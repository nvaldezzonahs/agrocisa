<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla servicios
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objServicio)
	{

		//Asignar datos al array
		$arrDatos = array('codigo' => $objServicio->strCodigo, 
						  'producto_servicio_id' => $objServicio->intProductoServicioID, 
						  'unidad_id' => $objServicio->intUnidadID, 
						  'objeto_impuesto_id' => $objServicio->intObjetoImpuestoID, 
						  'descripcion' => $objServicio->strDescripcion,
						  'horas' => $objServicio->intHoras,
						  'tasa_cuota_iva' => $objServicio->intTasaCuotaIva,
						  'tasa_cuota_ieps' => $objServicio->intTasaCuotaIeps,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objServicio->intUsuarioID);
		//Guardar los datos del registro
	    return $this->db->insert('servicios', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objServicio)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objServicio->strCodigo, 
						  'producto_servicio_id' => $objServicio->intProductoServicioID, 
						  'unidad_id' => $objServicio->intUnidadID, 
						  'objeto_impuesto_id' => $objServicio->intObjetoImpuestoID, 
						  'descripcion' => $objServicio->strDescripcion,
						  'horas' => $objServicio->intHoras,
						  'tasa_cuota_iva' => $objServicio->intTasaCuotaIva,
						  'tasa_cuota_ieps' => $objServicio->intTasaCuotaIeps,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objServicio->intUsuarioID);
		$this->db->where('servicio_id', $objServicio->intServicioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('servicios', $arrDatos);
	}


    //Método para modificar el estatus de un registro
	public function set_estatus($intServicioID, $strEstatus)
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
		$this->db->where('servicio_id', $intServicioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('servicios', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intServicioID = NULL, $strCodigo = NULL, $strBusqueda = NULL, $strEstatus = NULL)
	{
		$this->db->select("S.servicio_id, S.codigo, S.producto_servicio_id, S.unidad_id,
						   S.objeto_impuesto_id, S.descripcion, S.tasa_cuota_iva, 
						   S.tasa_cuota_ieps, 
						   TIva.valor_maximo AS porcentaje_iva,
						   TIeps.valor_maximo AS porcentaje_ieps,
						   S.horas, S.estatus,
						   CONCAT_WS(' - ', PS.codigo, PS.descripcion) AS producto_servicio, 
						   CONCAT_WS(' - ', U.codigo, U.nombre) AS unidad, 
						   CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto", FALSE);
		$this->db->from('servicios AS S');
		$this->db->join('sat_productos_servicios AS PS', 'S.producto_servicio_id = PS.producto_servicio_id', 'inner');
		$this->db->join('sat_unidades AS U', 'S.unidad_id = U.unidad_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'S.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIeps', 'S.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
	    $this->db->join('sat_objeto_impuesto AS OImp', 'S.objeto_impuesto_id = OImp.objeto_impuesto_id', 'left');
		
		//Si existe id del servicio
		if ($intServicioID !== NULL)
		{   
			$this->db->where('S.servicio_id', $intServicioID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigo !== NULL)//Si existe código
		{
			$this->db->where('S.codigo', $strCodigo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			//Si existe estatus 
			if($strEstatus !== NULL)
			{
				$this->db->where('S.estatus', $strEstatus);
			}

			$this->db->where("((S.codigo LIKE '%$strBusqueda%') OR
			 				   (S.descripcion LIKE '%$strBusqueda%') OR
			 				   (S.estatus LIKE '%$strBusqueda%') OR
			        		   (CONCAT_WS(' - ', PS.codigo, PS.descripcion) LIKE '%$strBusqueda%') OR 
	        				   (CONCAT_WS(' - ', U.codigo, U.nombre) LIKE '%$strBusqueda%'))");
			$this->db->order_by('S.codigo', 'ASC');
			return $this->db->get()->result();
		}
	}

	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $strEstatus = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe estatus 
		if($strEstatus !== NULL)
		{
			$this->db->where('S.estatus', $strEstatus);
		}
		$this->db->where("((S.codigo LIKE '%$strBusqueda%') OR
			 			   (S.descripcion LIKE '%$strBusqueda%') OR
			 			   (S.estatus LIKE '%$strBusqueda%') OR
			        	   (CONCAT_WS(' - ', PS.codigo, PS.descripcion) LIKE '%$strBusqueda%') OR 
	        			   (CONCAT_WS(' - ', U.codigo, U.nombre) LIKE '%$strBusqueda%'))");
		$this->db->from('servicios AS S');
		$this->db->join('sat_productos_servicios AS PS', 'S.producto_servicio_id = PS.producto_servicio_id', 'inner');
		$this->db->join('sat_unidades AS U', 'S.unidad_id = U.unidad_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'S.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("S.servicio_id, S.codigo, S.descripcion, S.estatus,
						   CONCAT_WS(' - ', PS.codigo, PS.descripcion) AS producto_servicio, 
						   CONCAT_WS(' - ', U.codigo, U.nombre) AS unidad", FALSE);
		$this->db->from('servicios AS S');
		$this->db->join('sat_productos_servicios AS PS', 'S.producto_servicio_id = PS.producto_servicio_id', 'inner');
		$this->db->join('sat_unidades AS U', 'S.unidad_id = U.unidad_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'S.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		//Si existe estatus 
		if($strEstatus !== NULL)
		{
			$this->db->where('S.estatus', $strEstatus);
		}
		$this->db->where("((S.codigo LIKE '%$strBusqueda%') OR
			 			   (S.descripcion LIKE '%$strBusqueda%') OR
			 			   (S.estatus LIKE '%$strBusqueda%') OR
			        	   (CONCAT_WS(' - ', PS.codigo, PS.descripcion) LIKE '%$strBusqueda%') OR 
	        			   (CONCAT_WS(' - ', U.codigo, U.nombre) LIKE '%$strBusqueda%'))");
		$this->db->order_by('S.codigo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["servicios"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" servicio_id,
						    CONCAT_WS(' - ', codigo, descripcion) AS servicio ", FALSE);
        $this->db->from('servicios');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(codigo LIKE '%$strDescripcion%' OR
        				   descripcion LIKE '%$strDescripcion%')");  
        $this->db->order_by("codigo",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}



	/*******************************************************************************************************************
	Funciones de la tabla equipos_tipos_precios
	*********************************************************************************************************************/
	//Método para regresar los datos de un precio correspondiente a un servicio-equipo
	public function buscar_servicio_equipo_precio($intServicioTipoID = NULL, $intEquipoTipoID = NULL)
	{
		$this->db->select('precio');
		$this->db->from('equipos_tipos_precios');
		$this->db->where('servicio_tipo_id', $intServicioTipoID);
		$this->db->where('equipo_tipo_id', $intEquipoTipoID);
		return $this->db->get()->result();
	}

}
?>