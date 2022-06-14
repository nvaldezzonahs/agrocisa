<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Choferes_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objChofer)
	{
		//Asignar datos al array
		$arrDatos = array('empleado_id' => $objChofer->intEmpleadoID, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objChofer->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('choferes', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objChofer)
	{
		//Asignar datos al array
		$arrDatos = array('empleado_id' => $objChofer->intEmpleadoID, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objChofer->intUsuarioID);
		$this->db->where('chofer_id', $objChofer->intChoferID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('choferes', $arrDatos);
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intChoferID, $strEstatus)
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
		$this->db->where('chofer_id', $intChoferID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('choferes', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intChoferID = NULL, $intEmpleadoID = NULL, $strBusqueda = NULL)
	{
		$this->db->select("C.chofer_id, C.empleado_id, C.estatus, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado", FALSE);
		$this->db->from('choferes AS C');
		$this->db->join('empleados AS E', 'C.empleado_id = E.empleado_id', 'inner');
		//Si existe id del chofer
		if ($intChoferID !== NULL)
		{   
			$this->db->where('C.chofer_id', $intChoferID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($intEmpleadoID !== NULL)//Si existe empleado
		{
			$this->db->where('C.empleado_id', $intEmpleadoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{

			$this->db->like('C.estatus', $strBusqueda);
			$this->db->or_like('E.codigo', $strBusqueda);
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
		$this->db->like('C.estatus', $strBusqueda);
		$this->db->or_like('E.codigo', $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
		$this->db->from('choferes AS C');
		$this->db->join('empleados AS E', 'C.empleado_id = E.empleado_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("C.chofer_id, C.estatus, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado", FALSE);
		$this->db->from('choferes AS C');
		$this->db->join('empleados AS E', 'C.empleado_id = E.empleado_id', 'inner');
		$this->db->like('C.estatus', $strBusqueda);
		$this->db->or_like('E.codigo', $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
		$this->db->order_by('E.apellido_paterno', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["choferes"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" C.chofer_id, 
						    CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS chofer ", FALSE);
        $this->db->from('choferes AS C');
		$this->db->join('empleados AS E', 'C.empleado_id = E.empleado_id', 'inner');
		$this->db->where('C.estatus', 'ACTIVO');
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