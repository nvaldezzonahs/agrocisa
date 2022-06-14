<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_presupuestos_gastos_model extends CI_model {

	public function buscar_presupuestos_gastos_inventarios_fisicos($intSucursalID ,$intDepartamentoID ,$intAnio)
	{
		
		if ($intSucursalID) {
			$strSucrsal = "AND DPG.sucursal_id =".$intSucursalID."";
		}else{
				$strSucrsal = '';		
		}
		if ($intDepartamentoID) {
			$strDepartamento = "AND DPG.sucursal_id =".$intDepartamentoID."";
		}else{
			$strDepartamento = '';
		}
		$query = $this->db->query("
			SELECT 			
					DPG.sucursal_id,
 					DPG.departamento_id,
 					D.descripcion AS departamentos,
					S.nombre AS sucursal,
					IFNULL(SUM(CASE WHEN DPG.mes = 01 THEN DPG.importe ELSE 0 END),0) AS PresupuestoEnero,
					IFNULL(SUM(CASE WHEN DPG.mes = 02 THEN DPG.importe ELSE 0 END),0) AS PresupuestoFebrero,
 					IFNULL(SUM(CASE WHEN DPG.mes = 03 THEN DPG.importe ELSE 0 END),0) AS PresupuestoMarzo,
 					IFNULL(SUM(CASE WHEN DPG.mes = 04 THEN DPG.importe ELSE 0 END),0) AS PresupuestoAbril,
 					IFNULL(SUM(CASE WHEN DPG.mes = 05 THEN DPG.importe ELSE 0 END),0) AS PresupuestoMayo,
 					IFNULL(SUM(CASE WHEN DPG.mes = 06 THEN DPG.importe ELSE 0 END),0) AS PresupuestoJunio,
					IFNULL(SUM(CASE WHEN DPG.mes = 07 THEN DPG.importe ELSE 0 END),0) AS PresupuestoJulio,
					IFNULL(SUM(CASE WHEN DPG.mes = 08 THEN DPG.importe ELSE 0 END),0) AS PresupuestoAgosto,
 					IFNULL(SUM(CASE WHEN DPG.mes = 09 THEN DPG.importe ELSE 0 END),0) AS PresupuestoSeptiembre,
 					IFNULL(SUM(CASE WHEN DPG.mes = 10 THEN DPG.importe ELSE 0 END),0) AS PresupuestoOctubre,
 					IFNULL(SUM(CASE WHEN DPG.mes = 11 THEN DPG.importe ELSE 0 END),0) AS PresupuestoNoviembre,	
 					IFNULL(SUM(CASE WHEN DPG.mes = 12 THEN DPG.importe ELSE 0 END),0) AS PresupuestoDiciembre		        																				
				FROM departamentos_presupuestos_gastos AS DPG 				
				INNER JOIN departamentos  AS D ON DPG.departamento_id = D.departamento_id      	
				INNER JOIN sucursales  AS S ON DPG.sucursal_id = S.sucursal_id					
				WHERE DPG.anio = ".$intAnio."  
				".$strSucrsal." "
				.$strDepartamento."
				GROUP BY  DPG.sucursal_id ,DPG.departamento_id


			"
			
		);

		return $query;
     //    $query = $this->db->query("SELECT 
					// 	OCT.sucursal_id,
					// 	OCT.departamento_id,
					// 		SUM(CASE WHEN MONTH(OCT.fecha) = 01 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS realEnero,
					// 		IFNULL(Temp.PresupuestoEnero, 0) AS PresupuestoEnero,
					// 		SUM(CASE WHEN MONTH(OCT.fecha) = 02 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS realFebrero,
					// 		IFNULL(Temp.PresupuestoFebrero, 0) AS PresupuestoFebrero,
					// 		SUM(CASE WHEN MONTH(OCT.fecha) = 03 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS realMarzo,
					// 		IFNULL(Temp.PresupuestoMarzo, 0) AS PresupuestoMarzo,
					// 		SUM(CASE WHEN MONTH(OCT.fecha) = 04 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS realAbril,
					// 		IFNULL(Temp.PresupuestoAbril, 0) AS PresupuestoAbril,
					// 		SUM(CASE WHEN MONTH(OCT.fecha) = 05 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS realMayo,
					// 		IFNULL(Temp.PresupuestoMayo, 0) AS PresupuestoMayo,
					// 		SUM(CASE WHEN MONTH(OCT.fecha) = 06 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS realJunio,
					// 		IFNULL(Temp.PresupuestoJunio, 0) AS PresupuestoJunio,
					// 		SUM(CASE WHEN MONTH(OCT.fecha) = 07 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS realJulio,
					// 		IFNULL(Temp.PresupuestoJulio, 0) AS PresupuestoJulio,
					// 		SUM(CASE WHEN MONTH(OCT.fecha) = 08 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS realAgosto,
					// 		IFNULL(Temp.PresupuestoAgosto, 0) AS PresupuestoAgosto,
					// 		SUM(CASE WHEN MONTH(OCT.fecha) = 09 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS realSeptiembre,
					// 		IFNULL(Temp.PresupuestoSeptiembre, 0) AS PresupuestoSeptiembre,
					// 		SUM(CASE WHEN MONTH(OCT.fecha) = 10 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS realOctubre,
					// 		IFNULL(Temp.PresupuestoOctubre, 0) AS PresupuestoOctubre,
					// 		SUM(CASE WHEN MONTH(OCT.fecha) = 11 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS realNoviembre,
					// 		IFNULL(Temp.PresupuestoNoviembre, 0) AS PresupuestoNoviembre,
					// 		SUM(CASE WHEN MONTH(OCT.fecha) = 12 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS realDiciembre,							
					//         IFNULL(Temp.PresupuestoDiciembre, 0) AS PresupuestoDiciembre
					// FROM ordenes_compra AS OCT
					// INNER JOIN ordenes_compra_detalles_02 AS OCDT ON OCT.orden_compra_id = OCDT.orden_compra_id
					// LEFT JOIN(
					// 			SELECT  
					// 					DPG.sucursal_id,
					// 					DPG.departamento_id,
					// 					SUM(CASE WHEN DPG.mes = 01 THEN DPG.importe ELSE 0 END) AS PresupuestoEnero,
					// 					SUM(CASE WHEN DPG.mes = 02 THEN DPG.importe ELSE 0 END) AS PresupuestoFebrero,
					// 					SUM(CASE WHEN DPG.mes = 03 THEN DPG.importe ELSE 0 END) AS PresupuestoMarzo,
					// 					SUM(CASE WHEN DPG.mes = 04 THEN DPG.importe ELSE 0 END) AS PresupuestoAbril,
					// 					SUM(CASE WHEN DPG.mes = 05 THEN DPG.importe ELSE 0 END) AS PresupuestoMayo,
					// 					SUM(CASE WHEN DPG.mes = 06 THEN DPG.importe ELSE 0 END) AS PresupuestoJunio,
					// 					SUM(CASE WHEN DPG.mes = 07 THEN DPG.importe ELSE 0 END) AS PresupuestoJulio,
					// 					SUM(CASE WHEN DPG.mes = 08 THEN DPG.importe ELSE 0 END) AS PresupuestoAgosto,
					// 					SUM(CASE WHEN DPG.mes = 09 THEN DPG.importe ELSE 0 END) AS PresupuestoSeptiembre,
					// 					SUM(CASE WHEN DPG.mes = 10 THEN DPG.importe ELSE 0 END) AS PresupuestoOctubre,
					// 					SUM(CASE WHEN DPG.mes = 11 THEN DPG.importe ELSE 0 END) AS PresupuestoNoviembre,	
					// 					SUM(CASE WHEN DPG.mes = 12 THEN DPG.importe ELSE 0 END) AS PresupuestoDiciembre
					// 			FROM departamentos_presupuestos_gastos AS DPG
					// 			INNER JOIN departamentos AS D ON DPG.departamento_id = D.departamento_id
					// 			WHERE DPG.anio = ".$intAnio."
					//             GROUP BY DPG.sucursal_id, DPG.departamento_id
					// 		) AS Temp ON Temp.sucursal_id = OCT.sucursal_id AND Temp.departamento_id = OCT.departamento_id
					// INNER JOIN departamentos  AS D ON OCT.departamento_id = D.departamento_id        	
					// INNER JOIN sucursales  AS S ON OCT.sucursal_id = S.sucursal_id
					// WHERE YEAR(OCT.fecha) = ".$intAnio."
					// AND OCT.sucursal_id = ".$intSucursalID."
					// AND OCT.departamento_id = ".$intDepartamentoID."
					// AND OCT.estatus IN ('AUTORIZADO', 'PARCIAL', 'SURTIDO')
					// GROUP BY OCT.sucursal_id, OCT.departamento_id;
     //    	");
     //    return $query;

	}

	public function buscar_reales_presupuestos_gastos_inventarios_fisicos($intSucursalID,$intDepartamentoID,$intAnio){
			
			
			if ($intSucursalID) {
				$strSucrsal = "AND OCT.sucursal_id =".$intSucursalID."";
			}else{
				$strSucrsal = '';	
			}
			if ($intDepartamentoID) {
				$strDepartamento = "AND OCT.departamento_id =".$intDepartamentoID."";
			}else{
				$strDepartamento = '';	
			}
			$query = $this->db->query("
					SELECT 
									OCT.sucursal_id,
									OCT.departamento_id,
									D.descripcion AS departamentos,
									S.nombre AS sucursal,
									SUM(CASE WHEN MONTH(OCT.fecha) = 01 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS RealEnero,
									SUM(CASE WHEN MONTH(OCT.fecha) = 02 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS RealFebrero,
									SUM(CASE WHEN MONTH(OCT.fecha) = 03 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS RealMarzo,						
									SUM(CASE WHEN MONTH(OCT.fecha) = 04 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS RealAbril,						
									SUM(CASE WHEN MONTH(OCT.fecha) = 05 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS RealMayo,
									SUM(CASE WHEN MONTH(OCT.fecha) = 06 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS RealJunio,							
									SUM(CASE WHEN MONTH(OCT.fecha) = 07 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS RealJulio,							
									SUM(CASE WHEN MONTH(OCT.fecha) = 08 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS RealAgosto,							
									SUM(CASE WHEN MONTH(OCT.fecha) = 09 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS RealSeptiembre,							
									SUM(CASE WHEN MONTH(OCT.fecha) = 10 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS RealOctubre,							
									SUM(CASE WHEN MONTH(OCT.fecha) = 11 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS RealNoviembre,							
									SUM(CASE WHEN MONTH(OCT.fecha) = 12 THEN ((OCDT.precio_unitario + OCDT.iva_unitario + OCDT.ieps_unitario) * OCDT.cantidad)ELSE 0 END)  AS RealDiciembre	
							FROM ordenes_compra  AS OCT
							INNER JOIN ordenes_compra_detalles_02 AS OCDT ON OCT.orden_compra_id = OCDT.orden_compra_id
							INNER JOIN departamentos  AS D ON OCT.departamento_id = D.departamento_id
							INNER JOIN sucursales  AS S ON OCT.sucursal_id = S.sucursal_id	
							WHERE YEAR(OCT.fecha) = ".$intAnio." 
							".$strSucrsal." "
							.$strDepartamento."
							AND OCT.estatus IN ('AUTORIZADO', 'PARCIAL', 'SURTIDO')
							GROUP BY OCT.sucursal_id, OCT.departamento_id
				");

			return $query;
	}
}
?>