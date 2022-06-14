<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing_product_lines_model extends CI_model {
	//MPL - Línea (s) de Productos de Marketing
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objMPL)
	{
		//Asignar datos al array
		$arrDatos = array('mcd_id' => $objMPL->intMcdID,
						  'codigo' => $objMPL->strCodigo, 
						  'descripcion' => $objMPL->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMPL->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('marketing_product_lines', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objMPL)
	{
		//Asignar datos al array
		$arrDatos = array('mcd_id' => $objMPL->intMcdID,
						  'codigo' => $objMPL->strCodigo, 
						  'descripcion' => $objMPL->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMPL->intUsuarioID);
		$this->db->where('mpl_id', $objMPL->intMplID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('marketing_product_lines', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intMplID, $strEstatus)
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
		$this->db->where('mpl_id', $intMplID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('marketing_product_lines', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMplID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select("MPL.mpl_id, MPL.mcd_id, MPL.codigo, MPL.descripcion, MPL.estatus,
						   CONCAT_WS(' - ', MCD.codigo, MCD.descripcion) AS marketing_code_description, 
						   CONCAT_WS(' - ', MPL.codigo, MPL.descripcion) AS marketing_product_line", FALSE);
		$this->db->from('marketing_product_lines AS MPL');
		$this->db->join('marketing_code_descriptions AS MCD', 'MPL.mcd_id = MCD.mcd_id', 'inner');
		//Si existe id de la MPL
		if ($intMplID !== NULL)
		{   
			$this->db->where('MPL.mpl_id', $intMplID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigo !== NULL)//Si existe código
		{
			$this->db->where('MPL.codigo', $strCodigo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('MPL.codigo', $strBusqueda);
		    $this->db->or_like('MPL.descripcion', $strBusqueda);
	        $this->db->or_like('MPL.estatus', $strBusqueda);   
			$this->db->order_by('MPL.codigo', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('MPL.codigo', $strBusqueda);
		$this->db->or_like('MPL.descripcion', $strBusqueda);
	    $this->db->or_like('MPL.estatus', $strBusqueda);    
		$this->db->from('marketing_product_lines AS MPL');
		$this->db->join('marketing_code_descriptions AS MCD', 'MPL.mcd_id = MCD.mcd_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('MPL.mpl_id, MPL.codigo, MPL.descripcion, MPL.estatus');
		$this->db->from('marketing_product_lines AS MPL');
		$this->db->join('marketing_code_descriptions AS MCD', 'MPL.mcd_id = MCD.mcd_id', 'inner');
		$this->db->like('MPL.codigo', $strBusqueda);
		$this->db->or_like('MPL.descripcion', $strBusqueda);
	    $this->db->or_like('MPL.estatus', $strBusqueda);  
		$this->db->order_by('MPL.codigo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["MPL"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" MPL.mpl_id, 
						    CONCAT_WS(' ',MPL.codigo, '-', MPL.descripcion, ',', MCD.descripcion) AS descripcion ", FALSE);
        $this->db->from('marketing_product_lines AS MPL');
		$this->db->join('marketing_code_descriptions AS MCD', 'MPL.mcd_id = MCD.mcd_id', 'inner');
	    $this->db->where('MPL.estatus', 'ACTIVO');
        $this->db->where("(MPL.codigo LIKE '%$strDescripcion%' OR
        				   MPL.descripcion LIKE '%$strDescripcion%')");  
        $this->db->order_by('MPL.codigo', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
		return $this->db->get()->result();
	}
}
?>