<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificados_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objCertificado)
	{
		//Asignar datos al array
		$arrDatos = array('folio' => $objCertificado->strFolio, 
						  'vigencia_desde' => $objCertificado->dteVigenciaDesde, 
						  'vigencia_hasta' => $objCertificado->dteVigenciaHasta, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objCertificado->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('certificados', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objCertificado)
	{
		//Asignar datos al array
		$arrDatos = array('folio' => $objCertificado->strFolio, 
						  'vigencia_desde' => $objCertificado->dteVigenciaDesde, 
						  'vigencia_hasta' => $objCertificado->dteVigenciaHasta,  
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objCertificado->intUsuarioID);
		$this->db->where('certificado_id',  $objCertificado->intCertificadoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('certificados', $arrDatos);
	}	

    //Método para modificar el estatus de un registro
	public function set_estatus($intCertificadoID, $strEstatus)
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
		$this->db->where('certificado_id', $intCertificadoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('certificados', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intCertificadoID = NULL, $strFolio = NULL, $strEstatus = NULL, 
						   $strBusqueda = NULL)
	{
		$this->db->select("certificado_id, folio, DATE_FORMAT(vigencia_desde,'%d/%m/%Y') AS vigencia_desde, 
						   DATE_FORMAT(vigencia_hasta,'%d/%m/%Y') AS vigencia_hasta, estatus, 
						   DATEDIFF(vigencia_hasta, CURDATE()) AS dias_vigencia", FALSE);
		$this->db->from('certificados');
		//Si existe id del certificado
		if ($intCertificadoID !== NULL)
		{   
			$this->db->where('certificado_id', $intCertificadoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strFolio !== NULL)//Si existe folio
		{
			$this->db->where('folio', $strFolio);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strEstatus !== NULL)//Si existe estatus
		{
			$this->db->where('estatus', $strEstatus);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->like('folio', $strBusqueda);
			$this->db->or_like('estatus', $strBusqueda);
			$this->db->order_by('vigencia_desde', 'DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('folio', $strBusqueda);
		$this->db->or_like('estatus', $strBusqueda);
		$this->db->from('certificados');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("certificado_id, folio, DATE_FORMAT(vigencia_desde,'%d/%m/%Y') AS vigencia_desde, 
						   DATE_FORMAT(vigencia_hasta,'%d/%m/%Y') AS vigencia_hasta, estatus, 
						   DATEDIFF(vigencia_hasta, CURDATE()) AS dias_vigencia", FALSE);
		$this->db->from('certificados');
		$this->db->like('folio', $strBusqueda);
		$this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('vigencia_desde', 'DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["certificados"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>