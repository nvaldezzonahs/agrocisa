<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de mensajes (para guardar el mensaje que se envía a los usuarios)
include_once(APPPATH . 'models/administracion/Mensajes_model.php');
//Incluir la clase modelo de descripciones de maquinaria (para verificar si tiene componentes antes de realizar un Pedido)
include_once(APPPATH . 'models/maquinaria/Maquinaria_descripciones_model.php');

class Cotizaciones_maquinaria_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla cotizaciones_maquinaria
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objCotizacionMaquinaria)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        

		//Tabla cotizaciones_maquinaria
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objCotizacionMaquinaria->strFolio); 

		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objCotizacionMaquinaria->intSucursalID, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objCotizacionMaquinaria->dteFecha, 
						  'moneda_id' => $objCotizacionMaquinaria->intMonedaID, 
						  'tipo_cambio' => $objCotizacionMaquinaria->intTipoCambio, 
						  'prospecto_id' => $objCotizacionMaquinaria->intProspectoID, 
						  'vendedor_id' => $objCotizacionMaquinaria->intVendedorID, 
						  'madurez' => $objCotizacionMaquinaria->strMadurez,
						  'estrategia_id' => $objCotizacionMaquinaria->intEstrategiaID,
						  'observaciones' => $objCotizacionMaquinaria->strObservaciones, 
						  'notas' => $objCotizacionMaquinaria->strNotas, 
						  'maquinaria_descripcion_id' => $objCotizacionMaquinaria->intMaquinariaDescripcionID,
						  'codigo' => $objCotizacionMaquinaria->strCodigo,
						  'descripcion_corta' => $objCotizacionMaquinaria->strDescripcionCorta,
						  'descripcion' => $objCotizacionMaquinaria->strDescripcion,
						  'precio' => $objCotizacionMaquinaria->intPrecio,
						  'descuento' => $objCotizacionMaquinaria->intDescuento,
						  'tasa_cuota_iva' => $objCotizacionMaquinaria->intTasaCuotaIva,
						  'iva' => $objCotizacionMaquinaria->intIva,
						  'tasa_cuota_ieps' => $objCotizacionMaquinaria->intTasaCuotaIeps,
						  'ieps' => $objCotizacionMaquinaria->intIeps,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objCotizacionMaquinaria->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('cotizaciones_maquinaria', $arrDatos);

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
	public function modificar(stdClass $objCotizacionMaquinaria)
	{

		//Asignar datos al array
		$arrDatos = array('fecha' => $objCotizacionMaquinaria->dteFecha, 
						  'moneda_id' => $objCotizacionMaquinaria->intMonedaID, 
						  'tipo_cambio' => $objCotizacionMaquinaria->intTipoCambio, 
						  'prospecto_id' => $objCotizacionMaquinaria->intProspectoID, 
						  'vendedor_id' => $objCotizacionMaquinaria->intVendedorID, 
						  'madurez' => $objCotizacionMaquinaria->strMadurez,
						  'estrategia_id' => $objCotizacionMaquinaria->intEstrategiaID,
						  'observaciones' => $objCotizacionMaquinaria->strObservaciones, 
						  'notas' => $objCotizacionMaquinaria->strNotas, 
						  'maquinaria_descripcion_id' => $objCotizacionMaquinaria->intMaquinariaDescripcionID,
						  'codigo' => $objCotizacionMaquinaria->strCodigo,
						  'descripcion_corta' => $objCotizacionMaquinaria->strDescripcionCorta,
						  'descripcion' => $objCotizacionMaquinaria->strDescripcion,
						  'precio' => $objCotizacionMaquinaria->intPrecio,
						  'descuento' => $objCotizacionMaquinaria->intDescuento,
						  'tasa_cuota_iva' => $objCotizacionMaquinaria->intTasaCuotaIva,
						  'iva' => $objCotizacionMaquinaria->intIva,
						  'tasa_cuota_ieps' => $objCotizacionMaquinaria->intTasaCuotaIeps,
						  'ieps' => $objCotizacionMaquinaria->intIeps,
						  'estatus' => 'ACTIVO', 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objCotizacionMaquinaria->intUsuarioID);
		$this->db->where('cotizacion_maquinaria_id', $objCotizacionMaquinaria->intCotizacionMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('cotizaciones_maquinaria', $arrDatos);
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intCotizacionMaquinariaID, $strEstatus)
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
		$this->db->where('cotizacion_maquinaria_id', $intCotizacionMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('cotizaciones_maquinaria', $arrDatos);
	}

	//Método para enviar a pedido los datos de un registro
	public function set_enviar_pedido($intCotizacionMaquinariaID, $strUsuarios, $strMensaje)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (Mensajes) 
        $otdModelMensajes = new  Mensajes_model();
		
		//Tabla cotizaciones_maquinaria
		//Asignar datos al array
		$arrDatos = array('estatus' => 'PEDIDO',
						  'fecha_pedido' => date("Y-m-d H:i:s"),
						  'usuario_pedido' => $this->session->userdata('usuario_id'));
		$this->db->where('cotizacion_maquinaria_id', $intCotizacionMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('cotizaciones_maquinaria', $arrDatos);

		//Tabla pedidos_maquinaria
		//Asignar folio consecutivo del Pedido
		$strFolioPedido = $this->get_folio_consecutivo_pedido();
		//Seleccionar los datos de la Cotización
		$otdCotizacion = $this->buscar($intCotizacionMaquinariaID);
		
		//Asignar datos al array
		$arrDatosPedido = array('sucursal_id' => $this->session->userdata('sucursal_id'), 
							    'folio' => $strFolioPedido,
								'fecha' => date("Y-m-d H:i:s"),
								'moneda_id' => $otdCotizacion->moneda_id,
								'tipo_cambio' => $otdCotizacion->tipo_cambio,
								'cotizacion_maquinaria_id' => $intCotizacionMaquinariaID,
								'prospecto_id' =>  $otdCotizacion->prospecto_id,
								'vendedor_id' =>  $otdCotizacion->vendedor_id,
								'observaciones' =>  $otdCotizacion->observaciones,
								'notas' =>  $otdCotizacion->notas,
								'maquinaria_descripcion_id' =>  $otdCotizacion->maquinaria_descripcion_id,
								'codigo' =>  $otdCotizacion->codigo,
								'descripcion_corta' =>  $otdCotizacion->descripcion_corta,
								'descripcion' =>  $otdCotizacion->descripcion,
								'precio' =>  $otdCotizacion->precio,
								'descuento' =>  $otdCotizacion->descuento,
								'tasa_cuota_iva' =>  $otdCotizacion->tasa_cuota_iva,
								'iva' =>  $otdCotizacion->iva,
								'tasa_cuota_ieps' =>  $otdCotizacion->tasa_cuota_ieps,
								'ieps' =>  $otdCotizacion->ieps,
								'fecha_creacion' => date("Y-m-d H:i:s"),
				  				'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
	    $this->db->insert('pedidos_maquinaria', $arrDatosPedido);

	    //ID del Pedido recien generado
	    $intPedidoMaquinariaID = $this->db->insert_id();

	    //Guardar componentes del Pedido
	    //Obtenemos el ID de la Maquinaria para solicitar el Pedido
		//Es necesario verificar si la Maquinaria cuenta con componentes adjuntos 
		//Se crea una instancia de la clase modelo (Maquinaria descripciones) 
        $otdMaquinariaDescripciones = new  Maquinaria_descripciones_model();
        //Seleccionar los componentes de la maquinaria
		$otdComponentesMaquinaria = $otdMaquinariaDescripciones->buscar_componentes($otdCotizacion->maquinaria_descripcion_id);
		//Si se encontraron componentes adjuntos
		if($otdComponentesMaquinaria){
			//Hacer un llamado al método para guardar componentes correspondientes a una maquinaria(en caso de que aplique)
			$this->guardar_componentes($intPedidoMaquinariaID, $otdComponentesMaquinaria);
		}

        //Hacer un llamado al método para guardar el mensaje que se envía a los usuarios
		$otdModelMensajes->guardar('COTIZACIONES DE MAQUINARIA', $intCotizacionMaquinariaID, 
									$strUsuarios, $strMensaje);
      
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
		
	}

	

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intCotizacionMaquinariaID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		$this->db->select("	CM.cotizacion_maquinaria_id, 
							CM.folio, 
							DATE_FORMAT(CM.fecha,'%d/%m/%Y') AS fecha,
							CM.fecha AS fecha_reporte, 
						   CM.moneda_id, CM.tipo_cambio, CM.prospecto_id, CM.vendedor_id, CM.madurez,
						   CM.estrategia_id, CM.observaciones, 
						   CM.notas, CM.estatus, CM.maquinaria_descripcion_id, CM.codigo, CM.descripcion_corta,
						   CM.descripcion, CM.precio, CM.descuento, CM.tasa_cuota_iva, CM.iva, 
						   CM.tasa_cuota_ieps, CM.ieps,  TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps, E.descripcion AS estrategia,
						   CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre) AS vendedor,
						   CONCAT(EMP.nombre, ' ', EMP.apellido_paterno, ' ', EMP.apellido_materno) AS nombre_vendedor,  
						   M.codigo AS codigo_moneda,
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' THEN C.razon_social
								    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   END AS prospecto, 
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' THEN C.correo_electronico
								    ELSE P.correo_electronico 
						   END AS correo_electronico, 
						   P.telefono_principal,  P.calle, P.numero_exterior, P.numero_interior, P.colonia,
						   P.referencia,  L.descripcion AS localidad, MP.descripcion AS municipio,
						   EP.descripcion AS estado, PP.descripcion AS pais,
						   CP.codigo_postal,  
						   C.rfc, C.razon_social AS cliente, C.estatus AS cliente_estatus,
					       C.telefono_principal AS cliente_telefono_principal, 
						   C.calle AS cliente_calle, C.numero_exterior AS cliente_numero_exterior, 
						   C.numero_interior AS cliente_numero_interior,  
						   CCP.codigo_postal AS cliente_codigo_postal,
						   C.colonia AS cliente_colonia, C.referencia AS cliente_referencia,
						   C.localidad AS cliente_localidad, 
						   MC.descripcion AS cliente_municipio,  EC.descripcion AS cliente_estado,
						   PPC.descripcion AS cliente_pais,
						   ML.descripcion AS maquinaria_linea ,MM.descripcion AS maquinaria_marca,
						   MMOD.descripcion AS maquinaria_modelo", FALSE);
	    $this->db->from('cotizaciones_maquinaria AS CM');
	    $this->db->join('sat_monedas AS M', 'CM.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('estrategias AS E', 'CM.estrategia_id = E.estrategia_id', 'inner');
	    $this->db->join('vendedores AS V', 'CM.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
		  $this->db->join('maquinaria_descripciones AS MD', 'CM.maquinaria_descripcion_id = MD.maquinaria_descripcion_id', 'inner');
	    $this->db->join('maquinaria_lineas AS ML', 'MD.maquinaria_linea_id = ML.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MM', 'MD.maquinaria_marca_id = MM.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'MD.maquinaria_modelo_id = MMOD.maquinaria_modelo_id', 'inner');
	    $this->db->join('prospectos AS P', 'CM.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sat_paises AS PP', 'EP.pais_id = PP.pais_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'CM.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'CM.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('sat_codigos_postales AS CCP', 'C.codigo_postal_id = CCP.codigo_postal_id', 'left');
		$this->db->join('municipios AS MC', 'C.municipio_id = MC.municipio_id', 'left');
		$this->db->join('sat_estados AS EC', 'MC.estado_id = EC.estado_id', 'left');
		$this->db->join('sat_paises AS PPC', 'EC.pais_id = PPC.pais_id', 'left');

	   
		//Si existe id de la cotización
		if ($intCotizacionMaquinariaID != NULL)
		{   
			$this->db->where('CM.cotizacion_maquinaria_id', $intCotizacionMaquinariaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('CM.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('CM.prospecto_id', $intProspectoID);
		    }

			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {		   		
		   		$this->db->where("CM.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('CM.estatus', $strEstatus);
			}

			$this->db->where("((CM.folio LIKE '%$strBusqueda%') OR
							   (C.razon_social LIKE '%$strBusqueda%') OR
	        				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
				               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('CM.folio DESC, CM.fecha DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
											 $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('cotizaciones_maquinaria AS CM');
		$this->db->join('prospectos AS P', 'CM.prospecto_id = P.prospecto_id', 'inner');		
		$this->db->join('sat_monedas AS M', 'CM.moneda_id = M.moneda_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->where('CM.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {		   		
	   		$this->db->where("CM.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('CM.estatus', $strEstatus);
		}

		$this->db->where("((CM.folio LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL,
						   $strEstatus = NULL, $strBusqueda = NULL,$intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('CM.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('CM.prospecto_id', $intProspectoID);
	    }

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {		   		
	   		$this->db->where("CM.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('CM.estatus', $strEstatus);
		}
		
		$this->db->where("((CM.folio LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))"); 

		
		$this->db->from('cotizaciones_maquinaria AS CM');
	    $this->db->join('sat_monedas AS M', 'CM.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('estrategias AS E', 'CM.estrategia_id = E.estrategia_id', 'inner');
	    $this->db->join('vendedores AS V', 'CM.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
		  $this->db->join('maquinaria_descripciones AS MD', 'CM.maquinaria_descripcion_id = MD.maquinaria_descripcion_id', 'inner');
	    $this->db->join('maquinaria_lineas AS ML', 'MD.maquinaria_linea_id = ML.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MM', 'MD.maquinaria_marca_id = MM.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'MD.maquinaria_modelo_id = MMOD.maquinaria_modelo_id', 'inner');
	    $this->db->join('prospectos AS P', 'CM.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sat_paises AS PP', 'EP.pais_id = PP.pais_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'CM.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CM.cotizacion_maquinaria_id, CM.folio, DATE_FORMAT(CM.fecha,'%d/%m/%Y') AS fecha, 
						   CM.estatus, 
						   CASE 
							   WHEN C.estatus = 'ACTIVO'  THEN C.razon_social
								    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   END AS prospecto", FALSE);
		$this->db->from('cotizaciones_maquinaria AS CM');
	    $this->db->join('sat_monedas AS M', 'CM.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('estrategias AS E', 'CM.estrategia_id = E.estrategia_id', 'inner');
	    $this->db->join('vendedores AS V', 'CM.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
		$this->db->join('maquinaria_descripciones AS MD', 'CM.maquinaria_descripcion_id = MD.maquinaria_descripcion_id', 'inner');
	    $this->db->join('maquinaria_lineas AS ML', 'MD.maquinaria_linea_id = ML.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MM', 'MD.maquinaria_marca_id = MM.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'MD.maquinaria_modelo_id = MMOD.maquinaria_modelo_id', 'inner');
	    $this->db->join('prospectos AS P', 'CM.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sat_paises AS PP', 'EP.pais_id = PP.pais_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'CM.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
	    $this->db->where('CM.sucursal_id', $this->session->userdata('sucursal_id'));
	    //Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('CM.prospecto_id', $intProspectoID);
	    }

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {		   		
	   		$this->db->where("CM.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('CM.estatus', $strEstatus);
		}


		$this->db->where("((CM.folio LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))"); 


		$this->db->order_by('CM.folio DESC, CM.fecha DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["cotizaciones"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*******************************************************************************************************************
	Funciones de la tabla pedidos_maquinaria
	*********************************************************************************************************************/
	//Función que se utiliza para regresar el folio consecutivo del pedido
	public function get_folio_consecutivo_pedido()
    {
   	    //Variable que se utiliza para asignar el folio consecutivo
	  	$strFolio = '';
   		//Seleccionar el folio máximo de la tabla pedidos_maquinaria
	    $this->db->select("IFNULL(MAX(folio),0) AS folio", FALSE);
		$this->db->from('pedidos_maquinaria');
		$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->limit(1);
		//Si existen datos
		if ($row = $this->db->get()->row()){
			//Asignar valor del folio
		    $strFolioMaximo = $row->folio;
			//Si el código máximo es igual a cero
			if($strFolioMaximo == 0)
		    {
		    	$intConsecutivo = 1;
		    }
		    else
		    {
		    	//Incrementar contador en uno
                $intConsecutivo =   ($strFolioMaximo + 1);

		    }
		}

	    //Concatenar al consecutivo el  incremento de ceros
        $strFolio = str_pad($intConsecutivo, 10, "0", STR_PAD_LEFT);

		//Regresar código consecutivo
		return $strFolio;
    }

    /*******************************************************************************************************************
	Funciones de la tabla pedidos_maquinaria_detalles
	*********************************************************************************************************************/
    //Función que se utiliza para guardar los componentes del pedido
	public function guardar_componentes($intPedidoMaquinariaID, $otdComponentesMaquinaria)
	{
		//Hacer recorrido para guardar componentes
		foreach ($otdComponentesMaquinaria as $componente) 
		{
			//Asignar datos al array
			$arrDatos = array(
								'pedido_maquinaria_id' => $intPedidoMaquinariaID,
				 			  	'renglon' => $componente->renglon,
							  	'maquinaria_descripcion_id' => $componente->maquinaria_descripcion_componente_id
							);
			//Guardar los datos del registro
			$this->db->insert('pedidos_maquinaria_detalles', $arrDatos);
		}	
	}
}	
?>