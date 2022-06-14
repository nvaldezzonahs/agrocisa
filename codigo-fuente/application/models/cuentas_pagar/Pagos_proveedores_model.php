<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Pagos_proveedores_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla pagos_proveedores
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objPagoProveedor)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
		
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objPagoProveedor->strFolio); 

		//Tabla pagos_proveedores
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objPagoProveedor->intSucursalID, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objPagoProveedor->dteFecha, 
						  'moneda_id' => $objPagoProveedor->intMonedaID, 
						  'tipo_cambio' => $objPagoProveedor->intTipoCambio, 
						  'proveedor_id' => $objPagoProveedor->intProveedorID, 
						  'razon_social' => $objPagoProveedor->strRazonSocial,
						  'rfc' => $objPagoProveedor->strRfc,
						  'calle' => $objPagoProveedor->strCalle,
						  'numero_exterior' => $objPagoProveedor->strNumeroExterior,
						  'numero_interior' => $objPagoProveedor->strNumeroInterior,
						  'codigo_postal' => $objPagoProveedor->strCodigoPostal,
						  'colonia' => $objPagoProveedor->strColonia,
						  'localidad' => $objPagoProveedor->strLocalidad,
						  'municipio' => $objPagoProveedor->strMunicipio,
						  'estado' => $objPagoProveedor->strEstado,
						  'pais' => $objPagoProveedor->strPais,
						  'cuenta_bancaria_id' => $objPagoProveedor->intCuentaBancariaID,
						  'forma_pago_id' => $objPagoProveedor->intFormaPagoID,
						  'importe' => $objPagoProveedor->intImporte,
						  'observaciones' => $objPagoProveedor->strObservaciones, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objPagoProveedor->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('pagos_proveedores', $arrDatos);
		//Agregar id del nuevo registro al objeto
		$objPagoProveedor->intPagoProveedorID = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles del pago
		$this->guardar_detalles($objPagoProveedor);

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
	public function modificar(stdClass $objPagoProveedor)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla pagos_proveedores
		//Asignar datos al array
		$arrDatos = array('fecha' => $objPagoProveedor->dteFecha, 
						  'moneda_id' => $objPagoProveedor->intMonedaID, 
						  'tipo_cambio' => $objPagoProveedor->intTipoCambio, 
						  'proveedor_id' => $objPagoProveedor->intProveedorID, 
						  'razon_social' => $objPagoProveedor->strRazonSocial,
						  'rfc' => $objPagoProveedor->strRfc,
						  'calle' => $objPagoProveedor->strCalle,
						  'numero_exterior' => $objPagoProveedor->strNumeroExterior,
						  'numero_interior' => $objPagoProveedor->strNumeroInterior,
						  'codigo_postal' => $objPagoProveedor->strCodigoPostal,
						  'colonia' => $objPagoProveedor->strColonia,
						  'localidad' => $objPagoProveedor->strLocalidad,
						  'municipio' => $objPagoProveedor->strMunicipio,
						  'estado' => $objPagoProveedor->strEstado,
						  'pais' => $objPagoProveedor->strPais,
						  'cuenta_bancaria_id' => $objPagoProveedor->intCuentaBancariaID,
						  'forma_pago_id' => $objPagoProveedor->intFormaPagoID,
						  'importe' => $objPagoProveedor->intImporte,
						  'observaciones' => $objPagoProveedor->strObservaciones,  
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objPagoProveedor->intUsuarioID);
		$this->db->where('pago_proveedor_id', $objPagoProveedor->intPagoProveedorID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('pagos_proveedores', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('pago_proveedor_id', $objPagoProveedor->intPagoProveedorID);
		$this->db->delete('pagos_proveedores_detalles');
		//Hacer un llamado al método para guardar los detalles del pago
		$this->guardar_detalles($objPagoProveedor);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intPagoProveedorID)
	{
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('pago_proveedor_id', $intPagoProveedorID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('pagos_proveedores', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intPagoProveedorID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = "WHERE ";

		//Si existe id del pago
		if ($intPagoProveedorID != NULL)
		{   

			$strRestricciones .= "PP.pago_proveedor_id = $intPagoProveedorID";
		}
		else  
		{

			$strRestricciones .= "PP.sucursal_id = $intSucursalID";

			//Si existe id del proveedor
		    if($intProveedorID > 0)
		    {
		    	$strRestricciones .= " AND PP.proveedor_id = $intProveedorID";
		    }

			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$strRestricciones .= " AND (PP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
		    }

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$strRestricciones .= " AND PP.estatus = '$strEstatus'";
			}


			$strRestricciones .= " AND ((PP.folio LIKE '%$strBusqueda%') OR
		        				   	   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
					                   (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))";
		
		}


		//Formar consulta
		$queryPagos = "SELECT PP.pago_proveedor_id, PP.folio, DATE_FORMAT(PP.fecha,'%d/%m/%Y') AS fecha, 
						   PP.moneda_id, PP.tipo_cambio, PP.proveedor_id, 
						   PP.razon_social, PP.rfc, PP.calle, PP.numero_exterior, PP.numero_interior,
						   PP.codigo_postal, PP.colonia, PP.localidad, PP.municipio, PP.estado, 
						   PP.pais, PP.cuenta_bancaria_id, PP.forma_pago_id, PP.importe,
						   PP.observaciones, PP.estatus,
						   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, 
						   P.telefono_principal, P.correo_electronico, P.contacto_correo_electronico, 
						   M.codigo AS codigo_moneda, CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, 
						   CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria,
						   CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, 
						   UC.usuario AS usuario_creacion,
						   DATE_FORMAT(PP.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion, 
						   ROUND((Detalles.Importe/PP.tipo_cambio), 2) AS subtotal,
						   ROUND((Detalles.IVA/PP.tipo_cambio), 2) AS iva,
						   ROUND((Detalles.IEPS/PP.tipo_cambio), 2) AS ieps 
				       FROM pagos_proveedores AS PP
				       INNER JOIN sat_monedas AS M ON PP.moneda_id = M.moneda_id
				       INNER JOIN proveedores AS P ON PP.proveedor_id = P.proveedor_id
				       INNER JOIN cuentas_bancarias AS CB ON PP.cuenta_bancaria_id = CB.cuenta_bancaria_id
				       INNER JOIN sat_forma_pago AS FP ON PP.forma_pago_id = FP.forma_pago_id
				       INNER JOIN (SELECT Det.pago_proveedor_id AS referenciaID,
								    	  SUM(Det.importe) AS Importe, 
								    	  SUM(Det.iva) AS IVA,
								    	  SUM(Det.ieps) AS IEPS
						    	   FROM pagos_proveedores_detalles AS Det
						    	   GROUP BY Det.pago_proveedor_id) AS Detalles ON Detalles.referenciaID = PP.pago_proveedor_id
				       LEFT JOIN  usuarios AS UC ON PP.usuario_creacion = UC.usuario_id
					   $strRestricciones
					   ORDER BY PP.fecha DESC, PP.folio DESC";

		$strSQL = $this->db->query($queryPagos);
		//Si existe id del pago
		if ($intPagoProveedorID != NULL)
		{ 
			//Regresar datos de la primer fila
			return $strSQL->row();
		}
		else
		{
			//Regresar todas las filas
			return $strSQL->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						                    $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('pagos_proveedores AS PP');
		$this->db->join('sat_monedas AS M', 'PP.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'PP.proveedor_id = P.proveedor_id', 'inner');
		$this->db->where('PP.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del proveedor
	    if($intProveedorID > 0)
	    {
	   		$this->db->where('PP.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(PP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('PP.estatus', $strEstatus);
		}

		$this->db->where("((PP.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}


	/*Método para regresar los movimientos (ordenes de compra, pagos, descuentos y anticipos) del proveedor 
	  que coincida con los criterios de búsqueda proporcionados (se utiliza en el reporte de estado de cuenta)*/
	public function buscar_movimientos_estado_cuenta($dteFechaInicial, $dteFechaFinal, $intProveedorID, 
													 $intMonedaID)
	{

		//Constante para identificar al tipo de movimiento entrada de refacciones por compra
		$intMovRefEntradaCompra = ENTRADA_REFACCIONES_COMPRA;
		//Constante para identificar al tipo de movimiento salida de refacciones por devolución al proveedor
		$intMovRefSalidaDevolucion = SALIDA_REFACCIONES_DEVOLUCION_PROVEEDOR;
		//Constante para identificar al tipo de movimiento salida de maquinaria por devolución al proveedor
		$intMovMaqSalidaDevolucion = SALIDA_MAQUINARIA_DEVOLUCION_PROVEEDOR;

		//Variable que se utiliza para formar la  consulta
		$queryMovimientos = '';
		
		//Variables para definir que tipos de módulo se incluiran en la búsqueda
		//Ordenes de compra de maquinaria
		$queryMaquinaria = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion,
								   DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
								   'ORDEN DE COMPRA MAQUINARIA' AS descripcion, '' AS folio_referencia, 'cargo' AS tipo, 
								   (SUM(ROUND(((Det.precio_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
									   ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
									   ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) -
									   ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS importe
							FROM  ordenes_compra_maquinaria AS Reg
							INNER JOIN ordenes_compra_maquinaria_detalles AS Det ON Reg.orden_compra_maquinaria_id = Det.orden_compra_maquinaria_id
							WHERE Reg.proveedor_id = $intProveedorID
							AND (Reg.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
							AND Reg.moneda_id = $intMonedaID
							AND (Reg.estatus = 'AUTORIZADO' OR Reg.estatus = 'SURTIDO')
							GROUP BY Reg.orden_compra_maquinaria_id";


		//Devoluciones de maquinaria
		$queryDevMaquinaria = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion,
								   	  DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
								   	  'DEVOLUCIÓN DE MAQUINARIA' AS descripcion,
								   	  OCM.folio AS folio_referencia, 'abono' AS tipo,
								   	  (SUM(ROUND((OCMD.precio_unitario/OCM.tipo_cambio), 2) + 
										  ROUND((OCMD.iva_unitario/OCM.tipo_cambio), 2) + 
										  ROUND((OCMD.ieps_unitario/OCM.tipo_cambio), 2)) -
										  ROUND((OCM.importe_retenido/OCM.tipo_cambio), 2)) AS importe
							   FROM movimientos_maquinaria AS Reg 
							   INNER JOIN movimientos_maquinaria AS MME ON Reg.referencia_id = MME.movimiento_maquinaria_id 
							   INNER JOIN ordenes_compra_maquinaria AS OCM ON MME.referencia_id = OCM.orden_compra_maquinaria_id
							   INNER JOIN movimientos_maquinaria_detalles AS MMDS ON Reg.movimiento_maquinaria_id = MMDS.movimiento_maquinaria_id
							   INNER JOIN movimientos_maquinaria_detalles AS MMDE ON MME.movimiento_maquinaria_id = MMDE.movimiento_maquinaria_id
									  AND MMDS.serie = MMDE.serie AND  MMDS.maquinaria_descripcion_id = MMDE.maquinaria_descripcion_id	
							   INNER JOIN ordenes_compra_maquinaria_detalles AS OCMD ON OCM.orden_compra_maquinaria_id = OCMD.orden_compra_maquinaria_id  
								      AND MMDE.maquinaria_descripcion_id = OCMD.maquinaria_descripcion_id
							   WHERE Reg.tipo_movimiento = $intMovMaqSalidaDevolucion
							   AND OCM.proveedor_id = $intProveedorID
							   AND (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
							   AND OCM.moneda_id = $intMonedaID
							   AND Reg.estatus = 'ACTIVO'
							   GROUP BY Reg.movimiento_maquinaria_id";


		//Entradas de compra de refacciones
		$queryRefacciones = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion,
								     DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
								    'ENTRADAS POR COMPRA REFACCIONES' AS descripcion, 
								     '' AS folio_referencia, 'cargo' AS tipo,
								     (SUM(ROUND(((Det.costo_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
									     ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
									     ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) -
									     ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS importe
							 FROM movimientos_refacciones AS Reg
							 INNER JOIN movimientos_refacciones_detalles AS Det ON Reg.movimiento_refacciones_id = Det.movimiento_refacciones_id
							 WHERE Reg.tipo_movimiento = $intMovRefEntradaCompra
							 AND Reg.proveedor_id = $intProveedorID
							 AND (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
							 AND Reg.moneda_id = $intMonedaID
							 AND Reg.estatus = 'ACTIVO'
							 GROUP BY Reg.movimiento_refacciones_id";

	    //Devoluciones de refacciones
	    $queryDevRefacciones = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion,
								     DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
								    'DEVOLUCIÓN DE REFACCIONES' AS descripcion, 
								     MRE.folio AS folio_referencia, 'abono' AS tipo,
								     SUM(ROUND(((Det.costo_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
									     ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
									     ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS importe
								 FROM movimientos_refacciones AS Reg
								 INNER JOIN movimientos_refacciones AS MRE ON Reg.referencia_id = MRE.movimiento_refacciones_id
								 INNER JOIN movimientos_refacciones_detalles AS Det ON Reg.movimiento_refacciones_id = Det.movimiento_refacciones_id
								 WHERE Reg.tipo_movimiento = $intMovRefSalidaDevolucion
								 AND MRE.proveedor_id = $intProveedorID
								 AND (DATE_FORMAT(Reg.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
								 AND Reg.moneda_id = $intMonedaID
								 AND Reg.estatus = 'ACTIVO'
								 GROUP BY Reg.movimiento_refacciones_id";


		//Ordenes de compra de servicio (trabajos foráneos)
		$queryServicio = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion,
								 DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
							     'ORDEN DE COMPRA SERVICIO' AS descripcion, '' AS folio_referencia, 'cargo' AS tipo,
							     (SUM(ROUND(((Det.costo_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
									 ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
									 ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) -
									 ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS importe
						  FROM trabajos_foraneos_02 AS Reg
						  INNER JOIN trabajos_foraneos_detalles AS Det ON Reg.trabajo_foraneo_id = Det.trabajo_foraneo_id
						  LEFT JOIN ordenes_compra AS OC ON Reg.orden_compra_id = OC.orden_compra_id
						  	   AND Reg.tipo_referencia = 'GENERAL'
						  LEFT JOIN ordenes_compra_servicio AS OCS ON Reg.orden_compra_id = OCS.orden_compra_servicio_id
						  	   AND Reg.tipo_referencia = 'SERVICIO'
						  WHERE (OC.proveedor_id = $intProveedorID  OR OCS.proveedor_id = $intProveedorID) 
						  AND (Reg.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
						  AND Reg.moneda_id = $intMonedaID
						  AND Reg.estatus = 'ACTIVO'
						  GROUP BY Reg.trabajo_foraneo_id";

	    //Ordenes de compra de servicio interno (trabajos foráneos internos)
		$queryServicioInterno = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion,
									 	DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
								     	'ORDEN DE COMPRA SERVICIO INTERNO' AS descripcion, '' AS folio_referencia, 'cargo' AS tipo,
								     	(SUM(ROUND(((Det.costo_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
										 	ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
										 	ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) -
										 	ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS importe
							  FROM trabajos_foraneos_internos AS Reg
							  INNER JOIN ordenes_compra AS OC ON Reg.orden_compra_id = OC.orden_compra_id
							  INNER JOIN trabajos_foraneos_internos_detalles AS Det ON Reg.trabajo_foraneo_interno_id = Det.trabajo_foraneo_interno_id
							  WHERE OC.proveedor_id = $intProveedorID
							  AND (Reg.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
							  AND Reg.moneda_id = $intMonedaID
							  AND Reg.estatus = 'ACTIVO'
							  GROUP BY Reg.trabajo_foraneo_interno_id";

		//Ordenes de compra generales
		$queryGeneral = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion,
								DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
							   'ORDEN DE COMPRA GENERAL' AS descripcion, '' AS folio_referencia, 'cargo' AS tipo,
  								(SUM((ROUND(((Det.precio_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
						             ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
						             ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2) -
						             ROUND(((Det.retencion_isr_unitario * Det.cantidad)/Reg.tipo_cambio), 2) -
						             ROUND(((Det.retencion_iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2))) -
						             ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS importe
						 FROM ordenes_compra AS Reg
						 INNER JOIN ordenes_compra_detalles_02 AS Det ON Reg.orden_compra_id = Det.orden_compra_id
						 WHERE Reg.orden_compra_id NOT IN (SELECT TF.orden_compra_id FROM  trabajos_foraneos_02 AS TF
						 								   WHERE TF.tipo_referencia = 'GENERAL')
						 AND  Reg.orden_compra_id NOT IN (SELECT TFI.orden_compra_id FROM  trabajos_foraneos_internos AS TFI)
						 AND Reg.proveedor_id = $intProveedorID
						 AND (Reg.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
						 AND Reg.moneda_id = $intMonedaID
						 AND (Reg.estatus = 'AUTORIZADO' OR Reg.estatus = 'SURTIDO')
						 GROUP BY Reg.orden_compra_id";

		//Ordenes de compra especiales
		$queryEspecial = "SELECT Reg.folio, Reg.fecha,  Reg.fecha_creacion,
								  DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
							     'ORDEN DE COMPRA ESPECIAL' AS descripcion, '' AS folio_referencia, 'cargo' AS tipo,
							     (SUM((ROUND(((Det.precio_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
						              ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
						              ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2))) -
						              ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS importe
						 FROM ordenes_compra_especiales AS Reg
						 INNER JOIN ordenes_compra_especiales_detalles AS Det ON Reg.orden_compra_especial_id = Det.orden_compra_especial_id
						 WHERE Reg.proveedor_id = $intProveedorID
						 AND (Reg.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
						 AND Reg.moneda_id = $intMonedaID
						 AND (Reg.estatus = 'AUTORIZADO' OR Reg.estatus = 'SURTIDO')
						 GROUP BY Reg.orden_compra_especial_id";

		//Ordenes de compra combustibles
		$queryCombustible = "SELECT Reg.folio, Reg.fecha,  Reg.fecha_creacion,
								    DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
							       'ORDEN DE COMPRA COMBUSTIBLE' AS descripcion, '' AS folio_referencia, 'cargo' AS tipo,
									(SUM(ROUND((VGD.subtotal/Reg.tipo_cambio), 2) + 
									    ROUND((VGD.iva/Reg.tipo_cambio), 2)) -
									    ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS importe
						 	FROM ordenes_compra_combustibles AS Reg
						 	INNER JOIN ordenes_compra_combustibles_detalles AS Det ON Reg.orden_compra_combustible_id = Det.orden_compra_combustible_id
						 	INNER JOIN vales_gasolina_detalles AS VGD ON Det.vale_gasolina_id = VGD.vale_gasolina_id
						 	WHERE Reg.proveedor_id = $intProveedorID
						 	AND (Reg.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
						 	AND Reg.moneda_id = $intMonedaID
						 	AND Reg.estatus = 'AUTORIZADO' 
						 	GROUP BY Reg.orden_compra_combustible_id";

		//Cartera
		$queryCartera = "SELECT Reg.folio, Reg.fecha,  Reg.fecha AS fecha_creacion,
							    DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
							   CONCAT_WS(' - ','CARTERA', Reg.modulo) AS descripcion, 
							   '' AS folio_referencia, 'cargo' AS tipo,
							   ((ROUND((Reg.subtotal/Reg.tipo_cambio), 2) + 
								 ROUND((Reg.iva_unitario/Reg.tipo_cambio), 2) + 
							     ROUND((Reg.ieps_unitario/Reg.tipo_cambio), 2))) AS importe
						 FROM cartera_proveedores AS Reg
						 WHERE Reg.proveedor_id = $intProveedorID
						 AND (Reg.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
						 AND Reg.moneda_id = $intMonedaID";

		//Descuentos
		$queryDescuentos = "SELECT  Reg.folio, Reg.fecha,  Reg.fecha_creacion,
								    DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format, 
							        CONCAT_WS(' - ','DESCUENTO', Det.referencia) AS descripcion, 
							        CASE 
										WHEN  Det.referencia = 'MAQUINARIA' THEN  OCM.folio
								        WHEN  Det.referencia = 'REFACCIONES' THEN  MR.folio
										WHEN  Det.referencia = 'SERVICIO' THEN  TF.folio
										WHEN  Det.referencia = 'SERVICIO INTERNO' THEN  TFI.folio
										WHEN  Det.referencia = 'GENERAL' THEN  OC.folio
										WHEN  Det.referencia = 'ESPECIAL' THEN  OCE.folio
										WHEN  Det.referencia = 'COMBUSTIBLE' THEN  OCC.folio
										ELSE CT.folio
									END AS folio_referencia, 'abono' AS tipo,
									CASE 
								 		WHEN Det.referencia = 'MAQUINARIA' AND OCM.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.importe/OCM.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/OCM.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/OCM.tipo_cambio), 2))
								        WHEN Det.referencia = 'REFACCIONES' AND MR.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.importe/MR.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/MR.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/MR.tipo_cambio), 2))
								        WHEN Det.referencia = 'SERVICIO' AND TF.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.importe/TF.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/TF.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/TF.tipo_cambio), 2))
								        WHEN Det.referencia = 'SERVICIO INTERNO' AND TFI.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.importe/TFI.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/TFI.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/TFI.tipo_cambio), 2))
								        WHEN Det.referencia = 'GENERAL' AND OC.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.importe/OC.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/OC.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/OC.tipo_cambio), 2))
								        WHEN Det.referencia = 'ESPECIAL' AND OCE.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.importe/OCE.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/OCE.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/OCE.tipo_cambio), 2))
								        WHEN Det.referencia = 'COMBUSTIBLE' AND OCC.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.importe/OCC.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/OCC.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/OCC.tipo_cambio), 2))
										WHEN Det.referencia = 'CARTERA' AND CT.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.importe/CT.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/CT.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/CT.tipo_cambio), 2))
								        ELSE
								         	SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
										    	ROUND((Det.iva/Reg.tipo_cambio), 2) + 
								         	    ROUND((Det.ieps/Reg.tipo_cambio), 2)) 
								 	END AS importe
							FROM  descuentos_proveedores AS Reg
							INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
							LEFT JOIN ordenes_compra_maquinaria AS OCM ON Det.referencia_id = OCM.orden_compra_maquinaria_id  
								 AND Det.referencia = 'MAQUINARIA'
							LEFT JOIN movimientos_refacciones AS MR ON Det.referencia_id = MR.movimiento_refacciones_id  
								  AND Det.referencia = 'REFACCIONES' AND MR.tipo_movimiento = $intMovRefEntradaCompra
							LEFT JOIN trabajos_foraneos_02 AS TF ON Det.referencia_id = TF.trabajo_foraneo_id  
								 AND Det.referencia = 'SERVICIO'
						    LEFT JOIN trabajos_foraneos_internos AS TFI ON Det.referencia_id = TFI.trabajo_foraneo_interno_id  
								 AND Det.referencia = 'SERVICIO INTERNO'
							LEFT JOIN ordenes_compra AS OC ON Det.referencia_id = OC.orden_compra_id  
								 AND Det.referencia = 'GENERAL'
						    LEFT JOIN ordenes_compra_especiales AS OCE ON Det.referencia_id = OCE.orden_compra_especial_id  
								 AND Det.referencia = 'ESPECIAL'
							LEFT JOIN ordenes_compra_combustibles AS OCC ON Det.referencia_id = OCC.orden_compra_combustible_id  
								 AND Det.referencia = 'COMBUSTIBLE'
						    LEFT JOIN cartera_proveedores AS CT ON Det.referencia_id = CT.cartera_proveedor_id  
								 AND Det.referencia = 'CARTERA' 
							WHERE  Reg.proveedor_id = $intProveedorID
							AND (Reg.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
							AND  Reg.estatus = 'ACTIVO'
							AND  (OCM.moneda_id = $intMonedaID OR 
								  MR.moneda_id = $intMonedaID OR
								  TF.moneda_id = $intMonedaID OR
								  TFI.moneda_id = $intMonedaID OR
								  OC.moneda_id = $intMonedaID OR
								  OCE.moneda_id = $intMonedaID OR
								  OCC.moneda_id = $intMonedaID OR
								  CT.moneda_id = $intMonedaID)
							GROUP BY Det.descuento_proveedor_id, Det.referencia, Det.referencia_id";


		//Pagos				
		$queryPagos = "SELECT  Reg.folio, Reg.fecha,  Reg.fecha_creacion,
							    DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format, 
						        CONCAT_WS(' - ','PAGO', Det.referencia) AS descripcion, 
						        CASE 
									WHEN  Det.referencia = 'MAQUINARIA' THEN  OCM.folio
							        WHEN  Det.referencia = 'REFACCIONES' THEN  MR.folio
									WHEN  Det.referencia = 'SERVICIO' THEN  TF.folio
									WHEN  Det.referencia = 'SERVICIO INTERNO' THEN  TFI.folio
									WHEN  Det.referencia = 'GENERAL' THEN  OC.folio
									WHEN  Det.referencia = 'ESPECIAL' THEN  OCE.folio
									WHEN  Det.referencia = 'COMBUSTIBLE' THEN  OCC.folio
									ELSE CT.folio
								END AS folio_referencia, 'abono' AS tipo,
								CASE 
							 		WHEN Det.referencia = 'MAQUINARIA' AND OCM.moneda_id <> Reg.moneda_id
										  THEN  
										   SUM(ROUND((Det.importe/OCM.tipo_cambio), 2) + 
									    	   ROUND((Det.iva/OCM.tipo_cambio), 2) + 
							         	       ROUND((Det.ieps/OCM.tipo_cambio), 2))
							        WHEN Det.referencia = 'REFACCIONES' AND MR.moneda_id <> Reg.moneda_id
										  THEN  
										   SUM(ROUND((Det.importe/MR.tipo_cambio), 2) + 
									    	   ROUND((Det.iva/MR.tipo_cambio), 2) + 
							         	       ROUND((Det.ieps/MR.tipo_cambio), 2))
							        WHEN Det.referencia = 'SERVICIO' AND TF.moneda_id <> Reg.moneda_id
										  THEN  
										   SUM(ROUND((Det.importe/TF.tipo_cambio), 2) + 
									    	   ROUND((Det.iva/TF.tipo_cambio), 2) + 
							         	       ROUND((Det.ieps/TF.tipo_cambio), 2))
							        WHEN Det.referencia = 'SERVICIO INTERNO' AND TFI.moneda_id <> Reg.moneda_id
										  THEN  
										   SUM(ROUND((Det.importe/TFI.tipo_cambio), 2) + 
									    	   ROUND((Det.iva/TFI.tipo_cambio), 2) + 
							         	       ROUND((Det.ieps/TFI.tipo_cambio), 2))
							        WHEN Det.referencia = 'GENERAL' AND OC.moneda_id <> Reg.moneda_id
										  THEN  
										   SUM(ROUND((Det.importe/OC.tipo_cambio), 2) + 
									    	   ROUND((Det.iva/OC.tipo_cambio), 2) + 
							         	       ROUND((Det.ieps/OC.tipo_cambio), 2))
							        WHEN Det.referencia = 'ESPECIAL' AND OCE.moneda_id <> Reg.moneda_id
										  THEN  
										   SUM(ROUND((Det.importe/OCE.tipo_cambio), 2) + 
									    	   ROUND((Det.iva/OCE.tipo_cambio), 2) + 
							         	       ROUND((Det.ieps/OCE.tipo_cambio), 2))
							        WHEN Det.referencia = 'COMBUSTIBLE' AND OCC.moneda_id <> Reg.moneda_id
											  THEN  
											   SUM(ROUND((Det.importe/OCC.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/OCC.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/OCC.tipo_cambio), 2))
									WHEN Det.referencia = 'CARTERA' AND CT.moneda_id <> Reg.moneda_id
										  THEN  
										   SUM(ROUND((Det.importe/CT.tipo_cambio), 2) + 
									    	   ROUND((Det.iva/CT.tipo_cambio), 2) + 
							         	       ROUND((Det.ieps/CT.tipo_cambio), 2))
							        ELSE
							         	SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
									    	ROUND((Det.iva/Reg.tipo_cambio), 2) + 
							         	    ROUND((Det.ieps/Reg.tipo_cambio), 2)) 
							 	END AS importe
						FROM  pagos_proveedores AS Reg
						INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
						LEFT JOIN ordenes_compra_maquinaria AS OCM ON Det.referencia_id = OCM.orden_compra_maquinaria_id  
							 AND Det.referencia = 'MAQUINARIA'
						LEFT JOIN movimientos_refacciones AS MR ON Det.referencia_id = MR.movimiento_refacciones_id  
							  AND Det.referencia = 'REFACCIONES' AND MR.tipo_movimiento = $intMovRefEntradaCompra
						LEFT JOIN trabajos_foraneos_02 AS TF ON Det.referencia_id = TF.trabajo_foraneo_id  
							 AND Det.referencia = 'SERVICIO'
						LEFT JOIN trabajos_foraneos_internos AS TFI ON Det.referencia_id = TFI.trabajo_foraneo_interno_id  
							 AND Det.referencia = 'SERVICIO INTERNO'
						LEFT JOIN ordenes_compra AS OC ON Det.referencia_id = OC.orden_compra_id  
							 AND Det.referencia = 'GENERAL'
					    LEFT JOIN ordenes_compra_especiales AS OCE ON Det.referencia_id = OCE.orden_compra_especial_id  
							 AND Det.referencia = 'ESPECIAL'
						LEFT JOIN ordenes_compra_combustibles AS OCC ON Det.referencia_id = OCC.orden_compra_combustible_id  
								 AND Det.referencia = 'COMBUSTIBLE'
					    LEFT JOIN cartera_proveedores AS CT ON Det.referencia_id = CT.cartera_proveedor_id  
							 AND Det.referencia = 'CARTERA' 
						WHERE  Reg.proveedor_id = $intProveedorID
						AND (Reg.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
						AND  Reg.estatus = 'ACTIVO'
						AND  (OCM.moneda_id = $intMonedaID OR 
							  MR.moneda_id = $intMonedaID OR
							  TF.moneda_id = $intMonedaID OR
							  TFI.moneda_id = $intMonedaID OR
							  OC.moneda_id = $intMonedaID OR
							  OCE.moneda_id = $intMonedaID OR
							  OCC.moneda_id = $intMonedaID OR
							  CT.moneda_id = $intMonedaID)
						GROUP BY Det.pago_proveedor_id, Det.referencia, Det.referencia_id";


		//Anticipos
		$queryAnticipos = "SELECT Reg.folio, Reg.fecha, Reg.fecha_creacion,
								  DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
							      CONCAT_WS(' - ','ANTICIPO', Reg.estatus) AS descripcion, 
								  '' AS folio_referencia, 'abono' AS tipo, 
								  (IFNULL(Detalles.Total, 0) -
								   IFNULL(AplicacionAnticipos.Total, 0)) AS importe
						   FROM  anticipos_proveedores AS Reg
						   LEFT JOIN (SELECT Det.anticipo_proveedor_id AS referenciaID,
						                	 SUM(ROUND((Det.subtotal/Reg.tipo_cambio), 2) + 
												 ROUND((Det.iva/Reg.tipo_cambio), 2) + 
												 ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total
					   				  FROM anticipos_proveedores AS Reg
					   				  INNER JOIN anticipos_proveedores_detalles AS Det ON Reg.anticipo_proveedor_id = Det.anticipo_proveedor_id
						    		  GROUP BY Det.anticipo_proveedor_id) AS Detalles ON Detalles.referenciaID = Reg.anticipo_proveedor_id
						   LEFT JOIN (SELECT Reg.anticipo_proveedor_id AS referenciaID,
						   					  SUM(ROUND((Det.importe/AP.tipo_cambio), 2) + 
										   		  ROUND((Det.iva/AP.tipo_cambio), 2) + 
						                  		  ROUND((Det.ieps/AP.tipo_cambio), 2)) AS Total
						  			  FROM anticipos_proveedores_aplicacion AS Reg
						  			  INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
						  			  INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
						  			  WHERE Reg.estatus = 'ACTIVO'
						  			  GROUP BY Reg.anticipo_proveedor_id) AS AplicacionAnticipos ON AplicacionAnticipos.referenciaID = Reg.anticipo_proveedor_id
						   WHERE Reg.proveedor_id = $intProveedorID
						   AND (Reg.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
						   AND Reg.moneda_id = $intMonedaID
						   AND Reg.estatus <> 'INACTIVO'
						   GROUP BY  Reg.anticipo_proveedor_id";

		//Aplicación de anticipos
	   $queryAplicacionAnticipos = "SELECT  Reg.folio, Reg.fecha,  Reg.fecha_creacion,
										    DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format, 
									        CONCAT_WS(' - ','APLICACIÓN DE ANTICIPO', Det.referencia) AS descripcion, 
									        CASE 
												WHEN  Det.referencia = 'MAQUINARIA' THEN  OCM.folio
										        WHEN  Det.referencia = 'REFACCIONES' THEN  MR.folio
												WHEN  Det.referencia = 'SERVICIO' THEN  TF.folio
												WHEN  Det.referencia = 'SERVICIO INTERNO' THEN  TFI.folio
												WHEN  Det.referencia = 'GENERAL' THEN  OC.folio
												WHEN  Det.referencia = 'ESPECIAL' THEN  OCE.folio
												WHEN  Det.referencia = 'COMBUSTIBLE' THEN  OCC.folio
												ELSE CT.folio
											END AS folio_referencia, 'abono' AS tipo,
											CASE 
										 		WHEN Det.referencia = 'MAQUINARIA' AND OCM.moneda_id <> AP.moneda_id
													  THEN  
													   SUM(ROUND((Det.importe/OCM.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/OCM.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/OCM.tipo_cambio), 2))
										        WHEN Det.referencia = 'REFACCIONES' AND MR.moneda_id <> AP.moneda_id
													  THEN  
													   SUM(ROUND((Det.importe/MR.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/MR.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/MR.tipo_cambio), 2))
										        WHEN Det.referencia = 'SERVICIO' AND TF.moneda_id <> AP.moneda_id
													  THEN  
													   SUM(ROUND((Det.importe/TF.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/TF.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/TF.tipo_cambio), 2))
										        WHEN Det.referencia = 'SERVICIO INTERNO' AND TFI.moneda_id <> AP.moneda_id
													  THEN  
													   SUM(ROUND((Det.importe/TFI.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/TFI.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/TFI.tipo_cambio), 2))
										        WHEN Det.referencia = 'GENERAL' AND OC.moneda_id <> AP.moneda_id
													  THEN  
													   SUM(ROUND((Det.importe/OC.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/OC.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/OC.tipo_cambio), 2))
										        WHEN Det.referencia = 'ESPECIAL' AND OCE.moneda_id <> AP.moneda_id
													  THEN  
													   SUM(ROUND((Det.importe/OCE.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/OCE.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/OCE.tipo_cambio), 2))
										        WHEN Det.referencia = 'COMBUSTIBLE' AND OCC.moneda_id <> AP.moneda_id
													  THEN  
													   SUM(ROUND((Det.importe/OCC.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/OCC.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/OCC.tipo_cambio), 2))
												WHEN Det.referencia = 'CARTERA' AND CT.moneda_id <> AP.moneda_id
													  THEN  
													   SUM(ROUND((Det.importe/CT.tipo_cambio), 2) + 
												    	   ROUND((Det.iva/CT.tipo_cambio), 2) + 
										         	       ROUND((Det.ieps/CT.tipo_cambio), 2))
										        ELSE
										         	SUM(ROUND((Det.importe/AP.tipo_cambio), 2) + 
												    	ROUND((Det.iva/AP.tipo_cambio), 2) + 
										         	    ROUND((Det.ieps/AP.tipo_cambio), 2)) 
										 	END AS importe
									FROM  anticipos_proveedores_aplicacion AS Reg
									INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
									INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
									LEFT JOIN ordenes_compra_maquinaria AS OCM ON Det.referencia_id = OCM.orden_compra_maquinaria_id  
										 AND Det.referencia = 'MAQUINARIA'
									LEFT JOIN movimientos_refacciones AS MR ON Det.referencia_id = MR.movimiento_refacciones_id  
										  AND Det.referencia = 'REFACCIONES' AND MR.tipo_movimiento = $intMovRefEntradaCompra
									LEFT JOIN trabajos_foraneos_02 AS TF ON Det.referencia_id = TF.trabajo_foraneo_id  
										 AND Det.referencia = 'SERVICIO'
									LEFT JOIN trabajos_foraneos_internos AS TFI ON Det.referencia_id = TFI.trabajo_foraneo_interno_id  
										 AND Det.referencia = 'SERVICIO INTERNO'
									LEFT JOIN ordenes_compra AS OC ON Det.referencia_id = OC.orden_compra_id  
										 AND Det.referencia = 'GENERAL'
								    LEFT JOIN ordenes_compra_especiales AS OCE ON Det.referencia_id = OCE.orden_compra_especial_id  
										 AND Det.referencia = 'ESPECIAL'
								    LEFT JOIN ordenes_compra_combustibles AS OCC ON Det.referencia_id = OCC.orden_compra_combustible_id  
										 AND Det.referencia = 'COMBUSTIBLE'
								    LEFT JOIN cartera_proveedores AS CT ON Det.referencia_id = CT.cartera_proveedor_id  
										 AND Det.referencia = 'CARTERA' 
									WHERE  AP.proveedor_id = $intProveedorID
									AND (Reg.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
									AND  Reg.estatus = 'ACTIVO'
									AND  (OCM.moneda_id = $intMonedaID OR 
										  MR.moneda_id = $intMonedaID OR
										  TF.moneda_id = $intMonedaID OR
										  TFI.moneda_id = $intMonedaID OR
										  OC.moneda_id = $intMonedaID OR
										  OCE.moneda_id = $intMonedaID OR
										  OCC.moneda_id = $intMonedaID OR
										  CT.moneda_id = $intMonedaID)
									GROUP BY Det.anticipo_proveedor_aplicacion_id, Det.referencia, Det.referencia_id";



		//Vales de caja chica
		$queryValesCaja = "SELECT  Reg.folio, Reg.fecha,  Reg.fecha_creacion,
								    DATE_FORMAT(Reg.fecha, '%d/%m/%Y') AS fecha_format, 
							       'VALE DE CAJA CHICA' AS descripcion,
							        CASE 
										WHEN  Det.tipo_orden_compra = 'MAQUINARIA' THEN  OCM.folio
								        WHEN  Det.tipo_orden_compra = 'REFACCIONES' THEN  MR.folio
										WHEN  Det.tipo_orden_compra = 'SERVICIO' THEN  TF.folio
										WHEN  Det.tipo_orden_compra = 'SERVICIO INTERNO' THEN  TFI.folio
										WHEN  Det.tipo_orden_compra = 'GENERAL' THEN  OC.folio
										ELSE  OCE.folio
									END AS folio_referencia, 'abono' AS tipo,
									CASE 
								 		WHEN Det.tipo_orden_compra = 'MAQUINARIA'
											  THEN  
											   SUM(ROUND((Det.subtotal/OCM.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/OCM.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/OCM.tipo_cambio), 2))
								        WHEN Det.tipo_orden_compra = 'REFACCIONES'
											  THEN  
											   SUM(ROUND((Det.subtotal/MR.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/MR.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/MR.tipo_cambio), 2))
								        WHEN Det.tipo_orden_compra = 'SERVICIO'
											  THEN  
											   SUM(ROUND((Det.subtotal/TF.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/TF.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/TF.tipo_cambio), 2))
								        WHEN Det.tipo_orden_compra = 'SERVICIO INTERNO'
											  THEN  
											   SUM(ROUND((Det.subtotal/TFI.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/TFI.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/TFI.tipo_cambio), 2))
								        WHEN Det.tipo_orden_compra = 'GENERAL'
											  THEN  
											   SUM(ROUND((Det.subtotal/OC.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/OC.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/OC.tipo_cambio), 2))
								        ELSE 
											   SUM(ROUND((Det.subtotal/OCE.tipo_cambio), 2) + 
										    	   ROUND((Det.iva/OCE.tipo_cambio), 2) + 
								         	       ROUND((Det.ieps/OCE.tipo_cambio), 2))
								 	END AS importe
							FROM  cajas_vales AS Reg 
							INNER JOIN cajas_vales_detalles AS Det ON Reg.caja_vale_id = Det.caja_vale_id
							LEFT JOIN ordenes_compra_maquinaria AS OCM ON Det.orden_compra_id = OCM.orden_compra_maquinaria_id  
								 AND Det.tipo_orden_compra = 'MAQUINARIA'
							LEFT JOIN movimientos_refacciones AS MR ON Det.orden_compra_id = MR.movimiento_refacciones_id  
								  AND Det.tipo_orden_compra = 'REFACCIONES' AND MR.tipo_movimiento = $intMovRefEntradaCompra
							LEFT JOIN trabajos_foraneos_02 AS TF ON Det.orden_compra_id = TF.trabajo_foraneo_id  
								 AND Det.tipo_orden_compra = 'SERVICIO'
							LEFT JOIN trabajos_foraneos_internos AS TFI ON Det.orden_compra_id = TFI.trabajo_foraneo_interno_id  
								 AND Det.tipo_orden_compra = 'SERVICIO INTERNO'
							LEFT JOIN ordenes_compra AS OC ON Det.orden_compra_id = OC.orden_compra_id  
								 AND Det.tipo_orden_compra = 'GENERAL'
						    LEFT JOIN ordenes_compra_especiales AS OCE ON Det.orden_compra_id = OCE.orden_compra_especial_id  
								 AND Det.tipo_orden_compra = 'ESPECIAL'
							WHERE  Det.proveedor_id = $intProveedorID
							AND (Reg.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
							AND (Reg.estatus = 'AUTORIZADO' OR Reg.estatus = 'CERRADO')
							AND  (OCM.moneda_id = $intMonedaID OR 
								  MR.moneda_id = $intMonedaID OR
								  TF.moneda_id = $intMonedaID OR
								  TFI.moneda_id = $intMonedaID OR
								  OC.moneda_id = $intMonedaID OR
								  OCE.moneda_id = $intMonedaID)
							GROUP BY Det.caja_vale_id, Det.tipo_orden_compra, Det.orden_compra_id";

		//Formar consulta
		$queryMovimientos .= $queryMaquinaria;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryDevMaquinaria;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryRefacciones;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryDevRefacciones;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryServicio;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryServicioInterno;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryGeneral;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryEspecial;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryCombustible;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryCartera;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryDescuentos;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryPagos;
    	$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryAnticipos;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryAplicacionAnticipos;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryValesCaja;
		$queryMovimientos .= " ORDER BY fecha, fecha_creacion, folio";

		$strSQL = $this->db->query($queryMovimientos);
		return $strSQL->result();
	}
	
	

	/*Método para regresar el anticipo de las ordenes de compra del proveedor 
	  que coincida con los criterios de búsqueda proporcionados (se utiliza en el reporte de ordenes de compra con adeudos)*/
	public function buscar_anticipo_ordenes_compra_adeudos($strOpcion, $dteFechaInicial, $intProveedorID = NULL, 
														   $intMonedaID = NULL, $dteFechaFinal = NULL, $strTipo = NULL)
	{

		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';

		//Si existe tipo (se considera para regresar el total de anticipos correspondientes al saldo vencido)
		if($strTipo !== NULL)
		{
		   $strRestricciones .= " < '$dteFechaInicial'";
		}
		else if($dteFechaInicial !== NULL AND $dteFechaFinal !== NULL)//Si existe rango de fechas
		{
			$strRestricciones .= " BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'";
		}
		else if($dteFechaInicial !== NULL)//Si existe fecha inicial
		{
			$strRestricciones .= " <= '$dteFechaInicial'";
		}
		else//Si existe fecha final
		{
			$strRestricciones .= " = '$dteFechaFinal'";
		}

		//Si el tipo de opción corresponde al reporte, significa que la información se va a mostrar en un reporte,
		//de lo contrario, se mostrará en el grid view -> Ordenes de compra con adeudo
		if($strOpcion == 'reporte')
		{
		   $strRestricciones .= " AND AP.moneda_id = $intMonedaID";
		}

		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$strSQL = $this->db->query("SELECT AP.moneda_id, AP.tipo_cambio, 
									  (IFNULL(Detalles.Total, 0) -
									   IFNULL(AplicacionAnticipos.Total, 0)) AS importe
							    FROM anticipos_proveedores AS AP
							    LEFT JOIN (SELECT Det.anticipo_proveedor_id AS referenciaID,
							                	  SUM(ROUND((Det.subtotal/Reg.tipo_cambio), 2) + 
															 ROUND((Det.iva/Reg.tipo_cambio), 2) + 
															 ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total
						   				   FROM anticipos_proveedores AS Reg
						   				   INNER JOIN anticipos_proveedores_detalles AS Det ON Reg.anticipo_proveedor_id = Det.anticipo_proveedor_id
							    		   GROUP BY Det.anticipo_proveedor_id) AS Detalles ON Detalles.referenciaID = AP.anticipo_proveedor_id
							    LEFT JOIN (SELECT Reg.anticipo_proveedor_id AS referenciaID,
							                	  SUM(ROUND((Det.importe/AP.tipo_cambio), 2) + 
															 ROUND((Det.iva/AP.tipo_cambio), 2) + 
															 ROUND((Det.ieps/AP.tipo_cambio), 2)) AS Total
						   				   FROM anticipos_proveedores_aplicacion AS Reg
										   INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
						   				   INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
											   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
										   WHERE  Reg.estatus = 'ACTIVO'
										   AND   Reg.fecha $strRestricciones
							    		   GROUP BY Reg.anticipo_proveedor_id) AS AplicacionAnticipos ON AplicacionAnticipos.referenciaID = AP.anticipo_proveedor_id 
							    WHERE AP.fecha $strRestricciones 
							    AND AP.proveedor_id = $intProveedorID
							    AND AP.estatus <> 'INACTIVO'");
		

		return $strSQL->result();
	}



	/*Método para regresar las ordenes de compra del proveedor 
	  que coincidan con los criterios de búsqueda proporcionados*/
	public function buscar_ordenes_compra_importes($strOpcion = NULL, $dteFechaCorte = NULL,
												   $intProveedorID =  NULL, $intMonedaID = NULL, 
												   $intReferenciaID = NULL, $strTipoReferencia = NULL, 
												   $dteFechaInicial = NULL, $intTasaCuotaIva = NULL, 
												   $intTasaCuotaIeps = NULL)
	{

		//Constante para identificar al tipo de movimiento entrada de refacciones por compra
		$intMovRefEntradaCompra = ENTRADA_REFACCIONES_COMPRA;
		//Constante para identificar al tipo de movimiento salida de refacciones por devolución al proveedor
		$intMovRefSalidaDevolucion = SALIDA_REFACCIONES_DEVOLUCION_PROVEEDOR;
		//Constante para identificar al tipo de movimiento salida de maquinaria por devolución al proveedor
		$intMovMaqSalidaDevolucion = SALIDA_MAQUINARIA_DEVOLUCION_PROVEEDOR;

		//Variable que se utiliza para formar la  consulta
		$queryOrdenesCompra = '';

		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		//Proveedor
		$strRestriccionesProveedor = '';
		$strRestriccionesProveedorTF = '';
		//Moneda
		$strRestriccionesMoneda = '';
		//Fecha de corte
		$strRestriccionesRegFecha = '';
		$strRestriccionesCartFecha = '';
		//ID de la referencia (orden de compra)
		$strRestriccionesMaqReferenciaID = '';
		$strRestriccionesRefReferenciaID = '';
		$strRestriccionesServReferenciaID = '';
		$strRestriccionesServIntReferenciaID = '';
		$strRestriccionesGralReferenciaID = '';
		$strRestriccionesEspecReferenciaID = '';
		$strRestriccionesCombReferenciaID = '';
		$strRestriccionesCartReferenciaID = '';
		//ID de la tasa o cuota del impuesto de IVA
		$strRestriccionesDetTasaCuotaIva = '';
	    $strRestriccionesOCDTasaCuotaIva = '';
		//ID de la tasa o cuota del impuesto de IEPS
		$strRestriccionesDetTasaCuotaIeps = '';

		//Variable que se utiliza para ordenar los registros dependiendo del tipo de búsqueda
		$strOrdenamiento = " ORDER BY ";

		//Si existe id del proveedor
		if($intProveedorID > 0)
		{
			$strRestriccionesProveedor .= " AND P.proveedor_id = $intProveedorID";
			$strRestriccionesProveedorTF .= " AND ( P.proveedor_id = $intProveedorID OR  
													PS.proveedor_id = $intProveedorID)"; 
		}

		//Si existe id de la moneda
		if($intMonedaID > 0)
		{
			$strRestriccionesMoneda .= " AND M.moneda_id = $intMonedaID";
		}

		//Si existe fecha de corte
		if($dteFechaCorte !== NULL)
		{
			$strRestriccionesRegFecha .= " AND DATE_FORMAT(Reg.fecha, '%Y-%m-%d') <= '$dteFechaCorte'";
			$strRestriccionesCartFecha .= "Reg.fecha <= '$dteFechaCorte'";
		}

		//Si existe fecha inicial 
		if($dteFechaInicial !== NULL)
		{
			$strRestriccionesRegFecha .= " AND DATE_FORMAT(Reg.fecha, '%Y-%m-%d') < '$dteFechaInicial'";
			$strRestriccionesCartFecha .= "Reg.fecha < '$dteFechaInicial'";
		}

		//Si existe id de la referencia (orden de compra)
		if($intReferenciaID !== NULL)
		{
			$strRestriccionesMaqReferenciaID = " AND Reg.orden_compra_maquinaria_id = $intReferenciaID";
			$strRestriccionesRefReferenciaID = " AND Reg.movimiento_refacciones_id = $intReferenciaID";
		    $strRestriccionesServReferenciaID = " AND Reg.trabajo_foraneo_id = $intReferenciaID";
		    $strRestriccionesServIntReferenciaID = " AND Reg.trabajo_foraneo_interno_id = $intReferenciaID";
		    $strRestriccionesGralReferenciaID = " AND Reg.orden_compra_id = $intReferenciaID";
		    $strRestriccionesEspecReferenciaID = " AND Reg.orden_compra_especial_id = $intReferenciaID";
		    $strRestriccionesCombReferenciaID = " AND Reg.orden_compra_combustible_id = $intReferenciaID";

		    //Si existe restrcción de fecha
			$strRestriccionesCartReferenciaID .= (($strRestriccionesCartFecha !== '') ? 
												    " AND " : '');

		    $strRestriccionesCartReferenciaID .= " Reg.cartera_proveedor_id = $intReferenciaID";

		}


		//Si existe id de la tasa o cuota del impuesto de IVA
		if($intTasaCuotaIva !== NULL)
		{
			$strRestriccionesOCDTasaCuotaIva  .= " WHERE  TIva.tasa_cuota_id = $intTasaCuotaIva";
			$strRestriccionesDetTasaCuotaIva  .= " AND TIva.tasa_cuota_id = $intTasaCuotaIva";

			//Si existe id de la tasa o cuota del impuesto de IEPS
			if($intTasaCuotaIeps !== NULL)
			{

			  	$strRestriccionesDetTasaCuotaIeps  .= " AND TIeps.tasa_cuota_id = $intTasaCuotaIeps";
			}
			else
			{
				$strRestriccionesDetTasaCuotaIeps  .= " AND TIeps.tasa_cuota_id IS NULL";
			}
		}


		//Si el tipo de opción corresponde al reporte, significa que la información se va a mostrar en un reporte
		//de lo contrario se mostrará en el grid view -> Ordenes de compra con adeudo
		if($strOpcion == 'reporte')
		{
			$strOrdenamiento .= "moneda_id, proveedor_id, fecha, folio";

		}
		else 
		{
			$strOrdenamiento .= "fecha, folio";
		}

		//Variables para definir que tipos de módulo se incluiran en la búsqueda
		//Ordenes de compra de maquinaria
		$queryMaquinaria = "SELECT Reg.orden_compra_maquinaria_id AS referencia_id,
								  'MAQUINARIA' AS tipo_referencia, 
								   Reg.folio, Reg.moneda_id, M.codigo AS moneda_tipo,
								   Reg.tipo_cambio,   Reg.fecha, Reg.fecha_vencimiento, 
								   DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
								   DATE_FORMAT(Reg.fecha_vencimiento,'%d/%m/%Y') AS fecha_vencimiento_format,
								   P.proveedor_id, P.codigo, P.razon_social, P.dias_credito,
								   P.limite_credito, 'ORDEN DE COMPRA MAQUINARIA' AS referencia, 
								   CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
								   (MaquinariaDetalles.Subtotal) AS subtotal,
								   (MaquinariaDetalles.IVA) AS iva,
								   (MaquinariaDetalles.IEPS) AS ieps,
								   (MaquinariaDetalles.Total) AS importe,
								   (IFNULL(AplicacionAnticiposMI.Total, 0) +
								   	IFNULL(AplicacionAnticiposMD.Total, 0) +
								    IFNULL(DescuentosMI.Total, 0) +
								    IFNULL(DescuentosMD.Total, 0) +
								    IFNULL(PagosMI.Total, 0) +
								    IFNULL(PagosMD.Total, 0) +
								    IFNULL(ValesCaja.Total, 0) +
								    IFNULL(Devolucion.Total, 0)) AS abonos,
								   ((MaquinariaDetalles.Total) -
								   	IFNULL(AplicacionAnticiposMI.Total, 0) -
								   	IFNULL(AplicacionAnticiposMD.Total, 0) -
								    IFNULL(DescuentosMI.Total, 0) -
								    IFNULL(DescuentosMD.Total, 0) -
								    IFNULL(PagosMI.Total, 0) - 
								    IFNULL(PagosMD.Total, 0) - 
								    IFNULL(ValesCaja.Total, 0) - 
								    IFNULL(Devolucion.Total, 0)) AS saldo, 
								    ((MaquinariaDetalles.Subtotal) -
								     IFNULL(AplicacionAnticiposMI.Subtotal, 0) -
								     IFNULL(AplicacionAnticiposMD.Subtotal, 0) -
								     IFNULL(DescuentosMI.Subtotal, 0) -
								     IFNULL(DescuentosMD.Subtotal, 0) -
								     IFNULL(PagosMI.Subtotal, 0) -
								     IFNULL(PagosMD.Subtotal, 0) -
								     IFNULL(ValesCaja.Subtotal, 0) -
								     IFNULL(Devolucion.Subtotal, 0)) AS saldo_subtotal, 
								    ((MaquinariaDetalles.IVA) -
								   	 IFNULL(AplicacionAnticiposMI.IVA, 0) -
								   	 IFNULL(AplicacionAnticiposMD.IVA, 0) -
								     IFNULL(DescuentosMI.IVA, 0) -
								     IFNULL(DescuentosMD.IVA, 0) -
								     IFNULL(PagosMI.IVA, 0) -
								     IFNULL(PagosMD.IVA, 0) -
								     IFNULL(ValesCaja.IVA, 0) - 
								     IFNULL(Devolucion.IVA, 0)) AS saldo_iva, 
								    ((MaquinariaDetalles.IEPS) -
								   	 IFNULL(AplicacionAnticiposMI.IEPS, 0) -
								   	 IFNULL(AplicacionAnticiposMD.IEPS, 0) -
								     IFNULL(DescuentosMI.IEPS, 0) -
								     IFNULL(DescuentosMD.IEPS, 0) -
								     IFNULL(PagosMI.IEPS, 0) - 
								     IFNULL(PagosMD.IEPS, 0) - 
								     IFNULL(ValesCaja.IEPS, 0) - 
								     IFNULL(Devolucion.IEPS, 0)) AS saldo_ieps 
							FROM  ordenes_compra_maquinaria AS Reg
							INNER JOIN sat_monedas AS M ON Reg.moneda_id = M.moneda_id
							INNER JOIN proveedores AS P ON Reg.proveedor_id = P.proveedor_id
							INNER JOIN (SELECT Det.orden_compra_maquinaria_id AS referenciaID,
											   (SUM((ROUND(((Det.precio_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
										            ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
										            ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2))) -
										            ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS Total, 
										       (SUM(ROUND(((Det.precio_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) -
										            ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS Subtotal,
										       SUM(ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS IVA,
										       SUM(ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS IEPS
										FROM  ordenes_compra_maquinaria AS Reg 
										INNER JOIN ordenes_compra_maquinaria_detalles AS Det ON Reg.orden_compra_maquinaria_id = Det.orden_compra_maquinaria_id
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						  			    $strRestriccionesOCDTasaCuotaIva
						  			    $strRestriccionesDetTasaCuotaIeps
										GROUP BY Det.orden_compra_maquinaria_id   
									   ) AS MaquinariaDetalles ON MaquinariaDetalles.referenciaID = Reg.orden_compra_maquinaria_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/AP.tipo_cambio), 2) + 
												   ROUND((Det.iva/AP.tipo_cambio), 2) + 
												   ROUND((Det.ieps/AP.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/AP.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/AP.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/AP.tipo_cambio), 2)) AS IEPS
									   FROM anticipos_proveedores_aplicacion AS Reg
									   INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
									   INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
												   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
									    	AND Det.referencia = 'MAQUINARIA'
									   INNER JOIN ordenes_compra_maquinaria AS OCM ON Det.referencia_id = OCM.orden_compra_maquinaria_id
									   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE  Reg.estatus = 'ACTIVO'
									   AND AP.moneda_id = OCM.moneda_id
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
									   GROUP BY Det.referencia_id) AS  AplicacionAnticiposMI ON AplicacionAnticiposMI.referenciaID = Reg.orden_compra_maquinaria_id 
						     LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											   SUM(ROUND((Det.importe/OCM.tipo_cambio), 2) + 
												   ROUND((Det.iva/OCM.tipo_cambio), 2) + 
												   ROUND((Det.ieps/OCM.tipo_cambio), 2)) AS Total, 
											   SUM(ROUND((Det.importe/OCM.tipo_cambio), 2)) AS Subtotal,
											   SUM(ROUND((Det.iva/OCM.tipo_cambio), 2)) AS IVA,
											   SUM(ROUND((Det.ieps/OCM.tipo_cambio), 2)) AS IEPS
									   FROM anticipos_proveedores_aplicacion AS Reg
									   INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
									   INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
												   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
									    	AND Det.referencia = 'MAQUINARIA'
									   INNER JOIN ordenes_compra_maquinaria AS OCM ON Det.referencia_id = OCM.orden_compra_maquinaria_id
									   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE  Reg.estatus = 'ACTIVO'
									   AND AP.moneda_id <> OCM.moneda_id
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
									   GROUP BY Det.referencia_id) AS  AplicacionAnticiposMD ON AplicacionAnticiposMD.referenciaID = Reg.orden_compra_maquinaria_id 
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
												  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
												  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
						    		   FROM descuentos_proveedores AS Reg
						    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
						    		   		 AND Det.referencia = 'MAQUINARIA'
						    		   INNER JOIN ordenes_compra_maquinaria AS OCM ON Det.referencia_id = OCM.orden_compra_maquinaria_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		   WHERE   Reg.estatus = 'ACTIVO'
						    		   AND Reg.moneda_id = OCM.moneda_id
						    		   $strRestriccionesRegFecha
						    		   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS DescuentosMI ON DescuentosMI.referenciaID = Reg.orden_compra_maquinaria_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/OCM.tipo_cambio), 2) + 
												  ROUND((Det.iva/OCM.tipo_cambio), 2) + 
												  ROUND((Det.ieps/OCM.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/OCM.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/OCM.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/OCM.tipo_cambio), 2)) AS IEPS
						    		   FROM descuentos_proveedores AS Reg
						    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
						    		   		 AND Det.referencia = 'MAQUINARIA'
						    		   INNER JOIN ordenes_compra_maquinaria AS OCM ON Det.referencia_id = OCM.orden_compra_maquinaria_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		   WHERE   Reg.estatus = 'ACTIVO'
						    		   AND Reg.moneda_id <> OCM.moneda_id
						    		   $strRestriccionesRegFecha
						    		   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS DescuentosMD ON DescuentosMD.referenciaID = Reg.orden_compra_maquinaria_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
												  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
												  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
						    		   FROM pagos_proveedores AS Reg
						    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
						    		  		AND Det.referencia = 'MAQUINARIA'
						    		   INNER JOIN ordenes_compra_maquinaria AS OCM ON Det.referencia_id = OCM.orden_compra_maquinaria_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE  Reg.estatus = 'ACTIVO'
									   AND Reg.moneda_id = OCM.moneda_id
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.referencia_id) AS PagosMI ON PagosMI.referenciaID = Reg.orden_compra_maquinaria_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/OCM.tipo_cambio), 2) + 
												  ROUND((Det.iva/OCM.tipo_cambio), 2) + 
												  ROUND((Det.ieps/OCM.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/OCM.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/OCM.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/OCM.tipo_cambio), 2)) AS IEPS
						    		   FROM pagos_proveedores AS Reg
						    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
						    		  		AND Det.referencia = 'MAQUINARIA'
						    		   INNER JOIN ordenes_compra_maquinaria AS OCM ON Det.referencia_id = OCM.orden_compra_maquinaria_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE  Reg.estatus = 'ACTIVO'
									   AND Reg.moneda_id <> OCM.moneda_id
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.referencia_id) AS PagosMD ON PagosMD.referenciaID = Reg.orden_compra_maquinaria_id
						    LEFT JOIN (SELECT Det.orden_compra_id AS referenciaID,
											  SUM(ROUND((Det.subtotal/OCM.tipo_cambio), 2) + 
												  ROUND((Det.iva/OCM.tipo_cambio), 2) + 
											      ROUND((Det.ieps/OCM.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.subtotal/OCM.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/OCM.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/OCM.tipo_cambio), 2)) AS IEPS
						    		   FROM cajas_vales AS Reg
						    		   INNER JOIN cajas_vales_detalles AS Det ON Reg.caja_vale_id = Det.caja_vale_id
						    		  		AND Det.tipo_orden_compra = 'MAQUINARIA'
						    		   INNER JOIN ordenes_compra_maquinaria AS OCM ON Det.orden_compra_id = OCM.orden_compra_maquinaria_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE  (Reg.estatus = 'AUTORIZADO' OR Reg.estatus = 'CERRADO')
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.orden_compra_id) AS ValesCaja ON ValesCaja.referenciaID = Reg.orden_compra_maquinaria_id
						    LEFT JOIN (SELECT Det.orden_compra_maquinaria_id AS referenciaID,
							    		  	  SUM(ROUND((Det.precio_unitario/OCM.tipo_cambio), 2) + 
											  	  ROUND((Det.iva_unitario/OCM.tipo_cambio), 2) + 
											 	  ROUND((Det.ieps_unitario/OCM.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.precio_unitario/OCM.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva_unitario/OCM.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps_unitario/OCM.tipo_cambio), 2)) AS IEPS	
									   FROM movimientos_maquinaria AS Reg 
									   INNER JOIN movimientos_maquinaria AS MME ON Reg.referencia_id = MME.movimiento_maquinaria_id 
									   INNER JOIN ordenes_compra_maquinaria AS OCM ON MME.referencia_id = OCM.orden_compra_maquinaria_id
									   INNER JOIN movimientos_maquinaria_detalles AS MMDS ON Reg.movimiento_maquinaria_id = MMDS.movimiento_maquinaria_id
									   INNER JOIN movimientos_maquinaria_detalles AS MMDE ON MME.movimiento_maquinaria_id = MMDE.movimiento_maquinaria_id
											  AND MMDS.serie = MMDE.serie AND  MMDS.maquinaria_descripcion_id = MMDE.maquinaria_descripcion_id	
									   INNER JOIN ordenes_compra_maquinaria_detalles AS Det ON OCM.orden_compra_maquinaria_id = Det.orden_compra_maquinaria_id  
										      AND MMDE.maquinaria_descripcion_id = Det.maquinaria_descripcion_id
							    	   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
							    	   WHERE Reg.tipo_movimiento = $intMovMaqSalidaDevolucion
							    	   AND Reg.estatus = 'ACTIVO' 
							    	   $strRestriccionesRegFecha
					   				   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
							    	   GROUP BY Det.orden_compra_maquinaria_id) AS Devolucion ON Devolucion.referenciaID = Reg.orden_compra_maquinaria_id
						    WHERE (Reg.estatus = 'AUTORIZADO' OR Reg.estatus = 'SURTIDO')
						    $strRestriccionesRegFecha 
						    $strRestriccionesMaqReferenciaID
						    $strRestriccionesMoneda
							$strRestriccionesProveedor";

	    //Entradas de refacciones por compra
		$queryRefacciones = "SELECT Reg.movimiento_refacciones_id AS referencia_id,
									'REFACCIONES' AS tipo_referencia, 
								     Reg.folio, Reg.moneda_id,  
								     M.codigo AS moneda_tipo, Reg.tipo_cambio,
								     Reg.fecha, 
								     ADDDATE(Reg.fecha, INTERVAL P.dias_credito DAY) AS fecha_vencimiento,
								     DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
									 DATE_FORMAT(ADDDATE(Reg.fecha, INTERVAL P.dias_credito DAY),'%d/%m/%Y') AS fecha_vencimiento_format,
								     P.proveedor_id, P.codigo, P.razon_social, P.dias_credito, 
								     P.limite_credito,  'ENTRADAS POR COMPRA REFACCIONES' AS referencia,  
									 CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
									 (RefaccionesDetalles.Subtotal) AS subtotal,
									 (RefaccionesDetalles.IVA) AS iva,
									 (RefaccionesDetalles.IEPS) AS ieps,
									 (RefaccionesDetalles.Total) AS importe,
									 (IFNULL(AplicacionAnticiposMI.Total, 0) +
									  IFNULL(AplicacionAnticiposMD.Total, 0) +
								   	  IFNULL(DescuentosMI.Total, 0) +
								   	  IFNULL(DescuentosMD.Total, 0) +
								   	  IFNULL(PagosMI.Total, 0) +
								   	  IFNULL(PagosMD.Total, 0) +
								   	  IFNULL(ValesCaja.Total, 0) +
								   	  IFNULL(Devolucion.Total, 0)) AS abonos,
						             ((RefaccionesDetalles.Total) -
								   	   IFNULL(AplicacionAnticiposMI.Total, 0) -
								   	   IFNULL(AplicacionAnticiposMD.Total, 0) -
								   	   IFNULL(DescuentosMI.Total, 0) -
								   	   IFNULL(DescuentosMD.Total, 0) -
								   	   IFNULL(PagosMI.Total, 0) -
								   	   IFNULL(PagosMD.Total, 0) -
								   	   IFNULL(ValesCaja.Total, 0) -
								   	   IFNULL(Devolucion.Total, 0)) AS saldo,
								   	 ((RefaccionesDetalles.Subtotal) -
								   	   IFNULL(AplicacionAnticiposMI.Subtotal, 0) -
								   	   IFNULL(AplicacionAnticiposMD.Subtotal, 0) -
								   	   IFNULL(DescuentosMI.Subtotal, 0) -
								   	   IFNULL(DescuentosMD.Subtotal, 0) -
								   	   IFNULL(PagosMI.Subtotal, 0) -
								   	   IFNULL(PagosMD.Subtotal, 0) -
								   	   IFNULL(ValesCaja.Subtotal, 0) -
								   	   IFNULL(Devolucion.Subtotal, 0)) AS saldo_subtotal,
								   	 ((RefaccionesDetalles.IVA) -
								   	   IFNULL(AplicacionAnticiposMI.IVA, 0) -
								   	   IFNULL(AplicacionAnticiposMD.IVA, 0) -
								   	   IFNULL(DescuentosMI.IVA, 0) -
								   	   IFNULL(DescuentosMD.IVA, 0) -
								   	   IFNULL(PagosMI.IVA, 0) - 
								   	   IFNULL(PagosMD.IVA, 0) - 
								   	   IFNULL(ValesCaja.IVA, 0) -
								   	   IFNULL(Devolucion.IVA, 0)) AS saldo_iva,
								   	 ((RefaccionesDetalles.IEPS) -
								   	   IFNULL(AplicacionAnticiposMI.IEPS, 0) -
								   	   IFNULL(AplicacionAnticiposMD.IEPS, 0) -
								   	   IFNULL(DescuentosMI.IEPS, 0) -
								   	   IFNULL(DescuentosMD.IEPS, 0) -
								   	   IFNULL(PagosMI.IEPS, 0) -
								   	   IFNULL(PagosMD.IEPS, 0) - 
								   	   IFNULL(ValesCaja.IEPS, 0) -
								   	   IFNULL(Devolucion.IEPS, 0)) AS saldo_ieps
							FROM  movimientos_refacciones AS Reg
							INNER JOIN sat_monedas AS M ON Reg.moneda_id = M.moneda_id
							INNER JOIN proveedores AS P ON Reg.proveedor_id = P.proveedor_id
							INNER JOIN (SELECT Det.movimiento_refacciones_id AS referenciaID,
											   (SUM((ROUND(((Det.costo_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
										               ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
										               ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2))) -
										               ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2))  AS Total, 
										       (SUM(ROUND(((Det.costo_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) -
										           ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS Subtotal,
										       SUM(ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS IVA,
										       SUM(ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS IEPS
										FROM  movimientos_refacciones AS Reg
										INNER JOIN movimientos_refacciones_detalles AS Det ON Reg.movimiento_refacciones_id = Det.movimiento_refacciones_id
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						  				$strRestriccionesOCDTasaCuotaIva
						  				$strRestriccionesDetTasaCuotaIeps
										GROUP BY Det.movimiento_refacciones_id   
									   ) AS RefaccionesDetalles ON RefaccionesDetalles.referenciaID = Reg.movimiento_refacciones_id
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/AP.tipo_cambio), 2) + 
												  ROUND((Det.iva/AP.tipo_cambio), 2) + 
												  ROUND((Det.ieps/AP.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/AP.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/AP.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/AP.tipo_cambio), 2)) AS IEPS
										FROM anticipos_proveedores_aplicacion AS Reg
										INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
										INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
												   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
									   		   AND Det.referencia = 'REFACCIONES'
									   	INNER JOIN  movimientos_refacciones AS MR ON Det.referencia_id = MR.movimiento_refacciones_id
									    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					   				    AND AP.moneda_id = MR.moneda_id
									    WHERE  Reg.estatus = 'ACTIVO'
									    $strRestriccionesRegFecha
									    $strRestriccionesDetTasaCuotaIva
									    $strRestriccionesDetTasaCuotaIeps
									   	GROUP BY Det.referencia_id) AS  AplicacionAnticiposMI ON AplicacionAnticiposMI.referenciaID = Reg.movimiento_refacciones_id 
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/MR.tipo_cambio), 2) + 
												  ROUND((Det.iva/MR.tipo_cambio), 2) + 
												  ROUND((Det.ieps/MR.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/MR.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/MR.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/MR.tipo_cambio), 2)) AS IEPS
										FROM anticipos_proveedores_aplicacion AS Reg
										INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
										INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
												   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
									   		   AND Det.referencia = 'REFACCIONES'
									   	INNER JOIN  movimientos_refacciones AS MR ON Det.referencia_id = MR.movimiento_refacciones_id
									    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
					   				    AND AP.moneda_id <> MR.moneda_id
									    WHERE  Reg.estatus = 'ACTIVO'
									    $strRestriccionesRegFecha
									    $strRestriccionesDetTasaCuotaIva
									    $strRestriccionesDetTasaCuotaIeps
									   	GROUP BY Det.referencia_id) AS  AplicacionAnticiposMD ON AplicacionAnticiposMD.referenciaID = Reg.movimiento_refacciones_id 
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
												  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
												  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
						    		   FROM descuentos_proveedores AS Reg
						    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
						    		   		 AND Det.referencia = 'REFACCIONES'
						    		   INNER JOIN  movimientos_refacciones AS MR ON Det.referencia_id = MR.movimiento_refacciones_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		   WHERE Reg.estatus = 'ACTIVO'
						    		   AND Reg.moneda_id = MR.moneda_id
						    		   $strRestriccionesRegFecha
						    		   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS DescuentosMI ON DescuentosMI.referenciaID = Reg.movimiento_refacciones_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/MR.tipo_cambio), 2) + 
												  ROUND((Det.iva/MR.tipo_cambio), 2) + 
												  ROUND((Det.ieps/MR.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/MR.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/MR.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/MR.tipo_cambio), 2)) AS IEPS
						    		   FROM descuentos_proveedores AS Reg
						    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
						    		   		 AND Det.referencia = 'REFACCIONES'
						    		   INNER JOIN  movimientos_refacciones AS MR ON Det.referencia_id = MR.movimiento_refacciones_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		   WHERE Reg.estatus = 'ACTIVO'
						    		   AND Reg.moneda_id <> MR.moneda_id
						    		   $strRestriccionesRegFecha
						    		   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS DescuentosMD ON DescuentosMD.referenciaID = Reg.movimiento_refacciones_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
												  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
												  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
						    		   FROM pagos_proveedores AS Reg
						    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
						    		   		 AND Det.referencia = 'REFACCIONES'
						    		   INNER JOIN  movimientos_refacciones AS MR ON Det.referencia_id = MR.movimiento_refacciones_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE Reg.estatus = 'ACTIVO'
									   AND Reg.moneda_id = MR.moneda_id
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.referencia_id) AS PagosMI ON PagosMI.referenciaID = Reg.movimiento_refacciones_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/MR.tipo_cambio), 2) + 
												  ROUND((Det.iva/MR.tipo_cambio), 2) + 
												  ROUND((Det.ieps/MR.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/MR.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/MR.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/MR.tipo_cambio), 2)) AS IEPS
						    		   FROM pagos_proveedores AS Reg
						    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
						    		   		 AND Det.referencia = 'REFACCIONES'
						    		   INNER JOIN  movimientos_refacciones AS MR ON Det.referencia_id = MR.movimiento_refacciones_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE Reg.estatus = 'ACTIVO'
									   AND Reg.moneda_id <> MR.moneda_id
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.referencia_id) AS PagosMD ON PagosMD.referenciaID = Reg.movimiento_refacciones_id
					        LEFT JOIN (SELECT Det.orden_compra_id AS referenciaID,
										      SUM(ROUND((Det.subtotal/MR.tipo_cambio), 2) + 
												  ROUND((Det.iva/MR.tipo_cambio), 2) + 
											      ROUND((Det.ieps/MR.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.subtotal/MR.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/MR.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/MR.tipo_cambio), 2)) AS IEPS
						    		   FROM cajas_vales AS Reg
						    		   INNER JOIN cajas_vales_detalles AS Det ON Reg.caja_vale_id = Det.caja_vale_id
						    		  		AND Det.tipo_orden_compra = 'REFACCIONES'
						    		   INNER JOIN  movimientos_refacciones AS MR ON Det.orden_compra_id = MR.movimiento_refacciones_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE  (Reg.estatus = 'AUTORIZADO' OR Reg.estatus = 'CERRADO')
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.orden_compra_id) AS ValesCaja ON ValesCaja.referenciaID = Reg.movimiento_refacciones_id
						    LEFT JOIN (SELECT MRE.movimiento_refacciones_id AS referenciaID,
											  SUM((ROUND(((Det.costo_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
										           ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
										           ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2))) AS Total, 
										       SUM(ROUND(((Det.costo_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS Subtotal,
										       SUM(ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS IVA,
										       SUM(ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS IEPS
										FROM  movimientos_refacciones AS Reg
										INNER JOIN movimientos_refacciones AS MRE ON Reg.referencia_id = MRE.movimiento_refacciones_id
										INNER JOIN movimientos_refacciones_detalles AS Det ON Reg.movimiento_refacciones_id = Det.movimiento_refacciones_id
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						  				WHERE Reg.tipo_movimiento = $intMovRefSalidaDevolucion
						  				AND Reg.estatus = 'ACTIVO'
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
									  GROUP BY MRE.movimiento_refacciones_id) AS Devolucion ON Devolucion.referenciaID = Reg.movimiento_refacciones_id
						    WHERE Reg.tipo_movimiento = $intMovRefEntradaCompra
						    AND Reg.estatus = 'ACTIVO'
						    $strRestriccionesRegFecha  
						    $strRestriccionesRefReferenciaID
						    $strRestriccionesMoneda
							$strRestriccionesProveedor";


		//Ordenes de compra de servicio (trabajos foráneos)
		$queryServicio = "SELECT Reg.trabajo_foraneo_id AS referencia_id, 
								  'SERVICIO' AS tipo_referencia, 
								  Reg.folio, Reg.moneda_id, M.codigo AS moneda_tipo, Reg.tipo_cambio,
								  Reg.fecha, Reg.fecha AS fecha_vencimiento, 
								  DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
								  DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_vencimiento_format,
								   CASE 
									   WHEN  OC.orden_compra_id > 0 
									   		THEN  P.proveedor_id
										    ELSE PS.proveedor_id
								   END AS proveedor_id,
								   CASE 
									   WHEN  OC.orden_compra_id > 0 
									   		THEN  P.codigo
										    ELSE PS.codigo
								   END AS codigo,
								   CASE 
									   WHEN  OC.orden_compra_id > 0 
									   		THEN  P.razon_social
										    ELSE PS.razon_social
								   END AS razon_social,
								   CASE 
									   WHEN  OC.orden_compra_id > 0 
									   		THEN  P.dias_credito
										    ELSE PS.dias_credito
								   END AS dias_credito,
								   CASE 
									   WHEN  OC.orden_compra_id > 0 
									   		THEN  P.limite_credito
										    ELSE PS.limite_credito
								   END AS limite_credito,
								  'ORDEN DE COMPRA SERVICIO' AS referencia, 
							 	  CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
							 	  (TFDetalles.Subtotal) AS subtotal,
								  (TFDetalles.IVA) AS iva,
								  (TFDetalles.IEPS) AS ieps,
							      (TFDetalles.Total) AS importe,
							      (IFNULL(AplicacionAnticiposMI.Total, 0) +
							       IFNULL(AplicacionAnticiposMD.Total, 0) +
					   			   IFNULL(DescuentosMI.Total, 0) +
					   			   IFNULL(DescuentosMD.Total, 0) +
					   			   IFNULL(PagosMI.Total, 0) +
					   			   IFNULL(PagosMD.Total, 0) +
					   			   IFNULL(ValesCaja.Total, 0)) AS abonos,
					   			  ((TFDetalles.Total) -
					   			    IFNULL(AplicacionAnticiposMI.Total, 0) -
					   			    IFNULL(AplicacionAnticiposMD.Total, 0) -
					   			    IFNULL(DescuentosMI.Total, 0) -
					   			    IFNULL(DescuentosMD.Total, 0) -
					   			    IFNULL(PagosMI.Total, 0) -
					   			    IFNULL(PagosMD.Total, 0) -
					   			    IFNULL(ValesCaja.Total, 0)) AS saldo,
					   			  ((TFDetalles.Subtotal) -
					   			    IFNULL(AplicacionAnticiposMI.Subtotal, 0) -
					   			    IFNULL(AplicacionAnticiposMD.Subtotal, 0) -
					   			    IFNULL(DescuentosMI.Subtotal, 0) -
					   			    IFNULL(DescuentosMD.Subtotal, 0) -
					   			    IFNULL(PagosMI.Subtotal, 0) -
					   			    IFNULL(PagosMD.Subtotal, 0) -
					   			    IFNULL(ValesCaja.Subtotal, 0)) AS saldo_subtotal,
					   			  ((TFDetalles.IVA) -
					   			    IFNULL(AplicacionAnticiposMI.IVA, 0) -
					   			    IFNULL(AplicacionAnticiposMD.IVA, 0) -
					   			    IFNULL(DescuentosMI.IVA, 0) -
					   			    IFNULL(DescuentosMD.IVA, 0) -
					   			    IFNULL(PagosMI.IVA, 0) -
					   			    IFNULL(PagosMD.IVA, 0) -
					   			    IFNULL(ValesCaja.IVA, 0)) AS saldo_iva, 
					   			  ((TFDetalles.IEPS) -
					   			    IFNULL(AplicacionAnticiposMI.IEPS, 0) -
					   			    IFNULL(AplicacionAnticiposMD.IEPS, 0) -
					   			    IFNULL(DescuentosMI.IEPS, 0) -
					   			    IFNULL(DescuentosMD.IEPS, 0) -
					   			    IFNULL(PagosMI.IEPS, 0) -
					   			    IFNULL(PagosMD.IEPS, 0) -
					   			    IFNULL(ValesCaja.IEPS, 0)) AS saldo_ieps 
							FROM trabajos_foraneos_02 AS Reg
							INNER JOIN sat_monedas AS M ON Reg.moneda_id = M.moneda_id
							INNER JOIN (SELECT Det.trabajo_foraneo_id AS referenciaID,
									           (SUM((ROUND(((Det.costo_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
								               	    ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
								                    ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2))) -
								                    ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS Total, 
									           (SUM(ROUND(((Det.costo_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) -
									           	    ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS Subtotal,
									           SUM(ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS IVA,
									           SUM(ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS IEPS
										FROM trabajos_foraneos_02 AS Reg
										INNER JOIN trabajos_foraneos_detalles AS Det ON Reg.trabajo_foraneo_id = Det.trabajo_foraneo_id
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						  				$strRestriccionesOCDTasaCuotaIva
						  				$strRestriccionesDetTasaCuotaIeps
										GROUP BY Det.trabajo_foraneo_id   
									   ) AS TFDetalles ON TFDetalles.referenciaID = Reg.trabajo_foraneo_id
							LEFT JOIN ordenes_compra AS OC ON Reg.orden_compra_id = OC.orden_compra_id
								 AND Reg.tipo_referencia = 'GENERAL'
							LEFT JOIN proveedores AS P ON OC.proveedor_id = P.proveedor_id
							LEFT JOIN ordenes_compra_servicio AS OCS ON Reg.orden_compra_id = OCS.orden_compra_servicio_id
							AND Reg.tipo_referencia = 'SERVICIO'
							LEFT JOIN proveedores AS PS ON OCS.proveedor_id = PS.proveedor_id
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/AP.tipo_cambio), 2) + 
												  ROUND((Det.iva/AP.tipo_cambio), 2) + 
												  ROUND((Det.ieps/AP.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/AP.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/AP.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/AP.tipo_cambio), 2)) AS IEPS
										FROM anticipos_proveedores_aplicacion AS Reg
										INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
										INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
												   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
									    	  AND Det.referencia = 'SERVICIO'
									    INNER JOIN trabajos_foraneos_02 AS TF ON Det.referencia_id = TF.trabajo_foraneo_id
									    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Reg.estatus = 'ACTIVO'
									    AND AP.moneda_id = TF.moneda_id
									    $strRestriccionesRegFecha
									    $strRestriccionesDetTasaCuotaIva
									    $strRestriccionesDetTasaCuotaIeps
									   	GROUP BY Det.referencia_id) AS  AplicacionAnticiposMI ON AplicacionAnticiposMI.referenciaID = Reg.trabajo_foraneo_id
						   LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/TF.tipo_cambio), 2) + 
												  ROUND((Det.iva/TF.tipo_cambio), 2) + 
												  ROUND((Det.ieps/TF.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/TF.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/TF.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/TF.tipo_cambio), 2)) AS IEPS
										FROM anticipos_proveedores_aplicacion AS Reg
										INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
										INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
												   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
									    	  AND Det.referencia = 'SERVICIO'
									    INNER JOIN trabajos_foraneos_02 AS TF ON Det.referencia_id = TF.trabajo_foraneo_id
									    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Reg.estatus = 'ACTIVO'
									    AND AP.moneda_id <> TF.moneda_id
									    $strRestriccionesRegFecha
									    $strRestriccionesDetTasaCuotaIva
									    $strRestriccionesDetTasaCuotaIeps
									   	GROUP BY Det.referencia_id) AS  AplicacionAnticiposMD ON AplicacionAnticiposMD.referenciaID = Reg.trabajo_foraneo_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
												  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
												  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
						    		   FROM descuentos_proveedores AS Reg
						    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
						    		   		 AND Det.referencia = 'SERVICIO'
						    		   INNER JOIN trabajos_foraneos_02 AS TF ON Det.referencia_id = TF.trabajo_foraneo_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		   WHERE Reg.estatus = 'ACTIVO'
						    		   AND Reg.moneda_id = TF.moneda_id
						    		   $strRestriccionesRegFecha
						    		   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS DescuentosMI ON DescuentosMI.referenciaID =Reg.trabajo_foraneo_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/TF.tipo_cambio), 2) + 
												  ROUND((Det.iva/TF.tipo_cambio), 2) + 
												  ROUND((Det.ieps/TF.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/TF.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/TF.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/TF.tipo_cambio), 2)) AS IEPS
						    		   FROM descuentos_proveedores AS Reg
						    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
						    		   		 AND Det.referencia = 'SERVICIO'
						    		   INNER JOIN trabajos_foraneos_02 AS TF ON Det.referencia_id = TF.trabajo_foraneo_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		   WHERE Reg.estatus = 'ACTIVO'
						    		   AND Reg.moneda_id <> TF.moneda_id
						    		   $strRestriccionesRegFecha
						    		   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS DescuentosMD ON DescuentosMD.referenciaID =Reg.trabajo_foraneo_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
												  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
												  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
						    		   FROM pagos_proveedores AS Reg
						    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
						    		   		AND Det.referencia = 'SERVICIO'
						    		   INNER JOIN trabajos_foraneos_02 AS TF ON Det.referencia_id = TF.trabajo_foraneo_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE Reg.estatus = 'ACTIVO'
									   AND Reg.moneda_id = TF.moneda_id
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.referencia_id) AS PagosMI ON PagosMI.referenciaID = Reg.trabajo_foraneo_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/TF.tipo_cambio), 2) + 
												  ROUND((Det.iva/TF.tipo_cambio), 2) + 
												  ROUND((Det.ieps/TF.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/TF.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/TF.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/TF.tipo_cambio), 2)) AS IEPS
						    		   FROM pagos_proveedores AS Reg
						    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
						    		   		AND Det.referencia = 'SERVICIO'
						    		   INNER JOIN trabajos_foraneos_02 AS TF ON Det.referencia_id = TF.trabajo_foraneo_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE Reg.estatus = 'ACTIVO'
									   AND Reg.moneda_id <> TF.moneda_id
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.referencia_id) AS PagosMD ON PagosMD.referenciaID = Reg.trabajo_foraneo_id
						    LEFT JOIN (SELECT Det.orden_compra_id AS referenciaID,
										  	  SUM(ROUND((Det.subtotal/TF.tipo_cambio), 2) + 
												  ROUND((Det.iva/TF.tipo_cambio), 2) + 
											      ROUND((Det.ieps/TF.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.subtotal/TF.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/TF.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/TF.tipo_cambio), 2)) AS IEPS
						    		   FROM cajas_vales AS Reg
						    		   INNER JOIN cajas_vales_detalles AS Det ON Reg.caja_vale_id = Det.caja_vale_id
						    		  		AND Det.tipo_orden_compra = 'SERVICIO'
						    		   INNER JOIN trabajos_foraneos_02 AS TF ON Det.orden_compra_id = TF.trabajo_foraneo_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE  (Reg.estatus = 'AUTORIZADO' OR Reg.estatus = 'CERRADO')
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.orden_compra_id) AS ValesCaja ON ValesCaja.referenciaID = Reg.trabajo_foraneo_id
						    WHERE Reg.estatus = 'ACTIVO'
						    $strRestriccionesRegFecha 
						    $strRestriccionesServReferenciaID
						    $strRestriccionesMoneda
							$strRestriccionesProveedorTF";


	    //Ordenes de compra de servicio interno  (trabajos foráneos internos)
		$queryServicioInterno = "SELECT Reg.trabajo_foraneo_interno_id AS referencia_id, 
									  'SERVICIO INTERNO' AS tipo_referencia, 
									  Reg.folio, Reg.moneda_id, M.codigo AS moneda_tipo, Reg.tipo_cambio,
									  Reg.fecha, Reg.fecha AS fecha_vencimiento, 
									  DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
									  DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_vencimiento_format,
									  P.proveedor_id, P.codigo, P.razon_social, P.dias_credito, 
									  P.limite_credito, 'ORDEN DE COMPRA SERVICIO INTERNO' AS referencia, 
								 	  CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
								 	  (TFIDetalles.Subtotal) AS subtotal,
									  (TFIDetalles.IVA) AS iva,
									  (TFIDetalles.IEPS) AS ieps,
								      (TFIDetalles.Total) AS importe,
								      (IFNULL(AplicacionAnticiposMI.Total, 0) +
								       IFNULL(AplicacionAnticiposMD.Total, 0) +
						   			   IFNULL(DescuentosMI.Total, 0) +
						   			   IFNULL(DescuentosMD.Total, 0) +
						   			   IFNULL(PagosMI.Total, 0) +
						   			   IFNULL(PagosMD.Total, 0) +
						   			   IFNULL(ValesCaja.Total, 0)) AS abonos,
						   			  ((TFIDetalles.Total) -
						   			    IFNULL(AplicacionAnticiposMI.Total, 0) -
						   			    IFNULL(AplicacionAnticiposMD.Total, 0) -
						   			    IFNULL(DescuentosMI.Total, 0) -
						   			    IFNULL(DescuentosMD.Total, 0) -
						   			    IFNULL(PagosMI.Total, 0) -
						   			    IFNULL(PagosMD.Total, 0) -
						   			    IFNULL(ValesCaja.Total, 0)) AS saldo,
						   			  ((TFIDetalles.Subtotal) -
						   			    IFNULL(AplicacionAnticiposMI.Subtotal, 0) -
						   			    IFNULL(AplicacionAnticiposMD.Subtotal, 0) -
						   			    IFNULL(DescuentosMI.Subtotal, 0) -
						   			    IFNULL(DescuentosMD.Subtotal, 0) -
						   			    IFNULL(PagosMI.Subtotal, 0) -
						   			    IFNULL(PagosMD.Subtotal, 0) -
						   			    IFNULL(ValesCaja.Subtotal, 0)) AS saldo_subtotal,
						   			  ((TFIDetalles.IVA) -
						   			    IFNULL(AplicacionAnticiposMI.IVA, 0) -
						   			    IFNULL(AplicacionAnticiposMD.IVA, 0) -
						   			    IFNULL(DescuentosMI.IVA, 0) -
						   			    IFNULL(DescuentosMD.IVA, 0) -
						   			    IFNULL(PagosMI.IVA, 0) -
						   			    IFNULL(PagosMD.IVA, 0) -
						   			    IFNULL(ValesCaja.IVA, 0)) AS saldo_iva, 
						   			  ((TFIDetalles.IEPS) -
						   			    IFNULL(AplicacionAnticiposMI.IEPS, 0) -
						   			    IFNULL(AplicacionAnticiposMD.IEPS, 0) -
						   			    IFNULL(DescuentosMI.IEPS, 0) -
						   			    IFNULL(DescuentosMD.IEPS, 0) -
						   			    IFNULL(PagosMI.IEPS, 0) -
						   			    IFNULL(PagosMD.IEPS, 0) -
						   			    IFNULL(ValesCaja.IEPS, 0)) AS saldo_ieps 
								FROM trabajos_foraneos_internos AS Reg
								INNER JOIN sat_monedas AS M ON Reg.moneda_id = M.moneda_id
								INNER JOIN ordenes_compra AS OC ON Reg.orden_compra_id = OC.orden_compra_id
								INNER JOIN proveedores AS P ON OC.proveedor_id = P.proveedor_id
								INNER JOIN (SELECT Det.trabajo_foraneo_interno_id AS referenciaID,
										           (SUM((ROUND(((Det.costo_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
									               	    ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
									                    ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2))) -
									                    ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS Total, 
										           (SUM(ROUND(((Det.costo_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) -
										             ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS Subtotal,
										           SUM(ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS IVA,
										           SUM(ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS IEPS
											FROM trabajos_foraneos_internos AS Reg
											INNER JOIN trabajos_foraneos_internos_detalles AS Det ON Reg.trabajo_foraneo_interno_id = Det.trabajo_foraneo_interno_id
											INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
						   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
							  				$strRestriccionesOCDTasaCuotaIva
							  				$strRestriccionesDetTasaCuotaIeps
											GROUP BY Det.trabajo_foraneo_interno_id   
										   ) AS TFIDetalles ON TFIDetalles.referenciaID = Reg.trabajo_foraneo_interno_id
								LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
												  SUM(ROUND((Det.importe/AP.tipo_cambio), 2) + 
													  ROUND((Det.iva/AP.tipo_cambio), 2) + 
													  ROUND((Det.ieps/AP.tipo_cambio), 2)) AS Total, 
												  SUM(ROUND((Det.importe/AP.tipo_cambio), 2)) AS Subtotal,
												  SUM(ROUND((Det.iva/AP.tipo_cambio), 2)) AS IVA,
												  SUM(ROUND((Det.ieps/AP.tipo_cambio), 2)) AS IEPS
											FROM anticipos_proveedores_aplicacion AS Reg
											INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
											INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
													   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
										    	  AND Det.referencia = 'SERVICIO INTERNO'
										    INNER JOIN trabajos_foraneos_internos AS TFI ON Det.referencia_id = TFI.trabajo_foraneo_interno_id
										    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
						   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
										    WHERE Reg.estatus = 'ACTIVO'
										    AND AP.moneda_id = TFI.moneda_id
										    $strRestriccionesRegFecha
										    $strRestriccionesDetTasaCuotaIva
										    $strRestriccionesDetTasaCuotaIeps
										   	GROUP BY Det.referencia_id) AS  AplicacionAnticiposMI ON AplicacionAnticiposMI.referenciaID = Reg.trabajo_foraneo_interno_id
							   LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
												  SUM(ROUND((Det.importe/TFI.tipo_cambio), 2) + 
													  ROUND((Det.iva/TFI.tipo_cambio), 2) + 
													  ROUND((Det.ieps/TFI.tipo_cambio), 2)) AS Total, 
												  SUM(ROUND((Det.importe/TFI.tipo_cambio), 2)) AS Subtotal,
												  SUM(ROUND((Det.iva/TFI.tipo_cambio), 2)) AS IVA,
												  SUM(ROUND((Det.ieps/TFI.tipo_cambio), 2)) AS IEPS
											FROM anticipos_proveedores_aplicacion AS Reg
											INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
											INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
													   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
										    	  AND Det.referencia = 'SERVICIO INTERNO'
										    INNER JOIN trabajos_foraneos_internos AS TFI ON Det.referencia_id = TFI.trabajo_foraneo_interno_id
										    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
						   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
										    WHERE Reg.estatus = 'ACTIVO'
										    AND AP.moneda_id <> TFI.moneda_id
										    $strRestriccionesRegFecha
										    $strRestriccionesDetTasaCuotaIva
										    $strRestriccionesDetTasaCuotaIeps
										   	GROUP BY Det.referencia_id) AS  AplicacionAnticiposMD ON AplicacionAnticiposMD.referenciaID = Reg.trabajo_foraneo_interno_id
							    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
												  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
													  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
													  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
												  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
												  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
												  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
							    		   FROM descuentos_proveedores AS Reg
							    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
							    		   		 AND Det.referencia = 'SERVICIO INTERNO'
							    		   INNER JOIN trabajos_foraneos_internos AS TFI ON Det.referencia_id = TFI.trabajo_foraneo_interno_id
							    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
						   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
							    		   WHERE Reg.estatus = 'ACTIVO'
							    		   AND Reg.moneda_id = TFI.moneda_id
							    		   $strRestriccionesRegFecha
							    		   $strRestriccionesDetTasaCuotaIva
							    		   $strRestriccionesDetTasaCuotaIeps
							    		   GROUP BY Det.referencia_id) AS DescuentosMI ON DescuentosMI.referenciaID =Reg.trabajo_foraneo_interno_id
							    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
												  SUM(ROUND((Det.importe/TFI.tipo_cambio), 2) + 
													  ROUND((Det.iva/TFI.tipo_cambio), 2) + 
													  ROUND((Det.ieps/TFI.tipo_cambio), 2)) AS Total, 
												  SUM(ROUND((Det.importe/TFI.tipo_cambio), 2)) AS Subtotal,
												  SUM(ROUND((Det.iva/TFI.tipo_cambio), 2)) AS IVA,
												  SUM(ROUND((Det.ieps/TFI.tipo_cambio), 2)) AS IEPS
							    		   FROM descuentos_proveedores AS Reg
							    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
							    		   		 AND Det.referencia = 'SERVICIO INTERNO'
							    		   INNER JOIN trabajos_foraneos_internos AS TFI ON Det.referencia_id = TFI.trabajo_foraneo_interno_id
							    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
						   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
							    		   WHERE Reg.estatus = 'ACTIVO'
							    		   AND Reg.moneda_id <> TFI.moneda_id
							    		   $strRestriccionesRegFecha
							    		   $strRestriccionesDetTasaCuotaIva
							    		   $strRestriccionesDetTasaCuotaIeps
							    		   GROUP BY Det.referencia_id) AS DescuentosMD ON DescuentosMD.referenciaID =Reg.trabajo_foraneo_interno_id
							    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
												  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
													  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
													  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
												  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
												  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
												  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
							    		   FROM pagos_proveedores AS Reg
							    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
							    		   		AND Det.referencia = 'SERVICIO INTERNO'
							    		   INNER JOIN trabajos_foraneos_internos AS TFI ON Det.referencia_id = TFI.trabajo_foraneo_interno_id
							    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
						   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
										   WHERE Reg.estatus = 'ACTIVO'
										   AND Reg.moneda_id = TFI.moneda_id
										   $strRestriccionesRegFecha
										   $strRestriccionesDetTasaCuotaIva
										   $strRestriccionesDetTasaCuotaIeps
							    		  GROUP BY Det.referencia_id) AS PagosMI ON PagosMI.referenciaID = Reg.trabajo_foraneo_interno_id
							    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
												  SUM(ROUND((Det.importe/TFI.tipo_cambio), 2) + 
													  ROUND((Det.iva/TFI.tipo_cambio), 2) + 
													  ROUND((Det.ieps/TFI.tipo_cambio), 2)) AS Total, 
												  SUM(ROUND((Det.importe/TFI.tipo_cambio), 2)) AS Subtotal,
												  SUM(ROUND((Det.iva/TFI.tipo_cambio), 2)) AS IVA,
												  SUM(ROUND((Det.ieps/TFI.tipo_cambio), 2)) AS IEPS
							    		   FROM pagos_proveedores AS Reg
							    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
							    		   		AND Det.referencia = 'SERVICIO INTERNO'
							    		   INNER JOIN trabajos_foraneos_internos AS TFI ON Det.referencia_id = TFI.trabajo_foraneo_interno_id
							    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
						   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
										   WHERE Reg.estatus = 'ACTIVO'
										   AND Reg.moneda_id <> TFI.moneda_id
										   $strRestriccionesRegFecha
										   $strRestriccionesDetTasaCuotaIva
										   $strRestriccionesDetTasaCuotaIeps
							    		  GROUP BY Det.referencia_id) AS PagosMD ON PagosMD.referenciaID = Reg.trabajo_foraneo_interno_id
							    LEFT JOIN (SELECT Det.orden_compra_id AS referenciaID,
											  	  SUM(ROUND((Det.subtotal/TFI.tipo_cambio), 2) + 
													  ROUND((Det.iva/TFI.tipo_cambio), 2) + 
												      ROUND((Det.ieps/TFI.tipo_cambio), 2)) AS Total, 
												  SUM(ROUND((Det.subtotal/TFI.tipo_cambio), 2)) AS Subtotal,
												  SUM(ROUND((Det.iva/TFI.tipo_cambio), 2)) AS IVA,
												  SUM(ROUND((Det.ieps/TFI.tipo_cambio), 2)) AS IEPS
							    		   FROM cajas_vales AS Reg
							    		   INNER JOIN cajas_vales_detalles AS Det ON Reg.caja_vale_id = Det.caja_vale_id
							    		  		AND Det.tipo_orden_compra = 'SERVICIO INTERNO'
							    		   INNER JOIN trabajos_foraneos_internos AS TFI ON Det.orden_compra_id = TFI.trabajo_foraneo_interno_id
							    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
						   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
										   WHERE  (Reg.estatus = 'AUTORIZADO' OR Reg.estatus = 'CERRADO')
										   $strRestriccionesRegFecha
										   $strRestriccionesDetTasaCuotaIva
										   $strRestriccionesDetTasaCuotaIeps
							    		  GROUP BY Det.orden_compra_id) AS ValesCaja ON ValesCaja.referenciaID = Reg.trabajo_foraneo_interno_id
							    WHERE Reg.estatus = 'ACTIVO'
							    $strRestriccionesRegFecha 
							    $strRestriccionesServIntReferenciaID
							    $strRestriccionesMoneda
								$strRestriccionesProveedor";

		//Ordenes de compra generales
		$queryGeneral = "SELECT Reg.orden_compra_id AS referencia_id, 
								 'GENERAL' AS tipo_referencia,
								 Reg.folio,  Reg.moneda_id,  M.codigo AS moneda_tipo, 
								 Reg.tipo_cambio, Reg.fecha, Reg.fecha_vencimiento, 
								 DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
								 DATE_FORMAT(Reg.fecha_vencimiento,'%d/%m/%Y') AS fecha_vencimiento_format,
								 P.proveedor_id, P.codigo, P.razon_social, P.dias_credito, 
								 P.limite_credito,    'ORDEN DE COMPRA GENERAL' AS referencia,  
								 CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
								 (GralDetalles.Subtotal) AS subtotal,
						         (GralDetalles.IVA) AS iva,
						         (GralDetalles.IEPS) AS ieps,
						         (GralDetalles.Total) AS importe,
						         (IFNULL(AplicacionAnticiposMI.Total, 0) +
						          IFNULL(AplicacionAnticiposMD.Total, 0) +
				   			 	  IFNULL(DescuentosMI.Total, 0) +
				   			 	  IFNULL(DescuentosMD.Total, 0) +
				   			  	  IFNULL(PagosMI.Total, 0) +
				   			  	  IFNULL(PagosMD.Total, 0) +
				   			  	  IFNULL(ValesCaja.Total, 0)) AS abonos,
				   			     ((GralDetalles.Total) -
				   			      IFNULL(AplicacionAnticiposMI.Total, 0) -
				   			      IFNULL(AplicacionAnticiposMD.Total, 0) -
				   			      IFNULL(DescuentosMI.Total, 0) -
				   			      IFNULL(DescuentosMD.Total, 0) -
				   			      IFNULL(PagosMI.Total, 0) -
				   			      IFNULL(PagosMD.Total, 0) -
				   			      IFNULL(ValesCaja.Total, 0)) AS saldo, 
				   			    ((GralDetalles.Subtotal) -
				   			      IFNULL(AplicacionAnticiposMI.Subtotal, 0) -
				   			      IFNULL(AplicacionAnticiposMD.Subtotal, 0) -
				   			      IFNULL(DescuentosMI.Subtotal, 0) -
				   			      IFNULL(DescuentosMD.Subtotal, 0) -
				   			      IFNULL(PagosMI.Subtotal, 0) -
				   			      IFNULL(PagosMD.Subtotal, 0) -
				   			      IFNULL(ValesCaja.Subtotal, 0)) AS saldo_subtotal,
				   			    ((GralDetalles.IVA) -
				   			      IFNULL(AplicacionAnticiposMI.IVA, 0) -
				   			      IFNULL(AplicacionAnticiposMD.IVA, 0) -
				   			      IFNULL(DescuentosMI.IVA, 0) -
				   			      IFNULL(DescuentosMD.IVA, 0) -
				   			      IFNULL(PagosMI.IVA, 0) -
				   			      IFNULL(PagosMD.IVA, 0) -
				   			      IFNULL(ValesCaja.IVA, 0)) AS saldo_iva,
				   			    ((GralDetalles.IEPS) -
				   			      IFNULL(AplicacionAnticiposMI.IEPS, 0) -
				   			      IFNULL(AplicacionAnticiposMD.IEPS, 0) -
				   			      IFNULL(DescuentosMI.IEPS, 0) -
				   			      IFNULL(DescuentosMD.IEPS, 0) -
				   			      IFNULL(PagosMI.IEPS, 0) -
				   			      IFNULL(PagosMD.IEPS, 0) -
				   			      IFNULL(ValesCaja.IEPS, 0)) AS saldo_ieps
							FROM ordenes_compra AS Reg
							INNER JOIN sat_monedas AS M ON Reg.moneda_id = M.moneda_id
							INNER JOIN proveedores AS P ON Reg.proveedor_id = P.proveedor_id
							INNER JOIN (SELECT Det.orden_compra_id AS referenciaID,
											   (SUM((ROUND(((Det.precio_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
										            ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
										            ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2) -
										            ROUND(((Det.retencion_isr_unitario * Det.cantidad)/Reg.tipo_cambio), 2) -
										            ROUND(((Det.retencion_iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2))) -
										         ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS Total, 
										       (SUM(ROUND((((Det.precio_unitario - Det.retencion_isr_unitario) * Det.cantidad)/Reg.tipo_cambio), 2)) -
										       ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS Subtotal,
										       SUM(ROUND((((Det.iva_unitario - Det.retencion_iva_unitario) * Det.cantidad)/Reg.tipo_cambio), 2)) AS IVA,
										       SUM(ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS IEPS
										FROM  ordenes_compra AS Reg
										INNER JOIN ordenes_compra_detalles_02 AS Det ON Reg.orden_compra_id = Det.orden_compra_id
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						  				$strRestriccionesOCDTasaCuotaIva
						  				$strRestriccionesDetTasaCuotaIeps
										GROUP BY Det.orden_compra_id   
									   ) AS GralDetalles ON GralDetalles.referenciaID = Reg.orden_compra_id
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/AP.tipo_cambio), 2) + 
												  ROUND((Det.iva/AP.tipo_cambio), 2) + 
												  ROUND((Det.ieps/AP.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/AP.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/AP.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/AP.tipo_cambio), 2)) AS IEPS
										FROM anticipos_proveedores_aplicacion AS Reg
										INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
										INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
												   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
									    	  AND Det.referencia = 'GENERAL'
									    INNER JOIN ordenes_compra AS OC ON Det.referencia_id = OC.orden_compra_id
									    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Reg.estatus = 'ACTIVO'
									    AND AP.moneda_id = OC.moneda_id
									    $strRestriccionesRegFecha
									    $strRestriccionesDetTasaCuotaIva
									    $strRestriccionesDetTasaCuotaIeps
									   	GROUP BY Det.referencia_id) AS  AplicacionAnticiposMI ON AplicacionAnticiposMI.referenciaID = Reg.orden_compra_id 
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/OC.tipo_cambio), 2) + 
												  ROUND((Det.iva/OC.tipo_cambio), 2) + 
												  ROUND((Det.ieps/OC.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/OC.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/OC.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/OC.tipo_cambio), 2)) AS IEPS
										FROM anticipos_proveedores_aplicacion AS Reg
										INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
										INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
												   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
									    	  AND Det.referencia = 'GENERAL'
									    INNER JOIN ordenes_compra AS OC ON Det.referencia_id = OC.orden_compra_id
									    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Reg.estatus = 'ACTIVO'
									    AND AP.moneda_id <> OC.moneda_id
									    $strRestriccionesRegFecha
									    $strRestriccionesDetTasaCuotaIva
									    $strRestriccionesDetTasaCuotaIeps
									   	GROUP BY Det.referencia_id) AS  AplicacionAnticiposMD ON AplicacionAnticiposMD.referenciaID = Reg.orden_compra_id 
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
												  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
												  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
						    		   FROM descuentos_proveedores AS Reg
						    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
						    		   		 AND Det.referencia = 'GENERAL'
						    		   INNER JOIN ordenes_compra AS OC ON Det.referencia_id = OC.orden_compra_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		   WHERE  Reg.estatus = 'ACTIVO'
						    		   AND Reg.moneda_id = OC.moneda_id
						    		   $strRestriccionesRegFecha
						    		   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS DescuentosMI ON DescuentosMI.referenciaID = Reg.orden_compra_id
						      LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											   SUM(ROUND((Det.importe/OC.tipo_cambio), 2) + 
												   ROUND((Det.iva/OC.tipo_cambio), 2) + 
												   ROUND((Det.ieps/OC.tipo_cambio), 2)) AS Total, 
											   SUM(ROUND((Det.importe/OC.tipo_cambio), 2)) AS Subtotal,
											   SUM(ROUND((Det.iva/OC.tipo_cambio), 2)) AS IVA,
											   SUM(ROUND((Det.ieps/OC.tipo_cambio), 2)) AS IEPS
						    		   FROM descuentos_proveedores AS Reg
						    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
						    		   		 AND Det.referencia = 'GENERAL'
						    		   INNER JOIN ordenes_compra AS OC ON Det.referencia_id = OC.orden_compra_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		   WHERE  Reg.estatus = 'ACTIVO'
						    		   AND Reg.moneda_id <> OC.moneda_id
						    		   $strRestriccionesRegFecha
						    		   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS DescuentosMD ON DescuentosMD.referenciaID = Reg.orden_compra_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
												  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
												  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
						    		   FROM pagos_proveedores AS Reg
						    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
						    		  		 AND Det.referencia = 'GENERAL'
						    		   INNER JOIN ordenes_compra AS OC ON Det.referencia_id = OC.orden_compra_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE Reg.estatus = 'ACTIVO'
									   AND Reg.moneda_id = OC.moneda_id
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.referencia_id) AS PagosMI ON PagosMI.referenciaID = Reg.orden_compra_id
						     LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/OC.tipo_cambio), 2) + 
												  ROUND((Det.iva/OC.tipo_cambio), 2) + 
												  ROUND((Det.ieps/OC.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/OC.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/OC.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/OC.tipo_cambio), 2)) AS IEPS
						    		   FROM pagos_proveedores AS Reg
						    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
						    		  		 AND Det.referencia = 'GENERAL'
						    		   INNER JOIN ordenes_compra AS OC ON Det.referencia_id = OC.orden_compra_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE Reg.estatus = 'ACTIVO'
									   AND Reg.moneda_id <> OC.moneda_id
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.referencia_id) AS PagosMD ON PagosMD.referenciaID = Reg.orden_compra_id
						    LEFT JOIN (SELECT Det.orden_compra_id AS referenciaID,
										  SUM(ROUND((Det.subtotal/OC.tipo_cambio), 2) + 
											  ROUND((Det.iva/OC.tipo_cambio), 2) + 
										      ROUND((Det.ieps/OC.tipo_cambio), 2)) AS Total, 
										  SUM(ROUND((Det.subtotal/OC.tipo_cambio), 2)) AS Subtotal,
										  SUM(ROUND((Det.iva/OC.tipo_cambio), 2)) AS IVA,
										  SUM(ROUND((Det.ieps/OC.tipo_cambio), 2)) AS IEPS
						    		   FROM cajas_vales AS Reg
						    		   INNER JOIN cajas_vales_detalles AS Det ON Reg.caja_vale_id = Det.caja_vale_id
						    		  		AND Det.tipo_orden_compra = 'GENERAL'
						    		   INNER JOIN ordenes_compra AS OC ON Det.orden_compra_id = OC.orden_compra_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE  (Reg.estatus = 'AUTORIZADO' OR Reg.estatus = 'CERRADO')
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.orden_compra_id) AS ValesCaja ON ValesCaja.referenciaID = Reg.orden_compra_id
						    WHERE Reg.orden_compra_id NOT IN (SELECT TF.orden_compra_id FROM  trabajos_foraneos_02 AS TF
						    								  WHERE TF.tipo_referencia = 'GENERAL')
						    AND  Reg.orden_compra_id NOT IN (SELECT TFI.orden_compra_id FROM  trabajos_foraneos_internos AS TFI)
						    AND (Reg.estatus = 'AUTORIZADO' OR Reg.estatus = 'SURTIDO') 
						    $strRestriccionesRegFecha  
						    $strRestriccionesGralReferenciaID
						    $strRestriccionesMoneda
							$strRestriccionesProveedor";

	    //Ordenes de compra especiales
		$queryEspecial = "SELECT Reg.orden_compra_especial_id AS referencia_id, 
								 'ESPECIAL' AS tipo_referencia,
								 Reg.folio,  Reg.moneda_id,  M.codigo AS moneda_tipo, 
								 Reg.tipo_cambio, Reg.fecha, Reg.fecha_vencimiento, 
								 DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
								 DATE_FORMAT(Reg.fecha_vencimiento,'%d/%m/%Y') AS fecha_vencimiento_format,
								 P.proveedor_id, P.codigo, P.razon_social, P.dias_credito, 
								 P.limite_credito,    'ORDEN DE COMPRA ESPECIAL' AS referencia,  
								 CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
								 (EspecDetalles.Subtotal) AS subtotal,
						         (EspecDetalles.IVA) AS iva,
						         (EspecDetalles.IEPS) AS ieps,
						         (EspecDetalles.Total) AS importe,
						         (IFNULL(AplicacionAnticiposMI.Total, 0) +
						          IFNULL(AplicacionAnticiposMD.Total, 0) +
				   			 	  IFNULL(DescuentosMI.Total, 0) +
				   			 	  IFNULL(DescuentosMD.Total, 0) +
				   			  	  IFNULL(PagosMI.Total, 0) +
				   			  	  IFNULL(PagosMD.Total, 0) +
				   			  	  IFNULL(ValesCaja.Total, 0)) AS abonos,
				   			     ((EspecDetalles.Total) -
				   			      IFNULL(AplicacionAnticiposMI.Total, 0) -
				   			      IFNULL(AplicacionAnticiposMD.Total, 0) -
				   			      IFNULL(DescuentosMI.Total, 0) -
				   			      IFNULL(DescuentosMD.Total, 0) -
				   			      IFNULL(PagosMI.Total, 0) -
				   			      IFNULL(PagosMD.Total, 0) -
				   			      IFNULL(ValesCaja.Total, 0)) AS saldo, 
				   			    ((EspecDetalles.Subtotal) -
				   			      IFNULL(AplicacionAnticiposMI.Subtotal, 0) -
				   			      IFNULL(AplicacionAnticiposMD.Subtotal, 0) -
				   			      IFNULL(DescuentosMI.Subtotal, 0) -
				   			      IFNULL(DescuentosMD.Subtotal, 0) -
				   			      IFNULL(PagosMI.Subtotal, 0) -
				   			      IFNULL(PagosMD.Subtotal, 0) -
				   			      IFNULL(ValesCaja.Subtotal, 0)) AS saldo_subtotal,
				   			    ((EspecDetalles.IVA) -
				   			      IFNULL(AplicacionAnticiposMI.IVA, 0) -
				   			      IFNULL(AplicacionAnticiposMD.IVA, 0) -
				   			      IFNULL(DescuentosMI.IVA, 0) -
				   			      IFNULL(DescuentosMD.IVA, 0) -
				   			      IFNULL(PagosMI.IVA, 0) -
				   			      IFNULL(PagosMD.IVA, 0) -
				   			      IFNULL(ValesCaja.IVA, 0)) AS saldo_iva,
				   			    ((EspecDetalles.IEPS) -
				   			      IFNULL(AplicacionAnticiposMI.IEPS, 0) -
				   			      IFNULL(AplicacionAnticiposMD.IEPS, 0) -
				   			      IFNULL(DescuentosMI.IEPS, 0) -
				   			      IFNULL(DescuentosMD.IEPS, 0) -
				   			      IFNULL(PagosMI.IEPS, 0) -
				   			      IFNULL(PagosMD.IEPS, 0) -
				   			      IFNULL(ValesCaja.IEPS, 0)) AS saldo_ieps
							FROM ordenes_compra_especiales AS Reg
							INNER JOIN sat_monedas AS M ON Reg.moneda_id = M.moneda_id
							INNER JOIN proveedores AS P ON Reg.proveedor_id = P.proveedor_id
							INNER JOIN (SELECT Det.orden_compra_especial_id AS referenciaID,
											   (SUM((ROUND(((Det.precio_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
										            ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2) + 
										            ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2))) -
										            ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS Total, 
										       (SUM(ROUND(((Det.precio_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) -
										      	    ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS Subtotal,
										       SUM(ROUND(((Det.iva_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS IVA,
										       SUM(ROUND(((Det.ieps_unitario * Det.cantidad)/Reg.tipo_cambio), 2)) AS IEPS
										FROM  ordenes_compra_especiales AS Reg
										INNER JOIN ordenes_compra_especiales_detalles AS Det ON Reg.orden_compra_especial_id = Det.orden_compra_especial_id
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						  				$strRestriccionesOCDTasaCuotaIva
						  				$strRestriccionesDetTasaCuotaIeps
										GROUP BY Det.orden_compra_especial_id   
									   ) AS EspecDetalles ON EspecDetalles.referenciaID = Reg.orden_compra_especial_id
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/AP.tipo_cambio), 2) + 
												  ROUND((Det.iva/AP.tipo_cambio), 2) + 
												  ROUND((Det.ieps/AP.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/AP.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/AP.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/AP.tipo_cambio), 2)) AS IEPS
										FROM anticipos_proveedores_aplicacion AS Reg
										INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
										INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
												   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
									    	  AND Det.referencia = 'ESPECIAL'
									    INNER JOIN ordenes_compra_especiales AS OCE ON Det.referencia_id = OCE.orden_compra_especial_id
									    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Reg.estatus = 'ACTIVO'
									    AND AP.moneda_id = OCE.moneda_id
									    $strRestriccionesRegFecha
									    $strRestriccionesDetTasaCuotaIva
									    $strRestriccionesDetTasaCuotaIeps
									   	GROUP BY Det.referencia_id) AS  AplicacionAnticiposMI ON AplicacionAnticiposMI.referenciaID = Reg.orden_compra_especial_id 
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/OCE.tipo_cambio), 2) + 
												  ROUND((Det.iva/OCE.tipo_cambio), 2) + 
												  ROUND((Det.ieps/OCE.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/OCE.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/OCE.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/OCE.tipo_cambio), 2)) AS IEPS
										FROM anticipos_proveedores_aplicacion AS Reg
										INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
										INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
												   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
									    	  AND Det.referencia = 'ESPECIAL'
									    INNER JOIN ordenes_compra_especiales AS OCE ON Det.referencia_id = OCE.orden_compra_especial_id
									    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Reg.estatus = 'ACTIVO'
									    AND AP.moneda_id <> OCE.moneda_id
									    $strRestriccionesRegFecha
									    $strRestriccionesDetTasaCuotaIva
									    $strRestriccionesDetTasaCuotaIeps
									   	GROUP BY Det.referencia_id) AS  AplicacionAnticiposMD ON AplicacionAnticiposMD.referenciaID = Reg.orden_compra_especial_id 
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
												  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
												  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
						    		   FROM descuentos_proveedores AS Reg
						    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
						    		   		 AND Det.referencia = 'ESPECIAL'
						    		   INNER JOIN ordenes_compra_especiales AS OCE ON Det.referencia_id = OCE.orden_compra_especial_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		   WHERE  Reg.estatus = 'ACTIVO'
						    		   AND Reg.moneda_id = OCE.moneda_id
						    		   $strRestriccionesRegFecha
						    		   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS DescuentosMI ON DescuentosMI.referenciaID = Reg.orden_compra_especial_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/OCE.tipo_cambio), 2) + 
												  ROUND((Det.iva/OCE.tipo_cambio), 2) + 
												  ROUND((Det.ieps/OCE.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/OCE.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/OCE.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/OCE.tipo_cambio), 2)) AS IEPS
						    		   FROM descuentos_proveedores AS Reg
						    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
						    		   		 AND Det.referencia = 'ESPECIAL'
						    		   INNER JOIN ordenes_compra_especiales AS OCE ON Det.referencia_id = OCE.orden_compra_especial_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		   WHERE  Reg.estatus = 'ACTIVO'
						    		   AND Reg.moneda_id <> OCE.moneda_id
						    		   $strRestriccionesRegFecha
						    		   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS DescuentosMD ON DescuentosMD.referenciaID = Reg.orden_compra_especial_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
												  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
												  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
						    		   FROM pagos_proveedores AS Reg
						    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
						    		  		 AND Det.referencia = 'ESPECIAL'
						    		   INNER JOIN ordenes_compra_especiales AS OCE ON Det.referencia_id = OCE.orden_compra_especial_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE Reg.estatus = 'ACTIVO'
									   AND Reg.moneda_id = OCE.moneda_id
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.referencia_id) AS PagosMI ON PagosMI.referenciaID = Reg.orden_compra_especial_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/OCE.tipo_cambio), 2) + 
												  ROUND((Det.iva/OCE.tipo_cambio), 2) + 
												  ROUND((Det.ieps/OCE.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/OCE.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/OCE.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/OCE.tipo_cambio), 2)) AS IEPS
						    		   FROM pagos_proveedores AS Reg
						    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
						    		  		 AND Det.referencia = 'ESPECIAL'
						    		   INNER JOIN ordenes_compra_especiales AS OCE ON Det.referencia_id = OCE.orden_compra_especial_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE Reg.estatus = 'ACTIVO'
									   AND Reg.moneda_id <> OCE.moneda_id
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.referencia_id) AS PagosMD ON PagosMD.referenciaID = Reg.orden_compra_especial_id
						    LEFT JOIN (SELECT Det.orden_compra_id AS referenciaID,
											  SUM(ROUND((Det.subtotal/OCE.tipo_cambio), 2) + 
												  ROUND((Det.iva/OCE.tipo_cambio), 2) + 
											      ROUND((Det.ieps/OCE.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.subtotal/OCE.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/OCE.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/OCE.tipo_cambio), 2)) AS IEPS
						    		   FROM cajas_vales AS Reg
						    		   INNER JOIN cajas_vales_detalles AS Det ON Reg.caja_vale_id = Det.caja_vale_id
						    		  		AND Det.tipo_orden_compra = 'ESPECIAL'
						    		   INNER JOIN ordenes_compra_especiales AS OCE ON Det.orden_compra_id = OCE.orden_compra_especial_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE  (Reg.estatus = 'AUTORIZADO' OR Reg.estatus = 'CERRADO')
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.orden_compra_id) AS ValesCaja ON ValesCaja.referenciaID = Reg.orden_compra_especial_id
						    WHERE (Reg.estatus = 'AUTORIZADO' OR Reg.estatus = 'SURTIDO') 
						    $strRestriccionesRegFecha  
						    $strRestriccionesEspecReferenciaID
						    $strRestriccionesMoneda
							$strRestriccionesProveedor";


	    //Ordenes de compra combustibles
		$queryCombustible = "SELECT Reg.orden_compra_combustible_id AS referencia_id, 
									'COMBUSTIBLE' AS tipo_referencia,
									 Reg.folio,  Reg.moneda_id,  M.codigo AS moneda_tipo, 
									 Reg.tipo_cambio, Reg.fecha, Reg.fecha_vencimiento, 
									 DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
									 DATE_FORMAT(Reg.fecha_vencimiento,'%d/%m/%Y') AS fecha_vencimiento_format,
									 P.proveedor_id, P.codigo, P.razon_social, P.dias_credito, 
									 P.limite_credito,    'ORDEN DE COMPRA COMBUSTIBLE' AS referencia,  
									 CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
									 (CombDetalles.Subtotal) AS subtotal,
							         (CombDetalles.IVA) AS iva,
							         (CombDetalles.IEPS) AS ieps,
							         (CombDetalles.Total) AS importe,
							         (IFNULL(AplicacionAnticiposMI.Total, 0) +
							          IFNULL(AplicacionAnticiposMD.Total, 0) +
					   			 	  IFNULL(DescuentosMI.Total, 0) +
					   			 	  IFNULL(DescuentosMD.Total, 0) +
					   			  	  IFNULL(PagosMI.Total, 0) +
					   			  	  IFNULL(PagosMD.Total, 0)) AS abonos,
					   			     ((CombDetalles.Total) -
					   			      IFNULL(AplicacionAnticiposMI.Total, 0) -
					   			      IFNULL(AplicacionAnticiposMD.Total, 0) -
					   			      IFNULL(DescuentosMI.Total, 0) -
					   			      IFNULL(DescuentosMD.Total, 0) -
					   			      IFNULL(PagosMI.Total, 0) -
					   			      IFNULL(PagosMD.Total, 0)) AS saldo, 
					   			    ((CombDetalles.Subtotal) -
					   			      IFNULL(AplicacionAnticiposMI.Subtotal, 0) -
					   			      IFNULL(AplicacionAnticiposMD.Subtotal, 0) -
					   			      IFNULL(DescuentosMI.Subtotal, 0) -
					   			      IFNULL(DescuentosMD.Subtotal, 0) -
					   			      IFNULL(PagosMI.Subtotal, 0) -
					   			      IFNULL(PagosMD.Subtotal, 0)) AS saldo_subtotal,
					   			    ((CombDetalles.IVA) -
					   			      IFNULL(AplicacionAnticiposMI.IVA, 0) -
					   			      IFNULL(AplicacionAnticiposMD.IVA, 0) -
					   			      IFNULL(DescuentosMI.IVA, 0) -
					   			      IFNULL(DescuentosMD.IVA, 0) -
					   			      IFNULL(PagosMI.IVA, 0) -
					   			      IFNULL(PagosMD.IVA, 0)) AS saldo_iva,
					   			    ((CombDetalles.IEPS) -
					   			      IFNULL(AplicacionAnticiposMI.IEPS, 0) -
					   			      IFNULL(AplicacionAnticiposMD.IEPS, 0) -
					   			      IFNULL(DescuentosMI.IEPS, 0) -
					   			      IFNULL(DescuentosMD.IEPS, 0) -
					   			      IFNULL(PagosMI.IEPS, 0) -
					   			      IFNULL(PagosMD.IEPS, 0)) AS saldo_ieps
								FROM ordenes_compra_combustibles AS Reg
								INNER JOIN sat_monedas AS M ON Reg.moneda_id = M.moneda_id
								INNER JOIN proveedores AS P ON Reg.proveedor_id = P.proveedor_id
								INNER JOIN (SELECT Det.orden_compra_combustible_id AS referenciaID,
											       (SUM(ROUND((VGD.subtotal/Reg.tipo_cambio), 2) + 
													   ROUND((VGD.iva/Reg.tipo_cambio), 2)) -
													   ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS Total, 
												   (SUM(ROUND((VGD.subtotal/Reg.tipo_cambio), 2)) -
												       ROUND((IFNULL(Reg.importe_retenido,0)/Reg.tipo_cambio), 2)) AS Subtotal,
												   SUM(ROUND((VGD.iva/Reg.tipo_cambio), 2)) AS IVA,
												   0 AS IEPS
											FROM  ordenes_compra_combustibles AS Reg
											INNER JOIN ordenes_compra_combustibles_detalles AS Det ON Reg.orden_compra_combustible_id = Det.orden_compra_combustible_id
											INNER JOIN vales_gasolina_detalles  AS VGD ON Det.vale_gasolina_id = VGD.vale_gasolina_id
											INNER JOIN sat_tasa_cuota AS TIva ON VGD.tasa_cuota_iva = TIva.tasa_cuota_id
							  				$strRestriccionesOCDTasaCuotaIva
											GROUP BY Det.orden_compra_combustible_id   
										   ) AS CombDetalles ON CombDetalles.referenciaID = Reg.orden_compra_combustible_id
								LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
												  SUM(ROUND((Det.importe/AP.tipo_cambio), 2) + 
													  ROUND((Det.iva/AP.tipo_cambio), 2) + 
													  ROUND((Det.ieps/AP.tipo_cambio), 2)) AS Total, 
												  SUM(ROUND((Det.importe/AP.tipo_cambio), 2)) AS Subtotal,
												  SUM(ROUND((Det.iva/AP.tipo_cambio), 2)) AS IVA,
												  SUM(ROUND((Det.ieps/AP.tipo_cambio), 2)) AS IEPS
											FROM anticipos_proveedores_aplicacion AS Reg
											INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
											INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
													   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
										    	  AND Det.referencia = 'COMBUSTIBLE'
										    INNER JOIN ordenes_compra_combustibles AS OCC ON Det.referencia_id = OCC.orden_compra_combustible_id
										    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
						   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
										    WHERE Reg.estatus = 'ACTIVO'
										    AND AP.moneda_id = OCC.moneda_id
										    $strRestriccionesRegFecha
										    $strRestriccionesDetTasaCuotaIva
										    $strRestriccionesDetTasaCuotaIeps
										   	GROUP BY Det.referencia_id) AS  AplicacionAnticiposMI ON AplicacionAnticiposMI.referenciaID = Reg.orden_compra_combustible_id 
								LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
												  SUM(ROUND((Det.importe/OCC.tipo_cambio), 2) + 
													  ROUND((Det.iva/OCC.tipo_cambio), 2) + 
													  ROUND((Det.ieps/OCC.tipo_cambio), 2)) AS Total, 
												  SUM(ROUND((Det.importe/OCC.tipo_cambio), 2)) AS Subtotal,
												  SUM(ROUND((Det.iva/OCC.tipo_cambio), 2)) AS IVA,
												  SUM(ROUND((Det.ieps/OCC.tipo_cambio), 2)) AS IEPS
											FROM anticipos_proveedores_aplicacion AS Reg
											INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
											INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
													   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
										    	  AND Det.referencia = 'COMBUSTIBLE'
										    INNER JOIN ordenes_compra_combustibles AS OCC ON Det.referencia_id = OCC.orden_compra_combustible_id
										    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
						   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
										    WHERE Reg.estatus = 'ACTIVO'
										    AND AP.moneda_id <> OCC.moneda_id
										    $strRestriccionesRegFecha
										    $strRestriccionesDetTasaCuotaIva
										    $strRestriccionesDetTasaCuotaIeps
										   	GROUP BY Det.referencia_id) AS  AplicacionAnticiposMD ON AplicacionAnticiposMD.referenciaID = Reg.orden_compra_combustible_id 
							    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
												  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
													  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
													  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
												  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
												  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
												  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
							    		   FROM descuentos_proveedores AS Reg
							    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
							    		   		 AND Det.referencia = 'COMBUSTIBLE'
							    		   INNER JOIN ordenes_compra_combustibles AS OCC ON Det.referencia_id = OCC.orden_compra_combustible_id
							    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
						   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
							    		   WHERE  Reg.estatus = 'ACTIVO'
							    		   AND Reg.moneda_id = OCC.moneda_id
							    		   $strRestriccionesRegFecha
							    		   $strRestriccionesDetTasaCuotaIva
							    		   $strRestriccionesDetTasaCuotaIeps
							    		   GROUP BY Det.referencia_id) AS DescuentosMI ON DescuentosMI.referenciaID = Reg.orden_compra_combustible_id
							    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
												  SUM(ROUND((Det.importe/OCC.tipo_cambio), 2) + 
													  ROUND((Det.iva/OCC.tipo_cambio), 2) + 
													  ROUND((Det.ieps/OCC.tipo_cambio), 2)) AS Total, 
												  SUM(ROUND((Det.importe/OCC.tipo_cambio), 2)) AS Subtotal,
												  SUM(ROUND((Det.iva/OCC.tipo_cambio), 2)) AS IVA,
												  SUM(ROUND((Det.ieps/OCC.tipo_cambio), 2)) AS IEPS
							    		   FROM descuentos_proveedores AS Reg
							    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
							    		   		 AND Det.referencia = 'COMBUSTIBLE'
							    		   INNER JOIN ordenes_compra_combustibles AS OCC ON Det.referencia_id = OCC.orden_compra_combustible_id
							    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
						   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
							    		   WHERE  Reg.estatus = 'ACTIVO'
							    		   AND Reg.moneda_id <> OCC.moneda_id
							    		   $strRestriccionesRegFecha
							    		   $strRestriccionesDetTasaCuotaIva
							    		   $strRestriccionesDetTasaCuotaIeps
							    		   GROUP BY Det.referencia_id) AS DescuentosMD ON DescuentosMD.referenciaID = Reg.orden_compra_combustible_id
							    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
												  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
													  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
													  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
												  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
												  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
												  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
							    		   FROM pagos_proveedores AS Reg
							    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
							    		  		 AND Det.referencia = 'COMBUSTIBLE'
							    		   INNER JOIN ordenes_compra_combustibles AS OCC ON Det.referencia_id = OCC.orden_compra_combustible_id
							    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
						   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
										   WHERE Reg.estatus = 'ACTIVO'
										   AND Reg.moneda_id = OCC.moneda_id
										   $strRestriccionesRegFecha
										   $strRestriccionesDetTasaCuotaIva
										   $strRestriccionesDetTasaCuotaIeps
							    		  GROUP BY Det.referencia_id) AS PagosMI ON PagosMI.referenciaID = Reg.orden_compra_combustible_id
							    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
												  SUM(ROUND((Det.importe/OCC.tipo_cambio), 2) + 
													  ROUND((Det.iva/OCC.tipo_cambio), 2) + 
													  ROUND((Det.ieps/OCC.tipo_cambio), 2)) AS Total, 
												  SUM(ROUND((Det.importe/OCC.tipo_cambio), 2)) AS Subtotal,
												  SUM(ROUND((Det.iva/OCC.tipo_cambio), 2)) AS IVA,
												  SUM(ROUND((Det.ieps/OCC.tipo_cambio), 2)) AS IEPS
							    		   FROM pagos_proveedores AS Reg
							    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
							    		  		 AND Det.referencia = 'COMBUSTIBLE'
							    		   INNER JOIN ordenes_compra_combustibles AS OCC ON Det.referencia_id = OCC.orden_compra_combustible_id
							    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
						   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
										   WHERE Reg.estatus = 'ACTIVO'
										   AND Reg.moneda_id <> OCC.moneda_id
										   $strRestriccionesRegFecha
										   $strRestriccionesDetTasaCuotaIva
										   $strRestriccionesDetTasaCuotaIeps
							    		  GROUP BY Det.referencia_id) AS PagosMD ON PagosMD.referenciaID = Reg.orden_compra_combustible_id
							    WHERE Reg.estatus = 'AUTORIZADO'
							    $strRestriccionesRegFecha  
							    $strRestriccionesCombReferenciaID
							    $strRestriccionesMoneda
								$strRestriccionesProveedor";


	    //Cartera
		$queryCartera = "SELECT Reg.cartera_proveedor_id AS referencia_id, 
								 CONCAT_WS(' - ','CARTERA', Reg.modulo) AS tipo_referencia, 
								 Reg.folio, Reg.moneda_id,  M.codigo AS moneda_tipo, 
								 Reg.tipo_cambio, Reg.fecha, Reg.fecha_vencimiento, 
								 DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha_format,
								 DATE_FORMAT(Reg.fecha_vencimiento,'%d/%m/%Y') AS fecha_vencimiento_format,
								 P.proveedor_id, P.codigo, P.razon_social, P.dias_credito, 
								 P.limite_credito, CONCAT_WS(' - ','CARTERA', Reg.modulo)  AS referencia,  
								 CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
								 (ROUND((Reg.subtotal/Reg.tipo_cambio), 2)) AS subtotal, 
							     (ROUND((Reg.iva_unitario/Reg.tipo_cambio), 2)) AS iva, 
							     (ROUND((Reg.ieps_unitario/Reg.tipo_cambio), 2)) AS ieps, 
							     ((ROUND((Reg.subtotal/Reg.tipo_cambio), 2) + 
								   ROUND((Reg.iva_unitario/Reg.tipo_cambio), 2) + 
							       ROUND((Reg.ieps_unitario/Reg.tipo_cambio), 2))) AS importe, 
								 (IFNULL(AplicacionAnticiposMI.Total, 0) + 
							      IFNULL(AplicacionAnticiposMD.Total, 0) + 
							      IFNULL(DescuentosMI.Total, 0) + 
							      IFNULL(DescuentosMD.Total, 0) + 
							      IFNULL(PagosMI.Total, 0) + 
							      IFNULL(PagosMD.Total, 0)) AS abonos, 
							      (((ROUND((Reg.subtotal/Reg.tipo_cambio), 2) + 
							         ROUND((Reg.iva_unitario/Reg.tipo_cambio), 2) + 
							         ROUND((Reg.ieps_unitario/Reg.tipo_cambio), 2))) - 
							         IFNULL(AplicacionAnticiposMI.Total, 0) - 
							         IFNULL(AplicacionAnticiposMD.Total, 0) - 
							         IFNULL(DescuentosMI.Total, 0) - 
							         IFNULL(DescuentosMD.Total, 0) - 
							         IFNULL(PagosMI.Total, 0) - 
							         IFNULL(PagosMD.Total, 0)) AS saldo, 
								  ((ROUND((Reg.subtotal/Reg.tipo_cambio), 2)) - 
							       IFNULL(AplicacionAnticiposMI.Subtotal, 0) - 
							       IFNULL(AplicacionAnticiposMD.Subtotal, 0) - 
							       IFNULL(DescuentosMI.Subtotal, 0) - 
							       IFNULL(DescuentosMD.Subtotal, 0) - 
							       IFNULL(PagosMI.Subtotal, 0) - 
							       IFNULL(PagosMD.Subtotal, 0)) AS saldo_subtotal, 
								((ROUND((Reg.iva_unitario/Reg.tipo_cambio), 2)) - 
							     IFNULL(AplicacionAnticiposMI.IVA, 0) - 
							     IFNULL(AplicacionAnticiposMD.IVA, 0) - 
							     IFNULL(DescuentosMI.IVA, 0) - 
							     IFNULL(DescuentosMD.IVA, 0) - 
							     IFNULL(PagosMI.IVA, 0) - 
							     IFNULL(PagosMD.IVA, 0)) AS saldo_iva, 
							     ((ROUND((Reg.ieps_unitario/Reg.tipo_cambio), 2)) - 
							      IFNULL(AplicacionAnticiposMI.IEPS, 0) - 
							      IFNULL(AplicacionAnticiposMD.IEPS, 0) - 
							      IFNULL(DescuentosMI.IEPS, 0) - 
							      IFNULL(DescuentosMD.IEPS, 0) - 
							      IFNULL(PagosMI.IEPS, 0) - 
							      IFNULL(PagosMD.IEPS, 0)) AS saldo_ieps 
							FROM cartera_proveedores AS Reg
							INNER JOIN sat_monedas AS M ON Reg.moneda_id = M.moneda_id
							INNER JOIN proveedores AS P ON Reg.proveedor_id = P.proveedor_id
							INNER JOIN sat_tasa_cuota AS TIva ON Reg.tasa_cuota_iva = TIva.tasa_cuota_id
						    LEFT JOIN sat_tasa_cuota AS TIeps ON Reg.tasa_cuota_ieps = TIeps.tasa_cuota_id
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/AP.tipo_cambio), 2) + 
										   		  ROUND((Det.iva/AP.tipo_cambio), 2) + 
						                  		  ROUND((Det.ieps/AP.tipo_cambio), 2)) AS Total, 
											   SUM(ROUND((Det.importe/AP.tipo_cambio), 2)) AS Subtotal,
											   SUM(ROUND((Det.iva/AP.tipo_cambio), 2)) AS IVA,
											   SUM(ROUND((Det.ieps/AP.tipo_cambio), 2)) AS IEPS
										FROM anticipos_proveedores_aplicacion AS Reg
										 INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
										INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
												   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
									    	  AND Det.referencia = 'CARTERA'
									    INNER JOIN cartera_proveedores AS CP ON Det.referencia_id = CP.cartera_proveedor_id
									    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Reg.estatus = 'ACTIVO'
									    AND AP.moneda_id = CP.moneda_id
									    $strRestriccionesRegFecha
									    $strRestriccionesDetTasaCuotaIva
									    $strRestriccionesDetTasaCuotaIeps
									   	GROUP BY Det.referencia_id) AS  AplicacionAnticiposMI ON AplicacionAnticiposMI.referenciaID = Reg.cartera_proveedor_id 
							LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/CP.tipo_cambio), 2) + 
										   		  ROUND((Det.iva/CP.tipo_cambio), 2) + 
						                  		  ROUND((Det.ieps/CP.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/CP.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/CP.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/CP.tipo_cambio), 2)) AS IEPS
										FROM anticipos_proveedores_aplicacion AS Reg
										 INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
										INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON 
												   Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
									    	  AND Det.referencia = 'CARTERA'
									    INNER JOIN cartera_proveedores AS CP ON Det.referencia_id = CP.cartera_proveedor_id
									    INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Reg.estatus = 'ACTIVO'
									    AND AP.moneda_id <> CP.moneda_id
									    $strRestriccionesRegFecha
									    $strRestriccionesDetTasaCuotaIva
									    $strRestriccionesDetTasaCuotaIeps
									   	GROUP BY Det.referencia_id) AS  AplicacionAnticiposMD ON AplicacionAnticiposMD.referenciaID = Reg.cartera_proveedor_id 
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
										   		  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
						                  		  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
						    		   FROM descuentos_proveedores AS Reg
						    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
						    		   		 AND Det.referencia = 'CARTERA'
						    		   INNER JOIN cartera_proveedores AS CP ON Det.referencia_id = CP.cartera_proveedor_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		   WHERE  Reg.estatus = 'ACTIVO'
						    		   AND Reg.moneda_id = CP.moneda_id
						    		   $strRestriccionesRegFecha
						    		   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS DescuentosMI ON DescuentosMI.referenciaID = Reg.cartera_proveedor_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/CP.tipo_cambio), 2) + 
										   		  ROUND((Det.iva/CP.tipo_cambio), 2) + 
						                  		  ROUND((Det.ieps/CP.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/CP.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/CP.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/CP.tipo_cambio), 2)) AS IEPS
						    		   FROM descuentos_proveedores AS Reg
						    		   INNER JOIN descuentos_proveedores_detalles AS Det ON Reg.descuento_proveedor_id = Det.descuento_proveedor_id
						    		   		 AND Det.referencia = 'CARTERA'
						    		   INNER JOIN cartera_proveedores AS CP ON Det.referencia_id = CP.cartera_proveedor_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						    		   WHERE  Reg.estatus = 'ACTIVO'
						    		   AND Reg.moneda_id <> CP.moneda_id
						    		   $strRestriccionesRegFecha
						    		   $strRestriccionesDetTasaCuotaIva
						    		   $strRestriccionesDetTasaCuotaIeps
						    		   GROUP BY Det.referencia_id) AS DescuentosMD ON DescuentosMD.referenciaID = Reg.cartera_proveedor_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2) + 
										   		  ROUND((Det.iva/Reg.tipo_cambio), 2) + 
						                  		  ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/Reg.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
						    		   FROM pagos_proveedores AS Reg
						    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
						    		  		 AND Det.referencia = 'CARTERA'
						    		   INNER JOIN cartera_proveedores AS CP ON Det.referencia_id = CP.cartera_proveedor_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE Reg.estatus = 'ACTIVO'
									   AND Reg.moneda_id = CP.moneda_id
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.referencia_id) AS PagosMI ON PagosMI.referenciaID = Reg.cartera_proveedor_id
						    LEFT JOIN (SELECT Det.referencia_id AS referenciaID,
											  SUM(ROUND((Det.importe/CP.tipo_cambio), 2) + 
										   		  ROUND((Det.iva/CP.tipo_cambio), 2) + 
						                  		  ROUND((Det.ieps/CP.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.importe/CP.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/CP.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/CP.tipo_cambio), 2)) AS IEPS
						    		   FROM pagos_proveedores AS Reg
						    		   INNER JOIN pagos_proveedores_detalles AS Det ON Reg.pago_proveedor_id = Det.pago_proveedor_id
						    		  		 AND Det.referencia = 'CARTERA'
						    		   INNER JOIN cartera_proveedores AS CP ON Det.referencia_id = CP.cartera_proveedor_id
						    		   INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
					   				   LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									   WHERE Reg.estatus = 'ACTIVO'
									   AND Reg.moneda_id <> CP.moneda_id
									   $strRestriccionesRegFecha
									   $strRestriccionesDetTasaCuotaIva
									   $strRestriccionesDetTasaCuotaIeps
						    		  GROUP BY Det.referencia_id) AS PagosMD ON PagosMD.referenciaID = Reg.cartera_proveedor_id
						    WHERE  $strRestriccionesCartFecha 
						    $strRestriccionesCartReferenciaID
						    $strRestriccionesMoneda
							$strRestriccionesProveedor
							$strRestriccionesDetTasaCuotaIva
							$strRestriccionesDetTasaCuotaIeps";


		//Si existe id de la referencia (orden de compra)
		if($intReferenciaID !== NULL)
		{
			//Dependiendo del tipo de referencia realizar la búsqueda de datos
			if($strTipoReferencia == 'MAQUINARIA')//Ordenes de compra de maquinaria
			{
				//Formar consulta
				$queryOrdenesCompra .= $queryMaquinaria;
			}
			else if($strTipoReferencia == 'REFACCIONES')//Entradas de refacciones por compra
			{
				//Formar consulta
				$queryOrdenesCompra .= $queryRefacciones;
			}
			else if($strTipoReferencia == 'SERVICIO')//Ordenes de compra de servicios (trabajos foráneos)
			{
				//Formar consulta
				$queryOrdenesCompra .= $queryServicio;
			}
			else if($strTipoReferencia == 'SERVICIO INTERNO')//Ordenes de compra de servicios internos (trabajos foráneos internos)
			{
				//Formar consulta
				$queryOrdenesCompra .= $queryServicioInterno;
			}
			else if($strTipoReferencia == 'GENERAL')//Ordenes de compra generales
			{
				//Formar consulta
				$queryOrdenesCompra .= $queryGeneral;	
			}
			else if($strTipoReferencia == 'ESPECIAL')//Ordenes de compra especiales
			{
				//Formar consulta
				$queryOrdenesCompra .= $queryEspecial;	
			}
		    else if($strTipoReferencia == 'COMBUSTIBLE')//Ordenes de compra combustibles
			{
				//Formar consulta
				$queryOrdenesCompra .= $queryCombustible;	
			}
			else  //Cartera
			{
				//Formar consulta
				$queryOrdenesCompra .= $queryCartera;
			}
		}
		else
		{
			//Formar consulta
			$queryOrdenesCompra .= $queryMaquinaria;
			$queryOrdenesCompra .= " UNION ";
			$queryOrdenesCompra .= $queryRefacciones;
			$queryOrdenesCompra .= " UNION ";
			$queryOrdenesCompra .= $queryServicio;
			$queryOrdenesCompra .= " UNION ";
			$queryOrdenesCompra .= $queryServicioInterno;
			$queryOrdenesCompra .= " UNION ";
			$queryOrdenesCompra .= $queryGeneral;
			$queryOrdenesCompra .= " UNION ";
			$queryOrdenesCompra .= $queryEspecial;
			$queryOrdenesCompra .= " UNION ";
			$queryOrdenesCompra .= $queryCombustible;
			$queryOrdenesCompra .= " UNION ";
			$queryOrdenesCompra .= $queryCartera;
			$queryOrdenesCompra .= $strOrdenamiento;
		}
		

		$strSQL = $this->db->query($queryOrdenesCompra);
		return $strSQL->result();
	}


	

	/*Método para regresar las tasas o cuotas de las ordenes de compra del proveedor 
	  que coincidan con los criterios de búsqueda proporcionados*/
	public function buscar_tasas_detalles_orden_compra($intReferenciaID, $strTipoReferencia)
	{	
		
		//Dependiendo del tipo de referencia realizar la búsqueda de datos
		if($strTipoReferencia == 'MAQUINARIA')//Ordenes de compra de maquinaria
		{
			//Detalles de la orden de compra de maquinaria
			$strSQL = $this->db->query("SELECT Det.tasa_cuota_iva, Det.tasa_cuota_ieps,  
											   TIva.valor_maximo AS porcentaje_iva, 
											   TIeps.valor_maximo AS porcentaje_ieps,
											   TIeps.tipo AS tipo_ieps, 
						   					   TIeps.factor AS factor_ieps
										FROM ordenes_compra_maquinaria_detalles AS Det
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
									    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Det.orden_compra_maquinaria_id = $intReferenciaID
									    GROUP BY Det.tasa_cuota_iva, Det.tasa_cuota_ieps");

		}
		else if($strTipoReferencia == 'REFACCIONES') //Entradas de refacciones por compra
		{
			//Detalles de la entrada de refacciones por compra
			$strSQL = $this->db->query("SELECT Det.tasa_cuota_iva, Det.tasa_cuota_ieps,  
											   TIva.valor_maximo AS porcentaje_iva, 
											   TIeps.valor_maximo AS porcentaje_ieps,
											   TIeps.tipo AS tipo_ieps, 
						   					   TIeps.factor AS factor_ieps
										FROM movimientos_refacciones_detalles AS Det
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
									    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Det.movimiento_refacciones_id = $intReferenciaID
									    GROUP BY Det.tasa_cuota_iva, Det.tasa_cuota_ieps");
		}
		else if($strTipoReferencia == 'SERVICIO') //Ordenes de compra de servicio (trabajos foréneos)
		{
			//Detalles de la orden de compra de servicio 
			$strSQL = $this->db->query("SELECT Det.tasa_cuota_iva, Det.tasa_cuota_ieps,  
											   TIva.valor_maximo AS porcentaje_iva, 
											   TIeps.valor_maximo AS porcentaje_ieps,
											   TIeps.tipo AS tipo_ieps, 
						   					   TIeps.factor AS factor_ieps
										FROM trabajos_foraneos_detalles AS Det
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
									    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Det.trabajo_foraneo_id = $intReferenciaID
									    GROUP BY Det.tasa_cuota_iva, Det.tasa_cuota_ieps");
		}
		else if($strTipoReferencia == 'SERVICIO INTERNO') //Ordenes de compra de servicio (trabajos foréneos internos)
		{
			//Detalles de la orden de compra de servicio interno
			$strSQL = $this->db->query("SELECT Det.tasa_cuota_iva, Det.tasa_cuota_ieps,  
											   TIva.valor_maximo AS porcentaje_iva, 
											   TIeps.valor_maximo AS porcentaje_ieps,
											   TIeps.tipo AS tipo_ieps, 
						   					   TIeps.factor AS factor_ieps
										FROM trabajos_foraneos_internos_detalles AS Det
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
									    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Det.trabajo_foraneo_interno_id = $intReferenciaID
									    GROUP BY Det.tasa_cuota_iva, Det.tasa_cuota_ieps");
		}
		else if($strTipoReferencia == 'GENERAL')//Ordenes de compra generales
		{
			//Detalles de la orden de compra general
			$strSQL = $this->db->query("SELECT Det.tasa_cuota_iva, Det.tasa_cuota_ieps,  
											   TIva.valor_maximo AS porcentaje_iva, 
											   TIeps.valor_maximo AS porcentaje_ieps,
											   TIeps.tipo AS tipo_ieps, 
						   					   TIeps.factor AS factor_ieps
										FROM ordenes_compra_detalles_02 AS Det
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
									    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Det.orden_compra_id= $intReferenciaID
									    GROUP BY Det.tasa_cuota_iva, Det.tasa_cuota_ieps");
		}
		else if($strTipoReferencia == 'ESPECIAL')//Ordenes de compra especiales
		{
			//Detalles de la orden de compra especiales
			$strSQL = $this->db->query("SELECT Det.tasa_cuota_iva, Det.tasa_cuota_ieps,  
											   TIva.valor_maximo AS porcentaje_iva, 
											   TIeps.valor_maximo AS porcentaje_ieps,
											   TIeps.tipo AS tipo_ieps, 
						   					   TIeps.factor AS factor_ieps
										FROM ordenes_compra_especiales_detalles AS Det
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
									    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Det.orden_compra_especial_id= $intReferenciaID
									    GROUP BY Det.tasa_cuota_iva, Det.tasa_cuota_ieps");
		}
		else if($strTipoReferencia == 'COMBUSTIBLE')//Ordenes de compra combustibles
		{
			//Detalles de la orden de compra combustibles
			$strSQL = $this->db->query("SELECT VGD.tasa_cuota_iva, NULL AS tasa_cuota_ieps,  
											   TIva.valor_maximo AS porcentaje_iva, 
											   '' AS porcentaje_ieps,
											   '' AS tipo_ieps, 
						   					   '' AS factor_ieps
										FROM ordenes_compra_combustibles_detalles AS Det
										INNER JOIN vales_gasolina_detalles AS VGD ON Det.vale_gasolina_id = VGD.vale_gasolina_id
										INNER JOIN sat_tasa_cuota AS TIva ON VGD.tasa_cuota_iva = TIva.tasa_cuota_id
									    WHERE Det.orden_compra_combustible_id= $intReferenciaID
									    GROUP BY VGD.tasa_cuota_iva");
		}
		else //Cartera
		{
			//Detalles de la cartera de vencimiento
			$strSQL = $this->db->query("SELECT Det.tasa_cuota_iva, Det.tasa_cuota_ieps,  
											   TIva.valor_maximo AS porcentaje_iva, 
											   TIeps.valor_maximo AS porcentaje_ieps,
											   TIeps.tipo AS tipo_ieps, 
						   					   TIeps.factor AS factor_ieps
										FROM cartera_proveedores AS Det
										INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
									    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
									    WHERE Det.cartera_proveedor_id = $intReferenciaID
									    GROUP BY Det.tasa_cuota_iva, Det.tasa_cuota_ieps");
		}

		return $strSQL->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProveedorID = NULL,
		                   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('PP.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('PP.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(PP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('PP.estatus', $strEstatus);
		}

		$this->db->where("((PP.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->from('pagos_proveedores AS PP');
	    $this->db->join('sat_monedas AS M', 'PP.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'PP.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('cuentas_bancarias AS CB', 'PP.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$this->db->join('sat_forma_pago AS FP', 'PP.forma_pago_id = FP.forma_pago_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("PP.pago_proveedor_id, PP.folio, DATE_FORMAT(PP.fecha,'%d/%m/%Y') AS fecha, 
						   PP.estatus, CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor", FALSE);
		$this->db->from('pagos_proveedores AS PP');
	    $this->db->join('sat_monedas AS M', 'PP.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'PP.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('cuentas_bancarias AS CB', 'PP.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$this->db->join('sat_forma_pago AS FP', 'PP.forma_pago_id = FP.forma_pago_id', 'inner');
		$this->db->where('PP.sucursal_id', $this->session->userdata('sucursal_id'));
	    //Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('PP.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(PP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('PP.estatus', $strEstatus);
		}

		$this->db->where("((PP.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
		$this->db->order_by('PP.fecha DESC, PP.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["pagos"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*******************************************************************************************************************
	Funciones de la tabla pagos_proveedores_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles del pago
	public function guardar_detalles(stdClass $objPagoProveedor)
	{
		/*Quitar | de la lista para obtener el referencia, referencia_id, importe, iva e ieps
		*/
		$arrReferencias = explode("|", $objPagoProveedor->strReferencias);
		$arrReferenciaID = explode("|", $objPagoProveedor->strReferenciaID);
		$arrImportes = explode("|", $objPagoProveedor->strImportes);
		$arrTasaCuotaIva = explode("|", $objPagoProveedor->strTasaCuotaIva);
		$arrIvas = explode("|", $objPagoProveedor->strIvas);
		$arrTasaCuotaIeps = explode("|", $objPagoProveedor->strTasaCuotaIeps);
		$arrIeps = explode("|", $objPagoProveedor->strIeps);

		//Hacer recorrido para insertar los datos en la tabla pagos_proveedores_detalles
		for ($intCon = 0; $intCon < sizeof($arrReferencias); $intCon++) 
		{

			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);

			//Separar cadena para obtener la referencia del detalle,  por ejemplo: CARTERA - REFACCIONES será CARTERA
			$arrTipoReferencia = explode(" - ", $arrReferencias[$intCon]);

			//Asignar datos al array
			$arrDatos = array('pago_proveedor_id' => $objPagoProveedor->intPagoProveedorID,
							  'renglon' => ($intCon + 1),
							  'referencia' => $arrTipoReferencia[0], 
							  'referencia_id' => $arrReferenciaID[$intCon],
							  'importe' => $arrImportes[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva' => $arrIvas[$intCon],
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps' => $arrIeps[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('pagos_proveedores_detalles', $arrDatos);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intPagoProveedorID)
	{
		$this->db->select('PPD.referencia, PPD.referencia_id, PPD.importe, 
						   PPD.tasa_cuota_iva, PPD.iva, PPD.tasa_cuota_ieps, PPD.ieps,
						   TIva.valor_maximo AS porcentaje_iva, TIeps.valor_maximo AS porcentaje_ieps,
						   TIeps.tipo AS tipo_ieps, TIeps.factor AS factor_ieps');
		$this->db->from('pagos_proveedores_detalles AS PPD');
		$this->db->join('sat_tasa_cuota AS TIva', 'PPD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'PPD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('PPD.pago_proveedor_id', $intPagoProveedorID);
		$this->db->order_by('PPD.renglon', 'ASC');
		return $this->db->get()->result();
	}
}	
?>