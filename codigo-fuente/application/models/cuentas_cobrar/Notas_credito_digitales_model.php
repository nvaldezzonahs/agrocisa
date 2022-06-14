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

class notas_credito_digitales_model extends CI_model {

	/*******************************************************************************************************************
	Funciones de la tabla notas_credito_digitales
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objNotaCreditoDigital)
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
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objNotaCreditoDigital->strFolio); 

		//Concatenar hora, minutos y segundos
		$dteFecha = $objNotaCreditoDigital->dteFecha.' '.date("H:i:s"); 

		//Tabla notas_credito_digitales
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objNotaCreditoDigital->intSucursalID,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha, 
						  'moneda_id' => $objNotaCreditoDigital->intMonedaID, 
						  'tipo_cambio' => $objNotaCreditoDigital->intTipoCambio,
						  'prospecto_id' => $objNotaCreditoDigital->intProspectoID,
						  'razon_social' => $objNotaCreditoDigital->strRazonSocial, 
						  'rfc' => $objNotaCreditoDigital->strRfc, 
						  'regimen_fiscal_id' => $objNotaCreditoDigital->intRegimenFiscalID,
						  'calle' => $objNotaCreditoDigital->strCalle,
						  'numero_exterior' => $objNotaCreditoDigital->strNumeroExterior,
						  'numero_interior' => $objNotaCreditoDigital->strNumeroInterior,
						  'codigo_postal' => $objNotaCreditoDigital->strCodigoPostal,
						  'colonia' => $objNotaCreditoDigital->strColonia,
						  'localidad' => $objNotaCreditoDigital->strLocalidad,
						  'municipio' => $objNotaCreditoDigital->strMunicipio,
						  'estado' => $objNotaCreditoDigital->strEstado,
						  'pais' => $objNotaCreditoDigital->strPais,
						  'forma_pago_id' => $objNotaCreditoDigital->intFormaPagoID,
						  'metodo_pago_id' => $objNotaCreditoDigital->intMetodoPagoID,
						  'uso_cfdi_id' => $objNotaCreditoDigital->intUsoCfdiID,
						  'tipo_relacion_id' => $objNotaCreditoDigital->intTipoRelacionID,
						  'exportacion_id' => $objNotaCreditoDigital->intExportacionID,
						  'observaciones' => $objNotaCreditoDigital->strObservaciones,
						  'estatus'  => 'TIMBRAR',
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objNotaCreditoDigital->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('notas_credito_digitales', $arrDatos);
		
		//Agregar id del nuevo registro al objeto
		$objNotaCreditoDigital->intNotaCreditoDigitalID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la nota de crédito digital
		$this->guardar_detalles($objNotaCreditoDigital);

		//Hacer un llamado al método para guardar los CFDI relacionados de la nota de crédito digital
		$otdModelCfdiRelacionados->guardar($objNotaCreditoDigital->intNotaCreditoDigitalID, 
										   'NOTA CREDITO', 
										   $objNotaCreditoDigital->strCfdiRelacionado, 
										   $objNotaCreditoDigital->strTiposRelacion);
			
		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objNotaCreditoDigital->intNotaCreditoDigitalID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objNotaCreditoDigital)
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

		//Concatenar hora, minutos y segundos
		$dteFecha = $objNotaCreditoDigital->dteFecha.' '.date("H:i:s"); 

		//Tabla notas_credito_digitales
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha, 
						  'moneda_id' => $objNotaCreditoDigital->intMonedaID, 
						  'tipo_cambio' => $objNotaCreditoDigital->intTipoCambio,
						  'prospecto_id' => $objNotaCreditoDigital->intProspectoID,
						  'razon_social' => $objNotaCreditoDigital->strRazonSocial, 
						  'rfc' => $objNotaCreditoDigital->strRfc, 
						  'regimen_fiscal_id' => $objNotaCreditoDigital->intRegimenFiscalID,
						  'calle' => $objNotaCreditoDigital->strCalle,
						  'numero_exterior' => $objNotaCreditoDigital->strNumeroExterior,
						  'numero_interior' => $objNotaCreditoDigital->strNumeroInterior,
						  'codigo_postal' => $objNotaCreditoDigital->strCodigoPostal,
						  'colonia' => $objNotaCreditoDigital->strColonia,
						  'localidad' => $objNotaCreditoDigital->strLocalidad,
						  'municipio' => $objNotaCreditoDigital->strMunicipio,
						  'estado' => $objNotaCreditoDigital->strEstado,
						  'pais' => $objNotaCreditoDigital->strPais,
						  'forma_pago_id' => $objNotaCreditoDigital->intFormaPagoID,
						  'metodo_pago_id' => $objNotaCreditoDigital->intMetodoPagoID,
						  'uso_cfdi_id' => $objNotaCreditoDigital->intUsoCfdiID,
						  'tipo_relacion_id' => $objNotaCreditoDigital->intTipoRelacionID,
						  'exportacion_id' => $objNotaCreditoDigital->intExportacionID,
						  'observaciones' => $objNotaCreditoDigital->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objNotaCreditoDigital->intUsuarioID);
		$this->db->where('nota_credito_digital_id', $objNotaCreditoDigital->intNotaCreditoDigitalID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('notas_credito_digitales', $arrDatos);

		//Eliminar los detalles guardados de la nota de crédito digital
		$this->db->where('nota_credito_digital_id', $objNotaCreditoDigital->intNotaCreditoDigitalID);
		$this->db->delete('notas_credito_digitales_detalles');
		
		//Hacer un llamado al método para guardar los detalles de la nota de crédito digital
		$this->guardar_detalles($objNotaCreditoDigital);

		//Hacer un llamado al método para guardar los CFDI relacionados de la nota de crédito digital
		$otdModelCfdiRelacionados->guardar($objNotaCreditoDigital->intNotaCreditoDigitalID, 
										   'NOTA CREDITO', 
										   $objNotaCreditoDigital->strCfdiRelacionado, 
										   $objNotaCreditoDigital->strTiposRelacion);

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
		$this->db->where('nota_credito_digital_id',  $objTimbrado->intReferenciaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('notas_credito_digitales', $arrDatos);
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

        //Modificar el estatus a INACTIVO de un registro de notas de crédito
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('nota_credito_digital_id', $objCancelacionCfdi->intReferenciaCfdiID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('notas_credito_digitales', $arrDatos);


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
	public function buscar($intNotaCreditoDigitalID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
					       $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';

		//Si existe id de la nota de crédito digital
		if ($intNotaCreditoDigitalID !== NULL)
		{   
			$strRestricciones .= " AND NCD.nota_credito_digital_id = $intNotaCreditoDigitalID";
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
		$queryNotasCredito = "SELECT NCD.nota_credito_digital_id, NCD.folio,
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
								   	NCD.uso_cfdi_id, NCD.tipo_relacion_id, NCD.exportacion_id,
								   	NCD.observaciones, NCD.estatus, 
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
								   	_utf8'E' AS TipoDeComprobante, 
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

							FROM notas_credito_digitales AS NCD
							INNER JOIN sat_monedas AS M ON NCD.moneda_id = M.moneda_id
							INNER JOIN clientes AS C ON NCD.prospecto_id = C.prospecto_id
							INNER JOIN prospectos AS PRO ON PRO.prospecto_id = C.prospecto_id
							INNER JOIN sat_forma_pago AS FP ON NCD.forma_pago_id = FP.forma_pago_id
							INNER JOIN sat_metodos_pago AS MP ON NCD.metodo_pago_id = MP.metodo_pago_id
							INNER JOIN sat_uso_cfdi AS U ON NCD.uso_cfdi_id = U.uso_cfdi_id
							INNER JOIN sat_tipos_relacion AS TR ON NCD.tipo_relacion_id = TR.tipo_relacion_id
							INNER JOIN (SELECT Det.nota_credito_digital_id AS referenciaID,
									    		   SUM(Det.precio) AS Precio, 
									    		   SUM(Det.iva) AS IVA,
									    		   SUM(Det.ieps) AS IEPS
						    		    FROM notas_credito_digitales_detalles AS Det
						    			GROUP BY Det.nota_credito_digital_id) AS Detalles ON Detalles.referenciaID = NCD.nota_credito_digital_id
							LEFT JOIN sat_tipos_comprobante AS TC ON TC.codigo = 'E'
							LEFT JOIN sat_exportacion AS ECF ON NCD.exportacion_id = ECF.exportacion_id
							LEFT JOIN sat_regimen_fiscal AS RF ON NCD.regimen_fiscal_id = RF.regimen_fiscal_id
							LEFT JOIN usuarios AS UC ON NCD.usuario_creacion = UC.usuario_id
							LEFT JOIN polizas AS PF ON NCD.nota_credito_digital_id = PF.referencia_id
								 AND  PF.modulo = 'CUENTAS POR COBRAR' AND PF.proceso = 'NOTA CREDITO'
							WHERE  NCD.sucursal_id = $intSucursalID
						    $strRestricciones
						    ORDER BY NCD.fecha DESC, NCD.folio DESC";


		$strSQL = $this->db->query($queryNotasCredito);
		//Si existe id de la nota de crédito digital
		if ($intNotaCreditoDigitalID !== NULL)
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

	/*Método para regresar las notas de crédito que con el criterio de búsqueda proporcionado
	 (se utiliza en el reporte de facturación)*/
	 public function buscar_notas_credito_facturas($dteFechaInicial, $dteFechaFinal, $intProspectoID = NULL,  
												   $intMonedaID = NULL, $strTipoReferencia = NULL, 
												   $strSucursales = NULL, $strServiciosTipos = NULL)
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
			$strRestriccionesProspecto .= " AND C.prospecto_id = $intProspectoID";
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
			$strRestriccionesSucursales .= " AND NC.sucursal_id IN (";

		    //Quitar | de la lista para obtener el id de la sucursal
			$arrSucursales = explode("|", $strSucursales);

			//Hacer recorrido para formar restricción con los ID's de las sucursales
			for ($intCon = 0; $intCon < sizeof($arrSucursales); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otra sucursal)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesSucursales .= ",";
				}

				//Concatenar id de la sucursal 
				$strRestriccionesSucursales .= $arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}


		//Si existen tipos de servicios
		if($strServiciosTipos)
		{	

			//Dependiendo del tipo de referencia agregar restricción
			if($strTipoReferencia == 'SERVICIO') //facturas de servicio
			{
				//Generar las condiciones dinamicas de las consultas respecto a la columna servicio_tipo_id
				$strRestriccionesServiciosTipos .= " AND OREP.servicio_tipo_id IN (";
			}
			else //facturas de refacciones
			{
				///Generar las condiciones dinamicas de las consultas respecto a la columna  tipo: Mostrador, Refaccionario, Campo, etc. 
				$strRestriccionesServiciosTipos .= " AND FR.tipo IN (";
			}


		    //Quitar | de la lista para obtener el id del tipo de servicio / tipo (Mostrador, Refaccionario, Campo, etc)
			$arrServiciosTipos = explode("|", $strServiciosTipos);

			//Hacer recorrido para formar restricción con los ID's de los tipos de servicios
			for ($intCon = 0; $intCon < sizeof($arrServiciosTipos); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otro tipo de servicio)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesServiciosTipos .= ",";
				}
				
				//Concatenar id del tipo de servicio / tipo (Mostrador, Refaccionario, Campo, etc)
				$strRestriccionesServiciosTipos .= "'".$arrServiciosTipos[$intCon]."'";
				
				
			}

			$strRestriccionesServiciosTipos .= ")";

		}

		//Dependiendo del tipo de referencia formar la consulta
		if($strTipoReferencia == 'SERVICIO') //Facturas de servicio
		{
			//Variable que se utiliza para formar la  consulta
			$strConsulta = "SELECT NC.nota_credito_digital_id, NC.folio, NC.tipo_cambio, NC.estatus,
								   DATE_FORMAT(NC.fecha,'%d/%m/%Y') AS fecha,
								   FS.folio AS folio_factura,
								   C.razon_social,
								   OREP.folio AS folio_orden_reparacion,
								   OREP.servicio_tipo_id, S.nombre AS sucursal, ST.descripcion AS servicio_tipo,
								   ROUND((NCD.precio/NC.tipo_cambio), 2) AS subtotal,
								    ROUND((NCD.iva/NC.tipo_cambio), 2) AS iva,
								    ROUND((NCD.ieps/NC.tipo_cambio), 2) AS ieps,
								    (ROUND((NCD.precio/NC.tipo_cambio), 2) +
								    ROUND((NCD.iva/NC.tipo_cambio), 2)  +
								    ROUND((NCD.ieps/NC.tipo_cambio), 2)) AS importe
								    
							FROM  notas_credito_digitales_detalles AS NCD
							INNER JOIN notas_credito_digitales AS NC ON NCD.nota_credito_digital_id = NC.nota_credito_digital_id
							INNER JOIN facturas_servicio AS FS ON FS.factura_servicio_id = NCD.referencia_id
							INNER JOIN ordenes_reparacion AS OREP ON FS.orden_reparacion_id = OREP.orden_reparacion_id
							INNER JOIN servicios_tipos AS ST ON OREP.servicio_tipo_id = ST.servicio_tipo_id
							INNER JOIN clientes AS C ON FS.prospecto_id = C.prospecto_id
							INNER JOIN prospectos AS PRO ON PRO.prospecto_id = C.prospecto_id
							INNER JOIN sat_monedas AS M ON NC.moneda_id = M.moneda_id
							INNER JOIN sucursales AS S ON NC.sucursal_id = S.sucursal_id 
							WHERE NCD.referencia = '$strTipoReferencia'
							AND  DATE_FORMAT(NC.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'
							$strRestriccionesSucursales 
							$strRestriccionesServiciosTipos
							$strRestriccionesMoneda
							$strRestriccionesProspecto
							$strOrdenamiento";
							
		}
		else if($strTipoReferencia == 'REFACCIONES')//Facturas de refacciones
		{

			//Variable que se utiliza para formar la  consulta
			$strConsulta = "SELECT NC.nota_credito_digital_id, NC.folio, NC.tipo_cambio, NC.estatus,
								   DATE_FORMAT(NC.fecha,'%d/%m/%Y') AS fecha,
								   FR.folio AS folio_factura,
								   C.razon_social,
								   FR.tipo, FR.condiciones_pago,
								   S.nombre AS sucursal,
								   ROUND((NCD.precio/NC.tipo_cambio), 2) AS subtotal,
								    ROUND((NCD.iva/NC.tipo_cambio), 2) AS iva,
								    ROUND((NCD.ieps/NC.tipo_cambio), 2) AS ieps,
								    (ROUND((NCD.precio/NC.tipo_cambio), 2) +
								    ROUND((NCD.iva/NC.tipo_cambio), 2)  +
								    ROUND((NCD.ieps/NC.tipo_cambio), 2)) AS importe
							FROM  notas_credito_digitales_detalles AS NCD
							INNER JOIN notas_credito_digitales AS NC ON NCD.nota_credito_digital_id = NC.nota_credito_digital_id
							INNER JOIN facturas_refacciones  AS FR ON FR.factura_refacciones_id = NCD.referencia_id
							INNER JOIN clientes AS C ON FR.prospecto_id = C.prospecto_id
							INNER JOIN prospectos AS PRO ON PRO.prospecto_id = C.prospecto_id
							  INNER JOIN sat_monedas AS M ON NC.moneda_id = M.moneda_id
							  INNER JOIN sucursales AS S ON NC.sucursal_id = S.sucursal_id 
							  WHERE NCD.referencia = '$strTipoReferencia'
							  AND  DATE_FORMAT(NC.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'
							  $strRestriccionesSucursales 
							  $strRestriccionesServiciosTipos
							  $strRestriccionesMoneda
							  $strRestriccionesProspecto
							  $strOrdenamiento";

		}


		$strSQL = $this->db->query($strConsulta);
		return $strSQL->result();

	 }



	//Método para regresar la información de un movimiento fiscal que será cancelado
	public function buscar_movimiento_fiscal($intNotaCreditoDigitalID)
	{

		$strSQL = $this->db->query("SELECT E.rfc AS RFC, 
										NOW() AS Fecha, 
										NCD.uuid, 
										NCD.folio 
									FROM notas_credito_digitales AS NCD
									INNER JOIN sucursales AS S ON S.sucursal_id = NCD.sucursal_id  
									INNER JOIN empresas E ON E.empresa_id = S.empresa_id
									WHERE NCD.nota_credito_digital_id = $intNotaCreditoDigitalID");
		return $strSQL->result();
	}


	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
											 $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('notas_credito_digitales AS NCD');
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
		$strProcesoPoliza = $this->db->escape('NOTA CREDITO');

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

		$this->db->from('notas_credito_digitales AS NCD');
	    $this->db->join('sat_monedas AS M', 'NCD.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'NCD.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'NCD.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'NCD.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'NCD.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'NCD.tipo_relacion_id = TR.tipo_relacion_id', 'inner');
	    $this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND NCD.nota_credito_digital_id = PF.referencia_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("	NCD.nota_credito_digital_id, 
							NCD.folio, 
							DATE_FORMAT(NCD.fecha,'%d/%m/%Y') AS fecha, 
						   	NCD.rfc, NCD.razon_social,
						   	IFNULL(NCD.regimen_fiscal_id,0) AS regimen_fiscal_id,
						   	NCD.estatus, NCD.uuid, 
						   	IFNULL(PF.poliza_id, 0) AS poliza_id, 
						    PF.folio AS folio_poliza,
						     IFNULL(CCFDI.cancelacion_id, 0) AS cancelacion_id", FALSE);
		$this->db->from('notas_credito_digitales AS NCD');
	    $this->db->join('sat_monedas AS M', 'NCD.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'NCD.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'NCD.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'NCD.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'NCD.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'NCD.tipo_relacion_id = TR.tipo_relacion_id', 'inner');
	    $this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND NCD.nota_credito_digital_id = PF.referencia_id', 'left');
	    $this->db->join('cancelaciones AS CCFDI', 'CCFDI.tipo_referencia = '.$strProcesoPoliza.' 
	    							        	  AND CCFDI.referencia_id = NCD.nota_credito_digital_id', 'left');

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
		$this->db->select('nota_credito_digital_id, folio, uuid');
        $this->db->from('notas_credito_digitales');
        $this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
        //Si el formulario corresponde a una cancelación de timbrado
        if($strFormulario == 'cancelacion')
        {
        	$this->db->where('nota_credito_digital_id <>', $intReferenciaID);
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
		//Dependiendo del tipo de referencia realizar consulta
		if($strTipoReferencia == 'NOTA CREDITO')
		{
			//Notas de crédito digitales
			$queryReferencia = "SELECT NCD.nota_credito_digital_id AS ID, NCD.sucursal_id, 
									 'CUENTAS POR COBRAR' AS Modulo, 
								     'NOTA CREDITO' AS Proceso, NCD.folio, NCD.fecha, NCD.moneda_id, P.codigo, 
								      NCD.razon_social, NCD.estatus, 0 AS Referencia 
						        FROM   notas_credito_digitales AS NCD 
						        INNER JOIN prospectos AS P ON NCD.prospecto_id = P.prospecto_id 
						        WHERE  NCD.nota_credito_digital_id = $intReferenciaID";
		}
		else if($strTipoReferencia == 'NOTA CARGO')
		{
			//Notas de cargo
			$queryReferencia = "SELECT NC.nota_cargo_id AS ID, NC.sucursal_id, 'CUENTAS POR COBRAR' AS Modulo, 
						       		   'NOTA CARGO' AS Proceso, NC.folio, NC.fecha, NC.moneda_id, P.codigo,
								        NC.razon_social, NC.estatus, 0 AS Referencia 
							   FROM   notas_cargo AS NC 
							   INNER JOIN prospectos AS P ON NC.prospecto_id = P.prospecto_id 
							   WHERE  NC.nota_cargo_id = $intReferenciaID";

		}
		else if($strTipoReferencia == 'NOTA CARGO DIGITAL')
		{
			//Notas de cargo digitales
			$queryReferencia = "SELECT NC.nota_cargo_digital_id AS ID, NC.sucursal_id, 'CUENTAS POR COBRAR' AS Modulo, 
								      'NOTA CARGO DIGITAL' AS Proceso, NC.folio, NC.fecha, NC.moneda_id, P.codigo, 
								      NC.razon_social, NC.estatus, 0 AS Referencia 
								FROM   notas_cargo_digitales AS NC 
								INNER JOIN prospectos AS P ON NC.prospecto_id = P.prospecto_id 
								WHERE  NC.nota_cargo_digital_id = $intReferenciaID";
		}
		else
		{

			//Notas de crédito servicio
			$queryReferencia = "SELECT NC.nota_credito_servicio_id AS ID, NC.sucursal_id, 'SERVICIO' AS Modulo, 
							       	  'NOTA CREDITO SERVICIO' AS Proceso, NC.folio, NC.fecha, NC.moneda_id, P.codigo, 
						       		  NC.razon_social, NC.estatus, FS.orden_reparacion_id AS Referencia 
								FROM   notas_credito_servicio AS NC INNER JOIN prospectos AS P ON NC.prospecto_id = P.prospecto_id 
						        INNER JOIN facturas_servicio AS FS ON NC.factura_servicio_id = FS.factura_servicio_id 
						        WHERE  NC.nota_credito_servicio_id = $intReferenciaID";
		}

		//Ejecutar consulta
		$strSQL = $this->db->query($queryReferencia);
		return $strSQL->row();
	}


	//Método para regresar los detalles de un registro (se utiliza para generar póliza)
	public function buscar_detalles_poliza($intReferenciaID, $strTipoReferencia)
	{
		//Dependiendo del tipo de referencia realizar búsqueda de datos
		if($strTipoReferencia == 'NOTA CREDITO')
		{
			//Notas de crédito digitales
			$queryDetalles = "SELECT NCDD.nota_credito_digital_id, NCDD.renglon, NCDD.referencia, NCDD.referencia_id,
									   ROUND(NCDD.precio, 2) AS precio, NCDD.tasa_cuota_iva, ROUND(NCDD.iva, 2) AS iva, 
									   NCDD.tasa_cuota_ieps, ROUND(NCDD.ieps, 2) AS ieps 
							   FROM   notas_credito_digitales_detalles AS NCDD 
							   WHERE  NCDD.nota_credito_digital_id = $intReferenciaID
						       ORDER BY NCDD.renglon, NCDD.tasa_cuota_iva, NCDD.tasa_cuota_ieps";
		}
		else if($strTipoReferencia == 'NOTA CARGO')
		{
			//Notas de cargo
			$queryDetalles = "SELECT NCD.nota_cargo_id, NCD.renglon, NCD.referencia, NCD.referencia_id, ROUND(NCD.precio, 2) AS precio, 
								   NCD.tasa_cuota_iva, ROUND(NCD.iva, 2) AS iva, NCD.tasa_cuota_ieps, ROUND(NCD.ieps, 2) AS ieps
			                    FROM   notas_cargo_detalles AS NCD 
			                    WHERE  NCD.nota_cargo_id = $intReferenciaID
								ORDER BY NCD.renglon, NCD.tasa_cuota_iva, NCD.tasa_cuota_ieps";

		}
		else if($strTipoReferencia == 'NOTA CARGO DIGITAL')
		{
			//Notas de cargo digitales
			$queryDetalles = "SELECT NCD.nota_cargo_digital_id, NCD.renglon, NCD.referencia, NCD.referencia_id, NCD.concepto, 
									   ROUND(NCD.precio, 2) AS precio, NCD.tasa_cuota_iva, ROUND(NCD.iva, 2) AS iva, NCD.tasa_cuota_ieps, 
								   	   ROUND(NCD.ieps, 2) AS ieps, MP.codigo AS MetodoPago, C.tipo_persona 
							    FROM   ((notas_cargo_digitales_detalles AS NCD INNER JOIN notas_cargo_digitales NC 
								         ON NCD.nota_cargo_digital_id = NC.nota_cargo_digital_id)
								         INNER JOIN sat_metodos_pago AS MP ON NC.metodo_pago_id = MP.metodo_pago_id) 
								         INNER JOIN clientes AS C ON NC.prospecto_id = C.prospecto_id
							    WHERE  NCD.nota_cargo_digital_id =  $intReferenciaID
							    ORDER BY NCD.renglon, NCD.tasa_cuota_iva, NCD.tasa_cuota_ieps";
		}
		else
		{

			//Notas de crédito servicio
			$queryDetalles = "SELECT NCD.nota_credito_servicio_id, NCD.renglon, NCD.concepto, ROUND(NCD.precio, 2) AS precio, 
								  	   NCD.tasa_cuota_iva, ROUND(NCD.iva, 2) AS iva, NCD.tasa_cuota_ieps, ROUND(NCD.ieps, 2) AS ieps 
								FROM   notas_credito_servicio_detalles AS NCD 
								WHERE  NCD.nota_credito_servicio_id = $intReferenciaID
								ORDER BY NCD.renglon, NCD.tasa_cuota_iva, NCD.tasa_cuota_ieps";
		}


		//Ejecutar consulta
		$strSQL = $this->db->query($queryDetalles);
		return $strSQL->result();

	}


	//Método para regresar la factura de la nota (se utiliza para generar póliza)
	public function buscar_factura_poliza($intReferenciaID, $strTipoReferencia, $strProceso = NULL)
	{

		//Dependiendo del tipo de referencia realizar búsqueda de datos
		if($strTipoReferencia == 'MAQUINARIA')
		{

			//Facturas de maquinaria
			$queryFactura ="SELECT FM.factura_maquinaria_id AS ID, P.codigo, FM.razon_social, ML.descripcion AS Modulo, 
			                        1 AS renglon, ROUND(FM.precio,2) AS Subtotal, FM.tasa_cuota_iva, ROUND(FM.iva, 2) AS IVA,
									   FM.tasa_cuota_ieps, TIeps.valor_maximo AS porcentaje_ieps, ROUND(FM.ieps, 2) AS IEPS, 
									   MD.codigo AS CodDes, FM.sucursal_id
						    FROM   facturas_maquinaria AS FM INNER JOIN prospectos AS P ON FM.prospecto_id = P.prospecto_id 
								   INNER JOIN maquinaria_descripciones AS MD 
								   ON FM.maquinaria_descripcion_id = MD.maquinaria_descripcion_id 
								   INNER JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id 
								   LEFT JOIN sat_tasa_cuota AS TIeps ON FM.tasa_cuota_ieps = TIeps.tasa_cuota_id
							WHERE  FM.factura_maquinaria_id = $intReferenciaID";

		}
		else if($strTipoReferencia == 'REFACCIONES')
		{
			//Facturas de refacciones
			$queryFactura ="SELECT FR.factura_refacciones_id AS ID, P.codigo, FR.razon_social, 'REFACCIONES' AS Modulo, 
								   1 AS renglon, ROUND(FR.gastos_paqueteria,2) AS Subtotal, 2 AS tasa_cuota_iva, 
								   ROUND(FR.gastos_paqueteria_iva, 2) AS IVA, NULL AS tasa_cuota_ieps, 0 AS porcentaje_ieps,
								    0 AS IEPS, '' AS CodDes, FR.sucursal_id 
							FROM   facturas_refacciones AS FR INNER JOIN prospectos AS P ON FR.prospecto_id = P.prospecto_id 
							WHERE  FR.factura_refacciones_id = $intReferenciaID
							AND    FR.gastos_paqueteria > 0 ";
			$queryFactura.=" UNION ";
			$queryFactura.="SELECT FR.factura_refacciones_id AS ID, P.codigo, FR.razon_social, M.descripcion AS Modulo,
								   FRD.renglon, SUM(ROUND((FRD.precio_unitario * FRD.cantidad), 2)) AS Subtotal, 
								   FRD.tasa_cuota_iva, SUM(ROUND((FRD.iva_unitario * FRD.cantidad), 2)) AS IVA, 
								   FRD.tasa_cuota_ieps, TIeps.valor_maximo AS porcentaje_ieps, 
								   SUM(ROUND((FRD.ieps_unitario * FRD.cantidad), 2)) AS IEPS, 
								   '' AS CodDes, FR.sucursal_id 
							FROM   facturas_refacciones AS FR INNER JOIN facturas_refacciones_detalles AS FRD
								   ON FR.factura_refacciones_id = FRD.factura_refacciones_id 
								   INNER JOIN prospectos AS P ON FR.prospecto_id = P.prospecto_id 
								   INNER JOIN refacciones_lineas AS RL ON FRD.codigo_linea = RL.codigo 
								   INNER JOIN modulos AS M ON RL.modulo_id = M.modulo_id 
								   LEFT JOIN sat_tasa_cuota AS TIeps ON FRD.tasa_cuota_ieps = TIeps.tasa_cuota_id
							WHERE  FR.factura_refacciones_id = $intReferenciaID
							GROUP BY FR.factura_refacciones_id, FRD.renglon, FRD.tasa_cuota_iva, FRD.tasa_cuota_ieps, M.descripcion";

			//Dependiendo del proceso ordenar registros
			if($strProceso == 'RECIBO INGRESO')
			{
				$queryFactura.= " ORDER BY tasa_cuota_iva, tasa_cuota_ieps";
			}
			else
			{
				$queryFactura.= " ORDER BY renglon, tasa_cuota_iva, tasa_cuota_ieps";
			}
			
		}
		else if($strTipoReferencia == 'SERVICIO')
		{
			//Facturas de servicio
			$queryFactura ="SELECT FS.factura_servicio_id AS ID, P.codigo, FS.razon_social, 'SERVICIO' AS Modulo, 
				                  1 AS renglon, ROUND(FS.gastos_servicio, 2) AS Subtotal, 2 AS tasa_cuota_iva, 
				                 ROUND(FS.gastos_servicio_iva, 2) AS IVA, NULL AS tasa_cuota_ieps,0 AS porcentaje_ieps,
				                 0 AS IEPS, '' AS CodDes, FS.sucursal_id 
							FROM   facturas_servicio AS FS INNER JOIN prospectos AS P ON FS.prospecto_id = P.prospecto_id 
							WHERE  FS.factura_servicio_id = $intReferenciaID";
			$queryFactura.=" UNION ";
			$queryFactura.="SELECT FS.factura_servicio_id AS ID, P.codigo, FS.razon_social, 'SERVICIO' AS Modulo,
								   FSM.renglon, ROUND((FSM.precio_unitario), 2) AS Subtotal, 
								   FSM.tasa_cuota_iva, ROUND((FSM.iva_unitario), 2) AS IVA, 
								   FSM.tasa_cuota_ieps, TIeps.valor_maximo AS porcentaje_ieps,
								    ROUND((FSM.ieps_unitario), 2) AS IEPS, '' AS CodDes, FS.sucursal_id
							FROM   facturas_servicio AS FS INNER JOIN facturas_servicio_mano_obra AS FSM 
								   ON FS.factura_servicio_id = FSM.factura_servicio_id 
								   INNER JOIN prospectos AS P ON FS.prospecto_id = P.prospecto_id 
								   LEFT JOIN sat_tasa_cuota AS TIeps ON FSM.tasa_cuota_ieps = TIeps.tasa_cuota_id
							WHERE  FS.factura_servicio_id =  $intReferenciaID";
			$queryFactura.=" UNION ";
			$queryFactura.="SELECT FS.factura_servicio_id AS ID, P.codigo, FS.razon_social, 'SERVICIO' AS Modulo, 
								   FSR.renglon, ROUND((FSR.cantidad * FSR.precio_unitario), 2) AS Subtotal, 
								   FSR.tasa_cuota_iva, ROUND((FSR.cantidad * FSR.iva_unitario), 2) AS IVA, 
								   FSR.tasa_cuota_ieps, TIeps.valor_maximo AS porcentaje_ieps,
								    ROUND((FSR.cantidad * FSR.ieps_unitario), 2) AS IEPS, '' AS CodDes, FS.sucursal_id 
							FROM   facturas_servicio AS FS INNER JOIN facturas_servicio_refacciones AS FSR 
								   ON FS.factura_servicio_id = FSR.factura_servicio_id
								   INNER JOIN prospectos AS P ON FS.prospecto_id = P.prospecto_id 
								   LEFT JOIN sat_tasa_cuota AS TIeps ON FSR.tasa_cuota_ieps = TIeps.tasa_cuota_id
							WHERE  FS.factura_servicio_id =  $intReferenciaID";
			$queryFactura.=" UNION ";
			$queryFactura.="SELECT FS.factura_servicio_id AS ID, P.codigo, FS.razon_social, 'SERVICIO' AS Modulo, 
								   FST.renglon, ROUND((FST.cantidad * FST.precio_unitario), 2) AS Subtotal, 
								   FST.tasa_cuota_iva, ROUND((FST.cantidad * FST.iva_unitario), 2) AS IVA, 
								   FST.tasa_cuota_ieps, TIeps.valor_maximo AS porcentaje_ieps,
								   ROUND((FST.cantidad * FST.ieps_unitario), 2) AS IEPS, '' AS CodDes, 
								   FS.sucursal_id 
							FROM   facturas_servicio AS FS INNER JOIN facturas_servicio_trabajos_foraneos AS FST 
								   ON FS.factura_servicio_id = FST.factura_servicio_id 
								   INNER JOIN prospectos AS P ON FS.prospecto_id = P.prospecto_id
								   LEFT JOIN sat_tasa_cuota AS TIeps ON FST.tasa_cuota_ieps = TIeps.tasa_cuota_id
							WHERE  FS.factura_servicio_id =  $intReferenciaID";
			$queryFactura.=" UNION ";
			$queryFactura.="SELECT FS.factura_servicio_id AS ID, P.codigo, FS.razon_social, 'SERVICIO' AS Modulo,
						    	   FSO.renglon, ROUND((FSO.cantidad * FSO.precio_unitario), 2) AS Subtotal, 
						    	   FSO.tasa_cuota_iva, ROUND((FSO.cantidad * FSO.iva_unitario), 2) AS IVA, 
								   FSO.tasa_cuota_ieps, TIeps.valor_maximo AS porcentaje_ieps,
								   ROUND((FSO.cantidad * FSO.ieps_unitario), 2) AS IEPS, '' AS CodDes,
								   FS.sucursal_id 
							FROM   facturas_servicio AS FS INNER JOIN facturas_servicio_otros AS FSO
								   ON FS.factura_servicio_id = FSO.factura_servicio_id 
								   INNER JOIN prospectos AS P ON FS.prospecto_id = P.prospecto_id
								   LEFT JOIN sat_tasa_cuota AS TIeps ON FSO.tasa_cuota_ieps = TIeps.tasa_cuota_id
							WHERE  FS.factura_servicio_id = $intReferenciaID
							ORDER BY tasa_cuota_iva, tasa_cuota_ieps";
		}
		else if($strTipoReferencia == 'CARTERA')
		{
			//Cartera
			$queryFactura ="SELECT C.cartera_id AS ID, P.codigo, C.razon_social, C.modulo AS Modulo, 
								   1 AS renglon, C.saldo AS Subtotal, 1 AS tasa_cuota_iva, 
								   0 AS IVA, NULL AS tasa_cuota_ieps, 0 AS porcentaje_ieps, 
								   0 AS IEPS, '' AS CodDes, C.sucursal_id 
							FROM   cartera AS C INNER JOIN prospectos AS P ON C.prospecto_id = P.prospecto_id 
							WHERE  C.cartera_id =  $intReferenciaID
							AND    C.modulo = 'MAQUINARIA' ";
			$queryFactura.="UNION ";
			$queryFactura.="SELECT C.cartera_id AS ID, P.codigo, C.razon_social, C.modulo AS Modulo,
				                   1 AS renglon, ROUND((C.saldo/1.16), 2) AS Subtotal, 2 AS tasa_cuota_iva, 
				                  ROUND(((C.saldo/1.16) * 0.16), 2) AS IVA, NULL AS tasa_cuota_ieps, 
				                  0 AS porcentaje_ieps, 0 AS IEPS, '' AS CodDes, C.sucursal_id 
							FROM   cartera AS C INNER JOIN prospectos AS P ON C.prospecto_id = P.prospecto_id 
							WHERE  C.cartera_id = $intReferenciaID
							AND    C.modulo <> 'MAQUINARIA' 
							ORDER BY tasa_cuota_iva, tasa_cuota_ieps";
		}
		else if($strTipoReferencia == 'CONCEPTO')
		{
			//Facturas de conceptos
			$queryFactura ="SELECT FC.factura_concepto_id AS ID, P.codigo, FC.razon_social, 'DIVERSOS' AS Modulo, 
								   FCD.renglon,  SUM(ROUND((FCD.cantidad * FCD.precio_unitario),2)) AS Subtotal, 
								   FCD.tasa_cuota_iva, SUM(ROUND((FCD.cantidad * FCD.iva_unitario),2)) AS IVA,
								   FCD.tasa_cuota_ieps,  TIeps.valor_maximo AS porcentaje_ieps,
								   SUM(ROUND((FCD.cantidad * FCD.ieps_unitario),2)) AS IEPS, 
								   '' AS CodDes, FC.sucursal_id 
							FROM   facturas_conceptos AS FC INNER JOIN facturas_conceptos_detalles AS FCD 
								   ON FC.factura_concepto_id = FCD.factura_concepto_id
							   INNER JOIN prospectos AS P ON FC.prospecto_id = P.prospecto_id 
							   LEFT JOIN sat_tasa_cuota AS TIeps ON FCD.tasa_cuota_ieps = TIeps.tasa_cuota_id
							WHERE  FC.factura_concepto_id = $intReferenciaID
							GROUP BY FC.factura_concepto_id, FCD.renglon, FCD.tasa_cuota_iva, FCD.tasa_cuota_ieps 
							ORDER BY FCD.renglon, FCD.tasa_cuota_iva, FCD.tasa_cuota_ieps";
		}

		//Ejecutar consulta
		$strSQL = $this->db->query($queryFactura);
		return $strSQL->result();
	}


	/*******************************************************************************************************************
	Funciones de la tabla notas_credito_digitales_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de una nota de crédito digital
	public function guardar_detalles(stdClass $objNotaCreditoDigital)
	{
		//Quitar | de la lista para obtener los valores del array
		$arrReferencias = explode("|", $objNotaCreditoDigital->strReferencias);
		$arrReferenciaID = explode("|", $objNotaCreditoDigital->strReferenciaID);
		$arrConceptos = explode("|", $objNotaCreditoDigital->strConceptos);
		$arrObjetoImpuestoSat = explode("|", $objNotaCreditoDigital->strObjetoImpuestoSat);
		$arrPrecios = explode("|", $objNotaCreditoDigital->strPrecios);
		$arrTasaCuotaIva = explode("|", $objNotaCreditoDigital->strTasaCuotaIva);
		$arrIvas = explode("|", $objNotaCreditoDigital->strIvas);
		$arrTasaCuotaIeps = explode("|", $objNotaCreditoDigital->strTasaCuotaIeps);
		$arrIeps = explode("|", $objNotaCreditoDigital->strIeps);
		
		//Hacer recorrido para insertar los datos en la tabla notas_credito_digitales_detalles
		for ($intCon = 0; $intCon < sizeof($arrReferenciaID); $intCon++) 
		{
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? $arrTasaCuotaIeps[$intCon] : NULL);

			//Asignar datos al array
			$arrDatos = array( 'nota_credito_digital_id' => $objNotaCreditoDigital->intNotaCreditoDigitalID,
				 			  'renglon' => ($intCon + 1),
							  'referencia' => $arrReferencias[$intCon],
							  'referencia_id' => $arrReferenciaID[$intCon],
							  'concepto' => $arrConceptos[$intCon],
							  'codigo_sat' => CLAVE_PRODUCTO_SAT_NCREDITO,
							  'unidad_sat' => CLAVE_UNIDAD_SAT_NCREDITO,
							  'objeto_impuesto_sat' => $arrObjetoImpuestoSat[$intCon],
							  'precio' => $arrPrecios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon],
							  'iva' => $arrIvas[$intCon],
							  'tasa_cuota_ieps' => $intTasaCuotaIeps,
							  'ieps' => $arrIeps[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('notas_credito_digitales_detalles', $arrDatos);
		}
		
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intNotaCreditoDigitalID)
	{

		$this->db->select("NCDD.referencia, NCDD.referencia_id, NCDD.concepto, NCDD.codigo_sat, 
						   NCDD.unidad_sat,  NCDD.objeto_impuesto_sat, NCDD.precio, NCDD.tasa_cuota_iva, NCDD.iva, 
						   NCDD.tasa_cuota_ieps, NCDD.ieps, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps,
						   TIeps.tipo AS tipo_ieps, TIeps.factor AS factor_ieps, 
						   CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto", FALSE);
		$this->db->from('notas_credito_digitales_detalles AS NCDD');
		$this->db->join('sat_tasa_cuota AS TIva', 'NCDD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'NCDD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('sat_objeto_impuesto AS OImp', 'NCDD.objeto_impuesto_sat = OImp.codigo', 'left');
		$this->db->where('NCDD.nota_credito_digital_id', $intNotaCreditoDigitalID);
		$this->db->order_by('NCDD.renglon', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los detalles de un registro para mostrarlos en el archivo XML
	public function buscar_detalles_xml($intNotaCreditoDigitalID)
	{
		//Constantes para identificar los datos del SAT correspondientes a la nota de crédito digital
   		$strClaveProductoServ = CLAVE_PRODUCTO_SAT_NCREDITO;
   		$strClaveUnidad = CLAVE_UNIDAD_SAT_NCREDITO;
   		$strUnidad = UNIDAD_SAT_NCREDITO;


		$strSQL = $this->db->query("SELECT 	NCDD.nota_credito_digital_id AS ID, 
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

						  			FROM notas_credito_digitales_detalles AS NCDD
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
						  			WHERE NCDD.nota_credito_digital_id = $intNotaCreditoDigitalID");
		return $strSQL->result();
	}

}