<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_existencia_model extends CI_model {

	public function consultar($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intMarcaID = NULL, $intLineaID = NULL, $intRefaccionID = NULL){

		$strSucursalID = "";

		$strRangoFechas1 = "";
		$strSucursalID1 = "";
		$strRangoFechas2 = "";
		$strSucursalID2 = "";

		$strMarcaID = "";
		$strLineaID = "";
		$strRefaccionID = "";

		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	    	$strRangoFechas1 = " AND MR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'";
	    	$strRangoFechas2 = " AND FR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'";
	    }
		if($intSucursalID != 0){
			$strSucursalID = " AND RI.sucursal_id = '$intSucursalID'";
			$strSucursalID1 = " AND MR.sucursal_id = '$intSucursalID'";
			$strSucursalID2 = " AND FR.sucursal_id = '$intSucursalID'";
		}
		if($intMarcaID != 0){
			$strMarcaID = " AND R.refacciones_marca_id = '$intMarcaID'";
		}
		if($intLineaID != 0){
			$strLineaID = " AND R.refacciones_linea_id = '$intLineaID'";
		}
		if($intRefaccionID != 0){
			$strRefaccionID = " AND R.refaccion_id = '$intRefaccionID'";
		}
			
		$strFecha = explode("-", $dteFechaInicial);
		$strAnio = $strFecha[0];

		$query = $this->db->query("
									SELECT 	RI.sucursal_id,
									        S.nombre AS sucursal, 
									        R.refaccion_id, 
									        R.descripcion, 
									        RI.inicial_existencia, 
									        RI.inicial_costo, 
									        IFNULL(Temp.tipo_movimiento, 0) AS tipo_movimiento, 
									        IFNULL(Temp.fecha, '') AS fecha, 
									        IFNULL(Temp.folio, 0) AS folio, 
									        IFNULL(Temp.cantidad, 0) AS cantidad, 
									        IFNULL(Temp.precio_unitario, 0) AS precio_unitario
									FROM ( 
									        refacciones AS R INNER JOIN refacciones_inventario AS RI ON R.refaccion_id = RI.refaccion_id 
									        AND RI.anio = $strAnio
									        $strSucursalID
									        $strMarcaID
									        $strLineaID
									        $strRefaccionID 
									     ) 
									LEFT JOIN ( 
									            SELECT  MR.sucursal_id, 
									                    MRD.refaccion_id, 
									                    MR.tipo_movimiento, 
									                    DATE_FORMAT(MR.fecha, '%d/%m/%Y') AS fecha, 
									                    DATE_FORMAT(MR.fecha_creacion, '%d/%m/%Y') AS fecha_creacion, 
									                    MR.folio, 
									                    MRD.cantidad, 
									                    MRD.precio_unitario 
									            FROM movimientos_refacciones MR 
									            INNER JOIN movimientos_refacciones_detalles MRD ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id 
									            AND MR.estatus <> 'INACTIVO'
									            $strRangoFechas1
									            $strSucursalID1 
									            UNION 
									            SELECT  FR.sucursal_id, 
									                    FRD.refaccion_id, '11' AS tipo_movimiento, 
									                    DATE_FORMAT(FR.fecha, '%d/%m/%Y') AS fecha, 
									                    DATE_FORMAT(FR.fecha_creacion, '%d/%m/%Y') AS fecha_creacion, 
									                    FR.folio, 
									                    FRD.cantidad, 
									                    FRD.precio_unitario 
									            FROM facturas_refacciones FR 
									            INNER JOIN facturas_refacciones_detalles FRD ON FR.factura_refacciones_id = FRD.factura_refacciones_id 
									            AND FR.estatus <> 'INACTIVO' 
									            $strRangoFechas2
									            $strSucursalID2 
									        ) AS Temp ON R.refaccion_id = Temp.refaccion_id AND RI.sucursal_id = Temp.sucursal_id 
									INNER JOIN sucursales S ON S.sucursal_id = RI.sucursal_id        
									ORDER BY RI.sucursal_id ASC, R.refaccion_id ASC, Temp.fecha ASC, Temp.fecha_creacion ASC; 
								");
        return $query;


	}

}
?>