<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Solicitudes_traspasos_refacciones_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objSolicitudTraspaso)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objSolicitudTraspaso->strFolio); 

		//Tabla solicitudes_traspasos_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objSolicitudTraspaso->intSucursalID, 
						  'folio' => $strFolioConsecutivo,  
						  'fecha' => $objSolicitudTraspaso->dteFecha, 
						  'sucursal_salida_id' => $objSolicitudTraspaso->intSucursalSalidaID, 
						  'observaciones' => $objSolicitudTraspaso->strObservaciones, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objSolicitudTraspaso->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('solicitudes_traspasos_refacciones', $arrDatos);
		//Agregar id del nuevo registro al objeto
		$objSolicitudTraspaso->intSolicitudTraspasoRefaccionesID = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la solicitud de traspaso
		$this->guardar_detalles($objSolicitudTraspaso);

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
	public function modificar(stdClass $objSolicitudTraspaso)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla solicitudes_traspasos_refacciones
		//Asignar datos al array
		$arrDatos = array('fecha' => $objSolicitudTraspaso->dteFecha, 
						  'sucursal_salida_id' => $objSolicitudTraspaso->intSucursalSalidaID, 
						  'observaciones' => $objSolicitudTraspaso->strObservaciones, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objSolicitudTraspaso->intUsuarioID);
		$this->db->where('solicitud_traspaso_refacciones_id', $objSolicitudTraspaso->intSolicitudTraspasoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('solicitudes_traspasos_refacciones', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('solicitud_traspaso_refacciones_id', $objSolicitudTraspaso->intSolicitudTraspasoRefaccionesID);
		$this->db->delete('solicitudes_traspasos_refacciones_detalles');

		//Hacer un llamado al método para guardar los detalles de la solicitud de traspaso
		$this->guardar_detalles($objSolicitudTraspaso);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intSolicitudTraspasoRefaccionesID, $strEstatus)
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
		$this->db->where('solicitud_traspaso_refacciones_id', $intSolicitudTraspasoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('solicitudes_traspasos_refacciones', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intSolicitudTraspasoRefaccionesID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intSucursalSalidaID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		$this->db->select("STR.solicitud_traspaso_refacciones_id, STR.folio, 
							DATE_FORMAT(STR.fecha,'%d/%m/%Y') AS fecha, 
						   STR.sucursal_salida_id, STR.observaciones, STR.estatus, SS.nombre AS sucursal_salida, 
						   ST.nombre AS sucursal_solicitud,
						   UC.usuario AS usuario_creacion,
						   DATE_FORMAT(STR.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
		$this->db->from('solicitudes_traspasos_refacciones AS STR');
		$this->db->join('sucursales AS ST', 'STR.sucursal_id = ST.sucursal_id', 'inner');
		$this->db->join('sucursales AS SS', 'STR.sucursal_salida_id = SS.sucursal_id', 'inner');
		$this->db->join('usuarios AS UC', 'STR.usuario_creacion = UC.usuario_id', 'left');
		//Si existe id de la solicitud de traspaso
		if ($intSolicitudTraspasoRefaccionesID !== NULL)
		{   
			$this->db->where('STR.solicitud_traspaso_refacciones_id', $intSolicitudTraspasoRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('STR.sucursal_id',  $this->session->userdata('sucursal_id'));
			//Si existe id de la sucursal de salida
		    if($intSucursalSalidaID > 0)
		    {
		   		$this->db->where('STR.sucursal_salida_id', $intSucursalSalidaID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {		   		
		   		$this->db->where("(STR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }
		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('STR.estatus', $strEstatus);
			} 

			$this->db->where("(STR.folio LIKE '%$strBusqueda%' OR
        				       SS.nombre LIKE '%$strBusqueda%')"); 

			$this->db->order_by('STR.fecha DESC, STR.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intSucursalSalidaID = NULL,
		                   $strEstatus,$strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('STR.sucursal_id',  $this->session->userdata('sucursal_id'));
		//Si existe id de la sucursal de salida
	    if($intSucursalSalidaID != NULL)
	    {
	   		$this->db->where('STR.sucursal_salida_id', $intSucursalSalidaID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
			$this->db->where("(STR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('STR.estatus', $strEstatus);
		}

		$this->db->where("(STR.folio LIKE '%$strBusqueda%' OR
        				   SS.nombre LIKE '%$strBusqueda%')"); 

		$this->db->from('solicitudes_traspasos_refacciones AS STR');
		$this->db->join('sucursales AS ST', 'STR.sucursal_id = ST.sucursal_id', 'inner');
		$this->db->join('sucursales AS SS', 'STR.sucursal_salida_id = SS.sucursal_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("STR.solicitud_traspaso_refacciones_id, STR.folio,
						   DATE_FORMAT(STR.fecha,'%d/%m/%Y') AS fecha, STR.estatus,
						   SS.nombre AS sucursal_salida", FALSE);
		$this->db->from('solicitudes_traspasos_refacciones AS STR');
		$this->db->join('sucursales AS ST', 'STR.sucursal_id = ST.sucursal_id', 'inner');
		$this->db->join('sucursales AS SS', 'STR.sucursal_salida_id = SS.sucursal_id', 'inner');
		$this->db->where('STR.sucursal_id',  $this->session->userdata('sucursal_id'));
		//Si existe id de la sucursal de salida
	    if($intSucursalSalidaID != NULL)
	    {
	   		$this->db->where('STR.sucursal_salida_id', $intSucursalSalidaID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {	   		
	   		$this->db->where("(STR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('STR.estatus', $strEstatus);
		} 


		$this->db->where("(STR.folio LIKE '%$strBusqueda%' OR
        				   SS.nombre LIKE '%$strBusqueda%')");

		$this->db->order_by('STR.fecha DESC, STR.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["solicitudes"] =$this->db->get()->result();
		return $arrResultado;
	}

	/*Método para regresar los registros activos y parcialmente surtidos que coincidan 
	  con el criterio de búsqueda proporcionado
	*/
	public function autocomplete($strDescripcion)
	{
		$this->db->select("STR.solicitud_traspaso_refacciones_id, CONCAT_WS(' - ', STR.folio, S.nombre) AS solicitud", FALSE);
        $this->db->from('solicitudes_traspasos_refacciones AS STR');
        $this->db->join('sucursales AS S', 'STR.sucursal_id = S.sucursal_id', 'inner');
	    $this->db->where('STR.sucursal_salida_id',  $this->session->userdata('sucursal_id'));
	    $this->db->where("(STR.estatus = 'ACTIVO' OR STR.estatus = 'PARCIALMENTE SURTIDO')");
        $this->db->where("(STR.folio LIKE '%$strDescripcion%' OR 
    					   S.nombre LIKE '%$strDescripcion%')");  
        $this->db->order_by("STR.folio",'DESC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla solicitudes_traspasos_refacciones_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la solicitud de traspaso
	public function guardar_detalles(stdClass $objSolicitudTraspaso)
	{
		//Quitar | de la lista para obtener el ID de la refacción, código, descripción y cantidad
		$arrRefaccionID = explode("|", $objSolicitudTraspaso->strRefaccionID);
		$arrCodigos = explode("|", $objSolicitudTraspaso->strCodigos);
		$arrDescripciones = explode("|", $objSolicitudTraspaso->strDescripciones);
		$arrCantidades = explode("|", $objSolicitudTraspaso->strCantidades);

		//Hacer recorrido para insertar los datos en la tabla solicitudes_traspasos_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Asignar datos al array
			$arrDatos = array('solicitud_traspaso_refacciones_id' => $objSolicitudTraspaso->intSolicitudTraspasoRefaccionesID,
							  'renglon' => ($intCon + 1),
							  'refaccion_id' => $arrRefaccionID[$intCon], 
							  'codigo' => $arrCodigos[$intCon],
							  'descripcion' => $arrDescripciones[$intCon],
							  'cantidad' => $arrCantidades[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('solicitudes_traspasos_refacciones_detalles', $arrDatos);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intSolicitudTraspasoRefaccionesID)
	{
		$this->db->select("STRD.renglon, STRD.refaccion_id, STRD.codigo, 
			               STRD.descripcion, STRD.cantidad,
			               CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
			               RM.descripcion AS refacciones_marca");
		$this->db->from('solicitudes_traspasos_refacciones_detalles AS STRD');
		$this->db->join('refacciones AS R', 'STRD.refaccion_id = R.refaccion_id', 'inner');
		$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
		$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
		$this->db->where('STRD.solicitud_traspaso_refacciones_id', $intSolicitudTraspasoRefaccionesID);
		$this->db->order_by('STRD.renglon', 'ASC');
		return $this->db->get()->result();
	}
}
?>