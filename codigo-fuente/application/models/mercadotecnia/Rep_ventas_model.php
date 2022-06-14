<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_ventas_model extends CI_model {
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function venta_maquinaria($dteFechaInicial, $dteFechaFinal)
	{
		$this->db->select('	FM.folio,
							DATE_FORMAT(FM.fecha,"%d/%m/%Y") AS fecha,
							FM.razon_social,
							P.telefono_principal,
							P.correo_electronico,
							CONCAT_WS(" ", E.nombre, E.apellido_paterno, E.apellido_materno) AS vendedor, 
							FM.localidad, 
							FM.municipio,
							ML.descripcion AS linea, 
							FM.descripcion_corta');
		$this->db->from('facturas_maquinaria FM');
		$this->db->join('prospectos AS P', 'P.prospecto_id = FM.prospecto_id', 'inner');
		$this->db->join('vendedores AS V', 'V.vendedor_id = FM.vendedor_id', 'inner');
		$this->db->join('empleados AS E', 'E.empleado_id = V.empleado_id', 'inner');
		$this->db->join('maquinaria_descripciones AS MD', 'MD.maquinaria_descripcion_id = FM.maquinaria_descripcion_id', 'inner');
		$this->db->join('maquinaria_lineas AS ML', 'ML.maquinaria_linea_id = MD.maquinaria_linea_id', 'inner');
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("(FM.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
		
		return $this->db->get()->result();

	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function venta_refacciones($dteFechaInicial, $dteFechaFinal)
	{
		$this->db->select('	FR.folio,
							FR.razon_social,
							FR.localidad,
							FR.municipio,
							P.telefono_principal,
							P.correo_electronico,
							DATE_FORMAT(FR.fecha, "%d/%m/%Y") AS fecha,
							FRD.cantidad,
							FRD.descripcion AS producto,
					        CONCAT_WS(" ", E.nombre, E.apellido_paterno, E.apellido_materno) AS vendedor');
		$this->db->from('facturas_refacciones_detalles FRD');
		$this->db->join('facturas_refacciones AS FR', 'FR.factura_refacciones_id = FRD.factura_refacciones_id', 'inner');
		$this->db->join('prospectos AS P', 'P.prospecto_id = FR.prospecto_id', 'inner');
		$this->db->join('vendedores AS V', 'V.vendedor_id = FR.vendedor_id', 'inner');
		$this->db->join('empleados AS E', 'E.empleado_id = V.empleado_id', 'inner');
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("(FR.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
		
		return $this->db->get()->result();

	}
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function venta_servicio($dteFechaInicial, $dteFechaFinal)
	{
		$this->db->select('	FS.folio,
							FS.razon_social,
					        FS.localidad,
					        FS.municipio,
					        P.telefono_principal,
					        P.correo_electronico,
					        DATE_FORMAT(FS.fecha, "%d/%m/%Y") AS fecha,
					        ML.descripcion AS linea,
					        MD.descripcion_corta AS equipo,
					        ORS.horas AS servicio_horas,
					        CONCAT_WS(" ", E.nombre, E.apellido_paterno, E.apellido_materno) AS mecanico');
		$this->db->from('facturas_servicio FS');
		$this->db->join('prospectos P', 'P.prospecto_id = FS.prospecto_id', 'inner');
		$this->db->join('ordenes_reparacion OREP', 'OREP.orden_reparacion_id = FS.orden_reparacion_id', 'inner');
		$this->db->join('maquinaria_descripciones MD', 'MD.maquinaria_descripcion_id = OREP.maquinaria_descripcion_id', 'inner');
		$this->db->join('maquinaria_lineas ML', 'ML.maquinaria_linea_id = MD.maquinaria_linea_id', 'inner');
		$this->db->join('ordenes_reparacion_servicios ORS', 'ORS.orden_reparacion_id = FS.orden_reparacion_id', 'inner');
		$this->db->join('empleados E', 'E.empleado_id = ORS.mecanico_id', 'inner');
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("(FS.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
		
		return $this->db->get()->result();

	}

}
?>