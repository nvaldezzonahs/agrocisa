<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_resultados_encuestas_model extends CI_model {

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar( $dteFechaInicial = NULL, $dteFechaFinal = NULL,  $intEncuestaID = NULL, $intZonaID = NULL, $intLocalidadID = NULL, $intMunicipioID = NULL, $intEstadoID = NULL, $intActividadID = NULL, $intCultivoID = NULL){
		
		$this->db->select("EP.encuesta_prospecto_id, 
							EP.folio, 
							EP.fecha, 
					        EP.encuesta_id, 
					        EP.prospecto_id, 
					        EP.observaciones", FALSe);
		$this->db->from("encuestas_prospectos EP");
		if($intCultivoID  > 0)
		{
			$this->db->join("prospectos_cultivos PC", "PC.prospecto_id = EP.prospecto_id AND PC.cultivo_id = '$intCultivoID'", 'inner');
		}
		if($intActividadID  > 0)
		{
			$this->db->join("prospectos_actividades PA", "PA.prospecto_id = EP.prospecto_id AND PA.actividad_id = '$intActividadID'", 'inner');
		}
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("DATE(EP.fecha) BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    if($intEncuestaID  > 0){
	    	$this->db->where("EP.encuesta_id", $intEncuestaID);
	    }
	    $this->db->order_by("EP.fecha",'DESC');
		return $this->db->get()->result();
	}

    //Método para obtener respuestas
    public function get_respuestas( $dteFechaInicial = NULL, $dteFechaFinal = NULL,  
    								$intEncuestaID = NULL, 
    								$intZonaID = NULL, $intLocalidadID = NULL, $intMunicipioID = NULL, $intEstadoID = NULL, 
    								$intActividadID = NULL, $intCultivoID = NULL){

    	$this->db->select("DISTINCT EPRO.encuesta_id AS EncuestaID,
								    E.descripcion AS Encuesta,
								    EPRE.renglon AS RenglonPregunta,
								    EPRE.pregunta AS Pregunta,
								    ERES.renglon AS RenglonRespuesta,
								    ERES.respuesta AS Respuesta,
								    (SELECT COUNT(EPPR2.renglon)
								     FROM encuestas_prospectos_respuestas AS EPPR2
									 INNER JOIN encuestas_prospectos AS EPP2 ON EPP2.encuesta_prospecto_id = EPPR2.encuesta_prospecto_id
									 INNER JOIN encuestas AS E2 ON E2.encuesta_id = EPP2.encuesta_id
								     WHERE EPPR2.renglon_pregunta = EPRE.renglon
									 AND EPPR2.renglon = ERES.renglon
									 AND E2.encuesta_id = E.encuesta_id) AS Total", FALSE);
    	$this->db->from("encuestas_prospectos EPRO");
    	$this->db->join("encuestas E", "E.encuesta_id = EPRO.encuesta_id", "inner");
    	$this->db->join("encuestas_preguntas EPRE", "EPRE.encuesta_id = EPRO.encuesta_id", "inner");
    	$this->db->join("encuestas_respuestas ERES", "ERES.renglon_pregunta = EPRE.renglon", "inner");
    	$this->db->where("ERES.encuesta_id = EPRO.encuesta_id");
    	//Filtros de: Rango de fechas, tipo de cultivo seleccionado, tipo de actividad seleccionada, encuesta seleccionada, 
    	if($intCultivoID > 0)
		{
			$this->db->join("prospectos_cultivos PC", "PC.prospecto_id = EPRO.prospecto_id AND PC.cultivo_id = '$intCultivoID'", 'inner');
		}
		if($intActividadID > 0)
		{
			$this->db->join("prospectos_actividades PA", "PA.prospecto_id = EPRO.prospecto_id AND PA.actividad_id = '$intActividadID'", 'inner');
		}
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("DATE(EPRO.fecha) BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    if($intEncuestaID > 0){
	    	$this->db->where("EPRO.encuesta_id", $intEncuestaID);
	    }
	    //Filtros de Ubicación
	    if($intLocalidadID > 0){
	    	$this->db->join("prospectos PROS", "PROS.prospecto_id = EPRO.prospecto_id", 'inner');
	    	$this->db->join("localidades LOC", "LOC.localidad_id =  PROS.localidad_id AND LOC.localidad_id = '$intLocalidadID'", 'inner');
	    }
	    if($intZonaID > 0){
	    	$this->db->join("prospectos PROS", "PROS.prospecto_id = EPRO.prospecto_id", 'inner');
	    	$this->db->join("localidades LOC", "LOC.localidad_id = PROS.localidad_id", 'inner');
	    	$this->db->join("zonas_localidades ZL", "ZL.localidad_id = LOC.localidad_id AND ZL.zona_id = '$intZonaID'", 'inner');
	    }
	    if($intMunicipioID > 0){
	    	$this->db->join("prospectos PROS", "PROS.prospecto_id = EPRO.prospecto_id", 'inner');
	    	$this->db->join("localidades LOC", "LOC.localidad_id = PROS.localidad_id", 'inner');
	    	$this->db->join("municipios MUN", "MUN.municipio_id = LOC.municipio_id AND MUN.municipio_id = '$intMunicipioID'", 'inner');
	    }
	    if($intEstadoID > 0){
	    	$this->db->join("prospectos PROS", "PROS.prospecto_id = EPRO.prospecto_id", 'inner');
	    	$this->db->join("localidades LOC", "LOC.localidad_id = PROS.localidad_id", 'inner');
	    	$this->db->join("municipios MUN", "MUN.municipio_id = LOC.municipio_id", 'inner');
	    	$this->db->join("sat_estados EST", "EST.estado_id = MUN.estado_id AND EST.estado_id = '$intEstadoID'", 'inner');
	    }
    	$this->db->order_by("EPRO.encuesta_id , EPRE.renglon , ERES.renglon", "ASC");

    	$arrResultado["respuestas"] = $this->db->get()->result();

    	return $arrResultado;

    }


}