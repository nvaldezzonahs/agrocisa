<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modulos_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objModulo)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objModulo->strDescripcion, 
						  'factura' => $objModulo->strTipoFactura, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objModulo->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('modulos', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objModulo)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objModulo->strDescripcion, 
						  'factura' => $objModulo->strTipoFactura, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objModulo->intUsuarioID);
		$this->db->where('modulo_id', $objModulo->intModuloID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('modulos', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intModuloID, $strEstatus)
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
		$this->db->where('modulo_id', $intModuloID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('modulos',$arrDatos);
	}

	//Método para regresar los registros a un combobox
	public function get_combo_box()
	{	
		$this->db->select("modulo_id AS value, descripcion AS nombre", FALSE);
		$this->db->from('modulos');
		$this->db->where('estatus', 'ACTIVO');
		$this->db->order_by('descripcion','ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intModuloID = NULL, $strDescripcion = NULL, $strBusqueda = NULL, $strEstatus = NULL)
	{
		$this->db->select('modulo_id, descripcion, factura,estatus');
		$this->db->from('modulos');
		//Si existe id de la actividad
		if ($intModuloID !== NULL)
		{   
			$this->db->where('modulo_id', $intModuloID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strDescripcion !== NULL)//Si existe descripción
		{
			$this->db->where('descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strEstatus !== NULL)//Si existe estatus
		{

			$this->db->where('estatus', $strEstatus);
			$this->db->order_by('modulo_id', 'ASC');
			return $this->db->get()->result();
		}
		else
		{
			$this->db->like('descripcion', $strBusqueda);
			$this->db->or_like('factura', $strBusqueda);
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
		$this->db->or_like('factura', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda); 
		$this->db->from('modulos');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('modulo_id, descripcion, factura, estatus');
		$this->db->from('modulos');
		$this->db->like('descripcion', $strBusqueda);
		$this->db->or_like('factura', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["modulos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strFactura = NULL)
	{
		$this->db->select(' modulo_id, descripcion ');
        $this->db->from('modulos');
	    $this->db->where('estatus', 'ACTIVO');
	    //Si existe tipo de factura
        if($strFactura !== NULL)
        {
        	 $this->db->where('factura', $strFactura);
        }
        $this->db->where("(descripcion LIKE '%$strDescripcion%')");  
        $this->db->order_by("descripcion",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>