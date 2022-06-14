<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verificaciones_estatales_model extends CI_model {
	
	//Método para guardar los datos de una verificación estatal nueva
	public function guardar($arrDatos)
	{
		//Guardar los datos de los registros
		return $this->db->insert_batch('verificaciones_estatales', $arrDatos);
		
	}

	//Método para modificar los datos de una verificación estatal previamente guardada
	public function modificar($intEstadoID, $arrDatos)
	{
		//Actualizar los datos de los registros
		return $this->db->update_batch('verificaciones_estatales', $arrDatos, 'mes', array("estado_id = $intEstadoID"));
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda = NULL, $intNumRows = NULL, $intPos = NULL)
	{
		
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->select("	DISTINCT COUNT(DISTINCT VE.estado_id) AS numrows", FALSE);
		$this->db->from('verificaciones_estatales VE');
		$this->db->join('sat_estados SE', 'SE.estado_id = VE.estado_id', 'inner');
		$this->db->like('SE.codigo', $strBusqueda);
		$this->db->or_like('SE.descripcion', $strBusqueda);
		$numrows = $this->db->get()->result();
		$arrResultado["total_rows"] = (int)$numrows[0]->numrows;

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("	DISTINCT VE.estado_id,
							CONCAT_WS('-', SE.codigo, SE.descripcion) AS verificacion_estado", FALSE);
		$this->db->from('verificaciones_estatales VE');
		$this->db->join('sat_estados SE', 'SE.estado_id = VE.estado_id', 'inner');
		if($strBusqueda != NULL){
			$this->db->like('SE.codigo', $strBusqueda);
			$this->db->or_like('SE.descripcion', $strBusqueda);
		}
		if($intNumRows != NULL && $intPos != NULL){
			$this->db->limit($intNumRows, $intPos);
		}
		$this->db->order_by('verificacion_estado', 'ASC');
		$arrResultado["verificaciones_estatales"] = $this->db->get()->result();
		
		return $arrResultado;
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intEstadoID = NULL)
	{
		$this->db->select('	VE.estado_id, 
							VE.mes, 
					        VE.digitos,
					        CONCAT_WS(" - ", SE.codigo, SE.descripcion) AS verificacion_estado', FALSE);
		$this->db->from('verificaciones_estatales VE');
		$this->db->join('sat_estados SE', 'SE.estado_id = VE.estado_id', 'inner');
        if($intEstadoID != NULL){
        	$this->db->where('VE.estado_id', $intEstadoID);
        }
        
        return $this->db->get()->result();
	}


}
?>