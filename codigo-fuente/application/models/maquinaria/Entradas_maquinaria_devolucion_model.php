<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de CFDI relacionados (para guardar los CFDI relacionados del registro)
include_once(APPPATH . 'models/caja/Cfdi_relacionados_model.php');
//Incluir la clase modelo de Maquinaria Inventario (para cambiar el estatus de una maquinara facturada)
include_once(APPPATH . 'models/maquinaria/Maquinaria_inventario_model.php');
//Incluir la clase modelo de Maquinaria Inventario (para cambiar el estatus de una maquinara facturada)
include_once(APPPATH . 'models/maquinaria/Facturas_maquinaria_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');
//Incluir la clase modelo de cancelaciones (para guardar la cancelación del timbrado (CFDI))
include_once(APPPATH . 'models/contabilidad/Cancelaciones_model.php');
//Incluir la clase modelo de clientes (para modificar el régimen fiscal del anticipo seleccionado)
include_once(APPPATH . 'models/cuentas_cobrar/Clientes_model.php');


class Entradas_maquinaria_devolucion_model extends CI_model {


	/*******************************************************************************************************************
	Funciones de la tabla movimientos_maquinaria -> ENTRADAS POR DEVOLUCION
	*********************************************************************************************************************/
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
		$this->db->where('movimiento_maquinaria_id',  $objTimbrado->intReferenciaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('movimientos_maquinaria', $arrDatos);
	}


	//Método para guardar un registro nuevo
	public function guardar(stdClass $objMovimiento, $objEntradaDevolucion)
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

         //Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();
        //Se crea una instancia de la clase modelo (Maquinaria_inventario) 
        $otdMaquinariaInventario = new  Maquinaria_inventario_model();
        //Se crea una instancia de la clase modelo (Factura_maquinaria) 
        $otdFacturaMaquinaria = new  Facturas_maquinaria_model();
        

		//Tabla movimientos_maquinaria
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		* (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		*/
		list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 

		//Concatenar hora, minutos y segundos
		$dteFecha = $objEntradaDevolucion->strFecha.' '.date("H:i:s");

		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $this->session->userdata('sucursal_id'),
						  'tipo_movimiento' => $objEntradaDevolucion->strTipoMovimiento,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha,  
						  'moneda_id' => $objEntradaDevolucion->intMonedaID, 
						  'tipo_cambio' => $objEntradaDevolucion->intTipoCambio, 
						  'referencia_id'=> mb_strtoupper($objEntradaDevolucion->intReferenciaID),
						  'prospecto_id' => mb_strtoupper($objEntradaDevolucion->intProspectoID), 
						  'forma_pago_id'=> $objEntradaDevolucion->intFormaPagoID,
						  'metodo_pago_id'=> $objEntradaDevolucion->intMetodoPagoID, 
						  'uso_cfdi_id'=> $objEntradaDevolucion->intUsoCfdiID, 
						  'tipo_relacion_id'=> $objEntradaDevolucion->intTipoRelacionID,
						  'exportacion_id'=> $objMovimiento->intExportacionID,
						  'observaciones' => mb_strtoupper($objEntradaDevolucion->strObservaciones),
						  'estatus' => 'TIMBRAR',
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('movimientos_maquinaria', $arrDatos);
		//Asignar id del nuevo registro en la base de datos
		$objMovimiento->intMovimientoMaquinariaID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la entrada por compra
		$this->guardar_maquinaria_detalles($objMovimiento->intMovimientoMaquinariaID, $objEntradaDevolucion->arrMaquinarias);

		//Hacer un llamado al método para guardar los CFDI relacionados del movimiento
		$otdModelCfdiRelacionados->guardar($objMovimiento->intMovimientoMaquinariaID, 'DEVOLUCION MAQUINARIA', 
										   $objMovimiento->strCfdiRelacionado, $objMovimiento->strTiposRelacion);
		
		//Modificamos el ESTATUS de la MAQUINARIA en el inventario
		//1. Obtenemos la MAQUINARIA_DESCRIPCION_ID Y SERIE de la maquinaria correspondiente a la FACTURA adjunta a la DEVOLUCIÓN
		$otdMaquinaria = $otdFacturaMaquinaria->buscar($objEntradaDevolucion->intReferenciaID);

		//2. Si se encuentra la información en la factura modificamos el estatus de la SERIE en almacen
		if($otdMaquinaria)
		{
			$otdMaquinariaInventario->set_estatus_devolucion($otdMaquinaria->maquinaria_descripcion_id, 
															 $otdMaquinaria->serie, $otdMaquinaria->sucursal_id);
		}

		//Si se cumple la sentencia modificar el régimen fiscal de la factura (significa que la factura seleccionada no tenia régimen fiscal y el usuario modificó el régimen fiscal del cliente)
		if($objMovimiento->strModRegimenFiscal == 'SI')
		{
			//Se crea una instancia de la clase modelo (Clientes) 
       		$otdModelClientes = new  Clientes_model();

       		//Hacer un llamado al método para modificar el id del régimen fiscal de una factura
       		$otdModelClientes->set_regimen_fiscal($objEntradaDevolucion->intReferenciaID, 
										  		  'MAQUINARIA', 
										  		  $objMovimiento->intRegimenFiscalID);

		}


		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoMaquinariaID.'_'.$strFolioConsecutivo;
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objMovimiento, $objEntradaDevolucion)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

		//Concatenar hora, minutos y segundos
		$dteFecha = $objEntradaDevolucion->strFecha.' '.date("H:i:s");

		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $this->session->userdata('sucursal_id'),
						  'tipo_movimiento' => $objEntradaDevolucion->strTipoMovimiento,
						  'fecha' => $dteFecha,  
						  'referencia_id'=> mb_strtoupper($objEntradaDevolucion->intReferenciaID),
						  'prospecto_id' => mb_strtoupper($objEntradaDevolucion->intProspectoID), 
						  'forma_pago_id' => $objEntradaDevolucion->intFormaPagoID,
						  'metodo_pago_id' => $objEntradaDevolucion->intMetodoPagoID,
						  'uso_cfdi_id' => $objEntradaDevolucion->intUsoCfdiID,
						  'tipo_relacion_id' => $objEntradaDevolucion->intTipoRelacionID,
						  'exportacion_id'=> $objMovimiento->intExportacionID,
						  'observaciones' => mb_strtoupper($objEntradaDevolucion->strObservaciones),
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('movimiento_maquinaria_id', $objMovimiento->intMovimientoMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_maquinaria', $arrDatos);

		
		//Eliminar los detalles del movimiento en la tabla: movimientos_maquinaria_detalles
		$this->db->where('movimiento_maquinaria_id', $objMovimiento->intMovimientoMaquinariaID);
		$this->db->delete('movimientos_maquinaria_detalles');
		
		//Hacer un llamado al método para guardar los detalles de la entrada por compra
		$this->guardar_maquinaria_detalles($objMovimiento->intMovimientoMaquinariaID, $objEntradaDevolucion->arrMaquinarias);

		//Hacer un llamado al método para guardar los CFDI relacionados del movimiento
		$otdModelCfdiRelacionados->guardar($objMovimiento->intMovimientoMaquinariaID, 'DEVOLUCION MAQUINARIA', 
										   $objMovimiento->strCfdiRelacionado, $objMovimiento->strTiposRelacion);


		//Si se cumple la sentencia modificar el régimen fiscal de la factura (significa que la factura seleccionada no tenia régimen fiscal y el usuario modificó el régimen fiscal del cliente)
		if($objMovimiento->strModRegimenFiscal == 'SI')
		{
			//Se crea una instancia de la clase modelo (Clientes) 
       		$otdModelClientes = new  Clientes_model();

       		//Hacer un llamado al método para modificar el id del régimen fiscal de una factura
       		$otdModelClientes->set_regimen_fiscal($objEntradaDevolucion->intReferenciaID, 
										  		  'MAQUINARIA', 
										  		  $objMovimiento->intRegimenFiscalID);

		}
		
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	 //Método para modificar el estatus de un registro a INACTIVO 
	public function set_cancelar(stdClass $objCancelacionCfdi)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();

		//Buscamos la referencia adjunta al movimiento (FACTURA_ID)
		$otdReferenciaID = $this->buscar_entrada_devolucion_factura($objCancelacionCfdi->intReferenciaCfdiID);
		//Se crea una instancia de la clase modelo (Maquinaria_inventario) 
        $otdMaquinariaInventario = new  Maquinaria_inventario_model();
		//Se crea una instancia de la clase modelo (Factura_maquinaria) 
        $otdFacturaMaquinaria = new  Facturas_maquinaria_model();
          //Se crea una instancia de la clase modelo (cancelaciones) 
        $otdModelCancelaciones = new Cancelaciones_model();

        $otdMaquinaria = $otdFacturaMaquinaria->buscar($otdReferenciaID->referencia_id);
        $otdSalidaID = $this->facturas_maquinaria_salidas_venta($otdReferenciaID->referencia_id);
		
		//Modificar la información de la MAQUINARIA en inventario con base a la información de FACTURAS MAQUINARIA y SALIDAS POR VENTA
        //Si la factura adjunta tiene una salida
        if($otdSalidaID)
        {
			$otdMaquinariaInventario->set_cancelar_estatus_devolucion($otdMaquinaria->maquinaria_descripcion_id, $otdMaquinaria->serie, $otdMaquinaria->sucursal_id, 'INACTIVO', $otdSalidaID->movimiento_maquinaria_id);
		}
		else
		{ //Si la factura no cuenta con una salida
			$otdMaquinariaInventario->set_cancelar_estatus_devolucion($otdMaquinaria->maquinaria_descripcion_id, $otdMaquinaria->serie, $otdMaquinaria->sucursal_id, 'FACTURADO', NULL);
		}

		
		//Modificar el estatus a INACTIVO del registro de ENTRADA DE MAQUINARIA POR DEVOLUCION en los movimientos de maquinaria
		$arrDatos = array(	
							'estatus' => 'INACTIVO',
							'fecha_eliminacion' => date("Y-m-d H:i:s"),
							'usuario_eliminacion' =>  $this->session->userdata('usuario_id')
						);
		$this->db->where('movimiento_maquinaria_id', $objCancelacionCfdi->intReferenciaCfdiID);
		$this->db->limit(1);
		$this->db->update('movimientos_maquinaria', $arrDatos);


	    //Si existe el id de la póliza
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

	//Método para buscar si una factura de maquinaria ha presentado una salida por venta
	public function facturas_maquinaria_salidas_venta($intFacturaMaquinariaID){
		
		$this->db->select("	movimiento_maquinaria_id ", FALSE);
		$this->db->where("tipo_movimiento", SALIDA_MAQUINARIA_VENTA);
		$this->db->where("referencia_id", $intFacturaMaquinariaID );
		$this->db->from('movimientos_maquinaria');
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intMovimientoMaquinariaID, $strEstatus)
	{
		//Si el estatus del registro es ACTIVO
		if($strEstatus == 'ACTIVO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'),
							  'fecha_eliminacion' => NULL,
							  'usuario_eliminacion' => NULL);
		}
		else 
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_eliminacion' => date("Y-m-d H:i:s"),
							  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		}
		$this->db->where('movimiento_maquinaria_id', $intMovimientoMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('movimientos_maquinaria', $arrDatos);
	}

	//Función que se utiliza para guardar los detalles guardar_maquinaria_detalles
	public function guardar_maquinaria_detalles($intMovimientoMaquinariaID, $arrMaquinarias)
	{
		//Validar que al menos exista una maquinaria en el arreglo
		if(sizeof($arrMaquinarias) > 0){
			//Hacer recorrido para insertar los datos en la tabla movimientos_maquinaria_detalles
			for ($intCon = 0; $intCon < sizeof($arrMaquinarias); $intCon++) 
			{	
				//Asignar datos al array
				$arrDatos = array('movimiento_maquinaria_id' => $intMovimientoMaquinariaID,
					   			  'renglon' => mb_strtoupper($arrMaquinarias[$intCon]->intRenglon), 
					   			  'maquinaria_descripcion_id' => mb_strtoupper($arrMaquinarias[$intCon]->strMaquinariaDescripcionID),
					   			  'codigo' => mb_strtoupper($arrMaquinarias[$intCon]->strCodigo),
								  'descripcion_corta' => mb_strtoupper($arrMaquinarias[$intCon]->strDescripcionCorta),
								  'serie' => mb_strtoupper($arrMaquinarias[$intCon]->strSerie),
								  'motor' => mb_strtoupper($arrMaquinarias[$intCon]->strMotor)
								);
				//Guardar los datos del registro
				$this->db->insert('movimientos_maquinaria_detalles', $arrDatos);
			}
		}
	}

	//Función que se utiliza para guardar los detalles maquinaria_inventario
	public function guardar_maquinaria_inventario($intMovimientoMaquinariaID, $intSucursalID, $arrMaquinarias)
	{
		//Validar que al menos exista una maquinaria en el arreglo
		if(sizeof($arrMaquinarias) > 0){
			//Hacer recorrido para insertar los datos en la tabla movimientos_maquinaria_detalles
			for ($intCon = 0; $intCon < sizeof($arrMaquinarias); $intCon++) 
			{	
				//Asignar datos al array
				$arrDatos = array('sucursal_id' => $intSucursalID,
					   			  'maquinaria_descripcion_id' => mb_strtoupper($arrMaquinarias[$intCon]->strMaquinariaDescripcionID),
								  'serie' => mb_strtoupper($arrMaquinarias[$intCon]->strSerie),
								  'motor' => mb_strtoupper($arrMaquinarias[$intCon]->strMotor),
								  'codigo' => mb_strtoupper($arrMaquinarias[$intCon]->strCodigo),
								  'descripcion_corta' => mb_strtoupper($arrMaquinarias[$intCon]->strDescripcionCorta),
								  'descripcion' => mb_strtoupper($arrMaquinarias[$intCon]->strDescripcion),
								  'numero_pedimento' => mb_strtoupper($arrMaquinarias[$intCon]->numPedimento),
								  'consignacion' => mb_strtoupper($arrMaquinarias[$intCon]->strConsignacion),
								  'entrada_id' => $intMovimientoMaquinariaID,
								  'fecha_creacion' => date("Y-m-d H:i:s"),
						  		  'usuario_creacion' => $this->session->userdata('usuario_id')
								);
				//Guardar los datos del registro
				$this->db->insert('maquinaria_inventario', $arrDatos);
			}
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL,  $intProspectoID = NULL, 
						   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{	

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR DEVOLUCION DE CLIENTE');
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoRefCFDI = $this->db->escape('DEVOLUCION MAQUINARIA');


	    //Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	    	$this->db->where("MM.prospecto_id", $intProspectoID);
	    } 

	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MM.estatus = 'TIMBRAR' OR MM.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MM.estatus', $strEstatus);
			}
		}

	    $this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
	    					(FM.folio LIKE '%$strBusqueda%') OR
		   					(C.razon_social  LIKE '%$strBusqueda%'))"); 

	    $this->db->where("MM.tipo_movimiento", ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA);
	    $this->db->where("MM.sucursal_id", $this->session->userdata('sucursal_id'));
		$this->db->from('movimientos_maquinaria MM');
		$this->db->join('facturas_maquinaria FM', 'FM.factura_maquinaria_id = MM.referencia_id', 'innner');
		$this->db->join('sucursales S', 'S.sucursal_id = FM.sucursal_id', 'innner');
		$this->db->join('clientes AS C', 'MM.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('polizas AS PF', 'MM.movimiento_maquinaria_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "MAQUINARIA"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("	MM.movimiento_maquinaria_id, 
							MM.folio, 
					        DATE_FORMAT(MM.fecha, '%d/%m/%Y') AS fecha,
					        FM.folio AS folio_factura,
					        S.nombre AS sucursal, 
					        C.razon_social AS cliente, 
					        MM.estatus, 
					        MM.certificado, 
							MM.sello, 
							MM.uuid, 
							MM.fecha_timbrado, 
							MM.certificado_sat, 
							MM.sello_sat, 
							MM.leyenda_sat, 
							MM.rfc_pac,
							IFNULL(FM.regimen_fiscal_id,0) AS regimen_fiscal_id,
							IFNULL(PF.poliza_id, 0) AS poliza_id, 
						    PF.folio AS folio_poliza, 
						    IFNULL(CCFDI.cancelacion_id, 0) AS cancelacion_id", FALSE);
		$this->db->from('movimientos_maquinaria MM');
		$this->db->join('facturas_maquinaria FM', 'FM.factura_maquinaria_id = MM.referencia_id', 'innner');
		$this->db->join('sucursales S', 'S.sucursal_id = FM.sucursal_id', 'innner');
		$this->db->join('clientes AS C', 'MM.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('polizas AS PF', 'MM.movimiento_maquinaria_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "MAQUINARIA"', 'left');
		$this->db->join('cancelaciones AS CCFDI', 'CCFDI.tipo_referencia = '.$strTipoRefCFDI.' 
	    							        	  AND CCFDI.referencia_id = MM.movimiento_maquinaria_id', 'left');


	    $this->db->where("MM.tipo_movimiento", ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA);
		$this->db->where("MM.sucursal_id", $this->session->userdata('sucursal_id'));


		 //Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	    	$this->db->where("MM.prospecto_id", $intProspectoID);
	    } 

	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  

	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MM.estatus = 'TIMBRAR' OR MM.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MM.estatus', $strEstatus);
			}
		}



	    $this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
	    					(FM.folio LIKE '%$strBusqueda%') OR
		   					(C.razon_social  LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('MM.fecha DESC, MM.folio DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		
		return $arrResultado;
	
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMovimientoMaquinariaID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL,  
						  $intProspectoID = NULL,  $strEstatus = NULL, $strBusqueda = NULL)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR DEVOLUCION DE CLIENTE');


		$this->db->select("	MM.movimiento_maquinaria_id, 
							MM.folio, 
					        DATE_FORMAT(MM.fecha, '%d/%m/%Y') AS fecha,
					        FM.factura_maquinaria_id AS referencia_id,
					        FM.folio AS referencia,
					        FM.razon_social,
						    FM.rfc,
						    CASE 
							  WHEN  FM.regimen_fiscal_id > 0 
							  THEN FM.regimen_fiscal_id		
							ELSE IFNULL(C.regimen_fiscal_id,0)
						    END regimen_fiscal_id,
						    IFNULL(FM.regimen_fiscal_id,0) AS regimenFiscalAnterior,
						    FM.moneda_id,
						    FM.tipo_cambio,
						    CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
							CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, 
							FP.codigo AS FormaPago,
							CONCAT_WS(' - ', MP.codigo, MP.descripcion) AS metodo_pago, 
							MP.codigo AS MetodoPago,
							CONCAT_WS(' - ', U.codigo, U.descripcion) AS uso_cfdi,  
							U.codigo AS UsoCFDI,
							CONCAT_WS(' - ', TR.codigo, TR.descripcion) AS tipo_relacion,
					        S.nombre AS sucursal,
					        MM.prospecto_id, 
					        C.razon_social AS cliente,
					        MM.forma_pago_id,
					        MM.metodo_pago_id,
					        MM.uso_cfdi_id,
					        MM.tipo_relacion_id,
					        MM.exportacion_id,
					        MM.observaciones,
					        MM.estatus,
					        MM.fecha_creacion,
					        MM.usuario_creacion,
						   	UC.usuario AS usuario_creacion,
						   	IFNULL(PF.poliza_id, 0) AS poliza_id, 
						    PF.folio AS folio_poliza ", FALSE);
	    $this->db->from('movimientos_maquinaria MM'); 
	    $this->db->join('facturas_maquinaria FM', 'FM.factura_maquinaria_id = MM.referencia_id', 'inner');
	    $this->db->join('sat_forma_pago FP', 'FP.forma_pago_id = MM.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago MP', 'MP.metodo_pago_id = MM.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi U', 'U.uso_cfdi_id = MM.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion TR', 'TR.tipo_relacion_id = MM.tipo_relacion_id', 'inner');
	    $this->db->join('sat_monedas M', 'M.moneda_id = FM.moneda_id', 'inner');
		$this->db->join('sucursales S', 'S.sucursal_id = FM.sucursal_id', 'inner');
		$this->db->join('clientes C', 'MM.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('usuarios AS UC', 'UC.usuario_id = MM.usuario_creacion', 'left');
		$this->db->join('polizas AS PF', 'MM.movimiento_maquinaria_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "MAQUINARIA"', 'left');

		$this->db->where('MM.tipo_movimiento', ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA);

		//Si existe id del movimiento de maquinaria
		if ($intMovimientoMaquinariaID != NULL)
		{   
			$this->db->where('MM.movimiento_maquinaria_id', $intMovimientoMaquinariaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{

			$this->db->where("MM.sucursal_id", $this->session->userdata('sucursal_id'));
			
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		    	$this->db->where("MM.prospecto_id", $intProspectoID);
		    } 

		    //Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }  

		    
		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(MM.estatus = 'TIMBRAR' OR MM.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('MM.estatus', $strEstatus);
				}
			}



		    $this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
		    					(FM.folio LIKE '%$strBusqueda%') OR
			   					(C.razon_social  LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('MM.fecha DESC', 'MM.folio DESC' );
			return $this->db->get()->result();
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intMovimientoMaquinariaID)
	{
		$this->db->select('	MMD.movimiento_maquinaria_id, 
							MMD.renglon, 
							MMD.maquinaria_descripcion_id,
							MMD.codigo, 
							MMD.descripcion_corta, 
							MMD.descripcion, 
						    MMD.serie, 
						    MMD.motor,
						    MI.numero_pedimento,
						    MI.consignacion,
						    ML.descripcion AS maquinaria_linea,
						    MM.descripcion AS maquinaria_marca,
						    MMOD.descripcion AS maquinaria_modelo');
		$this->db->from('movimientos_maquinaria_detalles AS MMD');
		$this->db->join('maquinaria_descripciones MD', 'MD.maquinaria_descripcion_id = MMD.maquinaria_descripcion_id', 'inner');	
		$this->db->join('maquinaria_lineas AS ML', 'ML.maquinaria_linea_id = MD.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MM', 'MM.maquinaria_marca_id = MD.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'MMOD.maquinaria_modelo_id = MD.maquinaria_modelo_id', 'inner');
		$this->db->join('maquinaria_inventario AS MI', 'MI.serie = MMD.serie AND MMD.maquinaria_descripcion_id = MI.maquinaria_descripcion_id','left');
		$this->db->where('MMD.movimiento_maquinaria_id', $intMovimientoMaquinariaID);
		$this->db->order_by('MMD.renglon', 'ASC');
		return $this->db->get()->result();
	}


	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strFormulario, $intReferenciaID)
	{
		$this->db->select('movimiento_maquinaria_id, folio, uuid');
        $this->db->from('movimientos_maquinaria');
        $this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
        $this->db->where('tipo_movimiento', ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA);

        //Si el tipo corresponde a una cancelación de timbrado
        if($strFormulario == 'cancelacion')
        {
        	
        	$this->db->where('movimiento_maquinaria_id <>', $intReferenciaID);

        }

	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(folio LIKE '%$strDescripcion%')");  
        $this->db->order_by("folio",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function serie_autocomplete($strDescripcion)
	{
    	$this->db->select('	maquinaria_descripcion_id,
						serie,
    					motor,
    					codigo,
    					descripcion_corta,
    					descripcion ');
        $this->db->from('maquinaria_inventario');
	    $this->db->where('sucursal_id', $this->session->userdata('sucursal_id') );
        $this->db->where('salida_id IS NULL'); 
        $this->db->where("(serie LIKE '%$strDescripcion%')");  
		$this->db->order_by('serie', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);

	  	return $this->db->get()->result();

	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function motor_autocomplete($strDescripcion)
	{
    	$this->db->select('	maquinaria_descripcion_id,
						serie,
    					motor,
    					codigo,
    					descripcion_corta,
    					descripcion ');
        $this->db->from('maquinaria_inventario');
	    $this->db->where('sucursal_id', $this->session->userdata('sucursal_id') );
        $this->db->where('salida_id IS NULL'); 
        $this->db->where("(motor LIKE '%$strDescripcion%')");  
		$this->db->order_by('motor', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);

	  	return $this->db->get()->result();

	}

	//Método para regresar los aditamentos correspondientes a una serie
	public function get_aditamentos($strSerie)
	{
    	$this->db->select('serie, renglon, cantidad, descripcion');
        $this->db->from('maquinaria_inventario_aditamentos');
	    $this->db->where('serie', $strSerie); 
		$this->db->order_by('renglon', 'ASC');

	  	return $this->db->get()->result();

	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_entrada_devolucion_factura($intMovimientoMaquinariaID = NULL)
	{
		
		$strSQL = $this->db->query(" SELECT MM.movimiento_maquinaria_id, 
											MM.folio AS folio, 
											MM.fecha, 
											DATE_FORMAT(MM.fecha,'%d/%m/%Y') AS fecha_format, 
											MM.moneda_id,  
											MM.tipo_cambio,
											MM.referencia_id, 
											MM.forma_pago_id, 
											MM.metodo_pago_id, 
											MM.uso_cfdi_id,  
											MM.tipo_relacion_id, 
											MM.observaciones, 
											MM.estatus,
											MM.certificado, 
											MM.sello, 
											MM.uuid, 
											MM.fecha_timbrado, 
											MM.certificado_sat, 
											MM.sello_sat, 
											MM.leyenda_sat, 
											MM.rfc_pac,
											M.codigo AS MonedaTipo, 
											CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
											CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, FP.codigo AS FormaPago,
											CONCAT_WS(' - ', MP.codigo, MP.descripcion) AS metodo_pago, MP.codigo AS MetodoPago,
											CONCAT_WS(' - ', U.codigo, U.descripcion) AS uso_cfdi, U.codigo AS UsoCFDI,
											CONCAT_WS(' - ', TR.codigo, TR.descripcion) AS tipo_relacion, TR.codigo AS TipoRelacion,
											_utf8'' AS CondicionesDePago, 
											_utf8'E' AS TipoDeComprobante, 
											CONCAT_WS(' - ', TC.codigo, TC.descripcion) AS tipo_comprobante,
											RF.codigo AS RegimenFiscal,
										   CONCAT_WS(' - ', RF.codigo, RF.descripcion) AS regimen_fiscal,
										   ECF.codigo AS CodigoExportacion,
										   CONCAT_WS(' - ', ECF.codigo, ECF.descripcion) AS exportacion,
											FM.folio AS folio_factura, 
									        C.rfc,  
											C.nombre_comercial AS cliente, C.correo_electronico, 
											C.contacto_correo_electronico,
									        FM.razon_social, C.telefono_principal AS telefono_principal, 
											C.calle, C.numero_exterior, C.numero_interior, CCP.codigo_postal,
											C.colonia, C.localidad, MC.descripcion AS municipio,  
											EC.descripcion estado,
											UC.usuario AS usuario_creacion, PRO.codigo AS CodigoProspecto
									FROM  movimientos_maquinaria AS MM
									INNER JOIN facturas_maquinaria FM ON FM.factura_maquinaria_id = MM.referencia_id
									INNER JOIN sat_monedas AS M ON MM.moneda_id = M.moneda_id
									INNER JOIN sat_forma_pago AS FP ON MM.forma_pago_id = FP.forma_pago_id
									INNER JOIN sat_metodos_pago AS MP ON MM.metodo_pago_id = MP.metodo_pago_id
									INNER JOIN sat_uso_cfdi AS U ON MM.uso_cfdi_id = U.uso_cfdi_id
									INNER JOIN sat_tipos_relacion AS TR ON MM.tipo_relacion_id = TR.tipo_relacion_id
									INNER JOIN usuarios AS UC ON MM.usuario_creacion = UC.usuario_id
									LEFT JOIN sat_tipos_comprobante AS TC ON TC.codigo = 'E'
									INNER JOIN clientes AS C ON FM.prospecto_id = C.prospecto_id
									INNER JOIN prospectos AS PRO ON PRO.prospecto_id = C.prospecto_id
									INNER JOIN municipios AS MC ON C.municipio_id = MC.municipio_id
									INNER JOIN sat_estados AS EC ON MC.estado_id = EC.estado_id
									LEFT JOIN sat_codigos_postales AS CCP ON C.codigo_postal_id = CCP.codigo_postal_id
									LEFT JOIN sat_regimen_fiscal AS RF ON RF.regimen_fiscal_id = FM.regimen_fiscal_id
									LEFT JOIN sat_exportacion AS ECF ON MM.exportacion_id = ECF.exportacion_id
									WHERE MM.movimiento_maquinaria_id = $intMovimientoMaquinariaID ");
		return $strSQL->row();

	}

	//Método para regresar los detalles de un registro para mostrarlos en el archivo XML
	public function buscar_detalles_xml_devolucion_factura($intMovimientoMaquinariaID)
	{

		$strSQL = $this->db->query("SELECT 	MM.movimiento_maquinaria_id AS ID, 
											'1' AS renglon, 
									        _utf8'84111506' AS ClaveProdServ,
									        _utf8'' AS NoIdentificacion, 
									        '1' AS cantidad, 
									        _utf8'ACT' AS ClaveUnidad, 
									        _utf8'Actividad' AS Unidad,
									        FM.objeto_impuesto_sat AS ClaveObjetoImpuesto,  
									        CONCAT('DEVOLUCION DE FACTURA ', FM.folio) AS Descripcion,
											CONCAT('DEVOLUCION DE FACTURA ', FM.folio) AS concepto,
									        FM.precio AS subtotal, 
									        '0' AS descuento, 
									        FM.iva AS iva,
											FM.ieps AS ieps, 
									        _utf8'' AS Pedimento,
									        TIva.valor_maximo AS PorcentajeIva, 
									        TIva.factor AS FactorIva,  
											IIva.codigo AS ImpuestoIva,  
									        TIeps.valor_maximo AS PorcentajeIeps,
											TIeps.factor AS FactorIeps, 
									        IIeps.codigo AS ImpuestoIeps, 
									        CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto
									FROM movimientos_maquinaria MM
									INNER JOIN facturas_maquinaria FM ON FM.factura_maquinaria_id = MM.referencia_id
									INNER JOIN  sat_tasa_cuota AS TIva ON FM.tasa_cuota_iva = TIva.tasa_cuota_id
									INNER JOIN  sat_impuestos AS IIva ON TIva.impuesto_id = IIva.impuesto_id
									LEFT JOIN   sat_tasa_cuota AS TIeps ON FM.tasa_cuota_ieps = TIeps.tasa_cuota_id
									LEFT JOIN   sat_impuestos AS IIeps ON TIeps.impuesto_id = IIeps.impuesto_id
									LEFT JOIN sat_objeto_impuesto AS OImp ON FM.objeto_impuesto_sat = OImp.codigo
									WHERE movimiento_maquinaria_id = $intMovimientoMaquinariaID");

		return $strSQL->result();
	}

	//Método para regresar la información de un movimiento fiscal que será cancelado
	public function buscar_movimiento_fiscal($intMovimientoMaquinariaID)
	{
		$strSQL = $this->db->query("SELECT 
										E.rfc AS RFC,
										NOW() AS Fecha,
									    MM.uuid,
									    MM.folio
									FROM movimientos_maquinaria MM
									INNER JOIN sucursales AS S ON S.sucursal_id = MM.sucursal_id   
									INNER JOIN empresas E ON E.empresa_id = S.empresa_id
									WHERE MM.movimiento_maquinaria_id = $intMovimientoMaquinariaID");
		return $strSQL->result();
	}


}
?>