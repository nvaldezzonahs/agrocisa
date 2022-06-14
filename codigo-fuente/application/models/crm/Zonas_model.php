<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zonas_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla zonas
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objZona)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla zonas
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objZona->strDescripcion,
						  'modulo_id' => $objZona->intModuloID,
						  'vendedor_id' => $objZona->intVendedorID,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objZona->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('zonas', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objZona->intZonaID = $this->db->insert_id();

		//Hacer un llamado al método para guardar las localidades de la zona
        $this->guardar_localidades($objZona);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}


	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objZona)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla zonas
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objZona->strDescripcion,
						  'modulo_id' => $objZona->intModuloID,
						  'vendedor_id' => $objZona->intVendedorID,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objZona->intUsuarioID);
		$this->db->where('zona_id', $objZona->intZonaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('zonas', $arrDatos);

		//Eliminar las localidades de la zona
		$this->db->where('zona_id', $objZona->intZonaID);  
        $this->db->delete('zonas_localidades');
        //Hacer un llamado al método para guardar las localidades de la zona
        $this->guardar_localidades($objZona);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intZonaID, $strEstatus)
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
		$this->db->where('zona_id', $intZonaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('zonas', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intZonaID = NULL, $strCriteriosBusq = NULL, $strBusqueda = NULL)
	{
		$this->db->select("Z.zona_id, Z.vendedor_id, Z.descripcion, Z.modulo_id, Z.estatus, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS vendedor,
						   M.descripcion AS modulo", FALSE);
		$this->db->from('zonas AS Z');
		$this->db->join('vendedores AS V', 'Z.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS E', 'V.empleado_id = E.empleado_id', 'inner');
		$this->db->join('modulos AS M', 'V.modulo_id = M.modulo_id', 'inner');
		//Si existe id de la zona
		if ($intZonaID !== NULL)
		{   
			$this->db->where('Z.zona_id', $intZonaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (moduloID|descripcion) para obtener los criterios de búsqueda
            list($intModuloID, $strDescripcion) = explode("|", $strCriteriosBusq);
			$this->db->where('Z.modulo_id', $intModuloID);
			$this->db->where('Z.descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('Z.descripcion', $strBusqueda);
			$this->db->or_like('Z.estatus', $strBusqueda);
	        $this->db->or_like('M.descripcion', $strBusqueda);
	        $this->db->or_like("CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre)", $strBusqueda);
		    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
			$this->db->order_by('Z.modulo_id, Z.descripcion','ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('Z.descripcion', $strBusqueda);
		$this->db->or_like('Z.estatus', $strBusqueda);
        $this->db->or_like('M.descripcion', $strBusqueda);
        $this->db->or_like("CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
		$this->db->from('zonas AS Z');
		$this->db->join('modulos AS M', 'Z.modulo_id = M.modulo_id', 'inner');
		$this->db->join('vendedores AS V', 'Z.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS E', 'V.empleado_id = E.empleado_id', 'inner');
		
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("Z.zona_id, Z.descripcion, Z.estatus,
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS vendedor,
						   M.descripcion AS modulo", FALSE);
		$this->db->from('zonas AS Z');
		$this->db->join('vendedores AS V', 'Z.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS E', 'V.empleado_id = E.empleado_id', 'inner');
		$this->db->join('modulos AS M', 'V.modulo_id = M.modulo_id', 'inner');
     	$this->db->like('Z.descripcion', $strBusqueda);
		$this->db->or_like('Z.estatus', $strBusqueda);
        $this->db->or_like('M.descripcion', $strBusqueda);
        $this->db->or_like("CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
		$this->db->order_by('Z.modulo_id, Z.descripcion','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["zonas"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar las localidades de una zona
	public function get_localidades($intZonaID = 0, $strOcupadas = NULL, $intModuloID = NULL)
	{
		//Si tipo de localidades es ocupadas
		if($strOcupadas !== NULL)
		{
			$this->db->select('ZL.localidad_id');
			$this->db->from('zonas_localidades AS ZL');
			$this->db->join('zonas AS Z', 'ZL.zona_id = Z.zona_id', 'inner');
			$this->db->where('Z.modulo_id', $intModuloID);
			//Si existe id de la zona
			if($intZonaID > 0)
			{
				$this->db->where('Z.zona_id <>', $intZonaID);
			}
		}
		else
		{
			$this->db->select('localidad_id');
			$this->db->from('zonas_localidades');
			$this->db->where('zona_id', $intZonaID);
		}
		
		return $this->db->get()->result();
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($intModuloID, $strDescripcion)
	{
		$this->db->select(' Z.zona_id, Z.descripcion, M.descripcion AS modulo');
        $this->db->from('zonas AS Z');
        $this->db->join('modulos AS M', 'Z.modulo_id = M.modulo_id', 'inner');
		$this->db->where('Z.estatus', 'ACTIVO');
		$this->db->where('Z.modulo_id', $intModuloID);
        $this->db->where("(Z.descripcion LIKE '%$strDescripcion%')"); 
        $this->db->order_by('Z.descripcion', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla zonas_localidades
	*********************************************************************************************************************/
	//Función que se utiliza para guardar las localidades de una zona.
    public function guardar_localidades(stdClass $objZona)
    {
	    //Quitar | de la lista para obtener clave de la localidad
        $arrLocalidades  = explode("|", $objZona->strLocalidades);
        //Hacer recorrido para insertar los datos en la tabla zonas_localidades
        foreach ($arrLocalidades as $intLocalidadID) 
        {
        	//Asignar datos al array
        	$arrDatos = array('zona_id' => $objZona->intZonaID,
							  'localidad_id' => $intLocalidadID);
        	//Guardar los datos del registro
			$this->db->insert('zonas_localidades', $arrDatos);
        }
    }

}
?>