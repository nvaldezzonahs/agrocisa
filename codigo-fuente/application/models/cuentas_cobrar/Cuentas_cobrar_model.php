<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentas_cobrar_model extends CI_model {

	public function buscar_importes_factura($intReferenciaID, $strTipoReferencia){

		//Dependiendo del tipo de referencia realizar la búsqueda de datos
		if($strTipoReferencia == 'MAQUINARIA')
		{
			$strSQL = $this->db->query("
										SELECT 	
									        (	ROUND(((	
													FM.precio  
									            ) * 100 ) / ( 	
									            				FM.precio + FM.iva + FM.ieps 
															), 2)	
									        ) AS PorcentajeSubtotal,
											(	
												ROUND(((	
													FM.iva  
									            ) * 100 ) / ( 	
									            				FM.precio + FM.iva + FM.ieps
															), 2)
									        ) AS PorcentajeIVA,
									        (	
												ROUND(((	
													FM.ieps
									            ) * 100 ) / ( 	
									            				FM.precio + FM.iva + FM.ieps
															), 2)
									        ) AS PorcentajeIEPS, 
											(
												FM.precio + FM.iva + FM.ieps + 
												IFNULL(NotasCargo.Total, 0) +
												IFNULL(NotasCargoDigitales.Total, 0)
									        ) AS ImporteTotal,
											(
												IFNULL(RecibosIngreso.Total, 0) + 
												IFNULL(NotasCreditoDigitales.Total, 0) + 
												IFNULL(PolizasAbono.Total, 0) +
												IFNULL(Pagos.Total, 0) +
									            IFNULL(Devoluciones.Total, 0)
											) AS ImporteAbonos,
											FM.tasa_cuota_iva AS TasaCuotaIva,
											( SELECT valor_maximo FROM sat_tasa_cuota WHERE tasa_cuota_id = FM.tasa_cuota_iva ) AS PorcentajeTasaCuotaIVA,
											FM.tasa_cuota_ieps AS TasaCuotaIeps,
											( SELECT valor_maximo FROM sat_tasa_cuota WHERE tasa_cuota_id = FM.tasa_cuota_ieps ) AS PorcentajeTasaCuotaIEPS
									FROM facturas_maquinaria FM
									LEFT JOIN(
											SELECT 	NCD.referencia_id AS referenciaID,
													SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
									                SUM(NCD.precio) AS Subtotal,
									                SUM(NCD.iva) AS IVA,
									                SUM(NCD.ieps) AS IEPS
											FROM notas_cargo_detalles NCD 
											INNER JOIN notas_cargo NC ON NC.nota_cargo_id = NCD.nota_cargo_id AND NC.estatus = 'ACTIVO'
											WHERE NCD.referencia = 'MAQUINARIA'
									        GROUP BY NCD.referencia_id
									) AS NotasCargo ON FM.factura_maquinaria_id = NotasCargo.referenciaID
									LEFT JOIN(
											SELECT 	NCD.referencia_id AS referenciaID,
													SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
									                SUM(NCD.precio) AS Subtotal,
									                SUM(NCD.iva) AS IVA,
									                SUM(NCD.ieps) AS IEPS
											FROM notas_cargo_digitales_detalles NCD 
											INNER JOIN notas_cargo_digitales NC ON NC.nota_cargo_digital_id = NCD.nota_cargo_digital_id AND NC.estatus = 'ACTIVO'
											WHERE NCD.referencia = 'MAQUINARIA'
									        GROUP BY NCD.referencia_id
									) AS NotasCargoDigitales ON FM.factura_maquinaria_id = NotasCargoDigitales.referenciaID
									LEFT JOIN(
											SELECT 	RID.referencia_id AS referenciaID,
													SUM(RID.precio + RID.iva + RID.ieps) AS Total,
									                SUM(RID.precio) AS Subtotal,
									                SUM(RID.iva) AS IVA,
									                SUM(RID.ieps) AS IEPS
											FROM recibos_ingreso_detalles RID
											INNER JOIN recibos_ingreso RI ON RI.recibo_ingreso_id = RID.recibo_ingreso_id AND RI.estatus = 'ACTIVO'
											WHERE RID.referencia = 'MAQUINARIA'
									        GROUP BY RID.referencia_id
									) AS RecibosIngreso ON FM.factura_maquinaria_id = RecibosIngreso.referenciaID
									LEFT JOIN(
											SELECT 	NCD.referencia_id AS referenciaID,
													SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
									                SUM(NCD.precio) AS Subtotal,
									                SUM(NCD.iva) AS IVA,
									                SUM(NCD.ieps) AS IEPS
											FROM notas_credito_digitales_detalles NCD
											INNER JOIN notas_credito_digitales NC ON NC.nota_credito_digital_id = NCD.nota_credito_digital_id AND NC.estatus = 'ACTIVO'
											WHERE NCD.referencia = 'MAQUINARIA'
									        GROUP BY NCD.referencia_id
									) AS NotasCreditoDigitales ON FM.factura_maquinaria_id = NotasCreditoDigitales.referenciaID 
									LEFT JOIN(
											SELECT 	PAD.referencia_id AS referenciaID,
													SUM(PAD.precio + PAD.iva + PAD.ieps) AS Total,
									                SUM(PAD.precio) AS Subtotal,
									                SUM(PAD.iva) AS IVA,
									                SUM(PAD.ieps) AS IEPS
											FROM polizas_abono_detalles_02 PAD
											INNER JOIN polizas_abono_02 PA ON PA.poliza_abono_id = PAD.poliza_abono_id AND PA.estatus = 'ACTIVO'
											WHERE PAD.referencia = 'MAQUINARIA'
									        GROUP BY PAD.referencia_id
									) AS PolizasAbono ON FM.factura_maquinaria_id = PolizasAbono.referenciaID
									LEFT JOIN(
											SELECT 	PDR.referencia_id AS referenciaID,
													SUM(PDR.imp_pagado) AS Total,
									                SUM(PDR.imp_pagado) AS Subtotal
											FROM pagos_detalles_relacionados_02 PDR
											INNER JOIN pagos P ON P.pago_id = PDR.pago_id AND P.estatus = 'ACTIVO'
											WHERE PDR.tipo_referencia = 'MAQUINARIA'
									        GROUP BY PDR.referencia_id
									) AS Pagos ON FM.factura_maquinaria_id = Pagos.referenciaID
									LEFT JOIN(
											SELECT 	MM.referencia_id AS referenciaID,
													SUM(FM.precio + FM.iva + FM.ieps) AS Total,
									                SUM(FM.precio) AS Subtotal,
									                SUM(FM.iva) AS IVA,
									                SUM(FM.ieps) AS IEPS
											FROM movimientos_maquinaria MM
											INNER JOIN facturas_maquinaria FM ON FM.factura_maquinaria_id = MM.referencia_id AND MM.estatus = 'ACTIVO'
									        WHERE MM.tipo_movimiento = ".ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA."
									        GROUP BY MM.referencia_id
									) AS Devoluciones ON FM.factura_maquinaria_id = Devoluciones.referenciaID
									WHERE FM.factura_maquinaria_id = $intReferenciaID;");
		}
		else if($strTipoReferencia == 'REFACCIONES')
		{

			$strSQL = $this->db->query("
										SELECT 
										(	ROUND(((	
													IFNULL(RefaccionesDetalles.Subtotal, 0) + 
													IFNULL(FR.gastos_paqueteria, 0) 
												) * 100 ) / ( 	IFNULL(RefaccionesDetalles.Total, 0) +
																IFNULL(FR.gastos_paqueteria, 0) + 
																IFNULL(FR.gastos_paqueteria_iva, 0)
															), 2)	
										 ) AS PorcentajeSubtotal,
										(	
												ROUND(((	
													IFNULL(RefaccionesDetalles.IVA, 0) +
													IFNULL(FR.gastos_paqueteria_iva, 0) 
												) * 100 ) / ( 	IFNULL(RefaccionesDetalles.Total, 0) +
																IFNULL(FR.gastos_paqueteria, 0) + 
																IFNULL(FR.gastos_paqueteria_iva, 0)
															), 2)
										 ) AS PorcentajeIVA,
										(	
											ROUND(((	
													IFNULL(RefaccionesDetalles.IEPS, 0) 
												) * 100 ) / ( 	IFNULL(RefaccionesDetalles.Total, 0) +
																IFNULL(FR.gastos_paqueteria, 0) + 
																IFNULL(FR.gastos_paqueteria_iva, 0)
															), 2)
										) AS PorcentajeIEPS, 
										( 	
											ROUND( IFNULL(RefaccionesDetalles.Total, 0) ,2) +
											ROUND( IFNULL(FR.gastos_paqueteria, 0) ,2) + 
									        ROUND( IFNULL(FR.gastos_paqueteria_iva, 0) ,2) + 
									        ROUND( IFNULL(NotasCargo.Total, 0) ,2) +
									        ROUND( IFNULL(NotasCargoDigitales.Total, 0) ,2)
										) AS ImporteTotal,
									    (
											ROUND( IFNULL(RecibosIngreso.Total, 0) ,2) + 
											ROUND( IFNULL(NotasCreditoDigitales.Total, 0) ,2) + 
											ROUND( IFNULL(PolizasAbono.Total, 0) ,2) +
											ROUND( IFNULL(Pagos.Total, 0) ,2) +
											ROUND( IFNULL(Devoluciones.Total, 0) ,2)
										) AS ImporteAbonos,
									    (
											ROUND( IFNULL(RefaccionesDetalles.Total, 0) ,2) +
											ROUND( IFNULL(FR.gastos_paqueteria, 0) ,2) + 
									        ROUND( IFNULL(FR.gastos_paqueteria_iva, 0) ,2) + 
									        ROUND( IFNULL(NotasCargo.Total, 0) ,2) +
									        ROUND( IFNULL(NotasCargoDigitales.Total, 0) ,2) -
											ROUND( IFNULL(RecibosIngreso.Total, 0) ,2) - 
											ROUND( IFNULL(NotasCreditoDigitales.Total, 0) ,2) - 
											ROUND( IFNULL(PolizasAbono.Total, 0) ,2) -
											ROUND( IFNULL(Pagos.Total, 0) ,2) -
											ROUND( IFNULL(Devoluciones.Total, 0) ,2)
										) AS ImporteSaldo,
										RefaccionesDetalles.TasaCuotaIva AS TasaCuotaIva,
										IFNULL( (SELECT valor_maximo FROM sat_tasa_cuota WHERE tasa_cuota_id = RefaccionesDetalles.TasaCuotaIva), 0) AS PorcentajeTasaCuotaIVA,
										RefaccionesDetalles.TasaCuotaIeps AS TasaCuotaIeps, 
										IFNULL( (SELECT valor_maximo FROM sat_tasa_cuota WHERE tasa_cuota_id = RefaccionesDetalles.TasaCuotaIeps), 0) AS PorcentajeTasaCuotaIEPS
									FROM facturas_refacciones FR
									INNER JOIN (
										SELECT 	FRD.factura_refacciones_id AS referenciaID,
												MAX(FRD.tasa_cuota_iva) AS TasaCuotaIva,
									            MAX(FRD.tasa_cuota_ieps) AS TasaCuotaIeps,
												SUM( FRD.cantidad * (FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) ) AS Total,
									            SUM( FRD.cantidad * FRD.precio_unitario ) AS Subtotal,
									            SUM( FRD.cantidad * FRD.iva_unitario ) AS IVA,
									            SUM( FRD.cantidad * FRD.ieps_unitario ) AS IEPS
											FROM facturas_refacciones_detalles FRD
									        GROUP BY FRD.factura_refacciones_id
									) AS RefaccionesDetalles ON RefaccionesDetalles.referenciaID = FR.factura_refacciones_id
									LEFT JOIN(
											SELECT 	NCD.referencia_id AS referenciaID,
													SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
									                SUM(NCD.precio) AS Subtotal,
									                SUM(NCD.iva) AS IVA,
									                SUM(NCD.ieps) AS IEPS
											FROM notas_cargo_detalles NCD 
											INNER JOIN notas_cargo NC ON NC.nota_cargo_id = NCD.nota_cargo_id AND NC.estatus = 'ACTIVO'
											WHERE NCD.referencia = 'REFACCIONES'
									        GROUP BY NCD.referencia_id
									) AS NotasCargo ON FR.factura_refacciones_id = NotasCargo.referenciaID
									LEFT JOIN(
											SELECT 	NCD.referencia_id AS referenciaID,
													SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
									                SUM(NCD.precio) AS Subtotal,
									                SUM(NCD.iva) AS IVA,
									                SUM(NCD.ieps) AS IEPS
											FROM notas_cargo_digitales_detalles NCD 
											INNER JOIN notas_cargo_digitales NC ON NC.nota_cargo_digital_id = NCD.nota_cargo_digital_id AND NC.estatus = 'ACTIVO'
											WHERE NCD.referencia = 'REFACCIONES'
									        GROUP BY NCD.referencia_id
									) AS NotasCargoDigitales ON FR.factura_refacciones_id = NotasCargoDigitales.referenciaID
									LEFT JOIN(
											SELECT 	RID.referencia_id AS referenciaID,
													SUM(RID.precio + RID.iva + RID.ieps) AS Total,
									                SUM(RID.precio) AS Subtotal,
									                SUM(RID.iva) AS IVA,
									                SUM(RID.ieps) AS IEPS
											FROM recibos_ingreso_detalles RID
											INNER JOIN recibos_ingreso RI ON RI.recibo_ingreso_id = RID.recibo_ingreso_id AND RI.estatus = 'ACTIVO'
											WHERE RID.referencia = 'REFACCIONES'
									        GROUP BY RID.referencia_id
									) AS RecibosIngreso ON FR.factura_refacciones_id = RecibosIngreso.referenciaID
									LEFT JOIN(
											SELECT 	NCD.referencia_id AS referenciaID,
													SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
									                SUM(NCD.precio) AS Subtotal,
									                SUM(NCD.iva) AS IVA,
									                SUM(NCD.ieps) AS IEPS
											FROM notas_credito_digitales_detalles NCD
											INNER JOIN notas_credito_digitales NC ON NC.nota_credito_digital_id = NCD.nota_credito_digital_id AND NC.estatus = 'ACTIVO'
											WHERE NCD.referencia = 'REFACCIONES'
									        GROUP BY NCD.referencia_id
									) AS NotasCreditoDigitales ON FR.factura_refacciones_id = NotasCreditoDigitales.referenciaID 
									LEFT JOIN(
											SELECT 	PAD.referencia_id AS referenciaID,
													SUM(PAD.precio + PAD.iva + PAD.ieps) AS Total,
									                SUM(PAD.precio) AS Subtotal,
									                SUM(PAD.iva) AS IVA,
									                SUM(PAD.ieps) AS IEPS
											FROM polizas_abono_detalles_02 PAD
											INNER JOIN polizas_abono_02 PA ON PA.poliza_abono_id = PAD.poliza_abono_id AND PA.estatus = 'ACTIVO'
											WHERE PAD.referencia = 'REFACCIONES'
									        GROUP BY PAD.referencia_id
									) AS PolizasAbono ON FR.factura_refacciones_id = PolizasAbono.referenciaID
									LEFT JOIN(
											SELECT 	PDR.referencia_id AS referenciaID,
													SUM(PDR.imp_pagado) AS Total,
									                SUM(PDR.imp_pagado) AS Subtotal
											FROM pagos_detalles_relacionados_02 PDR
											INNER JOIN pagos P ON P.pago_id = PDR.pago_id AND P.estatus = 'ACTIVO'
											WHERE PDR.tipo_referencia = 'REFACCIONES'
									        GROUP BY PDR.referencia_id
									) AS Pagos ON FR.factura_refacciones_id = Pagos.referenciaID
									LEFT JOIN(
											SELECT 
												FR.factura_refacciones_id AS referenciaID,
												SUM( MRD.cantidad * (FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) ) AS Total,
											    SUM(MRD.cantidad * FRD.precio_unitario ) AS Subtotal,
												SUM(MRD.cantidad * FRD.iva_unitario) AS IVA,
												SUM(MRD.cantidad * FRD.ieps_unitario) AS IEPS
											FROM facturas_refacciones FR
											INNER JOIN facturas_refacciones_detalles FRD ON FRD.factura_refacciones_id = FR.factura_refacciones_id
											INNER JOIN movimientos_refacciones MR ON MR.referencia_id = FR.factura_refacciones_id 
											INNER JOIN movimientos_refacciones_detalles MRD ON MRD.movimiento_refacciones_id = MR.movimiento_refacciones_id AND MRD.refaccion_id = FRD.refaccion_id AND MRD.renglon = FRD.renglon
											WHERE MR.estatus = 'ACTIVO'
											AND MR.tipo_movimiento = ".ENTRADA_REFACCIONES_DEVOLUCION_FACTURA."
											AND MR.tipo_referencia = 'REFACCIONES'
											GROUP BY FR.factura_refacciones_id
										) AS Devoluciones ON FR.factura_refacciones_id = Devoluciones.referenciaID		
									WHERE FR.factura_refacciones_id = $intReferenciaID; ");	
		}
		else //SERVICIO
		{
			
			$strSQL = $this->db->query("
										SELECT 
										(	
												ROUND(((	
													IFNULL(FS.gastos_servicio, 0) + 
									                IFNULL(ManoObra.Subtotal, 0) + 
									                IFNULL(Refacciones.Subtotal, 0) + 
									                IFNULL(Foraneos.Subtotal, 0) + 
									                IFNULL(Otros.Subtotal, 0)
									            ) * 100 ) / ( 	IFNULL(FS.gastos_servicio, 0) + 
																IFNULL(FS.gastos_servicio_iva, 0) + 
																IFNULL(ManoObra.Total, 0) + 
																IFNULL(Refacciones.Total, 0) + 
																IFNULL(Foraneos.Total, 0) + 
																IFNULL(Otros.Total, 0)
															), 2)
									     ) AS PorcentajeSubtotal,
										(	
												ROUND(((	
													IFNULL(FS.gastos_servicio_iva, 0) + 
									                IFNULL(ManoObra.IVA, 0) + 
									                IFNULL(Refacciones.IVA, 0) + 
									                IFNULL(Foraneos.IVA, 0) + 
									                IFNULL(Otros.IVA, 0)
									            ) * 100 ) / ( 	IFNULL(FS.gastos_servicio, 0) + 
																IFNULL(FS.gastos_servicio_iva, 0) + 
																IFNULL(ManoObra.Total, 0) + 
																IFNULL(Refacciones.Total, 0) + 
																IFNULL(Foraneos.Total, 0) + 
																IFNULL(Otros.Total, 0)
															), 2)
									     ) AS PorcentajeIVA,
									     (	
												ROUND(((	
									                IFNULL(ManoObra.IEPS, 0) + 
									                IFNULL(Refacciones.IEPS, 0) + 
									                IFNULL(Foraneos.IEPS, 0) + 
									                IFNULL(Otros.IEPS, 0)
									            ) * 100 ) / ( 	IFNULL(FS.gastos_servicio, 0) + 
																IFNULL(FS.gastos_servicio_iva, 0) + 
																IFNULL(ManoObra.Total, 0) + 
																IFNULL(Refacciones.Total, 0) + 
																IFNULL(Foraneos.Total, 0) + 
																IFNULL(Otros.Total, 0)
															), 2)
									     ) AS PorcentajeIEPS,
										( 
											IFNULL(FS.gastos_servicio, 0) + 
											IFNULL(FS.gastos_servicio_iva, 0) + 
											IFNULL(ManoObra.Total, 0) + 
											IFNULL(Refacciones.Total, 0) + 
											IFNULL(Foraneos.Total, 0) + 
											IFNULL(Otros.Total, 0) +
											IFNULL(NotasCargo.Total, 0) +
											IFNULL(NotasCargoDigitales.Total, 0)
										) AS ImporteTotal,
										(
											IFNULL(RecibosIngreso.Total, 0) + 
											IFNULL(NotasCreditoDigitales.Total, 0) + 
											IFNULL(PolizasAbono.Total, 0) +
											IFNULL(Pagos.Total, 0) +
											IFNULL(Devoluciones.Total, 0)
										) AS ImporteAbonos,
									    (
											IFNULL(FS.gastos_servicio, 0) + 
											IFNULL(FS.gastos_servicio_iva, 0) + 
											IFNULL(ManoObra.Total, 0) + 
											IFNULL(Refacciones.Total, 0) + 
											IFNULL(Foraneos.Total, 0) + 
											IFNULL(Otros.Total, 0) +
											IFNULL(NotasCargo.Total, 0) +
											IFNULL(NotasCargoDigitales.Total, 0) -
											IFNULL(RecibosIngreso.Total, 0) - 
											IFNULL(NotasCreditoDigitales.Total, 0) - 
											IFNULL(PolizasAbono.Total, 0) -
											IFNULL(Pagos.Total, 0) -
											IFNULL(Devoluciones.Total, 0)
										) AS ImporteSaldo,
										GREATEST(ManoObra.TasaCuotaIVA, Refacciones.TasaCuotaIVA, Foraneos.TasaCuotaIVA, Otros.TasaCuotaIVA) AS TasaCuotaIva,
										( SELECT valor_maximo FROM sat_tasa_cuota WHERE tasa_cuota_id = GREATEST(ManoObra.TasaCuotaIVA, Refacciones.TasaCuotaIVA, Foraneos.TasaCuotaIVA, Otros.TasaCuotaIVA) ) AS PorcentajeTasaCuotaIVA,
										GREATEST(ManoObra.TasaCuotaIEPS, Refacciones.TasaCuotaIEPS, Foraneos.TasaCuotaIEPS, Otros.TasaCuotaIEPS) AS TasaCuotaIeps,
										( SELECT valor_maximo FROM sat_tasa_cuota WHERE tasa_cuota_id = GREATEST(ManoObra.TasaCuotaIEPS, Refacciones.TasaCuotaIEPS, Foraneos.TasaCuotaIEPS, Otros.TasaCuotaIEPS) ) AS PorcentajeTasaCuotaIEPS
									FROM facturas_servicio FS
									LEFT JOIN(
										SELECT 	FSMO.factura_servicio_id AS referenciaID,
												MAX(FSMO.tasa_cuota_iva) AS TasaCuotaIVA,
												MAX(FSMO.tasa_cuota_ieps) AS TasaCuotaIEPS,
									            SUM( FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) AS Total,
												SUM(FSMO.precio_unitario) AS Subtotal,
												SUM(FSMO.iva_unitario) AS IVA,
												SUM(FSMO.ieps_unitario) AS IEPS
										FROM facturas_servicio_mano_obra FSMO
										GROUP BY FSMO.factura_servicio_id
									) AS ManoObra ON ManoObra.referenciaID = FS.factura_servicio_id 
									LEFT JOIN(
										SELECT 	FSR.factura_servicio_id AS referenciaID,
												MAX(FSR.tasa_cuota_iva) AS TasaCuotaIVA,
												MAX(FSR.tasa_cuota_ieps) AS TasaCuotaIEPS,
									            SUM( FSR.cantidad * (FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) ) AS Total,
									            SUM( FSR.cantidad * FSR.precio_unitario) AS Subtotal,
												SUM( FSR.cantidad * FSR.iva_unitario ) AS IVA,
												SUM( FSR.cantidad * FSR.ieps_unitario ) AS IEPS
										FROM facturas_servicio_refacciones FSR
										GROUP BY FSR.factura_servicio_id
									) AS Refacciones ON Refacciones.referenciaID = FS.factura_servicio_id
									LEFT JOIN(
										SELECT 	FSTF.factura_servicio_id AS referenciaID,
												MAX(FSTF.tasa_cuota_iva) AS TasaCuotaIVA,
												MAX(FSTF.tasa_cuota_ieps) AS TasaCuotaIEPS,
									            SUM( FSTF.cantidad * (FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) ) AS Total,
									            SUM( FSTF.cantidad * FSTF.precio_unitario) AS Subtotal,
												SUM( FSTF.cantidad * FSTF.iva_unitario ) AS IVA,
												SUM( FSTF.cantidad * FSTF.ieps_unitario ) AS IEPS
										FROM facturas_servicio_trabajos_foraneos FSTF
										GROUP BY FSTF.factura_servicio_id
									) AS Foraneos ON Foraneos.referenciaID = FS.factura_servicio_id
									LEFT JOIN(
										SELECT 	FSO.factura_servicio_id AS referenciaID,
												MAX(FSO.tasa_cuota_iva) AS TasaCuotaIVA,
												MAX(FSO.tasa_cuota_ieps) AS TasaCuotaIEPS,
									            SUM( FSO.cantidad * (FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) ) AS Total,
									            SUM( FSO.cantidad * FSO.precio_unitario ) AS Subtotal,
												SUM( FSO.cantidad * FSO.iva_unitario ) AS IVA,
												SUM( FSO.cantidad * FSO.ieps_unitario ) AS IEPS
										FROM facturas_servicio_otros FSO
										GROUP BY FSO.factura_servicio_id
									) AS Otros ON Otros.referenciaID = FS.factura_servicio_id
									LEFT JOIN(
											SELECT 	NCD.referencia_id AS referenciaID,
													SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
									                SUM(NCD.precio) AS Subtotal,
									                SUM(NCD.iva) AS IVA,
									                SUM(NCD.ieps) AS IEPS
											FROM notas_cargo_detalles NCD 
											INNER JOIN notas_cargo NC ON NC.nota_cargo_id = NCD.nota_cargo_id AND NC.estatus = 'ACTIVO'
											WHERE NCD.referencia = 'SERVICIO'
											GROUP BY NCD.referencia_id
									) AS NotasCargo ON FS.factura_servicio_id = NotasCargo.referenciaID
									LEFT JOIN(
											SELECT 	NCD.referencia_id AS referenciaID,
													SUM(NCD.precio) AS Total,
									                SUM(NCD.precio - NCD.iva - NCD.ieps) AS Subtotal,
									                SUM(NCD.iva) AS IVA,
									                SUM(NCD.ieps) AS IEPS
											FROM notas_cargo_digitales_detalles NCD 
											INNER JOIN notas_cargo_digitales NC ON NC.nota_cargo_digital_id = NCD.nota_cargo_digital_id AND NC.estatus = 'ACTIVO'
											WHERE NCD.referencia = 'SERVICIO'
											GROUP BY NCD.referencia_id
									) AS NotasCargoDigitales ON FS.factura_servicio_id = NotasCargoDigitales.referenciaID
									LEFT JOIN(
											SELECT 	RID.referencia_id AS referenciaID,
													SUM(RID.precio + RID.iva + RID.ieps) AS Total,
									                SUM(RID.precio) AS Subtotal,
									                SUM(RID.iva) AS IVA,
									                SUM(RID.ieps) AS IEPS
											FROM recibos_ingreso_detalles RID
											INNER JOIN recibos_ingreso RI ON RI.recibo_ingreso_id = RID.recibo_ingreso_id AND RI.estatus = 'ACTIVO'
											WHERE RID.referencia = 'SERVICIO'
											GROUP BY RID.referencia_id
									) AS RecibosIngreso ON FS.factura_servicio_id = RecibosIngreso.referenciaID
									LEFT JOIN(
											SELECT 	NCD.referencia_id AS referenciaID,
													SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
									                SUM(NCD.precio) AS Subtotal,
									                SUM(NCD.iva) AS IVA,
									                SUM(NCD.ieps) AS IEPS
											FROM notas_credito_digitales_detalles NCD
											INNER JOIN notas_credito_digitales NC ON NC.nota_credito_digital_id = NCD.nota_credito_digital_id AND NC.estatus = 'ACTIVO'
											WHERE NCD.referencia = 'SERVICIO'
											GROUP BY NCD.referencia_id
									) AS NotasCreditoDigitales ON FS.factura_servicio_id = NotasCreditoDigitales.referenciaID 
									LEFT JOIN(
											SELECT 	PAD.referencia_id AS referenciaID,
													SUM(PAD.precio + PAD.iva + PAD.ieps) AS Total,
									                SUM(PAD.precio) AS Subtotal,
									                SUM(PAD.iva) AS IVA,
									                SUM(PAD.ieps) AS IEPS
											FROM polizas_abono_detalles_02 PAD
											INNER JOIN polizas_abono_02 PA ON PA.poliza_abono_id = PAD.poliza_abono_id AND PA.estatus = 'ACTIVO'
											WHERE PAD.referencia = 'SERVICIO'
											GROUP BY PAD.referencia_id
									) AS PolizasAbono ON FS.factura_servicio_id = PolizasAbono.referenciaID
									LEFT JOIN(
											SELECT 	PDR.referencia_id AS referenciaID,
													SUM(PDR.imp_pagado) AS Total,
									                SUM(PDR.imp_pagado) AS Subtotal
											FROM pagos_detalles_relacionados_02 PDR
											INNER JOIN pagos P ON P.pago_id = PDR.pago_id AND P.estatus = 'ACTIVO'
											WHERE PDR.tipo_referencia = 'SERVICIO'
											GROUP BY PDR.referencia_id
									) AS Pagos ON FS.factura_servicio_id = Pagos.referenciaID
									LEFT JOIN(
									        SELECT 
												FR.factura_refacciones_id AS referenciaID,
												SUM( MRD.cantidad * (FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) ) AS Total,
											    SUM(MRD.cantidad * FRD.precio_unitario ) AS Subtotal,
												SUM(MRD.cantidad * FRD.iva_unitario) AS IVA,
												SUM(MRD.cantidad * FRD.ieps_unitario) AS IEPS
											FROM facturas_refacciones FR
											INNER JOIN facturas_refacciones_detalles FRD ON FRD.factura_refacciones_id = FR.factura_refacciones_id
											INNER JOIN movimientos_refacciones MR ON MR.referencia_id = FR.factura_refacciones_id 
											INNER JOIN movimientos_refacciones_detalles MRD ON MRD.movimiento_refacciones_id = MR.movimiento_refacciones_id AND MRD.refaccion_id = FRD.refaccion_id AND MRD.renglon = FRD.renglon
											WHERE MR.estatus = 'ACTIVO'
											AND MR.tipo_movimiento = ".ENTRADA_REFACCIONES_DEVOLUCION_FACTURA."
											AND MR.tipo_referencia = 'SERVICIO'
											GROUP BY FR.factura_refacciones_id
									) AS Devoluciones ON FS.factura_servicio_id = Devoluciones.referenciaID
									WHERE FS.factura_servicio_id = $intReferenciaID;

								");	
		}	
		
		return $strSQL->result();

	}

	/*******************************************************************************************************************
	Funciones que corresponden a las facturas, pagos y anticipos del cliente
	*********************************************************************************************************************/
	/*Método para regresar el anticipo de las facturas del cliente 
	  que coincida con los criterios de búsqueda proporcionados (se utiliza en el reporte de facturas con adeudos)*/
	public function buscar_anticipo_facturas_adeudos($strOpcion, $dteFechaCorte, $intProspectoID = NULL, $intMonedaID = NULL)
	{
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones =  '';

		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			$strRestricciones .= " AND A.prospecto_id = $intProspectoID";
		}


		//Si el tipo de opción corresponde al reporte, significa que la información se va a mostrar en un reporte,
		//de lo contrario, se mostrará en el grid view -> facturas que adeuda el cliente
		if($strOpcion == 'reporte')
		{
			$strSQL = $this->db->query("SELECT SUM((A.subtotal + A.iva + A.ieps) / A.tipo_cambio)  total_anticipo
										FROM  anticipos AS A
										WHERE DATE_FORMAT(A.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
										AND A.moneda_id = $intMonedaID
										$strRestricciones
										AND (A.estatus = 'ACTIVO' OR A.estatus = 'TIMBRAR')
										GROUP BY  A.prospecto_id");


		}
		else
		{
			$strSQL = $this->db->query("SELECT ((A.subtotal + A.iva + A.ieps) / A.tipo_cambio)  importe, 
											    A.moneda_id, A.tipo_cambio
										FROM  anticipos AS A
										WHERE DATE_FORMAT(A.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
										AND  A.prospecto_id = $intProspectoID
										AND (A.estatus = 'ACTIVO' OR A.estatus = 'TIMBRAR')");	
		}
		
		return $strSQL->result();
	}


	/*Método para regresar los anticipos aplicados de las facturas del cliente 
	  que coincida con los criterios de búsqueda proporcionados (se utiliza en el reporte de facturas con adeudos)*/
	public function buscar_aplicacion_anticipo_facturas_adeudos($strOpcion, $dteFechaCorte, $intProspectoID = NULL, $intMonedaID = NULL)
	{
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones =  '';

		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			$strRestricciones .= " AND A.prospecto_id = $intProspectoID";
		}


		//Si el tipo de opción corresponde al reporte, significa que la información se va a mostrar en un reporte,
		//de lo contrario, se mostrará en el grid view -> facturas que adeuda el cliente
		if($strOpcion == 'reporte')
		{
			$strSQL = $this->db->query("SELECT SUM((A.subtotal + A.iva + A.ieps) / A.tipo_cambio)  total_anticipo
										FROM  anticipos_aplicacion AS A
										WHERE DATE_FORMAT(A.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
										AND A.moneda_id = $intMonedaID
										$strRestricciones
										AND (A.estatus = 'ACTIVO' OR A.estatus = 'TIMBRAR')
										GROUP BY  A.prospecto_id");


		}
		else
		{
			$strSQL = $this->db->query("SELECT ((A.subtotal + A.iva + A.ieps) / A.tipo_cambio)  importe, 
											    A.moneda_id, A.tipo_cambio
										FROM  anticipos_aplicacion AS A
										WHERE DATE_FORMAT(A.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
										AND  A.prospecto_id = $intProspectoID
										AND (A.estatus = 'ACTIVO' OR A.estatus = 'TIMBRAR')");	
		}
		
		return $strSQL->result();
	}


	/*Método para regresar los saldos de las facturas con adeudos del cliente 
	  que coincida con los criterios de búsqueda proporcionados*/
	public function buscar_saldos_facturas_adeudos($strOpcion, $dteFechaCorte, $intProspectoID = NULL, $intMonedaID = NULL, $arrSucursales = NULL, $arrModulos = NULL)
	{
		//Constante para identificar al tipo de movimiento entrada de maquinaria por devolución de la factura
		$intMovDevMaq = ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA;
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución de la factura
		$intMovDevRef = ENTRADA_REFACCIONES_DEVOLUCION_FACTURA;
		//Constante para identificar el método de pago: pago en parcialidades o diferido
		$intMetodoPagoIDPPD = METODO_PAGO_PPD;
		//Constante para identificar el método de pago: pago en una sola exhibición
		$intMetodoPagoIDPUE = METODO_PAGO_BASE;

		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';
		//Variable que se utiliza para ordenar los registros dependiendo del tipo de búsqueda
		$strOrdenamiento = "ORDER BY ";

		//Si existe id de la moneda
		if($intMonedaID > 0)
		{
			$strRestricciones .= " AND M.moneda_id = $intMonedaID";
		}
		
		//Si existe id del cliente
		if($intProspectoID > 0)
		{
			$strRestricciones .= " AND C.prospecto_id = $intProspectoID";
		}

		
		//Variables para generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
		$sucursales = explode('|', $arrSucursales);
		$strSucursalesMaq = '';
		$strSucursalesRef = '';
		$strSucursalesSer = '';
		$strSucursalesCar = '';

		for ($i = 0; $i<sizeof($sucursales); $i++) {
		    if($i == 0){
		    	
		    	$strSucursalesMaq .= 'AND ( ';
		    	$strSucursalesMaq .= 'FM.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesRef .= 'AND ( ';
		    	$strSucursalesRef .= 'FR.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesSer .= 'AND ( ';
		    	$strSucursalesSer .= 'FS.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesCar .= 'AND ( ';
		    	$strSucursalesCar .= 'CT.sucursal_id = '.$sucursales[$i];

		    }
		    else{

		    	$strSucursalesMaq .= ' OR FM.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesRef .= ' OR FR.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesSer .= ' OR FS.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesCar .= ' OR CT.sucursal_id = '.$sucursales[$i];
		    
		    }
		}

		$strSucursalesMaq .= ')';
		$strSucursalesRef .= ')';
		$strSucursalesSer .= ')';
		$strSucursalesCar .= ')';

		//Si el tipo de opción corresponde al reporte, significa que la información se va a mostrar en un reporte
		//de lo contrario se mostrará en el grid view -> facturas que adeuda el cliente
		if($strOpcion == 'reporte')
		{
			$strOrdenamiento .= "moneda_id, nombre_comercial, fecha, folio";
		}
		else
		{
			$strOrdenamiento .= "fecha, folio";
		}



		//Variables para definir que tipos de módulo se incluiran en la búsqueda
		$queryMaquinaria = "
							SELECT 	 
								FM.factura_maquinaria_id AS referencia_id,
								'MAQUINARIA' AS tipo_referencia,
								FM.uuid,
								FM.folio,
								FM.moneda_id,
								M.codigo AS moneda_tipo,
								FM.tipo_cambio,
								FM.metodo_pago_id,
								MP.codigo AS metodo_pago,
								FM.fecha,
								FM.vencimiento AS fecha_vencimiento,
								DATE_FORMAT(FM.fecha, '%d/%m/%Y') AS fecha_format,
								DATE_FORMAT(FM.vencimiento, '%d/%m/%Y') AS fecha_vencimiento_format,
								C.prospecto_id,
								C.nombre_comercial,
								C.maquinaria_credito_dias AS dias_credito,
								C.maquinaria_credito_limite AS limite_credito,
								'MAQUINARIA' AS referencia,
								CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
						        ((FM.precio + ROUND(FM.iva, 2) + ROUND(FM.ieps, 2)) / FM.tipo_cambio) AS importe,
						        (
									((FM.precio + ROUND(FM.iva, 2) + ROUND(FM.ieps, 2)) / FM.tipo_cambio) 
									+ IFNULL(NotasCargo.Total/NotasCargo.TipoCambio, 0) 
									+ IFNULL(NotasCargoDigitales.Total/NotasCargoDigitales.TipoCambio, 0)
						            - IFNULL(RecibosIngreso.Total/RecibosIngreso.TipoCambio, 0) 
									- IFNULL(NotasCreditoDigitales.Total/NotasCreditoDigitales.TipoCambio, 0) 
									- IFNULL(PolizasAbono.Total/PolizasAbono.TipoCambio, 0) 
									- IFNULL(Pagos.Total/Pagos.TipoCambio, 0) 
									- IFNULL(
											(
												SELECT 
													((FMM.precio + ROUND(FMM.iva, 2) + ROUND(FMM.ieps, 2)) / FMM.tipo_cambio) AS total
												FROM movimientos_maquinaria AS MM
												INNER JOIN facturas_maquinaria AS FMM ON MM.referencia_id = FMM.factura_maquinaria_id
												WHERE MM.referencia_id = FM.factura_maquinaria_id
												AND MM.tipo_movimiento = $intMovDevMaq
												AND DATE_FORMAT(MM.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
												AND MM.estatus = 'ACTIVO'), 0) 
						            
								) AS saldo,
								(
									IFNULL(RecibosIngreso.Total/RecibosIngreso.TipoCambio, 0) + 
									IFNULL(NotasCreditoDigitales.Total/NotasCreditoDigitales.TipoCambio, 0) + 
									IFNULL(PolizasAbono.Total/PolizasAbono.TipoCambio, 0) +
									IFNULL(Pagos.Total/Pagos.TipoCambio, 0) +
									IFNULL(
											(
												SELECT 
													((FMM.precio + ROUND(FMM.iva, 2) + ROUND(FMM.ieps, 2)) / FMM.tipo_cambio) AS total
												FROM movimientos_maquinaria AS MM
												INNER JOIN facturas_maquinaria AS FMM ON MM.referencia_id = FMM.factura_maquinaria_id
												WHERE MM.referencia_id = FM.factura_maquinaria_id
												AND MM.tipo_movimiento = $intMovDevMaq
												AND DATE_FORMAT(MM.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
												AND MM.estatus = 'ACTIVO'), 0)
								) AS parcialidades
							FROM facturas_maquinaria FM
							INNER JOIN clientes C ON C.prospecto_id = FM.prospecto_id
							INNER JOIN sat_monedas AS M ON FM.moneda_id = M.moneda_id
							INNER JOIN sat_metodos_pago AS MP ON FM.metodo_pago_id = MP.metodo_pago_id
							LEFT JOIN(
									SELECT 	NCD.referencia_id AS referenciaID,
											MAX(NC.tipo_cambio) AS TipoCambio,
											SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
											SUM(NCD.precio) AS Subtotal,
											SUM(NCD.iva) AS IVA,
											SUM(NCD.ieps) AS IEPS
									FROM notas_cargo_detalles NCD 
									INNER JOIN notas_cargo NC ON NC.nota_cargo_id = NCD.nota_cargo_id
							        WHERE NCD.referencia = 'MAQUINARIA'
									AND DATE_FORMAT(NC.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
									AND NC.estatus = 'ACTIVO'
									GROUP BY NCD.referencia_id
							) AS NotasCargo ON FM.factura_maquinaria_id = NotasCargo.referenciaID
							LEFT JOIN(
									SELECT 	NCD.referencia_id AS referenciaID,
											MAX(NC.tipo_cambio) AS TipoCambio,
											SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
											SUM(NCD.precio) AS Subtotal,
											SUM(NCD.iva) AS IVA,
											SUM(NCD.ieps) AS IEPS
									FROM notas_cargo_digitales_detalles NCD 
									INNER JOIN notas_cargo_digitales NC ON NC.nota_cargo_digital_id = NCD.nota_cargo_digital_id
							        WHERE NCD.referencia = 'MAQUINARIA'
									AND DATE_FORMAT(NC.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
									AND (NC.estatus = 'ACTIVO' OR NC.estatus = 'TIMBRAR')
									GROUP BY NCD.referencia_id
							) AS NotasCargoDigitales ON FM.factura_maquinaria_id = NotasCargoDigitales.referenciaID
							LEFT JOIN(
									SELECT 	RID.referencia_id AS referenciaID,
											MAX(RI.tipo_cambio) AS TipoCambio,
											SUM(RID.precio + RID.iva + RID.ieps) AS Total,
											SUM(RID.precio) AS Subtotal,
											SUM(RID.iva) AS IVA,
											SUM(RID.ieps) AS IEPS
									FROM recibos_ingreso_detalles RID
									INNER JOIN recibos_ingreso RI ON RI.recibo_ingreso_id = RID.recibo_ingreso_id
									WHERE RID.referencia = 'MAQUINARIA'
							        AND DATE_FORMAT(RI.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
									AND RI.estatus = 'ACTIVO'
									GROUP BY RID.referencia_id
							) AS RecibosIngreso ON FM.factura_maquinaria_id = RecibosIngreso.referenciaID
							LEFT JOIN(
									SELECT 	NCD.referencia_id AS referenciaID,
											MAX(NC.tipo_cambio) AS TipoCambio,
											SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
											SUM(NCD.precio) AS Subtotal,
											SUM(NCD.iva) AS IVA,
											SUM(NCD.ieps) AS IEPS
									FROM notas_credito_digitales_detalles NCD
									INNER JOIN notas_credito_digitales NC ON NC.nota_credito_digital_id = NCD.nota_credito_digital_id
									WHERE NCD.referencia = 'MAQUINARIA'
							        AND DATE_FORMAT(NC.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
									AND (NC.estatus = 'ACTIVO' OR NC.estatus = 'TIMBRAR')
									GROUP BY NCD.referencia_id
							) AS NotasCreditoDigitales ON FM.factura_maquinaria_id = NotasCreditoDigitales.referenciaID 
							LEFT JOIN(
									SELECT 	PAD.referencia_id AS referenciaID,
											MAX(PA.tipo_cambio) AS TipoCambio,
											SUM(PAD.precio + PAD.iva + PAD.ieps) AS Total,
											SUM(PAD.precio) AS Subtotal,
											SUM(PAD.iva) AS IVA,
											SUM(PAD.ieps) AS IEPS
									FROM polizas_abono_detalles_02 PAD
									INNER JOIN polizas_abono_02 PA ON PA.poliza_abono_id = PAD.poliza_abono_id
									WHERE PAD.referencia = 'MAQUINARIA'
									AND DATE_FORMAT(PA.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
									AND PA.estatus = 'ACTIVO'
									GROUP BY PAD.referencia_id
							) AS PolizasAbono ON FM.factura_maquinaria_id = PolizasAbono.referenciaID
							LEFT JOIN(
									SELECT 	PDR.referencia_id AS referenciaID,
											MAX(PDR.tipo_cambio) AS TipoCambio,
											SUM(PDR.imp_pagado) AS Total,
											SUM(PDR.imp_pagado) AS Subtotal
									FROM pagos_detalles_relacionados_02 PDR
									INNER JOIN pagos P ON P.pago_id = PDR.pago_id
									WHERE PDR.tipo_referencia = 'MAQUINARIA'
							        AND DATE_FORMAT(P.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
							        AND (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
									GROUP BY PDR.referencia_id
							) AS Pagos ON FM.factura_maquinaria_id = Pagos.referenciaID
							WHERE DATE_FORMAT(FM.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
							AND (FM.metodo_pago_id = $intMetodoPagoIDPPD OR FM.metodo_pago_id = $intMetodoPagoIDPUE)
							$strRestricciones 
							AND (FM.estatus = 'ACTIVO' OR FM.estatus = 'TIMBRAR')
							$strSucursalesMaq
							GROUP BY FM.factura_maquinaria_id ";

		$queryRefacciones = " SELECT FR.factura_refacciones_id AS referencia_id, 
									'REFACCIONES' AS tipo_referencia, 
									FR.uuid, 
									FR.folio, 
									FR.moneda_id, 
									M.codigo AS moneda_tipo,
									FR.tipo_cambio, 
									FR.metodo_pago_id, 
									MP.codigo AS metodo_pago, 
									FR.fecha, 
									FR.vencimiento  AS fecha_vencimiento,
									DATE_FORMAT(FR.fecha, '%d/%m/%Y') AS fecha_format,
									DATE_FORMAT(FR.vencimiento, '%d/%m/%Y') AS fecha_vencimiento_format,
									C.prospecto_id, 
									C.nombre_comercial, 
									C.refacciones_credito_dias AS dias_credito,
									C.refacciones_credito_limite AS limite_credito, 
									'REFACCIONES' AS referencia,
									CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
									(
										ROUND( IFNULL(RefaccionesDetalles.Total/FR.tipo_cambio, 0) ,2) +
										ROUND( IFNULL(FR.gastos_paqueteria/FR.tipo_cambio, 0) ,2) + 
										ROUND( IFNULL(FR.gastos_paqueteria_iva/FR.tipo_cambio, 0) ,2)
							        ) AS importe,
							        (
										ROUND( IFNULL(RefaccionesDetalles.Total/FR.tipo_cambio, 0) ,2) +
										ROUND( IFNULL(FR.gastos_paqueteria/FR.tipo_cambio, 0) ,2) + 
										ROUND( IFNULL(FR.gastos_paqueteria_iva/FR.tipo_cambio, 0) ,2) + 
										ROUND( IFNULL(NotasCargo.Total/NotasCargo.TipoCambio, 0) ,2) +
										ROUND( IFNULL(NotasCargoDigitales.Total/NotasCargoDigitales.TipoCambio, 0) ,2) -
							            ROUND( IFNULL(RecibosIngreso.Total/RecibosIngreso.TipoCambio, 0) ,2) - 
										ROUND( IFNULL(NotasCreditoDigitales.Total/NotasCreditoDigitales.TipoCambio, 0) ,2) - 
										ROUND( IFNULL(PolizasAbono.Total/PolizasAbono.TipoCambio, 0) ,2) -
										ROUND( IFNULL(Pagos.Total/Pagos.TipoCambio, 0) ,2) -
										ROUND( IFNULL(Devoluciones.Total/Devoluciones.TipoCambio, 0) ,2) 
							        ) AS saldo,
							        (
										ROUND( IFNULL(RecibosIngreso.Total/RecibosIngreso.TipoCambio, 0) ,2) + 
										ROUND( IFNULL(NotasCreditoDigitales.Total/NotasCreditoDigitales.TipoCambio, 0) ,2) + 
										ROUND( IFNULL(PolizasAbono.Total/PolizasAbono.TipoCambio, 0) ,2) +
										ROUND( IFNULL(Pagos.Total/Pagos.TipoCambio, 0) ,2) +
										ROUND( IFNULL(Devoluciones.Total/Devoluciones.TipoCambio, 0) ,2)
							        ) AS parcialidades
							FROM facturas_refacciones FR
							INNER JOIN clientes C ON C.prospecto_id = FR.prospecto_id
							INNER JOIN sat_monedas AS M ON FR.moneda_id = M.moneda_id
							INNER JOIN sat_metodos_pago AS MP ON  FR.metodo_pago_id = MP.metodo_pago_id
							INNER JOIN (
							SELECT 	FRD.factura_refacciones_id AS referenciaID,
									SUM( FRD.cantidad * (FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) ) AS Total,
									SUM( FRD.cantidad * FRD.precio_unitario ) AS Subtotal,
									SUM( FRD.cantidad * FRD.iva_unitario ) AS IVA,
									SUM( FRD.cantidad * FRD.ieps_unitario ) AS IEPS
								FROM facturas_refacciones_detalles FRD
								GROUP BY FRD.factura_refacciones_id
							) AS RefaccionesDetalles ON RefaccionesDetalles.referenciaID = FR.factura_refacciones_id
							LEFT JOIN(
							    SELECT 	NCD.referencia_id AS referenciaID,
							    		MAX(NC.tipo_cambio) AS TipoCambio,
										SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
										SUM(NCD.precio) AS Subtotal,
										SUM(NCD.iva) AS IVA,
										SUM(NCD.ieps) AS IEPS
								FROM notas_cargo_detalles NCD 
								INNER JOIN notas_cargo NC ON NC.nota_cargo_id = NCD.nota_cargo_id
								WHERE NCD.referencia = 'REFACCIONES'
								AND DATE_FORMAT(NC.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
								AND NC.estatus = 'ACTIVO'
								GROUP BY NCD.referencia_id
							) AS NotasCargo ON FR.factura_refacciones_id = NotasCargo.referenciaID
							LEFT JOIN(
							    SELECT 	NCD.referencia_id AS referenciaID,
							    		MAX(NC.tipo_cambio) AS TipoCambio,
										SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
										SUM(NCD.precio) AS Subtotal,
										SUM(NCD.iva) AS IVA,
										SUM(NCD.ieps) AS IEPS
								FROM notas_cargo_digitales_detalles NCD 
								INNER JOIN notas_cargo_digitales NC ON NC.nota_cargo_digital_id = NCD.nota_cargo_digital_id
								WHERE NCD.referencia = 'REFACCIONES'
								AND DATE_FORMAT(NC.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
								AND (NC.estatus = 'ACTIVO' OR NC.estatus = 'TIMBRAR')
								GROUP BY NCD.referencia_id
							) AS NotasCargoDigitales ON FR.factura_refacciones_id = NotasCargoDigitales.referenciaID
							LEFT JOIN(	
							    SELECT 	RID.referencia_id AS referenciaID,
							    		MAX(RI.tipo_cambio) AS TipoCambio,
										SUM(RID.precio + RID.iva + RID.ieps) AS Total,
										SUM(RID.precio) AS Subtotal,
										SUM(RID.iva) AS IVA,
										SUM(RID.ieps) AS IEPS
								FROM recibos_ingreso_detalles RID
								INNER JOIN recibos_ingreso RI ON RI.recibo_ingreso_id = RID.recibo_ingreso_id
								WHERE RID.referencia = 'REFACCIONES'
								AND DATE_FORMAT(RI.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
								AND RI.estatus = 'ACTIVO'
								GROUP BY RID.referencia_id
							) AS RecibosIngreso ON FR.factura_refacciones_id = RecibosIngreso.referenciaID
							LEFT JOIN(
							    SELECT 	NCD.referencia_id AS referenciaID,
							    		MAX(NC.tipo_cambio) AS TipoCambio,
										SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
										SUM(NCD.precio) AS Subtotal,
										SUM(NCD.iva) AS IVA,
										SUM(NCD.ieps) AS IEPS
								FROM notas_credito_digitales_detalles NCD
								INNER JOIN notas_credito_digitales NC ON NC.nota_credito_digital_id = NCD.nota_credito_digital_id
								WHERE NCD.referencia = 'REFACCIONES'
								AND DATE_FORMAT(NC.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
								AND (NC.estatus = 'ACTIVO' OR NC.estatus = 'TIMBRAR')
								GROUP BY NCD.referencia_id
							) AS NotasCreditoDigitales ON FR.factura_refacciones_id = NotasCreditoDigitales.referenciaID 
							LEFT JOIN(
							    SELECT 	PAD.referencia_id AS referenciaID,
							    		MAX(PA.tipo_cambio) AS TipoCambio,
										SUM(PAD.precio + PAD.iva + PAD.ieps) AS Total,
										SUM(PAD.precio) AS Subtotal,
										SUM(PAD.iva) AS IVA,
										SUM(PAD.ieps) AS IEPS
								FROM polizas_abono_detalles_02 PAD
								INNER JOIN polizas_abono_02 PA ON PA.poliza_abono_id = PAD.poliza_abono_id
								WHERE PAD.referencia = 'REFACCIONES'
								AND DATE_FORMAT(PA.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
								AND PA.estatus = 'ACTIVO'
								GROUP BY PAD.referencia_id
							) AS PolizasAbono ON FR.factura_refacciones_id = PolizasAbono.referenciaID
							LEFT JOIN(
								SELECT 	PDR.referencia_id AS referenciaID,
										MAX(PDR.tipo_cambio) AS TipoCambio,
										SUM(PDR.imp_pagado) AS Total,
										SUM(PDR.imp_pagado) AS Subtotal
								FROM pagos AS P
								INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
								INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PDR.pago_id = P.pago_id AND PDR.renglon_detalles = PD.renglon
								WHERE PDR.tipo_referencia = 'REFACCIONES'
								AND DATE_FORMAT(P.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
								AND (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
								GROUP BY PDR.referencia_id
							) AS Pagos ON FR.factura_refacciones_id = Pagos.referenciaID
							LEFT JOIN(
									SELECT 
										MR.referencia_id AS referenciaID,
										MR.tipo_cambio AS TipoCambio,
										SUM(MRD.cantidad * (FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario)) AS Total,
						                SUM(MRD.cantidad * FRD.precio_unitario) AS Subtotal,
						                SUM(MRD.cantidad * FRD.iva_unitario) AS IVA,
						                SUM(MRD.cantidad * FRD.ieps_unitario) AS IEPS
									FROM movimientos_refacciones_detalles MRD
									INNER JOIN movimientos_refacciones MR ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
									INNER JOIN facturas_refacciones_detalles FRD ON FRD.refaccion_id = MRD.refaccion_id 
									           AND FRD.renglon = MRD.renglon AND MR.referencia_id = FRD.factura_refacciones_id
									WHERE MR.tipo_referencia = 'REFACCIONES'
									AND MR.estatus = 'ACTIVO'
									AND MR.tipo_movimiento = $intMovDevRef
									GROUP BY MR.referencia_id
							) AS Devoluciones ON FR.factura_refacciones_id = Devoluciones.referenciaID
						WHERE DATE_FORMAT(FR.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
						AND (FR.metodo_pago_id = $intMetodoPagoIDPPD OR FR.metodo_pago_id = $intMetodoPagoIDPUE)
						$strRestricciones 
						AND (FR.estatus = 'ACTIVO' OR FR.estatus = 'TIMBRAR')
						$strSucursalesRef
						GROUP BY FR.factura_refacciones_id";

		$queryServicio = " SELECT 
								FS.factura_servicio_id AS referencia_id, 
								'SERVICIO' AS tipo_referencia,
								FS.uuid, 
								FS.folio, 
								FS.moneda_id, 
								M.codigo AS moneda_tipo, 
								FS.tipo_cambio, 
								FS.metodo_pago_id, 
								MP.codigo AS metodo_pago,
								FS.fecha, 
								FS.vencimiento  AS fecha_vencimiento,
								DATE_FORMAT(FS.fecha, '%d/%m/%Y') AS fecha_format,
								DATE_FORMAT(FS.vencimiento, '%d/%m/%Y') AS fecha_vencimiento_format,
								C.prospecto_id, 
								C.nombre_comercial, 
								C.servicio_credito_dias AS dias_credito,
								C.servicio_credito_limite AS limite_credito,  
								'SERVICIO' AS referencia,
								CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
								( 
									ROUND( IFNULL(FS.gastos_servicio/FS.tipo_cambio, 0) ,2) + 
									ROUND( IFNULL(FS.gastos_servicio_iva/FS.tipo_cambio, 0) ,2) + 
									ROUND( IFNULL(ManoObra.Total/FS.tipo_cambio, 0) ,2) + 
									ROUND( IFNULL(Refacciones.Total/FS.tipo_cambio, 0) ,2) + 
									ROUND( IFNULL(Foraneos.Total/FS.tipo_cambio, 0) ,2) + 
									ROUND( IFNULL(Otros.Total/FS.tipo_cambio, 0) ,2)
								) AS importe,
								(
									ROUND( IFNULL(FS.gastos_servicio/FS.tipo_cambio, 0) ,2) + 
									ROUND( IFNULL(FS.gastos_servicio_iva/FS.tipo_cambio, 0) ,2) + 
									ROUND( IFNULL(ManoObra.Total/FS.tipo_cambio, 0) ,2) + 
									ROUND( IFNULL(Refacciones.Total/FS.tipo_cambio, 0) ,2) + 
									ROUND( IFNULL(Foraneos.Total/FS.tipo_cambio, 0) ,2) + 
									ROUND( IFNULL(Otros.Total/FS.tipo_cambio, 0) ,2) +
									ROUND( IFNULL(NotasCargo.Total/NotasCargo.TipoCambio, 0) ,2) +
									ROUND( IFNULL(NotasCargoDigitales.Total/NotasCargoDigitales.TipoCambio, 0) ,2) -
							        ROUND( IFNULL(RecibosIngreso.Total/RecibosIngreso.TipoCambio, 0) ,2) - 
									ROUND( IFNULL(NotasCreditoDigitales.Total/NotasCreditoDigitales.TipoCambio, 0) ,2) - 
									ROUND( IFNULL(PolizasAbono.Total/PolizasAbono.TipoCambio, 0) ,2) -
									ROUND( IFNULL(Pagos.Total/Pagos.TipoCambio, 0) ,2) -
									ROUND( IFNULL(Devoluciones.Total/Devoluciones.TipoCambio, 0) ,2)
								) AS saldo,
								(
									ROUND( IFNULL(RecibosIngreso.Total/RecibosIngreso.TipoCambio, 0) ,2) + 
									ROUND( IFNULL(NotasCreditoDigitales.Total/NotasCreditoDigitales.TipoCambio, 0) ,2) + 
									ROUND( IFNULL(PolizasAbono.Total/PolizasAbono.TipoCambio, 0) ,2) +
									ROUND( IFNULL(Pagos.Total/Pagos.TipoCambio, 0) ,2) +
									ROUND( IFNULL(Devoluciones.Total/Devoluciones.TipoCambio, 0) ,2)
								) AS parcialidades
							FROM facturas_servicio FS
							INNER JOIN clientes C ON C.prospecto_id = FS.prospecto_id
							INNER JOIN sat_monedas AS M ON FS.moneda_id = M.moneda_id
							INNER JOIN sat_metodos_pago AS MP ON  FS.metodo_pago_id = MP.metodo_pago_id
							LEFT JOIN(
								SELECT 	FSMO.factura_servicio_id AS referenciaID,
										SUM(FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) AS Total,
										SUM(FSMO.precio_unitario) AS Subtotal,
										SUM(FSMO.iva_unitario) AS IVA,
										SUM(FSMO.ieps_unitario) AS IEPS
								FROM facturas_servicio_mano_obra FSMO
							GROUP BY FSMO.factura_servicio_id
							) AS ManoObra ON ManoObra.referenciaID = FS.factura_servicio_id 
							LEFT JOIN(
							SELECT 	FSR.factura_servicio_id AS referenciaID,
									SUM( FSR.cantidad * (FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) ) AS Total,
									SUM( FSR.cantidad * FSR.precio_unitario) AS Subtotal,
									SUM( FSR.cantidad * FSR.iva_unitario ) AS IVA,
									SUM( FSR.cantidad * FSR.ieps_unitario ) AS IEPS
							FROM facturas_servicio_refacciones FSR
							GROUP BY FSR.factura_servicio_id
							) AS Refacciones ON Refacciones.referenciaID = FS.factura_servicio_id
							LEFT JOIN(
							SELECT 	FSTF.factura_servicio_id AS referenciaID,
									SUM( FSTF.cantidad * (FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) ) AS Total,
									SUM( FSTF.cantidad * FSTF.precio_unitario) AS Subtotal,
									SUM( FSTF.cantidad * FSTF.iva_unitario ) AS IVA,
									SUM( FSTF.cantidad * FSTF.ieps_unitario ) AS IEPS
							FROM facturas_servicio_trabajos_foraneos FSTF
							GROUP BY FSTF.factura_servicio_id
							) AS Foraneos ON Foraneos.referenciaID = FS.factura_servicio_id
							LEFT JOIN(
							SELECT 	FSO.factura_servicio_id AS referenciaID,
									SUM( FSO.cantidad * (FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) ) AS Total,
									SUM( FSO.cantidad * FSO.precio_unitario ) AS Subtotal,
									SUM( FSO.cantidad * FSO.iva_unitario ) AS IVA,
									SUM( FSO.cantidad * FSO.ieps_unitario ) AS IEPS
							FROM facturas_servicio_otros FSO
							GROUP BY FSO.factura_servicio_id
							) AS Otros ON Otros.referenciaID = FS.factura_servicio_id
							LEFT JOIN(
								SELECT 	NCD.referencia_id AS referenciaID,
										MAX(NC.tipo_cambio) AS TipoCambio,
										SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
										SUM(NCD.precio) AS Subtotal,
										SUM(NCD.iva) AS IVA,
										SUM(NCD.ieps) AS IEPS
								FROM notas_cargo_detalles NCD 
								INNER JOIN notas_cargo NC ON NC.nota_cargo_id = NCD.nota_cargo_id
								WHERE NCD.referencia = 'SERVICIO'
								AND DATE_FORMAT(NC.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
								AND NC.estatus = 'ACTIVO'
								GROUP BY NCD.referencia_id
							) AS NotasCargo ON FS.factura_servicio_id = NotasCargo.referenciaID
							LEFT JOIN(
								SELECT 	NCD.referencia_id AS referenciaID,
										MAX(NC.tipo_cambio) AS TipoCambio,
										SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
										SUM(NCD.precio) AS Subtotal,
										SUM(NCD.iva) AS IVA,
										SUM(NCD.ieps) AS IEPS
								FROM notas_cargo_digitales_detalles NCD 
								INNER JOIN notas_cargo_digitales NC ON NC.nota_cargo_digital_id = NCD.nota_cargo_digital_id
								WHERE NCD.referencia = 'SERVICIO'
								AND DATE_FORMAT(NC.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
								AND (NC.estatus = 'ACTIVO' OR NC.estatus = 'TIMBRAR')
								GROUP BY NCD.referencia_id
							) AS NotasCargoDigitales ON FS.factura_servicio_id = NotasCargoDigitales.referenciaID
							LEFT JOIN(
								SELECT 	RID.referencia_id AS referenciaID,
										MAX(RI.tipo_cambio) AS TipoCambio,
										SUM(RID.precio + RID.iva + RID.ieps) AS Total,
										SUM(RID.precio) AS Subtotal,
										SUM(RID.iva) AS IVA,
										SUM(RID.ieps) AS IEPS
								FROM recibos_ingreso_detalles RID
								INNER JOIN recibos_ingreso RI ON RI.recibo_ingreso_id = RID.recibo_ingreso_id
								WHERE RID.referencia = 'SERVICIO'
								AND DATE_FORMAT(RI.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
								AND RI.estatus = 'ACTIVO'
								GROUP BY RID.referencia_id
							) AS RecibosIngreso ON FS.factura_servicio_id = RecibosIngreso.referenciaID
							LEFT JOIN(
								SELECT 	NCD.referencia_id AS referenciaID,
										MAX(NC.tipo_cambio) AS TipoCambio,
										SUM(NCD.precio + NCD.iva + NCD.ieps) AS Total,
										SUM(NCD.precio) AS Subtotal,
										SUM(NCD.iva) AS IVA,
										SUM(NCD.ieps) AS IEPS
								FROM notas_credito_digitales_detalles NCD
								INNER JOIN notas_credito_digitales NC ON NC.nota_credito_digital_id = NCD.nota_credito_digital_id
								WHERE NCD.referencia = 'SERVICIO'
								AND DATE_FORMAT(NC.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
								AND (NC.estatus = 'ACTIVO' OR NC.estatus = 'TIMBRAR')
								GROUP BY NCD.referencia_id
							) AS NotasCreditoDigitales ON FS.factura_servicio_id = NotasCreditoDigitales.referenciaID 
							LEFT JOIN(
								SELECT 	PAD.referencia_id AS referenciaID,
										MAX(PA.tipo_cambio) AS TipoCambio,
										SUM(PAD.precio + PAD.iva + PAD.ieps) AS Total,
										SUM(PAD.precio) AS Subtotal,
										SUM(PAD.iva) AS IVA,
										SUM(PAD.ieps) AS IEPS
								FROM polizas_abono_detalles_02 PAD
								INNER JOIN polizas_abono_02 PA ON PA.poliza_abono_id = PAD.poliza_abono_id
								WHERE PAD.referencia = 'SERVICIO'
								AND DATE_FORMAT(PA.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
								AND PA.estatus = 'ACTIVO'
								GROUP BY PAD.referencia_id
							) AS PolizasAbono ON FS.factura_servicio_id = PolizasAbono.referenciaID
							LEFT JOIN(
								SELECT 	PDR.referencia_id AS referenciaID,
										MAX(PDR.tipo_cambio) AS TipoCambio,
										SUM(PDR.imp_pagado) AS Total,
										SUM(PDR.imp_pagado) AS Subtotal
								FROM pagos AS P
								INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
								INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PDR.pago_id = P.pago_id AND PDR.renglon_detalles = PD.renglon
								WHERE PDR.tipo_referencia = 'SERVICIO'
								AND DATE_FORMAT(P.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
								AND (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
								GROUP BY PDR.referencia_id
							) AS Pagos ON FS.factura_servicio_id = Pagos.referenciaID
							LEFT JOIN(
									SELECT 
										FSR.factura_servicio_id AS referenciaID,
										MAX(MR.tipo_cambio) AS TipoCambio,
										SUM( MRD.cantidad * (FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) ) AS Total,
						                SUM(MRD.cantidad * FSR.precio_unitario) AS Subtotal,
						                SUM(MRD.cantidad * FSR.iva_unitario) AS IVA,
						                SUM(MRD.cantidad * FSR.ieps_unitario) AS IEPS
									FROM movimientos_refacciones_detalles MRD
									INNER JOIN movimientos_refacciones MR ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
									INNER JOIN facturas_servicio_refacciones FSR ON FSR.refaccion_id = MRD.refaccion_id AND FSR.renglon = MRD.renglon
									WHERE MR.tipo_referencia = 'SERVICIO'
									AND MR.estatus = 'ACTIVO'
									AND MR.tipo_movimiento = $intMovDevRef
									GROUP BY FSR.factura_servicio_id
							) AS Devoluciones ON FS.factura_servicio_id = Devoluciones.referenciaID
							WHERE DATE_FORMAT(FS.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
							AND (FS.metodo_pago_id = $intMetodoPagoIDPPD OR FS.metodo_pago_id = $intMetodoPagoIDPUE)
							$strRestricciones
							AND (FS.estatus = 'ACTIVO' OR FS.estatus = 'TIMBRAR')
							$strSucursalesSer
							GROUP BY FS.factura_servicio_id ";

		//Bloque de código para configurar los módulos que se mostrarán de la tabla cartera con base a lo seleccionado
		$modulos = explode('|', $arrModulos);
		//Variable para generar las condiciones dinamicas de las consultas respecto a la columna cartera.modulo
		$cond_cartera = '';

		for ($i = 0; $i<sizeof($modulos); $i++) {
		    if($i == 0){
		    	$cond_cartera .= "AND ( ";
		    	$cond_cartera .= "CT.modulo = "."'".$modulos[$i]."'";
		    }
		    else{
		    	$cond_cartera .= " OR CT.modulo = "."'".$modulos[$i]."'";
		    }
		}
		$cond_cartera .= ")";					

		$queryCartera = "SELECT 	CT.cartera_id AS referencia_id, 
									CONCAT_WS(' - ', 'CARTERA', CT.modulo) AS tipo_referencia, 
								   	CT.uuid, 
								   	CT.folio, 
								   	CT.moneda_id, 
								   	M.codigo AS moneda_tipo,  
							       	CT.tipo_cambio, 
							       	CT.metodo_pago_id, 
							       	MP.codigo AS metodo_pago,
							       	CT.fecha, 
							       	CT.vencimiento  AS fecha_vencimiento,
								   	DATE_FORMAT(CT.fecha, '%d/%m/%Y') AS fecha_format,
								   	DATE_FORMAT(CT.vencimiento, '%d/%m/%Y') AS fecha_vencimiento_format,
								   	CT.prospecto_id, 
								   	C.nombre_comercial, 
								   	0 AS dias_credito,
							       	0 AS limite_credito,  
							       	CT.modulo AS referencia,
							      	CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion_moneda,
							      CT.importe, 
							      (CT.saldo - 
							       IFNULL((SELECT SUM(PDR.imp_pagado/PDR.tipo_cambio) AS total
										  FROM pagos AS P
										  INNER JOIN pagos_detalles_relacionados_02 AS PDR ON P.pago_id = PDR.pago_id
										  WHERE PDR.referencia_id = CT.cartera_id
										  AND PDR.tipo_referencia = 'CARTERA'
										  AND DATE_FORMAT(P.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
										  AND (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')), 0)) AS saldo, 
							      (CT.parcialidades +
								   IFNULL((SELECT COUNT(PDR.renglon)
										   FROM pagos AS P
										   INNER JOIN pagos_detalles_relacionados_02 AS PDR ON P.pago_id = PDR.pago_id
										   WHERE PDR.referencia_id = CT.cartera_id
										   AND PDR.tipo_referencia = 'CARTERA'
										   AND DATE_FORMAT(P.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
										   AND (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')), 0)) AS parcialidades
							FROM cartera AS CT
							INNER JOIN clientes C ON C.prospecto_id = CT.prospecto_id
							INNER JOIN sat_monedas AS M ON  CT.moneda_id = M.moneda_id
							INNER JOIN sat_metodos_pago AS MP ON  CT.metodo_pago_id = MP.metodo_pago_id
							WHERE DATE_FORMAT(CT.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
							AND (CT.metodo_pago_id = $intMetodoPagoIDPPD OR CT.metodo_pago_id = $intMetodoPagoIDPUE)
							$cond_cartera
							$strRestricciones
							$strSucursalesCar 
							$strOrdenamiento ";
		
		$queryGeneral = '';
		foreach ($modulos as &$modulo) {
		    
		    switch ($modulo) {
			    case 'MAQUINARIA':
			        $queryGeneral .= $queryMaquinaria;
			        break;
			    case 'REFACCIONES':
			        $queryGeneral .= $queryRefacciones;
			        break;
			    case 'SERVICIO':
			        $queryGeneral .= $queryServicio;
			        break;
			}

			$queryGeneral .= ' UNION ';

		}

		$queryGeneral .= $queryCartera;

		$strSQL = $this->db->query($queryGeneral);

		return $strSQL->result();

	}


	/*Método para regresar el saldo inicial que coincida con los criterios de búsqueda proporcionados
     *(se utiliza en el reporte de estado de cuenta)*/
	public function buscar_saldo_inicial_estado_cuenta($dteFecha, $intClienteID, $intMonedaID, $arrSucursales, $arrModulos)
	{
		//Constante para identificar al tipo de movimiento entrada de maquinaria por devolución de la factura
		$intMovDevMaq = ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA;
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución de la factura
		$intMovDevRef = ENTRADA_REFACCIONES_DEVOLUCION_FACTURA;

		//Variables para generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
		$sucursales = explode('|', $arrSucursales);
		$strSucursalesMaq = '';
		$strSucursalesMovMaq = '';
		$strSucursalesRef = '';
		$strSucursalesMovRef = '';
		$strSucursalesSer = '';

		$strSucursalesNC = '';
		$strSucursalesNCD = '';
		$strSucursalesRI = '';
		$strSucursalesPA = '';

		$strSucursalesPagos = '';
		$strSucursalesCartera = '';
		
		for ($i = 0; $i<sizeof($sucursales); $i++) {
		    if($i == 0){
		    	$strSucursalesMaq .= 'AND ( ';
		    	$strSucursalesMaq .= 'FM.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesMovMaq .= 'AND ( ';
		    	$strSucursalesMovMaq .= 'MM.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesRef .= 'AND ( ';
		    	$strSucursalesRef .= 'FR.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesMovRef .= 'AND ( ';
		    	$strSucursalesMovRef .= 'MR.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesSer .= 'AND ( ';
		    	$strSucursalesSer .= 'FS.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesNC .= 'AND ( ';
		    	$strSucursalesNC .= 'NC.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesNCD .= 'AND ( ';
		    	$strSucursalesNCD .= 'NCR.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesRI .= 'AND ( ';
		    	$strSucursalesRI .= 'RI.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesPA .= 'AND ( ';
		    	$strSucursalesPA .= 'PA.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesPagos .= 'AND ( ';
		    	$strSucursalesPagos .= 'P.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesCartera .= 'AND ( ';
		    	$strSucursalesCartera .= 'CT.sucursal_id = '.$sucursales[$i];

		    }
		    else{

		    	$strSucursalesMaq .= ' OR FM.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesMovMaq .= ' OR MM.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesRef .= ' OR FR.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesMovRef .= ' OR MR.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesSer .= ' OR FS.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesNC .= ' OR NC.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesNCD .= ' OR NCR.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesRI .= ' OR RI.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesPA .= ' OR PA.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesPagos .= ' OR P.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesCartera .= ' OR CT.sucursal_id = '.$sucursales[$i];

		    }
		}

		$strSucursalesMaq .= ')';
		$strSucursalesMovMaq .= ')';
		$strSucursalesRef .= ')';
		$strSucursalesMovRef .= ')';
		$strSucursalesSer .= ')';
		$strSucursalesNC .= ')';
		$strSucursalesNCD .= ')';
		$strSucursalesRI .= ')';
		$strSucursalesPA .= ')';
		$strSucursalesPagos .= ')';
		$strSucursalesCartera .= ')';


		//Bloque de código para configurar los módulos que se mostrarán en cargos y abonos con base a lo seleccionado
		$modulosCargosAbonos = explode('|', $arrModulos);
		
		$strNotasCargo = '';
		$strNotasCargoDigitales = '';
		$strNotasCreditoDigitales = '';
		$strRecibosIngreso = '';
		$strPolizasAbono = '';
		$strPagos = '';
							
		for ($i = 0; $i<sizeof($modulosCargosAbonos); $i++) {
		    if($i == 0){
		    	$strRecibosIngreso .= 'AND ( ';
		    	$strRecibosIngreso .= 'RID.referencia = '."'".$modulosCargosAbonos[$i]."'";

		    	$strPolizasAbono .= 'AND ( ';
		    	$strPolizasAbono .= 'PAD.referencia = '."'".$modulosCargosAbonos[$i]."'";

		    	$strNotasCargo .= 'AND ( ';
		    	$strNotasCargo .= 'NCD.referencia = '."'".$modulosCargosAbonos[$i]."'";

		    	$strNotasCargoDigitales .= 'AND ( ';
		    	$strNotasCargoDigitales .= 'NCD.referencia = '."'".$modulosCargosAbonos[$i]."'";

		    	$strNotasCreditoDigitales .= 'AND ( ';
		    	$strNotasCreditoDigitales .= 'NCRD.referencia = '."'".$modulosCargosAbonos[$i]."'";

		    	$strPagos .= 'AND ( ';
		    	$strPagos .= 'PDR.tipo_referencia = '."'".$modulosCargosAbonos[$i]."'";

		    }
		    else{
		    	$strRecibosIngreso .= ' OR RID.referencia = '."'".$modulosCargosAbonos[$i]."'";
		    	$strPolizasAbono .= ' OR PAD.referencia = '."'".$modulosCargosAbonos[$i]."'";
		    	$strNotasCargo .= ' OR NCD.referencia = '."'".$modulosCargosAbonos[$i]."'";
		    	$strNotasCargoDigitales .= ' OR NCD.referencia = '."'".$modulosCargosAbonos[$i]."'";
		    	$strNotasCreditoDigitales .= ' OR NCRD.referencia = '."'".$modulosCargosAbonos[$i]."'";
		    	$strPagos .= ' OR PDR.tipo_referencia = '."'".$modulosCargosAbonos[$i]."'";
		    }
		}

		$strRecibosIngreso .= ')';
		$strPolizasAbono .= ')';
		$strNotasCargo .= ')';
		$strNotasCargoDigitales .= ')';
		$strNotasCreditoDigitales .= ')';
		$strPagos .= ')';


		$queryMaquinaria = "
			SELECT FM.factura_maquinaria_id AS ID, 
			       DATE_FORMAT(FM.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       FM.fecha_creacion,
			       'cargo' AS tipo,
			       ROUND(((FM.precio + FM.iva + FM.ieps)/FM.tipo_cambio), 2) AS total
			FROM   facturas_maquinaria FM
			WHERE  FM.prospecto_id = $intClienteID
			$strSucursalesMaq
			AND    DATE_FORMAT(FM.fecha, '%Y-%m-%d') < '$dteFecha'
			AND    FM.moneda_id = $intMonedaID
			AND    FM.estatus <> 'INACTIVO'
			GROUP BY FM.factura_maquinaria_id
			UNION
			SELECT MM.movimiento_maquinaria_id AS ID,
			       DATE_FORMAT(MM.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       MM.fecha_creacion,
			       'abono' AS tipo,
			       ROUND(((FM.precio + FM.iva + FM.ieps)/FM.tipo_cambio), 2) AS total
			FROM   movimientos_maquinaria AS MM
			       INNER JOIN facturas_maquinaria AS FM ON MM.referencia_id = FM.factura_maquinaria_id
			WHERE  MM.prospecto_id = $intClienteID
			$strSucursalesMovMaq
			AND    MM.tipo_movimiento = $intMovDevMaq
			AND    DATE_FORMAT(MM.fecha, '%Y-%m-%d') < '$dteFecha'
			AND    FM.moneda_id = $intMonedaID
			AND    MM.estatus = 'ACTIVO'
			GROUP BY MM.movimiento_maquinaria_id
		";

		$queryRefacciones = "
			SELECT FR.factura_refacciones_id AS ID, 
			       DATE_FORMAT(FR.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       FR.fecha_creacion,
			       'cargo' AS tipo,
			       ROUND(IFNULL((FR.gastos_paqueteria + FR.gastos_paqueteria_iva)/FR.tipo_cambio, 0) +
			             (SUM(ROUND((FRD.precio_unitario * FRD.cantidad), 2) + 
						   	  ROUND((FRD.iva_unitario * FRD.cantidad), 2) + 
						   	  ROUND((FRD.ieps_unitario * FRD.cantidad), 2))/FR.tipo_cambio), 2) AS total
			FROM   facturas_refacciones_detalles AS FRD
			       INNER JOIN facturas_refacciones AS FR ON FR.factura_refacciones_id = FRD.factura_refacciones_id
			WHERE  FR.prospecto_id = $intClienteID
			$strSucursalesRef
			AND    DATE_FORMAT(FR.fecha, '%Y-%m-%d') < '$dteFecha'
			AND    FR.moneda_id = $intMonedaID
			AND    FR.estatus <> 'INACTIVO'
			GROUP BY FR.factura_refacciones_id
			UNION
			SELECT MR.movimiento_refacciones_id AS ID, 
			       DATE_FORMAT(MAX(MR.fecha), '%Y-%m-%d') AS fecha_ordenamiento,
			       MAX(MR.fecha_creacion) AS fecha_creacion,
			       'abono' AS tipo,
			       ROUND((SUM(ROUND((FRD.precio_unitario * MRD.cantidad), 2) + 
						   	  ROUND((FRD.iva_unitario * MRD.cantidad), 2) + 
						   	  ROUND((FRD.ieps_unitario * MRD.cantidad), 2))/MR.tipo_cambio), 2) AS total
			FROM   movimientos_refacciones_detalles MRD
			       INNER JOIN movimientos_refacciones MR ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
			       INNER JOIN facturas_refacciones_detalles FRD ON FRD.refaccion_id = MRD.refaccion_id AND FRD.renglon = MRD.renglon
			       INNER JOIN facturas_refacciones FR ON FR.factura_refacciones_id = FRD.factura_refacciones_id 
			                  AND FR.factura_refacciones_id = MR.referencia_id
			WHERE  FR.prospecto_id = $intClienteID
			$strSucursalesMovRef
			AND    MR.tipo_movimiento = $intMovDevRef
			AND    DATE_FORMAT(MR.fecha, '%Y-%m-%d') < '$dteFecha'
			AND    FR.moneda_id = $intMonedaID
			AND    MR.estatus = 'ACTIVO'
			GROUP BY MR.movimiento_refacciones_id
		";

		$queryServicio = 	"
			SELECT FS.factura_servicio_id AS ID, 
			       DATE_FORMAT(FS.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       FS.fecha_creacion,
			       'cargo' AS tipo,
			       ROUND(IFNULL((FS.gastos_servicio + FS.gastos_servicio_iva)/FS.tipo_cambio, 0) +
			             IFNULL((ManoObra.Importe/FS.tipo_cambio), 0) +
			             IFNULL((Otros.Importe/FS.tipo_cambio), 0) +
			             IFNULL((Refacciones.Importe/FS.tipo_cambio), 0) +
			             IFNULL((Foraneos.Importe/FS.tipo_cambio), 0), 2) AS total
			FROM   facturas_servicio FS
			       LEFT JOIN (SELECT factura_servicio_id, 
			                         SUM(precio_unitario + iva_unitario + ieps_unitario) AS Importe
			                  FROM   facturas_servicio_mano_obra
			                  GROUP BY factura_servicio_id) AS ManoObra ON FS.factura_servicio_id = ManoObra.factura_servicio_id
			       LEFT JOIN (SELECT factura_servicio_id, 
			                         SUM((precio_unitario + iva_unitario + ieps_unitario) * cantidad) AS Importe
			                  FROM   facturas_servicio_otros
			                  GROUP BY factura_servicio_id) AS Otros ON FS.factura_servicio_id = Otros.factura_servicio_id
			       LEFT JOIN (SELECT factura_servicio_id, 
			                         SUM((precio_unitario + iva_unitario + ieps_unitario) * cantidad) AS Importe
			                  FROM   facturas_servicio_refacciones
			                  GROUP BY factura_servicio_id) AS Refacciones ON FS.factura_servicio_id = Refacciones.factura_servicio_id
			       LEFT JOIN (SELECT factura_servicio_id, 
			                         SUM((precio_unitario + iva_unitario + ieps_unitario) * cantidad) AS Importe
			                  FROM   facturas_servicio_trabajos_foraneos
			                  GROUP BY factura_servicio_id) AS Foraneos ON FS.factura_servicio_id = Foraneos.factura_servicio_id
			WHERE  FS.prospecto_id = $intClienteID
			$strSucursalesSer
			AND    DATE_FORMAT(FS.fecha, '%Y-%m-%d') < '$dteFecha'
			AND    FS.moneda_id = $intMonedaID
			AND    FS.estatus <> 'INACTIVO'
			GROUP BY FS.factura_servicio_id
			UNION
			SELECT MR.movimiento_refacciones_id AS ID, 
			       DATE_FORMAT(MAX(MR.fecha), '%Y-%m-%d') AS fecha_ordenamiento,
			       MAX(MR.fecha_creacion) AS fecha_creacion,
			       'abono' AS tipo,
			       ROUND(SUM(((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * MRD.cantidad)/MR.tipo_cambio), 2) AS total
			FROM   movimientos_refacciones_detalles MRD
			       INNER JOIN movimientos_refacciones MR ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
			       INNER JOIN facturas_servicio_refacciones FSR ON FSR.refaccion_id = MRD.refaccion_id AND FSR.renglon = MRD.renglon
			       INNER JOIN facturas_servicio FS ON FS.factura_servicio_id = FSR.factura_servicio_id 
			                  AND FS.factura_servicio_id = MR.referencia_id
			WHERE  FS.prospecto_id = $intClienteID
			$strSucursalesMovRef
			AND    MR.tipo_movimiento = $intMovDevRef
			AND    DATE_FORMAT(MR.fecha, '%Y-%m-%d') < '$dteFecha'
			AND    FS.moneda_id = $intMonedaID
			AND    MR.estatus = 'ACTIVO'
			GROUP BY MR.movimiento_refacciones_id
		";

		$queryCargosAbonos = "
			SELECT NC.nota_cargo_id AS ID,
			       DATE_FORMAT(NC.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       NC.fecha_creacion,
			       'cargo' AS tipo,
			       ROUND(((NCD.precio + NCD.iva + NCD.ieps)/NC.tipo_cambio) , 2) AS total
			FROM   notas_cargo_detalles NCD
			       INNER JOIN notas_cargo NC ON NCD.nota_cargo_id = NC.nota_cargo_id
			WHERE  NC.prospecto_id = $intClienteID
			$strNotasCargo
			$strSucursalesNC
			AND    DATE_FORMAT(NC.fecha, '%Y-%m-%d') < '$dteFecha'
			AND    NC.moneda_id = $intMonedaID
			AND    NC.estatus = 'ACTIVO'
			UNION
			SELECT NC.nota_cargo_digital_id AS ID,
			       DATE_FORMAT(NC.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       NC.fecha_creacion,
			       'cargo' AS tipo,
			       ROUND(((NCD.precio + NCD.iva + NCD.ieps)/NC.tipo_cambio), 2) AS total
			FROM   notas_cargo_digitales_detalles NCD
			       INNER JOIN notas_cargo_digitales NC ON NCD.nota_cargo_digital_id = NC.nota_cargo_digital_id
			WHERE  NC.prospecto_id = $intClienteID
			$strNotasCargoDigitales
			$strSucursalesNC
			AND    DATE_FORMAT(NC.fecha, '%Y-%m-%d') < '$dteFecha'
			AND    NC.moneda_id = $intMonedaID
			AND    NC.estatus <> 'INACTIVO'
			UNION
			SELECT NCR.nota_credito_digital_id AS ID, 
			       DATE_FORMAT(NCR.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       NCR.fecha_creacion,
			       'abono' AS tipo,
			       ROUND(((NCRD.precio + NCRD.iva + NCRD.ieps)/NCR.tipo_cambio), 2) AS total
			FROM   notas_credito_digitales_detalles NCRD
			       INNER JOIN notas_credito_digitales NCR ON NCR.nota_credito_digital_id = NCRD.nota_credito_digital_id
			WHERE  NCR.prospecto_id = $intClienteID
			$strNotasCreditoDigitales
			AND    DATE_FORMAT(NCR.fecha, '%Y-%m-%d') < '$dteFecha'
			AND    NCR.moneda_id = $intMonedaID
			AND    NCR.estatus <> 'INACTIVO' 
			UNION
			SELECT RI.recibo_ingreso_id AS ID, 
			       DATE_FORMAT(RI.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       RI.fecha_creacion, 
			       'abono' AS tipo,
			       ROUND(((RID.precio + RID.iva + RID.ieps)/RI.tipo_cambio), 2) AS total 
			FROM   recibos_ingreso_detalles RID 
			       INNER JOIN recibos_ingreso RI ON RID.recibo_ingreso_id = RI.recibo_ingreso_id 
			WHERE  RI.prospecto_id = $intClienteID
			$strRecibosIngreso
			$strSucursalesRI
			AND    DATE_FORMAT(RI.fecha, '%Y-%m-%d') < '$dteFecha'
			AND    RI.moneda_id = $intMonedaID 
			AND    RI.estatus = 'ACTIVO'  
			UNION
			SELECT PA.poliza_abono_id AS ID, 
			       DATE_FORMAT(PA.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       PA.fecha_creacion, 
			       'abono' AS tipo, 
			        ROUND(((PAD.precio + PAD.iva + PAD.ieps)/PA.tipo_cambio), 2) AS total 
			FROM    polizas_abono_detalles_02 PAD 
			        INNER JOIN polizas_abono_02 PA ON PAD.poliza_abono_id = PA.poliza_abono_id
			WHERE   PA.prospecto_id = $intClienteID
			$strPolizasAbono
			$strSucursalesPA
			AND     DATE_FORMAT(PA.fecha, '%Y-%m-%d') < '$dteFecha'
			AND     PA.moneda_id = $intMonedaID 
			AND     PA.estatus = 'ACTIVO'    
			UNION 
			SELECT P.pago_id AS ID, 
			       DATE_FORMAT(P.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       P.fecha_creacion, 
			       'abono' AS tipo,
			       ROUND(SUM(PDR.imp_pagado/PD.tipo_cambio), 2) AS total
			FROM   pagos AS P
			       INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
			       INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PDR.pago_id = P.pago_id AND PDR.renglon_detalles = PD.renglon
			       INNER JOIN sat_monedas AS M ON PD.moneda_id = M.moneda_id
			WHERE  P.prospecto_id = $intClienteID
			$strPagos
			$strSucursalesPagos
			AND    DATE_FORMAT(P.fecha, '%Y-%m-%d') < '$dteFecha'
			AND    M.moneda_id = $intMonedaID
			AND    P.estatus <> 'INACTIVO'
			GROUP BY P.pago_id, PD.renglon, PDR.renglon
		";

		//Bloque de código para identificar que registros de la tabla cartera serán considerados con base al módulo seleccionados
		$modulosCartera = explode('|', $arrModulos);						

		$strModulosCartera = '';
		
		for ($i = 0; $i<sizeof($modulosCartera); $i++) {
		    if($i == 0){
		    	$strModulosCartera .= 'AND ( ';
		    	$strModulosCartera .= 'CT.modulo = '."'".$modulosCartera[$i]."'";
		    }
		    else{
		    	$strModulosCartera .= ' OR CT.modulo = '."'".$modulosCartera[$i]."'";
		    }
		}

		$strModulosCartera .= ')';						

		$queryCartera = "
							UNION 	
								SELECT 	CT.cartera_id AS ID, 
										DATE_FORMAT(CT.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
										(CT.fecha) AS fecha_creacion,
										'cargo' AS tipo,
										ROUND( (CT.saldo/CT.tipo_cambio) , 2) AS total
								FROM cartera AS CT
								WHERE CT.prospecto_id = $intClienteID
								$strSucursalesCartera
								AND DATE_FORMAT(CT.fecha, '%Y-%m-%d') < '$dteFecha'
								$strModulosCartera
								AND CT.moneda_id = $intMonedaID
							UNION 	
							SELECT P.pago_id AS ID, 
							       DATE_FORMAT(P.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
							       P.fecha_creacion, 
							       'abono' AS tipo,
							       ROUND(SUM(PDR.imp_pagado/PD.tipo_cambio), 2) AS total
							FROM   pagos AS P
							       INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
							       INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PDR.pago_id = P.pago_id AND PDR.renglon_detalles = PD.renglon
							       INNER JOIN sat_monedas AS M ON PD.moneda_id = M.moneda_id
							       INNER JOIN cartera AS CT ON PDR.tipo_referencia = 'CARTERA' AND PDR.referencia_id = CT.cartera_id
							WHERE  P.prospecto_id = $intClienteID
							$strSucursalesPagos
							AND    DATE_FORMAT(P.fecha, '%Y-%m-%d') < '$dteFecha'
							AND    M.moneda_id = $intMonedaID
							AND    P.estatus <> 'INACTIVO'
							GROUP BY P.pago_id, PD.renglon, PDR.renglon
							ORDER BY fecha_ordenamiento, fecha_creacion ASC;
						";						
									

		/*
		//BLOQUE DE CÓDIGO QUE FORMA PARTE DE ANTICIPOS
		UNION SELECT
		 	AA.folio, 
		 	AA.fecha, 
	         DATE_FORMAT(AA.fecha,'%d/%m/%Y') AS fecha_format,
		 	'ANTICIPO APLICACIÓN DEL CLIENTE' AS descripcion, 
		 	'' AS folio_referencia, 
		 	'abono' AS tipo,
		 	SUM((AA.subtotal + AA.iva + AA.ieps) / AA.tipo_cambio) AS total
		 FROM anticipos_aplicacion AA
		 WHERE AA.prospecto_id = $intClienteID
		 AND (DATE_FORMAT(AA.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
		 AND AA.moneda_id = $intMonedaID
		 AND (AA.estatus = 'ACTIVO' OR AA.estatus = 'TIMBRAR')
	    GROUP BY AA.anticipo_aplicacion_id
		*/						

		
		//Bloque de código para configurar los módulos que se mostrarán con base a lo seleccionado
		$modulos = explode('|', $arrModulos);
							
		$queryGeneral = '';
		foreach ($modulos as &$modulo) {
		    
		    switch ($modulo) {
			    case 'MAQUINARIA':
			        $queryGeneral .= $queryMaquinaria;
			        break;
			    case 'REFACCIONES':
			        $queryGeneral .= $queryRefacciones;
			        break;
			    case 'SERVICIO':
			        $queryGeneral .= $queryServicio;
			        break;
			}

			$queryGeneral .= ' UNION ';

		}

		$queryGeneral .= $queryCargosAbonos;
		$queryGeneral .= $queryCartera;

		//var_dump($queryGeneral);

		$strSQL = $this->db->query($queryGeneral);

		return $strSQL->result();
		
	}

	/*Método para regresar el saldo inicial de anticipos que coincida con los criterios de búsqueda proporcionados
     *(se utiliza en el reporte de estado de cuenta)*/
	public function buscar_saldo_inicial_anticipos_estado_cuenta($dteFecha, $intClienteID, $intMonedaID)
	{

		$strSQL = $this->db->query("
									SELECT 
										 IFNULL((SELECT 
									                    SUM((subtotal + iva + ieps) / tipo_cambio) AS total_anticipo
									                FROM anticipos
									                WHERE prospecto_id = $intClienteID
									                AND DATE_FORMAT(fecha, '%Y-%m-%d') < '$dteFecha'
									                AND moneda_id = $intMonedaID
									                AND (estatus = 'ACTIVO' OR estatus = 'TIMBRAR')), 0) 
										- IFNULL((SELECT 
									                    SUM((subtotal + iva + ieps) / tipo_cambio) AS total_anticipo
									                FROM anticipos_aplicacion
									                WHERE prospecto_id = $intClienteID
									                AND DATE_FORMAT(fecha, '%Y-%m-%d') < '$dteFecha'
									                AND moneda_id = $intMonedaID
													AND (estatus = 'ACTIVO' OR estatus = 'TIMBRAR')), 0)            
									AS saldo_inicial;
								  ");

		return $strSQL->result();

	}

	/*Método para regresar las facturas (maquinaria, refacciones, servicios, notas de cargo, anticipos, notas de crédito y/o recibos de ingreso) del cliente 
	  que coincida con los criterios de búsqueda proporcionados (se utiliza en el reporte de estado de cuenta)*/
	public function buscar_movimientos_estado_cuenta($dteFechaInicial, $dteFechaFinal, $intClienteID, $intMonedaID, $arrSucursales, $arrModulos)
	{
		//Constante para identificar al tipo de movimiento entrada de maquinaria por devolución de la factura
		$intMovDevMaq = ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA;
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución de la factura
		$intMovDevRef = ENTRADA_REFACCIONES_DEVOLUCION_FACTURA;

		//Variables para generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
		$sucursales = explode('|', $arrSucursales);
		$strSucursalesMaq = '';
		$strSucursalesMovMaq = '';
		$strSucursalesRef = '';
		$strSucursalesMovRef = '';
		$strSucursalesSer = '';

		$strSucursalesNC = '';
		$strSucursalesNCD = '';
		$strSucursalesRI = '';
		$strSucursalesPA = '';

		$strSucursalesPagos = '';
		$strSucursalesCartera = '';
		
		for ($i = 0; $i<sizeof($sucursales); $i++) {
		    if($i == 0){
		    	$strSucursalesMaq .= 'AND ( ';
		    	$strSucursalesMaq .= 'FM.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesMovMaq .= 'AND ( ';
		    	$strSucursalesMovMaq .= 'MM.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesRef .= 'AND ( ';
		    	$strSucursalesRef .= 'FR.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesMovRef .= 'AND ( ';
		    	$strSucursalesMovRef .= 'MR.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesSer .= 'AND ( ';
		    	$strSucursalesSer .= 'FS.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesNC .= 'AND ( ';
		    	$strSucursalesNC .= 'NC.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesNCD .= 'AND ( ';
		    	$strSucursalesNCD .= 'NCR.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesRI .= 'AND ( ';
		    	$strSucursalesRI .= 'RI.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesPA .= 'AND ( ';
		    	$strSucursalesPA .= 'PA.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesPagos .= 'AND ( ';
		    	$strSucursalesPagos .= 'P.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesCartera .= 'AND ( ';
		    	$strSucursalesCartera .= 'CT.sucursal_id = '.$sucursales[$i];

		    }
		    else{

		    	$strSucursalesMaq .= ' OR FM.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesMovMaq .= ' OR MM.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesRef .= ' OR FR.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesMovRef .= ' OR MR.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesSer .= ' OR FS.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesNC .= ' OR NC.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesNCD .= ' OR NCR.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesRI .= ' OR RI.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesPA .= ' OR PA.sucursal_id = '.$sucursales[$i];

		    	$strSucursalesPagos .= ' OR P.sucursal_id = '.$sucursales[$i];
		    	$strSucursalesCartera .= ' OR CT.sucursal_id = '.$sucursales[$i];

		    }
		}

		$strSucursalesMaq .= ')';
		$strSucursalesMovMaq .= ')';
		$strSucursalesRef .= ')';
		$strSucursalesMovRef .= ')';
		$strSucursalesSer .= ')';
		$strSucursalesNC .= ')';
		$strSucursalesNCD .= ')';
		$strSucursalesRI .= ')';
		$strSucursalesPA .= ')';
		$strSucursalesPagos .= ')';
		$strSucursalesCartera .= ')';


		//Bloque de código para configurar los módulos que se mostrarán en cargos y abonos con base a lo seleccionado
		$modulosCargosAbonos = explode('|', $arrModulos);
		
		$strNotasCargo = '';
		$strNotasCargoDigitales = '';
		$strNotasCreditoDigitales = '';
		$strRecibosIngreso = '';
		$strPolizasAbono = '';
		$strPagos = '';
							
		for ($i = 0; $i<sizeof($modulosCargosAbonos); $i++) {
		    if($i == 0){
		    	$strRecibosIngreso .= 'AND ( ';
		    	$strRecibosIngreso .= 'RID.referencia = '."'".$modulosCargosAbonos[$i]."'";

		    	$strPolizasAbono .= 'AND ( ';
		    	$strPolizasAbono .= 'PAD.referencia = '."'".$modulosCargosAbonos[$i]."'";

		    	$strNotasCargo .= 'AND ( ';
		    	$strNotasCargo .= 'NCD.referencia = '."'".$modulosCargosAbonos[$i]."'";

		    	$strNotasCargoDigitales .= 'AND ( ';
		    	$strNotasCargoDigitales .= 'NCD.referencia = '."'".$modulosCargosAbonos[$i]."'";

		    	$strNotasCreditoDigitales .= 'AND ( ';
		    	$strNotasCreditoDigitales .= 'NCRD.referencia = '."'".$modulosCargosAbonos[$i]."'";

		    	$strPagos .= 'AND ( ';
		    	$strPagos .= 'PDR.tipo_referencia = '."'".$modulosCargosAbonos[$i]."'";

		    }
		    else{
		    	$strRecibosIngreso .= ' OR RID.referencia = '."'".$modulosCargosAbonos[$i]."'";
		    	$strPolizasAbono .= ' OR PAD.referencia = '."'".$modulosCargosAbonos[$i]."'";
		    	$strNotasCargo .= ' OR NCD.referencia = '."'".$modulosCargosAbonos[$i]."'";
		    	$strNotasCargoDigitales .= ' OR NCD.referencia = '."'".$modulosCargosAbonos[$i]."'";
		    	$strNotasCreditoDigitales .= ' OR NCRD.referencia = '."'".$modulosCargosAbonos[$i]."'";
		    	$strPagos .= ' OR PDR.tipo_referencia = '."'".$modulosCargosAbonos[$i]."'";
		    }
		}

		$strRecibosIngreso .= ')';
		$strPolizasAbono .= ')';
		$strNotasCargo .= ')';
		$strNotasCargoDigitales .= ')';
		$strNotasCreditoDigitales .= ')';
		$strPagos .= ')';

		$queryMaquinaria = "
			SELECT FM.factura_maquinaria_id AS ID, FM.folio,
			       FM.fecha,
			       DATE_FORMAT(FM.fecha, '%d/%m/%Y') AS fecha_format,
			       DATE_FORMAT(FM.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       FM.fecha_creacion,
			       'FACTURA DE MAQUINARIA' AS descripcion,
			       '' AS folio_referencia,
			       'cargo' AS tipo,
			       ROUND(((FM.precio + FM.iva + FM.ieps)/FM.tipo_cambio), 2) AS total
			FROM   facturas_maquinaria FM
			WHERE  FM.prospecto_id = $intClienteID
			$strSucursalesMaq
			AND    (DATE_FORMAT(FM.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
			AND    FM.moneda_id = $intMonedaID
			AND    (FM.estatus = 'ACTIVO' OR FM.estatus = 'TIMBRAR')
			GROUP BY FM.factura_maquinaria_id
			UNION
			SELECT MM.movimiento_maquinaria_id AS ID, MM.folio,
			       DATE_FORMAT(MM.fecha, '%Y-%m-%d') AS fecha,
			       DATE_FORMAT(MM.fecha, '%d/%m/%Y') AS fecha_format,
			       DATE_FORMAT(MM.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       MM.fecha_creacion,
			       'DEVOLUCIÓN DE MAQUINARIA' AS descripcion,
			       FM.folio AS folio_referencia,
			       'abono' AS tipo,
			       ROUND(((FM.precio + FM.iva + FM.ieps)/FM.tipo_cambio) , 2) AS total
			FROM   movimientos_maquinaria AS MM
			       INNER JOIN facturas_maquinaria AS FM ON MM.referencia_id = FM.factura_maquinaria_id
			WHERE  MM.prospecto_id = $intClienteID
			$strSucursalesMovMaq
			AND    MM.tipo_movimiento = $intMovDevMaq
			AND    (DATE_FORMAT(MM.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
			AND    FM.moneda_id = $intMonedaID
			AND    MM.estatus = 'ACTIVO'
			GROUP BY MM.movimiento_maquinaria_id
		";

		$queryRefacciones = "
			SELECT FR.factura_refacciones_id AS ID, FR.folio, 
			       FR.fecha, 
			       DATE_FORMAT(FR.fecha,'%d/%m/%Y') AS fecha_format,
			       DATE_FORMAT(FR.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       FR.fecha_creacion,
			       'FACTURA DE REFACCIONES' AS descripcion, 
			       '' AS folio_referencia, 
			       'cargo' AS tipo,
			       ROUND(IFNULL((FR.gastos_paqueteria + FR.gastos_paqueteria_iva)/FR.tipo_cambio, 0) +
			             (SUM(ROUND((FRD.precio_unitario * FRD.cantidad), 2) + 
						   	  ROUND((FRD.iva_unitario * FRD.cantidad), 2) + 
						   	  ROUND((FRD.ieps_unitario * FRD.cantidad), 2))/FR.tipo_cambio), 2) AS total
			FROM   facturas_refacciones_detalles AS FRD
			       INNER JOIN facturas_refacciones AS FR ON FR.factura_refacciones_id = FRD.factura_refacciones_id
			WHERE  FR.prospecto_id = $intClienteID
			$strSucursalesRef
			AND    (DATE_FORMAT(FR.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
			AND    FR.moneda_id = $intMonedaID
			AND    (FR.estatus = 'ACTIVO' OR FR.estatus = 'TIMBRAR')
			GROUP BY FR.factura_refacciones_id
			UNION
			SELECT MR.movimiento_refacciones_id AS ID, MR.folio,
			       DATE_FORMAT(MR.fecha, '%Y-%m-%d') AS fecha,
			       DATE_FORMAT(MR.fecha, '%d/%m/%Y') AS fecha_format,
			       DATE_FORMAT(MR.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       MR.fecha_creacion AS fecha_creacion,
			       'DEVOLUCIÓN DE REFACCIONES' AS descripcion,
			       FR.folio AS folio_referencia,
			       'abono' AS tipo,
			       ROUND((SUM(ROUND((FRD.precio_unitario * MRD.cantidad), 2) + 
						   	  ROUND((FRD.iva_unitario * MRD.cantidad), 2) + 
						   	  ROUND((FRD.ieps_unitario * MRD.cantidad), 2))/MR.tipo_cambio), 2) AS total
			FROM   movimientos_refacciones_detalles MRD
			       INNER JOIN movimientos_refacciones MR ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
			       INNER JOIN facturas_refacciones_detalles FRD ON FRD.refaccion_id = MRD.refaccion_id AND FRD.renglon = MRD.renglon
			       INNER JOIN facturas_refacciones FR ON FR.factura_refacciones_id = FRD.factura_refacciones_id 
			                  AND FR.factura_refacciones_id = MR.referencia_id
			WHERE  FR.prospecto_id = $intClienteID
			$strSucursalesMovRef
			AND    MR.tipo_movimiento = $intMovDevRef
			AND    (DATE_FORMAT(MR.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
			AND    FR.moneda_id = $intMonedaID
			AND    MR.estatus = 'ACTIVO'
			GROUP BY MR.movimiento_refacciones_id
		";

		$queryServicio = "
			SELECT FS.factura_servicio_id AS ID, FS.folio, 
			       FS.fecha, 
			       DATE_FORMAT(FS.fecha,'%d/%m/%Y') AS fecha_format,
			       DATE_FORMAT(FS.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       FS.fecha_creacion,
			       'FACTURA DE SERVICIO' AS descripcion, 
			       '' AS folio_referencia, 
			       'cargo' AS tipo,
			       ROUND(IFNULL((FS.gastos_servicio + FS.gastos_servicio_iva)/FS.tipo_cambio, 0) +
			             IFNULL((ManoObra.Importe/ FS.tipo_cambio), 0) +
			             IFNULL((Otros.Importe/ FS.tipo_cambio), 0) +
			             IFNULL((Refacciones.Importe/ FS.tipo_cambio), 0) +
			             IFNULL((Foraneos.Importe/ FS.tipo_cambio), 0), 2) AS total
			FROM   facturas_servicio FS
			       LEFT JOIN (SELECT factura_servicio_id, 
			                         SUM(precio_unitario + iva_unitario + ieps_unitario) AS Importe
			                  FROM   facturas_servicio_mano_obra
			                  GROUP BY factura_servicio_id) AS ManoObra ON FS.factura_servicio_id = ManoObra.factura_servicio_id
			       LEFT JOIN (SELECT factura_servicio_id, 
			                         SUM((precio_unitario + iva_unitario + ieps_unitario) * cantidad) AS Importe
			                  FROM   facturas_servicio_otros
			                  GROUP BY factura_servicio_id) AS Otros ON FS.factura_servicio_id = Otros.factura_servicio_id
			       LEFT JOIN (SELECT factura_servicio_id, 
			                         SUM((precio_unitario + iva_unitario + ieps_unitario) * cantidad) AS Importe
			                  FROM   facturas_servicio_refacciones
			                  GROUP BY factura_servicio_id) AS Refacciones ON FS.factura_servicio_id = Refacciones.factura_servicio_id
			       LEFT JOIN (SELECT factura_servicio_id, 
			                         SUM((precio_unitario + iva_unitario + ieps_unitario) * cantidad) AS Importe
			                  FROM   facturas_servicio_trabajos_foraneos
			                  GROUP BY factura_servicio_id) AS Foraneos ON FS.factura_servicio_id = Foraneos.factura_servicio_id
			WHERE FS.prospecto_id = $intClienteID
			$strSucursalesSer
			AND   (DATE_FORMAT(FS.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
			AND   FS.moneda_id = $intMonedaID
			AND   (FS.estatus = 'ACTIVO' OR FS.estatus = 'TIMBRAR')
			GROUP BY FS.factura_servicio_id
			UNION
			SELECT MR.movimiento_refacciones_id AS ID, MR.folio,
			       DATE_FORMAT(MR.fecha, '%Y-%m-%d') AS fecha,
			       DATE_FORMAT(MR.fecha, '%d/%m/%Y') AS fecha_format,
			       DATE_FORMAT(MR.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       MR.fecha_creacion AS fecha_creacion,
			       'DEVOLUCIÓN DE SERVICIO' AS descripcion,
			       FS.folio AS folio_referencia,
			       'abono' AS tipo,
			       ROUND(SUM(((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * MRD.cantidad)/MR.tipo_cambio), 2) AS total
			FROM   movimientos_refacciones_detalles MRD
			       INNER JOIN movimientos_refacciones MR ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
			       INNER JOIN facturas_servicio_refacciones FSR ON FSR.refaccion_id = MRD.refaccion_id AND FSR.renglon = MRD.renglon
			       INNER JOIN facturas_servicio FS ON FS.factura_servicio_id = FSR.factura_servicio_id 
			                  AND FS.factura_servicio_id = MR.referencia_id
			WHERE  FS.prospecto_id = $intClienteID
			$strSucursalesMovRef
			AND    MR.tipo_movimiento = $intMovDevRef
			AND    (DATE_FORMAT(MR.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
			AND    FS.moneda_id = $intMonedaID
			AND    MR.estatus = 'ACTIVO'
			GROUP BY MR.movimiento_refacciones_id
		";

		$queryCargosAbonos = "
			SELECT CONCAT(NC.nota_cargo_id, NCD.renglon) AS ID, NC.folio, 
			       NC.fecha, 
			       DATE_FORMAT(NC.fecha,'%d/%m/%Y') AS fecha_format,
			       DATE_FORMAT(NC.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       NC.fecha_creacion,
			       'NOTA DE CARGO' AS descripcion, 
			       CASE
			       WHEN NCD.referencia = 'MAQUINARIA' THEN (SELECT folio 
			                                                FROM   facturas_maquinaria 
			                                                WHERE  factura_maquinaria_id = NCD.referencia_id)
			       WHEN NCD.referencia = 'SERVICIO' THEN (SELECT folio 
			                                              FROM   facturas_servicio 
			                                              WHERE  factura_servicio_id = NCD.referencia_id)
			       WHEN NCD.referencia = 'REFACCIONES' THEN (SELECT folio 
			                                                 FROM   facturas_refacciones 
			                                                 WHERE  factura_refacciones_id = NCD.referencia_id)
			       END AS folioReferencia, 
			       'cargo' AS tipo,
			       ROUND(((NCD.precio + NCD.iva + NCD.ieps)/NC.tipo_cambio), 2) AS total
			FROM   notas_cargo_detalles NCD
			       INNER JOIN notas_cargo NC ON NCD.nota_cargo_id = NC.nota_cargo_id
			WHERE  NC.prospecto_id = $intClienteID
			$strNotasCargo
			$strSucursalesNC
			AND    (DATE_FORMAT(NC.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
			AND    NC.moneda_id = $intMonedaID
			AND    NC.estatus = 'ACTIVO'
			UNION
			SELECT CONCAT(NC.nota_cargo_digital_id, NCD.renglon) AS ID, NC.folio, 
			       NC.fecha, 
			       DATE_FORMAT(NC.fecha,'%d/%m/%Y') AS fecha_format,
			       DATE_FORMAT(NC.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       NC.fecha_creacion,
			       'NOTA DE CARGO DIGITAL' AS descripcion, 
			       CASE
			       WHEN NCD.referencia = 'MAQUINARIA' THEN (SELECT folio 
			                                                FROM   facturas_maquinaria 
			                                                WHERE  factura_maquinaria_id = NCD.referencia_id)
			       WHEN NCD.referencia = 'SERVICIO' THEN (SELECT folio 
			                                              FROM   facturas_servicio 
			                                              WHERE  factura_servicio_id = NCD.referencia_id)
			       WHEN NCD.referencia = 'REFACCIONES' THEN (SELECT folio 
			                                                 FROM   facturas_refacciones 
			                                                 WHERE  factura_refacciones_id = NCD.referencia_id)
			       END AS folioReferencia, 
			       'cargo' AS tipo,
			       ROUND(((NCD.precio + NCD.iva + NCD.ieps)/NC.tipo_cambio), 2) AS total
			FROM   notas_cargo_digitales_detalles NCD
			       INNER JOIN notas_cargo_digitales NC ON NCD.nota_cargo_digital_id = NC.nota_cargo_digital_id
			WHERE  NC.prospecto_id = $intClienteID
			$strNotasCargoDigitales
			$strSucursalesNC
			AND    (DATE_FORMAT(NC.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
			AND    NC.moneda_id = $intMonedaID
			AND    (NC.estatus = 'ACTIVO' OR NC.estatus = 'TIMBRAR')
			UNION
			SELECT CONCAT(NCR.nota_credito_digital_id, NCRD.renglon) AS ID, NCR.folio, 
			       NCR.fecha, 
			       DATE_FORMAT(NCR.fecha,'%d/%m/%Y') AS fecha_format,
			       DATE_FORMAT(NCR.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       NCR.fecha_creacion,
			       'NOTA DE CRÉDITO' AS descripcion, 
			       CASE
			       WHEN NCRD.referencia = 'MAQUINARIA' THEN (SELECT folio 
			                                                 FROM   facturas_maquinaria 
			                                                 WHERE  factura_maquinaria_id = NCRD.referencia_id)
			       WHEN NCRD.referencia = 'SERVICIO' THEN (SELECT folio 
			                                               FROM   facturas_servicio 
			                                               WHERE  factura_servicio_id = NCRD.referencia_id)
			       WHEN NCRD.referencia = 'REFACCIONES' THEN (SELECT folio 
			                                                  FROM   facturas_refacciones 
			                                                  WHERE  factura_refacciones_id = NCRD.referencia_id)
			       END AS folioReferencia, 
			       'abono' AS tipo,
			       ROUND(((NCRD.precio + NCRD.iva + NCRD.ieps)/NCR.tipo_cambio), 2) AS total
			FROM   notas_credito_digitales_detalles NCRD
			       INNER JOIN notas_credito_digitales NCR ON NCR.nota_credito_digital_id = NCRD.nota_credito_digital_id
			WHERE  NCR.prospecto_id = $intClienteID
			$strNotasCreditoDigitales
			AND    (DATE_FORMAT(NCR.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
			AND    NCR.moneda_id = $intMonedaID
			AND    (NCR.estatus = 'ACTIVO' OR NCR.estatus = 'TIMBRAR')  
			UNION
			SELECT CONCAT(RI.recibo_ingreso_id, RID.renglon) AS ID, RI.folio, 
			       RI.fecha, 
			       DATE_FORMAT(RI.fecha,'%d/%m/%Y') AS fecha_format,
			       DATE_FORMAT(RI.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       RI.fecha_creacion,
			       'RECIBO DE INGRESO' AS descripcion, 
			       CASE
			       WHEN RID.referencia = 'MAQUINARIA' THEN (SELECT folio 
			                                                FROM   facturas_maquinaria 
			                                                WHERE  factura_maquinaria_id = RID.referencia_id)
			       WHEN RID.referencia = 'SERVICIO' THEN (SELECT folio 
			                                              FROM   facturas_servicio 
			                                              WHERE  factura_servicio_id = RID.referencia_id)
			       WHEN RID.referencia = 'REFACCIONES' THEN (SELECT folio 
			                                                 FROM   facturas_refacciones 
			                                                 WHERE  factura_refacciones_id = RID.referencia_id)
			       END AS folioReferencia, 
			       'abono' AS tipo,
			       ROUND(((RID.precio + RID.iva + RID.ieps)/RI.tipo_cambio), 2) AS total 
			FROM   recibos_ingreso_detalles RID 
			       INNER JOIN recibos_ingreso RI ON RID.recibo_ingreso_id = RI.recibo_ingreso_id 
			WHERE  RI.prospecto_id = $intClienteID
			$strRecibosIngreso
			$strSucursalesRI
			AND    (DATE_FORMAT(RI.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal') 
			AND    RI.moneda_id = $intMonedaID 
			AND    RI.estatus = 'ACTIVO'  
			UNION
			SELECT CONCAT(PA.poliza_abono_id, PAD.renglon) AS ID, PA.folio, 
			       PA.fecha, 
			       DATE_FORMAT(PA.fecha,'%d/%m/%Y') AS fecha_format,
			       DATE_FORMAT(PA.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       PA.fecha_creacion,
			       'POLIZA DE ABONO' AS descripcion, 
			       CASE
			       WHEN PAD.referencia = 'MAQUINARIA' THEN (SELECT folio 
			                                                FROM   facturas_maquinaria 
			                                                WHERE  factura_maquinaria_id = PAD.referencia_id)
			       WHEN PAD.referencia = 'SERVICIO' THEN (SELECT folio 
			                                              FROM   facturas_servicio 
			                                              WHERE  factura_servicio_id = PAD.referencia_id)
			       WHEN PAD.referencia = 'REFACCIONES' THEN (SELECT folio 
			                                                 FROM   facturas_refacciones 
			                                                 WHERE  factura_refacciones_id = PAD.referencia_id)
			       END AS folioReferencia, 
			       'abono' AS tipo,
			       ROUND(((PAD.precio + PAD.iva + PAD.ieps)/PA.tipo_cambio), 2) AS total 
			FROM   polizas_abono_detalles_02 PAD 
			       INNER JOIN polizas_abono_02 PA ON PAD.poliza_abono_id = PA.poliza_abono_id
			WHERE  PA.prospecto_id = $intClienteID
			$strPolizasAbono
			$strSucursalesPA
			AND    (DATE_FORMAT(PA.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal') 
			AND    PA.moneda_id = $intMonedaID 
			AND    PA.estatus = 'ACTIVO'    
			UNION 
			SELECT CONCAT(P.pago_id, PD.renglon, PDR.renglon) AS ID, P.folio, 
			       DATE_FORMAT(PD.fecha_pago, '%Y-%m-%d') AS fecha,
			       DATE_FORMAT(PD.fecha_pago, '%d/%m/%Y') AS fecha_format,
			       DATE_FORMAT(PD.fecha_pago, '%Y-%m-%d') AS fecha_ordenamiento,
			       PD.fecha_pago AS fecha_creacion, 
			       'PAGO' AS descripcion,
			       PDR.folio AS folio_referencia, 
			       'abono' AS tipo,
			       ROUND(SUM(PDR.imp_pagado) , 2) AS total
			FROM   pagos AS P
			       INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
			       INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PDR.pago_id = P.pago_id AND PDR.renglon_detalles = PD.renglon
			       INNER JOIN sat_monedas AS M ON PD.moneda_id = M.moneda_id
			WHERE  P.prospecto_id = $intClienteID
			$strPagos
			$strSucursalesPagos
			AND    (DATE_FORMAT(P.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
			AND    (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
			GROUP BY P.pago_id, PD.renglon, PDR.renglon
		";

		//Bloque de código para identificar que registros de la tabla cartera serán considerados con base al módulo seleccionados
		$modulosCartera = explode('|', $arrModulos);						

		$strModulosCartera = '';
		
		for ($i = 0; $i<sizeof($modulosCartera); $i++) {
		    if($i == 0){
		    	$strModulosCartera .= 'AND ( ';
		    	$strModulosCartera .= 'CT.modulo = '."'".$modulosCartera[$i]."'";
		    }
		    else{
		    	$strModulosCartera .= ' OR CT.modulo = '."'".$modulosCartera[$i]."'";
		    }
		}

		$strModulosCartera .= ')';						

		$queryCartera = "
			UNION 	
			SELECT CONCAT(CT.cartera_id, 1) AS ID, CT.folio, 
			       DATE_FORMAT(CT.fecha, '%Y-%m-%d') AS fecha,
			       DATE_FORMAT(CT.fecha, '%d/%m/%Y') AS fecha_format,
			       DATE_FORMAT(CT.fecha, '%Y-%m-%d') AS fecha_ordenamiento,
			       CT.fecha AS fecha_creacion, 
			       'CARTERA' AS descripcion,
			       '' AS folio_referencia, 
			       'cargo' AS tipo,
			       ROUND((CT.saldo/CT.tipo_cambio), 2) AS total
			FROM   cartera AS CT
			WHERE  CT.prospecto_id = $intClienteID
			$strSucursalesCartera
			AND    (DATE_FORMAT(CT.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
			$strModulosCartera
			AND    CT.moneda_id = $intMonedaID
			UNION 
			SELECT CONCAT(P.pago_id, PD.renglon, PDR.renglon) AS ID, P.folio, 
			       DATE_FORMAT(PD.fecha_pago, '%Y-%m-%d') AS fecha,
			       DATE_FORMAT(PD.fecha_pago, '%d/%m/%Y') AS fecha_format,
			       DATE_FORMAT(PD.fecha_pago, '%Y-%m-%d') AS fecha_ordenamiento,
			       PD.fecha_pago AS fecha_creacion, 
			       'PAGO' AS descripcion,
			       PDR.folio AS folio_referencia, 
			       'abono' AS tipo,
			       ROUND(SUM(PDR.imp_pagado/PD.tipo_cambio) , 2) AS total
			FROM   pagos AS P
			       INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
			       INNER JOIN pagos_detalles_relacionados_02 AS PDR ON PDR.pago_id = P.pago_id AND PDR.renglon_detalles = PD.renglon
			       INNER JOIN sat_monedas AS M ON PD.moneda_id = M.moneda_id
			       INNER JOIN cartera AS CT ON PDR.tipo_referencia = 'CARTERA' AND PDR.referencia_id = CT.cartera_id
			WHERE  P.prospecto_id = $intClienteID
			$strSucursalesPagos
			$strModulosCartera
			AND    (DATE_FORMAT(P.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
			AND    M.moneda_id = $intMonedaID
			AND    (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')
			GROUP BY P.pago_id, PD.renglon, PDR.renglon
			ORDER BY fecha_ordenamiento, fecha_creacion ASC;
		";						

		/*
		//BLOQUE DE CÓDIGO QUE FORMA PARTE DE ANTICIPOS
		UNION SELECT
		 	AA.folio, 
		 	AA.fecha, 
	         DATE_FORMAT(AA.fecha,'%d/%m/%Y') AS fecha_format,
		 	'ANTICIPO APLICACIÓN DEL CLIENTE' AS descripcion, 
		 	'' AS folio_referencia, 
		 	'abono' AS tipo,
		 	SUM((AA.subtotal + AA.iva + AA.ieps) / AA.tipo_cambio) AS total
		 FROM anticipos_aplicacion AA
		 WHERE AA.prospecto_id = $intClienteID
		 AND (DATE_FORMAT(AA.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
		 AND AA.moneda_id = $intMonedaID
		 AND (AA.estatus = 'ACTIVO' OR AA.estatus = 'TIMBRAR')
	    GROUP BY AA.anticipo_aplicacion_id
		*/						

		
		//Bloque de código para configurar los módulos que se mostrarán con base a lo seleccionado
		$modulos = explode('|', $arrModulos);
							
		$queryGeneral = '';
		foreach ($modulos as &$modulo) {
		    
		    switch ($modulo) {
			    case 'MAQUINARIA':
			        $queryGeneral .= $queryMaquinaria;
			        break;
			    case 'REFACCIONES':
			        $queryGeneral .= $queryRefacciones;
			        break;
			    case 'SERVICIO':
			        $queryGeneral .= $queryServicio;
			        break;
			}

			$queryGeneral .= ' UNION ';

		}

		$queryGeneral .= $queryCargosAbonos;
		$queryGeneral .= $queryCartera;

		$strSQL = $this->db->query($queryGeneral);

		return $strSQL->result();

	}


	/*Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado 
     *(se utiliza en el reporte de estado de cuenta)*/
	public function buscar_distintas_monedas_estado_cuenta($dteFechaInicial, $dteFechaFinal, $intClienteID)
	{

		$strSQL	= $this->db->query("SELECT 
										DISTINCT FM.moneda_id, 
												CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion,
												M.codigo
										FROM facturas_maquinaria AS FM
										INNER JOIN sat_monedas AS M ON FM.moneda_id = M.moneda_id
										WHERE  FM.prospecto_id = $intClienteID 
										AND ((DATE_FORMAT(FM.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal') OR (DATE_FORMAT(FM.fecha, '%Y-%m-%d') < '$dteFechaInicial'))
										AND (FM.estatus = 'ACTIVO' OR FM.estatus = 'TIMBRAR')
									UNION 
										SELECT 
											DISTINCT FR.moneda_id, 
													CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion,
													M.codigo
										FROM facturas_refacciones FR
										INNER JOIN sat_monedas AS M ON FR.moneda_id = M.moneda_id
										WHERE FR.prospecto_id = $intClienteID
										AND ((DATE_FORMAT(FR.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal') OR (DATE_FORMAT(FR.fecha, '%Y-%m-%d') < '$dteFechaInicial'))
										AND (FR.estatus = 'ACTIVO' OR FR.estatus = 'TIMBRAR')
									UNION 
										SELECT 
											DISTINCT FS.moneda_id, 
													CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion,
													M.codigo
										FROM facturas_servicio FS
										INNER JOIN sat_monedas AS M ON FS.moneda_id = M.moneda_id
										WHERE FS.prospecto_id = $intClienteID
										AND ((DATE_FORMAT(FS.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal') OR (DATE_FORMAT(FS.fecha, '%Y-%m-%d') < '$dteFechaInicial'))
										AND (FS.estatus = 'ACTIVO' OR FS.estatus = 'TIMBRAR')
									UNION 
										SELECT 
											DISTINCT CT.moneda_id, 
													CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion,
													M.codigo
										FROM cartera CT
										INNER JOIN sat_monedas AS M ON CT.moneda_id = M.moneda_id
										WHERE CT.prospecto_id = $intClienteID
										AND ((DATE_FORMAT(CT.fecha, '%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal') OR (DATE_FORMAT(CT.fecha, '%Y-%m-%d') < '$dteFechaInicial'))	
									ORDER BY  moneda_id ASC");
		
		return $strSQL->result();
	}


}