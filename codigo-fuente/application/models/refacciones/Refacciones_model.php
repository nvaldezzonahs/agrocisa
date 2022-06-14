<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla refacciones
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objRefaccion)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla refacciones
		//Asignar datos al array
		$arrDatos = array('codigo_01' => $objRefaccion->strCodigo01, 
						  'codigo_02' => $objRefaccion->strCodigo02, 
						  'codigo_03' => $objRefaccion->strCodigo03, 
						  'codigo_04' => $objRefaccion->strCodigo04, 
						  'descripcion' => $objRefaccion->strDescripcion,
						  'servicio' => $objRefaccion->strServicio,
						  'producto_servicio_id' => $objRefaccion->intProductoServicioID, 
						  'unidad_id' => $objRefaccion->intUnidadID, 
						  'objeto_impuesto_id' => $objRefaccion->intObjetoImpuestoID, 
						  'refacciones_linea_id' => $objRefaccion->intRefaccionesLineaID, 
						  'refacciones_marca_id' => $objRefaccion->intRefaccionesMarcaID, 
						  'mpc_id' => $objRefaccion->intMpcID, 
						  'costo_planta' => $objRefaccion->intCostoPlanta, 
						  'moneda_id' => $objRefaccion->intMonedaID, 
						  'tasa_cuota_iva' => $objRefaccion->intTasaCuotaIva, 
						  'tasa_cuota_ieps' => $objRefaccion->intTasaCuotaIeps, 
						  'remplaza_id' => $objRefaccion->intRemplazaID, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objRefaccion->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('refacciones', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objRefaccion->intRefaccionID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar refacción en el inventario
		$this->guardar_inventario($objRefaccion);

		//Hacer un llamado al método para guardar los precios de la refacción
		$this->guardar_precios($objRefaccion);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objRefaccion)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla refacciones
		//Asignar datos al array
		$arrDatos = array('codigo_01' => $objRefaccion->strCodigo01, 
						  'codigo_02' => $objRefaccion->strCodigo02, 
						  'codigo_03' => $objRefaccion->strCodigo03, 
						  'codigo_04' => $objRefaccion->strCodigo04, 
						  'descripcion' => $objRefaccion->strDescripcion,
						  'servicio' => $objRefaccion->strServicio,
						  'producto_servicio_id' => $objRefaccion->intProductoServicioID, 
						  'unidad_id' => $objRefaccion->intUnidadID, 
						  'objeto_impuesto_id' => $objRefaccion->intObjetoImpuestoID, 
						  'refacciones_linea_id' => $objRefaccion->intRefaccionesLineaID, 
						  'refacciones_marca_id' => $objRefaccion->intRefaccionesMarcaID, 
						  'mpc_id' => $objRefaccion->intMpcID, 
						  'costo_planta' => $objRefaccion->intCostoPlanta, 
						  'moneda_id' => $objRefaccion->intMonedaID, 
						  'tasa_cuota_iva' => $objRefaccion->intTasaCuotaIva, 
						  'tasa_cuota_ieps' => $objRefaccion->intTasaCuotaIeps, 
						  'remplaza_id' => $objRefaccion->intRemplazaID,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objRefaccion->intUsuarioID);
		$this->db->where('refaccion_id', $objRefaccion->intRefaccionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('refacciones', $arrDatos);

		//Hacer un llamado al método para modificar refacción en el inventario
		$this->modificar_inventario($objRefaccion);

		//Eliminar los precios guardados
		$this->db->where('refaccion_id', $objRefaccion->intRefaccionID);
		$this->db->delete('refacciones_precios');

		//Hacer un llamado al método para guardar los precios de la refacción
		$this->guardar_precios($objRefaccion);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar el IVA de las refacciones
	public function modificar_iva(stdClass $objRefaccion)
	{
		//Asignar datos al array
		$arrDatos = array('tasa_cuota_iva' => $objRefaccion->intTasaCuotaIva, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objRefaccion->intUsuarioID);
		//Actualizar los datos del registro
		return $this->db->update('refacciones', $arrDatos);
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intRefaccionID, $strEstatus)
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
		$this->db->where('refaccion_id', $intRefaccionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('refacciones', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intRefaccionID = NULL, $intProveedorID = NULL, $intRefaccionesListaPrecioID = NULL, 
						   $dteFechaTipoCambio = NULL, $strCodigo = NULL,  $strBusqueda = NULL, $strEstatus = NULL, 
						   $strTipoReferencia = NULL, $intReferenciaID = NULL, $strListaPrecioCte = NULL)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Constante para identificar el ID de la primer lista de precios
        $intRefaccionListaPreciosBase = REFACCION_LISTA_PRECIOS_BASE;
        //Constante para identificar al tipo de movimiento entrada de refacciones por compra
		$intMovEntradaRefacciones = ENTRADA_REFACCIONES_COMPRA;
		//Constante para identificar el ID de la moneda: peso mexicano
		$intMonedaBaseID = MONEDA_BASE;
		//Constante para identificar el tipo de cambio de la moneda: peso mexicano
		$intTipoCambioMonedaBase = TIPO_CAMBIO_MONEDA_BASE;
        //Variable que se utiliza para agregar el campo último costo del proveedor
		$strCampoUltimoCostoProveedor = '';

		//Si existe id de la lista de precios
		if ($intRefaccionesListaPrecioID > 0) 
		{
			$intRefaccionListaPreciosBase = $intRefaccionesListaPrecioID;
		}


		//Si la refacción se carga en cotizaciones/pedidos/remisiones/facturas
		//Regresar el precio que tiene asignado el cliente
		if($strListaPrecioCte == 'SI')
		{
			$intRefaccionListaPreciosBase = (($intRefaccionesListaPrecioID !== '') ? 
							          		  $intRefaccionesListaPrecioID : 0);
		}

		
		//Si existe id del proveedor
		if($intProveedorID > 0)
		{
			$strCampoUltimoCostoProveedor .= "(SELECT (MRD.costo_unitario + MRD.descuento_unitario)
											   FROM movimientos_refacciones_detalles AS  MRD
											   INNER JOIN movimientos_refacciones AS MR ON MRD.movimiento_refacciones_id = MR.movimiento_refacciones_id
												WHERE MR.tipo_movimiento = $intMovEntradaRefacciones
												AND   MR.proveedor_id = $intProveedorID 
												AND MR.estatus = 'ACTIVO'
												AND MRD.refaccion_id = R.refaccion_id
												AND MR.fecha = (SELECT MAX(MRF.fecha)
																FROM movimientos_refacciones AS MRF
												                INNER JOIN movimientos_refacciones_detalles AS MRDF ON MRF.movimiento_refacciones_id = MRDF.movimiento_refacciones_id
												                WHERE MRF.tipo_movimiento = MR.tipo_movimiento
																AND   MRF.proveedor_id = MR.proveedor_id
												                AND MRF.estatus = MR.estatus
																AND MRDF.refaccion_id = MRD.refaccion_id)) AS ultimo_costo_proveedor";
		}


		//Si existe tipo de referencia (kit, marca o línea)
		if($strTipoReferencia !== NULL)
		{

			//Variable que se utiliza para asignar los campos que regresara el kit de refacciones
			$strCamposKit = "'0' AS cantidad, '0' AS porcentaje_descuento";

			//Dependiendo del tipo de referencia realizar la búsqueda de datos
			if($strTipoReferencia == 'KIT')
			{
				//Variables que se utilizan para indicar que las refacciones pertenecen al kit 
				$strCamposKit = "RKD.cantidad,  RKD.descuento AS porcentaje_descuento";
				$strCampoClaveID =  'RKD.refaccion_kit_id';

			}
			else if($strTipoReferencia == 'LINEA')
			{
				//Variables que se utilizan para indicar que las refacciones pertenecen a una línea 
				$strCampoClaveID =  'RL.refacciones_linea_id';
			}	
			else
			{
				//Variables que se utilizan para indicar que las refacciones pertenecen a una marca 
				$strCampoClaveID =  'RM.refacciones_marca_id';
				
			}

			$this->db->select("R.refaccion_id, R.codigo_01 AS codigo, R.descripcion, R.servicio,
							   R.tasa_cuota_iva, R.tasa_cuota_ieps, RL.codigo AS codigo_linea,
							   TIva.valor_maximo AS porcentaje_iva, TIeps.valor_maximo AS porcentaje_ieps,
							   IFNULL(RP.precio, 0) AS precio, R.moneda_id,
							   IFNULL(RI.actual_existencia, 0) AS actual_existencia, 
							   IFNULL(RI.disponible_existencia, 0) AS disponible_existencia,  
							   IFNULL(RI.actual_costo, 0) AS actual_costo, 
							   IFNULL(RII.actual_existencia, 0) AS actual_existencia_interno,  
							   IFNULL(RII.actual_costo, 0) AS actual_costo_interno,
							   PS.codigo AS codigo_sat, 
							   U.codigo AS unidad_sat,
							   OImp.codigo AS objeto_impuesto_sat,
							   $strCamposKit, 
							   CASE   
							      WHEN R.moneda_id <> $intMonedaBaseID
							      THEN IFNULL((SELECT TC.tipo_cambio_venta
									    	   FROM tipos_cambio AS  TC
									           WHERE TC.fecha = '$dteFechaTipoCambio' 
									           AND TC.moneda_id = R.moneda_id), 0)
							      ELSE $intTipoCambioMonedaBase
							   END AS tipo_cambio_venta", FALSE);
			$this->db->from('refacciones AS R');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			//Dependiendo del tipo de referencia realizar la búsqueda de datos
			if($strTipoReferencia == 'KIT')
			{
				$this->db->join('refacciones_kits_detalles AS RKD', 'R.refaccion_id = RKD.refaccion_id', 'inner');
			}
			else if($strTipoReferencia == 'MARCA')
			{
				$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			}
			$this->db->join('sat_monedas AS M', 'R.moneda_id = M.moneda_id', 'inner');
			$this->db->join('sat_productos_servicios AS PS', 'R.producto_servicio_id = PS.producto_servicio_id', 'inner');
			$this->db->join('sat_unidades AS U', 'R.unidad_id = U.unidad_id', 'inner');
			$this->db->join('sat_tasa_cuota AS TIva', 'R.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
			$this->db->join('sat_tasa_cuota AS TIeps', 'R.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
			$this->db->join('sat_objeto_impuesto AS OImp', 'R.objeto_impuesto_id = OImp.objeto_impuesto_id', 'left');
			$this->db->join('refacciones_inventario AS RI', 'R.refaccion_id = RI.refaccion_id 
							 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(NOW())', 'left');
			$this->db->join('refacciones_internas_inventario AS RII', 'R.refaccion_id = RII.refaccion_id 
							 AND RII.sucursal_id = '.$intSucursalID.' AND RII.anio = YEAR(NOW())', 'left');
			$this->db->join('refacciones_precios AS RP', 'R.refaccion_id = RP.refaccion_id 
							 AND RP.refacciones_lista_precio_id = '.$intRefaccionListaPreciosBase, 'left');
			$this->db->where($strCampoClaveID, $intReferenciaID);
			$this->db->where('R.estatus', 'ACTIVO');
			$this->db->order_by('R.codigo_01', 'ASC');
		    return $this->db->get()->result();

		}
		else
		{
			$this->db->select("R.refaccion_id, R.codigo_01, R.codigo_02, R.codigo_03, R.codigo_04, R.descripcion,
							   R.servicio, R.producto_servicio_id, R.unidad_id, R.objeto_impuesto_id,
							   R.refacciones_linea_id, R.refacciones_marca_id, 
							   R.mpc_id, R.costo_planta, R.moneda_id, R.tasa_cuota_iva, 
							   R.tasa_cuota_ieps, R.remplaza_id, R.estatus,
							   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
							   RL.codigo AS codigo_linea, RM.descripcion AS refacciones_marca,
							   TIva.valor_maximo AS porcentaje_iva, TIeps.valor_maximo AS porcentaje_ieps,
							   CONCAT_WS(' - ', MPC.codigo, MPC.descripcion) AS marketing_product_code,
							   CONCAT_WS(' - ', MPL.codigo, MPL.descripcion) AS marketing_product_line,
							   CONCAT_WS(' - ', MCD.codigo, MCD.descripcion) AS marketing_code_description,
							   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, M.codigo AS codigo_moneda,
							   CONCAT_WS(' - ', PS.codigo, PS.descripcion) AS producto_servicio, 
							   CONCAT_WS(' - ', U.codigo, U.nombre) AS unidad, 
							   CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto,
							   CONCAT_WS(' - ', RR.codigo_01, RR.descripcion) AS remplaza, 
							   CONCAT_WS(' - ', RRZ.codigo_01, RRZ.descripcion) AS remplazo, 
							   RI.localizacion, RI.clasificacion, RI.clasificacion_planta, 
							   IFNULL(RI.minimo, 0) AS minimo, 
							   IFNULL(RI.maximo, 0) AS maximo, IFNULL(RI.reorden, 0) AS reorden, 
							   IFNULL(RI.actual_existencia, 0) AS actual_existencia, 
							   IFNULL(RI.disponible_existencia, 0) AS disponible_existencia, 
							   IFNULL(RI.actual_costo, 0) AS actual_costo, 
							   IFNULL(RII.actual_existencia, 0) AS actual_existencia_interno,  
							   IFNULL(RII.actual_costo, 0) AS actual_costo_interno,
							   IFNULL(RP.precio, 0) AS precio, PS.codigo AS codigo_sat, 
							   U.codigo AS unidad_sat, OImp.codigo AS objeto_impuesto_sat,
							   $strCampoUltimoCostoProveedor,  
							   CASE   
							      WHEN R.moneda_id <> $intMonedaBaseID
							      THEN IFNULL((SELECT TC.tipo_cambio_venta
									   		   FROM tipos_cambio AS  TC
									   		   WHERE TC.fecha = '$dteFechaTipoCambio' 
									           AND TC.moneda_id = R.moneda_id), 0)
							      ELSE $intTipoCambioMonedaBase
							   END AS tipo_cambio_venta", FALSE);
			$this->db->from('refacciones AS R');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('sat_monedas AS M', 'R.moneda_id = M.moneda_id', 'inner');
			$this->db->join('sat_productos_servicios AS PS', 'R.producto_servicio_id = PS.producto_servicio_id', 'inner');
			$this->db->join('sat_unidades AS U', 'R.unidad_id = U.unidad_id', 'inner');
			$this->db->join('sat_tasa_cuota AS TIva', 'R.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
			$this->db->join('sat_tasa_cuota AS TIeps', 'R.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
			$this->db->join('marketing_product_codes AS MPC', 'R.mpc_id = MPC.mpc_id', 'left');
			$this->db->join('marketing_product_lines AS MPL', 'MPC.mpl_id = MPL.mpl_id', 'left');
			$this->db->join('marketing_code_descriptions AS MCD', 'MPL.mcd_id = MCD.mcd_id', 'left');
			$this->db->join('refacciones AS RR', 'R.remplaza_id = RR.refaccion_id', 'left');
			$this->db->join('refacciones AS RRZ', 'R.remplaza_id = RRZ.refaccion_id ', 'left');
			$this->db->join('sat_objeto_impuesto AS OImp', 'R.objeto_impuesto_id = OImp.objeto_impuesto_id', 'left');
			$this->db->join('refacciones_inventario AS RI', 'R.refaccion_id = RI.refaccion_id 
							 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(NOW())', 'left');
			$this->db->join('refacciones_internas_inventario AS RII', 'R.refaccion_id = RII.refaccion_id 
							 AND RII.sucursal_id = '.$intSucursalID.' AND RII.anio = YEAR(NOW())', 'left');
			$this->db->join('refacciones_precios AS RP', 'R.refaccion_id = RP.refaccion_id 
							 AND RP.refacciones_lista_precio_id = '.$intRefaccionListaPreciosBase, 'left');

			//Si existe id de la refacción
			if ($intRefaccionID !== NULL)
			{   
				$this->db->where('R.refaccion_id', $intRefaccionID);
				$this->db->limit(1);
				return $this->db->get()->row();
			}
			else if ($strCodigo !== NULL)//Si existe código
			{	
				$this->db->where("R.codigo_01 = '$strCodigo' OR 
								  R.codigo_02 = '$strCodigo' OR
								  R.codigo_03 = '$strCodigo' OR
								  R.codigo_04 = '$strCodigo'"); 
				$this->db->limit(1);
				return $this->db->get()->row();
			}
			else
			{
				//Si existe estatus 
				if($strEstatus !== NULL)
				{
					$this->db->where('R.estatus', $strEstatus);
				}
				$this->db->where("((R.codigo_01 LIKE '%$strBusqueda%') OR
						   (R.codigo_02 LIKE '%$strBusqueda%') OR  
						   (R.codigo_03 LIKE '%$strBusqueda%') OR  
						   (R.codigo_04 LIKE '%$strBusqueda%') OR  
        				   (R.descripcion LIKE '%$strBusqueda%') OR
        				   (R.estatus LIKE '%$strBusqueda%') OR
        				   (R.servicio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', RL.codigo, RL.descripcion) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', RL.codigo, RL.descripcion) LIKE '%$strBusqueda%'))");
				$this->db->order_by('R.codigo_01', 'ASC');
				return $this->db->get()->result();
			}

		}
		
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $strEstatus = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe estatus 
		if($strEstatus !== NULL)
		{
			$this->db->where('R.estatus', $strEstatus);
		}
		$this->db->where("((R.codigo_01 LIKE '%$strBusqueda%') OR
						   (R.codigo_02 LIKE '%$strBusqueda%') OR  
						   (R.codigo_03 LIKE '%$strBusqueda%') OR  
						   (R.codigo_04 LIKE '%$strBusqueda%') OR  
        				   (R.descripcion LIKE '%$strBusqueda%') OR
        				   (R.estatus LIKE '%$strBusqueda%') OR
        				   (R.servicio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', RL.codigo, RL.descripcion) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', RL.codigo, RL.descripcion) LIKE '%$strBusqueda%'))");
		$this->db->from('refacciones AS R');
		$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
		$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
		$this->db->join('sat_monedas AS M', 'R.moneda_id = M.moneda_id', 'inner');
		$this->db->join('sat_productos_servicios AS PS', 'R.producto_servicio_id = PS.producto_servicio_id', 'inner');
		$this->db->join('sat_unidades AS U', 'R.unidad_id = U.unidad_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'R.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("R.refaccion_id, R.codigo_01, R.codigo_02, R.codigo_03, R.codigo_04, 
						   R.descripcion, R.servicio, R.estatus,
						   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea", FALSE);
		$this->db->from('refacciones AS R');
		$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
		$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
		$this->db->join('sat_monedas AS M', 'R.moneda_id = M.moneda_id', 'inner');
		$this->db->join('sat_productos_servicios AS PS', 'R.producto_servicio_id = PS.producto_servicio_id', 'inner');
		$this->db->join('sat_unidades AS U', 'R.unidad_id = U.unidad_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'R.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		//Si existe estatus 
		if($strEstatus !== NULL)
		{
			$this->db->where('R.estatus', $strEstatus);
		}
		$this->db->where("((R.codigo_01 LIKE '%$strBusqueda%') OR
						   (R.codigo_02 LIKE '%$strBusqueda%') OR  
						   (R.codigo_03 LIKE '%$strBusqueda%') OR  
						   (R.codigo_04 LIKE '%$strBusqueda%') OR  
        				   (R.descripcion LIKE '%$strBusqueda%') OR
        				   (R.estatus LIKE '%$strBusqueda%') OR
        				   (R.servicio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', RL.codigo, RL.descripcion) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', RL.codigo, RL.descripcion) LIKE '%$strBusqueda%'))");
		$this->db->order_by('R.codigo_01', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["refacciones"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strTipo, $strTipoMovimiento)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Variable que se utiliza para asignar el año actual
		$strAnioActual = date("Y");
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';
		//Asignar número de registros para el autocomplete
	    $intLimite = LIMITE_AUTOCOMPLETE;
	    
		//Si el movimiento de refacciones corresponde a una salida
		if($strTipoMovimiento == 'salida')
		{
			$strRestricciones .= " INNER JOIN refacciones_inventario AS RI ON R.refaccion_id = RI.refaccion_id
								   AND RI.sucursal_id = $intSucursalID AND  RI.anio = '$strAnioActual'
								   AND RI.disponible_existencia > 0";
		}
		else if ($strTipoMovimiento == 'salida_interna')
		{
			$strRestricciones .= " INNER JOIN refacciones_internas_inventario AS RII ON R.refaccion_id = RII.refaccion_id
								   AND RII.sucursal_id = $intSucursalID AND  RII.anio = '$strAnioActual'
								   AND RII.actual_existencia > 0";
		}

		//Dependiendo del tipo realizar la búsqueda de datos
	    if($strTipo == 'codigo')
	    {
	    	$strSQL = $this->db->query("SELECT R.refaccion_id, R.codigo_01 AS codigo, 
	    	 								   CONCAT_WS(' - ', R.codigo_01, R.descripcion) AS refaccion
	    	 							FROM refacciones AS R 
	    	 							$strRestricciones
	    	 							WHERE R.estatus = 'ACTIVO'
	    	 							AND (R.codigo_01 LIKE '%$strDescripcion%' OR
	    	 								 R.descripcion LIKE '%$strDescripcion%')
	    	 							UNION
	    	 							SELECT R.refaccion_id,  R.codigo_01 AS codigo, 
	    	 							 	   CONCAT_WS(' - ', R.codigo_02, R.descripcion) AS refaccion
	    	 							FROM refacciones AS R
	    	 							$strRestricciones
	    	 							WHERE estatus = 'ACTIVO'
	    	 							AND R.codigo_02 <> ''
	    	 							AND (R.codigo_02 LIKE '%$strDescripcion%' OR
	    	 								 R.descripcion LIKE '%$strDescripcion%')
	    	 							UNION
	    	 							SELECT R.refaccion_id, R.codigo_01 AS codigo,
	    	 							 	   CONCAT_WS(' - ', R.codigo_03, R.descripcion) AS refaccion
	    	 							FROM refacciones AS R
	    	 							$strRestricciones
	    	 							WHERE R.estatus = 'ACTIVO'
	    	 							AND  R.codigo_03 <> ''
	    	 							AND (R.codigo_03 LIKE '%$strDescripcion%' OR
	    	 								 R.descripcion LIKE '%$strDescripcion%')
	    	 							UNION
	    	 							SELECT R.refaccion_id, R.codigo_01 AS codigo, 
	    	 							 	   CONCAT_WS(' - ', R.codigo_04, R.descripcion) AS refaccion
	    	 							FROM refacciones AS R
	    	 							$strRestricciones
	    	 							WHERE R.estatus = 'ACTIVO'
	    	 							AND  R.codigo_04 <> ''
	    	 							AND (R.codigo_04 LIKE '%$strDescripcion%' OR
	    	 								 R.descripcion LIKE '%$strDescripcion%')
	    	 							ORDER BY codigo ASC 
	    	 							LIMIT 0, $intLimite");

	    	return $strSQL->result();
	    }
	    else if($strTipo == 'descripcion')
	    {
	    	$this->db->select(" R.refaccion_id, R.codigo_01 AS codigo,
						        CONCAT_WS(' - ', R.codigo_01, R.descripcion) AS refaccion ", FALSE);
	        $this->db->from('refacciones AS R');
	        //Si el movimiento de refacciones corresponde a una salida
			if($strTipoMovimiento == 'salida')
	        {
	        	$this->db->join('refacciones_inventario AS RI', 
					        	'R.refaccion_id = RI.refaccion_id AND RI.sucursal_id = '.$intSucursalID.' 
					        	 RI.anio = YEAR(NOW()) AND RI.disponible_existencia > 0', 'inner');
	        }
	      	else if ($strTipoMovimiento == 'salida_interna')
	      	{
	      		$this->db->join('refacciones_internas_inventario AS RII', 
					        	'R.refaccion_id = RII.refaccion_id AND RII.sucursal_id = '.$intSucursalID.' 
					        	 RII.anio = YEAR(NOW()) AND RII.actual_existencia > 0', 'inner');
	      	}

	   	    $this->db->where('R.estatus','ACTIVO');
	        $this->db->where("(R.codigo_01 LIKE '%$strDescripcion%' OR
	        				   R.descripcion LIKE '%$strDescripcion%')");  
			$this->db->order_by('R.codigo_01', 'ASC');
			$this->db->limit($intLimite, 0);
		    return $this->db->get()->result();
	    }
	    else
	    {
	    	$this->db->select(" refaccion_id, codigo_01 AS codigo,
						        CONCAT_WS(' - ', codigo_01, descripcion) AS refaccion ", FALSE);
	        $this->db->from('refacciones');
	   	    $this->db->where('estatus','ACTIVO');
	        $this->db->where("(codigo_01 LIKE '%$strDescripcion%' OR
	        				   codigo_02 LIKE '%$strDescripcion%' OR 
	        				   codigo_03 LIKE '%$strDescripcion%' OR
	        				   codigo_04 LIKE '%$strDescripcion%' OR
	        				   descripcion LIKE '%$strDescripcion%')");  
			$this->db->order_by('codigo_01', 'ASC');
			$this->db->limit($intLimite, 0);
		    return $this->db->get()->result();
	    }
		
	}

	/*******************************************************************************************************************
	Funciones de la tabla refacciones_inventario
	*********************************************************************************************************************/
	//Función que se utiliza para guardar refacción en el inventario
	public function guardar_inventario(stdClass $objRefaccion)
	{
		//Variable que se utiliza para asignar el año actual
		$strAnioActual = date("Y");
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objRefaccion->intSucursalID,
			              'refaccion_id' => $objRefaccion->intRefaccionID,
						  'anio' => $strAnioActual,
						  'localizacion' => $objRefaccion->strLocalizacion,
						  'clasificacion' => '',
						  'clasificacion_planta' => '',
						  'minimo' => 0,
						  'maximo' => 0,
						  'reorden' => 0,
						  'inicial_existencia' => 0,
						  'inicial_costo' => 0,
						  'actual_existencia' => 0,
						  'disponible_existencia' => 0,
						  'actual_costo' => 0);
		//Guardar los datos del registro
		$this->db->insert('refacciones_inventario', $arrDatos);
	}

	//Función que se utiliza para modificar refacción en el inventario
	public function modificar_inventario(stdClass $objRefaccion)
	{
		//Variable que se utiliza para asignar el año actual
		$strAnioActual = date("Y");

		//Asignar datos al array
		$arrDatos = array('localizacion' => $objRefaccion->strLocalizacion);
		$this->db->where('sucursal_id',  $objRefaccion->intSucursalID);
		$this->db->where('refaccion_id', $objRefaccion->intRefaccionID);
		$this->db->where('anio', $strAnioActual);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('refacciones_inventario', $arrDatos);
	}

	/*******************************************************************************************************************
	Funciones de la tabla refacciones_precios
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los precios de la refacción
	public function guardar_precios(stdClass $objRefaccion)
	{
		//Si existen listas de precios
		if($objRefaccion->strRefaccionesListaPrecioID !== '')
		{
			//Quitar | de la lista para obtener el ID de la lista y el precio
			$arrRefaccionesListaPrecioID = explode("|", $objRefaccion->strRefaccionesListaPrecioID);
			$arrPrecios = explode("|", $objRefaccion->strPrecios);
			//Hacer recorrido para insertar los datos en la tabla refacciones_precios
			for ($intCon = 0; $intCon < sizeof($arrRefaccionesListaPrecioID); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('refaccion_id' => $objRefaccion->intRefaccionID,
								  'refacciones_lista_precio_id' => $arrRefaccionesListaPrecioID[$intCon],
								  'precio' => $arrPrecios[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('refacciones_precios', $arrDatos);
			}
		}
	}

	//Método para regresar los precios de un registro
	public function buscar_precios($intRefaccionID)
	{
		$this->db->select('RLP.refacciones_lista_precio_id, RLP.descripcion, 
						   IFNULL(RP.precio,0) AS precio');
		$this->db->from('refacciones_listas_precios AS RLP');
		$this->db->join('refacciones_precios AS RP', 'RLP.refacciones_lista_precio_id = RP.refacciones_lista_precio_id 
						 AND RP.refaccion_id = '.$intRefaccionID, 'left');
		$this->db->where('RLP.estatus', 'ACTIVO');
		$this->db->order_by('RLP.refacciones_lista_precio_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para obtener el precio de una refacción con base a un ID y un precio de lista proporcionado
	public function buscar_precio($intRefaccionID = NULL, $intListaPrecioID = NULL){

		$this->db->select('precio');
		$this->db->from('refacciones_precios');
		$this->db->where('refaccion_id', $intRefaccionID);
		$this->db->where('refacciones_lista_precio_id', $intListaPrecioID);
		return $this->db->get()->result();

	}
}
?>