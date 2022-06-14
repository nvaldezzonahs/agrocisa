<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_tipo_factor_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatTipoFactor)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objSatTipoFactor->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatTipoFactor->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_tipo_factor', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatTipoFactor)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objSatTipoFactor->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatTipoFactor->intUsuarioID);
		$this->db->where('tipo_factor_id', $objSatTipoFactor->intTipoFactorID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_tipo_factor', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intTipoFactorID, $strEstatus)
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
		$this->db->where('tipo_factor_id', $intTipoFactorID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_tipo_factor', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intTipoFactorID = NULL, $strDescripcion = NULL, $strBusqueda = NULL)
	{
		$this->db->select('tipo_factor_id, descripcion, estatus');
		$this->db->from('sat_tipo_factor');
		//Si existe id del tipo de factor
		if ($intTipoFactorID !== NULL)
		{   
			$this->db->where('tipo_factor_id', $intTipoFactorID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strDescripcion !== NULL)//Si existe descripción
		{
			$this->db->where('descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
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
		$this->db->from('sat_tipo_factor');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('tipo_factor_id, descripcion, estatus');
		$this->db->from('sat_tipo_factor');
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('descripcion','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["tipos_factor"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>