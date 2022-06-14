<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados_incidencias_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objIncidencia)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Asignar datos al array
		$arrDatos = array('empleado_id' => $objIncidencia->intEmpleadoID, 
						  'fecha' => $objIncidencia->dteFecha, 
						  'comentario' => $objIncidencia->strComentario, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objIncidencia->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('empleados_incidencias', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objIncidencia->intIncidenciaID = $this->db->insert_id();

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objIncidencia->intIncidenciaID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objIncidencia)
	{
		//Asignar datos al array
		$arrDatos = array('empleado_id' => $objIncidencia->intEmpleadoID, 
						  'fecha' => $objIncidencia->dteFecha, 
						  'comentario' => $objIncidencia->strComentario,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objIncidencia->intUsuarioID);
		$this->db->where('incidencia_id', $objIncidencia->intIncidenciaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('empleados_incidencias', $arrDatos);
	}

	
    //Método para modificar el estatus de un registro
	public function set_estatus($intIncidenciaID, $strEstatus)
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
		$this->db->where('incidencia_id', $intIncidenciaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('empleados_incidencias', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intIncidenciaID = NULL, $strCriteriosBusq = NULL, $dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL, $intEmpleadoID = NULL, $strEstatus = NULL, 
						   $strBusqueda =  NULL)
	{
		$this->db->select("EI.incidencia_id, EI.empleado_id, DATE_FORMAT(EI.fecha,'%d/%m/%Y') AS fecha, 
						   EI.comentario, EI.estatus, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado", FALSE);
	    $this->db->from('empleados_incidencias AS EI');
		$this->db->join('empleados AS E', 'EI.empleado_id = E.empleado_id', 'inner');
		//Si existe id de la incidencia
		if ($intIncidenciaID !==  NULL)
		{   
			$this->db->where('EI.incidencia_id', $intIncidenciaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !==  NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (fecha|empleado_id) para obtener los criterios de búsqueda
            list($dteFecha, $intEmpleadoID) = explode("|", $strCriteriosBusq); 
			$this->db->where('EI.empleado_id', $intEmpleadoID);
			$this->db->where('EI.fecha', $dteFecha);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			//Si existe id del empleado
		    if($intEmpleadoID > 0)
		    {
		   		$this->db->where('EI.empleado_id', $intEmpleadoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(EI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus !== 'TODOS')
			{
				$this->db->where('EI.estatus', $strEstatus);
			}

		    $this->db->where("((CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) 
		    					LIKE '%$strBusqueda%') OR
			        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
						       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
						       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))");
	    
			$this->db->order_by('EI.fecha DESC, E.apellido_paterno');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intEmpleadoID = NULL,
		                   $strEstatus = NULL, $strBusqueda =  NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe id del empleado
	    if($intEmpleadoID > 0)
	    {
	   		$this->db->where('EI.empleado_id', $intEmpleadoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(EI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus !== 'TODOS')
		{
			$this->db->where('EI.estatus', $strEstatus);
		}

	    $this->db->where("((CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) 
	    					LIKE '%$strBusqueda%') OR
		        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))"); 

		$this->db->from('empleados_incidencias AS EI');
		$this->db->join('empleados AS E', 'EI.empleado_id = E.empleado_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("EI.incidencia_id, EI.empleado_id, DATE_FORMAT(EI.fecha,'%d/%m/%Y') AS fecha,
						   EI.comentario, EI.estatus, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado", FALSE);
		$this->db->from('empleados_incidencias AS EI');
		$this->db->join('empleados AS E', 'EI.empleado_id = E.empleado_id', 'inner');
		//Si existe id del empleado
	    if($intEmpleadoID > 0)
	    {
	   		$this->db->where('EI.empleado_id', $intEmpleadoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(EI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    
	    //Si existe estatus
		if($strEstatus !== 'TODOS')
		{
			$this->db->where('EI.estatus', $strEstatus);
		}

	    $this->db->where("((CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) 
	    					LIKE '%$strBusqueda%') OR
		        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('EI.fecha DESC, E.apellido_paterno');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["incidencias"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>