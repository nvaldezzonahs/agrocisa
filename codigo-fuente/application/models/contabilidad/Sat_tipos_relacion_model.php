<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_tipos_relacion_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatTipoRelacion)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatTipoRelacion->strCodigo, 
						  'descripcion' => $objSatTipoRelacion->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatTipoRelacion->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_tipos_relacion',$arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatTipoRelacion)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatTipoRelacion->strCodigo, 
						  'descripcion' => $objSatTipoRelacion->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatTipoRelacion->intUsuarioID);
		$this->db->where('tipo_relacion_id', $objSatTipoRelacion->intTipoRelacionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_tipos_relacion', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intTipoRelacionID, $strEstatus)
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
		$this->db->where('tipo_relacion_id', $intTipoRelacionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_tipos_relacion', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intTipoRelacionID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select('tipo_relacion_id, codigo, descripcion, estatus');
		$this->db->from('sat_tipos_relacion');
		//Si existe id del tipo de relación
		if ($intTipoRelacionID !== NULL)
		{   
			$this->db->where('tipo_relacion_id', $intTipoRelacionID);
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
		$this->db->from('sat_tipos_relacion');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('tipo_relacion_id, codigo, descripcion, estatus');
		$this->db->from('sat_tipos_relacion');
		$this->db->like('codigo', $strBusqueda);
	    $this->db->or_like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda); 
		$this->db->order_by('codigo','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["tipos_relacion"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" tipo_relacion_id,
						    CONCAT_WS(' - ', codigo, descripcion) AS tipo_relacion ", FALSE);
        $this->db->from('sat_tipos_relacion');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(codigo LIKE '%$strDescripcion%' OR
        				   descripcion LIKE '%$strDescripcion%')");  
        $this->db->order_by("codigo",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>