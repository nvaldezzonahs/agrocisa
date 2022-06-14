<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_analisis_mayores extends MY_Controller {
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
		$this->cargar_vista('contabilidad/rep_analisis_mayores', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el análisis de mayores contables
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{
		
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strCuentaInicial = trim($this->input->post('strCuentaInicial'));
		$strCuentaFinal = trim($this->input->post('strCuentaFinal'));

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

		//Seleccionar los saldos de las cuentas contables
		$otdCuentas = $this->cuentas->buscar_saldos_cuentas_resumen($dteFechaInicial, $dteFechaFinal, 
														   		    $strCuentaInicial, $strCuentaFinal, 
														   			'ANALISIS MAYORES');
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  utf8_decode('ANÁLISIS DE MAYORES ').$strTituloRangoFechas;
		//Crea los titulos de la primer cabecera 
		$pdf->arrCabecera = array('CUENTA', 'NOMBRE', 'SALDO ANTERIOR', 'MOVIMIENTOS',
								  'SALDO ACTUAL');
		//Crea los titulos de la segunda cabecera 
		$pdf->arrCabecera2 = array('', '', 'DEUDOR','ACREEDOR', 'CARGO','ABONO', 'DEUDOR','ACREEDOR');
		//Establece el ancho de las columnas de las cabeceras
		$pdf->arrAnchura = array(18, 52, 40, 40, 40);
		$pdf->arrAnchura2 = array(18, 52, 20, 20, 20, 20, 20, 20);
		//Establece la alineación de las celdas de las tablas
		$pdf->arrAlineacion = array('L', 'L', 'C', 'C', 'C');
	    $pdf->arrAlineacion2 = array('L', 'L', 'R', 'R', 'R', 'R', 'R', 'R');

		//Establecer el color de línea
	    $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
	    $pdf->SetWidths($pdf->arrAnchura2);

	    //Si hay información
		if($otdCuentas)
		{
			//Recorremos el arreglo 
			foreach ($otdCuentas as $arrCta)
			{
				//Variable que se utiliza para asignar el saldo inicial
				$intSaldoInicial = 0;
				//Variable que se utiliza para asignar el saldo actual
				$intSaldoActual = 0;
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
				//Variable que se utiliza para asignar la naturaleza
	   		    $strNaturalezaCta = $arrCta->naturaleza;

				//Asignar array con los saldos de la cuenta contable
				$arrSaldos = $this->get_saldos_cuenta_contable($arrCta);
				//Asignar saldos de la cuenta contable
			    $intSaldoInicial = $arrSaldos['saldo_inicial'];
			    $intSaldoActual = $arrSaldos['saldo_actual'];
			    $intAcumCargos = $arrSaldos['acumulado_cargos'];
			    $intAcumAbonos = $arrSaldos['acumulado_abonos'];

			   //Dependiendo de la naturaleza de la cuenta, asignar saldos
			    if($arrCta->naturaleza == 'ACREEDORA')
			    {
			    	//Asignar saldo inicial de la cuenta 
			    	$intSaldoInicialCtaAcreedora = $intSaldoInicial;
			    	//Asignar saldo actual de la cuenta 
			    	$intSaldoActualCtaAcreedora = $intSaldoActual;

		    		//Convertir cantidad a formato moneda
		    		$intSaldoInicialCtaAcreedora = '$'.number_format($intSaldoInicialCtaAcreedora,2);
		    		$intSaldoActualCtaAcreedora = '$'.number_format($intSaldoActualCtaAcreedora,2);
			    }
			    else
			    {
			    	//Asignar saldo inicial de la cuenta 
			    	$intSaldoInicialCtaDeudora = $intSaldoInicial;
			    	//Asignar saldo actual de la cuenta 
			    	$intSaldoActualCtaDeudora = $intSaldoActual;

		    		//Convertir cantidad a formato moneda
		    		$intSaldoInicialCtaDeudora = '$'.number_format($intSaldoInicialCtaDeudora,2);
		    		$intSaldoActualCtaDeudora = '$'.number_format($intSaldoActualCtaDeudora,2);
			    }
			    

			  
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCta->cuenta, 
				                utf8_decode($arrCta->descripcion), 
				                $intSaldoInicialCtaDeudora,
				                $intSaldoInicialCtaAcreedora,
				               '$'.number_format($intAcumCargos,2),
				           	   '$'.number_format($intAcumAbonos,2),
				           	    $intSaldoActualCtaDeudora,
				           	    $intSaldoActualCtaAcreedora), 
					  	     $pdf->arrAlineacion2, 'ClippedCell', 'SI');



			}//Cierre de foreach (cuentas)

		}//Cierre de verificación de cuentas

		//Ejecutar la salida del reporte
        $pdf->Output('analisis_mayores.pdf','I'); 

	}


	/*Método para generar un archivo XLS con el análisis de mayores contables
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strCuentaInicial = trim($this->input->post('strCuentaInicial'));
		$strCuentaFinal = trim($this->input->post('strCuentaFinal'));
		//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;

        //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');


		//Seleccionar los saldos de las cuentas contables
		$otdCuentas = $this->cuentas->buscar_saldos_cuentas_resumen($dteFechaInicial, $dteFechaFinal, 
														    		$strCuentaInicial, $strCuentaFinal, 
														    	   'ANALISIS MAYORES');
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
			     ->setCellValue('A7', 'ANÁLISIS DE MAYORES '.$strTituloRangoFechas);
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
				//Variable que se utiliza para asignar el saldo inicial
				$intSaldoInicial = 0;
				//Variable que se utiliza para asignar el saldo actual
				$intSaldoActual = 0;
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
				
				//Variable que se utiliza para asignar la naturaleza
	   		    $strNaturalezaCta = $arrCta->naturaleza;

				//Asignar array con los saldos de la cuenta contable
				$arrSaldos = $this->get_saldos_cuenta_contable($arrCta);
				//Asignar saldos de la cuenta contable
			    $intSaldoInicial = $arrSaldos['saldo_inicial'];
			    $intSaldoActual = $arrSaldos['saldo_actual'];
			    $intAcumCargos = $arrSaldos['acumulado_cargos'];
			    $intAcumAbonos = $arrSaldos['acumulado_abonos'];

			   //Dependiendo de la naturaleza de la cuenta, asignar saldos
			    if($arrCta->naturaleza == 'ACREEDORA')
			    {
			    	//Asignar saldo inicial de la cuenta 
			    	$intSaldoInicialCtaAcreedora = $intSaldoInicial;
			    	//Asignar saldo actual de la cuenta 
			    	$intSaldoActualCtaAcreedora = $intSaldoActual;
			    }
			    else
			    {
			    	//Asignar saldo inicial de la cuenta 
			    	$intSaldoInicialCtaDeudora = $intSaldoInicial;
			    	//Asignar saldo actual de la cuenta 
			    	$intSaldoActualCtaDeudora = $intSaldoActual;

			    }
			    

			    //Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
				        	 ->setCellValue('A'.$intFila, $arrCta->cuenta)
				        	 ->setCellValue('B'.$intFila, $arrCta->descripcion)
				        	 ->setCellValue('C'.$intFila, $intSaldoInicialCtaDeudora)
				        	 ->setCellValue('D'.$intFila, $intSaldoInicialCtaAcreedora)
				        	 ->setCellValue('E'.$intFila, $intAcumCargos)
				        	 ->setCellValue('F'.$intFila, $intAcumAbonos)
				        	 ->setCellValue('G'.$intFila, $intSaldoActualCtaDeudora)
				        	 ->setCellValue('H'.$intFila, $intSaldoActualCtaAcreedora);

				//Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 

			}//Cierre de foreach (cuentas)

			
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


		}//Cierre de verificación de cuentas

		
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'analisis_mayores.xls', 
        								    'análisis de mayores', $intFila);

	}
	
}