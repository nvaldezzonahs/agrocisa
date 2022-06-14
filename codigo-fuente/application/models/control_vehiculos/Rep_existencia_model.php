<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_existencia_model extends CI_model {

	public function consultar($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intRefaccionID = NULL){

		$strSucursalID = "";

		$strRangoFechas1 = "";
		$strSucursalID1 = "";

		$strMarcaID = "";
		$strLineaID = "";
		$strRefaccionID = "";

		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	    	$strRangoFechas1 = " AND MR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'";
	    }
		if($intSucursalID != 0){
			$strSucursalID = " AND RI.sucursal_id = '$intSucursalID'";
			$strSucursalID1 = " AND MR.sucursal_id = '$intSucursalID'";
		}
		if($intRefaccionID != 0){
			$strRefaccionID = " AND R.refaccion_interna_id = '$intRefaccionID'";
		}
			
		$strFecha = explode("-", $dteFechaInicial);
		$strAnio = $strFecha[0];

		$query = $this->db->query("
									SELECT 	RI.sucursal_id,
									        S.nombre AS sucursal, 
									        R.refaccion_interna_id, 
									        R.descripcion, 
									        RI.inicial_existencia, 
									        RI.inicial_costo, 
									        IFNULL(Temp.tipo_movimiento, 0) AS tipo_movimiento, 
									        IFNULL(Temp.fecha, '') AS fecha, 
									        IFNULL(Temp.folio, 0) AS folio, 
									        IFNULL(Temp.cantidad, 0) AS cantidad, 
									        IFNULL(Temp.precio_unitario, 0) AS precio_unitario
									FROM ( 
									        refacciones_internas AS R INNER JOIN refacciones_internas_inventario AS RI ON R.refaccion_interna_id = RI.refaccion_interna_id 
									        AND RI.anio = $strAnio
									        $strSucursalID
									        $strRefaccionID 
									     ) 
									LEFT JOIN ( 
									            SELECT  MR.sucursal_id, 
									                    MRD.refaccion_interna_id, 
									                    MR.tipo_movimiento, 
									                    DATE_FORMAT(MR.fecha, '%d/%m/%Y') AS fecha, 
									                    DATE_FORMAT(MR.fecha_creacion, '%d/%m/%Y') AS fecha_creacion, 
									                    MR.folio, 
									                    MRD.cantidad, 
									                    MRD.precio_unitario 
									            FROM movimientos_refacciones_internas MR 
									            INNER JOIN movimientos_refacciones_internas_detalles MRD ON MR.movimiento_refacciones_internas_id = MRD.movimiento_refacciones_internas_id 
									            AND MR.estatus <> 'INACTIVO'
									            $strRangoFechas1
									            $strSucursalID1 
									        ) AS Temp ON R.refaccion_interna_id = Temp.refaccion_interna_id AND RI.sucursal_id = Temp.sucursal_id 
									INNER JOIN sucursales S ON S.sucursal_id = RI.sucursal_id        
									ORDER BY RI.sucursal_id ASC, R.refaccion_interna_id ASC, Temp.fecha ASC, Temp.fecha_creacion ASC; 
								");
        return $query;


	}

}
?>