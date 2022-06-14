<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de ordenes de reparación (para modificar el estatus del registro)
include_once(APPPATH . 'models/servicio/Ordenes_reparacion_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');
//Incluir la clase modelo de CFDI relacionados (para guardar los CFDI relacionados del registro)
include_once(APPPATH . 'models/caja/Cfdi_relacionados_model.php');
//Incluir la clase modelo de claves de autorización (para modificar el estatus de la clave)
include_once(APPPATH . 'models/cuentas_cobrar/Claves_autorizacion_model.php');
//Incluir la clase modelo de cancelaciones (para guardar la cancelación del timbrado (CFDI))
include_once(APPPATH . 'models/contabilidad/Cancelaciones_model.php');



class Facturas_servicio_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla facturas_servicio
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objFacturaServicio)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        //Se crea una instancia de la clase modelo (ordenes de reparación) 
        $otdModelOrdenesReparacion = new  Ordenes_reparacion_model();
        //Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();
        
		//Tabla facturas_servicio
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objFacturaServicio->strFolio); 

		//Concatenar hora, minutos y segundos
		$dteFecha = $objFacturaServicio->dteFecha.' '.date("H:i:s"); 
		
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objFacturaServicio->intSucursalID, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha,  
						  'condiciones_pago' => $objFacturaServicio->strCondicionesPago, 
						  'vencimiento' => $objFacturaServicio->dteVencimiento, 
						  'moneda_id' => $objFacturaServicio->intMonedaID, 
						  'tipo_cambio' => $objFacturaServicio->intTipoCambio,
						  'orden_reparacion_id' => $objFacturaServicio->intOrdenReparacionID,
						  'estrategia_id' => $objFacturaServicio->intEstrategiaID,
						  'prospecto_id' => $objFacturaServicio->intProspectoID,
						  'razon_social' => $objFacturaServicio->strRazonSocial, 
						  'rfc' => $objFacturaServicio->strRfc, 
						  'regimen_fiscal_id' => $objFacturaServicio->intRegimenFiscalID,
						  'calle' => $objFacturaServicio->strCalle,
						  'numero_exterior' => $objFacturaServicio->strNumeroExterior,
						  'numero_interior' => $objFacturaServicio->strNumeroInterior,
						  'codigo_postal' => $objFacturaServicio->strCodigoPostal,
						  'colonia' => $objFacturaServicio->strColonia,
						  'localidad' => $objFacturaServicio->strLocalidad,
						  'municipio' => $objFacturaServicio->strMunicipio,
						  'estado' => $objFacturaServicio->strEstado,
						  'pais' => $objFacturaServicio->strPais,
						  'gastos_servicio' => $objFacturaServicio->intGastosServicio,
						  'gastos_servicio_iva' => $objFacturaServicio->intGastosServicioIva,
						  'forma_pago_id' => $objFacturaServicio->intFormaPagoID,
						  'metodo_pago_id' => $objFacturaServicio->intMetodoPagoID,
						  'uso_cfdi_id' => $objFacturaServicio->intUsoCfdiID,
						  'tipo_relacion_id' => $objFacturaServicio->intTipoRelacionID,
						  'exportacion_id' => $objFacturaServicio->intExportacionID,
						  'observaciones' => $objFacturaServicio->strObservaciones,
						  'notas' => $objFacturaServicio->strNotas,
						  'estatus' => 'TIMBRAR',
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objFacturaServicio->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('facturas_servicio', $arrDatos);
		
		//Agregar id del nuevo registro al objeto
		$objFacturaServicio->intFacturaServicioID = $this->db->insert_id();
		
		//Hacer un llamado al método para guardar los servicios de mano de obra de la factura
		$this->guardar_servicios_mano_obra($objFacturaServicio);

		//Hacer un llamado al método para guardar las refacciones de la factura
		$this->guardar_refacciones($objFacturaServicio);

		//Hacer un llamado al método para guardar las refacciones de la factura
		$this->guardar_trabajos_foraneos($objFacturaServicio);

		//Hacer un llamado al método para guardar otros servicios de la factura
		$this->guardar_otros($objFacturaServicio);

		
		//Hacer un llamado al método para modificar el estatus de la orden de reparación
		$otdModelOrdenesReparacion->set_estatus($objFacturaServicio->intOrdenReparacionID, 'FACTURADO');

		//Hacer un llamado al método para guardar los CFDI relacionados de la factura
		$otdModelCfdiRelacionados->guardar($objFacturaServicio->intFacturaServicioID, 'FACTURA SERVICIO', 
										   $objFacturaServicio->strCfdiRelacionado, 
										   $objFacturaServicio->strTiposRelacion);



		//Si existe id de la clave de autorización, significa que se excedio del límite de crédito o el cliente tiene saldo vencido
		//en las facturas de maquinaria, refacciones y/o servicio
		if($objFacturaServicio->intClaveAutorizacionID > 0)
		{
			//Se crea una instancia de la clase modelo (claves de autorización) 
       	    $otdModelClavesAutorizacion = new  Claves_autorizacion_model();
       	    
       	    //Hacer un llamado al método para modificar el estatus de la clave de autorización
			$otdModelClavesAutorizacion->modificar($objFacturaServicio->intClaveAutorizacionID, 
										   	  	   'SERVICIO', $objFacturaServicio->intFacturaServicioID);

		}

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		//return $this->db->trans_status();
		return $this->db->trans_status().'_'.$objFacturaServicio->intFacturaServicioID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objFacturaServicio)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

        //Concatenar hora, minutos y segundos
		$dteFecha = $objFacturaServicio->dteFecha.' '.date("H:i:s"); 

		//Tabla facturas_servicio
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha,  
						  'condiciones_pago' => $objFacturaServicio->strCondicionesPago, 
						  'vencimiento' => $objFacturaServicio->dteVencimiento, 
						  'moneda_id' => $objFacturaServicio->intMonedaID, 
						  'tipo_cambio' => $objFacturaServicio->intTipoCambio,
						  'estrategia_id' => $objFacturaServicio->intEstrategiaID,
						  'prospecto_id' => $objFacturaServicio->intProspectoID,
						  'razon_social' => $objFacturaServicio->strRazonSocial, 
						  'rfc' => $objFacturaServicio->strRfc, 
						  'regimen_fiscal_id' => $objFacturaServicio->intRegimenFiscalID,
						  'calle' => $objFacturaServicio->strCalle,
						  'numero_exterior' => $objFacturaServicio->strNumeroExterior,
						  'numero_interior' => $objFacturaServicio->strNumeroInterior,
						  'codigo_postal' => $objFacturaServicio->strCodigoPostal,
						  'colonia' => $objFacturaServicio->strColonia,
						  'localidad' => $objFacturaServicio->strLocalidad,
						  'municipio' => $objFacturaServicio->strMunicipio,
						  'estado' => $objFacturaServicio->strEstado,
						  'pais' => $objFacturaServicio->strPais,
						  'gastos_servicio' => $objFacturaServicio->intGastosServicio,
						  'gastos_servicio_iva' => $objFacturaServicio->intGastosServicioIva,
						  'forma_pago_id' => $objFacturaServicio->intFormaPagoID,
						  'metodo_pago_id' => $objFacturaServicio->intMetodoPagoID,
						  'uso_cfdi_id' => $objFacturaServicio->intUsoCfdiID,
						  'tipo_relacion_id' => $objFacturaServicio->intTipoRelacionID,
						  'exportacion_id' => $objFacturaServicio->intExportacionID,
						  'observaciones' => $objFacturaServicio->strObservaciones,
						  'notas' => $objFacturaServicio->strNotas,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objFacturaServicio->intUsuarioID);
		$this->db->where('factura_servicio_id', $objFacturaServicio->intFacturaServicioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('facturas_servicio', $arrDatos);

		//Eliminar servicios de mano de obra guardados
		$this->db->where('factura_servicio_id', $objFacturaServicio->intFacturaServicioID);
		$this->db->delete('facturas_servicio_mano_obra');
		//Eliminar refacciones guardadas
		$this->db->where('factura_servicio_id', $objFacturaServicio->intFacturaServicioID);
		$this->db->delete('facturas_servicio_refacciones');
		//Eliminar trabajos foráneos guardados
		$this->db->where('factura_servicio_id', $objFacturaServicio->intFacturaServicioID);
		$this->db->delete('facturas_servicio_trabajos_foraneos');
		//Eliminar otros servicios guardados
		$this->db->where('factura_servicio_id', $objFacturaServicio->intFacturaServicioID);
		$this->db->delete('facturas_servicio_otros');

		//Hacer un llamado al método para guardar los servicios de mano de obra de la factura
		$this->guardar_servicios_mano_obra($objFacturaServicio);

		//Hacer un llamado al método para guardar las refacciones de la factura
		$this->guardar_refacciones($objFacturaServicio);

		//Hacer un llamado al método para guardar las refacciones de la factura
		$this->guardar_trabajos_foraneos($objFacturaServicio);

		//Hacer un llamado al método para guardar otros servicios de la factura
		$this->guardar_otros($objFacturaServicio);
		
		//Hacer un llamado al método para guardar los CFDI relacionados de la factura
		$otdModelCfdiRelacionados->guardar($objFacturaServicio->intFacturaServicioID, 
										  'FACTURA SERVICIO', 
										   $objFacturaServicio->strCfdiRelacionado, 
										   $objFacturaServicio->strTiposRelacion);


		//Si existe id de la clave de autorización, significa que se excedio del límite de crédito o el cliente tiene saldo vencido
		//en las facturas de maquinaria, refacciones y/o servicio
		if($objFacturaServicio->intClaveAutorizacionID > 0)
		{
			//Se crea una instancia de la clase modelo (claves de autorización) 
       	    $otdModelClavesAutorizacion = new  Claves_autorizacion_model();
       	    
       	    //Hacer un llamado al método para modificar el estatus de la clave de autorización
			$otdModelClavesAutorizacion->modificar($objFacturaServicio->intClaveAutorizacionID, 
										   	  	   'SERVICIO', $objFacturaServicio->intFacturaServicioID);

		}

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar los datos del timbrado de un registro previamente guardado
	public function modificar_timbrado(stdClass $objTimbrado)
	{
		//Asignar datos al array
		$arrDatos = array('estatus' => 'ACTIVO',
						  'certificado' =>  $objTimbrado->strCertificado, 
						  'sello' => $objTimbrado->strSello, 
						  'uuid' => $objTimbrado->strUuid, 
						  'fecha_timbrado' => $objTimbrado->strFechaTimbrado, 
						  'certificado_sat' => $objTimbrado->strCertificadoSat, 
						  'sello_sat' => $objTimbrado->strSelloSat, 
						  'leyenda_sat' => $objTimbrado->strLeyendaSat, 
						  'rfc_pac' => $objTimbrado->strRfcPac, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objTimbrado->intUsuarioID);
		$this->db->where('factura_servicio_id', $objTimbrado->intReferenciaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('facturas_servicio', $arrDatos);
	}

    //Método para modificar el estatus de un registro a INACTIVO 
	public function set_cancelar(stdClass $objCancelacionCfdi)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (ordenes de reparación) 
        $otdModelOrdenesReparacion = new  Ordenes_reparacion_model();
        //Se crea una instancia de la clase modelo (pólizas) 
        $otdModelPolizas = new Polizas_model();
        //Se crea una instancia de la clase modelo (cancelaciones) 
        $otdModelCancelaciones = new Cancelaciones_model();

		//Tabla facturas_servicio
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('factura_servicio_id', $objCancelacionCfdi->intReferenciaCfdiID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('facturas_servicio', $arrDatos);

		//Hacer un llamado al método para modificar el estatus de la orden de reparación
		$otdModelOrdenesReparacion->set_estatus($objCancelacionCfdi->intReferenciaIDReg, 'FINALIZADO');

		//Hacer un llamado al método para modificar el estatus de la póliza 
		$otdModelPolizas->set_estatus($objCancelacionCfdi->intPolizaID, 'INACTIVO');

		//Hacer un llamado al método para guardar cancelación del timbrado
		$otdModelCancelaciones->guardar($objCancelacionCfdi);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intFacturaServicioID = NULL, $dteFechaInicial = NULL,  $dteFechaFinal = NULL,
						   $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		$this->db->select("FS.factura_servicio_id, FS.folio, FS.fecha,
							DATE_FORMAT(FS.fecha,'%d/%m/%Y') AS fecha_format,
						   	FS.condiciones_pago, DATE_FORMAT(FS.vencimiento,'%d/%m/%Y') AS vencimiento, 
						   	FS.moneda_id, FS.tipo_cambio, FS.orden_reparacion_id,
						   	FS.estrategia_id, FS.prospecto_id, FS.razon_social, 
						   	FS.rfc, 
						   	CASE 
							   WHEN  FS.regimen_fiscal_id > 0 
							   		THEN FS.regimen_fiscal_id		
							   ELSE IFNULL(C.regimen_fiscal_id,0)
						    END regimen_fiscal_id,
						    IFNULL(FS.regimen_fiscal_id,0) AS regimenFiscalAnterior,
						   	FS.calle, FS.numero_exterior, FS.numero_interior, 
						   	FS.codigo_postal, FS.colonia, FS.localidad, FS.municipio, 
						   	FS.estado, FS.pais, FS.gastos_servicio, FS.gastos_servicio_iva,
						   	FS.forma_pago_id, FS.metodo_pago_id, FS.uso_cfdi_id,
						   	CASE   
						      WHEN FS.tipo_relacion_id > 0 THEN FS.tipo_relacion_id
						      ELSE ''  
						    END AS tipo_relacion_id, FS.exportacion_id, 
						   	FS.observaciones, FS.notas, FS.estatus,
						   	FS.certificado, FS.sello, FS.uuid, FS.fecha_timbrado, FS.certificado_sat, 
						   	FS.sello_sat, FS.leyenda_sat, FS.rfc_pac,
						   	OREP.folio AS folio_orden_reparacion,
						   	C.nombre_comercial AS cliente, C.correo_electronico,
						    C.contacto_correo_electronico, C.servicio_credito_dias,
						   	M.codigo AS MonedaTipo, 
						   	CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   	E.descripcion AS estrategia,
						   	CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, FP.codigo AS FormaPago,
						    CONCAT_WS(' - ', MP.codigo, MP.descripcion) AS metodo_pago, MP.codigo AS MetodoPago,
						    CONCAT_WS(' - ', U.codigo, U.descripcion) AS uso_cfdi, U.codigo AS UsoCFDI,
						    CONCAT_WS(' - ', TR.codigo, TR.descripcion) AS tipo_relacion,
						    TR.codigo AS TipoRelacion,
						    FS.condiciones_pago AS CondicionesDePago, 
						   	_utf8'I' AS TipoDeComprobante,
						   	CONCAT_WS(' - ', TC.codigo, TC.descripcion) AS tipo_comprobante,
						   	RF.codigo AS RegimenFiscal,
						   CONCAT_WS(' - ', RF.codigo, RF.descripcion) AS regimen_fiscal,
						   ECF.codigo AS CodigoExportacion,
						   CONCAT_WS(' - ', ECF.codigo, ECF.descripcion) AS exportacion,
						   	P.codigo AS CodigoProspecto, 
						   	IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza,
						   	UC.usuario AS usuario_creacion,
						   	IFNULL(CA.clave_autorizacion_id, 0) AS clave_autorizacion_id", FALSE);
	    $this->db->from('facturas_servicio AS FS');
	    $this->db->join('sat_monedas AS M', 'FS.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('estrategias AS E', 'FS.estrategia_id = E.estrategia_id', 'inner');
	    $this->db->join('ordenes_reparacion OREP', 'OREP.orden_reparacion_id = FS.orden_reparacion_id', 'inner');
	    $this->db->join('clientes AS C', 'FS.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS P', 'FS.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'FS.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'FS.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'FS.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'TR.tipo_relacion_id = FS.tipo_relacion_id', 'left');
	    $this->db->join('sat_tipos_comprobante AS TC', 'TC.codigo = "I"', 'left');
	     $this->db->join('sat_regimen_fiscal AS RF', 'FS.regimen_fiscal_id = RF.regimen_fiscal_id', 'left');
	     $this->db->join('sat_exportacion AS ECF', 'FS.exportacion_id = ECF.exportacion_id', 'left');
	    $this->db->join('usuarios AS UC', 'FS.usuario_creacion = UC.usuario_id', 'left');
	    $this->db->join('polizas AS PF', 'FS.factura_servicio_id = PF.referencia_id AND
	    							      PF.modulo = "SERVICIO" AND PF.proceso = "FACTURACION"', 'left');
	    $this->db->join('claves_autorizacion AS CA', 'FS.factura_servicio_id = CA.referencia_id AND
	    							     		      CA.referencia = "SERVICIO"', 'left');

		//Si existe id de la cotización
		if ($intFacturaServicioID != NULL)
		{   
			$this->db->where('FS.factura_servicio_id', $intFacturaServicioID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('FS.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('FS.prospecto_id', $intProspectoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(FS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(FS.estatus = 'TIMBRAR' OR FS.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('FS.estatus', $strEstatus);
				}
			}

			$this->db->where("((FS.folio LIKE '%$strBusqueda%') OR
		    				   (CONCAT_WS(' - ', FS.rfc, FS.razon_social) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', FS.rfc, FS.razon_social) LIKE '%$strBusqueda%') OR
	    				       (CONCAT_WS(' - ', FS.razon_social, FS.rfc) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', FS.razon_social, FS.rfc) LIKE '%$strBusqueda%'))");

			$this->db->order_by('FS.fecha DESC, FS.folio DESC');
			return $this->db->get()->result();
		}
	}


    //Método para regresar los datos de un registro (se utiliza para generar póliza)
	public function buscar_referencia_poliza($intReferenciaID, $strTipoReferencia)
	{
		//Constante para identificar al tipo de servicio: trabajo foráneo
		$intTipoServicioTF = TIPO_SERVICIO_TRABAJO_FORANEO;
		//Constante para identificar al tipo de servicio: facturación
		$intTipoServicioFacturacion = TIPO_SERVICIO_FACTURACION;
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
		$intMonedaBase = MONEDA_BASE;
		

		//Dependiendo del tipo de referencia realizar consulta
		if($strTipoReferencia == 'FACTURA SERVICIO')
		{
			//Facturas de servicio
			$queryReferencia = "SELECT FS.factura_servicio_id AS referencia_id, FS.sucursal_id,
										 FS.folio, FS.fecha, FS.moneda_id, FS.estatus,	
								  		 $intTipoServicioFacturacion AS servicio_tipo_id,
								  		 M.codigo AS Moneda
							    FROM facturas_servicio AS FS
							    LEFT JOIN sat_monedas AS M ON FS.moneda_id = M.moneda_id
							    WHERE FS.factura_servicio_id = $intReferenciaID";
		}
		else if ($strTipoReferencia == 'ORDEN DE TRABAJO')
		{
			//Ordenes de reparación
			$queryReferencia = "SELECT OREP.orden_reparacion_id AS referencia_id, 
								      OREP.sucursal_id, OREP.folio, 
								      OREP.fecha_finalizacion AS fecha, $intMonedaBase AS moneda_id,
								      OREP.estatus, OREP.servicio_tipo_id, 'MXN' AS Moneda
								FROM  ordenes_reparacion AS OREP
								WHERE OREP.orden_reparacion_id = $intReferenciaID";
		}
		else //Trabajos foráneos
		{
			//Trabajos foráneos
			$queryReferencia = "SELECT TF.trabajo_foraneo_id AS referencia_id,
									  TF.sucursal_id, TF.folio, TF.fecha, TF.moneda_id, 
									  TF.estatus, $intTipoServicioTF AS servicio_tipo_id, 
									  M.codigo AS Moneda
							   FROM trabajos_foraneos_02 AS TF
						  	   LEFT JOIN sat_monedas AS M ON TF.moneda_id = M.moneda_id
						  	   WHERE TF.trabajo_foraneo_id = $intReferenciaID";
		}
	

		//Ejecutar consulta
		$strSQL = $this->db->query($queryReferencia);
		return $strSQL->row();

	}

	//Método para regresar los detalles de un registro (se utiliza para generar póliza)
	public function buscar_detalles_poliza($intReferenciaID, $intServicioTipoID)
	{
		//Constantes para identificar los datos del SAT correspondientes al IVA 16%
		$intTasaCuotaIDIva = SAT_TASA_CUOTA_IVA_ID;
		//Constante para identificar al tipo de movimiento salida de refacciones por taller
		$intMovSalidaTaller = SALIDA_REFACCIONES_TALLER;
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución del taller
		$intMovEntradaDevolucion = ENTRADA_REFACCIONES_DEVOLUCION_TALLER;


		//Dependiendo del tipo de servicio realizar búsqueda de datos
		if($intServicioTipoID == TIPO_SERVICIO_PREENTREGA)//Pre entrega
		{
			//Pre Entrega
			$queryDetalles ="SELECT OREP.orden_reparacion_id AS referencia_id, 
									OREP.observaciones, 'MANO OBRA' AS Tipo, 
									SUM(ORS.horas * ORS.costo) AS Costo, 
									ML.maquinaria_linea_id,
									OREP.maquinaria_descripcion_id, MD.descripcion_corta, 
									OREP.serie, OREP.motor 
							FROM   ordenes_reparacion AS OREP INNER JOIN ordenes_reparacion_servicios AS ORS 
								   ON OREP.orden_reparacion_id = ORS.orden_reparacion_id 
								   INNER JOIN maquinaria_descripciones AS MD 
								   ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id 
								   INNER JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id 
						    WHERE  OREP.orden_reparacion_id = $intReferenciaID
							GROUP BY OREP.orden_reparacion_id";
			$queryDetalles.=" UNION ";
			$queryDetalles.="SELECT OREP.orden_reparacion_id AS referencia_id, 
								    OREP.observaciones, 'REFACCIONES' AS Tipo,
						      	    SUM(MRD.cantidad * MRD.costo_unitario) AS Costo, 
						      	    ML.maquinaria_linea_id, 
									OREP.maquinaria_descripcion_id, MD.descripcion_corta, 
									OREP.serie, OREP.motor 
							FROM   ordenes_reparacion AS OREP INNER JOIN requisiciones_refacciones AS RR 
								   ON OREP.orden_reparacion_id = RR.orden_reparacion_id
							INNER JOIN maquinaria_descripciones AS MD 
								   ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id 
							INNER JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id 
							INNER JOIN movimientos_refacciones AS MR
								  ON RR.requisicion_refacciones_id = MR.referencia_id AND MR.tipo_movimiento = $intMovSalidaTaller 
							INNER JOIN movimientos_refacciones_detalles AS MRD 
								  ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id 
							WHERE  OREP.orden_reparacion_id = $intReferenciaID
							AND    RR.estatus <> 'INACTIVO'
							AND    MR.estatus <> 'INACTIVO'
							GROUP BY OREP.orden_reparacion_id";
			$queryDetalles.=" UNION ";
			$queryDetalles.="SELECT OREP.orden_reparacion_id AS referencia_id, 
									OREP.observaciones, 'REFACCIONES' AS Tipo, 
								   SUM(MRDE.cantidad * MRDE.costo_unitario * -1) AS Costo, 
								   ML.maquinaria_linea_id, OREP.maquinaria_descripcion_id, 
								   MD.descripcion_corta, OREP.serie, OREP.motor
							FROM   ordenes_reparacion AS OREP INNER JOIN requisiciones_refacciones AS RR 
								   ON OREP.orden_reparacion_id = RR.orden_reparacion_id 
							INNER JOIN maquinaria_descripciones AS MD 
								  ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
							INNER JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id 
							INNER JOIN movimientos_refacciones AS MR
								   ON RR.requisicion_refacciones_id = MR.referencia_id AND MR.tipo_movimiento = $intMovSalidaTaller 
							INNER JOIN movimientos_refacciones_detalles AS MRD
								   ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id 
							INNER JOIN movimientos_refacciones AS MRE 
								   ON MRE.referencia_id = MR.movimiento_refacciones_id AND MRE.tipo_movimiento = $intMovEntradaDevolucion 
							INNER JOIN movimientos_refacciones_detalles AS MRDE 
								  ON MRE.movimiento_refacciones_id = MRDE.movimiento_refacciones_id
							   	AND MRD.renglon = MRDE.renglon 
								AND MRD.refaccion_id = MRDE.refaccion_id
							WHERE  OREP.orden_reparacion_id = $intReferenciaID
							AND    RR.estatus <> 'INACTIVO' 
							AND    MR.estatus <> 'INACTIVO'
							AND    MRE.estatus <> 'INACTIVO'
							GROUP BY OREP.orden_reparacion_id";
			$queryDetalles.=" UNION ";
			$queryDetalles.="SELECT OREP.orden_reparacion_id AS referencia_id, 
									OREP.observaciones, 'FORANEOS' AS Tipo,
									SUM(TFD.cantidad * (TFD.costo_unitario + TFD.ieps_unitario)) AS Costo, 
									ML.maquinaria_linea_id, OREP.maquinaria_descripcion_id, 
									MD.descripcion_corta, OREP.serie, OREP.motor
							FROM   ordenes_reparacion AS OREP INNER JOIN trabajos_foraneos_02 AS TF 
									ON OREP.orden_reparacion_id = TF.orden_reparacion_id
							INNER JOIN maquinaria_descripciones AS MD
								   ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
							INNER JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id
							INNER JOIN trabajos_foraneos_detalles AS TFD 
								   ON TF.trabajo_foraneo_id = TFD.trabajo_foraneo_id 
							WHERE  OREP.orden_reparacion_id = $intReferenciaID
							AND    TF.estatus <> 'INACTIVO'
							GROUP BY OREP.orden_reparacion_id
							ORDER BY Tipo";

		}
		else if($intServicioTipoID == TIPO_SERVICIO_INTERNO) //Servicio interno
		{

			//Servicio interno
			$queryDetalles = "SELECT OREP.orden_reparacion_id AS referencia_id, 
									 OREP.observaciones, 'MANO OBRA' AS Tipo, 
									 SUM(ORS.horas * ORS.costo) AS Costo, 
									 OREP.maquinaria_descripcion_id, 	   
									 MD.descripcion_corta, OREP.serie, OREP.motor
							  FROM   ordenes_reparacion AS OREP 
							  INNER JOIN ordenes_reparacion_servicios AS ORS  ON OREP.orden_reparacion_id = ORS.orden_reparacion_id 	   
							  INNER JOIN maquinaria_descripciones AS MD ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id 
							  WHERE  OREP.orden_reparacion_id = $intReferenciaID
							  GROUP BY OREP.orden_reparacion_id";
			$queryDetalles.= " UNION ";
			$queryDetalles.="SELECT OREP.orden_reparacion_id AS referencia_id, 
									OREP.observaciones, 'REFACCIONES' AS Tipo,  
									SUM(MRD.cantidad * MRD.costo_unitario) AS Costo, 
									OREP.maquinaria_descripcion_id,  MD.descripcion_corta, 
									OREP.serie, OREP.motor 
							 FROM   ordenes_reparacion AS OREP INNER JOIN requisiciones_refacciones AS RR 
						        	ON OREP.orden_reparacion_id = RR.orden_reparacion_id 
							 INNER JOIN maquinaria_descripciones AS MD
								   ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id        
							 INNER JOIN movimientos_refacciones AS MR  ON RR.requisicion_refacciones_id = MR.referencia_id AND MR.tipo_movimiento = $intMovSalidaTaller 	   
							 INNER JOIN movimientos_refacciones_detalles AS MRD 	   
							 	   ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id 
							 WHERE  OREP.orden_reparacion_id = $intReferenciaID
							 AND    RR.estatus <> 'INACTIVO'
							 AND    MR.estatus <> 'INACTIVO' 
							 GROUP BY OREP.orden_reparacion_id";
			$queryDetalles.= " UNION ";
			$queryDetalles.="SELECT OREP.orden_reparacion_id AS referencia_id, 
									OREP.observaciones, 'REFACCIONES' AS Tipo,    
								    SUM(MRDE.cantidad * MRDE.costo_unitario * -1) AS Costo, 
								    OREP.maquinaria_descripcion_id,	   
								    MD.descripcion_corta, OREP.serie, OREP.motor 
							 FROM   ordenes_reparacion AS OREP INNER JOIN requisiciones_refacciones AS RR 
							 		ON OREP.orden_reparacion_id = RR.orden_reparacion_id  
							 INNER JOIN maquinaria_descripciones AS MD   
							 	   ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id 
							 INNER JOIN movimientos_refacciones AS MR  
							 	   ON RR.requisicion_refacciones_id = MR.referencia_id 
							 	   AND MR.tipo_movimiento = $intMovSalidaTaller 	   
							 INNER JOIN movimientos_refacciones_detalles AS MRD  
							 	   ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id     
							 INNER JOIN movimientos_refacciones AS MRE 
							 		ON MRE.referencia_id = MR.movimiento_refacciones_id 
							 		AND MRE.tipo_movimiento = $intMovEntradaDevolucion 
						   	 INNER JOIN movimientos_refacciones_detalles AS MRDE 	  
						   	 	    ON MRE.movimiento_refacciones_id = MRDE.movimiento_refacciones_id 
								   AND MRD.renglon = MRDE.renglon 
								   AND MRD.refaccion_id = MRDE.refaccion_id
							 WHERE  OREP.orden_reparacion_id = $intReferenciaID
							 AND    RR.estatus <> 'INACTIVO' 
			                 AND    MR.estatus <> 'INACTIVO'
			                 AND    MRE.estatus <> 'INACTIVO'
			                 GROUP BY OREP.orden_reparacion_id";
			$queryDetalles.=" UNION ";
			$queryDetalles.="SELECT OREP.orden_reparacion_id AS referencia_id, 
								    OREP.observaciones, 'FORANEOS' AS Tipo, 
									SUM(TFD.cantidad * (TFD.costo_unitario + TFD.ieps_unitario)) AS Costo, 
									OREP.maquinaria_descripcion_id,	MD.descripcion_corta, 
									OREP.serie, OREP.motor 
							 FROM   ordenes_reparacion AS OREP INNER JOIN trabajos_foraneos_02 AS TF 
							   		ON OREP.orden_reparacion_id = TF.orden_reparacion_id 
				             INNER JOIN maquinaria_descripciones AS MD 	   
				             		ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id        
				             INNER JOIN trabajos_foraneos_detalles AS TFD 
				                   ON TF.trabajo_foraneo_id = TFD.trabajo_foraneo_id
				             WHERE  OREP.orden_reparacion_id = $intReferenciaID
							 AND    TF.estatus <> 'INACTIVO'
							 GROUP BY OREP.orden_reparacion_id 
							 ORDER BY Tipo";
		}
		else if($intServicioTipoID == TIPO_SERVICIO_TALLER) //Servicio interno taller
		{
			//Servicio interno taller
			$queryDetalles ="SELECT OREP.orden_reparacion_id AS referencia_id, 
									OREP.observaciones, 'MANO OBRA' AS Tipo,
								   SUM(ORS.horas * ORS.costo) AS Costo, OREP.maquinaria_descripcion_id,
								   MD.descripcion_corta, OREP.serie, OREP.motor
							 FROM  ordenes_reparacion AS OREP INNER JOIN ordenes_reparacion_servicios AS ORS
								   ON OREP.orden_reparacion_id = ORS.orden_reparacion_id 
				   			 INNER JOIN maquinaria_descripciones AS MD 
								   ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id 
							 WHERE  OREP.orden_reparacion_id = $intReferenciaID
							 GROUP BY OREP.orden_reparacion_id";
			$queryDetalles.=" UNION ";
			$queryDetalles.="SELECT OREP.orden_reparacion_id AS referencia_id, 
									OREP.observaciones, 'REFACCIONES' AS Tipo,
									SUM(MRD.cantidad * MRD.costo_unitario) AS Costo, 
									OREP.maquinaria_descripcion_id, MD.descripcion_corta, 
									OREP.serie, OREP.motor
							  FROM  ordenes_reparacion AS OREP INNER JOIN requisiciones_refacciones AS RR
								    ON OREP.orden_reparacion_id = RR.orden_reparacion_id
							  INNER JOIN maquinaria_descripciones AS MD
								   	ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
							  INNER JOIN movimientos_refacciones AS MR 
								    ON RR.requisicion_refacciones_id = MR.referencia_id 
								    AND MR.tipo_movimiento = $intMovSalidaTaller 
							  INNER JOIN movimientos_refacciones_detalles AS MRD
					         	    ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
							  WHERE  OREP.orden_reparacion_id = $intReferenciaID
							  AND    RR.estatus <> 'INACTIVO' 
							  AND    MR.estatus <> 'INACTIVO' 
							  GROUP BY OREP.orden_reparacion_id";
			$queryDetalles.=" UNION ";
			$queryDetalles.="SELECT OREP.orden_reparacion_id AS referencia_id, 
									OREP.observaciones, 'REFACCIONES' AS Tipo, 
							 	    SUM(MRDE.cantidad * MRDE.costo_unitario * -1) AS Costo, 
							 	    OREP.maquinaria_descripcion_id,
								    MD.descripcion_corta, OREP.serie, OREP.motor
							 FROM   ordenes_reparacion AS OREP INNER JOIN requisiciones_refacciones AS RR 
				   					ON OREP.orden_reparacion_id = RR.orden_reparacion_id 
				   			 INNER JOIN maquinaria_descripciones AS MD
			 					   ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
			 				 INNER JOIN movimientos_refacciones AS MR
								   ON RR.requisicion_refacciones_id = MR.referencia_id 
								   AND MR.tipo_movimiento = $intMovSalidaTaller
						     INNER JOIN movimientos_refacciones_detalles AS MRD 
								   ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
			 				 INNER JOIN movimientos_refacciones AS MRE 
								   ON MRE.referencia_id = MR.movimiento_refacciones_id 
								   AND MRE.tipo_movimiento = $intMovEntradaDevolucion 
			                 INNER JOIN movimientos_refacciones_detalles AS MRDE
			                       ON MRE.movimiento_refacciones_id = MRDE.movimiento_refacciones_id
		                    	   AND MRD.renglon = MRDE.renglon 
								   AND MRD.refaccion_id = MRDE.refaccion_id
							WHERE  OREP.orden_reparacion_id = $intReferenciaID
							AND    RR.estatus <> 'INACTIVO'
			                AND    MR.estatus <> 'INACTIVO'
							AND    MRE.estatus <> 'INACTIVO'
							GROUP BY OREP.orden_reparacion_id";
			$queryDetalles.=" UNION ";
			$queryDetalles.="SELECT OREP.orden_reparacion_id AS referencia_id, 
									OREP.observaciones, 'FORANEOS' AS Tipo,
							 	    SUM(TFD.cantidad * (TFD.costo_unitario + TFD.ieps_unitario)) AS Costo, 
							 	    OREP.maquinaria_descripcion_id,
								    MD.descripcion_corta, OREP.serie, OREP.motor
			                FROM   ordenes_reparacion AS OREP INNER JOIN trabajos_foraneos_02 AS TF
						    	   ON OREP.orden_reparacion_id = TF.orden_reparacion_id
							INNER JOIN maquinaria_descripciones AS MD
								   ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
							INNER JOIN trabajos_foraneos_detalles AS TFD 
								   ON TF.trabajo_foraneo_id = TFD.trabajo_foraneo_id
							WHERE  OREP.orden_reparacion_id = $intReferenciaID
							AND    TF.estatus <> 'INACTIVO' 
							GROUP BY OREP.orden_reparacion_id 
							ORDER BY Tipo";
		}
		else if ($intServicioTipoID == TIPO_SERVICIO_VENTAS)//Servicio interno ventas
		{
			//Servicio interno ventas
			$queryDetalles ="SELECT OREP.orden_reparacion_id AS referencia_id, 
									OREP.observaciones, 'MANO OBRA' AS Tipo, 
								    SUM(ORS.horas * ORS.costo) AS Costo, OREP.maquinaria_descripcion_id,
							    	MD.descripcion_corta, OREP.serie, OREP.motor
							FROM   ordenes_reparacion AS OREP INNER JOIN ordenes_reparacion_servicios AS ORS
								   ON OREP.orden_reparacion_id = ORS.orden_reparacion_id 
							INNER JOIN maquinaria_descripciones AS MD
								   ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
							WHERE  OREP.orden_reparacion_id = $intReferenciaID
							GROUP BY OREP.orden_reparacion_id";
			$queryDetalles.=" UNION ";
			$queryDetalles.="SELECT OREP.orden_reparacion_id AS referencia_id, 
								    OREP.observaciones, 'REFACCIONES' AS Tipo,
									SUM(MRD.cantidad * MRD.costo_unitario) AS Costo, 
									OREP.maquinaria_descripcion_id, MD.descripcion_corta, 
									OREP.serie, OREP.motor
							FROM   ordenes_reparacion AS OREP INNER JOIN requisiciones_refacciones AS RR 
								   ON OREP.orden_reparacion_id = RR.orden_reparacion_id
			 				INNER JOIN maquinaria_descripciones AS MD 
								   ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
							INNER JOIN movimientos_refacciones AS MR
								  ON RR.requisicion_refacciones_id = MR.referencia_id 
								  AND MR.tipo_movimiento = $intMovSalidaTaller 
						    INNER JOIN movimientos_refacciones_detalles AS MRD
								   ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id 
			                WHERE  OREP.orden_reparacion_id = $intReferenciaID
							AND    RR.estatus <> 'INACTIVO'
							AND    MR.estatus <> 'INACTIVO'
							GROUP BY OREP.orden_reparacion_id";
			$queryDetalles.=" UNION ";
			$queryDetalles.="SELECT OREP.orden_reparacion_id AS referencia_id, 
									OREP.observaciones, 'REFACCIONES' AS Tipo, 
								    SUM(MRDE.cantidad * MRDE.costo_unitario * -1) AS Costo, 
								    OREP.maquinaria_descripcion_id, 
									MD.descripcion_corta, OREP.serie, OREP.motor
							FROM   ordenes_reparacion AS OREP INNER JOIN requisiciones_refacciones AS RR
								   ON OREP.orden_reparacion_id = RR.orden_reparacion_id
							INNER JOIN maquinaria_descripciones AS MD 
								  ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id 
							INNER JOIN movimientos_refacciones AS MR 
								  ON RR.requisicion_refacciones_id = MR.referencia_id 
								  AND MR.tipo_movimiento = $intMovSalidaTaller 
							INNER JOIN movimientos_refacciones_detalles AS MRD
								   ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
							INNER JOIN movimientos_refacciones AS MRE 
								   ON MRE.referencia_id = MR.movimiento_refacciones_id 
								   AND MRE.tipo_movimiento = $intMovEntradaDevolucion
							INNER JOIN movimientos_refacciones_detalles AS MRDE
								   ON MRE.movimiento_refacciones_id = MRDE.movimiento_refacciones_id
								   AND MRD.renglon = MRDE.renglon 
								   AND MRD.refaccion_id = MRDE.refaccion_id 
							WHERE  OREP.orden_reparacion_id = $intReferenciaID
							AND    RR.estatus <> 'INACTIVO'
							AND    MR.estatus <> 'INACTIVO'
							AND    MRE.estatus <> 'INACTIVO'
							GROUP BY OREP.orden_reparacion_id";
			$queryDetalles.=" UNION ";
			$queryDetalles.="SELECT OREP.orden_reparacion_id AS referencia_id, 
									OREP.observaciones, 'FORANEOS' AS Tipo, 
								    SUM(TFD.cantidad * (TFD.costo_unitario + TFD.ieps_unitario)) AS Costo, 
								    OREP.maquinaria_descripcion_id, 
							   		MD.descripcion_corta, OREP.serie, OREP.motor
			                FROM   ordenes_reparacion AS OREP INNER JOIN trabajos_foraneos_02 AS TF
								   ON OREP.orden_reparacion_id = TF.orden_reparacion_id
						    INNER JOIN maquinaria_descripciones AS MD 
								  ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
						    INNER JOIN trabajos_foraneos_detalles AS TFD 
								  ON TF.trabajo_foraneo_id = TFD.trabajo_foraneo_id 
							WHERE  OREP.orden_reparacion_id = $intReferenciaID
							AND    TF.estatus <> 'INACTIVO'
							GROUP BY OREP.orden_reparacion_id
							ORDER BY Tipo";
		}
		else if ($intServicioTipoID == TIPO_SERVICIO_TRABAJO_FORANEO)//Trabajo foráneo
		{
			//Trabajos foráneos
			$queryDetalles ="SELECT TF.trabajo_foraneo_id AS referencia_id, 
									CASE 
									   WHEN  OC.orden_compra_id > 0 
									   		THEN  P.codigo
										    ELSE PS.codigo
								    END AS codigo,
								    CASE 
									   WHEN  OC.orden_compra_id > 0 
									   		THEN  P.razon_social
										    ELSE PS.razon_social
								    END AS razon_social,
								    CASE 
									   WHEN  OC.orden_compra_id > 0 
									   		THEN  P.tipo_proveedor
										    ELSE PS.tipo_proveedor
								    END AS tipo_proveedor,
								    TF.factura, SUM(TFD.cantidad * TFD.costo_unitario) AS Subtotal,
									SUM(TFD.cantidad * TFD.iva_unitario) AS IVA, 
								    TFD.tasa_cuota_ieps, STC.valor_maximo AS TasaIEPS, 
								    SUM(TFD.cantidad * TFD.ieps_unitario) AS IEPS 
							FROM   trabajos_foraneos_02 AS TF INNER JOIN trabajos_foraneos_detalles AS TFD 
								   ON TF.trabajo_foraneo_id = TFD.trabajo_foraneo_id 
							LEFT JOIN ordenes_compra AS OC ON TF.orden_compra_id = OC.orden_compra_id
								  AND TF.tipo_referencia = 'GENERAL'
							LEFT JOIN proveedores AS P ON OC.proveedor_id = P.proveedor_id
							LEFT JOIN ordenes_compra_servicio AS OCS ON TF.orden_compra_id = OCS.orden_compra_servicio_id
								  AND TF.tipo_referencia = 'SERVICIO'
							LEFT JOIN proveedores AS PS ON OCS.proveedor_id = PS.proveedor_id
							LEFT JOIN sat_tasa_cuota AS STC ON TFD.tasa_cuota_ieps = STC.tasa_cuota_id 
						    WHERE  TF.trabajo_foraneo_id = $intReferenciaID
							GROUP BY TF.trabajo_foraneo_id, TFD.tasa_cuota_ieps
							ORDER BY TFD.tasa_cuota_ieps";
		}
		else if ($intServicioTipoID == TIPO_SERVICIO_FACTURACION)//Factura de servicio
		{

			//Detalles de la factura de servicio
			$queryDetalles ="SELECT FS.factura_servicio_id AS referencia_id, 1 AS renglon, 
									P.codigo, FS.razon_social, FS.condiciones_pago, 
							    	FS.orden_reparacion_id, 'SERVICIO' AS Tipo, 
							 	    ROUND(FS.gastos_servicio, 2) AS Subtotal,
								    $intTasaCuotaIDIva AS tasa_cuota_iva, 
								    ROUND(FS.gastos_servicio_iva, 2) AS IVA, 
								    NULL AS tasa_cuota_ieps, '' AS TasaIEPS,  0 AS IEPS 
							FROM   facturas_servicio AS FS INNER JOIN prospectos AS P ON FS.prospecto_id = P.prospecto_id
							WHERE  FS.factura_servicio_id = $intReferenciaID";
			$queryDetalles.=" UNION ";
			$queryDetalles.="SELECT FS.factura_servicio_id AS referencia_id, FSM.renglon, P.codigo, 
								    FS.razon_social, FS.condiciones_pago, 
							    	FS.orden_reparacion_id, 'MANO OBRA' AS Tipo,
							 	    ROUND((FSM.precio_unitario), 2) AS Subtotal, 
								    FSM.tasa_cuota_iva, ROUND((FSM.iva_unitario), 2) AS IVA,
								    FSM.tasa_cuota_ieps, STC.valor_maximo AS TasaIEPS,
								    ROUND((FSM.ieps_unitario), 2) AS IEPS 
							FROM   facturas_servicio AS FS 
							INNER JOIN facturas_servicio_mano_obra AS FSM 
								   ON FS.factura_servicio_id = FSM.factura_servicio_id 
						   	INNER JOIN prospectos AS P ON FS.prospecto_id = P.prospecto_id
						   	LEFT JOIN sat_tasa_cuota AS STC ON FSM.tasa_cuota_ieps = STC.tasa_cuota_id 
							WHERE  FS.factura_servicio_id = $intReferenciaID";
			$queryDetalles.=" UNION ";
			$queryDetalles.="SELECT FS.factura_servicio_id AS referencia_id, 
									FSR.renglon, P.codigo, FS.razon_social, FS.condiciones_pago, 
								    FS.orden_reparacion_id, 'REFACCIONES' AS Tipo, 
								    ROUND((FSR.cantidad * FSR.precio_unitario), 2) AS Subtotal, 
								    FSR.tasa_cuota_iva, 
								    ROUND((FSR.cantidad * FSR.iva_unitario), 2) AS IVA,
									FSR.tasa_cuota_ieps, STC.valor_maximo AS TasaIEPS,
									ROUND((FSR.cantidad * FSR.ieps_unitario), 2) AS IEPS 
							FROM   facturas_servicio AS FS 
							INNER JOIN facturas_servicio_refacciones AS FSR 
								   ON FS.factura_servicio_id = FSR.factura_servicio_id 
							INNER JOIN prospectos AS P ON FS.prospecto_id = P.prospecto_id 
							LEFT JOIN sat_tasa_cuota AS STC ON FSR.tasa_cuota_ieps = STC.tasa_cuota_id
							WHERE  FS.factura_servicio_id = $intReferenciaID";
			$queryDetalles.=" UNION ";
			$queryDetalles.="SELECT FS.factura_servicio_id AS referencia_id, FST.renglon, P.codigo, 
								    FS.razon_social, FS.condiciones_pago, 
									FS.orden_reparacion_id, 'FORANEOS' AS Tipo, 
								    ROUND((FST.cantidad * FST.precio_unitario), 2) AS Subtotal, 
							   		FST.tasa_cuota_iva, 
							   		ROUND((FST.cantidad * FST.iva_unitario), 2) AS IVA,
									FST.tasa_cuota_ieps,  STC.valor_maximo AS TasaIEPS,
									ROUND((FST.cantidad * FST.ieps_unitario), 2) AS IEPS
							 FROM   facturas_servicio AS FS 
							 INNER JOIN facturas_servicio_trabajos_foraneos AS FST 
									ON FS.factura_servicio_id = FST.factura_servicio_id 
							 INNER JOIN prospectos AS P ON FS.prospecto_id = P.prospecto_id
							 LEFT JOIN sat_tasa_cuota AS STC ON FST.tasa_cuota_ieps = STC.tasa_cuota_id
							 WHERE  FS.factura_servicio_id = $intReferenciaID";
			$queryDetalles.=" UNION ";
			$queryDetalles.="SELECT FS.factura_servicio_id AS referencia_id, FSO.renglon, P.codigo, 
								    FS.razon_social, FS.condiciones_pago, 
									FS.orden_reparacion_id, 'OTROS' AS Tipo, 
								    ROUND((FSO.cantidad * FSO.precio_unitario), 2) AS Subtotal, 
							   		FSO.tasa_cuota_iva, 
							   		ROUND((FSO.cantidad * FSO.iva_unitario), 2) AS IVA,
									FSO.tasa_cuota_ieps,  STC.valor_maximo AS TasaIEPS,
									ROUND((FSO.cantidad * FSO.ieps_unitario), 2) AS IEPS
							 FROM   facturas_servicio AS FS 
							 INNER JOIN facturas_servicio_otros AS FSO 
									ON FS.factura_servicio_id = FSO.factura_servicio_id 
							 INNER JOIN prospectos AS P ON FS.prospecto_id = P.prospecto_id
							 LEFT JOIN sat_tasa_cuota AS STC ON FSO.tasa_cuota_ieps = STC.tasa_cuota_id
							 WHERE  FS.factura_servicio_id = $intReferenciaID";
			$queryDetalles.=" ORDER BY tasa_cuota_iva, tasa_cuota_ieps";
		}


		//Ejecutar consulta
		$strSQL = $this->db->query($queryDetalles);
		return $strSQL->result();
	}

	/*Método para regresar las facturas que coincidan con los criterios de búsqueda proporcionados 
	 (se utiliza en el reporte de facturación)*/
	public function buscar_facturas($dteFechaInicial, $dteFechaFinal, $intProspectoID = NULL,  
									$intMonedaID = NULL, $strSucursales = NULL, 
									$strServiciosTipos = NULL, $strTipoReporte = NULL)
	{

		//Prospecto
		$strRestriccionesProspecto = '';
		//Moneda
		$strRestriccionesMoneda = '';
		//ID´s de las sucursales
		$strRestriccionesSucursales = '';
		//ID´s de los tipos de servicios
		$strRestriccionesServiciosTipos = '';
		//Variable que se utiliza para ordenar los registros dependiendo del tipo de búsqueda
		$strOrdenamiento = " ORDER BY ";

		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			$strRestriccionesProspecto .= " AND FS.prospecto_id = $intProspectoID";
		}

		 //Si existe id de la moneda
		if($intMonedaID > 0)
		{
			$strRestriccionesMoneda .= " AND FS.moneda_id = $intMonedaID";
			$strOrdenamiento .= " FS.moneda_id,";
		}


		//Si existen sucursales seleccionadas
		if($strSucursales)
		{	

			//Generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
			$strRestriccionesSucursales .= " AND (";

		    //Quitar | de la lista para obtener el id de la sucursal
			$arrSucursales = explode("|", $strSucursales);

			//Hacer recorrido para formar restricción con los ID's de las sucursales
			for ($intCon = 0; $intCon < sizeof($arrSucursales); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otra sucursal)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesSucursales .= " OR ";
				}

				//Concatenar id de la sucursal 
				$strRestriccionesSucursales .= "FS.sucursal_id = ".$arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}


		//Si existen tipos de servicios seleccionados
		if($strServiciosTipos)
		{	


			//Generar las condiciones dinamicas de las consultas respecto a la columna servicio_tipo_id
			$strRestriccionesServiciosTipos .= " AND (";

		    //Quitar | de la lista para obtener el id del tipo de servicio
			$arrServiciosTipos = explode("|", $strServiciosTipos);

			//Hacer recorrido para formar restricción con los ID's de los tipos de servicios
			for ($intCon = 0; $intCon < sizeof($arrServiciosTipos); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otro tipo de servicio)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesServiciosTipos .= " OR ";
				}

				

				//Concatenar id del tipo de servicio 
				$strRestriccionesServiciosTipos .= "OREP.servicio_tipo_id = ".$arrServiciosTipos[$intCon];
			}

			$strRestriccionesServiciosTipos .= ")";


		}


		//Dependiendo del tipo de reporte ordenar los datos
		if($strTipoReporte == 'SEPARADO_SERVICIO_TIPO')
		{
			$strOrdenamiento .= " OREP.servicio_tipo_id, FS.fecha, FS.folio";
		}
		else
		{
			$strOrdenamiento .= " FS.fecha, FS.folio";
		}

	


		//Facturas de servicio
		$queryFacturas = "SELECT FS.factura_servicio_id, FS.orden_reparacion_id, 
								 FS.folio, FS.moneda_id, FS.tipo_cambio, FS.gastos_servicio,
								 FS.gastos_servicio_iva, FS.estatus,
								 DATE_FORMAT(FS.fecha, '%d/%m/%Y') AS fecha, 
								 C.razon_social,
								 M.codigo AS MonedaTipo, OREP.folio AS folio_orden_reparacion,
								 OREP.servicio_tipo_id, 
								 S.nombre AS sucursal, ST.descripcion AS servicio_tipo,
								 (ServicioDetalles.Subtotal) AS subtotal,
						         (ServicioDetalles.IVA) AS iva,
						         (ServicioDetalles.IEPS) AS ieps,
						         (ServicioDetalles.Total) AS importe
						  FROM facturas_servicio AS FS
						  INNER JOIN clientes C ON C.prospecto_id = FS.prospecto_id
						  INNER JOIN prospectos AS PP ON C.prospecto_id = PP.prospecto_id
						  INNER JOIN sat_monedas AS M ON FS.moneda_id = M.moneda_id
						  INNER JOIN sucursales AS S ON FS.sucursal_id = S.sucursal_id
						  INNER JOIN ordenes_reparacion AS OREP ON FS.orden_reparacion_id = OREP.orden_reparacion_id
						  INNER JOIN servicios_tipos AS ST ON OREP.servicio_tipo_id = ST.servicio_tipo_id
						  INNER JOIN (SELECT Reg.factura_servicio_id AS referenciaID,
				   						    (IFNULL(ROUND(((Reg.gastos_servicio + Reg.gastos_servicio_iva)/
		    													Reg.tipo_cambio), 2), 0) +  
		   						  		     IFNULL(ROUND((ManoObra.Importe/Reg.tipo_cambio), 2), 0) +
		   						  		     IFNULL(ROUND((Otros.Importe/Reg.tipo_cambio), 2), 0) +
		   						  		     IFNULL(ROUND((Refacciones.Importe/Reg.tipo_cambio), 2), 0) +
		   						  		     IFNULL(ROUND((Foraneos.Importe/Reg.tipo_cambio), 2), 0)) AS Total,
		   						  		    (IFNULL(ROUND((Reg.gastos_servicio/Reg.tipo_cambio), 2), 0) +  
				   						  	  IFNULL(ROUND((ManoObra.Subtotal/Reg.tipo_cambio), 2), 0) +
			   						  		  IFNULL(ROUND((Otros.Subtotal/Reg.tipo_cambio), 2), 0) +
			   						  		  IFNULL(ROUND((Refacciones.Subtotal/Reg.tipo_cambio), 2), 0) +
			   						  		  IFNULL(ROUND((Foraneos.Subtotal/Reg.tipo_cambio), 2), 0)) AS Subtotal,
		   						  		   (IFNULL(ROUND((Reg.gastos_servicio_iva/Reg.tipo_cambio), 2), 0) + 
			   						  	    IFNULL(ROUND((ManoObra.IVA/Reg.tipo_cambio), 2), 0) +
			   						  	    IFNULL(ROUND((Otros.IVA/Reg.tipo_cambio), 2), 0) +
			   						  	    IFNULL(ROUND((Refacciones.IVA/Reg.tipo_cambio), 2), 0) +
			   						  	    IFNULL(ROUND((Foraneos.IVA/Reg.tipo_cambio), 2), 0)) AS IVA,
				   						   (IFNULL(ROUND((ManoObra.IEPS/Reg.tipo_cambio), 2), 0) +
				   						    IFNULL(ROUND((Otros.IEPS/Reg.tipo_cambio), 2), 0) + 
				   						    IFNULL(ROUND((Refacciones.IEPS/Reg.tipo_cambio), 2), 0) +
				   						    IFNULL(ROUND((Foraneos.IEPS/Reg.tipo_cambio), 2), 0)) AS IEPS
				   					 FROM facturas_servicio AS Reg
				   					 LEFT JOIN (SELECT Det.factura_servicio_id,
												      SUM(ROUND(Det.precio_unitario,2) + 
												      	  ROUND(Det.iva_unitario,2) + 
												      	  ROUND(Det.ieps_unitario,2)) AS Importe, 
												      SUM(Det.precio_unitario) AS Subtotal, 
												      SUM(ROUND(Det.iva_unitario,2)) AS IVA, 
												      SUM(ROUND(Det.ieps_unitario,2)) AS IEPS
									            FROM  facturas_servicio_mano_obra AS Det
									            INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
											    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									           GROUP BY Det.factura_servicio_id) AS ManoObra ON Reg.factura_servicio_id = ManoObra.factura_servicio_id
									LEFT JOIN (SELECT Det.factura_servicio_id,
													  SUM(ROUND((Det.precio_unitario * Det.cantidad), 2) + 
							   						  	  ROUND((Det.iva_unitario * Det.cantidad), 2) + 
							   						  	  ROUND((Det.ieps_unitario * Det.cantidad), 2)) AS Importe,
							   						  SUM(ROUND((Det.precio_unitario * Det.cantidad), 2)) AS Subtotal, 
												      SUM(ROUND((Det.iva_unitario * Det.cantidad), 2)) AS IVA, 
												      SUM(ROUND((Det.ieps_unitario * Det.cantidad), 2)) AS IEPS
									           FROM   facturas_servicio_otros AS Det
									            INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				  			    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									           GROUP BY Det.factura_servicio_id) AS Otros ON Reg.factura_servicio_id = Otros.factura_servicio_id
									LEFT JOIN (SELECT Det.factura_servicio_id,
												      SUM(ROUND((Det.precio_unitario * Det.cantidad), 2) + 
							   						  	  ROUND((Det.iva_unitario * Det.cantidad), 2) + 
							   						  	  ROUND((Det.ieps_unitario * Det.cantidad), 2)) AS Importe,
							   						  SUM(ROUND((Det.precio_unitario * Det.cantidad), 2)) AS Subtotal, 
												      SUM(ROUND((Det.iva_unitario * Det.cantidad), 2)) AS IVA, 
												      SUM(ROUND((Det.ieps_unitario * Det.cantidad), 2)) AS IEPS
									           FROM   facturas_servicio_refacciones AS Det
									           INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				   			   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									           GROUP BY Det.factura_servicio_id) AS Refacciones ON Reg.factura_servicio_id = Refacciones.factura_servicio_id
									LEFT JOIN (SELECT Det.factura_servicio_id, 
													  SUM(ROUND((Det.precio_unitario * Det.cantidad), 2) + 
							   						  	  ROUND((Det.iva_unitario * Det.cantidad), 2) + 
							   						  	  ROUND((Det.ieps_unitario * Det.cantidad), 2)) AS Importe,
							   						  SUM(ROUND((Det.precio_unitario * Det.cantidad), 2)) AS Subtotal, 
												      SUM(ROUND((Det.iva_unitario * Det.cantidad), 2)) AS IVA, 
												      SUM(ROUND((Det.ieps_unitario * Det.cantidad), 2)) AS IEPS
									           FROM   facturas_servicio_trabajos_foraneos AS Det
									           INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				   			   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									           GROUP BY  Det.factura_servicio_id) AS Foraneos ON Reg.factura_servicio_id = Foraneos.factura_servicio_id) AS ServicioDetalles ON ServicioDetalles.referenciaID = FS.factura_servicio_id
					   WHERE  DATE_FORMAT(FS.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'
					   $strRestriccionesSucursales 
					   $strRestriccionesServiciosTipos
					   $strRestriccionesMoneda
					   $strRestriccionesProspecto
					   $strOrdenamiento";


	    $strSQL = $this->db->query($queryFacturas);
		return $strSQL->result();

	}




	//Método para regresar los detalles de un registro para mostrarlos en el archivo XML
	public function buscar_detalles_xml($intFacturaServicioID)
	{
		//Variable que se utiliza para formar la  consulta
		$queryDetalles = '';
		//Variable que se utilizan para agregar unión del detalle (fijo) gastos de servicio
		$queryGastosServicio = '';

		//Seleccionar los gatos de servicio de la factura
		$otdGastosServicio = $this->buscar_gastos_servicio($intFacturaServicioID);
		
		//Si la factura cuenta con gastos de servicio
		if($otdGastosServicio)
		{	
			//Constantes para identificar los datos del SAT correspondientes al gasto de servicio
       		$strClaveProductoServ = CLAVE_PRODUCTO_SAT_GASTOS_SERVICIO;
       		$strClaveUnidad = CLAVE_UNIDAD_SAT_GASTOS_SERVICIO;
       		$strUnidad = UNIDAD_SAT_GASTOS_SERVICIO;
       		$strClaveObjetoImpuesto = CLAVE_OBJETOIMP_SAT_GASTOS_SERVICIO;
       		$strConceptoObjetoImpuesto = CONCEPTO_OBJETOIMP_SAT_GASTOS_SERVICIO;
       		$strDescripcion = DESCRIPCION_SAT_GASTOS_SERVICIO;
       		$strConcepto = CONCEPTO_SAT_GASTOS_SERVICIO;
       		$strDescuento = DESCUENTO_GASTOS_SERVICIO;
       		$strIeps = IEPS_GASTOS_PAQUETERIA;
       		$strPorcentajeIva = PORCENTAJE_IVA_GASTOS_SERVICIO;
       		$strFactorIva = FACTOR_IVA_GASTOS_SERVICIO;
       		$strImpuestoIva = IMPUESTO_IVA_GASTOS_SERVICIO;

			//Variable que se utiliza para asignar el último renglón de los detalles
			$intUltimoRenglon = $otdGastosServicio->renglon;
			//Variable que se utiliza para asignar el gasto de servicio
			$intGastosServicio = $otdGastosServicio->gastos_servicio;
			//Variable que se utiliza para asignar el iva del gasto de servicio
			$intGastosServicioIva = $otdGastosServicio->gastos_servicio_iva;
			
			
			//Detalle del gasto de servicio
			$queryGastosServicio = " UNION ";
			$queryGastosServicio .= "SELECT	'' AS ID, 
											$intUltimoRenglon AS renglon,  
											$strClaveProductoServ AS ClaveProdServ,
											_utf8'' AS NoIdentificacion, 
											'1' AS cantidad,
											'$strClaveUnidad' AS ClaveUnidad, 
											'$strUnidad' AS Unidad,
											'$strClaveObjetoImpuesto' AS ClaveObjetoImpuesto,
											'$strDescripcion' AS Descripcion,
											'$strConcepto' AS concepto,									
											$intGastosServicio AS subtotal, 
											$strDescuento AS descuento, 
											$intGastosServicioIva AS iva, 
											$strIeps AS ieps,
											_utf8'' AS Pedimento, 
											$strPorcentajeIva AS PorcentajeIva, 
											'$strFactorIva' AS FactorIva,  
											'$strImpuestoIva' AS ImpuestoIva,  
											NULL AS PorcentajeIeps,
											NULL AS FactorIeps, 
											NULL AS ImpuestoIeps,
											'$strConceptoObjetoImpuesto' AS objeto_impuesto";

		}//Cierre de verificación de gastos de servicio

		//Variables para definir los detalles que  se incluiran en la búsqueda
		//Servicios de mano de obra
		$queryMO = "SELECT FSMO.servicio_id AS ID, 
						   FSMO.renglon AS renglon,
					       FSMO.codigo_sat AS ClaveProdServ,
						   _utf8'' AS NoIdentificacion,  
						   1 AS cantidad,
					      FSMO.unidad_sat AS ClaveUnidad,
					      SU.nombre AS Unidad,
					      FSMO.objeto_impuesto_sat AS ClaveObjetoImpuesto, 
						  FSMO.descripcion AS Descripcion,
					     FSMO.descripcion AS concepto, 
						 FSMO.precio_unitario AS subtotal, 
						 FSMO.descuento_unitario AS descuento, 
						 FSMO.iva_unitario AS iva, 
						 FSMO.ieps_unitario AS ieps, 
						 _utf8'' AS Pedimento,
						 TIva.valor_maximo AS PorcentajeIva, 
						 TIva.factor AS FactorIva,  
						 IIva.codigo AS ImpuestoIva,  
						 TIeps.valor_maximo AS PorcentajeIeps,
						 TIeps.factor AS FactorIeps, IIeps.codigo AS ImpuestoIeps,
						 CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto 
					FROM facturas_servicio_mano_obra AS FSMO
					INNER JOIN facturas_servicio AS FS ON FS.factura_servicio_id = FSMO.factura_servicio_id
					INNER JOIN sat_unidades SU ON SU.codigo = FSMO.unidad_sat
					INNER JOIN  sat_tasa_cuota AS TIva ON  FSMO.tasa_cuota_iva = TIva.tasa_cuota_id 
					INNER JOIN  sat_impuestos AS IIva ON TIva.impuesto_id = IIva.impuesto_id
					LEFT JOIN  sat_tasa_cuota AS TIeps ON FSMO.tasa_cuota_ieps = TIeps.tasa_cuota_id
					LEFT JOIN  sat_impuestos AS IIeps ON TIeps.impuesto_id = IIeps.impuesto_id
					LEFT JOIN sat_objeto_impuesto AS OImp ON FSMO.objeto_impuesto_sat = OImp.codigo
					WHERE FSMO.factura_servicio_id = $intFacturaServicioID";

		//Refacciones
		$queryRefacciones = "SELECT FSR.refaccion_id AS ID, 
									FSR.renglon AS renglon,
							    	FSR.codigo_sat AS ClaveProdServ,
									_utf8'' AS NoIdentificacion,  
									FSR.cantidad AS cantidad,
							    	FSR.unidad_sat AS ClaveUnidad, 
							    	SU.nombre AS Unidad,
							    	FSR.objeto_impuesto_sat AS ClaveObjetoImpuesto, 
							   	 	FSR.descripcion AS Descripcion,
							    	FSR.descripcion AS concepto, 
									FSR.precio_unitario AS subtotal, 
									FSR.descuento_unitario AS descuento, 
									FSR.iva_unitario AS iva, 
									FSR.ieps_unitario AS ieps, 
								 	_utf8'' AS Pedimento, 
								 	TIva.valor_maximo AS PorcentajeIva, 
								 	TIva.factor AS FactorIva,  
								 	IIva.codigo AS ImpuestoIva,  
								 	TIeps.valor_maximo AS PorcentajeIeps,
									TIeps.factor AS FactorIeps, IIeps.codigo AS ImpuestoIeps, 
									CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto
							FROM facturas_servicio_refacciones AS FSR
							INNER JOIN facturas_servicio AS FS ON FS.factura_servicio_id = FSR.factura_servicio_id
							INNER JOIN sat_unidades SU ON SU.codigo = FSR.unidad_sat
							INNER JOIN  sat_tasa_cuota AS TIva ON  FSR.tasa_cuota_iva = TIva.tasa_cuota_id 
							INNER JOIN  sat_impuestos AS IIva ON TIva.impuesto_id = IIva.impuesto_id
							LEFT JOIN  sat_tasa_cuota AS TIeps ON FSR.tasa_cuota_ieps = TIeps.tasa_cuota_id
							LEFT JOIN  sat_impuestos AS IIeps ON TIeps.impuesto_id = IIeps.impuesto_id
							LEFT JOIN sat_objeto_impuesto AS OImp ON FSR.objeto_impuesto_sat = OImp.codigo
							WHERE FSR.factura_servicio_id = $intFacturaServicioID";

		//Trabajos foráneos
		$queryTF = "SELECT FSTF.factura_servicio_id AS ID, 
						   FSTF.renglon AS renglon,  
					       FSTF.codigo_sat AS ClaveProdServ,
						   _utf8'' AS NoIdentificacion,  
						   FSTF.cantidad AS cantidad,
						   FSTF.unidad_sat AS ClaveUnidad, 
					       SU.nombre AS Unidad,
					       FSTF.objeto_impuesto_sat AS ClaveObjetoImpuesto, 	
					       FSTF.concepto AS Descripcion,
					       FSTF.concepto AS concepto, 
						   FSTF.precio_unitario AS subtotal, 
						   FSTF.descuento_unitario AS descuento, 
						   FSTF.iva_unitario AS iva, 
						   FSTF.ieps_unitario AS ieps, 
						   _utf8'' AS Pedimento, 
						   TIva.valor_maximo AS PorcentajeIva, 
						   TIva.factor AS FactorIva,  
						   IIva.codigo AS ImpuestoIva,  
						   TIeps.valor_maximo AS PorcentajeIeps,
						   TIeps.factor AS FactorIeps, IIeps.codigo AS ImpuestoIeps,
						   CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto
					FROM facturas_servicio_trabajos_foraneos AS FSTF
					INNER JOIN facturas_servicio AS FS ON FS.factura_servicio_id = FSTF.factura_servicio_id
					INNER JOIN sat_unidades SU ON SU.codigo = FSTF.unidad_sat
					INNER JOIN  sat_tasa_cuota AS TIva ON  FSTF.tasa_cuota_iva = TIva.tasa_cuota_id 
					INNER JOIN  sat_impuestos AS IIva ON TIva.impuesto_id = IIva.impuesto_id
					LEFT JOIN  sat_tasa_cuota AS TIeps ON FSTF.tasa_cuota_ieps = TIeps.tasa_cuota_id
					LEFT JOIN  sat_impuestos AS IIeps ON TIeps.impuesto_id = IIeps.impuesto_id
					LEFT JOIN sat_objeto_impuesto AS OImp ON FSTF.objeto_impuesto_sat = OImp.codigo
					WHERE FSTF.factura_servicio_id = $intFacturaServicioID";

		//Otros servicios
		$queryOtros = "SELECT FSO.factura_servicio_id AS ID, 
						   	  FSO.renglon AS renglon,  
					       	  FSO.codigo_sat AS ClaveProdServ,
						   	  _utf8'' AS NoIdentificacion,  
						   	  FSO.cantidad AS cantidad,
						   	  FSO.unidad_sat AS ClaveUnidad, 
					       	  SU.nombre AS Unidad,	
					       	  FSO.objeto_impuesto_sat AS ClaveObjetoImpuesto, 
					       	  FSO.concepto AS Descripcion,
					       	  FSO.concepto AS concepto, 
						   	  FSO.precio_unitario AS subtotal, 
						   	  FSO.descuento_unitario AS descuento, 
						   	  FSO.iva_unitario AS iva, 
						      FSO.ieps_unitario AS ieps, 
						   	  _utf8'' AS Pedimento, 
						      TIva.valor_maximo AS PorcentajeIva, 
						      TIva.factor AS FactorIva,  
						      IIva.codigo AS ImpuestoIva,  
						      TIeps.valor_maximo AS PorcentajeIeps,
						      TIeps.factor AS FactorIeps, IIeps.codigo AS ImpuestoIeps,
						      CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto
		FROM facturas_servicio_otros AS FSO
		INNER JOIN facturas_servicio AS FS ON FS.factura_servicio_id = FSO.factura_servicio_id
		INNER JOIN sat_unidades SU ON SU.codigo = FSO.unidad_sat
		INNER JOIN  sat_tasa_cuota AS TIva ON  FSO.tasa_cuota_iva = TIva.tasa_cuota_id 
		INNER JOIN  sat_impuestos AS IIva ON TIva.impuesto_id = IIva.impuesto_id
		LEFT JOIN  sat_tasa_cuota AS TIeps ON FSO.tasa_cuota_ieps = TIeps.tasa_cuota_id
		LEFT JOIN  sat_impuestos AS IIeps ON TIeps.impuesto_id = IIeps.impuesto_id
		LEFT JOIN sat_objeto_impuesto AS OImp ON FSO.objeto_impuesto_sat = OImp.codigo
		WHERE FSO.factura_servicio_id = $intFacturaServicioID";

		
		//Formar consulta
		$queryDetalles  .= $queryMO;
		$queryDetalles  .= " UNION ";
		$queryDetalles  .= $queryRefacciones;
		$queryDetalles  .= " UNION ";
		$queryDetalles  .= $queryTF;
		$queryDetalles  .= " UNION ";
		$queryDetalles  .= $queryOtros;
		$queryDetalles  .= $queryGastosServicio;

		$strSQL = $this->db->query($queryDetalles);
		return $strSQL->result();

	}


	//Método para regresar la información de gastos de servicio de un registro
	public function buscar_gastos_servicio($intFacturaServicioID)
	{
		$this->db->select("FS.gastos_servicio, 
			               FS.gastos_servicio_iva, 
						   (IFNULL((SELECT MAX(FSMO.renglon)
									 FROM facturas_servicio_mano_obra AS FSMO
								     WHERE FSMO.factura_servicio_id = FS.factura_servicio_id) +
								    (SELECT MAX(FSR.renglon)
									  FROM facturas_servicio_refacciones AS FSR
								      WHERE FSR.factura_servicio_id = FS.factura_servicio_id) +
								    (SELECT MAX(FSTF.renglon)
									  FROM facturas_servicio_trabajos_foraneos AS FSTF
								      WHERE FSTF.factura_servicio_id = FS.factura_servicio_id), 0) + 1) AS renglon", FALSE);
		$this->db->from('facturas_servicio AS FS');
		$this->db->where('FS.factura_servicio_id', $intFacturaServicioID);
		$this->db->where('FS.gastos_servicio > 0');
		$this->db->limit(1);
		return $this->db->get()->row();
	}


	//Método para regresar la información de un movimiento fiscal que será cancelado
	public function buscar_movimiento_fiscal($intFacturaServicioID)
	{
		$strSQL = $this->db->query("SELECT E.rfc AS RFC, 
										NOW() AS Fecha, 
										FS.uuid, 
										FS.folio 
									FROM facturas_servicio AS FS
									INNER JOIN sucursales AS S ON S.sucursal_id = FS.sucursal_id   
									INNER JOIN empresas E ON E.empresa_id = S.empresa_id
									WHERE FS.factura_servicio_id = $intFacturaServicioID");
		return $strSQL->result();
	}


	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						  					 $intProspectoID = NULL, $strEstatus = NULL, 
						  					 $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

        $this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
        $this->db->from('facturas_servicio AS FS');
	    $this->db->join('sat_monedas AS M', 'FS.moneda_id = M.moneda_id', 'inner');
	    $this->db->where('FS.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
	 	//Si existe id del prospecto
	    if($intProspectoID > 0)
	    {
	   		$this->db->where('FS.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(FS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('FS.estatus', $strEstatus);
		}

		$this->db->where("((FS.folio LIKE '%$strBusqueda%') OR
	    				     (CONCAT_WS(' - ', FS.rfc, FS.razon_social) LIKE '%$strBusqueda%') OR
		                     (CONCAT_WS(' ', FS.rfc, FS.razon_social) LIKE '%$strBusqueda%') OR
    				         (CONCAT_WS(' - ', FS.razon_social, FS.rfc) LIKE '%$strBusqueda%') OR
		                     (CONCAT_WS(' ', FS.razon_social, FS.rfc) LIKE '%$strBusqueda%'))");
		

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
		
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL, 
						   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoRefCFDI = $this->db->escape('FACTURA SERVICIO');


		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('FS.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('FS.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(FS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(FS.estatus = 'TIMBRAR' OR FS.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('FS.estatus', $strEstatus);
			}
		}


		$this->db->where("((FS.folio LIKE '%$strBusqueda%') OR
		    				   (CONCAT_WS(' - ', FS.rfc, FS.razon_social) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', FS.rfc, FS.razon_social) LIKE '%$strBusqueda%') OR
	    				       (CONCAT_WS(' - ', FS.razon_social, FS.rfc) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', FS.razon_social, FS.rfc) LIKE '%$strBusqueda%'))");

		$this->db->from('facturas_servicio AS FS');
	    $this->db->join('sat_monedas AS M', 'FS.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('estrategias AS E', 'FS.estrategia_id = E.estrategia_id', 'inner');
	    $this->db->join('ordenes_reparacion OREP', 'OREP.orden_reparacion_id = FS.orden_reparacion_id', 'inner');
	    $this->db->join('clientes AS C', 'FS.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'FS.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'FS.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'FS.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('polizas AS PF', 'FS.factura_servicio_id = PF.referencia_id AND
	    							       PF.modulo = "SERVICIO" AND PF.proceso = "FACTURACION"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("FS.factura_servicio_id, FS.folio, 
						   DATE_FORMAT(FS.fecha,'%d/%m/%Y') AS fecha, 
						   FS.orden_reparacion_id, FS.rfc, FS.razon_social, 
						   IFNULL(FS.regimen_fiscal_id,0) AS regimen_fiscal_id,
						   FS.estatus, FS.uuid, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza, 
						   IFNULL(CCFDI.cancelacion_id, 0) AS cancelacion_id", FALSE);
		$this->db->from('facturas_servicio AS FS');
	    $this->db->join('sat_monedas AS M', 'FS.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('estrategias AS E', 'FS.estrategia_id = E.estrategia_id', 'inner');
	    $this->db->join('ordenes_reparacion OREP', 'OREP.orden_reparacion_id = FS.orden_reparacion_id', 'inner');
	    $this->db->join('clientes AS C', 'FS.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'FS.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'FS.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'FS.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('polizas AS PF', 'FS.factura_servicio_id = PF.referencia_id AND
	    							       PF.modulo = "SERVICIO" AND PF.proceso = "FACTURACION"', 'left');
	    $this->db->join('cancelaciones AS CCFDI', 'CCFDI.tipo_referencia = '.$strTipoRefCFDI.' 
	    							        	  AND CCFDI.referencia_id = FS.factura_servicio_id', 'left');

	    $this->db->where('FS.sucursal_id', $this->session->userdata('sucursal_id'));
	    //Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('FS.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(FS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(FS.estatus = 'TIMBRAR' OR FS.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('FS.estatus', $strEstatus);
			}
		}
		$this->db->where("((FS.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', FS.rfc, FS.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', FS.rfc, FS.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', FS.razon_social, FS.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', FS.razon_social, FS.rfc) LIKE '%$strBusqueda%'))");
		
		$this->db->order_by('FS.fecha DESC, FS.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["facturas"] =$this->db->get()->result();
		return $arrResultado;
	}
	

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strFormulario, $intReferenciaID)
	{
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución de la factura
		$intMovDevRef = ENTRADA_REFACCIONES_DEVOLUCION_FACTURA;

		$this->db->select("FS.factura_servicio_id, FS.folio, FS.uuid, 
							CASE 
								  WHEN  FS.regimen_fiscal_id > 0 
								  THEN FS.regimen_fiscal_id		
								ELSE IFNULL(C.regimen_fiscal_id,0)
							    END regimen_fiscal_id", FALSE);
        $this->db->from('facturas_servicio AS FS');
         $this->db->join('clientes AS C', 'FS.prospecto_id = C.prospecto_id', 'inner');
        $this->db->where('FS.sucursal_id', $this->session->userdata('sucursal_id'));
        //Si el formulario (proceso) corresponde a una nota de crédito de servicio 
        if($strFormulario == 'NOTA CREDITO')
        {
        	$this->db->where("(FS.factura_servicio_id NOT IN 
        					   (SELECT NCS.factura_servicio_id 
        					   	FROM  notas_credito_servicio AS NCS 
        					   	WHERE (NCS.estatus = 'ACTIVO' OR NCS.estatus = 'TIMBRAR')))",NULL,FALSE);

        	$this->db->where("(FS.factura_servicio_id NOT IN 
        					   (SELECT MR.referencia_id 
        					   	FROM  movimientos_refacciones AS MR 
        					   	WHERE  MR.tipo_movimiento = $intMovDevRef
				   				AND MR.tipo_referencia = 'SERVICIO'
        					   	AND (MR.estatus = 'ACTIVO' OR MR.estatus = 'TIMBRAR')))",NULL,FALSE);
        }
        else if($strFormulario == 'cancelacion')//Si el formulario corresponde a una cancelación de timbrado
        {
        	$this->db->where('factura_servicio_id <>', $intReferenciaID);
        }
        $this->db->where('FS.estatus', 'ACTIVO');
        $this->db->where("(FS.folio LIKE '%$strDescripcion%')"); 
		$this->db->order_by('FS.folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}


	/*******************************************************************************************************************
	Funciones de la tabla facturas_servicio_mano_obra
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los servicios de mano de obra de la factura
	public function guardar_servicios_mano_obra(stdClass $objFacturaServicio)
	{
		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener los servicios de mano de obra de la factura
		foreach ($objFacturaServicio->arrServiciosManoObra as $arrDets)
		{
			//Hacer recorrido para obtener los datos del servicio
			foreach ($arrDets as $arrDet)
			{
				//Incrementar renglón consecutivo
				$intRenglon++;

				//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
				//Asignar datos al array
				$arrDatos = array('factura_servicio_id' => $objFacturaServicio->intFacturaServicioID,
								  'renglon' => $intRenglon,
								  'servicio_id' => $arrDet->intServicioID,
								  'codigo' =>  mb_strtoupper($arrDet->strCodigo),
								  'descripcion' => mb_strtoupper($arrDet->strDescripcion),
								  'codigo_sat' => $arrDet->strCodigoSat,
								  'unidad_sat' => $arrDet->strUnidadSat,
								  'objeto_impuesto_sat' => $arrDet->strObjetoImpuestoSat,
								  'precio_unitario' => $arrDet->intPrecioUnitario,
								  'descuento_unitario' => $arrDet->intDescuentoUnitario,
								  'tasa_cuota_iva' => $arrDet->intTasaCuotaIva,
								  'iva_unitario' => $arrDet->intIvaUnitario,
								  'tasa_cuota_ieps' => $arrDet->intTasaCuotaIeps,
								  'ieps_unitario' => $arrDet->intIepsUnitario);
				//Guardar los datos del registro
				$this->db->insert('facturas_servicio_mano_obra', $arrDatos);
			}
		}
	}

	//Método para regresar los servicios de mano de obra de un registro
	public function buscar_servicios_mano_obra($intFacturaServicioID)
	{
		$this->db->select("FSMO.servicio_id, FSMO.codigo, FSMO.descripcion, FSMO.codigo_sat, 
						   FSMO.unidad_sat, FSMO.objeto_impuesto_sat, FSMO.precio_unitario, FSMO.descuento_unitario, 
						   FSMO.tasa_cuota_iva, FSMO.iva_unitario, FSMO.tasa_cuota_ieps,
						   FSMO.ieps_unitario, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps", FALSE);
		$this->db->from('facturas_servicio_mano_obra AS FSMO');
		$this->db->join('sat_tasa_cuota AS TIva', 'FSMO.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'FSMO.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('FSMO.factura_servicio_id', $intFacturaServicioID);
		$this->db->order_by('FSMO.renglon', 'ASC');
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla facturas_servicio_refacciones
	*********************************************************************************************************************/
	//Función que se utiliza para guardar las refacciones de la factura
	public function guardar_refacciones(stdClass $objFacturaServicio)
	{
		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener las refacciones de la factura
		foreach ($objFacturaServicio->arrRefacciones as $arrDets)
		{
			//Hacer recorrido para obtener los datos de la refacción
			foreach ($arrDets as $arrDet)
			{
				//Incrementar renglón consecutivo
				$intRenglon++;

				//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
				//Asignar datos al array
				$arrDatos = array('factura_servicio_id' => $objFacturaServicio->intFacturaServicioID,
								  'renglon' => $intRenglon,
								  'refaccion_id' => $arrDet->intRefaccionID,
								  'codigo' =>  mb_strtoupper($arrDet->strCodigo),
								  'descripcion' => mb_strtoupper($arrDet->strDescripcion),
								  'codigo_linea' => $arrDet->strCodigoLinea,
								  'codigo_sat' => $arrDet->strCodigoSat,
								  'unidad_sat' => $arrDet->strUnidadSat,
								  'objeto_impuesto_sat' => $arrDet->strObjetoImpuestoSat,
								  'cantidad' => $arrDet->intCantidad,
								  'precio_unitario' => $arrDet->intPrecioUnitario,
								  'descuento_unitario' => $arrDet->intDescuentoUnitario,
								  'tasa_cuota_iva' => $arrDet->intTasaCuotaIva,
								  'iva_unitario' => $arrDet->intIvaUnitario,
								  'tasa_cuota_ieps' => $arrDet->intTasaCuotaIeps,
								  'ieps_unitario' => $arrDet->intIepsUnitario);
				//Guardar los datos del registro
				$this->db->insert('facturas_servicio_refacciones', $arrDatos);
			}
		}
	}

	//Método para regresar las refacciones de un registro
	public function buscar_refacciones($intFacturaServicioID, $intOrdenReparacionID = NULL)
	{
		$this->db->select("FSR.refaccion_id, FSR.codigo, FSR.descripcion, 
						   FSR.codigo_linea, FSR.codigo_sat, FSR.unidad_sat,
						   FSR.objeto_impuesto_sat, FSR.cantidad, FSR.precio_unitario, 
						   FSR.descuento_unitario, FSR.tasa_cuota_iva, FSR.iva_unitario, FSR.tasa_cuota_ieps,
						   FSR.ieps_unitario, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps", FALSE);
		$this->db->from('facturas_servicio_refacciones AS FSR');
		$this->db->join('sat_tasa_cuota AS TIva', 'FSR.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'FSR.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('FSR.factura_servicio_id', $intFacturaServicioID);
		$this->db->order_by('FSR.renglon', 'ASC');
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla facturas_servicio_trabajos_foraneos
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los trabajos foráneos de la factura
	public function guardar_trabajos_foraneos(stdClass $objFacturaServicio)
	{
		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener los trabajos foráneos de la factura
		foreach ($objFacturaServicio->arrTrabajosForaneos as $arrDets)
		{
			//Hacer recorrido para obtener los datos del trabajo foráneo
			foreach ($arrDets as $arrDet)
			{
				//Incrementar renglón consecutivo
				$intRenglon++;

				//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
				$intTasaCuotaIeps = (($arrDet->intTasaCuotaIeps !== '') ? 
						   	  	  	  $arrDet->intTasaCuotaIeps : NULL);

				//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
				//Asignar datos al array
				$arrDatos = array('factura_servicio_id' => $objFacturaServicio->intFacturaServicioID,
								  'renglon' => $intRenglon,
								  'concepto' => mb_strtoupper($arrDet->strConcepto),
								  'codigo_sat' => $arrDet->strCodigoSat,
								  'unidad_sat' => $arrDet->strUnidadSat,
								  'objeto_impuesto_sat' => $arrDet->strObjetoImpuestoSat,
								  'cantidad' => $arrDet->intCantidad,
								  'precio_unitario' => $arrDet->intPrecioUnitario,
								  'descuento_unitario' => $arrDet->intDescuentoUnitario,
								  'tasa_cuota_iva' => $arrDet->intTasaCuotaIva,
								  'iva_unitario' => $arrDet->intIvaUnitario,
								  'tasa_cuota_ieps' => $intTasaCuotaIeps,
								  'ieps_unitario' => $arrDet->intIepsUnitario);
				//Guardar los datos del registro
				$this->db->insert('facturas_servicio_trabajos_foraneos', $arrDatos);
			}
		}
	}

	//Método para regresar los trabajos foráneos de un registro
	public function buscar_trabajos_foraneos($intFacturaServicioID)
	{
		$this->db->select("FSTF.concepto,  FSTF.codigo_sat, 
						   FSTF.unidad_sat, FSTF.objeto_impuesto_sat, 
						   FSTF.cantidad, FSTF.precio_unitario, 
						   FSTF.descuento_unitario, FSTF.tasa_cuota_iva, 
						   FSTF.iva_unitario, FSTF.tasa_cuota_ieps,
						   FSTF.ieps_unitario, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps", FALSE);
		$this->db->from('facturas_servicio_trabajos_foraneos AS FSTF');
		$this->db->join('sat_tasa_cuota AS TIva', 'FSTF.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'FSTF.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('FSTF.factura_servicio_id', $intFacturaServicioID);
		$this->db->order_by('FSTF.renglon', 'ASC');
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla facturas_servicio_otros
	*********************************************************************************************************************/
	//Función que se utiliza para guardar otros servicios de la factura
	public function guardar_otros(stdClass $objFacturaServicio)
	{
		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener losotros servicios de la factura
		foreach ($objFacturaServicio->arrOtros as $arrDets)
		{
		//Hacer recorrido para obtener los datos del detalle (otro servicio)
			foreach ($arrDets as $arrDet)
			{
				//Incrementar renglón consecutivo
				$intRenglon++;

				//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
				$intTasaCuotaIeps = (($arrDet->intTasaCuotaIeps !== '') ? 
						   	  	  	  $arrDet->intTasaCuotaIeps : NULL);

				//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
				//Asignar datos al array
				$arrDatos = array('factura_servicio_id' => $objFacturaServicio->intFacturaServicioID,
								  'renglon' => $intRenglon,
								  'concepto' => mb_strtoupper($arrDet->strConcepto),
								  'codigo_sat' => $arrDet->strCodigoSat,
								  'unidad_sat' => $arrDet->strUnidadSat,
								  'objeto_impuesto_sat' => $arrDet->strObjetoImpuestoSat,
								  'cantidad' => $arrDet->intCantidad,
								  'precio_unitario' => $arrDet->intPrecioUnitario,
								  'descuento_unitario' => $arrDet->intDescuentoUnitario,
								  'tasa_cuota_iva' => $arrDet->intTasaCuotaIva,
								  'iva_unitario' => $arrDet->intIvaUnitario,
								  'tasa_cuota_ieps' => $intTasaCuotaIeps,
								  'ieps_unitario' => $arrDet->intIepsUnitario);
				//Guardar los datos del registro
				$this->db->insert('facturas_servicio_otros', $arrDatos);
			}
		}
	}

	//Método para regresar los otros servicios de un registro
	public function buscar_otros($intFacturaServicioID)
	{
		$this->db->select("FSO.concepto,  FSO.codigo_sat, 
						   FSO.unidad_sat, FSO.objeto_impuesto_sat, 
						   FSO.cantidad, FSO.precio_unitario, 
						   FSO.descuento_unitario, FSO.tasa_cuota_iva, 
						   FSO.iva_unitario, FSO.tasa_cuota_ieps,
						   FSO.ieps_unitario, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps", FALSE);
		$this->db->from('facturas_servicio_otros AS FSO');
		$this->db->join('sat_tasa_cuota AS TIva', 'FSO.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'FSO.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('FSO.factura_servicio_id', $intFacturaServicioID);
		$this->db->order_by('FSO.renglon', 'ASC');
		return $this->db->get()->result();
	}

	
	/*******************************************************************************************************************
	Funciones que corresponden a las ordenes de reparación
	*********************************************************************************************************************/
	//Método para regresar los acumulados del costo unitario de una orden de reparación
	public function buscar_acumulados_costo_orden_reparacion($intOrdenReparacionID)
	{
		$strSQL = $this->db->query("SELECT IFNULL((SELECT SUM(ORS.horas * ORS.costo) 
													 FROM ordenes_reparacion_servicios AS ORS
													 WHERE ORS.orden_reparacion_id = O.orden_reparacion_id
													 AND ORS.estatus = 'FINALIZADO'), 0) AS acumulado_mano_obra,
											IFNULL((SELECT SUM(TFD.costo_unitario * TFD.cantidad) 
													 FROM trabajos_foraneos_02 AS TF
													 INNER JOIN trabajos_foraneos_detalles AS TFD ON TF.trabajo_foraneo_id = TFD.trabajo_foraneo_id
													 WHERE TF.orden_reparacion_id = O.orden_reparacion_id
													 AND TF.estatus = 'ACTIVO'), 0) AS acumulado_trabajos_foraneos
									FROM  ordenes_reparacion AS O
									WHERE O.orden_reparacion_id = $intOrdenReparacionID");
		return $strSQL->result();
	}

	//Método para regresar las salidas y entradas por devolución de una orden de reparación
	public function buscar_refacciones_orden_reparacion($intOrdenReparacionID)
	{
		//Constante para identificar al tipo de movimiento salida de refacciones por taller
		$intMovSalidaTaller = SALIDA_REFACCIONES_TALLER; 
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución del taller
		$intMovEntradaDevolucion = ENTRADA_REFACCIONES_DEVOLUCION_TALLER;

		$strSQL = $this->db->query("SELECT MR.folio, MR.fecha, 'SALIDA POR TALLER' AS descripcion, 'salida' AS tipo,
										   DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha_format, MR.estatus,
										   RR.folio AS folio_requisicion, 
										   SUM(MRD.cantidad * MRD.precio_unitario) AS subtotal, 
										   SUM(MRD.cantidad * MRD.costo_unitario) AS acumulado_costo
									FROM movimientos_refacciones AS MR
									INNER JOIN requisiciones_refacciones AS RR ON MR.referencia_id = RR.requisicion_refacciones_id
									INNER JOIN movimientos_refacciones_detalles AS MRD ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
									WHERE MR.tipo_movimiento = $intMovSalidaTaller
									AND RR.orden_reparacion_id = $intOrdenReparacionID
									AND MR.estatus = 'ACTIVO'
									GROUP BY MR.movimiento_refacciones_id
									UNION 
									SELECT MRE.folio, MRE.fecha, 'ENTRADA POR DEV. DE TALLER' AS descripcion, 'entrada' AS tipo,
										   DATE_FORMAT(MRE.fecha,'%d/%m/%Y') AS fecha_format, MRE.estatus, 
										   RR.folio AS folio_requisicion, 
										   SUM(MRDE.cantidad * MRDE.precio_unitario) AS subtotal, 
										   SUM(MRDE.cantidad * MRDE.costo_unitario) AS acumulado_costo
									FROM movimientos_refacciones AS MRE
									INNER JOIN movimientos_refacciones_detalles AS MRDE ON MRE.movimiento_refacciones_id = MRDE.movimiento_refacciones_id
									INNER JOIN movimientos_refacciones AS MRS ON MRE.referencia_id = MRS.movimiento_refacciones_id
									INNER JOIN requisiciones_refacciones AS RR ON MRS.referencia_id = RR.requisicion_refacciones_id
									WHERE MRE.tipo_movimiento = $intMovEntradaDevolucion
									AND RR.orden_reparacion_id = $intOrdenReparacionID
									GROUP BY MRE.movimiento_refacciones_id
									ORDER BY fecha ASC");
		return $strSQL->result();
	}

}	
?>