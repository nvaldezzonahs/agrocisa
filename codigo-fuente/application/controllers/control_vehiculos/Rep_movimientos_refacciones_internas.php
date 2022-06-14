<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_movimientos_refacciones_internas extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo del reporte de movimientos
		$this->load->model('control_vehiculos/rep_movimientos_refacciones_internas_model', 'movimientos');
		//Cargamos el modelo de sucursales
		$this->load->model('administracion/sucursales_model', 'sucursales');
		//Cargamos el modelo de refacciones
		$this->load->model('refacciones/refacciones_model', 'refacciones');

	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('control_vehiculos/rep_movimientos_refacciones_internas', $arrDatos);
	}

	
	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	/*Método para generar un reporte PDF con el listado de los movimientos de la refacción 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $intRefaccionID, $arrSucursales) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Quitar espacios vacíos y decodificar cadena cifrada
		$arrSucursales = trim(urldecode($arrSucursales));
		//Variable que se utiliza para asignar título de la fecha
		$strTituloFecha = '';

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
		$pdf->strLinea1 = 'MOVIMIENTOS DE REFACCIONES '.$strTituloFecha;
		//Seleccionar los datos de la refacción que coincide con el id
		$otdRefaccion =  $this->refacciones->buscar($intRefaccionID);
		//Concatenar datos de la refacción
		$strRefaccion = $otdRefaccion->codigo_01.' - '.$otdRefaccion->descripcion;
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('MOVIMIENTO'), 'FOLIO', 'FECHA', 'CANTIDAD', 
								  'COSTO', 'IMPORTE', 'EXISTENCIA');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(70, 20, 20, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'R', 'R', 'R', 'R');
		$arrAlineacionEntrada = array('L', 'L', 'C', 'L', 'R', 'R', 'R');
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Establecer el color de fondo para la línea
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		/*Quitar | de la lista para obtener el ID de la sucursal
		*/
		$arrSucursalID = explode("|", $arrSucursales);

		//Hacer recorrido para obtener sucursales
		for ($intCon = 0; $intCon < sizeof($arrSucursalID); $intCon++) 
		{
			//Variable que se utiliza para asignar el id de la sucursal
			$intSucursalID = $arrSucursalID[$intCon];
			//Seleccionar los datos de la sucursal que coincide con el id
			$otdSucursal =  $this->sucursales->buscar($intSucursalID);

			//Seleccionar la existencia inicial de la refacción
			$otdExistenciaInicial = $this->movimientos->buscar_existencia_inicial($dteFechaInicial, 
																				  $intSucursalID,
																				  $intRefaccionID);

			//Seleccionar los movimientos (entradas, salidas y facturas) de la refacción
			$otdMovimientos = $this->movimientos->buscar_movimientos($dteFechaInicial, 
																	 $dteFechaFinal,
																	 $intSucursalID,
																	 $intRefaccionID);


			//Variables que se utilizan para la existencia inicial
			$numCantidadInicial = 0;
			$numImporteInicial =  0;
			$numCostoInicial =  0;
			$strLocalizacion = '';

			//Si hay información de la existencia inicial
			if($otdExistenciaInicial)
			{	
				//Recorremos el arreglo 
				foreach ($otdExistenciaInicial as $arrEx) 
				{
					//Asignar datos a las variables
					$numCantidadInicial = $arrEx->Cantidad;
					$numImporteInicial = $arrEx->Importe;
					$strLocalizacion = $arrEx->localizacion;
					//Si existe cantidad inicial
					if ($numCantidadInicial > 0)
					{
						//Calcular costo inicial
						$numCostoInicial = ($numImporteInicial/$numCantidadInicial);
					}
					
				}

			}//Cierre de verificación de existencia inicial

			//Establece las descripciones del título del reporte (posición segunda línea)
			$pdf->arrDatosLinea2 = array(utf8_decode('REFACCIÓN: '.$strRefaccion),  
							        	 utf8_decode('LÍNEA: '.$otdRefaccion->refacciones_linea),  
							 	  	 	 utf8_decode('LOCALIZACIÓN: '.$strLocalizacion).'                '. 
							 	  	     utf8_decode('UNIDAD: '.$otdRefaccion->unidad),
							 	  	     utf8_decode('SUCURSAL: '.$otdSucursal->nombre));


			//Agregar la primer pagina
			$pdf->AddPage();

			//Cambiar el volumen de la letra
            $pdf->strTipoLetraTabla = 'Negrita';
			//Imprimir el renglon correspondiente a la EXISTENCIA INICIAL
			$pdf->Row(array(utf8_decode('EXISTENCIA INICIAL'), '', '',
							number_format($numCantidadInicial, 2, '.', ','),
							"$".number_format($numCostoInicial, 2, '.', ','),
							"$".number_format($numImporteInicial, 2, '.', ','),
							number_format($numCantidadInicial, 2, '.', ',')), 
						$pdf->arrAlineacion,  'ClippedCell');
			//Cambiar el volumen de la letra
        	$pdf->strTipoLetraTabla = 'Normal';

        	//Variables que se utilizan para la existencia actual
			$numCantidadActual = $numCantidadInicial;
			$numImporteActual = $numImporteInicial;
			$numCostoActual = $numCostoInicial;

			//Si hay información de movimientos
			if($otdMovimientos)
			{
				//Recorremos el arreglo 
				foreach ($otdMovimientos as $arrMov) 
				{
					//Asignar tipo de movimiento
					$intTipoMovimiento = $arrMov->tipo_movimiento;
					//Asignar descripción del tipo de movimiento
					$strConcepto = $this->ARR_MOV_REFACCIONES_INTERNAS_DESCRIPCIONES[$intTipoMovimiento];
					//Array que se utiliza para agregar alineación de las celdas de la tabla dependiendo del tipo de movimiento (entrada/salida)
					$arrTipoAlineacion = array();
					//Variable que se utiliza para asignar el costo del detalle
					$intCosto = 0;

					//Calcular costo del detalle
					$intCosto = ($arrMov->cantidad * $arrMov->costo_unitario);

					//Si el estatus del movimiento es INACTIVO
					if($arrMov->estatus == 'INACTIVO')
					{
						//Concatenar referencia al concepto del movimiento
						$strConcepto .= " - CANCELADO";
					}

					//Si el tipo de movimiento corresponde a una entrada
					if ($intTipoMovimiento < SALIDA_REFACCIONES_INTERNAS)
					{
						//Si el estatus del movimiento es diferente de INACTIVO
						if($arrMov->estatus <> 'INACTIVO')
						{
							//Incrementar cantidad
							$numCantidadActual += $arrMov->cantidad;
							//Incrementar importe
							$numImporteActual += $intCosto;
						}
						
						//Cambiar alineación para mostrar cantidad a la izquierda
						$arrTipoAlineacion = $arrAlineacionEntrada;
					   
					}
					else
					{
						//Si el estatus del movimiento es diferente de INACTIVO
						if($arrMov->estatus <> 'INACTIVO')
						{
							//Decrementar cantidad
							$numCantidadActual -= $arrMov->cantidad;
							//Decrementar importe
							$numImporteActual -= $intCosto;

						}
						
						//Cambiar alineación para mostrar cantidad a la derecha
						$arrTipoAlineacion =  $pdf->arrAlineacion;
						
					}

					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
	      			$pdf->Row(array(utf8_decode($strConcepto), $arrMov->folio, $arrMov->fecha_format, 
									number_format($arrMov->cantidad, 2, '.', ','),
									"$".number_format($arrMov->costo_unitario, 2, '.', ','),
									"$".number_format($intCosto, 2, '.', ','),
									number_format($numCantidadActual, 2, '.', ',')), 
									$arrTipoAlineacion, 'ClippedCell');
				}

				//Si existe cantidad actual
				if ($numCantidadActual > 0)
				{
					//Calcular costo actual
					$numCostoActual = ($numImporteActual/$numCantidadActual);
				}

			}//Cierre de verificación de movimientos de refacciones

			
	    	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());//dibuja una linea para separar la información de los movimientos
					
	   		//Cambiar el volumen de la letra
        	$pdf->strTipoLetraTabla = 'Negrita';
        	//Imprimir el renglon correspondiente a la EXISTENCIA ACTUAL
			$pdf->Row(array(utf8_decode('EXISTENCIA ACTUAL'), '', '',
							number_format($numCantidadActual, 2, '.', ','),
							"$".number_format($numCostoActual, 2, '.', ','),
							"$".number_format($numImporteActual, 2, '.', ','),
							number_format($numCantidadActual, 2, '.', ',')), 
						$pdf->arrAlineacion,  'ClippedCell');
			//Cambiar el volumen de la letra
        	$pdf->strTipoLetraTabla = 'Normal';

		}//Cierre de for 

		//Ejecutar la salida del reporte
		$pdf->Output('reporte_movimientos_refacciones_'.$otdRefaccion->codigo_01.'.pdf','I');	 
	}

	/*Método para generar un archivo XLS con el listado de los movimientos de la refacción 
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $intRefaccionID, $arrSucursales) 
	{
		//Quitar espacios vacíos y decodificar cadena cifrada
		$arrSucursales = trim(urldecode($arrSucursales));
	   //Variable que se utiliza para asignar título de la fecha
		$strTituloFecha = '';
		//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 13;
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
		//Variable que se utiliza para asignar el número máximo de movimientos (evitar que la fecha de impresión tome como última fila el número de registros de la última sucursal)
		$intNumMaxMovimientos = 0;
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
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE,
        												'name' => 'Arial',
        												'size' => 9,
    													'color' => array('rgb' => 'ffffff')));

        $arrStyleFuenteColumnasPrinc = array('font' => array('bold' => TRUE,
    													     'color' => array('rgb' => '000000')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la izquierda el contenido de la celda
        $arrStyleAlignmentLeft = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));


        //Seleccionar los datos de la refacción que coincide con el id
		$otdRefaccion =  $this->refacciones->buscar($intRefaccionID);
		//Concatenar datos de la refacción
		$strRefaccion = $otdRefaccion->codigo_01.' - '.$otdRefaccion->descripcion;

        /*Quitar | de la lista para obtener el ID de la sucursal
		*/
		$arrSucursalID = explode("|", $arrSucursales);

		

		//Hacer recorrido para obtener sucursales
		for ($intCon = 0; $intCon < sizeof($arrSucursalID); $intCon++) 
		{
			
			//Variable que se utiliza para asignar el id de la sucursal
			$intSucursalID = $arrSucursalID[$intCon];
			//Seleccionar los datos de la sucursal que coincide con el id
			$otdSucursal =  $this->sucursales->buscar($intSucursalID);
			//Variable que se utiliza para asignar el número de movimientos 
			$intNumMovimientos = 0; 
			//Número de fila donde se va a comenzar a rellenar
			$intFila = 14;
			$intFilaInicial = 14;


			//Seleccionar la existencia inicial de la refacción
			$otdExistenciaInicial = $this->movimientos->buscar_existencia_inicial($dteFechaInicial, 
																				  $intSucursalID,
																				  $intRefaccionID);

			//Seleccionar los movimientos (entradas, salidas y facturas) de la refacción
			$otdMovimientos = $this->movimientos->buscar_movimientos($dteFechaInicial, 
																	 $dteFechaFinal,
																	 $intSucursalID,
																	 $intRefaccionID);

			//Variables que se utilizan para la existencia inicial
			$numCantidadInicial = 0;
			$numImporteInicial =  0;
			$numCostoInicial =  0;
			$strLocalizacion = '';

			//Si hay información de la existencia inicial
			if($otdExistenciaInicial)
			{	
				//Recorremos el arreglo 
				foreach ($otdExistenciaInicial as $arrEx) 
				{
					//Asignar datos a las variables
					$numCantidadInicial = $arrEx->Cantidad;
					$numImporteInicial = $arrEx->Importe;
					$strLocalizacion = $arrEx->localizacion;
					//Si existe cantidad inicial
					if ($numCantidadInicial > 0)
					{
						//Calcular costo inicial
						$numCostoInicial = ($numImporteInicial/$numCantidadInicial);
					}
					
				}

			}//Cierre de verificación de existencia inicial


			//Asignar el nombre de la hoja
			$strNombreHoja = 'movimientos '.$otdSucursal->nombre;

			//Si el contador de hojas es igual a cero (primer sucursal)
			if ($intContadorHojas == 0)
			{
				
				//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
		        $this->get_encabezado_archivo_excel($objExcel);
		        //Marcar como activa la nueva hoja
		        $objExcel->setActiveSheetIndex($intContadorHojas);
			}
			else
			{
				
				//Agregar nueva hoja
				$objNuevaHoja = $objExcel->createSheet();
				//Marcar como activa la nueva hoja
				$objExcel->setActiveSheetIndex($intContadorHojas); 
				//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
	            $this->get_encabezado_archivo_excel($objNuevaHoja, 'nueva');
	            //Definir nombre de la hoja
				$objNuevaHoja->setTitle($strNombreHoja);
			}


			//Se agrega el título del archivo
			$objExcel->getActiveSheet()->setCellValue('A7', 'MOVIMIENTOS DE REFACCIONES '.$strTituloFecha);

			$objExcel->getActiveSheet()->setCellValue('A8', 'REFACCIÓN: '.$strRefaccion);

			$objExcel->getActiveSheet()->setCellValue('A9', 'LÍNEA: '.$otdRefaccion->refacciones_linea);

			$objExcel->getActiveSheet()->setCellValue('A10', 'LOCALIZACIÓN: '.$strLocalizacion);

			$objExcel->getActiveSheet()->setCellValue('B10', 'UNIDAD: '.$otdRefaccion->unidad);

			$objExcel->getActiveSheet()->setCellValue('A11', 'SUCURSAL: '.$otdSucursal->nombre);

			//Se agregan las columnas de cabecera
	        $objExcel->getActiveSheet()->setCellValue('A'.$intPosEncabezados, 'MOVIMIENTO')
		              ->setCellValue('B'.$intPosEncabezados, 'FOLIO')
	                  ->setCellValue('C'.$intPosEncabezados, 'FECHA')
	                  ->setCellValue('D'.$intPosEncabezados, 'CANTIDAD')
	                  ->setCellValue('E'.$intPosEncabezados, 'COSTO')
	                  ->setCellValue('F'.$intPosEncabezados, 'IMPORTE')
	                  ->setCellValue('G'.$intPosEncabezados, 'EXISTENCIA');
	        //Combinar las siguientes celdas
	       	$objExcel->getActiveSheet()->mergeCells('A8:D8');
	       	$objExcel->getActiveSheet()->mergeCells('A9:D9');
	       	$objExcel->getActiveSheet()->mergeCells('B10:E10');
	       	$objExcel->getActiveSheet()->mergeCells('A11:D11');

	       	//Cambiar estilo de las siguientes celdas
	        $objExcel->getActiveSheet()
	        		 ->getStyle('A8:D8')
	        		 ->applyFromArray($arrStyleBold);

	        $objExcel->getActiveSheet()
	        		 ->getStyle('A9:D9')
	        		 ->applyFromArray($arrStyleBold);

	        $objExcel->getActiveSheet()
	        		 ->getStyle('A10:E10')
	        		 ->applyFromArray($arrStyleBold);

	        $objExcel->getActiveSheet()
	        		 ->getStyle('A11:D11')
	        		 ->applyFromArray($arrStyleBold);

	        //Preferencias de color de relleno de celda 
	        $objExcel->getActiveSheet()
	    			 ->getStyle('A9:D9')
	    			 ->applyFromArray($arrStyleFuenteColumnasPrinc);

	    	$objExcel->getActiveSheet()
	    			 ->getStyle('B10:E10')
	    			 ->applyFromArray($arrStyleFuenteColumnasPrinc);

	    	$objExcel->getActiveSheet()
	    			 ->getStyle('A11:D11')
	    			 ->applyFromArray($arrStyleFuenteColumnasPrinc);

	       
	    	//Preferencias de color de relleno de celda 
	    	$objExcel->getActiveSheet()
				     ->getStyle('A'.$intPosEncabezados.':G'.$intPosEncabezados)
				     ->getFill()
				     ->applyFromArray($arrStyleColumnas);

	        //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('A13:G13')
	    			 ->applyFromArray($arrStyleFuenteColumnas);

	    			 
	    	//Cambiar alineación de las siguientes celdas
	    	$objExcel->getActiveSheet()
	            	 ->getStyle('A9:D9')
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentLeft);	

			$objExcel->getActiveSheet()
	            	 ->getStyle('A13:G13')
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentCenter);

			//Agregar información correspondiente a la EXISTENCIA INICIAL
	        $objExcel->getActiveSheet()
					 ->setCellValue('A'.$intFila, 'EXISTENCIA INICIAL')
			 		 ->setCellValue('D'.$intFila, $numCantidadInicial)
                     ->setCellValue('E'.$intFila, $numCostoInicial)
                     ->setCellValue('F'.$intFila, $numImporteInicial)
                     ->setCellValue('G'.$intFila, $numCantidadInicial);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('A'.$intFila.':G'.$intFila)
            		 ->applyFromArray($arrStyleBold);

            //Cambiar alineación de la celda
	        $objExcel->getActiveSheet()
	            	 ->getStyle('D'.$intFila.':'.'D'.$intFila)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentRight);

            //Incrementar el indice para escribir los datos del siguiente registro
            $intFila++;

            //Variables que se utilizan para la existencia actual
			$numCantidadActual = $numCantidadInicial;
			$numImporteActual = $numImporteInicial;
			$numCostoActual = $numCostoInicial;

			//Si hay información de movimientos
			if($otdMovimientos)
			{
				//Asignar el número de movimientos
				$intNumMovimientos = count($otdMovimientos);
				//Recorremos el arreglo 
				foreach ($otdMovimientos as $arrMov) 
				{
					//Asignar tipo de movimiento
					$intTipoMovimiento = $arrMov->tipo_movimiento;
					//Asignar descripción del tipo de movimiento
					$strConcepto = $this->ARR_MOV_REFACCIONES_INTERNAS_DESCRIPCIONES[$intTipoMovimiento];
					//Array que se utiliza para agregar alineación de las celdas de la tabla dependiendo del tipo de movimiento (entrada/salida)
					$arrTipoAlineacion = array();
					//Variable que se utiliza para asignar el costo del detalle
					$intCosto = 0;

					//Calcular costo del detalle
					$intCosto = ($arrMov->cantidad * $arrMov->costo_unitario);

					//Si el estatus del movimiento es INACTIVO
					if($arrMov->estatus == 'INACTIVO')
					{
						//Concatenar referencia al concepto del movimiento
						$strConcepto .= " - CANCELADO";
					}

					//Si el tipo de movimiento corresponde a una entrada
					if ($intTipoMovimiento < SALIDA_REFACCIONES_INTERNAS)
					{
						//Si el estatus del movimiento es diferente de INACTIVO
						if($arrMov->estatus <> 'INACTIVO')
						{
							//Incrementar cantidad
							$numCantidadActual += $arrMov->cantidad;
							//Incrementar importe
							$numImporteActual += $intCosto;
						}
						
						//Cambiar alineación para mostrar cantidad a la izquierda
						 $arrTipoAlineacion = $arrStyleAlignmentLeft;
					   
					}
					else
					{
						//Si el estatus del movimiento es diferente de INACTIVO
						if($arrMov->estatus <> 'INACTIVO')
						{
							//Decrementar cantidad
							$numCantidadActual -= $arrMov->cantidad;
							//Decrementar importe
							$numImporteActual -= $intCosto;

						}
						
						//Cambiar alineación para mostrar cantidad a la derecha
						$arrTipoAlineacion = $arrStyleAlignmentRight;
						
					}

					//Agregar información del registro
			        $objExcel->getActiveSheet()
							 ->setCellValue('A'.$intFila, $strConcepto)
							 ->setCellValueExplicit('B'.$intFila, $arrMov->folio, PHPExcel_Cell_DataType::TYPE_STRING)
							 ->setCellValue('C'.$intFila, $arrMov->fecha_format)
					 		 ->setCellValue('D'.$intFila, $arrMov->cantidad)
		                     ->setCellValue('E'.$intFila, $arrMov->costo_unitario)
		                     ->setCellValue('F'.$intFila, $intCosto)
		                     ->setCellValue('G'.$intFila, $numCantidadActual);

	       			//Cambiar alineación de la celda
			        $objExcel->getActiveSheet()
			            	 ->getStyle('D'.$intFila.':'.'D'.$intFila)
			            	 ->getAlignment()
			            	 ->applyFromArray($arrTipoAlineacion);

		            //Incrementar el indice para escribir los datos del siguiente registro
                    $intFila++;
                  
				}

				//Si existe cantidad actual
				if ($numCantidadActual > 0)
				{
					//Calcular costo actual
					$numCostoActual = ($numImporteActual/$numCantidadActual);
				}

			}//Cierre de verificación de movimientos de refacciones


			//Agregar información correspondiente a la EXISTENCIA ACTUAL
	        $objExcel->getActiveSheet()
					 ->setCellValue('A'.$intFila, 'EXISTENCIA ACTUAL')
			 		 ->setCellValue('D'.$intFila, $numCantidadActual)
                     ->setCellValue('E'.$intFila, $numCostoActual)
                     ->setCellValue('F'.$intFila, $numImporteActual)
                     ->setCellValue('G'.$intFila, $numCantidadActual);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('A'.$intFila.':G'.$intFila)
            		 ->applyFromArray($arrStyleBold);
            		 
            //Cambiar alineación de la celda
	        $objExcel->getActiveSheet()
	            	 ->getStyle('D'.$intFila.':'.'D'.$intFila)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentRight);


            //Si el número de movimientos es mayor que el número máximo de registros (por cada sucursal)		 
            if($intNumMovimientos > $intNumMaxMovimientos)
            {
            	//Asignar número de movimientos
            	$intNumMaxMovimientos = $intNumMovimientos;
            }

			//Cambiar contenido de las celdas a formato númerico de 2 decimales
	        $objExcel->getActiveSheet()
	        		 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
	        		 ->getNumberFormat()
	        		 ->setFormatCode('###0.00');

	        $objExcel->getActiveSheet()
	        		 ->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)
	        		 ->getNumberFormat()
	        		 ->setFormatCode('###0.00');


	         //Cambiar contenido de las celdas a formato moneda
	        $objExcel->getActiveSheet()
	        		 ->getStyle('E'.$intFilaInicial.':'.'F'.$intFila)
	        		 ->getNumberFormat()
	        		 ->setFormatCode('$#,##0.00');


	       	//Cambiar alineación de las siguientes celdas
	        $objExcel->getActiveSheet()
	            	 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentCenter);

          	$objExcel->getActiveSheet()
	            	 ->getStyle('E'.$intFilaInicial.':'.'G'.$intFila)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentRight);

	       	//Incrementar contador por cada sucursal
			$intContadorHojas++;


		}//Cierre de for 

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'reporte_movimientos_refacciones_'.$otdRefaccion->codigo_01.'.xls', 'movimientos', $intNumMaxMovimientos);
	}
}	