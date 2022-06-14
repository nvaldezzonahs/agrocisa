<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de CFDI relacionados (para guardar los CFDI relacionados del registro)
include_once(APPPATH . 'models/caja/Cfdi_relacionados_model.php');
//Incluir la clase modelo de cancelaciones (para guardar la cancelación del timbrado (CFDI))
include_once(APPPATH . 'models/contabilidad/Cancelaciones_model.php');
//Incluir la clase modelo de clientes (para modificar el régimen fiscal del anticipo seleccionado)
include_once(APPPATH . 'models/cuentas_cobrar/Clientes_model.php');

class Anticipos_aplicacion_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objAplicacionAnticipo)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        //Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

        //Variable que se utiliza para asignar el id del nuevo registro
		$intAnticipoAplicacionID = 0;

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objAplicacionAnticipo->strFolio); 
		 
		//Concatenar hora, minutos y segundos
		$dteFecha = $objAplicacionAnticipo->dteFecha.' '.date("H:i:s"); 

		//Tabla anticipos_aplicacion
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objAplicacionAnticipo->intSucursalID,
						  'anticipo_id' => $objAplicacionAnticipo->intAnticipoID,
						  'folio' => $strFolioConsecutivo,
						  'fecha' => $dteFecha, 
						  'moneda_id' => $objAplicacionAnticipo->intMonedaID, 
						  'tipo_cambio' => $objAplicacionAnticipo->intTipoCambio, 
						  'prospecto_id' => $objAplicacionAnticipo->intProspectoID, 
						  'razon_social' => $objAplicacionAnticipo->strRazonSocial, 
						  'rfc' => $objAplicacionAnticipo->strRfc, 
						  'regimen_fiscal_id' => $objAplicacionAnticipo->intRegimenFiscalID,
						  'calle' => $objAplicacionAnticipo->strCalle, 
						  'numero_exterior' => $objAplicacionAnticipo->strNumeroExterior, 
						  'numero_interior' => $objAplicacionAnticipo->strNumeroInterior, 
						  'codigo_postal' => $objAplicacionAnticipo->strCodigoPostal, 
						  'colonia' => $objAplicacionAnticipo->strColonia, 
						  'localidad' => $objAplicacionAnticipo->strLocalidad, 
						  'municipio' => $objAplicacionAnticipo->strMunicipio, 
						  'estado' => $objAplicacionAnticipo->strEstado, 
						  'pais' => $objAplicacionAnticipo->strPais, 
						  'concepto' => $objAplicacionAnticipo->strConcepto,
						  'objeto_impuesto_sat' => $objAplicacionAnticipo->strObjetoImpuestoSat, 
						  'subtotal' => $objAplicacionAnticipo->intSubtotal,
						  'tasa_cuota_iva' => $objAplicacionAnticipo->intTasaCuotaIva,
						  'iva' => $objAplicacionAnticipo->intIva,
						  'tasa_cuota_ieps' => $objAplicacionAnticipo->intTasaCuotaIeps,
						  'ieps' => $objAplicacionAnticipo->intIeps,
						  'forma_pago_id' => $objAplicacionAnticipo->intFormaPagoID,
						  'metodo_pago_id' => $objAplicacionAnticipo->intMetodoPagoID,
						  'uso_cfdi_id' => $objAplicacionAnticipo->intUsoCfdiID,
						  'tipo_relacion_id' => $objAplicacionAnticipo->intTipoRelacionID,
						  'exportacion_id' => $objAplicacionAnticipo->intExportacionID,
						  'observaciones' => $objAplicacionAnticipo->strObservaciones,
						  'estatus'  => 'TIMBRAR',
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objAplicacionAnticipo->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('anticipos_aplicacion', $arrDatos);
		//Asignar id del nuevo registro en la base de datos
		$intAnticipoAplicacionID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los CFDI relacionados de la aplicación de anticipo
		$otdModelCfdiRelacionados->guardar($intAnticipoAplicacionID, 'APLICACION ANTICIPO', 
									       $objAplicacionAnticipo->strCfdiRelacionado, 
									       $objAplicacionAnticipo->strTiposRelacion);
		

		//Si se cumple la sentencia modificar el régimen fiscal del anticipo (significa que el anticipo seleccionado no tenia régimen fiscal y el usuario modificó el régimen fiscal del cliente)
		if($objAplicacionAnticipo->strModRegimenFiscal == 'SI')
		{
			//Se crea una instancia de la clase modelo (Clientes) 
       		$otdModelClientes = new  Clientes_model();

       		//Hacer un llamado al método para modificar el id del régimen fiscal de un anticipo
       		$otdModelClientes->set_regimen_fiscal($objAplicacionAnticipo->intAnticipoID, 
										  		  'ANTICIPO', 
										  		  $objAplicacionAnticipo->intRegimenFiscalID);

		}

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intAnticipoAplicacionID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objAplicacionAnticipo)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
	    //Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

        //Concatenar hora, minutos y segundos
		$dteFecha = $objAplicacionAnticipo->dteFecha.' '.date("H:i:s"); 

        //Tabla anticipos_aplicacion
		//Asignar datos al array
		$arrDatos = array('anticipo_id' => $objAplicacionAnticipo->intAnticipoID,
						  'fecha' => $dteFecha, 
						  'moneda_id' => $objAplicacionAnticipo->intMonedaID, 
						  'tipo_cambio' => $objAplicacionAnticipo->intTipoCambio, 
						  'prospecto_id' => $objAplicacionAnticipo->intProspectoID, 
						  'razon_social' => $objAplicacionAnticipo->strRazonSocial, 
						  'rfc' => $objAplicacionAnticipo->strRfc, 
						  'regimen_fiscal_id' => $objAplicacionAnticipo->intRegimenFiscalID,
						  'calle' => $objAplicacionAnticipo->strCalle, 
						  'numero_exterior' => $objAplicacionAnticipo->strNumeroExterior, 
						  'numero_interior' => $objAplicacionAnticipo->strNumeroInterior, 
						  'codigo_postal' => $objAplicacionAnticipo->strCodigoPostal, 
						  'colonia' => $objAplicacionAnticipo->strColonia, 
						  'localidad' => $objAplicacionAnticipo->strLocalidad, 
						  'municipio' => $objAplicacionAnticipo->strMunicipio, 
						  'estado' => $objAplicacionAnticipo->strEstado, 
						  'pais' => $objAplicacionAnticipo->strPais, 
						  'concepto' => $objAplicacionAnticipo->strConcepto,
						  'objeto_impuesto_sat' => $objAplicacionAnticipo->strObjetoImpuestoSat, 
						  'subtotal' => $objAplicacionAnticipo->intSubtotal,
						  'tasa_cuota_iva' => $objAplicacionAnticipo->intTasaCuotaIva,
						  'iva' => $objAplicacionAnticipo->intIva,
						  'tasa_cuota_ieps' => $objAplicacionAnticipo->intTasaCuotaIeps,
						  'ieps' => $objAplicacionAnticipo->intIeps,
						  'forma_pago_id' => $objAplicacionAnticipo->intFormaPagoID,
						  'metodo_pago_id' => $objAplicacionAnticipo->intMetodoPagoID,
						  'uso_cfdi_id' => $objAplicacionAnticipo->intUsoCfdiID,
						  'tipo_relacion_id' => $objAplicacionAnticipo->intTipoRelacionID,
						  'exportacion_id' => $objAplicacionAnticipo->intExportacionID,
						  'observaciones' => $objAplicacionAnticipo->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objAplicacionAnticipo->intUsuarioID);
		$this->db->where('anticipo_aplicacion_id', $objAplicacionAnticipo->intAnticipoAplicacionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('anticipos_aplicacion', $arrDatos);

	    //Hacer un llamado al método para guardar los CFDI relacionados de la aplicación de anticipo
		$otdModelCfdiRelacionados->guardar($objAplicacionAnticipo->intAnticipoAplicacionID, 
										  'APLICACION ANTICIPO', 
										   $objAplicacionAnticipo->strCfdiRelacionado, 
										   $objAplicacionAnticipo->strTiposRelacion);

		//Si se cumple la sentencia modificar el régimen fiscal del anticipo (significa que el anticipo seleccionado no tenia régimen fiscal y el usuario modificó el régimen fiscal del cliente)
		if($objAplicacionAnticipo->strModRegimenFiscal == 'SI')
		{
			//Se crea una instancia de la clase modelo (Clientes) 
       		$otdModelClientes = new  Clientes_model();

       		//Hacer un llamado al método para modificar el id del régimen fiscal de un anticipo
       		$otdModelClientes->set_regimen_fiscal($objAplicacionAnticipo->intAnticipoID, 
										  		  'ANTICIPO', 
										  		  $objAplicacionAnticipo->intRegimenFiscalID);

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
		$this->db->where('anticipo_aplicacion_id', $objTimbrado->intReferenciaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('anticipos_aplicacion', $arrDatos);
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
						  'usuario_eliminacion' => $this->session->userdata('usuario_id'));
		$this->db->where('anticipo_aplicacion_id', $objCancelacionCfdi->intReferenciaCfdiID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('anticipos_aplicacion', $arrDatos);

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
	public function buscar($intAnticipoAplicacionID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL, $intAnticipoID = NULL)
	{
		$this->db->select("AA.anticipo_aplicacion_id, AA.anticipo_id, AA.folio, AA.fecha, 
						   DATE_FORMAT(AA.fecha,'%d/%m/%Y') AS fecha_format,
						   AA.moneda_id, AA.tipo_cambio, AA.prospecto_id, AA.razon_social, 
						   AA.rfc, 
						   CASE 
							  WHEN  AA.regimen_fiscal_id > 0 
							  THEN AA.regimen_fiscal_id		
							ELSE IFNULL(C.regimen_fiscal_id,0)
						    END regimen_fiscal_id,
						   IFNULL(AA.regimen_fiscal_id,0) AS regimenFiscalAnterior,
						   AA.calle, AA.numero_exterior, AA.numero_interior, AA.codigo_postal, 
						   AA.colonia, AA.localidad, AA.municipio, AA.estado, AA.pais, AA.concepto,
						   AA.objeto_impuesto_sat, AA.subtotal, AA.tasa_cuota_iva, AA.iva, 
						   AA.tasa_cuota_ieps, AA.ieps, AA.forma_pago_id, 
						   AA.metodo_pago_id, AA.uso_cfdi_id, AA.tipo_relacion_id,  AA.exportacion_id,
						   AA.observaciones, AA.estatus, AA.certificado, 
						   AA.sello, AA.uuid, AA.fecha_timbrado, AA.certificado_sat, AA.sello_sat,
						   AA.leyenda_sat, AA.rfc_pac, C.nombre_comercial AS cliente, C.correo_electronico,
						   C.contacto_correo_electronico, M.codigo AS MonedaTipo, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, FP.codigo AS FormaPago,
						   CONCAT_WS(' - ', MP.codigo, MP.descripcion) AS metodo_pago, MP.codigo AS MetodoPago,
						   CONCAT_WS(' - ', U.codigo, U.descripcion) AS uso_cfdi, U.codigo AS UsoCFDI,
						   CONCAT_WS(' - ', TR.codigo, TR.descripcion) AS tipo_relacion, TR.codigo AS TipoRelacion,
						   _utf8'' AS CondicionesDePago, _utf8'E' AS TipoDeComprobante, 
						   CONCAT_WS(' - ', TC.codigo, TC.descripcion) AS tipo_comprobante,
						  RF.codigo AS RegimenFiscal,
						   CONCAT_WS(' - ', RF.codigo, RF.descripcion) AS regimen_fiscal,
						   ECF.codigo AS CodigoExportacion,
						   CONCAT_WS(' - ', ECF.codigo, ECF.descripcion) AS exportacion,
						   CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto,
						   TIva.valor_maximo AS porcentaje_iva, TIeps.valor_maximo AS porcentaje_ieps, 
						   A.folio AS folio_anticipo, 
							PRO.codigo AS CodigoProspecto", FALSE);
		$this->db->from('anticipos_aplicacion AS AA');
		$this->db->join('anticipos AS A', 'AA.anticipo_id = A.anticipo_id', 'inner');
		$this->db->join('clientes AS C', 'AA.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('sat_monedas AS M', 'AA.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'AA.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'AA.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'AA.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'AA.tipo_relacion_id = TR.tipo_relacion_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIva', 'AA.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIeps', 'AA.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
	    $this->db->join('sat_tipos_comprobante AS TC', 'TC.codigo = "E"', 'left');
	    $this->db->join('sat_exportacion AS ECF', 'AA.exportacion_id = ECF.exportacion_id', 'left');
	    $this->db->join('sat_regimen_fiscal AS RF', 'AA.regimen_fiscal_id = RF.regimen_fiscal_id', 'left');
	    $this->db->join('sat_objeto_impuesto AS OImp', 'AA.objeto_impuesto_sat = OImp.codigo', 'left');
		//Si existe id de la aplicación de anticipo
		if ($intAnticipoAplicacionID !== NULL)
		{   
			$this->db->where('AA.anticipo_aplicacion_id', $intAnticipoAplicacionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			
		    //Si existe id del cliente
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('AA.prospecto_id', $intProspectoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(AA.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe id del anticipo
		    if($intAnticipoID !== NULL)
		    {
		    	$this->db->where('AA.anticipo_id', $intAnticipoID);
		    	$this->db->where("(AA.estatus = 'TIMBRAR' OR AA.estatus = 'ACTIVO')");
		    }
		    else
		    {
		    	//Si existe estatus
				if($strEstatus != 'TODOS')
				{
					$this->db->where('AA.estatus', $strEstatus);
				}

				$this->db->where('AA.sucursal_id', $this->session->userdata('sucursal_id'));
				$this->db->where("((AA.folio LIKE '%$strBusqueda%') OR
			    				   (AA.concepto LIKE '%$strBusqueda%') OR
			    				   (CONCAT_WS(' - ', AA.rfc, AA.razon_social) LIKE '%$strBusqueda%') OR
				                   (CONCAT_WS(' ', AA.rfc, AA.razon_social) LIKE '%$strBusqueda%') OR
		    				       (CONCAT_WS(' - ', AA.razon_social, AA.rfc) LIKE '%$strBusqueda%') OR
				                   (CONCAT_WS(' ', AA.razon_social, AA.rfc) LIKE '%$strBusqueda%'))"); 
		    }
		   
			$this->db->order_by('AA.fecha DESC, AA.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los detalles de un registro para mostrarlos en el archivo XML
	public function buscar_detalles_xml($intAnticipoAplicacionID)
	{

		$strSQL = $this->db->query("SELECT AA.anticipo_aplicacion_id AS ID, 1 AS renglon, 
										   _utf8'84111506' AS ClaveProdServ, 
						  				  _utf8'' AS NoIdentificacion,  1 AS cantidad, _utf8'ACT' AS ClaveUnidad, 
						 				  _utf8'Actividad' AS Unidad, 
						 				  AA.objeto_impuesto_sat AS ClaveObjetoImpuesto,
						 				  _utf8'APLICACION DE ANTICIPO' AS Descripcion, 
						  				  AA.concepto, AA.subtotal, 0 AS descuento, AA.iva, AA.ieps, _utf8'' AS Pedimento, 
						  				  TIva.valor_maximo AS PorcentajeIva, TIva.factor AS FactorIva,  
						  				  IIva.codigo AS ImpuestoIva,  TIeps.valor_maximo AS PorcentajeIeps,
						  				  TIeps.factor AS FactorIeps, IIeps.codigo AS ImpuestoIeps, 
						  				  CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto
						  			FROM anticipos_aplicacion AS AA
						  			INNER JOIN  sat_tasa_cuota AS TIva ON AA.tasa_cuota_iva = TIva.tasa_cuota_id
						  			INNER JOIN  sat_impuestos AS IIva ON TIva.impuesto_id = IIva.impuesto_id
						  			LEFT JOIN  sat_tasa_cuota AS TIeps ON AA.tasa_cuota_ieps = TIeps.tasa_cuota_id
						  			LEFT JOIN  sat_impuestos AS IIeps ON TIeps.impuesto_id = IIeps.impuesto_id
						  			LEFT JOIN sat_objeto_impuesto AS OImp ON AA.objeto_impuesto_sat = OImp.codigo
						  			WHERE AA.anticipo_aplicacion_id = $intAnticipoAplicacionID");

		return $strSQL->result();
	}


	//Método para regresar la información de un movimiento fiscal que será cancelado
	public function buscar_movimiento_fiscal($intAnticipoAplicacionID)
	{
		$strSQL = $this->db->query("SELECT E.rfc AS RFC, 
										NOW() AS Fecha, 
										AA.uuid, 
										AA.folio 
									FROM anticipos_aplicacion AS AA
									INNER JOIN sucursales AS S ON S.sucursal_id = AA.sucursal_id   
									INNER JOIN empresas E ON E.empresa_id = S.empresa_id
									WHERE AA.anticipo_aplicacion_id = $intAnticipoAplicacionID");
		return $strSQL->result();
	}


	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
											 $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('anticipos_aplicacion AS AA');
		$this->db->join('sat_monedas AS M', 'AA.moneda_id = M.moneda_id', 'inner');
		$this->db->where('AA.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		 //Si existe id del cliente
	    if($intProspectoID > 0)
	    {
	   		$this->db->where('AA.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(AA.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('AA.estatus', $strEstatus);
		}

		$this->db->where("((AA.folio LIKE '%$strBusqueda%') OR
	    				   (AA.concepto LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', AA.rfc, AA.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', AA.rfc, AA.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', AA.razon_social, AA.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', AA.razon_social, AA.rfc) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL, 
						   $strEstatus = NULL, $strBusqueda =  NULL, $intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoRefCFDI = $this->db->escape('APLICACION ANTICIPO');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('AA.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del cliente
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('AA.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(AA.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('AA.estatus', $strEstatus);
		}

		$this->db->where("((AA.folio LIKE '%$strBusqueda%') OR
	    				   (AA.concepto LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', AA.rfc, AA.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', AA.rfc, AA.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', AA.razon_social, AA.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', AA.razon_social, AA.rfc) LIKE '%$strBusqueda%'))"); 

		$this->db->from('anticipos_aplicacion AS AA');
		$this->db->join('anticipos AS A', 'AA.anticipo_id = A.anticipo_id', 'inner');
		$this->db->join('clientes AS C', 'AA.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('sat_monedas AS M', 'AA.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'AA.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'AA.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'AA.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'AA.tipo_relacion_id = TR.tipo_relacion_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIva', 'AA.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();


		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("AA.anticipo_aplicacion_id, AA.folio, DATE_FORMAT(AA.fecha,'%d/%m/%Y') AS fecha,
						   AA.concepto, CONCAT('$',FORMAT(((AA.subtotal + AA.iva +AA.ieps) / AA.tipo_cambio),2)) AS total, 
						   AA.estatus, AA.razon_social, AA.rfc,
						   IFNULL(AA.regimen_fiscal_id,0) AS regimen_fiscal_id,
						   AA.uuid, 
						   IFNULL(CCFDI.cancelacion_id, 0) AS cancelacion_id", FALSE);

		$this->db->from('anticipos_aplicacion AS AA');
		$this->db->join('anticipos AS A', 'AA.anticipo_id = A.anticipo_id', 'inner');
		$this->db->join('clientes AS C', 'AA.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('sat_monedas AS M', 'AA.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'AA.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'AA.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'AA.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'AA.tipo_relacion_id = TR.tipo_relacion_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIva', 'AA.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	    $this->db->join('cancelaciones AS CCFDI', 'CCFDI.tipo_referencia = '.$strTipoRefCFDI.' 
	    							        	  AND CCFDI.referencia_id = AA.anticipo_aplicacion_id', 'left');
		
		$this->db->where('AA.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del cliente
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('AA.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(AA.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('AA.estatus', $strEstatus);
		}

		$this->db->where("((AA.folio LIKE '%$strBusqueda%') OR
	    				   (AA.concepto LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', AA.rfc, AA.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', AA.rfc, AA.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', AA.razon_social, AA.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', AA.razon_social, AA.rfc) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('AA.fecha DESC, AA.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["anticipos_aplicacion"] =$this->db->get()->result();
		return $arrResultado;
	}

	
	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strFormulario, $intReferenciaID)
	{
		$this->db->select('anticipo_aplicacion_id, folio, uuid');
        $this->db->from('anticipos_aplicacion');
        $this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
        //Si el formulario corresponde a una cancelación de timbrado
        if($strFormulario == 'cancelacion')
        {
        	$this->db->where('anticipo_aplicacion_id <>', $intReferenciaID);
        }
     	$this->db->where('estatus', 'ACTIVO');
        $this->db->where("(folio LIKE '%$strDescripcion%')");
        $this->db->order_by('folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}


	//Método para regresar los datos de un registro (se utiliza para generar póliza)
	public function buscar_referencia_poliza($intReferenciaID, $strTipoReferencia)
	{

		//Constante para identificar la forma de pago: Aplicación de anticipos
		$intFormaPagoIDApliAnticipo = FORMA_PAGO_APLICACION_ANTICIPO;

		//Dependiendo del tipo de referencia realizar consulta		
		if($strTipoReferencia == 'POLIZA ABONO')
		{
			//Pólizas de abono
			$queryReferencia ="SELECT PA.poliza_abono_id AS ID, PA.sucursal_id, 'CUENTAS POR COBRAR' AS Modulo,
							      'POLIZA ABONO' AS Proceso, PA.folio, PA.fecha, PA.moneda_id, P.codigo,
								   PA.razon_social, PA.anticipo_id
							   FROM   polizas_abono_02 AS PA 
							   INNER JOIN prospectos AS P ON PA.prospecto_id = P.prospecto_id
							   WHERE  PA.poliza_abono_id = $intReferenciaID";
		}
		else
		{
			//Pagos 
			$queryReferencia = "SELECT P.pago_id AS ID, P.sucursal_id, 'CAJA' AS Modulo, 'RECEPCION PAGO' AS Proceso, P.folio, 
							    	  PD.fecha_pago AS fecha, PD.moneda_id, PR.codigo, P.razon_social, 
							    	  PD.renglon, PD.anticipo_id
							    FROM   (pagos AS P INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id) 
								INNER JOIN prospectos AS PR ON P.prospecto_id = PR.prospecto_id 
								WHERE  P.pago_id = $intReferenciaID 
								AND    PD.forma_pago_id = $intFormaPagoIDApliAnticipo";
		}

		//Ejecutar consulta
		$strSQL = $this->db->query($queryReferencia);
		return $strSQL->row();
	}


	//Método para regresar los detalles de un registro (se utiliza para generar póliza)
	public function buscar_detalles_poliza($intReferenciaID, $strTipoReferencia)
	{
		//Dependiendo del tipo de referencia realizar consulta		
		if($strTipoReferencia == 'POLIZA ABONO')
		{
			//Pólizas de abono
			$queryDetalles = "SELECT PAD.poliza_abono_id, PAD.renglon, PAD.referencia, PAD.referencia_id, 
				  			 	     PAD.precio, PAD.tasa_cuota_iva, PAD.iva, PAD.tasa_cuota_ieps, PAD.ieps 
							 FROM   polizas_abono_detalles_02 AS PAD 
							 WHERE  PAD.poliza_abono_id = $intReferenciaID 
							 ORDER BY PAD.renglon, PAD.tasa_cuota_iva, PAD.tasa_cuota_ieps";
		}
		else
		{
			//Pagos
			$queryDetalles = "SELECT PDR.pago_id, PDR.renglon, PDR.tipo_referencia, PDR.referencia_id, PDR.imp_pagado
							  FROM   pagos_detalles_relacionados_02 AS PDR 
							  WHERE  PDR.pago_id = $intReferenciaID 
							  ORDER BY PDR.renglon";

		}

		//Ejecutar consulta
		$strSQL = $this->db->query($queryDetalles);
		return $strSQL->result();
	}


	//Método para regresar los anticipos por aplicar
	public function buscar_anticipos_poliza($intAnticipoID, $intReferenciaID, $strTipoReferencia, $intRenglon = NULL)
	{

		//Dependiendo del tipo de referencia realizar consulta	
		if($strTipoReferencia == 'POLIZA ABONO')
		{
			//Pólizas de abono
			$queryDetalles = "SELECT  SUM(ROUND(PAD.precio, 2)) AS subtotal, 
									  SUM(ROUND(PAD.iva, 2)) AS IVA, 
									  SUM(ROUND(PAD.ieps, 2)) AS IEPS, 
								    A.anticipo_id AS ID, IFNULL(A.modulo_id,0) AS modulo_id,  
								    M.descripcion AS modulo,  A.tasa_cuota_ieps, A.tasa_cuota_iva, A.sucursal_id
							 FROM   polizas_abono_detalles_02 AS PAD 
							 INNER JOIN  polizas_abono_02 AS PA ON PA.poliza_abono_id = PAD.poliza_abono_id
							 INNER JOIN anticipos AS A ON PA.anticipo_id = A.anticipo_id
							 LEFT JOIN modulos AS M ON A.modulo_id = M.modulo_id 
							 WHERE  PAD.poliza_abono_id = $intReferenciaID
							 AND PA.anticipo_id = $intAnticipoID
							 GROUP BY  PA.poliza_abono_id";

		}
		else
		{
			//Pagos
			$queryDetalles = "SELECT  SUM(ROUND(PDR.imp_pagado, 2)) AS subtotal, 
									   ROUND(A.iva, 2) AS IVA, 
									  IFNULL(ROUND(A.ieps, 2),0) AS IEPS, 
								    A.anticipo_id AS ID, IFNULL(A.modulo_id,0) AS modulo_id,  
								    M.descripcion AS modulo,  A.tasa_cuota_ieps, A.tasa_cuota_iva, A.sucursal_id
							 FROM   pagos_detalles_02 AS PD
							 INNER JOIN  pagos_detalles_relacionados_02 AS PDR ON PD.pago_id = PDR.pago_id
							 AND PDR.renglon_detalles = PD.renglon
							 INNER JOIN anticipos AS A ON PD.anticipo_id = A.anticipo_id
							 LEFT JOIN modulos AS M ON A.modulo_id = M.modulo_id 
							 WHERE  PD.pago_id = $intReferenciaID
							 AND PD.renglon = $intRenglon
							 AND PD.anticipo_id = $intAnticipoID
							 GROUP BY  PD.pago_id";
		}

		//Ejecutar consulta
		$strSQL = $this->db->query($queryDetalles);
		return $strSQL->row();
	}

	//Método para regresar los anticipos por aplicar
	public function buscar_anticipos_polizaAnt($strCodCli, $dteFecha)
	{

		$queryAnticipos = "SELECT A.anticipo_id AS ID, A.sucursal_id, 
									CASE   
									  WHEN A.fecha_cobro IS NULL
							          THEN TCB.fecha
									  ELSE A.fecha_cobro 
									END AS fecha, A.moneda_id, A.concepto, A.subtotal, 
							       A.tasa_cuota_iva, ROUND(A.iva, 2) AS IVA, A.tasa_cuota_ieps, IFNULL(ROUND(A.ieps, 2),0) AS IEPS,
							       'ANTICIPO' AS Proceso, IFNULL(A.modulo_id,0) AS modulo_id, M.descripcion AS modulo
							FROM   ((traspasos_caja_bancos AS TCB INNER JOIN traspasos_caja_bancos_detalles AS TCBD 
							         ON TCB.traspaso_caja_banco_id = TCBD.traspaso_caja_banco_id) 
								     INNER JOIN anticipos AS A ON TCBD.tipo_referencia = 'ANTICIPO' AND TCBD.referencia_id = A.anticipo_id) 
									 INNER JOIN prospectos AS P ON A.prospecto_id = P.prospecto_id 
									 LEFT JOIN modulos AS M ON A.modulo_id = M.modulo_id 
							WHERE  TCB.fecha <=  '$dteFecha' 
							AND    TCB.estatus = 'ACTIVO' 
							AND    A.estatus = 'ACTIVO' 
							AND    P.codigo = '$strCodCli'";
		$queryAnticipos.=" UNION ";
		$queryAnticipos.="SELECT A.anticipo_id AS ID, A.sucursal_id, 
								 CASE   
								  WHEN A.fecha_cobro IS NULL
						          THEN A.fecha
								  ELSE A.fecha_cobro 
								 END AS fecha, A.moneda_id, A.concepto, A.subtotal, 
								  A.tasa_cuota_iva, ROUND(A.iva, 2) AS IVA, A.tasa_cuota_ieps, IFNULL(ROUND(A.ieps, 2),0) AS IEPS, 
								  'ANTICIPO' AS Proceso, IFNULL(A.modulo_id,0) AS modulo_id, M.descripcion AS modulo
						 FROM   anticipos AS A INNER JOIN prospectos AS P ON A.prospecto_id = P.prospecto_id 
						  LEFT JOIN modulos AS M ON A.modulo_id = M.modulo_id 
						 WHERE  A.fecha < '2019-01-01'
						 AND    A.estatus = 'ACTIVO'
						 AND    P.codigo = '$strCodCli'";
		$queryAnticipos.=" UNION ";
		$queryAnticipos.="SELECT A.anticipo_no_fiscal_id AS ID, A.sucursal_id, A.fecha, A.moneda_id, M.descripcion AS concepto, A.subtotal, 
						    	 A.tasa_cuota_iva, ROUND(A.iva, 2) AS IVA, A.tasa_cuota_ieps,  IFNULL(ROUND(A.ieps, 2),0) AS IEPS, 
						    	 'RECIBO INTERNO ANTICIPO' AS Proceso, IFNULL(A.modulo_id,0) AS modulo_id, M.descripcion AS modulo
						  FROM   anticipos_no_fiscales AS A INNER JOIN prospectos AS P ON A.prospecto_id = P.prospecto_id 
						        INNER JOIN modulos AS M ON A.modulo_id = M.modulo_id 
						WHERE  A.fecha <= '$dteFecha' 
						AND    A.estatus = 'ACTIVO' 
						AND    P.codigo = '$strCodCli'
						ORDER BY fecha, concepto, tasa_cuota_iva, tasa_cuota_ieps";
		//Ejecutar consulta
		$strSQL = $this->db->query($queryAnticipos);
		return $strSQL->result();
	}


}
?>