<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_movimientos_refacciones_internas_model extends CI_model {

	/*Método para regresar la existencia inicial que coincida con los criterios de búsqueda proporcionados*/
	public function buscar_existencia_inicial($dteFechaInicial, $intSucursalID, $intRefaccionID)
	{
		//Constante para identificar al tipo de movimiento en el que empiezan las salidas de refacciones
		$intMovSalidaInicial = SALIDA_REFACCIONES_INTERNAS;

		//Separar fecha para obtener el año
		$strFecha = explode("-", $dteFechaInicial);
		$strAnio = $strFecha[0];

		//Asignar fecha inicial del inventario
		$dteFechaInicialInv = $strAnio.'-01-01';

		$strSQL = $this->db->query("SELECT 
										  (RII.inicial_existencia + IFNULL(EntIni.Cantidad, 0) - IFNULL(SalIni.Cantidad, 0)) AS Cantidad,
										  ((RII.inicial_existencia * RII.inicial_costo) + IFNULL(EntIni.Importe, 0) - 
										  	IFNULL(SalIni.Importe, 0)) AS Importe, 
										  RII.localizacion

									FROM (refacciones_internas_inventario AS RII 
									LEFT JOIN (SELECT MRID.refaccion_id, SUM(MRID.cantidad) AS Cantidad,
											   		  SUM(MRID.costo_unitario * MRID.cantidad) AS Importe 
											   FROM movimientos_refacciones_internas AS MRI 
											   INNER JOIN movimientos_refacciones_internas_detalles AS MRID ON MRI.movimiento_refacciones_internas_id = MRID.movimiento_refacciones_internas_id
											   WHERE MRI.fecha < '$dteFechaInicial'
											   AND  MRI.fecha >= '$dteFechaInicialInv'
											   AND  MRI.tipo_movimiento < $intMovSalidaInicial
											   AND MRI.sucursal_id = $intSucursalID
											   AND MRI.estatus <> 'INACTIVO'
											   GROUP BY MRID.refaccion_id) AS EntIni ON  RII.refaccion_id = EntIni.refaccion_id)
									LEFT JOIN (SELECT MRID.refaccion_id, SUM(MRID.cantidad) AS Cantidad,
													  SUM(MRID.costo_unitario * MRID.cantidad) AS Importe
											   FROM movimientos_refacciones_internas AS MRI 
											   INNER JOIN movimientos_refacciones_internas_detalles AS MRID ON MRI.movimiento_refacciones_internas_id = MRID.movimiento_refacciones_internas_id
											   WHERE MRI.fecha < '$dteFechaInicial'
											   AND MRI.fecha >= '$dteFechaInicialInv'
											   AND  MRI.tipo_movimiento >= $intMovSalidaInicial
											   AND MRI.sucursal_id = $intSucursalID
											   AND MRI.estatus <> 'INACTIVO'
											   GROUP BY MRID.refaccion_id) AS SalIni ON RII.refaccion_id = SalIni.refaccion_id
									WHERE  RII.sucursal_id = $intSucursalID
									AND    RII.anio = '$strAnio'
									AND    RII.refaccion_id = $intRefaccionID");
		return $strSQL->result();
	}

	/*Método para regresar los movimientos que coincidan con los criterios de búsqueda proporcionados*/
	public function buscar_movimientos($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intRefaccionID)
	{

		$strSQL = $this->db->query("SELECT MRI.movimiento_refacciones_internas_id, MRI.tipo_movimiento,
										   MRI.folio, MRI.fecha,  MRI.fecha_creacion,  
										   MRI.fecha_actualizacion,
										   DATE_FORMAT(MRI.fecha,'%d/%m/%Y') AS fecha_format,
										   MRI.estatus, MRID.cantidad, MRID.costo_unitario
									FROM movimientos_refacciones_internas AS MRI 
									INNER JOIN movimientos_refacciones_internas_detalles AS MRID ON MRI.movimiento_refacciones_internas_id = MRID.movimiento_refacciones_internas_id
									WHERE MRID.refaccion_id = $intRefaccionID
									AND  MRI.sucursal_id = $intSucursalID
									AND  MRI.fecha >= '$dteFechaInicial'
									AND  MRI.fecha <= '$dteFechaFinal'
									ORDER BY fecha, fecha_creacion, fecha_actualizacion");
		return $strSQL->result();

	}

}
?>