<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Requisiciones_refacciones_internas_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla requisiciones_refacciones_internas
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objRequisicionRefacciones)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        
		//Tabla requisiciones_refacciones_internas
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objRequisicionRefacciones->strFolio); 

		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objRequisicionRefacciones->intSucursalID, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objRequisicionRefacciones->dteFecha, 
						  'orden_reparacion_interna_id' => $objRequisicionRefacciones->intOrdenReparacionInternaID,
						  'observaciones' => $objRequisicionRefacciones->strObservaciones, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objRequisicionRefacciones->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('requisiciones_refacciones_internas', $arrDatos);
		//Agregar id del nuevo registro al objeto
		$objRequisicionRefacciones->intRequisicionRefaccionesInternasID = $this->db->insert_id();
		//Hacer un llamado al método para guardar los detalles de la requisición
		$this->guardar_detalles($objRequisicionRefacciones);

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
	public function modificar(stdClass $objRequisicionRefacciones)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla requisiciones_refacciones_internas
		//Asignar datos al array
		$arrDatos = array('fecha' => $objRequisicionRefacciones->dteFecha, 
						  'orden_reparacion_interna_id' => $objRequisicionRefacciones->intOrdenReparacionInternaID,
						  'observaciones' => $objRequisicionRefacciones->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objRequisicionRefacciones->intUsuarioID);
		$this->db->where('requisicion_refacciones_internas_id', $objRequisicionRefacciones->intRequisicionRefaccionesInternasID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('requisiciones_refacciones_internas', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('requisicion_refacciones_internas_id', $objRequisicionRefacciones->intRequisicionRefaccionesInternasID);
		$this->db->delete('requisiciones_refacciones_internas_detalles');
		//Hacer un llamado al método para guardar los detalles de la requisición
		$this->guardar_detalles($objRequisicionRefacciones);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}


    //Método para modificar el estatus de un registro
	public function set_estatus($intRequisicionRefaccionesInternasID, $strEstatus)
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
		$this->db->where('requisicion_refacciones_internas_id', $intRequisicionRefaccionesInternasID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('requisiciones_refacciones_internas', $arrDatos);
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intRequisicionRefaccionesInternasID = NULL, $dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL,  $intVehiculoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		$this->db->select("RRI.requisicion_refacciones_internas_id, RRI.folio, 
						   DATE_FORMAT(RRI.fecha,'%d/%m/%Y') AS fecha, 
						   RRI.orden_reparacion_interna_id, RRI.observaciones, RRI.estatus, 
						   ORI.folio AS folio_orden_reparacion, ORI.serie, ORI.motor, ORI.vehiculo_id,
						   CASE 
							   WHEN  ORI.vehiculo_id > 0 
							   		THEN CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas)
								    ELSE '' 
						   	END AS vehiculo, 
						   	V.codigo AS codigo_vehiculo, 
					       	V.modelo AS modelo_vehiculo, 
					       	V.marca AS marca_vehiculo, 
					       	V.placas AS placas_vehiculo, 
						   UC.usuario AS usuario_creacion, 
						   DATE_FORMAT(RRI.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
	    $this->db->from('requisiciones_refacciones_internas AS RRI');
	    $this->db->join('ordenes_reparacion_internas AS ORI', 
	    				'RRI.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id', 'inner');
	    $this->db->join('vehiculos AS V', 'ORI.vehiculo_id = V.vehiculo_id', 'left');
		$this->db->join('usuarios AS UC', 'RRI.usuario_creacion = UC.usuario_id', 'left');
		//Si existe id de la requisición interna
		if ($intRequisicionRefaccionesInternasID != NULL)
		{   
			$this->db->where('RRI.requisicion_refacciones_internas_id', $intRequisicionRefaccionesInternasID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('RRI.sucursal_id',  $this->session->userdata('sucursal_id'));
			//Si existe id del vehículo
		    if($intVehiculoID > 0)
		    {
		   		$this->db->where('ORI.vehiculo_id', $intVehiculoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("RRI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('RRI.estatus', $strEstatus);
			}

			$this->db->where("((RRI.folio LIKE '%$strBusqueda%') OR
						   (ORI.folio LIKE '%$strBusqueda%') OR
						   (ORI.serie LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' - ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%'))");

			$this->db->order_by('RRI.fecha DESC, RRI.folio DESC');
			return $this->db->get()->result();
		}
	}

	

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intVehiculoID = NULL,
						   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('RRI.sucursal_id',  $this->session->userdata('sucursal_id'));
		//Si existe id del vehículo
	    if($intVehiculoID > 0)
	    {
	   		$this->db->where('ORI.vehiculo_id', $intVehiculoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {	   		
	   	     $this->db->where("(RRI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('RRI.estatus', $strEstatus);
		}


		$this->db->where("((RRI.folio LIKE '%$strBusqueda%') OR
						   (ORI.folio LIKE '%$strBusqueda%') OR
						   (ORI.serie LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' - ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%'))");

		$this->db->from('requisiciones_refacciones_internas AS RRI');
	    $this->db->join('ordenes_reparacion_internas AS ORI', 
	    				'RRI.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id', 'inner');
	    $this->db->join('vehiculos AS V', 'ORI.vehiculo_id = V.vehiculo_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("RRI.requisicion_refacciones_internas_id, RRI.folio, 
						   DATE_FORMAT(RRI.fecha,'%d/%m/%Y') AS fecha, 
						   RRI.estatus, ORI.folio AS folio_orden_reparacion, ORI.serie,
						   CASE 
							   WHEN  ORI.vehiculo_id > 0 
							   		THEN CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas)
								    ELSE '' 
						   	END AS vehiculo", FALSE);
		$this->db->from('requisiciones_refacciones_internas AS RRI');
	    $this->db->join('ordenes_reparacion_internas AS ORI', 
	    				'RRI.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id', 'inner');
	    $this->db->join('vehiculos AS V', 'ORI.vehiculo_id = V.vehiculo_id', 'left');
		$this->db->where('RRI.sucursal_id',  $this->session->userdata('sucursal_id'));
	     //Si existe id del vehículo
	    if($intVehiculoID > 0)
	    {
	   		$this->db->where('ORI.vehiculo_id', $intVehiculoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {	   		
	   	    $this->db->where("RRI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('RRI.estatus', $strEstatus);
		}

		$this->db->where("((RRI.folio LIKE '%$strBusqueda%') OR
						   (ORI.folio LIKE '%$strBusqueda%') OR
						   (ORI.serie LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' - ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%'))");

		$this->db->order_by('RRI.fecha DESC, RRI.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["requisiciones"] =$this->db->get()->result();
		return $arrResultado;
	}

	/*Método para regresar los registros activos y parcialmente surtidos que coincidan 
	  con el criterio de búsqueda proporcionado
	*/
	public function autocomplete($strDescripcion)
	{
		$this->db->select('RRI.requisicion_refacciones_internas_id, RRI.folio');
        $this->db->from('requisiciones_refacciones_internas AS RRI');
        $this->db->join('ordenes_reparacion_internas AS ORI', 'RRI.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id', 'inner');
	    $this->db->where('RRI.sucursal_id',  $this->session->userdata('sucursal_id'));
	    $this->db->where('ORI.estatus', 'ACTIVO');
	    $this->db->where("(RRI.estatus = 'ACTIVO' OR RRI.estatus = 'PARCIALMENTE SURTIDO')");
        $this->db->where("(RRI.folio LIKE '%$strDescripcion%')");  
        $this->db->order_by("RRI.folio",'DESC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla requisiciones_refacciones_internas_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la requisición
	public function guardar_detalles(stdClass $objRequisicionRefacciones)
	{
		/*Quitar | de la lista para obtener el ID de la refacción, código, descripción, cantidad, 
		 precio unitario, descuento unitario, iva unitario e ieps unitario
		*/
		$arrRefaccionID = explode("|", $objRequisicionRefacciones->strRefaccionID);
		$arrCodigos = explode("|", $objRequisicionRefacciones->strCodigos);
		$arrDescripciones = explode("|", $objRequisicionRefacciones->strDescripciones);
		$arrCodigosLineas = explode("|", $objRequisicionRefacciones->strCodigosLineas);
		$arrCantidades = explode("|", $objRequisicionRefacciones->strCantidades);
	
		//Hacer recorrido para insertar los datos en la tabla requisiciones_refacciones_internas_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			
			//Asignar datos al array
			$arrDatos = array('requisicion_refacciones_internas_id' => $objRequisicionRefacciones->intRequisicionRefaccionesInternasID,
							  'renglon' => ($intCon + 1),
							  'refaccion_id' => $arrRefaccionID[$intCon], 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $arrCantidades[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('requisiciones_refacciones_internas_detalles', $arrDatos);
			
		}
	}


	//Método para regresar los detalles de un registro
	public function buscar_detalles($intRequisicionRefaccionesInternasID)
	{
		$this->db->select('RRID.renglon, RRID.refaccion_id, RRID.codigo, RRID.descripcion, RRID.codigo_linea, 
						   RRID.cantidad');
		$this->db->from('requisiciones_refacciones_internas_detalles AS RRID');
		$this->db->where('RRID.requisicion_refacciones_internas_id', $intRequisicionRefaccionesInternasID);
		$this->db->order_by('RRID.renglon', 'ASC');
		return $this->db->get()->result();
	}
}	
?>