<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Entradas_maquinaria_compra_model extends CI_model {

	//Método para guardar un registro nuevo
	public function guardar($strFolio, $objEntradaCompra)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        
		//Variable que se utiliza para asignar el id del nuevo registro
		$intMovimientoMaquinariaID = 0;

		//Tabla movimientos_maquinaria
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $strFolio); 

		if($objEntradaCompra->intChoferID == '' || $objEntradaCompra->intChoferID == 'NaN'){ 
			$intChoferID = NULL; 
		}
		else{
			$intChoferID = $objEntradaCompra->intChoferID;
		}

		if($objEntradaCompra->intVehiculoID == '' || $objEntradaCompra->intVehiculoID == 'NaN'){ 
			$intVehiculoID = NULL; 
		}
		else{
			$intVehiculoID = $objEntradaCompra->intVehiculoID;
		}

		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $this->session->userdata('sucursal_id'),
						  'tipo_movimiento' => mb_strtoupper($objEntradaCompra->strTipoMovimiento),
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => mb_strtoupper($objEntradaCompra->strFecha),  
						  'moneda_id' => mb_strtoupper($objEntradaCompra->intMonedaID), 
						  'tipo_cambio' => mb_strtoupper($objEntradaCompra->numTipoCambio), 
						  'referencia_id'=> mb_strtoupper($objEntradaCompra->intReferenciaID),
						  'chofer_id' => $intChoferID, 
						  'vehiculo_id' => $intVehiculoID, 
						  'observaciones' => mb_strtoupper($objEntradaCompra->strObservaciones),
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('movimientos_maquinaria', $arrDatos);
		//Asignar id del nuevo registro en la base de datos
		$intMovimientoMaquinariaID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la entrada por compra
		$this->guardar_maquinaria_detalles($intMovimientoMaquinariaID, $objEntradaCompra->arrMaquinarias);
		
		//Hacer un llamado al método guardar maquinaria_inventario
		$this->guardar_maquinaria_inventario($intMovimientoMaquinariaID, $this->session->userdata('sucursal_id'), $objEntradaCompra->arrMaquinarias);
		
		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intMovimientoMaquinariaID.'_'.$strFolioConsecutivo;
		
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar($intMovimientoMaquinariaID, $objEntradaCompra)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $this->session->userdata('sucursal_id'),
						  'tipo_movimiento' => $objEntradaCompra->strTipoMovimiento,
						  'fecha' => mb_strtoupper($objEntradaCompra->strFecha),  
						  'moneda_id' => mb_strtoupper($objEntradaCompra->intMonedaID), 
						  'tipo_cambio' => mb_strtoupper($objEntradaCompra->numTipoCambio), 
						  'referencia_id'=> $objEntradaCompra->intReferenciaID,
						  'chofer_id' => $objEntradaCompra->intChoferID, 
						  'vehiculo_id' => $objEntradaCompra->intVehiculoID, 
						  'observaciones' => mb_strtoupper($objEntradaCompra->strObservaciones),
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('movimiento_maquinaria_id', $intMovimientoMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_maquinaria', $arrDatos);

		//Es necesario primeramente eliminar el registro en Inventario asociado previamente a las maquinarias correspondientes
		$otdDetalles = $this->buscar_detalles($intMovimientoMaquinariaID);

		if($otdDetalles){

			//Eliminar los detalles del movimiento en la tabla: movimientos_maquinaria_detalles
			$this->db->where('movimiento_maquinaria_id', $intMovimientoMaquinariaID);
			$this->db->delete('movimientos_maquinaria_detalles');	

			//Eliminamos las MAQUINARIAS asociadas a la sucursal_id, maquinaria_descripcion_id y serie de la tabla: maquinaria_inventario
			for ($intCon = 0; $intCon < sizeof($otdDetalles); $intCon++) 
			{	

				//Asignar datos al array
				$this->db->where('estatus', 'ACTIVO');				
				$this->db->where('sucursal_id', $objEntradaCompra->intSucursalID);
				$this->db->where('maquinaria_descripcion_id', $otdDetalles[$intCon]->maquinaria_descripcion_id);
				$this->db->where('serie', $otdDetalles[$intCon]->serie);
				$this->db->delete('maquinaria_inventario');	

				$this->db->where('serie', $otdDetalles[$intCon]->serie);
				$this->db->delete('maquinaria_inventario_aditamentos');

			}
			
		}
	
		//Hacer un llamado al método para guardar los detalles de la entrada por compra
		$this->guardar_maquinaria_detalles($intMovimientoMaquinariaID, $objEntradaCompra->arrMaquinarias);

		//Hacer un llamado al método guardar maquinaria_inventario
		$this->guardar_maquinaria_inventario($intMovimientoMaquinariaID, $this->session->userdata('sucursal_id'), $objEntradaCompra->arrMaquinarias);
		
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
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
								  'descripcion' => mb_strtoupper($arrMaquinarias[$intCon]->strDescripcion),
								  'serie' => mb_strtoupper($arrMaquinarias[$intCon]->strSerie),
								  'motor' => mb_strtoupper($arrMaquinarias[$intCon]->strMotor)
								);
				//Guardar los datos del registro
				$this->db->insert('movimientos_maquinaria_detalles', $arrDatos);

				//Limpiamos la tabla de ADITAMENTOS: 
				$this->db->where('serie', $arrMaquinarias[$intCon]->strSerie);
				$this->db->delete('maquinaria_inventario_aditamentos');

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
								  'numero_pedimento' => mb_strtoupper($arrMaquinarias[$intCon]->strPedimento),
								  'consignacion' => $arrMaquinarias[$intCon]->strConsignacion,
								  'entrada_id' => $intMovimientoMaquinariaID,
								  'fecha_creacion' => date("Y-m-d H:i:s"),
						  		  'usuario_creacion' => $this->session->userdata('usuario_id'));
				//Guardar los datos del registro
				$this->db->insert('maquinaria_inventario', $arrDatos);
				
				//Hacer un llamado al método guardar maquinaria_inventario_aditamentos
				//Validar que el registro cuente con Aditamentos
				if(sizeof($arrMaquinarias[$intCon]->arrAditamentos) > 0)
				{
					
					$this->guardar_maquinaria_inventario_aditamentos($arrMaquinarias[$intCon]->arrAditamentos, $arrMaquinarias[$intCon]->strSerie);
				}


			}

			

		}
	}

	//Función que se utiliza para guardar los detalles maquinaria_inventario
	public function guardar_maquinaria_inventario_aditamentos($arrAditamentos, $strSerie)
	{

		//Hacer recorrido para insertar los datos en la tabla maquinaria_inventario_aditamentos
		for ($intCon = 0; $intCon < sizeof($arrAditamentos); $intCon++) 
		{	
			//Asignar datos al array
			$arrDatos = array('serie' => mb_strtoupper($strSerie),
				   			  'renglon' => mb_strtoupper($arrAditamentos[$intCon]->intRenglon + 1),
							  'cantidad' => mb_strtoupper($arrAditamentos[$intCon]->intCantidad),
							  'descripcion' => mb_strtoupper($arrAditamentos[$intCon]->strDescripcion)
							);
			//Guardar los datos del registro
			$this->db->insert('maquinaria_inventario_aditamentos', $arrDatos);
		}
	}


	/*Método para regresar los registros que coincidan con la serie proporcionada
	 *(se utiliza en el reporte de rastreo de series)*/
	public function buscar_serie($strSerie)
	{
		

		//Variable que se utiliza para formar la  consulta
		$querySerie = '';

		//Variables para definir que tipos de módulo se incluiran en la búsqueda
		//Inventario inicial de maquinaria
		$queryInventarioInicial = "SELECT 'INVENTARIO INICIAL' AS tipo_referencia, '0000000001' AS folio, 
										   '2019-01-01' AS fecha, '2000-01-01' AS fecha_creacion, 
	   										'01/01/2019' AS fecha_format, 
	   									  'INVENTARIO INICIAL' AS tipo_movimiento,  'ACTIVO' AS estatus, 
	   									  S.nombre AS sucursal
	   								   FROM maquinaria_inventario AS MI 
									   INNER JOIN sucursales AS S ON MI.sucursal_id = S.sucursal_id
									   WHERE MI.entrada_id = 1
									   AND MI.serie = '$strSerie'";

		//Movimientos de maquinaria
		$queryMovimientosMaquinaria = "SELECT 'MOVIMIENTO' AS tipo_referencia, MM.folio, 
											   MM.fecha, MM.fecha_creacion, 
	   										   DATE_FORMAT(MM.fecha,'%d/%m/%Y') AS fecha_format, 
	   										   MM.tipo_movimiento,  MM.estatus, S.nombre AS sucursal
	   								   FROM movimientos_maquinaria AS MM 
									   INNER JOIN sucursales AS S ON MM.sucursal_id = S.sucursal_id
									   INNER JOIN movimientos_maquinaria_detalles AS MMD ON MM.movimiento_maquinaria_id =  MMD.movimiento_maquinaria_id
									   WHERE MMD.serie = '$strSerie'";

		//Facturas de maquinaria
		$queryFacturasMaquinaria = "SELECT 'FACTURA MAQUINARIA' AS tipo_referencia, FM.folio, 
										    FM.fecha, FM.fecha_creacion, 
	   									    DATE_FORMAT(FM.fecha,'%d/%m/%Y') AS fecha_format, 
	  										'FACTURA DE MAQUINARIA' AS tipo_movimiento,  
	  										FM.estatus, S.nombre AS sucursal
								    FROM facturas_maquinaria AS FM 
									INNER JOIN sucursales AS S ON FM.sucursal_id = S.sucursal_id
									LEFT JOIN facturas_maquinaria_detalles AS FMD ON FM.factura_maquinaria_id =  FMD.factura_maquinaria_id
									WHERE (FM.serie = '$strSerie' OR FMD.serie = '$strSerie')";

		//Ordenes de reparación
		$queryOrdenesReparacion = "SELECT 'ORDEN DE TRABAJO' AS tipo_referencia, OT.folio, 
										   OT.fecha, OT.fecha_creacion, 
	   									   DATE_FORMAT(OT.fecha,'%d/%m/%Y') AS fecha_format, 
	   									  ST.descripcion AS tipo_movimiento,  OT.estatus, S.nombre AS sucursal
									FROM ordenes_reparacion AS OT 
									INNER JOIN sucursales AS S ON OT.sucursal_id = S.sucursal_id
									INNER JOIN servicios_tipos AS ST ON OT.servicio_tipo_id = ST.servicio_tipo_id
									WHERE OT.serie = '$strSerie'";

		//Ordenes de reparación interna
		$queryOrdenesReparacionInterna = "SELECT 'ORDEN DE TRABAJO INTERNA' AS tipo_referencia, OTI.folio, 
											      OTI.fecha, OTI.fecha_creacion, 
	  											  DATE_FORMAT(OTI.fecha,'%d/%m/%Y') AS fecha_format, 
	  										      STI.descripcion AS tipo_movimiento,  OTI.estatus, 
	  										      S.nombre AS sucursal
										  FROM ordenes_reparacion_internas AS OTI 
										  INNER JOIN sucursales AS S ON OTI.sucursal_id = S.sucursal_id
										  INNER JOIN servicios_internos_tipos AS STI ON OTI.servicio_interno_tipo_id = STI.servicio_interno_tipo_id
										  WHERE OTI.serie = '$strSerie'";

		//Formar consulta
		$querySerie .= $queryInventarioInicial;
	    $querySerie .= " UNION ";
		$querySerie .= $queryMovimientosMaquinaria;
	    $querySerie .= " UNION ";
		$querySerie .= $queryFacturasMaquinaria;
		$querySerie .= " UNION ";
		$querySerie .= $queryOrdenesReparacion;
		$querySerie .= " UNION ";
		$querySerie .= $queryOrdenesReparacionInterna;
		$querySerie .= " ORDER BY fecha, fecha_creacion, folio";

		$strSQL = $this->db->query($querySerie);
		return $strSQL->result();

	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMovimientoMaquinariaID = NULL,  $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		$this->db->select("MM.movimiento_maquinaria_id,
							MM.sucursal_id, 
							MM.tipo_movimiento, 
							MM.folio, 
							DATE_FORMAT(MM.fecha, '%d/%m/%Y') AS fecha,
							OCM.folio AS folio_orden_compra,
							OCM.proveedor_id,
							CONCAT(P.codigo, ' - ', P.nombre_comercial) AS proveedor, 
							MM.moneda_id, 
							MM.tipo_cambio, 
							MM.referencia_id,
							MM.chofer_id,
							CONCAT(E.codigo, ' - ', E.nombre, ' ', E.apellido_paterno, ' ', E.apellido_materno) AS chofer,
							MM.vehiculo_id,
							CONCAT(V.codigo, ' - ', V.modelo, ' ', V.marca, ' ', V.placas) AS vehiculo, 
							MM.observaciones,
							MM.estatus, 
							MM.fecha_creacion,
							MM.usuario_creacion,
							UC.usuario AS usuario_creacion", FALSE);
	    $this->db->from('movimientos_maquinaria AS MM');
	    $this->db->join('ordenes_compra_maquinaria AS OCM', 'OCM.orden_compra_maquinaria_id = MM.referencia_id','inner');
	    $this->db->join('proveedores AS P', 'P.proveedor_id = OCM.proveedor_id','inner');
	    $this->db->join('vehiculos AS V', 'V.vehiculo_id = MM.vehiculo_id','left');
	    $this->db->join('choferes AS C', 'C.chofer_id = MM.chofer_id','left');
	    $this->db->join('empleados AS E', 'E.empleado_id = C.empleado_id','left');
	    $this->db->join('usuarios AS UC', 'UC.usuario_id = MM.usuario_creacion', 'left');
	    //Si existe id del movimiento
		if($intMovimientoMaquinariaID != NULL)
		{   
			$this->db->where('MM.movimiento_maquinaria_id', $intMovimientoMaquinariaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('MM.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del proveedor
		    if($intProveedorID > 0)
		    {
		   		$this->db->where('OCM.proveedor_id', $intProveedorID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('MM.estatus', $strEstatus);
			}

			$this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
	               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
	           		(OCM.folio LIKE '%$strBusqueda%') )"); 

		    $this->db->order_by('MM.fecha DESC, MM.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL,  $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda = NULL,$intNumRows, $intPos)
	{	

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MM.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del proveedor
		if($intProveedorID != NULL)
		{
	    	$this->db->where("OCM.proveedor_id", $intProveedorID);
	    } 
	    //Si existe rango de fechas
		if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MM.estatus', $strEstatus);
		}
		$this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
		   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
           (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
       		(OCM.folio LIKE '%$strBusqueda%') )"); 

		$this->db->from('movimientos_maquinaria AS MM');
		$this->db->join('ordenes_compra_maquinaria AS OCM', 'OCM.orden_compra_maquinaria_id = MM.referencia_id', 'inner');
		$this->db->join('proveedores AS P', 'P.proveedor_id = OCM.proveedor_id', 'inner');
		$this->db->where('MM.tipo_movimiento', ENTRADA_MAQUINARIA_COMPRA);
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MM.movimiento_maquinaria_id,
						   MM.folio, 
					       DATE_FORMAT(MM.fecha, '%d/%m/%Y') AS fecha,
					       OCM.folio AS folio_orden_compra,
					       CONCAT(P.codigo, ' - ', P.nombre_comercial) AS proveedor,
					       MM.estatus", FALSE);
		$this->db->from('movimientos_maquinaria AS MM');
		$this->db->join('ordenes_compra_maquinaria AS OCM', 'OCM.orden_compra_maquinaria_id = MM.referencia_id', 'inner');
		$this->db->join('proveedores AS P', 'P.proveedor_id = OCM.proveedor_id', 'inner');
		$this->db->where('MM.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MM.tipo_movimiento', ENTRADA_MAQUINARIA_COMPRA);
		//Si existe id del proveedor
		if($intProveedorID != NULL)
		{
	    	$this->db->where("OCM.proveedor_id", $intProveedorID);
	    } 
	    //Si existe rango de fechas
		if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MM.estatus', $strEstatus);
		}

		$this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
	               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
	           		(OCM.folio LIKE '%$strBusqueda%') )"); 

		$this->db->order_by('MM.fecha DESC, MM.folio DESC');
		$this->db->limit($intNumRows, $intPos);		
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
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
						    ML.descripcion AS maquinaria_linea,
							MM.descripcion AS maquinaria_marca,
							MMOD.descripcion AS maquinaria_modelo,
						    MI.numero_pedimento,
						    MI.consignacion, 
						    MI.estatus ');
		$this->db->from('movimientos_maquinaria_detalles MMD');
		$this->db->join('maquinaria_descripciones MD', 'MD.maquinaria_descripcion_id = MMD.maquinaria_descripcion_id', 'inner');	
		$this->db->join('maquinaria_lineas AS ML', 'ML.maquinaria_linea_id = MD.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MM', 'MM.maquinaria_marca_id = MD.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'MMOD.maquinaria_modelo_id = MD.maquinaria_modelo_id', 'inner');
		$this->db->join('maquinaria_inventario MI', 'MI.entrada_id = MMD.movimiento_maquinaria_id AND MMD.serie = MI.serie', 'inner');
		$this->db->where('MMD.movimiento_maquinaria_id', $intMovimientoMaquinariaID);
		$this->db->order_by('MMD.renglon', 'ASC');

		return $this->db->get()->result();
	}

	//Método para regresar los datos de un registro asociados a los posibles ADITAMENTOS adjuntos a una MAQUINARIA
	public function buscar_aditamentos($strSerie)
	{
		$this->db->select('	serie,
							renglon,
							cantidad,
					        descripcion ');
		$this->db->from('maquinaria_inventario_aditamentos');
		$this->db->where('serie', $strSerie);

		return $this->db->get()->result();
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strTipo)
	{
		//Si el Autocomplete es por rastreo de serie
		if($strTipo == 'rastreo_serie') 
		{
			$this->db->select("DISTINCT MMD.serie", FALSE);
	        $this->db->from('movimientos_maquinaria AS MM');
	        $this->db->join('movimientos_maquinaria_detalles AS MMD', 
	        				'MM.movimiento_maquinaria_id = MMD.movimiento_maquinaria_id', 'innner');
			$this->db->where('MM.sucursal_id', $this->session->userdata('sucursal_id'));
	        $this->db->where("(MMD.serie LIKE '%$strDescripcion%')"); 
			$this->db->order_by('MMD.serie', 'ASC');

		}
		else//Autocomplete por Folio
		{
			$this->db->select("movimiento_maquinaria_id, folio, referencia_id", FALSE);
	        $this->db->from('movimientos_maquinaria');
			$this->db->where('estatus', 'ACTIVO');
			$this->db->where('tipo_movimiento', '1');
			$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
	        $this->db->where("(folio LIKE '%$strDescripcion%')"); 
			$this->db->order_by('folio', 'ASC');
		}	

		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
		return $this->db->get()->result();
	}
}
?>