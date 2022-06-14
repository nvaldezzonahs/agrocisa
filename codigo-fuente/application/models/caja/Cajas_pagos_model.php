<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Cajas_pagos_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla cajas_pagos
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objCajaPago)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objCajaPago->strFolio);

		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objCajaPago->intSucursalID,
						  'folio' => $strFolioConsecutivo,
						  'fecha' => $objCajaPago->dteFecha, 
						  'empleado_id' => $objCajaPago->intEmpleadoID, 
						  'caja_vale_id' => $objCajaPago->intCajaValeID, 
						  'importe' => $objCajaPago->intImporte, 
						  'observaciones' => $objCajaPago->strObservaciones, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objCajaPago->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('cajas_pagos', $arrDatos);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para guardar el cierre de caja
	public function guardar_cierre_caja(stdClass $objCajaPago)
	{
	    //Asignar datos al array
		$arrDatos = array('caja_corte_id' => $objCajaPago->intCajaCorteID, 
						  'fecha_actualizacion' => $objCajaPago->dteFecha,
						  'usuario_actualizacion' => $objCajaPago->intUsuarioID);
		$this->db->where('sucursal_id', $objCajaPago->intSucursalID);
		$this->db->where('caja_corte_id IS NULL');
		$this->db->where('estatus', 'ACTIVO');

		//Actualizar los datos del registro
	    return $this->db->update('cajas_pagos', $arrDatos);
	}


	//Método para cancelar el cierre de caja
	public function set_cancelar_cierre_caja(stdClass $objCajaPago)
	{
	    //Asignar datos al array
		$arrDatos = array('caja_corte_id' => NULL, 
						  'fecha_actualizacion' => $objCajaPago->dteFecha,
						  'usuario_actualizacion' => $objCajaPago->intUsuarioID);
		$this->db->where('caja_corte_id', $objCajaPago->intCajaCorteID);
		//Actualizar los datos del registro
	    return $this->db->update('cajas_pagos', $arrDatos);
	}

	
	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objCajaPago)
	{
		//Asignar datos al array
		$arrDatos = array('fecha' =>  $objCajaPago->dteFecha, 
						  'empleado_id' =>  $objCajaPago->intEmpleadoID, 
						  'caja_vale_id' =>  $objCajaPago->intCajaValeID, 
						  'importe' =>  $objCajaPago->intImporte, 
						  'observaciones' =>  $objCajaPago->strObservaciones, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objCajaPago->intUsuarioID);
		$this->db->where('caja_pago_id', $objCajaPago->intCajaPagoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('cajas_pagos', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intCajaPagoID, $strEstatus)
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
		$this->db->where('caja_pago_id', $intCajaPagoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('cajas_pagos', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intCajaPagoID = NULL, $intCajaCorteID = NULL, $strTipoCajaCorte = NULL,
						   $dteFechaInicial = NULL, $dteFechaFinal = NULL, $intEmpleadoID = NULL)
	{
		//Si el tipo de corte de caja es ARQUEO
		if($strTipoCajaCorte == 'ARQUEO')
		{
			$strImporte = " CCAP.importe";
		}
		else
		{
			$strImporte = " CP.importe";
		}

		$this->db->select("CP.caja_pago_id, CP.folio, DATE_FORMAT(CP.fecha,'%d/%m/%Y') AS fecha, CP.empleado_id, 
						   CP.caja_vale_id, $strImporte, CP.observaciones, CP.caja_corte_id, CP.estatus, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
						   CONCAT_WS(' - ', CV.folio, CV.tipo_vale) AS caja_vale, CV.folio AS folio_vale,
						   (CV.importe -
							 IFNULL((SELECT SUM(CVD.subtotal + CVD.iva + CVD.ieps) 
									 FROM cajas_vales_detalles AS CVD
									 WHERE CVD.caja_vale_id = CV.caja_vale_id), 0) -
							  IFNULL((SELECT SUM(CP.importe)
									  FROM cajas_pagos AS CP
									  WHERE CV.caja_vale_id = CP.caja_vale_id
									  AND CP.estatus = 'ACTIVO'), 0)) AS saldo, 
							UC.usuario AS usuario_creacion", FALSE);
		$this->db->from('cajas_pagos AS CP');
		$this->db->join('empleados AS E', 'CP.empleado_id = E.empleado_id', 'inner');
		$this->db->join('cajas_vales AS CV', 'CP.caja_vale_id = CV.caja_vale_id', 'inner');
		$this->db->join('usuarios AS UC', 'CP.usuario_creacion = UC.usuario_id', 'left');
		$this->db->where('CP.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del pago de caja
		if ($intCajaPagoID !== NULL)
		{   
			$this->db->where('CP.caja_pago_id', $intCajaPagoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($intCajaCorteID !== NULL)//Si existe id del corte de caja
		{   
			//Si el tipo de corte de caja es ARQUEO
			if($strTipoCajaCorte == 'ARQUEO')
			{
				$this->db->join('cajas_corte_arqueos AS CCAP', 
						        'CP.caja_pago_id = CCAP.referencia_id AND CCAP.tipo = "PAGO"', 'inner');
				$this->db->where('CCAP.caja_corte_id', $intCajaCorteID);
			}
			else
			{
				$this->db->where('CP.caja_corte_id', $intCajaCorteID);
			}
			
			$this->db->order_by('CP.fecha', 'DESC');
			return $this->db->get()->result();
		}
		else 
		{
		    //Si existe id del empleado
		 	if($intEmpleadoID > 0)
		    {
		   		$this->db->where('CP.empleado_id', $intEmpleadoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("(CP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 
			$this->db->order_by('CP.fecha DESC, CP.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que se encuentran activos (se utilizan para guardar un arqueo de caja)
	public function buscar_pagos_arqueo_caja()
	{
		$this->db->select('caja_pago_id, importe');
		$this->db->from('cajas_pagos');
		$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('caja_corte_id IS NULL');
		$this->db->where('estatus', 'ACTIVO');
		return $this->db->get()->result();
	}

	/*Método para regresar los saldos de los vales de caja del empleado 
	  que coincida con los criterios de búsqueda proporcionados (se utiliza en el reporte de vales de caja chica con adeudos)*/
	public function buscar_saldos_vales_caja_adeudos($dteFechaCorte, $intEmpleadoID =  NULL)
	{
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';

		//Si existe id del empleado
		if($intEmpleadoID > 0)
		{
			$strRestricciones .= " AND E.empleado_id = $intEmpleadoID";
		}

		$strSQL = $this->db->query("SELECT CV.folio, CV.fecha, CV.concepto, CV.importe, 
										   DATE_FORMAT(CV.fecha,'%d/%m/%Y') AS fecha_format, E.empleado_id,
									       CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado, 
									        (CV.importe -
											 IFNULL((SELECT SUM(CVD.subtotal + CVD.iva + CVD.ieps) 
													 FROM cajas_vales_detalles AS CVD
													 WHERE CV.caja_vale_id = CVD.caja_vale_id), 0) -
											  IFNULL((SELECT SUM(CP.importe)
													  FROM cajas_pagos AS CP
													  WHERE CV.caja_vale_id = CP.caja_vale_id
									                  AND CP.fecha <= '$dteFechaCorte'
													  AND CP.estatus = 'ACTIVO'), 0)) AS saldo

									FROM cajas_vales AS CV
									INNER JOIN empleados AS E ON CV.referencia_id = E.empleado_id AND CV.tipo_referencia = 'EMPLEADO'
									WHERE  CV.fecha <= '$dteFechaCorte' 
									AND CV.estatus = 'CERRADO'
									$strRestricciones
									ORDER BY E.empleado_id, CV.fecha ASC");

		return $strSQL->result();
	}

	/*Método para regresar el saldo inicial que coincida con los criterios de búsqueda proporcionados
     *(se utiliza en el reporte de estado de cuenta)*/
	public function buscar_saldo_inicial_estado_cuenta($dteFecha, $intEmpleadoID)
	{
		$strSQL = $this->db->query("SELECT SUM(CV.importe) -
										   IFNULL((SELECT SUM(CVD.subtotal + CVD.iva + CVD.ieps) 
												   FROM cajas_vales_detalles AS CVD
												   INNER JOIN cajas_vales AS CV2 ON CVD.caja_vale_id = CV2.caja_vale_id
												   WHERE CV2.referencia_id = CV.referencia_id
									               AND  CV2.tipo_referencia = CV.tipo_referencia
									               AND CV2.fecha < '$dteFecha'
												   AND CV2.estatus = CV.estatus), 0) -
									        IFNULL((SELECT SUM(CP.importe)
												    FROM cajas_pagos AS CP
												    WHERE CP.empleado_id = CV.referencia_id
												    AND CP.fecha < '$dteFecha'
												    AND CP.estatus = 'ACTIVO'), 0) AS saldo_inicial
									FROM cajas_vales AS CV
									WHERE CV.referencia_id = $intEmpleadoID
									AND CV.tipo_referencia = 'EMPLEADO'
									AND CV.fecha < '$dteFecha'
									AND CV.estatus = 'CERRADO'");

		return $strSQL->result();
	}
	
	/*Método para regresar los movimientos (vales de caja, comprobación y pagos) del empleado 
	  que coincida con los criterios de búsqueda proporcionados (se utiliza en el reporte de estado de cuenta)*/
	public function buscar_movimientos_estado_cuenta($dteFechaInicial, $dteFechaFinal, $intEmpleadoID)
	{
		$strSQL = $this->db->query("SELECT CV.folio, CV.fecha, DATE_FORMAT(CV.fecha,'%d/%m/%Y') AS fecha_format,
										   CV.concepto AS descripcion, '' AS folio_referencia, 'cargo' AS tipo,
									       CV.importe AS total
									FROM cajas_vales AS CV
									WHERE CV.referencia_id = $intEmpleadoID
									AND CV.tipo_referencia = 'EMPLEADO'
									AND (CV.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
									AND CV.estatus = 'CERRADO'
									UNION
									SELECT '' AS folio, CV.fecha AS fecha, DATE_FORMAT(CV.fecha,'%d/%m/%Y') AS fecha_format,
											'COMPROBACIÓN' AS descripcion, CV.folio AS folio_referencia,
									        'abono' AS tipo, SUM(CVD.subtotal + CVD.iva + CVD.ieps) AS total
									FROM cajas_vales_detalles AS CVD
									INNER JOIN cajas_vales AS CV ON CVD.caja_vale_id = CV.caja_vale_id
									WHERE CV.referencia_id = $intEmpleadoID
									AND CV.tipo_referencia = 'EMPLEADO'
									AND (CV.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
									AND CV.estatus = 'CERRADO'
									GROUP BY CV.caja_vale_id
									UNION 
									SELECT CP.folio, CP.fecha, DATE_FORMAT(CP.fecha,'%d/%m/%Y') AS fecha_format,
										'PAGO' AS descripcion,  CV.folio AS folio_referencia,
									    'abono' AS tipo, CP.importe AS total
									FROM cajas_pagos AS CP
									INNER JOIN cajas_vales AS CV ON CP.caja_vale_id = CV.caja_vale_id
									WHERE CP.empleado_id = $intEmpleadoID
									AND (CP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')
									AND CP.estatus = 'ACTIVO'");
		return $strSQL->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intEmpleadoID = NULL,
		                   $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('CP.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del empleado
	    if($intEmpleadoID != NULL)
	    {
	   		$this->db->where('CP.empleado_id', $intEmpleadoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(CP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
		$this->db->from('cajas_pagos AS CP');
		$this->db->join('empleados AS E', 'CP.empleado_id = E.empleado_id', 'inner');
		$this->db->join('cajas_vales AS CV', 'CP.caja_vale_id = CV.caja_vale_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CP.caja_pago_id, CP.folio, DATE_FORMAT(CP.fecha,'%d/%m/%Y') AS fecha,
						   CP.caja_corte_id, CP.estatus, CONCAT('$',FORMAT(CP.importe,2)) AS importe, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
						   CONCAT_WS(' - ', CV.folio, CV.tipo_vale) AS vale", FALSE);
		$this->db->from('cajas_pagos AS CP');
		$this->db->join('empleados AS E', 'CP.empleado_id = E.empleado_id', 'inner');
		$this->db->join('cajas_vales AS CV', 'CP.caja_vale_id = CV.caja_vale_id', 'inner');
		$this->db->where('CP.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del empleado
	    if($intEmpleadoID != NULL)
	    {
	   		$this->db->where('CP.empleado_id', $intEmpleadoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(CP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
		$this->db->order_by('CP.fecha DESC, CP.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["pagos"] =$this->db->get()->result();
		return $arrResultado;
	}

}
?>