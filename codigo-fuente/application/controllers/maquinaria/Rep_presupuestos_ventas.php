<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_presupuestos_ventas extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('maquinaria/rep_presupuestos_ventas_model', 'presupuestos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('maquinaria/rep_presupuestos_ventas', $arrDatos);
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
		$result = $this->presupuestos->buscar_presupuestos_ventas($intAnio);
		$otdPresupuestosCompras = $result->result();
		
		//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE PRESUPUESTOS DE VENTAS DE MAQUINARIA DEL AÑO '.$intAnio);

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
		$objExcel->setActiveSheetIndex(0)->setCellValue('D8', 'ENERO');
		$objExcel->setActiveSheetIndex(0)->setCellValue('H8', 'FEBRERO');
		$objExcel->setActiveSheetIndex(0)->setCellValue('L8', 'MARZO');
		$objExcel->setActiveSheetIndex(0)->setCellValue('P8', 'ABRIL');
		$objExcel->setActiveSheetIndex(0)->setCellValue('T8', 'MAYO');
		$objExcel->setActiveSheetIndex(0)->setCellValue('X8', 'JUNIO');
		$objExcel->setActiveSheetIndex(0)->setCellValue('AB8', 'JULIO');
		$objExcel->setActiveSheetIndex(0)->setCellValue('AF8', 'AGOSTO');
		$objExcel->setActiveSheetIndex(0)->setCellValue('AJ8', 'SEPTIEMBRE');
		$objExcel->setActiveSheetIndex(0)->setCellValue('AN8', 'OCTUBRE');
		$objExcel->setActiveSheetIndex(0)->setCellValue('AR8', 'NOVIEMBRE');
		$objExcel->setActiveSheetIndex(0)->setCellValue('AV8', 'DICIEMBRE');
		$objExcel->setActiveSheetIndex(0)->setCellValue('AZ8', 'ANUAL');

		//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()->getStyle('D8:BC8')->applyFromArray($arrStyleBold);

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()->getStyle('D8:BC8')->getFill()->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()->getStyle('D8:BC8')->applyFromArray($arrStyleFuenteColumnas);

        //]Subtitulos de las columnas
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'VENDEDOR')
        		 ->setCellValue('B'.$intPosEncabezados, 'CÓDIGO')
        		 ->setCellValue('C'.$intPosEncabezados, 'DESCRIPCIÓN')
                 ->setCellValue('D'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('E'.$intPosEncabezados, 'REAL')
                 ->setCellValue('F'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('G'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('H'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('I'.$intPosEncabezados, 'REAL')
                 ->setCellValue('J'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('K'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('L'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('M'.$intPosEncabezados, 'REAL')
                 ->setCellValue('N'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('O'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('P'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('Q'.$intPosEncabezados, 'REAL')
                 ->setCellValue('R'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('S'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('T'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('U'.$intPosEncabezados, 'REAL')
                 ->setCellValue('V'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('W'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('X'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('Y'.$intPosEncabezados, 'REAL')
                 ->setCellValue('Z'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AA'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('AB'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('AC'.$intPosEncabezados, 'REAL')
                 ->setCellValue('AD'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AE'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('AF'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('AG'.$intPosEncabezados, 'REAL')
                 ->setCellValue('AH'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AI'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('AJ'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('AK'.$intPosEncabezados, 'REAL')
                 ->setCellValue('AL'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AM'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('AN'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('AO'.$intPosEncabezados, 'REAL')
                 ->setCellValue('AP'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AQ'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('AR'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('AS'.$intPosEncabezados, 'REAL')
                 ->setCellValue('AT'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AU'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('AV'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('AW'.$intPosEncabezados, 'REAL')
                 ->setCellValue('AX'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('AY'.$intPosEncabezados, '% CUMPLIMIENTO')
                 ->setCellValue('AZ'.$intPosEncabezados, 'PRESUPUESTADO')
                 ->setCellValue('BA'.$intPosEncabezados, 'REAL')
                 ->setCellValue('BB'.$intPosEncabezados, 'DIFERENCIA')
                 ->setCellValue('BC'.$intPosEncabezados, '% CUMPLIMIENTO');

		//Combinar las siguientes celdas
       	$objExcel->setActiveSheetIndex(0)->mergeCells('D8:G8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('H8:K8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('L8:O8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('P8:S8');	
       	$objExcel->setActiveSheetIndex(0)->mergeCells('T8:W8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('X8:AA8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('AB8:AE8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('AF8:AI8'); 
       	$objExcel->setActiveSheetIndex(0)->mergeCells('AJ8:AM8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('AN8:AQ8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('AR8:AU8');
       	$objExcel->setActiveSheetIndex(0)->mergeCells('AV8:AY8'); 
       	$objExcel->setActiveSheetIndex(0)->mergeCells('AZ8:BC8');    

		//Preferencias de color de relleno de celda 
        //$objExcel->getActiveSheet()->getStyle('C8:E8')->getFill()->applyFromArray($arrStyleColumnas);
        $objExcel->getActiveSheet()->getStyle('D8:G8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('H8:K8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('L8:O8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('P8:S8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('T8:W8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('X8:AA8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('AB8:AE8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('AF8:AI8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('AJ8:AM8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('AN8:AQ8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('AR8:AU8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('AV8:AY8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet()->getStyle('AZ8:BC8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);

        $objExcel->getActiveSheet()->getStyle('D8:BC8')->getFill()->applyFromArray($arrStyleColumnas); 
        $objExcel->getActiveSheet()->getStyle('A9:BC9')->getFill()->applyFromArray($arrStyleColumnas);

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

		//Variables para acumular totales
		$presupuestoAnual = 0;
		$realAnual = 0;

		//Si hay información
		if ($otdPresupuestosCompras)
		{	
			

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
						 ->setCellValue('A'.$intFila, $arrCol->vendedor)
					     ->setCellValue('B'.$intFila, $arrCol->codigo)
					     ->setCellValue('C'.$intFila, $arrCol->descripcion_corta)
					     
					     ->setCellValue('D'.$intFila, $arrCol->PresupuestoEnero)
					     ->setCellValue('E'.$intFila, $arrCol->RealEnero)
					     ->setCellValue('F'.$intFila, $arrCol->RealEnero - $arrCol->PresupuestoEnero)
					     ->setCellValue('G'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoEnero, $arrCol->RealEnero))

					     ->setCellValue('H'.$intFila, $arrCol->PresupuestoFebrero)
						 ->setCellValue('I'.$intFila, $arrCol->RealFebrero)
						 ->setCellValue('J'.$intFila, $arrCol->RealFebrero - $arrCol->PresupuestoFebrero)
						 ->setCellValue('K'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoFebrero, $arrCol->RealFebrero))

					     ->setCellValue('L'.$intFila, $arrCol->PresupuestoMarzo)
					     ->setCellValue('M'.$intFila, $arrCol->RealMarzo)
					     ->setCellValue('N'.$intFila, $arrCol->RealMarzo - $arrCol->PresupuestoMarzo)
					     ->setCellValue('O'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoMarzo, $arrCol->RealMarzo))

					     ->setCellValue('P'.$intFila, $arrCol->PresupuestoAbril)
					     ->setCellValue('Q'.$intFila, $arrCol->RealAbril)
					     ->setCellValue('R'.$intFila, $arrCol->RealAbril - $arrCol->PresupuestoAbril)
					     ->setCellValue('S'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoAbril, $arrCol->RealAbril))

					     ->setCellValue('T'.$intFila, $arrCol->PresupuestoMayo)
					     ->setCellValue('U'.$intFila, $arrCol->RealMayo)
					     ->setCellValue('V'.$intFila, $arrCol->RealMayo - $arrCol->PresupuestoMayo)
					     ->setCellValue('W'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoMayo, $arrCol->RealMayo))

					     ->setCellValue('X'.$intFila, $arrCol->PresupuestoJunio)
					     ->setCellValue('Y'.$intFila, $arrCol->RealJunio)
					     ->setCellValue('Z'.$intFila, $arrCol->RealJunio - $arrCol->PresupuestoJunio)
					     ->setCellValue('AA'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoJunio, $arrCol->RealJunio))

					     ->setCellValue('AB'.$intFila, $arrCol->PresupuestoJulio)
						 ->setCellValue('AC'.$intFila, $arrCol->RealJulio)
						 ->setCellValue('AD'.$intFila, $arrCol->RealJulio - $arrCol->PresupuestoJulio)
						 ->setCellValue('AE'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoJulio, $arrCol->RealJulio))

					     ->setCellValue('AF'.$intFila, $arrCol->PresupuestoAgosto)
					     ->setCellValue('AG'.$intFila, $arrCol->RealAgosto)
					     ->setCellValue('AH'.$intFila, $arrCol->RealAgosto - $arrCol->PresupuestoAgosto)
					     ->setCellValue('AI'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoAgosto, $arrCol->RealAgosto))

					     ->setCellValue('AJ'.$intFila, $arrCol->PresupuestoSeptiembre)
					     ->setCellValue('AK'.$intFila, $arrCol->RealSeptiembre)
					     ->setCellValue('AL'.$intFila, $arrCol->RealSeptiembre - $arrCol->PresupuestoSeptiembre)
					     ->setCellValue('AM'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoSeptiembre, $arrCol->RealSeptiembre))

					     ->setCellValue('AN'.$intFila, $arrCol->PresupuestoOctubre)
					     ->setCellValue('AO'.$intFila, $arrCol->RealOctubre)
					     ->setCellValue('AP'.$intFila, $arrCol->RealOctubre - $arrCol->PresupuestoOctubre)
					     ->setCellValue('AQ'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoOctubre, $arrCol->RealOctubre))

					     ->setCellValue('AR'.$intFila, $arrCol->PresupuestoNoviembre)
					     ->setCellValue('AS'.$intFila, $arrCol->RealNoviembre)
					     ->setCellValue('AT'.$intFila, $arrCol->RealNoviembre - $arrCol->PresupuestoNoviembre)
					     ->setCellValue('AU'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoNoviembre, $arrCol->RealNoviembre))

					     ->setCellValue('AV'.$intFila, $arrCol->PresupuestoDiciembre)
					     ->setCellValue('AW'.$intFila, $arrCol->RealDiciembre)
					     ->setCellValue('AX'.$intFila, $arrCol->RealDiciembre - $arrCol->PresupuestoDiciembre)
					     ->setCellValue('AY'.$intFila, $this->get_cumplimiento($arrCol->PresupuestoDiciembre, $arrCol->RealDiciembre))

					     ->setCellValue('AZ'.$intFila, $PresupuestoTotal)
					     ->setCellValue('BA'.$intFila, $RealTotal)
					     ->setCellValue('BB'.$intFila, $RealTotal - $PresupuestoTotal)
					     ->setCellValue('BC'.$intFila, $this->get_cumplimiento($PresupuestoTotal, $RealTotal));
					     
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
	        $objExcel->setActiveSheetIndex(0)->setCellValue('D'.$intFila,  $presupuestoEnero);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('E'.$intFila,  $realEnero);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('F'.$intFila,  $realEnero - $presupuestoEnero);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('G'.$intFila,  $this->get_cumplimiento($presupuestoEnero, $realEnero));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('H'.$intFila,  $presupuestoFebrero);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('I'.$intFila,  $realFebrero);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('J'.$intFila,  $realFebrero - $presupuestoFebrero);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('K'.$intFila,  $this->get_cumplimiento($presupuestoFebrero, $realFebrero));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('L'.$intFila,  $presupuestoMarzo);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('M'.$intFila,  $realMarzo);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('N'.$intFila,  $realMarzo - $presupuestoMarzo);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('O'.$intFila,  $this->get_cumplimiento($presupuestoMarzo, $realMarzo));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('P'.$intFila,  $presupuestoAbril);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('Q'.$intFila,  $realAbril);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('R'.$intFila,  $realAbril - $presupuestoAbril);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('S'.$intFila,  $this->get_cumplimiento($presupuestoAbril, $realAbril));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('T'.$intFila,  $presupuestoMayo);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('U'.$intFila,  $realMayo);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('V'.$intFila,  $realMayo - $presupuestoMayo);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('W'.$intFila,  $this->get_cumplimiento($presupuestoMayo, $realMayo));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('X'.$intFila,  $presupuestoJunio);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('Y'.$intFila,  $realJunio);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('Z'.$intFila,  $realJunio - $presupuestoJunio);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AA'.$intFila,  $this->get_cumplimiento($presupuestoJunio, $realJunio));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('AB'.$intFila,  $presupuestoJulio);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AC'.$intFila,  $realJulio);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AD'.$intFila,  $realJulio - $presupuestoJulio);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AE'.$intFila,  $this->get_cumplimiento($presupuestoJulio, $realJulio));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('AF'.$intFila,  $presupuestoAgosto);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AG'.$intFila,  $realAgosto);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AH'.$intFila,  $realAgosto - $presupuestoAgosto);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AI'.$intFila,  $this->get_cumplimiento($presupuestoAgosto, $realAgosto));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('AJ'.$intFila,  $presupuestoSeptiembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AK'.$intFila,  $realSeptiembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AL'.$intFila,  $realSeptiembre - $presupuestoSeptiembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AM'.$intFila,  $this->get_cumplimiento($presupuestoSeptiembre, $realSeptiembre));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('AN'.$intFila,  $presupuestoOctubre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AO'.$intFila,  $realOctubre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AP'.$intFila,  $realOctubre - $presupuestoOctubre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AQ'.$intFila,  $this->get_cumplimiento($presupuestoOctubre, $realOctubre));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('AR'.$intFila,  $presupuestoNoviembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AS'.$intFila,  $realNoviembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AT'.$intFila,  $realNoviembre - $presupuestoNoviembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AU'.$intFila,  $this->get_cumplimiento($presupuestoNoviembre, $realNoviembre));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('AV'.$intFila,  $presupuestoDiciembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AW'.$intFila,  $realDiciembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AX'.$intFila,  $realDiciembre - $presupuestoDiciembre);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('AY'.$intFila,  $this->get_cumplimiento($presupuestoDiciembre, $realDiciembre));

	        $objExcel->setActiveSheetIndex(0)->setCellValue('AZ'.$intFila,  $presupuestoAnual);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('BA'.$intFila,  $realAnual);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('BB'.$intFila, 	$realAnual - $presupuestoAnual);
	        $objExcel->setActiveSheetIndex(0)->setCellValue('BC'.$intFila,  $this->get_cumplimiento($presupuestoAnual, $realAnual));				
		}

		

		//Cambiar contenido de las celdas que contendrán formato moneda
        $objExcel->getActiveSheet()->getStyle('D'.$intFilaInicial.':'.'F'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('H'.$intFilaInicial.':'.'J'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('K'.$intFilaInicial.':'.'K'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('L'.$intFilaInicial.':'.'N'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('O'.$intFilaInicial.':'.'O'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('P'.$intFilaInicial.':'.'R'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('S'.$intFilaInicial.':'.'S'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('T'.$intFilaInicial.':'.'V'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('W'.$intFilaInicial.':'.'W'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('X'.$intFilaInicial.':'.'Z'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AA'.$intFilaInicial.':'.'AA'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AB'.$intFilaInicial.':'.'AD'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AE'.$intFilaInicial.':'.'AE'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AF'.$intFilaInicial.':'.'AH'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AI'.$intFilaInicial.':'.'AI'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AJ'.$intFilaInicial.':'.'AL'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AM'.$intFilaInicial.':'.'AM'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AN'.$intFilaInicial.':'.'AP'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AQ'.$intFilaInicial.':'.'AQ'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AR'.$intFilaInicial.':'.'AT'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AU'.$intFilaInicial.':'.'AU'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AV'.$intFilaInicial.':'.'AX'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AY'.$intFilaInicial.':'.'AY'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');
        $objExcel->getActiveSheet()->getStyle('AZ'.$intFilaInicial.':'.'BB'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00;[Red]-$#,##0.00');
        $objExcel->getActiveSheet()->getStyle('BC'.$intFilaInicial.':'.'BC'.$intFila)->getNumberFormat()->setFormatCode('#,##0.00; [Red]-#,##0.00');                   
        $objExcel->getActiveSheet()->getStyle('D'.$intFilaInicial.':'.'BC'.$intFila)->getAlignment()->applyFromArray($arrStyleAlignmentRight);

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'presupuestos_ventas.xls', 'presupuestos_ventas', $intFila);
        
	}

}	