<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_bancos_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatBanco)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatBanco->strCodigo, 
						  'descripcion' => $objSatBanco->strDescripcion, 
						  'rfc' => $objSatBanco->strRfc,
						  'razon_social' => $objSatBanco->strRazonSocial,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatBanco->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_bancos', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatBanco)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatBanco->strCodigo, 
						  'descripcion' => $objSatBanco->strDescripcion,
						  'rfc' => $objSatBanco->strRfc,
						  'razon_social' => $objSatBanco->strRazonSocial, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatBanco->intUsuarioID);
		$this->db->where('banco_id', $objSatBanco->intBancoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_bancos', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intBancoID, $strEstatus)
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
		$this->db->where('banco_id', $intBancoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_bancos', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intBancoID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select('banco_id, codigo, descripcion, rfc, razon_social, estatus');
		$this->db->from('sat_bancos');
		//Si existe id del banco
		if ($intBancoID !== NULL)
		{   
			$this->db->where('banco_id', $intBancoID);
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
		    $this->db->or_like('rfc', $strBusqueda); 
		    $this->db->or_like('razon_social', $strBusqueda); 
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
		$this->db->or_like('rfc', $strBusqueda); 
	    $this->db->or_like('razon_social', $strBusqueda); 
        $this->db->or_like('estatus', $strBusqueda);
		$this->db->from('sat_bancos');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('banco_id, codigo, descripcion, rfc, razon_social, estatus');
		$this->db->from('sat_bancos');
		$this->db->like('codigo', $strBusqueda);
		$this->db->or_like('descripcion', $strBusqueda);
		$this->db->or_like('rfc', $strBusqueda); 
	    $this->db->or_like('razon_social', $strBusqueda); 
        $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('codigo','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["bancos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion,  $strTipo = NULL)
	{
		$this->db->select(" banco_id, CONCAT_WS(' - ', codigo, descripcion) AS banco, 
						    rfc, razon_social", FALSE);
        $this->db->from('sat_bancos');
		$this->db->where('estatus', 'ACTIVO');
		//Dependiendo del tipo definir criterios de búsqueda
		if($strTipo == 'rfc')
		{
		   $this->db->where("(rfc LIKE '%$strDescripcion%')"); 
		}
		else
		{
			$this->db->where("(codigo LIKE '%$strDescripcion%' OR  
        				       descripcion LIKE '%$strDescripcion%')");
		}
          
		$this->db->order_by('codigo', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>