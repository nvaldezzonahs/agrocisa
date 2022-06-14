<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_analisis_auxiliares extends MY_Controller {
	

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
	    //Cargamos el modelo de catalogo de cuentas
		$this->load->model('contabilidad/catalogo_cuentas_model', 'cuentas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('contabilidad/rep_analisis_auxiliares', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	/*Método para generar un reporte PDF con el análisis de auxiliares contables
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{
		
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strCuentaInicial = trim($this->input->post('strCuentaInicial'));
		$strCuentaFinal = trim($this->input->post('strCuentaFinal'));
		$strTipoReporte = $this->input->post('strTipoReporte');
		$strIncluirSaldosAnteriores = $this->input->post('strIncluirSaldosAnteriores');

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .=	 ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');


		//Seleccionar los saldos de las cuentas contables
		$otdCuentas = $this->cuentas->buscar_saldos_cuentas($dteFechaInicial, $dteFechaFinal, 
														    $strCuentaInicial, $strCuentaFinal);

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  utf8_decode('ANÁLISIS DE AUXILIARES CONTABLES ').$strTituloRangoFechas;
		//Crea los titulos de la cabecera detalles de la póliza
		$pdf->arrCabecera = array('FECHA', 'TIPO', utf8_decode('NÚMERO'),  'CONCEPTO', 'REFERENCIA',
								  '', 'CARGO', 'ABONO', 'SALDO');
		//Establece el ancho de las columnas de cabecera de la póliza
		$pdf->arrAnchura = array(15, 15, 16, 62, 19, 3, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla de la póliza
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L', 'L', 'C', 'R', 'R', 'R');
		//Establece el ancho de las columnas de las cuentas
		$arrAnchuraCuentas = array(20, 88, 22, 60);
		//Establece la alineación de las celdas de la tabla cuentas
		$arrAlineacionCuentas = array('L', 'L', 'R', 'R');
		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(130, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R', 'R');
		//Establecer el color de línea
	    $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		//Agregar la primer pagina
		$pdf->AddPage();
			
		//Si hay información
		if($otdCuentas)
		{
			//Recorremos el arreglo 
			foreach ($otdCuentas as $arrCta)
			{
				//Variable que se utiliza para asignar el saldo inicial
				$intSaldoInicial = 0;
				//Variable que se utiliza para asignar el saldo actual
				$intSaldoActual = 0;
				//Variable que se utiliza para agregar cuenta en el reporte (asignar NO para evitar mostrar los datos de la cuenta)
				$strAgregarCta = 'NO';

				//Asignar array con los saldos de la cuenta contable
				$arrSaldos = $this->get_saldos_cuenta_contable($arrCta);
				//Asignar saldos de la cuenta contable
			    $intSaldoInicial = $arrSaldos['saldo_inicial'];
			    $intSaldoActual = $arrSaldos['saldo_actual'];

			
			    //Seleccionar los movimientos de la cuenta contable
				$otdMovimientos = $this->cuentas->buscar_movimientos_analisis_auxiliares($arrCta->cuenta_id,
																						 $dteFechaInicial, 
																						 $dteFechaFinal);

				
				
				//Dependiendo del tipo de reporte, mostrar información en el archivo
				if($strTipoReporte == 'SOLO_MOVIMIENTOS')//Sólo con movimientos en el rango de fechas
				{
					 //Si existen movimientos de la cuenta contable
					 if($otdMovimientos)
					 {
					 	//Asignar SI para agregar datos de la cuenta
					 	$strAgregarCta = 'SI';

					 }
					
				}
				else if($strTipoReporte == 'MOVIMIENTOS_SALDOS')//Cuentas con movimientos y/o saldo en el rango de fechas
				{
				    //Si existen movimientos ó saldo de la cuenta contable
					//if($otdMovimientos OR (($intSaldoActual >= 1) OR ($intSaldoActual <= -1))) //Validación anterior
					//Se cambia la condición porque quieren saldos negativos
					if($otdMovimientos OR ($intSaldoActual > 0 OR $intSaldoActual < 0))
					{
						//Asignar SI para agregar datos de la cuenta
					 	$strAgregarCta = 'SI';

					}
				}
				else if($strTipoReporte == 'SALDO')//Sólo cuentas con saldo
				{
					//Si existe saldo de la cuenta contable
					//if (($intSaldoActual >= 1) OR ($intSaldoActual <= -1))//Validación anterior
					//Se cambia la condición porque quieren saldos negativos
					if($intSaldoActual > 0 OR  $intSaldoActual < 0)
					{
						//Asignar SI para agregar datos de la cuenta
					 	$strAgregarCta = 'SI';
						
					}

				}
				else //Todas las cuentas
				{
					//Asignar SI para agregar datos de la cuenta
					$strAgregarCta = 'SI';
					
				}

				

				//Si se cumplen las reglas de validación
				if($strAgregarCta == 'SI')
				{
					//Hacer un llamado a la función para mostrar información en el reporte
					$this->get_datos_reporte($pdf, 'PDF', $otdMovimientos, $arrCta, $intSaldoInicial, 
  									         $strIncluirSaldosAnteriores, $arrAnchuraCuentas, 
  									         $arrAlineacionCuentas, $arrAnchuraTotales, $arrAlineacionTotales);
				}


			}//Cierre de foreach (cuentas)

		}//Cierre de verificación de cuentas

		//Ejecutar la salida del reporte
        $pdf->Output('analisis_auxiliares_'.$strTipoReporte.'.pdf','I'); 
	}	


	/*Método para generar un archivo XLS con el análisis de auxiliares contables
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls()
    {

    	//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strCuentaInicial = trim($this->input->post('strCuentaInicial'));
		$strCuentaFinal = trim($this->input->post('strCuentaFinal'));
		$strTipoReporte = $this->input->post('strTipoReporte');
		$strIncluirSaldosAnteriores = $this->input->post('strIncluirSaldosAnteriores');


		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .=	 ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

		//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
		
		//Seleccionar los saldos de las cuentas contables
		$otdCuentas = $this->cuentas->buscar_saldos_cuentas($dteFechaInicial, $dteFechaFinal, 
														    $strCuentaInicial, $strCuentaFinal);

		//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'ANÁLISIS DE AUXILIARES CONTABLES '.$strTituloRangoFechas);
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('B'.$intPosEncabezados, 'TIPO')
        		 ->setCellValue('C'.$intPosEncabezados, 'NÚMERO')
        		 ->setCellValue('D'.$intPosEncabezados, 'CONCEPTO')
                 ->setCellValue('E'.$intPosEncabezados, 'REFERENCIA')
                 ->setCellValue('F'.$intPosEncabezados, 'ESTATUS')
                 ->setCellValue('G'.$intPosEncabezados, 'CARGO')
                 ->setCellValue('H'.$intPosEncabezados, 'ABONO')
                 ->setCellValue('I'.$intPosEncabezados, 'SALDO');

        //Preferencias de color de relleno de celda
		$objExcel->getActiveSheet()
				 ->getStyle('A9:I9')
				 ->getFill()
				 ->applyFromArray($arrStyleColumnas);



		//Si hay información
		if($otdCuentas)
		{
			//Recorremos el arreglo 
			foreach ($otdCuentas as $arrCta)
			{
				//Variable que se utiliza para asignar el saldo inicial
				$intSaldoInicial = 0;
				//Variable que se utiliza para asignar el saldo actual
				$intSaldoActual = 0;
				//Variable que se utiliza para agregar cuenta en el reporte (asignar NO para evitar mostrar los datos de la cuenta)
				$strAgregarCta = 'NO';

				//Asignar array con los saldos de la cuenta contable
				$arrSaldos = $this->get_saldos_cuenta_contable($arrCta);
				//Asignar saldos de la cuenta contable
			    $intSaldoInicial = $arrSaldos['saldo_inicial'];
			    $intSaldoActual = $arrSaldos['saldo_actual'];

			
			    //Seleccionar los movimientos de la cuenta contable
				$otdMovimientos = $this->cuentas->buscar_movimientos_analisis_auxiliares($arrCta->cuenta_id,
																						 $dteFechaInicial, 
																						 $dteFechaFinal);

				//Dependiendo del tipo de reporte, mostrar información en el archivo
				if($strTipoReporte == 'SOLO_MOVIMIENTOS')//Sólo con movimientos en el rango de fechas
				{
					 //Si existen movimientos de la cuenta contable
					 if($otdMovimientos)
					 {
					 	//Asignar SI para agregar datos de la cuenta
					 	$strAgregarCta = 'SI';
					 }
					
				}
				else if($strTipoReporte == 'MOVIMIENTOS_SALDOS')//Cuentas con movimientos y/o saldo en el rango de fechas
				{
				    //Si existen movimientos ó saldo de la cuenta contable
					//if($otdMovimientos OR (($intSaldoActual >= 1) OR ($intSaldoActual <= -1)))//Validación anterior
					//Se cambia la condición porque quieren saldos negativos
					if($otdMovimientos OR ($intSaldoActual > 0 OR $intSaldoActual < 0))
					{
						//Asignar SI para agregar datos de la cuenta
					 	$strAgregarCta = 'SI';

					}
				}
				else if($strTipoReporte == 'SALDO')//Sólo cuentas con saldo
				{
					//Si existe saldo de la cuenta contable
					//if (($intSaldoActual >= 1) OR ($intSaldoActual <= -1))//Validación anterior
					//Se cambia la condición porque quieren saldos negativos
					if($intSaldoActual > 0 OR  $intSaldoActual < 0)
					{
						//Asignar SI para agregar datos de la cuenta
					 	$strAgregarCta = 'SI';

					}

				}
				else //Todas las cuentas
				{
					//Asignar SI para agregar datos de la cuenta
					$strAgregarCta = 'SI';

				}

				//Si se cumplen las reglas de validación
				if($strAgregarCta == 'SI')
				{
					//Hacer un llamado a la función para mostrar información en el reporte
					$intFila =  $this->get_datos_reporte($objExcel, 'EXCEL', $otdMovimientos, $arrCta, $intSaldoInicial, 
  									         			 $strIncluirSaldosAnteriores, NULL, NULL, NULL, NULL, $intFila, 
  									         			 $arrStyleBold);
				}


			}//Cierre de foreach (cuentas)

			//Cambiar contenido de las celdas a formato moneda
       		$objExcel->getActiveSheet()
            		 ->getStyle('G'.$intFilaInicial.':'.'I'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            //Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
		        	 ->getStyle('A'.$intFilaInicial.':'.'A'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);


		    $objExcel->getActiveSheet()
		        	 ->getStyle('G'.$intFilaInicial.':'.'I'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		     
        	//Cambiar estilo de las siguientes celdas
	        $objExcel->getActiveSheet()
	            		 ->getStyle('F'.$intFila.':'.'I'.$intFila)
	            		 ->applyFromArray($arrStyleBold);

		}//Cierre de verificación de cuentas


        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'analisis_auxiliares_'.$strTipoReporte.'.xls', 
        								    'analisis de auxiliares', $intFila);
    }


    //Función que se utiliza para escribir los datos del reporte 
  	public function  get_datos_reporte($lib, $strTipoArchivo, $otdMovimientos, $arrCta, $intSaldoInicial, 
  									   $strIncluirSaldosAnteriores, $arrAnchuraCuentas = NULL, 
  									   $arrAlineacionCuentas = NULL, $arrAnchuraTotales = NULL, 
  									   $arrAlineacionTotales = NULL, $intFilaExcel = NULL, $arrStyleBold = NULL)
    {
		//Variable que se utiliza para asignar el saldo actual de la cuenta
		$intSaldoActual = 0;
		//Variable que se utiliza para asignar el acumulado de los cargos
		$intAcumCargos = 0;
		//Variable que se utiliza para asignar el acumulado de los abonos
		$intAcumAbonos = 0;
		//Array que se utiliza para agregar los datos de la cuenta (cuarto nivel o seleccionada)
		$arrDatosCta = array('descripcion' => '',
							 'cuenta' => '', 
							 'incluir_saldo' => '', 
							 'saldo_inicial' => '');

		//Array que se utiliza para agregar los datos de la cuenta del primer nivel
		$arrDatosCtaPrimerNivel = array('descripcion' => '',
										'cuenta' => '');

		//Array que se utiliza para agregar los datos de la cuenta del segundo nivel
		$arrDatosCtaSegundoNivel = array('descripcion' => '',
										  'cuenta' => '');

		//Array que se utiliza para agregar los datos de la cuenta del tercer nivel
		$arrDatosCtaTercerNivel =  array('descripcion' => '',
										 'cuenta' => '');

		//Array que se utiliza para agregar los datos de los acumulados
		$arrDatosAcumulados = array('totales' => 'TOTALES:',
								    'acumulado_cargos' => '0.00', 
								 	'acumulado_abonos' => '0.00',
								    'saldo_actual' => '0.00');

		//Variable que se utiliza para asignar la naturaleza
	    $strNaturalezaCta = $arrCta->naturaleza;

	   
		//Agregar al array los datos de la cuenta  del primer nivel
		$arrDatosCtaPrimerNivel['cuenta'] = $arrCta->cuenta_primer_nivel;
		$arrDatosCtaPrimerNivel['descripcion'] = $arrCta->descripcion_cuenta_primer_nivel;
		
		//Agregar al array los datos de la cuenta del segundo nivel
		$arrDatosCtaSegundoNivel['cuenta'] = $arrCta->cuenta_segundo_nivel;
		$arrDatosCtaSegundoNivel['descripcion'] = $arrCta->descripcion_cuenta_segundo_nivel;

		//Agregar al array los datos de la cuenta  del tercer nivel
		$arrDatosCtaTercerNivel['cuenta'] = $arrCta->cuenta_tercer_nivel;
		$arrDatosCtaTercerNivel['descripcion'] = $arrCta->descripcion_cuenta_padre;


		//Agregar al array los datos de la cuenta
		$arrDatosCta['cuenta'] = $arrCta->cuenta; 
	    $arrDatosCta['descripcion'] = $arrCta->descripcion;
	    

	    //Si se cumple la sentencia mostrar saldo anterior
	    if($strIncluirSaldosAnteriores == 'SI')
	    {	
	    	//Asignar el saldo inicial
	    	$intSaldoActual = $intSaldoInicial;

	    	//Si el tipo de archivo es PDF
	    	if($strTipoArchivo == 'PDF')
	    	{
	    		//Convertir cantidad a formato moneda
			    $intSaldoInicial = '$'.number_format($intSaldoInicial,2);
	    	}

			//Saldo anterior
			$arrDatosCta['incluir_saldo'] = 'SALDO INICIAL';
			$arrDatosCta['saldo_inicial'] = $intSaldoInicial;
	    }


	    //Si el tipo de archivo es PDF
	    if($strTipoArchivo == 'PDF')
	    {
	    	//Establece el ancho de las columnas
	    	$lib->SetWidths($arrAnchuraCuentas);

	    	//Si existe cuenta del primer nivel
	    	if($arrCta->cuenta_primer_nivel != '')
	    	{
	    	   //Cuenta del primer nivel
				$lib->Row(array($arrDatosCtaPrimerNivel['cuenta'], 
					            utf8_decode($arrDatosCtaPrimerNivel['descripcion'])), 
						  $arrAlineacionCuentas, 'ClippedCell', 'SI');

	    	}


	    	//Si existe cuenta del segundo nivel
	    	if($arrCta->cuenta_segundo_nivel != '')
	    	{

	    	    //Cuenta del segundo nivel
				$lib->Row(array($arrDatosCtaSegundoNivel['cuenta'], 
					            utf8_decode($arrDatosCtaSegundoNivel['descripcion'])), 
						  $arrAlineacionCuentas, 'ClippedCell', 'SI');

	    	}

	    	//Si existe cuenta del tercer nivel
	    	if($arrCta->cuenta_tercer_nivel != '')
	    	{

	    		//Cuenta del tercer nivel
			  	$lib->Row(array($arrDatosCtaTercerNivel['cuenta'], 
			             		utf8_decode($arrDatosCtaTercerNivel['descripcion'])), 
				  	     $arrAlineacionCuentas, 'ClippedCell', 'SI');
	    	}

	    	
	    	//Cuenta del cuarto nivel (o cuenta seleccionada)
			$lib->Row(array($arrDatosCta['cuenta'], 
			                utf8_decode($arrDatosCta['descripcion']), 
			                $arrDatosCta['incluir_saldo'],
			                $arrDatosCta['saldo_inicial']), 
				  	     $arrAlineacionCuentas, 'ClippedCell', 'SI');

	    }
	    else //Si el tipo de archivo es Excel
	    {
	    	
			//Si existe cuenta del primer nivel
	    	if($arrCta->cuenta_primer_nivel != '')
	    	{
	    		//Agregar información de la cuenta
	    		$lib->getActiveSheet()
	                ->setCellValue('A'.$intFilaExcel, $arrDatosCtaPrimerNivel['cuenta'])
	                ->setCellValue('B'.$intFilaExcel, $arrDatosCtaPrimerNivel['descripcion']);
	    		
				//Incrementar el indice para escribir los datos del siguiente registro
				$intFilaExcel++;
	    	}

	    	//Si existe cuenta del segundo nivel
	    	if($arrCta->cuenta_segundo_nivel != '')
	    	{
				//Agregar información de la cuenta
	    		$lib->getActiveSheet()
	                ->setCellValue('A'.$intFilaExcel, $arrDatosCtaSegundoNivel['cuenta'])
	                ->setCellValue('B'.$intFilaExcel, $arrDatosCtaSegundoNivel['descripcion']);

				//Incrementar el indice para escribir los datos del siguiente registro
				$intFilaExcel++;
	    	}


	    	//Si existe cuenta del tercer nivel
	    	if($arrCta->cuenta_tercer_nivel != '')
	    	{
	    		//Agregar información de la cuenta
	    		$lib->getActiveSheet()
	                ->setCellValue('A'.$intFilaExcel, $arrDatosCtaTercerNivel['cuenta'])
	                ->setCellValue('B'.$intFilaExcel, $arrDatosCtaTercerNivel['descripcion']);

				//Incrementar el indice para escribir los datos del siguiente registro
				$intFilaExcel++;
	    	}

 
	        //Agregar información de la cuenta del cuarto nivel (o cuenta seleccionada)
	    	$lib->getActiveSheet()
                ->setCellValue('A'.$intFilaExcel, $arrDatosCta['cuenta'])
                ->setCellValue('B'.$intFilaExcel, $arrDatosCta['descripcion'])
                ->setCellValue('E'.$intFilaExcel, $arrDatosCta['incluir_saldo'])
                ->setCellValue('I'.$intFilaExcel, $arrDatosCta['saldo_inicial']);

			//Incrementar el indice para escribir los datos del siguiente registro
			$intFilaExcel++;

	    }


		//Verificar si existe información de los movimientos 
		if($otdMovimientos)
		{

			//Recorremos el arreglo 
			foreach ($otdMovimientos as $arrMov)
			{ 
				//Variable que se utiliza para asignar el importe del cargo
				$intCargo = 0;
				//Variable que se utiliza para asignar el importe del abono
				$intAbono = 0;
				//Array que se utiliza para agregar los datos del movimiento
				$arrDatosMov = array('fecha' => '', 
									 'tipo' => '', 
									 'folio' => '',
									 'concepto' => '', 
									 'referencia' => '', 
									 'estatus' => '', 
									 'cargo' => '', 
									 'abono' => '', 
									 'saldo' => '0.00');

				//Variable que se utiliza para asignar la naturaleza
				$strNaturalezaMov = $arrMov->naturaleza;
				//Variables que se utilizan para asignar valores del movimiento
				$intImporte = $arrMov->importe;
				$strEstatus =  $arrMov->estatus;
				$strAliasEstatus = '';

				//Dependiendo del estatus asignar alias
				if($strEstatus == 'ACTIVO')
				{
					$strAliasEstatus = 'A';
				}
				else if($strEstatus == 'INACTIVO')
				{
					$strAliasEstatus = 'C';
				}
				else
				{
					$strAliasEstatus = 'NA';
				}


				//Dependiendo de la naturaleza del movimiento, asignar importe
				if($strNaturalezaMov == 'CARGO')
				{
					//Asignar importe del movimiento
					$intCargo =  $intImporte;
					$intAbono =  '';

					//Si el estatus del movimiento es ACTIVO
					if($strEstatus == 'ACTIVO')
					{
						//Incrementar acumulado
						$intAcumCargos += $intImporte;
						
						//Dependiendo de la naturaleza de la cuenta, calcular el saldo actual
						if($strNaturalezaCta == 'ACREEDORA')
						{
							//Decrementar el saldo actual
							$intSaldoActual -= $intImporte;
						}
						else
						{
							//Incrementar el saldo actual
							$intSaldoActual += $intImporte;
						}
					}


				}
				else
				{
					//Asignar importe del movimiento
					$intAbono = $intImporte;
					$intCargo =  '';

					//Si el estatus del movimiento es ACTIVO
					if($strEstatus == 'ACTIVO')
					{
						//Incrementar acumulado
						$intAcumAbonos += $intImporte;

						//Dependiendo de la naturaleza de la cuenta, calcular el saldo actual
						if($strNaturalezaCta == 'ACREEDORA')
						{
							//Incrementar el saldo actual
							$intSaldoActual += $intImporte;
						}
						else
						{
							//Decrementar el saldo actual
							$intSaldoActual -= $intImporte;
							
						}
					}
				}

				//Agregar al array los datos del movimiento
				$arrDatosMov['fecha'] = $arrMov->fecha;
				$arrDatosMov['tipo'] = $arrMov->tipo;
				$arrDatosMov['folio'] = $arrMov->folio;
				$arrDatosMov['concepto'] = $arrMov->concepto;
				$arrDatosMov['referencia'] = $arrMov->referencia;
				$arrDatosMov['estatus'] = $strAliasEstatus;
				$arrDatosMov['cargo'] = $intCargo;
				$arrDatosMov['abono'] = $intAbono;
				$arrDatosMov['saldo'] = $intSaldoActual;

				//Si el tipo de archivo es PDF
			    if($strTipoArchivo == 'PDF')
			    {	

			    	//Si existe el tipo de movimientos es un cargo
			    	if($intCargo != '')
			    	{
			    	   //Convertir cantidad a formato moneda
			    		$arrDatosMov['cargo'] = '$'.number_format($intCargo,2);
			    	}

			    	//Si existe el tipo de movimientos es un abono
			    	if($intAbono != '')
			    	{
			    		//Convertir cantidad a formato moneda
			    		$arrDatosMov['abono'] = '$'.number_format($intAbono,2);
			    	}
			    
					//Establece el ancho de las columnas
					$lib->SetWidths($lib->arrAnchura);

					//Movimiento
					$lib->Row(array($arrDatosMov['fecha'], 
									$arrDatosMov['tipo'], $arrDatosMov['folio'], 
					                utf8_decode($arrDatosMov['concepto']), 
					                utf8_decode($arrDatosMov['referencia']),
					                $arrDatosMov['estatus'],
					                $arrDatosMov['cargo'], $arrDatosMov['abono'],
					                '$'.number_format($arrDatosMov['saldo'],2)), 
						  	   	    $lib->arrAlineacion, 'ClippedCell', 'SI');
	            
				}
				else //Si el tipo de archivo es Excel
				{
					
				    //Agregar información del movimiento
					$lib->getActiveSheet()
		                ->setCellValue('A'.$intFilaExcel, $arrDatosMov['fecha'])
		                ->setCellValue('B'.$intFilaExcel, $arrDatosMov['tipo'])
		                ->setCellValue('C'.$intFilaExcel, $arrDatosMov['folio'])
		                ->setCellValue('D'.$intFilaExcel, $arrDatosMov['concepto'])
		                ->setCellValue('E'.$intFilaExcel, $arrDatosMov['referencia'])
		                ->setCellValue('F'.$intFilaExcel, $arrDatosMov['estatus'])
		                ->setCellValue('G'.$intFilaExcel, $arrDatosMov['cargo'])
		                ->setCellValue('H'.$intFilaExcel, $arrDatosMov['abono'])
		                ->setCellValue('I'.$intFilaExcel, $arrDatosMov['saldo']);

					//Incrementar el indice para escribir los datos del siguiente registro
					$intFilaExcel++;
				}
					
			}//Cierre de foreach (movimientos)
			
		}//Cierre de verificación de movimientos

		//Agregar al array los datos de los totales (acumulados)
		$arrDatosAcumulados['acumulado_cargos'] = $intAcumCargos;
		$arrDatosAcumulados['acumulado_abonos'] = $intAcumAbonos;
		$arrDatosAcumulados['saldo_actual'] = $intSaldoActual;

		//Si el tipo de archivo es PDF
	    if($strTipoArchivo == 'PDF')
	    {
	    	//Dibuja una línea para separar la información de cada prospecto
	    	$lib->Line(10, $lib->GetY(), 200, $lib->GetY());

	    	//Escribir totales
			//Establece el ancho de las columnas
			$lib->SetWidths($arrAnchuraTotales);

	    	//Cambiar el volumen de la fuente a bold
		    $lib->strTipoLetraTabla = 'Negrita';

		    //Acumulados de los importes
		    $lib->Row(array($arrDatosAcumulados['totales'],
		    				'$'.number_format($arrDatosAcumulados['acumulado_cargos'],2),
						    '$'.number_format($arrDatosAcumulados['acumulado_abonos'],2),
							'$'.number_format($arrDatosAcumulados['saldo_actual'],2)), 
						  	$arrAlineacionTotales, 'ClippedCell', 'SI');

			//Cambiar el volumen de la fuente a normal
		    $lib->strTipoLetraTabla = '';
			$lib->Ln(6);//Deja un salto de línea
		}
		else //Si el tipo de archivo es Excel
		{
			//Incrementar el indice para escribir los datos del siguiente registro
			$intFilaExcel++;
			
			//Agregar información de los totales
			$lib->getActiveSheet()
		        ->setCellValue('F'.$intFilaExcel, $arrDatosAcumulados['totales'])
		        ->setCellValue('G'.$intFilaExcel, $arrDatosAcumulados['acumulado_cargos'])
		        ->setCellValue('H'.$intFilaExcel, $arrDatosAcumulados['acumulado_abonos'])
		        ->setCellValue('I'.$intFilaExcel, $arrDatosAcumulados['saldo_actual']);


		    //Cambiar estilo de las siguientes celdas
	        $lib->getActiveSheet()
	            ->getStyle('F'.$intFilaExcel.':'.'I'.$intFilaExcel)
	            ->applyFromArray($arrStyleBold);

			//Incrementar el indice para escribir los datos del siguiente registro
			$intFilaExcel+=3;
		}


		//Si el tipo de archivo es Excel
        if($strTipoArchivo == 'EXCEL')
        {
            //Regresar indice para ecribir los datos del siguiente registro
            return  $intFilaExcel;
        }

    }

}