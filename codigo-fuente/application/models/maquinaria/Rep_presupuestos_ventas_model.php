<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_presupuestos_ventas_model extends CI_model {

	public function buscar_presupuestos_ventas($intAnio)
	{
		
        $query = $this->db->query('SELECT
											IFNULL( CONCAT_WS(" ", E.apellido_paterno, E.apellido_materno, E.nombre), " " ) AS vendedor,
											MPV.vendedor_id,
											MD.codigo,
											MD.descripcion_corta,
											SUM(CASE WHEN MPV.mes = 01 THEN MPV.cantidad ELSE 0 END) AS PresupuestoEnero,
									        IFNULL(Temp.CantidadEnero - Temp2.DevolucionEnero, 0) AS RealEnero,
											SUM(CASE WHEN MPV.mes = 02 THEN MPV.cantidad ELSE 0 END) AS PresupuestoFebrero,
									        IFNULL(Temp.CantidadFebrero - Temp2.DevolucionFebrero, 0) AS RealFebrero,
									        SUM(CASE WHEN MPV.mes = 03 THEN MPV.cantidad ELSE 0 END) AS PresupuestoMarzo,
									        IFNULL(Temp.CantidadMarzo - Temp2.DevolucionMarzo, 0) AS RealMarzo,
									        SUM(CASE WHEN MPV.mes = 04 THEN MPV.cantidad ELSE 0 END) AS PresupuestoAbril,
									        IFNULL(Temp.CantidadAbril - Temp2.DevolucionAbril, 0) AS RealAbril,
									        SUM(CASE WHEN MPV.mes = 05 THEN MPV.cantidad ELSE 0 END) AS PresupuestoMayo,
									        IFNULL(Temp.CantidadMayo - Temp2.DevolucionMayo, 0) AS RealMayo,
									        SUM(CASE WHEN MPV.mes = 06 THEN MPV.cantidad ELSE 0 END) AS PresupuestoJunio,
									        IFNULL(Temp.CantidadJunio - Temp2.DevolucionJunio, 0) AS RealJunio,
									        SUM(CASE WHEN MPV.mes = 07 THEN MPV.cantidad ELSE 0 END) AS PresupuestoJulio,
									        IFNULL(Temp.CantidadJulio - Temp2.DevolucionJulio, 0) AS RealJulio,
									        SUM(CASE WHEN MPV.mes = 08 THEN MPV.cantidad ELSE 0 END) AS PresupuestoAgosto,
									        IFNULL(Temp.CantidadAgosto - Temp2.DevolucionAgosto, 0) AS RealAgosto,
									        SUM(CASE WHEN MPV.mes = 09 THEN MPV.cantidad ELSE 0 END) AS PresupuestoSeptiembre,
									        IFNULL(Temp.CantidadSeptiembre - Temp2.DevolucionSeptiembre, 0) AS RealSeptiembre,
									        SUM(CASE WHEN MPV.mes = 10 THEN MPV.cantidad ELSE 0 END) AS PresupuestoOctubre,
									        IFNULL(Temp.CantidadOctubre - Temp2.DevolucionOctubre, 0) AS RealOctubre,
									        SUM(CASE WHEN MPV.mes = 11 THEN MPV.cantidad ELSE 0 END) AS PresupuestoNoviembre,
									        IFNULL(Temp.CantidadNoviembre - Temp2.DevolucionNoviembre, 0) AS RealNoviembre,
									        SUM(CASE WHEN MPV.mes = 12 THEN MPV.cantidad ELSE 0 END) AS PresupuestoDiciembre,
									        IFNULL(Temp.CantidadDiciembre - Temp2.DevolucionDiciembre, 0) AS RealDiciembre
									FROM (
											maquinaria_presupuestos_ventas MPV
											INNER JOIN maquinaria_descripciones MD ON MD.maquinaria_descripcion_id = MPV.maquinaria_descripcion_id
									        INNER JOIN vendedores V ON V.vendedor_id = MPV.vendedor_id
									        INNER JOIN empleados E ON E.empleado_id = V.vendedor_id
										 )
									LEFT JOIN
										(
											SELECT  FM.maquinaria_descripcion_id AS ID,
													FM.vendedor_id As VendedorID,
													SUM(CASE WHEN MONTH(MM.fecha) = 01 THEN 1 ELSE 0 END) AS CantidadEnero,
													SUM(CASE WHEN MONTH(MM.fecha) = 02 THEN 1 ELSE 0 END) AS CantidadFebrero,
													SUM(CASE WHEN MONTH(MM.fecha) = 03 THEN 1 ELSE 0 END) AS CantidadMarzo,
													SUM(CASE WHEN MONTH(MM.fecha) = 04 THEN 1 ELSE 0 END) AS CantidadAbril,
													SUM(CASE WHEN MONTH(MM.fecha) = 05 THEN 1 ELSE 0 END) AS CantidadMayo,
													SUM(CASE WHEN MONTH(MM.fecha) = 06 THEN 1 ELSE 0 END) AS CantidadJunio,
													SUM(CASE WHEN MONTH(MM.fecha) = 07 THEN 1 ELSE 0 END) AS CantidadJulio,
													SUM(CASE WHEN MONTH(MM.fecha) = 08 THEN 1 ELSE 0 END) AS CantidadAgosto,
													SUM(CASE WHEN MONTH(MM.fecha) = 09 THEN 1 ELSE 0 END) AS CantidadSeptiembre,
													SUM(CASE WHEN MONTH(MM.fecha) = 10 THEN 1 ELSE 0 END) AS CantidadOctubre,
													SUM(CASE WHEN MONTH(MM.fecha) = 11 THEN 1 ELSE 0 END) AS CantidadNoviembre,
													SUM(CASE WHEN MONTH(MM.fecha) = 12 THEN 1 ELSE 0 END) AS CantidadDiciembre
											FROM movimientos_maquinaria MM
											INNER JOIN facturas_maquinaria FM ON FM.factura_maquinaria_id = MM.referencia_id
											WHERE MM.tipo_movimiento = 11
											AND YEAR(MM.fecha) = '.$intAnio.'
											GROUP BY FM.vendedor_id, FM.maquinaria_descripcion_id
											ORDER BY FM.vendedor_id, FM.maquinaria_descripcion_id
										) AS Temp ON MD.maquinaria_descripcion_id = Temp.ID AND MPV.vendedor_id = Temp.VendedorID
									LEFT JOIN
										(
											SELECT  FM.maquinaria_descripcion_id AS ID,
													FM.vendedor_id AS VendedorID,
													SUM(CASE WHEN MONTH(MM.fecha) = 01 THEN 1 ELSE 0 END) AS DevolucionEnero,
													SUM(CASE WHEN MONTH(MM.fecha) = 02 THEN 1 ELSE 0 END) AS DevolucionFebrero,
													SUM(CASE WHEN MONTH(MM.fecha) = 03 THEN 1 ELSE 0 END) AS DevolucionMarzo,
													SUM(CASE WHEN MONTH(MM.fecha) = 04 THEN 1 ELSE 0 END) AS DevolucionAbril,
													SUM(CASE WHEN MONTH(MM.fecha) = 05 THEN 1 ELSE 0 END) AS DevolucionMayo,                                                                                                                                                                                                
													SUM(CASE WHEN MONTH(MM.fecha) = 06 THEN 1 ELSE 0 END) AS DevolucionJunio,
													SUM(CASE WHEN MONTH(MM.fecha) = 07 THEN 1 ELSE 0 END) AS DevolucionJulio,
													SUM(CASE WHEN MONTH(MM.fecha) = 08 THEN 1 ELSE 0 END) AS DevolucionAgosto,
													SUM(CASE WHEN MONTH(MM.fecha) = 09 THEN 1 ELSE 0 END) AS DevolucionSeptiembre,
													SUM(CASE WHEN MONTH(MM.fecha) = 10 THEN 1 ELSE 0 END) AS DevolucionOctubre,
													SUM(CASE WHEN MONTH(MM.fecha) = 11 THEN 1 ELSE 0 END) AS DevolucionNoviembre,
													SUM(CASE WHEN MONTH(MM.fecha) = 12 THEN 1 ELSE 0 END) AS DevolucionDiciembre
											FROM movimientos_maquinaria MM
											INNER JOIN facturas_maquinaria FM ON FM.factura_maquinaria_id = MM.referencia_id
											WHERE MM.tipo_movimiento = 2
											AND YEAR(MM.fecha) = '.$intAnio.'
											GROUP BY FM.vendedor_id, FM.maquinaria_descripcion_id
											ORDER BY FM.vendedor_id, FM.maquinaria_descripcion_id
										) AS Temp2 ON MD.maquinaria_descripcion_id = Temp2.ID AND MPV.vendedor_id = Temp2.VendedorID
									WHERE MPV.anio = '.$intAnio.'
									GROUP BY MPV.vendedor_id, MPV.maquinaria_descripcion_id
									ORDER BY MPV.vendedor_id, MPV.maquinaria_descripcion_id');
        return $query;

	}

}

?>