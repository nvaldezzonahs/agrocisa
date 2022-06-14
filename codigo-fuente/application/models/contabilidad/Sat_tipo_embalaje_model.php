<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_tipo_embalaje_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatTipoEmbalaje)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatTipoEmbalaje->strCodigo, 
						  'descripcion' => $objSatTipoEmbalaje->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatTipoEmbalaje->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_tipo_embalaje', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatTipoEmbalaje)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatTipoEmbalaje->strCodigo, 
						  'descripcion' => $objSatTipoEmbalaje->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatTipoEmbalaje->intUsuarioID);
		$this->db->where('tipo_embalaje_id', $objSatTipoEmbalaje->intTipoEmbalajeID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_tipo_embalaje', $arrDatos);
	}
	
	//Método para modificar el estatus de un registro
	public function set_estatus($intTipoEmbalajeID, $strEstatus)
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
		$this->db->where('tipo_embalaje_id', $intTipoEmbalajeID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_tipo_embalaje', $arrDatos);
	}

	//Método para regresar los registros a un combobox
	public function get_combo_box()
	{	
		$this->db->select("tipo_embalaje_id AS value, CONCAT_WS(' - ', codigo, descripcion) AS nombre", FALSE);
		$this->db->from('sat_tipo_embalaje');
		$this->db->where('estatus', 'ACTIVO');
		$this->db->order_by('codigo','ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intTipoEmbalajeID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select('tipo_embalaje_id, codigo, descripcion, estatus');
		$this->db->from('sat_tipo_embalaje');
		//Si existe id del registro
		if ($intTipoEmbalajeID !== NULL)
		{   
			$this->db->where('tipo_embalaje_id', $intTipoEmbalajeID);
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
		$this->db->from('sat_tipo_embalaje');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('tipo_embalaje_id, codigo, descripcion, estatus');
		$this->db->from('sat_tipo_embalaje');
		$this->db->like('codigo', $strBusqueda);
	    $this->db->or_like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda); 
		$this->db->order_by('codigo','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["tipos"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>