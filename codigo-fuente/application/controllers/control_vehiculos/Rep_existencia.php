<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_existencia extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('control_vehiculos/rep_existencia_model', 'existencia');
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
		$this->cargar_vista('control_vehiculos/rep_existencia', $arrDatos);
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
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intRefaccionID) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para asignar título de la fecha
		$strTituloFecha = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;

		//Seleccionar los datos del registro que coincide con la fecha
		$result = $this->existencia->consultar($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intRefaccionID);
		$otdResultado = $result->result();

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFecha = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C').' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  'EXISTENCIA DE REFACCIONES INTERNAS '.$strTituloFecha;
		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('SUCURSAL'), utf8_decode('DESCRIPCIÓN'), 'FECHA', 'KARDEX', 
								  'COSTO',  'IMPORTE');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(50, 60, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'R', 'R', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);

		//Si hay información
		if ($otdResultado)
		{
			$intRefaccionID = 0;
			$numExistencia = 0;
			$numCosto = 0;
			$strSucursal = '';
			$strDescripcion = '';
			$strFecha = '';

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdResultado as $arrCol)
			{

				//Si la refacción cambió
   				if($intRefaccionID != $arrCol->refaccion_interna_id && $intRefaccionID != 0)
   				{	
   					//Impresión de variables
					$pdf->Row(array(utf8_decode($strSucursal),
									utf8_decode($strDescripcion), 
									$strFecha,  
									$numExistencia, 
									'$'.number_format($numCosto, 2),
									'$'.number_format($numExistencia * $numCosto, 2)), 
							  $pdf->arrAlineacion, 'ClippedCell');

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

				$intRefaccionID = $arrCol->refaccion_interna_id;
				$strSucursal = $arrCol->sucursal;
				$strDescripcion = $arrCol->descripcion;
				$strFecha = $arrCol->fecha;	
				
				
			}

			//Agregar datos del último refacción
   			if($intRefaccionID != 0)
			{
				$pdf->Row(array(utf8_decode($strSucursal),
								utf8_decode($strDescripcion), 
								$strFecha,  
								$numExistencia, 
								'$'.number_format($numCosto, 2),
								'$'.number_format($numExistencia * $numCosto, 2)), 
						   $pdf->arrAlineacion);
			}

		}

		//Ejecutar la salida del reporte
		$pdf->Output('reporte_existencia.pdf','I');	            
		
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intRefaccionID) 
	{	
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;
        
        //Seleccionar los datos del registro que coincide con la fecha
		$result = $this->existencia->consultar($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intRefaccionID);
		$otdResultado = $result->result();
		
		//Si existe rango de fechas
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal  != '0000-00-00')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C'). ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		}

     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)->setCellValue('A7', 'EXISTENCIA DE REFACCIONES INTERNAS '.$strTituloRangoFechas);

		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'SUCURSAL')
        		 ->setCellValue('B'.$intPosEncabezados, 'DESCRIPCIÓN')
        		 ->setCellValue('C'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('D'.$intPosEncabezados, 'KARDEX')
        		 ->setCellValue('E'.$intPosEncabezados, 'COSTO')
        		 ->setCellValue('F'.$intPosEncabezados, 'IMPORTE');

        //Definir estilos de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE, 'color' => array('rgb' => 'ffffff')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Combinar las siguientes celdas
       	$objExcel->setActiveSheetIndex(0)->mergeCells('A8:D8');
       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()->getStyle('A8:D8')->applyFromArray($arrStyleBold);

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()->getStyle('A10:F10')->getFill()->applyFromArray($arrStyleColumnas);
        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()->getStyle('A10:F10')->applyFromArray($arrStyleFuenteColumnas);	 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()->getStyle('A10:F10')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);

		//Si hay información
		if ($otdResultado)
		{
			
			//Array que se utiliza para agregar los datos de los registros 
		    $arrRegistros = array();

			$intRefaccionID = 0;
			$numExistencia = 0;
			$numCosto = 0;
			$strSucursal = '';
			$strDescripcion = '';
			$strFecha = '';

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdResultado as $arrCol)
			{

				//Si la refacción cambió
   				if($intRefaccionID != $arrCol->refaccion_interna_id && $intRefaccionID != 0)
   				{	
   					
   					//Impresión de variables
					$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValue('A'. $intFila, $strSucursal)
	                         ->setCellValue('B'.$intFila, $strDescripcion)
	                         ->setCellValue('C'.$intFila, $strFecha)
	                         ->setCellValue('D'.$intFila, $numExistencia)
	                         ->setCellValue('E'.$intFila, $numCosto)
	                         ->setCellValue('F'.$intFila, $numExistencia * $numCosto);

					//Reinicializar variables
					$numExistencia = $arrCol->inicial_existencia;
					$numCosto = $arrCol->inicial_costo;

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

				$intRefaccionID = $arrCol->refaccion_interna_id;
				$strSucursal = $arrCol->sucursal;
				$strDescripcion = $arrCol->descripcion;
				$strFecha = $arrCol->fecha;	
				
				//Incrementar el indice para escribir los datos del siguiente registro
	             
				
			}

			//Agregar datos del último refacción
   			if($intRefaccionID != 0)
			{
				$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValue('A'. $intFila, $strSucursal)
	                         ->setCellValue('B'.$intFila, $strDescripcion)
	                         ->setCellValue('C'.$intFila, $strFecha)
	                         ->setCellValue('D'.$intFila, $numExistencia)
	                         ->setCellValue('E'.$intFila, $numCosto)
	                         ->setCellValue('F'.$intFila, $numExistencia * $numCosto);            
			}

		}
       
		//Dar formato a las columnas de la tabla respecto a alineación y formato
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
	        	 ->getStyle('D'.$intFilaInicial.':'.'F'.$intFila)
	        	 ->getAlignment()
	        	 ->applyFromArray($arrStyleAlignmentRight);
        		 
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'existencia.xls', 'existencia', $intFila);
        
	}


}	