<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_presupuestos_model extends CI_model {

	public function buscar_presupuestos_contabilidad($intAnio)
	{
        $query = $this->db->query("SELECT  
        								CONCAT_WS(' ', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel) AS cuenta,
        								CC.descripcion, 
        								SUM(CASE WHEN CP.mes = 01 THEN CP.importe ELSE 0 END) AS PresupuestoEnero,
								        Temp.realEnero AS RealEnero,
										SUM(CASE WHEN CP.mes = 02 THEN CP.importe ELSE 0 END) AS PresupuestoFebrero,
										Temp.realFebrero AS RealFebrero,
										SUM(CASE WHEN CP.mes = 03 THEN CP.importe ELSE 0 END) AS PresupuestoMarzo,
										Temp.realMarzo AS RealMarzo,
										SUM(CASE WHEN CP.mes = 04 THEN CP.importe ELSE 0 END) AS PresupuestoAbril,
										Temp.realAbril AS RealAbril,
										SUM(CASE WHEN CP.mes = 05 THEN CP.importe ELSE 0 END) AS PresupuestoMayo,
								        Temp.realMayo AS RealMayo,
										SUM(CASE WHEN CP.mes = 06 THEN CP.importe ELSE 0 END) AS PresupuestoJunio,
										Temp.realJunio AS RealJunio,
										SUM(CASE WHEN CP.mes = 07 THEN CP.importe ELSE 0 END) AS PresupuestoJulio,
										Temp.realJulio AS RealJulio,
										SUM(CASE WHEN CP.mes = 08 THEN CP.importe ELSE 0 END) AS PresupuestoAgosto,
										Temp.realAgosto AS RealAgosto,
										SUM(CASE WHEN CP.mes = 09 THEN CP.importe ELSE 0 END) AS PresupuestoSeptiembre,
										Temp.realSeptiembre AS RealSeptiembre,
										SUM(CASE WHEN CP.mes = 10 THEN CP.importe ELSE 0 END) AS PresupuestoOctubre,
										Temp.realOctubre AS RealOctubre,
										SUM(CASE WHEN CP.mes = 11 THEN CP.importe ELSE 0 END) AS PresupuestoNoviembre,	
										Temp.realNoviembre AS RealNoviembre,		
										SUM(CASE WHEN CP.mes = 12 THEN CP.importe ELSE 0 END) AS PresupuestoDiciembre,
										Temp.realDiciembre AS RealDiciembre
										
										
        	FROM catalogo_cuentas AS CC 
        	INNER JOIN cuentas_presupuestos  AS CP ON CC.cuenta_id = CP.cuenta_id
        	LEFT JOIN(
	        		SELECT CCL.cuenta_id,
						SUM(CASE WHEN MONTH(P.fecha) = 01 THEN PDL.importe ELSE 0 END) AS realEnero,
						SUM(CASE WHEN MONTH(P.fecha) = 02 THEN PDL.importe ELSE 0 END) AS realFebrero,
						SUM(CASE WHEN MONTH(P.fecha) = 03 THEN PDL.importe ELSE 0 END) AS realMarzo,
						SUM(CASE WHEN MONTH(P.fecha) = 04 THEN PDL.importe ELSE 0 END) AS realAbril,
						SUM(CASE WHEN MONTH(P.fecha) = 05 THEN PDL.importe ELSE 0 END) AS realMayo,
						SUM(CASE WHEN MONTH(P.fecha) = 06 THEN PDL.importe ELSE 0 END) AS realJunio,
						SUM(CASE WHEN MONTH(P.fecha) = 07 THEN PDL.importe ELSE 0 END) AS realJulio,
						SUM(CASE WHEN MONTH(P.fecha) = 08 THEN PDL.importe ELSE 0 END) AS realAgosto,
						SUM(CASE WHEN MONTH(P.fecha) = 09 THEN PDL.importe ELSE 0 END) AS realSeptiembre,
						SUM(CASE WHEN MONTH(P.fecha) = 10 THEN PDL.importe ELSE 0 END) AS realOctubre,
						SUM(CASE WHEN MONTH(P.fecha) = 11 THEN PDL.importe ELSE 0 END) AS realNoviembre,
						SUM(CASE WHEN MONTH(P.fecha) = 12 THEN PDL.importe ELSE 0 END) AS realDiciembre
						FROM catalogo_cuentas AS CCL 
						LEFT JOIN polizas_detalles AS PDL ON CCL.cuenta_id = PDL.cuenta_id
						LEFT JOIN polizas AS P ON PDL.poliza_id = P.poliza_id
						WHERE YEAR(P.fecha) = ".$intAnio."
						GROUP BY  CCL.cuenta_id

	        	) AS Temp  ON CP.cuenta_id = Temp.cuenta_id
        	WHERE CP.anio = ".$intAnio."
        	GROUP BY CC.cuenta_id 
        	ORDER BY CC.descripcion DESC");
        return $query;

	}

}

?>