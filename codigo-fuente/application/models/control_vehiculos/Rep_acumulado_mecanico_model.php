<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_acumulado_mecanico_model extends CI_model {

	//Consulta que se utiliza para el reporte de todos los mecánicos
	public function ordenes_servicios_internos($dteFechaInicial, $dteFechaFinal, $intSucursalID = NULL, $intMecanicoID = NULL, $intVehiculoID = NULL){
	
		$strRangoFechas = "";
		$strSucursalID = "";
		$strMecanicoID = "";
		$strVehiculoID = "";

		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	    	$strRangoFechas = " AND ORI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'";
	    }
		if($intSucursalID != 0)
		{
			$strSucursalID = " AND ORI.sucursal_id = '$intSucursalID'";
		}
		if($intMecanicoID != 0)
		{
			$strMecanicoID = " AND ORI.mecanico_id = '$intMecanicoID'";
		}
		if($intVehiculoID != 0)
		{
			$strVehiculoID = " AND ORI.vehiculo_id = '$intVehiculoID'";
		}

		$query = $this->db->query("
									SELECT 
										ORI.orden_reparacion_interna_id,
									    ORIS.mecanico_id,
									    ORIS.horas
									FROM ordenes_reparacion_internas ORI
									INNER JOIN ordenes_reparacion_internas_servicios ORIS ON ORIS.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id
									WHERE ORI.estatus = 'ACTIVO'
									$strRangoFechas
									$strSucursalID
									$strVehiculoID
									$strMecanicoID
									ORDER BY mecanico_id 
								");
        return $query;

	}

	//Consulta que se utiliza para el reporte de un mecánico en particular
	public function ordenes_servicios_internos_mecanico($dteFechaInicial, $dteFechaFinal, $intSucursalID = NULL, $intMecanicoID, $intVehiculoID = NULL){
	
		$strRangoFechas = "";
		$strSucursalID = "";
		$strMecanicoID = "";
		$strVehiculoID = "";

		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	    	$strRangoFechas = " AND ORI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'";
	    }
		if($intSucursalID != 0)
		{
			$strSucursalID = " AND ORI.sucursal_id = '$intSucursalID'";
		}
		if($intMecanicoID != 0)
		{
			$strMecanicoID = " AND ORIS.mecanico_id = '$intMecanicoID'";
		}
		if($intVehiculoID != 0)
		{
			$strVehiculoID = " AND ORI.vehiculo_id = '$intVehiculoID'";
		}

		$query = $this->db->query("
									SELECT 
									    ORI.orden_reparacion_interna_id,
									    ORI.folio,
									    DATE_FORMAT(ORI.fecha, '%d/%m/%Y') AS fecha,
									    CONCAT_WS(' - ', V.codigo, CONCAT_WS(' ', V.modelo, V.marca, V.anio)) AS vehiculo, 
									    ORIS.mecanico_id,
									    ORIS.horas
									FROM ordenes_reparacion_internas ORI
									INNER JOIN ordenes_reparacion_internas_servicios ORIS ON ORIS.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id
									INNER JOIN vehiculos V ON V.vehiculo_id = ORI.vehiculo_id
									WHERE ORI.estatus = 'ACTIVO'
									$strRangoFechas
									$strSucursalID
									$strVehiculoID
									$strMecanicoID 
								");
        return $query;

	}

	public function buscar_trabajos_foraneos($intOrdenReparacionInternaID){

		$query = $this->db->query("
									SELECT 
										ORI.orden_reparacion_interna_id,
									    SUM(Temp.importe) AS importe_trabajo_foraneo
									FROM trabajos_foraneos_internos TFI 
									LEFT JOIN ordenes_reparacion_internas ORI ON ORI.orden_reparacion_interna_id = TFI.orden_reparacion_interna_id
									LEFT JOIN (
												SELECT
													TFID.trabajo_foraneo_interno_id,
													SUM(
															(TFID.cantidad * (TFID.precio_unitario/TFI2.tipo_cambio)) +
															(TFID.cantidad * (TFID.iva_unitario/TFI2.tipo_cambio)) +
															(TFID.cantidad * (TFID.ieps_unitario/TFI2.tipo_cambio))
													  ) AS importe
												FROM trabajos_foraneos_internos_detalles TFID
									            INNER JOIN trabajos_foraneos_internos TFI2 ON TFI2.trabajo_foraneo_interno_id = TFID.trabajo_foraneo_interno_id
									            GROUP BY TFID.trabajo_foraneo_interno_id
											  ) AS Temp ON Temp.trabajo_foraneo_interno_id = TFI.trabajo_foraneo_interno_id                
									WHERE ORI.orden_reparacion_interna_id = $intOrdenReparacionInternaID 
								");
        return $query;

	}

}
?>