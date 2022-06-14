<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de vales de caja (para cancelar el cierre de caja)
include_once(APPPATH . 'models/caja/Cajas_vales_model.php');
//Incluir la clase modelo de pagos a caja (para cancelar el cierre de caja)
include_once(APPPATH . 'models/caja/Cajas_pagos_model.php');
//Incluir la clase modelo de ingresos de efectivo a caja (para cancelar el cierre de caja)
include_once(APPPATH . 'models/caja/Cajas_ingresos_model.php');
//Incluir la clase modelo de corte de caja (para cancelar el cierre de caja)
include_once(APPPATH . 'models/caja/Cajas_corte_model.php');

class Cajas_apertura_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objCajaApertura)
	{
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objCajaApertura->intSucursalID,
						  'cuenta_bancaria_id' => $objCajaApertura->intCuentaBancariaID, 
						  'fecha' => $objCajaApertura->dteFecha, 
						  'importe_apertura' => $objCajaApertura->intImporteApertura, 
						  'importe_interno' => $objCajaApertura->intImporteInterno, 
						  'saldo' => $objCajaApertura->intSaldo, 
						  'fecha_creacion' =>  date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objCajaApertura->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('cajas_apertura', $arrDatos);
	}

	//Método para guardar el cierre de caja
	public function guardar_cierre_caja(stdClass $objCajaApertura)
	{
		//Asignar datos al array
		$arrDatos = array('estatus' => 'CERRADA', 
						  'fecha_actualizacion' => $objCajaApertura->dteFecha,
						  'usuario_actualizacion' => $objCajaApertura->intUsuarioID);
		$this->db->where('sucursal_id', $objCajaApertura->intSucursalID);
		$this->db->where('estatus', 'ABIERTA');
		$this->db->limit(1);

		//Actualizar los datos del registro
	    return $this->db->update('cajas_apertura', $arrDatos);
	}


	//Método para cancelar los datos de un registro
	public function set_cancelar($intCajaAperturaID, $intCajaCorteID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (vales de caja) 
        $otdModelCajasVales = new  Cajas_vales_model();
        //Se crea una instancia de la clase modelo (pagos a caja) 
        $otdModelCajasPagos = new  Cajas_pagos_model();
        //Se crea una instancia de la clase modelo (ingresos de efectivo a caja) 
        $otdModelCajasIngresos = new  Cajas_ingresos_model();
        //Se crea una instancia de la clase modelo (corte de caja) 
        $otdModelCajasCorte = new  Cajas_corte_model();

        //Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objCajaApertura = new stdClass();
		//Variables que se utilizan para asignar datos de control
		$objCajaApertura->intCajaAperturaID = $intCajaAperturaID;
		$objCajaApertura->intCajaCorteID = $intCajaCorteID;
		$objCajaApertura->dteFecha = date("Y-m-d H:i:s");
		$objCajaApertura->intSucursalID = $this->session->userdata('sucursal_id');
		$objCajaApertura->intUsuarioID = $this->session->userdata('usuario_id');

		//Tabla cajas_apertura
		//Asignar datos al array
		$arrDatos = array('estatus' => 'CANCELADA',
						  'fecha_eliminacion' => $objCajaApertura->dteFecha,
						  'usuario_eliminacion' =>  $objCajaApertura->intUsuarioID);
		$this->db->where('caja_apertura_id', $objCajaApertura->intCajaAperturaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('cajas_apertura', $arrDatos);

		//Hacer un llamado al método para cancelar el cierre de caja
		$otdModelCajasVales->set_cancelar_cierre_caja($objCajaApertura);

		//Hacer un llamado al método para cancelar el cierre de caja
		$otdModelCajasPagos->set_cancelar_cierre_caja($objCajaApertura);

		//Hacer un llamado al método para cancelar el cierre de caja
		$otdModelCajasIngresos->set_cancelar_cierre_caja($objCajaApertura);

		//Hacer un llamado al método para cancelar el cierre de caja
		$otdModelCajasCorte->set_cancelar_cierre_caja($objCajaApertura);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intCajaAperturaID = NULL, $strEstatus = NULL, $dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL, $intUsuarioID = NULL, $strEstatusRep = NULL, $strBusqueda =  NULL)
	{
		$this->db->select("CA.caja_apertura_id, CA.cuenta_bancaria_id, DATE_FORMAT(CA.fecha,'%d/%m/%Y') AS fecha,
						    DATE_FORMAT(CA.fecha,'%r') AS hora,
						    CA.importe_apertura, CA.importe_interno, CA.saldo, CA.estatus,
						    CASE 
							   WHEN U.empleado_id > 0  
							   THEN  CONCAT(U.usuario,' - ', E.apellido_paterno, ' ', E.apellido_materno,' ', E.nombre)
							   ELSE  U.usuario
						    END AS usuario, 
						    IFNULL((SELECT SUM(CV.importe)
									FROM cajas_vales AS CV 
									WHERE CV.sucursal_id = CA.sucursal_id
									AND CV.caja_corte_id IS NULL
									AND CV.tipo_vale = 'FONDO DE CAJA'
									AND CV.estatus = 'CERRADO'),0) AS importe_cajas_vales,
							IFNULL((SELECT SUM(CVD.subtotal)
									FROM cajas_vales_detalles AS CVD 
									INNER JOIN cajas_vales AS CV ON CVD.caja_vale_id = CV.caja_vale_id
									WHERE CV.sucursal_id = CA.sucursal_id
									AND CV.caja_corte_id IS NULL
									AND CV.tipo_vale = 'FONDO DE CAJA'
									AND CV.estatus = 'CERRADO'
									AND CVD.tipo = 'DEVOLUCION'),0) AS importe_cajas_vales_devoluciones,
							IFNULL((SELECT SUM(CP.importe)
									FROM cajas_pagos AS CP 
									WHERE CP.sucursal_id = CA.sucursal_id
									AND CP.caja_corte_id IS NULL
									AND CP.estatus = 'ACTIVO'),0) AS importe_cajas_pagos,
							IFNULL((SELECT SUM(CI.importe + CI.importe_interno)
									FROM cajas_ingresos AS CI 
									WHERE CI.sucursal_id = CA.sucursal_id
									AND CI.caja_corte_id IS NULL
									AND CI.estatus = 'ACTIVO'),0) AS importe_cajas_ingresos,
							CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria, 
							CC.caja_corte_id", NULL);
		$this->db->from('cajas_apertura AS CA');
		$this->db->join('cuentas_bancarias AS CB', 'CA.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$this->db->join('usuarios AS U', 'CA.usuario_creacion = U.usuario_id', 'inner');
		$this->db->join('empleados AS E', 'U.empleado_id = E.empleado_id', 'left');
		$this->db->join('cajas_corte AS CC', 'CA.caja_apertura_id = CC.caja_apertura_id 
						 AND CC.tipo = "CIERRE"', 'left');
		$this->db->where('CA.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id de la apertura de caja
		if ($intCajaAperturaID !== NULL)
		{   
			$this->db->where('CA.caja_apertura_id', $intCajaAperturaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strEstatus !== NULL)//Si existe estatus
		{
			$this->db->where('CA.estatus', $strEstatus);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			//Si existe id del usuario
		    if($intUsuarioID > 0)
		    {
		   		$this->db->where('CA.usuario_creacion', $intUsuarioID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(CA.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }

		    //Si existe estatus
			if($strEstatusRep != 'TODOS')
			{
				$this->db->where('CA.estatus', $strEstatusRep);
			}

			$this->db->where("((CA.importe_apertura LIKE '%$strBusqueda%') OR
		 				   	   (CA.importe_interno LIKE '%$strBusqueda%') OR
    				           (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
		                       (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))"); 

	    	$this->db->order_by('CA.fecha','DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intUsuarioID = NULL, 
					       $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('CA.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del usuario
	    if($intUsuarioID != NULL)
	    {
	   		$this->db->where('CA.usuario_creacion', $intUsuarioID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(CA.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('CA.estatus', $strEstatus);
		}

		$this->db->where("((CA.importe_apertura LIKE '%$strBusqueda%') OR
		 				   (CA.importe_interno LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))"); 

		$this->db->from('cajas_apertura AS CA');
		$this->db->join('cuentas_bancarias AS CB', 'CA.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$this->db->join('usuarios AS U', 'CA.usuario_creacion = U.usuario_id', 'inner');
		$this->db->join('empleados AS E', 'U.empleado_id = E.empleado_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CA.caja_apertura_id, DATE_FORMAT(CA.fecha,'%d/%m/%Y %r') AS fecha,
						   CONCAT('$',FORMAT(CA.importe_apertura,2)) AS importe_apertura, 
						   CONCAT('$',FORMAT(CA.importe_interno,2)) AS importe_interno, 
						   CONCAT('$',FORMAT(CA.saldo,2)) AS saldo, 
						   CA.estatus,
						   CASE 
						   	   WHEN U.empleado_id > 0  
							   THEN  CONCAT(U.usuario,' - ', E.apellido_paterno, ' ', E.apellido_materno,' ', E.nombre)
							   ELSE  U.usuario
						   END AS usuario, 
						   CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria,
						   CC.caja_corte_id", NULL);
		$this->db->from('cajas_apertura AS CA');
		$this->db->join('cuentas_bancarias AS CB', 'CA.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$this->db->join('usuarios AS U', 'CA.usuario_creacion = U.usuario_id', 'inner');
		$this->db->join('empleados AS E', 'U.empleado_id = E.empleado_id', 'left');
		$this->db->join('cajas_corte AS CC', 'CA.caja_apertura_id = CC.caja_apertura_id 
						 AND CC.tipo = "CIERRE"', 'left');
		$this->db->where('CA.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del usuario
	    if($intUsuarioID != NULL)
	    {
	   		$this->db->where('CA.usuario_creacion', $intUsuarioID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(CA.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
	    if($strEstatus != 'TODOS')
		{
			$this->db->where('CA.estatus', $strEstatus);
		}

		$this->db->where("((CA.importe_apertura LIKE '%$strBusqueda%') OR
		 				   (CA.importe_interno LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))"); 

	    $this->db->order_by('CA.fecha','DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["aperturas"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>