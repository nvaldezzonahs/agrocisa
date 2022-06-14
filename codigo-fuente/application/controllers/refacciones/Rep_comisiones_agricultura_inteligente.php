<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_comisiones_agricultura_inteligente extends MY_Controller {
	

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de facturas de refacciones
		$this->load->model('refacciones/facturas_refacciones_model', 'facturas');
	
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrRegistro = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('refacciones/rep_comisiones_agricultura_inteligente', $arrRegistro);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrRegistro = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrRegistro));
	}

	

	/*Método para generar un reporte PDF con las comisiones de agricultura inteligente
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');

	   //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial);
		$strTituloRangoFechas .= ' AL '.$this->get_fecha_formato_letra($dteFechaFinal);
		$strTituloRangoFechas = 'PERIODO '.$strTituloRangoFechas;
	
		//Seleccionar las comisiones de agricultura inteligente
		$otdResultado = $this->facturas->buscar_comisiones_agricultura($dteFechaInicial, $dteFechaFinal); 

		//Se crea una instancia de la clase PDF
        $pdf = new PDF('L','mm','letter');//orientación horizontal
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'REPORTE DE COMISIONES DE AGRICULTURA INTELIGENTE';
		$pdf->strLinea2 = mb_strtoupper($strTituloRangoFechas);
		//Establece los títulos de las cabeceras
		$pdf->arrCabecera = array('SUCURSAL', 'VENDEDOR', 'NOMBRE VENDEDOR', 'FACTURA', 
								  'FECHA', 'IMPORTE', 'CONDICIONES', 'CLIENTE', 
								   utf8_decode('LÍNEA'));

		$pdf->arrCabecera2 = array(utf8_decode('CÓDIGO'), 'PRODUCTO', 'CANTIDAD', 
								   'SUBTOTAL', 'COSTO', 'UTILIDAD', 'PORCENTAJE', 
								   utf8_decode('COMISIÓN'));

		//Establece el ancho de las columnas de las cabeceras
		$pdf->arrAnchura = array(40, 20, 50, 20, 20, 20, 20, 60, 12);
		$pdf->arrAnchura2 = array(40, 110, 20, 20, 20, 20, 18, 14);
		//Establece la alineación de las celdas de las tablas
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L', 'C', 'R', 'L', 'L', 'C');
		$pdf->arrAlineacion2 = array('L', 'L', 'R', 'R', 'R', 'R', 'R', 'R');
	    //Agregar la primer pagina
		$pdf->AddPage();
	
		//Si hay información
		if ($otdResultado)
		{	

			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 

				//Si se cumple la sentencia
				if (($arrCol->AbonoParcial > 0) && 
					($arrCol->Precio - $arrCol->AbonoTotal <= 0.01))
				{

					//Asignar valores a las variables
					$intCantidad = $arrCol->cantidad;
					$intPrecioUnitario = $arrCol->precio_unitario;
					$intCostoUnitario = $arrCol->costo_unitario;
					
					//Calcular subtotal
					$intSubtotal = ($intCantidad * $intPrecioUnitario);
					//Calcular costo total
					$intCosto = ($intCantidad * $intCostoUnitario);
					//Calcular utilidad
					$intUtilidad = ($intCantidad * ($intPrecioUnitario - $intCostoUnitario));

					//Establece el ancho de las columnas
					$pdf->SetWidths($pdf->arrAnchura);
					
					//Información de la primer cabecera
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(utf8_decode($arrCol->Sucursal), $arrCol->CodVen, 
									utf8_decode($arrCol->Vendedor), $arrCol->folio, 
									$arrCol->fecha, '$'.number_format($arrCol->Precio, 2, '.', ','), 
							    	$arrCol->condiciones_pago, utf8_decode($arrCol->razon_social), 
									$arrCol->codigo_linea), $pdf->arrAlineacion, 'ClippedCell');


					//Establece el ancho de las columnas
					$pdf->SetWidths($pdf->arrAnchura2);
					//Información de la segunda cabecera
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($arrCol->codigo, utf8_decode($arrCol->descripcion), 
									number_format($intCantidad, 2, '.', ','), 
									'$'.number_format($intSubtotal, 2, '.', ','), 
									'$'.number_format($intCosto, 2, '.', ','), 
									'$'.number_format($intUtilidad, 2, '.', ',')), 
							  $pdf->arrAlineacion2, 'ClippedCell');

					$pdf->Ln(1); //Deja un salto de línea

				}//Cierre de verificación de abono parcial/ abono total


			}//Cierre de foreach

			
		}//Cierre de verificación de ventas

		//Ejecutar la salida del reporte
		$pdf->Output('comisiones_agricultura_inteligente.pdf','I'); 
	}


	/*Método para generar un archivo XLS con las comisiones de agricultura inteligente
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{
		
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');

	   	//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial);
		$strTituloRangoFechas .= ' AL '.$this->get_fecha_formato_letra($dteFechaFinal);
		$strTituloRangoFechas = 'PERIODO '.$strTituloRangoFechas;

		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;
       
        //Seleccionar las comisiones de agricultura inteligente
		$otdResultado = $this->facturas->buscar_comisiones_agricultura($dteFechaInicial, $dteFechaFinal); 
     	
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'REPORTE DE COMISIONES DE AGRICULTURA INTELIGENTE')
			     ->setCellValue('A8', strtoupper($strTituloRangoFechas));

		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'SUCURSAL')
        		 ->setCellValue('B'.$intPosEncabezados, 'VENDEDOR')
                 ->setCellValue('C'.$intPosEncabezados, 'NOMBRE VENDEDOR')
                 ->setCellValue('D'.$intPosEncabezados, 'FACTURA')
                 ->setCellValue('E'.$intPosEncabezados, 'FECHA')
                 ->setCellValue('F'.$intPosEncabezados, 'IMPORTE')
                 ->setCellValue('G'.$intPosEncabezados, 'CONDICIONES')
                 ->setCellValue('H'.$intPosEncabezados, 'CLIENTE')
                 ->setCellValue('I'.$intPosEncabezados, 'LÍNEA')
                 ->setCellValue('J'.$intPosEncabezados, 'CÓDIGO')
                 ->setCellValue('K'.$intPosEncabezados, 'PRODUCTO')
                 ->setCellValue('L'.$intPosEncabezados, 'CANTIDAD')
                 ->setCellValue('M'.$intPosEncabezados, 'SUBTOTAL')
                 ->setCellValue('N'.$intPosEncabezados, 'COSTO')
                 ->setCellValue('O'.$intPosEncabezados, 'UTILIDAD')
                 ->setCellValue('P'.$intPosEncabezados, 'PORCENTAJE')
                 ->setCellValue('Q'.$intPosEncabezados, 'COMISIÓN');


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


        //Combinar las siguientes celdas
       	$objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A8:D8');

       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A8:D8')
        		 ->applyFromArray($arrStyleBold);

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A10:Q10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:Q10')
    			 ->applyFromArray($arrStyleFuenteColumnas);


    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:Q10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);


    	//Si hay información
		if ($otdResultado)
		{	

			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 

				//Si se cumple la sentencia
				if (($arrCol->AbonoParcial > 0) && 
				    ($arrCol->Precio - $arrCol->AbonoTotal <= 0.01))
				{

					//Asignar valores a las variables
					$intCantidad = $arrCol->cantidad;
					$intPrecioUnitario = $arrCol->precio_unitario;
					$intCostoUnitario = $arrCol->costo_unitario;
					
					//Calcular subtotal
					$intSubtotal = ($intCantidad * $intPrecioUnitario);
					//Calcular costo total
					$intCosto = ($intCantidad * $intCostoUnitario);
					//Calcular utilidad
					$intUtilidad = ($intCantidad * ($intPrecioUnitario - $intCostoUnitario));

					
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
	                         ->setCellValue('A'.$intFila, $arrCol->Sucursal)
	                         ->setCellValue('B'.$intFila, $arrCol->CodVen)
	                         ->setCellValue('C'.$intFila, $arrCol->Vendedor)
	                         ->setCellValue('D'.$intFila, $arrCol->folio)
	                         ->setCellValue('E'.$intFila, $arrCol->fecha)
	                         ->setCellValue('F'.$intFila, $arrCol->Precio)
	                         ->setCellValue('G'.$intFila, $arrCol->condiciones_pago)
	                         ->setCellValue('H'.$intFila, $arrCol->razon_social)
	                         ->setCellValue('I'.$intFila, $arrCol->codigo_linea)
	                         ->setCellValue('J'.$intFila, $arrCol->codigo)
	                         ->setCellValue('K'.$intFila, $arrCol->descripcion)
	                         ->setCellValue('L'.$intFila, $intCantidad)
	                         ->setCellValue('M'.$intFila, $intSubtotal)
	                         ->setCellValue('N'.$intFila, $intCosto)
	                         ->setCellValue('O'.$intFila, $intUtilidad);

					//Incrementar el indice para escribir los datos del siguiente registro
                	$intFila++; 

				}//Cierre de verificación de abono parcial/ abono total


			}//Cierre de foreach


			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            $objExcel->getActiveSheet()
            		 ->getStyle('L'.$intFilaInicial.':'.'O'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar contenido de las celdas a formato númerico de 2 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('L'.$intFilaInicial.':'.'L'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('#,##0.00');


			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('I'.$intFilaInicial.':'.'I'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
                	 ->getStyle('L'.$intFilaInicial.':'.'O'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);


			
		}//Cierre de verificación de ventas
		
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'comisiones_agricultura_inteligente.xls', 'comisiones', $intFila);
	}

   
}	