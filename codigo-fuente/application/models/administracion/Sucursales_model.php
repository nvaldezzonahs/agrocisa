<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursales_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSucursal)
	{
		//Asignar datos al array
		$arrDatos = array('empresa_id' => $objSucursal->intEmpresaID, 
						  'nombre' => $objSucursal->strNombre, 
						  'calle' => $objSucursal->strCalle, 
						  'numero_exterior' => $objSucursal->strNumeroExterior,
						  'numero_interior' => $objSucursal->strNumeroInterior,
						  'codigo_postal' => $objSucursal->strCodigoPostal,
						  'colonia' => $objSucursal->strColonia,
						  'localidad_id' => $objSucursal->intLocalidadID,
						  'telefono_01' => $objSucursal->strTelefono01,
						  'telefono_02' => $objSucursal->strTelefono02,
						  'correo_electronico' => $objSucursal->strCorreoElectronico,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSucursal->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('sucursales', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objSucursal)
	{
		//Asignar datos al array
		$arrDatos = array('nombre' => $objSucursal->strNombre, 
						  'calle' => $objSucursal->strCalle, 
						  'numero_exterior' => $objSucursal->strNumeroExterior,
						  'numero_interior' => $objSucursal->strNumeroInterior,
						  'codigo_postal' => $objSucursal->strCodigoPostal,
						  'colonia' => $objSucursal->strColonia,
						  'localidad_id' => $objSucursal->intLocalidadID,
						  'telefono_01' => $objSucursal->strTelefono01,
						  'telefono_02' => $objSucursal->strTelefono02,
						  'correo_electronico' => $objSucursal->strCorreoElectronico,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSucursal->intUsuarioID);
		$this->db->where('sucursal_id', $objSucursal->intSucursalID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sucursales', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intSucursalID, $strEstatus)
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
		$this->db->where('sucursal_id', $intSucursalID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('sucursales', $arrDatos);
	}

	//Método para regresar las sucursales a un combobox
	public function get_combo_box($intUsuarioID = NULL)
	{
		//Si existe id del usuario
		if ($intUsuarioID !== NULL)
		{
			$this->db->select('S.sucursal_id AS value, S.nombre');
			$this->db->from('sucursales AS S');
			$this->db->join('usuarios_permisos AS UP', 'UP.sucursal_id = S.sucursal_id', 'inner');
			$this->db->where('UP.usuario_id', $intUsuarioID);
			$this->db->where('S.estatus', 'ACTIVO');
			$this->db->order_by('S.nombre','ASC');
			return $this->db->get()->result();
		}
		else
		{
			$this->db->select('sucursal_id AS value, nombre');
			$this->db->from('sucursales');
			$this->db->where('estatus', 'ACTIVO');
			$this->db->order_by('nombre','ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intSucursalID = NULL, $strNombre = NULL, $strBusqueda = NULL)
	{
		$this->db->select("S.sucursal_id, S.nombre, S.calle, S.numero_exterior, S.numero_interior,
						   S.codigo_postal, S.colonia, S.localidad_id, S.telefono_01, S.telefono_02,
						   S.correo_electronico, S.estatus, L.descripcion AS localidad,
						   M.descripcion AS municipio, CONCAT_WS(' - ',E.codigo, E.descripcion) AS estado,
						   CONCAT_WS(' - ', P.codigo, P.descripcion) AS pais, E.descripcion AS estado_rep, 
						   P.descripcion AS pais_rep", FALSE);
		$this->db->from('sucursales AS S');
		$this->db->join('localidades AS L', 'S.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS M', 'L.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		//Si existe id de la sucursal
		if ($intSucursalID !== NULL)
		{   
			$this->db->where('S.sucursal_id', $intSucursalID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strNombre !== NULL)//Si existe nombre
		{
			$this->db->where('S.nombre', $strNombre);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{	
			$this->db->like('E.descripcion', $strBusqueda);
	        $this->db->or_like('P.descripcion', $strBusqueda);
	        $this->db->or_like('M.descripcion', $strBusqueda);
	        $this->db->or_like('L.descripcion', $strBusqueda);
	        $this->db->or_like('S.nombre', $strBusqueda);
	        $this->db->or_like('S.telefono_01', $strBusqueda);
	        $this->db->or_like('S.estatus', $strBusqueda);
			$this->db->order_by('E.codigo, M.descripcion, L.descripcion, S.nombre', 'ASC');
			return $this->db->get()->result();
		}
	}
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('E.descripcion', $strBusqueda);
	    $this->db->or_like('P.descripcion', $strBusqueda);
	    $this->db->or_like('M.descripcion', $strBusqueda);
	    $this->db->or_like('L.descripcion', $strBusqueda);
	    $this->db->or_like('S.nombre', $strBusqueda);
	    $this->db->or_like('S.telefono_01', $strBusqueda);
	    $this->db->or_like('S.estatus', $strBusqueda);
		$this->db->from('sucursales AS S');
		$this->db->join('localidades AS L', 'S.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS M', 'L.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('S.sucursal_id, S.nombre, S.calle, S.numero_exterior, 
						   S.numero_interior, S.codigo_postal, S.colonia, S.telefono_01, S.estatus, 
						   L.descripcion AS localidad, M.descripcion AS municipio, 
	    				   E.descripcion AS estado, P.descripcion AS pais');
		$this->db->from('sucursales AS S');
		$this->db->join('localidades AS L', 'S.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS M', 'L.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		$this->db->like('E.descripcion', $strBusqueda);
	    $this->db->or_like('P.descripcion', $strBusqueda);
	    $this->db->or_like('M.descripcion', $strBusqueda);
	    $this->db->or_like('L.descripcion', $strBusqueda);
	    $this->db->or_like('S.nombre', $strBusqueda);
	    $this->db->or_like('S.telefono_01', $strBusqueda);
	    $this->db->or_like('S.estatus', $strBusqueda);
		$this->db->order_by('E.codigo, M.descripcion, L.descripcion, S.nombre', 'ASC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["sucursales"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strTipo)
	{
		$this->db->select(' sucursal_id, nombre ');
        $this->db->from('sucursales');
        //Si el tipo corresponde a no incluir, significa que no se recuperará la sucursal que se encuentra logeada en el sistema
        if($strTipo === 'no incluir')
        {
        	$this->db->where('sucursal_id <>', $this->session->userdata('sucursal_id'));
        }
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(nombre LIKE '%$strDescripcion%')");  
		$this->db->order_by('nombre', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	  	return $this->db->get()->result();
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function destino_autocomplete($strDescripcion, $intSucursalID)
	{
		$this->db->select('sucursal_id, nombre');
        $this->db->from('sucursales');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(nombre LIKE '%$strDescripcion%')"); 
        $this->db->where("sucursal_id !=", $intSucursalID); 
		$this->db->order_by('nombre', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	  	return $this->db->get()->result();
	}

}
?>