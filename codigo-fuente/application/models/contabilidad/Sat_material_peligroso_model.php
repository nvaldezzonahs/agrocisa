<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_material_peligroso_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatMaterial)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatMaterial->strCodigo, 
						  'descripcion' => $objSatMaterial->strDescripcion, 
						  'clase' => $objSatMaterial->strClase, 
						  'peligro_secundario' => $objSatMaterial->strPeligroSecundario, 
						  'nombre_tecnico' => $objSatMaterial->strNombreTecnico, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatMaterial->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_material_peligroso', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatMaterial)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatMaterial->strCodigo, 
						  'descripcion' => $objSatMaterial->strDescripcion, 
						  'clase' => $objSatMaterial->strClase, 
						  'peligro_secundario' => $objSatMaterial->strPeligroSecundario, 
						  'nombre_tecnico' => $objSatMaterial->strNombreTecnico, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatMaterial->intUsuarioID);
		$this->db->where('material_peligroso_id', $objSatMaterial->intMaterialPeligrosoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_material_peligroso', $arrDatos);
	}
	
	//Método para modificar el estatus de un registro
	public function set_estatus($intMaterialPeligrosoID, $strEstatus)
	{
		//Si el estatus del registro es ACTIVO
		if($strEstatus == 'ACTIVO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'),
							  'fecha_eliminacion' => NULL,
							  'usuario_eliminacion' => NULL);
		}
		else 
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_eliminacion' => date("Y-m-d H:i:s"),
							  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		}
		$this->db->where('material_peligroso_id', $intMaterialPeligrosoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_material_peligroso', $arrDatos);
	}

	//Método para regresar los registros a un combobox
	public function get_combo_box()
	{	
		$this->db->select("material_peligroso_id AS value, CONCAT_WS(' - ', codigo, descripcion) AS nombre", FALSE);
		$this->db->from('sat_material_peligroso');
		$this->db->where('estatus', 'ACTIVO');
		$this->db->order_by('codigo','ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMaterialPeligrosoID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select('material_peligroso_id, codigo, descripcion, clase, peligro_secundario, 
						   nombre_tecnico,estatus');
		$this->db->from('sat_material_peligroso');
		//Si existe id del material peligroso
		if ($intMaterialPeligrosoID !== NULL)
		{   
			$this->db->where('material_peligroso_id', $intMaterialPeligrosoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigo !== NULL)//Si existe código
		{
			$this->db->where('codigo', $strCodigo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('codigo', $strBusqueda);
	    	$this->db->or_like('descripcion', $strBusqueda);
	    	$this->db->or_like('clase', $strBusqueda);
	    	$this->db->or_like('estatus', $strBusqueda);
			$this->db->order_by('codigo', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('codigo', $strBusqueda);
	    $this->db->or_like('descripcion', $strBusqueda);
	    $this->db->or_like('clase', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda); 
		$this->db->from('sat_material_peligroso');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('material_peligroso_id, codigo, descripcion, clase, estatus');
		$this->db->from('sat_material_peligroso');
		$this->db->like('codigo', $strBusqueda);
	    $this->db->or_like('descripcion', $strBusqueda);
	    $this->db->or_like('clase', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda); 
		$this->db->order_by('codigo','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["materiales"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>