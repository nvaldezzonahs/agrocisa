<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_inventario_herramientas extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('inventarios_fisicos/rep_inventario_herramientas_model', 'rep_inventario_herramientas');
		$this->load->model('administracion/empresas_model', 'empresas');
		$this->load->model('administracion/sucursales_model', 'sucursales');
		$this->load->model('servicio/mecanicos_model', 'mecanicos');

	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('inventarios_fisicos/rep_inventario_herramientas', $arrDatos);
	}


	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($dteFechaCorte, $intMecanicoID) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para asignar título de la fecha
		$strTituloFecha = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Variable que se utiliza pra asignar el id actual del mecánico
		$intMecanicoIDActual = 0;
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;

		//Seleccionar los datos del registro que coincide con la fecha
		$otdResultado = $this->rep_inventario_herramientas->consultar($dteFechaCorte, $intMecanicoID);
		//Si existe rango de fechas
		if($dteFechaCorte != '0000-00-00')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloFecha = 'AL '.$this->get_fecha_formato_letra($dteFechaCorte, 'C');
		}
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  'INVENTARIO DE HERRAMIENTAS '.$strTituloFecha;		
		//Agregar la primer pagina
		$pdf->AddPage();

		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Crea los titulos de la cabecera
		$arrCabecera = array(utf8_decode('MECÁNICO'));
		$arrCabecera2 = array(utf8_decode('HERRAMIENTA'), 'FECHA', 'KARDEX');
		//Establece el ancho de las columnas de cabecera
		$arrAnchura = array(190);
		$arrAnchura2 = array(150, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$arrAlineacion = array('L');
		$arrAlineacion2 = array('L', 'L', 'R');
		
		//Recorre el array de titulos de encabezado para crearlos
		for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
		{
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//inserta los titulos de la cabecera
			$pdf->Cell($arrAnchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, $arrAlineacion[$intCont], TRUE);
		}
		$pdf->Ln(); //Deja un salto de línea
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAnchura);

		//Recorre el array de titulos de encabezado para crearlos
		for ($intCont = 0; $intCont < count($arrCabecera2); $intCont++)
		{
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//inserta los titulos de la cabecera
			$pdf->Cell($arrAnchura2[$intCont], 7, $arrCabecera2[$intCont], 1, 0, $arrAlineacion2[$intCont], TRUE);
		}
		$pdf->Ln(); //Deja un salto de línea
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAnchura2);

		//Array que se utiliza para agregar los datos de un detalle
		$arrAuxiliar = array();

		//Si hay información
		if ($otdResultado)
		{
			//Variable que utiliza para asignar el ID de la herramienta actual
			$intHerramientaID = 0;
			//Variable para asignar la cantidad incrementada o decrementada de las herramientas
			$numCantidad = 0;
			//Variable para asignar el código y descripción de una herramienta
			$strHerramienta = '';
			//Variable para asignar la fecha del último movimiento de una herramienta
			$strFecha = '';

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdResultado as $arrCol)
			{

				//Si es el primer registro y no existe id del mecánico
      			if($intContador === 0 && $arrCol->mecanico_id === NULL)
      			{
					//Asignar id del mecánico actual
      				$intMecanicoIDActual = $arrCol->mecanico_id;
      			}

      			//Si el mecánico actual es igual a cero (primer mecánico)
	      		if ($intMecanicoIDActual === 0 && $arrCol->mecanico_id > 0)
	      		{
	      			//Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
	      			$pdf->Row(array(
									 utf8_decode($arrCol->mecanico)
									), 
									$arrCabecera, 
									$arrAnchura, 
									$arrAlineacion, 
									FALSE, 
									FALSE, 
									$arrAlineacion, 
									'ClippedCell'
							);
							
	      			//Asignar id del mecánico actual
	      			$intMecanicoIDActual = $arrCol->mecanico_id;
	      		}
   				
   				//Si la herramientaID cambió
   				if($intHerramientaID != $arrCol->herramienta_id && $intHerramientaID != 0)
   				{	
   					//Cambiar el volumen de la fuente a normal
   				    $pdf->strTipoLetraTabla = '';
   					//Impresión de variables
					$pdf->Row(array(utf8_decode($strHerramienta), 
												$strFecha,  
												number_format($numCantidad, 2) 			
									), 
									$arrCabecera2, 
									$arrAnchura2, 
									$arrAlineacion2, 
									FALSE, 
									FALSE, 
									$arrAlineacion2, 
									'ClippedCell'
							);

					//Reinicializar variables
					$numCantidad = 0;
   				}

   				//Si el tipo de movimiento es una salida se suma la cantidad. Caso contrario se resta
   				if($arrCol->tipo_movimiento < 11){
					$numCantidad += $arrCol->cantidad;
				}
				else{	
					$numCantidad -= $arrCol->cantidad;
				}

				//Asignación de valores
				$intHerramientaID = $arrCol->herramienta_id;
				$strHerramienta = $arrCol->codigo.' - '.$arrCol->descripcion;
				$strFecha = $arrCol->fecha;	

				//Si el mecánico actual es diferente al anterior
	      		if($intMecanicoIDActual != $arrCol->mecanico_id && $arrCol->mecanico_id !== NULL)
	      		{	
	      			$pdf->Ln(2); //Deja un salto de línea
	      			//Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
	      			$pdf->Row(array(
									 utf8_decode($arrCol->mecanico)
									), 
									$arrCabecera, 
									$arrAnchura, 
									$arrAlineacion, 
									FALSE, 
									FALSE, 
									$arrAlineacion, 
									'ClippedCell'
							);
	      			//Asignar id del mecánico actual
	      			$intMecanicoIDActual = $arrCol->mecanico_id;	
	      		}

			}

			//Agregar datos del último insumo
   			if($intHerramientaID != 0)
			{
				//Cambiar el volumen de la fuente a normal
				$pdf->strTipoLetraTabla = '';
				//Impresión de variables
				$pdf->Row(array(utf8_decode($strHerramienta), 
											$strFecha,  
											number_format($numCantidad, 2) 			
								), 
									$arrCabecera2, 
									$arrAnchura2, 
									$arrAlineacion2, 
									FALSE, 
									FALSE, 
									$arrAlineacion2, 
									'ClippedCell'
							);
			}
	
		}
		
		//Ejecutar la salida del reporte
		$pdf->Output('reporte_inventario_herramientas.pdf','I');	            
		
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaCorte, $intMecanicoID) 
	{	
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
		//Seleccionar los datos del registro que coincide con la fecha
		$otdResultado = $this->rep_inventario_herramientas->consultar($dteFechaCorte, $intMecanicoID);
		//var_dump($otdResultado);

		//Si existe rango de fechas
		if($dteFechaCorte != '0000-00-00')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloFecha = 'AL '.$this->get_fecha_formato_letra($dteFechaCorte, 'C');
		}
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'INVENTARIO '.$strTituloFecha );
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'MECÁNICO')
        		 ->setCellValue('B'.$intPosEncabezados, 'CÓDIGO')
                 ->setCellValue('C'.$intPosEncabezados, 'HERRAMIENTA')
                 ->setCellValue('D'.$intPosEncabezados, 'FECHA')
                 ->setCellValue('E'.$intPosEncabezados, 'KARDEX');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));
        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));
        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
        			->getStyle('A9:E9')
        			->getFill()
        			->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{
			//Variable para asignar la herramienta ID
			$intHerramientaID = 0;
			//Variable para asignar la cantidad del KARDEX
			$numCantidad = 0;
			//Variable para asignar el nombre del mecánico
			$strMecanico = '';
			//Variable para asignar el código de una herramienta
			$strCodigo = '';
			//Variable para asignar la descripción de una herramienta
			$strHerramienta = '';
			//Variable para asignar la fecha del último movimiento de una herramienta
			$strFecha = '';

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdResultado as $arrCol)
			{

				//Si el insumoID cambió
   				if($intHerramientaID != $arrCol->herramienta_id && $intHerramientaID != 0)
   				{	
   					
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFila, $strMecanico)
                         ->setCellValue('B'.$intFila, $strCodigo)
                         ->setCellValue('C'.$intFila, $strHerramienta)
                         ->setCellValue('D'.$intFila, $strFecha)
                         ->setCellValue('E'.$intFila, $numCantidad)
                         ;

					//Reinicializar variables
					$numCantidad = 0;

					//Incrementar el contador por cada registro
					$intContador++;
                	//Incrementar el indice para escribir los datos del siguiente registro
                	$intFila++; 

   				}

   				if($arrCol->tipo_movimiento < 11){
					$numCantidad += $arrCol->cantidad;
				}
				else{	
					$numCantidad -= $arrCol->cantidad;
				}

				$intHerramientaID = $arrCol->herramienta_id;
				$strMecanico = $arrCol->mecanico;
				$strCodigo = $arrCol->codigo;
				$strHerramienta = $arrCol->descripcion;
				$strFecha = $arrCol->fecha;			

			}

			//Agregar datos de la última herramienta
   			if($intHerramientaID != 0)
			{
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFila, $strMecanico)
                         ->setCellValue('B'.$intFila, $strCodigo)
                         ->setCellValue('C'.$intFila, $strHerramienta)
                         ->setCellValue('D'.$intFila, $strFecha)
                         ->setCellValue('E'.$intFila, $numCantidad)
                         ;
			}

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
                	 ->getNumberFormat()
            		 ->setFormatCode('#,##0.00');
            $objExcel->getActiveSheet()
                	 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);


		}

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'reporte_inventario_herramientas.xls', 'inventario de herramientas', $intFila);

	}

}