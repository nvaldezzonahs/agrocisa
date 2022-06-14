<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mecanicos_tipos_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objMecanicoTipo)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objMecanicoTipo->strCodigo, 
						  'descripcion' => $objMecanicoTipo->strDescripcion, 
						  'costo' => $objMecanicoTipo->intCosto, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMecanicoTipo->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('mecanicos_tipos', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objMecanicoTipo)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objMecanicoTipo->strCodigo, 
						  'descripcion' => $objMecanicoTipo->strDescripcion, 
						  'costo' => $objMecanicoTipo->intCosto, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' =>  $objMecanicoTipo->intUsuarioID);
		$this->db->where('mecanico_tipo_id', $objMecanicoTipo->intMecanicoTipoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('mecanicos_tipos', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intMecanicoTipoID, $strEstatus)
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
		$this->db->where('mecanico_tipo_id', $intMecanicoTipoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('mecanicos_tipos', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMecanicoTipoID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select('mecanico_tipo_id, codigo, descripcion, costo, estatus');
		$this->db->from('mecanicos_tipos');
		//Si existe id del tipo de mecánico
		if ($intMecanicoTipoID !== NULL)
		{   
			$this->db->where('mecanico_tipo_id', $intMecanicoTipoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigo !== NULL)//Si existe descripción
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
		$this->db->from('mecanicos_tipos');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('mecanico_tipo_id, codigo, descripcion, estatus');
		$this->db->from('mecanicos_tipos');
		$this->db->like('codigo', $strBusqueda);
		$this->db->or_like('descripcion', $strBusqueda);
        $this->db->or_like('estatus', $strBusqueda); 
		$this->db->order_by('codigo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["tipos_mecanicos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" mecanico_tipo_id, 
						   CONCAT_WS(' - ', codigo, descripcion) AS tipo ", FALSE);
        $this->db->from('mecanicos_tipos');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(codigo LIKE '%$strDescripcion%' OR
        				   descripcion LIKE '%$strDescripcion%')");  
		$this->db->order_by('codigo', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>