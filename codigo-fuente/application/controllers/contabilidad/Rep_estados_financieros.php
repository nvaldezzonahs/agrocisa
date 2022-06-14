<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_estados_financieros extends MY_Controller {
	
	//Información que se utiliza para asignar los indices iniciales del archivo Excel
	var $archivoExcel = NULL;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar el indice de la columna principal
	    $this->archivoExcel['intIndColInicial'] = 1;
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		 //Cargamos el modelo de catalogo de cuentas
		$this->load->model('contabilidad/catalogo_cuentas_model', 'cuentas');
		 //Cargamos el modelo de catalogo de reportes
		$this->load->model('contabilidad/reportes_model', 'reportes');
		
		
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('contabilidad/rep_estados_financieros', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con los estados financieros
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte = $this->input->post('dteFechaCorte');
		$strTiposReporte = trim($this->input->post('strTiposReporte'));

		//Hacer un llamado a la función para obtener fecha inicial
		$dteFechaInicial = $this->get_fecha_inicial($dteFechaCorte);

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = ' AL '.mb_strtoupper($this->get_fecha_formato_letra($dteFechaCorte, ''));

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');

		
		//Agregar columnas %
		/*//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('DESCRIPCIÓN'), 'SALDO ANTERIOR', ' ', 'MOVIMIENTO DEL MES',
								   '', 'SALDO FINAL','');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(70,  25, 10, 35, 10,  30, 10);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'R', 'R', 'R', 'R', 'R', 'R');*/

		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('DESCRIPCIÓN'), 'SALDO ANTERIOR', 'MOVIMIENTO DEL MES',
								   'SALDO FINAL');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(70,  35, 45,  40);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'R', 'R', 'R');

		//Buscar los tipos de reporte que han sido seleccionados
	    $arrTiposReporte = explode('|', $strTiposReporte);

	    //Hacer recorrido para cargar reportes
		for ($intCon = 0; $intCon < sizeof($arrTiposReporte); $intCon++) 
		{
			//Variable que se utiliza para asignar el modulo
			$strTipoRep = $arrTiposReporte[$intCon];
			//Hacer un llamado a la función para obtener el título del reporte
			$strTitulo = $this->get_titulo_reporte($strTipoRep);
			$strTitulo .= $strTituloRangoFechas.' EN PESOS';

			$pdf->strLinea1 = $strTitulo;
			//Agregar pagina
			$pdf->AddPage();

			//Establece el ancho de las columnas
		    $pdf->SetWidths($pdf->arrAnchura);

		    //Hacer un llamado a la función para mostrar información en el reporte
			$this->get_datos_reporte('PDF', $strTipoRep, $pdf, $dteFechaInicial, $dteFechaCorte);

			
		}


			
		//Ejecutar la salida del reporte
        $pdf->Output('estados_financieros.pdf','I'); 


	}

	/*Método para generar un archivo XLS con los estados financieros
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte = $this->input->post('dteFechaCorte');
		$strTiposReporte = trim($this->input->post('strTiposReporte'));

		//Hacer un llamado a la función para obtener fecha inicial
		$dteFechaInicial = $this->get_fecha_inicial($dteFechaCorte);

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = ' AL '.mb_strtoupper($this->get_fecha_formato_letra($dteFechaCorte, ''));

		//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        
         //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
		//Variable que se utiliza para asignar el número de registros por cada  tipo de reporte
		$intNumRegistros = 0; 
		//Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última moneda)
		$intNumMaxRegistros = 0;

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

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);


		//Buscar los tipos de reporte que han sido seleccionados
	    $arrTiposReporte = explode('|', $strTiposReporte);

	    //Hacer recorrido para cargar reportes
		for ($intCon = 0; $intCon < sizeof($arrTiposReporte); $intCon++) 
		{

			//Número de fila donde se va a comenzar a rellenar
	        $intFila = 10;
	        $intFilaInicial = 10;

			//Variable que se utiliza para asignar el modulo
			$strTipoRep = $arrTiposReporte[$intCon];

			//Hacer un llamado a la función para obtener el título del reporte
			$strTitulo = $this->get_titulo_reporte($strTipoRep);
			$strTitulo .= $strTituloRangoFechas.' EN PESOS';

			//Asignar el nombre de la hoja
			$strNombreHoja = $strTipoRep;

			//Si se cumple la sentencia
	      	if($intContadorHojas == 0)
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
			$objExcel->getActiveSheet()->setCellValue('A7', $strTitulo);

			//Se agregan las columnas de cabecera
	        $objExcel->getActiveSheet()->setCellValue('A'.$intPosEncabezados, 'DESCRIPCIÓN')
	                 ->setCellValue('B'.$intPosEncabezados, 'SALDO ANTERIOR')
	                 ->setCellValue('C'.$intPosEncabezados, 'MOVIMIENTO DEL MES')
	                 ->setCellValue('D'.$intPosEncabezados, 'SALDO FINAL');

	        //Preferencias de color de relleno de celda
	        $objExcel->getActiveSheet()
	    			 ->getStyle('A9:D9')
	    			 ->getFill()
	    			 ->applyFromArray($arrStyleColumnas);
	     
	    	//Preferencias de color de texto de la celda
	        $objExcel->getActiveSheet()
	    			 ->getStyle('A9:D9')
	    			 ->applyFromArray($arrStyleFuenteColumnas);

	        //Cambiar alineación de las siguientes celdas
			 $objExcel->getActiveSheet()
            	 ->getStyle('B9:D9')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentRight);


            //Hacer un llamado a la función para mostrar información en el reporte
			$intFila =  $this->get_datos_reporte('EXCEL', $strTipoRep, $objExcel, $dteFechaInicial, $dteFechaCorte, $intFila);

           	//Asignar el número de registros
			$intNumRegistros = $intFila;

			//Si el número de registros (por cada moneda) es mayor que el número máximo de registros 
		    if($intNumRegistros > $intNumMaxRegistros)
            {
            	//Asignar número de registros
            	$intNumMaxRegistros = $intNumRegistros;
            }


		    //Incrementar contador por cada tipo de reporte
			$intContadorHojas++;

			
		}//Cierre del for


		

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
       $this->get_pie_pagina_archivo_excel($objExcel, 'estados_financieros.xls', 
        								    'estados financieros', $intNumMaxRegistros);


	}

	//Función que se utiliza para regresar el título del reporte
	public function get_titulo_reporte($strTipoRep)
	{
		//Variable que se utiliza para asignar título
		$strTitulo = '';
		//Dependiendo del tipo asignar título
		if($strTipoRep ==  'BALANCE_GRAL')
		{
			$strTitulo = 'BALANCE GENERAL';
		}
		else if($strTipoRep ==  'RESULTADOS_GLOBAL_GRAL')
		{
			$strTitulo = 'ESTADO DE RESULTADOS GLOBAL GENERAL';
		}

		//Regresar título
		return $strTitulo;
	}


	//Función que se utiliza para escribir los datos del reporte 
	public function get_datos_reporte($strTipoArchivo, $strTipoRep, $lib, $dteFechaInicial, $dteFechaFinal, $intFila = NULL)
	{
		//Dependiendo del tipo cargar datos del reporte
		if($strTipoRep ==  'BALANCE_GRAL')
		{
			//Hacer un llamado a la función para mostrar información del balance general
			return $this->get_balance_gral($strTipoArchivo, $lib, $dteFechaInicial, $dteFechaFinal, $intFila);
		}
		else if($strTipoRep ==  'RESULTADOS_GLOBAL_GRAL')
		{
			
			//Hacer un llamado a la función para mostrar información del estado de resultados global
			return $this->get_estado_resultados_gral($strTipoArchivo, $lib, $dteFechaInicial, $dteFechaFinal, $intFila);
		}

	}


//Método para generar el reporte de balance general
	public function get_balance_gral($strTipoArchivo, $lib, $dteFechaInicial, $dteFechaFinal, $intFila = NULL)
	{
		//Variables que se utilizan para asignar acumulados
		$numAntCirculante = 0;
		$numActCirculante = 0;
		$numAntFijo = 0;
		$numActFijo = 0;
		$numAntDiferido = 0;
		$numActDiferido = 0;
		$numAntPasivo = 0;
		$numActPasivo = 0;
		$numAntCapital = 0;
		$numActCapital = 0;


		//Asignar posición de la abscisa 
		$intPosX = 12;



		$otdAgrupadores = $this->reportes->buscar_agrupadores('BALANCE GENERAL');

		$intContSumaActivoCirculante = 0;
		$intContSumaPasivoCirculante = 0;

		if($otdAgrupadores)
		{
			foreach ($otdAgrupadores as $arrAgrup)
			{ 

				//Variable que se utiliza para asignar el concepto padre
				$strConceptoPadre =  $arrAgrup->concepto_padre;

				//Hacer un llamado a la función para escribir los datos de los detalles (cuentas) 
				$otdCtas = $this->get_detalles_agrupador($arrAgrup->reporte_id, $strConceptoPadre,
														 $dteFechaInicial, $dteFechaFinal,
											   	   	     $strTipoArchivo, $lib, $intFila, $intPosX);
				$intFila = $otdCtas['fila'];
				$numAntSdo =  $otdCtas['numAntSdo'];
				$numActSdo = $otdCtas['numActSdo'];


				//Calcular saldo final acumulado
				$numSdoFinal = ($numAntSdo + $numActSdo);

				//Dependiendo del concepto padre (agrupador) asignar valores
				if($strConceptoPadre == 'ACTIVO CIRCULANTE')
				{
					$numAntCirculante =  $numAntSdo;
	   				$numActCirculante = $numActSdo;
	   				//Incrementar contador por cada agrupador de las cuentas activo circulante
	   				$intContSumaActivoCirculante++;
	   				
				}
				else if($strConceptoPadre == 'ACTIVO FIJO')
				{
					 $numAntFijo =  $numAntSdo;
	   				 $numActFijo = $numActSdo;
	   				 //Incrementar contador por cada agrupador de las cuentas activo circulante
	   				 $intContSumaActivoCirculante++;
				}
				else if($strConceptoPadre == 'ACTIVO DIFERIDO')
				{
					 $numAntDiferido =  $numAntSdo;
	   				 $numActDiferido = $numActSdo;
	   				 //Incrementar contador por cada agrupador de las cuentas activo circulante
	   				 $intContSumaActivoCirculante++;
				}
				else if($strConceptoPadre == 'PASIVO CIRCULANTE')
				{
					 $numAntPasivo =  $numAntSdo;
	   				 $numActPasivo = $numActSdo;
	   				 //Incrementar contador por cada agrupador de las cuentas pasivo circulante
	   				 $intContSumaPasivoCirculante++;
				}
				else if($strConceptoPadre == 'CAPITAL')
				{
					 $numAntCapital =  $numAntSdo;
	   				 $numActCapital = $numActSdo;
				}


				//Hacer un llamado a la función para escribir totales
	  			$intFila = $this->get_total($arrAgrup->titulo_total, $numAntSdo,  $numActSdo, $numSdoFinal, 
							       			$strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL');
				
				//Si se cumple la sentencia significa que ya se recorrieron los agrupadores correspondientes al ACTIVO CIRCULANTE
	  			if($intContSumaActivoCirculante == 3)
	  			{
	  				/**********************************************
					**SUMA DEL ACTIVO
					***********************************************/
	  				//Calcular total activo
					$numAntTotalAct = ($numAntCirculante + $numAntFijo + $numAntDiferido);
					$numActTotalAct = ($numActCirculante + $numActFijo + $numActDiferido);
					$numSdoFinalTotalAct = ($numAntTotalAct + $numActTotalAct);

					//Hacer un llamado a la función para escribir utilidad bruta
				    $intFila = $this->get_total('SUMA DEL ACTIVO', $numAntTotalAct,  $numActTotalAct, $numSdoFinalTotalAct, 
										        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL');

				    //Inicializar valor
				    $intContSumaActivoCirculante = 0;
	  			}

	  			//Si se cumple la sentencia significa que ya se recorrieron los agrupadores correspondientes al PASIVO CIRCULANTE
	  			if($intContSumaPasivoCirculante == 1)
	  			{

	  				/**********************************************
					** SUMA DEL PASIVO
					***********************************************/
	  				$numSdoFinalTotalPas = ($numAntPasivo + $numActPasivo);
					//Hacer un llamado a la función para escribir utilidad bruta
				    $intFila = $this->get_total('SUMA DEL PASIVO', $numAntPasivo,  $numActPasivo, $numSdoFinalTotalPas, 
										        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL');

				    //Inicializar valor
				    $intContSumaPasivoCirculante = 0;
	  			}


			}//Cierre de foreach agrupador


			/**********************************************
			**UTILIDAD O (PERDIDA) DEL EJERCICIO
			***********************************************/
			//Calcular utilidad 
		    $numAntUtilidad = ($numAntCirculante + $numAntFijo + $numAntDiferido - $numAntPasivo - $numAntCapital);
			$numActUtilidad = ($numActCirculante + $numActFijo + $numActDiferido - $numActPasivo - $numActCapital);
			$numSdoFinalUtilidad = ($numAntUtilidad + $numActUtilidad);
		

			//Hacer un llamado a la función para escribir utilidad
	    	$intFila = $this->get_total('UTILIDAD O (PERDIDA) DEL EJERCICIO', $numAntUtilidad,  $numActUtilidad, $numSdoFinalUtilidad, 
							        $strTipoArchivo, $lib, $intFila, $intPosX);


	    	/**********************************************
			** SUMA DEL CAPITAL
			***********************************************/
		    //Calcular suma del capital 
		    $numAntSumCapital = ($numAntCapital + $numAntUtilidad);
			$numActSumCapital = ($numActCapital + $numActUtilidad);
			$numSdoFinalSumCapital = ($numAntSumCapital + $numActSumCapital);

		    //Hacer un llamado a la función para escribir total
		    $intFila = $this->get_total('SUMA DEL CAPITAL', $numAntSumCapital,  $numActSumCapital, $numSdoFinalSumCapital, 
								        $strTipoArchivo, $lib, $intFila, $intPosX);


		    /**********************************************
			** SUMA DEL PASIVO Y CAPITAL
			***********************************************/
			//Calcular total 
			$numAntTemp = ($numAntPasivo + $numAntSumCapital);
			$numActTemp = ($numActPasivo + $numActSumCapital);
			$numSdoFinalTemp = ($numAntTemp + $numActTemp);
		

			//Hacer un llamado a la función para escribir total
		    $intFila = $this->get_total('SUMA DEL PASIVO Y CAPITAL', $numAntTemp,  $numActTemp, $numSdoFinalTemp, 
								        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL');



		}//Cierre de verificación de información


		//Regresar indice de la fila
		return $intFila;


	}


	public function get_estado_resultados_gral($strTipoArchivo, $lib, $dteFechaInicial, $dteFechaFinal, $intFila = NULL)
	{

		//Variables que se utilizan para asignar acumulados
		$numAntVentas = 0;
		$numActVentas = 0;
		$numAntDev = 0;
		$numActDev = 0;
		$numAntProdFinanciero = 0;
	    $numActProdFinanciero = 0;
		$numAntCostos = 0;
		$numActCostos = 0;
		$numAntGastos = 0;
		$numActGastos = 0;
		$numAntGasAdmin = 0;
		$numActGasAdmin = 0;
		$numAntGasFin = 0;
		$numActGasFin = 0;

		//Asignar posición de la abscisa 
		$intPosX = 12;

		$intContVentasNetas = 0;
		$intContIngresosCorp = 0;


		$otdAgrupadores = $this->reportes->buscar_agrupadores('ESTADO DE RESULTADOS GLOBAL GENERAL');
		if($otdAgrupadores)
		{
			foreach ($otdAgrupadores as $arrAgrup)
			{ 

				//Variable que se utiliza para asignar el concepto padre
				$strConceptoPadre =  $arrAgrup->concepto_padre;

				//Hacer un llamado a la función para escribir los datos de los detalles (cuentas) 
				$otdCtas = $this->get_detalles_agrupador($arrAgrup->reporte_id, $strConceptoPadre,
														 $dteFechaInicial, $dteFechaFinal,
											   	   	     $strTipoArchivo, $lib, $intFila, $intPosX);
				$intFila = $otdCtas['fila'];
				$numAntSdo =  $otdCtas['numAntSdo'];
				$numActSdo = $otdCtas['numActSdo'];


				//Calcular saldo final acumulado
				$numSdoFinal = ($numAntSdo + $numActSdo);


				if($arrAgrup->titulo_total != '')
				{
					//Hacer un llamado a la función para escribir totales
	  				$intFila = $this->get_total($arrAgrup->titulo_total, $numAntSdo,  $numActSdo, $numSdoFinal, 
							       				$strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL');
				}

			
				//Dependiendo del concepto padre (agrupador) asignar valores
				if($strConceptoPadre == 'INGRESOS')
				{
					$numAntVentas =  $numAntSdo;
	   				$numActVentas = $numActSdo;

	   				//Incrementar contador por cada agrupador de las cuentas ventas 
	   				$intContVentasNetas++;
	   				//Incrementar contador por cada agrupador de los ingresos corporativos
	   				$intContIngresosCorp++;

	   				
				}
				else if($strConceptoPadre == 'DEVOLUCIONES')
				{

					$numAntDev =  $numAntSdo;
	   				$numActDev = $numActSdo;
	   				//Incrementar contador por cada agrupador de las cuentas ventas
	   				$intContVentasNetas++;
				}
				else if($strConceptoPadre == 'PRODUCTOS FINANCIEROS')
				{

					$numAntProdFinanciero =  $numAntSdo;
	   				$numActProdFinanciero = $numActSdo;
	   				//Incrementar contador por cada agrupador de los ingresos corporativos
	   				$intContIngresosCorp++;
				}


				//Si se cumple la sentencia significa que ya se recorrieron los agrupadores correspondientes a Ventas Netas
	  			if($intContVentasNetas == 2)
	  			{

	  				/**********************************************
				    ** TOTAL VENTAS NETAS
				    ***********************************************/
					//Calcular total de ventas
					$numAntTotalVta = ($numAntVentas - $numAntDev);
					$numActTotalVta = ($numActVentas - $numActDev);
					$numSdoFinalTotalVta = ($numAntVentas + $numActVentas - $numAntDev - $numActDev);

					//Hacer un llamado a la función para escribir total
				    $intFila = $this->get_total('TOTAL VENTAS NETAS', $numAntTotalVta,  $numActTotalVta, $numSdoFinalTotalVta, 
										        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL');

				    //Inicializar valor
				    $intContVentasNetas = 0;
	  			}

	  			//Si se cumple la sentencia significa que ya se recorrieron los agrupadores correspondientes a Ingresos Corporativos
	  			if($intContIngresosCorp == 2)
	  			{

	  				/**********************************************
					**TOTAL DE INGRESOS CORPORATIVOS
					***********************************************/
					//Calcular total de ingresos
					$numAntTotalIng = ($numAntTotalVta + $numAntProdFinanciero);
					$numActTotalIng = ($numActTotalVta + $numActProdFinanciero);
					$numSdoFinalTotalIng = ($numAntTotalVta + $numActTotalVta + $numAntProdFinanciero + $numActProdFinanciero);

					//Hacer un llamado a la función para escribir total
				    $intFila = $this->get_total('TOTAL DE INGRESOS CORPORATIVOS', $numAntTotalIng,  $numActTotalIng, 
				    							$numSdoFinalTotalIng,$strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL');

				    //Inicializar valor
				    $intContIngresosCorp = 0;
	  			}
				
	  			


			}//Cierre de foreach agrupador


		


		}//Cierre de verificación de información


	   

	     //Regresar indice de la fila
          return  $intFila;

	}



	public function get_detalles_agrupador($intReporteID, $strConceptoPadre, $dteFechaInicial, $dteFechaFinal, 
										  $strTipoArchivo, $lib, $intFila = NULL, $intPosX = NULL)
	{


		//Array que se utiliza para enviar datos
		$arrDatos = array('numAntSdo' => '0.00',
						  'numActSdo' => '0.00',
						  'fila' => 0);

		//Variable que se utiliza para acumular el saldo anterior (de las cuentas)
		 $numAntSdo = 0;
		 //Variable que se utiliza para acumular el saldo actual (de las cuentas)
		 $numActSdo = 0;
		 //Variable que se utiliza para asignar la naturaleza de las cuentas (por agrupador)
		 $strNaturaleza = NULL;
		//Asignar posición de la abscisa (título)
		$intPosXTitulo = 10;

			//Buscar los detalles (cuentas) del agrupador
			$otdDetalles = $this->reportes->buscar_detalles_agrupador($intReporteID, $strConceptoPadre);

			//Si existen detalles
			if($otdDetalles)
			{
				//Hacer recorrido para obtener información
				foreach ($otdDetalles as $arrDet)
				{ 
					//Si existe título principal
					if($arrDet->titulo_principal != '')
					{
						$arrDatos = array($arrDet->titulo_principal);
						$intFila = $this->get_registro($strTipoArchivo, $lib, $arrDatos, $intFila,  $intPosXTitulo);

					}

					//Si existe título secundario
					if($arrDet->titulo_secundario != '')
					{
						$arrDatos = array($arrDet->titulo_secundario);
						$intFila = $this->get_registro($strTipoArchivo, $lib, $arrDatos, $intFila, $intPosXTitulo);

					}

					

					//Hacer un llamado a la función para escribir los datos de las cuentas
					$otdCta = $this->get_datos_ctas_rep($dteFechaInicial, $dteFechaFinal, $strNaturaleza,
												   	   $arrDet->cuentas, $arrDet->concepto,  $strTipoArchivo, $lib,
													   $intFila, $intPosX);
					$intFila = $otdCta['fila'];
					$strNaturaleza = $otdCta['naturaleza'];
					$numAntSdo +=  $otdCta['numAntSdo'];
   					$numActSdo += $otdCta['numActSdo'];
					

				}//Cierre de foreach detalles

			}//Cierre de verificación de detalles


			//Asignar datos al array
		$arrDatos['numAntSdo'] = $numAntSdo;
		$arrDatos['numActSdo'] = $numActSdo;
		$arrDatos['fila'] = $intFila;

		//Regresar array con los acumulados de los saldos
		return $arrDatos;
	}


	

	//Método para generar el reporte de balance general
	public function get_balance_gralACTUAL($strTipoArchivo, $lib, $dteFechaInicial, $dteFechaFinal, $intFila = NULL)
	{
		//Variables que se utilizan para asignar acumulados
		$numAntCirculante = 0;
		$numActCirculante = 0;
		$numAntFijo = 0;
		$numActFijo = 0;
		$numAntDiferido = 0;
		$numActDiferido = 0;
		$numAntPasivo = 0;
		$numActPasivo = 0;
		$numAntCapital = 0;
		$numActCapital = 0;



		//Array que contiene los nombres de las cuentas activo circulante
		$CirculanteNombres = Array(1=>"Caja La Barca", 2=>"Caja Penjamo", 3=>"Caja La Piedad",	
								   4=>"Caja Poncitlan",	5=>"Caja Morelia", 6=>"Caja Expo Agrocisa",	
								   7=>"Caja Expo Cnh", 8=>"Bancos",	9=>"Clientes La Barca",	
								   10=>"Clientes Penjamo", 11=>"Clientes La Piedad",	
								   12=>"Clientes Poncitlan", 13=>"Clientes Morelia",	
								   14=>"Clientes Expo Agrocisa", 15=>"Clientes Expo Cnh",	
								   16=>"Socios y Accionistas", 17=>"Deudores Diversos La Barca",	
								   18=>"Funcionarios y Empleados La Barca",	19=>"Funcionarios y Empleados Penjamo",	
								   20=>"Funcionarios y Empleados La Piedad", 21=>"Funcionarios y Empleados Poncitlan",	
								   22=>"Funcionarios y Empleados Morelia", 23=>"Estimacion de Cuentas Incobrables",	
								   24=>"Pagos Anticipados", 25=>"Inventario La Barca",	26=>"Inventario Penjamo",	
								   27=>"Inventario La Piedad", 28=>"Inventario Poncitlan", 29=>"Inventario Morelia",	
								   30=>"Inventario Expo Agrocisa", 31=>"Inventario Expo Cnh",
								   32=>"Estimacion de Inventarios Obsoletos", 33=>"Anticipo A Proveedores",	
								   34=>"Subsidio Al Empleo Global",	35=>"Credito Diesel por aplicar",	
								   36=>"Impuestos a Favor",	37=>"Pagos Provisionales de ISR",	
								   38=>"Iva Acreditable Pagado", 39=>"Ieps Acreditable Pagado",
								   40=>"Iva Por Acreditar La Barca", 41=>"Iva Por Acreditar Penjamo",	
								   42=>"Iva Por Acreditar La Piedad", 43=>"Iva Por Acreditar Poncitlan",	
								   44=>"Iva Por Acreditar Morelia",	45=>"Iva Por Acreditar Expo Agrocisa",	
								   46=>"Iva Por Acreditar Expo Cnh", 47=>"IEPS por acreditar",	
								   48=>"Otros Activos a Corto Plazo",);

		
		//Array que contiene las cuentas activo circulante
		$CirculanteCuentas = Array(1=>"101-01-00-00000", 2=>"101-02-00-00000", 		
								   3=>"101-03-00-00000", 4=>"101-04-00-00000", 		
								   5=>"101-05-00-00000", 6=>"101-06-00-00000", 		
								   7=>"101-07-00-00000", 8=>"102-00-00-00000", 		
								   9=>"105-01-00-00000", 10=>"105-02-00-00000", 		
								   11=>"105-03-00-00000", 12=>"105-04-00-00000", 		
								   13=>"105-05-00-00000", 14=>"105-06-00-00000",		
								   15=>"105-07-00-00000", 16=>"107-01-02-00000", 		
								   17=>"107-01-03-00000", 18=>"107-01-01-00000", 		
								   19=>"107-02-01-00000", 20=>"107-03-01-00000", 		
								   21=>"107-04-01-00000", 22=>"107-05-01-00000", 		
								   23=>"108-00-00-00000", 24=>"109-00-00-00000", 		
								   25=>"115-01-00-00000", 26=>"115-02-00-00000", 		
								   27=>"115-03-00-00000", 28=>"115-04-00-00000",		
								   29=>"115-05-00-00000", 30=>"115-06-00-00000", 		
								   31=>"115-07-00-00000", 32=>"116-00-00-00000", 		
								   33=>"120-00-00-00000", 34=>"110-00-00-00000", 		
								   35=>"111-00-00-00000", 36=>"113-00-00-00000", 		
								   37=>"114-00-00-00000", 38=>"118-01-00-00000|118-02-00-00000", 		
								   39=>"118-03-00-00000", 40=>"119-01-01-00000", 		
								   41=>"119-01-02-00000", 42=>"119-01-03-00000", 		
								   43=>"119-01-04-00000", 44=>"119-01-05-00000", 		
								   45=>"119-01-06-00000", 46=>"119-01-07-00000", 		
								   47=>"119-03-00-00000", 48=>"121-00-00-00000");



		//Array que contiene los nombres de las cuentas activo fijo
		$FijoNombres = Array(1=>"Mobiliario y Equipo De Ofna.",	
							 2=>"Dep. Acum. Equipo De Ofna.",	
							 3=>"Equipo De Transporte",	
							 4=>"Dep. Acum. Equipo De Transporte",
							 5=>"Equipo De Computo",	
							 6=>"Depreciacion Acum Eq. Cómputo",	
							 7=>"Maquinaria y Equipo",	
							 8=>"Depreciacion Acum Maq. Y Equipo");

		//Array que contiene las cuentas activo fijo
		$FijoCuentas = Array(1=>"155-00-00-00000", 2=>"171-04-00-00000", 
							 3=>"154-01-00-00000", 4=>"171-03-00-00000", 
							 5=>"156-00-00-00000", 6=>"171-05-00-00000", 
							 7=>"153-00-00-00000", 8=>"171-02-00-00000");

		//Array que contiene los nombres de las cuentas activo diferido
		$DiferidoNombres = Array(1=>"Gastos Diferidos", 	
								 2=>"Depositos en Garantia");	

		//Array que contiene las cuentas activo diferido
		$DiferidoCuentas = Array(1=>"173-01-01-00000", 
 								 2=>"184-00-00-00000");

		//Array que contiene los nombres de las cuentas pasivo
		$PasivoNombres = Array(1=>"Proveedores La Barca",
								2=>"Proveedores Penjamo",
								3=>"Proveedores La Piedad",
								4=>"Proveedores Poncitlan",
								5=>"Proveedores Morelia",
								6=>"Proveedores Expo Agrocisa",
								7=>"Proveedores Expo Cnh",
								8=>"Proveedores Extranjeros",
								9=>"Creditos Bancarios por Pagar",
								10=>"Cobros Anticipados a Corto Plazo",
								11=>"Acreedores Diversos",
								12=>"Anticipos De Clientes La Barca",
								13=>"Anticipos De Clientes Penjamo",
								14=>"Anticipos De Clientes La Piedad",
								15=>"Anticipos De Clientes Poncitlan",
								16=>"Anticipos De Clientes Morelia",
								17=>"Anticipos De Clientes Expo Agrocisa",
								18=>"Anticipos De Clientes Expo Cnh",
								19=>"Impuestos Trasladados",
								20=>"Iva Trasladado Cobrado",
								21=>"Ieps Trasladado Cobrado",
								22=>"Iva Por Trasladar La Barca",
								23=>"Iva Por Trasladar Penjamo",
								24=>"Iva Por Trasladar La Piedad",
								25=>"Iva Por Trasladar Poncitlan",
								26=>"Iva Por Trasladar Morelia",
								27=>"Iva Por Trasladar Expo Agrocisa",
								28=>"Iva Por Trasladar Expo Cnh",
								29=>"IEPS Por Trasladar",
								30=>"Otros Impuestos por Retener",
								31=>"Sueldos por Pagar",
								32=>"Impuestos Por Pagar La Barca",
								33=>"Impuestos Por Pagar Penjamo",
								34=>"Impuestos Por Pagar La Piedad",
								35=>"Impuestos Por Pagar Poncitlan",
								36=>"Impuestos Por Pagar Morelia",
								37=>"Imss Retenido Cuota Obrera",
								38=>"Pagos Realizados por Cuenta de Terceros",
								39=>"IVA, IEPS e ISR por Pagar",
								40=>"PTU por Pagar");

		//Array que contiene las cuentas pasivo
		$PasivoCuentas = Array(1=>"201-01-01-00000", 		
							   2=>"201-01-02-00000", 		
							   3=>"201-01-03-00000", 		
							   4=>"201-01-04-00000", 		
							   5=>"201-01-05-00000", 		
							   6=>"201-01-06-00000", 		
							   7=>"201-01-07-00000", 		
							   8=>"201-02-00-00000", 		
							   9=>"202-00-00-00000", 		
							   10=>"203-00-00-00000", 		
							   11=>"205-00-00-00000", 		
							   12=>"206-01-00-00000", 		
							   13=>"206-02-00-00000", 		
							   14=>"206-03-00-00000", 		
							   15=>"206-04-00-00000", 		
							   16=>"206-05-00-00000", 		
							   17=>"206-06-00-00000",		
							   18=>"206-07-00-00000", 		
							   19=>"207-00-00-00000", 		
							   20=>"208-01-00-00000", 		
							   21=>"208-02-00-00000", 		
							   22=>"209-01-01-00000", 		
							   23=>"209-01-02-00000",		
							   24=>"209-01-03-00000", 		
							   25=>"209-01-04-00000", 		
							   26=>"209-01-05-00000", 		
							   27=>"209-01-06-00000", 		
							   28=>"209-01-07-00000", 		
							   29=>"209-02-00-00000", 		
							   30=>"209-03-00-00000|209-04-00-00000|209-05-00-00000|209-06-00-00000",		
							   31=>"210-00-00-00000", 		
							   32=>"211-01-01-00000|211-02-01-00000|211-03-01-00000|212-01-01-00000|216-01-01-00000|216-03-01-00000|216-04-01-00000|216-05-00-00000|216-10-01-00000|216-12-01-00000",
							   33=>"211-01-02-00000|211-02-02-00000|211-03-02-00000|212-01-02-00000|216-01-02-00000|216-03-02-00000|216-04-02-00000|216-10-02-00000|216-12-02-00000", 	 		
							   34=>"211-01-03-00000|211-02-03-00000|211-03-03-00000|212-01-03-00000|216-01-03-00000|216-03-03-00000|216-04-03-00000|216-10-03-00000|216-12-03-00000", 	 		
							   35=>"211-01-04-00000|211-02-04-00000|211-03-04-00000|212-01-04-00000|216-01-04-00000|216-03-04-00000|216-04-04-00000|216-10-04-00000|216-12-04-00000", 	 		
							   36=>"211-01-05-00000|211-02-05-00000|211-03-05-00000|212-01-05-00000|216-01-05-00000|216-03-05-00000|216-04-05-00000|216-10-05-00000|216-12-05-00000", 			
							   37=>"216-11-00-00000", 	 		
							   38=>"217-00-00-00000", 			
							   39=>"213-00-00-00000", 	 		
							   40=>"215-00-00-00000");

		//Array que contiene los nombres de las cuentas capital
		$CapitalNombres = Array(1=>"Capital Social Fijo",
								2=>"Capital Social Variable",
								3=>"Aportaciones para Futuros Aumentos de Capital",
								4=>"Resultado Ejercicios Anteriores");

		//Array que contiene las cuentas capital
		$CapitalCuentas = Array(1=>"301-01-00-00000",
								2=>"301-02-00-00000",
								3=>"301-03-00-00000",
								4=>"304-00-00-00000");


		//Asignar posición de la abscisa 
		$intPosX = 12;
		$intPosXTitulo = 10;


		/**********************************************
		**ACTIVO CIRCULANTE
		***********************************************/
		$arrDatos = array('ACTIVO');
	    $intFila = $this->get_registro($strTipoArchivo, $lib, $arrDatos, $intFila);

	    $arrDatos = array('CIRCULANTE');
	    $intFila = $this->get_registro($strTipoArchivo, $lib, $arrDatos, $intFila);

	    //Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'DEUDORA', 
									    $CirculanteCuentas, $CirculanteNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX);
	 	$intFila = $otdCta['fila'];
	 	$numAntCirculante =  $otdCta['numAntSdo'];
	    $numActCirculante = $otdCta['numActSdo'];

	    //Calcular saldo final acumulado
		$numSdoFinal = ($numAntCirculante + $numActCirculante);

		//Hacer un llamado a la función para escribir totales
	   $intFila = $this->get_total('TOTAL CIRCULANTE', $numAntCirculante,  $numActCirculante, $numSdoFinal, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL');


	 	

		/**********************************************
		**ACTIVO FIJO
		***********************************************/
		$arrDatos = array('FIJO');
	    $intFila = $this->get_registro($strTipoArchivo, $lib, $arrDatos, $intFila, $intPosXTitulo);
		//Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'DEUDORA', 
									    $FijoCuentas, $FijoNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX);
	 	$intFila = $otdCta['fila'];
	 	$numAntFijo =  $otdCta['numAntSdo'];
	    $numActFijo = $otdCta['numActSdo'];

	    //Calcular saldo final acumulado
		$numSdoFinal = ($numAntFijo + $numActFijo);

		//Hacer un llamado a la función para escribir totales
		$intFila = $this->get_total('TOTAL FIJO', $numAntFijo,  $numActFijo, $numSdoFinal, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL');


		/**********************************************
		**ACTIVO DIFERIDO
		***********************************************/
		$arrDatos = array('DIFERIDO');
	    $intFila = $this->get_registro($strTipoArchivo, $lib, $arrDatos, $intFila, $intPosXTitulo);
		//Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'DEUDORA', 
									    $DiferidoCuentas, $DiferidoNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX);
	 	$intFila = $otdCta['fila'];
	 	$numAntDiferido =  $otdCta['numAntSdo'];
	    $numActDiferido = $otdCta['numActSdo'];

	    //Calcular saldo final acumulado
		$numSdoFinal = ($numAntDiferido + $numActDiferido);

		//Hacer un llamado a la función para escribir totales
		$intFila = $this->get_total('TOTAL DIFERIDO', $numAntDiferido,  $numActDiferido, $numSdoFinal, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL');


	
	   /**********************************************
		**SUMA DEL ACTIVO
		***********************************************/
		//Calcular total activo
		$numAntTotalAct = ($numAntCirculante + $numAntFijo + $numAntDiferido);
		$numActTotalAct = ($numActCirculante + $numActFijo + $numActDiferido);
		$numSdoFinalTotalAct = ($numAntTotalAct + $numActTotalAct);

		//Hacer un llamado a la función para escribir utilidad bruta
	    $intFila = $this->get_total('SUMA DEL ACTIVO', $numAntTotalAct,  $numActTotalAct, $numSdoFinalTotalAct, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL');


		
		/**********************************************
		**PASIVO Y CAPITAL
		***********************************************/
		$arrDatos = array('PASIVO');
	    $intFila = $this->get_registro($strTipoArchivo, $lib, $arrDatos, $intFila, $intPosXTitulo);
	    /**********************************************
		**PASIVO 
		***********************************************/
		$arrDatos = array('CIRCULANTE');
	    $intFila = $this->get_registro($strTipoArchivo, $lib, $arrDatos, $intFila, $intPosXTitulo);
		//Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'ACREEDORA', 
									    $PasivoCuentas, $PasivoNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX);
	 	$intFila = $otdCta['fila'];
	 	$numAntPasivo =  $otdCta['numAntSdo'];
	    $numActPasivo = $otdCta['numActSdo'];

	    //Calcular saldo final acumulado
		$numSdoFinal = ($numAntPasivo + $numActPasivo);

		//Hacer un llamado a la función para escribir totales
		$intFila = $this->get_total('TOTAL CIRCULANTE', $numAntPasivo,  $numActPasivo, $numSdoFinal, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL');



		/**********************************************
		** SUMA DEL PASIVO
		***********************************************/
		//Hacer un llamado a la función para escribir total del pasivo
	    $intFila = $this->get_total('SUMA DEL PASIVO', $numAntPasivo,  $numActPasivo, $numSdoFinal, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL');



		/**********************************************
		**CAPITAL 
		***********************************************/
		$arrDatos = array('CAPITAL');
	    $intFila = $this->get_registro($strTipoArchivo, $lib, $arrDatos, $intFila, $intPosXTitulo);
		//Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'ACREEDORA', 
									    $CapitalCuentas, $CapitalNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX);
	 	$intFila = $otdCta['fila'];
	 	$numAntCapital =  $otdCta['numAntSdo'];
	    $numActCapital = $otdCta['numActSdo'];

	    //Calcular saldo final acumulado
		$numSdoFinalCapital = ($numAntCapital + $numActCapital);

		//Hacer un llamado a la función para escribir total de capital
	    $intFila = $this->get_total('TOTAL CAPITAL', $numAntCapital,  $numActCapital, $numSdoFinalCapital, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL');



		
		/**********************************************
		**UTILIDAD O (PERDIDA) DEL EJERCICIO
		***********************************************/
		//Calcular utilidad 
	    $numAntUtilidad = ($numAntCirculante + $numAntFijo + $numAntDiferido - $numAntPasivo - $numAntCapital);
		$numActUtilidad = ($numActCirculante + $numActFijo + $numActDiferido - $numActPasivo - $numActCapital);
		$numSdoFinalUtilidad = ($numAntUtilidad + $numActUtilidad);
	

		//Hacer un llamado a la función para escribir utilidad
	    $intFila = $this->get_total('UTILIDAD O (PERDIDA) DEL EJERCICIO', $numAntUtilidad,  $numActUtilidad, $numSdoFinalUtilidad, 
							        $strTipoArchivo, $lib, $intFila, $intPosX);


	    /**********************************************
		** SUMA DEL CAPITAL
		***********************************************/
	    //Calcular suma del capital 
	    $numAntSumCapital = ($numAntCapital + $numAntUtilidad);
		$numActSumCapital = ($numActCapital + $numActUtilidad);
		$numSdoFinalSumCapital = ($numAntSumCapital + $numActSumCapital);

	    //Hacer un llamado a la función para escribir total
	    $intFila = $this->get_total('SUMA DEL CAPITAL', $numAntSumCapital,  $numActSumCapital, $numSdoFinalSumCapital, 
							        $strTipoArchivo, $lib, $intFila, $intPosX);


	   
	    /**********************************************
		** SUMA DEL PASIVO Y CAPITAL
		***********************************************/
		//Calcular total 
		$numAntTemp = ($numAntPasivo + $numAntSumCapital);
		$numActTemp = ($numActPasivo + $numActSumCapital);
		$numSdoFinalTemp = ($numAntTemp + $numActTemp);
	

		//Hacer un llamado a la función para escribir total
	    $intFila = $this->get_total('SUMA DEL PASIVO Y CAPITAL', $numAntTemp,  $numActTemp, $numSdoFinalTemp, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL');


		//Regresar indice de la fila
		return $intFila;


	}

	//Método para generar el reporte de estado de resultados global
	public function get_estado_resultados_gralACT($strTipoArchivo, $lib, $dteFechaInicial, $dteFechaFinal, $intFila = NULL)
	{

		//Variables que se utilizan para asignar acumulados
		$numAntVentas = 0;
		$numActVentas = 0;
		$numAntDev = 0;
		$numActDev = 0;
		$numAntProdFinanciero = 0;
	    $numActProdFinanciero = 0;
		$numAntCostos = 0;
		$numActCostos = 0;
		$numAntGastos = 0;
		$numActGastos = 0;
		$numAntGasAdmin = 0;
		$numActGasAdmin = 0;
		$numAntGasFin = 0;
		$numActGasFin = 0;

		//Array que contiene los nombres de las cuentas ventas
	    $VentasNombres = Array(1=>"VENTAS LA BARCA", 2=>"VENTAS PENJAMO",
							   3=>"VENTAS LA PIEDAD", 4=>"VENTAS PONCITLAN",
							   5=>"VENTAS MORELIA", 6=>"VENTAS EXPO AGROCISA",
							   7=>"VENTAS EXPO CNH");

	    //Array que contiene las cuentas ventas
		$VentasCuentas = Array(1=>"401-01-00-00000|403-01-01-00000",	
							   2=>"401-02-00-00000|403-01-02-00000",	
							   3=>"401-03-00-00000|403-01-03-00000",	
							   4=>"401-04-00-00000|403-01-04-00000",	
							   5=>"401-05-00-00000|403-01-05-00000",	
							   6=>"401-06-00-00000|403-01-06-00000",	
							   7=>"401-07-00-00000|403-01-07-00000");

		//Array que contiene los nombres de las cuentas devolución
		$DevNombres = Array(1=>"DEVOLUCIONES SOBRE VENTAS LA BARCA",
							2=>"DESCUENTOS SOBRE VENTAS LA BARCA",
							3=>"DEVOLUCIONES SOBRE VENTAS PENJAMO",
							4=>"DESCUENTOS SOBRE VENTAS PENJAMO",
							5=>"DEVOLUCIONES SOBRE VENTAS LA PIEDAD",
							6=>"DESCUENTOS SOBRE VENTAS LA PIEDAD",
							7=>"DEVOLUCIONES SOBRE VENTAS PONCITLAN",
							8=>"DESCUENTOS SOBRE VENTAS PONCITLAN",
							9=>"DEVOLUCIONES SOBRE VENTAS MORELIA",
							10=>"DESCUENTOS SOBRE VENTAS MORELIA",
							11=>"DEVOLUCIONES SOBRE VENTAS EXPO AGROCISA",
							12=>"DESCUENTOS SOBRE VENTAS EXPO AGROCISA",
							13=>"DEVOLUCIONES SOBRE VENTAS EXPO CNH",
							14=>"DESCUENTOS SOBRE VENTAS EXPO CNH");

		//Array que contiene las cuentas devolución
		$DevCuentas = Array(1=>"402-01-01-00000|402-01-02-00000",	
							2=>"402-01-03-00000|402-01-04-00000",	
							3=>"402-02-01-00000|402-02-02-00000",	
							4=>"402-02-03-00000|402-02-04-00000",	
							5=>"402-03-01-00000|402-03-02-00000",	
							6=>"402-03-03-00000|402-03-04-00000",	
							7=>"402-04-01-00000|402-04-02-00000",	
							8=>"402-04-03-00000|402-04-04-00000",	
							9=>"402-05-01-00000|402-05-02-00000",	
							10=>"402-05-03-00000|402-05-04-00000",	
							11=>"402-06-01-00000|402-06-02-00000",	
							12=>"402-06-03-00000|402-06-04-00000",	
							13=>"402-07-01-00000|402-07-02-00000",	
							14=>"402-07-03-00000|402-07-04-00000");

		//Array que contiene los nombres de las cuentas productos financieros
		$ProdFinancierosNombres = Array(1=>"PRODUCTOS FINANCIEROS LA BARCA",
									    2=>"PRODUCTOS FINANCIEROS PENJAMO",
									    3=>"PRODUCTOS FINANCIEROS LA PIEDAD",
									    4=>"PRODUCTOS FINANCIEROS PONCITLAN",
									    5=>"PRODUCTOS FINANCIEROS MORELIA");

		//Array que contiene las cuentas productos financieros
		$ProdFinancieroCuentas = Array(1=>"702-01-00-00000",
									   2=>"702-02-00-00000",
									   3=>"702-03-00-00000",
									   4=>"702-04-00-00000",
									   5=>"702-05-00-00000");


		 //Array que contiene los nombres de las cuentas costos
		$CostosNombres = Array(1=>"COSTO DE LO VENDIDO LA BARCA",
							   2=>"COSTO DE LO VENDIDO PENJAMO",
							   3=>"COSTO DE LO VENDIDO LA PIEDAD",
							   4=>"COSTO DE LO VENDIDO PONCITLAN",
							   5=>"COSTO DE LO VENDIDO MORELIA", 
							   6=>"COSTO DE LO VENDIDO EXPO AGROCISA", 
							   7=>"COSTO DE LO VENDIDO EXPO CNH");

		//Array que contiene las cuentas costos
		$CostosCuentas = Array(1=>"501-01-01-00000|503-01-00-00000",	
							   2=>"501-01-02-00000|503-02-00-00000",	
							   3=>"501-01-03-00000|503-03-00-00000",	
							   4=>"501-01-04-00000|503-04-00-00000",	
							   5=>"501-01-05-00000|503-05-00-00000", 
							   6=>"501-01-06-00000",
							   7=>"501-01-07-00000");

		//Array que contiene los nombres de las cuentas gastos de operación
		$GastosOperNombres = Array(1=>"GASTOS DE VENTA LA BARCA",                          
								   2=>"GASTOS DE VENTA PENJAMO",
								   3=>"GASTOS DE VENTA LA PIEDAD",
								   4=>"GASTOS DE VENTA PONCITLAN",
								   5=>"GASTOS DE VENTA MORELIA");

		//Array que contiene las cuentas gastos de operación
		$GastosOperCuentas = Array(1=>"602-01-00-00000",
								   2=>"602-02-00-00000",
								   3=>"602-03-00-00000",
								   4=>"602-04-00-00000",
								   5=>"602-05-00-00000");

		//Array que contiene los nombres de las cuentas gastos administrativos
		$GastosAdmonNombres = Array(1=>"GASTOS ADMINISTRATIVOS LA BARCA",                  
									2=>"GASTOS ADMINISTRATIVOS PENJAMO",
									3=>"GASTOS ADMINISTRATIVOS LA PIEDAD",
									4=>"GASTOS ADMINISTRATIVOS PONCITLAN",
									5=>"GASTOS ADMINISTRATIVOS MORELIA",
									6=>"GASTOS ADMINISTRATIVOS CORPORATIVO");

		//Array que contiene las cuentas gastos administrativos
		$GastosAdmonCuentas = Array(1=>"603-01-00-00000",
									2=>"603-02-00-00000",
									3=>"603-03-00-00000",
									4=>"603-04-00-00000",
									5=>"603-05-00-00000",
									6=>"603-10-00-00000");

		//Array que contiene los nombres de las cuentas gastos financieros
		$GastosFinNombres = Array(1=>"GASTOS FINANCIEROS LA BARCA",
								  2=>"GASTOS FINANCIEROS PENJAMO",                        
								  3=>"GASTOS FINANCIEROS LA PIEDAD",
								  4=>"GASTOS FINANCIEROS PONCITLAN",
								  5=>"GASTOS FINANCIEROS MORELIA");

		//Array que contiene las cuentas gastos financieros
		$GastosFinCuentas = Array(1=>"701-01-00-00000",
								  2=>"701-02-00-00000",
							      3=>"701-03-00-00000",
								  4=>"701-04-00-00000",
								  5=>"701-05-00-00000");

		//Array que contiene los nombres de las cuentas otros gastos
		$GastosOtrNombres = Array(1=>"OTROS GASTOS",);

		//Array que contiene las cuentas otros gastos
		$GastosOtrCuentas = Array(1=>"703-00-00-00000");

	     //Array que contiene los nombres de las cuentas otros productos
		$ProdOtrNombres = Array(1=>"OTROS PRODUCTOS");

		//Array que contiene las cuentas otros productos
		$ProdOtrCuentas = Array(1=>"704-00-00-00000");


		//Array que contiene los nombres de las cuentas ISR
		$IsrNombres = Array(1=>"ISR ANUAL");

		//Array que contiene las cuentas ISR
		$IsrCuentas = Array(1=>"611-00-00-00000");

		//Array que contiene los nombres de las cuentas DEPRECIACIONES CONTABLES
		$DepreContNombres = Array(1=>"DEPRECIACIONES CONTABLES");

		//Array que contiene las cuentas DEPRECIACIONES CONTABLES
		$DepreContCuentas = Array(1=>"613-00-00-00000");



		//Asignar posición de la abscisa 
		$intPosX = 12;
		$intPosXTitulo = 10;

		/**********************************************
		**VENTAS GENERALES
		***********************************************/
		$arrDatos = array('INGRESOS');
	    $intFila = $this->get_registro($strTipoArchivo, $lib, $arrDatos, $intFila);

	    //Hacer un llamado a la función para escribir los datos de las cuentas
  		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 
  										'ACREEDORA', $VentasCuentas);
  		$numAntVentas =  $otdCta['numAntSdo'];
	    $numActVentas = $otdCta['numActSdo'];

		///Calcular saldo final
		$numFinalVtas = ($numAntVentas + $numActVentas);

		/**********************************************
		**VENTAS NETAS
		***********************************************/
		//Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'ACREEDORA', 
									    $VentasCuentas, $VentasNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX, NULL, $numAntVentas, $numActVentas, $numFinalVtas);

		//Asignar indice de la fila para escribir el siguiente regsitro
	 	$intFila = $otdCta['fila'];

	   //Hacer un llamado a la función para escribir totales
	   $intFila = $this->get_total('TOTAL DE VENTAS CORPORATIVO', $numAntVentas,  $numActVentas, $numFinalVtas, 
							      $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL',  NULL, 100, 100, 100);


	   /**********************************************
		**DEVOLUCIONES
		***********************************************/
		//Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'DEUDORA', 
									    $DevCuentas, $DevNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX, '', $numAntVentas, $numActVentas, $numFinalVtas);
	   $intFila = $otdCta['fila'];
	   $numAntDev =  $otdCta['numAntSdo'];
	   $numActDev = $otdCta['numActSdo'];
	   ///Calcular saldo final
	   $numSdoFinal = ($numAntDev + $numActDev);


		//Variables que se utilizan para asignar el porcentaje de ventas
	    $intPorcSdoAnterior = $this->get_porcentaje_vtas($numAntDev, $numAntVentas);
	    $intPorcMovMes =  $this->get_porcentaje_vtas($numActDev, $numActVentas);
	    $intPorcSdoFinal = $this->get_porcentaje_vtas($numSdoFinal, $numFinalVtas);

	    //Hacer un llamado a la función para escribir totales
		$intFila = $this->get_total('TOTAL DE DEVOLUCIONES Y DESCUENTOS S/VENTAS', $numAntDev,  $numActDev, $numSdoFinal, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL',  NULL, $intPorcSdoAnterior,  
							        $intPorcMovMes, $intPorcSdoFinal);


		/**********************************************
		** TOTAL VENTAS NETAS
		***********************************************/
		//Calcular total de ventas
		$numAntTotalVta = ($numAntVentas - $numAntDev);
		$numActTotalVta = ($numActVentas - $numActDev);
		$numSdoFinalTotalVta = ($numAntVentas + $numActVentas - $numAntDev - $numActDev);

		//Variables que se utilizan para asignar el porcentaje de ventas
	    $intPorcSdoAnterior = $this->get_porcentaje_vtas($numAntTotalVta, $numAntVentas);
	    $intPorcMovMes =  $this->get_porcentaje_vtas($numActTotalVta, $numActVentas);
	    $intPorcSdoFinal = $this->get_porcentaje_vtas($numSdoFinalTotalVta, $numFinalVtas);

		//Hacer un llamado a la función para escribir total
	    $intFila = $this->get_total('TOTAL VENTAS NETAS', $numAntTotalVta,  $numActTotalVta, $numSdoFinalTotalVta, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL',  NULL, $intPorcSdoAnterior,  
							        $intPorcMovMes, $intPorcSdoFinal);

	    /**********************************************
		**PRODUCTOS FINANCIEROS
		***********************************************/
		//Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'ACREEDORA', 
									    $ProdFinancieroCuentas, $ProdFinancierosNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX, NULL, $numAntVentas, $numActVentas, $numFinalVtas);
	   $intFila = $otdCta['fila'];
	   $numAntProdFinanciero =  $otdCta['numAntSdo'];
	   $numActProdFinanciero = $otdCta['numActSdo'];
	   ///Calcular saldo final
	   $numSdoFinal = ($numAntProdFinanciero + $numActProdFinanciero);


		//Variables que se utilizan para asignar el porcentaje de ventas
	    $intPorcSdoAnterior = $this->get_porcentaje_vtas($numAntProdFinanciero, $numAntVentas);
	    $intPorcMovMes =  $this->get_porcentaje_vtas($numActProdFinanciero, $numActVentas);
	    $intPorcSdoFinal = $this->get_porcentaje_vtas($numSdoFinal, $numFinalVtas);

	    //Hacer un llamado a la función para escribir totales
		$intFila = $this->get_total('TOTAL DE PRODUCTOS FINANCIEROS', $numAntProdFinanciero,  $numActProdFinanciero, $numSdoFinal, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL',  NULL, $intPorcSdoAnterior,  
							        $intPorcMovMes, $intPorcSdoFinal);

		/**********************************************
		**TOTAL DE INGRESOS CORPORATIVOS
		***********************************************/
		//Calcular total de ingresos
		$numAntTotalIng = ($numAntTotalVta + $numAntProdFinanciero);
		$numActTotalIng = ($numActTotalVta + $numActProdFinanciero);
		$numSdoFinalTotalIng = ($numAntTotalVta + $numActTotalVta + $numAntProdFinanciero + $numActProdFinanciero);

		//Variables que se utilizan para asignar el porcentaje de ventas
	    $intPorcSdoAnterior = $this->get_porcentaje_vtas($numAntTotalIng, $numAntVentas);
	    $intPorcMovMes =  $this->get_porcentaje_vtas($numActTotalIng, $numActVentas);
	    $intPorcSdoFinal = $this->get_porcentaje_vtas($numSdoFinalTotalIng, $numFinalVtas);

		//Hacer un llamado a la función para escribir total
	    $intFila = $this->get_total('TOTAL DE INGRESOS CORPORATIVOS', $numAntTotalIng,  $numActTotalIng, $numSdoFinalTotalIng, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL', NULL, $intPorcSdoAnterior,  
							        $intPorcMovMes, $intPorcSdoFinal);



	   /**********************************************
		**COSTO DE VENTAS
		***********************************************/
		//Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'DEUDORA', 
									    $CostosCuentas, $CostosNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX, NULL, $numAntVentas, $numActVentas, $numFinalVtas);
	   $intFila = $otdCta['fila'];
	   $numAntCostos =  $otdCta['numAntSdo'];
	   $numActCostos = $otdCta['numActSdo'];

		///Calcular saldo final
		$numSdoFinal = ($numAntCostos + $numActCostos);

		//Variables que se utilizan para asignar el porcentaje de ventas
	    $intPorcSdoAnterior = $this->get_porcentaje_vtas($numAntCostos, $numAntVentas);
	    $intPorcMovMes =  $this->get_porcentaje_vtas($numActCostos, $numActVentas);
	    $intPorcSdoFinal = $this->get_porcentaje_vtas($numSdoFinal, $numFinalVtas);

		//Hacer un llamado a la función para escribir totales
		$intFila = $this->get_total('TOTAL DE COSTO DE LO VENDIDO', $numAntCostos,  $numActCostos, $numSdoFinal, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL',  NULL, $intPorcSdoAnterior,  
							        $intPorcMovMes, $intPorcSdoFinal);

	   /**********************************************
		** UTILIDAD BRUTA
		***********************************************/
		//Calcular utilidad
		$numAntUtilidadBta = ($numAntTotalIng - $numAntCostos);
		$numActUtilidadBta = ($numActTotalIng - $numActCostos);
		$numSdoFinalUtilidadBta = ($numAntTotalIng + $numActTotalIng - $numAntCostos - $numActCostos);

		//Variables que se utilizan para asignar el porcentaje de ventas
	    $intPorcSdoAnterior = $this->get_porcentaje_vtas($numAntUtilidadBta, $numAntVentas);
	    $intPorcMovMes =  $this->get_porcentaje_vtas($numActUtilidadBta, $numActVentas);
	    $intPorcSdoFinal = $this->get_porcentaje_vtas($numSdoFinalUtilidadBta, $numFinalVtas);

		//Hacer un llamado a la función para escribir utilidad bruta
	    $intFila = $this->get_total('UTILIDAD BRUTA', $numAntUtilidadBta,  $numActUtilidadBta, $numSdoFinalUtilidadBta, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL',  NULL, $intPorcSdoAnterior,  
							        $intPorcMovMes, $intPorcSdoFinal);


	    /**********************************************
		**GASTOS DE OPERACION
		***********************************************/
	    $arrDatos = array('GASTOS DE OPERACION');
	    $intFila = $this->get_registro($strTipoArchivo, $lib, $arrDatos, $intFila, $intPosXTitulo);
		//Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'DEUDORA', 
									    $GastosOperCuentas,  $GastosOperNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX, 'PORCENTAJE', $numAntVentas, $numActVentas, $numFinalVtas);
	   $intFila = $otdCta['fila'];
	   $numAntGastos =  $otdCta['numAntSdo'];
	   $numActGastos = $otdCta['numActSdo'];

		///Calcular saldo final
		$numSdoFinal = ($numAntGastos + $numActGastos);

		//Variables que se utilizan para asignar el porcentaje de ventas
	    $intPorcSdoAnterior = $this->get_porcentaje_vtas($numAntGastos, $numAntVentas);
	    $intPorcMovMes =  $this->get_porcentaje_vtas($numActGastos, $numActVentas);
	    $intPorcSdoFinal = $this->get_porcentaje_vtas($numSdoFinal, $numFinalVtas);

		//Hacer un llamado a la función para escribir totales
		$intFila = $this->get_total('TOTAL DE GASTOS DE VENTA', $numAntGastos,  $numActGastos, $numSdoFinal, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL',  NULL, $intPorcSdoAnterior,  
							        $intPorcMovMes, $intPorcSdoFinal);



	   /**********************************************
		**GASTOS ADMINISTRATIVOS
		***********************************************/
		//Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'DEUDORA', 
									    $GastosAdmonCuentas,  $GastosAdmonNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX, NULL, $numAntVentas, $numActVentas, $numFinalVtas);
	   $intFila = $otdCta['fila'];
	   $numAntGasAdmin =  $otdCta['numAntSdo'];
	   $numActGasAdmin = $otdCta['numActSdo'];

		///Calcular saldo final
		$numSdoFinal = ($numAntGasAdmin + $numActGasAdmin);

		//Variables que se utilizan para asignar el porcentaje de ventas
	    $intPorcSdoAnterior = $this->get_porcentaje_vtas($numAntGasAdmin, $numAntVentas);
	    $intPorcMovMes =  $this->get_porcentaje_vtas($numActGasAdmin, $numActVentas);
	    $intPorcSdoFinal = $this->get_porcentaje_vtas($numSdoFinal, $numFinalVtas);

		//Hacer un llamado a la función para escribir totales
		$intFila = $this->get_total('TOTAL GASTOS ADMINISTRATIVOS', $numAntGasAdmin,  $numActGasAdmin, $numSdoFinal, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL',  NULL, $intPorcSdoAnterior,  
							        $intPorcMovMes, $intPorcSdoFinal);


 		/**********************************************
		**GASTOS FINANCIEROS
		***********************************************/
		//Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'DEUDORA', 
									    $GastosFinCuentas,  $GastosFinNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX, NULL, $numAntVentas, $numActVentas, $numFinalVtas);
	   $intFila = $otdCta['fila'];
	   $numAntGasFin =  $otdCta['numAntSdo'];
	   $numActGasFin = $otdCta['numActSdo'];

		///Calcular saldo final
		$numSdoFinal = ($numAntGasFin + $numActGasFin);

		//Variables que se utilizan para asignar el porcentaje de ventas
	    $intPorcSdoAnterior = $this->get_porcentaje_vtas($numAntGasFin, $numAntVentas);
	    $intPorcMovMes =  $this->get_porcentaje_vtas($numActGasFin, $numActVentas);
	    $intPorcSdoFinal = $this->get_porcentaje_vtas($numSdoFinal, $numFinalVtas);

		//Hacer un llamado a la función para escribir totales
		$intFila = $this->get_total('TOTAL GASTOS FINANCIEROS', $numAntGasFin,  $numActGasFin, $numSdoFinal, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL',  NULL, $intPorcSdoAnterior,  
							        $intPorcMovMes, $intPorcSdoFinal);




		/**********************************************
		**TOTAL DE GASTOS DE OPERACIÓN
		***********************************************/
		//Calcular total de gastos
		$numAntTotalGas = ($numAntGastos + $numAntGasAdmin + $numAntGasFin);
		$numActTotalGas = ($numActGastos + $numActGasAdmin + $numActGasFin );
		$numSdoFinalTotalGas = ($numAntGastos + $numActGastos + $numAntGasAdmin + $numActGasAdmin + $numAntGasFin + $numActGasFin);

		//Variables que se utilizan para asignar el porcentaje de ventas
	    $intPorcSdoAnterior = $this->get_porcentaje_vtas($numAntTotalGas, $numAntVentas);
	    $intPorcMovMes =  $this->get_porcentaje_vtas($numActTotalGas, $numActVentas);
	    $intPorcSdoFinal = $this->get_porcentaje_vtas($numSdoFinalTotalGas, $numFinalVtas);

		//Hacer un llamado a la función para escribir total
	    $intFila = $this->get_total('TOTAL DE GASTOS DE OPERACIÓN CORPORATIVO', $numAntTotalGas,  $numActTotalGas, $numSdoFinalTotalGas, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL',  NULL, $intPorcSdoAnterior,  
							        $intPorcMovMes, $intPorcSdoFinal);


	    /**********************************************
		**OTROS GASTOS
		***********************************************/
		//Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'DEUDORA', 
									    $GastosOtrCuentas,  $GastosOtrNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX, NULL, $numAntVentas, $numActVentas, $numFinalVtas);
	   $intFila = $otdCta['fila'];
	   $numAntGasOtr =  $otdCta['numAntSdo'];
	   $numActGasOtr = $otdCta['numActSdo'];


	    /**********************************************
		**OTROS PRODUCTOS
		***********************************************/
		//Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'ACREEDORA', 
									    $ProdOtrCuentas,  $ProdOtrNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX, NULL, $numAntVentas, $numActVentas, $numFinalVtas);
	   $intFila = $otdCta['fila'];
	   $numAntProdOtr =  $otdCta['numAntSdo'];
	   $numActProdOtr = $otdCta['numActSdo'];


	   /**********************************************
		** UTILIDAD O PERDIDA ANTES DE IMPUESTOS
		***********************************************/
		//Calcular utilidad 
		$numAntUtilidadPerdida = ($numAntUtilidadBta - $numAntTotalGas - $numAntGasOtr +  $numAntProdOtr);
		$numActUtilidadPerdida = ($numActUtilidadBta - $numActTotalGas - $numActGasOtr +  $numActProdOtr );
		$numSdoFinalUtilidadPerdida = ($numAntUtilidadBta + $numActUtilidadBta - $numAntTotalGas - $numActTotalGas - $numAntGasOtr - 
									   $numActGasOtr + $numAntProdOtr + $numActProdOtr);

		//Hacer un llamado a la función para escribir utilidad 
	    $intFila = $this->get_total('UTILIDAD O PERDIDA ANTES DE IMPUESTOS', $numAntUtilidadPerdida,  $numActUtilidadPerdida, $numSdoFinalUtilidadPerdida, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL',  NULL, $intPorcSdoAnterior,  
							        $intPorcMovMes, $intPorcSdoFinal);


	    /**********************************************
		**ISR
		***********************************************/
		//Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'DEUDORA', 
									    $IsrCuentas,  $IsrNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX, NULL, $numAntVentas, $numActVentas, $numFinalVtas);
	   $intFila = $otdCta['fila'];
	   $numAntIsr =  $otdCta['numAntSdo'];
	   $numActIsr = $otdCta['numActSdo'];


	    /**********************************************
		**ISR
		***********************************************/
		//Hacer un llamado a la función para escribir los datos de las cuentas
		$otdCta = $this->get_datos_ctas($dteFechaInicial, $dteFechaFinal, 'DEUDORA', 
									    $DepreContCuentas,  $DepreContNombres,  $strTipoArchivo, $lib,
										$intFila, $intPosX, NULL, $numAntVentas, $numActVentas, $numFinalVtas);
	   $intFila = $otdCta['fila'];
	   $numAntDepreCont =  $otdCta['numAntSdo'];
	   $numActDepreCont = $otdCta['numActSdo'];


		/**********************************************
		** UTILIDAD O PERDIDA NETA DEL PERIODO
		***********************************************/
		//Calcular utilidad 
		$numAntUtilidadPeriodo = ($numAntUtilidadPerdida - $numAntIsr - $numAntDepreCont);
		$numActUtilidadPeriodo = ($numActUtilidadPerdida - $numActIsr - $numActDepreCont);
		$numSdoFinalUtilidadPeriodo = ($numAntUtilidadPerdida + $numActUtilidadPerdida - $numAntIsr - $numActIsr - $numAntDepreCont - $numActDepreCont);

		//Variables que se utilizan para asignar el porcentaje de ventas
	    $intPorcSdoAnterior = $this->get_porcentaje_vtas($numAntUtilidadPeriodo, $numAntVentas);
	    $intPorcMovMes =  $this->get_porcentaje_vtas($numActUtilidadPeriodo, $numActVentas);
	    $intPorcSdoFinal = $this->get_porcentaje_vtas($numSdoFinalUtilidadPeriodo, $numFinalVtas);

		//Hacer un llamado a la función para escribir utilidad 
	    $intFila = $this->get_total('UTILIDAD O PERDIDA NETA DEL PERIODO', $numAntUtilidadPeriodo,  $numActUtilidadPeriodo, $numSdoFinalUtilidadPeriodo, 
							        $strTipoArchivo, $lib, $intFila, $intPosX, 'TOTAL',  NULL, $intPorcSdoAnterior,  
							        $intPorcMovMes, $intPorcSdoFinal);


	   

	     //Regresar indice de la fila
          return  $intFila;

	}

		//Función que se utiliza para escribir los datos de la(s) cuenta(s) 
	public function get_datos_ctas_rep($dteFechaInicial, $dteFechaFinal, $strNaturaleza = NULL,
							      $arrCuentas = NULL,  $arrCuentasNombres = NULL, 
	 							  $strTipoArchivo = NULL, $lib = NULL, $intFila = NULL,  $intPosX = NULL, 
	 							  $strTiposReporte = NULL, $numAntVentas = NULL, $numActVentas = NULL, $numFinalVtas= NULL)
	{

		//Array que se utiliza para enviar datos
		$arrDatos = array('numAntSdo' => '0.00',
						  'numActSdo' => '0.00',
						  'naturaleza' => '',
						  'fila' => 0);


		 //Variable que se utiliza par asignar el saldo anterior (de las cuentas)
		  $intSdoAnterior = 0;
		  //Variable que se utiliza para asignar el saldo actual (de las cuentas)
		   $intMovMes =  0;
		  //Variable que se utiliza para asignar el saldo final (de las cuentas)
		   $intSdoFinal =  0;
		   //Variable que se utiliza para asignar la naturaleza de las cuentas (por agrupador)
		   $strNaturalezaCta = '';

		   	//Seleccionar los saldos de la cuenta contable
  			$otdSaldosCta = $this->cuentas->buscar_saldos_ctas_estados_financierosAct($dteFechaInicial, $dteFechaFinal,
  													  						 		  $arrCuentas, $strNaturaleza)[0];

  		   $intSdoAnterior = $otdSaldosCta->saldo_anterior;
		   $intMovMes = $otdSaldosCta->movimientos;
		   $intSdoFinal = $otdSaldosCta->saldo_final;
		   $strNaturalezaCta = $otdSaldosCta->naturaleza;
			

		   if($strTipoArchivo != NULL)
		   {

		   	  //Si el tipo de reporte tiene las columnas de porcentajes '%'
			   if($strTiposReporte == 'PORCENTAJE')
			   {
			   	  //Variables que se utilizan para asignar el porcentaje de ventas
				   $intPorcSdoAnterior = $this->get_porcentaje_vtas($intSdoAnterior, $numAntVentas);
				   $intPorcMovMes =  $this->get_porcentaje_vtas($intMovMes, $numActVentas);
				   $intPorcSdoFinal = $this->get_porcentaje_vtas($intSdoFinal, $numFinalVtas);

			   }
		 

			   //Array que contiene la información del registro
			   $arrDatos = array();
			   $arrDatos[] = (($strTipoArchivo == 'PDF') ?  utf8_decode($arrCuentasNombres) :  $arrCuentasNombres); 
			   $arrDatos[] =   number_format($intSdoAnterior, 0, '.', ',');

			  // $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intSdoAnterior, 0, '.', ',') : $intSdoAnterior);

			   //Si el tipo de reporte tiene las columnas de porcentajes '%'
			  /* if($strTiposReporte == 'PORCENTAJE')
			   {
			   	  $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intPorcSdoAnterior, 1, '.', ',') : $intPorcSdoAnterior);
			   }
			   else
			   {
			   	 $arrDatos[] = '';
			   }
			  */

			  // $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intMovMes, 0, '.', ',') : $intMovMes);

			   //  $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intMovMes, 0, '.', ',') : $intMovMes);
			    $arrDatos[] =   number_format($intMovMes, 0, '.', ',');

			   //Si el tipo de reporte tiene las columnas de porcentajes '%'
			   /*if($strTiposReporte == 'PORCENTAJE')
			   {
			   	  $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intPorcMovMes, 1, '.', ',') : $intPorcMovMes);
			   }
			   else
			   {
			   	 $arrDatos[] = '';
			   }*/

			   //$arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intSdoFinal, 0, '.', ',') : $intSdoFinal);
			    $arrDatos[] =  number_format($intSdoFinal, 0, '.', ',');

			   //Si el tipo de reporte tiene las columnas de porcentajes '%'
			   /*if($strTiposReporte == 'PORCENTAJE')
			   {
			   	  $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intPorcSdoFinal, 1, '.', ',') : $intPorcSdoFinal);
			   }
			   else
			   {
			   	 $arrDatos[] = '';
			   }*/
		  
		   	  $intFila = $this->get_registro($strTipoArchivo, $lib, $arrDatos, $intFila, $intPosX);

		   }
		  



		//Asignar datos al array
		$arrDatos['numAntSdo'] = $intSdoAnterior;
		$arrDatos['numActSdo'] = $intMovMes;
		$arrDatos['naturaleza'] = $strNaturalezaCta;
		$arrDatos['fila'] = $intFila;

		//Regresar array con los acumulados de los saldos
		return $arrDatos;

	}

	//Función que se utiliza para escribir los datos de la(s) cuenta(s) 
	public function get_datos_ctas($dteFechaInicial, $dteFechaFinal, $strNaturaleza, 
							      $arrCuentas = NULL,  $arrCuentasNombres = NULL, 
	 							  $strTipoArchivo = NULL, $lib = NULL, $intFila = NULL,  $intPosX = NULL, 
	 							  $strTiposReporte = NULL, $numAntVentas = NULL, $numActVentas = NULL, $numFinalVtas= NULL)
	{

		//Array que se utiliza para enviar datos
		$arrDatos = array('numAntSdo' => '0.00',
						  'numActSdo' => '0.00',
						  'fila' => 0);

		//Variable que se utiliza para acumular el saldo anterior (de las cuentas)
		 $numAntSdo = 0;
		 //Variable que se utiliza para acumular el saldo actual (de las cuentas)
		 $numActSdo = 0;

		//Hacer recorrido para obtener información de las cuentas
		for ($intCont = 1; $intCont <= count($arrCuentas); $intCont++)
		{

			//Seleccionar los saldos de la cuenta contable
  			$otdSaldosCta = $this->get_saldos_cuentas($dteFechaInicial, $dteFechaFinal, $strNaturaleza, 
  													   $arrCuentas[$intCont]);

  		   $intSdoAnterior = $otdSaldosCta['saldo_anterior'];
		   $intMovMes = $otdSaldosCta['movimientos'];
		   $intSdoFinal = $otdSaldosCta['saldo_final'];

		  
		   //Incrementar acumulados	
		   $numAntSdo += $intSdoAnterior;
		   $numActSdo += $intMovMes;

		   if($strTipoArchivo != NULL)
		   {

		   	  //Si el tipo de reporte tiene las columnas de porcentajes '%'
			   if($strTiposReporte == 'PORCENTAJE')
			   {
			   	  //Variables que se utilizan para asignar el porcentaje de ventas
				   $intPorcSdoAnterior = $this->get_porcentaje_vtas($intSdoAnterior, $numAntVentas);
				   $intPorcMovMes =  $this->get_porcentaje_vtas($intMovMes, $numActVentas);
				   $intPorcSdoFinal = $this->get_porcentaje_vtas($intSdoFinal, $numFinalVtas);

			   }
		 

			   //Array que contiene la información del registro
			   $arrDatos = array();
			   $arrDatos[] = (($strTipoArchivo == 'PDF') ?  utf8_decode($arrCuentasNombres[$intCont]) :  $arrCuentasNombres[$intCont]); 
			   $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intSdoAnterior, 0, '.', ',') : $intSdoAnterior);

			   //Si el tipo de reporte tiene las columnas de porcentajes '%'
			  /* if($strTiposReporte == 'PORCENTAJE')
			   {
			   	  $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intPorcSdoAnterior, 1, '.', ',') : $intPorcSdoAnterior);
			   }
			   else
			   {
			   	 $arrDatos[] = '';
			   }
			  */

			   $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intMovMes, 0, '.', ',') : $intMovMes);

			   //Si el tipo de reporte tiene las columnas de porcentajes '%'
			   /*if($strTiposReporte == 'PORCENTAJE')
			   {
			   	  $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intPorcMovMes, 1, '.', ',') : $intPorcMovMes);
			   }
			   else
			   {
			   	 $arrDatos[] = '';
			   }*/

			   $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intSdoFinal, 0, '.', ',') : $intSdoFinal);

			   //Si el tipo de reporte tiene las columnas de porcentajes '%'
			   /*if($strTiposReporte == 'PORCENTAJE')
			   {
			   	  $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intPorcSdoFinal, 1, '.', ',') : $intPorcSdoFinal);
			   }
			   else
			   {
			   	 $arrDatos[] = '';
			   }*/
		  
		   	  $intFila = $this->get_registro($strTipoArchivo, $lib, $arrDatos, $intFila, $intPosX);

		   }
		  

		}//Cierre del for


		//Asignar datos al array
		$arrDatos['numAntSdo'] = $numAntSdo;
		$arrDatos['numActSdo'] = $numActSdo;
		$arrDatos['fila'] = $intFila;

		//Regresar array con los acumulados de los saldos
		return $arrDatos;

	}

	//Función que se utiliza para escribir el total de la(s) cuenta(s) 
	public function get_total($strDescripcion, $numAntSdo,  $numActSdo, $numFinalSdo, 
							  $strTipoArchivo, $lib,  $intFila, $intPosX, $strTipo = 'TOTAL',
							  $strTiposReporte = NULL, $intPorcSdoAnterior = NULL, $intPorcMovMes = NULL, $intPorcSdoFinal = NULL)
	{

		//Array que contiene la información del registro
	   $arrDatos = array();
	   $arrDatos[] = (($strTipoArchivo == 'PDF') ?  utf8_decode($strDescripcion) : $strDescripcion); 
	  // $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($numAntSdo, 0, '.', ',') : $numAntSdo);

	   $arrDatos[] =  number_format($numAntSdo, 0, '.', ',');
	    //Si el tipo de reporte tiene las columnas de porcentajes '%'
	   /*if($strTiposReporte == 'PORCENTAJE')
	   {
	   	 $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intPorcSdoAnterior, 1, '.', ',') : $intPorcSdoAnterior);
	   }
	   else
	   {
	   	 $arrDatos[] = '';
	   }*/
	  
	  // $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($numActSdo, 0, '.', ',') : $numActSdo);

	    $arrDatos[] =  number_format($numActSdo, 0, '.', ',');
	   //Si el tipo de reporte tiene las columnas de porcentajes '%'
	   /*if($strTiposReporte == 'PORCENTAJE')
	   {
		   $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intPorcMovMes, 1, '.', ',') : $intPorcMovMes);
	   }
	   else
	   {
	   	 $arrDatos[] = '';
	   }*/

	 //  $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($numFinalSdo, 0, '.', ',') : $numFinalSdo);

	    $arrDatos[] =  number_format($numFinalSdo, 0, '.', ',');

	   //Si el tipo de reporte tiene las columnas de porcentajes '%'
	   /*if($strTiposReporte == 'PORCENTAJE')
	   {
		   $arrDatos[] =   (($strTipoArchivo == 'PDF') ?  number_format($intPorcSdoFinal, 1, '.', ',') : $intPorcSdoFinal);
	   }
	   else
	   {
	   	 $arrDatos[] = '';
	   }*/

	   $intFila = $this->get_registro($strTipoArchivo, $lib, $arrDatos, $intFila, $intPosX, $strTipo);

	   //Regresar el indice de la fila para escribir el siguiente registro
	   return $intFila;
	}

	//Función que se utiliza para escribir los datos de un registro (renglón/fila)
	public function get_registro($strTipoArchivo, $lib, $arrDatos, $intFila, $intPosX = NULL,  $strTipo = NULL)
	{

		
		//Si el tipo de archivo es PDF
		if($strTipoArchivo == 'PDF')
	    {	

	    	
			//Si el tipo de registro (fila) corresponde a TOTAL
	    	if($strTipo == 'TOTAL')
	    	{
	    		$lib->Line(90, ($lib->GetY() + 0.4), 120, ($lib->GetY() + 0.4)); //dibuja una linea para separar la información del total
				$lib->Line(128, ($lib->GetY() + 0.4), 165, ($lib->GetY() + 0.4)); //dibuja una linea para separar la información del total
				$lib->Line(170, ($lib->GetY() + 0.4), 201, ($lib->GetY() + 0.4)); //dibuja una linea para separar la información del total
	    	}
	     
 			//Si existe valor de la abscisa
	    	if($intPosX != NULL)
	    	{
	    		$lib->intValorAbscisa = $intPosX;

				$lib->SetX($intPosX);
	    	}
			
			$lib->Row($arrDatos, $lib->arrAlineacion, 'ClippedCell');

			//Si el tipo de registro (fila) corresponde a TOTAL
			if($strTipo == 'TOTAL')
		    {
				//Espacios de salto de línea
				$lib->Ln(2);
			}
			
		}
	   else //Si el tipo de archivo es Excel
	   {
			

   	       //Hacer un llamado a la función para escribir los datos 
		   $this->get_datos_registro_excel($lib, $arrDatos, 
										   $this->archivoExcel['intIndColInicial'], 
									       $intFila);

		    //Hacer un llamado a la función para cambiar el estilo de la celda
		   $this->get_estilo_celda($lib, $intFila, $strTipo);

		   //Si el tipo de registro (fila) corresponde a TOTAL
		    if($strTipo == 'TOTAL')
		    {
	    		//Incrementar el indice para escribir los datos del siguiente registro
				$intFila+=2;
    		}
    		else
    		{
    			
    			//Incrementar el indice para escribir los datos del siguiente registro
				$intFila++;
    		}
   	    }

	   return $intFila;
	}

	 //Función que se utiliza para cambiar el estilo de las celadas del archivo Excel
	public function get_estilo_celda($lib, $intFila, $strTipo = NULL)
	{
		 //Definir estilo de las celdas que apareceran en negrita
   	    $arrStyleBold = array('font'=> array('bold'=> TRUE));
   	    //Definir estilo para alinear a la derecha el contenido de la celda
       $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

       //Si el tipo de registro (fila) corresponde a TOTAL
        if($strTipo == 'TOTAL')
	    {
	        //Cambiar estilo de las siguientes celdas
	        $lib->getActiveSheet()
			    ->getStyle('A'.$intFila.':'.'G'.$intFila)
			    ->applyFromArray($arrStyleBold);
		}

		//Cambiar contenido de las celdas a formato moneda
       	$lib->getActiveSheet()
        		 ->getStyle('B'.$intFila.':'.'G'.$intFila)
        		 ->getNumberFormat()
        		 ->setFormatCode('#,##0.00');

        //Cambiar alineación de las siguientes celdas
		$lib->getActiveSheet()
		    	 ->getStyle('B'.$intFila.':'.'G'.$intFila)
		    	 ->getAlignment()
		    	 ->applyFromArray($arrStyleAlignmentRight);
	}

	//Función que se utiliza para regresar el porcentaje de ventas
	public function get_porcentaje_vtas($intSaldo, $numTotalVtas)
	{
		//Variable que se utiliza para asignar el porcentaje de ventas
		$intPorcentaje = 0;

	  //Si existen ventas
	   if ($numTotalVtas <> 0)
	   {
	   	  //Calcular porcentaje 
	   	  $intPorcentaje = ($intSaldo/$numTotalVtas*100);
	   	  
		}

		//Regresar porcentaje de ventas
		return $intPorcentaje;

	}

	//Función que se utiliza para regresar los saldos de las cuentas
	public function get_saldos_cuentas($dteFechaInicial, $dteFechaFinal, $strNaturaleza, $arrCuentas = NULL)
	{

		//Array que se utiliza para enviar datos
		$arrDatos = array('saldo_anterior' => '0.00',
						  'movimientos' => '0.00',
						  'saldo_final' => '0.00');


		//Seleccionar los saldos de la cuenta contable
  		$otdSaldosCta = $this->cuentas->buscar_saldos_ctas_estados_financieros($dteFechaInicial, 
																               $dteFechaFinal, 
																               $arrCuentas);
  			//Inicializar variables
  			$numDebeAnt = 0;
			$numHaberAnt = 0;
			$numDebe = 0;
			$numHaber = 0;

			//Si hay información
			if($otdSaldosCta)
			{
				//Recorremos el arreglo 
				foreach ($otdSaldosCta as $arrSdo)
				{

					//Incrementar cargos y abonos correspondientes al saldo inicial
					$numDebeAnt += $arrSdo->cargos_saldo_inicial;
					$numHaberAnt += $arrSdo->abonos_saldo_inicial;

					//Incrementar cargos y abonos correspondientes al saldo actual
					$numDebe += $arrSdo->cargos_saldo_actual;
					$numHaber += $arrSdo->abonos_saldo_actual;


				}//Cierre de foreach (saldos)


				//Dependiendo de la naturaleza de la cuenta, calcular el saldos
				if($strNaturaleza == 'DEUDORA')
				{
					//Calcular el saldo anterior
					$intSdoAnterior = ($numDebeAnt - $numHaberAnt);

					//Calcular los movimientos del mes
					$intMovMes = ($numDebe - $numHaber);

					//Calcular el saldo final
					$intSdoFinal = ($numDebeAnt - $numHaberAnt + $numDebe - $numHaber);
				}
				else
				{
					
					//Calcular el saldo anterior
					$intSdoAnterior = ($numHaberAnt - $numDebeAnt);

					//Calcular los movimientos del mes
					$intMovMes = ($numHaber - $numDebe);

					//Calcular el saldo final
					$intSdoFinal = ($numHaberAnt + $numHaber - $numDebeAnt - $numDebe);
				
				}
				


				//Asignar datos al array
				$arrDatos['saldo_anterior'] = $intSdoAnterior;
				$arrDatos['movimientos'] = $intMovMes;
				$arrDatos['saldo_final'] = $intSdoFinal;

			}//Cierre de verificación de saldos

			

			//Regresar array con los saldos
			 return $arrDatos;

	}
	
}