<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_ventas extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('mercadotecnia/rep_ventas_model', 'rep_ventas');
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
		$this->cargar_vista('mercadotecnia/rep_ventas', $arrDatos);
	}

	

	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $intModuloID) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para asignar título de la fecha
		$strTituloFecha = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		
		//Si existe rango de fechas
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloFecha = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C').' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		}

		//Se crea una instancia de la clase PDF
		$pdf = new PDF('L','mm','legal');//orientación horizontal
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'REPORTE DE VENTAS '.$strTituloFecha;
		
		//Dependiendo del módulo seleccionado, imprimos el subtitulo del reporte
		switch ($intModuloID) {
		    case "1":
		        $pdf->strLinea2 = 'MAQUINARIA';
		        //Seleccionar los registros que coinciden con los parametros enviados
				$otdResultado = $this->rep_ventas->venta_maquinaria($dteFechaInicial, $dteFechaFinal);
		        break;
		    case "2":
		        $pdf->strLinea2 = 'REFACCIONES';
		        //Seleccionar los registros que coinciden con los parametros enviados
				$otdResultado = $this->rep_ventas->venta_refacciones($dteFechaInicial, $dteFechaFinal);
		        break;
		    case "3":
		        $pdf->strLinea2 = 'SERVICIO';
		        //Seleccionar los registros que coinciden con los parametros enviados
				$otdResultado = $this->rep_ventas->venta_servicio($dteFechaInicial, $dteFechaFinal);
		        break;
		}

		//Agregar la primer pagina
		$pdf->AddPage();
		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);

		//Dependiendo del módulo seleccionado, imprimos el la información correspondiente al reporte
		switch ($intModuloID) {
		    
		    case "1":

		    	/*****************************************************************************************************************
				* SECCIÓN CORRESPONDIENTE A MAQUINARIA
				******************************************************************************************************************/	
		    	//Crea los titulos de la cabecera
				$arrCabecera = array('FOLIO', 
									'NOMBRE', 
									utf8_decode('POBLACIÓN'), 
									'MUNICIPIO', 
									utf8_decode('TELÉFONO'),  
									'EMAIL', 
									'FECHA ENTREGA', 
									utf8_decode('LÍNEA'), 
									utf8_decode('DESCRIPCIÓN'), 
									'VENDEDOR');
				//Establece el ancho de las columnas de cabecera
				$arrAchura = array(20, 50, 30, 30, 20, 40, 25, 20, 55, 40);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'L', 'L', 'L', 'L', 'C', 'L', 'L', 'L');

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

				if($otdResultado){

					//Recorremos el arreglo para obtener la información de los movimientos
					foreach ($otdResultado as $arrCol)
					{
						
						
						$pdf->Row(array($arrCol->folio, 
										utf8_decode($arrCol->razon_social),
										utf8_decode($arrCol->localidad),
										utf8_decode($arrCol->municipio),
										$arrCol->telefono_principal,
										$arrCol->correo_electronico,
										$arrCol->fecha,
										$arrCol->linea,
										$arrCol->descripcion_corta,
										utf8_decode($arrCol->vendedor),
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

		        break;

		    case "2":

		        /*****************************************************************************************************************
				* SECCIÓN CORRESPONDIENTE A REFACCIONES
				******************************************************************************************************************/	
		    	//Crea los titulos de la cabecera
				$arrCabecera = array('FOLIO', 
									'NOMBRE', 
									utf8_decode('POBLACIÓN'), 
									'MUNICIPIO', 
									utf8_decode('TELÉFONO'),  
									'EMAIL', 
									'FECHA',
									'CANTIDAD', 
									utf8_decode('PRODUCTO'),
									'VENDEDOR');
				//Establece el ancho de las columnas de cabecera
				$arrAchura = array(20, 50, 30, 30, 20, 40, 25, 15, 50, 50);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'L', 'L', 'L', 'L', 'C', 'L', 'L', 'C');

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

				if($otdResultado){

					//Recorremos el arreglo para obtener la información de los movimientos
					foreach ($otdResultado as $arrCol)
					{
						
						$pdf->Row(array($arrCol->folio, 
										utf8_decode($arrCol->razon_social),
										utf8_decode($arrCol->localidad),
										utf8_decode($arrCol->municipio),
										$arrCol->telefono_principal,
										$arrCol->correo_electronico,
										$arrCol->fecha,
										$arrCol->cantidad,
										$arrCol->producto,
										utf8_decode($arrCol->vendedor),
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

		        break;

		    case "3":

		        /*****************************************************************************************************************
				* SECCIÓN CORRESPONDIENTE A SERVICIO
				******************************************************************************************************************/	
		    	//Crea los titulos de la cabecera
				$arrCabecera = array('FOLIO', 
									'NOMBRE', 
									utf8_decode('POBLACIÓN'), 
									'MUNICIPIO', 
									utf8_decode('TELÉFONO'),  
									'EMAIL', 
									'FECHA', 
									utf8_decode('LÍNEA'), 
									utf8_decode('EQUIPO'),
									utf8_decode('SERVICIO'),  
									utf8_decode('TÉCNICO'));
				//Establece el ancho de las columnas de cabecera
				$arrAchura = array(20, 50, 30, 30, 20, 40, 25, 20, 25, 30, 40);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'L', 'L', 'L', 'L', 'C', 'L', 'L', 'L', 'L');

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

				if($otdResultado){

					//Recorremos el arreglo para obtener la información de los movimientos
					foreach ($otdResultado as $arrCol)
					{
						
						
						$pdf->Row(array($arrCol->folio, 
										utf8_decode($arrCol->razon_social),
										utf8_decode($arrCol->localidad),
										utf8_decode($arrCol->municipio),
										$arrCol->telefono_principal,
										$arrCol->correo_electronico,
										$arrCol->fecha,
										utf8_decode($arrCol->linea),
										utf8_decode($arrCol->equipo),
										$arrCol->servicio_horas,
										utf8_decode($arrCol->mecanico),
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
		        break;

		}

		//Ejecutar la salida del reporte
		$pdf->Output('reporte_ventas.pdf','I');	 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $intModuloID) 
	{
		
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFilaInicial = 10;
        $intFila = 10;
		//Variable que se utiliza para asignar título de la fecha
		$strTituloFecha = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		
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

        //Dependiendo del módulo seleccionado, imprimos el subtitulo del reporte
		switch ($intModuloID) {
		    case "1":
		    	//Se agrega el título del archivo
				$objExcel->setActiveSheetIndex(0)->setCellValue('A7', 'VENTAS DE MAQUINARIA '.$strTituloFecha );
		        //Seleccionar los registros que coinciden con los parametros enviados
				$otdResultado = $this->rep_ventas->venta_maquinaria($dteFechaInicial, $dteFechaFinal);
		        break;
		    case "2":
		        //Se agrega el título del archivo
				$objExcel->setActiveSheetIndex(0)->setCellValue('A7', 'VENTAS DE REFACCIONES '.$strTituloFecha );
		        //Seleccionar los registros que coinciden con los parametros enviados
				$otdResultado = $this->rep_ventas->venta_refacciones($dteFechaInicial, $dteFechaFinal);
		        break;
		    case "3":
		        
		        //Se agrega el título del archivo
				$objExcel->setActiveSheetIndex(0)->setCellValue('A7', 'VENTAS DE SERVICIO '.$strTituloFecha );
		        //Seleccionar los registros que coinciden con los parametros enviados
				$otdResultado = $this->rep_ventas->venta_servicio($dteFechaInicial, $dteFechaFinal);

		        break;
		}
		     	     
		

        //Dependiendo del módulo seleccionado, imprimos el la información correspondiente al reporte
		switch ($intModuloID) {
		    
		    case "1":

		    	/*****************************************************************************************************************
				* SECCIÓN CORRESPONDIENTE A MAQUINARIA
				******************************************************************************************************************/	
				//Se agregan las columnas de cabecera
		        $objExcel->setActiveSheetIndex(0)
		        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
		        		 ->setCellValue('B'.$intPosEncabezados, 'NOMBRE')
		                 ->setCellValue('C'.$intPosEncabezados, 'POBLACIÓN')
		                 ->setCellValue('D'.$intPosEncabezados, 'MUNICIPIO')
		                 ->setCellValue('E'.$intPosEncabezados, 'TELÉFONO')
		                 ->setCellValue('F'.$intPosEncabezados, 'EMAIL')
		                 ->setCellValue('G'.$intPosEncabezados, 'FECHA ENTREGA')
		                 ->setCellValue('H'.$intPosEncabezados, 'LÍNEA')
		                 ->setCellValue('I'.$intPosEncabezados, 'DESCRIPCIÓN')
		                 ->setCellValue('J'.$intPosEncabezados, 'VENDEDOR');

		        //Definir estilo de las celdas correspondientes a los encabezados
		        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));
		        //Definir estilo para centrar el contenido de la celda
		        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        //Definir estilo para alinear a la derecha el contenido de la celda
		        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		        //Definir estilo de las celdas que apareceran en negrita
		        $arrStyleBold = array('font'=> array('bold'=> TRUE));
		        //Preferencias de color de relleno de celda 
		        $objExcel->getActiveSheet()->getStyle('A9:J9')->getFill()->applyFromArray($arrStyleColumnas);

		    	//Si hay información
				if($otdResultado){

					//Recorremos el arreglo para obtener la información de los movimientos
					foreach ($otdResultado as $arrCol)
					{
						
						//Crear el renglon correspondiente a la EXISTENCIA INICIAL
						$objExcel->setActiveSheetIndex(0)
		                         ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValueExplicit('B'.$intFila, $arrCol->razon_social)
		                         ->setCellValue('C'.$intFila, $arrCol->localidad)
		                         ->setCellValue('D'.$intFila, $arrCol->municipio)
		                         ->setCellValue('E'.$intFila, $arrCol->telefono_principal)
		                         ->setCellValue('F'.$intFila, $arrCol->correo_electronico)
		                         ->setCellValue('G'.$intFila, $arrCol->fecha)
		                         ->setCellValue('H'.$intFila, $arrCol->linea)
		                         ->setCellValue('I'.$intFila, $arrCol->descripcion_corta)
		                         ->setCellValue('J'.$intFila, $arrCol->vendedor);
						
						//Incrementar el contador por cada registro
						$intContador++;
		                //Incrementar el indice para escribir los datos del siguiente registro
		                $intFila++; 

					}	

		            //Cambiar alineación de las siguientes celdas
					$objExcel->getActiveSheet()->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)->getAlignment()->applyFromArray($arrStyleAlignmentCenter);           

				}

		        break;

		    case "2":

		        /*****************************************************************************************************************
				* SECCIÓN CORRESPONDIENTE A REFACCIONES
				******************************************************************************************************************/	
				//Se agregan las columnas de cabecera
		        $objExcel->setActiveSheetIndex(0)
		        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
		        		 ->setCellValue('B'.$intPosEncabezados, 'NOMBRE')
		                 ->setCellValue('C'.$intPosEncabezados, 'POBLACIÓN')
		                 ->setCellValue('D'.$intPosEncabezados, 'MUNICIPIO')
		                 ->setCellValue('E'.$intPosEncabezados, 'TELÉFONO')
		                 ->setCellValue('F'.$intPosEncabezados, 'EMAIL')
		                 ->setCellValue('G'.$intPosEncabezados, 'FECHA')
		                 ->setCellValue('H'.$intPosEncabezados, 'CANTIDAD')
		                 ->setCellValue('I'.$intPosEncabezados, 'PRODUCTO')
		                 ->setCellValue('J'.$intPosEncabezados, 'VENDEDOR');

		        //Definir estilo de las celdas correspondientes a los encabezados
		        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));
		        //Definir estilo para centrar el contenido de la celda
		        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        //Definir estilo para alinear a la derecha el contenido de la celda
		        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		        //Definir estilo de las celdas que apareceran en negrita
		        $arrStyleBold = array('font'=> array('bold'=> TRUE));
		        //Preferencias de color de relleno de celda 
		        $objExcel->getActiveSheet()->getStyle('A9:J9')->getFill()->applyFromArray($arrStyleColumnas);
				
		    	//Si hay información
				if($otdResultado){

					//Recorremos el arreglo para obtener la información de los movimientos
					foreach ($otdResultado as $arrCol)
					{

						//Crear el renglon correspondiente a la EXISTENCIA INICIAL
						$objExcel->setActiveSheetIndex(0)
		                         ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValueExplicit('B'.$intFila, $arrCol->razon_social)
		                         ->setCellValue('C'.$intFila, $arrCol->localidad)
		                         ->setCellValue('D'.$intFila, $arrCol->municipio)
		                         ->setCellValue('E'.$intFila, $arrCol->telefono_principal)
		                         ->setCellValue('F'.$intFila, $arrCol->correo_electronico)
		                         ->setCellValue('G'.$intFila, $arrCol->fecha)
		                         ->setCellValue('H'.$intFila, $arrCol->cantidad)
		                         ->setCellValue('I'.$intFila, $arrCol->producto)
		                         ->setCellValue('J'.$intFila, $arrCol->vendedor);
	     
						//Incrementar el contador por cada registro
						$intContador++;
		                //Incrementar el indice para escribir los datos del siguiente registro
		                $intFila++;

	            	}

	            	//Cambiar alineación de las siguientes celdas
					$objExcel->getActiveSheet()->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)->getAlignment()->applyFromArray($arrStyleAlignmentCenter);

				}

				
		        break;

		    case "3":

		        /*****************************************************************************************************************
				* SECCIÓN CORRESPONDIENTE A SERVICIO
				******************************************************************************************************************/	
				//Se agregan las columnas de cabecera
		        $objExcel->setActiveSheetIndex(0)
		        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
		        		 ->setCellValue('B'.$intPosEncabezados, 'NOMBRE')
		                 ->setCellValue('C'.$intPosEncabezados, 'POBLACIÓN')
		                 ->setCellValue('D'.$intPosEncabezados, 'MUNICIPIO')
		                 ->setCellValue('E'.$intPosEncabezados, 'TELÉFONO')
		                 ->setCellValue('F'.$intPosEncabezados, 'EMAIL')
		                 ->setCellValue('G'.$intPosEncabezados, 'FECHA')
		                 ->setCellValue('H'.$intPosEncabezados, 'LÍNEA')
		                 ->setCellValue('I'.$intPosEncabezados, 'EQUIPO')
		                 ->setCellValue('J'.$intPosEncabezados, 'SERVICIO')
		                 ->setCellValue('K'.$intPosEncabezados, 'MÉCANICO');

		        //Definir estilo de las celdas correspondientes a los encabezados
		        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));
		        //Definir estilo para centrar el contenido de la celda
		        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		        //Definir estilo para alinear a la derecha el contenido de la celda
		        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		        //Definir estilo de las celdas que apareceran en negrita
		        $arrStyleBold = array('font'=> array('bold'=> TRUE));
		        //Preferencias de color de relleno de celda 
		        $objExcel->getActiveSheet()->getStyle('A9:K9')->getFill()->applyFromArray($arrStyleColumnas);
				
		    	//Si hay información
				if($otdResultado){

					//Recorremos el arreglo para obtener la información de los movimientos
					foreach ($otdResultado as $arrCol)
					{

						//Crear el renglon correspondiente a la EXISTENCIA INICIAL
						$objExcel->setActiveSheetIndex(0)
		                         ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValueExplicit('B'.$intFila, $arrCol->razon_social)
		                         ->setCellValue('C'.$intFila, $arrCol->localidad)
		                         ->setCellValue('D'.$intFila, $arrCol->municipio)
		                         ->setCellValue('E'.$intFila, $arrCol->telefono_principal)
		                         ->setCellValue('F'.$intFila, $arrCol->correo_electronico)
		                         ->setCellValue('G'.$intFila, $arrCol->fecha)
		                         ->setCellValue('H'.$intFila, $arrCol->linea)
		                         ->setCellValue('I'.$intFila, $arrCol->equipo)
		                         ->setCellValue('J'.$intFila, $arrCol->servicio_horas)
		                         ->setCellValue('K'.$intFila, $arrCol->mecanico);
	     
						//Incrementar el contador por cada registro
						$intContador++;
		                //Incrementar el indice para escribir los datos del siguiente registro
		                $intFila++;

					}

					//Cambiar alineación de las siguientes celdas
					$objExcel->getActiveSheet()->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)->getAlignment()->applyFromArray($arrStyleAlignmentCenter);

				}

		        break;

		}

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'reporte_ventas.xls', 'ventas', $intFila);

	}


}	