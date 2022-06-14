<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_cadenas_pago_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatCadenaPago)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatCadenaPago->strCodigo, 
						  'descripcion' => $objSatCadenaPago->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatCadenaPago->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_cadenas_pago', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatCadenaPago)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatCadenaPago->strCodigo, 
						  'descripcion' => $objSatCadenaPago->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatCadenaPago->intUsuarioID);
		$this->db->where('cadena_pago_id', $objSatCadenaPago->intCadenaPagoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_cadenas_pago', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intCadenaPagoID, $strEstatus)
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
		$this->db->where('cadena_pago_id', $intCadenaPagoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_cadenas_pago', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intCadenaPagoID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select('cadena_pago_id, codigo, descripcion, estatus');
		$this->db->from('sat_cadenas_pago');
		//Si existe id de la cadena de pago
		if ($intCadenaPagoID !== NULL)
		{   
			$this->db->where('cadena_pago_id', $intCadenaPagoID);
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
		$this->db->from('sat_cadenas_pago');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('cadena_pago_id, codigo, descripcion, estatus');
		$this->db->from('sat_cadenas_pago');
		$this->db->like('codigo', $strBusqueda);
		$this->db->or_like('descripcion', $strBusqueda); 
	    $this->db->or_like('estatus', $strBusqueda); 
		$this->db->order_by('codigo','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["cadenas_pago"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" cadena_pago_id, 
						   CONCAT_WS(' - ', codigo, descripcion) AS cadena_pago", FALSE);
        $this->db->from('sat_cadenas_pago');
		$this->db->where('estatus', 'ACTIVO');
		$this->db->where("(codigo LIKE '%$strDescripcion%' OR  
    				       descripcion LIKE '%$strDescripcion%')");
		$this->db->order_by('codigo', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>