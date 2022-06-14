<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de mensajes (para guardar el mensaje que se envía a los usuarios)
include_once(APPPATH . 'models/administracion/Mensajes_model.php');

class Ordenes_compra_maquinaria_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla ordenes_compra
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objOrdenCompra)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		//Tabla ordenes_compra_maquinaria
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objOrdenCompra->strFolio); 

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
		$this->db->insert('ordenes_compra_maquinaria', $arrDatos);
		//Agregar id del nuevo registro al objeto
		$objOrdenCompra->intOrdenCompraMaquinariaID = $this->db->insert_id();

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
		return $this->db->trans_status().'_'.$objOrdenCompra->intOrdenCompraMaquinariaID.'_'.$strFolioConsecutivo;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objOrdenCompra)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla ordenes_compra_maquinaria
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
		$this->db->where('orden_compra_maquinaria_id', $objOrdenCompra->intOrdenCompraMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('ordenes_compra_maquinaria', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('orden_compra_maquinaria_id', $objOrdenCompra->intOrdenCompraMaquinariaID);
		$this->db->delete('ordenes_compra_maquinaria_detalles');
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
	public function set_estatus($intOrdenCompraMaquinariaID, $strEstatus)
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
		$this->db->where('orden_compra_maquinaria_id', $intOrdenCompraMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('ordenes_compra_maquinaria', $arrDatos);
	}

	//Método para enviar la autorización (o rechazo) de un registro
	public function set_enviar_autorizacion($intOrdenCompraMaquinariaID, $strUsuarios, $strMensaje, $strEstatus)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (Mensajes) 
        $otdModelMensajes = new  Mensajes_model();

		//Si existe estatus
		if($strEstatus !== NULL)
		{
			//Tabla ordenes_compra
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
			$this->db->where('orden_compra_maquinaria_id', $intOrdenCompraMaquinariaID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('ordenes_compra_maquinaria', $arrDatos);
		}
		
        //Hacer un llamado al método para guardar el mensaje que se envía a los usuarios
		$otdModelMensajes->guardar('ORDENES DE COMPRA MAQUINARIA', $intOrdenCompraMaquinariaID, $strUsuarios, $strMensaje);
        
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intOrdenCompraMaquinariaID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		$this->db->select("OC.orden_compra_maquinaria_id,  OC.folio, 
						   DATE_FORMAT(OC.fecha,'%d/%m/%Y') AS fecha, 
						   DATE_FORMAT(OC.fecha_entrega,'%d/%m/%Y') AS fecha_entrega,
						   DATE_FORMAT(OC.fecha_vencimiento,'%d/%m/%Y') AS fecha_vencimiento, 
						   OC.condiciones_pago, OC.moneda_id, OC.tipo_cambio, 
						   OC.factura,  OC.proveedor_id, OC.regimen_fiscal_id,
						   OC.porcentaje_retencion_id, OC.importe_retenido,
						   OC.observaciones, OC.estatus,
						   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, 
						   P.dias_credito, P.correo_electronico, P.rfc, P.telefono_principal,  
						   P.calle, P.numero_exterior, P.numero_interior, 
						   P.colonia, P.localidad, MP.descripcion AS municipio, 
						   EP.descripcion AS estado, CP.codigo_postal, 
						   M.codigo AS codigo_moneda, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, 
						   PIsr.porcentaje AS porcentaje_isr, 
						   UC.usuario AS usuario_creacion, 
						   UA.usuario AS usuario_autorizacion, 
						   DATE_FORMAT(OC.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
	    $this->db->from('ordenes_compra_maquinaria AS OC');
	    $this->db->join('sat_monedas AS M', 'OC.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('usuarios AS UC', 'OC.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('usuarios AS UA', 'OC.usuario_autorizacion = UA.usuario_id', 'left');
		$this->db->join('porcentaje_retencion_isr AS PIsr', 'OC.porcentaje_retencion_id = PIsr.porcentaje_retencion_id', 'left');

		//Si existe id de la orden de compra
		if ($intOrdenCompraMaquinariaID != NULL)
		{   
			$this->db->where('OC.orden_compra_maquinaria_id', $intOrdenCompraMaquinariaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('OC.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del proveedor
		    if($intProveedorID > 0)
		    {
		   		$this->db->where('OC.proveedor_id', $intProveedorID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(OC.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('OC.estatus', $strEstatus);
			}

			$this->db->where("((OC.folio LIKE '%$strBusqueda%') OR
        				      (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			                  (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))");

			$this->db->order_by('OC.fecha DESC, OC.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						                     $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;
        
		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('ordenes_compra_maquinaria AS OC');
		$this->db->join('sat_monedas AS M', 'OC.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->where('OC.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del proveedor
	    if($intProveedorID > 0)
	    {
	   		$this->db->where('OC.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OC.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OC.estatus', $strEstatus);
		}

		$this->db->where("((OC.folio LIKE '%$strBusqueda%') OR
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
		$this->db->where('OC.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('OC.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OC.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OC.estatus', $strEstatus);
		}

		$this->db->where("((OC.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
		$this->db->from('ordenes_compra_maquinaria AS OC');
		$this->db->join('sat_monedas AS M', 'OC.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("	OC.orden_compra_maquinaria_id, 
							OC.folio, 
							DATE_FORMAT(OC.fecha,'%d/%m/%Y') AS fecha, 
						   	OC.estatus, 
						   	CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor", FALSE);
		$this->db->from('ordenes_compra_maquinaria AS OC');
		$this->db->join('sat_monedas AS M', 'OC.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->where('OC.sucursal_id', $this->session->userdata('sucursal_id'));
	    
	    //Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('OC.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OC.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OC.estatus', $strEstatus);
		}

		$this->db->where("((OC.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
		$this->db->order_by('OC.fecha DESC, OC.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["ordenes"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strEstatus, $intSucursalID, $strFormulario = NULL)
	{
		//Constante para identificar al tipo de movimiento entrada por compra de maquinaria
		$intMovEntradaMaqCompra = ENTRADA_MAQUINARIA_COMPRA;

		$this->db->select("	OC.orden_compra_maquinaria_id, CONCAT_WS(' - ', OC.folio, P.razon_social) AS orden_proveedor", FALSE);
		$this->db->from('ordenes_compra_maquinaria AS OC');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->where('OC.sucursal_id', $intSucursalID);
		$this->db->where('OC.estatus', $strEstatus);

		//Si el formulario (proceso) corresponde a una entrada de maquinaria por compra 
		if($strFormulario == 'entradas_maquinaria_compra')
		{
			 $this->db->where("OC.orden_compra_maquinaria_id NOT IN (SELECT MM.referencia_id FROM  
	     				  		 movimientos_maquinaria AS MM 
	     				  		 WHERE MM.tipo_movimiento = $intMovEntradaMaqCompra  
	     				   		 AND MM.estatus = 'ACTIVO'
	     				   		 AND  MM.referencia_id IS NOT NULL)", NULL, FALSE);
		}


		$this->db->where("(OC.folio LIKE '%$strDescripcion%' OR
						   P.razon_social LIKE '%$strDescripcion%')"); 
		$this->db->order_by("OC.folio",'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla ordenes_compra_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la orden de compra
	public function guardar_detalles(stdClass $objOrdenCompra)
	{
		/*Quitar | de la lista para obtener el concepto, cantidad, precio unitario, descuento unitario, 
		  iva unitario e ieps unitario
		*/
		$arrMaquinariaID = explode("|", $objOrdenCompra->strMaquinariaID);
		$arrCodigos = explode("|", $objOrdenCompra->strCodigos);
		$arrDescripciones = explode("|", $objOrdenCompra->strDescripciones);
		$arrCantidades = explode("|", $objOrdenCompra->strCantidades);
		$arrPreciosUnitarios = explode("|", $objOrdenCompra->strPreciosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objOrdenCompra->strDescuentosUnitarios);
		$arrTasaCuotaIva = explode("|", $objOrdenCompra->strTasaCuotaIva);
		$arrIvasUnitarios = explode("|", $objOrdenCompra->strIvasUnitarios);
		$arrTasaCuotaIeps = explode("|", $objOrdenCompra->strTasaCuotaIeps);
		$arrIepsUnitarios = explode("|", $objOrdenCompra->strIepsUnitarios);

		//Hacer recorrido para insertar los datos en la tabla ordenes_compra_detalles
		for ($intCon = 0; $intCon < sizeof($arrMaquinariaID); $intCon++) 
		{

			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);
			//Asignar datos al array
			$arrDatos = array('orden_compra_maquinaria_id' => $objOrdenCompra->intOrdenCompraMaquinariaID,
							  'renglon' => ($intCon + 1),
							  'maquinaria_descripcion_id' => $arrMaquinariaID[$intCon], 
							  'codigo' => $arrCodigos[$intCon],
							  'descripcion_corta' => $arrDescripciones[$intCon],
							  'cantidad' => $arrCantidades[$intCon],
							  'precio_unitario' => $arrPreciosUnitarios[$intCon],
							  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva_unitario' => $arrIvasUnitarios[$intCon], 
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps_unitario' => $arrIepsUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('ordenes_compra_maquinaria_detalles', $arrDatos);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intOrdenCompraMaquinariaID, $strFormulario = NULL)
	{
		$this->db->select('OCD.maquinaria_descripcion_id, OCD.codigo, 
						   OCD.descripcion_corta, MD.descripcion, MD.servicio,
						   OCD.cantidad, OCD.precio_unitario, OCD.descuento_unitario,  OCD.tasa_cuota_iva,
						   OCD.iva_unitario, OCD.tasa_cuota_ieps, OCD.ieps_unitario, 
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps');
		$this->db->from('ordenes_compra_maquinaria_detalles AS OCD');
		$this->db->join('maquinaria_descripciones AS MD', 'MD.maquinaria_descripcion_id = OCD.maquinaria_descripcion_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'OCD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'OCD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('OCD.orden_compra_maquinaria_id', $intOrdenCompraMaquinariaID);
		//Si el formulario (proceso) corresponde a una entrada de maquinaria por compra 
		if($strFormulario == 'entradas_maquinaria_compra')
		{
			$this->db->where('MD.servicio <>', 'SI');
		}
		$this->db->order_by('OCD.renglon', 'ASC');
		return $this->db->get()->result();
	}


	//Método para regresar las tasas de ieps de los detalles de un registro
	public function buscar_tasas_ieps_detalles($intOrdenCompraMaquinariaID)
	{
		$this->db->select("DISTINCT OCD.tasa_cuota_ieps, TIeps.valor_maximo AS porcentaje_ieps", FALSE);
		$this->db->from('ordenes_compra_maquinaria_detalles AS OCD');
		$this->db->join('sat_tasa_cuota AS TIeps', 'OCD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'inner');
		$this->db->where('OCD.orden_compra_maquinaria_id', $intOrdenCompraMaquinariaID);
		$this->db->where('OCD.ieps_unitario > 0');
		return $this->db->get()->result();
	}


	//Método para regresar el costo (total) de los detalles con servicio de un registro
	public function buscar_costo_servicios($intOrdenCompraMaquinariaID)
	{

		//Costo total de los detalles con servicio
		$queryCostosServ = "SELECT 
								 SUM(CMD.cantidad * CMD.precio_unitario) AS Subtotal, 
								 SUM(CMD.cantidad * CMD.iva_unitario) AS IVA,
			                     ROUND((SUM(CMD.cantidad * CMD.precio_unitario)  /  DetallesSinServ.cantidad),2) AS porcentaje
							FROM   ordenes_compra_maquinaria AS CM INNER JOIN ordenes_compra_maquinaria_detalles AS CMD 
								   ON CM.orden_compra_maquinaria_id = CMD.orden_compra_maquinaria_id 
								   INNER JOIN maquinaria_descripciones AS MD 
								   ON CMD.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
							LEFT JOIN (SELECT CMDNS. orden_compra_maquinaria_id AS referenciaID,
														     SUM(CMDNS.cantidad) AS cantidad
											   FROM   ordenes_compra_maquinaria_detalles AS CMDNS
			                                   INNER JOIN maquinaria_descripciones AS MDNS
												ON CMDNS.maquinaria_descripcion_id = MDNS.maquinaria_descripcion_id
			                                    WHERE MDNS.servicio <>  'SI' 
												GROUP BY CMDNS.orden_compra_maquinaria_id) AS DetallesSinServ ON DetallesSinServ.referenciaID = CM.orden_compra_maquinaria_id
							WHERE  CM.orden_compra_maquinaria_id = $intOrdenCompraMaquinariaID
							AND    MD.servicio = 'SI' 
							GROUP BY CM.orden_compra_maquinaria_id";


		//Ejecutar consulta
		$strSQL = $this->db->query($queryCostosServ);
		return $strSQL->row();

	}

	
}	
?>