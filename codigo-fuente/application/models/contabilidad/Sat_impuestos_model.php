<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_impuestos_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatImpuesto)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatImpuesto->strCodigo, 
						  'descripcion' => $objSatImpuesto->strDescripcion, 
						  'retencion' => $objSatImpuesto->strRetencion, 
						  'traslado' => $objSatImpuesto->strTraslado,
						  'tipo' => $objSatImpuesto->strTipo,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatImpuesto->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_impuestos', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatImpuesto)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatImpuesto->strCodigo, 
						  'descripcion' => $objSatImpuesto->strDescripcion, 
						  'retencion' => $objSatImpuesto->strRetencion, 
						  'traslado' => $objSatImpuesto->strTraslado,
						  'tipo' => $objSatImpuesto->strTipo,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatImpuesto->intUsuarioID);
		$this->db->where('impuesto_id', $objSatImpuesto->intImpuestoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_impuestos', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intImpuestoID, $strEstatus)
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
		$this->db->where('impuesto_id', $intImpuestoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_impuestos', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intImpuestoID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select('impuesto_id, codigo, descripcion, retencion, traslado, tipo, estatus');
		$this->db->from('sat_impuestos');
		//Si existe id del impuesto
		if ($intImpuestoID !== NULL)
		{   
			$this->db->where('impuesto_id', $intImpuestoID);
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
		$this->db->from('sat_impuestos');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('impuesto_id, codigo, descripcion, estatus');
		$this->db->from('sat_impuestos');
		$this->db->like('codigo', $strBusqueda);
	    $this->db->or_like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda); 
		$this->db->order_by('codigo','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["impuestos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" impuesto_id, CONCAT_WS(' - ', codigo, descripcion) AS impuesto, 
							traslado, retencion", FALSE);
        $this->db->from('sat_impuestos');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(codigo LIKE '%$strDescripcion%' OR
        				   descripcion LIKE '%$strDescripcion%')");  
        $this->db->order_by("codigo",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>