<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procesos_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objProceso)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Variable que se utiliza para asignar el id del nuevo registro
		$intProcesoID = 0;
		//Asignar datos al array
		$arrDatos = array('proceso_padre_id' => $objProceso->intProcesoPadreID,
						  'menu_nivel' => $objProceso->strMenuNivel,
				          'descripcion' => $objProceso->strDescripcion,
				          'orden' => $objProceso->intOrden,
				          'ruta_acceso' => $objProceso->strRutaAcceso,
				          'tipo_ventana' => $objProceso->strTipoVentana,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
				          'usuario_creacion' => $objProceso->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('procesos', $arrDatos);

		//Asignar id del nuevo registro en la base de datos
		$intProcesoID = $this->db->insert_id();

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intProcesoID;
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objProceso)
	{
		//Asignar datos al array
		$arrDatos = array('proceso_padre_id' => $objProceso->intProcesoPadreID,
						  'menu_nivel' => $objProceso->strMenuNivel,
				          'descripcion' => $objProceso->strDescripcion,
				          'orden' => $objProceso->intOrden,
				          'ruta_acceso' => $objProceso->strRutaAcceso,
				          'tipo_ventana' => $objProceso->strTipoVentana,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
				          'usuario_actualizacion' => $objProceso->intUsuarioID);
		$this->db->where('proceso_id', $objProceso->intProcesoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('procesos', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intProcesoID, $strEstatus)
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
	    $this->db->where('proceso_id', $intProcesoID);
	    $this->db->limit(1);
	    //Actualizar los datos del registro
	    return $this->db->update('procesos', $arrDatos);
	}

	//Método para agregar un subproceso al proceso seleccionado
	public function set_subproceso($intProcesoID, $strFuncion)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Eliminar subproceso de la tabla subprocesos
		$this->db->where('funcion', $strFuncion);
		$this->db->where('proceso_id', $intProcesoID);
		$this->db->delete('subprocesos');

		//Asignar datos al array
		$arrDatos = array('proceso_id' => $intProcesoID, 
						  'funcion' => $strFuncion);
		//Guardar los datos del registro
		$this->db->insert('subprocesos', $arrDatos);
		
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para eliminar los datos de un subproceso
	public function eliminar_subproceso($intSubprocesoID)
	{
		//Eliminar subproceso de la tabla subprocesos
		$this->db->where('subproceso_id', $intSubprocesoID);
		$this->db->limit(1);
		return $this->db->delete('subprocesos');
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intProcesoID = NULL, $intProcesoPadreID = NULL, $strBusqueda = NULL)
	{
		//Si existe id del proceso
		if ($intProcesoID !== NULL)
		{
			$this->db->select('P.menu_nivel, P.descripcion, P.orden, P.ruta_acceso, P.tipo_ventana, P.estatus, 
							   PPN1.proceso_id AS proceso_padre_nivel1, PPN1.descripcion AS PPN1, 
							   PPN2.proceso_id AS proceso_padre_nivel2, PPN2.descripcion AS PPN2, 
							   PPN3.proceso_id AS proceso_padre_nivel3, PPN3.descripcion AS PPN3');
			$this->db->from('procesos AS P');
			$this->db->join('procesos AS PPN1', 'P.proceso_padre_id = PPN1.proceso_id', 'left');
			$this->db->join('procesos AS PPN2', 'PPN1.proceso_padre_id = PPN2.proceso_id', 'left');
			$this->db->join('procesos AS PPN3', 'PPN2.proceso_padre_id = PPN3.proceso_id', 'left');
			$this->db->where('P.proceso_id', $intProcesoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($intProcesoPadreID !== NULL)//Si existe id del proceso padre
		{	

			$this->db->select('proceso_id AS value, descripcion AS nombre');
			$this->db->from('procesos');
			$this->db->where('estatus', 'ACTIVO');
			$this->db->where('proceso_padre_id', ($intProcesoPadreID == 0 ? NULL: $intProcesoPadreID));
			$this->db->order_by('orden', 'ASC');
			return $this->db->get()->result();
		}
		else
		{  
			$this->db->select("P.descripcion AS proceso, P.menu_nivel, P.orden, P.ruta_acceso,
							   P.tipo_ventana, P.estatus, 
							   CASE P.menu_nivel 
							   		WHEN 'NIVEL 1' THEN '' 
									WHEN 'NIVEL 2' THEN PPN1.descripcion
									WHEN 'NIVEL 3' THEN CONCAT(PPN2.descripcion, '/', PPN1.descripcion)
									WHEN 'NIVEL 4' THEN CONCAT(PPN3.descripcion, '/', PPN2.descripcion, '/', PPN1.descripcion)
							   END AS proceso_padre", FALSE);
			$this->db->from('procesos AS P');
			$this->db->join('procesos AS PPN1', 'P.proceso_padre_id = PPN1.proceso_id', 'left');
			$this->db->join('procesos AS PPN2', 'PPN1.proceso_padre_id = PPN2.proceso_id', 'left');
			$this->db->join('procesos AS PPN3', 'PPN2.proceso_padre_id = PPN3.proceso_id', 'left');
			$this->db->like('P.descripcion', $strBusqueda);
		    $this->db->or_like('P.estatus', $strBusqueda);
		    $this->db->or_like('P.menu_nivel', $strBusqueda);
		    $this->db->or_like('P.tipo_ventana', $strBusqueda);
		    $this->db->or_like('PPN1.descripcion', $strBusqueda);
		    $this->db->or_like('PPN2.descripcion', $strBusqueda);
		    $this->db->or_like('PPN3.descripcion', $strBusqueda);
		    $this->db->or_like("CONCAT(PPN2.descripcion, '/', PPN1.descripcion)", $strBusqueda);
		    $this->db->or_like("CONCAT(PPN3.descripcion, '/', PPN2.descripcion, '/', PPN1.descripcion)", $strBusqueda);
			$this->db->order_by('PPN3.orden, PPN2.orden, PPN1.orden, P.orden', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('P.descripcion', $strBusqueda);
	    $this->db->or_like('P.estatus', $strBusqueda);
	    $this->db->or_like('P.menu_nivel', $strBusqueda);
	    $this->db->or_like('P.tipo_ventana', $strBusqueda);
	    $this->db->or_like('PPN1.descripcion', $strBusqueda);
	    $this->db->or_like('PPN2.descripcion', $strBusqueda);
	    $this->db->or_like('PPN3.descripcion', $strBusqueda);
	    $this->db->or_like("CONCAT(PPN2.descripcion, '/', PPN1.descripcion)", $strBusqueda);
		$this->db->or_like("CONCAT(PPN3.descripcion, '/', PPN2.descripcion, '/', PPN1.descripcion)", $strBusqueda);
		$this->db->from('procesos AS P');
		$this->db->join('procesos AS PPN1', 'P.proceso_padre_id = PPN1.proceso_id', 'left');
		$this->db->join('procesos AS PPN2', 'PPN1.proceso_padre_id = PPN2.proceso_id', 'left');
		$this->db->join('procesos AS PPN3', 'PPN2.proceso_padre_id = PPN3.proceso_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("P.proceso_id, P.descripcion AS proceso, P.menu_nivel, P.estatus, 
						   CASE P.menu_nivel 
								WHEN 'NIVEL 1' THEN '' 
								WHEN 'NIVEL 2' THEN PPN1.descripcion 
								WHEN 'NIVEL 3' THEN CONCAT(PPN2.descripcion,'/',PPN1.descripcion) 
								WHEN 'NIVEL 4' THEN CONCAT(PPN3.descripcion,'/',PPN2.descripcion,'/',PPN1.descripcion) 
						   END AS proceso_padre, 
						   P.orden, IFNULL(PPN2.proceso_id, 0) AS proceso_padre_nivel2", FALSE);
		$this->db->from('procesos AS P');
		$this->db->join('procesos AS PPN1', 'P.proceso_padre_id = PPN1.proceso_id', 'left');
		$this->db->join('procesos AS PPN2', 'PPN1.proceso_padre_id = PPN2.proceso_id', 'left');
		$this->db->join('procesos AS PPN3', 'PPN2.proceso_padre_id = PPN3.proceso_id', 'left');
		$this->db->like('P.descripcion', $strBusqueda);
	    $this->db->or_like('P.estatus', $strBusqueda);
	    $this->db->or_like('P.menu_nivel', $strBusqueda);
	    $this->db->or_like('P.tipo_ventana', $strBusqueda);
	    $this->db->or_like('PPN1.descripcion', $strBusqueda);
	    $this->db->or_like('PPN2.descripcion', $strBusqueda);
	    $this->db->or_like('PPN3.descripcion', $strBusqueda);

	       $this->db->or_like("CONCAT(PPN2.descripcion, '/', PPN1.descripcion)", $strBusqueda);
		     $this->db->or_like("CONCAT(PPN3.descripcion, '/', PPN2.descripcion, '/', PPN1.descripcion)", $strBusqueda);



		$this->db->order_by('PPN3.orden, PPN2.orden, PPN1.orden, P.orden', 'ASC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["procesos"] = $this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los hijos de un proceso
	public function get_procesos_hijos($intProcesoID)
	{
		$this->db->select("P.proceso_id, P.proceso_padre_id, P.descripcion, 
						   P.ruta_acceso, P.tipo_ventana, P.menu_nivel, 
						   (SELECT COUNT(PH.proceso_padre_id)
							FROM   procesos AS PH
							WHERE  PH.proceso_padre_id = P.proceso_id
							AND    PH.estatus = 'ACTIVO') AS hijos");
		$this->db->from('procesos AS P');
		/*Si existe id del proceso, significa que el proceso padre no corresponde a un proceso principal 
		 (por ejemplo: Caja, Maquinaria, Seguridad, etc.) */
		if($intProcesoID > 0)
		{
			$this->db->where('P.proceso_padre_id', $intProcesoID);
		}
		else
		{
			$this->db->where('P.proceso_padre_id IS NULL'); 
		}
		$this->db->where('P.estatus', 'ACTIVO');
		$this->db->order_by('P.orden');
		return $this->db->get()->result();
	}

	//Método para obtener los subprocesos de un proceso
	public function get_subprocesos($intProcesoID = NULL)
	{
		//Seleccionar los subprocesos del proceso enviado como parámetro
		$this->db->select('subproceso_id, funcion');
		$this->db->from('subprocesos');
		$this->db->where('proceso_id', $intProcesoID);
		return $this->db->get()->result();
	}
}
?>