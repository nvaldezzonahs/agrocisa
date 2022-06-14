<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_movimientos_refacciones_model extends CI_model {

	/*Método para regresar la existencia inicial que coincida con los criterios de búsqueda proporcionados*/
	public function buscar_existencia_inicial($dteFechaInicial, $intSucursalID, $intRefaccionID)
	{
		//Constante para identificar al tipo de movimiento en el que empiezan las salidas de refacciones
		$intMovSalidaInicial = SALIDA_REFACCIONES_TALLER;

		//Separar fecha para obtener el año
		$strFecha = explode("-", $dteFechaInicial);
		$strAnio = $strFecha[0];

		//Asignar fecha inicial del inventario
		$dteFechaInicialInv = $strAnio.'-01-01';

		$strSQL = $this->db->query("SELECT 
										  (RI.inicial_existencia + IFNULL(EntIni.Cantidad, 0) - IFNULL(SalIni.Cantidad, 0) - IFNULL(FacIni.Cantidad, 0)) AS Cantidad,
										  ((RI.inicial_existencia * RI.inicial_costo) + IFNULL(EntIni.Importe, 0) - 
										  	IFNULL(SalIni.Importe, 0) - IFNULL(FacIni.Importe, 0)) AS Importe, 
										  RI.localizacion

									FROM ((refacciones_inventario AS RI 
									LEFT JOIN (SELECT MRD.refaccion_id, SUM(MRD.cantidad) AS Cantidad,
											   		  SUM(MRD.costo_unitario * MRD.cantidad) AS Importe 
											   FROM movimientos_refacciones AS MR 
											   INNER JOIN movimientos_refacciones_detalles AS MRD ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
											   WHERE DATE_FORMAT(MR.fecha, '%Y-%m-%d') < '$dteFechaInicial'
											   AND DATE_FORMAT(MR.fecha, '%Y-%m-%d') >= '$dteFechaInicialInv'
											   AND  MR.tipo_movimiento < $intMovSalidaInicial
											   AND MR.sucursal_id = $intSucursalID
											   AND MR.estatus <> 'INACTIVO'
											   GROUP BY MRD.refaccion_id) AS EntIni ON  RI.refaccion_id = EntIni.refaccion_id)
									LEFT JOIN (SELECT MRD.refaccion_id, SUM(MRD.cantidad) AS Cantidad,
													  SUM(MRD.costo_unitario * MRD.cantidad) AS Importe
											   FROM movimientos_refacciones AS MR 
											   INNER JOIN movimientos_refacciones_detalles AS MRD ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
											   WHERE DATE_FORMAT(MR.fecha, '%Y-%m-%d') < '$dteFechaInicial'
											   AND DATE_FORMAT(MR.fecha, '%Y-%m-%d') >= '$dteFechaInicialInv'
											   AND  MR.tipo_movimiento >= $intMovSalidaInicial
											   AND MR.sucursal_id = $intSucursalID
											   AND MR.estatus <> 'INACTIVO'
											   GROUP BY MRD.refaccion_id) AS SalIni ON RI.refaccion_id = SalIni.refaccion_id)
									LEFT JOIN (SELECT FRD.refaccion_id, SUM(FRD.cantidad) AS Cantidad,
													  SUM(FRD.costo_unitario * FRD.cantidad) AS Importe
											   FROM facturas_refacciones AS FR
											   INNER JOIN facturas_refacciones_detalles AS FRD ON FR.factura_refacciones_id = FRD.factura_refacciones_id
											   WHERE DATE_FORMAT(FR.fecha, '%Y-%m-%d') < '$dteFechaInicial'
											   AND DATE_FORMAT(FR.fecha, '%Y-%m-%d') >= '$dteFechaInicialInv'
											   AND FR.sucursal_id = $intSucursalID
											   AND FR.estatus <> 'INACTIVO'
											   GROUP BY FRD.refaccion_id) AS FacIni ON RI.refaccion_id = FacIni.refaccion_id
									WHERE  RI.sucursal_id = $intSucursalID
									AND    RI.anio = '$strAnio'
									AND    RI.refaccion_id = $intRefaccionID");
		return $strSQL->result();
	}

	/*Método para regresar los movimientos que coincidan con los criterios de búsqueda proporcionados*/
	public function buscar_movimientos($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intRefaccionID)
	{
		//Constante para identificar al tipo de movimiento salida de refacciones por venta (factura)
		$intMovSalidaVenta = SALIDA_REFACCIONES_VENTA;

		$strSQL = $this->db->query("SELECT MR.movimiento_refacciones_id, MR.tipo_movimiento,
										   MR.folio, MR.fecha,  MR.fecha_creacion,  MR.fecha_actualizacion,
										   DATE_FORMAT(MR.fecha,'%d/%m/%Y') AS fecha_format,
										   MR.estatus,  
										   SUM(MRD.cantidad) AS cantidad,
     									   MRD.costo_unitario
									FROM movimientos_refacciones AS MR 
									INNER JOIN movimientos_refacciones_detalles AS MRD ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
									WHERE MRD.refaccion_id = $intRefaccionID
									AND  MR.sucursal_id = $intSucursalID
									AND  DATE_FORMAT(MR.fecha, '%Y-%m-%d') >= '$dteFechaInicial'
									AND  DATE_FORMAT(MR.fecha, '%Y-%m-%d') <= '$dteFechaFinal'
									GROUP BY MR.movimiento_refacciones_id
									UNION 
									SELECT FR.factura_refacciones_id, $intMovSalidaVenta AS tipo_movimiento,
										   FR.folio, FR.fecha,  FR.fecha_creacion,  FR.fecha_actualizacion,
										   DATE_FORMAT(FR.fecha,'%d/%m/%Y') AS fecha_format,
										   FR.estatus,  
										   SUM(FRD.cantidad) AS cantidad,
    									   FRD.costo_unitario
									FROM facturas_refacciones AS FR 
									INNER JOIN facturas_refacciones_detalles AS FRD ON FR.factura_refacciones_id = FRD.factura_refacciones_id
									WHERE FRD.refaccion_id = $intRefaccionID
									AND  FR.sucursal_id = $intSucursalID
									AND  DATE_FORMAT(FR.fecha, '%Y-%m-%d') >= '$dteFechaInicial'
									AND  DATE_FORMAT(FR.fecha, '%Y-%m-%d') <= '$dteFechaFinal'
									GROUP BY FR.factura_refacciones_id 
									ORDER BY fecha, fecha_creacion, fecha_actualizacion");
		return $strSQL->result();

	}

}
?>