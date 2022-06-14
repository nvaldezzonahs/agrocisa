<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');

class Trabajos_foraneos_internos_model extends CI_model {

	/*******************************************************************************************************************
	Funciones de la tabla trabajos_foraneos_internos
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objTrabajoForaneo)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objTrabajoForaneo->strFolio); 

		//Tabla trabajos_foraneos_internos
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objTrabajoForaneo->intSucursalID,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objTrabajoForaneo->dteFecha, 
						  'moneda_id' => $objTrabajoForaneo->intMonedaID, 
						  'tipo_cambio' => $objTrabajoForaneo->intTipoCambio,
						  'factura' => $objTrabajoForaneo->strFactura,  
						  'orden_compra_id' => $objTrabajoForaneo->intOrdenCompraID, 
						  'regimen_fiscal_id' => $objTrabajoForaneo->intRegimenFiscalID,
						  'porcentaje_retencion_id' => $objTrabajoForaneo->intPorcentajeRetencionID,
						  'importe_retenido' => $objTrabajoForaneo->intImporteRetenido,
						  'orden_reparacion_interna_id' => $objTrabajoForaneo->intOrdenReparacionInternaID, 
						  'observaciones' => $objTrabajoForaneo->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objTrabajoForaneo->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('trabajos_foraneos_internos', $arrDatos);

	    //Agregar id del nuevo registro al objeto
		$objTrabajoForaneo->intTrabajoForaneoInternoID = $this->db->insert_id();

	    //Hacer un llamado al método para guardar los detalles del trabajo foráneo
		$this->guardar_detalles($objTrabajoForaneo);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objTrabajoForaneo->intTrabajoForaneoInternoID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objTrabajoForaneo)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla trabajos_foraneos_internos
		//Asignar datos al array
		$arrDatos = array('fecha' => $objTrabajoForaneo->dteFecha, 
						  'moneda_id' => $objTrabajoForaneo->intMonedaID, 
						  'tipo_cambio' => $objTrabajoForaneo->intTipoCambio,
						  'factura' => $objTrabajoForaneo->strFactura,  
						  'orden_compra_id' => $objTrabajoForaneo->intOrdenCompraID,
						  'regimen_fiscal_id' => $objTrabajoForaneo->intRegimenFiscalID,
						  'porcentaje_retencion_id' => $objTrabajoForaneo->intPorcentajeRetencionID,
						  'importe_retenido' => $objTrabajoForaneo->intImporteRetenido, 
						  'orden_reparacion_interna_id' => $objTrabajoForaneo->intOrdenReparacionInternaID, 
						  'observaciones' => $objTrabajoForaneo->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objTrabajoForaneo->intUsuarioID);
		$this->db->where('trabajo_foraneo_interno_id', $objTrabajoForaneo->intTrabajoForaneoInternoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('trabajos_foraneos_internos', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('trabajo_foraneo_interno_id', $objTrabajoForaneo->intTrabajoForaneoInternoID);
		$this->db->delete('trabajos_foraneos_internos_detalles');

		//Hacer un llamado al método para guardar los detalles del trabajo foráneo
		$this->guardar_detalles($objTrabajoForaneo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intTrabajoForaneoInternoID,  $intPolizaID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Se crea una instancia de la clase modelo (pólizas) 
        $otdModelPolizas = new Polizas_model();

		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('trabajo_foraneo_interno_id', $intTrabajoForaneoInternoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('trabajos_foraneos_internos', $arrDatos);

		//Hacer un llamado al método para modificar el estatus de la póliza 
		$otdModelPolizas->set_estatus($intPolizaID, 'INACTIVO');

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intTrabajoForaneoInternoID = NULL, $dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL,  $intProveedorID = NULL, $strEstatus = NULL, 
						   $strBusqueda =  NULL)
	{
		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('CONTROL DE VEHICULOS');
		$strProcesoPoliza = $this->db->escape('TRABAJO FORANEO');

		$this->db->select("TFI.trabajo_foraneo_interno_id, TFI.folio,
						   DATE_FORMAT(TFI.fecha,'%d/%m/%Y') AS fecha, TFI.orden_reparacion_interna_id,
						   TFI.moneda_id, TFI.tipo_cambio, TFI.orden_compra_id,
						   TFI.regimen_fiscal_id, TFI.porcentaje_retencion_id, TFI.importe_retenido,
						   TFI.factura, TFI.observaciones, TFI.estatus,
						   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, P.rfc,
						   P.telefono_principal, P.calle, P.numero_exterior, P.numero_interior, P.colonia,
						   CP.codigo_postal, P.localidad, MP.descripcion AS municipio, 
						   EP.descripcion AS estado, OC.folio AS folio_orden_compra, 
						   M.codigo AS codigo_moneda,
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   ORI.folio AS folio_orden_reparacion, ORI.serie, ORI.motor, ORI.vehiculo_id,
						   CASE 
							   WHEN  ORI.vehiculo_id > 0 
							   		THEN CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas)
								    ELSE '' 
						   END AS vehiculo, 
						   PIsr.porcentaje AS porcentaje_isr,
						   UC.usuario AS usuario_creacion, 
						   DATE_FORMAT(TFI.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion,
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   PF.folio AS folio_poliza", FALSE);
		$this->db->from('trabajos_foraneos_internos AS TFI');
		$this->db->join('sat_monedas AS M', 'TFI.moneda_id = M.moneda_id', 'inner');
		$this->db->join('ordenes_compra AS OC', 'TFI.orden_compra_id = OC.orden_compra_id', 'inner');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('ordenes_reparacion_internas AS ORI',
						'TFI.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id', 'inner');
		$this->db->join('vehiculos AS V', 'ORI.vehiculo_id = V.vehiculo_id', 'left');
		$this->db->join('usuarios AS UC', 'TFI.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND TFI.trabajo_foraneo_interno_id = PF.referencia_id', 'left');
		$this->db->join('porcentaje_retencion_isr AS PIsr', 'TFI.porcentaje_retencion_id = PIsr.porcentaje_retencion_id', 'left');
		
		//Si existe id del trabajo foráneo interno
		if ($intTrabajoForaneoInternoID !== NULL)
		{   
			$this->db->where('trabajo_foraneo_interno_id', $intTrabajoForaneoInternoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('TFI.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del proveedor
		    if($intProveedorID > 0)
		    {
		   		$this->db->where('OC.proveedor_id', $intProveedorID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(TFI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		   //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(TFI.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('TFI.estatus', $strEstatus);
				}
			}

		    $this->db->where("((TFI.folio LIKE '%$strBusqueda%') OR
		    				   (OC.folio LIKE '%$strBusqueda%') OR
							   (ORI.folio LIKE '%$strBusqueda%') OR
        				       (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		    $this->db->order_by('TFI.fecha DESC, TFI.folio DESC');
		    return $this->db->get()->result();
		}

	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   					 $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('trabajos_foraneos_internos AS TFI');
		$this->db->join('sat_monedas AS M', 'TFI.moneda_id = M.moneda_id', 'inner');
		$this->db->join('ordenes_compra AS OC', 'TFI.orden_compra_id = OC.orden_compra_id', 'inner');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('ordenes_reparacion_internas AS ORI',
						'TFI.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id', 'inner');
		$this->db->where('TFI.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del proveedor
	    if($intProveedorID > 0)
	    {
	   		$this->db->where('OC.proveedor_id', $intProveedorID);
	    }
		
		//Si existe rango de fechas
		if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(TFI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('TFI.estatus', $strEstatus);
		}

	    $this->db->where("((TFI.folio LIKE '%$strBusqueda%') OR
	    				   (OC.folio LIKE '%$strBusqueda%') OR
						   (ORI.folio LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL, 
					       $intNumRows, $intPos)
	{
		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('CONTROL DE VEHICULOS');
		$strProcesoPoliza = $this->db->escape('TRABAJO FORANEO');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('TFI.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('OC.proveedor_id', $intProveedorID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(TFI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(TFI.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('TFI.estatus', $strEstatus);
			}
		}

		$this->db->where("((TFI.folio LIKE '%$strBusqueda%') OR
						   (OC.folio LIKE '%$strBusqueda%') OR
						   (ORI.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->from('trabajos_foraneos_internos AS TFI');
		$this->db->join('sat_monedas AS M', 'TFI.moneda_id = M.moneda_id', 'inner');
		$this->db->join('ordenes_compra AS OC', 'TFI.orden_compra_id = OC.orden_compra_id', 'inner');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('ordenes_reparacion_internas AS ORI', 'TFI.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id', 'inner');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND TFI.trabajo_foraneo_interno_id = PF.referencia_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("TFI.trabajo_foraneo_interno_id, TFI.folio, TFI.estatus,
						   DATE_FORMAT(TFI.fecha,'%d/%m/%Y') AS fecha,
						   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, P.proveedor_id,
						   OC.folio AS folio_orden_compra, 
						   ORI.folio AS folio_orden_reparacion, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   PF.folio AS folio_poliza", FALSE);
		$this->db->from('trabajos_foraneos_internos AS TFI');
		$this->db->join('sat_monedas AS M', 'TFI.moneda_id = M.moneda_id', 'inner');
		$this->db->join('ordenes_compra AS OC', 'TFI.orden_compra_id = OC.orden_compra_id', 'inner');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('ordenes_reparacion_internas AS ORI', 
						'TFI.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id', 'inner');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND TFI.trabajo_foraneo_interno_id = PF.referencia_id', 'left');
		
		$this->db->where('TFI.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('OC.proveedor_id', $intProveedorID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(TFI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  
	    
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(TFI.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('TFI.estatus', $strEstatus);
			}
		}
		
		$this->db->where("((TFI.folio LIKE '%$strBusqueda%') OR
						   (OC.folio LIKE '%$strBusqueda%') OR
						   (ORI.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))");

		$this->db->order_by('TFI.fecha DESC, TFI.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["trabajos"] =$this->db->get()->result();
		return $arrResultado;
	}

	/*******************************************************************************************************************
	Funciones de la tabla trabajos_foraneos_internos_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles del trabajo foráneo
	public function guardar_detalles(stdClass $objTrabajoForaneo)

	{
		/*Quitar | de la lista para obtener el concepto, ID del producto, ID de la unidad, cantidad,
		  precio unitario, descuento unitario, iva unitario e ieps unitario
		*/
		$arrConceptos = explode("|", $objTrabajoForaneo->strConceptos);
		$arrCantidades = explode("|", $objTrabajoForaneo->strCantidades);
		$arrCostosUnitarios = explode("|", $objTrabajoForaneo->strCostosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objTrabajoForaneo->strDescuentosUnitarios);
		$arrTasaCuotaIva = explode("|", $objTrabajoForaneo->strTasaCuotaIva);
		$arrIvasUnitarios = explode("|", $objTrabajoForaneo->strIvasUnitarios);
		$arrTasaCuotaIeps = explode("|", $objTrabajoForaneo->strTasaCuotaIeps);
		$arrIepsUnitarios = explode("|", $objTrabajoForaneo->strIepsUnitarios);

		//Hacer recorrido para insertar los datos en la tabla trabajos_foraneos_internos_detalles
		for ($intCon = 0; $intCon < sizeof($arrConceptos); $intCon++) 
		{
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);
			
			//Asignar datos al array
			$arrDatos = array('trabajo_foraneo_interno_id' => $objTrabajoForaneo->intTrabajoForaneoInternoID,
							  'renglon' => ($intCon + 1),
							  'concepto' => $arrConceptos[$intCon], 
							  'cantidad' => $arrCantidades[$intCon],
							  'costo_unitario' => $arrCostosUnitarios[$intCon],
							  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva_unitario' => $arrIvasUnitarios[$intCon], 
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps_unitario' => $arrIepsUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('trabajos_foraneos_internos_detalles', $arrDatos);
		}
	}
	
	//Método para regresar los detalles de un registro
	public function buscar_detalles($intTrabajoForaneoInternoID = NULL, $intOrdenReparacionInternaID = NULL)
	{

		$this->db->select("TFI.trabajo_foraneo_interno_id, TFI.folio, 
						   DATE_FORMAT(TFI.fecha,'%d/%m/%Y') AS fecha, 
						   TFI.moneda_id, TFI.tipo_cambio, 
						   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor,
						   TFID.renglon, TFID.concepto, TFID.cantidad, 
						   TFID.costo_unitario, TFID.descuento_unitario, TFID.tasa_cuota_iva,  
						   TFID.iva_unitario, TFID.tasa_cuota_ieps, TFID.ieps_unitario, 
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps, 
						   TIeps.valor_minimo AS  valor_minimo_ieps, TIeps.tipo AS tipo_ieps, 
						   TIeps.factor AS factor_ieps,
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda", FALSE);
		$this->db->from('trabajos_foraneos_internos AS TFI');
		$this->db->join('sat_monedas AS M', 'TFI.moneda_id = M.moneda_id', 'inner');
		$this->db->join('ordenes_compra AS OC', 'TFI.orden_compra_id = OC.orden_compra_id', 'inner');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('trabajos_foraneos_internos_detalles AS TFID', 'TFI.trabajo_foraneo_interno_id = TFID.trabajo_foraneo_interno_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'TFID.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'TFID.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		//Si existe id del trabajo foráneo interno
		if($intTrabajoForaneoInternoID !== NULL)
		{
			$this->db->where('TFID.trabajo_foraneo_interno_id', $intTrabajoForaneoInternoID);
			
		}
		else
		{
			$this->db->where('TFI.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('TFI.orden_reparacion_interna_id', $intOrdenReparacionInternaID);
			$this->db->where('TFI.estatus', 'ACTIVO');
			
		}

		$this->db->order_by('TFI.folio DESC','TFID.renglon');
		return $this->db->get()->result();
	}


	//Método para regresar las tasas de ieps de los detalles de un registro
	public function buscar_tasas_ieps_detalles($intTrabajoForaneoInternoID)
	{
		$this->db->select("DISTINCT TFID.tasa_cuota_ieps, TIeps.valor_maximo AS porcentaje_ieps", FALSE);
		$this->db->from('trabajos_foraneos_internos_detalles AS TFID');
		$this->db->join('sat_tasa_cuota AS TIeps', 'TFID.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'inner');
		$this->db->where('TFID.trabajo_foraneo_interno_id', $intTrabajoForaneoInternoID);
		$this->db->where('TFID.ieps_unitario > 0');
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_detalles($intOrdenReparacionInternaID, $intNumRows, $intPos)
	{
		//Seleccionar los registros sin límite que coincidan con los criterios de búsqueda
	    $this->db->select('TFID.cantidad, TFID.costo_unitario, TFID.descuento_unitario,  
	    				   TFID.tasa_cuota_iva, TFID.iva_unitario,
	    				   TFID.tasa_cuota_ieps, TFID.ieps_unitario, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps, 
						   TIeps.tipo AS tipo_ieps, TIeps.factor AS factor_ieps, TFI.estatus');
		$this->db->from('trabajos_foraneos_internos_detalles AS TFID');
		$this->db->join('trabajos_foraneos_internos AS TFI', 
						'TFID.trabajo_foraneo_interno_id = TFI.trabajo_foraneo_interno_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'TFID.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'TFID.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('TFI.orden_reparacion_interna_id', $intOrdenReparacionInternaID);
		$arrResultado["registros"] =$this->db->get()->result();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("TFI.trabajo_foraneo_interno_id, TFI.folio, 
						   DATE_FORMAT(TFI.fecha,'%d/%m/%Y') AS fecha, 
						   TFI.estatus, TFID.concepto, 
						   TFID.cantidad, TFID.costo_unitario, TFID.descuento_unitario,
						   TFID.tasa_cuota_iva, TFID.iva_unitario,
	    				   TFID.tasa_cuota_ieps, TFID.ieps_unitario, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps, 
						   TIeps.tipo AS tipo_ieps, TIeps.factor AS factor_ieps, TFI.estatus", FALSE);
		$this->db->from('trabajos_foraneos_internos_detalles AS TFID');
		$this->db->join('trabajos_foraneos_internos AS TFI', 
						'TFID.trabajo_foraneo_interno_id = TFI.trabajo_foraneo_interno_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'TFID.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'TFID.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
	    $this->db->where('TFI.orden_reparacion_interna_id', $intOrdenReparacionInternaID);
		$this->db->order_by('TFI.folio DESC','TFID.renglon');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["detalles"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>