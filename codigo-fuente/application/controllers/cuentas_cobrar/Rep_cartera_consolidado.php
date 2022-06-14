<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_cartera_consolidado extends MY_Controller {

	//Información que se utiliza para asignar los indices iniciales del archivo Excel
	var $archivoExcel = NULL;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar el indice de la columna principal
	    $this->archivoExcel['intIndColInicial'] = 1;
	    //Asignar posición para escribir las descripciones de las columnas 
	    $this->archivoExcel['intPosEncabezados'] = 11;
	    //Asignar el número de fila donde se va a comenzar a rellenar
	    $this->archivoExcel['intFilaInicial'] = 14;
	    //Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de pagos
		$this->load->model('caja/pagos_model', 'pagos');
		//Cargamos el modelo de clientes
		$this->load->model('cuentas_cobrar/clientes_model', 'clientes');
		//Cargamos el modelo de monedas
		$this->load->model('contabilidad/sat_monedas_model', 'monedas');
		//Cargamos el modelo de pedidos de maquinaria
		$this->load->model('maquinaria/pedidos_maquinaria_model', 'pedidos_maquinaria');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('cuentas_cobrar/rep_cartera_consolidado', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_tipo_calendario('application/json')->set_output(json_encode($arrDatos));
	}


	
	/*Método para generar un reporte PDF con la cartera (de vencimientos) consolidado
	 *dependiendo de los criterios de búsqueda proporcionados*/ 
	public function get_reporte() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte = $this->input->post('dteFechaCorte');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strModulos = trim($this->input->post('strModulos'));

		//Separar Mes y Año de la fecha
		$arrFecha = explode('/', $dteFechaCorte);
		$strMes = $arrFecha[0];
		$strAnio = $arrFecha[1];


		//Hacer un llamado a la función para obtener las semanas del mes 
		$arrSemanas = $this->get_semanas_mes($strMes, $strAnio);
		//Asignar el número de semanas que tiene el mes
		$intNumSemanas = sizeof($arrSemanas);
		//Variable que se utiliza para asignar el último día del mes
		$intUltimoDiaMes = 0;
		//Array que se utiliza para agregar los datos de las sucursales
        $arrSucursales = array();
        //Array que se utiliza para agregar los datos de una sucursal
        $arrAuxiliar = array();

        //Buscar el nombre de las sucursales que han sido seleccionadas y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 2
	    $strTituloSucursales = '';
	    $arrSucursalesID = explode('|', $strSucursales);
	    //Hacer recorrido para obtener el id de las sucursales
	    foreach ($arrSucursalesID as &$intSucursalID) 
	    {		    
		    //Seleccionar los datos de la sucursal
			$otdSucursal = $this->sucursales->buscar($intSucursalID);
			//Concatenamos el nombre de la sucursal a la variable de impresión
			$strTituloSucursales .= $otdSucursal->nombre.', ';

			//Definir valores del array auxiliar de información (para cada sucursal)
			$arrAuxiliar["sucursal_id"] = $intSucursalID;
			$arrAuxiliar["nombre"] = $otdSucursal->nombre;
			 //Agregar datos al array
            array_push($arrSucursales, $arrAuxiliar);
		}

		//Quitar último elemento de la cadena (,)
		$strTituloSucursales = substr($strTituloSucursales, 0, -2);

		//Buscar el nombre de los Módulos que han sido seleccionados y por tanto apareceran en el reporte
		//Variable para concatenar lo que será impreso en el titulo del renglon 3
	    $strTituloModulos = '';
	    $arrDescripcionesModulos = explode('|', $strModulos);
	    //Variable que se utiliza para indicar que esta seleccionado el módulo de maquinaria
	    $strModuloMaquinaria = '';
	    //Hacer recorrido para obtener las descripciones de los modulos 
	    foreach ($arrDescripcionesModulos as &$strModulo) 
	    {
			//Concatenamos el nombre del módulo a la variable de impresión
			$strTituloModulos .= $strModulo.', ';

			//Si seleccionaron el módulo de maquinaria
			if($strModulo == 'MAQUINARIA')
			{
				//Asignar valor a la variable para obtener las formas de pago (documentos) de las facturas de maquinaria
				$strModuloMaquinaria = 'MAQUINARIA';
			}
		}

		//Quitar último elemento de la cadena (,)
		$strTituloModulos = substr($strTituloModulos, 0, -2);

		//Se crea una instancia de la clase PDF
		$pdf = new PDF('L','mm','legal');//orientación horizontal
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Crea los titulos de la cabecera
	    $pdf->arrCabecera = array('SALDOS SEMANALES');
	    //Crea los titulos de la segunda cabecera 
		$pdf->arrCabecera2 = array('', '');
		//Crea los titulos de la tercera cabecera 
		$pdf->arrCabecera3 = array('SUCURSAL', 'CONCEPTO');
		//Variable que se utiliza para asignar el tamaño de los encabezados de las columnas fijas
		$intTamColFijas = 85;
		
		//Variable que se utiliza para asignar el tamaño restante de la hoja doble cara
	    $intTamColSemanas = ((335 - $intTamColFijas) / $intNumSemanas);

	    //Variable que se utiliza para asignar el tamaño de los encabezados de las columnas fijas
		$intTamColPorcentaje = 15;
		$intTamColMonto =  $intTamColSemanas - $intTamColPorcentaje;

		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(335);
		$pdf->arrAnchura2 = array(25, 60);
		$pdf->arrAnchura3 = array(25, 60);
		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array($intTamColFijas);
		//Establece la alineación de las columnas de las cabeceras
		$pdf->arrAlineacion = array('C');
		$pdf->arrAlineacion2 = array('L', 'L');
		$pdf->arrAlineacion3 = array('L', 'L');
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R');

		//Hacer recorrido para agregar a la cabecera las semanas del mes
        foreach ($arrSemanas as $arrSem) 
        {
        	//Agregar datos al array de la segunda cabecera
            $pdf->arrCabecera2[] = $arrSem['primer_dia'].' AL '.$arrSem['ultimo_dia'];
            $pdf->arrAnchura2[] =  $intTamColSemanas;
            $pdf->arrAlineacion2[] = 'R';

            //Agregar datos al array de la tercera cabecera
            //Monto
            $pdf->arrCabecera3[] = 'MONTO';
            $pdf->arrAnchura3[] =  $intTamColMonto;
            $pdf->arrAlineacion3[] = 'R';
            //Porcentaje
            $pdf->arrCabecera3[] = '%';
            $pdf->arrAnchura3[] =  $intTamColPorcentaje;
            $pdf->arrAlineacion3[] = 'R';

            //Agregar datos al array de la tabla totales
            //Monto
            $arrAnchuraTotales[] =  $intTamColMonto;
            $arrAlineacionTotales[] = 'R';
            //Porcentaje
            $arrAnchuraTotales[] =  $intTamColPorcentaje;
            $arrAlineacionTotales[] = 'R';

            //Asignar último día de la semana (con la finalidad de saber el último día del mes)
            $intUltimoDiaMes = $arrSem['ultimo_dia'];

        }

        //Variable que se utiliza para asignar la fecha inicial (del mes)
        $dteFechaInicial = $strAnio.'-'.$strMes.'-'.'01';
        //Variable que se utiliza para asignar la fecha final (del mes)
        $dteFechaFinal = $strAnio.'-'.$strMes.'-'.$intUltimoDiaMes;

	 	//Reemplazar 0 por cadena vacia
	 	$intMes = str_replace('0', '',  $strMes);
	 	//Hacer un llamado a la función para cambiar número del mes por la descripción del mes
		//por ejemplo: 02 a FEBRERO
	 	$strNombreMes = $this->ARR_MESES_DESCRIPCIONES[$intMes];

	 	//Datos para los títulos del reporte
	 	$strTituloLinea1 =  'RESUMEN DE CARTERA GENERAL EN ';
	 	$strTituloModLinea1 =  'RESUMEN DE CARTERA GENERAL DE ';
	 	$strTituloMesAnio = 'DEL MES DE '.$strNombreMes.' DEL '.$strAnio;
	 	$strTituloModulos = utf8_decode('MÓDULOS: '.trim($strTituloModulos));

	 	//Asignar el valor de la descripción (título de la lista de registros) del reporte
	    $pdf->strLinea1 = $strTituloLinea1.'     '.$strTituloMesAnio;
	    //Asignar el valor de la línea dos del título
		$pdf->strLinea2 =  utf8_decode('SUCURSALES: '.trim($strTituloSucursales));
		//Asignar el valor de la línea tres del título
		$pdf->strLinea3 =  $strTituloModulos;
	    //Establecer el color de línea
	    $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Seleccionar los datos de las monedas activas
		$otdMonedas = $this->monedas->buscar(NULL, NULL, NULL, 'ACTIVO');
		//Si hay información
		if($otdMonedas)
		{
			//Recorremos el arreglo 
			foreach ($otdMonedas as $arrMon)
			{
				//Asignar el id de la moneda actual
				$intMonedaID = $arrMon->moneda_id;
				//Asignar la descripción de la moneda
				$strMoneda = strtoupper($arrMon->descripcion);

				
				//Asignar array con los saldos de las semanas del mes
				$arrSaldosSemanasMes = $this->get_saldos_mes($dteFechaInicial, $dteFechaFinal, $intMonedaID, 
						    							  	 $arrSemanas, $arrSucursales, $strSucursales,
					    							  	     $strModulos, $arrDescripcionesModulos, 
					    							  	     $strMes, $strAnio, $strModuloMaquinaria);



				//Asignar el número de semanas con saldos
				$intNumSemSaldos = count($arrSaldosSemanasMes);

				//Si existen semanas con saldos (facturas con adeudos)
				if($intNumSemSaldos > 0)
				{
					//Concatenar moneda para el primer encabezado del reporte
					$strTituloMoneda = $strTituloLinea1.$strMoneda;
					//Asignar el valor de la descripción (título de la lista de registros) del reporte
					$pdf->strLinea1 = $strTituloMoneda.' '.$strTituloMesAnio;
					//Asignar nuevamente el valor de la línea tres del título (debido a que en la hoja por módulo no se muestra)
					$pdf->strLinea3 = $strTituloModulos;
					//Agregar pagina
					$pdf->AddPage();

					//Hacer un llamado a la función para  escribir los saldos generales
					$this->get_datos_cartera($pdf, 'PDF', $arrSucursales, $arrSemanas, $intNumSemanas,
											 $arrSaldosSemanasMes, $dteFechaFinal, $intMonedaID, $strModuloMaquinaria,
											 NULL, $arrAlineacionTotales, $arrAnchuraTotales);


					//Hacer un llamado a la función para  escribir los saldos por cada módulo
					$this->get_datos_cartera($pdf, 'PDF', $arrSucursales, $arrSemanas, $intNumSemanas,
											 $arrSaldosSemanasMes,  $dteFechaFinal, $intMonedaID, 
											 $strModuloMaquinaria, $arrDescripcionesModulos, 
											 $arrAlineacionTotales, $arrAnchuraTotales, 
											 $strTituloModLinea1, $strTituloMesAnio, $strMoneda);

				}//Cierre de verificación de información de saldos 
				 

			}

		}//Cierre de verificación de monedas

		//Ejecutar la salida del reporte
        $pdf->Output('cartera_consolidado.pdf','I'); 
	}

	/*Método para generar un archivo XLS con la cartera (de vencimientos) consolidado
	 *dependiendo de los criterios de búsqueda proporcionados*/ 
	public function get_xls()
    {
    	//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte = $this->input->post('dteFechaCorte');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strModulos = trim($this->input->post('strModulos'));

		//Separar Mes y Año de la fecha
		$arrFecha = explode('/', $dteFechaCorte);
		$strMes = $arrFecha[0];
		$strAnio = $arrFecha[1];

        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
		//Hacer un llamado a la función para obtener las semanas del mes 
		$arrSemanas = $this->get_semanas_mes($strMes, $strAnio);
		//Asignar el número de semanas que tiene el mes
		$intNumSemanas = sizeof($arrSemanas);
		//Variable que se utiliza para asignar el último día del mes
		$intUltimoDiaMes = 0;
		//Array que se utiliza para agregar los datos de las sucursales
        $arrSucursales = array();
        //Array que se utiliza para agregar los datos de una sucursal
        $arrAuxiliar = array();
        //Variable que se utiliza para asignar el número de registros por cada moneda
		$intNumRegistros = 0; 
		//Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última moneda)
		$intNumMaxRegistros = 0;

        //Buscar el nombre de las sucursales que han sido seleccionadas y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 2
	    $strTituloSucursales = '';
	    $arrSucursalesID = explode('|', $strSucursales);
	    //Hacer recorrido para obtener el id de las sucursales
	    foreach ($arrSucursalesID as &$intSucursalID) 
	    {		    
		    //Seleccionar los datos de la sucursal
			$otdSucursal = $this->sucursales->buscar($intSucursalID);
			//Concatenamos el nombre de la sucursal a la variable de impresión
			$strTituloSucursales .= $otdSucursal->nombre.', ';

			//Definir valores del array auxiliar de información (para cada sucursal)
			$arrAuxiliar["sucursal_id"] = $intSucursalID;
			$arrAuxiliar["nombre"] = $otdSucursal->nombre;
			 //Agregar datos al array
            array_push($arrSucursales, $arrAuxiliar);
		}

		//Quitar último elemento de la cadena (,)
		$strTituloSucursales = substr($strTituloSucursales, 0, -2);

		//Buscar el nombre de los Módulos que han sido seleccionados y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 3
	    $strTituloModulos = '';
	    $arrDescripcionesModulos = explode('|', $strModulos);
	    //Variable que se utiliza para indicar que esta seleccionado el módulo de maquinaria
	    $strModuloMaquinaria = '';
	 	//Hacer recorrido para obtener las descripciones de los modulos 
	    foreach ($arrDescripcionesModulos as &$strModulo) 
	    {
			//Concatenamos el nombre del módulo a la variable de impresión
			$strTituloModulos .= $strModulo.', ';

			//Si seleccionaron el módulo de maquinaria
			if($strModulo == 'MAQUINARIA')
			{
				//Asignar valor a la variable para obtener las formas de pago (documentos) de las facturas de maquinaria
				$strModuloMaquinaria = 'MAQUINARIA';
			}
		}

		//Quitar último elemento de la cadena (,)
		$strTituloModulos = substr($strTituloModulos, 0, -2);

	 	//Crea los titulos de la cabecera
	    $arrCabecera = array('SALDOS SEMANALES');
	    //Crea los titulos de la segunda cabecera 
		$arrCabecera2 = array();
		//Crea los titulos de la tercera cabecera 
		$arrCabecera3 = array('SUCURSAL', 'CONCEPTO');

	   	//Hacer recorrido para agregar a la cabecera las semanas del mes
        foreach ($arrSemanas as $arrSem) 
        {
        	//Agregar datos al array de la segunda cabecera
            $arrCabecera2[] = $arrSem['primer_dia'].' AL '.$arrSem['ultimo_dia'];
            
            //Agregar datos al array de la tercera cabecera
            //Monto
            $arrCabecera3[] = 'MONTO';
            //Porcentaje
            $arrCabecera3[] = '%';

            //Asignar último día de la semana (con la finalidad de saber el último día del mes)
            $intUltimoDiaMes = $arrSem['ultimo_dia'];

        }
	

        //Variable que se utiliza para asignar la fecha inicial (del mes)
        $dteFechaInicial = $strAnio.'-'.$strMes.'-'.'01';
        //Variable que se utiliza para asignar la fecha final (del mes)
        $dteFechaFinal = $strAnio.'-'.$strMes.'-'.$intUltimoDiaMes;

	 	//Reemplazar 0 por cadena vacia
	 	$intMes = str_replace('0', '',  $strMes);
	 	//Hacer un llamado a la función para cambiar número del mes por la descripción del mes
		//por ejemplo: 02 a FEBRERO
	 	$strNombreMes = $this->ARR_MESES_DESCRIPCIONES[$intMes];

	 	//Datos del primer título del reporte 
	 	$strTituloLinea1 =  'RESUMEN DE CARTERA GENERAL EN ';
	 	$strTituloModLinea1 =  'RESUMEN DE CARTERA GENERAL DE ';
	 	$strTituloMesAnio = 'DEL MES DE '.$strNombreMes.' DEL '.$strAnio;

		//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');

        //Seleccionar los datos de las monedas activas
		$otdMonedas = $this->monedas->buscar(NULL, NULL, NULL, 'ACTIVO');
		//Si hay información
		if($otdMonedas)
		{
			//Recorremos el arreglo 
			foreach ($otdMonedas as $arrMon)
			{
			  
				//Asignar el id de la moneda actual
				$intMonedaID = $arrMon->moneda_id;
				//Asignar la descripción de la moneda
				$strMoneda = strtoupper($arrMon->descripcion);
				//Asignar el código de la moneda
				$strCodigoMoneda = $arrMon->codigo;

				//Asignar el nombre de la hoja
				$strNombreHoja = 'CARTERA '.$strCodigoMoneda;
			
				//Concatenar datos para el primer encabezado del reporte
				$strEncabezado = $strTituloLinea1.' '.$strTituloMesAnio;

				//Si se cumple la sentencia (mostrar encabezado aunque no existan semanas con saldo)
				if($intContadorHojas == 0)
				{
					//Hacer un llamado a la función para escribir el encabezado en el archivo excel
					$this->get_encabezado_archivo_xls($objExcel, $strEncabezado, $strTituloSucursales, $strTituloModulos,
												 	 $arrCabecera, $arrCabecera2, $arrCabecera3);
				}

		        //Asignar array con los saldos de las semanas del mes
				$arrSaldosSemanasMes = $this->get_saldos_mes($dteFechaInicial, $dteFechaFinal, $intMonedaID, 
						    							  	 $arrSemanas, $arrSucursales, $strSucursales,
					    							  	     $strModulos, $arrDescripcionesModulos, 
					    							  	     $strMes, $strAnio, $strModuloMaquinaria);

				//Asignar el número de semanas con saldos
				$intNumSemSaldos = count($arrSaldosSemanasMes);

				//Si existen semanas con saldos (facturas con adeudos)
				if($intNumSemSaldos > 0)
				{
					//Número de fila donde se va a comenzar a rellenar
				    $intFila = $this->archivoExcel['intFilaInicial'];

				    //Hacer un llamado a la función para agregar (o activar) una hoja en el archivo excel
				    $intContadorHojas = $this->get_hoja_archivo_excel($objExcel, $strNombreHoja, $intContadorHojas);

				
					//Hacer un llamado a la función para  escribir los saldos generales
					$arrIndicesArchivo = $this->get_datos_cartera($objExcel, 'EXCEL', $arrSucursales, $arrSemanas, 
																  $intNumSemanas, $arrSaldosSemanasMes, $dteFechaFinal, 
																  $intMonedaID, $strModuloMaquinaria, NULL, NULL, 
																  NULL, NULL, $strTituloMesAnio, $strMoneda, $intFila, NULL, 
																  $strTituloSucursales, $strTituloModulos, $arrCabecera, 
													 			  $arrCabecera2, $arrCabecera3);

					//Asignar indice actual de la fila
					$intFila = $arrIndicesArchivo['fila'];
					//Incrementar contador por cada moneda
			        $intContadorHojas++;
					
			        //Hacer un llamado a la función para cambiar el estilo de las celdas
			        $this->get_estilo_celda($objExcel, NULL, $arrCabecera3, $intFila);

					//Hacer un llamado a la función para  escribir los saldos por cada módulo
					$arrIndicesArchivo = $this->get_datos_cartera($objExcel, 'EXCEL', $arrSucursales, $arrSemanas, 
															      $intNumSemanas, $arrSaldosSemanasMes,
															      $dteFechaFinal, $intMonedaID, $strModuloMaquinaria, 
															      $arrDescripcionesModulos,  NULL, NULL, 
															      $strTituloModLinea1, $strTituloMesAnio, 
													 			  $strMoneda, NULL, $intContadorHojas, 
													 			  $strTituloSucursales, NULL, $arrCabecera, 
													 			  $arrCabecera2, $arrCabecera3, $strCodigoMoneda);

					//Asignar indice actual de la fila
					$intFila = $arrIndicesArchivo['fila'];
					//Asignar contador actual de la hoja (para evitar perder indice)
					$intContadorHojas = $arrIndicesArchivo['contador_hoja'];

					//Asignar el número de registros (filas)
					$intNumRegistros = $intFila;

					//Si el número de registros (por cada moneda) es mayor que el número máximo de registros 
				    if($intNumRegistros > $intNumMaxRegistros)
		            {
		            	//Asignar número de registros
		            	$intNumMaxRegistros = $intNumRegistros;
		            }

				}//Cierre de verificación de información de saldos 
				
			}

		}//Cierre de verificación de monedas

        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'cartera_consolidado.xls', 'CARTERA', $intNumMaxRegistros);
    }

    //Función que se utiliza para escribir el encabezado del archivo Excel
    public function get_encabezado_archivo_xls($objExcel, $strEncabezado, $strTituloSucursales, $strTituloModulos = NULL,
    										  $arrCabecera, $arrCabecera2, $arrCabecera3)
    {	

    	//Asignar posición para escribir las descripciones de las columnas 
      	$intPosEncabezados = $this->archivoExcel['intPosEncabezados'];
      	//Variable que se utiliza para asignar el número de columna donde se empezaran a escribir los encabezados 
      	$intIndColE= $this->archivoExcel['intIndColInicial'];//Encabezados del reporte
	 	$intIndColESem = 3; //Variable que se utiliza para asignar el número de columna donde se empezaran a escribir las semanas
	 	//Asignar el número de columnas de la cabecera 3
	 	$intNumColCabecera3 = count($arrCabecera3);

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

    	//Se agrega el título del archivo
		$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);
		$objExcel->getActiveSheet()->setCellValue('A8', 'SUCURSALES: '.$strTituloSucursales);
		
		//Si la hoja del archivo Excel corresponde a los acumulados generales
		if($strTituloModulos != NULL)
		{
			$objExcel->getActiveSheet()->setCellValue('A9', 'MÓDULOS: '.$strTituloModulos);
		}
		

		//Combinar las siguientes celdas
       	$objExcel->getActiveSheet()->mergeCells('A8:D8');
       	$objExcel->getActiveSheet()->mergeCells('A9:D9');

       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A8:D8')
        		 ->applyFromArray($arrStyleBold);

        $objExcel->getActiveSheet()
        		 ->getStyle('A9:D9')
        		 ->applyFromArray($arrStyleBold);

        //Preferencias de color de texto de la celda
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:D9')
    			 ->applyFromArray($arrStyleFuenteColumnasPrinc);

    	//Cambiar alineación de las siguientes celdas
    	$objExcel->getActiveSheet()
            	 ->getStyle('A9:D9')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentLeft);


		//Hacer recorrido para obtener los datos de la cabecera 1
    	foreach ($arrCabecera as $arrDet) 
    	{	
    		//Asignar columna inicial
    		$strColInicial = $this->ARR_COLUMNAS[$this->archivoExcel['intIndColInicial']].$intPosEncabezados;
    		//Asignar columna final
    		$strColFinal = $this->ARR_COLUMNAS[$intNumColCabecera3].$intPosEncabezados;

        	//Se agrega en el encabezado del archivo la cabecera 1
        	$objExcel->getActiveSheet()->setCellValue($strColInicial, $arrDet);
		   
		    //Combinar las siguientes celdas
        	$objExcel->getActiveSheet()->mergeCells($strColInicial.':'.$strColFinal);

        	//Cambiar estilo de las siguientes celdas
	        $objExcel->getActiveSheet()
	        		 ->getStyle($strColInicial.':'.$strColFinal)
	        		 ->applyFromArray($arrStyleBold);

	        //Cambiar alineación de las siguientes celdas
		    $objExcel->getActiveSheet()
		        	 ->getStyle($strColInicial.':'.$strColFinal)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);

	        //Preferencias de color de relleno de celda
       		$objExcel->getActiveSheet()
    			     ->getStyle($strColInicial.':'.$strColFinal)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

	        //Preferencias de color de texto de la celda
       	    $objExcel->getActiveSheet()
    			     ->getStyle($strColInicial.':'.$strColFinal)
    			     ->applyFromArray($arrStyleFuenteColumnas);

		          		
        }//Cierre de foreach (cabecera 1)

        //Incrementar los indices para escribir los datos de la cabecera 2
        $intIndColE = $intIndColESem;
        $intPosEncabezados++;

        //Hacer recorrido para obtener los datos de la cabecera 2
    	foreach ($arrCabecera2 as $arrDet) 
    	{
    		$strColInicial = $this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados;
    		$intIndColE++;
    		$strColFinal = $this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados;

        	//Se agrega en el encabezado del archivo la cabecera 2
        	$objExcel->getActiveSheet()->setCellValue($strColInicial, $arrDet);

        	//Combinar las siguientes celdas
            $objExcel->getActiveSheet()->mergeCells($strColInicial.':'.$strColFinal);
           
            //Cambiar estilo de las siguientes celdas
	        $objExcel->getActiveSheet()
	        		 ->getStyle($strColInicial.':'.$strColFinal)
	        		 ->applyFromArray($arrStyleBold);

	        //Cambiar alineación de las siguientes celdas
		    $objExcel->getActiveSheet()
		        	 ->getStyle($strColInicial.':'.$strColFinal)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);

	        //Preferencias de color de relleno de celda
       		$objExcel->getActiveSheet()
    			     ->getStyle('A'.$intPosEncabezados.':'.$strColFinal)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

	        //Preferencias de color de texto de la celda
       	    $objExcel->getActiveSheet()
    			     ->getStyle($strColInicial.':'.$strColFinal)
    			     ->applyFromArray($arrStyleFuenteColumnas);


		    //Incrementar indice de la columna
			$intIndColE++;           	

        }//Cierre de foreach (cabecera 2)

        //Incrementar los indices para escribir los datos de la cabecera 3
        $intIndColE =  $this->archivoExcel['intIndColInicial'];
        $intPosEncabezados++;

		//Hacer recorrido para obtener los datos de la cabecera 3
    	foreach ($arrCabecera3 as $arrDet) 
    	{
    		$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados;

        	//Se agrega en el encabezado del archivo la cabecera 3
        	$objExcel->getActiveSheet()->setCellValue($strColActual, $arrDet);

        	 //Cambiar estilo de las siguientes celdas
	        $objExcel->getActiveSheet()
	        		 ->getStyle($strColActual)
	        		 ->applyFromArray($arrStyleBold);

	        //Cambiar alineación de las siguientes celdas
		    $objExcel->getActiveSheet()
		        	 ->getStyle($strColActual)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);

	        //Preferencias de color de relleno de celda
       		$objExcel->getActiveSheet()
    			     ->getStyle($strColActual)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

	        //Preferencias de color de texto de la celda
       	    $objExcel->getActiveSheet()
    			     ->getStyle($strColActual)
    			     ->applyFromArray($arrStyleFuenteColumnas);


		    //Incrementar indice de la columna
			$intIndColE++;  

        }//Cierre de foreach (cabecera 3)

    }

   
	//Función que se utiliza para escribir los datos de la cartera
    public function get_datos_cartera($lib, $strTipoArchivo, $arrSucursales, $arrSemanas, $intNumSemanas,
    								  $arrSaldosSemanasMes,  $dteFechaFinal, $intMonedaID, $strModuloMaquinaria,
    								  $arrDescripcionesModulos = NULL, $arrAlineacionTotales = NULL, 
    								  $arrAnchuraTotales = NULL, $strTituloModLinea1 = NULL, $strTituloMesAnio = NULL,  
    								  $strMoneda = NULL, $intFilaExcel = NULL, $intContadorHojas = NULL, 
    								  $strTituloSucursales = NULL, $strTituloModulos = NULL, 
    								  $arrCabecera = NULL, $arrCabecera2 = NULL, $arrCabecera3 = NULL, 
    								  $strCodigoMoneda = NULL)
    {


    	//Array que se utiliza para enviar datos del archivo Excel
		$arrDatosExcel = array('fila' => 0, 
						  	   'contador_hoja' => 0);

    	
    	//Si los datos corresponden al concentrado general de saldos
		if($arrDescripcionesModulos == NULL)
		{
			//Si el tipo de archivo es PDF
            if($strTipoArchivo == 'PDF')
            {
            	//Establece el ancho de las columnas
				$lib->SetWidths($lib->arrAnchura3);
            }
        	else //Si el tipo de archivo es Excel
			{
				//Concatenar moneda para el primer encabezado del reporte
				$strTituloLinea1 = 'RESUMEN DE CARTERA GENERAL EN '.$strMoneda;
				//Cambiar descripción de la primer línea del título
				$strEncabezado = $strTituloLinea1.' '.$strTituloMesAnio;

				//Hacer un llamado a la función para escribir el encabezado en el archivo excel
				$this->get_encabezado_archivo_xls($lib, $strEncabezado, $strTituloSucursales, $strTituloModulos,
											 	  $arrCabecera, $arrCabecera2, $arrCabecera3);
			}

			//Array que se utiliza para agregar los datos del saldo general
			$arrAcumuladoSdoGral = array();

			//Agregar al array descripción del saldo general
			$arrAcumuladoSdoGral[] = 'TOTAL GLOBAL:';

			//Variable que se utiliza para asignar el número de la semana actual
			$intNumSemanaActual = 1;
			
			//Hacer recorrido para obtener los datos de las sucursales seleccionadas (Gral)
			foreach ($arrSucursales as $arrSuc)
			{
				
				//Array que se utiliza para agregar los datos del saldo 
				$arrDatosSdoSuc = array();
				//Array que se utiliza para agregar los datos del saldo por vencer
				$arrDatosSdoVencer = array();
				//Array que se utiliza para agregar los datos del saldo vencido
				$arrDatosSdoVencido = array();
				//Array que se utiliza para agregar los datos del saldo de maquinaria (por forma de pago)
				$arrDatosSdoDocPedidosMaq = array();
				//Array que se utiliza para verificar si la forma de pago tiene saldo (en caso de no existir saldo del documento no se muestra la forma de pago recorrida)
				$arrAcumSdoDocPedidosMaq = array();

				//Asignar el nombre de la sucursal
				$strSucursal = $arrSuc['nombre'];

				//Si el tipo de archivo es PDF
				if($strTipoArchivo == 'PDF')
    			{
    				//Se concatena |Negrita -> para cambiar el volumen de la fuente a bold
    				$strSucursal = utf8_decode($strSucursal.'|Negrita');
    			}

				//Agregar al array descripción de la sucursal
				$arrDatosSdoSuc[] = $strSucursal;
				$arrDatosSdoSuc[] = 'TOTAL';

				//Agregar al array descripción del saldo por vencer
				$arrDatosSdoVencer[] = '';
				$arrDatosSdoVencer[] = 'POR VENCER';

				//Agregar al array descripción del saldo vencido
				$arrDatosSdoVencido[] = '';
				$arrDatosSdoVencido[] = 'VENCIDO';

				//Si el módulo de maquinaria se encuentra seleccionado
				if($strModuloMaquinaria != '')
				{
					//Seleccionar los datos de los documentos de pedidos de maquinaria (pagos)
					$otdDocPedidosMaq = $this->pedidos_maquinaria->buscar_distintas_formas_pago($arrSuc['sucursal_id'], 
																								$dteFechaFinal, 
																								$intMonedaID);
					//Si hay información
					if($otdDocPedidosMaq)
					{
						//Hacer recorrido para obtener los documentos de pago
						foreach ($otdDocPedidosMaq as $arrDoc) 
						{
							//Asignar la descripción de la forma de pago (documento de pago)
							$strDescripcion = $arrDoc->descripcion;

							//Si el tipo de archivo es PDF
       					    if($strTipoArchivo == 'PDF')
		        			{
		        				//Se utiliza utf8 para acentos y tildes
		        				$strDescripcion = utf8_decode($strDescripcion);
		        			}

							//Agregar al array descripción del documento (pedidos de maquinaria)
       						$arrDatosSdoDocPedidosMaq[$arrDoc->documento_pago_id][] = '';
       						$arrDatosSdoDocPedidosMaq[$arrDoc->documento_pago_id][] = $strDescripcion;
       						//Inicializar variables
       						$arrAcumSdoDocPedidosMaq[$arrDoc->documento_pago_id] = 0;

						}//Cierre de foreach formas de pago de maquinaria

					}//Cierre de verificación de formas de pago

				}//Cierre de verificación del módulo de maquinaria

				
				//Hacer recorrido para obtener las semanas del mes
				foreach ($arrSemanas as $arrSem) 
		        {
		        	//Variable que se utiliza para identificar una semana (obtener sus datos)
		        	$intPrimerDiaSemana = $arrSem['primer_dia'];
		        
		        	//Hacer recorrido para obtener los datos de la semana 
		        	foreach($arrSaldosSemanasMes["semana_".$intPrimerDiaSemana] as $arrDetSem) 
			        {

			        	//Verificar que el número de la semana actual no sea mayor a las semanas del mes
		        		//(para evitar agregar más semanas en el array)
		        		if($intNumSemanaActual <= $intNumSemanas)
		        		{
		        			//Asignar el acumulado general de saldos (de la semana)
	        				$intAcumSdoGral = $arrDetSem[0]['acumulado_general'][0][$intPrimerDiaSemana];

	        				//Si el tipo de archivo es PDF
       					    if($strTipoArchivo == 'PDF')
		        			{
		        				//Convertir cantidad a formato moneda
		        				$intAcumSdoGral = '$'.number_format($intAcumSdoGral,2);
		        			}

		        			//Agregar al array los datos del saldo general
		        			$arrAcumuladoSdoGral[] = $intAcumSdoGral;
		        			$arrAcumuladoSdoGral[] = '';

		        		}
		        		
		        		//Hacer recorrido para obtener las sucursales de la semana
		        		foreach($arrDetSem[0]['sucursales'] as $arrSucSem) 
		        		{
				        	//Hacer recorrido para obtener los datos de la sucursal 
			        		foreach($arrSucSem["sucursal_".$arrSuc['sucursal_id']] as $arrDetSuc)
			        		{

		        				//Variables que se utilizan para asignar los datos del saldo (de la sucursal)
		        				$intAcumSdoSuc = $arrDetSuc[0]['saldo'];
		        				$intPorcentajeSdoSuc = $arrDetSuc[0]['porcentaje_saldo'];
		        				//Variables que se utilizan para asignar los datos del saldo por vencer (de la sucursal)
		        				$intAcumSdoVencerSuc = $arrDetSuc[0]['saldo_vencer'];
		        				$intPorcentajeSdoVencerSuc = $arrDetSuc[0]['porcentaje_saldo_vencer'];
		        				//Variables que se utilizan para asignar los datos del saldo vencido  (de la sucursal)
		        				$intAcumSdoVencidoSuc = $arrDetSuc[0]['saldo_vencido'];
		        				$intPorcentajeSdoVencidoSuc = $arrDetSuc[0]['porcentaje_saldo_vencido'];

		        				//Si el tipo de archivo es PDF
           					    if($strTipoArchivo == 'PDF')
			        			{	
			        				//Convertir cantidad a formato moneda
			        				//Se concatena |Negrita -> para cambiar el volumen de la fuente a bold
			        				//Acumulado del saldo
			        				$intAcumSdoSuc =  '$'.number_format($intAcumSdoSuc,2).'|Negrita';
			        				$intPorcentajeSdoSuc .= '%|Negrita';

			        				//Acumulado del saldo por vencer
			        				$intAcumSdoVencerSuc =  '$'.number_format($intAcumSdoVencerSuc,2);
			        				$intPorcentajeSdoVencerSuc .= '%';

			        				//Acumulado del saldo vencido
			        				$intAcumSdoVencidoSuc =  '$'.number_format($intAcumSdoVencidoSuc,2);
			        				$intPorcentajeSdoVencidoSuc .= '%';
			        			}
			        			else //Si el tipo de archivo es Excel
			        			{
			        				$intPorcentajeSdoSuc = $intPorcentajeSdoSuc / 100;
			        				$intPorcentajeSdoVencerSuc = $intPorcentajeSdoVencerSuc / 100;
			        				$intPorcentajeSdoVencidoSuc = $intPorcentajeSdoVencidoSuc / 100;
			        			}

			        			//Agregar al array los datos del saldo
		        				$arrDatosSdoSuc[] = $intAcumSdoSuc;
		        				$arrDatosSdoSuc[] = $intPorcentajeSdoSuc;

		        				//Agregar al array los datos del saldo por vencer
                                $arrDatosSdoVencer[] = $intAcumSdoVencerSuc;
                                $arrDatosSdoVencer[] = $intPorcentajeSdoVencerSuc;

                                //Agregar al array los datos del saldo vencido
                                $arrDatosSdoVencido[] = $intAcumSdoVencidoSuc;
                                $arrDatosSdoVencido[] = $intPorcentajeSdoVencidoSuc;


                                //Si el módulo de maquinaria se encuentra seleccionado
								if($strModuloMaquinaria != '' && $otdDocPedidosMaq)
                                {
									//Hacer recorrido para obtener saldos de los documentos de pago
									foreach ($otdDocPedidosMaq as $arrDoc) 
									{
										//Asignar el saldo del documento
										$intAcumSaldoDoc = $arrDetSuc[0]['saldo_maquinaria'][$arrDoc->documento_pago_id];
										//Asignar el porcentaje que le corresponde al saldo del documento
										$intPorcentajeSdoDoc = $arrDetSuc[0]['porcentaje_saldo_maquinaria'][$arrDoc->documento_pago_id];

										//Si existe saldo del documento
										if($intAcumSaldoDoc > 0)
										{
											//Incrementar acumulado del saldo por documento
											$arrAcumSdoDocPedidosMaq[$arrDoc->documento_pago_id] += $intAcumSaldoDoc;

											//Si el tipo de archivo es PDF
			           					    if($strTipoArchivo == 'PDF')
						        			{
						        				//Acumulado del saldo por documento
						        				$intAcumSaldoDoc =  '$'.number_format($intAcumSaldoDoc,2);
						        				$intPorcentajeSdoDoc .= '%';

						        			}
						        			else //Si el tipo de archivo es Excel
						        			{
						        				$intPorcentajeSdoDoc = $intPorcentajeSdoDoc / 100;
						        			}

					        				//Agregar al array los datos del saldo por documento
											$arrDatosSdoDocPedidosMaq[$arrDoc->documento_pago_id][] = $intAcumSaldoDoc;
											$arrDatosSdoDocPedidosMaq[$arrDoc->documento_pago_id][] = $intPorcentajeSdoDoc;
										}
										
									}//Cierre de foreach formas de pago de maquinaria
									
                                }//Cierre de verificación del módulo de maquinaria

			        		}//Cierre de foreach (datos de la sucursal)

		        		}//Cierre de foreach (sucursales de la semana)

			        }//Cierre de foreach (saldos de la semana)

			        //Incrementar contador por cada semana recorrida
			        $intNumSemanaActual++;

		        }//Cierre de foreach (semanas del mes)

		        //Si el tipo de archivo es PDF
	            if($strTipoArchivo == 'PDF')
	            {
			        //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					//(se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
					//Saldo
					$lib->Row($arrDatosSdoSuc, 
			    		      $lib->arrAlineacion3, 'ClippedCell');

					//Saldo por vencer
					$lib->Row($arrDatosSdoVencer, 
			    			  $lib->arrAlineacion3, 'ClippedCell');

					//Saldo Vencido
					$lib->Row($arrDatosSdoVencido, 
			    		      $lib->arrAlineacion3, 'ClippedCell');

					
					//Si el módulo de maquinaria se encuentra seleccionado
					if($strModuloMaquinaria != '' && $otdDocPedidosMaq)
	                {
						//Hacer recorrido para obtener los datos de los documentos (saldos) de maquinaria
						foreach ($otdDocPedidosMaq as $arrDoc ) 
						{
							//Si existe saldo del documento
							if($arrAcumSdoDocPedidosMaq[$arrDoc->documento_pago_id] > 0)
							{
								//Saldo del documento (forma de pago)
								$lib->Row($arrDatosSdoDocPedidosMaq[$arrDoc->documento_pago_id], 
			    		      			  $lib->arrAlineacion3, 'ClippedCell'); 
							}

						}//Cierre de verificación de formas de pago

					}//Cierre de verificación del módulo de maquinaria

					$lib->Ln(3); //Deja un salto de línea
				}
				else //Si el tipo de archivo es Excel
				{

					//Asignar el número de columna donde se empezaran a escribir los datos 
					$intIndColE =  $this->archivoExcel['intIndColInicial'];
					
					//Hacer recorrido para obtener los datos del saldo
					foreach ($arrDatosSdoSuc as $arrDet) 
					{
						//Asignar columna actual
						$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaExcel;
						//Asignar indice de la columna: concepto
						$strColConcepto = 'B'.$intFilaExcel;
						//Asignar indice de la columna: sucursal
						$strColSucursal = 'A'.$intFilaExcel;

						//Agregar información del saldo
						$lib->getActiveSheet()
		                          ->setCellValue($strColActual, $arrDet);

		                //Si se cumple la sentencia
			            if($strColActual == $strColSucursal OR $strColActual != $strColConcepto)
		                {

					        //Hacer un llamado a la función para cambiar el estilo de la celda
					        $this->get_estilo_celda($lib, $strColActual);
		                }

		                //Incrementar indice de la columna
						$intIndColE++;     

					}//Cierre de foreach (saldo)

				    //Incrementar el indice para escribir los datos del siguiente registro
					$intFilaExcel++;

					//Inicializar variable para escribir el saldo por vencer
					$intIndColE =  $this->archivoExcel['intIndColInicial'];

					//Hacer recorrido para obtener los datos del saldo por vencer
					foreach ($arrDatosSdoVencer as $arrDet) 
					{	
						//Asignar columna actual
						$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaExcel;

						//Agregar información del saldo por vencer
						$lib->getActiveSheet()
		                    ->setCellValue($strColActual, $arrDet);
		                //Incrementar indice de la columna
						$intIndColE++;     
						
					}//Cierre de foreach (saldo por vencer)

					//Incrementar el indice para escribir los datos del siguiente registro
					$intFilaExcel++;

					//Inicializar variable para escribir el saldo vencido
					$intIndColE =  $this->archivoExcel['intIndColInicial'];

					//Hacer recorrido para obtener los datos del saldo vencido
					foreach ($arrDatosSdoVencido as $arrDet) 
					{
						//Asignar columna actual
						$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaExcel;

						//Agregar información del saldo vencido
						$lib->getActiveSheet()
		                    ->setCellValue($strColActual, $arrDet);
		                //Incrementar indice de la columna
						$intIndColE++;     

					}//Cierre de foreach (saldo vencido)

					//Si el módulo de maquinaria se encuentra seleccionado
					if($strModuloMaquinaria != '' && $otdDocPedidosMaq)
	                {
	                	//Hacer recorrido para obtener los datos de los documentos (saldos) de maquinaria
						foreach ($otdDocPedidosMaq as $arrDoc ) 
						{
							//Si existe saldo del documento
							if($arrAcumSdoDocPedidosMaq[$arrDoc->documento_pago_id] > 0)
							{
								//Incrementar el indice para escribir los datos del siguiente registro
								$intFilaExcel++;

								//Inicializar variable para escribir el saldo del documento
								$intIndColE =  $this->archivoExcel['intIndColInicial'];

								//Hacer recorrido para obtener los datos del saldo del documento
								foreach ($arrDatosSdoDocPedidosMaq[$arrDoc->documento_pago_id] as $arrDet) 
								{
									//Asignar columna actual
									$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaExcel;

									//Agregar información del saldo por documento (forma de pago)
									$lib->getActiveSheet()
					                    ->setCellValue($strColActual, $arrDet);
					                //Incrementar indice de la columna
									$intIndColE++;    

								}//Cierre de foreach (saldo del documento)
							}

						}//Cierre de verificación de formas de pago

					}//Cierre de verificación del módulo de maquinaria

					//Incrementar el indice para escribir los datos del siguiente registro
					$intFilaExcel+=2;

				}

			}//Cierre de foreach (sucursales seleccionadas)

			//Si el tipo de archivo es PDF
            if($strTipoArchivo == 'PDF')
            {
				$lib->Ln(-3);//Quitar un salto de línea
				$lib->Line(10, ($lib->GetY() + 0.4), 345, ($lib->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
				
				//Establece el ancho de las columnas
				$lib->SetWidths($arrAnchuraTotales);
				//Cambiar el volumen de la letra
				$lib->strTipoLetraTabla = 'Negrita';
				//Acumulados de los saldos generales por semana
		       $lib->Row($arrAcumuladoSdoGral, 
				    	  $arrAlineacionTotales, 'ClippedCell');
		        //Cambiar el volumen de la letra
				$lib->strTipoLetraTabla = 'Normal';
			}
			else //Si el tipo de archivo es Excel
			{
				//Asignar el número de columna donde se empezaran a escribir los totales 
				$intIndColE = $this->archivoExcel['intIndColInicial']+1;

				//Hacer recorrido para obtener los datos del saldo por vencer
				foreach ($arrAcumuladoSdoGral as $arrDet) 
				{	
					//Asignar columna actual
					$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaExcel;

					//Agregar información del saldo por vencer
					$lib->getActiveSheet()
	                    ->setCellValue($strColActual, $arrDet);

			        //Hacer un llamado a la función para cambiar el estilo de la celda
			        $this->get_estilo_celda($lib, $strColActual);

	                //Incrementar indice de la columna
					$intIndColE++;     
					
				}//Cierre de foreach (saldo por vencer)

			
			}
		}
		else //Concentrado de saldos por cada módulo seleccionado
		{

			//Agregar hoja por cada módulo seleccionado
			//Hacer recorrido para obtener las descripciones de los módulos 
			for ($intCon = 0; $intCon < sizeof($arrDescripcionesModulos); $intCon++) 
			{

				//Array que se utiliza para agregar los datos del saldo por módulo
				$arrAcumuladosSdoMod = array();
				
				//Variable que se utiliza para asignar el módulo
				$strModulo = $arrDescripcionesModulos[$intCon];
				//Variable que se utiliza para asignar el número de semanas con saldos (facturas con adeudos)
				$intNumRegistros = 0;

				//Agregar al array descripción del saldo general (por módulo)
				$arrAcumuladosSdoMod[] =  'TOTAL GLOBAL '.$strModulo.':';

				//Hacer recorrido para agregar a la cabecera las semanas del mes
		        foreach ($arrSemanas as $arrSem) 
		        {
		        	//Variable que se utiliza para identificar una semana (obtener sus datos)
			        $intPrimerDiaSemana = $arrSem['primer_dia'];

			        //Hacer recorrido para obtener los datos de la semana 
		        	foreach($arrSaldosSemanasMes["semana_".$intPrimerDiaSemana] as $arrDetSem) 
		        	{ 
	        			//Asignar el acumulado de saldos (de la semana) en el módulo 
	        			$intAcumSdoMod = $arrDetSem[0]['acumulado_modulo'][0][$intPrimerDiaSemana][$strModulo];

	        			//Si existen saldos en la semana
	        			if($intAcumSdoMod > 0)
	        			{
	        				//Incrementar contador por cada semana con saldos (facturas con adeudos)
	        				$intNumRegistros++;
	        			}

	        			//Si el tipo de archivo es PDF
   					    if($strTipoArchivo == 'PDF')
	        			{
	        				//Convertir cantidad a formato moneda
	        				$intAcumSdoMod = '$'.number_format($intAcumSdoMod,2);
	        			}

	        			//Agregar al array los datos del saldo
	        			$arrAcumuladosSdoMod[] = $intAcumSdoMod;
	        			$arrAcumuladosSdoMod[] = '';
		        	}
		        }

		        //Si existen semanas con saldos (facturas con adeudos)
		        if($intNumRegistros > 0)
		        {
		        	//Concatenar moneda para el primer encabezado del reporte
					$strTituloMoneda = $strTituloModLinea1.' '.$strModulo.' EN '.$strMoneda;

					//Si el tipo de archivo es PDF
		            if($strTipoArchivo == 'PDF')
		            {
						//Asignar el valor de la descripción (título de la lista de registros) del reporte
						$lib->strLinea1 = $strTituloMoneda.' '.$strTituloMesAnio;
					   //Quitar el valor de la línea tres del título (módulos seleccionados)
						$lib->strLinea3 = '';

						//Agregar pagina
						$lib->AddPage();

						//Establece el ancho de las columnas
						$lib->SetWidths($lib->arrAnchura3);
					}
					else //Si el tipo de archivo es Excel
					{

						//Asignar el nombre de la hoja
						$strNombreHoja = $strModulo.'_'.$strCodigoMoneda;

						//Número de fila donde se va a comenzar a rellenar
						$intFilaExcel = $this->archivoExcel['intFilaInicial'];


					    //Hacer un llamado a la función para agregar (o activar) una hoja en el archivo excel
						$intContadorHojas = $this->get_hoja_archivo_excel($lib, $strNombreHoja, $intContadorHojas);


						//Hacer un llamado a la función para escribir el encabezado en el archivo excel
						$this->get_encabezado_archivo_xls($lib, $strTituloMoneda, $strTituloSucursales, 
													      NULL, $arrCabecera, $arrCabecera2, 
													       $arrCabecera3);
						

					}	

					//Hacer recorrido para obtener los datos de las sucursales seleccionadas (por cada módulo)
					foreach ($arrSucursales as $arrSuc)
					{
						
						//Array que se utiliza para agregar los datos del saldo 
						$arrDatosSdoSuc = array();
						//Array que se utiliza para agregar los datos del saldo por vencer
						$arrDatosSdoVencer = array();
						//Array que se utiliza para agregar los datos del saldo vencido
						$arrDatosSdoVencido = array();
						//Array que se utiliza para agregar los datos del saldo de maquinaria (por forma de pago)
						$arrDatosSdoDocPedidosMaq = array();
						//Array que se utiliza para verificar si la forma de pago tiene saldo (en caso de no existir saldo del documento no se muestra la forma de pago recorrida)
						$arrAcumSdoDocPedidosMaq = array();

						//Asignar el nombre de la sucursal
						$strSucursal = $arrSuc['nombre'];

						//Si el tipo de archivo es PDF
   					    if($strTipoArchivo == 'PDF')
	        			{
	        				//Se concatena |Negrita -> para cambiar el volumen de la fuente a bold
	        				$strSucursal = utf8_decode($strSucursal.'|Negrita');
	        			}

						//Agregar al array descripción de la sucursal
						$arrDatosSdoSuc[] = $strSucursal;
						$arrDatosSdoSuc[] = 'TOTAL';

						//Agregar al array descripción del saldo por vencer
						$arrDatosSdoVencer[] = '';
						$arrDatosSdoVencer[] = 'POR VENCER';

						//Agregar al array descripción del saldo vencido
						$arrDatosSdoVencido[] = '';
						$arrDatosSdoVencido[] = 'VENCIDO';

						//Si el módulo corresponde a Maquinaria
						if($strModulo == 'MAQUINARIA')
						{
							//Seleccionar los datos de los documentos de pedidos de maquinaria (pagos)
							$otdDocPedidosMaq = $this->pedidos_maquinaria->buscar_distintas_formas_pago($arrSuc['sucursal_id'], 
																										$dteFechaFinal, 
																										$intMonedaID);
							//Si hay información
							if($otdDocPedidosMaq)
							{
								//Hacer recorrido para obtener los documentos de pago
								foreach ($otdDocPedidosMaq as $arrDoc) 
								{
									//Asignar la descripción de la forma de pago (documento de pago)
									$strDescripcion = $arrDoc->descripcion;

									//Si el tipo de archivo es PDF
	           					    if($strTipoArchivo == 'PDF')
				        			{
				        				//Se utiliza utf8 para acentos y tildes
				        				$strDescripcion = utf8_decode($strDescripcion);
				        			}

									//Agregar al array descripción del documento (pedidos de maquinaria)
	           						$arrDatosSdoDocPedidosMaq[$arrDoc->documento_pago_id][] = '';
	           						$arrDatosSdoDocPedidosMaq[$arrDoc->documento_pago_id][] = $strDescripcion;
	           						//Inicializar variables
	           						$arrAcumSdoDocPedidosMaq[$arrDoc->documento_pago_id] = 0;

								}//Cierre de foreach formas de pago de maquinaria

							}//Cierre de verificación de formas de pago

						}//Cierre de verificación del módulo de maquinaria

						//Hacer recorrido para obtener las semanas del mes
					    foreach ($arrSemanas as $arrSem) 
				        {
				        	//Variable que se utiliza para identificar una semana (obtener sus datos)
				        	$intPrimerDiaSemana = $arrSem['primer_dia'];

				        	//Hacer recorrido para obtener los datos de la semana 
				        	foreach($arrSaldosSemanasMes["semana_".$intPrimerDiaSemana] as $arrDetSem) 
				        	{ 

			        			//Hacer recorrido para obtener las sucursales de la semana
			        			foreach($arrDetSem[0]['sucursales'] as $arrSucSem) 
			        			{
			        				//Hacer recorrido para obtener los datos de la sucursal 
					        		foreach($arrSucSem["sucursal_".$arrSuc['sucursal_id']] as $arrDetSuc)
					        		{

				        				//Hacer recorrido para obtener los datos del módulo
				        				foreach($arrDetSuc[0]['modulos'] as $arrModSuc)
					        			{
					        				//Variables que se utilizan para asignar los datos del saldo (de la sucursal)
					        				$intAcumSdoSuc = $arrModSuc[$strModulo][0]['saldo'];
					        				$intPorcentajeSdoSuc = $arrModSuc[$strModulo][0]['porcentaje_saldo'];
					        				//Variables que se utilizan para asignar los datos del saldo por vencer (de la sucursal)
					        				$intAcumSdoVencerSuc =$arrModSuc[$strModulo][0]['saldo_vencer'];
					        				$intPorcentajeSdoVencerSuc = $arrModSuc[$strModulo][0]['porcentaje_saldo_vencer'];
					        				//Variables que se utilizan para asignar los datos del saldo vencido (de la sucursal)
					        				$intAcumSdoVencidoSuc = $arrModSuc[$strModulo][0]['saldo_vencido'];
					        				$intPorcentajeSdoVencidoSuc = $arrModSuc[$strModulo][0]['porcentaje_saldo_vencido'];


					        				//Si el tipo de archivo es PDF
			           					    if($strTipoArchivo == 'PDF')
						        			{
						        				//Convertir cantidad a formato moneda
						        				//Se concatena |Negrita -> para cambiar el volumen de la fuente a bold
						        				//Acumulado del saldo
						        				$intAcumSdoSuc =  '$'.number_format($intAcumSdoSuc,2).'|Negrita';
						        				$intPorcentajeSdoSuc .= '%|Negrita';

						        				//Acumulado del saldo por vencer
						        				$intAcumSdoVencerSuc =  '$'.number_format($intAcumSdoVencerSuc,2);
						        				$intPorcentajeSdoVencerSuc .= '%';

						        				//Acumulado del saldo vencido
						        				$intAcumSdoVencidoSuc =  '$'.number_format($intAcumSdoVencidoSuc,2);
						        				$intPorcentajeSdoVencidoSuc .= '%';
						        			}
						        			else //Si el tipo de archivo es Excel
						        			{
						        				$intPorcentajeSdoSuc = $intPorcentajeSdoSuc / 100;
						        				$intPorcentajeSdoVencerSuc = $intPorcentajeSdoVencerSuc / 100;
						        				$intPorcentajeSdoVencidoSuc = $intPorcentajeSdoVencidoSuc / 100;
						        			}

					        				//Agregar al array los datos del saldo
					        				$arrDatosSdoSuc[] = $intAcumSdoSuc;
					        				$arrDatosSdoSuc[] = $intPorcentajeSdoSuc;

					        				//Agregar al array los datos del saldo por vencer
			                                $arrDatosSdoVencer[] = $intAcumSdoVencerSuc;
			                                $arrDatosSdoVencer[] = $intPorcentajeSdoVencerSuc;

			                                //Agregar al array los datos del saldo vencido
			                                $arrDatosSdoVencido[] = $intAcumSdoVencidoSuc;
			                                $arrDatosSdoVencido[] = $intPorcentajeSdoVencidoSuc;

			                                //Si el módulo corresponde a Maquinaria
			                                if($strModulo == 'MAQUINARIA' && $otdDocPedidosMaq)
			                                {
												//Hacer recorrido para obtener saldos de los documentos de pago
												foreach ($otdDocPedidosMaq as $arrDoc) 
												{
													//Asignar el saldo del documento
													$intAcumSaldoDoc = $arrModSuc[$strModulo][0]['saldo_maquinaria'][$arrDoc->documento_pago_id];
													//Asignar el porcentaje que le corresponde al saldo del documento
													$intPorcentajeSdoDoc = $arrModSuc[$strModulo][0]['porcentaje_saldo_maquinaria'][$arrDoc->documento_pago_id];

													//Si existe saldo del documento
													if($intAcumSaldoDoc > 0)
													{
														//Incrementar acumulado del saldo por documento
														$arrAcumSdoDocPedidosMaq[$arrDoc->documento_pago_id] += $intAcumSaldoDoc;

														//Si el tipo de archivo es PDF
						           					    if($strTipoArchivo == 'PDF')
									        			{
									        				//Acumulado del saldo por documento
									        				$intAcumSaldoDoc =  '$'.number_format($intAcumSaldoDoc,2);
									        				$intPorcentajeSdoDoc .= '%';

									        			}
									        			else //Si el tipo de archivo es Excel
									        			{
									        				$intPorcentajeSdoDoc = $intPorcentajeSdoDoc / 100;
									        			}

								        				//Agregar al array los datos del saldo por documento
														$arrDatosSdoDocPedidosMaq[$arrDoc->documento_pago_id][] = $intAcumSaldoDoc;
														$arrDatosSdoDocPedidosMaq[$arrDoc->documento_pago_id][] = $intPorcentajeSdoDoc;
													}
													
												}//Cierre de foreach formas de pago de maquinaria
												
			                                }//Cierre de verificación del módulo de maquinaria

						        		}//Cierre de foreach (datos del módulo)
					        			
					        		}//Cierre de foreach (datos de la sucursal)

			        			}//Cierre de foreach (sucursales de la semana)

							}//Cierre de foreach (saldos de la semana)
						   

				        }//Cierre de foreach (semanas del mes)

				        //Si el tipo de archivo es PDF
			            if($strTipoArchivo == 'PDF')
			            {
					        //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							//(se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
							$lib->Row($arrDatosSdoSuc, 
					    			  $lib->arrAlineacion3, 'ClippedCell');

							//Saldo por vencer
							$lib->Row($arrDatosSdoVencer, 
					    			  $lib->arrAlineacion3, 'ClippedCell');

							//Saldo Vencido
							$lib->Row($arrDatosSdoVencido, 
					    		      $lib->arrAlineacion3, 'ClippedCell');

							//Si el módulo corresponde a Maquinaria
							if($strModulo == 'MAQUINARIA' && $otdDocPedidosMaq)
			                {
								//Hacer recorrido para obtener los datos de los documentos (saldos) de maquinaria
								foreach ($otdDocPedidosMaq as $arrDoc ) 
								{
									//Si existe saldo del documento
									if($arrAcumSdoDocPedidosMaq[$arrDoc->documento_pago_id] > 0)
									{
										//Saldo del documento (forma de pago)
										$lib->Row($arrDatosSdoDocPedidosMaq[$arrDoc->documento_pago_id], 
					    		      			  $lib->arrAlineacion3, 'ClippedCell'); 
									}

								}//Cierre de verificación de formas de pago

							}//Cierre de verificación del módulo de maquinaria


						    $lib->Ln(3); //Deja un salto de línea
						}
						else //Si el tipo de archivo es Excel
						{
							//Asignar el número de columna donde se empezaran a escribir los datos 
							$intIndColE =  $this->archivoExcel['intIndColInicial'];

							//Hacer recorrido para obtener los datos del saldo
							foreach ($arrDatosSdoSuc as $arrDet) 
							{
								//Asignar columna actual
								$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaExcel;
								//Asignar indice de la columna: concepto
								$strColConcepto = 'B'.$intFilaExcel;
								//Asignar indice de la columna: sucursal
								$strColSucursal = 'A'.$intFilaExcel;

								//Agregar información del saldo
								$lib->getActiveSheet()
		                         	->setCellValue($strColActual, $arrDet);

		                        //Si se cumple la sentencia
					            if($strColActual == $strColSucursal OR $strColActual != $strColConcepto)
				                {
							        //Hacer un llamado a la función para cambiar el estilo de la celda
							        $this->get_estilo_celda($lib, $strColActual);
				                }

		                        //Incrementar indice de la columna
								$intIndColE++;     

							}//Cierre de foreach (saldo)

							//Incrementar el indice para escribir los datos del siguiente registro
							$intFilaExcel++;

							//Inicializar variable para escribir el saldo por vencer 
							$intIndColE =  $this->archivoExcel['intIndColInicial'];

							//Hacer recorrido para obtener los datos del saldo por vencer
							foreach ($arrDatosSdoVencer as $arrDet) 
							{	
								//Asignar columna actual
								$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaExcel;

								//Agregar información del saldo por vencer
								$lib->getActiveSheet()
				                    ->setCellValue($strColActual, $arrDet);
				                //Incrementar indice de la columna
								$intIndColE++;     
								
							}//Cierre de foreach (saldo por vencer)

							//Incrementar el indice para escribir los datos del siguiente registro
							$intFilaExcel++;

							//Inicializar variable para escribir el saldo vencido
							$intIndColE =  $this->archivoExcel['intIndColInicial'];

							//Hacer recorrido para obtener los datos del saldo vencido
							foreach ($arrDatosSdoVencido as $arrDet) 
							{
								//Asignar columna actual
								$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaExcel;

								//Agregar información del saldo vencido
								$lib->getActiveSheet()
				                    ->setCellValue($strColActual, $arrDet);
				                //Incrementar indice de la columna
								$intIndColE++;  

							}//Cierre de foreach (saldo vencido)

							//Si el módulo corresponde a Maquinaria
							if($strModulo == 'MAQUINARIA' && $otdDocPedidosMaq)
			                {
			                	//Hacer recorrido para obtener los datos de los documentos (saldos) de maquinaria
								foreach ($otdDocPedidosMaq as $arrDoc ) 
								{
									//Si existe saldo del documento
									if($arrAcumSdoDocPedidosMaq[$arrDoc->documento_pago_id] > 0)
									{
										//Incrementar el indice para escribir los datos del siguiente registro
										$intFilaExcel++;

										//Inicializar variable para escribir el saldo del documento
										$intIndColE =  $this->archivoExcel['intIndColInicial'];

										//Hacer recorrido para obtener los datos del saldo del documento
										foreach ($arrDatosSdoDocPedidosMaq[$arrDoc->documento_pago_id] as $arrDet) 
										{
											//Asignar columna actual
											$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaExcel;

											//Agregar información del saldo por documento (forma de pago)
											$lib->getActiveSheet()
							                    ->setCellValue($strColActual, $arrDet);
							                //Incrementar indice de la columna
											$intIndColE++;  

										}//Cierre de foreach (saldo del documento)
									}

								}//Cierre de verificación de formas de pago

			                }//Cierre de verificación del módulo de maquinaria


							//Incrementar el indice para escribir los datos del siguiente registro
							$intFilaExcel+=2;

						}

					}//Cierre de foreach (sucursales seleccionadas)

					//Si el tipo de archivo es PDF
		            if($strTipoArchivo == 'PDF')
		            {
						$lib->Ln(-3);//Quitar un salto de línea
						$lib->Line(10, ($lib->GetY() + 0.4), 345, ($lib->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
						//Establece el ancho de las columnas
						$lib->SetWidths($arrAnchuraTotales);
						//Cambiar el volumen de la letra
						$lib->strTipoLetraTabla = 'Negrita';
						//Acumulados de los saldos del módulo por semana
						$lib->Row($arrAcumuladosSdoMod, 
					    		  $arrAlineacionTotales, 'ClippedCell');
						//Cambiar el volumen de la letra
						$lib->strTipoLetraTabla = 'Normal';
					}
					else //Si el tipo de archivo es Excel
					{
						//Asignar el número de columna donde se empezaran a escribir los totales 
						$intIndColE =  $this->archivoExcel['intIndColInicial']+1;

						//Hacer recorrido para obtener los datos del saldo vencido
						foreach ($arrAcumuladosSdoMod as $arrDet) 
						{
							//Asignar columna actual
							$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaExcel;

							//Agregar información del saldo vencido
							$lib->getActiveSheet()
			                    ->setCellValue($strColActual, $arrDet);

			                //Hacer un llamado a la función para cambiar el estilo de la celda
			                $this->get_estilo_celda($lib, $strColActual);

			                //Incrementar indice de la columna
							$intIndColE++;  

						}//Cierre de foreach (saldo vencido)


						//Hacer un llamado a la función para cambiar el estilo de las celdas
			            $this->get_estilo_celda($lib, NULL, $arrCabecera3, $intFilaExcel);

						//Incrementar contador por cada módulo
						$intContadorHojas++;
					}


		        }//Cierre de verificación de información de saldos
				

			}//Cierre del for (módulos seleccionados)
		}

		//Si el tipo de archivo es Excel
        if($strTipoArchivo == 'EXCEL')
        {
        	//Agregar datos al array
		    $arrDatosExcel['fila'] = $intFilaExcel;
		    $arrDatosExcel['contador_hoja'] = $intContadorHojas;

            //Regresar indices para ecribir los datos del siguiente registro
            return  $arrDatosExcel;
        }
		
    }


    //Función que se utiliza para cambiar el estilo de las celadas del archivo Excel
    public function get_estilo_celda($lib, $strColActual = NULL, $arrCabecera3 = NULL, $intUltimaFila = NULL)
    {
    	//Definir estilo para cambiar el formato de la celda a porcentaje
        $arrStylePorcentaje = array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    	//Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));


        //Si existe columna actual 
        if($strColActual != NULL)
        {
        	//Cambiar estilo de la  celda
	        $lib->getActiveSheet()
	            ->getStyle($strColActual)
	            ->applyFromArray($arrStyleBold);

        }
    	

        //Si existen datos de la cabecera 3
        if($arrCabecera3)
        {
        	$intIndiceCol = 1;

	        //Hacer recorrido para obtener los datos de la cabecera 3
	        foreach ($arrCabecera3 as $arrDet) 
	        {
	        	//Asignar columna actual
	        	$strColActual = $this->ARR_COLUMNAS[$intIndiceCol];

	        	//Si la descripción de la columna es MONTO o Porcentaje
	        	if($arrDet == 'MONTO' OR $arrDet == '%')
	        	{

	        		//Si la descripción de la columna es Monto
	        		if($arrDet == 'MONTO')
	        		{
	        		    //Cambiar contenido de las celdas a formato moneda
		           		$lib->getActiveSheet()
		            		->getStyle($strColActual.$this->archivoExcel['intFilaInicial'].':'.$strColActual.$intUltimaFila)
		            		->getNumberFormat()
		            		->setFormatCode('$#,##0.00');
	        		}
	        		else
	        		{
	        			//Cambiar contenido de las celdas a formato porcentaje
						$lib->getActiveSheet()
			                ->getStyle($strColActual.$this->archivoExcel['intFilaInicial'].':'.$strColActual.$intUltimaFila)
			                ->getNumberFormat()
			            	->applyFromArray($arrStylePorcentaje);
	        		}

	        		//Cambiar alineación de las siguientes celdas
	        		$lib->getActiveSheet()
				        	 ->getStyle($strColActual.$this->archivoExcel['intFilaInicial'].':'.$strColActual.$intUltimaFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);
	        		
	        	}

	        	//Incrementar indice de la columna
	        	$intIndiceCol++;

	   		}//Cierre de foreach (cabecera 3)
        }
        

    }

	//Función que se utiliza para regresar los saldos del mes
    public function get_saldos_mes($dteFechaInicial, $dteFechaFinal, $intMonedaID, 
    							   $arrSemanas, $arrSucursales, $strSucursales, $strModulos, 
    							   $arrDescripcionesModulos, $strMes, $strAnio, $strModuloMaquinaria)
    {


    	//Array que se utiliza para agregar los datos de las semanas del mes
    	$arrSdoSemanas = array();
    	//Array que se utiliza para agregar los datos del módulo/sucursal/semana
        $arrAuxiliar = array();
        //Array que se utiliza para agregar los saldos generales por semana
		$arrAcumuladoSdoGral = array();
		//Variable que se utiliza para asignar el número de facturas con saldo  
		$intContadorFrasSdo = 0;

        //Seleccionar los datos de las facturas (con saldo) que coinciden con el parámetro enviado
		$otdResultado = $this->pagos->buscar_facturas_importes('reporte', $dteFechaFinal, NULL, 
																NULL, $intMonedaID, NULL, NULL, 
																NULL, $strSucursales, 
																$strModulos, NULL, NULL, 'saldo');

        //Hacer recorrido para obtener las semanas del mes
		foreach ($arrSemanas as $arrSem) 
        {
        	//Variable que se utiliza para identificar una semana (obtener sus datos)
        	$intPrimerDiaSemana = $arrSem['primer_dia'];
        	//Variable que se utiliza para asignar la fecha final de la semana
        	$dteFechaFinalSem =  $strAnio.'-'.$strMes.'-'.$arrSem['ultimo_dia'];
        	//Array que se utiliza para agregar los datos de las sucursales
        	$arrSucursalesSem = array();
        	//Array que se utiliza para agregar las sucursales y acumulados de la semana
			$arrDetallesSem  = array();
			//Array que se utiliza para agregar los saldos por módulo
        	$arrAcumuladoSaldoMod = array();
        	//Inicializar array 
        	$arrAcumuladoSdoGral[$intPrimerDiaSemana] = 0;

        	//Hacer recorrido para obtener las descripciones de los módulos 
			for ($intContMod = 0; $intContMod < sizeof($arrDescripcionesModulos); $intContMod++) 
			{
				//Asignar la descripción del módulo
				$strModulo = $arrDescripcionesModulos[$intContMod];

				//Inicializar variables
				$arrAcumuladoSaldoMod[$intPrimerDiaSemana][$strModulo] = 0;

			}


        	//Hacer recorrido para obtener las sucursales seleccionadas
        	foreach ($arrSucursales as $arrSuc)
			{
				//Array que se utiliza para agregar los datos de los módulos
				$arrModulosSuc = array();
				//Variable que se utiliza para asignar el saldo vencido por sucursal
				$intSaldoVencidoSuc = 0;
				//Variable que se utiliza para asignar el saldo por vencer por sucursal
				$intSaldoVencerSuc = 0;
				//Variable que se utiliza para asignar el saldo de los documentos (formas de pago -> pedidos de maquinaria) por sucursal
				$intSaldoDocPedidosMaqSuc = 0;
				//Variable que se utiliza para asignar el saldo por sucursal
				$intSaldoSuc = 0;
				//Array que se utiliza para asignar el saldo del documento (formas de pago -> pedidos de maquinaria) por sucursal
				$arrSaldoDocPedidosMaqSuc = array(); 
				//Array que se utiliza para asignar el porcentaje que le corresponde al saldo por documento sobre el saldo total (de la sucursal)
			    $arrPorcentajeDocPedidosMaqSuc = array(); 

				//Array que se utiliza para agregar los módulos y acumulados de la sucursal
				$arrDetallesSuc = array();

				//Si el módulo de maquinaria se encuentra seleccionado
				if($strModuloMaquinaria != '')
				{
					//Seleccionar los datos de los documentos de pedidos de maquinaria (pagos)
					$otdDocPedidosMaq = $this->pedidos_maquinaria->buscar_distintas_formas_pago($arrSuc['sucursal_id'], 
																								$dteFechaFinal, 
																								$intMonedaID);
					//Si hay información
					if($otdDocPedidosMaq)
					{
						//Hacer recorrido para obtener el id de los documentos (formas de pago -> pedidos de maquinaria)
						foreach ($otdDocPedidosMaq as $arrDoc) 
						{
       						//Inicializar variables
							$arrSaldoDocPedidosMaqSuc[$arrDoc->documento_pago_id] = 0;
							$arrPorcentajeDocPedidosMaqSuc[$arrDoc->documento_pago_id] = 0;

						}//Cierre de foreach formas de pago de maquinaria


					}//Cierre de verificación de formas de pago


				}//Cierre de verificación del módulo de maquinaria

				//Hacer recorrido para obtener las descripciones de los módulos 
				for ($intContMod = 0; $intContMod < sizeof($arrDescripcionesModulos); $intContMod++) 
				{

					//Asignar la descripción del módulo
					$strModulo = $arrDescripcionesModulos[$intContMod];
					//Inicializar array para agregar los saldos del módulo
					$arrModulosSuc[$strModulo] = array();
					//Inicializar array para agregar los datos de un módulo
       				$arrAuxiliar = array();
					//Variable que se utiliza para asignar el saldo vencido
					$intSaldoVencido = 0;
					//Variable que se utiliza para asignar el saldo por vencer
					$intSaldoVencer = 0;
					//Variable que se utiliza para asignar el saldo por documentos (forma de pago) del pedido de maquinaria
					$intSaldoDocPedidosMaq = 0;
					//Array que se utiliza para asignar el saldo por documento (forma de pago) del pedido de maquinaria
					$arrSaldoDocPedidosMaq = array(); 
					//Variable que se utiliza para asignar el saldo
					$intSaldo = 0;
					//Asignar el porcentaje del saldo total
					$intPorcentajeGral = 100;
					//Variable que se utiliza para asignar el porcentaje que le corresponde al saldo vencido sobre el saldo total
					$intPorcentajeSdoVencido = 0;
					//Variable que se utiliza para asignar el porcentaje que le corresponde al saldo por vencer sobre el saldo total
					$intPorcentajeSdoVencer = 0;
					//Array que se utiliza para asignar el porcentaje que le corresponde al saldo por documento sobre el saldo total
					$arrPorcentajeDocPedidosMaq = array(); 

					//Si el módulo corresponde a Maquinaria
					if($strModulo == 'MAQUINARIA' && $otdDocPedidosMaq)
					{
						//Hacer recorrido para obtener el id de los documentos (formas de pago -> pedidos de maquinaria)
						foreach ($otdDocPedidosMaq as $arrDoc) 
						{
       						//Inicializar variables
							$arrSaldoDocPedidosMaq[$arrDoc->documento_pago_id] = 0;
							$arrPorcentajeDocPedidosMaq[$arrDoc->documento_pago_id] = 0;

						}//Cierre de foreach formas de pago de maquinaria

					}//Cierre de verificación del módulo
										

					//Si hay información
		        	if($otdResultado)
					{
						//Recorremos el arreglo para obtener los datos de las facturas
						foreach ($otdResultado as $arrCol)
						{
							//Asignar el saldo de la factura
							$intSaldoFactura = $arrCol->saldo;
							//Variable que se utiliza para asignar el id de la factura
						    $intReferenciaID = $arrCol->referencia_id;
						    //Variable que se utiliza para asignar el tipo de referencia (MAQUINARIA/REFACCIONES/SERVICIO/CARTERA) de la factura 
						    $strTipoReferencia =  $arrCol->tipo_referencia;


                    	    //Si la factura no se encuentra pagada
							//if (($intSaldoFactura >= 1) OR ($intSaldoFactura <= -1)) //Validación anterior
							if($intSaldoFactura > 0)
							{

								//Asignar acumulado de abonos (pagos) de la factura
								$intTotalAbonos = $arrCol->abonos;

								//Si la factura pertenece a la sucursal y al módulo
								if($arrCol->sucursal_id == $arrSuc['sucursal_id'] && 
								    $arrCol->modulo == $strModulo)
								{

									//Si el tipo de referencia corresponde a una factura de maquinaria
									if($strModulo == 'MAQUINARIA' && $strTipoReferencia == 'MAQUINARIA')
									{
										
										//Seleccionar los pagos del pedido de maquinaria
										$otdPedidosMaq = $this->pedidos_maquinaria->buscar_formas_pago(NULL, 
																									  $intReferenciaID);
										
										//Si hay información
										if($otdPedidosMaq)
										{
											//Hacer recorrido para obtener los pagos del pedido de maquinaria
											foreach ($otdPedidosMaq as $arrDoc) 
											{
												//Asignar el importe de la forma de pago (pago del pedido)
												$intImpDocPago = $arrDoc->importe;

												
												//Si se cumple la sentencia (decrementar el acumulado de abonos)
												if($intTotalAbonos >= $intImpDocPago)
												{
													//Decrementar el acumulado de los abonos
													$intTotalAbonos -= $intImpDocPago;
													//Asignar valor cero para indicar que el pago ya esta saldado 
													$intImpDocPago = 0;
												}
												else
												{
													//Decrementar el importe del documento
													$intImpDocPago -= $intTotalAbonos;
													//Asignar valor cero para indicar que los abonos corresponden al documento
													$intTotalAbonos = 0;
												}	

												//Si el documento del pago es PAGARÉ, ENGANCHE O CONTADO
												if($arrDoc->documento_pago_id == DOCUMENTO_PAGO_ENGANCHE OR 
													$arrDoc->documento_pago_id == DOCUMENTO_PAGO_PAGARE OR
													$arrDoc->documento_pago_id == DOCUMENTO_PAGO_CONTADO)
												{
													//Si la fecha de vencimiento se encuentra en el rango de fechas (semana)
								                    if ($arrDoc->fecha_vencimiento <= $dteFechaFinalSem)
								                    {
								                    	//Incrementar acumulado del saldo vencido por módulo
				                        			    $intSaldoVencido += $intImpDocPago;
				                        			    //Incrementar acumulado del saldo vencido por sucursal
				                        			    $intSaldoVencidoSuc += $intImpDocPago;
								                    }
								                    else
								                    {
								                    	//Incrementar acumulado del saldo por vencer por módulo
								                    	$intSaldoVencer += $intImpDocPago;
								                    	//Incrementar acumulado del saldo por vencer por sucursal
								                    	$intSaldoVencerSuc += $intImpDocPago;
								                    }
								                }
								                else
												{

			      							        //Incrementar acumulado del saldo del documento por módulo
			      							        $intSaldoDocPedidosMaq += $intImpDocPago;
			      							        $arrSaldoDocPedidosMaq[$arrDoc->documento_pago_id] += $intImpDocPago;
			      							        //Incrementar acumulado del saldo del documento por sucursal
			      							        $intSaldoDocPedidosMaqSuc += $intImpDocPago;
			      							        $arrSaldoDocPedidosMaqSuc[$arrDoc->documento_pago_id] += $intImpDocPago;
												}

											}//Cierre de foreach pagos del pedido de maquinaria

										}
										else
										{
											//Si la fecha de vencimiento se encuentra en el rango de fechas (semana)
						                    if ($arrCol->fecha_vencimiento <= $dteFechaFinalSem)
						                    {
						                    	//Incrementar acumulado del saldo vencido por módulo
		                        			    $intSaldoVencido += $intSaldoFactura;
		                        			    //Incrementar acumulado del saldo vencido por sucursal
		                        			    $intSaldoVencidoSuc += $intSaldoFactura;
						                    }
						                    else
						                    {
						                    	//Incrementar acumulado del saldo por vencer por módulo
						                    	$intSaldoVencer += $intSaldoFactura;
						                    	//Incrementar acumulado del saldo por vencer por sucursal
						                    	$intSaldoVencerSuc += $intSaldoFactura;
						                    }
										}
									}
									else //Si el módulo es diferente de maquinaria
									{
										//Si la fecha de vencimiento se encuentra en el rango de fechas (semana)
					                    if ($arrCol->fecha_vencimiento <= $dteFechaFinalSem)
					                    {
					                    	//Incrementar acumulado del saldo vencido por módulo
	                        			    $intSaldoVencido += $intSaldoFactura;
	                        			    //Incrementar acumulado del saldo vencido por sucursal
	                        			    $intSaldoVencidoSuc += $intSaldoFactura;
					                    }
					                    else
					                    {
					                    	//Incrementar acumulado del saldo por vencer por módulo
					                    	$intSaldoVencer += $intSaldoFactura;
					                    	//Incrementar acumulado del saldo por vencer por sucursal
					                    	$intSaldoVencerSuc += $intSaldoFactura;
					                    }
									}

				                    //Incrementar contador por cada factura con saldo
				                    $intContadorFrasSdo++;
								}

							}//Cierre de verificación del saldo

						}

					}//Cierre de verificación de información


					//Calcular el saldo del módulo (en la semana)
					$intSaldo = $intSaldoVencido + $intSaldoVencer + $intSaldoDocPedidosMaq;

					//Si no existe saldo total
					if($intSaldo == 0)
					{
						//Asignar valor cero para evitar confusiones
						$intPorcentajeGral = 0;
					}

					//Si existe saldo vencido
					if($intSaldoVencido > 0)
					{
						//Calcular el porcentaje que le corresponde al saldo vencido
						$intPorcentajeSdoVencido = ($intSaldoVencido * $intPorcentajeGral) / $intSaldo;
					}
					
					//Si existe saldo por vencer
					if($intSaldoVencer > 0)
					{
						//Calcular el porcentaje que le corresponde al saldo por vencer
						$intPorcentajeSdoVencer = ($intSaldoVencer * $intPorcentajeGral) / $intSaldo;
					}
					
					
					//Si existe saldo de los documentos (formas de pago) de pedidos de maquinaria
					if($intSaldoDocPedidosMaq > 0)
					{

						//Hacer recorrido para obtener saldo de los documentos (formas de pago)
						foreach ($otdDocPedidosMaq as $arrDoc) 
						{
							//Asignar el saldo del documento
							$intSaldoDoc = $arrSaldoDocPedidosMaq[$arrDoc->documento_pago_id];

							//Calcular el porcentaje que le corresponde al saldo del documento
							$intPorcentajeSdoDoc =  ($intSaldoDoc * $intPorcentajeGral) / $intSaldo;

							//Convertir cantidad a dos decimales
							$intPorcentajeSdoDoc = number_format($intPorcentajeSdoDoc, 2, '.','');

							//Asignar valores del array
			      			$arrPorcentajeDocPedidosMaq[$arrDoc->documento_pago_id] = $intPorcentajeSdoDoc;

						}//Cierre de foreach formas de pago de maquinaria
					}

					//Convertir cantidad a dos decimales
					$intPorcentajeGral = number_format($intPorcentajeGral, 2, '.','');
					$intPorcentajeSdoVencido = number_format($intPorcentajeSdoVencido, 2, '.','');
					$intPorcentajeSdoVencer = number_format($intPorcentajeSdoVencer, 2, '.','');

					//Definir valores del array auxiliar de información (para cada módulo)
					$arrAuxiliar["saldo"] = $intSaldo;
					$arrAuxiliar["porcentaje_saldo"] = $intPorcentajeGral;
					$arrAuxiliar["saldo_vencido"] = $intSaldoVencido;
					$arrAuxiliar["porcentaje_saldo_vencido"] = $intPorcentajeSdoVencido; 
					$arrAuxiliar["saldo_vencer"] = $intSaldoVencer;
					$arrAuxiliar["porcentaje_saldo_vencer"] = $intPorcentajeSdoVencer;
					$arrAuxiliar["saldo_maquinaria"] = $arrSaldoDocPedidosMaq;
					$arrAuxiliar["porcentaje_saldo_maquinaria"] = $arrPorcentajeDocPedidosMaq;
					//Agregar datos al array
				    array_push($arrModulosSuc[$strModulo], $arrAuxiliar);

				   //Incrementar valores de los siguientes arrays
				   $arrAcumuladoSaldoMod[$intPrimerDiaSemana][$strModulo] += $intSaldo;
				   $arrAcumuladoSdoGral[$intPrimerDiaSemana] += $intSaldo;

				}//Cierre del for (módulos)

				//Calcular el saldo de la sucursal (en la semana)
				$intSaldoSuc = $intSaldoVencidoSuc + $intSaldoVencerSuc + $intSaldoDocPedidosMaqSuc;
				//Asignar el porcentaje del saldo total
			    $intPorcentajeGral = 100;
				//Inicializar variables para calcular porcentajes de los saldos por cada sucursal
				$intPorcentajeSdoVencido = 0;
				$intPorcentajeSdoVencer = 0;
				//Inicializar array para agregar los datos de una sucursal
       			$arrAuxiliar = array();

       			//Si no existe saldo total
				if($intSaldoSuc == 0)
				{
					//Asignar valor cero para evitar confusiones
					$intPorcentajeGral = 0;
				}

				//Si existe saldo vencido
				if($intSaldoVencidoSuc > 0)
				{
					//Calcular el porcentaje que le corresponde al saldo vencido
					$intPorcentajeSdoVencido = ($intSaldoVencidoSuc * $intPorcentajeGral) / $intSaldoSuc;
				}
				
				//Si existe saldo por vencer
				if($intSaldoVencerSuc > 0)
				{
					//Calcular el porcentaje que le corresponde al saldo por vencer
					$intPorcentajeSdoVencer = ($intSaldoVencerSuc * $intPorcentajeGral) / $intSaldoSuc;
				}

				//Si existe saldo de los documentos (formas de pago) de pedidos de maquinaria
				if($intSaldoDocPedidosMaqSuc > 0)
				{

					//Hacer recorrido para obtener saldo de los documentos (formas de pago)
					foreach ($otdDocPedidosMaq as $arrDoc) 
					{
						//Asignar el saldo del documento
						$intSaldoDoc = $arrSaldoDocPedidosMaqSuc[$arrDoc->documento_pago_id];

						//Calcular el porcentaje que le corresponde al saldo del documento
						$intPorcentajeSdoDoc =  ($intSaldoDoc * $intPorcentajeGral) / $intSaldoSuc;

						//Convertir cantidad a dos decimales
						$intPorcentajeSdoDoc = number_format($intPorcentajeSdoDoc, 2, '.','');

						//Asignar valores del array
		      			$arrPorcentajeDocPedidosMaqSuc[$arrDoc->documento_pago_id] = $intPorcentajeSdoDoc;

					}//Cierre de foreach formas de pago de maquinaria
				}

				//Convertir cantidad a dos decimales
				$intPorcentajeGral = number_format($intPorcentajeGral, 2, '.','');
				$intPorcentajeSdoVencido = number_format($intPorcentajeSdoVencido, 2, '.','');
				$intPorcentajeSdoVencer = number_format($intPorcentajeSdoVencer, 2, '.','');

			    //Definir valores del array auxiliar de información (para cada sucursal)
				$arrAuxiliar["saldo"] = $intSaldoSuc;
				$arrAuxiliar["porcentaje_saldo"] = $intPorcentajeGral;
				$arrAuxiliar["saldo_vencido"] = $intSaldoVencidoSuc;
				$arrAuxiliar["porcentaje_saldo_vencido"] = $intPorcentajeSdoVencido;
				$arrAuxiliar["saldo_vencer"] = $intSaldoVencerSuc;
				$arrAuxiliar["porcentaje_saldo_vencer"] = $intPorcentajeSdoVencer;
				$arrAuxiliar["saldo_maquinaria"] = $arrSaldoDocPedidosMaqSuc;
				$arrAuxiliar["porcentaje_saldo_maquinaria"] = $arrPorcentajeDocPedidosMaqSuc;
				$arrAuxiliar["modulos"] = array($arrModulosSuc);
				//Agregar datos al array
			    array_push($arrDetallesSuc, $arrAuxiliar);

			    //Agregar al array los detalles (módulos y acumulados) de la sucursal
			    $arrSucursalesSem["sucursal_".$arrSuc['sucursal_id']] = array($arrDetallesSuc);

			}//Cierre de foreach (sucursales)

			
			//Si existen facturas con saldo
			if($intContadorFrasSdo > 0)
    		{
				//Inicializar array para agregar los datos de una semana
	       	    $arrAuxiliar = array();

	       	    //Definir valores del array auxiliar de información (para cada semana)
	       	    $arrAuxiliar["sucursales"] = array($arrSucursalesSem);
	       	    $arrAuxiliar["acumulado_modulo"] = array($arrAcumuladoSaldoMod);
	       	    $arrAuxiliar["acumulado_general"] = array($arrAcumuladoSdoGral);
	       	    //Agregar datos al array
				array_push($arrDetallesSem, $arrAuxiliar);

				//Agregar al array los detalles (sucursales y acumulados) de la semana
				$arrSdoSemanas["semana_".$intPrimerDiaSemana] = array($arrDetallesSem);
			}

        }//Cierre de foreach (semanas)

       	//Regresar array con los saldos del mes
		return $arrSdoSemanas;
    }

}