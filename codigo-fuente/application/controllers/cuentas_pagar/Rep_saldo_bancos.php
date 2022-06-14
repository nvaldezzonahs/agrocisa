<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_saldo_bancos extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de cuentas bancarias
		$this->load->model('cuentas_pagar/cuentas_bancarias_model', 'cuentas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('cuentas_pagar/rep_saldo_bancos', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con los saldos de las cuentas bancarias
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{	
		
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intCuentaBancariaID = $this->input->post('intCuentaBancariaID');

		//Si existe id de la cuenta bancaria
		if($intCuentaBancariaID > 0)
		{
			//Hacer un llamado a la función para generar un reporte PDF con los movimientos de una cuenta bancaria
			$this->get_reporte_cuenta_bancaria($dteFechaInicial, $dteFechaFinal, $intCuentaBancariaID);
		}
		else
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado general de saldos bancarios
			$this->get_reporte_general($dteFechaInicial, $dteFechaFinal);
		}
	}

    //Método para generar un reporte PDF con los movimientos de una cuenta bancaria
	public function get_reporte_cuenta_bancaria($dteFechaInicial, $dteFechaFinal, $intCuentaBancariaID) 
	{	        
		
		//Variable que se utiliza para asignar el saldo inicial
		$intSaldoInicial = 0;
		//Variable que se utiliza para asignar el saldo actual de la cuenta bancaria
		$intSaldoActual = 0;
		//Variable que se utiliza para asignar el acumulado de los cargos (egresos, pagos y anticipos)
		$intAcumCargos = 0;
		//Variable que se utiliza para asignar el acumulado de los abonos (ingresos)
		$intAcumAbonos = 0;
		//Variable que se utiliza para asignar el acumulado del saldo 
		$intSaldo = 0;

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'SALDO BANCARIO ';
		//Seleccionar los datos de la cuenta bancaria que coincide con el id
		$otdCuentaBancaria =  $this->cuentas->buscar($intCuentaBancariaID);
		//Concatenar los datos de la cuenta bancaria
		$strCuentaBancaria = $otdCuentaBancaria->cuenta.' - '.$otdCuentaBancaria->descripcion;
		//Establece las descripciones del título del reporte (posición segunda línea)
		$pdf->arrDatosLinea2 = array(utf8_decode('CUENTA: '.$strCuentaBancaria),  
						 	  	 	 'FECHA INICIAL: '.$this->get_fecha_formato_letra($dteFechaInicial, 'C')
						 	  	 	 .'                '. 
						 	  	     'FECHA FINAL: '.$this->get_fecha_formato_letra($dteFechaFinal, 'C'),
						 	  	     utf8_decode('MONEDA: '.$otdCuentaBancaria->moneda));

		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('DESCRIPCIÓN'), 'FOLIO', 'AFECTA', 'FECHA',  
								  'CARGO', 'ABONO', 'SALDO');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(38, 20, 52, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'C', 'R', 'R', 'R');
		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(130, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R', 'R');
		//Agregar pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Establecer el color de línea
	    $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Seleccionar el saldo inicial de la cuenta bancaria (primer posición del arreglo)
		$otdSaldoInicial = $this->cuentas->buscar_saldo_cuenta_bancaria($intCuentaBancariaID, 
																		$dteFechaInicial)[0];

	    //Seleccionar el saldo actual de la cuenta bancaria (primer posición del arreglo)
		$otdSaldoActual = $this->cuentas->buscar_saldo_cuenta_bancaria($intCuentaBancariaID, 
																	   $dteFechaInicial, 
																	   $dteFechaFinal)[0];

		//Asignar el saldo inicial
		$intSaldoInicial = $otdSaldoInicial->saldo;
		$intSaldo =  $intSaldoInicial;
		//Calcular el saldo actual
		$intSaldoActual = ($intSaldoInicial + $otdSaldoActual->saldo);
		//Incrementar acumulado
		$intAcumAbonos += $intSaldo;

		//Se agrega la informacion del saldo inicial
		$pdf->Row(array('SALDO INICIAL', '', '', '', '', '$'.number_format($intSaldoInicial,2),
	   					'$'.number_format($intSaldo,2)), 
	    				$pdf->arrAlineacion, 'ClippedCell');

		//Seleccionar los movimientos (ingresos,traspasos, egresos, pagos y anticipos) de la cuenta bancaria
		$otdMovimientos = $this->cuentas->buscar_movimientos_cuentas_bancarias($intCuentaBancariaID, 
																			   $dteFechaInicial, 
																			   $dteFechaFinal);
		//Si hay información
		if($otdMovimientos)
		{
			//Recorremos el arreglo 
			foreach ($otdMovimientos as $arrMov)
			{
				//Variable que se utiliza para asignar el importe total de un egreso, pago o anticipo
				$intTotalCargo = '';
				//Variable que se utiliza para asignar el importe total de un ingreso
				$intTotalAbono = '';
				//Variable que se utiliza para asignar el importe del movimiento
				$intImporte = $arrMov->importe;
				//Variable que se utiliza para asignar el folio de la referencia
				$strFolioReferencia = $arrMov->folio_referencia;

				//Si el tipo de movimiento corresponde a un cargo (egreso, pago o anticipo)
				if($arrMov->tipo == 'cargo')
				{
					//Asignar importe total del egreso, pago o anticipo
					$intTotalCargo = '$'. number_format($intImporte, 2);
					//Incrementar acumulados
					$intSaldo -= $intImporte;
					$intAcumCargos += $intImporte;
				}
				else
				{
					//Asignar el importe total del ingreso
					$intTotalAbono = '$'. number_format($intImporte, 2);
					//Decrementar acumulados 
					$intSaldo += $intImporte;
					$intAcumAbonos += $intImporte;
				}

				//Si el tipo de referencia corresponde a una póliza de abono
				if($arrMov->tipo_referencia == 'POLIZA ABONO')
				{
					//Concatenar folio del detalle
					$strFolioReferencia .= ', '.$arrMov->folio_detalle;
				}


				//Si el tipo de referencia corresponde a un recibo de pago
				if($arrMov->tipo_referencia == 'RECIBO DE PAGO')
				{
					//Concatenar fecha y monto del detalle
					$strFolioReferencia .= '  FECHA: '.$arrMov->fecha_referencia;
					$strFolioReferencia .= '     MONTO: $'.number_format($arrMov->monto_referencia,2);

				}

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
			    $pdf->Row(array(utf8_decode($arrMov->descripcion), $arrMov->folio, $strFolioReferencia, 
					   			$arrMov->fecha_format, $intTotalCargo, $intTotalAbono,
					   			'$'.number_format($intSaldo,2)), 
			    				$pdf->arrAlineacion);

			  

			   
			}

		}//Cierre de verificación de movimientos

		$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
		//Escribir totales
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAnchuraTotales);
		//Cambiar el volumen de la letra
		$pdf->strTipoLetraTabla = 'Negrita';
		$pdf->Row(array('TOTALES: ', 
						'$'.number_format($intAcumCargos, 2), 
						'$'.number_format($intAcumAbonos, 2),
						'$'.number_format($intSaldoActual, 2)), 
						$arrAlineacionTotales, 'ClippedCell');
		//Cambiar el volumen de la letra
		$pdf->strTipoLetraTabla = 'Normal';		

		//Ejecutar la salida del reporte
        $pdf->Output('saldo_bancario_cuenta_'.$otdCuentaBancaria->cuenta.'.pdf','I'); 
	}

	//Método para generar un reporte PDF con el listado general de saldos bancarios
	public function get_reporte_general($dteFechaInicial, $dteFechaFinal) 
	{	        
		//Variable que se utiliza pra asignar el id actual de la moneda
	    $intMonedaIDActual = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo inicial
	    $intAcumSaldoInicial = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo actual
	    $intAcumSaldoActual = 0;

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C'). ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'SALDOS BANCARIOS '.$strTituloRangoFechas;
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('CUENTA', 'SALDO ANTERIOR', 'SALDO ACTUAL');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(130, 30, 30);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'R', 'R');
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Establecer el color de línea
	    $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Seleccionar todas las cuentas bancarias
		$otdResultado = $this->cuentas->buscar();
		//Si hay información
		if($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Asignar el id de la cuenta bancaria 
				$intCuentaBancariaID = $arrCol->cuenta_bancaria_id;

				//Si la moneda actual es igual a cero (primer moneda)
				if ($intMonedaIDActual == 0)
				{	
					//Cambiar el volumen de la letra
					$pdf->strTipoLetraTabla = 'Negrita';
					//Moneda
					$pdf->Row(array(utf8_decode('MONEDA:  '.$arrCol->moneda)), 
								$pdf->arrAlineacion, 'ClippedCell');
					//Cambiar el volumen de la letra
					$pdf->strTipoLetraTabla = 'Normal';	

					//Asignar id del moneda actual
	      			$intMonedaIDActual = $arrCol->moneda_id;
				}

				//Si la moneda actual es diferente a la anterior
   				if ($intMonedaIDActual != $arrCol->moneda_id)
				{
					$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
					//Escribir totales
			        //Cambiar el volumen de la letra
					$pdf->strTipoLetraTabla = 'Negrita';
					$pdf->Row(array('TOTALES: ', 
	   								'$'.number_format($intAcumSaldoInicial, 2), 
	   								'$'.number_format($intAcumSaldoActual, 2)), 
	   								$arrAlineacionTotales, 'ClippedCell');
	   				//Cambiar el volumen de la letra
					$pdf->strTipoLetraTabla = 'Normal';	

					$pdf->Ln(5); //Deja un salto de línea
					
					//Cambiar el volumen de la letra
					$pdf->strTipoLetraTabla = 'Negrita';
					//Moneda
					$pdf->Row(array(utf8_decode('MONEDA:  '.$arrCol->moneda)), 
								$pdf->arrAlineacion, 'ClippedCell');
					//Cambiar el volumen de la letra
					$pdf->strTipoLetraTabla = 'Normal';	

					//Inicializar variables
					$intAcumSaldoInicial = 0;
					$intAcumSaldoActual = 0;
				}


			    //Seleccionar el saldo inicial de la cuenta bancaria (primer posición del arreglo)
				$otdSaldoInicial = $this->cuentas->buscar_saldo_cuenta_bancaria($intCuentaBancariaID, 
																				$dteFechaInicial)[0];

			    //Seleccionar el saldo actual de la cuenta bancaria (primer posición del arreglo)
				$otdSaldoActual = $this->cuentas->buscar_saldo_cuenta_bancaria($intCuentaBancariaID, 
																			   $dteFechaInicial, 
																			   $dteFechaFinal)[0];
				//Asignar el saldo inicial
				$intSaldoInicial = $otdSaldoInicial->saldo;
				//Calcular el saldo actual
				$intSaldoActual = ($intSaldoInicial + $otdSaldoActual->saldo);

				//Concatenar datos de la cuenta bancaria
				$strCuentaBancaria = $arrCol->cuenta.' - '.$arrCol->descripcion;

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($strCuentaBancaria), 
								'$'.number_format($intSaldoInicial,2),
								'$'.number_format($intSaldoActual,2)),
								$pdf->arrAlineacion, 'ClippedCell');


				//Asignar id de la moneda actual
				$intMonedaIDActual = $arrCol->moneda_id;
				//Incrementar acumulados
                $intAcumSaldoInicial += $intSaldoInicial;
                $intAcumSaldoActual += $intSaldoActual;
                

			}

			//Escribir los acumulados del última moneda
			if ($intMonedaIDActual > 0)
			{
				$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
				//Escribir totales
		        //Cambiar el volumen de la letra
				$pdf->strTipoLetraTabla = 'Negrita';
				$pdf->Row(array('TOTALES: ', 
   								'$'.number_format($intAcumSaldoInicial, 2), 
   								'$'.number_format($intAcumSaldoActual, 2)), 
   								$arrAlineacionTotales, 'ClippedCell');
   				//Cambiar el volumen de la letra
				$pdf->strTipoLetraTabla = 'Normal';	
			}

			$pdf->Ln(10);//Deja un salto de linea
		}

		//Ejecutar la salida del reporte
        $pdf->Output('saldos_bancarios_general.pdf','I'); 
	}


	/*Método para generar un archivo XLS con los saldos de las cuentas bancarias
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intCuentaBancariaID = $this->input->post('intCuentaBancariaID');

		//Si existe id de la cuenta bancaria
		if($intCuentaBancariaID > 0)
		{
			//Hacer un llamado a la función para generar un archivo XLS con los movimientos de una cuenta bancaria
			$this->get_xls_cuenta_bancaria($dteFechaInicial, $dteFechaFinal, $intCuentaBancariaID);
		}
		else
		{

			//Hacer un llamado a la función para generar un archivo XLS con el listado general de saldos bancarios
			$this->get_xls_general($dteFechaInicial, $dteFechaFinal);
		}
	}

	//Método para generar un archivo XLS con los movimientos de una cuenta bancaria
	public function get_xls_cuenta_bancaria($dteFechaInicial, $dteFechaFinal, $intCuentaBancariaID) 
	{	
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
 		
		//Número de fila donde se va a comenzar a rellenar
	    $intFila = 14;
	    $intFilaInicial = 14;
 	    //Variable que se utiliza para asignar el saldo inicial
		$intSaldoInicial = 0;
		//Variable que se utiliza para asignar el saldo actual de la cuenta bancaria
		$intSaldoActual = 0;
		//Variable que se utiliza para asignar el acumulado de los cargos (egresos, pagos y anticipos)
		$intAcumCargos = 0;
		//Variable que se utiliza para asignar el acumulado de los abonos (ingresos)
		$intAcumAbonos = 0;
		//Variable que se utiliza para asignar el acumulado del saldo 
		$intSaldo = 0;

      	//Seleccionar los datos de la cuenta bancaria que coincide con el id
		$otdCuentaBancaria =  $this->cuentas->buscar($intCuentaBancariaID);

     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
		//Se agrega el título del archivo
		$objExcel->getActiveSheet()->setCellValue('A7', 'SALDO BANCARIO');
		$objExcel->getActiveSheet()->setCellValue('A8', 'CUENTA: '.$otdCuentaBancaria->cuenta.' - '.$otdCuentaBancaria->descripcion);
	
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

	    //Seleccionar el saldo inicial de la cuenta bancaria (primer posición del arreglo)
		$otdSaldoInicial = $this->cuentas->buscar_saldo_cuenta_bancaria($intCuentaBancariaID, 
																		$dteFechaInicial)[0];

	    //Seleccionar el saldo actual de la cuenta bancaria (primer posición del arreglo)
		$otdSaldoActual = $this->cuentas->buscar_saldo_cuenta_bancaria($intCuentaBancariaID, 
																	   $dteFechaInicial, 
																	   $dteFechaFinal)[0];
	    //Asignar el saldo inicial
		$intSaldoInicial = $otdSaldoInicial->saldo;
		$intSaldo =  $intSaldoInicial;
		//Calcular el saldo actual
		$intSaldoActual = ($intSaldoInicial + $otdSaldoActual->saldo);
		//Incrementar acumulado
		$intAcumAbonos += $intSaldo;

		//Se agrega el rango de fechas
        $objExcel->getActiveSheet()
        		 ->setCellValue('A'.$intPosEncabezados, 'FECHA INICIAL:')
        		 ->setCellValue('B'.$intPosEncabezados, $this->get_fecha_formato_letra($dteFechaInicial, 'C'))
                 ->setCellValue('C'.$intPosEncabezados, 'FECHA FINAL:')
                 ->setCellValue('D'.$intPosEncabezados, $this->get_fecha_formato_letra($dteFechaFinal, 'C'))
                 ->setCellValue('E'.$intPosEncabezados, 'MONEDA:')
                 ->setCellValue('F'.$intPosEncabezados, $otdCuentaBancaria->moneda);

        //Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A'.$intPosEncabezados)
        		 ->applyFromArray($arrStyleBold);

        $objExcel->getActiveSheet()
        		 ->getStyle('C'.$intPosEncabezados)
        		 ->applyFromArray($arrStyleBold);

        $objExcel->getActiveSheet()
        		 ->getStyle('E'.$intPosEncabezados)
        		 ->applyFromArray($arrStyleBold);

        //Cambiar alineación de las siguientes celdas
        $objExcel->getActiveSheet()
	        	 ->getStyle('A'.$intPosEncabezados)
	        	 ->getAlignment()
	        	 ->applyFromArray($arrStyleAlignmentRight);

        $objExcel->getActiveSheet()
        	 ->getStyle('C'.$intPosEncabezados)
        	 ->getAlignment()
        	 ->applyFromArray($arrStyleAlignmentRight);

         $objExcel->getActiveSheet()
        	 ->getStyle('E'.$intPosEncabezados)
        	 ->getAlignment()
        	 ->applyFromArray($arrStyleAlignmentRight);

        //Incrementar el indice para escribir los datos del encabezado
        $intPosEncabezados++;

        //Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A'.$intPosEncabezados)
        		 ->applyFromArray($arrStyleBold);

        $objExcel->getActiveSheet()
        		 ->getStyle('C'.$intPosEncabezados)
        		 ->applyFromArray($arrStyleBold);

        //Incrementar el indice para escribir cabecera
        $intPosEncabezados+=2;

  		//Se agregan las columnas de cabecera
        $objExcel->getActiveSheet()->setCellValue('A'.$intPosEncabezados, 'DESCRIPCIÓN')
                 ->setCellValue('B'.$intPosEncabezados, 'FOLIO')
                 ->setCellValue('C'.$intPosEncabezados, 'AFECTA')
                 ->setCellValue('D'.$intPosEncabezados, 'FECHA')
                 ->setCellValue('E'.$intPosEncabezados, 'CARGO')
                 ->setCellValue('F'.$intPosEncabezados, 'ABONO')
                 ->setCellValue('G'.$intPosEncabezados, 'SALDO');


        //Combinar las siguientes celdas
       	$objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A8:D8');

       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A8:D8')
        		 ->applyFromArray($arrStyleBold);

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A13:G13')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A13:G13')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A13:G13')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

	   
       	
         //Agregar información del saldo inicial
		 $objExcel->getActiveSheet()
		 		 ->setCellValue('A'.$intFila, 'SALDO INICIAL')
                 ->setCellValue('F'.$intFila, $intSaldoInicial)
                 ->setCellValue('G'.$intFila, $intSaldo);

        //Incrementar el indice para escribir los datos del siguiente registro
        $intFila++;

        //Seleccionar los movimientos (ingresos, traspasos, egresos, pagos y anticipos) de la cuenta bancaria
		$otdMovimientos = $this->cuentas->buscar_movimientos_cuentas_bancarias($intCuentaBancariaID, 
																			   $dteFechaInicial, 
																			   $dteFechaFinal);
		//Si hay información
		if($otdMovimientos)
		{
			//Recorremos el arreglo 
			foreach ($otdMovimientos as $arrMov)
			{
				//Variable que se utiliza para asignar el importe total de un egreso, pago o anticipo
				$intTotalCargo = '';
				//Variable que se utiliza para asignar el importe total de un ingreso
				$intTotalAbono = '';
				//Variable que se utiliza para asignar el importe del movimiento
				$intImporte = $arrMov->importe;
				//Variable que se utiliza para asignar el folio de la referencia
				$strFolioReferencia = $arrMov->folio_referencia;

				//Si el tipo de movimiento corresponde a un cargo (egreso, pago o anticipo)
				if($arrMov->tipo == 'cargo')
				{
					//Asignar importe total del egreso, pago o anticipo
					$intTotalCargo = $intImporte;
					//Incrementar acumulados
					$intSaldo -= $intImporte;
					$intAcumCargos += $intImporte;
				}
				else
				{
					//Asignar el importe total del ingreso
					$intTotalAbono = $intImporte;
					//Decrementar acumulados 
					$intSaldo += $intImporte;
					$intAcumAbonos += $intImporte;
				}

				//Si el tipo de referencia corresponde a una póliza de abono
				if($arrMov->tipo_referencia == 'POLIZA ABONO')
				{
					//Concatenar folio del detalle
					$strFolioReferencia .= ', '.$arrMov->folio_detalle;
				}

				//Si el tipo de referencia corresponde a un recibo de pago
				if($arrMov->tipo_referencia == 'RECIBO DE PAGO')
				{
					//Concatenar fecha y monto del detalle
					$strFolioReferencia .= '  FECHA: '.$arrMov->fecha_referencia;
					$strFolioReferencia .= '     MONTO: $'.number_format($arrMov->monto_referencia,2);

				}

			    //Agregar información del movimiento
				$objExcel->getActiveSheet()
				 		 ->setCellValue('A'.$intFila, $arrMov->descripcion)
				 		 ->setCellValueExplicit('B'.$intFila, $arrMov->folio, PHPExcel_Cell_DataType::TYPE_STRING)
				 		 ->setCellValueExplicit('C'.$intFila, $strFolioReferencia, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('D'.$intFila, $arrMov->fecha_format)
                         ->setCellValue('E'.$intFila, $intTotalCargo)
                         ->setCellValue('F'.$intFila, $intTotalAbono)
                         ->setCellValue('G'.$intFila, $intSaldo);

                //Incrementar el indice para escribir los datos del siguiente registro
           		$intFila++;

			}

		}//Cierre de verificación de movimientos

		//Asignar indice de fila donde se empezaran a escribir los totales
        $intFilaTotales = $intFila;

		//Escribir totales
    	//Agregar información de los totales
		$objExcel->getActiveSheet()
                 ->setCellValue('D'.$intFilaTotales, 'TOTALES:')
                 ->setCellValue('E'.$intFilaTotales, $intAcumCargos)
                 ->setCellValue('F'.$intFilaTotales, $intAcumAbonos)
                 ->setCellValue('G'.$intFilaTotales, $intSaldoActual);


        //Cambiar contenido de las celdas a formato moneda
   		$objExcel->getActiveSheet()
        		 ->getStyle('E'.$intFilaInicial.':'.'G'.$intFila)
        		 ->getNumberFormat()
        		 ->setFormatCode('$#,##0.00');

       	//Cambiar alineación de las siguientes celdas
       	$objExcel->getActiveSheet()
	        	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
	        	 ->getAlignment()
	        	 ->applyFromArray($arrStyleAlignmentCenter);

	    $objExcel->getActiveSheet()
	        	 ->getStyle('D'.$intFilaTotales.':'.'D'.$intFilaTotales)
	        	 ->getAlignment()
	        	 ->applyFromArray($arrStyleAlignmentRight);
	        	 
		$objExcel->getActiveSheet()
	        	 ->getStyle('E'.$intFilaInicial.':'.'G'.$intFila)
	        	 ->getAlignment()
	        	 ->applyFromArray($arrStyleAlignmentRight);

	    //Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('D'.$intFila.':'.'G'.$intFila)
        		 ->applyFromArray($arrStyleBold);	

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'saldo_bancario_cuenta_'.$otdCuentaBancaria->cuenta.'.xls', 'movimientos', $intFila);
	}
    
    //Método para generar un archivo XLS con el listado general de saldos bancarios
	public function get_xls_general($dteFechaInicial, $dteFechaFinal) 
	{	
		//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Variable que se utiliza pra asignar el id actual de la moneda
	    $intMonedaIDActual = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo inicial
	    $intAcumSaldoInicial = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo actual
	    $intAcumSaldoActual = 0;
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C'). ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
        //Seleccionar todas las cuentas bancarias
		$otdResultado = $this->cuentas->buscar();
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'SALDOS BANCARIOS '.$strTituloRangoFechas);
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'CUENTA')
                 ->setCellValue('B'.$intPosEncabezados, 'SALDO ANTERIOR')
                 ->setCellValue('C'.$intPosEncabezados, 'SALDO ACTUAL');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:C9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Asignar el id de la cuenta bancaria 
				$intCuentaBancariaID = $arrCol->cuenta_bancaria_id;

				//Si la moneda actual es igual a cero (primer moneda)
				if ($intMonedaIDActual == 0)
				{
					//Agregar descripción de la moneda
					$objExcel->setActiveSheetIndex(0)
					         ->setCellValue('A'.$intFila, 'MONEDA: '.$arrCol->moneda);

					//Cambiar estilo de la celda
		            $objExcel->getActiveSheet()
		            		 ->getStyle('A'.$intFila)
		            		 ->applyFromArray($arrStyleBold);

					//Asignar id del moneda actual
	      			$intMonedaIDActual = $arrCol->moneda_id;
	      			//Incrementar el indice para escribir los datos de la cuenta bancaria
                	$intFila++; 
				}

				//Si la moneda actual es diferente a la anterior
   				if ($intMonedaIDActual != $arrCol->moneda_id)
				{
					//Escribir totales
			        //Agregar información de los acumulados
					$objExcel->setActiveSheetIndex(0)
						     ->setCellValue('A'.$intFila, 'TOTALES:')
                             ->setCellValue('B'.$intFila, $intAcumSaldoInicial)
                             ->setCellValue('C'.$intFila, $intAcumSaldoActual);

                    //Cambiar estilo de las celdas
		            $objExcel->getActiveSheet()
		            		 ->getStyle('A'.$intFila.':'.'C'.$intFila)
		            		 ->applyFromArray($arrStyleBold);

		            //Cambiar alineación de la celda
					$objExcel->getActiveSheet()
		                	 ->getStyle('A'.$intFila)
		                	 ->getAlignment()
		                	 ->applyFromArray($arrStyleAlignmentRight);


					//Incrementar el indice para escribir los datos de la cuenta bancaria
                	$intFila+= 2; 

					//Agregar descripción de la moneda
					$objExcel->setActiveSheetIndex(0)
					         ->setCellValue('A'.$intFila, 'MONEDA: '.$arrCol->moneda);

					//Cambiar estilo de la celda
		            $objExcel->getActiveSheet()
		            		 ->getStyle('A'.$intFila)
		            		 ->applyFromArray($arrStyleBold);


					//Inicializar variables
					$intAcumSaldoInicial = 0;
					$intAcumSaldoActual = 0;
					//Incrementar el indice para escribir los datos de la cuenta bancaria
                	$intFila++; 
				}


				//Seleccionar el saldo inicial de la cuenta bancaria (primer posición del arreglo)
				$otdSaldoInicial = $this->cuentas->buscar_saldo_cuenta_bancaria($intCuentaBancariaID, 
																				$dteFechaInicial)[0];

			    //Seleccionar el saldo actual de la cuenta bancaria (primer posición del arreglo)
				$otdSaldoActual = $this->cuentas->buscar_saldo_cuenta_bancaria($intCuentaBancariaID, 
																			   $dteFechaInicial, 
																			   $dteFechaFinal)[0];

				//Asignar el saldo inicial
				$intSaldoInicial = $otdSaldoInicial->saldo;
				//Calcular el saldo actual
				$intSaldoActual = ($intSaldoInicial + $otdSaldoActual->saldo);

				//Concatenar datos de la cuenta bancaria
				$strCuentaBancaria = $arrCol->cuenta.' - '.$arrCol->descripcion;

				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFila, $strCuentaBancaria)
                         ->setCellValue('B'.$intFila, $intSaldoInicial)
                         ->setCellValue('C'.$intFila, $intSaldoActual);

                //Asignar id de la moneda actual
				$intMonedaIDActual = $arrCol->moneda_id;
				//Incrementar acumulados
                $intAcumSaldoInicial += $intSaldoInicial;
                $intAcumSaldoActual += $intSaldoActual;      
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}
			
		}

		//Escribir los acumulados del última moneda
		if ($intMonedaIDActual > 0)
		{
			//Escribir totales
			//Agregar información de los acumulados
			$objExcel->setActiveSheetIndex(0)
						     ->setCellValue('A'.$intFila, 'TOTALES:')
                             ->setCellValue('B'.$intFila, $intAcumSaldoInicial)
                             ->setCellValue('C'.$intFila, $intAcumSaldoActual);

            //Cambiar estilo de las celdas
            $objExcel->getActiveSheet()
            		 ->getStyle('A'.$intFila.':'.'C'.$intFila)
            		 ->applyFromArray($arrStyleBold);

            //Cambiar alineación de la celda
			$objExcel->getActiveSheet()
                	 ->getStyle('A'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);
		}

		//Cambiar contenido de las celdas a formato moneda
        $objExcel->getActiveSheet()
        		 ->getStyle('B'.$intFilaInicial.':'.'C'.$intFila)
        		 ->getNumberFormat()
        		 ->setFormatCode('$#,##0.00');

		//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('B'.$intFilaInicial.':'.'C'.$intFila)
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentRight);

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'saldos_bancarios_general.xls', 'saldos', $intFila);
	}	
   
}