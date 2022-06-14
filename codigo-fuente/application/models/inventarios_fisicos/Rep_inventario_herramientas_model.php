<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_inventario_herramientas_model extends CI_model {

	public function consultar($dteFechaCorte, $intMecanicoID){
	
		if($intMecanicoID > 0){
			$join = "(
						movimientos_herramientas AS MH
						INNER JOIN movimientos_herramientas_detalles AS MHD ON MHD.movimiento_herramienta_id = MH.movimiento_herramienta_id
						AND MH.estatus <> 'INACTIVO'
						AND MH.fecha <= '$dteFechaCorte'
						AND MH.mecanico_id = '$intMecanicoID'		
					)";
		}
		else{
			$join = "(
						movimientos_herramientas AS MH
						INNER JOIN movimientos_herramientas_detalles AS MHD ON MHD.movimiento_herramienta_id = MH.movimiento_herramienta_id
						AND MH.estatus <> 'INACTIVO'
						AND MH.fecha <= '$dteFechaCorte'		
					)";
		}

		$this->db->select("	H.herramienta_id,
							H.codigo,
						    H.descripcion,
						    MH.movimiento_herramienta_id,
						    MH.tipo_movimiento,
						    DATE_FORMAT(MH.fecha, '%d/%m/%Y') AS fecha,
						    MH.folio,
						    MH.mecanico_id,
						    CONCAT(E.codigo, ' - ' , E.nombre, ' ', E.apellido_paterno, ' ', E.apellido_materno) AS mecanico,
						    MH.estatus,
						    MH.observaciones,
						    MHD.cantidad", FALSE);
		$this->db->from('(
							herramientas AS H
						 )');
		$this->db->join($join, 'H.herramienta_id = MHD.herramienta_id', 'left');
		$this->db->join('mecanicos AS M', 'M.mecanico_id = MH.mecanico_id', 'inner');
		$this->db->join('empleados AS E', 'E.empleado_id = M.empleado_id', 'inner');
		$this->db->order_by('MH.mecanico_id, H.herramienta_id, MH.fecha, MH.fecha_creacion', 'ASC');
		return $this->db->get()->result();

	}

}