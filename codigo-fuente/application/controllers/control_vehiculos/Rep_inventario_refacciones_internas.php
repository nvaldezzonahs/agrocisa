<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_inventario_refacciones_internas extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo de inventario de refacciones internas
		$this->load->model('control_vehiculos/refacciones_internas_inventario_model', 'inventario');
		//Cargamos el modelo de líneas de refacciones
		$this->load->model('refacciones/refacciones_lineas_model', 'lineas');
		//Cargamos el modelo de marcas de refacciones
		$this->load->model('refacciones/refacciones_marcas_model', 'marcas');

	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('control_vehiculos/rep_inventario_refacciones_internas', $arrDatos);
	}

	
	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	/*Método para generar un reporte PDF con el inventario de refacciones
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($dteFechaCorte, $intRefaccionesLineaID, $intRefaccionesMarcaID, 
								$strTipoOrdenamiento, $strExistencia, 
								$strLocalizacionInicial = NULL, $strLocalizacionFinal = NULL) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para asignar el subtitulo del reporte
		$strSubtitulo = '';
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16 DE OCTUBRE DE 2017 
		$strTituloFecha = strtoupper($this->get_fecha_formato_letra($dteFechaCorte, ''));
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  'INVENTARIO INTERNO AL '.$strTituloFecha;
		//Si existe id de la línea de refacciones
		if($intRefaccionesLineaID > 0)
		{
			//Seleccionar los datos de la línea de refacciones que coincide con el id
			$otdRefaccionesLinea =  $this->lineas->buscar($intRefaccionesLineaID);
			$strSubtitulo .= utf8_decode('LÍNEA: '.$otdRefaccionesLinea->descripcion);
		}

		//Si existe id de la marca de refacciones
		if($intRefaccionesMarcaID > 0)
		{
			//Seleccionar los datos de la marca de refacciones que coincide con el id
			$otdRefaccionesMarca =  $this->marcas->buscar($intRefaccionesMarcaID);
			$strSubtitulo .= '    '. utf8_decode('MARCA: '.$otdRefaccionesMarca->descripcion);
			
		}
		//Asignar el valor de la descripción (subtítulo de la lista de registros) del reporte
		$pdf->strLinea2 =  $strSubtitulo;
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('LÍNEA'), utf8_decode('CÓDIGO'), 
								  utf8_decode('DESCRIPCIÓN'), 'UNIDAD', 
								  utf8_decode('LOCALIZACIÓN'), 'FECHA', 'KARDEX', 
								  'COSTO', 'IMPORTE');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(15, 25, 40, 15, 20, 15, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L', 'L', 'C', 'R', 'R', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Establecer el color de fondo para la línea
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Seleccionar la existencia inicial de las refacciones del inventario (de la sucursal)
		$otdExistenciaInicial = $this->inventario->buscar_existencia_inicial($dteFechaCorte, 
																			 $intRefaccionesLineaID,
																			 $intRefaccionesMarcaID, 
																			 $strTipoOrdenamiento, 
																			 $strLocalizacionInicial,
																			 $strLocalizacionFinal); 
		
		//Variables que se utilizan para la existencia actual	
		$numAcumCantidadActual = 0;
		$numAcumImporteActual = 0;

		//Si hay información de la existencia inicial
		if($otdExistenciaInicial)
		{
			//Recorremos el arreglo 
			foreach ($otdExistenciaInicial as $arrEx) 
			{

				//Variables que se utilizan para la existencia inicial
				$numCantidadActual = $arrEx->inicial_existencia;
				$numCostoActual = $arrEx->inicial_costo;

				//Asignar array con los acumulados de los movimientos (entradas, salidas y facturas) de la refacción
			    $arrDatosMovRefaccion = $this->get_acumulados_movimientos_refaccion($dteFechaCorte, 
			     															         $arrEx->refaccion_id, 
			     															         $numCantidadActual, 
			     															         $numCostoActual);
			    //Asignar cantidad actual de la refacción
				$numCantidadActual = $arrDatosMovRefaccion['cantidad_actual'];
				//Asignar costo actual de la refacción
				$numCostoActual = $arrDatosMovRefaccion['costo_actual'];

				//Bandera que se utiliza para agregar información de la refacción
				$bolEntro = TRUE;

				//Si se no se cumple la sentencia
				if (($strExistencia ==  'SI') AND ($numCantidadActual == 0))
				{
					//Asignar FALSE para evitar escribir datos
					$bolEntro = FALSE;
				}

				//Si se cumple la sentencia
				if ($bolEntro)
				{
					//Calcular importe actual
					$intImporteActual = ($numCantidadActual * $numCostoActual);
					
					//Incrementar acumulados
					$numAcumCantidadActual += $numCantidadActual;
					$numAcumImporteActual += $intImporteActual;

					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
	      			$pdf->Row(array(utf8_decode($arrEx->CodigoLinea),  $arrEx->codigo_01, 
									utf8_decode($arrEx->descripcion), utf8_decode($arrEx->CodigoUnidad),
									utf8_decode($arrEx->localizacion), $arrEx->Fecha, 
									number_format($numCantidadActual, 2, '.', ','),
									"$".number_format($numCostoActual, 2, '.', ','),
									"$".number_format($intImporteActual, 2, '.', ',')), 
									$pdf->arrAlineacion, 'ClippedCell');
	      		}
				

			}//Cierre de foreach de la existencia inicial 

		}//Cierre de verificación de existencia inicial

		$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());//dibuja una linea para separar la información de los movimientos

        //Cambiar el volumen de la letra
    	$pdf->strTipoLetraTabla = 'Negrita';
    	//Imprimir el renglon correspondiente a los totales
		$pdf->Row(array('', '', '', '', '', utf8_decode('TOTALES'),
						number_format($numAcumCantidadActual, 2, '.', ','), '',
						"$".number_format($numAcumImporteActual, 2, '.', ',')), 
					$pdf->arrAlineacion,  'ClippedCell');
		//Cambiar el volumen de la letra
    	$pdf->strTipoLetraTabla = 'Normal';

		//Ejecutar la salida del reporte
		$pdf->Output('inventario_refacciones.pdf','I');	 
	}

	/*Método para generar un archivo XLS  con el inventario de refacciones
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls($dteFechaCorte, $intRefaccionesLineaID, $intRefaccionesMarcaID, 
							$strTipoOrdenamiento, $strExistencia, 
							$strLocalizacionInicial = NULL, $strLocalizacionFinal = NULL) 
	{	
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 11;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 12;
        $intFilaInicial = 12;
      	//Seleccionar la existencia inicial de las refacciones del inventario (de la sucursal)
		$otdExistenciaInicial = $this->inventario->buscar_existencia_inicial($dteFechaCorte, 
																			 $intRefaccionesLineaID,
																			 $intRefaccionesMarcaID, 
																			 $strTipoOrdenamiento, 
																			 $strLocalizacionInicial,
																			 $strLocalizacionFinal); 
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
			     ->setCellValue('A7', 'INVENTARIO INTERNO AL '.$strTituloFecha);
		//Si existe id de la línea de refacciones
		if($intRefaccionesLineaID > 0)
		{
			//Seleccionar los datos de la línea de refacciones que coincide con el id
			$otdRefaccionesLinea =  $this->lineas->buscar($intRefaccionesLineaID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'LÍNEA: '.$otdRefaccionesLinea->descripcion);
		}

		//Si existe id de la marca de refacciones
		if($intRefaccionesMarcaID > 0)
		{
			//Seleccionar los datos de la marca de refacciones que coincide con el id
			$otdRefaccionesMarca =  $this->marcas->buscar($intRefaccionesMarcaID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A9', 'MARCA: '.$otdRefaccionesMarca->descripcion);
			
		}

		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'LÍNEA')
                 ->setCellValue('B'.$intPosEncabezados, 'CÓDIGO')
                 ->setCellValue('C'.$intPosEncabezados, 'DESCRIPCIÓN')
                 ->setCellValue('D'.$intPosEncabezados, 'UNIDAD')
                 ->setCellValue('E'.$intPosEncabezados, 'LOCALIZACIÓN')
                 ->setCellValue('F'.$intPosEncabezados, 'FECHA')
                 ->setCellValue('G'.$intPosEncabezados, 'KARDEX')
                 ->setCellValue('H'.$intPosEncabezados, 'COSTO')
                 ->setCellValue('I'.$intPosEncabezados, 'IMPORTE');


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

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

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
    			 ->getStyle('A11:I11')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A9:D9')
    			 ->applyFromArray($arrStyleFuenteEncabezado);

    	$objExcel->getActiveSheet()
    			 ->getStyle('A11:I11')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
    	$objExcel->getActiveSheet()
            	 ->getStyle('A9:D9')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentLeft);

		$objExcel->getActiveSheet()
            	 ->getStyle('A11:I11')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Variables que se utilizan para la existencia actual	
		$numAcumCantidadActual = 0;
		$numAcumImporteActual = 0;

		//Si hay información de la existencia inicial
		if($otdExistenciaInicial)
		{
			//Recorremos el arreglo 
			foreach ($otdExistenciaInicial as $arrEx) 
			{

				//Variables que se utilizan para la existencia inicial
				$numCantidadActual = $arrEx->inicial_existencia;
				$numCostoActual = $arrEx->inicial_costo;

				//Asignar array con los acumulados de los movimientos (entradas, salidas y facturas) de la refacción
			    $arrDatosMovRefaccion = $this->get_acumulados_movimientos_refaccion($dteFechaCorte, 
			     															         $arrEx->refaccion_id, 
			     															         $numCantidadActual, 
			     															         $numCostoActual);
			    //Asignar cantidad actual de la refacción
				$numCantidadActual = $arrDatosMovRefaccion['cantidad_actual'];
				//Asignar costo actual de la refacción
				$numCostoActual = $arrDatosMovRefaccion['costo_actual'];

				//Bandera que se utiliza para agregar información de la refacción
				$bolEntro = TRUE;

				//Si se no se cumple la sentencia
				if (($strExistencia ==  'SI') AND ($numCantidadActual == 0))
				{
					//Asignar FALSE para evitar escribir datos
					$bolEntro = FALSE;
				}

				//Si se cumple la sentencia
				if ($bolEntro)
				{
					//Calcular importe actual
					$intImporteActual = ($numCantidadActual * $numCostoActual);
					
					//Incrementar acumulados
					$numAcumCantidadActual += $numCantidadActual;
					$numAcumImporteActual += $intImporteActual;

	      			//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
							 ->setCellValueExplicit('A'.$intFila, $arrEx->CodigoLinea, PHPExcel_Cell_DataType::TYPE_STRING)
							 ->setCellValueExplicit('B'.$intFila, $arrEx->codigo_01, PHPExcel_Cell_DataType::TYPE_STRING)
							 ->setCellValue('C'.$intFila, $arrEx->descripcion)
							 ->setCellValueExplicit('D'.$intFila, $arrEx->CodigoUnidad, PHPExcel_Cell_DataType::TYPE_STRING)
							 ->setCellValueExplicit('E'.$intFila, $arrEx->localizacion, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('F'.$intFila, $arrEx->Fecha)
	                         ->setCellValue('G'.$intFila, $numCantidadActual)
	                         ->setCellValue('H'.$intFila, $numCostoActual)
	                         ->setCellValue('I'.$intFila, $intImporteActual);

	                //Incrementar el indice para escribir los datos del siguiente registro
                	$intFila++; 
	      		}
				

			}//Cierre de foreach de la existencia inicial 

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
	            	 ->getStyle('G'.$intFilaInicial.':'.'I'.$intFila)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentRight);

		}//Cierre de verificación de existencia inicial

		//Incrementar el indice para escribir el total
        $intFila++;
        //Agregar información del total
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('F'.$intFila,  'TOTAL: ')
                 ->setCellValue('G'.$intFila,  $numAcumCantidadActual)
                 ->setCellValue('I'.$intFila,  $numAcumImporteActual);
        //Cambiar estilo de la celda
        $objExcel->getActiveSheet()
        		 ->getStyle('F'.$intFila.':'.'I'.$intFila)
        		 ->applyFromArray($arrStyleBold);


	    //Cambiar contenido de las celdas a formato númerico de 2 decimales
	    $objExcel->getActiveSheet()
	    		 ->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)
	    		 ->getNumberFormat()
	    		 ->setFormatCode('###0.00');

       	//Cambiar contenido de las celdas a formato moneda
        $objExcel->getActiveSheet()
        		 ->getStyle('H'.$intFilaInicial.':'.'I'.$intFila)
        		 ->getNumberFormat()
        		 ->setFormatCode('$#,##0.00');

       	//Cambiar alineación de las siguientes celdas
        $objExcel->getActiveSheet()
            	 ->getStyle('F'.$intFila.':'.'I'.$intFila)
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentRight);

		
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'inventario_refacciones.xls', 'inventario', $intFila);
	}

	//Función que se utiliza para regresar los acumulados de los movimientos internos (entradas y salidas) de una refacción
	public function get_acumulados_movimientos_refaccion($dteFechaCorte, $intRefaccionID, $numCantidadActual, $numCostoActual)
	{

		//Array que se utiliza para enviar datos
		$arrDatos = array('cantidad_actual' => 0,
						  'costo_actual' => 0);

		//Seleccionar los movimientos (entradas, salidas y facturas) de la refacción
		$otdMovimientos = $this->inventario->buscar_movimientos($dteFechaCorte, 
																$intRefaccionID);

		//Si hay información de movimientos
		if($otdMovimientos)
		{
			//Recorremos el arreglo 
			foreach ($otdMovimientos as $arrMov)
			{
				//Asignar tipo de movimiento
				$intTipoMovimiento = $arrMov->tipo_movimiento;

				//Si el tipo de movimiento corresponde a una entrada
				if ($intTipoMovimiento < SALIDA_REFACCIONES_INTERNAS)
				{
					//Calcular costo actual
					$numCostoActual = (($numCantidadActual * $numCostoActual) + ($arrMov->cantidad * $arrMov->costo_unitario));
					//Incrementar cantidad actual
					$numCantidadActual += $arrMov->cantidad;
				   
				}
				else
				{
					//Calcular costo actual
					$numCostoActual = (($numCantidadActual * $numCostoActual) - ($arrMov->cantidad * $arrMov->costo_unitario));
					//Decrementar cantidad actual
					$numCantidadActual -= $arrMov->cantidad;
				}

				//Si hay existencia
				if ($numCantidadActual <> 0)
				{
					//Calcular costo actual
					$numCostoActual = $numCostoActual / $numCantidadActual;
				}
			}
				
		}//Cierre de verificación de movimientos de refacciones
		
		//Asignar datos al array los acumulados de los movimientos de la refacción
		$arrDatos = array('cantidad_actual' =>  $numCantidadActual,
						  'costo_actual' => $numCostoActual);


		//Regresar array con los acumulados de los movimientos de la refacción
		return $arrDatos;
	}

	
}	