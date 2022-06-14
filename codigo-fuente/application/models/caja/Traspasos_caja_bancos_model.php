<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');

class Traspasos_caja_bancos_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla traspasos_caja_bancos
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objTraspasoCajaBancos)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objTraspasoCajaBancos->strFolio); 

		//Tabla traspasos_caja_bancos
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objTraspasoCajaBancos->intSucursalID,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objTraspasoCajaBancos->dteFecha, 
						  'cuenta_bancaria_id' => $objTraspasoCajaBancos->intCuentaBancariaID,
						  'importe' => $objTraspasoCajaBancos->intImporte,
						  'empleado_id' => $objTraspasoCajaBancos->intEmpleadoID, 
						  'observaciones' => $objTraspasoCajaBancos->strObservaciones, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objTraspasoCajaBancos->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('traspasos_caja_bancos', $arrDatos);
		//Agregar id del nuevo registro al objeto
		$objTraspasoCajaBancos->intTraspasoCajaBancoID = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles del traspaso
		$this->guardar_detalles($objTraspasoCajaBancos);
		
		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objTraspasoCajaBancos->intTraspasoCajaBancoID;
	}

	
	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objTraspasoCajaBancos)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();


		//Tabla traspasos_caja_bancos
		//Asignar datos al array
		$arrDatos = array('fecha' => $objTraspasoCajaBancos->dteFecha, 
						  'cuenta_bancaria_id' => $objTraspasoCajaBancos->intCuentaBancariaID, 
						  'importe' => $objTraspasoCajaBancos->intImporte,
						  'empleado_id' => $objTraspasoCajaBancos->intEmpleadoID, 
						  'observaciones' => $objTraspasoCajaBancos->strObservaciones, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objTraspasoCajaBancos->intUsuarioID);
		$this->db->where('traspaso_caja_banco_id', $objTraspasoCajaBancos->intTraspasoCajaBancoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('traspasos_caja_bancos', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('traspaso_caja_banco_id', $objTraspasoCajaBancos->intTraspasoCajaBancoID);
		$this->db->delete('traspasos_caja_bancos_detalles');

		//Hacer un llamado al método para guardar los detalles del traspaso
		$this->guardar_detalles($objTraspasoCajaBancos);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}


	//Método para modificar el estatus de un registro
	public function set_estatus($intTraspasoCajaBancoID, $intPolizaID = NULL)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('traspaso_caja_banco_id', $intTraspasoCajaBancoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('traspasos_caja_bancos',$arrDatos);

		//Si existe id de la póliza
		if($intPolizaID > 0)
		{
			//Se crea una instancia de la clase modelo (pólizas) 
       	 	$otdModelPolizas = new Polizas_model();
			//Hacer un llamado al método para modificar el estatus de la póliza 
			$otdModelPolizas->set_estatus($intPolizaID, 'INACTIVO');
		}

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intTraspasoCajaBancoID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intEmpleadoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{


		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';

		//Si existe id del traspaso
		if ($intTraspasoCajaBancoID !== NULL)
		{   
			$strRestricciones .= " AND TCB.traspaso_caja_banco_id = $intTraspasoCajaBancoID";
		}
		else
		{
			 //Si existe id del empleado
		    if($intEmpleadoID > 0)
		    {

		   		$strRestricciones .= " AND TCB.empleado_id = $intEmpleadoID";
		    }

		    //Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$strRestricciones .= " AND (TCB.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
		    } 


		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$strRestricciones .= " AND  (IFNULL(PF.poliza_id, 0) = 0)";
					$strRestricciones .= " AND (TCB.estatus = 'ACTIVO')";

				}
				else
				{
					$strRestricciones .= " AND  TCB.estatus = '$strEstatus'";
				}
			}


			$strRestricciones .= " AND ((TCB.folio LIKE '%$strBusqueda%') OR
									   (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
						               (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
			        				   (CONCAT_WS(' - ', E.codigo, E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
			        				   (CONCAT_WS(' ', E.codigo, E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
						               (CONCAT_WS(' ', E.codigo, E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
						               (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
						               (CONCAT_WS(' ', E.nombre,E. apellido_paterno) LIKE '%$strBusqueda%') OR 
						               (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
						               (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
						               (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))";
		}


		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$strSQL = $this->db->query("SELECT TCB.traspaso_caja_banco_id, TCB.folio, DATE_FORMAT(TCB.fecha,'%d/%m/%Y') AS fecha, 
										   TCB.cuenta_bancaria_id, TCB.importe, TCB.empleado_id, TCB.observaciones, 
										   TCB.estatus, CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria, 
										   CB.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, M.codigo AS codigo_moneda,
										   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado, 
										   UC.usuario AS usuario_creacion, 
										   DATE_FORMAT(TCB.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion, 
										   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   				   PF.folio AS folio_poliza
									 FROM traspasos_caja_bancos AS TCB
									 INNER JOIN empleados AS E ON TCB.empleado_id = E.empleado_id
									 INNER JOIN cuentas_bancarias AS CB ON TCB.cuenta_bancaria_id = CB.cuenta_bancaria_id
									 INNER JOIN sat_monedas AS M ON CB.moneda_id = M.moneda_id
									 LEFT JOIN usuarios AS UC ON TCB.usuario_creacion = UC.usuario_id
									 LEFT JOIN polizas AS PF ON TCB.traspaso_caja_banco_id = PF.referencia_id 
									 	  AND PF.modulo = 'CAJA' AND PF.proceso = 'TRASPASO BANCOS'
								    WHERE TCB.sucursal_id = $intSucursalID 
								    $strRestricciones 
								    ORDER BY  TCB.fecha DESC, TCB.folio DESC");


		//Si existe id del traspaso
		if ($intTraspasoCajaBancoID !== NULL)
		{   
			return $strSQL->row();
		}
		else
		{
			return $strSQL->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						                     $intEmpleadoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('traspasos_caja_bancos AS TCB');
		$this->db->join('empleados AS E', 'TCB.empleado_id = E.empleado_id', 'inner');
		$this->db->join('cuentas_bancarias AS CB', 'TCB.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$this->db->join('sat_monedas AS M', 'CB.moneda_id = M.moneda_id', 'inner');
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del empleado
		if($intEmpleadoID > 0)
	    {
	   		$this->db->where('TCB.empleado_id', $intEmpleadoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(TCB.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('TCB.estatus', $strEstatus);
		}

	    $this->db->where("((TCB.folio LIKE '%$strBusqueda%') OR
						   (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', E.codigo, E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' ', E.codigo, E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', E.codigo, E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', E.nombre,E. apellido_paterno) LIKE '%$strBusqueda%') OR 
			               (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
			               (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))");

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}



	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intEmpleadoID = NULL, 
						   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{

		//Si no existe posición inicial
		if($intPos == '')
		{
			$intPos = 0;
		}

		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';


		//Si existe id del empleado
	    if($intEmpleadoID > 0)
	    {

	   		$strRestricciones .= " AND TCB.empleado_id = $intEmpleadoID";
	    }

	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$strRestricciones .= " AND (TCB.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
	    } 


	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$strRestricciones .= " AND  (IFNULL(PF.poliza_id, 0) = 0)";
				$strRestricciones .= " AND (TCB.estatus = 'ACTIVO')";

			}
			else
			{
				$strRestricciones .= " AND  TCB.estatus = '$strEstatus'";
			}
		}


		$strRestricciones .= " AND ((TCB.folio LIKE '%$strBusqueda%') OR
								   (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
					               (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
		        				   (CONCAT_WS(' - ', E.codigo, E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
		        				   (CONCAT_WS(' ', E.codigo, E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
					               (CONCAT_WS(' ', E.codigo, E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					               (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					               (CONCAT_WS(' ', E.nombre,E. apellido_paterno) LIKE '%$strBusqueda%') OR 
					               (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
					               (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
					               (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))";
		

		 $strSQL= $this->db->query(" SELECT TCB.traspaso_caja_banco_id 
								     FROM traspasos_caja_bancos AS TCB
									 INNER JOIN empleados AS E ON TCB.empleado_id = E.empleado_id
									 INNER JOIN cuentas_bancarias AS CB ON TCB.cuenta_bancaria_id = CB.cuenta_bancaria_id
									 INNER JOIN sat_monedas AS M ON CB.moneda_id = M.moneda_id
									 LEFT JOIN polizas AS PF ON TCB.traspaso_caja_banco_id = PF.referencia_id 
									 	   AND PF.modulo = 'CAJA' AND PF.proceso = 'TRASPASO BANCOS'
								   WHERE TCB.sucursal_id = $intSucursalID 
								        $strRestricciones");
	    $arrResultado["total_rows"]=$strSQL->num_rows();


		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$strSQL = $this->db->query("SELECT TCB.traspaso_caja_banco_id, TCB.folio, DATE_FORMAT(TCB.fecha,'%d/%m/%Y') AS fecha,
										   TCB.estatus, CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria, 
										   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
										    IFNULL(PF.poliza_id, 0) AS poliza_id,
						   				  PF.folio AS folio_poliza
    								 FROM traspasos_caja_bancos AS TCB
									 INNER JOIN empleados AS E ON TCB.empleado_id = E.empleado_id
									 INNER JOIN cuentas_bancarias AS CB ON TCB.cuenta_bancaria_id = CB.cuenta_bancaria_id
									 INNER JOIN sat_monedas AS M ON CB.moneda_id = M.moneda_id
									 LEFT JOIN usuarios AS UC ON TCB.usuario_creacion = UC.usuario_id
									 LEFT JOIN polizas AS PF ON TCB.traspaso_caja_banco_id = PF.referencia_id 
									 	   AND PF.modulo = 'CAJA' AND PF.proceso = 'TRASPASO BANCOS'
							        WHERE TCB.sucursal_id = $intSucursalID 
							        $strRestricciones
							    	ORDER BY  TCB.fecha DESC, TCB.folio DESC
							    	 LIMIT $intPos, $intNumRows");		               


		$arrResultado["traspasos"] = $strSQL->result();
		return $arrResultado;
	}

	
	/*******************************************************************************************************************
	Funciones de la tabla traspasos_caja_bancos_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles del traspaso
	public function guardar_detalles(stdClass $objTraspasoCajaBancos)
	{
		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener los detalles del traspaso
		foreach ($objTraspasoCajaBancos->arrDetalles as $arrDets)
		{
			//Hacer recorrido para obtener los datos del detalle
			foreach ($arrDets as $arrDet)
			{
				//Incrementar renglón consecutivo
				$intRenglon++;
				//Asignar datos al array
				$arrDatos = array('traspaso_caja_banco_id' => $objTraspasoCajaBancos->intTraspasoCajaBancoID,
								  'renglon' => $intRenglon,
								  'tipo_referencia' => $arrDet->strTipoReferencia,
								  'referencia_id' => $arrDet->intReferenciaID,
								  'renglon_referencia' => $arrDet->intRenglonReferencia,
								  'importe' => $arrDet->intImporte);
				//Guardar los datos del registro
				$this->db->insert('traspasos_caja_bancos_detalles', $arrDatos);
			}
		}
	}



	//Método para regresar los ingresos (anticipos, pagos, recibos de ingreso y pólizas de abono) que coincidan con el criterio de búsqueda proporcionado
	public function buscar_ingresos($intTraspasoCajaBancoID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
									$intProspectoID = NULL, $intMonedaID = NULL)
	{
		
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID = $this->session->userdata('sucursal_id');
		//Constante para identificar la forma de pago: Transferencia electrónica
		$intFormaPagoIDTE = FORMA_PAGO_TRANSFERENCIA;

		//Variable que se utiliza para formar la consulta
		$queryIngresosDeposito = '';

		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		//ID del traspaso de caja
		$strRestriccionesTraspasoBanco = '';
		//Estatus del traspaso de caja 
		$strRestriccionesEstatusTraspasoBanco = '';

		//Prospecto
		$strRestriccionesProspecto = '';
		//Fecha
		$strRestriccionesFechaPagos = '';
		$strRestriccionesFechaAnticipo = '';
		$strRestriccionesFechaRecibosIngreso = '';
		$strRestriccionesFechaPolizasAbono = '';
		//Variable que se utiliza para agregar los campos de la tabla traspasos_caja_bancos_detalles
		$strCampoRenglon = '';
		//Variable que se utiliza para ordenar los registros dependiendo del tipo de búsqueda
		$strOrdenamiento = " ORDER BY ";

		//Si existe id del traspaso de caja 
		if($intTraspasoCajaBancoID != NULL)
		{
			$strRestriccionesTraspasoBanco .= "TraspasoDetalles.ID = $intTraspasoCajaBancoID";
			$strCampoRenglon = ", TraspasoDetalles.renglon";
			$strOrdenamiento .= "renglon ASC";

		}
		else
		{
			$strRestriccionesTraspasoBanco .= "IFNULL(TraspasoDetalles.ID,0) = 0";
			$strRestriccionesEstatusTraspasoBanco .= " AND TCB.estatus = 'ACTIVO'"; 
			$strOrdenamiento .= "fecha ASC";
		}
		
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	    	$strRestriccionesProspecto .= " AND C.prospecto_id = $intProspectoID";
	    }

	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	    	
	    	$strRestriccionesFechaPagos .= " AND (DATE_FORMAT(PD.fecha_pago,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
	    	$strRestriccionesFechaAnticipo .= " AND (DATE_FORMAT(A.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
	    	$strRestriccionesFechaRecibosIngreso .= " AND (DATE_FORMAT(RI.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
	    	$strRestriccionesFechaPolizasAbono .= " AND (DATE_FORMAT(PA.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
	    }


		//Variables para definir los procesos que se incluiran en la búsqueda
		//Pagos
		$queryPagos = "SELECT  P.pago_id AS referencia_id, 'PAGO' AS tipo_referencia,
							   PD.renglon AS renglon_referencia, 
						       DATE_FORMAT(P.fecha,'%d/%m/%Y') AS fecha, P.folio,
							   PD.moneda_id, PD.tipo_cambio, P.razon_social,
						       CASE   
							      WHEN TraspasoDetalles.ID > 0 
							      	THEN (TraspasoDetalles.importe / PD.tipo_cambio)
							      ELSE (PD.monto / PD.tipo_cambio) 
							   	END AS importe,
							   CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, 
							   '' AS folio_detalle $strCampoRenglon
					   FROM pagos AS P
					   INNER JOIN clientes AS C ON  P.prospecto_id = C.prospecto_id
					   INNER JOIN pagos_detalles_02 AS PD ON P.pago_id = PD.pago_id
					   INNER JOIN sat_forma_pago AS FP ON PD.forma_pago_id = FP.forma_pago_id
					   LEFT JOIN (SELECT IFNULL(TCBD.traspaso_caja_banco_id,0) AS ID, 
										  TCBD.referencia_id AS referenciaID,
										  TCBD.renglon, TCBD.renglon_referencia, 
										  TCBD.importe
								  FROM traspasos_caja_bancos_detalles AS TCBD
						          INNER JOIN traspasos_caja_bancos AS TCB ON TCBD.traspaso_caja_banco_id = TCB.traspaso_caja_banco_id
						          WHERE TCBD.tipo_referencia = 'PAGO'
						          $strRestriccionesEstatusTraspasoBanco)  AS TraspasoDetalles ON TraspasoDetalles.referenciaID = P.pago_id AND TraspasoDetalles.renglon_referencia = PD.renglon";

		
		$queryPagos .= " WHERE  $strRestriccionesTraspasoBanco "; 

		//Si no existe id del traspaso de caja
		if($intTraspasoCajaBancoID === NULL)
		{

			$queryPagos .= " AND PD.moneda_id = $intMonedaID";
			//$queryPagos .= " AND PD.forma_pago_id <> $intFormaPagoIDTE";
			//$queryPagos .= " AND PD.cuenta_bancaria_id IS NULL";
			$queryPagos .= " AND  (P.estatus = 'ACTIVO' OR P.estatus = 'TIMBRAR')";
			$queryPagos .= $strRestriccionesProspecto;
			$queryPagos .= $strRestriccionesFechaPagos;
		}


	    //Anticipos
		$queryAnticipos = "SELECT  A.anticipo_id AS referencia_id, 'ANTICIPO' AS tipo_referencia,
								   1 AS renglon_referencia, DATE_FORMAT(A.fecha,'%d/%m/%Y') AS fecha, 
								   A.folio, A.moneda_id, A.tipo_cambio, A.razon_social,
								   CASE   
								      WHEN TraspasoDetalles.ID > 0 
								      	THEN (TraspasoDetalles.importe / A.tipo_cambio)
								      ELSE 
							      		   ((ROUND((A.subtotal/A.tipo_cambio), 2) + 
										     ROUND((A.iva/A.tipo_cambio), 2) + 
										     ROUND((A.ieps/A.tipo_cambio), 2)))
								   	END AS importe,
							       CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, 
							       '' AS folio_detalle $strCampoRenglon
							FROM anticipos AS A
							INNER JOIN clientes AS C ON A.prospecto_id = C.prospecto_id
							INNER JOIN sat_forma_pago AS FP ON A.forma_pago_id = FP.forma_pago_id
						    LEFT JOIN (SELECT IFNULL(TCBD.traspaso_caja_banco_id,0) AS ID, 
												  TCBD.referencia_id AS referenciaID,
												  TCBD.renglon, TCBD.renglon_referencia, 
												  TCBD.importe
										 FROM traspasos_caja_bancos_detalles AS TCBD
								         INNER JOIN traspasos_caja_bancos AS TCB ON TCBD.traspaso_caja_banco_id = TCB.traspaso_caja_banco_id
								         WHERE TCBD.tipo_referencia = 'ANTICIPO'
								         $strRestriccionesEstatusTraspasoBanco)  AS TraspasoDetalles ON TraspasoDetalles.referenciaID = A.anticipo_id AND TraspasoDetalles.renglon_referencia = 1";


		$queryAnticipos .= " WHERE  $strRestriccionesTraspasoBanco "; 

		//Si no existe id del traspaso de caja
		if($intTraspasoCajaBancoID === NULL)
		{

			$queryAnticipos .= " AND A.moneda_id = $intMonedaID";
			$queryAnticipos .= " AND (A.estatus = 'ACTIVO' OR A.estatus = 'TIMBRAR')";
			$queryAnticipos .= $strRestriccionesProspecto;
			$queryAnticipos .= $strRestriccionesFechaAnticipo;
		}



		 //Anticipos no fiscales
		$queryAnticiposNoFiscales = "SELECT  A.anticipo_no_fiscal_id AS referencia_id, 'RECIBO INTERNO ANTICIPO' AS tipo_referencia,
								   1 AS renglon_referencia, DATE_FORMAT(A.fecha,'%d/%m/%Y') AS fecha, 
								   A.folio, A.moneda_id, A.tipo_cambio, A.razon_social,
								   CASE   
								      WHEN TraspasoDetalles.ID > 0 
								      	THEN (TraspasoDetalles.importe / A.tipo_cambio)
								      ELSE 
							      		   ((ROUND((A.subtotal/A.tipo_cambio), 2) + 
										     ROUND((A.iva/A.tipo_cambio), 2) + 
										     ROUND((A.ieps/A.tipo_cambio), 2)))
								   	END AS importe,
							       CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, 
							       '' AS folio_detalle $strCampoRenglon
							FROM anticipos_no_fiscales AS A
							INNER JOIN clientes AS C ON A.prospecto_id = C.prospecto_id
							INNER JOIN sat_forma_pago AS FP ON A.forma_pago_id = FP.forma_pago_id
						    LEFT JOIN (SELECT IFNULL(TCBD.traspaso_caja_banco_id,0) AS ID, 
												  TCBD.referencia_id AS referenciaID,
												  TCBD.renglon, TCBD.renglon_referencia, 
												  TCBD.importe
										 FROM traspasos_caja_bancos_detalles AS TCBD
								         INNER JOIN traspasos_caja_bancos AS TCB ON TCBD.traspaso_caja_banco_id = TCB.traspaso_caja_banco_id
								         WHERE TCBD.tipo_referencia = 'RECIBO INTERNO ANTICIPO'
								         $strRestriccionesEstatusTraspasoBanco)  AS TraspasoDetalles ON TraspasoDetalles.referenciaID = A.anticipo_no_fiscal_id AND TraspasoDetalles.renglon_referencia = 1";


		$queryAnticiposNoFiscales .= " WHERE  $strRestriccionesTraspasoBanco "; 

		//Si no existe id del traspaso de caja
		if($intTraspasoCajaBancoID === NULL)
		{

			$queryAnticiposNoFiscales .= " AND A.moneda_id = $intMonedaID";
			$queryAnticiposNoFiscales .= " AND A.estatus = 'ACTIVO'";
			$queryAnticiposNoFiscales .= $strRestriccionesProspecto;
			$queryAnticiposNoFiscales .= $strRestriccionesFechaAnticipo;
		}

		//Recibos de ingresos
		$queryRecibosIngresos = "SELECT  RI.recibo_ingreso_id AS referencia_id, 
								 		 'RECIBO INGRESO' AS tipo_referencia,
										 1 AS renglon_referencia, 
								         DATE_FORMAT(RI.fecha,'%d/%m/%Y') AS fecha, RI.folio,
										 RI.moneda_id, RI.tipo_cambio, RI.razon_social,
										 CASE   
										      WHEN TraspasoDetalles.ID > 0 
										      	THEN (TraspasoDetalles.importe / RI.tipo_cambio)
										      ELSE 
										      		(RecibosIngreso.Total / RI.tipo_cambio) 
										 END AS importe,
										 CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, 
										 '' AS folio_detalle $strCampoRenglon
							     FROM recibos_ingreso AS RI
							   	 INNER JOIN clientes AS C ON  RI.prospecto_id = C.prospecto_id
							   	 INNER JOIN sat_forma_pago AS FP ON RI.forma_pago_id = FP.forma_pago_id
							 	 INNER JOIN (SELECT recibo_ingreso_id AS referenciaID,
										   		    SUM(ROUND(precio,2) + ROUND(iva,2) + ROUND(ieps,2)) AS Total 
											 FROM recibos_ingreso_detalles
											 GROUP BY recibo_ingreso_id   
									   		 ) AS RecibosIngreso ON RecibosIngreso.referenciaID = RI.recibo_ingreso_id
							     LEFT JOIN (SELECT IFNULL(TCBD.traspaso_caja_banco_id,0) AS ID, 
												  TCBD.referencia_id AS referenciaID,
												  TCBD.renglon, TCBD.renglon_referencia, 
												  TCBD.importe
										    FROM traspasos_caja_bancos_detalles AS TCBD
								            INNER JOIN traspasos_caja_bancos AS TCB ON TCBD.traspaso_caja_banco_id = TCB.traspaso_caja_banco_id
								            WHERE TCBD.tipo_referencia = 'RECIBO INGRESO'
								            $strRestriccionesEstatusTraspasoBanco)  AS TraspasoDetalles ON TraspasoDetalles.referenciaID = RI.recibo_ingreso_id AND TraspasoDetalles.renglon_referencia = 1";

		$queryRecibosIngresos .= " WHERE  $strRestriccionesTraspasoBanco "; 

		//Si no existe id del traspaso de caja
		if($intTraspasoCajaBancoID === NULL)
		{

			$queryRecibosIngresos .= " AND RI.moneda_id = $intMonedaID";
			$queryRecibosIngresos .= " AND  RI.estatus = 'ACTIVO'";
			$queryRecibosIngresos .= $strRestriccionesProspecto;
			$queryRecibosIngresos .= $strRestriccionesFechaRecibosIngreso;

		}


		//Pólizas de abono
		$queryPolizasAbono = "SELECT PA.poliza_abono_id AS referencia_id, 'POLIZA ABONO' AS tipo_referencia,
									 PAD.renglon AS renglon_referencia, 
									 DATE_FORMAT(PA.fecha,'%d/%m/%Y') AS fecha, PA.folio,
									 PA.moneda_id, PA.tipo_cambio, PA.razon_social,
									 CASE   
									    WHEN TraspasoDetalles.ID > 0 
									      	THEN (TraspasoDetalles.importe / PA.tipo_cambio)
									    ELSE
							               ((ROUND((PAD.precio/PA.tipo_cambio), 2) + 
										     ROUND((PAD.iva/PA.tipo_cambio), 2) + 
										     ROUND((PAD.ieps/PA.tipo_cambio), 2)))
									   	END AS importe,
									 CASE 
									    WHEN  FM.factura_maquinaria_id > 0 
											THEN CONCAT_WS(' - ', FPM.codigo, FPM.descripcion) 
									    WHEN  FR.factura_refacciones_id > 0
											THEN CONCAT_WS(' - ', FPR.codigo, FPR.descripcion) 
									    ELSE CONCAT_WS(' - ', FPS.codigo, FPR.descripcion) 
									  END AS  forma_pago,
							         CASE 
									    WHEN  FM.factura_maquinaria_id > 0 
											THEN CONCAT_WS(' - ', FM.folio, 'MAQUINARIA') 
									    WHEN  FR.factura_refacciones_id > 0
											THEN CONCAT_WS(' - ', FR.folio, 'REFACCIONES') 
									    ELSE CONCAT_WS(' - ', FS.folio, 'SERVICIO') 
									  END AS  folio_detalle $strCampoRenglon
							  FROM polizas_abono_02 AS PA
							  INNER JOIN clientes AS C ON  PA.prospecto_id = C.prospecto_id
							  INNER JOIN polizas_abono_detalles_02 AS PAD ON PA.poliza_abono_id = PAD.poliza_abono_id
							  LEFT JOIN facturas_maquinaria AS FM ON PAD.referencia_id = FM.factura_maquinaria_id 
								   AND PAD.referencia = 'MAQUINARIA'
							  LEFT JOIN sat_forma_pago AS FPM ON FPM.forma_pago_id  =  FM.forma_pago_id
							  LEFT JOIN facturas_refacciones AS FR ON PAD.referencia_id = FR.factura_refacciones_id 
								   AND PAD.referencia = 'REFACCIONES'
							  LEFT JOIN sat_forma_pago AS FPR ON FPR.forma_pago_id  =  FR.forma_pago_id
							  LEFT JOIN facturas_servicio AS FS ON PAD.referencia_id = FS.factura_servicio_id 
								   AND PAD.referencia = 'SERVICIO'
							  LEFT JOIN sat_forma_pago AS FPS ON FPS.forma_pago_id  =  FS.forma_pago_id
							  LEFT JOIN (SELECT IFNULL(TCBD.traspaso_caja_banco_id,0) AS ID, 
												  TCBD.referencia_id AS referenciaID,
												  TCBD.renglon, TCBD.renglon_referencia, 
												  TCBD.importe
										 FROM traspasos_caja_bancos_detalles AS TCBD
								         INNER JOIN traspasos_caja_bancos AS TCB ON TCBD.traspaso_caja_banco_id = TCB.traspaso_caja_banco_id
								         WHERE TCBD.tipo_referencia = 'POLIZA ABONO'
								         $strRestriccionesEstatusTraspasoBanco)  AS TraspasoDetalles ON TraspasoDetalles.referenciaID = PA.poliza_abono_id AND TraspasoDetalles.renglon_referencia = PAD.renglon";

		$queryPolizasAbono .= " WHERE  $strRestriccionesTraspasoBanco "; 

		//Si no existe id del traspaso de caja
		if($intTraspasoCajaBancoID === NULL)
		{
			
			$queryPolizasAbono .= " AND PA.moneda_id = $intMonedaID";
			$queryPolizasAbono .= " AND  PA.estatus = 'ACTIVO'";
			$queryPolizasAbono .= $strRestriccionesProspecto;
			$queryPolizasAbono .= $strRestriccionesFechaPolizasAbono;
		}

		//Formar consulta
		$queryIngresosDeposito .= $queryPagos;
		$queryIngresosDeposito .= " UNION ";
		$queryIngresosDeposito .= $queryAnticipos;
		$queryIngresosDeposito .= " UNION ";
		$queryIngresosDeposito .= $queryAnticiposNoFiscales;
		$queryIngresosDeposito .= " UNION ";
		$queryIngresosDeposito .= $queryRecibosIngresos;
		$queryIngresosDeposito .= " UNION ";
		$queryIngresosDeposito .= $queryPolizasAbono;
		$queryIngresosDeposito .= $strOrdenamiento;

		$strSQL = $this->db->query($queryIngresosDeposito);
		return $strSQL->result();
	}
}
?>