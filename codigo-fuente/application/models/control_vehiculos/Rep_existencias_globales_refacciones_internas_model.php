<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_existencias_globales_refacciones_internas_model extends CI_model {
	
	//Función para buscar la existencia de una refacción
	public function buscar_existencia($intRefaccionID){

		$this->db->select('RII.sucursal_id, S.nombre AS sucursal, 
						   RII.refaccion_id, RII.anio, 
						   RII.localizacion, RII.actual_existencia, 
						   RII.actual_costo');
		$this->db->from('refacciones_internas_inventario AS RII');
		$this->db->join('sucursales AS S', 'S.sucursal_id = RII.sucursal_id', 'inner');
		$this->db->where('RII.refaccion_id', $intRefaccionID);
		$this->db->where('RII.anio', date("Y"));
		return $this->db->get()->result();

	}
	
}

?>