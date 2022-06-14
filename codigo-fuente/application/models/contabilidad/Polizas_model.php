<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Polizas_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla polizas
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objPoliza)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

        /*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objPoliza->strFolio);

		//Tabla polizas
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objPoliza->intSucursalID, 
						  'tipo' => $objPoliza->strTipo, 
						  'modulo' =>  $objPoliza->strModulo,
						  'proceso' => $objPoliza->strProceso,
						  'referencia_id' => $objPoliza->intReferenciaID,
						  'folio' => $strFolioConsecutivo,
						  'fecha' => $objPoliza->dteFecha,
						  'concepto' => $objPoliza->strConcepto,
						  'observaciones' => $objPoliza->strObservaciones, 
						  'estatus' => $objPoliza->strEstatus, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objPoliza->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('polizas', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objPoliza->intPolizaID = $this->db->insert_id();
	
		//Si la póliza corresponde al módulo de contabilidad (no se genera automáticamente)
		if($objPoliza->strModulo == 'CONTABILIDAD' && $objPoliza->strProceso == 'POLIZA')
		{
			//Si la póliza corresponde al cierre anual
			if($objPoliza->strCierreAnual == 'SI')
			{

				//Hacer un llamado al método para guardar los detalles de la póliza de cierre anual
				$this->guardar_detalles_cierre($objPoliza);
			}
			else
			{
				//Hacer un llamado al método para guardar los detalles de la póliza
				$this->guardar_detalles($objPoliza);
			}
			
		}
		else
		{
			//Hacer un llamado al método para guardar los detalles de la póliza generada de forma automática
			$this->guardar_detalles_generados($objPoliza);
		}

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objPoliza->intPolizaID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objPoliza)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla polizas
		//Asignar datos al array
		$arrDatos = array('tipo' => $objPoliza->strTipo, 
						  'fecha' => $objPoliza->dteFecha,
						  'concepto' => $objPoliza->strConcepto,
						  'observaciones' => $objPoliza->strObservaciones,
						  'estatus' => $objPoliza->strEstatus, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objPoliza->intUsuarioID);
		$this->db->where('poliza_id', $objPoliza->intPolizaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('polizas', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('poliza_id', $objPoliza->intPolizaID);
		$this->db->delete('polizas_detalles');

		//Eliminar los detalles Diot guardados
		$this->db->where('poliza_id', $objPoliza->intPolizaID);
		$this->db->delete('polizas_detalles_diot');

		//Hacer un llamado al método para guardar los detalles de la póliza
		$this->guardar_detalles($objPoliza);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intPolizaID, $strEstatus)
	{


		//Si el estatus del registro es ACTIVO o NO APLICADA
		if($strEstatus == 'ACTIVO' OR $strEstatus == 'NO APLICADA')
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
		$this->db->where('poliza_id', $intPolizaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('polizas', $arrDatos);
	}


	//Método para modificar el estatus de varios registros
	public function set_estatus_varios($strPolizaID, $strEstatus)
	{

		//Generar las condiciones dinamicas de las consultas respecto a la columna poliza_id
		$strRestriccionesPolizas = " (";
		
	    //Quitar | de la lista para obtener el id de la póliza
		$arrPolizas = explode("|", $strPolizaID);

		//Hacer recorrido para formar restricción con los ID's de las sucursales
		for ($intCon = 0; $intCon < sizeof($arrPolizas); $intCon++) 
		{
			//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otra póliza)
			if($intCon > 0)
			{
				//Asignar condición OR
				$strRestriccionesPolizas .= " OR ";
			}

			//Concatenar id de la póliza 
			$strRestriccionesPolizas .= "poliza_id = ".$arrPolizas[$intCon];
		}

		$strRestriccionesPolizas .= ")";

		//Si el estatus del registro es ACTIVO o NO APLICADA
		if($strEstatus == 'ACTIVO' OR $strEstatus == 'NO APLICADA')
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

		$this->db->where($strRestriccionesPolizas);
		//Actualizar los datos del registro
		return $this->db->update('polizas', $arrDatos);

	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intPolizaID = NULL, $strCriteriosBusq = NULL, 
						   $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $strEstatus = NULL, $strModulo = NULL, $strProceso = NULL, 
						   $strBusqueda =  NULL)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';

		//Si existe id de la póliza
		if ($intPolizaID !== NULL)
		{   
			$strRestricciones .= " AND P.poliza_id = $intPolizaID";
		}
		else if ($strCriteriosBusq !== NULL) //Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (referencia_id|modulo|proceso) para obtener los criterios de búsqueda
            list($intReferenciaID, $strModulo, $strProceso) = explode("|", $strCriteriosBusq);

            $strRestricciones .= " AND P.referencia_id = $intReferenciaID";
            $strRestricciones .= " AND P.modulo = '$strModulo'"; 
            $strRestricciones .= " AND P.proceso = '$strProceso'"; 

		}
		else
		{
			
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$strRestricciones .= " AND (P.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
		    } 

		    //Si existe módulo
			if($strModulo != 'TODOS')
			{
				$strRestricciones .= " AND P.modulo = '$strModulo'";
			}


 			//Si existe proceso
			if($strProceso != 'TODOS')
			{
				$strRestricciones .= " AND P.proceso = '$strProceso'";
			}


		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$strRestricciones .= " AND P.estatus = '$strEstatus'";
			}

			$strRestricciones .= " AND (P.folio LIKE '%$strBusqueda%' OR
										P.concepto LIKE '%$strBusqueda%' OR
										P.tipo LIKE '%$strBusqueda%')";

		}
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$strSQL = $this->db->query("SELECT P.poliza_id, P.tipo, P.modulo, P.proceso, P.referencia_id, 
										   P.folio, 
										   DATE_FORMAT(P.fecha,'%d/%m/%Y') AS fecha, 
										   P.concepto, P.observaciones, P.estatus,
										   CASE 
											   WHEN  MR.movimiento_refacciones_id > 0 
											   		THEN MR.folio
											   WHEN  FR.factura_refacciones_id > 0
											   		THEN FR.folio
											   WHEN  MM.movimiento_maquinaria_id > 0 
											   		THEN MM.folio
											   WHEN  FM.factura_maquinaria_id > 0
											   		THEN FM.folio
											   WHEN  TF.trabajo_foraneo_id > 0 
											   		THEN TF.folio
											   WHEN  FS.factura_servicio_id > 0
											   		THEN FS.folio
 											   WHEN  FC.factura_concepto_id > 0
											   		THEN FC.folio
											   WHEN  ORR.orden_reparacion_id > 0
											   		THEN ORR.folio
											   WHEN  NCS.nota_credito_servicio_id > 0
											   		THEN NCS.folio
											   WHEN  A.anticipo_id > 0
											   		THEN A.folio
											   WHEN  ANF.anticipo_no_fiscal_id > 0
											   		THEN ANF.folio
											   WHEN  RI.recibo_ingreso_id > 0
											   		THEN RI.folio
											   WHEN  PG.pago_id > 0
											   		THEN PG.folio
											   WHEN  TCB.traspaso_caja_banco_id > 0
											   		THEN TCB.folio
											    WHEN  NCRE.nota_credito_digital_id > 0
											   		THEN NCRE.folio
											    WHEN  NCA.nota_cargo_id > 0
											   		THEN NCA.folio
											   WHEN  NCAD.nota_cargo_digital_id > 0
											   		THEN NCAD.folio
											   WHEN  PA.poliza_abono_id > 0
											   		THEN PA.folio
											   WHEN  MRI.movimiento_refacciones_internas_id > 0 
											   		THEN MRI.folio
											   WHEN  TFI.trabajo_foraneo_interno_id > 0 
											   		THEN TFI.folio
											   WHEN  ORI.orden_reparacion_interna_id > 0 
											   		THEN ORI.folio
											   ELSE ''
										    END AS  referencia,
										    S.nombre AS sucursal,
										    UC.usuario AS usuario_creacion, 
										    DATE_FORMAT(P.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion
									FROM polizas AS P
									INNER JOIN sucursales AS S ON P.sucursal_id = S.sucursal_id
									LEFT JOIN usuarios AS UC ON P.usuario_creacion = UC.usuario_id
									LEFT JOIN movimientos_refacciones AS MR ON  P.referencia_id = MR.movimiento_refacciones_id 
										 AND  P.modulo = 'REFACCIONES'
										 AND (P.proceso = 'ENTRADA POR COMPRA' OR 
										 	  P.proceso = 'ENTRADA POR DEVOLUCION DE CLIENTE' OR 
										      P.proceso = 'ENTRADA POR DEVOLUCION DE TALLER' OR 
										      P.proceso = 'ENTRADA POR TRASPASO' OR
											  P.proceso = 'ENTRADA POR AJUSTE' OR  
											  P.proceso = 'SALIDA POR TALLER' OR 
										      P.proceso = 'SALIDA POR CONSUMO INTERNO' OR 
										      P.proceso = 'SALIDA POR TRASPASO' OR
										      P.proceso = 'SALIDA POR DEVOLUCION AL PROVEEDOR' OR  
										      P.proceso = 'SALIDA POR AJUSTE')
									LEFT JOIN  facturas_refacciones AS FR ON P.referencia_id = FR.factura_refacciones_id  
										 AND  P.modulo = 'REFACCIONES' AND P.proceso = 'FACTURACION'
									LEFT JOIN movimientos_maquinaria AS MM ON  P.referencia_id = MM.movimiento_maquinaria_id 
										 AND  P.modulo = 'MAQUINARIA'
										 AND (P.proceso = 'ENTRADA POR COMPRA' OR
										  	  P.proceso = 'ENTRADA POR TRASPASO' OR
										 	  P.proceso = 'ENTRADA POR DEVOLUCION DE CLIENTE' OR 
											  P.proceso = 'ENTRADA POR AJUSTE' OR
											  P.proceso = 'SALIDA POR VENTA' OR 
											  P.proceso = 'SALIDA POR TRASPASO' OR
											  P.proceso = 'SALIDA POR DEMOSTRACION' OR
											  P.proceso = 'SALIDA POR VALIDACION' OR
										      P.proceso = 'SALIDA POR CONSUMO INTERNO' OR 
										      P.proceso = 'SALIDA POR DEVOLUCION AL PROVEEDOR' OR  
										      P.proceso = 'SALIDA POR AJUSTE')
									LEFT JOIN  facturas_maquinaria AS FM ON P.referencia_id = FM.factura_maquinaria_id  
										 AND  P.modulo = 'MAQUINARIA' AND P.proceso = 'FACTURACION'
									LEFT JOIN  trabajos_foraneos_02 AS TF ON P.referencia_id = TF.trabajo_foraneo_id  
										 AND  P.modulo = 'SERVICIO' AND P.proceso = 'TRABAJO FORANEO'
									LEFT JOIN  facturas_servicio AS FS ON P.referencia_id = FS.factura_servicio_id  
										 AND  P.modulo = 'SERVICIO' AND P.proceso = 'FACTURACION'
									LEFT JOIN  facturas_conceptos AS FC ON P.referencia_id = FC.factura_concepto_id  
										 AND  P.modulo = 'CONTABILIDAD' AND P.proceso = 'FACTURACION'
									LEFT JOIN  ordenes_reparacion AS ORR ON P.referencia_id = ORR.orden_reparacion_id  
										 AND  P.modulo = 'SERVICIO' AND P.proceso = 'ORDEN DE TRABAJO'
								    LEFT JOIN  notas_credito_servicio AS NCS ON P.referencia_id = NCS.nota_credito_servicio_id  
										 AND  P.modulo = 'SERVICIO' AND P.proceso = 'NOTA CREDITO SERVICIO'
									LEFT JOIN  anticipos AS A ON P.referencia_id = A.anticipo_id  
										 AND  P.modulo = 'CAJA' AND P.proceso = 'ANTICIPO'
									LEFT JOIN  anticipos_no_fiscales AS ANF ON P.referencia_id = ANF.anticipo_no_fiscal_id  
										 AND  P.modulo = 'CAJA' AND P.proceso = 'RECIBO INTERNO ANTICIPO'
									LEFT JOIN  recibos_ingreso AS RI ON P.referencia_id = RI.recibo_ingreso_id  
										 AND  P.modulo = 'CUENTAS POR COBRAR' AND P.proceso = 'RECIBO INGRESO'
									LEFT JOIN  notas_credito_digitales AS NCRE ON P.referencia_id = NCRE.nota_credito_digital_id  
										 AND  P.modulo = 'CUENTAS POR COBRAR' AND P.proceso = 'NOTA CREDITO'
									LEFT JOIN  notas_cargo AS NCA ON P.referencia_id = NCA.nota_cargo_id  
										 AND  P.modulo = 'CUENTAS POR COBRAR' AND P.proceso = 'NOTA CARGO'
								    LEFT JOIN  notas_cargo_digitales AS NCAD ON P.referencia_id = NCAD.nota_cargo_digital_id  
										 AND  P.modulo = 'CUENTAS POR COBRAR' AND P.proceso = 'NOTA CARGO DIGITAL'
									LEFT JOIN  polizas_abono_02 AS PA ON P.referencia_id = PA.poliza_abono_id  
										 AND  P.modulo = 'CUENTAS POR COBRAR' AND P.proceso = 'POLIZA ABONO'
									LEFT JOIN  pagos AS PG ON P.referencia_id = PG.pago_id  
										 AND  P.modulo = 'CAJA' AND P.proceso = 'RECEPCION PAGO'
								    LEFT JOIN  traspasos_caja_bancos AS TCB ON P.referencia_id = TCB.traspaso_caja_banco_id  
										 AND  P.modulo = 'CAJA' AND P.proceso = 'TRASPASO BANCOS'
									LEFT JOIN movimientos_refacciones_internas AS MRI ON  P.referencia_id = MRI.movimiento_refacciones_internas_id 
										 AND  P.modulo = 'CONTROL DE VEHICULOS'
										 AND (P.proceso = 'ENTRADA POR TRASPASO ALMACEN GENERAL' OR 
										      P.proceso = 'ENTRADA POR DEVOLUCION DE TALLER' OR 
											  P.proceso = 'ENTRADA POR AJUSTE' OR  
											  P.proceso = 'SALIDA POR TALLER' OR 
										      P.proceso = 'SALIDA POR CONSUMO INTERNO' OR 
										      P.proceso = 'SALIDA POR TRASPASO' OR 
										      P.proceso = 'SALIDA POR AJUSTE')
								    LEFT JOIN  trabajos_foraneos_internos AS TFI ON P.referencia_id = TFI.trabajo_foraneo_interno_id  
										 AND  P.modulo = 'CONTROL DE VEHICULOS' AND P.proceso = 'TRABAJO FORANEO'
									 LEFT JOIN  ordenes_reparacion_internas AS ORI ON P.referencia_id = ORI.orden_reparacion_interna_id  
										 AND  P.modulo = 'CONTROL DE VEHICULOS' AND P.proceso = 'ORDEN DE TRABAJO'
									WHERE P.sucursal_id = $intSucursalID
									$strRestricciones
									ORDER BY P.fecha DESC, P.folio DESC");


		//Si existe id de la póliza
		if ($intPolizaID !== NULL)
		{   
			return $strSQL->row();
		}
		else
		{
			return $strSQL->result();
		}
		
	}

	/*Método para regresar las pólizas que coincidan con los criterios de búsqueda proporcionados 
	 (se utiliza en los reportes de pólizas)*/
	public function buscar_polizas($dteFechaInicial = NULL , $dteFechaFinal = NULL,
								   $strFolioInicial = NULL, $strFolioFinal = NULL,  
								   $strTipoPoliza = NULL, $strSucursales = NULL, $strModulos = NULL)
	{

		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';
		//ID´s de las sucursales
		$strRestriccionesSucursales = '';
		//Modulos
		$strRestriccionesModulos = '';

		//Si existe tipo de póliza
		if($strTipoPoliza != NULL)
		{

			//Si no existen restricciones asignar condición WHERE
			$strRestricciones .= (($strRestricciones !== '') ? 
									" AND " : "WHERE ");

			$strRestricciones .= "P.tipo = '$strTipoPoliza'";
		}

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		{
			//Si no existen restricciones asignar condición WHERE
			$strRestricciones .= (($strRestricciones !== '') ? 
									" AND " : "WHERE ");

			$strRestricciones .= "(P.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
		}

		//Si existe rango de folios
	    if($strFolioInicial != NULL && $strFolioFinal != NULL)
		{
			//Si no existen restricciones asignar condición WHERE
			$strRestricciones .= (($strRestricciones !== '') ? 
									" AND " : "WHERE ");

			$strRestricciones .= "(P.folio >= '$strFolioInicial' AND P.folio <= '$strFolioFinal')";
		}


		//Si existen sucursales seleccionadas
		if($strSucursales)
		{	
			//Si no existen restricciones asignar condición WHERE
			$strRestriccionesSucursales .= (($strRestricciones !== '') ? 
											" AND " : "WHERE ");

			//Generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
			$strRestriccionesSucursales .= " (";

		    //Quitar | de la lista para obtener el id de la sucursal
			$arrSucursales = explode("|", $strSucursales);

			//Hacer recorrido para formar restricción con los ID's de las sucursales
			for ($intCon = 0; $intCon < sizeof($arrSucursales); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otra sucursal)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesSucursales .= " OR ";
				}

				//Concatenar id de la sucursal 
				$strRestriccionesSucursales .= "P.sucursal_id = ".$arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}


		//Si existen modulos seleccionados
		if($strModulos)
		{
			//Generar las condiciones dinamicas de las consultas respecto a la columna modulo
			$strRestriccionesModulos .= " AND (";

		    //Quitar | de la lista para obtener el modulo
			$arrModulos = explode("|", $strModulos);

			//Hacer recorrido para formar restricción con los modulos
			for ($intCon = 0; $intCon < sizeof($arrModulos); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otro modulo)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesModulos .= " OR ";
				}

				//Concatenar modulo
				$strRestriccionesModulos .= "P.modulo =  "."'".$arrModulos[$intCon]."'";
			}

			$strRestriccionesModulos .= ")";
		}


		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$strSQL = $this->db->query("SELECT P.poliza_id, P.tipo, P.folio, P.modulo, P.proceso,
										   DATE_FORMAT(P.fecha,'%d/%m/%Y') AS fecha, 
						   				   P.concepto,  P.estatus, 
						   				   S.nombre AS sucursal, 
						   				    CASE 
											   WHEN  MR.movimiento_refacciones_id > 0 
											   		THEN MR.folio
											   WHEN  FR.factura_refacciones_id > 0
											   		THEN FR.folio
											   WHEN  MM.movimiento_maquinaria_id > 0 
											   		THEN MM.folio
											   WHEN  FM.factura_maquinaria_id > 0
											   		THEN FM.folio
											   WHEN  TF.trabajo_foraneo_id > 0 
											   		THEN TF.folio
											   WHEN  FS.factura_servicio_id > 0
											   		THEN FS.folio
												   WHEN  FC.factura_concepto_id > 0
											   		THEN FC.folio
											   WHEN  ORR.orden_reparacion_id > 0
											   		THEN ORR.folio
											   WHEN  NCS.nota_credito_servicio_id > 0
											   		THEN NCS.folio
											   WHEN  A.anticipo_id > 0
											   		THEN A.folio
											   WHEN  ANF.anticipo_no_fiscal_id > 0
											   		THEN ANF.folio
											   WHEN  RI.recibo_ingreso_id > 0
											   		THEN RI.folio
											   WHEN  PG.pago_id > 0
											   		THEN PG.folio
											   WHEN  TCB.traspaso_caja_banco_id > 0
											   		THEN TCB.folio
											    WHEN  NCRE.nota_credito_digital_id > 0
											   		THEN NCRE.folio
											    WHEN  NCA.nota_cargo_id > 0
											   		THEN NCA.folio
											   WHEN  NCAD.nota_cargo_digital_id > 0
											   		THEN NCAD.folio
											   WHEN  PA.poliza_abono_id > 0
											   		THEN PA.folio
											   WHEN  MRI.movimiento_refacciones_internas_id > 0 
											   		THEN MRI.folio
											   WHEN  TFI.trabajo_foraneo_interno_id > 0 
											   		THEN TFI.folio
											   WHEN  ORI.orden_reparacion_interna_id > 0 
											   		THEN ORI.folio
											   ELSE ''
										    END AS  referencia
						   			FROM polizas AS P
						   			INNER JOIN sucursales AS S ON P.sucursal_id = S.sucursal_id
						   			LEFT JOIN movimientos_refacciones AS MR ON  P.referencia_id = MR.movimiento_refacciones_id 
										 AND  P.modulo = 'REFACCIONES'
										 AND (P.proceso = 'ENTRADA POR COMPRA' OR 
										 	  P.proceso = 'ENTRADA POR DEVOLUCION DE CLIENTE' OR 
										      P.proceso = 'ENTRADA POR DEVOLUCION DE TALLER' OR 
										      P.proceso = 'ENTRADA POR TRASPASO' OR
											  P.proceso = 'ENTRADA POR AJUSTE' OR  
											  P.proceso = 'SALIDA POR TALLER' OR 
										      P.proceso = 'SALIDA POR CONSUMO INTERNO' OR 
										      P.proceso = 'SALIDA POR TRASPASO' OR
										      P.proceso = 'SALIDA POR DEVOLUCION AL PROVEEDOR' OR  
										      P.proceso = 'SALIDA POR AJUSTE')
									LEFT JOIN  facturas_refacciones AS FR ON P.referencia_id = FR.factura_refacciones_id  
										 AND  P.modulo = 'REFACCIONES' AND P.proceso = 'FACTURACION'
									LEFT JOIN movimientos_maquinaria AS MM ON  P.referencia_id = MM.movimiento_maquinaria_id 
										 AND  P.modulo = 'MAQUINARIA'
										 AND (P.proceso = 'ENTRADA POR COMPRA' OR
										  	  P.proceso = 'ENTRADA POR TRASPASO' OR
										 	  P.proceso = 'ENTRADA POR DEVOLUCION DE CLIENTE' OR 
											  P.proceso = 'ENTRADA POR AJUSTE' OR
											  P.proceso = 'SALIDA POR VENTA' OR 
											  P.proceso = 'SALIDA POR TRASPASO' OR
											  P.proceso = 'SALIDA POR DEMOSTRACION' OR
											  P.proceso = 'SALIDA POR VALIDACION' OR
										      P.proceso = 'SALIDA POR CONSUMO INTERNO' OR 
										      P.proceso = 'SALIDA POR DEVOLUCION AL PROVEEDOR' OR  
										      P.proceso = 'SALIDA POR AJUSTE')
									LEFT JOIN  facturas_maquinaria AS FM ON P.referencia_id = FM.factura_maquinaria_id  
										 AND  P.modulo = 'MAQUINARIA' AND P.proceso = 'FACTURACION'
									LEFT JOIN  trabajos_foraneos_02 AS TF ON P.referencia_id = TF.trabajo_foraneo_id  
										 AND  P.modulo = 'SERVICIO' AND P.proceso = 'TRABAJO FORANEO'
									LEFT JOIN  facturas_servicio AS FS ON P.referencia_id = FS.factura_servicio_id  
										 AND  P.modulo = 'SERVICIO' AND P.proceso = 'FACTURACION'
									LEFT JOIN  facturas_conceptos AS FC ON P.referencia_id = FC.factura_concepto_id  
										 AND  P.modulo = 'CONTABILIDAD' AND P.proceso = 'FACTURACION'
									LEFT JOIN  ordenes_reparacion AS ORR ON P.referencia_id = ORR.orden_reparacion_id  
										 AND  P.modulo = 'SERVICIO' AND P.proceso = 'ORDEN DE TRABAJO'
									LEFT JOIN  notas_credito_servicio AS NCS ON P.referencia_id = NCS.nota_credito_servicio_id  
										 AND  P.modulo = 'SERVICIO' AND P.proceso = 'NOTA CREDITO SERVICIO'
									LEFT JOIN  anticipos AS A ON P.referencia_id = A.anticipo_id  
										 AND  P.modulo = 'CAJA' AND P.proceso = 'ANTICIPO'
									LEFT JOIN  anticipos_no_fiscales AS ANF ON P.referencia_id = ANF.anticipo_no_fiscal_id  
										 AND  P.modulo = 'CAJA' AND P.proceso = 'RECIBO INTERNO ANTICIPO'
									LEFT JOIN  recibos_ingreso AS RI ON P.referencia_id = RI.recibo_ingreso_id  
										 AND  P.modulo = 'CUENTAS POR COBRAR' AND P.proceso = 'RECIBO INGRESO'
									LEFT JOIN  notas_credito_digitales AS NCRE ON P.referencia_id = NCRE.nota_credito_digital_id  
										 AND  P.modulo = 'CUENTAS POR COBRAR' AND P.proceso = 'NOTA CREDITO'
									LEFT JOIN  notas_cargo AS NCA ON P.referencia_id = NCA.nota_cargo_id  
										 AND  P.modulo = 'CUENTAS POR COBRAR' AND P.proceso = 'NOTA CARGO'
								    LEFT JOIN  notas_cargo_digitales AS NCAD ON P.referencia_id = NCAD.nota_cargo_digital_id  
										 AND  P.modulo = 'CUENTAS POR COBRAR' AND P.proceso = 'NOTA CARGO DIGITAL'
									LEFT JOIN  polizas_abono_02 AS PA ON P.referencia_id = PA.poliza_abono_id  
										 AND  P.modulo = 'CUENTAS POR COBRAR' AND P.proceso = 'POLIZA ABONO'
									LEFT JOIN  pagos AS PG ON P.referencia_id = PG.pago_id  
										 AND  P.modulo = 'CAJA' AND P.proceso = 'RECEPCION PAGO'
								    LEFT JOIN  traspasos_caja_bancos AS TCB ON P.referencia_id = TCB.traspaso_caja_banco_id  
										 AND  P.modulo = 'CAJA' AND P.proceso = 'TRASPASO BANCOS'
									LEFT JOIN movimientos_refacciones_internas AS MRI ON  P.referencia_id = MRI.movimiento_refacciones_internas_id 
										 AND  P.modulo = 'CONTROL DE VEHICULOS'
										 AND (P.proceso = 'ENTRADA POR TRASPASO ALMACEN GENERAL' OR 
										      P.proceso = 'ENTRADA POR DEVOLUCION DE TALLER' OR 
											  P.proceso = 'ENTRADA POR AJUSTE' OR  
											  P.proceso = 'SALIDA POR TALLER' OR 
										      P.proceso = 'SALIDA POR CONSUMO INTERNO' OR 
										      P.proceso = 'SALIDA POR TRASPASO' OR 
										      P.proceso = 'SALIDA POR AJUSTE')
								    LEFT JOIN  trabajos_foraneos_internos AS TFI ON P.referencia_id = TFI.trabajo_foraneo_interno_id  
										 AND  P.modulo = 'CONTROL DE VEHICULOS' AND P.proceso = 'TRABAJO FORANEO'
								    LEFT JOIN  ordenes_reparacion_internas AS ORI ON P.referencia_id = ORI.orden_reparacion_interna_id  
										 AND  P.modulo = 'CONTROL DE VEHICULOS' AND P.proceso = 'ORDEN DE TRABAJO'
						   			$strRestricciones
						   			$strRestriccionesSucursales
						   			$strRestriccionesModulos
						   			ORDER BY P.fecha DESC, P.folio DESC");
		return $strSQL->result();


	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $strEstatus = NULL, 
						   $strModulo = NULL, $strProceso = NULL, $strBusqueda =  NULL,
		                   $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('P.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(P.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe módulo
		if($strModulo != 'TODOS')
		{
			$this->db->where('P.modulo', $strModulo);
		}

		//Si existe proceso
		if($strProceso != 'TODOS')
		{
			$this->db->where('P.proceso', $strProceso);
		}

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('P.estatus', $strEstatus);
		}

		$this->db->where("(P.folio LIKE '%$strBusqueda%' OR
						   P.concepto LIKE '%$strBusqueda%' OR
						   P.tipo LIKE '%$strBusqueda%')"); 

		$this->db->from('polizas AS P');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("P.poliza_id, P.tipo, P.folio, DATE_FORMAT(P.fecha,'%d/%m/%Y') AS fecha, 
						   P.referencia_id, P.concepto, P.estatus, 
						   CONCAT('$', FORMAT(IFNULL((SELECT SUM(PD.importe) 
											   		 FROM polizas_detalles AS PD
											   		 INNER JOIN catalogo_cuentas AS CC ON PD.cuenta_id = CC.cuenta_id
											   		 WHERE PD.poliza_id = P.poliza_id
											   		 AND PD.naturaleza = 'CARGO'),0),2)) AS total_cargos,
						   CONCAT('$', FORMAT(IFNULL((SELECT SUM(PD.importe) 
											   		 FROM polizas_detalles AS PD
											   		 INNER JOIN catalogo_cuentas AS CC ON PD.cuenta_id = CC.cuenta_id
											   		 WHERE PD.poliza_id = P.poliza_id
											   		 AND PD.naturaleza = 'ABONO'),0),2)) AS total_abonos", FALSE);
		$this->db->from('polizas AS P');
		$this->db->where('P.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(P.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe módulo
		if($strModulo != 'TODOS')
		{
			$this->db->where('P.modulo', $strModulo);
		}

		//Si existe proceso
		if($strProceso != 'TODOS')
		{
			$this->db->where('P.proceso', $strProceso);
		}

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('P.estatus', $strEstatus);
		}

		$this->db->where("(P.folio LIKE '%$strBusqueda%' OR
						   P.concepto LIKE '%$strBusqueda%' OR
						   P.tipo LIKE '%$strBusqueda%')"); 
		$this->db->order_by('P.fecha DESC, P.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["polizas"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $intSucursalID = NULL, $strEstatus = NULL)
	{
		$this->db->select(' poliza_id, folio');
        $this->db->from('polizas');
        //Si existe sucursal seleccionda (modal)
        if($intSucursalID !== NULL)
        {
        	//Si existe id de la sucursal
        	if($intSucursalID > 0)
        	{
        		$this->db->where('sucursal_id', $intSucursalID);
        	}

        }
        else
        {
        	$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
        }

        //Si existe estatus
        if($strEstatus !== NULL)
        {
        	 $this->db->where('estatus', $strEstatus);
        }
        $this->db->where("(folio LIKE '%$strDescripcion%')");  
        $this->db->order_by("folio",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	


	/*******************************************************************************************************************
	Funciones de la tabla polizas_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la póliza
	public function guardar_detalles(stdClass $objPoliza)
	{

		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener los detalles de la póliza
		foreach ($objPoliza->arrDetalles as $arrDets)
		{
			//Hacer recorrido para obtener los datos del detalle
			foreach ($arrDets as $arrDet)
			{
				//Incrementar renglón consecutivo
				$intRenglon++;

				//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
				//Asignar datos al array
				$arrDatos = array('poliza_id' => $objPoliza->intPolizaID,
								  'renglon' => $intRenglon,
								  'cuenta_id' => $arrDet->intCuentaID,
								  'importe' => $arrDet->intImporte,
								  'naturaleza' => $arrDet->strNaturaleza,
								  'referencia' => mb_strtoupper($arrDet->strReferencia),
								  'concepto' => mb_strtoupper($arrDet->strConcepto));
				//Guardar los datos del registro
				$this->db->insert('polizas_detalles', $arrDatos);

				//Hacer un llamado al método para guardar los detalles Diot del detalle
				$this->guardar_detalles_diot($objPoliza->intPolizaID, $intRenglon, $arrDet->arrDetallesDiot);

			}
		}

	}


	//Función que se utiliza para guardar los detalles de la póliza generada automáticamente
	public function guardar_detalles_cierre(stdClass $objPoliza)
	{

		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener los datos del detalle
		foreach ($objPoliza->arrDetalles as $arrDet)
		{
			//Incrementar renglón consecutivo
			$intRenglon++;

			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
			//Asignar datos al array
			$arrDatos = array('poliza_id' => $objPoliza->intPolizaID,
							  'renglon' => $intRenglon,
							  'cuenta_id' => $arrDet->intCuentaID,
							  'importe' => $arrDet->intImporte,
							  'naturaleza' => $arrDet->strNaturaleza,
							  'referencia' => mb_strtoupper($arrDet->strReferencia),
							  'concepto' => mb_strtoupper($arrDet->strConcepto));
			//Guardar los datos del registro
			$this->db->insert('polizas_detalles', $arrDatos);

		}
	}


	//Función que se utiliza para guardar los detalles de la póliza generada automáticamente
	public function guardar_detalles_generados(stdClass $objPoliza)
	{	
		//Variable que se utiliza para asignar el acumulado de cargos
		$numCargo = 0;
		//Variable que se utiliza para asignar el acumulado de abonos
		$numAbono = 0;

		//Hacer recorrido para obtener los datos del detalle
		foreach($objPoliza->arrDetalles as $arrDet)
		{	
			//Dependiendo de la naturaleza incrementar acumulados
			if ($arrDet['naturaleza'] == 'CARGO')
			{
				//Incrementar acumulado de cargos
				$numCargo += $arrDet['importe'];
			}
			else
			{
				//Incrementar acumulado de abonos
				$numAbono += $arrDet['importe'];
			}

			//Asignar datos al array
			$arrDatos = array('poliza_id' => $objPoliza->intPolizaID,
							  'renglon' => $arrDet['renglon'],
							  'cuenta_id' => $arrDet['cuenta_id'],
							  'importe' => $arrDet['importe'],
							  'naturaleza' => $arrDet['naturaleza'],
							  'referencia' => $arrDet['referencia'],
							  'concepto' => $arrDet['concepto']);
			//Guardar los datos del registro
			$this->db->insert('polizas_detalles', $arrDatos);

		}//Cierre de foreach



	    //Convertir cantidad a cinco decimales
		$numCargo = number_format($numCargo, 5, '.', '');
		$numAbono = number_format($numAbono, 5, '.', '');


		//Si se cumple la sentencia
		if (($objPoliza->strEstatus == 'ACTIVO') && (($numCargo != $numAbono) OR ($numCargo == 0)))
		{
			//Hacer un llamado a la función para cambiar el estatus de la póliza
			$this->set_estatus($objPoliza->intPolizaID, 'NO APLICADA');
		}	
	
	
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intPolizaID)
	{
		$this->db->select("PD.renglon, PD.cuenta_id, PD.importe, PD.naturaleza, 
						   PD.referencia, PD.concepto, 
						   CONCAT_WS(' ', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel) AS cuenta,
						   CC.descripcion AS cuenta_descripcion,
						   IFNULL(CC.cuenta_padre_id,0) AS cuenta_padre_id, 
						   CC.descripcion AS descripcion_cuenta, CC.primer_nivel AS cuenta_principal, 
						   CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel", FALSE);
		$this->db->from('polizas_detalles AS PD');
		$this->db->join('catalogo_cuentas AS CC', 'PD.cuenta_id = CC.cuenta_id', 'inner');
		$this->db->where('PD.poliza_id', $intPolizaID);
		$this->db->order_by('PD.renglon', 'ASC');
		return $this->db->get()->result();
	}

	//Método para generar los detalles de la póliza de cierre de año
	public function generar_detalles_polizas_cierre($strFecha, $intCuentaResultados)
	{
		$arrDetalle = array();
		$numCargos = 0;
		$numAbonos = 0;

		$arrCuentas = explode('|', ARR_POLIZA_CIERRE);

		foreach($arrCuentas AS $strCuenta)
		{
			$this->db->select('cuenta_id');
			$this->db->from('catalogo_cuentas');
			$this->db->where('primer_nivel', $strCuenta);
			$this->db->order_by('primer_nivel, segundo_nivel, tercer_nivel, cuarto_nivel');
			$objCuentas = $this->db->get();
			foreach($objCuentas->result() AS $objRenCue)
			{
				$this->db->select("CC.cuenta_id, 
								   (SELECT SUM(PD.importe) AS importe 
								    FROM   polizas P INNER JOIN polizas_detalles PD 
										   ON PD.poliza_id = P.poliza_id 
								    WHERE  PD.cuenta_id = CC.cuenta_id 
								    AND    PD.naturaleza = 'CARGO' 
								    AND    P.fecha <= '$strFecha' 
								    AND    P.estatus = 'ACTIVO') AS Cargos, 
								   (SELECT SUM(PD.importe) AS importe 
								    FROM   polizas P INNER JOIN polizas_detalles PD 
										   ON PD.poliza_id = P.poliza_id 
								    WHERE  PD.cuenta_id = CC.cuenta_id 
								    AND    PD.naturaleza = 'ABONO' 
								    AND    P.fecha <= '$strFecha' 
								    AND    P.estatus = 'ACTIVO') AS Abonos", FALSE);
				$this->db->from('catalogo_cuentas AS CC');
				$this->db->where('CC.cuenta_id', $objRenCue->cuenta_id);
				$objSaldos = $this->db->get();
				foreach($objSaldos->result() AS $objRenSal)
				{
					if ((($objRenSal->Cargos - $objRenSal->Abonos) > 0) OR (($objRenSal->Abonos - $objRenSal->Cargos) > 0))
					{
						if (($objRenSal->Cargos - $objRenSal->Abonos) > 0)
						{
							$numAbonos += round(($objRenSal->Cargos - $objRenSal->Abonos), 5);
							$numImporte = round(($objRenSal->Cargos - $objRenSal->Abonos), 5);
							$strNaturaleza = "ABONO";
						}
						else
						{
							$numCargos += round(($objRenSal->Abonos - $objRenSal->Cargos), 5);
							$numImporte = round(($objRenSal->Abonos - $objRenSal->Cargos), 5);
							$strNaturaleza = "CARGO";
						}
						array_push($arrDetalle, array('intCuentaID' => $objRenSal->cuenta_id, 
													  'intImporte' => $numImporte, 
													  'strNaturaleza' => $strNaturaleza, 
													  'strReferencia' => '', 
													  'strConcepto' => ''));
					}
				}
			}
		}
		if (($numCargos - $numAbonos) > 0){
			$numImporte = round(($numCargos - $numAbonos), 5);
			$strNaturaleza = "ABONO";
		}
		else{
			$numImporte = round(($numAbonos - $numCargos), 5);
			$strNaturaleza = "CARGO";
		}
		array_push($arrDetalle, array('intCuentaID' => $intCuentaResultados, 
									  'intImporte' => $numImporte, 
									  'strNaturaleza' => $strNaturaleza, 
									  'strReferencia' => '', 
									  'strConcepto' => ''));

		return json_decode(json_encode($arrDetalle), FALSE);
	}

	/*******************************************************************************************************************
	Funciones de la tabla polizas_detalles_diot
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles Diot de la póliza
	public function guardar_detalles_diot($intPolizaID, $intRenglonDetalle, $arrDetallesDiot)
	{
		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener los detalles relacionados del detalle
		foreach ($arrDetallesDiot as $arrDet)
		{
			//Incrementar renglón consecutivo
			$intRenglon++;

			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
			//Asignar datos al array
			$arrDatos = array('poliza_id' => $intPolizaID,
							  'renglon_detalles' => $intRenglonDetalle,
							  'renglon' => $intRenglon,
							  'proveedor_id' => $arrDet->intProveedorID,
							  'serie' => mb_strtoupper($arrDet->strSerie),
							  'folio' => mb_strtoupper($arrDet->strFolio),
							  'referencia' => mb_strtoupper($arrDet->strReferencia),
							  'tasa_cuota_iva' => $arrDet->intTasaCuotaIva,
							  'importe_base' => $arrDet->intImporteBase,
							  'importe_iva' => $arrDet->intImporteIva);
			//Guardar los datos del registro
			$this->db->insert('polizas_detalles_diot', $arrDatos);

		}
	}

	 //Método para regresar los detalles Diot de un registro
	public function buscar_detalles_diot($intPolizaID, $intRenglonDetalle)
	{
		$this->db->select("PDD.renglon, PDD.proveedor_id, PDD.serie, PDD.folio, PDD.referencia, 
						   PDD.tasa_cuota_iva, PDD.importe_base, PDD.importe_iva, 
						   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor,
						   TIva.valor_maximo AS porcentaje_iva", FALSE);
		$this->db->from('polizas_detalles_diot AS PDD');
		$this->db->join('proveedores AS P', 'PDD.proveedor_id = P.proveedor_id', 'inner');
		 $this->db->join('sat_tasa_cuota AS TIva', 'PDD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->where('PDD.poliza_id', $intPolizaID);
		$this->db->where('PDD.renglon_detalles', $intRenglonDetalle);
		$this->db->order_by('PDD.renglon', 'ASC');
		return $this->db->get()->result();
	}
}	
?>