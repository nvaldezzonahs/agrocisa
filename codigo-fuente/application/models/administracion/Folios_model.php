<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Folios_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objFolio)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objFolio->strDescripcion, 
						  'serie' => $objFolio->strSerie, 
						  'consecutivo' => $objFolio->intConsecutivo,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objFolio->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('folios', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objFolio)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objFolio->strDescripcion, 
						  'serie' => $objFolio->strSerie, 
						  'consecutivo' => $objFolio->intConsecutivo,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objFolio->intUsuarioID);
		$this->db->where('folio_id', $objFolio->intFolioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('folios', $arrDatos);
	}

	//Función que se utiliza para modificar el consecutivo de un registro
	public function modificar_consecutivo_folio($intFolioID, $intConsecutivo)
	{
		//Asignar datos al array
		$arrDatos = array('consecutivo' => $intConsecutivo, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('folio_id', $intFolioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('folios', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intFolioID, $strEstatus)
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
		$this->db->where('folio_id', $intFolioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('folios', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intFolioID = NULL, $strDescripcion = NULL, $strBusqueda = NULL)
	{
		$this->db->select('folio_id, descripcion, serie, consecutivo, estatus');
		$this->db->from('folios');
		//Si existe id del folio
		if ($intFolioID !== NULL)
		{   
			$this->db->where('folio_id', $intFolioID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strDescripcion !== NULL)//Si existe descripción
		{
			$this->db->where('descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('descripcion', $strBusqueda);
	    	$this->db->or_like('serie', $strBusqueda);
	   	    $this->db->or_like('estatus', $strBusqueda);
			$this->db->order_by('descripcion', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('serie', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->from('folios');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('folio_id, descripcion, serie, consecutivo, estatus');
		$this->db->from('folios');
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('serie', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["folios"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" folio_id, 
						   CONCAT_WS(' - ', serie, descripcion) AS folio ", FALSE);
        $this->db->from('folios');
		$this->db->where('estatus', 'ACTIVO');
        $this->db->where("(serie LIKE '%$strDescripcion%' OR  
        				   descripcion LIKE '%$strDescripcion%')");  
		$this->db->order_by('serie', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>