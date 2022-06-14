<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_rendimiento_gasolinas extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('control_vehiculos/rep_rendimiento_gasolinas_model', 'rendimientos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('control_vehiculos/rep_rendimiento_gasolinas', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte($strTipo, $strMes, $strAnio) 
	{
		if($strTipo == 'Mensual')
		{
			//Hacer un llamado a la función para generar un reporte PDF con el consumo de combustible para un mes en particular
			$this->get_reporte_mensual($strMes, $strAnio);
		}
		else
		{
			//Hacer un llamado a la función para generar un reporte PDF con el consumo de combustible para un año en particular
			$this->get_reporte_comparativo($strAnio);
		}
	}

	/*Método para generar un reporte XLS
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls($strTipo, $strMes, $strAnio) 
	{
		if($strTipo == 'Mensual')
		{
			//Hacer un llamado a la función para generar un reporte XLS con el consumo de combustible para un mes en particular
			$this->get_xls_mensual($strMes, $strAnio);
		}
		else
		{
			//Hacer un llamado a la función para generar un reporte XLS con el consumo de combustible para un año en particular
			$this->get_xls_comparativo($strAnio);
		}
	}

	/*Método para generar un reporte PDF con el listado de los rendimientos*/
	public function get_reporte_mensual($strMes, $strAnio) 
	{	      
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');

		//Seleccionar los datos
		$otdResultado = $this->rendimientos->mensual($strMes, $strAnio); 

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación horizontal, tamaño carta
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		//$pdf->strLinea1= 'LISTADO DE VIGENCIAs '.$strTituloRangoFechas;
		$pdf->strLinea1= 'RESUMEN CONSUMO DE COMBUSTIBLE VEHICULOS MES DE'.' '.$this->ARR_MESES_DESCRIPCIONES[(int)$strMes].' '.$strAnio;

		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('VEHÍCULO'), utf8_decode('CÓDIGO'), 'RESPONSABLE', 
					         'LITROS', 'IMPORTE', 'KM RECORRIDOS', 'REND KM/LITROS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(35, 20, 45, 20, 20, 25, 25);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'L', 'R', 'R', 'R', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Establecer el color de fondo para la línea
		$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Si se encuentran resultados
		if($otdResultado){
			//Asigna el tipo y tamaño de letra para un subtitulo
			$pdf->SetTextColor(0);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);

			foreach ($otdResultado as $arrCol)
			{ 

				$kilometros_recorridos = $arrCol->kilometraje_final - $arrCol->kilometraje_inicial;
				if($kilometros_recorridos < 0){
					$kilometros_recorridos = 0;
				}

				$rendimiento = 0;
				if($arrCol->litros > 0){
					$rendimiento = $kilometros_recorridos / $arrCol->litros;
				}

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array( utf8_decode($arrCol->vehiculo), 
								  $arrCol->codigo, 
								  utf8_decode($arrCol->responsable), 
								  number_format($arrCol->litros, 2), 
								  '$ '.number_format($arrCol->importe, 2), 
								  number_format($kilometros_recorridos, 2),
								  number_format($rendimiento, 2)),
						  $pdf->arrAlineacion);
				
				//Dibuja una línea para separar la información de cada prospecto
	    		$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
			}

		}


		//Espacios de salto de línea
        $pdf->Ln();
        //Ejecutar la salida del reporte
        $pdf->Output('rendimiento_gasolinas_mensual'.'pdf','I'); 
	}

	/*Método para generar un reporte PDF con el listado comparativo de un año*/
	public function get_reporte_comparativo($strAnio) 
	{	      
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');

		//Seleccionar los datos
		$otdResultado = $this->rendimientos->comparativo($strAnio); 

		//var_dump($otdResultado);

		//Se crea una instancia de la clase PDF
		$pdf = new PDF('L','mm','letter');//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		//$pdf->strLinea1= 'LISTADO DE VIGENCIAs '.$strTituloRangoFechas;
		$pdf->strLinea1 = utf8_decode('COMPARATIVO MENSUAL DE  RENDIMIENTO DE KILÓMETROS POR LITRO DEL AÑO'.' '.$strAnio);
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('VEHÍCULO'), utf8_decode('CÓDIGO'), 'ENERO', 'FEBRERO', 'MARZO', 
							'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 
							'NOVIEMBRE', 'DICIEMBRE');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(30, 16, 17, 17, 17, 17, 17, 17, 17, 17, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Establecer el color de fondo para la línea
		$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Si se encuentran resultados
		if($otdResultado){
			//Asigna el tipo y tamaño de letra para un subtitulo
			$pdf->SetTextColor(0);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);

			foreach ($otdResultado as $arrCol)
			{ 

				$km_recorridos_enero = $arrCol->KmFinalEnero - $arrCol->KmInicialEnero;
				if($km_recorridos_enero < 0){ $km_recorridos_enero = 0; }
				$rendimiento_enero = '-';
				if($arrCol->LitrosEnero > 0){ 
					$rendimiento_enero = $km_recorridos_enero / $arrCol->LitrosEnero; 
					$rendimiento_enero = number_format($rendimiento_enero, 2);
				}

				$km_recorridos_febrero = $arrCol->KmFinalFebrero - $arrCol->KmInicialFebrero;
				if($km_recorridos_febrero < 0){ $km_recorridos_febrero = 0; }
				$rendimiento_febrero = '-';
				if($arrCol->LitrosFebrero > 0){ 
					$rendimiento_febrero = $km_recorridos_febrero / $arrCol->LitrosFebrero;
					$rendimiento_febrero = number_format($rendimiento_febrero, 2); 
				}

				$km_recorridos_marzo = $arrCol->KmFinalMarzo - $arrCol->KmInicialMarzo;
				if($km_recorridos_marzo < 0){ $km_recorridos_marzo = 0; }
				$rendimiento_marzo = '-';
				if($arrCol->LitrosMarzo > 0){ 
					$rendimiento_marzo = $km_recorridos_marzo / $arrCol->LitrosMarzo;
					$rendimiento_marzo = number_format($rendimiento_marzo, 2); 
				}

				$km_recorridos_abril = $arrCol->KmFinalAbril - $arrCol->KmInicialAbril;
				if($km_recorridos_abril < 0){ $km_recorridos_abril = 0; }
				$rendimiento_abril = '-';
				if($arrCol->LitrosAbril > 0){ 
					$rendimiento_abril = $km_recorridos_abril / $arrCol->LitrosAbril;
					$rendimiento_abril = number_format($rendimiento_abril, 2); 
				}

				$km_recorridos_mayo = $arrCol->KmFinalMayo - $arrCol->KmInicialMayo;
				if($km_recorridos_mayo < 0){ $km_recorridos_mayo = 0; }
				$rendimiento_mayo = '-';
				if($arrCol->LitrosMayo > 0){ 
					$rendimiento_mayo = $km_recorridos_mayo / $arrCol->LitrosMayo;
					$rendimiento_mayo = number_format($rendimiento_mayo, 2); 
				}

				$km_recorridos_junio = $arrCol->KmFinalJunio - $arrCol->KmInicialJunio;
				if($km_recorridos_junio < 0){ $km_recorridos_junio = 0; }
				$rendimiento_junio = '-';
				if($arrCol->LitrosJunio > 0){ 
					$rendimiento_junio = $km_recorridos_junio / $arrCol->LitrosJunio;
					$rendimiento_junio = number_format($rendimiento_junio, 2); 
				}

				$km_recorridos_julio = $arrCol->KmFinalJulio - $arrCol->KmInicialJulio;
				if($km_recorridos_julio < 0){ $km_recorridos_julio = 0; }
				$rendimiento_julio = '-';
				if($arrCol->LitrosJulio > 0){ 
					$rendimiento_julio = $km_recorridos_julio / $arrCol->LitrosJulio;
					$rendimiento_julio = number_format($rendimiento_julio, 2); 
				}

				$km_recorridos_agosto = $arrCol->KmFinalAgosto - $arrCol->KmInicialAgosto;
				if($km_recorridos_agosto < 0){ $km_recorridos_agosto = 0; }
				$rendimiento_agosto = '-';
				if($arrCol->LitrosAgosto > 0){ 
					$rendimiento_agosto = $km_recorridos_agosto / $arrCol->LitrosAgosto;
					$rendimiento_agosto = number_format($rendimiento_agosto, 2); 
				}

				$km_recorridos_septiembre = $arrCol->KmFinalSeptiembre - $arrCol->KmInicialSeptiembre;
				if($km_recorridos_septiembre < 0){ $km_recorridos_septiembre = 0; }
				$rendimiento_septiembre = '-';
				if($arrCol->LitrosSeptiembre > 0){ 
					$rendimiento_septiembre = $km_recorridos_septiembre / $arrCol->LitrosSeptiembre; 
					$rendimiento_septiembre = number_format($rendimiento_septiembre, 2);
				}

				$km_recorridos_octubre = $arrCol->KmFinalOctubre - $arrCol->KmInicialOctubre;
				if($km_recorridos_octubre < 0){ $km_recorridos_octubre = 0; }
				$rendimiento_octubre = '-';
				if($arrCol->LitrosOctubre > 0){ 
					$rendimiento_octubre = $km_recorridos_octubre / $arrCol->LitrosOctubre; 
					$rendimiento_octubre = number_format($rendimiento_octubre, 2);
				}

				$km_recorridos_noviembre = $arrCol->KmFinalNoviembre - $arrCol->KmInicialNoviembre;
				if($km_recorridos_noviembre < 0){ $km_recorridos_noviembre = 0; }
				$rendimiento_noviembre = '-';
				if($arrCol->LitrosNoviembre > 0){ 
					$rendimiento_noviembre = $km_recorridos_noviembre / $arrCol->LitrosNoviembre; 
					$rendimiento_noviembre = number_format($rendimiento_noviembre, 2);
				}

				$km_recorridos_diciembre = $arrCol->KmFinalDiciembre - $arrCol->KmInicialDiciembre;
				if($km_recorridos_diciembre < 0){ $km_recorridos_diciembre = 0; }
				$rendimiento_diciembre = '-';
				if($arrCol->LitrosDiciembre > 0){ 
					$rendimiento_diciembre = $km_recorridos_diciembre / $arrCol->LitrosDiciembre; 
					$rendimiento_diciembre = number_format($rendimiento_diciembre, 2);
				}
				
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array( utf8_decode($arrCol->vehiculo), 
								  $arrCol->codigo, 
								  $rendimiento_enero, 
								  $rendimiento_febrero, 
								  $rendimiento_marzo, 
								  $rendimiento_abril,
								  $rendimiento_mayo,
								  $rendimiento_junio,
								  $rendimiento_julio,
								  $rendimiento_agosto,
								  $rendimiento_septiembre,
								  $rendimiento_octubre,
								  $rendimiento_noviembre,
								  $rendimiento_diciembre),
						   $pdf->arrAlineacion);

				//Dibuja una línea para separar la información de cada prospecto
	    		$pdf->Line(10, $pdf->GetY(), 272, $pdf->GetY());
			}

		}
		
		//Espacios de salto de línea
        $pdf->Ln();
        //Ejecutar la salida del reporte
        $pdf->Output('rendimiento_gasolinas_comparativo'.'pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls_mensual($strMes, $strAnio) 
	{	
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        
        //Seleccionar los datos
		$otdResultado = $this->rendimientos->mensual($strMes, $strAnio);

     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        
        $strTitulo = $this->ARR_MESES_DESCRIPCIONES[(int)$strMes].' '.$strAnio;

        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'RESUMEN CONSUMO DE COMBUSTIBLE VEHICULOS MES DE '.$strTitulo);
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'VEHÍCULO')
        		 ->setCellValue('B'.$intPosEncabezados, 'CÓDIGO')
        		 ->setCellValue('C'.$intPosEncabezados, 'RESPONSABLE')
        		 ->setCellValue('D'.$intPosEncabezados, 'LITROS')
        		 ->setCellValue('E'.$intPosEncabezados, 'IMPORTE')
        		 ->setCellValue('F'.$intPosEncabezados, 'KM RECORRIDOS')
        		 ->setCellValue('G'.$intPosEncabezados, 'REND KM/LITROS');
        //Definir estilo de las celdas correspondientes a los encabezados
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

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()->getStyle('A9:G9')->getFill()->applyFromArray($arrStyleColumnas);
		 
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   

				$kilometros_recorridos = $arrCol->kilometraje_final - $arrCol->kilometraje_inicial;
				if($kilometros_recorridos < 0){
					$kilometros_recorridos = 0;
				}

				$rendimiento = 0;
				if($arrCol->litros > 0){
					$rendimiento = $kilometros_recorridos / $arrCol->litros;
				}

				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0) 
                         ->setCellValue('A'.$intFila, $arrCol->vehiculo)
                         ->setCellValueExplicit('B'.$intFila, $arrCol->codigo, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('C'.$intFila, $arrCol->responsable)
                         ->setCellValue('D'.$intFila, $arrCol->litros)
                         ->setCellValue('E'.$intFila, $arrCol->importe)
                         ->setCellValue('F'.$intFila, $kilometros_recorridos)
                         ->setCellValue('G'.$intFila, $rendimiento);

                //Incrementar el indice para escribir el total
            	$intFila++;

            	$intContador++;         
			}
			
			//Cambiar contenido de las celdas a formato númerico
			$objExcel->getActiveSheet()
            		 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

            $objExcel->getActiveSheet()
            		 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.000000');		 
           	 		 
			//Cambiar contenido de las celdas a formato númerico
            $objExcel->getActiveSheet()
            		 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

			//Cambiar contenido de las celdas a formato númerico
            $objExcel->getActiveSheet()
            		 ->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

            //Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('D'.$intPosEncabezados.':G'.$intPosEncabezados)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentCenter);		 		 
                	 
			
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('G'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('G'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'rendimiento_gasolinas.xls', 'Reporte Mensual', $intContador);
	}

	public function get_xls_comparativo($strAnio) 
	{	
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        
        //Seleccionar los datos
		$otdResultado = $this->rendimientos->comparativo($strAnio);

     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        
        $strTitulo = $strAnio;

        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'RENDIMIENTO DE KILÓMETROS POR LITRO EN EL AÑO '.$strTitulo);
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'VEHÍCULO')
        		 ->setCellValue('B'.$intPosEncabezados, 'CÓDIGO')
        		 ->setCellValue('C'.$intPosEncabezados, 'ENERO')
        		 ->setCellValue('D'.$intPosEncabezados, 'FEBRERO')
        		 ->setCellValue('E'.$intPosEncabezados, 'MARZO')
        		 ->setCellValue('F'.$intPosEncabezados, 'ABRIL')
        		 ->setCellValue('G'.$intPosEncabezados, 'MAYO')
        		 ->setCellValue('H'.$intPosEncabezados, 'JUNIO')
        		 ->setCellValue('I'.$intPosEncabezados, 'JULIO')
        		 ->setCellValue('J'.$intPosEncabezados, 'AGOSTO')
        		 ->setCellValue('K'.$intPosEncabezados, 'SEPTIEMBRE')
        		 ->setCellValue('L'.$intPosEncabezados, 'OCTUBRE')
        		 ->setCellValue('M'.$intPosEncabezados, 'NOVIEMBRE')
        		 ->setCellValue('N'.$intPosEncabezados, 'DICIEMBRE');

        //Definir estilo de las celdas correspondientes a los encabezados
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

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()->getStyle('A9:N9')->getFill()->applyFromArray($arrStyleColumnas);
		 
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   

				$km_recorridos_enero = $arrCol->KmFinalEnero - $arrCol->KmInicialEnero;
				if($km_recorridos_enero < 0){ $km_recorridos_enero = 0; }
				$rendimiento_enero = '-';
				if($arrCol->LitrosEnero > 0){ 
					$rendimiento_enero = $km_recorridos_enero / $arrCol->LitrosEnero; 
					$rendimiento_enero = number_format($rendimiento_enero, 2);
				}

				$km_recorridos_febrero = $arrCol->KmFinalFebrero - $arrCol->KmInicialFebrero;
				if($km_recorridos_febrero < 0){ $km_recorridos_febrero = 0; }
				$rendimiento_febrero = '-';
				if($arrCol->LitrosFebrero > 0){ 
					$rendimiento_febrero = $km_recorridos_febrero / $arrCol->LitrosFebrero;
					$rendimiento_febrero = number_format($rendimiento_febrero, 2); 
				}

				$km_recorridos_marzo = $arrCol->KmFinalMarzo - $arrCol->KmInicialMarzo;
				if($km_recorridos_marzo < 0){ $km_recorridos_marzo = 0; }
				$rendimiento_marzo = '-';
				if($arrCol->LitrosMarzo > 0){ 
					$rendimiento_marzo = $km_recorridos_marzo / $arrCol->LitrosMarzo;
					$rendimiento_marzo = number_format($rendimiento_marzo, 2); 
				}

				$km_recorridos_abril = $arrCol->KmFinalAbril - $arrCol->KmInicialAbril;
				if($km_recorridos_abril < 0){ $km_recorridos_abril = 0; }
				$rendimiento_abril = '-';
				if($arrCol->LitrosAbril > 0){ 
					$rendimiento_abril = $km_recorridos_abril / $arrCol->LitrosAbril;
					$rendimiento_abril = number_format($rendimiento_abril, 2); 
				}

				$km_recorridos_mayo = $arrCol->KmFinalMayo - $arrCol->KmInicialMayo;
				if($km_recorridos_mayo < 0){ $km_recorridos_mayo = 0; }
				$rendimiento_mayo = '-';
				if($arrCol->LitrosMayo > 0){ 
					$rendimiento_mayo = $km_recorridos_mayo / $arrCol->LitrosMayo;
					$rendimiento_mayo = number_format($rendimiento_mayo, 2); 
				}

				$km_recorridos_junio = $arrCol->KmFinalJunio - $arrCol->KmInicialJunio;
				if($km_recorridos_junio < 0){ $km_recorridos_junio = 0; }
				$rendimiento_junio = '-';
				if($arrCol->LitrosJunio > 0){ 
					$rendimiento_junio = $km_recorridos_junio / $arrCol->LitrosJunio;
					$rendimiento_junio = number_format($rendimiento_junio, 2); 
				}

				$km_recorridos_julio = $arrCol->KmFinalJulio - $arrCol->KmInicialJulio;
				if($km_recorridos_julio < 0){ $km_recorridos_julio = 0; }
				$rendimiento_julio = '-';
				if($arrCol->LitrosJulio > 0){ 
					$rendimiento_julio = $km_recorridos_julio / $arrCol->LitrosJulio;
					$rendimiento_julio = number_format($rendimiento_julio, 2); 
				}

				$km_recorridos_agosto = $arrCol->KmFinalAgosto - $arrCol->KmInicialAgosto;
				if($km_recorridos_agosto < 0){ $km_recorridos_agosto = 0; }
				$rendimiento_agosto = '-';
				if($arrCol->LitrosAgosto > 0){ 
					$rendimiento_agosto = $km_recorridos_agosto / $arrCol->LitrosAgosto;
					$rendimiento_agosto = number_format($rendimiento_agosto, 2); 
				}

				$km_recorridos_septiembre = $arrCol->KmFinalSeptiembre - $arrCol->KmInicialSeptiembre;
				if($km_recorridos_septiembre < 0){ $km_recorridos_septiembre = 0; }
				$rendimiento_septiembre = '-';
				if($arrCol->LitrosSeptiembre > 0){ 
					$rendimiento_septiembre = $km_recorridos_septiembre / $arrCol->LitrosSeptiembre; 
					$rendimiento_septiembre = number_format($rendimiento_septiembre, 2);
				}

				$km_recorridos_octubre = $arrCol->KmFinalOctubre - $arrCol->KmInicialOctubre;
				if($km_recorridos_octubre < 0){ $km_recorridos_octubre = 0; }
				$rendimiento_octubre = '-';
				if($arrCol->LitrosOctubre > 0){ 
					$rendimiento_octubre = $km_recorridos_octubre / $arrCol->LitrosOctubre; 
					$rendimiento_octubre = number_format($rendimiento_octubre, 2);
				}

				$km_recorridos_noviembre = $arrCol->KmFinalNoviembre - $arrCol->KmInicialNoviembre;
				if($km_recorridos_noviembre < 0){ $km_recorridos_noviembre = 0; }
				$rendimiento_noviembre = '-';
				if($arrCol->LitrosNoviembre > 0){ 
					$rendimiento_noviembre = $km_recorridos_noviembre / $arrCol->LitrosNoviembre; 
					$rendimiento_noviembre = number_format($rendimiento_noviembre, 2);
				}

				$km_recorridos_diciembre = $arrCol->KmFinalDiciembre - $arrCol->KmInicialDiciembre;
				if($km_recorridos_diciembre < 0){ $km_recorridos_diciembre = 0; }
				$rendimiento_diciembre = '-';
				if($arrCol->LitrosDiciembre > 0){ 
					$rendimiento_diciembre = $km_recorridos_diciembre / $arrCol->LitrosDiciembre; 
					$rendimiento_diciembre = number_format($rendimiento_diciembre, 2);
				}

				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0) 
                         ->setCellValue('A'.$intFila, $arrCol->vehiculo)
                         ->setCellValueExplicit('B'.$intFila, $arrCol->codigo, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('C'.$intFila, $rendimiento_enero)
                         ->setCellValue('D'.$intFila, $rendimiento_febrero)
                         ->setCellValue('E'.$intFila, $rendimiento_marzo)
                         ->setCellValue('F'.$intFila, $rendimiento_abril)
                         ->setCellValue('G'.$intFila, $rendimiento_mayo)
                         ->setCellValue('H'.$intFila, $rendimiento_junio)
                         ->setCellValue('I'.$intFila, $rendimiento_julio)
                         ->setCellValue('J'.$intFila, $rendimiento_agosto)
                         ->setCellValue('K'.$intFila, $rendimiento_septiembre)
                         ->setCellValue('L'.$intFila, $rendimiento_octubre)
                         ->setCellValue('M'.$intFila, $rendimiento_noviembre)
                         ->setCellValue('N'.$intFila, $rendimiento_diciembre);

                //Incrementar el indice para escribir el total
            	$intFila++;

            	$intContador++;         
			}
			
			//Cambiar contenido de las celdas a formato númerico
			$objExcel->getActiveSheet()
            		 ->getStyle('C'.$intFilaInicial.':'.'N'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

            $objExcel->getActiveSheet()
            		 ->getStyle('C'.$intFilaInicial.':'.'N'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('#,##0.000000');		 
           	 		 
            //Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('C'.$intPosEncabezados.':N'.$intPosEncabezados)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentCenter);		 		 
             
            //Cambiar alineación de las siguientes celdas
    		$objExcel->getActiveSheet(0)->getStyle('C'.$intFilaInicial.':'.'N'.$intFila)->getAlignment()->applyFromArray($arrStyleAlignmentRight);	 
			
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('N'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('N'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'rendimiento_gasolinas.xls', 'Comparativo Mensual', $intContador);
	}

}