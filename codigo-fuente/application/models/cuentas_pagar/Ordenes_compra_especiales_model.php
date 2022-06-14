<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de mensajes (para guardar el mensaje que se envía a los usuarios)
include_once(APPPATH . 'models/administracion/Mensajes_model.php');

class Ordenes_compra_especiales_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla ordenes_compra_especiales
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objOrdenCompra)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
		
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objOrdenCompra->strFolio); 

		//Tabla ordenes_compra_especiales
		//Asignar datos al array
		$arrDatos = array('folio' => $strFolioConsecutivo, 
						  'fecha' => $objOrdenCompra->dteFecha, 
						  'fecha_entrega' => $objOrdenCompra->dteFechaEntrega,
						  'fecha_vencimiento' => $objOrdenCompra->dteFechaVencimiento,
						  'condiciones_pago' => $objOrdenCompra->strCondicionesPago,
						  'moneda_id' => $objOrdenCompra->intMonedaID, 
						  'tipo_cambio' => $objOrdenCompra->intTipoCambio, 
						  'factura' => $objOrdenCompra->strFactura, 
						  'proveedor_id' => $objOrdenCompra->intProveedorID, 
						  'regimen_fiscal_id' => $objOrdenCompra->intRegimenFiscalID,
						  'porcentaje_retencion_id' => $objOrdenCompra->intPorcentajeRetencionID,
						  'importe_retenido' => $objOrdenCompra->intImporteRetenido, 
						  'solicita_id' => $objOrdenCompra->intSolicitaID,
						  'observaciones' => $objOrdenCompra->strObservaciones, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objOrdenCompra->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('ordenes_compra_especiales', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objOrdenCompra->intOrdenCompraEspecialID = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la orden de compra
		$this->guardar_detalles($objOrdenCompra);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objOrdenCompra->intOrdenCompraEspecialID.'_'.$strFolioConsecutivo;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objOrdenCompra)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla ordenes_compra_especiales
		//Asignar datos al array
		$arrDatos = array('fecha' => $objOrdenCompra->dteFecha, 
						  'fecha_entrega' => $objOrdenCompra->dteFechaEntrega,
						  'fecha_vencimiento' => $objOrdenCompra->dteFechaVencimiento,
						  'condiciones_pago' => $objOrdenCompra->strCondicionesPago,
						  'moneda_id' => $objOrdenCompra->intMonedaID, 
						  'tipo_cambio' => $objOrdenCompra->intTipoCambio, 
						  'factura' => $objOrdenCompra->strFactura, 
						  'proveedor_id' => $objOrdenCompra->intProveedorID, 
						  'regimen_fiscal_id' => $objOrdenCompra->intRegimenFiscalID,
						  'porcentaje_retencion_id' => $objOrdenCompra->intPorcentajeRetencionID,
						  'importe_retenido' => $objOrdenCompra->intImporteRetenido, 
						  'solicita_id' => $objOrdenCompra->intSolicitaID,
						  'observaciones' => $objOrdenCompra->strObservaciones, 
						  'estatus' => 'ACTIVO', 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objOrdenCompra->intUsuarioID);
		$this->db->where('orden_compra_especial_id', $objOrdenCompra->intOrdenCompraEspecialID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('ordenes_compra_especiales', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('orden_compra_especial_id', $objOrdenCompra->intOrdenCompraEspecialID);
		$this->db->delete('ordenes_compra_especiales_detalles');
		//Hacer un llamado al método para guardar los detalles de la orden de compra
		$this->guardar_detalles($objOrdenCompra);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intOrdenCompraEspecialID, $strEstatus)
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
		$this->db->where('orden_compra_especial_id', $intOrdenCompraEspecialID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('ordenes_compra_especiales', $arrDatos);
	}

	//Método para enviar la autorización (o rechazo) de un registro
	public function set_enviar_autorizacion($intOrdenCompraEspecialID, $strUsuarios, $strMensaje, $strEstatus)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (Mensajes) 
        $otdModelMensajes = new  Mensajes_model();

		//Si existe estatus
		if($strEstatus !== NULL)
		{
			//Tabla ordenes_compra_especiales
			//Si el estatus del registro es AUTORIZADO
			if($strEstatus == 'AUTORIZADO')
			{
				//Asignar datos al array
				$arrDatos = array('estatus' => $strEstatus,
								  'fecha_autorizacion' => date("Y-m-d H:i:s"),
								  'usuario_autorizacion' => $this->session->userdata('usuario_id'));
			}
			else
			{
				//Asignar datos al array
				$arrDatos = array('estatus' => $strEstatus,
								  'fecha_actualizacion' => date("Y-m-d H:i:s"),
								  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
			}
			$this->db->where('orden_compra_especial_id', $intOrdenCompraEspecialID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('ordenes_compra_especiales', $arrDatos);
		}
		
        //Hacer un llamado al método para guardar el mensaje que se envía a los usuarios
		$otdModelMensajes->guardar('ORDENES DE COMPRA ESPECIALES', $intOrdenCompraEspecialID, $strUsuarios, $strMensaje);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intOrdenCompraEspecialID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		$this->db->select("OCE.orden_compra_especial_id, OCE.folio, DATE_FORMAT(OCE.fecha,'%d/%m/%Y') AS fecha, 
						   DATE_FORMAT(OCE.fecha_entrega,'%d/%m/%Y') AS fecha_entrega,
						   DATE_FORMAT(OCE.fecha_vencimiento,'%d/%m/%Y') AS fecha_vencimiento, 
						   OCE.condiciones_pago, OCE.moneda_id, OCE.tipo_cambio, OCE.factura, 
						   OCE.proveedor_id, OCE.regimen_fiscal_id, OCE.porcentaje_retencion_id, 
						   OCE.importe_retenido, OCE.solicita_id, OCE.observaciones, OCE.estatus,
						   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, P.dias_credito,
						   P.correo_electronico, P.contacto_correo_electronico,
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS solicita,
						   P.rfc, P.telefono_principal,  
						   P.calle, P.numero_exterior, P.numero_interior, P.colonia,  
						   P.localidad, MP.descripcion AS municipio, EP.descripcion AS estado,
						   CP.codigo_postal, M.codigo AS codigo_moneda, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, 
						   PIsr.porcentaje AS porcentaje_isr, 
						   UC.usuario AS usuario_creacion, 
						   UA.usuario AS usuario_autorizacion, 
						   DATE_FORMAT(OCE.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
	    $this->db->from('ordenes_compra_especiales AS OCE');
	    $this->db->join('sat_monedas AS M', 'OCE.moneda_id = M.moneda_id', 'inner');
		$this->db->join('empleados AS E', 'OCE.solicita_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'OCE.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('usuarios AS UC', 'OCE.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('usuarios AS UA', 'OCE.usuario_autorizacion = UA.usuario_id', 'left');
		$this->db->join('porcentaje_retencion_isr AS PIsr', 'OCE.porcentaje_retencion_id = PIsr.porcentaje_retencion_id', 'left');

		//Si existe id de la orden de compra especial
		if ($intOrdenCompraEspecialID != NULL)
		{   
			$this->db->where('OCE.orden_compra_especial_id', $intOrdenCompraEspecialID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			//Si existe id del proveedor
		    if($intProveedorID > 0)
		    {
		   		$this->db->where('OCE.proveedor_id', $intProveedorID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(OCE.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('OCE.estatus', $strEstatus);
			}

		    $this->db->where("((OCE.folio LIKE '%$strBusqueda%') OR
        				      (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			                  (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('OCE.fecha DESC, OCE.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						                     $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('ordenes_compra_especiales AS OCE');
		$this->db->join('sat_monedas AS M', 'OCE.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'OCE.proveedor_id = P.proveedor_id', 'inner');
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del proveedor
	    if($intProveedorID > 0)
	    {
	   		$this->db->where('OCE.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OCE.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OCE.estatus', $strEstatus);
		}

		$this->db->where("((OCE.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProveedorID = NULL,
		                   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('OCE.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OCE.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OCE.estatus', $strEstatus);
		}

		$this->db->where("((OCE.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->from('ordenes_compra_especiales AS OCE');
	    $this->db->join('sat_monedas AS M', 'OCE.moneda_id = M.moneda_id', 'inner');
		$this->db->join('empleados AS E', 'OCE.solicita_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'OCE.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("OCE.orden_compra_especial_id, OCE.folio, DATE_FORMAT(OCE.fecha,'%d/%m/%Y') AS fecha, 
						   OCE.estatus, CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor", FALSE);
		$this->db->from('ordenes_compra_especiales AS OCE');
	    $this->db->join('sat_monedas AS M', 'OCE.moneda_id = M.moneda_id', 'inner');
		$this->db->join('empleados AS E', 'OCE.solicita_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'OCE.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
	    //Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('OCE.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OCE.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OCE.estatus', $strEstatus);
		}

		$this->db->where("((OCE.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))");

		$this->db->order_by('OCE.fecha DESC, OCE.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["ordenes"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros autorizados que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{

		$this->db->select("	OCE.orden_compra_especial_id, CONCAT_WS(' - ', OCE.folio, P.razon_social) AS orden_proveedor", FALSE);
		$this->db->from('ordenes_compra_especiales AS OCE');
		$this->db->join('proveedores AS P', 'OCE.proveedor_id = P.proveedor_id', 'inner');
		$this->db->where('OCE.estatus', 'AUTORIZADO');
		$this->db->where("(OCE.folio LIKE '%$strDescripcion%' OR 
						   P.razon_social LIKE '%$strDescripcion%')"); 
		$this->db->order_by("OCE.folio",'ASC');
		$this->db->limit(LIMITE_AUTOCEOMPLETE, 0);
		return $this->db->get()->result();
		
	}


	/*******************************************************************************************************************
	Funciones de la tabla ordenes_compra_especiales_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la orden de compra
	public function guardar_detalles(stdClass $objOrdenCompra)
	{
		/*Quitar | de la lista para obtener el ID de la cuenta, concepto, cantidad, precio unitario,
		 descuento unitario, iva unitario e ieps unitario
		*/
		$arrCuentaID = explode("|", $objOrdenCompra->strCuentaID);
		$arrConceptos = explode("|", $objOrdenCompra->strConceptos);
		$arrCantidades = explode("|", $objOrdenCompra->strCantidades);
		$arrPreciosUnitarios = explode("|", $objOrdenCompra->strPreciosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objOrdenCompra->strDescuentosUnitarios);
		$arrTasaCuotaIva = explode("|", $objOrdenCompra->strTasaCuotaIva);
		$arrIvasUnitarios = explode("|", $objOrdenCompra->strIvasUnitarios);
		$arrTasaCuotaIeps = explode("|", $objOrdenCompra->strTasaCuotaIeps);
		$arrIepsUnitarios = explode("|", $objOrdenCompra->strIepsUnitarios);

		//Hacer recorrido para insertar los datos en la tabla ordenes_compra_especiales_detalles
		for ($intCon = 0; $intCon < sizeof($arrConceptos); $intCon++) 
		{
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);
			
			//Asignar datos al array
			$arrDatos = array('orden_compra_especial_id' => $objOrdenCompra->intOrdenCompraEspecialID,
							  'renglon' => ($intCon + 1),
							  'cuenta_id' => $arrCuentaID[$intCon],
							  'concepto' => $arrConceptos[$intCon], 
							  'cantidad' => $arrCantidades[$intCon],
							  'precio_unitario' => $arrPreciosUnitarios[$intCon],
							  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva_unitario' => $arrIvasUnitarios[$intCon], 
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps_unitario' => $arrIepsUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('ordenes_compra_especiales_detalles', $arrDatos);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intOrdenCompraEspecialID)
	{
		
		$this->db->select("OCED.renglon, OCED.cuenta_id, OCED.concepto, OCED.cantidad, 
						   OCED.precio_unitario, OCED.descuento_unitario,
						   OCED.tasa_cuota_iva, OCED.iva_unitario, OCED.tasa_cuota_ieps, OCED.ieps_unitario,
						   TIva.valor_maximo AS porcentaje_iva, TIeps.valor_maximo AS porcentaje_ieps,
						   TIeps.valor_minimo AS  valor_minimo_ieps, TIeps.tipo AS tipo_ieps, 
						   TIeps.factor AS factor_ieps, 
						   CCuartoNivel.descripcion AS cuenta_nivel4,
						   CONCAT(CCuartoNivel.cuenta_id,'|',CCuartoNivel.primer_nivel,'-',CCuartoNivel.segundo_nivel, '-', CCuartoNivel.tercer_nivel, '-', CCuartoNivel.cuarto_nivel)
								AS cuentaID_nivel4,
						   CONCAT(CTercerNivel.cuenta_id,'|',CTercerNivel.primer_nivel,'-',CTercerNivel.segundo_nivel, '-', CTercerNivel.tercer_nivel, '-', CTercerNivel.cuarto_nivel)
								AS cuentaID_nivel3,  CTercerNivel.descripcion AS cuenta_nivel3,
						   CONCAT(CSegundoNivel.cuenta_id,'|',CSegundoNivel.primer_nivel,'-',CSegundoNivel.segundo_nivel, '-', CSegundoNivel.tercer_nivel, '-', CSegundoNivel.cuarto_nivel)
								AS cuentaID_nivel2,  CSegundoNivel.descripcion AS cuenta_nivel2,
						   CONCAT(CPrimerNivel.cuenta_id,'|',CPrimerNivel.primer_nivel,'-',CPrimerNivel.segundo_nivel, '-', CPrimerNivel.tercer_nivel, '-', CPrimerNivel.cuarto_nivel)
								AS cuentaID_nivel1,  CPrimerNivel.descripcion AS cuenta_nivel1 ", FALSE);
		$this->db->from('ordenes_compra_especiales_detalles AS OCED');
		$this->db->join('sat_tasa_cuota AS TIva', 'OCED.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'OCED.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('catalogo_cuentas AS CCuartoNivel', 'OCED.cuenta_id = CCuartoNivel.cuenta_id', 'left');
		$this->db->join('catalogo_cuentas AS CTercerNivel', 'CCuartoNivel.cuenta_padre_id = CTercerNivel.cuenta_id', 'left');
		$this->db->join('catalogo_cuentas AS CSegundoNivel', 'CTercerNivel.cuenta_padre_id = CSegundoNivel.cuenta_id', 'left');
		$this->db->join('catalogo_cuentas AS CPrimerNivel', 'CSegundoNivel.cuenta_padre_id = CPrimerNivel.cuenta_id', 'left');
		$this->db->where('OCED.orden_compra_especial_id', $intOrdenCompraEspecialID);
		$this->db->order_by('OCED.renglon', 'ASC');
		return $this->db->get()->result();

	}
}	
?>