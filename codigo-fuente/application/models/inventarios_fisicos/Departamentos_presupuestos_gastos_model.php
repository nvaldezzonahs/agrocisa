<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departamentos_presupuestos_gastos_model extends CI_model {
	//Método para guardar los datos de un presupuesto nuevo
	public function guardar($arrDatos)
	{
		//Guardar los datos de los registros
		return $this->db->insert_batch('departamentos_presupuestos_gastos', $arrDatos);
		
	}

	//Método para modificar los datos de un presupuesto previamente guardado
	public function modificar(stdClass $objDepartamentoPresupuesto)
	{
		//Actualizar los datos de los registros
		return $this->db->update_batch('departamentos_presupuestos_gastos', $objDepartamentoPresupuesto->arrDatos, 'mes', 
										array("sucursal_id = $objDepartamentoPresupuesto->intSucursalID AND departamento_id= $objDepartamentoPresupuesto->intDepartamentoID
										   	   AND anio='$objDepartamentoPresupuesto->strAnio'"));
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intScurasalID,$intDepartamentoID, $strAnio)
	{
		$this->db->select('FORMAT(importe,2) AS importe');
		$this->db->from('departamentos_presupuestos_gastos');
		$this->db->where('sucursal_id', $intScurasalID);
        $this->db->where('departamento_id', $intDepartamentoID);
        $this->db->where('anio', $strAnio);
        return $this->db->get()->result();
	}
}
?>