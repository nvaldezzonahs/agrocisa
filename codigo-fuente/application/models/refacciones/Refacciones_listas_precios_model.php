<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones_listas_precios_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objListaPrecios)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objListaPrecios->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objListaPrecios->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('refacciones_listas_precios', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objListaPrecios)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objListaPrecios->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objListaPrecios->intUsuarioID);
		$this->db->where('refacciones_lista_precio_id', $objListaPrecios->intRefaccionesListaPrecioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('refacciones_listas_precios', $arrDatos);
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intRefaccionesListaPrecioID, $strEstatus)
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
		$this->db->where('refacciones_lista_precio_id', $intRefaccionesListaPrecioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('refacciones_listas_precios', $arrDatos);
	}
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intRefaccionesListaPrecioID = NULL, $strDescripcion = NULL, $strBusqueda = NULL)
	{
		$this->db->select('refacciones_lista_precio_id, descripcion, estatus');
		$this->db->from('refacciones_listas_precios');
		//Si existe id de la lista de precios de refacciones
		if ($intRefaccionesListaPrecioID !== NULL)
		{   
			$this->db->where('refacciones_lista_precio_id', $intRefaccionesListaPrecioID);
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
		$this->db->or_like('estatus', $strBusqueda);
		$this->db->from('refacciones_listas_precios');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('refacciones_lista_precio_id, descripcion, estatus');
		$this->db->from('refacciones_listas_precios');
		$this->db->like('descripcion', $strBusqueda);
		$this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["listas_precios"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(' refacciones_lista_precio_id, descripcion');
        $this->db->from('refacciones_listas_precios');
		$this->db->where('estatus', 'ACTIVO');
        $this->db->where("(descripcion LIKE '%$strDescripcion%')");  
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>