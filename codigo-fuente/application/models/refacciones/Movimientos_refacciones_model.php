<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');
//Incluir la clase modelo de CFDI relacionados (para guardar los CFDI relacionados del registro)
include_once(APPPATH . 'models/caja/Cfdi_relacionados_model.php');
//Incluir la clase modelo de cancelaciones (para guardar la cancelación del timbrado (CFDI))
include_once(APPPATH . 'models/contabilidad/Cancelaciones_model.php');
//Incluir la clase modelo de clientes (para modificar el régimen fiscal del anticipo seleccionado)
include_once(APPPATH . 'models/cuentas_cobrar/Clientes_model.php');


class Movimientos_refacciones_model extends CI_model {

	/*******************************************************************************************************************
	Funciones de la tabla movimientos_refacciones
	*********************************************************************************************************************/

	//Método para modificar los datos del timbrado de un registro previamente guardado
	public function modificar_timbrado(stdClass $objTimbrado)
	{
		//Asignar datos al array
		$arrDatos = array('estatus' => 'ACTIVO',
						  'certificado' =>  $objTimbrado->strCertificado, 
						  'sello' => $objTimbrado->strSello, 
						  'uuid' => $objTimbrado->strUuid, 
						  'fecha_timbrado' => $objTimbrado->strFechaTimbrado, 
						  'certificado_sat' => $objTimbrado->strCertificadoSat, 
						  'sello_sat' => $objTimbrado->strSelloSat, 
						  'leyenda_sat' => $objTimbrado->strLeyendaSat, 
						  'rfc_pac' => $objTimbrado->strRfcPac, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objTimbrado->intUsuarioID);
		$this->db->where('movimiento_refacciones_id', $objTimbrado->intReferenciaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('movimientos_refacciones', $arrDatos);
	}


	//Método para regresar la información de un movimiento fiscal que será cancelado
	public function buscar_movimiento_fiscal($intMovimientoRefaccionesID)
	{
		$strSQL = $this->db->query("SELECT E.rfc AS RFC, 
										NOW() AS Fecha, 
										MR.uuid, 
										MR.folio 
									FROM movimientos_refacciones AS MR
									INNER JOIN sucursales AS S ON S.sucursal_id = MR.sucursal_id   
									INNER JOIN empresas E ON E.empresa_id = S.empresa_id
									WHERE MR.movimiento_refacciones_id = $intMovimientoRefaccionesID");
		return $strSQL->result();
	}


	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Entradas de Refacciones por Compra
	*********************************************************************************************************************
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_entrada_compra(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 

		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s"); 

		//Tabla movimientos_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID,
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objMovimiento->dteFecha,  
						  'moneda_id' => $objMovimiento->intMonedaID, 
						  'tipo_cambio' => $objMovimiento->intTipoCambio, 
						  'referencia_id'=> $objMovimiento->intReferenciaID,
						  'proveedor_id' => $objMovimiento->intProveedorID, 
						  'regimen_fiscal_id' => $objMovimiento->intRegimenFiscalID,
						  'porcentaje_retencion_id' => $objMovimiento->intPorcentajeRetencionID,
						  'importe_retenido' => $objMovimiento->intImporteRetenido,
						  'factura' => $objMovimiento->strFactura, 
						  'remision' => $objMovimiento->strRemision, 
						  'tipo_entrada' => $objMovimiento->strTipoEntrada,
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones', $arrDatos);
	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoRefaccionesID  = $this->db->insert_id();


		//Hacer un llamado al método para guardar las refacciones en el inventario (en caso de que no existan)
		$this->guardar_refacciones_inventario($objMovimiento->dteFecha, $objMovimiento->strRefaccionID, 
											  $objMovimiento->strLocalizaciones);



	    //Hacer un llamado al método para guardar los detalles de la entrada de refacciones
		$this->guardar_detalles_entrada_compra($objMovimiento);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoRefaccionesID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar_entrada_compra(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s"); 

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimiento->dteFecha,  
						  'moneda_id' => $objMovimiento->intMonedaID, 
						  'tipo_cambio' => $objMovimiento->intTipoCambio, 
						  'referencia_id'=> $objMovimiento->intReferenciaID,
						  'proveedor_id' => $objMovimiento->intProveedorID, 
						  'regimen_fiscal_id' => $objMovimiento->intRegimenFiscalID,
						  'porcentaje_retencion_id' => $objMovimiento->intPorcentajeRetencionID,
						  'importe_retenido' => $objMovimiento->intImporteRetenido,
						  'factura' => $objMovimiento->strFactura, 
						  'remision' => $objMovimiento->strRemision, 
						  'tipo_entrada' => $objMovimiento->strTipoEntrada,
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_refacciones', $arrDatos);


	    //Hacer un llamado al método para guardar las refacciones en el inventario (en caso de que no existan)
		$this->guardar_refacciones_inventario($objMovimiento->dteFecha, $objMovimiento->strRefaccionID,
											  $objMovimiento->strLocalizaciones);

	    //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($objMovimiento->intMovimientoRefaccionesID, 
	   													  $objMovimiento->intTipoMovimiento, 
	   													  $objMovimiento->dteFecha);

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->delete('movimientos_refacciones_detalles');

		//Hacer un llamado al método para guardar los detalles de la entrada de refacciones
		$this->guardar_detalles_entrada_compra($objMovimiento);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intMovimientoRefaccionesID, $intTipoMovimiento, $intPolizaID = NULL)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('movimiento_refacciones_id', $intMovimientoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_refacciones', $arrDatos);

		//Si existe el id de la póliza
		if($intPolizaID > 0)
		{
			//Se crea una instancia de la clase modelo (pólizas) 
       		$otdModelPolizas = new Polizas_model();
       		//Hacer un llamado al método para modificar el estatus de la póliza 
			$otdModelPolizas->set_estatus($intPolizaID, 'INACTIVO');
		}

		//Seleccionar la fecha del movimiento que coincide con el id
		$otdFechaMovimiento = $this->buscar_fecha_movimiento($intMovimientoRefaccionesID);

		//Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($intMovimientoRefaccionesID, $intTipoMovimiento, 
	   													  $otdFechaMovimiento->fecha);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}


	//Método para modificar el estatus de un registro (cancelar timbrado CFDI)
	public function set_cancelar(stdClass $objCancelacionCfdi)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Se crea una instancia de la clase modelo (cancelaciones) 
        $otdModelCancelaciones = new Cancelaciones_model();

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('movimiento_refacciones_id', $objCancelacionCfdi->intReferenciaCfdiID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_refacciones', $arrDatos);

		//Si existe el id de la póliza
		if($objCancelacionCfdi->intPolizaID > 0)
		{
			//Se crea una instancia de la clase modelo (pólizas) 
       		$otdModelPolizas = new Polizas_model();
       		//Hacer un llamado al método para modificar el estatus de la póliza 
			$otdModelPolizas->set_estatus($objCancelacionCfdi->intPolizaID, 'INACTIVO');
		}

		//Seleccionar la fecha del movimiento que coincide con el id
		$otdFechaMovimiento = $this->buscar_fecha_movimiento($objCancelacionCfdi->intReferenciaCfdiID);

		//Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($objCancelacionCfdi->intReferenciaCfdiID, $otdFechaMovimiento->tipo_movimiento, 
	   													  $otdFechaMovimiento->fecha);


	   	//Hacer un llamado al método para guardar cancelación del timbrado
		$otdModelCancelaciones->guardar($objCancelacionCfdi);


		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_entrada_compra($intMovimientoRefaccionesID = NULL, $intTipoMovimiento = NULL, 
						   		   		  $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   		  $intProveedorID = NULL, $strEstatus = NULL, 
						   		   		  $strBusqueda =  NULL)
	{

		//Constante para identificar al tipo de movimiento salida de refacciones por devolución al proveedor
		$intMovSalidaDevolucion = SALIDA_REFACCIONES_DEVOLUCION_PROVEEDOR;
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR COMPRA');
		
		$this->db->select("MR.movimiento_refacciones_id, MR.folio,
						   DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha, MR.moneda_id, MR.tipo_cambio,
						   MR.proveedor_id, MR.regimen_fiscal_id, MR.porcentaje_retencion_id, 
						   MR.importe_retenido, MR.factura, MR.remision, MR.tipo_entrada,
						   MR.observaciones, MR.estatus, CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, 
						   P.rfc, P.telefono_principal, P.calle, P.numero_exterior, P.numero_interior, P.colonia,
						   CP.codigo_postal, P.localidad, MP.descripcion AS municipio, 
						   EP.descripcion AS estado, OCR.orden_compra_refacciones_id, OCR.folio AS folio_orden_compra,
						   M.codigo AS codigo_moneda, CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   (SELECT IFNULL(COUNT(MRS.movimiento_refacciones_id), 0)
							FROM movimientos_refacciones AS MRS
							WHERE MRS.tipo_movimiento = $intMovSalidaDevolucion
							AND MRS.referencia_id = MR.movimiento_refacciones_id
							AND MRS.estatus = 'ACTIVO') AS total_salidas_devolucion_proveedor,
							IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza,
						   	 PIsr.porcentaje AS porcentaje_isr, 
							UC.usuario AS usuario_creacion, 
							DATE_FORMAT(MR.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('sat_monedas AS M', 'MR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'MR.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('ordenes_compra_refacciones AS OCR', 'MR.referencia_id = OCR.orden_compra_refacciones_id', 'left');
		$this->db->join('usuarios AS UC', 'MR.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'MR.movimiento_refacciones_id = PF.referencia_id
	    							        AND PF.proceso = '.$strTipoMovimiento.' 
	    							        AND PF.modulo = "REFACCIONES"', 'left');
		$this->db->join('porcentaje_retencion_isr AS PIsr', 'MR.porcentaje_retencion_id = PIsr.porcentaje_retencion_id', 'left');
	
		//Si existe id del movimiento
		if ($intMovimientoRefaccionesID !== NULL)
		{   
			$this->db->where('MR.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
			//Si existe id del proveedor
		    if($intProveedorID > 0)
		    {
		   		$this->db->where('MR.proveedor_id', $intProveedorID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		   //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				    $this->db->where("(MR.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('MR.estatus', $strEstatus);
				}
			}

			$this->db->where("((MR.folio LIKE '%$strBusqueda%') OR
							   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
					           (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 


		    $this->db->order_by('MR.fecha DESC, MR.folio DESC');
		    return $this->db->get()->result();
		}

	}

	//Método para regresar la fecha del movimiento que coincide con el id proporcionado
	public function buscar_fecha_movimiento($intMovimientoRefaccionesID)
	{
		$this->db->select("DATE_FORMAT(fecha,'%Y-%m-%d') AS fecha, tipo_movimiento", FALSE);
		$this->db->from('movimientos_refacciones');
		$this->db->where('movimiento_refacciones_id', $intMovimientoRefaccionesID);
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($intTipoMovimiento, $dteFechaInicial = NULL, 
		                                     $dteFechaFinal = NULL, $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;
        
		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('sat_monedas AS M', 'MR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'MR.proveedor_id = P.proveedor_id', 'inner');
		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del proveedor
	    if($intProveedorID > 0)
	    {
	   		$this->db->where('MR.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MR.estatus', $strEstatus);
		}

		$this->db->where("((MR.folio LIKE '%$strBusqueda%') OR
						   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
				           (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))");

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_entrada_compra($intTipoMovimiento, $dteFechaInicial = NULL, 
										  $dteFechaFinal = NULL, $intProveedorID = NULL, 
										  $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Constante para identificar al tipo de movimiento salida de refacciones por devolución al proveedor
		$intMovSalidaDevolucion = SALIDA_REFACCIONES_DEVOLUCION_PROVEEDOR;
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR COMPRA');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('MR.proveedor_id', $intProveedorID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 


	   //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
			    $this->db->where("(MR.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MR.estatus', $strEstatus);
			}
		}

		$this->db->where("((MR.folio LIKE '%$strBusqueda%') OR
						   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
				           (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('sat_monedas AS M', 'MR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'MR.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('polizas AS PF', 'MR.movimiento_refacciones_id = PF.referencia_id
	    							        AND PF.proceso = '.$strTipoMovimiento.' 
	    							        AND PF.modulo = "REFACCIONES"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MR.movimiento_refacciones_id, MR.folio, MR.estatus,
						   DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha,
						   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, P.proveedor_id,
						   (SELECT IFNULL(COUNT(MRS.movimiento_refacciones_id), 0)
							FROM movimientos_refacciones AS MRS
							WHERE MRS.tipo_movimiento = $intMovSalidaDevolucion
							AND MRS.referencia_id = MR.movimiento_refacciones_id
							AND MRS.estatus = 'ACTIVO') AS total_salidas_devolucion_proveedor,
							IFNULL(PF.poliza_id, 0) AS poliza_id, 
						    PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('sat_monedas AS M', 'MR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'MR.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('polizas AS PF', 'MR.movimiento_refacciones_id = PF.referencia_id
	    							        AND PF.proceso = '.$strTipoMovimiento.' 
	    							        AND PF.modulo = "REFACCIONES"', 'left');
		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('MR.proveedor_id', $intProveedorID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  


	  //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
			    $this->db->where("(MR.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MR.estatus', $strEstatus);
			}
		}

		$this->db->where("((MR.folio LIKE '%$strBusqueda%') OR
						   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
				           (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
		$this->db->order_by('MR.fecha DESC, MR.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado (se utiliza para validar existencia del archivo XML)
	public function buscarXML_entrada_compra($intTipoMovimiento, $intProveedorID, $strFactura)
	{

		$this->db->select("MR.movimiento_refacciones_id", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('proveedores AS P', 'MR.proveedor_id = P.proveedor_id', 'inner');
		$this->db->where('MR.sucursal_id',  $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
		$this->db->where('MR.estatus', 'ACTIVO');
		$this->db->where('MR.proveedor_id', $intProveedorID);
		$this->db->where('MR.factura', $strFactura);
		return $this->db->get()->result();
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $intTipoMovimiento, $strTipo = NULL)
	{

		//Constante para identificar al tipo de movimiento entrada de refacciones por traspaso
		$intMovEntradaTraspaso = ENTRADA_REFACCIONES_TRASPASO;

		//Asignar número de registros para el autocomplete
    	$intLimite = LIMITE_AUTOCOMPLETE;
		//Dependiendo del tipo de movimiento realizar la búsqueda de datos
		if($intTipoMovimiento == ENTRADA_REFACCIONES_COMPRA)
		{
			$this->db->select("	MR.movimiento_refacciones_id, 
			                CONCAT_WS(' - ', MR.folio, P.razon_social) AS movimiento", FALSE);
			$this->db->from('movimientos_refacciones AS MR');
			$this->db->join('proveedores AS P', 'MR.proveedor_id = P.proveedor_id', 'inner');
			$this->db->where('MR.sucursal_id',  $this->session->userdata('sucursal_id'));
			$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
			$this->db->where('MR.estatus', 'ACTIVO');
			$this->db->where("(MR.folio LIKE '%$strDescripcion%' OR
							   P.razon_social LIKE '%$strDescripcion%')");
			$this->db->limit($intLimite, 0);
			return $this->db->get()->result();
		}
		else if($intTipoMovimiento == SALIDA_REFACCIONES_TRASPASO)
		{

			$this->db->select("	MR.movimiento_refacciones_id, 
			                   CONCAT_WS(' - ', MR.folio, S.nombre) AS movimiento", FALSE);
			$this->db->from('movimientos_refacciones AS MR');
			$this->db->join('solicitudes_traspasos_refacciones AS STR', 'MR.referencia_id = STR.solicitud_traspaso_refacciones_id', 'inner');
			$this->db->join('sucursales AS S', 'STR.sucursal_salida_id = S.sucursal_id', 'inner');
			$this->db->join('movimientos_refacciones AS MRE', 'MRE.referencia_id = MR.movimiento_refacciones_id AND MRE.tipo_movimiento = '.$intMovEntradaTraspaso.'', 'left');
			$this->db->where("(MRE.movimiento_refacciones_id IS NULL OR
							   MRE.estatus = 'INACTIVO')");
			$this->db->where('STR.sucursal_id',  $this->session->userdata('sucursal_id'));
			$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
			$this->db->where('MR.estatus', 'ACTIVO');
			$this->db->where("(MR.folio LIKE '%$strDescripcion%' OR
							   S.nombre LIKE '%$strDescripcion%')");
			$this->db->limit($intLimite, 0);
			return $this->db->get()->result();
		}
		else if($intTipoMovimiento == ENTRADA_REFACCIONES_DEVOLUCION_FACTURA)
		{
			//Si el Autocomplete es por referencias (facturas de refacciones y facturas de servicios)
		    if($strTipo == 'referencias')
		    {
		    	//Variable que se utiliza para formar la  consulta
				$queryFacturas = '';

				//Facturas de refacciones
				$queryRefacciones = "SELECT Reg.factura_refacciones_id  AS referencia_id, 
							   		   CONCAT_WS(' - ', Reg.folio, 'REFACCIONES') AS referencia,
							   		   'REFACCIONES' AS tipo_referencia,
							   		   'FACTURA REFACCIONES' AS modulo, 
									   SUM(((Det.precio_unitario + Det.iva_unitario + Det.ieps_unitario) * Det.cantidad) / Reg.tipo_cambio) AS importe, 
									   CASE 
										  WHEN  Reg.regimen_fiscal_id > 0 
										  THEN Reg.regimen_fiscal_id		
										ELSE IFNULL(C.regimen_fiscal_id,0)
									    END regimen_fiscal_id
									FROM facturas_refacciones AS Reg
									INNER JOIN clientes AS C ON Reg.prospecto_id = C.prospecto_id
									INNER JOIN facturas_refacciones_detalles AS Det ON Reg.factura_refacciones_id = Det.factura_refacciones_id
									WHERE Reg.estatus = 'ACTIVO'
									AND (Reg.folio LIKE '%$strDescripcion%' OR 
										 CONCAT_WS(' - ', Reg.folio, 'REFACCIONES') LIKE '%$strDescripcion%' OR 
										 CONCAT_WS('-', Reg.folio, 'REFACCIONES') LIKE '%$strDescripcion%')
									GROUP BY Reg.factura_refacciones_id ";

				//Refacciones de las facturas de servicio
				$queryServicio = "SELECT Reg.factura_servicio_id  AS referencia_id, 
    							   		   CONCAT_WS(' - ', Reg.folio, 'SERVICIO') AS referencia,
    							   		   'SERVICIO' AS tipo_referencia, 
    							   		   'FACTURA SERVICIO' AS modulo, 
    							   		     IFNULL(SUM(((Det.precio_unitario + Det.iva_unitario + Det.ieps_unitario) * Det.cantidad) / Reg.tipo_cambio), 0) AS importe, 
    							   		    CASE 
											  WHEN  Reg.regimen_fiscal_id > 0 
											  THEN Reg.regimen_fiscal_id		
											ELSE IFNULL(C.regimen_fiscal_id,0)
										    END regimen_fiscal_id
    								FROM facturas_servicio AS Reg
									INNER JOIN facturas_servicio_refacciones AS Det ON Det.factura_servicio_id = Reg.factura_servicio_id
									INNER JOIN clientes AS C ON Reg.prospecto_id = C.prospecto_id
    								WHERE Reg.factura_servicio_id NOT IN (SELECT NCS.factura_servicio_id 
    																      FROM  notas_credito_servicio AS NCS
						 								  				  WHERE (NCS.estatus = 'ACTIVO' OR 
						 								  				  		 NCS.estatus = 'TIMBRAR'))
						 		    AND  Reg.estatus = 'ACTIVO'
    								AND   (Reg.folio LIKE '%$strDescripcion%'  OR 
    									   CONCAT_WS(' - ', Reg.folio, 'SERVICIO') LIKE '%$strDescripcion%' OR 
    									   CONCAT_WS('-', Reg.folio, 'REFACCIONES') LIKE '%$strDescripcion%')
    								GROUP BY Reg.factura_servicio_id";

    			//Formar consulta
				$queryFacturas .= $queryRefacciones;
		   	    $queryFacturas .= " UNION ";
		   	    $queryFacturas .= $queryServicio;
		   	    $queryFacturas .= " ORDER BY referencia ASC";
		   	    $queryFacturas .= " LIMIT 0, $intLimite";
		   	    
		   	    $strSQL = $this->db->query($queryFacturas);
				return $strSQL->result();
		    	
		    }

		}
		else
		{


			$this->db->select("	MR.movimiento_refacciones_id,  MR.folio AS movimiento", FALSE);
			$this->db->from('movimientos_refacciones AS MR');
			$this->db->where('MR.sucursal_id',  $this->session->userdata('sucursal_id'));
			$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
			$this->db->where('MR.estatus', 'ACTIVO');
			$this->db->where("(MR.folio LIKE '%$strDescripcion%')");
			$this->db->order_by('MR.fecha DESC, MR.folio DESC');
			$this->db->limit($intLimite, 0);
			return $this->db->get()->result();
		}
		
	}


	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	//Se utiliza para la cancelación del CFDI
	public function autocomplete_cancelacion($strDescripcion, $intTipoMovimiento, $intReferenciaID)
	{
		$this->db->select('movimiento_refacciones_id, folio, uuid');
        $this->db->from('movimientos_refacciones');
        $this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
        $this->db->where('tipo_movimiento', $intTipoMovimiento);
        $this->db->where('movimiento_refacciones_id <>', $intReferenciaID);
     	$this->db->where('estatus', 'ACTIVO');
        $this->db->where("(folio LIKE '%$strDescripcion%')");
        $this->db->order_by('folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	
	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Entradas de Refacciones por Devolución de la Factura
	*********************************************************************************************************************
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_entrada_devolucion_factura(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
         //Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 


		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s"); 

		//Tabla movimientos_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID,
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objMovimiento->dteFecha,  
						  'moneda_id' => $objMovimiento->intMonedaID, 
						  'tipo_cambio' => $objMovimiento->intTipoCambio, 
						  'tipo_referencia'=> $objMovimiento->strTipoReferencia,
						  'referencia_id'=> $objMovimiento->intReferenciaID,
						  'empleado_autorizacion' => $objMovimiento->intEmpleadoAutorizacion,
						  'forma_pago_id'=> $objMovimiento->intFormaPagoID,
						  'metodo_pago_id'=> $objMovimiento->intMetodoPagoID, 
						  'uso_cfdi_id'=> $objMovimiento->intUsoCfdiID, 
						  'tipo_relacion_id'=> $objMovimiento->intTipoRelacionID, 
						  'exportacion_id'=> $objMovimiento->intExportacionID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'estatus' => 'TIMBRAR',
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones', $arrDatos);
	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoRefaccionesID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar las refacciones en el inventario (en caso de que no existan)
		$this->guardar_refacciones_inventario($objMovimiento->dteFecha, $objMovimiento->strRefaccionID);

	    //Hacer un llamado al método para guardar los detalles de la entrada por devolución de la factura
		$this->guardar_detalles_entrada_devolucion_factura($objMovimiento);

		//Hacer un llamado al método para guardar los CFDI relacionados del movimiento
		$otdModelCfdiRelacionados->guardar($objMovimiento->intMovimientoRefaccionesID, 
										   'DEVOLUCION REFACCIONES', 
										   $objMovimiento->strCfdiRelacionado, 
										   $objMovimiento->strTiposRelacion);


		//Si se cumple la sentencia modificar el régimen fiscal de la factura (significa que la referencia seleccionada no tenia régimen fiscal y el usuario modificó el régimen fiscal del cliente)
		if($objMovimiento->strModRegimenFiscal == 'SI')
		{
			//Se crea una instancia de la clase modelo (Clientes) 
       		$otdModelClientes = new  Clientes_model();

       		//Hacer un llamado al método para modificar el id del régimen fiscal de una referencia
       		$otdModelClientes->set_regimen_fiscal($objMovimiento->intMovimientoRefaccionesID, 
										  		  $objMovimiento->strTipoReferencia, 
										  		  $objMovimiento->intRegimenFiscalID);

		}


		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoRefaccionesID;
	}


	

    //Método para modificar los datos de un registro previamente guardado
	public function modificar_entrada_devolucion_factura(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (CFDI relacionados) 
        $otdModelCfdiRelacionados = new  Cfdi_relacionados_model();

        //Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s"); 

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimiento->dteFecha,  
						  'moneda_id' => $objMovimiento->intMonedaID, 
						  'tipo_cambio' => $objMovimiento->intTipoCambio, 
						  'referencia_id'=> $objMovimiento->intReferenciaID,
						  'empleado_autorizacion' => $objMovimiento->intEmpleadoAutorizacion, 
						  'forma_pago_id' => $objMovimiento->intFormaPagoID,
						  'metodo_pago_id' => $objMovimiento->intMetodoPagoID,
						  'uso_cfdi_id' => $objMovimiento->intUsoCfdiID,
						  'tipo_relacion_id' => $objMovimiento->intTipoRelacionID,
						  'exportacion_id'=> $objMovimiento->intExportacionID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_refacciones', $arrDatos);

	    //Hacer un llamado al método para guardar las refacciones en el inventario (en caso de que no existan)
		$this->guardar_refacciones_inventario($objMovimiento->dteFecha, $objMovimiento->strRefaccionID);

	    //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($objMovimiento->intMovimientoRefaccionesID, 
	   													  $objMovimiento->intTipoMovimiento, 
	   													  $objMovimiento->dteFecha);

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->delete('movimientos_refacciones_detalles');

		//Hacer un llamado al método para guardar los detalles de la entrada por devolución de la factura
		$this->guardar_detalles_entrada_devolucion_factura($objMovimiento);

		//Hacer un llamado al método para guardar los CFDI relacionados del movimiento
		$otdModelCfdiRelacionados->guardar($objMovimiento->intMovimientoRefaccionesID, 
										   'DEVOLUCION REFACCIONES',
										   $objMovimiento->strCfdiRelacionado,
										   $objMovimiento->strTiposRelacion);


		//Si se cumple la sentencia modificar el régimen fiscal de la factura (significa que la referencia seleccionada no tenia régimen fiscal y el usuario modificó el régimen fiscal del cliente)
		if($objMovimiento->strModRegimenFiscal == 'SI')
		{

			//Se crea una instancia de la clase modelo (Clientes) 
       		$otdModelClientes = new  Clientes_model();

       		//Hacer un llamado al método para modificar el id del régimen fiscal de una referencia
       		$otdModelClientes->set_regimen_fiscal($objMovimiento->intReferenciaID, 
										  		  $objMovimiento->strTipoReferencia, 
										  		  $objMovimiento->intRegimenFiscalID);

		}

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}



	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_entrada_devolucion_factura($intMovimientoRefaccionesID = NULL, $intTipoMovimiento = NULL,
													  $dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL,$strEstatus = NULL, $strBusqueda = NULL)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID = $this->session->userdata('sucursal_id');
		
		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		$strRestricciones = '';

		//Variable que se utiliza para ordenar los registros dependiendo del tipo de búsqueda
		$strOrdenamiento = '';

		 //Variable que se utiliza para agregar union con la tabla facturas_refacciones
	    $strUnionFacturaRefacciones  = "INNER JOIN facturas_refacciones AS FR ON MR.referencia_id = FR.factura_refacciones_id
                                        AND MR.tipo_referencia = 'REFACCIONES'
                                        LEFT JOIN sat_regimen_fiscal AS RF ON RF.regimen_fiscal_id = FR.regimen_fiscal_id";

       	//Variable que se utiliza para agregar union con la tabla facturas_servicio
	    $strUnionFacturaServicio = "INNER JOIN facturas_servicio AS FR ON MR.referencia_id = FR.factura_servicio_id 
	                                AND MR.tipo_referencia = 'SERVICIO'
	                                LEFT JOIN sat_regimen_fiscal AS RF ON RF.regimen_fiscal_id = FR.regimen_fiscal_id";

		//Variable que se utiliza para agregar union con la tabla clientes (y sus tablas relacionadas)
	    $strUnionClientes = "INNER JOIN clientes AS C ON FR.prospecto_id = C.prospecto_id
	    					 INNER JOIN prospectos AS PRO ON PRO.prospecto_id = C.prospecto_id
	                         INNER JOIN municipios AS MC ON C.municipio_id = MC.municipio_id
	                         INNER JOIN sat_estados AS EC ON MC.estado_id = EC.estado_id
	                         LEFT JOIN sat_codigos_postales AS CCP ON C.codigo_postal_id = CCP.codigo_postal_id";

		//Si existe id del movimiento
		if ($intMovimientoRefaccionesID !== NULL)
		{   
			

			$strRestricciones .= "WHERE MR.movimiento_refacciones_id = $intMovimientoRefaccionesID";
		}
		else
		{

			$strRestricciones .= "WHERE MR.sucursal_id = $intSucursalID ";
			$strRestricciones .= "AND MR.tipo_movimiento = $intTipoMovimiento ";

			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$strRestricciones .= "AND FR.prospecto_id = $intProspectoID ";
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {

		    	$strRestricciones .= "AND (DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
		    } 



 		//Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$strRestricciones .= " AND (IFNULL(PF.poliza_id, 0) = 0)";
				$strRestricciones .= " AND (MR.estatus = 'TIMBRAR' OR MR.estatus = 'ACTIVO')";
			}
			else
			{
				$strRestricciones .= " AND (MR.estatus = '$strEstatus')";
			}
		}



    		$strRestricciones .= " AND ((MR.folio LIKE '%$strBusqueda%') OR
   			(C.nombre_comercial LIKE '%$strBusqueda%') OR
	   		(FR.folio LIKE '%$strBusqueda%')OR	   		
	   		(MR.tipo_referencia LIKE '%$strBusqueda%'))";

		    $strOrdenamiento .= "ORDER BY folio DESC";
		}

	  

	    //Variable que se utiliza para formar la  consulta
	    $strConsulta = "SELECT MR.movimiento_refacciones_id, MR.folio, MR.fecha, 
			   				   DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha_format, 
			   				   MR.moneda_id,  MR.tipo_cambio, MR.tipo_referencia, MR.referencia_id,  
			   				   MR.empleado_autorizacion, MR.forma_pago_id, MR.metodo_pago_id, 
			  				   MR.uso_cfdi_id,  MR.tipo_relacion_id, MR.exportacion_id, MR.observaciones, MR.estatus,
			  				   MR.certificado, MR.sello, MR.uuid, MR.fecha_timbrado, 
			  				   MR.certificado_sat, MR.sello_sat, MR.leyenda_sat, MR.rfc_pac,
			  				   M.codigo AS MonedaTipo, 
							   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
			   				   CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, FP.codigo AS FormaPago,
			   				   CONCAT_WS(' - ', MP.codigo, MP.descripcion) AS metodo_pago, MP.codigo AS MetodoPago,
			   				   CONCAT_WS(' - ', U.codigo, U.descripcion) AS uso_cfdi, U.codigo AS UsoCFDI,
			   				   CONCAT_WS(' - ', TR.codigo, TR.descripcion) AS tipo_relacion, TR.codigo AS TipoRelacion,
			   				   _utf8'' AS CondicionesDePago, _utf8'E' AS TipoDeComprobante, 
			   				   CONCAT_WS(' - ', TC.codigo, TC.descripcion) AS tipo_comprobante,
			   				   RF.codigo AS RegimenFiscal,
							   CONCAT_WS(' - ', RF.codigo, RF.descripcion) AS regimen_fiscal,
							   ECF.codigo AS CodigoExportacion,
							   CONCAT_WS(' - ', ECF.codigo, ECF.descripcion) AS exportacion,
							   FR.folio AS folio_factura, FR.rfc, 
							   CASE 
								  WHEN  FR.regimen_fiscal_id > 0 
								  THEN FR.regimen_fiscal_id		
								ELSE IFNULL(C.regimen_fiscal_id,0)
							    END regimen_fiscal_id,
							   IFNULL(FR.regimen_fiscal_id,0) AS regimenFiscalAnterior,
							   FR.razon_social AS cliente, C.correo_electronico, 
							   C.contacto_correo_electronico,FR.razon_social, C.telefono_principal AS telefono_principal, 
							   C.calle, C.numero_exterior, C.numero_interior, CCP.codigo_postal,
							   C.colonia, C.localidad, MC.descripcion AS municipio,  
							   EC.descripcion estado,  
							   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
							   PRO.codigo AS CodigoProspecto,
							   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	   PF.folio AS folio_poliza,
							   UC.usuario AS usuario_creacion, 
							   DATE_FORMAT(MR.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion
						FROM  movimientos_refacciones AS MR
						INNER JOIN sat_monedas AS M ON MR.moneda_id = M.moneda_id
						INNER JOIN sat_forma_pago AS FP ON MR.forma_pago_id = FP.forma_pago_id
						INNER JOIN sat_metodos_pago AS MP ON MR.metodo_pago_id = MP.metodo_pago_id
						INNER JOIN sat_uso_cfdi AS U ON MR.uso_cfdi_id = U.uso_cfdi_id
						INNER JOIN sat_tipos_relacion AS TR ON MR.tipo_relacion_id = TR.tipo_relacion_id
						INNER JOIN empleados AS E ON MR.empleado_autorizacion = E.empleado_id
						INNER JOIN usuarios AS UC ON MR.usuario_creacion = UC.usuario_id
						LEFT JOIN sat_exportacion AS ECF ON MR.exportacion_id = ECF.exportacion_id
						LEFT JOIN sat_tipos_comprobante AS TC ON TC.codigo = 'E'
						LEFT JOIN polizas AS PF ON MR.movimiento_refacciones_id = PF.referencia_id
							 AND  PF.modulo = 'REFACCIONES'
							 AND  PF.proceso = 'ENTRADA POR DEVOLUCION DE CLIENTE'";


		$strSQL = $this->db->query("$strConsulta
									$strUnionFacturaRefacciones
									$strUnionClientes
									$strRestricciones
									UNION
									$strConsulta
									$strUnionFacturaServicio
									$strUnionClientes
									$strRestricciones
									$strOrdenamiento");

		//Si existe id del movimiento
		if ($intMovimientoRefaccionesID !== NULL)
		{	
			return $strSQL->row();
		}
		else
		{
			return $strSQL->result();
		}

	}


	

	/*Método para regresar las devoluciones de facturas que con el criterio de búsqueda proporcionado
	 (se utiliza en el reporte de facturación)*/
	public function buscar_devoluciones_facturas($dteFechaInicial, $dteFechaFinal, $intProspectoID = NULL,  
												 $intMonedaID = NULL, $strTipoReferencia = NULL, 
												 $strSucursales = NULL, $strServiciosTipos = NULL)
	{
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución de la factura
		$intMovDevRef = ENTRADA_REFACCIONES_DEVOLUCION_FACTURA;
		//Prospecto
		$strRestriccionesProspecto = '';
		//Moneda
		$strRestriccionesMoneda = '';
		//ID´s de las sucursales
		$strRestriccionesSucursales = '';
		//ID´s de los tipos de servicios
		$strRestriccionesServiciosTipos = '';
		//Variable que se utiliza para ordenar los registros dependiendo del tipo de búsqueda
		$strOrdenamiento = " ORDER BY ";


		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			$strRestriccionesProspecto .= " AND C.prospecto_id = $intProspectoID";
		}

		 //Si existe id de la moneda
		if($intMonedaID > 0)
		{
			$strRestriccionesMoneda .= " AND MR.moneda_id = $intMonedaID";
			$strOrdenamiento .= " MR.moneda_id,";
		}

		$strOrdenamiento .= " MR.fecha, MR.folio";

		//Si existen sucursales seleccionadas
		if($strSucursales)
		{	

			//Generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
			$strRestriccionesSucursales .= " AND MR.sucursal_id IN (";

		    //Quitar | de la lista para obtener el id de la sucursal
			$arrSucursales = explode("|", $strSucursales);

			//Hacer recorrido para formar restricción con los ID's de las sucursales
			for ($intCon = 0; $intCon < sizeof($arrSucursales); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otra sucursal)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesSucursales .= ",";
				}

				//Concatenar id de la sucursal 
				$strRestriccionesSucursales .= $arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}


		//Si existen tipos de servicios seleccionados
		if($strServiciosTipos)
		{	

			//Dependiendo del tipo de referencia agregar restricción
			if($strTipoReferencia == 'SERVICIO') //facturas de servicio
			{
				//Generar las condiciones dinamicas de las consultas respecto a la columna servicio_tipo_id
				$strRestriccionesServiciosTipos .= " AND OREP.servicio_tipo_id IN (";
			}
			else //facturas de refacciones
			{
				///Generar las condiciones dinamicas de las consultas respecto a la columna  tipo: Mostrador, Refaccionario, Campo, etc. 
				$strRestriccionesServiciosTipos .= " AND FR.tipo IN (";
			}

			

		    //Quitar | de la lista para obtener el id del tipo de servicio
			$arrServiciosTipos = explode("|", $strServiciosTipos);

			//Hacer recorrido para formar restricción con los ID's de los tipos de servicios
			for ($intCon = 0; $intCon < sizeof($arrServiciosTipos); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otro tipo de servicio)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesServiciosTipos .= ",";
				}

				

				//Concatenar id del tipo de servicio 
				$strRestriccionesServiciosTipos .= "'".$arrServiciosTipos[$intCon]."'";
			}

			$strRestriccionesServiciosTipos .= ")";

		}

		//Dependiendo del tipo de referencia formar la consulta
		if($strTipoReferencia == 'SERVICIO') //Facturas de servicio
		{

			//Variable que se utiliza para formar la  consulta
			$strConsulta = "SELECT MR.movimiento_refacciones_id, MR.folio, MR.tipo_cambio, MR.estatus,
		   				   DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha,
		   				   FR.folio AS folio_factura,
		   				   C.razon_social,
		   				   OREP.folio AS folio_orden_reparacion,
		   				   OREP.servicio_tipo_id, S.nombre AS sucursal, ST.descripcion AS servicio_tipo,
		   				   Detalles.subtotal,
		   				   Detalles.iva,
		   				   Detalles.ieps,
		   				   Detalles.importe
			   		    FROM  movimientos_refacciones AS MR
			   		    INNER JOIN facturas_servicio AS FR ON FR.factura_servicio_id = MR.referencia_id
			   		    INNER JOIN (SELECT 
							         Reg.factura_servicio_id AS referenciaID,
							         MR.movimiento_refacciones_id AS movimientoID,
							            SUM(ROUND(((Det.precio_unitario * MRD.cantidad) / MR.tipo_cambio), 2)) AS subtotal,
							            SUM(ROUND(((Det.iva_unitario * MRD.cantidad) / MR.tipo_cambio), 2)) AS iva,
							            SUM(ROUND(((Det.ieps_unitario * MRD.cantidad) / MR.tipo_cambio), 2)) AS ieps,
							            SUM(ROUND(((Det.precio_unitario * MRD.cantidad) / MR.tipo_cambio), 2) + ROUND(((Det.iva_unitario * MRD.cantidad) / MR.tipo_cambio), 2) + ROUND(((Det.ieps_unitario * MRD.cantidad) / MR.tipo_cambio), 2)) AS importe
								    FROM
								        facturas_servicio AS Reg
								   INNER JOIN    movimientos_refacciones AS MR ON Reg.factura_servicio_id = MR.referencia_id AND MR.tipo_referencia = 'SERVICIO'
								   INNER JOIN movimientos_refacciones_detalles AS MRD ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
								   INNER JOIN facturas_servicio_refacciones AS Det ON Reg.factura_servicio_id = Det.factura_servicio_id AND Det.refaccion_id = MRD.refaccion_id AND Det.renglon = MRD.renglon
								   WHERE MR.tipo_movimiento = $intMovDevRef
								   GROUP BY MR.movimiento_refacciones_id) AS Detalles ON Detalles.referenciaID =  MR.referencia_id AND Detalles.movimientoID = MR.movimiento_refacciones_id
						INNER JOIN ordenes_reparacion AS OREP ON FR.orden_reparacion_id = OREP.orden_reparacion_id
						INNER JOIN servicios_tipos AS ST ON OREP.servicio_tipo_id = ST.servicio_tipo_id
					    INNER JOIN clientes AS C ON FR.prospecto_id = C.prospecto_id
						INNER JOIN prospectos AS PRO ON PRO.prospecto_id = C.prospecto_id
						INNER JOIN sat_monedas AS M ON MR.moneda_id = M.moneda_id
						INNER JOIN sucursales AS S ON MR.sucursal_id = S.sucursal_id
						WHERE MR.tipo_movimiento = $intMovDevRef
			   			AND MR.tipo_referencia = '$strTipoReferencia'
			   		    AND  DATE_FORMAT(MR.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'
					    $strRestriccionesSucursales 
					    $strRestriccionesServiciosTipos
					    $strRestriccionesMoneda
					    $strRestriccionesProspecto
					    $strOrdenamiento";
		}
		else if($strTipoReferencia == 'REFACCIONES')//Facturas de refacciones
		{
			//Variable que se utiliza para formar la  consulta
			$strConsulta = "SELECT MR.movimiento_refacciones_id, MR.folio, MR.tipo_cambio, MR.estatus,
		   				   DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha,
		   				   FR.folio AS folio_factura,
		   				   C.razon_social,
		   				   FR.tipo, FR.condiciones_pago, S.nombre AS sucursal, 
		   				   Detalles.subtotal,
		   				   Detalles.iva,
		   				   Detalles.ieps,
		   				   Detalles.importe
			   		    FROM  movimientos_refacciones AS MR
			   		    INNER JOIN facturas_refacciones AS FR ON FR.factura_refacciones_id = MR.referencia_id
			   		    INNER JOIN (SELECT 
							         Reg.factura_refacciones_id AS referenciaID,
							         MR.movimiento_refacciones_id AS movimientoID,
							            SUM(ROUND(((Det.precio_unitario * MRD.cantidad) / MR.tipo_cambio), 2)) AS subtotal,
							            SUM(ROUND(((Det.iva_unitario * MRD.cantidad) / MR.tipo_cambio), 2)) AS iva,
							            SUM(ROUND(((Det.ieps_unitario * MRD.cantidad) / MR.tipo_cambio), 2)) AS ieps,
							            SUM(ROUND(((Det.precio_unitario * MRD.cantidad) / MR.tipo_cambio), 2) + ROUND(((Det.iva_unitario * MRD.cantidad) / MR.tipo_cambio), 2) + ROUND(((Det.ieps_unitario * MRD.cantidad) / MR.tipo_cambio), 2)) AS importe
								    FROM
								        facturas_refacciones AS Reg
								   INNER JOIN    movimientos_refacciones AS MR ON Reg.factura_refacciones_id = MR.referencia_id AND MR.tipo_referencia = 'REFACCIONES'
								   INNER JOIN movimientos_refacciones_detalles AS MRD ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
								   INNER JOIN facturas_refacciones_detalles AS Det ON Reg.factura_refacciones_id = Det.factura_refacciones_id AND Det.refaccion_id = MRD.refaccion_id AND Det.renglon = MRD.renglon
								   WHERE MR.tipo_movimiento = $intMovDevRef
								   GROUP BY MR.movimiento_refacciones_id) AS Detalles ON Detalles.referenciaID =  MR.referencia_id AND Detalles.movimientoID = MR.movimiento_refacciones_id
					    INNER JOIN clientes AS C ON FR.prospecto_id = C.prospecto_id
						INNER JOIN prospectos AS PRO ON PRO.prospecto_id = C.prospecto_id
						INNER JOIN sat_monedas AS M ON MR.moneda_id = M.moneda_id
						INNER JOIN sucursales AS S ON MR.sucursal_id = S.sucursal_id
						WHERE MR.tipo_movimiento = $intMovDevRef
			   			AND MR.tipo_referencia = '$strTipoReferencia'
			   		    AND  DATE_FORMAT(MR.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'
					    $strRestriccionesSucursales 
					    $strRestriccionesServiciosTipos
					    $strRestriccionesMoneda
					    $strRestriccionesProspecto
					    $strOrdenamiento";
		}
     	
	    

		$strSQL = $this->db->query($strConsulta);
		return $strSQL->result();

	}
	
	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas_entrada_devolucion_factura($intTipoMovimiento, $dteFechaInicial = NULL, 
		                                     			   			    $dteFechaFinal = NULL, $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT MR.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('sat_monedas AS M', 'MR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('facturas_refacciones AS FR', 'MR.referencia_id = FR.factura_refacciones_id 
						 AND MR.tipo_referencia = "REFACCIONES"', 'left');
		$this->db->join('facturas_servicio AS FS', 'MR.referencia_id = FS.factura_servicio_id 
						 AND MR.tipo_referencia = "SERVICIO"', 'left');
		$this->db->join('clientes AS CFR', 'FR.prospecto_id = CFR.prospecto_id', 'left');
		$this->db->join('clientes AS CFS', 'FS.prospecto_id = CFS.prospecto_id', 'left');
		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
	    if($intProspectoID > 0)
	    {
	   		$this->db->where("(FR.prospecto_id = $intProspectoID OR 
	   						   FS.prospecto_id = $intProspectoID)", NULL, FALSE);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MR.estatus', $strEstatus);
		}
		$this->db->where("((MR.folio LIKE '%$strBusqueda%') OR

		   (CFR.nombre_comercial LIKE '%$strBusqueda%') OR
           (CFS.nombre_comercial LIKE '%$strBusqueda%') OR
       	   (FR.folio LIKE '%$strBusqueda%')OR
       	   (FS.folio LIKE '%$strBusqueda%') OR
       	   (MR.tipo_referencia LIKE '%$strBusqueda%'))"); 
		$this->db->order_by('MR.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_entrada_devolucion_factura($intTipoMovimiento, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   		 		      $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL, $intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR DEVOLUCION DE CLIENTE');
		$strTipoRefCFDI = $this->db->escape('DEVOLUCION REFACCIONES');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where("(FR.prospecto_id = $intProspectoID OR 
	   						   FS.prospecto_id = $intProspectoID)", NULL, FALSE);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 


	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MR.estatus = 'TIMBRAR' OR MR.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MR.estatus', $strEstatus);
			}
			
		}

		$this->db->where("((MR.folio LIKE '%$strBusqueda%') OR

		   (CFR.nombre_comercial LIKE '%$strBusqueda%') OR
           (CFS.nombre_comercial LIKE '%$strBusqueda%') OR
       	   (FR.folio LIKE '%$strBusqueda%')OR
       	   (FS.folio LIKE '%$strBusqueda%') OR
       	   (MR.tipo_referencia LIKE '%$strBusqueda%'))"); 


		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('sat_monedas AS M', 'MR.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'MR.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('sat_metodos_pago AS MP', 'MR.metodo_pago_id = MP.metodo_pago_id', 'inner');
	    $this->db->join('sat_uso_cfdi AS U', 'MR.uso_cfdi_id = U.uso_cfdi_id', 'inner');
	    $this->db->join('sat_tipos_relacion AS TR', 'MR.tipo_relacion_id = TR.tipo_relacion_id', 'inner');
		$this->db->join('empleados AS E', 'MR.empleado_autorizacion = E.empleado_id', 'inner');
		$this->db->join('facturas_refacciones AS FR', 'MR.referencia_id = FR.factura_refacciones_id 
						 AND MR.tipo_referencia = "REFACCIONES"', 'left');
		$this->db->join('clientes AS CFR', 'FR.prospecto_id = CFR.prospecto_id', 'left');
		$this->db->join('facturas_servicio AS FS', 'MR.referencia_id = FS.factura_servicio_id 
						 AND MR.tipo_referencia = "SERVICIO"', 'left');
		$this->db->join('clientes AS CFS', 'FS.prospecto_id = CFS.prospecto_id', 'left');
		$this->db->join('polizas AS PF', 'MR.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MR.movimiento_refacciones_id, MR.folio, MR.estatus,
						   DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha,
						   MR.tipo_referencia, MR.uuid,
						   CASE 
							   WHEN  MR.tipo_referencia = 'REFACCIONES'
							   		THEN  FR.folio
							   ELSE  FS.folio
						    END AS folio_factura,
						    CASE 
							   WHEN  MR.tipo_referencia = 'REFACCIONES'
							   		THEN  CFR.razon_social
							   ELSE  CFS.razon_social
						    END AS razon_social, 
						    CASE 
							   WHEN  MR.tipo_referencia = 'REFACCIONES'
							   		THEN  IFNULL(FR.regimen_fiscal_id,0)
							   ELSE   IFNULL(FS.regimen_fiscal_id,0)
						    END AS regimen_fiscal_id,
						    CASE 
							   WHEN  MR.tipo_referencia = 'REFACCIONES'
							   		THEN  CFR.razon_social
							   ELSE  CFS.razon_social
						    END AS razon_social,
						    IFNULL(PF.poliza_id, 0) AS poliza_id, 
						    PF.folio AS folio_poliza, 
						     IFNULL(CCFDI.cancelacion_id, 0) AS cancelacion_id", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('sat_monedas AS M', 'MR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('empleados AS E', 'MR.empleado_autorizacion = E.empleado_id', 'inner');
		$this->db->join('facturas_refacciones AS FR', 'MR.referencia_id = FR.factura_refacciones_id 
						 AND MR.tipo_referencia = "REFACCIONES"', 'left');
		$this->db->join('clientes AS CFR', 'FR.prospecto_id = CFR.prospecto_id', 'left');
		$this->db->join('facturas_servicio AS FS', 'MR.referencia_id = FS.factura_servicio_id 
						 AND MR.tipo_referencia = "SERVICIO"', 'left');
		$this->db->join('clientes AS CFS', 'FS.prospecto_id = CFS.prospecto_id', 'left');
		$this->db->join('polizas AS PF', 'MR.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		$this->db->join('cancelaciones AS CCFDI', 'CCFDI.tipo_referencia = '.$strTipoRefCFDI.' 
	    							        	   AND CCFDI.referencia_id = MR.movimiento_refacciones_id', 'left');


		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where("(FR.prospecto_id = $intProspectoID OR 
	   						   FS.prospecto_id = $intProspectoID)", NULL, FALSE);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MR.estatus = 'TIMBRAR' OR MR.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MR.estatus', $strEstatus);
			}
			
		}

		$this->db->where("((MR.folio LIKE '%$strBusqueda%') OR

		   (CFR.razon_social LIKE '%$strBusqueda%') OR
           (CFS.razon_social LIKE '%$strBusqueda%') OR
       	   (FR.folio LIKE '%$strBusqueda%')OR
       	   (FS.folio LIKE '%$strBusqueda%') OR
       	   (MR.tipo_referencia LIKE '%$strBusqueda%'))"); 
		$this->db->order_by('MR.fecha DESC, MR.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}


	


	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Entradas de Refacciones por Devolución del Taller
	*********************************************************************************************************************
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_entrada_devolucion_taller(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 

		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");

		//Tabla movimientos_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID,
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento,  
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objMovimiento->dteFecha,  
						  'moneda_id' => $objMovimiento->intMonedaID, 
						  'tipo_cambio' => $objMovimiento->intTipoCambio, 
						  'referencia_id'=> $objMovimiento->intReferenciaID,
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones', $arrDatos);
	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoRefaccionesID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar las refacciones en el inventario (en caso de que no existan)
		$this->guardar_refacciones_inventario($objMovimiento->dteFecha, $objMovimiento->strRefaccionID);

	    //Hacer un llamado al método para guardar los detalles de la entrada por devolución del taller
		$this->guardar_detalles_entrada_devolucion_taller($objMovimiento);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoRefaccionesID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar_entrada_devolucion_taller(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");


		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimiento->dteFecha,  
						  'moneda_id' => $objMovimiento->intMonedaID, 
						  'tipo_cambio' => $objMovimiento->intTipoCambio, 
						  'referencia_id'=> $objMovimiento->intReferenciaID,
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_refacciones', $arrDatos);


	    //Hacer un llamado al método para guardar las refacciones en el inventario (en caso de que no existan)
		$this->guardar_refacciones_inventario($objMovimiento->dteFecha, $objMovimiento->strRefaccionID);


	    //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($objMovimiento->intMovimientoRefaccionesID, 
	   													  $objMovimiento->intTipoMovimiento, 
	   													  $objMovimiento->dteFecha);

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->delete('movimientos_refacciones_detalles');

		//Hacer un llamado al método para guardar los detalles de la entrada por devolución del taller
		$this->guardar_detalles_entrada_devolucion_taller($objMovimiento);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_entrada_devolucion_taller($intMovimientoRefaccionesID = NULL, $intTipoMovimiento = NULL, 
						   		   	     			 $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   	     			 $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR DEVOLUCION DE TALLER');


		$this->db->select("MRE.movimiento_refacciones_id, MRE.folio, DATE_FORMAT(MRE.fecha,'%d/%m/%Y') AS fecha, 
						   MRE.moneda_id,  MRE.tipo_cambio, MRE.referencia_id,  MRE.observaciones, MRE.estatus, 
						   MRS.folio AS folio_salida, OR.folio AS folio_orden_reparacion, 
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' THEN C.razon_social
								    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   END AS prospecto,
						   P.telefono_principal,  P.calle, P.numero_exterior, P.numero_interior, P.colonia,  
						   L.descripcion AS localidad, MP.descripcion AS municipio, EP.descripcion AS estado,
						   CP.codigo_postal,
						   M.codigo AS codigo_moneda, CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   C.rfc, C.estatus AS cliente_estatus, 
						   C.razon_social AS cliente, C.telefono_principal AS cliente_telefono_principal, 
						   C.calle AS cliente_calle, C.numero_exterior AS cliente_numero_exterior, 
						   C.numero_interior AS cliente_numero_interior,  
						   CCP.codigo_postal AS cliente_codigo_postal,
						   C.colonia AS cliente_colonia, C.localidad AS cliente_localidad, 
						   MC.descripcion AS cliente_municipio,  EC.descripcion AS cliente_estado,
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza,
						   UC.usuario AS usuario_creacion, 
						   DATE_FORMAT(MRE.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
		$this->db->from('movimientos_refacciones AS MRE');
		$this->db->join('sat_monedas AS M', 'MRE.moneda_id = M.moneda_id', 'inner');
		$this->db->join('movimientos_refacciones AS MRS', 'MRE.referencia_id = MRS.movimiento_refacciones_id', 'inner');
		$this->db->join('requisiciones_refacciones AS RR', 'MRS.referencia_id = RR.requisicion_refacciones_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'RR.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
		$this->db->join('prospectos AS P', 'OR.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('sat_codigos_postales AS CCP', 'C.codigo_postal_id = CCP.codigo_postal_id', 'left');
		$this->db->join('municipios AS MC', 'C.municipio_id = MC.municipio_id', 'left');
		$this->db->join('sat_estados AS EC', 'MC.estado_id = EC.estado_id', 'left');
		$this->db->join('usuarios AS UC', 'MRE.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'MRE.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
	
		//Si existe id del movimiento
		if ($intMovimientoRefaccionesID !== NULL)
		{   
			$this->db->where('MRE.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MRE.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MRE.tipo_movimiento', $intTipoMovimiento);
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('OR.prospecto_id', $intProspectoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(MRE.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		     //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(MRE.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('MRE.estatus', $strEstatus);
				}
			}


	       $this->db->where("((MRE.folio LIKE '%$strBusqueda%') OR
							  (MRS.folio LIKE '%$strBusqueda%') OR
							  (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
							  (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
							  (C.razon_social LIKE '%$strBusqueda%'))"); 
		    $this->db->order_by('MRE.fecha DESC, MRE.folio DESC');
		    return $this->db->get()->result();
		}

	}
	
	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas_entrada_devolucion_taller($intTipoMovimiento, $dteFechaInicial = NULL, 
		                                     			   			   $dteFechaFinal = NULL, $intProspectoID = NULL,$strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;
        
		$this->db->select("DISTINCT MRE.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('movimientos_refacciones AS MRE');
		$this->db->join('sat_monedas AS M', 'MRE.moneda_id = M.moneda_id', 'inner');
		$this->db->join('movimientos_refacciones AS MRS', 'MRE.referencia_id = MRS.movimiento_refacciones_id', 'inner');
		$this->db->join('requisiciones_refacciones AS RR', 'MRS.referencia_id = RR.requisicion_refacciones_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'RR.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
		$this->db->join('prospectos AS P', 'OR.prospecto_id = P.prospecto_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->where('MRE.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRE.tipo_movimiento', $intTipoMovimiento);
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
	    if($intProspectoID > 0)
	    {
	   		$this->db->where('OR.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRE.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 


	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MRE.estatus', $strEstatus);
		}

       $this->db->where("((MRE.folio LIKE '%$strBusqueda%') OR
						   (MRS.folio LIKE '%$strBusqueda%') OR
						   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
						   (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('MRE.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_entrada_devolucion_taller($intTipoMovimiento, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   		 		     $intProspectoID = NULL,$strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR DEVOLUCION DE TALLER');


		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MRE.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRE.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('OR.prospecto_id', $intProspectoID);
	    }


	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRE.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRE.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRE.estatus', $strEstatus);
			}
		}

	    $this->db->where("((MRE.folio LIKE '%$strBusqueda%') OR
						   (MRS.folio LIKE '%$strBusqueda%') OR
						   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
						   (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%'))"); 

		$this->db->from('movimientos_refacciones AS MRE');
		$this->db->join('sat_monedas AS M', 'MRE.moneda_id = M.moneda_id', 'inner');
		$this->db->join('movimientos_refacciones AS MRS', 'MRE.referencia_id = MRS.movimiento_refacciones_id', 'inner');
		$this->db->join('requisiciones_refacciones AS RR', 'MRS.referencia_id = RR.requisicion_refacciones_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'RR.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
		$this->db->join('prospectos AS P', 'OR.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('polizas AS PF', 'MRE.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MRE.movimiento_refacciones_id, MRE.folio, MRE.referencia_id, MRE.estatus,
						   DATE_FORMAT(MRE.fecha,'%d/%m/%Y') AS fecha, MRS.folio AS folio_salida,
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' 
							   	 THEN C.razon_social
								 ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   END AS prospecto,
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_refacciones AS MRE');
		$this->db->join('sat_monedas AS M', 'MRE.moneda_id = M.moneda_id', 'inner');
		$this->db->join('movimientos_refacciones AS MRS', 'MRE.referencia_id = MRS.movimiento_refacciones_id', 'inner');
		$this->db->join('requisiciones_refacciones AS RR', 'MRS.referencia_id = RR.requisicion_refacciones_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'RR.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
		$this->db->join('prospectos AS P', 'OR.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('polizas AS PF', 'MRE.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		$this->db->where('MRE.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRE.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('OR.prospecto_id', $intProspectoID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRE.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  


	       //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRE.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRE.estatus', $strEstatus);
			}
		}

	    $this->db->where("((MRE.folio LIKE '%$strBusqueda%') OR
						   (MRS.folio LIKE '%$strBusqueda%') OR
						   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
						   (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
						   (C.razon_social LIKE '%$strBusqueda%'))");  

		$this->db->order_by('MRE.fecha DESC, MRE.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}

	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Entradas de Refacciones por Traspaso
	*********************************************************************************************************************
	*********************************************************************************************************************/
	public function guardar_entrada_traspaso(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin(); 

		//Concatenar hora, minutos y segundos
		$dteFecha = $objMovimiento->dteFecha.' '.date("H:i:s");


		//Tabla movimientos_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID,
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento,
						  'folio' => $objMovimiento->strFolio, 
						  'fecha' => $dteFecha,  
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones', $arrDatos);
	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoRefaccionesID  = $this->db->insert_id();

	    //Hacer un llamado al método para guardar las refacciones en el inventario (en caso de que no existan)
		$this->guardar_refacciones_inventario($dteFecha, $objMovimiento->strRefaccionID);

	    //Hacer un llamado al método para guardar los detalles de la entrada por traspaso
		$this->guardar_detalles_entrada_traspaso($objMovimiento);

	    //Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoRefaccionesID;
	}
	

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_entrada_traspaso($intMovimientoRefaccionesID = NULL, $strCriteriosBusq = NULL,
										    $intTipoMovimiento = NULL, $dteFechaInicial = NULL, 
										    $dteFechaFinal = NULL, $intSucursalSalidaID = NULL, 
										    $strEstatus = NULL, $strBusqueda = NULL)
	{	
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR TRASPASO');


		$this->db->select("MRE.movimiento_refacciones_id, MRE.folio, DATE_FORMAT(MRE.fecha,'%d/%m/%Y') AS fecha, 
						   MRE.referencia_id,  MRE.observaciones, MRE.estatus, STR.sucursal_salida_id, 
						   SS.nombre AS sucursal_salida,
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza,
						   UC.usuario AS usuario_creacion, 
						   DATE_FORMAT(MRE.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
		$this->db->from('movimientos_refacciones AS MRE');
		$this->db->join('movimientos_refacciones AS MRS', 'MRE.referencia_id = MRS.movimiento_refacciones_id', 'inner');
		$this->db->join('solicitudes_traspasos_refacciones AS STR', 'MRS.referencia_id = STR.solicitud_traspaso_refacciones_id', 'inner');
		$this->db->join('sucursales AS SS', 'STR.sucursal_salida_id = SS.sucursal_id', 'inner');
		$this->db->join('usuarios AS UC', 'MRE.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'MRE.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');


		//Si existe id del movimiento
		if ($intMovimientoRefaccionesID !== NULL)
		{   
			$this->db->where('MRE.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (folio|tipoMovimiento) para obtener los criterios de búsqueda
            list($strFolio, $intTipoMovimiento) = explode("|", $strCriteriosBusq); 
            $this->db->where('MRE.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MRE.folio', $strFolio);
			$this->db->where('MRE.tipo_movimiento', $intTipoMovimiento);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MRE.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MRE.tipo_movimiento', $intTipoMovimiento);
			//Si existe id de la sucursal de salida por traspaso
		    if($intSucursalSalidaID > 0)
		    {
		   		$this->db->where('STR.sucursal_salida_id', $intSucursalSalidaID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(MRE.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

			//Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(MRE.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('MRE.estatus', $strEstatus);
				}
			}


			$this->db->where("((MRE.folio LIKE '%$strBusqueda%') OR
	        				   ( SS.nombre LIKE '%$strBusqueda%'))"); 

		    $this->db->order_by('MRE.fecha DESC, MRE.folio DESC');
		    return $this->db->get()->result();
		}

	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_entrada_traspaso($intTipoMovimiento, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   		   $intSucursalSalidaID = NULL, $strEstatus = NULL, $strBusqueda = NULL ,$intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR TRASPASO');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MRE.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRE.tipo_movimiento', $intTipoMovimiento);
		//Si existe id de la sucursal de salida por traspaso
	    if($intSucursalSalidaID != NULL)
	    {
	   		$this->db->where('STR.sucursal_salida_id', $intSucursalSalidaID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRE.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRE.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRE.estatus', $strEstatus);
			}
		}

		$this->db->where("((MRE.folio LIKE '%$strBusqueda%') OR
        				   ( SS.nombre LIKE '%$strBusqueda%'))"); 

		$this->db->from('movimientos_refacciones AS MRE');
		$this->db->join('movimientos_refacciones AS MRS', 'MRE.referencia_id = MRS.movimiento_refacciones_id', 'inner');
		$this->db->join('solicitudes_traspasos_refacciones AS STR', 'MRS.referencia_id = STR.solicitud_traspaso_refacciones_id', 'inner');
		$this->db->join('sucursales AS SS', 'STR.sucursal_salida_id = SS.sucursal_id', 'inner');
		$this->db->join('polizas AS PF', 'MRE.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MRE.movimiento_refacciones_id, MRE.folio,  MRE.referencia_id, MRE.estatus,
						   DATE_FORMAT(MRE.fecha,'%d/%m/%Y') AS fecha, SS.nombre AS sucursal_salida, 
						   STR.sucursal_salida_id, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_refacciones AS MRE');
		$this->db->join('movimientos_refacciones AS MRS', 'MRE.referencia_id = MRS.movimiento_refacciones_id', 'inner');
		$this->db->join('solicitudes_traspasos_refacciones AS STR', 'MRS.referencia_id = STR.solicitud_traspaso_refacciones_id', 'inner');
		$this->db->join('sucursales AS SS', 'STR.sucursal_salida_id = SS.sucursal_id', 'inner');
		$this->db->join('polizas AS PF', 'MRE.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		$this->db->where('MRE.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRE.tipo_movimiento', $intTipoMovimiento);
		//Si existe id de la sucursal de salida por traspaso
	    if($intSucursalSalidaID != NULL)
	    {
	   		$this->db->where('STR.sucursal_salida_id', $intSucursalSalidaID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRE.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRE.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRE.estatus', $strEstatus);
			}
		}


		$this->db->where("((MRE.folio LIKE '%$strBusqueda%') OR
        				   ( SS.nombre LIKE '%$strBusqueda%'))"); 

	    $this->db->order_by('MRE.fecha DESC, MRE.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}

	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Entradas de Refacciones por Ajuste
	*********************************************************************************************************************
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_entrada_ajuste(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 

		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");

		//Tabla movimientos_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID,
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento, 
						  'folio' => $strFolioConsecutivo,
						  'fecha' => $objMovimiento->dteFecha,  
						  'empleado_autorizacion' => $objMovimiento->intEmpleadoAutorizacion, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones', $arrDatos);
	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoRefaccionesID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar las refacciones en el inventario (en caso de que no existan)
		$this->guardar_refacciones_inventario($objMovimiento->dteFecha, $objMovimiento->strRefaccionID);

	    //Hacer un llamado al método para guardar los detalles de la entrada por ajuste
		$this->guardar_detalles_entrada_ajuste($objMovimiento);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoRefaccionesID;
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_entrada_ajuste(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimiento->dteFecha, 
						  'empleado_autorizacion' => $objMovimiento->intEmpleadoAutorizacion, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_refacciones', $arrDatos);

	    //Hacer un llamado al método para guardar las refacciones en el inventario (en caso de que no existan)
		$this->guardar_refacciones_inventario($objMovimiento->dteFecha, $objMovimiento->strRefaccionID);

	    //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($objMovimiento->intMovimientoRefaccionesID, 
	   													  $objMovimiento->intTipoMovimiento, 
	   													  $objMovimiento->dteFecha);

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->delete('movimientos_refacciones_detalles');

		//Hacer un llamado al método para guardar los detalles de la entrada por ajuste
		$this->guardar_detalles_entrada_ajuste($objMovimiento);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_entrada_ajuste($intMovimientoRefaccionesID = NULL, $intTipoMovimiento = NULL, 
						   		   		  $dteFechaInicial = NULL, $dteFechaFinal = NULL, $intEmpleadoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR AJUSTE');


		$this->db->select("MR.movimiento_refacciones_id, MR.folio, DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha, 
						   MR.referencia_id,  MR.empleado_autorizacion, MR.observaciones, MR.estatus, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   PF.folio AS folio_poliza,
						   UC.usuario AS usuario_creacion, 
						   DATE_FORMAT(MR.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('empleados AS E', 'MR.empleado_autorizacion = E.empleado_id', 'inner');
		$this->db->join('usuarios AS UC', 'MR.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'MR.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');


		//Si existe id del movimiento
		if ($intMovimientoRefaccionesID !== NULL)
		{   
			$this->db->where('MR.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);

			//Si existe id del empleado
			if($intEmpleadoID > 0)
		    {
		   		$this->db->where('MR.empleado_autorizacion', $intEmpleadoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(MR.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('MR.estatus', $strEstatus);
				}
			}

			$this->db->where("((MR.folio LIKE '%$strBusqueda%') OR
	        				   (CONCAT_WS(' ', E.codigo,  E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
				               (CONCAT_WS(' - ', E.codigo,  E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))");
		    $this->db->order_by('MR.fecha DESC, MR.folio DESC');
		    return $this->db->get()->result();
		}

	}

    //Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_entrada_ajuste($intTipoMovimiento, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   		 $intEmpleadoID = NULL,$strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR AJUSTE');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MRE.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRE.tipo_movimiento', $intTipoMovimiento);
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRE.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRE.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRE.estatus', $strEstatus);
			}
		}

		$this->db->where("((MRE.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' ', E.codigo,  E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' - ', E.codigo,  E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))");

		$this->db->from('movimientos_refacciones AS MRE');
		$this->db->join('empleados AS E', 'MRE.empleado_autorizacion = E.empleado_id', 'inner');
		$this->db->join('polizas AS PF', 'MRE.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MRE.movimiento_refacciones_id, MRE.folio, MRE.estatus,
						   DATE_FORMAT(MRE.fecha,'%d/%m/%Y') AS fecha,
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   PF.folio AS folio_poliza", FALSE);
	    $this->db->from('movimientos_refacciones AS MRE');
		$this->db->join('empleados AS E', 'MRE.empleado_autorizacion = E.empleado_id', 'inner');
		$this->db->join('polizas AS PF', 'MRE.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		$this->db->where('MRE.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRE.tipo_movimiento', $intTipoMovimiento);
	    //Si existe id del empleado
		if($intEmpleadoID > 0)
	    {
	   		$this->db->where('MRE.empleado_autorizacion', $intEmpleadoID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRE.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  

	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRE.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRE.estatus', $strEstatus);
			}
		}

		$this->db->where("((MRE.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' ', E.codigo,  E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' - ', E.codigo,  E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))");

		$this->db->order_by('MRE.fecha DESC, MRE.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Salidas de Refacciones por Taller
	*********************************************************************************************************************
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_salida_taller(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 

		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");

		//Tabla movimientos_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID,
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objMovimiento->dteFecha,  
						  'moneda_id' => $objMovimiento->intMonedaID,  
						  'tipo_cambio' => $objMovimiento->intTipoCambio,  
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones', $arrDatos);
	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoRefaccionesID  = $this->db->insert_id();

	    //Hacer un llamado al método para guardar los detalles de la salida por taller
		$this->guardar_detalles_salida_taller($objMovimiento);

		//Hacer un llamado al método para modificar el estatus de la requisición de refacciones
	    $this->set_estatus_requisicion_refacciones($objMovimiento->intReferenciaID, 
	    										   $objMovimiento->strEstatusRequisicion);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoRefaccionesID;
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_salida_taller(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimiento->dteFecha, 
						  'moneda_id' => $objMovimiento->intMonedaID,  
						  'tipo_cambio' => $objMovimiento->intTipoCambio,   
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_refacciones', $arrDatos);

	    //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($objMovimiento->intMovimientoRefaccionesID, 
	   													  $objMovimiento->intTipoMovimiento, 
	   													  $objMovimiento->dteFecha);

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->delete('movimientos_refacciones_detalles');

		//Hacer un llamado al método para guardar los detalles de la salida por taller
		$this->guardar_detalles_salida_taller($objMovimiento);


		//Hacer un llamado al método para modificar el estatus de la requisición de refacciones
	    $this->set_estatus_requisicion_refacciones($objMovimiento->intReferenciaID, 
	    										   $objMovimiento->strEstatusRequisicion);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_salida_taller($intMovimientoRefaccionesID = NULL, $intTipoMovimiento = NULL, 
						   		   	     $dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL,$strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución del taller
		$intMovEntradaDevolucion = ENTRADA_REFACCIONES_DEVOLUCION_TALLER;
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('SALIDA POR TALLER');

		$this->db->select("MR.movimiento_refacciones_id, MR.folio, DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha, 
						   MR.moneda_id,  MR.tipo_cambio, MR.referencia_id,  MR.observaciones, MR.estatus, 
						   RR.folio AS folio_requisicion, OR.folio AS folio_orden_reparacion, 
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' 
							   		 THEN C.razon_social
								    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   END AS prospecto,  P.codigo AS CodigoProspecto,
						   P.telefono_principal,  P.calle, P.numero_exterior, P.numero_interior, P.colonia,  
						   L.descripcion AS localidad, MP.descripcion AS municipio, EP.descripcion AS estado,
						   CP.codigo_postal,
						   M.codigo AS codigo_moneda, CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   IFNULL(C.rfc,'') AS rfc,  C.estatus AS cliente_estatus, 
						   IFNULL(C.razon_social, P.nombre_comercial) AS razon_social,
						   C.nombre_comercial AS cliente, C.telefono_principal AS cliente_telefono_principal, 
						   C.calle AS cliente_calle, C.numero_exterior AS cliente_numero_exterior, 
						   C.numero_interior AS cliente_numero_interior,  
						   CCP.codigo_postal AS cliente_codigo_postal,
						   C.colonia AS cliente_colonia, C.localidad AS cliente_localidad, 
						   MC.descripcion AS cliente_municipio,  EC.descripcion AS cliente_estado,
						   (SELECT IFNULL(COUNT(MRE.movimiento_refacciones_id), 0)
							FROM movimientos_refacciones AS MRE
							WHERE MRE.tipo_movimiento = $intMovEntradaDevolucion
							AND MRE.referencia_id = MR.movimiento_refacciones_id
							AND MRE.estatus = 'ACTIVO') AS total_entradas_devolucion,
							IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza,
							UC.usuario AS usuario_creacion,
							DATE_FORMAT(MR.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('sat_monedas AS M', 'MR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('requisiciones_refacciones AS RR', 'MR.referencia_id = RR.requisicion_refacciones_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'RR.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
		$this->db->join('prospectos AS P', 'OR.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('sat_codigos_postales AS CCP', 'C.codigo_postal_id = CCP.codigo_postal_id', 'left');
		$this->db->join('municipios AS MC', 'C.municipio_id = MC.municipio_id', 'left');
		$this->db->join('sat_estados AS EC', 'MC.estado_id = EC.estado_id', 'left');
		$this->db->join('usuarios AS UC', 'MR.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'MR.movimiento_refacciones_id = PF.referencia_id
	    							        AND PF.proceso = '.$strTipoMovimiento.' 
	    							        AND PF.modulo = "REFACCIONES"', 'left');
	
		//Si existe id del movimiento
		if ($intMovimientoRefaccionesID !== NULL)
		{   
			$this->db->where('MR.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('OR.prospecto_id', $intProspectoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(MR.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('MR.estatus', $strEstatus);
				}
			}

			$this->db->where("((MR.folio LIKE '%$strBusqueda%') OR
	        				   (RR.folio LIKE '%$strBusqueda%') OR
				               (OR.folio LIKE '%$strBusqueda%') OR
				           	   (C.razon_social LIKE '%$strBusqueda%') OR 
				           	   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))"); 
		    $this->db->order_by('MR.fecha DESC, MR.folio DESC');
		    return $this->db->get()->result();
		}

	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas_salida_taller($intTipoMovimiento, $dteFechaInicial = NULL, 
		                                     			   $dteFechaFinal = NULL, $intProspectoID = NULL,$strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;
        
		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('sat_monedas AS M', 'MR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('requisiciones_refacciones AS RR', 'MR.referencia_id = RR.requisicion_refacciones_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'RR.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
	    if($intProspectoID > 0)
	    {
	   		$this->db->where('OR.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

    //Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_salida_taller($intTipoMovimiento, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   		 $intProspectoID = NULL,  $strEstatus = NULL, $strBusqueda = NULL,$intNumRows, $intPos)
	{
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución del taller
		$intMovEntradaDevolucion = ENTRADA_REFACCIONES_DEVOLUCION_TALLER;
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('SALIDA POR TALLER');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('OR.prospecto_id', $intProspectoID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MR.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MR.estatus', $strEstatus);
			}
		}

		$this->db->where("((MR.folio LIKE '%$strBusqueda%') OR
        				   (RR.folio LIKE '%$strBusqueda%') OR
			               (OR.folio LIKE '%$strBusqueda%') OR
			           	   (C.razon_social LIKE '%$strBusqueda%') OR 
			           	   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))"); 


		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('sat_monedas AS M', 'MR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('requisiciones_refacciones AS RR', 'MR.referencia_id = RR.requisicion_refacciones_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'RR.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
		$this->db->join('prospectos AS P', 'OR.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('polizas AS PF', 'MR.movimiento_refacciones_id = PF.referencia_id
	    							        AND PF.proceso = '.$strTipoMovimiento.' 
	    							        AND PF.modulo = "REFACCIONES"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MR.movimiento_refacciones_id, MR.folio, MR.referencia_id, MR.estatus,
						   DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha, RR.folio AS folio_requisicion,
						   OR.folio AS folio_orden_reparacion,  
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' 
							   		 THEN C.razon_social
								    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   END AS prospecto,
						   (SELECT IFNULL(COUNT(MRE.movimiento_refacciones_id), 0)
							FROM movimientos_refacciones AS MRE
							WHERE MRE.tipo_movimiento = $intMovEntradaDevolucion
							AND MRE.referencia_id = MR.movimiento_refacciones_id
							AND MRE.estatus = 'ACTIVO') AS total_entradas_devolucion,
							IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('sat_monedas AS M', 'MR.moneda_id = M.moneda_id', 'inner');
		$this->db->join('requisiciones_refacciones AS RR', 'MR.referencia_id = RR.requisicion_refacciones_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'RR.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
		$this->db->join('prospectos AS P', 'OR.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('polizas AS PF', 'MR.movimiento_refacciones_id = PF.referencia_id
	    							        AND PF.proceso = '.$strTipoMovimiento.' 
	    							        AND PF.modulo = "REFACCIONES"', 'left');
		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('OR.prospecto_id', $intProspectoID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  

	   //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MR.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MR.estatus', $strEstatus);
			}
		}

		$this->db->where("((MR.folio LIKE '%$strBusqueda%') OR
        				   (RR.folio LIKE '%$strBusqueda%') OR
			               (OR.folio LIKE '%$strBusqueda%') OR
			           	   (C.razon_social LIKE '%$strBusqueda%') OR 
			           	   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('MR.fecha DESC, MR.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}

	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Salidas de Refacciones por Consumo Interno
	*********************************************************************************************************************
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_salida_consumo_interno(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 

		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");

		//Tabla movimientos_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID, 
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento, 
						  'folio' => $strFolioConsecutivo,
						  'fecha' => $objMovimiento->dteFecha,  
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'empleado_autorizacion' => $objMovimiento->intEmpleadoAutorizacion, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones', $arrDatos);

	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoRefaccionesID = $this->db->insert_id();

	    //Hacer un llamado al método para guardar los detalles de la salida por consumo interno
		$this->guardar_detalles_salida_consumo_interno($objMovimiento);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoRefaccionesID;
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_salida_consumo_interno(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimiento->dteFecha, 
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'empleado_autorizacion' => $objMovimiento->intEmpleadoAutorizacion, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_refacciones', $arrDatos);

	    //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($objMovimiento->intMovimientoRefaccionesID, 
	   													  $objMovimiento->intTipoMovimiento, 
	   													  $objMovimiento->dteFecha);

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->delete('movimientos_refacciones_detalles');

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_detalles_gastos		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->delete('movimientos_refacciones_detalles_gastos');
		

		//Hacer un llamado al método para guardar los detalles de la salida por consumo interno
		$this->guardar_detalles_salida_consumo_interno($objMovimiento);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_salida_consumo_interno($intMovimientoRefaccionesID = NULL, $intTipoMovimiento = NULL, 
						   		   				  $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   				  $intDepartamentoID = NULL,  $strEstatus = NULL, $strBusqueda = NULL)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('SALIDA POR CONSUMO INTERNO');


		$this->db->select("MR.movimiento_refacciones_id, MR.folio, DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha, 
						   MR.referencia_id,  MR.empleado_autorizacion, MR.observaciones, MR.estatus, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
						   D.descripcion AS departamento,
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   PF.folio AS folio_poliza,
						   UC.usuario AS usuario_creacion,
						   DATE_FORMAT(MR.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('departamentos AS D', 'MR.referencia_id = D.departamento_id', 'inner');
		$this->db->join('empleados AS E', 'MR.empleado_autorizacion = E.empleado_id', 'inner');
		$this->db->join('usuarios AS UC', 'MR.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'MR.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		//Si existe id del movimiento
		if ($intMovimientoRefaccionesID !== NULL)
		{   
			$this->db->where('MR.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
			//Si existe id del departamento
		    if($intDepartamentoID > 0)
		    {
		   		$this->db->where('MR.referencia_id', $intDepartamentoID);
		    }
			//Si existe rango de fechas
		   	if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(MR.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('MR.estatus', $strEstatus);
				}
			}

			$this->db->where("((MR.folio LIKE '%$strBusqueda%') OR
        				   (D.descripcion LIKE '%$strBusqueda%'))"); 
			
		    $this->db->order_by('MR.fecha DESC, MR.folio DESC');
		    return $this->db->get()->result();
		}

	}

    //Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_salida_consumo_interno($intTipoMovimiento, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   				  $intDepartamentoID = NULL, $strEstatus = NULL, $strBusqueda = NULL,$intNumRows, $intPos)
	{
		

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('SALIDA POR CONSUMO INTERNO');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MRS.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRS.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del departamento
		if($intDepartamentoID > 0)
	    {
	   		$this->db->where('MRS.referencia_id', $intDepartamentoID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRS.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRS.estatus', $strEstatus);
			}
		}

		$this->db->where("((MRS.folio LIKE '%$strBusqueda%') OR
        				   (D.descripcion LIKE '%$strBusqueda%'))"); 

		$this->db->from('movimientos_refacciones AS MRS');
		$this->db->join('departamentos AS D', 'MRS.referencia_id = D.departamento_id', 'inner');
		$this->db->join('empleados AS E', 'MRS.empleado_autorizacion = E.empleado_id', 'inner');
		$this->db->join('polizas AS PF', 'MRS.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MRS.movimiento_refacciones_id, MRS.folio, MRS.estatus,
						   DATE_FORMAT(MRS.fecha,'%d/%m/%Y') AS fecha, D.descripcion AS departamento,
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   PF.folio AS folio_poliza", FALSE);
	    $this->db->from('movimientos_refacciones AS MRS');
		$this->db->join('departamentos AS D', 'MRS.referencia_id = D.departamento_id', 'inner');
		$this->db->join('empleados AS E', 'MRS.empleado_autorizacion = E.empleado_id', 'inner');
		$this->db->join('polizas AS PF', 'MRS.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		$this->db->where('MRS.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRS.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del departamento
		if($intDepartamentoID > 0)
	    {
	   		$this->db->where('MRS.referencia_id', $intDepartamentoID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  

	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRS.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRS.estatus', $strEstatus);
			}
		}

		$this->db->where("((MRS.folio LIKE '%$strBusqueda%') OR
        				   (D.descripcion LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('MRS.fecha DESC, MRS.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Salidas de Refacciones por Traspaso
	*********************************************************************************************************************
	*********************************************************************************************************************/
	public function guardar_salida_traspaso(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 

		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");

		//Tabla movimientos_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID, 
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objMovimiento->dteFecha,  
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones', $arrDatos);

	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoRefaccionesID = $this->db->insert_id();

	    //Hacer un llamado al método para guardar los detalles de la salida por traspaso
		$this->guardar_detalles_salida_traspaso($objMovimiento);

		//Hacer un llamado al método para modificar el estatus de la solicitud de refacciones por traspaso
	    $this->set_estatus_solicitud_traspaso($objMovimiento->intReferenciaID, 
	    									  $objMovimiento->strEstatusSolicitudTraspaso);

	    //Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);
	    
	    //Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoRefaccionesID;
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_salida_traspaso(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimiento->dteFecha, 
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_refacciones', $arrDatos);

	    //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($objMovimiento->intMovimientoRefaccionesID, 
	   													  $objMovimiento->intTipoMovimiento, 
	   													  $objMovimiento->dteFecha);

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->delete('movimientos_refacciones_detalles');

		//Hacer un llamado al método para guardar los detalles de la salida por traspaso
		$this->guardar_detalles_salida_traspaso($objMovimiento);


		//Hacer un llamado al método para modificar el estatus de la solicitud de refacciones por traspaso
	    $this->set_estatus_solicitud_traspaso($objMovimiento->intReferenciaID, 
	    									  $objMovimiento->strEstatusSolicitudTraspaso);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_salida_traspaso($intMovimientoRefaccionesID = NULL, $intTipoMovimiento = NULL, 
						   		   	       $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   	       $intSucursalSolicitudID = NULL,$strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar al tipo de movimiento entrada de refacciones por traspaso
		$intMovEntradaTraspaso = ENTRADA_REFACCIONES_TRASPASO;
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('SALIDA POR TRASPASO');

		$this->db->select("MR.movimiento_refacciones_id, MR.sucursal_id, MR.folio, 
						   DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha, 
						   MR.referencia_id,  MR.observaciones, MR.estatus, 
						   STR.folio AS folio_solicitud, SS.nombre AS sucursal_solicitud,
						    SM.nombre AS sucursal_salida,
						   (SELECT IFNULL(COUNT(MRE.movimiento_refacciones_id), 0)
							FROM movimientos_refacciones AS MRE
							WHERE MRE.tipo_movimiento = $intMovEntradaTraspaso
							AND MRE.referencia_id = MR.movimiento_refacciones_id
							AND MRE.estatus = 'ACTIVO') AS total_entradas_traspaso,
							IFNULL(PF.poliza_id, 0) AS poliza_id,
						    PF.folio AS folio_poliza,
							UC.usuario AS usuario_creacion, 
							DATE_FORMAT(MR.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('solicitudes_traspasos_refacciones AS STR', 'MR.referencia_id = STR.solicitud_traspaso_refacciones_id', 'inner');
		$this->db->join('sucursales AS SS', 'STR.sucursal_id = SS.sucursal_id', 'inner');
		$this->db->join('sucursales AS SM', 'MR.sucursal_id = SM.sucursal_id', 'inner');
		$this->db->join('usuarios AS UC', 'MR.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'MR.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
	
		//Si existe id del movimiento
		if ($intMovimientoRefaccionesID !== NULL)
		{   
			$this->db->where('MR.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
			//Si existe id de la sucursal que solicita el traspaso
		    if($intSucursalSolicitudID > 0)
		    {
		   		$this->db->where('STR.sucursal_id', $intSucursalSolicitudID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('MR.estatus', $strEstatus);
			}

			$this->db->where("(MR.folio LIKE '%$strBusqueda%' OR
	        				   STR.folio LIKE '%$strBusqueda%' OR
				               SS.nombre LIKE '%$strBusqueda%')"); 

		    $this->db->order_by('MR.fecha DESC, MR.folio DESC');
		    return $this->db->get()->result();
		}

	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_salida_traspaso($intTipoMovimiento, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   		   $intSucursalSolicitudID = NULL, $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Constante para identificar al tipo de movimiento entrada de refacciones por traspaso
		$intMovEntradaTraspaso = ENTRADA_REFACCIONES_TRASPASO;
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('SALIDA POR TRASPASO');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
		//Si existe id de la sucursal de la solicitud
	    if($intSucursalSolicitudID != NULL)
	    {
	   		$this->db->where('STR.sucursal_id', $intSucursalSolicitudID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MR.estatus', $strEstatus);
		}

		$this->db->where("(MR.folio LIKE '%$strBusqueda%' OR
        				   STR.folio LIKE '%$strBusqueda%' OR
			               SS.nombre LIKE '%$strBusqueda%')");

		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('solicitudes_traspasos_refacciones AS STR', 'MR.referencia_id = STR.solicitud_traspaso_refacciones_id', 'inner');
		$this->db->join('sucursales AS SS', 'STR.sucursal_id = SS.sucursal_id', 'inner');
		$this->db->join('sucursales AS SM', 'MR.sucursal_id = SM.sucursal_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MR.movimiento_refacciones_id, MR.folio, MR.referencia_id, MR.estatus,
						   DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha, STR.folio AS folio_solicitud, 
						   SS.nombre AS sucursal_solicitud,
						   (SELECT IFNULL(COUNT(MRE.movimiento_refacciones_id), 0)
							FROM movimientos_refacciones AS MRE
							WHERE MRE.tipo_movimiento = $intMovEntradaTraspaso
							AND MRE.referencia_id = MR.movimiento_refacciones_id
							AND MRE.estatus = 'ACTIVO') AS total_entradas_traspaso,
							IFNULL(PF.poliza_id, 0) AS poliza_id,
						    PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('solicitudes_traspasos_refacciones AS STR', 'MR.referencia_id = STR.solicitud_traspaso_refacciones_id', 'inner');
		$this->db->join('sucursales AS SS', 'STR.sucursal_id = SS.sucursal_id', 'inner');
		$this->db->join('sucursales AS SM', 'MR.sucursal_id = SM.sucursal_id', 'inner');
		$this->db->join('polizas AS PF', 'MR.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
		//Si existe id de la sucursal que solicita el traspaso
	    if($intSucursalSolicitudID != NULL)
	    {
	   		$this->db->where('STR.sucursal_id', $intSucursalSolicitudID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  

	   //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MR.estatus', $strEstatus);
		}

		$this->db->where("(MR.folio LIKE '%$strBusqueda%' OR
        				   STR.folio LIKE '%$strBusqueda%' OR
			               SS.nombre LIKE '%$strBusqueda%')");

		$this->db->order_by('MR.fecha DESC, MR.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}

	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Salidas de Refacciones por Devolución al Proveedor
	*********************************************************************************************************************
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_salida_devolucion_proveedor(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 

		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");

		//Tabla movimientos_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID,
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objMovimiento->dteFecha,  
						  'moneda_id' => $objMovimiento->intMonedaID,  
						  'tipo_cambio' => $objMovimiento->intTipoCambio,  
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones', $arrDatos);

	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoRefaccionesID = $this->db->insert_id();

	    //Hacer un llamado al método para guardar los detalles de la salida por devolución al proveedor
		$this->guardar_detalles_salida_devolucion_proveedor($objMovimiento);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoRefaccionesID;
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_salida_devolucion_proveedor(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimiento->dteFecha, 
						  'moneda_id' => $objMovimiento->intMonedaID,  
						  'tipo_cambio' => $objMovimiento->intTipoCambio,   
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_refacciones', $arrDatos);

	    //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($objMovimiento->intMovimientoRefaccionesID, 
	   													  $objMovimiento->intTipoMovimiento, 
	   													  $objMovimiento->dteFecha);

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->delete('movimientos_refacciones_detalles');

		//Hacer un llamado al método para guardar los detalles de la salida por devolución al proveedor
		$this->guardar_detalles_salida_devolucion_proveedor($objMovimiento);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_salida_devolucion_proveedor($intMovimientoRefaccionesID = NULL, $intTipoMovimiento = NULL, 
						   		   					   $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   					   $intProveedorID = NULL,$strEstatus = NULL, $strBusqueda = NULL)
	{
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('SALIDA POR DEVOLUCION AL PROVEEDOR');

		$this->db->select("MRS.movimiento_refacciones_id, MRS.folio, DATE_FORMAT(MRS.fecha,'%d/%m/%Y') AS fecha, 
						   MRS.moneda_id,  MRS.tipo_cambio, MRS.referencia_id,  MRS.observaciones, MRS.estatus, 
						   MRE.folio AS folio_entrada, CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, 
						   P.rfc, P.telefono_principal, P.calle, P.numero_exterior, P.numero_interior, P.colonia,
						   CP.codigo_postal, P.localidad, MP.descripcion AS municipio, 
						   M.codigo AS codigo_moneda, CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   EP.descripcion AS estado, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   PF.folio AS folio_poliza,
						   UC.usuario AS usuario_creacion,
						   DATE_FORMAT(MRS.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
		$this->db->from('movimientos_refacciones AS MRS');
		$this->db->join('sat_monedas AS M', 'MRS.moneda_id = M.moneda_id', 'inner');
		$this->db->join('movimientos_refacciones AS MRE', 'MRS.referencia_id = MRE.movimiento_refacciones_id', 'inner');
		$this->db->join('proveedores AS P', 'MRE.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('usuarios AS UC', 'MRS.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'MRS.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
	
		//Si existe id del movimiento
		if ($intMovimientoRefaccionesID !== NULL)
		{   
			$this->db->where('MRS.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MRS.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MRS.tipo_movimiento', $intTipoMovimiento);
			//Si existe id del proveedor
		    if($intProveedorID > 0)
		    {
		   		$this->db->where('MRE.proveedor_id', $intProveedorID);
		    }

			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(MRS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(MRS.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('MRS.estatus', $strEstatus);
				}
			}

			$this->db->where("((MRS.folio LIKE '%$strBusqueda%') OR
	        				   (MRE.folio LIKE '%$strBusqueda%') OR
				               (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
				           	   (CONCAT_WS('  ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
		    $this->db->order_by('MRS.fecha DESC, MRS.folio DESC');
		    return $this->db->get()->result();
		}

	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas_salida_devolucion_proveedor($intTipoMovimiento, $dteFechaInicial = NULL, 
		                                     $dteFechaFinal = NULL, $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;
        
		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('movimientos_refacciones AS MRS');
		$this->db->join('sat_monedas AS M', 'MRS.moneda_id = M.moneda_id', 'inner');
		$this->db->join('movimientos_refacciones AS MRE', 'MRS.referencia_id = MRE.movimiento_refacciones_id', 'inner');
		$this->db->join('proveedores AS P', 'MRE.proveedor_id = P.proveedor_id', 'inner');
		$this->db->where('MRS.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRS.tipo_movimiento', $intTipoMovimiento);
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del proveedor
	    if($intProveedorID > 0)
	    {
	   		$this->db->where('MRE.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MRS.estatus', $strEstatus);
		}

		$this->db->where("((MRS.folio LIKE '%$strBusqueda%') OR
        				   (MRE.folio LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			           	   (CONCAT_WS('  ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

    //Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_salida_devolucion_proveedor($intTipoMovimiento, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   					   $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda = NULL, 
						   		   					   $intNumRows, $intPos)
	{
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('SALIDA POR DEVOLUCION AL PROVEEDOR');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MRS.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRS.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('MRE.proveedor_id', $intProveedorID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRS.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRS.estatus', $strEstatus);
			}
		}

		$this->db->where("((MRS.folio LIKE '%$strBusqueda%') OR
        				   (MRE.folio LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			           	   (CONCAT_WS('  ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->from('movimientos_refacciones AS MRS');
		$this->db->join('sat_monedas AS M', 'MRS.moneda_id = M.moneda_id', 'inner');
		$this->db->join('movimientos_refacciones AS MRE', 'MRS.referencia_id = MRE.movimiento_refacciones_id', 'inner');
		$this->db->join('proveedores AS P', 'MRE.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('polizas AS PF', 'MRS.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MRS.movimiento_refacciones_id, MRS.folio, MRS.estatus,
						   DATE_FORMAT(MRS.fecha,'%d/%m/%Y') AS fecha, MRE.folio AS folio_entrada,
						   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor,
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_refacciones AS MRS');
		$this->db->join('sat_monedas AS M', 'MRS.moneda_id = M.moneda_id', 'inner');
		$this->db->join('movimientos_refacciones AS MRE', 'MRS.referencia_id = MRE.movimiento_refacciones_id', 'inner');
		$this->db->join('proveedores AS P', 'MRE.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('polizas AS PF', 'MRS.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		$this->db->where('MRS.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRS.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('MRE.proveedor_id', $intProveedorID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  

	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRS.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRS.estatus', $strEstatus);
			}
		}
		$this->db->where("((MRS.folio LIKE '%$strBusqueda%') OR
        				   (MRE.folio LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			           	   (CONCAT_WS('  ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('MRS.fecha DESC, MRS.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}

	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Salidas de Refacciones por Ajuste
	*********************************************************************************************************************
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_salida_ajuste(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 

		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");

		//Tabla movimientos_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID,
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento, 
						  'folio' => $strFolioConsecutivo,
						  'fecha' => $objMovimiento->dteFecha,  
						  'empleado_autorizacion' => $objMovimiento->intEmpleadoAutorizacion, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones', $arrDatos);

	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoRefaccionesID = $this->db->insert_id();

	    //Hacer un llamado al método para guardar los detalles de la salida por ajuste
		$this->guardar_detalles_salida_ajuste($objMovimiento);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoRefaccionesID;
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_salida_ajuste(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimiento->dteFecha, 
						  'empleado_autorizacion' => $objMovimiento->intEmpleadoAutorizacion, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_refacciones', $arrDatos);

	    //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($objMovimiento->intMovimientoRefaccionesID, 
	   													  $objMovimiento->intTipoMovimiento, 
	   													  $objMovimiento->dteFecha);

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->delete('movimientos_refacciones_detalles');

		//Hacer un llamado al método para guardar los detalles de la salida por ajuste
		$this->guardar_detalles_salida_ajuste($objMovimiento);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_salida_ajuste($intMovimientoRefaccionesID = NULL, $intTipoMovimiento = NULL, 
						   		   		 $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   		 $intEmpleadoID = NULL,$strEstatus = NULL, $strBusqueda = NULL)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('SALIDA POR AJUSTE');

		$this->db->select("MR.movimiento_refacciones_id, MR.folio, DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha, 
						   MR.referencia_id,  MR.empleado_autorizacion, MR.observaciones, MR.estatus, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   PF.folio AS folio_poliza,
						   UC.usuario AS usuario_creacion, 
						   DATE_FORMAT(MR.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('empleados AS E', 'MR.empleado_autorizacion = E.empleado_id', 'inner');
		$this->db->join('usuarios AS UC', 'MR.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'MR.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');

		//Si existe id del movimiento
		if ($intMovimientoRefaccionesID !== NULL)
		{   
			$this->db->where('MR.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);

			//Si existe id del empleado
			if($intEmpleadoID > 0)
		    {
		   		$this->db->where('MR.empleado_autorizacion', $intEmpleadoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		     //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(MR.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('MR.estatus', $strEstatus);
				}
			}

			$this->db->where("((MR.folio LIKE '%$strBusqueda%') OR
	        				   (CONCAT_WS(' - ', E.codigo,  E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
				               (CONCAT_WS(' ', E.codigo,  E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))"); 
			
		    $this->db->order_by('MR.fecha DESC, MR.folio DESC');
		    return $this->db->get()->result();
		}

	}

    //Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_salida_ajuste($intTipoMovimiento, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   		$intEmpleadoID = NULL,$strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('SALIDA POR AJUSTE');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MRS.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRS.tipo_movimiento', $intTipoMovimiento);
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRS.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRS.estatus', $strEstatus);
			}
		}

		$this->db->where("((MRS.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', E.codigo,  E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', E.codigo,  E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))"); 
		$this->db->from('movimientos_refacciones AS MRS');
		$this->db->join('empleados AS E', 'MRS.empleado_autorizacion = E.empleado_id', 'inner');
		$this->db->join('polizas AS PF', 'MRS.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MRS.movimiento_refacciones_id, MRS.folio, MRS.estatus,
						   DATE_FORMAT(MRS.fecha,'%d/%m/%Y') AS fecha,
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   PF.folio AS folio_poliza", FALSE);
	    $this->db->from('movimientos_refacciones AS MRS');
		$this->db->join('empleados AS E', 'MRS.empleado_autorizacion = E.empleado_id', 'inner');
		$this->db->join('polizas AS PF', 'MRS.movimiento_refacciones_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "REFACCIONES"', 'left');
		$this->db->where('MRS.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRS.tipo_movimiento', $intTipoMovimiento);
	    //Si existe id del empleado
		if($intEmpleadoID > 0)
	    {
	   		$this->db->where('MRS.empleado_autorizacion', $intEmpleadoID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRS.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  

	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRS.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRS.estatus', $strEstatus);
			}
		}

		$this->db->where("((MRS.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', E.codigo,  E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', E.codigo,  E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))"); 
		$this->db->order_by('MRS.fecha DESC, MRS.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Salidas de Refacciones por Traspaso Vehicular
	*********************************************************************************************************************
	*********************************************************************************************************************/
	public function guardar_salida_traspaso_vehicular(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 

		//Concatenar hora, minutos y segundos
		$dteFecha = $objMovimiento->dteFecha.' '.date("H:i:s"); 

		//Tabla movimientos_refacciones
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID,
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha,  
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones', $arrDatos);

	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoRefaccionesID = $this->db->insert_id();

	    //Hacer un llamado al método para guardar los detalles de la salida por traspaso vehicular
		$this->guardar_detalles_salida_traspaso_vehicular($objMovimiento);

		//Hacer un llamado al método para modificar el estatus de la solicitud de refacciones internas por traspaso
	    $this->set_estatus_solicitud_traspaso_interno($objMovimiento->intReferenciaID, 
	    											  $objMovimiento->strEstatusSolicitudTraspaso);

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
	public function modificar_salida_traspaso_vehicular(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Concatenar hora, minutos y segundos
		$dteFecha = $objMovimiento->dteFecha.' '.date("H:i:s"); 

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha, 
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_refacciones', $arrDatos);

	    //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($objMovimiento->intMovimientoRefaccionesID, 
	   													  $objMovimiento->intTipoMovimiento, 
	   													  $objMovimiento->dteFecha);

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_id', $objMovimiento->intMovimientoRefaccionesID);
		$this->db->delete('movimientos_refacciones_detalles');

		//Hacer un llamado al método para guardar los detalles de la salida por traspaso vehicular
		$this->guardar_detalles_salida_traspaso_vehicular($objMovimiento);


		//Hacer un llamado al método para modificar el estatus de la solicitud de refacciones internas por traspaso
	    $this->set_estatus_solicitud_traspaso_interno($objMovimiento->intReferenciaID, 
	    											  $objMovimiento->strEstatusSolicitudTraspaso);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_salida_traspaso_vehicular($intMovimientoRefaccionesID = NULL, $intTipoMovimiento = NULL, 
						   		   	      			 $dteFechaInicial = NULL,  $dteFechaFinal = NULL, 
						   		   	      			 $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar al tipo de movimiento entrada de refacciones internas por traspaso
		$intMovEntradaTraspaso = ENTRADA_REFACCIONES_INTERNAS_TRASPASO;

		$this->db->select("MR.movimiento_refacciones_id, MR.sucursal_id, MR.folio, 
						  DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha, 
						   MR.referencia_id,  MR.observaciones, MR.estatus, 
						   STR.folio AS folio_solicitud, S.nombre AS sucursal,
						   (SELECT IFNULL(COUNT(MRIE.movimiento_refacciones_internas_id), 0)
							FROM movimientos_refacciones_internas AS MRIE
							WHERE MRIE.tipo_movimiento = $intMovEntradaTraspaso
							AND MRIE.referencia_id = MR.movimiento_refacciones_id
							AND MRIE.estatus = 'ACTIVO') AS total_entradas_traspaso,
							UC.usuario AS usuario_creacion, 
							DATE_FORMAT(MR.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('solicitudes_traspasos_refacciones_internas AS STR', 'MR.referencia_id = STR.solicitud_traspaso_refacciones_internas_id', 'inner');
		$this->db->join('sucursales AS S', 'MR.sucursal_id = S.sucursal_id', 'inner');
		$this->db->join('usuarios AS UC', 'MR.usuario_creacion = UC.usuario_id', 'left');
		//Si existe id del movimiento
		if ($intMovimientoRefaccionesID !== NULL)
		{   
			$this->db->where('MR.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		     //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('MR.estatus', $strEstatus);
			}

			$this->db->where("(MR.folio LIKE '%$strBusqueda%' OR
	        				   STR.folio LIKE '%$strBusqueda%')"); 
		    $this->db->order_by('MR.fecha DESC, MR.folio DESC');
		    return $this->db->get()->result();
		}

	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_salida_traspaso_vehicular($intTipoMovimiento, $dteFechaInicial = NULL, 
													$dteFechaFinal = NULL, $strEstatus = NULL, $strBusqueda = NULL, 
													$intNumRows, $intPos)
	{
		//Constante para identificar al tipo de movimiento entrada de refacciones internas por traspaso
		$intMovEntradaTraspaso = ENTRADA_REFACCIONES_INTERNAS_TRASPASO;

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MR.estatus', $strEstatus);
		}

		$this->db->where("(MR.folio LIKE '%$strBusqueda%' OR
        				   STR.folio LIKE '%$strBusqueda%')"); 

		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('solicitudes_traspasos_refacciones_internas AS STR', 'MR.referencia_id = STR.solicitud_traspaso_refacciones_internas_id', 'inner');
		$this->db->join('sucursales AS S', 'MR.sucursal_id = S.sucursal_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MR.movimiento_refacciones_id, MR.folio, MR.referencia_id, MR.estatus,
						   DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha, STR.folio AS folio_solicitud, 
						   (SELECT IFNULL(COUNT(MRIE.movimiento_refacciones_internas_id), 0)
							FROM movimientos_refacciones_internas AS MRIE
							WHERE MRIE.tipo_movimiento = $intMovEntradaTraspaso
							AND MRIE.referencia_id = MR.movimiento_refacciones_id
							AND MRIE.estatus = 'ACTIVO') AS total_entradas_traspaso", FALSE);
		$this->db->from('movimientos_refacciones AS MR');
		$this->db->join('solicitudes_traspasos_refacciones_internas AS STR', 'MR.referencia_id = STR.solicitud_traspaso_refacciones_internas_id', 'inner');
		$this->db->join('sucursales AS S', 'MR.sucursal_id = S.sucursal_id', 'inner');
		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MR.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MR.estatus', $strEstatus);
		}

		$this->db->where("(MR.folio LIKE '%$strBusqueda%' OR
        				   STR.folio LIKE '%$strBusqueda%')"); 

		$this->db->order_by('MR.fecha DESC, MR.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*******************************************************************************************************************
	Funciones de la tabla movimientos_refacciones_detalles
	*********************************************************************************************************************/
	/*******************************************************************************************************************
	Funciones para Actualizar Inventario de refacciones
	*********************************************************************************************************************/
	//Método para regresar los detalles de un registro (para actualizar inventario)
	public function buscar_detalles_movimiento($intMovimientoRefaccionesID)
	{
		$this->db->select('renglon, refaccion_id, cantidad');
		$this->db->from('movimientos_refacciones_detalles');
		$this->db->where('movimiento_refacciones_id', $intMovimientoRefaccionesID);
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones del proceso Entradas de Refacciones por Compra
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la entrada de refacciones por compra
	public function guardar_detalles_entrada_compra(stdClass $objMovimiento)
	{


		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener la localización, ID de la refacción, código, descripción, 
		  código de la línea, cantidad, costo unitario, descuento unitario,  iva unitario e ieps unitario
		*/
		$arrLocalizaciones = explode("|", $objMovimiento->strLocalizaciones);
		$arrRefaccionID = explode("|", $objMovimiento->strRefaccionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrCodigosLineas = explode("|", $objMovimiento->strCodigosLineas);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrCostosUnitarios = explode("|", $objMovimiento->strCostosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objMovimiento->strDescuentosUnitarios);
		$arrTasaCuotaIva = explode("|", $objMovimiento->strTasaCuotaIva);
		$arrIvasUnitarios = explode("|", $objMovimiento->strIvasUnitarios);
		$arrTasaCuotaIeps = explode("|", $objMovimiento->strTasaCuotaIeps);
		$arrIepsUnitarios = explode("|", $objMovimiento->strIepsUnitarios);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];
			$intCostoUnitario = $arrCostosUnitarios[$intCon];
			$strLocalizacion = $arrLocalizaciones[$intCon];


			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);

			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_id' => $objMovimiento->intMovimientoRefaccionesID,
							  'renglon' => ($intCon + 1),
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $intCostoUnitario,
							  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva_unitario' => $arrIvasUnitarios[$intCon], 
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps_unitario' => $arrIepsUnitarios[$intCon],
							  'precio_unitario' => 0);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_detalles', $arrDatos);

			//Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   												$intRefaccionID, $intCantidad, $intCostoUnitario, 
	   												$strLocalizacion);

		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_entrada_compra($intMovimientoRefaccionesID)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');

		$this->db->select("MRD.refaccion_id, MRD.codigo, MRD.descripcion, MRD.codigo_linea, 
						   MRD.cantidad, MRD.costo_unitario,
					       MRD.descuento_unitario, MRD.tasa_cuota_iva, MRD.iva_unitario, 
					       MRD.tasa_cuota_ieps, MRD.ieps_unitario, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps, RI.localizacion, 
						   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
						   RM.descripcion AS refacciones_marca,
						   IFNULL(RI.actual_costo, 0) AS actual_costo", FALSE);
		$this->db->from('movimientos_refacciones_detalles AS MRD');
		$this->db->join('movimientos_refacciones AS MR', 'MRD.movimiento_refacciones_id = MR.movimiento_refacciones_id', 'inner');
		$this->db->join('refacciones AS R', 'MRD.refaccion_id = R.refaccion_id', 'inner');
		$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
		$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'MRD.tasa_cuota_iva = TIva.tasa_cuota_id', 'left');
		$this->db->join('sat_tasa_cuota AS TIeps', 'MRD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('refacciones_inventario AS RI', 'MRD.refaccion_id = RI.refaccion_id 
						 AND RI.sucursal_id = MR.sucursal_id AND RI.anio = YEAR(MR.fecha)', 'left');
		$this->db->where('MRD.movimiento_refacciones_id', $intMovimientoRefaccionesID);
		$this->db->order_by('MRD.renglon', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar las tasas de ieps de los detalles de un registro
	public function buscar_tasas_ieps_detalles_entrada_compra($intMovimientoRefaccionesID)
	{
		$this->db->select("DISTINCT MRD.tasa_cuota_ieps, TIeps.valor_maximo AS porcentaje_ieps", FALSE);
		$this->db->from('movimientos_refacciones_detalles AS MRD');
		$this->db->join('sat_tasa_cuota AS TIeps', 'MRD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'inner');
		$this->db->where('MRD.movimiento_refacciones_id', $intMovimientoRefaccionesID);
		$this->db->where('MRD.ieps_unitario > 0');
		return $this->db->get()->result();
	}
	

	/*******************************************************************************************************************
	Funciones del proceso Entradas de Refacciones por Traspaso
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la entrada de refacciones por traspaso
	public function guardar_detalles_entrada_traspaso(stdClass $objMovimiento)
	{


		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el renglón, ID de la refacción, código, descripción, 
		  código de la línea, cantidad y costo unitario
		*/
		$arrRenglon = explode("|", $objMovimiento->strRenglon);
		$arrRefaccionID = explode("|", $objMovimiento->strRefaccionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrCodigosLineas = explode("|", $objMovimiento->strCodigosLineas);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrCostosUnitarios = explode("|", $objMovimiento->strCostosUnitarios);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];
			$intCostoUnitario = $arrCostosUnitarios[$intCon];

			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_id' => $objMovimiento->intMovimientoRefaccionesID,
							  'renglon' => $arrRenglon[$intCon], 
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $intCostoUnitario,
							  'descuento_unitario' => 0,
							  'iva_unitario' => 0, 
							  'ieps_unitario' => 0,
							  'precio_unitario' => 0);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_detalles', $arrDatos);

			//Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   												$intRefaccionID, $intCantidad, 
	   												$intCostoUnitario);

	   		//Hacer un llamado al método para modificar el inventario de la refacción de la salida por traspaso
	   		$this->modificar_inventario_refacciones_salida_traspaso($strAnio, 
	   																$objMovimiento->intSucursalSalidaID, 
	   																$intRefaccionID, 
	   																$intCantidad);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_entrada_traspaso($intMovimientoRefaccionesID, $intReferenciaID = NULL)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Si existe id de la referencia
		if($intReferenciaID  != NULL)
		{
			$this->db->select("MRDS.renglon, MRDS.refaccion_id, MRDS.codigo, MRDS.descripcion, 
							   MRDS.codigo_linea, MRDS.cantidad, MRDS.costo_unitario,
							   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
							   RM.descripcion AS refacciones_marca", FALSE);
			$this->db->from('movimientos_refacciones_detalles AS MRDS');
			$this->db->join('refacciones AS R', 'MRDS.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->where('MRDS.movimiento_refacciones_id', $intReferenciaID);
			$this->db->order_by('MRDS.renglon', 'ASC');

		}
		else
		{
			$this->db->select("MRD.refaccion_id, MRD.codigo, MRD.descripcion, MRD.codigo_linea, 
				               MRD.cantidad, MRD.costo_unitario, RI.localizacion,
				               CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
				               RM.descripcion AS refacciones_marca", FALSE);
			$this->db->from('movimientos_refacciones_detalles AS MRD');
			$this->db->join('movimientos_refacciones AS MR', 
							'MRD.movimiento_refacciones_id = MR.movimiento_refacciones_id', 'inner');
			$this->db->join('refacciones AS R', 'MRD.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('refacciones_inventario AS RI', 'MRD.refaccion_id = RI.refaccion_id 
							 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(MR.fecha)', 'left');
			$this->db->where('MRD.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->order_by('MRD.renglon', 'ASC');
		}

		return $this->db->get()->result();
	}


	/*******************************************************************************************************************
	Funciones del proceso Entradas de Refacciones por Devolución de la Factura
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la devolución de la factura
	public function guardar_detalles_entrada_devolucion_factura(stdClass $objMovimiento)
	{

		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el renglón, ID de la refacción, código, descripción, 
		  código de la línea, cantidad, costo unitario
		  y precio unitario
		*/
		$arrRenglon = explode("|", $objMovimiento->strRenglon);
		$arrRefaccionID = explode("|", $objMovimiento->strRefaccionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrCodigosLineas = explode("|", $objMovimiento->strCodigosLineas);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrCostosUnitarios = explode("|", $objMovimiento->strCostosUnitarios);
		$arrPreciosUnitarios = explode("|", $objMovimiento->strPreciosUnitarios);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];
			$intCostoUnitario = $arrCostosUnitarios[$intCon];

			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_id' => $objMovimiento->intMovimientoRefaccionesID,
							  'renglon' => $arrRenglon[$intCon],
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $intCostoUnitario,
							  'descuento_unitario' => 0,
							  'iva_unitario' => 0, 
							  'ieps_unitario' => 0,
							  'precio_unitario' => $arrPreciosUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_detalles', $arrDatos);

			//Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   												$intRefaccionID, $intCantidad, $intCostoUnitario);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_entrada_devolucion_factura($intMovimientoRefaccionesID, $intReferenciaID = NULL, 
															   $strTipoReferencia = NULL)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución de la factura
		$intMovEntradaDevolucion = ENTRADA_REFACCIONES_DEVOLUCION_FACTURA;
		//Constante para identificar al tipo de movimiento salida de refacciones por taller
		$intMovSalidaTaller = SALIDA_REFACCIONES_TALLER;

		//Si existe id de la referencia
		if($intReferenciaID  != NULL)
		{
			//Dependiendo del tipo de referencia realizar búsqueda de información
			if($strTipoReferencia == 'REFACCIONES')
			{
				$this->db->select("FRD.renglon, FRD.refaccion_id, FRD.codigo, FRD.descripcion, FRD.codigo_linea,
							       FRD.cantidad AS cantidad_salida, 
							       FRD.costo_unitario,  FRD.precio_unitario,
							       IFNULL(MRD.cantidad, 0) AS cantidad_entrada,
							       (SELECT IFNULL(SUM(MRDD.cantidad), 0)
									FROM movimientos_refacciones_detalles AS MRDD
									INNER JOIN movimientos_refacciones AS MR ON MRDD.movimiento_refacciones_id = MR.movimiento_refacciones_id
									WHERE MR.tipo_movimiento = $intMovEntradaDevolucion
									AND MR.referencia_id = $intReferenciaID
									AND MR.tipo_referencia = '$strTipoReferencia'
									AND (MR.estatus = 'TIMBRAR' OR MR.estatus = 'ACTIVO')
									AND MRDD.refaccion_id = FRD.refaccion_id) AS cantidad_devolucion,
									CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
						   			RM.descripcion AS refacciones_marca
									", FALSE);
				$this->db->from('facturas_refacciones_detalles AS FRD');
				$this->db->join('refacciones AS R', 'FRD.refaccion_id = R.refaccion_id', 'inner');
				$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
				$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
				$this->db->join('movimientos_refacciones_detalles AS MRD', 
								'MRD.movimiento_refacciones_id = '.$intMovimientoRefaccionesID.' 
								 AND FRD.refaccion_id = MRD.refaccion_id AND FRD.renglon = MRD.renglon', 'left');
				$this->db->where('FRD.factura_refacciones_id', $intReferenciaID);
				$this->db->order_by('FRD.renglon', 'ASC');
				
			}
			else
			{
				$this->db->select("FSR.renglon, FSR.refaccion_id, FSR.codigo, 
								   FSR.descripcion, FSR.codigo_linea,
							       FSR.cantidad AS cantidad_salida, 
							       MRDST.costo_unitario,  FSR.precio_unitario,
							       IFNULL(MRD.cantidad, 0) AS cantidad_entrada,
							       (SELECT IFNULL(SUM(MRDD.cantidad), 0)
									FROM movimientos_refacciones_detalles AS MRDD
									INNER JOIN movimientos_refacciones AS MR ON MRDD.movimiento_refacciones_id = MR.movimiento_refacciones_id
									WHERE MR.tipo_movimiento = $intMovEntradaDevolucion
									AND MR.referencia_id = $intReferenciaID
									AND MR.tipo_referencia = '$strTipoReferencia'
									AND (MR.estatus = 'TIMBRAR' OR MR.estatus = 'ACTIVO')
									AND MRDD.refaccion_id = FSR.refaccion_id) AS cantidad_devolucion,
									CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
						   			RM.descripcion AS refacciones_marca
									", FALSE);
				$this->db->from('facturas_servicio AS FS');
				$this->db->join('ordenes_reparacion AS OR', 'FS.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
				$this->db->join('requisiciones_refacciones AS RR', 'OR.orden_reparacion_id = RR.orden_reparacion_id', 'inner');
				$this->db->join('movimientos_refacciones AS MRST', 'MRST.tipo_movimiento = '.$intMovSalidaTaller.'
								AND MRST.referencia_id = RR.requisicion_refacciones_id', 'inner');
				$this->db->join('movimientos_refacciones_detalles AS MRDST', 'MRST.movimiento_refacciones_id = MRDST.movimiento_refacciones_id', 'inner');
				$this->db->join('facturas_servicio_refacciones AS FSR', 'FS.factura_servicio_id = FSR.factura_servicio_id
								AND MRDST.refaccion_id = FSR.refaccion_id', 'inner');
				$this->db->join('refacciones AS R', 'FSR.refaccion_id = R.refaccion_id', 'inner');
				$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
				$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
				$this->db->join('movimientos_refacciones_detalles AS MRD', 
								'MRD.movimiento_refacciones_id = '.$intMovimientoRefaccionesID.' 
								 AND FSR.refaccion_id = MRD.refaccion_id AND FSR.renglon = MRD.renglon', 'left');
				$this->db->where('FS.factura_servicio_id', $intReferenciaID);

				$this->db->order_by('MRD.renglon', 'ASC');

			}

			
		}
		else
		{
			$this->db->select("MRD.codigo, MRD.descripcion, MRD.codigo_linea, MRD.cantidad,  MRD.costo_unitario, 
							   MRD.precio_unitario,  RI.localizacion,
							   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
						   	 RM.descripcion AS refacciones_marca");
			$this->db->from('movimientos_refacciones_detalles AS MRD');
			$this->db->join('movimientos_refacciones AS MR', 'MRD.movimiento_refacciones_id = MR.movimiento_refacciones_id', 'inner');
			$this->db->join('refacciones AS R', 'MRD.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('refacciones_inventario AS RI', 'MRD.refaccion_id = RI.refaccion_id 
						 	 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(MR.fecha)', 'left');
			$this->db->where('MRD.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->order_by('MRD.renglon', 'ASC');
		}
		
		return $this->db->get()->result();
	}

	//Método para regresar los detalles de un registro para mostrarlos en el archivo XML
	public function buscar_detalles_xml_devolucion_factura($intMovimientoRefaccionesID)
	{

		$strSQL = $this->db->query("SELECT MRD.movimiento_refacciones_id AS ID, 
								   1 AS renglon,   _utf8'84111506' AS ClaveProdServ, 
								   _utf8'' AS NoIdentificacion, 
								   1 AS cantidad, 
								   _utf8'ACT' AS ClaveUnidad,
								   _utf8'Actividad' AS Unidad,
								   FRD.objeto_impuesto_sat AS ClaveObjetoImpuesto,
								   CONCAT('DEVOLUCION DE FACTURA ', FR.folio) AS Descripcion,
								   CONCAT('DEVOLUCION DE FACTURA ', FR.folio) AS concepto,
								   SUM((MRD.cantidad * MRD.precio_unitario) / MR.tipo_cambio) AS subtotal,
								   0 AS descuento,
								   SUM((MRD.cantidad * FRD.iva_unitario) / MR.tipo_cambio) AS iva,
								   SUM((MRD.cantidad * FRD.ieps_unitario) / MR.tipo_cambio) AS ieps,
								   _utf8'' AS Pedimento,
				  				  TIva.valor_maximo AS PorcentajeIva, TIva.factor AS FactorIva,  
				  				  IIva.codigo AS ImpuestoIva,  TIeps.valor_maximo AS PorcentajeIeps,
				  				  TIeps.factor AS FactorIeps, IIeps.codigo AS ImpuestoIeps, 
				  				  CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto
				  			  FROM movimientos_refacciones AS MR
				  			  INNER JOIN  movimientos_refacciones_detalles AS MRD ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
				  			  INNER JOIN facturas_refacciones AS FR ON MR.referencia_id =  FR.factura_refacciones_id
				  			  		AND MR.tipo_referencia = 'REFACCIONES'
				  			  INNER JOIN facturas_refacciones_detalles AS FRD ON FR.factura_refacciones_id =  FRD.factura_refacciones_id 
				  			  INNER JOIN  sat_tasa_cuota AS TIva ON FRD.tasa_cuota_iva = TIva.tasa_cuota_id
				  			  INNER JOIN  sat_impuestos AS IIva ON TIva.impuesto_id = IIva.impuesto_id
				  			  LEFT JOIN  sat_tasa_cuota AS TIeps ON FRD.tasa_cuota_ieps = TIeps.tasa_cuota_id
				  			  LEFT JOIN  sat_impuestos AS IIeps ON TIeps.impuesto_id = IIeps.impuesto_id
				  			  LEFT JOIN sat_objeto_impuesto AS OImp ON FRD.objeto_impuesto_sat = OImp.codigo
				  			  WHERE MR.movimiento_refacciones_id = $intMovimientoRefaccionesID
				  			  AND   MRD.refaccion_id =  FRD.refaccion_id
				  			  GROUP BY FRD.tasa_cuota_ieps, FRD.tasa_cuota_iva

				  			  UNION 
				  			  	SELECT MRD.movimiento_refacciones_id AS ID, 
								   1 AS renglon,   _utf8'84111506' AS ClaveProdServ, 
								   _utf8'' AS NoIdentificacion, 
								  1 AS cantidad, 
								   _utf8'ACT' AS ClaveUnidad,
								   _utf8'Actividad' AS Unidad,
								   FSR.objeto_impuesto_sat AS ClaveObjetoImpuesto,
								   CONCAT('DEVOLUCION DE FACTURA ', FS.folio) AS Descripcion,
								   CONCAT('DEVOLUCION DE FACTURA ', FS.folio) AS concepto,
								   SUM((MRD.cantidad * MRD.precio_unitario) / MR.tipo_cambio) AS subtotal,
								   0 AS descuento,
								   SUM((MRD.cantidad * FSR.iva_unitario) / MR.tipo_cambio) AS iva,
								   SUM((MRD.cantidad * FSR.ieps_unitario) / MR.tipo_cambio) AS ieps,
								   _utf8'' AS Pedimento,
				  				  TIva.valor_maximo AS PorcentajeIva, TIva.factor AS FactorIva,  
				  				  IIva.codigo AS ImpuestoIva,  TIeps.valor_maximo AS PorcentajeIeps,
				  				  TIeps.factor AS FactorIeps, IIeps.codigo AS ImpuestoIeps, 
				  				  CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto
				  			  FROM movimientos_refacciones AS MR
				  			  INNER JOIN  movimientos_refacciones_detalles AS MRD ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
				  			  INNER JOIN facturas_servicio AS FS ON MR.referencia_id =  FS.factura_servicio_id AND MR.tipo_referencia = 'SERVICIO'
				  			  INNER JOIN facturas_servicio_refacciones AS FSR ON FS.factura_servicio_id =  FSR.factura_servicio_id
				  			  INNER JOIN  sat_tasa_cuota AS TIva ON FSR.tasa_cuota_iva = TIva.tasa_cuota_id
				  			  INNER JOIN  sat_impuestos AS IIva ON TIva.impuesto_id = IIva.impuesto_id
				  			  LEFT JOIN  sat_tasa_cuota AS TIeps ON FSR.tasa_cuota_ieps = TIeps.tasa_cuota_id
				  			  LEFT JOIN  sat_impuestos AS IIeps ON TIeps.impuesto_id = IIeps.impuesto_id
				  			  LEFT JOIN sat_objeto_impuesto AS OImp ON FSR.objeto_impuesto_sat = OImp.codigo
				  			  WHERE MR.movimiento_refacciones_id = $intMovimientoRefaccionesID
				  			  AND   MRD.refaccion_id =  FSR.refaccion_id
				  			  GROUP BY FSR.tasa_cuota_ieps, FSR.tasa_cuota_iva");

		

		return $strSQL->result();
	}

	/*******************************************************************************************************************
	Funciones del proceso Entradas de Refacciones por Devolución del Taller
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la entrada por devolución del taller
	public function guardar_detalles_entrada_devolucion_taller(stdClass $objMovimiento)
	{

		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el renglón, ID de la refacción, código, descripción, 
		  código de la línea, cantidad, costo unitario y precio unitario
		*/
		$arrRenglon = explode("|", $objMovimiento->strRenglon);
		$arrRefaccionID = explode("|", $objMovimiento->strRefaccionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrCodigosLineas = explode("|", $objMovimiento->strCodigosLineas);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrCostosUnitarios = explode("|", $objMovimiento->strCostosUnitarios);
		$arrPreciosUnitarios = explode("|", $objMovimiento->strPreciosUnitarios);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];
			$intCostoUnitario = $arrCostosUnitarios[$intCon];

			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_id' => $objMovimiento->intMovimientoRefaccionesID,
							  'renglon' => $arrRenglon[$intCon],
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $intCostoUnitario,
							  'descuento_unitario' => 0,
							  'iva_unitario' => 0, 
							  'ieps_unitario' => 0,
							  'precio_unitario' =>$arrPreciosUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_detalles', $arrDatos);

			//Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   												$intRefaccionID, $intCantidad, 
	   												$intCostoUnitario);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_entrada_devolucion_taller($intMovimientoRefaccionesID, $intReferenciaID = NULL)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución del taller
		$intMovEntradaDevolucion = ENTRADA_REFACCIONES_DEVOLUCION_TALLER;

		//Si existe id de la referencia
		if($intReferenciaID  != NULL)
		{
			$this->db->select("MRDS.renglon, MRDS.refaccion_id, MRDS.codigo, MRDS.descripcion, MRDS.codigo_linea,
						       MRDS.cantidad AS cantidad_salida, MRDS.costo_unitario,  MRDS.precio_unitario,
						       IFNULL(MRDE.cantidad, 0) AS cantidad_entrada,
						       (SELECT IFNULL(SUM(MRDD.cantidad), 0)
								FROM movimientos_refacciones_detalles AS MRDD
								INNER JOIN movimientos_refacciones AS MR ON MRDD.movimiento_refacciones_id = MR.movimiento_refacciones_id
								WHERE MR.tipo_movimiento = $intMovEntradaDevolucion
								AND MR.referencia_id = $intReferenciaID
								AND MR.estatus = 'ACTIVO'
								AND MRDD.refaccion_id = MRDS.refaccion_id) AS cantidad_devolucion,
								CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
								RM.descripcion AS refacciones_marca", FALSE);
			$this->db->from('movimientos_refacciones_detalles AS MRDS');
			$this->db->join('refacciones AS R', 'MRDS.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('movimientos_refacciones AS MRE', 
							'MRE.movimiento_refacciones_id = '.$intMovimientoRefaccionesID.'
							 AND MRE.referencia_id = MRDS.movimiento_refacciones_id', 'left');
			$this->db->join('movimientos_refacciones_detalles AS MRDE', 
							'MRE.movimiento_refacciones_id = MRDE.movimiento_refacciones_id
							 AND MRDE.refaccion_id = MRDS.refaccion_id AND MRDE.renglon = MRDS.renglon', 'left');
			$this->db->where('MRDS.movimiento_refacciones_id', $intReferenciaID);
			$this->db->order_by('MRDS.renglon', 'ASC');
		}
		else
		{
			$this->db->select("MRD.codigo, MRD.descripcion, MRD.codigo_linea, MRD.cantidad,  MRD.costo_unitario, 
							  MRD.precio_unitario,  RI.localizacion,
							  CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
								RM.descripcion AS refacciones_marca");
			$this->db->from('movimientos_refacciones_detalles AS MRD');
			$this->db->join('movimientos_refacciones AS MR', 'MRD.movimiento_refacciones_id = MR.movimiento_refacciones_id', 'inner');
			$this->db->join('refacciones AS R', 'MRD.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('refacciones_inventario AS RI', 'MRD.refaccion_id = RI.refaccion_id 
						 	 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(MR.fecha)', 'left');
			$this->db->where('MRD.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->order_by('MRD.renglon', 'ASC');
		}
		
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones del proceso Entradas de Refacciones por Ajuste
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la entrada por ajuste
	public function guardar_detalles_entrada_ajuste(stdClass $objMovimiento)
	{

		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el ID de la refacción, código, descripción, código de la línea, 
		  cantidad y costo unitario 
		*/
		$arrRefaccionID = explode("|", $objMovimiento->strRefaccionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrCodigosLineas = explode("|", $objMovimiento->strCodigosLineas);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrCostosUnitarios = explode("|", $objMovimiento->strCostosUnitarios);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];
			$intCostoUnitario = $arrCostosUnitarios[$intCon];

			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_id' => $objMovimiento->intMovimientoRefaccionesID,
							  'renglon' => ($intCon + 1),
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $intCostoUnitario,
							  'descuento_unitario' => 0,
							  'iva_unitario' => 0, 
							  'ieps_unitario' => 0,
							  'precio_unitario' => 0);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_detalles', $arrDatos);

			//Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   												$intRefaccionID, $intCantidad, $intCostoUnitario);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_entrada_ajuste($intMovimientoRefaccionesID)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');

		$this->db->select("MRD.refaccion_id, MRD.codigo, MRD.descripcion, MRD.codigo_linea, 
						   MRD.cantidad, MRD.costo_unitario, RI.localizacion,
						   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
							RM.descripcion AS refacciones_marca
						   ", FALSE);
		$this->db->from('movimientos_refacciones_detalles AS MRD');
		$this->db->join('movimientos_refacciones AS MR', 'MRD.movimiento_refacciones_id = MR.movimiento_refacciones_id', 'inner');
		$this->db->join('refacciones AS R', 'MRD.refaccion_id = R.refaccion_id', 'inner');
		$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
		$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
		$this->db->join('refacciones_inventario AS RI', 'MRD.refaccion_id = RI.refaccion_id 
						 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(MR.fecha)', 'left');
		$this->db->where('MRD.movimiento_refacciones_id', $intMovimientoRefaccionesID);
		$this->db->order_by('MRD.renglon', 'ASC');
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones del proceso Salidas de Refacciones por Taller
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la salida por taller
	public function guardar_detalles_salida_taller(stdClass $objMovimiento)
	{

		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el renglón, ID de la refacción, código, descripción, 
		  código de la línea, cantidad surtida, precio unitario, costo actual,
		  ID del back order, cantidad pendiente por surtir y estatus de la requisición en la tabla back_order
		*/
		$arrRenglon = explode("|", $objMovimiento->strRenglon);
		$arrRefaccionID = explode("|", $objMovimiento->strRefaccionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrCodigosLineas = explode("|", $objMovimiento->strCodigosLineas);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrPreciosUnitarios = explode("|", $objMovimiento->strPreciosUnitarios);
		$arrCostosUnitarios = explode("|", $objMovimiento->strCostosUnitarios);
		$arrBackOrderID = explode("|", $objMovimiento->strBackOrderID);
		$arrCantidadesBackOrder = explode("|", $objMovimiento->strCantidadesBackOrder);
		$arrEstatusBackOrder = explode("|", $objMovimiento->strEstatusBackOrder);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRenglon); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRenglon = $arrRenglon[$intCon];
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];

			//Variables que se utilizan para asignar valores del pedido pendiente
			$intBackOrderID = $arrBackOrderID[$intCon];
			$intCantidadBackOrder = $arrCantidadesBackOrder[$intCon];
			$strEstatusBackOrder = $arrEstatusBackOrder[$intCon];

			/*************************************************************************************
			* Guardar datos de la refacción en la tabla movimientos_refacciones_detalles
			**************************************************************************************/
			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_id' => $objMovimiento->intMovimientoRefaccionesID,
							  'renglon' => $intRenglon,
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $arrCostosUnitarios[$intCon],
							  'descuento_unitario' => 0,
							  'iva_unitario' => 0, 
							  'ieps_unitario' => 0,
							  'precio_unitario' => $arrPreciosUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_detalles', $arrDatos);

			//Si existe id del pedido pendiente 
			if($intBackOrderID > 0)
			{
				//Hacer un llamado a la función para actualizar los datos del pedido pendiente
				$this->modificar_pedido_pendiente($intBackOrderID, $intCantidadBackOrder, $strEstatusBackOrder);
			}
			else
			{
				//Si el estatus es diferente de SURTIDO
				if($strEstatusBackOrder != 'SURTIDO')
				{
					//Hacer un llamado a la función para guardar los datos del pedido pendiente 
					$this->guardar_pedido_pendiente($objMovimiento->intReferenciaID, 
													$intRenglon, 
													$intCantidadBackOrder, 
													$strEstatusBackOrder);
				}
			}
			
			//Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   												$intRefaccionID, $intCantidad);
			
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_salida_taller($intMovimientoRefaccionesID, $intReferenciaID = NULL, 
												 $intTipoMovimiento = NULL, $intOrdenReparacionID = NULL)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución del taller
		$intMovEntradaDevolucion = ENTRADA_REFACCIONES_DEVOLUCION_TALLER;

		//Si existe id de la referencia
		if($intReferenciaID  != NULL)
		{
			$this->db->select("RRD.refaccion_id, RRD.renglon, RRD.codigo, 
							   RRD.descripcion,  RRD.precio_unitario,
							   RRD.codigo_linea, 
							   IFNULL(BO.back_order_id, 0) AS back_order_id, RRD.cantidad AS cantidad_solicitada, 
						       IFNULL(BO.cantidad, 0) AS cantidad_pendiente, 
						       IFNULL(MRD.cantidad, 0) AS cantidad_surtida,
						       IFNULL(RI.actual_costo, 0) AS actual_costo,
						       IFNULL(RI.disponible_existencia, 0) AS disponible_existencia,
						       CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
							   RM.descripcion AS refacciones_marca", FALSE);
			$this->db->from('requisiciones_refacciones_detalles AS RRD');
			$this->db->join('refacciones AS R', 'RRD.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('back_order AS BO', 'RRD.requisicion_refacciones_id = BO.requisicion_refacciones_id 
							 AND RRD.renglon = BO.renglon', 'left');
			$this->db->join('movimientos_refacciones AS MR', 
							'MR.movimiento_refacciones_id = '.$intMovimientoRefaccionesID.'
							 AND MR.referencia_id = RRD.requisicion_refacciones_id', 'left');
			$this->db->join('movimientos_refacciones_detalles AS MRD', 
							'MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
							 AND MRD.refaccion_id = RRD.refaccion_id AND MRD.renglon = RRD.renglon', 'left');
			//Si existe id del movimiento
			if($intMovimientoRefaccionesID > 0)
			{
				$this->db->join('refacciones_inventario AS RI', 'RRD.refaccion_id = RI.refaccion_id 
							 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(MR.fecha)', 'left');
			}
			else
			{
				$this->db->join('refacciones_inventario AS RI', 'RRD.refaccion_id = RI.refaccion_id 
							 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(NOW())', 'left');
			}
			
			$this->db->where('RRD.requisicion_refacciones_id', $intReferenciaID);
			$this->db->order_by('RRD.renglon', 'ASC');
		}
		else
		{

			$this->db->select("MR.folio, DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha, MR.moneda_id,
							   MR.tipo_cambio,
							   RR.folio AS folio_requisicion, MRD.refaccion_id, MRD.codigo, 
							   MRD.descripcion, MRD.codigo_linea, MRD.cantidad, 
							   MRD.costo_unitario, MRD.precio_unitario, 
						       RRD.cantidad AS cantidad_solicitada, RI.localizacion, 
						       PS.codigo AS codigo_sat, U.codigo AS unidad_sat,
						       OImp.codigo AS objeto_impuesto_sat,
						       MRD.descuento_unitario, R.tasa_cuota_iva, R.tasa_cuota_ieps,
						       TIva.valor_maximo AS porcentaje_iva, TIeps.valor_maximo AS porcentaje_ieps, 
						       CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						      (SELECT IFNULL(SUM(MRDE.cantidad), 0)
								FROM movimientos_refacciones_detalles AS MRDE
								INNER JOIN movimientos_refacciones AS MRE ON MRDE.movimiento_refacciones_id = MRE.movimiento_refacciones_id
								WHERE MRE.tipo_movimiento = $intMovEntradaDevolucion
								AND MRE.referencia_id = MR.movimiento_refacciones_id
								AND MRE.estatus = 'ACTIVO'
								AND MRDE.refaccion_id = MRD.refaccion_id) AS cantidad_devolucion,
								CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
							   RM.descripcion AS refacciones_marca", FALSE);
			$this->db->from('requisiciones_refacciones_detalles AS RRD');
			$this->db->join('refacciones AS R', 'RRD.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('sat_productos_servicios AS PS', 'R.producto_servicio_id = PS.producto_servicio_id', 'inner');
			$this->db->join('sat_unidades AS U', 'R.unidad_id = U.unidad_id', 'inner');
			$this->db->join('requisiciones_refacciones AS RR', 'RRD.requisicion_refacciones_id = RR.requisicion_refacciones_id', 'inner');
			$this->db->join('movimientos_refacciones AS MR', 'MR.referencia_id = RR.requisicion_refacciones_id', 'inner');
			$this->db->join('movimientos_refacciones_detalles AS MRD', 'MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
							 AND MRD.refaccion_id = RRD.refaccion_id AND MRD.renglon = RRD.renglon', 'inner');
			$this->db->join('sat_monedas AS M', 'MR.moneda_id = M.moneda_id', 'inner');
			$this->db->join('sat_tasa_cuota AS TIva', 'R.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
			$this->db->join('sat_tasa_cuota AS TIeps', 'R.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
			$this->db->join('sat_objeto_impuesto AS OImp', 'R.objeto_impuesto_id = OImp.objeto_impuesto_id', 'left');
			$this->db->join('refacciones_inventario AS RI', 'RRD.refaccion_id = RI.refaccion_id 
							 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(MR.fecha)', 'left');

			//Si existe id del movimiento
			if ($intMovimientoRefaccionesID !== NULL)
			{
				$this->db->where('MRD.movimiento_refacciones_id', $intMovimientoRefaccionesID);
				$this->db->order_by('MRD.renglon', 'ASC');

			}
			else
			{
				$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
		    	$this->db->where('RR.orden_reparacion_id', $intOrdenReparacionID);
		    	$this->db->where('MR.estatus', 'ACTIVO');
		    	$this->db->order_by('MR.fecha DESC, MR.folio DESC, MRD.renglon ASC');
			}
			
		}
		
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_detalles_salida_taller($intTipoMovimiento, $intOrdenReparacionID, $intNumRows, $intPos)
	{
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución del taller
		$intMovEntradaDevolucion = ENTRADA_REFACCIONES_DEVOLUCION_TALLER;

		//Variable que se utiliza para asignar subconsulta de las entradas por devolución
		$strSubConsultaDevolucion = "(SELECT IFNULL(SUM(MRDE.cantidad), 0)
										FROM movimientos_refacciones_detalles AS MRDE
										INNER JOIN movimientos_refacciones AS MRE ON MRDE.movimiento_refacciones_id = MRE.movimiento_refacciones_id
										WHERE MRE.tipo_movimiento = $intMovEntradaDevolucion
										AND MRE.referencia_id = MR.movimiento_refacciones_id
										AND MRE.estatus = 'ACTIVO'
										AND MRDE.refaccion_id = MRD.refaccion_id) AS cantidad_devolucion";

		//Seleccionar los registros sin límite que coincidan con los criterios de búsqueda
	    $this->db->select("MRD.cantidad, MRD.precio_unitario, MR.estatus,
	    				   RRD.cantidad AS cantidad_solicitada,
	    				   $strSubConsultaDevolucion", FALSE);
		$this->db->from('requisiciones_refacciones_detalles AS RRD');
		$this->db->join('requisiciones_refacciones AS RR', 'RRD.requisicion_refacciones_id = RR.requisicion_refacciones_id', 'inner');
		$this->db->join('movimientos_refacciones AS MR', 'MR.referencia_id = RR.requisicion_refacciones_id', 'inner');
		$this->db->join('movimientos_refacciones_detalles AS MRD', 'MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
					     AND MRD.refaccion_id = RRD.refaccion_id AND MRD.renglon = RRD.renglon', 'inner');
		$this->db->where('MR.sucursal_id',  $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
	    $this->db->where('RR.orden_reparacion_id', $intOrdenReparacionID);
		$arrResultado["registros"] =$this->db->get()->result();
	
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MR.folio, DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha, MR.estatus,
						   RR.folio AS folio_requisicion,  MRD.codigo, MRD.descripcion, MRD.cantidad,
						   MRD.precio_unitario, RRD.cantidad AS cantidad_solicitada, 
						   $strSubConsultaDevolucion", FALSE);
		$this->db->from('requisiciones_refacciones_detalles AS RRD');
		$this->db->join('requisiciones_refacciones AS RR', 'RRD.requisicion_refacciones_id = RR.requisicion_refacciones_id', 'inner');
		$this->db->join('movimientos_refacciones AS MR', 'MR.referencia_id = RR.requisicion_refacciones_id', 'inner');
		$this->db->join('movimientos_refacciones_detalles AS MRD', 'MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
					     AND MRD.refaccion_id = RRD.refaccion_id AND MRD.renglon = RRD.renglon', 'inner');
		$this->db->where('MR.sucursal_id',  $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
	    $this->db->where('RR.orden_reparacion_id', $intOrdenReparacionID);
		$this->db->order_by('MR.fecha DESC, MR.folio DESC, MRD.renglon ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["detalles"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*******************************************************************************************************************
	Funciones del proceso Salidas de Refacciones por Consumo Interno
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la salida por consumo interno
	public function guardar_detalles_salida_consumo_interno(stdClass $objMovimiento)
	{

		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el ID de la refacción, código, descripción, código de la línea, cantidad y costo unitario 
		*/
		$arrRefaccionID = explode("|", $objMovimiento->strRefaccionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrCodigosLineas = explode("|", $objMovimiento->strCodigosLineas);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrCostosUnitarios = explode("|", $objMovimiento->strCostosUnitarios);
		$arrSucursalID = explode("|", $objMovimiento->strSucursalID);
		$arrModuloID = explode("|", $objMovimiento->strModuloID);
		$arrGastoTipoID = explode("|", $objMovimiento->strGastoTipoID);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{

			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];

			//Si no existe id de la sucursal asignar valor nulo
			$intSucursalID = (($arrSucursalID[$intCon] !== '') ? 
						   	   $arrSucursalID[$intCon] : NULL);

			//Si no existe id del módulo asignar valor nulo
			$intModuloID = (($arrModuloID[$intCon] !== '') ? 
						   	   $arrModuloID[$intCon] : NULL);

			//Asignar renglón consecutivo
			$intRenglon = ($intCon + 1);

			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_id' => $objMovimiento->intMovimientoRefaccionesID,
							  'renglon' => $intRenglon,
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $arrCostosUnitarios[$intCon],
							  'descuento_unitario' => 0,
							  'iva_unitario' => 0, 
							  'ieps_unitario' => 0,
							  'precio_unitario' => 0);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_detalles', $arrDatos);

			//Tabla movimientos_refacciones_detalles_gastos
			$arrDatosGasto = array('movimiento_refacciones_id' => $objMovimiento->intMovimientoRefaccionesID,
								   'renglon' => $intRenglon,
								   'sucursal_id' => $intSucursalID, 
								   'modulo_id' => $intModuloID, 
								   'gasto_tipo_id' => $arrGastoTipoID[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_detalles_gastos', $arrDatosGasto);

			//Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   												$intRefaccionID, $intCantidad);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_salida_consumo_interno($intMovimientoRefaccionesID)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');

		$this->db->select("MRD.refaccion_id, MRD.codigo, MRD.descripcion, 
						   MRD.codigo_linea, MRD.cantidad, MRD.costo_unitario,
						   IFNULL(RI.disponible_existencia, 0) AS disponible_existencia, RI.localizacion,
						   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
						   RM.descripcion AS refacciones_marca,
						   MRDG.sucursal_id, MRDG.modulo_id, MRDG.gasto_tipo_id,
						   GT.descripcion AS gasto,  GT.tipo_gasto,
						   S.nombre AS sucursal, M.descripcion AS modulo", FALSE);
		$this->db->from('movimientos_refacciones_detalles AS MRD');
		$this->db->join('refacciones AS R', 'MRD.refaccion_id = R.refaccion_id', 'inner');
		$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
		$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
		$this->db->join('refacciones_inventario AS RI', 'MRD.refaccion_id = RI.refaccion_id 
						 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(NOW())', 'left');
		$this->db->join('movimientos_refacciones_detalles_gastos AS MRDG', 
						'MRD.movimiento_refacciones_id = MRDG.movimiento_refacciones_id 
						 AND MRD.renglon = MRDG.renglon', 'left');
		$this->db->join('gastos_tipos AS GT', 'MRDG.gasto_tipo_id = GT.gasto_tipo_id', 'left');
		$this->db->join('sucursales AS S', 'MRDG.sucursal_id = S.sucursal_id', 'left');
		$this->db->join('modulos AS M', 'MRDG.modulo_id = M.modulo_id', 'left');
		$this->db->where('MRD.movimiento_refacciones_id', $intMovimientoRefaccionesID);
		$this->db->order_by('MRD.renglon', 'ASC');
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones del proceso Salidas de Refacciones por Traspaso
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la salida por traspaso
	public function guardar_detalles_salida_traspaso(stdClass $objMovimiento)
	{
		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el renglón, ID de la refacción, código, descripción, 
		  código de la línea, cantidad surtida, costo unitario,
		  ID del back order, cantidad pendiente por surtir y estatus de la requisición en la tabla back_order
		*/
		$arrRenglon = explode("|", $objMovimiento->strRenglon);
		$arrRefaccionID = explode("|", $objMovimiento->strRefaccionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrCodigosLineas = explode("|", $objMovimiento->strCodigosLineas);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrCostosUnitarios = explode("|", $objMovimiento->strCostosUnitarios);
		$arrBackOrderTraspasoID = explode("|", $objMovimiento->strBackOrderTraspasoID);
		$arrCantidadesBackOrder = explode("|", $objMovimiento->strCantidadesBackOrder);
		$arrEstatusBackOrder = explode("|", $objMovimiento->strEstatusBackOrder);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRenglon); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRenglon = $arrRenglon[$intCon];
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];

			//Variables que se utilizan para asignar valores del pedido pendiente
			$intBackOrderTraspasoID = $arrBackOrderTraspasoID[$intCon];
			$intCantidadBackOrder = $arrCantidadesBackOrder[$intCon];
			$strEstatusBackOrder = $arrEstatusBackOrder[$intCon];

			/*************************************************************************************
			* Guardar datos de la refacción en la tabla movimientos_refacciones_detalles
			**************************************************************************************/
			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_id' => $objMovimiento->intMovimientoRefaccionesID,
							  'renglon' => $intRenglon,
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $arrCostosUnitarios[$intCon],
							  'descuento_unitario' => 0,
							  'iva_unitario' => 0, 
							  'ieps_unitario' => 0,
							  'precio_unitario' => 0);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_detalles', $arrDatos);

			//Si existe id del pedido pendiente 
			if($intBackOrderTraspasoID > 0)
			{
				//Hacer un llamado a la función para actualizar los datos del pedido pendiente
				$this->modificar_pedido_pendiente_traspaso($intBackOrderTraspasoID, 
														   $intCantidadBackOrder, 
														   $strEstatusBackOrder);
			}
			else
			{
				//Si el estatus es diferente de SURTIDO
				if($strEstatusBackOrder != 'SURTIDO')
				{
					//Hacer un llamado a la función para guardar los datos del pedido pendiente 
					$this->guardar_pedido_pendiente_traspaso($objMovimiento->intReferenciaID, 
															 $intRenglon, 
														 	 $intCantidadBackOrder, 
														 	 $strEstatusBackOrder);
				}
				
			}

		    //Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   											    $intRefaccionID, $intCantidad);
		}

	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_salida_traspaso($intMovimientoRefaccionesID, $intReferenciaID = NULL)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');

		//Si existe id de la referencia
		if($intReferenciaID  != NULL)
		{
			$this->db->select("STRD.refaccion_id, STRD.renglon, STRD.codigo, 
							   STRD.descripcion, RL.codigo AS codigo_linea, 
							   IFNULL(BOT.back_order_traspaso_id, 0) AS back_order_traspaso_id, STRD.cantidad AS cantidad_solicitada, 
						       IFNULL(BOT.cantidad, 0) AS cantidad_pendiente, 
						       IFNULL(MRD.cantidad, 0) AS cantidad_surtida,
						       IFNULL(RI.actual_costo, 0) AS actual_costo,
						       IFNULL(RI.disponible_existencia, 0) AS disponible_existencia,
						       CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
							   RM.descripcion AS refacciones_marca", FALSE);
			$this->db->from('solicitudes_traspasos_refacciones_detalles AS STRD');
			$this->db->join('refacciones AS R', 'STRD.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('back_order_traspasos AS BOT', 
							'STRD.solicitud_traspaso_refacciones_id = BOT.solicitud_traspaso_refacciones_id 
							AND STRD.renglon = BOT.renglon', 'left');
			$this->db->join('movimientos_refacciones AS MR', 
							'MR.movimiento_refacciones_id = '.$intMovimientoRefaccionesID.'
							 AND MR.referencia_id = STRD.solicitud_traspaso_refacciones_id', 'left');
			$this->db->join('movimientos_refacciones_detalles AS MRD', 
							'MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
							 AND MRD.refaccion_id = STRD.refaccion_id AND MRD.renglon = STRD.renglon', 'left');
			//Si existe id del movimiento
			if($intMovimientoRefaccionesID > 0)
			{
				$this->db->join('refacciones_inventario AS RI', 'STRD.refaccion_id = RI.refaccion_id 
						     AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(MR.fecha)', 'left');
			}
			else
			{
				$this->db->join('refacciones_inventario AS RI', 'STRD.refaccion_id = RI.refaccion_id 
						     AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(NOW())', 'left');
			}
			
			$this->db->where('STRD.solicitud_traspaso_refacciones_id', $intReferenciaID);
			$this->db->order_by('STRD.renglon', 'ASC');
		}
		else
		{
			$this->db->select("MRD.codigo, MRD.descripcion, MRD.codigo_linea, MRD.cantidad, MRD.costo_unitario, 
						       MRD.precio_unitario, STRD.cantidad AS cantidad_solicitada, RI.localizacion,
						       CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
							   RM.descripcion AS refacciones_marca");
			$this->db->from('solicitudes_traspasos_refacciones_detalles AS STRD');
			$this->db->join('refacciones AS R', 'STRD.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('movimientos_refacciones AS MR', 
							'MR.referencia_id = STRD.solicitud_traspaso_refacciones_id', 'inner');
			$this->db->join('movimientos_refacciones_detalles AS MRD', 
							'MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
							 AND MRD.refaccion_id = STRD.refaccion_id AND MRD.renglon = STRD.renglon', 'inner');
			$this->db->join('refacciones_inventario AS RI', 'STRD.refaccion_id = RI.refaccion_id 
						     AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(MR.fecha)', 'left');
			$this->db->where('MR.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->order_by('MRD.renglon', 'ASC');
		}
		
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones del proceso Salidas de Refacciones por Devolución al Proveedor
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la salida por devolución al proveedor
	public function guardar_detalles_salida_devolucion_proveedor(stdClass $objMovimiento)
	{

		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el renglón, ID de la refacción, código, descripción, 
		  código de la línea, cantidad, costo unitario, descuento unitario, iva unitario e ieps unitario
		*/
		$arrRenglon = explode("|", $objMovimiento->strRenglon);
		$arrRefaccionID = explode("|", $objMovimiento->strRefaccionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrCodigosLineas = explode("|", $objMovimiento->strCodigosLineas);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrCostosUnitarios = explode("|", $objMovimiento->strCostosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objMovimiento->strDescuentosUnitarios);
		$arrTasaCuotaIva = explode("|", $objMovimiento->strTasaCuotaIva);
		$arrIvasUnitarios = explode("|", $objMovimiento->strIvasUnitarios);
		$arrTasaCuotaIeps = explode("|", $objMovimiento->strTasaCuotaIeps);
		$arrIepsUnitarios = explode("|", $objMovimiento->strIepsUnitarios);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRenglon); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];

			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);
				
			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_id' => $objMovimiento->intMovimientoRefaccionesID,
							  'renglon' => $arrRenglon[$intCon],
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $arrCostosUnitarios[$intCon],
							  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva_unitario' => $arrIvasUnitarios[$intCon], 
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps_unitario' => $arrIepsUnitarios[$intCon],
							  'precio_unitario' => 0);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_detalles', $arrDatos);

			//Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   												$intRefaccionID, $intCantidad);

		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_salida_devolucion_proveedor($intMovimientoRefaccionesID, $intReferenciaID = NULL)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Constante para identificar al tipo de movimiento salida de refacciones por devolución al proveedor
		$intMovSalidaDevolucion = SALIDA_REFACCIONES_DEVOLUCION_PROVEEDOR;

		//Si existe id de la referencia
		if($intReferenciaID  != NULL)
		{
			$this->db->select("MRDE.renglon, MRDE.refaccion_id, MRDE.codigo, MRDE.descripcion, MRDE.codigo_linea,
						       MRDE.cantidad AS cantidad_entrada, MRDE.costo_unitario, 
						       MRDE.descuento_unitario AS descuento_unitario_entrada, MRDE.tasa_cuota_iva,
						       MRDE.iva_unitario AS iva_unitario_entrada, MRDE.tasa_cuota_ieps,
						       MRDE.ieps_unitario AS ieps_unitario_entrada, 
						       TIva.valor_maximo AS porcentaje_iva, 
						   	   TIeps.valor_maximo AS porcentaje_ieps,
						       IFNULL(MRDS.cantidad, 0) AS cantidad_salida, 
						       IFNULL(MRDS.descuento_unitario, 0) AS descuento_unitario_salida, 
						       IFNULL(MRDS.iva_unitario, 0) AS iva_unitario_salida,
						       IFNULL(MRDS.ieps_unitario, 0) AS ieps_unitario_salida, 
						       (SELECT IFNULL(SUM(MRDD.cantidad), 0)
								FROM movimientos_refacciones_detalles AS MRDD
								INNER JOIN movimientos_refacciones AS MR ON MRDD.movimiento_refacciones_id = MR.movimiento_refacciones_id
								WHERE MR.tipo_movimiento = $intMovSalidaDevolucion
								AND MR.referencia_id = $intReferenciaID
								AND MR.estatus = 'ACTIVO'
								AND MRDD.refaccion_id = MRDE.refaccion_id) AS cantidad_devolucion,
								IFNULL(RI.disponible_existencia, 0) AS disponible_existencia,
								CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
								RM.descripcion AS refacciones_marca", FALSE);
			$this->db->from('movimientos_refacciones_detalles AS MRDE');
			$this->db->join('refacciones AS R', 'MRDE.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('sat_tasa_cuota AS TIva', 'MRDE.tasa_cuota_iva = TIva.tasa_cuota_id', 'left');
			$this->db->join('sat_tasa_cuota AS TIeps', 'MRDE.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
			$this->db->join('refacciones_inventario AS RI', 'MRDE.refaccion_id = RI.refaccion_id 
						     AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(NOW())', 'left');
			$this->db->join('movimientos_refacciones_detalles AS MRDS', 
							'MRDS.movimiento_refacciones_id = '.$intMovimientoRefaccionesID.' 
							 AND MRDE.refaccion_id = MRDS.refaccion_id AND MRDE.renglon = MRDS.renglon', 'left');
			$this->db->where('MRDE.movimiento_refacciones_id', $intReferenciaID);
			$this->db->order_by('MRDE.renglon', 'ASC');
		}
		else
		{
			$this->db->select("MRD.codigo, MRD.descripcion, MRD.codigo_linea, MRD.cantidad, MRD.costo_unitario, 
						       MRD.descuento_unitario, MRD.tasa_cuota_iva, MRD.iva_unitario, 
						       MRD.tasa_cuota_ieps, MRD.ieps_unitario, TIva.valor_maximo AS porcentaje_iva, 
						   	   TIeps.valor_maximo AS porcentaje_ieps, RI.localizacion,
						   	   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
						   	   RM.descripcion AS refacciones_marca");
			$this->db->from('movimientos_refacciones_detalles AS MRD');
			$this->db->join('movimientos_refacciones AS MR', 'MRD.movimiento_refacciones_id = MR.movimiento_refacciones_id', 'inner');
			$this->db->join('refacciones AS R', 'MRD.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('sat_tasa_cuota AS TIva', 'MRD.tasa_cuota_iva = TIva.tasa_cuota_id', 'left');
			$this->db->join('sat_tasa_cuota AS TIeps', 'MRD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
			$this->db->join('refacciones_inventario AS RI', 'MRD.refaccion_id = RI.refaccion_id 
						 	 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(MR.fecha)', 'left');
			$this->db->where('MRD.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->order_by('MRD.renglon', 'ASC');
		}
		
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones del proceso Salidas de Refacciones por Ajuste
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la salida por ajuste
	public function guardar_detalles_salida_ajuste(stdClass $objMovimiento)
	{

		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el ID de la refacción, código, descripción, código de la línea, 
		  cantidad y costo unitario 
		*/
		$arrRefaccionID = explode("|", $objMovimiento->strRefaccionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrCodigosLineas = explode("|", $objMovimiento->strCodigosLineas);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrCostosUnitarios = explode("|", $objMovimiento->strCostosUnitarios);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];

			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_id' => $objMovimiento->intMovimientoRefaccionesID,
							  'renglon' => ($intCon + 1),
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $arrCostosUnitarios[$intCon],
							  'descuento_unitario' => 0,
							  'iva_unitario' => 0, 
							  'ieps_unitario' => 0,
							  'precio_unitario' => 0);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_detalles', $arrDatos);

			//Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   												$intRefaccionID, $intCantidad);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_salida_ajuste($intMovimientoRefaccionesID)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');

		$this->db->select("MRD.refaccion_id, MRD.codigo, MRD.descripcion, MRD.codigo_linea, 
						   MRD.cantidad, MRD.costo_unitario,
						   IFNULL(RI.disponible_existencia, 0) AS disponible_existencia, RI.localizacion,
						   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
						   RM.descripcion AS refacciones_marca", FALSE);
		$this->db->from('movimientos_refacciones_detalles AS MRD');
		$this->db->join('movimientos_refacciones AS MR', 'MRD.movimiento_refacciones_id = MR.movimiento_refacciones_id', 'inner');
		$this->db->join('refacciones AS R', 'MRD.refaccion_id = R.refaccion_id', 'inner');
		$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
		$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
		$this->db->join('refacciones_inventario AS RI', 'MRD.refaccion_id = RI.refaccion_id 
						 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(MR.fecha)', 'left');
		$this->db->where('MRD.movimiento_refacciones_id', $intMovimientoRefaccionesID);
		$this->db->order_by('MRD.renglon', 'ASC');
		return $this->db->get()->result();
	}


	/*******************************************************************************************************************
	Funciones del proceso Salidas de Refacciones por Traspaso Vehicular
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la salida por traspaso vehicular
	public function guardar_detalles_salida_traspaso_vehicular(stdClass $objMovimiento)
	{
		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el renglón, ID de la refacción, código, descripción, 
		  código de la línea, cantidad surtida, costo unitario,
		  ID del back order, cantidad pendiente por surtir y estatus de la requisición en la tabla back_order
		*/
		$arrRenglon = explode("|", $objMovimiento->strRenglon);
		$arrRefaccionID = explode("|", $objMovimiento->strRefaccionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrCodigosLineas = explode("|", $objMovimiento->strCodigosLineas);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrCostosUnitarios = explode("|", $objMovimiento->strCostosUnitarios);
		$arrBackOrderTraspasoInternoID = explode("|", $objMovimiento->strBackOrderTraspasoInternoID);
		$arrCantidadesBackOrder = explode("|", $objMovimiento->strCantidadesBackOrder);
		$arrEstatusBackOrder = explode("|", $objMovimiento->strEstatusBackOrder);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_detalles
		for ($intCon = 0; $intCon < sizeof($arrRenglon); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRenglon = $arrRenglon[$intCon];
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];

			//Variables que se utilizan para asignar valores del pedido pendiente
			$intBackOrderTraspasoInternoID = $arrBackOrderTraspasoInternoID[$intCon];
			$intCantidadBackOrder = $arrCantidadesBackOrder[$intCon];
			$strEstatusBackOrder = $arrEstatusBackOrder[$intCon];

			/*************************************************************************************
			* Guardar datos de la refacción en la tabla movimientos_refacciones_detalles
			**************************************************************************************/
			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_id' => $objMovimiento->intMovimientoRefaccionesID,
							  'renglon' => $intRenglon,
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $arrCostosUnitarios[$intCon],
							  'descuento_unitario' => 0,
							  'iva_unitario' => 0, 
							  'ieps_unitario' => 0,
							  'precio_unitario' => 0);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_detalles', $arrDatos);

			//Si existe id del pedido pendiente 
			if($intBackOrderTraspasoInternoID > 0)
			{
				//Hacer un llamado a la función para actualizar los datos del pedido pendiente
				$this->modificar_pedido_pendiente_traspaso_interno($intBackOrderTraspasoInternoID, 
																   $intCantidadBackOrder, 
														  		   $strEstatusBackOrder);
			}
			else
			{
				//Si el estatus es diferente de SURTIDO
				if($strEstatusBackOrder != 'SURTIDO')
				{
					//Hacer un llamado a la función para guardar los datos del pedido pendiente 
					$this->guardar_pedido_pendiente_traspaso_interno($objMovimiento->intReferenciaID, 
																     $intRenglon, 
														 	 		 $intCantidadBackOrder, 
														 	 		 $strEstatusBackOrder);
				}
				
			}

		    //Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   												$intRefaccionID, $intCantidad);

		}

	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_salida_traspaso_vehicular($intMovimientoRefaccionesID, 
															  $intReferenciaID = NULL)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');


		//Si existe id de la referencia
		if($intReferenciaID  != NULL)
		{

			$this->db->select("STRD.refaccion_id, STRD.renglon, STRD.codigo, 
							   STRD.descripcion, RL.codigo AS codigo_linea, 
							   IFNULL(BOT.back_order_traspaso_interno_id, 0) AS back_order_traspaso_interno_id, 
							   STRD.cantidad AS cantidad_solicitada, 
						       IFNULL(BOT.cantidad, 0) AS cantidad_pendiente, 
						       IFNULL(MRD.cantidad, 0) AS cantidad_surtida,
						       IFNULL(RI.actual_costo, 0) AS actual_costo,
						       IFNULL(RI.disponible_existencia, 0) AS disponible_existencia,
						       CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
							   RM.descripcion AS refacciones_marca", FALSE);
			$this->db->from('solicitudes_traspasos_refacciones_internas_detalles AS STRD');
			$this->db->join('refacciones AS R', 'STRD.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('back_order_traspasos_internos AS BOT', 
							'STRD.solicitud_traspaso_refacciones_internas_id = BOT.solicitud_traspaso_refacciones_internas_id 
							 AND STRD.renglon = BOT.renglon', 'left');
			$this->db->join('movimientos_refacciones AS MR', 
							'MR.movimiento_refacciones_id = '.$intMovimientoRefaccionesID.'
							 AND MR.referencia_id = STRD.solicitud_traspaso_refacciones_internas_id', 'left');
			$this->db->join('movimientos_refacciones_detalles AS MRD', 
							'MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
							 AND MRD.refaccion_id = STRD.refaccion_id AND MRD.renglon = STRD.renglon', 'left');
			//Si existe id del movimiento
			if($intMovimientoRefaccionesID > 0)
			{
				$this->db->join('refacciones_inventario AS RI', 'STRD.refaccion_id = RI.refaccion_id 
						     AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(MR.fecha)', 'left');
			}
			else
			{
				$this->db->join('refacciones_inventario AS RI', 'STRD.refaccion_id = RI.refaccion_id 
						     AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(NOW())', 'left');
			}
			$this->db->where('STRD.solicitud_traspaso_refacciones_internas_id', $intReferenciaID);
			$this->db->order_by('STRD.renglon', 'ASC');
		}
		else
		{

			$this->db->select("MRD.codigo, MRD.descripcion, MRD.codigo_linea, MRD.cantidad, MRD.costo_unitario, 
						       MRD.precio_unitario, STRD.cantidad AS cantidad_solicitada, RI.localizacion,
						       CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
							   RM.descripcion AS refacciones_marca");
			$this->db->from('solicitudes_traspasos_refacciones_internas_detalles AS STRD');
			$this->db->join('refacciones AS R', 'STRD.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('movimientos_refacciones AS MR', 
							'MR.referencia_id = STRD.solicitud_traspaso_refacciones_internas_id', 'inner');
			$this->db->join('movimientos_refacciones_detalles AS MRD', 
							'MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
							 AND MRD.refaccion_id = STRD.refaccion_id AND MRD.renglon = STRD.renglon', 'inner');
			$this->db->join('refacciones_inventario AS RI', 'STRD.refaccion_id = RI.refaccion_id 
						     AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(MR.fecha)', 'left');
			$this->db->where('MR.movimiento_refacciones_id', $intMovimientoRefaccionesID);
			$this->db->order_by('MRD.renglon', 'ASC');
		}
		
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla refacciones_inventario
	*********************************************************************************************************************/
	//Función que se utiliza para guardar las refacciones en el inventario
	public function guardar_refacciones_inventario($dteFecha, $strRefaccionID, $strLocalizaciones = NULL)
	{
		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $dteFecha);
		$strAnio = $strFecha[0];

		//Quitar | de la lista para obtener el ID de la refacción y localización
		$arrRefaccionID = explode("|", $strRefaccionID);

		//Si existe el array de localizaciones 
		if($strLocalizaciones != NULL)
		{
			$arrLocalizaciones = explode("|", $strLocalizaciones);
		}
	
		//Hacer recorrido para insertar los datos en la tabla refacciones_inventario
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionID[$intCon];
			$strLocalizacion = '';

			//Si existe el array de localizaciones 
			if($strLocalizaciones != NULL)
			{
				$strLocalizacion = $arrLocalizaciones[$intCon];
			}

			//Seleccionar los datos de inventario de la refacción
			$otdInventario = $this->buscar_inventario_refaccion($intRefaccionID, $strAnio);

			//Si no existen datos del inventario
			if(!$otdInventario)
			{	
				//Asignar datos al array
				$arrDatos = array('sucursal_id' => $this->session->userdata('sucursal_id'),
						  	   	  'refaccion_id' => $intRefaccionID,
						  	   	  'anio' => $strAnio,
						  	   	  'localizacion' => $strLocalizacion,
						  	   	  'clasificacion' => '',
								  'clasificacion_planta' => '',
								  'minimo' => 0,
								  'maximo' => 0,
								  'reorden' => 0,
								  'inicial_existencia' => 0,
								  'inicial_costo' => 0,
								  'actual_existencia' => 0,
								  'disponible_existencia' => 0,
								  'actual_costo' => 0);
				//Guardar los datos del registro
				$this->db->insert('refacciones_inventario', $arrDatos);
			}
		}
	}

	//Función que se utiliza para modificar el inventario de una refacción de la salida por traspaso
	public function modificar_inventario_refacciones_salida_traspaso($strAnio, $intSucursalSalidaID, $intRefaccionID, 
																	$intCantidad)
	{
		//Actualizar existencia de la refacción en inventario
		//Seleccionar los datos de inventario de la refacción
		$otdInventario = $this->buscar_inventario_refaccion($intRefaccionID, $strAnio, $intSucursalSalidaID);
		//Asignar datos a las variables
		$intExistenciaActual = $otdInventario->actual_existencia;
		$intExistenciaDisponible = $otdInventario->disponible_existencia;

		//Decrementar existencia actual
		$intExistenciaActual -= $intCantidad;

		/*************************************************************************************
		* Actualizar datos del inventario por cada registro 
		* de la tabla refacciones_inventario		
		**************************************************************************************/
		$arrInventario = array('actual_existencia' => $intExistenciaActual);
		$this->db->where('sucursal_id', $intSucursalSalidaID);
		$this->db->where('anio', $strAnio);
		$this->db->where('refaccion_id', $intRefaccionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('refacciones_inventario', $arrInventario);
	}

	//Función que se utiliza para modificar el inventario de una refacción de la salida por traspaso vehicular
	public function modificar_inventario_refacciones_salida_traspaso_vehicular($strAnio, $intRefaccionID, $intCantidad)
	{
		//Actualizar existencia de la refacción en inventario
		//Seleccionar los datos de inventario de la refacción
		$otdInventario = $this->buscar_inventario_refaccion($intRefaccionID, $strAnio);
		//Asignar datos a las variables
		$intExistenciaActual = $otdInventario->actual_existencia;
		$intExistenciaDisponible = $otdInventario->disponible_existencia;

		//Decrementar existencia actual
		$intExistenciaActual -= $intCantidad;

		/*************************************************************************************
		* Actualizar datos del inventario por cada registro 
		* de la tabla refacciones_inventario		
		**************************************************************************************/
		$arrInventario = array('actual_existencia' => $intExistenciaActual);
		$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('anio', $strAnio);
		$this->db->where('refaccion_id', $intRefaccionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('refacciones_inventario', $arrInventario);
	}

	//Función que se utiliza para modificar el inventario de una refacción del movimiento 
	public function modificar_inventario_refacciones($strAnio, $intTipoMovimiento, $intRefaccionID, 
													 $intCantidad, $intCostoUnitario = NULL, $strLocalizacion = NULL)
	{
		
		//Actualizar existencia de la refacción en inventario
		//Seleccionar los datos de inventario de la refacción
		$otdInventario = $this->buscar_inventario_refaccion($intRefaccionID, $strAnio);
		//Asignar datos a las variables
		$intExistenciaActual = $otdInventario->actual_existencia;
		$intExistenciaDisponible = $otdInventario->disponible_existencia;
		$intCostoActual = $otdInventario->actual_costo;

		//Si el tipo de movimiento corresponde a una entrada
		if($intTipoMovimiento < SALIDA_REFACCIONES_TALLER)
		{
			//Si el movimiento es de entrada a Almacén			
			if (($intExistenciaActual + $intCantidad) != 0)
			{
				//Calcular costo actual
				$intCostoActual = (($intCostoActual * $intExistenciaActual) + ($intCostoUnitario * $intCantidad)) / ($intExistenciaActual + $intCantidad);
			}
			else
			{
				//Asignar costo unitario
				$intCostoActual = $intCostoUnitario;
			}

			//Incrementar existencia actual
			$intExistenciaActual += $intCantidad;

			//Incrementar existencia disponible 
			$intExistenciaDisponible += $intCantidad;

			/*************************************************************************************
			* Array ques se utiliza para actualizar datos del inventario
			**************************************************************************************/
			$arrInventario = array('actual_existencia' => $intExistenciaActual,
						  	   	   'disponible_existencia' => $intExistenciaDisponible,
						  	   	   'actual_costo' => $intCostoActual);

			//Si el tipo de movimiento corresponde a una estrada por compra
			if($intTipoMovimiento == ENTRADA_REFACCIONES_COMPRA)
			{
				//Agregar elemento en el array
				$arrInventario['localizacion'] = $strLocalizacion; 
			}
			
		}
		else
		{
			//Decrementar existencia disponible
			$intExistenciaDisponible -= $intCantidad;

			/*************************************************************************************
			* Array ques se utiliza para actualizar datos del inventario
			**************************************************************************************/
			$arrInventario = array('disponible_existencia' => $intExistenciaDisponible);

			//Si el tipo de movimiento no corresponde a una salida de refacciones por traspaso
			if($intTipoMovimiento != SALIDA_REFACCIONES_TRASPASO &&  
			   $intTipoMovimiento != SALIDA_REFACCIONES_TRASPASO_VEHICULAR)
			{
				//Decrementar existencia actual
				$intExistenciaActual -= $intCantidad;

				//Agregar elemento en el array
				$arrInventario['actual_existencia'] = $intExistenciaActual; 
			}

		}
		
		
		/*************************************************************************************
		* Actualizar datos del inventario por cada registro 
		* de la tabla refacciones_inventario		
		**************************************************************************************/
		$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('anio', $strAnio);
		$this->db->where('refaccion_id', $intRefaccionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('refacciones_inventario', $arrInventario);

	}

	//Función que se utiliza para modificar el historial de refacciones de la salida por traspaso 
	//(normal o vehicular) en el inventario
	public function modificar_historial_inventario_refacciones_salida_traspaso($intMovimientoRefaccionesID, 
																			   $intSucursalSalidaID = NULL)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Seleccionar la fecha del movimiento que coincide con el id
		$otdFechaMovimiento = $this->buscar_fecha_movimiento($intMovimientoRefaccionesID);

		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $otdFechaMovimiento->fecha);
		$strAnio = $strFecha[0];

		//Seleccionar los detalles del movimiento
		$otdDetalles = $this->buscar_detalles_movimiento($intMovimientoRefaccionesID);

		//Hacer recorrido para actualizar los datos del inventario
	    foreach ($otdDetalles as $arrDet) 
		{
			//Asignar id de la refacción interna
			$intRefaccionID = $arrDet->refaccion_id;
			//Seleccionar los datos de inventario de la refacción
			$otdInventario = $this->buscar_inventario_refaccion($intRefaccionID, $strAnio, $intSucursalSalidaID);
			//Asignar datos a las variables
			$numCantidadActual = $otdInventario->actual_existencia;

			//Incrementar existencia actual
	        $numCantidadActual += $arrDet->cantidad;

	        /*************************************************************************************
			* Actualizar datos del inventario por cada registro 
			* de la tabla refacciones_inventario		
			**************************************************************************************/
			$arrInventario = array('actual_existencia' => $numCantidadActual);
			//Si existe id de la sucursal de salida
			if($intSucursalSalidaID != NULL)
			{
				$this->db->where('sucursal_id', $intSucursalSalidaID);
			}
			else
			{
				$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
			}
			$this->db->where('anio', $strAnio);
			$this->db->where('refaccion_id', $intRefaccionID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('refacciones_inventario', $arrInventario);
			
		}//Cierre de foreach detalles del movimiento

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Función que se utiliza para modificar el historial de refacciones en el inventario
	public function modificar_historial_inventario_refacciones($intMovimientoRefaccionesID, $intTipoMovimiento, 
															  $dteFecha)
	{
		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $dteFecha);
		$strAnio = $strFecha[0];

		//Seleccionar los detalles del movimiento
		$otdDetalles = $this->buscar_detalles_movimiento($intMovimientoRefaccionesID);

		//Hacer recorrido para actualizar los datos del inventario
	    foreach ($otdDetalles as $arrDet) 
		{
			//Asignar id de la refacción
			$intRefaccionID = $arrDet->refaccion_id;
			//Seleccionar los datos de inventario de la refacción
			$otdInventario = $this->buscar_inventario_refaccion($intRefaccionID, $strAnio);
			//Asignar datos a las variables
			$numCantidadActual = $otdInventario->inicial_existencia;
		    $numCantidadDisponible = $otdInventario->inicial_existencia;
			$numCostoActual = $otdInventario->inicial_costo;

			
			//Seleccionar todos los movimientos activos de la refacción excluyendo el movimiento seleccionado
			$otdMovimientos = $this->buscar_movimientos_activos_refaccion($intRefaccionID, $strAnio, 
																		  $intMovimientoRefaccionesID);

			//Si hay información de movimientos
			if($otdMovimientos)
			{
				//Recorremos el arreglo 
				foreach ($otdMovimientos as $arrMov) 
				{
					//Asignar tipo de movimiento
					$intTipoMovimiento = $arrMov->tipo_movimiento;

					//Si el tipo de movimiento corresponde a una entrada
					if ($intTipoMovimiento < SALIDA_REFACCIONES_TALLER)
					{
						//Calcular costo actual
						$numCostoActual = (($numCantidadActual * $numCostoActual) + ($arrMov->cantidad * $arrMov->costo_unitario));

						//Incrementar cantidad actual
						$numCantidadActual += $arrMov->cantidad;

						//Incrementar cantidad disponible 
						$numCantidadDisponible += $arrMov->cantidad;

					}
					else
					{
						//Calcular costo actual
						$numCostoActual = (($numCantidadActual * $numCostoActual) - ($arrMov->cantidad * $arrMov->costo_unitario));

						
						//Decrementar cantidad actual
						$numCantidadActual -= $arrMov->cantidad;

						//Decrementar cantidad disponible 
						$numCantidadDisponible -= $arrMov->cantidad;

					}
					
					//Si hay existencia
					if ($numCantidadActual <> 0)
					{
						//Calcular costo actual
						$numCostoActual = $numCostoActual / $numCantidadActual;
					}
				}

			}//Cierre de verificación de movimientos de refacciones


			/*************************************************************************************
			* Array ques se utiliza para actualizar datos del inventario
			**************************************************************************************/
			$arrInventario = array('disponible_existencia' => $numCantidadDisponible, 
								   'actual_costo' => $numCostoActual);

			//Si el tipo de movimiento no corresponde a una salida de refacciones por traspaso
			if($intTipoMovimiento != SALIDA_REFACCIONES_TRASPASO && 
			   $intTipoMovimiento != SALIDA_REFACCIONES_TRASPASO_VEHICULAR)
			{
				//Agregar elemento en el array
				$arrInventario['actual_existencia'] = $numCantidadActual; 
			}
			
			/*************************************************************************************
			* Actualizar datos del inventario por cada registro 
			* de la tabla refacciones_inventario		
			**************************************************************************************/
			$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('anio', $strAnio);
			$this->db->where('refaccion_id', $intRefaccionID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('refacciones_inventario', $arrInventario);

		}//Cierre de foreach detalles del movimiento
	}

	//Método para regresar los datos de inventario que coinciden con los criterios de búsqueda proporcionados
	public function buscar_inventario_refaccion($intRefaccionID, $strAnio, $intSucursalSalidaID = NULL)
	{
		$this->db->select('inicial_existencia, inicial_costo, actual_existencia, disponible_existencia, actual_costo');
		$this->db->from('refacciones_inventario');
		//Si existe el id de la sucursal de la salida por traspaso
		if($intSucursalSalidaID != NULL)
		{	
			$this->db->where('sucursal_id',  $intSucursalSalidaID);
		}
		else
		{
			$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
		}
		$this->db->where('anio', $strAnio);
		$this->db->where('refaccion_id', $intRefaccionID);
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	//Método para regresar todos los movimientos activos de una refacción excluyendo el movimiento proporcionado
	function buscar_movimientos_activos_refaccion($intRefaccionID, $strAnio, $intMovimientoRefaccionesID)
	{
		//Constante para identificar al tipo de movimiento salida de refacciones por venta (factura)
		$intMovSalidaVenta = SALIDA_REFACCIONES_VENTA;
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar fecha inicial del inventario
		$dteFechaInicial = $strAnio.'-01-01';
		//Asignar fecha final del inventario
		$dteFechaFinal = $strAnio.'-12-31';

		$strSQL = $this->db->query("SELECT MR.tipo_movimiento, MR.fecha, MR.fecha_creacion,  
										   MR.fecha_actualizacion, MRD.renglon, MRD.cantidad,  
										   MRD.costo_unitario
									FROM movimientos_refacciones AS MR 
									INNER JOIN movimientos_refacciones_detalles AS MRD ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
									WHERE MRD.refaccion_id = $intRefaccionID
									AND  MR.sucursal_id = $intSucursalID
									AND  DATE_FORMAT(MR.fecha, '%Y-%m-%d') >= '$dteFechaInicial'
									AND  DATE_FORMAT(MR.fecha, '%Y-%m-%d') <= '$dteFechaFinal'
									AND  MR.estatus <> 'INACTIVO'
									AND  MR.movimiento_refacciones_id <> $intMovimientoRefaccionesID
									UNION 
									SELECT  $intMovSalidaVenta AS tipo_movimiento, FR.fecha, 
										   FR.fecha_creacion, FR.fecha_actualizacion,  FRD.renglon, 
										   FRD.cantidad, FRD.costo_unitario
									FROM facturas_refacciones AS FR 
									INNER JOIN facturas_refacciones_detalles AS FRD ON FR.factura_refacciones_id = FRD.factura_refacciones_id
									WHERE FRD.refaccion_id = $intRefaccionID
									AND  FR.sucursal_id = $intSucursalID
									AND  DATE_FORMAT(FR.fecha, '%Y-%m-%d') >= '$dteFechaInicial'
									AND  DATE_FORMAT(FR.fecha, '%Y-%m-%d') <= '$dteFechaFinal'
									AND  FR.estatus <> 'INACTIVO'
									ORDER BY fecha, fecha_creacion, fecha_actualizacion");
		return $strSQL->result();

	}


	/*******************************************************************************************************************
	Funciones de la tabla solicitudes_traspasos_refacciones
	*********************************************************************************************************************/
	//Método para modificar el estatus de la solicitud de refacciones por traspaso
	public function set_estatus_solicitud_traspaso($intSolicitudTraspasoRefaccionesID, $strEstatus)
	{
		//Asignar datos al array
		$arrDatos = array('estatus' => $strEstatus,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('solicitud_traspaso_refacciones_id', $intSolicitudTraspasoRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    return $this->db->update('solicitudes_traspasos_refacciones', $arrDatos);
	}

	//Método para regresar el total de movimientos activos que coincidan con los criterios de búsqueda proporcionados
	public function buscar_total_movimientos_solicitud_traspaso($intTipoMovimiento, 
																$intSolicitudTraspasoRefaccionesID)
	{
		$this->db->select('COUNT(MR.movimiento_refacciones_id) AS total_movimientos');
		$this->db->from('movimientos_refacciones MR');
		$this->db->join('solicitudes_traspasos_refacciones AS STR', 
						'MR.referencia_id = STR.solicitud_traspaso_refacciones_id', 'inner');
		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
		$this->db->where('MR.referencia_id', $intSolicitudTraspasoRefaccionesID);
		$this->db->where('MR.estatus', 'ACTIVO');
		$this->db->limit(1);
		return $this->db->get()->row();
	}


	/*******************************************************************************************************************
	Funciones de la tabla solicitudes_traspasos_refacciones_internas
	*********************************************************************************************************************/
	//Método para modificar el estatus de la solicitud de refacciones internas por traspaso
	public function set_estatus_solicitud_traspaso_interno($intSolicitudTraspasoRefaccionesInternasID, 
														   $strEstatus)
	{
		//Asignar datos al array
		$arrDatos = array('estatus' => $strEstatus,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('solicitud_traspaso_refacciones_internas_id', $intSolicitudTraspasoRefaccionesInternasID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    return $this->db->update('solicitudes_traspasos_refacciones_internas', $arrDatos);
	}

	//Método para regresar el total de movimientos activos que coincidan con los criterios de búsqueda proporcionados
	public function buscar_total_movimientos_solicitud_traspaso_interno($intTipoMovimiento, 
																	   $intSolicitudTraspasoRefaccionesInternasID)
	{
		$this->db->select('COUNT(MR.movimiento_refacciones_id) AS total_movimientos');
		$this->db->from('movimientos_refacciones MR');
		$this->db->join('solicitudes_traspasos_refacciones_internas AS STR', 
						'MR.referencia_id = STR.solicitud_traspaso_refacciones_internas_id', 'inner');
		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
		$this->db->where('MR.referencia_id', $intSolicitudTraspasoRefaccionesInternasID);
		$this->db->where('MR.estatus', 'ACTIVO');
		$this->db->limit(1);
		return $this->db->get()->row();
	}


	/*******************************************************************************************************************
	Funciones de la tabla requisiciones_refacciones
	*********************************************************************************************************************/
	//Método para modificar el estatus de la requisición de refacciones
	public function set_estatus_requisicion_refacciones($intRequisicionRefaccionesID, $strEstatus)
	{
		//Asignar datos al array
		$arrDatos = array('estatus' => $strEstatus,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('requisicion_refacciones_id', $intRequisicionRefaccionesID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    return $this->db->update('requisiciones_refacciones', $arrDatos);
	}

	//Método para regresar el total de movimientos activos que coincidan con los criterios de búsqueda proporcionados
	public function buscar_total_movimientos_requisicion_refacciones($intTipoMovimiento, 
																	 $intRequisicionRefaccionesID)
	{
		$this->db->select('COUNT(MR.movimiento_refacciones_id) AS total_movimientos');
		$this->db->from('movimientos_refacciones MR');
		$this->db->join('requisiciones_refacciones AS RR', 
						'MR.referencia_id = RR.requisicion_refacciones_id', 'inner');
		$this->db->where('MR.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MR.tipo_movimiento', $intTipoMovimiento);
		$this->db->where('MR.referencia_id', $intRequisicionRefaccionesID);
		$this->db->where('MR.estatus', 'ACTIVO');
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	/*******************************************************************************************************************
	Funciones de la tabla back_order
	*********************************************************************************************************************/
	//Método para guardar los datos de un pedido pendiente de la requisición de refacciones
	public function guardar_pedido_pendiente($intRequisicionRefaccionesID, $intRenglon, $intCantidad, 
											 $strEstatus)
	{

		//Asignar datos al array
		$arrDatos = array('requisicion_refacciones_id' => $intRequisicionRefaccionesID, 
						  'renglon' => $intRenglon, 
						  'cantidad' => $intCantidad, 
						  'estatus' => $strEstatus,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('back_order', $arrDatos);
	}

	//Método para modificar los datos de un pedido pendiente de la requisición de refacciones
	public function modificar_pedido_pendiente($intBackOrderID, $intCantidad, $strEstatus)
	{
		//Asignar datos al array
		$arrDatos = array('cantidad' => $intCantidad, 
			              'estatus' => $strEstatus,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('back_order_id', $intBackOrderID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('back_order', $arrDatos);
	}

	//Método para eliminar los pedidos pendientes de una requisición de refacciones
	public function eliminar_pedidos_requisicion_refacciones($intRequisicionRefaccionesID)
	{
		//Eliminar datos de la tabla back_order
		$this->db->where('requisicion_refacciones_id', $intRequisicionRefaccionesID);
		return $this->db->delete('back_order');
	}


	/*******************************************************************************************************************
	Funciones de la tabla back_order_traspasos
	*********************************************************************************************************************/
	//Método para guardar los datos de un pedido pendiente de la solicitud de refacciones por traspaso
	public function guardar_pedido_pendiente_traspaso($intSolicitudTraspasoRefaccionesID, $intRenglon, $intCantidad, 
													  $strEstatus)
	{

		//Asignar datos al array
		$arrDatos = array('solicitud_traspaso_refacciones_id' => $intSolicitudTraspasoRefaccionesID, 
						  'renglon' => $intRenglon, 
						  'cantidad' => $intCantidad, 
						  'estatus' => $strEstatus,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('back_order_traspasos', $arrDatos);
	}

	//Método para modificar los datos de un pedido pendiente de la solicitud de refacciones por traspaso
	public function modificar_pedido_pendiente_traspaso($intBackOrderTraspasoID, $intCantidad, $strEstatus)
	{
		//Asignar datos al array
		$arrDatos = array('cantidad' => $intCantidad, 
			              'estatus' => $strEstatus,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('back_order_traspaso_id', $intBackOrderTraspasoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('back_order_traspasos', $arrDatos);
	}

	//Método para eliminar los pedidos pendientes de una solicitud de refacciones por traspaso
	public function eliminar_pedidos_solicitud_traspaso($intSolicitudTraspasoRefaccionesID)
	{
		//Eliminar datos de la tabla back_order_traspasos
		$this->db->where('solicitud_traspaso_refacciones_id', $intSolicitudTraspasoRefaccionesID);
		return $this->db->delete('back_order_traspasos');
	}

	/*******************************************************************************************************************
	Funciones de la tabla back_order_traspasos_internos
	*********************************************************************************************************************/
	//Método para guardar los datos de un pedido pendiente de la solicitud de refacciones internas por traspaso
	public function guardar_pedido_pendiente_traspaso_interno($intSolicitudTraspasoRefaccionesInternasID, 
															  $intRenglon, $intCantidad, $strEstatus)
	{

		//Asignar datos al array
		$arrDatos = array('solicitud_traspaso_refacciones_internas_id' => $intSolicitudTraspasoRefaccionesInternasID, 
						  'renglon' => $intRenglon, 
						  'cantidad' => $intCantidad, 
						  'estatus' => $strEstatus,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('back_order_traspasos_internos', $arrDatos);
	}

	//Método para modificar los datos de un pedido pendiente de la solicitud de refacciones internas por traspaso
	public function modificar_pedido_pendiente_traspaso_interno($intBackOrderTraspasoInternoID, $intCantidad, 
															    $strEstatus)
	{
		//Asignar datos al array
		$arrDatos = array('cantidad' => $intCantidad, 
			              'estatus' => $strEstatus,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('back_order_traspaso_interno_id', $intBackOrderTraspasoInternoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('back_order_traspasos_internos', $arrDatos);
	}

	//Método para eliminar los pedidos pendientes de una solicitud de refacciones internas por traspaso
	public function eliminar_pedidos_solicitud_traspaso_interno($intSolicitudTraspasoRefaccionesInternasID)
	{
		//Eliminar datos de la tabla back_order_traspasos_internos
		$this->db->where('solicitud_traspaso_refacciones_internas_id', $intSolicitudTraspasoRefaccionesInternasID);
		return $this->db->delete('back_order_traspasos_internos');
	}
}
?>