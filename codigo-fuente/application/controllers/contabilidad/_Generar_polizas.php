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
		//Cargamos el modelo de refacciones de reparación
		$this->load->model('servicio/ordenes_reparacion_model', 'ordenes');
		//Cargamos el modelo de facturas de refacciones
		$this->load->model('refacciones/facturas_refacciones_model', 'facturas_refacciones');
		//Cargamos el modelo de facturas de maquinaria
		$this->load->model('maquinaria/facturas_maquinaria_model', 'facturas_maquinaria');
		//Cargamos el modelo de inventario de maquinaria
		$this->load->model('maquinaria/maquinaria_inventario_model', 'inventario_maquinaria');
		
		//Variable que se utiliza para asignar los errores al generar la póliza
        $this->ARR_DATOS['strError'] = '';
        //Variable que se utiliza para asignar el folio de la referencia de la póliza
        $this->ARR_DATOS['strFolioReferencia'] = '';
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
		}


		//Si no se obtienen errores al ejecutar el proceso
		if ($this->ARR_DATOS['strError'] == '')
		{
			//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE, 
							  'tipo_mensaje' => TIPO_MSJ_EXITO, 
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

		}//Cierre de verificación de información
	}


	

	//Método para generar una póliza con los datos de la factura de servicio, orden de reparación o trabajo foráneo, etc.
	public function get_poliza_servicio($intReferenciaID, $strTipoReferencia, $intProcesoMenuID)
	{
		

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
						$objCuenta->strMovimientosBancarios = 'NO';
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

		}//Cierre de verificación de información

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


					//Concatenar datos para realizar la búsqueda del departamento
					$strCriteriosBusq = $intModuloID.'|REFACCIONES';
					//Hacer un llamado al método para comprobar la existencia de la configuración del departamento
					$otdConfDepto = $this->config_polizas->buscar_configuracion_departamentos(NULL, $strCriteriosBusq);


					//Si existen datos del departamento (cuenta del módulo)
					if($otdConfDepto)
					{
						//Asignar cuenta del departamento
						$strCuentaDepto =  $otdConfDepto->cuenta;

						/****Costo***/
						//Datos del costo
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


		}//Cierre de verificación de información

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
				


			}
			else if ($intTipoMovimiento == ENTRADA_MAQUINARIA_TRASPASO) //Entradas de maquinaria por traspaso
			{

				

			}
			else if ($intTipoMovimiento == ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA)//Entradas de maquinaria por devolución de factura
			{

				

			}
			else if ($intTipoMovimiento == SALIDA_MAQUINARIA_DEVOLUCION_PROVEEDOR)//Salidas de maquinaria por devolución al proveedor
			{
				
			}
			else if ($intTipoMovimiento == SALIDA_MAQUINARIA_INTERNA) //Salidas de maquinaria por consumo interno
			{
				

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
							
							//Si se cumple la sentencia
							if ($arrDet->servicio == 'NO')
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

									/*//Asignar código interno consecutivo
									$objInventario->strCodigoInterno = $this->get_codigo_interno($arrDet->consignacion);
									//Hacer un llamado a la función para modificar los datos del inventario en la BD
									$this->modificar_inventario_maquinaria($objInventario);*/

									
									
								}
								else
								{
									$objInventario->strCodigoInterno = $arrDet->codigo_interno;
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
									if ($arrDet->entrada_id == 1)
									{
 										
										//Incrementar costo
										$arrDet->costo = $arrDet->costo + $intCostoCta;

									}
									else
									{
										//Asignar costo de la cuenta contable
										$arrDet->costo = $intCostoCta;
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

									$strConcepto = 'DIARIO POR VENTA DE '.$arrModulo[1].' '.$arrDet->condiciones_pago;
									$strModulo = $arrModulo[1];

								}
								else
							    {
							    	//Asignar mensaje de error
									$this->ARR_DATOS['strError'] .= 'No existe cuenta contable del departamento 
																	 '.$strModulo.' (módulo).';
									$this->ARR_DATOS['strError'] .= '<br>';
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
						foreach ($arrInventario as $arrDet) 
						{
							$arrDet['renglon'] = $intRenglon;
							//Agregar datos al array
							array_push($arrDetalles, $arrDet);
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


		}//Cierre de verificación de información

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
			}

		}//Cierre de verificación de errores
		
	}


	 //Método para modificar  los datos del inventario de maquinaria en la BD
	function modificar_inventario_maquinaria(stdClass $objInventario)
	{
		
		//Asignar tipo de referencia (se utiliza para modificar los datos del inventario correspondientes a la póliza)
		$objInventario->strTipo = 'POLIZA';
		
		//Hacer un llamado al método para modificar los datos del inventario 
		$bolResultado = $this->inventario_maquinaria->modificar($objPoliza); 
		
		//Si se obtienen errores al ejecutar el proceso
		if(!$bolResultado)
		{
			//Asignar mensaje de error
	 		$this->ARR_DATOS['strError'] .= 'Ocurrió un error al guardar los datos del inventario. <br>';
	 		$this->ARR_DATOS['strError'] .= ' Factura '.$this->ARR_DATOS['strFolioReferencia'];
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
							'tipo_cuenta' => '');


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

	//Función que se utiliza para regresar el código interno consecutivo
	function get_codigo_interno($strConsignacion)
	{	
		//Variable que se utiliza para regresar el código consecutivo
    	$strCodigoConsecutivo = '';

		//Hacer un llamado al método para obtener el código interno máximo del inventario de maquinaria
		$otdResultado = $this->inventario_maquinaria->buscar_codigo_interno($strConsignacion);

		//Si existen datos
		if($otdResultado)
		{
			//Asignar valores
	    	$strCodigoInterno = $otdResultado->codigo_interno;

	    	//Concatenar al consecutivo el incremento de ceros
	    	$strCodigoConsecutivo = str_pad(($strCodigoInterno + 1), 5, "0", STR_PAD_LEFT);
		}

		//Regresar código consecutivo
		return $strCodigoConsecutivo;
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
							 'codigo_interno' => '');



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
				}
				else 
				{
					$arrRastreo['existencia'] = 'NO';
					$arrRastreo['sucursal_id'] = $arrRast->sucursal_id;
					$arrRastreo['codigo_interno'] = $arrRast->codigo_interno;
				}

			}//Cierre de foreach
		
		}//Cierre de verificación de información


		//Regresar datos del rastreo
		return $arrRastreo;
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