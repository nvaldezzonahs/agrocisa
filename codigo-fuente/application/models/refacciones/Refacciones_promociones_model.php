<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones_promociones_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla refacciones_promociones
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objRefaccionPromocion)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla refacciones_promociones
		//Asignar datos al array
		$arrDatos = array('fecha_inicio' => $objRefaccionPromocion->dteFechaInicio, 
						  'fecha_final' => $objRefaccionPromocion->dteFechaFinal, 
						  'sucursal_id' => $objRefaccionPromocion->intSucursalID, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objRefaccionPromocion->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('refacciones_promociones', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objRefaccionPromocion->intRefaccionPromocionID = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la promoción
		$this->guardar_detalles($objRefaccionPromocion);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objRefaccionPromocion)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla refacciones_promociones
		//Asignar datos al array
		$arrDatos = array('fecha_inicio' => $objRefaccionPromocion->dteFechaInicio, 
						  'fecha_final' => $objRefaccionPromocion->dteFechaFinal, 
						  'sucursal_id' => $objRefaccionPromocion->intSucursalID, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objRefaccionPromocion->intUsuarioID);
		$this->db->where('refaccion_promocion_id', $objRefaccionPromocion->intRefaccionPromocionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('refacciones_promociones', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('refaccion_promocion_id', $objRefaccionPromocion->intRefaccionPromocionID);
		$this->db->delete('refacciones_promociones_detalles');
		//Hacer un llamado al método para guardar los detalles de la promoción
		$this->guardar_detalles($objRefaccionPromocion);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intRefaccionPromocionID, $strEstatus)
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
		$this->db->where('refaccion_promocion_id', $intRefaccionPromocionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('refacciones_promociones', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intRefaccionPromocionID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL,
						   $intSucursalID = NULL)
	{

		$this->db->select("RP.refaccion_promocion_id, DATE_FORMAT(RP.fecha_inicio,'%d/%m/%Y') AS fecha_inicio,
						   DATE_FORMAT(RP.fecha_final,'%d/%m/%Y') AS fecha_final, RP.sucursal_id, RP.estatus, 
						   CASE 
							   WHEN  RP.sucursal_id > 0 
							   		THEN  S.nombre
							   ELSE 'TODAS'
						   END AS sucursal", FALSE);
	    $this->db->from('refacciones_promociones AS RP');
	    $this->db->join('sucursales AS S', 'RP.sucursal_id = S.sucursal_id', 'left');
		//Si existe id de la promoción
		if ($intRefaccionPromocionID !== NULL)
		{   
			$this->db->where('RP.refaccion_promocion_id', $intRefaccionPromocionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			//Si existe id de la sucursal
		    if($intSucursalID > 0)
		    {
		   		$this->db->where('RP.sucursal_id', $intSucursalID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(('$dteFechaInicial'  BETWEEN RP.fecha_inicio AND RP.fecha_final) OR
		   					       ('$dteFechaFinal' BETWEEN RP.fecha_inicio AND RP.fecha_final))", NULL, FALSE);
		    }
		    $this->db->order_by('RP.fecha_inicio', 'DESC');
		    return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intSucursalID = NULL,
						   $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe id de la sucursal
		if($intSucursalID > 0)
	    {
	   		$this->db->where('RP.sucursal_id', $intSucursalID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(('$dteFechaInicial'  BETWEEN RP.fecha_inicio AND RP.fecha_final) OR
		   					   ('$dteFechaFinal' BETWEEN RP.fecha_inicio AND RP.fecha_final))", NULL, FALSE);
	    } 
		$this->db->from('refacciones_promociones AS RP');
		$this->db->join('sucursales AS S', 'RP.sucursal_id = S.sucursal_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("RP.refaccion_promocion_id,  DATE_FORMAT(RP.fecha_inicio,'%d/%m/%Y') AS fecha_inicio,
						   DATE_FORMAT(RP.fecha_final,'%d/%m/%Y') AS fecha_final, RP.estatus, 
						   CASE 
							   WHEN  RP.sucursal_id > 0 
							   		THEN  S.nombre
							   ELSE 'TODAS'
						    END AS sucursal", FALSE);
		$this->db->from('refacciones_promociones AS RP');
		$this->db->join('sucursales AS S', 'RP.sucursal_id = S.sucursal_id', 'left');
		//Si existe id de la sucursal
	    if($intSucursalID > 0)
	    {
	   		$this->db->where('RP.sucursal_id', $intSucursalID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(('$dteFechaInicial'  BETWEEN RP.fecha_inicio AND RP.fecha_final) OR
		   					   ('$dteFechaFinal' BETWEEN RP.fecha_inicio AND RP.fecha_final))", NULL, FALSE);
	    }
		$this->db->order_by('RP.fecha_inicio', 'DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["promociones"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strTipo, $dteFecha, 
								 $intRefaccionesListaPrecioID, $strListaPrecioCte)
	{
		//Constante para identificar el ID de la primer lista de precios
        $intRefaccionListaPreciosBase = REFACCION_LISTA_PRECIOS_BASE;
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strInicioSubconsultaPromocion = '';
		$strFinalSubconsultaPromocion = '';
		$strPorcentajeDescLineaRefacciones = '';
		$strRestriccionesRefacciones = '';
		$strRestriccionesKits = '';
		$strRestriccionesLinea = '';
		$strRestriccionesMarca = '';

	
       /* //Si existe id de la lista de precios
		if($intRefaccionesListaPrecioID > 0)
		{
			$intRefaccionListaPreciosBase = $intRefaccionesListaPrecioID;
		}*/


		//Si la refacción se carga en cotizaciones/pedidos/remisiones/facturas
		//Regresar la lista de precio que tiene asignada el cliente
		if($strListaPrecioCte == 'SI')
		{
			$intRefaccionListaPreciosBase = (($intRefaccionesListaPrecioID !== '') ? 
							          		  $intRefaccionesListaPrecioID : 0);
		}



		//Asignar número de registros para el autocomplete
    	$intLimite = LIMITE_AUTOCOMPLETE;

    	//Si existe fecha para la búsqueda del descuento de promoción
		if($dteFecha != '')
		{
			
			$strInicioSubconsultaPromocion = ", IFNULL((SELECT RPD.descuento
											  	  		FROM refacciones_promociones AS RP
											   	  		INNER JOIN refacciones_promociones_detalles AS RPD ON RP.refaccion_promocion_id = RPD.refaccion_promocion_id";

			$strFinalSubconsultaPromocion = "AND '$dteFecha' BETWEEN  RP.fecha_inicio AND  RP.fecha_final
								  	   		 AND (RP.sucursal_id = $intSucursalID OR RP.sucursal_id IS NULL)),0) AS descuento_promocion";

		    //Promoción de la refacción
			$strRestriccionesRefacciones .= " $strInicioSubconsultaPromocion
										  	  WHERE RPD.tipo = 'REFACCION'
										  	  AND RPD.referencia_id = R.refaccion_id
										 	  $strFinalSubconsultaPromocion";

			$strRestriccionesRefacciones .= ", '0' AS descuento_linea";


			//Promoción del kit de refacciones
			$strRestriccionesKits .= " $strInicioSubconsultaPromocion
								  	   WHERE RPD.tipo = 'KIT'
								  	   AND RPD.referencia_id = RK.refaccion_kit_id 
								 	   $strFinalSubconsultaPromocion";

			$strRestriccionesKits .= ", '0' AS descuento_linea";


			//Promoción de la linea
			$strRestriccionesLinea .= "$strInicioSubconsultaPromocion
									   WHERE RPD.tipo = 'LINEA'
									   AND RPD.referencia_id = RL.refacciones_linea_id 
									   $strFinalSubconsultaPromocion";

			//Porcentaje de descuento de la línea						   
			$strRestriccionesLinea .= ", IFNULL((SELECT RLD.porcentaje_utilidad
										    FROM refacciones_lineas_detalles AS RLD
											WHERE RLD.refacciones_linea_id = RL.refacciones_linea_id
											AND RLD.refacciones_lista_precio_id = $intRefaccionListaPreciosBase),0) AS descuento_linea";

			//Promoción de la marca
			$strRestriccionesMarca .= "$strInicioSubconsultaPromocion
								  	   WHERE RPD.tipo = 'MARCA'
								  	   AND RPD.referencia_id = RM.refacciones_marca_id
								 	   $strFinalSubconsultaPromocion";
			$strRestriccionesMarca .= ", '0' AS descuento_linea";


		}


		//Si el Autocomplete es por referencias (refacciones, kits, líneas y marcas)
	    if($strTipo == 'referencias')
	    {
	    	$strSQL = $this->db->query("SELECT R.refaccion_id  AS referencia_id, 
	    									 CONCAT_WS(' - ', R.codigo_01, R.descripcion) AS referencia, 
	    									 'REFACCION' AS tipo_referencia $strRestriccionesRefacciones
	    	 							FROM refacciones AS R
	    	 							WHERE R.estatus = 'ACTIVO'
	    	 							AND (R.codigo_01 LIKE '%$strDescripcion%' OR
				        				     R.codigo_02 LIKE '%$strDescripcion%' OR 
				        				     R.codigo_03 LIKE '%$strDescripcion%' OR
				        				     R.codigo_04 LIKE '%$strDescripcion%' OR
				        				     R.descripcion LIKE '%$strDescripcion%')
								        UNION 
								        SELECT RK.refaccion_kit_id AS referencia_id, 
								        	   CONCAT_WS(' - ', RK.codigo, RK.descripcion) AS referencia,
								        	   'KIT' AS tipo_referencia $strRestriccionesKits
								        FROM refacciones_kits AS RK
								        WHERE RK.estatus = 'ACTIVO'
								        AND  (RK.codigo LIKE '%$strDescripcion%' OR
				        				      RK.descripcion LIKE '%$strDescripcion%')
				        				UNION 
				        				SELECT RL.refacciones_linea_id AS referencia_id, 
								        	   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS referencia,
								        	   'LINEA' AS tipo_referencia $strRestriccionesLinea
								        FROM refacciones_lineas AS RL
								        WHERE RL.estatus = 'ACTIVO'
								        AND  (RL.codigo LIKE '%$strDescripcion%' OR
				        				      RL.descripcion LIKE '%$strDescripcion%')
				        				UNION 
				        				SELECT RM.refacciones_marca_id AS referencia_id, 
								        	   RM.descripcion AS referencia,
								        	   'MARCA' AS tipo_referencia $strRestriccionesMarca
								        FROM refacciones_marcas AS RM
								        WHERE RM.estatus = 'ACTIVO'
								        AND  (RM.descripcion LIKE '%$strDescripcion%')
	    	 							ORDER BY referencia ASC 
	    	 							LIMIT 0, $intLimite");

	    	return $strSQL->result();
	    }
	}
	
	/*******************************************************************************************************************
	Funciones de la tabla refacciones_promociones_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la promoción
	public function guardar_detalles(stdClass $objRefaccionPromocion)
	{
		/*Quitar | de la lista para obtener el tipo, ID de la referencia y descuento
		*/
		$arrTipos = explode("|", $objRefaccionPromocion->strTipos);
		$arrReferenciaID = explode("|", $objRefaccionPromocion->strReferenciaID);
		$arrDescuentos = explode("|", $objRefaccionPromocion->strDescuentos);

		//Hacer recorrido para insertar los datos en la tabla refacciones_promociones_detalles
		for ($intCon = 0; $intCon < sizeof($arrTipos); $intCon++) 
		{
			//Asignar datos al array
			$arrDatos = array('refaccion_promocion_id' => $objRefaccionPromocion->intRefaccionPromocionID,
							  'renglon' => ($intCon + 1),
							  'tipo' => $arrTipos[$intCon], 
							  'referencia_id' => $arrReferenciaID[$intCon],
							  'descuento' => $arrDescuentos[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('refacciones_promociones_detalles', $arrDatos);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intRefaccionPromocionID)
	{
		$this->db->select("RPD.refaccion_promocion_id, RPD.tipo, RPD.referencia_id, RPD.descuento,
						   CASE 
							   WHEN  RPD.tipo = 'REFACCION'
							   		THEN  CONCAT_WS(' - ', R.codigo_01, R.descripcion)
							   WHEN  RPD.tipo = 'KIT'
							   		THEN  CONCAT_WS(' - ', RK.codigo, RK.descripcion)
							    WHEN  RPD.tipo = 'LINEA'
							   		THEN  CONCAT_WS(' - ', RL.codigo, RL.descripcion)
							   ELSE RM.descripcion
						    END AS referencia", FALSE);
		$this->db->from('refacciones_promociones_detalles AS RPD');
		$this->db->join('refacciones AS R', 'RPD.referencia_id = R.refaccion_id
						 AND RPD.tipo = "REFACCION"', 'left');
		$this->db->join('refacciones_kits AS RK', 'RPD.referencia_id = RK.refaccion_kit_id 
						 AND RPD.tipo = "KIT"', 'left');
		$this->db->join('refacciones_lineas AS RL', 'RPD.referencia_id = RL.refacciones_linea_id
						  AND RPD.tipo = "LINEA"', 'left');
		$this->db->join('refacciones_marcas AS RM', 'RPD.referencia_id = RM.refacciones_marca_id
					     AND  RPD.tipo = "MARCA"', 'left');
		$this->db->where('RPD.refaccion_promocion_id', $intRefaccionPromocionID);
		$this->db->order_by('RPD.renglon', 'ASC');
		return $this->db->get()->result();
	}
}	
?>