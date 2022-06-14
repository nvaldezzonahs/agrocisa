<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio_presupuestos_mano_obra_model extends CI_model {
	//Método para guardar los datos de un presupuesto nuevo
	public function guardar($arrDatos)
	{
		//Guardar los datos de los registros
		return $this->db->insert_batch('servicio_presupuestos_mano_obra', $arrDatos);
		
	}

	//Método para modificar los datos de un presupuesto previamente guardado
	public function modificar(stdClass $objServicioPresupuestoMO)
	{

		//Actualizar los datos de los registros
		return $this->db->update_batch('servicio_presupuestos_mano_obra', $objServicioPresupuestoMO->arrDatos, 'mes',
										array("mecanico_id = $objServicioPresupuestoMO->intMecanicoID
										   	   AND anio='$objServicioPresupuestoMO->strAnio'"));
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intMecanicoID, $strAnio)
	{
		$this->db->select('FORMAT(importe, 2) AS importe, FORMAT(horas, 2) AS horas');
		$this->db->from('servicio_presupuestos_mano_obra');
		$this->db->where('mecanico_id', $intMecanicoID);
        $this->db->where('anio', $strAnio);
        return $this->db->get()->result();
	}


	/*Método para regresar los presupuestos mano de obra por año
	 (se utiliza en el reporte presupuestos mano de obra)*/
	public function buscar_presupuestos_anio($strAnio)
	{
		//Formar consulta
		$queryPresupuestos = "SELECT  SPMO.mecanico_id,
									  CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) AS mecanico,
									  SUM(CASE WHEN SPMO.mes = 01  THEN SPMO.importe ELSE 0 END) AS PresupuestoEnero,
								       IFNULL(Temp.ImporteEnero, 0) AS RealEnero,
								       SUM(CASE WHEN SPMO.mes = 01 THEN SPMO.horas ELSE 0 END) AS HorasEnero,
								       IFNULL(Temp.HorasEnero, 0) AS RealHorasEnero,
									   SUM(CASE WHEN SPMO.mes = 02 THEN SPMO.importe ELSE 0 END) AS PresupuestoFebrero,
								       IFNULL(Temp.ImporteFebrero, 0) AS RealFebrero,
								       SUM(CASE WHEN SPMO.mes = 02 THEN SPMO.horas ELSE 0 END) AS HorasFebrero,
								       IFNULL(Temp.HorasFebrero, 0) AS RealHorasFebrero,
								       SUM(CASE WHEN SPMO.mes = 03 THEN SPMO.importe ELSE 0 END) AS PresupuestoMarzo,
								       IFNULL(Temp.ImporteMarzo, 0) AS RealMarzo,
								       SUM(CASE WHEN SPMO.mes = 03 THEN SPMO.horas ELSE 0 END) AS HorasMarzo,
								       IFNULL(Temp.HorasMarzo, 0) AS RealHorasMarzo,
								       SUM(CASE WHEN SPMO.mes = 04 THEN SPMO.importe ELSE 0 END) AS PresupuestoAbril,
								       IFNULL(Temp.ImporteAbril, 0) AS RealAbril,
								       SUM(CASE WHEN SPMO.mes = 04 THEN SPMO.horas ELSE 0 END) AS HorasAbril,
								       IFNULL(Temp.HorasAbril, 0) AS RealHorasAbril,
								       SUM(CASE WHEN SPMO.mes = 05 THEN SPMO.importe ELSE 0 END) AS PresupuestoMayo,
								       IFNULL(Temp.ImporteMayo, 0) AS RealMayo,
								       SUM(CASE WHEN SPMO.mes = 05 THEN SPMO.horas ELSE 0 END) AS HorasMayo,
								       IFNULL(Temp.HorasMayo, 0) AS RealHorasMayo,
								       SUM(CASE WHEN SPMO.mes = 06 THEN SPMO.importe ELSE 0 END) AS PresupuestoJunio,
								       IFNULL(Temp.ImporteJunio, 0) AS RealJunio,
								       SUM(CASE WHEN SPMO.mes = 06 THEN SPMO.horas ELSE 0 END) AS HorasJunio,
								       IFNULL(Temp.HorasJunio, 0) AS RealHorasJunio,
								       SUM(CASE WHEN SPMO.mes = 07 THEN SPMO.importe ELSE 0 END) AS PresupuestoJulio,
								       IFNULL(Temp.ImporteJulio, 0) AS RealJulio,
								       SUM(CASE WHEN SPMO.mes = 07 THEN SPMO.horas ELSE 0 END) AS HorasJulio,
								       IFNULL(Temp.HorasJulio, 0) AS RealHorasJulio,
								       SUM(CASE WHEN SPMO.mes = 08 THEN SPMO.importe ELSE 0 END) AS PresupuestoAgosto,
								       IFNULL(Temp.ImporteAgosto, 0) AS RealAgosto,
								       SUM(CASE WHEN SPMO.mes = 08 THEN SPMO.horas ELSE 0 END) AS HorasAgosto,
								       IFNULL(Temp.HorasAgosto, 0) AS RealHorasAgosto,
								       SUM(CASE WHEN SPMO.mes = 09 THEN SPMO.importe ELSE 0 END) AS PresupuestoSeptiembre,
								       IFNULL(Temp.ImporteSeptiembre, 0) AS RealSeptiembre,
								       SUM(CASE WHEN SPMO.mes = 09 THEN SPMO.horas ELSE 0 END) AS HorasSeptiembre,
								       IFNULL(Temp.HorasSeptiembre, 0) AS RealHorasSeptiembre,
								       SUM(CASE WHEN SPMO.mes = 10 THEN SPMO.importe ELSE 0 END) AS PresupuestoOctubre,
								       IFNULL(Temp.ImporteOctubre, 0) AS RealOctubre,
								       SUM(CASE WHEN SPMO.mes = 10 THEN SPMO.horas ELSE 0 END) AS HorasOctubre,
								       IFNULL(Temp.HorasOctubre, 0) AS RealHorasOctubre,
								       SUM(CASE WHEN SPMO.mes = 11 THEN SPMO.importe ELSE 0 END) AS PresupuestoNoviembre,
								       IFNULL(Temp.ImporteNoviembre, 0) AS RealNoviembre,
								       SUM(CASE WHEN SPMO.mes = 11 THEN SPMO.horas ELSE 0 END) AS HorasNoviembre,
								       IFNULL(Temp.HorasNoviembre, 0) AS RealHorasNoviembre,
								       SUM(CASE WHEN SPMO.mes = 12 THEN SPMO.importe ELSE 0 END) AS PresupuestoDiciembre,
								       IFNULL(Temp.ImporteDiciembre, 0) AS RealDiciembre,
								       SUM(CASE WHEN SPMO.mes = 12 THEN SPMO.horas ELSE 0 END) AS HorasDiciembre,
								       IFNULL(Temp.HorasDiciembre, 0) AS RealHorasDiciembre
							  FROM (
											servicio_presupuestos_mano_obra AS SPMO
											INNER JOIN mecanicos AS M ON M.mecanico_id = SPMO.mecanico_id
									        INNER JOIN empleados AS E ON E.empleado_id = M.empleado_id
								 ) 
							   LEFT JOIN (SELECT  
													ORS.mecanico_id AS mecanicoID,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 01 THEN (ORS.horas * ORS.precio) ELSE 0 END) AS ImporteEnero,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 01 THEN (ORS.horas) ELSE 0 END) AS HorasEnero,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 02 THEN (ORS.horas * ORS.precio) ELSE 0 END) AS ImporteFebrero,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 02 THEN (ORS.horas) ELSE 0 END) AS HorasFebrero,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 03 THEN (ORS.horas * ORS.precio) ELSE 0 END) AS ImporteMarzo,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 03 THEN (ORS.horas) ELSE 0 END) AS HorasMarzo,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 04 THEN (ORS.horas * ORS.precio) ELSE 0 END) AS ImporteAbril,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 04 THEN (ORS.horas) ELSE 0 END) AS HorasAbril,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 05 THEN (ORS.horas * ORS.precio) ELSE 0 END) AS ImporteMayo,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 05 THEN (ORS.horas) ELSE 0 END) AS HorasMayo,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 06 THEN (ORS.horas * ORS.precio) ELSE 0 END) AS ImporteJunio,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 06 THEN (ORS.horas) ELSE 0 END) AS HorasJunio,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 07 THEN (ORS.horas * ORS.precio) ELSE 0 END) AS ImporteJulio,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 07 THEN (ORS.horas) ELSE 0 END) AS HorasJulio,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 08 THEN (ORS.horas * ORS.precio) ELSE 0 END) AS ImporteAgosto,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 08 THEN (ORS.horas) ELSE 0 END) AS HorasAgosto,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 09 THEN (ORS.horas * ORS.precio) ELSE 0 END) AS ImporteSeptiembre,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 09 THEN (ORS.horas) ELSE 0 END) AS HorasSeptiembre,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 10 THEN (ORS.horas * ORS.precio) ELSE 0 END) AS ImporteOctubre,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 10 THEN (ORS.horas) ELSE 0 END) AS HorasOctubre,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 11 THEN (ORS.horas * ORS.precio) ELSE 0 END) AS ImporteNoviembre,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 11 THEN (ORS.horas) ELSE 0 END) AS HorasNoviembre,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 12 THEN (ORS.horas * ORS.precio) ELSE 0 END) AS ImporteDiciembre,
													SUM(CASE WHEN MONTH(ORS.fecha_finalizacion) = 12 THEN (ORS.horas) ELSE 0 END) AS HorasDiciembre
											FROM ordenes_reparacion_servicios AS ORS
											INNER JOIN ordenes_reparacion AS OREP ON OREP.orden_reparacion_id = ORS.orden_reparacion_id
											WHERE OREP.estatus = 'FINALIZADO'
											AND ORS.estatus = 'FINALIZADO'
											AND YEAR(ORS.fecha_finalizacion) = '$strAnio'
											GROUP BY ORS.mecanico_id
											ORDER BY ORS.mecanico_id
										)   AS Temp ON SPMO.mecanico_id = Temp.mecanicoID
								WHERE SPMO.anio = '$strAnio'
								GROUP BY SPMO.mecanico_id
								ORDER BY SPMO.mecanico_id";

		$strSQL = $this->db->query($queryPresupuestos);
		return $strSQL->result();		
	}

}
?>