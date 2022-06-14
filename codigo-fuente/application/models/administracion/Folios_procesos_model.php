<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Folios_procesos_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objFolioProceso)
	{
	   //Asignar datos al array
		$arrDatos = array('sucursal_id' => $objFolioProceso->intSucursalID, 
						  'folio_id' => $objFolioProceso->intFolioID, 
						  'proceso_id' => $objFolioProceso->intProcesoID,
						  'tipo' => $objFolioProceso->strTipo,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objFolioProceso->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('folios_procesos', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objFolioProceso)
	{
		//Asignar datos al array
		$arrDatos = array('folio_id' => $objFolioProceso->intFolioID, 
						  'proceso_id' => $objFolioProceso->intProcesoID, 
						  'tipo' => $objFolioProceso->strTipo,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objFolioProceso->intUsuarioID);
		$this->db->where('sucursal_id', $objFolioProceso->intSucursalID);
		$this->db->where('folio_id', $objFolioProceso->intFolioIDAnterior);
		$this->db->where('proceso_id', $objFolioProceso->intProcesoIDAnterior);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('folios_procesos', $arrDatos);
	}

	//Método para eliminar los datos de un registro
	public function eliminar($intFolioID, $intProcesoID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('folio_id', $intFolioID);  
		$this->db->where('proceso_id', $intProcesoID);  
		//Eliminar los datos del registro
        $this->db->delete('folios_procesos');
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intFolioID = NULL, $intProcesoID = NULL,  $strEstatus = NULL,  
						   $strBusqueda = NULL, $strTipo = NULL, $strSinSucursal = NULL)
	{

		$this->db->select("FP.folio_id, FP.proceso_id, FP.tipo,
						   F.serie, F.consecutivo, F.descripcion AS folio, 
						   P.descripcion AS proceso, 
						   CASE P.menu_nivel 
								WHEN 'NIVEL 1' THEN '' 
								WHEN 'NIVEL 2' THEN PPN1.descripcion
								WHEN 'NIVEL 3' THEN CONCAT(PPN2.descripcion, '/', PPN1.descripcion)
								WHEN 'NIVEL 4' THEN CONCAT(PPN3.descripcion, '/', PPN2.descripcion, '/', PPN1.descripcion)
						   END AS proceso_padre, PPN1.proceso_id AS proceso_nivel1, 
						   PPN2.proceso_id AS proceso_nivel2, PPN3.proceso_id AS proceso_nivel3", FALSE);
		$this->db->from('folios_procesos AS FP');
		$this->db->join('folios AS F', 'FP.folio_id = F.folio_id', 'inner');
		$this->db->join('procesos AS P', 'FP.proceso_id = P.proceso_id', 'inner');
		$this->db->join('procesos AS PPN1', 'P.proceso_padre_id = PPN1.proceso_id', 'left');
		$this->db->join('procesos AS PPN2', 'PPN1.proceso_padre_id = PPN2.proceso_id', 'left');
		$this->db->join('procesos AS PPN3', 'PPN2.proceso_padre_id = PPN3.proceso_id', 'left');

		//Si se cumple la sentencia considerar sucursal logeada en el sistema
		if($strSinSucursal != 'SI')
		{
			$this->db->where('FP.sucursal_id', $this->session->userdata('sucursal_id'));
		}
		
		//Si existen id´s
		if($intFolioID > 0 && $intProcesoID > 0)
		{
			$this->db->where('FP.folio_id', $intFolioID);
			$this->db->where('FP.proceso_id', $intProcesoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($intProcesoID > 0)//Si existe id del proceso
		{   
			$this->db->where('FP.proceso_id', $intProcesoID);
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
		        			   F.consecutivo LIKE '%$strBusqueda%' OR
		        			   P.descripcion LIKE '%$strBusqueda%')"); 
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
	        			   F.consecutivo LIKE '%$strBusqueda%' OR
	        			   P.descripcion LIKE '%$strBusqueda%')"); 
        $this->db->from('folios_procesos AS FP');
		$this->db->join('folios AS F', 'FP.folio_id = F.folio_id', 'inner');
		$this->db->join('procesos AS P', 'FP.proceso_id = P.proceso_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("FP.folio_id, FP.proceso_id, FP.tipo,
						   CONCAT_WS(' - ', F.serie, F.descripcion) AS folio, 
						   F.consecutivo, P.descripcion AS proceso,
						   CASE P.menu_nivel 
								WHEN 'NIVEL 1' THEN '' 
								WHEN 'NIVEL 2' THEN PPN1.descripcion 
								WHEN 'NIVEL 3' THEN CONCAT(PPN2.descripcion,'/',PPN1.descripcion) 
								WHEN 'NIVEL 4' THEN CONCAT(PPN3.descripcion,'/',PPN2.descripcion,'/',PPN1.descripcion) 
						   END AS proceso_padre", FALSE);
		$this->db->from('folios_procesos AS FP');
		$this->db->join('folios AS F', 'FP.folio_id = F.folio_id', 'inner');
		$this->db->join('procesos AS P', 'FP.proceso_id = P.proceso_id', 'inner');
		$this->db->join('procesos AS PPN1', 'P.proceso_padre_id = PPN1.proceso_id', 'left');
		$this->db->join('procesos AS PPN2', 'PPN1.proceso_padre_id = PPN2.proceso_id', 'left');
		$this->db->join('procesos AS PPN3', 'PPN2.proceso_padre_id = PPN3.proceso_id', 'left');
		$this->db->where('FP.sucursal_id', $this->session->userdata('sucursal_id'));
        $this->db->where("(FP.tipo LIKE '%$strBusqueda%' OR  
						   F.serie LIKE '%$strBusqueda%' OR  
	        			   F.descripcion LIKE '%$strBusqueda%' OR
	        			   F.consecutivo LIKE '%$strBusqueda%' OR
	        			   P.descripcion LIKE '%$strBusqueda%')");  
		$this->db->order_by('F.serie', 'ASC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["folios"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>