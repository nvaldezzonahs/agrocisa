<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_localidades_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatLocalidad)
	{
		//Asignar datos al array
		$arrDatos = array('estado_id' => $objSatLocalidad->intEstadoID, 
						  'codigo' => $objSatLocalidad->strCodigo, 
						  'descripcion' => $objSatLocalidad->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatLocalidad->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_localidades', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatLocalidad)
	{
		//Asignar datos al array
		$arrDatos = array('estado_id' => $objSatLocalidad->intEstadoID,
						  'codigo' => $objSatLocalidad->strCodigo, 
						  'descripcion' => $objSatLocalidad->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatLocalidad->intUsuarioID);
		$this->db->where('localidad_id', $objSatLocalidad->intLocalidadID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_localidades', $arrDatos);
	}
	
	//Método para modificar el estatus de un registro
	public function set_estatus($intLocalidadID, $strEstatus)
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
		$this->db->where('localidad_id', $intLocalidadID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_localidades', $arrDatos);
	}

	//Método para regresar los registros a un combobox
	public function get_combo_box()
	{	
		$this->db->select("localidad_id AS value, CONCAT_WS(' - ', codigo, descripcion) AS nombre", FALSE);
		$this->db->from('sat_localidades');
		$this->db->where('estatus', 'ACTIVO');
		$this->db->order_by('codigo','ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intLocalidadID = NULL, $strCriteriosBusq = NULL, $strBusqueda = NULL)
	{
		$this->db->select("L.localidad_id, L.estado_id, L.codigo, L.descripcion, L.estatus,
						   CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado,
						   CONCAT_WS(' - ', P.codigo, P.descripcion) AS pais", FALSE);
		$this->db->from('sat_localidades AS L');
		$this->db->join('sat_estados AS E', 'L.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		//Si existe id del registro
		if ($intLocalidadID !== NULL)
		{   
			$this->db->where('L.localidad_id', $intLocalidadID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (estado_id|codigo) para obtener los criterios de búsqueda
            list($intEstadoID, $strCodigo) = explode("|", $strCriteriosBusq); 
			$this->db->where('L.estado_id', $intEstadoID);
			$this->db->where('L.codigo', $strCodigo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('L.codigo', $strBusqueda);
	    	$this->db->or_like('L.descripcion', $strBusqueda);
	    	$this->db->or_like('L.estatus', $strBusqueda);
	    	$this->db->or_like("CONCAT_WS(' - ', E.codigo, E.descripcion)", $strBusqueda);
	    	$this->db->or_like("CONCAT_WS(' ', E.codigo, E.descripcion)", $strBusqueda);
			$this->db->order_by('L.codigo', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('L.codigo', $strBusqueda);
    	$this->db->or_like('L.descripcion', $strBusqueda);
    	$this->db->or_like('L.estatus', $strBusqueda);
    	$this->db->or_like("CONCAT_WS(' - ', E.codigo, E.descripcion)", $strBusqueda);
    	$this->db->or_like("CONCAT_WS(' ', E.codigo, E.descripcion)", $strBusqueda);
		$this->db->from('sat_localidades AS L');
		$this->db->join('sat_estados AS E', 'L.estado_id = E.estado_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("L.localidad_id, L.codigo, L.descripcion, L.estatus, 
						   CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado", FALSE);
		$this->db->from('sat_localidades AS L');
		$this->db->join('sat_estados AS E', 'L.estado_id = E.estado_id', 'inner');
		$this->db->like('L.codigo', $strBusqueda);
    	$this->db->or_like('L.descripcion', $strBusqueda);
    	$this->db->or_like('L.estatus', $strBusqueda);
    	$this->db->or_like("CONCAT_WS(' - ', E.codigo, E.descripcion)", $strBusqueda);
    	$this->db->or_like("CONCAT_WS(' ', E.codigo, E.descripcion)", $strBusqueda);
		$this->db->order_by('L.codigo','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["localidades"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>