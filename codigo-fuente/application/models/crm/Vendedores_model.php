<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendedores_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla vendedores
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objVendedor)
	{
		//Asignar datos al array
		$arrDatos = array('empleado_id' => $objVendedor->intEmpleadoID, 
						  'modulo_id' => $objVendedor->intModuloID,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objVendedor->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('vendedores', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objVendedor)
	{
		//Asignar datos al array
		$arrDatos = array('empleado_id' => $objVendedor->intEmpleadoID, 
			 			  'modulo_id' => $objVendedor->intModuloID,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objVendedor->intUsuarioID);
		$this->db->where('vendedor_id', $objVendedor->intVendedorID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('vendedores', $arrDatos);
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intVendedorID, $strEstatus)
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
		$this->db->where('vendedor_id', $intVendedorID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('vendedores', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intVendedorID = NULL, $strCriteriosBusq = NULL, $strBusqueda = NULL)
	{
		$this->db->select("V.vendedor_id, V.empleado_id, V.modulo_id, V.estatus, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
						   M.descripcion AS modulo", FALSE);
		$this->db->from('vendedores AS V');
		$this->db->join('empleados AS E', 'V.empleado_id = E.empleado_id', 'inner');
		$this->db->join('modulos AS M', 'V.modulo_id = M.modulo_id', 'inner');
		//Si existe id del vendedor
		if ($intVendedorID !== NULL)
		{   
			$this->db->where('V.vendedor_id', $intVendedorID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (empleadoID|moduloID) para obtener los criterios de búsqueda
            list($intEmpleadoID, $intModuloID) = explode("|", $strCriteriosBusq); 
            $this->db->where('V.empleado_id', $intEmpleadoID);
			$this->db->where('V.modulo_id', $intModuloID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('V.estatus', $strBusqueda);
	        $this->db->or_like('M.descripcion', $strBusqueda);
	        $this->db->or_like("CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre)", $strBusqueda);
		    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
			$this->db->order_by('V.modulo_id, E.apellido_paterno', 'ASC');
			return $this->db->get()->result();
		}
	}


	//Método para regresar los registros que coincidan con el módulo proporcionado 
	public function buscar_modulo($intModuloID)
	{
		$this->db->select("E.sucursal_id, V.vendedor_id, 
						   E.codigo, CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) AS Vendedor, 
						   S.nombre AS Sucursal", FALSE);
		$this->db->from('vendedores AS V');
		$this->db->join('empleados AS E', 'V.empleado_id = E.empleado_id', 'inner');
		$this->db->join('sucursales AS S', 'E.sucursal_id = S.sucursal_id', 'left');
		$this->db->where('V.modulo_id', $intModuloID);
		$this->db->where('V.estatus', 'ACTIVO');
		$this->db->order_by('E.sucursal_id, E.codigo');
	    return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('V.estatus', $strBusqueda);
        $this->db->or_like('M.descripcion', $strBusqueda);
         $this->db->or_like("CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
		$this->db->from('vendedores AS V');
		$this->db->join('empleados AS E', 'V.empleado_id = E.empleado_id', 'inner');
		$this->db->join('modulos AS M', 'V.modulo_id = M.modulo_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("V.vendedor_id, V.estatus, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
						   M.descripcion AS modulo", FALSE);
		$this->db->from('vendedores AS V');
		$this->db->join('empleados AS E', 'V.empleado_id = E.empleado_id', 'inner');
		$this->db->join('modulos AS M', 'V.modulo_id = M.modulo_id', 'inner');
		$this->db->like('V.estatus', $strBusqueda);
        $this->db->or_like('M.descripcion', $strBusqueda);
        $this->db->or_like("CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre)", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
		$this->db->order_by('V.modulo_id, E.apellido_paterno', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["vendedores"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($intModuloID, $strDescripcion)
	{
		$this->db->select(" V.vendedor_id, 
						    CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS vendedor, M.modulo_id,
						    M.descripcion AS modulo", FALSE);
        $this->db->from('vendedores AS V');
		$this->db->join('empleados AS E', 'V.empleado_id = E.empleado_id', 'inner');
		$this->db->join('modulos AS M', 'V.modulo_id = M.modulo_id', 'inner');
		$this->db->where('V.estatus', 'ACTIVO');
		//Si existe id del módulo
		if($intModuloID > 0)
		{
			$this->db->where('V.modulo_id', $intModuloID);
		}
        $this->db->where("((E.codigo LIKE '%$strDescripcion%') OR  
        				   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strDescripcion%') OR 
			               (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strDescripcion%') OR 
			               (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strDescripcion%'))"); 
		$this->db->order_by('E.apellido_paterno', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla prospectos_vendedores
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los prospectos del vendedor
	public function guardar_prospectos(stdClass $objVendedorProspecto)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		
		//Eliminar los prospectos guardados
		$this->db->where('vendedor_id', $objVendedorProspecto->intVendedorID);
		$this->db->delete('prospectos_vendedores');

		//Si existen prospectos
		if($objVendedorProspecto->strProspectoID != '')
		{
			//Quitar | de la lista para obtener el ID del prospecto
			$arrProspectoID = explode("|", $objVendedorProspecto->strProspectoID);

			//Hacer recorrido para insertar los datos en la tabla prospectos_vendedores
			for ($intCon = 0; $intCon < sizeof($arrProspectoID); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('vendedor_id' => $objVendedorProspecto->intVendedorID,
								  'prospecto_id' => $arrProspectoID[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('prospectos_vendedores', $arrDatos);
			}
		}

		//Actualizar datos de la tabla vendedores
		//Asignar datos al array
		$arrDatos = array('fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('vendedor_id', $objVendedorProspecto->intVendedorID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('vendedores', $arrDatos);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los prospectos de un registro
	public function buscar_prospectos($intVendedorID)
	{
		$this->db->select("PV.prospecto_id, 
						   CONCAT_WS(' - ', P.codigo, P.nombre_comercial) AS prospecto", FALSE);
		$this->db->from('prospectos_vendedores AS PV');
		$this->db->join('prospectos AS P', 'PV.prospecto_id = P.prospecto_id', 'inner');
		$this->db->where('PV.vendedor_id', $intVendedorID);
		return $this->db->get()->result();
	}
}
?>