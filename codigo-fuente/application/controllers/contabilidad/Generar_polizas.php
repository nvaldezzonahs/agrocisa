<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generar_polizas extends MY_Controller {
	//Variables de la clase
    //Información que se envia a la vista
    var $ARR_DATOS = NULL;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo de sucursales contables
		$this->load->model('contabilidad/sucursales_contabilidad_model', 'config_contable');
		//Cargamos el modelo de configuraciones para pólizas
		$this->load->model('servicio/configuracion_polizas_model', 'config_polizas');
		//Cargamos el modelo de cuentas
		$this->load->model('contabilidad/catalogo_cuentas_model', 'cuentas');
		//Cargamos el modelo de pólizas
		$this->load->model('contabilidad/polizas_model', 'polizas');
		//Cargamos el modelo de movimientos de maquinaria
		$this->load->model('maquinaria/movimientos_maquinaria_model', 'mov_maquinaria');
		//Cargamos el modelo de facturas de conceptos
		$this->load->model('contabilidad/facturas_conceptos_model', 'facturas_conceptos');
		//Cargamos el modelo de facturas de servicio
		$this->load->model('servicio/facturas_servicio_model', 'facturas_servicio');
		//Cargamos el modelo de ordenes de reparación
		$this->load->model('servicio/ordenes_reparacion_model', 'ordenes');
		//Cargamos el modelo de facturas de refacciones
		$this->load->model('refacciones/facturas_refacciones_model', 'facturas_refacciones');
		//Cargamos el modelo de facturas de maquinaria
		$this->load->model('maquinaria/facturas_maquinaria_model', 'facturas_maquinaria');
		//Cargamos el modelo de inventario de maquinaria
		$this->load->model('maquinaria/maquinaria_inventario_model', 'inventario_maquinaria');
			//Cargamos el modelo de ordenes de reparación interna
		$this->load->model('control_vehiculos/ordenes_reparacion_internas_model', 'ordenes_internas');
		//Cargamos el modelo de movimientos de refacciones internas
		$this->load->model('control_vehiculos/movimientos_refacciones_internas_model', 'mov_refacciones_internas');
		//Cargamos el modelo de notas de crédito
		$this->load->model('cuentas_cobrar/notas_credito_digitales_model', 'notas');
		//Cargamos el modelo de anticipos
		$this->load->model('caja/anticipos_model', 'anticipos');
		//Cargamos el modelo de aplicación de anticipos
		$this->load->model('caja/anticipos_aplicacion_model', 'aplicacion');
		//Cargamos el modelo de pagos
		$this->load->model('caja/pagos_model', 'pagos');
		//Variable que se utiliza para asignar los errores al generar la póliza
        $this->ARR_DATOS['strError'] = '';
        //Variable que se utiliza para asignar el folio de la referencia de la póliza
        $this->ARR_DATOS['strFolioReferencia'] = '';
        //Variable que se utiliza para asignar el id de la póliza generada (nuevo registro)
        $this->ARR_DATOS['intPolizaID'] = 0;
	}

	//Método para generar la póliza de un registro
	public function generar_poliza()
	{
		//No mostrar los errores de php
	    error_reporting(0);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intReferenciaID = $this->input->post('intReferenciaID');
		$strTipoReferencia = $this->input->post('strTipoReferencia');
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));

		//Dependiendo del tipo de referencia generar póliza
	    switch ($strTipoReferencia) 
        {
		   	case "FACTURA CONCEPTOS":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_conceptos($intReferenciaID, $intProcesoMenuID);
		    	break; 	 
		    case "FACTURA SERVICIO":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_servicio($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 
		    case "TRABAJO FORANEO":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_servicio($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 	
		    case "ORDEN DE TRABAJO":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_servicio($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 	
		    case "FACTURA REFACCIONES":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_refacciones($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 	
		    case "MOVIMIENTO DE REFACCIONES":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_refacciones($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 	
		     case "FACTURA MAQUINARIA":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_maquinaria($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break;
		     case "MOVIMIENTO DE MAQUINARIA":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_maquinaria($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 
		    case "ORDEN DE TRABAJO INTERNA":
		    	//Cambiar el tipo de referencia
		    	$strTipoReferencia = "ORDEN DE TRABAJO";
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_orden_reparacion_interna($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break;
		    case "MOVIMIENTO DE REFACCIONES INTERNAS":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_refacciones_internas($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 	
		     case "TRABAJO FORANEO INTERNO":
		     	//Cambiar el tipo de referencia
		    	$strTipoReferencia = "TRABAJO FORANEO";
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_refacciones_internas($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 	
		     case "NOTA CREDITO":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_diario($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 	
		     case "NOTA CARGO":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_diario($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 
		     case "NOTA CARGO DIGITAL":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_diario($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 
		     case "NOTA CREDITO SERVICIO":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_diario($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 
		    case "ANTICIPO":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_ingresos($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 
		    case "RECIBO INTERNO ANTICIPO":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_ingresos($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 
		    case "RECIBO INGRESO":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_ingresos($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 
		    case "TRASPASO BANCOS":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_ingresos($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 
		   case "POLIZA ABONO":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_aplicacion($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 
		    case "PAGO":
		    	//Hacer un llamado a la función para generar póliza
		   	    $this->get_poliza_pago($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		    	break; 
		}


		//Si no se obtienen errores al ejecutar el proceso
		if ($this->ARR_DATOS['strError'] == '')
		{
			//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE, 
							  'tipo_mensaje' => TIPO_MSJ_EXITO, 
							  'poliza_id' => $this->ARR_DATOS['intPolizaID'],
							  'mensaje' => 'La póliza se generó correctamente.');
		}
		else
		{

			//Enviar el mensaje de error al formulario
			$arrDatos = array('resultado' => FALSE, 
							  'tipo_mensaje' => TIPO_MSJ_ERROR, 
							  'mensaje' => '<b>No es posible generar póliza de la referencia: '.
							  				$this->ARR_DATOS['strFolioReferencia'].'</b><br>'.
							  				$this->ARR_DATOS['strError']);
		}

		//Enviar datos a la vista
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}



	
	//Método para generar una póliza con los datos de la factura de conceptos
	public function get_poliza_conceptos($intReferenciaID, $intProcesoMenuID)
	{	
		//------------------------------------------------------------------------------------------------------------------------
		//---------- DATOS DE LA FACTURA 
		//------------------------------------------------------------------------------------------------------------------------
       	//Seleccionar datos del registro
	    $otdFra = $this->facturas_conceptos->buscar($intReferenciaID);
		//------------------------------------------------------------------------------------------------------------------------
		//---------- DETALLES DE LA FACTURA 
		//------------------------------------------------------------------------------------------------------------------------
		//Seleccionar los detalles del registro
	    $otdDetalles = $this->facturas_conceptos->buscar_detalles_poliza($intReferenciaID);

	    //Verificar si hay información del registro
		if($otdFra)
		{

			//Asignar el folio de la referencia (movimiento/factura)
			$this->ARR_DATOS['strFolioReferencia'] = $otdFra->folio;

			//Crear un objeto vacio, stdClass es el objeto Póliza
			$objPoliza = new stdClass();
			//Array que se utiliza para agregar los detalles de la póliza 
			$arrDetalles = array();
			//Array que se utiliza para agregar los datos de un detalle
			$arrAuxiliar = array();
			//Variables que se utilizan para asignar datos de la póliza
			$strConcepto = '';
			$strObservaciones = '';
			//Variables que se utilizan para asignar datos del detalle
			$intRenglon = 1;
			$intConceptoTipoID = 0;
			//Variable que se utiliza para acumular el subtotal
			$numSubtotal = 0;
			//Variable que se utiliza para acumular el importe de IVA
			$numIVA = 0;
			
			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL REGISTRO 
	        //------------------------------------------------------------------------------------------------------------------------
			//Verificar si existe información de los detalles 
			if ($otdDetalles) 
			{ 
				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDet)
				{
					//Asignar valores del detalle
					$strConcepto = 'DIARIO POR VENTA FACTURA DE '.$arrDet->Concepto;
					$intConceptoTipoID = $arrDet->concepto_tipo_id;
					//Incrementar acumulados
					$numSubtotal += $arrDet->Subtotal;
					$numIVA += $arrDet->IVA;

				}//Cierre de foreach

			}//Cierre de verificación de detalles

			//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
			$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);
			//Si hay información de la cuenta contable
			if($otdConfContable)
			{
				//Asignar cuenta contable
				$strCuentaContable =  $otdConfContable->cuenta_contable;
				//Datos del cliente
				$arrAuxiliar['renglon'] = $intRenglon;
				//Crear un objeto vacio, stdClass es el objeto Cuenta
				$objCuenta = new stdClass();
				//Asignar datos al objeto Cuenta contable
				$objCuenta->intCuentaPadreID = NULL;
				$objCuenta->intSatCuentaID = NULL;
				//Definir datos de la cuenta
				$objCuenta->strPrimerNivel = '105';
				$objCuenta->strSegundoNivel = $strCuentaContable;
				//Si existe importe de IVA
				if ($numIVA > 0)
				{
					$objCuenta->strTercerNivel = '11';
				}
				else
				{
					$objCuenta->strTercerNivel = '12';
				}

				$objCuenta->strCuartoNivel = $otdFra->CodigoProspecto;
				$objCuenta->strDescripcion = $otdFra->razon_social;
				$objCuenta->strNaturaleza = NULL;
				$objCuenta->strTipoCuenta = NULL;
				$objCuenta->strAceptaMovimientos = 'SI';
				$objCuenta->strMovimientosBancarios = 'NO';


				//Calcular importe
				$intImporte = ($numSubtotal + $numIVA);

				//Hacer un llamado a la función para obtener los datos de la cuenta 
				$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
				$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
				$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
				$arrAuxiliar['naturaleza'] = 'CARGO';
				$arrAuxiliar['referencia'] = '';
				$arrAuxiliar['concepto'] = '';
				//Si existe id de la cuenta
				if ($arrAuxiliar['cuenta_id'] > 0)
				{	
					//Agregar datos al array
					array_push($arrDetalles, $arrAuxiliar);
					//Incrementar renglón
					$intRenglon++;
				}
				

				//Datos de las ventas
				$arrAuxiliar['renglon'] = $intRenglon;
				//Crear un objeto vacio, stdClass es el objeto Cuenta
				$objCuenta = new stdClass();

				//Dependiendo del tipo de concepto asignar los datos de la cuenta
				if ($intConceptoTipoID == CONCEPTO_TIPO_SMPI)//Servicios maquinaria pesada fintegra
				{
				   //Definir datos de la cuenta
					$objCuenta->strPrimerNivel = '401';
					$objCuenta->strSegundoNivel = $strCuentaContable;
					$objCuenta->strTercerNivel = '30';
					$objCuenta->strCuartoNivel = '00000';
				}
				else if ($intConceptoTipoID == CONCEPTO_TIPO_CVS)//Comisión por venta de seguros
				{
					//Definir datos de la cuenta
					$objCuenta->strPrimerNivel = '401';
					$objCuenta->strSegundoNivel = $strCuentaContable;
					$objCuenta->strTercerNivel = '26';
					$objCuenta->strCuartoNivel = '00000';
				}
				else if ($intConceptoTipoID == CONCEPTO_TIPO_RGI)//Recuperación de gastos inversiones
				{
					//Definir datos de la cuenta
					$objCuenta->strPrimerNivel = '401';
					$objCuenta->strSegundoNivel = $strCuentaContable;
					$objCuenta->strTercerNivel = '16';
					$objCuenta->strCuartoNivel = '00000';
				}
				else if ($intConceptoTipoID == CONCEPTO_TIPO_VAFTP)//Venta de activo fijo  (transmisión de propiedad)
				{
					//Definir datos de la cuenta
					$objCuenta->strPrimerNivel = '403';
					$objCuenta->strSegundoNivel = '01';
					$objCuenta->strTercerNivel = '01';
					$objCuenta->strCuartoNivel = '10000';
				}
				else if ($intConceptoTipoID == CONCEPTO_TIPO_VAFIA)//Venta de activo fijo (indemnización aseguradora)
				{
					//Definir datos de la cuenta
					$objCuenta->strPrimerNivel = '403';
					$objCuenta->strSegundoNivel = '01';
					$objCuenta->strTercerNivel = '01';
					$objCuenta->strCuartoNivel = '20000';
				}
				else if ($intConceptoTipoID == CONCEPTO_TIPO_ICI)//Ingresos por cobro de intereses
				{
					//Definir datos de la cuenta
					$objCuenta->strPrimerNivel = '401';
					$objCuenta->strSegundoNivel = $strCuentaContable;
					$objCuenta->strTercerNivel = '32';
					$objCuenta->strCuartoNivel = '00000';
				}

				//Hacer un llamado a la función para obtener los datos de la cuenta
				$arrCuenta = $this->get_cuenta($objCuenta);
				$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
				$arrAuxiliar['importe'] = number_format($numSubtotal, 5, '.', '');
				$arrAuxiliar['naturaleza'] = 'ABONO';
				$arrAuxiliar['referencia'] = '';
				$arrAuxiliar['concepto'] = '';

				//Si existe id de la cuenta
				if ($arrAuxiliar['cuenta_id'] > 0)
				{
					//Agregar datos al array
					array_push($arrDetalles, $arrAuxiliar);
					//Incrementar renglón
					$intRenglon++;
				}


				//Si existe importe de IVA
				if ($numIVA > 0)
				{
					//Datos del IVA
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					//Definir datos de la cuenta
					$objCuenta->strPrimerNivel = '209';
					$objCuenta->strSegundoNivel = '01';
					$objCuenta->strTercerNivel = $strCuentaContable;;
					$objCuenta->strCuartoNivel = '00000';
					//Hacer un llamado a la función para obtener los datos de la cuenta
					$arrCuenta = $this->get_cuenta($objCuenta);
					$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					$arrAuxiliar['importe'] = number_format($numIVA, 5, '.', '');
					$arrAuxiliar['naturaleza'] = 'ABONO';
					$arrAuxiliar['referencia'] = '';
					$arrAuxiliar['concepto'] = '';

					//Si existe id de la cuenta
					if ($arrAuxiliar['cuenta_id'] > 0)
					{
						//Agregar datos al array
						array_push($arrDetalles, $arrAuxiliar);
						//Incrementar renglón
						$intRenglon++;
					}

				}//Cierre de verifición del importe de IVA

				//Asignar datos de la póliza
				$objPoliza->intSucursalID =  $otdFra->sucursal_id;
				$objPoliza->strTipo = 'DIARIO';
				$objPoliza->strModulo = 'CONTABILIDAD';
				$objPoliza->strProceso = 'FACTURACION';
				$objPoliza->intReferenciaID = $otdFra->factura_concepto_id;
				$objPoliza->dteFecha = $otdFra->fecha;
				$objPoliza->strConcepto = $strConcepto;
				$objPoliza->strObservaciones = $strObservaciones;
				$objPoliza->strEstatus = 'ACTIVO';
				$objPoliza->arrDetalles = $arrDetalles;

				//Hacer un llamado a la función para guardar los datos de la póliza en la BD
				$this->guardar_poliza_referencia($objPoliza, $intProcesoMenuID);
			}
			else
			{
				//Asignar mensaje de error
		 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
		 		$this->ARR_DATOS['strError'] .= '<br>';
			}

		}
		else
		{
			//Indicar mensaje de error (no se genera la póliza porque no se cumplen con las restricciones / no existe información del registro)
			$this->ARR_DATOS['strError'] = MSJ_ERROR_POLIZA;
		}
	}


	

	//Método para generar una póliza con los datos de la factura de servicio, orden de reparación o trabajo foráneo, etc.
	public function get_poliza_servicio($intReferenciaID, $strTipoReferencia, $intProcesoMenuID)
	{
		
		//Array que se utiliza para saber si el tipo de servicio generá póliza
		$arrTiposServicios = array(TIPO_SERVICIO_PREENTREGA, 
								   TIPO_SERVICIO_INTERNO, 
								   TIPO_SERVICIO_TALLER, 
								   TIPO_SERVICIO_VENTAS,
								   TIPO_SERVICIO_TRABAJO_FORANEO, 
								   TIPO_SERVICIO_FACTURACION);

		//------------------------------------------------------------------------------------------------------------------------
		//---------- DATOS DE LA REFERENCIA 
		//------------------------------------------------------------------------------------------------------------------------
       	//Seleccionar datos del registro
       	$otdFra = $this->facturas_servicio->buscar_referencia_poliza($intReferenciaID, $strTipoReferencia);
       	
       	//Verificar si hay información del registro
		if($otdFra)
		{
			//Asignar el folio de la referencia (movimiento/factura)
			$this->ARR_DATOS['strFolioReferencia'] = $otdFra->folio;
			
			//Crear un objeto vacio, stdClass es el objeto Póliza
			$objPoliza = new stdClass();
			//Crear instancia del objeto Inventario
			$objInventario = new Inventario();
			//Array que se utiliza para agregar los detalles de la póliza 
			$arrDetalles = array();
			//Array que se utiliza para agregar los datos de un detalle
			$arrAuxiliar = array();
			//Variables que se utilizan para asignar datos de la póliza
			$strConcepto = '';
			$strObservaciones = '';
			//Variables que se utilizan para asignar datos del detalle
			$intRenglon = 1;
			//Asignar el id del tipo de servicio
			$intServicioTipoID = $otdFra->servicio_tipo_id;
			//Constante para identificar los datos del SAT correspondientes al IVA 16%
			$intTasaCuotaIDIva = SAT_TASA_CUOTA_IVA_ID;
			//Constante para identificar los datos del SAT correspondientes al IVA cero
			$intTasaCuotaIDIvaCero = SAT_TASA_CUOTA_IVA_CERO_ID;

			//Si el tipo de servicio se encuentra en el array
			if(in_array($intServicioTipoID, $arrTiposServicios))
			{
				//------------------------------------------------------------------------------------------------------------------------
				//---------- DETALLES DE LA REFERENCIA 
				//------------------------------------------------------------------------------------------------------------------------
				//Seleccionar los detalles del registro
			    $otdDetalles = $this->facturas_servicio->buscar_detalles_poliza($intReferenciaID, 	
			    																$intServicioTipoID);


				//------------------------------------------------------------------------------------------------------------------------
		        //---------- DATOS DEL REGISTRO 
		        //------------------------------------------------------------------------------------------------------------------------
			    //Dependiendo del tipo de servicio generar póliza
				if($intServicioTipoID == TIPO_SERVICIO_PREENTREGA)//Pre entrega
				{
					//Variable que se utiliza para asignar serie
					$strSerie = '';
					//Variable que se utiliza para acumular el costo por mano de obra
					$numCostoManoObra = 0;
					//Variable que se utiliza para acumular el costo de refacciones
					$numCostoRefacciones = 0;
					//Variable que se utiliza para acumular el costo de trabajos foráneos
					$numCostoForaneos = 0;
					//Array que se utiliza para asignar los datos de la cuenta del departamento
					$arrModulo = NULL;

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Asignar valores del detalle
							$strConcepto = 'DIARIO POR PRE ENTREGA DE '.$arrDet->descripcion_corta;
							$strConcepto .= ' CON SERIE '.$arrDet->serie;
							$strObservaciones = $arrDet->observaciones;
							$strSerie =  $arrDet->serie;

							//Concatenar datos para realizar la búsqueda del departamento
	    					$strCriteriosBusq = $arrDet->maquinaria_linea_id.'|MAQUINARIA';
							//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
							$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

							//Si existen datos del departamento (cuenta de línea de maquinaria)
							if($otdConfDepto)
							{
								//Obtener los datos de la cuenta
								$arrModulo = explode("|", $otdConfDepto->cuenta);
							}

							//Si existe motor
							if ($arrDet->motor != '')
							{
								$strConcepto.= ' MOTOR '.$arrDet->motor;
								$strDescripcion = $arrDet->descripcion_corta;
								$strDescripcion .= ' NS.: '.$strSerie.'-'.$arrDet->motor;
							}
							else
							{
								$strDescripcion = $arrDet->descripcion_corta;
								$strDescripcion .= ' NS.: '.$strSerie;
							}

							//Dependiendo del tipo incrementar acumulado del costo
							if ($arrDet->Tipo == 'MANO OBRA')
							{ 
								$numCostoManoObra += $arrDet->Costo;
							}
							else if ($arrDet->Tipo == 'REFACCIONES')
							{
								$numCostoRefacciones += $arrDet->Costo;
							}
							else if ($arrDet->Tipo == 'FORANEOS')
							{
								$numCostoForaneos += $arrDet->Costo;
							}

						}//Cierre de foreach

					}//Cierre de verificación de detalles


					//Si existen datos de la cuenta de línea de maquinaria
					if($arrModulo != NULL)
					{


						//Hacer un llamado a la función para obtener los datos del rastreo
						$arrRastreo = $this->get_rastreo($strSerie, $otdFra->fecha);

						//Si existe existencia del rastreo
						if ($arrRastreo['existencia'] == 'SI')
						{
							//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
							$otdConfContable = $this->config_contable->buscar($arrRastreo['sucursal_id']);



							//Si hay información de la cuenta contable
							if($otdConfContable)
							{
								//Asignar cuenta contable
								$strCuentaContable =  $otdConfContable->cuenta_contable;


								//Datos del inventario
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->intCuentaPadreID = NULL;
								$objCuenta->intSatCuentaID = NULL;
								//Definir datos de la cuenta
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = $arrModulo[0];
								$objCuenta->strCuartoNivel = $arrRastreo['codigo_interno'];
								$objCuenta->strDescripcion = $strDescripcion;
								$objCuenta->strNaturaleza = NULL;
								$objCuenta->strTipoCuenta = NULL;
								$objCuenta->strAceptaMovimientos = 'SI';
								$objCuenta->strMovimientosBancarios = 'NO';

								//Calcular importe
								$intImporte = ($numCostoRefacciones + $numCostoManoObra + $numCostoForaneos);

								//Hacer un llamado a la función para obtener los datos de la cuenta 
								$arrCuenta =  $this->get_cuenta($objCuenta, 'SI', 'INVENTARIO');
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'CARGO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{	
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}
							}
							else
							{
								//Asignar mensaje de error
						 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE.' (rastreo)';
						 		$this->ARR_DATOS['strError'] .= '<br>';
							}

						}
						else
						{
							//Si no existe sucursal del restreo
							if ($arrRastreo['sucursal_id'] == 0)
							{
								//Asignar sucursal del registro (referencia)
								$arrRastreo['sucursal_id'] = $otdFra->sucursal_id;
							}

							//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
							$otdConfContable = $this->config_contable->buscar($arrRastreo['sucursal_id']);

							//Si hay información de la cuenta contable
							if($otdConfContable)
							{

								//Asignar cuenta contable
								$strCuentaContable =  $otdConfContable->cuenta_contable;

								//Datos del costo
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '501';
								$objCuenta->strSegundoNivel = '01';
								$objCuenta->strTercerNivel = $strCuentaContable;
								$objCuenta->strCuartoNivel = $arrModulo[0].'000';

								//Calcular importe
								$intImporte = ($numCostoRefacciones + $numCostoManoObra + $numCostoForaneos);

								//Hacer un llamado a la función para obtener los datos de la cuenta 
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'CARGO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{	
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}
							}
							else
							{
								//Asignar mensaje de error
						 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE.' (rastreo)';
						 		$this->ARR_DATOS['strError'] .= '<br>';
							}

						}//Cierre de verificación de la existencia de rastreo
				    }
				    else
				    {
				    	//Asignar mensaje de error
						$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
														(línea de maquinaria).';
						$this->ARR_DATOS['strError'] .= '<br>';
				    }


					//Verificar si existen acumulados de costos
					if($numCostoRefacciones > 0 OR $numCostoManoObra > 0 OR $numCostoForaneos > 0)
					{
						//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
						$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

						//Si hay información de la cuenta contable
						if($otdConfContable)
						{

							//Asignar cuenta contable
							$strCuentaContable =  $otdConfContable->cuenta_contable;

							/****Inventario***/
							//Si existe costo de refacciones
							if ($numCostoRefacciones > 0)
							{

								//Datos del costo de refacciones para inventario
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = '03';
								$objCuenta->strCuartoNivel = '01000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($numCostoRefacciones, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

								
							}//Cierre de verificación del costo de refacciones (inventario)

							//Si existe costo por mano de obra
							if ($numCostoManoObra > 0)
							{

								//Datos del costo por mano de obra para inventario
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = '03';
								$objCuenta->strCuartoNivel = '02000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

								

							}//Cierre de verificación del costo por mano de obra (inventario)

							//Si existe costo de trabajos foráneos
							if ($numCostoForaneos > 0)
							{

								//Datos del costo del trabajo foráneo para inventario
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = '03';
								$objCuenta->strCuartoNivel = '03000';
								//Hacer un llamado a la función para obtener los datos de la cuenta 
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($numCostoForaneos, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}
								

							}//Cierre de verificación del costo de trabajos foráneos (inventario)


							/****Mano de obra***/
							//Si existe costo por mano de obra
							if ($numCostoManoObra > 0)
							{
								//Datos del costo por mano de obra (cargos)
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = '03';
								$objCuenta->strCuartoNivel = '02000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'CARGO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}


								//Datos del costo por mano de obra (abonos)
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '602';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = '03';
								$objCuenta->strCuartoNivel = '01000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

							}//Cierre de verificación del costo por mano de obra
						}
						else
						{
							//Asignar mensaje de error
					 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
					 		$this->ARR_DATOS['strError'] .= '<br>';
						}

					}//Cierre de verificación de acumulados de costos

				}
				else if($intServicioTipoID == TIPO_SERVICIO_INTERNO)//Servicio interno
				{
					//Variable que se utiliza para acumular el costo por mano de obra
					$numCostoManoObra = 0;
					//Variable que se utiliza para acumular el costo de refacciones
					$numCostoRefacciones = 0;
					//Variable que se utiliza para acumular el costo de trabajos foráneos
					$numCostoForaneos = 0;

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Asignar valores del detalle
							$strConcepto = 'DIARIO POR SERVICIO INTERNO DE '.$arrDet->descripcion_corta;
							$strConcepto .= ' CON SERIE '.$arrDet->serie;
							
							//Si existe motor
							if ($arrDet->motor != '')
							{
								$strConcepto .= ' MOTOR '.$arrDet->motor;
							}

							$strObservaciones = $arrDet->observaciones;

							//Dependiendo del tipo incrementar acumulado del costo
							if ($arrDet->Tipo == 'MANO OBRA')
							{
								$numCostoManoObra += $arrDet->Costo;
							}
							else if ($arrDet->Tipo == 'REFACCIONES')
							{
								$numCostoRefacciones += $arrDet->Costo;
							}
							else if ($arrDet->Tipo == 'FORANEOS')
							{
								$numCostoForaneos += $arrDet->Costo;
							}


						}//Cierre de foreach

					}//Cierre de verificación de detalles

					
					//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
					$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

					//Si hay información de la cuenta contable
					if($otdConfContable)
					{

						//Asignar cuenta contable
						$strCuentaContable =  $otdConfContable->cuenta_contable;

						/****Inventario***/
						//Si existe costo de refacciones
						if ($numCostoRefacciones > 0)
						{
							//Datos del costo de refacciones para inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '01000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoRefacciones, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo de refacciones (inventario)


						//Si existe costo por mano de obra
						if ($numCostoManoObra > 0)
						{
							//Datos del costo por mano de obra para inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '02000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo por mano de obra (inventario)


						//Si existe costo de trabajos foráneos
						if ($numCostoForaneos > 0)
						{
							//Datos del costo del trabajo foráneo para inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '03000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoForaneos, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo de trabajos foráneos (inventario)


						/****Mano de obra***/
						//Si existe costo por mano de obra
						if ($numCostoManoObra > 0)
						{
							//Datos del costo por mano de obra (cargos)
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '02000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

							//Datos del costo por mano de obra (abonos)
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '602';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '01000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo por mano de obra
					}
					else
					{
						//Asignar mensaje de error
					 	$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
					 	$this->ARR_DATOS['strError'] .= '<br>';
					}


				}
				else if ($intServicioTipoID == TIPO_SERVICIO_TALLER) //Servicio interno taller
				{
					//Variable que se utiliza para acumular el costo por mano de obra
					$numCostoManoObra = 0;
					//Variable que se utiliza para acumular el costo de refacciones
					$numCostoRefacciones = 0;
					//Variable que se utiliza para acumular el costo de trabajos foráneos
					$numCostoForaneos = 0;

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Asignar valores del detalle
							$strConcepto = 'DIARIO POR SERVICIO INTERNO TALLER DE '.$arrDet->descripcion_corta;
							$strConcepto .= ' CON SERIE '.$arrDet->serie;

							//Si existe motor
							if ($arrDet->motor != '')
							{
								$strConcepto.= ' MOTOR '.$arrDet->motor;
							}

							$strObservaciones = $arrDet->observaciones;

							//Dependiendo del tipo incrementar acumulado del costo
							if ($arrDet->Tipo == 'MANO OBRA')
							{
								$numCostoManoObra += $arrDet->Costo;
							}
							else if ($arrDet->Tipo == 'REFACCIONES')
							{
								$numCostoRefacciones += $arrDet->Costo;
							}
							else if ($arrDet->Tipo == 'FORANEOS')
							{
								$numCostoForaneos += $arrDet->Costo;
							}


						}//Cierre de foreach

					}//Cierre de verificación de detalles

					//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
					$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

					//Si hay información de la cuenta contable
					if($otdConfContable)
					{

						//Asignar cuenta contable
						$strCuentaContable =  $otdConfContable->cuenta_contable;
					
						/****Costos***/
						//Si existe costo por mano de obra
						if ($numCostoManoObra > 0)
						{
							//Datos del costo por mano de obra 
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '501';
							$objCuenta->strSegundoNivel = '01';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = '03001';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo por mano de obra (costos)

						//Si existe costo de refacciones
						if ($numCostoRefacciones > 0)
						{
							//Datos del costo de refacciones
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '501';
							$objCuenta->strSegundoNivel = '01';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = '03002';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoRefacciones, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo de refacciones (costos)

						//Si existe costo de trabajos foráneos
						if ($numCostoForaneos > 0)
						{
							//Datos del costo del trabajo foráneo
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '501';
							$objCuenta->strSegundoNivel = '01';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = '03003';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoForaneos, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo de trabajos foráneos (costos)


						/****Inventario***/
						//Si existe costo de refacciones
						if ($numCostoRefacciones > 0)
						{
							//Datos del costo de refacciones para inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '01000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoRefacciones, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo de refacciones (inventario)


						//Si existe costo por mano de obra
						if ($numCostoManoObra > 0)
						{
							//Datos del costo por mano de obra para inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '02000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo por mano de obra (inventario)


						//Si existe costo de trabajos foráneos
						if ($numCostoForaneos > 0)
						{
							//Datos del costo del trabajo foráneo para inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '03000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoForaneos, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo de trabajos foráneos (inventario)

						
						/****Mano de obra***/
					    //Si existe costo por mano de obra
						if ($numCostoManoObra > 0)
						{
							//Datos del costo por mano de obra (cargos)
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '02000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

							//Datos del costo por mano de obra (abonos)
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '602';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '01000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo por mano de obra

				    }
					else
					{
						//Asignar mensaje de error
				 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
				 		$this->ARR_DATOS['strError'] .= '<br>';
					}

				}
				else if ($intServicioTipoID == TIPO_SERVICIO_VENTAS) //Servicio interno ventas
				{
					//Variable que se utiliza para acumular el costo por mano de obra
					$numCostoManoObra = 0;
					//Variable que se utiliza para acumular el costo de refacciones
					$numCostoRefacciones = 0;
					//Variable que se utiliza para acumular el costo de trabajos foráneos
					$numCostoForaneos = 0;

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Asignar valores del detalle
							$strConcepto = 'DIARIO POR SERVICIO INTERNO VENTAS DE '.$arrDet->descripcion_corta;
							$strConcepto .= ' CON SERIE '.$arrDet->serie;

							//Si existe motor
							if ($arrDet->motor != '')
							{
								$strConcepto.= ' MOTOR '.$arrDet->motor;
							}

							$strObservaciones = $arrDet->observaciones;

							//Dependiendo del tipo incrementar acumulado del costo
							if ($arrDet->Tipo == 'MANO OBRA')
							{
								$numCostoManoObra += $arrDet->Costo;
							}
							else if ($arrDet->Tipo == 'REFACCIONES')
							{
								$numCostoRefacciones += $arrDet->Costo;
							}
							else if ($arrDet->Tipo == 'FORANEOS')
							{
								$numCostoForaneos += $arrDet->Costo;
							}

						}//Cierre de foreach

					}//Cierre de verificación de detalles


					//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
					$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

					//Si hay información de la cuenta contable
					if($otdConfContable)
					{

						//Asignar cuenta contable
						$strCuentaContable =  $otdConfContable->cuenta_contable;

						/****Inventario***/
						//Si existe costo de refacciones
						if ($numCostoRefacciones > 0)
						{
							//Datos del costo de refacciones para inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '01000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoRefacciones, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo de refacciones (inventario)
						
						//Si existe costo por mano de obra
						if ($numCostoManoObra > 0)
						{
							//Datos del costo por mano de obra para inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '02000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo por mano de obra (inventario)

						//Si existe costo de trabajos foráneos
						if ($numCostoForaneos > 0)
						{
							//Datos del costo del trabajo foráneo para inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '03000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoForaneos, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo de trabajos foráneos (inventario)


						/****Mano de obra***/
						//Si existe costo por mano de obra
						if ($numCostoManoObra > 0)
						{
							//Datos del costo por mano de obra (cargos)
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '02000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}


							//Datos del costo por mano de obra (abonos)
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '602';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '01';
							$objCuenta->strCuartoNivel = '01000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo por mano de obra
					}
					else
					{
						//Asignar mensaje de error
				 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
				 		$this->ARR_DATOS['strError'] .= '<br>';
					}

				}
				else if ($intServicioTipoID == TIPO_SERVICIO_TRABAJO_FORANEO)//Trabajo foráneo
				{
					//Variable que se utiliza para acumular el subtotal
					$numSubtotal = 0;
					//Variable que se utiliza para acumular el importe de IVA
					$numIVA = 0;
					//Variable que se utiliza para acumular el importe de IEPS
					$numIEPS = 0;
					//Variables que se utilizan para asignar los datos del proveedor
					$strCodigo = '';
					$strProveedor = '';
					$strTipoProveedor = '';
					//Array que se utiliza para asignar los datos de las tasas de IEPS
					$arrIEPS = array();

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Asignar valores del detalle
							$strConcepto = 'DIARIO POR TRABAJO SUBCONTRATADO';
							$strConcepto.= ' CON FACTURA '.$arrDet->factura;
							$strConcepto.= ' DE '.$arrDet->razon_social;
							$strCodigo = $arrDet->codigo;
							$strProveedor = $arrDet->razon_social;
							$strTipoProveedor = $arrDet->tipo_proveedor;

							//Incrementar acumulados
							$numSubtotal += $arrDet->Subtotal;
							$numIVA += $arrDet->IVA;

							//Si la tasa de IEPS corresponde al rango
							if ($arrDet->tasa_cuota_ieps == SAT_TASA_CUOTA_IEPS_RANGO)
							{
								//Incrementar acumulado del subtotal
								$numSubtotal += $arrDet->IEPS;
							}
							else if ($arrDet->IEPS > 0)//Si existe importe de IEPS
							{
								//Incrementar acumulado de IEPS
								$numIEPS += $arrDet->IEPS;

								//Agregar datos al array
								array_push($arrIEPS, array('TasaID' => $arrDet->tasa_cuota_ieps,
														   'TasaIEPS' => $arrDet->TasaIEPS,
														   'Importe' => $arrDet->IEPS));
							}
							
							
						}//Cierre de foreach

					}//Cierre de verificación de detalles


					//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
					$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

					$numSubtotal = number_format($numSubtotal, 5, '.', '');
					$numIVA = number_format($numIVA, 5, '.', '');

					//Si hay información de la cuenta contable
					if($otdConfContable)
					{
						//Asignar cuenta contable
						$strCuentaContable =  $otdConfContable->cuenta_contable;

						/****Inventario***/
						//Datos del inventario
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '115';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '03';
						$objCuenta->strCuartoNivel = '03000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numSubtotal, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}


						//Si existe importe de IVA
						if ($numIVA > 0)
						{
							//Datos del IVA
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '119';
							$objCuenta->strSegundoNivel = '01';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = '00000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numIVA, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verifición del importe de IVA

						//Hacer recorrido para obtener Tasas de IEPS
						foreach($arrIEPS as $objIEPS)
						{

							//Hacer un llamado al método para comprobar la existencia de la configuración del ieps
							$otdConfIeps = $this->config_polizas->buscar_configuracion_ieps(NULL, $objIEPS['TasaID']);

							//Si existen datos de la tasa (cuenta de la tasa de IEPS)
							if($otdConfIeps)
							{
								//Datos del IEPS
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '119';
								$objCuenta->strSegundoNivel = '03';
								$objCuenta->strTercerNivel = $strCuentaContable;
								$objCuenta->strCuartoNivel = $otdConfIeps->cuenta;
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($objIEPS['Importe'], 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'CARGO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}
							}
							else
						    {
						    	//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la tasa de IEPS: ';
								$this->ARR_DATOS['strError'] .=  $objIEPS['TasaIEPS'];
								$this->ARR_DATOS['strError'] .= '<br>';
						    }

						}//Cierre de foreach

						//Datos del proveedor
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID  = NULL;
						$objCuenta->intSatCuentaID  = NULL;
						$objCuenta->strPrimerNivel = '201';
						$objCuenta->strSegundoNivel = NULL;
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = NULL;
						$objCuenta->strDescripcion  = $strProveedor;
						$objCuenta->strNaturaleza  = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos  = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';

						//Dependiendo del tipo de proveedor asignar datos de la cuenta
						if ($strTipoProveedor == 'NACIONAL')
						{

							//Hacer un llamado al método para comprobar la existencia de la configuración de la moneda
							$otdConfMoneda = $this->config_polizas->buscar_configuracion_monedas(NULL, $otdFra->moneda_id);

							//Si existen datos de la moneda (cuenta de la moneda)
							if($otdConfMoneda)
							{
								$objCuenta->strSegundoNivel = '01';
								$objCuenta->strCuartoNivel = $otdConfMoneda->cuenta.substr($strCodigo, 1);
							}
							else
							{
								//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la moneda: ';
								$this->ARR_DATOS['strError'] .= $otdFra->Moneda;
								$this->ARR_DATOS['strError'] .= '<br>';
							}
							
						}
						else
						{
							$objCuenta->strSegundoNivel = '02';
							$objCuenta->strCuartoNivel = '3'.substr($strCodigo, 1);
						}

						//Si existe segundo y cuarto nivel de la cuenta
						if($objCuenta->strSegundoNivel != NULL && $objCuenta->strCuartoNivel != NULL)
						{
							//Calcular importe
							$intImporte = ($numSubtotal + $numIVA + $numIEPS);

							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'PROVEEDOR');
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}
						
					}
					else
					{
						//Asignar mensaje de error
				 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
				 		$this->ARR_DATOS['strError'] .= '<br>';
					}

				}
				else if ($intServicioTipoID == TIPO_SERVICIO_FACTURACION)//Factura de servicio
				{	

					//Variable que se utiliza para acumular el costo por mano de obra
					$numCostoManoObra = 0;
					//Variable que se utiliza para acumular el costo de refacciones
					$numCostoRefacciones = 0;
					//Variable que se utiliza para acumular el costo de trabajos foráneos
					$numCostoForaneos = 0;
					//Variable que se utiliza para acumular el subtotal
					$numSubtotal = 0;
					//Variable que se utiliza para acumular el importe de IVA
					$numIVA = 0;
					//Variable que se utiliza para acumular el importe de IEPS
					$numIEPS = 0;
					//Variables que se utilizan para asignar los datos de la factura
					$intOrdenReparacionID = 0;
					$strCodigo = '';
					$strCliente = '';
					$strCondiciones = '';
					//Array que se utiliza para asignar los datos de las tasas de IVA para clientes
					$arrClientes = array($intTasaCuotaIDIvaCero => 0, 
										 $intTasaCuotaIDIva => 0);

					//Array que se utiliza para asignar los datos de las tasas de IVA para ventas
					$arrVentas = array($intTasaCuotaIDIvaCero => 0, 
									   $intTasaCuotaIDIva => 0);

					//Array que se utiliza para asignar los datos de las tasas de IEPS
					$arrIEPS = array();

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{

							//Asignar valores del detalle
							$strCondiciones = $arrDet->condiciones_pago;
							$strConcepto = 'DIARIO POR VENTA DE SERVICIO '.$strCondiciones;
							$intOrdenReparacionID = $arrDet->orden_reparacion_id;
							$strCodigo = $arrDet->codigo;
							$strCliente = $arrDet->razon_social;

							//Incrementar acumulados
							$numSubtotal += $arrDet->Subtotal;
							$numIVA += $arrDet->IVA;
							$numIEPS += $arrDet->IEPS;

							//Agregar total al array de clientes
							$arrClientes[$arrDet->tasa_cuota_iva] += ($arrDet->Subtotal + $arrDet->IVA + 
																	   $arrDet->IEPS);

							//Agregar subtotal al array de ventas
							$arrVentas[$arrDet->tasa_cuota_iva] += ($arrDet->Subtotal);

							//Si existe importe de IEPS
							if ($arrDet->IEPS > 0)
							{
								//Agregar datos al array
								array_push($arrIEPS, array('TasaID' => $arrDet->tasa_cuota_ieps,
														   'TasaIEPS' => $arrDet->TasaIEPS, 
														   'Importe' =>$arrDet->IEPS));
							}


						}//Cierre de foreach

					}//Cierre de verificación de detalles


					//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
					$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

					//Si hay información de la cuenta contable
					if($otdConfContable)
					{
						//Asignar cuenta contable
						$strCuentaContable =  $otdConfContable->cuenta_contable;

						/****Clientes IVA 16%***/
						//Si existen clientes con tasa de IVA del 16%
						if ($arrClientes[$intTasaCuotaIDIva] > 0)
						{

							//Datos del cliente
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->intCuentaPadreID = NULL;
							$objCuenta->intSatCuentaID = NULL;
							$objCuenta->strPrimerNivel = '105';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '05';
							$objCuenta->strCuartoNivel = $strCodigo;
							$objCuenta->strDescripcion = $strCliente;
							$objCuenta->strNaturaleza = NULL;
							$objCuenta->strTipoCuenta = NULL;
							$objCuenta->strAceptaMovimientos = 'SI';
							$objCuenta->strMovimientosBancarios  = 'NO';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrClientes[$intTasaCuotaIDIva], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verifición de tasa de IVA del 16%


						/****Clientes IVA 0%***/
						//Si existen clientes con tasa de IVA del 0%
						if ($arrClientes[$intTasaCuotaIDIvaCero] > 0)
						{
							//Datos del cliente
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->intCuentaPadreID = NULL;
							$objCuenta->intSatCuentaID = NULL;
							$objCuenta->strPrimerNivel = '105';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '06';
							$objCuenta->strCuartoNivel = $strCodigo;
							$objCuenta->strDescripcion = $strCliente;
							$objCuenta->strNaturaleza = NULL;
							$objCuenta->strTipoCuenta = NULL;
							$objCuenta->strAceptaMovimientos = 'SI';
							$objCuenta->strMovimientosBancarios  = 'NO';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrClientes[$intTasaCuotaIDIvaCero], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verifición de tasa de IVA del 0%

						//Dependiendo de las condiciones de pago asignar datos de la cuenta
						if ($strCondiciones == 'CONTADO')
						{

							/****Ventas IVA 16%***/
							//Si existen ventas con tasa de IVA del 16%
							if ($arrVentas[$intTasaCuotaIDIva] > 0)
							{	
								//Datos de la venta
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '401';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = '02';
								$objCuenta->strCuartoNivel = '03000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($arrVentas[$intTasaCuotaIDIva], 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

							}//Cierre de verifición de tasa de IVA del 16%


							/****Ventas IVA 0%***/
							//Si existen ventas con tasa de IVA del 0%
							if ($arrVentas[$intTasaCuotaIDIvaCero] > 0)
							{
								//Datos de la venta
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '401';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = '05';
								$objCuenta->strCuartoNivel = '03000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($arrVentas[$intTasaCuotaIDIvaCero], 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}
							}
						}
						else
						{

							/****Ventas IVA 16%***/
							//Si existen ventas con tasa de IVA del 16%
							if ($arrVentas[$intTasaCuotaIDIva] > 0)
							{
								//Datos de la venta
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '401';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = '03';
								$objCuenta->strCuartoNivel = '03000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($arrVentas[$intTasaCuotaIDIva], 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}
							}


							/****Ventas IVA 0%***/
							//Si existen ventas con tasa de IVA del 0%
							if ($arrVentas[$intTasaCuotaIDIvaCero] > 0)
							{
								//Datos de la venta
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '401';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = '06';
								$objCuenta->strCuartoNivel = '03000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($arrVentas[$intTasaCuotaIDIvaCero], 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}
							}

						}


						//Si existe importe de IVA
						if ($numIVA > 0)
						{
							//Datos del IVA
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '209';
							$objCuenta->strSegundoNivel = '01';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = '00000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numIVA, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}


						//Hacer recorrido para obtener Tasas de IEPS
						foreach($arrIEPS as $objIEPS)
						{
							//Hacer un llamado al método para comprobar la existencia de la configuración del ieps
							$otdConfIeps = $this->config_polizas->buscar_configuracion_ieps(NULL, $objIEPS['TasaID']);

							//Si existen datos de la tasa (cuenta de la tasa de IEPS)
							if($otdConfIeps)
							{
								//Datos del IEPS
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '209';
								$objCuenta->strSegundoNivel = '02';
								$objCuenta->strTercerNivel = $strCuentaContable;
								$objCuenta->strCuartoNivel = $otdConfIeps->cuenta;
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($objIEPS['Importe'], 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

							}
							else
						    {
						    	//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la tasa de IEPS: ';
								$this->ARR_DATOS['strError'] .=  $objIEPS['TasaIEPS'];
								$this->ARR_DATOS['strError'] .= '<br>';
						    }

						}//Cierre de foreach


						//Seleccionar los detalles de la orden de reparación 
				   		$otdDetOrden = $this->ordenes->buscar_detalles_poliza($intOrdenReparacionID);

				   		//Verificar si existe información de los detalles 
						if ($otdDetOrden) 
						{
							//Recorremos el arreglo 
							foreach ($otdDetOrden as $arrOrd)
							{
								//Dependiendo del tipo incrementar acumulado del costo
								if ($arrOrd->Tipo == 'MANO OBRA')
								{
									$numCostoManoObra += $arrOrd->Costo;
								}
								else if ($arrOrd->Tipo == 'REFACCIONES')
								{
									$numCostoRefacciones += $arrOrd->Costo;
								}
								else if ($arrOrd->Tipo == 'FORANEOS')
								{
									$numCostoForaneos += $arrOrd->Costo;
								}

							}//Cierre de foreach

						}//Cierre de verificación de detalles


						/****Costos***/
						//Si existe costo por mano de obra
						if ($numCostoManoObra > 0)
						{
							//Datos del costo por mano de obra 
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '501';
							$objCuenta->strSegundoNivel = '01';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = '03001';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo por mano de obra (costos)

						//Si existe costo de refacciones
						if ($numCostoRefacciones > 0)
						{
							//Datos del costo de refacciones
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '501';
							$objCuenta->strSegundoNivel = '01';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = '03002';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoRefacciones, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo de refacciones (costos)

						//Si existe costo de trabajos foráneos
						if ($numCostoForaneos > 0)
						{
							//Datos del costo del trabajo foráneo 
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '501';
							$objCuenta->strSegundoNivel = '01';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = '03003';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoForaneos, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo de trabajos foráneos (costos)


						/****Inventario***/
						//Si existe costo de refacciones
						if ($numCostoRefacciones > 0)
						{
							//Datos del costo de refacciones para inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '01000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoRefacciones, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo de refacciones (inventario)

						//Si existe costo por mano de obra
						if ($numCostoManoObra > 0)
						{
							//Datos del costo por mano de obra para inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '02000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo por mano de obra (inventario)


						//Si existe costo de trabajos foráneos
						if ($numCostoForaneos > 0)
						{
							//Datos del costo del trabajo foráneo para inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '03000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoForaneos, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo de trabajos foráneos (inventario)


						/****Mano de obra***/
						//Si existe costo por mano de obra
						if ($numCostoManoObra > 0)
						{
							//Datos del costo por mano de obra (cargos)
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '02000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

							//Datos del costo por mano de obra (abonos)
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '602';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '01000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verificación del costo por mano de obra
					}
					else
					{
						//Asignar mensaje de error
				 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
				 		$this->ARR_DATOS['strError'] .= '<br>';
					}	

				}//Cierre de la verificación del tipo de servicio


				
				//Concatenar datos para realizar la búsqueda del proceso
				$strCriteriosBusq = $intServicioTipoID.'|SERVICIO';
				//Hacer un llamado al método para comprobar la existencia de la configuración del proceso
				$otdConfProceso = $this->config_polizas->buscar_configuracion_procesos(NULL, $strCriteriosBusq);

				//Si existen datos del proceso
				if($otdConfProceso)
				{

					//Asignar datos de la póliza
					$objPoliza->intSucursalID =  $otdFra->sucursal_id;
					$objPoliza->strTipo = 'DIARIO';
					$objPoliza->strModulo = 'SERVICIO';
					$objPoliza->strProceso = $otdConfProceso->proceso;
					$objPoliza->intReferenciaID = $otdFra->referencia_id;
					$objPoliza->dteFecha = $otdFra->fecha;
					$objPoliza->strConcepto = $strConcepto;
					$objPoliza->strObservaciones = $strObservaciones;
					$objPoliza->strEstatus = 'ACTIVO';
					$objPoliza->arrDetalles = $arrDetalles;

					//Hacer un llamado a la función para guardar los datos de la póliza en la BD
					$this->guardar_poliza_referencia($objPoliza, $intProcesoMenuID);

				}
				else
				{
					//Asignar mensaje de error
					$this->ARR_DATOS['strError'] .= 'No existe configuración del proceso para 
													 el tipo de servicio.';
					$this->ARR_DATOS['strError'] .= '<br>';
				}
			}
			else
			{
				//Asignar mensaje de error
				$this->ARR_DATOS['strError'] .= 'El tipo de servicio no se encuentra en la lista de servicios que generan póliza.';
				$this->ARR_DATOS['strError'] .= '<br>';

			}//Cierre de verificación del tipo de servicio en el array

		}
		else
		{
			//Indicar mensaje de error (no se genera la póliza porque no se cumplen con las restricciones / no existe información del registro)
			$this->ARR_DATOS['strError'] = MSJ_ERROR_POLIZA;
		}

	}


	//Método para generar una póliza con los datos de la factura de refacciones y movimientos de refacciones
	public function get_poliza_refacciones($intReferenciaID, $strTipoReferencia, $intProcesoMenuID)
	{
		//Array's que se utilizan para las cuentas de monedas
		$MonRef = array('MXN' =>'3', 'USD' =>'4');
		$MonAI = array('MXN' =>'7', 'USD' =>'8');

		//------------------------------------------------------------------------------------------------------------------------
		//---------- DATOS DE LA REFERENCIA 
		//------------------------------------------------------------------------------------------------------------------------
       	//Seleccionar datos del registro
       	$otdFra = $this->facturas_refacciones->buscar_referencia_poliza($intReferenciaID, $strTipoReferencia);

       	//Verificar si hay información del registro
		if($otdFra)
		{	

			//Asignar el folio de la referencia (movimiento/factura)
			$this->ARR_DATOS['strFolioReferencia'] = $otdFra->folio;

			//Crear un objeto vacio, stdClass es el objeto Póliza
			$objPoliza = new stdClass();
			//Array que se utiliza para agregar los detalles de la póliza 
			$arrDetalles = array();
			//Array que se utiliza para agregar los datos de un detalle
			$arrAuxiliar = array();
			//Variables que se utilizan para asignar datos de la póliza
			$strConcepto = '';
			$strObservaciones = '';
			//Variables que se utilizan para asignar datos del detalle
			$intRenglon = 1;
			//Asignar el id del tipo de movimiento
			$intTipoMovimiento = $otdFra->tipo_movimiento;
			//Constante para identificar los datos del SAT correspondientes al IVA 16%
			$intTasaCuotaIDIva = SAT_TASA_CUOTA_IVA_ID;
			//Constante para identificar los datos del SAT correspondientes al IVA cero
			$intTasaCuotaIDIvaCero = SAT_TASA_CUOTA_IVA_CERO_ID;


			//------------------------------------------------------------------------------------------------------------------------
			//---------- DETALLES DE LA REFERENCIA 
			//------------------------------------------------------------------------------------------------------------------------
			//Seleccionar los detalles del registro
		    $otdDetalles = $this->facturas_refacciones->buscar_detalles_poliza($intReferenciaID, 	
		    																   $intTipoMovimiento);



			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL REGISTRO 
	        //------------------------------------------------------------------------------------------------------------------------
		    //Dependiendo del tipo de movimiento generar póliza
			if($intTipoMovimiento == ENTRADA_REFACCIONES_COMPRA) //Entradas de refacciones por compra
			{
				//Variable que se utiliza para acumular el subtotal
				$numSubtotal = 0;
				//Variable que se utiliza para acumular el importe de IVA
				$numIVA = 0;
				//Variable que se utiliza para acumular el importe de IEPS
				$numIEPS = 0;
				//Variables que se utilizan para asignar los datos del proveedor
				$strModulo = '';
				$intModuloID = 0;
				$strCodigo = '';
				$strProveedor = '';
				$strTipoProveedor = '';
				//Array que se utiliza para asignar los datos de las tasas de IEPS
				$arrIEPS = array();

				//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Asignar valores del detalle
						$strConcepto = 'DIARIO POR COMPRA DE '.$arrDet->Modulo;
						
						//Si existe factura
						if ($arrDet->factura != '')
						{
							$strConcepto.= ' CON FACTURA '.$arrDet->factura;
						}

						//Si existe remisión
						if ($arrDet->remision != '')
						{
							$strConcepto.= ' REMISION '.$arrDet->remision;
						}

						$strConcepto.= ' DE '.$arrDet->razon_social;

						$strModulo = $arrDet->Modulo;
						$intModuloID =  $arrDet->modulo_id;
						$strCodigo = $arrDet->codigo;
						$strProveedor = $arrDet->razon_social;
						$strTipoProveedor = $arrDet->tipo_proveedor;

						//Incrementar acumulados
						$numSubtotal += $arrDet->Subtotal;
						$numIVA += $arrDet->IVA;
						

						//Si existe importe de IEPS
						if ($arrDet->IEPS > 0)
						{
							//Incrementar acumulado de IEPS
							$numIEPS += $arrDet->IEPS;

							//Agregar datos al array
							array_push($arrIEPS, array('TasaID' => $arrDet->tasa_cuota_ieps,
													   'TasaIEPS' => $arrDet->TasaIEPS,
													   'Importe' => $arrDet->IEPS));
						}


					}//Cierre de foreach

				}//Cierre de verificación de detalles


				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);


				//Si hay información de la cuenta contable
				if($otdConfContable)
				{

					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					//Concatenar datos para realizar la búsqueda del departamento
					$strCriteriosBusq = $intModuloID.'|REFACCIONES';
					//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
					$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

					//Si existen datos del departamento (cuenta del módulo)
					if($otdConfDepto)
					{
						//Asignar cuenta del departamento
						$strCuentaDepto =  $otdConfDepto->cuenta;

						/****Inventario***/
						//Datos del inventario
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '115';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = $strCuentaDepto;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numSubtotal, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}
					else
				    {
				    	//Asignar mensaje de error
						$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
														 '.$strModulo.' (módulo).';
						$this->ARR_DATOS['strError'] .= '<br>';
				    }


					//Si existe importe de IVA
					if ($numIVA > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '119';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numIVA, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}

					//Hacer recorrido para obtener Tasas de IEPS
					foreach($arrIEPS as $objIEPS)
					{
						//Hacer un llamado al método para comprobar la existencia de la configuración del ieps
						$otdConfIeps = $this->config_polizas->buscar_configuracion_ieps(NULL, $objIEPS['TasaID']);

						//Si existen datos de la tasa (cuenta de la tasa de IEPS)
						if($otdConfIeps)
						{

							//Datos del IEPS
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '119';
							$objCuenta->strSegundoNivel = '03';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = $otdConfIeps->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($objIEPS['Importe'], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}
						else
					    {
					    	//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la tasa de IEPS: ';
							$this->ARR_DATOS['strError'] .=  $objIEPS['TasaIEPS'];
							$this->ARR_DATOS['strError'] .= '<br>';
					    }

					}//Cierre de foreach

					//Datos del proveedor
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->intCuentaPadreID = NULL;
					$objCuenta->intSatCuentaID = NULL;
					$objCuenta->strPrimerNivel = '201';
					$objCuenta->strSegundoNivel = NULL;
					$objCuenta->strTercerNivel = $strCuentaContable;
					$objCuenta->strCuartoNivel = NULL;
					$objCuenta->strDescripcion = $strProveedor;
					$objCuenta->strNaturaleza = NULL;
					$objCuenta->strTipoCuenta = NULL;
					$objCuenta->strAceptaMovimientos = 'SI';
					$objCuenta->strMovimientosBancarios  = 'NO';

					//Dependiendo del tipo de proveedor asignar datos de la cuenta
					if ($strTipoProveedor == 'NACIONAL')
					{
						$objCuenta->strSegundoNivel = '01';

						//Dependiendo del módulo asignar moneda
						if ($strModulo == 'REFACCIONES')
						{
							$objCuenta->strCuartoNivel = $MonRef[$otdFra->Moneda].substr($strCodigo, 1);
						}
						else
						{
							$objCuenta->strCuartoNivel = $MonAI[$otdFra->Moneda].substr($strCodigo, 1);
						}
					}
					else
					{
						$objCuenta->strSegundoNivel = '02';

						//Dependiendo del módulo asignar cuenta
						if ($strModulo == 'REFACCIONES')
						{
							$objCuenta->strCuartoNivel = '2'.substr($strCodigo, 1);
						}
						else
						{
							$objCuenta->strCuartoNivel = '5'.substr($strCodigo, 1);
						}
					}


					//Si existe segundo y cuarto nivel de la cuenta
					if($objCuenta->strSegundoNivel != NULL && $objCuenta->strCuartoNivel != NULL)
					{

						//Calcular importe
						$intImporte = ($numSubtotal + $numIVA + $numIEPS);

						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'PROVEEDOR');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}
				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}


			}
			else if ($intTipoMovimiento == ENTRADA_REFACCIONES_DEVOLUCION_FACTURA) //Entradas de refacciones por devolución de factura
			{

				//Variable que se utiliza para acumular el subtotal
				$numSubtotal = 0;
				//Variable que se utiliza para acumular el importe de IVA
				$numIVA = 0;
				//Variable que se utiliza para acumular el importe de IEPS
				$numIEPS = 0;
				//Variable que se utiliza para acumular el costo de refacciones
				$numCosto = 0;
				//Variables que se utilizan para asignar los datos del cliente
				$intModuloID = 0;
				$strModulo = '';
				$strCodigo = '';
				$strCliente = '';
				$strCondiciones = '';
				$strTipoReferencia = '';

				//Array que se utiliza para asignar los datos de las tasas de IVA para clientes
				$arrClientes = array('REFACCIONES' => array($intTasaCuotaIDIvaCero => 0, 
															$intTasaCuotaIDIva => 0),
									 'AGRICULTURA INTELIGENTE' => array($intTasaCuotaIDIvaCero => 0, 
									 								    $intTasaCuotaIDIva => 0));

				//Array que se utiliza para asignar los datos de las tasas de IVA para ventas
				$arrVentas = array('REFACCIONES' => array($intTasaCuotaIDIvaCero => 0, 
														  $intTasaCuotaIDIva => 0),
								   'AGRICULTURA INTELIGENTE' => array($intTasaCuotaIDIvaCero => 0, 
								   									  $intTasaCuotaIDIva => 0));
				
				//Array que se utiliza para asignar los datos de las tasas de IEPS
				$arrIEPS = array();


				//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Asignar valores del detalle
						$strConcepto = 'DIARIO POR ENTRADA POR DEVOLUCION DE CLIENTE DE '.$arrDet->Modulo;
						$strConcepto .= ' '.$arrDet->condiciones_pago;
						$strModulo = $arrDet->Modulo;
						$intModuloID = $arrDet->modulo_id;
						$strCodigo = $arrDet->codigo;
						$strCliente = $arrDet->razon_social;
						$strCondiciones = $arrDet->condiciones_pago;
						$strTipoReferencia = $arrDet->tipo_referencia;

						//Incrementar acumulados
						$numSubtotal += $arrDet->Subtotal;
						$numIVA += $arrDet->IVA;
						$numIEPS += $arrDet->IEPS;
						$numCosto += $arrDet->Costo;

						//Agregar total al array de clientes
						$arrClientes[$strModulo][$arrDet->tasa_cuota_iva] += ($arrDet->Subtotal + 
																				   $arrDet->IVA + 
																				   $arrDet->IEPS);

						//Agregar subtotal al array de ventas
						$arrVentas[$strModulo][$arrDet->tasa_cuota_iva] += ($arrDet->Subtotal);


						//Si existe importe de IEPS
						if ($arrDet->IEPS > 0)
						{
							//Agregar datos al array
							array_push($arrIEPS, array('TasaID' => $arrDet->tasa_cuota_ieps,
													   'TasaIEPS' => $arrDet->TasaIEPS, 
													   'Importe' => $arrDet->IEPS));
						}

					}//Cierre de foreach

				}//Cierre de verificación de detalles


				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

				//Si hay información de la cuenta contable
				if($otdConfContable)
				{
					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					//Concatenar datos para realizar la búsqueda del departamento
					$strCriteriosBusq = $intModuloID.'|REFACCIONES';
					//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
					$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

					//Si existen datos del departamento (cuenta del módulo)
					if($otdConfDepto)
					{

						//Asignar cuenta del departamento
						$strCuentaDepto =  $otdConfDepto->cuenta;

						/****Inventario***/
						//Datos del inventario
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '115';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = $strCuentaDepto;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
					    $arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numCosto, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}


						/****Costo***/
						//Datos del costo
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '501';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;

						//Dependiendo del tipo de referencia asignar cuenta
						if ($strTipoReferencia == 'REFACCIONES')
						{
							$objCuenta->strCuartoNivel = $strCuentaDepto.'000';
						}
						else
						{
							$objCuenta->strCuartoNivel = '03002';
						}
						
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numCosto, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}
					else
				    {
				    	//Asignar mensaje de error
						$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
														 '.$strModulo.' (módulo).';
						$this->ARR_DATOS['strError'] .= '<br>';
				    }


					/****Ventas de Refacciones IVA 16%***/
					//Si existen ventas con tasa de IVA del 16%
					if ($arrVentas['REFACCIONES'][$intTasaCuotaIDIva] > 0)
					{
						//Datos de la venta
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '402';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '01';
						//Dependiendo del tipo de referencia asignar cuenta
						if ($strTipoReferencia == 'REFACCIONES')
						{
							$objCuenta->strCuartoNivel = '02000';
						}
						else
						{
							$objCuenta->strCuartoNivel = '03000';
						}
						
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrVentas['REFACCIONES'][$intTasaCuotaIDIva], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 16%


					/****Ventas de Refacciones IVA 0%***/
					//Si existen clientes con tasa de IVA del 0%
					if ($arrVentas['REFACCIONES'][$intTasaCuotaIDIvaCero] > 0)
					{
						//Datos de la venta
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '402';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '02';
						//Dependiendo del tipo de referencia asignar cuenta
						if ($strTipoReferencia == 'REFACCIONES')
						{
							$objCuenta->strCuartoNivel = '02000';
						}
						else
						{
							$objCuenta->strCuartoNivel = '03000';
						}
						
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrVentas['REFACCIONES'][$intTasaCuotaIDIvaCero], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 0%


					/****Ventas de Agricultura Inteligente IVA 16%***/
					//Si existen ventas con tasa de IVA del 16%
					if ($arrVentas['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIva] > 0)
					{
						//Datos de la venta
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '402';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '01';
						//Dependiendo del tipo de referencia asignar cuenta
						if ($strTipoReferencia == 'REFACCIONES')
						{
							$objCuenta->strCuartoNivel = '05000';
						}
						else
						{
							$objCuenta->strCuartoNivel = '03000';
						}
						
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrVentas['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIva], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 16%



					/****Ventas de Agricultura Inteligente IVA 0%***/
					//Si existen ventas con tasa de IVA del 0%
					if ($arrVentas['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIvaCero] > 0)
					{
						//Datos de la venta
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '402';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '02';
						//Dependiendo del tipo de referencia asignar cuenta
						if ($strTipoReferencia == 'REFACCIONES')
						{
							$objCuenta->strCuartoNivel = '05000';
						}
						else
						{
							$objCuenta->strCuartoNivel = '03000';
						}

						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrVentas['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIvaCero], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 0%


					//Si existe importe de IVA
					if ($numIVA > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '209';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numIVA, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}


					//Hacer recorrido para obtener Tasas de IEPS
					foreach($arrIEPS as $objIEPS)
					{

						//Hacer un llamado al método para comprobar la existencia de la configuración del ieps
						$otdConfIeps = $this->config_polizas->buscar_configuracion_ieps(NULL, $objIEPS['TasaID']);

						//Si existen datos de la tasa (cuenta de la tasa de IEPS)
						if($otdConfIeps)
						{

							//Datos del IEPS
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '209';
							$objCuenta->strSegundoNivel = '02';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = $otdConfIeps->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($objIEPS['Importe'], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}
						else
					    {
					    	//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la tasa de IEPS: ';
							$this->ARR_DATOS['strError'] .=  $objIEPS['TasaIEPS'];
							$this->ARR_DATOS['strError'] .= '<br>';
					    }

					}//Cierre de foreach


					/****Clientes de Refacciones IVA 16%***/
					//Si existen clientes con tasa de IVA del 16%
					if ($arrClientes['REFACCIONES'][$intTasaCuotaIDIva] > 0)
					{
						//Datos del cliente
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '105';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						//Dependiendo del tipo de referencia asignar cuenta
						if ($strTipoReferencia == 'REFACCIONES')
						{
							$objCuenta->strTercerNivel = '03';
						}
						else
						{
							$objCuenta->strTercerNivel = '05';
						}
						$objCuenta->strCuartoNivel = $strCodigo;
						$objCuenta->strDescripcion = $strCliente;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrClientes['REFACCIONES'][$intTasaCuotaIDIva], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 16%


					/****Clientes de Refacciones IVA 0%***/
					//Si existen clientes con tasa de IVA del 0%
					if ($arrClientes['REFACCIONES'][$intTasaCuotaIDIvaCero] > 0)
					{
						//Datos del cliente
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '105';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						//Dependiendo del tipo de referencia asignar cuenta
						if ($strTipoReferencia == 'REFACCIONES')
						{
							$objCuenta->strTercerNivel = '04';
						}
						else
						{
							$objCuenta->strTercerNivel = '06';
						}

						$objCuenta->strCuartoNivel = $strCodigo;
						$objCuenta->strDescripcion = $strCliente;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrClientes['REFACCIONES'][$intTasaCuotaIDIvaCero], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 0%


					/****Clientes de Agricultura Inteligente IVA 16%***/
					//Si existen clientes con tasa de IVA del 16%
					if ($arrClientes['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIva] > 0)
					{
						//Datos del cliente
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '105';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						//Dependiendo del tipo de referencia asignar cuenta
						if ($strTipoReferencia == 'REFACCIONES')
						{
							$objCuenta->strTercerNivel = '09';
						}
						else
						{
							$objCuenta->strTercerNivel = '05';
						}
						$objCuenta->strCuartoNivel = $strCodigo;
						$objCuenta->strDescripcion = $strCliente;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrClientes['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIva], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 16%


					/****Clientes de Agricultura Inteligente IVA 0%***/
					//Si existen clientes con tasa de IVA del 0%
					if ($arrClientes['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIvaCero] > 0)
					{
						//Datos del cliente
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '105';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						//Dependiendo del tipo de referencia asignar cuenta
						if ($strTipoReferencia == 'REFACCIONES')
						{
							$objCuenta->strTercerNivel = '10';
						}
						else
						{
							$objCuenta->strTercerNivel = '06';
						}
						$objCuenta->strCuartoNivel = $strCodigo;
						$objCuenta->strDescripcion = $strCliente;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrClientes['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIvaCero], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 0%
				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}
			else if ($intTipoMovimiento == ENTRADA_REFACCIONES_DEVOLUCION_TALLER)//Entradas de refacciones por devolución de taller
			{

				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

				//Si hay información de la cuenta contable
				if($otdConfContable)
				{
					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Asignar valores del detalle
							$strModulo = $arrDet->Modulo;
							$intModuloID = $arrDet->modulo_id;

							$strConcepto = 'DIARIO POR ENTRADA POR DEVOLUCION DE TALLER DE '.$strModulo;
							$strConcepto.= ' DE ORDEN DE REPARACION FOLIO '.$arrDet->OrdRep;

							//Concatenar datos para realizar la búsqueda del departamento
							$strCriteriosBusq = $intModuloID.'|REFACCIONES';
							//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
							$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);


							//Si existen datos del departamento (cuenta del módulo)
							if($otdConfDepto)
							{
								//Asignar cuenta del departamento
								$strCuentaDepto =  $otdConfDepto->cuenta;

								/****Inventario de Refacciones***/
								//Datos del inventario
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = $strCuentaDepto;
								$objCuenta->strCuartoNivel = '00000';
								//Hacer un llamado a la función para obtener los datos de la cuenta 
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'CARGO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

							}
							else
						    {
						    	//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																 '.$strModulo.' (módulo).';
								$this->ARR_DATOS['strError'] .= '<br>';
						    }

							/****Inventario del Taller***/
							//Datos del inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '01000';
							//Hacer un llamado a la función para obtener los datos de la cuenta 
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de foreach

					}//Cierre de verificación de detalles

				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}
			else if ($intTipoMovimiento == ENTRADA_REFACCIONES_TRASPASO)//Entradas de refacciones por traspaso
			{
				//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{

						//Asignar valores del detalle
						$strModulo = $arrDet->Modulo;
						$intModuloID = $arrDet->modulo_id;

						$strConcepto = 'DIARIO POR ENTRADA POR TRASPASO DE '.$strModulo;
						$strConcepto.= ' DE LA SUCURSAL '.$arrDet->Origen;

						//Concatenar datos para realizar la búsqueda del departamento
						$strCriteriosBusq = $intModuloID.'|REFACCIONES';
						//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
						$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);


						//Si existen datos del departamento (cuenta del módulo)
						if($otdConfDepto)
						{
							//Asignar cuenta del departamento
							$strCuentaDepto =  $otdConfDepto->cuenta;

							//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal de destino
							$otdConfContable = $this->config_contable->buscar($arrDet->DestinoID);

							//Si hay información de la cuenta contable
							if($otdConfContable)
							{

								//Asignar cuenta contable
								$strCuentaContable =  $otdConfContable->cuenta_contable;

								/****Inventario Destino***/
								//Datos del inventario
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = $strCuentaDepto;
								$objCuenta->strCuartoNivel = '00000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'CARGO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

							}
							else
							{
								//Asignar mensaje de error
						 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE.' (Destino).';
						 		$this->ARR_DATOS['strError'] .= '<br>';
							}



							//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal de origen
							$otdConfContable = $this->config_contable->buscar($arrDet->OrigenID);

							//Si hay información de la cuenta contable
							if($otdConfContable)
							{
								//Asignar cuenta contable
								$strCuentaContable =  $otdConfContable->cuenta_contable;

								/****Inventario Origen***/
								//Datos del inventario
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = $strCuentaDepto;
								$objCuenta->strCuartoNivel = '00000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}
							}
							else
							{
								//Asignar mensaje de error
						 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE.' (Origen).';
						 		$this->ARR_DATOS['strError'] .= '<br>';
							}

					    }
						else
					    {
					    	//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
															 '.$strModulo.' (módulo).';
							$this->ARR_DATOS['strError'] .= '<br>';
					    }

					}//Cierre de foreach

				}//Cierre de verificación de detalles
			}
			else if ($intTipoMovimiento == ENTRADA_REFACCIONES_AJUSTE) //Entradas de refacciones por ajuste
			{
				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

				//Si hay información de la cuenta contable
				if($otdConfContable)
				{

					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{

							//Asignar valores del detalle
							$strModulo = $arrDet->Modulo;
							$intModuloID = $arrDet->modulo_id;

							$strConcepto = 'DIARIO POR ENTRADA DE '.$strModulo.' POR AJUSTE';
							$strObservaciones = $arrDet->observaciones;


							//Concatenar datos para realizar la búsqueda del departamento
							$strCriteriosBusq = $intModuloID.'|REFACCIONES';
							//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
							$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

							//Si existen datos del departamento (cuenta del módulo)
							if($otdConfDepto)
							{
								//Asignar cuenta del departamento
								$strCuentaDepto =  $otdConfDepto->cuenta;

								/****Inventario de Refacciones***/
								//Datos del inventario
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = $strCuentaDepto;
								$objCuenta->strCuartoNivel = '00000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'CARGO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

								/****Costo de venta***/
								//Costo de venta
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '501';
								$objCuenta->strSegundoNivel = '01';
								$objCuenta->strTercerNivel = $strCuentaContable;
								$objCuenta->strCuartoNivel = $strCuentaDepto.'000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}
							}
							else
						    {
						    	//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																 '.$strModulo.' (módulo).';
								$this->ARR_DATOS['strError'] .= '<br>';
						    }

						}//Cierre de foreach

					}//Cierre de verificación de detalles
				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}
			else if ($intTipoMovimiento == SALIDA_REFACCIONES_TALLER)//Salidas de refacciones por taller
			{

				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

				//Si hay información de la cuenta contable
				if($otdConfContable)
				{

					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Asignar valores del detalle
							$intModuloID = $arrDet->modulo_id;
							$strModulo = $arrDet->Modulo;

							$strConcepto = 'DIARIO POR SALIDA DE '.$strModulo;
							$strConcepto.= ' A TALLER A LA ORDEN DE REPARACION FOLIO '.$arrDet->OrdRep;


							/****Inventario del Taller***/
							//Datos del inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '01000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}


							//Concatenar datos para realizar la búsqueda del departamento
							$strCriteriosBusq = $intModuloID.'|REFACCIONES';
							//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
							$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);
							
							//Si existen datos del departamento (cuenta del módulo)
							if($otdConfDepto)
							{
								//Asignar cuenta del departamento
								$strCuentaDepto =  $otdConfDepto->cuenta;

								/****Inventario de Refacciones***/
								//Datos del inventario
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = $strCuentaDepto;
								$objCuenta->strCuartoNivel = '00000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

							}
							else
						    {
						    	//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																 '.$strModulo.' (módulo).';
								$this->ARR_DATOS['strError'] .= '<br>';
						    }

						}//Cierre de foreach

					}//Cierre de verificación de detalles

				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}
			else if ($intTipoMovimiento == SALIDA_REFACCIONES_CONSUMO_INTERNO)//Salidas de refacciones por consumo interno
			{
				//Variable que se utiliza para acumular salidas de refacciones
				$numRefacciones = 0;
				//Variable que se utiliza para acumular salidas de agricultura inteligente
				$numAgricultura = 0;

				//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Asignar valores del detalle
						$strModulo = $arrDet->Modulo;
						$intModuloID = $arrDet->modulo_id;
						$strTipoGasto = $arrDet->tipo_gasto;
						$strModuloTipoGasto = $arrDet->ModuloTipoGasto;
						

						$strConcepto = 'DIARIO POR SALIDA DE '.$strModulo.' POR USO INTERNO';
						$strObservaciones = $arrDet->observaciones;

						//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
						$otdConfContable = $this->config_contable->buscar($arrDet->sucursal_id);

						//Si hay información de la cuenta contable
						if($otdConfContable)
						{

							//Asignar cuenta contable
							$strCuentaContable =  $otdConfContable->cuenta_contable;

							//Datos del gasto
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->intCuentaPadreID = NULL;
							$objCuenta->intSatCuentaID = NULL;
							//Dependiendo del tipo de gasto asignar cuenta
							if ($strTipoGasto == 'GASTOS DE VENTA')
							{
								//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
								$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, $intModuloID);

								//Si existen datos del departamento (cuenta del módulo)
								if($otdConfModulo)
								{

									//Asignar cuenta del departamento
									$strCuentaModulo =  $otdConfModulo->cuenta;
									$objCuenta->strPrimerNivel = '602';
									$objCuenta->strSegundoNivel = $strCuentaContable;
									$objCuenta->strTercerNivel = $strCuentaModulo;

									
							    }
								else
							    {
							    	//Asignar mensaje de error
									$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo:  
																	  '.$strModuloTipoGasto;
									$this->ARR_DATOS['strError'] .= '<br>';
							    }
							}
							else if ($strTipoGasto == 'GASTOS DE ADMINISTRACION')
							{
								$objCuenta->strPrimerNivel = '603';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = '00';
							}
							else if ($strTipoGasto == 'GASTOS CORPORATIVOS')
							{
								$objCuenta->strPrimerNivel = '603';
								$objCuenta->strSegundoNivel = '10';
								$objCuenta->strTercerNivel = '00';
							}


							//Si existe primero, segundo y tercer nivel de la cuenta
							if($objCuenta->strPrimerNivel != NULL && $objCuenta->strSegundoNivel != NULL
							   && $objCuenta->strTercerNivel != NULL)
							{
								$objCuenta->strCuartoNivel = str_pad($arrDet->prefijo, 4, '0', STR_PAD_RIGHT);
								$objCuenta->strCuartoNivel = $objCuenta->strCuartoNivel.'1';
								$objCuenta->strDescripcion = 'CONSUMOS INTERNOS DE '.$arrDet->Gasto.' DE ALMACEN REFACCIONES';
								$objCuenta->strNaturaleza = NULL;
								$objCuenta->strTipoCuenta = NULL;
								$objCuenta->strAceptaMovimientos = 'SI';
								$objCuenta->strMovimientosBancarios  = 'NO';
								//Hacer un llamado a la función para obtener los datos de la cuenta 
								$arrCuenta = $this->get_cuenta($objCuenta, 'SI', "CONSUMOS");
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'CARGO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{	
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}
							}
							

						}
						else
						{
							//Asignar mensaje de error
					 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE.'(Tipo de gasto: '.$strTipoGasto.' SUC. '.$arrDet->sucursal.')';
					 		$this->ARR_DATOS['strError'] .= '<br>';
						}

						//Dependiendo del módulo incrementar acumulados
						if ($strModulo == 'REFACCIONES')
						{
							$numRefacciones += $arrDet->Subtotal;
						}
						else
						{
							$numAgricultura += $arrDet->Subtotal;
						}

					}//Cierre de foreach

				}//Cierre de verificación de detalles


				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

				//Si hay información de la cuenta contable
				if($otdConfContable)
				{

					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					/****Inventario de refacciones***/
					//Si existe acumulado de refacciones
					if ($numRefacciones > 0)
					{
						//Datos del inventario
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '115';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '02';
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numRefacciones, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{	
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}

					/****Inventario de Agricultura Inteligente***/
					//Si existe acumulado de agricultura
					if ($numAgricultura > 0)
					{
						//Datos del inventario
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '115';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '05';
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numAgricultura, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{	
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}
				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}
			}
			else if ($intTipoMovimiento == SALIDA_REFACCIONES_TRASPASO)//Salidas de refacciones por traspaso
			{

			}
			else if ($intTipoMovimiento == SALIDA_REFACCIONES_DEVOLUCION_PROVEEDOR)//Salidas de refacciones por devolución al proveedor
			{
				//Variable que se utiliza para acumular el subtotal
				$numSubtotal = 0;
				//Variable que se utiliza para acumular el importe de IVA
				$numIVA = 0;
				//Variable que se utiliza para acumular el importe de IEPS
				$numIEPS = 0;
				//Variables que se utilizan para asignar los datos del proveedor
				$strModulo = '';
				$intModuloID = 0;
				$strCodigo = '';
				$strProveedor = '';
				$strTipoProveedor = '';
				//Array que se utiliza para asignar los datos de las tasas de IEPS
				$arrIEPS = array();

				//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Asignar valores del detalle
						$strModulo = $arrDet->Modulo;
						$intModuloID = $arrDet->modulo_id;

						$strConcepto = 'DIARIO POR DEVOLUCION DE '.$strModulo;

						//Si existe factura
						if ($arrDet->factura != '')
						{
							$strConcepto.= ' DE LA FACTURA '.$arrDet->factura;
						}

						//Si existe remisión
						if ($arrDet->remision != '')
						{
							$strConcepto.= ' REMISION '.$arrDet->remision;
						}

						$strConcepto.= ' DE '.$arrDet->razon_social;
						$strModulo = $arrDet->Modulo;
						$intModuloID = $arrDet->modulo_id;
						$strCodigo = $arrDet->codigo;
						$strProveedor = $arrDet->razon_social;
						$strTipoProveedor = $arrDet->tipo_proveedor;

						//Incrementar acumulados
						$numSubtotal += $arrDet->Subtotal;
						$numIVA += $arrDet->IVA;
						$numIEPS += $arrDet->IEPS;

						//Si existe importe de IEPS
						if ($arrDet->IEPS > 0)
						{
							//Agregar datos al array
							array_push($arrIEPS, array('TasaID' => $arrDet->tasa_cuota_ieps,
													   'TasaIEPS' => $arrDet->TasaIEPS,  
													   'Importe' => $arrDet->IEPS));
						}

					}//Cierre de foreach

				}//Cierre de verificación de detalles

				
				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

				//Si hay información de la cuenta contable
				if($otdConfContable)
				{
					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					//Datos del proveedor
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->intCuentaPadreID = NULL;
					$objCuenta->intSatCuentaID = NULL;
					$objCuenta->strPrimerNivel = '201';
					$objCuenta->strSegundoNivel = NULL;
					$objCuenta->strTercerNivel = $strCuentaContable;
					$objCuenta->strCuartoNivel = NULL;
					$objCuenta->strDescripcion = $strProveedor;
					$objCuenta->strNaturaleza = NULL;
					$objCuenta->strTipoCuenta = NULL;
					$objCuenta->strAceptaMovimientos = 'SI';
					$objCuenta->strMovimientosBancarios  = 'NO';

					//Dependiendo del tipo de proveedor asignar datos de la cuenta
					if ($strTipoProveedor == 'NACIONAL')
					{
						$objCuenta->strSegundoNivel = '01';

						//Dependiendo del módulo asignar moneda
						if ($strModulo == 'REFACCIONES')
						{
							$objCuenta->strCuartoNivel = $MonRef[$otdFra->Moneda].substr($strCodigo, 1);
						}
						else
						{
							$objCuenta->strCuartoNivel = $MonAI[$otdFra->Moneda].substr($strCodigo, 1);
						}
					}
					else
					{
						$objCuenta->strSegundoNivel = '02';
						//Dependiendo del módulo asignar cuenta
						if ($strModulo == 'REFACCIONES')
						{
							$objCuenta->strCuartoNivel = '2'.substr($strCodigo, 1);
						}
						else
						{
							$objCuenta->strCuartoNivel = '5'.substr($strCodigo, 1);
						}
					}

					//Calcular importe
					$intImporte = ($numSubtotal + $numIVA + $numIEPS);

					//Hacer un llamado a la función para obtener los datos de la cuenta
					$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'PROVEEDOR');
					$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
					$arrAuxiliar['naturaleza'] = 'CARGO';
					$arrAuxiliar['referencia'] = '';
					$arrAuxiliar['concepto'] = '';
					//Si existe id de la cuenta
					if ($arrAuxiliar['cuenta_id'] > 0)
					{	
						//Agregar datos al array
						array_push($arrDetalles, $arrAuxiliar);
						//Incrementar renglón
						$intRenglon++;
					}

					
					//Concatenar datos para realizar la búsqueda del departamento
					$strCriteriosBusq = $intModuloID.'|REFACCIONES';
					//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
					$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

					//Si existen datos del departamento (cuenta del módulo)
					if($otdConfDepto)
					{
						//Asignar cuenta del departamento
						$strCuentaDepto =  $otdConfDepto->cuenta;

						/****Inventario***/
					    //Datos del inventario
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '115';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = $strCuentaDepto;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numSubtotal, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{	
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}
					else
				    {
				    	//Asignar mensaje de error
						$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
														 '.$strModulo.' (módulo).';
						$this->ARR_DATOS['strError'] .= '<br>';
				    }


					//Si existe importe de IVA
					if ($numIVA > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '119';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numIVA, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{	
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}

					//Hacer recorrido para obtener Tasas de IEPS
					foreach($arrIEPS as $objIEPS)
					{
						//Hacer un llamado al método para comprobar la existencia de la configuración del ieps
						$otdConfIeps = $this->config_polizas->buscar_configuracion_ieps(NULL, $objIEPS['TasaID']);

						//Si existen datos de la tasa (cuenta de la tasa de IEPS)
						if($otdConfIeps)
						{
							//Datos del IEPS
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '119';
							$objCuenta->strSegundoNivel = '03';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = $otdConfIeps->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($objIEPS['Importe'], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{	
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}
						else
					    {
					    	//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la tasa de IEPS: ';
							$this->ARR_DATOS['strError'] .=  $objIEPS['TasaIEPS'];
							$this->ARR_DATOS['strError'] .= '<br>';
					    }

					}//Cierre de foreach

				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}
			else if ($intTipoMovimiento == SALIDA_REFACCIONES_AJUSTE)//Salidas de refacciones por ajuste
			{

				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);
				
				//Si hay información de la cuenta contable
				if($otdConfContable)
				{
					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{

							//Asignar valores del detalle
							$strModulo = $arrDet->Modulo;
							$intModuloID = $arrDet->modulo_id;

							$strConcepto = 'DIARIO POR SALIDA DE '.$strModulo.' POR AJUSTE';
							$strObservaciones = $arrDet->observaciones;

							//Concatenar datos para realizar la búsqueda del departamento
							$strCriteriosBusq = $intModuloID.'|REFACCIONES';
							//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
							$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);


							//Si existen datos del departamento (cuenta del módulo)
							if($otdConfDepto)
							{
								//Asignar cuenta del departamento
								$strCuentaDepto =  $otdConfDepto->cuenta;

								/****Costo de venta***/
								//Costo de venta
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '501';
								$objCuenta->strSegundoNivel = '01';
								$objCuenta->strTercerNivel = $strCuentaContable;
								$objCuenta->strCuartoNivel = $strCuentaDepto.'000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'CARGO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

								/****Inventario de Refacciones***/
								//Datos del inventario
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = $strCuentaDepto;
								$objCuenta->strCuartoNivel = '00000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

							}
							else
						    {
						    	//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																 '.$strModulo.' (módulo).';
								$this->ARR_DATOS['strError'] .= '<br>';
						    }

						}//Cierre de foreach

					}//Cierre de verificación de detalles

				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}
			else if ($intTipoMovimiento == TIPO_SERVICIO_FACTURACION)//Factura de refacciones
			{
				//Variable que se utiliza para acumular el subtotal
				$numSubtotal = 0;
				//Variable que se utiliza para acumular el importe de IVA
				$numIVA = 0;
				//Variable que se utiliza para acumular el importe de IEPS
				$numIEPS = 0;
				//Variable que se utiliza para acumular el costo de refacciones
				$numCosto = 0;
				//Variable que se utiliza para asignar el gasto de paqueteria
				$numPaqueteria = 0;
				//Variable que se utiliza para asignar el importe de IVA del gasto de paqueteria
				$numPaqueteriaIVA = 0;
				//Variables que se utilizan para asignar los datos del cliente
				$strModulo = '';
				$intModuloID = 0;
				$strCodigo = '';
				$strCliente = '';
				$strCondiciones = '';


				//Array que se utiliza para asignar los datos de las tasas de IVA para clientes
				$arrClientes = array('REFACCIONES' => array($intTasaCuotaIDIvaCero => 0, 
														    $intTasaCuotaIDIva => 0),
									 'AGRICULTURA INTELIGENTE' => array($intTasaCuotaIDIvaCero => 0, 
									 									$intTasaCuotaIDIva => 0));

				//Array que se utiliza para asignar los datos de las tasas de IVA para ventas
				$arrVentas = array('REFACCIONES' => array($intTasaCuotaIDIvaCero => 0, 
														  $intTasaCuotaIDIva => 0),
								   'AGRICULTURA INTELIGENTE' => array($intTasaCuotaIDIvaCero => 0, 
								   									  $intTasaCuotaIDIva => 0));

				//Array que se utiliza para asignar los datos de las tasas de IVA para costos
				$arrCostos = array('REFACCIONES' => array($intTasaCuotaIDIvaCero => 0, 
														  $intTasaCuotaIDIva => 0),
								   'AGRICULTURA INTELIGENTE' => array($intTasaCuotaIDIvaCero => 0, 
								   									  $intTasaCuotaIDIva => 0));
				
				//Array que se utiliza para asignar los datos de las tasas de IEPS
				$arrIEPS = array();

				//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{

						//Asignar valores del detalle
						$strModulo = $arrDet->Modulo;
						$intModuloID = $arrDet->modulo_id;
						$strCodigo = $arrDet->codigo;
						$strCliente = $arrDet->razon_social;
						$strCondiciones = $arrDet->condiciones_pago;

						$strConcepto = 'DIARIO POR VENTA DE '.$strModulo;
						$strConcepto .= ' '.$strCondiciones;
 	
 						//Incrementar acumulados
						$numSubtotal += $arrDet->Subtotal;
						$numIVA += $arrDet->IVA;
						$numIEPS += $arrDet->IEPS;
						$numCosto += $arrDet->Costo;
						
						//Asignar gastos de paqueteria
						$numPaqueteria = $arrDet->gastos_paqueteria;
						$numPaqueteriaIVA = $arrDet->gastos_paqueteria_iva;

						//Agregar total al array de clientes
						$arrClientes[$strModulo][$arrDet->tasa_cuota_iva] += ($arrDet->Subtotal + 
																			  $arrDet->IVA + 
																			  $arrDet->IEPS);

						//Agregar subtotal al array de ventas
						$arrVentas[$strModulo][$arrDet->tasa_cuota_iva] += ($arrDet->Subtotal);

						//Agregar costo al array de costos
						$arrCostos[$strModulo][$arrDet->tasa_cuota_iva] += ($arrDet->Costo);


						//Si existe importe de IEPS
						if ($arrDet->IEPS > 0)
						{
							//Agregar datos al array
							array_push($arrIEPS, array('TasaID' => $arrDet->tasa_cuota_ieps,
													   'TasaIEPS' => $arrDet->TasaIEPS,
													   'Importe' => $arrDet->IEPS));
						}
						
						

					}//Cierre de foreach


				}//Cierre de verificación de detalles


				/****Gastos de paquetería***/
				$arrClientes[$strModulo][$intTasaCuotaIDIva] += ($numPaqueteria + $numPaqueteriaIVA);
				$arrVentas[$strModulo][$intTasaCuotaIDIva] += ($numPaqueteria);
				//Incrementar acumulado del IVA
				$numIVA += $numPaqueteriaIVA;	


				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

				//Si hay información de la cuenta contable
				if($otdConfContable)
				{
					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;


					/****Clientes de Refacciones IVA 16%***/
					//Si existen clientes con tasa de IVA del 16%
					if ($arrClientes['REFACCIONES'][$intTasaCuotaIDIva] > 0)
					{

						//Datos del cliente
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '105';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '03';
						$objCuenta->strCuartoNivel = $strCodigo;
						$objCuenta->strDescripcion = $strCliente;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrClientes['REFACCIONES'][$intTasaCuotaIDIva], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 16%


					/****Clientes de Refacciones IVA 0%***/
					//Si existen clientes con tasa de IVA del 0%
					if ($arrClientes['REFACCIONES'][$intTasaCuotaIDIvaCero] > 0)
					{
						//Datos del cliente
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '105';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '04';
						$objCuenta->strCuartoNivel = $strCodigo;
						$objCuenta->strDescripcion = $strCliente;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrClientes['REFACCIONES'][$intTasaCuotaIDIvaCero], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 0%



					/****Clientes de Agricultura Inteligente IVA 16%***/
					//Si existen clientes con tasa de IVA del 16%
					if ($arrClientes['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIva] > 0)
					{
						//Datos del cliente
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '105';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '09';
						$objCuenta->strCuartoNivel = $strCodigo;
						$objCuenta->strDescripcion = $strCliente;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrClientes['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIva], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 16%


					/****Clientes de Agricultura Inteligente IVA 0%***/
					//Si existen clientes con tasa de IVA del 0%
					if ($arrClientes['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIvaCero] > 0)
					{
						//Datos del cliente
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '105';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '10';
						$objCuenta->strCuartoNivel = $strCodigo;
						$objCuenta->strDescripcion = $strCliente;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrClientes['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIvaCero], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 0%

					//Dependiendo de las condiciones de pago asignar datos de la cuenta
					if ($strCondiciones == 'CONTADO')
					{

						/****Ventas de Refacciones IVA 16%***/
						//Si existen ventas con tasa de IVA del 16%
						if ($arrVentas['REFACCIONES'][$intTasaCuotaIDIva] > 0)
						{
							//Datos de la venta
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '401';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '02';
							$objCuenta->strCuartoNivel = '02000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
						    $arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrVentas['REFACCIONES'][$intTasaCuotaIDIva], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verifición de tasa de IVA del 16%



						/****Ventas de Refacciones IVA 0%***/
						//Si existen ventas con tasa de IVA del 0%
						if ($arrVentas['REFACCIONES'][$intTasaCuotaIDIvaCero] > 0)
						{
							//Datos de la venta
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '401';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '05';
							$objCuenta->strCuartoNivel = '02000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
						    $arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrVentas['REFACCIONES'][$intTasaCuotaIDIvaCero], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verifición de tasa de IVA del 0%



						/****Ventas de Agricultura Inteligente IVA 16%***/
						//Si existen ventas con tasa de IVA del 16%
						if ($arrVentas['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIva] > 0)
						{
							//Datos de la venta
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '401';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '02';
							$objCuenta->strCuartoNivel = '05000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
						    $arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrVentas['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIva], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verifición de tasa de IVA del 16%


						/****Ventas de Agricultura Inteligente IVA 0%***/
						//Si existen ventas con tasa de IVA del 0%
						if ($arrVentas['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIvaCero] > 0)
						{
							//Datos de la venta
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '401';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '05';
							$objCuenta->strCuartoNivel = '05000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
						    $arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrVentas['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIvaCero], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verifición de tasa de IVA del 0%
					}
					else
					{

						/****Ventas de Refacciones IVA 16%***/
						//Si existen ventas con tasa de IVA del 16%
						if ($arrVentas['REFACCIONES'][$intTasaCuotaIDIva] > 0)
						{
							//Datos de la venta
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '401';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '02000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
						    $arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrVentas['REFACCIONES'][$intTasaCuotaIDIva], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verifición de tasa de IVA del 16%



						/****Ventas de Refacciones IVA 0%***/
						//Si existen ventas con tasa de IVA del 0%
						if ($arrVentas['REFACCIONES'][$intTasaCuotaIDIvaCero] > 0)
						{
							//Datos de la venta
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '401';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '06';
							$objCuenta->strCuartoNivel = '02000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
						    $arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrVentas['REFACCIONES'][$intTasaCuotaIDIvaCero], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verifición de tasa de IVA del 0%


						/****Ventas de Agricultura Inteligente IVA 16%***/
						//Si existen ventas con tasa de IVA del 16%
						if ($arrVentas['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIva] > 0)
						{
							//Datos de la venta
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '401';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '03';
							$objCuenta->strCuartoNivel = '05000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
						    $arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrVentas['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIva], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verifición de tasa de IVA del 16%



						/****Ventas de Agricultura Inteligente IVA 0%***/
						//Si existen ventas con tasa de IVA del 0%
						if ($arrVentas['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIvaCero] > 0)
						{
							//Datos de la venta
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '401';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '06';
							$objCuenta->strCuartoNivel = '05000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
						    $arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrVentas['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIvaCero], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de verifición de tasa de IVA del 0%
					}


					//Si existe importe de IVA
					if ($numIVA > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '209';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numIVA, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}


					//Hacer recorrido para obtener Tasas de IEPS
					foreach($arrIEPS as $objIEPS)
					{

						//Hacer un llamado al método para comprobar la existencia de la configuración del ieps
						$otdConfIeps = $this->config_polizas->buscar_configuracion_ieps(NULL, $objIEPS['TasaID']);

						//Si existen datos de la tasa (cuenta de la tasa de IEPS)
						if($otdConfIeps)
						{
							//Datos del IEPS
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '209';
							$objCuenta->strSegundoNivel = '02';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = $otdConfIeps->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($objIEPS['Importe'], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}
						else
					    {
					    	//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la tasa de IEPS: ';
							$this->ARR_DATOS['strError'] .=  $objIEPS['TasaIEPS'];
							$this->ARR_DATOS['strError'] .= '<br>';
					    }

					}//Cierre de foreach



					/****Costos de Refacciones IVA 16%***/
					//Si existen costos con tasa de IVA del 16%
					if ($arrCostos['REFACCIONES'][$intTasaCuotaIDIva] > 0)
					{

						/****Costo***/
						//Datos del costo
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '501';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '02000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrCostos['REFACCIONES'][$intTasaCuotaIDIva], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 16%


					/****Costos de Refacciones IVA 0%***/
					//Si existen costos con tasa de IVA del 0%
					if ($arrCostos['REFACCIONES'][$intTasaCuotaIDIvaCero] > 0)
					{
						/****Costo***/
						//Datos del costo
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '501';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel ='02000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrCostos['REFACCIONES'][$intTasaCuotaIDIvaCero], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 0%


					/****Costos de  Agricultura Inteligente IVA 16%***/
					//Si existen costos con tasa de IVA del 16%
					if ($arrCostos['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIva] > 0)
					{

						/****Costo***/
						//Datos del costo
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '501';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '05000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrCostos['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIva], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 16%


					/****Costos de Agricultura Inteligente IVA 0%***/
					//Si existen costos con tasa de IVA del 0%
					if ($arrCostos['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIvaCero] > 0)
					{
						/****Costo***/
						//Datos del costo
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '501';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '05000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrCostos['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIvaCero], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 0%



					/****Inventario de Refacciones IVA 16%***/
					//Si existen costos con tasa de IVA del 16%
					if ($arrCostos['REFACCIONES'][$intTasaCuotaIDIva] > 0)
					{

						/****Inventario***/
						//Datos del inventario
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '115';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '02';
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrCostos['REFACCIONES'][$intTasaCuotaIDIva], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 16%


					/****Inventario de Refacciones IVA 0%***/
					//Si existen costos con tasa de IVA del 0%
					if ($arrCostos['REFACCIONES'][$intTasaCuotaIDIvaCero] > 0)
					{
						/****Inventario***/
						//Datos del inventario
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '115';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '02';
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrCostos['REFACCIONES'][$intTasaCuotaIDIvaCero], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 0%


					/****Inventario de  Agricultura Inteligente IVA 16%***/
					//Si existen costos con tasa de IVA del 16%
					if ($arrCostos['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIva] > 0)
					{

						/****Inventario***/
						//Datos del inventario
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '115';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '05';
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrCostos['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIva], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 16%


					/****Inventario de Agricultura Inteligente IVA 0%***/
					//Si existen costos con tasa de IVA del 0%
					if ($arrCostos['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIvaCero] > 0)
					{
						/****Inventario***/
						//Datos del inventario
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '115';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '05';
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrCostos['AGRICULTURA INTELIGENTE'][$intTasaCuotaIDIvaCero], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 0%


			    }
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}//Cierre de la verificación del tipo de movimiento


			//Concatenar datos para realizar la búsqueda del proceso
			$strCriteriosBusq = $intTipoMovimiento.'|REFACCIONES';

			//Hacer un llamado al método para comprobar la existencia de la configuración del proceso
			$otdConfProceso = $this->config_polizas->buscar_configuracion_procesos(NULL, $strCriteriosBusq);

			//Si existen datos del proceso
			if($otdConfProceso)
			{
				//Asignar datos de la póliza
				$objPoliza->intSucursalID =  $otdFra->sucursal_id;
				$objPoliza->strTipo = 'DIARIO';
				$objPoliza->strModulo = 'REFACCIONES';
				$objPoliza->strProceso = $otdConfProceso->proceso;
				$objPoliza->intReferenciaID = $otdFra->referencia_id;
				$objPoliza->dteFecha = $otdFra->fecha;
				$objPoliza->strConcepto = $strConcepto;
				$objPoliza->strObservaciones = $strObservaciones;
				$objPoliza->strEstatus = 'ACTIVO';
				$objPoliza->arrDetalles = $arrDetalles;

				//Hacer un llamado a la función para guardar los datos de la póliza en la BD
				$this->guardar_poliza_referencia($objPoliza, $intProcesoMenuID);
			}
			else
			{
				//Asignar mensaje de error
				$this->ARR_DATOS['strError'] .= 'No existe configuración del proceso para 
												 el tipo de movimiento.';
				$this->ARR_DATOS['strError'] .= '<br>';
			}


		}
		else
		{
			//Indicar mensaje de error (no se genera la póliza porque no se cumplen con las restricciones / no existe información del registro)
			$this->ARR_DATOS['strError'] = MSJ_ERROR_POLIZA;
		}

	}


	//Método para generar una póliza con los datos de la factura de maquinaria y movimientos de maquinaria
	public function get_poliza_maquinaria($intReferenciaID, $strTipoReferencia, $intProcesoMenuID)
	{


		//Array's que se utilizan para las cuentas de monedas
		$MonMaq = array('MXN' =>'1', 'USD' =>'2');
		$MonCon = array('MXN' =>'5', 'USD' =>'6');

		//------------------------------------------------------------------------------------------------------------------------
		//---------- DATOS DE LA REFERENCIA 
		//------------------------------------------------------------------------------------------------------------------------
       	//Seleccionar datos del registro
       	$otdFra = $this->facturas_maquinaria->buscar_referencia_poliza($intReferenciaID, $strTipoReferencia);

       	//Verificar si hay información del registro
		if($otdFra)
		{	

			//Asignar el folio de la referencia (movimiento/factura)
			$this->ARR_DATOS['strFolioReferencia'] = $otdFra->folio;

			//Crear un objeto vacio, stdClass es el objeto Póliza
			$objPoliza = new stdClass();
			//Array que se utiliza para agregar los detalles de la póliza 
			$arrDetalles = array();
			//Array que se utiliza para agregar los datos de un detalle
			$arrAuxiliar = array();
			//Variables que se utilizan para asignar datos de la póliza
			$strConcepto = '';
			$strObservaciones = '';
			//Variables que se utilizan para asignar datos del detalle
			$intRenglon = 1;
			//Asignar el id del tipo de movimiento
			$intTipoMovimiento = $otdFra->tipo_movimiento;
			//Constante para identificar los datos del SAT correspondientes al IVA 16%
			$intTasaCuotaIDIva = SAT_TASA_CUOTA_IVA_ID;
			//Constante para identificar los datos del SAT correspondientes al IVA cero
			$intTasaCuotaIDIvaCero = SAT_TASA_CUOTA_IVA_CERO_ID;


			//------------------------------------------------------------------------------------------------------------------------
			//---------- DETALLES DE LA REFERENCIA 
			//------------------------------------------------------------------------------------------------------------------------
			//Seleccionar los detalles del registro
		    $otdDetalles = $this->facturas_maquinaria->buscar_detalles_poliza($intReferenciaID, 	
		    																   $intTipoMovimiento);


			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL REGISTRO 
	        //------------------------------------------------------------------------------------------------------------------------
		    //Dependiendo del tipo de movimiento generar póliza
			if($intTipoMovimiento == ENTRADA_MAQUINARIA_COMPRA) //Entradas de maquinaria por compra
			{
				
				//Variable que se utiliza para acumular el subtotal
				$numSubtotal = 0;
				//Variable que se utiliza para acumular el importe de IVA
				$numIVA = 0;
				//Variables que se utilizan para asignar los datos del proveedor
				$strModulo = '';
				$intModuloID = 0;
				$strCodigo = '';
				$strProveedor = '';
				$strTipoProveedor = '';
				$strConsignacion = 'NO';

				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

				//Si hay información de la cuenta contable
				if($otdConfContable)
				{

					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{	
							//Asignar valores del detalle
							$strCodigo = $arrDet->codigo;
						    $strProveedor = $arrDet->razon_social;
							$strTipoProveedor = $arrDet->tipo_proveedor;
							$strConsignacion = $arrDet->consignacion;
							$intModuloID =  $arrDet->modulo_id;
							$strModulo = '';
							//Array que se utiliza para asignar los datos de la cuenta del departamento
							$arrModulo = NULL;

							//Concatenar datos para realizar la búsqueda del departamento
							$strCriteriosBusq = $intModuloID.'|MAQUINARIA';
							//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
							$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

							//Si existen datos del departamento (cuenta del módulo)
							if($otdConfDepto)
							{
								 //Asignar cuenta del departamento
								$strCuentaDepto =  $otdConfDepto->cuenta;
								//Separar cuenta del departamento
								$arrModulo = explode("|", $strCuentaDepto);
								$strModulo = $arrModulo[1];

								//Si existe motor
								if ($arrDet->motor != '')
								{
									$strDescripcion = $arrDet->descripcion_corta;
									$strDescripcion .=' NS.: '.$arrDet->serie.'-'.$arrDet->motor;
								}
								else
								{
									$strDescripcion = $arrDet->descripcion_corta.' NS.: '.$arrDet->serie;
								}

								

								//Si existe consignación
								if ($arrDet->consignacion == 'SI')
								{

									//Calcular importe
									$intImporte = ($arrDet->precio_unitario + $arrDet->iva_unitario);


									/****Inventario***/
									//Datos del inventario
									$arrAuxiliar['renglon'] = $intRenglon;
									//Crear un objeto vacio, stdClass es el objeto Cuenta
									$objCuenta = new stdClass();
									$objCuenta->intCuentaPadreID = NULL;
									$objCuenta->intSatCuentaID = NULL;
									$objCuenta->strPrimerNivel = '814';
									$objCuenta->strSegundoNivel = '01';
									$objCuenta->strTercerNivel = $strCuentaContable;
									$objCuenta->strCuartoNivel = $arrDet->codigo_interno;
									$objCuenta->strDescripcion = $strDescripcion;
									$objCuenta->strNaturaleza = NULL;
									$objCuenta->strTipoCuenta = NULL;
									$objCuenta->strAceptaMovimientos = 'SI';
									$objCuenta->strMovimientosBancarios  = 'NO';
									//Hacer un llamado a la función para obtener los datos de la cuenta
									$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CONSIGNACION');
									$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
									$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
									$arrAuxiliar['naturaleza'] = 'CARGO';
									$arrAuxiliar['referencia'] = '';
									$arrAuxiliar['concepto'] = '';
									//Si existe id de la cuenta
									if ($arrAuxiliar['cuenta_id'] > 0)
									{
										//Agregar datos al array
										array_push($arrDetalles, $arrAuxiliar);
										//Incrementar renglón
										$intRenglon++;
									}


									$strConcepto = 'DIARIO POR CONSIGNACION DE '.$strModulo;
								}
								else
								{
									/****Inventario***/
									//Datos del inventario
									$arrAuxiliar['renglon'] = $intRenglon;
									//Crear un objeto vacio, stdClass es el objeto Cuenta
									$objCuenta = new stdClass();
									$objCuenta->intCuentaPadreID = NULL;
									$objCuenta->intSatCuentaID = NULL;
									$objCuenta->strPrimerNivel = '115';
									$objCuenta->strSegundoNivel = $strCuentaContable;
									$objCuenta->strTercerNivel = $arrModulo[0];
									$objCuenta->strCuartoNivel = $arrDet->codigo_interno;
									$objCuenta->strDescripcion = $strDescripcion;
									$objCuenta->strNaturaleza = NULL;
									$objCuenta->strTipoCuenta = NULL;
									$objCuenta->strAceptaMovimientos = 'SI';
									$objCuenta->strMovimientosBancarios  = 'NO';
									//Hacer un llamado a la función para obtener los datos de la cuenta
									$arrCuenta = $this->get_cuenta($objCuenta,  'SI', 'INVENTARIO');
									$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
									$arrAuxiliar['importe'] = number_format($arrDet->precio_unitario, 5, '.', '');
									$arrAuxiliar['naturaleza'] = 'CARGO';
									$arrAuxiliar['referencia'] = '';
									$arrAuxiliar['concepto'] = '';
									//Si existe id de la cuenta
									if ($arrAuxiliar['cuenta_id'] > 0)
									{
										//Agregar datos al array
										array_push($arrDetalles, $arrAuxiliar);
										//Incrementar renglón
										$intRenglon++;
									}

									$strConcepto = 'DIARIO POR COMPRA DE '.$strModulo;
								}


								//Si existe factura de la orden de compra
								if ($arrDet->factura != '')
								{
									$strConcepto.= ' CON FACTURA '.$arrDet->factura;
								}


								$strConcepto.= ' DE '.$arrDet->razon_social;

								//Incrementar acumulados
								$numSubtotal += $arrDet->precio_unitario;
								$numIVA += $arrDet->iva_unitario;
									
								
						    }
						    else
						    {
						    	//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																 '.$strModulo.' (módulo).';
								$this->ARR_DATOS['strError'] .= '<br>';
						    }

						}//Cierre de foreach

					}//Cierre de verificación de detalles
					

					//Calcular importe
					$intImporte = ($numSubtotal + $numIVA);

					//Si existe consignación
					if ($strConsignacion == 'SI')
					{

						//Datos del proveedor
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '814';
						$objCuenta->strSegundoNivel = '02';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = $strCodigo;
						$objCuenta->strDescripcion = $strProveedor;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CONSIGNACION');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}
					else
					{
						//Si existe importe de IVA
						if ($numIVA > 0)
						{
							//Datos del IVA
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '119';
							$objCuenta->strSegundoNivel = '01';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = '00000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numIVA, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}

						//Datos del proveedor
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '201';
						$objCuenta->strSegundoNivel = NULL;
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = NULL;
						$objCuenta->strDescripcion = $strProveedor;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';
						//Dependiendo del tipo de proveedor asignar datos de la cuenta
						if ($strTipoProveedor == 'NACIONAL')
						{
							$objCuenta->strSegundoNivel = '01';

							//Dependiendo del módulo asignar moneda
							if ($strModulo == 'MAQUINARIA AGRICOLA')
							{
								$objCuenta->strCuartoNivel = $MonMaq[$otdFra->Moneda].substr($strCodigo, 1);
							}
							else
							{
								$objCuenta->strCuartoNivel = $MonCon[$otdFra->Moneda].substr($strCodigo, 1);
							}
						}
						else
						{
							$objCuenta->strSegundoNivel = '02';

							//Dependiendo del módulo asignar cuenta
							if ($strModulo == 'MAQUINARIA AGRICOLA')
							{
								$objCuenta->strCuartoNivel = '1'.substr($strCodigo, 1);
							}
							else
							{
								$objCuenta->strCuartoNivel = '4'.substr($strCodigo, 1);
							}
						}

						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'PROVEEDOR');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}
				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}
			else if ($intTipoMovimiento == ENTRADA_MAQUINARIA_TRASPASO) //Entradas de maquinaria por traspaso
			{


					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Asignar valores del detalle
							$intModuloID =  $arrDet->modulo_id;
							$strModulo = '';
							//Array que se utiliza para asignar los datos de la cuenta del departamento
							$arrModulo = NULL;

							//Concatenar datos para realizar la búsqueda del departamento
							$strCriteriosBusq = $intModuloID.'|MAQUINARIA';
							//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
							$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

							//Si existen datos del departamento (cuenta del módulo)
							if($otdConfDepto)
							{	

								//Asignar cuenta del departamento
								$strCuentaDepto =  $otdConfDepto->cuenta;
								//Separar cuenta del departamento
								$arrModulo = explode("|", $strCuentaDepto);
								$strModulo = $arrModulo[1];
								
							}
							else
						    {
						    	//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																 '.$strModulo.' (módulo).';
								$this->ARR_DATOS['strError'] .= '<br>';
						    }



							//Si existe motor
							if ($arrDet->motor != '')
							{
								$strDescripcion = $arrDet->descripcion_corta;
								$strDescripcion .= ' NS.: '.$arrDet->serie.'-'.$arrDet->motor;
							}
							else
							{
								$strDescripcion = $arrDet->descripcion_corta;
								$strDescripcion .= ' NS.: '.$arrDet->serie;
							}

							/****Inventario***/
							//Crear un objeto vacio, stdClass es el objeto Inventario
							$objInventario = new stdClass();
							$objInventario->intSucursalID = $otdFra->sucursal_id;
							$objInventario->intMaquinariaDescripcionID = $arrDet->maquinaria_descripcion_id;
							$objInventario->strSerie = $arrDet->serie;
							$objInventario->strConsignacion = $arrDet->consignacion;
							$objInventario->intCosto = $arrDet->costo;

							//Si no existe código interno
							if ($arrDet->codigo_interno == '')
							{
								//Asignar código interno consecutivo
								$objInventario->strCodigoInterno = $this->inventario_maquinaria->get_codigo_interno($arrDet->consignacion);

								//Hacer un llamado a la función para modificar los datos del inventario en la BD
								$this->modificar_inventario_maquinaria($objInventario, 'ENTRADA');

							}
							else
							{
								$objInventario->strCodigoInterno = $arrDet->codigo_interno;
							}

							

							//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal de origen
							$otdConfContableOrigen = $this->config_contable->buscar($arrDet->OrigenID);
							
							//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal de destino
							$otdConfContableDestino = $this->config_contable->buscar($arrDet->DestinoID);
							//Variable que se utiliza para asignar la cuenta contable de la sucursal de origen
							$strCuentaContableOrigen = '';
							//Variable que se utiliza para asignar la cuenta contable de la sucursal de destino
							$strCuentaContableDestino = '';
							//Variable que se utiliza para asignar el id de la cuenta inventario origen
							$intCuentaIDInvOrigen = 0;

							//Si hay información de la cuenta contable de la sucursal origen
							if($otdConfContableOrigen)
							{
								//Asignar cuenta contable
								$strCuentaContableOrigen =  $otdConfContableOrigen->cuenta_contable;
							}


							//Si hay información de la cuenta contable de la sucursal destino
							if($otdConfContableDestino)
							{
								//Asignar cuenta contable
								$strCuentaContableDestino =  $otdConfContableDestino->cuenta_contable;
							}


							//Si existe cuenta contable de la sucursal de origen
							if($strCuentaContableOrigen != '')
							{

								//Si existe consignación
								if ($arrDet->consignacion == 'SI')
								{
									/****Cuenta de Inventario origen***/
									//Datos de la cuenta de inventario
									//Crear un objeto vacio, stdClass es el objeto Cuenta
									$objCuenta = new stdClass();
									$objCuenta->intCuentaPadreID = NULL;
									$objCuenta->intSatCuentaID = NULL;
									$objCuenta->strPrimerNivel = '814';
									$objCuenta->strSegundoNivel = '01';
									$objCuenta->strTercerNivel = $strCuentaContableOrigen;
									$objCuenta->strCuartoNivel = $objInventario->strCodigoInterno;
									$objCuenta->strDescripcion = $strDescripcion;
									$objCuenta->strNaturaleza = NULL;
									$objCuenta->strTipoCuenta = NULL;
									$objCuenta->strAceptaMovimientos = 'SI';
								    $objCuenta->strMovimientosBancarios  = 'NO';
								    //Hacer un llamado a la función para obtener los datos de la cuenta
									$arrCuenta = $this->get_cuenta($objCuenta,'SI', 'CONSIGNACION');
									//Asignar el id de la cuenta inventario origen
									$intCuentaIDInvOrigen = $arrCuenta['cuenta_id'];
								}
								else
								{

									//Si existen datos de la cuenta del departamento
									if($arrModulo != NULL)
									{
										/****Cuenta de Inventario origen***/
										//Datos de la cuenta de inventario
										//Crear un objeto vacio, stdClass es el objeto Cuenta
										$objCuenta = new stdClass();
										$objCuenta->intCuentaPadreID = NULL;
										$objCuenta->intSatCuentaID = NULL;
										$objCuenta->strPrimerNivel = '115';
										$objCuenta->strSegundoNivel = $strCuentaContableOrigen;
										$objCuenta->strTercerNivel = $arrModulo[0];
										$objCuenta->strCuartoNivel = $objInventario->strCodigoInterno;
										$objCuenta->strDescripcion = $strDescripcion;
										$objCuenta->strNaturaleza = NULL;
										$objCuenta->strTipoCuenta = NULL;
										$objCuenta->strAceptaMovimientos = 'SI';
										$objCuenta->strMovimientosBancarios  = 'NO';
										//Hacer un llamado a la función para obtener los datos de la cuenta
										$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'INVENTARIO');

										//Asignar el id de la cuenta inventario origen
										$intCuentaIDInvOrigen = $arrCuenta['cuenta_id'];
								    }
								}

							}
							



							//Asignar costo de la cuenta contable
							$intCostoCta = $this->get_costo($intCuentaIDInvOrigen, $otdFra->fecha);

							//Si el id del inventario es 1
							/*if ($arrDet->entrada_id == 1)
							{
									
								//Incrementar costo
								$arrDet->costo = $arrDet->costo + $intCostoCta;

							}
							else
							{
								$arrDet->costo = $intCostoCta;
							}*/

							//Si existe costo de la cuenta contable (cargos y abonos)
							//Nota: se hace de esta manera porque a veces no existen costos
							if($intCostoCta > 0)
							{
								

								//Si se cumpla la sentencia
								if($intCostoCta <> $arrDet->costo)
								{
									
									//Incrementar costo
									$arrDet->costo = $arrDet->costo + $intCostoCta;
									
								}
								else
								{
									//Asignar costo de la cuenta contable
							 		$arrDet->costo = $intCostoCta;
								}
							}

							//Si existen cuentas contables
							if($strCuentaContableOrigen != '' && $strCuentaContableDestino != '')
							{
								//Si existe consignación
								if ($arrDet->consignacion == 'SI')
								{
										/****Cuenta de Inventario destino***/
										//Datos de la cuenta de inventario
										$arrAuxiliar['renglon'] = $intRenglon;
										//Crear un objeto vacio, stdClass es el objeto Cuenta
										$objCuenta = new stdClass();
										$objCuenta->intCuentaPadreID = NULL;
										$objCuenta->intSatCuentaID = NULL;
										$objCuenta->strPrimerNivel = '814';
										$objCuenta->strSegundoNivel = '01';
										$objCuenta->strTercerNivel = $strCuentaContableDestino;
										$objCuenta->strCuartoNivel = $objInventario->strCodigoInterno;
										$objCuenta->strDescripcion = $strDescripcion;
										$objCuenta->strNaturaleza = NULL;
										$objCuenta->strTipoCuenta = NULL;
										$objCuenta->strAceptaMovimientos = 'SI';
										$objCuenta->strMovimientosBancarios  = 'NO';
										//Hacer un llamado a la función para obtener los datos de la cuenta
										$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CONSIGNACION');
										$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
										$arrAuxiliar['importe'] = number_format($arrDet->costo, 5, '.', '');
										$arrAuxiliar['naturaleza'] = 'CARGO';
										$arrAuxiliar['referencia'] = '';
										$arrAuxiliar['concepto'] = '';
										//Si existe id de la cuenta
										if ($arrAuxiliar['cuenta_id'] > 0)
										{
											//Agregar datos al array
											array_push($arrDetalles, $arrAuxiliar);
											//Incrementar renglón
											$intRenglon++;
										}


									/****Cuenta de Inventario origen***/
									//Datos de la cuenta de inventario
									$arrAuxiliar['renglon'] = $intRenglon;
									//Crear un objeto vacio, stdClass es el objeto Cuenta
									$objCuenta = new stdClass();
									$objCuenta->intCuentaPadreID = NULL;
									$objCuenta->intSatCuentaID = NULL;
									$objCuenta->strPrimerNivel = '814';
									$objCuenta->strSegundoNivel = '01';
									$objCuenta->strTercerNivel = $strCuentaContableOrigen;;
									$objCuenta->strCuartoNivel = $objInventario->strCodigoInterno;
									$objCuenta->strDescripcion = $strDescripcion;
									$objCuenta->strNaturaleza = NULL;
									$objCuenta->strTipoCuenta = NULL;
									$objCuenta->strAceptaMovimientos = 'SI';
									$objCuenta->strMovimientosBancarios  = 'NO';
									//Hacer un llamado a la función para obtener los datos de la cuenta
									$arrCuenta =  $this->get_cuenta($objCuenta, 'SI', 'CONSIGNACION');
									$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
									$arrAuxiliar['importe'] = number_format($arrDet->costo, 5, '.', '');
									$arrAuxiliar['naturaleza'] = 'ABONO';
									$arrAuxiliar['referencia'] = '';
									$arrAuxiliar['concepto'] = '';
									//Si existe id de la cuenta
									if ($arrAuxiliar['cuenta_id'] > 0)
									{
										//Agregar datos al array
										array_push($arrDetalles, $arrAuxiliar);
										//Incrementar renglón
										$intRenglon++;
									}

								}
								else
								{
									//Si existen datos de la cuenta del departamento
									if($arrModulo != NULL)
									{
									
										/****Cuenta de Inventario destino***/
									    //Datos de la cuenta de inventario
										$arrAuxiliar['renglon'] = $intRenglon;
										//Crear un objeto vacio, stdClass es el objeto Cuenta
										$objCuenta = new stdClass();
										$objCuenta->intCuentaPadreID = NULL;
										$objCuenta->intSatCuentaID = NULL;
										$objCuenta->strPrimerNivel = '115';
										$objCuenta->strSegundoNivel = $strCuentaContableDestino;
										$objCuenta->strTercerNivel = $arrModulo[0];
										$objCuenta->strCuartoNivel = $objInventario->strCodigoInterno;
										$objCuenta->strDescripcion = $strDescripcion;
										$objCuenta->strNaturaleza = NULL;
										$objCuenta->strTipoCuenta = NULL;
										$objCuenta->strAceptaMovimientos = 'SI';
										$objCuenta->strMovimientosBancarios  = 'NO';
										//Hacer un llamado a la función para obtener los datos de la cuenta
										$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'INVENTARIO');
										$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
										$arrAuxiliar['importe'] = number_format($arrDet->costo, 5, '.', '');
										$arrAuxiliar['naturaleza'] = 'CARGO';
										$arrAuxiliar['referencia'] = '';
										$arrAuxiliar['concepto'] = '';
										//Si existe id de la cuenta
										if ($arrAuxiliar['cuenta_id'] > 0)
										{

											//Agregar datos al array
											array_push($arrDetalles, $arrAuxiliar);
											//Incrementar renglón
											$intRenglon++;
										}


										/****Cuenta de Inventario origen***/
									    //Datos de la cuenta de inventario
										$arrAuxiliar['renglon'] = $intRenglon;
										//Crear un objeto vacio, stdClass es el objeto Cuenta
										$objCuenta = new stdClass();
										$objCuenta->intCuentaPadreID = NULL;
										$objCuenta->intSatCuentaID = NULL;
										$objCuenta->strPrimerNivel = '115';
										$objCuenta->strSegundoNivel = $strCuentaContableOrigen;
										$objCuenta->strTercerNivel = $arrModulo[0];
										$objCuenta->strCuartoNivel = $objInventario->strCodigoInterno;
										$objCuenta->strDescripcion = $strDescripcion;
										$objCuenta->strNaturaleza = NULL;
										$objCuenta->strTipoCuenta = NULL;
										$objCuenta->strAceptaMovimientos = 'SI';
										$objCuenta->strMovimientosBancarios  = 'NO';
										//Hacer un llamado a la función para obtener los datos de la cuenta
										$arrCuenta =  $this->get_cuenta($objCuenta, 'SI', 'INVENTARIO');
										$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
										$arrAuxiliar['importe'] = number_format($arrDet->costo, 5, '.', '');
										$arrAuxiliar['naturaleza'] = 'ABONO';
										$arrAuxiliar['referencia'] = '';
										$arrAuxiliar['concepto'] = '';
										//Si existe id de la cuenta
										if ($arrAuxiliar['cuenta_id'] > 0)
										{
											//Agregar datos al array
											array_push($arrDetalles, $arrAuxiliar);
											//Incrementar renglón
											$intRenglon++;
										}
									}
								}

								$strConcepto = 'DIARIO POR ENTRADA POR TRASPASO DE '.$strModulo;
								$strConcepto.= ' DE LA SUCURSAL '.$arrDet->Origen;
							
							}


							//Si no existe cuenta contable de la sucursal de origen
							if($strCuentaContableOrigen == '')
							{
								//Asignar mensaje de error
						 		$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la sucursal de origen.';
						 		$this->ARR_DATOS['strError'] .= '<br>';
							}

							//Si no existe cuenta contable de la sucursal destino
							if($strCuentaContableDestino == '')
							{
								//Asignar mensaje de error
						 		$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la sucursal destino.';
						 		$this->ARR_DATOS['strError'] .= '<br>';
							}


						}//Cierre de foreach

				    }//Cierre de verificación de detalles

			}
			else if ($intTipoMovimiento == ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA)//Entradas de maquinaria por devolución de factura
			{

				//Variable que se utiliza para acumular el subtotal
				$numSubtotal = 0;
				//Variable que se utiliza para acumular el importe de IVA
				$numIVA = 0;
				//Variable que se utiliza para acumular el costo
				$numCosto = 0;
				//Variables que se utilizan para asignar los datos del proveedor
				$strModulo = '';
				$intModuloID = 0;
				$strCodigo = '';
				$strCliente = '';
				$strCondiciones = '';

				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

				//Si hay información de la cuenta contable
				if($otdConfContable)
				{

					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;


					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{	
						   //Asignar valores del detalle
							$intModuloID =  $arrDet->modulo_id;
							$strModulo = '';
							//Array que se utiliza para asignar los datos de la cuenta del departamento
							$arrModulo = NULL;

						    //Si existe motor
						    if ($arrDet->motor != '')
							{
								$strDescripcion = $arrDet->descripcion_corta;
								$strDescripcion .= ' NS.: '.$arrDet->serie.'-'.$arrDet->motor;
							}
							else
							{
								$strDescripcion = $arrDet->descripcion_corta;
								$strDescripcion .= ' NS.: '.$arrDet->serie;
							}


							//Concatenar datos para realizar la búsqueda del departamento
							$strCriteriosBusq = $intModuloID.'|MAQUINARIA';
							//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
							$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);
						    //Si existen datos del departamento (cuenta del módulo)
							if($otdConfDepto)
							{	

								//Asignar cuenta del departamento
								$strCuentaDepto =  $otdConfDepto->cuenta;
								//Separar cuenta del departamento
								$arrModulo = explode("|", $strCuentaDepto);
								$strModulo = $arrModulo[1];

								/****Inventario***/
								//Crear un objeto vacio, stdClass es el objeto Inventario
								$objInventario = new stdClass();
								$objInventario->intSucursalID = $otdFra->sucursal_id;
								$objInventario->intMaquinariaDescripcionID = $arrDet->maquinaria_descripcion_id;
								$objInventario->strSerie = $arrDet->serie;
								$objInventario->strConsignacion = $arrDet->consignacion;
								$objInventario->intCosto = $arrDet->costo;

								//Si no existe código interno
								if ($arrDet->codigo_interno == '')
								{
									//Asignar código interno consecutivo
									$objInventario->strCodigoInterno = $this->inventario_maquinaria->get_codigo_interno($arrDet->consignacion);
									
									//Hacer un llamado a la función para modificar los datos del inventario en la BD
									$this->modificar_inventario_maquinaria($objInventario, 'DEVOLUCION');
								}
								else
								{
									$objInventario->strCodigoInterno = $arrDet->codigo_interno;
								}

								/****Inventario***/
								//Datos del inventario
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->intCuentaPadreID = NULL;
								$objCuenta->intSatCuentaID = NULL;
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = $arrModulo[0];
								$objCuenta->strCuartoNivel = $objInventario->strCodigoInterno;
								$objCuenta->strDescripcion = $strDescripcion;
								$objCuenta->strNaturaleza = NULL;
								$objCuenta->strTipoCuenta = NULL;
								$objCuenta->strAceptaMovimientos = 'SI';
								$objCuenta->strMovimientosBancarios  = 'NO';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'INVENTARIO');
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];

								//Asignar costo de la cuenta contable
								$intCostoCta = $this->get_costo($arrAuxiliar['cuenta_id'], $otdFra->fecha);

								//Si el id del inventario es 1
								/*if ($arrDet->entrada_id == 1)
								{
									$arrDet->costo = $arrDet->costo + $intCostoCta;
								}
								else
								{
									
									$arrDet->costo = $intCostoCta;
									
								//}*/

								//Si existe costo de la cuenta contable (cargos y abonos)
								//Nota: se hace de esta manera porque a veces no existen costos
								if($intCostoCta > 0)
								{
									//Si se cumpla la sentencia
									if($intCostoCta <> $arrDet->costo)
									{
										//Incrementar costo
										$arrDet->costo = $arrDet->costo + $intCostoCta;
									}
									else
									{
										//Asignar costo de la cuenta contable
								 		$arrDet->costo = $intCostoCta;
									}
								}

								$arrAuxiliar['importe'] = number_format($arrDet->costo, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'CARGO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

							}
							else
						    {
						    	//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																 '.$strModulo.' (módulo).';
								$this->ARR_DATOS['strError'] .= '<br>';
						    }

							//Incrementar acumulados
							$numSubtotal = $arrDet->precio;
							$numIVA = $arrDet->IVA;
							$numCosto += $arrDet->costo;
							
							$strConcepto = 'DIARIO POR ENTRADA POR DEVOLUCION DE CLIENTE DE ';
							$strConcepto .= $strModulo.' '.$arrDet->condiciones_pago;
							$strModulo = $strModulo;
							$strCodigo = $arrDet->codigo;
							$strCliente = $arrDet->razon_social;
							$strCondiciones = $arrDet->condiciones_pago;
							

						}//Cierre de foreach

					}//Cierre de verificación de detalles


					/****Costo***/
				    //Datos del costo
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->strPrimerNivel = '501';
					$objCuenta->strSegundoNivel = '01';
					$objCuenta->strTercerNivel = $strCuentaContable;

					//Dependiendo del módulo asignar cuenta
					if ($strModulo == 'MAQUINARIA AGRICOLA')
					{
						$objCuenta->strCuartoNivel = '01000';
					}
					else
					{
						$objCuenta->strCuartoNivel = '04000';
					}
					//Hacer un llamado a la función para obtener los datos de la cuenta
					$arrCuenta = $this->get_cuenta($objCuenta);
					$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					$arrAuxiliar['importe'] = number_format($numCosto, 5, '.', '');
					$arrAuxiliar['naturaleza'] = 'ABONO';
					$arrAuxiliar['referencia'] = '';
					$arrAuxiliar['concepto'] = '';
					//Si existe id de la cuenta
					if ($arrAuxiliar['cuenta_id'] > 0)
					{
						//Agregar datos al array
						array_push($arrDetalles, $arrAuxiliar);
						//Incrementar renglón
						$intRenglon++;
					}


					/****Devoluciones***/
					 //Datos de la devolución
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->strPrimerNivel = '402';
					$objCuenta->strSegundoNivel = $strCuentaContable;
					//Si existe importe de IVA
					if ($numIVA > 0)
					{
						$objCuenta->strTercerNivel = '01';
					}
					else
					{
						$objCuenta->strTercerNivel = '02';
					}


					//Dependiendo del módulo asignar cuenta
					if ($strModulo == 'MAQUINARIA AGRICOLA')
					{
						$objCuenta->strCuartoNivel = '01000';
					}
					else
					{
						$objCuenta->strCuartoNivel = '04000';
					}

					//Hacer un llamado a la función para obtener los datos de la cuenta
					$arrCuenta = $this->get_cuenta($objCuenta);
					$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					$arrAuxiliar['importe'] = number_format($numSubtotal, 5, '.', '');
					$arrAuxiliar['naturaleza'] = 'CARGO';
					$arrAuxiliar['referencia'] = '';
					$arrAuxiliar['concepto'] = '';
					//Si existe id de la cuenta
					if ($arrAuxiliar['cuenta_id'] > 0)
					{
						//Agregar datos al array
						array_push($arrDetalles, $arrAuxiliar);
						//Incrementar renglón
						$intRenglon++;
					}


					//Si existe importe de IVA
					if ($numIVA > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '209';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numIVA, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}


					/****Clientes***/
					 //Datos del cliente
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->intCuentaPadreID = NULL;
					$objCuenta->intSatCuentaID = NULL;
					$objCuenta->strPrimerNivel = '105';
					$objCuenta->strSegundoNivel = $strCuentaContable;
					$objCuenta->strCuartoNivel = $strCodigo;
					$objCuenta->strDescripcion = $strCliente;
					$objCuenta->strNaturaleza = NULL;
					$objCuenta->strTipoCuenta = NULL;
					$objCuenta->strAceptaMovimientos = 'SI';
					$objCuenta->strMovimientosBancarios  = 'NO';
					//Dependiendo del módulo asignar cuenta
					if ($strModulo == 'MAQUINARIA AGRICOLA')
					{
						//Si existe importe de IVA
						if ($numIVA > 0)
						{
							$objCuenta->strTercerNivel = '01';
						}
						else
						{
							$objCuenta->strTercerNivel = '02';
						}
					}
					else
					{
						//Si existe importe de IVA
						if ($numIVA > 0)
						{
							$objCuenta->strTercerNivel = '07';
						}
						else
						{
							$objCuenta->strTercerNivel = '08';
						}
					}
					//Hacer un llamado a la función para obtener los datos de la cuenta
					$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
					$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					$arrAuxiliar['importe'] = number_format(($numSubtotal + $numIVA), 5, '.', '');
					$arrAuxiliar['naturaleza'] = 'ABONO';
					$arrAuxiliar['referencia'] = '';
					$arrAuxiliar['concepto'] = '';
					//Si existe id de la cuenta
					if ($arrAuxiliar['cuenta_id'] > 0)
					{
						//Agregar datos al array
						array_push($arrDetalles, $arrAuxiliar);
						//Incrementar renglón
						$intRenglon++;
					}
				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}
			else if ($intTipoMovimiento == SALIDA_MAQUINARIA_DEVOLUCION_PROVEEDOR)//Salidas de maquinaria por devolución al proveedor
			{
				
				//Variable que se utiliza para acumular el subtotal
				$numSubtotal = 0;
				//Variable que se utiliza para acumular el importe de IVA
				$numIVA = 0;
				//Variables que se utilizan para asignar los datos del proveedor
				$strModulo = '';
				$intModuloID = 0;
				$strCodigo = '';
				$strProveedor = '';
				$strTipoProveedor = '';
				$strConsignacion = 'NO';
				$arrInventario = array();

				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);
				
				//Si hay información de la cuenta contable
				if($otdConfContable)
				{

					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Asignar valores del detalle
							$intModuloID =  $arrDet->modulo_id;
							$strModulo = '';
							//Array que se utiliza para asignar los datos de la cuenta del departamento
							$arrModulo = NULL;

							//Concatenar datos para realizar la búsqueda del departamento
							$strCriteriosBusq = $intModuloID.'|MAQUINARIA';
							//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
							$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

							//Si existen datos del departamento (cuenta del módulo)
							if($otdConfDepto)
							{	

								//Asignar cuenta del departamento
								$strCuentaDepto =  $otdConfDepto->cuenta;
								//Separar cuenta del departamento
								$arrModulo = explode("|", $strCuentaDepto);
								$strModulo = $arrModulo[1];
								
							}
							else
						    {
						    	//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																 '.$strModulo.' (módulo).';
								$this->ARR_DATOS['strError'] .= '<br>';
						    }


						    //Si existe motor
							if ($arrDet->motor != '')
							{
								$strDescripcion = $arrDet->descripcion_corta;
								$strDescripcion .= ' NS.: '.$arrDet->serie.'-'.$arrDet->motor;
							}
							else
							{
								$strDescripcion = $arrDet->descripcion_corta;
								$strDescripcion .= ' NS.: '.$arrDet->serie;
							}

							/****Inventario***/
							//Crear un objeto vacio, stdClass es el objeto Inventario
							$objInventario = new stdClass();
							$objInventario->intSucursalID = $otdFra->sucursal_id;
							$objInventario->intMaquinariaDescripcionID = $arrDet->maquinaria_descripcion_id;
							$objInventario->strSerie = $arrDet->serie;
							$objInventario->strConsignacion = $arrDet->consignacion;
							$objInventario->intCosto = $arrDet->precio_unitario;

							//Si no existe código interno
						    if ($arrDet->codigo_interno == '')
							{
								//Asignar código interno consecutivo
							     $objInventario->strCodigoInterno = $this->inventario_maquinaria->get_codigo_interno($arrDet->consignacion);
										
								//Hacer un llamado a la función para modificar los datos del inventario en la BD
								$this->modificar_inventario_maquinaria($objInventario, 'SALIDA');
							}
							else
							{
								$objInventario->strCodigoInterno = $arrDet->codigo_interno;
							}


							//Si existe consignación
							if ($arrDet->consignacion == 'SI')
							{
								
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->intCuentaPadreID = NULL;
								$objCuenta->intSatCuentaID = NULL;
								$objCuenta->strPrimerNivel = '814';
								$objCuenta->strSegundoNivel = '01';
								$objCuenta->strTercerNivel = $strCuentaContable;
								$objCuenta->strCuartoNivel = $objInventario->strCodigoInterno;
								$objCuenta->strDescripcion = $strDescripcion;
								$objCuenta->strNaturaleza = NULL;
								$objCuenta->strTipoCuenta = NULL;
								$objCuenta->strAceptaMovimientos = 'SI';
								$objCuenta->strMovimientosBancarios  = 'NO';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CONSIGNACION');
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format(($arrDet->precio_unitario + $arrDet->iva_unitario), 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{   
									//Agregar datos al array
									array_push($arrInventario, $arrAuxiliar);
								}
							}
							else
							{

								//Si existen datos de la cuenta de línea de maquinaria
								if($arrModulo != NULL)
								{
									//Datos del inventario 
									//Crear un objeto vacio, stdClass es el objeto Cuenta
									$objCuenta = new stdClass();
									$objCuenta->intCuentaPadreID = NULL;
									$objCuenta->intSatCuentaID = NULL;
									$objCuenta->strPrimerNivel = '115';
									$objCuenta->strSegundoNivel = $strCuentaContable;
									$objCuenta->strTercerNivel = $arrModulo[0];
									$objCuenta->strCuartoNivel = $objInventario->strCodigoInterno;
									$objCuenta->strDescripcion = $strDescripcion;
									$objCuenta->strNaturaleza = NULL;
									$objCuenta->strTipoCuenta = NULL;
									$objCuenta->strAceptaMovimientos = 'SI';
									$objCuenta->strMovimientosBancarios  = 'NO';
									//Hacer un llamado a la función para obtener los datos de la cuenta
									$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'INVENTARIO');
									$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
									$arrAuxiliar['importe'] = number_format($arrDet->precio_unitario, 5, '.', '');
									$arrAuxiliar['naturaleza'] = 'ABONO';
									$arrAuxiliar['referencia'] = '';
									$arrAuxiliar['concepto'] = '';
									//Si existe id de la cuenta
									if ($arrAuxiliar['cuenta_id'] > 0)
									{
										//Agregar datos al array
										array_push($arrInventario, $arrAuxiliar);
									}
								}
							}

							$strConcepto = 'DIARIO POR DEVOLUCION DE '.$strModulo;
							
							//Si existe factura
							if ($arrDet->factura != '')
							{
								$strConcepto.= ' DE LA FACTURA '.$arrDet->factura;
							}


							$strConcepto.= ' DE '.$arrDet->razon_social;

							//Incrementar acumulados
							$numSubtotal += $arrDet->precio_unitario;
							$numIVA += $arrDet->iva_unitario;
							
							$strModulo = $strModulo;
							$strCodigo = $arrDet->codigo;
							$strProveedor = $arrDet->razon_social;
							$strTipoProveedor = $arrDet->tipo_proveedor;
							$strConsignacion = $arrDet->consignacion;


						}//Cierre de foreach

					}//Cierre de verificación de detalles


					//Si existe consignación
					if ($strConsignacion == 'SI')
					{
						//Datos del proveedor
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '814';
						$objCuenta->strSegundoNivel = '02';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = $strCodigo;
						$objCuenta->strDescripcion = $strProveedor;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CONSIGNACION');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format(($numSubtotal + $numIVA), 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;


						}

					}
					else
					{
						//Datos del proveedor
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '201';
						$objCuenta->strSegundoNivel = NULL;
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = NULL;
						$objCuenta->strDescripcion = $strProveedor;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';



						//Si el proveedor es nacional
						if ($strTipoProveedor == 'NACIONAL')
						{
							$objCuenta->strSegundoNivel = '01';
							//Dependiendo del módulo asignar cuenta
							if ($strModulo == 'MAQUINARIA AGRICOLA')
							{
								$objCuenta->strCuartoNivel = $MonMaq[$otdFra->Moneda].substr($strCodigo, 1);
							}
							else
							{
								$objCuenta->strCuartoNivel = $MonCon[$otdFra->Moneda].substr($strCodigo, 1);
							}
						}
						else
						{
							$objCuenta->strSegundoNivel = '02';
							//Dependiendo del módulo asignar cuenta
							if ($strModulo == 'MAQUINARIA AGRICOLA')
							{
								$objCuenta->strCuartoNivel = '1'.substr($strCodigo, 1);
							}
							else
							{
								$objCuenta->strCuartoNivel = '4'.substr($strCodigo, 1);
							}
						}
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'PROVEEDOR');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format(($numSubtotal + $numIVA), 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}

					//Hacer recorrido para obtener cuentas del inventario
					foreach ($arrInventario as $arrInv) 
					{
						//Datos del inventario
						$arrInv['renglon'] = $intRenglon;
						//Agregar datos al array
						array_push($arrDetalles, $arrInv);
						//Incrementar renglón
						$intRenglon++;

					}

					//Si existe importe de IVA
					if ($numIVA > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '119';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numIVA, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}
				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}


			}
			else if ($intTipoMovimiento == SALIDA_MAQUINARIA_INTERNA) //Salidas de maquinaria por consumo interno
			{

				//Variable que se utiliza para acumular el subtotal
				$numSubtotal = 0;
				//Variable que se utiliza para acumular el importe de IVA
				$numIVA = 0;
				//Variables que se utilizan para asignar los datos del proveedor
				$strModulo = '';
				$intModuloID = 0;
				$strCodigo = '';
				$strProveedor = '';
				$strTipoProveedor = '';
				$strConsignacion = 'NO';

				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

				//Si hay información de la cuenta contable
				if($otdConfContable)
				{

					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;


					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Asignar valores del detalle
							$intModuloID =  $arrDet->modulo_id;
							$strModulo = '';
							//Array que se utiliza para asignar los datos de la cuenta del departamento
							$arrModulo = NULL;

							//Concatenar datos para realizar la búsqueda del departamento
							$strCriteriosBusq = $intModuloID.'|MAQUINARIA';
							//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
							$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

						    //Si existen datos del departamento (cuenta del módulo)
							if($otdConfDepto)
							{

								//Asignar cuenta del departamento
								$strCuentaDepto =  $otdConfDepto->cuenta;
								//Separar cuenta del departamento
								$arrModulo = explode("|", $strCuentaDepto);
								$strModulo = $arrModulo[1];

								//Si existe motor
								if ($arrDet->motor != '')
								{
									$strDescripcion = $arrDet->descripcion_corta;
									$strDescripcion .= ' NS.: '.$arrDet->serie.'-'.$arrDet->motor;
								}
								else
								{
									$strDescripcion = $arrDet->descripcion_corta;
									$strDescripcion .= ' NS.: '.$arrDet->serie;
								}

								/****Inventario***/
								//Crear un objeto vacio, stdClass es el objeto Inventario
								$objInventario = new stdClass();
								$objInventario->intSucursalID = $otdFra->sucursal_id;
								$objInventario->intMaquinariaDescripcionID = $arrDet->maquinaria_descripcion_id;
						        $objInventario->strSerie = $arrDet->serie;
							    $objInventario->strConsignacion = $arrDet->consignacion;
								$objInventario->intCosto = $arrDet->costo;

								//Si no existe código interno
								if ($arrDet->codigo_interno == '')
								{
									//Asignar código interno consecutivo
									$objInventario->strCodigoInterno = $this->inventario_maquinaria->get_codigo_interno($arrDet->consignacion);

									//Hacer un llamado a la función para modificar los datos del inventario en la BD
									$this->modificar_inventario_maquinaria($objInventario, 'SALIDA');

								}
								else
								{
									$objInventario->strCodigoInterno = $arrDet->codigo_interno;
								}


								/****Inventario***/
							    //Datos del inventario
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->intCuentaPadreID = NULL;
								$objCuenta->intSatCuentaID = NULL;
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = $arrModulo[0];
								$objCuenta->strCuartoNivel = $objInventario->strCodigoInterno;
								$objCuenta->strDescripcion = $strDescripcion;
								$objCuenta->strNaturaleza = NULL;
								$objCuenta->strTipoCuenta = NULL;
								$objCuenta->strAceptaMovimientos = 'SI';
								$objCuenta->strMovimientosBancarios  = 'NO';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'INVENTARIO');
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								//Asignar costo de la cuenta contable
								$intCostoCta = $this->get_costo($arrAuxiliar['cuenta_id'], $otdFra->fecha);

								//Si el id del inventario es 1
								/*if ($arrDet->entrada_id == 1)
								{
									$arrDet->costo = $arrDet->costo + $intCostoCta;
								}
								else
								{*/
									//$arrDet->costo =  $intCostoCta;
								//}

								//Si existe costo de la cuenta contable (cargos y abonos)
								//Nota: se hace de esta manera porque a veces no existen costos
								if($intCostoCta > 0)
								{
									//Si se cumpla la sentencia
									if($intCostoCta <> $arrDet->costo)
									{
										//Incrementar costo
										$arrDet->costo = $arrDet->costo + $intCostoCta;
									}
									else
									{
										//Asignar costo de la cuenta contable
								 		$arrDet->costo = $intCostoCta;
									}
								}

								$arrAuxiliar['importe'] = number_format($arrDet->costo, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

								$strConcepto = 'DIARIO POR SALIDA DE '.$strModulo.' POR USO INTERNO';
								$strObservaciones = $arrDet->observaciones;



							}
							else
						    {
						    	//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																 '.$strModulo.' (módulo).';
								$this->ARR_DATOS['strError'] .= '<br>';
						    }	
						}//Cierre de foreach	

					}//Cierre de verificación de detalles
				
				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}
			}
			else if ($intTipoMovimiento == TIPO_SERVICIO_FACTURACION)//Factura de maquinaria
			{
				//Variable que se utiliza para acumular el subtotal
				$numSubtotal = 0;
				//Variable que se utiliza para acumular el importe de IVA
				$numIVA = 0;
				//Variable que se utiliza para acumular el costo 
				$numCosto = 0;
				//Variables que se utilizan para asignar los datos del cliente
				$strModulo = '';
				$strCodigo = '';
				$strCliente = '';
				$strCondiciones = '';
				//Array que se utiliza para agregar los detalles del inventario
				$arrInventario = array();

				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdFra->sucursal_id);

				//Si hay información de la cuenta contable
				if($otdConfContable)
				{

					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;


					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Asignar valores del detalle
							$strCodigo = $arrDet->codigo;
							$strCliente = $arrDet->razon_social;
							$strCondiciones = $arrDet->condiciones_pago;
							$intModuloID =  $arrDet->modulo_id;
							$strModulo = '';
							//Array que se utiliza para asignar los datos de la cuenta del departamento
							$arrModulo = NULL;
							//Concatenar datos para realizar la búsqueda del departamento
							$strCriteriosBusq = $intModuloID.'|MAQUINARIA';
							//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
							$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

							//Si existen datos del departamento (cuenta del módulo)
							if($otdConfDepto)
							{	

								//Asignar cuenta del departamento
								$strCuentaDepto =  $otdConfDepto->cuenta;
								//Separar cuenta del departamento
								$arrModulo = explode("|", $strCuentaDepto);
								$strModulo = $arrModulo[1];

								$strConcepto = 'DIARIO POR VENTA DE '.$strModulo.' '.$arrDet->condiciones_pago;
								
							}
							else
						    {
						    	//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																 '.$strModulo.' (módulo).';
								$this->ARR_DATOS['strError'] .= '<br>';
						    }


							//Si se cumple la sentencia
							if ($arrDet->servicio == 'NO' && $strModulo != '')
							{

								//Si existe motor
								if ($arrDet->motor != '')
								{
									$strDescripcion = $arrDet->descripcion_corta;
									$strDescripcion .= ' NS.: '.$arrDet->serie.'-'.$arrDet->motor;
								}
								else
								{
									$strDescripcion = $arrDet->descripcion_corta.' NS.: '.$arrDet->serie;
								}

								/****Inventario***/
								//Crear un objeto vacio, stdClass es el objeto Inventario
								$objInventario = new stdClass();
								$objInventario->intSucursalID = $otdFra->sucursal_id;
								$objInventario->intMaquinariaDescripcionID = $arrDet->maquinaria_descripcion_id;
								$objInventario->strSerie = $arrDet->serie;
								$objInventario->strConsignacion = $arrDet->consignacion;
								$objInventario->intCosto = $arrDet->costo;

								
								//Si no existe código interno
								if ($arrDet->codigo_interno == '')
								{

									//Asignar código interno consecutivo
									$objInventario->strCodigoInterno = $this->inventario_maquinaria->get_codigo_interno($arrDet->consignacion);

									//Hacer un llamado a la función para modificar los datos del inventario en la BD
									$this->modificar_inventario_maquinaria($objInventario, 'FACTURA');
								}
								else
								{
									$objInventario->strCodigoInterno = $arrDet->codigo_interno;
								}

							

								/****Cuenta de Inventario***/
								//Datos de la cuenta de inventario
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->intCuentaPadreID = NULL;
								$objCuenta->intSatCuentaID = NULL;
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = $arrModulo[0];
								$objCuenta->strCuartoNivel = $objInventario->strCodigoInterno;
								$objCuenta->strDescripcion = $strDescripcion;
								$objCuenta->strNaturaleza = NULL;
								$objCuenta->strTipoCuenta = NULL;
								$objCuenta->strAceptaMovimientos = 'SI';
								$objCuenta->strMovimientosBancarios  = 'NO';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'INVENTARIO');
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];

							
								//Asignar costo de la cuenta contable
								$intCostoCta = $this->get_costo($arrAuxiliar['cuenta_id'], $otdFra->fecha);

								//Si el id del inventario es 1
								/*if ($arrDet->entrada_id == 1)
								{
										
									//Incrementar costo
									$arrDet->costo = $arrDet->costo + $intCostoCta;

								}
								else
								{
									$arrDet->costo = $intCostoCta;
								}*/

								//Si existe costo de la cuenta contable (cargos y abonos)
								//Nota: se hace de esta manera porque en la factura: M000003143 con serie S507523M
								//no existen cargos ni abonos de la cuenta contable
								if($intCostoCta > 0)
								{
									//Si se cumple la sentencia
									if($intCostoCta <> $arrDet->costo)
									{
										//Incrementar costo
										$arrDet->costo = $arrDet->costo + $intCostoCta;
									}
									else
									{
										//Asignar costo de la cuenta contable
								 		$arrDet->costo = $intCostoCta;
									}
									
								}
								

								$arrAuxiliar['importe'] = number_format($arrDet->costo, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrInventario, $arrAuxiliar);
								}

							}
							else
							{	

								//Dependiendo del código de maquinaria asignar concepto
								if ($arrDet->CodDes == 'TRASLADO/MAQAGRIC')
								{
									$strConcepto = 'DIARIO POR FACTURA SERVICIOS DE LOGISTICA POR ENTREGA DE EQUIPO AGRICOLA ';
									$strConcepto .= $arrDet->condiciones_pago;
									$strModulo = 'MAQUINARIA AGRICOLA';
								}
								else if ($arrDet->CodDes == 'TRASLADO/MAQCONST')
								{
									$strConcepto = 'DIARIO POR FACTURA SERVICIOS DE LOGISTICA POR ENTREGA DE EQUIPO CONSTRUCCION ';
									$strConcepto .= $arrDet->condiciones_pago;
									$strModulo = 'EQUIPO INDUSTRIAL O CONSTRUCCION';
								}
							}

							//Incrementar acumulados
							$numSubtotal = $arrDet->precio;
							$numIVA = $arrDet->IVA;
							$numCosto += $arrDet->costo;
							

						}//Cierre de foreach

					}//Cierre de verificación de detalles


					//Datos del cliente
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->intCuentaPadreID = NULL;
					$objCuenta->intSatCuentaID = NULL;
					$objCuenta->strPrimerNivel = '105';
					$objCuenta->strSegundoNivel = $strCuentaContable;
					$objCuenta->strCuartoNivel = $strCodigo;
					$objCuenta->strDescripcion = $strCliente;
					$objCuenta->strNaturaleza = NULL;
					$objCuenta->strTipoCuenta = NULL;
					$objCuenta->strAceptaMovimientos = 'SI';
					$objCuenta->strMovimientosBancarios = 'NO';
					//Dependiendo del módulo asignar cuenta
					if ($strModulo == 'MAQUINARIA AGRICOLA')
					{
						//Si existe importe de IVA
						if ($numIVA > 0)
						{
							$objCuenta->strTercerNivel = '01';
						}
						else
						{
							$objCuenta->strTercerNivel = '02';
						}
					}
					else
					{
						//Si existe importe de IVA
						if ($numIVA > 0)
						{
							$objCuenta->strTercerNivel = '07';
						}
						else
						{
							$objCuenta->strTercerNivel = '08';
						}
					}

					//Hacer un llamado a la función para obtener los datos de la cuenta 
					$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
					$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					$arrAuxiliar['importe'] = number_format(($numSubtotal + $numIVA), 5, '.', '');
					$arrAuxiliar['naturaleza'] = 'CARGO';
					$arrAuxiliar['referencia'] = '';
					$arrAuxiliar['concepto'] = '';
					//Si existe id de la cuenta
					if ($arrAuxiliar['cuenta_id'] > 0)
					{
						//Agregar datos al array
						array_push($arrDetalles, $arrAuxiliar);
						//Incrementar renglón
						$intRenglon++;
					}

					//Datos de la venta
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->strPrimerNivel = '401';
					$objCuenta->strSegundoNivel = $strCuentaContable;

					//Dependiendo de las condiciones de pago asignar cuenta
					if ($strCondiciones == 'CONTADO')
					{
						//Si existe importe de IVA
						if ($numIVA > 0)
						{
							$objCuenta->strTercerNivel = '02';
						}
						else
						{
							$objCuenta->strTercerNivel = '05';
						}
					}
					else
					{
						//Si existe importe de IVA
						if ($numIVA > 0)
						{
							$objCuenta->strTercerNivel = '03';
						}
						else
						{
							$objCuenta->strTercerNivel = '06';
						}
					}


					//Dependiendo del módulo asignar cuenta
					if ($strModulo == 'MAQUINARIA AGRICOLA')
					{
						$objCuenta->strCuartoNivel = '01000';
					}
					else
					{
						$objCuenta->strCuartoNivel = '04000';
					}
					//Hacer un llamado a la función para obtener los datos de la cuenta
					$arrCuenta = $this->get_cuenta($objCuenta);
					$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					$arrAuxiliar['importe'] = number_format($numSubtotal, 5, '.', '');
					$arrAuxiliar['naturaleza'] = 'ABONO';
					$arrAuxiliar['referencia'] = '';
					$arrAuxiliar['concepto'] = '';
					//Si existe id de la cuenta
					if ($arrAuxiliar['cuenta_id'] > 0)
					{
						//Agregar datos al array
						array_push($arrDetalles, $arrAuxiliar);
						//Incrementar renglón
						$intRenglon++;
					}

					//Si existe importe de IVA
					if ($numIVA > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '209';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numIVA, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}


					//Si existe importe del costo
					if ($numCosto > 0)
					{

						//Datos del costo
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '501';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						//Dependiendo del módulo asignar cuenta
						if ($strModulo == 'MAQUINARIA AGRICOLA')
						{
							$objCuenta->strCuartoNivel = '01000';
						}
						else
						{
							$objCuenta->strCuartoNivel = '04000';
						}
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numCosto, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

						//Hacer recorrido para obtener los datos del inventario
						foreach ($arrInventario as $arrInv) 
						{
							$arrInv['renglon'] = $intRenglon;
							//Agregar datos al array
							array_push($arrDetalles, $arrInv);
							//Incrementar renglón
							$intRenglon++;
						}
					}

				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}	
				
			}//Cierre de la verificación del tipo de movimiento


			//Concatenar datos para realizar la búsqueda del proceso
			$strCriteriosBusq = $intTipoMovimiento.'|MAQUINARIA';

			//Hacer un llamado al método para comprobar la existencia de la configuración del proceso
			$otdConfProceso = $this->config_polizas->buscar_configuracion_procesos(NULL, $strCriteriosBusq);

			//Si existen datos del proceso
			if($otdConfProceso)
			{
				//Asignar datos de la póliza
				$objPoliza->intSucursalID =  $otdFra->sucursal_id;
				$objPoliza->strTipo = 'DIARIO';
				$objPoliza->strModulo = 'MAQUINARIA';
				$objPoliza->strProceso = $otdConfProceso->proceso;
				$objPoliza->intReferenciaID = $otdFra->referencia_id;
				$objPoliza->dteFecha = $otdFra->fecha;
				$objPoliza->strConcepto = $strConcepto;
				$objPoliza->strObservaciones = $strObservaciones;
				$objPoliza->strEstatus = 'ACTIVO';
				$objPoliza->arrDetalles = $arrDetalles;

				//Hacer un llamado a la función para guardar los datos de la póliza en la BD
				$this->guardar_poliza_referencia($objPoliza, $intProcesoMenuID);
			}
			else
			{
				//Asignar mensaje de error
				$this->ARR_DATOS['strError'] .= 'No existe configuración del proceso para 
												 el tipo de movimiento.';
				$this->ARR_DATOS['strError'] .= '<br>';
			}


		}
		else
		{
			//Indicar mensaje de error (no se genera la póliza porque no se cumplen con las restricciones / no existe información del registro)
			$this->ARR_DATOS['strError'] = MSJ_ERROR_POLIZA;
		}
	}


	//Método para generar una póliza con los datos de los movimientos de refacciones internas del módulo control de vehículos (parque vehícular).
	public function get_poliza_refacciones_internas($intReferenciaID, $strTipoReferencia, $intProcesoMenuID)
	{
		//------------------------------------------------------------------------------------------------------------------------
		//---------- DATOS DE LA REFERENCIA 
		//------------------------------------------------------------------------------------------------------------------------
       	//Seleccionar datos del registro
       	$otdMov = $this->mov_refacciones_internas->buscar_referencia_poliza($intReferenciaID, $strTipoReferencia);

       
       	//Verificar si hay información del registro
		if($otdMov)
		{
			//Asignar el folio de la referencia (movimiento/trabajo foráneo)
			$this->ARR_DATOS['strFolioReferencia'] = $otdMov->folio;
			//Crear un objeto vacio, stdClass es el objeto Póliza
			$objPoliza = new stdClass();
			//Array que se utiliza para agregar los detalles de la póliza 
			$arrDetalles = array();
			//Array que se utiliza para agregar los datos de un detalle
			$arrAuxiliar = array();
			//Variables que se utilizan para asignar datos de la póliza
			$strConcepto = '';
			$strObservaciones = '';
			//Variables que se utilizan para asignar datos del detalle
			$intRenglon = 1;
			//Asignar el id del tipo de movimiento
			$intTipoMovimiento = $otdMov->tipo_movimiento;
			//Constante para identificar los datos del SAT correspondientes al IVA 16%
			$intTasaCuotaIDIva = SAT_TASA_CUOTA_IVA_ID;
			//Constante para identificar los datos del SAT correspondientes al IVA cero
			$intTasaCuotaIDIvaCero = SAT_TASA_CUOTA_IVA_CERO_ID;


			

			//------------------------------------------------------------------------------------------------------------------------
			//---------- DETALLES DE LA REFERENCIA 
			//------------------------------------------------------------------------------------------------------------------------
			//Seleccionar los detalles del registro
		    $otdDetalles = $this->mov_refacciones_internas->buscar_detalles_poliza($intReferenciaID, 	
		    																   	   $intTipoMovimiento);

		    //------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL REGISTRO 
	        //------------------------------------------------------------------------------------------------------------------------
		    //Dependiendo del tipo de movimiento generar póliza
		    if($intTipoMovimiento == ENTRADA_REFACCIONES_INTERNAS_TRASPASO) //Entradas de refacciones internas por traspaso almacén general
			{

				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
			    $otdConfContable = $this->config_contable->buscar($otdMov->sucursal_id);

			    //Si hay información de la cuenta contable
				if($otdConfContable)
				{
				
					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{

							//Asignar valores del detalle
							$strConcepto = 'DIARIO POR TRASPASO REFACCIONES A ALMACEN REFACCIONES PARQUE VEHICULAR DE ALMACEN GENERAL REFACCIONES';

							/****Inventario parque vehicular***/
							//Datos del inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '07';
							$objCuenta->strCuartoNivel = '01100';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

							/****Inventario de origen***/
							//Datos del inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '02';
							$objCuenta->strCuartoNivel = '00000';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}


						}//Cierre de foreach

					}//Cierre de verificación de detalles

				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}
			else if($intTipoMovimiento == ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER)//Entradas de refacciones internas por devolución de taller
			{

				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
			    $otdConfContable = $this->config_contable->buscar($otdMov->sucursal_id);

			    //Si hay información de la cuenta contable
				if($otdConfContable)
				{
				
					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Asignar valores del detalle
							$strConcepto = 'DIARIO POR ENTRADA DE REFACCIONES DE ORDEN DE TRABAJO PARQUE VEHICULAR FOLIO '.$arrDet->OrdRep;

							/****Inventario de refacciones***/
							//Datos del inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '07';
							$objCuenta->strCuartoNivel = '01100';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

							/****Inventario de taller***/
							//Datos del inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '07';
							$objCuenta->strCuartoNivel = '01200';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de foreach

					}//Cierre de verificación de detalles

				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}
			else if($intTipoMovimiento == SALIDA_REFACCIONES_INTERNAS)//Salidas de refacciones internas por taller
			{
				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
			    $otdConfContable = $this->config_contable->buscar($otdMov->sucursal_id);

			    //Si hay información de la cuenta contable
				if($otdConfContable)
				{
					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{	
							//Asignar valores del detalle
							$strConcepto = 'DIARIO POR SALIDA DE REFACCIONES A ORDEN DE TRABAJO PARQUE VEHICULAR FOLIO '.$arrDet->OrdRep;

							/****Inventario de taller***/
							//Datos del inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '07';
							$objCuenta->strCuartoNivel = '01200';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

							/****Inventario de refacciones***/
							//Datos del inventario
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '115';
							$objCuenta->strSegundoNivel = $strCuentaContable;
							$objCuenta->strTercerNivel = '07';
							$objCuenta->strCuartoNivel = '01100';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}//Cierre de foreach

					}//Cierre de verificación de detalles
				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}
			else if($intTipoMovimiento == SALIDA_REFACCIONES_INTERNAS_CONSUMO_INTERNO)//Salidas de refacciones internas por consumo interno
			{

				

				//Variable que se utiliza para acumular el subtotal
				$numSubtotal = 0;

				//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{	
						//Asignar valores del detalle
						$intModuloID = $arrDet->modulo_id;
						$strTipoGasto = $arrDet->tipo_gasto;
						$strModuloTipoGasto = $arrDet->ModuloTipoGasto;

						$strConcepto = 'DIARIO POR SALIDA DE REFACCIONES POR USO INTERNO PARQUE VEHICULAR';

						//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal del gasto
			    		$otdConfContable = $this->config_contable->buscar($arrDet->sucursal_id);

			    		//Variable que se utiliza para asignar la cuenta contable
			    		$strCuentaContable = '';
			    		
			    		//Si hay información de la cuenta contable
						if($otdConfContable)
						{	
							//Asignar cuenta contable
							$strCuentaContable =  $otdConfContable->cuenta_contable;
						}



						/****Gastos***/
						//Datos de gastos
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
					    $objCuenta = new stdClass();
						$objCuenta->strSegundoNivel = NULL;


						//Dependiendo del tipo de gasto asignar cuenta
						if ($strTipoGasto == 'GASTOS DE VENTA')
						{
							//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
						    $otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, $intModuloID);

						    //Si existen datos del departamento (cuenta del módulo)
							if($otdConfModulo)
							{
								$objCuenta->strPrimerNivel = '602';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = $otdConfModulo->cuenta;
							}
							else
						    {
						    	//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo:  
																  '.$strModuloTipoGasto;
								$this->ARR_DATOS['strError'] .= '<br>';
						    }
						}
						else if ($strTipoGasto == 'GASTOS DE ADMINISTRACION')
						{
							$objCuenta->strPrimerNivel = '603';
							$objCuenta->strSegundoNivel = $strCuentaContable;;
							$objCuenta->strTercerNivel = '00';
						}
						else
						{
							$objCuenta->strPrimerNivel = '603';
							$objCuenta->strSegundoNivel = '10';
							$objCuenta->strTercerNivel = '00';
						}

						
						//Si existe segundo nivel de la cuenta
						if($objCuenta->strSegundoNivel != NULL)
						{
							
							$objCuenta->strCuartoNivel = $arrDet->prefijo.'001';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrDet->Subtotal, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';


							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}



						}
						else
						{
							//Asignar mensaje de error
					 		$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la sucursal del gasto.';
					 		$this->ARR_DATOS['strError'] .= '<br>';
						}

							
						//Incrementar acumulado
						$numSubtotal += $arrDet->Subtotal;


					}//Cierre de foreach

				}//Cierre de verificación de detalles


				
				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
			    $otdConfContable = $this->config_contable->buscar($otdMov->sucursal_id);

			    //Si hay información de la cuenta contable
				if($otdConfContable)
				{
					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					/****Inventario de refacciones***/
				    //Datos del inventario
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->strPrimerNivel = '115';
					$objCuenta->strSegundoNivel = $strCuentaContable;
					$objCuenta->strTercerNivel = '07';
					$objCuenta->strCuartoNivel = '01100';
					//Hacer un llamado a la función para obtener los datos de la cuenta
					$arrCuenta = $this->get_cuenta($objCuenta);
					$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					$arrAuxiliar['importe'] = number_format($numSubtotal, 5, '.', '');
					$arrAuxiliar['naturaleza'] = 'ABONO';
					$arrAuxiliar['referencia'] = '';
					$arrAuxiliar['concepto'] = '';
					//Si existe id de la cuenta
					if ($arrAuxiliar['cuenta_id'] > 0)
					{
						//Agregar datos al array
						array_push($arrDetalles, $arrAuxiliar);
						//Incrementar renglón
						$intRenglon++;
					}
				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}
			else if ($intTipoMovimiento == TIPO_SERVICIO_FACTURACION)//Trabajo foráneo interno
			{	
				//Variable que se utiliza para acumular el subtotal
				$numSubtotal = 0;
				//Variable que se utiliza para acumular el importe de IVA
				$numIVA = 0;
				//Variable que se utiliza para acumular el importe de IEPS
				$numIEPS = 0;
				//Variables que se utilizan para asignar los datos del proveedor
				$strModulo = '';
				$intModuloID = 0;
				$strCodigo = '';
				$strProveedor = '';
				$strTipoProveedor = '';
				$strCtaMoneda = '';
				$strCodigoMoneda = '';
				//Array que se utiliza para asignar los datos de las tasas de IEPS
				$arrIEPS = array();

				//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Asignar valores del detalle
						$strConcepto = 'DIARIO POR TRABAJO SUBCONTRATADO';
						$strConcepto.= ' CON FACTURA '.$arrDet->factura;
						$strConcepto.= ' DE '.$arrDet->razon_social;
						$strCodigo = $arrDet->codigo;
						$strProveedor = $arrDet->razon_social;
						$strTipoProveedor = $arrDet->tipo_proveedor;
						$strCodigoMoneda = $arrDet->Moneda;

						//Hacer un llamado al método para comprobar la existencia de la configuración de la moneda
						$otdConfMoneda = $this->config_polizas->buscar_configuracion_monedas(NULL, $arrDet->moneda_id);
						//Si existen datos de la moneda (cuenta de la moneda)
						if($otdConfMoneda)
						{
							//Asignar cuenta de la moneda
							$strCtaMoneda = $otdConfMoneda->cuenta;
						}



						//Incrementar acumulados
						$numSubtotal += $arrDet->Subtotal;
						$numIVA += $arrDet->IVA;

						//Si la tasa de IEPS corresponde al rango
						if ($arrDet->tasa_cuota_ieps == SAT_TASA_CUOTA_IEPS_RANGO)
						{
							//Incrementar acumulado del subtotal
							$numSubtotal += $arrDet->IEPS;
						}
						else if ($arrDet->IEPS > 0)//Si existe importe de IEPS
						{
							//Incrementar acumulado de IEPS
							$numIEPS += $arrDet->IEPS;

							//Agregar datos al array
							array_push($arrIEPS, array('TasaID' => $arrDet->tasa_cuota_ieps,
													   'TasaIEPS' => $arrDet->TasaIEPS,
													   'Importe' => $arrDet->IEPS));
						}

					}//Cierre de foreach

				}//Cierre de verificación de detalles


				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
			    $otdConfContable = $this->config_contable->buscar($otdMov->sucursal_id);

			    //Si hay información de la cuenta contable
				if($otdConfContable)
				{
					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					/****Inventario foráneos***/
				    //Datos del inventario
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->strPrimerNivel = '115';
					$objCuenta->strSegundoNivel = $strCuentaContable;
					$objCuenta->strTercerNivel = '07';
					$objCuenta->strCuartoNivel = '03000';
					//Hacer un llamado a la función para obtener los datos de la cuenta
					$arrCuenta = $this->get_cuenta($objCuenta);
					$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					$arrAuxiliar['importe'] = number_format($numSubtotal, 5, '.', '');
					$arrAuxiliar['naturaleza'] = 'CARGO';
					$arrAuxiliar['referencia'] = '';
					$arrAuxiliar['concepto'] = '';
					//Si existe id de la cuenta
					if ($arrAuxiliar['cuenta_id'] > 0)
					{
						//Agregar datos al array
						array_push($arrDetalles, $arrAuxiliar);
						//Incrementar renglón
						$intRenglon++;
					}

					//Si existe importe de IVA
					if ($numIVA > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '119';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numIVA, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición del importe de IVA


					//Hacer recorrido para obtener Tasas de IEPS
					foreach($arrIEPS as $objIEPS)
					{

						//Hacer un llamado al método para comprobar la existencia de la configuración del ieps
					   $otdConfIeps = $this->config_polizas->buscar_configuracion_ieps(NULL, $objIEPS['TasaID']);

					   //Si existen datos de la tasa (cuenta de la tasa de IEPS)
						if($otdConfIeps)
						{
							//Datos del IEPS
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '119';
							$objCuenta->strSegundoNivel = '03';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = $otdConfIeps->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($objIEPS['Importe'], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}
						else
					    {
					    	//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la tasa de IEPS: ';
							$this->ARR_DATOS['strError'] .=  $objIEPS['TasaIEPS'];
							$this->ARR_DATOS['strError'] .= '<br>';
					    }


					}//Cierre de foreach


					//Datos del proveedor
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->intCuentaPadreID = NULL;
					$objCuenta->intSatCuentaID = NULL;
					$objCuenta->strPrimerNivel = '201';
					$objCuenta->strSegundoNivel = NULL;
					$objCuenta->strTercerNivel = $strCuentaContable;
					$objCuenta->strCuartoNivel = NULL;
					$objCuenta->strDescripcion = $strProveedor;
					$objCuenta->strNaturaleza = NULL;
					$objCuenta->strTipoCuenta = NULL;
					$objCuenta->strAceptaMovimientos = 'SI';
					$objCuenta->strMovimientosBancarios  = 'NO';

					//Dependiendo del tipo de proveedor asignar datos de la cuenta
					if ($strTipoProveedor == 'NACIONAL')
					{
						
						//Si existen datos de la moneda (cuenta de la moneda)
						if($strCtaMoneda)
						{
							$objCuenta->strSegundoNivel = '01';
							$objCuenta->strCuartoNivel = $strCtaMoneda.substr($strCodigo, 1);

						}
						else
						{
							//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la moneda: ';
							$this->ARR_DATOS['strError'] .= $strCodigoMoneda;
							$this->ARR_DATOS['strError'] .= '<br>';
						}
					}
					else
					{
						$objCuenta->strSegundoNivel = '02';
						$objCuenta->strCuartoNivel = '3'.substr($strCodigo, 1);
					}

					//Si existe segundo y cuarto nivel de la cuenta
					if($objCuenta->strSegundoNivel != NULL && $objCuenta->strCuartoNivel != NULL)
					{
						//Calcular importe
						$intImporte = ($numSubtotal + $numIVA + $numIEPS);

						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'PROVEEDOR');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}

				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

				
			}//Cierre de verificación del tipo de movimiento


			//Concatenar datos para realizar la búsqueda del proceso
			$strCriteriosBusq = $intTipoMovimiento.'|CONTROL DE VEHICULOS';
			//Hacer un llamado al método para comprobar la existencia de la configuración del proceso
			$otdConfProceso = $this->config_polizas->buscar_configuracion_procesos(NULL, $strCriteriosBusq);

			//Si existen datos del proceso
			if($otdConfProceso)
			{


				//Asignar datos de la póliza
				$objPoliza->intSucursalID =  $otdMov->sucursal_id;
				$objPoliza->strTipo = 'DIARIO';
				$objPoliza->strModulo = 'CONTROL DE VEHICULOS';
				$objPoliza->strProceso = $otdConfProceso->proceso;
				$objPoliza->intReferenciaID = $otdMov->referencia_id;
				$objPoliza->dteFecha = $otdMov->fecha;
				$objPoliza->strConcepto = $strConcepto;
				$objPoliza->strObservaciones = $strObservaciones;
				$objPoliza->strEstatus = 'ACTIVO';
				$objPoliza->arrDetalles = $arrDetalles;

				//Hacer un llamado a la función para guardar los datos de la póliza en la BD
				$this->guardar_poliza_referencia($objPoliza, $intProcesoMenuID);
			}
			else
			{
				//Asignar mensaje de error
				$this->ARR_DATOS['strError'] .= 'No existe configuración del proceso para 
												 el tipo de movimiento.';
				$this->ARR_DATOS['strError'] .= '<br>';
			}



		}
		else
		{
			//Indicar mensaje de error (no se genera la póliza porque no se cumplen con las restricciones / no existe información del registro)
			$this->ARR_DATOS['strError'] = MSJ_ERROR_POLIZA;
		}
	}



	//Método para generar una póliza con los datos de la orden de reparación interna del módulo control de vehículos (parque vehícular).
	public function get_poliza_orden_reparacion_interna($intReferenciaID, $strTipoReferencia, $intProcesoMenuID)
	{
		
		//Array que se utiliza para saber si el tipo de servicio generá póliza
		$arrTiposServicios = array(TIPO_SERVICIO_INTERNO_VEHICULOS, 
								   TIPO_SERVICIO_INTERNO_MAQUINARIA);

		//------------------------------------------------------------------------------------------------------------------------
		//---------- DATOS DE LA REFERENCIA 
		//------------------------------------------------------------------------------------------------------------------------
       	//Seleccionar datos del registro
       	$otdOrden = $this->ordenes_internas->buscar_referencia_poliza($intReferenciaID);
       	
       	//Verificar si hay información del registro
		if($otdOrden)
		{
			//Asignar el folio de la referencia (orden de reparación interna)
			$this->ARR_DATOS['strFolioReferencia'] = $otdOrden->folio;
			
			//Crear un objeto vacio, stdClass es el objeto Póliza
			$objPoliza = new stdClass();
			//Crear instancia del objeto Inventario
			$objInventario = new Inventario();
			//Array que se utiliza para agregar los detalles de la póliza 
			$arrDetalles = array();
			//Array que se utiliza para agregar los datos de un detalle
			$arrAuxiliar = array();
			//Variables que se utilizan para asignar datos de la póliza
			$strConcepto = '';
			$strObservaciones = '';
			//Variables que se utilizan para asignar datos del detalle
			$intRenglon = 1;
			//Variables que se utilizan para indicar si se guardadá la póliza de la orden de reparación
			$strGuardar = 'NO';
			//Asignar el id del tipo de servicio interno
			$intServicioInternoTipoID = $otdOrden->servicio_interno_tipo_id;


			//Si el tipo de servicio se encuentra en el array
			if(in_array($intServicioInternoTipoID, $arrTiposServicios))
			{
				//------------------------------------------------------------------------------------------------------------------------
				//---------- DETALLES DE LA REFERENCIA 
				//------------------------------------------------------------------------------------------------------------------------
				//Seleccionar los detalles del registro
			    $otdDetalles = $this->ordenes_internas->buscar_detalles_poliza($intReferenciaID);


				//------------------------------------------------------------------------------------------------------------------------
		        //---------- DATOS DEL REGISTRO 
		        //------------------------------------------------------------------------------------------------------------------------
			    //Dependiendo del tipo de servicio generar póliza
				if ($intServicioInternoTipoID == TIPO_SERVICIO_INTERNO_VEHICULOS) //Servicio interno vehículos
				{

					//Variable que se utiliza para acumular el costo de refacciones
					$numCostoRefacciones = 0;
					//Variable que se utiliza para acumular el costo de trabajos foráneos
					$numCostoForaneos = 0;

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Asignar valores del detalle
							$strConcepto = 'DIARIO POR SERVICIO VEHICULO '.$otdOrden->marca;
							$strConcepto .= ' NUM '.$otdOrden->codigo;
							$strConcepto .= ' PLACAS '.$otdOrden->placas;

							//Dependiendo del tipo incrementar acumulado del costo
							if ($arrDet->Tipo == 'REFACCIONES')
							{
								$numCostoRefacciones += $arrDet->Costo;
							}
							else if ($arrDet->Tipo == 'FORANEOS')
							{
								$numCostoForaneos += $arrDet->Costo;
							}


						}//Cierre de foreach

					}//Cierre de verificación de detalles

					//Variable que se utiliza para asignar el total de costos
					$numTotalCostos = $numCostoRefacciones + $numCostoForaneos;

					//Si existen costos
					if ($numTotalCostos != 0)
					{

						//Asignar SI para indicar que se guardará la póliza
						$strGuardar = 'SI';
						
						/****Gastos***/
						//Datos de gastos
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						//Definir datos de la cuenta
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;


						//Si existe id de la sucursal del vehículo
						if ($otdOrden->SucVeh > 0)
						{

							//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal del vehículo
				   		   $otdConfContable = $this->config_contable->buscar($otdOrden->SucVeh);


							//Si hay información de la cuenta contable
							if($otdConfContable)
							{
								//Asignar cuenta contable
								$strCuentaContable =  $otdConfContable->cuenta_contable;

								//Si el departamento corresponde a Administración
								if ($otdOrden->departamento_id == DEPTO_ADMINISTRACION)
								{
									$objCuenta->strPrimerNivel = '603';
									$objCuenta->strSegundoNivel = $strCuentaContable;
									$objCuenta->strTercerNivel = '00';
									$objCuenta->strCuartoNivel = '83'.$otdOrden->codigo;
								}
								else
								{

									//Concatenar datos para realizar la búsqueda del departamento
			    					$strCriteriosBusq = $otdOrden->modulo_id.'|VEHICULOS';

									//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
									$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);


									//Si existen datos del departamento (cuenta del módulo)
									if($otdConfDepto)
									{

										$objCuenta->strPrimerNivel = '602';
										$objCuenta->strSegundoNivel = $strCuentaContable;
										$objCuenta->strTercerNivel = $otdConfDepto->cuenta;
										$objCuenta->strCuartoNivel = '85'.$otdOrden->codigo;
									}
									else
								    {
								    	//Asignar mensaje de error
										$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																		(módulo).';
										$this->ARR_DATOS['strError'] .= '<br>';
								    }
									
								}
							}
							else
							{
								//Asignar mensaje de error
						 		$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la sucursal del vehículo.';
						 		$this->ARR_DATOS['strError'] .= '<br>';
							}
						}
						else
						{
							$objCuenta->strPrimerNivel = '603';
							$objCuenta->strSegundoNivel = '10';
							$objCuenta->strTercerNivel = '00';
							$objCuenta->strCuartoNivel = '83'.$otdOrden->codigo;
						}

						$objCuenta->strDescripcion = $otdOrden->marca.' MOD '.$otdOrden->modelo;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';
						//Hacer un llamado a la función para obtener los datos de la cuenta
					    $arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'VEHICULO');
					    $arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					    $arrAuxiliar['importe'] = number_format($numTotalCostos, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}




						//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
					    $otdConfContable = $this->config_contable->buscar($otdOrden->sucursal_id);
						
						//Si hay información de la cuenta contable
						if($otdConfContable)
						{
							//Asignar cuenta contable
							$strCuentaContable =  $otdConfContable->cuenta_contable;

							/****Inventario***/
							//Si existe costo por refacciones
							if ($numCostoRefacciones > 0)
							{

								//Datos del costo de refacciones
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = '07';
								$objCuenta->strCuartoNivel = '01200';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($numCostoRefacciones, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

							}//Cierre de verificación del costo de refacciones (inventario)



							//Si existe costo de trabajos foráneos
							if ($numCostoForaneos > 0)
							{
								//Datos del costo del trabajo foráneo
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = '07';
								$objCuenta->strCuartoNivel = '03000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($numCostoForaneos, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

							}//Cierre de verificación del costo de trabajos foráneos (inventario)

						}
						else
						{
							//Asignar mensaje de error
					 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
					 		$this->ARR_DATOS['strError'] .= '<br>';
						}

					}//Cierre de verificación del total de costos
				   
				}
				else if ($intServicioInternoTipoID == TIPO_SERVICIO_INTERNO_MAQUINARIA) //Servicio interno maquinaria
				{
					//Variable que se utiliza para acumular el costo de refacciones
					$numCostoRefacciones = 0;
					//Variable que se utiliza para acumular el costo de trabajos foráneos
					$numCostoForaneos = 0;
					//Array que se utiliza para asignar los datos de la cuenta del departamento
					$arrModulo = NULL;

					//Verificar si existe información de los detalles 
					if ($otdDetalles) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Dependiendo del tipo incrementar acumulado del costo
							if ($arrDet->Tipo == 'REFACCIONES')
							{
								$numCostoRefacciones += $arrDet->Costo;
							}
							else if ($arrDet->Tipo == 'FORANEOS')
							{
								$numCostoForaneos += $arrDet->Costo;
							}

						}//Cierre de foreach

					}//Cierre de verificación de detalles


					//Variable que se utiliza para asignar el total de costos
					$numTotalCostos = $numCostoRefacciones + $numCostoForaneos;

					//Si existen costos
					if ($numTotalCostos != 0)
					{
						//Asignar SI para indicar que se guardará la póliza
						$strGuardar = 'SI';
						//Hacer un llamado a la función para obtener los datos del rastreo
						$arrRastreo = $this->get_rastreo_orden($otdOrden->serie, 
															   $otdOrden->fecha, 
															   $otdOrden->sucursal_id);

						

						//Concatenar datos para realizar la búsqueda del departamento
    					$strCriteriosBusq = $arrRastreo['modulo'].'|MAQUINARIA';
						//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
						$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

						//Si existen datos del departamento (cuenta de línea de maquinaria)
						if($otdConfDepto)
						{
							//Obtener los datos de la cuenta
							$arrModulo = explode("|", $otdConfDepto->cuenta);
						}


						

						//Si existe motor
						if ($arrRastreo['motor'] != '')
						{
							$strDescripcion = $arrRastreo['descripcion_corta'];
							$strDescripcion .=	' NS.: '.$arrRastreo['serie'].'-'.$arrRastreo['motor'];
						}
						else
						{
							$strDescripcion = $arrRastreo['descripcion_corta'].' NS.: '.$arrRastreo['serie'];
						}

						//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
						$otdConfContable = $this->config_contable->buscar($otdOrden->sucursal_id);

						//Si hay información de la cuenta contable
						if($otdConfContable)
						{
							//Asignar cuenta contable
							$strCuentaContable =  $otdConfContable->cuenta_contable;

							
							//Si no existe consignación
							if ($arrRastreo['consignacion'] == 'NO')
							{
								//Si existen datos de la cuenta de línea de maquinaria
								if($arrModulo != NULL)
								{

									$strConcepto = 'DIARIO POR FINALIZACION DE ORDEN DE TRABAJO INTERNO '.$arrModulo[1];

									

									//Si existe existencia del rastreo
									if ($arrRastreo['existencia'] == 'SI')
									{
										$strConcepto.= ' EN INVENTARIO';

										/***Inventario**/
										//Datos del inventario
										$arrAuxiliar['renglon'] = $intRenglon;
										//Crear un objeto vacio, stdClass es el objeto Cuenta
									   	$objCuenta = new stdClass();
									   	//Definir datos de la cuenta
										$objCuenta->intCuentaPadreID = NULL;
										$objCuenta->intSatCuentaID = NULL;
										$objCuenta->strPrimerNivel = '115';
										$objCuenta->strSegundoNivel = $strCuentaContable;
										$objCuenta->strTercerNivel = $arrModulo[0];
										$objCuenta->strCuartoNivel = $arrRastreo['codigo_interno'];
										$objCuenta->strDescripcion = $strDescripcion;
										$objCuenta->strNaturaleza = NULL;
										$objCuenta->strTipoCuenta = NULL;
										$objCuenta->strAceptaMovimientos = 'SI';
										$objCuenta->strMovimientosBancarios  = 'NO';
										//Hacer un llamado a la función para obtener los datos de la cuenta
										$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'INVENTARIO');
										$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
										$arrAuxiliar['importe'] = number_format($numTotalCostos, 5, '.', '');
										$arrAuxiliar['naturaleza'] = 'CARGO';
										$arrAuxiliar['referencia'] = '';
										$arrAuxiliar['concepto'] = '';
										//Si existe id de la cuenta
										if ($arrAuxiliar['cuenta_id'] > 0)
										{
											//Agregar datos al array
											array_push($arrDetalles, $arrAuxiliar);
											//Incrementar renglón
											$intRenglon++;
										}
									}
									else
									{
										$strConcepto.= ' YA VENDIDA';

										//Datos del costo
										$arrAuxiliar['renglon'] = $intRenglon;
										//Crear un objeto vacio, stdClass es el objeto Cuenta
									   	$objCuenta = new stdClass();
									   	//Definir datos de la cuenta
										$objCuenta->strPrimerNivel = '501';
										$objCuenta->strSegundoNivel = '01';
										$objCuenta->strTercerNivel = $strCuentaContable;
										$objCuenta->strCuartoNivel = $arrModulo[0].'000';
										//Hacer un llamado a la función para obtener los datos de la cuenta
										$arrCuenta = $this->get_cuenta($objCuenta);
										$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
										$arrAuxiliar['importe'] = number_format($numTotalCostos, 5, '.', '');
										$arrAuxiliar['naturaleza'] = 'CARGO';
										$arrAuxiliar['referencia'] = '';
										$arrAuxiliar['concepto'] = '';
										//Si existe id de la cuenta
										if ($arrAuxiliar['cuenta_id'] > 0)
										{
											//Agregar datos al array
											array_push($arrDetalles, $arrAuxiliar);
											//Incrementar renglón
											$intRenglon++;
										}
									}
									
								}
								else
							    {
							    	//Asignar mensaje de error
									$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																	(línea de maquinaria).';
									$this->ARR_DATOS['strError'] .= '<br>';
							    }
							}
							else
							{
								
								$strConcepto = 'DIARIO POR FINALIZACION DE ORDEN DE TRABAJO INTERNO A EQUIPO DE CONSIGNACION';

								
								/***Mantenimiento**/
								//Datos del mantenimiento
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '602';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = '01';
								$objCuenta->strCuartoNivel = '86001';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($numTotalCostos, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'CARGO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}
							}



							/****Inventario***/
							//Si existe costo por refacciones
							if ($numCostoRefacciones > 0)
							{
								//Datos del costo de refacciones
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = '07';
								$objCuenta->strCuartoNivel = '01200';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($numCostoRefacciones, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

							}//Cierre de verificación del costo de refacciones (inventario)
							

							//Si existe costo de trabajos foráneos
							if ($numCostoForaneos > 0)
							{
								//Datos del costo del trabajo foráneo
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '115';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = '07';
								$objCuenta->strCuartoNivel = '03000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($numCostoForaneos, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

							}//Cierre de verificación del costo de trabajos foráneos (inventario)


					    }
						else
						{
							//Asignar mensaje de error
					 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
					 		$this->ARR_DATOS['strError'] .= '<br>';
						}



					}//Cierre de verificación del total de costos

					

				}//Cierre de la verificación del tipo de servicio



				//Si se cumple la sentencia
				if ($strGuardar == 'SI')
				{

						//Asignar datos de la póliza
						$objPoliza->intSucursalID =  $otdOrden->sucursal_id;
						$objPoliza->strTipo = 'DIARIO';
						$objPoliza->strModulo = 'CONTROL DE VEHICULOS';
						$objPoliza->strProceso = 'ORDEN DE TRABAJO';
						$objPoliza->intReferenciaID = $otdOrden->referencia_id;
						$objPoliza->dteFecha = $otdOrden->fecha;
						$objPoliza->strConcepto = $strConcepto;
						$objPoliza->strObservaciones = $strObservaciones;
						$objPoliza->strEstatus = 'ACTIVO';
						$objPoliza->arrDetalles = $arrDetalles;

						//Hacer un llamado a la función para guardar los datos de la póliza en la BD
						$this->guardar_poliza_referencia($objPoliza, $intProcesoMenuID);
				}
				else
				{
					//Asignar mensaje de error
					$this->ARR_DATOS['strError'] .= 'No existen costos.';
					$this->ARR_DATOS['strError'] .= '<br>';
				}

				
			}
			else
			{
				//Asignar mensaje de error
				$this->ARR_DATOS['strError'] .= 'El tipo de servicio no se encuentra en la lista de servicios que generan póliza.';
				$this->ARR_DATOS['strError'] .= '<br>';

			}//Cierre de verificación del tipo de servicio en el array

		}
		else
		{
			//Indicar mensaje de error (no se genera la póliza porque no se cumplen con las restricciones / no existe información del registro)
			$this->ARR_DATOS['strError'] = MSJ_ERROR_POLIZA;
		}

	}

	//Método para generar una póliza con los datos de la nota de crédito digital, nota de cargo, etc.
	public function get_poliza_diario($intReferenciaID, $strTipoReferencia, $intProcesoMenuID)
	{

		//------------------------------------------------------------------------------------------------------------------------
		//---------- DATOS DE LA REFERENCIA 
		//------------------------------------------------------------------------------------------------------------------------
       	//Seleccionar datos del registro
       	$otdNota = $this->notas->buscar_referencia_poliza($intReferenciaID, $strTipoReferencia);

       	//Verificar si hay información del registro
		if($otdNota)
		{
			//Asignar el folio de la referencia (nota)
			$this->ARR_DATOS['strFolioReferencia'] = $otdNota->folio;

			//Crear un objeto vacio, stdClass es el objeto Póliza
			$objPoliza = new stdClass();
			//Array que se utiliza para agregar los detalles de la póliza 
			$arrDetalles = array();
			//Array que se utiliza para agregar los datos de un detalle
			$arrAuxiliar = array();
			//Variables que se utilizan para asignar datos de la póliza
			$strConcepto = '';
			$strObservaciones = '';
			//Variables que se utilizan para asignar datos del detalle
			$intRenglon = 1;


			//------------------------------------------------------------------------------------------------------------------------
			//---------- DETALLES DE LA REFERENCIA 
			//------------------------------------------------------------------------------------------------------------------------
			//Seleccionar los detalles del registro
		    $otdDetalles = $this->notas->buscar_detalles_poliza($intReferenciaID, 	
		    													$strTipoReferencia);

		    //------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL REGISTRO 
	        //------------------------------------------------------------------------------------------------------------------------
		    //Dependiendo del proceso generar póliza
		    if ($otdNota->Proceso == 'NOTA CREDITO')//Notas de crédito digitales
			{


				//Array que se utiliza para asignar los datos de las tasas de IEPS
				$arrIEPS = array();
				//Array que se utiliza para asignar los datos de los clientes
				$arrClientes = array();
				//Variable que se utiliza para acumular el importe de IVA
				$numIVAGeneral = 0;

				//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrMov)
					{
						//Si existe importe de IEPS
						if ($arrMov->ieps > 0)
						{
							
							//Agregar datos al array
							array_push($arrIEPS, array('TasaID' => $arrMov->tasa_cuota_ieps,
													   'TasaIEPS' => $arrMov->TasaIEPS,
													   'Importe' => $arrMov->ieps));
						}

						//Incrementar IVA
						$numIVAGeneral += $arrMov->iva;

						//Seleccionar facturas de la nota de crédito
					    $otdFraNota = $this->notas->buscar_factura_poliza($arrMov->referencia_id, 	
		    															  $arrMov->referencia);

					    //Array que se utiliza para asignar los datos de los impuestos
					    $arrImpuesto = array();
					    //Variable que se utiliza para asignar la descripción del módulo
						$strModulo = '';
						//Variable que se utiliza para acumular el subtotal
						$numSubtotal = 0;
						$intTasaIVA = 0;
						//Variable que se utiliza para acumular el importe de IVA
						$numIVA = 0;
						$intTasaIEPS = 0;
						//Variable que se utiliza para acumular el importe de IEPS
						$numIEPS = 0;
						//Verificar si existe información de las facturas 
						if ($otdFraNota) 
						{

							//Recorremos el arreglo 
							foreach ($otdFraNota as $arrDet)
							{

								//Asignar el id de la sucursal
								$otdNota->sucursal_id =  $arrDet->sucursal_id;

								//Dependiendo de la referencia asignar módulo
								if ($arrMov->referencia == 'MAQUINARIA')
								{
									if ($arrDet->CodDes == 'TRASLADO/MAQAGRIC')
									{
										$arrDet->Modulo = 'MAQUINARIA';
									}
									else if ($arrDet->CodDes == 'TRASLADO/MAQCONST')
									{
										$arrDet->Modulo = 'CONSTRUCCION';
									}
									else
									{	
										//Concatenar datos para realizar la búsqueda del departamento
				    					$strCriteriosBusq = $arrDet->Modulo.'|CUENTAS POR COBRAR';
										//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
										$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

										//Si existen datos del departamento (cuenta de línea de maquinaria)
										if($otdConfDepto)
										{
											//Asignar cuenta del departamento
											$arrDet->Modulo = $otdConfDepto->cuenta;

										}
										else
									    {
									    	//Asignar mensaje de error
											$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																			(línea de maquinaria).';
											$this->ARR_DATOS['strError'] .= '<br>';
									    }

									}
								}



								//Si se cumple la sentencia
								if ((($arrDet->Modulo <> $strModulo) && 
									 ($strModulo <> '')) OR 
									(($arrDet->tasa_cuota_iva <> $intTasaIVA) && 
									 ($intTasaIVA <> 0)) OR 
									(($arrDet->tasa_cuota_ieps <> $intTasaIEPS) && 
									 ($intTasaIEPS <> 0)))
								{


									//Agregar datos al array
									array_push($arrImpuesto, array('Modulo' => $strModulo, 
																   'Subtotal' => $numSubtotal, 
																   'TasaCuotaIVA' => $intTasaIVA, 
																   'IVA' => $numIVA, 
																   'TasaCuotaIEPS' => $intTasaIEPS, 
																   'IEPS' => $numIEPS));

									//Inicializar valores
									$numSubtotal = 0;
									$numIVA = 0;
									$numIEPS = 0;
								}


								//Asignar módulo de la factura
								$strModulo = $arrDet->Modulo;
								//Incrementar acumulados
								$numSubtotal += $arrDet->Subtotal;
								$intTasaIVA = $arrDet->tasa_cuota_iva;
								$numIVA += $arrDet->IVA;
								$intTasaIEPS = $arrDet->tasa_cuota_ieps;
								$numIEPS += $arrDet->IEPS;


							}//Cierre de foreach facturas

						}//Cierre de verificación de facturas


						//Si se cumple la sentencia
						if (($strModulo <> '') OR ($intTasaIVA <> 0) OR ($intTasaIEPS <> 0))
						{


							//Agregar datos al array
							array_push($arrImpuesto, array('Modulo' => $strModulo, 
														   'Subtotal' => $numSubtotal, 
														   'TasaCuotaIVA' => $intTasaIVA, 
														   'IVA' => $numIVA, 
														   'TasaCuotaIEPS' => $intTasaIEPS, 
														   'IEPS' => $numIEPS));
						}


						//Asignar valores
						$numSaldo = $arrMov->precio;
						$numSaldoIVA = $arrMov->iva;
						$numSaldoIEPS = $arrMov->ieps;



						//Hacer recorrido para obtener impuestos
						foreach($arrImpuesto as $objImpuesto)
						{
							//Si se cumple la sentencia
							if (($numSaldo > 0) &&
								($objImpuesto['TasaCuotaIVA'] == $arrMov->tasa_cuota_iva) &&
								($objImpuesto['TasaCuotaIEPS'] == $arrMov->tasa_cuota_ieps))
							{
								$strConcepto = 'DESCUENTO A FACTURAS POR VENTAS '.$objImpuesto['Modulo'];

								if (round($numSaldo, 5) >= round($objImpuesto['Subtotal'], 5))
								{
									//Agregar datos al array
									array_push($arrClientes, array('Modulo' => $objImpuesto['Modulo'], 
																   'Subtotal' => $objImpuesto['Subtotal'], 
																   'TasaCuotaIVA' => $objImpuesto['TasaCuotaIVA'], 
																   'IVA' => $objImpuesto['IVA'], 
																   'TasaCuotaIEPS' => $objImpuesto['TasaCuotaIEPS'], 
																   'IEPS' => $objImpuesto['IEPS']));
								}
								else
								{
									//Agregar datos al array
									array_push($arrClientes, array('Modulo' => $objImpuesto['Modulo'], 
																   'Subtotal' => $numSaldo, 
																   'TasaCuotaIVA' => $objImpuesto['TasaCuotaIVA'], 
																   'IVA' => $numSaldoIVA, 
																   'TasaCuotaIEPS' => $objImpuesto['TasaCuotaIEPS'], 
																   'IEPS' => $numSaldoIEPS));
								}

								//Decremantar saldos
								$numSaldo -= $objImpuesto['Subtotal'];
								$numSaldoIVA -= $objImpuesto['IVA'];
								$numSaldoIEPS -= $objImpuesto['IEPS'];
							}
						}


					}//Cierre de foreach detalles

				}//Cierre de verificación de detalles

				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdNota->sucursal_id);


				//Si hay información de la cuenta contable
				if($otdConfContable)
				{

					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					/******Descuento sobre ventas******/
					//Hacer recorrido para obtener descuento sobre ventas
					foreach($arrClientes as $objCliente)
					{

						//Variable que se utiliza para asignar descripción del modulo
						$strModuloCte = $objCliente['Modulo'];


						//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
						$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'DESCUENTOS', $strModuloCte);


						//Si existen datos del departamento (cuenta del módulo)
						if($otdConfModulo)
						{
							/****Cliente***/
							//Datos del cliente
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '402';
							$objCuenta->strSegundoNivel = $strCuentaContable;

							//Si existe importe de IVA
							if ($objCliente['IVA'] > 0)
							{
								$objCuenta->strTercerNivel = '03';
							}
							else
							{
								$objCuenta->strTercerNivel = '04';
							}
							$objCuenta->strCuartoNivel = $otdConfModulo->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($objCliente['Subtotal'], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}
						else
					    {
					    	//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo (descuento):  
															  '.$strModuloCte;
							$this->ARR_DATOS['strError'] .= '<br>';
					    }

					}//Cierre de foreach descuento sobre ventas


					//IVA por trasladar
					if ($numIVAGeneral > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '209';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numIVAGeneral, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}


					/******IEPS******/
					//Hacer recorrido para obtener IEPS trasladado cobrado
					foreach($arrIEPS as $objIEPS)
					{

					    //Hacer un llamado al método para comprobar la existencia de la configuración del ieps
					    $otdConfIeps = $this->config_polizas->buscar_configuracion_ieps(NULL, $objIEPS['TasaID']);

					     //Si existen datos de la tasa (cuenta de la tasa de IEPS)
						if($otdConfIeps)
						{
							//Datos del IEPS
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '209';
							$objCuenta->strSegundoNivel = '02';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = $otdConfIeps->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($objIEPS['Importe'], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}
						else
					    {
					    	//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la tasa de IEPS: ';
							$this->ARR_DATOS['strError'] .=  $objIEPS['TasaIEPS'];
							$this->ARR_DATOS['strError'] .= '<br>';
					    }

					}//Cierre de foreach IEPS


					/******Clientes******/
					//Hacer recorrido para obtener clientes
					foreach($arrClientes as $objCliente)
					{

						//Variable que se utiliza para asignar descripción del modulo
						$strModuloCte = $objCliente['Modulo'];

						//Variable que se utiliza para asignar la descripción de la Tasa de IVA
						$strTasaIVA = "";

						//Datos del cliente
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '105';
						$objCuenta->strSegundoNivel = $strCuentaContable;

						//Si existe importe de IVA
						if ($objCliente['IVA'] > 0)
						{
							//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
							$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA16', $strModuloCte);
							$strTasaIVA = ' 16%';
						}
						else
						{
							//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
							$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA0', $strModuloCte);
							$strTasaIVA = '0%';
						}


						//Si existen datos del departamento (cuenta del módulo)
						if($otdConfModulo)
						{
							$objCuenta->strTercerNivel = $otdConfModulo->cuenta;
							$objCuenta->strCuartoNivel = $otdNota->codigo;
							$objCuenta->strDescripcion = $otdNota->razon_social;
							$objCuenta->strNaturaleza = NULL;
							$objCuenta->strTipoCuenta = NULL;
							$objCuenta->strAceptaMovimientos = 'SI';
							$objCuenta->strMovimientosBancarios  = 'NO';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];

							//Calcular importe
							$intImporte = ($objCliente['Subtotal'] + $objCliente['IVA'] + $objCliente['IEPS']);

							$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						
						}
						else
						{
							//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo (cliente TASA '.$strTasaIVA.'):  
															  '.$strModuloCte;
							$this->ARR_DATOS['strError'] .= '<br>';
						}

					}//Cierre de foreach clientes

				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}
			else if ($otdNota->Proceso == 'NOTA CARGO')//Notas de cargo
			{
				//Asignar concepto de la póliza
				$strConcepto = 'PARA CONVERTIR EN ANTICIPO DE CLIENTE LO PREVIAMENTE PAGADO O APLICADO';

				//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrMov)
					{
						//Seleccionar facturas de la nota de cargo
					    $otdFraNota = $this->notas->buscar_factura_poliza($arrMov->referencia_id, 	
		    															  $arrMov->referencia);

					    //Variable que se utiliza para asignar id de la sucursal
					    $intSucursalID = 0;
					    //Variable que se utiliza para asignar descripción del módulo
						$strModulo = '';

						//Verificar si existe información de las facturas 
						if ($otdFraNota) 
						{
							//Recorremos el arreglo 
							foreach ($otdFraNota as $arrDet)
							{

								//Si se cumple la sentencia
								if (($arrMov->tasa_cuota_iva == $arrDet->tasa_cuota_iva) &&
									($arrMov->tasa_cuota_ieps == $arrDet->tasa_cuota_ieps))
								{
									//Asignar el id de la sucursal
									$intSucursalID = $arrDet->sucursal_id;
									//Asignar descripción del módulo
									$strModulo = $arrDet->Modulo;

									//Dependiendo de la referencia asignar módulo
									if ($arrMov->referencia == 'MAQUINARIA')
									{
										if ($arrDet->CodDes == 'TRASLADO/MAQAGRIC')
										{
											$strModulo = 'MAQUINARIA';
										}
										else if ($arrDet->CodDes == 'TRASLADO/MAQCONST')
										{
											$strModulo = 'CONSTRUCCION';
										}
										else
										{

											//Concatenar datos para realizar la búsqueda del departamento
					    					$strCriteriosBusq = $arrDet->Modulo.'|CUENTAS POR COBRAR';
											//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
											$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

											//Si existen datos del departamento (cuenta de línea de maquinaria)
											if($otdConfDepto)
											{
												//Asignar cuenta del departamento
												$strModulo = $otdConfDepto->cuenta;
											}
											else
										    {
										    	//Asignar mensaje de error
												$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																				(línea de maquinaria).';
												$this->ARR_DATOS['strError'] .= '<br>';
									   		}
										}
									}
								}


							}//Cierre de foreach facturas

						}//Cierre de verificación de facturas


			  				
			  			//Calcular importe
						$intImporte = ($arrMov->precio + $arrMov->iva + $arrMov->ieps);
								

						//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal (factura)
			  			$otdConfContableCte = $this->config_contable->buscar($intSucursalID);
			  		    //Si hay información de la cuenta contable (cliente - factura)
						if($otdConfContableCte)
						{
							
							//Variable que se utiliza para asignar la descripción de la Tasa de IVA
						    $strTasaIVA = "";
						    //Si existe importe de IVA
							if ($arrMov->iva > 0)
							{

								//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
								$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA16', $strModulo);
								$strTasaIVA = ' 16%';
							}
							else
							{
								//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
								$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA0', $strModulo);
								$strTasaIVA = '0%';
							}
			  			

							//Si existen datos del departamento (cuenta del módulo)
							if($otdConfModulo)
							{
								/****Clientes***/
								//Datos del cliente
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->intCuentaPadreID = NULL;
								$objCuenta->intSatCuentaID = NULL;
								$objCuenta->strPrimerNivel = '105';
								$objCuenta->strSegundoNivel = $otdConfContableCte->cuenta_contable;
								$objCuenta->strTercerNivel = $otdConfModulo->cuenta;
								$objCuenta->strCuartoNivel = $otdNota->codigo;
								$objCuenta->strDescripcion = $otdNota->razon_social;
								$objCuenta->strNaturaleza = NULL;
								$objCuenta->strTipoCuenta = NULL;
								$objCuenta->strAceptaMovimientos = 'SI';
								$objCuenta->strMovimientosBancarios  = 'NO';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'CARGO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

						    }
							else
							{
								//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo (cliente TASA '.$strTasaIVA.'):  
																  '.$strModulo;
								$this->ARR_DATOS['strError'] .= '<br>';
							}

						}
						else
						{
							//Asignar mensaje de error
					 		$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la sucursal (cliente).';
					 		$this->ARR_DATOS['strError'] .= '<br>';
						}


						//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal (nota)
			  			$otdConfContableNota = $this->config_contable->buscar($otdNota->sucursal_id);

						//Si hay información de la cuenta contable (nota)
						if($otdConfContableNota)
						{
							
							//Variable que se utiliza para asignar la descripción de la Tasa de IVA
						    $strTasaIVA = "";
						    //Si existe importe de IVA
							if ($arrMov->iva > 0)
							{

								//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
								$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA16', $strModulo);
								$strTasaIVA = ' 16%';
							}
							else
							{
								//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
								$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA0', $strModulo);
								$strTasaIVA = '0%';
							}
			  			

							//Si existen datos del departamento (cuenta del módulo)
							if($otdConfModulo)
							{

								/****Anticipos***/
								//Datos del anticipo
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->intCuentaPadreID = NULL;
								$objCuenta->intSatCuentaID = NULL;
								$objCuenta->strPrimerNivel = '206';
								$objCuenta->strSegundoNivel = $otdConfContableNota->cuenta_contable;
								$objCuenta->strTercerNivel = $otdConfModulo->cuenta;
								$objCuenta->strCuartoNivel = $otdNota->codigo;
								$objCuenta->strDescripcion = $otdNota->razon_social;
								$objCuenta->strNaturaleza = NULL;
								$objCuenta->strTipoCuenta = NULL;
								$objCuenta->strAceptaMovimientos = 'SI';
								$objCuenta->strMovimientosBancarios  = 'NO';
								$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}
							}
							else
							{
								//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo (cliente TASA '.$strTasaIVA.'):  
																  '.$strModulo;
								$this->ARR_DATOS['strError'] .= '<br>';
							}
						}
						else
						{
							//Asignar mensaje de error
					 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
					 		$this->ARR_DATOS['strError'] .= '<br>';
						}


					}//Cierre de foreach detalles

				}//Cierre de verificación de detalles

			}
			else if ($otdNota->Proceso == 'NOTA CARGO DIGITAL')//Notas de cargo digitales
			{


				//Verificar si existe información de los detalles
				if ($otdDetalles) 
				{

					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrMov)
					{
						//Seleccionar facturas de la nota de cargo
					    $otdFraNota = $this->notas->buscar_factura_poliza($arrMov->referencia_id, 	
		    															  $arrMov->referencia);

					    //Variable que se utiliza para asignar descripción del módulo
					    $strModulo = '';

					    //Verificar si existe información de las facturas 
						if ($otdFraNota) 
						{

							//Recorremos el arreglo 
							foreach ($otdFraNota as $arrDet)
							{

								//Si se cumple la sentencia
								if (($arrMov->tasa_cuota_iva == $arrDet->tasa_cuota_iva) &&
									($arrMov->tasa_cuota_ieps == $arrDet->tasa_cuota_ieps))
								{
									//Asignar descripción del módulo
									$strModulo = $arrDet->Modulo;

									//Dependiendo de la referencia asignar módulo
									if ($arrMov->referencia == 'MAQUINARIA')
									{
										if ($arrDet->CodDes == 'TRASLADO/MAQAGRIC')
										{
											$strModulo = 'MAQUINARIA';
										}
										else if ($arrDet->CodDes == 'TRASLADO/MAQCONST')
										{
											$strModulo = 'CONSTRUCCION';
										}
										else
										{
											//Concatenar datos para realizar la búsqueda del departamento
					    					$strCriteriosBusq = $arrDet->Modulo.'|CUENTAS POR COBRAR';
											//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
											$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

											//Si existen datos del departamento (cuenta de línea de maquinaria)
											if($otdConfDepto)
											{
												//Asignar cuenta del departamento
												$strModulo = $otdConfDepto->cuenta;
											}
											else
										    {
										    	//Asignar mensaje de error
												$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																				(línea de maquinaria).';
												$this->ARR_DATOS['strError'] .= '<br>';
										    }
										}
									}
								}


							}//Cierre de foreach facturas


						}//Cierre de verificación de facturas


						//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
			   			$otdConfContable = $this->config_contable->buscar($otdNota->sucursal_id);


			   			//Si hay información de la cuenta contable
						if($otdConfContable)
						{

							//Asignar cuenta contable
							$strCuentaContable =  $otdConfContable->cuenta_contable;

							//Variable que se utiliza para asignar la descripción de la Tasa de IVA
							$strTasaIVA = "";
							//Si existe importe de IVA
							if ($arrMov->iva > 0)
							{
								//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
								$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA16', $strModulo);
								$strTasaIVA = ' 16%';

							}
							else
							{
								

								//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
								$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA0', $strModulo);
								$strTasaIVA = '0%';
							}

							//Si existen datos del departamento (cuenta del módulo)
							if($otdConfModulo)
							{

							   	/****Cliente***/
							   	//Datos del cliente
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->intCuentaPadreID = NULL;
								$objCuenta->intSatCuentaID = NULL;
								$objCuenta->strPrimerNivel = '105';
								$objCuenta->strSegundoNivel = $strCuentaContable;
								$objCuenta->strTercerNivel = $otdConfModulo->cuenta;
								$objCuenta->strCuartoNivel = $otdNota->codigo;
								$objCuenta->strDescripcion = $otdNota->razon_social;
								$objCuenta->strNaturaleza = NULL;
								$objCuenta->strTipoCuenta = NULL;
								$objCuenta->strAceptaMovimientos = 'SI';
								$objCuenta->strMovimientosBancarios  = 'NO';
							    //Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];

								//Calcular importe
								$intImporte = ($arrMov->precio + $arrMov->iva + $arrMov->ieps);

								$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'CARGO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}
							}
							else
							{
								//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo (cliente TASA '.$strTasaIVA.'):  
																  '.$strModulo;
								$this->ARR_DATOS['strError'] .= '<br>';
							}


				    		//Array que se utiliza para separar concepto
							$arrConcepto = explode(' ', $arrMov->concepto);

							//Si se cumple la sentencia
							if (in_array('COMPLEMENTO', $arrConcepto)) 
							{
								$strConcepto = 'REGISTRO COMPLEMENTO PRECIO VENTA '.$strModulo;



								//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
								$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'DESCUENTOS', $strModulo);


								//Si existen datos del departamento (cuenta del módulo)
								if($otdConfModulo)
								{
									/****Ventas***/
							   		//Datos de la venta
									$arrAuxiliar['renglon'] = $intRenglon;
								    //Crear un objeto vacio, stdClass es el objeto Cuenta
									$objCuenta = new stdClass();
									$objCuenta->strPrimerNivel = '401';
									$objCuenta->strSegundoNivel = $strCuentaContable;

									//Deoendiendo del metodo de pago asignar cuenta
									if ($arrMov->MetodoPago == 'PUE')
									{
										//Si existe importe de IVA
										if ($arrMov->iva > 0)
										{
											$objCuenta->strTercerNivel = '02';
										}
										else
										{
											$objCuenta->strTercerNivel = '05';
										}
									}
									else
									{
										//Si existe importe de IVA
										if ($arrMov->iva > 0)
										{
											$objCuenta->strTercerNivel = '03';
										}
										else
										{
											$objCuenta->strTercerNivel = '06';
										}
									}

									$objCuenta->strCuartoNivel = $otdConfModulo->cuenta;
									//Hacer un llamado a la función para obtener los datos de la cuenta
									$arrCuenta = $this->get_cuenta($objCuenta);
									$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
									$arrAuxiliar['importe'] = number_format($arrMov->precio, 5, '.', '');
									$arrAuxiliar['naturaleza'] = 'ABONO';
									$arrAuxiliar['referencia'] = '';
									$arrAuxiliar['concepto'] = '';
									//Si existe id de la cuenta
									if ($arrAuxiliar['cuenta_id'] > 0)
									{
										//Agregar datos al array
										array_push($arrDetalles, $arrAuxiliar);
										//Incrementar renglón
										$intRenglon++;
									}
								}
								else
								{

							    	//Asignar mensaje de error
									$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo (descuento (complemento)):  
																	  '.$strModulo;
									$this->ARR_DATOS['strError'] .= '<br>';
								}
							}
							else if (in_array('INTERESES', $arrConcepto)) 
							{

								$strConcepto = 'REGISTRO POR COBRO DE INTERESES A FACTURA '.$strModulo;

								//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
								$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'DESCUENTOS', $strModulo);


								//Si existen datos del departamento (cuenta del módulo)
								if($otdConfModulo)
								{
									/****Intereses***/
							   		//Datos de intereses
									$arrAuxiliar['renglon'] = $intRenglon;
									 //Crear un objeto vacio, stdClass es el objeto Cuenta
									$objCuenta = new stdClass();
									$objCuenta->strPrimerNivel = '702';
									$objCuenta->strSegundoNivel = $strCuentaContable;
									if ($arrMov->iva == 'FISICA')
									{
										$objCuenta->strTercerNivel = '06';
									}
									else
									{
										$objCuenta->strTercerNivel = '08';
									}
									$objCuenta->strCuartoNivel = $otdConfModulo->cuenta;

									//Hacer un llamado a la función para obtener los datos de la cuenta
									$arrCuenta = $this->get_cuenta($objCuenta);
									$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
									$arrAuxiliar['importe'] = number_format($arrMov->precio, 5, '.', '');
									$arrAuxiliar['naturaleza'] = 'ABONO';
									$arrAuxiliar['referencia'] = '';
									$arrAuxiliar['concepto'] = '';
									//Si existe id de la cuenta
									if ($arrAuxiliar['cuenta_id'] > 0)
									{
										//Agregar datos al array
										array_push($arrDetalles, $arrAuxiliar);
										//Incrementar renglón
										$intRenglon++;
									}
								}
								else
								{

							    	//Asignar mensaje de error
									$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo (descuento (intereses)):  
																	  '.$strModulo;
									$this->ARR_DATOS['strError'] .= '<br>';
								}
							}
							else if (in_array('DESCUENTO', $arrConcepto) OR
									 in_array('BONIFICACION', $arrConcepto)) 
							{
								$strConcepto = 'PARA CANCELAR DESCUENTO SOBRE VENTA A FACTURA '.$strModulo;


								//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
								$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'DESCUENTOS', $strModulo);

								//Si existen datos del departamento (cuenta del módulo)
								if($otdConfModulo)
								{
									//Datos del descuento
									$arrAuxiliar['renglon'] = $intRenglon;
									//Crear un objeto vacio, stdClass es el objeto Cuenta
									$objCuenta = new stdClass();
									$objCuenta->strPrimerNivel = '402';
									$objCuenta->strSegundoNivel = $strCuentaContable;
									//Si existe importe de IVA
									if ($arrMov->iva > 0)
									{
										$objCuenta->strTercerNivel = '03';
									}
									else
									{
										$objCuenta->strTercerNivel = '04';
									}
								    
								    $objCuenta->strCuartoNivel = $otdConfModulo->cuenta;
									//Hacer un llamado a la función para obtener los datos de la cuenta
									$arrCuenta = $this->get_cuenta($objCuenta);
									$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
									$arrAuxiliar['importe'] = number_format($arrMov->precio, 5, '.', '');
									$arrAuxiliar['naturaleza'] = 'ABONO';
									$arrAuxiliar['referencia'] = '';
									$arrAuxiliar['concepto'] = '';
									//Si existe id de la cuenta
									if ($arrAuxiliar['cuenta_id'] > 0)
									{
										//Agregar datos al array
										array_push($arrDetalles, $arrAuxiliar);
										//Incrementar renglón
										$intRenglon++;
									}
								}
								else
								{

							    	//Asignar mensaje de error
									$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo (descuento):  
																	  '.$strModulo;
									$this->ARR_DATOS['strError'] .= '<br>';
								}
							}

							//Si existe importe de IVA
							if ($arrMov->iva > 0)
							{
								//Datos del IVA
								$arrAuxiliar['renglon'] = $intRenglon;
								 //Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '209';
								$objCuenta->strSegundoNivel = '01';
								$objCuenta->strTercerNivel = $strCuentaContable;
								$objCuenta->strCuartoNivel = '00000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($arrMov->iva, 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}
							}

							//Si existe importe de IEPS
							if ($arrMov->ieps > 0)
							{
								  //Hacer un llamado al método para comprobar la existencia de la configuración del ieps
					    		$otdConfIeps = $this->config_polizas->buscar_configuracion_ieps(NULL, $arrMov->tasa_cuota_ieps);

					    		 //Si existen datos de la tasa (cuenta de la tasa de IEPS)
								if($otdConfIeps)
								{
										//Datos del IEPS
										$arrAuxiliar['renglon'] = $intRenglon;
										 //Crear un objeto vacio, stdClass es el objeto Cuenta
										$objCuenta = new stdClass();
										$objCuenta->strPrimerNivel = '209';
										$objCuenta->strSegundoNivel = '02';
										$objCuenta->strTercerNivel = $strCuentaContable;
										$objCuenta->strCuartoNivel = $otdConfIeps->cuenta;
										//Hacer un llamado a la función para obtener los datos de la cuenta
										$arrCuenta = $this->get_cuenta($objCuenta);
										$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
										$arrAuxiliar['importe'] = number_format($arrMov->ieps, 5, '.', '');
										$arrAuxiliar['naturaleza'] = 'ABONO';
										$arrAuxiliar['referencia'] = '';
										$arrAuxiliar['concepto'] = '';
										//Si existe id de la cuenta
										if ($arrAuxiliar['cuenta_id'] > 0)
										{
											//Agregar datos al array
											array_push($arrDetalles, $arrAuxiliar);
											//Incrementar renglón
											$intRenglon++;
										}
								}
								else
							    {
							    	//Asignar mensaje de error
									$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la tasa de IEPS: ';
									$this->ARR_DATOS['strError'] .=  $arrMov->TasaIEPS;
									$this->ARR_DATOS['strError'] .= '<br>';
							    }
							}

						}
						else
						{
							//Asignar mensaje de error
					 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
					 		$this->ARR_DATOS['strError'] .= '<br>';
						}

					}//Cierre de foreach detalles

				}//Cierre de verificación de detalles

			}
			else//Notas de crédito servicio
			{
				//Constante para identificar los datos del SAT correspondientes al IVA 16%
				$intTasaCuotaIDIva = SAT_TASA_CUOTA_IVA_ID;
				//Constante para identificar los datos del SAT correspondientes al IVA cero
				$intTasaCuotaIDIvaCero = SAT_TASA_CUOTA_IVA_CERO_ID;

				//Array que se utiliza para asignar los datos de las tasas de IVA para clientes
				$arrClientes = array($intTasaCuotaIDIvaCero => 0, 
								     $intTasaCuotaIDIva => 0);

				//Array que se utiliza para asignar los datos de las tasas de IVA para devoluciones
				$arrDevolucion =array($intTasaCuotaIDIvaCero => 0, 
								     $intTasaCuotaIDIva => 0);

				//Array que se utiliza para asignar los datos de las tasas de IEPS
				$arrIEPS = array();

				//Variable que se utiliza para acumular el subtotal
				$numSubtotal = 0;
				//Variable que se utiliza para acumular el importe de IVA
				$numIVA = 0;
				//Variable que se utiliza para acumular el importe de IEPS
				$numIEPS = 0;

				//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrMov)
					{
						$strConcepto = 'DEVOLUCION SOBRE VENTA TALLER';

						//Incrementar acumulados
						$numSubtotal += $arrMov->precio;
						$numIVA += $arrMov->iva;
						$numIEPS += $arrMov->ieps;

						//Agregar total al array de clientes
						$arrClientes[$arrMov->tasa_cuota_iva] += ($arrMov->precio + $arrMov->iva + $arrMov->ieps);
						//Agregar precio al array de devolución
						$arrDevolucion[$arrMov->tasa_cuota_iva] += ($arrMov->precio);

						//Si existe importe de IEPS
						if ($arrMov->ieps > 0)
						{
							//Agregar datos al array
							array_push($arrIEPS, array('TasaID' => $arrMov->tasa_cuota_ieps, 
														'TasaIEPS' => $arrMov->TasaIEPS,
														'Importe' => $arrMov->IEPS));
						}
					
					}//Cierre de foreach detalles


				}//Cierre de verificación de detalles


				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdNota->sucursal_id);

				//Si hay información de la cuenta contable
				if($otdConfContable)
				{

					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					/****Devoluciones sobre ventas IVA 16%***/
					//Si existen devoluciones con tasa de IVA del 16%
					if ($arrDevolucion[$intTasaCuotaIDIva] > 0)
					{
						//Datos de la devolución
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
					    $objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '402';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '01';
						$objCuenta->strCuartoNivel = '03000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrDevolucion[$intTasaCuotaIDIva], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 16%


					/****Devoluciones sobre ventas IVA 0%***/
				   //Si existen devoluciones con tasa de IVA del 0%
					if ($arrDevolucion[$intTasaCuotaIDIvaCero] > 0)
					{
						//Datos de la devolución
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '402';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '02';
						$objCuenta->strCuartoNivel = '03000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrDevolucion[$intTasaCuotaIDIvaCero], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 0%


					//Si existe importe de IVA por trasladar
					if ($numIVA > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '209';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numIVA, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}

					/****Clientes IVA 16%***/
					//Si existen clientes con tasa de IVA del 16%
					if ($arrClientes[$intTasaCuotaIDIva] > 0)
					{
						//Datos del cliente
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '105';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '05';
						$objCuenta->strCuartoNivel = $otdNota->codigo;
						$objCuenta->strDescripcion = $otdNota->razon_social;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrClientes[$intTasaCuotaIDIva], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 16%


					/****Clientes IVA 0%***/
					//Si existen clientes con tasa de IVA del 0%
					if ($arrClientes[$intTasaCuotaIDIvaCero] > 0)
					{
						//Datos del cliente
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '105';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '06';
						$objCuenta->strCuartoNivel = $otdNota->codigo;
						$objCuenta->strDescripcion = $otdNota->razon_social;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($arrClientes[$intTasaCuotaIDIvaCero], 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verifición de tasa de IVA del 0%


					//Variable que se utiliza para acumular el costo de mano de obra
					$numCostoManoObra = 0;
					//Variable que se utiliza para acumular el costo de refacciones
					$numCostoRefacciones = 0;
					//Variable que se utiliza para acumular el costo de trabajos foráneos
					$numCostoForaneos = 0;

					//Seleccionar los detalles de la orden de reparación 
					$otdDetOrden = $this->ordenes->buscar_detalles_poliza($otdNota->Referencia);

					//Verificar si existe información de los detalles (orden de reparación)
					if ($otdDetOrden) 
					{
						//Recorremos el arreglo 
						foreach ($otdDetOrden as $arrOrd)
						{
							//Dependiendo del tipo incrementar acumulado del costo
							if ($arrOrd->Tipo == 'MANO OBRA')
							{
								$numCostoManoObra += $arrOrd->Costo;
							}
							else if ($arrOrd->Tipo == 'REFACCIONES')
							{
								$numCostoRefacciones += $arrOrd->Costo;
							}
							else if ($arrOrd->Tipo == 'FORANEOS')
							{
								$numCostoForaneos += $arrOrd->Costo;
							}

						}//Cierre de foreach

					}//Cierre de verificación de detalles


					/****Inventario***/
					//Si existe costo de refacciones
					if ($numCostoRefacciones > 0)
					{
						//Datos del costo de refacciones
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '115';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '03';
						$objCuenta->strCuartoNivel = '01000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numCostoRefacciones, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verificación del costo de refacciones (inventario)

					//Si existe costo por mano de obra
					if ($numCostoManoObra > 0)
					{
						//Datos del costo por mano de obra 
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '115';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '03';
						$objCuenta->strCuartoNivel = '02000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verificación del costo por mano de obra (inventario)

					//Si existe costo de trabajos foráneos
					if ($numCostoForaneos > 0)
					{
						//Datos del costo del trabajo foráneo 
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '115';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '03';
						$objCuenta->strCuartoNivel = '03000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numCostoForaneos, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verificación del costo de trabajos foráneos (inventario)


					/****Costos***/
					//Si existe costo por mano de obra
					if ($numCostoManoObra > 0)
					{
						//Datos del costo por mano de obra 
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '501';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '03001';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numCostoManoObra, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verificación del costo por mano de obra (costos)


					//Si existe costo de refacciones
					if ($numCostoRefacciones > 0)
					{
						//Datos del costo de refacciones
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '501';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '03002';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numCostoRefacciones, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verificación del costo de refacciones (costos)

					//Si existe costo de trabajos foráneos
					if ($numCostoForaneos > 0)
					{
						//Datos del costo del trabajo foráneo
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '501';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '03003';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numCostoForaneos, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}//Cierre de verificación del costo de trabajos foráneos (costos)

				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}


			//Asignar datos de la póliza
			$objPoliza->intSucursalID =  $otdNota->sucursal_id;
			$objPoliza->strTipo = 'DIARIO';
			$objPoliza->strModulo = $otdNota->Modulo;
			$objPoliza->strProceso =  $otdNota->Proceso;
			$objPoliza->intReferenciaID = $otdNota->ID;
			$objPoliza->dteFecha = $otdNota->fecha;
			$objPoliza->strConcepto = $strConcepto;
			$objPoliza->strObservaciones = $strObservaciones;
			$objPoliza->strEstatus = 'ACTIVO';
			$objPoliza->arrDetalles = $arrDetalles;

			//Hacer un llamado a la función para guardar los datos de la póliza en la BD
			$this->guardar_poliza_referencia($objPoliza, $intProcesoMenuID);
			

		}
		else
		{
			//Indicar mensaje de error (no se genera la póliza porque no se cumplen con las restricciones / no existe información del registro)
			$this->ARR_DATOS['strError'] = MSJ_ERROR_POLIZA;
		}
	}

	//Método para generar una póliza con los datos de la póliza de abono,  pago, etc.
	public function get_poliza_pago($intReferenciaID, $strTipoReferencia, $intProcesoMenuID)
	{
		
		//Seleccionar la forma de pago del registro
		$otdPago = $this->pagos->buscar_forma_pago($intReferenciaID);

		//Dependiendo de la forma de pago generar póliza
		if($otdPago->forma_pago_id == FORMA_PAGO_APLICACION_ANTICIPO)
		{

			//Asignar el id del proceso pólizas de abono
			$intProcesoMenuID = PROCESOID_POLIZAS_ABONO;

			///Hacer un llamado a la función para generar póliza
			$this->get_poliza_aplicacion($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		}
		else
		{

			//Hacer un llamado a la función para generar póliza
			$this->get_poliza_ingresos($intReferenciaID, $strTipoReferencia, $intProcesoMenuID);
		}

	}

	//Método para generar una póliza con los datos del anticipo, recibo de ingresos, pago, etc.
	public function get_poliza_ingresos($intReferenciaID, $strTipoReferencia, $intProcesoMenuID)
	{


		//------------------------------------------------------------------------------------------------------------------------
		//---------- DATOS DE LA REFERENCIA 
		//------------------------------------------------------------------------------------------------------------------------
       	//Seleccionar datos del registro
       	$otdIngreso = $this->anticipos->buscar_referencia_poliza($intReferenciaID, $strTipoReferencia);

       	//Variable que se utiliza para guardar datos de la póliza en la BD
       	$strAgregar= 'SI';

       	//Verificar si hay información del registro
		if($otdIngreso)
		{
			

			//Asignar el folio de la referencia (anticipo/recibo)
			$this->ARR_DATOS['strFolioReferencia'] = $otdIngreso->folio;

			//Crear un objeto vacio, stdClass es el objeto Póliza
			$objPoliza = new stdClass();
			//Array que se utiliza para agregar los detalles de la póliza 
			$arrDetalles = array();
			//Array que se utiliza para agregar los datos de un detalle
			$arrAuxiliar = array();
			//Variables que se utilizan para asignar datos de la póliza
			$strConcepto = '';
			$strObservaciones = '';
			//Variables que se utilizan para asignar datos del detalle
			$intRenglon = 1;

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL REGISTRO 
	        //------------------------------------------------------------------------------------------------------------------------
		    //Dependiendo del proceso generar póliza
		    if (($otdIngreso->Proceso == 'ANTICIPO') OR 
				($otdIngreso->Proceso == 'RECIBO INTERNO ANTICIPO')) //Anticipos fiscales/Anticipos no fiscales
			{

				//Asignar descripción del departamento (módulo)
				$strDepartamento = $otdIngreso->departamento;

				$strConcepto = 'INGRESO POR ANTICIPO CLIENTE '.$strDepartamento;

				//Calcular importe
				$intImporte = ($otdIngreso->subtotal + $otdIngreso->IVA + $otdIngreso->IEPS);

				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdIngreso->sucursal_id);
				$strCuentaContable = '';
				//Si hay información de la cuenta contable
				if($otdConfContable)
				{
					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					/****Caja***/
					//Datos de la caja
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->strPrimerNivel = '101';
					$objCuenta->strSegundoNivel = $strCuentaContable;
					$objCuenta->strTercerNivel = '02';
					$objCuenta->strCuartoNivel = '00000';
					//Hacer un llamado a la función para obtener los datos de la cuenta
					$arrCuenta = $this->get_cuenta($objCuenta);
					$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
					$arrAuxiliar['naturaleza'] = 'CARGO';
					$arrAuxiliar['referencia'] = '';
					$arrAuxiliar['concepto'] = '';
					//Si existe id de la cuenta
					if ($arrAuxiliar['cuenta_id'] > 0)
					{
						//Agregar datos al array
						array_push($arrDetalles, $arrAuxiliar);
						//Incrementar renglón
						$intRenglon++;
					}

					//Si existe importe de IVA por trasladar
					if ($otdIngreso->IVA > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '209';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($otdIngreso->IVA, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}

				
					/****Cliente***/
					//Variable que se utiliza para asignar la descripción de la Tasa de IVA
					$strTasaIVA = "";

					//Si existe importe de IVA
					if ($otdIngreso->IVA > 0)
					{
						//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
						$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA16', $strDepartamento);
						$strTasaIVA = ' 16%';
					}
					else
					{
						//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
						$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA0', $strDepartamento);
						$strTasaIVA = '0%';
					}

					//Si existen datos del departamento (cuenta del módulo)
					if($otdConfModulo)
					{
						//Datos del cliente
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '206';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = $otdConfModulo->cuenta;
						$objCuenta->strCuartoNivel = $otdIngreso->codigo;
						$objCuenta->strDescripcion = $otdIngreso->razon_social;
						$objCuenta->strNaturaleza = NULL;
						$objCuenta->strTipoCuenta = NULL;
						$objCuenta->strAceptaMovimientos = 'SI';
						$objCuenta->strMovimientosBancarios  = 'NO';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}

					}
					else
					{
						//Asignar mensaje de error
						$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo (cliente TASA '.$strTasaIVA.'):  
														  '.$strDepartamento;
						$this->ARR_DATOS['strError'] .= '<br>';
					}


					//Si existe importe de IVA trasladado cobrado
					if ($otdIngreso->IVA > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '208';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($otdIngreso->IVA, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}

					/****Contracuenta ingresos IVA***/
					//Datos de la contracuenta
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->strPrimerNivel = '899';
					$objCuenta->strSegundoNivel = '01';
					$objCuenta->strTercerNivel = $strCuentaContable;
					$objCuenta->strCuartoNivel = '01000';
					//Hacer un llamado a la función para obtener los datos de la cuenta
					$arrCuenta = $this->get_cuenta($objCuenta);
					$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					$arrAuxiliar['importe'] = number_format($otdIngreso->subtotal, 5, '.', '');
					$arrAuxiliar['naturaleza'] = 'CARGO';
					$arrAuxiliar['referencia'] = '';
					$arrAuxiliar['concepto'] = '';
					//Si existe id de la cuenta
					if ($arrAuxiliar['cuenta_id'] > 0)
					{
						//Agregar datos al array
						array_push($arrDetalles, $arrAuxiliar);
						//Incrementar renglón
						$intRenglon++;
					}


					/****Contracuenta ingresos IVA***/
					//Datos de la contracuenta
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->strPrimerNivel = '899';
					$objCuenta->strSegundoNivel = '02';
					$objCuenta->strTercerNivel = $strCuentaContable;
					//Si existe importe de IVA
					if ($otdIngreso->IVA > 0)
					{
						// Contracuenta ingresos IVA 16% 
						$objCuenta->strCuartoNivel = '01000';
					}
					else
					{
						// Contracuenta ingresos IVA 0% 
						$objCuenta->strCuartoNivel = '02000';
					}
					
					//Hacer un llamado a la función para obtener los datos de la cuenta
					$arrCuenta = $this->get_cuenta($objCuenta);
					$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					$arrAuxiliar['importe'] = number_format($otdIngreso->subtotal, 5, '.', '');
					$arrAuxiliar['naturaleza'] = 'ABONO';
					$arrAuxiliar['referencia'] = '';
					$arrAuxiliar['concepto'] = '';
					//Si existe id de la cuenta
					if ($arrAuxiliar['cuenta_id'] > 0)
					{
						//Agregar datos al array
						array_push($arrDetalles, $arrAuxiliar);
						//Incrementar renglón
						$intRenglon++;
					}


				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}
				

				//Si existe id de la cuenta bancaria
				if($otdIngreso->cuenta_bancaria_id > 0)
				{
					//Hacer un llamado al método para comprobar la existencia de la configuración de la cuenta bancaria 
					$otdConfCtaBancariaUsd = $this->config_polizas->buscar_configuracion_cuentas_bancarias(NULL, $otdIngreso->cuenta_bancaria_id, 'USD');
						
					//Si existen datos de la cuenta bancaria
					if($otdConfCtaBancariaUsd)
					{	
						//Cuentas de orden moneda extranjera
						if ($otdIngreso->moneda_id <> MONEDA_BASE)
						{

							//Calcular importe
							$intImporte = (($otdIngreso->subtotal + $otdIngreso->IVA + $otdIngreso->IEPS)/$otdIngreso->tipo_cambio);


							/****Contracuenta dólares***/
							//Datos de la contracuenta
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '899';
							$objCuenta->strSegundoNivel = '01';
							$objCuenta->strTercerNivel = '01';
							$objCuenta->strCuartoNivel = $otdConfCtaBancariaUsd->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

							/****Contracuenta dólares***/
							//Datos de la contracuenta
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '899';
							$objCuenta->strSegundoNivel = '02';
							$objCuenta->strTercerNivel = '01';
							$objCuenta->strCuartoNivel = $otdConfCtaBancariaUsd->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}


					} //Cierre de verificación de cuenta (cuenta bancaria extranjera)


				}//Cierre de verificación de cuenta bancaria
				
			}
			else if ($otdIngreso->Proceso == 'RECIBO INGRESO') //Recibo de ingresos
			{

				//Array que se utiliza para asignar los datos de las tasas de IEPS
				$arrIEPS = array();
				//Array que se utiliza para asignar los datos de los clientes
				$arrClientes = array();
				//Variable que se utiliza para acumular el importe de IVA 16%
				$numSubtotalIVA16 = 0;
				//Variable que se utiliza para acumular el importe de IVA 0%
				$numSubtotalIVA0 = 0;

			    //------------------------------------------------------------------------------------------------------------------------
				//---------- DETALLES DE LA REFERENCIA 
				//------------------------------------------------------------------------------------------------------------------------
				//Seleccionar los detalles del registro
			    $otdDetalles = $this->anticipos->buscar_detalles_poliza($intReferenciaID, 	
			    														$strTipoReferencia);



			    //Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{

					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrMov)
					{
						//Si existe importe de IEPS
						if ($arrMov->ieps > 0)
						{
							//Agregar datos al array
							array_push($arrIEPS, array('TasaID' => $arrMov->tasa_cuota_ieps, 
													   'TasaIEPS' => $arrMov->TasaIEPS,
													   'Importe' => $arrMov->ieps));
						}

						//Si existe importe de IVA
						if ($arrMov->iva > 0)
						{
							$numSubtotalIVA16 += $arrMov->precio;
						}
						else
						{
							$numSubtotalIVA0 += $arrMov->precio;
						}

					    //Seleccionar facturas del recibo de ingreso
					    $otdFraRecibo = $this->notas->buscar_factura_poliza($arrMov->referencia_id, 	
		    															  	 $arrMov->referencia, 
		    															  	 $otdIngreso->Proceso);

					    //Array que se utiliza para asignar los datos de los impuestos
					    $arrImpuesto = array();
					    //Variable que se utiliza para asignar la descripción del módulo
						$strModulo = '';
						//Variable que se utiliza para acumular el subtotal
						$numSubtotal = 0;
						$intTasaIVA = 0;
						//Variable que se utiliza para acumular el importe de IVA
						$numIVA = 0;
						$intTasaIEPS = NULL;
						//Variable que se utiliza para acumular el importe de IEPS
						$numIEPS = 0;
						//Variable que se utiliza para acumular el subtotal
						$numSubtotalGeneral = 0;
						//Variable que se utiliza para acumular el importe de IVA
						$numIVAGeneral = 0;
						//Variable que se utiliza para acumular el importe de IEPS
						$numIEPSGeneral = 0;

						//Verificar si existe información de las facturas 
						if ($otdFraRecibo) 
						{
							//Recorremos el arreglo 
							foreach ($otdFraRecibo as $arrDet)
							{

								//Dependiendo de la referencia asignar módulo
								if ($arrMov->referencia == 'MAQUINARIA')
								{
									if ($arrDet->CodDes == 'TRASLADO/MAQAGRIC')
									{
										$arrDet->Modulo = 'MAQUINARIA';
									}
									else if ($arrDet->CodDes == 'TRASLADO/MAQCONST')
									{
										$arrDet->Modulo = 'CONSTRUCCION';
									}
									else
									{
										//Concatenar datos para realizar la búsqueda del departamento
				    					$strCriteriosBusq = $arrDet->Modulo.'|CUENTAS POR COBRAR';
										//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
										$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

										//Si existen datos del departamento (cuenta de línea de maquinaria)
										if($otdConfDepto)
										{
											//Asignar cuenta del departamento
											$arrDet->Modulo = $otdConfDepto->cuenta;

										}
										else
									    {
									    	//Asignar mensaje de error
											$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																			(línea de maquinaria).';
											$this->ARR_DATOS['strError'] .= '<br>';
									    }
									}
								}



								//Si se cumple la sentencia
								if ((($arrDet->Modulo <> $strModulo) && 
									 ($strModulo <> '')) OR 
									(($arrDet->tasa_cuota_iva <> $intTasaIVA)) OR 
									(($arrDet->tasa_cuota_ieps <> $intTasaIEPS)))
								{

									//Si existe modulo
									if($strModulo <> '')
									{
										//Agregar datos al array
										array_push($arrImpuesto, array('Modulo' => $strModulo, 
																	   'Subtotal' => $numSubtotal, 
																	   'TasaCuotaIVA' => $intTasaIVA, 
																	   'IVA' => $numIVA, 
																	   'TasaCuotaIEPS' => $intTasaIEPS, 
																	   'IEPS' => $numIEPS));

									}
									
									//Inicializar valores
									$numSubtotal = 0;
									$numIVA = 0;
									$numIEPS = 0;
								}


								

								//Asignar módulo de la factura
								$strModulo = $arrDet->Modulo;
								//Incrementar acumulados
								$numSubtotal += $arrDet->Subtotal;
								$intTasaIVA = $arrDet->tasa_cuota_iva;
								$numIVA += $arrDet->IVA;
								$intTasaIEPS = $arrDet->tasa_cuota_ieps;
								$numIEPS += $arrDet->IEPS;
								$numSubtotalGeneral += $arrDet->Subtotal;
								$numIVAGeneral += $arrDet->IVA;
								$numIEPSGeneral += $arrDet->IEPS;


							}//Cierre de foreach facturas

						}//Cierre de verificación de facturas


						//Agregar datos al array
						array_push($arrImpuesto, array('Modulo' => $strModulo, 
													   'Subtotal' => $numSubtotal, 
													   'TasaCuotaIVA' => $intTasaIVA, 
													   'IVA' => $numIVA, 
													   'TasaCuotaIEPS' => $intTasaIEPS, 
													   'IEPS' => $numIEPS));
						

						//Asignar valores
						$numSaldo = $arrMov->precio;
						$numSaldoIVA = $arrMov->iva;
						$numSaldoIEPS = $arrMov->ieps;


						//Hacer recorrido para obtener impuestos
						foreach($arrImpuesto as $objImpuesto)
						{


							//Si se cumple la sentencia
							if (($numSaldo > 0) &&
								($objImpuesto['TasaCuotaIVA'] == $arrMov->tasa_cuota_iva) &&
								($objImpuesto['TasaCuotaIEPS'] == $arrMov->tasa_cuota_ieps))
							{
								$strConcepto = 'INGRESO POR PAGO CLIENTE '.$objImpuesto['Modulo'];

								if (round(($numSaldo + $numSaldoIVA + $numSaldoIEPS), 5) >= 
									round(($objImpuesto['Subtotal'] + $objImpuesto['IVA'] + $objImpuesto['IEPS']), 5))
								{
									//Agregar datos al array
									array_push($arrClientes, array('Modulo' => $objImpuesto['Modulo'], 
																   'Subtotal' => $objImpuesto['Subtotal'], 
																   'TasaCuotaIVA' => $objImpuesto['TasaCuotaIVA'], 
																   'IVA' => $objImpuesto['IVA'], 
																   'TasaCuotaIEPS' => $objImpuesto['TasaCuotaIEPS'], 
																   'IEPS' => $objImpuesto['IEPS']));
								}
								else
								{
									//Agregar datos al array
									array_push($arrClientes, array('Modulo' => $objImpuesto['Modulo'], 
																   'Subtotal' => $numSaldo, 
																   'TasaCuotaIVA' => $objImpuesto['TasaCuotaIVA'], 
																   'IVA' => $numSaldoIVA, 
																   'TasaCuotaIEPS' => $objImpuesto['TasaCuotaIEPS'], 
																   'IEPS' => $numSaldoIEPS));
								}


								$numSaldo -= $objImpuesto['Subtotal'];
								$numSaldoIVA -= $objImpuesto['IVA'];
								$numSaldoIEPS -= $objImpuesto['IEPS'];
							}
						}


					}//Cierre de foreach detalles

				}//Cierre de verificación de detalles


				//Calcular importe
				$intImporte = ($otdIngreso->subtotal + $otdIngreso->IVA + $otdIngreso->IEPS);

				
				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdIngreso->sucursal_id);
				$strCuentaContable = '';
				//Si hay información de la cuenta contable
				if($otdConfContable)
				{
					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;
					/****Caja***/
					//Datos de la caja
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->strPrimerNivel = '101';
					$objCuenta->strSegundoNivel = $strCuentaContable;
					$objCuenta->strTercerNivel = '02';
					$objCuenta->strCuartoNivel = '00000';
					//Hacer un llamado a la función para obtener los datos de la cuenta
					$arrCuenta = $this->get_cuenta($objCuenta);
					$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
					$arrAuxiliar['naturaleza'] = 'CARGO';
					$arrAuxiliar['referencia'] = '';
					$arrAuxiliar['concepto'] = '';
					//Si existe id de la cuenta
					if ($arrAuxiliar['cuenta_id'] > 0)
					{
						//Agregar datos al array
						array_push($arrDetalles, $arrAuxiliar);
						//Incrementar renglón
						$intRenglon++;
					}

					//Si existe importe de IVA por trasladar
					if ($otdIngreso->IVA > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '209';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($otdIngreso->IVA, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}

					/******IEPS******/
					//Hacer recorrido para obtener IEPS  por trasladar
					foreach($arrIEPS as $objIEPS)
					{
						 //Hacer un llamado al método para comprobar la existencia de la configuración del ieps
					    $otdConfIeps = $this->config_polizas->buscar_configuracion_ieps(NULL, $objIEPS['TasaID']);

					     //Si existen datos de la tasa (cuenta de la tasa de IEPS)
						if($otdConfIeps)
						{
							//Datos del IEPS
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '209';
							$objCuenta->strSegundoNivel = '02';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = $otdConfIeps->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($objIEPS['Importe'], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}
						else
					    {
					    	//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la tasa de IEPS (por trasladar): ';
							$this->ARR_DATOS['strError'] .=  $objIEPS['TasaIEPS'];
							$this->ARR_DATOS['strError'] .= '<br>';
					    }

					}//Cierre de foreach IEPS

					
					/******Clientes******/
					//Hacer recorrido para obtener clientes
					foreach($arrClientes as $objCliente)
					{

						//Variable que se utiliza para asignar descripción del modulo
						$strModuloCte = $objCliente['Modulo'];

						//Variable que se utiliza para asignar la descripción de la Tasa de IVA
						$strTasaIVA = "";


						//Datos del cliente
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '105';
						$objCuenta->strSegundoNivel = $strCuentaContable;

						//Si existe importe de IVA
						if ($objCliente['IVA'] > 0)
						{
							//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
							$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA16', $strModuloCte);
							$strTasaIVA = ' 16%';

							
						}
						else
						{
							//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
							$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA0', $strModuloCte);
							$strTasaIVA = '0%';
						}

						//Si existen datos del departamento (cuenta del módulo)
						if($otdConfModulo)
						{
							$objCuenta->strTercerNivel = $otdConfModulo->cuenta;
							$objCuenta->strCuartoNivel = $otdIngreso->codigo;
							$objCuenta->strDescripcion = $otdIngreso->razon_social;
							$objCuenta->strNaturaleza = NULL;
							$objCuenta->strTipoCuenta = NULL;
							$objCuenta->strAceptaMovimientos = 'SI';
							$objCuenta->strMovimientosBancarios  = 'NO';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];

							//Calcular importe
							$intImporte = ($objCliente['Subtotal'] + $objCliente['IVA'] + $objCliente['IEPS']);

							
							//Si se cumple la sentencia
							if (($numSaldo + $numSaldoIVA + $numSaldoIEPS) > 0)
							{
								$objCliente['Subtotal'] += ($numSaldo + $numSaldoIVA + $numSaldoIEPS);
								$numSaldo = 0;
								$numSaldoIVA = 0;
								$numSaldoIEPS = 0;
								$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');


							}
							else
							{
								$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
							}
							
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}
						else
						{
							//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo (cliente TASA '.$strTasaIVA.'):  
															  '.$strModuloCte;
							$this->ARR_DATOS['strError'] .= '<br>';
						}

					}//Cierre de foreach clientes

					//Si existe importe de IVA trasladado cobrado
					if ($otdIngreso->IVA > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '208';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($otdIngreso->IVA, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}

					
					/******IEPS******/
					//Hacer recorrido para obtener IEPS  trasladado cobrado
					foreach($arrIEPS as $objIEPS)
					{

						 //Hacer un llamado al método para comprobar la existencia de la configuración del ieps
					    $otdConfIeps = $this->config_polizas->buscar_configuracion_ieps(NULL, $objIEPS['TasaID']);

					      //Si existen datos de la tasa (cuenta de la tasa de IEPS)
						if($otdConfIeps)
						{
							//Datos del IEPS
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '208';
							$objCuenta->strSegundoNivel = '02';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = $otdConfIeps->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($objIEPS['Importe'], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}
						else
					    {
					    	//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la tasa de IEPS (trasladado cobrado): ';
							$this->ARR_DATOS['strError'] .=  $objIEPS['TasaIEPS'];
							$this->ARR_DATOS['strError'] .= '<br>';
					    }


					}//Cierre de foreach IEPS

					/****Contracuenta ingresos IVA***/
					//Datos de la contracuenta
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->strPrimerNivel = '899';
					$objCuenta->strSegundoNivel = '01';
					$objCuenta->strTercerNivel = $strCuentaContable;
					$objCuenta->strCuartoNivel = '01000';
					//Hacer un llamado a la función para obtener los datos de la cuenta
					$arrCuenta = $this->get_cuenta($objCuenta);
					$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					$arrAuxiliar['importe'] = number_format($otdIngreso->subtotal, 5, '.', '');
					$arrAuxiliar['naturaleza'] = 'CARGO';
					$arrAuxiliar['referencia'] = '';
					$arrAuxiliar['concepto'] = '';
					//Si existe id de la cuenta
					if ($arrAuxiliar['cuenta_id'] > 0)
					{
						//Agregar datos al array
						array_push($arrDetalles, $arrAuxiliar);
						//Incrementar renglón
						$intRenglon++;
					}


					/****Contracuenta ingresos IVA 16%***/
					if ($numSubtotalIVA16 > 0)
					{

						//Datos de la contracuenta
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '899';
						$objCuenta->strSegundoNivel = '02';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '01000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numSubtotalIVA16, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}

					
					/****Contracuenta ingresos IVA 0%***/
					if ($numSubtotalIVA0 > 0)
					{
						//Datos de la contracuenta
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '899';
						$objCuenta->strSegundoNivel = '02';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '02000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numSubtotalIVA0, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}

				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}


			}
			else if ($otdIngreso->Proceso == 'RECEPCION PAGO') //Pagos
			{

				//Array que se utiliza para asignar los datos de las tasas de IEPS
				$arrIEPS = array();
				//Array que se utiliza para asignar los datos de los clientes
				$arrClientes = array();
				//Variable que se utiliza para acumular el importe de IVA 16%
				$numSubtotalIVA16 = 0;
				//Variable que se utiliza para acumular el importe de IVA 0%
				$numSubtotalIVA0 = 0;
				//Variable que se utiliza para acumular el importe de IVA
				$numTotalIVA = 0;
				//Constante para identificar los datos del SAT correspondientes al IVA 16%
				$intTasaCuotaIDIva = SAT_TASA_CUOTA_IVA_ID;
				//Constante para identificar los datos del SAT correspondientes al IVA cero
				$intTasaCuotaIDIvaCero = SAT_TASA_CUOTA_IVA_CERO_ID;


				 //------------------------------------------------------------------------------------------------------------------------
				//---------- DETALLES DE LA REFERENCIA 
				//------------------------------------------------------------------------------------------------------------------------
				//Seleccionar los detalles del registro
			    $otdDetalles = $this->anticipos->buscar_detalles_poliza($intReferenciaID, 	
			    														$strTipoReferencia);


				//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{

					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrMov)
					{

						//Seleccionar facturas del pago
					    $otdFraPago = $this->notas->buscar_factura_poliza($arrMov->referencia_id, 	
		    															  $arrMov->tipo_referencia);

					     //Array que se utiliza para asignar los datos de los impuestos
					    $arrImpuesto = array();
					    //Variable que se utiliza para asignar la descripción del módulo
						$strModulo = '';
						//Variable que se utiliza para acumular el subtotal
						$numSubtotal = 0;
						$intTasaIVA = 0;
						//Variable que se utiliza para acumular el importe de IVA
						$numIVA = 0;
						$intTasaIEPS = 0;
						//Variable que se utiliza para asignar el porcentaje del impuesto de IEPS
						$intPorcTasaIEPS = 0;
						//Variable que se utiliza para acumular el importe de IEPS
						$numIEPS = 0;
						//Variable que se utiliza para acumular el subtotal
						$numSubtotalGeneral = 0;
						//Variable que se utiliza para acumular el importe de IVA general
						$numIVAGeneral = 0;
						//Variable que se utiliza para acumular el importe de IEPS general
						$numIEPSGeneral = 0;

						//Verificar si existe información de las facturas 
						if ($otdFraPago) 
						{
							//Recorremos el arreglo 
							foreach ($otdFraPago as $arrDet)
							{

								//Dependiendo de la referencia asignar módulo
								if ($arrMov->tipo_referencia == 'MAQUINARIA')
								{
									if ($arrDet->CodDes == 'TRASLADO/MAQAGRIC')
									{
										$arrDet->Modulo = 'MAQUINARIA';
									}
									else if ($arrDet->CodDes == 'TRASLADO/MAQCONST')
									{
										$arrDet->Modulo = 'CONSTRUCCION';
									}
									else
									{

										//Concatenar datos para realizar la búsqueda del departamento
				    					$strCriteriosBusq = $arrDet->Modulo.'|CUENTAS POR COBRAR';
										//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
										$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

										//Si existen datos del departamento (cuenta de línea de maquinaria)
										if($otdConfDepto)
										{
											//Asignar cuenta del departamento
											$arrDet->Modulo = $otdConfDepto->cuenta;

										}
										else
									    {
									    	//Asignar mensaje de error
											$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																			(línea de maquinaria).';
											$this->ARR_DATOS['strError'] .= '<br>';
									    }
									}
								}




								//Si se cumple la sentencia
								if ((($arrDet->Modulo <> $strModulo) && 
									 ($strModulo <> '')) OR 
									 (($arrDet->tasa_cuota_iva <> $intTasaIVA) && 
									 ($intTasaIVA <> 0)) OR 
									 (($arrDet->tasa_cuota_ieps <> $intTasaIEPS) && 
									 ($intTasaIEPS <> 0)))
								{

									
									//Agregar datos al array
									array_push($arrImpuesto, array('Modulo' => $strModulo, 
																   'Subtotal' => $numSubtotal, 
																   'TasaCuotaIVA' => $intTasaIVA, 
																   'IVA' => $numIVA, 
																   'TasaCuotaIEPS' => $intTasaIEPS, 
																   'PorcTasaCuotaIEPS' => $intPorcTasaIEPS, 
																   'IEPS' => $numIEPS));
									
									//Inicializar valores
									$numSubtotal = 0;
									$numIVA = 0;
									$numIEPS = 0;
								}



								//Asignar módulo de la factura
								$strModulo = $arrDet->Modulo;

								//Incrementar acumulados
								$numSubtotal += $arrDet->Subtotal;
								$intTasaIVA = $arrDet->tasa_cuota_iva;
								$numIVA += $arrDet->IVA;
								$intTasaIEPS =  (($arrDet->tasa_cuota_ieps !== '') ? 
												 $arrDet->tasa_cuota_ieps : 0);

								$intPorcTasaIEPS = (($arrDet->tasa_cuota_ieps !== '') ? 
												 	$arrDet->porcentaje_ieps : 0);

								$numIEPS += $arrDet->IEPS;

								$numSubtotalGeneral += $arrDet->Subtotal;
								$numIVAGeneral += $arrDet->IVA;
								$numIEPSGeneral += $arrDet->IEPS;


							}//Cierre de foreach facturas

						}//Cierre de verificación de facturas


						//Si se cumple la sentencia
						if (($strModulo <> '') OR ($intTasaIVA <> 0) OR ($intTasaIEPS <> 0))
						{


							//Agregar datos al array
							array_push($arrImpuesto, array('Modulo' => $strModulo, 
														   'Subtotal' => $numSubtotal, 
														   'TasaCuotaIVA' => $intTasaIVA, 
														   'IVA' => $numIVA, 
														   'TasaCuotaIEPS' => $intTasaIEPS, 
														   'PorcTasaCuotaIEPS' => $intPorcTasaIEPS, 
														   'IEPS' => $numIEPS));
						}

						//Asignar valores
						$numSaldo = $arrMov->imp_pagado;

						//Hacer recorrido para obtener impuestos
						foreach($arrImpuesto as $objImpuesto)
						{
							//Si se cumple la sentencia
							if ($numSaldo > 0)
							{
								$strConcepto = 'INGRESO POR PAGO CLIENTE '.$objImpuesto['Modulo'];

								
								//Si se cumple la sentencia
								if (round($numSaldo, 5) >= round(($objImpuesto['Subtotal'] + $objImpuesto['IVA'] + $objImpuesto['IEPS']), 5))
								{

								 	

									//Si existe importe de IEPS
									if ($objImpuesto['IEPS'] > 0)
									{
										//Agregar datos al array
										array_push($arrIEPS, array('TasaID' => $objImpuesto['TasaCuotaIEPS'], 
																    'Importe' => $objImpuesto['IEPS']));
									}

									//Si existe importe de IVA
									if ($objImpuesto['IVA'] > 0)
									{
										$numSubtotalIVA16 += $objImpuesto['Subtotal'];
										$numTotalIVA += $objImpuesto['IVA'];
									}
									else
									{
										$numSubtotalIVA0 += $objImpuesto['Subtotal'];
									}

									//Agregar datos al array
									array_push($arrClientes, array('Modulo' => $objImpuesto['Modulo'], 
																   'Subtotal' => $objImpuesto['Subtotal'], 
																   'TasaCuotaIVA' => $objImpuesto['TasaCuotaIVA'], 
																   'IVA' => $objImpuesto['IVA'], 
																   'TasaCuotaIEPS' => $objImpuesto['TasaCuotaIEPS'], 
																   'IEPS' => $objImpuesto['IEPS']));
								}
								else
								{
									//Inicializar valores
									$numSaldoIVA = 0;
									$numSaldoIEPS = 0;
									//Variable que se utiliza para asignar porcentaje del impuesto que se va a desglosar
								  	 $intPorcentajeDesglose = 0;
								  	 $numTmp = $numSaldo;
								  	

									//Si existe importe de IEPS
									if ($objImpuesto['IEPS'] > 0  OR $objImpuesto['TasaCuotaIVA'] == $intTasaCuotaIDIva)

									{

										if($objImpuesto['TasaCuotaIVA'] == $intTasaCuotaIDIva)
										{
										    //Incremetar porcentaje de impuestos para su desglose
		        							$intPorcentajeDesglose += 0.16;
										}
									

		        						if ($objImpuesto['IEPS'] > 0)
		        						{
		        							$intPorcentajeDesglose += $objImpuesto['PorcTasaCuotaIEPS'];
		        						}


		        						
		        						$intPorcentajeDesglose +=1;


		        						//Calcular precio de la referencia (desglosar IVA y/o IEPS)
	                					$numTmp =  round(($numSaldo/$intPorcentajeDesglose), 2);
										
									}


									//Si existen impuestos con tasa de IVA del 16%
									if ($objImpuesto['TasaCuotaIVA'] == $intTasaCuotaIDIva)
									{

										//$numTmp = round(($numSaldo/1.16), 2);
										$numSaldoIVA = round(($numTmp * 0.16), 4);
										$numSaldo = ($numSaldo-$numSaldoIVA);

										$numSubtotalIVA16 += $numSaldo;
										$numTotalIVA += $numSaldoIVA;


									}
									/*else if ($objImpuesto['TasaCuotaIEPS'] > 0)
									{
									   //Asignar mensaje de error
										$this->ARR_DATOS['strError'] .= 'Impuesto de IEPS: '.$objImpuesto['TasaCuotaIEPS'];
										$this->ARR_DATOS['strError'] .= '<br>';
									}*/
									else
									{
										$numSubtotalIVA0 += $numSaldo;
									}

									//Si existe importe de IEPS
									if ($objImpuesto['IEPS'] > 0)
									{
										$numSaldoIEPS = round(($numTmp * $objImpuesto['PorcTasaCuotaIEPS']), 4);
										$numSaldo = ($numSaldo-$numSaldoIEPS);

										if($numSubtotalIVA16 > 0)
										{
											$numSubtotalIVA16 -= $numSaldoIEPS;
										}
										

										if($numSubtotalIVA0 > 0)
										{
											$numSubtotalIVA0 -= $numSaldoIEPS;
										}

										array_push($arrIEPS, array('TasaID' => $objImpuesto['TasaCuotaIEPS'], 
																   'Importe' => $numSaldoIEPS));
									}

									//Agregar datos al array
									array_push($arrClientes, array('Modulo' => $objImpuesto['Modulo'], 
																   'Subtotal' => $numSaldo, 
																   'TasaCuotaIVA' => $objImpuesto['TasaCuotaIVA'], 
																   'IVA' => $numSaldoIVA, 
																   'TasaCuotaIEPS' => $objImpuesto['TasaCuotaIEPS'], 
																   'IEPS' => $numSaldoIEPS));
								}

								$numSaldo -= $objImpuesto['Subtotal'];
								$numSaldo -= $objImpuesto['IVA'];
								$numSaldo -= $objImpuesto['IEPS'];
							}
						}

					}//Cierre de foreach detalles

				}//Cierre de verificación de detalles


				//Calcular importe
				$intImporte = ($otdIngreso->subtotal + $otdIngreso->IVA + $otdIngreso->IEPS);

				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($otdIngreso->sucursal_id);
				$strCuentaContable = '';
				//Si hay información de la cuenta contable
				if($otdConfContable)
				{
					//Asignar cuenta contable
					$strCuentaContable =  $otdConfContable->cuenta_contable;

					//Dependiendo de la forma de pago agregar cuenta
					if ($otdIngreso->forma_pago_id == FORMA_PAGO_COMPENSACION) //Compensación
					{
						
						/****Compensación***/
						//Datos de la compensación
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '101';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '05';
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}
					else
					{
					
						/****Caja***/
						//Datos de la caja
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '101';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						$objCuenta->strTercerNivel = '02';
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
						
					}

					//Si existe importe de IVA por trasladar
					if ($numTotalIVA > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '209';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numTotalIVA, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}


					/******IEPS******/
					//Hacer recorrido para obtener IEPS  por trasladar
					foreach($arrIEPS as $objIEPS)
					{

					 //Hacer un llamado al método para comprobar la existencia de la configuración del ieps
					    $otdConfIeps = $this->config_polizas->buscar_configuracion_ieps(NULL, $objIEPS['TasaID']);

					   
					   //Si existen datos de la tasa (cuenta de la tasa de IEPS)
						if($otdConfIeps)
						{
							//Datos del IEPS
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '209';
							$objCuenta->strSegundoNivel = '02';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = $otdConfIeps->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($objIEPS['Importe'], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}
						else
					    {
					    	//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la tasa de IEPS (por trasladar): ';
							$this->ARR_DATOS['strError'] .=  $objIEPS['TasaID'];
							$this->ARR_DATOS['strError'] .= '<br>';
					    }

					}//Cierre de foreach IEPS


					/******Clientes******/
					//Hacer recorrido para obtener clientes
					foreach($arrClientes as $objCliente)
					{

						//Variable que se utiliza para asignar descripción del modulo
						$strModuloCte = $objCliente['Modulo'];

						//Variable que se utiliza para asignar la descripción de la Tasa de IVA
						$strTasaIVA = "";

						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->intCuentaPadreID = NULL;
						$objCuenta->intSatCuentaID = NULL;
						$objCuenta->strPrimerNivel = '105';
						$objCuenta->strSegundoNivel = $strCuentaContable;
						//Si existe importe de IVA
						if ($objCliente['IVA'] > 0)
						{
							//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
							$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA16', $strModuloCte);
							$strTasaIVA = ' 16%';

							
						}
						else
						{
							//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
							$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA0', $strModuloCte);
							$strTasaIVA = '0%';
						}

						//Si existen datos del departamento (cuenta del módulo)
						if($otdConfModulo)
						{
							$objCuenta->strTercerNivel = $otdConfModulo->cuenta;
							$objCuenta->strCuartoNivel = $otdIngreso->codigo;
							$objCuenta->strDescripcion = $otdIngreso->razon_social;
							$objCuenta->strNaturaleza = NULL;
							$objCuenta->strTipoCuenta = NULL;
							$objCuenta->strAceptaMovimientos = 'SI';
							$objCuenta->strMovimientosBancarios  = 'NO';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta =  $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];

							//Calcular importe
							$intImporte = ($objCliente['Subtotal'] + $objCliente['IVA'] + $objCliente['IEPS']);

							//Si se cumple la sentencia
							if ($numSaldo > 0)
							{
								$objCliente['Subtotal'] += $numSaldo;
								$numSaldo = 0;
								$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
							}
							else
							{
								$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');	
							}
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						}
						else
						{
							//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo (cliente TASA '.$strTasaIVA.'):  
															  '.$strModuloCte;
							$this->ARR_DATOS['strError'] .= '<br>';
						}

					}//Cierre de foreach clientes


					//Si existe importe de IVA trasladado cobrado
					if ($numTotalIVA > 0)
					{
						//Datos del IVA
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '208';
						$objCuenta->strSegundoNivel = '01';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numTotalIVA, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}

					/******IEPS******/
					//Hacer recorrido para obtener IEPS  trasladado cobrado
					foreach($arrIEPS as $objIEPS)
					{

						 //Hacer un llamado al método para comprobar la existencia de la configuración del ieps
						 $otdConfIeps = $this->config_polizas->buscar_configuracion_ieps(NULL, $objIEPS['TasaID']);

					    //Si existen datos de la tasa (cuenta de la tasa de IEPS)
						if($otdConfIeps)
						{
							//Datos del IEPS
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '208';
							$objCuenta->strSegundoNivel = '02';
							$objCuenta->strTercerNivel = $strCuentaContable;
							$objCuenta->strCuartoNivel = $otdConfIeps->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($objIEPS['Importe'], 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}
						else
					    {
					    	//Asignar mensaje de error
							$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la tasa de IEPS (trasladado cobrado): ';
							$this->ARR_DATOS['strError'] .=  $objIEPS['TasaID'];
							$this->ARR_DATOS['strError'] .= '<br>';
					    }

					}//Cierre de foreach IEPS

					/****Contracuenta ingresos IVA***/
					//Datos de la contracuenta
					$arrAuxiliar['renglon'] = $intRenglon;
					//Crear un objeto vacio, stdClass es el objeto Cuenta
					$objCuenta = new stdClass();
					$objCuenta->strPrimerNivel = '899';
					$objCuenta->strSegundoNivel = '01';
					$objCuenta->strTercerNivel = $strCuentaContable;
					$objCuenta->strCuartoNivel = '01000';
					//Hacer un llamado a la función para obtener los datos de la cuenta
					$arrCuenta = $this->get_cuenta($objCuenta);
					$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
					$arrAuxiliar['importe'] = number_format(($numSubtotalIVA16 + $numSubtotalIVA0), 5, '.', '');
					$arrAuxiliar['naturaleza'] = 'CARGO';
					$arrAuxiliar['referencia'] = '';
					$arrAuxiliar['concepto'] = '';
					//Si existe id de la cuenta
					if ($arrAuxiliar['cuenta_id'] > 0)
					{
						//Agregar datos al array
						array_push($arrDetalles, $arrAuxiliar);
						//Incrementar renglón
						$intRenglon++;
					}


					/****Contracuenta ingresos IVA 16%***/
					if ($numSubtotalIVA16 > 0)
					{
						//Datos de la contracuenta
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '899';
						$objCuenta->strSegundoNivel = '02';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '01000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numSubtotalIVA16, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}

					/****Contracuenta ingresos IVA 0%***/
					if ($numSubtotalIVA0 > 0)
					{
						//Datos de la contracuenta
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '899';
						$objCuenta->strSegundoNivel = '02';
						$objCuenta->strTercerNivel = $strCuentaContable;
						$objCuenta->strCuartoNivel = '02000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numSubtotalIVA0, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'ABONO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}
					}


				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

				
				//Si existe id de la cuenta bancaria
				if($otdIngreso->cuenta_bancaria_id > 0)
				{
					//Hacer un llamado al método para comprobar la existencia de la configuración de la cuenta bancaria 
					$otdConfCtaBancariaUsd = $this->config_polizas->buscar_configuracion_cuentas_bancarias(NULL, $otdIngreso->cuenta_bancaria_id, 'USD');
					
					//Si existen datos de la cuenta bancaria
					if($otdConfCtaBancariaUsd)
					{
						//Cuentas de orden moneda extranjera
						if ($otdIngreso->moneda_id <> MONEDA_BASE)
						{
							//Calcular importe
							$intImporte = (($otdIngreso->subtotal + $otdIngreso->IVA + $otdIngreso->IEPS)/$otdIngreso->tipo_cambio);

							/****Contracuenta dólares***/
							//Datos de la contracuenta
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '899';
							$objCuenta->strSegundoNivel = '01';
							$objCuenta->strTercerNivel = '01';
							$objCuenta->strCuartoNivel = $otdConfCtaBancariaUsd->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

							/****Contracuenta dólares***/
							//Datos de la contracuenta
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '899';
							$objCuenta->strSegundoNivel = '02';
							$objCuenta->strTercerNivel = '01';
							$objCuenta->strCuartoNivel = $otdConfCtaBancariaUsd->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($intImporte, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}
						}

					} //Cierre de verificación de cuenta (cuenta bancaria extranjera)

				}//Cierre de verificación de cuenta bancaria


			}
			else //Traspaso de caja a bancos
			{

				//Array que se utiliza para asignar los datos de los pagos (ingresos)
				$arrPagos = array();
				//Array que se utiliza para agregar los datos de un  pago (ingreso)
				$arrTmp = array();

				$strConcepto = 'POR TRASPASO DE CAJA A BANCOS';
				$strObservaciones = '';
				//Variable que se utiliza para acumular el importe 
				$numImporte = 0;
				//Variable que se utiliza para acumular el importe en dólares
				$numDolares = 0;

				//------------------------------------------------------------------------------------------------------------------------
				//---------- DETALLES DE LA REFERENCIA 
				//------------------------------------------------------------------------------------------------------------------------
				//Seleccionar los detalles del registro
			    $otdDetalles = $this->anticipos->buscar_detalles_poliza($intReferenciaID, 	
			    														$strTipoReferencia);
			   
			    //Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{

					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrMov)
					{
						//Incrementar acumulados
						$numImporte += $arrMov->importe;
						$numDolares += ($arrMov->importe/$arrMov->tipo_cambio);

						$arrTmp['sucursal_id'] = $arrMov->sucursal_id;
						$arrTmp['importe'] = $arrMov->importe;
						//Agregar datos al array
						array_push($arrPagos, $arrTmp);


					}//Cierre de foreach detalles
				
				}//Cierre de verificación de detalles

				//Si existe importe
				if ($numImporte > 0)
				{

					//Hacer un llamado al método para comprobar la existencia de la configuración de la cuenta bancaria 
					$otdConfCtaBancaria = $this->config_polizas->buscar_configuracion_cuentas_bancarias(NULL, $otdIngreso->cuenta_bancaria_id, 'BANCO');
						

					//Si existen datos de la cuenta bancaria
					if($otdConfCtaBancaria)
					{
						/****Banco***/
						//Datos del banco
						$arrAuxiliar['renglon'] = $intRenglon;
						//Crear un objeto vacio, stdClass es el objeto Cuenta
						$objCuenta = new stdClass();
						$objCuenta->strPrimerNivel = '102';
						$objCuenta->strSegundoNivel = $otdConfCtaBancaria->cuenta;
						$objCuenta->strTercerNivel = '00';
						$objCuenta->strCuartoNivel = '00000';
						//Hacer un llamado a la función para obtener los datos de la cuenta
						$arrCuenta = $this->get_cuenta($objCuenta);
						$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
						$arrAuxiliar['importe'] = number_format($numImporte, 5, '.', '');
						$arrAuxiliar['naturaleza'] = 'CARGO';
						$arrAuxiliar['referencia'] = '';
						$arrAuxiliar['concepto'] = '';
						//Si existe id de la cuenta
						if ($arrAuxiliar['cuenta_id'] > 0)
						{
							//Agregar datos al array
							array_push($arrDetalles, $arrAuxiliar);
							//Incrementar renglón
							$intRenglon++;
						}


					}//Cierre de verificación de cuenta (cuenta bancaria)

					//Hacer recorrido para obtener pagos
					foreach($arrPagos as $objPago)
					{

						//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
					 	$otdConfContable = $this->config_contable->buscar($objPago['sucursal_id']);

					  	//Si hay información de la cuenta contable
						if($otdConfContable)
						{
								/****Caja***/
								//Datos de la caja
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = '101';
								$objCuenta->strSegundoNivel = $otdConfContable->cuenta_contable;
								$objCuenta->strTercerNivel = '02';
								$objCuenta->strCuartoNivel = '00000';
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($objPago['importe'], 5, '.', '');
								$arrAuxiliar['naturaleza'] = 'ABONO';
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}
						}
						else
						{
							//Asignar mensaje de error
					 		$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la sucursal (ingreso).';
					 		$this->ARR_DATOS['strError'] .= '<br>';
						}


					}//Cierre de foreach pagos

					// Cuentas de orden moneda extranjera
					if (($otdIngreso->cuenta_bancaria_id == CUENTA_BANCARIA_BBVAUSD) OR
						($otdIngreso->cuenta_bancaria_id == CUENTA_BANCARIA_BANAMEXUSD))
					{

						//Hacer un llamado al método para comprobar la existencia de la configuración de la cuenta bancaria 
						$otdConfCtaBancariaUsd = $this->config_polizas->buscar_configuracion_cuentas_bancarias(NULL, $otdIngreso->cuenta_bancaria_id, 'USD');
						
						//Si existen datos de la cuenta bancaria
						if($otdConfCtaBancariaUsd)
						{

							/****Contracuenta dólares***/
							//Datos de la contracuenta
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '899';
							$objCuenta->strSegundoNivel = '01';
							$objCuenta->strTercerNivel = '01';
							$objCuenta->strCuartoNivel = $otdConfCtaBancariaUsd->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numDolares, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'CARGO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}


							/****Contracuenta dólares***/
							//Datos de la contracuenta
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->strPrimerNivel = '899';
							$objCuenta->strSegundoNivel = '02';
							$objCuenta->strTercerNivel = '01';
							$objCuenta->strCuartoNivel = $otdConfCtaBancariaUsd->cuenta;
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta = $this->get_cuenta($objCuenta);
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($numDolares, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

						} //Cierre de verificación de cuenta (cuenta bancaria extranjera)


					}//Cierre de verificación de cuenta bancaria


				}//Cierre de verificación de importe
				else
				{
					//Asignar No para evitar guardar póliza sin importes
					$strAgregar = 'NO';
				}

			}


			//Si se cumple la sentencia guardar los datos de la póliza
			if($strAgregar  == 'SI')
			{
				//Asignar datos de la póliza
				$objPoliza->intSucursalID =  $otdIngreso->sucursal_id;
				$objPoliza->strTipo = 'INGRESO';
				$objPoliza->strModulo = $otdIngreso->Modulo;
				$objPoliza->strProceso =  $otdIngreso->Proceso;
				$objPoliza->intReferenciaID = $otdIngreso->ID;
				$objPoliza->dteFecha = $otdIngreso->fecha;
				$objPoliza->strConcepto = $strConcepto;
				$objPoliza->strObservaciones = $strObservaciones;
				$objPoliza->strEstatus = 'ACTIVO';;
				$objPoliza->arrDetalles = $arrDetalles;

				//Hacer un llamado a la función para guardar los datos de la póliza en la BD
				$this->guardar_poliza_referencia($objPoliza, $intProcesoMenuID);

			}
			


		}//Cierre de verificación de información

		
		//Si se cumple la sentencia significa que la forma de pago de los detalles del pago (RECEPCIÓN DE PAGO/ TRASPASO BANCOS)
       	//corresponde es diferente a la consultada
       	if(!$otdIngreso OR $strAgregar == 'NO')
       	{

       		//Indicar mensaje de error (no se genera la póliza porque no se cumplen con las restricciones / no existe información del registro)
			$this->ARR_DATOS['strError'] = MSJ_ERROR_POLIZA;
       	}


	}



	//Método para generar una póliza con los datos de la póliza de abono,  pago, etc.
	public function get_poliza_aplicacion($intReferenciaID, $strTipoReferencia, $intProcesoMenuID)
	{
		//------------------------------------------------------------------------------------------------------------------------
		//---------- DATOS DE LA REFERENCIA 
		//------------------------------------------------------------------------------------------------------------------------
       	//Seleccionar datos del registro
       	$otdAplicacion = $this->aplicacion->buscar_referencia_poliza($intReferenciaID, $strTipoReferencia);
        

        //Verificar si hay información del registro
		if($otdAplicacion)
		{


		    //Asignar el folio de la referencia (poliza de abono/pago)
			$this->ARR_DATOS['strFolioReferencia'] = $otdAplicacion->folio;

			//Crear un objeto vacio, stdClass es el objeto Póliza
			$objPoliza = new stdClass();
			//Array que se utiliza para agregar los detalles de la póliza 
			$arrDetalles = array();
			//Array que se utiliza para agregar los datos de un detalle
			$arrAuxiliar = array();
			$arrIVA = array();
			//Variables que se utilizan para asignar datos de la póliza
			$strConcepto = '';
			$strObservaciones = '';
			//Variables que se utilizan para asignar datos del detalle
			$intRenglon = 1;

			//------------------------------------------------------------------------------------------------------------------------
			//---------- DETALLES DE LA REFERENCIA 
			//------------------------------------------------------------------------------------------------------------------------
			//Seleccionar los detalles del registro
		    $otdDetalles = $this->aplicacion->buscar_detalles_poliza($intReferenciaID, 	
		    														$strTipoReferencia);


			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL REGISTRO 
	        //------------------------------------------------------------------------------------------------------------------------
		    //Dependiendo del proceso generar póliza
		    if ($otdAplicacion->Proceso == 'POLIZA ABONO') //Pólizas de abono
			{

				//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrMov)
					{

						//Seleccionar facturas del registro
					    $otdFra = $this->notas->buscar_factura_poliza($arrMov->referencia_id, 	
		    														  $arrMov->referencia);

					    //Variable que se utiliza para asignar la descripción del módulo
					    $strModulo = '';
					    //Variable que se utiliza para asignar la cuenta contable de la sucursal
					    $strSucursal = '';

					    //Verificar si existe información de las facturas 
						if ($otdFra) 
						{

							//Recorremos el arreglo 
							foreach ($otdFra as $arrDet)
							{

								//Si se cumple la sentencia
								if (($arrMov->tasa_cuota_iva == $arrDet->tasa_cuota_iva) &&
									($arrMov->tasa_cuota_ieps == $arrDet->tasa_cuota_ieps))
								{
									$strModulo = $arrDet->Modulo;

									//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
					 				$otdConfContable = $this->config_contable->buscar($arrDet->sucursal_id);


					 				//Si hay información de la cuenta contable
									if($otdConfContable)
									{
										//Asignar cuenta contable
					 					$strSucursal = $otdConfContable->cuenta_contable;
					 				}


									//Dependiendo de la referencia asignar módulo
									if ($arrMov->referencia == 'MAQUINARIA')
									{

										if ($arrDet->CodDes == 'TRASLADO/MAQAGRIC')
										{
											$strModulo = 'MAQUINARIA';
										}
										else if ($arrDet->CodDes == 'TRASLADO/MAQCONST')
										{
											$strModulo = 'CONSTRUCCION';
										}
										else
										{
											//Concatenar datos para realizar la búsqueda del departamento
					    					$strCriteriosBusq = $arrDet->Modulo.'|CUENTAS POR COBRAR';
											//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
											$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

											//Si existen datos del departamento (cuenta de línea de maquinaria)
											if($otdConfDepto)
											{
												//Asignar cuenta del departamento
												$strModulo = $otdConfDepto->cuenta;


											}
											else
										    {
										    	//Asignar mensaje de error
												$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																				(línea de maquinaria).';
												$this->ARR_DATOS['strError'] .= '<br>';
										    }

										}
									}

								}

							}//Cierre de foreach facturas	

						}//Cierre de verificación de facturas



						//Si existe cuenta contable de la sucursal
						if($strSucursal != '')
						{

							$strConcepto = 'APLICACION DE ANTICIPO CLIENTE '.$strModulo;
							$numAplicacion = ($arrMov->precio + $arrMov->iva + $arrMov->ieps);
							//Calcular  importe 
							$intImporte = ($arrMov->precio + $arrMov->iva + $arrMov->ieps);

							//Variable que se utiliza para asignar la descripción de la Tasa de IVA
							$strTasaIVA = "";

							// Asignamos los valores contables de la aplicación del anticipo
							if ($arrMov->iva > 0)
							{
								//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
								$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA16', $strModulo);
								$strTasaIVA = ' 16%';
							}
							else
							{
								//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
								$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA0', $strModulo);
								$strTasaIVA = '0%';
							}

							//Si existen datos del departamento (cuenta del módulo)
							if($otdConfModulo)
							{

								//Asignar cuenta contable
								$strModulo = $otdConfModulo->cuenta;

							}
							else
							{
								//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo (cliente TASA '.$strTasaIVA.'):  
																  '.$strModulo;
								$this->ARR_DATOS['strError'] .= '<br>';
							}

							//Seleccionar anticipos por aplicar
							$arrAnticipos = $this->get_anticipos_aplicacion($otdAplicacion->anticipo_id, $intReferenciaID, $strTipoReferencia);


							// Revisar si existen anticipos que se puedan aplicar
							foreach ($arrAnticipos as &$arrTmp) 
							{

								if (($arrTmp['Total'] > 0) && 
									($numAplicacion > 0))
								{
									

											// Anticipo 
											$arrAuxiliar['renglon'] = $intRenglon;
											//Crear un objeto vacio, stdClass es el objeto Cuenta
											$objCuenta = new stdClass();
											$objCuenta->intCuentaPadreID = NULL;
											$objCuenta->intSatCuentaID = NULL;
											$objCuenta->strPrimerNivel = '206';
											$objCuenta->strSegundoNivel = $arrTmp['Sucursal'];
											$objCuenta->strTercerNivel = $arrTmp['Modulo'];
											$objCuenta->strCuartoNivel = $otdAplicacion->codigo;
											$objCuenta->strDescripcion = $otdAplicacion->razon_social;
											$objCuenta->strNaturaleza= NULL;
											$objCuenta->strTipoCuenta = NULL;
											$objCuenta->strAceptaMovimientos = 'SI';
											$objCuenta->strMovimientosBancarios  = 'NO';
											//Hacer un llamado a la función para obtener los datos de la cuenta
											$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
											$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
											$arrAuxiliar['importe'] = number_format($numAplicacion, 5, '.', '');
											$arrAuxiliar['naturaleza'] = 'CARGO';
											$arrAuxiliar['referencia'] = '';
											$arrAuxiliar['concepto'] = '';
											//Si existe id de la cuenta
											if ($arrAuxiliar['cuenta_id'] > 0)
											{
												//Agregar datos al array
												array_push($arrDetalles, $arrAuxiliar);
												//Incrementar renglón
												$intRenglon++;
											}

											$arrTmp['Total'] -= $numAplicacion;
											$numAplicacion = 0;


											//Si es del mismo módulo sin importar la sucursal
											if ($arrTmp['Modulo'] == $strModulo && $arrTmp['Sucursal'] != $strSucursal)
											{

												// IVA
												if ($arrMov->iva > 0) 
												{
													array_push($arrIVA, array('PrimerNivel' => '209', 
																			  'SegundoNivel' => '01', 
																			  'TercerNivel' => $strSucursal, 
																			  'CuartoNivel' => '00000', 
																			  'Importe' => $arrMov->iva, 
																			  'Naturaleza' => 'CARGO'));

													array_push($arrIVA, array('PrimerNivel' => '209', 
																			  'SegundoNivel' => '01', 
																			  'TercerNivel' => $arrTmp['Sucursal'], 
																			  'CuartoNivel' => '00000', 
																			  'Importe' => $arrMov->iva, 
																			  'Naturaleza' => 'ABONO'));
												}
											}

											//Si es la misma sucursal
											if ($arrTmp['Sucursal'] == $strSucursal)
											{
												// IVA
												if (($arrMov->iva > 0) && 
													($arrTmp['IVA'] == 0))
												{
												

													array_push($arrIVA, array('PrimerNivel' => '209', 
																			  'SegundoNivel' => '01', 
																			  'TercerNivel' => $strSucursal, 
																			  'CuartoNivel' => '00000', 
																			  'Importe' => $arrMov->iva, 
																			  'Naturaleza' => 'CARGO'));

													array_push($arrIVA, array('PrimerNivel' => '208', 
																			  'SegundoNivel' => '01', 
																			  'TercerNivel' => $arrTmp['Sucursal'], 
																			  'CuartoNivel' => '00000', 
																			  'Importe' => $arrMov->iva, 
																			  'Naturaleza' => 'ABONO'));

													array_push($arrIVA, array('PrimerNivel' => '899', 
																			  'SegundoNivel' => '02', 
																			  'TercerNivel' => $strSucursal, 
																			  'CuartoNivel' => '02000', 
																			  'Importe' => $intImporte, 
																			  'Naturaleza' => 'CARGO'));

													array_push($arrIVA, array('PrimerNivel' => '899', 
																			  'SegundoNivel' => '01', 
																			  'TercerNivel' => $arrTmp['Sucursal'], 
																			  'CuartoNivel' => '01000', 
																			  'Importe' => $intImporte, 
																			  'Naturaleza' => 'ABONO'));

													array_push($arrIVA, array('PrimerNivel' => '899', 
																			  'SegundoNivel' => '01', 
																			  'TercerNivel' => $strSucursal, 
																			  'CuartoNivel' => '01000', 
																			  'Importe' => $arrMov->precio, 
																			  'Naturaleza' => 'CARGO'));

													array_push($arrIVA, array('PrimerNivel' => '899', 
																			  'SegundoNivel' => '02', 
																			  'TercerNivel' => $arrTmp['Sucursal'], 
																			  'CuartoNivel' => '01000', 
																			  'Importe' => $arrMov->precio, 
																			  'Naturaleza' => 'ABONO'));
												}
												else if (($arrMov->iva == 0) && 
														 ($arrTmp['IVA'] > 0))
												{
													array_push($arrIVA, array('PrimerNivel' => '208', 
																			  'SegundoNivel' => '01', 
																			  'TercerNivel' => $strSucursal, 
																			  'CuartoNivel' => '00000', 
																			  'Importe' => $arrMov->iva, 
																			  'Naturaleza' => 'CARGO'));

													array_push($arrIVA, array('PrimerNivel' => '209', 
																			  'SegundoNivel' => '01', 
																			  'TercerNivel' => $arrTmp['Sucursal'], 
																			  'CuartoNivel' => '00000', 
																			  'Importe' => $arrMov->iva,
																			  'Naturaleza' => 'ABONO'));

													array_push($arrIVA, array('PrimerNivel' => '899', 
																			  'SegundoNivel' => '02', 
																			  'TercerNivel' => $strSucursal, 
																			  'CuartoNivel' => '01000', 
																			  'Importe' => $intImporte, 
																			  'Naturaleza' => 'CARGO'));

													array_push($arrIVA, array('PrimerNivel' => '899', 
																			  'SegundoNivel' => '01', 
																			  'TercerNivel' => $arrTmp['Sucursal'], 
																			  'CuartoNivel' => '01000', 
																			  'Importe' => $intImporte, 
																			  'Naturaleza' => 'ABONO'));

													array_push($arrIVA, array('PrimerNivel' => '899', 
																			  'SegundoNivel' => '01', 
																			  'TercerNivel' => $strSucursal, 
																			  'CuartoNivel' => '01000', 
																			  'Importe' => $arrMov->precio, 
																			  'Naturaleza' => 'CARGO'));

													array_push($arrIVA, array('PrimerNivel' => '899', 
																			  'SegundoNivel' => '02', 
																			  'TercerNivel' => $arrTmp['Sucursal'], 
																			  'CuartoNivel' => '02000', 
																			  'Importe' => $arrMov->precio, 
																			  'Naturaleza' => 'ABONO'));
												}

											}
											
									}

							}//Cierre de foreach anticipos


							// Cliente 
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->intCuentaPadreID = NULL;
							$objCuenta->intSatCuentaID = NULL;
							$objCuenta->strPrimerNivel = '105';
							$objCuenta->strSegundoNivel = $strSucursal;
							$objCuenta->strTercerNivel = $strModulo;
							$objCuenta->strCuartoNivel = $otdAplicacion->codigo;
							$objCuenta->strDescripcion = $otdAplicacion->razon_social;
							$objCuenta->strNaturaleza= NULL;
							$objCuenta->strTipoCuenta = NULL;
							$objCuenta->strAceptaMovimientos = 'SI';
							$objCuenta->strMovimientosBancarios  = 'NO';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta =  $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format(($intImporte), 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}


							//Hacer recorrido para obtener IVAS
							foreach($arrIVA as $objIVA)
							{
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = $objIVA['PrimerNivel'];
								$objCuenta->strSegundoNivel = $objIVA['SegundoNivel'];
								$objCuenta->strTercerNivel = $objIVA['TercerNivel'];
								$objCuenta->strCuartoNivel = $objIVA['CuartoNivel'];
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta =$this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($objIVA['Importe'], 5, '.', '');
								$arrAuxiliar['naturaleza'] = $objIVA['Naturaleza'];
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

							}//Cierre de foreach IVAS

						}
						else
						{
							//Asignar mensaje de error
					 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
					 		$this->ARR_DATOS['strError'] .= '<br>';
						}



					}//Cierre de foreach detalles

				}//Cierre de verificación de detalles

			}
			else if ($otdAplicacion->Proceso == 'RECEPCION PAGO')
			{

				//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrMov)
					{
						//Seleccionar facturas del registro
					    $otdFra = $this->notas->buscar_factura_poliza($arrMov->referencia_id, 	
		    														  $arrMov->tipo_referencia);

					    //Variable que se utiliza para asignar la descripción del módulo
					    $strModulo = '';
					    //Variable que se utiliza para asignar la cuenta contable de la sucursal
						$strSucursal = '';
						$numSubtotalGeneral = 0;
						$numIVAGeneral = 0;
						$numIEPSGeneral = 0;

						//Verificar si existe información de las facturas 
						if ($otdFra) 
						{
							//Recorremos el arreglo 
							foreach ($otdFra as $arrDet)
							{
								$strModulo = $arrDet->Modulo;
								//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
					 			$otdConfContable = $this->config_contable->buscar($arrDet->sucursal_id);
				 				//Si hay información de la cuenta contable
								if($otdConfContable)
								{
									//Asignar cuenta contable
				 					$strSucursal = $otdConfContable->cuenta_contable;
				 				}

				 				//Incrementar acumulados
								$numSubtotalGeneral += $arrDet->Subtotal;
								$numIVAGeneral += $arrDet->IVA;
								$numIEPSGeneral += $arrDet->IEPS;

								//Dependiendo de la referencia asignar módulo
								if ($arrMov->tipo_referencia == 'MAQUINARIA')
								{
									if ($arrDet->CodDes == 'TRASLADO/MAQAGRIC')
									{
										$strModulo = 'MAQUINARIA';
									}
									else if ($arrDet->CodDes == 'TRASLADO/MAQCONST')
									{
										$strModulo = 'CONSTRUCCION';
									}
									else
									{

										//Concatenar datos para realizar la búsqueda del departamento
				    					$strCriteriosBusq = $arrDet->Modulo.'|CUENTAS POR COBRAR';
										//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
										$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);

										//Si existen datos del departamento (cuenta de línea de maquinaria)
										if($otdConfDepto)
										{
											//Asignar cuenta del departamento
											$strModulo = $otdConfDepto->cuenta;


										}
										else
									    {
									    	//Asignar mensaje de error
											$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																			(línea de maquinaria).';
											$this->ARR_DATOS['strError'] .= '<br>';
									    }
									}
								}


							}//Cierre de foreach facturas

						}//Cierre de verificación de facturas


						//Si existe cuenta contable de la sucursal
						if($strSucursal != '')
						{
							$strConcepto = 'APLICACION DE ANTICIPO CLIENTE '.$strModulo;
							$numAplicacion = $arrMov->imp_pagado;

							//Variable que se utiliza para asignar la descripción de la Tasa de IVA
							$strTasaIVA = "";


							// Asignamos los valores contables de la aplicación del anticipo
							if ($numIVAGeneral > 0)
							{
								//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
								$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA16', $strModulo);
								$strTasaIVA = ' 16%';
							}
							else
							{
								//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
								$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA0', $strModulo);
								$strTasaIVA = '0%';
							}

							//Si existen datos del departamento (cuenta del módulo)
							if($otdConfModulo)
							{

								//Asignar cuenta contable
								$strModulo = $otdConfModulo->cuenta;

							}
							else
							{
								//Asignar mensaje de error
								$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo (cliente TASA '.$strTasaIVA.'):  
																  '.$strModulo;
								$this->ARR_DATOS['strError'] .= '<br>';
							}



							//Seleccionar anticipos por aplicar
							$arrAnticipos = $this->get_anticipos_aplicacion($otdAplicacion->anticipo_id, $intReferenciaID, $strTipoReferencia, 
																			$otdAplicacion->renglon);



							// Revisar si existen anticipos que se puedan aplicar a la misma sucursal y módulo
							foreach ($arrAnticipos as &$arrTmp) 
							{
								if (($arrTmp['Total'] > 0) && 
									($numAplicacion > 0))
								{

									// Anticipo 
									$arrAuxiliar['renglon'] = $intRenglon;
									//Crear un objeto vacio, stdClass es el objeto Cuenta
									$objCuenta = new stdClass();
									$objCuenta->intCuentaPadreID = NULL;
									$objCuenta->intSatCuentaID = NULL;
									$objCuenta->strPrimerNivel = '206';
									$objCuenta->strSegundoNivel = $arrTmp['Sucursal'];
									$objCuenta->strTercerNivel = $arrTmp['Modulo'];
									$objCuenta->strCuartoNivel = $otdAplicacion->codigo;
									$objCuenta->strDescripcion = $otdAplicacion->razon_social;
									$objCuenta->strNaturaleza = NULL;
									$objCuenta->strTipoCuenta = NULL;
									$objCuenta->strAceptaMovimientos = 'SI';
									$objCuenta->strMovimientosBancarios  = 'NO';
									//Hacer un llamado a la función para obtener los datos de la cuenta
									$arrCuenta = $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
									$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
									$arrAuxiliar['importe'] = number_format($numAplicacion, 5, '.', '');
									$arrAuxiliar['naturaleza'] = 'CARGO';
									$arrAuxiliar['referencia'] = '';
									$arrAuxiliar['concepto'] = '';
									//Si existe id de la cuenta
									if ($arrAuxiliar['cuenta_id'] > 0)
									{
										//Agregar datos al array
										array_push($arrDetalles, $arrAuxiliar);
										//Incrementar renglón
										$intRenglon++;
									}

									$arrTmp['Total'] -= $numAplicacion;
									$numAplicacion = 0;

									//Si es del mismo módulo sin importar la sucursal
									if ($arrTmp['Modulo'] == $strModulo && $arrTmp['Sucursal'] != $strSucursal)
									{

										// IVA
										if ($numIVAGeneral > 0) 
										{
											array_push($arrIVA, array('PrimerNivel' => '209', 
																	  'SegundoNivel' => '01', 
																	  'TercerNivel' => $strSucursal, 
																	  'CuartoNivel' => '00000', 
																	  'Importe' => number_format((($arrMov->imp_pagado/1.16) * 0.16), 4, '.', ''), 
																	  'Naturaleza' => 'CARGO'));

											array_push($arrIVA, array('PrimerNivel' => '209', 
																	  'SegundoNivel' => '01', 
																	  'TercerNivel' => $arrTmp['Sucursal'], 
																	  'CuartoNivel' => '00000', 
																	  'Importe' => number_format((($arrMov->imp_pagado/1.16) * 0.16), 4, '.', ''), 
																	  'Naturaleza' => 'ABONO'));
										}

									}

									//Si es la misma sucursal
									if ($arrTmp['Sucursal'] == $strSucursal)
									{

										// IVA
										if (($numIVAGeneral > 0) && 
											($arrTmp['IVA'] == 0))

										{
											array_push($arrIVA, array('PrimerNivel' => '209', 
																	  'SegundoNivel' => '01', 
																	  'TercerNivel' => $strSucursal, 
																	  'CuartoNivel' => '00000', 
																	  'Importe' => number_format((($arrMov->imp_pagado/1.16) * 0.16), 4, '.', ''), 
																	  'Naturaleza' => 'CARGO'));

											array_push($arrIVA, array('PrimerNivel' => '208', 
																	  'SegundoNivel' => '01', 
																	  'TercerNivel' => $arrTmp['Sucursal'], 
																	  'CuartoNivel' => '00000', 
																	  'Importe' => number_format((($arrMov->imp_pagado/1.16) * 0.16), 4, '.', ''), 
																	  'Naturaleza' => 'ABONO'));

											array_push($arrIVA, array('PrimerNivel' => '899', 
																	  'SegundoNivel' => '02', 
																	  'TercerNivel' => $strSucursal, 
																	  'CuartoNivel' => '02000', 
																	  'Importe' => $arrMov->imp_pagado, 
																	  'Naturaleza' => 'CARGO'));

											array_push($arrIVA, array('PrimerNivel' => '899', 
																	  'SegundoNivel' => '01', 
																	  'TercerNivel' => $arrTmp['Sucursal'], 
																	  'CuartoNivel' => '01000', 
																	  'Importe' => $arrMov->imp_pagado, 
																	  'Naturaleza' => 'ABONO'));

											array_push($arrIVA, array('PrimerNivel' => '899', 
																	  'SegundoNivel' => '01', 
																	  'TercerNivel' => $strSucursal, 
																	  'CuartoNivel' => '01000', 
																	  'Importe' => number_format(($arrMov->imp_pagado/1.16), 2, '.', ''), 
																	  'Naturaleza' => 'CARGO'));

											array_push($arrIVA, array('PrimerNivel' => '899', 
																	  'SegundoNivel' => '02', 
																	  'TercerNivel' => $arrTmp['Sucursal'], 
																	  'CuartoNivel' => '01000', 
																	  'Importe' => number_format(($arrMov->imp_pagado/1.16), 2, '.', ''), 
																	  'Naturaleza' => 'ABONO'));
										}
										else if (($arrMov->iva == 0) && 
												 ($arrTmp['IVA'] > 0))
										{
											array_push($arrIVA, array('PrimerNivel' => '208', 
																	  'SegundoNivel' => '01', 
																	  'TercerNivel' => $strSucursal, 
																	  'CuartoNivel' => '00000', 
																	  'Importe' => number_format((($arrMov->imp_pagado/1.16) * 0.16), 4, '.', ''), 
																	  'Naturaleza' => 'CARGO'));

											array_push($arrIVA, array('PrimerNivel' => '209', 
																	  'SegundoNivel' => '01', 
																	  'TercerNivel' => $arrTmp['Sucursal'], 
																	  'CuartoNivel' => '00000', 
																	  'Importe' => number_format((($arrMov->imp_pagado/1.16) * 0.16), 4, '.', ''), 
																	  'Naturaleza' => 'ABONO'));

											array_push($arrIVA, array('PrimerNivel' => '899', 
																	  'SegundoNivel' => '02', 
																	  'TercerNivel' => $strSucursal, 
																	  'CuartoNivel' => '01000', 
																	  'Importe' => $arrMov->imp_pagado, 
																	  'Naturaleza' => 'CARGO'));

											array_push($arrIVA, array('PrimerNivel' => '899', 
																	  'SegundoNivel' => '01', 
																	  'TercerNivel' => $arrTmp['Sucursal'], 
																	  'CuartoNivel' => '01000', 
																	  'Importe' => $arrMov->imp_pagado, 
																	  'Naturaleza' => 'ABONO'));

											array_push($arrIVA, array('PrimerNivel' => '899', 
																	  'SegundoNivel' => '01', 
																	  'TercerNivel' => $strSucursal, 
																	  'CuartoNivel' => '01000', 
																	  'Importe' => number_format(($arrMov->imp_pagado/1.16), 2, '.', ''), 
																	  'Naturaleza' => 'CARGO'));

											array_push($arrIVA, array('PrimerNivel' => '899', 
																	  'SegundoNivel' => '02', 
																	  'TercerNivel' => $arrTmp['Sucursal'], 
																	  'CuartoNivel' => '02000', 
																	  'Importe' => number_format(($arrMov->imp_pagado/1.16), 2, '.', ''), 
																	  'Naturaleza' => 'ABONO'));
										}
									}


								}

							}//Cierre de foreach anticipos


							// Cliente 
							$arrAuxiliar['renglon'] = $intRenglon;
							//Crear un objeto vacio, stdClass es el objeto Cuenta
							$objCuenta = new stdClass();
							$objCuenta->intCuentaPadreID = NULL;
							$objCuenta->intSatCuentaID = NULL;
							$objCuenta->strPrimerNivel = '105';
							$objCuenta->strSegundoNivel = $strSucursal;
							$objCuenta->strTercerNivel = $strModulo;
							$objCuenta->strCuartoNivel = $otdAplicacion->codigo;
							$objCuenta->strDescripcion = $otdAplicacion->razon_social;
							$objCuenta->strNaturaleza = NULL;
							$objCuenta->strTipoCuenta = NULL;
							$objCuenta->strAceptaMovimientos = 'SI';
							$objCuenta->strMovimientosBancarios  = 'NO';
							//Hacer un llamado a la función para obtener los datos de la cuenta
							$arrCuenta =  $this->get_cuenta($objCuenta, 'SI', 'CLIENTE');
							$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
							$arrAuxiliar['importe'] = number_format($arrMov->imp_pagado, 5, '.', '');
							$arrAuxiliar['naturaleza'] = 'ABONO';
							$arrAuxiliar['referencia'] = '';
							$arrAuxiliar['concepto'] = '';
							//Si existe id de la cuenta
							if ($arrAuxiliar['cuenta_id'] > 0)
							{
								//Agregar datos al array
								array_push($arrDetalles, $arrAuxiliar);
								//Incrementar renglón
								$intRenglon++;
							}

							//Hacer recorrido para obtener IVAS
							foreach($arrIVA as $objIVA)
							{
								$arrAuxiliar['renglon'] = $intRenglon;
								//Crear un objeto vacio, stdClass es el objeto Cuenta
								$objCuenta = new stdClass();
								$objCuenta->strPrimerNivel = $objIVA['PrimerNivel'];
								$objCuenta->strSegundoNivel = $objIVA['SegundoNivel'];
								$objCuenta->strTercerNivel = $objIVA['TercerNivel'];
								$objCuenta->strCuartoNivel = $objIVA['CuartoNivel'];
								//Hacer un llamado a la función para obtener los datos de la cuenta
								$arrCuenta = $this->get_cuenta($objCuenta);
								$arrAuxiliar['cuenta_id'] = $arrCuenta['cuenta_id'];
								$arrAuxiliar['importe'] = number_format($objIVA['Importe'], 5, '.', '');
								$arrAuxiliar['naturaleza'] = $objIVA['Naturaleza'];
								$arrAuxiliar['referencia'] = '';
								$arrAuxiliar['concepto'] = '';
								//Si existe id de la cuenta
								if ($arrAuxiliar['cuenta_id'] > 0)
								{
									//Agregar datos al array
									array_push($arrDetalles, $arrAuxiliar);
									//Incrementar renglón
									$intRenglon++;
								}

							}//Cierre de foreach IVAS


						}
						else
						{
							//Asignar mensaje de error
					 		$this->ARR_DATOS['strError'] .= MSJ_ERROR_CUENTA_CONTABLE;
					 		$this->ARR_DATOS['strError'] .= '<br>';
						}


					}//Cierre de foreach detalles

				}//Cierre de verificación de detalles

			}


			//Asignar datos de la póliza
			$objPoliza->intSucursalID =  $otdAplicacion->sucursal_id;
			$objPoliza->strTipo = 'DIARIO';
			$objPoliza->strModulo = $otdAplicacion->Modulo;
			$objPoliza->strProceso =  $otdAplicacion->Proceso;
			$objPoliza->intReferenciaID = $otdAplicacion->ID;
			$objPoliza->dteFecha = $otdAplicacion->fecha;
			$objPoliza->strConcepto = $strConcepto;
			$objPoliza->strObservaciones = $strObservaciones;
			$objPoliza->strEstatus = 'ACTIVO';
			$objPoliza->arrDetalles = $arrDetalles;

			//Hacer un llamado a la función para guardar los datos de la póliza en la BD
			$this->guardar_poliza_referencia($objPoliza, $intProcesoMenuID);

		}
		else
		{
			//Indicar mensaje de error (no se genera la póliza porque no se cumplen con las restricciones / no existe información del registro)
			$this->ARR_DATOS['strError'] = MSJ_ERROR_POLIZA;
		}
	}

    //Método para guardar los datos de la póliza en la BD
	function guardar_poliza_referencia(stdClass $objPoliza, $intProcesoMenuID)
	{

		//Si no se obtienen errores antes de guardar los datos de la póliza
		if ($this->ARR_DATOS['strError'] == '')
		{
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
		    $objPoliza->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10, 'POLIZA');
		    //Recortar fecha a 10 caracteres
			$objPoliza->dteFecha = substr($objPoliza->dteFecha, 0, 10);
			$objPoliza->intUsuarioID = $this->session->userdata('usuario_id');
			 //Asignar NO para indicar que la póliza no corresponde al cierre anual
			$objPoliza->strCierreAnual = 'NO';

		    //Si no existe folio del proceso
			if($objPoliza->strFolio == '')
			{
				//Asignar mensaje de error
		 		$this->ARR_DATOS['strError'] .=  MSJ_GENERAR_FOLIO;
		 		$this->ARR_DATOS['strError'] .= '<br>';
			}
			else
			{
				//Hacer un llamado al método para guardar los datos de la póliza 
				$bolResultado = $this->polizas->guardar($objPoliza); 
				/*Quitar '_'  de la cadena (resultadoTransaccion_polizaID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro */
				list($bolResultado, $objPoliza->intPolizaID) = explode("_", $bolResultado); 
 

				//Si se obtienen errores al ejecutar el proceso
				if(!$bolResultado)
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= 'Ocurrió un error al guardar los datos de la póliza.';
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}
				else
				{
					//Asignar el id del nuevo registro
					$this->ARR_DATOS['intPolizaID'] = $objPoliza->intPolizaID;
				}
			}

		}//Cierre de verificación de errores
		
	}


	 //Método para modificar  los datos del inventario de maquinaria en la BD
	function modificar_inventario_maquinaria(stdClass $objInventario, $strTipo)
	{
		
		//Asignar tipo de referencia (se utiliza para modificar los datos del inventario correspondientes a la póliza)
		$objInventario->strTipo = 'POLIZA';
		
		//Hacer un llamado al método para modificar los datos del inventario 
		$bolResultado = $this->inventario_maquinaria->modificar($objInventario); 
		
		//Si se obtienen errores al ejecutar el proceso
		if(!$bolResultado)
		{
			//Asignar mensaje de error
	 		$this->ARR_DATOS['strError'] .= 'Ocurrió un error al guardar los datos del inventario. <br>';
	 		$this->ARR_DATOS['strError'] .=  $strTipo.' '.$this->ARR_DATOS['strFolioReferencia'];
	 		$this->ARR_DATOS['strError'] .= ' Serie '.$objInventario->strSerie;
	 		$this->ARR_DATOS['strError'] .= '<br>';
		}	

	}


	//Función que se utiliza para regresar los datos de una cuenta
	function get_cuenta($objCuenta, $strAgregar = NULL, $strTipo = NULL)
	{
		//Array que se utiliza para enviar datos
		$arrCuenta = array ('cuenta_id' => 0, 
							'sat_cuenta_id' => 0, 
							'naturaleza' => '', 
							'tipo_cuenta' => '', 
							'movimientos_bancarios' => '');


		//Concatenar datos para realizar la búsqueda
    	$strCriteriosBusq = $objCuenta->strPrimerNivel.'|'.$objCuenta->strSegundoNivel.'|';
    	$strCriteriosBusq .= $objCuenta->strTercerNivel.'|'.$objCuenta->strCuartoNivel;

    	

    	//Hacer un llamado al método para comprobar la existencia de la cuenta
		$otdResultado = $this->cuentas->buscar(NULL, $strCriteriosBusq, NULL, 
						   					   NULL, NULL, NULL, 'ACTIVO');

		//Si existen datos
		if($otdResultado)
		{
			
			//Asignar datos al array
			$arrCuenta['cuenta_id'] = $otdResultado->cuenta_id;
			$arrCuenta['sat_cuenta_id'] = $otdResultado->sat_cuenta_id;
			$arrCuenta['naturaleza'] = $otdResultado->naturaleza;
			$arrCuenta['tipo_cuenta'] = $otdResultado->tipo_cuenta;
			$arrCuenta['movimientos_bancarios'] = $otdResultado->movimientos_bancarios;

		}
		else if ($strAgregar == 'SI') //Guardar datos de la cuenta en la BD
		{
			//Crear instancia del objeto cuenta
			$objNuevaCta = new stdClass();
			$objNuevaCta->strPrimerNivel = $objCuenta->strPrimerNivel;
			$objNuevaCta->strSegundoNivel = $objCuenta->strSegundoNivel;
			$objNuevaCta->strTercerNivel = $objCuenta->strTercerNivel;
			//Dependiendo del tipo asignar cuenta 
			if ($strTipo == 'CLIENTE')//Si la cuenta pertenece a un cliente
			{
				$objNuevaCta->strCuartoNivel = '00000';	
			}
			else if($strTipo == 'PROVEEDOR') //Si la cuenta pertenece a un proveedor
			{
				$objNuevaCta->strCuartoNivel = substr($objCuenta->strCuartoNivel, 0, 1).'0000';
			}
			else if ($strTipo == 'INVENTARIO')//Si la cuenta pertenece a un inventario
			{
				$objNuevaCta->strCuartoNivel = '00000';	
			}
			else if ($strTipo == "CONSUMOS")
			{
				$objNuevaCta->strCuartoNivel = '00000';
			}
			else if ($strTipo == 'CONSIGNACION')
			{
				$objNuevaCta->strCuartoNivel = '00000';
			}
			else if ($strTipo == 'VEHICULO')
			{
				$objNuevaCta->strCuartoNivel = substr($objCuenta->strCuartoNivel, 0, 2).'000';
			}


			//Concatenar los datos para indicar cuenta padre
	    	$strCuentaPadre = $objNuevaCta->strPrimerNivel.' '.$objNuevaCta->strSegundoNivel.' ';
	    	$strCuentaPadre .= $objNuevaCta->strTercerNivel.' '.$objNuevaCta->strCuartoNivel;


			//Hacer un llamado a la función para obtener los datos de la cuenta
			$arrNuevaCta = $this->get_cuenta($objNuevaCta);
			$objCuenta->intCuentaPadreID = $arrNuevaCta['cuenta_id'];
			
			//Verificar si existe id de la cuenta padre
			if($objCuenta->intCuentaPadreID > 0)
			{
				$objCuenta->intSatCuentaID = $arrNuevaCta['sat_cuenta_id'];
				$objCuenta->strNaturaleza= $arrNuevaCta['naturaleza'];
				$objCuenta->strTipoCuenta = $arrNuevaCta['tipo_cuenta'];
				$objCuenta->strMovimientosBancarios = $arrNuevaCta['movimientos_bancarios'];
			    $objCuenta->intUsuarioID = $this->session->userdata('usuario_id');

				//Hacer un llamado al método para guardar los datos de la cuenta
				$bolResultado = $this->cuentas->guardar($objCuenta);
				/*Quitar '_'  de la cadena (resultadoTransaccion_cuentaID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro */
				list($bolResultado, $objCuenta->intCuentaID) = explode("_", $bolResultado); 

				//Si se ejecutó acción en la base de datos
				if($bolResultado)
				{
					//Asignar id del nuevo registro
					$arrCuenta['cuenta_id'] = $objCuenta->intCuentaID;
			    }
			    else
			    {
			    	//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= 'Ocurrió un error al guardar los datos de la cuenta.';
			 		$this->ARR_DATOS['strError'] .= '<br>';
			    }
			}
			else
			{
					$this->ARR_DATOS['strError'] .= 'No existe la cuenta padre: '.$strCuentaPadre;
			 		$this->ARR_DATOS['strError'] .= '<br>';
			}
		}
	

		//Regresar datos de la cuenta
		return $arrCuenta;
	}



	//Función que se utiliza para regresar el costo de una cuenta contable
	function get_costo($intCuentaID, $dteFecha)
	{	

		//Variable que se utiliza para regresar el costo de la cuenta
    	$intCosto = 0;

        //Hacer un llamado al método para obtener los costos (cargos y abonos) de la cuenta contable
		$otdResultado = $this->cuentas->buscar_costos_cuenta($intCuentaID, $dteFecha);

		//Si existen datos
		if($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCosto)
			{ 
				
				//Incrementar acumulado del costo
				$intCosto += ($arrCosto->Cargos - $arrCosto->Abonos);
			}

			//Convertir cantidad a dos decimales
			$intCosto = number_format($intCosto, 2, '.', '');
		}

		//Evitar regresar valores negativos
		if($intCosto < 0)
		{
			$intCosto = 0;
		}

		//Regresar el costo de la cuenta contable
		return $intCosto;
	}



	//Función que se utiliza para regresar los datos de un rastreo
	function get_rastreo($strSerie, $dteFecha)
	{
		//Array que se utiliza para enviar datos
		$arrRastreo = array ('existencia' => 'NO', 
							 'sucursal_id' => 0, 
							 'codigo_interno' => '', 
							 'tipo_movimiento' => '');

		//Seleccionar los rastreos de maquinaria
		$otdRastreos = $this->mov_maquinaria->buscar_rastreos($strSerie, $dteFecha);

		//Si existen datos
		if($otdRastreos)
		{
			//Recorremos el arreglo 
			foreach ($otdRastreos as $arrRast)
			{
				//Si el tipo de movimiento corresponde a una entrada
				if ($arrRast->tipo_movimiento < SALIDA_MAQUINARIA_VENTA)
				{

					$arrRastreo['existencia'] = 'SI';
					$arrRastreo['sucursal_id'] = $arrRast->sucursal_id;
					$arrRastreo['codigo_interno'] = $arrRast->codigo_interno;
					$arrRastreo['tipo_movimiento'] = $arrRast->tipo_movimiento;
				}
				else 
				{
					$arrRastreo['existencia'] = 'NO';
					$arrRastreo['sucursal_id'] = $arrRast->sucursal_id;
					$arrRastreo['codigo_interno'] = $arrRast->codigo_interno;
					$arrRastreo['tipo_movimiento'] = $arrRast->tipo_movimiento;
				}
			}//Cierre de foreach
		
		}//Cierre de verificación de información

		//Regresar datos del rastreo
		return $arrRastreo;
	}


	//Función que se utiliza para regresar los datos de un rastreo de maquinaria (orden de reparación interna)
	function get_rastreo_orden($strSerie, $dteFecha, $intSucursalID)
	{
		//Array que se utiliza para enviar datos
		$arrRastreo = array ('existencia' => 'NO', 
							 'sucursal_id' => 0, 
							 'serie' => '', 
							 'motor' => '', 
							 'descripcion_corta' => '', 
							 'consignacion' => '', 
							 'codigo_interno' => '',
							 'modulo' => '');

		//Seleccionar los rastreos del inventario de maquinaria 
		$otdRastreosInv = $this->inventario_maquinaria->buscar_rastreo_orden($strSerie, $dteFecha, 
																	   		 $intSucursalID, 'inventario');

		//Si existen datos
		if($otdRastreosInv)
		{
			
			$arrRastreo['existencia'] = 'SI';
			$arrRastreo['sucursal_id'] = $otdRastreosInv->sucursal_id;
			$arrRastreo['serie'] = $otdRastreosInv->serie;
			$arrRastreo['motor'] = $otdRastreosInv->motor;
			$arrRastreo['descripcion_corta'] = $otdRastreosInv->descripcion_corta;
			$arrRastreo['consignacion'] = $otdRastreosInv->consignacion;
			$arrRastreo['codigo_interno'] = $otdRastreosInv->codigo_interno;
			$arrRastreo['modulo'] = $otdRastreosInv->Modulo;
		
		}//Cierre de verificación de información

		//Seleccionar los rastreos de los movimientos de maquinaria
		$otdRastreosMov = $this->inventario_maquinaria->buscar_rastreo_orden($strSerie, $dteFecha, 
																	   		 $intSucursalID, 'movimientos');

		//Si existen datos
		if($otdRastreosMov)
		{
		
			//Si el tipo de movimiento corresponde a una entrada
			if ($arrRast->tipo_movimiento < SALIDA_MAQUINARIA_VENTA)
			{
				$arrRastreo['existencia'] = 'SI';
				
			}
			else 
			{
				$arrRastreo['existencia'] = 'NO';
			}

			$arrRastreo['sucursal_id'] = $otdRastreosMov->sucursal_id;
			$arrRastreo['serie'] = $otdRastreosMov->serie;
			$arrRastreo['motor'] = $otdRastreosMov->motor;
			$arrRastreo['descripcion_corta'] = $otdRastreosMov->descripcion_corta;
			$arrRastreo['consignacion'] = $otdRastreosMov->consignacion;
			$arrRastreo['codigo_interno'] = $otdRastreosMov->codigo_interno;
			$arrRastreo['modulo'] = $otdRastreosMov->Modulo;
		
		}//Cierre de verificación de información

		//Regresar datos del rastreo
		return $arrRastreo;
	}


	//Función que se utiliza para regresar los anticipos por aplicar
	function get_anticipos_aplicacion($intAnticipoID, $intReferenciaID, $strTipoReferencia, $intRenglon = NULL)
	{

		//Array que se utiliza para asignar los datos de los anticipos
		$arrAnticipos = array();

		//Seleccionar los rastreos del inventario de maquinaria 
		$otdAnticipo = $this->aplicacion->buscar_anticipos_poliza($intAnticipoID, $intReferenciaID, $strTipoReferencia, $intRenglon);

		//Si existe información
		if($otdAnticipo)
		{

			//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
			$otdConfContable = $this->config_contable->buscar($otdAnticipo->sucursal_id);

			//Si hay información de la cuenta contable
			if($otdConfContable)
			{
				//Variable que se utiliza para asignar la descripción de la Tasa de IVA
				$strTasaIVA = "";

				//Si existe el id del módulo
				if($otdAnticipo->modulo_id > 0)
				{
					//Asignar la descripción del módulo
					$strModulo = $otdAnticipo->modulo;
				}
				else
				{
					//Asignar descripción del modulo (hacer un llamado a la función para verificar existencia del id del módulo, en caso de que no exista actualizar registro)
					$strModulo = $this->anticipos->set_modulo($otdAnticipo->ID, 'POLIZA');
					
		     	}


				//Si existe importe de IVA
			    if ($otdAnticipo->IVA > 0)
				{
					//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
					$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA16', $strModulo);
					$strTasaIVA = ' 16%';

					
				}
				else
				{
					//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
					$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA0', $strModulo);
					$strTasaIVA = '0%';
				}

				//Si existen datos del departamento (cuenta del módulo)
				if($otdConfModulo)
				{
					//Calcular importe
					$intImporte = ($otdAnticipo->subtotal + $otdAnticipo->IVA + $otdAnticipo->IEPS);
					$strCtaModulo = $otdConfModulo->cuenta;

					
					//Agregar datos al array
					array_push($arrAnticipos, array('ID' => $otdAnticipo->ID, 
												    'Modulo' => $strCtaModulo, 
													'Sucursal' => $otdConfContable->cuenta_contable,
													'Subtotal' => $otdAnticipo->subtotal, 
													'TasaCuotaIVA' => $otdAnticipo->tasa_cuota_iva, 
													'IVA' => $otdAnticipo->IVA, 
													'TasaCuotaIEPS' => $otdAnticipo->tasa_cuota_ieps, 
													'IEPS' => $otdAnticipo->IEPS, 
													'Total' => $intImporte));
					
					
					

				}
				else
				{
					//Asignar mensaje de error
					$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo (anticipo TASA '.$strTasaIVA.'): '.$strModulo;
					$this->ARR_DATOS['strError'] .= '<br>';
				}

			}
			else
			{
				//Asignar mensaje de error
		 		$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la sucursal (anticipo).';
		 		$this->ARR_DATOS['strError'] .= '<br>';
			}


		}//Cierre de verificación de anticipos

		//Regresar array con los datos de anticipos
		return $arrAnticipos;
	}


	//Función que se utiliza para regresar los anticipos por aplicar
	function get_anticipos_aplicacionAnt($strCodCli, $dteFecha, $strModuloRef)
	{
		
		//Array que se utiliza para asignar los datos de los anticipos
		$arrAnticipos = array();

		//Seleccionar los rastreos del inventario de maquinaria 
		$otdAnticipos = $this->aplicacion->buscar_anticipos_poliza($strCodCli, $dteFecha);

		//Si existe información
		if($otdAnticipos)
		{
			//Recorremos el arreglo 
			foreach ($otdAnticipos as $arrAnt)
			{
				
				//Seleccionar los datos de la cuenta contable que coincide con el id de la sucursal
				$otdConfContable = $this->config_contable->buscar($arrAnt->sucursal_id);

				//Si hay información de la cuenta contable
				if($otdConfContable)
				{
					//Variable que se utiliza para asignar la descripción de la Tasa de IVA
					$strTasaIVA = "";


					//Dependiendo del proceso asignar descripción del módulo (departamento)
					if($arrAnt->Proceso == 'ANTICIPO')
					{
						//Si existe el id del módulo
						if($arrAnt->modulo_id > 0)
						{
							//Asignar la descripción del módulo
							$strModulo = $arrAnt->modulo;
						}
						else
						{
							//Asignar descripción del modulo (hacer un llamado a la función para verificar existencia del id del módulo, en caso de que no exista actualizar registro)
							$strModulo = $this->anticipos->set_modulo($arrAnt->ID, 'POLIZA');
							
						}

						
					}
					else
					{
						$strModulo = $arrAnt->concepto;
					}
					

					//Si existe importe de IVA
				    if ($arrAnt->IVA > 0)
					{
						//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
						$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA16', $strModulo);
						$strTasaIVA = ' 16%';

						
					}
					else
					{
						//Hacer un llamado al método para comprobar la existencia de la configuración del módulo
						$otdConfModulo = $this->config_polizas->buscar_configuracion_modulos(NULL, 0, 'CLIENTE TASA0', $strModulo);
						$strTasaIVA = '0%';
					}

					//Si existen datos del departamento (cuenta del módulo)
					if($otdConfModulo)
					{
						//Calcular importe
						$intImporte = ($arrAnt->subtotal + $arrAnt->IVA + $arrAnt->IEPS);
						$strCtaModulo = $otdConfModulo->cuenta;

						//Si se cumple la sentencia (aplicación)
						if($strCtaModulo == $strModuloRef)
						{
							//Agregar datos al array
							array_push($arrAnticipos, array('ID' => $arrAnt->ID, 
														    'Modulo' => $strCtaModulo, 
															'Sucursal' => $otdConfContable->cuenta_contable, 
															'Fecha' => $arrAnt->fecha, 
															'Subtotal' => $arrAnt->subtotal, 
															'TasaCuotaIVA' => $arrAnt->tasa_cuota_iva, 
															'IVA' => $arrAnt->IVA, 
															'TasaCuotaIEPS' => $arrAnt->tasa_cuota_ieps, 
															'IEPS' => $arrAnt->IEPS, 
															'Total' => $intImporte));
						}
						
						

					}
					else
					{
						//Asignar mensaje de error
						$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del módulo (anticipo TASA '.$strTasaIVA.'): '.$strModulo;
						$this->ARR_DATOS['strError'] .= '<br>';
					}
				}
				else
				{
					//Asignar mensaje de error
			 		$this->ARR_DATOS['strError'] .= 'No existe cuenta contable de la sucursal (anticipo).';
			 		$this->ARR_DATOS['strError'] .= '<br>';
				}

			}//Cierre de foreach
		
		}//Cierre de verificación de anticipos

		

		//Si no existen errores de cuentas contables
		if($this->ARR_DATOS['strError'] == "")
		{
			//Hacer un llamado al método para obtener los cargo de la cuenta del cliente
			$otdCargos = $this->cuentas->buscar_cargos_cliente($strCodCli, $dteFecha, '206', $strModuloRef);

			//Si existe información
			if($otdCargos)
			{
				//Recorremos el arreglo 
				foreach ($otdCargos as $arrAplicacion)
				{
					// Revisar si existen anticipos que se aplicaron a la misma sucursal y módulo
					foreach ($arrAnticipos as &$arrTmp) 
					{
						if (($arrTmp['Total'] > 0) &&
							($arrTmp['Fecha'] <= $arrAplicacion->fecha) &&
							($arrAplicacion->importe > 0))
						{


							if (($arrTmp['Sucursal'] == $arrAplicacion->segundo_nivel) && 
								($arrTmp['Modulo'] == $arrAplicacion->tercer_nivel))
							{
								if ($arrTmp['Total'] >= $arrAplicacion->importe)
								{
									$arrTmp['Total'] -= $arrAplicacion->importe;
									$arrAplicacion->importe = 0;
								}
								else
								{
									$arrAplicacion->importe -= $arrTmp['Total'];
									$arrTmp['Total'] = 0;
								}
							}

						}
					}//Cierre de foreach de anticipos

					// Si todavía existe importe por aplicar
					if ($arrAplicacion->importe > 0)
					{
						// Validamos que tenga saldo en el mismo módulo sin importar la sucursal
						foreach ($arrAnticipos as &$arrTmp) 
						{

							if (($arrTmp['Total'] > 0) &&
								($arrTmp['Fecha'] <= $arrAplicacion->fecha) &&
								($arrAplicacion->importe > 0))
							{
								if ($arrTmp['Modulo'] == $arrAplicacion->tercer_nivel)
								{
									if ($arrTmp['Total'] >= $arrAplicacion->importe)
									{
										$arrTmp['Total'] -= $arrAplicacion->importe;
										$arrAplicacion->importe = 0;
									}
									else
									{
										$arrAplicacion->importe -= $arrTmp['Total'];
										$arrTmp['Total'] = 0;
									}
								}
							}
						}

						// Si todavía existe importe por aplicar
						if ($arrAplicacion->importe > 0)
						{

								//Validamos que tenga saldo en la misma sucursal
								foreach ($arrAnticipos as &$arrTmp) 
								{
									if (($arrTmp['Total'] > 0) &&
										($arrTmp['Fecha'] <= $arrAplicacion->fecha) &&
										($arrAplicacion->importe > 0))
									{
										if ($arrTmp['Sucursal'] == $arrAplicacion->segundo_nivel)
										{
											if ($arrTmp['Total'] >= $arrAplicacion->importe)
											{
												$arrTmp['Total'] -= $arrAplicacion->importe;
												$arrAplicacion->importe = 0;
											}
											else
											{
												$arrAplicacion->importe -= $arrTmp['Total'];
												$arrTmp['Total'] = 0;
											}
										}
									}
								}

								// Si todavía existe importe por aplicar
								if ($arrAplicacion->importe > 0)
								{

									// Tomamos los más antiguos para aplicar
									foreach ($arrAnticipos as &$arrTmp) 
									{
										if (($arrTmp['Total'] > 0) &&
											($arrAplicacion->importe > 0))
										{
											if ($arrTmp['Total'] >= $arrAplicacion->importe)
											{
												$arrTmp['Total'] -= $arrAplicacion->importe;
												$arrAplicacion->importe = 0;
											}
											else
											{
												$arrAplicacion->importe -= $arrTmp['Total'];
												$arrTmp['Total'] = 0;
											}
										}
									}
								}
							}

						}//Cierre de verificación de importe por aplicar


				}//Cierre de foreach de aplicación


			}//Cierre de verificación de cargos

		}//Cierre de verificación de errores en cuentas contables

		//Regresar array con los datos de anticipos
		return $arrAnticipos;
	}
}

//------------------------------------------------------------------------------------------------------------------------
//---------- CLASES
//------------------------------------------------------------------------------------------------------------------------
class Cuenta
{
	public $intCuentaPadreID = NULL;
	public $intSatCuentaID = NULL;
	public $strPrimerNivel = NULL;
	public $strSegundoNivel = NULL;
	public $strTercerNivel = NULL;
	public $strCuartoNivel = NULL;
	public $strDescripcion = NULL;
	public $strNaturaleza = NULL;
	public $strTipoCuenta = NULL;
	public $strAceptaMovimientos = 'SI';
	public $strMovimientosBancarios = 'NO';
	
}


class Inventario
{
	public $intSucursalID = NULL;
	public $intMaquinariaDescripcionID = NULL;
	public $strSerie = NULL;
	public $strCodigoInterno = NULL;
	public $intCosto = NULL;
}