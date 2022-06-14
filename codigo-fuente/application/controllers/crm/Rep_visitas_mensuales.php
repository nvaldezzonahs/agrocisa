<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_visitas_mensuales extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('crm/prospectos_model', 'prospectos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('crm/rep_visitas_mensuales', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el tabulador de visitas mensuales de los vendedores 
     *dependiendo de los criterios de búsqueda proporcionados.*/
	public function get_reporte() 
	{	            
		//Variables que se utilizan para recuperar los valores de la vista
		$intMes = $this->input->post('intMes');
		$strMes = $this->input->post('strMes');
		$strAnio = $this->input->post('strAnio');
		$intModuloID = $this->input->post('intModuloID');
		$strModulo = trim($this->input->post('strModulo'));
        //Variables que se utilizan para acumular totales
        $intAcumVisitas = 0; //Total de visitas mensuales
        $intAcumCotizaciones = 0;//Total de cotizaciones mensuales
        $intPorcCotizaciones = 0;//Total de porcentaje mensual de cotizaciones (efectividad)
        $intAcumVentas = 0;//Total de ventas mensuales
        $intPorcVentas = 0;//Total de porcentaje mensual de ventas (efectividad)
        $intAcumVisitasReprogramadas = 0; //Total de visitas mensuales reprogramadas
        $intPorcVisitasReprogramadas = 0;//Total de porcentaje mensual de visitas reprogramadas (efectividad)

        //Array que se utiliza para asignar el acumulado del total de visitas por cada día del mes
	    $arrAcumTotalVisitas = array(); 
	    //Array que se utiliza para agregar las visitas de los vendedores
		$arrVendedores = array();
        //Hacer un llamado a la función para calcular los días del mes
		$intDiasMes = $this->get_dias_mes($intMes, $strAnio);
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;

		//Asignar objeto con las visitas mensuales que realizaron los vendedores 
		$otdVisitasMensuales = $this->get_visitas_mensuales($intMes, $strAnio, $intModuloID, $intDiasMes); 
		//Asignar array con los datos de los vendedores
	    $arrVendedores = $otdVisitasMensuales['rows'];
	    //Asignar el acumulado de las visitas 
		$intAcumVisitas =  $otdVisitasMensuales['acumulado_visitas'];
		//Asignar el acumulado de las cotizaciones
		$intAcumCotizaciones =  $otdVisitasMensuales['acumulado_cotizaciones'];
		//Asignar el porcentaje de efectividad de las cotizaciones
		$intPorcCotizaciones =  $otdVisitasMensuales['porc_cotizaciones'];
		//Asignar el acumulado de las ventas
		$intAcumVentas =  $otdVisitasMensuales['acumulado_ventas'];
		//Asignar el porcentaje de efectividad de las ventas
		$intPorcVentas =  $otdVisitasMensuales['porc_ventas'];
		//Asignar el acumulado de las visitas reprogramadas
		$intAcumVisitasReprogramadas =  $otdVisitasMensuales['acumulado_visitas_reprogramadas'];
		//Asignar el porcentaje de efectividad de las visitas reprogramadas
	    $intPorcVisitasReprogramadas =  $otdVisitasMensuales['porc_visitas_reprogramadas'];
		
		//Se crea una instancia de la clase PDF
		$pdf = new PDF('L','mm','legal');//orientación horizontal
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1= 'REPORTE DIARIO DE VISITAS DE VENDEDORES DEL MES DE '.$strMes.' DE '. $strAnio;
		//Si existe id del módulo
		if($intModuloID > 0)
	    {
	    	$pdf->strLinea2 = utf8_decode('MÓDULO: '.$strModulo);
	    }

	    //Crea los titulos de la cabecera
		$pdf->arrCabecera = array('VENDEDOR');
		//Variable que se utiliza para asignar el tamaño de los encabezados de las columnas fijas 
	    $intTamColDia = 6.5;
	    $intTamColFijas = 91;
	    $intTamColDias = ($intTamColDia * $intDiasMes);
	    //Variable que se utiliza para asignar el tamaño restante de la hoja doble cara
	    $intTamColVendedor = (335 - ($intTamColFijas + $intTamColDias));
	  	//Establece el ancho de las columnas de cabecera
        $pdf->arrAnchura = array($intTamColVendedor);
        //Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L');
		//Hacer recorrido para agregar a la cabecera los días del mes
        for ($intContDias = 1; $intContDias <= $intDiasMes;  $intContDias++)
        {
        	//Asignar datos al array
            $pdf->arrCabecera[] = $intContDias;
            $pdf->arrAnchura[] =  $intTamColDia;
            $pdf->arrAlineacion[] = 'R';
        }
        //Agregar al array las siguientes columnas
	    //Total de visitas
	    $pdf->arrCabecera[] =  'TOTAL'; 
	    //Total de cotizaciones
	    $pdf->arrCabecera[] =  'COTI.'; 
	    //Porcentaje de efectividad
	    $pdf->arrCabecera[] =  'EFECT.';
	    //Total de ventas
	    $pdf->arrCabecera[] =  'VENTAS'; 
	    //Porcentaje de efectividad
	    $pdf->arrCabecera[] =  'EFECT.';
	    //Número de visitas reprogramadas
	    $pdf->arrCabecera[] =  'VIS.REP.';
	    //Porcentaje de visitas reprogramadas
	    $pdf->arrCabecera[] =  'EFECT.';
	    //Agregar al array los siguientes tamaños
	    $pdf->arrAnchura[] =  13;//Columna Total
	    $pdf->arrAnchura[] =  13;//Columna Cotizaciones
	    $pdf->arrAnchura[] =  13;//Columna Efectividad
	    $pdf->arrAnchura[] =  13;//Columna Ventas
	    $pdf->arrAnchura[] =  13;//Columna Efectividad
	    $pdf->arrAnchura[] =  13;//Columna Visitas reprogramadas
	    $pdf->arrAnchura[] =  13;//Columna % Visitas reprogramadas
	    //Agregar al array las siguientes alineaciones
	    $pdf->arrAlineacion[] = 'R';
	    $pdf->arrAlineacion[] = 'R';
	    $pdf->arrAlineacion[] = 'R';
	    $pdf->arrAlineacion[] = 'R';
	    $pdf->arrAlineacion[] = 'R';
	    $pdf->arrAlineacion[] = 'R';
	    $pdf->arrAlineacion[] = 'R';

		//Agregar la primer pagina
		$pdf->AddPage();
		//Establecer el color de línea
	    $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		
        //Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);

		//Si hay información
		if($arrVendedores)
		{	
			//Hacer recorrido para inicializar el acumulado del total de visitas (por cada día del mes)
			for($intContDias = 1; $intContDias <= $intDiasMes;  $intContDias++)
			{	
				$arrAcumTotalVisitas["acumuladoVisitas_".$intContDias] = 0;
			}

			//Recorremos el arreglo 
			foreach ($arrVendedores as $arrCol)
			{
                //Asignar al array los datos del vendedor
            	$arrDatos = array(utf8_decode($arrCol["vendedor"]));
            	//Hacer recorrido para agregar total de visitas diarias
	            for($intContDias = 1; $intContDias <= $intDiasMes;  $intContDias++)
	            {
	            	//Asignar al array el total de visitas diarias del vendedor
	            	$arrDatos[] = $arrCol["totalVisitas_".$intContDias];
	            	//Incrementar acumulados
	            	$arrAcumTotalVisitas["acumuladoVisitas_".$intContDias] += $arrCol["totalVisitas_".$intContDias];
	            }
	            
	            //Total de visitas mensuales del vendedor
		        $arrDatos[] = $arrCol["totalVisitasVendedor"]; 
			    
			    //Total de cotizaciones mensuales del vendedor
			    $arrDatos[] = $arrCol["totalCotizaciones"];
			    
			    //Porcentaje mensual de cotizaciones (efectividad)
			    $arrDatos[] = number_format($arrCol["porcentajeCotizaciones"], 2); 

			    //Total de ventas mensuales del vendedor
			    $arrDatos[] =  $arrCol["totalVentas"];
			    
			    //Porcentaje mensual de ventas (efectividad)
			    $arrDatos[] =  number_format($arrCol["porcentajeVentas"], 2);
			    
			    //Total de visitas reprogramadas
			    $arrDatos[] =  $arrCol["totalVisitasReprogramadas"];
			    //Porcentaje de visitas reprogramadas (efectividad)
			    $arrDatos[] =  number_format($arrCol["porcentajeVisitasReprogramadas"], 2); 

            	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
                $pdf->Row($arrDatos, $pdf->arrAlineacion, NULL, NULL, TRUE);
				
			}
		}

		//Inicializar array
        $arrDatos = array();
		//Escribir totales
		$arrDatos = array('TOTALES');

		//Hacer recorrido para escribir información del acumulado de visitas (por cada día del mes)
		for($intContDias = 1; $intContDias <= $intDiasMes;  $intContDias++)
		{
			//Asignar al array el acumulado de visitas diarias del vendedor
	        $arrDatos[] = $arrAcumTotalVisitas["acumuladoVisitas_".$intContDias];

		}
	

		//Acumulado del total de visitas mensuales de todos los vendedores del módulo
		$arrDatos[] = $intAcumVisitas;

		//Acumulado del total de cotizaciones mensuales de todos los vendedores del módulo
		$arrDatos[] = $intAcumCotizaciones;

		//Acumulado del total de porcentaje mensual de efectividad (cotizaciones) de todos los vendedores del módulo
		$arrDatos[] = number_format($intPorcCotizaciones, 2);

		//Acumulado del total de ventas mensuales de todos los vendedores del módulo
		$arrDatos[] = $intAcumVentas;

		//Acumulado del total de porcentaje mensual de efectividad (ventas) de todos los vendedores del módulo
		$arrDatos[] = number_format($intPorcVentas, 2);

		//Acumulado del total de visitas reprogramadas
		$arrDatos[] = $intAcumVisitasReprogramadas;

		//Acumulado del % total de visitas reprogramadas
        $arrDatos[] = number_format($intPorcVisitasReprogramadas, 2);

        //Cambiar el tipo de letra de la tabla
        $pdf->strTipoLetraTabla = 'Negrita';
        //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
        $pdf->Row($arrDatos, $pdf->arrAlineacion, NULL, NULL, TRUE);

        //Ejecutar la salida del reporte
        $pdf->Output('visitas_mes_'.$strMes.'_'.$strAnio.'_'.$strModulo.'.pdf','I'); 
	}

    /*Método para generar un archivo XLS con el tabulador de visitas mensuales de los vendedores 
     *dependiendo de los criterios de búsqueda proporcionados.*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$intMes = $this->input->post('intMes');
		$strMes = $this->input->post('strMes');
		$strAnio = $this->input->post('strAnio');
		$intModuloID = $this->input->post('intModuloID');
		$strModulo = trim($this->input->post('strModulo'));
		//Variable que se utiliza para definir título del módulo
        $strTituloModulo = '';
		//Variables que se utilizan para acumular totales
        $intAcumVisitas = 0; //Total de visitas mensuales
        $intAcumCotizaciones = 0;//Total de cotizaciones mensuales
        $intPorcCotizaciones = 0;//Total de porcentaje mensual de cotizaciones (efectividad)
        $intAcumVentas = 0;//Total de ventas mensuales
        $intPorcVentas = 0;//Total de porcentaje mensual de ventas (efectividad)
        $intAcumVisitasReprogramadas = 0; //Total de visitas mensuales reprogramadas
        $intPorcVisitasReprogramadas = 0;//Total de porcentaje mensual de visitas reprogramadas (efectividad)
      
        //Array que se utiliza para asignar el acumulado del total de visitas por cada día del mes
	    $arrAcumTotalVisitas = array(); 
	    //Array que se utiliza para agregar las visitas de los vendedores
		$arrVendedores = array();
        //Hacer un llamado a la función para calcular los días del mes
		$intDiasMes = $this->get_dias_mes($intMes, $strAnio);
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
       
        //Variable que se utiliza para asignar el número de columna donde se empezaran a escribir los días faltantes del mes 
	    $intIndColDias = 30;
	    $intIndColE = $intIndColDias;//Empezar en la columna 30-AD (Encabezados de los días del mes)
	    $intIndColAcum = 2;//Empezar en la columna 2-B (Acumulado del total de visitas por cada día del mes)
	    //Descripciones de las columnas 
        $intPosEncabezados = 9;
		
		//Asignar objeto con las visitas mensuales que realizaron los vendedores 
		$otdVisitasMensuales = $this->get_visitas_mensuales($intMes, $strAnio, $intModuloID, $intDiasMes); 
		//Asignar array con los datos de los vendedores
	    $arrVendedores = $otdVisitasMensuales['rows'];
	    //Asignar el acumulado de las visitas 
		$intAcumVisitas =  $otdVisitasMensuales['acumulado_visitas'];
		//Asignar el acumulado de las cotizaciones
		$intAcumCotizaciones =  $otdVisitasMensuales['acumulado_cotizaciones'];
		//Asignar el porcentaje de efectividad de las cotizaciones
		$intPorcCotizaciones =  $otdVisitasMensuales['porc_cotizaciones'];
		//Asignar el acumulado de las ventas
		$intAcumVentas =  $otdVisitasMensuales['acumulado_ventas'];
		//Asignar el porcentaje de efectividad de las ventas
		$intPorcVentas =  $otdVisitasMensuales['porc_ventas'];
		//Asignar el acumulado de las visitas reprogramadas
		$intAcumVisitasReprogramadas =  $otdVisitasMensuales['acumulado_visitas_reprogramadas'];
		//Asignar el porcentaje de efectividad de las visitas reprogramadas
	    $intPorcVisitasReprogramadas =  $otdVisitasMensuales['porc_visitas_reprogramadas'];
     	
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/crm/archivos_excel/visitas_mensuales.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
       //Si existe id del módulo
		if($intModuloID > 0)
	    {	
	    	//Asignar el título del módulo
	    	$strTituloModulo = ' MÓDULO: '.$strModulo;
	    }
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'REPORTE DIARIO DE VISITAS DE VENDEDORES DEL MES DE '.$strMes.' DE '. $strAnio.$strTituloModulo);
		//Hacer recorrido para agregar a la cabecera las columnas con los días faltantes del mes
        for($intContDias = 29; $intContDias <= $intDiasMes;  $intContDias++)
        {
        		//Se agrega en el encabezado del archivo los días del mes
        	   $objExcel->setActiveSheetIndex(0)
		                ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados, $intContDias);
		        //Incrementar indice de la columna
			    $intIndColE++;           		
        }
        //Se agrega en el encabezado del archivo las columnas de los totales
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados, 'TOTAL')
        		 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+1].$intPosEncabezados, 'COTIZACIONES')
        		 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+2].$intPosEncabezados, 'EFEC. %')
        		 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+3].$intPosEncabezados, 'VENTAS')
        		 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+4].$intPosEncabezados, 'EFEC. %')
        		 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+5].$intPosEncabezados, 'VIS.REP.')
        		 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+6].$intPosEncabezados, 'EFEC. %');

        //Incrementar indice de la columna (sumar el número de columnas correspondientes a los totales)
        $intIndColE = $intIndColE+6;

		//Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));
        
        //Preferencias de color de relleno de celda 
     	$objExcel->getActiveSheet()
 			     ->getStyle('A9:'.$this->ARR_COLUMNAS[$intIndColE].'9')
 			     ->getFill()
 			     ->applyFromArray($arrStyleColumnas);
 			     
		//Si hay información
		if ($arrVendedores)
		{	
			//Hacer recorrido para inicializar el acumulado del total de visitas (por cada día del mes)
			for($intContDias = 1; $intContDias <= $intDiasMes;  $intContDias++)
			{	
				$arrAcumTotalVisitas["acumuladoVisitas_".$intContDias] = 0;
			}

			//Recorremos el arreglo 
			foreach ($arrVendedores as $arrCol)
			{   
				//Inicializar indice de la columna para empezar en la columna 30-AD (total de visitas en los días del mes)
				$intIndColVisitas = $intIndColDias;

				//Agregar información
				$objExcel->setActiveSheetIndex(0)
					     ->setCellValue('A'.$intFila, $arrCol["vendedor"])
				         ->setCellValue('B'.$intFila, $arrCol["totalVisitas_1"])
				         ->setCellValue('C'.$intFila, $arrCol["totalVisitas_2"])
				         ->setCellValue('D'.$intFila, $arrCol["totalVisitas_3"])
				         ->setCellValue('E'.$intFila, $arrCol["totalVisitas_4"])
				         ->setCellValue('F'.$intFila, $arrCol["totalVisitas_5"])
				         ->setCellValue('G'.$intFila, $arrCol["totalVisitas_6"])
				         ->setCellValue('H'.$intFila, $arrCol["totalVisitas_7"])
				         ->setCellValue('I'.$intFila, $arrCol["totalVisitas_8"])
				         ->setCellValue('J'.$intFila, $arrCol["totalVisitas_9"])
				         ->setCellValue('K'.$intFila, $arrCol["totalVisitas_10"])
				         ->setCellValue('L'.$intFila, $arrCol["totalVisitas_11"])
				         ->setCellValue('M'.$intFila, $arrCol["totalVisitas_12"])
				         ->setCellValue('N'.$intFila, $arrCol["totalVisitas_13"])
				         ->setCellValue('O'.$intFila, $arrCol["totalVisitas_14"])
				         ->setCellValue('P'.$intFila, $arrCol["totalVisitas_15"])
				         ->setCellValue('Q'.$intFila, $arrCol["totalVisitas_16"])
				         ->setCellValue('R'.$intFila, $arrCol["totalVisitas_17"])
				         ->setCellValue('S'.$intFila, $arrCol["totalVisitas_18"])
				         ->setCellValue('T'.$intFila, $arrCol["totalVisitas_19"])
				         ->setCellValue('U'.$intFila, $arrCol["totalVisitas_20"])
				         ->setCellValue('V'.$intFila, $arrCol["totalVisitas_21"])
				         ->setCellValue('W'.$intFila, $arrCol["totalVisitas_22"])
				         ->setCellValue('X'.$intFila, $arrCol["totalVisitas_23"])
				         ->setCellValue('Y'.$intFila, $arrCol["totalVisitas_24"])
				         ->setCellValue('Z'.$intFila, $arrCol["totalVisitas_25"])
				         ->setCellValue('AA'.$intFila, $arrCol["totalVisitas_26"])
				         ->setCellValue('AB'.$intFila, $arrCol["totalVisitas_27"])
				         ->setCellValue('AC'.$intFila, $arrCol["totalVisitas_28"]);

				//Hacer recorrido para incrementar acumulados del total de visitas (por cada día del mes) 
	            for($intContDias = 1; $intContDias <= $intDiasMes;  $intContDias++)
	            {
            		//Si el mes tiene más de 28 días
            		if($intContDias >= 29)
            		{
            			//Agregar Información del total de visitas por día
	            	    $objExcel->setActiveSheetIndex(0)
				                 ->setCellValue($this->ARR_COLUMNAS[$intIndColVisitas].$intFila, 
				                   				$arrCol["totalVisitas_".$intContDias]);

				        //Incrementar indice de la columna
				    	$intIndColVisitas++;  
            		}
            	  
            		//Incrementar acumulados
            		$arrAcumTotalVisitas["acumuladoVisitas_".$intContDias] += $arrCol["totalVisitas_".$intContDias];
				                		
	            }

	            //Agregar información del total de visitas de los prospectos
	            $objExcel->setActiveSheetIndex(0)
				         ->setCellValue($this->ARR_COLUMNAS[$intIndColVisitas].$intFila, $arrCol["totalVisitasVendedor"])
				         ->setCellValue($this->ARR_COLUMNAS[$intIndColVisitas+1].$intFila, $arrCol["totalCotizaciones"])
				         ->setCellValue($this->ARR_COLUMNAS[$intIndColVisitas+2].$intFila, $arrCol["porcentajeCotizaciones"])
				         ->setCellValue($this->ARR_COLUMNAS[$intIndColVisitas+3].$intFila, $arrCol["totalVentas"])
				         ->setCellValue($this->ARR_COLUMNAS[$intIndColVisitas+4].$intFila, $arrCol["porcentajeVentas"])
			          	 ->setCellValue($this->ARR_COLUMNAS[$intIndColVisitas+5].$intFila, $arrCol["totalVisitasReprogramadas"])
			           	 ->setCellValue($this->ARR_COLUMNAS[$intIndColVisitas+6].$intFila, $arrCol["porcentajeVisitasReprogramadas"]);

		      	//Incrementar el indice para escribir los datos del siguiente registro
				$intFila++; 
			}

			//Agregar información de los acumulados
		    $objExcel->setActiveSheetIndex(0)
					 ->setCellValue('A'.$intFila, 'TOTALES')
					 ->setCellValue($this->ARR_COLUMNAS[$intIndColVisitas].$intFila, $intAcumVisitas)
				     ->setCellValue($this->ARR_COLUMNAS[$intIndColVisitas+1].$intFila, $intAcumCotizaciones)
				     ->setCellValue($this->ARR_COLUMNAS[$intIndColVisitas+2].$intFila, $intPorcCotizaciones)
				     ->setCellValue($this->ARR_COLUMNAS[$intIndColVisitas+3].$intFila, $intAcumVentas)
				     ->setCellValue($this->ARR_COLUMNAS[$intIndColVisitas+4].$intFila, $intPorcVentas)
				     ->setCellValue($this->ARR_COLUMNAS[$intIndColVisitas+5].$intFila, $intAcumVisitasReprogramadas)
				     ->setCellValue($this->ARR_COLUMNAS[$intIndColVisitas+6].$intFila, $intPorcVisitasReprogramadas);

			//Hacer recorrido para agregar información del acumulado de visitas (por cada día del mes)
			for($intContDias = 1; $intContDias <= $intDiasMes;  $intContDias++)
			{
				//Agregar información del acumulado de visitas por día
				$objExcel->setActiveSheetIndex(0)
						 ->setCellValue($this->ARR_COLUMNAS[$intIndColAcum].$intFila, $arrAcumTotalVisitas["acumuladoVisitas_".$intContDias]);

				//Incrementar el indice para escribir el acumulado del siguiente día
				$intIndColAcum++;
			}	


		    //Cambiar contenido de la celda a formato númerico de 2 decimales
	        $objExcel->getActiveSheet()
	                 ->getStyle($this->ARR_COLUMNAS[$intIndColVisitas+2].$intFilaInicial.':'.
	                 			$this->ARR_COLUMNAS[$intIndColVisitas+2].$intFila)
	                 ->getNumberFormat()
	 				 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

	 		$objExcel->getActiveSheet()
	                 ->getStyle($this->ARR_COLUMNAS[$intIndColVisitas+4].$intFilaInicial.':'.
	                 			$this->ARR_COLUMNAS[$intIndColVisitas+4].$intFila)
	                 ->getNumberFormat()
	 				 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

	 	   $objExcel->getActiveSheet()
	                 ->getStyle($this->ARR_COLUMNAS[$intIndColVisitas+6].$intFilaInicial.':'.
	                 			$this->ARR_COLUMNAS[$intIndColVisitas+6].$intFila)
	                 ->getNumberFormat()
	 				 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);


			//Cambiar estilo de las celdas
	 	    $objExcel->getActiveSheet()
	 	    		 ->getStyle('A'.$intFila.':'.$this->ARR_COLUMNAS[$intIndColVisitas+6].$intFila)
	 	    		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'visitas_mes_'.$strMes.'_'.$strAnio.'_'.$strModulo.'.xls',
        								   'visitas', $intFila);
	}

	/*Método para regresar las visitas mensuales de los vendedores que coincidan con los criterios de búsqueda
	 *proporcionados (se utiliza en el reporte de visitas mensuales)*/
	public function get_visitas_mensuales($intMes, $strAnio, $intModuloID, $intDiasMes)
	{
		//Array que se utiliza para enviar datos
		$arrDatos = array('rows' => NULL, 
						  'acumulado_visitas' => '0',
						  'acumulado_cotizaciones' => '0',
						  'porc_cotizaciones' => '0.00',
						  'acumulado_ventas' => '0', 
						  'porc_ventas' => '0.0',
						  'acumulado_visitas_reprogramadas' => '0',
						  'porc_visitas_reprogramadas' => '0.00');

		//Variables que se utilizan para acumular totales
        $intAcumVisitas = 0; //Total de visitas mensuales
        $intAcumCotizaciones = 0;//Total de cotizaciones mensuales
        $intPorcCotizaciones = 0;//Total de porcentaje mensual de efectividad (cotizaciones)
        $intAcumVentas = 0;//Total de ventas mensuales
        $intPorcVentas = 0;//Total de porcentaje mensual de efectividad (ventas)
        $intAcumVisitasReprogramadas = 0; //Total de visitas mensuales reprogramadas
        $intPorcVisitasReprogramadas = 0;//Total de porcentaje mensual de visitas reprogramadas

		//Variable que se utiliza como contador de visitas del vendedor
		$intTotalVisitas = 0;
		//Array que se utiliza para agregar las visitas mensuales de los vendedores
        $arrVendedores = array();
        //Array que se utiliza para agregar los datos de un vendedor
        $arrAuxiliar = array();
		//Seleccionar los datos de los vendedores del módulo
		$otdVendedores = $this->prospectos->buscar_vendedores_modulo($intModuloID);
		//Seleccionar los datos de las visitas mensuales de cada vendedor
	    $otdVisitasMensuales = $this->prospectos->buscar_visitas_vendedores($intMes, $strAnio, $intModuloID);
	  
	    //Si hay información
		if($otdVendedores)
		{
			//Hacer recorrido para obtener la información de los vendedores
			foreach ($otdVendedores as $arrVendedor) 
			{
				//Variable que se utiliza para verificar si el vendedor que se encuentra INACTIVO 
				//tiene visitas en el mes; asignar Si para agregar datos del vendedor en el array resultado
				$strAgregarDatos = 'Si';
				//Inicializar variable
				$intTotalVisitas = 0;
				//Asignar id del vendedor
				$intVendedorID = $arrVendedor->vendedor_id;
				$intModVendedorID = $arrVendedor->modulo_id;
				$strFraModulo = $arrVendedor->factura;

                //Definir valores del array auxiliar de información (para cada vendedor)
                //Si existe id del módulo
				if($intModuloID > 0)
				{
               	 	$arrAuxiliar["vendedor"] = $arrVendedor->vendedor;
               	}
               	else
               	{
               		$arrAuxiliar["vendedor"] = $arrVendedor->modulo.': '.$arrVendedor->vendedor;
               		
               	}
             	
                //Hacer recorrido para inicializar el total de visitas (por cada día del mes)
				for($intContDias = 1; $intContDias <= $intDiasMes;  $intContDias++)
				{	
					$arrAuxiliar["totalVisitas_".$intContDias] = 0;
				}

				//Hacer recorrido para obtener la información de las visitas del vendedor
				foreach ($otdVisitasMensuales as $arrVisitas) 
				{
					//Si el vendedor tiene visitas
					if($intVendedorID == $arrVisitas->vendedor_id)
					{
						//Asignar el total de visitas diarias del vendedor
						$arrAuxiliar["totalVisitas_".$arrVisitas->dia] = $arrVisitas->total;

						//Incrementar acumulados
					    $intTotalVisitas += $arrVisitas->total;
					    $intAcumVisitas += $arrVisitas->total;
					}
				}

				//Asignar el total de visitas del vendedor
				$arrAuxiliar["totalVisitasVendedor"] = $intTotalVisitas;
				
				//Seleccionar los datos de las ventas mensuales del vendedor
	    		$otdVentas = $this->prospectos->buscar_ventas_vendedor($intMes, $strAnio, 
	    															  $intVendedorID, $strFraModulo);
	    		//Tomar primer elemento del array
				$otdVentas = $otdVentas[0];

				//Verificar si hay información de las ventas
				if($otdVentas)
				{
					//Variable que se utiliza para asignar el porcentaje de ventas
					$intPorcVentas  = 0;
					$intNumVentas = $otdVentas->numero_facturas;

					//Si existen visitas
					if($intTotalVisitas > 0)
					{
						//Calcular el porcentaje de ventas
						$intPorcVentas = ($intNumVentas * 100) /$intTotalVisitas;
					}

					//Asignar el total de ventas del vendedor
					$arrAuxiliar["totalVentas"] = $intNumVentas;
					$arrAuxiliar["porcentajeVentas"] = $intPorcVentas;

					//Incrementar acumulado
					$intAcumVentas += $intNumVentas;

				}
				else
				{
					$arrAuxiliar["totalVentas"] = 0;
					$arrAuxiliar["porcentajeVentas"] = 0;

				}

	    		//Seleccionar los datos de las cotizaciones mensuales del vendedor
	    		$otdCotizaciones = $this->prospectos->buscar_cotizaciones_vendedor($intMes, $strAnio, 
	    																	       $intVendedorID, 
	    																	       $strFraModulo);
	    		//Tomar primer elemento del array
				$otdCotizaciones = $otdCotizaciones[0];

				//Verificar si hay información de las cotizaciones
				if($otdCotizaciones)
				{
					//Variable que se utiliza para asignar el porcentaje de cotizaciones
					$intPorcCotizaciones  = 0;
					$intNumCotizaciones = $otdCotizaciones->numero_cotizaciones;

					//Si existen visitas
					if($intTotalVisitas > 0)
					{
						//Calcular el porcentaje de ventas
						$intPorcCotizaciones = ($intNumCotizaciones * 100) /$intTotalVisitas;
					}

					//Asignar el total de ventas del vendedor
					$arrAuxiliar["totalCotizaciones"] = $intNumCotizaciones;
					$arrAuxiliar["porcentajeCotizaciones"] = $intPorcCotizaciones;

					//Incrementar acumulado
					$intAcumCotizaciones += $intNumCotizaciones;

				}
				else
				{
					$arrAuxiliar["totalCotizaciones"] = 0;
					$arrAuxiliar["porcentajeCotizaciones"] = 0;
				}


			    //Seleccionar los datos de las visitas mensuales del vendedor que han sido reprogramadas 
	    		$otdVisitasReprogramadas= $this->prospectos->buscar_visitas_reprogramadas_vendedor($intMes, 
	    																						   $strAnio, 
	    																						   $intVendedorID, 
	    																						   $intModVendedorID);
	    		//Tomar primer elemento del array
				$otdVisitasReprogramadas = $otdVisitasReprogramadas[0]; 
				//Verificar si hay información de las visitas reprogramadas
				if($otdVisitasReprogramadas)
				{
					//Variable que se utiliza para asignar el porcentaje de visitas reprogramadas
					$intPorcVisitasRep  = 0;
					$intNumVisitasRep = $otdVisitasReprogramadas->numero_visitas;

					//Si existen visitas
					if($intTotalVisitas > 0)
					{
						//Calcular el porcentaje de visitas reprogramadas
						$intPorcVisitasRep = ($intNumVisitasRep * 100) /$intTotalVisitas;
					}

					//Asignar el total de visitas reprogramadas del vendedor
					$arrAuxiliar["totalVisitasReprogramadas"] = $intNumVisitasRep;
					$arrAuxiliar["porcentajeVisitasReprogramadas"] = $intPorcVisitasRep;

					//Incrementar acumulado
					$intAcumVisitasReprogramadas += $intNumVisitasRep;
				}
				else
				{
					$arrAuxiliar["totalVisitasReprogramadas"] = 0;
					$arrAuxiliar["porcentajeVisitasReprogramadas"] = 0;
				}

				//Si el vendedor se encuentra INACTIVO y no tiene visitas en el mes
				if($arrVendedor->estatus == 'INACTIVO' && $intTotalVisitas == 0)
				{
					//Asignar No - para no agregar los datos del vendedor en el array resultado 
					$strAgregarDatos = 'No';	
				}

				//Si existe información del vendedor
				if($strAgregarDatos == 'Si')
				{
					//Asignar datos al array resultado
                	array_push($arrVendedores,$arrAuxiliar); 
				}

			}//Cierre de foreach vendedores

		}//Cierre de verificación para obtener información de vendedores
		
		//Agregar datos al array
		$arrDatos['rows'] = $arrVendedores;

		//Si existen visitas
		if($intAcumVisitas > 0)
		{
			//Calcular el porcentaje (efectividad) de cotizaciones
			$intPorcCotizaciones = ($intAcumCotizaciones * 100) /$intAcumVisitas;

			//Calcular el porcentaje (efectividad) de ventas
			$intPorcVentas = ($intAcumVentas * 100) /$intAcumVisitas;

			//Calcular el porcentaje de visitas reprogramadas
			$intPorcVisitasReprogramadas = ($intAcumVisitasReprogramadas * 100) /$intAcumVisitas;

			//Agregar datos al array
			$arrDatos['acumulado_visitas'] = $intAcumVisitas;
	   		$arrDatos['acumulado_cotizaciones'] = $intAcumCotizaciones;
	    	$arrDatos['porc_cotizaciones'] = $intPorcCotizaciones;
	    	$arrDatos['acumulado_ventas'] = $intAcumVentas;
	    	$arrDatos['porc_ventas'] = $intPorcVentas;
	    	$arrDatos['acumulado_visitas_reprogramadas'] = $intAcumVisitasReprogramadas;
	    	$arrDatos['porc_visitas_reprogramadas'] = $intPorcVisitasReprogramadas;
		}

		return $arrDatos;
	}
}