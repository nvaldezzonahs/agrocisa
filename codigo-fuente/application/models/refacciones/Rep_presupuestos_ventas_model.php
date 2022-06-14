<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_presupuestos_ventas_model extends CI_model {

	public function buscar_presupuestos_ventas($intAnio)
	{
		
        $query = $this->db->query('SELECT
										RPV.refacciones_linea_id,
										RL.codigo,
										RL.descripcion,
										SUM(CASE WHEN RPV.mes = 01 THEN RPV.importe ELSE 0 END) AS PresupuestoEnero,
								        IFNULL(Temp.ImporteEnero, 0) AS RealEnero,
										SUM(CASE WHEN RPV.mes = 02 THEN RPV.importe ELSE 0 END) AS PresupuestoFebrero,
								        IFNULL(Temp.ImporteFebrero, 0) AS RealFebrero,
										SUM(CASE WHEN RPV.mes = 03 THEN RPV.importe ELSE 0 END) AS PresupuestoMarzo,
								        IFNULL(Temp.ImporteMarzo, 0) AS RealMarzo,
										SUM(CASE WHEN RPV.mes = 04 THEN RPV.importe ELSE 0 END) AS PresupuestoAbril,
								        IFNULL(Temp.ImporteAbril, 0) AS RealAbril,
										SUM(CASE WHEN RPV.mes = 05 THEN RPV.importe ELSE 0 END) AS PresupuestoMayo,
								        IFNULL(Temp.ImporteMayo, 0) AS RealMayo,
										SUM(CASE WHEN RPV.mes = 06 THEN RPV.importe ELSE 0 END) AS PresupuestoJunio,
								        IFNULL(Temp.ImporteJunio, 0) AS RealJunio,
										SUM(CASE WHEN RPV.mes = 07 THEN RPV.importe ELSE 0 END) AS PresupuestoJulio,
								        IFNULL(Temp.ImporteJulio, 0) AS RealJulio,
										SUM(CASE WHEN RPV.mes = 08 THEN RPV.importe ELSE 0 END) AS PresupuestoAgosto,
								        IFNULL(Temp.ImporteAgosto, 0) AS RealAgosto,
										SUM(CASE WHEN RPV.mes = 09 THEN RPV.importe ELSE 0 END) AS PresupuestoSeptiembre,
								        IFNULL(Temp.ImporteSeptiembre, 0) AS RealSeptiembre,
										SUM(CASE WHEN RPV.mes = 10 THEN RPV.importe ELSE 0 END) AS PresupuestoOctubre,
								        IFNULL(Temp.ImporteOctubre, 0) AS RealOctubre,
										SUM(CASE WHEN RPV.mes = 11 THEN RPV.importe ELSE 0 END) AS PresupuestoNoviembre,
								        IFNULL(Temp.ImporteNoviembre, 0) AS RealNoviembre,
										SUM(CASE WHEN RPV.mes = 12 THEN RPV.importe ELSE 0 END) AS PresupuestoDiciembre,
								        IFNULL(Temp.ImporteDiciembre, 0) AS RealDiciembre
								FROM (
										refacciones_presupuestos_ventas RPV
										INNER JOIN refacciones_lineas RL ON RL.refacciones_linea_id = RPV.refacciones_linea_id
									 ) 
								LEFT JOIN
									(
										SELECT  
												R.refacciones_linea_id AS LineaID,
												SUM(CASE WHEN MONTH(FR.fecha) = 01 THEN FRD.cantidad * (FRD.costo_unitario * FR.tipo_cambio) ELSE 0 END) AS ImporteEnero,
												SUM(CASE WHEN MONTH(FR.fecha) = 02 THEN FRD.cantidad * (FRD.costo_unitario * FR.tipo_cambio) ELSE 0 END) AS ImporteFebrero,
												SUM(CASE WHEN MONTH(FR.fecha) = 03 THEN FRD.cantidad * (FRD.costo_unitario * FR.tipo_cambio) ELSE 0 END) AS ImporteMarzo,
												SUM(CASE WHEN MONTH(FR.fecha) = 04 THEN FRD.cantidad * (FRD.costo_unitario * FR.tipo_cambio) ELSE 0 END) AS ImporteAbril,
												SUM(CASE WHEN MONTH(FR.fecha) = 05 THEN FRD.cantidad * (FRD.costo_unitario * FR.tipo_cambio) ELSE 0 END) AS ImporteMayo,
												SUM(CASE WHEN MONTH(FR.fecha) = 06 THEN FRD.cantidad * (FRD.costo_unitario * FR.tipo_cambio) ELSE 0 END) AS ImporteJunio,
												SUM(CASE WHEN MONTH(FR.fecha) = 07 THEN FRD.cantidad * (FRD.costo_unitario * FR.tipo_cambio) ELSE 0 END) AS ImporteJulio,
												SUM(CASE WHEN MONTH(FR.fecha) = 08 THEN FRD.cantidad * (FRD.costo_unitario * FR.tipo_cambio) ELSE 0 END) AS ImporteAgosto,
												SUM(CASE WHEN MONTH(FR.fecha) = 09 THEN FRD.cantidad * (FRD.costo_unitario * FR.tipo_cambio) ELSE 0 END) AS ImporteSeptiembre,
												SUM(CASE WHEN MONTH(FR.fecha) = 10 THEN FRD.cantidad * (FRD.costo_unitario * FR.tipo_cambio) ELSE 0 END) AS ImporteOctubre,
												SUM(CASE WHEN MONTH(FR.fecha) = 11 THEN FRD.cantidad * (FRD.costo_unitario * FR.tipo_cambio) ELSE 0 END) AS ImporteNoviembre,
												SUM(CASE WHEN MONTH(FR.fecha) = 12 THEN FRD.cantidad * (FRD.costo_unitario * FR.tipo_cambio) ELSE 0 END) AS ImporteDiciembre
										FROM facturas_refacciones FR
										INNER JOIN facturas_refacciones_detalles FRD ON FRD.factura_refacciones_id = FR.factura_refacciones_id
										INNER JOIN refacciones R ON R.refaccion_id = FRD.refaccion_id 
										WHERE FR.estatus = "ACTIVO"
										AND YEAR(FR.fecha) = '.$intAnio.'
										GROUP BY R.refacciones_linea_id
										ORDER BY R.refacciones_linea_id
								    ) AS Temp ON RPV.refacciones_linea_id = Temp.LineaID     
								WHERE RPV.anio = '.$intAnio.'
								GROUP BY RPV.refacciones_linea_id
								ORDER BY RPV.refacciones_linea_id');

        return $query;

	}

}

?>