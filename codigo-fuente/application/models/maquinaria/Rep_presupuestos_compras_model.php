<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_presupuestos_compras_model extends CI_model {

	public function buscar_presupuestos_compras($intAnio)
	{
		
        $query = $this->db->query('SELECT
										MD.codigo,
										MD.descripcion_corta,
										SUM(CASE WHEN MPC.mes = 01 THEN MPC.importe ELSE 0 END) AS PresupuestoEnero,
								        IFNULL(Temp.ImporteEnero - Temp2.DevolucionEnero, 0) AS RealEnero,
										SUM(CASE WHEN MPC.mes = 02 THEN MPC.importe ELSE 0 END) AS PresupuestoFebrero,
										IFNULL(Temp.ImporteFebrero - Temp2.DevolucionFebrero, 0) AS RealFebrero,
										SUM(CASE WHEN MPC.mes = 03 THEN MPC.importe ELSE 0 END) AS PresupuestoMarzo,
										IFNULL(Temp.ImporteMarzo - Temp2.DevolucionMarzo, 0) AS RealMarzo,
										SUM(CASE WHEN MPC.mes = 04 THEN MPC.importe ELSE 0 END) AS PresupuestoAbril,
										IFNULL(Temp.ImporteAbril - Temp2.DevolucionAbril, 0) AS RealAbril,
										SUM(CASE WHEN MPC.mes = 05 THEN MPC.importe ELSE 0 END) AS PresupuestoMayo,
								        IFNULL(Temp.ImporteMayo - Temp2.DevolucionMayo, 0) AS RealMayo,
										SUM(CASE WHEN MPC.mes = 06 THEN MPC.importe ELSE 0 END) AS PresupuestoJunio,
										IFNULL(Temp.ImporteJunio - Temp2.DevolucionJunio, 0) AS RealJunio,
										SUM(CASE WHEN MPC.mes = 07 THEN MPC.importe ELSE 0 END) AS PresupuestoJulio,
										IFNULL(Temp.ImporteJulio - Temp2.DevolucionJulio, 0) AS RealJulio,
										SUM(CASE WHEN MPC.mes = 08 THEN MPC.importe ELSE 0 END) AS PresupuestoAgosto,
										IFNULL(Temp.ImporteAgosto - Temp2.DevolucionAgosto, 0) AS RealAgosto,
										SUM(CASE WHEN MPC.mes = 09 THEN MPC.importe ELSE 0 END) AS PresupuestoSeptiembre,
										IFNULL(Temp.ImporteSeptiembre - Temp2.DevolucionSeptiembre, 0) AS RealSeptiembre,
										SUM(CASE WHEN MPC.mes = 10 THEN MPC.importe ELSE 0 END) AS PresupuestoOctubre,
										IFNULL(Temp.ImporteOctubre - Temp2.DevolucionOctubre, 0) AS RealOctubre,
										SUM(CASE WHEN MPC.mes = 11 THEN MPC.importe ELSE 0 END) AS PresupuestoNoviembre,
										IFNULL(Temp.ImporteNoviembre - Temp2.DevolucionNoviembre, 0) AS RealNoviembre,
										SUM(CASE WHEN MPC.mes = 12 THEN MPC.importe ELSE 0 END) AS PresupuestoDiciembre,
										IFNULL(Temp.ImporteDiciembre - Temp2.DevolucionDiciembre, 0) AS RealDiciembre
								FROM (maquinaria_presupuestos_compras MPC
								LEFT JOIN ordenes_compra_maquinaria_detalles OCMD ON OCMD.maquinaria_descripcion_id = MPC.maquinaria_descripcion_id
								INNER JOIN maquinaria_descripciones MD ON MD.maquinaria_descripcion_id = MPC.maquinaria_descripcion_id)
								LEFT JOIN
								(
								SELECT  OCMD.codigo AS ID,
										SUM(CASE WHEN MONTH(MM.fecha) = 01 THEN OCMD.cantidad * (OCMD.precio_unitario * MM.tipo_cambio) ELSE 0 END) AS ImporteEnero,
										SUM(CASE WHEN MONTH(MM.fecha) = 02 THEN OCMD.cantidad * (OCMD.precio_unitario * MM.tipo_cambio) ELSE 0 END) AS ImporteFebrero,
										SUM(CASE WHEN MONTH(MM.fecha) = 03 THEN OCMD.cantidad * (OCMD.precio_unitario * MM.tipo_cambio) ELSE 0 END) AS ImporteMarzo,
										SUM(CASE WHEN MONTH(MM.fecha) = 04 THEN OCMD.cantidad * (OCMD.precio_unitario * MM.tipo_cambio) ELSE 0 END) AS ImporteAbril,
										SUM(CASE WHEN MONTH(MM.fecha) = 05 THEN OCMD.cantidad * (OCMD.precio_unitario * MM.tipo_cambio) ELSE 0 END) AS ImporteMayo,
										SUM(CASE WHEN MONTH(MM.fecha) = 06 THEN OCMD.cantidad * (OCMD.precio_unitario * MM.tipo_cambio) ELSE 0 END) AS ImporteJunio,
										SUM(CASE WHEN MONTH(MM.fecha) = 07 THEN OCMD.cantidad * (OCMD.precio_unitario * MM.tipo_cambio) ELSE 0 END) AS ImporteJulio,
										SUM(CASE WHEN MONTH(MM.fecha) = 08 THEN OCMD.cantidad * (OCMD.precio_unitario * MM.tipo_cambio) ELSE 0 END) AS ImporteAgosto,
										SUM(CASE WHEN MONTH(MM.fecha) = 09 THEN OCMD.cantidad * (OCMD.precio_unitario * MM.tipo_cambio) ELSE 0 END) AS ImporteSeptiembre,
										SUM(CASE WHEN MONTH(MM.fecha) = 10 THEN OCMD.cantidad * (OCMD.precio_unitario * MM.tipo_cambio) ELSE 0 END) AS ImporteOctubre,
										SUM(CASE WHEN MONTH(MM.fecha) = 11 THEN OCMD.cantidad * (OCMD.precio_unitario * MM.tipo_cambio) ELSE 0 END) AS ImporteNoviembre,
										SUM(CASE WHEN MONTH(MM.fecha) = 12 THEN OCMD.cantidad * (OCMD.precio_unitario * MM.tipo_cambio) ELSE 0 END) AS ImporteDiciembre
								FROM movimientos_maquinaria MM
								INNER JOIN ordenes_compra_maquinaria_detalles OCMD ON OCMD.orden_compra_maquinaria_id = MM.referencia_id
								WHERE MM.tipo_movimiento = 1
								AND YEAR(MM.fecha) = '.$intAnio.'
								GROUP BY OCMD.codigo
								ORDER BY OCMD.codigo
								) AS Temp ON MD.codigo = Temp.ID
								LEFT JOIN
								(
								SELECT  OCMD.codigo AS ID,
										SUM(CASE WHEN MONTH(MM1.fecha) = 01 THEN OCMD.cantidad * (OCMD.precio_unitario * MM2.tipo_cambio) ELSE 0 END) AS DevolucionEnero,
										SUM(CASE WHEN MONTH(MM1.fecha) = 02 THEN OCMD.cantidad * (OCMD.precio_unitario * MM2.tipo_cambio) ELSE 0 END) AS DevolucionFebrero,
										SUM(CASE WHEN MONTH(MM1.fecha) = 03 THEN OCMD.cantidad * (OCMD.precio_unitario * MM2.tipo_cambio) ELSE 0 END) AS DevolucionMarzo,
										SUM(CASE WHEN MONTH(MM1.fecha) = 04 THEN OCMD.cantidad * (OCMD.precio_unitario * MM2.tipo_cambio) ELSE 0 END) AS DevolucionAbril,
										SUM(CASE WHEN MONTH(MM1.fecha) = 05 THEN OCMD.cantidad * (OCMD.precio_unitario * MM2.tipo_cambio) ELSE 0 END) AS DevolucionMayo,
										SUM(CASE WHEN MONTH(MM1.fecha) = 06 THEN OCMD.cantidad * (OCMD.precio_unitario * MM2.tipo_cambio) ELSE 0 END) AS DevolucionJunio,
										SUM(CASE WHEN MONTH(MM1.fecha) = 07 THEN OCMD.cantidad * (OCMD.precio_unitario * MM2.tipo_cambio) ELSE 0 END) AS DevolucionJulio,
										SUM(CASE WHEN MONTH(MM1.fecha) = 08 THEN OCMD.cantidad * (OCMD.precio_unitario * MM2.tipo_cambio) ELSE 0 END) AS DevolucionAgosto,
										SUM(CASE WHEN MONTH(MM1.fecha) = 09 THEN OCMD.cantidad * (OCMD.precio_unitario * MM2.tipo_cambio) ELSE 0 END) AS DevolucionSeptiembre,
										SUM(CASE WHEN MONTH(MM1.fecha) = 10 THEN OCMD.cantidad * (OCMD.precio_unitario * MM2.tipo_cambio) ELSE 0 END) AS DevolucionOctubre,
										SUM(CASE WHEN MONTH(MM1.fecha) = 11 THEN OCMD.cantidad * (OCMD.precio_unitario * MM2.tipo_cambio) ELSE 0 END) AS DevolucionNoviembre,
										SUM(CASE WHEN MONTH(MM1.fecha) = 12 THEN OCMD.cantidad * (OCMD.precio_unitario * MM2.tipo_cambio) ELSE 0 END) AS DevolucionDiciembre
								FROM movimientos_maquinaria MM1
								INNER JOIN movimientos_maquinaria MM2 ON MM2.movimiento_maquinaria_id = MM1.referencia_id
								INNER JOIN ordenes_compra_maquinaria_detalles OCMD ON OCMD.orden_compra_maquinaria_id = MM2.referencia_id
								WHERE MM1.tipo_movimiento = 15
								AND YEAR(MM1.fecha) = '.$intAnio.'
								GROUP BY OCMD.codigo
								ORDER BY OCMD.codigo
								) AS Temp2 ON MD.codigo = Temp2.ID
								WHERE MPC.anio = '.$intAnio.'
								GROUP BY MD.codigo
								ORDER BY MD.codigo');
        return $query;

	}

}

?>