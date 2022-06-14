<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Porcentaje_retencion_iva_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objPorcentajeRetencion)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objPorcentajeRetencion->strDescripcion,
						  'porcentaje' => $objPorcentajeRetencion->intPorcentaje, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objPorcentajeRetencion->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('porcentaje_retencion_iva', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objPorcentajeRetencion)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objPorcentajeRetencion->strDescripcion, 
						  'porcentaje' => $objPorcentajeRetencion->intPorcentaje, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objPorcentajeRetencion->intUsuarioID);
		$this->db->where('porcentaje_retencion_id', $objPorcentajeRetencion->intPorcentajeRetencionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('porcentaje_retencion_iva', $arrDatos);
	}
	
	//Método para modificar el estatus de un registro
	public function set_estatus($intPorcentajeRetencionID, $strEstatus)
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
		$this->db->where('porcentaje_retencion_id', $intPorcentajeRetencionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('porcentaje_retencion_iva', $arrDatos);
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intPorcentajeRetencionID = NULL,  $strBusqueda = NULL)
	{
		$this->db->select('porcentaje_retencion_id, descripcion, porcentaje, estatus');
		$this->db->from('porcentaje_retencion_iva');
		//Si existe id del país
		if ($intPorcentajeRetencionID !== NULL)
		{   
			$this->db->where('porcentaje_retencion_id', $intPorcentajeRetencionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('descripcion', $strBusqueda);
	    	$this->db->or_like('porcentaje', $strBusqueda);
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
    	$this->db->or_like('porcentaje', $strBusqueda);
    	$this->db->or_like('estatus', $strBusqueda);
		$this->db->from('porcentaje_retencion_iva');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('porcentaje_retencion_id, descripcion, porcentaje, estatus');
		$this->db->from('porcentaje_retencion_iva');
		$this->db->like('descripcion', $strBusqueda);
    	$this->db->or_like('porcentaje', $strBusqueda);
    	$this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["porcentajes"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>