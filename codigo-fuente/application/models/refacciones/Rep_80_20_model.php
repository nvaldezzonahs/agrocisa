<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_80_20_model extends CI_model {

	public function ventas_clientes($dteFechaInicial, $dteFechaFinal, $arrSucursales){

		$sucursales = explode('%7C', $arrSucursales);
		//Variable para generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
		$cond_ref = '';

		for ($i = 0; $i<sizeof($sucursales); $i++) {
		    if($i == 0){
		    	$cond_ref .= 'AND ( ';
		    	$cond_ref .= 'FR.sucursal_id = '.$sucursales[$i];
		    }
		    else{
		    	$cond_ref .= ' OR FR.sucursal_id = '.$sucursales[$i];
		    }    
		}
		$cond_ref .= ')';

		$query = $this->db->query("
									SELECT 
										FR.prospecto_id,
									    C.nombre_comercial AS cliente, 
										C.localidad, 
										M.descripcion AS municipio, 
										E.descripcion AS estado,
										COUNT(FR.folio) AS numero_facturas,
										IFNULL(SUM((FRD.precio_unitario * FRD.cantidad) / FR.tipo_cambio), 0) AS subtotal,
										IFNULL(SUM((FRD.iva_unitario * FRD.cantidad) / FR.tipo_cambio), 0) AS iva,
										IFNULL(SUM((FRD.ieps_unitario * FRD.cantidad) / FR.tipo_cambio), 0) AS ieps,
										IFNULL(SUM(((FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) * FRD.cantidad) / FR.tipo_cambio), 0) AS total
									FROM
										facturas_refacciones AS FR
									INNER JOIN facturas_refacciones_detalles AS FRD ON FRD.factura_refacciones_id = FRD.factura_refacciones_id
									INNER JOIN clientes C ON C.prospecto_id = FR.prospecto_id
									INNER JOIN municipios M ON M.municipio_id = C.municipio_id
									INNER JOIN sat_estados E ON E.estado_id = M.estado_id 
									WHERE (FR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
									AND (FR.estatus = 'ACTIVO' OR FR.estatus = 'TIMBRAR')
									$cond_ref
									GROUP BY FR.prospecto_id
									ORDER BY total DESC");
        return $query->result();


	}


	public function ventas_refacciones($dteFechaInicial, $dteFechaFinal, $arrSucursales){

		$sucursales = explode('%7C', $arrSucursales);
		//Variable para generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
		$cond_ref = '';

		for ($i = 0; $i<sizeof($sucursales); $i++) {
		    if($i == 0){
		    	$cond_ref .= 'AND ( ';
		    	$cond_ref .= 'FR.sucursal_id = '.$sucursales[$i];
		    }
		    else{
		    	$cond_ref .= ' OR FR.sucursal_id = '.$sucursales[$i];
		    }    
		}
		$cond_ref .= ')';

		$query = $this->db->query("
									SELECT 
										FRD.refaccion_id,
									    R.descripcion AS refaccion,
										COUNT(FR.folio) AS numero_facturas,
										IFNULL(SUM((FRD.precio_unitario * FRD.cantidad) / FR.tipo_cambio), 0) AS subtotal,
										IFNULL(SUM((FRD.iva_unitario * FRD.cantidad) / FR.tipo_cambio), 0) AS iva,
										IFNULL(SUM((FRD.ieps_unitario * FRD.cantidad) / FR.tipo_cambio), 0) AS ieps,
										IFNULL(SUM(((FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) * FRD.cantidad) / FR.tipo_cambio), 0) AS total
									FROM facturas_refacciones AS FR
									INNER JOIN facturas_refacciones_detalles AS FRD ON FRD.factura_refacciones_id = FRD.factura_refacciones_id
									INNER JOIN refacciones R ON R.refaccion_id = FRD.refaccion_id
									WHERE (FR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal') 
									AND (FR.estatus = 'ACTIVO' OR FR.estatus = 'TIMBRAR')
									$cond_ref
									GROUP BY FRD.refaccion_id
									ORDER BY total DESC
								");

        return $query->result();


	}

	public function ventas_clientes_mensual($dteFechaInicial, $dteFechaFinal, $arrSucursales){

		$sucursales = explode('%7C', $arrSucursales);
		//Variable para generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
		$cond_ref = '';

		for ($i = 0; $i<sizeof($sucursales); $i++) {
		    if($i == 0){
		    	$cond_ref .= 'AND ( ';
		    	$cond_ref .= 'FR.sucursal_id = '.$sucursales[$i];
		    }
		    else{
		    	$cond_ref .= ' OR FR.sucursal_id = '.$sucursales[$i];
		    }
		}
		$cond_ref .= ')';

		$query = $this->db->query("
									 SELECT 
									    Temp.prospecto_id,
									    C.nombre_comercial AS cliente,
									    C.localidad,
									    M.descripcion AS municipio,
									    E.descripcion AS estado,
									    SUM(facturas_enero) AS FacturasEnero,
									    SUM(TotalEnero) AS TotalEnero,
									    SUM(facturas_febrero) AS FacturasFebrero,
									    SUM(TotalFebrero) AS TotalFebrero,
									    SUM(facturas_marzo) AS FacturasMarzo,
									    SUM(TotalMarzo) AS TotalMarzo,
									    SUM(facturas_abril) AS FacturasAbril,
									    SUM(TotalAbril) AS TotalAbril,
									    SUM(facturas_mayo) AS FacturasMayo,
									    SUM(TotalMayo) AS TotalMayo,
									    SUM(facturas_junio) AS FacturasJunio,
									    SUM(TotalJunio) AS TotalJunio,
									    SUM(facturas_julio) AS FacturasJulio,
									    SUM(TotalJulio) AS TotalJulio,
									    SUM(facturas_agosto) AS FacturasAgosto,
									    SUM(TotalAgosto) AS TotalAgosto,
									    SUM(facturas_septiembre) AS FacturasSeptiembre,
									    SUM(TotalSeptiembre) AS TotalSeptiembre,
									    SUM(facturas_octubre) AS FacturasOctubre,
									    SUM(TotalOctubre) AS TotalOctubre,
									    SUM(facturas_noviembre) AS FacturasNoviembre,
									    SUM(TotalNoviembre) AS TotalNoviembre,
									    SUM(facturas_diciembre) AS FacturasDiciembre,
									    SUM(TotalDiciembre) AS TotalDiciembre,
									    SUM(numero_facturas) AS FacturasAnuales,
									    SUM(total) AS TotalAnual
									FROM
									    (
									    
										SELECT 
									        FR.prospecto_id,
									        COUNT(FR.folio) AS numero_facturas,
									        IFNULL(SUM(((FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) * FRD.cantidad) / FR.tipo_cambio), 0) AS total,
									        SUM(CASE WHEN MONTH(FR.fecha) = 1 THEN 1 ELSE 0 END) AS facturas_enero,
											SUM(CASE WHEN MONTH(FR.fecha) = 2 THEN 1 ELSE 0 END) AS facturas_febrero,
											SUM(CASE WHEN MONTH(FR.fecha) = 3 THEN 1 ELSE 0 END) AS facturas_marzo,
											SUM(CASE WHEN MONTH(FR.fecha) = 4 THEN 1 ELSE 0 END) AS facturas_abril,
											SUM(CASE WHEN MONTH(FR.fecha) = 5 THEN 1 ELSE 0 END) AS facturas_mayo,
											SUM(CASE WHEN MONTH(FR.fecha) = 6 THEN 1 ELSE 0 END) AS facturas_junio,
											SUM(CASE WHEN MONTH(FR.fecha) = 7 THEN 1 ELSE 0 END) AS facturas_julio,
											SUM(CASE WHEN MONTH(FR.fecha) = 8 THEN 1 ELSE 0 END) AS facturas_agosto,
											SUM(CASE WHEN MONTH(FR.fecha) = 9 THEN 1 ELSE 0 END) AS facturas_septiembre,
											SUM(CASE WHEN MONTH(FR.fecha) = 10 THEN 1 ELSE 0 END) AS facturas_octubre,
											SUM(CASE WHEN MONTH(FR.fecha) = 11 THEN 1 ELSE 0 END) AS facturas_noviembre,
											SUM(CASE WHEN MONTH(FR.fecha) = 12 THEN 1 ELSE 0 END) AS facturas_diciembre,
									        SUM(CASE WHEN MONTH(FR.fecha) = 1 THEN IFNULL(((FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) * FRD.cantidad) / FR.tipo_cambio, 0) ELSE 0 END) AS TotalEnero,
									        SUM(CASE WHEN MONTH(FR.fecha) = 2 THEN IFNULL(((FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) * FRD.cantidad) / FR.tipo_cambio, 0) ELSE 0 END) AS TotalFebrero,
									        SUM(CASE WHEN MONTH(FR.fecha) = 3 THEN IFNULL(((FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) * FRD.cantidad) / FR.tipo_cambio, 0) ELSE 0 END) AS TotalMarzo,
									        SUM(CASE WHEN MONTH(FR.fecha) = 4 THEN IFNULL(((FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) * FRD.cantidad) / FR.tipo_cambio, 0) ELSE 0 END) AS TotalAbril,
											SUM(CASE WHEN MONTH(FR.fecha) = 5 THEN IFNULL(((FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) * FRD.cantidad) / FR.tipo_cambio, 0) ELSE 0 END) AS TotalMayo,
											SUM(CASE WHEN MONTH(FR.fecha) = 6 THEN IFNULL(((FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) * FRD.cantidad) / FR.tipo_cambio, 0) ELSE 0 END) AS TotalJunio,
											SUM(CASE WHEN MONTH(FR.fecha) = 7 THEN IFNULL(((FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) * FRD.cantidad) / FR.tipo_cambio, 0) ELSE 0 END) AS TotalJulio,
											SUM(CASE WHEN MONTH(FR.fecha) = 8 THEN IFNULL(((FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) * FRD.cantidad) / FR.tipo_cambio, 0) ELSE 0 END) AS TotalAgosto,
									        SUM(CASE WHEN MONTH(FR.fecha) = 9 THEN IFNULL(((FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) * FRD.cantidad) / FR.tipo_cambio, 0) ELSE 0 END) AS TotalSeptiembre,
									        SUM(CASE WHEN MONTH(FR.fecha) = 10 THEN IFNULL(((FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) * FRD.cantidad) / FR.tipo_cambio, 0) ELSE 0 END) AS TotalOctubre,
									        SUM(CASE WHEN MONTH(FR.fecha) = 11 THEN IFNULL(((FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) * FRD.cantidad) / FR.tipo_cambio, 0) ELSE 0 END) AS TotalNoviembre,
									        SUM(CASE WHEN MONTH(FR.fecha) = 12 THEN IFNULL(((FRD.precio_unitario + FRD.iva_unitario + FRD.ieps_unitario) * FRD.cantidad) / FR.tipo_cambio, 0) ELSE 0 END) AS TotalDiciembre
									    FROM
									        facturas_refacciones AS FR
									    INNER JOIN facturas_refacciones_detalles AS FRD ON FRD.factura_refacciones_id = FRD.factura_refacciones_id
									    WHERE(FR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
									    AND (FR.estatus = 'ACTIVO' OR FR.estatus = 'TIMBRAR')
									    $cond_ref
									    GROUP BY FR.prospecto_id 
										
									    ) AS Temp
									INNER JOIN clientes C ON C.prospecto_id = Temp.prospecto_id
									INNER JOIN municipios M ON M.municipio_id = C.municipio_id
									INNER JOIN sat_estados E ON E.estado_id = M.estado_id
									GROUP BY Temp.prospecto_id
									ORDER BY TotalAnual DESC
								");

        return $query->result();


	}


}
?>