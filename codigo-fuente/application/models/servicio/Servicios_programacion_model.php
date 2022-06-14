<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Servicios_programacion_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objServicioProgramacion)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

        /*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objServicioProgramacion->strFolio); 

		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objServicioProgramacion->intSucursalID, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objServicioProgramacion->dteFecha,
						  'tipo' => $objServicioProgramacion->strTipo, 
						  'ubicacion' => $objServicioProgramacion->strUbicacion, 
						  'prospecto_id' => $objServicioProgramacion->intProspectoID, 
						  'telefono' => $objServicioProgramacion->strTelefono, 
						  'mecanico_id' => $objServicioProgramacion->intMecanicoID, 
						  'actividad' => $objServicioProgramacion->strActividad, 
						  'observaciones' => $objServicioProgramacion->strObservaciones,
						  'orden_reparacion_id' => $objServicioProgramacion->intOrdenReparacionID, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objServicioProgramacion->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('servicios_programacion', $arrDatos);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objServicioProgramacion)
	{
		//Asignar datos al array
		$arrDatos = array('fecha' => $objServicioProgramacion->dteFecha,
						  'tipo' => $objServicioProgramacion->strTipo,
						  'ubicacion' => $objServicioProgramacion->strUbicacion, 
						  'prospecto_id' => $objServicioProgramacion->intProspectoID, 
						  'telefono' => $objServicioProgramacion->strTelefono, 
						  'mecanico_id' => $objServicioProgramacion->intMecanicoID, 
						  'actividad' => $objServicioProgramacion->strActividad, 
						  'observaciones' => $objServicioProgramacion->strObservaciones,
						  'orden_reparacion_id' => $objServicioProgramacion->intOrdenReparacionID,  
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objServicioProgramacion->intUsuarioID);
		$this->db->where('servicio_programacion_id', $objServicioProgramacion->intServicioProgramacionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('servicios_programacion', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intServicioProgramacionID, $strEstatus)
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
		$this->db->where('servicio_programacion_id', $intServicioProgramacionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('servicios_programacion', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intServicioProgramacionID = NULL, $strCriteriosBusq = NULL, $dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL, $intProspectoID = NULL, $intMecanicoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		$this->db->select("SP.servicio_programacion_id, SP.folio, 
						   DATE_FORMAT(SP.fecha,'%d/%m/%Y') AS fecha,
						   DATE_FORMAT(SP.fecha,'%h:%i %p') AS hora, 
 						  DATE_FORMAT(SP.fecha, '%d/%m/%Y %h:%i %p') AS fecha_rep,
						   SP.tipo, SP.ubicacion, 
						   SP.prospecto_id, SP.telefono, SP.mecanico_id, SP.actividad, 
						   SP.observaciones, SP.orden_reparacion_id, SP.estatus, 
						   C.razon_social AS cliente, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS mecanico, OR.folio AS folio_orden_reparacion", FALSE);
		$this->db->from('servicios_programacion AS SP');
		$this->db->join('clientes AS C', 'SP.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('mecanicos AS M', 'SP.mecanico_id = M.mecanico_id', 'inner');
		$this->db->join('empleados AS E', 'M.empleado_id = E.empleado_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'SP.orden_reparacion_id = OR.orden_reparacion_id', 'left');
		//Si existe id de la programación de servicio
		if ($intServicioProgramacionID !== NULL)
		{   
			$this->db->where('SP.servicio_programacion_id', $intServicioProgramacionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (fecha|mecanicoID) para obtener los criterios de búsqueda
            list($dteFecha, $intMecanicoID) = explode("|", $strCriteriosBusq); 
			$this->db->where("DATE_FORMAT(SP.fecha,'%Y-%m-%d %H:%i:%s') = '$dteFecha'", NULL, FALSE);
			$this->db->where('SP.mecanico_id', $intMecanicoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			//Si existe id del cliente
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('SP.prospecto_id', $intProspectoID);
		    }
		    //Si existe id del mecánico
		    if($intMecanicoID > 0)
		    {
		   		$this->db->where('SP.mecanico_id', $intMecanicoID);
		    }
		    //Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(SP.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }
		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('SP.estatus', $strEstatus);
			}

			$this->db->where("((SP.folio LIKE '%$strBusqueda%') OR
							   (C.razon_social LIKE '%$strBusqueda%') OR
							   (OR.folio LIKE '%$strBusqueda%') OR
	        				   (CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
			        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
						       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
						       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))");

			$this->db->order_by('SP.fecha DESC, SP.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL, 
						   $intMecanicoID = NULL,$strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe id del cliente
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('SP.prospecto_id', $intProspectoID);
	    }
	    //Si existe id del mecánico
	    if($intMecanicoID != NULL)
	    {
	   		$this->db->where('SP.mecanico_id', $intMecanicoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(SP.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('SP.estatus', $strEstatus);
		}

		$this->db->where("((SP.folio LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%') OR
						   (OR.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
		        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))");
		$this->db->from('servicios_programacion AS SP');
		$this->db->join('clientes AS C', 'SP.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('mecanicos AS M', 'SP.mecanico_id = M.mecanico_id', 'inner');
		$this->db->join('empleados AS E', 'M.empleado_id = E.empleado_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'SP.orden_reparacion_id = OR.orden_reparacion_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("SP.servicio_programacion_id, SP.folio, SP.tipo, SP.estatus, 
						   DATE_FORMAT(SP.fecha, '%d/%m/%Y %h:%i %p') AS fecha,
						   C.razon_social AS cliente, OR.folio AS folio_orden_reparacion,
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS mecanico", FALSE);
		$this->db->from('servicios_programacion AS SP');
		$this->db->join('clientes AS C', 'SP.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('mecanicos AS M', 'SP.mecanico_id = M.mecanico_id', 'inner');
		$this->db->join('empleados AS E', 'M.empleado_id = E.empleado_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'SP.orden_reparacion_id = OR.orden_reparacion_id', 'left');
		//Si existe id del cliente
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('SP.prospecto_id', $intProspectoID);
	    }
	    //Si existe id del mecánico
	    if($intMecanicoID != NULL)
	    {
	   		$this->db->where('SP.mecanico_id', $intMecanicoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(SP.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('SP.estatus', $strEstatus);
		}
		
		$this->db->where("((SP.folio LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%') OR
						   (OR.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
		        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))");
		$this->db->order_by('SP.fecha DESC, SP.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["programacion"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>