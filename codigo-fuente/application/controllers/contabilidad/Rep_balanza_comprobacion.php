<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_balanza_comprobacion extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
	    //Cargamos el modelo de catalogo de cuentas
		$this->load->model('contabilidad/catalogo_cuentas_model', 'cuentas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('contabilidad/rep_balanza_comprobacion', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	/*Método para generar un reporte PDF con la balanza de comprobación
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strNivel = $this->input->post('strNivel');
		$strTipoReporte = $this->input->post('strTipoReporte');

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .=	 ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

		//Seleccionar las cuentas contables correspondientes al nivel
		$otdCuentas = $this->cuentas->buscar(NULL, NULL, NULL, 'BALANZA COMPROBACION', $strNivel);

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  utf8_decode('BALANZA DE COMPROBACIÓN ').$strTituloRangoFechas;
		//Crea los titulos de la primer cabecera 
		$pdf->arrCabecera = array('CUENTA', 'NOMBRE', 'SALDO ANTERIOR', 'MOVIMIENTOS',
								  'SALDO ACTUAL');
		//Crea los titulos de la segunda cabecera 
		$pdf->arrCabecera2 = array('', '', 'DEUDOR','ACREEDOR', 'CARGO','ABONO', 
								   'DEUDOR','ACREEDOR');
		//Establece el ancho de las columnas de las cabeceras
		$pdf->arrAnchura = array(20, 50, 40, 40, 40);
		$pdf->arrAnchura2 = array(20, 50, 20, 20, 20, 20, 20, 20);
		//Establece la alineación de las celdas de las tablas
		$pdf->arrAlineacion = array('L', 'L', 'C', 'C', 'C');
	    $pdf->arrAlineacion2 = array('L', 'L', 'R', 'R', 'R', 'R', 'R', 'R');
	    //Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(70, 20, 20, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R', 'R', 'R', 'R', 'R');


		//Establecer el color de línea
	    $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
	    $pdf->SetWidths($pdf->arrAnchura2);

	    //Variables que se utilizan para asignar acumulados de cargos y abonos
	    $intAcumCargosSdoInicial = 0;
	    $intAcumAbonosSdoInicial = 0;
	    $intAcumCargosMov = 0;
	    $intAcumAbonosMov = 0;
	    $intAcumCargosSdoActual = 0;
	    $intAcumAbonosSdoActual = 0;

	    //Si hay información
		if($otdCuentas)
		{
			//Recorremos el arreglo 
			foreach ($otdCuentas as $arrCta)
			{

				//Asignar objeto con los saldos de la cuenta contable 
			   	 $otdSaldos = $this->get_datos_reporte('PDF', $dteFechaInicial, $dteFechaFinal, 
			    								       $arrCta, $strNivel, $strTipoReporte);

			    //Asignar array con los datos de la cuenta
			    $arrDatosCta = $otdSaldos['rows'];
			    //Asignar el acumulado de los cargos del saldo inicial
				$intAcumCargosSdoInicial +=  $otdSaldos['acumulado_cargos_saldo_inicial'];
				//Asignar el acumulado de los abonos del saldo inicial
				$intAcumAbonosSdoInicial +=  $otdSaldos['acumulado_abonos_saldo_inicial'];
				//Asignar el acumulado de los cargos de movimientos
				$intAcumCargosMov +=  $otdSaldos['acumulado_cargos_movimientos'];
				//Asignar el acumulado de los abonos de movimientos
				$intAcumAbonosMov +=  $otdSaldos['acumulado_abonos_movimientos'];
				 //Asignar el acumulado de los cargos del saldo actual
				$intAcumCargosSdoActual +=  $otdSaldos['acumulado_cargos_saldo_actual'];
				//Asignar el acumulado de los abonos del saldo actual
				$intAcumAbonosSdoActual +=  $otdSaldos['acumulado_abonos_saldo_actual'];
				

				//Si hay información de la cuenta
			    if($arrDatosCta)
				{
				    //Recorremos el arreglo 
					foreach ($arrDatosCta as $arrDet)
					{

						//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				   		$pdf->Row(array($arrDet['cuenta'], 
				   						$arrDet['descripcion'], 
				   						$arrDet['cargos_saldo_inicial'], 
				   						$arrDet['abonos_saldo_inicial'], 
				   						$arrDet['cargos_movimientos'], 
				   						$arrDet['abonos_movimientos'], 
				   						$arrDet['cargos_saldo_actual'], 
				   						$arrDet['abonos_saldo_actual']), 
				    				    $pdf->arrAlineacion2, 'ClippedCell');
					}

				}//Cierre de verificación de información 

				

			}//Cierre de foreach (cuentas)

			$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
			//Escribir totales
			//Establece el ancho de las columnas
    		$pdf->SetWidths($arrAnchuraTotales);
			//Cambiar el volumen de la letra
			$pdf->strTipoLetraTabla = 'Negrita';
			//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
			$pdf->Row(array('TOTAL:', 
	   						'$'.number_format($intAcumCargosSdoInicial, 2, '.', ','), 
	   						'$'.number_format($intAcumAbonosSdoInicial, 2, '.', ','), 
	   						'$'.number_format($intAcumCargosMov, 2, '.', ','), 
	   						'$'.number_format($intAcumAbonosMov, 2, '.', ','), 
	   						'$'.number_format($intAcumCargosSdoActual, 2, '.', ','), 
	   						'$'.number_format($intAcumAbonosSdoActual, 2, '.', ',')), 
	    				    $arrAlineacionTotales, 'ClippedCell');
			//Cambiar el volumen de la letra
			$pdf->strTipoLetraTabla = 'Normal';	

		}//Cierre de verificación de cuentas


	    //Ejecutar la salida del reporte
        $pdf->Output('balanza_comprobacion.pdf','I'); 
	}

	/*Método para generar un archivo XLS con la balanza de comprobación
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strNivel = $this->input->post('strNivel');
		$strTipoReporte = $this->input->post('strTipoReporte');
		//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;
        //Variables que se utilizan para asignar acumulados de cargos y abonos
	    $intAcumCargosSdoInicial = 0;
	    $intAcumAbonosSdoInicial = 0;
	    $intAcumCargosMov = 0;
	    $intAcumAbonosMov = 0;
	    $intAcumCargosSdoActual = 0;
	    $intAcumAbonosSdoActual = 0;

        //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');


		//Seleccionar las cuentas contables correspondientes al nivel
		$otdCuentas = $this->cuentas->buscar(NULL, NULL, NULL, 'BALANZA COMPROBACION', $strNivel);

		//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE,
        												'name' => 'Arial',
        												'size' => 9,
    													'color' => array('rgb' => 'ffffff')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'BALANZA DE COMPROBACIÓN '.$strTituloRangoFechas);
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'CUENTA')
        		 ->setCellValue('B'.$intPosEncabezados, 'NOMBRE')
        		 ->setCellValue('C'.$intPosEncabezados, 'SALDO ANTERIOR')
        		 ->setCellValue('E'.$intPosEncabezados, 'MOVIMIENTOS')
                 ->setCellValue('G'.$intPosEncabezados, 'SALDO ACTUAL');



        //Incrementar indice para escribir la segunda cabecera
        $intPosEncabezados++;

        //Se agregan las columnas de cabecera 2
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('C'.$intPosEncabezados, 'DEUDOR')
        		 ->setCellValue('D'.$intPosEncabezados, 'ACREEDOR')
        		 ->setCellValue('E'.$intPosEncabezados, 'CARGO')
        		 ->setCellValue('F'.$intPosEncabezados, 'ABONO')
                 ->setCellValue('G'.$intPosEncabezados, 'DEUDOR')
                 ->setCellValue('H'.$intPosEncabezados, 'ACREEDOR');


        //Combinar las siguientes celdas
		$objExcel->getActiveSheet()->mergeCells('C9:D9');
		$objExcel->getActiveSheet()->mergeCells('E9:F9');
		$objExcel->getActiveSheet()->mergeCells('G9:H9');

        //Preferencias de color de relleno de celda
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:H10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);


    	//Preferencias de color de texto de la celda
		$objExcel->getActiveSheet()
		    			 ->getStyle('A10:H10')
		    			 ->applyFromArray($arrStyleFuenteColumnas);


    	//Cambiar alineación de las siguientes celdas
    	$objExcel->getActiveSheet()
            	 ->getStyle('A10:H10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);



	    //Si hay información
		if($otdCuentas)
		{
			//Recorremos el arreglo 
			foreach ($otdCuentas as $arrCta)
			{

				//Asignar objeto con los saldos de la cuenta contable 
		   		 $otdSaldos = $this->get_datos_reporte('EXCEL', $dteFechaInicial, $dteFechaFinal, 
		    								      		$arrCta, $strNivel, $strTipoReporte);
				

			    //Asignar array con los datos de la cuenta
			    $arrDatosCta = $otdSaldos['rows'];
			    //Asignar el acumulado de los cargos del saldo inicial
				$intAcumCargosSdoInicial +=  $otdSaldos['acumulado_cargos_saldo_inicial'];
				//Asignar el acumulado de los abonos del saldo inicial
				$intAcumAbonosSdoInicial +=  $otdSaldos['acumulado_abonos_saldo_inicial'];
				//Asignar el acumulado de los cargos de movimientos
				$intAcumCargosMov +=  $otdSaldos['acumulado_cargos_movimientos'];
				//Asignar el acumulado de los abonos de movimientos
				$intAcumAbonosMov +=  $otdSaldos['acumulado_abonos_movimientos'];
				 //Asignar el acumulado de los cargos del saldo actual
				$intAcumCargosSdoActual +=  $otdSaldos['acumulado_cargos_saldo_actual'];
				//Asignar el acumulado de los abonos del saldo actual
				$intAcumAbonosSdoActual +=  $otdSaldos['acumulado_abonos_saldo_actual'];

			    

				//Si hay información de la cuenta
			    if($arrDatosCta)
				{
				    //Recorremos el arreglo 
					foreach ($arrDatosCta as $arrDet)
					{

					    //Agregar información del registro
						$objExcel->setActiveSheetIndex(0)
				   				 ->setCellValue('A'.$intFila,$arrDet['cuenta']) 
				   				 ->setCellValue('B'.$intFila,$arrDet['descripcion']) 
				   				 ->setCellValue('C'.$intFila,$arrDet['cargos_saldo_inicial']) 
				   				 ->setCellValue('D'.$intFila,$arrDet['abonos_saldo_inicial']) 
				   				 ->setCellValue('E'.$intFila,$arrDet['cargos_movimientos']) 
				   				 ->setCellValue('F'.$intFila,$arrDet['abonos_movimientos']) 
				   				 ->setCellValue('G'.$intFila,$arrDet['cargos_saldo_actual']) 
				   				 ->setCellValue('H'.$intFila,$arrDet['abonos_saldo_actual']);

				   		//Incrementar el indice para escribir los datos del siguiente registro
                		$intFila++; 
					}

				}//Cierre de verificación de información 

			}//Cierre de foreach (cuentas)

			//Agregar información del total
			$objExcel->getActiveSheet()
	                 ->setCellValue('B'.$intFila, 'TOTAL:')
	                 ->setCellValue('C'.$intFila,$intAcumCargosSdoInicial)
	                 ->setCellValue('D'.$intFila,$intAcumAbonosSdoInicial)
	                 ->setCellValue('E'.$intFila,$intAcumCargosMov)
	                 ->setCellValue('F'.$intFila,$intAcumAbonosMov)
	                 ->setCellValue('G'.$intFila,$intAcumCargosSdoActual)
	                 ->setCellValue('H'.$intFila,$intAcumAbonosSdoActual);


			//Cambiar contenido de las celdas a formato moneda
       		$objExcel->getActiveSheet()
            		 ->getStyle('C'.$intFilaInicial.':'.'H'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            //Cambiar alineación de las siguientes celdas
		 	$objExcel->getActiveSheet()
	        	 	 ->getStyle('C'.$intFilaInicial.':'.'H'.$intFila)
	        	 	 ->getAlignment()
	        	 	 ->applyFromArray($arrStyleAlignmentRight);

	        $objExcel->getActiveSheet()
	        	 	 ->getStyle('B'.$intFila)
	        	 	 ->getAlignment()
	        	 	 ->applyFromArray($arrStyleAlignmentRight);

	        //Cambiar estilo de las siguientes celdas
		    $objExcel->getActiveSheet()
	                 ->getStyle('B'.$intFila.':H'.$intFila)
	                 ->applyFromArray($arrStyleBold);


		}//Cierre de verificación de cuentas

		
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'balanza_comprobacion.xls', 
        								    'balanza', $intFila);

	}
	

	

  	//Función que se utiliza para escribir los datos del reporte
  	public function  get_datos_reporte($strTipoArchivo, $dteFechaInicial, $dteFechaFinal, 
  									   $arrCta, $strNivel, $strTipoReporte)
  	{	

  		//Array que se utiliza para enviar datos
		$arrDatos = array('rows' => NULL, 
						  'acumulado_cargos_saldo_inicial' => '0.00',
						  'acumulado_abonos_saldo_inicial' => '0.00',
						  'acumulado_cargos_movimientos' => '0.00',
						  'acumulado_abonos_movimientos' => '0.00',
						  'acumulado_cargos_saldo_actual' => '0.00', 
						  'acumulado_abonos_saldo_actual' => '0.00');

		

  		//Array que se utiliza para agregar los datos de la cuenta
		$arrDatosCta = array();
		//Array que se utiliza para agregar los datos de una cuenta
       	$arrAuxiliar = array();
  		//Variable que se utiliza para asignar el saldo inicial
		$intSaldoInicial = 0;
		//Variable que se utiliza para asignar el saldo actual
		$intSaldoActual = 0;
		//Variable que se utiliza para asignar el acumulado de los cargos para calcular el saldo inicial
		$intCargosSdoInicial = 0;
		//Variable que se utiliza para asignar el acumulado de los abonos para calcular el saldo inicial
		$intAbonosSdoInicial = 0;
		//Variable que se utiliza para asignar el acumulado de los cargos para calcular el saldo actual
		$intCargosSdoActual = 0;
		//Variable que se utiliza para asignar el acumulado de los abonos para calcular el saldo actual
		$intAbonosSdoActual = 0;
		//Variable que se utiliza para asignar el acumulado de los cargos (movimientos)
		$intAcumCargos = 0;
		//Variable que se utiliza para asignar el acumulado de los abonos (movimientos)
		$intAcumAbonos = 0;
		//Variable que se utiliza para asignar el saldo inicial de una cuenta de naturaleza: DEUDORA
		$intSaldoInicialCtaDeudora = '';
		//Variable que se utiliza para asignar el saldo inicial de una cuenta de naturaleza: ACREEDORA
		$intSaldoInicialCtaAcreedora = '';
		//Variable que se utiliza para asignar el saldo actual de una cuenta de naturaleza: DEUDORA
		$intSaldoActualCtaDeudora = '';
		//Variable que se utiliza para asignar el saldo actual de una cuenta de naturaleza: ACREEDORA
		$intSaldoActualCtaAcreedora = '';
		//Variable que se utiliza para asignar el acumulado del saldo inicial de cuentas acreedoras
		$intAcumSaldoInicialCtaAcreedora = 0;
		//Variable que se utiliza para asignar el acumulado del saldo actual de cuentas acreedoras
		$intAcumSaldoActualCtaAcreedora = 0;
		//Variable que se utiliza para asignar el acumulado del saldo inicial de cuentas deudoras
		$intAcumSaldoInicialCtaDeudora = 0;
		//Variable que se utiliza para asignar el acumulado del saldo actual de cuentas deudoras
		$intAcumSaldoActualCtaDeudora = 0;
		//Variable que se utiliza para asignar el acumulado de los cargos (movimientos)
		$intTotalCargos = 0;
		//Variable que se utiliza para asignar el acumulado de los abonos (movimientos)
		$intTotalAbonos = 0;
		//Variable que se utiliza para agregar cuenta en el reporte (asignar NO para evitar mostrar los datos de la cuenta)
		$strAgregarCta = 'NO';
		//Variable que se utiliza para incrementar acumulados de saldos (asignar NO para evitar acumular saldos)
		$strIncAcumulados = 'NO';

		//Variable que se utiliza para asignar cuenta
		$strCuenta = '';

  		//Seleccionar los saldos de la cuenta contable
  		$otdSaldosCta = $this->cuentas->buscar_saldos_cuenta_balanza_comp($dteFechaInicial, 
  																	      $dteFechaFinal, 
  																	      $arrCta, $strNivel);

  		//Si hay información
		if($otdSaldosCta)
		{
			//Recorremos el arreglo 
			foreach ($otdSaldosCta as $arrSdo)
			{

				//Incrementar cargos y abonos correspondientes al saldo inicial
				$intCargosSdoInicial +=  $arrSdo->cargos_saldo_inicial;
				$intAbonosSdoInicial += $arrSdo->abonos_saldo_inicial;

				//Incrementar cargos y abonos correspondientes al saldo actual
				$intCargosSdoActual += $arrSdo->cargos_saldo_actual;;
				$intAbonosSdoActual += $arrSdo->abonos_saldo_actual;

			}//Cierre de foreach (saldos)

		}//Cierre de verificación de saldos

		

		//Dependiendo del nivel incrementar acumulados y definir cuenta contable
		if($strNivel == "NIVEL 3")//Tercer nivel
		{
			//Si la cuenta acepta movimientos
	    	if ($arrCta->acepta_movimientos == "SI")
	    	{
	    		//Asignar SI para incrementar acumulados
	    		$strIncAcumulados = 'SI';
	    	}

	    	$strCuenta = $arrCta->primer_nivel." ".$arrCta->segundo_nivel." ".
						 $arrCta->tercer_nivel." ". $arrCta->cuarto_nivel;
			
		}
		else 
		{
			//Asignar SI para incrementar acumulados
			$strIncAcumulados = 'SI';

			//Dependiendo del nivel definir cuenta contable
			if($strNivel == "NIVEL 1")//Primer nivel
			{
				$strCuenta = $arrCta->primer_nivel;
			}
			else //Segundo nivel
			{
				$strCuenta = $arrCta->primer_nivel." ".$arrCta->segundo_nivel;
			}

		}


		//Dependiendo de la naturaleza de la cuenta, calcular el saldo inicial (anterior)
		if($arrCta->naturaleza == 'ACREEDORA')
		{
			//Calcular saldos
			$intSaldoInicial = $intAbonosSdoInicial - $intCargosSdoInicial;
			$intSaldoActual = $intAbonosSdoActual - $intCargosSdoActual;

			//Decrementar saldo inicial (anterior)
			$intSaldoActual += $intSaldoInicial;

			//Asignar saldo inicial de la cuenta 
	    	$intSaldoInicialCtaAcreedora = $intSaldoInicial;
	    	//Asignar saldo actual de la cuenta 
	    	$intSaldoActualCtaAcreedora = $intSaldoActual;


	    	//Si la cuenta acepta movimientos
	    	if ($strIncAcumulados == "SI")
	    	{
		    	//Incrementar acumulados
		    	$intAcumSaldoInicialCtaAcreedora += $intSaldoInicialCtaAcreedora;
		    	$intAcumSaldoActualCtaAcreedora += $intSaldoActualCtaAcreedora;
		    }


    		//Si el tipo de archivo es PDF convertir cantidad a formato moneda
			$intSaldoInicialCtaAcreedora =  (($strTipoArchivo == 'PDF') ? 
							          	     '$'.number_format($intSaldoInicialCtaAcreedora, 2, '.', ',') : $intSaldoInicialCtaAcreedora);

			$intSaldoActualCtaAcreedora =  (($strTipoArchivo == 'PDF') ? 
							          	     '$'.number_format($intSaldoActualCtaAcreedora, 2, '.', ',') : $intSaldoActualCtaAcreedora);



		}
		else
		{
			//Calcular saldos
			$intSaldoInicial = $intCargosSdoInicial - $intAbonosSdoInicial;
			$intSaldoActual = $intCargosSdoActual - $intAbonosSdoActual;

			//Decrementar saldo inicial (anterior)
			$intSaldoActual += $intSaldoInicial;

			//Asignar saldo inicial de la cuenta 
	    	$intSaldoInicialCtaDeudora = $intSaldoInicial;
	    	//Asignar saldo actual de la cuenta 
	    	$intSaldoActualCtaDeudora = $intSaldoActual;

	    	//Si la cuenta acepta movimientos
	    	if ($strIncAcumulados == "SI")
	    	{
		    	//Incrementar acumulados
		    	$intAcumSaldoInicialCtaDeudora += $intSaldoInicialCtaDeudora;
		    	$intAcumSaldoActualCtaDeudora += $intSaldoActualCtaDeudora;
		    }


    		//Si el tipo de archivo es PDF convertir cantidad a formato moneda
			$intSaldoInicialCtaDeudora =  (($strTipoArchivo == 'PDF') ? 
							          	     '$'.number_format($intSaldoInicialCtaDeudora, 2, '.', ',') : $intSaldoInicialCtaDeudora);

			$intSaldoActualCtaDeudora =  (($strTipoArchivo == 'PDF') ? 
							          	     '$'.number_format($intSaldoActualCtaDeudora, 2, '.', ',') : $intSaldoActualCtaDeudora);

		}

		//Asignar movimientos
		$intAcumCargos = $intCargosSdoActual;
	    $intAcumAbonos = $intAbonosSdoActual;

	    
	    //Dependiendo del tipo de reporte, mostrar información en el archivo
		if($strTipoReporte == 'SOLO_MOVIMIENTOS')//Sólo con movimientos en el rango de fechas
		{
			 //Si existen movimientos de la cuenta contable
			 if(($intAcumCargos > 0) OR  ($intAcumAbonos > 0))
			 {
			 	//Asignar SI para agregar datos de la cuenta
			 	$strAgregarCta = 'SI';
			 }
		}
		else if($strTipoReporte == 'MOVIMIENTOS_SALDOS')//Cuentas con movimientos y/o saldo en el rango de fechas
		{
			 //Si existen movimientos ó saldo de la cuenta contable
			/*if((($intAcumCargos > 0) OR  ($intAcumAbonos > 0)) OR 
				(($intSaldoActual >= 1) OR ($intSaldoActual <= -1)))*///Validación anterior

		    //Se cambia la condición porque quieren saldos negativos
			if((($intAcumCargos > 0) OR  ($intAcumAbonos > 0)) OR 
				($intSaldoActual > 0 OR $intSaldoActual < 0))
			{

				//Asignar SI para agregar datos de la cuenta
				$strAgregarCta = 'SI';
			}
		}
		else if($strTipoReporte == 'SALDO')//Sólo cuentas con saldo
		{

			//Si existe saldo de la cuenta contable
			//if (($intSaldoActual >= 1) OR ($intSaldoActual <= -1))//Validación anterior
			//Se cambia la condición porque quieren saldos negativos
			if($intSaldoActual > 0 OR  $intSaldoActual < 0)
			{
				//Asignar SI para agregar datos de la cuenta
				$strAgregarCta = 'SI';
			}
		}
		else //Todas las cuentas
		{
			//Asignar SI para agregar datos de la cuenta
			$strAgregarCta = 'SI';
		}


		//Si se cumplen las reglas de validación
		if($strAgregarCta == 'SI')
		{
			$arrAuxiliar['cuenta'] = $strCuenta;

			$arrAuxiliar['descripcion'] = $arrCta->descripcion;
			$arrAuxiliar['cargos_saldo_inicial'] =  $intSaldoInicialCtaDeudora;
			$arrAuxiliar['abonos_saldo_inicial'] =  $intSaldoInicialCtaAcreedora;

			$arrAuxiliar['cargos_movimientos'] =   (($strTipoArchivo == 'PDF') ? 
							  						 '$'.number_format($intAcumCargos, 2, '.', ',') : $intAcumCargos);

			$arrAuxiliar['abonos_movimientos'] =   (($strTipoArchivo == 'PDF') ? 
							  						 '$'.number_format($intAcumAbonos, 2, '.', ',') : $intAcumAbonos);

			$arrAuxiliar['cargos_saldo_actual'] =  $intSaldoActualCtaDeudora;
			$arrAuxiliar['abonos_saldo_actual'] =  $intSaldoActualCtaAcreedora;



			//Si la cuenta acepta movimientos
			if ($strIncAcumulados == "SI")
	    	{
				//Incrementar acumulados de los movimientos
				$intTotalCargos += $intAcumCargos;
				$intTotalAbonos += $intAcumAbonos;
			}


			//Asignar datos al array
	        array_push($arrDatosCta, $arrAuxiliar); 
	        //Asignar datos al array
			$arrDatos['rows'] = $arrDatosCta;

			$arrDatos['acumulado_cargos_saldo_inicial'] = $intAcumSaldoInicialCtaDeudora;
		    $arrDatos['acumulado_abonos_saldo_inicial'] = $intAcumSaldoInicialCtaAcreedora;
			$arrDatos['acumulado_cargos_movimientos'] = $intTotalCargos;
			$arrDatos['acumulado_abonos_movimientos'] = $intTotalAbonos;
			$arrDatos['acumulado_cargos_saldo_actual'] = $intAcumSaldoActualCtaDeudora;
			$arrDatos['acumulado_abonos_saldo_actual'] = $intAcumSaldoActualCtaAcreedora;

		}
	    

		//Regresar array con los saldos
		return $arrDatos;
  	}
}