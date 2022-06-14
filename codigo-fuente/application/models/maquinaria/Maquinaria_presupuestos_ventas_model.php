<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maquinaria_presupuestos_ventas_model extends CI_model {
	//Método para guardar los datos de un presupuesto nuevo
	public function guardar($arrDatos)
	{
		//Guardar los datos de los registros
		return $this->db->insert_batch('maquinaria_presupuestos_ventas', $arrDatos);
		
	}

	//Método para modificar los datos de un presupuesto previamente guardado
	public function modificar(stdClass $objMaquinariaPresupuestoVta)
	{

		//Actualizar los datos de los registros
		return $this->db->update_batch('maquinaria_presupuestos_ventas', $objMaquinariaPresupuestoVta->arrDatos, 'mes',
										array("vendedor_id = $objMaquinariaPresupuestoVta->intVendedorID
											   AND maquinaria_descripcion_id= $objMaquinariaPresupuestoVta->intMaquinariaDescripcionID
										   	   AND anio='$objMaquinariaPresupuestoVta->strAnio'"));
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intVendedorID, $intMaquinariaDescripcionID, $strAnio)
	{
		$this->db->select('cantidad, FORMAT(importe, 2) AS importe');
		$this->db->from('maquinaria_presupuestos_ventas');
		$this->db->where('vendedor_id', $intVendedorID);
        $this->db->where('maquinaria_descripcion_id', $intMaquinariaDescripcionID);
        $this->db->where('anio', $strAnio);
        return $this->db->get()->result();
	}
}
?>