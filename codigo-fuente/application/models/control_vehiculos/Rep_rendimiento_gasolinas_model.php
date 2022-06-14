<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_rendimiento_gasolinas_model extends CI_model {
	
	//Método para regresar los registros correspondientes a un mes en particular
	public function mensual($mes = NULL, $anio = NULL)
	{
		$this->db->select(" V.vehiculo_id,
							CONCAT(V.marca, ' ', V.modelo, ' ', V.anio) AS vehiculo,
							V.codigo,
							CONCAT(E.apellido_paterno, ' ', E.apellido_materno, ' ', E.nombre) AS responsable,
							IFNULL(Temp.litros, 0) AS litros,
							IFNULL(Temp.importe, 0) AS importe,
							IFNULL(Temp2.kilometraje_maximo, 0) AS kilometraje_final,
							CONVERT(CONCAT(Temp3.fecha_minima, ' ', Temp3.hora_minima), DATETIME) AS fecha_minima,
						    CASE 
								WHEN 
									(SELECT kilometraje
									FROM vales_gasolina
									WHERE vehiculo_id = V.vehiculo_id
									AND CONVERT(CONCAT(fecha, ' ', hora), DATETIME) < fecha_minima
									ORDER BY fecha DESC 
									LIMIT 1)
								IS NULL
								THEN (SELECT kilometraje
									  FROM vehiculos
									  WHERE vehiculo_id = V.vehiculo_id
									  LIMIT 1)	
								ELSE (SELECT kilometraje
									  FROM vales_gasolina
									  WHERE vehiculo_id = V.vehiculo_id
									  AND CONVERT(CONCAT(fecha, ' ', hora), DATETIME) < fecha_minima
									  ORDER BY fecha DESC 
									  LIMIT 1)
							END AS kilometraje_inicial
							FROM vehiculos V
							LEFT JOIN empleados E ON E.empleado_id = V.responsable_id
							LEFT JOIN (SELECT 	VG.vehiculo_id,
												SUM(VGD.litros) AS litros,
												SUM(VGD.importe) AS importe
										FROM vales_gasolina VG
										INNER JOIN vales_gasolina_detalles VGD ON VGD.vale_gasolina_id = VG.vale_gasolina_id
										WHERE MONTH(VG.fecha) = $mes
							            AND YEAR(VG.fecha) = $anio
										GROUP BY VG.vehiculo_id
									  ) AS Temp ON Temp.vehiculo_id = V.vehiculo_id
							 LEFT JOIN (
										SELECT vehiculo_id, 
							            MAX(kilometraje) AS kilometraje_maximo,
							            MAX(fecha) AS fecha_maxima, 
							            MAX(hora) AS hora_maxima 
										FROM vales_gasolina 
										WHERE MONTH(fecha) = $mes 
										AND YEAR(fecha) = $anio
										GROUP BY vehiculo_id
							            ) AS Temp2 ON Temp2.vehiculo_id = V.vehiculo_id
							LEFT JOIN (
										SELECT vehiculo_id,
							            MIN(fecha) AS fecha_minima, 
							            MIN(hora) AS hora_minima 
										FROM vales_gasolina 
										WHERE MONTH(fecha) = $mes 
										AND YEAR(fecha) = $anio
										GROUP BY vehiculo_id   
									  ) AS Temp3 ON Temp3.vehiculo_id = V.vehiculo_id
							ORDER BY V.codigo ASC ", FALSE);
        
	    return $this->db->get()->result();
	}

	//Método para regresar los registros correspondientes a un año en particular
	public function comparativo($anio = NULL)
	{
			$this->db->select("	V.vehiculo_id,
								CONCAT(V.marca, ' ', V.modelo, ' ', V.anio) AS vehiculo,
								V.codigo,
								IFNULL(TempLitros.LitrosEnero, 0) AS LitrosEnero,
						        CASE 
									WHEN TempKmMinimoEnero.KmMinimoEnero IS NULL
									THEN (SELECT kilometraje FROM vehiculos WHERE vehiculo_id = V.vehiculo_id LIMIT 1)	
									ELSE TempKmMinimoEnero.KmMinimoEnero
								END AS KmInicialEnero,
						        IFNULL(TempKmMaximo.KmMaximoEnero, 0) AS KmFinalEnero,
								IFNULL(TempLitros.LitrosFebrero, 0) AS LitrosFebrero,
						        CASE 
									WHEN TempKmMinimo.KmMinimoFebrero IS NULL
									THEN (SELECT kilometraje FROM vehiculos WHERE vehiculo_id = V.vehiculo_id LIMIT 1)	
									ELSE TempKmMinimo.KmMinimoFebrero
								END AS KmInicialFebrero,
						        IFNULL(TempKmMaximo.KmMaximoFebrero, 0) AS KmFinalFebrero,
								IFNULL(TempLitros.LitrosMarzo, 0) AS LitrosMarzo,
						        CASE 
									WHEN TempKmMinimo.KmMinimoMarzo IS NULL
									THEN (SELECT kilometraje FROM vehiculos WHERE vehiculo_id = V.vehiculo_id LIMIT 1)	
									ELSE TempKmMinimo.KmMinimoMarzo
								END AS KmInicialMarzo,
						        IFNULL(TempKmMaximo.KmMaximoMarzo, 0) AS KmFinalMarzo,
								IFNULL(TempLitros.LitrosAbril, 0) AS LitrosAbril,
						        CASE 
									WHEN TempKmMinimo.KmMinimoAbril IS NULL
									THEN (SELECT kilometraje FROM vehiculos WHERE vehiculo_id = V.vehiculo_id LIMIT 1)	
									ELSE TempKmMinimo.KmMinimoAbril
								END AS KmInicialAbril,
						        IFNULL(TempKmMaximo.KmMaximoAbril, 0) AS KmFinalAbril,
								IFNULL(TempLitros.LitrosMayo, 0) AS LitrosMayo,
						        CASE 
									WHEN TempKmMinimo.KmMinimoMayo IS NULL
									THEN (SELECT kilometraje FROM vehiculos WHERE vehiculo_id = V.vehiculo_id LIMIT 1)	
									ELSE TempKmMinimo.KmMinimoMayo
								END AS KmInicialMayo,
						        IFNULL(TempKmMaximo.KmMaximoMayo, 0) AS KmFinalMayo,
								IFNULL(TempLitros.LitrosJunio, 0) AS LitrosJunio,
						        CASE 
									WHEN TempKmMinimo.KmMinimoJunio IS NULL
									THEN (SELECT kilometraje FROM vehiculos WHERE vehiculo_id = V.vehiculo_id LIMIT 1)	
									ELSE TempKmMinimo.KmMinimoJunio
								END AS KmInicialJunio,
						        IFNULL(TempKmMaximo.KmMaximoJunio, 0) AS KmFinalJunio,
								IFNULL(TempLitros.LitrosJulio, 0) AS LitrosJulio,
						        CASE 
									WHEN TempKmMinimo.KmMinimoJulio IS NULL
									THEN (SELECT kilometraje FROM vehiculos WHERE vehiculo_id = V.vehiculo_id LIMIT 1)	
									ELSE TempKmMinimo.KmMinimoJulio
								END AS KmInicialJulio,
						        IFNULL(TempKmMaximo.KmMaximoJulio, 0) AS KmFinalJulio,
								IFNULL(TempLitros.LitrosAgosto, 0) AS LitrosAgosto,
						        CASE 
									WHEN TempKmMinimo.KmMinimoAgosto IS NULL
									THEN (SELECT kilometraje FROM vehiculos WHERE vehiculo_id = V.vehiculo_id LIMIT 1)	
									ELSE TempKmMinimo.KmMinimoAgosto
								END AS KmInicialAgosto,
						        IFNULL(TempKmMaximo.KmMaximoAgosto, 0) AS KmFinalAgosto,
								IFNULL(TempLitros.LitrosSeptiembre, 0) AS LitrosSeptiembre,
						        CASE 
									WHEN TempKmMinimo.KmMinimoSeptiembre IS NULL
									THEN (SELECT kilometraje FROM vehiculos WHERE vehiculo_id = V.vehiculo_id LIMIT 1)	
									ELSE TempKmMinimo.KmMinimoSeptiembre
								END AS KmInicialSeptiembre,
						        IFNULL(TempKmMaximo.KmMaximoSeptiembre, 0) AS KmFinalSeptiembre,
								IFNULL(TempLitros.LitrosOctubre, 0) AS LitrosOctubre,
						        CASE 
									WHEN TempKmMinimo.KmMinimoOctubre IS NULL
									THEN (SELECT kilometraje FROM vehiculos WHERE vehiculo_id = V.vehiculo_id LIMIT 1)	
									ELSE TempKmMinimo.KmMinimoOctubre
								END AS KmInicialOctubre,
						        IFNULL(TempKmMaximo.KmMaximoOctubre, 0) AS KmFinalOctubre,
								IFNULL(TempLitros.LitrosNoviembre, 0) AS LitrosNoviembre,
						        CASE 
									WHEN TempKmMinimo.KmMinimoNoviembre IS NULL
									THEN (SELECT kilometraje FROM vehiculos WHERE vehiculo_id = V.vehiculo_id LIMIT 1)	
									ELSE TempKmMinimo.KmMinimoNoviembre
								END AS KmInicialNoviembre,
						        IFNULL(TempKmMaximo.KmMaximoNoviembre, 0) AS KmFinalNoviembre,
								IFNULL(TempLitros.LitrosDiciembre, 0) AS LitrosDiciembre,
						        CASE 
									WHEN TempKmMinimo.KmMinimoDiciembre IS NULL
									THEN (SELECT kilometraje FROM vehiculos WHERE vehiculo_id = V.vehiculo_id LIMIT 1)	
									ELSE TempKmMinimo.KmMinimoDiciembre
								END AS KmInicialDiciembre,
						        IFNULL(TempKmMaximo.KmMaximoDiciembre, 0) AS KmFinalDiciembre
						FROM vehiculos V
						LEFT JOIN (
									SELECT 	VG.vehiculo_id,
											SUM(CASE WHEN MONTH(VG.fecha) = 01 THEN VGD.litros ELSE 0 END) AS LitrosEnero,
											SUM(CASE WHEN MONTH(VG.fecha) = 02 THEN VGD.litros ELSE 0 END) AS LitrosFebrero,
											SUM(CASE WHEN MONTH(VG.fecha) = 03 THEN VGD.litros ELSE 0 END) AS LitrosMarzo,
											SUM(CASE WHEN MONTH(VG.fecha) = 04 THEN VGD.litros ELSE 0 END) AS LitrosAbril,
											SUM(CASE WHEN MONTH(VG.fecha) = 05 THEN VGD.litros ELSE 0 END) AS LitrosMayo,
											SUM(CASE WHEN MONTH(VG.fecha) = 06 THEN VGD.litros ELSE 0 END) AS LitrosJunio,
											SUM(CASE WHEN MONTH(VG.fecha) = 07 THEN VGD.litros ELSE 0 END) AS LitrosJulio,
											SUM(CASE WHEN MONTH(VG.fecha) = 08 THEN VGD.litros ELSE 0 END) AS LitrosAgosto,
											SUM(CASE WHEN MONTH(VG.fecha) = 09 THEN VGD.litros ELSE 0 END) AS LitrosSeptiembre,
											SUM(CASE WHEN MONTH(VG.fecha) = 10 THEN VGD.litros ELSE 0 END) AS LitrosOctubre,
											SUM(CASE WHEN MONTH(VG.fecha) = 11 THEN VGD.litros ELSE 0 END) AS LitrosNoviembre,
											SUM(CASE WHEN MONTH(VG.fecha) = 12 THEN VGD.litros ELSE 0 END) AS LitrosDiciembre
									FROM vales_gasolina VG
									INNER JOIN vales_gasolina_detalles VGD ON VGD.vale_gasolina_id = VG.vale_gasolina_id
									AND YEAR(VG.fecha) = $anio
									GROUP BY VG.vehiculo_id
								   ) AS TempLitros ON TempLitros.vehiculo_id = V.vehiculo_id
						LEFT JOIN (
									SELECT  vehiculo_id,
											MAX( CASE WHEN MONTH(fecha) = 01 THEN kilometraje ELSE 0 END ) AS KmMaximoEnero,
											MAX( CASE WHEN MONTH(fecha) = 02 THEN kilometraje ELSE 0 END ) AS KmMaximoFebrero,
											MAX( CASE WHEN MONTH(fecha) = 03 THEN kilometraje ELSE 0 END ) AS KmMaximoMarzo,
											MAX( CASE WHEN MONTH(fecha) = 04 THEN kilometraje ELSE 0 END ) AS KmMaximoAbril,
											MAX( CASE WHEN MONTH(fecha) = 05 THEN kilometraje ELSE 0 END ) AS KmMaximoMayo,
											MAX( CASE WHEN MONTH(fecha) = 06 THEN kilometraje ELSE 0 END ) AS KmMaximoJunio,
											MAX( CASE WHEN MONTH(fecha) = 07 THEN kilometraje ELSE 0 END ) AS KmMaximoJulio,
											MAX( CASE WHEN MONTH(fecha) = 08 THEN kilometraje ELSE 0 END ) AS KmMaximoAgosto,
											MAX( CASE WHEN MONTH(fecha) = 09 THEN kilometraje ELSE 0 END ) AS KmMaximoSeptiembre,
											MAX( CASE WHEN MONTH(fecha) = 10 THEN kilometraje ELSE 0 END ) AS KmMaximoOctubre,
											MAX( CASE WHEN MONTH(fecha) = 11 THEN kilometraje ELSE 0 END ) AS KmMaximoNoviembre,
											MAX( CASE WHEN MONTH(fecha) = 12 THEN kilometraje ELSE 0 END ) AS KmMaximoDiciembre
									FROM vales_gasolina
									WHERE YEAR(fecha) = $anio
									GROUP BY vehiculo_id
								   ) AS TempKmMaximo ON TempKmMaximo.vehiculo_id = V.vehiculo_id
						LEFT JOIN (
									SELECT  vehiculo_id,
											MAX( CASE WHEN MONTH(fecha) = 01 THEN kilometraje ELSE 0 END ) AS KmMinimoFebrero,
											MAX( CASE WHEN MONTH(fecha) = 02 THEN kilometraje ELSE 0 END ) AS KmMinimoMarzo,
											MAX( CASE WHEN MONTH(fecha) = 03 THEN kilometraje ELSE 0 END ) AS KmMinimoAbril,
											MAX( CASE WHEN MONTH(fecha) = 04 THEN kilometraje ELSE 0 END ) AS KmMinimoMayo,
											MAX( CASE WHEN MONTH(fecha) = 05 THEN kilometraje ELSE 0 END ) AS KmMinimoJunio,
											MAX( CASE WHEN MONTH(fecha) = 06 THEN kilometraje ELSE 0 END ) AS KmMinimoJulio,
											MAX( CASE WHEN MONTH(fecha) = 07 THEN kilometraje ELSE 0 END ) AS KmMinimoAgosto,
											MAX( CASE WHEN MONTH(fecha) = 08 THEN kilometraje ELSE 0 END ) AS KmMinimoSeptiembre,
											MAX( CASE WHEN MONTH(fecha) = 09 THEN kilometraje ELSE 0 END ) AS KmMinimoOctubre,
											MAX( CASE WHEN MONTH(fecha) = 10 THEN kilometraje ELSE 0 END ) AS KmMinimoNoviembre,
											MAX( CASE WHEN MONTH(fecha) = 11 THEN kilometraje ELSE 0 END ) AS KmMinimoDiciembre
									FROM vales_gasolina
									WHERE YEAR(fecha) = $anio
									GROUP BY vehiculo_id
								  )  AS TempKmMinimo ON TempKmMinimo.vehiculo_id = V.vehiculo_id
						LEFT JOIN (
									SELECT vehiculo_id,
											MAX( kilometraje ) AS KmMinimoEnero
									FROM vales_gasolina
									WHERE YEAR(fecha) = $anio - 1
									GROUP BY vehiculo_id
								  ) AS TempKmMinimoEnero ON TempKmMinimoEnero.vehiculo_id = V.vehiculo_id
						ORDER BY V.codigo ", FALSE);
        
	    return $this->db->get()->result();
	}

}

?>