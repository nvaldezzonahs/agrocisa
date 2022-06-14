<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Movimiento_caja_herramientas_model extends CI_model {

	//Método para guardar un registro nuevo
	public function guardar(stdClass $objMovimientoHerramienta)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		//Tabla movimientos_herramientas
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimientoHerramienta->strFolio); 

		//Asignar datos al array
		$arrDatos = array('tipo_movimiento' => $objMovimientoHerramienta->intTipoID,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objMovimientoHerramienta->dteFecha,  
						  'mecanico_id' => $objMovimientoHerramienta->intMecanicoID, 
						  'observaciones' => $objMovimientoHerramienta->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimientoHerramienta->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('movimientos_herramientas', $arrDatos);
		//Agregar id del nuevo registro al objeto
		$objMovimientoHerramienta->intMovimientoCajaHerramientaID  = $this->db->insert_id();
		
		//Hacer un llamado al método para guardar los detalles de la entrada por insumo
		$this->guardar_detalles($objMovimientoHerramienta);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimientoHerramienta->intMovimientoCajaHerramientaID.'_'.$strFolioConsecutivo;
		
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objMovimientoHerramienta)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();

		/**************************************************************************************************
		* 1. Modificar el encabezado del movimiento en la tabla movimientos_insumos		
		***************************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('tipo_movimiento' => $objMovimientoHerramienta->intTipoID, 
						  'fecha' => $objMovimientoHerramienta->dteFecha,  
						  'mecanico_id' => $objMovimientoHerramienta->intMecanicoID, 
						  'observaciones' => $objMovimientoHerramienta->strObservaciones,
						  'estatus' => 'ACTIVO', 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimientoHerramienta->intUsuarioID);
		$this->db->where('movimiento_herramienta_id', $objMovimientoHerramienta->intMovimientoCajaHerramientaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_herramientas', $arrDatos);
		
		/********************************************************************************************************
		* 2. Seleccionar los detalles del movimiento de la tabla movimientos_herramientas_detalles		
		********************************************************************************************************/
		$arrDetalles = $this->buscar_detalles($objMovimientoHerramienta->intMovimientoCajaHerramientaID);

		/*******************************************************************************************************
		* 3. Seleccionar existencia para cada herramienta en el grid del movimiento 		
		*******************************************************************************************************/
		for($i=0; $i<sizeof($arrDetalles); $i++){

			$numExistencia = 0;

			$this->db->select('MH.movimiento_herramienta_id,
							   MH.tipo_movimiento, 
							   MH.folio,
						       MH.fecha,
						       MH.mecanico_id,
						       MH.observaciones,
							   MHD.renglon,
							   MHD.herramienta_id, 
							   MHD.cantidad');
			$this->db->from('movimientos_herramientas MH');
			$this->db->join('movimientos_herramientas_detalles MHD', 'MHD.movimiento_herramienta_id = MH.movimiento_herramienta_id', 'inner');
			$this->db->where('MHD.herramienta_id', $arrDetalles[$i]->herramienta_id);
			$this->db->where('MH.mecanico_id', $objMovimientoHerramienta->intMecanicoID);
			$this->db->where('MH.estatus !=', 'INACTIVO');
			$this->db->where('MH.movimiento_herramienta_id !=', $objMovimientoHerramienta->intMovimientoCajaHerramientaID);
			$arrMovimientos = $this->db->get()->result();
			 
			for($j=0; $j<sizeof($arrMovimientos); $j++){

				if ($arrMovimientos[$j]->tipo_movimiento < 11){
	                $numExistencia += $arrMovimientos[$j]->cantidad;
				}
				else
				{
					$numExistencia -= $arrMovimientos[$j]->cantidad;
				}

			}

			/******************************************************************************************************
			* 4. Actualizar existencia actual y costo actual por cada registro de la tabla herramientas_inventario		
			*******************************************************************************************************/
			//Actualizar los datos del registro
			$arrInventario = array('cantidad' => $numExistencia);
			$this->db->where('mecanico_id', $objMovimientoHerramienta->intMecanicoID);
			$this->db->where('herramienta_id', $arrDetalles[$i]->herramienta_id);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('herramientas_inventario', $arrInventario);
		}

		/******************************************************************************************************
		* 5. Eliminar los detalles del movimiento en la tabla movimientos_herramientas_detalles		
		******************************************************************************************************/
		$this->db->where('movimiento_herramienta_id', $objMovimientoHerramienta->intMovimientoCajaHerramientaID);
		$this->db->delete('movimientos_herramientas_detalles');

		/*************************************************************************************
		* 6. Guardar detalles del movimiento en la tabla movimientos_herramientas_detalles		
		**************************************************************************************/
		$this->guardar_detalles($objMovimientoHerramienta);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();	

	}

	//Función que se utiliza para guardar los detalles del movimiento
	public function guardar_detalles(stdClass $objMovimientoHerramienta)
	{
		/*Quitar | de la lista para obtener la herramienta_id, cantidad
		*/
		$arrHerramientaID = explode("|", $objMovimientoHerramienta->strHerramientaID);
		$arrCantidades = explode("|", $objMovimientoHerramienta->strCantidades);

		//Hacer recorrido para insertar los datos en la tabla movimientos_herramientas_detalles
		for ($intCon = 0; $intCon < sizeof($arrHerramientaID); $intCon++) 
		{
			//Obtener el ID correspondiente a ese concepto (INSUMO)
			$intHerramientaID = $arrHerramientaID[$intCon];
			$numCantidad = $arrCantidades[$intCon];
	
			//Asignar datos al array
			$arrDatos = array('movimiento_herramienta_id' => $objMovimientoHerramienta->intMovimientoCajaHerramientaID,
							  'renglon' => ($intCon + 1),
							  'herramienta_id' => $intHerramientaID, 
							  'cantidad' => $numCantidad);
			//Guardar los datos del registro
			$this->db->insert('movimientos_herramientas_detalles', $arrDatos);

			//Actualizar existencia de la herramienta en el Inventario
			$objExistencia = $this->get_existencia($intHerramientaID, $objMovimientoHerramienta->intMecanicoID);
			
			//Si la existencia no es NULL. Es decir, ya se encuentra dada de alta la relación entre un mecanico_id y una herramienta_id. Actualizamos la existencia. Caso contrario, insertamos un nuevo registro en la tabla: herramientas_inventario
			if($objExistencia){
				//Obtenemos la existencia actual
				$numExistencia = $objExistencia->cantidad;

				//Sumamos a la existencia. Caso contrario restamos
				if($objMovimientoHerramienta->intTipoID < 11){
					$numExistencia += $numCantidad;
				}
				else{
					$numExistencia -= $numCantidad;
				}

				//Actualizar los datos del registro
				$arrInventario = array('cantidad' => $numExistencia);
				$this->db->where('mecanico_id', $objMovimientoHerramienta->intMecanicoID);
				$this->db->where('herramienta_id', $intHerramientaID);
				$this->db->limit(1);
				//Actualizar los datos del registro
				$this->db->update('herramientas_inventario', $arrInventario);
			}
			else{

				//Sumamos a la existencia. Caso contrario restamos
				if($objMovimientoHerramienta->intTipoID < 11){
					$numExistencia = $numCantidad;
				}
				else{
					$numExistencia = $numCantidad * -1;
				}

				$arrInventario = array('mecanico_id' => $objMovimientoHerramienta->intMecanicoID,
									   'herramienta_id' => $intHerramientaID,
									   'cantidad' => $numExistencia
									  );
				//Guardar los datos del registro
				$this->db->insert('herramientas_inventario', $arrInventario);
			}	
			
		}
	}

	//Función para obtener la existencia acorde a la relación entre un Mecanico y una Herramienta
	public function get_existencia($intHerramientaID, $intMecanicoID){

		$this->db->select('cantidad');
		$this->db->from('herramientas_inventario');
		$this->db->where('mecanico_id', $intMecanicoID);
		$this->db->where('herramienta_id', $intHerramientaID);
		$this->db->limit(1);

		return $this->db->get()->row();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMovimientoCajaHerramientaID){
		
		$this->db->select("	MH.movimiento_herramienta_id,
							MH.tipo_movimiento,
							CASE MH.tipo_movimiento 
							   WHEN '1' then 'ASIGNACIÓN' 
							   WHEN '11' then 'ELIMINACIÓN'
						    END AS movimiento,  
					        MH.folio,
					        DATE_FORMAT(MH.fecha, '%d/%m/%Y') AS fecha,
					        MH.mecanico_id,
					        CONCAT(E.codigo, ' - ' , E.nombre, ' ', E.apellido_paterno, ' ', E.apellido_materno) AS mecanico,
					        MH.observaciones,
					        MH.estatus,
					        MH.usuario_creacion", FALSE);
	    $this->db->from('movimientos_herramientas MH');
	    $this->db->join('mecanicos AS M', 'M.mecanico_id = MH.mecanico_id', 'inner');
		$this->db->join('empleados AS E', 'E.empleado_id = M.empleado_id', 'inner');
	    $this->db->where('MH.movimiento_herramienta_id', $intMovimientoCajaHerramientaID);
	    
	    return $this->db->get()->row();	

	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL,  $intMecanicoID = NULL, $intNumRows, $intPos)
	{
		
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("DATE(MH.fecha) BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    if($intMecanicoID != 0){
	    	$this->db->where("MH.mecanico_id", $intMecanicoID);
	    } 
		$this->db->from('movimientos_herramientas MH');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MH.movimiento_herramienta_id,
						   MH.tipo_movimiento,
						   CASE MH.tipo_movimiento 
							   WHEN '1' then 'ASIGNACIÓN' 
							   WHEN '11' then 'ELIMINACIÓN'
						   END AS movimiento,  
						   MH.folio, 
					       DATE_FORMAT(MH.fecha, '%d/%m/%Y') AS fecha,
					       MH.mecanico_id,
					       CONCAT(E.nombre, ' ', E.apellido_paterno, ' ', E.apellido_materno) AS mecanico,
					       MH.estatus", FALSE);
		$this->db->from('movimientos_herramientas MH');
		$this->db->join('mecanicos AS M', 'M.mecanico_id = MH.mecanico_id', 'inner');
		$this->db->join('empleados AS E', 'E.empleado_id = M.empleado_id', 'inner');
	    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("DATE(MH.fecha) BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    if($intMecanicoID != 0){
	    	$this->db->where("MH.mecanico_id", $intMecanicoID);
	    } 
		$this->db->order_by('MH.folio', 'DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		
		return $arrResultado;
	
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intMovimientoCajaHerramientaID, $strEstatus)
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

		$this->db->where('movimiento_herramienta_id', $intMovimientoCajaHerramientaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_herramientas', $arrDatos);

		/*************************************************************************************
		* 2. Seleccionar los detalles del movimiento de la tabla movimientos_insumos_detalles		
		**************************************************************************************/
		$arrDetalles = $this->buscar_detalles($intMovimientoCajaHerramientaID);

		/*************************************************************************************
		* 3. Seleccionar existencia por cada registro de la tabla herramientas_inventario		
		**************************************************************************************/
		for($i=0; $i<sizeof($arrDetalles); $i++){

			$herramienta_id = $arrDetalles[$i]->herramienta_id;
			$mecanico_id = $arrDetalles[$i]->mecanico_id;
			
			$objInventario = $this->get_existencia($herramienta_id, $mecanico_id);

			$numExistencia = $objInventario->cantidad;

			//Preguntar por el tipo de movimiento
			if($arrDetalles[$i]->tipo_movimiento == 1){ //Movimiento de tipo ASIGNACIÓN (1)
				
				if($strEstatus == 'ACTIVO'){ //Pasa de estar INACTIVO a ACTIVO
					$numExistencia += $arrDetalles[$i]->cantidad;
				}
				else{
					$numExistencia -= $arrDetalles[$i]->cantidad;
				}

			} 
			else{ //Movimiento de tipo ELIMINACIÓN (11)

				if($strEstatus == 'ACTIVO'){ //Pasa de estar INACTIVO a ACTIVO
					$numExistencia -= $arrDetalles[$i]->cantidad;
				}
				else{
					$numExistencia += $arrDetalles[$i]->cantidad;
				}

			}
			
			/*************************************************************************************
			* 4. Actualizar existencia por cada registro de la tabla herramientas_inventario		
			**************************************************************************************/
			//Actualizar los datos del registro
			$arrInventario = array('cantidad' => $numExistencia);
			$this->db->where('mecanico_id', $mecanico_id);
			$this->db->where('herramienta_id', $herramienta_id);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('herramientas_inventario', $arrInventario);

		}

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intMovimientoCajaHerramientaID)
	{
		$this->db->select("	MHD.movimiento_herramienta_id,
							MHD.renglon,
							MHD.herramienta_id,
							MHD.cantidad,
							MH.tipo_movimiento,
							H.codigo,
							H.descripcion", FALSE);
		$this->db->from('movimientos_herramientas_detalles MHD');
		$this->db->join('movimientos_herramientas MH', 'MH.movimiento_herramienta_id = MHD.movimiento_herramienta_id', 'inner');
		$this->db->join('herramientas H', 'H.herramienta_id = MHD.herramienta_id', 'inner');
		$this->db->where('MHD.movimiento_herramienta_id', $intMovimientoCajaHerramientaID);
		$this->db->order_by('MHD.renglon', 'ASC');

		return $this->db->get()->result();

	}
}
?>