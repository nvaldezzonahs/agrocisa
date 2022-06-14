<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentas_presupuestos_model extends CI_model {
	//Método para guardar los datos de un presupuesto nuevo
	public function guardar($arrDatos)
	{
		//Guardar los datos de los registros
		return $this->db->insert_batch('cuentas_presupuestos', $arrDatos);
		
	}

	//Método para modificar los datos de un presupuesto previamente guardado
	public function modificar($intCuentaID, $strAnio, $arrDatos)
	{
		//Actualizar los datos de los registros
		return $this->db->update_batch('cuentas_presupuestos', $arrDatos, 'mes', 
										array("cuenta_id= $intCuentaID
										   	   AND anio='$strAnio'"));
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intCuentaID, $strAnio)
	{
		$this->db->select('FORMAT(importe,2) AS importe');
		$this->db->from('cuentas_presupuestos');
        $this->db->where('cuenta_id', $intCuentaID);
        $this->db->where('anio', $strAnio);
        return $this->db->get()->result();
	}


	/*Método para regresar los presupuestos de cuentas por año
	 (se utiliza en el reporte presupuestos)*/
	public function buscar_presupuestos_anio($strAnio)
	{

		//Formar consulta
		$queryPresupuestos = "SELECT  
        								CONCAT_WS(' ', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel) AS cuenta,
        								CC.descripcion, 
        								SUM(CASE WHEN CP.mes = 01 THEN CP.importe ELSE 0 END) AS PresupuestoEnero,
								        IFNULL(Temp.realEnero, 0) AS RealEnero,
										SUM(CASE WHEN CP.mes = 02 THEN CP.importe ELSE 0 END) AS PresupuestoFebrero,
										IFNULL(Temp.realFebrero, 0) AS RealFebrero,
										SUM(CASE WHEN CP.mes = 03 THEN CP.importe ELSE 0 END) AS PresupuestoMarzo,
										IFNULL(Temp.realMarzo, 0) AS RealMarzo,
										SUM(CASE WHEN CP.mes = 04 THEN CP.importe ELSE 0 END) AS PresupuestoAbril,
										IFNULL(Temp.realAbril, 0) AS RealAbril,
										SUM(CASE WHEN CP.mes = 05 THEN CP.importe ELSE 0 END) AS PresupuestoMayo,
								        IFNULL(Temp.realMayo, 0) AS RealMayo,
										SUM(CASE WHEN CP.mes = 06 THEN CP.importe ELSE 0 END) AS PresupuestoJunio,
										IFNULL(Temp.realJunio, 0) AS RealJunio,
										SUM(CASE WHEN CP.mes = 07 THEN CP.importe ELSE 0 END) AS PresupuestoJulio,
										IFNULL(Temp.realJulio, 0) AS RealJulio,
										SUM(CASE WHEN CP.mes = 08 THEN CP.importe ELSE 0 END) AS PresupuestoAgosto,
										IFNULL(Temp.realAgosto, 0) AS RealAgosto,
										SUM(CASE WHEN CP.mes = 09 THEN CP.importe ELSE 0 END) AS PresupuestoSeptiembre,
										IFNULL(Temp.realSeptiembre, 0) AS RealSeptiembre,
										SUM(CASE WHEN CP.mes = 10 THEN CP.importe ELSE 0 END) AS PresupuestoOctubre,
										IFNULL(Temp.realOctubre, 0) AS RealOctubre,
										SUM(CASE WHEN CP.mes = 11 THEN CP.importe ELSE 0 END) AS PresupuestoNoviembre,	
										IFNULL(Temp.realNoviembre, 0) AS RealNoviembre,		
										SUM(CASE WHEN CP.mes = 12 THEN CP.importe ELSE 0 END) AS PresupuestoDiciembre,
										IFNULL(Temp.realDiciembre, 0) AS RealDiciembre
										
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
										WHERE YEAR(P.fecha) = '$strAnio'
										GROUP BY  CCL.cuenta_id

					        	) AS Temp  ON CP.cuenta_id = Temp.cuenta_id
				        	WHERE CP.anio = '$strAnio'
				        	GROUP BY CC.cuenta_id 
				        	ORDER BY CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel";

		$strSQL = $this->db->query($queryPresupuestos);
		return $strSQL->result();		

	}
}
?>