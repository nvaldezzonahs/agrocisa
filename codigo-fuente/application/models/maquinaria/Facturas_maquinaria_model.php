<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');
//Incluir la clase modelo de CFDI relacionados (para guardar los CFDI relacionados del registro)
include_once(APPPATH . 'models/caja/Cfdi_relacionados_model.php');
//Incluir la clase modelo de Maquinaria Inventario (para cambiar el estatus de una maquinara facturada)
include_once(APPPATH . 'models/maquinaria/Maquinaria_inventario_model.php');
//Incluir la clase modelo de Pedidos Maquinaria (para cambiar el estatus de un pedido a facturado)
include_once(APPPATH . 'models/maquinaria/Pedidos_maquinaria_model.php');
//Incluir la clase modelo de claves de autorización (para modificar el estatus de la clave)
include_once(APPPATH . 'models/cuentas_cobrar/Claves_autorizacion_model.php');
//Incluir la clase modelo de cancelaciones (para guardar la cancelación del timbrado (CFDI))
include_once(APPPATH . 'models/contabilidad/Cancelaciones_model.php');



class Facturas_maquinaria_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla facturas_maquinaria
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objFacturaMaquinaria)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        //Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();
        //Se crea una instancia de la clase modelo (Maquinaria_inventario) 
        $otdMaquinariaInventario = new  Maquinaria_inventario_model();
        //Se crea una instancia de la clase modelo (Pedidos_maquinaria) 
        $otdPedidosMaquinaria = new  Pedidos_maquinaria_model();
		
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objFacturaMaquinaria->strFolio); 

		//Concatenar hora, minutos y segundos
		$dteFecha = $objFacturaMaquinaria->dteFecha.' '.date("H:i:s"); 
 
		//Tabla facturas_maquinaria
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objFacturaMaquinaria->intSucursalID, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha,
						  'condiciones_pago' => $objFacturaMaquinaria->strCondicionesPago, 
						  'vencimiento' => $objFacturaMaquinaria->dteVencimiento, 
						  'moneda_id' => $objFacturaMaquinaria->intMonedaID, 
						  'tipo_cambio' => $objFacturaMaquinaria->intTipoCambio,
						  'pedido_maquinaria_id' => $objFacturaMaquinaria->intPedidoMaquinariaID,
						  'vendedor_id' => $objFacturaMaquinaria->intVendedorID,
						  'prospecto_id' => $objFacturaMaquinaria->intProspectoID,
						  'razon_social' => $objFacturaMaquinaria->strRazonSocial, 
						  'rfc' => $objFacturaMaquinaria->strRfc, 
						  'regimen_fiscal_id' => $objFacturaMaquinaria->intRegimenFiscalID,
						  'calle' => $objFacturaMaquinaria->strCalle,
						  'numero_exterior' => $objFacturaMaquinaria->strNumeroExterior,
						  'numero_interior' => $objFacturaMaquinaria->strNumeroInterior,
						  'codigo_postal' => $objFacturaMaquinaria->strCodigoPostal,
						  'colonia' => $objFacturaMaquinaria->strColonia,
						  'localidad' => $objFacturaMaquinaria->strLocalidad,
						  'municipio' => $objFacturaMaquinaria->strMunicipio,
						  'estado' => $objFacturaMaquinaria->strEstado,
						  'pais' => $objFacturaMaquinaria->strPais,
						  'observaciones' => $objFacturaMaquinaria->strObservaciones,
						  'notas' => $objFacturaMaquinaria->strNotas,
						  'estatus'  => 'TIMBRAR',
						  'maquinaria_descripcion_id' => $objFacturaMaquinaria->intMaquinariaDescripcionID,
						  'serie' => $objFacturaMaquinaria->strSerie,
						  'motor' => $objFacturaMaquinaria->strMotor,
						  'codigo' => $objFacturaMaquinaria->strCodigo,
						  'descripcion_corta' => $objFacturaMaquinaria->strDescripcionCorta,
						  'descripcion' => $objFacturaMaquinaria->strDescripcion,
						  'codigo_sat' => $objFacturaMaquinaria->strCodigoSat,
						  'unidad_sat' => $objFacturaMaquinaria->strUnidadSat,
						  'objeto_impuesto_sat' => $objFacturaMaquinaria->strObjetoImpuestoSat,
						  'precio' => $objFacturaMaquinaria->intPrecio,
						  'descuento' => $objFacturaMaquinaria->intDescuento,
						  'tasa_cuota_iva' => $objFacturaMaquinaria->intTasaCuotaIva,
						  'iva' => $objFacturaMaquinaria->intIva,
						  'tasa_cuota_ieps' => $objFacturaMaquinaria->intTasaCuotaIeps,
						  'ieps' => $objFacturaMaquinaria->intIeps,
						  'forma_pago_id' => $objFacturaMaquinaria->intFormaPagoID,
						  'metodo_pago_id' => $objFacturaMaquinaria->intMetodoPagoID,
						  'uso_cfdi_id' => $objFacturaMaquinaria->intUsoCfdiID,
						  'tipo_relacion_id' => $objFacturaMaquinaria->intTipoRelacionID,
						  'exportacion_id' => $objFacturaMaquinaria->intExportacionID,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objFacturaMaquinaria->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('facturas_maquinaria', $arrDatos);
		
		//Agregar id del nuevo registro al objeto
		$objFacturaMaquinaria->intFacturaMaquinariaID  = $this->db->insert_id();
		
		//Hacer un llamado al método para cambiar el estatus del pedido
		$otdPedidosMaquinaria->set_estatus($objFacturaMaquinaria->intPedidoMaquinariaID, 
								           'FACTURADO');

		//Modificar la información de inventario de MAQUINARIA
		//Si la MAQUINARIA que se facturó es de tipo SIMPLE
		if($objFacturaMaquinaria->strSerie != '')
		{
			//Hacer un llamado al método para modificar el estatus de la maquinaria
			$otdMaquinariaInventario->set_estatus($objFacturaMaquinaria->intMaquinariaDescripcionID, 
												  $objFacturaMaquinaria->strSerie, 
												  'FACTURADO', NULL, $objFacturaMaquinaria->strConsignacion);
		}
		else  //Si la MAQUINARIA que se facturó es de tipo COMPUESTA
		{   
		   
		    //Hacer un llamado al método para guardar componentes correspondientes a una maquinaria(en caso de que aplique)
			$this->guardar_componentes($objFacturaMaquinaria);

		    //Hacer un llamado al método para modificar el estatus de la maquinaria compuesta
			$otdMaquinariaInventario->set_estatus_componentes($objFacturaMaquinaria->strMaquinariaDescripcionID, 
															  $objFacturaMaquinaria->strSeries, 
															  'FACTURADO', $objFacturaMaquinaria->strConsignacion);
		}

		//Hacer un llamado al método para guardar los CFDI relacionados de la factura
		$otdModelCfdiRelacionados->guardar($objFacturaMaquinaria->intFacturaMaquinariaID, 
										   'FACTURA MAQUINARIA', 
										   $objFacturaMaquinaria->strCfdiRelacionado, 
										   $objFacturaMaquinaria->strTiposRelacion);


		//Si existe id de la clave de autorización, significa que se excedio del límite de crédito o el cliente tiene saldo vencido
		//en las facturas de maquinaria, refacciones y/o servicio
		if($objFacturaMaquinaria->intClaveAutorizacionID > 0)
		{
			//Se crea una instancia de la clase modelo (claves de autorización) 
       	    $otdModelClavesAutorizacion = new  Claves_autorizacion_model();
       	    
       	    //Hacer un llamado al método para modificar el estatus de la clave de autorización
			$otdModelClavesAutorizacion->modificar($objFacturaMaquinaria->intClaveAutorizacionID, 
										   	  	   'MAQUINARIA', $objFacturaMaquinaria->intFacturaMaquinariaID);

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
		return $this->db->trans_status().'_'.$objFacturaMaquinaria->intFacturaMaquinariaID;

	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objFacturaMaquinaria)
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();
         //Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();
      
        //Concatenar hora, minutos y segundos
		$dteFecha = $objFacturaMaquinaria->dteFecha.' '.date("H:i:s"); 

		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha,
						  'condiciones_pago' => $objFacturaMaquinaria->strCondicionesPago, 
						  'vencimiento' => $objFacturaMaquinaria->dteVencimiento, 
						  'moneda_id' => $objFacturaMaquinaria->intMonedaID, 
						  'tipo_cambio' => $objFacturaMaquinaria->intTipoCambio,
						  'pedido_maquinaria_id' => $objFacturaMaquinaria->intPedidoMaquinariaID,
						  'vendedor_id' => $objFacturaMaquinaria->intVendedorID,
						  'prospecto_id' => $objFacturaMaquinaria->intProspectoID,
						  'razon_social' => $objFacturaMaquinaria->strRazonSocial, 
						  'rfc' => $objFacturaMaquinaria->strRfc, 
						  'regimen_fiscal_id' => $objFacturaMaquinaria->intRegimenFiscalID,
						  'calle' => $objFacturaMaquinaria->strCalle,
						  'numero_exterior' => $objFacturaMaquinaria->strNumeroExterior,
						  'numero_interior' => $objFacturaMaquinaria->strNumeroInterior,
						  'codigo_postal' => $objFacturaMaquinaria->strCodigoPostal,
						  'colonia' => $objFacturaMaquinaria->strColonia,
						  'localidad' => $objFacturaMaquinaria->strLocalidad,
						  'municipio' => $objFacturaMaquinaria->strMunicipio,
						  'estado' => $objFacturaMaquinaria->strEstado,
						  'pais' => $objFacturaMaquinaria->strPais,
						  'observaciones' => $objFacturaMaquinaria->strObservaciones,
						  'notas' => $objFacturaMaquinaria->strNotas,
						  'maquinaria_descripcion_id' => $objFacturaMaquinaria->intMaquinariaDescripcionID,
						  'serie' => $objFacturaMaquinaria->strSerie,
						  'motor' => $objFacturaMaquinaria->strMotor,
						  'codigo' => $objFacturaMaquinaria->strCodigo,
						  'descripcion_corta' => $objFacturaMaquinaria->strDescripcionCorta,
						  'descripcion' => $objFacturaMaquinaria->strDescripcion,
						  'codigo_sat' => $objFacturaMaquinaria->strCodigoSat,
						  'unidad_sat' => $objFacturaMaquinaria->strUnidadSat,
						  'objeto_impuesto_sat' => $objFacturaMaquinaria->strObjetoImpuestoSat,
						  'precio' => $objFacturaMaquinaria->intPrecio,
						  'descuento' => $objFacturaMaquinaria->intDescuento,
						  'tasa_cuota_iva' => $objFacturaMaquinaria->intTasaCuotaIva,
						  'iva' => $objFacturaMaquinaria->intIva,
						  'tasa_cuota_ieps' => $objFacturaMaquinaria->intTasaCuotaIeps,
						  'ieps' => $objFacturaMaquinaria->intIeps,
						  'forma_pago_id' => $objFacturaMaquinaria->intFormaPagoID,
						  'metodo_pago_id' => $objFacturaMaquinaria->intMetodoPagoID,
						  'uso_cfdi_id' => $objFacturaMaquinaria->intUsoCfdiID,
						  'tipo_relacion_id' => $objFacturaMaquinaria->intTipoRelacionID,
						  'exportacion_id' => $objFacturaMaquinaria->intExportacionID,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objFacturaMaquinaria->intUsuarioID);
		$this->db->where('factura_maquinaria_id', $objFacturaMaquinaria->intFacturaMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('facturas_maquinaria', $arrDatos);

		//Si la MAQUINARIA cuenta con componentes
		if($objFacturaMaquinaria->strMaquinariaDescripcionID != '')
		{

			//Hacer un llamado al método para modificar componentes correspondientes a una maquinaria(en caso de que aplique)
			$this->modificar_componentes($objFacturaMaquinaria);

		}


		//Hacer un llamado al método para guardar los CFDI relacionados de la factura
		$otdModelCfdiRelacionados->guardar($objFacturaMaquinaria->intFacturaMaquinariaID, 
									       'FACTURA MAQUINARIA', 
									        $objFacturaMaquinaria->strCfdiRelacionado, 
									        $objFacturaMaquinaria->strTiposRelacion);


		//Si existe id de la clave de autorización, significa que se excedio del límite de crédito o el cliente tiene saldo vencido
		//en las facturas de maquinaria, refacciones y/o servicio
		if($objFacturaMaquinaria->intClaveAutorizacionID > 0)
		{
			//Se crea una instancia de la clase modelo (claves de autorización) 
       	    $otdModelClavesAutorizacion = new  Claves_autorizacion_model();
       	    
       	    //Hacer un llamado al método para modificar el estatus de la clave de autorización
			$otdModelClavesAutorizacion->modificar($objFacturaMaquinaria->intClaveAutorizacionID, 
										   	  	   'MAQUINARIA', $objFacturaMaquinaria->intFacturaMaquinariaID);

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
		$this->db->where('factura_maquinaria_id', $objTimbrado->intReferenciaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('facturas_maquinaria', $arrDatos);
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
		//Se crea una instancia de la clase modelo (Maquinaria_inventario) 
        $otdMaquinariaInventario = new  Maquinaria_inventario_model();
        //Se crea una instancia de la clase modelo (Pedidos_maquinaria) 
        $otdPedidosMaquinaria = new  Pedidos_maquinaria_model();


        ///Modificar el estatus a INACTIVO de un registro de facturas de maquinaria
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('factura_maquinaria_id', $objCancelacionCfdi->intReferenciaCfdiID);
		$this->db->limit(1);
		$this->db->update('facturas_maquinaria', $arrDatos);
		
		//Modificamos el estatus del PEDIDO correspondiente a la factura que ha sido cancelada
		$otdFacturaMaquinaria  = $this->buscar($objCancelacionCfdi->intReferenciaCfdiID);

		//Hacer un llamado al método para cambiar el estatus del pedido
		$otdPedidosMaquinaria->set_estatus($otdFacturaMaquinaria->pedido_maquinaria_id, 
									       'AUTORIZADO');


		//Modificar la información de inventario de MAQUINARIA
		//Si la MAQUINARIA que se facturó es de tipo SIMPLE
		if($otdFacturaMaquinaria->serie != '')
		{
			//Hacer un llamado al método para modificar el estatus de la maquinaria
			$otdMaquinariaInventario->set_estatus($otdFacturaMaquinaria->maquinaria_descripcion_id, 
												  $otdFacturaMaquinaria->serie, 
												  'ACTIVO');
		}
		else
		{
			//Seleccionar los detalles de la factura para modificar el estatus de los componentes
			$otdDetalles = $this->buscar_detalles($objCancelacionCfdi->intReferenciaCfdiID);

			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDet)
				{
					//Hacer un llamado al método para modificar el estatus de la maquinaria
					$otdMaquinariaInventario->set_estatus($arrDet->maquinaria_descripcion_id, 
												 		  $arrDet->serie, 
												  		  'ACTIVO');
				}

			}//Cierre de verificación de detalles

		}
		
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
	public function buscar($intFacturaMaquinariaID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		$this->db->select("	FM.factura_maquinaria_id,FM.sucursal_id, 
							FM.folio, FM.fecha, 
						   	DATE_FORMAT(FM.fecha,'%d/%m/%Y') AS fecha_format,
						   	FM.condiciones_pago, FM.condiciones_pago AS CondicionesDePago, 
						   	DATE_FORMAT(FM.vencimiento,'%d/%m/%Y') AS vencimiento, 
						   	FM.moneda_id, FM.tipo_cambio, FM.pedido_maquinaria_id, 
						   	FM.vendedor_id, FM.prospecto_id, FM.razon_social, 
						   	FM.rfc, 
						   	CASE 
							   WHEN  FM.regimen_fiscal_id > 0 
							   		THEN FM.regimen_fiscal_id		
							   ELSE IFNULL(C.regimen_fiscal_id,0)
						    END regimen_fiscal_id,
						    IFNULL(FM.regimen_fiscal_id,0) AS regimenFiscalAnterior,
						   	FM.calle, FM.numero_exterior, FM.numero_interior, 
						   	FM.codigo_postal, FM.colonia, FM.localidad, FM.municipio, FM.estado, 
						   	FM.pais, FM.observaciones, FM.notas, FM.estatus, 
						   	FM.maquinaria_descripcion_id, FM.codigo AS modelo, 
						   	FM.serie, FM.motor, FM.codigo, FM.descripcion_corta, 
						   	FM.descripcion, FM.codigo_sat, FM.unidad_sat, 
						    FM.objeto_impuesto_sat, FM.precio, 
						   	FM.descuento, 	FM.tasa_cuota_iva, 
						   	FM.iva, FM.tasa_cuota_ieps, FM.ieps, FM.forma_pago_id, 
						    FM.metodo_pago_id,FM.uso_cfdi_id,   
						    CASE   
						      WHEN FM.tipo_relacion_id > 0 THEN FM.tipo_relacion_id
						      ELSE ''  
						    END AS tipo_relacion_id, 
						    FM.exportacion_id,
						    FM.certificado, FM.sello, FM.uuid, 
						    FM.fecha_timbrado, FM.certificado_sat, 
						    FM.sello_sat, FM.leyenda_sat, FM.rfc_pac,
						    CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre) AS vendedor, 
						    C.razon_social AS cliente,
						    P.codigo AS CodigoProspecto, 
						    SCP.codigo_postal AS CodigoPostalProspecto,
						    C.correo_electronico, 
						    C.contacto_correo_electronico, 
						    C.telefono_principal, 
						    C.maquinaria_credito_dias, 
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
						    TIva.valor_maximo AS porcentaje_iva, 
						    TIeps.valor_maximo AS porcentaje_ieps,
						    _utf8'I' AS TipoDeComprobante,
						   	CONCAT_WS(' - ', TC.codigo, TC.descripcion) AS tipo_comprobante,
						   RF.codigo AS RegimenFiscal,
						   CONCAT_WS(' - ', RF.codigo, RF.descripcion) AS regimen_fiscal,
						   ECF.codigo AS CodigoExportacion,
						   CONCAT_WS(' - ', ECF.codigo, ECF.descripcion) AS exportacion,
						    PM.folio AS folio_pedido, 
						    ML.descripcion AS maquinaria_linea ,MM.descripcion AS maquinaria_marca,
						    MMOD.descripcion AS maquinaria_modelo, 
						    IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza, 
						   	IFNULL(CA.clave_autorizacion_id, 0) AS clave_autorizacion_id", FALSE);
	    $this->db->from('facturas_maquinaria AS FM');
	    $this->db->join('pedidos_maquinaria AS PM', 'FM.pedido_maquinaria_id = PM.pedido_maquinaria_id', 'inner');
	    $this->db->join('sat_monedas AS M', 'FM.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('vendedores AS V', 'FM.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
	    $this->db->join('clientes AS C', 'FM.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS P', 'P.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'FM.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'FM.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'FM.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIva', 'FM.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	    $this->db->join('maquinaria_descripciones AS MD', 'FM.maquinaria_descripcion_id = MD.maquinaria_descripcion_id', 'inner');
	    $this->db->join('maquinaria_lineas AS ML', 'MD.maquinaria_linea_id = ML.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MM', 'MD.maquinaria_marca_id = MM.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'MD.maquinaria_modelo_id = MMOD.maquinaria_modelo_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'FM.tipo_relacion_id = TR.tipo_relacion_id', 'left');
	    $this->db->join('sat_tasa_cuota AS TIeps', 'FM.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
	    $this->db->join('sat_codigos_postales AS SCP', 'SCP.codigo_postal_id = C.codigo_postal_id', 'left');
	    $this->db->join('sat_tipos_comprobante AS TC', 'TC.codigo = "I"', 'left');
	     $this->db->join('sat_exportacion AS ECF', 'FM.exportacion_id = ECF.exportacion_id', 'left');
	     $this->db->join('sat_regimen_fiscal AS RF', 'FM.regimen_fiscal_id = RF.regimen_fiscal_id', 'left');
	    $this->db->join('polizas AS PF', 'FM.factura_maquinaria_id = PF.referencia_id AND
	    							      PF.modulo = "MAQUINARIA" AND PF.proceso = "FACTURACION"', 'left');
	    $this->db->join('claves_autorizacion AS CA', 'FM.factura_maquinaria_id = CA.referencia_id AND
	    							     		      CA.referencia = "MAQUINARIA"', 'left');

		//Si existe id de la cotización
		if ($intFacturaMaquinariaID != NULL)
		{   
			$this->db->where('FM.factura_maquinaria_id', $intFacturaMaquinariaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('FM.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('FM.prospecto_id', $intProspectoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(FM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }
		    
		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(FM.estatus = 'TIMBRAR' OR FM.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('FM.estatus', $strEstatus);
				}
			}

			$this->db->where("((FM.folio LIKE '%$strBusqueda%') OR
		    				   (CONCAT_WS(' - ', FM.rfc, FM.razon_social) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', FM.rfc, FM.razon_social) LIKE '%$strBusqueda%') OR
	    				       (CONCAT_WS(' - ', FM.razon_social, FM.rfc) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', FM.razon_social, FM.rfc) LIKE '%$strBusqueda%') OR 
			                   (PM.folio LIKE '%$strBusqueda%'))");

			$this->db->order_by('FM.fecha DESC, FM.folio DESC');
			return $this->db->get()->result();
		}
	}


	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						  					 $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('facturas_maquinaria AS FM');
		$this->db->join('pedidos_maquinaria AS PM', 'FM.pedido_maquinaria_id = PM.pedido_maquinaria_id', 'inner');
		$this->db->join('sat_monedas AS M', 'FM.moneda_id = M.moneda_id', 'inner');
		$this->db->where('FM.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('FM.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(FM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('FM.estatus', $strEstatus);
		}

		$this->db->where("((FM.folio LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', FM.rfc, FM.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', FM.rfc, FM.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', FM.razon_social, FM.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', FM.razon_social, FM.rfc) LIKE '%$strBusqueda%') OR 
		                   (PM.folio LIKE '%$strBusqueda%'))");

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}


	//Método para regresar los datos de un registro (se utiliza para generar póliza)
	public function buscar_referencia_poliza($intReferenciaID, $strTipoReferencia)
	{
		//Constante para identificar al tipo de movimiento: facturación
		$intTipoServicioFacturacion = TIPO_SERVICIO_FACTURACION;
		//Constante para identificar al tipo de movimiento: entradas de maquinaria por compra
		$intMovEntradaCompra = ENTRADA_MAQUINARIA_COMPRA;
		//Constante para identificar al tipo de movimiento: salidas de maquinaria por venta
		$intMovSalidaVenta = SALIDA_MAQUINARIA_VENTA;
		//Constante para identificar al tipo de movimiento: salidas de maquinaria por traspaso
		$intMovSalidaTraspaso = SALIDA_MAQUINARIA_TRASPASO;
		//Constante para identificar al tipo de movimiento: salidas de maquinaria por demostración
		$intMovSalidaDemostracion = SALIDA_MAQUINARIA_DEMOSTRACION;
		//Constante para identificar al tipo de movimiento: salidas de maquinaria por validación
		$intMovSalidaValidacion = SALIDA_MAQUINARIA_VALIDACION;
		//Constante para identificar al tipo de movimiento: salidas de maquinaria  por devolución al proveedor
		$intMovSalidaDevProv = SALIDA_MAQUINARIA_DEVOLUCION_PROVEEDOR;

		//Dependiendo del tipo de referencia realizar consulta
		if($strTipoReferencia == 'FACTURA MAQUINARIA')
		{
			//Facturas de maquinaria
			$queryReferencia = "SELECT FM.factura_maquinaria_id AS referencia_id, 
									   FM.sucursal_id, $intTipoServicioFacturacion AS tipo_movimiento, 
									   FM.folio, FM.fecha, FM.moneda_id, M.codigo AS Moneda, 
									   FM.estatus 
								FROM   facturas_maquinaria AS FM 
								LEFT JOIN sat_monedas AS M ON FM.moneda_id = M.moneda_id 
								WHERE  FM.factura_maquinaria_id = $intReferenciaID";
		}
		else //Movimientos de maquinaria
		{
			//Movimientos de maquinaria
			$queryReferencia = "SELECT MM.movimiento_maquinaria_id AS referencia_id, 
									   MM.sucursal_id, MM.tipo_movimiento, 
									   MM.folio, MM.fecha, 
									   CASE 
											WHEN MM.tipo_movimiento = $intMovSalidaDevProv THEN
											EntradaCompra.moneda_id
											ELSE
									  		 MM.moneda_id 
									    END AS moneda_id, 
									   CASE 
											WHEN MM.tipo_movimiento = $intMovSalidaDevProv THEN
											EntradaCompra.Moneda
											ELSE
									  		 M.codigo 
									     END AS Moneda, 
								      MM.estatus
							    FROM  movimientos_maquinaria AS MM 
							    LEFT JOIN sat_monedas AS M ON MM.moneda_id = M.moneda_id
							    LEFT JOIN (SELECT MM.movimiento_maquinaria_id AS referenciaID, 
							    				  MM.moneda_id, 
							    				  M.codigo AS Moneda
							    		   FROM movimientos_maquinaria AS MM
							    		   INNER JOIN sat_monedas AS M ON MM.moneda_id = M.moneda_id
							    		   WHERE MM.tipo_movimiento = $intMovEntradaCompra) AS EntradaCompra ON EntradaCompra.referenciaID = MM.referencia_id
		                        WHERE  MM.movimiento_maquinaria_id = $intReferenciaID
								AND    MM.tipo_movimiento <> $intMovSalidaVenta
								AND    MM.tipo_movimiento <> $intMovSalidaTraspaso 
								AND    MM.tipo_movimiento <> $intMovSalidaDemostracion
								AND    MM.tipo_movimiento <> $intMovSalidaValidacion";
		}

		//Ejecutar consulta
		$strSQL = $this->db->query($queryReferencia);
		return $strSQL->row();
	}


	//Método para regresar los detalles de un registro (se utiliza para generar póliza)
	public function buscar_detalles_poliza($intReferenciaID, $intTipoMovimiento)
	{
		//Dependiendo del tipo de servicio realizar búsqueda de datos
		if($intTipoMovimiento == ENTRADA_MAQUINARIA_COMPRA)
		{
			//Entradas de maquinaria por compra
			$queryDetalles ="SELECT MM.movimiento_maquinaria_id AS ID, MM.referencia_id, 
								   P.codigo, P.razon_social, P.tipo_proveedor, 
				   				   CM.factura, ML.maquinaria_linea_id AS modulo_id,
				   				   ML.descripcion AS Modulo, 
				   				   MMD.renglon, MMD.maquinaria_descripcion_id, 
								   MMD.descripcion_corta, MMD.serie, MMD.motor, 
								   CMD.precio_unitario, CMD.iva_unitario,
								   MI.codigo_interno, MI.consignacion 
							FROM   movimientos_maquinaria AS MM 
							INNER JOIN movimientos_maquinaria_detalles AS MMD 
								  ON MM.movimiento_maquinaria_id = MMD.movimiento_maquinaria_id 
							INNER JOIN ordenes_compra_maquinaria AS CM ON MM.referencia_id = CM.orden_compra_maquinaria_id 
						    INNER JOIN ordenes_compra_maquinaria_detalles AS CMD
							      ON CM.orden_compra_maquinaria_id = CMD.orden_compra_maquinaria_id 
				   				  AND MMD.maquinaria_descripcion_id = CMD.maquinaria_descripcion_id 
						    INNER JOIN proveedores AS P ON CM.proveedor_id = P.proveedor_id 
						    INNER JOIN maquinaria_descripciones AS MD 
						          ON MMD.maquinaria_descripcion_id = MD.maquinaria_descripcion_id 
						    INNER JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id 
						    INNER JOIN maquinaria_inventario AS MI ON MM.sucursal_id = MI.sucursal_id 
						          AND MMD.maquinaria_descripcion_id = MI.maquinaria_descripcion_id 
						          AND MMD.serie = MI.serie  
						    WHERE  MM.movimiento_maquinaria_id = $intReferenciaID
						    ORDER BY MMD.renglon";

		}
		else if($intTipoMovimiento == ENTRADA_MAQUINARIA_TRASPASO)
		{
			//Entradas de maquinaria por traspaso
			$queryDetalles ="SELECT MM.movimiento_maquinaria_id AS ID, MM.sucursal_id AS DestinoID, 
								    S.nombre AS Destino, MM2.sucursal_id AS OrigenID, 
								    S2.nombre AS Origen, ML.maquinaria_linea_id AS modulo_id,
								    ML.descripcion AS Modulo, MMD.renglon,
				   					MMD.maquinaria_descripcion_id, MMD.descripcion_corta, 
				   					MMD.serie, MMD.motor, MI.costo, MI.entrada_id, MI.codigo_interno, 
				   					MI.consignacion 
							FROM   movimientos_maquinaria AS MM 
							INNER JOIN movimientos_maquinaria_detalles AS MMD 
								   ON MM.movimiento_maquinaria_id = MMD.movimiento_maquinaria_id 
							INNER JOIN maquinaria_descripciones AS MD 
								   ON MMD.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
							INNER JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id
							INNER JOIN sucursales AS S ON MM.sucursal_id = S.sucursal_id
							INNER JOIN movimientos_maquinaria AS MM2 ON MM.referencia_id = MM2.movimiento_maquinaria_id 
							INNER JOIN sucursales AS S2 ON MM2.sucursal_id = S2.sucursal_id 
							INNER JOIN maquinaria_inventario AS MI ON MI.sucursal_id = MM2.sucursal_id 
								  AND MI.maquinaria_descripcion_id = MMD.maquinaria_descripcion_id 
								  AND MI.serie = MMD.serie  
							WHERE  MM.movimiento_maquinaria_id = $intReferenciaID
							ORDER BY MMD.renglon";
		}
		else if($intTipoMovimiento == ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA)
		{
			//Entradas de maquinaria por devolución de factura
			$queryDetalles ="SELECT MM.movimiento_maquinaria_id AS ID, 
								    P.codigo, FM.razon_social, FM.condiciones_pago, 
								    ML.maquinaria_linea_id AS modulo_id,
				   					ML.descripcion AS Modulo, MMD.renglon, 
				   					FM.precio, FM.tasa_cuota_iva, ROUND(FM.iva, 2) AS IVA, 
				   					FM.maquinaria_descripcion_id, MI.costo, MI.entrada_id, 
				   					MI.codigo_interno, FM.serie, FM.motor, MI.descripcion_corta, 
				   					MI.consignacion 
							FROM  movimientos_maquinaria AS MM 
							INNER JOIN movimientos_maquinaria_detalles AS MMD
				   				  ON MM.movimiento_maquinaria_id = MMD.movimiento_maquinaria_id
				   			INNER JOIN facturas_maquinaria AS FM ON MM.referencia_id = FM.factura_maquinaria_id 
				   			INNER JOIN prospectos AS P ON FM.prospecto_id = P.prospecto_id
				   			INNER JOIN maquinaria_descripciones AS MD 
				   				  ON FM.maquinaria_descripcion_id = MD.maquinaria_descripcion_id 
				   			INNER JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id 
			       			INNER JOIN maquinaria_inventario AS MI ON FM.sucursal_id = MI.sucursal_id 
				   				  AND MMD.maquinaria_descripcion_id = MI.maquinaria_descripcion_id 
				   				  AND MMD.serie = MI.serie  
						    WHERE  MM.movimiento_maquinaria_id = $intReferenciaID
						    GROUP BY MMD.renglon";
		}
		else if($intTipoMovimiento == SALIDA_MAQUINARIA_DEVOLUCION_PROVEEDOR)
		{
			//Salidas de maquinaria por devolución al proveedor
			$queryDetalles ="SELECT MM.movimiento_maquinaria_id AS ID, MM.referencia_id, 
									P.codigo, P.razon_social, P.tipo_proveedor, 
				   					CM.factura, ML.maquinaria_linea_id AS modulo_id,
				   					ML.descripcion AS Modulo, MMD.renglon, 
				   					MMD.maquinaria_descripcion_id, 
				   				    MMD.descripcion_corta, MMD.serie, MMD.motor, 
				   				    CMD.precio_unitario,  CMD.iva_unitario, 
				   					MI.codigo_interno, MI.consignacion
							FROM   movimientos_maquinaria AS MM 
							INNER JOIN movimientos_maquinaria_detalles AS MMD 
				   				  ON MM.movimiento_maquinaria_id = MMD.movimiento_maquinaria_id 
				   			INNER JOIN movimientos_maquinaria AS MM2 ON MM.referencia_id = MM2.movimiento_maquinaria_id 
				  			INNER JOIN movimientos_maquinaria_detalles AS MMD2
				   				  ON MM2.movimiento_maquinaria_id = MMD2.movimiento_maquinaria_id
				   				  AND MMD.serie = MMD2.serie
				   			INNER JOIN ordenes_compra_maquinaria AS CM 
				   				  ON MM2.referencia_id = CM.orden_compra_maquinaria_id
				   			INNER JOIN ordenes_compra_maquinaria_detalles AS CMD 
				   				  ON CM.orden_compra_maquinaria_id = CMD.orden_compra_maquinaria_id
				   				  AND MMD2.maquinaria_descripcion_id = CMD.maquinaria_descripcion_id
				   			INNER JOIN proveedores AS P ON CM.proveedor_id = P.proveedor_id
				   			INNER JOIN maquinaria_descripciones AS MD 
				   				  ON MMD.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
				   			INNER JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id
				   			INNER JOIN maquinaria_inventario AS MI ON MM.sucursal_id = MI.sucursal_id
				   				  AND MMD.maquinaria_descripcion_id = MI.maquinaria_descripcion_id
				   				  AND MMD.serie = MI.serie 
						    WHERE  MM.movimiento_maquinaria_id = $intReferenciaID
							ORDER BY MMD.renglon";
		}
		else if($intTipoMovimiento == SALIDA_MAQUINARIA_INTERNA)
		{
			//Salidas de maquinaria interna
			$queryDetalles ="SELECT MM.movimiento_maquinaria_id AS ID, MM.observaciones, 
								    ML.maquinaria_linea_id AS modulo_id,
									ML.descripcion AS Modulo, MMD.renglon, 
									MMD.maquinaria_descripcion_id, MMD.descripcion_corta, MMD.serie,
				   					MMD.motor, MI.costo, MI.entrada_id, MI.codigo_interno, 
				   					MI.consignacion 
						    FROM   movimientos_maquinaria AS MM 
						    INNER JOIN movimientos_maquinaria_detalles AS MMD
				  				  ON MM.movimiento_maquinaria_id = MMD.movimiento_maquinaria_id
				   			INNER JOIN maquinaria_descripciones AS MD
				   				  ON MMD.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
				   			INNER JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id 
				   			INNER JOIN maquinaria_inventario AS MI ON MM.sucursal_id = MI.sucursal_id 
				   				  AND MMD.maquinaria_descripcion_id = MI.maquinaria_descripcion_id
				   				  AND MMD.serie = MI.serie 
						    WHERE  MM.movimiento_maquinaria_id = $intReferenciaID
							ORDER BY MMD.renglon";
		}
		else if ($intTipoMovimiento == TIPO_SERVICIO_FACTURACION)
		{
			//Facturas de maquinaria
			$queryDetalles ="SELECT FM.factura_maquinaria_id AS ID, P.codigo, FM.razon_social, 
									FM.condiciones_pago, ML.maquinaria_linea_id AS modulo_id,
									ML.descripcion AS Modulo, FM.precio, 
									FM.tasa_cuota_iva, ROUND(FM.iva, 2) AS IVA, 
				   				    1 AS renglon, FM.maquinaria_descripcion_id, MI.costo, 
				   				    MI.entrada_id, MI.codigo_interno, FM.serie, FM.motor, 
				   				    MI.descripcion_corta, MI.consignacion, MD.codigo AS CodDes, 
				   				    MD.servicio
							FROM   facturas_maquinaria AS FM 
							INNER JOIN prospectos AS P ON FM.prospecto_id = P.prospecto_id 
				   			INNER JOIN maquinaria_descripciones AS MD 
				   				  ON FM.maquinaria_descripcion_id = MD.maquinaria_descripcion_id 
				   				  AND MD.servicio = 'NO'
				   			INNER JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id
			       			INNER JOIN maquinaria_inventario AS MI ON FM.sucursal_id = MI.sucursal_id 
				   				  AND FM.maquinaria_descripcion_id = MI.maquinaria_descripcion_id 
				   				  AND FM.serie = MI.serie 
							WHERE  FM.factura_maquinaria_id = $intReferenciaID";
			$queryDetalles .= " UNION ";
			$queryDetalles .= "SELECT FM.factura_maquinaria_id AS ID, P.codigo, FM.razon_social, 
									 FM.condiciones_pago, ML.maquinaria_linea_id AS modulo_id,
									 ML.descripcion AS Modulo, 
									 FM.precio, FM.tasa_cuota_iva, ROUND(FM.iva, 2) AS IVA,
				  					 FMD.renglon, FMD.maquinaria_descripcion_id, MI.costo, 
				  					 MI.entrada_id, MI.codigo_interno, FMD.serie, FMD.motor, 
				  					 MI.descripcion_corta, MI.consignacion, 
				   					 MD.codigo AS CodDes, MD.servicio
							FROM   facturas_maquinaria AS FM 
							INNER JOIN facturas_maquinaria_detalles AS FMD
				   				  ON FM.factura_maquinaria_id = FMD.factura_maquinaria_id
				   			INNER JOIN prospectos AS P ON FM.prospecto_id = P.prospecto_id
				   			INNER JOIN maquinaria_descripciones AS MD 
				  				  ON FM.maquinaria_descripcion_id = MD.maquinaria_descripcion_id 
				  				  AND MD.servicio = 'NO'
				   			INNER JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id
			      		    INNER JOIN maquinaria_inventario AS MI ON FM.sucursal_id = MI.sucursal_id
				   				  AND FMD.maquinaria_descripcion_id = MI.maquinaria_descripcion_id 
				   				  AND FMD.serie = MI.serie  
							WHERE  FM.factura_maquinaria_id = $intReferenciaID";
			$queryDetalles .= " UNION ";
			$queryDetalles .= "SELECT FM.factura_maquinaria_id AS ID, P.codigo, FM.razon_social, 
									 FM.condiciones_pago, ML.maquinaria_linea_id AS modulo_id,
									 ML.descripcion AS Modulo, FM.precio, 
									 FM.tasa_cuota_iva, ROUND(FM.iva, 2) AS IVA, 
				   					 1 AS renglon, FM.maquinaria_descripcion_id, 0 AS costo, 
				   					 0 AS entrada_id, '' AS codigo_interno, 
				   					 '' AS serie, '' AS motor, '' AS descripcion_corta, 
				   					 'NO' AS consignacion, MD.codigo AS CodDes, MD.servicio
							  FROM   facturas_maquinaria AS FM 
							  INNER JOIN prospectos AS P ON FM.prospecto_id = P.prospecto_id
				   			  INNER JOIN maquinaria_descripciones AS MD
				   					ON FM.maquinaria_descripcion_id = MD.maquinaria_descripcion_id 
				   					AND MD.servicio = 'SI' 
				   			  INNER JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id
							  WHERE  FM.factura_maquinaria_id =  $intReferenciaID
							  ORDER BY renglon";
		}


		//Ejecutar consulta
		$strSQL = $this->db->query($queryDetalles);
		return $strSQL->result();
	}


	//Método para regresar la información de un movimiento fiscal que será cancelado
	public function buscar_movimiento_fiscal($intFacturaMaquinariaID)
	{
		$strSQL = $this->db->query("SELECT E.rfc AS RFC, 
										NOW() AS Fecha, 
										FM.uuid, 
										FM.folio 
									FROM facturas_maquinaria AS FM
									INNER JOIN sucursales AS S ON S.sucursal_id = FM.sucursal_id   
									INNER JOIN empresas E ON E.empresa_id = S.empresa_id
									WHERE FM.factura_maquinaria_id = $intFacturaMaquinariaID");
		return $strSQL->result();
	}



	

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL,
		                   $strEstatus = NULL, $strBusqueda =  NULL, $intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoRefCFDI = $this->db->escape('FACTURA MAQUINARIA');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('FM.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('FM.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(FM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(FM.estatus = 'TIMBRAR' OR FM.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('FM.estatus', $strEstatus);
			}
		}

	    $this->db->where("((FM.folio LIKE '%$strBusqueda%') OR
	    			       (CONCAT_WS(' - ', FM.rfc, FM.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', FM.rfc, FM.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', FM.razon_social, FM.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', FM.razon_social, FM.rfc) LIKE '%$strBusqueda%') OR 
		                   (PM.folio LIKE '%$strBusqueda%'))");	

		$this->db->from('facturas_maquinaria AS FM');
	    $this->db->join('pedidos_maquinaria AS PM', 'FM.pedido_maquinaria_id = PM.pedido_maquinaria_id', 'inner');
	    $this->db->join('sat_monedas AS M', 'FM.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('vendedores AS V', 'FM.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
	    $this->db->join('clientes AS C', 'FM.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS P', 'P.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'FM.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'FM.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'FM.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIva', 'FM.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	    $this->db->join('maquinaria_descripciones AS MD', 'FM.maquinaria_descripcion_id = MD.maquinaria_descripcion_id', 'inner');
	    $this->db->join('maquinaria_lineas AS ML', 'MD.maquinaria_linea_id = ML.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MM', 'MD.maquinaria_marca_id = MM.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'MD.maquinaria_modelo_id = MMOD.maquinaria_modelo_id', 'inner');
		$this->db->join('polizas AS PF', 'FM.factura_maquinaria_id = PF.referencia_id AND
	    							      PF.modulo = "MAQUINARIA" AND PF.proceso = "FACTURACION"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("FM.factura_maquinaria_id, FM.folio, DATE_FORMAT(FM.fecha,'%d/%m/%Y') AS fecha,
						   FM.rfc, FM.razon_social,
						   IFNULL(FM.regimen_fiscal_id,0) AS regimen_fiscal_id, 
						   FM.estatus, FM.uuid, PM.folio AS folio_pedido, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza,
						    IFNULL(CCFDI.cancelacion_id, 0) AS cancelacion_id", FALSE);
		 $this->db->from('facturas_maquinaria AS FM');
	    $this->db->join('pedidos_maquinaria AS PM', 'FM.pedido_maquinaria_id = PM.pedido_maquinaria_id', 'inner');
	    $this->db->join('sat_monedas AS M', 'FM.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('vendedores AS V', 'FM.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
	    $this->db->join('clientes AS C', 'FM.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS P', 'P.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'FM.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'FM.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'FM.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIva', 'FM.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	    $this->db->join('maquinaria_descripciones AS MD', 'FM.maquinaria_descripcion_id = MD.maquinaria_descripcion_id', 'inner');
	    $this->db->join('maquinaria_lineas AS ML', 'MD.maquinaria_linea_id = ML.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MM', 'MD.maquinaria_marca_id = MM.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'MD.maquinaria_modelo_id = MMOD.maquinaria_modelo_id', 'inner');
		$this->db->join('polizas AS PF', 'FM.factura_maquinaria_id = PF.referencia_id AND
	    							      PF.modulo = "MAQUINARIA" AND PF.proceso = "FACTURACION"', 'left');
		$this->db->join('cancelaciones AS CCFDI', 'CCFDI.tipo_referencia = '.$strTipoRefCFDI.' 
	    							        	  AND CCFDI.referencia_id = FM.factura_maquinaria_id', 'left');


	    $this->db->where('FM.sucursal_id', $this->session->userdata('sucursal_id'));
	    //Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('FM.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(FM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(FM.estatus = 'TIMBRAR' OR FM.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('FM.estatus', $strEstatus);
			}
		}

		$this->db->where("((FM.folio LIKE '%$strBusqueda%') OR
	    			       (CONCAT_WS(' - ', FM.rfc, FM.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', FM.rfc, FM.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', FM.razon_social, FM.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', FM.razon_social, FM.rfc) LIKE '%$strBusqueda%') OR 
		                   (PM.folio LIKE '%$strBusqueda%'))");	

		$this->db->order_by('FM.fecha DESC, FM.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["facturas"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strFormulario, $intReferenciaID)
	{
		$this->db->select("FM.factura_maquinaria_id, FM.folio, FM.uuid,
							CASE 
							  WHEN  FM.regimen_fiscal_id > 0 
							  THEN FM.regimen_fiscal_id		
							ELSE IFNULL(C.regimen_fiscal_id,0)
						    END regimen_fiscal_id", FALSE); 
        $this->db->from('facturas_maquinaria AS FM');
         $this->db->join('clientes AS C', 'FM.prospecto_id = C.prospecto_id', 'inner');
        $this->db->where('FM.sucursal_id', $this->session->userdata('sucursal_id'));
          //Si el formulario corresponde a una cancelación de timbrado
        if($strFormulario == 'cancelacion')
        {
        	$this->db->where('FM.factura_maquinaria_id <>', $intReferenciaID);
        }

        $this->db->where('FM.estatus', 'ACTIVO');
        $this->db->where("(FM.folio LIKE '%$strDescripcion%')"); 
		$this->db->order_by('FM.folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla facturas_maquinaria_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los componentes de la factura
	public function guardar_componentes(stdClass $objFacturaMaquinaria)
	{
		
		//Quitar | de la lista para obtener la descripciónID, número de serie y motor
		$arrMaquinariaDescripcionID = explode("|", $objFacturaMaquinaria->strMaquinariaDescripcionID);
		$arrSeries = explode("|", $objFacturaMaquinaria->strSeries);
		$arrMotores = explode("|", $objFacturaMaquinaria->strMotores);

		//Hacer recorrido para insertar los datos en la tabla facturas_maquinaria_detalles
		for ($intCon = 0; $intCon < sizeof($arrMaquinariaDescripcionID); $intCon++) 
		{
			//Asignar datos al array
			$arrDatos = array('factura_maquinaria_id' => $objFacturaMaquinaria->intFacturaMaquinariaID,
				 			  'renglon' => ($intCon + 1),
							  'maquinaria_descripcion_id' => $arrMaquinariaDescripcionID[$intCon],
							  'serie' => $arrSeries[$intCon],
							  'motor' => $arrMotores[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('facturas_maquinaria_detalles', $arrDatos);
		}
		
	}


	//Función que se utiliza para modificar los componentes de la factura
	public function modificar_componentes(stdClass $objFacturaMaquinaria)
	{
		
		//Quitar | de la lista para obtener la descripciónID, número de serie y motor
		$arrRenglonID = explode("|", $objFacturaMaquinaria->strRenglonID);
		$arrMaquinariaDescripcionID = explode("|", $objFacturaMaquinaria->strMaquinariaDescripcionID);
		$arrSeries = explode("|", $objFacturaMaquinaria->strSeries);
		$arrMotores = explode("|", $objFacturaMaquinaria->strMotores);

		//Hacer recorrido para insertar los datos en la tabla facturas_maquinaria_detalles
		for ($intCon = 0; $intCon < sizeof($arrMaquinariaDescripcionID); $intCon++) 
		{
			//Asignar datos al array
			$arrDatos = array('serie' => $arrSeries[$intCon],
							  'motor' => $arrMotores[$intCon]);
			$this->db->where('factura_maquinaria_id', $objFacturaMaquinaria->intFacturaMaquinariaID);
			$this->db->where('renglon', $arrRenglonID[$intCon]);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('facturas_maquinaria_detalles', $arrDatos);
		}
		
	}


	//Método para regresar los detalles de un registro
	public function buscar_detalles($intFacturaMaquinariaID){
		$this->db->select("	
							FM.factura_maquinaria_id, 
							FM.maquinaria_descripcion_id,
						   	FM.serie, 
						   	FM.motor, 
						   	FM.descripcion_corta,
						   	FM.descripcion, 
						   	FMD.renglon,
						   	FMD.maquinaria_descripcion_id AS componente_maquinaria_descripcion_id,
						   	FMD.serie AS componente_serie, 
						   	FMD.motor AS componente_motor,
						   	MD.codigo AS componente_codigo, 
						   	MD.descripcion_corta AS componente_descripcion_corta,
						   	MD.descripcion AS componente_descripcion", FALSE);
		$this->db->from('facturas_maquinaria FM');
	    $this->db->join('facturas_maquinaria_detalles FMD', 'FMD.factura_maquinaria_id = FM.factura_maquinaria_id', 'inner');
	    $this->db->join('maquinaria_descripciones MD', 'MD.maquinaria_descripcion_id = FMD.maquinaria_descripcion_id', 'inner');
	 	$this->db->where('FM.factura_maquinaria_id', $intFacturaMaquinariaID);
	 	$this->db->order_by('FMD.renglon', 'ASC');
		return $this->db->get()->result();
	}


	//Método para regresar los detalles de un registro
	public function buscar_detalles_xml($intFacturaMaquinariaID)
	{
		$strSQL = $this->db->query("
									SELECT
										FM.factura_maquinaria_id AS ID, 
										'1' AS renglon,  
										FM.codigo_sat AS ClaveProdServ,
										_utf8'' AS NoIdentificacion, 
										'1' AS cantidad,
										FM.unidad_sat AS ClaveUnidad, 
										SU.nombre AS Unidad,
										FM.objeto_impuesto_sat AS ClaveObjetoImpuesto,
										FM.descripcion AS Descripcion,
										FM.descripcion AS concepto,									
										(FM.precio) AS subtotal, 
										(FM.descuento) AS descuento, 
										(FM.iva) AS iva, 
										(FM.ieps) AS ieps,
										IFNULL(MI.numero_pedimento, '') AS Pedimento, 
										TIva.valor_maximo AS PorcentajeIva, 
										TIva.factor AS FactorIva,  
										IIva.codigo AS ImpuestoIva,  
										TIeps.valor_maximo AS PorcentajeIeps,
										TIeps.factor AS FactorIeps, 
										IIeps.codigo AS ImpuestoIeps,
										CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto
									FROM facturas_maquinaria  AS FM
									INNER JOIN maquinaria_descripciones AS MD ON MD.maquinaria_descripcion_id = FM.maquinaria_descripcion_id
									INNER JOIN sat_productos_servicios AS SPS ON SPS.producto_servicio_id = MD.producto_servicio_id
									LEFT JOIN maquinaria_inventario AS MI ON FM.sucursal_id = MI.sucursal_id 
										  AND  FM.maquinaria_descripcion_id = MI.maquinaria_descripcion_id
										  AND  FM.serie = MI.serie  
									LEFT JOIN sat_unidades AS SU ON SU.codigo = FM.unidad_sat
									LEFT JOIN  sat_tasa_cuota AS TIva ON TIva.tasa_cuota_id = FM.tasa_cuota_iva
									LEFT JOIN  sat_impuestos AS IIva ON IIva.impuesto_id = TIva.impuesto_id 
									LEFT JOIN  sat_tasa_cuota AS TIeps ON TIeps.tasa_cuota_id = FM.tasa_cuota_ieps		
									LEFT JOIN  sat_impuestos AS IIeps ON IIeps.impuesto_id = TIeps.impuesto_id
									LEFT JOIN sat_objeto_impuesto AS OImp ON FM.objeto_impuesto_sat = OImp.codigo
									WHERE FM.factura_maquinaria_id = $intFacturaMaquinariaID");

		return $strSQL->result();

	}

}	
?>