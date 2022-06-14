<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing_code_descriptions_model extends CI_model {
	//MCD - Descripción (es) de Código de Marketing
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objMCD)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objMCD->strCodigo, 
						  'descripcion' => $objMCD->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMCD->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('marketing_code_descriptions', $arrDatos);
	}

	//Método para modificar (actualizar) los datos de una MCD.
	public function modificar(stdClass $objMCD)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objMCD->strCodigo, 
						  'descripcion' => $objMCD->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMCD->intUsuarioID);
		$this->db->where('mcd_id', $objMCD->intMcdID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('marketing_code_descriptions', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intMcdID, $strEstatus)
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
		$this->db->where('mcd_id', $intMcdID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('marketing_code_descriptions', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMcdID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select('mcd_id, codigo, descripcion, estatus');
		$this->db->from('marketing_code_descriptions');
		//Si existe id de la MCD
		if ($intMcdID !== NULL)
		{   
			$this->db->where('mcd_id', $intMcdID);
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
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->from('marketing_code_descriptions');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('mcd_id, codigo, descripcion, estatus');
		$this->db->from('marketing_code_descriptions');
		$this->db->like('codigo', $strBusqueda);
	    $this->db->or_like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('codigo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["MCD"] =$this->db->get()->result();
		return $arrResultado;
	}
	
	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" mcd_id, CONCAT_WS(' - ', codigo, descripcion) AS descripcion ", FALSE);
        $this->db->from('marketing_code_descriptions');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(codigo LIKE '%$strDescripcion%' OR 
        				   descripcion LIKE '%$strDescripcion%')");
        $this->db->order_by('codigo', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>