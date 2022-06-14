<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ampliar_plazos_credito extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de plazos de crédito
		$this->load->model('cuentas_cobrar/ampliar_plazos_credito_model', 'plazos');
		//Cargamos el modelo de pagos
		$this->load->model('caja/pagos_model', 'pagos');
		//Cargamos el modelo de clientes
		$this->load->model('cuentas_cobrar/clientes_model', 'clientes');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('cuentas_cobrar/ampliar_plazos_credito', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->plazos->filtro($this->input->post('dteFechaInicial'),
									    $this->input->post('dteFechaFinal'),
									    $this->input->post('intProspectoID'),
									    trim($this->input->post('strTipoReferencia')),
									    trim($this->input->post('strBusqueda')),
			                            $config['per_page'],
			                            $config['cur_page']);	
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['plazos'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			
			//Si el usuario cuenta con el permiso de acceso VER REGISTRO
			if (in_array('VER REGISTRO', $arrPermisos))
			{
				$arrDet->mostrarAccionVerRegistro = '';
			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['plazos'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows']);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para guardar o modificar los datos de un registro
	public function guardar()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objAmpliarPlazoCredito = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		$objAmpliarPlazoCredito->strTipoReferencia = $this->input->post('strTipoReferencia');
		$objAmpliarPlazoCredito->intReferenciaID = $this->input->post('intReferenciaID');
		$objAmpliarPlazoCredito->intRenglon = $this->input->post('intRenglon');
		$objAmpliarPlazoCredito->intDocumentoPagoID = $this->input->post('intDocumentoPagoID');
		$objAmpliarPlazoCredito->dteVencimiento = $this->input->post('dteVencimiento');
		$objAmpliarPlazoCredito->intDias = $this->input->post('intDias');
		$objAmpliarPlazoCredito->dteNuevoVencimiento = $this->input->post('dteNuevoVencimiento');
		$objAmpliarPlazoCredito->intNuevoDocumentoPagoID = $this->input->post('intNuevoDocumentoPagoID');
		$objAmpliarPlazoCredito->intUsuarioID = $this->session->userdata('usuario_id');

		//Guardar los datos de un registro nuevo
		$bolResultado = $this->plazos->guardar($objAmpliarPlazoCredito);
        //Si no se obtienen errores al ejecutar el proceso
		if($bolResultado)
		{
			//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE,
						 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
						      'mensaje' => MSJ_GUARDAR);
		}
		else
		{
			//Enviar el mensaje de error al formulario
			$arrDatos = array('resultado' => FALSE,
						      'tipo_mensaje' => TIPO_MSJ_ERROR,
				              'mensaje' => MSJ_ERROR_GUARDAR);
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

    //Método para regresar los datos de un registro
	public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL, 'factura' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intAmpliarPlazoCreditoID = $this->input->post('intAmpliarPlazoCreditoID');
		$strTipoReferencia = $this->input->post('strTipoReferencia');
		$intReferenciaID = $this->input->post('intReferenciaID');
		//Variable que se utiliza para asignar el importe total de la factura
		$intImporteTotal = 0;

		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->plazos->buscar($intAmpliarPlazoCreditoID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
		    //Agregar al array los datos de la ampliación del crédito
			$arrDatos['row'] = $otdResultado;

			//Agregar al array los datos de la factura / forma de pago del pedido de maquinaria
			$arrDatos['factura'] = $this->get_datos_factura($otdResultado);
		}


		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	

	//Método para regresar todos los registros activos en un autocomplete
	public function autocomplete()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$strDescripcion = trim($this->input->post('strDescripcion'));

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->plazos->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
					//Variable que se utiliza para asignar el id de la factura
					$intReferenciaID = $arrCol->referencia_id;
					//Variable que se utiliza para asignar el tipo de referencia (MAQUINARIA/REFACCIONES/SERVICIO/CARTERA) de la factura
				    $strTipoReferencia = $arrCol->tipo_referencia;
				    //Variable que se utiliza para asignar el renglón de la forma de pago del pedido de maquinaria
				    $intRenglon = $arrCol->renglon;
				   
			    	//Seleccionar los datos de la factura que coincida con el id (primer posición del arreglo)
					$otdFactura = $this->pagos->buscar_facturas_importes(NULL, NULL, NULL, NULL, NULL, 
																		 $intReferenciaID, 
																		 $strTipoReferencia)[0];
					//Si hay información
					if($otdFactura)
					{
						$dteVencimiento =  $otdFactura->fecha_vencimiento_format;
						$intImporte = $otdFactura->importe;

						//Si existe renglón, significa que se ampliara el plazo de una forma de pago (pedido de la factura de maquinaria)
						if($intRenglon > 0 && $strTipoReferencia == 'MAQUINARIA')
						{
							//Asignar los valores de la forma de pago
							$dteVencimiento = $arrCol->vencimiento;
							$intImporte = $arrCol->importe;
							//Asignar el id del pedido de maquinaria
							$intReferenciaID = $arrCol->pedido_maquinaria_id;
						}

						//Convertir cantidad a formato moneda
						$intImporte = number_format($intImporte,2);

						$arrDatos[] = array('value' => $arrCol->referencia, 
			        						'data' => $intReferenciaID, 
			        						'tipo_referencia' => $strTipoReferencia,
			        					    'fecha' => $otdFactura->fecha_format,
			        					    'vencimiento' => $dteVencimiento, 
			        					    'codigo_moneda' => $otdFactura->moneda_tipo,
			        					    'tipo_cambio' => $otdFactura->tipo_cambio,
			        					    'razon_social' => $otdFactura->razon_social,
			        						'importe' => $intImporte, 
			        						'renglon' => $intRenglon, 
			        						'documento_pago_id' => $arrCol->documento_pago_id,
			        						'documento_pago' => $arrCol->documento_pago);

					}//Cierre de verificación de la factura

		        	
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}


	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte() 
	{	            
		
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProspectoID = $this->input->post('intProspectoID');
		$strTipoReferencia = trim($this->input->post('strTipoReferencia'));
		$strBusqueda = trim($this->input->post('strBusqueda'));

		//Array que se utiliza para asignar los tipos de referencia 
		$arrTipoReferencia = array('MAQUINARIA', 'REFACCIONES', 'SERVICIO', 'CARTERA'); 
		//Array que se utiliza para asignar el subtotal por tipo de referencia
		$arrSubtotalTipoReferencia = array(); 
		//Array que se utiliza para asignar el IVA por tipo de referencia
		$arrIvaTipoReferencia = array();
		//Array que se utiliza para asignar el IEPS por tipo de referencia
		$arrIepsTipoReferencia = array(); 
		//Array que se utiliza para asignar el total por tipo de referencia
		$arrTotalTipoReferencia = array();
		//Array que se utiliza para asignar el subtotal por moneda
		$arrSubtotalMoneda = array(); 
		//Array que se utiliza para asignar el IVA por moneda
		$arrIvaMoneda = array();
		//Array que se utiliza para asignar el IEPS por moneda
		$arrIepsMoneda = array(); 
		//Array que se utiliza para asignar el total por moneda
		$arrTotalMoneda = array();
		//Array que se utiliza para asignar el total de registros por moneda
		$arrTotalRegistrosMoneda = array();
		//Variable que se utiliza para asignar el acumulado del subtotal por tipo de referencia
		$intAcumSubtotalTipoReferencia = 0;
		//Variable que se utiliza para asignar el acumulado del IVA por tipo de referencia
	    $intAcumIvaTipoReferencia = 0;
	    //Variable que se utiliza para asignar el acumulado del IEPS por tipo de referencia
		$intAcumIepsTipoReferencia = 0;
		//Variable que se utiliza para asignar el acumulado del total por tipo de referencia
		$intAcumTotalTipoReferencia = 0;
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->plazos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, 
										      $strTipoReferencia, $strBusqueda);
		
		//Seleccionar los datos de las monedas que coinciden con el parámetro enviado
		$otdMonedas = $this->plazos->buscar_distintas_monedas($dteFechaInicial, $dteFechaFinal, 
															  $intProspectoID, $strTipoReferencia, 
															  $strBusqueda);
		
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
			$strTituloRangoFechas .= ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		}

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = utf8_decode('LISTADO DE PLAZOS DE CRÉDITO ').$strTituloRangoFechas;
		//Si existe id del cliente
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del cliente que coincide con el id
			$otdProspecto =  $this->clientes->buscar($intProspectoID);
			$pdf->strLinea2 =  utf8_decode('RAZÓN SOCIAL: '.$otdProspecto->razon_social);
		}

		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'TIPO', utf8_decode('RAZÓN SOCIAL'), 
								  'VENCIMIENTO', 'NUEVO VCTO.', 
							 	  'SUBTOTAL', 'IVA', 'IEPS', 'TOTAL');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(18, 19, 43, 18, 20, 18, 18, 18, 18);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'C', 'C', 'R', 'R', 'R', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo para obtener la información de los tipos de referencia
			foreach ($arrTipoReferencia as $arrTipo)
			{
				//Inicializar variables
				$arrSubtotalTipoReferencia[$arrTipo] = 0;
				$arrIvaTipoReferencia[$arrTipo] = 0;
				$arrIepsTipoReferencia[$arrTipo] = 0;
				$arrTotalTipoReferencia[$arrTipo] = 0;
			}	

			//Recorremos el arreglo para obtener la información de las monedas
			foreach ($otdMonedas as $arrMon)
			{
				//Recorremos el arreglo para obtener la información de los tipos de referencia
				foreach ($arrTipoReferencia as $arrTipo)
				{
					//Inicializar variables
					$arrSubtotalMoneda[$arrMon->moneda_id][$arrTipo] = 0;
					$arrIvaMoneda[$arrMon->moneda_id][$arrTipo] = 0;
					$arrIepsMoneda[$arrMon->moneda_id][$arrTipo] = 0;
					$arrTotalMoneda[$arrMon->moneda_id][$arrTipo] = 0;
					$arrTotalRegistrosMoneda[$arrMon->moneda_id] = 0;
				}
			}

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
		        //Variable que se utiliza para asignar el acumulado del subtotal
				$intAcumSubtotal = 0;
				//Variable que se utiliza para asignar el acumulado del IVA
				$intAcumIva = 0;
				//Variable que se utiliza para asignar el acumulado del IEPS
				$intAcumIeps = 0;
				//Variable que se utiliza para asignar el importe total
				$intTotal = 0;
				//Variables que se utilizan para asignar los valores de la factura
				$strFolio = '';
				$strRazonSocial = '';
				$strCodigoMoneda = '';
				$intTipoCambio = '';
				
		        //Asignar objeto con los datos de la factura / forma de pago del pedido de maquinaria
				$objFactura = $this->get_datos_factura($arrCol);

				//Si hay información
				if($objFactura)
				{
					//Asignar valores de la factura / forma de pago del pedido de maquinaria
					$intAcumSubtotal = $objFactura->subtotal;
					$intAcumIva = $objFactura->iva;
					$intAcumIeps = $objFactura->ieps;
					$intTotal = $objFactura->importe;
					$strFolio =  $objFactura->folio;
					$strRazonSocial =  $objFactura->razon_social;
					$strCodigoMoneda = $objFactura->codigo_moneda; 
					$intTipoCambio = $objFactura->tipo_cambio;

					//Incrementar valores de los siguientes arrays
					$arrSubtotalTipoReferencia[$arrCol->tipo_referencia] += ($intAcumSubtotal * $objFactura->tipo_cambio);
			      	$arrIvaTipoReferencia[$arrCol->tipo_referencia] += ($intAcumIva * $objFactura->tipo_cambio);
			      	$arrIepsTipoReferencia[$arrCol->tipo_referencia] += ($intAcumIeps * $objFactura->tipo_cambio);
			      	$arrTotalTipoReferencia[$arrCol->tipo_referencia] += ($intTotal * $objFactura->tipo_cambio);

			      
			      	//Si el id de la moneda no corresponde al peso mexicano
			      	if($objFactura->moneda_id != MONEDA_BASE)
			      	{
			      		//Incrementar valores de los siguientes arrays
				      	$arrSubtotalMoneda[$objFactura->moneda_id][$arrCol->tipo_referencia] += $intAcumSubtotal;
				      	$arrIvaMoneda[$objFactura->moneda_id][$arrCol->tipo_referencia] += $intAcumIva;
				      	$arrIepsMoneda[$objFactura->moneda_id][$arrCol->tipo_referencia] += $intAcumIeps;
				      	$arrTotalMoneda[$objFactura->moneda_id][$arrCol->tipo_referencia] += $intTotal;
				      	$arrTotalRegistrosMoneda[$objFactura->moneda_id] += 1;
			      	}

				}//Cierre de verificación de la factura


				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($strFolio, $arrCol->tipo_referencia, utf8_decode($strRazonSocial), 
								$arrCol->vencimiento,  $arrCol->nuevo_vencimiento, 
								'$'.number_format($intAcumSubtotal,2),
								'$'.number_format($intAcumIva,2), 
								'$'.number_format($intAcumIeps,2),
								'$'.number_format($intTotal,2)),
								$pdf->arrAlineacion, 'ClippedCell');
				//Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);

		        //Si existe id de la forma de pago del pedido de maquinaria
		        if($arrCol->documento_pago_id > 0)
		        {
		        	//Tipo de pago
					$pdf->Cell(17, 4, 'TIPO DE PAGO:', 0, 0, 'L', 0);
				    $pdf->ClippedCell(40, 4, utf8_decode($arrCol->documento_pago), 0, 0, 'L', 0);
		        }

		        //Moneda
				$pdf->Cell(12, 4, 'MONEDA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(7, 4, utf8_decode($strCodigoMoneda), 0, 0, 'L', 0);
		    	//Tipo de cambio
		    	$pdf->Cell(6, 4, 'T.C.:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(12, 4,'$'.number_format($intTipoCambio, 4, '.', ','), 0, 0, 'R', 0);
			    //Empleado que hace la autorización
				$pdf->Cell(13, 4, 'AUTORIZA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(45, 4, utf8_decode($arrCol->empleado_autorizacion), 0, 0, 'L', 0);
		      	$pdf->Ln(5);//Deja un salto de línea
				//Incrementar el contador por cada registro
				$intContador++;
			}

			$pdf->Ln(5);//Deja un salto de linea

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- RESUMEN
	        //------------------------------------------------------------------------------------------------------------------------
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//Crea los titulos de la cabecera
			$arrCabeceraResumen = array('ESTATUS', 'SUBTOTAL', 'IVA', 'IEPS',  'TOTAL');
			//Establece el ancho de las columnas de cabecera
			$arrAnchuraResumen = array(25, 25, 25, 25, 25);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacionResumen = array('L', 'R', 'R', 'R', 'R');
			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Creación de la tabla Resumen
			$pdf->Cell(125, 4, 'RESUMEN GENERAL EN PESOS', 0, 0, 'C', TRUE);
			$pdf->Ln(4);//Deja un salto de linea
			//Recorre el array de titulos de encabezado para crearlos
			for ($intCont = 0; $intCont < count($arrCabeceraResumen); $intCont++)
			{
				//inserta los titulos de la cabecera
				$pdf->Cell($arrAnchuraResumen[$intCont], 5, $arrCabeceraResumen[$intCont], 1, 0, 
						   $arrAlineacionResumen[$intCont], TRUE);
			}
			$pdf->Ln(6);//Deja un salto de línea
			//Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchuraResumen);
			//Hacer recorrido para obtener totales por tipo de referencia
			foreach ($arrTipoReferencia as $arrTipo)
			{
				//Si existe subtotal
				if($arrSubtotalTipoReferencia[$arrTipo] > 0)
				{
				 	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($arrTipo,'$'.number_format($arrSubtotalTipoReferencia[$arrTipo],2), 
									'$'.number_format($arrIvaTipoReferencia[$arrTipo],2), 
			    				    '$'.number_format($arrIepsTipoReferencia[$arrTipo],2), 
			    				    '$'.number_format($arrTotalTipoReferencia[$arrTipo],2)), 
									$arrAlineacionResumen);

					//Incrementar acumulados
					$intAcumSubtotalTipoReferencia += $arrSubtotalTipoReferencia[$arrTipo];
					$intAcumIvaTipoReferencia += $arrIvaTipoReferencia[$arrTipo];
					$intAcumIepsTipoReferencia += $arrIepsTipoReferencia[$arrTipo];
					$intAcumTotalTipoReferencia += $arrTotalTipoReferencia[$arrTipo];
					
				}
			}

			//Asigna el tipo y tamaño de letra para los totales
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Escribir totales
	    	$pdf->Cell(12,3,'TOTALES: ', 0, 0, 'L');  
	    	//Total de registros
            $pdf->Cell(13,3,$intContador, 0, 0, 'R');
            //Acumulado del subtotal
            $pdf->Cell(25,3,'$'.number_format($intAcumSubtotalTipoReferencia,2), 0, 0, 'R');
            //Acumulado del IVA
            $pdf->Cell(25,3,'$'.number_format($intAcumIvaTipoReferencia,2), 0, 0, 'R');
           //Acumulado del IEPS
            $pdf->Cell(25,3,'$'.number_format($intAcumIepsTipoReferencia,2), 0, 0, 'R');
            //Acumulado del importe total
            $pdf->Cell(25,3,'$'.number_format($intAcumTotalTipoReferencia,2), 0, 0, 'R');
            $pdf->Ln(8);//Deja un salto de línea

            //Hacer recorrido para obtener el resumen por cada tipo de moneda
			foreach ($otdMonedas as $arrMon) 
			{
				//Limpiar las siguientes variables (por cada moneda recorrida)
				$intAcumSubtotalTipoReferencia = 0;
				$intAcumIvaTipoReferencia = 0;
				$intAcumIepsTipoReferencia = 0;
				$intAcumTotalTipoReferencia = 0;

				//Asigna el tipo y tamaño de letra para la cabecera de la tabla
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Creación de la tabla Resumen
				$pdf->ClippedCell(125, 4, 'RESUMEN POR MONEDA '.mb_strtoupper($arrMon->descripcion), 0, 0, 'C', TRUE);
			    $pdf->Ln(4);//Deja un salto de linea
				
				//Recorre el array de titulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabeceraResumen); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchuraResumen[$intCont], 5, $arrCabeceraResumen[$intCont], 1, 0, 
							   $arrAlineacionResumen[$intCont], TRUE);
				}
				$pdf->Ln(6);//Deja un salto de línea
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraResumen);
				//Hacer recorrido para obtener totales por estatus
				foreach ($arrTipoReferencia as $arrTipo)
				{
					//Si existe subtotal
					if($arrSubtotalMoneda[$arrMon->moneda_id][$arrTipo] > 0)
					{
					 	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						$pdf->Row(array($arrTipo,'$'.number_format($arrSubtotalMoneda[$arrMon->moneda_id][$arrTipo],2), 
										'$'.number_format($arrIvaMoneda[$arrMon->moneda_id][$arrTipo],2), 
				    				    '$'.number_format($arrIepsMoneda[$arrMon->moneda_id][$arrTipo],2), 
				    				    '$'.number_format($arrTotalMoneda[$arrMon->moneda_id][$arrTipo],2)), 
									  $arrAlineacionResumen);

						
						//Incrementar acumulados
						$intAcumSubtotalTipoReferencia += $arrSubtotalMoneda[$arrMon->moneda_id][$arrTipo];
						$intAcumIvaTipoReferencia += $arrIvaMoneda[$arrMon->moneda_id][$arrTipo];
						$intAcumIepsTipoReferencia += $arrIepsMoneda[$arrMon->moneda_id][$arrTipo];
						$intAcumTotalTipoReferencia += $arrTotalMoneda[$arrMon->moneda_id][$arrTipo];
					}
				}

				//Asigna el tipo y tamaño de letra para los totales
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Escribir totales
		    	$pdf->Cell(12,3,'TOTALES: ', 0, 0, 'L');  
		    	//Total de registros
	            $pdf->Cell(13,3,$arrTotalRegistrosMoneda[$arrMon->moneda_id], 0, 0, 'R');
	            //Acumulado del subtotal
	            $pdf->Cell(25,3,'$'.number_format($intAcumSubtotalTipoReferencia,2), 0, 0, 'R');
	            //Acumulado del IVA
	            $pdf->Cell(25,3,'$'.number_format($intAcumIvaTipoReferencia,2), 0, 0, 'R');
	           //Acumulado del IEPS
	            $pdf->Cell(25,3,'$'.number_format($intAcumIepsTipoReferencia,2), 0, 0, 'R');
	            //Acumulado del importe total
	            $pdf->Cell(25,3,'$'.number_format($intAcumTotalTipoReferencia,2), 0, 0, 'R');
	            $pdf->Ln(8);//Deja un salto de línea
			}
		}
		//Ejecutar la salida del reporte
		$pdf->Output('ampliacion_plazos_credito.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProspectoID = $this->input->post('intProspectoID');
		$strTipoReferencia = trim($this->input->post('strTipoReferencia'));
		$strBusqueda = trim($this->input->post('strBusqueda'));

		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->plazos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, 
											  $strTipoReferencia, $strBusqueda);
		
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
			$strTituloRangoFechas .= ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		}

     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE PLAZOS DE CRÉDITO '.$strTituloRangoFechas);
		//Si existe id del cliente
		if($intProspectoID > 0)
		{   
			//Seleccionar los datos del cliente que coincide con el id
			$otdProspecto =  $this->clientes->buscar($intProspectoID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'RAZÓN SOCIAL: '.$otdProspecto->razon_social);
		}
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'TIPO DE PAGO')
        		 ->setCellValue('C'.$intPosEncabezados, 'TIPO')
        		 ->setCellValue('D'.$intPosEncabezados, 'RAZÓN SOCIAL')
        		 ->setCellValue('E'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('F'.$intPosEncabezados, 'VENCIMIENTO')
        		 ->setCellValue('G'.$intPosEncabezados, 'DÍAS')
        		 ->setCellValue('H'.$intPosEncabezados, 'NUEVO VENCIMIENTO')
        		 ->setCellValue('I'.$intPosEncabezados, 'AUTORIZA')
        		 ->setCellValue('J'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('K'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('L'.$intPosEncabezados, 'IEPS')
        		 ->setCellValue('M'.$intPosEncabezados, 'TOTAL')
        		 ->setCellValue('N'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('O'.$intPosEncabezados, 'T.C.');
        

        //Definir estilos de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE,
    													'color' => array('rgb' => 'ffffff')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Combinar las siguientes celdas
       	$objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A8:D8');

       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A8:D8')
        		 ->applyFromArray($arrStyleBold);

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A10:O10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:O10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:O10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
		        //Variable que se utiliza para asignar el acumulado del subtotal
				$intAcumSubtotal = 0;
				//Variable que se utiliza para asignar el acumulado del IVA
				$intAcumIva = 0;
				//Variable que se utiliza para asignar el acumulado del IEPS
				$intAcumIeps = 0;
				//Variable que se utiliza para asignar el importe total
				$intTotal = 0;
				//Variables que se utilizan para asignar los valores de la factura
				$strFolio = '';
				$dteFecha = '';
				$strRazonSocial = '';
				$strMoneda = '';
				$intTipoCambio = '';

				 //Asignar objeto con los datos de la factura / forma de pago del pedido de maquinaria
				$objFactura = $this->get_datos_factura($arrCol);

				//Si hay información
				if($objFactura)
				{
					//Asignar valores de la factura / forma de pago del pedido de maquinaria
					$intAcumSubtotal = $objFactura->subtotal;
					$intAcumIva = $objFactura->iva;
					$intAcumIeps = $objFactura->ieps;
					$intTotal = $objFactura->importe;
					$strFolio =  $objFactura->folio;
					$dteFecha = $objFactura->fecha;
					$strRazonSocial =  $objFactura->razon_social;
					$strMoneda = $objFactura->moneda; 
					$intTipoCambio = $objFactura->tipo_cambio;

				}//Cierre de verificación de la factura

				
		    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
				 		 ->setCellValueExplicit('A'.$intFila, $strFolio, PHPExcel_Cell_DataType::TYPE_STRING)
                          ->setCellValue('B'.$intFila, $arrCol->documento_pago)
                         ->setCellValue('C'.$intFila, $arrCol->tipo_referencia)
                         ->setCellValue('D'.$intFila, $strRazonSocial)
                         ->setCellValue('E'.$intFila, $dteFecha)
                         ->setCellValue('F'.$intFila, $arrCol->vencimiento)
                         ->setCellValue('G'.$intFila, $arrCol->dias)
                         ->setCellValue('H'.$intFila, $arrCol->nuevo_vencimiento)
                         ->setCellValueExplicit('I'.$intFila, $arrCol->empleado_autorizacion, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('J'.$intFila, $intAcumSubtotal)
                         ->setCellValue('K'.$intFila, $intAcumIva)
                         ->setCellValue('L'.$intFila, $intAcumIeps)
                         ->setCellValue('M'.$intFila, $intTotal)
                         ->setCellValue('N'.$intFila, $strMoneda)
                         ->setCellValue('O'.$intFila, $intTipoCambio);

				//Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			    
                //Incrementar el contador por cada registro
				$intContador++;
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('J'.$intFilaInicial.':'.'M'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('O'.$intFilaInicial.':'.'O'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.0000');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
		        	 ->getStyle('E'.$intFilaInicial.':'.'F'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('H'.$intFilaInicial.':'.'H'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('J'.$intFilaInicial.':'.'M'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('O'.$intFilaInicial.':'.'O'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('O'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('O'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'ampliacion_plazos_credito.xls', 'plazos de crédito', 
        									$intFila);
	}

	//Método para regresar los datos de la factura / forma de pago del pedido de maquinaria
	public function get_datos_factura($otdResultado)
	{
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objFactura = new stdClass();
		//Variable que se utiliza para asignar el renglón de la forma de pago del pedido de maquinaria
	    $intRenglon = $otdResultado->renglon;
		//Variable que se utiliza para asignar el id de la factura
		$intReferenciaID = $otdResultado->referencia_id;
		//Variable que se utiliza para asignar el tipo de referencia (MAQUINARIA/REFACCIONES/SERVICIO/CARTERA) de la factura
	    $strTipoReferencia = $otdResultado->tipo_referencia;
	    //Si existe renglón, obtener los datos de la  factura del pedido (forma de pago) de maquinaria
		if($intRenglon > 0 && $strTipoReferencia == 'MAQUINARIA')
		{
			//Asignar id de la factura de maquinaria
			$intReferenciaID = $otdResultado->factura_maquinaria_id;
		}

		//Seleccionar los datos de la factura que coincida con el id (primer posición del arreglo)
		$otdFactura = $this->pagos->buscar_facturas_importes(NULL, NULL, NULL, NULL, NULL, 
															$intReferenciaID, 
															$strTipoReferencia)[0];
		//Si hay información
		if($otdFactura)
		{
			//Crear propiedades del objeto
			$objFactura->folio = $otdFactura->folio;
			$objFactura->fecha = $otdFactura->fecha_format;
			$objFactura->moneda_id = $otdFactura->moneda_id;
			$objFactura->codigo_moneda = $otdFactura->moneda_tipo;
			$objFactura->moneda = $otdFactura->descripcion_moneda;
			$objFactura->tipo_cambio = $otdFactura->tipo_cambio;
			$objFactura->razon_social = $otdFactura->razon_social;
			$objFactura->subtotal = $otdFactura->subtotal;
			$objFactura->iva = $otdFactura->iva;
			$objFactura->ieps = $otdFactura->ieps;

			//Asignar los importes de la factura
			$intImporte = $otdFactura->importe;
			$intSubtotal = $otdFactura->subtotal;
			$intIva = $otdFactura->iva;
			$intIeps = $otdFactura->ieps;

			//Si existe renglón, asignar los importes de la forma de pago del pedido de maquinaria
			if($intRenglon > 0  &&  $strTipoReferencia == 'MAQUINARIA')
			{
				//Asignar los importes de la forma de pago
				$intImporte = $otdResultado->importe;
				$intSubtotal = $intImporte;
				$intIva = 0;
				$intIeps = 0;

			}

			$objFactura->subtotal = $intSubtotal;
			$objFactura->iva = $intIva;
			$objFactura->ieps = $intIeps;
			$objFactura->importe = $intImporte;
		}

		//Regresar el objeto con los datos de la factura / forma de pago del pedido de maquinaria
		return $objFactura;
	}
}