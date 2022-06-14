<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_presupuestos_compras_model extends CI_model {

	public function buscar_presupuestos_compras($intAnio)
	{
		
        $query = $this->db->query('SELECT
								        RPC.refacciones_linea_id,
								        RL.codigo,
								        RL.descripcion,
										SUM(CASE WHEN RPC.mes = 01 THEN RPC.importe ELSE 0 END) AS PresupuestoEnero,
								        IFNULL(Temp.ImporteEnero - Temp2.DevolucionEnero, 0) AS RealEnero,
										SUM(CASE WHEN RPC.mes = 02 THEN RPC.importe ELSE 0 END) AS PresupuestoFebrero,
								        IFNULL(Temp.ImporteFebrero - Temp2.DevolucionFebrero, 0) AS RealFebrero,
								        SUM(CASE WHEN RPC.mes = 03 THEN RPC.importe ELSE 0 END) AS PresupuestoMarzo,
								        IFNULL(Temp.ImporteMarzo - Temp2.DevolucionMarzo, 0) AS RealMarzo,
								        SUM(CASE WHEN RPC.mes = 04 THEN RPC.importe ELSE 0 END) AS PresupuestoAbril,
								        IFNULL(Temp.ImporteAbril - Temp2.DevolucionAbril, 0) AS RealAbril,
								        SUM(CASE WHEN RPC.mes = 05 THEN RPC.importe ELSE 0 END) AS PresupuestoMayo,
								        IFNULL(Temp.ImporteMayo - Temp2.DevolucionMayo, 0) AS RealMayo,
								        SUM(CASE WHEN RPC.mes = 06 THEN RPC.importe ELSE 0 END) AS PresupuestoJunio,
								        IFNULL(Temp.ImporteJunio - Temp2.DevolucionJunio, 0) AS RealJunio,
								        SUM(CASE WHEN RPC.mes = 07 THEN RPC.importe ELSE 0 END) AS PresupuestoJulio,
								        IFNULL(Temp.ImporteJulio - Temp2.DevolucionJulio, 0) AS RealJulio,
								        SUM(CASE WHEN RPC.mes = 08 THEN RPC.importe ELSE 0 END) AS PresupuestoAgosto,
								        IFNULL(Temp.ImporteAgosto - Temp2.DevolucionAgosto, 0) AS RealAgosto,
								        SUM(CASE WHEN RPC.mes = 09 THEN RPC.importe ELSE 0 END) AS PresupuestoSeptiembre,
								        IFNULL(Temp.ImporteSeptiembre - Temp2.DevolucionSeptiembre, 0) AS RealSeptiembre,
								        SUM(CASE WHEN RPC.mes = 10 THEN RPC.importe ELSE 0 END) AS PresupuestoOctubre,
								        IFNULL(Temp.ImporteOctubre - Temp2.DevolucionOctubre, 0) AS RealOctubre,
								        SUM(CASE WHEN RPC.mes = 11 THEN RPC.importe ELSE 0 END) AS PresupuestoNoviembre,
								        IFNULL(Temp.ImporteNoviembre - Temp2.DevolucionNoviembre, 0) AS RealNoviembre,
								        SUM(CASE WHEN RPC.mes = 12 THEN RPC.importe ELSE 0 END) AS PresupuestoDiciembre,
								        IFNULL(Temp.ImporteDiciembre - Temp2.DevolucionDiciembre, 0) AS RealDiciembre
								FROM (
										refacciones_presupuestos_compras RPC
										INNER JOIN refacciones_lineas RL ON RL.refacciones_linea_id = RPC.refacciones_linea_id
									 )
								LEFT JOIN
									(
										SELECT  
												R.refacciones_linea_id AS LineaID,
												SUM(CASE WHEN MONTH(MR.fecha) = 01 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS ImporteEnero,
												SUM(CASE WHEN MONTH(MR.fecha) = 02 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS ImporteFebrero,
												SUM(CASE WHEN MONTH(MR.fecha) = 03 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS ImporteMarzo,
												SUM(CASE WHEN MONTH(MR.fecha) = 04 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS ImporteAbril,
												SUM(CASE WHEN MONTH(MR.fecha) = 05 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS ImporteMayo,
												SUM(CASE WHEN MONTH(MR.fecha) = 06 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS ImporteJunio,
												SUM(CASE WHEN MONTH(MR.fecha) = 07 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS ImporteJulio,
												SUM(CASE WHEN MONTH(MR.fecha) = 08 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS ImporteAgosto,
												SUM(CASE WHEN MONTH(MR.fecha) = 09 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS ImporteSeptiembre,
												SUM(CASE WHEN MONTH(MR.fecha) = 10 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS ImporteOctubre,
												SUM(CASE WHEN MONTH(MR.fecha) = 11 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS ImporteNoviembre,
												SUM(CASE WHEN MONTH(MR.fecha) = 12 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS ImporteDiciembre
										FROM movimientos_refacciones MR
										INNER JOIN movimientos_refacciones_detalles MRD ON MRD.movimiento_refacciones_id = MR.movimiento_refacciones_id
										INNER JOIN refacciones R ON R.refaccion_id = MRD.refaccion_id 
										WHERE MR.tipo_movimiento = 1
										AND YEAR(MR.fecha) = '.$intAnio.'
										GROUP BY R.refacciones_linea_id
										ORDER BY R.refacciones_linea_id
									) AS Temp ON RPC.refacciones_linea_id = Temp.LineaID
								LEFT JOIN
									(
										SELECT  
												R.refacciones_linea_id AS LineaID,
												SUM(CASE WHEN MONTH(MR.fecha) = 01 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS DevolucionEnero,
												SUM(CASE WHEN MONTH(MR.fecha) = 02 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS DevolucionFebrero,
												SUM(CASE WHEN MONTH(MR.fecha) = 03 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS DevolucionMarzo,
												SUM(CASE WHEN MONTH(MR.fecha) = 04 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS DevolucionAbril,
												SUM(CASE WHEN MONTH(MR.fecha) = 05 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS DevolucionMayo,
												SUM(CASE WHEN MONTH(MR.fecha) = 06 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS DevolucionJunio,
												SUM(CASE WHEN MONTH(MR.fecha) = 07 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS DevolucionJulio,
												SUM(CASE WHEN MONTH(MR.fecha) = 08 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS DevolucionAgosto,
												SUM(CASE WHEN MONTH(MR.fecha) = 09 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS DevolucionSeptiembre,
												SUM(CASE WHEN MONTH(MR.fecha) = 10 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS DevolucionOctubre,
												SUM(CASE WHEN MONTH(MR.fecha) = 11 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS DevolucionNoviembre,
												SUM(CASE WHEN MONTH(MR.fecha) = 12 THEN MRD.cantidad * (MRD.costo_unitario * MR.tipo_cambio) ELSE 0 END) AS DevolucionDiciembre
										FROM movimientos_refacciones MR
										INNER JOIN movimientos_refacciones_detalles MRD ON MRD.movimiento_refacciones_id = MR.movimiento_refacciones_id
										INNER JOIN refacciones R ON R.refaccion_id = MRD.refaccion_id 
										WHERE MR.tipo_movimiento = 14
										AND YEAR(MR.fecha) = '.$intAnio.'
										GROUP BY R.refacciones_linea_id
										ORDER BY R.refacciones_linea_id
									) AS Temp2 ON RPC.refacciones_linea_id = Temp2.LineaID    
								WHERE RPC.anio = '.$intAnio.'
								GROUP BY RPC.refacciones_linea_id
								ORDER BY RPC.refacciones_linea_id');
        return $query;

	}

}

?>