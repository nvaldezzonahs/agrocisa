<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentos_empleados_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objDocumento)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objDocumento->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objDocumento->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('documentos_empleados', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objDocumento)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objDocumento->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objDocumento->intUsuarioID);
		$this->db->where('documento_empleado_id', $objDocumento->intDocumentoEmpleadoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('documentos_empleados', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intDocumentoEmpleadoID, $strEstatus)
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
		$this->db->where('documento_empleado_id', $intDocumentoEmpleadoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('documentos_empleados', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intDocumentoEmpleadoID = NULL, $strDescripcion = NULL, $strBusqueda = NULL, 
						   $strEstatus = NULL)
	{
		$this->db->select('documento_empleado_id, descripcion, estatus');
		$this->db->from('documentos_empleados');
		//Si existe id del documento
		if ($intDocumentoEmpleadoID !== NULL)
		{   
			$this->db->where('documento_empleado_id', $intDocumentoEmpleadoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strDescripcion !== NULL)//Si existe descripción
		{
			$this->db->where('descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if($strEstatus !== NULL)//Si existe estatus
		{
			$this->db->where('estatus', $strEstatus);
			return $this->db->get()->result();
		}
		else
		{
			$this->db->like('descripcion', $strBusqueda);
	        $this->db->or_like('estatus', $strBusqueda); 
			$this->db->order_by('descripcion', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda); 
		$this->db->from('documentos_empleados');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('documento_empleado_id, descripcion, estatus');
		$this->db->from('documentos_empleados');
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["documentos"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>