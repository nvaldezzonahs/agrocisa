<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Herramientas_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objHerramienta)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objHerramienta->strCodigo, 
						  'descripcion' => $objHerramienta->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objHerramienta->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('herramientas', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objHerramienta)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objHerramienta->strCodigo, 
						  'descripcion' => $objHerramienta->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objHerramienta->intUsuarioID);
		$this->db->where('herramienta_id', $objHerramienta->intHerramientaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('herramientas', $arrDatos);
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intHerramientaID, $strEstatus)
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
		$this->db->where('herramienta_id', $intHerramientaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('herramientas', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intHerramientaID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select('herramienta_id, codigo, descripcion, estatus');
		$this->db->from('herramientas');
		//Si existe id de la herramienta
		if ($intHerramientaID !== NULL)
		{   
			$this->db->where('herramienta_id', $intHerramientaID);
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
		$this->db->from('herramientas');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('herramienta_id, codigo, descripcion, estatus');
		$this->db->from('herramientas');
		$this->db->like('codigo', $strBusqueda);
		$this->db->or_like('descripcion', $strBusqueda); 
	    $this->db->or_like('estatus', $strBusqueda);  
		$this->db->order_by('codigo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["herramientas"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" H.herramienta_id, 
						    CONCAT(H.codigo, ' - ', H.descripcion) AS herramienta ", FALSE);
        $this->db->from('herramientas AS H');
		$this->db->where('H.estatus', 'ACTIVO');
        $this->db->where("(
        					(H.codigo LIKE '%$strDescripcion%') OR
        				   	(H.descripcion LIKE '%$strDescripcion%')
        				  )"); 
		$this->db->order_by('H.codigo', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>