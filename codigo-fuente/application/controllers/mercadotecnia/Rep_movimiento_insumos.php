<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_movimiento_insumos extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('mercadotecnia/rep_movimiento_insumos_model', 'rep_movimiento_insumos');
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
		$this->cargar_vista('mercadotecnia/rep_movimiento_insumos', $arrDatos);
	}


	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($intInsumoID, $dteFechaInicial, $dteFechaFinal) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para asignar título de la fecha
		$strTituloFecha = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos del registro que coincide con los parametros enviados
		$otdInicial = $this->rep_movimiento_insumos->consultar_inicial($intInsumoID, $dteFechaInicial);
		//Seleccionar los registros que coinciden con los parametros enviados
		$otdResultado = $this->rep_movimiento_insumos->consultar($intInsumoID, $dteFechaInicial, $dteFechaFinal);

		//Si existe rango de fechas
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloFecha = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C').' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
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
		$pdf->strLinea1 = 'MOVIMIENTOS DE INSUMOS '.$strTituloFecha;
		
		//Nombre del insumo que se esta imprimiendo en el reporte
		if($otdInicial){
			$pdf->strLinea2 = 'INSUMO: '.$otdInicial[0]->descripcion;
		}
		else{
			$pdf->strLinea2 = 'SIN MOVIMIENTOS PARA ESTE INSUMO';
		}
		
		
		//Agregar la primer pagina
		$pdf->AddPage();

		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Crea los titulos de la cabecera
		$arrCabecera = array(utf8_decode('MOVIMIENTO'), 'FOLIO', 'FECHA', 'CANTIDAD', 'COSTO',  'IMPORTE', 'EXISTENCIA', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$arrAchura = array(50, 20, 20, 20, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$arrAlineacion = array('L', 'L', 'C', 'R', 'R', 'R', 'R', 'C');

		$arrAlineacion2 = array('L', 'L', 'C', 'L', 'R', 'R', 'R', 'C');

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

		//Si hay información
		if ($otdInicial)
		{

			$numExistenciaInicial = $otdInicial[0]->inicial_existencia;
			$numCostoInicial = $otdInicial[0]->inicial_costo;

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdInicial as $arrCol)
			{
				
				if($arrCol->tipo_movimiento < 11){
					
					$numCostoInicial = (($numExistenciaInicial * $numCostoInicial) + ($arrCol->cantidad * $arrCol->precio_unitario));
	                $numExistenciaInicial += $arrCol->cantidad;
	                if ($numExistenciaInicial <> 0){
	                    $numCostoInicial = $numCostoInicial / $numExistenciaInicial;
	                }
				}
				else{
					
					$numCostoInicial = (($numExistenciaInicial * $numCostoInicial) - ($arrCol->cantidad * $arrCol->precio_unitario));
					$numExistenciaInicial -= $arrCol->cantidad;
					if ($numExistenciaInicial <> 0){
						$numCostoInicial = $numCostoInicial / $numExistenciaInicial;
					}

				}

			}

			//Imprimir el renglon correspondiente a la EXISTENCIA INICIAL
			$pdf->Row(array(utf8_decode('EXISTENCIA INICIAL'), 
											'',
											'', 
											number_format($numExistenciaInicial, 2),
											'$'.number_format($numCostoInicial, 2),
											'$'.number_format($numCostoInicial * $numExistenciaInicial, 2),
											number_format($numExistenciaInicial, 2),
											''
									), 
									$arrCabecera, 
									$arrAchura, 
									$arrAlineacion, 
									FALSE, 
									FALSE, 
									$arrAlineacion,  
									'ClippedCell'
						);
			
			

		}

		if($otdResultado){

			$acumImporte = $numExistenciaInicial * $numCostoInicial;
			$acumExistencia = $numExistenciaInicial;

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdResultado as $arrCol)
			{
				
				//Solo sumamos los movimientos que se encuentran activos
				if($arrCol->estatus == 'ACTIVO'){

					if($arrCol->tipo_movimiento < 11){
						$acumImporte += $arrCol->cantidad * $arrCol->precio_unitario;
						$acumExistencia += $arrCol->cantidad;
					}
					else{
						
						$acumImporte -= $arrCol->cantidad * $arrCol->precio_unitario;
						$acumExistencia -= $arrCol->cantidad;

					}

				}

				$tipoMovimiento = '';
				switch ($arrCol->tipo_movimiento) {
					case '1':
						$tipoMovimiento = 'ENTRADA POR COMPRA';
						break;

					case '2':
						$tipoMovimiento = 'ENTRADA DESPUÉS DE EVENTO';
						break;

					case '11':
						$tipoMovimiento = 'SALIDA A DE EVENTO';
						break;
				}

				
				if($arrCol->tipo_movimiento < 11){
					$pdf->Row(array(utf8_decode($tipoMovimiento), 
											$arrCol->folio,
											$arrCol->fecha, 
											number_format($arrCol->cantidad, 2),
											'$'.number_format($arrCol->precio_unitario, 2),
											'$'.number_format($arrCol->precio_unitario * $arrCol->cantidad, 2),
											number_format($acumExistencia, 2),
											$arrCol->estatus
									), 
									$arrCabecera, 
									$arrAchura, 
									$arrAlineacion2, 
									FALSE, 
									FALSE, 
									$arrAlineacion2,  
									'ClippedCell'
						);
				}
				else{
					$pdf->Row(array(utf8_decode($tipoMovimiento), 
											$arrCol->folio,
											$arrCol->fecha, 
											number_format($arrCol->cantidad, 2),
											'$'.number_format($arrCol->precio_unitario, 2),
											'$'.number_format($arrCol->precio_unitario * $arrCol->cantidad, 2),
											number_format($acumExistencia, 2),
											$arrCol->estatus
									), 
									$arrCabecera, 
									$arrAchura, 
									$arrAlineacion, 
									FALSE, 
									FALSE, 
									$arrAlineacion,  
									'ClippedCell'
						);
				}
				

			}

			//Espacios de salto de línea
		    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
		    //Cambiar el volumen de la letra
	        $pdf->strTipoLetraTabla = 'Negrita';
			//Escribe la cadena concatenada con el total de registros
			$pdf->Row(array(utf8_decode('EXISTENCIA ACTUAL'), 
												'',
												'', 
												'',
												'$'.number_format($acumImporte/$acumExistencia, 2),
												'$'.number_format($acumImporte, 2),
												number_format($acumExistencia, 2),
												''
										), 
										$arrCabecera, 
										$arrAchura, 
										$arrAlineacion, 
										FALSE, 
										FALSE, 
										$arrAlineacion,  
										'ClippedCell'
							);

		}	

		//Ejecutar la salida del reporte
		$pdf->Output('reporte_movimiento_insumos.pdf','I');	 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($intInsumoID, $dteFechaInicial, $dteFechaFinal) 
	{
		
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFilaInicial = 10;
        $intFila = 11;
		//Variable que se utiliza para asignar título de la fecha
		$strTituloFecha = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos del registro que coincide con los parametros enviados
		$otdInicial = $this->rep_movimiento_insumos->consultar_inicial($intInsumoID, $dteFechaInicial);
		//Seleccionar los registros que coinciden con los parametros enviados
		$otdResultado = $this->rep_movimiento_insumos->consultar($intInsumoID, $dteFechaInicial, $dteFechaFinal);
		//Si existe rango de fechas
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloFecha = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C').' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		}
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);

        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)->setCellValue('A7', 'MOVIMIENTOS DE INSUMOS ENTRE '.$strTituloFecha );
		
		//Se agrega el subtítulo del archivo
		if($otdInicial){
			$objExcel->setActiveSheetIndex(0)->setCellValue('A8', 'INSUMO: '.$otdInicial[0]->descripcion );	
		}
		else{
			$objExcel->setActiveSheetIndex(0)->setCellValue('A8', 'SIN MOVIMIENTOS PARA ESTE INSUMO' );	
		}
		     	     
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'MOVIMIENTO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FOLIO')
                 ->setCellValue('C'.$intPosEncabezados, 'FECHA')
                 ->setCellValue('D'.$intPosEncabezados, 'CANTIDAD')
                 ->setCellValue('E'.$intPosEncabezados, 'COSTO')
                 ->setCellValue('F'.$intPosEncabezados, 'IMPORTE')
                 ->setCellValue('G'.$intPosEncabezados, 'EXISTENCIA');

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
        $objExcel->getActiveSheet()->getStyle('A9:G9')->getFill()->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdInicial)
		{

			$numExistenciaInicial = $otdInicial[0]->inicial_existencia;
			$numCostoInicial = $otdInicial[0]->inicial_costo;

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdInicial as $arrCol)
			{
				
				if($arrCol->tipo_movimiento < 11){
					
					$numCostoInicial = (($numExistenciaInicial * $numCostoInicial) + ($arrCol->cantidad * $arrCol->precio_unitario));
	                $numExistenciaInicial += $arrCol->cantidad;
	                if ($numExistenciaInicial <> 0){
	                    $numCostoInicial = $numCostoInicial / $numExistenciaInicial;
	                }
				}
				else{
					
					$numCostoInicial = (($numExistenciaInicial * $numCostoInicial) - ($arrCol->cantidad * $arrCol->precio_unitario));
					$numExistenciaInicial -= $arrCol->cantidad;
					if ($numExistenciaInicial <> 0){
						$numCostoInicial = $numCostoInicial / $numExistenciaInicial;
					}

				}

			}

			//Crear el renglon correspondiente a la EXISTENCIA INICIAL
			$objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFilaInicial, 'EXISTENCIA INICIAL')
                         ->setCellValue('B'.$intFilaInicial, '')
                         ->setCellValue('C'.$intFilaInicial, '')
                         ->setCellValue('D'.$intFilaInicial, $numExistenciaInicial)
                         ->setCellValue('E'.$intFilaInicial, $numCostoInicial)
                         ->setCellValue('F'.$intFilaInicial, $numCostoInicial * $numExistenciaInicial)
                         ->setCellValue('G'.$intFilaInicial, $numExistenciaInicial)
                         ;
			
		}

		if($otdResultado){

			$acumImporte = $numExistenciaInicial * $numCostoInicial;
			$acumExistencia = $numExistenciaInicial;

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdResultado as $arrCol)
			{
				
				if($arrCol->tipo_movimiento < 11){
					
					$acumImporte += $arrCol->cantidad * $arrCol->precio_unitario;
					$acumExistencia += $arrCol->cantidad;
				}
				else{
					
					$acumImporte -= $arrCol->cantidad * $arrCol->precio_unitario;
					$acumExistencia -= $arrCol->cantidad;

				}

				$tipoMovimiento = '';
				switch ($arrCol->tipo_movimiento) {
					case '1':
						$tipoMovimiento = 'ENTRADA POR COMPRA';
						break;

					case '2':
						$tipoMovimiento = 'ENTRADA DESPUÉS DE EVENTO';
						break;

					case '11':
						$tipoMovimiento = 'SALIDA A DE EVENTO';
						break;
				}

				//Crear el renglon correspondiente a la EXISTENCIA INICIAL
				$objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFila, utf8_decode($tipoMovimiento))
                         ->setCellValueExplicit('B'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('C'.$intFila, $arrCol->fecha)
                         ->setCellValue('D'.$intFila, $arrCol->cantidad)
                         ->setCellValue('E'.$intFila, $arrCol->precio_unitario)
                         ->setCellValue('F'.$intFila, $arrCol->precio_unitario * $arrCol->cantidad)
                         ->setCellValue('G'.$intFila, $acumExistencia)
                         ;
				
				//Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 

			}

			

            //Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

			$objExcel->getActiveSheet()
                	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
                	 ->getNumberFormat()
            		 ->setFormatCode('##0.00');
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

            $objExcel->getActiveSheet()
                	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
                	 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');
            $objExcel->getActiveSheet()
                	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
                	 ->getAlignment() 
                	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
                	 ->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)
                	 ->getNumberFormat()
            		 ->setFormatCode('##0.00');    	 
            $objExcel->getActiveSheet()
                	 ->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);     	 
                	 
            //Agregar información de la existencia actual
            $objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFila, 'EXISTENCIA ACTUAL')
                         ->setCellValue('B'.$intFila, '')
                         ->setCellValue('C'.$intFila, '')
                         ->setCellValue('D'.$intFila, '')
                         ->setCellValue('E'.$intFila, $acumImporte/$acumExistencia)
                         ->setCellValue('F'.$intFila, $acumImporte)
                         ->setCellValue('G'.$intFila, $acumExistencia)
                         ;
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('A'.$intFila.':'.'G'.$intFila)
            		 ->applyFromArray($arrStyleBold);             

		}
		
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'reporte_movimiento_insumos.xls', 'movimiento_insumos', $intFila);

	}


}	