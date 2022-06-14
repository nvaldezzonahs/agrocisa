<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_presupuestos_ventas extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
        $this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('servicio/servicio_presupuestos_ventas_model', 'presupuestos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('servicio/rep_presupuestos_ventas', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	/*Método para generar un reporte PDF con el listado de presupuestos de un año*/
    public function get_reporte() 
    {
    	//Variables que se utilizan para recuperar los valores de la vista
        $strAnio = $this->input->post('strAnio');
        //Array que se utiliza para agregar los datos de presupuestos mensuales
        $arrPptoMeses = array();
        //Array que se utiliza para agregar acumulados
        $arrAcumulados = array();

        //Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
        //para el pie de pagina del PDF
        $pdf->strUsuario = $this->session->userdata('usuario');
        //Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
        //para el encabezado del PDF
        $pdf->intSucursalID = $this->session->userdata('sucursal_id');
        //Crea los titulos de la cabecera
        $pdf->arrCabecera = array('MES', 'PRESUPUESTADO', 'REFACCIONES', 
        						  'TRAB. FOR.', 'OTROS', 'KILOMETRAJE', 
        						  'DIFERENCIA', '% CUMPLIMIENTO');

        //Establece el ancho de las columnas de cabecera
        $pdf->arrAnchura = array(29, 23, 23, 23, 23, 23, 23, 23);
        //Establece la alineación de las celdas de la tabla
        $pdf->arrAlineacion = array('L', 'R', 'R', 'R', 'R', 'R', 'R', 'R');
        //Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R', 'R', 'R', 'R', 'R', 'R');

        //Asignar el valor de la descripción (título de la lista de registros) del reporte
        $pdf->strLinea1 =  utf8_decode('LISTADO DE PRESUPUESTOS DE VENTAS DEL AÑO ').$strAnio;
        //Agregar la primer pagina
        $pdf->AddPage();
        //Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Establecer el color de línea
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);


        //Asignar objeto con los presupuestos en el año
        $otdPresupuestos = $this->get_presupuestos($strAnio);  
        //Asignar array con los datos de los presupuestos
        $arrPptoMeses = $otdPresupuestos['presupuestos']; 
        //Asignar array con los acumulados
        $arrAcumulados = $otdPresupuestos['acumulados'];      

         //Si hay información de los presupuestos
        if($arrPptoMeses)
        {
            //Recorremos el arreglo 
            foreach ($arrPptoMeses as $arrDet) 
            {	
            	/*Nota: se concatena |Negrita -> para cambiar el volumen de la fuente a bold,
                        se concatena |VerificarNumero -> para cambiar el color de texto a rojo en caso de que el valor numérico sea negativo
                 */
            	 $pdf->Row(array($arrDet['mes'], 
                              '$'.number_format($arrDet['presupuesto'],2),
                              '$'.number_format($arrDet['refacciones'],2),
                              '$'.number_format( $arrDet['trabajos_foraneos'],2),
                              '$'.number_format($arrDet['otros'],2),
                              '$'.number_format($arrDet['kilometraje'],2),
                              '$'.number_format($arrDet['diferencia'],2).'|VerificarNumero',
                               number_format($arrDet['cumplimiento'], 2)), 
                         $pdf->arrAlineacion, 'ClippedCell');



        	}//Cierre de foreach 

        }//Cierre de verificación de información 


        //------------------------------------------------------------------------------------------------------------------------
        //---------- RESUMEN
        //------------------------------------------------------------------------------------------------------------------------
		//Dibuja una línea para separar el total
    	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
   	
    	 //Si hay información de los acumulados
        if($arrAcumulados)
        {
	        //Cambiar el volumen de la fuente a bold
			$pdf->strTipoLetraTabla = 'Negrita';

	    	//Acumulados generales del subtotal
			$pdf->Row(array('TOTALES:', 
							'$'.number_format($arrAcumulados[0]['presupuesto'],2),
	                        '$'.number_format($arrAcumulados[0]['refacciones'],2),
	                        '$'.number_format($arrAcumulados[0]['trabajos_foraneos'],2),
	                        '$'.number_format($arrAcumulados[0]['otros'],2),
	                        '$'.number_format($arrAcumulados[0]['kilometraje'],2),
	                        '$'.number_format($arrAcumulados[0]['diferencia'],2).'|VerificarNumero',
	                         number_format($arrAcumulados[0]['cumplimiento'], 2)), 
	                     $arrAlineacionTotales, 'ClippedCell');

			//Cambiar el volumen de la letra
			$pdf->strTipoLetraTabla = 'Normal';

		}//Cierre de verificación de información

        //Ejecutar la salida del reporte
        $pdf->Output('presupuestos_ventas.pdf','I'); 
    }

	/*Método para generar un archivo XLS con el listado de presupuestos de un año*/
    public function get_xls() 
    {
    	//Variables que se utilizan para recuperar los valores de la vista
        $strAnio = $this->input->post('strAnio');
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Array que se utiliza para agregar los datos de presupuestos mensuales
        $arrPptoMeses = array();
        //Array que se utiliza para agregar acumulados
        $arrAcumulados = array();

        //Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('A7', 'LISTADO DE PRESUPUESTOS DE VENTAS DEL AÑO '.$strAnio);

        //Se agregan las columnas de la cabecera
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$intPosEncabezados, 'MES')
                 ->setCellValue('B'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('C'.$intPosEncabezados, 'REAL REFACCIONES')
                 ->setCellValue('D'.$intPosEncabezados, 'REAL TRABAJOS FORÁNEOS')
                 ->setCellValue('E'.$intPosEncabezados, 'REAL OTROS')
                 ->setCellValue('F'.$intPosEncabezados, 'REAL KILOMETRAJE')
                 ->setCellValue('G'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('H'.$intPosEncabezados, '% CUMPLIMIENTO');       

        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:H9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);


    	 //Asignar objeto con los presupuestos en el año
        $otdPresupuestos = $this->get_presupuestos($strAnio);  
        //Asignar array con los datos de los presupuestos
        $arrPptoMeses = $otdPresupuestos['presupuestos']; 
         //Asignar array con los acumulados
        $arrAcumulados = $otdPresupuestos['acumulados'];     

        
        //Si hay información de los presupuestos
        if($arrPptoMeses)
        {
            //Recorremos el arreglo 
            foreach ($arrPptoMeses as $arrDet) 
            {	

            	//Agregar información del registro
                $objExcel->setActiveSheetIndex(0)
                		 ->setCellValue('A'.$intFila, $arrDet['mes'])
                		 ->setCellValue('B'.$intFila, $arrDet['presupuesto'])
                		 ->setCellValue('C'.$intFila, $arrDet['refacciones'])
                		 ->setCellValue('D'.$intFila, $arrDet['trabajos_foraneos'])
                		 ->setCellValue('E'.$intFila, $arrDet['otros'])
                		 ->setCellValue('F'.$intFila, $arrDet['kilometraje'])
                		 ->setCellValue('G'.$intFila, $arrDet['diferencia'])
                		 ->setCellValue('H'.$intFila, $arrDet['cumplimiento']);


            	//Incrementar el indice para escribir los datos del siguiente registro
                $intFila++;

            }//Cierre de foreach 

        }//Cierre de verificación de información     

        //Incrementar el indice para escribir los acumulados
        $intFila++;   

        
        //------------------------------------------------------------------------------------------------------------------------
        //---------- RESUMEN
        //------------------------------------------------------------------------------------------------------------------------
        //Si hay información de los acumulados
        if($arrAcumulados)
        {
        	//Agregar información del registro
            $objExcel->setActiveSheetIndex(0)
             		 ->setCellValue('A'.$intFila, 'TOTALES:')
             		 ->setCellValue('B'.$intFila, $arrAcumulados[0]['presupuesto'])
            		 ->setCellValue('C'.$intFila, $arrAcumulados[0]['refacciones'])
            		 ->setCellValue('D'.$intFila, $arrAcumulados[0]['trabajos_foraneos'])
            		 ->setCellValue('E'.$intFila, $arrAcumulados[0]['otros'])
            		 ->setCellValue('F'.$intFila, $arrAcumulados[0]['kilometraje'])
            		 ->setCellValue('G'.$intFila, $arrAcumulados[0]['diferencia'])
            		 ->setCellValue('H'.$intFila, $arrAcumulados[0]['cumplimiento']);

        } //Cierre de verificación de información



        /*Cambiar contenido de las celdas a formato moneda 
        (cambiar color de texto en caso de ser un valor negativo)*/
        $objExcel->getActiveSheet()
                 ->getStyle('B'.$intFilaInicial.':'.'G'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

       	$objExcel->getActiveSheet()
                 ->getStyle('H'.$intFilaInicial.':'.'H'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        //Cambiar alineación de las siguientes celdas         
        $objExcel->getActiveSheet()
                 ->getStyle('B'.$intFilaInicial.':'.'H'.$intFila)
                 ->getAlignment()
                 ->applyFromArray($arrStyleAlignmentRight);         


        $objExcel->getActiveSheet()
                 ->getStyle('A'.$intFila.':'.'A'.$intFila)
                 ->getAlignment()
                 ->applyFromArray($arrStyleAlignmentRight);
                 

        //Cambiar estilo de la celda
        $objExcel->getActiveSheet()
                 ->getStyle('A'.$intFila.':'.'H'.$intFila)
                 ->applyFromArray($arrStyleBold);  


        
        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'presupuestos_ventas.xls', 'presupuestos', $intFila);
    }


    //Asignar objeto con los detalles de presupuestos
    public function get_presupuestos($strAnio)
    {
    	//Array que se utiliza para enviar datos
        $arrDatos = array('presupuestos' => NULL, 
                          'acumulados' => NULL);

        //Array que se utiliza para agregar los datos de presupuestos mensuales
        $arrPptoMeses = array();
        //Array que se utiliza para agregar acumulados
        $arrAcumulados = array();
        //Array que se utiliza para agregar los datos de un presupuesto mensual
        $arrAuxiliar = array();

        //Array´s que se utilizan para asignar importes de los presupuestos/ventas mensuales 
    	//Importes presupuestados
    	$arrPresupuesto = array();
    	//Importes reales de refacciones
    	$arrRefacciones = array();
    	//Inicializar valores del array
    	//Enero
    	$arrRefacciones['01'] = 0;
    	//Febrero
    	$arrRefacciones['02'] = 0;
    	//Marzo
    	$arrRefacciones['03'] = 0;
    	//Abril
    	$arrRefacciones['04'] = 0;
    	//Mayo
    	$arrRefacciones['05'] = 0;
    	//Junio
    	$arrRefacciones['06'] = 0;
    	//Julio
    	$arrRefacciones['07'] = 0;
    	//Agosto
    	$arrRefacciones['08'] = 0;
    	//Septiembre
    	$arrRefacciones['09'] = 0;
    	//Octubre
    	$arrRefacciones['10'] = 0;
    	//Noviembre
    	$arrRefacciones['11'] = 0;
    	//Diciembre
    	$arrRefacciones['12'] = 0;

    	//Importes reales de trabajos foráneos
    	$arrTrabajosForaneos = array();
    	//Inicializar valores del array
    	//Enero
    	$arrTrabajosForaneos['01'] = 0;
    	//Febrero
    	$arrTrabajosForaneos['02'] = 0;
    	//Marzo
    	$arrTrabajosForaneos['03'] = 0;
    	//Abril
    	$arrTrabajosForaneos['04'] = 0;
    	//Mayo
    	$arrTrabajosForaneos['05'] = 0;
    	//Junio
    	$arrTrabajosForaneos['06'] = 0;
    	//Julio
    	$arrTrabajosForaneos['07'] = 0;
    	//Agosto
    	$arrTrabajosForaneos['08'] = 0;
    	//Septiembre
    	$arrTrabajosForaneos['09'] = 0;
    	//Octubre
    	$arrTrabajosForaneos['10'] = 0;
    	//Noviembre
    	$arrTrabajosForaneos['11'] = 0;
    	//Diciembre
    	$arrTrabajosForaneos['12'] = 0;


    	//Importes reales de otros servicios
    	$arrOtros = array();
    	//Inicializar valores del array
    	//Enero
    	$arrOtros['01'] = 0;
    	//Febrero
    	$arrOtros['02'] = 0;
    	//Marzo
    	$arrOtros['03'] = 0;
    	//Abril
    	$arrOtros['04'] = 0;
    	//Mayo
    	$arrOtros['05'] = 0;
    	//Junio
    	$arrOtros['06'] = 0;
    	//Julio
    	$arrOtros['07'] = 0;
    	//Agosto
    	$arrOtros['08'] = 0;
    	//Septiembre
    	$arrOtros['09'] = 0;
    	//Octubre
    	$arrOtros['10'] = 0;
    	//Noviembre
    	$arrOtros['11'] = 0;
    	//Diciembre
    	$arrOtros['12'] = 0;


    	//Importes reales de kilometraje
    	$arrKilometraje = array();
    	//Inicializar valores del array
    	//Enero
    	$arrKilometraje['01'] = 0;
    	//Febrero
    	$arrKilometraje['02'] = 0;
    	//Marzo
    	$arrKilometraje['03'] = 0;
    	//Abril
    	$arrKilometraje['04'] = 0;
    	//Mayo
    	$arrKilometraje['05'] = 0;
    	//Junio
    	$arrKilometraje['06'] = 0;
    	//Julio
    	$arrKilometraje['07'] = 0;
    	//Agosto
    	$arrKilometraje['08'] = 0;
    	//Septiembre
    	$arrKilometraje['09'] = 0;
    	//Octubre
    	$arrKilometraje['10'] = 0;
    	//Noviembre
    	$arrKilometraje['11'] = 0;
    	//Diciembre
    	$arrKilometraje['12'] = 0;

    	//Variables que se utilizan para asignar los acumulados de presupuestos
        $intAcumPresupuesto = 0;
        $intAcumRefacciones = 0;
        $intAcumTF = 0;
        $intAcumOtros = 0;
        $intAcumKilometraje = 0;


        //Seleccionar los datos de los presupuestos que coinciden con el parámetro enviado
        $otdResultado = $this->presupuestos->buscar_presupuestos_anio($strAnio);

        //Verificar si existe información
        if($otdResultado)
        {

            //Recorremos el arreglo 
            foreach ($otdResultado as $arrCol) 
            {
            	
            	//Variables que se utilizan para asignar valores del detalle
            	$strMes = $arrCol->mes;
            	$strTipo = $arrCol->tipo;
            	$intImporte = $arrCol->importe;
            
            	//Dependiendo del tipo asignar importe
            	if($strTipo == 'Presupuesto')
            	{
            		//Asignar importe del mes
            		$arrPresupuesto[$strMes] = $intImporte;
            		//Incrementar acumulado 
            		$intAcumPresupuesto += $intImporte;

            	}
            	else if($strTipo == 'Refacciones')
            	{
            		//Asignar importe del mes
            		$arrRefacciones[$strMes] = $intImporte;
            		//Incrementar acumulado 
            		$intAcumRefacciones += $intImporte;
            	}
            	else if($strTipo == 'Trabajos Foraneos')
            	{
            		//Asignar importe del mes
            		$arrTrabajosForaneos[$strMes] = $intImporte;
            		//Incrementar acumulado 
            		$intAcumTF += $intImporte;
            	}
            	else if($strTipo == 'Otros')
            	{
            		//Asignar importe del mes
            		$arrOtros[$strMes] = $intImporte;
            		//Incrementar acumulado 
            		$intAcumOtros += $intImporte;
            	}
            	else //Si el tipo es gastos de servicio
            	{
            		//Asignar importe del mes
					$arrKilometraje[$strMes] = $intImporte;
					//Incrementar acumulado 
            		$intAcumKilometraje += $intImporte;
            	}

            }//Cierre de foreach


            //Definir valores del array auxiliar de información (para cada mes)
       		/*
            * Presupuestos del mes de Enero
            */
            //Calcular el importe total de ventas mensuales
            $intImporteVentas = $arrRefacciones['01'] +  $arrTrabajosForaneos['01'] + 
            					$arrOtros['01'] + $arrKilometraje['01'];

            
            $arrAuxiliar["mes"] = 'ENERO';
            $arrAuxiliar["presupuesto"] = $arrPresupuesto['01'];	
            $arrAuxiliar["refacciones"] = $arrRefacciones['01'];	
            $arrAuxiliar["trabajos_foraneos"] = $arrTrabajosForaneos['01'];		
            $arrAuxiliar["otros"] = $arrOtros['01'];
            $arrAuxiliar["kilometraje"] = $arrKilometraje['01'];
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia"] = $intImporteVentas - $arrPresupuesto['01'];
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento"] = $this->get_cumplimiento_ppto($arrPresupuesto['01'], 
                                                                        $intImporteVentas);

            //Asignar datos al array
            array_push($arrPptoMeses, $arrAuxiliar); 

			
			/*
            * Presupuestos del mes de Febrero
            */
            //Calcular el importe total de ventas mensuales
            $intImporteVentas = $arrRefacciones['02'] +  $arrTrabajosForaneos['02'] + 
            					$arrOtros['02'] + $arrKilometraje['02'];

            
            $arrAuxiliar["mes"] = 'FEBRERO';
            $arrAuxiliar["presupuesto"] = $arrPresupuesto['02'];	
            $arrAuxiliar["refacciones"] = $arrRefacciones['02'];	
            $arrAuxiliar["trabajos_foraneos"] = $arrTrabajosForaneos['02'];		
            $arrAuxiliar["otros"] = $arrOtros['02'];
            $arrAuxiliar["kilometraje"] = $arrKilometraje['02'];
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia"] = $intImporteVentas - $arrPresupuesto['02'];
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento"] = $this->get_cumplimiento_ppto($arrPresupuesto['02'], 
                                                                        $intImporteVentas);

            //Asignar datos al array
            array_push($arrPptoMeses, $arrAuxiliar); 


            /*
            * Presupuestos del mes de Marzo
            */
            //Calcular el importe total de ventas mensuales
            $intImporteVentas = $arrRefacciones['03'] +  $arrTrabajosForaneos['03'] + 
            					$arrOtros['03'] + $arrKilometraje['03'];

            
            $arrAuxiliar["mes"] = 'MARZO';
            $arrAuxiliar["presupuesto"] = $arrPresupuesto['03'];	
            $arrAuxiliar["refacciones"] = $arrRefacciones['03'];	
            $arrAuxiliar["trabajos_foraneos"] = $arrTrabajosForaneos['03'];		
            $arrAuxiliar["otros"] = $arrOtros['03'];
            $arrAuxiliar["kilometraje"] = $arrKilometraje['03'];
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia"] = $intImporteVentas - $arrPresupuesto['03'];
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento"] = $this->get_cumplimiento_ppto($arrPresupuesto['03'], 
                                                                        $intImporteVentas);

            //Asignar datos al array
            array_push($arrPptoMeses, $arrAuxiliar); 


            /*
            * Presupuestos del mes de Abril
            */
            //Calcular el importe total de ventas mensuales
            $intImporteVentas = $arrRefacciones['04'] +  $arrTrabajosForaneos['04'] + 
            					$arrOtros['04'] + $arrKilometraje['04'];

            
            $arrAuxiliar["mes"] = 'ABRIL';
            $arrAuxiliar["presupuesto"] = $arrPresupuesto['04'];	
            $arrAuxiliar["refacciones"] = $arrRefacciones['04'];	
            $arrAuxiliar["trabajos_foraneos"] = $arrTrabajosForaneos['04'];		
            $arrAuxiliar["otros"] = $arrOtros['04'];
            $arrAuxiliar["kilometraje"] = $arrKilometraje['04'];
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia"] = $intImporteVentas - $arrPresupuesto['04'];
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento"] = $this->get_cumplimiento_ppto($arrPresupuesto['04'], 
                                                                        $intImporteVentas);

            //Asignar datos al array
            array_push($arrPptoMeses, $arrAuxiliar); 


            /*
            * Presupuestos del mes de Mayo
            */
            //Calcular el importe total de ventas mensuales
            $intImporteVentas = $arrRefacciones['05'] +  $arrTrabajosForaneos['05'] + 
            					$arrOtros['05'] + $arrKilometraje['05'];

            
            $arrAuxiliar["mes"] = 'MAYO';
            $arrAuxiliar["presupuesto"] = $arrPresupuesto['05'];	
            $arrAuxiliar["refacciones"] = $arrRefacciones['05'];	
            $arrAuxiliar["trabajos_foraneos"] = $arrTrabajosForaneos['05'];		
            $arrAuxiliar["otros"] = $arrOtros['05'];
            $arrAuxiliar["kilometraje"] = $arrKilometraje['05'];
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia"] = $intImporteVentas - $arrPresupuesto['05'];
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento"] = $this->get_cumplimiento_ppto($arrPresupuesto['05'], 
                                                                        $intImporteVentas);

            //Asignar datos al array
            array_push($arrPptoMeses, $arrAuxiliar); 


            /*
            * Presupuestos del mes de Junio
            */
            //Calcular el importe total de ventas mensuales
            $intImporteVentas = $arrRefacciones['06'] +  $arrTrabajosForaneos['06'] + 
            					$arrOtros['06'] + $arrKilometraje['06'];

            
            $arrAuxiliar["mes"] = 'JUNIO';
            $arrAuxiliar["presupuesto"] = $arrPresupuesto['06'];	
            $arrAuxiliar["refacciones"] = $arrRefacciones['06'];	
            $arrAuxiliar["trabajos_foraneos"] = $arrTrabajosForaneos['06'];		
            $arrAuxiliar["otros"] = $arrOtros['06'];
            $arrAuxiliar["kilometraje"] = $arrKilometraje['06'];
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia"] = $intImporteVentas - $arrPresupuesto['06'];
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento"] = $this->get_cumplimiento_ppto($arrPresupuesto['06'], 
                                                                        $intImporteVentas);

            //Asignar datos al array
            array_push($arrPptoMeses, $arrAuxiliar); 


            /*
            * Presupuestos del mes de Julio
            */
            //Calcular el importe total de ventas mensuales
            $intImporteVentas = $arrRefacciones['07'] +  $arrTrabajosForaneos['07'] + 
            					$arrOtros['07'] + $arrKilometraje['07'];

            
            $arrAuxiliar["mes"] = 'JULIO';
            $arrAuxiliar["presupuesto"] = $arrPresupuesto['07'];	
            $arrAuxiliar["refacciones"] = $arrRefacciones['07'];	
            $arrAuxiliar["trabajos_foraneos"] = $arrTrabajosForaneos['07'];		
            $arrAuxiliar["otros"] = $arrOtros['07'];
            $arrAuxiliar["kilometraje"] = $arrKilometraje['07'];
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia"] = $intImporteVentas - $arrPresupuesto['07'];
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento"] = $this->get_cumplimiento_ppto($arrPresupuesto['07'], 
                                                                        $intImporteVentas);

            //Asignar datos al array
            array_push($arrPptoMeses, $arrAuxiliar); 


            /*
            * Presupuestos del mes de Agosto
            */
            //Calcular el importe total de ventas mensuales
            $intImporteVentas = $arrRefacciones['08'] +  $arrTrabajosForaneos['08'] + 
            					$arrOtros['08'] + $arrKilometraje['08'];

            
            $arrAuxiliar["mes"] = 'AGOSTO';
            $arrAuxiliar["presupuesto"] = $arrPresupuesto['08'];	
            $arrAuxiliar["refacciones"] = $arrRefacciones['08'];	
            $arrAuxiliar["trabajos_foraneos"] = $arrTrabajosForaneos['08'];		
            $arrAuxiliar["otros"] = $arrOtros['08'];
            $arrAuxiliar["kilometraje"] = $arrKilometraje['08'];
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia"] = $intImporteVentas - $arrPresupuesto['08'];
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento"] = $this->get_cumplimiento_ppto($arrPresupuesto['08'], 
                                                                        $intImporteVentas);

            //Asignar datos al array
            array_push($arrPptoMeses, $arrAuxiliar);


            /*
            * Presupuestos del mes de Septiembre
            */
            //Calcular el importe total de ventas mensuales
            $intImporteVentas = $arrRefacciones['09'] +  $arrTrabajosForaneos['09'] + 
            					$arrOtros['09'] + $arrKilometraje['09'];

            
            $arrAuxiliar["mes"] = 'SEPTIEMBRE';
            $arrAuxiliar["presupuesto"] = $arrPresupuesto['09'];	
            $arrAuxiliar["refacciones"] = $arrRefacciones['09'];	
            $arrAuxiliar["trabajos_foraneos"] = $arrTrabajosForaneos['09'];		
            $arrAuxiliar["otros"] = $arrOtros['09'];
            $arrAuxiliar["kilometraje"] = $arrKilometraje['09'];
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia"] = $intImporteVentas - $arrPresupuesto['09'];
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento"] = $this->get_cumplimiento_ppto($arrPresupuesto['09'], 
                                                                        $intImporteVentas);

            //Asignar datos al array
            array_push($arrPptoMeses, $arrAuxiliar); 



            /*
            * Presupuestos del mes de Octubre
            */
            //Calcular el importe total de ventas mensuales
            $intImporteVentas = $arrRefacciones['10'] +  $arrTrabajosForaneos['10'] + 
            					$arrOtros['10'] + $arrKilometraje['10'];

            
            $arrAuxiliar["mes"] = 'OCTUBRE';
            $arrAuxiliar["presupuesto"] = $arrPresupuesto['10'];	
            $arrAuxiliar["refacciones"] = $arrRefacciones['10'];	
            $arrAuxiliar["trabajos_foraneos"] = $arrTrabajosForaneos['10'];		
            $arrAuxiliar["otros"] = $arrOtros['10'];
            $arrAuxiliar["kilometraje"] = $arrKilometraje['10'];
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia"] = $intImporteVentas - $arrPresupuesto['10'];
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento"] = $this->get_cumplimiento_ppto($arrPresupuesto['10'], 
                                                                        $intImporteVentas);

            //Asignar datos al array
            array_push($arrPptoMeses, $arrAuxiliar); 


            /*
            * Presupuestos del mes de Noviembre
            */
            //Calcular el importe total de ventas mensuales
            $intImporteVentas = $arrRefacciones['11'] +  $arrTrabajosForaneos['11'] + 
            					$arrOtros['11'] + $arrKilometraje['11'];

            
            $arrAuxiliar["mes"] = 'NOVIEMBRE';
            $arrAuxiliar["presupuesto"] = $arrPresupuesto['11'];	
            $arrAuxiliar["refacciones"] = $arrRefacciones['11'];	
            $arrAuxiliar["trabajos_foraneos"] = $arrTrabajosForaneos['11'];		
            $arrAuxiliar["otros"] = $arrOtros['11'];
            $arrAuxiliar["kilometraje"] = $arrKilometraje['11'];
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia"] = $intImporteVentas - $arrPresupuesto['11'];
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento"] = $this->get_cumplimiento_ppto($arrPresupuesto['11'], 
                                                                        $intImporteVentas);

            //Asignar datos al array
            array_push($arrPptoMeses, $arrAuxiliar); 


            /*
            * Presupuestos del mes de Diciembre
            */
            //Calcular el importe total de ventas mensuales
            $intImporteVentas = $arrRefacciones['12'] +  $arrTrabajosForaneos['12'] + 
            					$arrOtros['12'] + $arrKilometraje['12'];

            
            $arrAuxiliar["mes"] = 'DICIEMBRE';
            $arrAuxiliar["presupuesto"] = $arrPresupuesto['12'];	
            $arrAuxiliar["refacciones"] = $arrRefacciones['12'];	
            $arrAuxiliar["trabajos_foraneos"] = $arrTrabajosForaneos['12'];		
            $arrAuxiliar["otros"] = $arrOtros['12'];
            $arrAuxiliar["kilometraje"] = $arrKilometraje['12'];
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia"] = $intImporteVentas - $arrPresupuesto['12'];
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento"] = $this->get_cumplimiento_ppto($arrPresupuesto['12'], 
                                                                        $intImporteVentas);

            //Asignar datos al array
            array_push($arrPptoMeses, $arrAuxiliar); 

            //------------------------------------------------------------------------------------------------------------------------
            //---------- ACUMULADOS
            //------------------------------------------------------------------------------------------------------------------------
            //Inicializar array auxiliar
            $arrAuxiliar = array();


            //Calcular el importe total de ventas mensuales
            $intImporteVentas = $intAcumRefacciones +  $intAcumTF + 
            					$intAcumOtros + $intAcumKilometraje;


            //Agregar datos al array
            //Definir valores del array auxiliar de información (para los acumulados)
           	$arrAuxiliar["presupuesto"] = $intAcumPresupuesto;
           	$arrAuxiliar["refacciones"] = $intAcumRefacciones;	
            $arrAuxiliar["trabajos_foraneos"] = $intAcumTF;	
            $arrAuxiliar["otros"] = $intAcumOtros;
            $arrAuxiliar["kilometraje"] = $intAcumKilometraje;
              //Calcular diferencia de importes
            $arrAuxiliar["diferencia"] = $intImporteVentas - $intAcumPresupuesto;
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento"] = $this->get_cumplimiento_ppto($intAcumPresupuesto, 
                                                                        $intImporteVentas);
            //Asignar datos al array
            array_push($arrAcumulados, $arrAuxiliar); 


            //Agregar datos a los array's
            $arrDatos['presupuestos'] = $arrPptoMeses;
            $arrDatos['acumulados'] = $arrAcumulados;

        }//Cierre de verificación de información


        //Regresar array con los datos de los presupuestos
        return $arrDatos;

    }

}	