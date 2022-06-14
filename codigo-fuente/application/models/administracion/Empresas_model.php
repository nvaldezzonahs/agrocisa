<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas_model extends CI_model {
	//Método para modificar los datos del registro previamente guardado
	public function modificar(stdClass $objEmpresa)
	{
		//Asignar datos al array
		$arrDatos = array('razon_social' => $objEmpresa->strRazonSocial, 
						  'nombre_comercial' => $objEmpresa->strNombreComercial,
						  'rfc' => $objEmpresa->strRfc,
						  'regimen_fiscal_id' => $objEmpresa->intRegimenFiscalID,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objEmpresa->intUsuarioID);
		$this->db->where('empresa_id', $objEmpresa->intEmpresaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('empresas',$arrDatos);
	}

	//Método para regresar los datos del registro 
	public function buscar($intSucursalID = NULL)
	{
		$this->db->select("E.razon_social,E.nombre_comercial, E.rfc, 
					       E.regimen_fiscal_id, CONCAT_WS(' - ', RF.codigo, RF.descripcion) AS regimen_fiscal, 
					       RF.codigo AS RegimenFiscal, S.codigo_postal", FALSE);
		$this->db->from('empresas AS E');
		$this->db->join('sat_regimen_fiscal AS RF', 'E.regimen_fiscal_id = RF.regimen_fiscal_id', 'inner');
		$this->db->join('sucursales AS S', 'E.empresa_id = S.empresa_id', 'inner');
		$this->db->where('E.empresa_id', $this->session->userdata('empresa_id'));
		//Si existe id de la sucursal
		if ($intSucursalID !== NULL)
		{   
			$this->db->where('S.sucursal_id', $intSucursalID);
		}

		$this->db->limit(1);
		return $this->db->get()->row();
	}
}
?>