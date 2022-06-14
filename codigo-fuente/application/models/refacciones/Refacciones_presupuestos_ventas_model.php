<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones_presupuestos_ventas_model extends CI_model {
	//Método para guardar los datos de un presupuesto nuevo
	public function guardar($arrDatos)
	{
		//Guardar los datos de los registros
		return $this->db->insert_batch('refacciones_presupuestos_ventas', $arrDatos);
		
	}

	//Método para modificar los datos de un presupuesto previamente guardado
	public function modificar(stdClass $objRefaccionesPresupuestoVta)
	{
		//Actualizar los datos de los registros
		return $this->db->update_batch('refacciones_presupuestos_ventas', 
										$objRefaccionesPresupuestoVta->arrDatos, 'mes', 
										array("vendedor_id = $objRefaccionesPresupuestoVta->intVendedorID 
										   	   AND refacciones_linea_id= $objRefaccionesPresupuestoVta->intRefaccionesLineaID
										   	   AND anio='$objRefaccionesPresupuestoVta->strAnio'"));
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intVendedorID, $intRefaccionesLineaID, $strAnio)
	{
		$this->db->select('FORMAT(importe,2) AS importe');
		$this->db->from('refacciones_presupuestos_ventas');
		$this->db->where('vendedor_id', $intVendedorID);
        $this->db->where('refacciones_linea_id', $intRefaccionesLineaID);
        $this->db->where('anio', $strAnio);
        return $this->db->get()->result();
	}
}
?>