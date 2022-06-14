<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encuestas_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla encuestas
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar($objEncuesta)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla encuestas
		//Asignar datos al array
		$arrDatos = array('descripcion' => mb_strtoupper($objEncuesta->strDescripcion), 
						  'modulo_id' => mb_strtoupper ($objEncuesta->intModuloID),
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('encuestas', $arrDatos);

		//Hacer un llamado al método para guardar las preguntas de la encuesta
		$this->guardar_preguntas($this->db->insert_id(), $objEncuesta->arrPreguntas);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar($intEncuestaID, $objEncuesta)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla encuestas
		//Asignar datos al array
		$arrDatos = array('descripcion' => mb_strtoupper($objEncuesta->strDescripcion), 
						  'modulo_id' => mb_strtoupper ($objEncuesta->intModuloID),
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('encuesta_id', $intEncuestaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('encuestas', $arrDatos);

			//Eliminar las respuestas para esta pregunta de la encuesta, para si es el caso, reemplazarlas
		$this->db->where('encuesta_id', $intEncuestaID);
		$this->db->delete('encuestas_respuestas');	
		//Eliminar las preguntas para esa encuesta para si es el caso, reemplazarlas
		$this->db->where('encuesta_id', $intEncuestaID);
		$this->db->delete('encuestas_preguntas');
	
		//Hacer un llamado al método para guardar las preguntas de la encuesta
		$this->guardar_preguntas($intEncuestaID, $objEncuesta->arrPreguntas);
		

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intEncuestaID, $strEstatus)
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
		$this->db->where('encuesta_id', $intEncuestaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('encuestas', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intEncuestaID = NULL, $strBusqueda = NULL)
	{
		//Si existe id de la encuesta
		if($intEncuestaID !== NULL){

			$this->db->select('E.encuesta_id, E.descripcion, E.modulo_id, E.estatus, 
							   M.descripcion AS modulo, EP.renglon AS renglonPregunta, EP.pregunta,
        					   ER.renglon AS renglonRespuesta, ER.respuesta');
			$this->db->from('encuestas AS E');
			$this->db->join('modulos AS M', 'E.modulo_id = M.modulo_id', 'inner');
			$this->db->join('encuestas_preguntas AS EP', 'EP.encuesta_id = E.encuesta_id', 'left');
			$this->db->join('encuestas_respuestas AS ER', 'EP.renglon = ER.renglon_pregunta AND ER.encuesta_id = E.encuesta_id', 'left');
			$this->db->where('E.encuesta_id', $intEncuestaID);
			$this->db->order_by('EP.renglon, ER.renglon');

		}
		else
		{
			$this->db->select('E.encuesta_id, E.descripcion, E.modulo_id, E.estatus,  M.descripcion AS modulo,
								(SELECT COUNT(renglon)
							     FROM encuestas_preguntas AS EP 
							     WHERE EP.encuesta_id = E.encuesta_id) AS total_preguntas', FALSE);
			$this->db->from('encuestas AS E');
			$this->db->join('modulos AS M', 'E.modulo_id = M.modulo_id', 'inner');
			$this->db->like('E.descripcion', $strBusqueda);
			$this->db->or_like('E.estatus', $strBusqueda); 
	        $this->db->or_like('M.descripcion', $strBusqueda);
			$this->db->order_by('E.descripcion', 'ASC');
		}
		
		return $this->db->get()->result();

	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('E.descripcion', $strBusqueda);
		$this->db->or_like('E.estatus', $strBusqueda); 
	    $this->db->or_like('M.descripcion', $strBusqueda);
		$this->db->from('encuestas AS E');
		$this->db->join('modulos AS M', 'E.modulo_id = M.modulo_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("E.encuesta_id, E.descripcion, E.estatus, M.descripcion AS modulo");
		$this->db->from('encuestas AS E');
		$this->db->join('modulos AS M', 'E.modulo_id = M.modulo_id', 'inner');
		$this->db->like('E.descripcion', $strBusqueda);
		$this->db->or_like('E.estatus', $strBusqueda); 
	    $this->db->or_like('M.descripcion', $strBusqueda);
		$this->db->order_by('E.descripcion', 'ASC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["encuestas"] = $this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strEstatus)
	{
		$this->db->select(" E.encuesta_id, CONCAT_WS(' ', E.descripcion, '-', M.descripcion) AS encuesta ", FALSE);
       $this->db->from('encuestas AS E');
		$this->db->join('modulos AS M', 'E.modulo_id = M.modulo_id', 'inner');
        //Si existe estatus
        if($strEstatus !== '')
        {
        	 $this->db->where('E.estatus', $strEstatus);
        }
        $this->db->where("(E.descripcion LIKE '%$strDescripcion%' OR
        				   M.descripcion LIKE '%$strDescripcion%')");   
		$this->db->order_by('E.descripcion', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla encuestas_preguntas
	*********************************************************************************************************************/
	//Función que se utiliza para guardar las preguntas de la encuesta
	public function guardar_preguntas($intEncuestaID, $arrPreguntas)
	{

		//Validar que al menos exista una pregunta en el arreglo
		if(sizeof($arrPreguntas) > 0){

			

			//Hacer recorrido para insertar los datos en la tabla encuestas_preguntas
			for ($intCon = 0; $intCon < sizeof($arrPreguntas); $intCon++) 
			{
				//Asignar datos al array
				$intRenglon = $intCon + 1;
				$arrDatos = array('encuesta_id' => $intEncuestaID,
								  'renglon' => $intRenglon,
								  'pregunta' => mb_strtoupper($arrPreguntas[$intCon][0])
								);
				//Guardar los datos del registro
				$this->db->insert('encuestas_preguntas', $arrDatos);

				//Hacer un llamado al metodo para guardar respuestas
				$this->guardar_respuestas($intEncuestaID, $intRenglon, $arrPreguntas[$intCon][1]);

			}

		}
	}

	//Método para regresar las preguntas de un registro
	public function buscar_preguntas($intEncuestaID)
	{
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('renglon, pregunta');
		$this->db->from('encuestas_preguntas');
		$this->db->where('encuesta_id', $intEncuestaID);
		$this->db->order_by('renglon');

		$arrResultado["preguntas"] = $this->db->get()->result();
		
		return $arrResultado;
	}

	/*******************************************************************************************************************
	Funciones de la tabla encuestas_respuestas
	*********************************************************************************************************************/
	//Función que se utiliza para guardar las respuestas de una pregunta de la encuesta
	public function guardar_respuestas($intEncuestaID, $intRenglonPregunta, $arrRespuestas)
	{
		//Validar que al menos exista una respuesta en el arreglo
		if(sizeof($arrRespuestas) > 0){

			//Hacer recorrido para insertar los datos en la tabla encuestas_preguntas
			for ($intCon = 0; $intCon < sizeof($arrRespuestas); $intCon++) 
			{
				//Asignar datos al array
				$intRenglon = $intCon + 1;
				$arrDatos = array('encuesta_id' => $intEncuestaID,
								  'renglon_pregunta' => $intRenglonPregunta,
								  'renglon' => $intRenglon,
								  'respuesta' => mb_strtoupper($arrRespuestas[$intCon])
								);
				//Guardar los datos del registro
				$this->db->insert('encuestas_respuestas', $arrDatos);
			}

		}
		
	}

}
?>