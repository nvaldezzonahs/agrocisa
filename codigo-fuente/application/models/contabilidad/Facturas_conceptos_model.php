<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');
//Incluir la clase modelo de CFDI relacionados (para guardar los CFDI relacionados del registro)
include_once(APPPATH . 'models/caja/Cfdi_relacionados_model.php');
//Incluir la clase modelo de cancelaciones (para guardar la cancelación del timbrado (CFDI))
include_once(APPPATH . 'models/contabilidad/Cancelaciones_model.php');

class Facturas_conceptos_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla facturas_conceptos
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objFacturaConcepto)
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
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objFacturaConcepto->strFolio); 

		//Concatenar hora, minutos y segundos
		$dteFecha = $objFacturaConcepto->dteFecha.' '.date("H:i:s"); 

		//Tabla facturas_conceptos
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objFacturaConcepto->intSucursalID, 
						  'folio' => $strFolioConsecutivo,
						  'fecha' => $dteFecha,
						  'condiciones_pago' => $objFacturaConcepto->strCondicionesPago,
						  'vencimiento' => $objFacturaConcepto->dteVencimiento,
						  'moneda_id' => $objFacturaConcepto->intMonedaID, 
						  'tipo_cambio' => $objFacturaConcepto->intTipoCambio, 
						  'prospecto_id' => $objFacturaConcepto->intProspectoID, 
						  'razon_social' => $objFacturaConcepto->strRazonSocial,
						  'rfc' => $objFacturaConcepto->strRfc,
						  'regimen_fiscal_id' => $objFacturaConcepto->intRegimenFiscalID,
						  'calle' => $objFacturaConcepto->strCalle,
						  'numero_exterior' => $objFacturaConcepto->strNumeroExterior,
						  'numero_interior' => $objFacturaConcepto->strNumeroInterior,
						  'codigo_postal' => $objFacturaConcepto->strCodigoPostal,
						  'colonia' => $objFacturaConcepto->strColonia,
						  'localidad' => $objFacturaConcepto->strLocalidad,
						  'municipio' => $objFacturaConcepto->strMunicipio,
						  'estado' => $objFacturaConcepto->strEstado,
						  'pais' => $objFacturaConcepto->strPais,
						  'forma_pago_id' => $objFacturaConcepto->intFormaPagoID,
						  'metodo_pago_id' => $objFacturaConcepto->intMetodoPagoID,
						  'uso_cfdi_id' => $objFacturaConcepto->intUsoCfdiID,
						  'tipo_relacion_id' => $objFacturaConcepto->intTipoRelacionID,
						  'exportacion_id' => $objFacturaConcepto->intExportacionID,
						  'observaciones' => $objFacturaConcepto->strObservaciones, 
						  'notas' => $objFacturaConcepto->strNotas, 
						  'estatus'  => 'TIMBRAR',
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objFacturaConcepto->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('facturas_conceptos', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objFacturaConcepto->intFacturaConceptoID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la factura
		$this->guardar_detalles($objFacturaConcepto);

		//Hacer un llamado al método para guardar los CFDI relacionados de la factura
		$otdModelCfdiRelacionados->guardar($objFacturaConcepto->intFacturaConceptoID, 
										   'FACTURA CONCEPTOS', 
										   $objFacturaConcepto->strCfdiRelacionado, 
										   $objFacturaConcepto->strTiposRelacion);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objFacturaConcepto->intFacturaConceptoID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objFacturaConcepto)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

		//Concatenar hora, minutos y segundos
		$dteFecha = $objFacturaConcepto->dteFecha.' '.date("H:i:s"); 
		
		//Tabla facturas_conceptos
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha,
						  'condiciones_pago' => $objFacturaConcepto->strCondicionesPago,
						  'vencimiento' => $objFacturaConcepto->dteVencimiento,
						  'moneda_id' => $objFacturaConcepto->intMonedaID, 
						  'tipo_cambio' => $objFacturaConcepto->intTipoCambio, 
						  'prospecto_id' => $objFacturaConcepto->intProspectoID, 
						  'razon_social' => $objFacturaConcepto->strRazonSocial,
						  'rfc' => $objFacturaConcepto->strRfc,
						  'regimen_fiscal_id' => $objFacturaConcepto->intRegimenFiscalID,
						  'calle' => $objFacturaConcepto->strCalle,
						  'numero_exterior' => $objFacturaConcepto->strNumeroExterior,
						  'numero_interior' => $objFacturaConcepto->strNumeroInterior,
						  'codigo_postal' => $objFacturaConcepto->strCodigoPostal,
						  'colonia' => $objFacturaConcepto->strColonia,
						  'localidad' => $objFacturaConcepto->strLocalidad,
						  'municipio' => $objFacturaConcepto->strMunicipio,
						  'estado' => $objFacturaConcepto->strEstado,
						  'pais' => $objFacturaConcepto->strPais,
						  'forma_pago_id' => $objFacturaConcepto->intFormaPagoID,
						  'metodo_pago_id' => $objFacturaConcepto->intMetodoPagoID,
						  'uso_cfdi_id' => $objFacturaConcepto->intUsoCfdiID,
						  'tipo_relacion_id' => $objFacturaConcepto->intTipoRelacionID,
						  'exportacion_id' => $objFacturaConcepto->intExportacionID,
						  'observaciones' => $objFacturaConcepto->strObservaciones, 
						  'notas' => $objFacturaConcepto->strNotas, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objFacturaConcepto->intUsuarioID);
		$this->db->where('factura_concepto_id', $objFacturaConcepto->intFacturaConceptoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('facturas_conceptos', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('factura_concepto_id', $objFacturaConcepto->intFacturaConceptoID);
		$this->db->delete('facturas_conceptos_detalles');
		//Hacer un llamado al método para guardar los detalles de la factura
		$this->guardar_detalles($objFacturaConcepto);


		//Hacer un llamado al método para guardar los CFDI relacionados de la factura
		$otdModelCfdiRelacionados->guardar($objFacturaConcepto->intFacturaConceptoID, 
										   'FACTURA CONCEPTOS', 
										   $objFacturaConcepto->strCfdiRelacionado, 
										   $objFacturaConcepto->strTiposRelacion);

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
		$this->db->where('factura_concepto_id', $objTimbrado->intReferenciaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('facturas_conceptos', $arrDatos);
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

		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('factura_concepto_id', $objCancelacionCfdi->intReferenciaCfdiID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('facturas_conceptos', $arrDatos);

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
	public function buscar($intFacturaConceptoID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		
		$this->db->select("FC.factura_concepto_id, FC.sucursal_id, FC.folio, FC.fecha, 
						   DATE_FORMAT(FC.fecha,'%d/%m/%Y') AS fecha_format,
						   FC.condiciones_pago,
			 			   DATE_FORMAT(FC.vencimiento,'%d/%m/%Y') AS vencimiento, 
			 			   FC.moneda_id, FC.tipo_cambio, FC.prospecto_id,
			 			   FC.razon_social, FC.rfc,  
			 			   CASE 
							   WHEN  FC.regimen_fiscal_id > 0 
							   		THEN FC.regimen_fiscal_id		
							   ELSE IFNULL(C.regimen_fiscal_id,0)
						    END regimen_fiscal_id, 
			 			   FC.calle, FC.numero_exterior, FC.numero_interior,
			 			   FC.codigo_postal, FC.colonia, FC.localidad, FC.municipio, FC.estado,
			 			   FC.pais, FC.forma_pago_id, FC.metodo_pago_id, FC.uso_cfdi_id, 
			 			   FC.tipo_relacion_id,  FC.exportacion_id, FC.observaciones, FC.notas, FC.estatus, 
			 			   FC.certificado, FC.sello, FC.uuid, FC.fecha_timbrado, FC.certificado_sat, 
			 			   FC.sello_sat, FC.leyenda_sat, FC.rfc_pac,
			 			   C.correo_electronico, C.contacto_correo_electronico,
			 			   C.maquinaria_credito_dias,  M.codigo AS MonedaTipo,
			 			    CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						    CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, 
						    FP.codigo AS FormaPago, 
						    CONCAT_WS(' - ', MP.codigo, MP.descripcion) AS metodo_pago, 
						    MP.codigo AS MetodoPago,
							 CONCAT_WS(' - ', U.codigo, U.descripcion) AS uso_cfdi,  
						    U.codigo AS UsoCFDI,
						    CONCAT_WS(' - ', TR.codigo, TR.descripcion) AS tipo_relacion, 
						    TR.codigo AS TipoRelacion,
						    FC.condiciones_pago AS CondicionesDePago,
						    _utf8'I' AS TipoDeComprobante,
						   	CONCAT_WS(' - ', TC.codigo, TC.descripcion) AS tipo_comprobante,
						   RF.codigo AS RegimenFiscal,
						   CONCAT_WS(' - ', RF.codigo, RF.descripcion) AS regimen_fiscal,
						   ECF.codigo AS CodigoExportacion,
						   CONCAT_WS(' - ', ECF.codigo, ECF.descripcion) AS exportacion,
						   	PRO.codigo AS CodigoProspecto,
						   	IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza,
						   	UC.usuario AS usuario_creacion", FALSE);
	    $this->db->from('facturas_conceptos AS FC');
	    $this->db->join('sat_monedas AS M', 'FC.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'FC.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'FC.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'FC.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'FC.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'FC.tipo_relacion_id = TR.tipo_relacion_id', 'left');
	    $this->db->join('sat_tipos_comprobante AS TC', 'TC.codigo = "I"', 'left');
	    $this->db->join('sat_exportacion AS ECF', 'FC.exportacion_id = ECF.exportacion_id', 'left');
	    $this->db->join('sat_regimen_fiscal AS RF', 'FC.regimen_fiscal_id = RF.regimen_fiscal_id', 'left');
	    $this->db->join('usuarios AS UC', 'FC.usuario_creacion = UC.usuario_id', 'left');
	    $this->db->join('polizas AS PF', 'FC.factura_concepto_id = PF.referencia_id AND
	    							      PF.modulo = "CONTABILIDAD" AND PF.proceso = "FACTURACION"', 'left');
		//Si existe id de la factura
		if ($intFacturaConceptoID != NULL)
		{   
			$this->db->where('FC.factura_concepto_id', $intFacturaConceptoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('FC.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('FC.prospecto_id', $intProspectoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(FC.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }
		    
		     //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(FC.estatus = 'TIMBRAR' OR FC.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('FC.estatus', $strEstatus);
				}
			}

			$this->db->where("((FC.folio LIKE '%$strBusqueda%') OR
		    				   (CONCAT_WS(' - ', FC.rfc, FC.razon_social) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', FC.rfc, FC.razon_social) LIKE '%$strBusqueda%') OR
	    				       (CONCAT_WS(' - ', FC.razon_social, FC.rfc) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', FC.razon_social, FC.rfc) LIKE '%$strBusqueda%'))");

			$this->db->order_by('FC.fecha DESC, FC.folio DESC');
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
		$this->db->from('facturas_conceptos AS FC');
		$this->db->join('sat_monedas AS M', 'FC.moneda_id = M.moneda_id', 'inner');
		$this->db->where('FC.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
	    if($intProspectoID > 0)
	    {
	   		$this->db->where('FC.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(FC.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('FC.estatus', $strEstatus);
		}

		$this->db->where("((FC.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', FC.rfc, FC.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', FC.rfc, FC.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', FC.razon_social, FC.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', FC.razon_social, FC.rfc) LIKE '%$strBusqueda%'))");

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar la información de un movimiento fiscal que será cancelado
	public function buscar_movimiento_fiscal($intFacturaConceptoID)
	{
		$strSQL = $this->db->query("SELECT E.rfc AS RFC, 
										   NOW() AS Fecha, 
										   FC.uuid, 
										   FC.folio 
									FROM facturas_conceptos AS FC
									INNER JOIN sucursales AS S ON S.sucursal_id = FC.sucursal_id   
									INNER JOIN empresas E ON E.empresa_id = S.empresa_id
									WHERE FC.factura_concepto_id = $intFacturaConceptoID");
		return $strSQL->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL,
		                   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoRefCFDI = $this->db->escape('FACTURA CONCEPTOS');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('FC.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('FC.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(FC.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(FC.estatus = 'TIMBRAR' OR FC.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('FC.estatus', $strEstatus);
			}
		}

		$this->db->where("((FC.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', FC.rfc, FC.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', FC.rfc, FC.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', FC.razon_social, FC.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', FC.razon_social, FC.rfc) LIKE '%$strBusqueda%'))");

	    $this->db->from('facturas_conceptos AS FC');
	    $this->db->join('sat_monedas AS M', 'FC.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'FC.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'FC.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'FC.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'FC.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('polizas AS PF', 'FC.factura_concepto_id = PF.referencia_id AND
	    							     PF.modulo = "CONTABILIDAD" AND PF.proceso = "FACTURACION"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("FC.factura_concepto_id, FC.folio, 
						   DATE_FORMAT(FC.fecha,'%d/%m/%Y') AS fecha, 
					       FC.rfc, FC.razon_social, 
					       IFNULL(FC.regimen_fiscal_id,0) AS regimen_fiscal_id,
						   FC.estatus, FC.uuid, 	
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza, 
						   IFNULL(CCFDI.cancelacion_id, 0) AS cancelacion_id", FALSE);
	    $this->db->from('facturas_conceptos AS FC');
	    $this->db->join('sat_monedas AS M', 'FC.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'FC.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'FC.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'FC.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'FC.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	   $this->db->join('polizas AS PF', 'FC.factura_concepto_id = PF.referencia_id AND
	    							     PF.modulo = "CONTABILIDAD" AND PF.proceso = "FACTURACION"', 'left');
	   $this->db->join('cancelaciones AS CCFDI', 'CCFDI.tipo_referencia = '.$strTipoRefCFDI.' 
	    							        	  AND CCFDI.referencia_id = FC.factura_concepto_id', 'left');

		$this->db->where('FC.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('FC.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(FC.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(FC.estatus = 'TIMBRAR' OR FC.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('FC.estatus', $strEstatus);
			}
		}

		$this->db->where("((FC.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', FC.rfc, FC.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', FC.rfc, FC.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', FC.razon_social, FC.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', FC.razon_social, FC.rfc) LIKE '%$strBusqueda%'))");

		$this->db->order_by('FC.fecha DESC, FC.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["facturas"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strFormulario, $intReferenciaID)
	{
		$this->db->select('factura_concepto_id, folio, uuid');
        $this->db->from('facturas_conceptos');
        $this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
        //Si el formulario corresponde a una cancelación de timbrado
        if($strFormulario == 'cancelacion')
        {
        	$this->db->where('factura_concepto_id <>', $intReferenciaID);
        }
     	$this->db->where('estatus', 'ACTIVO');
        $this->db->where("(folio LIKE '%$strDescripcion%')");
        $this->db->order_by('folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}


	/*******************************************************************************************************************
	Funciones de la tabla facturas_conceptos_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la factura
	public function guardar_detalles(stdClass $objFacturaConcepto)
	{

		/*Quitar | de la lista para obtener el concepto, código SAT, unidad SAT, cantidad, precio unitario, descuento unitario, iva unitario e ieps unitario
		*/
		$arrConceptoTipoID = explode("|", $objFacturaConcepto->strConceptoTipoID);
		$arrConceptos = explode("|", $objFacturaConcepto->strConceptos);
		$arrCodigosSat = explode("|", $objFacturaConcepto->strCodigosSat);
		$arrUnidadesSat = explode("|", $objFacturaConcepto->strUnidadesSat);
		$arrObjetoImpuestoSat = explode("|", $objFacturaConcepto->strObjetoImpuestoSat);
		$arrCantidades = explode("|", $objFacturaConcepto->strCantidades);
		$arrPreciosUnitarios = explode("|", $objFacturaConcepto->strPreciosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objFacturaConcepto->strDescuentosUnitarios);
		$arrTasaCuotaIva = explode("|", $objFacturaConcepto->strTasaCuotaIva);
		$arrIvasUnitarios = explode("|", $objFacturaConcepto->strIvasUnitarios);
		$arrTasaCuotaIeps = explode("|", $objFacturaConcepto->strTasaCuotaIeps);
		$arrIepsUnitarios = explode("|", $objFacturaConcepto->strIepsUnitarios);

		//Hacer recorrido para insertar los datos en la tabla facturas_conceptos_detalles
		for ($intCon = 0; $intCon < sizeof($arrConceptos); $intCon++) 
		{
		
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);
			
			//Asignar datos al array
			$arrDatos = array('factura_concepto_id' => $objFacturaConcepto->intFacturaConceptoID,
							  'renglon' => ($intCon + 1),
							  'concepto_tipo_id' => $arrConceptoTipoID[$intCon], 
							  'concepto' => $arrConceptos[$intCon], 
							  'codigo_sat' => $arrCodigosSat[$intCon],
							  'unidad_sat' => $arrUnidadesSat[$intCon],
							  'objeto_impuesto_sat' => $arrObjetoImpuestoSat[$intCon],
							  'cantidad' => $arrCantidades[$intCon],
							  'precio_unitario' => $arrPreciosUnitarios[$intCon],
							  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva_unitario' => $arrIvasUnitarios[$intCon], 
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps_unitario' => $arrIepsUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('facturas_conceptos_detalles', $arrDatos);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intFacturaConceptoID)
	{
		$this->db->select("FCD.renglon, FCD.concepto_tipo_id, FCD.concepto, FCD.codigo_sat, FCD.unidad_sat,
						   FCD.objeto_impuesto_sat, FCD.cantidad, FCD.precio_unitario, FCD.descuento_unitario,
						   FCD.tasa_cuota_iva, FCD.iva_unitario, FCD.tasa_cuota_ieps,
						   FCD.ieps_unitario, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps,
						   CONCAT_WS(' - ', PS.codigo, PS.descripcion) AS producto_servicio, 
						   CONCAT_WS(' - ', U.codigo, U.nombre) AS unidad, 
						   CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto, 
						   CT.descripcion AS concepto_tipo", FALSE);
		$this->db->from('facturas_conceptos_detalles AS FCD');
		$this->db->join('conceptos_tipos AS CT', 'FCD.concepto_tipo_id = CT.concepto_tipo_id', 'inner');
		$this->db->join('sat_productos_servicios AS PS', 'FCD.codigo_sat = PS.codigo', 'inner');
		$this->db->join('sat_unidades AS U', 'FCD.unidad_sat = U.codigo', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'FCD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'FCD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('sat_objeto_impuesto AS OImp', 'FCD.objeto_impuesto_sat = OImp.codigo', 'left');
		$this->db->where('FCD.factura_concepto_id', $intFacturaConceptoID);
		$this->db->order_by('FCD.renglon', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los detalles de un registro (se utiliza para generar póliza)
	public function buscar_detalles_poliza($intFacturaConceptoID)
	{
		$strSQL = $this->db->query("SELECT FCD.factura_concepto_id AS ID, FCD.renglon,
										   SUM(FCD.cantidad * FCD.precio_unitario) AS Subtotal,
										   FCD.tasa_cuota_iva, 
										   ROUND(SUM(FCD.cantidad * FCD.iva_unitario), 2) AS IVA,
										   FCD.concepto_tipo_id, CT.descripcion AS Concepto
								    FROM   facturas_conceptos_detalles AS FCD 
								    INNER JOIN conceptos_tipos AS CT ON FCD.concepto_tipo_id = CT.concepto_tipo_id
								    WHERE  FCD.factura_concepto_id = $intFacturaConceptoID
								    GROUP BY FCD.factura_concepto_id, FCD.renglon, FCD.tasa_cuota_iva
								    ORDER BY FCD.renglon, FCD.tasa_cuota_iva");

		return $strSQL->result();

	}

	//Método para regresar los detalles de un registro (se utiliza para el timbrado de la factura)
	public function buscar_detalles_xml($intFacturaConceptoID)
	{
		$strSQL = $this->db->query("
							SELECT FCD.factura_concepto_id AS ID, 
								   FCD.renglon AS renglon,  
							   	   FCD.codigo_sat AS ClaveProdServ,
								   _utf8'' AS NoIdentificacion, 
								  FCD.cantidad AS cantidad,
							      FCD.unidad_sat AS ClaveUnidad, 
							      U.nombre AS Unidad,
							      FCD.objeto_impuesto_sat AS ClaveObjetoImpuesto, 
							      FCD.concepto AS Descripcion,
							      FCD.concepto AS concepto,									
								  FCD.precio_unitario AS subtotal, 
								  FCD.descuento_unitario AS descuento, 
								  FCD.iva_unitario AS iva, 
								  FCD.ieps_unitario AS ieps,
								  _utf8'' AS Pedimento, 
								  TIva.valor_maximo AS PorcentajeIva, 
								  TIva.factor AS FactorIva,  
								  IIva.codigo AS ImpuestoIva,  
								  TIeps.valor_maximo AS PorcentajeIeps,
								  TIeps.factor AS FactorIeps, 
								  IIeps.codigo AS ImpuestoIeps, 
								  CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto
							FROM facturas_conceptos_detalles AS FCD
							INNER JOIN sat_productos_servicios AS PS ON FCD.codigo_sat = PS.codigo
							INNER JOIN sat_unidades AS U ON FCD.unidad_sat = U.codigo
							INNER JOIN  sat_tasa_cuota AS TIva ON FCD.tasa_cuota_iva = TIva.tasa_cuota_id
							INNER JOIN  sat_impuestos AS IIva ON TIva.impuesto_id = IIva.impuesto_id		
							LEFT JOIN  sat_tasa_cuota AS TIeps ON FCD.tasa_cuota_ieps = TIeps.tasa_cuota_id		
							LEFT JOIN  sat_impuestos AS IIeps ON TIeps.impuesto_id = IIeps.impuesto_id
							LEFT JOIN sat_objeto_impuesto AS OImp ON FCD.objeto_impuesto_sat = OImp.codigo
							WHERE FCD.factura_concepto_id = $intFacturaConceptoID");

		return $strSQL->result();
	}

}
?>