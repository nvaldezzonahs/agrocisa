<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Localidades_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objLocalidad)
	{
		//Asignar datos al array
		$arrDatos = array('municipio_id' => $objLocalidad->intMunicipioID,
						  'descripcion' => $objLocalidad->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objLocalidad->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('localidades', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objLocalidad)
	{
		//Asignar datos al array
		$arrDatos = array('municipio_id' => $objLocalidad->intMunicipioID,
						  'descripcion' => $objLocalidad->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objLocalidad->intUsuarioID);
		$this->db->where('localidad_id', $objLocalidad->intLocalidadID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('localidades', $arrDatos);
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
		return $this->db->update('localidades', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intLocalidadID = NULL, $strCriteriosBusq = NULL, $strEstatus = NULL, 
						   $strBusqueda = NULL)
	{
		$this->db->select("L.localidad_id, L.descripcion AS localidad, L.estatus,
						   L.municipio_id, M.descripcion AS municipio,
						   CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado, E.estado_id,
						   CONCAT_WS(' - ', P.codigo, P.descripcion) AS pais, P.pais_id", FALSE);
		$this->db->from('localidades AS L');
		$this->db->join('municipios AS M', 'L.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		//Si existe id de la localidad
		if ($intLocalidadID !== NULL)
		{   
			$this->db->where('L.localidad_id', $intLocalidadID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (municipio_id|descripcion) para obtener los criterios de búsqueda
            list($intMunicipioID, $strDescripcion) = explode("|", $strCriteriosBusq); 
			$this->db->where('L.municipio_id', $intMunicipioID);
			$this->db->where('L.descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{	
   	   		//Si existe estatus
   	   		if($strEstatus !== NULL)
   	   		{
   	   			$this->db->where('L.estatus', 'ACTIVO'); 
   	   		}
   	   		else
   	   		{
   	   			$this->db->like('L.estatus', $strBusqueda);
				$this->db->or_like("CONCAT_WS(' ', L.descripcion, M.descripcion, E.descripcion, P.descripcion)", $strBusqueda);
				$this->db->or_like("CONCAT_WS(' ', L.descripcion, M.descripcion, E.codigo, P.codigo)", $strBusqueda);
				$this->db->or_like("CONCAT_WS(' ', P.descripcion, E.descripcion, M.descripcion, L.descripcion)", $strBusqueda);
				$this->db->or_like("CONCAT_WS(' ', P.codigo, E.codigo, M.descripcion, L.descripcion)", $strBusqueda);
			    $this->db->or_like("CONCAT_WS(' ', L.descripcion,  E.descripcion)", $strBusqueda);
			    $this->db->or_like("CONCAT_WS(' ', L.descripcion,  M.descripcion)", $strBusqueda);
			    	    $this->db->or_like(" CONCAT_WS(' - ', E.codigo, E.descripcion)", $strBusqueda);
			    $this->db->or_like("CONCAT_WS(' - ', E.codigo, E.descripcion)", $strBusqueda);
			    $this->db->or_like("CONCAT_WS(' ', E.codigo, E.descripcion)", $strBusqueda);
			    $this->db->or_like("CONCAT_WS(' - ', P.codigo, P.descripcion)", $strBusqueda);
			    $this->db->or_like("CONCAT_WS(' - ', P.codigo, P.descripcion)", $strBusqueda);
			     
   	   		}
			$this->db->order_by('P.codigo, E.codigo, M.descripcion, L.descripcion', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
   	    //Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('L.estatus', $strBusqueda);
		$this->db->or_like("CONCAT_WS(' ', L.descripcion, M.descripcion, E.descripcion, P.descripcion)", $strBusqueda);
		$this->db->or_like("CONCAT_WS(' ', L.descripcion, M.descripcion, E.codigo, P.codigo)", $strBusqueda);
		$this->db->or_like("CONCAT_WS(' ', P.descripcion, E.descripcion, M.descripcion, L.descripcion)", $strBusqueda);
		$this->db->or_like("CONCAT_WS(' ', P.codigo, E.codigo, M.descripcion, L.descripcion)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', L.descripcion,  E.descripcion)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', L.descripcion,  M.descripcion)", $strBusqueda);
	    $this->db->or_like(" CONCAT_WS(' - ', E.codigo, E.descripcion)", $strBusqueda);

	    $this->db->or_like("CONCAT_WS(' - ', E.codigo, E.descripcion)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', E.codigo, E.descripcion)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' - ', P.codigo, P.descripcion)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' - ', P.codigo, P.descripcion)", $strBusqueda);
	     
	      
		$this->db->from('localidades AS L');
		$this->db->join('municipios AS M', 'L.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
	    $this->db->select("L.localidad_id, L.descripcion AS localidad, L.estatus, 
	    				   M.descripcion AS municipio, 
	    				   CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado,
						   CONCAT_WS(' - ', P.codigo, P.descripcion) AS pais", FALSE);
		$this->db->from('localidades AS L');
		$this->db->join('municipios AS M', 'L.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		$this->db->like('L.estatus', $strBusqueda);
		$this->db->or_like("CONCAT_WS(' ', L.descripcion, M.descripcion, E.descripcion, P.descripcion)", $strBusqueda);
		$this->db->or_like("CONCAT_WS(' ', L.descripcion, M.descripcion, E.codigo, P.codigo)", $strBusqueda);
		$this->db->or_like("CONCAT_WS(' ', P.descripcion, E.descripcion, M.descripcion, L.descripcion)", $strBusqueda);
		$this->db->or_like("CONCAT_WS(' ', P.codigo, E.codigo, M.descripcion, L.descripcion)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', L.descripcion,  E.descripcion)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', L.descripcion,  M.descripcion)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' - ', E.codigo, E.descripcion)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', E.codigo, E.descripcion)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' - ', P.codigo, P.descripcion)", $strBusqueda);
		$this->db->or_like("CONCAT_WS(' - ', P.codigo, P.descripcion)", $strBusqueda);
		$this->db->order_by('E.codigo, M.descripcion, L.descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["localidades"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $intMunicipioID)
	{
		$this->db->select(" L.localidad_id,
						    CONCAT(L.descripcion, ',', M.descripcion, ',', E.descripcion) AS localidad ", FALSE);
        $this->db->from('localidades AS L');
	    $this->db->join('municipios AS M', 'L.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->where('L.estatus', 'ACTIVO');
		//Si existe id del municipio
        if($intMunicipioID > 0)
        {
        	 $this->db->where('L.municipio_id', $intMunicipioID);
        }
		$this->db->where("((CONCAT_WS(' ', L.descripcion, M.descripcion, E.descripcion) LIKE '%$strDescripcion%') OR
			                 (CONCAT_WS(' ', L.descripcion, M.descripcion, E.codigo) LIKE '%$strDescripcion%') OR
			                 (CONCAT_WS(' ', E.descripcion, M.descripcion, L.descripcion) LIKE '%$strDescripcion%') OR
			                 (CONCAT_WS(' ', E.codigo, M.descripcion, L.descripcion) LIKE '%$strDescripcion%') OR 
			                 (CONCAT_WS(' ', L.descripcion,  E.descripcion) LIKE '%$strDescripcion%') OR
			                 (CONCAT_WS(' ', L.descripcion,  M.descripcion) LIKE '%$strDescripcion%'))"); 
        $this->db->order_by('E.codigo, M.descripcion, L.descripcion', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>