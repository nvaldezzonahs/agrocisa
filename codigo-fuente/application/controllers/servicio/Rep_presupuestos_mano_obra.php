<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_presupuestos_mano_obra extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
        //Cargar el helper del reporte
        $this->load->helper('hlpfpdf');
		    //Cargamos el modelo
        $this->load->model('servicio/servicio_presupuestos_mano_obra_model', 'presupuestos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('servicio/rep_presupuestos_mano_obra', $arrDatos);
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
        $arrMecanicos = array();
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
        $pdf->arrCabecera = array(utf8_decode('MECÁNICO'), 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 
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
        $arrAnchuraMecanico = array(335);
        //Establece la alineación de la celda mecánico
        $arrAlineacionMecanico = array('L');

        //Asignar el valor de la descripción (título de la lista de registros) del reporte
        $pdf->strLinea1 =  utf8_decode('LISTADO DE PRESUPUESTOS DE MANO DE OBRA DEL AÑO ').$strAnio;

        //Agregar la primer pagina
        $pdf->AddPage();
       

        //Asignar objeto con los presupuestos de los mecánicos en el año
        $otdPresupuestos = $this->get_presupuestos($strAnio);  
        //Asignar array con los datos de los mecánicos
        $arrMecanicos = $otdPresupuestos['mecanicos']; 
         //Asignar array con los acumulados
        $arrAcumulados = $otdPresupuestos['acumulados'];  

        //Si hay información de los mecánicos
        if($arrMecanicos)
        {
            //Recorremos el arreglo 
            foreach ($arrMecanicos as $arrDet) 
            {
                //Establece el ancho de las columnas
                $pdf->SetWidths($arrAnchuraMecanico);
                //Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
                $pdf->Row(array(utf8_decode($arrDet['mecanico'])), $arrAlineacionMecanico, 'ClippedCell');


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
                

                //DIFERENCIA EN IMPORTE
                $pdf->Row(array('DIF. IMPT.|Negrita',
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

                //% CUMPLIMIENTO EN IMPORTE
                $pdf->Row(array('% CUMP.|Negrita',
                                number_format($arrDet['cumplimiento_importeEnero'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_importeFebrero'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_importeMarzo'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_importeAbril'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_importeMayo'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_importeJunio'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_importeJulio'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_importeAgosto'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_importeSeptiembre'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_importeOctubre'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_importeNoviembre'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_importeDiciembre'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_importeAnual'], 2, '.', '')), 
                            $pdf->arrAlineacion, 'ClippedCell');

                //HORAS PRESUPUESTADO
                $pdf->Row(array('HRAS PPTO.|Negrita',
                               number_format($arrDet['horas_enero'], 2, '.', ''),
                               number_format($arrDet['horas_febrero'], 2, '.', ''),
                               number_format($arrDet['horas_marzo'], 2, '.', ''),
                               number_format($arrDet['horas_abril'], 2, '.', ''),
                               number_format($arrDet['horas_mayo'], 2, '.', ''),
                               number_format($arrDet['horas_junio'], 2, '.', ''),
                               number_format($arrDet['horas_julio'], 2, '.', ''),
                               number_format($arrDet['horas_agosto'], 2, '.', ''),
                               number_format( $arrDet['horas_septiembre'], 2, '.', ''),
                               number_format($arrDet['horas_octubre'], 2, '.', ''),
                               number_format($arrDet['horas_noviembre'], 2, '.', ''),
                               number_format($arrDet['horas_diciembre'], 2, '.', ''),
                               number_format($arrDet['horas_anual'], 2, '.', '')), 
                            $pdf->arrAlineacion, 'ClippedCell');

                //HORAS REAL
                $pdf->Row(array('HRAS REAL|Negrita',
                                number_format($arrDet['real_horasEnero'], 2, '.', ''),
                                number_format($arrDet['real_horasFebrero'], 2, '.', ''),
                                number_format($arrDet['real_horasMarzo'], 2, '.', ''),
                                number_format($arrDet['real_horasAbril'], 2, '.', ''),
                                number_format($arrDet['real_horasMayo'], 2, '.', ''),
                                number_format($arrDet['real_horasJunio'], 2, '.', ''),
                                number_format($arrDet['real_horasJulio'], 2, '.', ''),
                                number_format($arrDet['real_horasAgosto'], 2, '.', ''),
                                number_format($arrDet['real_horasSeptiembre'], 2, '.', ''),
                                number_format($arrDet['real_horasOctubre'], 2, '.', ''),
                                number_format($arrDet['real_horasNoviembre'], 2, '.', ''),
                                number_format($arrDet['real_horasDiciembre'], 2, '.', ''),
                                number_format($arrDet['real_horasAnual'], 2, '.', '')), 
                            $pdf->arrAlineacion, 'ClippedCell');

                //DIFERENCIA EN HORAS
                $pdf->Row(array('DIF. HRAS|Negrita',
                                number_format($arrDet['diferencia_horasEnero'], 2, '.', '').'|VerificarNumero',
                                number_format($arrDet['diferencia_horasFebrero'], 2, '.', '').'|VerificarNumero',
                                number_format($arrDet['diferencia_horasMarzo'], 2, '.', '').'|VerificarNumero',
                                number_format($arrDet['diferencia_horasAbril'], 2, '.', '').'|VerificarNumero',
                                number_format($arrDet['diferencia_horasMayo'], 2, '.', '').'|VerificarNumero',
                                number_format($arrDet['diferencia_horasJunio'], 2, '.', '').'|VerificarNumero',
                                number_format($arrDet['diferencia_horasJulio'], 2, '.', '').'|VerificarNumero',
                                number_format($arrDet['diferencia_horasAgosto'], 2, '.', '').'|VerificarNumero',
                                number_format( $arrDet['diferencia_horasSeptiembre'], 2, '.', '').'|VerificarNumero',
                                number_format($arrDet['diferencia_horasOctubre'], 2, '.', '').'|VerificarNumero',
                                number_format($arrDet['diferencia_horasNoviembre'], 2, '.', '').'|VerificarNumero',
                                number_format($arrDet['diferencia_horasDiciembre'], 2, '.', '').'|VerificarNumero',
                                number_format($arrDet['diferencia_horasAnual'], 2, '.', '').'|VerificarNumero'), 
                            $pdf->arrAlineacion, 'ClippedCell');

                //% CUMPLIMIENTO EN HORAS
                $pdf->Row(array('% CUMP.|Negrita',
                                number_format($arrDet['cumplimiento_horasEnero'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_horasFebrero'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_horasMarzo'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_horasAbril'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_horasMayo'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_horasJunio'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_horasJulio'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_horasAgosto'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_horasSeptiembre'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_horasOctubre'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_horasNoviembre'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_horasDiciembre'], 2, '.', ''),
                                number_format($arrDet['cumplimiento_horasAnual'], 2, '.', '')), 
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
             
             //DIFERENCIA EN IMPORTE
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

             //% CUMPLIMIENTO EN IMPORTE
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

             //HORAS PRESUPUESTADO
             $pdf->Row(array('HRAS PPTO.|Negrita',
                            number_format($arrAcumulados[0]['horas_enero'], 2, '.', ''),
                            number_format($arrAcumulados[0]['horas_febrero'], 2, '.', ''),
                            number_format($arrAcumulados[0]['horas_marzo'], 2, '.', ''),
                            number_format($arrAcumulados[0]['horas_abril'], 2, '.', ''),
                            number_format($arrAcumulados[0]['horas_mayo'], 2, '.', ''),
                            number_format($arrAcumulados[0]['horas_junio'], 2, '.', ''),
                            number_format($arrAcumulados[0]['horas_julio'], 2, '.', ''),
                            number_format($arrAcumulados[0]['horas_agosto'], 2, '.', ''),
                            number_format($arrAcumulados[0]['horas_septiembre'], 2, '.', ''),
                            number_format($arrAcumulados[0]['horas_octubre'], 2, '.', ''),
                            number_format($arrAcumulados[0]['horas_noviembre'], 2, '.', ''),
                            number_format($arrAcumulados[0]['horas_diciembre'], 2, '.', ''),
                            number_format($arrAcumulados[0]['horas_anual'], 2, '.', '')), 
                     $pdf->arrAlineacion, 'ClippedCell');

             //HORAS REAL
             $pdf->Row(array('HRAS REAL|Negrita',
                             number_format($arrAcumulados[0]['real_horasEnero'], 2, '.', ''),
                             number_format($arrAcumulados[0]['real_horasFebrero'], 2, '.', ''),
                             number_format($arrAcumulados[0]['real_horasMarzo'], 2, '.', ''),
                             number_format($arrAcumulados[0]['real_horasAbril'], 2, '.', ''),
                             number_format($arrAcumulados[0]['real_horasMayo'], 2, '.', ''),
                             number_format($arrAcumulados[0]['real_horasJunio'], 2, '.', ''),
                             number_format($arrAcumulados[0]['real_horasJulio'], 2, '.', ''),
                             number_format($arrAcumulados[0]['real_horasAgosto'], 2, '.', ''),
                             number_format($arrAcumulados[0]['real_horasSeptiembre'], 2, '.', ''),
                             number_format($arrAcumulados[0]['real_horasOctubre'], 2, '.', ''),
                             number_format($arrAcumulados[0]['real_horasNoviembre'], 2, '.', ''),
                             number_format($arrAcumulados[0]['real_horasDiciembre'], 2, '.', ''),
                             number_format($arrAcumulados[0]['real_horasAnual'], 2, '.', '')), 
                       $pdf->arrAlineacion, 'ClippedCell');

             //DIFERENCIA EN HORAS
             $pdf->Row(array('DIF. HRAS|Negrita',
                             number_format($arrAcumulados[0]['diferencia_horasEnero'], 2, '.', '').'|VerificarNumero',
                             number_format($arrAcumulados[0]['diferencia_horasFebrero'], 2, '.', '').'|VerificarNumero',
                             number_format($arrAcumulados[0]['diferencia_horasMarzo'], 2, '.', '').'|VerificarNumero',
                             number_format($arrAcumulados[0]['diferencia_horasAbril'], 2, '.', '').'|VerificarNumero',
                             number_format($arrAcumulados[0]['diferencia_horasMayo'], 2, '.', '').'|VerificarNumero',
                             number_format($arrAcumulados[0]['diferencia_horasJunio'], 2, '.', '').'|VerificarNumero',
                             number_format($arrAcumulados[0]['diferencia_horasJulio'], 2, '.', '').'|VerificarNumero',
                             number_format($arrAcumulados[0]['diferencia_horasAgosto'], 2, '.', '').'|VerificarNumero',
                            number_format($arrAcumulados[0]['diferencia_horasSeptiembre'], 2, '.', '').'|VerificarNumero',
                             number_format($arrAcumulados[0]['diferencia_horasOctubre'], 2, '.', '').'|VerificarNumero',
                             number_format($arrAcumulados[0]['diferencia_horasNoviembre'], 2, '.', '').'|VerificarNumero',
                             number_format($arrAcumulados[0]['diferencia_horasDiciembre'], 2, '.', '').'|VerificarNumero',
                             number_format($arrAcumulados[0]['diferencia_horasAnual'], 2, '.', '').'|VerificarNumero'), 
                     $pdf->arrAlineacion, 'ClippedCell');

             //% CUMPLIMIENTO EN HORAS
             $pdf->Row(array('% CUMP.|Negrita',
                             number_format($arrAcumulados[0]['cumplimiento_horasEnero'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_horasFebrero'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_horasMarzo'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_horasAbril'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_horasMayo'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_horasJunio'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_horasJulio'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_horasAgosto'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_horasSeptiembre'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_horasOctubre'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_horasNoviembre'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_horasDiciembre'], 2),
                             number_format($arrAcumulados[0]['cumplimiento_horasAnual'], 2)), 
                      $pdf->arrAlineacion, 'ClippedCell');

        }//Cierre de verificación de información

        //Ejecutar la salida del reporte
        $pdf->Output('presupuestos_mano_obra.pdf','I'); 
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
        $arrMecanicos = array();
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
                 ->setCellValue('A7', 'LISTADO DE PRESUPUESTOS DE MANO DE OBRA DEL AÑO '.$strAnio);

        //Se agregan las columnas de la primer cabecera
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('B'.$intPosEncabezados, 'ENERO')
                 ->setCellValue('J'.$intPosEncabezados, 'FEBRERO')
                 ->setCellValue('R'.$intPosEncabezados, 'MARZO')
                 ->setCellValue('Z'.$intPosEncabezados, 'ABRIL')
                 ->setCellValue('AH'.$intPosEncabezados, 'MAYO')
                 ->setCellValue('AP'.$intPosEncabezados, 'JUNIO')
                 ->setCellValue('AX'.$intPosEncabezados, 'JULIO')
                 ->setCellValue('BF'.$intPosEncabezados, 'AGOSTO')
                 ->setCellValue('BN'.$intPosEncabezados, 'SEPTIEMBRE')
                 ->setCellValue('BV'.$intPosEncabezados, 'OCTUBRE')
                 ->setCellValue('CD'.$intPosEncabezados, 'NOVIEMBRE')
                 ->setCellValue('CL'.$intPosEncabezados, 'DICIEMBRE')
                 ->setCellValue('CT'.$intPosEncabezados, 'ANUAL');

        //Incrementar los indices para escribir las columnas de la cabecera 2
        $intPosEncabezados++;
        //Se agregan las columnas de la segunda cabecera
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$intPosEncabezados, 'MECÁNICO')
                 //Presupuestos del mes de Enero
                 ->setCellValue('B'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('C'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('D'.$intPosEncabezados, 'DIFERENCIA EN IMPORTE')
                 ->setCellValue('E'.$intPosEncabezados, '% CUMPLIMIENTO EN IMPORTE')
                 ->setCellValue('F'.$intPosEncabezados, 'HORAS PRESUPUESTADO')
                 ->setCellValue('G'.$intPosEncabezados, 'HORAS REAL')
                 ->setCellValue('H'.$intPosEncabezados, 'DIFERENCIA EN HORAS')
                 ->setCellValue('I'.$intPosEncabezados, '% CUMPLIMIENTO EN HORAS')
                 //Presupuestos del mes de Febrero
                 ->setCellValue('J'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('K'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('L'.$intPosEncabezados, 'DIFERENCIA EN IMPORTE')
                 ->setCellValue('M'.$intPosEncabezados, '% CUMPLIMIENTO EN IMPORTE')
                 ->setCellValue('N'.$intPosEncabezados, 'HORAS PRESUPUESTADO')
                 ->setCellValue('O'.$intPosEncabezados, 'HORAS REAL')
                 ->setCellValue('P'.$intPosEncabezados, 'DIFERENCIA EN HORAS')
                 ->setCellValue('Q'.$intPosEncabezados, '% CUMPLIMIENTO EN HORAS')
                 //Presupuestos del mes de Marzo
                 ->setCellValue('R'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('S'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('T'.$intPosEncabezados, 'DIFERENCIA EN IMPORTE')
                 ->setCellValue('U'.$intPosEncabezados, '% CUMPLIMIENTO EN IMPORTE')
                 ->setCellValue('V'.$intPosEncabezados, 'HORAS PRESUPUESTADO')
                 ->setCellValue('W'.$intPosEncabezados, 'HORAS REAL')
                 ->setCellValue('X'.$intPosEncabezados, 'DIFERENCIA EN HORAS')
                 ->setCellValue('Y'.$intPosEncabezados, '% CUMPLIMIENTO EN HORAS')
                 //Presupuestos del mes de Abril
                 ->setCellValue('Z'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('AA'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('AB'.$intPosEncabezados, 'DIFERENCIA EN IMPORTE')
                 ->setCellValue('AC'.$intPosEncabezados, '% CUMPLIMIENTO EN IMPORTE')
                 ->setCellValue('AD'.$intPosEncabezados, 'HORAS PRESUPUESTADO')
                 ->setCellValue('AE'.$intPosEncabezados, 'HORAS REAL')
                 ->setCellValue('AF'.$intPosEncabezados, 'DIFERENCIA EN HORAS')
                 ->setCellValue('AG'.$intPosEncabezados, '% CUMPLIMIENTO EN HORAS')
                  //Presupuestos del mes de Mayo
                 ->setCellValue('AH'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('AI'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('AJ'.$intPosEncabezados, 'DIFERENCIA EN IMPORTE')
                 ->setCellValue('AK'.$intPosEncabezados, '% CUMPLIMIENTO EN IMPORTE')
                 ->setCellValue('AL'.$intPosEncabezados, 'HORAS PRESUPUESTADO')
                 ->setCellValue('AM'.$intPosEncabezados, 'HORAS REAL')
                 ->setCellValue('AN'.$intPosEncabezados, 'DIFERENCIA EN HORAS')
                 ->setCellValue('AO'.$intPosEncabezados, '% CUMPLIMIENTO EN HORAS')
                 //Presupuestos del mes de Junio
                 ->setCellValue('AP'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('AQ'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('AR'.$intPosEncabezados, 'DIFERENCIA EN IMPORTE')
                 ->setCellValue('AS'.$intPosEncabezados, '% CUMPLIMIENTO EN IMPORTE')
                 ->setCellValue('AT'.$intPosEncabezados, 'HORAS PRESUPUESTADO')
                 ->setCellValue('AU'.$intPosEncabezados, 'HORAS REAL')
                 ->setCellValue('AV'.$intPosEncabezados, 'DIFERENCIA EN HORAS')
                 ->setCellValue('AW'.$intPosEncabezados, '% CUMPLIMIENTO EN HORAS')
                 //Presupuestos del mes de Julio
                 ->setCellValue('AX'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('AY'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('AZ'.$intPosEncabezados, 'DIFERENCIA EN IMPORTE')
                 ->setCellValue('BA'.$intPosEncabezados, '% CUMPLIMIENTO EN IMPORTE')
                 ->setCellValue('BB'.$intPosEncabezados, 'HORAS PRESUPUESTADO')
                 ->setCellValue('BC'.$intPosEncabezados, 'HORAS REAL')
                 ->setCellValue('BD'.$intPosEncabezados, 'DIFERENCIA EN HORAS')
                 ->setCellValue('BE'.$intPosEncabezados, '% CUMPLIMIENTO EN HORAS')
                 //Presupuestos del mes de Agosto
                 ->setCellValue('BF'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('BG'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('BH'.$intPosEncabezados, 'DIFERENCIA EN IMPORTE')
                 ->setCellValue('BI'.$intPosEncabezados, '% CUMPLIMIENTO EN IMPORTE')
                 ->setCellValue('BJ'.$intPosEncabezados, 'HORAS PRESUPUESTADO')
                 ->setCellValue('BK'.$intPosEncabezados, 'HORAS REAL')
                 ->setCellValue('BL'.$intPosEncabezados, 'DIFERENCIA EN HORAS')
                 ->setCellValue('BM'.$intPosEncabezados, '% CUMPLIMIENTO EN HORAS')
                 //Presupuestos del mes de Septiembre
                 ->setCellValue('BN'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('BO'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('BP'.$intPosEncabezados, 'DIFERENCIA EN IMPORTE')
                 ->setCellValue('BQ'.$intPosEncabezados, '% CUMPLIMIENTO EN IMPORTE')
                 ->setCellValue('BR'.$intPosEncabezados, 'HORAS PRESUPUESTADO')
                 ->setCellValue('BS'.$intPosEncabezados, 'HORAS REAL')
                 ->setCellValue('BT'.$intPosEncabezados, 'DIFERENCIA EN HORAS')
                 ->setCellValue('BU'.$intPosEncabezados, '% CUMPLIMIENTO EN HORAS')
                 //Presupuestos del mes de Octubre
                 ->setCellValue('BV'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('BW'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('BX'.$intPosEncabezados, 'DIFERENCIA EN IMPORTE')
                 ->setCellValue('BY'.$intPosEncabezados, '% CUMPLIMIENTO EN IMPORTE')
                 ->setCellValue('BZ'.$intPosEncabezados, 'HORAS PRESUPUESTADO')
                 ->setCellValue('CA'.$intPosEncabezados, 'HORAS REAL')
                 ->setCellValue('CB'.$intPosEncabezados, 'DIFERENCIA EN HORAS')
                 ->setCellValue('CC'.$intPosEncabezados, '% CUMPLIMIENTO EN HORAS')
                 //Presupuestos del mes de Noviembre
                  ->setCellValue('CD'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('CE'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('CF'.$intPosEncabezados, 'DIFERENCIA EN IMPORTE')
                 ->setCellValue('CG'.$intPosEncabezados, '% CUMPLIMIENTO EN IMPORTE')
                 ->setCellValue('CH'.$intPosEncabezados, 'HORAS PRESUPUESTADO')
                 ->setCellValue('CI'.$intPosEncabezados, 'HORAS REAL')
                 ->setCellValue('CJ'.$intPosEncabezados, 'DIFERENCIA EN HORAS')
                 ->setCellValue('CK'.$intPosEncabezados, '% CUMPLIMIENTO EN HORAS')
                 //Presupuestos del mes de Diciembre
                 ->setCellValue('CL'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('CM'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('CN'.$intPosEncabezados, 'DIFERENCIA EN IMPORTE')
                 ->setCellValue('CO'.$intPosEncabezados, '% CUMPLIMIENTO EN IMPORTE')
                 ->setCellValue('CP'.$intPosEncabezados, 'HORAS PRESUPUESTADO')
                 ->setCellValue('CQ'.$intPosEncabezados, 'HORAS REAL')
                 ->setCellValue('CR'.$intPosEncabezados, 'DIFERENCIA EN HORAS')
                 ->setCellValue('CS'.$intPosEncabezados, '% CUMPLIMIENTO EN HORAS')
                 //Presupuestos del año
                 ->setCellValue('CT'.$intPosEncabezados, 'IMPORTE PRESUPUESTADO')
                 ->setCellValue('CU'.$intPosEncabezados, 'IMPORTE REAL')
                 ->setCellValue('CV'.$intPosEncabezados, 'DIFERENCIA EN IMPORTE')
                 ->setCellValue('CW'.$intPosEncabezados, '% CUMPLIMIENTO EN IMPORTE')
                 ->setCellValue('CX'.$intPosEncabezados, 'HORAS PRESUPUESTADO')
                 ->setCellValue('CY'.$intPosEncabezados, 'HORAS REAL')
                 ->setCellValue('CZ'.$intPosEncabezados, 'DIFERENCIA EN HORAS')
                 ->setCellValue('DA'.$intPosEncabezados, '% CUMPLIMIENTO EN HORAS');


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
                 ->mergeCells('B'.$intPosPrimerCabecera.':I'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('J'.$intPosPrimerCabecera.':Q'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('R'.$intPosPrimerCabecera.':Y'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('Z'.$intPosPrimerCabecera.':AG'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('AH'.$intPosPrimerCabecera.':AO'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('AP'.$intPosPrimerCabecera.':AW'.$intPosPrimerCabecera); 
        
        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('AX'.$intPosPrimerCabecera.':BE'.$intPosPrimerCabecera);        

        $objExcel->setActiveSheetIndex(0)
                  ->mergeCells('BF'.$intPosPrimerCabecera.':BM'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('BN'.$intPosPrimerCabecera.':BU'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('BV'.$intPosPrimerCabecera.':CC'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('CD'.$intPosPrimerCabecera.':CK'.$intPosPrimerCabecera); 

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('CL'.$intPosPrimerCabecera.':CS'.$intPosPrimerCabecera);

        $objExcel->setActiveSheetIndex(0)
                 ->mergeCells('CT'.$intPosPrimerCabecera.':DA'.$intPosPrimerCabecera);


        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
                 ->getStyle('B'.$intPosPrimerCabecera.':DA'.$intPosPrimerCabecera)
                 ->getFill()
                 ->applyFromArray($arrStyleColumnas);

        $objExcel->getActiveSheet()
                 ->getStyle('A'.$intPosEncabezados.':DA'.$intPosEncabezados)
                 ->getFill()
                 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
        $objExcel->getActiveSheet()
                     ->getStyle('A'.$intPosEncabezados.':DA'.$intPosEncabezados)
                     ->applyFromArray($arrStyleFuenteColumnas);


        //Asignar objeto con los presupuestos de los mecánicos en el año
        $otdPresupuestos = $this->get_presupuestos($strAnio);  
        //Asignar array con los datos de los mecánicos
        $arrMecanicos = $otdPresupuestos['mecanicos']; 
         //Asignar array con los acumulados
        $arrAcumulados = $otdPresupuestos['acumulados'];           

        //Si hay información de los mecánicos
        if($arrMecanicos)
        {
            //Recorremos el arreglo 
            foreach ($arrMecanicos as $arrDet) 
            {

                //La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
                //Agregar información del registro
                $objExcel->setActiveSheetIndex(0)
                         ->setCellValueExplicit('A'.$intFila, $arrDet['mecanico'], PHPExcel_Cell_DataType::TYPE_STRING)
                         //Presupuestos del mes de Enero
                         ->setCellValue('B'.$intFila, $arrDet['presupuesto_enero'])
                         ->setCellValue('C'.$intFila, $arrDet['real_enero'])
                         ->setCellValue('D'.$intFila, $arrDet['diferencia_importeEnero'])
                         ->setCellValue('E'.$intFila, $arrDet['cumplimiento_importeEnero'])
                         ->setCellValue('F'.$intFila, $arrDet['horas_enero'])
                         ->setCellValue('G'.$intFila, $arrDet['real_horasEnero'])
                         ->setCellValue('H'.$intFila, $arrDet['diferencia_horasEnero'])
                         ->setCellValue('I'.$intFila, $arrDet['cumplimiento_horasEnero'])
                         //Presupuestos del mes de Febrero
                         ->setCellValue('J'.$intFila, $arrDet['presupuesto_febrero'])
                         ->setCellValue('K'.$intFila, $arrDet['real_febrero'])
                         ->setCellValue('L'.$intFila, $arrDet['diferencia_importeFebrero'])
                         ->setCellValue('M'.$intFila, $arrDet['cumplimiento_importeFebrero'])
                         ->setCellValue('N'.$intFila, $arrDet['horas_febrero'])
                         ->setCellValue('O'.$intFila, $arrDet['real_horasFebrero'])
                         ->setCellValue('P'.$intFila, $arrDet['diferencia_horasFebrero'])
                         ->setCellValue('Q'.$intFila, $arrDet['cumplimiento_horasFebrero'])
                         //Presupuestos del mes de Marzo
                         ->setCellValue('R'.$intFila, $arrDet['presupuesto_marzo'])
                         ->setCellValue('S'.$intFila, $arrDet['real_marzo'])
                         ->setCellValue('T'.$intFila, $arrDet['diferencia_importeMarzo'])
                         ->setCellValue('U'.$intFila, $arrDet['cumplimiento_importeMarzo'])
                         ->setCellValue('V'.$intFila, $arrDet['horas_marzo'])
                         ->setCellValue('W'.$intFila, $arrDet['real_horasMarzo'])
                         ->setCellValue('X'.$intFila, $arrDet['diferencia_horasMarzo'])
                         ->setCellValue('Y'.$intFila, $arrDet['cumplimiento_horasMarzo'])
                         //Presupuestos del mes de Abril
                         ->setCellValue('Z'.$intFila, $arrDet['presupuesto_abril'])
                         ->setCellValue('AA'.$intFila, $arrDet['real_abril'])
                         ->setCellValue('AB'.$intFila, $arrDet['diferencia_importeAbril'])
                         ->setCellValue('AC'.$intFila, $arrDet['cumplimiento_importeAbril'])
                         ->setCellValue('AD'.$intFila, $arrDet['horas_abril'])
                         ->setCellValue('AE'.$intFila, $arrDet['real_horasAbril'])
                         ->setCellValue('AF'.$intFila, $arrDet['diferencia_horasAbril'])
                         ->setCellValue('AG'.$intFila, $arrDet['cumplimiento_horasAbril'])
                         //Presupuestos del mes de Mayo
                         ->setCellValue('AH'.$intFila, $arrDet['presupuesto_mayo'])
                         ->setCellValue('AI'.$intFila, $arrDet['real_mayo'])
                         ->setCellValue('AJ'.$intFila, $arrDet['diferencia_importeMayo'])
                         ->setCellValue('AK'.$intFila, $arrDet['cumplimiento_importeMayo'])
                         ->setCellValue('AL'.$intFila, $arrDet['horas_mayo'])
                         ->setCellValue('AM'.$intFila, $arrDet['real_horasMayo'])
                         ->setCellValue('AN'.$intFila, $arrDet['diferencia_horasMayo'])
                         ->setCellValue('AO'.$intFila, $arrDet['cumplimiento_horasMayo'])
                         //Presupuestos del mes de Junio
                         ->setCellValue('AP'.$intFila, $arrDet['presupuesto_junio'])
                         ->setCellValue('AQ'.$intFila, $arrDet['real_junio'])
                         ->setCellValue('AR'.$intFila, $arrDet['diferencia_importeJunio'])
                         ->setCellValue('AS'.$intFila, $arrDet['cumplimiento_importeJunio'])
                         ->setCellValue('AT'.$intFila, $arrDet['horas_junio'])
                         ->setCellValue('AU'.$intFila, $arrDet['real_horasJunio'])
                         ->setCellValue('AV'.$intFila, $arrDet['diferencia_horasJunio'])
                         ->setCellValue('AW'.$intFila, $arrDet['cumplimiento_horasJunio'])
                         //Presupuestos del mes de Julio
                         ->setCellValue('AX'.$intFila, $arrDet['presupuesto_julio'])
                         ->setCellValue('AY'.$intFila, $arrDet['real_julio'])
                         ->setCellValue('AZ'.$intFila, $arrDet['diferencia_importeJulio'])
                         ->setCellValue('BA'.$intFila, $arrDet['cumplimiento_importeJulio'])
                         ->setCellValue('BB'.$intFila, $arrDet['horas_julio'])
                         ->setCellValue('BC'.$intFila, $arrDet['real_horasJulio'])
                         ->setCellValue('BD'.$intFila, $arrDet['diferencia_horasJulio'])
                         ->setCellValue('BE'.$intFila, $arrDet['cumplimiento_horasJulio'])
                         //Presupuestos del mes de Agosto
                         ->setCellValue('BF'.$intFila, $arrDet['presupuesto_agosto'])
                         ->setCellValue('BG'.$intFila, $arrDet['real_agosto'])
                         ->setCellValue('BH'.$intFila, $arrDet['diferencia_importeAgosto'])
                         ->setCellValue('BI'.$intFila, $arrDet['cumplimiento_importeAgosto'])
                         ->setCellValue('BJ'.$intFila, $arrDet['horas_agosto'])
                         ->setCellValue('BK'.$intFila, $arrDet['real_horasAgosto'])
                         ->setCellValue('BL'.$intFila, $arrDet['diferencia_horasAgosto'])
                         ->setCellValue('BM'.$intFila, $arrDet['cumplimiento_horasAgosto'])
                         //Presupuestos del mes de Septiembre
                         ->setCellValue('BN'.$intFila, $arrDet['presupuesto_septiembre'])
                         ->setCellValue('BO'.$intFila, $arrDet['real_septiembre'])
                         ->setCellValue('BP'.$intFila, $arrDet['diferencia_importeSeptiembre'])
                         ->setCellValue('BQ'.$intFila, $arrDet['cumplimiento_importeSeptiembre'])
                         ->setCellValue('BR'.$intFila, $arrDet['horas_septiembre'])
                         ->setCellValue('BS'.$intFila, $arrDet['real_horasSeptiembre'])
                         ->setCellValue('BT'.$intFila, $arrDet['diferencia_horasSeptiembre'])
                         ->setCellValue('BU'.$intFila, $arrDet['cumplimiento_horasSeptiembre'])
                         //Presupuestos del mes de Octubre
                         ->setCellValue('BV'.$intFila, $arrDet['presupuesto_octubre'])
                         ->setCellValue('BW'.$intFila, $arrDet['real_octubre'])
                         ->setCellValue('BX'.$intFila, $arrDet['diferencia_importeOctubre'])
                         ->setCellValue('BY'.$intFila, $arrDet['cumplimiento_importeOctubre'])
                         ->setCellValue('BZ'.$intFila, $arrDet['horas_octubre'])
                         ->setCellValue('CA'.$intFila, $arrDet['real_horasOctubre'])
                         ->setCellValue('CB'.$intFila, $arrDet['diferencia_horasOctubre'])
                         ->setCellValue('CC'.$intFila, $arrDet['cumplimiento_horasOctubre'])
                         //Presupuestos del mes de Noviembre
                         ->setCellValue('CD'.$intFila, $arrDet['presupuesto_noviembre'])
                         ->setCellValue('CE'.$intFila, $arrDet['real_noviembre'])
                         ->setCellValue('CF'.$intFila, $arrDet['diferencia_importeNoviembre'])
                         ->setCellValue('CG'.$intFila, $arrDet['cumplimiento_importeNoviembre'])
                         ->setCellValue('CH'.$intFila, $arrDet['horas_noviembre'])
                         ->setCellValue('CI'.$intFila, $arrDet['real_horasNoviembre'])
                         ->setCellValue('CJ'.$intFila, $arrDet['diferencia_horasNoviembre'])
                         ->setCellValue('CK'.$intFila, $arrDet['cumplimiento_horasNoviembre'])
                         //Presupuestos del mes de Diciembre
                         ->setCellValue('CL'.$intFila, $arrDet['presupuesto_diciembre'])
                         ->setCellValue('CM'.$intFila, $arrDet['real_diciembre'])
                         ->setCellValue('CN'.$intFila, $arrDet['diferencia_importeDiciembre'])
                         ->setCellValue('CO'.$intFila, $arrDet['cumplimiento_importeDiciembre'])
                         ->setCellValue('CP'.$intFila, $arrDet['horas_diciembre'])
                         ->setCellValue('CQ'.$intFila, $arrDet['real_horasDiciembre'])
                         ->setCellValue('CR'.$intFila, $arrDet['diferencia_horasDiciembre'])
                         ->setCellValue('CS'.$intFila, $arrDet['cumplimiento_horasDiciembre'])
                         //Presupuestos del año
                         ->setCellValue('CT'.$intFila, $arrDet['presupuesto_anual'])
                         ->setCellValue('CU'.$intFila, $arrDet['real_anual'])
                         ->setCellValue('CV'.$intFila, $arrDet['diferencia_importeAnual'])
                         ->setCellValue('CW'.$intFila, $arrDet['cumplimiento_importeAnual'])
                         ->setCellValue('CX'.$intFila, $arrDet['horas_anual'])
                         ->setCellValue('CY'.$intFila, $arrDet['real_horasAnual'])
                         ->setCellValue('CZ'.$intFila, $arrDet['diferencia_horasAnual'])
                         ->setCellValue('DA'.$intFila, $arrDet['cumplimiento_horasAnual']);



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
                         ->setCellValue('F'.$intFila, $arrAcumulados[0]['horas_enero'])
                         ->setCellValue('G'.$intFila, $arrAcumulados[0]['real_horasEnero'])
                         ->setCellValue('H'.$intFila, $arrAcumulados[0]['diferencia_horasEnero'])
                         ->setCellValue('I'.$intFila, $arrAcumulados[0]['cumplimiento_horasEnero'])
                         //Presupuestos del mes de Febrero
                         ->setCellValue('J'.$intFila, $arrAcumulados[0]['presupuesto_febrero'])
                         ->setCellValue('K'.$intFila, $arrAcumulados[0]['real_febrero'])
                         ->setCellValue('L'.$intFila, $arrAcumulados[0]['diferencia_importeFebrero'])
                         ->setCellValue('M'.$intFila, $arrAcumulados[0]['cumplimiento_importeFebrero'])
                         ->setCellValue('N'.$intFila, $arrAcumulados[0]['horas_febrero'])
                         ->setCellValue('O'.$intFila, $arrAcumulados[0]['real_horasFebrero'])
                         ->setCellValue('P'.$intFila, $arrAcumulados[0]['diferencia_horasFebrero'])
                         ->setCellValue('Q'.$intFila, $arrAcumulados[0]['cumplimiento_horasFebrero'])
                         //Presupuestos del mes de Marzo
                         ->setCellValue('R'.$intFila, $arrAcumulados[0]['presupuesto_marzo'])
                         ->setCellValue('S'.$intFila, $arrAcumulados[0]['real_marzo'])
                         ->setCellValue('T'.$intFila, $arrAcumulados[0]['diferencia_importeMarzo'])
                         ->setCellValue('U'.$intFila, $arrAcumulados[0]['cumplimiento_importeMarzo'])
                         ->setCellValue('V'.$intFila, $arrAcumulados[0]['horas_marzo'])
                         ->setCellValue('W'.$intFila, $arrAcumulados[0]['real_horasMarzo'])
                         ->setCellValue('X'.$intFila, $arrAcumulados[0]['diferencia_horasMarzo'])
                         ->setCellValue('Y'.$intFila, $arrAcumulados[0]['cumplimiento_horasMarzo'])
                         //Presupuestos del mes de Abril
                         ->setCellValue('Z'.$intFila, $arrAcumulados[0]['presupuesto_abril'])
                         ->setCellValue('AA'.$intFila, $arrAcumulados[0]['real_abril'])
                         ->setCellValue('AB'.$intFila, $arrAcumulados[0]['diferencia_importeAbril'])
                         ->setCellValue('AC'.$intFila, $arrAcumulados[0]['cumplimiento_importeAbril'])
                         ->setCellValue('AD'.$intFila, $arrAcumulados[0]['horas_abril'])
                         ->setCellValue('AE'.$intFila, $arrAcumulados[0]['real_horasAbril'])
                         ->setCellValue('AF'.$intFila, $arrAcumulados[0]['diferencia_horasAbril'])
                         ->setCellValue('AG'.$intFila, $arrAcumulados[0]['cumplimiento_horasAbril'])
                         //Presupuestos del mes de Mayo
                         ->setCellValue('AH'.$intFila, $arrAcumulados[0]['presupuesto_mayo'])
                         ->setCellValue('AI'.$intFila, $arrAcumulados[0]['real_mayo'])
                         ->setCellValue('AJ'.$intFila, $arrAcumulados[0]['diferencia_importeMayo'])
                         ->setCellValue('AK'.$intFila, $arrAcumulados[0]['cumplimiento_importeMayo'])
                         ->setCellValue('AL'.$intFila, $arrAcumulados[0]['horas_mayo'])
                         ->setCellValue('AM'.$intFila, $arrAcumulados[0]['real_horasMayo'])
                         ->setCellValue('AN'.$intFila, $arrAcumulados[0]['diferencia_horasMayo'])
                         ->setCellValue('AO'.$intFila, $arrAcumulados[0]['cumplimiento_horasMayo'])
                         //Presupuestos del mes de Junio
                         ->setCellValue('AP'.$intFila, $arrAcumulados[0]['presupuesto_junio'])
                         ->setCellValue('AQ'.$intFila, $arrAcumulados[0]['real_junio'])
                         ->setCellValue('AR'.$intFila, $arrAcumulados[0]['diferencia_importeJunio'])
                         ->setCellValue('AS'.$intFila, $arrAcumulados[0]['cumplimiento_importeJunio'])
                         ->setCellValue('AT'.$intFila, $arrAcumulados[0]['horas_junio'])
                         ->setCellValue('AU'.$intFila, $arrAcumulados[0]['real_horasJunio'])
                         ->setCellValue('AV'.$intFila, $arrAcumulados[0]['diferencia_horasJunio'])
                         ->setCellValue('AW'.$intFila, $arrAcumulados[0]['cumplimiento_horasJunio'])
                         //Presupuestos del mes de Julio
                         ->setCellValue('AX'.$intFila, $arrAcumulados[0]['presupuesto_julio'])
                         ->setCellValue('AY'.$intFila, $arrAcumulados[0]['real_julio'])
                         ->setCellValue('AZ'.$intFila, $arrAcumulados[0]['diferencia_importeJulio'])
                         ->setCellValue('BA'.$intFila, $arrAcumulados[0]['cumplimiento_importeJulio'])
                         ->setCellValue('BB'.$intFila, $arrAcumulados[0]['horas_julio'])
                         ->setCellValue('BC'.$intFila, $arrAcumulados[0]['real_horasJulio'])
                         ->setCellValue('BD'.$intFila, $arrAcumulados[0]['diferencia_horasJulio'])
                         ->setCellValue('BE'.$intFila, $arrAcumulados[0]['cumplimiento_horasJulio'])
                         //Presupuestos del mes de Agosto
                         ->setCellValue('BF'.$intFila, $arrAcumulados[0]['presupuesto_agosto'])
                         ->setCellValue('BG'.$intFila, $arrAcumulados[0]['real_agosto'])
                         ->setCellValue('BH'.$intFila, $arrAcumulados[0]['diferencia_importeAgosto'])
                         ->setCellValue('BI'.$intFila, $arrAcumulados[0]['cumplimiento_importeAgosto'])
                         ->setCellValue('BJ'.$intFila, $arrAcumulados[0]['horas_agosto'])
                         ->setCellValue('BK'.$intFila, $arrAcumulados[0]['real_horasAgosto'])
                         ->setCellValue('BL'.$intFila, $arrAcumulados[0]['diferencia_horasAgosto'])
                         ->setCellValue('BM'.$intFila, $arrAcumulados[0]['cumplimiento_horasAgosto'])
                         //Presupuestos del mes de Septiembre
                         ->setCellValue('BN'.$intFila, $arrAcumulados[0]['presupuesto_septiembre'])
                         ->setCellValue('BO'.$intFila, $arrAcumulados[0]['real_septiembre'])
                         ->setCellValue('BP'.$intFila, $arrAcumulados[0]['diferencia_importeSeptiembre'])
                         ->setCellValue('BQ'.$intFila, $arrAcumulados[0]['cumplimiento_importeSeptiembre'])
                         ->setCellValue('BR'.$intFila, $arrAcumulados[0]['horas_septiembre'])
                         ->setCellValue('BS'.$intFila, $arrAcumulados[0]['real_horasSeptiembre'])
                         ->setCellValue('BT'.$intFila, $arrAcumulados[0]['diferencia_horasSeptiembre'])
                         ->setCellValue('BU'.$intFila, $arrAcumulados[0]['cumplimiento_horasSeptiembre'])
                         //Presupuestos del mes de Octubre
                         ->setCellValue('BV'.$intFila, $arrAcumulados[0]['presupuesto_octubre'])
                         ->setCellValue('BW'.$intFila, $arrAcumulados[0]['real_octubre'])
                         ->setCellValue('BX'.$intFila, $arrAcumulados[0]['diferencia_importeOctubre'])
                         ->setCellValue('BY'.$intFila, $arrAcumulados[0]['cumplimiento_importeOctubre'])
                         ->setCellValue('BZ'.$intFila, $arrAcumulados[0]['horas_octubre'])
                         ->setCellValue('CA'.$intFila, $arrAcumulados[0]['real_horasOctubre'])
                         ->setCellValue('CB'.$intFila, $arrAcumulados[0]['diferencia_horasOctubre'])
                         ->setCellValue('CC'.$intFila, $arrAcumulados[0]['cumplimiento_horasOctubre'])
                         //Presupuestos del mes de Noviembre
                         ->setCellValue('CD'.$intFila, $arrAcumulados[0]['presupuesto_noviembre'])
                         ->setCellValue('CE'.$intFila, $arrAcumulados[0]['real_noviembre'])
                         ->setCellValue('CF'.$intFila, $arrAcumulados[0]['diferencia_importeNoviembre'])
                         ->setCellValue('CG'.$intFila, $arrAcumulados[0]['cumplimiento_importeNoviembre'])
                         ->setCellValue('CH'.$intFila, $arrAcumulados[0]['horas_noviembre'])
                         ->setCellValue('CI'.$intFila, $arrAcumulados[0]['real_horasNoviembre'])
                         ->setCellValue('CJ'.$intFila, $arrAcumulados[0]['diferencia_horasNoviembre'])
                         ->setCellValue('CK'.$intFila, $arrAcumulados[0]['cumplimiento_horasNoviembre'])
                         //Presupuestos del mes de Diciembre
                         ->setCellValue('CL'.$intFila, $arrAcumulados[0]['presupuesto_diciembre'])
                         ->setCellValue('CM'.$intFila, $arrAcumulados[0]['real_diciembre'])
                         ->setCellValue('CN'.$intFila, $arrAcumulados[0]['diferencia_importeDiciembre'])
                         ->setCellValue('CO'.$intFila, $arrAcumulados[0]['cumplimiento_importeDiciembre'])
                         ->setCellValue('CP'.$intFila, $arrAcumulados[0]['horas_diciembre'])
                         ->setCellValue('CQ'.$intFila, $arrAcumulados[0]['real_horasDiciembre'])
                         ->setCellValue('CR'.$intFila, $arrAcumulados[0]['diferencia_horasDiciembre'])
                         ->setCellValue('CS'.$intFila, $arrAcumulados[0]['cumplimiento_horasDiciembre'])
                         //Presupuestos del año
                         ->setCellValue('CT'.$intFila, $arrAcumulados[0]['presupuesto_anual'])
                         ->setCellValue('CU'.$intFila, $arrAcumulados[0]['real_anual'])
                         ->setCellValue('CV'.$intFila, $arrAcumulados[0]['diferencia_importeAnual'])
                         ->setCellValue('CW'.$intFila, $arrAcumulados[0]['cumplimiento_importeAnual'])
                         ->setCellValue('CX'.$intFila, $arrAcumulados[0]['horas_anual'])
                         ->setCellValue('CY'.$intFila, $arrAcumulados[0]['real_horasAnual'])
                         ->setCellValue('CZ'.$intFila, $arrAcumulados[0]['diferencia_horasAnual'])
                         ->setCellValue('DA'.$intFila, $arrAcumulados[0]['cumplimiento_horasAnual']);

        } //Cierre de verificación de información


       /*Cambiar contenido de las celdas a formato moneda 
        (cambiar color de texto en caso de ser un valor negativo)*/
        $objExcel->getActiveSheet()
                 ->getStyle('B'.$intFilaInicial.':'.'D'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('E'.$intFilaInicial.':'.'I'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');
        
        $objExcel->getActiveSheet()
                 ->getStyle('J'.$intFilaInicial.':'.'L'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('M'.$intFilaInicial.':'.'Q'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('R'.$intFilaInicial.':'.'T'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('U'.$intFilaInicial.':'.'Y'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('Z'.$intFilaInicial.':'.'AB'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        
        $objExcel->getActiveSheet()
                 ->getStyle('AC'.$intFilaInicial.':'.'AG'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('AH'.$intFilaInicial.':'.'AJ'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('AK'.$intFilaInicial.':'.'AO'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('AP'.$intFilaInicial.':'.'AR'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('AS'.$intFilaInicial.':'.'AW'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('AX'.$intFilaInicial.':'.'AZ'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('BA'.$intFilaInicial.':'.'BE'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('BF'.$intFilaInicial.':'.'BH'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('BI'.$intFilaInicial.':'.'BM'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('BN'.$intFilaInicial.':'.'BP'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('BQ'.$intFilaInicial.':'.'BU'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('BV'.$intFilaInicial.':'.'BX'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('BY'.$intFilaInicial.':'.'CC'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('CD'.$intFilaInicial.':'.'CF'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');


        $objExcel->getActiveSheet()
                 ->getStyle('CG'.$intFilaInicial.':'.'CK'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('CL'.$intFilaInicial.':'.'CN'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');


        $objExcel->getActiveSheet()
                 ->getStyle('CO'.$intFilaInicial.':'.'CS'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');

        $objExcel->getActiveSheet()
                 ->getStyle('CT'.$intFilaInicial.':'.'CV'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('$#,##0.00;[Red]-$#,##0.00');


        $objExcel->getActiveSheet()
                 ->getStyle('CW'.$intFilaInicial.':'.'DA'.$intFila)
                 ->getNumberFormat()
                 ->setFormatCode('#,##0.00; [Red]-#,##0.00');  

        //Cambiar alineación de las siguientes celdas         
        $objExcel->getActiveSheet()
                 ->getStyle('B'.$intFilaInicial.':'.'DA'.$intFila)
                 ->getAlignment()
                 ->applyFromArray($arrStyleAlignmentRight);

         $objExcel->getActiveSheet()
                 ->getStyle('A'.$intFila.':'.'A'.$intFila)
                 ->getAlignment()
                 ->applyFromArray($arrStyleAlignmentRight);


         //Cambiar estilo de la celda
         $objExcel->getActiveSheet()
                 ->getStyle('A'.$intFila.':'.'DA'.$intFila)
                 ->applyFromArray($arrStyleBold);        

        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'presupuestos_mano_obra.xls', 'presupuestos', $intFila);
    }


    //Asignar objeto con los detalles de presupuestos
    public function get_presupuestos($strAnio)
    {
        //Array que se utiliza para enviar datos
        $arrDatos = array('mecanicos' => NULL, 
                          'acumulados' => NULL);

        //Array que se utiliza para agregar los datos de mecánicos
        $arrMecanicos = array();
        //Array que se utiliza para agregar acumulados
        $arrAcumulados = array();
        //Array que se utiliza para agregar los datos de un mecánico
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
        
        //Variables que se utilizan para asignar los acumulados de horas
        $intAcumHorasEnero = 0;
        $intAcumHorasFebrero = 0;
        $intAcumHorasMarzo = 0;
        $intAcumHorasAbril = 0;
        $intAcumHorasMayo = 0;
        $intAcumHorasJunio = 0;
        $intAcumHorasJulio = 0;
        $intAcumHorasAgosto = 0;
        $intAcumHorasSeptiembre = 0;
        $intAcumHorasOctubre = 0;
        $intAcumHorasNoviembre = 0;
        $intAcumHorasDiciembre = 0;
        $intAcumHorasAnual = 0;
        
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


        //Variables que se utilizan para asignar los acumulados de horas reales
        $intAcumRealHorasEnero = 0;
        $intAcumRealHorasFebrero = 0;
        $intAcumRealHorasMarzo = 0;
        $intAcumRealHorasAbril = 0;
        $intAcumRealHorasMayo = 0;
        $intAcumRealHorasJunio = 0;
        $intAcumRealHorasJulio = 0;
        $intAcumRealHorasAgosto = 0;
        $intAcumRealHorasSeptiembre = 0;
        $intAcumRealHorasOctubre = 0;
        $intAcumRealHorasNoviembre = 0;
        $intAcumRealHorasDiciembre = 0;
        $intAcumRealHorasAnual = 0;


        //Verificar si existe información
        if($otdResultado)
        {
            //Recorremos el arreglo 
            foreach ($otdResultado as $arrCol) 
            {
                //Variable para acumular el presupuesto total anual
                $intPresupuestoAnual = 0; 
                //Variable para acumular el presupuesto total de horas anual
                $intHorasAnual = 0; 
                //Variable para acumular el importe total real anual
                $intRealAnual = 0; 
                //Variable para acumular el importe total real de horas anual
                $intRealHorasAnual = 0;

                //Variables que se utilizan para asignar valores de los presupuestos mensuales
                //Enero
                $intPresupuestoEnero = $arrCol->PresupuestoEnero;
                $intRealEnero = $arrCol->RealEnero;
                $intHorasEnero = $arrCol->HorasEnero;
                $intRealHorasEnero = $arrCol->RealHorasEnero;
                //Febrero
                $intPresupuestoFebrero = $arrCol->PresupuestoFebrero;
                $intRealFebrero = $arrCol->RealFebrero;
                $intHorasFebrero = $arrCol->HorasFebrero;
                $intRealHorasFebrero = $arrCol->RealHorasFebrero;
                //Marzo
                $intPresupuestoMarzo = $arrCol->PresupuestoMarzo;
                $intRealMarzo = $arrCol->RealMarzo;
                $intHorasMarzo = $arrCol->HorasMarzo;
                $intRealHorasMarzo = $arrCol->RealHorasMarzo;
                //Abril
                $intPresupuestoAbril = $arrCol->PresupuestoAbril;
                $intRealAbril = $arrCol->RealAbril;
                $intHorasAbril = $arrCol->HorasAbril;
                $intRealHorasAbril = $arrCol->RealHorasAbril;
                //Mayo
                $intPresupuestoMayo = $arrCol->PresupuestoMayo;
                $intRealMayo = $arrCol->RealMayo;
                $intHorasMayo = $arrCol->HorasMayo;
                $intRealHorasMayo = $arrCol->RealHorasMayo;
                //Junio
                $intPresupuestoJunio = $arrCol->PresupuestoJunio;
                $intRealJunio = $arrCol->RealJunio;
                $intHorasJunio = $arrCol->HorasJunio;
                $intRealHorasJunio = $arrCol->RealHorasJunio;
                //Julio
                $intPresupuestoJulio = $arrCol->PresupuestoJulio;
                $intRealJulio = $arrCol->RealJulio;
                $intHorasJulio = $arrCol->HorasJulio;
                $intRealHorasJulio = $arrCol->RealHorasJulio;
                //Agosto
                $intPresupuestoAgosto = $arrCol->PresupuestoAgosto;
                $intRealAgosto = $arrCol->RealAgosto;
                $intHorasAgosto = $arrCol->HorasAgosto;
                $intRealHorasAgosto = $arrCol->RealHorasAgosto;
                //Septiembre
                $intPresupuestoSeptiembre = $arrCol->PresupuestoSeptiembre;
                $intRealSeptiembre = $arrCol->RealSeptiembre;
                $intHorasSeptiembre = $arrCol->HorasSeptiembre;
                $intRealHorasSeptiembre = $arrCol->RealHorasSeptiembre;
                //Octubre
                $intPresupuestoOctubre = $arrCol->PresupuestoOctubre;
                $intRealOctubre = $arrCol->RealOctubre;
                $intHorasOctubre = $arrCol->HorasOctubre;
                $intRealHorasOctubre = $arrCol->RealHorasOctubre;
                //Noviembre
                $intPresupuestoNoviembre = $arrCol->PresupuestoNoviembre;
                $intRealNoviembre = $arrCol->RealNoviembre;
                $intHorasNoviembre = $arrCol->HorasNoviembre;
                $intRealHorasNoviembre = $arrCol->RealHorasNoviembre;
                //Diciembre
                $intPresupuestoDiciembre = $arrCol->PresupuestoDiciembre;
                $intRealDiciembre = $arrCol->RealDiciembre;
                $intHorasDiciembre = $arrCol->HorasDiciembre;
                $intRealHorasDiciembre = $arrCol->RealHorasDiciembre;


    

                //Definir valores del array auxiliar de información (para cada mecánico)
                $arrAuxiliar["mecanico"] = $arrCol->mecanico;
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
                $arrAuxiliar["horas_enero"] = $intHorasEnero;
                $arrAuxiliar["real_horasEnero"] = $intRealHorasEnero;
                //Calcular diferencia de horas
                $arrAuxiliar["diferencia_horasEnero"] = $intRealHorasEnero - $intHorasEnero;
                //Calcular porcentaje de cumplimiento de horas
                $arrAuxiliar["cumplimiento_horasEnero"] = $this->get_cumplimiento_ppto($intHorasEnero,
                                                                                       $intRealHorasEnero);

                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoEnero;
                //Incrementar horas del presupuesto anual
                $intHorasAnual += $intHorasEnero;
                //Incrementar importe real anual
                $intRealAnual += $intRealEnero;
                //Incrementar horas del importe real anual
                $intRealHorasAnual += $intRealHorasEnero;

                //Incrementar acumulados del mes
                $intAcumPresupuestoEnero += $intPresupuestoEnero;
                $intAcumHorasEnero += $intHorasEnero;
                $intAcumRealEnero += $intRealEnero;
                $intAcumRealHorasEnero += $intRealHorasEnero;


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
                $arrAuxiliar["horas_febrero"] = $intHorasFebrero;
                $arrAuxiliar["real_horasFebrero"] = $intRealHorasFebrero;
                //Calcular diferencia de horas
                $arrAuxiliar["diferencia_horasFebrero"] = $intRealHorasFebrero - $intHorasFebrero;
                //Calcular porcentaje de cumplimiento de horas
                $arrAuxiliar["cumplimiento_horasFebrero"] = $this->get_cumplimiento_ppto($intHorasFebrero, 
                                                                                         $intRealHorasFebrero);
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoFebrero;
                //Incrementar horas del presupuesto anual
                $intHorasAnual += $intHorasFebrero;
                //Incrementar importe real anual
                $intRealAnual += $intRealFebrero;
                //Incrementar horas del importe real anual
                $intRealHorasAnual += $intRealHorasFebrero;

                //Incrementar acumulados del mes
                $intAcumPresupuestoFebrero += $intPresupuestoFebrero;
                $intAcumHorasFebrero += $intHorasFebrero;
                $intAcumRealFebrero += $intRealFebrero;
                $intAcumRealHorasFebrero += $intRealHorasFebrero;


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
                $arrAuxiliar["horas_marzo"] = $intHorasMarzo;
                $arrAuxiliar["real_horasMarzo"] = $intRealHorasMarzo;
                //Calcular diferencia de horas
                $arrAuxiliar["diferencia_horasMarzo"] = $intRealHorasMarzo - $intHorasMarzo;
                //Calcular porcentaje de cumplimiento de horas
                $arrAuxiliar["cumplimiento_horasMarzo"] = $this->get_cumplimiento_ppto($intHorasMarzo, 
                                                                                       $intRealHorasMarzo);
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoMarzo;
                //Incrementar horas del presupuesto anual
                $intHorasAnual += $intHorasMarzo;
                //Incrementar importe real anual
                $intRealAnual += $intRealMarzo;
                //Incrementar horas del importe real anual
                $intRealHorasAnual += $intRealHorasMarzo;

                //Incrementar acumulados del mes
                $intAcumPresupuestoMarzo += $intPresupuestoMarzo;
                $intAcumHorasMarzo += $intHorasMarzo;
                $intAcumRealMarzo += $intRealMarzo;
                $intAcumRealHorasMarzo += $intRealHorasMarzo;



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
                $arrAuxiliar["horas_abril"] = $intHorasAbril;
                $arrAuxiliar["real_horasAbril"] = $intRealHorasAbril;
                //Calcular diferencia de horas
                $arrAuxiliar["diferencia_horasAbril"] = $intRealHorasAbril - $intHorasAbril;
                //Calcular porcentaje de cumplimiento de horas
                $arrAuxiliar["cumplimiento_horasAbril"] = $this->get_cumplimiento_ppto($intHorasAbril, 
                                                                                       $intRealHorasAbril);
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoAbril;
                //Incrementar horas del presupuesto anual
                $intHorasAnual += $intHorasAbril;
                //Incrementar importe real anual
                $intRealAnual += $intRealAbril;
                //Incrementar horas del importe real anual
                $intRealHorasAnual += $intRealHorasAbril;

                //Incrementar acumulados del mes
                $intAcumPresupuestoAbril += $intPresupuestoAbril;
                $intAcumHorasAbril += $intHorasAbril;
                $intAcumRealAbril += $intRealAbril;
                $intAcumRealHorasAbril += $intRealHorasAbril;


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
                $arrAuxiliar["horas_mayo"] = $intHorasMayo;
                $arrAuxiliar["real_horasMayo"] = $intRealHorasMayo;
                //Calcular diferencia de horas
                $arrAuxiliar["diferencia_horasMayo"] = $intRealHorasMayo - $intHorasMayo;
                //Calcular porcentaje de cumplimiento de horas
                $arrAuxiliar["cumplimiento_horasMayo"] = $this->get_cumplimiento_ppto($intHorasMayo, 
                                                                                      $intRealHorasMayo);
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoMayo;
                //Incrementar horas del presupuesto anual
                $intHorasAnual += $intHorasMayo;
                //Incrementar importe real anual
                $intRealAnual += $intRealMayo;
                //Incrementar horas del importe real anual
                $intRealHorasAnual += $intRealHorasMayo;

                //Incrementar acumulados del mes
                $intAcumPresupuestoMayo += $intPresupuestoMayo;
                $intAcumHorasMayo += $intHorasMayo;
                $intAcumRealMayo += $intRealMayo;
                $intAcumRealHorasMayo += $intRealHorasMayo;


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
                $arrAuxiliar["horas_junio"] = $intHorasJunio;
                $arrAuxiliar["real_horasJunio"] = $intRealHorasJunio;
                //Calcular diferencia de horas
                $arrAuxiliar["diferencia_horasJunio"] = $intRealHorasJunio - $intHorasJunio;
                //Calcular porcentaje de cumplimiento de horas
                $arrAuxiliar["cumplimiento_horasJunio"] = $this->get_cumplimiento_ppto($intHorasJunio, 
                                                                                       $intRealHorasJunio);
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoJunio;
                //Incrementar horas del presupuesto anual
                $intHorasAnual += $intHorasJunio;
                //Incrementar importe real anual
                $intRealAnual += $intRealJunio;
                //Incrementar horas del importe real anual
                $intRealHorasAnual += $intRealHorasJunio;

                //Incrementar acumulados del mes
                $intAcumPresupuestoJunio += $intPresupuestoJunio;
                $intAcumHorasJunio += $intHorasJunio;
                $intAcumRealJunio += $intRealJunio;
                $intAcumRealHorasJunio += $intRealHorasJunio;


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
                $arrAuxiliar["horas_julio"] = $intHorasJulio;
                $arrAuxiliar["real_horasJulio"] = $intRealHorasJulio;
                //Calcular diferencia de horas
                $arrAuxiliar["diferencia_horasJulio"] = $intRealHorasJulio - $intHorasJulio;
                //Calcular porcentaje de cumplimiento de horas
                $arrAuxiliar["cumplimiento_horasJulio"] = $this->get_cumplimiento_ppto($intHorasJulio, 
                                                                                       $intRealHorasJulio);
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoJulio;
                //Incrementar horas del presupuesto anual
                $intHorasAnual += $intHorasJulio;
                //Incrementar importe real anual
                $intRealAnual += $intRealJulio;
                //Incrementar horas del importe real anual
                $intRealHorasAnual += $intRealHorasJulio;

                //Incrementar acumulados del mes
                $intAcumPresupuestoJulio += $intPresupuestoJulio;
                $intAcumHorasJulio += $intHorasJulio;
                $intAcumRealJulio += $intRealJulio;
                $intAcumRealHorasJulio += $intRealHorasJulio;


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
                $arrAuxiliar["horas_agosto"] = $intHorasAgosto;
                $arrAuxiliar["real_horasAgosto"] = $intRealHorasAgosto;
                //Calcular diferencia de horas
                $arrAuxiliar["diferencia_horasAgosto"] = $intRealHorasAgosto - $intHorasAgosto;
                //Calcular porcentaje de cumplimiento de horas
                $arrAuxiliar["cumplimiento_horasAgosto"] = $this->get_cumplimiento_ppto($intHorasAgosto, 
                                                                                        $intRealHorasAgosto);
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoAgosto;
                //Incrementar horas del presupuesto anual
                $intHorasAnual += $intHorasAgosto;
                //Incrementar importe real anual
                $intRealAnual += $intRealAgosto;
                //Incrementar horas del importe real anual
                $intRealHorasAnual += $intRealHorasAgosto;

                //Incrementar acumulados del mes
                $intAcumPresupuestoAgosto += $intPresupuestoAgosto;
                $intAcumHorasAgosto += $intHorasAgosto;
                $intAcumRealAgosto += $intRealAgosto;
                $intAcumRealHorasAgosto += $intRealHorasAgosto;

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
                $arrAuxiliar["horas_septiembre"] = $intHorasSeptiembre;
                $arrAuxiliar["real_horasSeptiembre"] = $intRealHorasSeptiembre;
                //Calcular diferencia de horas
                $arrAuxiliar["diferencia_horasSeptiembre"] = $intRealHorasSeptiembre - $intHorasSeptiembre;
                //Calcular porcentaje de cumplimiento de horas
                $arrAuxiliar["cumplimiento_horasSeptiembre"] = $this->get_cumplimiento_ppto($intHorasSeptiembre, 
                                                                                            $intRealHorasSeptiembre);
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoSeptiembre;
                //Incrementar horas del presupuesto anual
                $intHorasAnual += $intHorasSeptiembre;
                //Incrementar importe real anual
                $intRealAnual += $intRealSeptiembre;
                //Incrementar horas del importe real anual
                $intRealHorasAnual += $intRealHorasSeptiembre;

                //Incrementar acumulados del mes
                $intAcumPresupuestoSeptiembre += $intPresupuestoSeptiembre;
                $intAcumHorasSeptiembre += $intHorasSeptiembre;
                $intAcumRealSeptiembre += $intRealSeptiembre;
                $intAcumRealHorasSeptiembre += $intRealHorasSeptiembre;


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
                $arrAuxiliar["horas_octubre"] = $intHorasOctubre;
                $arrAuxiliar["real_horasOctubre"] = $intRealHorasOctubre;
                //Calcular diferencia de horas
                $arrAuxiliar["diferencia_horasOctubre"] = $intRealHorasOctubre - $intHorasOctubre;
                //Calcular porcentaje de cumplimiento de horas
                $arrAuxiliar["cumplimiento_horasOctubre"] = $this->get_cumplimiento_ppto($intHorasOctubre, 
                                                                                         $intRealHorasOctubre);
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoOctubre;
                //Incrementar horas del presupuesto anual
                $intHorasAnual += $intHorasOctubre;
                //Incrementar importe real anual
                $intRealAnual += $intRealOctubre;
                //Incrementar horas del importe real anual
                $intRealHorasAnual += $intRealHorasOctubre;

                //Incrementar acumulados del mes
                $intAcumPresupuestoOctubre += $intPresupuestoOctubre;
                $intAcumHorasOctubre += $intHorasOctubre;
                $intAcumRealOctubre += $intRealOctubre;
                $intAcumRealHorasOctubre += $intRealHorasOctubre;


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
                $arrAuxiliar["horas_noviembre"] = $intHorasNoviembre;
                $arrAuxiliar["real_horasNoviembre"] = $intRealHorasNoviembre;
                //Calcular diferencia de horas
                $arrAuxiliar["diferencia_horasNoviembre"] = $intRealHorasNoviembre - $intHorasNoviembre;
                //Calcular porcentaje de cumplimiento de horas
                $arrAuxiliar["cumplimiento_horasNoviembre"] = $this->get_cumplimiento_ppto($intHorasNoviembre, 
                                                                                           $intRealHorasNoviembre);
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoNoviembre;
                //Incrementar horas del presupuesto anual
                $intHorasAnual += $intHorasNoviembre;
                //Incrementar importe real anual
                $intRealAnual += $intRealNoviembre;
                //Incrementar horas del importe real anual
                $intRealHorasAnual += $intRealHorasNoviembre;

                //Incrementar acumulados del mes
                $intAcumPresupuestoNoviembre += $intPresupuestoNoviembre;
                $intAcumHorasNoviembre += $intHorasNoviembre;
                $intAcumRealNoviembre += $intRealNoviembre;
                $intAcumRealHorasNoviembre += $intRealHorasNoviembre;


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
                $arrAuxiliar["horas_diciembre"] = $intHorasDiciembre;
                $arrAuxiliar["real_horasDiciembre"] = $intRealHorasDiciembre;
                //Calcular diferencia de horas
                $arrAuxiliar["diferencia_horasDiciembre"] = $intRealHorasDiciembre - $intHorasDiciembre;
                //Calcular porcentaje de cumplimiento de horas
                $arrAuxiliar["cumplimiento_horasDiciembre"] = $this->get_cumplimiento_ppto($intHorasDiciembre, 
                                                                                           $intRealHorasDiciembre);
                
                //Incrementar importe del presupuesto anual
                $intPresupuestoAnual += $intPresupuestoDiciembre;
                //Incrementar horas del presupuesto anual
                $intHorasAnual += $intHorasDiciembre;
                //Incrementar importe real anual
                $intRealAnual += $intRealDiciembre;
                //Incrementar horas del importe real anual
                $intRealHorasAnual += $intRealHorasDiciembre;

                //Incrementar acumulados del mes
                $intAcumPresupuestoDiciembre += $intPresupuestoDiciembre;
                $intAcumHorasDiciembre += $intHorasDiciembre;
                $intAcumRealDiciembre += $intRealDiciembre;
                $intAcumRealHorasDiciembre += $intRealHorasDiciembre;


                //Anual
                $arrAuxiliar["presupuesto_anual"] = $intPresupuestoAnual;
                $arrAuxiliar["real_anual"] = $intRealAnual;
                //Calcular diferencia de importes
                $arrAuxiliar["diferencia_importeAnual"] = $intRealAnual - $intPresupuestoAnual;
                //Calcular porcentaje de cumplimiento de importes
                $arrAuxiliar["cumplimiento_importeAnual"] = $this->get_cumplimiento_ppto($intPresupuestoAnual, 
                                                                                         $intRealAnual);
                $arrAuxiliar["horas_anual"] = $intHorasAnual;
                $arrAuxiliar["real_horasAnual"] = $intRealHorasAnual;
                //Calcular diferencia de horas
                $arrAuxiliar["diferencia_horasAnual"] = $intRealHorasAnual - $intHorasAnual;
                 //Calcular porcentaje de cumplimiento de horas
                $arrAuxiliar["cumplimiento_horasAnual"] = $this->get_cumplimiento_ppto($intHorasAnual, 
                                                                                       $intRealHorasAnual);

                //Incrementar acumulados del año
                $intAcumPresupuestoAnual += $intPresupuestoAnual;
                $intAcumHorasAnual += $intHorasAnual;
                $intAcumRealAnual += $intRealAnual;
                $intAcumRealHorasAnual += $intRealHorasAnual;

                //Asignar datos al array
                array_push($arrMecanicos, $arrAuxiliar); 

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
            $arrAuxiliar["horas_enero"] = $intAcumHorasEnero;
            $arrAuxiliar["real_horasEnero"] = $intAcumRealHorasEnero;
            //Calcular diferencia de horas
            $arrAuxiliar["diferencia_horasEnero"] = $intAcumRealHorasEnero - $intAcumHorasEnero;
            //Calcular porcentaje de cumplimiento de horas
            $arrAuxiliar["cumplimiento_horasEnero"] = $this->get_cumplimiento_ppto($intAcumHorasEnero, 
                                                                                   $intAcumRealHorasEnero);
            
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
            $arrAuxiliar["horas_febrero"] = $intAcumHorasFebrero;
            $arrAuxiliar["real_horasFebrero"] = $intAcumRealHorasFebrero;
            //Calcular diferencia de horas
            $arrAuxiliar["diferencia_horasFebrero"] = $intAcumRealHorasFebrero - $intAcumHorasFebrero;
            //Calcular porcentaje de cumplimiento de horas
            $arrAuxiliar["cumplimiento_horasFebrero"] = $this->get_cumplimiento_ppto($intAcumHorasFebrero, 
                                                                                     $intAcumRealHorasFebrero);
           
           
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
            $arrAuxiliar["horas_marzo"] = $intAcumHorasMarzo;
            $arrAuxiliar["real_horasMarzo"] = $intAcumRealHorasMarzo;
            //Calcular diferencia de horas
            $arrAuxiliar["diferencia_horasMarzo"] = $intAcumRealHorasMarzo - $intAcumHorasMarzo;
            //Calcular porcentaje de cumplimiento de horas
            $arrAuxiliar["cumplimiento_horasMarzo"] = $this->get_cumplimiento_ppto($intAcumHorasMarzo, 
                                                                                   $intAcumRealHorasMarzo);
            
            
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
            $arrAuxiliar["horas_abril"] = $intAcumHorasAbril;
            $arrAuxiliar["real_horasAbril"] = $intAcumRealHorasAbril;
            //Calcular diferencia de horas
            $arrAuxiliar["diferencia_horasAbril"] = $intAcumRealHorasAbril - $intAcumHorasAbril;
            //Calcular porcentaje de cumplimiento de horas
            $arrAuxiliar["cumplimiento_horasAbril"] = $this->get_cumplimiento_ppto($intAcumHorasAbril, 
                                                                                   $intAcumRealHorasAbril);
            

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
            $arrAuxiliar["horas_mayo"] = $intAcumHorasMayo;
            $arrAuxiliar["real_horasMayo"] = $intAcumRealHorasMayo;
            //Calcular diferencia de horas
            $arrAuxiliar["diferencia_horasMayo"] = $intAcumRealHorasMayo - $intAcumHorasMayo;
            //Calcular porcentaje de cumplimiento de horas
            $arrAuxiliar["cumplimiento_horasMayo"] = $this->get_cumplimiento_ppto($intAcumHorasMayo, 
                                                                                  $intAcumRealHorasMayo);
            

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
            $arrAuxiliar["horas_junio"] = $intAcumHorasJunio;
            $arrAuxiliar["real_horasJunio"] = $intAcumRealHorasJunio;
            //Calcular diferencia de horas
            $arrAuxiliar["diferencia_horasJunio"] = $intAcumRealHorasJunio - $intAcumHorasJunio;
            //Calcular porcentaje de cumplimiento de horas
            $arrAuxiliar["cumplimiento_horasJunio"] = $this->get_cumplimiento_ppto($intAcumHorasJunio, 
                                                                                   $intAcumRealHorasJunio);
            

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
            $arrAuxiliar["horas_julio"] = $intAcumHorasJulio;
            $arrAuxiliar["real_horasJulio"] = $intAcumRealHorasJulio;
            //Calcular diferencia de horas
            $arrAuxiliar["diferencia_horasJulio"] = $intAcumRealHorasJulio - $intAcumHorasJulio;
            //Calcular porcentaje de cumplimiento de horas
            $arrAuxiliar["cumplimiento_horasJulio"] = $this->get_cumplimiento_ppto($intAcumHorasJulio, 
                                                                                   $intAcumRealHorasJulio);
            

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
            $arrAuxiliar["horas_agosto"] = $intAcumHorasAgosto;
            $arrAuxiliar["real_horasAgosto"] = $intAcumRealHorasAgosto;
            //Calcular diferencia de horas
            $arrAuxiliar["diferencia_horasAgosto"] = $intAcumRealHorasAgosto - $intAcumHorasAgosto;
            //Calcular porcentaje de cumplimiento de horas
            $arrAuxiliar["cumplimiento_horasAgosto"] = $this->get_cumplimiento_ppto($intAcumHorasAgosto, 
                                                                                    $intAcumRealHorasAgosto);
            

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
            $arrAuxiliar["horas_septiembre"] = $intAcumHorasSeptiembre;
            $arrAuxiliar["real_horasSeptiembre"] = $intAcumRealHorasSeptiembre;
            //Calcular diferencia de horas
            $arrAuxiliar["diferencia_horasSeptiembre"] =$intAcumRealHorasSeptiembre - $intAcumHorasSeptiembre;
            //Calcular porcentaje de cumplimiento de horas
            $arrAuxiliar["cumplimiento_horasSeptiembre"] = $this->get_cumplimiento_ppto($intAcumHorasSeptiembre, 
                                                                                   $intAcumRealHorasSeptiembre);
            

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
            $arrAuxiliar["horas_octubre"] = $intAcumHorasOctubre;
            $arrAuxiliar["real_horasOctubre"] = $intAcumRealHorasOctubre;
            //Calcular diferencia de horas
            $arrAuxiliar["diferencia_horasOctubre"] = $intAcumRealHorasOctubre - $intAcumHorasOctubre;
            //Calcular porcentaje de cumplimiento de horas
            $arrAuxiliar["cumplimiento_horasOctubre"] = $this->get_cumplimiento_ppto($intAcumHorasOctubre, 
                                                                                     $intAcumRealHorasOctubre);
            

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
            $arrAuxiliar["horas_noviembre"] = $intAcumHorasNoviembre;
            $arrAuxiliar["real_horasNoviembre"] = $intAcumRealHorasNoviembre;
            //Calcular diferencia de horas
            $arrAuxiliar["diferencia_horasNoviembre"] = $intAcumRealHorasNoviembre - $intAcumHorasNoviembre;
             //Calcular porcentaje de cumplimiento de horas
            $arrAuxiliar["cumplimiento_horasNoviembre"] = $this->get_cumplimiento_ppto($intAcumHorasNoviembre, 
                                                                                  $intAcumRealHorasNoviembre);
            

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
            $arrAuxiliar["horas_diciembre"] = $intAcumHorasDiciembre;
            $arrAuxiliar["real_horasDiciembre"] = $intAcumRealHorasDiciembre;
            //Calcular diferencia de horas
            $arrAuxiliar["diferencia_horasDiciembre"] = $intAcumRealHorasDiciembre - $intAcumHorasDiciembre;
            //Calcular porcentaje de cumplimiento de horas
            $arrAuxiliar["cumplimiento_horasDiciembre"] = $this->get_cumplimiento_ppto($intAcumHorasDiciembre, 
                                                                                  $intAcumRealHorasDiciembre);

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
            $arrAuxiliar["horas_anual"] = $intAcumHorasAnual;
            $arrAuxiliar["real_horasAnual"] = $intAcumRealHorasAnual;
            //Calcular diferencia de horas
            $arrAuxiliar["diferencia_horasAnual"] = $intAcumRealHorasAnual - $intAcumHorasAnual;
            //Calcular porcentaje de cumplimiento de horas
            $arrAuxiliar["cumplimiento_horasAnual"] = $this->get_cumplimiento_ppto($intAcumHorasAnual, 
                                                                                  $intAcumRealHorasAnual);

            //Asignar datos al array
            array_push($arrAcumulados, $arrAuxiliar); 

            //Agregar datos a los array's
            $arrDatos['mecanicos'] = $arrMecanicos;
            $arrDatos['acumulados'] = $arrAcumulados;

        }//Cierre de verificación de información


        //Regresar array con los datos de los presupuestos
        return $arrDatos;
    }

}	