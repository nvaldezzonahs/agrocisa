<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estrategias_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objEstrategia)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objEstrategia->strDescripcion, 
						  'modulo_id' => $objEstrategia->intModuloID, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objEstrategia->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('estrategias', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objEstrategia)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objEstrategia->strDescripcion, 
						  'modulo_id' => $objEstrategia->intModuloID,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objEstrategia->intUsuarioID);
		$this->db->where('estrategia_id', $objEstrategia->intEstrategiaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('estrategias', $arrDatos);
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intEstrategiaID, $strEstatus)
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
		$this->db->where('estrategia_id', $intEstrategiaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('estrategias', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intEstrategiaID = NULL, $strCriteriosBusq = NULL, $strBusqueda = NULL)
	{
		$this->db->select('E.estrategia_id, E.descripcion,E.modulo_id ,M.descripcion AS modulo, E.estatus');
		$this->db->from('estrategias AS E');
		$this->db->join('modulos AS M', 'M.modulo_id = E.modulo_id');
		//Si existe id de la estrategia
		if ($intEstrategiaID !== NULL)
		{   
			$this->db->where('E.estrategia_id', $intEstrategiaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (modulo_id|descripcion) para obtener los criterios de búsqueda
            list($intModuloID, $strDescripcion) = explode("|", $strCriteriosBusq); 
			$this->db->where('E.modulo_id', $intModuloID);
			$this->db->where('E.descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('E.descripcion', $strBusqueda);
			$this->db->or_like('M.descripcion', $strBusqueda); 
	        $this->db->or_like('E.estatus', $strBusqueda); 
			$this->db->order_by('M.descripcion , E.descripcion', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('E.descripcion', $strBusqueda);
		$this->db->or_like('M.descripcion', $strBusqueda); 
	    $this->db->or_like('E.estatus', $strBusqueda);  
		$this->db->from('estrategias AS E');
		$this->db->join('modulos AS M', 'M.modulo_id = E.modulo_id');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('E.estrategia_id, E.descripcion, M.descripcion AS modulo, 
							E.estatus');
		$this->db->from('estrategias AS E');
		$this->db->join('modulos AS M', 'M.modulo_id = E.modulo_id');
		$this->db->like('E.descripcion', $strBusqueda);
		$this->db->or_like('M.descripcion', $strBusqueda); 
	    $this->db->or_like('E.estatus', $strBusqueda);   
		$this->db->order_by('M.descripcion, E.descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["estrategias"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($intModuloID, $strDescripcion)
	{
		$this->db->select(' estrategia_id, descripcion ');
        $this->db->from('estrategias');
	    $this->db->where('estatus', 'ACTIVO');
	    $this->db->where('modulo_id', $intModuloID);
        $this->db->where("(descripcion LIKE '%$strDescripcion%')");  
        $this->db->order_by("descripcion",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>