<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de factura de refacciones (para modificar el estatus de la cotización)
include_once(APPPATH . 'models/refacciones/Facturas_refacciones_model.php');

class Pedidos_refacciones_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla pedidos_refacciones
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objPedidoRefacciones)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        //Se crea una instancia de la clase modelo (factura de refacciones) 
        $otdModelReferencia = new  Facturas_refacciones_model();

        //Se crea una instancia de la clase modelo (cotizaciones de refacciones) 
      	$otdModelCotizacionesRefacciones = new  Cotizaciones_refacciones_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objPedidoRefacciones->strFolio); 

		//Tabla pedidos_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objPedidoRefacciones->intSucursalID,
						  'folio' => $strFolioConsecutivo,
						  'fecha' => $objPedidoRefacciones->dteFecha,
						  'moneda_id' => $objPedidoRefacciones->intMonedaID, 
						  'tipo_cambio' => $objPedidoRefacciones->intTipoCambio, 
						  'cotizacion_refacciones_id' => $objPedidoRefacciones->intCotizacionRefaccionesID, 
						  'vendedor_id' => $objPedidoRefacciones->intVendedorID, 
						  'estrategia_id' => $objPedidoRefacciones->intEstrategiaID, 
						  'tipo' => $objPedidoRefacciones->strTipo,
						  'anticipo_id' => $objPedidoRefacciones->intAnticipoID,
						  'prospecto_id' => $objPedidoRefacciones->intProspectoID, 
						  'gastos_paqueteria' => $objPedidoRefacciones->intGastosPaqueteria,
						  'gastos_paqueteria_iva' => $objPedidoRefacciones->intGastosPaqueteriaIva,
						  'observaciones' => $objPedidoRefacciones->strObservaciones, 
						  'notas' => $objPedidoRefacciones->strNotas, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objPedidoRefacciones->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('pedidos_refacciones', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objPedidoRefacciones->intPedidoRefaccionesID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles del pedido
		$this->guardar_detalles($objPedidoRefacciones);

		//Hacer un llamado al método para modificar el estatus de la cotización
		$otdModelReferencia->set_estatus_referencia('COTIZACION', 
									  			    $objPedidoRefacciones->intCotizacionRefaccionesID, 
									  			    'PEDIDO');


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
	public function modificar(stdClass $objPedidoRefacciones)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		 //Se crea una instancia de la clase modelo (factura de refacciones) 
        $otdModelReferencia = new  Facturas_refacciones_model();

		//Tabla pedidos_refacciones
		//Asignar datos al array
		$arrDatos = array('fecha' => $objPedidoRefacciones->dteFecha,
						  'moneda_id' => $objPedidoRefacciones->intMonedaID, 
						  'tipo_cambio' => $objPedidoRefacciones->intTipoCambio, 
						  'cotizacion_refacciones_id' => $objPedidoRefacciones->intCotizacionRefaccionesID, 
						  'vendedor_id' => $objPedidoRefacciones->intVendedorID, 
						  'estrategia_id' => $objPedidoRefacciones->intEstrategiaID, 
						  'tipo' => $objPedidoRefacciones->strTipo,
						  'anticipo_id' => $objPedidoRefacciones->intAnticipoID,
						  'prospecto_id' => $objPedidoRefacciones->intProspectoID, 
						  'gastos_paqueteria' => $objPedidoRefacciones->intGastosPaqueteria,
						  'gastos_paqueteria_iva' => $objPedidoRefacciones->intGastosPaqueteriaIva,
						  'observaciones' => $objPedidoRefacciones->strObservaciones, 
						  'notas' => $objPedidoRefacciones->strNotas,  
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objPedidoRefacciones->intUsuarioID);
		$this->db->where('pedido_refacciones_id', $objPedidoRefacciones->intPedidoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('pedidos_refacciones', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('pedido_refacciones_id', $objPedidoRefacciones->intPedidoRefaccionesID);
		$this->db->delete('pedidos_refacciones_detalles');
		//Hacer un llamado al método para guardar los detalles del pedido
		$this->guardar_detalles($objPedidoRefacciones);

		//Hacer un llamado al método para modificar el estatus de la cotización
		$otdModelReferencia->set_estatus_referencia('COTIZACION', 
									  			    $objPedidoRefacciones->intCotizacionRefaccionesID, 
									  			    'PEDIDO');

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intPedidoRefaccionesID, $strEstatus, $intCotizacionRefaccionesID = NULL)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

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
		else if ($strEstatus == 'INACTIVO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_eliminacion' => date("Y-m-d H:i:s"),
							  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));

			//Se crea una instancia de la clase modelo (facturas de refacciones) 
      	 	$otdModelReferencia = new  Facturas_refacciones_model();

			//Hacer un llamado al método para modificar el estatus de la cotización
			$otdModelReferencia->set_estatus_referencia('COTIZACION', $intCotizacionRefaccionesID, 'ACTIVO');
		}
		else //Si el estatus del registro es REMISION/FACTURADO
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		}

		$this->db->where('pedido_refacciones_id', $intPedidoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('pedidos_refacciones', $arrDatos);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intPedidoRefaccionesID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL, 
						   $intCotizacionRefaccionesID = NULL)
	{
		$this->db->select("PR.pedido_refacciones_id, PR.folio, 
						   DATE_FORMAT(PR.fecha,'%d/%m/%Y') AS fecha, PR.moneda_id, PR.tipo_cambio, 
						   PR.cotizacion_refacciones_id, PR.vendedor_id, PR.prospecto_id, 
						   PR.estrategia_id, PR.tipo, PR.anticipo_id, 
						   PR.gastos_paqueteria, PR.gastos_paqueteria_iva, PR.observaciones,
						   PR.notas, PR.estatus,  M.codigo AS codigo_moneda,
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   E.descripcion AS estrategia,
						   CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre) AS vendedor,
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' THEN C.razon_social
								    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   END AS prospecto, 
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
						   CP.codigo_postal,  C.rfc, 
						   CASE 
							   WHEN  C.regimen_fiscal_id > 0 
							   		THEN C.regimen_fiscal_id		
							   ELSE 0
						    END regimen_fiscal_id,
						   C.razon_social, C.refacciones_credito_dias, 
						   C.refacciones_lista_precio_id, C.razon_social AS cliente, 
						   C.estatus  AS cliente_estatus, C.telefono_principal AS cliente_telefono_principal, 
						   C.calle AS cliente_calle, C.numero_exterior AS cliente_numero_exterior, 
						   C.numero_interior AS cliente_numero_interior,  CCP.codigo_postal AS cliente_codigo_postal,
						   C.colonia AS cliente_colonia, C.localidad AS cliente_localidad, 
						   MC.descripcion AS cliente_municipio,  EC.descripcion AS cliente_estado,
						   PC.descripcion AS cliente_pais,
						   CR.folio AS folio_cotizacion, CR.tipo_cambio AS tipo_cambio_cotizacion,
						   A.folio AS folio_anticipo,
						   PR.usuario_creacion,
						   PR.fecha_creacion", FALSE);
	    $this->db->from('pedidos_refacciones AS PR');
	    $this->db->join('sat_monedas AS M', 'PR.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('estrategias AS E', 'PR.estrategia_id = E.estrategia_id', 'inner');
	    $this->db->join('vendedores AS V', 'PR.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
	    $this->db->join('prospectos AS P', 'PR.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('sat_codigos_postales AS CCP', 'C.codigo_postal_id = CCP.codigo_postal_id', 'left');
		$this->db->join('municipios AS MC', 'C.municipio_id = MC.municipio_id', 'left');
		$this->db->join('sat_estados AS EC', 'MC.estado_id = EC.estado_id', 'left');
		$this->db->join('sat_paises AS PC', 'EC.pais_id = PC.pais_id', 'left');
		$this->db->join('cotizaciones_refacciones AS CR', 'PR.cotizacion_refacciones_id = CR.cotizacion_refacciones_id', 'left');
		$this->db->join('anticipos AS A', 'PR.anticipo_id = A.anticipo_id', 'left');
		//Si existe id del pedido
		if ($intPedidoRefaccionesID != NULL)
		{   
			$this->db->where('PR.pedido_refacciones_id', $intPedidoRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if($intCotizacionRefaccionesID != NULL)//Si existe id de la cotización
		{
			$this->db->where('PR.cotizacion_refacciones_id', $intCotizacionRefaccionesID);
			$this->db->where('PR.estatus', 'ACTIVO');
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('PR.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('PR.prospecto_id', $intProspectoID);
		    }
		
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {	   		                                               		   		

		   		$this->db->where("(PR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }
		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('PR.estatus', $strEstatus);
			}

			$this->db->where("((PR.folio LIKE '%$strBusqueda%') OR
						       (C.razon_social LIKE '%$strBusqueda%') OR
	        			       (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
				               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR 
				               (CR.folio LIKE '%$strBusqueda%') OR 
				      	       (A.folio LIKE '%$strBusqueda%'))");		
			$this->db->order_by('PR.fecha DESC, PR.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						                     $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('pedidos_refacciones AS PR');
	   	$this->db->join('prospectos AS P', 'PR.prospecto_id = P.prospecto_id', 'inner');
		$this->db->join('sat_monedas AS M', 'PR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('cotizaciones_refacciones AS CR', 'PR.cotizacion_refacciones_id = CR.cotizacion_refacciones_id', 'left');
		$this->db->join('anticipos AS A', 'PR.anticipo_id = A.anticipo_id', 'left');
		$this->db->where('PR.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
	    if($intProspectoID > 0)
	    {
	   		$this->db->where('PR.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {	   		                                               		   		

	   		$this->db->where("(PR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('PR.estatus', $strEstatus);
		}

		
		$this->db->where("((PR.folio LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%') OR
	        			   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
				           (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR 
				           (CR.folio LIKE '%$strBusqueda%') OR 
				      	   (A.folio LIKE '%$strBusqueda%'))");
		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL,
		                 $strEstatus = NULL, $strBusqueda =  NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('PR.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('PR.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {	   		                                               		   		

	   		$this->db->where("(PR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('PR.estatus', $strEstatus);
		}

		$this->db->where("((PR.folio LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%') OR
	        			   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
				           (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR 
				           (CR.folio LIKE '%$strBusqueda%') OR 
				      	   (A.folio LIKE '%$strBusqueda%'))");

	    $this->db->from('pedidos_refacciones AS PR');
	    $this->db->join('sat_monedas AS M', 'PR.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('estrategias AS E', 'PR.estrategia_id = E.estrategia_id', 'inner');
	    $this->db->join('vendedores AS V', 'PR.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
	    $this->db->join('prospectos AS P', 'PR.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('cotizaciones_refacciones AS CR', 'PR.cotizacion_refacciones_id = CR.cotizacion_refacciones_id', 'left');
		$this->db->join('anticipos AS A', 'PR.anticipo_id = A.anticipo_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("PR.pedido_refacciones_id, PR.folio, DATE_FORMAT(PR.fecha,'%d/%m/%Y') AS fecha,
						   PR.cotizacion_refacciones_id, PR.estatus,
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' THEN C.razon_social
								    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   END AS prospecto, CR.folio AS folio_cotizacion,
						   A.folio AS folio_anticipo", FALSE);
	 	$this->db->from('pedidos_refacciones AS PR');
	    $this->db->join('sat_monedas AS M', 'PR.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('estrategias AS E', 'PR.estrategia_id = E.estrategia_id', 'inner');
	    $this->db->join('vendedores AS V', 'PR.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
	    $this->db->join('prospectos AS P', 'PR.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('cotizaciones_refacciones AS CR', 'PR.cotizacion_refacciones_id = CR.cotizacion_refacciones_id', 'left');
		$this->db->join('anticipos AS A', 'PR.anticipo_id = A.anticipo_id', 'left');
		$this->db->where('PR.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('PR.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {	   		                                               		   		

	   		$this->db->where("(PR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('PR.estatus', $strEstatus);
		}

		$this->db->where("((PR.folio LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%') OR
	        			   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
				           (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR 
				           (CR.folio LIKE '%$strBusqueda%') OR 
				      	   (A.folio LIKE '%$strBusqueda%'))");		

		$this->db->order_by('PR.fecha DESC, PR.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["pedidos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strTipo, $intMonedaID, $intProspectoID)
	{
		$this->db->select("PR.pedido_refacciones_id, PR.folio, PR.anticipo_id, 
						   CASE 
							   WHEN  C.regimen_fiscal_id > 0 
							   		THEN C.regimen_fiscal_id		
							   ELSE 0
						    END regimen_fiscal_id", FALSE);
        $this->db->from('pedidos_refacciones AS PR');
        $this->db->join('prospectos AS P', 'PR.prospecto_id = P.prospecto_id', 'inner');
        $this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
        $this->db->where('PR.sucursal_id', $this->session->userdata('sucursal_id'));
        $this->db->where("PR.pedido_refacciones_id NOT IN (SELECT FR.referencia_id FROM  
         				   facturas_refacciones AS FR WHERE FR.tipo_referencia = 'PEDIDO'  
         				   AND (FR.estatus = 'ACTIVO'  OR FR.estatus = 'TIMBRAR'))", NULL, FALSE);
        $this->db->where("PR.pedido_refacciones_id NOT IN (SELECT RR.referencia_id FROM  
         				  remisiones_refacciones AS RR WHERE RR.tipo_referencia = 'PEDIDO'  
         				  AND (RR.estatus = 'ACTIVO' OR RR.estatus = 'FACTURADO'))", NULL, FALSE);
        //Si el tipo corresponde a cliente
        if($strTipo == 'cliente')
        {
        	$this->db->where('C.estatus', 'ACTIVO');
        }

        //Si existe id de la moneda
        if($intMonedaID > 0)
        {
			$this->db->where('PR.moneda_id', $intMonedaID);
        }

        //Si existe id del prospecto
        if($intProspectoID > 0)
        {
			$this->db->where('PR.prospecto_id', $intProspectoID);
        }
	    $this->db->where('PR.estatus', 'ACTIVO');
        $this->db->where("(PR.folio LIKE '%$strDescripcion%')");
        $this->db->order_by('PR.folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla pedidos_refacciones_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles del pedido
	public function guardar_detalles(stdClass $objPedidoRefacciones)
	{
		/*Quitar | de la lista para obtener el ID de la refacción, código, descripción, 
		 cantidad, precio unitario, descuento unitario, iva unitario e ieps unitario
		*/
		$arrRefaccionID = explode("|", $objPedidoRefacciones->strRefaccionID);
		$arrCodigos = explode("|", $objPedidoRefacciones->strCodigos);
		$arrDescripciones = explode("|", $objPedidoRefacciones->strDescripciones);
		$arrCodigosLineas = explode("|", $objPedidoRefacciones->strCodigosLineas);
		$arrCantidades = explode("|", $objPedidoRefacciones->strCantidades);
		$arrPreciosUnitarios = explode("|", $objPedidoRefacciones->strPreciosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objPedidoRefacciones->strDescuentosUnitarios);
		$arrTasaCuotaIva = explode("|", $objPedidoRefacciones->strTasaCuotaIva);
		$arrIvasUnitarios = explode("|", $objPedidoRefacciones->strIvasUnitarios);
		$arrTasaCuotaIeps = explode("|", $objPedidoRefacciones->strTasaCuotaIeps);
		$arrIepsUnitarios = explode("|", $objPedidoRefacciones->strIepsUnitarios);

		//Hacer recorrido para insertar los datos en la tabla pedidos_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{

			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);

			//Asignar datos al array
			$arrDatos = array('pedido_refacciones_id' => $objPedidoRefacciones->intPedidoRefaccionesID,
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
			$this->db->insert('pedidos_refacciones_detalles', $arrDatos);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intPedidoRefaccionesID)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');

		$this->db->select("PD.refaccion_id, PD.codigo, PD.descripcion, PD.codigo_linea, 
						   PD.cantidad, PD.precio_unitario, 
						   PD.descuento_unitario, PD.tasa_cuota_iva, 
						   PD.iva_unitario, PD.tasa_cuota_ieps, PD.ieps_unitario, 
						   PS.codigo AS codigo_sat, U.codigo AS unidad_sat,
						   OImp.codigo AS objeto_impuesto_sat,
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps,
						   IFNULL(RI.actual_costo, 0) AS actual_costo,
						   IFNULL(RI.disponible_existencia, 0) AS disponible_existencia,
						   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
						   RM.descripcion AS refacciones_marca", FALSE);
		$this->db->from('pedidos_refacciones_detalles AS PD');
		$this->db->join('sat_tasa_cuota AS TIva', 'PD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('refacciones AS R', 'PD.refaccion_id = R.refaccion_id', 'inner');
		$this->db->join('refacciones_lineas AS RL', 'PD.codigo_linea = RL.codigo', 'inner');
		$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'left');
		$this->db->join('refacciones_inventario AS RI', 'R.refaccion_id = RI.refaccion_id 
						 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(NOW())', 'left');
		$this->db->join('sat_productos_servicios AS PS', 'R.producto_servicio_id = PS.producto_servicio_id', 'left');
		$this->db->join('sat_unidades AS U', 'R.unidad_id = U.unidad_id', 'left');
		$this->db->join('sat_objeto_impuesto AS OImp', 'R.objeto_impuesto_id = OImp.objeto_impuesto_id', 'left');
		$this->db->join('sat_tasa_cuota AS TIeps', 'PD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('PD.pedido_refacciones_id', $intPedidoRefaccionesID);
		$this->db->order_by('PD.renglon', 'ASC');
		return $this->db->get()->result();
	}
}
?>