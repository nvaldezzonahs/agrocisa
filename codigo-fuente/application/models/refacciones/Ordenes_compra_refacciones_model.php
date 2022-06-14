<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de mensajes (para guardar el mensaje que se envía a los usuarios)
include_once(APPPATH . 'models/administracion/Mensajes_model.php');

class Ordenes_compra_refacciones_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla ordenes_compra_refacciones
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objOrdenCompra)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objOrdenCompra->strFolio); 

		//Tabla ordenes_compra_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objOrdenCompra->intSucursalID, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objOrdenCompra->dteFecha, 
						  'fecha_entrega' => $objOrdenCompra->dteFechaEntrega,
						  'fecha_vencimiento' => $objOrdenCompra->dteFechaVencimiento,
						  'condiciones_pago' => $objOrdenCompra->strCondicionesPago,
						  'moneda_id' => $objOrdenCompra->intMonedaID, 
						  'tipo_cambio' => $objOrdenCompra->intTipoCambio, 
						  'factura' => $objOrdenCompra->strFactura, 
						  'proveedor_id' => $objOrdenCompra->intProveedorID, 
						  'regimen_fiscal_id' => $objOrdenCompra->intRegimenFiscalID,
						  'porcentaje_retencion_id' => $objOrdenCompra->intPorcentajeRetencionID,
						  'importe_retenido' => $objOrdenCompra->intImporteRetenido,
						  'observaciones' => $objOrdenCompra->strObservaciones, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objOrdenCompra->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('ordenes_compra_refacciones', $arrDatos);
		//Agregar id del nuevo registro al objeto
		$objOrdenCompra->intOrdenCompraRefaccionesID = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la orden de compra
		$this->guardar_detalles($objOrdenCompra);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objOrdenCompra->intOrdenCompraRefaccionesID.'_'.$strFolioConsecutivo;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objOrdenCompra)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla ordenes_compra_refacciones
		//Asignar datos al array
		$arrDatos = array('fecha' => $objOrdenCompra->dteFecha, 
						  'fecha_entrega' => $objOrdenCompra->dteFechaEntrega,
						  'fecha_vencimiento' => $objOrdenCompra->dteFechaVencimiento,
						  'condiciones_pago' => $objOrdenCompra->strCondicionesPago,
						  'moneda_id' => $objOrdenCompra->intMonedaID, 
						  'tipo_cambio' => $objOrdenCompra->intTipoCambio, 
						  'factura' => $objOrdenCompra->strFactura, 
						  'proveedor_id' => $objOrdenCompra->intProveedorID, 
						  'regimen_fiscal_id' => $objOrdenCompra->intRegimenFiscalID,
						  'porcentaje_retencion_id' => $objOrdenCompra->intPorcentajeRetencionID,
						  'importe_retenido' => $objOrdenCompra->intImporteRetenido,
						  'observaciones' => $objOrdenCompra->strObservaciones, 
						  'estatus' => 'ACTIVO', 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objOrdenCompra->intUsuarioID);
		$this->db->where('orden_compra_refacciones_id', $objOrdenCompra->intOrdenCompraRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('ordenes_compra_refacciones', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('orden_compra_refacciones_id', $objOrdenCompra->intOrdenCompraRefaccionesID);
		$this->db->delete('ordenes_compra_refacciones_detalles');
		//Hacer un llamado al método para guardar los detalles de la orden de compra
		$this->guardar_detalles($objOrdenCompra);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intOrdenCompraRefaccionesID, $strEstatus)
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
		$this->db->where('orden_compra_refacciones_id', $intOrdenCompraRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('ordenes_compra_refacciones', $arrDatos);
	}

	//Método para enviar la autorización (o rechazo) de un registro
	public function set_enviar_autorizacion($intOrdenCompraRefaccionesID, $strUsuarios, $strMensaje, $strEstatus)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (Mensajes) 
        $otdModelMensajes = new  Mensajes_model();

		//Si existe estatus
		if($strEstatus !== NULL)
		{
			//Tabla ordenes_compra_refacciones
			//Si el estatus del registro es AUTORIZADO
			if($strEstatus == 'AUTORIZADO')
			{
				//Asignar datos al array
				$arrDatos = array('estatus' => $strEstatus,
								  'fecha_autorizacion' => date("Y-m-d H:i:s"),
								  'usuario_autorizacion' => $this->session->userdata('usuario_id'));
			}
			else
			{
				//Asignar datos al array
				$arrDatos = array('estatus' => $strEstatus,
								  'fecha_actualizacion' => date("Y-m-d H:i:s"),
								  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
			}
			$this->db->where('orden_compra_refacciones_id', $intOrdenCompraRefaccionesID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('ordenes_compra_refacciones', $arrDatos);
		}
		
        //Hacer un llamado al método para guardar el mensaje que se envía a los usuarios
		$otdModelMensajes->guardar('ORDENES DE COMPRA REFACCIONES', $intOrdenCompraRefaccionesID, 
								    $strUsuarios, $strMensaje);
        
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intOrdenCompraRefaccionesID = NULL,  $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		$this->db->select("OCR.orden_compra_refacciones_id, OCR.folio, DATE_FORMAT(OCR.fecha,'%d/%m/%Y') AS fecha, 
						   DATE_FORMAT(OCR.fecha_entrega,'%d/%m/%Y') AS fecha_entrega,
						   DATE_FORMAT(OCR.fecha_vencimiento,'%d/%m/%Y') AS fecha_vencimiento, 
						   OCR.condiciones_pago, OCR.moneda_id, OCR.tipo_cambio, OCR.factura, 
						   OCR.proveedor_id, IFNULL(OCR.regimen_fiscal_id, '') AS regimen_fiscal_id, OCR.porcentaje_retencion_id, 
						   OCR.importe_retenido, OCR.observaciones, OCR.estatus, 
						   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, 
						   P.regimen_fiscal_id AS regimenFiscalIDProv, 
						   P.dias_credito, P.correo_electronico, P.contacto_correo_electronico, 
						   P.rfc, P.telefono_principal, P.calle, P.numero_exterior, P.numero_interior, 
						   P.colonia, P.localidad, MP.descripcion AS municipio, EP.descripcion AS estado,
						   CP.codigo_postal, M.codigo AS codigo_moneda,
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, 
						   PIsr.porcentaje AS porcentaje_isr, 
						   UC.usuario AS usuario_creacion, UA.usuario AS usuario_autorizacion,
						   DATE_FORMAT(OCR.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
	    $this->db->from('ordenes_compra_refacciones AS OCR');
	    $this->db->join('sat_monedas AS M', 'OCR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'OCR.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');		
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('usuarios AS UC', 'OCR.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('usuarios AS UA', 'OCR.usuario_autorizacion = UA.usuario_id', 'left');
		$this->db->join('porcentaje_retencion_isr AS PIsr', 'OCR.porcentaje_retencion_id = PIsr.porcentaje_retencion_id', 'left');

		//Si existe id de la orden de compra
		if ($intOrdenCompraRefaccionesID != NULL)
		{   
			$this->db->where('OCR.orden_compra_refacciones_id', $intOrdenCompraRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('OCR.sucursal_id',  $this->session->userdata('sucursal_id'));
			//Si existe id del proveedor
		    if($intProveedorID > 0)
		    {
		   		$this->db->where('OCR.proveedor_id', $intProveedorID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(OCR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('OCR.estatus', $strEstatus);
			}

		    $this->db->where("((OCR.folio LIKE '%$strBusqueda%') OR
        				      (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			                  (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('OCR.fecha DESC, OCR.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   					 $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;
        
		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('ordenes_compra_refacciones AS OCR');
		$this->db->join('sat_monedas AS M', 'OCR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'OCR.proveedor_id = P.proveedor_id', 'inner');
		$this->db->where('OCR.sucursal_id',  $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del proveedor
	    if($intProveedorID > 0)
	    {
	   		$this->db->where('OCR.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OCR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OCR.estatus', $strEstatus);
		}

		$this->db->where("((OCR.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))");
		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProveedorID = NULL, 
						   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('OCR.sucursal_id',  $this->session->userdata('sucursal_id'));
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('OCR.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OCR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OCR.estatus', $strEstatus);
		}

		$this->db->where("((OCR.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
		
		$this->db->from('ordenes_compra_refacciones AS OCR');
	    $this->db->join('sat_monedas AS M', 'OCR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'OCR.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("OCR.orden_compra_refacciones_id, OCR.folio, DATE_FORMAT(OCR.fecha,'%d/%m/%Y') AS fecha, 
						   OCR.estatus, CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor", FALSE);
		$this->db->from('ordenes_compra_refacciones AS OCR');
	    $this->db->join('sat_monedas AS M', 'OCR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'OCR.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->where('OCR.sucursal_id',  $this->session->userdata('sucursal_id'));
	    //Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('OCR.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OCR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OCR.estatus', $strEstatus);
		}

		$this->db->where("((OCR.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))");

		$this->db->order_by('OCR.fecha DESC, OCR.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["ordenes"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros autorizados que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strFormulario = NULL)
	{
		//Constante para identificar al tipo de movimiento entrada por compra de refacciones
		$intMovEntradaRefCompra = ENTRADA_REFACCIONES_COMPRA;

		$this->db->select("	OCR.orden_compra_refacciones_id, 
			                CONCAT_WS(' - ', OCR.folio, P.razon_social) AS orden_proveedor", FALSE);
		$this->db->from('ordenes_compra_refacciones AS OCR');
		$this->db->join('proveedores AS P', 'OCR.proveedor_id = P.proveedor_id', 'inner');
		$this->db->where('OCR.sucursal_id',  $this->session->userdata('sucursal_id'));
		$this->db->where('OCR.estatus', 'AUTORIZADO');

		//Si el formulario (proceso) corresponde a una entrada de refacciones por compra 
		if($strFormulario == 'entradas_refacciones_compra')
		{
			 $this->db->where("OCR.orden_compra_refacciones_id NOT IN (SELECT MR.referencia_id FROM  
	     				  		 movimientos_refacciones AS MR 
	     				  		 WHERE MR.tipo_movimiento = $intMovEntradaRefCompra  
	     				   		 AND MR.estatus = 'ACTIVO')", NULL, FALSE);
		}

		$this->db->where("(OCR.folio LIKE '%$strDescripcion%' OR
						   P.razon_social LIKE '%$strDescripcion%')"); 
		$this->db->order_by("OCR.folio",'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla ordenes_compra_refacciones_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la orden de compra
	public function guardar_detalles(stdClass $objOrdenCompra)
	{
		/*Quitar | de la lista para obtener el ID de la refacción, código, descripción, código de la línea, 
		 cantidad, precio unitario, descuento unitario, iva unitario e ieps unitario
		*/
		$arrRefaccionID = explode("|", $objOrdenCompra->strRefaccionID);
		$arrCodigos = explode("|", $objOrdenCompra->strCodigos);
		$arrDescripciones = explode("|", $objOrdenCompra->strDescripciones);
		$arrCodigosLineas = explode("|", $objOrdenCompra->strCodigosLineas);
		$arrCantidades = explode("|", $objOrdenCompra->strCantidades);
		$arrPreciosUnitarios = explode("|", $objOrdenCompra->strPreciosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objOrdenCompra->strDescuentosUnitarios);
		$arrTasaCuotaIva = explode("|", $objOrdenCompra->strTasaCuotaIva);
		$arrIvasUnitarios = explode("|", $objOrdenCompra->strIvasUnitarios);
		$arrTasaCuotaIeps = explode("|", $objOrdenCompra->strTasaCuotaIeps);
		$arrIepsUnitarios = explode("|", $objOrdenCompra->strIepsUnitarios);

		//Hacer recorrido para insertar los datos en la tabla ordenes_compra_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{	
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);

			//Asignar datos al array
			$arrDatos = array('orden_compra_refacciones_id' => $objOrdenCompra->intOrdenCompraRefaccionesID,
							  'renglon' => ($intCon + 1),
							  'refaccion_id' => $arrRefaccionID[$intCon], 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $arrCantidades[$intCon],
							  'precio_unitario' => $arrPreciosUnitarios[$intCon],
							  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva_unitario' => $arrIvasUnitarios[$intCon], 
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps_unitario' => $arrIepsUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('ordenes_compra_refacciones_detalles', $arrDatos);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intOrdenCompraRefaccionesID)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');

		$this->db->select("OCRD.refaccion_id, OCRD.codigo, OCRD.descripcion, OCRD.codigo_linea, 
						   OCRD.cantidad, OCRD.precio_unitario, OCRD.descuento_unitario, 
						   OCRD.tasa_cuota_iva, OCRD.iva_unitario, OCRD.tasa_cuota_ieps,
						   OCRD.ieps_unitario, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps,  
						   RI.localizacion, RI.actual_costo ", FALSE);
		$this->db->from('ordenes_compra_refacciones_detalles AS OCRD');
		$this->db->join('sat_tasa_cuota AS TIva', 'OCRD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('refacciones AS R', 'OCRD.refaccion_id = R.refaccion_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'OCRD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('refacciones_inventario AS RI', 'R.refaccion_id = RI.refaccion_id 
						 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(NOW())', 'left');
		$this->db->where('OCRD.orden_compra_refacciones_id', $intOrdenCompraRefaccionesID);
		$this->db->order_by('OCRD.renglon', 'ASC');
		return $this->db->get()->result();
	}
}	
?>