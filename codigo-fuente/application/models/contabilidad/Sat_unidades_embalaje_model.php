<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_unidades_embalaje_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatUnidad)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatUnidad->strCodigo, 
						  'nombre' => $objSatUnidad->strNombre, 
						  'descripcion' => $objSatUnidad->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatUnidad->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_unidades_embalaje', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatUnidad)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatUnidad->strCodigo, 
						  'nombre' => $objSatUnidad->strNombre, 
						  'descripcion' => $objSatUnidad->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatUnidad->intUsuarioID);
		$this->db->where('unidad_embalaje_id', $objSatUnidad->intUnidadEmbalajeID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_unidades_embalaje', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intUnidadEmbalajeID, $strEstatus)
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
		$this->db->where('unidad_embalaje_id', $intUnidadEmbalajeID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_unidades_embalaje', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intUnidadEmbalajeID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select('unidad_embalaje_id, codigo, nombre, descripcion, estatus');
		$this->db->from('sat_unidades_embalaje');
		//Si existe id de la unidad
		if ($intUnidadEmbalajeID !== NULL)
		{   
			$this->db->where('unidad_embalaje_id', $intUnidadEmbalajeID);
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
	        $this->db->or_like('nombre', $strBusqueda);
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
	    $this->db->or_like('nombre', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda); 
		$this->db->from('sat_unidades_embalaje');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('unidad_embalaje_id, codigo, nombre, estatus');
		$this->db->from('sat_unidades_embalaje');
		$this->db->like('codigo', $strBusqueda);
	    $this->db->or_like('nombre', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('codigo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["unidades"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" unidad_embalaje_id, CONCAT_WS(' - ', codigo, nombre) AS unidad ", FALSE);
        $this->db->from('sat_unidades_embalaje');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(codigo LIKE '%$strDescripcion%' OR
        				   nombre LIKE '%$strDescripcion%')");  
        $this->db->order_by('codigo', 'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
		return $this->db->get()->result();
	}
}
?>