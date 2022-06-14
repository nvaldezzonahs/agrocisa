<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursales_contabilidad_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objConfiguracion)
	{
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objConfiguracion->intSucursalID,
						  'cuenta_contable' => $objConfiguracion->strCuentaContable, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objConfiguracion->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sucursales_contabilidad', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objConfiguracion)
	{
		//Asignar datos al array
		$arrDatos = array('cuenta_contable' => $objConfiguracion->strCuentaContable,  
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objConfiguracion->intUsuarioID);
		$this->db->where('sucursal_id', $objConfiguracion->intSucursalID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sucursales_contabilidad', $arrDatos);
	}


	//Método para eliminar los datos de un registro
	public function eliminar($intSucursalID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		$this->db->where('sucursal_id', $intSucursalID);
		//Eliminar los datos del registro
        $this->db->delete('sucursales_contabilidad');
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}
   
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intSucursalID = NULL, $strCuentaContable = NULL, $strBusqueda = NULL)
	{

		$this->db->select('SC.sucursal_id, SC.cuenta_contable, S.nombre AS sucursal');
		$this->db->from('sucursales_contabilidad AS SC');
		$this->db->join('sucursales AS S', 'SC.sucursal_id = S.sucursal_id', 'inner');
		//Si existe id de la sucursal
		if ($intSucursalID !== NULL)
		{   
			$this->db->where('SC.sucursal_id', $intSucursalID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCuentaContable !== NULL)//Si existe cuenta contable
		{   

			$this->db->where('SC.cuenta_contable', $strCuentaContable);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->like('SC.cuenta_contable', $strBusqueda);
	        $this->db->or_like('S.nombre', $strBusqueda);  
			$this->db->order_by('S.nombre', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('SC.cuenta_contable', $strBusqueda);
	    $this->db->or_like('S.nombre', $strBusqueda);  	           
		$this->db->from('sucursales_contabilidad AS SC');
		$this->db->join('sucursales AS S', 'SC.sucursal_id = S.sucursal_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('SC.sucursal_id, SC.cuenta_contable, S.nombre AS sucursal');
		$this->db->from('sucursales_contabilidad AS SC');
		$this->db->join('sucursales AS S', 'SC.sucursal_id = S.sucursal_id', 'inner');
		$this->db->like('SC.cuenta_contable', $strBusqueda);
	    $this->db->or_like('S.nombre', $strBusqueda);  	
		$this->db->order_by('S.nombre', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["configuraciones"] =$this->db->get()->result();
		return $arrResultado;
	}

}
?>