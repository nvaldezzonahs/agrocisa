<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de mensajes (para guardar el mensaje que se envía a los usuarios)
include_once(APPPATH . 'models/administracion/Mensajes_model.php');

class Ordenes_compra_servicio_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla ordenes_compra_servicio
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

		//Tabla ordenes_compra_servicio
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
						  'solicita_id' => $objOrdenCompra->intSolicitaID,
						  'orden_reparacion_id' => $objOrdenCompra->intOrdenReparacionID,
						  'observaciones' => $objOrdenCompra->strObservaciones, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objOrdenCompra->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('ordenes_compra_servicio', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objOrdenCompra->intOrdenCompraServicioID = $this->db->insert_id();

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
		return $this->db->trans_status().'_'.$objOrdenCompra->intOrdenCompraServicioID.'_'.$strFolioConsecutivo;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objOrdenCompra)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla ordenes_compra_servicio
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
						  'solicita_id' => $objOrdenCompra->intSolicitaID,
						  'orden_reparacion_id' => $objOrdenCompra->intOrdenReparacionID,
						  'observaciones' => $objOrdenCompra->strObservaciones, 
						  'estatus' => 'ACTIVO', 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objOrdenCompra->intUsuarioID);
		$this->db->where('orden_compra_servicio_id', $objOrdenCompra->intOrdenCompraServicioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('ordenes_compra_servicio', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('orden_compra_servicio_id', $objOrdenCompra->intOrdenCompraServicioID);
		$this->db->delete('ordenes_compra_servicio_detalles');
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
	public function set_estatus($intOrdenCompraServicioID, $strEstatus)
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
		$this->db->where('orden_compra_servicio_id', $intOrdenCompraServicioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('ordenes_compra_servicio', $arrDatos);
	}

	//Método para enviar la autorización (o rechazo) de un registro
	public function set_enviar_autorizacion($intOrdenCompraServicioID, $strUsuarios, $strMensaje, $strEstatus)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (Mensajes) 
        $otdModelMensajes = new  Mensajes_model();

		//Si existe estatus
		if($strEstatus !== NULL)
		{
			//Tabla ordenes_compra_servicio
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
			$this->db->where('orden_compra_servicio_id', $intOrdenCompraServicioID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('ordenes_compra_servicio', $arrDatos);
		}
		
        //Hacer un llamado al método para guardar el mensaje que se envía a los usuarios
		$otdModelMensajes->guardar('ORDENES DE COMPRA SERVICIO', $intOrdenCompraServicioID, 
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
	public function buscar($intOrdenCompraServicioID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		$this->db->select("OCS.orden_compra_servicio_id, OCS.folio, 
						   DATE_FORMAT(OCS.fecha,'%d/%m/%Y') AS fecha, 
						   DATE_FORMAT(OCS.fecha_entrega,'%d/%m/%Y') AS fecha_entrega,
						   DATE_FORMAT(OCS.fecha_vencimiento,'%d/%m/%Y') AS fecha_vencimiento, 
						   OCS.condiciones_pago, OCS.moneda_id, OCS.tipo_cambio, 
						   OCS.factura, OCS.proveedor_id, 
						   IFNULL(OCS.regimen_fiscal_id, '') AS regimen_fiscal_id,
						   OCS.porcentaje_retencion_id, 
						   OCS.importe_retenido, OCS.solicita_id,  
						   OCS.orden_reparacion_id, OCS.observaciones, OCS.estatus,
						   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, P.dias_credito,
						   P.regimen_fiscal_id AS regimenFiscalIDProv, 
						   P.correo_electronico, P.contacto_correo_electronico,
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS solicita,
						   P.rfc, P.telefono_principal,  
						   P.calle, P.numero_exterior, P.numero_interior, P.colonia,  
						   P.localidad, MP.descripcion AS municipio, EP.descripcion AS estado,
						   CP.codigo_postal, M.codigo AS codigo_moneda, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   PIsr.porcentaje AS porcentaje_isr,  
						   OR.folio AS folio_orden_reparacion,
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' THEN C.razon_social
								    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						    END AS prospecto,
						   	CASE 
							   WHEN  C.estatus = 'ACTIVO' THEN CONCAT_WS(' - ', PP.codigo, C.razon_social)
								    ELSE CONCAT_WS(' - ', PP.codigo, PP.nombre_comercial) 
						   	END AS prospecto_rep, 
						   UC.usuario AS usuario_creacion, 
						   UA.usuario AS usuario_autorizacion, 
						   DATE_FORMAT(OCS.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
	    $this->db->from('ordenes_compra_servicio AS OCS');
	    $this->db->join('sat_monedas AS M', 'OCS.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('ordenes_reparacion AS OR', 'OCS.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
	    $this->db->join('prospectos AS PP', 'OR.prospecto_id = PP.prospecto_id', 'inner');
		$this->db->join('empleados AS E', 'OCS.solicita_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'OCS.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('clientes AS C', 'PP.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('usuarios AS UC', 'OCS.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('usuarios AS UA', 'OCS.usuario_autorizacion = UA.usuario_id', 'left');
		$this->db->join('porcentaje_retencion_isr AS PIsr', 'OCS.porcentaje_retencion_id = PIsr.porcentaje_retencion_id', 'left');

		//Si existe id de la orden de compra
		if ($intOrdenCompraServicioID != NULL)
		{   
			$this->db->where('OCS.orden_compra_servicio_id', $intOrdenCompraServicioID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('OCS.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del proveedor
		    if($intProveedorID > 0)
		    {
		   		$this->db->where('OCS.proveedor_id', $intProveedorID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(OCS.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('OCS.estatus', $strEstatus);
			}

		    $this->db->where("((OCS.folio LIKE '%$strBusqueda%') OR
		    				   (OR.folio LIKE '%$strBusqueda%') OR
        				       (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('OCS.fecha DESC, OCS.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						                     $intProveedorID = NULL, $strEstatus = NULL, 
						                     $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('ordenes_compra_servicio AS OCS');
	    $this->db->join('sat_monedas AS M', 'OCS.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('ordenes_reparacion AS OR', 'OCS.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
	    $this->db->join('prospectos AS PP', 'OR.prospecto_id = PP.prospecto_id', 'inner');
		$this->db->join('empleados AS E', 'OCS.solicita_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'OCS.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->where('OCS.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del proveedor
	    if($intProveedorID > 0)
	    {
	   		$this->db->where('OCS.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OCS.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OCS.estatus', $strEstatus);
		}

	    $this->db->where("((OCS.folio LIKE '%$strBusqueda%') OR
	    				   (OR.folio LIKE '%$strBusqueda%') OR
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
		$this->db->where('OCS.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del proveedor
	    if($intProveedorID > 0)
	    {
	   		$this->db->where('OCS.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OCS.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OCS.estatus', $strEstatus);
		}

	    $this->db->where("((OCS.folio LIKE '%$strBusqueda%') OR
	    				   (OR.folio LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))");

		$this->db->from('ordenes_compra_servicio AS OCS');
	    $this->db->join('sat_monedas AS M', 'OCS.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('ordenes_reparacion AS OR', 'OCS.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
	    $this->db->join('prospectos AS PP', 'OR.prospecto_id = PP.prospecto_id', 'inner');
		$this->db->join('empleados AS E', 'OCS.solicita_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'OCS.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("OCS.orden_compra_servicio_id, OCS.folio, 
						   DATE_FORMAT(OCS.fecha,'%d/%m/%Y') AS fecha, 
						   OCS.estatus, CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, 
						   OR.folio AS folio_orden_reparacion", FALSE);
		$this->db->from('ordenes_compra_servicio AS OCS');
	    $this->db->join('sat_monedas AS M', 'OCS.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('ordenes_reparacion AS OR', 'OCS.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
	    $this->db->join('prospectos AS PP', 'OR.prospecto_id = PP.prospecto_id', 'inner');
		$this->db->join('empleados AS E', 'OCS.solicita_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'OCS.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
	    $this->db->where('OCS.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del proveedor
	    if($intProveedorID > 0)
	    {
	   		$this->db->where('OCS.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OCS.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OCS.estatus', $strEstatus);
		}

	    $this->db->where("((OCS.folio LIKE '%$strBusqueda%') OR
	    				   (OR.folio LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))");

		$this->db->order_by('OCS.fecha DESC, OCS.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["ordenes"] =$this->db->get()->result();
		return $arrResultado;
	}


	//Método para regresar los registros autorizados que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $intOrdenReparacionID)
	{
		$this->db->select("OCS.orden_compra_servicio_id,
						   CONCAT_WS(' - ', OCS.folio, P.razon_social) AS orden_compra_servicio", FALSE);
        $this->db->from('ordenes_compra_servicio AS OCS');
		$this->db->join('proveedores AS P', 'OCS.proveedor_id = P.proveedor_id', 'inner');
	  	$this->db->where('OCS.sucursal_id', $this->session->userdata('sucursal_id'));
	  	$this->db->where('OCS.orden_reparacion_id', $intOrdenReparacionID);
	  	$this->db->where('OCS.estatus', 'AUTORIZADO');
        $this->db->where("(OCS.folio LIKE '%$strDescripcion%' OR 
							P.razon_social LIKE '%$strDescripcion%')");
        $this->db->order_by("OCS.folio",'DESC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}


	/*******************************************************************************************************************
	Funciones de la tabla ordenes_compra_servicio_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la orden de compra
	public function guardar_detalles(stdClass $objOrdenCompra)
	{
		/*Quitar | de la lista para obtener el concepto, cantidad, precio unitario,
		 descuento unitario, iva unitario e ieps unitario
		*/
		$arrConceptos = explode("|", $objOrdenCompra->strConceptos);
		$arrCantidades = explode("|", $objOrdenCompra->strCantidades);
		$arrPreciosUnitarios = explode("|", $objOrdenCompra->strPreciosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objOrdenCompra->strDescuentosUnitarios);
		$arrTasaCuotaIva = explode("|", $objOrdenCompra->strTasaCuotaIva);
		$arrIvasUnitarios = explode("|", $objOrdenCompra->strIvasUnitarios);
		$arrTasaCuotaIeps = explode("|", $objOrdenCompra->strTasaCuotaIeps);
		$arrIepsUnitarios = explode("|", $objOrdenCompra->strIepsUnitarios);
		
		//Hacer recorrido para insertar los datos en la tabla ordenes_compra_servicio_detalles
		for ($intCon = 0; $intCon < sizeof($arrConceptos); $intCon++) 
		{
		
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);

			//Asignar datos al array
			$arrDatos = array('orden_compra_servicio_id' => $objOrdenCompra->intOrdenCompraServicioID,
							  'renglon' => ($intCon + 1),
							  'concepto' => $arrConceptos[$intCon], 
							  'cantidad' => $arrCantidades[$intCon],
							  'precio_unitario' => $arrPreciosUnitarios[$intCon],
							  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva_unitario' => $arrIvasUnitarios[$intCon], 
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps_unitario' => $arrIepsUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('ordenes_compra_servicio_detalles', $arrDatos);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intOrdenCompraServicioID)
	{
		
		$this->db->select("OCSD.renglon, OCSD.concepto, OCSD.cantidad, OCSD.precio_unitario, 
						   OCSD.descuento_unitario, OCSD.tasa_cuota_iva, OCSD.iva_unitario, 
						   OCSD.tasa_cuota_ieps, OCSD.ieps_unitario, 
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps,
						   TIeps.valor_minimo AS  valor_minimo_ieps, TIeps.tipo AS tipo_ieps, 
						   TIeps.factor AS factor_ieps", FALSE);
		$this->db->from('ordenes_compra_servicio_detalles OCSD');
		$this->db->join('sat_tasa_cuota AS TIva', 'OCSD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'OCSD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('OCSD.orden_compra_servicio_id', $intOrdenCompraServicioID);
		$this->db->order_by('OCSD.renglon', 'ASC');
		return $this->db->get()->result();

	}
}	
?>