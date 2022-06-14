<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campanas_publicitarias_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar($strTipo, $intModuloID, $intZonaID, $intLocalidadID, $intMunicipioID, 
							$intEstadoID, $strTitulo, $strComentarios, $intAlcance)
	{
		//Asignar datos al array
		$arrDatos = array('tipo' => $strTipo, 
						  'modulo_id' => $intModuloID,
						  'zona_id' => $intZonaID,
						  'localidad_id' => $intLocalidadID,
						  'municipio_id' => $intMunicipioID,
						  'estado_id' => $intEstadoID,
						  'titulo' => $strTitulo,
						  'comentarios' => $strComentarios,
						  'alcance' => $intAlcance,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		return $this->db->insert('campanas_publicitarias', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intCampanaPublicitariaID = NULL, $dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL, $intModuloID = NULL, $intZonaID = NULL,
						   $intLocalidadID = NULL, $intMunicipioID = NULL, $intEstadoID = NULL)
	{
		$this->db->select("CP.campana_publicitaria_id, CP.tipo, CP.modulo_id, CP.zona_id, 
						   CP.localidad_id, CP.municipio_id, CP.estado_id, CP.titulo, CP.comentarios, 
						   CP.alcance, DATE_FORMAT(CP.fecha_creacion,'%d/%m/%Y') AS fecha,
						   CASE 
							   WHEN  CP.modulo_id > 0 THEN MO.descripcion
								 ELSE 'TODOS'
						   END AS modulo, Z.descripcion AS zona, 
						   L.descripcion AS localidad, M.descripcion AS municipio, 
						   CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado, E.descripcion AS estado_rep", FALSE);
		$this->db->from('campanas_publicitarias AS CP');
		$this->db->join('modulos AS MO', 'CP.modulo_id = MO.modulo_id', 'left');
		$this->db->join('zonas AS Z', 'CP.zona_id = Z.zona_id', 'left');
		$this->db->join('localidades AS L', 'CP.localidad_id = L.localidad_id', 'left');
		$this->db->join('municipios AS M', 'CP.municipio_id = M.municipio_id', 'left');
		$this->db->join('sat_estados AS E', 'CP.estado_id = E.estado_id', 'left');
		//Si existe id de la campaña publicitaria
		if ($intCampanaPublicitariaID !== NULL)
		{   
			$this->db->where('campana_publicitaria_id', $intCampanaPublicitariaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{	
			//Si existe id del módulo
			if($intModuloID > 0)
		    {
			   	$this->db->where('CP.modulo_id', $intModuloID);
			}
		    //Si existe id de la zona
			if($intZonaID > 0)
		    {
		   		$this->db->where('CP.zona_id', $intZonaID);
		    }
		    //Si existe id de la localidad
			if($intLocalidadID > 0)
		    {
		   		$this->db->where('CP.localidad_id', $intLocalidadID);
		    }
		    //Si existe id del municipio
			if($intMunicipioID > 0)
		    {
		   		$this->db->where('CP.municipio_id', $intMunicipioID);
		    }
		    //Si existe id del estado
			if($intEstadoID > 0)
		    {
		   		$this->db->where('CP.estado_id', $intEstadoID);
		    }
		    //Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("(DATE_FORMAT(CP.fecha_creacion,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }
		    $this->db->order_by('CP.fecha_creacion', 'DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los correos electrónicos que coincidan con el criterio de búsqueda proporcionado
	public function buscar_correos_electronicos($strTipo)
	{
		//Dependiendo del tipo realizar la búsqueda de datos
		if($strTipo == 'PROSPECTOS')
		{
			$this->db->select('correo_electronico, contacto_correo_electronico');
			$this->db->from('prospectos');
			$this->db->where('estatus', 'ACTIVO');
			$this->db->where("(correo_electronico <> '' OR  contacto_correo_electronico <> '')", NULL, FALSE);
		}
		else
		{
			$this->db->select('correo_electronico, contacto_correo_electronico');
			$this->db->from('clientes');
			$this->db->where('estatus', 'ACTIVO');
			$this->db->where("(correo_electronico <> '' OR  contacto_correo_electronico <> '')", NULL, FALSE);
		}

		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intModuloID = NULL, $intZonaID = NULL, 
						   $intLocalidadID = NULL, $intMunicipioID = NULL, $intEstadoID = NULL,  $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe id del módulo
		if($intModuloID != NULL)
	    {
			$this->db->where('CP.modulo_id', $intModuloID);
		}
		//Si existe id de la zona
		if($intZonaID != NULL)
	    {
	   		$this->db->where('CP.zona_id', $intZonaID);
	    }
	    //Si existe id de la localidad
		if($intLocalidadID != NULL)
	    {
	   		$this->db->where('CP.localidad_id', $intLocalidadID);
	    }
	    //Si existe id del municipio
		if($intMunicipioID != NULL)
	    {
	   		$this->db->where('CP.municipio_id', $intMunicipioID);
	    }
	    //Si existe id del estado
		if($intEstadoID != NULL)
	    {
	   		$this->db->where('CP.estado_id', $intEstadoID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(CP.fecha_creacion,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
		$this->db->from('campanas_publicitarias AS CP');
		$this->db->join('modulos AS MO', 'CP.modulo_id = MO.modulo_id', 'left');
		$this->db->join('zonas AS Z', 'CP.zona_id = Z.zona_id', 'left');
		$this->db->join('localidades AS L', 'CP.localidad_id = L.localidad_id', 'left');
		$this->db->join('municipios AS M', 'CP.municipio_id = M.municipio_id', 'left');
		$this->db->join('sat_estados AS E', 'CP.estado_id = E.estado_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CP.campana_publicitaria_id, CP.alcance, CP.tipo, 
						   DATE_FORMAT(CP.fecha_creacion,'%d/%m/%Y') AS fecha,
						   CASE 
							   WHEN  CP.modulo_id > 0 THEN MO.descripcion
								 ELSE 'TODOS'
						   END AS modulo,
						   Z.descripcion AS zona, L.descripcion AS localidad, 
						   M.descripcion AS municipio, E.descripcion AS estado", FALSE);
		$this->db->from('campanas_publicitarias AS CP');
		$this->db->join('modulos AS MO', 'CP.modulo_id = MO.modulo_id', 'left');
		$this->db->join('zonas AS Z', 'CP.zona_id = Z.zona_id', 'left');
		$this->db->join('localidades AS L', 'CP.localidad_id = L.localidad_id', 'left');
		$this->db->join('municipios AS M', 'CP.municipio_id = M.municipio_id', 'left');
		$this->db->join('sat_estados AS E', 'CP.estado_id = E.estado_id', 'left');
		//Si existe id del módulo
		if($intModuloID != NULL)
	    {
			$this->db->where('CP.modulo_id', $intModuloID);
		}
		//Si existe id de la zona
		if($intZonaID != NULL)
	    {
	   		$this->db->where('CP.zona_id', $intZonaID);
	    }
	    //Si existe id de la localidad
		if($intLocalidadID != NULL)
	    {
	   		$this->db->where('CP.localidad_id', $intLocalidadID);
	    }
	    //Si existe id del municipio
		if($intMunicipioID != NULL)
	    {
	   		$this->db->where('CP.municipio_id', $intMunicipioID);
	    }
	    //Si existe id del estado
		if($intEstadoID != NULL)
	    {
	   		$this->db->where('CP.estado_id', $intEstadoID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(CP.fecha_creacion,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
		$this->db->order_by('CP.fecha_creacion', 'DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["campanas"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>