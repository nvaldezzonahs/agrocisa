<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cajas_ingresos_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objCajaIngreso)
	{
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objCajaIngreso->intSucursalID,
						  'cuenta_bancaria_id' => $objCajaIngreso->intCuentaBancariaID,
						  'fecha' => $objCajaIngreso->dteFecha, 
						  'concepto' => $objCajaIngreso->strConcepto, 
						  'importe' => $objCajaIngreso->intImporte, 
						  'importe_interno' => $objCajaIngreso->intImporteInterno, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objCajaIngreso->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('cajas_ingresos', $arrDatos);
	}

	//Método para guardar el cierre de caja
	public function guardar_cierre_caja(stdClass $objCajaIngreso)
	{
		//Asignar datos al array
		$arrDatos = array('caja_corte_id' =>  $objCajaIngreso->intCajaCorteID, 
						  'fecha_actualizacion' =>  $objCajaIngreso->dteFecha,
						  'usuario_actualizacion' =>  $objCajaIngreso->intUsuarioID);
		$this->db->where('sucursal_id',  $objCajaIngreso->intSucursalID);
		$this->db->where('caja_corte_id IS NULL');
		$this->db->where('estatus', 'ACTIVO');

		//Actualizar los datos del registro
	    return  $this->db->update('cajas_ingresos', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objCajaIngreso)
	{
		//Asignar datos al array
		$arrDatos = array('cuenta_bancaria_id' => $objCajaIngreso->intCuentaBancariaID,
						  'fecha' => $objCajaIngreso->dteFecha, 
						  'concepto' => $objCajaIngreso->strConcepto, 
						  'importe' => $objCajaIngreso->intImporte, 
						  'importe_interno' => $objCajaIngreso->intImporteInterno, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objCajaIngreso->intUsuarioID);
		$this->db->where('caja_ingreso_id', $objCajaIngreso->intCajaIngresoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('cajas_ingresos', $arrDatos);
	}


	//Método para cancelar el cierre de caja
	public function set_cancelar_cierre_caja(stdClass $objCajaIngreso)
	{
	    //Asignar datos al array
		$arrDatos = array('caja_corte_id' => NULL, 
						  'fecha_actualizacion' => $objCajaIngreso->dteFecha,
						  'usuario_actualizacion' => $objCajaIngreso->intUsuarioID);
		$this->db->where('caja_corte_id', $objCajaIngreso->intCajaCorteID);
		//Actualizar los datos del registro
	    return $this->db->update('cajas_ingresos', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intCajaIngresoID, $strEstatus)
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
		$this->db->where('caja_ingreso_id', $intCajaIngresoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('cajas_ingresos', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intCajaIngresoID = NULL, $intCajaCorteID = NULL, $strTipoCajaCorte = NULL,
						   $dteFechaInicial = NULL, $dteFechaFinal = NULL, $strEstatus = NULL, 
						   $strBusqueda =  NULL)
	{

		//Si el tipo de corte de caja es ARQUEO
		if($strTipoCajaCorte == 'ARQUEO')
		{
			$strImportes = " CCAI.importe, CCAI.importe_interno";
		}
		else
		{
			$strImportes = " CI.importe, CI.importe_interno";
		}

		$this->db->select("CI.caja_ingreso_id, DATE_FORMAT(CI.fecha,'%d/%m/%Y') AS fecha, CI.concepto, 
						   $strImportes, CI.caja_corte_id, CI.estatus, ,
						   CB.cuenta_bancaria_id,
						   CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria", FALSE);
		$this->db->from('cajas_ingresos AS CI');
		$this->db->join('cuentas_bancarias AS CB', 'CI.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$this->db->where('CI.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del ingreso de caja
		if ($intCajaIngresoID !== NULL)
		{   
			$this->db->where('CI.caja_ingreso_id', $intCajaIngresoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($intCajaCorteID !== NULL)//Si existe id del corte de caja
		{   
			//Si el tipo de corte de caja es ARQUEO
			if($strTipoCajaCorte == 'ARQUEO')
			{
				$this->db->join('cajas_corte_arqueos AS CCAI', 
						        'CI.caja_ingreso_id = CCAI.referencia_id AND CCAI.tipo = "INGRESO"', 'inner');
				$this->db->where('CCAI.caja_corte_id', $intCajaCorteID);
			}
			else
			{
				$this->db->where('CI.caja_corte_id', $intCajaCorteID);
			}
			
			$this->db->order_by('CI.fecha', 'DESC');
			return $this->db->get()->result();
		}
		else 
		{
			//Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("(CI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('CI.estatus', $strEstatus);
			}

			$this->db->where("((CI.concepto LIKE '%$strBusqueda%') OR
							   (CI.importe LIKE '%$strBusqueda%') OR
		 				   	   (CI.importe_interno LIKE '%$strBusqueda%') OR
    				           (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
		                       (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('CI.fecha', 'DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que se encuentran activos (se utilizan para guardar un arqueo de caja)
	public function buscar_ingresos_arqueo_caja()
	{
		$this->db->select('caja_ingreso_id, importe, importe_interno');
		$this->db->from('cajas_ingresos');
		$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('caja_corte_id IS NULL');
		$this->db->where('estatus', 'ACTIVO');
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $strEstatus = NULL, 
						   $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('CI.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(CI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('CI.estatus', $strEstatus);
		}

		$this->db->where("((CI.concepto LIKE '%$strBusqueda%') OR
						   (CI.importe LIKE '%$strBusqueda%') OR
	 				   	   (CI.importe_interno LIKE '%$strBusqueda%') OR
				           (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
	                       (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))"); 

		$this->db->from('cajas_ingresos AS CI');
		$this->db->join('cuentas_bancarias AS CB', 'CI.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CI.caja_ingreso_id, DATE_FORMAT(CI.fecha,'%d/%m/%Y') AS fecha, CI.concepto,
						   CI.caja_corte_id, CI.estatus, CONCAT('$',FORMAT(CI.importe,2)) AS importe, 
						   CONCAT('$',FORMAT(CI.importe_interno,2)) AS importe_interno, 
						   CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria", FALSE);
		$this->db->from('cajas_ingresos AS CI');
		$this->db->join('cuentas_bancarias AS CB', 'CI.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$this->db->where('CI.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(CI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('CI.estatus', $strEstatus);
		}

		$this->db->where("((CI.concepto LIKE '%$strBusqueda%') OR
						   (CI.importe LIKE '%$strBusqueda%') OR
	 				   	   (CI.importe_interno LIKE '%$strBusqueda%') OR
				           (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
	                       (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('CI.fecha', 'DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["ingresos"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>