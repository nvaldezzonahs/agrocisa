<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_vigencias_model extends CI_model {
	
	//Método para regresar los registros correspondientes a las Licencias de un empleado
	public function licencias_vencidas()
	{
		$this->db->select(" CONCAT_WS(' - ', codigo, CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)) AS empleado, 
					        E.licencia_manejo, 
					        E.licencia_tipo,
					        DATE_FORMAT(E.licencia_vigencia, '%d/%m/%Y') AS licencia_vigencia, 
					        DATE_FORMAT(E.licencia_expedicion, '%d/%m/%Y') AS licencia_expedicion,
					        S.nombre AS sucursal,
					        D.descripcion AS departamento,
					        P.descripcion AS puesto ", FALSE);
        $this->db->from('empleados E');
        $this->db->join('sucursales S', 'S.sucursal_id = E.sucursal_id', 'inner');
        $this->db->join('departamentos D', 'D.departamento_id = E.departamento_id', 'inner');
        $this->db->join('puestos P', 'P.puesto_id = E.puesto_id', 'inner');
	    $this->db->where('E.licencia_vigencia < NOW()', NULL, FALSE);
        $this->db->where('E.sucursal_id', $this->session->userdata('sucursal_id'));  
        $this->db->order_by('E.licencia_vigencia', 'ASC');  
	    return $this->db->get()->result();
	}

	public function licencias_vigentes()
	{
		$this->db->select(" CONCAT_WS(' - ', codigo, CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)) AS empleado, 
					        E.licencia_manejo, 
					        E.licencia_tipo,  
					        DATE_FORMAT(E.licencia_vigencia, '%d/%m/%Y') AS licencia_vigencia, 
					        DATE_FORMAT(E.licencia_expedicion, '%d/%m/%Y') AS licencia_expedicion,
					        S.nombre AS sucursal,
					        D.descripcion AS departamento,
					        P.descripcion AS puesto ", FALSE);
        $this->db->from('empleados E');
        $this->db->join('sucursales S', 'S.sucursal_id = E.sucursal_id', 'inner');
        $this->db->join('departamentos D', 'D.departamento_id = E.departamento_id', 'inner');
        $this->db->join('puestos P', 'P.puesto_id = E.puesto_id', 'inner');
	    $this->db->where('E.licencia_vigencia >= NOW()', NULL, FALSE);
        $this->db->where('E.sucursal_id', $this->session->userdata('sucursal_id'));  
        $this->db->order_by('E.licencia_vigencia', 'ASC');  
	    return $this->db->get()->result();
	}

	//Método para regresar los registros correspondientes a las Pólizas de un vehiculo
	public function polizas_vencidas()
	{
		$this->db->select("	codigo, 
							modelo, 
							marca, 
							aseguradora, 
							poliza, 
							costo_poliza, 
							DATE_FORMAT(fecha_renovacion, '%d/%m/%Y') AS fecha_renovacion", FALSE);
        $this->db->from('vehiculos');
	    $this->db->where('fecha_renovacion < NOW()', NULL, FALSE);
        $this->db->order_by('fecha_renovacion', 'ASC');  
	    return $this->db->get()->result();
	}

	public function polizas_vigentes()
	{
		$this->db->select("	codigo, 
							modelo, 
							marca, 
							aseguradora, 
							poliza, 
							costo_poliza, 
							DATE_FORMAT(fecha_renovacion, '%d/%m/%Y') AS fecha_renovacion", FALSE);
        $this->db->from('vehiculos');
	    $this->db->where('fecha_renovacion >= NOW()', NULL, FALSE);
        $this->db->order_by('fecha_renovacion', 'ASC');  
	    return $this->db->get()->result();
	}

	//Método para recuperar un listado de los vehículos activos
	public function vehiculos_activos($verificacion_federal = NULL){

		$this->db->select('	vehiculo_id, 
							codigo, 
							modelo, 
							marca, 
							anio, 
							placas, 
							estado_id');
        $this->db->from('vehiculos');
        //Si existe un tipo de verificación seleccionada
		if ($verificacion_federal !== NULL)
		{   
			$this->db->where('verificacion_federal', $verificacion_federal);
		}
	    $this->db->where('estatus', 'ACTIVO'); 
        $this->db->order_by('codigo','ASC');  
	    return $this->db->get()->result();
	}

	//Método para recuperar un listado de los meses en que aplica la verificación de un automóvil acorde a su placa
	public function meses_aplican($estado_id, $digito){

		$this->db->select('mes');
        $this->db->from('verificaciones_estatales');
	    $this->db->where('estado_id', $estado_id);
	    $this->db->where("digitos LIKE '%$digito%' ");  
        $this->db->order_by('mes','ASC');  
	    return $this->db->get()->result();

	}

	//Método para recuperar un listado de las verificaciones generadas para un vehículo
	public function verificaciones_vehiculo($vehiculo_id, $anio){

		$this->db->select('	verificacion_id,
							vehiculo_id,
							DATE_FORMAT(fecha_verificacion, "%m") AS mes,
							fecha_verificacion', FALSE);
        $this->db->from('verificaciones');
	    $this->db->where('vehiculo_id', $vehiculo_id);
	    $this->db->where('tipo', 'VEHICULAR');
	    $this->db->where('YEAR(fecha_verificacion)', $anio); 
	    $this->db->where('estatus', 'ACTIVO'); 
        $this->db->order_by('mes','ASC');  
	    return $this->db->get()->result();

	}

	//Método para obtener el resultado correspondiente a la verificación de tipo emisiones contaminantes para un vehiculo en un semestre en particular
	public function verificacion_emisiones_contaminantes($vehiculo_id, $anio, $semestre){

		$this->db->select('verificacion_id', FALSE);
        $this->db->from('verificaciones');
	    $this->db->where('vehiculo_id', $vehiculo_id);
	    $this->db->where('YEAR(fecha_verificacion)', $anio); 
	    $this->db->where('tipo', 'EMISIONES CONTAMINANTES');
	    $this->db->where('semestre', $semestre);
	    $this->db->where('estatus', 'ACTIVO');  
	    return $this->db->get()->result();

	}

	//Método para recuperar un listado de los meses en que aplica la verificación mecánica federal de un automóvil acorde a su placa
	public function meses_aplican_verificacion_mecanica($digito){

		$this->db->select('meses');
        $this->db->from('verificaciones_federales');
	    $this->db->where('digito', $digito); 
	    return $this->db->get()->row();

	}

	//Método para recuperar el mes en que se efectuó la verificación mecánica federal de un automóvil
	public function mes_verificado_verificacion_mecanica($vehiculo_id, $anio){

		$this->db->select('DATE_FORMAT(fecha_verificacion, "%m") AS mes');
        $this->db->from('verificaciones');
	    $this->db->where('vehiculo_id', $vehiculo_id);
	    $this->db->where('YEAR(fecha_verificacion)', $anio); 
	    $this->db->where('tipo', 'FISICO MECANICA');
	    $this->db->where('estatus', 'ACTIVO');  
	    return $this->db->get()->result();
	    
	}

}
?>