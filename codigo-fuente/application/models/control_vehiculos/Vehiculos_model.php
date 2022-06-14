<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehiculos_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objVehiculo)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objVehiculo->strCodigo, 
						  'modelo' => $objVehiculo->strModelo,
						  'marca' => $objVehiculo->strMarca,
						  'anio' => $objVehiculo->strAnio,
						  'serie' => $objVehiculo->strSerie,
						  'placas' => $objVehiculo->strPlacas,
						  'estado_id' => $objVehiculo->intEstadoID,
						  'costo' => $objVehiculo->intCosto,
						  'kilometraje' => $objVehiculo->intKilometraje,
						  'responsable_id' => $objVehiculo->intResponsableID,
						  'modulo_id' => $objVehiculo->intModuloID,
						  'departamento_id' => $objVehiculo->intDepartamentoID,
						  'sucursal_id' => $objVehiculo->intSucursalID,
						  'aseguradora' => $objVehiculo->strAseguradora,
						  'poliza' => $objVehiculo->strPoliza,
						  'fecha_renovacion' => $objVehiculo->dteFechaRenovacion,
						  'costo_poliza' => $objVehiculo->intCostoPoliza,
						  'verificacion_federal' => $objVehiculo->strVerificacionFederal,
						  'observaciones' => $objVehiculo->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objVehiculo->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('vehiculos', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objVehiculo)
	{
		//Asignar datos al array
		$arrDatos = array('codigo' => $objVehiculo->strCodigo, 
						  'modelo' => $objVehiculo->strModelo,
						  'marca' => $objVehiculo->strMarca,
						  'anio' => $objVehiculo->strAnio,
						  'serie' => $objVehiculo->strSerie,
						  'placas' => $objVehiculo->strPlacas,
						  'estado_id' => $objVehiculo->intEstadoID,
						  'costo' => $objVehiculo->intCosto,
						  'kilometraje' => $objVehiculo->intKilometraje,
						  'responsable_id' => $objVehiculo->intResponsableID,
						  'modulo_id' => $objVehiculo->intModuloID,
						  'departamento_id' => $objVehiculo->intDepartamentoID,
						  'sucursal_id' => $objVehiculo->intSucursalID,
						  'aseguradora' => $objVehiculo->strAseguradora,
						  'poliza' => $objVehiculo->strPoliza,
						  'fecha_renovacion' => $objVehiculo->dteFechaRenovacion,
						  'costo_poliza' => $objVehiculo->intCostoPoliza,
						  'verificacion_federal' => $objVehiculo->strVerificacionFederal,
						  'observaciones' => $objVehiculo->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objVehiculo->intUsuarioID);
		$this->db->where('vehiculo_id', $objVehiculo->intVehiculoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('vehiculos', $arrDatos);
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intVehiculoID, $strEstatus)
	{
		//Si el estatus del registro es ACTIVO
		if($strEstatus == 'ACTIVO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'),
							  'fecha_eliminacion' => NULL,
							  'usuario_eliminacion' => NULL);
		}
		else 
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_eliminacion' => date("Y-m-d H:i:s"),
							  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		}
		$this->db->where('vehiculo_id', $intVehiculoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('vehiculos', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intVehiculoID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select("V.vehiculo_id, V.codigo, V.modelo, V.marca, V.anio,
						   V.serie, V.placas, V.estado_id, V.costo, V.kilometraje,
						   V.responsable_id, V.modulo_id, V.departamento_id,
						   V.sucursal_id, V.aseguradora, V.poliza,
						   DATE_FORMAT(V.fecha_renovacion,'%d/%m/%Y') AS fecha_renovacion,
						   V.costo_poliza, V.verificacion_federal, V.observaciones, V.estatus,
 						   CONCAT(EM.apellido_paterno,' ', EM.apellido_materno,' ', EM.nombre) AS responsable,
 						   EM.licencia_manejo, EM.licencia_tipo, 
 						   DATE_FORMAT(EM.licencia_vigencia,'%d/%m/%Y') AS licencia_vigencia, 
						   D.descripcion AS departamento, S.nombre AS sucursal,
						   CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado, M.descripcion AS modulo,
						   CASE 
							 WHEN  V.sucursal_id > 0 
							    THEN ''
							 ELSE 'SI' 
						   END AS corporativo");
		$this->db->from('vehiculos V');
		$this->db->join('empleados AS EM', 'V.responsable_id = EM.empleado_id', 'inner');
		$this->db->join('sat_estados AS E', 'V.estado_id = E.estado_id', 'inner');
		$this->db->join('departamentos AS D', 'V.departamento_id = D.departamento_id', 'inner');
		$this->db->join('sucursales AS S', 'V.sucursal_id = S.sucursal_id', 'left');
		$this->db->join('modulos AS M', 'V.modulo_id = M.modulo_id', 'left');
		//Si existe id del vehículo
		if ($intVehiculoID !== NULL)
		{   
			$this->db->where('V.vehiculo_id', $intVehiculoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigo !== NULL)//Si existe código
		{
			$this->db->where('V.codigo', $strCodigo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->like('V.codigo', $strBusqueda);
			$this->db->or_like('V.modelo', $strBusqueda); 
	        $this->db->or_like('V.estatus', $strBusqueda);  
			$this->db->order_by('V.codigo', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('V.codigo', $strBusqueda);
		$this->db->or_like('V.modelo', $strBusqueda); 
	    $this->db->or_like('V.estatus', $strBusqueda);
		$this->db->from('vehiculos AS V');
		$this->db->join('empleados AS EM', 'EM.empleado_id = V.responsable_id', 'inner');
		$this->db->join('sat_estados AS E', 'E.estado_id = V.estado_id', 'inner');
		$this->db->join('departamentos AS D', 'D.departamento_id = V.departamento_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('V.vehiculo_id, V.codigo, V.modelo, V.marca, V.placas, V.estatus');
		$this->db->from('vehiculos AS V');
		$this->db->join('empleados AS EM', 'EM.empleado_id = V.responsable_id', 'inner');
		$this->db->join('sat_estados AS E', 'E.estado_id = V.estado_id', 'inner');
		$this->db->join('departamentos AS D', 'D.departamento_id = V.departamento_id', 'inner');
		$this->db->like('V.codigo', $strBusqueda);
		$this->db->or_like('V.modelo', $strBusqueda); 
	    $this->db->or_like('V.estatus', $strBusqueda); 
		$this->db->order_by('V.codigo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["vehiculos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" vehiculo_id, CONCAT_WS(' ', codigo, '-', modelo, marca, placas) AS vehiculo ", FALSE);
        $this->db->from('vehiculos');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(codigo LIKE '%$strDescripcion%' OR 
    					   modelo LIKE '%$strDescripcion%' OR
    					   marca LIKE '%$strDescripcion%' OR
    					   placas LIKE '%$strDescripcion%')");  
        $this->db->order_by("codigo",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>