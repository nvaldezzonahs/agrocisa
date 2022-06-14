<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_configuracion_autotransporte_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatConfiguracion)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatConfiguracion->strCodigo, 
						  'descripcion' => $objSatConfiguracion->strDescripcion, 
						  'numero_ejes' => $objSatConfiguracion->strNumeroEjes,
						  'numero_llantas' => $objSatConfiguracion->strNumeroLlantas,
						  'remolque' => $objSatConfiguracion->strRemolque,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatConfiguracion->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_configuracion_autotransporte', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatConfiguracion)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatConfiguracion->strCodigo, 
						  'descripcion' => $objSatConfiguracion->strDescripcion, 
						  'numero_ejes' => $objSatConfiguracion->strNumeroEjes,
						  'numero_llantas' => $objSatConfiguracion->strNumeroLlantas,
						  'remolque' => $objSatConfiguracion->strRemolque, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatConfiguracion->intUsuarioID);
		$this->db->where('configuracion_id', $objSatConfiguracion->intConfiguracionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_configuracion_autotransporte', $arrDatos);
	}
	
	//Método para modificar el estatus de un registro
	public function set_estatus($intConfiguracionID, $strEstatus)
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
		$this->db->where('configuracion_id', $intConfiguracionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_configuracion_autotransporte', $arrDatos);
	}

	//Método para regresar los registros a un combobox
	public function get_combo_box()
	{	
		$this->db->select("configuracion_id AS value, CONCAT_WS(' - ', codigo, descripcion) AS nombre", FALSE);
		$this->db->from('sat_configuracion_autotransporte');
		$this->db->where('estatus', 'ACTIVO');
		$this->db->order_by('codigo','ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intConfiguracionID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select('configuracion_id, codigo, descripcion,numero_ejes, numero_llantas,
						  remolque, estatus');
		$this->db->from('sat_configuracion_autotransporte');
		//Si existe id del registro
		if ($intConfiguracionID !== NULL)
		{   
			$this->db->where('configuracion_id', $intConfiguracionID);
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
		$this->db->from('sat_configuracion_autotransporte');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('configuracion_id, codigo, descripcion, estatus');
		$this->db->from('sat_configuracion_autotransporte');
		$this->db->like('codigo', $strBusqueda);
	    $this->db->or_like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda); 
		$this->db->order_by('codigo','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["configuracion"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>