<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');


class Encuestas_prospectos_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla encuestas_prospectos
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar($strFolio, $objEncuestaProspecto)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $strFolio); 

		//Asignar datos al array
		$arrDatos = array('folio' => $strFolioConsecutivo, 
						  'fecha' => $objEncuestaProspecto->strFecha,
						  'encuesta_id' => $objEncuestaProspecto->intEncuestaID,
						  'prospecto_id' => $objEncuestaProspecto->intProspectoID,
						  'vendedor_id' => $objEncuestaProspecto->intVendedorID,
						  'observaciones' => mb_strtoupper($objEncuestaProspecto->strObservaciones),
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('encuestas_prospectos', $arrDatos);

		//Hacer un llamado al método para guardar las respuestas para cada pregunta de la encuesta
		$this->guardar_respuestas($this->db->insert_id(), $objEncuestaProspecto->arrPreguntasRespuestas);
		
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
	public function modificar($intEncuestaProspectoID, $objEncuestaProspecto)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Asignar datos al array
		$arrDatos = array('vendedor_id' => $objEncuestaProspecto->intVendedorID,
						  'observaciones' => mb_strtoupper($objEncuestaProspecto->strObservaciones),
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('encuesta_prospecto_id', $intEncuestaProspectoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('encuestas_prospectos', $arrDatos);

		//Eliminar las respuestas correspondientes a esa encuesta aplicada
		$this->db->where('encuesta_prospecto_id', $intEncuestaProspectoID);
		$this->db->delete('encuestas_prospectos_respuestas');

		//Hacer un llamado al método para guardar las respuestas para cada pregunta de la encuesta
		$this->guardar_respuestas($intEncuestaProspectoID, $objEncuestaProspecto->arrPreguntasRespuestas);
		

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intEncuestaProspectoID, $strEstatus)
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
		$this->db->where('encuesta_prospecto_id', $intEncuestaProspectoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('encuestas_prospectos', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intEncuestaProspectoID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProspectoID = NULL, $intVendedorID = NULL, $intEncuestaID = NULL, $intModuloID = NULL)
	{
		$this->db->select("EP.encuesta_prospecto_id, EP.folio, DATE_FORMAT(EP.fecha,'%d/%m/%Y') AS fecha, 
					       EP.encuesta_id, EP.prospecto_id, EP.vendedor_id, EP.observaciones, EP.estatus,
					       E.descripcion AS encuesta, E.modulo_id, M.descripcion AS modulo,
					       CONCAT_WS(' - ', P.codigo, P.nombre_comercial) AS prospecto,
					       P.telefono_principal, P.telefono_secundario,
					       P.contacto_nombre,  P.contacto_celular,
					       CONCAT_WS(' ', P.contacto_telefono, P.contacto_extension) AS contacto_telefono,
					       CONCAT(EM.codigo, ' - ', EM.apellido_paterno,' ', EM.apellido_materno,' ', EM.nombre) AS vendedor,
					       (SELECT COUNT(renglon) 
					       	FROM encuestas_preguntas 
					       	WHERE encuesta_id = EP.encuesta_id ) AS numeroPreguntas,
	        			   (SELECT COUNT(renglon) 
	        			   	FROM encuestas_prospectos_respuestas 
	        			   	WHERE encuesta_prospecto_id = EP.encuesta_prospecto_id) numeroRespuestas", FALSE);
	    $this->db->from('encuestas_prospectos EP');
	    $this->db->join('prospectos P', 'P.prospecto_id = EP.prospecto_id', 'inner');
	    $this->db->join('encuestas E', 'E.encuesta_id = EP.encuesta_id', 'inner');
	    $this->db->join('modulos AS M', 'E.modulo_id = M.modulo_id', 'inner');
	    $this->db->join('vendedores AS V', 'V.vendedor_id = EP.vendedor_id', 'inner');
	    $this->db->join('empleados AS EM', 'EM.empleado_id = V.empleado_id', 'inner');
		//Si existe id de la encuesta
		if ($intEncuestaProspectoID !== NULL)
		{   
			$this->db->where('EP.encuesta_prospecto_id', $intEncuestaProspectoID);
			$this->db->limit(1);
			$arrResultado["encuesta"] = $this->db->get()->row();

			//Cargar información correspondiente a las preguntas y respuestas de la encuesta
			$this->db->select("EPR.renglon_pregunta, 
							   EPR.renglon, 
						       EPR.comentarios,
						       ER.respuesta,
	       					   EPRE.pregunta");
			$this->db->from('encuestas_prospectos EP');
			$this->db->join('encuestas_prospectos_respuestas EPR', 'EP.encuesta_prospecto_id = EPR.encuesta_prospecto_id', 'inner');
			$this->db->join('encuestas_respuestas ER', 'ER.renglon_pregunta = EPR.renglon_pregunta 
							 AND ER.renglon = EPR.renglon AND ER.encuesta_id = EP.encuesta_id', 'inner');
			$this->db->join('encuestas_preguntas EPRE', 'EPRE.renglon = EPR.renglon_pregunta 
				             AND EPRE.encuesta_id = EP.encuesta_id', 'inner');
			$this->db->where('EPR.encuesta_prospecto_id ', $intEncuestaProspectoID);
			$arrResultado["preguntas_respuestas"] = $this->db->get()->result();
		}
		else
		{
			//Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("(EP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }
		    //Si existe id del prospecto
		   	if($intProspectoID > 0)
		   	{
		   		$this->db->where('EP.prospecto_id', $intProspectoID);
		   	}
		    //Si existe id del vendedor
		   	if($intVendedorID > 0)
		   	{
		   		$this->db->where('EP.vendedor_id', $intVendedorID);
		   	}
		   	//Si existe id de la encuesta
		   	if($intEncuestaID > 0)
		   	{
		   		$this->db->where('EP.encuesta_id', $intEncuestaID);
		   	}
		    //Si existe id del módulo
		   	if($intModuloID > 0)
		   	{
		   		$this->db->where('E.modulo_id', $intModuloID);
		   	}

			$this->db->order_by('EP.folio DESC');
			$arrResultado["encuestas_prospectos"] =$this->db->get()->result();
		}

		return $arrResultado;
		
	}
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL,
						   $intVendedorID = NULL, $intEncuestaID = NULL, $intModuloID = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(EP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	   	//Si existe id del prospecto
	   	if($intProspectoID != NULL)
	   	{
	   		$this->db->where('EP.prospecto_id', $intProspectoID);
	   	}
	    //Si existe id del vendedor
	   	if($intVendedorID != NULL)
	   	{
	   		$this->db->where('EP.vendedor_id', $intVendedorID);
	   	}
	   	//Si existe id de la encuesta
	   	if($intEncuestaID != NULL)
	   	{
	   		$this->db->where('EP.encuesta_id', $intEncuestaID);
	   	}
	    //Si existe id del módulo
	   	if($intModuloID != NULL)
	   	{
	   		$this->db->where('E.modulo_id', $intModuloID);
	   	}
		$this->db->from('encuestas_prospectos EP');
		$this->db->join('prospectos P', 'P.prospecto_id = EP.prospecto_id', 'inner');
	    $this->db->join('encuestas E', 'E.encuesta_id = EP.encuesta_id', 'inner');
	    $this->db->join('modulos AS M', 'E.modulo_id = M.modulo_id', 'inner');
	    $this->db->join('vendedores AS V', 'V.vendedor_id = EP.vendedor_id', 'inner');
	    $this->db->join('empleados AS EM', 'EM.empleado_id = V.empleado_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		
		//Seleccionar la información correspondiente a la busqueda
		$this->db->select("EP.encuesta_prospecto_id, 
						   EP.folio, DATE_FORMAT(EP.fecha,'%d/%m/%Y') AS fecha, 
						   EP.estatus, E.descripcion AS encuesta,
						   M.descripcion AS modulo, 
						   CONCAT_WS(' - ', P.codigo, P.nombre_comercial) AS prospecto", FALSE);
		$this->db->from('encuestas_prospectos EP');
		$this->db->join('prospectos P', 'P.prospecto_id = EP.prospecto_id', 'inner');
	    $this->db->join('encuestas E', 'E.encuesta_id = EP.encuesta_id', 'inner');
	    $this->db->join('modulos AS M', 'E.modulo_id = M.modulo_id', 'inner');
	    $this->db->join('vendedores AS V', 'V.vendedor_id = EP.vendedor_id', 'inner');
	    $this->db->join('empleados AS EM', 'EM.empleado_id = V.empleado_id', 'inner');
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(EP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	   	//Si existe id del prospecto
	   	if($intProspectoID != NULL)
	   	{
	   		$this->db->where('EP.prospecto_id', $intProspectoID);
	   	}
	    //Si existe id del vendedor
	   	if($intVendedorID != NULL)
	   	{
	   		$this->db->where('EP.vendedor_id', $intVendedorID);
	   	}
	   	//Si existe id de la encuesta
	   	if($intEncuestaID != NULL)
	   	{
	   		$this->db->where('EP.encuesta_id', $intEncuestaID);
	   	}
	    //Si existe id del módulo
	   	if($intModuloID != NULL)
	   	{
	   		$this->db->where('E.modulo_id', $intModuloID);
	   	}
		$this->db->order_by('EP.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["encuestas_prospectos"] =$this->db->get()->result();
		return $arrResultado;
		
	}

    /*******************************************************************************************************************
	Funciones de la tabla encuestas_prospectos_respuestas
	*********************************************************************************************************************/
	//Función que se utiliza para guardar las preguntas de la encuesta
	public function guardar_respuestas($intEncuestaProspectoID, $arrPreguntasRespuestas)
	{
		//Validar que al menos exista una pregunta
		if(sizeof($arrPreguntasRespuestas) > 0){
			//Hacer recorrido para insertar los datos en la tabla encuestas_preguntas
			for ($intCon = 0; $intCon < sizeof($arrPreguntasRespuestas); $intCon++) 
			{
				if($arrPreguntasRespuestas[$intCon][1] != ''){ //Preguntamos si la pregunta tiene una respuesta asignada
					//Asignar datos al array
					$arrDatos = array('encuesta_prospecto_id' => $intEncuestaProspectoID,
								  'renglon_pregunta' => $arrPreguntasRespuestas[$intCon][0],
								  'renglon' => $arrPreguntasRespuestas[$intCon][1],
								  'comentarios' => mb_strtoupper($arrPreguntasRespuestas[$intCon][2])
								);
					//Guardar los datos del registro
					$this->db->insert('encuestas_prospectos_respuestas', $arrDatos);
				}
				
			}
		}
	}

}
?>