<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Choferes_actividades_registro_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objActividad)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objActividad->strFolio); 

		//Tabla choferes_actividades_registro
		//Asignar datos al array
		$arrDatos = array('folio' => $strFolioConsecutivo, 
						  'fecha' => $objActividad->dteFecha, 
						  'chofer_id' => $objActividad->intChoferID,
						  'sucursal_id' => $objActividad->intSucursalID, 
						  'departamento_id' => $objActividad->intDepartamentoID, 
						  'prospecto_id' => $objActividad->intProspectoID,
						  'chofer_actividad_id' => $objActividad->intChoferActividadID,
						  'comision' => $objActividad->intComision,
						  'equipo' => $objActividad->strEquipo,
						  'serie' => $objActividad->strSerie,
						  'comentario' => $objActividad->strComentario,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objActividad->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('choferes_actividades_registro', $arrDatos);

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
	public function modificar(stdClass $objActividad)
	{
		//Asignar datos al array
		$arrDatos = array('fecha' => $objActividad->dteFecha, 
						  'chofer_id' => $objActividad->intChoferID,
						  'sucursal_id' => $objActividad->intSucursalID, 
						  'departamento_id' => $objActividad->intDepartamentoID,  
						  'prospecto_id' => $objActividad->intProspectoID,
						  'chofer_actividad_id' => $objActividad->intChoferActividadID,
						  'comision' => $objActividad->intComision,
						  'equipo' => $objActividad->strEquipo,
						  'serie' => $objActividad->strSerie,
						  'comentario' => $objActividad->strComentario,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objActividad->intUsuarioID);
		$this->db->where('chofer_actividad_registro_id', $objActividad->intChoferActividadRegistroID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('choferes_actividades_registro', $arrDatos);
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intChoferActividadRegistroID, $strEstatus)
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
		$this->db->where('chofer_actividad_registro_id', $intChoferActividadRegistroID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('choferes_actividades_registro', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intChoferActividadRegistroID = NULL, $dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL, $intChoferID = NULL,  $strEstatus = NULL, $strBusqueda = NULL)
	{
		$this->db->select("CAR.chofer_actividad_registro_id, CAR.folio, 
						   DATE_FORMAT(CAR.fecha,'%d/%m/%Y') AS fecha, CAR.chofer_id, CAR.sucursal_id, 
						   CAR.departamento_id, CAR.prospecto_id, CAR.chofer_actividad_id, CAR.comision, 
						   CAR.equipo, CAR.serie, CAR.comentario, CAR.estatus, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS chofer,
						   CA.descripcion AS chofer_actividad, CT.razon_social AS cliente,
						   S.nombre AS sucursal, D.descripcion AS departamento", FALSE);
		$this->db->from('choferes_actividades_registro AS CAR');
		$this->db->join('choferes_actividades AS CA', 'CAR.chofer_actividad_id = CA.chofer_actividad_id', 'inner');
		$this->db->join('choferes AS C', 'CAR.chofer_id = C.chofer_id', 'inner');
		$this->db->join('empleados AS E', 'C.empleado_id = E.empleado_id', 'inner');
		$this->db->join('clientes AS CT', 'CAR.prospecto_id = CT.prospecto_id', 'left');
		$this->db->join('sucursales AS S', 'CAR.sucursal_id = S.sucursal_id', 'left');
		$this->db->join('departamentos AS D', 'CAR.departamento_id = D.departamento_id', 'left');

		
		//Si existe id del registro de actividad
		if ($intChoferActividadRegistroID !== NULL)
		{   
			$this->db->where('CAR.chofer_actividad_registro_id', $intChoferActividadRegistroID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			//Si existe id del chofer
		    if($intChoferID > 0)
		    {
		   		$this->db->where('CAR.chofer_id', $intChoferID);
		    }

		    //Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {		   				   		
		   		$this->db->where("CAR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('CAR.estatus', $strEstatus);
			}

			$this->db->where("((CAR.folio LIKE '%$strBusqueda%') OR
							    (CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
			        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
						       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
						       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
					            (CT.razon_social LIKE '%$strBusqueda%'))"); 
			
			$this->db->order_by('CAR.fecha DESC, CAR.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intChoferID = NULL,  $strEstatus = NULL, $strBusqueda = NULL,$intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe id del chofer
	    if($intChoferID != NULL)
	    {
	   		$this->db->where('CAR.chofer_id', $intChoferID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   	
	   		$this->db->where("CAR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);

	    } 
	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('CAR.estatus', $strEstatus);
		}

		$this->db->where("((CAR.folio LIKE '%$strBusqueda%') OR
						    (CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
		        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
				            (CT.razon_social LIKE '%$strBusqueda%'))"); 

		$this->db->from('choferes_actividades_registro AS CAR');
		$this->db->join('choferes_actividades AS CA', 'CAR.chofer_actividad_id = CA.chofer_actividad_id', 'inner');
		$this->db->join('choferes AS C', 'CAR.chofer_id = C.chofer_id', 'inner');
		$this->db->join('empleados AS E', 'C.empleado_id = E.empleado_id', 'inner');
		$this->db->join('clientes AS CT', 'CAR.prospecto_id = CT.prospecto_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CAR.chofer_actividad_registro_id, CAR.folio, DATE_FORMAT(CAR.fecha,'%d/%m/%Y') AS fecha,
				           CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS chofer,
				           CT.razon_social AS cliente, CAR.estatus", FALSE);
		$this->db->from('choferes_actividades_registro AS CAR');
		$this->db->join('choferes_actividades AS CA', 'CAR.chofer_actividad_id = CA.chofer_actividad_id', 'inner');
		$this->db->join('choferes AS C', 'CAR.chofer_id = C.chofer_id', 'inner');
		$this->db->join('empleados AS E', 'C.empleado_id = E.empleado_id', 'inner');
		$this->db->join('clientes AS CT', 'CAR.prospecto_id = CT.prospecto_id', 'left');
		//Si existe id del chofer
	    if($intChoferID != NULL)
	    {
	   		$this->db->where('CAR.chofer_id', $intChoferID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {

	   		$this->db->where("CAR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('CAR.estatus', $strEstatus);
		}

		$this->db->where("((CAR.folio LIKE '%$strBusqueda%') OR
						    (CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
		        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
				            (CT.razon_social LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('CAR.fecha DESC, CAR.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["actividades"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>