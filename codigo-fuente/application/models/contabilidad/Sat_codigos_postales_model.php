<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_codigos_postales_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatCodigoPostal)
	{
		//Asignar datos al array
		$arrDatos = array('codigo_postal' => $objSatCodigoPostal->strCodigoPostal, 
						  'estado' => $objSatCodigoPostal->strCodigoEstado, 
						  'municipio' => $objSatCodigoPostal->strCodigoMunicipio, 
						  'localidad' => $objSatCodigoPostal->strCodigoLocalidad,
						  'municipio_id' => $objSatCodigoPostal->intMunicipioID,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatCodigoPostal->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_codigos_postales', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatCodigoPostal)
	{
		//Asignar datos al array
		$arrDatos = array('codigo_postal' => $objSatCodigoPostal->strCodigoPostal, 
						  'estado' => $objSatCodigoPostal->strCodigoEstado, 
						  'municipio' => $objSatCodigoPostal->strCodigoMunicipio, 
						  'localidad' => $objSatCodigoPostal->strCodigoLocalidad,
						  'municipio_id' => $objSatCodigoPostal->intMunicipioID,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatCodigoPostal->intUsuarioID);
		$this->db->where('codigo_postal_id', $objSatCodigoPostal->intCodigoPostalID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_codigos_postales', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intCodigoPostalID, $strEstatus)
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
		$this->db->where('codigo_postal_id', $intCodigoPostalID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_codigos_postales', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intCodigoPostalID = NULL, $strCodigoPostal = NULL, $strBusqueda = NULL)
	{
		$this->db->select("CP.codigo_postal_id, CP.codigo_postal, CP.estado AS codigo_estado, 
						   CP.municipio AS codigo_municipio, CP.localidad AS codigo_localidad, 
						   CP.municipio_id, CP.estatus, M.descripcion AS municipio, 
						   CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado,
						   CONCAT_WS(' - ', P.codigo, P.descripcion) AS pais", FALSE);
		$this->db->from('sat_codigos_postales AS CP');
		$this->db->join('municipios AS M', 'CP.municipio_id = M.municipio_id', 'left');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'left');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'left');
		//Si existe id del código postal
		if ($intCodigoPostalID !== NULL)
		{   
			$this->db->where('CP.codigo_postal_id', $intCodigoPostalID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigoPostal !== NULL)//Si existe código postal
		{
			$this->db->where('CP.codigo_postal', $strCodigoPostal);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('CP.codigo_postal', $strBusqueda);
		    $this->db->or_like('CP.estado', $strBusqueda);
		    $this->db->or_like('CP.municipio', $strBusqueda);
		    $this->db->or_like('CP.estatus', $strBusqueda);
			$this->db->order_by('CP.codigo_postal', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('CP.codigo_postal', $strBusqueda);
	    $this->db->or_like('CP.estado', $strBusqueda);
	    $this->db->or_like('CP.municipio', $strBusqueda);
	    $this->db->or_like('CP.estatus', $strBusqueda);
		$this->db->from('sat_codigos_postales AS CP');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('CP.codigo_postal_id, CP.codigo_postal, CP.estado AS codigo_estado, 
						   CP.municipio AS codigo_municipio, CP.estatus');
		$this->db->from('sat_codigos_postales AS CP');
		$this->db->like('CP.codigo_postal', $strBusqueda);
	    $this->db->or_like('CP.estado', $strBusqueda);
	    $this->db->or_like('CP.municipio', $strBusqueda);
	    $this->db->or_like('CP.estatus', $strBusqueda);
		$this->db->order_by('CP.codigo_postal','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["codigos_postales"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(' codigo_postal_id, codigo_postal ');
        $this->db->from('sat_codigos_postales');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(codigo_postal LIKE '%$strDescripcion%')");  
		$this->db->order_by('codigo_postal', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>