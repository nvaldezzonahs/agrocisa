<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios_internos_programacion_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar($dteFecha, $intVehiculoID, $intMecanicoID, $strActividad, $strObservaciones)
	{
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha,
						  'vehiculo_id' => $intVehiculoID, 
						  'mecanico_id' => $intMecanicoID, 
						  'actividad' => $strActividad, 
						  'observaciones' => $strObservaciones, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		return $this->db->insert('servicios_internos_programacion', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar($intServicioInternoProgramacionID, $dteFecha, $intVehiculoID,
							  $intMecanicoID, $strActividad, $strObservaciones)
	{
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha,
						  'vehiculo_id' => $intVehiculoID, 
						  'mecanico_id' => $intMecanicoID, 
						  'actividad' => $strActividad, 
						  'observaciones' => $strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('servicio_interno_programacion_id', $intServicioInternoProgramacionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('servicios_internos_programacion', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intServicioInternoProgramacionID, $strEstatus)
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
		$this->db->where('servicio_interno_programacion_id', $intServicioInternoProgramacionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('servicios_internos_programacion', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intServicioInternoProgramacionID = NULL, $strCriteriosBusq = NULL, $dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL, $intVehiculoID = NULL, $intMecanicoID = NULL)
	{
		$this->db->select("SP.servicio_interno_programacion_id, DATE_FORMAT(SP.fecha,'%d/%m/%Y') AS fecha,
						   DATE_FORMAT(SP.fecha,'%h:%i %p') AS hora, SP.vehiculo_id,
						   SP.mecanico_id, SP.actividad, SP.observaciones, SP.estatus, 
						   CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas) AS vehiculo,
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS mecanico", FALSE);
		$this->db->from('servicios_internos_programacion AS SP');
		$this->db->join('vehiculos AS V', 'SP.vehiculo_id = V.vehiculo_id', 'inner');
		$this->db->join('mecanicos AS M', 'SP.mecanico_id = M.mecanico_id', 'inner');
		$this->db->join('empleados AS E', 'M.empleado_id = E.empleado_id', 'inner');
		//Si existe id de la programación de servicio
		if ($intServicioInternoProgramacionID !== NULL)
		{   
			$this->db->where('SP.servicio_interno_programacion_id', $intServicioInternoProgramacionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (fecha|mecanicoID) para obtener los criterios de búsqueda
            list($dteFecha, $intMecanicoID) = explode("|", $strCriteriosBusq); 
			$this->db->where("DATE_FORMAT(SP.fecha,'%Y-%m-%d %H:%i') = '$dteFecha'", NULL, FALSE);
			$this->db->where('SP.mecanico_id', $intMecanicoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			//Si existe id del vehículo
		    if($intVehiculoID > 0)
		    {
		   		$this->db->where('SP.vehiculo_id', $intVehiculoID);
		    }
		    //Si existe id del mecánico
		    if($intMecanicoID > 0)
		    {
		   		$this->db->where('SP.mecanico_id', $intMecanicoID);
		    }
		    //Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("(DATE_FORMAT(SP.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 
			$this->db->order_by('SP.fecha', 'DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intVehiculoID = NULL, 
						   $intMecanicoID = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe id del vehículo
	    if($intVehiculoID != NULL)
	    {
	   		$this->db->where('SP.vehiculo_id', $intVehiculoID);
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
		$this->db->from('servicios_internos_programacion AS SP');
		$this->db->join('vehiculos AS V', 'SP.vehiculo_id = V.vehiculo_id', 'inner');
		$this->db->join('mecanicos AS M', 'SP.mecanico_id = M.mecanico_id', 'inner');
		$this->db->join('empleados AS E', 'M.empleado_id = E.empleado_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("SP.servicio_interno_programacion_id, SP.estatus, 
						   DATE_FORMAT(SP.fecha,'%d/%m/%Y') AS fecha,
						   DATE_FORMAT(SP.fecha,'%h:%i %p') AS hora,
						   CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas) AS vehiculo,
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS mecanico", FALSE);
		$this->db->from('servicios_internos_programacion AS SP');
		$this->db->join('vehiculos AS V', 'SP.vehiculo_id = V.vehiculo_id', 'inner');
		$this->db->join('mecanicos AS M', 'SP.mecanico_id = M.mecanico_id', 'inner');
		$this->db->join('empleados AS E', 'M.empleado_id = E.empleado_id', 'inner');
		//Si existe id del vehículo
	    if($intVehiculoID != NULL)
	    {
	   		$this->db->where('SP.vehiculo_id', $intVehiculoID);
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
		$this->db->order_by('SP.fecha', 'DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["programacion"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>