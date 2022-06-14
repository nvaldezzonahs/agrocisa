<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_ordenes_en_proceso_model extends CI_model {
	
	//Método para regresar los registros correspondientes a las Licencias de un empleado
	public function consultar($fecha, $sucursal_id = NULL, $vehiculo_id = NULL, $mecanico_id = NULL)
	{
		$this->db->select(" ORI.orden_reparacion_interna_id,
							ORI.sucursal_id,
					        ORI.folio,
					        DATE_FORMAT(ORI.fecha, '%d/%m/%Y') AS fecha,
					        ORI.vehiculo_id,
					        V.codigo,
					        CONCAT_WS(' - ', V.modelo, V.marca) AS vehiculo,
					        V.placas,
					        ORI.falla,
					        ORI.causa,
					        ORI.solucion ", FALSE);
        $this->db->from('ordenes_reparacion_internas ORI');
        $this->db->join('vehiculos V', 'V.vehiculo_id = ORI.vehiculo_id', 'inner');
	    $this->db->where('ORI.fecha <=', $fecha);
        $this->db->where('ORI.estatus', 'ACTIVO'); 

        //Si se envia una sucursal seleccionada
        if($sucursal_id != '0'){
        	$this->db->where('ORI.sucursal_id', $sucursal_id);
        }

        //Si se envia un vehículo seleccionado
        if($vehiculo_id != '0'){
        	$this->db->where('ORI.vehiculo_id', $vehiculo_id);
        }

        //Si se envia un mecánico seleccionado
        if($mecanico_id != '0'){
        	$this->db->join('ordenes_reparacion_internas_servicios ORIS', 'ORIS.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id', 'inner');
        	$this->db->where('ORIS.mecanico_id', $mecanico_id);
        }  

        $this->db->order_by('ORI.fecha', 'ASC');  
	    return $this->db->get()->result();
	}

}