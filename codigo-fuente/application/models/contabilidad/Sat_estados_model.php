<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_estados_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatEstado)
	{
		//Asignar datos al array
		$arrDatos = array('pais_id' => $objSatEstado->intPaisID,
						  'codigo' => $objSatEstado->strCodigo, 
						  'descripcion' => $objSatEstado->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatEstado->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_estados', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatEstado)
	{
		//Asignar datos al array
		$arrDatos = array('pais_id' =>  $objSatEstado->intPaisID,
						  'codigo' =>  $objSatEstado->strCodigo, 
						  'descripcion' => $objSatEstado->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatEstado->intUsuarioID);
		$this->db->where('estado_id', $objSatEstado->intEstadoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_estados', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intEstadoID, $strEstatus)
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
		$this->db->where('estado_id', $intEstadoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_estados', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intEstadoID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select("E.estado_id, E.pais_id, E.codigo, E.descripcion, E.estatus, 
						   CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado,
						   CONCAT_WS(' - ', P.codigo, P.descripcion) AS pais", FALSE);
		$this->db->from('sat_estados AS E');
	    $this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		//Si existe id del estado
		if ($intEstadoID !== NULL)
		{   
			$this->db->where('E.estado_id', $intEstadoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigo !== NULL)//Si existe código
		{
			$this->db->where('E.codigo', $strCodigo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('E.estatus', $strBusqueda);
	    	$this->db->or_like("CONCAT_WS(' - ', E.codigo, E.descripcion)", $strBusqueda);
	    	$this->db->or_like("CONCAT_WS(' ', E.codigo, E.descripcion)", $strBusqueda);
	 		$this->db->or_like("CONCAT_WS(' - ', P.codigo, P.descripcion)", $strBusqueda);
	 		$this->db->or_like("CONCAT_WS(' ', P.codigo, P.descripcion)", $strBusqueda);
			$this->db->order_by('P.codigo, E.codigo', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('E.estatus', $strBusqueda);
    	$this->db->or_like("CONCAT_WS(' - ', E.codigo, E.descripcion)", $strBusqueda);
    	$this->db->or_like("CONCAT_WS(' ', E.codigo, E.descripcion)", $strBusqueda);
 		$this->db->or_like("CONCAT_WS(' - ', P.codigo, P.descripcion)", $strBusqueda);
 		$this->db->or_like("CONCAT_WS(' ', P.codigo, P.descripcion)", $strBusqueda);
		$this->db->from('sat_estados AS E');
	    $this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		 $this->db->select("E.estado_id, E.estatus, 
		 					CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado, 
						    CONCAT_WS(' - ', P.codigo, P.descripcion) AS pais", FALSE);
		$this->db->from('sat_estados AS E');
	    $this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
	   	$this->db->like('E.estatus', $strBusqueda);
    	$this->db->or_like("CONCAT_WS(' - ', E.codigo, E.descripcion)", $strBusqueda);
    	$this->db->or_like("CONCAT_WS(' ', E.codigo, E.descripcion)", $strBusqueda);
 		$this->db->or_like("CONCAT_WS(' - ', P.codigo, P.descripcion)", $strBusqueda);
 		$this->db->or_like("CONCAT_WS(' ', P.codigo, P.descripcion)", $strBusqueda);
		$this->db->order_by('P.codigo, E.codigo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["estados"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" E.estado_id, 
						   CONCAT_WS(' ', E.codigo, '-', E.descripcion, ',', P.descripcion) AS estado ", FALSE);
        $this->db->from('sat_estados AS E');
	    $this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		$this->db->where('E.estatus', 'ACTIVO');
        $this->db->where("(E.codigo LIKE '%$strDescripcion%' OR  
        				   E.descripcion LIKE '%$strDescripcion%')");  
		$this->db->order_by('E.codigo', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>