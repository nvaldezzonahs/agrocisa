<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Motivos_suspension_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objMotivoSuspension)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objMotivoSuspension->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMotivoSuspension->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('motivos_suspension', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objMotivoSuspension)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objMotivoSuspension->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMotivoSuspension->intUsuarioID);
		$this->db->where('motivo_suspension_id', $objMotivoSuspension->intMotivoSuspensionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('motivos_suspension', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intMotivoSuspensionID, $strEstatus)
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
		$this->db->where('motivo_suspension_id', $intMotivoSuspensionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('motivos_suspension',$arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMotivoSuspensionID = NULL, $strDescripcion = NULL, $strBusqueda = NULL)
	{
		$this->db->select('motivo_suspension_id, descripcion, estatus');
		$this->db->from('motivos_suspension');
		//Si existe id de la actividad
		if ($intMotivoSuspensionID !== NULL)
		{   
			$this->db->where('motivo_suspension_id', $intMotivoSuspensionID);
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
		$this->db->from('motivos_suspension');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('motivo_suspension_id, descripcion, estatus');
		$this->db->from('motivos_suspension');
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["motivos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(' motivo_suspension_id, descripcion ');
        $this->db->from('motivos_suspension');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(descripcion LIKE '%$strDescripcion%')");  
        $this->db->order_by("descripcion",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>