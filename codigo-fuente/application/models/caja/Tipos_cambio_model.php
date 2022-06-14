<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipos_cambio_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objTipoCambio)
	{
		//Asignar datos al array
		$arrDatos = array('fecha' => $objTipoCambio->dteFecha, 
						  'moneda_id' => $objTipoCambio->intMonedaID, 
						  'tipo_cambio_venta' => $objTipoCambio->intTipoCambioVenta, 
						  'tipo_cambio_sat' => $objTipoCambio->intTipoCambioSat, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objTipoCambio->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('tipos_cambio', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objTipoCambio)
	{
		//Asignar datos al array
		$arrDatos = array('fecha' => $objTipoCambio->dteFecha, 
						  'moneda_id' => $objTipoCambio->intMonedaID, 
						  'tipo_cambio_venta' => $objTipoCambio->intTipoCambioVenta, 
						  'tipo_cambio_sat' => $objTipoCambio->intTipoCambioSat,  
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objTipoCambio->intUsuarioID);
		$this->db->where('tipo_cambio_id', $objTipoCambio->intTipoCambioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('tipos_cambio', $arrDatos);
	}	

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intTipoCambioID = NULL, $strCriteriosBusq = NULL, $dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL, $intMonedaID = NULL)
	{
		$this->db->select("TC.tipo_cambio_id, DATE_FORMAT(TC.fecha,'%d/%m/%Y') AS fecha, TC.moneda_id,
						   TC.tipo_cambio_venta,  TC.tipo_cambio_sat, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda", FALSE);
		$this->db->from('tipos_cambio AS TC');
		$this->db->join('sat_monedas AS M', 'TC.moneda_id = M.moneda_id', 'inner');
		//Si existe id del tipo de cambio
		if ($intTipoCambioID !== NULL)
		{   
			$this->db->where('TC.tipo_cambio_id', $intTipoCambioID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (fecha|monedaID) para obtener los criterios de búsqueda
            list($dteFecha, $intMonedaID) = explode("|", $strCriteriosBusq); 
			$this->db->where('TC.fecha', $dteFecha);
			$this->db->where('TC.moneda_id', $intMonedaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			//Si existe id de la moneda
		    if($intMonedaID > 0)
		    {
				$this->db->where('TC.moneda_id', $intMonedaID);
			}
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(TC.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }
			$this->db->order_by('TC.fecha', 'DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intMonedaID = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe id de la moneda
	    if($intMonedaID > 0)
	    {
			$this->db->where('TC.moneda_id', $intMonedaID);
		}
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(TC.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
		$this->db->from('tipos_cambio AS TC');
		$this->db->join('sat_monedas AS M', 'TC.moneda_id = M.moneda_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("TC.tipo_cambio_id, DATE_FORMAT(TC.fecha,'%d/%m/%Y') AS fecha, 
						   TC.tipo_cambio_venta, TC.tipo_cambio_sat,
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda", FALSE);
		$this->db->from('tipos_cambio AS TC');
		$this->db->join('sat_monedas AS M', 'TC.moneda_id = M.moneda_id', 'inner');
		//Si existe id de la moneda
	    if($intMonedaID > 0)
	    {
			$this->db->where('TC.moneda_id', $intMonedaID);
		}
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(TC.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
		$this->db->order_by('TC.fecha', 'DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["tipos"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>