<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_80_20_model extends CI_model {


	/*Método para regresar las ventas a clientes que coincidan con los criterios de búsqueda proporcionados*/
	public function ventas_clientes($dteFechaInicial, $dteFechaFinal, $strSucursales)
	{

		//ID´s de las sucursales
		$strRestriccionesSucursales = '';

		//Si existen sucursales seleccionadas
		if($strSucursales)
		{
			//Generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
			$strRestriccionesSucursales .= " AND (";

		    //Quitar | de la lista para obtener el id de la sucursal
			$arrSucursales = explode("|", $strSucursales);

			//Hacer recorrido para formar restricción con los ID's de las sucursales
			for ($intCon = 0; $intCon < sizeof($arrSucursales); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otra sucursal)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesSucursales .= " OR ";
				}

				//Concatenar id de la sucursal 
				$strRestriccionesSucursales .= "FM.sucursal_id = ".$arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}


		$query = $this->db->query("
									SELECT 
										FM.prospecto_id AS prospecto_id,
									    C.nombre_comercial AS cliente, 
										C.localidad, 
										M.descripcion AS municipio, 
										E.descripcion AS estado,
										COUNT(FM.folio) AS numero_facturas,
										IFNULL(SUM(FM.precio / FM.tipo_cambio), 0) AS subtotal,
										IFNULL(SUM(FM.iva / FM.tipo_cambio), 0) AS iva,
										IFNULL(SUM(FM.ieps / FM.tipo_cambio), 0) AS ieps,
										IFNULL(SUM((FM.precio + FM.iva + FM.ieps) / FM.tipo_cambio), 0) AS total
									FROM facturas_maquinaria FM  
									INNER JOIN clientes C ON C.prospecto_id = FM.prospecto_id
									INNER JOIN municipios M ON M.municipio_id = C.municipio_id
									INNER JOIN sat_estados E ON E.estado_id = M.estado_id  
									WHERE (FM.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
									AND (FM.estatus = 'ACTIVO' OR FM.estatus = 'TIMBRAR')
									$strRestriccionesSucursales
									GROUP BY FM.prospecto_id
									ORDER BY total DESC
								");

        return $query->result();


	}


	/*Método para regresar las ventas de maquinaria que coincidan con los criterios de búsqueda proporcionados*/
	public function ventas_maquinarias($dteFechaInicial, $dteFechaFinal, $strSucursales)
	{

		//ID´s de las sucursales
		$strRestriccionesSucursales = '';

		//Si existen sucursales seleccionadas
		if($strSucursales)
		{
			//Generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
			$strRestriccionesSucursales .= " AND (";

		    //Quitar | de la lista para obtener el id de la sucursal
			$arrSucursales = explode("|", $strSucursales);

			//Hacer recorrido para formar restricción con los ID's de las sucursales
			for ($intCon = 0; $intCon < sizeof($arrSucursales); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otra sucursal)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesSucursales .= " OR ";
				}

				//Concatenar id de la sucursal 
				$strRestriccionesSucursales .= "sucursal_id = ".$arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}

		$query = $this->db->query("
									SELECT  
									        descripcion_corta,
									        COUNT(folio) AS numero_facturas,
									        SUM( precio/tipo_cambio - descuento/tipo_cambio ) AS subtotal,
									        SUM( iva/tipo_cambio ) AS iva,
									        SUM( ieps/tipo_cambio ) AS ieps,
									        SUM( (precio/tipo_cambio - descuento/tipo_cambio) + iva/tipo_cambio + ieps/tipo_cambio ) AS total
									FROM facturas_maquinaria
									WHERE (fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal') 
									AND (estatus = 'ACTIVO' OR estatus = 'TIMBRAR')
									$strRestriccionesSucursales
									GROUP BY descripcion_corta
									ORDER BY total DESC
								");

        return $query->result();


	}


	/*Método para regresar las ventas mensuales a clientes que coincidan con los criterios de búsqueda proporcionados*/
	public function ventas_clientes_mensual($dteFechaInicial, $dteFechaFinal, $strSucursales)
	{

		//ID´s de las sucursales
		$strRestriccionesSucursales = '';

		//Si existen sucursales seleccionadas
		if($strSucursales)
		{
			//Generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
			$strRestriccionesSucursales .= " AND (";

		    //Quitar | de la lista para obtener el id de la sucursal
			$arrSucursales = explode("|", $strSucursales);

			//Hacer recorrido para formar restricción con los ID's de las sucursales
			for ($intCon = 0; $intCon < sizeof($arrSucursales); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otra sucursal)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesSucursales .= " OR ";
				}

				//Concatenar id de la sucursal 
				$strRestriccionesSucursales .= "FM.sucursal_id = ".$arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}

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
									        	FM.prospecto_id AS prospecto_id,
									            COUNT(FM.folio) AS numero_facturas,
									            IFNULL(SUM((FM.precio + FM.iva + FM.ieps) / FM.tipo_cambio), 0) AS total,
									            SUM(CASE WHEN MONTH(FM.fecha) = 1 THEN 1 ELSE 0 END) AS facturas_enero,
									            SUM(CASE WHEN MONTH(FM.fecha) = 2 THEN 1 ELSE 0 END) AS facturas_febrero,
									            SUM(CASE WHEN MONTH(FM.fecha) = 3 THEN 1 ELSE 0 END) AS facturas_marzo,
									            SUM(CASE WHEN MONTH(FM.fecha) = 4 THEN 1 ELSE 0 END) AS facturas_abril,
									            SUM(CASE WHEN MONTH(FM.fecha) = 5 THEN 1 ELSE 0 END) AS facturas_mayo,
									            SUM(CASE WHEN MONTH(FM.fecha) = 6 THEN 1 ELSE 0 END) AS facturas_junio,
									            SUM(CASE WHEN MONTH(FM.fecha) = 7 THEN 1 ELSE 0 END) AS facturas_julio,
									            SUM(CASE WHEN MONTH(FM.fecha) = 8 THEN 1 ELSE 0 END) AS facturas_agosto,
												SUM(CASE WHEN MONTH(FM.fecha) = 9 THEN 1 ELSE 0 END) AS facturas_septiembre,
									            SUM(CASE WHEN MONTH(FM.fecha) = 10 THEN 1 ELSE 0 END) AS facturas_octubre,
									            SUM(CASE WHEN MONTH(FM.fecha) = 11 THEN 1 ELSE 0 END) AS facturas_noviembre,
									            SUM(CASE WHEN MONTH(FM.fecha) = 12 THEN 1 ELSE 0 END) AS facturas_diciembre,
									            SUM(CASE WHEN MONTH(FM.fecha) = 1 THEN IFNULL((FM.precio + FM.iva + FM.ieps) / FM.tipo_cambio, 0) ELSE 0 END) AS TotalEnero,
									            SUM(CASE WHEN MONTH(FM.fecha) = 2 THEN IFNULL((FM.precio + FM.iva + FM.ieps) / FM.tipo_cambio, 0) ELSE 0 END) AS TotalFebrero, 
									            SUM(CASE WHEN MONTH(FM.fecha) = 3 THEN IFNULL((FM.precio + FM.iva + FM.ieps) / FM.tipo_cambio, 0) ELSE 0 END) AS TotalMarzo,   
									            SUM(CASE WHEN MONTH(FM.fecha) = 4 THEN IFNULL((FM.precio + FM.iva + FM.ieps) / FM.tipo_cambio, 0) ELSE 0 END) AS TotalAbril,
									            SUM(CASE WHEN MONTH(FM.fecha) = 5 THEN IFNULL((FM.precio + FM.iva + FM.ieps) / FM.tipo_cambio, 0) ELSE 0 END) AS TotalMayo,
									            SUM(CASE WHEN MONTH(FM.fecha) = 6 THEN IFNULL((FM.precio + FM.iva + FM.ieps) / FM.tipo_cambio, 0) ELSE 0 END) AS TotalJunio,
									            SUM(CASE WHEN MONTH(FM.fecha) = 7 THEN IFNULL((FM.precio + FM.iva + FM.ieps) / FM.tipo_cambio, 0) ELSE 0 END) AS TotalJulio,
									            SUM(CASE WHEN MONTH(FM.fecha) = 8 THEN IFNULL((FM.precio + FM.iva + FM.ieps) / FM.tipo_cambio, 0) ELSE 0 END) AS TotalAgosto,
									            SUM(CASE WHEN MONTH(FM.fecha) = 9 THEN IFNULL((FM.precio + FM.iva + FM.ieps) / FM.tipo_cambio, 0) ELSE 0 END) AS TotalSeptiembre,
									            SUM(CASE WHEN MONTH(FM.fecha) = 10 THEN IFNULL((FM.precio + FM.iva + FM.ieps) / FM.tipo_cambio, 0) ELSE 0 END) AS TotalOctubre,
									            SUM(CASE WHEN MONTH(FM.fecha) = 11 THEN IFNULL((FM.precio + FM.iva + FM.ieps) / FM.tipo_cambio, 0) ELSE 0 END) AS TotalNoviembre,
									            SUM(CASE WHEN MONTH(FM.fecha) = 12 THEN IFNULL((FM.precio + FM.iva + FM.ieps) / FM.tipo_cambio, 0) ELSE 0 END) AS TotalDiciembre      
									    FROM
									        facturas_maquinaria FM
									    WHERE(FM.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
									    AND (FM.estatus = 'ACTIVO' OR FM.estatus = 'TIMBRAR')
									    $strRestriccionesSucursales
									    GROUP BY FM.prospecto_id 
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