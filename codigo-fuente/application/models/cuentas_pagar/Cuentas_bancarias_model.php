<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentas_bancarias_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objCuentaBancaria)
	{
		//Asignar datos al array
		$arrDatos = array('banco_id' => $objCuentaBancaria->intBancoID,
						  'cuenta' => $objCuentaBancaria->strCuenta,
						  'clabe' => $objCuentaBancaria->strClabe,
						  'descripcion' => $objCuentaBancaria->strDescripcion, 
						  'moneda_id' => $objCuentaBancaria->intMonedaID,
						  'contacto_nombre' => $objCuentaBancaria->strContactoNombre,
						  'contacto_telefono' => $objCuentaBancaria->strContactoTelefono,
						  'contacto_extension' => $objCuentaBancaria->strContactoExtension,
						  'contacto_celular' => $objCuentaBancaria->strContactoCelular,
						  'contacto_correo_electronico' => $objCuentaBancaria->strContactoCorreoElectronico,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objCuentaBancaria->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('cuentas_bancarias', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objCuentaBancaria)
	{
		//Asignar datos al array
		$arrDatos = array('banco_id' => $objCuentaBancaria->intBancoID, 
						  'cuenta' => $objCuentaBancaria->strCuenta,
						  'clabe' => $objCuentaBancaria->strClabe,
						  'descripcion' => $objCuentaBancaria->strDescripcion, 
						  'moneda_id' => $objCuentaBancaria->intMonedaID,
						  'contacto_nombre' => $objCuentaBancaria->strContactoNombre,
						  'contacto_telefono' => $objCuentaBancaria->strContactoTelefono,
						  'contacto_extension' => $objCuentaBancaria->strContactoExtension,
						  'contacto_celular' => $objCuentaBancaria->strContactoCelular,
						  'contacto_correo_electronico' => $objCuentaBancaria->strContactoCorreoElectronico,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objCuentaBancaria->intUsuarioID);
		$this->db->where('cuenta_bancaria_id', $objCuentaBancaria->intCuentaBancariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('cuentas_bancarias', $arrDatos);
	}


	//Método para modificar el estatus de un registro
	public function set_estatus($intCuentaBancariaID, $strEstatus)
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
		$this->db->where('cuenta_bancaria_id', $intCuentaBancariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('cuentas_bancarias', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intCuentaBancariaID = NULL, $strCuenta = NULL, $strBusqueda = NULL, $intMonedaID = NULL)
	{
		$this->db->select("CB.cuenta_bancaria_id, CB.banco_id, CB.cuenta, CB.clabe, CB.descripcion, 
						   CB.moneda_id, CB.contacto_nombre, CB.contacto_telefono, CB.contacto_extension, 
						   CB.contacto_celular, CB.contacto_correo_electronico,
						   CB.estatus, CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   M.codigo AS codigo_moneda,						   
						   CONCAT_WS(' - ', B.codigo, B.descripcion) AS banco", FALSE);
		$this->db->from('cuentas_bancarias AS CB');
		$this->db->join('sat_bancos AS B', 'CB.banco_id = B.banco_id', 'inner');
		$this->db->join('sat_monedas AS M', 'CB.moneda_id = M.moneda_id', 'inner');
		//Si existe id de la cuenta bancaria
		if ($intCuentaBancariaID !== NULL)
		{   
			$this->db->where('CB.cuenta_bancaria_id', $intCuentaBancariaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCuenta !== NULL)//Si existe cuenta
		{
			$this->db->where('CB.cuenta', $strCuenta);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($intMonedaID !== NULL)//Si existe id de la moneda
		{
			$this->db->where('CB.moneda_id', $intMonedaID);
			$this->db->order_by('CB.cuenta', 'ASC');
			return $this->db->get()->result();
		}
		else 
		{	
			$this->db->like('CB.cuenta', $strBusqueda);
	    	$this->db->or_like('CB.clabe', $strBusqueda);
	    	$this->db->or_like('CB.contacto_nombre', $strBusqueda);
	    	$this->db->or_like('CB.estatus', $strBusqueda);
	    	$this->db->or_like('B.codigo', $strBusqueda);
	    	$this->db->or_like('B.descripcion', $strBusqueda);
	    	$this->db->or_like('M.codigo', $strBusqueda);
	    	$this->db->or_like('M.descripcion', $strBusqueda);
			$this->db->order_by('CB.moneda_id, CB.cuenta', 'ASC');
			return $this->db->get()->result();
		}
	}

	/*Método para regresar el saldo de la cuenta bancaria que coincida con los criterios de búsqueda proporcionados
     */
	public function buscar_saldo_cuenta_bancaria($intCuentaBancariaID, $dteFechaInicial = NULL, 
												 $dteFechaFinal = NULL, $strTipo = NULL)
	{

		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		$strRestriccionesAjusteBancFecha = '';
		$strRestriccionesFechaPagos = '';
		$strRestriccionesFechaTraspasoBanco = '';
		$strRestriccionesPagosProvFecha = '';
		$strRestriccionesAnticiposProvFecha = '';
		$strRestriccionesAnticiposDevFecha = '';

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	    	$strRestriccionesAjusteBancFecha .= " AND (fecha  BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";

	    	$strRestriccionesFechaPagos .= " AND (DATE_FORMAT(PD.fecha_pago,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";

	    	$strRestriccionesFechaTraspasoBanco .= " AND (TCB.fecha  BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";

	    	$strRestriccionesPagosProvFecha .= " AND (PP.fecha  BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";

	    	$strRestriccionesAnticiposProvFecha .= " AND (AP.fecha  BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";

	    	$strRestriccionesAnticiposDevFecha .= " AND (DATE_FORMAT(AD.fecha,'%Y-%m-%d')  BETWEEN 
	    											'$dteFechaInicial' AND '$dteFechaFinal')";
	    }
	    else
	    {
	    	//Si el tipo corresponde al saldo_actual
	    	if($strTipo == 'saldo_actual')
	    	{	
	    		//Operador que se utiliza para obtener el saldo actual
	    		$strOperador = '<=';
	    	}
	    	else
	    	{
	    		//Operador que se utiliza para obtener el saldo anterior
	    		$strOperador = '<';
	    	}


	    	$strRestriccionesAjusteBancFecha .= " AND (fecha ".$strOperador." '$dteFechaInicial')";

	    	$strRestriccionesFechaPagos .= " AND (DATE_FORMAT(PD.fecha_pago,'%Y-%m-%d') ".$strOperador." '$dteFechaInicial')";

	    	$strRestriccionesFechaTraspasoBanco .= " AND (TCB.fecha ".$strOperador." '$dteFechaInicial')";

	    	$strRestriccionesPagosProvFecha .= " AND (PP.fecha ".$strOperador." '$dteFechaInicial')";

	    	$strRestriccionesAnticiposProvFecha .= " AND (AP.fecha ".$strOperador." '$dteFechaInicial')";

	    	$strRestriccionesAnticiposDevFecha .= " AND (DATE_FORMAT(AD.fecha,'%Y-%m-%d') ".$strOperador." 
	    											'$dteFechaInicial')";
	    }


		$strSQL = $this->db->query("SELECT (IFNULL(AjustesBancariosIngreso.Total,0) + 
											IFNULL(Pagos.Total,0) + 
											IFNULL(TraspasoPagos.Total,0) +
											IFNULL(TraspasoAnticipos.Total,0) + 
											IFNULL(TraspasoRecibosIngreso.Total,0) +
											IFNULL(TraspasoPolizasAbono.Total,0) -
											IFNULL(AjustesBancariosEgreso.Total,0) - 
											IFNULL(PagosProveedores.Total,0) -
											IFNULL(AnticiposProveedores.Total,0) -
											IFNULL(AnticiposDevolucion.Total,0)) AS saldo
									FROM cuentas_bancarias AS CB
									LEFT JOIN (SELECT cuenta_bancaria_id AS referenciaID,
													  SUM(subtotal + iva) AS Total
											   FROM ajustes_bancarios
											   WHERE tipo = 'INGRESO'
											   AND  estatus = 'ACTIVO'
											   $strRestriccionesAjusteBancFecha
											   GROUP BY cuenta_bancaria_id
											   ) AS AjustesBancariosIngreso ON AjustesBancariosIngreso.referenciaID = CB.cuenta_bancaria_id
									LEFT JOIN (SELECT PD.cuenta_bancaria_id AS referenciaID,
													 SUM(PD.monto / PD.tipo_cambio) AS Total
												FROM  pagos AS P
												INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
												INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PDR.pago_id = P.pago_id 
												AND PDR.renglon_detalles = PD.renglon
												WHERE (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
												 $strRestriccionesFechaPagos
												GROUP BY PD.cuenta_bancaria_id) AS Pagos ON Pagos.referenciaID = CB.cuenta_bancaria_id
									LEFT JOIN (SELECT TCB.cuenta_bancaria_id AS referenciaID,
													  SUM(TCBD.importe / PD.tipo_cambio) AS Total
											   FROM pagos AS P
											   INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
											   INNER JOIN traspasos_caja_bancos_detalles AS TCBD ON TCBD.tipo_referencia = 'PAGO' 
					   								AND  TCBD.referencia_id =  P.pago_id  AND TCBD.renglon_referencia = PD.renglon
					   						   INNER JOIN traspasos_caja_bancos AS TCB ON TCBD.traspaso_caja_banco_id = TCB.traspaso_caja_banco_id
											   WHERE TCB.estatus = 'ACTIVO'
											   $strRestriccionesFechaTraspasoBanco
											   GROUP BY TCB.cuenta_bancaria_id) AS TraspasoPagos ON TraspasoPagos.referenciaID = CB.cuenta_bancaria_id
								    LEFT JOIN (SELECT TCB.cuenta_bancaria_id AS referenciaID,
													  SUM(TCBD.importe / A.tipo_cambio) AS Total
											   FROM anticipos AS A	
											   INNER JOIN traspasos_caja_bancos_detalles AS TCBD ON TCBD.tipo_referencia = 'ANTICIPO' 
										   			 AND  TCBD.referencia_id = A.anticipo_id  AND TCBD.renglon_referencia = 1
											   INNER JOIN traspasos_caja_bancos AS TCB ON TCBD.traspaso_caja_banco_id = TCB.traspaso_caja_banco_id
											   WHERE TCB.estatus = 'ACTIVO'
											   $strRestriccionesFechaTraspasoBanco
											   GROUP BY TCB.cuenta_bancaria_id) AS TraspasoAnticipos ON TraspasoAnticipos.referenciaID = CB.cuenta_bancaria_id
									LEFT JOIN (SELECT TCB.cuenta_bancaria_id AS referenciaID,
													  SUM(TCBD.importe / RI.tipo_cambio) AS Total
											   FROM recibos_ingreso AS RI
											   INNER JOIN traspasos_caja_bancos_detalles AS TCBD ON TCBD.tipo_referencia = 'RECIBO INGRESO' 
										   			 AND  TCBD.referencia_id = RI.recibo_ingreso_id  AND TCBD.renglon_referencia = 1
										   	   INNER JOIN traspasos_caja_bancos AS TCB ON TCBD.traspaso_caja_banco_id = TCB.traspaso_caja_banco_id	 
											   WHERE TCB.estatus = 'ACTIVO'
											   $strRestriccionesFechaTraspasoBanco
											   GROUP BY TCB.cuenta_bancaria_id) AS TraspasoRecibosIngreso ON TraspasoRecibosIngreso.referenciaID = CB.cuenta_bancaria_id
									LEFT JOIN (SELECT TCB.cuenta_bancaria_id AS referenciaID,
													  SUM(TCBD.importe / PA.tipo_cambio) AS Total
											   FROM polizas_abono_02 AS PA	 
											   INNER JOIN polizas_abono_detalles_02 AS PAD ON PA.poliza_abono_id = PAD.poliza_abono_id 
											   INNER JOIN traspasos_caja_bancos_detalles AS TCBD ON TCBD.tipo_referencia = 'POLIZA ABONO' 
					   								 AND  TCBD.referencia_id = PA.poliza_abono_id  AND TCBD.renglon_referencia = PAD.renglon
					  		 				   INNER JOIN traspasos_caja_bancos AS TCB ON TCBD.traspaso_caja_banco_id = TCB.traspaso_caja_banco_id
											   WHERE TCB.estatus = 'ACTIVO'
											   $strRestriccionesFechaTraspasoBanco
											   GROUP BY TCB.cuenta_bancaria_id) AS TraspasoPolizasAbono ON TraspasoPolizasAbono.referenciaID = CB.cuenta_bancaria_id
									LEFT JOIN (SELECT cuenta_bancaria_id AS referenciaID,
													  SUM(subtotal + iva) AS Total
											   FROM ajustes_bancarios
											   WHERE tipo = 'EGRESO'
											   AND  estatus = 'ACTIVO'
											   $strRestriccionesAjusteBancFecha
											   GROUP BY cuenta_bancaria_id
											   ) AS AjustesBancariosEgreso ON AjustesBancariosEgreso.referenciaID = CB.cuenta_bancaria_id
									LEFT JOIN (SELECT PP.cuenta_bancaria_id AS referenciaID,
													  SUM((PPD.importe + PPD.iva + PPD.ieps) / PP.tipo_cambio) AS Total
											   FROM pagos_proveedores AS PP
											   INNER JOIN pagos_proveedores_detalles AS PPD ON PP.pago_proveedor_id = PPD.pago_proveedor_id
											   WHERE  PP.estatus = 'ACTIVO'
											   $strRestriccionesPagosProvFecha
											   GROUP BY PP.cuenta_bancaria_id
											   ) AS PagosProveedores ON PagosProveedores.referenciaID = CB.cuenta_bancaria_id
									LEFT JOIN (SELECT AP.cuenta_bancaria_id AS referenciaID,
													  IFNULL(SUM((APD.subtotal + APD.iva + APD.ieps) / AP.tipo_cambio), 0) AS Total
											   FROM anticipos_proveedores AS AP
											   LEFT JOIN anticipos_proveedores_detalles AS APD ON AP.anticipo_proveedor_id = APD.anticipo_proveedor_id
											   WHERE  AP.estatus <> 'ACTIVO'
											   $strRestriccionesAnticiposProvFecha
											   GROUP BY AP.cuenta_bancaria_id
											   ) AS AnticiposProveedores ON AnticiposProveedores.referenciaID = CB.cuenta_bancaria_id
									LEFT JOIN (SELECT AD.cuenta_bancaria_id AS referenciaID,
													  SUM(ROUND((DAD.subtotal/A.tipo_cambio), 2) + 
														  ROUND((DAD.iva/A.tipo_cambio), 2) + 
										                  ROUND((DAD.ieps/A.tipo_cambio), 2)) AS Total
											   FROM anticipos_devolucion AS AD
											   INNER JOIN anticipos_devolucion_detalles AS DAD ON AD.anticipo_devolucion_id = DAD.anticipo_devolucion_id
											    	AND DAD.referencia = 'FISCAL'
											    INNER JOIN anticipos AS A ON DAD.referencia_id = A.anticipo_id
											    WHERE  AD.estatus = 'ACTIVO'
											   $strRestriccionesAnticiposDevFecha
											   GROUP BY AD.cuenta_bancaria_id
											   ) AS AnticiposDevolucion ON AnticiposDevolucion.referenciaID = CB.cuenta_bancaria_id
									WHERE CB.cuenta_bancaria_id = $intCuentaBancariaID");

		return $strSQL->result();
	}

	/*Método para regresar los movimientos (ingresos, egresos, pagos y/o anticipos) de la cuenta bancaria 
	  que coincida con los criterios de búsqueda proporcionados (se utiliza en el reporte de saldo en bancos)*/
	public function buscar_movimientos_cuentas_bancarias($intCuentaBancariaID, $dteFechaInicial, $dteFechaFinal)
	{
		
		//Variable que se utiliza para formar la consulta
		$queryMovimientos = '';

		//Variables para definir los procesos que se incluiran en la búsqueda
		$queryAjustesBancariosIngreso = "SELECT folio, fecha, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha_format,
											    'INGRESO'  AS descripcion, '' AS folio_referencia, 
											    ''  AS fecha_referencia,  '' AS monto_referencia, 
											    '' AS tipo_referencia, '' AS folio_detalle, 'abono' AS tipo,
												(subtotal + iva) AS importe
										 FROM ajustes_bancarios
										 WHERE tipo = 'INGRESO'
										 AND  cuenta_bancaria_id = $intCuentaBancariaID
										 AND (fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
										 AND  estatus = 'ACTIVO'";

        //Pagos
		$queryPagos = "SELECT P.folio, DATE_FORMAT(P.fecha, '%Y-%m-%d') AS fecha, 
							  DATE_FORMAT(P.fecha, '%d/%m/%Y') AS fecha_format, 
							  'RECIBO DE PAGO' AS descripcion, 
							  PDR.folio AS folio_referencia,  
							  DATE_FORMAT(PD.fecha_pago, '%d/%m/%Y')  AS fecha_referencia,  
							  PD.monto AS monto_referencia, 
							  'RECIBO DE PAGO' AS tipo_referencia, '' AS folio_detalle, 'abono' AS tipo,
							  SUM(PDR.imp_pagado/PD.tipo_cambio) AS importe
					   FROM pagos AS P
					   INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
					   INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PDR.pago_id = P.pago_id 
							 AND PDR.renglon_detalles = PD.renglon
					   WHERE PD.cuenta_bancaria_id = $intCuentaBancariaID
					   AND (DATE_FORMAT(P.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
					   AND (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
					   GROUP BY P.pago_id, PD.renglon, PDR.renglon";

		//Traspasos de caja a bancos: PAGOS
		$queryTraspasoPagos = "SELECT  TCB.folio, TCB.fecha, DATE_FORMAT(TCB.fecha, '%d/%m/%Y') AS fecha_format,
									   CONCAT_WS(' - ', 'TRASPASO ', TCBD.tipo_referencia) AS descripcion,
								       P.folio  AS folio_referencia, ''  AS fecha_referencia, '' AS monto_referencia,
							  			TCBD.tipo_referencia, '' AS folio_detalle, 'abono' AS tipo,
								       (TCBD.importe / PD.tipo_cambio) AS importe
							   FROM pagos AS P
							   INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
							   INNER JOIN traspasos_caja_bancos_detalles AS TCBD ON TCBD.tipo_referencia = 'PAGO' 
							   		AND  TCBD.referencia_id =  P.pago_id  AND TCBD.renglon_referencia = PD.renglon
							   INNER JOIN traspasos_caja_bancos AS TCB ON TCBD.traspaso_caja_banco_id = TCB.traspaso_caja_banco_id
							   WHERE TCB.cuenta_bancaria_id = $intCuentaBancariaID
							   AND (TCB.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
							   AND  TCB.estatus = 'ACTIVO'";

	    //Traspasos de caja a bancos: ANTICIPOS
		$queryTraspasoAnticipos = "SELECT  TCB.folio, TCB.fecha, DATE_FORMAT(TCB.fecha, '%d/%m/%Y') AS fecha_format,
										   CONCAT_WS(' - ', 'TRASPASO ', TCBD.tipo_referencia) AS descripcion,
									       A.folio  AS folio_referencia, ''  AS fecha_referencia,  
							  			   '' AS monto_referencia, TCBD.tipo_referencia,
									       '' AS folio_detalle, 'abono' AS tipo,
									       (TCBD.importe / A.tipo_cambio) AS importe
								   FROM anticipos AS A	
								   INNER JOIN traspasos_caja_bancos_detalles AS TCBD ON TCBD.tipo_referencia = 'ANTICIPO' 
								   		AND  TCBD.referencia_id = A.anticipo_id  AND TCBD.renglon_referencia = 1
								   INNER JOIN traspasos_caja_bancos AS TCB ON TCBD.traspaso_caja_banco_id = TCB.traspaso_caja_banco_id
								   WHERE TCB.cuenta_bancaria_id = $intCuentaBancariaID
								   AND (TCB.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
								   AND  TCB.estatus = 'ACTIVO'";

		//Traspasos de caja a bancos: RECIBOS DE INGRESOS
		$queryTraspasoRecibosIngreso = "SELECT TCB.folio, TCB.fecha, 
										       DATE_FORMAT(TCB.fecha, '%d/%m/%Y') AS fecha_format,
											   CONCAT_WS(' - ', 'TRASPASO ', TCBD.tipo_referencia) AS descripcion,
										       RI.folio  AS folio_referencia, ''  AS fecha_referencia,  
							  			   	   '' AS monto_referencia, TCBD.tipo_referencia,
										       '' AS folio_detalle, 'abono' AS tipo,
										       (TCBD.importe / RI.tipo_cambio) AS importe
									   FROM recibos_ingreso AS RI
									   INNER JOIN traspasos_caja_bancos_detalles AS TCBD ON TCBD.tipo_referencia = 'RECIBO INGRESO' 
									   		AND  TCBD.referencia_id = RI.recibo_ingreso_id AND TCBD.renglon_referencia = 1
									   INNER JOIN traspasos_caja_bancos AS TCB ON TCBD.traspaso_caja_banco_id = TCB.traspaso_caja_banco_id
									   WHERE TCB.cuenta_bancaria_id = $intCuentaBancariaID
									   AND (TCB.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
									   AND  TCB.estatus = 'ACTIVO'";

		//Traspasos de caja a bancos: PÓLIZAS DE ABONO
		$queryTraspasoPolizasAbono = "SELECT TCB.folio, TCB.fecha, 
									         DATE_FORMAT(TCB.fecha, '%d/%m/%Y') AS fecha_format,
											 CONCAT_WS(' - ', 'TRASPASO ', TCBD.tipo_referencia) AS descripcion,
										     PA.folio  AS folio_referencia, ''  AS fecha_referencia,  
							  			     '' AS monto_referencia, TCBD.tipo_referencia,
										     CASE 
											    WHEN  FM.factura_maquinaria_id > 0 
													THEN CONCAT_WS(' - ', FM.folio, 'MAQUINARIA') 
											    WHEN  FR.factura_refacciones_id > 0
													THEN CONCAT_WS(' - ', FR.folio, 'REFACCIONES') 
											    ELSE CONCAT_WS(' - ', FS.folio, 'SERVICIO') 
											  END AS  folio_detalle,
										      'abono' AS tipo,
										     (TCBD.importe / PA.tipo_cambio) AS importe
									  FROM polizas_abono_02 AS PA	 
									  INNER JOIN polizas_abono_detalles_02 AS PAD ON PA.poliza_abono_id = PAD.poliza_abono_id 
									  INNER JOIN traspasos_caja_bancos_detalles AS TCBD ON TCBD.tipo_referencia = 'POLIZA ABONO' 
			   								 AND  TCBD.referencia_id = PA.poliza_abono_id  AND TCBD.renglon_referencia = PAD.renglon
			  		 				  INNER JOIN traspasos_caja_bancos AS TCB ON TCBD.traspaso_caja_banco_id = TCB.traspaso_caja_banco_id
			  		 				  LEFT JOIN facturas_maquinaria AS FM ON PAD.referencia_id = FM.factura_maquinaria_id 
											   AND PAD.referencia = 'MAQUINARIA'
									  LEFT JOIN facturas_refacciones AS FR ON PAD.referencia_id = FR.factura_refacciones_id 
											   AND PAD.referencia = 'REFACCIONES'
									  LEFT JOIN facturas_servicio AS FS ON PAD.referencia_id = FS.factura_servicio_id 
											   AND PAD.referencia = 'SERVICIO'
									  WHERE TCB.cuenta_bancaria_id = $intCuentaBancariaID
									  AND (TCB.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
									  AND  TCB.estatus = 'ACTIVO'";

		//Ajustes bancarios: EGRESOS		  
		$queryAjustesBancariosEgreso = "SELECT folio, fecha, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha_format,
											    'EGRESO'  AS descripcion, '' AS folio_referencia, 
											    ''  AS fecha_referencia, '' AS monto_referencia, '' AS tipo_referencia,
											    '' AS folio_detalle, 'cargo' AS tipo,
												(subtotal + iva) AS importe
										 FROM ajustes_bancarios
										 WHERE tipo = 'EGRESO'
										 AND  cuenta_bancaria_id = $intCuentaBancariaID
										 AND (fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
										 AND  estatus = 'ACTIVO'";

		//Pagos a proveedores								 
		$queryPagosProveedores = "SELECT PP.folio, PP.fecha, DATE_FORMAT(PP.fecha,'%d/%m/%Y') AS fecha_format,
										   CONCAT_WS(' - ','PAGO A PROVEEDOR', PPD.referencia) AS descripcion, 
										   CASE 
											   WHEN  PPD.referencia = 'MAQUINARIA' THEN  OCM.folio
											   WHEN  PPD.referencia = 'REFACCIONES' THEN  OCR.folio
											   WHEN  PPD.referencia = 'SERVICIO' THEN  TF.folio
											   ELSE OC.folio
											END AS folio_referencia, ''  AS fecha_referencia,  
							  			   '' AS monto_referencia, '' AS tipo_referencia,  
											'' AS folio_detalle, 'cargo' AS tipo, 
											SUM((PPD.importe + PPD.iva + PPD.ieps) / PP.tipo_cambio)  importe
								 FROM  pagos_proveedores AS PP 
								 INNER JOIN pagos_proveedores_detalles AS PPD ON PP.pago_proveedor_id = PPD.pago_proveedor_id
								 LEFT JOIN ordenes_compra_maquinaria AS OCM ON PPD.referencia_id = OCM.orden_compra_maquinaria_id 
								      AND PPD.referencia = 'MAQUINARIA'
								 LEFT JOIN ordenes_compra_refacciones AS OCR ON PPD.referencia_id = OCR.orden_compra_refacciones_id 
								      AND PPD.referencia = 'REFACCIONES'
								 LEFT JOIN trabajos_foraneos_02 AS TF ON PPD.referencia_id = TF.trabajo_foraneo_id 
								      AND PPD.referencia = 'SERVICIO'
								 LEFT JOIN ordenes_compra AS OC ON PPD.referencia_id = OC.orden_compra_id 
								      AND PPD.referencia = 'GENERAL'
								WHERE PP.cuenta_bancaria_id = $intCuentaBancariaID
								AND (PP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
								AND PP.estatus = 'ACTIVO'
								GROUP BY PP.pago_proveedor_id, PPD.referencia, PPD.referencia_id";

		//Anticipos a proveedores	
		$queryAnticiposProveedores = "SELECT AP.folio, AP.fecha, DATE_FORMAT(AP.fecha,'%d/%m/%Y') AS fecha_format,
											 CONCAT_WS(' - ','ANTICIPO PROVEEDOR', AP.estatus) AS descripcion, 
											 '' AS folio_referencia, ''  AS fecha_referencia,  
							  			     '' AS monto_referencia, '' AS tipo_referencia,
											 '' AS folio_detalle, 'cargo' AS tipo, 
											 IFNULL(SUM((APD.subtotal + APD.iva + APD.ieps) / AP.tipo_cambio), 0) AS importe 
										FROM anticipos_proveedores AS AP
										LEFT JOIN anticipos_proveedores_detalles AS APD ON AP.anticipo_proveedor_id = APD.anticipo_proveedor_id
										WHERE AP.cuenta_bancaria_id = $intCuentaBancariaID
										AND (AP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
										AND AP.estatus <> 'INACTIVO'
										GROUP BY AP.anticipo_proveedor_id";

		//Devolución de anticipos
		$queryAnticiposDevolucion = "SELECT AD.folio, AD.fecha, DATE_FORMAT(AD.fecha,'%d/%m/%Y') AS fecha_format,
											'DEV. ANTICIPO CLTE.' AS descripcion, 
											'' AS folio_referencia, ''  AS fecha_referencia,  
							  			    '' AS monto_referencia, '' AS tipo_referencia, 
											'' AS folio_detalle, 'cargo' AS tipo, 
											SUM(ROUND((DAD.subtotal/A.tipo_cambio), 2) + 
												ROUND((DAD.iva/A.tipo_cambio), 2) + 
										        ROUND((DAD.ieps/A.tipo_cambio), 2)) AS importe
										FROM anticipos_devolucion AS AD
										INNER JOIN anticipos_devolucion_detalles AS DAD ON AD.anticipo_devolucion_id = DAD.anticipo_devolucion_id
										  	  AND DAD.referencia = 'FISCAL'
										INNER JOIN anticipos AS A ON DAD.referencia_id = A.anticipo_id
										WHERE AD.cuenta_bancaria_id = $intCuentaBancariaID
									    AND (DATE_FORMAT(AD.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
										AND AD.estatus = 'ACTIVO'
										GROUP BY AD.anticipo_devolucion_id";


		//Formar consulta
		$queryMovimientos .= $queryAjustesBancariosIngreso;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryPagos;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryTraspasoPagos;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryTraspasoAnticipos;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryTraspasoRecibosIngreso;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryTraspasoPolizasAbono;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryAjustesBancariosEgreso;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryPagosProveedores;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryAnticiposProveedores;
		$queryMovimientos .= " UNION ";
		$queryMovimientos .= $queryAnticiposDevolucion;
		$queryMovimientos .= " ORDER BY fecha, folio";

		$strSQL = $this->db->query($queryMovimientos);
		return $strSQL->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('CB.cuenta', $strBusqueda);
    	$this->db->or_like('CB.clabe', $strBusqueda);
    	$this->db->or_like('CB.contacto_nombre', $strBusqueda);
    	$this->db->or_like('CB.estatus', $strBusqueda);
    	$this->db->or_like('B.codigo', $strBusqueda);
    	$this->db->or_like('B.descripcion', $strBusqueda);
    	$this->db->or_like('M.codigo', $strBusqueda);
    	$this->db->or_like('M.descripcion', $strBusqueda);
		$this->db->from('cuentas_bancarias AS CB');
		$this->db->join('sat_bancos AS B', 'CB.banco_id = B.banco_id', 'inner');
		$this->db->join('sat_monedas AS M', 'CB.moneda_id = M.moneda_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CB.cuenta_bancaria_id, CB.cuenta, CB.clabe, CB.descripcion, CB.estatus, CB.contacto_nombre, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   CONCAT_WS(' - ', B.codigo, B.descripcion) AS banco", FALSE);
		$this->db->from('cuentas_bancarias AS CB');
		$this->db->join('sat_bancos AS B', 'CB.banco_id = B.banco_id', 'inner');
		$this->db->join('sat_monedas AS M', 'CB.moneda_id = M.moneda_id', 'inner');
		$this->db->like('CB.cuenta', $strBusqueda);
    	$this->db->or_like('CB.clabe', $strBusqueda);
    	$this->db->or_like('CB.contacto_nombre', $strBusqueda);
    	$this->db->or_like('CB.estatus', $strBusqueda);
    	$this->db->or_like('B.codigo', $strBusqueda);
    	$this->db->or_like('B.descripcion', $strBusqueda);
    	$this->db->or_like('M.codigo', $strBusqueda);
    	$this->db->or_like('M.descripcion', $strBusqueda);
		$this->db->order_by('CB.moneda_id, CB.cuenta', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["cuentas"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $intMonedaID)
	{
		$this->db->select("CB.cuenta_bancaria_id,  CB.cuenta, CB.clabe,
						   CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria, 
						   B.rfc AS rfc_banco", FALSE);
		$this->db->from('cuentas_bancarias AS CB');
		$this->db->join('sat_bancos AS B', 'CB.banco_id = B.banco_id', 'left');
		//Si existe id de la moneda
		if($intMonedaID > 0)
		{
			$this->db->where('CB.moneda_id', $intMonedaID);
		}
		$this->db->where('CB.estatus', 'ACTIVO');
		$this->db->where("((CB.cuenta LIKE '%$strDescripcion%') OR
						   (CB.descripcion LIKE '%$strDescripcion%'))"); 
		$this->db->order_by("CB.descripcion",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
		return $this->db->get()->result();
	}


	//Método para regresar los registros a un combobox
	public function get_combo_box($intMonedaID)
	{	
		$this->db->select("cuenta_bancaria_id AS value, 
						   CONCAT_WS(' - ', cuenta, descripcion) AS nombre", FALSE);
		$this->db->from('cuentas_bancarias');
		$this->db->where('moneda_id', $intMonedaID);
		$this->db->where('estatus', 'ACTIVO');
		$this->db->order_by('descripcion','ASC');
		return $this->db->get()->result();
	}

}
?>