<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_visitas_reprogramadas extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de prospectos
		$this->load->model('crm/prospectos_model', 'prospectos');
		//Cargamos el modelo de vendedores
		$this->load->model('crm/vendedores_model', 'vendedores');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('crm/rep_visitas_reprogramadas', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el listado de las visitas reprogramadas
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{	        

		//Variables que se utilizan para recuperar los valores de la vista
		$intProspectoID = $this->input->post('intProspectoID');
	    $dteFechaInicial = $this->input->post('dteFechaInicial');
	    $dteFechaFinal = $this->input->post('dteFechaFinal');
	    $intModuloID = $this->input->post('intModuloID');
	    $intVendedorID = $this->input->post('intVendedorID');
        //Variable que se utiliza pra asignar el id actual del vendedor
		$intVendedorIDActual = 0;
        //Variable que se utiliza para definir título de rango de fechas
        $strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Variable que se utiliza para contar el número de registros por vendedor
		$intTotalVisitasVendedor = 0;

		//Si existe rango de fechas
   		if($dteFechaInicial != '' &&  $dteFechaFinal != '')
   		{
   			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
   			$strTituloRangoFechas  = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
   			$strTituloRangoFechas  .= ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
   		}

		//Seleccionar los datos de las visitas reprogramadas a prospectos
		$otdResultado = $this->prospectos->buscar_reprogramacion_visitas($intProspectoID, $dteFechaInicial, 
																		 $dteFechaFinal, $intModuloID, 
																		 $intVendedorID); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'LISTADO DE VISITAS REPROGRAMADAS '.$strTituloRangoFechas;
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('PROSPECTO', 'FECHA ORIGINAL', 'REPROGRAMADA', 
							 utf8_decode('MÓDULO'), 'COMENTARIO');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(50, 25, 25, 23, 67);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'C', 'L', 'L');
		//Establece el ancho de las columnas del vendedor
		$arrAnchuraVendedor = array(20, 170);
		//Establece la alineación de las celdas del vendedor
		$arrAlineacionVendedor = array('L', 'L');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establecer el color de fondo para la cabecera
		$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		//Si hay información
		if($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Si es el primer registro y no existe id del vendedor
      			if($intContador === 0 && $arrCol->vendedor_id === NULL)
      			{
		    		//Asignar id del vendedor actuals
					$intVendedorIDActual = $arrCol->vendedor_id;
      			}

				//Si el vendedor actual es igual a cero (primer vendedor)
	      		if ($intVendedorIDActual === 0 && $arrCol->vendedor_id > 0)
	      		{
	      			//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
      				//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraVendedor);
	                //Vendedor (se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
		        	$pdf->Row(array('VENDEDOR|Negrita', utf8_decode($arrCol->vendedor)), 
							     $arrAlineacionVendedor, 'ClippedCell');
	      			//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 

	      			//Limpiar las siguientes variables (por cada vendedor recorrido)
	      			$intVendedorIDActual = $arrCol->vendedor_id;
	      			$intTotalVisitasVendedor = 0;
	      		}

	      		//Si el vendedor actual es diferente al anterior
	      		if($intVendedorIDActual != $arrCol->vendedor_id && $arrCol->vendedor_id !== NULL)
	      		{
	      			$pdf->Ln(1);//Deja un salto de línea
					//Asigna el tipo y tamaño de letra para los totales
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Escribe la cadena concatenada con el total de registros
					$pdf->Cell(0,3,'VISITAS: '.$intTotalVisitasVendedor, 0, 0, 'R');
	      			$pdf->Ln(4); //Deja un salto de línea
	      			
	      			//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
	      			//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraVendedor);
	                //Vendedor (se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
		        	$pdf->Row(array('VENDEDOR|Negrita', utf8_decode($arrCol->vendedor)), 
							     $arrAlineacionVendedor, 'ClippedCell');
		    		//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
					$pdf->Ln(1); //Deja un salto de línea
	      			//Limpiar las siguientes variables (por cada vendedor recorrido)
	      			$intVendedorIDActual = $arrCol->vendedor_id;
	      			$intTotalVisitasVendedor = 0;
	      		}

	      		//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				$pdf->SetTextColor(0); //Establecer el color de texto por defecto

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol->prospecto), $arrCol->fecha_original, 
								$arrCol->fecha_reprogramada, $arrCol->modulo, 
								utf8_decode($arrCol->comentario)), 
								$pdf->arrAlineacion);


				//Incrementar el contador por cada registro
				$intContador++;
				//Incrementar el contador por cada vendedor
				$intTotalVisitasVendedor++;
			}

			//Escribir las visitas del último vendedor
	   		if($intVendedorIDActual > 0)
			{
				$pdf->Ln();//Deja un salto de línea
				//Asigna el tipo y tamaño de letra para los totales
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Escribe la cadena concatenada con el total de registros
				$pdf->Cell(0,3,'VISITAS: '.$intTotalVisitasVendedor, 0, 0, 'R');
			}
		}
		//Espacios de salto de línea
        $pdf->Ln();
        //Asigna el tipo y tamaño de letra para los totales
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
        //Escribe la cadena concatenada con el total de registros
        $pdf->Cell(0,3,'VISITAS TOTALES: '.$intContador, 0, 0, 'R');
        //Ejecutar la salida del reporte
        $pdf->Output('visitas_reprogramadas.pdf','I'); 
	}

    /*Método para generar un archivo XLS con el listado de las visitas reprogramadas
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$intProspectoID = $this->input->post('intProspectoID');
	    $dteFechaInicial = $this->input->post('dteFechaInicial');
	    $dteFechaFinal = $this->input->post('dteFechaFinal');
	    $intModuloID = $this->input->post('intModuloID');
	    $intVendedorID = $this->input->post('intVendedorID');
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;

        //Seleccionar los datos de las visitas reprogramadas a prospectos
		$otdResultado = $this->prospectos->buscar_reprogramacion_visitas($intProspectoID, $dteFechaInicial, 
																		 $dteFechaFinal, $intModuloID, 
																		 $intVendedorID); 
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas  = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
   			$strTituloRangoFechas  .= ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		}
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE VISITAS REPROGRAMADAS '.$strTituloRangoFechas);
	    //Si existe id del vendedor
		if($intVendedorID > 0)
		{   //Seleccionar los datos del vendedor que coincide con el id
			$otdVendedor =  $this->vendedores->buscar($intVendedorID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'VENDEDOR: '.$otdVendedor->empleado);
		}
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'PROSPECTO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA ORIGINAL')
        		 ->setCellValue('C'.$intPosEncabezados, 'FECHA REPROGRAMADA')
        		 ->setCellValue('D'.$intPosEncabezados, 'MÓDULO')
                 ->setCellValue('E'.$intPosEncabezados, 'COMENTARIOS')
                 ->setCellValue('F'.$intPosEncabezados, 'VENDEDOR')
                 ->setCellValue('G'.$intPosEncabezados, 'LOCALIDAD')
                 ->setCellValue('H'.$intPosEncabezados, 'MUNICIPIO')
                 ->setCellValue('I'.$intPosEncabezados, 'ESTADO');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE,
    													'color' => array('rgb' => 'ffffff')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

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
    			 ->getStyle('A10:I10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

    	//Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:I10')
    			 ->applyFromArray($arrStyleFuenteColumnas);

    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:I10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
				 		->setCellValueExplicit('A'.$intFila, $arrCol->prospecto, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->fecha_original)
                         ->setCellValue('C'.$intFila, $arrCol->fecha_reprogramada)
                         ->setCellValue('D'.$intFila, $arrCol->modulo)
                         ->setCellValue('E'.$intFila, $arrCol->comentario)
                         ->setCellValue('F'.$intFila, $arrCol->vendedor)
                         ->setCellValue('G'.$intFila, $arrCol->localidad)
                         ->setCellValue('H'.$intFila, $arrCol->municipio)
                         ->setCellValue('I'.$intFila, $arrCol->estado);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('I'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('I'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'visitas_reprogramadas.xls', 'reprogramación', $intFila);
	}
}