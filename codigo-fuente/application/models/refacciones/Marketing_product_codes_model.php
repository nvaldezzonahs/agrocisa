<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing_product_codes_model extends CI_model {
	//MPC - Código (s) de Productos de Marketing
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objMPC)
	{
		//Asignar datos al array
		$arrDatos = array('mpl_id' => $objMPC->intMplID,
						  'codigo' => $objMPC->strCodigo, 
						  'descripcion' => $objMPC->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMPC->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('marketing_product_codes', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objMPC)
	{
		//Asignar datos al array
		$arrDatos = array('mpl_id' => $objMPC->intMplID,
						  'codigo' => $objMPC->strCodigo, 
						  'descripcion' => $objMPC->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMPC->intUsuarioID);
		$this->db->where('mpc_id', $objMPC->intMpcID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('marketing_product_codes', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intMpcID, $strEstatus)
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
		$this->db->where('mpc_id', $intMpcID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('marketing_product_codes', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMpcID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select("MPC.mpc_id, MPC.mpl_id, MPC.codigo, MPC.descripcion, MPC.estatus,
						   CONCAT_WS(' - ', MPL.codigo, MPL.descripcion) AS marketing_product_line,
						   CONCAT_WS(' - ', MCD.codigo, MCD.descripcion) AS marketing_code_description", FALSE);
		$this->db->from('marketing_product_codes AS MPC');
		$this->db->join('marketing_product_lines AS MPL', 'MPC.mpl_id = MPL.mpl_id', 'inner');
		$this->db->join('marketing_code_descriptions AS MCD', 'MPL.mcd_id = MCD.mcd_id', 'inner');
		//Si existe id de la MPC
		if ($intMpcID !== NULL)
		{   
			$this->db->where('MPC.mpc_id', $intMpcID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigo !== NULL)//Si existe código
		{
			$this->db->where('MPC.codigo', $strCodigo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('MPC.codigo', $strBusqueda);
			$this->db->or_like('MPC.descripcion', $strBusqueda);
	        $this->db->or_like('MPC.estatus', $strBusqueda);
			$this->db->order_by('MPC.codigo', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('MPC.codigo', $strBusqueda);
		$this->db->or_like('MPC.descripcion', $strBusqueda);
        $this->db->or_like('MPC.estatus', $strBusqueda);
		$this->db->from('marketing_product_codes AS MPC');
		$this->db->join('marketing_product_lines AS MPL', 'MPC.mpl_id = MPL.mpl_id', 'inner');
		$this->db->join('marketing_code_descriptions AS MCD', 'MPL.mcd_id = MCD.mcd_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('MPC.mpc_id, MPC.codigo, MPC.descripcion, MPC.estatus');
		$this->db->from('marketing_product_codes AS MPC');
		$this->db->join('marketing_product_lines AS MPL', 'MPC.mpl_id = MPL.mpl_id', 'inner');
		$this->db->join('marketing_code_descriptions AS MCD', 'MPL.mcd_id = MCD.mcd_id', 'inner');
		$this->db->like('MPC.codigo', $strBusqueda);
		$this->db->or_like('MPC.descripcion', $strBusqueda);
        $this->db->or_like('MPC.estatus', $strBusqueda);
		$this->db->order_by('MPC.codigo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["MPC"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" MPC.mpc_id, 
						    CONCAT_WS(' ',MPC.codigo, '-', MPC.descripcion, ',', MPL.descripcion, ',', MCD.descripcion) AS descripcion ", FALSE);
        $this->db->from('marketing_product_codes AS MPC');
		$this->db->join('marketing_product_lines AS MPL', 'MPC.mpl_id = MPL.mpl_id', 'inner');
		$this->db->join('marketing_code_descriptions AS MCD', 'MPL.mcd_id = MCD.mcd_id', 'inner');
	    $this->db->where('MPC.estatus', 'ACTIVO');
        $this->db->where("(MPC.codigo LIKE '%$strDescripcion%' OR
        				   MPC.descripcion LIKE '%$strDescripcion%')");  
        $this->db->order_by('MPC.codigo', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
		return $this->db->get()->result();
	}
}
?>