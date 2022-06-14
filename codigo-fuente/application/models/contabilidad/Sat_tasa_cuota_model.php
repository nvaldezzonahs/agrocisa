<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_tasa_cuota_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatTasaCuota)
	{
		//Asignar datos al array
		$arrDatos = array('impuesto_id' => $objSatTasaCuota->intImpuestoID, 
						  'tipo' => $objSatTasaCuota->strTipo,
						  'factor' => $objSatTasaCuota->strFactor,
						  'valor_minimo' => $objSatTasaCuota->intValorMinimo,
						  'valor_maximo' => $objSatTasaCuota->intValorMaximo,
						  'retencion' => $objSatTasaCuota->strRetencion,
						  'traslado' => $objSatTasaCuota->strTraslado,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatTasaCuota->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_tasa_cuota', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatTasaCuota)
	{
		//Asignar datos al array
		$arrDatos = array('impuesto_id' => $objSatTasaCuota->intImpuestoID, 
						  'tipo' => $objSatTasaCuota->strTipo,
						  'factor' => $objSatTasaCuota->strFactor,
						  'valor_minimo' => $objSatTasaCuota->intValorMinimo,
						  'valor_maximo' => $objSatTasaCuota->intValorMaximo,
						  'retencion' => $objSatTasaCuota->strRetencion,
						  'traslado' => $objSatTasaCuota->strTraslado, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatTasaCuota->intUsuarioID);
		$this->db->where('tasa_cuota_id', $objSatTasaCuota->intTasaCuotaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_tasa_cuota', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intTasaCuotaID, $strEstatus)
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
		$this->db->where('tasa_cuota_id',$intTasaCuotaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_tasa_cuota',$arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intTasaCuotaID = NULL, $strCriteriosBusqVerExistencia = NULL, 
							$strCriteriosBusqTasaCuota = NULL, $strBusqueda = NULL)
	{
		$this->db->select("TC.tasa_cuota_id, TC.impuesto_id, TC.tipo, TC.factor, TC.valor_minimo, 
						   TC.valor_maximo, TC.retencion, TC.traslado, TC.estatus, 
						   CONCAT_WS(' - ', I.codigo, I.descripcion) AS impuesto", FALSE);
		$this->db->from('sat_tasa_cuota AS TC');
		$this->db->join('sat_impuestos AS I', 'TC.impuesto_id = I.impuesto_id', 'inner');
		//Si existe id de la tasa o cuota
		if ($intTasaCuotaID !== NULL)
		{   
			$this->db->where('TC.tasa_cuota_id', $intTasaCuotaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusqVerExistencia !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (impuesto_id|tipo|valor_maximo) para obtener los criterios de búsqueda
            list($intImpuestoID, $strTipo, $intValorMaximo) = explode("|", $strCriteriosBusqVerExistencia); 
			$this->db->where('TC.impuesto_id', $intImpuestoID);
			$this->db->where('TC.tipo', $strTipo);
			$this->db->where('TC.valor_maximo', $intValorMaximo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusqTasaCuota !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (codigo_impuesto|factor|valor_maximo) para obtener los criterios de búsqueda
            list($strCodigoImpuesto, $strFactor, $intValorMaximo) = explode("|", $strCriteriosBusqTasaCuota); 
			$this->db->where('I.codigo', $strCodigoImpuesto);
			$this->db->where('TC.factor', $strFactor);
			$this->db->where('TC.valor_maximo', $intValorMaximo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
	        $this->db->like('TC.tipo', $strBusqueda);
	        $this->db->or_like('TC.factor', $strBusqueda);
	        $this->db->or_like('TC.valor_minimo', $strBusqueda);
	        $this->db->or_like('TC.valor_maximo', $strBusqueda);
	        $this->db->or_like('TC.estatus', $strBusqueda);
	        $this->db->or_like('I.codigo', $strBusqueda);
	        $this->db->or_like('I.descripcion', $strBusqueda);
			$this->db->order_by('I.codigo, TC.factor', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('TC.tipo', $strBusqueda);
        $this->db->or_like('TC.factor', $strBusqueda);
        $this->db->or_like('TC.valor_minimo', $strBusqueda);
        $this->db->or_like('TC.valor_maximo', $strBusqueda);
        $this->db->or_like('TC.estatus', $strBusqueda);
        $this->db->or_like('I.codigo', $strBusqueda);
        $this->db->or_like('I.descripcion', $strBusqueda);
		$this->db->from('sat_tasa_cuota AS TC');
		$this->db->join('sat_impuestos AS I', 'TC.impuesto_id = I.impuesto_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("TC.tasa_cuota_id, TC.tipo, UPPER(TC.factor) AS factor, TC.valor_minimo, TC.valor_maximo, 
						   TC.estatus,  CONCAT_WS(' - ', I.codigo, I.descripcion) AS impuesto", FALSE);
		$this->db->from('sat_tasa_cuota AS TC');
		$this->db->join('sat_impuestos AS I', 'TC.impuesto_id = I.impuesto_id', 'inner');
		$this->db->like('TC.tipo', $strBusqueda);
        $this->db->or_like('TC.factor', $strBusqueda);
        $this->db->or_like('TC.valor_minimo', $strBusqueda);
        $this->db->or_like('TC.valor_maximo', $strBusqueda);
        $this->db->or_like('TC.estatus', $strBusqueda);
        $this->db->or_like('I.codigo', $strBusqueda);
        $this->db->or_like('I.descripcion', $strBusqueda);
		$this->db->order_by('I.codigo, TC.factor', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["tasa_cuota"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strImpuesto)
	{
		$this->db->select("TC.tasa_cuota_id, TC.valor_minimo, 
						   TC.valor_maximo,  TC.tipo, TC.factor", FALSE);
       $this->db->from('sat_tasa_cuota AS TC');
		$this->db->join('sat_impuestos AS I', 'TC.impuesto_id = I.impuesto_id', 'inner');
        $this->db->where('I.descripcion', $strImpuesto);
	    $this->db->where('TC.estatus', 'ACTIVO');
        $this->db->where("(TC.valor_maximo LIKE '%$strDescripcion%')");  
        $this->db->order_by("TC.valor_maximo",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>