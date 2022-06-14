<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Folios_polizas_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objFolioPoliza)
	{
	   //Asignar datos al array
		$arrDatos = array('sucursal_id' => $objFolioPoliza->intSucursalID, 
						  'folio_id' => $objFolioPoliza->intFolioID, 
						  'tipo' => $objFolioPoliza->strTipo,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objFolioPoliza->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('folios_polizas', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objFolioPoliza)
	{
		//Asignar datos al array
		$arrDatos = array('folio_id' => $objFolioPoliza->intFolioID, 
						  'tipo' => $objFolioPoliza->strTipo,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objFolioPoliza->intUsuarioID);
		$this->db->where('sucursal_id', $objFolioPoliza->intSucursalID);
		$this->db->where('folio_id', $objFolioPoliza->intFolioIDAnterior);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('folios_polizas', $arrDatos);
	}

	//Método para eliminar los datos de un registro
	public function eliminar($intFolioID, $strTipo)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('folio_id', $intFolioID);  
		$this->db->where('tipo', $strTipo);  
		//Eliminar los datos del registro
        $this->db->delete('folios_polizas');
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intFolioID = NULL, $strTipo = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		$this->db->select('FP.folio_id, FP.tipo, F.serie, F.consecutivo, 
						   F.descripcion AS folio');
		$this->db->from('folios_polizas AS FP');
		$this->db->join('folios AS F', 'FP.folio_id = F.folio_id', 'inner');
		$this->db->where('FP.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existen id's
		if($intFolioID > 0 && $strTipo !== NULL)
		{
			$this->db->where('FP.folio_id', $intFolioID);
			$this->db->where('FP.tipo', $strTipo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if($strTipo !== NULL)//Si existe tipo de póliza
		{
			$this->db->where('FP.tipo', $strTipo);
			//Si existe estatus del folio
			if($strEstatus !== NULL)
			{
				$this->db->where('F.estatus', $strEstatus);
			}
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{	
			$this->db->where("(FP.tipo LIKE '%$strBusqueda%' OR  
							   F.serie LIKE '%$strBusqueda%' OR  
		        			   F.descripcion LIKE '%$strBusqueda%' OR
		        			   F.consecutivo LIKE '%$strBusqueda%')"); 
			$this->db->order_by('F.serie', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('FP.sucursal_id', $this->session->userdata('sucursal_id'));
        $this->db->where("(FP.tipo LIKE '%$strBusqueda%' OR  
						   F.serie LIKE '%$strBusqueda%' OR  
	        			   F.descripcion LIKE '%$strBusqueda%' OR
	        			   F.consecutivo LIKE '%$strBusqueda%')"); 
        $this->db->from('folios_polizas AS FP');
		$this->db->join('folios AS F', 'FP.folio_id = F.folio_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("FP.folio_id, FP.tipo,
						   CONCAT_WS(' - ', F.serie, F.descripcion) AS folio, 
						   F.consecutivo", FALSE);
		$this->db->from('folios_polizas AS FP');
		$this->db->join('folios AS F', 'FP.folio_id = F.folio_id', 'inner');
		$this->db->where('FP.sucursal_id', $this->session->userdata('sucursal_id'));
        $this->db->where("(FP.tipo LIKE '%$strBusqueda%' OR  
						   F.serie LIKE '%$strBusqueda%' OR  
	        			   F.descripcion LIKE '%$strBusqueda%' OR
	        			   F.consecutivo LIKE '%$strBusqueda%')");  
		$this->db->order_by('F.serie', 'ASC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["folios"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>