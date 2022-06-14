<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');

class Trabajos_foraneos_model extends CI_model {

	/*******************************************************************************************************************
	Funciones de la tabla trabajos_foraneos
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

		//Tabla trabajos_foraneos
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
						  'orden_reparacion_id' => $objTrabajoForaneo->intOrdenReparacionID, 
						  'observaciones' => $objTrabajoForaneo->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objTrabajoForaneo->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('trabajos_foraneos_02', $arrDatos);

	    //Agregar id del nuevo registro al objeto
		$objTrabajoForaneo->intTrabajoForaneoID = $this->db->insert_id();

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
		return $this->db->trans_status().'_'.$objTrabajoForaneo->intTrabajoForaneoID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objTrabajoForaneo)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla trabajos_foraneos
		//Asignar datos al array
		$arrDatos = array('fecha' => $objTrabajoForaneo->dteFecha, 
						  'moneda_id' => $objTrabajoForaneo->intMonedaID, 
						  'tipo_cambio' => $objTrabajoForaneo->intTipoCambio,
						  'factura' => $objTrabajoForaneo->strFactura,  
						  'orden_compra_id' => $objTrabajoForaneo->intOrdenCompraID, 
						  'regimen_fiscal_id' => $objTrabajoForaneo->intRegimenFiscalID,
						  'porcentaje_retencion_id' => $objTrabajoForaneo->intPorcentajeRetencionID,
						  'importe_retenido' => $objTrabajoForaneo->intImporteRetenido,
						  'orden_reparacion_id' => $objTrabajoForaneo->intOrdenReparacionID, 
						  'observaciones' => $objTrabajoForaneo->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objTrabajoForaneo->intUsuarioID);
		$this->db->where('trabajo_foraneo_id', $objTrabajoForaneo->intTrabajoForaneoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('trabajos_foraneos_02', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('trabajo_foraneo_id', $objTrabajoForaneo->intTrabajoForaneoID);
		$this->db->delete('trabajos_foraneos_detalles');

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
	public function set_estatus($intTrabajoForaneoID, $intPolizaID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Se crea una instancia de la clase modelo (pólizas) 
        $otdModelPolizas = new Polizas_model();

		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('trabajo_foraneo_id', $intTrabajoForaneoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('trabajos_foraneos_02', $arrDatos);

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
	public function buscar($intTrabajoForaneoID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strProcesoPoliza = $this->db->escape('TRABAJO FORANEO');

		$this->db->select("TF.trabajo_foraneo_id, TF.folio,
						   DATE_FORMAT(TF.fecha,'%d/%m/%Y') AS fecha, TF.orden_reparacion_id,
						   TF.moneda_id, TF.tipo_cambio, TF.orden_compra_id,
						   TF.regimen_fiscal_id, TF.porcentaje_retencion_id, 
						   TF.importe_retenido, TF.factura, TF.observaciones, TF.estatus,
						   M.codigo AS codigo_moneda,
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   OR.folio AS folio_orden_reparacion,
						   CONCAT_WS(' - ', PP.codigo, PP.nombre_comercial) AS prospecto,
						   PP.codigo AS CodigoProspecto,
						   IFNULL(C.razon_social, PP.nombre_comercial) AS razon_social, 
						   CASE 
							   WHEN  OC.orden_compra_id > 0 
							   		THEN  OC.folio
								    ELSE OCS.folio
						   END AS folio_orden_compra,
						   CASE 
							   WHEN  OC.orden_compra_id > 0 
							   		THEN  CONCAT_WS(' - ', P.codigo, P.razon_social) 
								    ELSE CONCAT_WS(' - ', PS.codigo, PS.razon_social)
						   END AS proveedor,
						   CASE 
							   WHEN  OC.orden_compra_id > 0 
							   		THEN  P.rfc
								    ELSE PS.rfc
						   END AS rfc,
						   CASE 
							   WHEN  OC.orden_compra_id > 0 
							   		THEN  P.telefono_principal
								    ELSE PS.telefono_principal
						   END AS telefono_principal,
						   CASE 
							   WHEN  OC.orden_compra_id > 0 
							   		THEN  P.calle
								    ELSE PS.calle
						   END AS calle,
						   CASE 
							   WHEN  OC.orden_compra_id > 0 
							   		THEN  P.numero_exterior
								    ELSE PS.numero_exterior
						   END AS numero_exterior,
						   CASE 
							   WHEN  OC.orden_compra_id > 0 
							   		THEN  P.numero_interior
								    ELSE PS.numero_interior
						   END AS numero_interior,
						   CASE 
							   WHEN  OC.orden_compra_id > 0 
							   		THEN  P.colonia
								    ELSE PS.colonia
						   END AS colonia,
						   CASE 
							   WHEN  OC.orden_compra_id > 0 
							   		THEN  CP.codigo_postal
								    ELSE CPS.codigo_postal
						   END AS codigo_postal,
						   CASE 
							   WHEN  OC.orden_compra_id > 0 
							   		THEN  P.localidad
								    ELSE PS.localidad
						   END AS localidad,
						   CASE 
							   WHEN  OC.orden_compra_id > 0 
							   		THEN  MP.descripcion
								    ELSE MPS.descripcion
						   END AS municipio,
						   CASE 
							   WHEN  OC.orden_compra_id > 0 
							   		THEN  EP.descripcion
								    ELSE EPS.descripcion
						   END AS estado,
						   PIsr.porcentaje AS porcentaje_isr, 
						   UC.usuario AS usuario_creacion, 
						   DATE_FORMAT(TF.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion, 
						   	IFNULL(PF.poliza_id, 0) AS poliza_id, 
						    PF.folio AS folio_poliza ", FALSE);
		$this->db->from('trabajos_foraneos_02 AS TF');
		$this->db->join('sat_monedas AS M', 'TF.moneda_id = M.moneda_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'TF.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
		$this->db->join('prospectos AS PP', 'OR.prospecto_id = PP.prospecto_id', 'inner');
		$this->db->join('ordenes_compra AS OC', 'TF.orden_compra_id = OC.orden_compra_id AND
						 TF.tipo_referencia = "GENERAL"', 'left');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'left');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'left');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'left');
		$this->db->join('ordenes_compra_servicio AS OCS', 'TF.orden_compra_id = OCS.orden_compra_servicio_id AND
						 TF.tipo_referencia = "SERVICIO"', 'left');
		$this->db->join('proveedores AS PS', 'OCS.proveedor_id = PS.proveedor_id', 'left');
		$this->db->join('sat_codigos_postales AS CPS', 'PS.codigo_postal_id = CPS.codigo_postal_id', 'left');
		$this->db->join('municipios AS MPS', 'PS.municipio_id = MPS.municipio_id', 'left');
		$this->db->join('sat_estados AS EPS', 'MPS.estado_id = EPS.estado_id', 'left');
		$this->db->join('clientes AS C', 'PP.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('usuarios AS UC', 'TF.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'TF.trabajo_foraneo_id = PF.referencia_id
	    							      AND PF.proceso = '.$strProcesoPoliza.' 
	    							      AND PF.modulo = "SERVICIO"', 'left');
		$this->db->join('porcentaje_retencion_isr AS PIsr', 'TF.porcentaje_retencion_id = PIsr.porcentaje_retencion_id', 'left');

		//Si existe id del trabajo foráneo
		if ($intTrabajoForaneoID !== NULL)
		{   
			$this->db->where('trabajo_foraneo_id', $intTrabajoForaneoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('TF.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del proveedor
		    if($intProveedorID > 0)
		    {
		   		$this->db->where("(OC.proveedor_id = $intProveedorID OR 
	   		  				   	   OCS.proveedor_id = $intProveedorID)");
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(TF.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(TF.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('TF.estatus', $strEstatus);
				}
			}

		    $this->db->where("((TF.folio LIKE '%$strBusqueda%') OR
							   (OC.folio LIKE '%$strBusqueda%') OR
							   (OR.folio LIKE '%$strBusqueda%') OR
	        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
				               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR 
				           	   (CONCAT_WS(' - ', PS.codigo, PS.razon_social) LIKE '%$strBusqueda%') OR
				               (CONCAT_WS(' ', PS.codigo, PS.razon_social) LIKE '%$strBusqueda%'))");

		    $this->db->order_by('TF.fecha DESC, TF.folio DESC');
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
		$this->db->from('trabajos_foraneos_02 AS TF');
		$this->db->join('sat_monedas AS M', 'TF.moneda_id = M.moneda_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'TF.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
		$this->db->join('prospectos AS PP', 'OR.prospecto_id = PP.prospecto_id', 'inner');
		$this->db->join('ordenes_compra AS OC', 'TF.orden_compra_id = OC.orden_compra_id AND
						 TF.tipo_referencia = "GENERAL"', 'left');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'left');
		$this->db->join('ordenes_compra_servicio AS OCS', 'TF.orden_compra_id = OCS.orden_compra_servicio_id AND
						 TF.tipo_referencia = "SERVICIO"', 'left');
		$this->db->join('proveedores AS PS', 'OCS.proveedor_id = PS.proveedor_id', 'left');
		$this->db->where('TF.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del proveedor
	    if($intProveedorID > 0)
	    {
	   		$this->db->where("(OC.proveedor_id = $intProveedorID OR 
	   		  				   OCS.proveedor_id = $intProveedorID)");
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(TF.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('TF.estatus', $strEstatus);
		}

	    $this->db->where("((TF.folio LIKE '%$strBusqueda%') OR
						   (OC.folio LIKE '%$strBusqueda%') OR
						   (OR.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR 
			           	   (CONCAT_WS(' - ', PS.codigo, PS.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', PS.codigo, PS.razon_social) LIKE '%$strBusqueda%'))");

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
		$strProcesoPoliza = $this->db->escape('TRABAJO FORANEO');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('TF.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where("(OC.proveedor_id = $intProveedorID OR 
	   		  				   OCS.proveedor_id = $intProveedorID)");
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(TF.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(TF.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('TF.estatus', $strEstatus);
			}
		}

		$this->db->where("((TF.folio LIKE '%$strBusqueda%') OR
						   (OC.folio LIKE '%$strBusqueda%') OR
						   (OR.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR 
			           	   (CONCAT_WS(' - ', PS.codigo, PS.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', PS.codigo, PS.razon_social) LIKE '%$strBusqueda%'))");

		$this->db->from('trabajos_foraneos_02 AS TF');
		$this->db->join('sat_monedas AS M', 'TF.moneda_id = M.moneda_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'TF.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
		$this->db->join('prospectos AS PP', 'OR.prospecto_id = PP.prospecto_id', 'inner');
		$this->db->join('ordenes_compra AS OC', 'TF.orden_compra_id = OC.orden_compra_id AND
						 TF.tipo_referencia = "GENERAL"', 'left');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'left');
		$this->db->join('ordenes_compra_servicio AS OCS', 'TF.orden_compra_id = OCS.orden_compra_servicio_id AND
						 TF.tipo_referencia = "SERVICIO"', 'left');
		$this->db->join('proveedores AS PS', 'OCS.proveedor_id = PS.proveedor_id', 'left');
		$this->db->join('polizas AS PF', 'TF.trabajo_foraneo_id = PF.referencia_id
	    							      AND PF.proceso = '.$strProcesoPoliza.' 
	    							      AND PF.modulo = "SERVICIO"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("TF.trabajo_foraneo_id, TF.folio, TF.estatus,
						   DATE_FORMAT(TF.fecha,'%d/%m/%Y') AS fecha,
						   CASE 
							   WHEN  OC.orden_compra_id > 0 
							   		THEN  OC.folio
								    ELSE OCS.folio
						   END AS folio_orden_compra,
						   CASE 
							   WHEN  OC.orden_compra_id > 0 
							   		THEN  CONCAT_WS(' - ', P.codigo, P.razon_social) 
								    ELSE CONCAT_WS(' - ', PS.codigo, PS.razon_social)
						   END AS proveedor, 
						   OR.folio AS folio_orden_reparacion, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza", FALSE);
		$this->db->from('trabajos_foraneos_02 AS TF');
		$this->db->join('sat_monedas AS M', 'TF.moneda_id = M.moneda_id', 'inner');
		$this->db->join('ordenes_reparacion AS OR', 'TF.orden_reparacion_id = OR.orden_reparacion_id', 'inner');
		$this->db->join('prospectos AS PP', 'OR.prospecto_id = PP.prospecto_id', 'inner');
		$this->db->join('ordenes_compra AS OC', 'TF.orden_compra_id = OC.orden_compra_id AND
						 TF.tipo_referencia = "GENERAL"', 'left');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'left');
		$this->db->join('ordenes_compra_servicio AS OCS', 'TF.orden_compra_id = OCS.orden_compra_servicio_id AND
						 TF.tipo_referencia = "SERVICIO"', 'left');
		$this->db->join('proveedores AS PS', 'OCS.proveedor_id = PS.proveedor_id', 'left');
		$this->db->join('polizas AS PF', 'TF.trabajo_foraneo_id = PF.referencia_id
	    							      AND PF.proceso = '.$strProcesoPoliza.' 
	    							      AND PF.modulo = "SERVICIO"', 'left');
		$this->db->where('TF.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where("(OC.proveedor_id = $intProveedorID OR 
	   		  				   OCS.proveedor_id = $intProveedorID)");
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(TF.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  
	    
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(TF.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('TF.estatus', $strEstatus);
			}
		}

		$this->db->where("((TF.folio LIKE '%$strBusqueda%') OR
						   (OC.folio LIKE '%$strBusqueda%') OR
						   (OR.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR 
			           	   (CONCAT_WS(' - ', PS.codigo, PS.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', PS.codigo, PS.razon_social) LIKE '%$strBusqueda%'))");

		$this->db->order_by('TF.fecha DESC, TF.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["trabajos"] =$this->db->get()->result();
		return $arrResultado;
	}

	/*******************************************************************************************************************
	Funciones de la tabla trabajos_foraneos_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles del trabajo foráneo
	public function guardar_detalles(stdClass $objTrabajoForaneo)

	{
		/*Quitar | de la lista para obtener el concepto, ID del producto, ID de la unidad, cantidad,
		  precio unitario, descuento unitario, iva unitario e ieps unitario
		*/
		$arrConceptos = explode("|", $objTrabajoForaneo->strConceptos);
		$arrProductoServicioID = explode("|", $objTrabajoForaneo->strProductoServicioID);
		$arrUnidadID = explode("|", $objTrabajoForaneo->strUnidadID);
		$arrObjetoImpuestoID = explode("|", $objTrabajoForaneo->strObjetoImpuestoID);
		$arrCantidades = explode("|", $objTrabajoForaneo->strCantidades);
		$arrCostosUnitarios = explode("|", $objTrabajoForaneo->strCostosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objTrabajoForaneo->strDescuentosUnitarios);
		$arrTasaCuotaIva = explode("|", $objTrabajoForaneo->strTasaCuotaIva);
		$arrIvasUnitarios = explode("|", $objTrabajoForaneo->strIvasUnitarios);
		$arrTasaCuotaIeps = explode("|", $objTrabajoForaneo->strTasaCuotaIeps);
		$arrIepsUnitarios = explode("|", $objTrabajoForaneo->strIepsUnitarios);
		$arrPreciosUnitarios = explode("|", $objTrabajoForaneo->strPreciosUnitarios);

		//Hacer recorrido para insertar los datos en la tabla trabajos_foraneos_detalles
		for ($intCon = 0; $intCon < sizeof($arrConceptos); $intCon++) 
		{
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);
			

			//Asignar datos al array
			$arrDatos = array('trabajo_foraneo_id' => $objTrabajoForaneo->intTrabajoForaneoID,
							  'renglon' => ($intCon + 1),
							  'concepto' => $arrConceptos[$intCon], 
							  'producto_servicio_id' => $arrProductoServicioID[$intCon], 
							  'unidad_id' => $arrUnidadID[$intCon], 
							  'objeto_impuesto_id' => $arrObjetoImpuestoID[$intCon], 
							  'cantidad' => $arrCantidades[$intCon],
							  'costo_unitario' => $arrCostosUnitarios[$intCon],
							  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva_unitario' => $arrIvasUnitarios[$intCon], 
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps_unitario' => $arrIepsUnitarios[$intCon],
							  'precio_unitario' => $arrPreciosUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('trabajos_foraneos_detalles', $arrDatos);
		}
	}
	
	//Método para regresar los detalles de un registro
	public function buscar_detalles($intTrabajoForaneoID = NULL, $intOrdenReparacionID = NULL, 
								    $strOpcion = NULL)
	{

		$this->db->select("TF.trabajo_foraneo_id, TF.folio, DATE_FORMAT(TF.fecha,'%d/%m/%Y') AS fecha, 
						   TF.moneda_id, TF.tipo_cambio, 
						   CASE 
							   WHEN  OC.orden_compra_id > 0 
							   		THEN  CONCAT_WS(' - ', P.codigo, P.razon_social) 
								    ELSE CONCAT_WS(' - ', POCS.codigo, POCS.razon_social)
						   END AS proveedor,
						   TFD.renglon, TFD.concepto, TFD.producto_servicio_id, TFD.unidad_id,
						   TFD.objeto_impuesto_id, TFD.cantidad, 
						   TFD.costo_unitario, TFD.descuento_unitario, TFD.tasa_cuota_iva,  
						   TFD.iva_unitario, TFD.tasa_cuota_ieps, TFD.ieps_unitario, TFD.precio_unitario, 
						   CONCAT_WS(' - ', PS.codigo, PS.descripcion) AS producto_servicio,
						   PS.codigo AS codigo_sat,
						   CONCAT_WS(' - ', U.codigo, U.nombre) AS unidad,
						   U.codigo AS unidad_sat,
						   CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto,
						   OImp.codigo AS objeto_impuesto_sat,
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps, 
						   TIeps.valor_minimo AS  valor_minimo_ieps, TIeps.tipo AS tipo_ieps, 
						   TIeps.factor AS factor_ieps,
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda", FALSE);
		$this->db->from('trabajos_foraneos_02 AS TF');
		$this->db->join('sat_monedas AS M', 'TF.moneda_id = M.moneda_id', 'inner');
		$this->db->join('trabajos_foraneos_detalles AS TFD', 'TF.trabajo_foraneo_id = TFD.trabajo_foraneo_id', 'inner');
		$this->db->join('sat_productos_servicios AS PS', 'TFD.producto_servicio_id = PS.producto_servicio_id', 'inner');
		$this->db->join('sat_unidades AS U', 'TFD.unidad_id = U.unidad_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'TFD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'TFD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('sat_objeto_impuesto AS OImp', 'TFD.objeto_impuesto_id = OImp.objeto_impuesto_id', 'left');
		$this->db->join('ordenes_compra AS OC', 'TF.orden_compra_id = OC.orden_compra_id AND
						 TF.tipo_referencia = "GENERAL"', 'left');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'left');
		$this->db->join('ordenes_compra_servicio AS OCS', 'TF.orden_compra_id = OCS.orden_compra_servicio_id AND
						 TF.tipo_referencia = "SERVICIO"', 'left');
		$this->db->join('proveedores AS POCS', 'OCS.proveedor_id = POCS.proveedor_id', 'left');

		
		//Si existe id del trabajo foráneo
		if($intTrabajoForaneoID !== NULL)
		{
			$this->db->where('TFD.trabajo_foraneo_id', $intTrabajoForaneoID);
			
		}
		else
		{	
			//Si los datos no se van a mostrar en los reportes: detallado de ordenes de reparación
			if($strOpcion != 'reporte')
			{
				$this->db->where('TF.sucursal_id', $this->session->userdata('sucursal_id'));
			}
			
			$this->db->where('TF.orden_reparacion_id', $intOrdenReparacionID);
			$this->db->where('TF.estatus', 'ACTIVO');
		}
		
		$this->db->order_by('TF.folio DESC','TFD.renglon');
		return $this->db->get()->result();
	}


	//Método para regresar las tasas de ieps de los detalles de un registro
	public function buscar_tasas_ieps_detalles($intTrabajoForaneoID)
	{
		$this->db->select("DISTINCT TFD.tasa_cuota_ieps, TIeps.valor_maximo AS porcentaje_ieps", FALSE);
		$this->db->from('trabajos_foraneos_detalles AS TFD');
		$this->db->join('sat_tasa_cuota AS TIeps', 'TFD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'inner');
		$this->db->where('TFD.trabajo_foraneo_id', $intTrabajoForaneoID);
		$this->db->where('TFD.ieps_unitario > 0');
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_detalles($intOrdenReparacionID, $intNumRows, $intPos)
	{
		//Seleccionar los registros sin límite que coincidan con los criterios de búsqueda
	    $this->db->select('TFD.cantidad, TFD.precio_unitario, TFD.tasa_cuota_iva, TFD.iva_unitario,
	    				   TFD.tasa_cuota_ieps, TFD.ieps_unitario, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps, 
						   TIeps.tipo AS tipo_ieps, TIeps.factor AS factor_ieps, TF.estatus');
		$this->db->from('trabajos_foraneos_detalles AS TFD');
		$this->db->join('trabajos_foraneos_02 AS TF', 'TFD.trabajo_foraneo_id = TF.trabajo_foraneo_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'TFD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'TFD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('TF.orden_reparacion_id', $intOrdenReparacionID);
		$arrResultado["registros"] =$this->db->get()->result();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("TF.trabajo_foraneo_id, TF.folio, 
						   DATE_FORMAT(TF.fecha,'%d/%m/%Y') AS fecha, 
						   TF.estatus, TFD.concepto, 
						   TFD.cantidad, TFD.precio_unitario, TFD.tasa_cuota_iva, TFD.iva_unitario,
	    				   TFD.tasa_cuota_ieps, TFD.ieps_unitario, TIva.valor_maximo AS porcentaje_iva, 
	    				   TIeps.valor_maximo AS porcentaje_ieps, 
	    				   TIeps.tipo AS tipo_ieps, TIeps.factor AS factor_ieps, TF.estatus", FALSE);
		$this->db->from('trabajos_foraneos_detalles AS TFD');
		$this->db->join('trabajos_foraneos_02 AS TF', 'TFD.trabajo_foraneo_id = TF.trabajo_foraneo_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'TFD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'TFD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
	    $this->db->where('TF.orden_reparacion_id', $intOrdenReparacionID);
		$this->db->order_by('TF.folio DESC','TFD.renglon');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["detalles"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>