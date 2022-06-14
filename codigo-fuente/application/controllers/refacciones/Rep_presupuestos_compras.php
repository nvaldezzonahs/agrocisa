<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_presupuestos_compras extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('refacciones/rep_presupuestos_compras_model', 'presupuestos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('refacciones/rep_presupuestos_compras', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un porcentaje de cumplimiento con base a un presupuesto y compras*/
	public function get_cumplimiento($presupuesto, $compras)
	{
		if($presupuesto == '0.0000000000'){
			return round(100, 2);
		}
		else{ //Calcular el porcentaje de cumplimiento
			return ( ($compras / $presupuesto) * 100);	
		}
		
	}

	/*Método para generar un archivo XLS con el listado de las licencias*/
	public function get_xls($intAnio) 
	{	

		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
       
		//Seleccionamos pos presupuestos para un año seleccionado
		$result = $this->presupuestos->buscar_presupuestos_compras($intAnio);
		$otdPresupuestosCompras = $result->result();
		
		//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE PRESUPUESTOS DE COMPRAS DE REFACCIONES DEL AÑO '.$intAnio);

		//Preferencias de color de relleno de celda
        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE, 'color' => array('rgb' => 'ffffff')));
    	$arrStyleFuenteNormal = array('font' => array('bold' => FALSE, 'color' => array('rgb' => '000000')));													     
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Formato del celda Porcentaje
        $format_percent =  array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

		//Se agregan las columnas de cabecera
        //Titulo de las columnas
		$objExcel->setActiveSheetIndex(0)->setCellValue('C8', 'ENERO');
		$objExcel->setActiveSheetIndex(0)->setCellValue('G8', 'FEBRERO');
		$objExcel->setActiveSheetIndex(0)->setCellValue('K8', 'MARZO');
		$objExcel->setActiveSheetIndex(0)->setCellValue('O8', 'ABRIL');
		$objExcel->setActiveSheetIndex(0)->setCellValue('S8', 'MAYO');
		$objExcel->setActiveSheetIndex(0)->setCellValue('W8', 'JUNIO');
		$objExcel->setActiveSheetIndex(0)->setCellValue('AA8', 'JULIO');
		$objExcel->setActiveSheetIndex(0)->setCellValue('AE8', 'AGOSTO');
		$objExcel->setActiveSheetIndex(0)->setCellValue('AI8', 'SEPTIEMBRE');
		$objExcel->setActiveSheetIndex(0)->setCellValue('AM8', 'OCTUBRE');
		$objExcel->setActiveSheetIndex(0)->setCellValue('AQ8', 'NOVIEMBRE');
		$objExcel->setActiveSheetIndex(0)->setCellValue('AU8', 'DICIEMBRE');
		$objExcel->setActiveSheetIndex(0)->setCellValue('AY8', 'ANUAL');

		//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()->getStyle('C8:BB8')->applyFromArray($arrStyleBold);

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()->getStyle('C8:BB8')->getFill()->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()->getStyle('C8:BB8')->applyFromArray($arrStyleFuenteColumnas);

        //]Subtitulos de las columnas
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'CÓDIGO')
        		 ->setCellValue('B'.$intPosEncabezados, 'DESCRIPCIÓN')
                 ->setCellValue('C'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('D'.$intPosEncabezados, 'REAL')
                 ->setCellValue('E'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('F'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('G'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('H'.$intPosEncabezados, 'REAL')
                 ->setCellValue('I'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('J'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('K'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('L'.$intPosEncabezados, 'REAL')
                 ->setCellValue('M'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('N'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('O'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('P'.$intPosEncabezados, 'REAL')
                 ->setCellValue('Q'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('R'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('S'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('T'.$intPosEncabezados, 'REAL')
                 ->setCellValue('U'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('V'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('W'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('X'.$intPosEncabezados, 'REAL')
                 ->setCellValue('Y'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('Z'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('AA'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('AB'.$intPosEncabezados, 'REAL')
                 ->setCellValue('AC'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AD'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('AE'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('AF'.$intPosEncabezados, 'REAL')
                 ->setCellValue('AG'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AH'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('AI'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('AJ'.$intPosEncabezados, 'REAL')
                 ->setCellValue('AK'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AL'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('AM'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('AN'.$intPosEncabezados, 'REAL')
                 ->setCellValue('AO'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AP'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('AQ'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('AR'.$intPosEncabezados, 'REAL')
                 ->setCellValue('AS'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AT'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('AU'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('AV'.$intPosEncabezados, 'REAL')
                 ->setCellValue('AW'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AX'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('AY'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('AZ'.$intPosEncabezados, 'REAL')
                 ->setCellValue('BA'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('BB'.$intPosEncabezados, '% CUMPLIMIENTO');

		//Combinar las siguientes celdas
       	$objExcel->setActiveSheetIndex(0)->mergeCells('C8:F8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('G8:J8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('K8:N8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('O8:R8');	
       	$objExcel->setActiveSheetIndex(0)->mergeCells('S8:V8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('W8:Z8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('AA8:AD8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('AE8:AH8'); 
       	$objExcel->setActiveSheetIndex(0)->mergeCells('AI8:AL8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('AM8:AP8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('AQ8:AT8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('AU8:AX8'); 
       	$objExcel->setActiveSheetIndex(0)->mergeCells('AY8:BB8');    

		//Preferencias de color de relleno de celda 
        //$objExcel->getActiveSheet()->getStyle('C8:E8')->getFill()->applyFromArray($arrStyleColumnas);
        $objExcel->getActiveSheet()->getStyle('C8:F8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('G8:J8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('K8:N8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('O8:R8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('S8:V8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('W8:Z8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('AA8:AD8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('AE8:AH8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('AI8:AL8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('AM8:AP8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('AQ8:AT8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('AU8:AX8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('AY8:BB8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);

        $objExcel->getActiveSheet()->getStyle('C8:BB8')->getFill()->applyFromArray($arrStyleColumnas); 
        $objExcel->getActiveSheet()->getStyle('A9:BB9')->getFill()->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdPresupuestosCompras)
		{	
			//Variables para acumular el total de presupuesto por mes 
			$presupuestoEnero = 0;
			$presupuestoFebrero = 0;
			$presupuestoMarzo = 0;
			$presupuestoAbril = 0;
			$presupuestoMayo = 0;
			$presupuestoJunio = 0;
			$presupuestoJulio = 0;
			$presupuestoAgosto = 0;
			$presupuestoSeptiembre = 0;
			$presupuestoOctubre = 0;
			$presupuestoNoviembre = 0;
			$presupuestoDiciembre = 0;

			//Variables para acumular el total de compras por mes 
			$realEnero = 0;
			$realFebrero = 0;
			$realMarzo = 0;
			$realAbril = 0;
			$realMayo = 0;
			$realJunio = 0;
			$realJulio = 0;
			$realAgosto = 0;
			$realSeptiembre = 0;
			$realOctubre = 0;
			$realNoviembre = 0;
			$realDiciembre = 0;

			$presupuestoAnual  = 0;
			$realAnual = 0;

			foreach ($otdPresupuestosCompras as $arrCol)
			{   
				
				//Variable para acumular el presupuesto total registrado para una maquinaria en el año seleccionado
				$PresupuestoTotal = $arrCol->PresupuestoEnero + $arrCol->PresupuestoFebrero + $arrCol->PresupuestoMarzo + $arrCol->PresupuestoAbril + $arrCol->PresupuestoMayo + $arrCol->PresupuestoJunio + $arrCol->PresupuestoJulio + $arrCol->PresupuestoAgosto + $arrCol->PresupuestoSeptiembre + $arrCol->PresupuestoOctubre + $arrCol->PresupuestoNoviembre + $arrCol->PresupuestoDiciembre;

				//Variable para acumular el importe total real registrado para una maquinaria en el año seleccionado
				$RealTotal = $arrCol->RealEnero + $arrCol->RealFebrero + $arrCol->RealMarzo + $arrCol->RealAbril + $arrCol->RealMayo + $arrCol->RealJunio + $arrCol->RealJulio + $arrCol->RealAgosto + $arrCol->RealSeptiembre + $arrCol->RealOctubre + $arrCol->RealNoviembre + $arrCol->RealDiciembre;

				$presupuestoEnero += $arrCol->PresupuestoEnero;
				$presupuestoFebrero += $arrCol->PresupuestoFebrero;
				$presupuestoMarzo += $arrCol->PresupuestoMarzo;
				$presupuestoAbril += $arrCol->PresupuestoAbril;
				$presupuestoMayo += $arrCol->PresupuestoMayo;
				$presupuestoJunio += $arrCol->PresupuestoJunio;
				$presupuestoJulio += $arrCol->PresupuestoJulio;
				$presupuestoAgosto += $arrCol->PresupuestoAgosto;
				$presupuestoSeptiembre += $arrCol->PresupuestoSeptiembre;
				$presupuestoOctubre += $arrCol->PresupuestoOctubre;
				$presupuestoNoviembre += $arrCol->PresupuestoNoviembre;
				$presupuestoDiciembre += $arrCol->PresupuestoDiciembre;

				$realEnero += $arrCol->RealEnero;
				$realFebrero += $arrCol->RealFebrero;
				$realMarzo += $arrCol->RealMarzo;
				$realAbril += $arrCol->RealAbril;
				$realMayo += $arrCol->RealMayo;
				$realJunio += $arrCol->RealJunio;
				$realJulio += $arrCol->RealJulio;
				$realAgosto += $arrCol->RealAgosto;
				$realSeptiembre += $arrCol->RealSeptiembre;
				$realOctubre += $arrCol->RealOctubre;
				$realNoviembre += $arrCol->RealNoviembre;
				$realDiciembre += $arrCol->RealDiciembre; 
 

				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
						 ->setCellValue('A'.$intFila, $arrCol->codigo)
					     ->setCellValue('B'.$intFila, $arrCol->descripcion)

					     ->setCellValue('C'.$intFila, $arrCol->PresupuestoEnero)
					     ->setCellValue('D'.$intFila, $arrCol->RealEnero)
					     ->setCellValue('E'.$intFila, $arrCol->RealEnero - $arrCol->PresupuestoEnero)
					     ->setCellValue('F'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoEnero, $arrCol->RealEnero))

					     ->setCellValue('G'.$intFila, $arrCol->PresupuestoFebrero)
						 ->setCellValue('H'.$intFila, $arrCol->RealFebrero)
						 ->setCellValue('I'.$intFila, $arrCol->RealFebrero - $arrCol->PresupuestoFebrero)
						 ->setCellValue('J'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoFebrero, $arrCol->RealFebrero))

					     ->setCellValue('K'.$intFila, $arrCol->PresupuestoMarzo)
					     ->setCellValue('L'.$intFila, $arrCol->RealMarzo)
					     ->setCellValue('M'.$intFila, $arrCol->RealMarzo - $arrCol->PresupuestoMarzo)
					     ->setCellValue('N'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoMarzo, $arrCol->RealMarzo))

					     ->setCellValue('O'.$intFila, $arrCol->PresupuestoAbril)
					     ->setCellValue('P'.$intFila, $arrCol->RealAbril)
					     ->setCellValue('Q'.$intFila, $arrCol->RealAbril - $arrCol->PresupuestoAbril)
					     ->setCellValue('R'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoAbril, $arrCol->RealAbril))

					     ->setCellValue('S'.$intFila, $arrCol->PresupuestoMayo)
					     ->setCellValue('T'.$intFila, $arrCol->RealMayo)
					     ->setCellValue('U'.$intFila, $arrCol->RealMayo - $arrCol->PresupuestoMayo)
					     ->setCellValue('V'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoMayo, $arrCol->RealMayo))

					     ->setCellValue('W'.$intFila, $arrCol->PresupuestoJunio)
					     ->setCellValue('X'.$intFila, $arrCol->RealJunio)
					     ->setCellValue('Y'.$intFila, $arrCol->RealJunio - $arrCol->PresupuestoJunio)
					     ->setCellValue('Z'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoJunio, $arrCol->RealJunio))

					     ->setCellValue('AA'.$intFila, $arrCol->PresupuestoJulio)
						 ->setCellValue('AB'.$intFila, $arrCol->RealJulio)
						 ->setCellValue('AC'.$intFila, $arrCol->RealJulio - $arrCol->PresupuestoJulio)
						 ->setCellValue('AD'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoJulio, $arrCol->RealJulio))

					     ->setCellValue('AE'.$intFila, $arrCol->PresupuestoAgosto)
					     ->setCellValue('AF'.$intFila, $arrCol->RealAgosto)
					     ->setCellValue('AG'.$intFila, $arrCol->RealAgosto - $arrCol->PresupuestoAgosto)
					     ->setCellValue('AH'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoAgosto, $arrCol->RealAgosto))

					     ->setCellValue('AI'.$intFila, $arrCol->PresupuestoSeptiembre)
					     ->setCellValue('AJ'.$intFila, $arrCol->RealSeptiembre)
					     ->setCellValue('AK'.$intFila, $arrCol->RealSeptiembre - $arrCol->PresupuestoSeptiembre)
					     ->setCellValue('AL'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoSeptiembre, $arrCol->RealSeptiembre))

					     ->setCellValue('AM'.$intFila, $arrCol->PresupuestoOctubre)
					     ->setCellValue('AN'.$intFila, $arrCol->RealOctubre)
					     ->setCellValue('AO'.$intFila, $arrCol->RealOctubre - $arrCol->PresupuestoOctubre)
					     ->setCellValue('AP'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoOctubre, $arrCol->RealOctubre))

					     ->setCellValue('AQ'.$intFila, $arrCol->PresupuestoNoviembre)
					     ->setCellValue('AR'.$intFila, $arrCol->RealNoviembre)
					     ->setCellValue('AS'.$intFila, $arrCol->RealNoviembre - $arrCol->PresupuestoNoviembre)
					     ->setCellValue('AT'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoNoviembre, $arrCol->RealNoviembre))

					     ->setCellValue('AU'.$intFila, $arrCol->PresupuestoDiciembre)
					     ->setCellValue('AV'.$intFila, $arrCol->RealDiciembre)
					     ->setCellValue('AW'.$intFila, $arrCol->RealDiciembre - $arrCol->PresupuestoDiciembre)
					     ->setCellValue('AX'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoDiciembre, $arrCol->RealDiciembre))

					     ->setCellValue('AY'.$intFila, $PresupuestoTotal)
					     ->setCellValue('AZ'.$intFila, $RealTotal)
					     ->setCellValue('BA'.$intFila, $RealTotal - $PresupuestoTotal)
					     ->setCellValue('BB'.$intFila, $this->get_cumplimiento($PresupuestoTotal, $RealTotal));
					     
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Insertar totales por mes
			$presupuestoAnual = $presupuestoEnero +
								$presupuestoFebrero +
								$presupuestoMarzo +
								$presupuestoAbril +
								$presupuestoMayo +
								$presupuestoJunio +
								$presupuestoJulio +
								$presupuestoAgosto +
								$presupuestoSeptiembre +
								$presupuestoOctubre +
								$presupuestoNoviembre +
								$presupuestoDiciembre;

			$realAnual = $realEnero +
						$realFebrero +
						$realMarzo +
						$realAbril +
						$realMayo +
						$realJunio +
						$realJulio +
						$realAgosto +
						$realSeptiembre +
						$realOctubre +
						$realNoviembre +
						$realDiciembre;					

			//Agregar información del total
	        $objExcel->setActiveSheetIndex(0)->setCellValue('C'.$intFila,  $presupuestoEnero);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('D'.$intFila,  $realEnero);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('E'.$intFila,  $realEnero - $presupuestoEnero);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('F'.$intFila,  $this->get_cumplimiento($presupuestoEnero, $realEnero));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('G'.$intFila,  $presupuestoFebrero);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('H'.$intFila,  $realFebrero);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('I'.$intFila,  $realFebrero - $presupuestoFebrero);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('J'.$intFila,  $this->get_cumplimiento($presupuestoFebrero, $realFebrero));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('K'.$intFila,  $presupuestoMarzo);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('L'.$intFila,  $realMarzo);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('M'.$intFila,  $realMarzo - $presupuestoMarzo);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('N'.$intFila,  $this->get_cumplimiento($presupuestoMarzo, $realMarzo));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('O'.$intFila,  $presupuestoAbril);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('P'.$intFila,  $realAbril);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('Q'.$intFila,  $realAbril - $presupuestoAbril);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('R'.$intFila,  $this->get_cumplimiento($presupuestoAbril, $realAbril));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('S'.$intFila,  $presupuestoMayo);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('T'.$intFila,  $realMayo);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('U'.$intFila,  $realMayo - $presupuestoMayo);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('V'.$intFila,  $this->get_cumplimiento($presupuestoMayo, $realMayo));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('W'.$intFila,  $presupuestoJunio);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('X'.$intFila,  $realJunio);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('Y'.$intFila,  $realJunio - $presupuestoJunio);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('Z'.$intFila,  $this->get_cumplimiento($presupuestoJunio, $realJunio));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('AA'.$intFila,  $presupuestoJulio);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AB'.$intFila,  $realJulio);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AC'.$intFila,  $realJulio - $presupuestoJulio);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AD'.$intFila,  $this->get_cumplimiento($presupuestoJulio, $realJulio));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('AE'.$intFila,  $presupuestoAgosto);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AF'.$intFila,  $realAgosto);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AG'.$intFila,  $realAgosto - $presupuestoAgosto);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AH'.$intFila,  $this->get_cumplimiento($presupuestoAgosto, $realAgosto));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('AI'.$intFila,  $presupuestoSeptiembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AJ'.$intFila,  $realSeptiembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AK'.$intFila,  $realSeptiembre - $presupuestoSeptiembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AL'.$intFila,  $this->get_cumplimiento($presupuestoSeptiembre, $realSeptiembre));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('AM'.$intFila,  $presupuestoOctubre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AN'.$intFila,  $realOctubre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AO'.$intFila,  $realOctubre - $presupuestoOctubre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AP'.$intFila,  $this->get_cumplimiento($presupuestoOctubre, $realOctubre));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('AQ'.$intFila,  $presupuestoNoviembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AR'.$intFila,  $realNoviembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AS'.$intFila,  $realNoviembre - $presupuestoNoviembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AT'.$intFila,  $this->get_cumplimiento($presupuestoNoviembre, $realNoviembre));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('AU'.$intFila,  $presupuestoDiciembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AV'.$intFila,  $realDiciembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AW'.$intFila,  $realDiciembre - $presupuestoDiciembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AX'.$intFila,  $this->get_cumplimiento($presupuestoDiciembre, $realDiciembre));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('AY'.$intFila,  $presupuestoAnual);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AZ'.$intFila,  $realAnual);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('BA'.$intFila, 	$realAnual - $presupuestoAnual);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('BB'.$intFila,  $this->get_cumplimiento($presupuestoAnual, $realAnual));
		}



		//Cambiar contenido de las celdas que contendrán formato moneda
        $objExcel->getActiveSheet()->getStyle('C'.$intFilaInicial.':'.'E'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('G'.$intFilaInicial.':'.'I'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('K'.$intFilaInicial.':'.'M'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('N'.$intFilaInicial.':'.'N'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('O'.$intFilaInicial.':'.'Q'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('R'.$intFilaInicial.':'.'R'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('S'.$intFilaInicial.':'.'U'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('V'.$intFilaInicial.':'.'V'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('W'.$intFilaInicial.':'.'Y'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('Z'.$intFilaInicial.':'.'Z'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AA'.$intFilaInicial.':'.'AC'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AD'.$intFilaInicial.':'.'AD'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AE'.$intFilaInicial.':'.'AG'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AH'.$intFilaInicial.':'.'AH'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AI'.$intFilaInicial.':'.'AK'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AL'.$intFilaInicial.':'.'AL'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AM'.$intFilaInicial.':'.'AO'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AP'.$intFilaInicial.':'.'AP'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AQ'.$intFilaInicial.':'.'AS'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AT'.$intFilaInicial.':'.'AT'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AU'.$intFilaInicial.':'.'AW'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AX'.$intFilaInicial.':'.'AX'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AY'.$intFilaInicial.':'.'BA'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('BB'.$intFilaInicial.':'.'BB'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');                   
        $objExcel->getActiveSheet()->getStyle('C'.$intFilaInicial.':'.'BB'.$intFila)->getAlignment()->applyFromArray($arrStyleAlignmentRight);

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'presupuestos_compras.xls', 'presupuestos_compras', $intFila);
        
	}

}	