<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de CFDI relacionados (para guardar los CFDI relacionados del registro)
include_once(APPPATH . 'models/caja/Cfdi_relacionados_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');
//Incluir la clase modelo de cancelaciones (para guardar la cancelación del timbrado (CFDI))
include_once(APPPATH . 'models/contabilidad/Cancelaciones_model.php');

class Pagos_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla pagos
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objPago)
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
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objPago->strFolio); 
		 
		//Concatenar hora, minutos y segundos
		$dteFecha = $objPago->dteFecha.' '.date("H:i:s"); 


		//Tabla pagos
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objPago->intSucursalID,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha, 
						  'moneda' => $objPago->strMoneda, 
						  'tipo_cambio' => $objPago->intTipoCambio, 
						  'prospecto_id' => $objPago->intProspectoID, 
						  'razon_social' => $objPago->strRazonSocial, 
						  'rfc' => $objPago->strRfc, 
						  'regimen_fiscal_id' => $objPago->intRegimenFiscalID,
						  'calle' => $objPago->strCalle, 
						  'numero_exterior' => $objPago->strNumeroExterior, 
						  'numero_interior' => $objPago->strNumeroInterior, 
						  'codigo_postal' => $objPago->strCodigoPostal, 
						  'colonia' => $objPago->strColonia, 
						  'localidad' => $objPago->strLocalidad, 
						  'municipio' => $objPago->strMunicipio, 
						  'estado' => $objPago->strEstado, 
						  'pais' => $objPago->strPais, 
						  'uso_cfdi_id' => $objPago->intUsoCfdiID,
						  'tipo_relacion_id' => $objPago->intTipoRelacionID,
						  'exportacion_id' => $objPago->intExportacionID,
						  'observaciones' => $objPago->strObservaciones,
						  'estatus'  => 'TIMBRAR',
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objPago->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('pagos', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objPago->intPagoID = $this->db->insert_id();


		//Hacer un llamado al método para guardar los CFDI relacionados del pago
		$otdModelCfdiRelacionados->guardar($objPago->intPagoID, 'PAGO', 
										   $objPago->strCfdiRelacionado, 
										   $objPago->strTiposRelacion);

		//Hacer un llamado al método para guardar los detalles del pago
		$this->guardar_detalles($objPago);
		
		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objPago->intPagoID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objPago)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();
	    //Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

        //Concatenar hora, minutos y segundos
		$dteFecha = $objPago->dteFecha.' '.date("H:i:s"); 

        //Tabla pagos
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha, 
						  'moneda' => $objPago->strMoneda, 
						  'tipo_cambio' => $objPago->intTipoCambio, 
						  'prospecto_id' => $objPago->intProspectoID, 
						  'razon_social' => $objPago->strRazonSocial, 
						  'rfc' => $objPago->strRfc, 
						  'regimen_fiscal_id' => $objPago->intRegimenFiscalID,
						  'calle' => $objPago->strCalle, 
						  'numero_exterior' => $objPago->strNumeroExterior, 
						  'numero_interior' => $objPago->strNumeroInterior, 
						  'codigo_postal' => $objPago->strCodigoPostal, 
						  'colonia' => $objPago->strColonia, 
						  'localidad' => $objPago->strLocalidad, 
						  'municipio' => $objPago->strMunicipio, 
						  'estado' => $objPago->strEstado, 
						  'pais' => $objPago->strPais, 
						  'uso_cfdi_id' => $objPago->intUsoCfdiID,
						  'tipo_relacion_id' => $objPago->intTipoRelacionID,
						  'exportacion_id' => $objPago->intExportacionID,
						  'observaciones' => $objPago->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objPago->intUsuarioID);
		$this->db->where('pago_id', $objPago->intPagoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('pagos', $arrDatos);

	    //Hacer un llamado al método para guardar los CFDI relacionados del pago
		$otdModelCfdiRelacionados->guardar($objPago->intPagoID, 'PAGO', 
										   $objPago->strCfdiRelacionado, 
										   $objPago->strTiposRelacion);

		//Eliminar los detalles relacionados guardados
		$this->db->where('pago_id', $objPago->intPagoID);
		$this->db->delete('pagos_detalles_relacionados_02');


		//Eliminar los detalles guardados
		$this->db->where('pago_id', $objPago->intPagoID);
		$this->db->delete('pagos_detalles_02');

		
		//Hacer un llamado al método para guardar los detalles del pago
		$this->guardar_detalles($objPago);
		
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
		$this->db->where('pago_id', $objTimbrado->intReferenciaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('pagos', $arrDatos);
	}

    //Método para modificar el estatus de un registro a INACTIVO 
	public function set_cancelar(stdClass $objCancelacionCfdi)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		 //Se crea una instancia de la clase modelo (cancelaciones) 
        $otdModelCancelaciones = new Cancelaciones_model();
		
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('pago_id',  $objCancelacionCfdi->intReferenciaCfdiID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('pagos', $arrDatos);

		//Si existe id de la póliza
        if($objCancelacionCfdi->intPolizaID > 0)
        {
        	//Se crea una instancia de la clase modelo (pólizas) 
	        $otdModelPolizas = new Polizas_model();
			//Hacer un llamado al método para modificar el estatus de la póliza 
			$otdModelPolizas->set_estatus($objCancelacionCfdi->intPolizaID, 'INACTIVO');
        }
		

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
	public function buscar($intPagoID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strProcesoPoliza = $this->db->escape('RECEPCION PAGO');
		//Constante para identificar la forma de pago: Aplicación de anticipos
		$intFormaPagoIDApliAnticipo = FORMA_PAGO_APLICACION_ANTICIPO;


		$this->db->select("P.pago_id, P.folio, P.fecha, DATE_FORMAT(P.fecha,'%d/%m/%Y') AS fecha_format,
						   P.moneda AS MonedaTipo, P.tipo_cambio, P.prospecto_id, PRO.codigo AS CodigoProspecto,  
						   P.razon_social, P.rfc,
						   CASE 
							  WHEN  P.regimen_fiscal_id > 0 
							  THEN P.regimen_fiscal_id		
							ELSE IFNULL(C.regimen_fiscal_id,0)
						    END regimen_fiscal_id,
						   P.calle, P.numero_exterior, P.numero_interior, 
						   P.codigo_postal, P.colonia, P.localidad, P.municipio, P.estado, 
						   P.pais, P.uso_cfdi_id,
						   	CASE   
						      WHEN P.tipo_relacion_id > 0 THEN P.tipo_relacion_id
						      ELSE ''  
						   	END AS tipo_relacion_id, P.exportacion_id,
						   	P.observaciones, P.estatus, P.certificado, P.sello, 
						   	P.uuid, P.fecha_timbrado, P.certificado_sat, P.sello_sat,
						   	P.leyenda_sat, P.rfc_pac, C.nombre_comercial AS cliente, 
						   	C.correo_electronico, C.contacto_correo_electronico,  
						   	P.moneda AS MonedaTipo, 
						   	_utf8'' AS FormaPago,
						   	_utf8'' AS MetodoPago, 
						   	CONCAT_WS(' - ', U.codigo, U.descripcion) AS uso_cfdi, 
						   	U.codigo AS UsoCFDI,
						   	CONCAT_WS(' - ', TR.codigo, TR.descripcion) AS tipo_relacion,
						   	IFNULL(TR.codigo, '') AS TipoRelacion,
						   	_utf8'' AS CondicionesDePago, 
						   	_utf8'P' AS TipoDeComprobante, 
						   	CONCAT_WS(' - ', TC.codigo, TC.descripcion) AS tipo_comprobante, 
						   	RF.codigo AS RegimenFiscal,
						   	ECF.codigo AS CodigoExportacion,
						   	_utf8'' AS forma_pago, 
						   	_utf8'' AS metodo_pago,
						    IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza, 
						   	IFNULL((SELECT COUNT(PD.pago_id)
						   	FROM pagos_detalles_02 AS PD
						   	WHERE PD.pago_id = P.pago_id
						   	AND PD.forma_pago_id = ".$intFormaPagoIDApliAnticipo."
						   	AND PD.anticipo_id IS NULL), 0) AS anticiposAplicar", FALSE);
		$this->db->from('pagos AS P');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('prospectos AS PRO', 'PRO.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'P.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'P.tipo_relacion_id = TR.tipo_relacion_id', 'left');
	    $this->db->join('sat_tipos_comprobante AS TC', 'TC.codigo = "P"', 'left');
	     $this->db->join('sat_exportacion AS ECF', 'P.exportacion_id = ECF.exportacion_id', 'left');
	    $this->db->join('sat_regimen_fiscal AS RF', 'P.regimen_fiscal_id = RF.regimen_fiscal_id', 'left');
	    $this->db->join('polizas AS PF', 'PF.modulo = "CAJA" 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND P.pago_id = PF.referencia_id', 'left');

		//Si existe id del pago
		if ($intPagoID !== NULL)
		{   
			$this->db->where('P.pago_id', $intPagoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('P.sucursal_id', $this->session->userdata('sucursal_id'));
		    //Si existe id del cliente
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('P.prospecto_id', $intProspectoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(P.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }
		    
		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{
					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(P.estatus = 'TIMBRAR' OR P.estatus = 'ACTIVO')");

				}
				else
				{
					$this->db->where('P.estatus', $strEstatus);
				}
			}


			$this->db->where("((P.folio LIKE '%$strBusqueda%') OR
		    				   (CONCAT_WS(' - ', P.rfc, P.razon_social) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', P.rfc, P.razon_social) LIKE '%$strBusqueda%') OR
	    				       (CONCAT_WS(' - ', P.razon_social, P.rfc) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', P.razon_social, P.rfc) LIKE '%$strBusqueda%'))");

			$this->db->order_by('P.fecha DESC, P.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los detalles de un registro para mostrarlos en el archivo XML
	public function buscar_detalles_xml($intPagoID)
	{

		$strSQL = $this->db->query("SELECT 	P.pago_id AS ID, 
											1 AS renglon, _utf8'84111506' AS ClaveProdServ,
											_utf8'' AS NoIdentificacion, 
											1 AS cantidad, 
											_utf8'ACT' AS ClaveUnidad,
											_utf8'' AS Unidad, 
											_utf8'Pago' AS Descripcion, 
											'Pago' AS concepto,
											0 AS subtotal, 
											0 AS descuento, 
											0 AS iva, 
											0 AS ieps, 
											_utf8'' AS Pedimento,
											TIva.valor_maximo AS PorcentajeIva, 
											TIva.factor AS FactorIva,
											IIva.codigo AS ImpuestoIva, 
											0 AS PorcentajeIeps,
						  				   '' AS FactorIeps, '' AS ImpuestoIeps, 
						  				   IFNULL((SELECT SUM(PD.monto) 
						  				   		   FROM pagos_detalles_02 AS PD
						  				   		   WHERE PD.pago_id = P.pago_id), 0) AS MontoTotalPagos
						  			FROM pagos AS P
						  			INNER JOIN  sat_impuestos AS IIva ON IIva.descripcion = 'IVA'
						  			INNER JOIN  sat_tasa_cuota AS TIva ON IIva.impuesto_id = TIva.impuesto_id AND TIva.valor_maximo = 0
						  			WHERE P.pago_id = $intPagoID");
		return $strSQL->result();
	}

	//Método para regresar la información de un movimiento fiscal que será cancelado
	public function buscar_movimiento_fiscal($intPagoID)
	{
		$strSQL = $this->db->query("SELECT E.rfc AS RFC,
										NOW() AS Fecha, 
										P.uuid, 
										P.folio 
									FROM pagos AS P
									INNER JOIN sucursales AS S ON S.sucursal_id = P.sucursal_id   
									INNER JOIN empresas E ON E.empresa_id = S.empresa_id
									WHERE P.pago_id = $intPagoID");
		return $strSQL->result();
	}
	

	//Método para regresar la forma de pago de un registro para generar póliza (aplicación/ingresos)
	public function buscar_forma_pago($intPagoID)
	{
		//Pagos
		$queryPago = "SELECT PD.forma_pago_id
			   		   FROM  ((pagos AS P INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id) 
	     					  INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PD.pago_id = PDR.pago_id 
						     AND PD.renglon = PDR.renglon_detalles)
					   WHERE P.pago_id = $intPagoID
                       GROUP BY P.pago_id, PDR.renglon_detalles";

		$strSQL = $this->db->query($queryPago);
		return $strSQL->row();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL, 
						   $strEstatus = NULL, $strBusqueda =  NULL, $intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strProcesoPoliza = $this->db->escape('RECEPCION PAGO');
		//Constante para identificar la forma de pago: Aplicación de anticipos
		$intFormaPagoIDApliAnticipo = FORMA_PAGO_APLICACION_ANTICIPO;


		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('P.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del cliente
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('P.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(P.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(P.estatus = 'TIMBRAR' OR P.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('P.estatus', $strEstatus);
			}
		}

		$this->db->where("((P.folio LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', P.rfc, P.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', P.rfc, P.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', P.razon_social, P.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', P.razon_social, P.rfc) LIKE '%$strBusqueda%'))");

		$this->db->from('pagos AS P');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'P.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('polizas AS PF', 'PF.modulo = "CAJA" 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND P.pago_id = PF.referencia_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("P.pago_id, P.folio, DATE_FORMAT(P.fecha,'%d/%m/%Y') AS fecha,
						   P.estatus, P.rfc, P.razon_social, 
						   IFNULL(P.regimen_fiscal_id,0) AS regimen_fiscal_id,
						    P.uuid,
						    IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   	PF.folio AS folio_poliza, 
						   	IFNULL((SELECT COUNT(PD.pago_id)
						   	FROM pagos_detalles_02 AS PD
						   	WHERE PD.pago_id = P.pago_id
						   	AND PD.forma_pago_id = ".$intFormaPagoIDApliAnticipo."
						   	AND PD.anticipo_id IS NULL), 0) AS anticiposAplicar, 
						   	IFNULL(CCFDI.cancelacion_id, 0) AS cancelacion_id", FALSE);
		$this->db->from('pagos AS P');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'P.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('polizas AS PF', 'PF.modulo = "CAJA" 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND P.pago_id = PF.referencia_id', 'left');
	    $this->db->join('cancelaciones AS CCFDI', 'CCFDI.tipo_referencia = "PAGO"
	    							        	  AND CCFDI.referencia_id = P.pago_id', 'left');
		

		$this->db->where('P.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del cliente
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('P.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(P.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(P.estatus = 'TIMBRAR' OR P.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('P.estatus', $strEstatus);
			}
		}

		$this->db->where("((P.folio LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', P.rfc, P.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', P.rfc, P.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', P.razon_social, P.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', P.razon_social, P.rfc) LIKE '%$strBusqueda%'))");

		$this->db->order_by('P.fecha DESC, P.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["pagos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strFormulario, $intReferenciaID)
	{
		$this->db->select('pago_id, folio, uuid');
        $this->db->from('pagos');
        $this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
        //Si el formulario corresponde a una cancelación de timbrado
        if($strFormulario == 'cancelacion')
        {
        	$this->db->where('pago_id <>', $intReferenciaID);
        }
     	$this->db->where('estatus', 'ACTIVO');
        $this->db->where("(folio LIKE '%$strDescripcion%')");
        $this->db->order_by('folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}



	/*Método para regresar las formas de pago  que coincidan con el criterio de búsqueda proporcionado 
     *(se utiliza en el reporte de ingresos)*/
	public function buscar_distintas_formas_pago_ingresos_dia($dteFecha, $intMonedaID, $strSucursales = NULL,
															  $strModulos = NULL, $intFormaPagoID = NULL)
	{

		//Variable que se utiliza para formar la  consulta
		$queryIngresos = '';
		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		//ID´s de las sucursales
		$strRestriccionesSucursales = '';
		//Modulos de la cartera
		$strRestriccionesModulos = '';
		//Modulo de maquinaria
		$strRestriccionModMaquinaria = '';
		//Modulo de refacciones
		$strRestriccionModRefacciones = '';
		//Modulo de servicio
		$strRestriccionModServicio = '';
		//Modulo de conceptos
		$strRestriccionModConceptos = '';
		//Forma de pago
		$strRestriccionesFormaPago = '';

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
				$strRestriccionesSucursales .= "Reg.sucursal_id = ".$arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}

		//Si existen modulos seleccionados
		if($strModulos)
		{
			//Generar las condiciones dinamicas de las consultas respecto al tipo de referencia de la tabla pagos
			$strRestriccionesModulos .= " AND ( PDR.tipo_referencia = 'CARTERA' ";

			//Quitar | de la lista para obtener el modulo
			$arrModulos = explode("|", $strModulos);

			//Hacer recorrido para formar restricción con los modulos de la catera
			for ($intCon = 0; $intCon < sizeof($arrModulos); $intCon++) 
			{
				//Variable que se utiliza para asignar el modulo
				$strModulo = $arrModulos[$intCon];

				
				//Asignar condición OR
				$strRestriccionesModulos .= " OR ";

				//Concatenar modulo para buscar datos en la tabla cartera
				$strRestriccionesModulos .= "PDR.tipo_referencia = "."'".$arrModulos[$intCon]."'";

				//Dependiendo del modulo asignar valor a la restricción que se utiliza para buscar datos de las facturas
				if($strModulo == 'MAQUINARIA')
				{
				   //Facturas de maquinaria
				   $strRestriccionModMaquinaria = $strModulo;
				}

				if($strModulo == 'REFACCIONES')
				{
					//Facturas de refacciones
					$strRestriccionModRefacciones = $strModulo;
				}
				
				if($strModulo == 'SERVICIO')
				{
					//Facturas de servicio
					$strRestriccionModServicio = $strModulo;
				}
				
				if($strModulo == 'CONCEPTOS')
				{
					//Facturas de conceptos
					$strRestriccionModConceptos = $strModulo;
				}
			}

			$strRestriccionesModulos .= ")";
		}

		//Si existe id de la forma de pago
		if($intFormaPagoID > 0)
		{
			$strRestriccionesFormaPago .= " AND FP.forma_pago_id = $intFormaPagoID";
		}

		
		//Variables para definir que tipos de módulo se incluiran en la búsqueda
		//Facturas de maquinaria
		$queryMaquinaria = "SELECT DISTINCT FP.forma_pago_id, 
								  CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
							FROM facturas_maquinaria AS Reg
							INNER JOIN sat_forma_pago AS FP ON Reg.forma_pago_id = FP.forma_pago_id
							WHERE DATE_FORMAT(Reg.fecha, '%Y-%m-%d') = '$dteFecha'
							$strRestriccionesSucursales
							$strRestriccionesFormaPago
							AND Reg.condiciones_pago = 'CONTADO'
							AND Reg.moneda_id = $intMonedaID
							AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')";

		//Facturas de refacciones
		$queryRefacciones =  "SELECT DISTINCT FP.forma_pago_id, 
									CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
							 FROM facturas_refacciones AS Reg
							 INNER JOIN sat_forma_pago AS FP ON Reg.forma_pago_id = FP.forma_pago_id
							 WHERE DATE_FORMAT(Reg.fecha, '%Y-%m-%d') = '$dteFecha'
							 $strRestriccionesSucursales
							 $strRestriccionesFormaPago
							 AND Reg.condiciones_pago = 'CONTADO'
							 AND Reg.moneda_id = $intMonedaID
							 AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')";

		//Facturas de servicio
		$queryServicio = "SELECT DISTINCT FP.forma_pago_id, 
								  CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
						 FROM facturas_servicio AS Reg
						 INNER JOIN sat_forma_pago AS FP ON Reg.forma_pago_id = FP.forma_pago_id
						 WHERE DATE_FORMAT(Reg.fecha, '%Y-%m-%d') = '$dteFecha'
						 $strRestriccionesSucursales
						 $strRestriccionesFormaPago
						 AND Reg.condiciones_pago = 'CONTADO'
						 AND Reg.moneda_id = $intMonedaID
						 AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')";

		//Facturas de conceptos
		$queryConceptos =   "SELECT DISTINCT FP.forma_pago_id, 
								  CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
							 FROM facturas_conceptos AS Reg
							 INNER JOIN sat_forma_pago AS FP ON Reg.forma_pago_id = FP.forma_pago_id
							 WHERE DATE_FORMAT(Reg.fecha, '%Y-%m-%d') = '$dteFecha'
							 $strRestriccionesSucursales
							 $strRestriccionesFormaPago
							 AND Reg.condiciones_pago = 'CONTADO'
							 AND Reg.moneda_id = $intMonedaID
							 AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')";


		//Anticipos
		$queryAnticipos =  "SELECT DISTINCT FP.forma_pago_id, 
								   CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
							FROM  anticipos AS Reg
							INNER JOIN sat_forma_pago AS FP ON Reg.forma_pago_id = FP.forma_pago_id
							WHERE DATE_FORMAT(Reg.fecha, '%Y-%m-%d') = '$dteFecha'
							$strRestriccionesSucursales
							$strRestriccionesFormaPago
							AND Reg.moneda_id = $intMonedaID
							AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')";

		//Pagos
	    $queryPagos =  "SELECT DISTINCT FP.forma_pago_id, 
								CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
						FROM pagos AS Reg
						INNER JOIN pagos_detalles_02 AS PD ON Reg.pago_id = PD.pago_id
						INNER JOIN sat_forma_pago AS FP ON PD.forma_pago_id = FP.forma_pago_id
						INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PDR.pago_id = Reg.pago_id 
								   AND PDR.renglon_detalles = PD.renglon
					    INNER JOIN sat_monedas AS M ON PDR.moneda_tipo = M.codigo
						WHERE DATE_FORMAT(PD.fecha_pago, '%Y-%m-%d') = '$dteFecha'
						$strRestriccionesSucursales
						$strRestriccionesModulos
						$strRestriccionesFormaPago
						AND M.moneda_id = $intMonedaID
						AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')";	



	    //Formar consulta
		//Si existe modulo de maquinaria
		if($strRestriccionModMaquinaria != '')
		{
		   //Concatenar facturas de maquinaria
		   $queryIngresos .= $queryMaquinaria;
		}


		//Si existe modulo de refacciones
		if($strRestriccionModRefacciones != '')
		{
			//Si existen facturas asignar condición UNION
			$queryIngresos .= (($queryIngresos !== '') ? 
								" UNION " : '');

			//Concatenar facturas de refacciones
			$queryIngresos .= $queryRefacciones;
		}
		

		//Si existe modulo de servicio
		if($strRestriccionModServicio != '')
		{
			//Si existen facturas asignar condición UNION
			$queryIngresos .= (($queryIngresos !== '') ? 
								" UNION " : '');

			//Concatenar facturas de servicio
			$queryIngresos .= $queryServicio;
		}


		//Si existe modulo de conceptos
		if($strRestriccionModConceptos != '')
		{
			//Si existen facturas asignar condición UNION
			$queryIngresos .= (($queryIngresos !== '') ? 
								" UNION " : '');

			//Concatenar facturas de conceptos
			$queryIngresos .= $queryConceptos;
		}

		
		$queryIngresos .= " UNION ";
		$queryIngresos .= $queryAnticipos;
		$queryIngresos .= " UNION ";
		$queryIngresos .= $queryPagos;
		$queryIngresos .= "ORDER BY  forma_pago_id ASC";

		$strSQL = $this->db->query($queryIngresos);
		return $strSQL->result();
	}


	/*Método para regresar los ingresos (facturas de maquinaria, facturas de refacciones, facturas de servicio, 
	  anticipos y pagos) con los criterios de búsqueda proporcionados 
	  (se utiliza en el reporte de ingresos)*/
	public function buscar_ingresos_dia($dteFecha, $intMonedaID, $strTipo, 
										$strSucursales = NULL, $intFormaPagoID = NULL)
	{
		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		//ID´s de las sucursales
		$strRestriccionesSucursales = '';
		//Forma de pago
		$strRestriccionesFormaPago = '';

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
				$strRestriccionesSucursales .= "Reg.sucursal_id = ".$arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}

		//Si existe id de la forma de pago
		if($intFormaPagoID > 0)
		{
			$strRestriccionesFormaPago .= " AND FP.forma_pago_id = $intFormaPagoID";
		}

		


		//Dependiendo del tipo realizar búsqueda de datos
		if($strTipo == 'FACTURAS MAQUINARIA')
		{
			$strSQL = $this->db->query("SELECT  CONCAT_WS(' - ', Reg.folio,  C.razon_social) AS concepto,
												(ROUND((Reg.precio/Reg.tipo_cambio), 2)) AS importe,
												(ROUND((Reg.iva/Reg.tipo_cambio), 2)) AS iva,
												(ROUND((Reg.ieps/Reg.tipo_cambio), 2)) AS ieps,
												Reg.forma_pago_id, 
											    CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
										FROM facturas_maquinaria AS Reg
										INNER JOIN sat_monedas AS M ON M.moneda_id = Reg.moneda_id
										INNER JOIN clientes AS C ON C.prospecto_id = Reg.prospecto_id
										INNER JOIN sat_forma_pago AS FP ON Reg.forma_pago_id = FP.forma_pago_id
										WHERE DATE_FORMAT(Reg.fecha, '%Y-%m-%d') = '$dteFecha'
										$strRestriccionesSucursales
										$strRestriccionesFormaPago
										AND Reg.condiciones_pago = 'CONTADO'
										AND Reg.moneda_id = $intMonedaID
										AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
										GROUP BY Reg.factura_maquinaria_id
										ORDER BY Reg.folio ASC");
		}
		else if($strTipo == 'FACTURAS REFACCIONES')
		{
			$strSQL = $this->db->query("SELECT  CONCAT_WS(' - ', Reg.folio,  C.razon_social) AS concepto,
												(IFNULL(ROUND((Reg.gastos_paqueteria/Reg.tipo_cambio), 2), 0) +
												SUM(ROUND((Det.precio_unitario * Det.cantidad), 2)))  AS importe, 
												SUM(ROUND((Det.iva_unitario * Det.cantidad), 2)) AS iva,
												SUM(ROUND((Det.ieps_unitario * Det.cantidad), 2)) AS ieps,
											    Reg.forma_pago_id, 
											    CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
									FROM facturas_refacciones AS Reg
									INNER JOIN facturas_refacciones_detalles AS Det ON Det.factura_refacciones_id = Reg.factura_refacciones_id
									INNER JOIN clientes AS C ON  Reg.prospecto_id = C.prospecto_id
									INNER JOIN sat_forma_pago AS FP ON Reg.forma_pago_id = FP.forma_pago_id
									WHERE DATE_FORMAT(Reg.fecha, '%Y-%m-%d') = '$dteFecha'
									$strRestriccionesSucursales
									$strRestriccionesFormaPago
									AND Reg.condiciones_pago = 'CONTADO'
									AND Reg.moneda_id = $intMonedaID
									AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
									GROUP BY Reg.factura_refacciones_id
									ORDER BY Reg.folio ASC");

		}
		else if($strTipo == 'FACTURAS SERVICIO')
		{

			$strSQL = $this->db->query("SELECT  CONCAT_WS(' - ', Reg.folio,  C.razon_social) AS concepto,
												(IFNULL(ROUND((Reg.gastos_servicio/Reg.tipo_cambio), 2), 0) +
												 IFNULL(ROUND((ManoObra.Subtotal/Reg.tipo_cambio), 2), 0) +
											     IFNULL((Otros.Subtotal / Reg.tipo_cambio), 0) +
											     IFNULL((Refacciones.Subtotal / Reg.tipo_cambio), 0) +
											     IFNULL((Foraneos.Subtotal / Reg.tipo_cambio), 0)) AS importe,

											    (IFNULL(ROUND((Reg.gastos_servicio_iva/Reg.tipo_cambio), 2), 0) +
												 IFNULL(ROUND((ManoObra.IVA/Reg.tipo_cambio), 2), 0) +
											     IFNULL((Otros.IVA / Reg.tipo_cambio), 0) +
											     IFNULL((Refacciones.IVA / Reg.tipo_cambio), 0) +
											     IFNULL((Foraneos.IVA / Reg.tipo_cambio), 0)) AS iva,

											    (IFNULL(ROUND((ManoObra.IEPS/Reg.tipo_cambio), 2), 0) +
					   						    IFNULL(ROUND((Otros.IEPS/Reg.tipo_cambio), 2), 0) + 
					   						    IFNULL(ROUND((Refacciones.IEPS/Reg.tipo_cambio), 2), 0) +
					   						    IFNULL(ROUND((Foraneos.IEPS/Reg.tipo_cambio), 2), 0)) AS ieps,
												Reg.forma_pago_id, CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
											FROM facturas_servicio AS Reg
											INNER JOIN clientes AS C ON  Reg.prospecto_id = C.prospecto_id
											INNER JOIN sat_forma_pago AS FP ON Reg.forma_pago_id = FP.forma_pago_id
											LEFT JOIN (SELECT factura_servicio_id, 
															  SUM(precio_unitario) AS Subtotal, 
															  SUM(ROUND(iva_unitario,2)) AS IVA, 
												      		  SUM(ROUND(ieps_unitario,2)) AS IEPS
									          		   FROM   facturas_servicio_mano_obra
									          		   GROUP BY factura_servicio_id) AS ManoObra ON Reg.factura_servicio_id = ManoObra.factura_servicio_id
											LEFT JOIN (SELECT factura_servicio_id, 
															  SUM(ROUND((precio_unitario * cantidad), 2)) AS Subtotal, 
												      		  SUM(ROUND((iva_unitario * cantidad), 2)) AS IVA, 
												      		  SUM(ROUND((ieps_unitario * cantidad), 2)) AS IEPS
											           FROM   facturas_servicio_otros
											           GROUP BY factura_servicio_id) AS Otros ON Reg.factura_servicio_id = Otros.factura_servicio_id
											LEFT JOIN (SELECT factura_servicio_id, 
															 SUM(ROUND((precio_unitario * cantidad), 2)) AS Subtotal, 
													         SUM(ROUND((iva_unitario * cantidad), 2)) AS IVA, 
													         SUM(ROUND((ieps_unitario * cantidad), 2)) AS IEPS
											           FROM   facturas_servicio_refacciones
											           GROUP BY factura_servicio_id) AS Refacciones ON Reg.factura_servicio_id = Refacciones.factura_servicio_id
											LEFT JOIN (SELECT factura_servicio_id, 
															 SUM(ROUND((precio_unitario * cantidad), 2)) AS Subtotal, 
												      		 SUM(ROUND((iva_unitario * cantidad), 2)) AS IVA, 
												      		 SUM(ROUND((ieps_unitario * cantidad), 2)) AS IEPS
											           FROM   facturas_servicio_trabajos_foraneos
											           GROUP BY factura_servicio_id) AS Foraneos ON Reg.factura_servicio_id = Foraneos.factura_servicio_id
											WHERE DATE_FORMAT(Reg.fecha, '%Y-%m-%d') = '$dteFecha'
											$strRestriccionesSucursales
											$strRestriccionesFormaPago
											AND Reg.condiciones_pago = 'CONTADO'
											AND Reg.moneda_id = $intMonedaID
											AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
											GROUP BY Reg.factura_servicio_id
											ORDER BY Reg.folio ASC");
		}
		else if($strTipo == 'FACTURAS CONCEPTOS')
		{
			$strSQL = $this->db->query("SELECT  CONCAT_WS(' - ', Reg.folio,  C.razon_social) AS concepto,
												(SUM(ROUND((Det.precio_unitario * Det.cantidad), 2)))  AS importe, 
												SUM(ROUND((Det.iva_unitario * Det.cantidad), 2)) AS iva,
												SUM(ROUND((Det.ieps_unitario * Det.cantidad), 2)) AS ieps,
											    Reg.forma_pago_id, 
											    CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
									FROM facturas_conceptos AS Reg
									INNER JOIN facturas_conceptos_detalles AS Det ON Det.factura_concepto_id = Reg.factura_concepto_id
									INNER JOIN clientes AS C ON  Reg.prospecto_id = C.prospecto_id
									INNER JOIN sat_forma_pago AS FP ON Reg.forma_pago_id = FP.forma_pago_id
									WHERE DATE_FORMAT(Reg.fecha, '%Y-%m-%d') = '$dteFecha'
									$strRestriccionesSucursales
									$strRestriccionesFormaPago
									AND Reg.condiciones_pago = 'CONTADO'
									AND Reg.moneda_id = $intMonedaID
									AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
									GROUP BY Reg.factura_concepto_id
									ORDER BY Reg.folio ASC");

		}
		else if($strTipo == 'ANTICIPOS')
		{
			$strSQL = $this->db->query("SELECT CONCAT_WS(' - ', Reg.folio, C.razon_social) AS concepto,
											 (ROUND((Reg.subtotal/Reg.tipo_cambio), 2)) AS importe,
											 (ROUND((Reg.iva/Reg.tipo_cambio), 2)) AS iva,
											 (ROUND((Reg.ieps/Reg.tipo_cambio), 2)) AS ieps,
											   Reg.forma_pago_id, 
											 CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
										FROM  anticipos AS Reg
										INNER JOIN clientes AS C ON  Reg.prospecto_id = C.prospecto_id
										INNER JOIN sat_forma_pago AS FP ON Reg.forma_pago_id = FP.forma_pago_id
										WHERE DATE_FORMAT(Reg.fecha, '%Y-%m-%d') = '$dteFecha'
										$strRestriccionesSucursales
										$strRestriccionesFormaPago
										AND Reg.moneda_id = $intMonedaID
										AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
										GROUP BY  Reg.anticipo_id
										ORDER BY Reg.folio ASC");
		}
		else if($strTipo == 'PAGOS MAQUINARIA')
		{
			$strSQL = $this->db->query("SELECT  CONCAT_WS(' - ', Reg.folio, PDR.folio,  C.razon_social) AS concepto,
											    SUM(ROUND((PDR.imp_pagado/PD.tipo_cambio),2)) AS importe, 
											   0 AS iva, 0 AS ieps,
											   PD.forma_pago_id,  
											   CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
									    FROM pagos AS Reg
									    INNER JOIN clientes AS C ON  Reg.prospecto_id = C.prospecto_id
									   	INNER JOIN pagos_detalles_02 AS PD ON Reg.pago_id = PD.pago_id
									   	INNER JOIN sat_forma_pago AS FP ON PD.forma_pago_id = FP.forma_pago_id
										INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PDR.pago_id = Reg.pago_id 
												   AND PDR.renglon_detalles = PD.renglon
									    INNER JOIN sat_monedas AS M ON PDR.moneda_tipo = M.codigo
									    WHERE PDR.tipo_referencia = 'MAQUINARIA'  
									    AND DATE_FORMAT(PD.fecha_pago, '%Y-%m-%d') = '$dteFecha'
									    $strRestriccionesSucursales
									    $strRestriccionesFormaPago
									    AND M.moneda_id = $intMonedaID
										AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
										GROUP BY Reg.pago_id, PD.renglon, PDR.renglon
										ORDER BY Reg.folio ASC");
		}
		else if($strTipo == 'PAGOS REFACCIONES')
		{
			$strSQL = $this->db->query("SELECT  CONCAT_WS(' - ', Reg.folio, PDR.folio,  C.razon_social) AS concepto,
											    SUM(ROUND((PDR.imp_pagado/PD.tipo_cambio),2)) AS importe, 
											   0 AS iva, 0 AS ieps,
											   PD.forma_pago_id,  
											   CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
									    FROM pagos AS Reg
									    INNER JOIN clientes AS C ON  Reg.prospecto_id = C.prospecto_id
									   	INNER JOIN pagos_detalles_02 AS PD ON Reg.pago_id = PD.pago_id
									   	INNER JOIN sat_forma_pago AS FP ON PD.forma_pago_id = FP.forma_pago_id
										INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PDR.pago_id = Reg.pago_id 
												   AND PDR.renglon_detalles = PD.renglon
									    INNER JOIN sat_monedas AS M ON PDR.moneda_tipo = M.codigo
									    WHERE PDR.tipo_referencia = 'REFACCIONES'  
									    AND DATE_FORMAT(PD.fecha_pago, '%Y-%m-%d') = '$dteFecha'
									    $strRestriccionesSucursales
									    $strRestriccionesFormaPago
									    AND M.moneda_id = $intMonedaID
										AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
										GROUP BY Reg.pago_id, PD.renglon, PDR.renglon
										ORDER BY Reg.folio ASC");
		}
		else if($strTipo == 'PAGOS SERVICIO')
		{
			$strSQL = $this->db->query("SELECT  CONCAT_WS(' - ', Reg.folio, PDR.folio,  C.razon_social) AS concepto,
											    SUM(ROUND((PDR.imp_pagado/PD.tipo_cambio),2)) AS importe, 
											   0 AS iva, 0 AS ieps,
											   PD.forma_pago_id,  
											   CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
									    FROM pagos AS Reg
									    INNER JOIN clientes AS C ON  Reg.prospecto_id = C.prospecto_id
									   	INNER JOIN pagos_detalles_02 AS PD ON Reg.pago_id = PD.pago_id
									   	INNER JOIN sat_forma_pago AS FP ON PD.forma_pago_id = FP.forma_pago_id
										INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PDR.pago_id = Reg.pago_id 
												   AND PDR.renglon_detalles = PD.renglon
									    INNER JOIN sat_monedas AS M ON PDR.moneda_tipo = M.codigo
									    WHERE PDR.tipo_referencia = 'SERVICIO'  
									    AND DATE_FORMAT(PD.fecha_pago, '%Y-%m-%d') = '$dteFecha'
									    $strRestriccionesSucursales
									    $strRestriccionesFormaPago
									    AND M.moneda_id = $intMonedaID
										AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
										GROUP BY Reg.pago_id, PD.renglon, PDR.renglon
										ORDER BY Reg.folio ASC");
		}
		else if($strTipo == 'PAGOS CONCEPTOS')
		{
			$strSQL = $this->db->query("SELECT  CONCAT_WS(' - ', Reg.folio, PDR.folio,  C.razon_social) AS concepto,
											    SUM(ROUND((PDR.imp_pagado/PD.tipo_cambio),2)) AS importe, 
											   0 AS iva, 0 AS ieps,
											   PD.forma_pago_id,  
											   CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
									    FROM pagos AS Reg
									    INNER JOIN clientes AS C ON  Reg.prospecto_id = C.prospecto_id
									   	INNER JOIN pagos_detalles_02 AS PD ON Reg.pago_id = PD.pago_id
									   	INNER JOIN sat_forma_pago AS FP ON PD.forma_pago_id = FP.forma_pago_id
										INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PDR.pago_id = Reg.pago_id 
												   AND PDR.renglon_detalles = PD.renglon
									    INNER JOIN sat_monedas AS M ON PDR.moneda_tipo = M.codigo
									    WHERE PDR.tipo_referencia = 'CONCEPTO'  
									    AND DATE_FORMAT(PD.fecha_pago, '%Y-%m-%d') = '$dteFecha'
									    $strRestriccionesSucursales
									    $strRestriccionesFormaPago
									    AND M.moneda_id = $intMonedaID
										AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
										GROUP BY Reg.pago_id, PD.renglon, PDR.renglon
										ORDER BY Reg.folio ASC");
		}
		else //PAGOS CARTERA
		{
			$strSQL = $this->db->query("SELECT  CONCAT_WS(' - ', Reg.folio, PDR.folio,  C.razon_social) AS concepto,
											    SUM(ROUND((PDR.imp_pagado/PD.tipo_cambio),2)) AS importe, 
											   0 AS iva, 0 AS ieps,
											   PD.forma_pago_id,  
											   CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago
									    FROM pagos AS Reg
									    INNER JOIN clientes AS C ON  Reg.prospecto_id = C.prospecto_id
									   	INNER JOIN pagos_detalles_02 AS PD ON Reg.pago_id = PD.pago_id
									   	INNER JOIN sat_forma_pago AS FP ON PD.forma_pago_id = FP.forma_pago_id
										INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PDR.pago_id = Reg.pago_id 
												   AND PDR.renglon_detalles = PD.renglon
									    INNER JOIN sat_monedas AS M ON PDR.moneda_tipo = M.codigo
									    WHERE PDR.tipo_referencia = 'CARTERA'  
									    AND DATE_FORMAT(PD.fecha_pago, '%Y-%m-%d') = '$dteFecha'
									    $strRestriccionesSucursales
									    $strRestriccionesFormaPago
									    AND M.moneda_id = $intMonedaID
										AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
										GROUP BY Reg.pago_id, PD.renglon, PDR.renglon
										ORDER BY Reg.folio ASC");
		}

		return $strSQL->result();
	}


	/*Método para regresar las facturas del cliente 
	  que coincidan con los criterios de búsqueda proporcionados*/
	public function buscar_facturas_importes($strOpcion = NULL, $dteFechaCorte = NULL, $intProspectoID =  NULL, 
											 $strFormulario = NULL, $intMonedaID = NULL, $intReferenciaID = NULL, 
											 $strTipoReferencia = NULL, $dteFechaInicial = NULL, 
										     $strSucursales = NULL, $strModulos = NULL, $intTasaCuotaIva = NULL, 
										     $intTasaCuotaIeps = NULL, $strTipoBusq = NULL)
	{


		//Constante para identificar al tipo de movimiento entrada de maquinaria por devolución de la factura
		$intMovDevMaq = ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA;
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución de la factura
		$intMovDevRef = ENTRADA_REFACCIONES_DEVOLUCION_FACTURA;
		//Constante para identificar el id de la tasa o cuota del impuesto de IVA
		$intTasaCuotaIDIva = SAT_TASA_CUOTA_IVA_ID;
		//Constante para identificar el método de pago: pago en parcialidades o diferido
		$intMetodoPagoIDPPD = METODO_PAGO_PPD;
		//Constante para identificar el método de pago: Pago en una sola exhibición
		$intMetodoPagoIDPUE = METODO_PAGO_BASE;
		//Variable que se utiliza para formar la  consulta
		$queryFacturas = '';
		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		//Prospecto
		$strRestriccionesProspecto = '';
		//Moneda
		$strRestriccionesMoneda = '';
		//Estatus
		$strRestriccionesEstatus = "(Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')";
		//ID del método de pago
		$strRestriccionesMetodoPago = '';
		//ID´s de las sucursales
		$strRestriccionesSucursales = '';
		//Modulos de la cartera
		$strRestriccionesModulos = '';
		//Modulo de maquinaria
		$strRestriccionModMaquinaria = '';
		//Modulo de refacciones
		$strRestriccionModRefacciones = '';
		//Modulo de servicio
		$strRestriccionModServicio = '';
		//Modulo de conceptos
		$strRestriccionModConceptos = '';
		//Fecha de corte
		$strRestriccionesRegFecha = '';
		$strRestriccionesCartFecha = '';
		$strRestriccionesPagoFecha = '';
		//ID de la referencia (factura)
		$strRestriccionesMaqReferenciaID = '';
		$strRestriccionesRefReferenciaID = '';
		$strRestriccionesServReferenciaID = '';
		$strRestriccionesConceptoReferenciaID = '';
		$strRestriccionesCartReferenciaID = '';

		//Gastos de paquetería
		$strRestriccionesGastosPaqueteria = '';
		//Gastos de servicio
		$strRestriccionesGastosServicio = '';
		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		//ID de la tasa o cuota del impuesto de IVA
		$strRestriccionesDetTasaCuotaIva = '';
		$strRestriccionesFDTasaCuotaIva = '';
		$strRestriccionesRegTasaCuotaIva = '';
		//Agrupar por tasa o cuota del impuesto de IVA
		$strAgruparTasaCuotaIva = '';
		//ID de la tasa o cuota del impuesto de IEPS
		$strRestriccionesDetTasaCuotaIeps = '';
		$strRestriccionesRegTasaCuotaIeps = '';

		//Variables que se utilizan para seleccionar los datos del gasto de servicio
		$strTotalGastosServicio = 0;
		$strSubtotalGastosServicio = 0;
		$strIvaGastosServicio = 0;
		//Variables que se utilizan para seleccionar los datos del gasto de paquetería
		$strTotalGastosPaqueteria = 0;
		$strSubtotalGastosPaqueteria = 0;
		$strIvaGastosPaqueteria = 0;


		//Variable que se utiliza para ordenar los registros dependiendo del tipo de búsqueda
		$strOrdenamiento = " ORDER BY ";

		//Si las facturas se van a mostrar en el grid view -> facturas que adeuda el cliente
		if($strFormulario !== NULL)
		{
			//Si el formulario (proceso) corresponde a un pago 
			if($strFormulario == 'PAGO')
			{
				$strRestriccionesMetodoPago .= " AND MP.metodo_pago_id = $intMetodoPagoIDPPD";
			}
			else if($strFormulario == 'NOTA CREDITO')//Si el formulario (proceso) corresponde a una nota de crédito digital 
			{
				$strRestriccionesEstatus = "Reg.estatus = 'ACTIVO'";
				$strRestriccionesMetodoPago .= " AND (MP.metodo_pago_id = $intMetodoPagoIDPPD OR 
													  MP.metodo_pago_id = $intMetodoPagoIDPUE)";
			}
			else//Si el formulario (proceso) corresponde a una póliza de abono o  recibo de ingreso
			{
				$strRestriccionesEstatus = "Reg.estatus = 'ACTIVO'";
				$strRestriccionesMetodoPago .= " AND MP.metodo_pago_id = $intMetodoPagoIDPUE";
			}
			
		}
		

		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			$strRestriccionesProspecto .= " AND C.prospecto_id = $intProspectoID";
		}

	    //Si existe id de la moneda
		if($intMonedaID > 0)
		{
			$strRestriccionesMoneda .= " AND M.moneda_id = $intMonedaID";
		}

		
		//Si existe rango de fechas
	    if($dteFechaInicial !== NULL && $dteFechaCorte !== NULL)
	    {
	   		$strRestriccionesRegFecha .= " AND DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaCorte'";
			$strRestriccionesCartFecha .= "DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaCorte'";
			$strRestriccionesPagoFecha .= " AND DATE_FORMAT(PD.fecha_pago, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaCorte'";
	    }
	    else
	    {
	    	//Si existe fecha de corte
			if($dteFechaCorte !== NULL)
			{
				$strRestriccionesRegFecha .= " AND DATE_FORMAT(Reg.fecha, '%Y-%m-%d') <= '$dteFechaCorte'";
				$strRestriccionesCartFecha .= "DATE_FORMAT(Reg.fecha, '%Y-%m-%d') <= '$dteFechaCorte'";
				$strRestriccionesPagoFecha .= " AND DATE_FORMAT(PD.fecha_pago, '%Y-%m-%d') <= '$dteFechaCorte'";

			}

			//Si existe fecha inicial 
			if($dteFechaInicial !== NULL)
			{
				$strRestriccionesRegFecha .= " AND DATE_FORMAT(Reg.fecha, '%Y-%m-%d') < '$dteFechaInicial'";
				$strRestriccionesCartFecha .= " DATE_FORMAT(Reg.fecha, '%Y-%m-%d') < '$dteFechaInicial'";
				$strRestriccionesPagoFecha .= " AND DATE_FORMAT(PD.fecha_pago, '%Y-%m-%d') < '$dteFechaInicial'";
			}
	    }


		//Si existe id de la referencia (factura)
		if($intReferenciaID !== NULL)
		{
			//Seleccionar todos los estatus
			$strRestriccionesEstatus = "(Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR'  
										 OR Reg.estatus = 'INACTIVO')";

			$strRestriccionesMaqReferenciaID = " AND Reg.factura_maquinaria_id = $intReferenciaID";
			$strRestriccionesRefReferenciaID = " AND Reg.factura_refacciones_id = $intReferenciaID";
		    $strRestriccionesServReferenciaID = " AND Reg.factura_servicio_id = $intReferenciaID";
		    $strRestriccionesConceptoReferenciaID = " AND Reg.factura_concepto_id = $intReferenciaID";
		    
		    //Si existe restricción de fecha
		    if($strRestriccionesCartFecha != '')
		    {
		    	//Concatenar condición AND
		    	$strRestriccionesCartReferenciaID = " AND ";

		    }

		    $strRestriccionesCartReferenciaID .= " Reg.cartera_id = $intReferenciaID";
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
				$strRestriccionesSucursales .= "Reg.sucursal_id = ".$arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}

		//Si existen modulos seleccionados
		if($strModulos)
		{
			//Generar las condiciones dinamicas de las consultas respecto a la columna modulo de la tabla cartera
			$strRestriccionesModulos .= " AND (";

			//Quitar | de la lista para obtener el modulo
			$arrModulos = explode("|", $strModulos);

			//Hacer recorrido para formar restricción con los modulos de la catera
			for ($intCon = 0; $intCon < sizeof($arrModulos); $intCon++) 
			{
				//Variable que se utiliza para asignar el modulo
				$strModulo = $arrModulos[$intCon];

				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otro modulo)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesModulos .= " OR ";
				}

				//Concatenar modulo para buscar datos en la tabla cartera
				$strRestriccionesModulos .= "Reg.modulo = "."'".$arrModulos[$intCon]."'";

				//Dependiendo del modulo asignar valor a la restricción que se utiliza para buscar datos de las facturas
				if($strModulo == 'MAQUINARIA')
				{
				   //Facturas de maquinaria
				   $strRestriccionModMaquinaria = $strModulo;
				}

				if($strModulo == 'REFACCIONES')
				{
					//Facturas de refacciones
					$strRestriccionModRefacciones = $strModulo;
				}
				
				if($strModulo == 'SERVICIO')
				{
					//Facturas de servicio
					$strRestriccionModServicio = $strModulo;
				}
				
				if($strModulo == 'CONCEPTOS')
				{
					//Facturas de conceptos
					$strRestriccionModConceptos = $strModulo;
				}
			}

			$strRestriccionesModulos .= ")";
		}

		//Si existe id de la tasa o cuota del impuesto de IVA
		if($intTasaCuotaIva !== NULL)
		{
			$strRestriccionesFDTasaCuotaIva  .= " WHERE  TIva.tasa_cuota_id = $intTasaCuotaIva";
			$strRestriccionesDetTasaCuotaIva  .= " AND TIva.tasa_cuota_id = $intTasaCuotaIva";
			$strAgruparTasaCuotaIva = ', TIva.tasa_cuota_id';
			
			//Si existe id de la tasa o cuota del impuesto de IEPS
			if($intTasaCuotaIeps !== NULL)
			{
			  	$strRestriccionesDetTasaCuotaIeps  .= " AND TIeps.tasa_cuota_id = $intTasaCuotaIeps";
			}
			else
			{
				$strRestriccionesDetTasaCuotaIeps  .= " AND TIeps.tasa_cuota_id IS NULL";
			}


			//Si se cumple la sentencia (Tasa cuota IVA 16% sin tasa de IEPS)	   							   	
			if($intTasaCuotaIva == $intTasaCuotaIDIva && $intTasaCuotaIeps == NULL)
			{ 
				//Seleccionar subtotal, iva e importe total del gastos de servicio
				$strTotalGastosServicio = "IFNULL(ROUND(((Reg.gastos_servicio + Reg.gastos_servicio_iva)/Reg.tipo_cambio), 2), 0)";
				$strSubtotalGastosServicio = "IFNULL(ROUND((Reg.gastos_servicio/Reg.tipo_cambio), 2), 0)";
				$strIvaGastosServicio =  "IFNULL(ROUND((Reg.gastos_servicio_iva/Reg.tipo_cambio), 2), 0)";

				//Seleccionar subtotal, iva e importe total del gastos de paquetería
				$strTotalGastosPaqueteria = "IFNULL(ROUND(((Reg.gastos_paqueteria + Reg.gastos_paqueteria_iva)/Reg.tipo_cambio), 2), 0)";
				$strSubtotalGastosPaqueteria = "IFNULL(ROUND((Reg.gastos_paqueteria/Reg.tipo_cambio), 2), 0)";
				$strIvaGastosPaqueteria = "IFNULL(ROUND((Reg.gastos_paqueteria_iva/Reg.tipo_cambio), 2), 0)";

			}//Cierre de verificación de la tasa de IVA 16%	   						   	


			//Considerar el gasto de paquetería por su tasa
			$strRestriccionesGastosPaqueteria .= " CASE 
														WHEN TIva.tasa_cuota_id = $intTasaCuotaIDIva THEN
															($strTotalGastosPaqueteria +
															 IFNULL(ROUND((Detalles.Importe/Reg.tipo_cambio), 2), 0))
													    ELSE
													    	IFNULL(ROUND((Detalles.Importe/Reg.tipo_cambio), 2), 0)
													    END AS Total,
													    CASE
														    WHEN TIva.tasa_cuota_id = $intTasaCuotaIDIva THEN
																($strSubtotalGastosPaqueteria +
																 IFNULL(ROUND((Detalles.Subtotal/Reg.tipo_cambio), 2), 0))
														    ELSE
														    	IFNULL(ROUND((Detalles.Subtotal/Reg.tipo_cambio), 2), 0)
														END AS Subtotal,
														CASE
														    WHEN TIva.tasa_cuota_id = $intTasaCuotaIDIva THEN
																($strIvaGastosPaqueteria +
																 IFNULL(ROUND((Detalles.IVA/Reg.tipo_cambio), 2), 0))
														    ELSE
														    	IFNULL(ROUND((Detalles.IVA/Reg.tipo_cambio), 2), 0)
														END AS IVA, ";


		    //Considerar el gasto de servicio por su tasa
			$strRestriccionesGastosServicio .= " CASE 
						   						     	WHEN TIva.tasa_cuota_id = $intTasaCuotaIDIva THEN
						   						   		 	($strTotalGastosServicio +  
						   						  		  	 IFNULL(ROUND((ManoObra.Importe/Reg.tipo_cambio), 2), 0) +
							   						  		 IFNULL(ROUND((Otros.Importe/Reg.tipo_cambio), 2), 0) +
							   						  		 IFNULL(ROUND((Refacciones.Importe/Reg.tipo_cambio), 2), 0) +
							   						  		 IFNULL(ROUND((Foraneos.Importe/Reg.tipo_cambio), 2), 0))
						   						  	 	ELSE
						   						  	 	 	(IFNULL(ROUND((ManoObra.Importe/Reg.tipo_cambio),2), 0) +
							   						  		 IFNULL(ROUND((Otros.Importe/Reg.tipo_cambio), 2), 0) +
							   						  		 IFNULL(ROUND((Refacciones.Importe/Reg.tipo_cambio), 2), 0) +
							   						  		 IFNULL(ROUND((Foraneos.Importe/Reg.tipo_cambio), 2), 0))
						   						   	END AS Total,
						   						   	CASE 
						   						     	WHEN TIva.tasa_cuota_id = $intTasaCuotaIDIva THEN
						   						   		 	($strSubtotalGastosServicio +  
						   						  		  	 IFNULL(ROUND((ManoObra.Subtotal/Reg.tipo_cambio), 2), 0) +
						   						  		  	 IFNULL(ROUND((Otros.Subtotal/Reg.tipo_cambio), 2), 0) +
							   						  		 IFNULL(ROUND((Refacciones.Subtotal/Reg.tipo_cambio), 2), 0) +
							   						  		 IFNULL(ROUND((Foraneos.Subtotal/Reg.tipo_cambio), 2), 0))
						   						  	 	ELSE
						   						  	 	 	(IFNULL(ROUND((ManoObra.Subtotal/Reg.tipo_cambio), 2), 0) +
						   						  		  	 IFNULL(ROUND((Otros.Subtotal/Reg.tipo_cambio), 2), 0) +
							   						  		 IFNULL(ROUND((Refacciones.Subtotal/Reg.tipo_cambio), 2), 0) +
							   						  		 IFNULL(ROUND((Foraneos.Subtotal/Reg.tipo_cambio), 2), 0))
						   						   	END AS Subtotal,
						   						   	CASE 
						   						     	WHEN TIva.tasa_cuota_id = $intTasaCuotaIDIva THEN
						   						   		 	($strIvaGastosServicio +  
						   						  		  	 IFNULL(ROUND((ManoObra.IVA/Reg.tipo_cambio), 2), 0) +
						   						  		  	 IFNULL(ROUND((Otros.IVA/Reg.tipo_cambio), 2), 0) +
							   						  		 IFNULL(ROUND((Refacciones.IVA/Reg.tipo_cambio), 2), 0) +
							   						  		 IFNULL(ROUND((Foraneos.IVA/Reg.tipo_cambio), 2), 0))
						   						  	 	ELSE
						   						  	 	 	(IFNULL(ROUND((ManoObra.IVA/Reg.tipo_cambio), 2), 0) +
						   						  		  	 IFNULL(ROUND((Otros.IVA/Reg.tipo_cambio), 2), 0) +
							   						  		 IFNULL(ROUND((Refacciones.IVA/Reg.tipo_cambio), 2), 0) +
							   						  		 IFNULL(ROUND((Foraneos.IVA/Reg.tipo_cambio), 2), 0))
						   						   	END AS IVA, ";


		}
		else
		{
			//Considerar el gasto de paquetería
			$strRestriccionesGastosPaqueteria = "(IFNULL(ROUND(((Reg.gastos_paqueteria + Reg.gastos_paqueteria_iva)/
																 Reg.tipo_cambio), 2), 0) +  
										          IFNULL(ROUND((Detalles.Importe/Reg.tipo_cambio), 2), 0)) AS Total, 
					   						  	 (IFNULL(ROUND((Reg.gastos_paqueteria/Reg.tipo_cambio), 2), 0) + 
             									  IFNULL(ROUND((Detalles.Subtotal/Reg.tipo_cambio), 2), 0)) AS Subtotal, 
					   						  	 (IFNULL(ROUND((Reg.gastos_paqueteria_iva/Reg.tipo_cambio), 2), 0) + 
		     									  IFNULL(ROUND((Detalles.IVA/Reg.tipo_cambio), 2), 0)) AS IVA, ";

		    //Considerar el gasto de servicio
		    $strRestriccionesGastosServicio = " (IFNULL(ROUND(((Reg.gastos_servicio + Reg.gastos_servicio_iva)/
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
				   						  	    IFNULL(ROUND((Foraneos.IVA/Reg.tipo_cambio), 2), 0)) AS IVA, ";
		}

		//Si el tipo de opción corresponde al reporte, significa que la información se va a mostrar en un reporte
		//de lo contrario se mostrará en el grid view -> facturas que adeuda el cliente
		if($strOpcion == 'reporte')
		{
			$strOrdenamiento .= "moneda_id, razon_social, fecha, folio";
		}
		else
		{
			$strOrdenamiento .= "fecha, folio";
		}


		//Variables para definir que tipos de módulo se incluiran en la búsqueda
		//Facturas de maquinaria
		$queryMaquinaria = "SELECT  Reg.factura_maquinaria_id AS referencia_id, Reg.sucursal_id,
								   'MAQUINARIA' AS modulo,
								   'MAQUINARIA' AS tipo_referencia, 
								   'FACTURA MAQUINARIA' AS tipo_referencia_cfdi,
									Reg.uuid, Reg.folio,  Reg.moneda_id, 
									M.codigo AS moneda_tipo, Reg.tipo_cambio, 
							        Reg.metodo_pago_id,  MP.codigo AS metodo_pago,
							        Reg.fecha, Reg.vencimiento  AS fecha_vencimiento,
									DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format,
									DATE_FORMAT(Reg.vencimiento, '%d/%m/%Y') AS fecha_vencimiento_format,
									C.prospecto_id, C.razon_social, 
									C.maquinaria_credito_dias AS dias_credito,
								    C.maquinaria_credito_limite AS limite_credito, 
								    'MAQUINARIA' AS referencia,
								    CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
								    CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) AS vendedor,
								  	(ROUND((Reg.precio/Reg.tipo_cambio), 2)) AS subtotal,
								    (ROUND((Reg.iva/Reg.tipo_cambio), 2)) AS iva,
								    (ROUND((Reg.ieps/Reg.tipo_cambio), 2)) AS ieps,
								    ((ROUND((Reg.precio/Reg.tipo_cambio), 2) + 
								      ROUND((Reg.iva/Reg.tipo_cambio), 2) + 
								      ROUND((Reg.ieps/Reg.tipo_cambio), 2))) AS importe,
								    (IFNULL(PagosMI.Total, 0) + 
								     IFNULL(PagosMD.Total, 0) + 
								     IFNULL(RecibosIngresoMI.Total,0) + 
								     IFNULL(RecibosIngresoMD.Total,0) + 
								     IFNULL(PolizasAbonoMI.Total, 0) +
								     IFNULL(PolizasAbonoMD.Total, 0) +
								     IFNULL(Devolucion.Total, 0) + 
								     IFNULL(NotasCreditoDigitalesMI.Total,0) +
								     IFNULL(NotasCreditoDigitalesMD.Total,0)) AS abonos,
								    (IFNULL(PagosMI.Parcialidades, 0) + 
								     IFNULL(PagosMD.Parcialidades, 0) + 
								     IFNULL(RecibosIngresoMI.Parcialidades, 0) + 
								     IFNULL(RecibosIngresoMD.Parcialidades, 0) + 
								     IFNULL(PolizasAbonoMI.Parcialidades, 0) + 
								     IFNULL(PolizasAbonoMD.Parcialidades, 0) + 
								     IFNULL(Devolucion.Parcialidades, 0) + 
								     IFNULL(NotasCreditoDigitalesMI.Parcialidades, 0) +
								     IFNULL(NotasCreditoDigitalesMD.Parcialidades, 0)) AS parcialidades,
								    (((ROUND((Reg.precio/Reg.tipo_cambio), 2) + 
								       ROUND((Reg.iva/Reg.tipo_cambio), 2) + 
								       ROUND((Reg.ieps/Reg.tipo_cambio), 2))) + 
								       IFNULL(NotasCargoMI.Total, 0) + 
								       IFNULL(NotasCargoMD.Total, 0) + 
								       IFNULL(NotasCargoDigitalesMI.Total, 0) + 
								       IFNULL(NotasCargoDigitalesMD.Total, 0) -
								       IFNULL(PagosMI.Total, 0) - 
								       IFNULL(PagosMD.Total, 0) - 
								       IFNULL(RecibosIngresoMI.Total, 0) - 
								       IFNULL(RecibosIngresoMD.Total, 0) -
								       IFNULL(PolizasAbonoMI.Total, 0) - 
								       IFNULL(PolizasAbonoMD.Total, 0) -
								       IFNULL(Devolucion.Total, 0) - 
								       IFNULL(NotasCreditoDigitalesMI.Total,0) -
								       IFNULL(NotasCreditoDigitalesMD.Total,0)) AS saldo,
								    (IFNULL(PagosMI.Total, 0) +  
							         IFNULL(PagosMD.Total, 0)) AS pagos, 
								    (((ROUND((Reg.precio/Reg.tipo_cambio), 2) + 
								       ROUND((Reg.iva/Reg.tipo_cambio), 2) +
								       ROUND((Reg.ieps/Reg.tipo_cambio), 2))) + 
								       IFNULL(NotasCargoMI.Total, 0) +
								       IFNULL(NotasCargoMD.Total, 0) +
								       IFNULL(NotasCargoDigitalesMI.Total, 0) + 
								       IFNULL(NotasCargoDigitalesMD.Total, 0) -
								       IFNULL(RecibosIngresoMI.Total, 0) - 
								       IFNULL(RecibosIngresoMD.Total, 0) - 
								       IFNULL(PolizasAbonoMI.Total, 0) -
								       IFNULL(PolizasAbonoMD.Total, 0) -
								       IFNULL(Devolucion.Total, 0) - 
								       IFNULL(NotasCreditoDigitalesMI.Total,0) -
								       IFNULL(NotasCreditoDigitalesMD.Total,0)) AS saldo_tasa
							FROM  facturas_maquinaria AS Reg
							INNER JOIN clientes  AS C ON  Reg.prospecto_id = C.prospecto_id
							INNER JOIN sat_monedas AS M ON Reg.moneda_id = M.moneda_id
							INNER JOIN sat_metodos_pago AS MP ON  Reg.metodo_pago_id = MP.metodo_pago_id
							INNER JOIN vendedores AS V ON Reg.vendedor_id =  V.vendedor_id
							INNER JOIN empleados AS E ON V.empleado_id =  E.empleado_id
							INNER JOIN sat_tasa_cuota AS TIva ON Reg.tasa_cuota_iva = TIva.tasa_cuota_id
						    LEFT JOIN sat_tasa_cuota AS TIeps ON Reg.tasa_cuota_ieps = TIeps.tasa_cuota_id
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
						                	  SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
										   		  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
						                  		  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
					   						  COUNT(Det.referencia_id) AS Parcialidades
					   				   FROM notas_cargo AS Reg
					   				   INNER JOIN notas_cargo_detalles AS Det ON Reg.nota_cargo_id = Det.nota_cargo_id
					   				 		 AND Det.referencia = 'MAQUINARIA'
					   				   INNER JOIN facturas_maquinaria AS FM ON Det.referencia_id = FM.factura_maquinaria_id 
					   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					   				   WHERE Reg.estatus = 'ACTIVO'
					   				   AND Reg.moneda_id = FM.moneda_id 
					   				   $strRestriccionesRegFecha
					   				   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS NotasCargoMI ON NotasCargoMI.referenciaID = Reg.factura_maquinaria_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
						    				  SUM(ROUND((Det.precio/FM.tipo_cambio), 2) + 
												  ROUND((Det.iva/FM.tipo_cambio), 2) + 
								                  ROUND((Det.ieps/FM.tipo_cambio), 2)) AS Total, 
					   						  COUNT(Det.referencia_id) AS Parcialidades
					   				   FROM notas_cargo AS Reg
					   				   INNER JOIN notas_cargo_detalles AS Det ON Reg.nota_cargo_id = Det.nota_cargo_id
					   				 		 AND Det.referencia = 'MAQUINARIA'
					   				   INNER JOIN facturas_maquinaria AS FM ON Det.referencia_id = FM.factura_maquinaria_id 
					   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					   				   WHERE Reg.estatus = 'ACTIVO'
					   				   AND Reg.moneda_id <>  FM.moneda_id 
					   				   $strRestriccionesRegFecha
					   				   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS NotasCargoMD ON NotasCargoMD.referenciaID = Reg.factura_maquinaria_id
						   	LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
					   						  SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
												  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								                  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
					   						  COUNT(Det.referencia_id) AS Parcialidades
					   				   FROM notas_cargo_digitales AS Reg
					   				   INNER JOIN notas_cargo_digitales_detalles AS Det ON Reg.nota_cargo_digital_id = Det.nota_cargo_digital_id
					   				   		AND Det.referencia = 'MAQUINARIA'
					   				   INNER JOIN facturas_maquinaria AS FM ON Det.referencia_id = FM.factura_maquinaria_id 
					   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					   				   WHERE  (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
					   				   AND Reg.moneda_id = FM.moneda_id 
					   				   $strRestriccionesRegFecha
					   				   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS NotasCargoDigitalesMI ON NotasCargoDigitalesMI.referenciaID = Reg.factura_maquinaria_id
						     	LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
					   						      SUM(ROUND((Det.precio/FM.tipo_cambio), 2) + 
												      ROUND((Det.iva/FM.tipo_cambio), 2) + 
								                  	  ROUND((Det.ieps/FM.tipo_cambio), 2)) AS Total, 
					   						      COUNT(Det.referencia_id) AS Parcialidades
					   				   FROM notas_cargo_digitales AS Reg
					   				   INNER JOIN notas_cargo_digitales_detalles AS Det ON Reg.nota_cargo_digital_id = Det.nota_cargo_digital_id
					   				   		AND Det.referencia = 'MAQUINARIA'
					   				   INNER JOIN facturas_maquinaria AS FM ON Det.referencia_id = FM.factura_maquinaria_id 
					   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					   				   WHERE  (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
					   				   AND Reg.moneda_id <> FM.moneda_id 
					   				   $strRestriccionesRegFecha
					   				   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS NotasCargoDigitalesMD ON NotasCargoDigitalesMD.referenciaID = Reg.factura_maquinaria_id
						   	LEFT JOIN (SELECT PDR.referencia_id AS referenciaID,
						   					  SUM(ROUND((PDR.imp_pagado/PD.tipo_cambio),2)) AS Total,
						   					  COUNT(PDR.renglon) AS Parcialidades
						   				FROM pagos AS P
						   				INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
						   				INNER JOIN pagos_detalles_relacionados_02 AS PDR ON P.pago_id = PDR.pago_id
									   		   AND PDR.renglon_detalles = PD.renglon AND PDR.tipo_referencia = 'MAQUINARIA'
									    INNER JOIN facturas_maquinaria AS FM ON PDR.referencia_id = FM.factura_maquinaria_id 
									    WHERE (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
									    AND   PD.moneda_id = FM.moneda_id 
									    $strRestriccionesPagoFecha
									    GROUP BY PDR.referencia_id) AS PagosMI ON PagosMI.referenciaID = Reg.factura_maquinaria_id
							LEFT JOIN (SELECT PDR.referencia_id AS referenciaID,
						   					  SUM(ROUND((PDR.imp_pagado/FM.tipo_cambio),2)) AS Total,
						   					  COUNT(PDR.renglon) AS Parcialidades
						   				FROM pagos AS P
						   				INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
						   				INNER JOIN pagos_detalles_relacionados_02 AS PDR ON P.pago_id = PDR.pago_id
									   		   AND PDR.renglon_detalles = PD.renglon AND PDR.tipo_referencia = 'MAQUINARIA'
									    INNER JOIN facturas_maquinaria AS FM ON PDR.referencia_id = FM.factura_maquinaria_id 
									    WHERE (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
									     AND   PD.moneda_id <> FM.moneda_id
									    $strRestriccionesPagoFecha
									    GROUP BY PDR.referencia_id) AS PagosMD ON PagosMD.referenciaID = Reg.factura_maquinaria_id
						    LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
						    				   SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
												   ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								                   ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
						    				   COUNT(Det.referencia_id) AS Parcialidades
						    		    FROM recibos_ingreso AS Reg
						    		    INNER JOIN recibos_ingreso_detalles AS Det ON Reg.recibo_ingreso_id = Det.recibo_ingreso_id AND Det.referencia = 'MAQUINARIA'
						    		    INNER JOIN facturas_maquinaria AS FM ON Det.referencia_id = FM.factura_maquinaria_id  
						    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		    WHERE Reg.estatus = 'ACTIVO'
						    		    AND  Reg.moneda_id = FM.moneda_id 
						    		    $strRestriccionesRegFecha
						    		    $strRestriccionesDetTasaCuotaIva
						    		   	$strRestriccionesDetTasaCuotaIeps
						                GROUP BY Det.referencia_id) AS RecibosIngresoMI ON RecibosIngresoMI.referenciaID = Reg.factura_maquinaria_id
						     LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
						    				    SUM(ROUND((Det.precio/FM.tipo_cambio), 2) + 
												    ROUND((Det.iva/FM.tipo_cambio), 2) + 
								                    ROUND((Det.ieps/FM.tipo_cambio), 2)) AS Total, 
						    				   COUNT(Det.referencia_id) AS Parcialidades
						    		    FROM recibos_ingreso AS Reg
						    		    INNER JOIN recibos_ingreso_detalles AS Det ON Reg.recibo_ingreso_id = Det.recibo_ingreso_id AND Det.referencia = 'MAQUINARIA'
						    		    INNER JOIN facturas_maquinaria AS FM ON Det.referencia_id = FM.factura_maquinaria_id  
						    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		    WHERE Reg.estatus = 'ACTIVO'
						    		    AND  Reg.moneda_id <> FM.moneda_id 
						    		    $strRestriccionesRegFecha
						    		    $strRestriccionesDetTasaCuotaIva
						    		   	$strRestriccionesDetTasaCuotaIeps
						                GROUP BY Det.referencia_id) AS RecibosIngresoMD ON RecibosIngresoMD.referenciaID = Reg.factura_maquinaria_id
						     LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
						    				    SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
													ROUND((Det.iva/Reg.tipo_cambio), 2) + 
									                ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total,  
						    				    COUNT(Det.referencia_id) AS Parcialidades
						    		    FROM polizas_abono_02 AS Reg
						    		    INNER JOIN polizas_abono_detalles_02 AS Det ON Reg.poliza_abono_id = Det.poliza_abono_id
						    		    	  AND Det.referencia = 'MAQUINARIA'
						    		    INNER JOIN facturas_maquinaria AS FM ON Det.referencia_id = FM.factura_maquinaria_id 
						    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		    WHERE Reg.estatus = 'ACTIVO'
						    		    AND  Reg.moneda_id = FM.moneda_id 
						    		    $strRestriccionesRegFecha
						    		    $strRestriccionesDetTasaCuotaIva
						    		   	$strRestriccionesDetTasaCuotaIeps
						                GROUP BY Det.referencia_id) AS PolizasAbonoMI ON PolizasAbonoMI.referenciaID = Reg.factura_maquinaria_id
						    LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
						    				   SUM(ROUND((Det.precio/FM.tipo_cambio), 2) + 
												   ROUND((Det.iva/FM.tipo_cambio), 2) + 
									               ROUND((Det.ieps/FM.tipo_cambio), 2)) AS Total,  
						    				    COUNT(Det.referencia_id) AS Parcialidades
						    		    FROM polizas_abono_02 AS Reg
						    		    INNER JOIN polizas_abono_detalles_02 AS Det ON Reg.poliza_abono_id = Det.poliza_abono_id
						    		    	  AND Det.referencia = 'MAQUINARIA'
						    		    INNER JOIN facturas_maquinaria AS FM ON Det.referencia_id = FM.factura_maquinaria_id 
						    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		    WHERE Reg.estatus = 'ACTIVO'
						    		     AND  Reg.moneda_id <> FM.moneda_id 
						    		    $strRestriccionesRegFecha
						    		    $strRestriccionesDetTasaCuotaIva
						    		   	$strRestriccionesDetTasaCuotaIeps
						                GROUP BY Det.referencia_id) AS PolizasAbonoMD ON PolizasAbonoMD.referenciaID = Reg.factura_maquinaria_id
						    LEFT JOIN (SELECT Reg.referencia_id AS referenciaID,
					   						  SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
												  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								                  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
					   						  COUNT(Reg.referencia_id) AS Parcialidades
					   				   FROM  movimientos_maquinaria AS Reg
					   				   INNER JOIN facturas_maquinaria AS Det ON Reg.referencia_id = Det.factura_maquinaria_id
					   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					   				   WHERE Reg.tipo_movimiento = $intMovDevMaq
					   				   AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
					   				   $strRestriccionesRegFecha
					   				   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Reg.referencia_id) AS Devolucion ON Devolucion.referenciaID = Reg.factura_maquinaria_id
							LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
						    				   SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
												   ROUND((Det.iva/Reg.tipo_cambio), 2) + 
									               ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
						    				    COUNT(Det.referencia_id) AS Parcialidades
							    		FROM notas_credito_digitales AS Reg
							    		INNER JOIN notas_credito_digitales_detalles AS Det ON Reg.nota_credito_digital_id = Det.nota_credito_digital_id
							    			  AND Det.referencia = 'MAQUINARIA'
							    	    INNER JOIN facturas_maquinaria AS FM ON Det.referencia_id = FM.factura_maquinaria_id 
							    	    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
							    		WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
							    		AND  Reg.moneda_id = FM.moneda_id 
							    		$strRestriccionesRegFecha
							    		$strRestriccionesDetTasaCuotaIva
							    		$strRestriccionesDetTasaCuotaIeps
							            GROUP BY Det.referencia_id) AS NotasCreditoDigitalesMI ON NotasCreditoDigitalesMI.referenciaID = Reg.factura_maquinaria_id
							LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
						    				   SUM(ROUND((Det.precio/FM.tipo_cambio), 2) + 
												   ROUND((Det.iva/FM.tipo_cambio), 2) + 
									               ROUND((Det.ieps/FM.tipo_cambio), 2)) AS Total, 
						    				    COUNT(Det.referencia_id) AS Parcialidades
							    		FROM notas_credito_digitales AS Reg
							    		INNER JOIN notas_credito_digitales_detalles AS Det ON Reg.nota_credito_digital_id = Det.nota_credito_digital_id
							    			  AND Det.referencia = 'MAQUINARIA'
							    	    INNER JOIN facturas_maquinaria AS FM ON Det.referencia_id = FM.factura_maquinaria_id 
							    	    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
							    		WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
							    		AND  Reg.moneda_id <> FM.moneda_id 
							    		$strRestriccionesRegFecha
							    		$strRestriccionesDetTasaCuotaIva
							    		$strRestriccionesDetTasaCuotaIeps
							            GROUP BY Det.referencia_id) AS NotasCreditoDigitalesMD ON NotasCreditoDigitalesMD.referenciaID = Reg.factura_maquinaria_id
						    WHERE $strRestriccionesEstatus
						    $strRestriccionesRegFecha
						    $strRestriccionesSucursales 
						    $strRestriccionesMaqReferenciaID
						    $strRestriccionesMetodoPago
						    $strRestriccionesMoneda
							$strRestriccionesProspecto
							$strRestriccionesDetTasaCuotaIva
							$strRestriccionesDetTasaCuotaIeps";

		//Facturas de refacciones
		$queryRefacciones = "SELECT Reg.factura_refacciones_id AS referencia_id, Reg.sucursal_id,
							        'REFACCIONES' AS modulo, 
							 		'REFACCIONES' AS tipo_referencia, 
							 		'FACTURA REFACCIONES' AS tipo_referencia_cfdi,
									Reg.uuid, Reg.folio, Reg.moneda_id, 
									M.codigo AS moneda_tipo, Reg.tipo_cambio, 
						        	Reg.metodo_pago_id, MP.codigo AS metodo_pago, 
						        	Reg.fecha, Reg.vencimiento  AS fecha_vencimiento,
									DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format,
									DATE_FORMAT(Reg.vencimiento, '%d/%m/%Y') AS fecha_vencimiento_format,
									C.prospecto_id,  C.razon_social, 
									C.refacciones_credito_dias AS dias_credito,
							    	C.refacciones_credito_limite AS limite_credito, 
							    	'REFACCIONES' AS referencia,
							    	CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
							    	CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) AS vendedor,
							    	(RefaccionesDetalles.Subtotal) AS subtotal,
							        (RefaccionesDetalles.IVA) AS iva,
							        (RefaccionesDetalles.IEPS) AS ieps,
							        (RefaccionesDetalles.Total) AS importe,
							        (IFNULL(PagosMI.Total, 0) +
							         IFNULL(PagosMD.Total, 0) +
					   			 	 IFNULL(RecibosIngresoMI.Total, 0) +
					   			 	 IFNULL(RecibosIngresoMD.Total, 0) +
					   			  	 IFNULL(PolizasAbonoMI.Total, 0) + 
					   			  	 IFNULL(PolizasAbonoMD.Total, 0) + 
					   			  	 IFNULL(Devolucion.Total, 0) +
					   			  	 IFNULL(NotasCreditoDigitalesMI.Total, 0) +
					   			  	 IFNULL(NotasCreditoDigitalesMD.Total, 0)) AS abonos,
					   			    (IFNULL(PagosMI.Parcialidades, 0) +
					   			     IFNULL(PagosMD.Parcialidades, 0) +
					   			 	 IFNULL(RecibosIngresoMI.Parcialidades, 0) +
					   			 	 IFNULL(RecibosIngresoMD.Parcialidades, 0) +
					   			  	 IFNULL(PolizasAbonoMI.Parcialidades, 0) + 
					   			  	 IFNULL(PolizasAbonoMD.Parcialidades, 0) + 
					   			  	 IFNULL(Devolucion.Parcialidades, 0) +
					   			  	 IFNULL(NotasCreditoDigitalesMI.Parcialidades, 0) +
					   			  	 IFNULL(NotasCreditoDigitalesMD.Parcialidades, 0)) AS parcialidades,
					   			    (((RefaccionesDetalles.Total) + 
							          IFNULL(NotasCargoMI.Total, 0) + 
							          IFNULL(NotasCargoMD.Total, 0) +
							          IFNULL(NotasCargoDigitalesMI.Total, 0) +
							          IFNULL(NotasCargoDigitalesMD.Total, 0) - 
							          IFNULL(PagosMI.Total, 0) - 
							          IFNULL(PagosMD.Total, 0) - 
							          IFNULL(RecibosIngresoMI.Total, 0) - 
							          IFNULL(RecibosIngresoMD.Total, 0) - 
							          IFNULL(PolizasAbonoMI.Total, 0) - 
							          IFNULL(PolizasAbonoMD.Total, 0) -
							          IFNULL(Devolucion.Total, 0) - 
							          IFNULL(NotasCreditoDigitalesMI.Total, 0) -
							          IFNULL(NotasCreditoDigitalesMD.Total, 0))) AS saldo,
							         (IFNULL(PagosMI.Total, 0) +  
							          IFNULL(PagosMD.Total, 0)) AS pagos, 
							        (((RefaccionesDetalles.Total) + 
							          IFNULL(NotasCargoMI.Total, 0) + 
							          IFNULL(NotasCargoMD.Total, 0) + 
							          IFNULL(NotasCargoDigitalesMI.Total, 0) +
							          IFNULL(NotasCargoDigitalesMD.Total, 0) - 
							          IFNULL(RecibosIngresoMI.Total, 0) - 
							          IFNULL(RecibosIngresoMD.Total, 0) - 
							          IFNULL(PolizasAbonoMI.Total, 0) -
							          IFNULL(PolizasAbonoMD.Total, 0) - 
							          IFNULL(Devolucion.Total, 0) - 
							          IFNULL(NotasCreditoDigitalesMI.Total, 0) -
							          IFNULL(NotasCreditoDigitalesMD.Total, 0))) AS saldo_tasa
							FROM facturas_refacciones AS Reg
							INNER JOIN clientes C ON C.prospecto_id = Reg.prospecto_id
							INNER JOIN sat_monedas AS M ON Reg.moneda_id = M.moneda_id
							INNER JOIN sat_metodos_pago AS MP ON  Reg.metodo_pago_id = MP.metodo_pago_id
							INNER JOIN vendedores AS V ON Reg.vendedor_id =  V.vendedor_id
							INNER JOIN empleados AS E ON V.empleado_id =  E.empleado_id
							INNER JOIN (SELECT Reg.factura_refacciones_id AS referenciaID,
					   						   $strRestriccionesGastosPaqueteria
											   IFNULL(ROUND((Detalles.IEPS/Reg.tipo_cambio), 2), 0) AS IEPS
					   					FROM facturas_refacciones AS Reg
					   					LEFT JOIN sat_tasa_cuota AS TIva ON TIva.tasa_cuota_id = $intTasaCuotaIDIva 
				   					       AND Reg.gastos_paqueteria_iva > 0			
					   					LEFT JOIN (SELECT Det.factura_refacciones_id,
					   									  SUM(ROUND((Det.precio_unitario * Det.cantidad), 2) + 
								   						  	  ROUND((Det.iva_unitario * Det.cantidad), 2) + 
								   						  	  ROUND((Det.ieps_unitario * Det.cantidad), 2)) AS Importe,
							   						  	  SUM(ROUND((Det.precio_unitario * Det.cantidad), 2)) AS Subtotal, 
												     	  SUM(ROUND((Det.iva_unitario * Det.cantidad), 2)) AS IVA, 
												      	  SUM(ROUND((Det.ieps_unitario * Det.cantidad), 2)) AS IEPS
					   							    FROM facturas_refacciones_detalles AS Det
								   					LEFT JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
								   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
								   				    $strRestriccionesFDTasaCuotaIva
									  				$strRestriccionesDetTasaCuotaIeps
									  				GROUP BY Det.factura_refacciones_id) AS Detalles 
									  				ON Reg.factura_refacciones_id = Detalles.factura_refacciones_id
									  				) AS RefaccionesDetalles ON RefaccionesDetalles.referenciaID = Reg.factura_refacciones_id
					   		LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
								              SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
												  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								                  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total,
					   						  COUNT(Det.referencia_id) AS Parcialidades
					   				   FROM notas_cargo AS Reg
					   				   INNER JOIN notas_cargo_detalles AS Det ON Reg.nota_cargo_id = Det.nota_cargo_id
					   				   		 AND Det.referencia = 'REFACCIONES'
					   				   INNER JOIN facturas_refacciones AS FR ON Det.referencia_id = FR.factura_refacciones_id  
					   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					   				   WHERE  Reg.estatus = 'ACTIVO'
					   				   AND Reg.moneda_id = FR.moneda_id
					   				   $strRestriccionesRegFecha
					   				   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS NotasCargoMI ON NotasCargoMI.referenciaID = Reg.factura_refacciones_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
					   						  SUM(ROUND((Det.precio/FR.tipo_cambio), 2) + 
												  ROUND((Det.iva/FR.tipo_cambio), 2) + 
								                  ROUND((Det.ieps/FR.tipo_cambio), 2)) AS Total,
					   						  COUNT(Det.referencia_id) AS Parcialidades
					   				   FROM notas_cargo AS Reg
					   				   INNER JOIN notas_cargo_detalles AS Det ON Reg.nota_cargo_id = Det.nota_cargo_id
					   				   		 AND Det.referencia = 'REFACCIONES'
					   				   INNER JOIN facturas_refacciones AS FR ON Det.referencia_id = FR.factura_refacciones_id  
					   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					   				   WHERE  Reg.estatus = 'ACTIVO'
					   				   AND Reg.moneda_id <> FR.moneda_id
					   				   $strRestriccionesRegFecha
					   				   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS NotasCargoMD ON NotasCargoMD.referenciaID = Reg.factura_refacciones_id
						   	LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
					   						  SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
												  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								                  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total,
					   						  COUNT(Det.referencia_id) AS Parcialidades
					   				   FROM notas_cargo_digitales AS Reg
					   				   INNER JOIN notas_cargo_digitales_detalles AS Det ON Reg.nota_cargo_digital_id = Det.nota_cargo_digital_id
					   				   		 AND Det.referencia = 'REFACCIONES'
					   				   INNER JOIN facturas_refacciones AS FR ON Det.referencia_id = FR.factura_refacciones_id 
					   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					   				   WHERE  (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
					   				   AND Reg.moneda_id = FR.moneda_id
					   				   $strRestriccionesRegFecha
					   				   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS NotasCargoDigitalesMI ON NotasCargoDigitalesMI.referenciaID = Reg.factura_refacciones_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
					   						  SUM(ROUND((Det.precio/FR.tipo_cambio), 2) + 
												  ROUND((Det.iva/FR.tipo_cambio), 2) + 
								                  ROUND((Det.ieps/FR.tipo_cambio), 2)) AS Total,
					   						  COUNT(Det.referencia_id) AS Parcialidades
					   				   FROM notas_cargo_digitales AS Reg
					   				   INNER JOIN notas_cargo_digitales_detalles AS Det ON Reg.nota_cargo_digital_id = Det.nota_cargo_digital_id
					   				   		 AND Det.referencia = 'REFACCIONES'
					   				   INNER JOIN facturas_refacciones AS FR ON Det.referencia_id = FR.factura_refacciones_id 
					   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					   				   WHERE  (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
					   				   AND Reg.moneda_id <> FR.moneda_id
					   				   $strRestriccionesRegFecha
					   				   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS NotasCargoDigitalesMD ON NotasCargoDigitalesMD.referenciaID = Reg.factura_refacciones_id
							LEFT JOIN (SELECT PDR.referencia_id AS referenciaID,
						   					  SUM(ROUND((PDR.imp_pagado/PD.tipo_cambio),2)) AS Total,
						   					  COUNT(PDR.renglon) AS Parcialidades
						   				FROM pagos AS P
						   				INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
						   				INNER JOIN pagos_detalles_relacionados_02 AS PDR ON P.pago_id = PDR.pago_id
									   		   AND PDR.renglon_detalles = PD.renglon AND PDR.tipo_referencia = 'REFACCIONES'
									    INNER JOIN facturas_refacciones AS FR ON PDR.referencia_id = FR.factura_refacciones_id 
									    WHERE (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
									    AND   PD.moneda_id = FR.moneda_id 
									    $strRestriccionesPagoFecha
									    GROUP BY PDR.referencia_id) AS PagosMI ON PagosMI.referenciaID = Reg.factura_refacciones_id
						    LEFT JOIN (SELECT PDR.referencia_id AS referenciaID,
						   					  SUM(ROUND((PDR.imp_pagado/FR.tipo_cambio),2)) AS Total,
						   					  COUNT(PDR.renglon) AS Parcialidades
						   				FROM pagos AS P
						   				INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
						   				INNER JOIN pagos_detalles_relacionados_02 AS PDR ON P.pago_id = PDR.pago_id
									   		   AND PDR.renglon_detalles = PD.renglon AND PDR.tipo_referencia = 'REFACCIONES'
									   	INNER JOIN facturas_refacciones AS FR ON PDR.referencia_id = FR.factura_refacciones_id 
									    WHERE (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
									    AND   PD.moneda_id <> FR.moneda_id 
									    $strRestriccionesPagoFecha
									    GROUP BY PDR.referencia_id) AS PagosMD ON PagosMD.referenciaID = Reg.factura_refacciones_id
						    LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
						    				   SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
												   ROUND((Det.iva/Reg.tipo_cambio), 2) + 
									               ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total,
						    				   COUNT(Det.referencia_id) AS Parcialidades
						    		    FROM recibos_ingreso AS Reg
						    		    INNER JOIN recibos_ingreso_detalles AS Det ON Reg.recibo_ingreso_id = Det.recibo_ingreso_id
						    		    	AND Det.referencia = 'REFACCIONES'
						    		    INNER JOIN facturas_refacciones AS FR ON Det.referencia_id = FR.factura_refacciones_id 
						    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		    WHERE Reg.estatus = 'ACTIVO'
						    		    AND  Reg.moneda_id = FR.moneda_id 
						    		    $strRestriccionesRegFecha
						    		    $strRestriccionesDetTasaCuotaIva
						    		   	$strRestriccionesDetTasaCuotaIeps
						                GROUP BY Det.referencia_id) AS RecibosIngresoMI ON RecibosIngresoMI.referenciaID = Reg.factura_refacciones_id
						     LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
						    				    SUM(ROUND((Det.precio/FR.tipo_cambio), 2) + 
													ROUND((Det.iva/FR.tipo_cambio), 2) + 
									                ROUND((Det.ieps/FR.tipo_cambio), 2)) AS Total,
						    				    COUNT(Det.referencia_id) AS Parcialidades
						    		    FROM recibos_ingreso AS Reg
						    		    INNER JOIN recibos_ingreso_detalles AS Det ON Reg.recibo_ingreso_id = Det.recibo_ingreso_id
						    		    	AND Det.referencia = 'REFACCIONES'
						    		    INNER JOIN facturas_refacciones AS FR ON Det.referencia_id = FR.factura_refacciones_id 
						    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		    WHERE Reg.estatus = 'ACTIVO'
						    		    AND  Reg.moneda_id <> FR.moneda_id 
						    		    $strRestriccionesRegFecha
						    		    $strRestriccionesDetTasaCuotaIva
						    		   	$strRestriccionesDetTasaCuotaIeps
						                GROUP BY Det.referencia_id) AS RecibosIngresoMD ON RecibosIngresoMD.referenciaID = Reg.factura_refacciones_id
						     LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
						    				    SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
													ROUND((Det.iva/Reg.tipo_cambio), 2) + 
									                ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
						    				    COUNT(Det.referencia_id) AS Parcialidades
						    		    FROM polizas_abono_02 AS Reg
						    		    INNER JOIN polizas_abono_detalles_02 AS Det ON Reg.poliza_abono_id = Det.poliza_abono_id
						    		    	  AND Det.referencia = 'REFACCIONES'
						    		    INNER JOIN facturas_refacciones AS FR ON Det.referencia_id = FR.factura_refacciones_id 
						    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		    WHERE Reg.estatus = 'ACTIVO'
						    		    AND  Reg.moneda_id = FR.moneda_id 
						    		    $strRestriccionesRegFecha
						    		    $strRestriccionesDetTasaCuotaIva
						    		   	$strRestriccionesDetTasaCuotaIeps
						                GROUP BY Det.referencia_id) AS PolizasAbonoMI ON PolizasAbonoMI.referenciaID = Reg.factura_refacciones_id
						    LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
						    				   SUM(ROUND((Det.precio/FR.tipo_cambio), 2) + 
												   ROUND((Det.iva/FR.tipo_cambio), 2) + 
									               ROUND((Det.ieps/FR.tipo_cambio), 2)) AS Total, 
						    				   COUNT(Det.referencia_id) AS Parcialidades
						    		    FROM polizas_abono_02 AS Reg
						    		    INNER JOIN polizas_abono_detalles_02 AS Det ON Reg.poliza_abono_id = Det.poliza_abono_id
						    		    	  AND Det.referencia = 'REFACCIONES'
						    		    INNER JOIN facturas_refacciones AS FR ON Det.referencia_id = FR.factura_refacciones_id 
						    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		    WHERE Reg.estatus = 'ACTIVO'
						    		    AND  Reg.moneda_id <> FR.moneda_id 
						    		    $strRestriccionesRegFecha
						    		    $strRestriccionesDetTasaCuotaIva
						    		   	$strRestriccionesDetTasaCuotaIeps
						                GROUP BY Det.referencia_id) AS PolizasAbonoMD ON PolizasAbonoMD.referenciaID = Reg.factura_refacciones_id
						    LEFT JOIN (SELECT Reg.referencia_id AS referenciaID,
					   						  SUM(ROUND(((Det.precio_unitario * RD.cantidad)/Reg.tipo_cambio), 2) + 
			   						  	   		  ROUND(((Det.iva_unitario * RD.cantidad)/Reg.tipo_cambio), 2) + 
			   						  	  		  ROUND(((Det.ieps_unitario * RD.cantidad)/Reg.tipo_cambio), 2)) AS Total,
					   						  COUNT(Reg.referencia_id) AS Parcialidades
					   				   FROM  movimientos_refacciones AS Reg
					   				   INNER JOIN movimientos_refacciones_detalles AS RD ON Reg.movimiento_refacciones_id = RD.movimiento_refacciones_id
					   				   INNER JOIN facturas_refacciones AS FR ON FR.factura_refacciones_id = Reg.referencia_id
									   INNER JOIN facturas_refacciones_detalles AS Det ON FR.factura_refacciones_id = Det.factura_refacciones_id AND Det.refaccion_id = RD.refaccion_id AND Det.renglon = RD.renglon
					   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					   				   WHERE Reg.tipo_movimiento = $intMovDevRef
					   				   AND Reg.tipo_referencia = 'REFACCIONES'
					   				   AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
					   				   $strRestriccionesRegFecha
					   				   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Reg.referencia_id) AS Devolucion ON Devolucion.referenciaID = Reg.factura_refacciones_id
							 LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
						    				    SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
													ROUND((Det.iva/Reg.tipo_cambio), 2) + 
									                ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
						    				   COUNT(Det.referencia_id) AS Parcialidades
							    		FROM notas_credito_digitales AS Reg
							    		INNER JOIN notas_credito_digitales_detalles AS Det ON Reg.nota_credito_digital_id = Det.nota_credito_digital_id
							    			  AND Det.referencia = 'REFACCIONES'
							    		INNER JOIN facturas_refacciones AS FR ON Det.referencia_id = FR.factura_refacciones_id 
							    	    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
							    		WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
							    		AND  Reg.moneda_id = FR.moneda_id 
							    		$strRestriccionesRegFecha
							    		$strRestriccionesDetTasaCuotaIva
							    		$strRestriccionesDetTasaCuotaIeps
							            GROUP BY Det.referencia_id) AS NotasCreditoDigitalesMI ON NotasCreditoDigitalesMI.referenciaID = Reg.factura_refacciones_id
							    LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
						    				       SUM(ROUND((Det.precio/FR.tipo_cambio), 2) + 
													   ROUND((Det.iva/FR.tipo_cambio), 2) + 
									                   ROUND((Det.ieps/FR.tipo_cambio), 2)) AS Total, 
						    				       COUNT(Det.referencia_id) AS Parcialidades
							    		FROM notas_credito_digitales AS Reg
							    		INNER JOIN notas_credito_digitales_detalles AS Det ON Reg.nota_credito_digital_id = Det.nota_credito_digital_id
							    			  AND Det.referencia = 'REFACCIONES'
							    		INNER JOIN facturas_refacciones AS FR ON Det.referencia_id = FR.factura_refacciones_id 
							    	    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
							    		WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
							    		AND  Reg.moneda_id <> FR.moneda_id 
							    		$strRestriccionesRegFecha
							    		$strRestriccionesDetTasaCuotaIva
							    		$strRestriccionesDetTasaCuotaIeps
							            GROUP BY Det.referencia_id) AS NotasCreditoDigitalesMD ON NotasCreditoDigitalesMD.referenciaID = Reg.factura_refacciones_id
							WHERE $strRestriccionesEstatus
							$strRestriccionesRegFecha
							$strRestriccionesSucursales
							$strRestriccionesRefReferenciaID
						    $strRestriccionesMetodoPago
						    $strRestriccionesMoneda
							$strRestriccionesProspecto";

		//Facturas de servicio
		$queryServicio = "SELECT Reg.factura_servicio_id AS referencia_id, Reg.sucursal_id,
								 'SERVICIO' AS modulo,
								 'SERVICIO' AS tipo_referencia,
								 'FACTURA SERVICIO' AS tipo_referencia_cfdi,
							     Reg.uuid, Reg.folio, Reg.moneda_id, 
							     M.codigo AS moneda_tipo, Reg.tipo_cambio, 
							     Reg.metodo_pago_id, MP.codigo AS metodo_pago,
							     Reg.fecha, Reg.vencimiento  AS fecha_vencimiento,
							     DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format,
							     DATE_FORMAT(Reg.vencimiento, '%d/%m/%Y') AS fecha_vencimiento_format,
							     C.prospecto_id, C.razon_social, 
							     C.servicio_credito_dias AS dias_credito,
							     C.servicio_credito_limite AS limite_credito,  
							     'SERVICIO' AS referencia,
							     CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
							     '' AS vendedor,
							     (ServicioDetalles.Subtotal) AS subtotal,
						         (ServicioDetalles.IVA) AS iva,
						         (ServicioDetalles.IEPS) AS ieps,
						         (ServicioDetalles.Total) AS importe,
						         (IFNULL(PagosMI.Total, 0) +
						          IFNULL(PagosMD.Total, 0) +
				   			 	  IFNULL(RecibosIngresoMI.Total, 0) +
				   			 	  IFNULL(RecibosIngresoMD.Total, 0) +
				   			  	  IFNULL(PolizasAbonoMI.Total, 0) + 
				   			  	  IFNULL(PolizasAbonoMD.Total, 0) + 
				   			  	  IFNULL(Devolucion.Total, 0) +
				   			  	  IFNULL(NotasCreditoServicio.Total, 0) +
				   			  	  IFNULL(NotasCreditoDigitalesMI.Total, 0) +
				   			  	  IFNULL(NotasCreditoDigitalesMD.Total, 0)) AS abonos,
				   			    (IFNULL(PagosMI.Parcialidades, 0) +
				   			     IFNULL(PagosMD.Parcialidades, 0) +
				   			 	 IFNULL(RecibosIngresoMI.Parcialidades, 0) +
				   			 	 IFNULL(RecibosIngresoMD.Parcialidades, 0) +
				   			  	 IFNULL(PolizasAbonoMI.Parcialidades, 0) + 
				   			  	 IFNULL(PolizasAbonoMD.Parcialidades, 0) + 
				   			  	 IFNULL(Devolucion.Parcialidades, 0) +
				   			  	 IFNULL(NotasCreditoServicio.Parcialidades, 0) +
				   			  	 IFNULL(NotasCreditoDigitalesMI.Parcialidades, 0) +
				   			  	 IFNULL(NotasCreditoDigitalesMD.Parcialidades, 0)) AS parcialidades,
				   			    (((ServicioDetalles.Total) + 
						          IFNULL(NotasCargoMI.Total, 0) + 
						          IFNULL(NotasCargoMD.Total, 0) + 
						          IFNULL(NotasCargoDigitalesMI.Total, 0) + 
						          IFNULL(NotasCargoDigitalesMD.Total, 0) -
						          IFNULL(PagosMI.Total, 0) - 
						          IFNULL(PagosMD.Total, 0) - 
						          IFNULL(RecibosIngresoMI.Total, 0) - 
						          IFNULL(RecibosIngresoMD.Total, 0) - 
						          IFNULL(PolizasAbonoMI.Total, 0) - 
						          IFNULL(PolizasAbonoMD.Total, 0) - 
						          IFNULL(Devolucion.Total, 0) - 
						          IFNULL(NotasCreditoServicio.Total, 0) -
						          IFNULL(NotasCreditoDigitalesMI.Total, 0) -
						          IFNULL(NotasCreditoDigitalesMD.Total, 0))) AS saldo,
						        (IFNULL(PagosMI.Total, 0) +  
							     IFNULL(PagosMD.Total, 0)) AS pagos, 
						        (((ServicioDetalles.Total) + 
						         IFNULL(NotasCargoMI.Total, 0) + 
						         IFNULL(NotasCargoMD.Total, 0) + 
						         IFNULL(NotasCargoDigitalesMI.Total, 0) + 
						         IFNULL(NotasCargoDigitalesMD.Total, 0) - 
						         IFNULL(RecibosIngresoMI.Total, 0) - 
						         IFNULL(RecibosIngresoMD.Total, 0) - 
						         IFNULL(PolizasAbonoMI.Total, 0) - 
						         IFNULL(PolizasAbonoMD.Total, 0) - 
						         IFNULL(Devolucion.Total, 0) - 
						         IFNULL(NotasCreditoServicio.Total, 0) -
						         IFNULL(NotasCreditoDigitalesMI.Total, 0) -
						         IFNULL(NotasCreditoDigitalesMD.Total, 0))) AS saldo_tasa
						  FROM facturas_servicio AS Reg
						  INNER JOIN clientes C ON C.prospecto_id = Reg.prospecto_id
						  INNER JOIN sat_monedas AS M ON Reg.moneda_id = M.moneda_id
						  INNER JOIN sat_metodos_pago AS MP ON  Reg.metodo_pago_id = MP.metodo_pago_id
						  INNER JOIN (SELECT Reg.factura_servicio_id AS referenciaID,
				   						   $strRestriccionesGastosServicio
				   						   (IFNULL(ROUND((ManoObra.IEPS/Reg.tipo_cambio), 2), 0) +
				   						    IFNULL(ROUND((Otros.IEPS/Reg.tipo_cambio), 2), 0) + 
				   						    IFNULL(ROUND((Refacciones.IEPS/Reg.tipo_cambio), 2), 0) +
				   						    IFNULL(ROUND((Foraneos.IEPS/Reg.tipo_cambio), 2), 0)) AS IEPS
				   					 FROM facturas_servicio AS Reg
				   					 LEFT JOIN sat_tasa_cuota AS TIva ON TIva.tasa_cuota_id = $intTasaCuotaIDIva 
				   					       AND Reg.gastos_servicio_iva > 0
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
									           $strRestriccionesFDTasaCuotaIva
						    				   $strRestriccionesDetTasaCuotaIeps
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
									           $strRestriccionesFDTasaCuotaIva
						    				   $strRestriccionesDetTasaCuotaIeps
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
									           $strRestriccionesFDTasaCuotaIva
						    				   $strRestriccionesDetTasaCuotaIeps
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
									           $strRestriccionesFDTasaCuotaIva
						    				   $strRestriccionesDetTasaCuotaIeps
									           GROUP BY  Det.factura_servicio_id) AS Foraneos ON Reg.factura_servicio_id = Foraneos.factura_servicio_id) AS ServicioDetalles ON ServicioDetalles.referenciaID = Reg.factura_servicio_id
				   		LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
				   						  SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
										      ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								              ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
				   						  COUNT(Det.referencia_id) AS Parcialidades
				   				   FROM notas_cargo AS Reg
				   				   INNER JOIN notas_cargo_detalles AS Det ON Reg.nota_cargo_id = Det.nota_cargo_id
				   				   		 AND Det.referencia = 'SERVICIO'
				   				   INNER JOIN facturas_servicio AS FS ON Det.referencia_id = FS.factura_servicio_id 
				   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
				   				   WHERE  Reg.estatus = 'ACTIVO'
				   				   AND  Reg.moneda_id = FS.moneda_id
				   				   $strRestriccionesRegFecha
				   				   $strRestriccionesDetTasaCuotaIva
					    		   $strRestriccionesDetTasaCuotaIeps
					    		   GROUP BY Det.referencia_id) AS NotasCargoMI ON NotasCargoMI.referenciaID = Reg.factura_servicio_id
					    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
				   						  SUM(ROUND((Det.precio/FS.tipo_cambio), 2) + 
											  ROUND((Det.iva/FS.tipo_cambio), 2) + 
								              ROUND((Det.ieps/FS.tipo_cambio), 2)) AS Total, 
				   						  COUNT(Det.referencia_id) AS Parcialidades
				   				   FROM notas_cargo AS Reg
				   				   INNER JOIN notas_cargo_detalles AS Det ON Reg.nota_cargo_id = Det.nota_cargo_id
				   				   		 AND Det.referencia = 'SERVICIO'
				   				   INNER JOIN facturas_servicio AS FS ON Det.referencia_id = FS.factura_servicio_id 
				   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
				   				   WHERE  Reg.estatus = 'ACTIVO'
				   				   AND  Reg.moneda_id <> FS.moneda_id
				   				   $strRestriccionesRegFecha
				   				   $strRestriccionesDetTasaCuotaIva
					    		   $strRestriccionesDetTasaCuotaIeps
					    		   GROUP BY Det.referencia_id) AS NotasCargoMD ON NotasCargoMD.referenciaID = Reg.factura_servicio_id
					   	LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
				   						  SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
											  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								              ROUND((Det.ieps/Reg.tipo_cambio), 2))  AS Total, 
				   						  COUNT(Det.referencia_id) AS Parcialidades
				   				   FROM notas_cargo_digitales AS Reg
				   				   INNER JOIN notas_cargo_digitales_detalles AS Det ON Reg.nota_cargo_digital_id = Det.nota_cargo_digital_id
				   				   		 AND Det.referencia = 'SERVICIO'
				   				   INNER JOIN facturas_servicio AS FS ON Det.referencia_id = FS.factura_servicio_id  
				   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
				   				   WHERE  (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
				   				   AND  Reg.moneda_id = FS.moneda_id
				   				   $strRestriccionesRegFecha
				   				   $strRestriccionesDetTasaCuotaIva
					    		   $strRestriccionesDetTasaCuotaIeps
					    		   GROUP BY Det.referencia_id) AS NotasCargoDigitalesMI ON NotasCargoDigitalesMI.referenciaID = Reg.factura_servicio_id
					    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
				   						  SUM(ROUND((Det.precio/FS.tipo_cambio), 2) + 
										      ROUND((Det.iva/FS.tipo_cambio), 2) + 
								              ROUND((Det.ieps/FS.tipo_cambio), 2)) AS Total, 
				   						  COUNT(Det.referencia_id) AS Parcialidades
				   				   FROM notas_cargo_digitales AS Reg
				   				   INNER JOIN notas_cargo_digitales_detalles AS Det ON Reg.nota_cargo_digital_id = Det.nota_cargo_digital_id
				   				   		 AND Det.referencia = 'SERVICIO'
				   				   INNER JOIN facturas_servicio AS FS ON Det.referencia_id = FS.factura_servicio_id  
				   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
				   				   WHERE  (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
				   				   AND  Reg.moneda_id <> FS.moneda_id
				   				   $strRestriccionesRegFecha
				   				   $strRestriccionesDetTasaCuotaIva
					    		   $strRestriccionesDetTasaCuotaIeps
					    		   GROUP BY Det.referencia_id) AS NotasCargoDigitalesMD ON NotasCargoDigitalesMD.referenciaID = Reg.factura_servicio_id
						LEFT JOIN (SELECT PDR.referencia_id AS referenciaID,
						   				  SUM(ROUND((PDR.imp_pagado/PD.tipo_cambio),2)) AS Total,
						   				  COUNT(PDR.renglon) AS Parcialidades
						   		   FROM pagos AS P
						   		   INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
						   		   INNER JOIN pagos_detalles_relacionados_02 AS PDR ON P.pago_id = PDR.pago_id
									   		   AND PDR.renglon_detalles = PD.renglon AND PDR.tipo_referencia = 'SERVICIO'
								   INNER JOIN facturas_servicio AS FS ON PDR.referencia_id = FS.factura_servicio_id
								   WHERE (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
								   AND   PD.moneda_id = FS.moneda_id 
							       $strRestriccionesPagoFecha
								   GROUP BY PDR.referencia_id) AS PagosMI ON PagosMI.referenciaID = Reg.factura_servicio_id
						LEFT JOIN (SELECT PDR.referencia_id AS referenciaID,
						   				  SUM(ROUND((PDR.imp_pagado/FS.tipo_cambio),2)) AS Total,
						   				  COUNT(PDR.renglon) AS Parcialidades
						   		   FROM pagos AS P
						   		   INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
						   		   INNER JOIN pagos_detalles_relacionados_02 AS PDR ON P.pago_id = PDR.pago_id
									   		   AND PDR.renglon_detalles = PD.renglon AND PDR.tipo_referencia = 'SERVICIO'
								   INNER JOIN facturas_servicio AS FS ON PDR.referencia_id = FS.factura_servicio_id
								   WHERE (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
								   AND   PD.moneda_id <> FS.moneda_id 
							       $strRestriccionesPagoFecha
								   GROUP BY PDR.referencia_id) AS PagosMD ON PagosMD.referenciaID = Reg.factura_servicio_id
					    LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
					    				   SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
											   ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								               ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
					    				   COUNT(Det.referencia_id) AS Parcialidades
					    		    FROM recibos_ingreso AS Reg
					    		    INNER JOIN recibos_ingreso_detalles AS Det ON Reg.recibo_ingreso_id = Det.recibo_ingreso_id
					    		    	AND Det.referencia = 'SERVICIO'
					    		    INNER JOIN facturas_servicio AS FS ON Det.referencia_id = FS.factura_servicio_id  
					    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id 
					    		    WHERE Reg.estatus = 'ACTIVO'
					    		    AND  Reg.moneda_id = FS.moneda_id
					    		    $strRestriccionesRegFecha
					    		    $strRestriccionesDetTasaCuotaIva
					    		   	$strRestriccionesDetTasaCuotaIeps
					                GROUP BY Det.referencia_id) AS RecibosIngresoMI ON RecibosIngresoMI.referenciaID = Reg.factura_servicio_id
					    LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
					    				   SUM(ROUND((Det.precio/FS.tipo_cambio), 2) + 
											   ROUND((Det.iva/FS.tipo_cambio), 2) + 
								               ROUND((Det.ieps/FS.tipo_cambio), 2)) AS Total, 
					    				   COUNT(Det.referencia_id) AS Parcialidades
					    		    FROM recibos_ingreso AS Reg
					    		    INNER JOIN recibos_ingreso_detalles AS Det ON Reg.recibo_ingreso_id = Det.recibo_ingreso_id
					    		    	AND Det.referencia = 'SERVICIO'
					    		    INNER JOIN facturas_servicio AS FS ON Det.referencia_id = FS.factura_servicio_id  
					    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id 
					    		    WHERE Reg.estatus = 'ACTIVO'
					    		    AND  Reg.moneda_id <> FS.moneda_id
					    		    $strRestriccionesRegFecha
					    		    $strRestriccionesDetTasaCuotaIva
					    		   	$strRestriccionesDetTasaCuotaIeps
					                GROUP BY Det.referencia_id) AS RecibosIngresoMD ON RecibosIngresoMD.referenciaID = Reg.factura_servicio_id
					     LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
					    				    SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
												ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								                ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
					    				    COUNT(Det.referencia_id) AS Parcialidades
					    		    FROM polizas_abono_02 AS Reg
					    		    INNER JOIN polizas_abono_detalles_02 AS Det ON Reg.poliza_abono_id = Det.poliza_abono_id
					    		    	  AND Det.referencia = 'SERVICIO'
					    		    INNER JOIN facturas_servicio AS FS ON Det.referencia_id = FS.factura_servicio_id  
					    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					    		    WHERE Reg.estatus = 'ACTIVO'
					    		    AND  Reg.moneda_id = FS.moneda_id
					    		    $strRestriccionesRegFecha
					    		    $strRestriccionesDetTasaCuotaIva
					    		   	$strRestriccionesDetTasaCuotaIeps
					                GROUP BY Det.referencia_id) AS PolizasAbonoMI ON PolizasAbonoMI.referenciaID = Reg.factura_servicio_id
					     LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
					    				    SUM(ROUND((Det.precio/FS.tipo_cambio), 2) + 
												ROUND((Det.iva/FS.tipo_cambio), 2) + 
								                ROUND((Det.ieps/FS.tipo_cambio), 2)) AS Total, 
					    				    COUNT(Det.referencia_id) AS Parcialidades
					    		    FROM polizas_abono_02 AS Reg
					    		    INNER JOIN polizas_abono_detalles_02 AS Det ON Reg.poliza_abono_id = Det.poliza_abono_id
					    		    	  AND Det.referencia = 'SERVICIO'
					    		    INNER JOIN facturas_servicio AS FS ON Det.referencia_id = FS.factura_servicio_id  
					    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					    		    WHERE Reg.estatus = 'ACTIVO'
					    		    AND  Reg.moneda_id <> FS.moneda_id
					    		    $strRestriccionesRegFecha
					    		    $strRestriccionesDetTasaCuotaIva
					    		   	$strRestriccionesDetTasaCuotaIeps
					                GROUP BY Det.referencia_id) AS PolizasAbonoMD ON PolizasAbonoMD.referenciaID = Reg.factura_servicio_id
					     LEFT JOIN (SELECT Reg.referencia_id AS referenciaID,
				   						  SUM(ROUND(((Det.precio_unitario * RD.cantidad)/Reg.tipo_cambio), 2) + 
				   						  	  ROUND(((Det.iva_unitario * RD.cantidad)/Reg.tipo_cambio), 2) + 
				   						  	  ROUND(((Det.ieps_unitario * RD.cantidad)/Reg.tipo_cambio), 2)) AS Total,
				   						  COUNT(Reg.referencia_id) AS Parcialidades
				   				   FROM  movimientos_refacciones AS Reg
				   				   INNER JOIN movimientos_refacciones_detalles AS RD ON Reg.movimiento_refacciones_id = RD.movimiento_refacciones_id
				   				   INNER JOIN facturas_servicio AS FS ON FS.factura_servicio_id = Reg.referencia_id
								   INNER JOIN facturas_servicio_refacciones AS Det ON FS.factura_servicio_id = Det.factura_servicio_id AND Det.refaccion_id = RD.refaccion_id AND Det.renglon = RD.renglon
				   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
				   				   WHERE Reg.tipo_movimiento = $intMovDevRef
				   				   AND Reg.tipo_referencia = 'SERVICIO'
				   				   AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
				   				   $strRestriccionesRegFecha
				   				   $strRestriccionesDetTasaCuotaIva
					    		   $strRestriccionesDetTasaCuotaIeps
					    		   GROUP BY Reg.referencia_id) AS Devolucion ON Devolucion.referenciaID = Reg.factura_servicio_id
						 LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
					    				    SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
												ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								                ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
					    				    COUNT(Det.referencia_id) AS Parcialidades
						    		FROM notas_credito_digitales AS Reg
						    		INNER JOIN notas_credito_digitales_detalles AS Det ON Reg.nota_credito_digital_id = Det.nota_credito_digital_id
						    			  AND Det.referencia = 'SERVICIO'
						    		INNER JOIN facturas_servicio AS FS ON Det.referencia_id = FS.factura_servicio_id  
						    	    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
						    		AND  Reg.moneda_id = FS.moneda_id
						    		$strRestriccionesRegFecha
						    		$strRestriccionesDetTasaCuotaIva
						    		$strRestriccionesDetTasaCuotaIeps
						            GROUP BY Det.referencia_id) AS NotasCreditoDigitalesMI ON NotasCreditoDigitalesMI.referenciaID = Reg.factura_servicio_id
						   LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
					    				      SUM(ROUND((Det.precio/FS.tipo_cambio), 2) + 
												  ROUND((Det.iva/FS.tipo_cambio), 2) + 
								                  ROUND((Det.ieps/FS.tipo_cambio), 2)) AS Total, 
					    				      COUNT(Det.referencia_id) AS Parcialidades
						    		FROM notas_credito_digitales AS Reg
						    		INNER JOIN notas_credito_digitales_detalles AS Det ON Reg.nota_credito_digital_id = Det.nota_credito_digital_id
						    			  AND Det.referencia = 'SERVICIO'
						    		INNER JOIN facturas_servicio AS FS ON Det.referencia_id = FS.factura_servicio_id  
						    	    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
						    		AND  Reg.moneda_id <> FS.moneda_id
						    		$strRestriccionesRegFecha
						    		$strRestriccionesDetTasaCuotaIva
						    		$strRestriccionesDetTasaCuotaIeps
						            GROUP BY Det.referencia_id) AS NotasCreditoDigitalesMD ON NotasCreditoDigitalesMD.referenciaID = Reg.factura_servicio_id
						     LEFT JOIN  (SELECT Reg.factura_servicio_id AS referenciaID, 
					    				    SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
												ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								                ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
					    				    COUNT(Reg.factura_servicio_id) AS Parcialidades
						    		FROM notas_credito_servicio AS Reg
						    		INNER JOIN notas_credito_servicio_detalles AS Det ON Reg.nota_credito_servicio_id = Det.nota_credito_servicio_id
						    	    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
						    		$strRestriccionesRegFecha
						    		$strRestriccionesDetTasaCuotaIva
						    		$strRestriccionesDetTasaCuotaIeps
						            GROUP BY Reg.factura_servicio_id) AS NotasCreditoServicio ON NotasCreditoServicio.referenciaID = Reg.factura_servicio_id
						  WHERE $strRestriccionesEstatus
						  		$strRestriccionesRegFecha
						  		$strRestriccionesSucursales
						  		$strRestriccionesServReferenciaID
						        $strRestriccionesMetodoPago
						        $strRestriccionesMoneda
							    $strRestriccionesProspecto";

		//Facturas de conceptos
		$queryConceptos =  "SELECT Reg.factura_concepto_id AS referencia_id, Reg.sucursal_id,
								   'CONCEPTOS' AS modulo,
								   'CONCEPTO' AS tipo_referencia, 
							       'FACTURA CONCEPTOS' AS tipo_referencia_cfdi, Reg.uuid, Reg.folio, 
							       Reg.moneda_id, M.codigo AS moneda_tipo, Reg.tipo_cambio, 
							       Reg.metodo_pago_id, MP.codigo AS metodo_pago, Reg.fecha, 
							       Reg.vencimiento AS fecha_vencimiento, DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format, 
							       DATE_FORMAT(Reg.vencimiento, '%d/%m/%Y') AS fecha_vencimiento_format, 
							       C.prospecto_id, C.razon_social, C.maquinaria_credito_dias AS dias_credito, 
							       C.maquinaria_credito_limite AS limite_credito, 'CONCEPTO' AS referencia, 
							       CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda, 
							       '' AS vendedor,
							       (ROUND((ConceptosDetalles.Subtotal/Reg.tipo_cambio), 2)) AS subtotal, 
							       (ROUND((ConceptosDetalles.IVA/Reg.tipo_cambio), 2)) AS iva, 
							       (ROUND((ConceptosDetalles.IEPS/Reg.tipo_cambio), 2)) AS ieps, 
							       (ROUND((ConceptosDetalles.Total/Reg.tipo_cambio), 2)) AS importe, 
							       (IFNULL(PagosMI.Total, 0) + 
							       	IFNULL(PagosMD.Total, 0) + 
									IFNULL(RecibosIngresoMI.Total, 0) + 
							        IFNULL(RecibosIngresoMD.Total, 0) + 
							        IFNULL(PolizasAbonoMI.Total, 0) + 
							        IFNULL(PolizasAbonoMD.Total, 0) + 
							        IFNULL(NotasCreditoDigitalesMI.Total, 0) + 
							        IFNULL(NotasCreditoDigitalesMD.Total, 0)) AS abonos, 
								   (IFNULL(PagosMI.Parcialidades, 0) + 
								    IFNULL(PagosMD.Parcialidades, 0) +
							        IFNULL(RecibosIngresoMI.Parcialidades, 0) + 
							        IFNULL(RecibosIngresoMD.Parcialidades, 0) + 
							        IFNULL(PolizasAbonoMI.Parcialidades, 0) + 
							        IFNULL(PolizasAbonoMD.Parcialidades, 0) + 
							        IFNULL(NotasCreditoDigitalesMI.Parcialidades, 0) + 
							        IFNULL(NotasCreditoDigitalesMD.Parcialidades, 0)) AS parcialidades, 
								  ((ROUND((ConceptosDetalles.Total/Reg.tipo_cambio), 2) + 
							        IFNULL(NotasCargoMI.Total, 0) + 
							        IFNULL(NotasCargoMD.Total, 0) + 
							        IFNULL(NotasCargoDigitalesMI.Total, 0) + 
							        IFNULL(NotasCargoDigitalesMD.Total, 0) - 
							        IFNULL(PagosMI.Total, 0) - 
							        IFNULL(PagosMD.Total, 0) - 
							        IFNULL(RecibosIngresoMI.Total, 0) - 
							        IFNULL(RecibosIngresoMD.Total, 0) - 
							        IFNULL(PolizasAbonoMI.Total, 0) - 
							        IFNULL(PolizasAbonoMD.Total, 0) - 
							        IFNULL(NotasCreditoDigitalesMI.Total, 0) - 
							        IFNULL(NotasCreditoDigitalesMD.Total, 0))) AS saldo, 
							       (IFNULL(PagosMI.Total, 0) +  
							        IFNULL(PagosMD.Total, 0)) AS pagos, 
								 ((ROUND((ConceptosDetalles.Total/Reg.tipo_cambio), 2) + 
							      IFNULL(NotasCargoMI.Total, 0) + 
							      IFNULL(NotasCargoMD.Total, 0) + 
							      IFNULL(NotasCargoDigitalesMI.Total, 0) + 
							      IFNULL(NotasCargoDigitalesMD.Total, 0) - 
							      IFNULL(RecibosIngresoMI.Total, 0) - 
							      IFNULL(RecibosIngresoMD.Total, 0) - 
							      IFNULL(PolizasAbonoMI.Total, 0) - 
							      IFNULL(PolizasAbonoMD.Total, 0) - 
							      IFNULL(NotasCreditoDigitalesMI.Total, 0) - 
							      IFNULL(NotasCreditoDigitalesMD.Total, 0))) AS saldo_tasa 
							FROM facturas_conceptos AS Reg 
							INNER JOIN clientes C ON C.prospecto_id = Reg.prospecto_id 
							INNER JOIN sat_monedas AS M ON Reg.moneda_id = M.moneda_id 
							INNER JOIN sat_metodos_pago AS MP ON Reg.metodo_pago_id = MP.metodo_pago_id 
							INNER JOIN (SELECT Det.factura_concepto_id AS referenciaID,
					   						   SUM(ROUND((Det.precio_unitario * Det.cantidad), 2) + 
					   						  	   ROUND((Det.iva_unitario * Det.cantidad), 2) + 
					   						  	   ROUND((Det.ieps_unitario * Det.cantidad), 2)) AS Total,
					   						   SUM(Det.precio_unitario * Det.cantidad) AS Subtotal,
					   						   SUM(ROUND((Det.iva_unitario * Det.cantidad), 2)) AS IVA,
											   SUM(ROUND((Det.ieps_unitario * Det.cantidad), 2)) AS IEPS
					   					FROM facturas_conceptos_detalles AS Det		
					   					INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					   					$strRestriccionesFDTasaCuotaIva
						  				$strRestriccionesDetTasaCuotaIeps
						  				GROUP BY Det.factura_concepto_id) AS ConceptosDetalles ON ConceptosDetalles.referenciaID = Reg.factura_concepto_id
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID, 
											  SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
												  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
												  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
												  COUNT(Det.referencia_id) AS Parcialidades 
									   FROM notas_cargo AS Reg 
							           INNER JOIN notas_cargo_detalles AS Det ON Reg.nota_cargo_id = Det.nota_cargo_id AND Det.referencia = 'CONCEPTO'
							           INNER JOIN facturas_conceptos AS FC ON Det.referencia_id = FC.factura_concepto_id 
							           INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id 
							           LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id 
							           WHERE Reg.estatus = 'ACTIVO' 
							           AND Reg.moneda_id = FC.moneda_id 
							           $strRestriccionesRegFecha
				   				       $strRestriccionesDetTasaCuotaIva
					    		       $strRestriccionesDetTasaCuotaIeps
							           GROUP BY Det.referencia_id) AS NotasCargoMI ON NotasCargoMI.referenciaID = Reg.factura_concepto_id 
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
							                  SUM(ROUND((Det.precio/FC.tipo_cambio), 2) + 
												  ROUND((Det.iva/FC.tipo_cambio), 2) + 
							                      ROUND((Det.ieps/FC.tipo_cambio), 2)) AS Total, 
											  COUNT(Det.referencia_id) AS Parcialidades 
										FROM notas_cargo AS Reg 
							            INNER JOIN notas_cargo_detalles AS Det ON Reg.nota_cargo_id = Det.nota_cargo_id 
											  AND Det.referencia = 'CONCEPTO' 
										INNER JOIN facturas_conceptos AS FC ON Det.referencia_id = FC.factura_concepto_id 
							            INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id 
							            LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id 
							            WHERE Reg.estatus = 'ACTIVO' 
							            AND  Reg.moneda_id <> FC.moneda_id 
							            $strRestriccionesRegFecha
				   				        $strRestriccionesDetTasaCuotaIva
					    		        $strRestriccionesDetTasaCuotaIeps
							            GROUP BY Det.referencia_id) AS NotasCargoMD ON NotasCargoMD.referenciaID = Reg.factura_concepto_id 
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID, 
							                  SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
							                      ROUND((Det.iva/Reg.tipo_cambio), 2) + 
							                      ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  COUNT(Det.referencia_id) AS Parcialidades 
										FROM notas_cargo_digitales AS Reg 
							            INNER JOIN notas_cargo_digitales_detalles AS Det ON Reg.nota_cargo_digital_id = Det.nota_cargo_digital_id AND Det.referencia = 'CONCEPTO' 
							            INNER JOIN facturas_conceptos AS FC ON Det.referencia_id = FC.factura_concepto_id 
							            INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id 
							            LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id 
							            WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR') 
							            AND  Reg.moneda_id = FC.moneda_id
							            $strRestriccionesRegFecha
				   				        $strRestriccionesDetTasaCuotaIva
					    		        $strRestriccionesDetTasaCuotaIeps
							            GROUP BY Det.referencia_id) AS NotasCargoDigitalesMI ON NotasCargoDigitalesMI.referenciaID = Reg.factura_concepto_id 
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID, 
							                  SUM(ROUND((Det.precio/FC.tipo_cambio), 2) + 
							                      ROUND((Det.iva/FC.tipo_cambio), 2) + 
							                      ROUND((Det.ieps/FC.tipo_cambio), 2)) AS Total, 
											  COUNT(Det.referencia_id) AS Parcialidades 
										FROM notas_cargo_digitales AS Reg 
							            INNER JOIN notas_cargo_digitales_detalles AS Det ON Reg.nota_cargo_digital_id = Det.nota_cargo_digital_id 
							                   AND Det.referencia = 'CONCEPTO' 
										INNER JOIN facturas_conceptos AS FC ON Det.referencia_id = FC.factura_concepto_id 
							            INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id 
							            LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id 
							            WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR') 
									    AND  Reg.moneda_id <> FC.moneda_id
									    $strRestriccionesRegFecha
				   				        $strRestriccionesDetTasaCuotaIva
					    		        $strRestriccionesDetTasaCuotaIeps
							            GROUP BY Det.referencia_id) AS NotasCargoDigitalesMD ON NotasCargoDigitalesMD.referenciaID = Reg.factura_concepto_id 
							LEFT JOIN (SELECT PDR.referencia_id AS referenciaID, 
										      SUM(ROUND((PDR.imp_pagado/PD.tipo_cambio),2)) AS Total, 
							                  COUNT(PDR.renglon) AS Parcialidades 
									   FROM pagos AS P INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id 
							           INNER JOIN pagos_detalles_relacionados_02 AS PDR ON P.pago_id = PDR.pago_id 
							                 AND PDR.renglon_detalles = PD.renglon 
							                 AND PDR.tipo_referencia = 'CONCEPTO'
							           INNER JOIN facturas_conceptos AS FC ON PDR.referencia_id = FC.factura_concepto_id 
									   WHERE (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
									   AND   PD.moneda_id = FC.moneda_id 
							           $strRestriccionesPagoFecha
							           GROUP BY PDR.referencia_id) AS PagosMI ON PagosMI.referenciaID = Reg.factura_concepto_id 
							LEFT JOIN (SELECT PDR.referencia_id AS referenciaID, 
										      SUM(ROUND((PDR.imp_pagado/FC.tipo_cambio),2)) AS Total, 
							                  COUNT(PDR.renglon) AS Parcialidades 
									   FROM pagos AS P INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id 
							           INNER JOIN pagos_detalles_relacionados_02 AS PDR ON P.pago_id = PDR.pago_id 
							                 AND PDR.renglon_detalles = PD.renglon 
							                 AND PDR.tipo_referencia = 'CONCEPTO'
							           INNER JOIN facturas_conceptos AS FC ON PDR.referencia_id = FC.factura_concepto_id 
									   WHERE (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR') 
									   AND   PD.moneda_id <> FC.moneda_id 
							           $strRestriccionesPagoFecha
							           GROUP BY PDR.referencia_id) AS PagosMD ON PagosMD.referenciaID = Reg.factura_concepto_id 
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID, 
							                  SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
							                      ROUND((Det.iva/Reg.tipo_cambio), 2) + 
							                      ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  COUNT(Det.referencia_id) AS Parcialidades 
									    FROM recibos_ingreso AS Reg 
							            INNER JOIN recibos_ingreso_detalles AS Det ON Reg.recibo_ingreso_id = Det.recibo_ingreso_id 
							                  AND Det.referencia = 'CONCEPTO' 
									    INNER JOIN facturas_conceptos AS FC ON Det.referencia_id = FC.factura_concepto_id 
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id 
							            LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id 
							            WHERE Reg.estatus = 'ACTIVO' 
							            AND  Reg.moneda_id = FC.moneda_id 
							            $strRestriccionesRegFecha
				   				        $strRestriccionesDetTasaCuotaIva
					    		        $strRestriccionesDetTasaCuotaIeps
							            GROUP BY Det.referencia_id) AS RecibosIngresoMI ON RecibosIngresoMI.referenciaID = Reg.factura_concepto_id 
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID, 
											  SUM(ROUND((Det.precio/FC.tipo_cambio), 2) + 
												  ROUND((Det.iva/FC.tipo_cambio), 2) + 
							                      ROUND((Det.ieps/FC.tipo_cambio), 2)) AS Total, 
											  COUNT(Det.referencia_id) AS Parcialidades 
										FROM recibos_ingreso AS Reg 
							            INNER JOIN recibos_ingreso_detalles AS Det ON Reg.recibo_ingreso_id = Det.recibo_ingreso_id 
							                  AND Det.referencia = 'CONCEPTO' 
										INNER JOIN facturas_conceptos AS FC ON Det.referencia_id = FC.factura_concepto_id 
							            INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id 
							            LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id 
							            WHERE Reg.estatus = 'ACTIVO' 
										AND  Reg.moneda_id <> FC.moneda_id 
										$strRestriccionesRegFecha
				   				        $strRestriccionesDetTasaCuotaIva
					    		        $strRestriccionesDetTasaCuotaIeps
							            GROUP BY Det.referencia_id) AS RecibosIngresoMD ON RecibosIngresoMD.referenciaID = Reg.factura_concepto_id 
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID, 
							                  SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
							                      ROUND((Det.iva/Reg.tipo_cambio), 2) + 
							                      ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  COUNT(Det.referencia_id) AS Parcialidades 
										FROM polizas_abono_02 AS Reg 
							            INNER JOIN polizas_abono_detalles_02 AS Det ON Reg.poliza_abono_id = Det.poliza_abono_id 
							                   AND Det.referencia = 'CONCEPTO' 
										INNER JOIN facturas_conceptos AS FC ON Det.referencia_id = FC.factura_concepto_id
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id 
							            LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id 
							            WHERE Reg.estatus = 'ACTIVO'
							            AND  Reg.moneda_id = FC.moneda_id
							            $strRestriccionesRegFecha
				   				        $strRestriccionesDetTasaCuotaIva
					    		        $strRestriccionesDetTasaCuotaIeps
							            GROUP BY Det.referencia_id) AS PolizasAbonoMI ON PolizasAbonoMI.referenciaID = Reg.factura_concepto_id 
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.precio/FC.tipo_cambio), 2) + 
							                      ROUND((Det.iva/FC.tipo_cambio), 2) + 
							                      ROUND((Det.ieps/FC.tipo_cambio), 2)) AS Total, 
											  COUNT(Det.referencia_id) AS Parcialidades 
									    FROM polizas_abono_02 AS Reg 
							            INNER JOIN polizas_abono_detalles_02 AS Det ON Reg.poliza_abono_id = Det.poliza_abono_id 
											   AND Det.referencia = 'CONCEPTO' 
									    INNER JOIN facturas_conceptos AS FC ON Det.referencia_id = FC.factura_concepto_id 
							            INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id 
							            LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id 
							            WHERE Reg.estatus = 'ACTIVO' 
							            AND   Reg.moneda_id <> FC.moneda_id 
							            $strRestriccionesRegFecha
				   				        $strRestriccionesDetTasaCuotaIva
					    		        $strRestriccionesDetTasaCuotaIeps
							            GROUP BY Det.referencia_id) AS PolizasAbonoMD ON PolizasAbonoMD.referenciaID = Reg.factura_concepto_id 
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID, 
											  SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
							                      ROUND((Det.iva/Reg.tipo_cambio), 2) + 
							                      ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  COUNT(Det.referencia_id) AS Parcialidades 
										FROM notas_credito_digitales AS Reg 
							            INNER JOIN notas_credito_digitales_detalles AS Det ON Reg.nota_credito_digital_id = Det.nota_credito_digital_id AND Det.referencia = 'CONCEPTO' 
							             INNER JOIN facturas_conceptos AS FC ON Det.referencia_id = FC.factura_concepto_id 
							            INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id 
							            LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id 
							            WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR') 
							            AND  Reg.moneda_id = FC.moneda_id
							            $strRestriccionesRegFecha
				   				        $strRestriccionesDetTasaCuotaIva
					    		        $strRestriccionesDetTasaCuotaIeps
							            GROUP BY Det.referencia_id) AS NotasCreditoDigitalesMI ON NotasCreditoDigitalesMI.referenciaID = Reg.factura_concepto_id 
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
							                  SUM(ROUND((Det.precio/FC.tipo_cambio), 2) + 
							                      ROUND((Det.iva/FC.tipo_cambio), 2) + 
							                      ROUND((Det.ieps/FC.tipo_cambio), 2)) AS Total, 
											  COUNT(Det.referencia_id) AS Parcialidades 
										FROM notas_credito_digitales AS Reg 
							            INNER JOIN notas_credito_digitales_detalles AS Det ON Reg.nota_credito_digital_id = Det.nota_credito_digital_id AND Det.referencia = 'CONCEPTO' 
							            INNER JOIN facturas_conceptos AS FC ON Det.referencia_id = FC.factura_concepto_id 
							            INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id 
							            LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id 
							            WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR') 
							            AND  Reg.moneda_id <> FC.moneda_id
							            $strRestriccionesRegFecha
				   				        $strRestriccionesDetTasaCuotaIva
					    		        $strRestriccionesDetTasaCuotaIeps
							            GROUP BY Det.referencia_id) AS NotasCreditoDigitalesMD ON NotasCreditoDigitalesMD.referenciaID = Reg.factura_concepto_id
							 WHERE $strRestriccionesEstatus
						  		$strRestriccionesRegFecha
						  		$strRestriccionesSucursales
						  		$strRestriccionesConceptoReferenciaID
						        $strRestriccionesMetodoPago
						        $strRestriccionesMoneda
							    $strRestriccionesProspecto";


		//Cartera
	    $queryCartera = "SELECT Reg.cartera_id AS referencia_id, Reg.sucursal_id,
	    					    Reg.modulo, 
	    					   'CARTERA' AS tipo_referencia, 
							   'CARTERA' AS  tipo_referencia_cfdi,
							    Reg.uuid, Reg.folio, Reg.moneda_id, M.codigo AS moneda_tipo,  
							    Reg.tipo_cambio, Reg.metodo_pago_id, MP.codigo AS metodo_pago,
							    Reg.fecha, Reg.vencimiento  AS fecha_vencimiento,
								DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format,
								DATE_FORMAT(Reg.vencimiento, '%d/%m/%Y') AS fecha_vencimiento_format,
								C.prospecto_id, C.razon_social, 0 AS dias_credito,
							    0 AS limite_credito,  Reg.modulo AS referencia,
							   CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
							   CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) AS vendedor,
							   (Reg.saldo/Reg.tipo_cambio) AS subtotal,
 						 	   0 AS iva,
						       0 AS ieps,
						       ROUND((Reg.saldo/Reg.tipo_cambio), 2) AS importe,
						       (IFNULL(PagosMI.Total, 0) +
						        IFNULL(PagosMD.Total, 0) +
				   			 	IFNULL(RecibosIngresoMI.Total, 0) +
				   			 	IFNULL(RecibosIngresoMD.Total, 0) +
				   			  	IFNULL(PolizasAbonoMI.Total, 0) + 
				   			  	IFNULL(PolizasAbonoMD.Total, 0) + 
				   			  	IFNULL(NotasCreditoDigitalesMI.Total, 0) +
				   			  	IFNULL(NotasCreditoDigitalesMD.Total, 0)) AS abonos,
				   			   (IFNULL(PagosMI.Parcialidades, 0) +
				   			    IFNULL(PagosMD.Parcialidades, 0) +
				   			 	IFNULL(RecibosIngresoMI.Parcialidades, 0) +
				   			 	IFNULL(RecibosIngresoMD.Parcialidades, 0) +
				   			  	IFNULL(PolizasAbonoMI.Parcialidades, 0) + 
				   			  	IFNULL(PolizasAbonoMD.Parcialidades, 0) + 
				   			  	IFNULL(NotasCreditoDigitalesMI.Parcialidades, 0) +
				   			  	IFNULL(NotasCreditoDigitalesMD.Parcialidades, 0)) AS parcialidades,
				   			   (ROUND((Reg.saldo / Reg.tipo_cambio), 2) +
				   			    IFNULL(NotasCargoMI.Total, 0) + 
				   			    IFNULL(NotasCargoMD.Total, 0) + 
				   			    IFNULL(NotasCargoDigitalesMI.Total, 0) + 
				   			    IFNULL(NotasCargoDigitalesMD.Total, 0) -
				   			    IFNULL(PagosMI.Total, 0) -
				   			    IFNULL(PagosMD.Total, 0) -
				   			 	IFNULL(RecibosIngresoMI.Total, 0) -
				   			 	IFNULL(RecibosIngresoMD.Total, 0) -
				   			  	IFNULL(PolizasAbonoMI.Total, 0) -
				   			  	IFNULL(PolizasAbonoMD.Total, 0) -
				   			  	IFNULL(NotasCreditoDigitalesMI.Total, 0) -
				   			  	IFNULL(NotasCreditoDigitalesMD.Total, 0)) AS saldo, 
				   			   (IFNULL(PagosMI.Total, 0) +  
							    IFNULL(PagosMD.Total, 0)) AS pagos,
				   			   (ROUND((Reg.saldo / Reg.tipo_cambio), 2) +
				   			    IFNULL(NotasCargoMI.Total, 0) + 
				   			    IFNULL(NotasCargoMD.Total, 0) + 
				   			    IFNULL(NotasCargoDigitalesMI.Total, 0) +
				   			    IFNULL(NotasCargoDigitalesMD.Total, 0) - 
				   			 	IFNULL(RecibosIngresoMI.Total, 0) -
				   			 	IFNULL(RecibosIngresoMD.Total, 0) -
				   			  	IFNULL(PolizasAbonoMI.Total, 0) -
				   			  	IFNULL(PolizasAbonoMD.Total, 0) -
				   			  	IFNULL(NotasCreditoDigitalesMI.Total, 0) -
				   			  	IFNULL(NotasCreditoDigitalesMD.Total, 0)) AS saldo_tasa
						FROM cartera AS Reg
						INNER JOIN clientes C ON C.prospecto_id = Reg.prospecto_id
						INNER JOIN sat_monedas AS M ON  Reg.moneda_id = M.moneda_id
						INNER JOIN sat_metodos_pago AS MP ON  Reg.metodo_pago_id = MP.metodo_pago_id
						LEFT JOIN vendedores AS V ON Reg.vendedor_id =  V.vendedor_id
						LEFT JOIN empleados AS E ON V.empleado_id =  E.empleado_id
						LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
				   						  SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
										   	  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
						                  	  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
				   						  COUNT(Det.referencia_id) AS Parcialidades
				   				   FROM notas_cargo AS Reg
				   				   INNER JOIN notas_cargo_detalles AS Det ON Reg.nota_cargo_id = Det.nota_cargo_id
				   				 		 AND Det.referencia = 'CARTERA'
				   				   INNER JOIN cartera AS CT ON Det.referencia_id = CT.cartera_id  
				   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
				   				   WHERE Reg.estatus = 'ACTIVO'
				   				   AND  Reg.moneda_id = CT.moneda_id
				   				   $strRestriccionesRegFecha
				   				   $strRestriccionesDetTasaCuotaIva
					    		   $strRestriccionesDetTasaCuotaIeps
					    		   GROUP BY Det.referencia_id) AS NotasCargoMI ON NotasCargoMI.referenciaID = Reg.cartera_id
					    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
				   						  SUM(ROUND((Det.precio/CT.tipo_cambio), 2) + 
											  ROUND((Det.iva/CT.tipo_cambio), 2) + 
							                  ROUND((Det.ieps/CT.tipo_cambio), 2)) AS Total, 
				   						  COUNT(Det.referencia_id) AS Parcialidades
				   				   FROM notas_cargo AS Reg
				   				   INNER JOIN notas_cargo_detalles AS Det ON Reg.nota_cargo_id = Det.nota_cargo_id
				   				 		 AND Det.referencia = 'CARTERA'
				   				   INNER JOIN cartera AS CT ON Det.referencia_id = CT.cartera_id  
				   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
				   				   WHERE Reg.estatus = 'ACTIVO'
				   				   AND  Reg.moneda_id <> CT.moneda_id
				   				   $strRestriccionesRegFecha
				   				   $strRestriccionesDetTasaCuotaIva
					    		   $strRestriccionesDetTasaCuotaIeps
					    		   GROUP BY Det.referencia_id) AS NotasCargoMD ON NotasCargoMD.referenciaID = Reg.cartera_id
					   	LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
				   						  SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
											  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
							                  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
				   						  COUNT(Det.referencia_id) AS Parcialidades
				   				   FROM notas_cargo_digitales AS Reg
				   				   INNER JOIN notas_cargo_digitales_detalles AS Det ON Reg.nota_cargo_digital_id = Det.nota_cargo_digital_id
				   				   		AND Det.referencia = 'CARTERA'
				   				   INNER JOIN cartera AS CT ON Det.referencia_id = CT.cartera_id 
				   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
				   				   WHERE  (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
				   				   AND  Reg.moneda_id = CT.moneda_id
				   				   $strRestriccionesRegFecha
				   				   $strRestriccionesDetTasaCuotaIva
					    		   $strRestriccionesDetTasaCuotaIeps
					    		   GROUP BY Det.referencia_id) AS NotasCargoDigitalesMI ON NotasCargoDigitalesMI.referenciaID = Reg.cartera_id
				    	LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
			   						      SUM(ROUND((Det.precio/CT.tipo_cambio), 2) + 
										   	  ROUND((Det.iva/CT.tipo_cambio), 2) + 
						                  	  ROUND((Det.ieps/CT.tipo_cambio), 2)) AS Total, 
			   						      COUNT(Det.referencia_id) AS Parcialidades
				   				   FROM notas_cargo_digitales AS Reg
				   				   INNER JOIN notas_cargo_digitales_detalles AS Det ON Reg.nota_cargo_digital_id = Det.nota_cargo_digital_id
				   				   		AND Det.referencia = 'CARTERA'
				   				   INNER JOIN cartera AS CT ON Det.referencia_id = CT.cartera_id 
				   				   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
				   				   WHERE  (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
				   				   AND  Reg.moneda_id <> CT.moneda_id
				   				   $strRestriccionesRegFecha
				   				   $strRestriccionesDetTasaCuotaIva
					    		   $strRestriccionesDetTasaCuotaIeps
					    		   GROUP BY Det.referencia_id) AS NotasCargoDigitalesMD ON NotasCargoDigitalesMD.referenciaID = Reg.cartera_id
					    LEFT JOIN (SELECT PDR.referencia_id AS referenciaID,
						   				  SUM(ROUND((PDR.imp_pagado/PD.tipo_cambio),2)) AS Total,
						   				  COUNT(PDR.renglon) AS Parcialidades
						   		   FROM pagos AS P
						   		   INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
						   		   INNER JOIN pagos_detalles_relacionados_02 AS PDR ON P.pago_id = PDR.pago_id
									   	 AND PDR.renglon_detalles = PD.renglon AND PDR.tipo_referencia = 'CARTERA'
								   INNER JOIN cartera AS CT ON PDR.referencia_id = CT.cartera_id 
								   WHERE (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
								   AND   PD.moneda_id = CT.moneda_id 
							       $strRestriccionesPagoFecha
								   GROUP BY PDR.referencia_id) AS PagosMI ON PagosMI.referenciaID = Reg.cartera_id
					    LEFT JOIN (SELECT PDR.referencia_id AS referenciaID,
						   				  SUM(ROUND((PDR.imp_pagado/CT.tipo_cambio),2)) AS Total,
						   				  COUNT(PDR.renglon) AS Parcialidades
						   		   FROM pagos AS P
						   		   INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
						   		   INNER JOIN pagos_detalles_relacionados_02 AS PDR ON P.pago_id = PDR.pago_id
									   	 AND PDR.renglon_detalles = PD.renglon AND PDR.tipo_referencia = 'CARTERA'
								   INNER JOIN cartera AS CT ON PDR.referencia_id = CT.cartera_id 
								   WHERE (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
								   AND   PD.moneda_id <> CT.moneda_id 
							       $strRestriccionesPagoFecha
								   GROUP BY PDR.referencia_id) AS PagosMD ON PagosMD.referenciaID = Reg.cartera_id
					    LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
					    				   SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
											   ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								               ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total,
					    				   COUNT(Det.referencia_id) AS Parcialidades
					    		    FROM recibos_ingreso AS Reg
					    		    INNER JOIN recibos_ingreso_detalles AS Det ON Reg.recibo_ingreso_id = Det.recibo_ingreso_id
					    		    	  AND Det.referencia = 'CARTERA'
					    		    INNER JOIN cartera AS CT ON Det.referencia_id = CT.cartera_id 
					    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					    		    WHERE Reg.estatus = 'ACTIVO'
					    		    AND   Reg.moneda_id = CT.moneda_id 
					    		    $strRestriccionesRegFecha
					    		    $strRestriccionesDetTasaCuotaIva
					    		   	$strRestriccionesDetTasaCuotaIeps
					                GROUP BY Det.referencia_id) AS RecibosIngresoMI ON RecibosIngresoMI.referenciaID = Reg.cartera_id
					    LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
					    				   SUM(ROUND((Det.precio/CT.tipo_cambio), 2) + 
											   ROUND((Det.iva/CT.tipo_cambio), 2) + 
								               ROUND((Det.ieps/CT.tipo_cambio), 2)) AS Total,
					    				   COUNT(Det.referencia_id) AS Parcialidades
					    		    FROM recibos_ingreso AS Reg
					    		    INNER JOIN recibos_ingreso_detalles AS Det ON Reg.recibo_ingreso_id = Det.recibo_ingreso_id
					    		    	  AND Det.referencia = 'CARTERA'
					    		    INNER JOIN cartera AS CT ON Det.referencia_id = CT.cartera_id 
					    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					    		    WHERE Reg.estatus = 'ACTIVO'
					    		    AND   Reg.moneda_id <> CT.moneda_id 
					    		    $strRestriccionesRegFecha
					    		    $strRestriccionesDetTasaCuotaIva
					    		   	$strRestriccionesDetTasaCuotaIeps
					                GROUP BY Det.referencia_id) AS RecibosIngresoMD ON RecibosIngresoMD.referenciaID = Reg.cartera_id
					     LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
					    				    SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
												ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								                ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total,
					    				    COUNT(Det.referencia_id) AS Parcialidades
					    		    FROM polizas_abono_02 AS Reg
					    		    INNER JOIN polizas_abono_detalles_02 AS Det ON Reg.poliza_abono_id = Det.poliza_abono_id
					    		    	  AND Det.referencia = 'CARTERA'
					    		    INNER JOIN cartera AS CT ON Det.referencia_id = CT.cartera_id 
					    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					    		    WHERE Reg.estatus = 'ACTIVO'
					    		    AND   Reg.moneda_id = CT.moneda_id 
					    		    $strRestriccionesRegFecha
					    		    $strRestriccionesDetTasaCuotaIva
					    		   	$strRestriccionesDetTasaCuotaIeps
					                GROUP BY Det.referencia_id) AS PolizasAbonoMI ON PolizasAbonoMI.referenciaID = Reg.cartera_id
					     LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
					    				    SUM(ROUND((Det.precio/CT.tipo_cambio), 2) + 
											    ROUND((Det.iva/CT.tipo_cambio), 2) + 
								                ROUND((Det.ieps/CT.tipo_cambio), 2)) AS Total,
					    				    COUNT(Det.referencia_id) AS Parcialidades
					    		    FROM polizas_abono_02 AS Reg
					    		    INNER JOIN polizas_abono_detalles_02 AS Det ON Reg.poliza_abono_id = Det.poliza_abono_id
					    		    	  AND Det.referencia = 'CARTERA'
					    		    INNER JOIN cartera AS CT ON Det.referencia_id = CT.cartera_id 
					    		    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					    		    WHERE Reg.estatus = 'ACTIVO'
					    		    AND   Reg.moneda_id <> CT.moneda_id 
					    		    $strRestriccionesRegFecha
					    		    $strRestriccionesDetTasaCuotaIva
					    		   	$strRestriccionesDetTasaCuotaIeps
					                GROUP BY Det.referencia_id) AS PolizasAbonoMD ON PolizasAbonoMD.referenciaID = Reg.cartera_id
						 LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
					    				    SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
												ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								                ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total,
					    				    COUNT(Det.referencia_id) AS Parcialidades
						    		FROM notas_credito_digitales AS Reg
						    		INNER JOIN notas_credito_digitales_detalles AS Det ON Reg.nota_credito_digital_id = Det.nota_credito_digital_id
						    			  AND Det.referencia = 'CARTERA'
						    	    INNER JOIN cartera AS CT ON Det.referencia_id = CT.cartera_id 
						    		INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
						    		AND   Reg.moneda_id = CT.moneda_id 
						    		$strRestriccionesRegFecha
						    		$strRestriccionesDetTasaCuotaIva
						    		$strRestriccionesDetTasaCuotaIeps
						            GROUP BY Det.referencia_id) AS NotasCreditoDigitalesMI ON NotasCreditoDigitalesMI.referenciaID = Reg.cartera_id
						 LEFT JOIN  (SELECT Det.referencia_id AS referenciaID, 
					    				    SUM(ROUND((Det.precio/CT.tipo_cambio), 2) + 
												ROUND((Det.iva/CT.tipo_cambio), 2) + 
								                ROUND((Det.ieps/CT.tipo_cambio), 2)) AS Total,
					    				    COUNT(Det.referencia_id) AS Parcialidades
						    		FROM notas_credito_digitales AS Reg
						    		INNER JOIN notas_credito_digitales_detalles AS Det ON Reg.nota_credito_digital_id = Det.nota_credito_digital_id
						    			  AND Det.referencia = 'CARTERA'
						    	    INNER JOIN cartera AS CT ON Det.referencia_id = CT.cartera_id 
						    		INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
				   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
						    		AND   Reg.moneda_id <> CT.moneda_id 
						    		$strRestriccionesRegFecha
						    		$strRestriccionesDetTasaCuotaIva
						    		$strRestriccionesDetTasaCuotaIeps
						            GROUP BY Det.referencia_id) AS NotasCreditoDigitalesMD ON NotasCreditoDigitalesMD.referenciaID = Reg.cartera_id
						WHERE $strRestriccionesCartFecha
							  $strRestriccionesSucursales
							  $strRestriccionesModulos
							  $strRestriccionesCartReferenciaID
						      $strRestriccionesMetodoPago
						      $strRestriccionesMoneda
							  $strRestriccionesProspecto";


		//Si existe id de la referencia (factura)
		if($intReferenciaID !== NULL)
		{
			//Dependiendo del tipo de referencia realizar la búsqueda de datos
			if($strTipoReferencia == 'MAQUINARIA')//Facturas de maquinaria
			{
				//Formar consulta
				$queryFacturas .= $queryMaquinaria;
			}
			else if($strTipoReferencia == 'REFACCIONES')//Facturas de refacciones
			{
				//Formar consulta
				$queryFacturas .= $queryRefacciones;
			}
			else if($strTipoReferencia == 'SERVICIO')//Facturas de servicio
			{
				//Formar consulta
				$queryFacturas .= $queryServicio;
			}
			else if($strTipoReferencia == 'CONCEPTO')//Facturas de conceptos
			{
				//Formar consulta
				$queryFacturas .= $queryConceptos;
			}
			else //Cartera
			{
				//Formar consulta
				$queryFacturas .= $queryCartera;	
			}
		}
		else if($strRestriccionesModulos != '')//Si existen módulos seleccionados
		{

			//Formar consulta
			//Si existe modulo de maquinaria
			if($strRestriccionModMaquinaria != '')
			{
			   //Concatenar facturas de maquinaria
			   $queryFacturas .= $queryMaquinaria;
			}


			//Si existe modulo de refacciones
			if($strRestriccionModRefacciones != '')
			{
				//Si existen facturas asignar condición UNION
				$queryFacturas .= (($queryFacturas !== '') ? 
									" UNION " : '');

				//Concatenar facturas de refacciones
				$queryFacturas .= $queryRefacciones;
			}
			

			//Si existe modulo de servicio
			if($strRestriccionModServicio != '')
			{
				//Si existen facturas asignar condición UNION
				$queryFacturas .= (($queryFacturas !== '') ? 
									" UNION " : '');

				//Concatenar facturas de servicio
				$queryFacturas .= $queryServicio;
			}


			//Si existe modulo de conceptos
			if($strRestriccionModConceptos != '')
			{
				//Si existen facturas asignar condición UNION
				$queryFacturas .= (($queryFacturas !== '') ? 
									" UNION " : '');

				//Concatenar facturas de conceptos
				$queryFacturas .= $queryConceptos;
			}

			//Si existen facturas asignar condición UNION
			$queryFacturas .= (($queryFacturas !== '') ? 
								" UNION " : '');
			$queryFacturas .= $queryCartera;
			$queryFacturas .= $strOrdenamiento;

		}
		else
		{
			//Formar consulta
			$queryFacturas .= $queryMaquinaria;
		    $queryFacturas .= " UNION ";
			$queryFacturas .= $queryRefacciones;
			$queryFacturas .= " UNION ";
			$queryFacturas .= $queryServicio;
			$queryFacturas .= " UNION ";
			$queryFacturas .= $queryConceptos;
			$queryFacturas .= " UNION ";
			$queryFacturas .= $queryCartera;
			$queryFacturas .= $strOrdenamiento;
		}

		$strSQL = $this->db->query($queryFacturas);
		return $strSQL->result();
	}
	

	/*Método para regresar las tasas o cuotas de las facturas
	  que coincidan con los criterios de búsqueda proporcionados*/
	public function buscar_tasas_detalles_facturas($intReferenciaID, $strTipoReferencia)
	{
		//Constantes para identificar los datos del SAT correspondientes al gasto de servicio y cartera de vencimiento
		$intTasaCuotaIDIva = SAT_TASA_CUOTA_IVA_ID;
		$strPorcentajeIva = PORCENTAJE_IVA_GASTOS_SERVICIO;
		//Constantes para identificar los datos del SAT correspondientes al IVA cero
		$intTasaCuotaIDIvaCero = SAT_TASA_CUOTA_IVA_CERO_ID;
		$strPorcentajeIvaCero = PORCENTAJE_IVA_CERO;
	
		//Dependiendo del tipo de referencia realizar la búsqueda de datos
		if($strTipoReferencia == 'MAQUINARIA')//Facturas de maquinaria
		{
			//Detalles de la factura de maquinaria
			$strSQL = $this->db->query("SELECT Det.tasa_cuota_iva, Det.tasa_cuota_ieps,  
											   TIva.valor_maximo AS porcentaje_iva, 
											   TIeps.valor_maximo AS porcentaje_ieps,
											   TIeps.tipo AS tipo_ieps, 
						   					   TIeps.factor AS factor_ieps
										FROM facturas_maquinaria AS Det
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
									    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Det.factura_maquinaria_id = $intReferenciaID
									    GROUP BY Det.tasa_cuota_iva, Det.tasa_cuota_ieps
									    ORDER BY Det.tasa_cuota_iva ASC");
		}
		else if($strTipoReferencia == 'REFACCIONES')//Facturas de refacciones
		{
			//Detalles de la factura de refacciones
			$strSQL = $this->db->query("SELECT Det.tasa_cuota_iva, Det.tasa_cuota_ieps,  
										   	   TIva.valor_maximo AS porcentaje_iva, 
										   	   TIeps.valor_maximo AS porcentaje_ieps,
										       TIeps.tipo AS tipo_ieps, 
					   					       TIeps.factor AS factor_ieps
									  FROM facturas_refacciones_detalles AS Det
									  INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
								      LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
								      WHERE Det.factura_refacciones_id = $intReferenciaID
								      UNION
									  SELECT $intTasaCuotaIDIva AS tasa_cuota_iva,  
											 NULL AS tasa_cuota_ieps,
											 $strPorcentajeIva AS porcentaje_iva,
											 NULL AS porcentaje_ieps,
											 NULL AS tipo_ieps, 
											 NULL AS factor_ieps
									  FROM facturas_refacciones AS Det
									  WHERE Det.factura_refacciones_id = $intReferenciaID
									  AND Det.gastos_paqueteria_iva > 0
								      GROUP BY tasa_cuota_iva, tasa_cuota_ieps
								      ORDER BY tasa_cuota_iva ASC");
		}
		else if($strTipoReferencia == 'SERVICIO')//Facturas de servicio
		{
			//Detalles de la factura de servicio
			$strSQL = $this->db->query("SELECT Det.tasa_cuota_iva, Det.tasa_cuota_ieps,  
										   	   TIva.valor_maximo AS porcentaje_iva, 
										   	   TIeps.valor_maximo AS porcentaje_ieps,
										       TIeps.tipo AS tipo_ieps, 
					   					       TIeps.factor AS factor_ieps
										FROM facturas_servicio_mano_obra AS Det
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
									    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Det.factura_servicio_id = $intReferenciaID
									    UNION 
									    SELECT Det.tasa_cuota_iva, Det.tasa_cuota_ieps,  
										   	   TIva.valor_maximo AS porcentaje_iva, 
										   	   TIeps.valor_maximo AS porcentaje_ieps,
										       TIeps.tipo AS tipo_ieps, 
					   					       TIeps.factor AS factor_ieps
										FROM facturas_servicio_refacciones AS Det
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
									    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Det.factura_servicio_id = $intReferenciaID
									    UNION 
									    SELECT Det.tasa_cuota_iva, Det.tasa_cuota_ieps,  
										   	   TIva.valor_maximo AS porcentaje_iva, 
										   	   TIeps.valor_maximo AS porcentaje_ieps,
										       TIeps.tipo AS tipo_ieps, 
					   					       TIeps.factor AS factor_ieps
										FROM facturas_servicio_otros AS Det
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
									    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Det.factura_servicio_id = $intReferenciaID
									    UNION 
									    SELECT Det.tasa_cuota_iva, Det.tasa_cuota_ieps,  
										   	   TIva.valor_maximo AS porcentaje_iva, 
										   	   TIeps.valor_maximo AS porcentaje_ieps,
										       TIeps.tipo AS tipo_ieps, 
					   					       TIeps.factor AS factor_ieps
										FROM facturas_servicio_trabajos_foraneos AS Det
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
									    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Det.factura_servicio_id = $intReferenciaID
									    UNION
										SELECT	$intTasaCuotaIDIva AS tasa_cuota_iva,  
												NULL AS tasa_cuota_ieps,
												$strPorcentajeIva AS porcentaje_iva,
												NULL AS porcentaje_ieps,
												NULL AS tipo_ieps, 
												NULL AS factor_ieps
										FROM facturas_servicio AS Det
										WHERE Det.factura_servicio_id = $intReferenciaID
										AND Det.gastos_servicio_iva > 0
									   GROUP BY tasa_cuota_iva, tasa_cuota_ieps
									   ORDER BY tasa_cuota_iva ASC");
		}
		else if($strTipoReferencia == 'CONCEPTO')//Facturas de conceptos
		{
			//Detalles de la factura de conceptos
			$strSQL = $this->db->query("SELECT Det.tasa_cuota_iva, Det.tasa_cuota_ieps,  
										   	   TIva.valor_maximo AS porcentaje_iva, 
										   	   TIeps.valor_maximo AS porcentaje_ieps,
										       TIeps.tipo AS tipo_ieps, 
					   					       TIeps.factor AS factor_ieps
									  FROM facturas_conceptos_detalles AS Det
									  INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
								      LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
								      WHERE Det.factura_concepto_id = $intReferenciaID
								      GROUP BY tasa_cuota_iva, tasa_cuota_ieps
									  ORDER BY tasa_cuota_iva ASC");
		}
		else //Cartera
		{
			//Detalles de la cartera de vencimiento
			$strSQL = $this->db->query("SELECT	$intTasaCuotaIDIvaCero AS tasa_cuota_iva,  
												NULL AS tasa_cuota_ieps,
												$strPorcentajeIvaCero AS porcentaje_iva,
												NULL AS porcentaje_ieps,
												NULL AS tipo_ieps, 
												NULL AS factor_ieps
									    FROM cartera AS Det
									    WHERE Det.cartera_id = $intReferenciaID
									    AND Det.modulo = 'MAQUINARIA'
									    UNION
										SELECT	$intTasaCuotaIDIva AS tasa_cuota_iva,  
												NULL AS tasa_cuota_ieps,
												$strPorcentajeIva AS porcentaje_iva,
												NULL AS porcentaje_ieps,
												NULL AS tipo_ieps, 
												NULL AS factor_ieps
									    FROM cartera AS Det 
									    WHERE Det.cartera_id = $intReferenciaID
									    AND Det.modulo = 'REFACCIONES'
									    UNION 
									    SELECT	$intTasaCuotaIDIva AS tasa_cuota_iva,  
												NULL AS tasa_cuota_ieps,
												$strPorcentajeIva AS porcentaje_iva,
												NULL AS porcentaje_ieps,
												NULL AS tipo_ieps, 
												NULL AS factor_ieps
									    FROM cartera AS Det 
									    WHERE Det.cartera_id = $intReferenciaID
									    AND Det.modulo = 'SERVICIO'
									    GROUP BY tasa_cuota_iva, tasa_cuota_ieps
									    ORDER BY tasa_cuota_iva ASC");

		}


		return $strSQL->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla pagos_detalles_02
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles del pago
	public function guardar_detalles(stdClass $objPago)
	{
		
		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener los detalles del pago
		foreach ($objPago->arrDetalles as $arrDets)
		{
			//Hacer recorrido para obtener los datos del detalle
			foreach ($arrDets as $arrDet)
			{
				//Incrementar renglón consecutivo
				$intRenglon++;
				//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
				//Asignar datos al array
				$arrDatos = array('pago_id' => $objPago->intPagoID,
								  'renglon' => $intRenglon,
								  'fecha_pago' => $arrDet->dteFechaPago,
								  'forma_pago_id' => $arrDet->intFormaPagoID,
								  'anticipo_id' => $arrDet->intAnticipoID,
								  'moneda_id' => $arrDet->intMonedaID,
								  'tipo_cambio' => $arrDet->intTipoCambio,
								  'monto' => $arrDet->intMonto,
								  'num_operacion' => mb_strtoupper($arrDet->strNumOperacion),
								  'rfc_emisor_cta_ord' => mb_strtoupper($arrDet->strRfcEmisorCtaOrd),
								  'nom_banco_ord_ext' =>  mb_strtoupper($arrDet->strNomBancoOrdExt),
								  'cta_ordenante' => $arrDet->strCtaOrdenante,
								  'cuenta_bancaria_id' => ($arrDet->intCuentaBancariaID)?$arrDet->intCuentaBancariaID:NULL,
								  'rfc_emisor_cta_ben' => mb_strtoupper($arrDet->strRfcEmisorCtaBen),
								  'cta_beneficiario' => $arrDet->strCtaBeneficiario,
								  'cadena_pago_id' => ($arrDet->intCadenaPagoID)?$arrDet->intCadenaPagoID:NULL,
								  'cer_pago' => mb_strtoupper($arrDet->strCerPago),
								  'cad_pago' => mb_strtoupper($arrDet->strCadPago),
								  'sello_pago' => mb_strtoupper($arrDet->strSelloPago));
				//Guardar los datos del registro
				$this->db->insert('pagos_detalles_02', $arrDatos);

				//Hacer un llamado al método para guardar los detalles relacionados del detalle
				$this->guardar_detalles_relacionados($objPago->intPagoID, $intRenglon, 
													 $arrDet->arrDetallesRelacionados);

			}
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intPagoID)
	{
		$this->db->select("	PD.renglon, 
							PD.fecha_pago, 
							DATE_FORMAT(PD.fecha_pago,'%d/%m/%Y') AS fecha, 
							DATE_FORMAT(PD.fecha_pago,'%H:%m:%s') AS hora,
						   	PD.forma_pago_id, 
						   	PD.anticipo_id, 
						   	PD.moneda_id, 
						   	PD.tipo_cambio, 
						   	PD.monto, 
						   	PD.num_operacion, 
						   	PD.rfc_emisor_cta_ord, 
						   	PD.nom_banco_ord_ext, 
						   	PD.cta_ordenante, 
						   	IFNULL(PD.cuenta_bancaria_id, '') AS cuenta_bancaria_id, 
						   	PD.rfc_emisor_cta_ben, 
						   	PD.cta_beneficiario, 
						   	IFNULL(PD.cadena_pago_id, '') AS cadena_pago_id, 
						   	PD.cer_pago, 
						   	PD.cad_pago, 
						   	PD.sello_pago, 
						   	CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, 
						   	CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   	CONCAT_WS(' - ', CP.codigo, CP.descripcion) AS cadena_pago,
						   	FP.codigo AS CodForPag, 
						   	M.codigo AS MonedaTipo, 
						   	IFNULL(CP.codigo, '') AS CodCadPag, 
						   	CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria, 
						   	A.folio AS folio_anticipo", FALSE);
		$this->db->from('pagos_detalles_02 AS PD');
		$this->db->join('sat_forma_pago AS FP', 'PD.forma_pago_id = FP.forma_pago_id', 'inner');
		$this->db->join('sat_monedas AS M', 'PD.moneda_id = M.moneda_id', 'inner');
		$this->db->join('sat_cadenas_pago AS CP', 'PD.cadena_pago_id = CP.cadena_pago_id', 'left');
		$this->db->join('cuentas_bancarias AS CB', 'PD.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'left');
		$this->db->join('anticipos AS A', 'PD.anticipo_id = A.anticipo_id', 'left');
		$this->db->where('PD.pago_id', $intPagoID);
		$this->db->order_by('PD.renglon', 'ASC');
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla pagos_detalles_relacionados_02
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los pagos relacionados del detalle
	public function guardar_detalles_relacionados($intPagoID, $intRenglonDetalle, $arrDetallesRelacionados)
	{
		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener los detalles relacionados del detalle
		foreach ($arrDetallesRelacionados as $arrDet)
		{
			//Incrementar renglón consecutivo
			$intRenglon++;

			//Asignar datos al array
			$arrDatos = array('pago_id' => $intPagoID,
							  'renglon_detalles' => $intRenglonDetalle,
							  'renglon' => $intRenglon,
							  'tipo_referencia' => $arrDet->strTipoReferencia,
							  'referencia_id' => $arrDet->intReferenciaID,
							  'uuid' => $arrDet->strUuid,
							  'folio' => $arrDet->strFolio,
							  'moneda_tipo' => $arrDet->strMonedaTipo,
							  'tipo_cambio' => $arrDet->intTipoCambio,
							  'metodo_pago_id' => $arrDet->intMetodoPagoID,
							  'num_parcialidad' => $arrDet->intNumParcialidades,
							  'imp_saldo_ant' => $arrDet->intImpSaldoAnt,
							  'imp_pagado' => $arrDet->intImpPagado,
							  'imp_saldo_insoluto' => $arrDet->intImpSaldoInsoluto);
			//Guardar los datos del registro
			$this->db->insert('pagos_detalles_relacionados_02', $arrDatos);

		}
	}

    //Método para regresar los detalles relacionados de un registro
	public function buscar_detalles_relacionados($intPagoID, $intRenglonDetalle)
	{
		$this->db->select("	PDR.renglon, 
							PDR.tipo_referencia, 
							PDR.referencia_id, 
							PDR.uuid, 
							PDR.folio, 
						   	PDR.moneda_tipo, 
						   	PDR.tipo_cambio, 
						   	PDR.metodo_pago_id, 
						   	PDR.num_parcialidad, 
						   	PDR.imp_saldo_ant, 
						   	PDR.imp_pagado, 
						   	PDR.imp_saldo_insoluto, 
						   	MP.codigo AS metodo_pago, 
						   	M.moneda_id, 
						   	CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   (SELECT COUNT(PDR2.renglon)
						   	FROM pagos_detalles_relacionados_02 AS PDR2
						   	WHERE PDR2.tipo_referencia = PDR.tipo_referencia
						   	AND PDR2.referencia_id = PDR.referencia_id
						   	AND PDR2.num_parcialidad > PDR.num_parcialidad) AS num_pagos_mayor_parcialidad", FALSE);
		$this->db->from('pagos_detalles_relacionados_02 AS PDR');
		$this->db->join('sat_metodos_pago AS MP', 'PDR.metodo_pago_id = MP.metodo_pago_id', 'inner');
		$this->db->join('sat_monedas AS M', 'PDR.moneda_tipo = M.codigo', 'inner');
		$this->db->where('PDR.pago_id', $intPagoID);
		$this->db->where('PDR.renglon_detalles', $intRenglonDetalle);
		$this->db->order_by('PDR.renglon', 'ASC');
		return $this->db->get()->result();
	}


	/*******************************************************************************************************************
	Funciones que corresponden a las facturas, pagos y anticipos del cliente
	*********************************************************************************************************************/
	/*Método para regresar el anticipo de las facturas del cliente 
	  que coincida con los criterios de búsqueda proporcionados (se utiliza en el reporte de facturas con adeudos)*/
	public function buscar_anticipo_facturas_adeudos($dteFechaCorte, $intProspectoID)
	{
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestriccionesFecha =  "DATE_FORMAT(Reg.fecha, '%Y-%m-%d') <= '$dteFechaCorte'";


		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$strSQL = $this->db->query("SELECT 
		                                    (((ROUND((Reg.subtotal/Reg.tipo_cambio), 2) + 
										       ROUND((Reg.iva/Reg.tipo_cambio), 2) + 
										       ROUND((Reg.ieps/Reg.tipo_cambio), 2))) -
										      IFNULL(ROUND((AplicacionAnticipo.Total / Reg.tipo_cambio),2), 0) -
										      IFNULL(ROUND((DevolucionAnticipo.Total / Reg.tipo_cambio),2), 0)
										      -  IFNULL(ROUND((PagoRefacciones.Total / Reg.tipo_cambio),2), 0) -
										     IFNULL(ROUND((RemisionRefacciones.Total / Reg.tipo_cambio),2), 0)
										     ) AS importe,
										    Reg.moneda_id, Reg.tipo_cambio
									FROM  anticipos AS Reg
								    LEFT JOIN (SELECT Reg.anticipo_id AS referenciaID,
								   				      SUM(ROUND(Reg.subtotal, 2) + 
							   						  	  ROUND(Reg.iva,2) + 
							   						  	  ROUND(Reg.ieps,2)) AS Total
								   			  FROM anticipos_aplicacion AS Reg
								   			  WHERE $strRestriccionesFecha
								   			  AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
								   			  GROUP BY Reg.anticipo_id) AS AplicacionAnticipo ON AplicacionAnticipo.referenciaID = Reg.anticipo_id
								   LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
							                	    SUM(ROUND(Det.subtotal, 2) + 
													    ROUND(Det.iva, 2) + 
													    ROUND(Det.ieps, 2)) AS Total
						   				   FROM anticipos_devolucion AS Reg
						   				   INNER JOIN anticipos_devolucion_detalles AS Det ON 
											   Reg.anticipo_devolucion_id = Det.anticipo_devolucion_id
											   AND Det.referencia = 'FISCAL'
										   WHERE  Reg.estatus = 'ACTIVO'
										   AND   $strRestriccionesFecha
							    		   GROUP BY Det.referencia_id) AS DevolucionAnticipo ON DevolucionAnticipo.referenciaID = Reg.anticipo_id 
							        LEFT JOIN (SELECT Reg.anticipo_id AS referenciaID, 
								   				     (SUM(ROUND(Reg.gastos_paqueteria,2) +
								   				    	 	 ROUND(Reg.gastos_paqueteria_iva,2)) +
								   					   SUM(ROUND((Det.precio_unitario * Det.cantidad),2) + 
							   						  	   ROUND((Det.iva_unitario * Det.cantidad),2) + 
							   						  	   ROUND((Det.ieps_unitario * Det.cantidad),2))) AS Total
											  FROM pedidos_refacciones_detalles AS Det
    										  INNER JOIN pedidos_refacciones AS Reg ON Det.pedido_refacciones_id = Reg.pedido_refacciones_id
								              WHERE Reg.estatus <> 'INACTIVO'
								              AND $strRestriccionesFecha
								              GROUP BY  Reg.anticipo_id) AS PagoRefacciones ON PagoRefacciones.referenciaID = Reg.anticipo_id
								    LEFT JOIN (SELECT Reg.anticipo_id AS referenciaID, 
								   				     (SUM(ROUND(Reg.gastos_paqueteria,2) +
								   				    	 	 ROUND(Reg.gastos_paqueteria_iva,2)) +
								   					   SUM(ROUND((Det.precio_unitario * Det.cantidad),2) + 
							   						  	   ROUND((Det.iva_unitario * Det.cantidad),2) + 
							   						  	   ROUND((Det.ieps_unitario * Det.cantidad),2))) AS Total
											  FROM remisiones_refacciones_detalles AS Det
    										  INNER JOIN remisiones_refacciones AS Reg ON Det.remision_refacciones_id = Reg.remision_refacciones_id
    										  LEFT JOIN pedidos_refacciones AS PR ON PR.pedido_refacciones_id = Reg.referencia_id AND Reg.tipo_referencia = 'PEDIDO'
								              WHERE Reg.estatus <> 'INACTIVO'
								              AND PR.anticipo_id IS NULL
								              AND $strRestriccionesFecha
								              GROUP BY  Reg.anticipo_id) AS RemisionRefacciones ON RemisionRefacciones.referenciaID = Reg.anticipo_id
									WHERE $strRestriccionesFecha
									AND  Reg.prospecto_id = $intProspectoID
									AND (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')");	
		
		return $strSQL->result();
	}


	/*Método para regresar los movimientos (cargos y abonos) del cliente 
	  que coincida con los criterios de búsqueda proporcionados (se utiliza en el reporte de estado de cuenta)*/
	public function buscar_movimientos_estado_cuenta($dteFechaInicial, $dteFechaFinal, $intProspectoID, 
												     $intMonedaID, $strSucursales = NULL, $strModulos = NULL)
	{
		//Constante para identificar al tipo de movimiento entrada de maquinaria por devolución de la factura
		$intMovDevMaq = ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA;
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución de la factura
		$intMovDevRef = ENTRADA_REFACCIONES_DEVOLUCION_FACTURA;
		//Variable que se utiliza para formar la  consulta
		$queryMovimientos = '';
		//ID´s de las sucursales
		$strRestriccionesSucursales = '';
		//Modulos de la cartera
		$strRestriccionesModulos = '';
		//Modulos del detalle de la cartera 
		//(en las tablas: notas de crédito, notas de cargo, pólizas de abono, pagos y recibos de ingresos)
		$strRestriccionesDetModulosCart = '';
		//Modulos de las notas de crédito, notas de cargo, pólizas de abono y recibos de ingresos
		$strRestriccionesDetModulos = '';
		//Modulos de los detalles relacionados de pagos
		$strRestriccionesDetPagoModulos = '';
		//Modulo de maquinaria
		$strRestriccionModMaquinaria = '';
		//Modulo de refacciones
		$strRestriccionModRefacciones = '';
		//Modulo de servicio
		$strRestriccionModServicio = '';
		//Modulo de conceptos
		$strRestriccionModConceptos = '';
		//Variable que se utiliza para ordenar los registros dependiendo del tipo de búsqueda
		$strOrdenamiento = " ORDER BY  DATE_FORMAT(fecha, '%Y-%m-%d'), fecha_creacion, folio";

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
				$strRestriccionesSucursales .= "Reg.sucursal_id = ".$arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}

		//Si existen modulos seleccionados
		if($strModulos)
		{
			//Generar las condiciones dinamicas de las consultas respecto a la columna modulo de la tabla cartera
			$strRestriccionesModulos .= " AND (";
			$strRestriccionesDetModulosCart .= " AND (";
			//Generar las condiciones dinamicas de las consultas respecto a la columna tipo de referencia
			$strRestriccionesDetModulos .= " AND (Det.referencia = 'CARTERA' ";
			$strRestriccionesDetPagoModulos .= " AND (PDR.tipo_referencia = 'CARTERA' ";

			//Quitar | de la lista para obtener el modulo
			$arrModulos = explode("|", $strModulos);

			//Hacer recorrido para formar restricción con los modulos de la catera
			for ($intCon = 0; $intCon < sizeof($arrModulos); $intCon++) 
			{
				//Variable que se utiliza para asignar el modulo
				$strModulo = $arrModulos[$intCon];

				//Concatenar OR a la cadena para obtener datos de otro modulo
				$strRestriccionesDetPagoModulos .= " OR ";
				$strRestriccionesDetModulos .= " OR ";

				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otro modulo)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesModulos .= " OR ";
					$strRestriccionesDetModulosCart .= " OR ";
				}

				//Concatenar modulo para buscar datos en la tabla cartera
				$strRestriccionesModulos .= "Reg.modulo = "."'".$arrModulos[$intCon]."'";
				$strRestriccionesDetModulosCart .= "CT.modulo = "."'".$arrModulos[$intCon]."'";
				//Concatenar modulo para buscar datos en la tablas: notas de cargo, notas de cargo digitales, pólizas de abono, entre otras.
				$strRestriccionesDetModulos .= "Det.referencia = "."'".$arrModulos[$intCon]."'";
				$strRestriccionesDetPagoModulos .= "PDR.tipo_referencia = "."'".$arrModulos[$intCon]."'";

				//Dependiendo del modulo asignar valor a la restricción que se utiliza para buscar datos de las facturas
				if($strModulo == 'MAQUINARIA')
				{
				   //Facturas de maquinaria
				   $strRestriccionModMaquinaria = $strModulo;
				}

				if($strModulo == 'REFACCIONES')
				{
					//Facturas de refacciones
					$strRestriccionModRefacciones = $strModulo;
				}
				
				if($strModulo == 'SERVICIO')
				{
					//Facturas de servicio
					$strRestriccionModServicio = $strModulo;
				}
				
				if($strModulo == 'CONCEPTOS')
				{
					//Facturas de conceptos
					$strRestriccionModConceptos = $strModulo;
				}
			}

			//Reemplazar CONCEPTOS por 'CONCEPTO'
            $strRestriccionesDetModulos =  str_replace ('CONCEPTOS', 'CONCEPTO',  $strRestriccionesDetModulos);
            $strRestriccionesDetPagoModulos =  str_replace ('CONCEPTOS', 'CONCEPTO',  $strRestriccionesDetPagoModulos);


			$strRestriccionesModulos .= ")";
			$strRestriccionesDetModulosCart .= ")";
			$strRestriccionesDetModulos .= ")";
			$strRestriccionesDetPagoModulos .= ")";
		}


		//Variables para definir que tipos de módulo se incluiran en la búsqueda
		//Facturas de maquinaria
		$queryMaquinaria = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion, Reg.estatus,
							       DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format,		
							       'FACTURA DE MAQUINARIA' AS descripcion,
							       '' AS folio_referencia, 'cargo' AS tipo,
							       ((ROUND((Reg.precio/Reg.tipo_cambio), 2) + 
								     ROUND((Reg.iva/Reg.tipo_cambio), 2) + 
								     ROUND((Reg.ieps/Reg.tipo_cambio), 2))) AS importe
							FROM   facturas_maquinaria  AS Reg
							WHERE  Reg.prospecto_id = $intProspectoID
							AND    (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
							$strRestriccionesSucursales
							AND    Reg.moneda_id = $intMonedaID";

	    //Devoluciones de maquinaria
		$queryDevMaquinaria = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion, Reg.estatus,
								      DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format,		
								       'DEVOLUCIÓN DE MAQUINARIA' AS descripcion,
								      FM.folio AS folio_referencia, 'abono' AS tipo,
							          ((ROUND((FM.precio/FM.tipo_cambio), 2) + 
									    ROUND((FM.iva/FM.tipo_cambio), 2) + 
									    ROUND((FM.ieps/FM.tipo_cambio), 2))) AS importe
								FROM  movimientos_maquinaria AS Reg
					   		    INNER JOIN facturas_maquinaria AS FM ON Reg.referencia_id = FM.factura_maquinaria_id
								WHERE  Reg.tipo_movimiento = $intMovDevMaq
								AND    Reg.prospecto_id = $intProspectoID
								AND   (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
								$strRestriccionesSucursales
								AND    FM.moneda_id = $intMonedaID
								GROUP BY Reg.movimiento_maquinaria_id";

		//Facturas de refacciones
		$queryRefacciones = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion, Reg.estatus,
							        DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format,
							       'FACTURA DE REFACCIONES' AS descripcion, 
							       '' AS folio_referencia, 'cargo' AS tipo,
							      (IFNULL(ROUND(((Reg.gastos_paqueteria + Reg.gastos_paqueteria_iva)/Reg.tipo_cambio), 2), 0) + 
								   SUM(ROUND(((Det.precio_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
									   ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
									   ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2))) AS importe
							FROM  facturas_refacciones AS Reg
							INNER JOIN facturas_refacciones_detalles AS Det ON Reg.factura_refacciones_id = Det.factura_refacciones_id
							WHERE  Reg.prospecto_id = $intProspectoID
							AND    (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
							$strRestriccionesSucursales
							AND    Reg.moneda_id = $intMonedaID
							GROUP BY Reg.factura_refacciones_id";


		//Devoluciones de refacciones
		$queryDevRefacciones = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion, Reg.estatus,
								       DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format,
								       'DEVOLUCIÓN DE REFACCIONES' AS descripcion,
								       FR.folio AS folio_referencia, 'abono' AS tipo,
								       SUM(ROUND(((FRD.precio_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
			   						  	    ROUND(((FRD.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
			   						  	    ROUND(((FRD.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS importe
								FROM  movimientos_refacciones AS Reg
					   		    INNER JOIN movimientos_refacciones_detalles AS Det ON Reg.movimiento_refacciones_id = Det.movimiento_refacciones_id
					   		    INNER JOIN facturas_refacciones AS FR ON FR.factura_refacciones_id = Reg.referencia_id
								INNER JOIN facturas_refacciones_detalles AS FRD ON FR.factura_refacciones_id = FRD.factura_refacciones_id  AND FRD.refaccion_id = Det.refaccion_id AND FRD.renglon = Det.renglon
								WHERE Reg.tipo_movimiento = $intMovDevRef
					   		    AND Reg.tipo_referencia = 'REFACCIONES'
					   		    AND  FR.prospecto_id = $intProspectoID
								AND (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
								$strRestriccionesSucursales
								AND  Reg.moneda_id = $intMonedaID
								GROUP BY Reg.movimiento_refacciones_id";

		//Facturas de servicio
		$queryServicio = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion, Reg.estatus,
								 DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format,
						       	 'FACTURA DE SERVICIO' AS descripcion, 
						      	 '' AS folio_referencia, 'cargo' AS tipo,
					             (IFNULL(ROUND(((Reg.gastos_servicio + Reg.gastos_servicio_iva)/Reg.tipo_cambio), 2), 0) +  
						   		  IFNULL(ROUND((ManoObra.Importe/Reg.tipo_cambio), 2), 0) +
							   	  IFNULL(ROUND((Otros.Importe/Reg.tipo_cambio), 2), 0) +
							   	  IFNULL(ROUND((Refacciones.Importe/Reg.tipo_cambio), 2), 0) +
							   	  IFNULL(ROUND((Foraneos.Importe/Reg.tipo_cambio), 2), 0)) AS importe
						  FROM  facturas_servicio AS Reg
						  LEFT JOIN (SELECT factura_servicio_id, 
									      SUM(ROUND(precio_unitario,2) + 
									      	  ROUND(iva_unitario,2) + 
									      	  ROUND(ieps_unitario,2)) AS Importe
						             FROM  facturas_servicio_mano_obra AS Det
						             GROUP BY factura_servicio_id) AS ManoObra ON Reg.factura_servicio_id = ManoObra.factura_servicio_id
						  LEFT JOIN (SELECT factura_servicio_id, 
											SUM(ROUND((precio_unitario * cantidad), 2) + 
					   						  	ROUND((iva_unitario * cantidad), 2) + 
					   						  	ROUND((ieps_unitario * cantidad), 2)) AS Importe
							          FROM  facturas_servicio_otros
							          GROUP BY factura_servicio_id) AS Otros ON Reg.factura_servicio_id = Otros.factura_servicio_id
						  LEFT JOIN (SELECT factura_servicio_id, 
									       SUM(ROUND((precio_unitario * cantidad), 2) + 
				   						  	  ROUND((iva_unitario * cantidad), 2) + 
				   						  	  ROUND((ieps_unitario * cantidad), 2)) AS Importe
						             FROM   facturas_servicio_refacciones
						           GROUP BY factura_servicio_id) AS Refacciones ON Reg.factura_servicio_id = Refacciones.factura_servicio_id
						  LEFT JOIN (SELECT factura_servicio_id, 
											SUM(ROUND((precio_unitario * cantidad), 2) + 
					   						  	ROUND((iva_unitario *  cantidad), 2) + 
					   						  	ROUND((ieps_unitario * cantidad), 2)) AS Importe
						             FROM  facturas_servicio_trabajos_foraneos 
						             GROUP BY factura_servicio_id) AS Foraneos ON Reg.factura_servicio_id = Foraneos.factura_servicio_id
						  WHERE  Reg.prospecto_id = $intProspectoID
						  AND    (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
						  $strRestriccionesSucursales
						  AND    Reg.moneda_id = $intMonedaID
						  GROUP BY Reg.factura_servicio_id";

		//Devoluciones de servicio
		$queryDevServicio = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion, Reg.estatus,
								    DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format,
								    'DEVOLUCIÓN DE REFACCIONES' AS descripcion,
								    FS.folio AS folio_referencia, 'abono' AS tipo,
								    SUM(ROUND(((FSR.precio_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
			   						  	 ROUND(((FSR.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
			   						  	 ROUND(((FSR.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS importe
							  FROM  movimientos_refacciones AS Reg
					   		  INNER JOIN movimientos_refacciones_detalles AS Det ON Reg.movimiento_refacciones_id = Det.movimiento_refacciones_id
					   		  INNER JOIN facturas_servicio AS FS ON FS.factura_servicio_id = Reg.referencia_id
							  INNER JOIN facturas_servicio_refacciones AS FSR ON FS.factura_servicio_id = FSR.factura_servicio_id  
							  		AND FSR.refaccion_id = Det.refaccion_id AND FSR.renglon = Det.renglon
							  WHERE Reg.tipo_movimiento = $intMovDevRef
					   		  AND Reg.tipo_referencia = 'SERVICIO'
					   		  AND  FS.prospecto_id = $intProspectoID
							  AND (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
							  $strRestriccionesSucursales
							  AND  Reg.moneda_id = $intMonedaID
							  GROUP BY Reg.movimiento_refacciones_id";

		//Notas de crédito de servicio
		$queryNotasCreditoServicio = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion, Reg.estatus,
										     DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format,
								            'DEVOLUCIÓN DE SERVICIO' AS descripcion,
								             FS.folio AS folio_referencia, 'abono' AS tipo,
								             SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
			   						  	         ROUND((Det.iva/Reg.tipo_cambio), 2) + 
			   						  	 		  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS importe
			   						 FROM  notas_credito_servicio AS Reg
			   						 INNER JOIN facturas_servicio AS FS ON Reg.factura_servicio_id = FS.factura_servicio_id
			   						 INNER JOIN notas_credito_servicio_detalles AS Det ON Reg.nota_credito_servicio_id = Det.nota_credito_servicio_id
			   						 WHERE  Reg.prospecto_id = $intProspectoID
			   						 AND (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
			   						 $strRestriccionesSucursales
			   						 AND  Reg.moneda_id = $intMonedaID
			   						  GROUP BY Reg.nota_credito_servicio_id";


		//Facturas de conceptos
		$queryConceptos = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion, Reg.estatus,
							      DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format,
							      'FACTURA DE CONCEPTOS' AS descripcion, 
							       '' AS folio_referencia, 'cargo' AS tipo,
   						  		   SUM(ROUND(((Det.precio_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
   						  		       ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
   						  		       ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS importe
						   FROM  facturas_conceptos AS Reg
						   INNER JOIN facturas_conceptos_detalles AS Det ON Reg.factura_concepto_id = Det.factura_concepto_id
						   WHERE  Reg.prospecto_id = $intProspectoID
						   AND    (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
						   $strRestriccionesSucursales
						   AND    Reg.moneda_id = $intMonedaID
						   GROUP BY Reg.factura_concepto_id";


		//Cartera
	    $queryCartera = "SELECT Reg.folio, Reg.fecha,  Reg.fecha AS fecha_creacion, 
	    					    'ACTIVO' AS estatus,  DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format, 
						        'CARTERA' AS descripcion,
						        '' AS folio_referencia, 
						        'cargo' AS tipo,
						        ROUND((Reg.saldo/Reg.tipo_cambio), 2) AS importe
						FROM   cartera AS Reg
						WHERE  Reg.prospecto_id = $intProspectoID
						AND    (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
						$strRestriccionesSucursales
						$strRestriccionesModulos
						AND  Reg.moneda_id = $intMonedaID";


		//Notas de cargo
		$queryNotasCargo = "SELECT  Reg.folio, Reg.fecha,  Reg.fecha_creacion, 
								    Reg.estatus,  DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format, 
							        'NOTA DE CARGO' AS descripcion,
							        CASE 
										WHEN  Det.referencia = 'MAQUINARIA' THEN  FM.folio
								        WHEN  Det.referencia = 'REFACCIONES' THEN  FR.folio
										WHEN  Det.referencia = 'SERVICIO' THEN  FS.folio
										WHEN  Det.referencia = 'CONCEPTO' THEN  FC.folio
										ELSE CT.folio
									 END AS folio_referencia, 'cargo' AS tipo,
							     	 CASE 
								 		WHEN Det.referencia = 'MAQUINARIA' AND FM.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.precio/FM.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/FM.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/FM.tipo_cambio), 2))
								        WHEN Det.referencia = 'REFACCIONES' AND FR.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.precio/FR.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/FR.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/FR.tipo_cambio), 2))
								        WHEN Det.referencia = 'SERVICIO' AND FS.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.precio/FS.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/FS.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/FS.tipo_cambio), 2))
								        WHEN Det.referencia = 'CONCEPTO' AND FC.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.precio/FC.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/FC.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/FC.tipo_cambio), 2))
										WHEN Det.referencia = 'CARTERA' AND CT.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.precio/CT.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/CT.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/CT.tipo_cambio), 2))
								        ELSE
								         	SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
										    	ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								         	    ROUND((Det.ieps/Reg.tipo_cambio), 2)) 
									END AS importe
							FROM  notas_cargo AS Reg
							INNER JOIN notas_cargo_detalles AS Det ON Reg.nota_cargo_id = Det.nota_cargo_id
							LEFT JOIN facturas_maquinaria AS FM ON Det.referencia_id = FM.factura_maquinaria_id  
								 AND Det.referencia = 'MAQUINARIA'
							LEFT JOIN facturas_refacciones AS FR ON Det.referencia_id = FR.factura_refacciones_id  
								 AND Det.referencia = 'REFACCIONES'
							LEFT JOIN facturas_servicio AS FS ON Det.referencia_id = FS.factura_servicio_id  
								 AND Det.referencia = 'SERVICIO'
							LEFT JOIN facturas_conceptos AS FC ON Det.referencia_id = FC.factura_concepto_id  
								 AND Det.referencia = 'CONCEPTO'
						    LEFT JOIN cartera AS CT ON Det.referencia_id = CT.cartera_id  
								 AND Det.referencia = 'CARTERA'  $strRestriccionesDetModulosCart
							WHERE  Reg.prospecto_id = $intProspectoID
							AND    (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
							$strRestriccionesSucursales
							$strRestriccionesDetModulos
							AND  (FM.moneda_id = $intMonedaID OR 
								  FR.moneda_id = $intMonedaID OR
								  FS.moneda_id = $intMonedaID OR
								  FC.moneda_id = $intMonedaID OR
								  CT.moneda_id = $intMonedaID)
							GROUP BY Det.nota_cargo_id, Det.referencia, Det.referencia_id";


		//Notas de cargo digitales
		$queryNotasCargoDigitales = "SELECT Reg.folio, Reg.fecha,  Reg.fecha_creacion, 
										    Reg.estatus,  DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format, 
									        'NOTA DE CARGO DIGITAL' AS descripcion,
									        CASE 
												WHEN  Det.referencia = 'MAQUINARIA' THEN  FM.folio
										        WHEN  Det.referencia = 'REFACCIONES' THEN  FR.folio
												WHEN  Det.referencia = 'SERVICIO' THEN  FS.folio
												WHEN  Det.referencia = 'CONCEPTO' THEN  FC.folio
												ELSE CT.folio
											END AS folio_referencia, 'cargo' AS tipo,
											CASE 
										 		WHEN Det.referencia = 'MAQUINARIA' AND FM.moneda_id <> Reg.moneda_id
													  THEN  
													   SUM(ROUND((Det.precio/FM.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/FM.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/FM.tipo_cambio), 2))
										        WHEN Det.referencia = 'REFACCIONES' AND FR.moneda_id <> Reg.moneda_id
													  THEN  
													   SUM(ROUND((Det.precio/FR.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/FR.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/FR.tipo_cambio), 2))
										        WHEN Det.referencia = 'SERVICIO' AND FS.moneda_id <> Reg.moneda_id
													  THEN  
													   SUM(ROUND((Det.precio/FS.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/FS.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/FS.tipo_cambio), 2))
										        WHEN Det.referencia = 'CONCEPTO' AND FC.moneda_id <> Reg.moneda_id
													  THEN  
													   SUM(ROUND((Det.precio/FC.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/FC.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/FC.tipo_cambio), 2))
												WHEN Det.referencia = 'CARTERA' AND CT.moneda_id <> Reg.moneda_id
													  THEN  
													   SUM(ROUND((Det.precio/CT.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/CT.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/CT.tipo_cambio), 2))
										        ELSE
										         	SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
												    	ROUND((Det.iva/Reg.tipo_cambio), 2) + 
										         	    ROUND((Det.ieps/Reg.tipo_cambio), 2)) 
										 	END AS importe
									FROM  notas_cargo_digitales AS Reg
									INNER JOIN notas_cargo_digitales_detalles AS Det ON Reg.nota_cargo_digital_id = Det.nota_cargo_digital_id
									LEFT JOIN facturas_maquinaria AS FM ON Det.referencia_id = FM.factura_maquinaria_id  
										 AND Det.referencia = 'MAQUINARIA'
									LEFT JOIN facturas_refacciones AS FR ON Det.referencia_id = FR.factura_refacciones_id  
										 AND Det.referencia = 'REFACCIONES'
									LEFT JOIN facturas_servicio AS FS ON Det.referencia_id = FS.factura_servicio_id  
										 AND Det.referencia = 'SERVICIO'
									LEFT JOIN facturas_conceptos AS FC ON Det.referencia_id = FC.factura_concepto_id  
										 AND Det.referencia = 'CONCEPTO'
								    LEFT JOIN cartera AS CT ON Det.referencia_id = CT.cartera_id  
										 AND Det.referencia = 'CARTERA'  $strRestriccionesDetModulosCart
									WHERE  Reg.prospecto_id = $intProspectoID
									AND    (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
									$strRestriccionesSucursales
								    $strRestriccionesDetModulos
									AND  (FM.moneda_id = $intMonedaID OR 
										  FR.moneda_id = $intMonedaID OR
										  FS.moneda_id = $intMonedaID OR
										  FC.moneda_id = $intMonedaID OR
										  CT.moneda_id = $intMonedaID)
									GROUP BY Det.nota_cargo_digital_id, Det.referencia, Det.referencia_id";

		//Notas de crédito digitales
		$queryNotasCreditoDigitales = "SELECT Reg.folio, Reg.fecha,  Reg.fecha_creacion, 
										      Reg.estatus,  DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format, 
									         'NOTA DE CRÉDITO' AS descripcion,
									         CASE 
												WHEN  Det.referencia = 'MAQUINARIA' THEN  FM.folio
										        WHEN  Det.referencia = 'REFACCIONES' THEN  FR.folio
												WHEN  Det.referencia = 'SERVICIO' THEN  FS.folio
												WHEN  Det.referencia = 'CONCEPTO' THEN  FC.folio
												ELSE CT.folio
											 END AS folio_referencia, 'abono' AS tipo,
											 CASE 
										 		WHEN Det.referencia = 'MAQUINARIA' AND FM.moneda_id <> Reg.moneda_id
													  THEN  
													   SUM(ROUND((Det.precio/FM.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/FM.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/FM.tipo_cambio), 2))
										        WHEN Det.referencia = 'REFACCIONES' AND FR.moneda_id <> Reg.moneda_id
													  THEN  
													   SUM(ROUND((Det.precio/FR.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/FR.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/FR.tipo_cambio), 2))
										        WHEN Det.referencia = 'SERVICIO' AND FS.moneda_id <> Reg.moneda_id
													  THEN  
													   SUM(ROUND((Det.precio/FS.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/FS.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/FS.tipo_cambio), 2))
										        WHEN Det.referencia = 'CONCEPTO' AND FC.moneda_id <> Reg.moneda_id
													  THEN  
													   SUM(ROUND((Det.precio/FC.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/FC.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/FC.tipo_cambio), 2))
												WHEN Det.referencia = 'CARTERA' AND CT.moneda_id <> Reg.moneda_id
													  THEN  
													   SUM(ROUND((Det.precio/CT.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/CT.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/CT.tipo_cambio), 2))
										        ELSE
										         	SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
												    	ROUND((Det.iva/Reg.tipo_cambio), 2) + 
										         	    ROUND((Det.ieps/Reg.tipo_cambio), 2)) 
										 	END AS importe
										FROM  notas_credito_digitales AS Reg
										INNER JOIN notas_credito_digitales_detalles AS Det ON Reg.nota_credito_digital_id = Det.nota_credito_digital_id
										LEFT JOIN facturas_maquinaria AS FM ON Det.referencia_id = FM.factura_maquinaria_id  
											 AND Det.referencia = 'MAQUINARIA'
										LEFT JOIN facturas_refacciones AS FR ON Det.referencia_id = FR.factura_refacciones_id  
											 AND Det.referencia = 'REFACCIONES'
										LEFT JOIN facturas_servicio AS FS ON Det.referencia_id = FS.factura_servicio_id  
											 AND Det.referencia = 'SERVICIO'
										LEFT JOIN facturas_conceptos AS FC ON Det.referencia_id = FC.factura_concepto_id  
											 AND Det.referencia = 'CONCEPTO'
									    LEFT JOIN cartera AS CT ON Det.referencia_id = CT.cartera_id  
											 AND Det.referencia = 'CARTERA' $strRestriccionesDetModulosCart
										WHERE  Reg.prospecto_id = $intProspectoID
										AND    (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
										$strRestriccionesSucursales
									    $strRestriccionesDetModulos
										AND  (FM.moneda_id = $intMonedaID OR 
											  FR.moneda_id = $intMonedaID OR
											  FS.moneda_id = $intMonedaID OR
											  FC.moneda_id = $intMonedaID OR
											  CT.moneda_id = $intMonedaID)
										GROUP BY Det.nota_credito_digital_id, Det.referencia, Det.referencia_id";

		//Pólizas de abono
		$queryPolizasAbono = "SELECT Reg.folio, Reg.fecha,  Reg.fecha_creacion, 
								     Reg.estatus,  DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format, 
							        'PÓLIZA DE ABONO' AS descripcion,
							        CASE 
										WHEN  Det.referencia = 'MAQUINARIA' THEN  FM.folio
								        WHEN  Det.referencia = 'REFACCIONES' THEN  FR.folio
										WHEN  Det.referencia = 'SERVICIO' THEN  FS.folio
										WHEN  Det.referencia = 'CONCEPTO' THEN  FC.folio
										ELSE CT.folio
									 END AS folio_referencia, 'abono' AS tipo,
									 CASE 
								 		WHEN Det.referencia = 'MAQUINARIA' AND FM.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.precio/FM.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/FM.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/FM.tipo_cambio), 2))
								        WHEN Det.referencia = 'REFACCIONES' AND FR.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.precio/FR.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/FR.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/FR.tipo_cambio), 2))
								        WHEN Det.referencia = 'SERVICIO' AND FS.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.precio/FS.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/FS.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/FS.tipo_cambio), 2))
								        WHEN Det.referencia = 'CONCEPTO' AND FC.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.precio/FC.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/FC.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/FC.tipo_cambio), 2))
										WHEN Det.referencia = 'CARTERA' AND CT.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.precio/CT.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/CT.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/CT.tipo_cambio), 2))
								        ELSE
								         	SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
										    	ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								         	    ROUND((Det.ieps/Reg.tipo_cambio), 2)) 
									 END AS importe
								FROM  polizas_abono_02 AS Reg
								INNER JOIN polizas_abono_detalles_02 AS Det ON Reg.poliza_abono_id = Det.poliza_abono_id
								LEFT JOIN facturas_maquinaria AS FM ON Det.referencia_id = FM.factura_maquinaria_id  
									 AND Det.referencia = 'MAQUINARIA'
								LEFT JOIN facturas_refacciones AS FR ON Det.referencia_id = FR.factura_refacciones_id  
									 AND Det.referencia = 'REFACCIONES'
								LEFT JOIN facturas_servicio AS FS ON Det.referencia_id = FS.factura_servicio_id  
									 AND Det.referencia = 'SERVICIO'
								LEFT JOIN facturas_conceptos AS FC ON Det.referencia_id = FC.factura_concepto_id  
									 AND Det.referencia = 'CONCEPTO'
							    LEFT JOIN cartera AS CT ON Det.referencia_id = CT.cartera_id  
									 AND Det.referencia = 'CARTERA' $strRestriccionesDetModulosCart
								WHERE  Reg.prospecto_id = $intProspectoID
								AND    (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
								$strRestriccionesSucursales
							    $strRestriccionesDetModulos
								AND  (FM.moneda_id = $intMonedaID OR 
									  FR.moneda_id = $intMonedaID OR
									  FS.moneda_id = $intMonedaID OR
									  FC.moneda_id = $intMonedaID OR
									  CT.moneda_id = $intMonedaID)
								GROUP BY Det.poliza_abono_id, Det.referencia, Det.referencia_id";
								
		//Recibos de ingreso 
		$queryRecibosIngreso =  "SELECT Reg.folio, Reg.fecha,  Reg.fecha_creacion, 
								    	Reg.estatus,  DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format, 
							        	'RECIBO DE INGRESO' AS descripcion,
							        	CASE 
											WHEN  Det.referencia = 'MAQUINARIA' THEN  FM.folio
								        	WHEN  Det.referencia = 'REFACCIONES' THEN  FR.folio
											WHEN  Det.referencia = 'SERVICIO' THEN  FS.folio
											WHEN  Det.referencia = 'CONCEPTO' THEN  FC.folio
											ELSE CT.folio
									 	END AS folio_referencia, 'abono' AS tipo,
									 	CASE 
									 		WHEN Det.referencia = 'MAQUINARIA' AND FM.moneda_id <> Reg.moneda_id
												  THEN  
												   SUM(ROUND((Det.precio/FM.tipo_cambio), 2) + 
											    	   ROUND((Det.iva/FM.tipo_cambio), 2) + 
									         	       ROUND((Det.ieps/FM.tipo_cambio), 2))
									        WHEN Det.referencia = 'REFACCIONES' AND FR.moneda_id <> Reg.moneda_id
												  THEN  
												   SUM(ROUND((Det.precio/FR.tipo_cambio), 2) + 
											    	   ROUND((Det.iva/FR.tipo_cambio), 2) + 
									         	       ROUND((Det.ieps/FR.tipo_cambio), 2))
									        WHEN Det.referencia = 'SERVICIO' AND FS.moneda_id <> Reg.moneda_id
												  THEN  
												   SUM(ROUND((Det.precio/FS.tipo_cambio), 2) + 
											    	   ROUND((Det.iva/FS.tipo_cambio), 2) + 
									         	       ROUND((Det.ieps/FS.tipo_cambio), 2))
									        WHEN Det.referencia = 'CONCEPTO' AND FC.moneda_id <> Reg.moneda_id
												  THEN  
												   SUM(ROUND((Det.precio/FC.tipo_cambio), 2) + 
											    	   ROUND((Det.iva/FC.tipo_cambio), 2) + 
									         	       ROUND((Det.ieps/FC.tipo_cambio), 2))
											WHEN Det.referencia = 'CARTERA' AND CT.moneda_id <> Reg.moneda_id
												  THEN  
												   SUM(ROUND((Det.precio/CT.tipo_cambio), 2) + 
											    	   ROUND((Det.iva/CT.tipo_cambio), 2) + 
									         	       ROUND((Det.ieps/CT.tipo_cambio), 2))
									        ELSE
									         	SUM(ROUND((Det.precio/Reg.tipo_cambio), 2) + 
											    	ROUND((Det.iva/Reg.tipo_cambio), 2) + 
									         	    ROUND((Det.ieps/Reg.tipo_cambio), 2)) 
									 	END AS importe
								FROM  recibos_ingreso AS Reg
								INNER JOIN recibos_ingreso_detalles AS Det ON Reg.recibo_ingreso_id = Det.recibo_ingreso_id
								LEFT JOIN facturas_maquinaria AS FM ON Det.referencia_id = FM.factura_maquinaria_id  
									 AND Det.referencia = 'MAQUINARIA'
								LEFT JOIN facturas_refacciones AS FR ON Det.referencia_id = FR.factura_refacciones_id  
									 AND Det.referencia = 'REFACCIONES'
								LEFT JOIN facturas_servicio AS FS ON Det.referencia_id = FS.factura_servicio_id  
									 AND Det.referencia = 'SERVICIO'
								LEFT JOIN facturas_conceptos AS FC ON Det.referencia_id = FC.factura_concepto_id  
									 AND Det.referencia = 'CONCEPTO'
							    LEFT JOIN cartera AS CT ON Det.referencia_id = CT.cartera_id  
									 AND Det.referencia = 'CARTERA' $strRestriccionesDetModulosCart
								WHERE  Reg.prospecto_id = $intProspectoID
								AND    (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
								$strRestriccionesSucursales
							    $strRestriccionesDetModulos
								AND  (FM.moneda_id = $intMonedaID OR 
									  FR.moneda_id = $intMonedaID OR
									  FS.moneda_id = $intMonedaID OR
									  FC.moneda_id = $intMonedaID OR
									  CT.moneda_id = $intMonedaID)
								GROUP BY Det.recibo_ingreso_id, Det.referencia, Det.referencia_id";

		//Pagos
		$queryPagos = "SELECT Reg.folio, PD.fecha_pago AS fecha, Reg.fecha_creacion, 
							  Reg.estatus,  DATE_FORMAT(PD.fecha_pago, '%d/%m/%Y') AS fecha_format, 
							  'PAGO' AS descripcion,
						      PDR.folio AS folio_referencia, 'abono' AS tipo,
							  CASE 
						 		WHEN PDR.tipo_referencia = 'MAQUINARIA' AND FM.moneda_id <> PD.moneda_id
									  THEN 
									   SUM(ROUND((PDR.imp_pagado/FM.tipo_cambio),2))
						        WHEN PDR.tipo_referencia = 'REFACCIONES' AND FR.moneda_id <> PD.moneda_id
									  THEN  
									   SUM(ROUND((PDR.imp_pagado/FR.tipo_cambio),2))
						        WHEN PDR.tipo_referencia = 'SERVICIO' AND FS.moneda_id <> PD.moneda_id
									  THEN  
									  SUM(ROUND((PDR.imp_pagado/FS.tipo_cambio),2))
						        WHEN PDR.tipo_referencia = 'CONCEPTO' AND FC.moneda_id <> PD.moneda_id
									  THEN  
									    SUM(ROUND((PDR.imp_pagado/FC.tipo_cambio),2))
								WHEN PDR.tipo_referencia = 'CARTERA' AND CT.moneda_id <> PD.moneda_id
									  THEN  
									  SUM(ROUND((PDR.imp_pagado/CT.tipo_cambio),2))
						        ELSE
						         	 SUM(ROUND((PDR.imp_pagado/PD.tipo_cambio),2))
						 	END AS importe
						FROM   pagos AS Reg
						INNER JOIN pagos_detalles_02 AS PD ON Reg.pago_id = PD.pago_id
						INNER JOIN pagos_detalles_relacionados_02 AS PDR ON Reg.pago_id = PDR.pago_id
							  AND PDR.renglon_detalles = PD.renglon
						LEFT JOIN facturas_maquinaria AS FM ON PDR.referencia_id = FM.factura_maquinaria_id  
							 AND PDR.tipo_referencia = 'MAQUINARIA'
					    LEFT JOIN facturas_refacciones AS FR ON PDR.referencia_id = FR.factura_refacciones_id  
						     AND PDR.tipo_referencia = 'REFACCIONES'
						LEFT JOIN facturas_servicio AS FS ON PDR.referencia_id = FS.factura_servicio_id  
							 AND PDR.tipo_referencia = 'SERVICIO'
						LEFT JOIN facturas_conceptos AS FC ON PDR.referencia_id = FC.factura_concepto_id  
							 AND PDR.tipo_referencia = 'CONCEPTO'
					    LEFT JOIN cartera AS CT ON PDR.referencia_id = CT.cartera_id  
							 AND PDR.tipo_referencia = 'CARTERA'  $strRestriccionesDetModulosCart
						WHERE  Reg.prospecto_id = $intProspectoID
						AND    (DATE_FORMAT(PD.fecha_pago, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
						$strRestriccionesSucursales
						$strRestriccionesDetPagoModulos
						AND  (FM.moneda_id = $intMonedaID OR 
							  FR.moneda_id = $intMonedaID OR
							  FS.moneda_id = $intMonedaID OR
							  FC.moneda_id = $intMonedaID OR
							  CT.moneda_id = $intMonedaID)
						GROUP BY Reg.pago_id, PD.renglon, PDR.renglon";


		//Si existen módulos seleccionados
		if($strRestriccionesModulos != '')
		{
			//Formar consulta
			//Si existe modulo de maquinaria
			if($strRestriccionModMaquinaria != '')
			{
			   //Concatenar facturas y devoluciones de maquinaria
			   $queryMovimientos .= $queryMaquinaria;
			   $queryMovimientos .= " UNION ";
			   $queryMovimientos .= $queryDevMaquinaria;
			}

			//Si existe modulo de refacciones
			if($strRestriccionModRefacciones != '')
			{
				//Si existen facturas  asignar condición UNION
				$queryMovimientos .= (($queryMovimientos !== '') ? 
									" UNION " : '');

				//Concatenar facturas y devoluciones de refacciones
				$queryMovimientos .= $queryRefacciones;
				$queryMovimientos .= " UNION ";
			    $queryMovimientos .= $queryDevRefacciones;
			}

			//Si existe modulo de servicio
			if($strRestriccionModServicio != '')
			{
				//Si existen facturas asignar condición UNION
				$queryMovimientos .= (($queryMovimientos !== '') ? 
										" UNION " : '');

				//Concatenar facturas, devoluciones y notas de crédito de servicio
				$queryMovimientos .= $queryServicio;
				$queryMovimientos .= " UNION ";
			    $queryMovimientos .= $queryDevServicio;
			    $queryMovimientos .= " UNION ";
			    $queryMovimientos .= $queryNotasCreditoServicio;
			}

			//Si existe modulo de conceptos
			if($strRestriccionModConceptos != '')
			{
				//Si existen facturas asignar condición UNION
				$queryMovimientos .= (($queryMovimientos !== '') ? 
										" UNION " : '');

				//Concatenar facturas de conceptos
				$queryMovimientos .= $queryConceptos;
			}

			//Si existen facturas asignar condición UNION
			$queryMovimientos .= (($queryMovimientos !== '') ? 
								   " UNION " : '');
			$queryMovimientos .= $queryCartera;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryNotasCargo;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryNotasCargoDigitales;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryNotasCreditoDigitales;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryPolizasAbono;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryRecibosIngreso;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryPagos;
			$queryMovimientos .= $strOrdenamiento;
		}
		else
		{
			//Formar consulta
		    $queryMovimientos .= $queryMaquinaria;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryDevMaquinaria;
		    $queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryRefacciones;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryDevRefacciones;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryServicio;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryDevServicio;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryNotasCreditoServicio;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryConceptos;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryCartera;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryNotasCargo;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryNotasCargoDigitales;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryNotasCreditoDigitales;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryPolizasAbono;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryRecibosIngreso;
			$queryMovimientos .= " UNION ";
			$queryMovimientos .= $queryPagos;
			$queryMovimientos .= $strOrdenamiento;
		}
	
		
		$strSQL = $this->db->query($queryMovimientos);
		return $strSQL->result();
	}

}
?>