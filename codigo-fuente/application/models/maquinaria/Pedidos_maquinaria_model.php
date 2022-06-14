<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de mensajes (para guardar el mensaje que se envía a los usuarios)
include_once(APPPATH . 'models/administracion/Mensajes_model.php');

class Pedidos_maquinaria_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla pedidos_maquinaria
	*********************************************************************************************************************/
    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objPedidoMaquinaria)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();
		//Tabla pedidos_maquinaria
		//Asignar datos al array
		$arrDatos = array('vendedor_id' => $objPedidoMaquinaria->intVendedorID, 
						  'folio_legal' => $objPedidoMaquinaria->strFolioLegal,
						  'observaciones' => $objPedidoMaquinaria->strObservaciones,
						  'notas' => $objPedidoMaquinaria->strNotas,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objPedidoMaquinaria->intUsuarioID);
		$this->db->where('pedido_maquinaria_id', $objPedidoMaquinaria->intPedidoMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('pedidos_maquinaria', $arrDatos);

	   
		//Verificamos que el PEDIDO DE MAQUINARIA contenga información referente a las FORMAS DE PAGO
	    if($objPedidoMaquinaria->strTiposPagoIDMaquinariaPago != '' && 
	    	$objPedidoMaquinaria->strImportesMaquinariaPago != '' && 
	    	$objPedidoMaquinaria->strVencimientosMaquinariaPago != '' )
	    { 
	    	//Eliminar las formas de pago guardadas
			$this->db->where('pedido_maquinaria_id', $objPedidoMaquinaria->intPedidoMaquinariaID);
			$this->db->delete('pedidos_maquinaria_pago');

			//Hacer un llamado al método para guardar las formas de pago del pedido
			$this->guardar_formas_pago($objPedidoMaquinaria);
		}


	    /*
	    //Verificamos que el PEDIDO DE MAQUINARIA contenga información referente a COMPONENTES DE MAQUINARIA
	    if($objPedidoMaquinaria->strMaquinariasDescripcionesID !== ''){
	    	//Eliminar los componenetes de maquinaria guardados
			$this->db->where('pedido_maquinaria_id', $objPedidoMaquinaria->intPedidoMaquinariaID);
			$this->db->delete('pedidos_maquinaria_detalles');
			//Hacer un llamado al método para guardar componentes correspondientes a una maquinaria(en caso de que aplique)
			$this->guardar_componentes($objPedidoMaquinaria);
	    }
	    */
							       
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
		
		
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intPedidoMaquinariaID, $strEstatus)
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
		else if($strEstatus == 'FACTURADO' OR $strEstatus == 'AUTORIZADO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id') );
		}
		else 
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_eliminacion' => date("Y-m-d H:i:s"),
							  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		}
		$this->db->where('pedido_maquinaria_id', $intPedidoMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('pedidos_maquinaria', $arrDatos);
	}

	//Método para enviar la autorización (o rechazo) de un registro
	public function set_enviar_autorizacion($intPedidoMaquinariaID, $intCotizacionMaquinariaID, 
										    $strUsuarios, $strMensaje, $strEstatus)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (Mensajes) 
        $otdModelMensajes = new  Mensajes_model();

		//Si existe estatus
		if($strEstatus !== NULL)
		{	
			//Si el estatus del registro es AUTORIZADO
			if($strEstatus == 'AUTORIZADO')
			{
				//Debemos verificar que el pedido ya se encuentre tambien autorizado en CRÉDITO
				$this->db->select("fecha_autorizacion_credito, usuario_autorizacion_credito", FALSE);
	    		$this->db->from('pedidos_maquinaria');
	    		$this->db->where('pedido_maquinaria_id', $intPedidoMaquinariaID);
	    		$this->db->limit(1);
				$otdCreditoAutorizado = $this->db->get()->row();
				
				//En caso de que el pedido se encuentre autorizado en Crédito cambiaremos el estatus del PEDIDO, fecha y usuario
				if($otdCreditoAutorizado->fecha_autorizacion_credito != NULL){ 
					//Asignar datos al array
					$arrDatos = array(
										'estatus' => $strEstatus,
								  		'fecha_autorizacion_maquinaria' => date("Y-m-d H:i:s"),
								  		'usuario_autorizacion_maquinaria' => $this->session->userdata('usuario_id')
									);
				}
				else{ //Caso contrario solo actualizaremos fecha y usuario correspondientes
					$arrDatos = array(
										'fecha_autorizacion_maquinaria' => date("Y-m-d H:i:s"),
								  		'usuario_autorizacion_maquinaria' => $this->session->userdata('usuario_id')
								  	);
				}
				//Actualizar los datos del registro
				$this->db->where('pedido_maquinaria_id', $intPedidoMaquinariaID);
				$this->db->limit(1);
				//Tabla pedidos_maquinaria
				$this->db->update('pedidos_maquinaria', $arrDatos);	
			}
			else
			{
				//Tabla pedidos_maquinaria
				//Asignar datos al array
				$arrDatos = array('estatus' => $strEstatus,
								  'fecha_actualizacion' => date("Y-m-d H:i:s"),
								  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
				$this->db->where('pedido_maquinaria_id', $intPedidoMaquinariaID);
				$this->db->limit(1);
				//Actualizar los datos del registro
				$this->db->update('pedidos_maquinaria', $arrDatos);

				//Tabla cotizaciones_maquinaria
				//Asignar datos al array
				$arrDatos = array('estatus' => $strEstatus,
								  'fecha_actualizacion' => date("Y-m-d H:i:s"),
								  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
				$this->db->where('cotizacion_maquinaria_id', $intCotizacionMaquinariaID);
				$this->db->limit(1);
				//Actualizar los datos del registro
				$this->db->update('cotizaciones_maquinaria', $arrDatos);
			}
		}

        //Hacer un llamado al método para guardar el mensaje que se envía a los usuarios
		$otdModelMensajes->guardar('PEDIDOS DE MAQUINARIA', $intPedidoMaquinariaID, $strUsuarios, $strMensaje);
        
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}

	//Método para enviar la autorización (o rechazo) de un registro
	public function set_enviar_autorizacion_credito($intPedidoMaquinariaID, $intCotizacionMaquinariaID, 
												    $strUsuarios, $strMensaje, $strEstatus)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (Mensajes) 
        $otdModelMensajes = new  Mensajes_model();

		//Si existe estatus
		if($strEstatus !== NULL)
		{	
			//Si el estatus del registro es AUTORIZADO
			if($strEstatus == 'AUTORIZADO')
			{
				//Debemos verificar que el pedido ya se encuentre tambien autorizado en MAQUINARIA
				$this->db->select("fecha_autorizacion_maquinaria, usuario_autorizacion_maquinaria", FALSE);
	    		$this->db->from('pedidos_maquinaria');
	    		$this->db->where('pedido_maquinaria_id', $intPedidoMaquinariaID);
	    		$this->db->limit(1);
				$otdCreditoAutorizado = $this->db->get()->row();
				
				//En caso de que el pedido se encuentre autorizado en Maquinaria cambiaremos el estatus del PEDIDO, fecha y usuario
				if($otdCreditoAutorizado->fecha_autorizacion_maquinaria != NULL){ 
					//Asignar datos al array
					$arrDatos = array(
										'estatus' => $strEstatus,
								  		'fecha_autorizacion_credito' => date("Y-m-d H:i:s"),
								  		'usuario_autorizacion_credito' => $this->session->userdata('usuario_id')
									);
				}
				else{ //Caso contrario solo actualizaremos fecha y usuario correspondientes
					$arrDatos = array(
										'fecha_autorizacion_credito' => date("Y-m-d H:i:s"),
								  		'usuario_autorizacion_credito' => $this->session->userdata('usuario_id')
								  	);
				}
				//Actualizar los datos del registro
				$this->db->where('pedido_maquinaria_id', $intPedidoMaquinariaID);
				$this->db->limit(1);
				//Tabla pedidos_maquinaria
				$this->db->update('pedidos_maquinaria', $arrDatos);	
			}
			else
			{
				//Tabla pedidos_maquinaria
				//Asignar datos al array
				$arrDatos = array('estatus' => $strEstatus,
								  'fecha_actualizacion' => date("Y-m-d H:i:s"),
								  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
				$this->db->where('pedido_maquinaria_id', $intPedidoMaquinariaID);
				$this->db->limit(1);
				//Actualizar los datos del registro
				$this->db->update('pedidos_maquinaria', $arrDatos);

				//Tabla cotizaciones_maquinaria
				//Asignar datos al array
				$arrDatos = array('estatus' => $strEstatus,
								  'fecha_actualizacion' => date("Y-m-d H:i:s"),
								  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
				$this->db->where('cotizacion_maquinaria_id', $intCotizacionMaquinariaID);
				$this->db->limit(1);
				//Actualizar los datos del registro
				$this->db->update('cotizaciones_maquinaria', $arrDatos);
			}
		}

        //Hacer un llamado al método para guardar el mensaje que se envía a los usuarios
		$otdModelMensajes->guardar('PEDIDOS DE MAQUINARIA', $intPedidoMaquinariaID, $strUsuarios, $strMensaje);
        
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intPedidoMaquinariaID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL,  
						   $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		$this->db->select("	PM.pedido_maquinaria_id, 
							PM.folio, 
							DATE_FORMAT(PM.fecha,'%d/%m/%Y') AS fecha,
						   	PM.moneda_id, 
						   	PM.tipo_cambio, 
						   	PM.cotizacion_maquinaria_id, 
						   	PM.prospecto_id, 
						   	PM.vendedor_id,
						   	PM.folio_legal, 
						   	PM.observaciones, 
						   	PM.notas, 
						   	PM.estatus, 
						   	PM.maquinaria_descripcion_id,
						   	PM.codigo, 
						   	PM.descripcion_corta, 
						   	PM.descripcion, 
						   	PM.precio, 
						   	PM.descuento, 
						   	PM.tasa_cuota_iva, 
						   	PM.iva, 
						   	PM.tasa_cuota_ieps, 
						   	PM.ieps, 
						   	TIva.valor_maximo AS porcentaje_iva, 
						   	TIeps.valor_maximo AS porcentaje_ieps, 
						   	CM.folio AS folio_cotizacion,
						   	CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre) AS vendedor, 
						   	M.codigo AS moneda, 
						   	CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda_descripcion, 
						 	CASE 
							   	WHEN  C.estatus = 'ACTIVO' THEN C.razon_social
								ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   END AS prospecto, 
						   P.telefono_principal,  
						   P.calle, 
						   P.numero_exterior, 
						   P.numero_interior, 
						   P.colonia,  
						   L.descripcion AS localidad, 
						   MP.descripcion AS municipio, 
						   EP.descripcion AS estado,
						   CP.codigo_postal,  
						   M.codigo AS codigo_moneda,
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   C.rfc, 
						   CASE 
							   WHEN  C.regimen_fiscal_id > 0 
							   		THEN C.regimen_fiscal_id		
							   ELSE 0
						   END regimen_fiscal_id,
						   C.razon_social,
						   C.razon_social AS cliente, 
						   C.estatus AS cliente_estatus,
					       C.telefono_principal AS cliente_telefono_principal, 
						   C.calle AS cliente_calle, 
						   C.numero_exterior AS cliente_numero_exterior, 
						   C.numero_interior AS cliente_numero_interior,  
						   CCP.codigo_postal AS cliente_codigo_postal,
						   C.colonia AS cliente_colonia, 
						   C.localidad AS cliente_localidad, 
						   MC.descripcion AS cliente_municipio,  
						   EC.descripcion AS cliente_estado,
                           C.maquinaria_credito_dias,
						   PS.codigo AS codigo_sat, 
						   U.codigo AS unidad_sat,
						   OImp.codigo AS objeto_impuesto_sat,
						   ML.descripcion AS maquinaria_linea,
						   MM.descripcion AS maquinaria_marca,
						   MMOD.descripcion AS maquinaria_modelo", FALSE);
	    $this->db->from('pedidos_maquinaria AS PM');
	    $this->db->join('maquinaria_descripciones AS MD', 'MD.maquinaria_descripcion_id = PM.maquinaria_descripcion_id', 'inner');	    
		$this->db->join('maquinaria_lineas AS ML', 'ML.maquinaria_linea_id = MD.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MM', 'MM.maquinaria_marca_id = MD.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'MMOD.maquinaria_modelo_id = MD.maquinaria_modelo_id', 'inner');
	    $this->db->join('cotizaciones_maquinaria AS CM', 'PM.cotizacion_maquinaria_id = CM.cotizacion_maquinaria_id', 'inner');
	    $this->db->join('sat_monedas AS M', 'PM.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('vendedores AS V', 'PM.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
	    $this->db->join('prospectos AS P', 'CM.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sat_paises AS PP', 'EP.pais_id = PP.pais_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'PM.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'PM.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('sat_codigos_postales AS CCP', 'C.codigo_postal_id = CCP.codigo_postal_id', 'left');
		$this->db->join('municipios AS MC', 'C.municipio_id = MC.municipio_id', 'left');
		$this->db->join('sat_estados AS EC', 'MC.estado_id = EC.estado_id', 'left');
		$this->db->join('sat_productos_servicios AS PS', 'MD.producto_servicio_id = PS.producto_servicio_id', 'left');
		$this->db->join('sat_unidades AS U', 'MD.unidad_id = U.unidad_id', 'left');
		$this->db->join('sat_objeto_impuesto AS OImp', 'MD.objeto_impuesto_id = OImp.objeto_impuesto_id', 'left');

		
		//Si existe id del pedido
		if ($intPedidoMaquinariaID != NULL)
		{   
			$this->db->where('PM.pedido_maquinaria_id', $intPedidoMaquinariaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('PM.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('PM.prospecto_id', $intProspectoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {		   		

		   		$this->db->where("PM.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
		    }
		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('PM.estatus', $strEstatus);
			}


			$this->db->where("((PM.folio LIKE '%$strBusqueda%') OR
							   (C.razon_social LIKE '%$strBusqueda%') OR
	        				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
				               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))");


			$this->db->order_by('PM.fecha DESC , PM.folio DESC');
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
		$this->db->from('pedidos_maquinaria AS PM');
		  $this->db->join('maquinaria_descripciones AS MD', 'MD.maquinaria_descripcion_id = PM.maquinaria_descripcion_id', 'inner');
	    $this->db->join('cotizaciones_maquinaria AS CM', 'PM.cotizacion_maquinaria_id = CM.cotizacion_maquinaria_id', 'inner');
		$this->db->join('sat_monedas AS M', 'PM.moneda_id = M.moneda_id', 'inner');
		$this->db->join('prospectos AS P', 'CM.prospecto_id = P.prospecto_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->where('PM.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('PM.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {		   		

	   		$this->db->where("PM.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('PM.estatus', $strEstatus);
		} 

		$this->db->where("((PM.folio LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))");

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para buscar componentes de maquinaria correspondientes a una cotización de maquinaria
	public function buscar_componentes_maquinaria($intPedidoMaquinariaID){
		$this->db->select("	PM.maquinaria_descripcion_id,
							MDC.renglon,
					        MDC.referencia_id,
					        MD.maquinaria_descripcion_id AS maquinaria_descripcion_componente_id,
					        MD.codigo,
					        MD.descripcion_corta", FALSE);
		$this->db->from('pedidos_maquinaria PM');
	    $this->db->join('maquinaria_descripciones_componentes MDC', 'MDC.maquinaria_descripcion_id = PM.maquinaria_descripcion_id', 'inner');
	    $this->db->join('maquinaria_descripciones MD', 'MD.maquinaria_descripcion_id = MDC.referencia_id', 'inner');
	 	$this->db->order_by('MDC.renglon', 'ASC');
	 	$this->db->where('PM.pedido_maquinaria_id', $intPedidoMaquinariaID);
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL, 
						  $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('PM.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('PM.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {		   		

	   		$this->db->where("PM.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('PM.estatus', $strEstatus);
		}

		$this->db->where("((PM.folio LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))");

		$this->db->from('pedidos_maquinaria AS PM');
	    $this->db->join('sat_monedas AS M', 'PM.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('vendedores AS V', 'PM.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
	    $this->db->join('prospectos AS P', 'PM.prospecto_id = P.prospecto_id', 'inner');
	 	$this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sat_paises AS PP', 'EP.pais_id = PP.pais_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("	PM.pedido_maquinaria_id, 
							PM.folio, 
							DATE_FORMAT(PM.fecha,'%d/%m/%Y') AS fecha,  
						   	PM.estatus, 
						   	CASE 
							   	WHEN C.estatus = 'ACTIVO'  THEN C.razon_social
								ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   	END AS prospecto", FALSE);
		$this->db->from('pedidos_maquinaria AS PM');
	    $this->db->join('sat_monedas AS M', 'PM.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('vendedores AS V', 'PM.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
	    $this->db->join('prospectos AS P', 'PM.prospecto_id = P.prospecto_id', 'inner');
	 	$this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sat_paises AS PP', 'EP.pais_id = PP.pais_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
	    $this->db->where('PM.sucursal_id', $this->session->userdata('sucursal_id'));
	    //Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('PM.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {		   		

	   		$this->db->where("PM.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('PM.estatus', $strEstatus);
		}

		$this->db->where("((PM.folio LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))");

		$this->db->order_by('PM.fecha DESC , PM.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["pedidos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros facturados que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select("PM.pedido_maquinaria_id, PM.folio, 
							CASE 
							   WHEN  C.regimen_fiscal_id > 0 
							   		THEN C.regimen_fiscal_id		
							   ELSE 0
						    END regimen_fiscal_id", FALSE);
        $this->db->from('pedidos_maquinaria AS PM');
        $this->db->join('clientes AS C', 'PM.prospecto_id = C.prospecto_id', 'left');
        $this->db->where('PM.sucursal_id', $this->session->userdata('sucursal_id'));
   	    $this->db->where('PM.estatus','AUTORIZADO');
        $this->db->where("(PM.folio LIKE '%$strDescripcion%')");  
		$this->db->order_by('PM.folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla pedidos_maquinaria_usada
	*********************************************************************************************************************/
	//Función que se utiliza para guardar la maquinaria usada del pedido
	public function guardar_maquinaria_usada($intPedidoMaquinariaID, $strDescripcionesMaquinariaUsada, $strImportesMaquinariaUsada)
	{
		//Si existe maquinaria usada
		if($strDescripcionesMaquinariaUsada !== '')
		{
			//Quitar | de la lista para obtener la descripción y el importe
			$arrDescripcionesMaquinariaUsada = explode("|", $strDescripcionesMaquinariaUsada);
			$arrImportesMaquinariaUsada = explode("|", $strImportesMaquinariaUsada);

			//Hacer recorrido para insertar los datos en la tabla pedidos_maquinaria_usada
			for ($intCon = 0; $intCon < sizeof($arrDescripcionesMaquinariaUsada); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('pedido_maquinaria_id' => $intPedidoMaquinariaID,
					 			  'renglon' => ($intCon + 1),
								  'descripcion' => $arrDescripcionesMaquinariaUsada[$intCon],
								  'importe' => $arrImportesMaquinariaUsada[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('pedidos_maquinaria_usada', $arrDatos);
			}
		}
	}

	
	
	/*******************************************************************************************************************
	Funciones de la tabla pedidos_maquinaria_pago
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los pagos del pedido
	public function guardar_formas_pago(stdClass $objPedidoMaquinaria)
	{
		
		//Quitar | de la lista para obtener el tipo de pago ID, observaciones, importe y fecha de vencimiento
		$arrTiposPagoIDMaquinariaPago = explode("|", $objPedidoMaquinaria->strTiposPagoIDMaquinariaPago);
		$arrObservacionesMaquinariaPago = explode("|", $objPedidoMaquinaria->strObservacionesMaquinariaPago);
		$arrImportesMaquinariaPago = explode("|", $objPedidoMaquinaria->strImportesMaquinariaPago);
		$arrVencimientosMaquinariaPago = explode("|", $objPedidoMaquinaria->strVencimientosMaquinariaPago);

		//Hacer recorrido para insertar los datos en la tabla pedidos_maquinaria_pago
		for ($intCon = 0; $intCon < sizeof($arrTiposPagoIDMaquinariaPago); $intCon++) 
		{
			//Asignar fecha de vencimiento
			$dteFechaVencimiento = $arrVencimientosMaquinariaPago[$intCon];
			
			//Si la fecha de vencimiento esta vacia asignar valor nulo
			$dteFechaVencimiento = (($dteFechaVencimiento !== '') ? $dteFechaVencimiento : NULL);

			//Asignar datos al array
			$arrDatos = array('pedido_maquinaria_id' => $objPedidoMaquinaria->intPedidoMaquinariaID,
				 			  'renglon' => ($intCon + 1),
							  'documento_pago_id' => $arrTiposPagoIDMaquinariaPago[$intCon],
							  'observaciones' => $arrObservacionesMaquinariaPago[$intCon],
							  'importe' => $arrImportesMaquinariaPago[$intCon],
							  'vencimiento' => $dteFechaVencimiento);
			//Guardar los datos del registro
			$this->db->insert('pedidos_maquinaria_pago', $arrDatos);
		}
	}


	//Método para regresar los documentos del pago que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_formas_pago($intSucursalID, $dteFechaCorte = NULL, $intMonedaID = NULL)
	{

		$this->db->select("DISTINCT DP.documento_pago_id, DP.descripcion", FALSE);
		$this->db->from('facturas_maquinaria AS FM');
		$this->db->join('pedidos_maquinaria AS PM', 'FM.pedido_maquinaria_id = PM.pedido_maquinaria_id', 'inner');
		$this->db->join('pedidos_maquinaria_pago AS PMP', 'PM.pedido_maquinaria_id = PMP.pedido_maquinaria_id', 'inner');
		$this->db->join('documentos_pagos AS DP', 'PMP.documento_pago_id = DP.documento_pago_id', 'inner');
		$this->db->where("(FM.estatus = 'ACTIVO' OR FM.estatus = 'TIMBRAR')");
		$this->db->where('FM.sucursal_id', $intSucursalID);
		//Si existe id de la moneda
	    if($intMonedaID > 0)
	    {
	   		$this->db->where('FM.moneda_id', $intMonedaID);
	    }

	    //Si existe fecha de corte
		if($dteFechaCorte !== NULL)
		{

			$this->db->where("(DATE_FORMAT(FM.fecha,'%Y-%m-%d') <= '$dteFechaCorte')", NULL, FALSE);
		}

		$this->db->order_by('DP.documento_pago_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar las formas de pago de un registro
	public function buscar_formas_pago($intPedidoMaquinariaID = NULL, $intFacturaMaquinariaID = NULL)
	{
		$this->db->select("	PMP.pedido_maquinaria_id,
							PMP.renglon,
							PMP.documento_pago_id,
							DP.descripcion AS documento_pago,
							PMP.observaciones, 
							PMP.importe,  
							DATE_FORMAT(PMP.vencimiento,'%d/%m/%Y') AS vencimiento, 
							PMP.vencimiento AS fecha_vencimiento", FALSE);
		$this->db->from('pedidos_maquinaria_pago AS PMP');
		$this->db->join('documentos_pagos AS DP', 'DP.documento_pago_id = PMP.documento_pago_id', 'inner');
		//Si existe id del pedido de maquinaria
		if($intPedidoMaquinariaID > 0)
		{
			$this->db->where('PMP.pedido_maquinaria_id', $intPedidoMaquinariaID);
			$this->db->order_by('PMP.renglon', 'ASC');
		}
		else
		{
			$this->db->join('pedidos_maquinaria AS PM', 'PMP.pedido_maquinaria_id = PM.pedido_maquinaria_id', 'inner');
			$this->db->join('facturas_maquinaria AS FM', 'PM.pedido_maquinaria_id = FM.pedido_maquinaria_id', 'inner');
			$this->db->where('FM.factura_maquinaria_id', $intFacturaMaquinariaID);
			$this->db->order_by('PMP.vencimiento', 'ASC');
		}
		
		return $this->db->get()->result();
	}



	/*******************************************************************************************************************
	Funciones de la tabla pedidos_maquinaria_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los componentes del pedido
	public function guardar_componentes(stdClass $objPedidoMaquinaria)
	{
		//Quitar | de la lista para obtener la descripciónID
		$arrMaquinariasDescripcionesID = explode("|", $objPedidoMaquinaria->strMaquinariasDescripcionesID);

		//Hacer recorrido para insertar los datos en la tabla pedidos_maquinaria_detalles
		for ($intCon = 0; $intCon < sizeof($arrMaquinariasDescripcionesID); $intCon++) 
		{
			//Asignar datos al array
			$arrDatos = array(
								'pedido_maquinaria_id' => $objPedidoMaquinaria->intPedidoMaquinariaID,
				 			  	'renglon' => ($intCon + 1),
							  	'maquinaria_descripcion_id' => $arrMaquinariasDescripcionesID[$intCon]
							);
			//Guardar los datos del registro
			$this->db->insert('pedidos_maquinaria_detalles', $arrDatos);
		}
	}

	//Método para regresar los componentes de la tabla pedidos_maquinaria_detalles (en caso de que aplique)
	public function buscar_componentes($intPedidoMaquinariaID)
	{
		$this->db->select('PMD.pedido_maquinaria_id,
						    PMD.renglon,
						    PMD.maquinaria_descripcion_id,
						    MD.maquinaria_descripcion_id AS maquinaria_descripcion_componente_id,
							MD.codigo,
							MD.descripcion_corta');
		$this->db->from('pedidos_maquinaria_detalles PMD');
		$this->db->join('maquinaria_descripciones MD', 'MD.maquinaria_descripcion_id = PMD.maquinaria_descripcion_id', 'inner');
		$this->db->where('PMD.pedido_maquinaria_id', $intPedidoMaquinariaID);
		$this->db->order_by('PMD.renglon', 'ASC');
		return $this->db->get()->result();
	}
}	
?>