<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensajes_model extends CI_model {
	
	//Método para guardar los mensajes que se envían a los usuarios
	public function guardar($strProceso, $intReferenciaID, $strUsuarios, $strMensaje)
	{
		//Quitar | de la lista para obtener clave del usuario
        $arrUsuarios  = explode("|", $strUsuarios);
        //Hacer recorrido para insertar los datos en la tabla mensajes
        foreach ($arrUsuarios as $intUsuarioID) 
        {
        	//Asignar datos al array
        	$arrDatos = array('proceso' => $strProceso, 
        					  'referencia_id' => $intReferenciaID,
        					  'para' => $intUsuarioID,
        					  'mensaje' => $strMensaje,
        					  'fecha_creacion' => date("Y-m-d H:i:s"),
						  	  'usuario_creacion' => $this->session->userdata('usuario_id'));
        	//Guardar los datos del registro
			$this->db->insert('mensajes', $arrDatos);
        }
	}

	//Método para modificar el estatus de los registros que coincidan con el criterio de búsqueda proporcionado
	public function set_estatus($intReferenciaID = NULL, $strProceso = NULL) 
	{
		//Asignar datos al array
		$arrDatos = array('estatus' => 'VISTO',
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		//Si existe id de la referencia
		if($intReferenciaID !== NULL)
		{
			$this->db->where('referencia_id', $intReferenciaID);
			$this->db->where('proceso', $strProceso);
			$this->db->where('para', $this->session->userdata('usuario_id'));
		}
		else 
		{
			$this->db->where('estatus', 'NUEVO');
			$this->db->where('para', $this->session->userdata('usuario_id'));
		}
		//Actualizar los datos del registro
		return $this->db->update('mensajes', $arrDatos);
	}

	//Método para regresar el número de mensajes nuevos del usuario logeado en el sistema
	public function get_mensajes_nuevos()
	{
		$this->db->from('mensajes');
		$this->db->where('estatus', 'NUEVO');
		$this->db->where('para', $this->session->userdata('usuario_id'));
		$arrResultado["total_mensajes_nuevos"] = $this->db->count_all_results();
		return $arrResultado;
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intReferenciaID, $strProceso)
	{	
		//Asignar id del usuario logeado en el sistema
		$intUsuarioID = $this->session->userdata('usuario_id');
		 
        $this->db->select("M.mensaje_id, DATE_FORMAT(M.fecha_creacion, '%d/%m/%Y %r') AS fecha,
        				   M.mensaje, M.estatus,
        				   CASE 
							   WHEN  M.usuario_creacion =  $intUsuarioID THEN 'SI'
							   ELSE 'NO' 
						   END AS usuario_envio_mesaje,
						   UC.usuario AS usuario_creacion,
    					   CONCAT_WS(' ', EC.nombre, EC.apellido_paterno, EC.apellido_materno) AS empleado_creacion", FALSE);
        $this->db->from('mensajes AS M');
	    $this->db->join('usuarios AS UC', 'M.usuario_creacion = UC.usuario_id', 'inner');
	    $this->db->join('empleados AS EC', 'UC.empleado_id = EC.empleado_id', 'left');
	    $this->db->where('M.referencia_id', $intReferenciaID);
		$this->db->where('M.proceso', $strProceso);
		$this->db->where("(M.para = $intUsuarioID  OR M.usuario_creacion = $intUsuarioID)", NULL, FALSE);
		$this->db->order_by('M.fecha_creacion', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intNumRows, $intPos)
	{
		//Asignar id del usuario logeado en el sistema
		$intUsuarioID = $this->session->userdata('usuario_id');
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where("(M.para = $intUsuarioID  OR M.usuario_creacion = $intUsuarioID)", NULL, FALSE);
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(M.fecha_creacion, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    $this->db->where("(M.mensaje LIKE '%$strBusqueda%' OR
	  					   UC.usuario LIKE '%$strBusqueda%' OR
	  		         	   ((CONCAT_WS(' ', EC.apellido_paterno, EC.apellido_materno, EC.nombre) LIKE '%$strBusqueda%') OR
			                (CONCAT_WS(' ', EC.nombre, EC.apellido_paterno, EC.apellido_materno) LIKE '%$strBusqueda%') OR
			                (CONCAT_WS(' ', EC.apellido_paterno, EC.apellido_materno) LIKE '%$strBusqueda%') OR
			                (CONCAT_WS(' ', EC.nombre, EC.apellido_paterno) LIKE '%$strBusqueda%') OR 
			                (CONCAT_WS(' ', EC.apellido_paterno, EC.nombre) LIKE '%$strBusqueda%') OR
			                (CONCAT_WS(' ', EC.nombre, EC.apellido_materno) LIKE '%$strBusqueda%') OR 
			                (CONCAT_WS(' ', EC.apellido_materno, EC.nombre) LIKE '%$strBusqueda%')))"); 
	    $this->db->from('mensajes AS M');
	    $this->db->join('usuarios AS UC', 'M.usuario_creacion = UC.usuario_id', 'inner');
	    $this->db->join('empleados AS EC', 'UC.empleado_id = EC.empleado_id', 'left');
	    $arrResultado["total_rows"] = $this->db->count_all_results();

	    //Seleccionar los registros que coincidan con los criterios de búsqueda
	    $this->db->select("M.mensaje_id, DATE_FORMAT(M.fecha_creacion, '%d/%m/%Y %r') AS fecha, 
	    				   M.mensaje, M.referencia_id, M.proceso, M.estatus, UC.usuario AS usuario_creacion,
	    				   CONCAT_WS(' ', EC.nombre, EC.apellido_paterno, EC.apellido_materno) AS empleado_creacion", FALSE);
    	$this->db->from('mensajes AS M');
	    $this->db->join('usuarios AS UC', 'M.usuario_creacion = UC.usuario_id', 'inner');
	    $this->db->join('empleados AS EC', 'UC.empleado_id = EC.empleado_id', 'left');
		$this->db->where("(M.para = $intUsuarioID  OR M.usuario_creacion = $intUsuarioID)", NULL, FALSE);
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(M.fecha_creacion, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	  	 $this->db->where("(M.mensaje LIKE '%$strBusqueda%' OR
	  					    UC.usuario LIKE '%$strBusqueda%' OR
	  		         	   ((CONCAT_WS(' ', EC.apellido_paterno, EC.apellido_materno, EC.nombre) LIKE '%$strBusqueda%') OR
			                (CONCAT_WS(' ', EC.nombre, EC.apellido_paterno, EC.apellido_materno) LIKE '%$strBusqueda%') OR
			                (CONCAT_WS(' ', EC.apellido_paterno, EC.apellido_materno) LIKE '%$strBusqueda%') OR
			                (CONCAT_WS(' ', EC.nombre, EC.apellido_paterno) LIKE '%$strBusqueda%') OR 
			                (CONCAT_WS(' ', EC.apellido_paterno, EC.nombre) LIKE '%$strBusqueda%') OR
			                (CONCAT_WS(' ', EC.nombre, EC.apellido_materno) LIKE '%$strBusqueda%') OR 
			                (CONCAT_WS(' ', EC.apellido_materno, EC.nombre) LIKE '%$strBusqueda%')))"); 
	  	$this->db->order_by('M.fecha_creacion', 'DESC');
	  	$this->db->limit($intNumRows,$intPos);
        $arrResultado["mensajes"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>