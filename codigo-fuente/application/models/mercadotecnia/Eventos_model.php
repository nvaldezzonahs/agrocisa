<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla eventos
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar($strDescripcion, 
							$dteFecha, 
							$dteHora,
							$strResponsable,
							$strMarcas,
							$strObjetivos,
							$strResultados,
							$intLocalidadID,
							$strCantidades,
							$strConceptos,
							$strImportes)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Variable que se utiliza para asignar el id del nuevo registro
		$intEventoID = 0;

		$dteFechaHora = $dteFecha.' '.$dteHora;
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFechaHora,
						  'localidad_id' => $intLocalidadID, 
						  'descripcion' => $strDescripcion,
						  'responsable' => $strResponsable,
						  'marcas_participantes' => $strMarcas,
						  'objetivos' => $strObjetivos,
						  'resultados' => $strResultados,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('eventos', $arrDatos);

		//Asignar id del nuevo registro en la base de datos
		$intEventoID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la orden de compra
		$this->guardar_detalles($intEventoID, $strCantidades, $strConceptos, $strImportes);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intEventoID;

	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar($intEventoID, 
							  $strDescripcion, 
							  $dteFecha, 
							  $dteHora,
							  $strResponsable,
							  $strMarcas,
							  $strObjetivos,
							  $strResultados,
							  $intLocalidadID,
							  $strCantidades,
							  $strConceptos,
							  $strImportes)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();

		$dteFechaHora = $dteFecha.' '.$dteHora;
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFechaHora,
						  'localidad_id' => $intLocalidadID, 
						  'descripcion' => $strDescripcion,
						  'responsable' => $strResponsable,
						  'marcas_participantes' => $strMarcas,
						  'objetivos' => $strObjetivos,
						  'resultados' => $strResultados,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('evento_id', $intEventoID);
		$this->db->limit(1);
		
		//Actualizar los datos del registro
		$this->db->update('eventos', $arrDatos);
		//Eliminar los detalles guardados
		$this->db->where('evento_id', $intEventoID);
		$this->db->delete('eventos_presupuesto');
		//Hacer un llamado al método para guardar los detalles de la orden de compra
		$this->guardar_detalles($intEventoID, $strCantidades, $strConceptos, $strImportes);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intEventoID, $strEstatus)
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
		$this->db->where('evento_id', $intEventoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('eventos',$arrDatos);
	}
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intEventoID = NULL,  $dteFechaInicial = NULL, $dteFechaFinal = NULL, $strBusqueda = NULL)
	{
		$this->db->select("	EV.evento_id, 
							DATE_FORMAT(EV.fecha,'%d/%m/%Y') AS fecha,
							DATE_FORMAT(EV.fecha,'%h:%i %p') AS hora,
							EV.localidad_id, 
						   	EV.descripcion,
						   	EV.responsable,
						   	EV.marcas_participantes,
						   	EV.objetivos,
						   	EV.resultados, 
						   	EV.estatus,						   	
						   	L.descripcion AS localidad, M.descripcion AS municipio,
						   	SUM((EP.cantidad * EP.importe_unitario)) AS total_presupuesto,
						   	CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado, E.descripcion AS estado_rep,
						   	CONCAT_WS(' - ', P.codigo, P.descripcion) AS pais, P.descripcion AS pais_rep,
						   	(SELECT COUNT(EA.renglon)
						    	FROM eventos_asistentes AS EA
						    	WHERE EA.evento_id = EV.evento_id) AS total_asistentes
						   ", FALSE);
		$this->db->from('eventos AS EV');				
		$this->db->join('eventos_presupuesto AS EP', 'EV.evento_id = EP.evento_id', 'inner');
		$this->db->join('localidades AS L', 'EV.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS M', 'L.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		$this->db->group_by('EP.evento_id');				
		//Si existe id del evento
		if($intEventoID !== NULL)
		{
			$this->db->where('EV.evento_id', $intEventoID);
			$this->db->limit(1);
			return $this->db->get()->row();
			
		}
		else
		{
			$this->db->where("(EV.descripcion LIKE '%$strBusqueda%' OR
						       EV.estatus LIKE '%$strBusqueda%' OR
						       L.descripcion LIKE '%$strBusqueda%')");
			//Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("(EV.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 
			$this->db->order_by('EV.fecha', 'DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $strBusqueda = NULL,
		                   $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
	    $this->db->where("(EV.descripcion LIKE '%$strBusqueda%' OR
						   EV.estatus LIKE '%$strBusqueda%' OR
						   L.descripcion LIKE '%$strBusqueda%')");
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(EV.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
		$this->db->from('eventos AS EV');
		$this->db->join('localidades AS L', 'EV.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS M', 'L.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("EV.evento_id, DATE_FORMAT(EV.fecha,'%d/%m/%Y') AS fecha,
						   EV.descripcion, EV.estatus, L.descripcion AS localidad", FALSE);
		$this->db->from('eventos AS EV');
		$this->db->join('localidades AS L', 'EV.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS M', 'L.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		$this->db->where("(EV.descripcion LIKE '%$strBusqueda%' OR
						   EV.estatus LIKE '%$strBusqueda%' OR
						   L.descripcion LIKE '%$strBusqueda%')");
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(EV.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
		$this->db->order_by('EV.fecha', 'DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["eventos"] =$this->db->get()->result();
		return $arrResultado;
	}

	/*******************************************************************************************************************
	Funciones de la tabla eventos_presupuesto
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles del evento
	public function guardar_detalles($intEventoID, $strCantidades, $strConceptos, $strImportes)
	{
		
		/*Quitar | de la lista para obtener la cantidad, concepto, importe*/
		$arrCantidades = explode("|", $strCantidades);
		$arrConceptos = explode("|", $strConceptos);
		$arrImportes = explode("|", $strImportes);

		//Hacer recorrido para insertar los datos en la tabla eventos_presupuesto
		for ($intCon = 0; $intCon < sizeof($arrConceptos); $intCon++) 
		{
			//Asignar datos al array
			$arrDatos = array('evento_id' => $intEventoID,
							  'renglon' => ($intCon + 1),
							  'cantidad' => $arrCantidades[$intCon], 
							  'concepto' => $arrConceptos[$intCon],
							  'importe_unitario' => $arrImportes[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('eventos_presupuesto', $arrDatos);
		}

	}

	/*******************************************************************************************************************
	Funciones de la tabla eventos_asistentes
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los asistentes del evento
	public function guardar_asistentes($intEventoID, $strProspectoID, $strTelefonos, $strCorreosElectronicos, 
									   $strLocalidadID, $strInteresados)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Si existen asistentes
		if($strProspectoID !== '')
		{
			//Eliminar los asistentes guardadas
			$this->db->where('evento_id', $intEventoID);
			$this->db->delete('eventos_asistentes');

			//Quitar | de la lista para obtener el ID del prospecto, teléfono, correo electrónico, 
			//id de la localidad e interesado
			$arrProspectoID = explode("|", $strProspectoID);
			$arrTelefonos = explode("|", $strTelefonos);
			$arrCorreosElectronicos = explode("|", $strCorreosElectronicos);
			$arrLocalidadID = explode("|", $strLocalidadID);
			$arrInteresados = explode("|", $strInteresados);

			//Hacer recorrido para insertar los datos en la tabla eventos_asistentes
			for ($intCon = 0; $intCon < sizeof($arrProspectoID); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('evento_id' => $intEventoID,
								  'renglon' => ($intCon + 1),
								  'prospecto_id' => $arrProspectoID[$intCon],
								  'telefono' => $arrTelefonos[$intCon],
								  'correo_electronico' => $arrCorreosElectronicos[$intCon], 
								  'localidad_id' => $arrLocalidadID[$intCon],
								  'interesado' => $arrInteresados[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('eventos_asistentes', $arrDatos);
			}

			//Actualizar datos de la tabla eventos
			//Asignar datos al array
			$arrDatos = array('fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
			$this->db->where('evento_id', $intEventoID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('eventos', $arrDatos);
		}

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los asistentes de un registro
	public function buscar_asistentes($intEventoID)
	{
		$this->db->select("EA.prospecto_id, EA.telefono, EA.correo_electronico, EA.localidad_id, 
						   EA.interesado, CONCAT_WS(' - ', P.codigo, P.nombre_comercial) AS prospecto,
						   L.descripcion AS localidad, M.descripcion AS municipio,
						   CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado, E.descripcion AS estado_rep", FALSE);
		$this->db->from('eventos_asistentes AS EA');
		$this->db->join('prospectos AS P', 'EA.prospecto_id = P.prospecto_id', 'inner');
		$this->db->join('localidades AS L', 'EA.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS M', 'L.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->where('EA.evento_id', $intEventoID);
		$this->db->order_by('EA.renglon', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intEventoID = NULL)
	{
		$this->db->select('	EP.evento_id,
						   	EP.renglon,
						   	EP.cantidad,
						   	EP.concepto,
						   	EP.importe_unitario,
						   	(EP.cantidad * EP.importe_unitario) AS total');
		$this->db->from('eventos_presupuesto AS EP');		
		$this->db->where('EP.evento_id', $intEventoID);
		$this->db->order_by('EP.renglon', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select("evento_id, descripcion AS evento", FALSE);
		$this->db->from('eventos');
		$this->db->where('estatus', 'ACTIVO');
		$this->db->where("descripcion LIKE '%$strDescripcion%'"); 
		$this->db->order_by("descripcion",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
		return $this->db->get()->result();
	}

}
?>