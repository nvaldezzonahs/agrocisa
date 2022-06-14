<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mecanicos_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objMecanico)
	{
		//Asignar datos al array
		$arrDatos = array('empleado_id' => $objMecanico->intEmpleadoID,
						  'mecanico_tipo_id' => $objMecanico->intMecanicoTipoID, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMecanico->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('mecanicos', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objMecanico)
	{
		//Asignar datos al array
		$arrDatos = array('empleado_id' => $objMecanico->intEmpleadoID,
						  'mecanico_tipo_id' => $objMecanico->intMecanicoTipoID, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMecanico->intUsuarioID);
		$this->db->where('mecanico_id', $objMecanico->intMecanicoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('mecanicos', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intMecanicoID, $strEstatus)
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
		$this->db->where('mecanico_id', $intMecanicoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('mecanicos', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMecanicoID = NULL, $intEmpleadoID = NULL, $strBusqueda = NULL)
	{
		$this->db->select("M.mecanico_id, M.empleado_id, M.mecanico_tipo_id, M.estatus, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
						   CONCAT_WS(' - ', MT.codigo, MT.descripcion) AS mecanico_tipo", FALSE);
		$this->db->from('mecanicos AS M');
		$this->db->join('empleados AS E', 'M.empleado_id = E.empleado_id', 'inner');
		$this->db->join('mecanicos_tipos AS MT', 'M.mecanico_tipo_id = MT.mecanico_tipo_id', 'inner');
		//Si existe id del mecánico
		if ($intMecanicoID !== NULL)
		{   
			$this->db->where('M.mecanico_id', $intMecanicoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($intEmpleadoID !== NULL)//Si existe empleado
		{
			$this->db->where('M.empleado_id', $intEmpleadoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{	
			$this->db->like('M.estatus', $strBusqueda);
			$this->db->or_like('MT.codigo', $strBusqueda);
			$this->db->or_like('MT.descripcion', $strBusqueda);
			$this->db->or_like("CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre)", $strBusqueda);
		    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
			$this->db->order_by('E.apellido_paterno', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('M.estatus', $strBusqueda);
		$this->db->or_like("CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
		$this->db->from('mecanicos AS M');
		$this->db->join('empleados AS E', 'M.empleado_id = E.empleado_id', 'inner');
		$this->db->join('mecanicos_tipos AS MT', 'M.mecanico_tipo_id = MT.mecanico_tipo_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("M.mecanico_id, M.estatus, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
						   CONCAT_WS(' - ', MT.codigo, MT.descripcion) AS mecanico_tipo", FALSE);
		$this->db->from('mecanicos AS M');
		$this->db->join('empleados AS E', 'M.empleado_id = E.empleado_id', 'inner');
		$this->db->join('mecanicos_tipos AS MT', 'M.mecanico_tipo_id = MT.mecanico_tipo_id', 'inner');
		$this->db->like('M.estatus', $strBusqueda);
		$this->db->or_like('MT.codigo', $strBusqueda);
		$this->db->or_like('MT.descripcion', $strBusqueda);
		$this->db->or_like("CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
		$this->db->order_by('E.apellido_paterno', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["mecanicos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strTipo = NULL)
	{
		$this->db->select(" M.mecanico_id, M.estatus,
						    CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS mecanico,
						    MT.costo", FALSE);
        $this->db->from('mecanicos AS M');
		$this->db->join('empleados AS E', 'M.empleado_id = E.empleado_id', 'inner');
		$this->db->join('mecanicos_tipos AS MT', 'M.mecanico_tipo_id = MT.mecanico_tipo_id', 'inner');
		 //Si el Autocomplete se muestra en los reportes de acumulados (detallados)
		if($strTipo != 'acumulados')
		{
			$this->db->where('M.estatus', 'ACTIVO');
		}
        $this->db->where("((E.codigo LIKE '%$strDescripcion%') OR
        				   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strDescripcion%') OR 
			               (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strDescripcion%') OR 
			               (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strDescripcion%'))"); 
		$this->db->order_by('E.apellido_paterno', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>