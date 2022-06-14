<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Movimientos_insumos_model extends CI_model {
	/*
	*********************************************************************************************************************
	*********************************************************************************************************************
	FUNCIONES PARA EL PROCESO DE: ENTRADA DE INSUMOS POR COMPRA
	*********************************************************************************************************************
	*********************************************************************************************************************
	*/
	//Método para guardar un registro nuevo
	public function guardar($strFolio,
							$dteFecha, 
						  	$intMonedaID, 
						  	$intTipoCambio,
						  	$intOrdenCompraID,
						  	$intProveedorID,
						  	$strFactura,
						  	$strObservaciones,
						  	$strInsumoID,  
						  	$strCantidades, 
						  	$strPreciosUnitarios, 
						  	$strDescuentosUnitarios, 
						  	$strIvasUnitarios, 
						  	$strIepsUnitarios,
						  	$intTipoMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		//Variable que se utiliza para asignar el id del nuevo registro
		$intEntradaCompraID = 0;

		//Tabla ordenes_compra
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $strFolio); 

		//Asignar datos al array
		$arrDatos = array('tipo_movimiento' => $intTipoMovimiento,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha,  
						  'moneda_id' => $intMonedaID, 
						  'tipo_cambio' => $intTipoCambio, 
						  'orden_compra_id'=> $intOrdenCompraID,
						  'proveedor_id' => $intProveedorID, 
						  'factura' => $strFactura, 
						  'observaciones' => $strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('movimientos_insumos', $arrDatos);
		//Asignar id del nuevo registro en la base de datos
		$intEntradaCompraID  = $this->db->insert_id();
		
		//Hacer un llamado al método para guardar los detalles de la entrada por insumo
		$this->guardar_detalles($this->db->insert_id(),
								$dteFecha,
								$strInsumoID, 
								$strCantidades, 
								$strPreciosUnitarios, 
							    $strDescuentosUnitarios, 
							    $strIvasUnitarios, 
							    $strIepsUnitarios,
							    $intTipoMovimiento);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intEntradaCompraID.'_'.$strFolioConsecutivo;
		
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar($intEntradaCompraID,
							  $dteFecha, 
						  	  $intMonedaID, 
						  	  $intTipoCambio,
						  	  $intOrdenCompraID,
						  	  $intProveedorID,
						  	  $strFactura,
						  	  $strObservaciones,
						  	  $strInsumoID,  
						  	  $strCantidades, 
						  	  $strPreciosUnitarios, 
						  	  $strDescuentosUnitarios, 
						  	  $strIvasUnitarios, 
						  	  $strIepsUnitarios,
						  	  $intTipoMovimiento)
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Obtener el año de la fecha proporcionada
		$strFecha = explode("-", $dteFecha);
		$strAnio = $strFecha[0];

		/*************************************************************************************
		* 1. Modificar el encabezado del movimiento en la tabla movimientos_insumos		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('tipo_movimiento' => $intTipoMovimiento,
						  'fecha' => $dteFecha,  
						  'moneda_id' => $intMonedaID, 
						  'tipo_cambio' => $intTipoCambio, 
						  'orden_compra_id'=> $intOrdenCompraID,
						  'proveedor_id' => $intProveedorID, 
						  'factura' => $strFactura, 
						  'observaciones' => $strObservaciones, 
						  'estatus' => 'ACTIVO', 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('movimiento_insumo_id', $intEntradaCompraID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_insumos', $arrDatos);

		/*************************************************************************************
		* 2. Seleccionar los detalles del movimiento de la tabla movimientos_insumos_detalles		
		**************************************************************************************/
		$arrDetalles = $this->buscar_detalles($intEntradaCompraID);

		/*************************************************************************************
		* 3. Seleccionar existencia y costo inicial por cada registro 
		* de la tabla insumos_inventario		
		**************************************************************************************/
		for($i=0; $i<sizeof($arrDetalles); $i++){

			$insumo_id = $arrDetalles[$i]->insumo_id;
			$objInventario = $this->get_existencia_costo($insumo_id, $strAnio);

			$numExistencia = $objInventario->inicial_existencia;
			$numCosto = $objInventario->inicial_costo;

			$this->db->select('MI.movimiento_insumo_id,
				   			   MI.tipo_movimiento, 
				   			   MI.fecha,
			       			   MIDE.insumo_id,
			       			   MIDE.renglon, 
			       			   MIDE.cantidad, 
			       			   MIDE.precio_unitario');
			$this->db->from('movimientos_insumos MI');
			$this->db->join('movimientos_insumos_detalles MIDE', 'MIDE.movimiento_insumo_id = MI.movimiento_insumo_id', 'inner');
			$this->db->where('MIDE.insumo_id', $insumo_id);
			$this->db->where('MI.fecha >=', $strAnio.'-01-01');
			$this->db->where('MI.fecha <=', $strAnio.'-12-31');
			$this->db->where('MI.estatus !=', 'INACTIVO');
			$this->db->where('MI.movimiento_insumo_id !=', $intEntradaCompraID);
			$this->db->order_by('MI.fecha', 'ASC');
			$arrMovimientos = $this->db->get()->result();
			 
			for($j=0; $j<sizeof($arrMovimientos); $j++){

				if ($arrMovimientos[$j]->tipo_movimiento < 11){

					$numCosto = (($numExistencia * $numCosto) + ($arrMovimientos[$j]->cantidad * $arrMovimientos[$j]->precio_unitario));
	                $numExistencia += $arrMovimientos[$j]->cantidad;
	                if ($numExistencia <> 0){
	                    $numCosto = $numCosto / $numExistencia;
	                }

				}

			}

			/*************************************************************************************
			* 4. Actualizar existencia actual y costo actual por cada registro 
			* de la tabla insumos_inventario		
			**************************************************************************************/
			//Actualizar los datos del registro
			$arrInventario = array('actual_existencia' => $numExistencia,
								   'actual_costo' => $numCosto);
			$this->db->where('anio', $strAnio);
			$this->db->where('insumo_id', $insumo_id);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('insumos_inventario', $arrInventario);

		}

		/*************************************************************************************
		* 5. Eliminar los detalles del movimiento en 
		* la tabla insumos_inventario_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_insumo_id', $intEntradaCompraID);
		$this->db->delete('movimientos_insumos_detalles');

		/*************************************************************************************
		* 6. Guardar detalles del movimiento en 
		* la tabla insumos_inventario_detalles		
		**************************************************************************************/
		//Hacer un llamado al método para guardar los detalles de la entrada por insumo
		$this->guardar_detalles($intEntradaCompraID,
								$dteFecha,
								$strInsumoID, 
								$strCantidades, 
								$strPreciosUnitarios, 
							    $strDescuentosUnitarios, 
							    $strIvasUnitarios, 
							    $strIepsUnitarios,
							    $intTipoMovimiento);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intEntradaCompraID, $strEstatus)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();

		/*************************************************************************************
		* 1. Modificar el encabezado del movimiento en la tabla movimientos_insumos		
		**************************************************************************************/
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

		$this->db->where('movimiento_insumo_id', $intEntradaCompraID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_insumos', $arrDatos);

		/*************************************************************************************
		* 2. Seleccionar los detalles del movimiento de la tabla movimientos_insumos_detalles		
		**************************************************************************************/
		$arrDetalles = $this->buscar_detalles($intEntradaCompraID);

		//Obtener el año de la fecha proporcionada
		$objFecha = $this->get_fecha_movimiento($intEntradaCompraID);
		$strFecha = explode("-", $objFecha->fecha);
		$strAnio = $strFecha[0];

		/*************************************************************************************
		* 3. Seleccionar existencia y costo inicial por cada registro 
		* de la tabla insumos_inventario		
		**************************************************************************************/
		for($i=0; $i<sizeof($arrDetalles); $i++){

			$insumo_id = $arrDetalles[$i]->insumo_id;
			$objInventario = $this->get_existencia_costo($insumo_id, $strAnio);

			$numExistencia = $objInventario->inicial_existencia;
			$numCosto = $objInventario->inicial_costo;

			$this->db->select('MI.movimiento_insumo_id,
				   			   MI.tipo_movimiento, 
				   			   MI.fecha,
			       			   MIDE.insumo_id,
			       			   MIDE.renglon, 
			       			   MIDE.cantidad, 
			       			   MIDE.precio_unitario');
			$this->db->from('movimientos_insumos MI');
			$this->db->join('movimientos_insumos_detalles MIDE', 'MIDE.movimiento_insumo_id = MI.movimiento_insumo_id', 'inner');
			$this->db->where('MIDE.insumo_id', $insumo_id);
			$this->db->where('MI.fecha >=', $strAnio.'-01-01');
			$this->db->where('MI.fecha <=', $strAnio.'-12-31');
			$this->db->where('MI.estatus !=', 'INACTIVO');
			$this->db->where('MI.movimiento_insumo_id !=', $intEntradaCompraID);
			$this->db->order_by('MI.fecha', 'ASC');
			$arrMovimientos = $this->db->get()->result();
			 
			for($j=0; $j<sizeof($arrMovimientos); $j++){

				if ($arrMovimientos[$j]->tipo_movimiento < 11){

					$numCosto = (($numExistencia * $numCosto) + ($arrMovimientos[$j]->cantidad * $arrMovimientos[$j]->precio_unitario));
	                $numExistencia += $arrMovimientos[$j]->cantidad;
	                if ($numExistencia <> 0){
	                    $numCosto = $numCosto / $numExistencia;
	                }

				}
				else{

					$numCosto = (($numExistencia * $numCosto) - ($arrMovimientos[$j]->cantidad * $arrMovimientos[$j]->precio_unitario));
					$numExistencia -= $arrMovimientos[$j]->cantidad;
					if ($numExistencia <> 0){
						$numCosto = $numCosto / $numExistencia;
					}

				}

			}

			/*************************************************************************************
			* 4. Actualizar existencia actual y costo actual por cada registro 
			* de la tabla insumos_inventario		
			**************************************************************************************/
			//Actualizar los datos del registro
			$arrInventario = array('actual_existencia' => $numExistencia,
								   'actual_costo' => $numCosto);
			$this->db->where('anio', $strAnio);
			$this->db->where('insumo_id', $insumo_id);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('insumos_inventario', $arrInventario);

		}

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMovimientoInsumoID = NULL, $intTipoMovimiento = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProveedorID = NULL){
		
		$this->db->select("	MI.movimiento_insumo_id,
						    MI.folio,
						    DATE_FORMAT(MI.fecha, '%d/%m/%Y') AS fecha,
						    MI.moneda_id,
						    MI.tipo_cambio,
						    MI.orden_compra_id,
						    (SELECT folio FROM ordenes_compra WHERE orden_compra_id = MI.orden_compra_id) AS ordenCompraFolio,
						    MI.proveedor_id,
						    CONCAT_WS(' - ', P.codigo, P.nombre_comercial) AS proveedor,
						    P.correo_electronico,
						    P.rfc, 
						    P.telefono_principal,  
						    P.calle, 
						    P.numero_exterior, 
						    P.numero_interior, 
						    P.colonia,  
						    L.descripcion AS localidad, 
						    MP.descripcion AS municipio, 
						    EP.descripcion AS estado,
						    CP.codigo_postal, 
						    M.codigo AS moneda,
						    MI.factura,
						    MI.evento_id,
						    E.descripcion AS evento,
						    MI.sucursal_id,
						    S.nombre AS sucursal,
						    MI.empleado_id,
						    CONCAT_WS(' ', EMP.nombre, EMP.apellido_paterno, EMP.apellido_materno) AS empleado,
						    MI.observaciones,
						    MI.estatus, 
						    UC.usuario AS usuario_creacion", FALSE);
	    $this->db->from('movimientos_insumos MI');
	    $this->db->join('sat_monedas AS M', 'MI.moneda_id = M.moneda_id', 'left');
	    $this->db->join('proveedores P', 'P.proveedor_id = MI.proveedor_id', 'left');
	    $this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'left');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'left');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'left');
		$this->db->join('usuarios AS UC', 'MI.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('eventos AS E', 'E.evento_id = MI.evento_id', 'left');
		$this->db->join('sucursales AS S', 'S.sucursal_id = MI.sucursal_id', 'left');
		$this->db->join('empleados AS EMP', 'EMP.empleado_id = MI.empleado_id', 'left');
	    $this->db->where('MI.tipo_movimiento', $intTipoMovimiento);
	    $this->db->order_by('MI.folio', 'DESC');

		//Si existe id de la orden de compra
		if ($intMovimientoInsumoID != NULL)
		{   
			$this->db->where('MI.movimiento_insumo_id', $intMovimientoInsumoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			//Si existe id del proveedor
		    if($intProveedorID > 0)
		    {
		   		$this->db->where('MI.proveedor_id', $intProveedorID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("(MI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 
			return $this->db->get()->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL,  
										     $intProveedorID = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;
        
		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('movimientos_insumos AS MI');
		$this->db->join('sat_monedas AS M', 'MI.moneda_id = M.moneda_id', 'inner');
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del proveedor
	    if($intProveedorID > 0)
	    {
	   		$this->db->where('MI.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("(MI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL,  
    					   $intProveedorID = NULL, 
    					   $intTipoMovimiento, 
    					   $intNumRows, 
    					   $intPos)
	{
		
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MI.tipo_movimiento', $intTipoMovimiento);
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("DATE(MI.fecha) BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    if($intProveedorID != 0){
	    	$this->db->where("MI.proveedor_id", $intProveedorID);
	    } 
		$this->db->from('movimientos_insumos MI');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MI.movimiento_insumo_id, 
						   MI.folio, 
					       DATE_FORMAT(MI.fecha, '%d/%m/%Y') AS fecha,
					       P.proveedor_id,
					       P.nombre_comercial AS proveedor,
					       MI.estatus");
		$this->db->from('movimientos_insumos MI');
		$this->db->join('proveedores P', 'P.proveedor_id = MI.proveedor_id', 'left');
	    $this->db->where('MI.tipo_movimiento', $intTipoMovimiento); 
	    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("DATE(MI.fecha) BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    if($intProveedorID != 0){
	    	$this->db->where("MI.proveedor_id", $intProveedorID);
	    } 
		$this->db->order_by('MI.folio', 'DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		
		return $arrResultado;
	
	}

	/*******************************************************************************************************************
	Funciones de la tabla movimientos_insumos_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la orden de compra
	public function guardar_detalles($intEntradaCompraID,
									$dteFecha, 
									$strInsumoID, 
								  	$strCantidades, 
								  	$strPreciosUnitarios, 
								  	$strDescuentosUnitarios, 
								  	$strIvasUnitarios, 
								  	$strIepsUnitarios,
								  	$intTipoMovimiento)
	{
		/*Quitar | de la lista para obtener el concepto, cantidad, precio unitario, descuento unitario, 
		  iva unitario e ieps unitario
		*/
		$strFecha = explode("-", $dteFecha);
		$strAnio = $strFecha[0];

		$arrInsumoID = explode("|", $strInsumoID);
		$arrCantidades = explode("|", $strCantidades);
		$arrPreciosUnitarios = explode("|", $strPreciosUnitarios);
		$arrDescuentosUnitarios = explode("|", $strDescuentosUnitarios);
		$arrIvasUnitarios = explode("|", $strIvasUnitarios);
		$arrIepsUnitarios = explode("|", $strIepsUnitarios);

		//Hacer recorrido para insertar los datos en la tabla ordenes_compra_detalles
		for ($intCon = 0; $intCon < sizeof($arrInsumoID); $intCon++) 
		{
			//Obtener el ID correspondiente a ese concepto (INSUMO)
			$intInsumoID = $arrInsumoID[$intCon];
			$numCantidad = $arrCantidades[$intCon];
			$numCosto = $arrPreciosUnitarios[$intCon];
			$numDescuento = $arrDescuentosUnitarios[$intCon];
			$numIVA = $arrIvasUnitarios[$intCon];
			$numIEPS = $arrIepsUnitarios[$intCon];
			//Asignar datos al array
			$arrDatos = array('movimiento_insumo_id' => $intEntradaCompraID,
							  'renglon' => ($intCon + 1),
							  'insumo_id' => $intInsumoID, 
							  'cantidad' => $numCantidad,
							  'precio_unitario' => $numCosto,
							  'descuento_unitario' => $numDescuento,
							  'iva_unitario' => $numIVA, 
							  'ieps_unitario' => $numIEPS);
			//Guardar los datos del registro
			$this->db->insert('movimientos_insumos_detalles', $arrDatos);

			//Actualizar existencia del insumo en inventario
			$objInventario = $this->get_existencia_costo($intInsumoID, $strAnio);
			$numExistencia = $objInventario->actual_existencia;
			$numCostoActual = $objInventario->actual_costo;
			//Si el movimiento es de entrada a Almacén			
			if (($numExistencia + $numCantidad) != 0){
				$numCostoActual = (($numCostoActual * $numExistencia) + ($numCosto * $numCantidad)) / ($numExistencia + $numCantidad);
			}
			else{
				$numCostoActual = $numCosto;
			}
			$numExistencia += $numCantidad;

			//Actualizar los datos del registro
			$arrInventario = array('actual_existencia' => $numExistencia,
								   'actual_costo' => $numCostoActual);
			$this->db->where('anio', $strAnio);
			$this->db->where('insumo_id', $intInsumoID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('insumos_inventario', $arrInventario);

		}
	}

	public function get_fecha_movimiento($intEntradaCompraID){
		$this->db->select('fecha');
		$this->db->from('movimientos_insumos');
		$this->db->where('movimiento_insumo_id', $intEntradaCompraID);
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	//Función para buscar la existencia y costo actual para un insumo
	public function get_existencia_costo($intInsumoID, $strAnio){

		$this->db->select('inicial_existencia, 
						   inicial_costo, 
						   actual_existencia, 
						   actual_costo');
		$this->db->from('insumos_inventario');
		$this->db->where('anio', $strAnio);
		$this->db->where('insumo_id', $intInsumoID);
		$this->db->limit(1);
		
		return $this->db->get()->row();
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intMovimientoInsumoID)
	{
		$this->db->select('	MI.renglon,
							MI.insumo_id,
							I.descripcion,
					        MI.cantidad,
					        MI.precio_unitario,
					        MI.descuento_unitario,
					        MI.iva_unitario,
					        MI.ieps_unitario');
		$this->db->from('movimientos_insumos_detalles MI');
		$this->db->join('insumos I', 'I.insumo_id = MI.insumo_id', 'left');
		$this->db->where('MI.movimiento_insumo_id', $intMovimientoInsumoID);
		$this->db->order_by('MI.renglon', 'ASC');
		return $this->db->get()->result();
	}

	public function get_rfc($intSucursalID){

		$this->db->select('E.rfc');
		$this->db->from('sucursales S');
		$this->db->join('empresas E', 'E.empresa_id = S.empresa_id', 'inner');
		$this->db->where('S.sucursal_id', $intSucursalID);
		$this->db->limit(1);
		return $this->db->get()->row();
		
	}

	/*
	*********************************************************************************************************************
	*********************************************************************************************************************
	FUNCIONES PARA EL PROCESO DE: SALIDA DE INSUMOS A EVENTO
	*********************************************************************************************************************
	*********************************************************************************************************************
	*/
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_salida_evento($dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL,  
    					   $intEventoID = NULL, 
    					   $intTipoMovimiento, 
    					   $intNumRows, 
    					   $intPos)
	{
		
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MI.tipo_movimiento', $intTipoMovimiento); 
		$this->db->from('movimientos_insumos MI');
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("DATE(MI.fecha) BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    if($intEventoID != 0){
	    	$this->db->where("MI.evento_id", $intEventoID);
	    } 
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MI.movimiento_insumo_id, 
						   MI.folio, 
					       DATE_FORMAT(MI.fecha, '%d/%m/%Y') AS fecha,
					       E.descripcion AS evento,
					       MI.estatus");
		$this->db->from('movimientos_insumos MI');
		$this->db->join('eventos E', 'E.evento_id = MI.evento_id', 'inner');
	    $this->db->where('MI.tipo_movimiento', $intTipoMovimiento); 
	    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("DATE(MI.fecha) BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    if($intEventoID != 0){
	    	$this->db->where("MI.evento_id", $intEventoID);
	    } 
		$this->db->order_by('MI.folio', 'DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		
		return $arrResultado;
	
	}

	//Método para guardar un registro nuevo
	public function guardar_salida_evento($strFolio,
										  $dteFecha, 
										  $intEventoID,
										  $intSucursalID,
										  $intEmpleadoID,
										  $strObservaciones,
										  $strInsumoID,  
										  $strCantidades, 
										  $strPreciosUnitarios,
										  $intTipoMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		//Variable que se utiliza para asignar el id del nuevo registro
		$intSalidaInsumosEventosID = 0;

		//Tabla ordenes_compra
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $strFolio); 

		//Asignar datos al array
		$arrDatos = array('tipo_movimiento' => $intTipoMovimiento,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha,  
						  'evento_id' => $intEventoID, 
						  'sucursal_id' => $intSucursalID, 
						  'empleado_id'=> $intEmpleadoID,
						  'observaciones' => $strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('movimientos_insumos', $arrDatos);
		//Asignar id del nuevo registro en la base de datos
		$intSalidaInsumosEventosID  = $this->db->insert_id();
		
		//Hacer un llamado al método para guardar los detalles de la entrada por insumo
		$this->guardar_detalles_salida_evento($this->db->insert_id(),
								$dteFecha,
								$strInsumoID, 
								$strCantidades, 
								$strPreciosUnitarios,
							    $intTipoMovimiento);
		
		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intSalidaInsumosEventosID.'_'.$strFolioConsecutivo;
		
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_salida_evento($intSalidaInsumosEventosID,
							  				$dteFecha, 
										  	$intEventoID,
										  	$intSucursalID,
										  	$intEmpleadoID,
										  	$strObservaciones,
										  	$strInsumoID,  
										  	$strCantidades, 
										  	$strPreciosUnitarios,
										  	$intTipoMovimiento)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();

		//Obtener el año de la fecha proporcionada
		$strFecha = explode("-", $dteFecha);
		$strAnio = $strFecha[0];

		/*************************************************************************************
		* 1. Modificar el encabezado del movimiento en la tabla movimientos_insumos		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('tipo_movimiento' => $intTipoMovimiento,
						  'fecha' => $dteFecha,  
						  'evento_id' => $intEventoID, 
						  'sucursal_id' => $intSucursalID, 
						  'empleado_id'=> $intEmpleadoID,
						  'observaciones' => $strObservaciones,
						  'estatus' => 'ACTIVO', 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));

		$this->db->where('movimiento_insumo_id', $intSalidaInsumosEventosID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_insumos', $arrDatos);

		/*************************************************************************************
		* 2. Seleccionar los detalles del movimiento de la tabla movimientos_insumos_detalles		
		**************************************************************************************/
		$arrDetalles = $this->buscar_detalles($intSalidaInsumosEventosID);

		/*************************************************************************************
		* 3. Seleccionar existencia y costo inicial por cada registro 
		* de la tabla insumos_inventario		
		**************************************************************************************/
		for($i=0; $i<sizeof($arrDetalles); $i++){

			$insumo_id = $arrDetalles[$i]->insumo_id;
			$objInventario = $this->get_existencia_costo($insumo_id, $strAnio);

			$numExistencia = $objInventario->inicial_existencia;
			$numCosto = $objInventario->inicial_costo;

			$this->db->select('MI.movimiento_insumo_id,
				   			   MI.tipo_movimiento, 
				   			   MI.fecha,
			       			   MIDE.insumo_id,
			       			   MIDE.renglon, 
			       			   MIDE.cantidad, 
			       			   MIDE.precio_unitario');
			$this->db->from('movimientos_insumos MI');
			$this->db->join('movimientos_insumos_detalles MIDE', 'MIDE.movimiento_insumo_id = MI.movimiento_insumo_id', 'inner');
			$this->db->where('MIDE.insumo_id', $insumo_id);
			$this->db->where('MI.fecha >=', $strAnio.'-01-01');
			$this->db->where('MI.fecha <=', $strAnio.'-12-31');
			$this->db->where('MI.estatus !=', 'INACTIVO');
			$this->db->where('MI.movimiento_insumo_id !=', $intSalidaInsumosEventosID);
			$this->db->order_by('MI.fecha', 'ASC');
			$arrMovimientos = $this->db->get()->result();
			 
			for($j=0; $j<sizeof($arrMovimientos); $j++){

				if ($arrMovimientos[$j]->tipo_movimiento >= 11){

	                $numCosto = (($numExistencia * $numCosto) - ($arrMovimientos[$j]->cantidad * $arrMovimientos[$j]->precio_unitario));
					$numExistencia -= $arrMovimientos[$j]->cantidad;
					if ($numExistencia <> 0){
						$numCosto = $numCosto / $numExistencia;
					}

				}

			}

			/*************************************************************************************
			* 4. Actualizar existencia actual y costo actual por cada registro 
			* de la tabla insumos_inventario		
			**************************************************************************************/
			//Actualizar los datos del registro
			$arrInventario = array('actual_existencia' => $numExistencia,
								   'actual_costo' => $numCosto);
			$this->db->where('anio', $strAnio);
			$this->db->where('insumo_id', $insumo_id);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('insumos_inventario', $arrInventario);

		}

		/*************************************************************************************
		* 5. Eliminar los detalles del movimiento en 
		* la tabla insumos_inventario_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_insumo_id', $intSalidaInsumosEventosID);
		$this->db->delete('movimientos_insumos_detalles');

		/*************************************************************************************
		* 6. Guardar detalles del movimiento en 
		* la tabla insumos_inventario_detalles		
		**************************************************************************************/
		//Hacer un llamado al método para guardar los detalles de la entrada por insumo
		$this->guardar_detalles_salida_evento($intSalidaInsumosEventosID,
								$dteFecha,
								$strInsumoID, 
								$strCantidades, 
								$strPreciosUnitarios,
							    $intTipoMovimiento);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}

	//Función que se utiliza para guardar los detalles de la orden de compra
	public function guardar_detalles_salida_evento($intSalidaInsumosEventosID,
									$dteFecha, 
									$strInsumoID, 
								  	$strCantidades, 
								  	$strPreciosUnitarios, 
								  	$intTipoMovimiento)
	{
		/*Quitar | de la lista para obtener el concepto, cantidad, precio unitario, descuento unitario, 
		  iva unitario e ieps unitario
		*/
		$strFecha = explode("-", $dteFecha);
		$strAnio = $strFecha[0];

		$arrInsumoID = explode("|", $strInsumoID);
		$arrCantidades = explode("|", $strCantidades);
		$arrPreciosUnitarios = explode("|", $strPreciosUnitarios);
		
		//Hacer recorrido para insertar los datos en la tabla movimientos_insumos_detalles
		for ($intCon = 0; $intCon < sizeof($arrInsumoID); $intCon++) 
		{
			//Obtener el ID correspondiente a ese concepto (INSUMO)
			$intInsumoID = $arrInsumoID[$intCon];
			$numCantidad = $arrCantidades[$intCon];
			$numCosto = $arrPreciosUnitarios[$intCon];
			//Asignar datos al array
			$arrDatos = array('movimiento_insumo_id' => $intSalidaInsumosEventosID,
							  'renglon' => ($intCon + 1),
							  'insumo_id' => $intInsumoID, 
							  'cantidad' => $numCantidad,
							  'precio_unitario' => $numCosto);
			//Guardar los datos del registro
			$this->db->insert('movimientos_insumos_detalles', $arrDatos);

			//Actualizar existencia del insumo en inventario
			$objInventario = $this->get_existencia_costo($intInsumoID, $strAnio);
			$numExistencia = $objInventario->actual_existencia;
			$numCostoActual = $objInventario->actual_costo;
			//Si el movimiento es de salida a Almacén
			if (($numExistencia - $numCantidad) != 0){
				$numCostoActual = (($numCostoActual * $numExistencia) - ($numCosto * $numCantidad)) / ($numExistencia - $numCantidad);
			}
			else{
				$numCostoActual = $numCosto;
			}
			$numExistencia -= $numCantidad;			
			
			//Actualizar los datos del registro
			$arrInventario = array('actual_existencia' => $numExistencia);
			$this->db->where('anio', $strAnio);
			$this->db->where('insumo_id', $intInsumoID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('insumos_inventario', $arrInventario);

		}
	}

	//Método para verificar si la salida de insumos a evento puede ser modificada o desactivada
	public function validar_salida($intMovimientoInsumoID){
		
		$this->db->select("MI2.folio", FALSE);
		$this->db->from('movimientos_insumos MI1');
		$this->db->join('movimientos_insumos MI2', 'MI2.movimiento_insumo_referencia_id = MI1.movimiento_insumo_id', 'left');
		$this->db->where('MI1.movimiento_insumo_id', $intMovimientoInsumoID);
		$this->db->where('MI1.tipo_movimiento', '11');
		$this->db->where('MI2.tipo_movimiento', '2');
		$this->db->limit(1);
		
		return $this->db->get()->row();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_salida_evento($intMovimientoInsumoID = NULL, $intTipoMovimiento = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, $intEventoID = NULL){
		
		$this->db->select("	MI.movimiento_insumo_id,
						    MI.folio,
						    DATE_FORMAT(MI.fecha, '%d/%m/%Y') AS fecha, 
						    MI.factura,
						    MI.evento_id,
						    E.descripcion AS evento,
						    L.descripcion AS localidad,
						    MP.descripcion AS municipio,
						    EST.descripcion AS estado,
						    MI.sucursal_id,
						    S.nombre AS sucursal,
						    MI.empleado_id,
						    CONCAT_WS(' ', EMP.nombre, EMP.apellido_paterno, EMP.apellido_materno) AS responsable,
						    MI.observaciones,
						    MI.estatus, 
						    UC.usuario AS usuario_creacion", FALSE);
	    $this->db->from('movimientos_insumos MI');
		$this->db->join('usuarios AS UC', 'MI.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('eventos AS E', 'E.evento_id = MI.evento_id', 'left');
		$this->db->join('localidades AS L', 'L.localidad_id = E.localidad_id', 'left');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'left');
		$this->db->join('sat_estados AS EST', 'MP.estado_id = EST.estado_id', 'left');
		$this->db->join('sucursales AS S', 'S.sucursal_id = MI.sucursal_id', 'left');
		$this->db->join('empleados AS EMP', 'EMP.empleado_id = MI.empleado_id', 'left');
	    $this->db->where('MI.tipo_movimiento', $intTipoMovimiento);
	    $this->db->order_by('MI.folio', 'DESC');

		//Si existe id de la orden de compra
		if ($intMovimientoInsumoID != NULL)
		{   
			$this->db->where('MI.movimiento_insumo_id', $intMovimientoInsumoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			//Si existe id del evento
		    if($intEventoID > 0)
		    {
		   		$this->db->where('MI.evento_id', $intEventoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("(MI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 
			return $this->db->get()->result();
		}
	}

	//Método para modificar el estatus de un registro
	public function set_estatus_salida_evento($intSalidaInsumosEventosID, $strEstatus)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();

		/*************************************************************************************
		* 1. Modificar el encabezado del movimiento en la tabla movimientos_insumos		
		**************************************************************************************/
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

		$this->db->where('movimiento_insumo_id', $intSalidaInsumosEventosID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_insumos', $arrDatos);

		/*************************************************************************************
		* 2. Seleccionar los detalles del movimiento de la tabla movimientos_insumos_detalles		
		**************************************************************************************/
		$arrDetalles = $this->buscar_detalles($intSalidaInsumosEventosID);

		//Obtener el año de la fecha proporcionada
		$objFecha = $this->get_fecha_movimiento($intSalidaInsumosEventosID);
		$strFecha = explode("-", $objFecha->fecha);
		$strAnio = $strFecha[0];

		/*************************************************************************************
		* 3. Seleccionar existencia y costo inicial por cada registro 
		* de la tabla insumos_inventario		
		**************************************************************************************/
		for($i=0; $i<sizeof($arrDetalles); $i++){

			$insumo_id = $arrDetalles[$i]->insumo_id;
			$objInventario = $this->get_existencia_costo($insumo_id, $strAnio);

			$numExistencia = $objInventario->inicial_existencia;
			$numCosto = $objInventario->inicial_costo;

			$this->db->select('MI.movimiento_insumo_id,
				   			   MI.tipo_movimiento, 
				   			   MI.fecha,
			       			   MIDE.insumo_id,
			       			   MIDE.renglon, 
			       			   MIDE.cantidad, 
			       			   MIDE.precio_unitario');
			$this->db->from('movimientos_insumos MI');
			$this->db->join('movimientos_insumos_detalles MIDE', 'MIDE.movimiento_insumo_id = MI.movimiento_insumo_id', 'inner');
			$this->db->where('MIDE.insumo_id', $insumo_id);
			$this->db->where('MI.fecha >=', $strAnio.'-01-01');
			$this->db->where('MI.fecha <=', $strAnio.'-12-31');
			$this->db->where('MI.estatus !=', 'INACTIVO');
			$this->db->where('MI.movimiento_insumo_id !=', $intSalidaInsumosEventosID);
			$this->db->order_by('MI.fecha', 'ASC');
			$arrMovimientos = $this->db->get()->result();
			 
			for($j=0; $j<sizeof($arrMovimientos); $j++){

				if ($arrMovimientos[$j]->tipo_movimiento >= 11){

					$numCosto = (($numExistencia * $numCosto) - ($arrMovimientos[$j]->cantidad * $arrMovimientos[$j]->precio_unitario));
					$numExistencia -= $arrMovimientos[$j]->cantidad;
					if ($numExistencia <> 0){
						$numCosto = $numCosto / $numExistencia;
					}

				}

			}


			/*************************************************************************************
			* 4. Actualizar existencia actual y costo actual por cada registro 
			* de la tabla insumos_inventario		
			**************************************************************************************/
			//Actualizar los datos del registro
			$arrInventario = array('actual_existencia' => $numExistencia,
								   'actual_costo' => $numCosto);
			$this->db->where('anio', $strAnio);
			$this->db->where('insumo_id', $insumo_id);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('insumos_inventario', $arrInventario);

		}

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}

	/*
	*********************************************************************************************************************
	*********************************************************************************************************************
	FUNCIONES PARA EL PROCESO DE: ENTRADA DE INSUMOS DESPUES DE EVENTO
	*********************************************************************************************************************
	*********************************************************************************************************************
	*/
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_entrada_evento($dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL,  
    					   $intEventoID = NULL, 
    					   $intTipoMovimiento, 
    					   $intNumRows, 
    					   $intPos)
	{
		
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MI.tipo_movimiento', $intTipoMovimiento);
		$this->db->join('movimientos_insumos MI2', 'MI2.movimiento_insumo_id = MI.movimiento_insumo_referencia_id', 'left'); 
		$this->db->from('movimientos_insumos MI');
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("DATE(MI.fecha) BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    if($intEventoID != 0){
	    	$this->db->where("MI2.evento_id", $intEventoID);
	    } 
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MI.movimiento_insumo_id, 
						   MI.folio, 
					       DATE_FORMAT(MI.fecha, '%d/%m/%Y') AS fecha,
					       MI2.folio AS folioSalida,
					       (SELECT descripcion FROM eventos WHERE evento_id = MI2.evento_id) AS evento,
					       MI.estatus", FALSE);
		$this->db->from('movimientos_insumos MI');
		$this->db->join('movimientos_insumos MI2', 'MI2.movimiento_insumo_id = MI.movimiento_insumo_referencia_id', 'left');
	    $this->db->where('MI.tipo_movimiento', $intTipoMovimiento); 
	    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("DATE(MI.fecha) BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    if($intEventoID != 0){
	    	$this->db->where("MI2.evento_id", $intEventoID);
	    } 
		$this->db->order_by('MI.folio', 'DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		
		return $arrResultado;
	
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" MI.movimiento_insumo_id,
						    CONCAT(MI.folio, ' - ', E.descripcion) AS movimiento ", FALSE);
        $this->db->from('movimientos_insumos MI');
        $this->db->join('eventos E', 'E.evento_id = MI.evento_id', 'left');
		$this->db->where('MI.estatus', 'ACTIVO');
		$this->db->where('MI.tipo_movimiento', '11');
        $this->db->where("((MI.folio LIKE '%$strDescripcion%') OR (E.descripcion LIKE '%$strDescripcion%'))"); 
		$this->db->order_by('MI.folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	//Método para guardar un registro nuevo
	public function guardar_entrada_evento($strFolio,
										  $dteFecha, 
										  $intMovimientoInsumoReferenciaID,
										  $strObservaciones,
										  $strInsumoID,  
										  $strCantidades, 
										  $strPreciosUnitarios,
										  $intTipoMovimiento){

		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		//Variable que se utiliza para asignar el id del nuevo registro
		$intEntradaInsumosEventosID = 0;

		//Tabla ordenes_compra
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $strFolio); 

		//Asignar datos al array
		$arrDatos = array('tipo_movimiento' => $intTipoMovimiento,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha,  
						  'movimiento_insumo_referencia_id' => $intMovimientoInsumoReferenciaID,
						  'observaciones' => $strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('movimientos_insumos', $arrDatos);
		//Asignar id del nuevo registro en la base de datos
		$intEntradaInsumosEventosID  = $this->db->insert_id();
		
		//Hacer un llamado al método para guardar los detalles de la entrada por insumo
		
		$this->guardar_detalles_entrada_evento($this->db->insert_id(),
								$dteFecha,
								$strInsumoID, 
								$strCantidades, 
								$strPreciosUnitarios);
		

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intEntradaInsumosEventosID.'_'.$strFolioConsecutivo;

	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_entrada_evento($intEntradaInsumosEventosID,
							  				$dteFecha, 
										  	$intMovimientoInsumoReferenciaID,
										  	$strObservaciones,
										  	$strInsumoID,  
										  	$strCantidades, 
										  	$strPreciosUnitarios,
										  	$intTipoMovimiento)						
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Obtener el año de la fecha proporcionada
		$strFecha = explode("-", $dteFecha);
		$strAnio = $strFecha[0];

		/*************************************************************************************
		* 1. Modificar el encabezado del movimiento en la tabla movimientos_insumos		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('tipo_movimiento' => $intTipoMovimiento,
						  'fecha' => $dteFecha,  
						  'movimiento_insumo_referencia_id' => $intMovimientoInsumoReferenciaID, 
						  'observaciones' => $strObservaciones, 
						  'estatus' => 'ACTIVO', 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('movimiento_insumo_id', $intEntradaInsumosEventosID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_insumos', $arrDatos);

		/*************************************************************************************
		* 2. Seleccionar los detalles del movimiento de la tabla movimientos_insumos_detalles		
		**************************************************************************************/
		$arrDetalles = $this->buscar_detalles($intMovimientoInsumoReferenciaID);

		/*************************************************************************************
		* 3. Seleccionar existencia y costo inicial por cada registro 
		* de la tabla insumos_inventario		
		**************************************************************************************/
		for($i=0; $i<sizeof($arrDetalles); $i++){

			$insumo_id = $arrDetalles[$i]->insumo_id;
			$objInventario = $this->get_existencia_costo($insumo_id, $strAnio);

			$numExistencia = $objInventario->inicial_existencia;
			$numCosto = $objInventario->inicial_costo;

			$this->db->select('MI.movimiento_insumo_id,
				   			   MI.tipo_movimiento, 
				   			   MI.fecha,
			       			   MIDE.insumo_id,
			       			   MIDE.renglon, 
			       			   MIDE.cantidad, 
			       			   MIDE.precio_unitario');
			$this->db->from('movimientos_insumos MI');
			$this->db->join('movimientos_insumos_detalles MIDE', 'MIDE.movimiento_insumo_id = MI.movimiento_insumo_id', 'inner');
			$this->db->where('MIDE.insumo_id', $insumo_id);
			$this->db->where('MI.fecha >=', $strAnio.'-01-01');
			$this->db->where('MI.fecha <=', $strAnio.'-12-31');
			$this->db->where('MI.estatus !=', 'INACTIVO');
			$this->db->where('MI.movimiento_insumo_id !=', $intMovimientoInsumoReferenciaID);
			$this->db->order_by('MI.fecha', 'ASC');
			$arrMovimientos = $this->db->get()->result();
			 
			for($j=0; $j<sizeof($arrMovimientos); $j++){

				if ($arrMovimientos[$j]->tipo_movimiento < 11){

					$numCosto = (($numExistencia * $numCosto) + ($arrMovimientos[$j]->cantidad * $arrMovimientos[$j]->precio_unitario));
	                $numExistencia += $arrMovimientos[$j]->cantidad;
	                if ($numExistencia <> 0){
	                    $numCosto = $numCosto / $numExistencia;
	                }

				}

			}

			/*************************************************************************************
			* 4. Actualizar existencia actual y costo actual por cada registro 
			* de la tabla insumos_inventario		
			**************************************************************************************/
			//Actualizar los datos del registro
			$arrInventario = array('actual_existencia' => $numExistencia,
								   'actual_costo' => $numCosto);
			$this->db->where('anio', $strAnio);
			$this->db->where('insumo_id', $insumo_id);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('insumos_inventario', $arrInventario);

		}

		/*************************************************************************************
		* 5. Eliminar los detalles del movimiento en 
		* la tabla insumos_inventario_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_insumo_id', $intEntradaInsumosEventosID);
		$this->db->delete('movimientos_insumos_detalles');

		/*************************************************************************************
		* 6. Guardar detalles del movimiento en 
		* la tabla insumos_inventario_detalles		
		**************************************************************************************/
		//Hacer un llamado al método para guardar los detalles de la entrada por insumo
		$this->guardar_detalles_entrada_evento($intEntradaInsumosEventosID,
								$dteFecha,
								$strInsumoID, 
								$strCantidades, 
								$strPreciosUnitarios);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Función que se utiliza para guardar los detalles de la entrade de insumos despues de evento
	public function guardar_detalles_entrada_evento($intEntradaInsumosEventosID,
									$dteFecha, 
									$strInsumoID, 
								  	$strCantidades, 
								  	$strPreciosUnitarios)
	{
		/*Quitar | de la lista para obtener el concepto, cantidad, precio unitario*/
		$strFecha = explode("-", $dteFecha);
		$strAnio = $strFecha[0];

		$arrInsumoID = explode("|", $strInsumoID);
		$arrCantidades = explode("|", $strCantidades);
		$arrPreciosUnitarios = explode("|", $strPreciosUnitarios);

		//Hacer recorrido para insertar los datos en la tabla ordenes_compra_detalles
		for ($intCon = 0; $intCon < sizeof($arrInsumoID); $intCon++) 
		{
			//Obtener el ID correspondiente a ese concepto (INSUMO)
			$intInsumoID = $arrInsumoID[$intCon];
			$numCantidad = $arrCantidades[$intCon];
			$numCosto = $arrPreciosUnitarios[$intCon];
			//Asignar datos al array
			$arrDatos = array('movimiento_insumo_id' => $intEntradaInsumosEventosID,
							  'renglon' => ($intCon + 1),
							  'insumo_id' => $intInsumoID, 
							  'cantidad' => $numCantidad,
							  'precio_unitario' => $numCosto);
			//Guardar los datos del registro
			$this->db->insert('movimientos_insumos_detalles', $arrDatos);

			//Actualizar existencia del insumo en inventario
			$objInventario = $this->get_existencia_costo($intInsumoID, $strAnio);
			$numExistencia = $objInventario->actual_existencia;
			$numCostoActual = $objInventario->actual_costo;
			//Si el movimiento es de entrada a Almacén			
			if (($numExistencia + $numCantidad) != 0){
				$numCostoActual = (($numCostoActual * $numExistencia) + ($numCosto * $numCantidad)) / ($numExistencia + $numCantidad);
			}
			else{
				$numCostoActual = $numCosto;
			}
			$numExistencia += $numCantidad;

			//Actualizar los datos del registro
			$arrInventario = array('actual_existencia' => $numExistencia,
								   'actual_costo' => $numCostoActual);
			$this->db->where('anio', $strAnio);
			$this->db->where('insumo_id', $intInsumoID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('insumos_inventario', $arrInventario);

		}
	}

	//Función para buscar si la salida a eventos
	public function buscar_detalle_evento($intID){

		$this->db->select("MI.movimiento_insumo_id,
						   MI.folio,
						   E.evento_id,
						   E.descripcion AS evento");
		$this->db->from('movimientos_insumos MI');
		$this->db->join('eventos E', 'MI.evento_id = E.evento_id' ,'left');
		$this->db->where('MI.movimiento_insumo_id', $intID);
		$this->db->where('MI.tipo_movimiento', '11');
		$this->db->where('MI.estatus', 'ACTIVO');
		$this->db->limit(1);

		return $this->db->get()->row();

	}

	//Función para buscar si la salida a eventos seleccionada ya fue registrada
	public function verificar_salida($intID, $intTipoMovimiento){

		$this->db->select("movimiento_insumo_id");
		$this->db->from('movimientos_insumos');
		$this->db->where('movimiento_insumo_referencia_id', $intID);
		$this->db->where('tipo_movimiento', $intTipoMovimiento);
		$this->db->where('estatus', 'ACTIVO');
		$this->db->limit(1);

		return $this->db->get()->row();

	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_entrada_evento($intMovimientoInsumoID = NULL, $intTipoMovimiento = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL){
		
		$this->db->select("	MI.movimiento_insumo_id,
							MI.tipo_movimiento,
						    MI.folio,
						    DATE_FORMAT(MI.fecha, '%d/%m/%Y') AS fecha, 
						    MI.movimiento_insumo_referencia_id,
						    MI.observaciones,
						    MI2.folio AS folioSalida,
					       (SELECT descripcion FROM eventos WHERE evento_id = MI2.evento_id) AS evento,
						    MI.estatus, 
						    UC.usuario AS usuario_creacion", FALSE);
	    $this->db->from('movimientos_insumos MI');
	    $this->db->join('movimientos_insumos MI2', 'MI2.movimiento_insumo_id = MI.movimiento_insumo_referencia_id', 'left');
		$this->db->join('usuarios AS UC', 'MI.usuario_creacion = UC.usuario_id', 'left');
	    $this->db->where('MI.tipo_movimiento', $intTipoMovimiento);
	    $this->db->order_by('MI.folio', 'DESC');

		//Si existe id de la orden de compra
		if ($intMovimientoInsumoID != NULL)
		{   
			$this->db->where('MI.movimiento_insumo_id', $intMovimientoInsumoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			//Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("(MI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 
			return $this->db->get()->result();
		}
	}

	//Función para regresar los detalles de un registro entrada de insumos despues de Evento
	public function buscar_detalles_entrada_evento($intMovimientoInsumoID)
	{
		$this->db->select('	MI.movimiento_insumo_id,
							MI.movimiento_insumo_referencia_id,
					        MI.tipo_movimiento,
					        I.descripcion,
					        MIDE1.renglon,
					        MIDE1.insumo_id,
					        MIDE1.precio_unitario,
					        MIDE1.cantidad AS salida,
					        MIDE2.cantidad AS entrada');
		$this->db->from('movimientos_insumos MI');
		$this->db->join('movimientos_insumos_detalles MIDE1', 'MIDE1.movimiento_insumo_id = MI.movimiento_insumo_referencia_id', 'left');
		$this->db->join('movimientos_insumos_detalles MIDE2', 'MIDE2.movimiento_insumo_id = MI.movimiento_insumo_id', 'left');
		$this->db->join('insumos I', 'MIDE1.insumo_id = I.insumo_id', 'left');
		$this->db->where('MI.tipo_movimiento', '2');
		$this->db->where('MI.movimiento_insumo_id', $intMovimientoInsumoID);
		$this->db->where('MIDE1.renglon = MIDE2.renglon');
		$this->db->order_by('MIDE2.renglon', 'ASC');
		return $this->db->get()->result();
	}

	//Método para modificar el estatus de un registro
	public function set_estatus_entrada_evento($intEntradaInsumosEventosID, $strEstatus)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();

		/*************************************************************************************
		* 1. Modificar el encabezado del movimiento en la tabla movimientos_insumos		
		**************************************************************************************/
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

		$this->db->where('movimiento_insumo_id', $intEntradaInsumosEventosID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_insumos', $arrDatos);

		/*************************************************************************************
		* 2. Seleccionar los detalles del movimiento de la tabla movimientos_insumos_detalles		
		**************************************************************************************/
		$arrDetalles = $this->buscar_detalles($intEntradaInsumosEventosID);

		//Obtener el año de la fecha proporcionada
		$objFecha = $this->get_fecha_movimiento($intEntradaInsumosEventosID);
		$strFecha = explode("-", $objFecha->fecha);
		$strAnio = $strFecha[0];

		//var_dump($arrDetalles);
		/*************************************************************************************
		* 3. Seleccionar existencia y costo inicial por cada registro 
		* de la tabla insumos_inventario		
		**************************************************************************************/
		for($i=0; $i<sizeof($arrDetalles); $i++){

			$insumo_id = $arrDetalles[$i]->insumo_id;
			$objInventario = $this->get_existencia_costo($insumo_id, $strAnio);

			$numExistencia = $objInventario->inicial_existencia;
			$numCosto = $objInventario->inicial_costo;

			$this->db->select('MI.movimiento_insumo_id,
				   			   MI.tipo_movimiento, 
				   			   MI.fecha,
			       			   MIDE.insumo_id,
			       			   MIDE.renglon, 
			       			   MIDE.cantidad, 
			       			   MIDE.precio_unitario');
			$this->db->from('movimientos_insumos MI');
			$this->db->join('movimientos_insumos_detalles MIDE', 'MIDE.movimiento_insumo_id = MI.movimiento_insumo_id', 'inner');
			$this->db->where('MIDE.insumo_id', $insumo_id);
			$this->db->where('MI.fecha >=', $strAnio.'-01-01');
			$this->db->where('MI.fecha <=', $strAnio.'-12-31');
			$this->db->where('MI.estatus !=', 'INACTIVO');
			$this->db->where('MI.movimiento_insumo_id !=', $intEntradaInsumosEventosID);
			$this->db->order_by('MI.fecha', 'ASC');
			$arrMovimientos = $this->db->get()->result();
			 
			for($j=0; $j<sizeof($arrMovimientos); $j++){

				if ($arrMovimientos[$j]->tipo_movimiento < 11){

					$numCosto = (($numExistencia * $numCosto) + ($arrMovimientos[$j]->cantidad * $arrMovimientos[$j]->precio_unitario));
	                $numExistencia += $arrMovimientos[$j]->cantidad;
	                if ($numExistencia <> 0){
	                    $numCosto = $numCosto / $numExistencia;
	                }

				}

			}

			/*************************************************************************************
			* 4. Actualizar existencia actual y costo actual por cada registro 
			* de la tabla insumos_inventario		
			**************************************************************************************/
			//Actualizar los datos del registro
			
			$arrInventario = array('actual_existencia' => $numExistencia,
								   'actual_costo' => $numCosto);
			$this->db->where('anio', $strAnio);
			$this->db->where('insumo_id', $insumo_id);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('insumos_inventario', $arrInventario);

		}
		

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}
}
?>