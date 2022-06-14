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

class Anticipos_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla anticipos
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objAnticipo)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        //Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

        //Variable que se utiliza para asignar el id del nuevo registro
		$intAnticipoID = 0;

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objAnticipo->strFolio); 

		//Concatenar hora, minutos y segundos
		$dteFecha = $objAnticipo->dteFecha.' '.date("H:i:s"); 

		//Tabla anticipos
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objAnticipo->intSucursalID, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha,  
						  'fecha_cobro' => $objAnticipo->dteFechaCobro, 
						  'moneda_id' => $objAnticipo->intMonedaID, 
						  'tipo_cambio' => $objAnticipo->intTipoCambio,
						  'modulo_id' => $objAnticipo->intModuloID,
						  'prospecto_id' => $objAnticipo->intProspectoID,
						  'razon_social' => $objAnticipo->strRazonSocial, 
						  'rfc' => $objAnticipo->strRfc, 
						  'regimen_fiscal_id' => $objAnticipo->intRegimenFiscalID,
						  'calle' => $objAnticipo->strCalle,
						  'numero_exterior' => $objAnticipo->strNumeroExterior,
						  'numero_interior' => $objAnticipo->strNumeroInterior,
						  'codigo_postal' => $objAnticipo->strCodigoPostal,
						  'colonia' => $objAnticipo->strColonia,
						  'localidad' => $objAnticipo->strLocalidad,
						  'municipio' => $objAnticipo->strMunicipio,
						  'estado' => $objAnticipo->strEstado,
						  'pais' => $objAnticipo->strPais,
						  'concepto' => $objAnticipo->strConcepto,
						  'objeto_impuesto_sat' => $objAnticipo->strObjetoImpuestoSat, 
						  'subtotal' => $objAnticipo->intSubtotal,
						  'tasa_cuota_iva' => $objAnticipo->intTasaCuotaIva,
						  'iva' => $objAnticipo->intIva,
						  'tasa_cuota_ieps' => $objAnticipo->intTasaCuotaIeps,
						  'ieps' => $objAnticipo->intIeps,
						  'forma_pago_id' => $objAnticipo->intFormaPagoID,
						  'metodo_pago_id' => $objAnticipo->intMetodoPagoID,
						  'uso_cfdi_id' => $objAnticipo->intUsoCfdiID,
						  'tipo_relacion_id' => $objAnticipo->intTipoRelacionID,
						  'exportacion_id' => $objAnticipo->intExportacionID,
						  'observaciones' => $objAnticipo->strObservaciones,
						  'estatus' => 'TIMBRAR',
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objAnticipo->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('anticipos', $arrDatos);

		//Asignar id del nuevo registro en la base de datos
		$intAnticipoID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los CFDI relacionados del anticipo
		$otdModelCfdiRelacionados->guardar($intAnticipoID, 'ANTICIPO', 
										   $objAnticipo->strCfdiRelacionado, 
										   $objAnticipo->strTiposRelacion);
		
		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intAnticipoID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objAnticipo)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();

	    //Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

        //Concatenar hora, minutos y segundos
		$dteFecha = $objAnticipo->dteFecha.' '.date("H:i:s"); 

	    //Tabla anticipos
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha,  
					 	  'fecha_cobro' => $objAnticipo->dteFechaCobro, 
						  'moneda_id' => $objAnticipo->intMonedaID, 
						  'tipo_cambio' => $objAnticipo->intTipoCambio,
						  'modulo_id' => $objAnticipo->intModuloID,
						  'prospecto_id' => $objAnticipo->intProspectoID,
						  'razon_social' => $objAnticipo->strRazonSocial, 
						  'rfc' => $objAnticipo->strRfc,
						  'regimen_fiscal_id' => $objAnticipo->intRegimenFiscalID, 
						  'calle' => $objAnticipo->strCalle,
						  'numero_exterior' => $objAnticipo->strNumeroExterior,
						  'numero_interior' => $objAnticipo->strNumeroInterior,
						  'codigo_postal' => $objAnticipo->strCodigoPostal,
						  'colonia' => $objAnticipo->strColonia,
						  'localidad' => $objAnticipo->strLocalidad,
						  'municipio' => $objAnticipo->strMunicipio,
						  'estado' => $objAnticipo->strEstado,
						  'pais' => $objAnticipo->strPais,
						  'concepto' => $objAnticipo->strConcepto,
						  'objeto_impuesto_sat' => $objAnticipo->strObjetoImpuestoSat, 
						  'subtotal' => $objAnticipo->intSubtotal,
						  'tasa_cuota_iva' => $objAnticipo->intTasaCuotaIva,
						  'iva' => $objAnticipo->intIva,
						  'tasa_cuota_ieps' => $objAnticipo->intTasaCuotaIeps,
						  'ieps' => $objAnticipo->intIeps,
						  'forma_pago_id' => $objAnticipo->intFormaPagoID,
						  'metodo_pago_id' => $objAnticipo->intMetodoPagoID,
						  'uso_cfdi_id' => $objAnticipo->intUsoCfdiID,
						  'tipo_relacion_id' => $objAnticipo->intTipoRelacionID,
						  'exportacion_id' => $objAnticipo->intExportacionID,
						  'observaciones' => $objAnticipo->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objAnticipo->intUsuarioID);
		$this->db->where('anticipo_id', $objAnticipo->intAnticipoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('anticipos', $arrDatos);

	    //Hacer un llamado al método para guardar los CFDI relacionados del anticipo
		$otdModelCfdiRelacionados->guardar($objAnticipo->intAnticipoID, 'ANTICIPO', 
										   $objAnticipo->strCfdiRelacionado, 
										   $objAnticipo->strTiposRelacion);
		
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
		$this->db->where('anticipo_id',  $objTimbrado->intReferenciaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('anticipos', $arrDatos);
	}


	//Método para modificar el estatus de un registro
	public function set_estatus($intAnticipoID, $strEstatus)
	{
		//Asignar datos al array
		$arrDatos = array('estatus' => $strEstatus,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('anticipo_id', $intAnticipoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('anticipos', $arrDatos);
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
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' => $this->session->userdata('usuario_id'));
		$this->db->where('anticipo_id', $objCancelacionCfdi->intReferenciaCfdiID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('anticipos', $arrDatos);

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


	//Método para modificar el modulo de un registro
	public function set_modulo($intAnticipoID, $strTipo = NULL)
	{

		//Variable que se utiliza para asignar el id del módulo
		$intModuloID = 0;
		//Variable que se utiliza para asignar la descripción del módulo
		$strDepartamento = '';

		//Seleccionar el módulo del anticipo
		$this->db->select('concepto, IFNULL(modulo_id,0) AS modulo_id');
		$this->db->from('anticipos');
	    $this->db->where('anticipo_id', $intAnticipoID);
	    $objAnticipo = $this->db->get()->row();


	    //Separarar concepto para obtener módulo
		$arrConcepto = explode(' ', $objAnticipo->concepto);

		//Dependiendo del concepto asignar id del módulo
		if (in_array('SERVICIO', $arrConcepto) OR
			in_array('SERVICO', $arrConcepto) OR
			in_array('SERVICIO.', $arrConcepto) OR
			in_array('SSERVICIO', $arrConcepto) OR
			in_array('SERVCIO', $arrConcepto) OR
			in_array('SERVICIO2230.07', $arrConcepto) OR
			in_array('SERVICIO8786.23', $arrConcepto) OR
			in_array('VICIO', $arrConcepto) OR
			in_array('SERVICIO900', $arrConcepto) OR
			in_array('SERVICIO2445.78', $arrConcepto)) 
		{
			$strDepartamento = 'SERVICIO';
		}
		else if (in_array('INDUSTRIAL', $arrConcepto) OR 
				 in_array('INDUSTRIAL.', $arrConcepto) OR 
				 in_array('CONSTRUCCIÓN', $arrConcepto) OR 
				 in_array('CONSTRUCCION', $arrConcepto)) 
		{
			$strDepartamento = 'CONSTRUCCION';
		}
		else if (in_array('MAQUINARIA', $arrConcepto) OR 
				 in_array('FORRAJERO', $arrConcepto) OR 
				 in_array('TRACTOR', $arrConcepto) OR 
				 in_array('AGRICOLA', $arrConcepto) OR 
				 in_array('IMPLEMENTO', $arrConcepto) OR 
				 in_array('MAQUINARIA.', $arrConcepto) OR 
				 in_array('MEZCLADORA', $arrConcepto) OR 
				 in_array('RASTRILLO', $arrConcepto) OR 
				 in_array('MAQUINARIA-REFACCIONES', $arrConcepto) OR 
				 in_array('IMPLEMENTOS', $arrConcepto)) 
		{
			$strDepartamento = 'MAQUINARIA';
		}
		else if (in_array('REFACCIONES', $arrConcepto) OR 
				 in_array('REFACCIONES.', $arrConcepto) OR 
				 in_array('REFACCIONES862.07', $arrConcepto) OR 
				 in_array('REFACIONES', $arrConcepto) OR 
				 in_array('RAFCCIONES.', $arrConcepto) OR 
				 in_array('REFAACIONES', $arrConcepto) OR 
				 in_array('REFACCCIONES', $arrConcepto) OR 
				 in_array('LLANTAS', $arrConcepto) OR 
				 in_array('REFACCONES', $arrConcepto) OR 
				 in_array('REFACCIONES,', $arrConcepto) OR 
				 in_array('REFACCION', $arrConcepto) OR 
				 in_array('REFACICONES', $arrConcepto) OR 
				 in_array('REFCCIONES', $arrConcepto) OR 
				 in_array('MREFACCIONES', $arrConcepto) OR 
				 in_array('REFACCIONE', $arrConcepto) OR 
				 in_array('DEREFACCIONES', $arrConcepto) OR 
				 in_array('REFACCIONES5948.2758', $arrConcepto) OR 
				 in_array('REFACCIONES258.62', $arrConcepto) OR 
				 in_array('MOTOR', $arrConcepto) OR 
				 in_array('REFACCINES.', $arrConcepto) OR 
				 in_array('REFACCINES.', $arrConcepto) OR 
				 in_array('REFACCIONES-SEMILLAS', $arrConcepto) OR 
				 in_array('RAFACCIONES', $arrConcepto)) 
		{
			$strDepartamento = 'REFACCIONES';
		}
		else if (in_array('AGROQUIMICOS', $arrConcepto) OR
				 in_array('AGROQUIMICOS.', $arrConcepto) OR
				 in_array('SEMILLA', $arrConcepto) OR
				 in_array('SEMILLA.', $arrConcepto) OR
				 in_array('SEMILLAS', $arrConcepto) OR
				 in_array('SEMILLAS/FERTILIZANTES', $arrConcepto) OR
				 in_array('INTELIGENTE', $arrConcepto) OR
				 in_array('PANELES', $arrConcepto) OR
				 in_array('SOLARES', $arrConcepto) OR
				 in_array('GPS', $arrConcepto)) 
		{
			$strDepartamento = 'AGRICULTURA INTELIGENTE';
		}

		

	    //Si no existe id del módulo
	    if($objAnticipo->modulo_id == 0)
	    {

			//Seleccionar el id del módulo que coincida con la descripción
			$this->db->select('modulo_id');
			$this->db->from('modulos');
		    $this->db->where('descripcion', $strDepartamento);
		    $objModulo = $this->db->get()->row();

		    //Asignar el id del módulo
		    $intModuloID = $objModulo->modulo_id;


		    //Asignar datos al array
			$arrDatos = array('modulo_id' => $intModuloID);
			$this->db->where('anticipo_id', $intAnticipoID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('anticipos', $arrDatos);

	    }//Cierre de verificación del módulo


	    //Si el tip corresponde a Póliza, significa que el registro se actualizó desde la póliza de aplicación
		if($strTipo == 'POLIZA')
		{
			//Regresar la descripción del módulo
			return $strDepartamento;
		}

	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intAnticipoID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						  $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		$this->db->select("A.anticipo_id, A.folio, A.fecha, DATE_FORMAT(A.fecha,'%d/%m/%Y') AS fecha_format,
						   A.fecha_cobro, DATE_FORMAT(A.fecha_cobro,'%d/%m/%Y') AS fecha_cobro_format,
						   A.moneda_id, A.tipo_cambio, A.modulo_id, A.prospecto_id, A.razon_social, 
						   A.rfc, 
						   CASE 
							  WHEN  A.regimen_fiscal_id > 0 
							  THEN A.regimen_fiscal_id		
							ELSE IFNULL(C.regimen_fiscal_id,0)
						    END regimen_fiscal_id,
						    IFNULL(A.regimen_fiscal_id,0) AS regimenFiscalAnterior,
						   A.calle, A.numero_exterior, A.numero_interior, A.codigo_postal, 
						   A.colonia, A.localidad, A.municipio, A.estado, A.pais, 
						   A.concepto, A.objeto_impuesto_sat,
						   A.subtotal, A.tasa_cuota_iva, A.iva, A.tasa_cuota_ieps, A.ieps, A.forma_pago_id, 
						   A.metodo_pago_id, A.uso_cfdi_id,
						   CASE   
						      WHEN A.tipo_relacion_id > 0 THEN A.tipo_relacion_id
						      ELSE ''  
						   END AS tipo_relacion_id, A.exportacion_id, A.observaciones, A.estatus, A.certificado, 
						   A.sello, A.uuid, A.fecha_timbrado, A.certificado_sat, A.sello_sat,
						   A.leyenda_sat, A.rfc_pac, C.nombre_comercial AS cliente, C.correo_electronico,
						   C.contacto_correo_electronico, M.codigo AS MonedaTipo, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, FP.codigo AS FormaPago,
						   CONCAT_WS(' - ', MP.codigo, MP.descripcion) AS metodo_pago, MP.codigo AS MetodoPago,
						   CONCAT_WS(' - ', U.codigo, U.descripcion) AS uso_cfdi, U.codigo AS UsoCFDI,
						   CONCAT_WS(' - ', TR.codigo, TR.descripcion) AS tipo_relacion, TR.codigo AS TipoRelacion,
						   _utf8'' AS CondicionesDePago, _utf8'I' AS TipoDeComprobante, 
						   CONCAT_WS(' - ', TC.codigo, TC.descripcion) AS tipo_comprobante,
						   RF.codigo AS RegimenFiscal,
						   CONCAT_WS(' - ', RF.codigo, RF.descripcion) AS regimen_fiscal,
						   ECF.codigo AS CodigoExportacion,
						   CONCAT_WS(' - ', ECF.codigo, ECF.descripcion) AS exportacion,
						   TIva.valor_maximo AS porcentaje_iva, TIeps.valor_maximo AS porcentaje_ieps,
							PRO.codigo AS CodigoProspecto, 
							C.refacciones_lista_precio_id, C.servicio_lista_precio_id, 
						    C.maquinaria_lista_precio_id, MA.descripcion AS modulo, 
						    CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto,
						    IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza", FALSE);
		$this->db->from('anticipos AS A');
		$this->db->join('clientes AS C', 'A.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('sat_monedas AS M', 'A.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'A.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'A.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'A.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIva', 'A.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'A.tipo_relacion_id = TR.tipo_relacion_id', 'left');
	    $this->db->join('sat_tasa_cuota AS TIeps', 'A.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
	    $this->db->join('sat_tipos_comprobante AS TC', 'TC.codigo = "I"', 'left');
	    $this->db->join('sat_exportacion AS ECF', 'A.exportacion_id = ECF.exportacion_id', 'left');
	    $this->db->join('sat_regimen_fiscal AS RF', 'A.regimen_fiscal_id = RF.regimen_fiscal_id', 'left');
	    $this->db->join('sat_objeto_impuesto AS OImp', 'A.objeto_impuesto_sat = OImp.codigo', 'left');
	    $this->db->join('modulos AS MA', 'A.modulo_id = MA.modulo_id', 'left');
	    $this->db->join('polizas AS PF', 'A.anticipo_id = PF.referencia_id AND
	    							      PF.modulo = "CAJA" AND PF.proceso = "ANTICIPO"', 'left');
		//Si existe id del anticipo
		if ($intAnticipoID !== NULL)
		{   
			$this->db->where('A.anticipo_id', $intAnticipoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('A.sucursal_id', $this->session->userdata('sucursal_id'));
		    //Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('A.prospecto_id', $intProspectoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(A.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{

				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(A.estatus = 'TIMBRAR' OR A.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('A.estatus', $strEstatus);
				}
				
			}

			$this->db->where("((A.folio LIKE '%$strBusqueda%') OR
		    				   (A.concepto LIKE '%$strBusqueda%') OR
		    				   (CONCAT_WS(' - ', A.rfc, A.razon_social) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', A.rfc, A.razon_social) LIKE '%$strBusqueda%') OR
	    				       (CONCAT_WS(' - ', A.razon_social, A.rfc) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', A.razon_social, A.rfc) LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('A.fecha DESC, A.folio DESC');
			return $this->db->get()->result();
		}
	}


	//Método para regresar los detalles de un registro para mostrarlos en el archivo XML
	public function buscar_detalles_xml($intAnticipoID)
	{
		//Constantes para identificar los datos del SAT correspondientes al anticipo
   		$strClaveProductoServ = CLAVE_PRODUCTO_SAT_ANTICIPO;
   		$strClaveUnidad = CLAVE_UNIDAD_SAT_ANTICIPO;
   		$strUnidad = UNIDAD_SAT_ANTICIPO;

		$strSQL = $this->db->query("SELECT A.anticipo_id AS ID, 1 AS renglon,  _utf8'$strClaveProductoServ' AS ClaveProdServ, 
						  				  _utf8'' AS NoIdentificacion,  1 AS cantidad, _utf8'$strClaveUnidad' AS ClaveUnidad, 
						 				  _utf8'$strUnidad' AS Unidad, 
						 				  A.objeto_impuesto_sat AS ClaveObjetoImpuesto,
						 				  _utf8'ANTICIPO DEL BIEN O SERVICIO' AS Descripcion,
						 				  A.concepto,  A.subtotal, 0 AS descuento, A.iva, A.ieps, _utf8'' AS Pedimento, 
						  				  TIva.valor_maximo AS PorcentajeIva, TIva.factor AS FactorIva,  
						  				  IIva.codigo AS ImpuestoIva,  TIeps.valor_maximo AS PorcentajeIeps,
						  				  TIeps.factor AS FactorIeps, IIeps.codigo AS ImpuestoIeps, 
						  				  CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto
						  			FROM anticipos AS A
						  			INNER JOIN  sat_tasa_cuota AS TIva ON A.tasa_cuota_iva = TIva.tasa_cuota_id
						  			INNER JOIN  sat_impuestos AS IIva ON TIva.impuesto_id = IIva.impuesto_id
						  			LEFT JOIN  sat_tasa_cuota AS TIeps ON A.tasa_cuota_ieps = TIeps.tasa_cuota_id
						  			LEFT JOIN  sat_impuestos AS IIeps ON TIeps.impuesto_id = IIeps.impuesto_id
						  			LEFT JOIN sat_objeto_impuesto AS OImp ON A.objeto_impuesto_sat = OImp.codigo
						  			WHERE A.anticipo_id = $intAnticipoID");

		return $strSQL->result();
	}

	//Método para regresar la información de un movimiento fiscal que será cancelado
	public function buscar_movimiento_fiscal($intAnticipoID)
	{
		$strSQL = $this->db->query("SELECT E.rfc AS RFC, 
										NOW() AS Fecha, 
										A.uuid, 
										A.folio 
									FROM anticipos AS A
									INNER JOIN sucursales AS S ON S.sucursal_id = A.sucursal_id   
									INNER JOIN empresas E ON E.empresa_id = S.empresa_id
									WHERE A.anticipo_id = $intAnticipoID");
		return $strSQL->result();
	}


	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL, 
											 $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('anticipos AS A');
		$this->db->join('sat_monedas AS M', 'A.moneda_id = M.moneda_id', 'inner');
		$this->db->where('A.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
	    if($intProspectoID > 0)
	    {
	   		$this->db->where('A.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(A.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			
			$this->db->where('A.estatus', $strEstatus);
			
		}

		$this->db->where("((A.folio LIKE '%$strBusqueda%') OR
	    				   (A.concepto LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', A.rfc, A.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', A.rfc, A.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', A.razon_social, A.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', A.razon_social, A.rfc) LIKE '%$strBusqueda%'))");  

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	/*Método para regresar los saldos de los anticipos
	  que coincida con los criterios de búsqueda proporcionados (se utiliza en el reporte anticipos con saldo)*/
	public function buscar_saldos_anticipos($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intMonedaID = NULL,
											$strSucursales = NULL, $strTiposAnticipos = NULL, $intProspectoID = NULL,
										    $intAnticipoID = NULL, $strTipoAnticipo = NULL, $intReferenciaID = NULL, 
										    $strTipoReferencia = NULL, $strFormulario = NULL, $intRenglon = NULL)
	{
		//Variable que se utiliza para formar la  consulta
		$queryAnticipos = '';

		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		//Prospecto
		$strRestriccionesProspecto = '';
		//Moneda
		$strRestriccionesMoneda = '';
		//Fecha
		$strRestriccionesFecha = '';
		//ID´s de las sucursales
		$strRestriccionesSucursales = '';
		//ID de la referencia (anticipo)
		$strRestriccionesFiscalReferenciaID = '';
		$strRestriccionesNFiscalReferenciaID = '';
		//Variables que se utilizan para agregar restricciones de la referencia (formulario donde se aplica el anticipo por ejemplo: aplicación de anticipos, pedidos o remisiones)
		//ID de la aplicación de anticipo
		$strRestriccionesApliAnticipo = '';
		//ID del pedido de refacciones
		$strRestriccionesPedidoRefacciones = '';
		//ID de la remisión de refacciones
		$strRestriccionesRemisionRefacciones = '';
		//ID de la póliza de abono
		$strRestriccionesPolizaAbono = '';
		//ID del pago (detalle)
		$strRestriccionesPago = '';

		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			$strRestriccionesProspecto .= " AND Reg.prospecto_id = $intProspectoID";
		}

		//Si existe rago de fechas
		if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		{
			$strRestriccionesFecha = " AND DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'";
		}
		else if($dteFechaInicial != NULL)
		{
			$strRestriccionesFecha .= " AND DATE_FORMAT(Reg.fecha, '%Y-%m-%d') <= '$dteFechaInicial'";
		}

		//Si existe id de la moneda
		if($intMonedaID > 0)
		{
			$strRestriccionesMoneda .= " AND Reg.moneda_id = $intMonedaID";
		}

		//Si existen sucursales seleccionadas
		if($strSucursales)
		{
			//Generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
			$strRestriccionesSucursales .= " AND (";

			/*Quitar | de la lista para obtener el id de la sucursal*/
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

		//Si existe id del anticipo (Fiscal/No fiscal)
		if($intAnticipoID !== NULL)
		{

			$strRestriccionesFiscalReferenciaID = " AND Reg.anticipo_id = $intAnticipoID";
			$strRestriccionesNFiscalReferenciaID = " AND Reg.anticipo_no_fiscal_id = $intAnticipoID";
		}

		//Variable que se utiliza para asignar el id del anticipo al que hace referencia la aplicación de anticipos
		$intRefAntApli = "Reg.anticipo_id";
		//Variable que se utiliza para asignar el id del anticipo al que hace referencia la póliza de abono/pagos (póliza de aplicación)
		$intRefAntPoliza = 0;


		//Si se cumple la sentencia, significa que se generará la póliza de aplicación desde los procesos: pagos y polizas de abono
		if($strFormulario == 'polizas_aplicacion')
		{
			$intRefAntApli = 0;
			$intRefAntPoliza = "Reg.anticipo_id";
		}
		

		//Si existe id de la referencia
		if($intReferenciaID > 0)
		{
			//Si el tipo de referencia corresponde a una aplicación de anticipo
			if($strTipoReferencia == 'aplicacion_anticipo')
			{
				$strRestriccionesApliAnticipo .= " AND Reg.anticipo_aplicacion_id <> $intReferenciaID";

			}
			else if($strTipoReferencia == 'pedido_refacciones')
			{
				$strRestriccionesPedidoRefacciones .= " AND Reg.pedido_refacciones_id <> $intReferenciaID";

			}
			else if($strTipoReferencia == 'remision_refacciones')
			{
				$strRestriccionesRemisionRefacciones .= " AND Reg.remision_refacciones_id <> $intReferenciaID";
			}
			else if($strTipoReferencia == 'pago')
			{
				$strRestriccionesPago .= " AND Reg.pago_id <> $intReferenciaID";
				$strRestriccionesPago .= " AND PD.renglon <> $intRenglon";
			}
			else if($strTipoReferencia == 'poliza_abono')
			{
				$strRestriccionesPolizaAbono .= " AND Reg.poliza_abono_id <> $intReferenciaID";
			}
		}

		


		//Variables para definir que tipos de anticipos se incluiran en la búsqueda
		//Anticipos fiscales
		$queryAnticiposFiscales = "SELECT Reg.anticipo_id AS referencia_id, 
										 'FISCAL' AS tipo_referencia, Reg.folio,  Reg.fecha, 
										  DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
										  Reg.tipo_cambio, Reg.concepto, Reg.razon_social, 
										  Reg.tasa_cuota_iva,  Reg.tasa_cuota_ieps,  
										  TIva.valor_maximo AS porcentaje_iva, 
								 		  TIeps.valor_maximo AS porcentaje_ieps,
								 		  (ROUND((Reg.subtotal/Reg.tipo_cambio), 2)) AS subtotal,
										  (ROUND((Reg.iva/Reg.tipo_cambio), 2)) AS iva,
										  (ROUND((Reg.ieps/Reg.tipo_cambio), 2)) AS ieps,
								  		  ((ROUND((Reg.subtotal/Reg.tipo_cambio), 2) + 
										     ROUND((Reg.iva/Reg.tipo_cambio), 2) + 
										     ROUND((Reg.ieps/Reg.tipo_cambio), 2))) AS importe,
										   (((ROUND((Reg.subtotal/Reg.tipo_cambio), 2) + 
										      ROUND((Reg.iva/Reg.tipo_cambio), 2) + 
										      ROUND((Reg.ieps/Reg.tipo_cambio), 2))) -
										     IFNULL(ROUND((AplicacionAnticipo.Total / Reg.tipo_cambio),2), 0) -
										     IFNULL(ROUND((PolizaAbono.Total / Reg.tipo_cambio),2), 0) -
										     IFNULL(ROUND((PagoDet.Total / Reg.tipo_cambio),2), 0) -
										     IFNULL(ROUND((DevolucionAnticipo.Total / Reg.tipo_cambio),2), 0) -
										     IFNULL(ROUND((PagoRefacciones.Total / Reg.tipo_cambio),2), 0) -
										     IFNULL(ROUND((RemisionRefacciones.Total / Reg.tipo_cambio),2), 0)
										     ) AS saldo, 
										     (IFNULL(AplicacionAnticipo.numero_operaciones,0) +
										     	IFNULL(PolizaAbono.numero_operaciones,0) +
										     	IFNULL(PagoDet.numero_operaciones,0) +
											    IFNULL(DevolucionAnticipo.numero_operaciones,0) +
											    IFNULL(PagoRefacciones.numero_operaciones,0) +
											    IFNULL(RemisionRefacciones.numero_operaciones,0)) AS numero_operaciones 
								   FROM anticipos AS Reg
								   INNER JOIN sat_tasa_cuota AS TIva ON Reg.tasa_cuota_iva = TIva.tasa_cuota_id
								   LEFT JOIN sat_tasa_cuota AS TIeps ON Reg.tasa_cuota_ieps = TIeps.tasa_cuota_id
								   LEFT JOIN (SELECT Reg.anticipo_id AS referenciaID,
								   				     SUM(ROUND(Reg.subtotal,2) + 
							   						  	 ROUND(Reg.iva,2) + 
							   						  	 ROUND(Reg.ieps,2)) AS Total,
							   						  	 COUNT(Reg.anticipo_aplicacion_id) AS numero_operaciones
								   			  FROM anticipos_aplicacion AS Reg
								   			  WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
								   			  $strRestriccionesApliAnticipo
								   			  $strRestriccionesFecha
								   			  GROUP BY Reg.anticipo_id) AS AplicacionAnticipo ON AplicacionAnticipo.referenciaID = $intRefAntApli
							   	   LEFT JOIN (SELECT Reg.anticipo_id AS referenciaID,
						                	    SUM(ROUND(Det.precio, 2) + 
												    ROUND(Det.iva, 2) + 
												    ROUND(Det.ieps, 2)) AS Total,
												    COUNT(Reg.anticipo_id) AS numero_operaciones
						   				   FROM polizas_abono_02 AS Reg
						   				   INNER JOIN polizas_abono_detalles_02 AS Det ON 
											   Reg.poliza_abono_id = Det.poliza_abono_id
										   WHERE  Reg.estatus = 'ACTIVO'
										   $strRestriccionesPolizaAbono 
										   $strRestriccionesFecha
							    		   GROUP BY Reg.anticipo_id) AS PolizaAbono ON PolizaAbono.referenciaID = $intRefAntPoliza
							    	LEFT JOIN (SELECT PD.anticipo_id AS referenciaID,
						                	    SUM(ROUND(PDR.imp_pagado, 2)) AS Total,
												    COUNT(PD.anticipo_id) AS numero_operaciones
						   				   FROM pagos AS Reg
						   				   INNER JOIN pagos_detalles_02 AS PD ON  Reg.pago_id = PD.pago_id
						   				   INNER JOIN pagos_detalles_relacionados_02 AS PDR ON Reg.pago_id = PDR.pago_id
									   		   AND PDR.renglon_detalles = PD.renglon
										   WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
										   AND PD.anticipo_id > 0
										   $strRestriccionesPago 
										   $strRestriccionesFecha
							    		   GROUP BY PD.pago_id, PD.renglon, PD.anticipo_id) AS PagoDet ON PagoDet.referenciaID = $intRefAntPoliza
								    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
							                	    SUM(ROUND(Det.subtotal, 2) + 
													    ROUND(Det.iva, 2) + 
													    ROUND(Det.ieps, 2)) AS Total,
													    COUNT(Det.referencia_id) AS numero_operaciones
							   				   FROM anticipos_devolucion AS Reg
							   				   INNER JOIN anticipos_devolucion_detalles AS Det ON 
												   Reg.anticipo_devolucion_id = Det.anticipo_devolucion_id
												   AND Det.referencia = 'FISCAL'
											   WHERE  Reg.estatus = 'ACTIVO'
											   $strRestriccionesFecha
								    		   GROUP BY Det.referencia_id) AS DevolucionAnticipo ON DevolucionAnticipo.referenciaID = Reg.anticipo_id
								    LEFT JOIN (SELECT Reg.anticipo_id AS referenciaID, 
								   				     (SUM(ROUND(Reg.gastos_paqueteria,2) +
								   				    	 	 ROUND(Reg.gastos_paqueteria_iva,2)) +
								   					   SUM(ROUND((Det.precio_unitario * Det.cantidad),2) + 
							   						  	   ROUND((Det.iva_unitario * Det.cantidad),2) + 
							   						  	   ROUND((Det.ieps_unitario * Det.cantidad),2))) AS Total, 
							   						  COUNT(Reg.pedido_refacciones_id) AS numero_operaciones
											  FROM pedidos_refacciones_detalles AS Det
    										  INNER JOIN pedidos_refacciones AS Reg ON Det.pedido_refacciones_id = Reg.pedido_refacciones_id
								              WHERE Reg.estatus <> 'INACTIVO'
								               $strRestriccionesPedidoRefacciones
								               $strRestriccionesFecha
								              GROUP BY  Reg.anticipo_id) AS PagoRefacciones ON PagoRefacciones.referenciaID = Reg.anticipo_id
								    LEFT JOIN (SELECT Reg.anticipo_id AS referenciaID, 
								   				     (SUM(ROUND(Reg.gastos_paqueteria,2) +
								   				    	 	 ROUND(Reg.gastos_paqueteria_iva,2)) +
								   					   SUM(ROUND((Det.precio_unitario * Det.cantidad),2) + 
							   						  	   ROUND((Det.iva_unitario * Det.cantidad),2) + 
							   						  	   ROUND((Det.ieps_unitario * Det.cantidad),2))) AS Total,
							   						  	   COUNT(Reg.remision_refacciones_id) AS numero_operaciones
											  FROM remisiones_refacciones_detalles AS Det
    										  INNER JOIN remisiones_refacciones AS Reg ON Det.remision_refacciones_id = Reg.remision_refacciones_id
    										  LEFT JOIN pedidos_refacciones AS PR ON PR.pedido_refacciones_id = Reg.referencia_id AND Reg.tipo_referencia = 'PEDIDO'
								              WHERE Reg.estatus <> 'INACTIVO'
								              AND PR.anticipo_id IS NULL
								              $strRestriccionesRemisionRefacciones
								               $strRestriccionesFecha
								              GROUP BY  Reg.anticipo_id) AS RemisionRefacciones ON RemisionRefacciones.referenciaID = Reg.anticipo_id
								   WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR')
								   $strRestriccionesFecha
								   $strRestriccionesFiscalReferenciaID
								   $strRestriccionesSucursales
								   $strRestriccionesMoneda
								   $strRestriccionesProspecto";

		//Anticipos no fiscales
		$queryAnticiposNoFiscales = "SELECT Reg.anticipo_no_fiscal_id AS referencia_id,
											'NO FISCAL' AS tipo_referencia, Reg.folio, Reg.fecha, 
										    DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format, 
										    Reg.tipo_cambio, Reg.concepto, Reg.razon_social, 
										    Reg.tasa_cuota_iva, Reg.tasa_cuota_ieps,  
										    TIva.valor_maximo AS porcentaje_iva, 
								 		 	TIeps.valor_maximo AS porcentaje_ieps,
								 		 	(ROUND((Reg.subtotal/Reg.tipo_cambio), 2)) AS subtotal,
											(ROUND((Reg.iva/Reg.tipo_cambio), 2)) AS iva,
											(ROUND((Reg.ieps/Reg.tipo_cambio), 2)) AS ieps,
									  		((ROUND((Reg.subtotal/Reg.tipo_cambio), 2) + 
										      ROUND((Reg.iva/Reg.tipo_cambio), 2) + 
										      ROUND((Reg.ieps/Reg.tipo_cambio), 2))) AS importe,
										    ((ROUND((Reg.subtotal/Reg.tipo_cambio), 2) + 
										      ROUND((Reg.iva/Reg.tipo_cambio), 2) + 
										      ROUND((Reg.ieps/Reg.tipo_cambio), 2)) -
										      IFNULL(ROUND((DevolucionAnticipo.Total / Reg.tipo_cambio),2), 0)
										      ) AS saldo,
										    IFNULL(DevolucionAnticipo.numero_operaciones,0) AS numero_operaciones
								   FROM anticipos_no_fiscales AS Reg
								   INNER JOIN sat_tasa_cuota AS TIva ON Reg.tasa_cuota_iva = TIva.tasa_cuota_id
								   LEFT JOIN sat_tasa_cuota AS TIeps ON Reg.tasa_cuota_ieps = TIeps.tasa_cuota_id
								   LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
							                	    SUM(ROUND(Det.subtotal, 2) + 
													    ROUND(Det.iva, 2) + 
													    ROUND(Det.ieps, 2)) AS Total,
													    COUNT(Det.referencia_id) AS numero_operaciones
							   				   FROM anticipos_devolucion AS Reg
							   				   INNER JOIN anticipos_devolucion_detalles AS Det ON 
												   Reg.anticipo_devolucion_id = Det.anticipo_devolucion_id
												   AND Det.referencia = 'NO FISCAL'
											   WHERE  Reg.estatus = 'ACTIVO'
											   $strRestriccionesFecha
								    		   GROUP BY Det.referencia_id) AS DevolucionAnticipo ON DevolucionAnticipo.referenciaID = Reg.anticipo_no_fiscal_id 
								   WHERE Reg.estatus = 'ACTIVO'
								   $strRestriccionesFecha
								   $strRestriccionesNFiscalReferenciaID
								   $strRestriccionesSucursales
								   $strRestriccionesMoneda
								   $strRestriccionesProspecto";

		//Si existe id del anticipo (Fiscal/No fiscal)					   
		if($intAnticipoID !== NULL)
		{
			//Dependiendo del tipo de referencia realizar la búsqueda de datos
			if($strTipoAnticipo == 'FISCAL')//Anticipos fiscales
			{
				//Formar consulta
				$queryAnticipos .= $queryAnticiposFiscales;
			}
			else //Anticipos no fiscales
			{
				//Formar consulta
				$queryAnticipos .= $queryAnticiposNoFiscales;
			}

		}
		else if($strTiposAnticipos)//Si existen tipos de anticipos seleccionados
		{
			//Quitar | de la lista para obtener el tipo de anticipo
			$arrTiposAnticipos = explode("|", $strTiposAnticipos);

			//Hacer recorrido para formar restricción con los tipos de anticipos
			for ($intCon = 0; $intCon < sizeof($arrTiposAnticipos); $intCon++) 
			{
				//Variable que se utiliza para asignar el tipo de anticipo
				$strTipoAnticipo = $arrTiposAnticipos[$intCon];

				//Dependiendo del tipo de anticipo asignar valor a la restricción que se utiliza para buscar datos de los anticipos
				if($strTipoAnticipo == 'FISCALES')
				{
				    //Concatenar anticipos fiscales
			   		$queryAnticipos .= $queryAnticiposFiscales;
				}

				if($strTipoAnticipo == 'NO FISCALES')
				{
				    //Si existen anticipos asignar condición UNION
					$queryAnticipos .= (($queryAnticipos !== '') ? 
										" UNION " : '');

					//Concatenar anticipos no fiscales
					$queryAnticipos .= $queryAnticiposNoFiscales;
				}
			}
		}
		else
		{

			//Formar consulta
		    $queryAnticipos .= $queryAnticiposFiscales;
			$queryAnticipos .= " UNION ";
			$queryAnticipos .= $queryAnticiposNoFiscales;

		}


		$queryAnticipos .= " ORDER BY fecha, folio";
		$strSQL = $this->db->query($queryAnticipos);
		return $strSQL->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL, 
						   $strEstatus = NULL, $strBusqueda =  NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('A.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del cliente
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('A.prospecto_id', $intProspectoID);
	    }

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(A.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(A.estatus = 'TIMBRAR' OR A.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('A.estatus', $strEstatus);
			}
				

		}

		$this->db->where("((A.folio LIKE '%$strBusqueda%') OR
	    				   (A.concepto LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', A.rfc, A.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', A.rfc, A.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', A.razon_social, A.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', A.razon_social, A.rfc) LIKE '%$strBusqueda%'))"); 

		$this->db->from('anticipos AS A');
		$this->db->join('clientes AS C', 'A.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('sat_monedas AS M', 'A.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'A.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'A.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'A.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIva', 'A.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	     $this->db->join('polizas AS PF', 'A.anticipo_id = PF.referencia_id AND
	    							      PF.modulo = "CAJA" AND PF.proceso = "ANTICIPO"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("A.anticipo_id, A.folio, DATE_FORMAT(A.fecha,'%d/%m/%Y') AS fecha,
						   A.razon_social, A.rfc,  A.concepto, 
						   IFNULL(A.regimen_fiscal_id,0) AS regimen_fiscal_id,
						   CONCAT('$',FORMAT(((A.subtotal + A.iva +A.ieps) / A.tipo_cambio),2)) AS total, 
						   A.estatus, A.uuid, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza, 
						   IFNULL(CCFDI.cancelacion_id, 0) AS cancelacion_id", FALSE);
		$this->db->from('anticipos AS A');
		$this->db->join('clientes AS C', 'A.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('sat_monedas AS M', 'A.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'A.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'A.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'A.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIva', 'A.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	    $this->db->join('polizas AS PF', 'A.anticipo_id = PF.referencia_id AND
	    							      PF.modulo = "CAJA" AND PF.proceso = "ANTICIPO"', 'left');
	   $this->db->join('cancelaciones AS CCFDI', 'CCFDI.tipo_referencia = "ANTICIPO"
	    							        	  AND CCFDI.referencia_id = A.anticipo_id', 'left');

		$this->db->where('A.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del cliente
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('A.prospecto_id', $intProspectoID);
	    }

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(A.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(A.estatus = 'TIMBRAR' OR A.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('A.estatus', $strEstatus);
			}
				

		}

		$this->db->where("((A.folio LIKE '%$strBusqueda%') OR
	    				   (A.concepto LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', A.rfc, A.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', A.rfc, A.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', A.razon_social, A.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', A.razon_social, A.rfc) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('A.fecha DESC, A.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["anticipos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los datos de un registro (se utiliza para generar póliza)
	public function buscar_referencia_poliza($intReferenciaID, $strTipoReferencia)
	{

		//Constante para identificar la forma de pago: Transferencia electrónica
		$intFormaPagoIDTransferencia = FORMA_PAGO_TRANSFERENCIA;
		//Constante para identificar la forma de pago: Aplicación de anticipos
		$intFormaPagoIDApliAnticipo = FORMA_PAGO_APLICACION_ANTICIPO;


		//Dependiendo del tipo de referencia realizar consulta
		if($strTipoReferencia == 'ANTICIPO')
		{

			//Hacer un llamado a la función para verificar existencia del id del módulo, en caso de que no exista actualizar registro
			$this->set_modulo($intReferenciaID);

			//Anticipos fiscales
			$queryReferencia = "SELECT A.anticipo_id AS ID, A.sucursal_id, 'CAJA' AS Modulo, 
					       			'ANTICIPO' AS Proceso, A.folio, A.fecha_cobro AS fecha, 0 AS cuenta_bancaria_id, A.moneda_id, 
	       							P.codigo, A.razon_social, A.concepto, A.subtotal, ROUND(A.iva, 2) AS IVA, ROUND(A.ieps, 2) AS IEPS,
								    A.forma_pago_id,  A.tipo_cambio,
								     A.modulo_id, MA.descripcion AS departamento 
								FROM   anticipos AS A INNER JOIN prospectos AS P ON A.prospecto_id = P.prospecto_id 
								LEFT JOIN modulos AS MA ON A.modulo_id = MA.modulo_id
								WHERE  A.anticipo_id = $intReferenciaID";


		}
		else if($strTipoReferencia == 'RECIBO INTERNO ANTICIPO')
		{
			//Anticipos no fiscales
			$queryReferencia = "SELECT A.anticipo_no_fiscal_id AS ID, A.anticipo_no_fiscal_id AS ID02, A.sucursal_id, 'CAJA' AS Modulo,
							       	'RECIBO INTERNO ANTICIPO' AS Proceso, A.folio, A.fecha, A.cuenta_bancaria_id, A.moneda_id, P.codigo,
							      	A.razon_social, M.descripcion AS concepto, A.subtotal, ROUND(A.iva, 2) AS IVA, ROUND(A.ieps, 2) AS IEPS, 
								    $intFormaPagoIDTransferencia AS forma_pago_id, A.tipo_cambio,
								      M.descripcion AS departamento
							  FROM   anticipos_no_fiscales AS A INNER JOIN prospectos AS P ON A.prospecto_id = P.prospecto_id 
							  INNER JOIN modulos AS M ON A.modulo_id = M.modulo_id 
							  WHERE  A.anticipo_no_fiscal_id = $intReferenciaID";


		}
		else if($strTipoReferencia == 'RECIBO INGRESO')
		{
			//Recibos de ingreso
			$queryReferencia = "SELECT RI.recibo_ingreso_id AS ID,  RI.sucursal_id, 
								     'CUENTAS POR COBRAR' AS Modulo,  'RECIBO INGRESO' AS Proceso, RI.folio, RI.fecha, 
								      RI.moneda_id, P.codigo, RI.razon_social, RID.referencia AS concepto, 
								      SUM(RID.precio) AS subtotal, SUM(RID.iva) AS IVA, 
								   	  SUM(RID.ieps) AS IEPS, RI.forma_pago_id, RI.tipo_cambio 
							  FROM    recibos_ingreso AS RI 
							  INNER JOIN recibos_ingreso_detalles RID ON RI.recibo_ingreso_id = RID.recibo_ingreso_id 
							  INNER JOIN prospectos AS P ON RI.prospecto_id = P.prospecto_id
							  WHERE  RI.recibo_ingreso_id = $intReferenciaID 
							  GROUP BY RI.recibo_ingreso_id";
		}
		else if($strTipoReferencia == 'PAGO')
		{
			//Pagos 
			$queryReferencia = "SELECT P.pago_id AS ID, P.sucursal_id, 'CAJA' AS Modulo, 
							       'RECEPCION PAGO' AS Proceso, P.folio, PD.fecha_pago AS fecha, PD.cuenta_bancaria_id, 
							        PD.moneda_id, PR.codigo, P.razon_social, PDR.tipo_referencia AS concepto, 
					  			 	SUM(PDR.imp_pagado) AS subtotal, 0 AS IVA, 0 AS IEPS, PD.forma_pago_id, 
				 					PD.tipo_cambio
							   FROM   ((pagos AS P INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id) 
				     					INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PD.pago_id = PDR.pago_id 
									    AND PD.renglon = PDR.renglon_detalles) 
									 INNER JOIN prospectos AS PR ON P.prospecto_id = PR.prospecto_id 
							  WHERE  P.pago_id = $intReferenciaID 
							  AND    PD.forma_pago_id <> $intFormaPagoIDApliAnticipo
							  GROUP BY P.pago_id, PDR.renglon_detalles ";
		}
		else 
		{
			//Traspasos de caja a bancos
			$queryReferencia = "SELECT TCB.traspaso_caja_banco_id AS ID, TCB.sucursal_id, TCB.folio, 
							          TCB.fecha, TCB.cuenta_bancaria_id, TCB.importe, 
							          'CAJA' AS Modulo,  'TRASPASO BANCOS' AS Proceso
							   FROM   traspasos_caja_bancos AS TCB
							   WHERE  TCB.traspaso_caja_banco_id = $intReferenciaID ";
			
	    }

		//Ejecutar consulta
		$strSQL = $this->db->query($queryReferencia);
		return $strSQL->row();
	}

	//Método para regresar los detalles de un registro (se utiliza para generar póliza)
	public function buscar_detalles_poliza($intReferenciaID, $strTipoReferencia)
	{
		//Constante para identificar la forma de pago: Efectivo
		$intFormaPagoIDEfectivo = FORMA_PAGO_EFECTIVO;
		//Constante para identificar la forma de pago: Cheque nominativo
		$intFormaPagoIDCheque = FORMA_PAGO_CHEQUE;
		//Constante para identificar la forma de pago: Tarjeta de crédito
		$intFormaPagoIDTDC = FORMA_PAGO_TARJETA_CREDITO;
		//Constante para identificar la forma de pago: Tarjeta de débito
		$intFormaPagoIDTDD = FORMA_PAGO_TARJETA_DEBITO;
		//Constante para identificar la forma de pago: Transferencia electrónica
		$intFormaPagoIDTransferencia = FORMA_PAGO_TRANSFERENCIA;

		//Dependiendo del tipo de referencia realizar búsqueda de datos
		if($strTipoReferencia == 'RECIBO INGRESO')
		{
			//Recibos de ingreso
			$queryDetalles ="SELECT RID.recibo_ingreso_id, RID.renglon, RID.referencia, RID.referencia_id, 
								    RID.precio, RID.tasa_cuota_iva, RID.iva, IFNULL(RID.tasa_cuota_ieps, NULL) AS tasa_cuota_ieps, 
								    RID.ieps, STC.valor_maximo AS TasaIEPS
							 FROM   recibos_ingreso_detalles AS RID 
							 LEFT JOIN sat_tasa_cuota AS STC ON RID.tasa_cuota_ieps = STC.tasa_cuota_id 
							 WHERE  RID.recibo_ingreso_id = $intReferenciaID
			                 ORDER BY RID.tasa_cuota_iva, RID.tasa_cuota_ieps, RID.renglon";
		}
	    else if($strTipoReferencia == 'PAGO')
		{
			//Pagos
			$queryDetalles ="SELECT PDR.pago_id, PDR.renglon, PDR.tipo_referencia, PDR.referencia_id, PDR.imp_pagado
							 FROM  pagos_detalles_relacionados_02 AS PDR
							 WHERE PDR.pago_id = $intReferenciaID
			                 ORDER BY PDR.renglon";
		}
		else  
		{
			
			//Ingresos de traspasos de caja a bancos
			$queryDetalles ="SELECT TCBD.traspaso_caja_banco_id, TCBD.renglon, TCBD.importe, A.tipo_cambio, A.sucursal_id 
							 FROM   traspasos_caja_bancos_detalles AS TCBD INNER JOIN anticipos AS A 
								   ON TCBD.tipo_referencia = 'ANTICIPO' AND TCBD.referencia_id = A.anticipo_id 
							 WHERE  TCBD.traspaso_caja_banco_id = $intReferenciaID
							 AND    (A.forma_pago_id = $intFormaPagoIDEfectivo OR 
							         A.forma_pago_id = $intFormaPagoIDCheque OR 
							         A.forma_pago_id = $intFormaPagoIDTDC OR 
							         A.forma_pago_id = $intFormaPagoIDTDD OR 
							     	 A.forma_pago_id = $intFormaPagoIDTransferencia)";
			$queryDetalles.=" UNION "; 
			$queryDetalles .="SELECT TCBD.traspaso_caja_banco_id, TCBD.renglon, TCBD.importe, RI.tipo_cambio, RI.sucursal_id 
							  FROM   traspasos_caja_bancos_detalles AS TCBD INNER JOIN recibos_ingreso AS RI 
								       ON TCBD.tipo_referencia = 'RECIBO INGRESO' AND TCBD.referencia_id = RI.recibo_ingreso_id 
							  WHERE  TCBD.traspaso_caja_banco_id = $intReferenciaID
							  AND    (RI.forma_pago_id = $intFormaPagoIDEfectivo OR 
								      RI.forma_pago_id = $intFormaPagoIDCheque OR 
								      RI.forma_pago_id = $intFormaPagoIDTDC OR 
								      RI.forma_pago_id = $intFormaPagoIDTDD OR
								      RI.forma_pago_id = $intFormaPagoIDTransferencia)";
			$queryDetalles.=" UNION "; 
			$queryDetalles .="SELECT TCBD.traspaso_caja_banco_id, TCBD.renglon, TCBD.importe, PD.tipo_cambio, P.sucursal_id 
							  FROM   traspasos_caja_bancos_detalles AS TCBD INNER JOIN pagos_detalles_02 AS PD 
							       ON TCBD.tipo_referencia = 'PAGO' AND TCBD.referencia_id = PD.pago_id AND TCBD.renglon_referencia = PD.renglon 
							       INNER JOIN pagos AS P ON PD.pago_id = P.pago_id 
							  WHERE  TCBD.traspaso_caja_banco_id = $intReferenciaID
							  AND    (PD.forma_pago_id = $intFormaPagoIDEfectivo OR 
							          PD.forma_pago_id = $intFormaPagoIDCheque OR 
							          PD.forma_pago_id = $intFormaPagoIDTDC OR 
							          PD.forma_pago_id = $intFormaPagoIDTDD OR 
							          PD.forma_pago_id = $intFormaPagoIDTransferencia) 
							  ORDER BY renglon";
		}

		//Ejecutar consulta
		$strSQL = $this->db->query($queryDetalles);
		return $strSQL->result();

	}


	

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $intMonedaID, $intProspectoID, $strFormulario, $intReferenciaID)
	{
		$this->db->select("A.anticipo_id, A.folio, A.uuid, 
							CASE 
							  WHEN  A.regimen_fiscal_id > 0 
							  THEN A.regimen_fiscal_id		
							ELSE IFNULL(C.regimen_fiscal_id,0)
						    END regimen_fiscal_id", FALSE);
        $this->db->from('anticipos AS A');
        $this->db->join('clientes AS C', 'A.prospecto_id = C.prospecto_id', 'inner');
        //Si existe id de la moneda
        if($intMonedaID > 0)
        {
			$this->db->where('A.moneda_id', $intMonedaID);
        }
        
        //Si el formulario (tipo/proceso) es diferente a polizas por aplicación, significa, que no corresponde a aquellos donde se genarán polizas y el anticipo puede aplicarse para otro cliente
        if($strFormulario != 'polizas_aplicacion')
        {
        	//Si existe id del prospecto
	        if($intProspectoID > 0)
	        {
				$this->db->where('A.prospecto_id', $intProspectoID);
	        }

	        //Si el tipo corresponde a una cancelación de timbrado
	        if($strFormulario == 'cancelacion')
	        {
	        	$this->db->where('A.sucursal_id', $this->session->userdata('sucursal_id'));
	        	$this->db->where('A.anticipo_id <>', $intReferenciaID);

	        }

        }
        
	    $this->db->where('A.estatus', 'ACTIVO');
        $this->db->where("(A.folio LIKE '%$strDescripcion%')");  
        $this->db->order_by("A.folio",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>