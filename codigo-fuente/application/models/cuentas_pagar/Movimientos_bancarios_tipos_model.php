<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movimientos_bancarios_tipos_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objMovimientoBancarioTipo)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objMovimientoBancarioTipo->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimientoBancarioTipo->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('movimientos_bancarios_tipos', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objMovimientoBancarioTipo)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objMovimientoBancarioTipo->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimientoBancarioTipo->intUsuarioID);
		$this->db->where('movimiento_bancario_tipo_id', $objMovimientoBancarioTipo->intMovimientoBancarioTipoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('movimientos_bancarios_tipos', $arrDatos);
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intMovimientoBancarioTipoID, $strEstatus)
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
		$this->db->where('movimiento_bancario_tipo_id', $intMovimientoBancarioTipoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('movimientos_bancarios_tipos', $arrDatos);
	}


	//Método para regresar los registros a un combobox
	public function get_combo_box()
	{	
		$this->db->select('movimiento_bancario_tipo_id AS value, descripcion AS nombre');
		$this->db->from('movimientos_bancarios_tipos');
		$this->db->where('estatus', 'ACTIVO');
		$this->db->order_by('descripcion','ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMovimientoBancarioTipoID = NULL, $strDescripcion = NULL, 
						   $strBusqueda = NULL)
	{
		$this->db->select('movimiento_bancario_tipo_id, descripcion, estatus');
		$this->db->from('movimientos_bancarios_tipos');
		//Si existe id del tipo de concepto
		if ($intMovimientoBancarioTipoID !== NULL)
		{   
			$this->db->where('movimiento_bancario_tipo_id', $intMovimientoBancarioTipoID);
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
		$this->db->from('movimientos_bancarios_tipos');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('movimiento_bancario_tipo_id, descripcion, estatus');
		$this->db->from('movimientos_bancarios_tipos');
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);  
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["tipos_movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>