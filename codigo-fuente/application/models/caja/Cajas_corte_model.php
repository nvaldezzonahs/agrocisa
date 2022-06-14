<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de vales de caja (para guardar el cierre o arqueo de caja)
include_once(APPPATH . 'models/caja/Cajas_vales_model.php');
//Incluir la clase modelo de pagos a caja (para guardar el cierre o arqueo de caja)
include_once(APPPATH . 'models/caja/Cajas_pagos_model.php');
//Incluir la clase modelo de ingresos de efectivo a caja (para guardar el cierre o arqueo de caja)
include_once(APPPATH . 'models/caja/Cajas_ingresos_model.php');
//Incluir la clase modelo de apertura de caja (para guardar el cierre o arqueo de caja)
include_once(APPPATH . 'models/caja/Cajas_apertura_model.php');


class Cajas_corte_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla cajas_corte
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objCajaCorte)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		
		//Tabla cajas_corte
		//Asignar datos al array
		$arrDatos = array('caja_apertura_id' => $objCajaCorte->intCajaAperturaID,
						  'fecha' =>  $objCajaCorte->dteFecha,
						  'usuario_realiza' => $objCajaCorte->intUsuarioID, 
						  'tipo' => $objCajaCorte->strTipo,  
						  'importe_teorico' => $objCajaCorte->intImporteTeorico,  
						  'mil' => $objCajaCorte->intMil, 
						  'quinientos' => $objCajaCorte->intQuinientos, 
						  'doscientos' => $objCajaCorte->intDoscientos, 
						  'cien' => $objCajaCorte->intCien, 
						  'cincuenta' => $objCajaCorte->intCincuenta, 
						  'veinte' => $objCajaCorte->intVeinte,
						  'diez' => $objCajaCorte->intDiez, 
						  'cinco' => $objCajaCorte->intCinco, 
						  'dos' => $objCajaCorte->intDos, 
						  'uno' => $objCajaCorte->intUno, 
						  'cincuenta_centavos' => $objCajaCorte->intCincuentaCentavos, 
						  'veinte_centavos' => $objCajaCorte->intVeinteCentavos, 
						  'diez_centavos' => $objCajaCorte->intDiezCentavos, 
						  'cinco_centavos' => $objCajaCorte->intCincoCentavos, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objCajaCorte->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('cajas_corte', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objCajaCorte->intCajaCorteID = $this->db->insert_id();

		//Si el tipo de corte es cierre
		if($objCajaCorte->strTipo == 'CIERRE')
		{
			//Hacer un llamado al método para guardar el corte de caja en las tablas relacionadas
       		$this->guardar_cierre($objCajaCorte);
		}
		else
		{
			//Hacer un llamado al método para guardar el arqueo de caja
       		$this->guardar_arqueo($objCajaCorte);
		}

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Función que se utiliza para guardar el corte de caja en las tablas: cajas_vales, cajas_pagos, cajas_ingresos y cajas_apertura
	public function guardar_cierre(stdClass $objCajaCorte)
	{
		//Se crea una instancia de la clase modelo (vales de caja) 
        $otdModelCajasVales = new  Cajas_vales_model();
        //Se crea una instancia de la clase modelo (pagos a caja) 
        $otdModelCajasPagos = new  Cajas_pagos_model();
        //Se crea una instancia de la clase modelo (ingresos de efectivo a caja) 
        $otdModelCajasIngresos = new  Cajas_ingresos_model();
        //Se crea una instancia de la clase modelo (apertura de caja) 
        $otdModelCajasApertura = new  Cajas_apertura_model();

		//Hacer un llamado al método para guardar el cierre de caja
		$otdModelCajasVales->guardar_cierre_caja($objCajaCorte);

		//Hacer un llamado al método para guardar el cierre de caja
		$otdModelCajasPagos->guardar_cierre_caja($objCajaCorte);

		//Hacer un llamado al método para guardar el cierre de caja
		$otdModelCajasIngresos->guardar_cierre_caja($objCajaCorte);

		//Hacer un llamado al método para guardar el cierre de caja
		$otdModelCajasApertura->guardar_cierre_caja($objCajaCorte);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objCajaCorte)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla cajas_corte
		//Asignar datos al array
		$arrDatos = array('fecha' => $objCajaCorte->dteFecha,
						  'usuario_realiza' => $objCajaCorte->intUsuarioID, 
						  'tipo' => $objCajaCorte->strTipo,  
						  'importe_teorico' => $objCajaCorte->intImporteTeorico,  
						  'mil' => $objCajaCorte->intMil, 
						  'quinientos' => $objCajaCorte->intQuinientos, 
						  'doscientos' => $objCajaCorte->intDoscientos, 
						  'cien' => $objCajaCorte->intCien, 
						  'cincuenta' => $objCajaCorte->intCincuenta, 
						  'veinte' => $objCajaCorte->intVeinte,
						  'diez' => $objCajaCorte->intDiez, 
						  'cinco' => $objCajaCorte->intCinco, 
						  'dos' => $objCajaCorte->intDos, 
						  'uno' => $objCajaCorte->intUno, 
						  'cincuenta_centavos' => $objCajaCorte->intCincuentaCentavos, 
						  'veinte_centavos' => $objCajaCorte->intVeinteCentavos, 
						  'diez_centavos' => $objCajaCorte->intDiezCentavos, 
						  'cinco_centavos' => $objCajaCorte->intCincoCentavos, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objCajaCorte->intUsuarioID);
		//Guardar los datos del registro
		$this->db->where('caja_corte_id', $objCajaCorte->intCajaCorteID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('cajas_corte', $arrDatos);

		//Si el tipo de corte es cierre
		if($objCajaCorte->strTipo == 'CIERRE')
		{
			//Hacer un llamado al método para guardar el corte de caja en las tablas relacionadas
       		$this->guardar_cierre($objCajaCorte);
		}
		else
		{
			//Hacer un llamado al método para guardar el arqueo de caja
       		$this->guardar_arqueo($objCajaCorte);
		}

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intCajaCorteID, $strEstatus)
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
		$this->db->where('caja_corte_id', $intCajaCorteID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('cajas_corte', $arrDatos);
	}


	//Método para cancelar el cierre de caja
	public function set_cancelar_cierre_caja(stdClass $objCajaCorte)
	{
	    //Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO', 
						  'fecha_eliminacion' => $objCajaCorte->dteFecha,
						  'usuario_eliminacion' => $objCajaCorte->intUsuarioID);
		$this->db->where('caja_apertura_id', $objCajaCorte->intCajaAperturaID);
		//Actualizar los datos del registro
	    return $this->db->update('cajas_corte', $arrDatos);
	}
	

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intCajaCorteID = NULL, $dteFechaInicial = NULL,  $dteFechaFinal = NULL,  
						   $intUsuarioID = NULL, $strTipo = NULL, $strUltimoCierre = NULL)
	{
		$this->db->select("CC.caja_corte_id, CC.caja_apertura_id, DATE_FORMAT(CC.fecha,'%d/%m/%Y') AS fecha, 
			 			   DATE_FORMAT(CC.fecha,'%r') AS hora, 
			 			   CASE 
							   WHEN U.empleado_id > 0  
							   THEN  CONCAT(U.usuario,' - ', E.apellido_paterno, ' ', E.apellido_materno,' ', E.nombre)
							   ELSE  U.usuario
						    END AS usuario, CC.tipo, CC.importe_teorico, CC.mil, CC.quinientos, CC.doscientos,
						    CC.cien, CC.cincuenta, CC.veinte, CC.diez, CC.cinco, CC.dos, CC.uno, CC.cincuenta_centavos,
						    CC.veinte_centavos,CC.diez_centavos, CC.cinco_centavos, CC.estatus, 
						    CA.importe_apertura, CA.importe_interno, CA.saldo, 
						    CA.estatus AS estatus_caja_apertura", FALSE);
		$this->db->from('cajas_corte AS CC');
		$this->db->join('cajas_apertura AS CA', 'CC.caja_apertura_id = CA.caja_apertura_id', 'inner');
		$this->db->join('usuarios AS U', 'CC.usuario_realiza = U.usuario_id', 'inner');
		$this->db->join('empleados AS E', 'U.empleado_id = E.empleado_id', 'left');
		//Si existe id del corte de caja
		if ($intCajaCorteID !== NULL)
		{   
			$this->db->where('CC.caja_corte_id', $intCajaCorteID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->where('CA.sucursal_id', $this->session->userdata('sucursal_id'));
		    
		    //Si se cumple la sentencia (seleccionar los datos del último cierre de caja)
		    if($strUltimoCierre !== NULL)
		    {
		    	$this->db->where('CC.tipo', 'CIERRE');
		    	$this->db->where('CC.estatus', 'ACTIVO');
		    	$this->db->where("CC.caja_corte_id = (SELECT  MAX(CCU.caja_corte_id)
													  FROM  cajas_corte AS CCU
								                      INNER JOIN cajas_apertura AS CAU ON CCU.caja_apertura_id = CAU.caja_apertura_id
								                      WHERE CAU.sucursal_id = CA.sucursal_id
								                      AND CCU.tipo = CC.tipo
								                      AND CCU.estatus = CC.estatus)", NULL, FALSE);
		    	$this->db->limit(1);
				return $this->db->get()->row();
		    }
		    else
		    {

		    	//Si existe id del usuario
			    if($intUsuarioID > 0)
			    {
			   		$this->db->where('CC.usuario_realiza', $intUsuarioID);
			    }
			    //Si existe tipo
			    if($strTipo != '')
			    {
			   		$this->db->where('CC.tipo', $strTipo);
			    }
				//Si existe rango de fechas
			    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
			    {

			   		$this->db->where("(DATE_FORMAT(CC.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);

			    } 
				$this->db->order_by('CC.fecha', 'DESC');
				return $this->db->get()->result();
		    }
		    
			
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intUsuarioID = NULL, 
						   $strTipo = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('CA.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del usuario
	    if($intUsuarioID != NULL)
	    {
	   		$this->db->where('CC.usuario_realiza', $intUsuarioID);
	    }
	    //Si existe tipo
	    if($strTipo != NULL)
	    {
	   		$this->db->where('CC.tipo', $strTipo);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(CC.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
		$this->db->from('cajas_corte AS CC');
		$this->db->join('cajas_apertura AS CA', 'CC.caja_apertura_id = CA.caja_apertura_id', 'inner');
		$this->db->join('usuarios AS U', 'CC.usuario_realiza = U.usuario_id', 'inner');
		$this->db->join('empleados AS E', 'U.empleado_id = E.empleado_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CC.caja_corte_id, DATE_FORMAT(CC.fecha,'%d/%m/%Y %r') AS fecha, CC.tipo, CC.estatus,
						   CASE 
						   	   WHEN U.empleado_id > 0  
							   THEN  CONCAT(U.usuario,' - ', E.apellido_paterno, ' ', E.apellido_materno,' ', E.nombre)
							   ELSE  U.usuario
						   END AS usuario, CA.estatus AS estatus_caja_apertura", FALSE);
		$this->db->from('cajas_corte AS CC');
		$this->db->join('cajas_apertura AS CA', 'CC.caja_apertura_id = CA.caja_apertura_id', 'inner');
		$this->db->join('usuarios AS U', 'CC.usuario_realiza = U.usuario_id', 'inner');
		$this->db->join('empleados AS E', 'U.empleado_id = E.empleado_id', 'left');
		$this->db->where('CA.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del usuario
	    if($intUsuarioID != NULL)
	    {
	   		$this->db->where('CC.usuario_realiza', $intUsuarioID);
	    }
	    //Si existe tipo
	    if($strTipo != NULL)
	    {
	   		$this->db->where('CC.tipo', $strTipo);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(CC.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
		$this->db->order_by('CC.fecha', 'DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["cortes"] =$this->db->get()->result();
		return $arrResultado;
	}

	/*******************************************************************************************************************
	Funciones de la tabla cajas_corte_arqueos
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles del arqueo de caja
	public function guardar_arqueo(stdClass $objCajaCorte)
	{
		//Se crea una instancia de la clase modelo (vales de caja) 
        $otdModelCajasVales = new  Cajas_vales_model();
        //Se crea una instancia de la clase modelo (pagos a caja) 
        $otdModelCajasPagos = new  Cajas_pagos_model();
        //Se crea una instancia de la clase modelo (ingresos de efectivo a caja) 
        $otdModelCajasIngresos = new  Cajas_ingresos_model();

		//Seleccionar los datos de los vales caja que se encuentran cerrados
		$otdValesCaja = $otdModelCajasVales->buscar_vales_arqueo_caja();
		//Seleccionar los datos de los ingresos de caja que se encuentran activos
		$otdIngresosCaja = $otdModelCajasIngresos->buscar_ingresos_arqueo_caja();
		//Seleccionar los datos de los pagos de caja que se encuentran activos
		$otdPagosCaja = $otdModelCajasPagos->buscar_pagos_arqueo_caja();

		//Verificar si hay información de los vales de caja
		if($otdValesCaja)
		{
			//Recorremos el arreglo 
			foreach ($otdValesCaja as $arrCol)
			{
				//Asignar renglón consecutivo
				$intRenglon = $this->get_renglon_consecutivo($objCajaCorte->intCajaCorteID);
				//Asignar el importe de devoluciones
				$intImporteDevolucion = $arrCol->importe_devolucion;
				//Asignar el id del vale de caja 
				$intCajaValeID = $arrCol->caja_vale_id;

				//Tabla cajas_corte_arqueos
				//Asignar datos al array
				$arrDatos = array('caja_corte_id' => $objCajaCorte->intCajaCorteID,
								  'renglon' => $intRenglon, 
								  'tipo' => 'VALE', 
								  'referencia_id' => $intCajaValeID, 
								  'importe' => $arrCol->importe);
				//Guardar los datos del registro
				$this->db->insert('cajas_corte_arqueos', $arrDatos);

				//Si existe importe de devolución
				if($intImporteDevolucion > 0)
				{
					//Asignar renglón consecutivo
					$intRenglon = $this->get_renglon_consecutivo($objCajaCorte->intCajaCorteID);
					//Tabla cajas_corte_arqueos
					//Asignar datos al array
					$arrDatos = array('caja_corte_id' => $objCajaCorte->intCajaCorteID,
									  'renglon' => $intRenglon, 
									  'tipo' => 'DEVOLUCION', 
									  'referencia_id' => $intCajaValeID, 
									  'importe' => $intImporteDevolucion);
					//Guardar los datos del registro
					$this->db->insert('cajas_corte_arqueos', $arrDatos);

				}
			}

		}//Cierre de verificación de vales
		
		//Verificar si hay información de los pagos de caja
		if($otdPagosCaja)
		{
			//Recorremos el arreglo 
			foreach ($otdPagosCaja as $arrCol)
			{
				//Asignar renglón consecutivo
				$intRenglon = $this->get_renglon_consecutivo($objCajaCorte->intCajaCorteID);

				//Tabla cajas_corte_arqueos
				//Asignar datos al array
				$arrDatos = array('caja_corte_id' => $objCajaCorte->intCajaCorteID,
								  'renglon' => $intRenglon, 
								  'tipo' => 'PAGO', 
								  'referencia_id' => $arrCol->caja_pago_id, 
								  'importe' => $arrCol->importe);
				//Guardar los datos del registro
				$this->db->insert('cajas_corte_arqueos', $arrDatos);
			}

		}//Cierre de verificación de ingresos de caja

		//Verificar si hay información de los ingresos de caja
		if($otdIngresosCaja)
		{
			//Recorremos el arreglo 
			foreach ($otdIngresosCaja as $arrCol)
			{
				//Asignar renglón consecutivo
				$intRenglon = $this->get_renglon_consecutivo($objCajaCorte->intCajaCorteID);

				//Tabla cajas_corte_arqueos
				//Asignar datos al array
				$arrDatos = array('caja_corte_id' => $objCajaCorte->intCajaCorteID,
								  'renglon' => $intRenglon, 
								  'tipo' => 'INGRESO', 
								  'referencia_id' => $arrCol->caja_ingreso_id, 
								  'importe' => $arrCol->importe, 
								  'importe_interno' => $arrCol->importe_interno);
				//Guardar los datos del registro
				$this->db->insert('cajas_corte_arqueos', $arrDatos);
			}

		}//Cierre de verificación de ingresos de caja
	}

	//Función que se utiliza para regresar el renglón consecutivo 
	public function get_renglon_consecutivo($intCajaCorteID)
	{
		//Variable que se utiliza para asignar el id del renglón 
	  	$intRenglon = 0;
	    //Seleccionar el renglón máximo que coincide con el id del corte de caja 
		//en la tabla cajas_corte_arqueos
	    $this->db->select('MAX(renglon) AS renglon');
		$this->db->from('cajas_corte_arqueos');
		$this->db->where('caja_corte_id', $intCajaCorteID);
		$this->db->limit(1);
		//Si existen datos
		if ($row = $this->db->get()->row())
		{
			//Asignar valor del renglon
		    $intRenglon = $row->renglon;
			//si devuelve nulo asignar el valor de 1
			if($intRenglon=='null')
		    {
		    	$intRenglon = 1;
		    }
		    else
		    {
		    	//Incrementar el valor del renglon a 1
		    	$intRenglon = ($intRenglon + 1);

		    }
		}
		//Regresar renglón consecutivo
		return $intRenglon;
	}
}
?>