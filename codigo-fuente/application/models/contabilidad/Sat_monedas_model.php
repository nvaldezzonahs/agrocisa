<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_monedas_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatMoneda)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatMoneda->strCodigo, 
						  'descripcion' => $objSatMoneda->strDescripcion, 
						  'decimales' => $objSatMoneda->intDecimales,
						  'porcentaje_variacion' => $objSatMoneda->intPorcentajeVariacion,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatMoneda->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_monedas', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatMoneda)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objSatMoneda->strCodigo, 
						  'descripcion' => $objSatMoneda->strDescripcion, 
						  'decimales' => $objSatMoneda->intDecimales,
						  'porcentaje_variacion' => $objSatMoneda->intPorcentajeVariacion,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatMoneda->intUsuarioID);
		$this->db->where('moneda_id', $objSatMoneda->intMonedaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_monedas', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intMonedaID, $strEstatus)
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
		$this->db->where('moneda_id', $intMonedaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_monedas', $arrDatos);
	}

	//Método para regresar los registros a un combobox
	public function get_combo_box()
	{	
		$this->db->select("moneda_id AS value, CONCAT_WS(' - ', codigo, descripcion) AS nombre", FALSE);
		$this->db->from('sat_monedas');
		$this->db->where('estatus', 'ACTIVO');
		$this->db->order_by('moneda_id','ASC');
		return $this->db->get()->result();
	}
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMonedaID = NULL, $strCodigo = NULL, $strBusqueda = NULL, $strEstatus = NULL)
	{
		$this->db->select('moneda_id, codigo, descripcion, decimales, porcentaje_variacion, estatus');
		$this->db->from('sat_monedas');
		//Si existe id de la moneda
		if ($intMonedaID !== NULL)
		{   
			$this->db->where('moneda_id', $intMonedaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigo !== NULL)//Si existe código
		{
			$this->db->where('codigo', $strCodigo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strEstatus !== NULL)//Si existe estatus
		{
			$this->db->where('estatus', $strEstatus);
			$this->db->order_by('moneda_id', 'ASC');
			return $this->db->get()->result();
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
		$this->db->from('sat_monedas');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('moneda_id, codigo, descripcion, estatus');
		$this->db->from('sat_monedas');
		$this->db->like('codigo', $strBusqueda);
	    $this->db->or_like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);   
		$this->db->order_by('codigo','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["monedas"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" moneda_id,
						    CONCAT_WS(' - ', codigo, descripcion) AS moneda ", FALSE);
        $this->db->from('sat_monedas');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(codigo LIKE '%$strDescripcion%' OR
        				   descripcion LIKE '%$strDescripcion%')");  
        $this->db->order_by("codigo",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>