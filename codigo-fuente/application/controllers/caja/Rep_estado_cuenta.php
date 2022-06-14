<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_estado_cuenta extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo de pagos de caja
		$this->load->model('caja/cajas_pagos_model', 'pagos');
		//Cargamos el modelo de empleados
		$this->load->model('recursos_humanos/empleados_model', 'empleados');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('caja/rep_estado_cuenta', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el estado de cuenta 
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $intEmpleadoID) 
	{	        
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para asignar el saldo inicial
		$intSaldoInicial = 0;
		//Variable que se utiliza para asignar el saldo actual del empleado
		$intSaldoActual = 0;
		//Variable que se utiliza para asignar el acumulado de los cargos (vales de caja)
		$intAcumCargos = 0;
		//Variable que se utiliza para asignar el acumulado de los abonos (pagos y comprobación)
		$intAcumAbonos = 0;
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C'). ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
	    //Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'ESTADO DE CUENTA '.$strTituloRangoFechas;
		//Seleccionar los datos del empleado que coincide con el id
		$otdEmpleado =  $this->empleados->buscar($intEmpleadoID);
		//Variable que se utiliza para concatenar los datos del empleado
		$strNombreEmpleado = $otdEmpleado->codigo.' - '.$otdEmpleado->apellido_paterno;
		$strNombreEmpleado .= ' '.$otdEmpleado->apellido_materno.' '.$otdEmpleado->nombre;
		$pdf->strLinea2 =  'EMPLEADO: '.utf8_decode($strNombreEmpleado);
		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('DESCRIPCIÓN'), 'FOLIO', 'AFECTA', 'FECHA',  'CARGO', 
							'ABONO', 'SALDO');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(70, 20, 20, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'C', 'R', 'R', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);

		//Establecer el color de fondo para la línea
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Seleccionar el saldo inicial del empleado
		$otdSaldoInicial = $this->pagos->buscar_saldo_inicial_estado_cuenta($dteFechaInicial, $intEmpleadoID);
		//Si hay información
		if($otdSaldoInicial)
		{
			//Recorremos el arreglo 
			foreach ($otdSaldoInicial as $arrSal)
			{
				//Asignar el saldo inicial
				$intSaldoInicial = $arrSal->saldo_inicial;
				$intSaldoActual =  $arrSal->saldo_inicial;

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
			   	$pdf->Row(array('SALDO INICIAL', '', '', '', '$'.number_format($intSaldoInicial,2), '', 
			   					'$'.number_format($intSaldoActual,2)), 
			    		  $pdf->arrAlineacion, 'ClippedCell');

			   	//Incrementar acumulado
				$intAcumCargos += $intSaldoActual;
			   	

			}

		}//Cierre de verificación del saldo inicial

		//Seleccionar los movimientos (ordenes de compra, descuentos, pagos y anticipos) del proveedor
		$otdMovimientos = $this->pagos->buscar_movimientos_estado_cuenta($dteFechaInicial, $dteFechaFinal, 
															             $intEmpleadoID);
		//Si hay información
		if($otdMovimientos)
		{
			//Recorremos el arreglo 
			foreach ($otdMovimientos as $arrMov)
			{
				//Variable que se utiliza para asignar el importe total de un vale de caja
				$intTotalCargo = '';
				//Variable que se utiliza para asignar el importe total de un pago o comprobación
				$intTotalAbono = '';

				//Si el tipo de movimiento corresponde a un cargo (vale de caja)
				if($arrMov->tipo == 'cargo')
				{
					//Asignar importe total del vale de caja
					$intTotalCargo = '$'. number_format($arrMov->total, 2);
					//Incrementar el saldo actual
					$intSaldoActual += $arrMov->total;
					//Incrementar acumulado
					$intAcumCargos += $arrMov->total;
				}
				else
				{
					//Asignar el importe total del pago o comprobación
					$intTotalAbono = '$'. number_format($arrMov->total, 2);
					//Decrementar el saldo actual
					$intSaldoActual -= $arrMov->total;
					//Incrementar acumulado
					$intAcumAbonos += $arrMov->total;
				}

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrMov->descripcion), $arrMov->folio, $arrMov->folio_referencia, 
					   			$arrMov->fecha_format, $intTotalCargo, $intTotalAbono,
					   			'$'.number_format($intSaldoActual,2)), $pdf->arrAlineacion, 'ClippedCell');

			}

		}//Cierre de verificación de movimientos

		$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
		//Escribir totales
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		$pdf->ClippedCell(130, 6, 'TOTALES:', 0, 0, 'R', 0);
		//Acumulado del importe total de cargos (ordenes de compra)
		$pdf->ClippedCell(20, 6, '$'.number_format($intAcumCargos,2), 0, 0, 'R', 0);
		//Acumulado del importe total de abonos (pagos, descuentos y anticipos)
		$pdf->ClippedCell(20, 6, '$'.number_format($intAcumAbonos,2), 0, 0, 'R', 0);
		//Saldo actual del proveedor
		$pdf->ClippedCell(20, 6, '$'.number_format($intSaldoActual,2), 0, 0, 'R', 0);


		//Ejecutar la salida del reporte
        $pdf->Output('estado_cuenta_'.$otdEmpleado->codigo.'.pdf','I'); 
	}

    /*Método para generar un archivo XLS con el estado de cuenta 
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $intEmpleadoID) 
	{	
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;
	  	 //Variable que se utiliza para asignar el saldo inicial
		$intSaldoInicial = 0;
		//Variable que se utiliza para asignar el saldo actual del empleado
		$intSaldoActual = 0;
		//Variable que se utiliza para asignar el acumulado de los cargos (vales de caja)
		$intAcumCargos = 0;
		//Variable que se utiliza para asignar el acumulado de los abonos (pagos y comprobación)
		$intAcumAbonos = 0;
		//Seleccionar los datos del empleado que coincide con el id
		$otdEmpleado =  $this->empleados->buscar($intEmpleadoID);
		//Variable que se utiliza para concatenar los datos del empleado
		$strNombreEmpleado = $otdEmpleado->codigo.' - '.$otdEmpleado->apellido_paterno;
		$strNombreEmpleado .= ' '.$otdEmpleado->apellido_materno.' '.$otdEmpleado->nombre;

          //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C'). ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);

        //Se agrega el título del archivo
		$objExcel->getActiveSheet()->setCellValue('A7', 'ESTADO DE CUENTA '.$strTituloRangoFechas);

		$objExcel->setActiveSheetIndex(0)
		         ->setCellValue('A8', 'EMPLEADO: '.$strNombreEmpleado);
		//Se agregan las columnas de cabecera
        $objExcel->getActiveSheet()->setCellValue('A'.$intPosEncabezados, 'DESCRIPCIÓN')
                 ->setCellValue('B'.$intPosEncabezados, 'FOLIO')
                 ->setCellValue('C'.$intPosEncabezados, 'AFECTA')
                 ->setCellValue('D'.$intPosEncabezados, 'FECHA')
                 ->setCellValue('E'.$intPosEncabezados, 'CARGO')
                 ->setCellValue('F'.$intPosEncabezados, 'ABONO')
                 ->setCellValue('G'.$intPosEncabezados, 'SALDO');
         //Definir estilos de las celdas correspondientes a los encabezados
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
    			 ->getStyle('A10:G10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:G10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:G10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

       	//Seleccionar el saldo inicial del empleado
		$otdSaldoInicial = $this->pagos->buscar_saldo_inicial_estado_cuenta($dteFechaInicial, $intEmpleadoID);
		//Si hay información
		if($otdSaldoInicial)
		{
			//Recorremos el arreglo 
			foreach ($otdSaldoInicial as $arrSal)
			{
				//Asignar el saldo inicial
				$intSaldoInicial = $arrSal->saldo_inicial;
				$intSaldoActual =  $arrSal->saldo_inicial;

				//Agregar información del saldo inicial
				$objExcel->getActiveSheet()
				 		 ->setCellValue('A'.$intFila, 'SALDO INICIAL')
                         ->setCellValue('E'.$intFila, $intSaldoInicial)
                         ->setCellValue('G'.$intFila, $intSaldoActual);

			   	//Incrementar acumulado
				$intAcumCargos += $intSaldoActual;
			    
			    //Incrementar el indice para escribir los datos del siguiente registro
           		$intFila++;

			}

		}//Cierre de verificación del saldo inicial

		//Seleccionar los movimientos (ordenes de compra, descuentos, pagos y anticipos) del proveedor
		$otdMovimientos = $this->pagos->buscar_movimientos_estado_cuenta($dteFechaInicial, $dteFechaFinal, $intEmpleadoID);
		//Si hay información
		if($otdMovimientos)
		{
			//Recorremos el arreglo 
			foreach ($otdMovimientos as $arrMov)
			{
				//Variable que se utiliza para asignar el importe total de una orden de compra
				$intTotalCargo = '';
				//Variable que se utiliza para asignar el importe total de un pago, descuento o anticipo
				$intTotalAbono = '';

				//Si el tipo de movimiento corresponde a un cargo (orden de compra)
				if($arrMov->tipo == 'cargo')
				{
					//Asignar importe total de la orden de compra
					$intTotalCargo = $arrMov->total;
					//Incrementar el saldo actual
					$intSaldoActual += $arrMov->total;
					//Incrementar acumulado
					$intAcumCargos += $arrMov->total;
				}
				else
				{
					//Asignar el importe total del pago, descuento o anticipo
					$intTotalAbono = $arrMov->total;
					//Decrementar el saldo actual
					$intSaldoActual -= $arrMov->total;
					//Incrementar acumulado
					$intAcumAbonos += $arrMov->total;
				}

				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del movimiento
				$objExcel->getActiveSheet()
				 		 ->setCellValue('A'.$intFila, $arrMov->descripcion)
				 		 ->setCellValueExplicit('B'.$intFila, $arrMov->folio, PHPExcel_Cell_DataType::TYPE_STRING)
				 		 ->setCellValueExplicit('C'.$intFila, $arrMov->folio_referencia, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('D'.$intFila, $arrMov->fecha_format)
                         ->setCellValue('E'.$intFila, $intTotalCargo)
                         ->setCellValue('F'.$intFila, $intTotalAbono)
                         ->setCellValue('G'.$intFila, $intSaldoActual);

                //Incrementar el indice para escribir los datos del siguiente registro
           		$intFila++;
           	}			
		
		}//Cierre de verificación de movimientos

		//Asignar indice de fila donde se empezaran a escribir los totales
        $intFilaTotales = $intFila;

        //Escribir totales
    	//Agregar información de los totales
		$objExcel->getActiveSheet()
                 ->setCellValue('D'.$intFila, 'TOTALES:')
                 ->setCellValue('E'.$intFila, $intAcumCargos)
                 ->setCellValue('F'.$intFila, $intAcumAbonos)
                 ->setCellValue('G'.$intFila, $intSaldoActual);

		//Cambiar contenido de las celdas a formato moneda
   		$objExcel->getActiveSheet()
        		 ->getStyle('E'.$intFilaInicial.':'.'G'.$intFila)
        		 ->getNumberFormat()
        		 ->setFormatCode('$#,##0.00');

       	//Cambiar alineación de las siguientes celdas
        $objExcel->getActiveSheet()
	        	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
	        	 ->getAlignment()
	        	 ->applyFromArray($arrStyleAlignmentCenter);

	    $objExcel->getActiveSheet()
	        	 ->getStyle('D'.$intFilaTotales.':'.'D'.$intFilaTotales)
	        	 ->getAlignment()
	        	 ->applyFromArray($arrStyleAlignmentRight);
	        	 
		$objExcel->getActiveSheet()
	        	 ->getStyle('E'.$intFilaInicial.':'.'G'.$intFila)
	        	 ->getAlignment()
	        	 ->applyFromArray($arrStyleAlignmentRight);

	    //Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('D'.$intFila.':'.'G'.$intFila)
        		 ->applyFromArray($arrStyleBold);

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'estado_cuenta_'.$otdEmpleado->codigo.'.xls', 'estado de cuenta', $intFila);
	}
}