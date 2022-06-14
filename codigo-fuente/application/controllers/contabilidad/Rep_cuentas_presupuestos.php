<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_cuentas_presupuestos extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('contabilidad/cuentas_presupuestos_model', 'presupuestos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('contabilidad/rep_cuentas_presupuestos', $arrDatos);
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

        //Array que se utiliza para agregar los datos de mecánicos
        $arrCuentas = array();
        //Array que se utiliza para agregar acumulados
        $arrAcumulados = array();

        //Se crea una instancia de la clase PDF
        $pdf = new PDF('L','mm','legal');//orientación horizontal
        //Asignar el nombre del usuario que se encuantra logeado en el sistema
        //para el pie de pagina del PDF
        $pdf->strUsuario = $this->session->userdata('usuario');
        //Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
        //para el encabezado del PDF
        $pdf->intSucursalID = $this->session->userdata('sucursal_id');
        //Crea los titulos de la cabecera
        $pdf->arrCabecera = array(utf8_decode('CUENTA'), 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 
                                  'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 
                                  'NOVIEMBRE', 'DICIEMBRE', 'ANUAL');

        //Establece el ancho de las columnas de cabecera
        $pdf->arrAnchura = array(23, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24);
        //Establece la alineación de las celdas de la tabla
        $pdf->arrAlineacion = array('L', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 
                                    'R', 'R', 'R', 'R', 'R');

        //Crea los titulos de la cabecera de la tabla resumen
        $arrCabeceraResumen = array('CONCEPTO', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 
                                   'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 
                                   'NOVIEMBRE', 'DICIEMBRE', 'ANUAL');

        //Establece el ancho de las columna mecánico
        $arrAnchuraCuenta = array(335);
        //Establece la alineación de la celda mecánico
        $arrAlineacionCuenta = array('L');

        //Asignar el valor de la descripción (título de la lista de registros) del reporte
        $pdf->strLinea1 =  utf8_decode('LISTADO DE PRESUPUESTOS DE CUENTAS DEL AÑO ').$strAnio;

        //Agregar la primer pagina
        $pdf->AddPage();
       

        //Asignar objeto con los presupuestos de las cuentas en el año
        $otdPresupuestos = $this->get_presupuestos($strAnio);  
        //Asignar array con los datos de las cuentas
        $arrCuentas = $otdPresupuestos['cuentas']; 
         //Asignar array con los acumulados
        $arrAcumulados = $otdPresupuestos['acumulados'];  

        //Si hay información de las cuentas
        if($arrCuentas)
        {
            //Recorremos el arreglo 
            foreach ($arrCuentas as $arrDet) 
            {
                //Establece el ancho de las columnas
                $pdf->SetWidths($arrAnchuraCuenta);
                //Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
                $pdf->Row(array(utf8_decode($arrDet['cuenta'])), $arrAlineacionCuenta, 'ClippedCell');


                //Establece el ancho de las columnas
                $pdf->SetWidths($pdf->arrAnchura);

                /*Nota: se concatena |Negrita -> para cambiar el volumen de la fuente a bold,
                        se concatena |VerificarNumero -> para cambiar el color de texto a rojo en caso de que el valor numérico sea negativo
                 */
                //IMPORTE PRESUPUESTADO
                $pdf->Row(array('IMPT. PPTO.|Negrita', 
                              '$'.number_format($arrDet['presupuesto_enero'],2),
                              '$'.number_format($arrDet['presupuesto_febrero'],2),
                              '$'.number_format( $arrDet['presupuesto_marzo'],2),
                              '$'.number_format($arrDet['presupuesto_abril'],2),
                              '$'.number_format($arrDet['presupuesto_mayo'],2),
                              '$'.number_format($arrDet['presupuesto_junio'],2),
                              '$'.number_format($arrDet['presupuesto_julio'],2),
                              '$'.number_format($arrDet['presupuesto_agosto'],2),
                              '$'.number_format($arrDet['presupuesto_septiembre'],2),
                              '$'.number_format($arrDet['presupuesto_octubre'],2),
                              '$'.number_format($arrDet['presupuesto_noviembre'],2),
                              '$'.number_format($arrDet['presupuesto_diciembre'],2),
                              '$'.number_format($arrDet['presupuesto_anual'],2)), 
                         $pdf->arrAlineacion, 'ClippedCell');

                //IMPORTE REAL
                $pdf->Row(array('IMPT. REAL|Negrita',
                               '$'.number_format($arrDet['real_enero'],2),
                               '$'.number_format($arrDet['real_febrero'],2),
                               '$'.number_format($arrDet['real_marzo'],2),
                               '$'.number_format($arrDet['real_abril'],2),
                               '$'.number_format( $arrDet['real_mayo'],2),
                               '$'.number_format($arrDet['real_junio'],2),
                               '$'.number_format($arrDet['real_julio'],2),
                               '$'.number_format($arrDet['real_agosto'],2),
                               '$'.number_format($arrDet['real_septiembre'],2),
                               '$'.number_format($arrDet['real_octubre'],2),
                               '$'.number_format($arrDet['real_noviembre'],2),
                               '$'.number_format($arrDet['real_diciembre'],2),
                               '$'.number_format($arrDet['real_anual'],2)), 
                            $pdf->arrAlineacion, 'ClippedCell');
                

                //DIFERENCIA
                $pdf->Row(array('DIFERENCIA|Negrita',
                                '$'.number_format($arrDet['diferencia_importeEnero'],2).'|VerificarNumero',
                                '$'.number_format($arrDet['diferencia_importeFebrero'],2).'|VerificarNumero',
                                '$'.number_format($arrDet['diferencia_importeMarzo'],2).'|VerificarNumero',
                                '$'.number_format($arrDet['diferencia_importeAbril'],2).'|VerificarNumero',
                                '$'.number_format($arrDet['diferencia_importeMayo'],2).'|VerificarNumero',
                                '$'.number_format($arrDet['diferencia_importeJunio'],2).'|VerificarNumero',
                                '$'.number_format($arrDet['diferencia_importeJulio'],2).'|VerificarNumero',
                                '$'.number_format($arrDet['diferencia_importeAgosto'],2).'|VerificarNumero',
                                '$'.number_format($arrDet['diferencia_importeSeptiembre'],2).'|VerificarNumero',
                                '$'.number_format($arrDet['diferencia_importeOctubre'],2).'|VerificarNumero',
                                '$'.number_format($arrDet['diferencia_importeNoviembre'],2).'|VerificarNumero',
                                '$'.number_format($arrDet['diferencia_importeDiciembre'],2).'|VerificarNumero',
                                '$'.number_format($arrDet['diferencia_importeAnual'],2).'|VerificarNumero'), 
                            $pdf->arrAlineacion, 'ClippedCell');

                //% CUMPLIMIENTO
                $pdf->Row(array('% CUMP.|Negrita',
                                number_format($arrDet['cumplimiento_importeEnero'], 2),
                                number_format($arrDet['cumplimiento_importeFebrero'], 2),
                                number_format($arrDet['cumplimiento_importeMarzo'], 2),
                                number_format($arrDet['cumplimiento_importeAbril'], 2),
                                number_format($arrDet['cumplimiento_importeMayo'], 2),
                                number_format($arrDet['cumplimiento_importeJunio'], 2),
                                number_format($arrDet['cumplimiento_importeJulio'], 2),
                                number_format($arrDet['cumplimiento_importeAgosto'], 2),
                                number_format($arrDet['cumplimiento_importeSeptiembre'], 2),
                                number_format($arrDet['cumplimiento_importeOctubre'], 2),
                                number_format($arrDet['cumplimiento_importeNoviembre'], 2),
                                number_format($arrDet['cumplimiento_importeDiciembre'], 2),
                                number_format($arrDet['cumplimiento_importeAnual'], 2)), 
                            $pdf->arrAlineacion, 'ClippedCell');

                
                $pdf->Ln(4);//Deja un salto de línea


            }//Cierre de foreach

        }//Cierre de verificación de información


        $pdf->Ln(5);//Deja un salto de linea
        //------------------------------------------------------------------------------------------------------------------------
        //---------- RESUMEN
        //------------------------------------------------------------------------------------------------------------------------
        //Establecer el color de fondo para la cabecera
        $pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
        $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
        //Asigna el tipo y tamaño de letra para la cabecera de la tabla
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
        $pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
        //Creación de la tabla Resumen
        $pdf->Cell(335, 4, 'RESUMEN', 0, 0, 'C', TRUE);
        $pdf->Ln(4);//Deja un salto de linea
        //Recorre el array de titulos de encabezado para crearlos
        for ($intCont = 0; $intCont < count($arrCabeceraResumen); $intCont++)
        {
            //inserta los titulos de la cabecera
            $pdf->Cell($pdf->arrAnchura[$intCont], 5, $arrCabeceraResumen[$intCont], 1, 0, 
                       $pdf->arrAlineacion[$intCont], TRUE);
        }

        $pdf->Ln(6);//Deja un salto de línea
        //Establece el ancho de las columnas
        $pdf->SetWidths($pdf->arrAnchura);
        $pdf->SetTextColor(0); //establece el color de texto
        //Si hay información de los acumulados
        if($arrAcumulados)
        {
           
             //IMPORTE PRESUPUESTADO
             $pdf->Row(array('IMPT. PPTO.|Negrita', 
                           '$'.number_format($arrAcumulados[0]['presupuesto_enero'],2),
                           '$'.number_format($arrAcumulados[0]['presupuesto_febrero'],2),
                           '$'.number_format($arrAcumulados[0]['presupuesto_marzo'],2),
                           '$'.number_format($arrAcumulados[0]['presupuesto_abril'],2),
                           '$'.number_format($arrAcumulados[0]['presupuesto_mayo'],2),
                           '$'.number_format($arrAcumulados[0]['presupuesto_junio'],2),
                           '$'.number_format($arrAcumulados[0]['presupuesto_julio'],2),
                           '$'.number_format($arrAcumulados[0]['presupuesto_agosto'],2),
                           '$'.number_format($arrAcumulados[0]['presupuesto_septiembre'],2),
                           '$'.number_format($arrAcumulados[0]['presupuesto_octubre'],2),
                           '$'.number_format($arrAcumulados[0]['presupuesto_noviembre'],2),
                           '$'.number_format($arrAcumulados[0]['presupuesto_diciembre'],2),
                           '$'.number_format($arrAcumulados[0]['presupuesto_anual'],2)), 
                      $pdf->arrAlineacion, 'ClippedCell');

             //IMPORTE REAL
             $pdf->Row(array('IMPT. REAL|Negrita',
                            '$'.number_format($arrAcumulados[0]['real_enero'],2),
                            '$'.number_format($arrAcumulados[0]['real_febrero'],2),
                            '$'.number_format($arrAcumulados[0]['real_marzo'],2),
                            '$'.number_format($arrAcumulados[0]['real_abril'],2),
                            '$'.number_format($arrAcumulados[0]['real_mayo'],2),
                            '$'.number_format($arrAcumulados[0]['real_junio'],2),
                            '$'.number_format($arrAcumulados[0]['real_julio'],2),
                            '$'.number_format($arrAcumulados[0]['real_agosto'],2),
                            '$'.number_format($arrAcumulados[0]['real_septiembre'],2),
                            '$'.number_format($arrAcumulados[0]['real_octubre'],2),
                            '$'.number_format($arrAcumulados[0]['real_noviembre'],2),
                            '$'.number_format($arrAcumulados[0]['real_diciembre'],2),
                            '$'.number_format($arrAcumulados[0]['real_anual'],2)), 
                     $pdf->arrAlineacion, 'ClippedCell');
             
             //DIFERENCIA
             $pdf->Row(array('DIF. IMPT.|Negrita',
                             '$'.number_format($arrAcumulados[0]['diferencia_importeEnero'],2).'|VerificarNumero',
                             '$'.number_format($arrAcumulados[0]['diferencia_importeFebrero'],2).'|VerificarNumero',
                             '$'.number_format($arrAcumulados[0]['diferencia_importeMarzo'],2).'|VerificarNumero',
                             '$'.number_format($arrAcumulados[0]['diferencia_importeAbril'],2).'|VerificarNumero',
                             '$'.number_format($arrAcumulados[0]['diferencia_importeMayo'],2).'|VerificarNumero',
                             '$'.number_format($arrAcumulados[0]['diferencia_importeJunio'],2).'|VerificarNumero',
                             '$'.number_format($arrAcumulados[0]['diferencia_importeJulio'],2).'|VerificarNumero',
                             '$'.number_format($arrAcumulados[0]['diferencia_importeAgosto'],2).'|VerificarNumero',
                             '$'.number_format($arrAcumulados[0]['diferencia_importeSeptiembre'],2).'|VerificarNumero',
                             '$'.number_format($arrAcumulados[0]['diferencia_importeOctubre'],2).'|VerificarNumero',
                             '$'.number_format($arrAcumulados[0]['diferencia_importeNoviembre'],2).'|VerificarNumero',
                             '$'.number_format($arrAcumulados[0]['diferencia_importeDiciembre'],2).'|VerificarNumero',
                             '$'.number_format($arrAcumulados[0]['diferencia_importeAnual'],2).'|VerificarNumero'), 
                       $pdf->arrAlineacion, 'ClippedCell');

             //% CUMPLIMIENTO
             $pdf->Row(array('% CUMP.|Negrita',
                             number_format($arrAcumulados[0]['cumplimiento_importeEnero'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_importeFebrero'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_importeMarzo'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_importeAbril'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_importeMayo'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_importeJunio'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_importeJulio'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_importeAgosto'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_importeSeptiembre'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_importeOctubre'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_importeNoviembre'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_importeDiciembre'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_importeAnual'], 2)), 
                     $pdf->arrAlineacion, 'ClippedCell');

        }//Cierre de verificación de información

        //Ejecutar la salida del reporte
        $pdf->Output('presupuestos_cuentas.pdf','I'); 
    }

	
    /*Método para generar un archivo XLS con el listado de presupuestos de un año*/
    public function get_xls() 
    {
        //Variables que se utilizan para recuperar los valores de la vista
        $strAnio = $this->input->post('strAnio');
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        $intPosPrimerCabecera = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;
        //Array que se utiliza para agregar los datos de mecánicos
        $arrCuentas = array();
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
                 ->setCellValue('A7', 'LISTADO DE PRESUPUESTOS DE CUENTAS DEL AÑO '.$strAnio);

        //Se agregan las columnas de la primer cabecera
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('B'.$intPosEncabezados, 'ENERO')
                 ->setCellValue('F'.$intPosEncabezados, 'FEBRERO')
                 ->setCellValue('J'.$intPosEncabezados, 'MARZO')
                 ->setCellValue('N'.$intPosEncabezados, 'ABRIL')
                 ->setCellValue('R'.$intPosEncabezados, 'MAYO')
                 ->setCellValue('V'.$intPosEncabezados, 'JUNIO')
                 ->setCellValue('Z'.$intPosEncabezados, 'JULIO')
                 ->setCellValue('AD'.$intPosEncabezados, 'AGOSTO')
                 ->setCellValue('AH'.$intPosEncabezados, 'SEPTIEMBRE')
                 ->setCellValue('AL'.$intPosEncabezados, 'OCTUBRE')
                 ->setCellValue('AP'.$intPosEncabezados, 'NOVIEMBRE')
                 ->setCellValue('AT'.$intPosEncabezados, 'DICIEMBRE')
                 ->setCellValue('AX'.$intPosEncabezados, 'ANUAL');

        //Incrementar los indices para escribir las columnas de la cabecera 2
        $intPosEncabezados++;
        //Se agregan las columnas de la segunda cabecera
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$intPosEncabezados, 'CUENTA')
                 //Presupuestos del mes de Enero
                 ->setCellValue('B'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('C'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('D'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('E'.$intPosEncabezados, '% CUMPLIMIENTO')
                 //Presupuestos del mes de Febrero
                 ->setCellValue('F'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('G'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('H'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('I'.$intPosEncabezados, '% CUMPLIMIENTO')
                 //Presupuestos del mes de Marzo
                 ->setCellValue('J'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('K'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('L'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('M'.$intPosEncabezados, '% CUMPLIMIENTO')
                 //Presupuestos del mes de Abril
                 ->setCellValue('N'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('O'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('P'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('Q'.$intPosEncabezados, '% CUMPLIMIENTO')
                  //Presupuestos del mes de Mayo
                 ->setCellValue('R'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('S'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('T'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('U'.$intPosEncabezados, '% CUMPLIMIENTO')
                 //Presupuestos del mes de Junio
                 ->setCellValue('V'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('W'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('X'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('Y'.$intPosEncabezados, '% CUMPLIMIENTO')
                 //Presupuestos del mes de Julio
                 ->setCellValue('Z'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('AA'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('AB'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AC'.$intPosEncabezados, '% CUMPLIMIENTO')
                 //Presupuestos del mes de Agosto
                 ->setCellValue('AD'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('AE'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('AF'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AG'.$intPosEncabezados, '% CUMPLIMIENTO')
                 //Presupuestos del mes de Septiembre
                 ->setCellValue('AH'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('AI'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('AJ'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AK'.$intPosEncabezados, '% CUMPLIMIENTO')
                 //Presupuestos del mes de Octubre
                 ->setCellValue('AL'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('AM'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('AN'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AO'.$intPosEncabezados, '% CUMPLIMIENTO')
                 //Presupuestos del mes de Noviembre
                  ->setCellValue('AP'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('AQ'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('AR'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AS'.$intPosEncabezados, '% CUMPLIMIENTO')
                 //Presupuestos del mes de Diciembre
                 ->setCellValue('AT'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('AU'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('AV'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AW'.$intPosEncabezados, '% CUMPLIMIENTO')
                 //Presupuestos del año
                 ->setCellValue('AX'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('AY'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('AZ'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('BA'.$intPosEncabezados, '% CUMPLIMIENTO');


         //Definir estilos de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE,
                                                        'color' => array('rgb' => 'ffffff')));


        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Combinar las siguientes celdas
        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('B'.$intPosPrimerCabecera.':E'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('F'.$intPosPrimerCabecera.':I'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('J'.$intPosPrimerCabecera.':M'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('N'.$intPosPrimerCabecera.':Q'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('R'.$intPosPrimerCabecera.':U'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('V'.$intPosPrimerCabecera.':Y'.$intPosPrimerCabecera); 
        
        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('Z'.$intPosPrimerCabecera.':AC'.$intPosPrimerCabecera);        

        $objExcel->setActiveSheetIndex(0)
                  ->mergeCells('AD'.$intPosPrimerCabecera.':AG'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('AH'.$intPosPrimerCabecera.':AK'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('BV'.$intPosPrimerCabecera.':CC'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('AL'.$intPosPrimerCabecera.':AO'.$intPosPrimerCabecera); 

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('AP'.$intPosPrimerCabecera.':AS'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('AT'.$intPosPrimerCabecera.':AW'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('AX'.$intPosPrimerCabecera.':BA'.$intPosPrimerCabecera);


        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
                 ->getStyle('B'.$intPosPrimerCabecera.':BA'.$intPosPrimerCabecera)
                 ->getFill()
                 ->applyFromArray($arrStyleColumnas);

        $objExcel->getActiveSheet()
                 ->getStyle('A'.$intPosEncabezados.':BA'.$intPosEncabezados)
                 ->getFill()
                 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
        $objExcel->getActiveSheet()
                     ->getStyle('A'.$intPosEncabezados.':BA'.$intPosEncabezados)
                     ->applyFromArray($arrStyleFuenteColumnas);


        //Asignar objeto con los presupuestos de las cuentas en el año
        $otdPresupuestos = $this->get_presupuestos($strAnio);  
        //Asignar array con los datos de las cuentas
        $arrCuentas = $otdPresupuestos['cuentas']; 
         //Asignar array con los acumulados
        $arrAcumulados = $otdPresupuestos['acumulados'];           

        //Si hay información de las cuentas
        if($arrCuentas)
        {
            //Recorremos el arreglo 
            foreach ($arrCuentas as $arrDet) 
            {

                //La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
                //Agregar información del registro
                $objExcel->setActiveSheetIndex(0)
                         ->setCellValueExplicit('A'.$intFila, $arrDet['cuenta'], PHPExcel_Cell_DataType::TYPE_STRING)
                         //Presupuestos del mes de Enero
                         ->setCellValue('B'.$intFila, $arrDet['presupuesto_enero'])
                         ->setCellValue('C'.$intFila, $arrDet['real_enero'])
                         ->setCellValue('D'.$intFila, $arrDet['diferencia_importeEnero'])
                         ->setCellValue('E'.$intFila, $arrDet['cumplimiento_importeEnero'])
                         //Presupuestos del mes de Febrero
                         ->setCellValue('F'.$intFila, $arrDet['presupuesto_febrero'])
                         ->setCellValue('G'.$intFila, $arrDet['real_febrero'])
                         ->setCellValue('H'.$intFila, $arrDet['diferencia_importeFebrero'])
                         ->setCellValue('I'.$intFila, $arrDet['cumplimiento_importeFebrero'])
                         //Presupuestos del mes de Marzo
                         ->setCellValue('J'.$intFila, $arrDet['presupuesto_marzo'])
                         ->setCellValue('K'.$intFila, $arrDet['real_marzo'])
                         ->setCellValue('L'.$intFila, $arrDet['diferencia_importeMarzo'])
                         ->setCellValue('M'.$intFila, $arrDet['cumplimiento_importeMarzo'])
                         //Presupuestos del mes de Abril
                         ->setCellValue('N'.$intFila, $arrDet['presupuesto_abril'])
                         ->setCellValue('O'.$intFila, $arrDet['real_abril'])
                         ->setCellValue('P'.$intFila, $arrDet['diferencia_importeAbril'])
                         ->setCellValue('Q'.$intFila, $arrDet['cumplimiento_importeAbril'])
                         //Presupuestos del mes de Mayo
                         ->setCellValue('R'.$intFila, $arrDet['presupuesto_mayo'])
                         ->setCellValue('S'.$intFila, $arrDet['real_mayo'])
                         ->setCellValue('T'.$intFila, $arrDet['diferencia_importeMayo'])
                         ->setCellValue('U'.$intFila, $arrDet['cumplimiento_importeMayo'])
                         //Presupuestos del mes de Junio
                         ->setCellValue('V'.$intFila, $arrDet['presupuesto_junio'])
                         ->setCellValue('W'.$intFila, $arrDet['real_junio'])
                         ->setCellValue('X'.$intFila, $arrDet['diferencia_importeJunio'])
                         ->setCellValue('Y'.$intFila, $arrDet['cumplimiento_importeJunio'])
                         //Presupuestos del mes de Julio
                         ->setCellValue('Z'.$intFila, $arrDet['presupuesto_julio'])
                         ->setCellValue('AA'.$intFila, $arrDet['real_julio'])
                         ->setCellValue('AB'.$intFila, $arrDet['diferencia_importeJulio'])
                         ->setCellValue('AC'.$intFila, $arrDet['cumplimiento_importeJulio'])
                         //Presupuestos del mes de Agosto
                         ->setCellValue('AD'.$intFila, $arrDet['presupuesto_agosto'])
                         ->setCellValue('AE'.$intFila, $arrDet['real_agosto'])
                         ->setCellValue('AF'.$intFila, $arrDet['diferencia_importeAgosto'])
                         ->setCellValue('AG'.$intFila, $arrDet['cumplimiento_importeAgosto'])
                         //Presupuestos del mes de Septiembre
                         ->setCellValue('AH'.$intFila, $arrDet['presupuesto_septiembre'])
                         ->setCellValue('AI'.$intFila, $arrDet['real_septiembre'])
                         ->setCellValue('AJ'.$intFila, $arrDet['diferencia_importeSeptiembre'])
                         ->setCellValue('AK'.$intFila, $arrDet['cumplimiento_importeSeptiembre'])
                         //Presupuestos del mes de Octubre
                         ->setCellValue('AL'.$intFila, $arrDet['presupuesto_octubre'])
                         ->setCellValue('AM'.$intFila, $arrDet['real_octubre'])
                         ->setCellValue('AN'.$intFila, $arrDet['diferencia_importeOctubre'])
                         ->setCellValue('AO'.$intFila, $arrDet['cumplimiento_importeOctubre'])
                         //Presupuestos del mes de Noviembre
                         ->setCellValue('AP'.$intFila, $arrDet['presupuesto_noviembre'])
                         ->setCellValue('AQ'.$intFila, $arrDet['real_noviembre'])
                         ->setCellValue('AR'.$intFila, $arrDet['diferencia_importeNoviembre'])
                         ->setCellValue('AS'.$intFila, $arrDet['cumplimiento_importeNoviembre'])
                         //Presupuestos del mes de Diciembre
                         ->setCellValue('AT'.$intFila, $arrDet['presupuesto_diciembre'])
                         ->setCellValue('AU'.$intFila, $arrDet['real_diciembre'])
                         ->setCellValue('AV'.$intFila, $arrDet['diferencia_importeDiciembre'])
                         ->setCellValue('AW'.$intFila, $arrDet['cumplimiento_importeDiciembre'])
                         //Presupuestos del año
                         ->setCellValue('AX'.$intFila, $arrDet['presupuesto_anual'])
                         ->setCellValue('AY'.$intFila, $arrDet['real_anual'])
                         ->setCellValue('AZ'.$intFila, $arrDet['diferencia_importeAnual'])
                         ->setCellValue('BA'.$intFila, $arrDet['cumplimiento_importeAnual']);



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
                //La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
                //Agregar información del registro
                $objExcel->setActiveSheetIndex(0)
                         ->setCellValueExplicit('A'.$intFila, 'TOTALES:', PHPExcel_Cell_DataType::TYPE_STRING)
                         //Presupuestos del mes de Enero
                         ->setCellValue('B'.$intFila, $arrAcumulados[0]['presupuesto_enero'])
                         ->setCellValue('C'.$intFila, $arrAcumulados[0]['real_enero'])
                         ->setCellValue('D'.$intFila, $arrAcumulados[0]['diferencia_importeEnero'])
                         ->setCellValue('E'.$intFila, $arrAcumulados[0]['cumplimiento_importeEnero'])
                         //Presupuestos del mes de Febrero
                         ->setCellValue('F'.$intFila, $arrAcumulados[0]['presupuesto_febrero'])
                         ->setCellValue('G'.$intFila, $arrAcumulados[0]['real_febrero'])
                         ->setCellValue('H'.$intFila, $arrAcumulados[0]['diferencia_importeFebrero'])
                         ->setCellValue('I'.$intFila, $arrAcumulados[0]['cumplimiento_importeFebrero'])
                         //Presupuestos del mes de Marzo
                         ->setCellValue('J'.$intFila, $arrAcumulados[0]['presupuesto_marzo'])
                         ->setCellValue('K'.$intFila, $arrAcumulados[0]['real_marzo'])
                         ->setCellValue('L'.$intFila, $arrAcumulados[0]['diferencia_importeMarzo'])
                         ->setCellValue('M'.$intFila, $arrAcumulados[0]['cumplimiento_importeMarzo'])
                         //Presupuestos del mes de Abril
                         ->setCellValue('N'.$intFila, $arrAcumulados[0]['presupuesto_abril'])
                         ->setCellValue('O'.$intFila, $arrAcumulados[0]['real_abril'])
                         ->setCellValue('P'.$intFila, $arrAcumulados[0]['diferencia_importeAbril'])
                         ->setCellValue('Q'.$intFila, $arrAcumulados[0]['cumplimiento_importeAbril'])
                         //Presupuestos del mes de Mayo
                         ->setCellValue('R'.$intFila, $arrAcumulados[0]['presupuesto_mayo'])
                         ->setCellValue('S'.$intFila, $arrAcumulados[0]['real_mayo'])
                         ->setCellValue('T'.$intFila, $arrAcumulados[0]['diferencia_importeMayo'])
                         ->setCellValue('U'.$intFila, $arrAcumulados[0]['cumplimiento_importeMayo'])
                         //Presupuestos del mes de Junio
                         ->setCellValue('V'.$intFila, $arrAcumulados[0]['presupuesto_junio'])
                         ->setCellValue('W'.$intFila, $arrAcumulados[0]['real_junio'])
                         ->setCellValue('X'.$intFila, $arrAcumulados[0]['diferencia_importeJunio'])
                         ->setCellValue('Y'.$intFila, $arrAcumulados[0]['cumplimiento_importeJunio'])
                         //Presupuestos del mes de Julio
                         ->setCellValue('Z'.$intFila, $arrAcumulados[0]['presupuesto_julio'])
                         ->setCellValue('AA'.$intFila, $arrAcumulados[0]['real_julio'])
                         ->setCellValue('AB'.$intFila, $arrAcumulados[0]['diferencia_importeJulio'])
                         ->setCellValue('AC'.$intFila, $arrAcumulados[0]['cumplimiento_importeJulio'])
                         //Presupuestos del mes de Agosto
                         ->setCellValue('AD'.$intFila, $arrAcumulados[0]['presupuesto_agosto'])
                         ->setCellValue('AE'.$intFila, $arrAcumulados[0]['real_agosto'])
                         ->setCellValue('AF'.$intFila, $arrAcumulados[0]['diferencia_importeAgosto'])
                         ->setCellValue('AG'.$intFila, $arrAcumulados[0]['cumplimiento_importeAgosto'])
                         //Presupuestos del mes de Septiembre
                         ->setCellValue('AH'.$intFila, $arrAcumulados[0]['presupuesto_septiembre'])
                         ->setCellValue('AI'.$intFila, $arrAcumulados[0]['real_septiembre'])
                         ->setCellValue('AJ'.$intFila, $arrAcumulados[0]['diferencia_importeSeptiembre'])
                         ->setCellValue('AK'.$intFila, $arrAcumulados[0]['cumplimiento_importeSeptiembre'])
                         //Presupuestos del mes de Octubre
                         ->setCellValue('AL'.$intFila, $arrAcumulados[0]['presupuesto_octubre'])
                         ->setCellValue('AM'.$intFila, $arrAcumulados[0]['real_octubre'])
                         ->setCellValue('AN'.$intFila, $arrAcumulados[0]['diferencia_importeOctubre'])
                         ->setCellValue('AO'.$intFila, $arrAcumulados[0]['cumplimiento_importeOctubre'])
                         //Presupuestos del mes de Noviembre
                         ->setCellValue('AP'.$intFila, $arrAcumulados[0]['presupuesto_noviembre'])
                         ->setCellValue('AQ'.$intFila, $arrAcumulados[0]['real_noviembre'])
                         ->setCellValue('AR'.$intFila, $arrAcumulados[0]['diferencia_importeNoviembre'])
                         ->setCellValue('AS'.$intFila, $arrAcumulados[0]['cumplimiento_importeNoviembre'])
                         //Presupuestos del mes de Diciembre
                         ->setCellValue('AT'.$intFila, $arrAcumulados[0]['presupuesto_diciembre'])
                         ->setCellValue('AU'.$intFila, $arrAcumulados[0]['real_diciembre'])
                         ->setCellValue('AV'.$intFila, $arrAcumulados[0]['diferencia_importeDiciembre'])
                         ->setCellValue('AW'.$intFila, $arrAcumulados[0]['cumplimiento_importeDiciembre'])
                         //Presupuestos del año
                         ->setCellValue('AX'.$intFila, $arrAcumulados[0]['presupuesto_anual'])
                         ->setCellValue('AY'.$intFila, $arrAcumulados[0]['real_anual'])
                         ->setCellValue('AZ'.$intFila, $arrAcumulados[0]['diferencia_importeAnual'])
                         ->setCellValue('BA'.$intFila, $arrAcumulados[0]['cumplimiento_importeAnual']);

        } //Cierre de verificación de información


       /*Cambiar contenido de las celdas a formato moneda 
        (cambiar color de texto en caso de ser un valor negativo)*/
        $objExcel->getActiveSheet()
                 ->getStyle('B'.$intFilaInicial.':'.'D'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');
        
        $objExcel->getActiveSheet()
                 ->getStyle('F'.$intFilaInicial.':'.'H'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('I'.$intFilaInicial.':'.'I'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('J'.$intFilaInicial.':'.'L'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('M'.$intFilaInicial.':'.'M'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('N'.$intFilaInicial.':'.'P'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        
        $objExcel->getActiveSheet()
                 ->getStyle('Q'.$intFilaInicial.':'.'Q'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('R'.$intFilaInicial.':'.'T'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('U'.$intFilaInicial.':'.'U'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('V'.$intFilaInicial.':'.'X'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('Y'.$intFilaInicial.':'.'Y'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('Z'.$intFilaInicial.':'.'AB'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('AC'.$intFilaInicial.':'.'AC'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('AD'.$intFilaInicial.':'.'AF'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('AG'.$intFilaInicial.':'.'AG'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('AH'.$intFilaInicial.':'.'AJ'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('AK'.$intFilaInicial.':'.'AK'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('AL'.$intFilaInicial.':'.'AN'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('AO'.$intFilaInicial.':'.'AO'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('AP'.$intFilaInicial.':'.'AR'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');


        $objExcel->getActiveSheet()
                 ->getStyle('AS'.$intFilaInicial.':'.'AS'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('AT'.$intFilaInicial.':'.'AV'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');


        $objExcel->getActiveSheet()
                 ->getStyle('AW'.$intFilaInicial.':'.'AW'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('AX'.$intFilaInicial.':'.'AZ'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');


        $objExcel->getActiveSheet()
                 ->getStyle('BA'.$intFilaInicial.':'.'BA'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');  

        //Cambiar alineación de las siguientes celdas         
        $objExcel->getActiveSheet()
                 ->getStyle('B'.$intFilaInicial.':'.'BA'.$intFila)
                 ->getAlignment()
                 ->applyFromArray($arrStyleAlignmentRight);

         $objExcel->getActiveSheet()
                 ->getStyle('A'.$intFila.':'.'A'.$intFila)
                 ->getAlignment()
                 ->applyFromArray($arrStyleAlignmentRight);


         //Cambiar estilo de la celda
         $objExcel->getActiveSheet()
                 ->getStyle('A'.$intFila.':'.'BA'.$intFila)
                 ->applyFromArray($arrStyleBold);        

        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'presupuestos_cuentas.xls', 'presupuestos', $intFila);
    }


    //Asignar objeto con los detalles de presupuestos
    public function get_presupuestos($strAnio)
    {
    	//Array que se utiliza para enviar datos
        $arrDatos = array('cuentas' => NULL, 
                          'acumulados' => NULL);

        //Array que se utiliza para agregar los datos de cuentas
        $arrCuentas = array();
        //Array que se utiliza para agregar acumulados
        $arrAcumulados = array();
        //Array que se utiliza para agregar los datos de una cuenta
        $arrAuxiliar = array();

         //Seleccionar los datos de los presupuestos que coinciden con el parámetro enviado
        $otdResultado = $this->presupuestos->buscar_presupuestos_anio($strAnio);

        //Variables que se utilizan para asignar los acumulados de presupuestos
        $intAcumPresupuestoEnero = 0;
        $intAcumPresupuestoFebrero = 0;
        $intAcumPresupuestoMarzo = 0;
        $intAcumPresupuestoAbril = 0;
        $intAcumPresupuestoMayo = 0;
        $intAcumPresupuestoJunio = 0;
        $intAcumPresupuestoJulio = 0;
        $intAcumPresupuestoAgosto = 0;
        $intAcumPresupuestoSeptiembre = 0;
        $intAcumPresupuestoOctubre = 0;
        $intAcumPresupuestoNoviembre = 0;
        $intAcumPresupuestoDiciembre = 0;
        $intAcumPresupuestoAnual = 0;

        
        //Variables que se utilizan para asignar los acumulados de importes reales
        $intAcumRealEnero = 0;
        $intAcumRealFebrero = 0;
        $intAcumRealMarzo = 0;
        $intAcumRealAbril = 0;
        $intAcumRealMayo = 0;
        $intAcumRealJunio = 0;
        $intAcumRealJulio = 0;
        $intAcumRealAgosto = 0;
        $intAcumRealSeptiembre = 0;
        $intAcumRealOctubre = 0;
        $intAcumRealNoviembre = 0;
        $intAcumRealDiciembre = 0;
        $intAcumRealAnual = 0;


        //Verificar si existe información
        if($otdResultado)
        {
            //Recorremos el arreglo 
            foreach ($otdResultado as $arrCol) 
            {
                //Variable para acumular el presupuesto total anual
                $intPresupuestoAnual = 0; 
                //Variable para acumular el importe total real anual
                $intRealAnual = 0; 

                //Variables que se utilizan para asignar valores de los presupuestos mensuales
                //Enero
                $intPresupuestoEnero = $arrCol->PresupuestoEnero;
                $intRealEnero = $arrCol->RealEnero;
                //Febrero
                $intPresupuestoFebrero = $arrCol->PresupuestoFebrero;
                $intRealFebrero = $arrCol->RealFebrero;
                //Marzo
                $intPresupuestoMarzo = $arrCol->PresupuestoMarzo;
                $intRealMarzo = $arrCol->RealMarzo;
                //Abril
                $intPresupuestoAbril = $arrCol->PresupuestoAbril;
                $intRealAbril = $arrCol->RealAbril;
                //Mayo
                $intPresupuestoMayo = $arrCol->PresupuestoMayo;
                $intRealMayo = $arrCol->RealMayo;
                //Junio
                $intPresupuestoJunio = $arrCol->PresupuestoJunio;
                $intRealJunio = $arrCol->RealJunio;
                //Julio
                $intPresupuestoJulio = $arrCol->PresupuestoJulio;
                $intRealJulio = $arrCol->RealJulio;
                //Agosto
                $intPresupuestoAgosto = $arrCol->PresupuestoAgosto;
                $intRealAgosto = $arrCol->RealAgosto;
                //Septiembre
                $intPresupuestoSeptiembre = $arrCol->PresupuestoSeptiembre;
                $intRealSeptiembre = $arrCol->RealSeptiembre;
                //Octubre
                $intPresupuestoOctubre = $arrCol->PresupuestoOctubre;
                $intRealOctubre = $arrCol->RealOctubre;
                //Noviembre
                $intPresupuestoNoviembre = $arrCol->PresupuestoNoviembre;
                $intRealNoviembre = $arrCol->RealNoviembre;
                //Diciembre
                $intPresupuestoDiciembre = $arrCol->PresupuestoDiciembre;
                $intRealDiciembre = $arrCol->RealDiciembre;


                //Definir valores del array auxiliar de información (para cada mecánico)
                $arrAuxiliar["cuenta"] = $arrCol->cuenta.' '.$arrCol->descripcion;
                 /*
                 * Presupuestos del mes de Enero
                 */
                $arrAuxiliar["presupuesto_enero"] = $intPresupuestoEnero;
                $arrAuxiliar["real_enero"] = $intRealEnero;
                //Calcular diferencia de importes
                $arrAuxiliar["diferencia_importeEnero"] = $intRealEnero - $intPresupuestoEnero;
                //Calcular porcentaje de cumplimiento de importes
                $arrAuxiliar["cumplimiento_importeEnero"] = $this->get_cumplimiento_ppto($intPresupuestoEnero, 
                                                                                         $intRealEnero);
               

                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoEnero;
                //Incrementar importe real anual
                $intRealAnual += $intRealEnero;

                //Incrementar acumulados del mes
                $intAcumPresupuestoEnero += $intPresupuestoEnero;
                $intAcumRealEnero += $intRealEnero;

                 /*
                 * Presupuestos del mes de Febrero
                 */
                $arrAuxiliar["presupuesto_febrero"] = $intPresupuestoFebrero;
                $arrAuxiliar["real_febrero"] = $intRealFebrero;
                //Calcular diferencia de importes
                $arrAuxiliar["diferencia_importeFebrero"] = $intRealFebrero - $intPresupuestoFebrero;
                //Calcular porcentaje de cumplimiento de importes
                $arrAuxiliar["cumplimiento_importeFebrero"] = $this->get_cumplimiento_ppto($intPresupuestoFebrero, 
                                                                                           $intRealFebrero);
             
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoFebrero;
                //Incrementar importe real anual
                $intRealAnual += $intRealFebrero;

                //Incrementar acumulados del mes
                $intAcumPresupuestoFebrero += $intPresupuestoFebrero;
                $intAcumRealFebrero += $intRealFebrero;

                /*
                 * Presupuestos del mes de Marzo
                 */
                $arrAuxiliar["presupuesto_marzo"] = $intPresupuestoMarzo;
                $arrAuxiliar["real_marzo"] = $intRealMarzo;
                //Calcular diferencia de importes
                $arrAuxiliar["diferencia_importeMarzo"] = $intRealMarzo - $intPresupuestoMarzo;
                //Calcular porcentaje de cumplimiento de importes
                $arrAuxiliar["cumplimiento_importeMarzo"] = $this->get_cumplimiento_ppto($intPresupuestoMarzo,  
                                                                                         $intRealMarzo);
               
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoMarzo;
                //Incrementar importe real anual
                $intRealAnual += $intRealMarzo;

                //Incrementar acumulados del mes
                $intAcumPresupuestoMarzo += $intPresupuestoMarzo;
                $intAcumRealMarzo += $intRealMarzo;


                /*
                * Presupuestos del mes de Abril
                */
                $arrAuxiliar["presupuesto_abril"] = $intPresupuestoAbril;
                $arrAuxiliar["real_abril"] = $intRealAbril;
                //Calcular diferencia de importes
                $arrAuxiliar["diferencia_importeAbril"] = $intRealAbril - $intPresupuestoAbril;
                //Calcular porcentaje de cumplimiento de importes
                $arrAuxiliar["cumplimiento_importeAbril"] = $this->get_cumplimiento_ppto($intPresupuestoAbril, 
                                                                                         $intRealAbril);
              
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoAbril;
                //Incrementar importe real anual
                $intRealAnual += $intRealAbril;

                //Incrementar acumulados del mes
                $intAcumPresupuestoAbril += $intPresupuestoAbril;
                $intAcumRealAbril += $intRealAbril;


                /*
                * Presupuestos del mes de Mayo
                */
                $arrAuxiliar["presupuesto_mayo"] = $intPresupuestoMayo;
                $arrAuxiliar["real_mayo"] = $intRealMayo;
                //Calcular diferencia de importes
                $arrAuxiliar["diferencia_importeMayo"] = $intRealMayo - $intPresupuestoMayo;
                //Calcular porcentaje de cumplimiento de importes
                $arrAuxiliar["cumplimiento_importeMayo"] = $this->get_cumplimiento_ppto($intPresupuestoMayo, 
                                                                                        $intRealMayo);
             
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoMayo;
                //Incrementar importe real anual
                $intRealAnual += $intRealMayo;

                //Incrementar acumulados del mes
                $intAcumPresupuestoMayo += $intPresupuestoMayo;
                $intAcumRealMayo += $intRealMayo;


                /*
                * Presupuestos del mes de Junio
                */
                $arrAuxiliar["presupuesto_junio"] = $intPresupuestoJunio;
                $arrAuxiliar["real_junio"] = $intRealJunio;
                //Calcular diferencia de importes
                $arrAuxiliar["diferencia_importeJunio"] = $intRealJunio - $intPresupuestoJunio;
                //Calcular porcentaje de cumplimiento de importes
                $arrAuxiliar["cumplimiento_importeJunio"] = $this->get_cumplimiento_ppto($intPresupuestoJunio, 
                                                                                         $intRealJunio);
              
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoJunio;
                //Incrementar importe real anual
                $intRealAnual += $intRealJunio;

                //Incrementar acumulados del mes
                $intAcumPresupuestoJunio += $intPresupuestoJunio;
                $intAcumRealJunio += $intRealJunio;


                /*
                * Presupuestos del mes de Julio
                */
                $arrAuxiliar["presupuesto_julio"] = $intPresupuestoJulio;
                $arrAuxiliar["real_julio"] = $intRealJulio;
                //Calcular diferencia de importes
                $arrAuxiliar["diferencia_importeJulio"] = $intRealJulio - $intPresupuestoJulio;
                //Calcular porcentaje de cumplimiento de importes
                $arrAuxiliar["cumplimiento_importeJulio"] = $this->get_cumplimiento_ppto($intPresupuestoJulio, 
                                                                                         $intRealJulio);
               
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoJulio;
                //Incrementar importe real anual
                $intRealAnual += $intRealJulio;

                //Incrementar acumulados del mes
                $intAcumPresupuestoJulio += $intPresupuestoJulio;
                $intAcumRealJulio += $intRealJulio;


                /*
                * Presupuestos del mes de Agosto
                */
                $arrAuxiliar["presupuesto_agosto"] = $intPresupuestoAgosto;
                $arrAuxiliar["real_agosto"] = $intRealAgosto;
                //Calcular diferencia de importes
                $arrAuxiliar["diferencia_importeAgosto"] = $intRealAgosto - $intPresupuestoAgosto;
                //Calcular porcentaje de cumplimiento de importes
                $arrAuxiliar["cumplimiento_importeAgosto"] = $this->get_cumplimiento_ppto($intPresupuestoAgosto, 
                                                                                          $intRealAgosto);
               
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoAgosto;
                //Incrementar importe real anual
                $intRealAnual += $intRealAgosto;

                //Incrementar acumulados del mes
                $intAcumPresupuestoAgosto += $intPresupuestoAgosto;
                $intAcumRealAgosto += $intRealAgosto;


               /*
                * Presupuestos del mes de Septiembre
                */
                $arrAuxiliar["presupuesto_septiembre"] = $intPresupuestoSeptiembre;
                $arrAuxiliar["real_septiembre"] = $intRealSeptiembre;
                //Calcular diferencia de importes
                $arrAuxiliar["diferencia_importeSeptiembre"] = $intRealSeptiembre - $intPresupuestoSeptiembre;
                //Calcular porcentaje de cumplimiento de importes
                $arrAuxiliar["cumplimiento_importeSeptiembre"] = $this->get_cumplimiento_ppto($intPresupuestoSeptiembre, 
                                                                                              $intRealSeptiembre);
             
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoSeptiembre;
                //Incrementar importe real anual
                $intRealAnual += $intRealSeptiembre;

                //Incrementar acumulados del mes
                $intAcumPresupuestoSeptiembre += $intPresupuestoSeptiembre;
                $intAcumRealSeptiembre += $intRealSeptiembre;


               /*
                * Presupuestos del mes de Octubre
                */
                $arrAuxiliar["presupuesto_octubre"] = $intPresupuestoOctubre;
                $arrAuxiliar["real_octubre"] = $intRealOctubre;
                //Calcular diferencia de importes
                $arrAuxiliar["diferencia_importeOctubre"] = $intRealOctubre - $intPresupuestoOctubre;
                //Calcular porcentaje de cumplimiento de importes
                $arrAuxiliar["cumplimiento_importeOctubre"] = $this->get_cumplimiento_ppto($intPresupuestoOctubre, 
                                                                                           $intRealOctubre);
              
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoOctubre;
                //Incrementar importe real anual
                $intRealAnual += $intRealOctubre;

                //Incrementar acumulados del mes
                $intAcumPresupuestoOctubre += $intPresupuestoOctubre;
                $intAcumRealOctubre += $intRealOctubre;


                /*
                * Presupuestos del mes de Noviembre
                */
                $arrAuxiliar["presupuesto_noviembre"] = $intPresupuestoNoviembre;
                $arrAuxiliar["real_noviembre"] = $intRealNoviembre;
                //Calcular diferencia de importes
                $arrAuxiliar["diferencia_importeNoviembre"] = $intRealNoviembre - $intPresupuestoNoviembre;
                //Calcular porcentaje de cumplimiento de importes
                $arrAuxiliar["cumplimiento_importeNoviembre"] = $this->get_cumplimiento_ppto($intPresupuestoNoviembre, 
                                                                                             $intRealNoviembre);
              
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoNoviembre;
                //Incrementar importe real anual
                $intRealAnual += $intRealNoviembre;

                //Incrementar acumulados del mes
                $intAcumPresupuestoNoviembre += $intPresupuestoNoviembre;
                $intAcumRealNoviembre += $intRealNoviembre;


                /*
                * Presupuestos del mes de Diciembre
                */
                $arrAuxiliar["presupuesto_diciembre"] = $intPresupuestoDiciembre;
                $arrAuxiliar["real_diciembre"] = $intRealDiciembre;
                //Calcular diferencia de importes
                $arrAuxiliar["diferencia_importeDiciembre"] = $intRealDiciembre - $intPresupuestoDiciembre;
                //Calcular porcentaje de cumplimiento de importes
                $arrAuxiliar["cumplimiento_importeDiciembre"] = $this->get_cumplimiento_ppto($intPresupuestoDiciembre, 
                                                                                             $intRealDiciembre);
               
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoDiciembre;
                //Incrementar importe real anual
                $intRealAnual += $intRealDiciembre;

                //Incrementar acumulados del mes
                $intAcumPresupuestoDiciembre += $intPresupuestoDiciembre;
                $intAcumRealDiciembre += $intRealDiciembre;


                //Anual
                $arrAuxiliar["presupuesto_anual"] = $intPresupuestoAnual;
                $arrAuxiliar["real_anual"] = $intRealAnual;
                //Calcular diferencia de importes
                $arrAuxiliar["diferencia_importeAnual"] = $intRealAnual - $intPresupuestoAnual;
                //Calcular porcentaje de cumplimiento de importes
                $arrAuxiliar["cumplimiento_importeAnual"] = $this->get_cumplimiento_ppto($intPresupuestoAnual, 
                                                                                         $intRealAnual);
             
                //Incrementar acumulados del año
                $intAcumPresupuestoAnual += $intPresupuestoAnual;
                $intAcumRealAnual += $intRealAnual;

                //Asignar datos al array
                array_push($arrCuentas, $arrAuxiliar); 

            }//Cierre de foreach


            //------------------------------------------------------------------------------------------------------------------------
            //---------- ACUMULADOS
            //------------------------------------------------------------------------------------------------------------------------
            //Inicializar array auxiliar
            $arrAuxiliar = array();
            //Agregar datos al array
            //Definir valores del array auxiliar de información (para los acumulados)
            /*
            * Acumulados del mes de Enero
            */
            $arrAuxiliar["presupuesto_enero"] = $intAcumPresupuestoEnero;
            $arrAuxiliar["real_enero"] = $intAcumRealEnero;
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia_importeEnero"] = $intAcumRealEnero - $intAcumPresupuestoEnero;
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento_importeEnero"] = $this->get_cumplimiento_ppto($intAcumPresupuestoEnero, 
                                                                                     $intAcumRealEnero);
           
            
            /*
            * Acumulados del mes de Febrero
            */
            $arrAuxiliar["presupuesto_febrero"] = $intAcumPresupuestoFebrero;
            $arrAuxiliar["real_febrero"] = $intAcumRealFebrero;
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia_importeFebrero"] = $intAcumRealFebrero - $intAcumPresupuestoFebrero;
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento_importeFebrero"] = $this->get_cumplimiento_ppto($intAcumPresupuestoFebrero, 
                                                                                       $intAcumRealFebrero);
           
           
            /*
            * Acumulados del mes de Marzo
            */
            $arrAuxiliar["presupuesto_marzo"] = $intAcumPresupuestoMarzo;
            $arrAuxiliar["real_marzo"] = $intAcumRealMarzo;
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia_importeMarzo"] = $intAcumRealMarzo - $intAcumPresupuestoMarzo;
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento_importeMarzo"] = $this->get_cumplimiento_ppto($intAcumPresupuestoMarzo, 
                                                                                     $intAcumRealMarzo);
          
            
            
            /*
            * Acumulados del mes de Abril
            */
            $arrAuxiliar["presupuesto_abril"] = $intAcumPresupuestoAbril;
            $arrAuxiliar["real_abril"] = $intAcumRealAbril;
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia_importeAbril"] = $intAcumRealAbril - $intAcumPresupuestoAbril;
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento_importeAbril"] = $this->get_cumplimiento_ppto($intAcumPresupuestoAbril, 
                                                                                     $intAcumRealAbril);
           

            /*
            * Acumulados del mes de Mayo
            */
            $arrAuxiliar["presupuesto_mayo"] = $intAcumPresupuestoMayo;
            $arrAuxiliar["real_mayo"] = $intAcumRealMayo;
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia_importeMayo"] = $intAcumRealMayo - $intAcumPresupuestoMayo;
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento_importeMayo"] = $this->get_cumplimiento_ppto($intAcumPresupuestoMayo, 
                                                                                    $intAcumRealMayo);
           

            /*
            * Acumulados del mes de Junio
            */
            $arrAuxiliar["presupuesto_junio"] = $intAcumPresupuestoJunio;
            $arrAuxiliar["real_junio"] = $intAcumRealJunio;
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia_importeJunio"] = $intAcumRealJunio - $intAcumPresupuestoJunio;
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento_importeJunio"] = $this->get_cumplimiento_ppto($intAcumPresupuestoJunio, 
                                                                                     $intAcumRealJunio);
          

            /*
            * Acumulados del mes de Julio
            */
            $arrAuxiliar["presupuesto_julio"] = $intAcumPresupuestoJulio;
            $arrAuxiliar["real_julio"] = $intAcumRealJulio;
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia_importeJulio"] = $intAcumRealJulio - $intAcumPresupuestoJulio;
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento_importeJulio"] = $this->get_cumplimiento_ppto($intAcumPresupuestoJulio, 
                                                                                     $intAcumRealJulio);
           

            /*
            * Acumulados del mes de Agosto
            */
            $arrAuxiliar["presupuesto_agosto"] = $intAcumPresupuestoAgosto;
            $arrAuxiliar["real_agosto"] = $intAcumRealAgosto;
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia_importeAgosto"] = $intAcumRealAgosto - $intAcumPresupuestoAgosto;
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento_importeAgosto"] = $this->get_cumplimiento_ppto($intAcumPresupuestoAgosto, 
                                                                                      $intAcumRealAgosto);
           

            /*
            * Acumulados del mes de Septiembre
            */
            $arrAuxiliar["presupuesto_septiembre"] = $intAcumPresupuestoSeptiembre;
            $arrAuxiliar["real_septiembre"] = $intAcumRealSeptiembre;
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia_importeSeptiembre"] = $intAcumRealSeptiembre - $intAcumPresupuestoSeptiembre;
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento_importeSeptiembre"] = $this->get_cumplimiento_ppto($intAcumPresupuestoSeptiembre, 
                                                                                          $intAcumRealSeptiembre);
          
            

            /*
            * Acumulados del mes de Octubre
            */
            $arrAuxiliar["presupuesto_octubre"] = $intAcumPresupuestoOctubre;
            $arrAuxiliar["real_octubre"] = $intAcumRealOctubre;
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia_importeOctubre"] = $intAcumRealOctubre - $intAcumPresupuestoOctubre;
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento_importeOctubre"] = $this->get_cumplimiento_ppto($intAcumPresupuestoOctubre, 
                                                                                  $intAcumRealOctubre);
         

            /*
            * Acumulados del mes de Noviembre
            */
            $arrAuxiliar["presupuesto_noviembre"] = $intAcumPresupuestoNoviembre;
            $arrAuxiliar["real_noviembre"] = $intAcumRealNoviembre;
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia_importeNoviembre"] = $intAcumRealNoviembre - $intAcumPresupuestoNoviembre;
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento_importeNoviembre"] = $this->get_cumplimiento_ppto($intAcumPresupuestoNoviembre, 
                                                                                    $intAcumRealNoviembre);
         

            /*
            * Acumulados del mes de Diciembre
            */
            $arrAuxiliar["presupuesto_diciembre"] = $intAcumPresupuestoDiciembre;
            $arrAuxiliar["real_diciembre"] = $intAcumRealDiciembre;
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia_importeDiciembre"] = $intAcumRealDiciembre - $intAcumPresupuestoDiciembre;
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento_importeDiciembre"] = $this->get_cumplimiento_ppto($intAcumPresupuestoDiciembre, 
                                                                                    $intAcumRealDiciembre);
           

            /*
             * Acumulados del año
            */
            $arrAuxiliar["presupuesto_anual"] = $intAcumPresupuestoAnual;
            $arrAuxiliar["real_anual"] = $intAcumRealAnual;
            //Calcular diferencia de importes
            $arrAuxiliar["diferencia_importeAnual"] = $intAcumRealAnual - $intAcumPresupuestoAnual;
            //Calcular porcentaje de cumplimiento de importes
            $arrAuxiliar["cumplimiento_importeAnual"] = $this->get_cumplimiento_ppto($intAcumPresupuestoAnual, 
                                                                                $intAcumRealAnual);
            

            //Asignar datos al array
            array_push($arrAcumulados, $arrAuxiliar); 

            //Agregar datos a los array's
            $arrDatos['cuentas'] = $arrCuentas;
            $arrDatos['acumulados'] = $arrAcumulados;

        }//Cierre de verificación de información


        //Regresar array con los datos de los presupuestos
        return $arrDatos;
    }

	
}