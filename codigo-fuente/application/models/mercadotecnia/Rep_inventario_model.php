<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_inventario_model extends CI_model {

	public function consultar($dteFechaCorte){

		$strFecha = explode("-", $dteFechaCorte);
		$strAnio = $strFecha[0];

		$fechaInicio = $strAnio.'-01-01';
		$fechaFin = $dteFechaCorte;

		$this->db->select("	I.insumo_id,
							I.descripcion,
						    II.inicial_existencia,
						    II.inicial_costo,
						    MI.movimiento_insumo_id,
						    MI.tipo_movimiento,
						    DATE_FORMAT(MI.fecha, '%d/%m/%Y') AS fecha,
						    MI.folio,
						    MID.cantidad,
						    MID.precio_unitario");
		$this->db->from("(
							insumos AS I
							INNER JOIN insumos_inventario AS II ON I.insumo_id = II.insumo_id
					        AND II.anio = '$strAnio'
						 )");
		$this->db->join("(
							movimientos_insumos AS MI
							INNER JOIN movimientos_insumos_detalles AS MID ON MI.movimiento_insumo_id = MID.movimiento_insumo_id
					        AND MI.estatus <> 'INACTIVO'
					        AND MI.fecha BETWEEN '$fechaInicio' AND '$fechaFin'		
					    )", 'I.insumo_id = MID.insumo_id', 'left');
		$this->db->order_by('I.insumo_id , MI.fecha , MI.fecha_creacion', 'ASC');
		return $this->db->get()->result();

	}

}