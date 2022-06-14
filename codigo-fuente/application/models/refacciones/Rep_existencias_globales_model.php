<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_existencias_globales_model extends CI_model {
	
	//Función para buscar la existencia de una refacción
	public function buscar_existencia($intRefaccionID){

		$this->db->select('RI.sucursal_id, S.nombre AS sucursal, 
						   RI.refaccion_id, RI.anio, 
						   RI.localizacion, RI.actual_existencia, 
						   RI.disponible_existencia, RI.actual_costo');
		$this->db->from('refacciones_inventario AS RI');
		$this->db->join('sucursales AS S', 'S.sucursal_id = RI.sucursal_id', 'inner');
		$this->db->where('RI.refaccion_id', $intRefaccionID);
		$this->db->where('RI.anio', date("Y"));
		return $this->db->get()->result();

	}
	
}

?>