<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_subtipo_remolque_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatSubtipo)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatSubtipo->strCodigo, 
						  'descripcion' => $objSatSubtipo->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatSubtipo->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_subtipo_remolque', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatSubtipo)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatSubtipo->strCodigo, 
						  'descripcion' => $objSatSubtipo->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatSubtipo->intUsuarioID);
		$this->db->where('subtipo_remolque_id', $objSatSubtipo->intSubtipoRemolqueID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_subtipo_remolque', $arrDatos);
	}
	
	//Método para modificar el estatus de un registro
	public function set_estatus($intSubtipoRemolqueID, $strEstatus)
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
		$this->db->where('subtipo_remolque_id', $intSubtipoRemolqueID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_subtipo_remolque', $arrDatos);
	}

	//Método para regresar los registros a un combobox
	public function get_combo_box()
	{	
		$this->db->select("subtipo_remolque_id AS value, CONCAT_WS(' - ', codigo, descripcion) AS nombre", FALSE);
		$this->db->from('sat_subtipo_remolque');
		$this->db->where('estatus', 'ACTIVO');
		$this->db->order_by('codigo','ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intSubtipoRemolqueID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select('subtipo_remolque_id, codigo, descripcion, estatus');
		$this->db->from('sat_subtipo_remolque');
		//Si existe id del registro
		if ($intSubtipoRemolqueID !== NULL)
		{   
			$this->db->where('subtipo_remolque_id', $intSubtipoRemolqueID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigo !== NULL)//Si existe código
		{
			$this->db->where('codigo', $strCodigo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('codigo', $strBusqueda);
	    	$this->db->or_like('descripcion', $strBusqueda);
	    	$this->db->or_like('estatus', $strBusqueda);
			$this->db->order_by('codigo', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('codigo', $strBusqueda);
	    $this->db->or_like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda); 
		$this->db->from('sat_subtipo_remolque');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('subtipo_remolque_id, codigo, descripcion, estatus');
		$this->db->from('sat_subtipo_remolque');
		$this->db->like('codigo', $strBusqueda);
	    $this->db->or_like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda); 
		$this->db->order_by('codigo','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["remolques"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>