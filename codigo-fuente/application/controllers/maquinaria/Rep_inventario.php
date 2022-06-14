<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_inventario extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de inventario de maquinaria
		$this->load->model('maquinaria/maquinaria_inventario_model', 'inventario');
		//Cargamos el modelo de líneas de maquinaria
		$this->load->model('maquinaria/maquinaria_lineas_model', 'lineas');
		//Cargamos el modelo de marcas de maquinaria
		$this->load->model('maquinaria/maquinaria_marcas_model', 'marcas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('maquinaria/rep_inventario', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el inventario de maquinaria
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte() 
	{	            
		
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte =  $this->input->post('dteFechaCorte');
		$strConsignacion =  $this->input->post('strConsignacion');
		$intMaquinariaLineaID =  $this->input->post('intMaquinariaLineaID');
		$intMaquinariaMarcaID =  $this->input->post('intMaquinariaMarcaID');
		$intMaquinariaModeloID =  $this->input->post('intMaquinariaModeloID');

		//Variable que se utiliza pra asignar el id actual de la descripción de maquinaria
		$intMaquinariaDescripcionIDActual = 0;
		//Variable que se utiliza para asignar el subtitulo del reporte
		$strSubtitulo = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos del inventario que coinciden con el parámetro enviado
		$otdResultado = $this->inventario->buscar_inventario($dteFechaCorte, $strConsignacion, $intMaquinariaLineaID, 
						   			                         $intMaquinariaMarcaID, $intMaquinariaModeloID); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFecha = $this->get_fecha_formato_letra($dteFechaCorte, 'C');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'INVENTARIO AL '.$strTituloFecha;
		//Si existe id de la línea de maquinaria
		if($intMaquinariaLineaID > 0)
		{
			//Seleccionar los datos de la línea de maquinaria que coincide con el id
			$otdMaquinariaLinea =  $this->lineas->buscar($intMaquinariaLineaID);
			$strSubtitulo .= utf8_decode('LÍNEA: '.$otdMaquinariaLinea->descripcion);
		}

		//Si existe id de la marca de maquinaria
		if($intMaquinariaMarcaID > 0)
		{
			//Seleccionar los datos de la marca de maquinaria que coincide con el id
			$otdMaquinariaMarca =  $this->marcas->buscar($intMaquinariaMarcaID);
			$strSubtitulo .= '    '. utf8_decode('MARCA: '.$otdMaquinariaMarca->descripcion);
			
		}
		//Asignar el valor de la descripción (subtítulo de la lista de registros) del reporte
		$pdf->strLinea2 =  $strSubtitulo;
				//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Crea los titulos de la primer cabecera 
		$pdf->arrCabecera = array(utf8_decode('MAQUINARIA'));
		//Crea los titulos de la segunda cabecera 
		$pdf->arrCabecera2 = array(utf8_decode('LÍNEA'), 'MARCA', 'MODELO');
		//Crea los titulos de la tercera cabecera 
		$pdf->arrCabecera3 = array('SERIE', 'MOTOR', 'ENTRADA', 'FECHA', utf8_decode('CONSIGNACIÓN'));
		//Establece el ancho de las columnas de las cabeceras
		$pdf->arrAnchura = array(190);
		$pdf->arrAnchura2 = array(64, 63, 63);
		$pdf->arrAnchura3 = array(64, 63, 20, 20, 23);
		//Establece la alineación de las celdas de las tablas
		$pdf->arrAlineacion = array('L');
		$pdf->arrAlineacion2 = array('L', 'L', 'L');
		$pdf->arrAlineacion3 = array('L', 'L', 'L', 'C', 'C');
		//Agregar la primer pagina
		$pdf->AddPage();
		
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 

				//Establece el ancho de las columnas de la primer cabecera
				$pdf->SetWidths($pdf->arrAnchura);

				//Si la descripción de maquinaria actual es igual a cero (primer descripción de maquinaria)
	      		if ($intMaquinariaDescripcionIDActual === 0)
	      		{
	      			//Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
	      			//Se agrega la informacion de la primer cabecera al reporte... se utiliza utf8 para acentos y tildes
	      			$pdf->Row(array(utf8_decode($arrCol->maquinaria_descripcion)), 
	      				$pdf->arrAlineacion,'ClippedCell');
							
	      			//Asignar id de la descripción de maquinaria actual
	      			$intMaquinariaDescripcionIDActual = $arrCol->maquinaria_descripcion_id;
	      		}

	      		//Si la descripción de maquinaria actual es diferente al anterior
	      		if ($intMaquinariaDescripcionIDActual != $arrCol->maquinaria_descripcion_id)
	      		{
	      			$pdf->Ln(2); //Deja un salto de línea
	      			//Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
	      			///Se agrega la informacion de la primer cabecera al reporte... se utiliza utf8 para acentos y tildes
	      			$pdf->Row(array(utf8_decode($arrCol->maquinaria_descripcion)), 
									
									$pdf->arrAlineacion, 'ClippedCell');
							
	      			
	      			//Asignar id de la descripción de maquinaria actual
	      	    	$intMaquinariaDescripcionIDActual = $arrCol->maquinaria_descripcion_id;

	      		}
   				

				//Cambiar el volumen de la fuente a normal
				$pdf->strTipoLetraTabla = '';
				//Establece el ancho de las columnas de la segunda cabecera
				$pdf->SetWidths($pdf->arrAnchura2);

				//Se agrega la informacion de la segunda cabecera al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol->maquinaria_linea), utf8_decode($arrCol->maquinaria_marca),
								utf8_decode($arrCol->maquinaria_modelo)), $pdf->arrAlineacion2, 'ClippedCell');


				//Establece el ancho de las columnas de la tecera cabecera
				$pdf->SetWidths($pdf->arrAnchura3);

				//Se agrega la informacion de la tercera cabecera al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol->serie), utf8_decode($arrCol->motor),
								$arrCol->folio_entrada, $arrCol->fecha, $arrCol->consignacion),
							   $pdf->arrAlineacion3, 'ClippedCell');

				//Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);

				//Si existe id del vendedor
				if($arrCol->vendedor_id > 0)
				{
					//Vendedor
					$pdf->Cell(15, 4, 'VENDEDOR:', 0, 0, 'L', 0);
				    $pdf->ClippedCell(80, 4, utf8_decode($arrCol->vendedor), 0, 0, 'L', 0);

				}

				//Si existe id del prospecto
				if($arrCol->prospecto_id > 0)
				{
					//Prospecto
					$pdf->Cell(16, 4, 'PROSPECTO:', 0, 0, 'L', 0);
				    $pdf->ClippedCell(79, 4, utf8_decode($arrCol->prospecto), 0, 0, 'L', 0);
				}

				//Si se cumple la sentencia
				if($arrCol->prospecto_id > 0 OR $arrCol->vendedor_id > 0)
				{
					$pdf->Ln(2); //Deja un salto de línea
				}

				//Si existen observaciones
				if($arrCol->observaciones != '')
				{
					$pdf->Ln(1); //Deja un salto de línea
					//Observaciones
					$pdf->Cell(20, 4, 'OBSERVACIONES:', 0, 0, 'L', 0);
				    $pdf->ClippedCell(170, 4, utf8_decode($arrCol->observaciones), 0, 0, 'L', 0);

					$pdf->Ln(2); //Deja un salto de línea
				}

				$pdf->Ln(1); //Deja un salto de línea

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
		$pdf->Output('inventario_maquinaria.pdf','I'); 
	}


	/*Método para generar un archivo XLS con el inventario de maquinaria
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte =  $this->input->post('dteFechaCorte');
		$strConsignacion =  $this->input->post('strConsignacion');
		$intMaquinariaLineaID =  $this->input->post('intMaquinariaLineaID');
		$intMaquinariaMarcaID =  $this->input->post('intMaquinariaMarcaID');
		$intMaquinariaModeloID =  $this->input->post('intMaquinariaModeloID');

		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 11;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 12;
        $intFilaInicial = 12;
      	//Seleccionar los datos del inventario que coinciden con el parámetro enviado
		$otdResultado = $this->inventario->buscar_inventario($dteFechaCorte, $strConsignacion, $intMaquinariaLineaID, 
						   			                         $intMaquinariaMarcaID, $intMaquinariaModeloID); 
     	
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFecha = $this->get_fecha_formato_letra($dteFechaCorte, 'C');
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'INVENTARIO AL '.$strTituloFecha);

		//Si existe id de la línea de maquinaria
		if($intMaquinariaLineaID > 0)
		{
			//Seleccionar los datos de la línea de maquinaria que coincide con el id
			$otdMaquinariaLinea =  $this->lineas->buscar($intMaquinariaLineaID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'LÍNEA: '.$otdMaquinariaLinea->descripcion);
		}

		//Si existe id de la marca de maquinaria
		if($intMaquinariaMarcaID > 0)
		{
			//Seleccionar los datos de la marca de maquinaria que coincide con el id
			$otdMaquinariaMarca =  $this->marcas->buscar($intMaquinariaMarcaID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A9', 'MARCA: '.$otdMaquinariaMarca->descripcion);
			
		}

		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'MAQUINARIA')
                 ->setCellValue('B'.$intPosEncabezados, 'LÍNEA')
                 ->setCellValue('C'.$intPosEncabezados, 'MARCA')
                 ->setCellValue('D'.$intPosEncabezados, 'MODELO')
                 ->setCellValue('E'.$intPosEncabezados, 'SERIE')
                 ->setCellValue('F'.$intPosEncabezados, 'MOTOR')
                 ->setCellValue('G'.$intPosEncabezados, 'ENTRADA')
                 ->setCellValue('H'.$intPosEncabezados, 'FECHA')
                 ->setCellValue('I'.$intPosEncabezados, 'CONSIGNACIÓN')
                 ->setCellValue('J'.$intPosEncabezados, 'VENDEDOR')
                 ->setCellValue('K'.$intPosEncabezados, 'PROSPECTO')
                 ->setCellValue('L'.$intPosEncabezados, 'OBSERVACIONES');


        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE,
    													'color' => array('rgb' => 'ffffff')));

        $arrStyleFuenteEncabezado = array('font' => array('bold' => TRUE,
    													'color' => array('rgb' => '000000')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la izquierda el contenido de la celda
        $arrStyleAlignmentLeft = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Combinar las siguientes celdas
       	$objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A8:D8');

       	$objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A9:D9');

       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A8:D8')
        		 ->applyFromArray($arrStyleBold);

        $objExcel->getActiveSheet()
        		 ->getStyle('A9:D9')
        		 ->applyFromArray($arrStyleBold);

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A11:L11')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A9:D9')
    			 ->applyFromArray($arrStyleFuenteEncabezado);

    	$objExcel->getActiveSheet()
    			 ->getStyle('A11:L11')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
    	$objExcel->getActiveSheet()
            	 ->getStyle('A9:D9')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentLeft);

		$objExcel->getActiveSheet()
            	 ->getStyle('A11:L11')
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
						 ->setCellValueExplicit('A'.$intFila, $arrCol->maquinaria_descripcion, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->maquinaria_linea)
                         ->setCellValue('C'.$intFila, $arrCol->maquinaria_marca)
                         ->setCellValue('D'.$intFila, $arrCol->maquinaria_modelo)
                         ->setCellValueExplicit('E'.$intFila, $arrCol->serie, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValueExplicit('F'.$intFila, $arrCol->motor, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValueExplicit('G'.$intFila, $arrCol->folio_entrada, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('H'.$intFila, $arrCol->fecha)
                         ->setCellValue('I'.$intFila, $arrCol->consignacion)
                         ->setCellValue('J'.$intFila, $arrCol->vendedor)
                         ->setCellValue('K'.$intFila, $arrCol->prospecto)
                         ->setCellValue('L'.$intFila, $arrCol->observaciones);

                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

            //Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('I'.$intFilaInicial.':'.'I'.$intFila)
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
        $this->get_pie_pagina_archivo_excel($objExcel, 'inventario_maquinaria.xls', 'inventario', $intFila);
	}
}