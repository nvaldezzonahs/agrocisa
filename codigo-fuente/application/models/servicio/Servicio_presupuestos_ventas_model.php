<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio_presupuestos_ventas_model extends CI_model {
	//Método para guardar los datos de un presupuesto nuevo
	public function guardar($arrDatos)
	{
		//Guardar los datos de los registros
		return $this->db->insert_batch('servicio_presupuestos_ventas', $arrDatos);
		
	}

	//Método para modificar los datos de un presupuesto previamente guardado
	public function modificar(stdClass $objServicioPresupuestoVentas)
	{
		//Actualizar los datos de los registros
		return $this->db->update_batch('servicio_presupuestos_ventas', $objServicioPresupuestoVentas->arrDatos, 'mes', 
										array("tipo = '$objServicioPresupuestoVentas->strTipo' 
										   	   AND anio='$objServicioPresupuestoVentas->strAnio'"));
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($strTipo, $strAnio)
	{
		$this->db->select('FORMAT(importe,2) AS importe');
		$this->db->from('servicio_presupuestos_ventas');
		$this->db->where('tipo', $strTipo);
        $this->db->where('anio', $strAnio);
        return $this->db->get()->result();
	}

	/*Método para regresar los presupuestos de ventas por año
	 (se utiliza en el reporte presupuestos de ventas)*/
	public function buscar_presupuestos_anio($strAnio)
	{
		//Variable que se utiliza para formar la consulta
		$queryPresupuestos = '';

		//Variables para definir que tipos de módulo se incluiran en la búsqueda
		//Presupuestos de ventas
		$queryPptoVentas = "SELECT SPV.mes, 'Presupuesto' AS tipo,
								   IFNULL(SUM(SPV.importe), 0) AS importe
						    FROM servicio_presupuestos_ventas AS SPV
							WHERE SPV.anio = '$strAnio'
							GROUP BY SPV.anio, SPV.mes";

		//Refacciones de las facturas de servicio
		$queryRefacciones = "SELECT DATE_FORMAT(FS.fecha, '%m') AS mes, 
	    							    'Refacciones' AS tipo,
								        IFNULL(SUM(ROUND((FSR.precio_unitario * FSR.cantidad), 2) + 
											       ROUND((FSR.iva_unitario * FSR.cantidad), 2) + 
											       ROUND((FSR.ieps_unitario * FSR.cantidad), 2)), 0) AS importe
							FROM  facturas_servicio AS FS
							INNER JOIN facturas_servicio_refacciones AS FSR ON FSR.factura_servicio_id = FS.factura_servicio_id 
							WHERE FS.estatus = 'ACTIVO'
							AND YEAR(FS.fecha) = '$strAnio'
							GROUP BY YEAR(FS.fecha), DATE_FORMAT(FS.fecha, '%m')"; 


	    //Trabajos foráneos de las facturas de servicio
	    $queryTrabajosForaneos = "SELECT DATE_FORMAT(FS.fecha, '%m') AS mes, 
	    							    'Trabajos Foraneos' AS tipo,
								        IFNULL(SUM(ROUND((FSTF.precio_unitario * FSTF.cantidad), 2) + 
											       ROUND((FSTF.iva_unitario * FSTF.cantidad), 2) + 
											       ROUND((FSTF.ieps_unitario * FSTF.cantidad), 2)), 0) AS importe
								FROM  facturas_servicio AS FS
								INNER JOIN facturas_servicio_trabajos_foraneos AS FSTF ON FSTF.factura_servicio_id = FS.factura_servicio_id 
								WHERE FS.estatus = 'ACTIVO'
								AND YEAR(FS.fecha) = '$strAnio'
								GROUP BY YEAR(FS.fecha), DATE_FORMAT(FS.fecha, '%m')"; 


	    //Otros servicios de las facturas de servicio
	    $queryOtros = "SELECT DATE_FORMAT(FS.fecha, '%m') AS mes, 
						      'Otros' AS tipo, 
					          IFNULL(SUM(ROUND((FSO.precio_unitario * FSO.cantidad), 2) + 
								         ROUND((FSO.iva_unitario * FSO.cantidad), 2) + 
								         ROUND((FSO.ieps_unitario * FSO.cantidad), 2)), 0) AS importe
					  FROM  facturas_servicio AS FS
					  INNER JOIN facturas_servicio_otros AS FSO ON FSO.factura_servicio_id = FS.factura_servicio_id 
					  WHERE FS.estatus = 'ACTIVO'
					  AND YEAR(FS.fecha) = '$strAnio'
					  GROUP BY YEAR(FS.fecha), DATE_FORMAT(FS.fecha, '%m')";

		//Kilometraje (gastos de servicio) de las facturas de servicio
	    $queryGastosServ = "SELECT DATE_FORMAT(FS.fecha, '%m') AS mes, 'Kilometraje' AS tipo, 
								   IFNULL(SUM(ROUND((FS.gastos_servicio + FS.gastos_servicio_iva), 2)),0)   AS importe
						    FROM  facturas_servicio AS FS
						    WHERE FS.estatus = 'ACTIVO'
						    AND YEAR(FS.fecha) = '$strAnio'
						    GROUP BY YEAR(FS.fecha), DATE_FORMAT(FS.fecha, '%m')";


		//Formar consulta
		$queryPresupuestos .= $queryPptoVentas;
	    $queryPresupuestos .= " UNION ";
		$queryPresupuestos .= $queryRefacciones;
		$queryPresupuestos .= " UNION ";
		$queryPresupuestos .= $queryTrabajosForaneos;
		$queryPresupuestos .= " UNION ";
		$queryPresupuestos .= $queryOtros;
		$queryPresupuestos .= " UNION ";
		$queryPresupuestos .= $queryGastosServ;
		$queryPresupuestos .= " ORDER BY mes, tipo";	

		$strSQL = $this->db->query($queryPresupuestos);
		return $strSQL->result();
	}
}
?>