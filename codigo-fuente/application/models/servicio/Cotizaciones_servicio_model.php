<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Cotizaciones_servicio_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla cotizaciones_servicio
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objCotizacionServicio)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		//Tabla cotizaciones_servicio
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objCotizacionServicio->strFolio); 

		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objCotizacionServicio->intSucursalID,
			              'folio' => $strFolioConsecutivo, 
						  'fecha' => $objCotizacionServicio->dteFecha, 
						  'moneda_id' => $objCotizacionServicio->intMonedaID, 
						  'tipo_cambio' => $objCotizacionServicio->intTipoCambio, 
						  'prospecto_id' => $objCotizacionServicio->intProspectoID, 
						  'equipo_tipo_id' => $objCotizacionServicio->intEquipoTipoID,
						  'servicio_tipo_id' => $objCotizacionServicio->intServicioTipoID,
						  'madurez' => $objCotizacionServicio->strMadurez,
						  'estrategia_id' => $objCotizacionServicio->intEstrategiaID,
						  'gastos_servicio' => $objCotizacionServicio->intGastosServicio,
						  'gastos_servicio_iva' => $objCotizacionServicio->intGastosServicioIva,
						  'observaciones' => $objCotizacionServicio->strObservaciones,
						  'notas' => $objCotizacionServicio->strNotas,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objCotizacionServicio->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('cotizaciones_servicio', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objCotizacionServicio->intCotizacionServicioID = $this->db->insert_id();

		//Hacer un llamado al método para guardar servicios de mano de obra de la cotización
		$this->guardar_mano_obra($objCotizacionServicio);

		//Hacer un llamado al método para guardar las refacciones de la cotización
		$this->guardar_refacciones($objCotizacionServicio);

		//Hacer un llamado al método para guardar los trabajos foráneos de la cotización
		$this->guardar_trabajos_foraneos($objCotizacionServicio);
		
		//Hacer un llamado al método para guardar otros servicios de la cotización
		$this->guardar_otros($objCotizacionServicio);


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
	public function modificar(stdClass $objCotizacionServicio)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla cotizaciones_servicio
		//Asignar datos al array
		$arrDatos = array('fecha' => $objCotizacionServicio->dteFecha, 
						  'moneda_id' => $objCotizacionServicio->intMonedaID, 
						  'tipo_cambio' => $objCotizacionServicio->intTipoCambio, 
						  'prospecto_id' => $objCotizacionServicio->intProspectoID, 
						  'equipo_tipo_id' => $objCotizacionServicio->intEquipoTipoID,
						  'servicio_tipo_id' => $objCotizacionServicio->intServicioTipoID,
						  'madurez' => $objCotizacionServicio->strMadurez,
						  'estrategia_id' => $objCotizacionServicio->intEstrategiaID,
						  'gastos_servicio' => $objCotizacionServicio->intGastosServicio,
						  'gastos_servicio_iva' => $objCotizacionServicio->intGastosServicioIva,
						  'observaciones' => $objCotizacionServicio->strObservaciones,
						  'notas' => $objCotizacionServicio->strNotas,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objCotizacionServicio->intUsuarioID);
		$this->db->where('cotizacion_servicio_id', $objCotizacionServicio->intCotizacionServicioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('cotizaciones_servicio', $arrDatos);

		//Eliminar los servicios de mano de obra guardados
		$this->db->where('cotizacion_servicio_id', $objCotizacionServicio->intCotizacionServicioID);
		$this->db->delete('cotizaciones_servicio_mano_obra');

		//Eliminar las refacciones guardadas
		$this->db->where('cotizacion_servicio_id', $objCotizacionServicio->intCotizacionServicioID);
		$this->db->delete('cotizaciones_servicio_refacciones');
		
		//Eliminar los trabajos foráneos guardados
		$this->db->where('cotizacion_servicio_id', $objCotizacionServicio->intCotizacionServicioID);
		$this->db->delete('cotizaciones_servicio_trabajos_foraneos');

		//Eliminar los otros servicios guardados
		$this->db->where('cotizacion_servicio_id', $objCotizacionServicio->intCotizacionServicioID);
		$this->db->delete('cotizaciones_servicio_otros');
		
		//Hacer un llamado al método para guardar servicios de mano de obra de la cotización
		$this->guardar_mano_obra($objCotizacionServicio);

		//Hacer un llamado al método para guardar las refacciones de la cotización
		$this->guardar_refacciones($objCotizacionServicio);

		//Hacer un llamado al método para guardar los trabajos foráneos de la cotización
		$this->guardar_trabajos_foraneos($objCotizacionServicio);
		
		//Hacer un llamado al método para guardar otros servicios de la cotización
		$this->guardar_otros($objCotizacionServicio);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intCotizacionServicioID, $strEstatus)
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
		$this->db->where('cotizacion_servicio_id', $intCotizacionServicioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('cotizaciones_servicio', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intCotizacionServicioID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{

		$this->db->select("CS.cotizacion_servicio_id, CS.folio, 
						   DATE_FORMAT(CS.fecha,'%d/%m/%Y') AS fecha,
					       CS.moneda_id, CS.tipo_cambio, CS.prospecto_id,
					       CS.equipo_tipo_id, CS.servicio_tipo_id,
					       CS.madurez, CS.estrategia_id, CS.gastos_servicio,
					       CS.gastos_servicio_iva, CS.observaciones, CS.notas,
					       CS.estatus, M.codigo AS codigo_moneda,
					       CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, 
					       ET.descripcion AS equipo_tipo, ST.descripcion AS servicio_tipo, 
					       E.descripcion AS estrategia,
					       CASE 
							   WHEN  C.estatus = 'ACTIVO' THEN C.razon_social
								    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   END AS prospecto,
						  C.servicio_lista_precio_id,
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' THEN C.correo_electronico
								    ELSE P.correo_electronico 
						   END AS correo_electronico, 
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' THEN C.contacto_correo_electronico
								    ELSE P.contacto_correo_electronico 
						   END AS contacto_correo_electronico, 
						   P.telefono_principal,  P.calle, P.numero_exterior, P.numero_interior, 
						   P.colonia, L.descripcion AS localidad, MP.descripcion AS municipio, EP.descripcion AS estado,
						   CP.codigo_postal,  C.rfc, C.razon_social, C.refacciones_credito_dias, 
						   C.refacciones_lista_precio_id, C.razon_social AS cliente, 
						   C.estatus  AS cliente_estatus, C.telefono_principal AS cliente_telefono_principal, 
						   C.calle AS cliente_calle, C.numero_exterior AS cliente_numero_exterior, 
						   C.numero_interior AS cliente_numero_interior,  CCP.codigo_postal AS cliente_codigo_postal,
						   C.colonia AS cliente_colonia, C.localidad AS cliente_localidad, 
						   MC.descripcion AS cliente_municipio,  EC.descripcion AS cliente_estado,
						   PC.descripcion AS cliente_pais,
					      UC.usuario AS usuario_creacion, 
					      DATE_FORMAT(CS.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
	    $this->db->from('cotizaciones_servicio AS CS');
	    $this->db->join('sat_monedas AS M', 'M.moneda_id = CS.moneda_id', 'inner');
	    $this->db->join('equipos_tipos AS ET', 'ET.equipo_tipo_id = CS.equipo_tipo_id', 'inner');
		$this->db->join('servicios_tipos AS ST', 'ST.servicio_tipo_id = CS.servicio_tipo_id', 'inner');
		$this->db->join('estrategias AS E', 'E.estrategia_id = CS.estrategia_id', 'inner');
	    $this->db->join('prospectos AS P', 'CS.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('sat_codigos_postales AS CCP', 'C.codigo_postal_id = CCP.codigo_postal_id', 'left');
		$this->db->join('municipios AS MC', 'C.municipio_id = MC.municipio_id', 'left');
		$this->db->join('sat_estados AS EC', 'MC.estado_id = EC.estado_id', 'left');
		$this->db->join('sat_paises AS PC', 'EC.pais_id = PC.pais_id', 'left');
		$this->db->join('usuarios AS UC', 'CS.usuario_creacion = UC.usuario_id', 'left');
		
		//Si existe id de la cotización de servicio
		if ($intCotizacionServicioID !== NULL)
		{   
			$this->db->where('CS.cotizacion_servicio_id', $intCotizacionServicioID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('CS.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('CS.prospecto_id', $intProspectoID);
		    }

		    //Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(CS.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('CS.estatus', $strEstatus);
			}

			$this->db->where("((CS.folio LIKE '%$strBusqueda%') OR
							   (C.razon_social LIKE '%$strBusqueda%') OR
							   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
				               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('CS.fecha DESC, CS.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						  					 $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('cotizaciones_servicio CS');
	    $this->db->join('sat_monedas M', 'M.moneda_id = CS.moneda_id', 'inner');
	    $this->db->join('equipos_tipos ET', 'ET.equipo_tipo_id = CS.equipo_tipo_id', 'inner');
		$this->db->join('servicios_tipos ST', 'ST.servicio_tipo_id = CS.servicio_tipo_id', 'inner');
		$this->db->join('estrategias E', 'E.estrategia_id = CS.estrategia_id', 'inner');
	    $this->db->join('prospectos P', 'P.prospecto_id = CS.prospecto_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->where('CS.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
	    if($intProspectoID > 0)
	    {
	   		$this->db->where('CS.prospecto_id', $intProspectoID);
	    }

	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(CS.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('CS.estatus', $strEstatus);
		}

		$this->db->where("((CS.folio LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%') OR
						   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))");
		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL, 
						   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('CS.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
	    if($intProspectoID > 0)
	    {
	   		$this->db->where('CS.prospecto_id', $intProspectoID);
	    }

	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(CS.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('CS.estatus', $strEstatus);
		}

		$this->db->where("((CS.folio LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%') OR
						   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))");

		$this->db->from('cotizaciones_servicio CS');
	    $this->db->join('sat_monedas M', 'M.moneda_id = CS.moneda_id', 'inner');
	    $this->db->join('equipos_tipos ET', 'ET.equipo_tipo_id = CS.equipo_tipo_id', 'inner');
		$this->db->join('servicios_tipos ST', 'ST.servicio_tipo_id = CS.servicio_tipo_id', 'inner');
		$this->db->join('estrategias E', 'E.estrategia_id = CS.estrategia_id', 'inner');
	    $this->db->join('prospectos P', 'P.prospecto_id = CS.prospecto_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CS.cotizacion_servicio_id, CS.folio, 
						   DATE_FORMAT(CS.fecha,'%d/%m/%Y') AS fecha, CS.estatus,
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' THEN C.razon_social
								    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   END AS prospecto", FALSE);
		$this->db->from('cotizaciones_servicio CS');
	    $this->db->join('sat_monedas M', 'M.moneda_id = CS.moneda_id', 'inner');
	    $this->db->join('equipos_tipos ET', 'ET.equipo_tipo_id = CS.equipo_tipo_id', 'inner');
		$this->db->join('servicios_tipos ST', 'ST.servicio_tipo_id = CS.servicio_tipo_id', 'inner');
		$this->db->join('estrategias E', 'E.estrategia_id = CS.estrategia_id', 'inner');
	    $this->db->join('prospectos P', 'P.prospecto_id = CS.prospecto_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->where('CS.sucursal_id', $this->session->userdata('sucursal_id'));
	    //Si existe id del prospecto
	    if($intProspectoID > 0)
	    {
	   		$this->db->where('CS.prospecto_id', $intProspectoID);
	    }

	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(CS.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('CS.estatus', $strEstatus);
		}

		$this->db->where("((CS.folio LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%') OR
						   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))");

		$this->db->order_by('CS.fecha DESC, CS.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["cotizaciones"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*******************************************************************************************************************
	Funciones de la tabla cotizaciones_servicio_mano_obra
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los servicios de mano de obra de la cotización
	public function guardar_mano_obra(stdClass $objCotizacionServicio)
	{
		//Si existen servicios de mano de obra
		if($objCotizacionServicio->strServicioIDMO != '')
		{
			/*Quitar | de la lista para obtener el ID del servicio, código, descripción, hora, precio unitario,
			 descuento unitario, iva unitario e ieps unitario
			*/
			$arrServicioID = explode("|", $objCotizacionServicio->strServicioIDMO);
			$arrCodigos = explode("|", $objCotizacionServicio->strCodigosMO);
			$arrDescripciones = explode("|", $objCotizacionServicio->strDescripcionesMO);
			$arrHoras = explode("|", $objCotizacionServicio->strHorasMO);
			$arrPreciosUnitarios = explode("|", $objCotizacionServicio->strPreciosUnitariosMO);
			$arrDescuentosUnitarios = explode("|", $objCotizacionServicio->strDescuentosUnitariosMO);
			$arrTasaCuotaIva = explode("|", $objCotizacionServicio->strTasaCuotaIvaMO);
			$arrIvasUnitarios = explode("|", $objCotizacionServicio->strIvasUnitariosMO);
			$arrTasaCuotaIeps = explode("|", $objCotizacionServicio->strTasaCuotaIepsMO);
			$arrIepsUnitarios = explode("|", $objCotizacionServicio->strIepsUnitariosMO);

			//Hacer recorrido para insertar los datos en la tabla cotizaciones_servicio_mano_obra
			for ($intCon = 0; $intCon < sizeof($arrServicioID); $intCon++) 
			{
				//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
				$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
							   	  	  $arrTasaCuotaIeps[$intCon] : NULL);

				//Asignar datos al array
				$arrDatos = array('cotizacion_servicio_id' => $objCotizacionServicio->intCotizacionServicioID,
								  'renglon' => ($intCon + 1),
								  'servicio_id' => $arrServicioID[$intCon], 
								  'codigo' => $arrCodigos[$intCon],
								  'descripcion' => $arrDescripciones[$intCon],
								  'horas' => $arrHoras[$intCon],
								  'precio_unitario' => $arrPreciosUnitarios[$intCon],
								  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
								  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
								  'iva_unitario' => $arrIvasUnitarios[$intCon], 
								  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
								  'ieps_unitario' => $arrIepsUnitarios[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('cotizaciones_servicio_mano_obra', $arrDatos);
			}
		}
		
	}

	//Método para regresar los servicios de mano de obra de un registro
	public function buscar_mano_obra($intCotizacionServicioID)
	{
		$this->db->select('CSMO.renglon, CSMO.servicio_id,
						   CSMO.codigo, CSMO.descripcion, CSMO.horas, 
						   CSMO.precio_unitario, CSMO.descuento_unitario, 
						   CSMO.tasa_cuota_iva, CSMO.iva_unitario, 
						   CSMO.tasa_cuota_ieps, CSMO.ieps_unitario,
						   S.descripcion AS servicio, 
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps');
		$this->db->from('cotizaciones_servicio_mano_obra AS CSMO');
		$this->db->join('servicios AS S', 'CSMO.servicio_id = S.servicio_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'CSMO.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'CSMO.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('CSMO.cotizacion_servicio_id', $intCotizacionServicioID);
		$this->db->order_by('CSMO.renglon', 'ASC');
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla cotizaciones_servicio_refacciones
	*********************************************************************************************************************/
	//Función que se utiliza para guardar las refacciones de la cotización
	public function guardar_refacciones(stdClass $objCotizacionServicio)
	{
		//Si existen refacciones
		if($objCotizacionServicio->strRefaccionIDRefacciones != '')
		{
			/*Quitar | de la lista para obtener el ID de la refacción, código, descripción, cantidad, 
			  precio unitario, descuento unitario, iva unitario e ieps unitario
			*/
			$arrRefaccionID = explode("|", $objCotizacionServicio->strRefaccionIDRefacciones);
			$strCodigos = explode("|", $objCotizacionServicio->strCodigosRefacciones);
			$arrDescripciones = explode("|", $objCotizacionServicio->strDescripcionesRefacciones);
			$arrCantidades = explode("|", $objCotizacionServicio->strCantidadesRefacciones);
			$arrPreciosUnitarios = explode("|", $objCotizacionServicio->strPreciosUnitariosRefacciones);
			$arrDescuentosUnitarios = explode("|", $objCotizacionServicio->strDescuentosUnitariosRefacciones);
			$arrTasaCuotaIva = explode("|", $objCotizacionServicio->strTasaCuotaIvaRefacciones);
			$arrIvasUnitarios = explode("|", $objCotizacionServicio->strIvasUnitariosRefacciones);
			$arrTasaCuotaIeps = explode("|", $objCotizacionServicio->strTasaCuotaIepsRefacciones);
			$arrIepsUnitarios = explode("|", $objCotizacionServicio->strIepsUnitariosRefacciones);

			//Hacer recorrido para insertar los datos en la tabla cotizaciones_servicio_refacciones
			for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
			{

				//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
				$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);

				//Asignar datos al array
				$arrDatos = array('cotizacion_servicio_id' => $objCotizacionServicio->intCotizacionServicioID,
								  'renglon' => ($intCon + 1),
								  'refaccion_id' => $arrRefaccionID[$intCon], 
								  'codigo' => $strCodigos[$intCon],
								  'descripcion' => $arrDescripciones[$intCon],
								  'cantidad' => $arrCantidades[$intCon],
								  'precio_unitario' => $arrPreciosUnitarios[$intCon],
								  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
								  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  	  'iva_unitario' => $arrIvasUnitarios[$intCon], 
							 	  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  	  'ieps_unitario' => $arrIepsUnitarios[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('cotizaciones_servicio_refacciones', $arrDatos);
			}
		}
	}

	//Método para regresar las refacciones de un registro
	public function buscar_refacciones($intCotizacionServicioID)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');

		$this->db->select("CSR.renglon, CSR.refaccion_id,
						   CSR.codigo, CSR.descripcion, CSR.cantidad, 
						   CSR.precio_unitario, CSR.descuento_unitario, 
						   CSR.tasa_cuota_iva, CSR.iva_unitario, 
						   CSR.tasa_cuota_ieps, CSR.ieps_unitario, 
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps, 
						   IFNULL(RI.actual_costo, 0) AS actual_costo", FALSE);
		$this->db->from('cotizaciones_servicio_refacciones AS CSR');
		$this->db->join('sat_tasa_cuota AS TIva', 'CSR.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'CSR.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('refacciones_inventario AS RI', 'CSR.refaccion_id = RI.refaccion_id 
						 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(NOW())', 'left');
		$this->db->where('CSR.cotizacion_servicio_id', $intCotizacionServicioID);
		$this->db->order_by('CSR.renglon', 'ASC');
		return $this->db->get()->result();
	}


	/*******************************************************************************************************************
	Funciones de la tabla cotizaciones_servicio_trabajos_foraneos
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los trabajos foráneos de la cotización
	public function guardar_trabajos_foraneos(stdClass $objCotizacionServicio)
	{
		//Si existen trabajos foráneos
		if($objCotizacionServicio->strConceptosTF != '')
		{
			/*Quitar | de la lista para obtener el concepto, cantidad, 
			  precio unitario, descuento unitario, iva unitario e ieps unitario
			*/
			$arrConceptos = explode("|", $objCotizacionServicio->strConceptosTF);
			$arrCantidades = explode("|", $objCotizacionServicio->strCantidadesTF);
			$arrPreciosUnitarios = explode("|", $objCotizacionServicio->strPreciosUnitariosTF);
			$arrDescuentosUnitarios = explode("|", $objCotizacionServicio->strDescuentosUnitariosTF);
			$arrTasaCuotaIva = explode("|", $objCotizacionServicio->strTasaCuotaIvaTF);
			$arrIvasUnitarios = explode("|", $objCotizacionServicio->strIvasUnitariosTF);
			$arrTasaCuotaIeps = explode("|", $objCotizacionServicio->strTasaCuotaIepsTF);
			$arrIepsUnitarios = explode("|", $objCotizacionServicio->strIepsUnitariosTF);

			//Hacer recorrido para insertar los datos en la tabla cotizaciones_servicio_trabajos_foraneos
			for ($intCon = 0; $intCon < sizeof($arrConceptos); $intCon++) 
			{
				//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
				$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  	  $arrTasaCuotaIeps[$intCon] : NULL);

				//Asignar datos al array
				$arrDatos = array('cotizacion_servicio_id' => $objCotizacionServicio->intCotizacionServicioID,
								  'renglon' => ($intCon + 1),
								  'concepto' => $arrConceptos[$intCon],
								  'cantidad' => $arrCantidades[$intCon],
								  'precio_unitario' => $arrPreciosUnitarios[$intCon],
								  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
								  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
								  'iva_unitario' => $arrIvasUnitarios[$intCon], 
								  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
								  'ieps_unitario' => $arrIepsUnitarios[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('cotizaciones_servicio_trabajos_foraneos', $arrDatos);
			}
		}
	}

	//Método para regresar los trabajos foráneos de un registro
	public function buscar_trabajos_foraneos($intCotizacionServicioID)
	{
		$this->db->select('CSTF.renglon, CSTF.concepto, CSTF.cantidad, 
						   CSTF.precio_unitario, CSTF.descuento_unitario, 
						   CSTF.tasa_cuota_iva, CSTF.iva_unitario, 
						   CSTF.tasa_cuota_ieps, CSTF.ieps_unitario, 
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps');
		$this->db->from('cotizaciones_servicio_trabajos_foraneos AS CSTF');
		$this->db->join('sat_tasa_cuota AS TIva', 'CSTF.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'CSTF.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('CSTF.cotizacion_servicio_id', $intCotizacionServicioID);
		$this->db->order_by('CSTF.renglon', 'ASC');
		return $this->db->get()->result();
	}


	/*******************************************************************************************************************
	Funciones de la tabla cotizaciones_servicio_otros
	*********************************************************************************************************************/
	//Función que se utiliza para guardar otros servicios de la cotización
	public function guardar_otros(stdClass $objCotizacionServicio)
	{
		
		//Si existen otros servicios
		if($objCotizacionServicio->strConceptosOtros != '')
		{
			/*Quitar | de la lista para obtener el concepto, cantidad, 
			  precio unitario, descuento unitario, iva unitario e ieps unitario
			*/
			$arrConceptos = explode("|", $objCotizacionServicio->strConceptosOtros);
			$arrCantidades = explode("|", $objCotizacionServicio->strCantidadesOtros);
			$arrPreciosUnitarios = explode("|", $objCotizacionServicio->strPreciosUnitariosOtros);
			$arrDescuentosUnitarios = explode("|", $objCotizacionServicio->strDescuentosUnitariosOtros);
			$arrTasaCuotaIva = explode("|", $objCotizacionServicio->strTasaCuotaIvaOtros);
			$arrIvasUnitarios = explode("|", $objCotizacionServicio->strIvasUnitariosOtros);
			$arrTasaCuotaIeps = explode("|", $objCotizacionServicio->strTasaCuotaIepsOtros);
			$arrIepsUnitarios = explode("|", $objCotizacionServicio->strIepsUnitariosOtros);

			//Hacer recorrido para insertar los datos en la tabla cotizaciones_servicio_otros
			for ($intCon = 0; $intCon < sizeof($arrConceptos); $intCon++) 
			{
				//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
				$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  	  $arrTasaCuotaIeps[$intCon] : NULL);

				//Asignar datos al array
				$arrDatos = array('cotizacion_servicio_id' => $objCotizacionServicio->intCotizacionServicioID,
								  'renglon' => ($intCon + 1),
								  'concepto' => $arrConceptos[$intCon],
								  'cantidad' => $arrCantidades[$intCon],
								  'precio_unitario' => $arrPreciosUnitarios[$intCon],
								  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
								  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
								  'iva_unitario' => $arrIvasUnitarios[$intCon], 
								  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
								  'ieps_unitario' => $arrIepsUnitarios[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('cotizaciones_servicio_otros', $arrDatos);
			}
		}
		
	}

	//Método para regresar los otros servicios de un registro
	public function buscar_otros($intCotizacionServicioID)
	{
		$this->db->select('CSO.renglon, CSO.concepto, CSO.cantidad, 
						   CSO.precio_unitario, CSO.descuento_unitario, 
						   CSO.tasa_cuota_iva, CSO.iva_unitario, 
						   CSO.tasa_cuota_ieps, CSO.ieps_unitario, 
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps');
		$this->db->from('cotizaciones_servicio_otros AS CSO');
		$this->db->join('sat_tasa_cuota AS TIva', 'CSO.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'CSO.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('CSO.cotizacion_servicio_id', $intCotizacionServicioID);
		$this->db->order_by('CSO.renglon', 'ASC');
		return $this->db->get()->result();
	}
}	
?>