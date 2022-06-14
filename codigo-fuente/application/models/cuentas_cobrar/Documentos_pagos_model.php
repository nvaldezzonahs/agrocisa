<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Documentos_pagos_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objDocumentoPago)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objDocumentoPago->strDescripcion, 
						  'genera_pagare' => $objDocumentoPago->strGeneraPagare,  
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objDocumentoPago->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('documentos_pagos', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objDocumentoPago)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objDocumentoPago->strDescripcion,
						  'genera_pagare' => $objDocumentoPago->strGeneraPagare, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objDocumentoPago->intUsuarioID);
		$this->db->where('documento_pago_id', $objDocumentoPago->intDocumentoPagoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('documentos_pagos', $arrDatos);
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intDocumentos_pagosID, $strEstatus)
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
		$this->db->where('documento_pago_id', $intDocumentos_pagosID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('documentos_pagos', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intDocumentos_pagosID = NULL,$strDescripcion = NULL,$strBusqueda = NULL, $strEstatus = NULL)
	{

		$this->db->select('documento_pago_id, descripcion, genera_pagare, estatus');
		$this->db->from('documentos_pagos');
		//Si existe id del documento
		if ($intDocumentos_pagosID !== NULL)
		{   
			$this->db->where('documento_pago_id', $intDocumentos_pagosID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strDescripcion !== NULL)//Si existe descripción
		{
			$this->db->where('descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if($strEstatus !== NULL)//Si existe estatus
		{
			$this->db->where('estatus', $strEstatus);
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
	public function filtro($strBusqueda = NULL,
		                   $intNumRows, $intPos)
	{
		
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->from('documentos_pagos');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('documento_pago_id, descripcion, genera_pagare, estatus');
		$this->db->from('documentos_pagos');
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["documentos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select('documento_pago_id, descripcion');
        $this->db->from('documentos_pagos');
        $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(descripcion LIKE '%$strDescripcion%')"); 
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}	
?>