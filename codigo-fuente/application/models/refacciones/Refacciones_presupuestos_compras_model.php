<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones_presupuestos_compras_model extends CI_model {
	//Método para guardar los datos de un presupuesto nuevo
	public function guardar($arrDatos)
	{
		//Guardar los datos de los registros
		return $this->db->insert_batch('refacciones_presupuestos_compras', $arrDatos);
		
	}

	//Método para modificar los datos de un presupuesto previamente guardado
	public function modificar(stdClass $objRefaccionesPresupuesto)
	{
		//Actualizar los datos de los registros
		return $this->db->update_batch('refacciones_presupuestos_compras', 
										$objRefaccionesPresupuesto->arrDatos, 'mes', 
										array("refacciones_linea_id= $objRefaccionesPresupuesto->intRefaccionesLineaID
										   	   AND anio='$objRefaccionesPresupuesto->strAnio'"));
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intRefaccionesLineaID, $strAnio)
	{
		$this->db->select('FORMAT(importe,2) AS importe');
		$this->db->from('refacciones_presupuestos_compras');
        $this->db->where('refacciones_linea_id', $intRefaccionesLineaID);
        $this->db->where('anio', $strAnio);
        return $this->db->get()->result();
	}
}
?>