<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_colonias_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatColonia)
	{
		//Asignar datos al array
		$arrDatos = array('codigo_postal_id' => $objSatColonia->intCodigoPostalID, 
						  'codigo' => $objSatColonia->strCodigo, 
						  'nombre_asentamiento' => $objSatColonia->strNombreAsentamiento, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatColonia->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_colonias', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatColonia)
	{
		//Asignar datos al array
		$arrDatos = array('codigo_postal_id' => $objSatColonia->intCodigoPostalID,
						  'codigo' => $objSatColonia->strCodigo, 
						  'nombre_asentamiento' => $objSatColonia->strNombreAsentamiento, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatColonia->intUsuarioID);
		$this->db->where('colonia_id', $objSatColonia->intColoniaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_colonias', $arrDatos);
	}
	
	//Método para modificar el estatus de un registro
	public function set_estatus($intColoniaID, $strEstatus)
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
		$this->db->where('colonia_id', $intColoniaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_colonias', $arrDatos);
	}

	//Método para regresar los registros a un combobox
	public function get_combo_box()
	{	
		$this->db->select("colonia_id AS value, CONCAT_WS(' - ', codigo, descripcion) AS nombre", FALSE);
		$this->db->from('sat_colonias');
		$this->db->where('estatus', 'ACTIVO');
		$this->db->order_by('codigo','ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intColoniaID = NULL, $strCriteriosBusq = NULL, $strBusqueda = NULL)
	{
		$this->db->select("C.colonia_id, C.codigo_postal_id, C.codigo, C.nombre_asentamiento, 
						   C.estatus, CP.codigo_postal, M.descripcion AS municipio, 
						   CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado", FALSE);
		$this->db->from('sat_colonias AS C');
		$this->db->join('sat_codigos_postales AS CP', 'C.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS M', 'CP.municipio_id = M.municipio_id', 'left');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'left');
		//Si existe id del registro
		if ($intColoniaID !== NULL)
		{   
			$this->db->where('C.colonia_id', $intColoniaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (codigo_postal_id|codigo) para obtener los criterios de búsqueda
            list($intCodigoPostalID, $strCodigo) = explode("|", $strCriteriosBusq); 
			$this->db->where('C.codigo_postal_id', $intCodigoPostalID);
			$this->db->where('C.codigo', $strCodigo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('C.codigo', $strBusqueda);
	    	$this->db->or_like('C.nombre_asentamiento', $strBusqueda);
	    	$this->db->or_like('C.estatus', $strBusqueda);
	    	$this->db->or_like('CP.codigo_postal', $strBusqueda);
			$this->db->order_by('C.codigo', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('C.codigo', $strBusqueda);
	    $this->db->or_like('C.nombre_asentamiento', $strBusqueda);
	    $this->db->or_like('C.estatus', $strBusqueda);
	    $this->db->or_like('CP.codigo_postal', $strBusqueda);
		$this->db->from('sat_colonias AS C');
		$this->db->join('sat_codigos_postales AS CP', 'C.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('C.colonia_id, C.codigo, C.nombre_asentamiento, C.estatus, 
						   CP.codigo_postal');
		$this->db->from('sat_colonias AS C');
		$this->db->join('sat_codigos_postales AS CP', 'C.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->like('C.codigo', $strBusqueda);
	    $this->db->or_like('C.nombre_asentamiento', $strBusqueda);
	    $this->db->or_like('C.estatus', $strBusqueda);
	    $this->db->or_like('CP.codigo_postal', $strBusqueda);
		$this->db->order_by('C.codigo','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["colonias"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>