<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_uso_cfdi_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatUsoCfdi)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatUsoCfdi->strCodigo, 
						  'descripcion' => $objSatUsoCfdi->strDescripcion, 
						  'fisica' => $objSatUsoCfdi->strPersonaFisica, 
						  'moral' => $objSatUsoCfdi->strPersonaMoral, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatUsoCfdi->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_uso_cfdi', $arrDatos);
	}
	
	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatUsoCfdi)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatUsoCfdi->strCodigo, 
						  'descripcion' => $objSatUsoCfdi->strDescripcion, 
						  'fisica' => $objSatUsoCfdi->strPersonaFisica, 
						  'moral' => $objSatUsoCfdi->strPersonaMoral, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatUsoCfdi->intUsuarioID);
		$this->db->where('uso_cfdi_id', $objSatUsoCfdi->intUsoCfdiID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_uso_cfdi', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intUsoCfdiID, $strEstatus)
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
		$this->db->where('uso_cfdi_id', $intUsoCfdiID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_uso_cfdi', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intUsoCfdiID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select('uso_cfdi_id, codigo, descripcion, fisica, moral, estatus');
		$this->db->from('sat_uso_cfdi');
		//Si existe id del uso de comprobante
		if ($intUsoCfdiID !== NULL)
		{   
			$this->db->where('uso_cfdi_id', $intUsoCfdiID);
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
		$this->db->from('sat_uso_cfdi');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('uso_cfdi_id, codigo, descripcion, estatus');
		$this->db->from('sat_uso_cfdi');
		$this->db->like('codigo', $strBusqueda);
	    $this->db->or_like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('codigo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["usos_cfdi"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" uso_cfdi_id,
						    CONCAT_WS(' - ', codigo, descripcion) AS uso_cfdi ", FALSE);
        $this->db->from('sat_uso_cfdi');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(codigo LIKE '%$strDescripcion%' OR
        				   descripcion LIKE '%$strDescripcion%')");  
        $this->db->order_by("codigo",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>