<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maquinaria_presupuestos_compras_model extends CI_model {
	//Método para guardar los datos de un presupuesto nuevo
	public function guardar($arrDatos)
	{
		//Guardar los datos de los registros
		return $this->db->insert_batch('maquinaria_presupuestos_compras', $arrDatos);
		
	}

	//Método para modificar los datos de un presupuesto previamente guardado
	public function modificar(stdClass $objMaquinariaPresupuesto)
	{
		//Actualizar los datos de los registros
		return $this->db->update_batch('maquinaria_presupuestos_compras', 
										$objMaquinariaPresupuesto->arrDatos, 
										'mes', 
										array("maquinaria_descripcion_id= $objMaquinariaPresupuesto->intMaquinariaDescripcionID AND anio='$objMaquinariaPresupuesto->strAnio'"));
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intMaquinariaDescripcionID, $strAnio)
	{
		$this->db->select('cantidad, FORMAT(importe,2) AS importe');
		$this->db->from('maquinaria_presupuestos_compras');
        $this->db->where('maquinaria_descripcion_id', $intMaquinariaDescripcionID);
        $this->db->where('anio', $strAnio);
        return $this->db->get()->result();
	}
}
?>