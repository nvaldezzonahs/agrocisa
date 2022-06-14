<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sat_tipos_permisos_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSatTipoPermiso)
	{
		//Asignar datos al array
		$arrDatos = array('clave_transporte_id' => $objSatTipoPermiso->intClaveTransporteID, 
						  'codigo' => $objSatTipoPermiso->strCodigo, 
						  'descripcion' => $objSatTipoPermiso->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSatTipoPermiso->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sat_tipos_permisos', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSatTipoPermiso)
	{
		//Asignar datos al array
		$arrDatos = array('clave_transporte_id' => $objSatTipoPermiso->intClaveTransporteID,
						  'codigo' => $objSatTipoPermiso->strCodigo, 
						  'descripcion' => $objSatTipoPermiso->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSatTipoPermiso->intUsuarioID);
		$this->db->where('tipo_permiso_id', $objSatTipoPermiso->intTipoPermisoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_tipos_permisos', $arrDatos);
	}
	
	//Método para modificar el estatus de un registro
	public function set_estatus($intTipoPermisoID, $strEstatus)
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
		$this->db->where('tipo_permiso_id', $intTipoPermisoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sat_tipos_permisos', $arrDatos);
	}

	//Método para regresar los registros a un combobox
	public function get_combo_box()
	{	
		$this->db->select("tipo_permiso_id AS value, CONCAT_WS(' - ', codigo, descripcion) AS nombre", FALSE);
		$this->db->from('sat_tipos_permisos');
		$this->db->where('estatus', 'ACTIVO');
		$this->db->order_by('codigo','ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intTipoPermisoID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select("TP.tipo_permiso_id,TP.clave_transporte_id, TP.codigo, TP.descripcion, TP.estatus, 
						   CONCAT_WS(' - ', CT.codigo, CT.descripcion) AS clave_transporte", FALSE);
		$this->db->from('sat_tipos_permisos AS TP');
		$this->db->join('sat_clave_transporte AS CT', 'TP.clave_transporte_id = CT.clave_transporte_id', 'inner');
		//Si existe id del registro
		if ($intTipoPermisoID !== NULL)
		{   
			$this->db->where('TP.tipo_permiso_id', $intTipoPermisoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigo !== NULL)//Si existe código
		{
			$this->db->where('TP.codigo', $strCodigo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('TP.codigo', $strBusqueda);
		    $this->db->or_like('TP.descripcion', $strBusqueda);
		    $this->db->or_like('TP.estatus', $strBusqueda); 
		    $this->db->or_like("CONCAT_WS(' - ', CT.codigo, CT.descripcion)", $strBusqueda);
	 		$this->db->or_like("CONCAT_WS(' ', CT.codigo, CT.descripcion)", $strBusqueda); 
			$this->db->order_by('codigo', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('TP.codigo', $strBusqueda);
	    $this->db->or_like('TP.descripcion', $strBusqueda);
	    $this->db->or_like('TP.estatus', $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' - ', CT.codigo, CT.descripcion)", $strBusqueda);
 		$this->db->or_like("CONCAT_WS(' ', CT.codigo, CT.descripcion)", $strBusqueda); 
		$this->db->from('sat_tipos_permisos AS TP');
		$this->db->join('sat_clave_transporte AS CT', 'TP.clave_transporte_id = CT.clave_transporte_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("TP.tipo_permiso_id, TP.codigo, TP.descripcion, TP.estatus, 
						   CONCAT_WS(' - ', CT.codigo, CT.descripcion) AS clave_transporte", FALSE);
		$this->db->from('sat_tipos_permisos AS TP');
		$this->db->join('sat_clave_transporte AS CT', 'TP.clave_transporte_id = CT.clave_transporte_id', 'inner');
		$this->db->like('TP.codigo', $strBusqueda);
	    $this->db->or_like('TP.descripcion', $strBusqueda);
	    $this->db->or_like('TP.estatus', $strBusqueda); 
	    $this->db->or_like("CONCAT_WS(' - ', CT.codigo, CT.descripcion)", $strBusqueda);
 		$this->db->or_like("CONCAT_WS(' ', CT.codigo, CT.descripcion)", $strBusqueda); 
		$this->db->order_by('TP.codigo','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["tipos"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>