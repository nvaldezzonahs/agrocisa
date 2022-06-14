<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de mensajes (para guardar el mensaje que se envía a los usuarios)
include_once(APPPATH . 'models/administracion/Mensajes_model.php');

class Ordenes_compra_combustibles_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla ordenes_compra_combustibles
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

		//Tabla ordenes_compra_combustibles
		//Asignar datos al array
		$arrDatos = array('folio' => $strFolioConsecutivo, 
						  'fecha' => $objOrdenCompra->dteFecha, 
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
						  'observaciones' => $objOrdenCompra->strObservaciones, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objOrdenCompra->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('ordenes_compra_combustibles', $arrDatos);
		//Agregar id del nuevo registro al objeto
		$objOrdenCompra->intOrdenCompraCombustibleID = $this->db->insert_id();

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
		return $this->db->trans_status().'_'.$objOrdenCompra->intOrdenCompraCombustibleID.'_'.$strFolioConsecutivo;
	}

	
	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objOrdenCompra)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla ordenes_compra_combustibles
		//Asignar datos al array
		$arrDatos = array('fecha' => $objOrdenCompra->dteFecha, 
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
						  'observaciones' => $objOrdenCompra->strObservaciones,  
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objOrdenCompra->intUsuarioID);
		$this->db->where('orden_compra_combustible_id', $objOrdenCompra->intOrdenCompraCombustibleID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('ordenes_compra_combustibles', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('orden_compra_combustible_id', $objOrdenCompra->intOrdenCompraCombustibleID);
		$this->db->delete('ordenes_compra_combustibles_detalles');

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
	public function set_estatus($intOrdenCompraCombustibleID)
	{
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('orden_compra_combustible_id', $intOrdenCompraCombustibleID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('ordenes_compra_combustibles',$arrDatos);
	}


	//Método para enviar la autorización (o rechazo) de un registro
	public function set_enviar_autorizacion($intOrdenCompraCombustibleID, $strUsuarios, $strMensaje, 
										    $strEstatus)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (Mensajes) 
        $otdModelMensajes = new  Mensajes_model();

		//Si existe estatus
		if($strEstatus !== NULL)
		{
			//Tabla ordenes_compra_combustibles
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
			$this->db->where('orden_compra_combustible_id', $intOrdenCompraCombustibleID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('ordenes_compra_combustibles', $arrDatos);
		}
		
        //Hacer un llamado al método para guardar el mensaje que se envía a los usuarios
		$otdModelMensajes->guardar('ORDENES DE COMPRA COMBUSTIBLES', 
								    $intOrdenCompraCombustibleID, 
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
	public function buscar($intOrdenCompraCombustibleID = NULL, $dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL, $intProveedorID = NULL, $strEstatus = NULL, 
						   $strBusqueda =  NULL)
	{

		$this->db->select("OCC.orden_compra_combustible_id, OCC.folio, 
						   DATE_FORMAT(OCC.fecha,'%d/%m/%Y') AS fecha, 
						   DATE_FORMAT(OCC.fecha_vencimiento,'%d/%m/%Y') AS fecha_vencimiento, 
						   OCC.condiciones_pago, OCC.moneda_id, OCC.tipo_cambio, OCC.factura, 
						   OCC.proveedor_id, OCC.regimen_fiscal_id,
						   OCC.porcentaje_retencion_id, 
						   OCC.importe_retenido, OCC.solicita_id, OCC.observaciones, OCC.estatus,
						   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, P.dias_credito,
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS solicita,
						   P.rfc, P.telefono_principal,  
						   P.calle, P.numero_exterior, P.numero_interior, P.colonia,  
						   P.localidad, MP.descripcion AS municipio, EP.descripcion AS estado,
						   CP.codigo_postal, M.codigo AS codigo_moneda, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, 
						   PIsr.porcentaje AS porcentaje_isr, 
						   UC.usuario AS usuario_creacion, 
						   UA.usuario AS usuario_autorizacion, 
						   DATE_FORMAT(OCC.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
	    $this->db->from('ordenes_compra_combustibles AS OCC');
	    $this->db->join('sat_monedas AS M', 'OCC.moneda_id = M.moneda_id', 'inner');
		$this->db->join('empleados AS E', 'OCC.solicita_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'OCC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('usuarios AS UC', 'OCC.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('usuarios AS UA', 'OCC.usuario_autorizacion = UA.usuario_id', 'left');
		$this->db->join('porcentaje_retencion_isr AS PIsr', 'OCC.porcentaje_retencion_id = PIsr.porcentaje_retencion_id', 'left');

		//Si existe id de la orden de compra
		if ($intOrdenCompraCombustibleID != NULL)
		{   
			$this->db->where('OCC.orden_compra_combustible_id', $intOrdenCompraCombustibleID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			//Si existe id del proveedor
		    if($intProveedorID > 0)
		    {
		   		$this->db->where('OCC.proveedor_id', $intProveedorID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(OCC.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('OCC.estatus', $strEstatus);
			}

		    $this->db->where("((OCC.folio LIKE '%$strBusqueda%') OR
        				      (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			                  (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('OCC.fecha DESC, OCC.folio DESC');
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
		$this->db->from('ordenes_compra_combustibles AS OCC');
		$this->db->join('sat_monedas AS M', 'OCC.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'OCC.proveedor_id = P.proveedor_id', 'inner');
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del proveedor
	    if($intProveedorID > 0)
	    {
	   		$this->db->where('OCC.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OCC.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OCC.estatus', $strEstatus);
		}

		$this->db->where("((OCC.folio LIKE '%$strBusqueda%') OR
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
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('OCC.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OCC.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OCC.estatus', $strEstatus);
		}

		$this->db->where("((OCC.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->from('ordenes_compra_combustibles AS OCC');
	    $this->db->join('sat_monedas AS M', 'OCC.moneda_id = M.moneda_id', 'inner');
		$this->db->join('empleados AS E', 'OCC.solicita_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'OCC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("OCC.orden_compra_combustible_id, OCC.folio, 
						   DATE_FORMAT(OCC.fecha,'%d/%m/%Y') AS fecha, 
						   OCC.estatus, CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor", FALSE);
		$this->db->from('ordenes_compra_combustibles AS OCC');
	    $this->db->join('sat_monedas AS M', 'OCC.moneda_id = M.moneda_id', 'inner');
		$this->db->join('empleados AS E', 'OCC.solicita_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'OCC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
	    //Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('OCC.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OCC.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OCC.estatus', $strEstatus);
		}

		$this->db->where("((OCC.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))");

		$this->db->order_by('OCC.fecha DESC, OCC.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["ordenes"] =$this->db->get()->result();
		return $arrResultado;
	}
	


	
	/*******************************************************************************************************************
	Funciones de la tabla ordenes_compra_combustibles_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la orden de compra
	public function guardar_detalles(stdClass $objOrdenCompra)
	{
		/*Quitar | de la lista para obtener el ID del vale de gasolina
		*/
		$arrValeGasolinaID = explode("|", $objOrdenCompra->strValeGasolinaID);

		//Hacer recorrido para insertar los datos en la tabla ordenes_compra_combustibles_detalles
		for ($intCon = 0; $intCon < sizeof($arrValeGasolinaID); $intCon++) 
		{
			//Asignar datos al array
			$arrDatos = array('orden_compra_combustible_id' => $objOrdenCompra->intOrdenCompraCombustibleID,
							  'renglon' => ($intCon + 1),
							  'vale_gasolina_id' => $arrValeGasolinaID[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('ordenes_compra_combustibles_detalles', $arrDatos);
		}
	}


	/*******************************************************************************************************************
	Funciones que corresponden a los vales de gasolina del proveedor
	*********************************************************************************************************************/
	//Método para regresar los vales de gasolina que coincidan con el criterio de búsqueda proporcionado
	public function buscar_vales_gasolina($intOrdenCompraCombustibleID = NULL, $intProveedorID = NULL, 
	 								      $dteFechaInicial = NULL, $dteFechaFinal = NULL, $strBusqueda =  NULL)
	{
		
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		//Variable que se utiliza para formar la consulta
		$queryValesGasolina = '';

		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		//ID de la orden de compra
		$strRestriccionesOrdenCompra = '';
		//Estatus de la orden de compra
		$strRestriccionesEstatusOrdenCompra = '';

		//Proveedor
		$strRestriccionesProveedor = '';
		//Variable que se utiliza para agregar los campos de la tabla ordenes_compra_combustibles_detalles
		$strCampoRenglon = '';
		//Variable que se utiliza para ordenar los registros dependiendo del tipo de búsqueda
		$strOrdenamiento = " ORDER BY ";

		//Si existe id de la orden de compra
		if($intOrdenCompraCombustibleID != NULL)
		{
			$strRestriccionesOrdenCompra .= "OrdenDetalles.ID = $intOrdenCompraCombustibleID";
			$strCampoRenglon = ", OrdenDetalles.renglon";
			$strOrdenamiento .= "renglon ASC";

		}
		else
		{
			$strRestriccionesOrdenCompra .= "IFNULL(OrdenDetalles.ID,0) = 0";
			
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL AND $dteFechaFinal != NULL)
		    {
		       $strRestriccionesOrdenCompra .= " AND  (VG.fecha  BETWEEN '$dteFechaInicial' 
		       									 	   AND '$dteFechaFinal')";
		    }

		    //Si existe descripción de la búsqueda
		    if($strBusqueda != NULL)
		    {

		    	$strRestriccionesOrdenCompra .= " AND ((VG.folio LIKE '%$strBusqueda%') OR
		    										   (VG.factura LIKE '%$strBusqueda%') OR
						        				       (CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas)  LIKE '%$strBusqueda%') OR
							           				   (CONCAT_WS(' ', V.codigo, ' ', V.modelo, V.marca, V.placas)  LIKE '%$strBusqueda%') OR 
							           				   (CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
									        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
												       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
												       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
												       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
												       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
												       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
												       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))";

		    }

		


			$strRestriccionesEstatusOrdenCompra .= " AND (OCC.estatus = 'ACTIVO' OR OCC.estatus = 'AUTORIZADO')"; 
			$strOrdenamiento .= "fecha ASC";
		}
		
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	    	$strRestriccionesProveedor .= " AND P.proveedor_id = $intProveedorID";
	    }

		//Vales de gasolina
		$queryValesGasolina = "SELECT  VG.vale_gasolina_id, VG.folio,
									   DATE_FORMAT(VG.fecha,'%d/%m/%Y') AS fecha, VG.factura,  
									   CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca) AS vehiculo,
									   CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) AS empleado,
									    M.moneda_id, M.codigo AS moneda_tipo, '1.0000' AS tipo_cambio,
									    ValesDetalles.total,
									    ValesDetalles.subtotal, 
									    ValesDetalles.iva
										$strCampoRenglon
							     FROM vales_gasolina AS VG
							   	INNER JOIN vehiculos AS V ON VG.vehiculo_id = V.vehiculo_id
								INNER JOIN empleados AS E ON VG.empleado_id = E.empleado_id
								INNER JOIN proveedores AS P ON  VG.proveedor_id = P.proveedor_id
							 	 INNER JOIN (SELECT vale_gasolina_id AS referenciaID,
										   		    SUM(ROUND(subtotal,2) + 
									    			    ROUND(iva, 2)) AS total,
											  		SUM(ROUND(subtotal, 2)) AS subtotal,
											        SUM(ROUND(iva, 2)) AS iva
											 FROM vales_gasolina_detalles
											 GROUP BY vale_gasolina_id   
									   		 ) AS ValesDetalles ON ValesDetalles.referenciaID = VG.vale_gasolina_id
							     LEFT JOIN sat_monedas AS M ON M.moneda_id = $intMonedaBase
							     LEFT JOIN (SELECT IFNULL(OCCD.orden_compra_combustible_id,0) AS ID, 
												  		  OCCD.vale_gasolina_id AS referenciaID, 
												  		  OCCD.renglon
										 FROM ordenes_compra_combustibles_detalles AS OCCD
								         INNER JOIN ordenes_compra_combustibles AS OCC ON OCCD.orden_compra_combustible_id = OCC.orden_compra_combustible_id
								         $strRestriccionesEstatusOrdenCompra)  AS OrdenDetalles ON OrdenDetalles.referenciaID = VG.vale_gasolina_id";

		$queryValesGasolina .= " WHERE  $strRestriccionesOrdenCompra "; 

		//Si no existe id de la orden de compra
		if($intOrdenCompraCombustibleID === NULL)
		{

			$queryValesGasolina .= " AND  VG.estatus = 'ACTIVO'";
			$queryValesGasolina .= $strRestriccionesProveedor;

		}

		$strSQL = $this->db->query($queryValesGasolina);
		return $strSQL->result();
	}
}
?>