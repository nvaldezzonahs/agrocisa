<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios_tipos_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objServicioTipo)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objServicioTipo->strDescripcion, 
						  'facturar' => $objServicioTipo->strFactura,
						  'importe' => $objServicioTipo->strImporte,
						  'porcentaje_trabajos_foraneos' => $objServicioTipo->intPorcentajeTrabajosForaneos,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objServicioTipo->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('servicios_tipos', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objServicioTipo)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objServicioTipo->strDescripcion, 
						  'facturar' => $objServicioTipo->strFactura,
						  'importe' => $objServicioTipo->strImporte,
						  'porcentaje_trabajos_foraneos' => $objServicioTipo->intPorcentajeTrabajosForaneos,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objServicioTipo->intUsuarioID);
		$this->db->where('servicio_tipo_id', $objServicioTipo->intServicioTipoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('servicios_tipos',  $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intServicioTipoID, $strEstatus)
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
		$this->db->where('servicio_tipo_id', $intServicioTipoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('servicios_tipos', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intServicioTipoID = NULL, $strDescripcion = NULL, $strBusqueda = NULL, 
						   $strFacturar = NULL)
	{
		$this->db->select('servicio_tipo_id, descripcion, facturar,importe,
						  IFNULL(porcentaje_trabajos_foraneos, 0) AS porcentaje_trabajos_foraneos,  
						  estatus');
		$this->db->from('servicios_tipos');
		//Si existe id del tipo de servicio
		if ($intServicioTipoID !== NULL)
		{   
			$this->db->where('servicio_tipo_id', $intServicioTipoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strDescripcion !== NULL)//Si existe descripción
		{
			$this->db->where('descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strFacturar !== NULL)//Si existe facturar
		{
			$this->db->where('facturar', $strFacturar);
			$this->db->order_by('descripcion', 'ASC');
			return $this->db->get()->result();
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
		$this->db->from('servicios_tipos');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('servicio_tipo_id, descripcion, facturar, importe, estatus');
		$this->db->from('servicios_tipos');
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["tipos_servicios"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(' servicio_tipo_id, descripcion, facturar ');
        $this->db->from('servicios_tipos');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(descripcion LIKE '%$strDescripcion%')");  
        $this->db->order_by("descripcion",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	//Método para regresar los registros a un combobox
	public function get_combo_box()
	{	
		$this->db->select('servicio_tipo_id AS value, 
						   descripcion AS nombre');
		$this->db->from('servicios_tipos');
		$this->db->where('estatus', 'ACTIVO');
		$this->db->order_by('descripcion','ASC');
		return $this->db->get()->result();
	}
}
?>