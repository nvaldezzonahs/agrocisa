<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentos_clientes_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objDocumentoCliente)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objDocumentoCliente->strDescripcion, 
						  'solicitar' => $objDocumentoCliente->strSolicitar,  
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objDocumentoCliente->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('documentos_clientes', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objDocumentoCliente)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objDocumentoCliente->strDescripcion,
						  'solicitar' => $objDocumentoCliente->strSolicitar, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objDocumentoCliente->intUsuarioID);
		$this->db->where('documento_cliente_id', $objDocumentoCliente->intDocumentoClienteID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('documentos_clientes', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intDocumentoClienteID, $strEstatus)
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
		
		$this->db->where('documento_cliente_id', $intDocumentoClienteID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('documentos_clientes', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intDocumentoClienteID = NULL, $strDescripcion = NULL, $strBusqueda = NULL,  $strEstatus = NULL, $strTipoPersona = NULL)
	{
		$this->db->select('documento_cliente_id, descripcion, solicitar, estatus');
		$this->db->from('documentos_clientes');
		//Si existe id del documento
		if ($intDocumentoClienteID !== NULL)
		{   
			$this->db->where('documento_cliente_id', $intDocumentoClienteID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strDescripcion !== NULL)//Si existe descripción
		{
			$this->db->where('descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if($strTipoPersona !== NULL)//Si existe un tipo de persona enviada(MORAL O FISICA)
		{
			$strSQL	= $this->db->query("SELECT 	documento_cliente_id, 
												descripcion, 
												solicitar, 
												estatus 
										FROM documentos_clientes 
										WHERE solicitar = '$strTipoPersona'
										AND estatus = 'ACTIVO'
										UNION
										SELECT 	documento_cliente_id, 
												descripcion, 
												solicitar, 
												estatus 
										FROM documentos_clientes 
										WHERE solicitar = 'AMBAS'
										AND estatus = 'ACTIVO'
										ORDER BY descripcion;");
		
			return $strSQL->result();
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
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->from('documentos_clientes');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('documento_cliente_id, descripcion, solicitar, estatus');
		$this->db->from('documentos_clientes');
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["documentos"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>