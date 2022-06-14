<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de factura de refacciones (para modificar el estatus de la referencia)
include_once(APPPATH . 'models/refacciones/Facturas_refacciones_model.php');

class Remisiones_refacciones_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla remisiones_refacciones
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objRemisionRefacciones)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        //Se crea una instancia de la clase modelo (factura de refacciones) 
        $otdModelReferencia = new  Facturas_refacciones_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objRemisionRefacciones->strFolio); 

		//Tabla remisiones_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objRemisionRefacciones->intSucursalID,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objRemisionRefacciones->dteFecha,
						  'moneda_id' => $objRemisionRefacciones->intMonedaID, 
						  'tipo_cambio' => $objRemisionRefacciones->intTipoCambio, 
						  'tipo_referencia' => $objRemisionRefacciones->strTipoReferencia, 
						  'referencia_id' => $objRemisionRefacciones->intReferenciaID,
						  'vendedor_id' => $objRemisionRefacciones->intVendedorID,
						  'estrategia_id' => $objRemisionRefacciones->intEstrategiaID,
						  'tipo' => $objRemisionRefacciones->strTipo, 
						  'anticipo_id' => $objRemisionRefacciones->intAnticipoID,
						  'prospecto_id' => $objRemisionRefacciones->intProspectoID, 
						  'gastos_paqueteria' => $objRemisionRefacciones->intGastosPaqueteria,
						  'gastos_paqueteria_iva' => $objRemisionRefacciones->intGastosPaqueteriaIva,
						  'observaciones' => $objRemisionRefacciones->strObservaciones, 
						  'notas' => $objRemisionRefacciones->strNotas, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objRemisionRefacciones->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('remisiones_refacciones', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objRemisionRefacciones->intRemisionRefaccionesID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la remisión
		$this->guardar_detalles($objRemisionRefacciones);

		//Hacer un llamado al método para modificar el estatus de la (cotización/pedido)
		$otdModelReferencia->set_estatus_referencia($objRemisionRefacciones->strTipoReferencia, 
									  			    $objRemisionRefacciones->intReferenciaID, 
									  			    'REMISION');

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
	public function modificar(stdClass $objRemisionRefacciones)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (factura de refacciones) 
        $otdModelReferencia = new  Facturas_refacciones_model();

		//Tabla remisiones_refacciones
		//Asignar datos al array
		$arrDatos = array('fecha' => $objRemisionRefacciones->dteFecha,
						  'moneda_id' => $objRemisionRefacciones->intMonedaID, 
						  'tipo_cambio' => $objRemisionRefacciones->intTipoCambio, 
						  'tipo_referencia' => $objRemisionRefacciones->strTipoReferencia, 
						  'referencia_id' => $objRemisionRefacciones->intReferenciaID,
						  'vendedor_id' => $objRemisionRefacciones->intVendedorID,
						  'estrategia_id' => $objRemisionRefacciones->intEstrategiaID,
						  'tipo' => $objRemisionRefacciones->strTipo, 
						  'anticipo_id' => $objRemisionRefacciones->intAnticipoID,
						  'prospecto_id' => $objRemisionRefacciones->intProspectoID, 
						  'gastos_paqueteria' => $objRemisionRefacciones->intGastosPaqueteria,
						  'gastos_paqueteria_iva' => $objRemisionRefacciones->intGastosPaqueteriaIva,
						  'observaciones' => $objRemisionRefacciones->strObservaciones, 
						  'notas' => $objRemisionRefacciones->strNotas, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objRemisionRefacciones->intUsuarioID);
		$this->db->where('remision_refacciones_id', $objRemisionRefacciones->intRemisionRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('remisiones_refacciones', $arrDatos);

		
		//Eliminar los detalles guardados
		$this->db->where('remision_refacciones_id', $objRemisionRefacciones->intRemisionRefaccionesID);
		$this->db->delete('remisiones_refacciones_detalles');
		//Hacer un llamado al método para guardar los detalles de la remisión
		$this->guardar_detalles($objRemisionRefacciones);

		//Hacer un llamado al método para modificar el estatus de la (cotización/pedido)
		$otdModelReferencia->set_estatus_referencia($objRemisionRefacciones->strTipoReferencia, 
									  			    $objRemisionRefacciones->intReferenciaID, 
									  			    'REMISION');

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intRemisionRefaccionesID, $strEstatus, 
							    $strTipoReferencia = NULL, $intReferenciaID = NULL)
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

			//Hacer un llamado al método para modificar el estatus de la referencia(cotización/pedido)
			$otdModelReferencia->set_estatus_referencia($strTipoReferencia, 
													    $intReferenciaID, 
													    'ACTIVO');
		}
		else //Si el estatus del registro es FACTURADO
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		}

	
		$this->db->where('remision_refacciones_id', $intRemisionRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('remisiones_refacciones', $arrDatos);

	    //Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intRemisionRefaccionesID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		$this->db->select("RR.remision_refacciones_id, RR.folio, 
						   DATE_FORMAT(RR.fecha,'%d/%m/%Y') AS fecha,
						   RR.moneda_id, RR.tipo_cambio, RR.tipo_referencia, RR.referencia_id,
						   RR.vendedor_id, RR.estrategia_id, RR.tipo, RR.anticipo_id, RR.prospecto_id, 
						   RR.gastos_paqueteria, RR.gastos_paqueteria_iva,RR.observaciones,
						   RR.notas, RR.estatus,   M.codigo AS codigo_moneda,
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   E.descripcion AS estrategia,
						   CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre) AS vendedor,
						   CP.codigo_postal,  C.rfc,
						   CASE 
							   WHEN  C.regimen_fiscal_id > 0 
							   		THEN C.regimen_fiscal_id		
							   ELSE 0
						    END regimen_fiscal_id,
						   C.razon_social, C.refacciones_credito_dias, 
						   C.refacciones_lista_precio_id, C.razon_social AS cliente, 
						   C.correo_electronico, C.contacto_correo_electronico, 
						   C.estatus  AS cliente_estatus, C.telefono_principal AS cliente_telefono_principal, 
						   C.calle AS cliente_calle, C.numero_exterior AS cliente_numero_exterior, 
						   C.numero_interior AS cliente_numero_interior,  CP.codigo_postal AS cliente_codigo_postal,
						   C.colonia AS cliente_colonia, C.localidad AS cliente_localidad, 
						   MC.descripcion AS cliente_municipio,  EC.descripcion AS cliente_estado,
						   PC.descripcion AS cliente_pais,
						   CR.folio AS folio_cotizacion, PR.folio AS folio_pedido, 
						   AP.anticipo_id AS anticipo_id_pedido,
						   A.folio AS folio_anticipo,
						   CASE 
							   WHEN  CR.cotizacion_refacciones_id > 0 
							   		THEN CONCAT_WS(' - ', CR.folio, RR.tipo_referencia) 
							   WHEN  PR.pedido_refacciones_id > 0 
							   		THEN CONCAT_WS(' - ', PR.folio, RR.tipo_referencia) 
							   ELSE ''
						    END folio_referencia,
						    CASE 
							   WHEN  CR.cotizacion_refacciones_id > 0 
							   		THEN CR.tipo_cambio
							   WHEN  PR.pedido_refacciones_id > 0 
							   		THEN PR.tipo_cambio
							   ELSE ''
						    END tipo_cambio_referencia,
						   RR.usuario_creacion,
						   RR.fecha_creacion", FALSE);
	    $this->db->from('remisiones_refacciones AS RR');
	    $this->db->join('sat_monedas AS M', 'RR.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('estrategias AS E', 'RR.estrategia_id = E.estrategia_id', 'inner');
	    $this->db->join('vendedores AS V', 'RR.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
	    $this->db->join('clientes AS C', 'RR.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('municipios AS MC', 'C.municipio_id = MC.municipio_id', 'inner');
		$this->db->join('sat_estados AS EC', 'MC.estado_id = EC.estado_id', 'inner');
		$this->db->join('sat_paises AS PC', 'EC.pais_id = PC.pais_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'C.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('cotizaciones_refacciones AS CR', 'RR.referencia_id = CR.cotizacion_refacciones_id 
						 AND RR.tipo_referencia = "COTIZACION"', 'left');
		$this->db->join('pedidos_refacciones AS PR', 'RR.referencia_id = PR.pedido_refacciones_id 
						 AND RR.tipo_referencia = "PEDIDO"', 'left');
		$this->db->join('anticipos AS A', 'RR.anticipo_id = A.anticipo_id', 'left');
		$this->db->join('anticipos AS AP', 'PR.anticipo_id = AP.anticipo_id', 'left');
		//Si existe id de la remisión
		if ($intRemisionRefaccionesID != NULL)
		{   
			$this->db->where('RR.remision_refacciones_id', $intRemisionRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where('RR.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('RR.prospecto_id', $intProspectoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {		   		
		   		$this->db->where("(RR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }
		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('RR.estatus', $strEstatus);
			}
			
			$this->db->where("((RR.folio LIKE '%$strBusqueda%') OR
		    			   	   (CONCAT_WS(' - ', C.rfc, C.razon_social) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', C.rfc, C.razon_social) LIKE '%$strBusqueda%') OR
	    				       (CONCAT_WS(' - ', C.razon_social, C.rfc) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', C.razon_social, C.rfc) LIKE '%$strBusqueda%') OR 
			                   (CONCAT_WS(' - ', CR.folio, RR.tipo_referencia) LIKE '%$strBusqueda%') OR 
			                   (CONCAT_WS(' - ', PR.folio, RR.tipo_referencia) LIKE '%$strBusqueda%'))");		
			$this->db->order_by('RR.fecha DESC, RR.folio DESC');
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
		$this->db->from('remisiones_refacciones AS RR');
		$this->db->join('sat_monedas AS M', 'RR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('clientes AS C', 'RR.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('cotizaciones_refacciones AS CR', 'RR.referencia_id = CR.cotizacion_refacciones_id 
						 AND RR.tipo_referencia = "COTIZACION"', 'left');
		$this->db->join('pedidos_refacciones AS PR', 'RR.referencia_id = PR.pedido_refacciones_id 
						 AND RR.tipo_referencia = "PEDIDO"', 'left');
		$this->db->where('RR.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
	    if($intProspectoID > 0)
	    {
	   		$this->db->where('RR.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	     if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(RR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('RR.estatus', $strEstatus);
		}

		$this->db->where("((RR.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', C.rfc, C.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', C.rfc, C.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', C.razon_social, C.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', C.razon_social, C.rfc) LIKE '%$strBusqueda%') OR 
			               (CONCAT_WS(' - ', CR.folio, RR.tipo_referencia) LIKE '%$strBusqueda%') OR 
			               (CONCAT_WS(' - ', PR.folio, RR.tipo_referencia) LIKE '%$strBusqueda%'))");	
		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL,
		                   $strEstatus = NULL,$strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('RR.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('RR.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {	   		
	   		$this->db->where("(RR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('RR.estatus', $strEstatus);
		}


		$this->db->where("((RR.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', C.rfc, C.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', C.rfc, C.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', C.razon_social, C.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', C.razon_social, C.rfc) LIKE '%$strBusqueda%') OR 
			               (CONCAT_WS(' - ', CR.folio, RR.tipo_referencia) LIKE '%$strBusqueda%') OR 
			               (CONCAT_WS(' - ', PR.folio, RR.tipo_referencia) LIKE '%$strBusqueda%'))");

	    $this->db->from('remisiones_refacciones AS RR');
	    $this->db->join('sat_monedas AS M', 'RR.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('estrategias AS E', 'RR.estrategia_id = E.estrategia_id', 'inner');
	    $this->db->join('vendedores AS V', 'RR.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
	    $this->db->join('clientes AS C', 'RR.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('municipios AS MC', 'C.municipio_id = MC.municipio_id', 'inner');
		$this->db->join('sat_estados AS EC', 'MC.estado_id = EC.estado_id', 'inner');
		$this->db->join('sat_paises AS PC', 'EC.pais_id = PC.pais_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'C.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('cotizaciones_refacciones AS CR', 'RR.referencia_id = CR.cotizacion_refacciones_id 
						 AND RR.tipo_referencia = "COTIZACION"', 'left');
		$this->db->join('pedidos_refacciones AS PR', 'RR.referencia_id = PR.pedido_refacciones_id 
						 AND RR.tipo_referencia = "PEDIDO"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("RR.remision_refacciones_id, RR.folio, DATE_FORMAT(RR.fecha,'%d/%m/%Y') AS fecha,
						   RR.tipo_referencia, RR.referencia_id,
						   RR.estatus, C.rfc, C.razon_social,
						   CASE 
							   WHEN  CR.cotizacion_refacciones_id > 0 
							   		THEN CONCAT_WS(' - ', CR.folio, RR.tipo_referencia) 
							   WHEN  PR.pedido_refacciones_id > 0 
							   		THEN CONCAT_WS(' - ', PR.folio, RR.tipo_referencia) 	
							    ELSE ''
						    END folio_referencia", FALSE);
	    $this->db->from('remisiones_refacciones AS RR');
	    $this->db->join('sat_monedas AS M', 'RR.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('estrategias AS E', 'RR.estrategia_id = E.estrategia_id', 'inner');
	    $this->db->join('vendedores AS V', 'RR.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'inner');
	    $this->db->join('clientes AS C', 'RR.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('municipios AS MC', 'C.municipio_id = MC.municipio_id', 'inner');
		$this->db->join('sat_estados AS EC', 'MC.estado_id = EC.estado_id', 'inner');
		$this->db->join('sat_paises AS PC', 'EC.pais_id = PC.pais_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'C.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('cotizaciones_refacciones AS CR', 'RR.referencia_id = CR.cotizacion_refacciones_id 
						 AND RR.tipo_referencia = "COTIZACION"', 'left');
		$this->db->join('pedidos_refacciones AS PR', 'RR.referencia_id = PR.pedido_refacciones_id 
						 AND RR.tipo_referencia = "PEDIDO"', 'left');
		
		$this->db->where('RR.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('RR.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {	   		
	   		$this->db->where("(RR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('RR.estatus', $strEstatus);
		}

		$this->db->where("((RR.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', C.rfc, C.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', C.rfc, C.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', C.razon_social, C.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', C.razon_social, C.rfc) LIKE '%$strBusqueda%') OR 
			               (CONCAT_WS(' - ', CR.folio, RR.tipo_referencia) LIKE '%$strBusqueda%') OR 
			               (CONCAT_WS(' - ', PR.folio, RR.tipo_referencia) LIKE '%$strBusqueda%'))");

		$this->db->order_by('RR.fecha DESC, RR.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["remisiones"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select("RR.remision_refacciones_id, RR.folio, 
							CASE 
							   WHEN  C.regimen_fiscal_id > 0 
							   		THEN C.regimen_fiscal_id		
							   ELSE 0
						    END regimen_fiscal_id", FALSE);
        $this->db->from('remisiones_refacciones AS RR');
        $this->db->join('clientes AS C', 'RR.prospecto_id = C.prospecto_id', 'inner');
        $this->db->where('RR.sucursal_id', $this->session->userdata('sucursal_id'));
         $this->db->where("RR.remision_refacciones_id NOT IN (SELECT FR.referencia_id FROM  
         				   facturas_refacciones AS FR WHERE FR.tipo_referencia = 'REMISION'  
         				   AND (FR.estatus = 'ACTIVO'  OR FR.estatus = 'TIMBRAR'))", NULL, FALSE);
	    $this->db->where('RR.estatus', 'ACTIVO');
        $this->db->where("(RR.folio LIKE '%$strDescripcion%')");
        $this->db->order_by('RR.folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla remisiones_refacciones_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la remisión
	public function guardar_detalles(stdClass $objRemisionRefacciones)
	{

		/*Quitar | de la lista para obtener el ID de la refacción, código, descripción, 
		  cantidad, costo unitario, descuento unitario, iva unitario, ieps unitario y precio unitario
		*/
		$arrRefaccionID = explode("|", $objRemisionRefacciones->strRefaccionID);
		$arrCodigos = explode("|", $objRemisionRefacciones->strCodigos);
		$arrDescripciones = explode("|", $objRemisionRefacciones->strDescripciones);
		$arrCodigosLineas = explode("|", $objRemisionRefacciones->strCodigosLineas);
		$arrCantidades = explode("|", $objRemisionRefacciones->strCantidades);
		$arrPreciosUnitarios = explode("|", $objRemisionRefacciones->strPreciosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objRemisionRefacciones->strDescuentosUnitarios);
		$arrTasaCuotaIva = explode("|", $objRemisionRefacciones->strTasaCuotaIva);
		$arrIvasUnitarios = explode("|", $objRemisionRefacciones->strIvasUnitarios);
		$arrTasaCuotaIeps = explode("|", $objRemisionRefacciones->strTasaCuotaIeps);
		$arrIepsUnitarios = explode("|", $objRemisionRefacciones->strIepsUnitarios);
		$arrCostosUnitarios = explode("|", $objRemisionRefacciones->strCostosUnitarios);
		
		//Hacer recorrido para insertar los datos en la tabla remisiones_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);

			//Asignar datos al array
			$arrDatos = array('remision_refacciones_id' => $objRemisionRefacciones->intRemisionRefaccionesID,
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
							  'ieps_unitario' => $arrIepsUnitarios[$intCon], 
							  'costo_unitario' => $arrCostosUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('remisiones_refacciones_detalles', $arrDatos);

		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intRemisionRefaccionesID)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');

		$this->db->select("RD.refaccion_id, RD.codigo, RD.descripcion, RD.codigo_linea, 
						   RD.cantidad, RD.precio_unitario, RD.descuento_unitario,
						   RD.tasa_cuota_iva, RD.iva_unitario, RD.tasa_cuota_ieps, RD.ieps_unitario, 
						   RD.costo_unitario,
						   PS.codigo AS codigo_sat, U.codigo AS unidad_sat,
						   OImp.codigo AS objeto_impuesto_sat,
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps,
						   RI.localizacion,
						   IFNULL(RI.actual_costo, 0) AS actual_costo,
						   IFNULL(RI.disponible_existencia, 0) AS disponible_existencia,
						   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
						   RM.descripcion AS refacciones_marca", FALSE);
		$this->db->from('remisiones_refacciones_detalles AS RD');
		$this->db->join('sat_tasa_cuota AS TIva', 'RD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('refacciones AS R', 'RD.refaccion_id = R.refaccion_id', 'inner');
		$this->db->join('refacciones_lineas AS RL', 'RD.codigo_linea = RL.codigo', 'inner');
		$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'left');
		$this->db->join('refacciones_inventario AS RI', 'R.refaccion_id = RI.refaccion_id 
						 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(NOW())', 'left');
		$this->db->join('sat_productos_servicios AS PS', 'R.producto_servicio_id = PS.producto_servicio_id', 'left');
		$this->db->join('sat_unidades AS U', 'R.unidad_id = U.unidad_id', 'left');
		$this->db->join('sat_objeto_impuesto AS OImp', 'R.objeto_impuesto_id = OImp.objeto_impuesto_id', 'left');
		$this->db->join('sat_tasa_cuota AS TIeps', 'RD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('RD.remision_refacciones_id', $intRemisionRefaccionesID);
		$this->db->order_by('RD.renglon', 'ASC');
		return $this->db->get()->result();
	}
}
?>