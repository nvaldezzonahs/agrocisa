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


class notas_cargo_digitales_model extends CI_model {

	/*******************************************************************************************************************
	Funciones de la tabla notas_cargo_digitales
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objNotaCargoDigital)
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
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objNotaCargoDigital->strFolio); 

		//Concatenar hora, minutos y segundos
		$dteFecha = $objNotaCargoDigital->dteFecha.' '.date("H:i:s"); 

		//Tabla notas_cargo_digitales
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objNotaCargoDigital->intSucursalID,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha, 
						  'moneda_id' => $objNotaCargoDigital->intMonedaID, 
						  'tipo_cambio' => $objNotaCargoDigital->intTipoCambio,
						  'prospecto_id' => $objNotaCargoDigital->intProspectoID,
						  'razon_social' => $objNotaCargoDigital->strRazonSocial, 
						  'rfc' => $objNotaCargoDigital->strRfc, 
						  'regimen_fiscal_id' => $objNotaCargoDigital->intRegimenFiscalID,
						  'calle' => $objNotaCargoDigital->strCalle,
						  'numero_exterior' => $objNotaCargoDigital->strNumeroExterior,
						  'numero_interior' => $objNotaCargoDigital->strNumeroInterior,
						  'codigo_postal' => $objNotaCargoDigital->strCodigoPostal,
						  'colonia' => $objNotaCargoDigital->strColonia,
						  'localidad' => $objNotaCargoDigital->strLocalidad,
						  'municipio' => $objNotaCargoDigital->strMunicipio,
						  'estado' => $objNotaCargoDigital->strEstado,
						  'pais' => $objNotaCargoDigital->strPais,
						  'forma_pago_id' => $objNotaCargoDigital->intFormaPagoID,
						  'metodo_pago_id' => $objNotaCargoDigital->intMetodoPagoID,
						  'uso_cfdi_id' => $objNotaCargoDigital->intUsoCfdiID,
						  'tipo_relacion_id' => $objNotaCargoDigital->intTipoRelacionID,
						  'exportacion_id' => $objNotaCargoDigital->intExportacionID,
						  'observaciones' => $objNotaCargoDigital->strObservaciones,
						  'estatus'  => 'TIMBRAR',
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objNotaCargoDigital->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('notas_cargo_digitales', $arrDatos);
		
		//Agregar id del nuevo registro al objeto
		$objNotaCargoDigital->intNotaCargoDigitalID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la nota de cargo digital
		$this->guardar_detalles($objNotaCargoDigital);

		//Hacer un llamado al método para guardar los CFDI relacionados de la nota de cargo digital
		$otdModelCfdiRelacionados->guardar($objNotaCargoDigital->intNotaCargoDigitalID, 
										   'NOTA CARGO', 
										   $objNotaCargoDigital->strCfdiRelacionado, 
										   $objNotaCargoDigital->strTiposRelacion);
			
		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objNotaCargoDigital->intNotaCargoDigitalID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objNotaCargoDigital)
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

		//Concatenar hora, minutos y segundos
		$dteFecha = $objNotaCargoDigital->dteFecha.' '.date("H:i:s"); 

		//Tabla notas_cargo_digitales
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha, 
						  'moneda_id' => $objNotaCargoDigital->intMonedaID, 
						  'tipo_cambio' => $objNotaCargoDigital->intTipoCambio,
						  'prospecto_id' => $objNotaCargoDigital->intProspectoID,
						  'razon_social' => $objNotaCargoDigital->strRazonSocial, 
						  'rfc' => $objNotaCargoDigital->strRfc, 
						  'regimen_fiscal_id' => $objNotaCargoDigital->intRegimenFiscalID,
						  'calle' => $objNotaCargoDigital->strCalle,
						  'numero_exterior' => $objNotaCargoDigital->strNumeroExterior,
						  'numero_interior' => $objNotaCargoDigital->strNumeroInterior,
						  'codigo_postal' => $objNotaCargoDigital->strCodigoPostal,
						  'colonia' => $objNotaCargoDigital->strColonia,
						  'localidad' => $objNotaCargoDigital->strLocalidad,
						  'municipio' => $objNotaCargoDigital->strMunicipio,
						  'estado' => $objNotaCargoDigital->strEstado,
						  'pais' => $objNotaCargoDigital->strPais,
						  'forma_pago_id' => $objNotaCargoDigital->intFormaPagoID,
						  'metodo_pago_id' => $objNotaCargoDigital->intMetodoPagoID,
						  'uso_cfdi_id' => $objNotaCargoDigital->intUsoCfdiID,
						  'tipo_relacion_id' => $objNotaCargoDigital->intTipoRelacionID,
						  'exportacion_id' => $objNotaCargoDigital->intExportacionID,
						  'observaciones' => $objNotaCargoDigital->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objNotaCargoDigital->intUsuarioID);
		$this->db->where('nota_cargo_digital_id', $objNotaCargoDigital->intNotaCargoDigitalID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('notas_cargo_digitales', $arrDatos);

		//Eliminar los detalles guardados de la nota de cargo digital
		$this->db->where('nota_cargo_digital_id', $objNotaCargoDigital->intNotaCargoDigitalID);
		$this->db->delete('notas_cargo_digitales_detalles');
		
		//Hacer un llamado al método para guardar los detalles de la nota de cargo digital
		$this->guardar_detalles($objNotaCargoDigital);

		//Hacer un llamado al método para guardar los CFDI relacionados de la nota de cargo digital
		$otdModelCfdiRelacionados->guardar($objNotaCargoDigital->intNotaCargoDigitalID, 
										   'NOTA CARGO', 
										   $objNotaCargoDigital->strCfdiRelacionado, 
										   $objNotaCargoDigital->strTiposRelacion);

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
		$this->db->where('nota_cargo_digital_id',  $objTimbrado->intReferenciaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('notas_cargo_digitales', $arrDatos);
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

 		 //Modificar el estatus a INACTIVO de un registro de notas de cargo
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('nota_cargo_digital_id', $objCancelacionCfdi->intReferenciaCfdiID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('notas_cargo_digitales', $arrDatos);

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
	public function buscar($intNotaCargoDigitalID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
					       $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';

		//Si existe id de la nota de cargo digital
		if ($intNotaCargoDigitalID !== NULL)
		{   

			$strRestricciones .= " AND NCD.nota_cargo_digital_id = $intNotaCargoDigitalID";
		}
		else
		{
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$strRestricciones .= " AND NCD.prospecto_id = $intProspectoID";
		    }

			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$strRestricciones .= " AND (DATE_FORMAT(NCD.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
		    }

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{
					$strRestricciones .= " AND (IFNULL(PF.poliza_id, 0) = 0)";
					$strRestricciones .= " AND (NCD.estatus = 'TIMBRAR' OR NCD.estatus = 'ACTIVO')";

				}
				else
				{
					$strRestricciones .= " AND NCD.estatus = '$strEstatus'";
				}
			}

			$strRestricciones .= " AND ((NCD.folio LIKE '%$strBusqueda%') OR
				    				   (CONCAT_WS(' - ', NCD.rfc, NCD.razon_social) LIKE '%$strBusqueda%') OR
					                   (CONCAT_WS(' ', NCD.rfc, NCD.razon_social) LIKE '%$strBusqueda%') OR
			    				       (CONCAT_WS(' - ', NCD.razon_social, NCD.rfc) LIKE '%$strBusqueda%') OR
					                   (CONCAT_WS(' ', NCD.razon_social, NCD.rfc) LIKE '%$strBusqueda%'))";
		}

		//Formar consulta
		$queryNotasCargo = "SELECT NCD.nota_cargo_digital_id, NCD.folio,
									NCD.fecha, DATE_FORMAT(NCD.fecha,'%d/%m/%Y') AS fecha_format,
								   	NCD.moneda_id, 	NCD.tipo_cambio, NCD.prospecto_id, 
								   	NCD.razon_social, NCD.rfc, 
								   	CASE 
									   WHEN  NCD.regimen_fiscal_id > 0 
									   		THEN NCD.regimen_fiscal_id		
									   ELSE IFNULL(C.regimen_fiscal_id,0)
								    END regimen_fiscal_id,
								   	NCD.calle, NCD.numero_exterior, 
								   	NCD.numero_interior, NCD.codigo_postal, NCD.colonia, 
								   	NCD.localidad, NCD.municipio, NCD.estado, 
								   	NCD.pais, NCD.forma_pago_id, NCD.metodo_pago_id,
								   	NCD.uso_cfdi_id, NCD.tipo_relacion_id,  NCD.exportacion_id, NCD.observaciones, NCD.estatus, 
								   	NCD.certificado, NCD.sello, NCD.uuid, NCD.fecha_timbrado, 
								    NCD.certificado_sat, NCD.sello_sat,NCD.leyenda_sat, NCD.rfc_pac,
								   	C.nombre_comercial AS cliente, 
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
								    _utf8'I' AS TipoDeComprobante,  
								   	CONCAT_WS(' - ', TC.codigo, TC.descripcion) AS tipo_comprobante,
								   	RF.codigo AS RegimenFiscal,
								   CONCAT_WS(' - ', RF.codigo, RF.descripcion) AS regimen_fiscal,
								   ECF.codigo AS CodigoExportacion,
								   CONCAT_WS(' - ', ECF.codigo, ECF.descripcion) AS exportacion,
								   	PRO.codigo AS CodigoProspecto,
								   	UC.usuario AS usuario_creacion, 
								   	C.correo_electronico, C.contacto_correo_electronico,
								   	ROUND((Detalles.Precio/NCD.tipo_cambio), 2) AS subtotal,
								    ROUND((Detalles.IVA/NCD.tipo_cambio), 2) AS iva,
								    ROUND((Detalles.IEPS/NCD.tipo_cambio), 2) AS ieps, 
								    IFNULL(PF.poliza_id, 0) AS poliza_id,
						   			PF.folio AS folio_poliza
						FROM notas_cargo_digitales AS NCD
						INNER JOIN sat_monedas AS M ON NCD.moneda_id = M.moneda_id
						INNER JOIN clientes AS C ON NCD.prospecto_id = C.prospecto_id
						INNER JOIN prospectos AS PRO ON PRO.prospecto_id = C.prospecto_id
						INNER JOIN sat_forma_pago AS FP ON NCD.forma_pago_id = FP.forma_pago_id
						INNER JOIN sat_metodos_pago AS MP ON NCD.metodo_pago_id = MP.metodo_pago_id
						INNER JOIN sat_uso_cfdi AS U ON NCD.uso_cfdi_id = U.uso_cfdi_id
						INNER JOIN sat_tipos_relacion AS TR ON NCD.tipo_relacion_id = TR.tipo_relacion_id
						INNER JOIN (SELECT Det.nota_cargo_digital_id AS referenciaID,
								    		   SUM(Det.precio) AS Precio, 
								    		   SUM(Det.iva) AS IVA,
								    		   SUM(Det.ieps) AS IEPS
						    		  FROM notas_cargo_digitales_detalles AS Det
						    		  GROUP BY Det.nota_cargo_digital_id) AS Detalles ON Detalles.referenciaID = NCD.nota_cargo_digital_id
						LEFT JOIN sat_tipos_comprobante AS TC ON TC.codigo = 'I'
						LEFT JOIN sat_exportacion AS ECF ON NCD.exportacion_id = ECF.exportacion_id
						LEFT JOIN sat_regimen_fiscal AS RF ON NCD.regimen_fiscal_id = RF.regimen_fiscal_id
						LEFT JOIN usuarios AS UC ON NCD.usuario_creacion = UC.usuario_id
						LEFT JOIN polizas AS PF ON NCD.nota_cargo_digital_id = PF.referencia_id
								 AND  PF.modulo = 'CUENTAS POR COBRAR' AND PF.proceso = 'NOTA CARGO DIGITAL'
						WHERE  NCD.sucursal_id = $intSucursalID
						$strRestricciones
						ORDER BY NCD.fecha DESC, NCD.folio DESC";

		
		$strSQL = $this->db->query($queryNotasCargo);

		//Si existe id de la nota de cargo digital
		if ($intNotaCargoDigitalID !== NULL)
		{ 
			//Regresar datos de la primer fila
			return $strSQL->row();
		}
		else
		{
			//Regresar todas las filas
			return $strSQL->result();
		}
	}

	//Método para regresar la información de un movimiento fiscal que será cancelado
	public function buscar_movimiento_fiscal($intNotaCargoDigitalID)
	{

		$strSQL = $this->db->query("SELECT E.rfc AS RFC, 
										NOW() AS Fecha, 
										NCD.uuid, 
										NCD.folio 
									FROM notas_cargo_digitales AS NCD
									INNER JOIN sucursales AS S ON S.sucursal_id = NCD.sucursal_id  
									INNER JOIN empresas E ON E.empresa_id = S.empresa_id
									WHERE NCD.nota_cargo_digital_id = $intNotaCargoDigitalID");
		return $strSQL->result();
	}


	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
											 $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('notas_cargo_digitales AS NCD');
		$this->db->join('sat_monedas AS M', 'NCD.moneda_id = M.moneda_id', 'inner');
		$this->db->where('NCD.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('NCD.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(NCD.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('NCD.estatus', $strEstatus);
		}

		$this->db->where("((NCD.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', NCD.rfc, NCD.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NCD.rfc, NCD.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', NCD.razon_social, NCD.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NCD.razon_social, NCD.rfc) LIKE '%$strBusqueda%'))");

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL,  
						   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('CUENTAS POR COBRAR');
		$strProcesoPoliza = $this->db->escape('NOTA CARGO DIGITAL');
		$strTipoRefCFDI = $this->db->escape('NOTA CARGO');


		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('NCD.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('NCD.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(NCD.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(NCD.estatus = 'TIMBRAR' OR NCD.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('NCD.estatus', $strEstatus);
			}
		}

		$this->db->where("((NCD.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', NCD.rfc, NCD.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NCD.rfc, NCD.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', NCD.razon_social, NCD.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NCD.razon_social, NCD.rfc) LIKE '%$strBusqueda%'))");

		$this->db->from('notas_cargo_digitales AS NCD');
	    $this->db->join('sat_monedas AS M', 'NCD.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'NCD.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'NCD.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'NCD.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'NCD.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'NCD.tipo_relacion_id = TR.tipo_relacion_id', 'inner');
	    $this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND NCD.nota_cargo_digital_id = PF.referencia_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("NCD.nota_cargo_digital_id, 
						   NCD.folio, 
						   DATE_FORMAT(NCD.fecha,'%d/%m/%Y') AS fecha, 
						   NCD.rfc, NCD.razon_social, 
						   IFNULL(NCD.regimen_fiscal_id,0) AS regimen_fiscal_id,
						   NCD.estatus,  NCD.uuid,
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza, 
						   IFNULL(CCFDI.cancelacion_id, 0) AS cancelacion_id", FALSE);
		$this->db->from('notas_cargo_digitales AS NCD');
	    $this->db->join('sat_monedas AS M', 'NCD.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'NCD.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'NCD.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'NCD.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'NCD.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'NCD.tipo_relacion_id = TR.tipo_relacion_id', 'inner');
	    $this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND NCD.nota_cargo_digital_id = PF.referencia_id', 'left');
	    $this->db->join('cancelaciones AS CCFDI', 'CCFDI.tipo_referencia = '.$strTipoRefCFDI.' 
	    							        	  AND CCFDI.referencia_id = NCD.nota_cargo_digital_id', 'left');

	    $this->db->where('NCD.sucursal_id', $this->session->userdata('sucursal_id'));
	    //Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('NCD.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(NCD.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(NCD.estatus = 'TIMBRAR' OR NCD.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('NCD.estatus', $strEstatus);
			}
		}


		$this->db->where("((NCD.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', NCD.rfc, NCD.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NCD.rfc, NCD.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', NCD.razon_social, NCD.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NCD.razon_social, NCD.rfc) LIKE '%$strBusqueda%'))");
		$this->db->order_by('NCD.fecha DESC, NCD.folio DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["notas"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strFormulario, $intReferenciaID)
	{
		$this->db->select('nota_cargo_digital_id, folio, uuid');
        $this->db->from('notas_cargo_digitales');
        $this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
        //Si el formulario corresponde a una cancelación de timbrado
        if($strFormulario == 'cancelacion')
        {
        	$this->db->where('nota_cargo_digital_id <>', $intReferenciaID);
        }
     	$this->db->where('estatus', 'ACTIVO');
        $this->db->where("(folio LIKE '%$strDescripcion%')");
        $this->db->order_by('folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}



	/*******************************************************************************************************************
	Funciones de la tabla notas_cargo_digitales_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de una nota de cargo digital
	public function guardar_detalles(stdClass $objNotaCargoDigital)
	{
		//Quitar | de la lista para obtener los valores del array
		$arrReferencias = explode("|", $objNotaCargoDigital->strReferencias);
		$arrReferenciaID = explode("|", $objNotaCargoDigital->strReferenciaID);
		$arrConceptos = explode("|", $objNotaCargoDigital->strConceptos);
		$arrObjetoImpuestoSat = explode("|", $objNotaCargoDigital->strObjetoImpuestoSat);
		$arrPrecios = explode("|", $objNotaCargoDigital->strPrecios);
		$arrTasaCuotaIva = explode("|", $objNotaCargoDigital->strTasaCuotaIva);
		$arrIvas = explode("|", $objNotaCargoDigital->strIvas);
		$arrTasaCuotaIeps = explode("|", $objNotaCargoDigital->strTasaCuotaIeps);
		$arrIeps = explode("|", $objNotaCargoDigital->strIeps);

		
		//Hacer recorrido para insertar los datos en la tabla notas_cargo_digitales_detalles
		for ($intCon = 0; $intCon < sizeof($arrReferenciaID); $intCon++) 
		{
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? $arrTasaCuotaIeps[$intCon] : NULL);

			//Asignar datos al array
			$arrDatos = array( 'nota_cargo_digital_id' => $objNotaCargoDigital->intNotaCargoDigitalID,
				 			  'renglon' => ($intCon + 1),
							  'referencia' => $arrReferencias[$intCon],
							  'referencia_id' => $arrReferenciaID[$intCon],
							  'concepto' => $arrConceptos[$intCon],
							  'codigo_sat' => CLAVE_PRODUCTO_SAT_NCARGO,
							  'unidad_sat' => CLAVE_UNIDAD_SAT_NCARGO,
							  'objeto_impuesto_sat' => $arrObjetoImpuestoSat[$intCon],
							  'precio' => $arrPrecios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon],
							  'iva' => $arrIvas[$intCon],
							  'tasa_cuota_ieps' => $intTasaCuotaIeps,
							  'ieps' => $arrIeps[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('notas_cargo_digitales_detalles', $arrDatos);
		}
		
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intNotaCargoDigitalID)
	{

		$this->db->select("NCDD.referencia, NCDD.referencia_id, NCDD.concepto, NCDD.codigo_sat, 
						   NCDD.unidad_sat, NCDD.objeto_impuesto_sat, NCDD.precio, NCDD.tasa_cuota_iva, NCDD.iva, 
						   NCDD.tasa_cuota_ieps, NCDD.ieps, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps,
						   TIeps.tipo AS tipo_ieps, TIeps.factor AS factor_ieps, 
						   CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto", FALSE);
		$this->db->from('notas_cargo_digitales_detalles AS NCDD');
		$this->db->join('sat_tasa_cuota AS TIva', 'NCDD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'NCDD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('sat_objeto_impuesto AS OImp', 'NCDD.objeto_impuesto_sat = OImp.codigo', 'left');
		$this->db->where('NCDD.nota_cargo_digital_id', $intNotaCargoDigitalID);
		$this->db->order_by('NCDD.renglon', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los detalles de un registro para mostrarlos en el archivo XML
	public function buscar_detalles_xml($intNotaCargoDigitalID)
	{
		//Constantes para identificar los datos del SAT correspondientes a la nota de cargo digital
   		$strClaveProductoServ = CLAVE_PRODUCTO_SAT_NCARGO;
   		$strClaveUnidad = CLAVE_UNIDAD_SAT_NCARGO;
   		$strUnidad = UNIDAD_SAT_NCARGO;

		$strSQL = $this->db->query("SELECT 	NCDD.nota_cargo_digital_id AS ID, 
											1 AS renglon,  
											_utf8'$strClaveProductoServ' AS ClaveProdServ, 
						  				  	_utf8'' AS NoIdentificacion,  
						  				  	1 AS cantidad, 
						  				  	_utf8'$strClaveUnidad' AS ClaveUnidad, 
						 				  	_utf8'$strUnidad' AS Unidad, 
						 				  	NCDD.objeto_impuesto_sat AS ClaveObjetoImpuesto,
						 				  	NCDD.concepto AS Descripcion, 
						 				  	NCDD.concepto, 
						 				    CASE 
											   WHEN  FM.factura_maquinaria_id > 0 
											   		THEN  FM.folio
											   WHEN  FR.factura_refacciones_id > 0
											   		THEN  FR.folio
											   WHEN  FS.factura_servicio_id > 0 
											   		THEN  FS.folio
											   WHEN  FC.factura_concepto_id > 0 
											   		THEN  FC.folio
											   ELSE 
											       CT.folio
										    END AS  folio_referencia,
						 				  	NCDD.precio AS subtotal, 
						 				  	0 AS descuento, 
						 				  	NCDD.iva AS iva, 
						 				  	NCDD.ieps AS ieps, 
						 				  	_utf8'' AS Pedimento, 
						  				  	TIva.valor_maximo AS PorcentajeIva, 
						  				  	TIva.factor AS FactorIva,  
						  				  	IIva.codigo AS ImpuestoIva,  
						  				  	TIeps.valor_maximo AS PorcentajeIeps,
						  				  	TIeps.factor AS FactorIeps, 
						  				  	IIeps.codigo AS ImpuestoIeps, 
						  				  	CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto
						  			FROM notas_cargo_digitales_detalles AS NCDD
						  			INNER JOIN  sat_tasa_cuota AS TIva ON NCDD.tasa_cuota_iva = TIva.tasa_cuota_id
						  			INNER JOIN  sat_impuestos AS IIva ON TIva.impuesto_id = IIva.impuesto_id
						  			LEFT JOIN  sat_tasa_cuota AS TIeps ON NCDD.tasa_cuota_ieps = TIeps.tasa_cuota_id
						  			LEFT JOIN  sat_impuestos AS IIeps ON TIeps.impuesto_id = IIeps.impuesto_id
						  			LEFT JOIN  facturas_maquinaria AS FM ON NCDD.referencia_id = FM.factura_maquinaria_id 
						  				 AND   NCDD.referencia = 'MAQUINARIA'
						  			LEFT JOIN facturas_refacciones AS FR ON NCDD.referencia_id = FR.factura_refacciones_id
						  				 AND  NCDD.referencia = 'REFACCIONES'
						  			LEFT JOIN facturas_servicio AS FS ON NCDD.referencia_id = FS.factura_servicio_id
						  				 AND  NCDD.referencia = 'SERVICIO'
						  		    LEFT JOIN facturas_conceptos AS FC ON NCDD.referencia_id = FC.factura_concepto_id
						  				 AND  NCDD.referencia = 'CONCEPTO'
						  			LEFT JOIN cartera AS CT ON NCDD.referencia_id = CT.cartera_id
						  				 AND  NCDD.referencia = 'CARTERA'
						  		    LEFT JOIN sat_objeto_impuesto AS OImp ON NCDD.objeto_impuesto_sat = OImp.codigo
						  			WHERE NCDD.nota_cargo_digital_id = $intNotaCargoDigitalID");
		return $strSQL->result();
	}

}