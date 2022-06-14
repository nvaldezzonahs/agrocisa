<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de CFDI relacionados (para guardar los CFDI relacionados del registro)
include_once(APPPATH . 'models/caja/Cfdi_relacionados_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');
//Incluir la clase modelo de ordenes de reparación (para modificar el estatus del registro)
include_once(APPPATH . 'models/servicio/Ordenes_reparacion_model.php');
//Incluir la clase modelo de cancelaciones (para guardar la cancelación del timbrado (CFDI))
include_once(APPPATH . 'models/contabilidad/Cancelaciones_model.php');
//Incluir la clase modelo de clientes (para modificar el régimen fiscal del anticipo seleccionado)
include_once(APPPATH . 'models/cuentas_cobrar/Clientes_model.php');

class Notas_credito_servicio_model extends CI_model {


	/*******************************************************************************************************************
	Funciones de la tabla notas_credito_servicio
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objNotaCredito)
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        //Se crea una instancia de la clase modelo (ordenes de reparación) 
        $otdModelOrdenesReparacion = new  Ordenes_reparacion_model();
        //Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

		//Tabla notas_credito_servicio
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objNotaCredito->strFolio); 

		//Concatenar hora, minutos y segundos
		$dteFecha = $objNotaCredito->dteFecha.' '.date("H:i:s"); 

		//Asignar datos al array
		$arrDatos = array('sucursal_id' =>  $objNotaCredito->intSucursalID, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha,  
						  'moneda_id' => $objNotaCredito->intMonedaID, 
						  'tipo_cambio' => $objNotaCredito->intTipoCambio,
						  'factura_servicio_id' => $objNotaCredito->intFacturaServicioID,
						  'prospecto_id' => $objNotaCredito->intProspectoID,
						  'razon_social' => $objNotaCredito->strRazonSocial, 
						  'rfc' => $objNotaCredito->strRfc, 
						  'regimen_fiscal_id'=> $objNotaCredito->intRegimenFiscalID,
						  'calle' => $objNotaCredito->strCalle,
						  'numero_exterior' => $objNotaCredito->strNumeroExterior,
						  'numero_interior' => $objNotaCredito->strNumeroInterior,
						  'codigo_postal' => $objNotaCredito->strCodigoPostal,
						  'colonia' => $objNotaCredito->strColonia,
						  'localidad' => $objNotaCredito->strLocalidad,
						  'municipio' => $objNotaCredito->strMunicipio,
						  'estado' => $objNotaCredito->strEstado,
						  'pais' => $objNotaCredito->strPais,
						  'forma_pago_id'=> $objNotaCredito->intFormaPagoID,
						  'metodo_pago_id'=> $objNotaCredito->intMetodoPagoID, 
						  'uso_cfdi_id'=> $objNotaCredito->intUsoCfdiID, 
						  'tipo_relacion_id'=> $objNotaCredito->intTipoRelacionID,
						  'exportacion_id'=> $objNotaCredito->intExportacionID,
						  'observaciones' => $objNotaCredito->strObservaciones,
						  'estatus' => 'TIMBRAR',
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objNotaCredito->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('notas_credito_servicio', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objNotaCredito->intNotaCreditoServicioID = $this->db->insert_id();


		//Hacer un llamado al método para guardar los detalles de la nota de crédito
		$this->guardar_detalles($objNotaCredito);

		//Hacer un llamado al método para modificar el estatus de la orden de reparación
		$otdModelOrdenesReparacion->set_estatus($objNotaCredito->intOrdenReparacionID, 'ACTIVO');
		
		//Hacer un llamado al método para guardar los CFDI relacionados de la devolución
		$otdModelCfdiRelacionados->guardar($objNotaCredito->intNotaCreditoServicioID, 
										   'DEVOLUCION SERVICIO', 
										   $objNotaCredito->strCfdiRelacionado, 
										   $objNotaCredito->strTiposRelacion);

		//Si se cumple la sentencia modificar el régimen fiscal de la factura (significa que la factura seleccionada no tenia régimen fiscal y el usuario modificó el régimen fiscal del cliente)
		if($objNotaCredito->strModRegimenFiscal == 'SI')
		{
			//Se crea una instancia de la clase modelo (Clientes) 
       		$otdModelClientes = new  Clientes_model();

       		//Hacer un llamado al método para modificar el id del régimen fiscal de una factura
       		$otdModelClientes->set_regimen_fiscal($objNotaCredito->intFacturaServicioID, 
										  		  'SERVICIO', 
										  		  $objNotaCredito->intRegimenFiscalID);

		}


		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objNotaCredito->intNotaCreditoServicioID;
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objNotaCredito)
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

         //Concatenar hora, minutos y segundos
		$dteFecha = $objNotaCredito->dteFecha.' '.date("H:i:s"); 

		//Tabla notas_credito_servicio
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha,  
						  'moneda_id' => $objNotaCredito->intMonedaID, 
						  'tipo_cambio' => $objNotaCredito->intTipoCambio,
						  'factura_servicio_id' => $objNotaCredito->intFacturaServicioID,
						  'prospecto_id' => $objNotaCredito->intProspectoID,
						  'razon_social' => $objNotaCredito->strRazonSocial, 
						  'rfc' => $objNotaCredito->strRfc, 
						  'regimen_fiscal_id'=> $objNotaCredito->intRegimenFiscalID,
						  'calle' => $objNotaCredito->strCalle,
						  'numero_exterior' => $objNotaCredito->strNumeroExterior,
						  'numero_interior' => $objNotaCredito->strNumeroInterior,
						  'codigo_postal' => $objNotaCredito->strCodigoPostal,
						  'colonia' => $objNotaCredito->strColonia,
						  'localidad' => $objNotaCredito->strLocalidad,
						  'municipio' => $objNotaCredito->strMunicipio,
						  'estado' => $objNotaCredito->strEstado,
						  'pais' => $objNotaCredito->strPais,
						  'forma_pago_id'=> $objNotaCredito->intFormaPagoID,
						  'metodo_pago_id'=> $objNotaCredito->intMetodoPagoID, 
						  'uso_cfdi_id'=> $objNotaCredito->intUsoCfdiID, 
						  'tipo_relacion_id'=> $objNotaCredito->intTipoRelacionID,
						  'exportacion_id'=> $objNotaCredito->intExportacionID,
						  'observaciones' => $objNotaCredito->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' =>  $objNotaCredito->intUsuarioID);
		$this->db->where('nota_credito_servicio_id', $objNotaCredito->intNotaCreditoServicioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('notas_credito_servicio', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('nota_credito_servicio_id', $objNotaCredito->intNotaCreditoServicioID);
		$this->db->delete('notas_credito_servicio_detalles');
		
		//Hacer un llamado al método para guardar los detalles de la nota de crédito
		$this->guardar_detalles($objNotaCredito);

	    //Hacer un llamado al método para guardar los CFDI relacionados de la devolución
		$otdModelCfdiRelacionados->guardar($objNotaCredito->intNotaCreditoServicioID, 
										   'DEVOLUCION SERVICIO', 
										   $objNotaCredito->strCfdiRelacionado, 
										   $objNotaCredito->strTiposRelacion);

		//Si se cumple la sentencia modificar el régimen fiscal de la factura (significa que la factura seleccionada no tenia régimen fiscal y el usuario modificó el régimen fiscal del cliente)
		if($objNotaCredito->strModRegimenFiscal == 'SI')
		{
			//Se crea una instancia de la clase modelo (Clientes) 
       		$otdModelClientes = new  Clientes_model();

       		//Hacer un llamado al método para modificar el id del régimen fiscal de una factura
       		$otdModelClientes->set_regimen_fiscal($objNotaCredito->intFacturaServicioID, 
										  		  'SERVICIO', 
										  		  $objNotaCredito->intRegimenFiscalID);

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
		$this->db->where('nota_credito_servicio_id', $objTimbrado->intReferenciaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('notas_credito_servicio', $arrDatos);
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


		//Tabla notas_credito_servicio
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('nota_credito_servicio_id', $objCancelacionCfdi->intReferenciaCfdiID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('notas_credito_servicio', $arrDatos);

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
	public function buscar($intNotaCreditoServicioID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
					       $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		
		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('SERVICIO');
		$strProcesoPoliza = $this->db->escape('NOTA CREDITO SERVICIO');

		$this->db->select("NCS.nota_credito_servicio_id, NCS.folio,
							NCS.fecha, DATE_FORMAT(NCS.fecha,'%d/%m/%Y') AS fecha_format,
						   	NCS.moneda_id, 	NCS.tipo_cambio, NCS.factura_servicio_id, 
						   	NCS.prospecto_id, NCS.razon_social, NCS.rfc,
						   	CASE 
							  WHEN  NCS.regimen_fiscal_id > 0 
							  THEN NCS.regimen_fiscal_id		
							ELSE IFNULL(C.regimen_fiscal_id,0)
						    END regimen_fiscal_id,
						    IFNULL(NCS.regimen_fiscal_id,0) AS regimenFiscalAnterior,
						    NCS.calle, NCS.numero_exterior, 
						   	NCS.numero_interior, NCS.codigo_postal, NCS.colonia, 
						   	NCS.localidad, NCS.municipio, NCS.estado, 
						   	NCS.pais, NCS.forma_pago_id, NCS.metodo_pago_id,
						   	NCS.uso_cfdi_id, NCS.tipo_relacion_id, 	NCS.exportacion_id,
						   	NCS.observaciones, NCS.estatus, 
						   	NCS.certificado, NCS.sello, NCS.uuid, NCS.fecha_timbrado, 
						    NCS.certificado_sat, NCS.sello_sat,NCS.leyenda_sat, NCS.rfc_pac, 
						   	M.codigo AS MonedaTipo, 
						   	CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   	CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, 
						   	FP.codigo AS FormaPago,
						   	CONCAT_WS(' - ', MP.codigo, MP.descripcion) AS metodo_pago, 
						   	MP.codigo AS MetodoPago,
						   	CONCAT_WS(' - ', U.codigo, U.descripcion) AS uso_cfdi, 
						   	U.codigo AS UsoCFDI,
						   	CONCAT_WS(' - ', TR.codigo, TR.descripcion) AS tipo_relacion, 
						   	TR.codigo AS TipoRelacion,
						   	_utf8'' AS CondicionesDePago, 
						   	_utf8'E' AS TipoDeComprobante, 
						   	CONCAT_WS(' - ', TC.codigo, TC.descripcion) AS tipo_comprobante,
						   RF.codigo AS RegimenFiscal,
						   CONCAT_WS(' - ', RF.codigo, RF.descripcion) AS regimen_fiscal,
						   ECF.codigo AS CodigoExportacion,
						   CONCAT_WS(' - ', ECF.codigo, ECF.descripcion) AS exportacion,
						   	PRO.codigo AS CodigoProspecto, FS.folio AS folio_factura,
						   	FS.orden_reparacion_id, FS.gastos_servicio, FS.gastos_servicio_iva,
						   	 UC.usuario AS usuario_creacion, 
						   	C.correo_electronico, C.contacto_correo_electronico, 
						   	IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza ", FALSE);
	    $this->db->from('notas_credito_servicio AS NCS');
	    $this->db->join('sat_monedas AS M', 'NCS.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'NCS.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('facturas_servicio AS FS', 'NCS.factura_servicio_id = FS.factura_servicio_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'NCS.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'NCS.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'NCS.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'NCS.tipo_relacion_id = TR.tipo_relacion_id', 'inner');
	    $this->db->join('sat_tipos_comprobante AS TC', 'TC.codigo = "E"', 'left');
	    $this->db->join('sat_regimen_fiscal AS RF', 'NCS.regimen_fiscal_id = RF.regimen_fiscal_id', 'left');
	    $this->db->join('sat_exportacion AS ECF', 'NCS.exportacion_id = ECF.exportacion_id', 'left');
	    $this->db->join('usuarios AS UC', 'NCS.usuario_creacion = UC.usuario_id', 'left');
	    $this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND NCS.nota_credito_servicio_id = PF.referencia_id', 'left');
		//Si existe id de la nota de crédito servicio
		if ($intNotaCreditoServicioID != NULL)
		{   
			$this->db->where('NCS.nota_credito_servicio_id', $intNotaCreditoServicioID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('NCS.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('NCS.prospecto_id', $intProspectoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(NCS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(NCS.estatus = 'TIMBRAR' OR NCS.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('NCS.estatus', $strEstatus);
				}
			}

			$this->db->where("((NCS.folio LIKE '%$strBusqueda%') OR
							   (FS.folio LIKE '%$strBusqueda%') OR
		    				   (CONCAT_WS(' - ', NCS.rfc, NCS.razon_social) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', NCS.rfc, NCS.razon_social) LIKE '%$strBusqueda%') OR
	    				       (CONCAT_WS(' - ', NCS.razon_social, NCS.rfc) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', NCS.razon_social, NCS.rfc) LIKE '%$strBusqueda%'))");
		   
			$this->db->order_by('NCS.fecha DESC, NCS.folio DESC');
			return $this->db->get()->result();
		}
	}

  	/*Método para regresar las notas de crédito que con el criterio de búsqueda proporcionado
	 (se utiliza en el reporte de facturación)*/
	 public function buscar_notas_credito_facturas($dteFechaInicial, $dteFechaFinal, $intProspectoID = NULL,  
												   $intMonedaID = NULL, $strSucursales = NULL, 
												   $strServiciosTipos = NULL)
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
			$strRestriccionesMoneda .= " AND NC.moneda_id = $intMonedaID";
			$strOrdenamiento .= " NC.moneda_id,";
		}

		$strOrdenamiento .= " NC.fecha, NC.folio";

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
				$strRestriccionesSucursales .= "NC.sucursal_id = ".$arrSucursales[$intCon];
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

		//Variable que se utiliza para formar la  consulta
		$strConsulta = "SELECT NC.nota_credito_servicio_id, NC.folio, NC.tipo_cambio, NC.estatus,
							   DATE_FORMAT(NC.fecha,'%d/%m/%Y') AS fecha,
							   FS.folio AS folio_factura,
							   C.razon_social,
							   OREP.folio AS folio_orden_reparacion,
							   OREP.servicio_tipo_id, S.nombre AS sucursal, ST.descripcion AS servicio_tipo,
							   Detalles.subtotal,
							   Detalles.iva,
							   Detalles.ieps,
							   Detalles.importe
						FROM  notas_credito_servicio AS NC
						INNER JOIN (SELECT NCD.nota_credito_servicio_id AS referenciaID,
											SUM(ROUND((NCD.precio/NC.tipo_cambio), 2)) AS subtotal,
							   				SUM(ROUND((NCD.iva/NC.tipo_cambio), 2)) AS iva,
										    SUM(ROUND((NCD.ieps/NC.tipo_cambio), 2)) AS ieps,
										    SUM(ROUND((NCD.precio/NC.tipo_cambio), 2) +
										    	ROUND((NCD.iva/NC.tipo_cambio), 2)  +
										     	ROUND((NCD.ieps/NC.tipo_cambio), 2)) AS importe
									FROM notas_credito_servicio_detalles AS NCD
									INNER JOIN notas_credito_servicio AS NC ON NCD.nota_credito_servicio_id = NC.nota_credito_servicio_id
							        GROUP BY NCD.nota_credito_servicio_id) AS Detalles ON Detalles.referenciaID = NC.nota_credito_servicio_id
						INNER JOIN facturas_servicio AS FS ON FS.factura_servicio_id = NC.factura_servicio_id
						INNER JOIN ordenes_reparacion AS OREP ON FS.orden_reparacion_id = OREP.orden_reparacion_id
						INNER JOIN servicios_tipos AS ST ON OREP.servicio_tipo_id = ST.servicio_tipo_id
						INNER JOIN clientes AS C ON NC.prospecto_id = C.prospecto_id
						INNER JOIN prospectos AS PRO ON PRO.prospecto_id = C.prospecto_id
						INNER JOIN sat_monedas AS M ON NC.moneda_id = M.moneda_id
						INNER JOIN sucursales AS S ON NC.sucursal_id = S.sucursal_id
						WHERE DATE_FORMAT(NC.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'
					    $strRestriccionesSucursales 
					    $strRestriccionesServiciosTipos
					    $strRestriccionesMoneda
					    $strRestriccionesProspecto
					    $strOrdenamiento";

		$strSQL = $this->db->query($strConsulta);
		return $strSQL->result();

	 }

  	//Método para regresar la información de un movimiento fiscal que será cancelado
	public function buscar_movimiento_fiscal($intNotaCreditoServicioID)
	{
		$strSQL = $this->db->query("SELECT E.rfc AS RFC, 
										NOW() AS Fecha, 
										NC.uuid, 
										NC.folio 
									FROM notas_credito_servicio AS NC
									INNER JOIN sucursales AS S ON S.sucursal_id = NC.sucursal_id   
									INNER JOIN empresas E ON E.empresa_id = S.empresa_id
									WHERE NC.nota_credito_servicio_id = $intNotaCreditoServicioID");
		return $strSQL->result();
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
											 $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, 
						 CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('notas_credito_servicio AS NCS');
	    $this->db->join('sat_monedas AS M', 'NCS.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'NCS.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('facturas_servicio AS FS', 'NCS.factura_servicio_id = FS.factura_servicio_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'NCS.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'NCS.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'NCS.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'NCS.tipo_relacion_id = TR.tipo_relacion_id', 'inner');
		$this->db->where('NCS.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('NCS.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(NCS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('NCS.estatus', $strEstatus);
		}

		$this->db->where("((NCS.folio LIKE '%$strBusqueda%') OR
						   (FS.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', NCS.rfc, NCS.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NCS.rfc, NCS.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', NCS.razon_social, NCS.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NCS.razon_social, NCS.rfc) LIKE '%$strBusqueda%'))");

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL,  
						   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('SERVICIO');
		$strProcesoPoliza = $this->db->escape('NOTA CREDITO SERVICIO');
		$strTipoRefCFDI = $this->db->escape('DEVOLUCION SERVICIO');


		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('NCS.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('NCS.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(NCS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(NCS.estatus = 'TIMBRAR' OR NCS.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('NCS.estatus', $strEstatus);
			}
		}

		$this->db->where("((NCS.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', NCS.rfc, NCS.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NCS.rfc, NCS.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', NCS.razon_social, NCS.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NCS.razon_social, NCS.rfc) LIKE '%$strBusqueda%'))");

		$this->db->from('notas_credito_servicio AS NCS');
	    $this->db->join('sat_monedas AS M', 'NCS.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'NCS.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('facturas_servicio AS FS', 'NCS.factura_servicio_id = FS.factura_servicio_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'NCS.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'NCS.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'NCS.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'NCS.tipo_relacion_id = TR.tipo_relacion_id', 'inner');
	    $this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND NCS.nota_credito_servicio_id = PF.referencia_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("NCS.nota_credito_servicio_id,  NCS.folio, 
						   DATE_FORMAT(NCS.fecha,'%d/%m/%Y') AS fecha, 
						   NCS.razon_social, NCS.estatus, NCS.uuid,
						   FS.folio AS folio_factura,  
						   IFNULL(NCS.regimen_fiscal_id,0) AS regimen_fiscal_id,
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza, 
						   IFNULL(CCFDI.cancelacion_id, 0) AS cancelacion_id", FALSE);
		$this->db->from('notas_credito_servicio AS NCS');
	    $this->db->join('sat_monedas AS M', 'NCS.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'NCS.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('facturas_servicio AS FS', 'NCS.factura_servicio_id = FS.factura_servicio_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'NCS.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'NCS.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'NCS.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'NCS.tipo_relacion_id = TR.tipo_relacion_id', 'inner');
	    $this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND NCS.nota_credito_servicio_id = PF.referencia_id', 'left');
	    $this->db->join('cancelaciones AS CCFDI', 'CCFDI.tipo_referencia = '.$strTipoRefCFDI.' 
	    							        	  AND CCFDI.referencia_id = NCS.nota_credito_servicio_id', 'left');

	    $this->db->where('NCS.sucursal_id', $this->session->userdata('sucursal_id'));
	    //Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('NCS.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(NCS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(NCS.estatus = 'TIMBRAR' OR NCS.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('NCS.estatus', $strEstatus);
			}
		}

		$this->db->where("((NCS.folio LIKE '%$strBusqueda%') OR
						   (FS.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', NCS.rfc, NCS.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NCS.rfc, NCS.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', NCS.razon_social, NCS.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NCS.razon_social, NCS.rfc) LIKE '%$strBusqueda%'))");
		$this->db->order_by('NCS.fecha DESC, NCS.folio DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["notas"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strFormulario, $intReferenciaID)
	{
		$this->db->select('nota_credito_servicio_id, folio, uuid');
        $this->db->from('notas_credito_servicio');
        $this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
        //Si el formulario corresponde a una cancelación de timbrado
        if($strFormulario == 'cancelacion')
        {
        	$this->db->where('nota_credito_servicio_id <>', $intReferenciaID);
        }
     	$this->db->where('estatus', 'ACTIVO');
        $this->db->where("(folio LIKE '%$strDescripcion%')");
        $this->db->order_by('folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
	

	/*******************************************************************************************************************
	Funciones de la tabla notas_credito_servicio_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la nota de crédito
	public function guardar_detalles(stdClass $objNotaCredito)
	{
		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener los detalles de la nota de crédito
		foreach ($objNotaCredito->arrDetalles as $arrDets)
		{
			//Hacer recorrido para obtener los datos del detalle
			foreach ($arrDets as $arrDet)
			{
				//Incrementar renglón consecutivo
				$intRenglon++;

				//Asignar datos al array
				$arrDatos = array('nota_credito_servicio_id' => $objNotaCredito->intNotaCreditoServicioID,
								  'renglon' => $intRenglon,
								  'concepto' => $objNotaCredito->strConcepto,
								  'codigo_sat' => CLAVE_PRODUCTO_SAT_NCREDITO_SERV,
								  'unidad_sat' => CLAVE_UNIDAD_SAT_NCREDITO_SERV,
								  'objeto_impuesto_sat' => $objNotaCredito->strObjetoImpuestoSat,
								  'precio' => $arrDet->precio,
								  'tasa_cuota_iva' => $arrDet->tasa_cuota_iva,
								  'iva' => $arrDet->iva,
								  'tasa_cuota_ieps' => $arrDet->tasa_cuota_ieps,
								  'ieps' => $arrDet->ieps);
				//Guardar los datos del registro
				$this->db->insert('notas_credito_servicio_detalles', $arrDatos);
			}
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intNotaCreditoServicioID)
	{

		$this->db->select("NCSD.concepto, NCSD.codigo_sat, NCSD.unidad_sat, NCSD.objeto_impuesto_sat,
						   1 AS cantidad, NCSD.precio, NCSD.tasa_cuota_iva, NCSD.iva, 
						   NCSD.tasa_cuota_ieps, NCSD.ieps, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps,
						   TIeps.tipo AS tipo_ieps, TIeps.factor AS factor_ieps, 
						   CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto", FALSE);
		$this->db->from('notas_credito_servicio_detalles AS NCSD');
		$this->db->join('sat_tasa_cuota AS TIva', 'NCSD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'NCSD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('sat_objeto_impuesto AS OImp', 'NCSD.objeto_impuesto_sat = OImp.codigo', 'left');
		$this->db->where('NCSD.nota_credito_servicio_id', $intNotaCreditoServicioID);
		$this->db->order_by('NCSD.renglon', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los detalles de un registro para mostrarlos en el archivo XML
	public function buscar_detalles_xml($intNotaCreditoServicioID)
	{
		//Constantes para identificar los datos del SAT correspondientes a la nota de crédito servicio
   		$strClaveProductoServ = CLAVE_PRODUCTO_SAT_NCREDITO_SERV;
   		$strClaveUnidad = CLAVE_UNIDAD_SAT_NCREDITO_SERV;
   		$strUnidad = UNIDAD_SAT_NCREDITO_SERV;

   		$strSQL = $this->db->query("SELECT 	NCSD.nota_credito_servicio_id AS ID, 
											1 AS renglon,  
											_utf8'$strClaveProductoServ' AS ClaveProdServ, 
						  				  	_utf8'' AS NoIdentificacion,  
						  				  	1 AS cantidad, 
						  				  	_utf8'$strClaveUnidad' AS ClaveUnidad, 
						 				  	_utf8'$strUnidad' AS Unidad, 
						 				  	NCSD.objeto_impuesto_sat AS ClaveObjetoImpuesto,
						 				  	NCSD.concepto AS Descripcion, 
						 				  	NCSD.concepto, 
						 				  	NCSD.precio AS subtotal, 
						 				  	0 AS descuento, 
						 				  	NCSD.iva AS iva, 
						 				  	NCSD.ieps AS ieps, 
						 				  	_utf8'' AS Pedimento, 
						  				  	TIva.valor_maximo AS PorcentajeIva, 
						  				  	TIva.factor AS FactorIva,  
						  				  	IIva.codigo AS ImpuestoIva,  
						  				  	TIeps.valor_maximo AS PorcentajeIeps,
						  				  	TIeps.factor AS FactorIeps, 
						  				  	IIeps.codigo AS ImpuestoIeps, 
						  				  	CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto
						  			FROM notas_credito_servicio_detalles AS NCSD
						  			INNER JOIN  sat_tasa_cuota AS TIva ON NCSD.tasa_cuota_iva = TIva.tasa_cuota_id
						  			INNER JOIN  sat_impuestos AS IIva ON TIva.impuesto_id = IIva.impuesto_id
						  			LEFT JOIN  sat_tasa_cuota AS TIeps ON NCSD.tasa_cuota_ieps = TIeps.tasa_cuota_id
						  			LEFT JOIN  sat_impuestos AS IIeps ON TIeps.impuesto_id = IIeps.impuesto_id
						  			LEFT JOIN sat_objeto_impuesto AS OImp ON NCSD.objeto_impuesto_sat = OImp.codigo
						  			WHERE NCSD.nota_credito_servicio_id = $intNotaCreditoServicioID");
		return $strSQL->result();
	}

}
?>