<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_cajas_vales_adeudos extends MY_Controller {
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
		$this->cargar_vista('caja/rep_cajas_vales_adeudos', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con los vales de caja que tienen adeudos
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte($dteFechaCorte, $intEmpleadoID) 
	{	
		//Si existe id del empleado
		if($intEmpleadoID > 0)
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado de vales de caja con adeudos de un empleado
			$this->get_reporte_empleado($dteFechaCorte, $intEmpleadoID);
		}
		else
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado general de vales de caja con adeudos
			$this->get_reporte_general($dteFechaCorte);
		}
	}

	//Método para generar un reporte PDF con el listado de vales de caja con adeudos de un empleado
    public function get_reporte_empleado($dteFechaCorte, $intEmpleadoID)
    {
    	//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
	    //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el total del saldo
	    $intTotalSaldo = 0;
	    //Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'VALES CON ADEUDOS FECHA DE CORTE: '.$this->get_fecha_formato_letra($dteFechaCorte, 'C');
		//Seleccionar los datos del empleado que coincide con el id
		$otdEmpleado =  $this->empleados->buscar($intEmpleadoID);
		//Variable que se utiliza para concatenar los datos del empleado
		$strNombreEmpleado = $otdEmpleado->codigo.' - '.$otdEmpleado->apellido_paterno;
		$strNombreEmpleado .= ' '.$otdEmpleado->apellido_materno.' '.$otdEmpleado->nombre;
		$pdf->strLinea2 =  'EMPLEADO: '.utf8_decode($strNombreEmpleado);
		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA',  'CONCEPTO', 'IMPORTE',  'SALDO',  
							       utf8_decode('DÍAS TRANSC.'));
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(18, 18, 74, 30, 30, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'L', 'R', 'R', 'C');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);

		//Seleccionar los saldos de los vales de caja del empleado
		$otdResultado = $this->pagos->buscar_saldos_vales_caja_adeudos($dteFechaCorte, $intEmpleadoID);
		//Si hay información
		if($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Si el vale de caja no se encuentra pagado
				if (($arrCol->saldo >= 1) OR ($arrCol->saldo <= -1))
				{
					//Variable que se utiliza para asignar el número de días transcurridos
					$intDiasTranscurridos = 0;

                    //Calcular los días transcurridos
                    $intDiasTranscurridos = ceil((strtotime($dteFechaCorte) - strtotime($arrCol->fecha)) / 86400);

					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
	   				$pdf->Row(array($arrCol->folio, $arrCol->fecha_format, $arrCol->concepto, 
	   								'$'.number_format($arrCol->importe,2), 
	   								'$'.number_format($arrCol->saldo,2), $intDiasTranscurridos), 
	   								 $pdf->arrAlineacion, 'ClippedCell');


	      			//Incrementar acumulado del saldo
                    $intAcumSaldo += $arrCol->saldo;

				}//Cierre de verificación del saldo
			}

			$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
			//Escribir total
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->ClippedCell(140, 6, 'TOTAL:', 0, 0, 'R', 0);
			//Acumulado del saldo
			$pdf->ClippedCell(30, 6, '$'.number_format($intAcumSaldo,2), 0, 0, 'R', 0);
						
		}

		//Ejecutar la salida del reporte
        $pdf->Output('vales_caja_adeudos_'.$otdEmpleado->codigo.'.pdf','I'); 
    }

	//Método para generar un reporte PDF con el listado general de vales de caja con adeudos
	public function get_reporte_general($dteFechaCorte) 
	{	
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
	    //Variable que se utiliza pra asignar el id actual del empleado
	    $intEmpleadoIDActual = 0;
	    //Variable que se utiliza pra asignar la fecha del vale de caja
	    $strFecha = '';
	   //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'VALES CON ADEUDOS FECHA DE CORTE: '.$this->get_fecha_formato_letra($dteFechaCorte, 'C');
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('EMPLEADO', 'SALDO', 'FECHA', utf8_decode('DÍAS TRANSC.'));
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(120, 30, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'R', 'C', 'C');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Seleccionar los saldos de los vales de caja
		$otdResultado = $this->pagos->buscar_saldos_vales_caja_adeudos($dteFechaCorte);
		//Si hay información
		if($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Si el vale de caja no se encuentra pagado
				if (($arrCol->saldo >= 1) OR ($arrCol->saldo <= -1))
				{
					//Si el empleado actual es diferente al anterior
					if ($intEmpleadoIDActual != $arrCol->empleado_id)
					{
						//Si existe id del empleado actual
						if ($intEmpleadoIDActual > 0)
						{
							//Si existe fecha
                            if ($dteFecha != "")
                            {
                            	//Separar fecha
                                $strFecha = substr($dteFecha, 8, 2)."/";
                                $strFecha.= substr($dteFecha, 5, 2)."/";
                                $strFecha.= substr($dteFecha, 0, 4);
                            }

							 //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
			   				$pdf->Row(array($strEmpleado, '$'.number_format($intSaldo,2), $strFecha, 
			   								$intDiasTranscurridos), $pdf->arrAlineacion, 'ClippedCell');
						}

						//Asignar valores del empleado
						$intEmpleadoIDActual = $arrCol->empleado_id;
						$strEmpleado = $arrCol->empleado;
						$intSaldo = $arrCol->saldo;
						//Incrementar acumulado del saldo
					    $intAcumSaldo += $arrCol->saldo;
					    //Limpiar las siguientes variables (por cada empleado recorrido)
					    $dteFecha = "";

					    //Si la fecha  es menor que la fecha de corte
                        if ($arrCol->fecha < $dteFechaCorte)
                        {
                        	//Asignar fecha del vale de caja
                            $dteFecha = $arrCol->fecha;
                            //Calcular los días transcurridos
                            $intDiasTranscurridos = ceil((strtotime($dteFechaCorte) - strtotime($dteFecha)) / 86400);
                        }

                        //Asignar fecha del vale de caja
                        $strFechaUlt = $arrCol->fecha;
					}
					else
					{
						//Incrementar acumulados
						$intSaldo += $arrCol->saldo;
                        $intAcumSaldo +=  $arrCol->saldo;

                        //Si la fecha es menor que la fecha de corte
                        if ($arrCol->fecha < $dteFechaCorte)
                        {
                        	//Si la fecha  es menor que la fecha de corte
                            if (($arrCol->fecha < $dteFecha) OR ($dteFecha == ""))
                            {
                            	//Asignar fecha del vale de caja
                                $dteFecha = $arrCol->fecha;
                                //Calcular los días transcurridos
                                $intDiasTranscurridos = ceil((strtotime($dteFechaCorte) - strtotime($dteFecha)) / 86400);
                            }
                        }

                        //Si la fecha es mayor que la última fecha
                        if ($arrCol->fecha > $strFechaUlt)
                        {
                        	//Asignar fecha del vale de caja
                            $strFechaUlt = $arrCol->fecha;
                        }
					}

				}//Cierre de verificación del saldo
			}

			//Escribir los acumulados del último empleado
			if ($intEmpleadoIDActual > 0)
			{
				//Si existe fecha
                if ($dteFecha != "")
                {
                	//Separar fecha
                    $strFecha = substr($dteFecha, 8, 2)."/";
                    $strFecha.= substr($dteFecha, 5, 2)."/";
                    $strFecha.= substr($dteFecha, 0, 4);
                }

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
   				$pdf->Row(array($strEmpleado, '$'.number_format($intSaldo,2), $strFecha, $intDiasTranscurridos), 
   								$pdf->arrAlineacion, 'ClippedCell');
			}

			$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
			//Escribir totales
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->ClippedCell(120, 6, 'TOTAL:', 0, 0, 'R', 0);
			//Acumulado del saldo
			$pdf->ClippedCell(30, 6, '$'.number_format($intAcumSaldo,2), 0, 0, 'R', 0);
		}

		//Ejecutar la salida del reporte
        $pdf->Output('vales_caja_adeudos_general.pdf','I'); 
	}


	/*Método para generar un archivo XLS con los vales de caja que tienen adeudos
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls($dteFechaCorte, $intEmpleadoID) 
	{
		//Si existe id del empleado
		if($intEmpleadoID > 0)
		{
			//Hacer un llamado a la función para generar un archivo XLS con el listado de vales de caja con adeudos de un empleado
			$this->get_xls_empleado($dteFechaCorte, $intEmpleadoID);
		}
		else
		{
			//Hacer un llamado a la función para generar un archivo XLS con el listado general de vales de caja con adeudos
			$this->get_xls_general($dteFechaCorte);
		}
	}


	//Método para generar un archivo XLS con el listado de vales de caja con adeudos de un empleado
    public function get_xls_empleado($dteFechaCorte, $intEmpleadoID)
    {
    	 //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;
	    //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el total del saldo
	    $intTotalSaldo = 0;
		//Seleccionar los datos del empleado que coincide con el id
		$otdEmpleado =  $this->empleados->buscar($intEmpleadoID);
		//Variable que se utiliza para concatenar los datos del empleado
		$strNombreEmpleado = $otdEmpleado->codigo.' - '.$otdEmpleado->apellido_paterno;
		$strNombreEmpleado .= ' '.$otdEmpleado->apellido_materno.' '.$otdEmpleado->nombre;

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFechaCorte = $this->get_fecha_formato_letra($dteFechaCorte, 'C');

		//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);

         //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'VALES CON ADEUDOS FECHA DE CORTE: '.$strTituloFechaCorte);

		$objExcel->setActiveSheetIndex(0)
		         ->setCellValue('A8', 'EMPLEADO: '.$strNombreEmpleado);
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
                 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
                 ->setCellValue('C'.$intPosEncabezados, 'CONCEPTO')
                 ->setCellValue('D'.$intPosEncabezados, 'IMPORTE')
                 ->setCellValue('E'.$intPosEncabezados, 'SALDO')
                 ->setCellValue('F'.$intPosEncabezados, 'DÍAS TRANSCURRIDOS');
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
    			 ->getStyle('A10:F10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:F10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:F10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Seleccionar los saldos de los vales de caja del empleado
		$otdResultado = $this->pagos->buscar_saldos_vales_caja_adeudos($dteFechaCorte, $intEmpleadoID);
		//Si hay información
		if($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Si el vale de caja no se encuentra pagado
				if (($arrCol->saldo >= 1) OR ($arrCol->saldo <= -1))
				{
					//Variable que se utiliza para asignar el número de días transcurridos
					$intDiasTranscurridos = 0;

                    //Calcular los días transcurridos
                    $intDiasTranscurridos = ceil((strtotime($dteFechaCorte) - strtotime($arrCol->fecha)) / 86400);

   					//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
	                         ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('B'.$intFila, $arrCol->fecha_format)
	                         ->setCellValue('C'.$intFila, $arrCol->concepto)
	                         ->setCellValue('D'.$intFila, $arrCol->importe)
	                         ->setCellValue('E'.$intFila, $arrCol->saldo)
	                         ->setCellValue('F'.$intFila, $intDiasTranscurridos);

	      			//Incrementar acumulado del saldo
                    $intAcumSaldo += $arrCol->saldo;
                    //Incrementar el indice para escribir los datos del siguiente registro
              		$intFila++; 

				}//Cierre de verificación del saldo
			}
		
			//Asignar el indice para escribir el total
            $intFilaTotal = $intFila++;

            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('D'.$intFilaTotal,  'TOTAL: ')
                     ->setCellValue('E'.$intFilaTotal,  $intAcumSaldo);

            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('D'.$intFilaTotal.':'.'E'.$intFilaTotal)
            		 ->applyFromArray($arrStyleBold);

            //Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('D'.$intFilaInicial.':'.'E'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar alineación de las siguientes celdas
           	$objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('D'.$intFilaInicial.':'.'E'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

			$objExcel->getActiveSheet()
                	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			
		}

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'vales_caja_adeudos_'.$otdEmpleado->codigo.'.xls', 'vales con adeudos', $intFila);
    }


    //Método para generar un archivo XLS con el listado general de vales de caja con adeudos
    public function get_xls_general($dteFechaCorte)
    {
    	//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Variable que se utiliza pra asignar el id actual del empleado
	    $intEmpleadoIDActual = 0;
	    //Variable que se utiliza pra asignar la fecha del vale de caja
	    $strFecha = '';
	   //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
        //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFechaCorte = $this->get_fecha_formato_letra($dteFechaCorte, 'C');
		//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);

         //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'VALES CON ADEUDOS FECHA DE CORTE: '.$strTituloFechaCorte);

      	//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'EMPLEADO')
                 ->setCellValue('B'.$intPosEncabezados, 'SALDO')
                 ->setCellValue('C'.$intPosEncabezados, 'FECHA')
                 ->setCellValue('D'.$intPosEncabezados, 'DÍAS TRANSCURRIDOS');
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

         //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:D9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

    	//Seleccionar los saldos de los vales de caja
		$otdResultado = $this->pagos->buscar_saldos_vales_caja_adeudos($dteFechaCorte);
		//Si hay información
		if($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Si el vale de caja no se encuentra pagado
				if (($arrCol->saldo >= 1) OR ($arrCol->saldo <= -1))
				{
					//Si el empleado actual es diferente al anterior
					if ($intEmpleadoIDActual != $arrCol->empleado_id)
					{
						//Si existe id del empleado actual
						if ($intEmpleadoIDActual > 0)
						{
							//Si existe fecha
                            if ($dteFecha != "")
                            {
                            	//Separar fecha
                                $strFecha = substr($dteFecha, 8, 2)."/";
                                $strFecha.= substr($dteFecha, 5, 2)."/";
                                $strFecha.= substr($dteFecha, 0, 4);
                            }

			   				//Agregar información del registro
							$objExcel->setActiveSheetIndex(0)
			                         ->setCellValue('A'.$intFila, $strEmpleado)
			                         ->setCellValue('B'.$intFila, $intSaldo)
			                         ->setCellValue('C'.$intFila, $strFecha)
			                         ->setCellValue('D'.$intFila, $intDiasTranscurridos);
			                
			                //Incrementar el indice para escribir los datos del siguiente registro
              				$intFila++; 
						}

						//Asignar valores del empleado
						$intEmpleadoIDActual = $arrCol->empleado_id;
						$strEmpleado = $arrCol->empleado;
						$intSaldo = $arrCol->saldo;
						//Incrementar acumulado del saldo
					    $intAcumSaldo += $arrCol->saldo;
					    //Limpiar las siguientes variables (por cada empleado recorrido)
					    $dteFecha = "";

					    //Si la fecha  es menor que la fecha de corte
                        if ($arrCol->fecha < $dteFechaCorte)
                        {
                        	//Asignar fecha del vale de caja
                            $dteFecha = $arrCol->fecha;
                            //Calcular los días transcurridos
                            $intDiasTranscurridos = ceil((strtotime($dteFechaCorte) - strtotime($dteFecha)) / 86400);
                        }

                        //Asignar fecha del vale de caja
                        $strFechaUlt = $arrCol->fecha;
					}
					else
					{
						//Incrementar acumulados
						$intSaldo += $arrCol->saldo;
                        $intAcumSaldo +=  $arrCol->saldo;

                        //Si la fecha es menor que la fecha de corte
                        if ($arrCol->fecha < $dteFechaCorte)
                        {
                        	//Si la fecha  es menor que la fecha de corte
                            if (($arrCol->fecha < $dteFecha) OR ($dteFecha == ""))
                            {
                            	//Asignar fecha del vale de caja
                                $dteFecha = $arrCol->fecha;
                                //Calcular los días transcurridos
                                $intDiasTranscurridos = ceil((strtotime($dteFechaCorte) - strtotime($dteFecha)) / 86400);
                            }
                        }

                        //Si la fecha es mayor que la última fecha
                        if ($arrCol->fecha > $strFechaUlt)
                        {
                        	//Asignar fecha del vale de caja
                            $strFechaUlt = $arrCol->fecha;
                        }
					}

				}//Cierre de verificación del saldo
			}

			//Escribir los acumulados del último empleado
			if ($intEmpleadoIDActual > 0)
			{
				//Si existe fecha
                if ($dteFecha != "")
                {
                	//Separar fecha
                    $strFecha = substr($dteFecha, 8, 2)."/";
                    $strFecha.= substr($dteFecha, 5, 2)."/";
                    $strFecha.= substr($dteFecha, 0, 4);
                }


				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
	                     ->setCellValue('A'.$intFila, $strEmpleado)
	                     ->setCellValue('B'.$intFila, $intSaldo)
	                     ->setCellValue('C'.$intFila, $strFecha)
	                     ->setCellValue('D'.$intFila, $intDiasTranscurridos);

	            //Incrementar el indice para escribir los datos del siguiente registro
              	$intFila++; 
			}


			//Asignar el indice para escribir el total
            $intFilaTotal = $intFila++;

            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('A'.$intFilaTotal,  'TOTAL: ')
                     ->setCellValue('B'.$intFilaTotal,  $intAcumSaldo);

            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('A'.$intFilaTotal.':'.'B'.$intFilaTotal)
            		 ->applyFromArray($arrStyleBold);

            //Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar alineación de las siguientes celdas
           	$objExcel->getActiveSheet()
                	 ->getStyle('A'.$intFilaTotal.':'.'A'.$intFilaTotal)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);
            
            $objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

			$objExcel->getActiveSheet()
                	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

		}


        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'vales_caja_adeudos_general.xls', 'vales con adeudos', $intFila);
    }

   
}