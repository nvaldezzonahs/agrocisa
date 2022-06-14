<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipos_tipos_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla equipos_tipos
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objEquipoTipo)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla equipos_tipos
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objEquipoTipo->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objEquipoTipo->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('equipos_tipos', $arrDatos);

	    //Agregar id del nuevo registro al objeto
		$objEquipoTipo->intEquipoTipoID = $this->db->insert_id();

	    //Hacer un llamado al método para guardar los precios del tipo de equipo
		$this->guardar_detalles($objEquipoTipo);
		
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objEquipoTipo)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla equipos_tipos
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objEquipoTipo->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objEquipoTipo->intUsuarioID);
		$this->db->where('equipo_tipo_id', $objEquipoTipo->intEquipoTipoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('equipos_tipos', $arrDatos);

		//Eliminar los precios guardados
		$this->db->where('equipo_tipo_id', $objEquipoTipo->intEquipoTipoID);
		$this->db->delete('equipos_tipos_precios');

		//Hacer un llamado al método para guardar los precios del tipo de equipo
		$this->guardar_detalles($objEquipoTipo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intEquipoTipoID, $strEstatus)
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
		$this->db->where('equipo_tipo_id', $intEquipoTipoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('equipos_tipos', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intEquipoTipoID = NULL, $intServicioTipoID = NULL, $strDescripcion = NULL, 
						   $strBusqueda = NULL)
	{

		//Variable que se utiliza para agregar los campos de la tabla equipos_tipos_precios
		$strCampoPrecio = '';
		
		//Si existe id del tipo de servicio
		if($intServicioTipoID > 0)
		{
			$strCampoPrecio = ", IFNULL((SELECT ETP.precio 
							 		    FROM equipos_tipos_precios AS ETP
							 		    WHERE  ETP.equipo_tipo_id = ET.equipo_tipo_id
							 		    AND   ETP.servicio_tipo_id = $intServicioTipoID),0) AS precio";

		}


		$this->db->select("ET.equipo_tipo_id, ET.descripcion, ET.estatus $strCampoPrecio", FALSE);
		$this->db->from('equipos_tipos AS ET');
		//Si existe id del tipo de equipo
		if ($intEquipoTipoID !== NULL)
		{   
			$this->db->where('ET.equipo_tipo_id', $intEquipoTipoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strDescripcion !== NULL)//Si existe descripción
		{
			$this->db->where('ET.descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('ET.descripcion', $strBusqueda);
	        $this->db->or_like('ET.estatus', $strBusqueda);
			$this->db->order_by('ET.descripcion', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->from('equipos_tipos');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('equipo_tipo_id, descripcion, estatus');
		$this->db->from('equipos_tipos');
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["tipos_equipos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $intServicioTipoID)
	{
		$this->db->select(" ET.equipo_tipo_id, ET.descripcion, 
							IFNULL((SELECT ETP.precio 
							 		FROM equipos_tipos_precios AS ETP
							 		WHERE  ETP.equipo_tipo_id = ET.equipo_tipo_id
							 		AND   ETP.servicio_tipo_id = $intServicioTipoID),0) AS precio ", FALSE);
        $this->db->from('equipos_tipos AS ET');
	    $this->db->where('ET.estatus', 'ACTIVO');
        $this->db->where("(ET.descripcion LIKE '%$strDescripcion%')");  
        $this->db->order_by("ET.descripcion",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla equipos_tipos_precios
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los precios del tipo de equipo
	public function guardar_detalles(stdClass $objEquipoTipo)
	{
		//Si existen tipos de servicios
		if($objEquipoTipo->strServicioTipoID !== '')
		{
			//Quitar | de la lista para obtener el ID del tipo de servicio y el precio
			$arrServicioTipoID = explode("|", $objEquipoTipo->strServicioTipoID);
			$arrPrecios = explode("|", $objEquipoTipo->strPrecios);

			//Hacer recorrido para insertar los datos en la tabla equipos_tipos_precios
			for ($intCon = 0; $intCon < sizeof($arrServicioTipoID); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('equipo_tipo_id' => $objEquipoTipo->intEquipoTipoID,
								  'servicio_tipo_id' => $arrServicioTipoID[$intCon],
								  'precio' => $arrPrecios[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('equipos_tipos_precios', $arrDatos);
			}
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intEquipoTipoID)
	{
		$this->db->select('ETP.servicio_tipo_id, ETP.precio, ST.descripcion AS servicio_tipo');
		$this->db->from('equipos_tipos_precios AS ETP');
		$this->db->join('servicios_tipos AS ST', 'ETP.servicio_tipo_id = ST.servicio_tipo_id', 'inner');
		$this->db->where('ETP.equipo_tipo_id', $intEquipoTipoID);
		$this->db->order_by('ST.descripcion', 'ASC');
		return $this->db->get()->result();
	}
}
?>