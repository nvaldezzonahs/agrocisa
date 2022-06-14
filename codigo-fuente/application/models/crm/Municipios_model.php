<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Municipios_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objMunicipio)
	{
		//Asignar datos al array
		$arrDatos = array('estado_id' => $objMunicipio->intEstadoID,
						  'descripcion' => $objMunicipio->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMunicipio->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('municipios', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objMunicipio)
	{
		//Asignar datos al array
		$arrDatos = array('estado_id' => $objMunicipio->intEstadoID,
						  'descripcion' => $objMunicipio->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMunicipio->intUsuarioID);
		$this->db->where('municipio_id', $objMunicipio->intMunicipioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('municipios', $arrDatos);
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intMunicipioID, $strEstatus)
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
		$this->db->where('municipio_id', $intMunicipioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('municipios', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMunicipioID = NULL, $strCriteriosBusq = NULL, $strBusqueda = NULL)
	{
		$this->db->select("M.municipio_id, M.estado_id, M.descripcion AS municipio, M.estatus,
						  CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado,
						  CONCAT_WS(' - ', P.codigo, P.descripcion) AS pais", FALSE);
		$this->db->from('municipios AS M');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		//Si existe id del municipio
		if ($intMunicipioID !== NULL)
		{   
			$this->db->where('M.municipio_id', $intMunicipioID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (estado_id|descripcion) para obtener los criterios de búsqueda
            list($intEstadoID, $strDescripcion) = explode("|", $strCriteriosBusq); 
			$this->db->where('M.estado_id', $intEstadoID);
			$this->db->where('M.descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{	
			$this->db->like('P.codigo', $strBusqueda);
			$this->db->or_like('P.descripcion', $strBusqueda); 
			$this->db->or_like('E.codigo', $strBusqueda);
			$this->db->or_like('E.descripcion', $strBusqueda);
			$this->db->or_like('M.descripcion', $strBusqueda);
			$this->db->or_like('M.estatus', $strBusqueda); 
			$this->db->order_by('E.codigo, M.descripcion', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('P.codigo', $strBusqueda);
		$this->db->or_like('P.descripcion', $strBusqueda); 
		$this->db->or_like('E.codigo', $strBusqueda);
		$this->db->or_like('E.descripcion', $strBusqueda);
		$this->db->or_like('M.descripcion', $strBusqueda);
		$this->db->or_like('M.estatus', $strBusqueda); 
		$this->db->from('municipios AS M');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("M.municipio_id, M.descripcion AS municipio, M.estatus,
	    				   CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado,
						   CONCAT_WS(' - ', P.codigo, P.descripcion) AS pais", FALSE);
		$this->db->from('municipios AS M');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		$this->db->like('P.codigo', $strBusqueda);
		$this->db->or_like('P.descripcion', $strBusqueda); 
		$this->db->or_like('E.codigo', $strBusqueda);
		$this->db->or_like('E.descripcion', $strBusqueda);
		$this->db->or_like('M.descripcion', $strBusqueda);
		$this->db->or_like('M.estatus', $strBusqueda); 
		$this->db->order_by('E.codigo, M.descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["municipios"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $intEstadoID = NULL)
	{
		$this->db->select(" M.municipio_id,
						    CONCAT(M.descripcion, ',', E.descripcion) AS municipio ", FALSE);
        $this->db->from('municipios AS M');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->where('M.estatus', 'ACTIVO');
		//Si existe id del estado
        if($intEstadoID > 0)
        {
        	 $this->db->where('M.estado_id', $intEstadoID);
        }
        $this->db->where("((CONCAT_WS(' ', M.descripcion, E.descripcion) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', M.descripcion, E.codigo) LIKE '%$strDescripcion%'))"); 
        $this->db->order_by('E.codigo, M.descripcion', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>