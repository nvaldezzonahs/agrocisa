<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');
//Incluir la clase modelo de CFDI relacionados (para guardar los CFDI relacionados del registro)
include_once(APPPATH . 'models/caja/Cfdi_relacionados_model.php');
//Incluir la clase modelo de cotizaciones de refacciones (para modificar el estatus de la cotización)
include_once(APPPATH . 'models/refacciones/Cotizaciones_refacciones_model.php');
//Incluir la clase modelo de pedidos de refacciones (para modificar el estatus del pedido)
include_once(APPPATH . 'models/refacciones/Pedidos_refacciones_model.php');
//Incluir la clase modelo de remisiones de refacciones (para modificar el estatus de la remisión)
include_once(APPPATH . 'models/refacciones/Remisiones_refacciones_model.php');
//Incluir la clase modelo de claves de autorización (para modificar el estatus de la clave)
include_once(APPPATH . 'models/cuentas_cobrar/Claves_autorizacion_model.php');
//Incluir la clase modelo de cancelaciones (para guardar la cancelación del timbrado (CFDI))
include_once(APPPATH . 'models/contabilidad/Cancelaciones_model.php');


class Facturas_refacciones_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla facturas_refacciones
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objFacturaRefacciones)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        //Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objFacturaRefacciones->strFolio); 

		//Concatenar hora, minutos y segundos
		$dteFecha = $objFacturaRefacciones->dteFecha.' '.date("H:i:s"); 

		//Tabla facturas_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objFacturaRefacciones->intSucursalID, 
						  'folio' => $strFolioConsecutivo,
						  'fecha' => $dteFecha,
						  'condiciones_pago' => $objFacturaRefacciones->strCondicionesPago,
						  'vencimiento' => $objFacturaRefacciones->dteVencimiento,
						  'moneda_id' => $objFacturaRefacciones->intMonedaID, 
						  'tipo_cambio' => $objFacturaRefacciones->intTipoCambio, 
						  'tipo_referencia' => $objFacturaRefacciones->strTipoReferencia, 
						  'referencia_id' => $objFacturaRefacciones->intReferenciaID,
						  'vendedor_id' => $objFacturaRefacciones->intVendedorID,
						  'estrategia_id' => $objFacturaRefacciones->intEstrategiaID,
						  'tipo' => $objFacturaRefacciones->strTipo,  
						  'prospecto_id' => $objFacturaRefacciones->intProspectoID, 
						  'razon_social' => $objFacturaRefacciones->strRazonSocial,
						  'rfc' => $objFacturaRefacciones->strRfc,
						  'regimen_fiscal_id' => $objFacturaRefacciones->intRegimenFiscalID,
						  'calle' => $objFacturaRefacciones->strCalle,
						  'numero_exterior' => $objFacturaRefacciones->strNumeroExterior,
						  'numero_interior' => $objFacturaRefacciones->strNumeroInterior,
						  'codigo_postal' => $objFacturaRefacciones->strCodigoPostal,
						  'colonia' => $objFacturaRefacciones->strColonia,
						  'localidad' => $objFacturaRefacciones->strLocalidad,
						  'municipio' => $objFacturaRefacciones->strMunicipio,
						  'estado' => $objFacturaRefacciones->strEstado,
						  'pais' => $objFacturaRefacciones->strPais,
						  'gastos_paqueteria' => $objFacturaRefacciones->intGastosPaqueteria,
						  'gastos_paqueteria_iva' => $objFacturaRefacciones->intGastosPaqueteriaIva,
						  'forma_pago_id' => $objFacturaRefacciones->intFormaPagoID,
						  'metodo_pago_id' => $objFacturaRefacciones->intMetodoPagoID,
						  'uso_cfdi_id' => $objFacturaRefacciones->intUsoCfdiID,
						  'tipo_relacion_id' => $objFacturaRefacciones->intTipoRelacionID,
						  'exportacion_id' => $objFacturaRefacciones->intExportacionID,
						  'observaciones' => $objFacturaRefacciones->strObservaciones, 
						  'notas' => $objFacturaRefacciones->strNotas, 
						  'estatus'  => 'TIMBRAR',
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objFacturaRefacciones->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('facturas_refacciones', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objFacturaRefacciones->intFacturaRefaccionesID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la factura
		$this->guardar_detalles($objFacturaRefacciones);

		//Hacer un llamado al método para guardar los CFDI relacionados del anticipo
		$otdModelCfdiRelacionados->guardar($objFacturaRefacciones->intFacturaRefaccionesID, 
										   'FACTURA REFACCIONES', 
										   $objFacturaRefacciones->strCfdiRelacionado, 
										   $objFacturaRefacciones->strTiposRelacion);

		//Hacer un llamado al método para modificar el estatus de la referencia (cotización/pedido/remisión)
		$this->set_estatus_referencia($objFacturaRefacciones->strTipoReferencia, 
									  $objFacturaRefacciones->intReferenciaID, 
									  'FACTURADO');

		//Si existe id de la clave de autorización, significa que se excedio del límite de crédito o el cliente tiene saldo vencido
		//en las facturas de maquinaria, refacciones y/o servicio
		if($objFacturaRefacciones->intClaveAutorizacionID > 0)
		{
			//Se crea una instancia de la clase modelo (claves de autorización) 
       	    $otdModelClavesAutorizacion = new  Claves_autorizacion_model();
       	    
       	    //Hacer un llamado al método para modificar el estatus de la clave de autorización
			$otdModelClavesAutorizacion->modificar($objFacturaRefacciones->intClaveAutorizacionID, 
										   	  	   'REFACCIONES', $objFacturaRefacciones->intFacturaRefaccionesID);

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
		return $this->db->trans_status().'_'.$objFacturaRefacciones->intFacturaRefaccionesID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objFacturaRefacciones)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

		//Concatenar hora, minutos y segundos
		$dteFecha = $objFacturaRefacciones->dteFecha.' '.date("H:i:s"); 
		
		//Tabla facturas_refacciones
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha,
						  'condiciones_pago' => $objFacturaRefacciones->strCondicionesPago,
						  'vencimiento' => $objFacturaRefacciones->dteVencimiento,
						  'moneda_id' => $objFacturaRefacciones->intMonedaID, 
						  'tipo_cambio' => $objFacturaRefacciones->intTipoCambio, 
						  'tipo_referencia' => $objFacturaRefacciones->strTipoReferencia, 
						  'referencia_id' => $objFacturaRefacciones->intReferenciaID,
						  'vendedor_id' => $objFacturaRefacciones->intVendedorID,
						  'estrategia_id' => $objFacturaRefacciones->intEstrategiaID,
						  'tipo' => $objFacturaRefacciones->strTipo,  
						  'prospecto_id' => $objFacturaRefacciones->intProspectoID, 
						  'razon_social' => $objFacturaRefacciones->strRazonSocial,
						  'rfc' => $objFacturaRefacciones->strRfc,
						  'regimen_fiscal_id' => $objFacturaRefacciones->intRegimenFiscalID,
						  'calle' => $objFacturaRefacciones->strCalle,
						  'numero_exterior' => $objFacturaRefacciones->strNumeroExterior,
						  'numero_interior' => $objFacturaRefacciones->strNumeroInterior,
						  'codigo_postal' => $objFacturaRefacciones->strCodigoPostal,
						  'colonia' => $objFacturaRefacciones->strColonia,
						  'localidad' => $objFacturaRefacciones->strLocalidad,
						  'municipio' => $objFacturaRefacciones->strMunicipio,
						  'estado' => $objFacturaRefacciones->strEstado,
						  'pais' => $objFacturaRefacciones->strPais,
						  'gastos_paqueteria' => $objFacturaRefacciones->intGastosPaqueteria,
						  'gastos_paqueteria_iva' => $objFacturaRefacciones->intGastosPaqueteriaIva,
						  'forma_pago_id' => $objFacturaRefacciones->intFormaPagoID,
						  'metodo_pago_id' => $objFacturaRefacciones->intMetodoPagoID,
						  'uso_cfdi_id' => $objFacturaRefacciones->intUsoCfdiID,
						  'tipo_relacion_id' => $objFacturaRefacciones->intTipoRelacionID,
						  'exportacion_id' => $objFacturaRefacciones->intExportacionID,
						  'observaciones' => $objFacturaRefacciones->strObservaciones, 
						  'notas' => $objFacturaRefacciones->strNotas, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objFacturaRefacciones->intUsuarioID);
		$this->db->where('factura_refacciones_id', $objFacturaRefacciones->intFacturaRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('facturas_refacciones', $arrDatos);

		 //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($objFacturaRefacciones->intFacturaRefaccionesID, $dteFecha);

		//Eliminar los detalles guardados
		$this->db->where('factura_refacciones_id', $objFacturaRefacciones->intFacturaRefaccionesID);
		$this->db->delete('facturas_refacciones_detalles');
		//Hacer un llamado al método para guardar los detalles de la factura
		$this->guardar_detalles($objFacturaRefacciones);


		//Hacer un llamado al método para guardar los CFDI relacionados de la factura
		$otdModelCfdiRelacionados->guardar($objFacturaRefacciones->intFacturaRefaccionesID, 
										   'FACTURA REFACCIONES', 
										   $objFacturaRefacciones->strCfdiRelacionado, 
										   $objFacturaRefacciones->strTiposRelacion);

		//Si existe id de la clave de autorización, significa que se excedio del límite de crédito o el cliente tiene saldo vencido
		//en las facturas de maquinaria, refacciones y/o servicio
		if($objFacturaRefacciones->intClaveAutorizacionID > 0)
		{
			//Se crea una instancia de la clase modelo (claves de autorización) 
       	    $otdModelClavesAutorizacion = new  Claves_autorizacion_model();
       	    
       	    //Hacer un llamado al método para modificar el estatus de la clave de autorización
			$otdModelClavesAutorizacion->modificar($objFacturaRefacciones->intClaveAutorizacionID, 
										   	  	   'REFACCIONES', $objFacturaRefacciones->intFacturaRefaccionesID);

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
		$this->db->where('factura_refacciones_id', $objTimbrado->intReferenciaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('facturas_refacciones', $arrDatos);
	}


	//Método para modificar el estatus de un registro a INACTIVO 
	public function set_cancelar(stdClass $objCancelacionCfdi)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (pólizas) 
        $otdModelPolizas = new Polizas_model();
        //Se crea una instancia de la clase modelo (cancelaciones) 
        $otdModelCancelaciones = new Cancelaciones_model();

		//Variable para seleccionar la fecha actual proveniente del Servidor
		$dteFechaActual = date("Y-m-d"); 

		//Función para modificar el inventario de refacciones agregando los detalles de la factura cancelada
		$this->modificar_historial_inventario_refacciones($objCancelacionCfdi->intReferenciaCfdiID, $dteFechaActual);

		//Modificar el estatus a INACTIVO de un registro de facturas de refacción
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
							  'fecha_eliminacion' => date("Y-m-d H:i:s"),
							  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('factura_refacciones_id', $objCancelacionCfdi->intReferenciaCfdiID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('facturas_refacciones', $arrDatos);

		//Hacer un llamado al método para modificar el estatus de la referencia(cotización/pedido/remisión)
		$this->set_estatus_referencia($objCancelacionCfdi->strTipoReferenciaReg, $objCancelacionCfdi->intReferenciaIDReg, 'ACTIVO');

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
	public function buscar($intFacturaRefaccionesID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL, 
						   $intReferenciaID = NULL, $strTipoReferencia = NULL)
	{

		$this->db->select("FR.factura_refacciones_id, FR.folio, FR.fecha, 
							DATE_FORMAT(FR.fecha,'%d/%m/%Y') AS fecha_format, 
							FR.condiciones_pago, FR.condiciones_pago AS CondicionesDePago,
							FR.vencimiento, FR.moneda_id,
							FR.tipo_cambio, FR.tipo_referencia, FR.referencia_id, 
						   	FR.vendedor_id, FR.estrategia_id, FR.tipo, 
						    FR.prospecto_id, FR.razon_social, FR.rfc, 
						    CASE 
							   WHEN  FR.regimen_fiscal_id > 0 
							   		THEN FR.regimen_fiscal_id		
							   ELSE IFNULL(C.regimen_fiscal_id,0)
						    END regimen_fiscal_id,
						    IFNULL(FR.regimen_fiscal_id,0) AS regimenFiscalAnterior,
						    FR.calle, FR.numero_exterior, 
						    FR.numero_interior, FR.codigo_postal, FR.colonia, FR.localidad, 
						    FR.municipio, FR.estado, FR.pais,FR.gastos_paqueteria,
						    FR.gastos_paqueteria_iva, FR.forma_pago_id, FR.metodo_pago_id, 
						    FR.uso_cfdi_id,  FR.tipo_relacion_id, FR.exportacion_id,
						    FR.observaciones, FR.notas,
						    FR.estatus, FR.certificado, FR.sello, FR.uuid,
						   	FR.fecha_timbrado, FR.certificado_sat, 	FR.sello_sat,
						   	FR.rfc_pac, FR.leyenda_sat,	FR.rfc_pac,
						    CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, 
						    M.codigo AS MonedaTipo, P.codigo AS CodigoProspecto, 
						    E.descripcion AS estrategia,  MP.codigo AS MetodoPago,
						    CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre) AS vendedor,
						    C.razon_social AS cliente, C.correo_electronico, C.contacto_correo_electronico, 
						    C.telefono_principal, C.refacciones_lista_precio_id, 
						    C.refacciones_credito_dias,
						    MP.codigo AS MetodoPago, 
						   	CONCAT_WS(' - ', MP.codigo, MP.descripcion) AS metodo_pago, 
						   	U.codigo AS UsoCFDI,
						   	CONCAT_WS(' - ', U.codigo, U.descripcion) AS uso_cfdi,
						   	FP.codigo AS FormaPago, 
						   	CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago,
						   	TR.codigo AS TipoRelacion,
						   	CONCAT_WS(' - ', TR.codigo, TR.descripcion) AS tipo_relacion, 
						   	_utf8'I' AS TipoDeComprobante,
						   	CONCAT_WS(' - ', TC.codigo, TC.descripcion) AS tipo_comprobante,
						   RF.codigo AS RegimenFiscal,
						   CONCAT_WS(' - ', RF.codigo, RF.descripcion) AS regimen_fiscal,
						   ECF.codigo AS CodigoExportacion,
						   CONCAT_WS(' - ', ECF.codigo, ECF.descripcion) AS exportacion,
						    CR.folio AS folio_cotizacion, 
						    PR.folio AS folio_pedido, 
						    RR.folio AS folio_remision,
						    IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza, 
						   	CASE 
							   WHEN  CR.cotizacion_refacciones_id > 0 
							   		THEN CONCAT_WS(' - ', CR.folio, FR.tipo_referencia) 
							   WHEN  PR.pedido_refacciones_id > 0 
							   		THEN CONCAT_WS(' - ', PR.folio, FR.tipo_referencia) 
							   WHEN  RR.remision_refacciones_id > 0 
							   		THEN CONCAT_WS(' - ', RR.folio, FR.tipo_referencia) 		
								    ELSE ''
						    END folio_referencia,
						    IFNULL(CA.clave_autorizacion_id, 0) AS clave_autorizacion_id", FALSE);
	    $this->db->from('facturas_refacciones AS FR');
	    $this->db->join('sat_monedas AS M', 'FR.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('estrategias AS E', 'FR.estrategia_id = E.estrategia_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'FR.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'FR.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'FR.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'FR.tipo_relacion_id = TR.tipo_relacion_id', 'left');
	    $this->db->join('vendedores AS V', 'FR.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
		$this->db->join('clientes AS C', 'FR.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('prospectos AS P', 'FR.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('municipios AS MC', 'C.municipio_id = MC.municipio_id', 'inner');
		$this->db->join('sat_estados AS EC', 'MC.estado_id = EC.estado_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'C.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('sat_tipos_comprobante AS TC', 'TC.codigo = "I"', 'left');
		$this->db->join('sat_exportacion AS ECF', 'FR.exportacion_id = ECF.exportacion_id', 'left');
		$this->db->join('cotizaciones_refacciones AS CR', 'FR.referencia_id = CR.cotizacion_refacciones_id 
						 AND FR.tipo_referencia = "COTIZACION"', 'left');
		$this->db->join('pedidos_refacciones AS PR', 'FR.referencia_id = PR.pedido_refacciones_id 
						 AND FR.tipo_referencia = "PEDIDO"', 'left');
		$this->db->join('remisiones_refacciones AS RR', 'FR.referencia_id = RR.remision_refacciones_id 
						 AND FR.tipo_referencia = "REMISION"', 'left');
		$this->db->join('sat_regimen_fiscal AS RF', 'FR.regimen_fiscal_id = RF.regimen_fiscal_id', 'left');
		$this->db->join('polizas AS PF', 'FR.factura_refacciones_id = PF.referencia_id AND
	    							      PF.modulo = "REFACCIONES" AND PF.proceso = "FACTURACION"', 'left');
		$this->db->join('claves_autorizacion AS CA', 'FR.factura_refacciones_id = CA.referencia_id AND
	    							     		      CA.referencia = "REFACCIONES"', 'left');


		//Si existe id de la factura
		if ($intFacturaRefaccionesID != NULL)
		{   
			$this->db->where('FR.factura_refacciones_id', $intFacturaRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if($intReferenciaID != NULL && $strTipoReferencia != NULL)//Si existe referencia de la factura
		{
			$this->db->where('FR.referencia_id', $intReferenciaID);
			$this->db->where('FR.tipo_referencia', $strTipoReferencia);
			$this->db->where("(FR.estatus = 'ACTIVO' OR FR.estatus = 'TIMBRAR')", NULL, FALSE);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('FR.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('FR.prospecto_id', $intProspectoID);
		    }
			//Si existe rango de fechas
		   	if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(FR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }
		    
		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(FR.estatus = 'TIMBRAR' OR FR.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('FR.estatus', $strEstatus);
				}
			}

			$this->db->where("((FR.folio LIKE '%$strBusqueda%') OR
		    				   (CONCAT_WS(' - ', FR.rfc, FR.razon_social) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', FR.rfc, FR.razon_social) LIKE '%$strBusqueda%') OR
	    				       (CONCAT_WS(' - ', FR.razon_social, FR.rfc) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', FR.razon_social, FR.rfc) LIKE '%$strBusqueda%') OR 
			                   (CONCAT_WS(' - ', CR.folio, FR.tipo_referencia) LIKE '%$strBusqueda%') OR 
			               	   (CONCAT_WS(' - ', PR.folio, FR.tipo_referencia) LIKE '%$strBusqueda%') OR 
			               	   (CONCAT_WS(' - ', RR.folio, FR.tipo_referencia) LIKE '%$strBusqueda%'))");

			$this->db->order_by('FR.fecha DESC, FR.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						                     $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('facturas_refacciones AS FR');
		$this->db->join('sat_monedas AS M', 'FR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('cotizaciones_refacciones AS CR', 'FR.referencia_id = CR.cotizacion_refacciones_id 
						 AND FR.tipo_referencia = "COTIZACION"', 'left');
		$this->db->join('pedidos_refacciones AS PR', 'FR.referencia_id = PR.pedido_refacciones_id 
						 AND FR.tipo_referencia = "PEDIDO"', 'left');
		$this->db->join('remisiones_refacciones AS RR', 'FR.referencia_id = RR.remision_refacciones_id 
						 AND FR.tipo_referencia = "REMISION"', 'left');
		$this->db->where('FR.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
	    if($intProspectoID > 0)
	    {
	   		$this->db->where('FR.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(FR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('FR.estatus', $strEstatus);
		}

	    $this->db->where("((FR.folio LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', FR.rfc, FR.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', FR.rfc, FR.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', FR.razon_social, FR.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', FR.razon_social, FR.rfc) LIKE '%$strBusqueda%') OR 
		                   (CONCAT_WS(' - ', CR.folio, FR.tipo_referencia) LIKE '%$strBusqueda%') OR 
		               	   (CONCAT_WS(' - ', PR.folio, FR.tipo_referencia) LIKE '%$strBusqueda%') OR 
		               	   (CONCAT_WS(' - ', RR.folio, FR.tipo_referencia) LIKE '%$strBusqueda%'))");

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar la fecha de la factura que coincide con el id proporcionado
	public function buscar_fecha_factura($intFacturaRefaccionesID)
	{
		$this->db->select("DATE_FORMAT(fecha,'%Y-%m-%d') AS fecha", FALSE);
		$this->db->from('facturas_refacciones');
		$this->db->where('factura_refacciones_id', $intFacturaRefaccionesID);
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	
	//Método para regresar la información de un posible gasto de paqueteria de un registro
	public function buscar_gastos_paqueteria($intFacturaRefaccionesID)
	{
		
		$this->db->select("FR.gastos_paqueteria, 
			               FR.gastos_paqueteria_iva, 
						   (SELECT MAX(FRD.renglon)
							FROM facturas_refacciones_detalles AS FRD
						    WHERE FRD.factura_refacciones_id = FR.factura_refacciones_id
						    ) + 1 AS renglon", FALSE);
		$this->db->from('facturas_refacciones AS FR');
		$this->db->where('FR.factura_refacciones_id', $intFacturaRefaccionesID);
		$this->db->where('FR.gastos_paqueteria > 0');
		$this->db->limit(1);
		return $this->db->get()->row();

	}


	//Método para regresar los datos de un registro (se utiliza para generar póliza)
	public function buscar_referencia_poliza($intReferenciaID, $strTipoReferencia)
	{

		//Constante para identificar al tipo de movimiento: facturación
		$intTipoServicioFacturacion = TIPO_SERVICIO_FACTURACION;
		//Constante para identificar al tipo de movimiento: salidas de refacciones por traspaso
		$intMovSalidaTraspaso = SALIDA_REFACCIONES_TRASPASO;
		//Constante para identificar al tipo de movimiento: salidas de refacciones por venta
		$intMovSalidaVenta = SALIDA_REFACCIONES_VENTA;
		//Constante para identificar al tipo de movimiento: salidas de refacciones por traspaso vehicular
		$intMovSalidaTraspasoVehicular = SALIDA_REFACCIONES_TRASPASO_VEHICULAR;
		
		
		//Dependiendo del tipo de referencia realizar consulta
		if($strTipoReferencia == 'FACTURA REFACCIONES')
		{
			
			//Facturas de refacciones
			$queryReferencia = "SELECT FR.factura_refacciones_id AS referencia_id, 
									   FR.sucursal_id, $intTipoServicioFacturacion AS tipo_movimiento, 
									   FR.folio, FR.fecha, FR.moneda_id, M.codigo AS Moneda, 
									   FR.estatus 
								FROM   facturas_refacciones AS FR 
								LEFT JOIN sat_monedas AS M ON FR.moneda_id = M.moneda_id 
								WHERE  FR.factura_refacciones_id = $intReferenciaID";
		}
		else //Movimientos de refacciones
		{
			//Movimientos de refacciones
			$queryReferencia = "SELECT MR.movimiento_refacciones_id AS referencia_id, 
									  MR.sucursal_id, MR.tipo_movimiento, 
									  MR.folio, MR.fecha, MR.moneda_id, 
									  M.codigo AS Moneda, MR.estatus
							    FROM  movimientos_refacciones AS MR 
							    LEFT JOIN sat_monedas AS M ON MR.moneda_id = M.moneda_id
		                        WHERE  MR.movimiento_refacciones_id = $intReferenciaID
								AND    MR.tipo_movimiento <> $intMovSalidaTraspaso
								AND    MR.tipo_movimiento <> $intMovSalidaVenta 
								AND    MR.tipo_movimiento <> $intMovSalidaTraspasoVehicular";
		}
	
		//Ejecutar consulta
		$strSQL = $this->db->query($queryReferencia);
		return $strSQL->row();
	}

	//Método para regresar los detalles de un registro (se utiliza para generar póliza)
	public function buscar_detalles_poliza($intReferenciaID, $intTipoMovimiento)
	{


		//Dependiendo del tipo de movimiento realizar búsqueda de datos
		if($intTipoMovimiento == ENTRADA_REFACCIONES_COMPRA)
		{

			//Entradas de refacciones por compra
			$queryDetalles ="SELECT MR.movimiento_refacciones_id AS referencia_id, P.codigo, 
									P.razon_social, P.tipo_proveedor, 
							   	    MR.factura, MR.remision, M.modulo_id,
							   	    M.descripcion AS Modulo,
								   SUM(MRD.cantidad * MRD.costo_unitario) AS Subtotal, 
								   SUM(MRD.cantidad * MRD.iva_unitario) AS IVA,
								   MRD.tasa_cuota_ieps, STC.valor_maximo AS TasaIEPS, 
								   SUM(MRD.cantidad * MRD.ieps_unitario) AS IEPS 
							FROM   movimientos_refacciones AS MR 
							INNER JOIN movimientos_refacciones_detalles AS MRD 
								   ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
					   	    INNER JOIN proveedores AS P ON MR.proveedor_id = P.proveedor_id
							INNER JOIN refacciones_lineas AS RL ON MRD.codigo_linea = RL.codigo
							INNER JOIN modulos AS M ON RL.modulo_id = M.modulo_id
						    LEFT JOIN sat_tasa_cuota AS STC ON MRD.tasa_cuota_ieps = STC.tasa_cuota_id
						    WHERE  MR.movimiento_refacciones_id = $intReferenciaID
							GROUP BY MR.movimiento_refacciones_id, MRD.tasa_cuota_ieps, M.descripcion
							ORDER BY MRD.tasa_cuota_ieps";
		}
		else if($intTipoMovimiento == ENTRADA_REFACCIONES_DEVOLUCION_FACTURA)
		{

			//Entradas de refacciones por devolución de factura
			$queryDetalles ="SELECT MR.movimiento_refacciones_id AS referencia_id, P.codigo, 
								   FR.razon_social, FR.condiciones_pago, 
								   M.modulo_id, M.descripcion AS Modulo, MRD.renglon, 
								   SUM(MRD.cantidad * MRD.precio_unitario) AS Subtotal,
								   FRD.tasa_cuota_iva, ROUND(SUM(MRD.cantidad * FRD.iva_unitario), 2) AS IVA, 
							       FRD.tasa_cuota_ieps, STC.valor_maximo AS TasaIEPS, 
							       ROUND(SUM(MRD.cantidad * FRD.ieps_unitario), 2) AS IEPS, 
								   SUM(MRD.cantidad * MRD.costo_unitario) AS Costo, MR.tipo_referencia 
						   FROM   movimientos_refacciones AS MR 
						   INNER JOIN movimientos_refacciones_detalles AS MRD 
								  ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
						   INNER JOIN facturas_refacciones AS FR ON MR.referencia_id = FR.factura_refacciones_id   AND MR.tipo_referencia = 'REFACCIONES' 
						   INNER JOIN facturas_refacciones_detalles AS FRD 
							     ON FR.factura_refacciones_id = FRD.factura_refacciones_id 
							     AND MRD.renglon = FRD.renglon
						   INNER JOIN prospectos AS P ON FR.prospecto_id = P.prospecto_id 
						   INNER JOIN refacciones_lineas AS RL ON FRD.codigo_linea = RL.codigo
						   INNER JOIN modulos AS M ON RL.modulo_id = M.modulo_id
						   LEFT JOIN sat_tasa_cuota AS STC ON FRD.tasa_cuota_ieps = STC.tasa_cuota_id
						   WHERE  MR.movimiento_refacciones_id = $intReferenciaID
							GROUP BY MR.movimiento_refacciones_id, MRD.renglon, FRD.tasa_cuota_iva, FRD.tasa_cuota_ieps, M.descripcion";
			$queryDetalles.=" UNION ";
			$queryDetalles.="SELECT MR.movimiento_refacciones_id AS referencia_id, P.codigo, FS.razon_social, 
								   FS.condiciones_pago, M.modulo_id, M.descripcion AS Modulo, 
								   MRD.renglon, SUM(MRD.cantidad * MRD.precio_unitario) AS Subtotal,
								   FSR.tasa_cuota_iva, ROUND(SUM(MRD.cantidad * FSR.iva_unitario), 2) AS IVA,
							   	   FSR.tasa_cuota_ieps, STC.valor_maximo AS TasaIEPS, 
							   	   ROUND(SUM(MRD.cantidad * FSR.ieps_unitario), 2) AS IEPS,
							   	   SUM(MRD.cantidad * MRD.costo_unitario) AS Costo, MR.tipo_referencia 
							FROM   movimientos_refacciones AS MR 
							INNER JOIN movimientos_refacciones_detalles AS MRD 
								   ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id 
							INNER JOIN facturas_servicio AS FS ON MR.referencia_id = FS.factura_servicio_id
							      AND MR.tipo_referencia = 'SERVICIO'
							INNER JOIN facturas_servicio_refacciones AS FSR ON FS.factura_servicio_id = FSR.factura_servicio_id 
							AND MRD.renglon = FSR.renglon
							INNER JOIN prospectos AS P ON FS.prospecto_id = P.prospecto_id
							INNER JOIN refacciones_lineas AS RL ON FSR.codigo_linea = RL.codigo
							INNER JOIN modulos AS M ON RL.modulo_id = M.modulo_id
							LEFT JOIN sat_tasa_cuota AS STC ON FSR.tasa_cuota_ieps = STC.tasa_cuota_id
							WHERE  MR.movimiento_refacciones_id = $intReferenciaID
							GROUP BY MR.movimiento_refacciones_id, MRD.renglon, FSR.tasa_cuota_iva, FSR.tasa_cuota_ieps, M.descripcion 
							ORDER BY renglon, tasa_cuota_iva, tasa_cuota_ieps";
		}
		else if ($intTipoMovimiento == ENTRADA_REFACCIONES_DEVOLUCION_TALLER)
		{
			//Entradas de refacciones por devolución de taller
			$queryDetalles ="SELECT MR.movimiento_refacciones_id AS referencia_id, O.folio AS OrdRep, 
									M.modulo_id, M.descripcion AS Modulo, 
								    SUM(MRD.cantidad * MRD.costo_unitario) AS Subtotal
							 FROM   movimientos_refacciones AS MR 
							 INNER JOIN movimientos_refacciones_detalles AS MRD
							       ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id 
							 INNER JOIN refacciones_lineas AS RL ON MRD.codigo_linea = RL.codigo 
							 INNER JOIN modulos AS M ON RL.modulo_id = M.modulo_id 
							 INNER JOIN movimientos_refacciones AS MR2 
							       ON MR.referencia_id = MR2.movimiento_refacciones_id 
							 INNER JOIN requisiciones_refacciones AS RR 
							       ON MR2.referencia_id = RR.requisicion_refacciones_id 
							 INNER JOIN ordenes_reparacion AS O ON RR.orden_reparacion_id = O.orden_reparacion_id
							 WHERE  MR.movimiento_refacciones_id = $intReferenciaID
							 GROUP BY MR.movimiento_refacciones_id, M.descripcion
							 ORDER BY Modulo";
		}
		else if ($intTipoMovimiento == ENTRADA_REFACCIONES_TRASPASO)
		{
			//Entradas de refacciones por traspaso
			$queryDetalles ="SELECT MR.movimiento_refacciones_id AS referencia_id, 
									MR.sucursal_id AS DestinoID, S.nombre AS Destino, 
								   	MR2.sucursal_id AS OrigenID, S2.nombre AS Origen, 
								   	M.modulo_id, M.descripcion AS Modulo,
						   			SUM(MRD.cantidad * MRD.costo_unitario) AS Subtotal 
							FROM   movimientos_refacciones AS MR 
							INNER JOIN movimientos_refacciones_detalles AS MRD 
								  ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
							INNER JOIN refacciones_lineas AS RL ON MRD.codigo_linea = RL.codigo 
							INNER JOIN modulos AS M ON RL.modulo_id = M.modulo_id
							INNER JOIN sucursales AS S ON MR.sucursal_id = S.sucursal_id
							INNER JOIN movimientos_refacciones AS MR2 
								  ON MR.referencia_id = MR2.movimiento_refacciones_id
							INNER JOIN sucursales AS S2 ON MR2.sucursal_id = S2.sucursal_id
							WHERE  MR.movimiento_refacciones_id = $intReferenciaID
							GROUP BY MR.movimiento_refacciones_id, M.descripcion
							ORDER BY Modulo";
		}
		else if ($intTipoMovimiento == ENTRADA_REFACCIONES_AJUSTE)
		{
			//Entradas de refacciones por ajuste
			$queryDetalles ="SELECT MR.movimiento_refacciones_id AS referencia_id, 
									MR.observaciones, M.modulo_id, M.descripcion AS Modulo, 
								    SUM(MRD.cantidad * MRD.costo_unitario) AS Subtotal
							FROM   movimientos_refacciones AS MR 
							INNER JOIN movimientos_refacciones_detalles AS MRD 
								 ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
							INNER JOIN refacciones_lineas AS RL ON MRD.codigo_linea = RL.codigo
							INNER JOIN modulos AS M ON RL.modulo_id = M.modulo_id
							WHERE  MR.movimiento_refacciones_id = $intReferenciaID
							GROUP BY MR.movimiento_refacciones_id, M.descripcion
							ORDER BY Modulo";
		}
		else if ($intTipoMovimiento == SALIDA_REFACCIONES_TALLER)
		{
			//Salidas de refacciones por taller
			$queryDetalles ="SELECT MR.movimiento_refacciones_id AS referencia_id, O.folio AS OrdRep,
							 		M.modulo_id, M.descripcion AS Modulo, 
							 		SUM(MRD.cantidad * MRD.costo_unitario) AS Subtotal
							 FROM   movimientos_refacciones AS MR 
							 INNER JOIN movimientos_refacciones_detalles AS MRD 
								   ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
							 INNER JOIN refacciones_lineas AS RL ON MRD.codigo_linea = RL.codigo
							 INNER JOIN modulos AS M ON RL.modulo_id = M.modulo_id
							 INNER JOIN requisiciones_refacciones AS RR ON MR.referencia_id = RR.requisicion_refacciones_id
							 INNER JOIN ordenes_reparacion AS O ON RR.orden_reparacion_id = O.orden_reparacion_id
							 WHERE  MR.movimiento_refacciones_id = $intReferenciaID
							 GROUP BY MR.movimiento_refacciones_id, M.descripcion
							 ORDER BY Modulo";
		}
		else if ($intTipoMovimiento == SALIDA_REFACCIONES_CONSUMO_INTERNO)
		{
			//Salidas de refacciones por consumo interno
			$queryDetalles ="SELECT MR.movimiento_refacciones_id, MR.observaciones, M.modulo_id, 
									M.descripcion AS Modulo, MRD.renglon, MRDG.sucursal_id, 
									MRDG.modulo_id, GT.tipo_gasto, 
								    GT.descripcion AS Gasto, GT.prefijo, 
						      		(MRD.cantidad * MRD.costo_unitario) AS Subtotal,
						      		S.nombre AS sucursal, MDGS.descripcion AS ModuloTipoGasto
							 FROM   movimientos_refacciones AS MR 
							 INNER JOIN movimientos_refacciones_detalles AS MRD 
							       ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id 
							 INNER JOIN movimientos_refacciones_detalles_gastos AS MRDG
								   ON MRD.movimiento_refacciones_id = MRDG.movimiento_refacciones_id 
								   AND MRD.renglon = MRDG.renglon
							 INNER JOIN gastos_tipos AS GT ON MRDG.gasto_tipo_id = GT.gasto_tipo_id 
							 INNER JOIN refacciones_lineas AS RL ON MRD.codigo_linea = RL.codigo
							 INNER JOIN modulos AS M ON RL.modulo_id = M.modulo_id
							 LEFT JOIN modulos AS MDGS ON MRDG.modulo_id = MDGS.modulo_id 
							 LEFT JOIN sucursales AS S ON MRDG.sucursal_id = S.sucursal_id
							 WHERE  MR.movimiento_refacciones_id = $intReferenciaID
							 ORDER BY MRD.renglon, Modulo";
		}
		else if ($intTipoMovimiento == SALIDA_REFACCIONES_DEVOLUCION_PROVEEDOR)
		{
			//Falla la consulta Salidas de refacciones por devolución al proveedor
			$queryDetalles ="SELECT MR.movimiento_refacciones_id AS referencia_id, 
									P.codigo, P.razon_social, P.tipo_proveedor,
							   		MR2.factura, MR2.remision, 
							   		M.modulo_id, M.descripcion AS Modulo, 
								    SUM(MRD.cantidad * MRD.costo_unitario) AS Subtotal, 
								    SUM(MRD.cantidad * MRD2.iva_unitario) AS IVA, 
								    MRD.tasa_cuota_ieps, STC.valor_maximo AS TasaIEPS,
									SUM(MRD.cantidad * MRD2.ieps_unitario) AS IEPS
							FROM   movimientos_refacciones AS MR 
							INNER JOIN movimientos_refacciones_detalles AS MRD
								   ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
							INNER JOIN movimientos_refacciones AS MR2 
							  	   ON MR.referencia_id = MR2.movimiento_refacciones_id
							INNER JOIN movimientos_refacciones_detalles AS MRD2
								   ON MR2.movimiento_refacciones_id = MRD2.movimiento_refacciones_id
							   	   AND MRD.renglon = MRD2.renglon
						    INNER JOIN proveedores AS P ON MR2.proveedor_id = P.proveedor_id
							INNER JOIN refacciones_lineas AS RL ON MRD.codigo_linea = RL.codigo
							INNER JOIN modulos AS M ON RL.modulo_id = M.modulo_id
							LEFT JOIN sat_tasa_cuota AS STC ON MRD2.tasa_cuota_ieps = STC.tasa_cuota_id
							WHERE  MR.movimiento_refacciones_id = $intReferenciaID
							GROUP BY MR.movimiento_refacciones_id, MRD.tasa_cuota_ieps, 
									 MRD.tasa_cuota_iva, M.descripcion, STC.valor_maximo
							ORDER BY MRD.tasa_cuota_iva, MRD.tasa_cuota_ieps";
		}
		else if ($intTipoMovimiento == SALIDA_REFACCIONES_AJUSTE)
		{
			//Salidas de refacciones por ajuste
			$queryDetalles = "SELECT MR.movimiento_refacciones_id AS referencia_id, MR.observaciones, 
									 M.modulo_id, M.descripcion AS Modulo,
								   	 SUM(MRD.cantidad * MRD.costo_unitario) AS Subtotal
							  FROM   movimientos_refacciones AS MR 
							  INNER JOIN movimientos_refacciones_detalles AS MRD 
								    ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id 
							  INNER JOIN refacciones_lineas AS RL ON MRD.codigo_linea = RL.codigo 
							  INNER JOIN modulos AS M ON RL.modulo_id = M.modulo_id 
							  WHERE  MR.movimiento_refacciones_id = $intReferenciaID
							  GROUP BY MR.movimiento_refacciones_id, M.descripcion 
							  ORDER BY Modulo";
		}
		else if ($intTipoMovimiento == TIPO_SERVICIO_FACTURACION)
		{
			//Facturas de refacciones
			$queryDetalles ="SELECT FR.factura_refacciones_id AS referencia_id, P.codigo, FR.razon_social, 
									FR.condiciones_pago, M.modulo_id, M.descripcion AS Modulo, 
								    FR.gastos_paqueteria, FR.gastos_paqueteria_iva, 
								    FRD.renglon, SUM(FRD.cantidad * FRD.precio_unitario) AS Subtotal,
								    FRD.tasa_cuota_iva, ROUND(SUM(FRD.cantidad * FRD.iva_unitario), 2) AS IVA, 
									FRD.tasa_cuota_ieps, STC.valor_maximo AS TasaIEPS,
									ROUND(SUM(FRD.cantidad * FRD.ieps_unitario), 2) AS IEPS, 
								    SUM(FRD.cantidad * FRD.costo_unitario) AS Costo 
							FROM   facturas_refacciones AS FR
							INNER JOIN facturas_refacciones_detalles AS FRD
								   ON FR.factura_refacciones_id = FRD.factura_refacciones_id
							INNER JOIN prospectos AS P ON FR.prospecto_id = P.prospecto_id
							INNER JOIN refacciones_lineas AS RL ON FRD.codigo_linea = RL.codigo
							INNER JOIN modulos AS M ON RL.modulo_id = M.modulo_id
							LEFT JOIN sat_tasa_cuota AS STC ON FRD.tasa_cuota_ieps = STC.tasa_cuota_id
							WHERE  FR.factura_refacciones_id = $intReferenciaID
							GROUP BY FR.factura_refacciones_id, FRD.renglon, FRD.tasa_cuota_iva, 
									 FRD.tasa_cuota_ieps, M.descripcion
							ORDER BY FRD.renglon, FRD.tasa_cuota_iva, FRD.tasa_cuota_ieps";
		}

		//Ejecutar consulta
		$strSQL = $this->db->query($queryDetalles);
		return $strSQL->result();

	}


	//Método para regresar la información de un movimiento fiscal que será cancelado
	public function buscar_movimiento_fiscal($intFacturaRefaccionesID)
	{
		$strSQL = $this->db->query("SELECT E.rfc AS RFC, 
										NOW() AS Fecha, 
										FR.uuid, 
										FR.folio 
									FROM facturas_refacciones AS FR
									INNER JOIN sucursales AS S ON S.sucursal_id = FR.sucursal_id   
									INNER JOIN empresas E ON E.empresa_id = S.empresa_id
									WHERE FR.factura_refacciones_id = $intFacturaRefaccionesID");
		return $strSQL->result();
	}


	/*Método para regresar las devoluciones de una sucursal*/
	public function buscar_devoluciones_sucursal($dteFechaInicial, $dteFechaFinal, $intSucursalID)
	{
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución de la factura
		$intMovDevRef = ENTRADA_REFACCIONES_DEVOLUCION_FACTURA;
		
		//Devoluciones de las facturas de refacciones
		$queryDevoluciones = "SELECT FR.factura_refacciones_id, FRD.renglon, 
									(MRD.cantidad * MRD.precio_unitario) AS Subtotal, 
				       				(MRD.cantidad * FRD.iva_unitario) AS IVA, (MRD.cantidad * FRD.ieps_unitario) AS IEPS 
							FROM   ((movimientos_refacciones MR INNER JOIN movimientos_refacciones_detalles MRD 
							         ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id) INNER JOIN 
							         facturas_refacciones FR ON MR.tipo_movimiento = $intMovDevRef AND MR.referencia_id = FR.factura_refacciones_id) 
							         INNER JOIN facturas_refacciones_detalles FRD ON FR.factura_refacciones_id = FRD.factura_refacciones_id 
							         AND MRD.renglon = FRD.renglon 
							WHERE  DATE_FORMAT(MR.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
							AND    DATE_FORMAT(MR.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
							AND    MR.estatus <> 'INACTIVO' 
							AND    MR.sucursal_id = $intSucursalID 
							AND    FR.condiciones_pago = 'CREDITO' 
							AND    FRD.iva_unitario > 0 
							AND    (FRD.codigo_linea <> 'SE' AND 
							        FRD.codigo_linea <> 'AG' AND 
							        FRD.codigo_linea <> 'GP' AND 
							        FRD.codigo_linea <> 'RI' AND 
							        FRD.codigo_linea <> 'PA')";
		$queryDevoluciones .= " UNION "; 
		$queryDevoluciones .= "SELECT FR.factura_refacciones_id, FRD.renglon, 
								   (MRD.cantidad * MRD.precio_unitario) AS Subtotal, 
				       			   (MRD.cantidad * FRD.iva_unitario) AS IVA, (MRD.cantidad * FRD.ieps_unitario) AS IEPS 
							FROM   ((movimientos_refacciones MR INNER JOIN movimientos_refacciones_detalles MRD 
							         ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id) INNER JOIN 
							         facturas_refacciones FR ON MR.tipo_movimiento = $intMovDevRef AND MR.referencia_id = FR.factura_refacciones_id) 
							         INNER JOIN facturas_refacciones_detalles FRD ON FR.factura_refacciones_id = FRD.factura_refacciones_id 
							         AND MRD.renglon = FRD.renglon 
							WHERE  DATE_FORMAT(MR.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
							AND    DATE_FORMAT(MR.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
							AND    MR.estatus <> 'INACTIVO' 
							AND    MR.sucursal_id = $intSucursalID 
							AND    FR.condiciones_pago = 'CREDITO' 
							AND    FRD.iva_unitario = 0 
							AND    (FRD.codigo_linea <> 'SE' AND 
							        FRD.codigo_linea <> 'AG' AND 
							        FRD.codigo_linea <> 'GP' AND 
							        FRD.codigo_linea <> 'RI' AND 
							        FRD.codigo_linea <> 'PA') ";

		$strSQL = $this->db->query($queryDevoluciones);
		return $strSQL->result();
	}

	/*Método para regresar los descuentos aplicados de una sucursal*/
	public function buscar_descuentos_sucursal($dteFechaInicial, $dteFechaFinal, $intSucursalID)
	{
		//Devoluciones de las facturas de refacciones
		$queryDescuentos = "SELECT FR.condiciones_pago, NCDD.renglon, NCDD.precio, NCDD.iva, NCDD.ieps 
							FROM   (notas_credito_digitales NCD INNER JOIN notas_credito_digitales_detalles NCDD 
									ON NCD.nota_credito_digital_id = NCDD.nota_credito_digital_id) INNER JOIN facturas_refacciones FR 
									ON NCDD.referencia = 'REFACCIONES' AND NCDD.referencia_id = FR.factura_refacciones_id 
							WHERE  DATE_FORMAT(NCD.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
							AND    DATE_FORMAT(NCD.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
							AND    NCD.sucursal_id = $intSucursalID 
							AND    NCD.estatus <> 'INACTIVO'";

		$strSQL = $this->db->query($queryDescuentos);
		return $strSQL->result();
	}

	/*Método para regresar las refacciones de una sucursal facturadas por taller*/
	public function buscar_refacciones_taller($dteFechaInicial, $dteFechaFinal, $intSucursalID)
	{

		//Refacciones facturadas por taller
		$queryRefaccionesTall = "SELECT PDR.pago_id AS ID, PDR.renglon, FS.factura_servicio_id, 
									   IFNULL(Refacciones.Subtotal, 0) AS ImporteRefacciones, 
									   (IFNULL((FS.gastos_servicio + FS.gastos_servicio_iva), 0) + 
										IFNULL(ManoObra.Importe, 0) + IFNULL(Otros.Importe, 0) + 
										IFNULL(Refacciones.Importe, 0) + IFNULL(Foraneos.Importe, 0) - 
										(IFNULL((SELECT SUM(PDR01.imp_pagado) 
												 FROM   pagos P01 INNER JOIN pagos_detalles_relacionados_02 PDR01 ON P01.pago_id = PDR01.pago_id 
												 WHERE  PDR01.tipo_referencia = 'SERVICIO' 
												 AND    PDR01.referencia_id = FS.factura_servicio_id 
												 AND    DATE_FORMAT(P01.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
												 AND    P01.estatus <> 'INACTIVO'), 0))) AS Saldo 
								FROM   pagos P INNER JOIN pagos_detalles_relacionados_02 PDR ON P.pago_id = PDR.pago_id 
									   INNER JOIN facturas_servicio FS ON PDR.tipo_referencia = 'SERVICIO' AND PDR.referencia_id = FS.factura_servicio_id 
									   LEFT JOIN (SELECT factura_servicio_id, SUM(precio_unitario + iva_unitario + ieps_unitario) AS Importe, 
														 SUM(precio_unitario) AS Subtotal 
												  FROM   facturas_servicio_mano_obra 
												  GROUP BY factura_servicio_id) AS ManoObra ON FS.factura_servicio_id = ManoObra.factura_servicio_id 
									   LEFT JOIN (SELECT factura_servicio_id, SUM((precio_unitario + iva_unitario + ieps_unitario) * cantidad) AS Importe 
												  FROM   facturas_servicio_otros 
												  GROUP BY factura_servicio_id) AS Otros ON FS.factura_servicio_id = Otros.factura_servicio_id 
									   LEFT JOIN (SELECT factura_servicio_id, SUM((precio_unitario + iva_unitario + ieps_unitario) * cantidad) AS Importe, 
														 SUM(precio_unitario * cantidad) AS Subtotal 
												  FROM   facturas_servicio_refacciones 
												  GROUP BY factura_servicio_id) AS Refacciones ON FS.factura_servicio_id = Refacciones.factura_servicio_id 
									   LEFT JOIN (SELECT factura_servicio_id, SUM((precio_unitario + iva_unitario + ieps_unitario) * cantidad) AS Importe 
												  FROM   facturas_servicio_trabajos_foraneos 
												  GROUP BY factura_servicio_id) AS Foraneos ON FS.factura_servicio_id = Foraneos.factura_servicio_id 
								WHERE  DATE_FORMAT(P.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
								AND    DATE_FORMAT(P.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
								AND    P.sucursal_id = $intSucursalID 
								AND    P.estatus <> 'INACTIVO' 
								GROUP BY P.pago_id , PDR.renglon, FS.factura_servicio_id";

	    $queryRefaccionesTall .= " UNION "; 						
		$queryRefaccionesTall .= "SELECT CONCAT('F', FS.factura_servicio_id) AS ID, 1 AS renglon, 
										FS.factura_servicio_id, 
									   IFNULL(Refacciones.Subtotal, 0) AS ImporteRefacciones, 0 AS Saldo 
								  FROM   facturas_servicio FS 
										   LEFT JOIN (SELECT factura_servicio_id, SUM(precio_unitario + iva_unitario + ieps_unitario) AS Importe, 
															 SUM(precio_unitario) AS Subtotal 
													  FROM   facturas_servicio_mano_obra 
													  GROUP BY factura_servicio_id) AS ManoObra ON FS.factura_servicio_id = ManoObra.factura_servicio_id 
										   LEFT JOIN (SELECT factura_servicio_id, SUM((precio_unitario + iva_unitario + ieps_unitario) * cantidad) AS Importe, 
															 SUM(precio_unitario * cantidad) AS Subtotal 
													  FROM   facturas_servicio_refacciones 
													  GROUP BY factura_servicio_id) AS Refacciones ON FS.factura_servicio_id = Refacciones.factura_servicio_id 
								   WHERE  DATE_FORMAT(FS.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
								   AND    DATE_FORMAT(FS.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
								   AND    FS.sucursal_id = $intSucursalID 
								   AND    FS.estatus <> 'INACTIVO' 
								   AND    FS.condiciones_pago = 'CONTADO' 
								   GROUP BY FS.factura_servicio_id 
								   ORDER BY ID, renglon";

		$strSQL = $this->db->query($queryRefaccionesTall);
		return $strSQL->result();
	}


	/*Método para regresar las ventas (de contado) de un vendedor*/
	public function buscar_ventas_contado_vendedor($dteFechaInicial, $dteFechaFinal, $intVendedorID)
	{
		//Ventas
		$queryVentas = "SELECT FR.factura_refacciones_id, FRD.renglon, 
							   SUM(FRD.cantidad * FRD.precio_unitario) AS Subtotal, 
			       			   SUM(FRD.cantidad * FRD.iva_unitario) AS IVA, 
			       			   SUM(FRD.cantidad * FRD.ieps_unitario) AS IEPS 
						FROM   facturas_refacciones FR INNER JOIN facturas_refacciones_detalles FRD 
						       ON FR.factura_refacciones_id = FRD.factura_refacciones_id 
						WHERE  FR.vendedor_id = $intVendedorID 
						AND    DATE_FORMAT(FR.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
						AND    DATE_FORMAT(FR.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
						AND    FR.estatus <> 'INACTIVO' 
						AND    FR.condiciones_pago = 'CONTADO' 
						AND    FRD.iva_unitario > 0 
						AND    (FRD.codigo_linea <> 'SE' AND 
						        FRD.codigo_linea <> 'AG' AND 
						        FRD.codigo_linea <> 'GP' AND 
						        FRD.codigo_linea <> 'RI' AND 
						        FRD.codigo_linea <> 'PA') 
						GROUP BY FR.factura_refacciones_id, FRD.renglon";
		$queryVentas .= " UNION ";
		$queryVentas .= "SELECT FR.factura_refacciones_id, FRD.renglon, 
							   SUM(FRD.cantidad * FRD.precio_unitario) AS Subtotal, 
						       SUM(FRD.cantidad * FRD.iva_unitario) AS IVA, 
						       SUM(FRD.cantidad * FRD.ieps_unitario) AS IEPS 
						FROM   facturas_refacciones FR INNER JOIN facturas_refacciones_detalles FRD 
						       ON FR.factura_refacciones_id = FRD.factura_refacciones_id 
						WHERE  FR.vendedor_id = $intVendedorID 
						AND    DATE_FORMAT(FR.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
						AND    DATE_FORMAT(FR.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
						AND    FR.estatus <> 'INACTIVO' 
						AND    FR.condiciones_pago = 'CONTADO' 
						AND    FRD.iva_unitario = 0 
						AND    (FRD.codigo_linea <> 'SE' AND 
						        FRD.codigo_linea <> 'AG' AND 
						        FRD.codigo_linea <> 'GP' AND 
						        FRD.codigo_linea <> 'RI' AND 
						        FRD.codigo_linea <> 'PA') 
						GROUP BY FR.factura_refacciones_id, FRD.renglon";

	    $strSQL = $this->db->query($queryVentas);
		return $strSQL->result();
	}


	/*Método para regresar los abonos recuperados de un vendedor*/
	public function buscar_abonos_vendedor($dteFechaInicial, $dteFechaFinal, $intVendedorID)
	{

		//Abonos
		$queryAbonos = "SELECT P.pago_id AS ID, PDR.renglon, FR.fecha, PDR.imp_pagado AS Abono, 
							   SUM(FRD.cantidad * FRD.iva_unitario) AS IVA 
						FROM   ((pagos P INNER JOIN pagos_detalles_relacionados_02 PDR ON P.pago_id = PDR.pago_id) INNER JOIN 
						         facturas_refacciones FR ON PDR.tipo_referencia = 'REFACCIONES' 
						         AND PDR.referencia_id = FR.factura_refacciones_id) INNER JOIN facturas_refacciones_detalles FRD 
						         ON FR.factura_refacciones_id = FRD.factura_refacciones_id 
						WHERE  FR.vendedor_id = $intVendedorID 
						AND    FR.condiciones_pago = 'CREDITO' 
						AND    DATE_FORMAT(P.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
						AND    DATE_FORMAT(P.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
						AND    P.estatus <> 'INACTIVO' 
						GROUP BY PDR.pago_id, PDR.renglon, FR.fecha, PDR.imp_pagado";
		$queryAbonos .= " UNION ";
		$queryAbonos .= "SELECT P.pago_id AS ID, PDR.renglon, C.fecha, PDR.imp_pagado AS Abono, 
							   ((C.importe/1.16) * 0.16) AS IVA 
						FROM   (pagos P INNER JOIN pagos_detalles_relacionados_02 PDR ON P.pago_id = PDR.pago_id) INNER JOIN 
						        cartera C ON PDR.tipo_referencia = 'CARTERA' AND PDR.referencia_id = C.cartera_id 
						        AND C.modulo = 'REFACCIONES' 
						WHERE  C.vendedor_id = $intVendedorID 
						AND    DATE_FORMAT(P.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
						AND    DATE_FORMAT(P.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
						AND    P.estatus <> 'INACTIVO' 
						GROUP BY PDR.pago_id , PDR.renglon, C.fecha, PDR.imp_pagado, C.importe"; 
		$queryAbonos .= " UNION ";
		$queryAbonos .= "SELECT RID.recibo_ingreso_id AS ID, RID.renglon, FR.fecha, 
							   (RID.precio + RID.iva + RID.ieps) AS Abono, 
						       SUM(FRD.cantidad * FRD.iva_unitario) AS IVA 
						FROM   ((recibos_ingreso RI INNER JOIN recibos_ingreso_detalles RID ON RI.recibo_ingreso_id = RID.recibo_ingreso_id) 
						         INNER JOIN facturas_refacciones FR ON RID.referencia = 'REFACCIONES' 
						         AND RID.referencia_id = FR.factura_refacciones_id) INNER JOIN facturas_refacciones_detalles FRD 
						         ON FR.factura_refacciones_id = FRD.factura_refacciones_id 
						WHERE  FR.vendedor_id = $intVendedorID 
						AND    FR.condiciones_pago = 'CREDITO' 
						AND    DATE_FORMAT(RI.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
						AND    DATE_FORMAT(RI.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
						AND    RI.estatus <> 'INACTIVO' 
						GROUP BY RID.recibo_ingreso_id, RID.renglon, FR.fecha";
		$queryAbonos .= " UNION ";
		$queryAbonos .= "SELECT PAD.poliza_abono_id AS ID, PAD.renglon, FR.fecha, 
							   (PAD.precio + PAD.iva + PAD.ieps) AS Abono, 
						       SUM(FRD.cantidad * FRD.iva_unitario) AS IVA 
						FROM   ((polizas_abono_02 PA INNER JOIN polizas_abono_detalles_02 PAD ON PA.poliza_abono_id = PAD.poliza_abono_id) 
						         INNER JOIN facturas_refacciones FR ON PAD.referencia = 'REFACCIONES' 
						         AND PAD.referencia_id = FR.factura_refacciones_id) INNER JOIN facturas_refacciones_detalles FRD 
						         ON FR.factura_refacciones_id = FRD.factura_refacciones_id 
						WHERE  FR.vendedor_id = $intVendedorID 
						AND    FR.condiciones_pago = 'CREDITO' 
						AND    DATE_FORMAT(PA.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
						AND    DATE_FORMAT(PA.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
						AND    PA.estatus <> 'INACTIVO' 
						GROUP BY PAD.poliza_abono_id, PAD.renglon, FR.factura_refacciones_id
						ORDER BY ID, renglon";

		$strSQL = $this->db->query($queryAbonos);
		return $strSQL->result();

	}


	/*Método para regresar las devoluciones de una vendedor*/
	public function buscar_devoluciones_vendedor($dteFechaInicial, $dteFechaFinal, $intVendedorID)
	{
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución de la factura
		$intMovDevRef = ENTRADA_REFACCIONES_DEVOLUCION_FACTURA;
		
		//Devoluciones de las facturas de refacciones
		$queryDevoluciones = "SELECT FR.factura_refacciones_id, FRD.renglon, 
									 (MRD.cantidad * MRD.precio_unitario) AS Subtotal, 
			       					 (MRD.cantidad * FRD.iva_unitario) AS IVA, 
			       					 (MRD.cantidad * FRD.ieps_unitario) AS IEPS 
							FROM   ((movimientos_refacciones MR INNER JOIN movimientos_refacciones_detalles MRD 
							         ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id) INNER JOIN 
							         facturas_refacciones FR ON MR.tipo_movimiento = $intMovDevRef AND MR.referencia_id = FR.factura_refacciones_id) 
							         INNER JOIN facturas_refacciones_detalles FRD ON FR.factura_refacciones_id = FRD.factura_refacciones_id 
							         AND MRD.renglon = FRD.renglon 
							WHERE  FR.vendedor_id = $intVendedorID 
							AND    DATE_FORMAT(MR.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
							AND    DATE_FORMAT(MR.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
							AND    MR.estatus <> 'INACTIVO' 
							AND    FR.condiciones_pago = 'CONTADO' 
							AND    FRD.iva_unitario > 0 
							AND    (FRD.codigo_linea <> 'SE' AND 
							        FRD.codigo_linea <> 'AG' AND 
							        FRD.codigo_linea <> 'GP' AND 
							        FRD.codigo_linea <> 'RI' AND 
							        FRD.codigo_linea <> 'PA')";
	    $queryDevoluciones .= " UNION ";
		$queryDevoluciones .= "SELECT FR.factura_refacciones_id, FRD.renglon, 
								   (MRD.cantidad * MRD.precio_unitario) AS Subtotal, 
							       (MRD.cantidad * FRD.iva_unitario) AS IVA, 
							       (MRD.cantidad * FRD.ieps_unitario) AS IEPS 
							    FROM   ((movimientos_refacciones MR INNER JOIN movimientos_refacciones_detalles MRD 
								         ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id) INNER JOIN 
								         facturas_refacciones FR ON MR.tipo_movimiento = $intMovDevRef AND MR.referencia_id = FR.factura_refacciones_id) 
								         INNER JOIN facturas_refacciones_detalles FRD ON FR.factura_refacciones_id = FRD.factura_refacciones_id 
								         AND MRD.renglon = FRD.renglon 
								WHERE  FR.vendedor_id = $intVendedorID 
								AND    DATE_FORMAT(MR.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
								AND    DATE_FORMAT(MR.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
								AND    MR.estatus <> 'INACTIVO' 
								AND    FR.condiciones_pago = 'CONTADO' 
								AND    FRD.iva_unitario = 0 
								AND    (FRD.codigo_linea <> 'SE' AND 
								        FRD.codigo_linea <> 'AG' AND 
								        FRD.codigo_linea <> 'GP' AND 
								        FRD.codigo_linea <> 'RI' AND 
								        FRD.codigo_linea <> 'PA')";

		$strSQL = $this->db->query($queryDevoluciones);
		return $strSQL->result();
	}


	/*Método para regresar las comisiones de agricultura inteligente que coincidan con los criterios de 
	 búsqueda proporcionados*/
	public function buscar_comisiones_agricultura($dteFechaInicial, $dteFechaFinal)
	{

		//Comisiones de servicios
		$queryComisiones = "SELECT FR.factura_refacciones_id, S.nombre AS Sucursal, 
						    	   E.codigo AS CodVen, 
								   CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) AS Vendedor, 
								   FR.folio, DATE_FORMAT(FR.fecha,'%d/%m/%Y') AS fecha, 
								   Tmp.Subtotal, Tmp.IVA, Tmp.IEPS, 
								   ((Tmp.Subtotal + Tmp.IVA + Tmp.IEPS) + 
									(IFNULL((SELECT SUM(NCD.precio + NCD.iva + NCD.ieps) 
											 FROM   notas_cargo NC INNER JOIN notas_cargo_detalles NCD ON NC.nota_cargo_id = NCD.nota_cargo_id 
											 WHERE  NCD.referencia = 'REFACCIONES' 
											 AND    NCD.referencia_id = FR.factura_refacciones_id 
											 AND    NC.estatus <> 'INACTIVO'), 0)) + 
									(IFNULL((SELECT SUM(NCDD.precio + NCDD.iva + NCDD.ieps) 
											 FROM   notas_cargo_digitales NCD INNER JOIN notas_cargo_digitales_detalles NCDD 
													ON NCD.nota_cargo_digital_id = NCDD.nota_cargo_digital_id 
											 WHERE  NCDD.referencia = 'REFACCIONES' 
											 AND    NCDD.referencia_id = FR.factura_refacciones_id 
											 AND    NCD.estatus <> 'INACTIVO'), 0))) AS Precio, 
								   ((IFNULL((SELECT SUM(PDR.imp_pagado) 
											 FROM   pagos P INNER JOIN pagos_detalles_relacionados_02 PDR ON PDR.pago_id = P.pago_id 
											 WHERE  PDR.tipo_referencia = 'REFACCIONES' 
											 AND    PDR.referencia_id = FR.factura_refacciones_id 
											 AND    DATE_FORMAT(P.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
											 AND    P.estatus <> 'INACTIVO'), 0)) + 
									(IFNULL((SELECT SUM(PAD.precio + PAD.iva + PAD.ieps) 
											 FROM   polizas_abono_02 PA INNER JOIN polizas_abono_detalles_02 PAD ON PA.poliza_abono_id = PAD.poliza_abono_id 
											 WHERE  PAD.referencia = 'REFACCIONES' 
											 AND    PAD.referencia_id = FR.factura_refacciones_id 
											 AND    DATE_FORMAT(PA.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
											 AND    PA.estatus <> 'INACTIVO'), 0)) + 
									(IFNULL((SELECT SUM(RID.precio + RID.iva + RID.ieps) 
											 FROM   recibos_ingreso RI INNER JOIN recibos_ingreso_detalles RID 
													ON RI.recibo_ingreso_id = RID.recibo_ingreso_id 
											 WHERE  RID.referencia = 'REFACCIONES' 
											 AND    RID.referencia_id = FR.factura_refacciones_id 
											 AND    DATE_FORMAT(RI.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
											 AND    RI.estatus <> 'INACTIVO'), 0)) + 
									(IFNULL((SELECT SUM(NCDD.precio + NCDD.iva + NCDD.ieps) 
											 FROM   notas_credito_digitales NCD INNER JOIN notas_credito_digitales_detalles NCDD 
													ON NCD.nota_credito_digital_id = NCDD.nota_credito_digital_id 
											 WHERE  NCDD.referencia = 'REFACCIONES' 
											 AND    NCDD.referencia_id = FR.factura_refacciones_id 
											 AND    DATE_FORMAT(NCD.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
											 AND    NCD.estatus <> 'INACTIVO'), 0))) AS AbonoTotal, 
								   ((IFNULL((SELECT SUM(PDR.imp_pagado) 
											 FROM   pagos P INNER JOIN pagos_detalles_relacionados_02 PDR ON PDR.pago_id = P.pago_id 
											 WHERE  PDR.tipo_referencia = 'REFACCIONES' 
											 AND    PDR.referencia_id = FR.factura_refacciones_id 
											 AND    DATE_FORMAT(P.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
											 AND    DATE_FORMAT(P.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
											 AND    P.estatus <> 'INACTIVO'), 0)) + 
									(IFNULL((SELECT SUM(PAD.precio + PAD.iva + PAD.ieps) 
											 FROM   polizas_abono_02 PA INNER JOIN polizas_abono_detalles_02 PAD ON PA.poliza_abono_id = PAD.poliza_abono_id 
											 WHERE  PAD.referencia = 'REFACCIONES' 
											 AND    PAD.referencia_id = FR.factura_refacciones_id 
											 AND    DATE_FORMAT(PA.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
											 AND    DATE_FORMAT(PA.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
											 AND    PA.estatus <> 'INACTIVO'), 0)) + 
									(IFNULL((SELECT SUM(RID.precio + RID.iva + RID.ieps) 
											 FROM   recibos_ingreso RI INNER JOIN recibos_ingreso_detalles RID 
													ON RI.recibo_ingreso_id = RID.recibo_ingreso_id 
											 WHERE  RID.referencia = 'REFACCIONES' 
											 AND    RID.referencia_id = FR.factura_refacciones_id 
											 AND    DATE_FORMAT(RI.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
											 AND    DATE_FORMAT(RI.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
											 AND    RI.estatus <> 'INACTIVO'), 0)) + 
									(IFNULL((SELECT SUM(NCDD.precio + NCDD.iva + NCDD.ieps) 
											 FROM   notas_credito_digitales NCD INNER JOIN notas_credito_digitales_detalles NCDD 
													ON NCD.nota_credito_digital_id = NCDD.nota_credito_digital_id 
											 WHERE  NCDD.referencia = 'REFACCIONES' 
											 AND    NCDD.referencia_id = FR.factura_refacciones_id 
											 AND    DATE_FORMAT(NCD.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
											 AND    DATE_FORMAT(NCD.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
											 AND    NCD.estatus <> 'INACTIVO'), 0))) AS AbonoParcial, 
								   FR.condiciones_pago, FR.razon_social, FRD.renglon, FRD.codigo_linea, FRD.codigo, FRD.descripcion, 
								   FRD.cantidad, FRD.precio_unitario, FRD.costo_unitario 
							FROM   facturas_refacciones FR INNER JOIN facturas_refacciones_detalles AS FRD 
								   ON FR.factura_refacciones_id = FRD.factura_refacciones_id 
								   INNER JOIN sucursales AS S ON FR.sucursal_id = S.sucursal_id 
								   INNER JOIN vendedores AS V ON FR.vendedor_id = V.vendedor_id 
								   INNER JOIN empleados AS E ON V.empleado_id = E.empleado_id 
								   INNER JOIN (SELECT FR02.factura_refacciones_id, SUM(FRD02.cantidad * FRD02.precio_unitario) AS Subtotal, 
													  SUM(FRD02.cantidad * FRD02.iva_unitario) AS IVA, SUM(FRD02.cantidad * FRD02.ieps_unitario) AS IEPS 
											   FROM   facturas_refacciones FR02 INNER JOIN facturas_refacciones_detalles AS FRD02 
													  ON FR02.factura_refacciones_id = FRD02.factura_refacciones_id 
											   GROUP BY FR02.factura_refacciones_id) AS Tmp ON FR.factura_refacciones_id = Tmp.factura_refacciones_id 
							WHERE  DATE_FORMAT(FR.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
							AND    FR.estatus <> 'INACTIVO' 
							AND    (FRD.codigo_linea = 'SE' OR 
									FRD.codigo_linea = 'AG' OR 
									FRD.codigo_linea = 'GP' OR 
									FRD.codigo_linea = 'RI' OR 
									FRD.codigo_linea = 'PA') 
							ORDER BY CodVen, FR.folio, FRD.renglon";

		$strSQL = $this->db->query($queryComisiones);
		return $strSQL->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL,
		                   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoRefCFDI = $this->db->escape('FACTURA REFACCIONES');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('FR.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('FR.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(FR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(FR.estatus = 'TIMBRAR' OR FR.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('FR.estatus', $strEstatus);
			}
		}

		$this->db->where("((FR.folio LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', FR.rfc, FR.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', FR.rfc, FR.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', FR.razon_social, FR.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', FR.razon_social, FR.rfc) LIKE '%$strBusqueda%') OR 
		                   (CONCAT_WS(' - ', CR.folio, FR.tipo_referencia) LIKE '%$strBusqueda%') OR 
		               	   (CONCAT_WS(' - ', PR.folio, FR.tipo_referencia) LIKE '%$strBusqueda%') OR 
		               	   (CONCAT_WS(' - ', RR.folio, FR.tipo_referencia) LIKE '%$strBusqueda%'))");

	    $this->db->from('facturas_refacciones AS FR');
	    $this->db->join('sat_monedas AS M', 'FR.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('estrategias AS E', 'FR.estrategia_id = E.estrategia_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'FR.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'FR.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'FR.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('vendedores AS V', 'FR.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
		$this->db->join('clientes AS C', 'FR.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('municipios AS MC', 'C.municipio_id = MC.municipio_id', 'inner');
		$this->db->join('sat_estados AS EC', 'MC.estado_id = EC.estado_id', 'inner');
		$this->db->join('cotizaciones_refacciones AS CR', 'FR.referencia_id = CR.cotizacion_refacciones_id 
						 AND FR.tipo_referencia = "COTIZACION"', 'left');
		$this->db->join('pedidos_refacciones AS PR', 'FR.referencia_id = PR.pedido_refacciones_id 
						 AND FR.tipo_referencia = "PEDIDO"', 'left');
		$this->db->join('remisiones_refacciones AS RR', 'FR.referencia_id = RR.remision_refacciones_id 
						 AND FR.tipo_referencia = "REMISION"', 'left');
		$this->db->join('polizas AS PF', 'FR.factura_refacciones_id = PF.referencia_id AND
	    							      PF.modulo = "REFACCIONES" AND PF.proceso = "FACTURACION"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("FR.factura_refacciones_id, 
							FR.folio, 
							DATE_FORMAT(FR.fecha,'%d/%m/%Y') AS fecha,
							FR.tipo_referencia, FR.referencia_id,
							FR.rfc, FR.razon_social, 
							IFNULL(FR.regimen_fiscal_id,0) AS regimen_fiscal_id, 
							CASE 
							   WHEN  CR.cotizacion_refacciones_id > 0 
							   		THEN CONCAT_WS(' - ', CR.folio, FR.tipo_referencia) 
							   WHEN  PR.pedido_refacciones_id > 0 
							   		THEN CONCAT_WS(' - ', PR.folio, FR.tipo_referencia) 
							   WHEN  RR.remision_refacciones_id > 0 
							   		THEN CONCAT_WS(' - ', RR.folio, FR.tipo_referencia) 		
								    ELSE ''
						    END folio_referencia, 
						   	FR.estatus, FR.uuid,
						   	IFNULL(PF.poliza_id, 0) AS poliza_id, 
						    PF.folio AS folio_poliza, 
						    IFNULL(CCFDI.cancelacion_id, 0) AS cancelacion_id", FALSE);
	    $this->db->from('facturas_refacciones AS FR');
	    $this->db->join('sat_monedas AS M', 'FR.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('estrategias AS E', 'FR.estrategia_id = E.estrategia_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'FR.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'FR.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'FR.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('vendedores AS V', 'FR.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
		$this->db->join('clientes AS C', 'FR.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('municipios AS MC', 'C.municipio_id = MC.municipio_id', 'inner');
		$this->db->join('sat_estados AS EC', 'MC.estado_id = EC.estado_id', 'inner');
		$this->db->join('cotizaciones_refacciones AS CR', 'FR.referencia_id = CR.cotizacion_refacciones_id 
						 AND FR.tipo_referencia = "COTIZACION"', 'left');
		$this->db->join('pedidos_refacciones AS PR', 'FR.referencia_id = PR.pedido_refacciones_id 
						 AND FR.tipo_referencia = "PEDIDO"', 'left');
		$this->db->join('remisiones_refacciones AS RR', 'FR.referencia_id = RR.remision_refacciones_id 
						 AND FR.tipo_referencia = "REMISION"', 'left');
		$this->db->join('polizas AS PF', 'FR.factura_refacciones_id = PF.referencia_id AND
	    							      PF.modulo = "REFACCIONES" AND PF.proceso = "FACTURACION"', 'left');

		$this->db->join('cancelaciones AS CCFDI', 'CCFDI.tipo_referencia = '.$strTipoRefCFDI.' 
	    							        	  AND CCFDI.referencia_id = FR.factura_refacciones_id', 'left');
		

		$this->db->where('FR.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('FR.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(FR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(FR.estatus = 'TIMBRAR' OR FR.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('FR.estatus', $strEstatus);
			}
		}
		$this->db->where("((FR.folio LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', FR.rfc, FR.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', FR.rfc, FR.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', FR.razon_social, FR.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', FR.razon_social, FR.rfc) LIKE '%$strBusqueda%') OR 
		                   (CONCAT_WS(' - ', CR.folio, FR.tipo_referencia) LIKE '%$strBusqueda%') OR 
		               	   (CONCAT_WS(' - ', PR.folio, FR.tipo_referencia) LIKE '%$strBusqueda%') OR 
		               	   (CONCAT_WS(' - ', RR.folio, FR.tipo_referencia) LIKE '%$strBusqueda%'))");

		$this->db->order_by('FR.fecha DESC, FR.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["facturas"] =$this->db->get()->result();
		return $arrResultado;
	}



	/*Método para regresar las facturas que coincidan con los criterios de búsqueda proporcionados 
	 (se utiliza en el reporte de facturación)*/
	public function buscar_facturas($dteFechaInicial, $dteFechaFinal, $intProspectoID = NULL,  
									$intMonedaID = NULL, $strSucursales = NULL, 
									$strTipos = NULL, $strTipoReporte = NULL)
	{

		//Prospecto
		$strRestriccionesProspecto = '';
		//Moneda
		$strRestriccionesMoneda = '';
		//ID´s de las sucursales
		$strRestriccionesSucursales = '';
		//ID´s de los tipos: Mostrador, Refaccionario, Campo, etc.
		$strRestriccionesTipos = '';
		//Variable que se utiliza para ordenar los registros dependiendo del tipo de búsqueda
		$strOrdenamiento = " ORDER BY ";

		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			$strRestriccionesProspecto .= " AND FR.prospecto_id = $intProspectoID";
		}

		 //Si existe id de la moneda
		if($intMonedaID > 0)
		{
			$strRestriccionesMoneda .= " AND FR.moneda_id = $intMonedaID";
			$strOrdenamiento .= " FR.moneda_id,";
		}


		//Si existen sucursales seleccionadas
		if($strSucursales)
		{
			//Generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
			$strRestriccionesSucursales .= " AND FR.sucursal_id IN (";

		    //Quitar | de la lista para obtener el id de la sucursal
			$arrSucursales = explode("|", $strSucursales);

			//Hacer recorrido para formar restricción con los ID's de las sucursales
			for ($intCon = 0; $intCon < sizeof($arrSucursales); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otra sucursal)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesSucursales .= " , ";
				}

				//Concatenar id de la sucursal 
				$strRestriccionesSucursales .= $arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}


		//Si existen tipos seleccionados
		if($strTipos)
		{	


			//Generar las condiciones dinamicas de las consultas respecto a la columna tipo
			$strRestriccionesTipos .= " AND  FR.tipo IN (";

		    //Quitar | de la lista para obtener el tipo
			$arrTipos = explode("|", $strTipos);

			//Hacer recorrido para formar restricción con  los tipos
			for ($intCon = 0; $intCon < sizeof($arrTipos); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otro tipo)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesTipos .= " , ";
				}

				//Concatenar tipo
				$strRestriccionesTipos .= "'".$arrTipos[$intCon]."'";
			}

			$strRestriccionesTipos .= ")";


		}


		//Dependiendo del tipo de reporte ordenar los datos
		if($strTipoReporte == 'SEPARADO_TIPO')
		{
			$strOrdenamiento .= " FR.tipo,";
		}
		else if($strTipoReporte == 'SEPARADO_CONDICIONES_PAGO')
		{
			$strOrdenamiento .= " FR.condiciones_pago,";
		}
		
		
		$strOrdenamiento .= " FR.fecha, FR.folio";
		

		//Facturas de refacciones
		$queryFacturas = "SELECT FR.factura_refacciones_id,
								 FR.folio, FR.moneda_id, FR.tipo_cambio, FR.gastos_paqueteria,
								 FR.gastos_paqueteria_iva, FR.estatus,
								 DATE_FORMAT(FR.fecha, '%d/%m/%Y') AS fecha, 
								 C.razon_social,
								 M.codigo AS MonedaTipo,
								 FR.tipo, FR.condiciones_pago, 
								 S.nombre AS sucursal,
								 (FR.gastos_paqueteria + 
					         	  ROUND(((SELECT SUM(ROUND((FRD.precio_unitario * FRD.cantidad), 2))
									      FROM   facturas_refacciones_detalles AS FRD
									      WHERE  FRD.factura_refacciones_id = FR.factura_refacciones_id)/FR.tipo_cambio), 2)) AS subtotal,
								(FR.gastos_paqueteria_iva + 
									ROUND(((SELECT SUM(ROUND((FRD.iva_unitario * FRD.cantidad), 2))
						                    FROM facturas_refacciones_detalles AS FRD
						                    WHERE FRD.factura_refacciones_id = FR.factura_refacciones_id) / FR.tipo_cambio),2)) AS iva,

								IFNULL(ROUND(((SELECT SUM(ROUND((FRD.ieps_unitario * FRD.cantidad), 2))
										      FROM   facturas_refacciones_detalles AS FRD
										     WHERE  FRD.factura_refacciones_id = FR.factura_refacciones_id)/FR.tipo_cambio), 2), 0) AS ieps,
								(FR.gastos_paqueteria +
								 FR.gastos_paqueteria_iva + 
					        	 ROUND(((SELECT SUM(ROUND((FRD.precio_unitario * FRD.cantidad), 2) +
											        ROUND((FRD.iva_unitario * FRD.cantidad), 2) +
											        ROUND((FRD.ieps_unitario * FRD.cantidad), 2))
									 FROM   facturas_refacciones_detalles AS FRD
									 WHERE  FRD.factura_refacciones_id = FR.factura_refacciones_id)/FR.tipo_cambio), 2)) AS importe

						  FROM facturas_refacciones AS FR
						  INNER JOIN clientes C ON C.prospecto_id = FR.prospecto_id
						  INNER JOIN prospectos AS PP ON C.prospecto_id = PP.prospecto_id
						  INNER JOIN sat_monedas AS M ON FR.moneda_id = M.moneda_id
						  INNER JOIN sucursales AS S ON FR.sucursal_id = S.sucursal_id
					   WHERE  DATE_FORMAT(FR.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'
					   $strRestriccionesSucursales 
					   $strRestriccionesTipos
					   $strRestriccionesMoneda
					   $strRestriccionesProspecto
					   $strOrdenamiento";


	    $strSQL = $this->db->query($queryFacturas);
		return $strSQL->result();

	}



	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strFormulario, $intReferenciaID)
	{
		$this->db->select('factura_refacciones_id, folio, uuid');
        $this->db->from('facturas_refacciones');
        $this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
        //Si el formulario corresponde a una cancelación de timbrado
        if($strFormulario == 'cancelacion')
        {
        	$this->db->where('factura_refacciones_id <>', $intReferenciaID);
        }
     	$this->db->where('estatus', 'ACTIVO');
        $this->db->where("(folio LIKE '%$strDescripcion%')");
        $this->db->order_by('folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla facturas_refacciones_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la factura
	public function guardar_detalles(stdClass $objFacturaRefacciones)
	{
		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objFacturaRefacciones->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el ID de la refacción, código, descripción, 
		  código SAT, unidad SAT, cantidad, precio unitario, descuento unitario, iva unitario e ieps unitario
		*/
		$arrRefaccionID = explode("|", $objFacturaRefacciones->strRefaccionID);
		$arrCodigos = explode("|", $objFacturaRefacciones->strCodigos);
		$arrDescripciones = explode("|", $objFacturaRefacciones->strDescripciones);
		$arrCodigosLineas = explode("|", $objFacturaRefacciones->strCodigosLineas);
		$arrCodigosSat = explode("|", $objFacturaRefacciones->strCodigosSat);
		$arrUnidadesSat = explode("|", $objFacturaRefacciones->strUnidadesSat);
		$arrObjetoImpuestoSat = explode("|", $objFacturaRefacciones->strObjetoImpuestoSat);
		$arrCantidades = explode("|", $objFacturaRefacciones->strCantidades);
		$arrPreciosUnitarios = explode("|", $objFacturaRefacciones->strPreciosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objFacturaRefacciones->strDescuentosUnitarios);
		$arrTasaCuotaIva = explode("|", $objFacturaRefacciones->strTasaCuotaIva);
		$arrIvasUnitarios = explode("|", $objFacturaRefacciones->strIvasUnitarios);
		$arrTasaCuotaIeps = explode("|", $objFacturaRefacciones->strTasaCuotaIeps);
		$arrIepsUnitarios = explode("|", $objFacturaRefacciones->strIepsUnitarios);
		$arrCostosUnitarios = explode("|", $objFacturaRefacciones->strCostosUnitarios);
		
		
		//Hacer recorrido para insertar los datos en la tabla facturas_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];

			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = ( ($arrTasaCuotaIeps[$intCon] !== '') ? $arrTasaCuotaIeps[$intCon] : NULL);

			//Asignar datos al array
			$arrDatos = array('factura_refacciones_id' => $objFacturaRefacciones->intFacturaRefaccionesID,
							  'renglon' => ($intCon + 1),
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon],
							  'descripcion' => $arrDescripciones[$intCon],
							  'codigo_linea' => $arrCodigosLineas[$intCon],
							  'codigo_sat' => $arrCodigosSat[$intCon],
							  'unidad_sat' => $arrUnidadesSat[$intCon],
							  'objeto_impuesto_sat' => $arrObjetoImpuestoSat[$intCon],
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $arrCostosUnitarios[$intCon], 
							  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
							  'iva_unitario' => $arrIvasUnitarios[$intCon],
							  'ieps_unitario' => $arrIepsUnitarios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'precio_unitario' => $arrPreciosUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('facturas_refacciones_detalles', $arrDatos);

			//Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $intRefaccionID, $intCantidad);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intFacturaRefaccionesID)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');

		$this->db->select("	FRD.refaccion_id, 
							FRD.codigo, 
							FRD.descripcion,
							FRD.codigo_linea, 
							FRD.codigo_sat, 
							FRD.unidad_sat, 
							FRD.objeto_impuesto_sat, 
						   	FRD.cantidad, 
						   	FRD.precio_unitario,
						   	FRD.descuento_unitario,
						   	FRD.tasa_cuota_iva,
						   	FRD.iva_unitario, 
						   	FRD.tasa_cuota_ieps, 
						   	FRD.ieps_unitario, 
						   	FRD.costo_unitario, 
						   	RI.localizacion,
						   	TIva.valor_maximo AS porcentaje_iva, 
						    TIeps.valor_maximo AS porcentaje_ieps,
						   	IFNULL(RI.actual_costo, 0) AS actual_costo,
						   	IFNULL(RI.disponible_existencia, 0) AS disponible_existencia,
						   	CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
						   	RM.descripcion AS refacciones_marca", FALSE);
		$this->db->from('facturas_refacciones_detalles AS FRD');
		$this->db->join('refacciones AS R', 'FRD.refaccion_id = R.refaccion_id', 'inner');
	    $this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
	    $this->db->join('refacciones_lineas AS RL', 'FRD.codigo_linea = RL.codigo', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'FRD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'FRD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('refacciones_inventario AS RI', 'FRD.refaccion_id = RI.refaccion_id AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(NOW())', 'left');
		$this->db->where('FRD.factura_refacciones_id', $intFacturaRefaccionesID);
		$this->db->order_by('FRD.renglon', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_xml($intFacturaRefaccionesID)
	{
		
		//Variable que se utilizan para agregar union del detalle (fijo) gastos de paqueteria
		$strUnionGastosPaqueteria = '';

		//Seleccionar los gatos de paqueteria de la factura
		$otdGastosPaqueteria = $this->buscar_gastos_paqueteria($intFacturaRefaccionesID);

		//Si la factura cuenta con gastos de paqueteria
		if($otdGastosPaqueteria)
		{	
			//Constantes para identificar los datos del SAT correspondientes al gasto de paquetería
       		$strClaveProductoServ = CLAVE_PRODUCTO_SAT_GASTOS_PAQUETERIA;
       		$strClaveUnidad = CLAVE_UNIDAD_SAT_GASTOS_PAQUETERIA;
       		$strUnidad = UNIDAD_SAT_GASTOS_PAQUETERIA;
       		$strClaveObjetoImpuesto = CLAVE_OBJETOIMP_SAT_GASTOS_PAQUETERIA;
       		$strConceptoObjetoImpuesto = CONCEPTO_OBJETOIMP_SAT_GASTOS_PAQUETERIA;
       		$strDescripcion = DESCRIPCION_SAT_GASTOS_PAQUETERIA;
       		$strConcepto = CONCEPTO_SAT_GASTOS_PAQUETERIA;
       		$strDescuento = DESCUENTO_GASTOS_PAQUETERIA;
       		$strIeps = IEPS_GASTOS_PAQUETERIA;
       		$strPorcentajeIva = PORCENTAJE_IVA_GASTOS_PAQUETERIA;
       		$strFactorIva = FACTOR_IVA_GASTOS_PAQUETERIA;
       		$strImpuestoIva = IMPUESTO_IVA_GASTOS_PAQUETERIA;

			//Variable que se utiliza para asignar el último renglón de los detalles
			$intUltimoRenglon = $otdGastosPaqueteria->renglon;
			//Variable que se utiliza para asignar el gasto de paqueteria
			$intGastosPaqueteria = $otdGastosPaqueteria->gastos_paqueteria;
			//Variable que se utiliza para asignar el iva del gasto de paqueteria
			$intGastosPaqueteriaIva = $otdGastosPaqueteria->gastos_paqueteria_iva;
			
			//Detalle del gasto de paqueteria
			$strUnionGastosPaqueteria = "UNION
										SELECT	'' AS ID, 
											$intUltimoRenglon AS renglon,  
											'$strClaveProductoServ' AS ClaveProdServ,
											_utf8'' AS NoIdentificacion, 
											'1.00' AS cantidad,
											'$strClaveUnidad' AS ClaveUnidad, 
											'$strUnidad' AS Unidad,
											'$strClaveObjetoImpuesto' AS ClaveObjetoImpuesto,
											'' AS Codigo,
											'' AS localizacion,
											'$strDescripcion' AS Descripcion,
											'$strConcepto' AS concepto,									
											'$intGastosPaqueteria' AS subtotal, 
											'$strDescuento' AS descuento, 
											'$intGastosPaqueteriaIva' AS iva, 
											'$strIeps' AS ieps,
											_utf8'' AS Pedimento, 
											'$strPorcentajeIva' AS PorcentajeIva, 
											'$strFactorIva' AS FactorIva,  
											'$strImpuestoIva' AS ImpuestoIva,  
											NULL AS PorcentajeIeps,
											NULL AS FactorIeps, 
											NULL AS ImpuestoIeps,
											'$strConceptoObjetoImpuesto' AS objeto_impuesto";

		}//Cierre de verificación de gastos de servicio
 
		$strSQL = $this->db->query("
							SELECT
								R.refaccion_id AS ID, 
								FRD.renglon AS renglon,  
							    FRD.codigo_sat AS ClaveProdServ,
								_utf8'' AS NoIdentificacion, 
								FRD.cantidad AS cantidad,
							    FRD.unidad_sat AS ClaveUnidad, 
							    SU.nombre AS Unidad,
							    FRD.objeto_impuesto_sat AS ClaveObjetoImpuesto, 
							    R.codigo_01 AS Codigo,
							    RI.localizacion,
							    FRD.descripcion AS Descripcion,
							    FRD.descripcion AS concepto,									
								(FRD.precio_unitario) AS subtotal, 
								(FRD.descuento_unitario) AS descuento, 
								(FRD.iva_unitario) AS iva, 
								(FRD.ieps_unitario) AS ieps,
								_utf8'' AS Pedimento, 
								TIva.valor_maximo AS PorcentajeIva, 
								TIva.factor AS FactorIva,  
								IIva.codigo AS ImpuestoIva,  
								TIeps.valor_maximo AS PorcentajeIeps,
								TIeps.factor AS FactorIeps, 
								IIeps.codigo AS ImpuestoIeps,
								CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto
							FROM facturas_refacciones_detalles FRD
							INNER JOIN facturas_refacciones AS FR ON FR.factura_refacciones_id = FRD.factura_refacciones_id   
							INNER JOIN refacciones R ON R.refaccion_id = FRD.refaccion_id
							INNER JOIN refacciones_inventario RI ON RI.sucursal_id = FR.sucursal_id AND RI.refaccion_id = FRD.refaccion_id AND RI.anio = YEAR(FR.fecha)
							INNER JOIN sat_productos_servicios SPS ON SPS.producto_servicio_id = R.producto_servicio_id
							LEFT JOIN sat_unidades AS SU ON SU.codigo = FRD.unidad_sat
							LEFT JOIN  sat_tasa_cuota AS TIva ON R.tasa_cuota_iva = TIva.tasa_cuota_id
							LEFT JOIN  sat_impuestos AS IIva ON TIva.impuesto_id = IIva.impuesto_id								
							LEFT JOIN  sat_tasa_cuota AS TIeps ON R.tasa_cuota_ieps = TIeps.tasa_cuota_id	
							LEFT JOIN  sat_impuestos AS IIeps ON TIeps.impuesto_id = IIeps.impuesto_id
							LEFT JOIN sat_objeto_impuesto AS OImp ON FRD.objeto_impuesto_sat = OImp.codigo
							WHERE FR.factura_refacciones_id = $intFacturaRefaccionesID
							$strUnionGastosPaqueteria");
		
		return $strSQL->result();
	}


	/*******************************************************************************************************************
	Funciones de la tabla refacciones_inventario
	*********************************************************************************************************************/
	//Función que se utiliza para modificar el inventario de una refacción del movimiento 
	public function modificar_inventario_refacciones($strAnio, $intRefaccionID, $intCantidad)
	{
		//Actualizar existencia de la refacción en inventario
		//Seleccionar los datos de inventario de la refacción
		$otdInventario = $this->buscar_inventario_refaccion($intRefaccionID, $strAnio);
		//Asignar datos a las variables
		$intExistenciaActual = $otdInventario->actual_existencia;
		$intExistenciaDisponible = $otdInventario->disponible_existencia;
		
		//Decrementar existencia actual
		$intExistenciaActual -= $intCantidad;
		//Decrementar existencia disponible
		$intExistenciaDisponible -= $intCantidad;

		/*************************************************************************************
		* Actualizar datos del inventario por cada registro 
		* de la tabla refacciones_inventario		
		**************************************************************************************/
		$arrInventario = array('actual_existencia' => $intExistenciaActual, 
							   'disponible_existencia' => $intExistenciaDisponible);
		$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('anio', $strAnio);
		$this->db->where('refaccion_id', $intRefaccionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('refacciones_inventario', $arrInventario);

	}

	//Función que se utiliza para modificar el historial de refacciones en el inventario
	public function modificar_historial_inventario_refacciones($intFacturaRefaccionesID, $dteFecha)
	{
		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $dteFecha);
		$strAnio = $strFecha[0];

		//Seleccionar los detalles de la factura
		$arrDetalles = $this->buscar_detalles($intFacturaRefaccionesID);

	    //Hacer recorrido para actualizar los datos del inventario
	    for($intCon = 0; $intCon < sizeof($arrDetalles); $intCon++) 
		{
			//Asignar id de la refacción interna
			$intRefaccionID = $arrDetalles[$intCon]->refaccion_id;
			//Seleccionar los datos de inventario de la refacción
			$otdInventario = $this->buscar_inventario_refaccion($intRefaccionID, $strAnio);
			//Asignar datos a las variables
			$intExistenciaActual = (float)$otdInventario->actual_existencia;
			$intExistenciaDisponible = (float)$otdInventario->disponible_existencia;

			//Incrementar existencia actual
	        $intExistenciaActual += (float)$arrDetalles[$intCon]->cantidad;
	        //Incrementar existencia disponible
	        $intExistenciaDisponible += (float)$arrDetalles[$intCon]->cantidad;

	        //----------------------------------------------------------------------------------------------------
			// Actualizar datos del inventario por cada registro 
			// de la tabla refacciones_inventario		
			//----------------------------------------------------------------------------------------------------
			$arrInventario = array('actual_existencia' => $intExistenciaActual, 'disponible_existencia' => $intExistenciaDisponible);
			$this->db->where('sucursal_id',  $this->session->userdata('sucursal_id'));
			$this->db->where('anio', $strAnio);
			$this->db->where('refaccion_id', $intRefaccionID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('refacciones_inventario', $arrInventario);
		}
		

	}

	//Método para regresar los datos de inventario que coinciden con los criterios de búsqueda proporcionados
	public function buscar_inventario_refaccion($intRefaccionID, $strAnio)
	{
		$this->db->select('inicial_existencia, inicial_costo, actual_existencia, disponible_existencia, actual_costo');
		$this->db->from('refacciones_inventario');
		$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('anio', $strAnio);
		$this->db->where('refaccion_id', $intRefaccionID);
		$this->db->limit(1);
		return $this->db->get()->row();
	}


	/*******************************************************************************************************************
	Funciones de las tablas: cotizaciones_refacciones, pedidos_refacciones y remisiones_refacciones
	*********************************************************************************************************************/
	//Método para modificar el estatus de una referencia (cotización/pedido/remisión)
	public function set_estatus_referencia($strTipoReferencia, $intReferenciaID, $strEstatus)
	{
		//Verificar si existe id de la referencia
		if($intReferenciaID > 0)
		{
			//Dependiendo del tipo de referencia modificar el estatus
			if($strTipoReferencia == 'COTIZACION')
			{
				//Se crea una instancia de la clase modelo (cotizaciones de refacciones) 
       		    $otdModelReferencia = new  Cotizaciones_refacciones_model();



			}
			else if($strTipoReferencia == 'PEDIDO')
			{
				
				//Se crea una instancia de la clase modelo (pedidos de refacciones) 
       		    $otdModelReferencia = new  Pedidos_refacciones_model();
			}
			else //Remisión
			{
				//Se crea una instancia de la clase modelo (remisiones de refacciones) 
       		    $otdModelReferencia = new  Remisiones_refacciones_model();

			}


			//Hacer un llamado al método para modificar el estatus de la referencia
			$otdModelReferencia->set_estatus($intReferenciaID, $strEstatus);

		}//Cierre de verificación de la referencia
	}
}
?>