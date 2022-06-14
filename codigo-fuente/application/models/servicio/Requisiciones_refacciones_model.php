<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Requisiciones_refacciones_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla requisiciones_refacciones
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objRequisicionRefacciones)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        
		//Tabla requisiciones_refacciones
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objRequisicionRefacciones->strFolio); 

		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objRequisicionRefacciones->intSucursalID, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objRequisicionRefacciones->dteFecha, 
						  'orden_reparacion_id' => $objRequisicionRefacciones->intOrdenReparacionID,
						  'moneda_id' => $objRequisicionRefacciones->intMonedaID, 
						  'tipo_cambio' => $objRequisicionRefacciones->intTipoCambio, 
						  'observaciones' => $objRequisicionRefacciones->strObservaciones, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objRequisicionRefacciones->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('requisiciones_refacciones', $arrDatos);
		//Agregar id del nuevo registro al objeto
		$objRequisicionRefacciones->intRequisicionRefaccionesID = $this->db->insert_id();
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

		//Tabla requisiciones_refacciones
		//Asignar datos al array
		$arrDatos = array('fecha' => $objRequisicionRefacciones->dteFecha, 
						  'orden_reparacion_id' => $objRequisicionRefacciones->intOrdenReparacionID,
						  'moneda_id' => $objRequisicionRefacciones->intMonedaID, 
						  'tipo_cambio' => $objRequisicionRefacciones->intTipoCambio, 
						  'observaciones' => $objRequisicionRefacciones->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objRequisicionRefacciones->intUsuarioID);
		$this->db->where('requisicion_refacciones_id', $objRequisicionRefacciones->intRequisicionRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('requisiciones_refacciones', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('requisicion_refacciones_id', $objRequisicionRefacciones->intRequisicionRefaccionesID);
		$this->db->delete('requisiciones_refacciones_detalles');
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
	public function set_estatus($intRequisicionRefaccionesID, $strEstatus)
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
		$this->db->where('requisicion_refacciones_id', $intRequisicionRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('requisiciones_refacciones', $arrDatos);
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intRequisicionRefaccionesID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		$this->db->select("RR.requisicion_refacciones_id, RR.folio, DATE_FORMAT(RR.fecha,'%d/%m/%Y') AS fecha, 
						   RR.orden_reparacion_id, RR.moneda_id, RR.tipo_cambio,
						   RR.observaciones, RR.estatus, OR.folio AS folio_orden_reparacion,
						   OR.tipo_reparacion, OR.estatus AS estatus_orden_reparacion, 
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' THEN C.nombre_comercial
								    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   END AS prospecto, 
						   P.telefono_principal,  P.calle, P.numero_exterior, P.numero_interior, P.colonia,  
						   L.descripcion AS localidad, MP.descripcion AS municipio, EP.descripcion AS estado,
						   CP.codigo_postal,   M.codigo AS codigo_moneda, CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   C.rfc, C.estatus AS cliente_estatus,
						   C.nombre_comercial AS cliente, 
					       C.telefono_principal AS cliente_telefono_principal, 
						   C.calle AS cliente_calle, C.numero_exterior AS cliente_numero_exterior, 
						   C.numero_interior AS cliente_numero_interior,  
						   CCP.codigo_postal AS cliente_codigo_postal,
						   C.colonia AS cliente_colonia, C.localidad AS cliente_localidad, 
						   MC.descripcion AS cliente_municipio,  EC.descripcion AS cliente_estado,
						   C.servicio_lista_precio_id, 
						   UC.usuario AS usuario_creacion,
						   DATE_FORMAT(RR.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion ", FALSE);
	    $this->db->from('requisiciones_refacciones AS RR');
	    $this->db->join('sat_monedas AS M', 'RR.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('ordenes_reparacion AS OR', 'RR.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
	    $this->db->join('prospectos AS P', 'OR.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sat_paises AS PP', 'EP.pais_id = PP.pais_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('sat_codigos_postales AS CCP', 'C.codigo_postal_id = CCP.codigo_postal_id', 'left');
		$this->db->join('municipios AS MC', 'C.municipio_id = MC.municipio_id', 'left');
		$this->db->join('sat_estados AS EC', 'MC.estado_id = EC.estado_id', 'left');
		$this->db->join('usuarios AS UC', 'RR.usuario_creacion = UC.usuario_id', 'left');

		//Si existe id de la requisición
		if ($intRequisicionRefaccionesID != NULL)
		{   
			$this->db->where('RR.requisicion_refacciones_id', $intRequisicionRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('RR.sucursal_id',  $this->session->userdata('sucursal_id'));
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('OR.prospecto_id', $intProspectoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(RR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('RR.estatus', $strEstatus);
			}

			$this->db->where("((RR.folio LIKE '%$strBusqueda%') OR
								(OR.folio LIKE '%$strBusqueda%') OR
								(C.nombre_comercial LIKE '%$strBusqueda%') OR
	        				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
				               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))"); 
			$this->db->order_by('RR.fecha DESC, RR.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						                    $intProspectoID = NULL,$strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('requisiciones_refacciones AS RR');
		$this->db->join('sat_monedas AS M', 'RR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'RR.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
	    $this->db->join('prospectos AS P', 'OR.prospecto_id = P.prospecto_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->where('RR.sucursal_id',  $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
	    if($intProspectoID > 0)
	    {
	   		$this->db->where('OR.prospecto_id', $intProspectoID);
	    }	
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(RR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('RR.estatus', $strEstatus);
		}

		$this->db->where("((RR.folio LIKE '%$strBusqueda%') OR
							(OR.folio LIKE '%$strBusqueda%') OR
							(C.nombre_comercial LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))"); 
		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL,$strEstatus, $strBusqueda = NULL,
		                   $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('RR.sucursal_id',  $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('OR.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {	   		
	   	     $this->db->where("(DATE_FORMAT(RR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('RR.estatus', $strEstatus);
		}

		$this->db->where("((RR.folio LIKE '%$strBusqueda%') OR
							(OR.folio LIKE '%$strBusqueda%') OR
							(C.nombre_comercial LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))"); 

		$this->db->from('requisiciones_refacciones AS RR');
	    $this->db->join('sat_monedas AS M', 'RR.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('ordenes_reparacion AS OR', 'RR.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
	    $this->db->join('prospectos AS P', 'OR.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sat_paises AS PP', 'EP.pais_id = PP.pais_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("RR.requisicion_refacciones_id, RR.folio, DATE_FORMAT(RR.fecha,'%d/%m/%Y') AS fecha, 
						   RR.estatus, OR.folio AS folio_orden_reparacion, OR.estatus AS estatus_orden_reparacion, 
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' THEN C.nombre_comercial
								    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   END AS prospecto", FALSE);
		$this->db->from('requisiciones_refacciones AS RR');
	    $this->db->join('sat_monedas AS M', 'RR.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('ordenes_reparacion AS OR', 'RR.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
	    $this->db->join('prospectos AS P', 'OR.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sat_paises AS PP', 'EP.pais_id = PP.pais_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->where('RR.sucursal_id',  $this->session->userdata('sucursal_id'));
	    //Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('OR.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {	   		
	   	     $this->db->where("(DATE_FORMAT(RR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('RR.estatus', $strEstatus);
		}

		$this->db->where("((RR.folio LIKE '%$strBusqueda%') OR
							(OR.folio LIKE '%$strBusqueda%') OR
							(C.nombre_comercial LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))"); 
		$this->db->order_by('RR.fecha DESC, RR.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["requisiciones"] =$this->db->get()->result();
		return $arrResultado;
	}

	/*Método para regresar los registros activos y parcialmente surtidos que coincidan 
	  con el criterio de búsqueda proporcionado
	*/
	public function autocomplete($strDescripcion)
	{
		$this->db->select(' RR.requisicion_refacciones_id, RR.folio');
        $this->db->from('requisiciones_refacciones AS RR');
        $this->db->join('ordenes_reparacion AS OREP', 'RR.orden_reparacion_id = OREP.orden_reparacion_id', 'inner');
	    $this->db->where('RR.sucursal_id',  $this->session->userdata('sucursal_id'));
	    $this->db->where('OREP.estatus', 'ACTIVO');
	    $this->db->where("(RR.estatus = 'ACTIVO' OR RR.estatus = 'PARCIALMENTE SURTIDO')");
        $this->db->where("(RR.folio LIKE '%$strDescripcion%')");  
        $this->db->order_by("RR.folio",'DESC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla requisiciones_refacciones_detalles
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
		$arrPreciosUnitarios = explode("|", $objRequisicionRefacciones->strPreciosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objRequisicionRefacciones->strDescuentosUnitarios);
		$arrTasaCuotaIva = explode("|", $objRequisicionRefacciones->strTasaCuotaIva);
		$arrIvasUnitarios = explode("|", $objRequisicionRefacciones->strIvasUnitarios);
		$arrTasaCuotaIeps = explode("|", $objRequisicionRefacciones->strTasaCuotaIeps);
		$arrIepsUnitarios = explode("|", $objRequisicionRefacciones->strIepsUnitarios);

	
		//Hacer recorrido para insertar los datos en la tabla requisiciones_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);

			//Asignar datos al array
			$arrDatos = array('requisicion_refacciones_id' => $objRequisicionRefacciones->intRequisicionRefaccionesID,
							  'renglon' => ($intCon + 1),
							  'refaccion_id' => $arrRefaccionID[$intCon], 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $arrCantidades[$intCon],
							  'precio_unitario' => $arrPreciosUnitarios[$intCon],
							  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva_unitario' => $arrIvasUnitarios[$intCon], 
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps_unitario' => $arrIepsUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('requisiciones_refacciones_detalles', $arrDatos);
			
		}
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_precios_detalles(stdClass $objRequisicionRefacciones)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		/*Quitar | de la lista para obtener el ID de la refacción y 
		 precio unitario
		*/
		$arrRenglon = explode("|", $objRequisicionRefacciones->strRenglon);
		$arrRefaccionID = explode("|", $objRequisicionRefacciones->strRefaccionID);
		$arrPreciosUnitarios = explode("|", $objRequisicionRefacciones->strPreciosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objRequisicionRefacciones->strDescuentosUnitarios);
		$arrIvasUnitarios = explode("|", $objRequisicionRefacciones->strIvasUnitarios);
		$arrIepsUnitarios = explode("|", $objRequisicionRefacciones->strIepsUnitarios);

		//Hacer recorrido para insertar los datos en la tabla requisiciones_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle
			$intRenglon = $arrRenglon[$intCon];
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intPrecioUnitario = $arrPreciosUnitarios[$intCon];

			//Tabla requisiciones_refacciones_detalles
			//Asignar datos al array
			$arrDatos = array('precio_unitario' => $intPrecioUnitario,
				 			  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
				 			  'iva_unitario' => $arrIvasUnitarios[$intCon],
				 			  'ieps_unitario' => $arrIepsUnitarios[$intCon]);
			$this->db->where('requisicion_refacciones_id', $objRequisicionRefacciones->intRequisicionRefaccionesID);
			$this->db->where('refaccion_id', $intRefaccionID);
			$this->db->where('renglon', $intRenglon);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('requisiciones_refacciones_detalles', $arrDatos);
			
			//Seleccionar los detalles de las salidas del taller que coinciden con la refacción de la requisición
			$otdSalidasTaller = $this->buscar_detalles_salidas_taller($objRequisicionRefacciones->intRequisicionRefaccionesID, 													      $intRefaccionID);

			//Si existen datos de las salidas por taller
			if($otdSalidasTaller)
			{
				//Recorremos el arreglo 
				foreach ($otdSalidasTaller as $arrSal)
				{
					//Tabla movimientos_refacciones_detalles
					$arrDatos = array('precio_unitario' => $intPrecioUnitario);
					$this->db->where('movimiento_refacciones_id', $arrSal->movimiento_refacciones_id);
					$this->db->where('renglon', $arrSal->renglon);
					$this->db->where('refaccion_id', $intRefaccionID);
					$this->db->limit(1);
					//Actualizar los datos del registro
					$this->db->update('movimientos_refacciones_detalles', $arrDatos);

				}
			}//Cierre de verificación de las salidas por taller

		}

		//Tabla requisiciones_refacciones
		//Asignar datos al array
		$arrDatos = array('fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objRequisicionRefacciones->intUsuarioID);
		$this->db->where('requisicion_refacciones_id', $objRequisicionRefacciones->intRequisicionRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('requisiciones_refacciones', $arrDatos);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}


	//Método para regresar los detalles de un registro
	public function buscar_detalles($intRequisicionRefaccionesID)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');

		$this->db->select("RRD.renglon, RRD.refaccion_id, RRD.codigo, RRD.descripcion, RRD.codigo_linea, 
						   RRD.cantidad, RRD.precio_unitario, RRD.descuento_unitario,
						   RRD.tasa_cuota_iva, RRD.iva_unitario,
						   RRD.tasa_cuota_ieps, RRD.ieps_unitario,
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps, 
						   IFNULL(RI.actual_costo, 0) AS actual_costo", FALSE);
		$this->db->from('requisiciones_refacciones_detalles AS RRD');
		$this->db->join('sat_tasa_cuota AS TIva', 'RRD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'RRD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('refacciones_inventario AS RI', 'RRD.refaccion_id = RI.refaccion_id 
						 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(NOW())', 'left');
		$this->db->where('RRD.requisicion_refacciones_id', $intRequisicionRefaccionesID);
		$this->db->order_by('RRD.renglon', 'ASC');
		return $this->db->get()->result();
	}

	//Función que se utiliza para regresar los detalles de los movimientos de las salidas por taller de una requisición de refacciones
	public function buscar_detalles_salidas_taller($intRequisicionRefaccionesID, $intRefaccionID)
    {
    	//Constante para identificar al tipo de movimiento salida de refacciones por  taller
		$intMovSalidaTaller = SALIDA_REFACCIONES_TALLER;

	    $this->db->select('MRD.movimiento_refacciones_id, MRD.renglon');
	    $this->db->from('movimientos_refacciones_detalles AS MRD');
		$this->db->join('movimientos_refacciones AS MR', 'MRD.movimiento_refacciones_id = MR.movimiento_refacciones_id', 'inner');
		$this->db->join('requisiciones_refacciones AS RR', 'MR.referencia_id = RR.requisicion_refacciones_id', 'inner');
		$this->db->join('requisiciones_refacciones_detalles AS RRD', 
						'RR.requisicion_refacciones_id = RRD.requisicion_refacciones_id
						 AND MRD.refaccion_id = RRD.refaccion_id AND MRD.renglon = RRD.renglon', 'inner');
		$this->db->where('MR.tipo_movimiento', $intMovSalidaTaller);
		$this->db->where('RR.requisicion_refacciones_id', $intRequisicionRefaccionesID);
		$this->db->where('MRD.refaccion_id', $intRefaccionID);
		return $this->db->get()->result();
    }

}	
?>