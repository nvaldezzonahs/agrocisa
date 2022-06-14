<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios_internos_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objServicio)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objServicio->strCodigo, 
						  'descripcion' => $objServicio->strDescripcion, 
						  'horas' => $objServicio->intHoras, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objServicio->intUsuarioID);
		
		//Guardar los datos del registro
		$this->db->insert('servicios_internos', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objServicio->intServicioInternoID = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles del servicio
		$this->guardar_detalles($objServicio);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objServicio)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objServicio->strCodigo, 
						  'descripcion' => $objServicio->strDescripcion, 
						  'horas' => $objServicio->intHoras, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objServicio->intUsuarioID);
		$this->db->where('servicio_interno_id', $objServicio->intServicioInternoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('servicios_internos', $arrDatos);


		//Eliminar los detalles guardados
		$this->db->where('servicio_interno_id', $objServicio->intServicioInternoID);
		$this->db->delete('servicios_internos_detalles');

		//Hacer un llamado al método para guardar los detalles del servicio
		$this->guardar_detalles($objServicio);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intServicioInternoID, $strEstatus)
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
		$this->db->where('servicio_interno_id', $intServicioInternoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('servicios_internos', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intServicioInternoID = NULL, $strCodigo = NULL, $strBusqueda = NULL, $strEstatus = NULL)
	{
		$this->db->select("	S.servicio_interno_id,
							S.codigo,
							S.descripcion,
							S.horas,
							S.estatus", FALSE);
		$this->db->from('servicios_internos AS S');
		//Si existe id del servicio
		if ($intServicioInternoID !== NULL)
		{   
			$this->db->where('S.servicio_interno_id', $intServicioInternoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigo !== NULL)//Si existe código
		{
			$this->db->where('S.codigo', $strCodigo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			//Si existe estatus 
			if($strEstatus !== NULL)
			{
				$this->db->where('S.estatus', $strEstatus);
			}
			$this->db->where("(S.codigo LIKE '%$strBusqueda%' OR  
        				       S.descripcion LIKE '%$strBusqueda%' OR
        				       S.estatus LIKE '%$strBusqueda%')");
			$this->db->order_by('S.codigo', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los datos de un precio correspondiente a un servicio-equipo
	public function buscar_servicio_equipo_precio($intServicioTipoID = NULL, $intEquipoTipoID = NULL)
	{
		
		$this->db->select('precio');
		$this->db->from('equipos_tipos_precios');
		$this->db->where('servicio_tipo_id', $intServicioTipoID);
		$this->db->where('equipo_tipo_id', $intEquipoTipoID);
		
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $strEstatus = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe estatus 
		if($strEstatus !== NULL)
		{
			$this->db->where('estatus', $strEstatus);
		}
		$this->db->where("(codigo LIKE '%$strBusqueda%' OR  
        				   descripcion LIKE '%$strBusqueda%' OR
        				   estatus LIKE '%$strBusqueda%')");
		$this->db->from('servicios_internos');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('servicio_interno_id, codigo, descripcion, estatus');
		$this->db->from('servicios_internos');
		//Si existe estatus 
		if($strEstatus !== NULL)
		{
			$this->db->where('estatus', $strEstatus);
		}
		$this->db->where("(codigo LIKE '%$strBusqueda%' OR  
        				   descripcion LIKE '%$strBusqueda%' OR
        				   estatus LIKE '%$strBusqueda%')");
		$this->db->order_by('codigo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["servicios"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" servicio_interno_id,
						    CONCAT_WS(' - ', codigo, descripcion) AS servicio ", FALSE);
        $this->db->from('servicios_internos');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(codigo LIKE '%$strDescripcion%' OR
        				   descripcion LIKE '%$strDescripcion%')");  
        $this->db->order_by("codigo",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	//Función que se utiliza para guardar los detalles del Servicio Interno
	public function guardar_detalles(stdClass $objServicio)
	{
		//Si existen detalles del servicio
		if($objServicio->strRefaccionesID != '')
		{
			/*Quitar | de la lista para obtener la refaccionID, cantidad*/
			$arrRefaccionesID = explode("|", $objServicio->strRefaccionesID);
			$arrCantidades = explode("|", $objServicio->strCantidades);

			//Hacer recorrido para insertar los datos en la tabla servicios_internos_detalles
			for ($intCon = 0; $intCon < sizeof($arrRefaccionesID); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('servicio_interno_id' => $objServicio->intServicioInternoID,
								  'renglon' => ($intCon + 1),
								  'refaccion_id' => $arrRefaccionesID[$intCon], 
								  'cantidad' => $arrCantidades[$intCon]);
				
				//Guardar los datos del registro
				$this->db->insert('servicios_internos_detalles', $arrDatos);
			}

		}
		
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intServicioInternoID)
	{
		$this->db->select('SID.servicio_interno_id, SID.renglon,
						   SID.refaccion_id, SID.cantidad,
						   CONCAT_WS(" - ", R.codigo_01, R.descripcion) AS refaccion');
		$this->db->from('servicios_internos_detalles SID');
		$this->db->join('refacciones R', 'R.refaccion_id = SID.refaccion_id', 'inner');
		$this->db->where('SID.servicio_interno_id', $intServicioInternoID);
		$this->db->order_by('SID.renglon', 'ASC');
		return $this->db->get()->result();
	}

}
?>