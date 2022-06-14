<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verificaciones_federales_model extends CI_model {
	
	//Método para guardar los datos de una verificación federal nueva
	public function guardar($intDigito, $arrDatos)
	{
		//Asignar datos al array
		$arrDatos = array('digito' => $intDigito, 
						  'meses' => $arrDatos,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		return $this->db->insert('verificaciones_federales', $arrDatos);
		
	}

	//Método para modificar los datos de una verificación federal previamente guardada
	public function modificar($intDigito, $arrDatos)
	{
		//Asignar datos al array
		$arrDatos = array('meses' => $arrDatos,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('digito', $intDigito);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('verificaciones_federales', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('digito', $strBusqueda);
		$this->db->from('verificaciones_federales');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('digito, meses');
		$this->db->from('verificaciones_federales');
		$this->db->like('digito', $strBusqueda);
		$this->db->order_by('digito', 'ASC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["verificaciones_federales"] =$this->db->get()->result();
		
		return $arrResultado;
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intDigito = NULL)
	{
		$this->db->select('	VF.digito, 
							VF.meses', FALSE);
		$this->db->from('verificaciones_federales VF');
        if($intDigito != NULL){
        	$this->db->where('VF.digito', $intDigito);
        }
        
        return $this->db->get()->result();
	}


}
?>