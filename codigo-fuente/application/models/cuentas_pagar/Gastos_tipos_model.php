<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gastos_tipos_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objGastoTipo)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objGastoTipo->strDescripcion, 
						  'tipo_gasto' => $objGastoTipo->strTipoGasto,
						  'prefijo' => $objGastoTipo->strPrefijo,
						  'parque_vehicular' => $objGastoTipo->strParqueVehicular,
						  'orden_compra' => $objGastoTipo->strOrdenCompra,
						  'retencion_isr' => $objGastoTipo->strRetencionIsr,
						  'retencion_iva' => $objGastoTipo->strRetencionIva,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objGastoTipo->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('gastos_tipos', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objGastoTipo)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objGastoTipo->strDescripcion, 
						  'tipo_gasto' => $objGastoTipo->strTipoGasto,
						  'prefijo' => $objGastoTipo->strPrefijo,
						  'parque_vehicular' => $objGastoTipo->strParqueVehicular,
						  'orden_compra' => $objGastoTipo->strOrdenCompra,
						  'retencion_isr' => $objGastoTipo->strRetencionIsr,
						  'retencion_iva' => $objGastoTipo->strRetencionIva,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objGastoTipo->intUsuarioID);
		$this->db->where('gasto_tipo_id', $objGastoTipo->intGastoTipoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('gastos_tipos',  $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intGastoTipoID, $strEstatus)
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
		$this->db->where('gasto_tipo_id', $intGastoTipoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('gastos_tipos', $arrDatos);
	}


    //Método para regresar los registros a un combobox
	public function get_combo_box($strTipoGasto = NULL, $strParqueVehicular = NULL, 
								 $strTipoOrdenCompra = NULL)
	{	
		$this->db->select("gasto_tipo_id AS value, 
						   descripcion AS nombre", FALSE);
		$this->db->from('gastos_tipos');
		//Dependiendo del tipo de orden de compra, realizar búsqueda de datos
		if($strTipoOrdenCompra !== NULL)
		{
			//Seleccionar los tipos de gastos para las ordenes de compra
			if($strTipoOrdenCompra == 'orden_compra')
			{
				$this->db->where('orden_compra', 'SI');
			}
		}

		//Si existe el tipo de gasto
		if ($strTipoGasto !== NULL)
		{
			$this->db->where('tipo_gasto', $strTipoGasto);
		}

		//Si existe el parque vehicular
		if ($strParqueVehicular !== NULL)
		{
			$this->db->where('parque_vehicular', $strParqueVehicular);
		}
		
		$this->db->where('estatus', 'ACTIVO');
		$this->db->order_by('descripcion','ASC');
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intGastoTipoID = NULL, $strCriteriosBusq = NULL, $strBusqueda = NULL)
	{
		$this->db->select('gasto_tipo_id, tipo_gasto, descripcion, prefijo, 
						   parque_vehicular, orden_compra,
						   retencion_isr, retencion_iva, estatus');
		$this->db->from('gastos_tipos');
		//Si existe id del tipo de gasto
		if ($intGastoTipoID !== NULL)
		{   
			$this->db->where('gasto_tipo_id', $intGastoTipoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (tipo_gasto|descripcion) para obtener los criterios de búsqueda
            list($strTipoGasto, $strDescripcion) = explode("|", $strCriteriosBusq); 
			$this->db->where('tipo_gasto', $strTipoGasto);
			$this->db->where('descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('descripcion', $strBusqueda);
		    $this->db->or_like('tipo_gasto', $strBusqueda);
			$this->db->or_like('prefijo', $strBusqueda);
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
		$this->db->or_like('tipo_gasto', $strBusqueda);
		$this->db->or_like('prefijo', $strBusqueda);
		$this->db->or_like('parque_vehicular', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->from('gastos_tipos');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('gasto_tipo_id, descripcion, tipo_gasto, prefijo, 
						   parque_vehicular, estatus');
		$this->db->from('gastos_tipos');
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('tipo_gasto', $strBusqueda);
		$this->db->or_like('prefijo', $strBusqueda);
		$this->db->or_like('parque_vehicular', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["tipos_gastos"] =$this->db->get()->result();
		return $arrResultado;
	}

	
}
?>