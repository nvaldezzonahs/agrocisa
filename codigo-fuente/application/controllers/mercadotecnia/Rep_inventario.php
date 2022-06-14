<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_inventario extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('mercadotecnia/rep_inventario_model', 'rep_inventario');
		$this->load->model('administracion/empresas_model', 'empresas');
		$this->load->model('administracion/sucursales_model', 'sucursales');

	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('mercadotecnia/rep_inventario', $arrDatos);
	}



	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($dteFechaCorte) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para asignar título de la fecha
		$strTituloFecha = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;

		//Seleccionar los datos del registro que coincide con la fecha
		$otdResultado = $this->rep_inventario->consultar($dteFechaCorte);
		//var_dump($otdResultado);

		//Si existe rango de fechas
		if($dteFechaCorte != '0000-00-00')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloFecha = 'AL '.$this->get_fecha_formato_letra($dteFechaCorte, 'C');
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
		$pdf->strLinea1 =  'INVENTARIO '.$strTituloFecha;
		
		//Agregar la primer pagina
		$pdf->AddPage();

		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Crea los titulos de la cabecera
		$arrCabecera = array(utf8_decode('DESCRIPCIÓN'), 'FECHA', 'KARDEX', 'COSTO',  'IMPORTE');
		//Establece el ancho de las columnas de cabecera
		$arrAchura = array(110, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$arrAlineacion = array('L', 'C', 'R', 'R', 'R');

		//Recorre el array de titulos de encabezado para crearlos
		for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
		{
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//inserta los titulos de la cabecera
			$pdf->Cell($arrAchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, $arrAlineacion[$intCont], TRUE);
		}
		$pdf->Ln(); //Deja un salto de línea
		
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAchura);

		//Array que se utiliza para agregar los datos de un detalle
		$arrAuxiliar = array();

		//Si hay información
		if ($otdResultado)
		{

			$intInsumoID = 0;
			$numExistencia = 0;
			$numCosto = 0;
			$strDescripcion = '';
			$strFecha = '';

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdResultado as $arrCol)
			{

				//Si el insumoID cambió
   				if($intInsumoID != $arrCol->insumo_id && $intInsumoID != 0)
   				{	
   					//Impresión de variables
					$pdf->Row(array(utf8_decode($strDescripcion), 
												$strFecha,  
												$numExistencia, 
												'$'.number_format($numCosto, 2),
												'$'.number_format($numExistencia * $numCosto, 2)
									), 
									$arrCabecera, 
									$arrAchura, 
									$arrAlineacion, 
									FALSE, 
									FALSE, 
									$arrAlineacion, 
									'ClippedCell'
							);

					//Reinicializar variables
					$numExistencia = $arrCol->inicial_existencia;
					$numCosto = $arrCol->inicial_costo;
   				}

   				if($arrCol->tipo_movimiento < 11){
					
					$numCosto = (($numExistencia * $numCosto) + ($arrCol->cantidad * $arrCol->precio_unitario));
	                $numExistencia += $arrCol->cantidad;
	                if ($numExistencia <> 0){
	                    $numCosto = $numCosto / $numExistencia;
	                }

				}
				else{
					
					$numCosto = (($numExistencia * $numCosto) - ($arrCol->cantidad * $arrCol->precio_unitario));
					$numExistencia -= $arrCol->cantidad;
					if ($numExistencia <> 0){
						$numCosto = $numCosto / $numExistencia;
					}

				}

				$intInsumoID = $arrCol->insumo_id;
				$strDescripcion = $arrCol->descripcion;
				$strFecha = $arrCol->fecha;	
				
				
			}

			//Agregar datos del último insumo
   			if($intInsumoID != 0)
			{
				$pdf->Row(array(utf8_decode($strDescripcion), 
												$strFecha,  
												$numExistencia, 
												'$'.number_format($numCosto, 2),
												'$'.number_format($numExistencia * $numCosto, 2)
									), 
									$arrCabecera, 
									$arrAchura, 
									$arrAlineacion, 
									FALSE, 
									FALSE, 
									$arrAlineacion
							);
			}

		}

		//Ejecutar la salida del reporte
		$pdf->Output('reporte_inventario.pdf','I');	            
		
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaCorte) 
	{
		
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
		//Seleccionar los datos del registro que coincide con la fecha
		$otdResultado = $this->rep_inventario->consultar($dteFechaCorte);
		//var_dump($otdResultado);

		//Si existe rango de fechas
		if($dteFechaCorte != '0000-00-00')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloFecha = 'AL '.$this->get_fecha_formato_letra($dteFechaCorte, 'C');
		}
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'INVENTARIO '.$strTituloFecha );
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'DESCRIPCIÓN')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
                 ->setCellValue('C'.$intPosEncabezados, 'KARDEX')
                 ->setCellValue('D'.$intPosEncabezados, 'COSTO')
                 ->setCellValue('E'.$intPosEncabezados, 'IMPORTE');
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
        			->getStyle('A9:E9')
        			->getFill()
        			->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{
			$intInsumoID = 0;
			$numExistencia = 0;
			$numCosto = 0;
			$strDescripcion = '';
			$strFecha = '';

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdResultado as $arrCol)
			{

				//Si el insumoID cambió
   				if($intInsumoID != $arrCol->insumo_id && $intInsumoID != 0)
   				{	
   					
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFila, $strDescripcion)
                         ->setCellValue('B'.$intFila, $strFecha)
                         ->setCellValue('C'.$intFila, $numExistencia)
                         ->setCellValue('D'.$intFila, $numCosto)
                         ->setCellValue('E'.$intFila, $numExistencia * $numCosto)
                         ;

					//Reinicializar variables
					$numExistencia = $arrCol->inicial_existencia;
					$numCosto = $arrCol->inicial_costo;

					//Incrementar el contador por cada registro
					$intContador++;
                	//Incrementar el indice para escribir los datos del siguiente registro
                	$intFila++; 

   				}

   				if($arrCol->tipo_movimiento < 11){
					
					$numCosto = (($numExistencia * $numCosto) + ($arrCol->cantidad * $arrCol->precio_unitario));
	                $numExistencia += $arrCol->cantidad;
	                if ($numExistencia <> 0){
	                    $numCosto = $numCosto / $numExistencia;
	                }

				}
				else{
					
					$numCosto = (($numExistencia * $numCosto) - ($arrCol->cantidad * $arrCol->precio_unitario));
					$numExistencia -= $arrCol->cantidad;
					if ($numExistencia <> 0){
						$numCosto = $numCosto / $numExistencia;
					}

				}

				$intInsumoID = $arrCol->insumo_id;
				$strDescripcion = $arrCol->descripcion;
				$strFecha = $arrCol->fecha;			

			}

			//Agregar datos del último insumo
   			if($intInsumoID != 0)
			{
				$objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFila, $strDescripcion)
                         ->setCellValue('B'.$intFila, $strFecha)
                         ->setCellValue('C'.$intFila, $numExistencia)
                         ->setCellValue('D'.$intFila, $numCosto)
                         ->setCellValue('E'.$intFila, $numExistencia * $numCosto)
                         ;
			}

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

			$objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
                	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
                	 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');   	 
            $objExcel->getActiveSheet()
                	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
                	 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
                	 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');
            $objExcel->getActiveSheet()
                	 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);


		}

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'reporte_inventario.xls', 'inventario', $intFila);

	}	


}