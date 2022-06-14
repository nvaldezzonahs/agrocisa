<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_rastreo_series extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de entradas de maquinaria por compra
		$this->load->model('maquinaria/movimientos_maquinaria_model', 'series');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('maquinaria/rep_rastreo_series', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte() 
	{	
		
		//Variables que se utilizan para recuperar los valores de la vista
		$strSerie = trim($this->input->post('strSerie'));

		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$strSerie = mb_strtoupper($strSerie);
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con la serie
		$otdResultado = $this->series->buscar_serie($strSerie); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar fecha actual
		$dteFecha = date("Y-m-d");
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFecha = $this->get_fecha_formato_letra($dteFecha, 'C');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = utf8_decode('RASTREO DE NÚMEROS DE SERIE: '.$strSerie.' AL DÍA '.$strTituloFecha);		
		//Crea los titulos de la cabecera 
		$pdf->arrCabecera = array('SUCURSAL', 'MOVIMIENTO', 'FOLIO', 'FECHA', 'ESTATUS');
		//Establece el ancho de las columnas de las cabeceras
		$pdf->arrAnchura = array(40, 80, 25, 20, 25);
		//Establece la alineación de las celdas de las tablas
		$pdf->arrAlineacion = array('L', 'L', 'L', 'C', 'C');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas de la primer cabecera
		$pdf->SetWidths($pdf->arrAnchura);
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Variable que se utiliza para asignar el tipo de referencia
			    $strTipoReferencia = $arrCol->tipo_referencia;
			    //Variable que se utiliza para asignar el tipo de movimiento
			    $strTipoMovimiento = $arrCol->tipo_movimiento;

			    //Si el tipo de referencia corresponde al movimiento de maquinaria
			    if( $strTipoReferencia == 'MOVIMIENTO')
			    {
			    	//Asignar la descripción del tipo de movimiento
					$strTipoMovimiento = $this->ARR_MOVIMIENTOS_MAQUINARIA[$strTipoMovimiento];
			    }

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol->sucursal), utf8_decode($strTipoMovimiento), 
								$arrCol->folio, $arrCol->fecha_format, $arrCol->estatus), 
								 $pdf->arrAlineacion, 'ClippedCell');
				//Incrementar el contador por cada registro
				$intContador++;
			}
		}
		//Espacios de salto de línea
		$pdf->Ln();
		//Asigna el tipo y tamaño de letra para los totales
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Escribe la cadena concatenada con el total de registros
		$pdf->Cell(0,3,'TOTAL: '.$intContador, 0, 0, 'R');
		//Ejecutar la salida del reporte
		$pdf->Output('rastreo_series_maquinaria.pdf','I'); 
	}


	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$strSerie = trim($this->input->post('strSerie'));
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$strSerie = mb_strtoupper($strSerie);
		
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Seleccionar los datos de los registros que coinciden con la serie
		$otdResultado = $this->series->buscar_serie($strSerie); 
     	//Asignar fecha actual
		$dteFecha = date("Y-m-d");
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFecha = $this->get_fecha_formato_letra($dteFecha, 'C');
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'RASTREO DE NÚMEROS DE SERIE: '.$strSerie.' AL DÍA '.$strTituloFecha);
	
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'SUCURSAL')
        		 ->setCellValue('B'.$intPosEncabezados, 'MOVIMIENTO')
                 ->setCellValue('C'.$intPosEncabezados, 'FOLIO')
                 ->setCellValue('D'.$intPosEncabezados, 'FECHA')
                 ->setCellValue('E'.$intPosEncabezados, 'ESTATUS');

        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:E9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
			    //Variable que se utiliza para asignar el tipo de referencia
			    $strTipoReferencia = $arrCol->tipo_referencia;
			    //Variable que se utiliza para asignar el tipo de movimiento
			    $strTipoMovimiento = $arrCol->tipo_movimiento;

			    //Si el tipo de referencia corresponde al movimiento de maquinaria
			    if( $strTipoReferencia == 'MOVIMIENTO')
			    {
			    	//Asignar la descripción del tipo de movimiento
					$strTipoMovimiento = $this->ARR_MOVIMIENTOS_MAQUINARIA[$strTipoMovimiento];
			    }

				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
						 ->setCellValue('A'.$intFila, $arrCol->sucursal)
                         ->setCellValue('B'.$intFila, $strTipoMovimiento)
                         ->setCellValueExplicit('C'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('D'.$intFila, $arrCol->fecha_format)
                         ->setCellValue('E'.$intFila, $arrCol->estatus);

                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

           //Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('E'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('E'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'rastreo_series_maquinaria.xls', 'rastreo', $intFila);
	}
}