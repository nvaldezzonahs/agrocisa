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
				$strRestriccionesSucursales .= "FS.sucursal_id = ".$arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}



		$query = $this->db->query("
									SELECT 	Temp.prospecto_id, 
											C.nombre_comercial AS cliente, 
									        C.localidad, 
									        M.descripcion AS municipio, 
									        E.descripcion AS estado,
									        SUM(numero_facturas) AS numero_facturas,
									        SUM(subtotal) AS subtotal, 
									        SUM(iva) AS iva, 
									        SUM(ieps) AS ieps, 
									        SUM(total) AS total
									FROM ( 
												SELECT 
													FS.prospecto_id,
									                COUNT(FS.folio) AS numero_facturas,
													IFNULL(SUM(FSMO.precio_unitario / FS.tipo_cambio), 0) +
													IFNULL(SUM((FSO.precio_unitario * FSO.cantidad) / FS.tipo_cambio), 0) +
													IFNULL(SUM((FSR.precio_unitario * FSR.cantidad) / FS.tipo_cambio), 0) +
													IFNULL(SUM((FSTF.precio_unitario * FSTF.cantidad) / FS.tipo_cambio), 0) AS subtotal, 
													IFNULL(SUM(FSMO.iva_unitario / FS.tipo_cambio), 0) +
													IFNULL(SUM((FSO.iva_unitario * FSO.cantidad) / FS.tipo_cambio), 0) +
													IFNULL(SUM((FSR.iva_unitario * FSR.cantidad) / FS.tipo_cambio), 0) +
													IFNULL(SUM((FSTF.iva_unitario * FSTF.cantidad) / FS.tipo_cambio), 0) AS iva, 
													IFNULL(SUM(FSMO.ieps_unitario / FS.tipo_cambio), 0) +
													IFNULL(SUM((FSO.ieps_unitario * FSO.cantidad) / FS.tipo_cambio), 0) +
													IFNULL(SUM((FSR.ieps_unitario * FSR.cantidad) / FS.tipo_cambio), 0) +
													IFNULL(SUM((FSTF.ieps_unitario * FSTF.cantidad) / FS.tipo_cambio), 0) AS ieps, 
													IFNULL(SUM((FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) / FS.tipo_cambio), 0) +
													IFNULL(SUM(((FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) * FSO.cantidad) / FS.tipo_cambio), 0) +
													IFNULL(SUM(((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * FSR.cantidad) / FS.tipo_cambio), 0) +
													IFNULL(SUM(((FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) * FSTF.cantidad) / FS.tipo_cambio), 0) AS total      
												FROM
													facturas_servicio FS
												LEFT JOIN facturas_servicio_mano_obra FSMO ON FSMO.factura_servicio_id = FS.factura_servicio_id
												LEFT JOIN facturas_servicio_otros FSO ON FSO.factura_servicio_id = FS.factura_servicio_id
												LEFT JOIN facturas_servicio_refacciones FSR ON FSR.factura_servicio_id = FS.factura_servicio_id
												LEFT JOIN facturas_servicio_trabajos_foraneos FSTF ON FSTF.factura_servicio_id = FS.factura_servicio_id 
												WHERE (FS.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal') 
												AND (FS.estatus = 'ACTIVO' OR FS.estatus = 'TIMBRAR')
												$strRestriccionesSucursales
												GROUP BY FS.prospecto_id
									     ) AS Temp
									INNER JOIN clientes C ON C.prospecto_id = Temp.prospecto_id
									INNER JOIN municipios M ON M.municipio_id = C.municipio_id
									INNER JOIN sat_estados E ON E.estado_id = M.estado_id      
									GROUP BY Temp.prospecto_id
									ORDER BY total DESC
								");

        return $query->result();


	}


	/*Método para regresar las ventas de servicio que coincidan con los criterios de búsqueda proporcionados*/
	public function ventas_servicio($dteFechaInicial, $dteFechaFinal, $strSucursales)
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
				$strRestriccionesSucursales .= "FS.sucursal_id = ".$arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}


		$query = $this->db->query("SELECT 	Temp.servicio_id, 
											CONCAT_WS('-', S.codigo, S.descripcion) AS servicio, 
											SUM(numero_facturas) AS numero_facturas,
											SUM(subtotal) AS subtotal, 
											SUM(iva) AS iva, 
											SUM(ieps) AS ieps, 
											SUM(total) AS total
									FROM ( 
											SELECT 
												FSMO.servicio_id,
												COUNT(FS.folio) AS numero_facturas,
												IFNULL(SUM(FSMO.precio_unitario / FS.tipo_cambio), 0) AS subtotal, 
												IFNULL(SUM(FSMO.iva_unitario / FS.tipo_cambio), 0) AS iva, 
												IFNULL(SUM(FSMO.ieps_unitario / FS.tipo_cambio), 0) AS ieps, 
												IFNULL(SUM((FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) / FS.tipo_cambio), 0) AS total      
											FROM
												facturas_servicio FS
											LEFT JOIN facturas_servicio_mano_obra FSMO ON FSMO.factura_servicio_id = FS.factura_servicio_id
											WHERE (fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal') 
											AND (FS.estatus = 'ACTIVO' OR FS.estatus = 'TIMBRAR')												
											$strRestriccionesSucursales
											GROUP BY FSMO.servicio_id
										 ) AS Temp
									INNER JOIN servicios S ON S.servicio_id = Temp.servicio_id     
									GROUP BY Temp.servicio_id
									ORDER BY total DESC;");

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
				$strRestriccionesSucursales .= "FS.sucursal_id = ".$arrSucursales[$intCon];
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
									        FS.prospecto_id,
									        COUNT(FS.folio) AS numero_facturas,
									        IFNULL(SUM((FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) / FS.tipo_cambio), 0) + 
									        IFNULL(SUM(((FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) * FSO.cantidad) / FS.tipo_cambio), 0) + 
									        IFNULL(SUM(((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * FSR.cantidad) / FS.tipo_cambio), 0) + 
									        IFNULL(SUM(((FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) * FSTF.cantidad) / FS.tipo_cambio), 0) AS total,
									        SUM(CASE WHEN MONTH(FS.fecha) = 1 THEN 1 ELSE 0 END) AS facturas_enero,
											SUM(CASE WHEN MONTH(FS.fecha) = 2 THEN 1 ELSE 0 END) AS facturas_febrero,
											SUM(CASE WHEN MONTH(FS.fecha) = 3 THEN 1 ELSE 0 END) AS facturas_marzo,
											SUM(CASE WHEN MONTH(FS.fecha) = 4 THEN 1 ELSE 0 END) AS facturas_abril,
											SUM(CASE WHEN MONTH(FS.fecha) = 5 THEN 1 ELSE 0 END) AS facturas_mayo,
											SUM(CASE WHEN MONTH(FS.fecha) = 6 THEN 1 ELSE 0 END) AS facturas_junio,
											SUM(CASE WHEN MONTH(FS.fecha) = 7 THEN 1 ELSE 0 END) AS facturas_julio,
											SUM(CASE WHEN MONTH(FS.fecha) = 8 THEN 1 ELSE 0 END) AS facturas_agosto,
											SUM(CASE WHEN MONTH(FS.fecha) = 9 THEN 1 ELSE 0 END) AS facturas_septiembre,
											SUM(CASE WHEN MONTH(FS.fecha) = 10 THEN 1 ELSE 0 END) AS facturas_octubre,
											SUM(CASE WHEN MONTH(FS.fecha) = 11 THEN 1 ELSE 0 END) AS facturas_noviembre,
											SUM(CASE WHEN MONTH(FS.fecha) = 12 THEN 1 ELSE 0 END) AS facturas_diciembre,
									        SUM(CASE WHEN MONTH(FS.fecha) = 1 THEN IFNULL(((FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) / FS.tipo_cambio),0) +
												IFNULL((((FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) * FSO.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * FSR.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) * FSTF.cantidad) / FS.tipo_cambio),0) ELSE 0 END) AS TotalEnero,
											SUM(CASE WHEN MONTH(FS.fecha) = 2 THEN IFNULL(((FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) / FS.tipo_cambio),0) +
												IFNULL((((FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) * FSO.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * FSR.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) * FSTF.cantidad) / FS.tipo_cambio),0) ELSE 0 END) AS TotalFebrero,
											SUM(CASE WHEN MONTH(FS.fecha) = 3 THEN IFNULL(((FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) / FS.tipo_cambio),0) +
												IFNULL((((FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) * FSO.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * FSR.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) * FSTF.cantidad) / FS.tipo_cambio),0) ELSE 0 END) AS TotalMarzo,
											SUM(CASE WHEN MONTH(FS.fecha) = 4 THEN IFNULL(((FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) / FS.tipo_cambio),0) +
												IFNULL((((FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) * FSO.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * FSR.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) * FSTF.cantidad) / FS.tipo_cambio),0) ELSE 0 END) AS TotalAbril,
											SUM(CASE WHEN MONTH(FS.fecha) = 5 THEN IFNULL(((FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) / FS.tipo_cambio),0) +
												IFNULL((((FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) * FSO.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * FSR.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) * FSTF.cantidad) / FS.tipo_cambio),0) ELSE 0 END) AS TotalMayo,
											SUM(CASE WHEN MONTH(FS.fecha) = 6 THEN IFNULL(((FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) / FS.tipo_cambio),0) +
												IFNULL((((FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) * FSO.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * FSR.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) * FSTF.cantidad) / FS.tipo_cambio),0) ELSE 0 END) AS TotalJunio,
											SUM(CASE WHEN MONTH(FS.fecha) = 7 THEN IFNULL(((FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) / FS.tipo_cambio),0) +
												IFNULL((((FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) * FSO.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * FSR.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) * FSTF.cantidad) / FS.tipo_cambio),0) ELSE 0 END) AS TotalJulio,
											SUM(CASE WHEN MONTH(FS.fecha) = 8 THEN IFNULL(((FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) / FS.tipo_cambio),0) +
												IFNULL((((FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) * FSO.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * FSR.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) * FSTF.cantidad) / FS.tipo_cambio),0) ELSE 0 END) AS TotalAgosto,
									        SUM(CASE WHEN MONTH(FS.fecha) = 9 THEN IFNULL(((FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) / FS.tipo_cambio),0) +
												IFNULL((((FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) * FSO.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * FSR.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) * FSTF.cantidad) / FS.tipo_cambio),0) ELSE 0 END) AS TotalSeptiembre,
									        SUM(CASE WHEN MONTH(FS.fecha) = 10 THEN IFNULL(((FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) / FS.tipo_cambio),0) +
												IFNULL((((FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) * FSO.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * FSR.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) * FSTF.cantidad) / FS.tipo_cambio),0) ELSE 0 END) AS TotalOctubre,
									        SUM(CASE WHEN MONTH(FS.fecha) = 11 THEN IFNULL(((FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) / FS.tipo_cambio),0) +
												IFNULL((((FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) * FSO.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * FSR.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) * FSTF.cantidad) / FS.tipo_cambio),0) ELSE 0 END) AS TotalNoviembre,
									        SUM(CASE WHEN MONTH(FS.fecha) = 12 THEN IFNULL(((FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) / FS.tipo_cambio),0) +
												IFNULL((((FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario) * FSO.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario) * FSR.cantidad) / FS.tipo_cambio),0) +
												IFNULL((((FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario) * FSTF.cantidad) / FS.tipo_cambio),0) ELSE 0 END) AS TotalDiciembre    
									    FROM facturas_servicio FS
									    LEFT JOIN facturas_servicio_mano_obra FSMO ON FSMO.factura_servicio_id = FS.factura_servicio_id
									    LEFT JOIN facturas_servicio_otros FSO ON FSO.factura_servicio_id = FS.factura_servicio_id
									    LEFT JOIN facturas_servicio_refacciones FSR ON FSR.factura_servicio_id = FS.factura_servicio_id
									    LEFT JOIN facturas_servicio_trabajos_foraneos FSTF ON FSTF.factura_servicio_id = FS.factura_servicio_id
									    WHERE(FS.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
									    AND (FS.estatus = 'ACTIVO' OR FS.estatus = 'TIMBRAR')
									    $strRestriccionesSucursales
									    GROUP BY FS.prospecto_id
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