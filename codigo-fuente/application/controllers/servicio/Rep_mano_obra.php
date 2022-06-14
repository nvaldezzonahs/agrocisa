<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_mano_obra extends MY_Controller {
	
	//Información que se utiliza para asignar los indices iniciales del archivo Excel
	var $archivoExcel = NULL;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Asignar el indice de la columna principal
	    $this->archivoExcel['intIndColInicial'] = 1;
		//Cargamos el modelo de ordenes de reparación
		$this->load->model('servicio/ordenes_reparacion_model', 'ordenes');
	
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrRegistro = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('servicio/rep_mano_obra', $arrRegistro);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrRegistro = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrRegistro));
	}

	

	/*Método para generar un reporte PDF con los servicios de mano de obra
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');

	   //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial);
		$strTituloRangoFechas .= ' AL '.$this->get_fecha_formato_letra($dteFechaFinal);
		$strTituloRangoFechas = 'PERIODO '.$strTituloRangoFechas;
	
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->ordenes->buscar_ordenes_mano_obra($dteFechaInicial, $dteFechaFinal); 
		//Se crea una instancia de la clase PDF
        $pdf = new PDF('L','mm','letter');//orientación horizontal
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'REPORTE DE MANO DE OBRA DE SERVICIO';
		$pdf->strLinea2 = mb_strtoupper($strTituloRangoFechas);
	   
		//Variable que se utiliza pra asignar el id actual del mecánico
		$intMecanicoIDActual = 0;
		//Variable que se utiliza pra asignar el id actual de la sucursal
		$intSucursalIDActual = 0;
		 //Variables que se utilizan para asignar los acumulados de servicios 
		$intAcumOrdrep = 0;
		$intAcumGar = 0;
		$intAcumPreEnt = 0;
		$intAcumPEP = 0;
		$intAcumSerInt = 0;
		$intAcumIntTal = 0;
		$intAcumIntVen = 0;
		//Array que se utiliza para agregar los datos de un mecánico
        $arrAuxiliar = array();
        //Array que se utiliza para asignar los acumulados del mecánico 
        $arrAcumulados = array();

		//Establecer el color de fondo para la cabecera
		$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Si hay información
		if ($otdResultado)
		{	

			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Si la sucursal actual es diferente a la anterior
				if ($arrCol->sucursal_id != $intSucursalIDActual)
				{
					//Si se cumple la sentencia
					if ($intSucursalIDActual > 0)
					{
						//Inicializar array´s
				        $arrAuxiliar = array();
				        $arrAcumulados = array();

				        //Definir valores del array auxiliar de información (para cada mecánico)
						$arrAuxiliar["intAcumOrdrep"] = $intAcumOrdrep;
						$arrAuxiliar["intAcumGar"] = $intAcumGar;
						$arrAuxiliar["intAcumPreEnt"] = $intAcumPreEnt;
						$arrAuxiliar["intAcumPEP"] = $intAcumPEP;
						$arrAuxiliar["intAcumSerInt"] = $intAcumSerInt;
						$arrAuxiliar["intAcumIntTal"] = $intAcumIntTal;
						$arrAuxiliar["intAcumIntVen"] = $intAcumIntVen;
						//Asignar datos al array
	               	 	array_push($arrAcumulados, $arrAuxiliar); 
	               	 	//Hacer un llamado a la función para agregar totales y subtotales
	               	 	$this->get_totales($pdf, 'PDF', $arrAcumulados, $arrAlineacion2, $arrAnchura2);

	               	 	//Inicializar variables
	               	 	$intAcumOrdrep = 0;
						$intAcumGar = 0;
						$intAcumPreEnt = 0;
						$intAcumPEP = 0;
						$intAcumSerInt = 0;
						$intAcumIntTal = 0;
						$intAcumIntVen = 0;

	               	 	
					}

					//Asignar el valor de la descripción (título de la lista de registros) del reporte
					$pdf->strLinea1 = 'REPORTE DE MANO DE OBRA DE SERVICIO';
					$pdf->strLinea2 = mb_strtoupper($strTituloRangoFechas);
					$pdf->strLinea3 = 'SUCURSAL: '.$arrCol->Sucursal;
					//Agregar la primer pagina
					$pdf->AddPage();

				}//Cierre de verificación de sucursal

				//Si el mecánico actual es diferente al anterior
				if ($arrCol->mecanico_id != $intMecanicoIDActual)
				{
					//Si se cumple la sentencia
					if ($intMecanicoIDActual > 0 && $intSucursalIDActual == $arrCol->sucursal_id)
					{
						//Inicializar array´s
				        $arrAuxiliar = array();
				        $arrAcumulados = array();

				        //Definir valores del array auxiliar de información (para cada mecánico)
						$arrAuxiliar["intAcumOrdrep"] = $intAcumOrdrep;
						$arrAuxiliar["intAcumGar"] = $intAcumGar;
						$arrAuxiliar["intAcumPreEnt"] = $intAcumPreEnt;
						$arrAuxiliar["intAcumPEP"] = $intAcumPEP;
						$arrAuxiliar["intAcumSerInt"] = $intAcumSerInt;
						$arrAuxiliar["intAcumIntTal"] = $intAcumIntTal;
						$arrAuxiliar["intAcumIntVen"] = $intAcumIntVen;
						//Asignar datos al array
	               	 	array_push($arrAcumulados, $arrAuxiliar); 
	               	 	//Hacer un llamado a la función para agregar totales y subtotales
	               	 	$this->get_totales($pdf, 'PDF', $arrAcumulados, $arrAlineacion2, $arrAnchura2);

	               	 	//Inicializar variables
	               	 	$intAcumOrdrep = 0;
						$intAcumGar = 0;
						$intAcumPreEnt = 0;
						$intAcumPEP = 0;
						$intAcumSerInt = 0;
						$intAcumIntTal = 0;
						$intAcumIntVen = 0;
					}

					$pdf->Ln(1); //Deja un salto de línea
					$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Crea los titulos de la cabecera 1
					$arrCabecera = array('MECANICO: ', $arrCol->CodMec,  
											  utf8_decode($arrCol->Mecanico));

					//Crea los titulos de la cabecera 2
					$arrCabecera2 = array('ORDEN', 'FACTURA', 'FECHA', 'CLIENTE', 
										  'ORDEN DE REP.', 'GARANTIA', 'PRE ENTREGA', 
										  'PEPS', 'SERV. INTERNO', 'INTERNO TALLER', 
										  'INTERNO VENTAS');

					//Establece el ancho de las columnas de cabecera
					$arrAnchura = array(20, 10, 232);
					$arrAnchura2 = array(17, 17, 15, 59, 20, 22, 22, 22, 22, 23, 23);
					//Establece la alineación de las celdas de las tablas
					$arrAlineacion = array('L', 'L', 'L');
					$arrAlineacion2 = array('L', 'L', 'C', 'L', 'R', 'R', 'R', 'R', 'R', 'R', 'R');

					//Recorre el array de títulos de encabezado para crearlos
					for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
					{
						//inserta los titulos de la cabecera 1
						$pdf->Cell($arrAnchura[$intCont], 3, $arrCabecera[$intCont], 1, 0, 
								   $arrAlineacion[$intCont], TRUE);
					}

					$pdf->Ln(); //Deja un salto de línea

					//Recorre el array de títulos de encabezado para crearlos
					for ($intCont = 0; $intCont < count($arrCabecera2); $intCont++)
					{
						//inserta los titulos de la cabecera 2
						$pdf->Cell($arrAnchura2[$intCont], 3, $arrCabecera2[$intCont], 1, 0, 
								   $arrAlineacion2[$intCont], TRUE);
					}

					$pdf->Ln(); //Deja un salto de línea


				}//Cierre de verificación de mecánico

				//Asignar id de la sucursal actual
				$intSucursalIDActual = $arrCol->sucursal_id;
				//Asignar id del mecánico actual
				$intMecanicoIDActual = $arrCol->mecanico_id;

				

				//Asignar objeto con los datos del registro
				$otdDatos = $this->get_datos('PDF', $arrCol, $intAcumOrdrep, $intAcumGar, $intAcumPreEnt, 
											 $intAcumPEP, $intAcumSerInt, $intAcumIntTal, $intAcumIntVen);

				//Asignar array con los datos del registro
				$arrDatos = $otdDatos['rows'];
				//Asignar acumulados de los servicios
				$intAcumOrdrep = $otdDatos['intAcumOrdrep'];
				$intAcumGar = $otdDatos['intAcumGar'];
				$intAcumPreEnt = $otdDatos['intAcumPreEnt'];
				$intAcumPEP = $otdDatos['intAcumPEP'];
				$intAcumSerInt = $otdDatos['intAcumSerInt'];
				$intAcumIntTal = $otdDatos['intAcumIntTal'];
				$intAcumIntVen = $otdDatos['intAcumIntVen'];


				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchura2);

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row($arrDatos, $arrAlineacion2, 'ClippedCell');

				

			}//Cierre de foreach

			//Escribir los totales del último mecánico
			if ($intMecanicoIDActual > 0)
			{
				//Inicializar array´s
		        $arrAuxiliar = array();
		        $arrAcumulados = array();

		        //Definir valores del array auxiliar de información (para cada mecánico)
				$arrAuxiliar["intAcumOrdrep"] = $intAcumOrdrep;
				$arrAuxiliar["intAcumGar"] = $intAcumGar;
				$arrAuxiliar["intAcumPreEnt"] = $intAcumPreEnt;
				$arrAuxiliar["intAcumPEP"] = $intAcumPEP;
				$arrAuxiliar["intAcumSerInt"] = $intAcumSerInt;
				$arrAuxiliar["intAcumIntTal"] = $intAcumIntTal;
				$arrAuxiliar["intAcumIntVen"] = $intAcumIntVen;
				//Asignar datos al array
           	 	array_push($arrAcumulados, $arrAuxiliar); 
           	 	//Hacer un llamado a la función para agregar totales y subtotales
           	 	$this->get_totales($pdf, 'PDF', $arrAcumulados, $arrAlineacion2, $arrAnchura2);
		   	}

		}

		//Ejecutar la salida del reporte
		$pdf->Output('mano_obra.pdf','I'); 
	}


	
	

	/*Método para generar un archivo XLS con los servicios de mano de obra
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		
	    //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial);
		$strTituloRangoFechas .= ' AL '.$this->get_fecha_formato_letra($dteFechaFinal);
		$strTituloRangoFechas = 'PERIODO '.$strTituloRangoFechas;
	
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->ordenes->buscar_ordenes_mano_obra($dteFechaInicial, $dteFechaFinal); 
		
		
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
		
		//Variable que se utiliza pra asignar el id actual del mecánico
		$intMecanicoIDActual = 0;
		//Variable que se utiliza pra asignar el id actual de la sucursal
		$intSucursalIDActual = 0;
		 //Variables que se utilizan para asignar los acumulados de servicios 
		$intAcumOrdrep = 0;
		$intAcumGar = 0;
		$intAcumPreEnt = 0;
		$intAcumPEP = 0;
		$intAcumSerInt = 0;
		$intAcumIntTal = 0;
		$intAcumIntVen = 0;
		//Array que se utiliza para agregar los datos de un mecánico
        $arrAuxiliar = array();
        //Array que se utiliza para asignar los acumulados del mecánico 
        $arrAcumulados = array();
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

        $arrStyleFuenteColumnasPrinc = array('font' => array('bold' => TRUE,
    													     'color' => array('rgb' => '000000')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo para alinear a la izquierda el contenido de la celda
        $arrStyleAlignmentLeft = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));


		//Si hay información
		if ($otdResultado)
		{	

			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Si la sucursal actual es diferente a la anterior
				if ($arrCol->sucursal_id != $intSucursalIDActual)
				{
					//Si se cumple la sentencia
					if ($intSucursalIDActual > 0)
					{
						//Inicializar array´s
				        $arrAuxiliar = array();
				        $arrAcumulados = array();

				        //Definir valores del array auxiliar de información (para cada mecánico)
						$arrAuxiliar["intAcumOrdrep"] = $intAcumOrdrep;
						$arrAuxiliar["intAcumGar"] = $intAcumGar;
						$arrAuxiliar["intAcumPreEnt"] = $intAcumPreEnt;
						$arrAuxiliar["intAcumPEP"] = $intAcumPEP;
						$arrAuxiliar["intAcumSerInt"] = $intAcumSerInt;
						$arrAuxiliar["intAcumIntTal"] = $intAcumIntTal;
						$arrAuxiliar["intAcumIntVen"] = $intAcumIntVen;
						//Asignar datos al array
	               	 	array_push($arrAcumulados, $arrAuxiliar); 
	               	 	//Hacer un llamado a la función para agregar totales y subtotales
	               	  	$this->get_totales($objExcel, 'EXCEL', $arrAcumulados, NULL, NULL, 
	               	 					   $intFila);
	               	 	

	               	 	//Inicializar variables
	               	 	$intAcumOrdrep = 0;
						$intAcumGar = 0;
						$intAcumPreEnt = 0;
						$intAcumPEP = 0;
						$intAcumSerInt = 0;
						$intAcumIntTal = 0;
						$intAcumIntVen = 0;

							
	               	 	//Si el número de registros (por cada sucursal) es mayor que el número máximo de registros 
					    if($intFila > $intNumMaxRegistros)
			            {
			            	//Asignar número de registros
			            	$intNumMaxRegistros = $intFila;
			            }


					}


					//Asignar el nombre de la hoja
					$strNombreHoja = 'mano de obra '.$arrCol->Sucursal;
					//Número de fila donde se va a comenzar a rellenar
				    $intFila = 14;
				    $intFilaInicial = 14;
				    //Posición para escribir las descripciones de las columnas 
			        $intPosEncabezados = 12;
			        $intPosEncabCab2 = 13;

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
					$objExcel->getActiveSheet()->setCellValue('A7', 'REPORTE DE MANO DE OBRA DE SERVICIO '.$arrCol->Sucursal);
					$objExcel->getActiveSheet()->setCellValue('A8', strtoupper($strTituloRangoFechas));
					$objExcel->getActiveSheet()->setCellValue('A9', 'SUCURSAL: '.$arrCol->Sucursal);

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


					//Incrementar contador por cada sucursal
					$intContadorHojas++;

				}//Cierre de verificación de sucursal

				//Si el mecánico actual es diferente al anterior
				if ($arrCol->mecanico_id != $intMecanicoIDActual)
				{
					//Si se cumple la sentencia
					if ($intMecanicoIDActual > 0 && $intSucursalIDActual == $arrCol->sucursal_id)
					{
						//Inicializar array´s
				        $arrAuxiliar = array();
				        $arrAcumulados = array();

				        //Definir valores del array auxiliar de información (para cada mecánico)
						$arrAuxiliar["intAcumOrdrep"] = $intAcumOrdrep;
						$arrAuxiliar["intAcumGar"] = $intAcumGar;
						$arrAuxiliar["intAcumPreEnt"] = $intAcumPreEnt;
						$arrAuxiliar["intAcumPEP"] = $intAcumPEP;
						$arrAuxiliar["intAcumSerInt"] = $intAcumSerInt;
						$arrAuxiliar["intAcumIntTal"] = $intAcumIntTal;
						$arrAuxiliar["intAcumIntVen"] = $intAcumIntVen;
						//Asignar datos al array
	               	 	array_push($arrAcumulados, $arrAuxiliar); 
	               	 	//Hacer un llamado a la función para agregar totales y subtotales
	               	 	$this->get_totales($objExcel, 'EXCEL', $arrAcumulados, NULL, NULL, 
	               	 					   $intFila);

	               	 	//Inicializar variables
	               	 	$intAcumOrdrep = 0;
						$intAcumGar = 0;
						$intAcumPreEnt = 0;
						$intAcumPEP = 0;
						$intAcumSerInt = 0;
						$intAcumIntTal = 0;
						$intAcumIntVen = 0;
					}

					//Si se cumple la sentencia significa que se van a escribir los datos del siguiente mecánico
					if($intFila != $intFilaInicial)
					{
						//Incrementar el indice para escribir cabeceras
						$intFila += 3;
						//Incrementar indice de los encabezados
						$intPosEncabezados = $intFila;
						$intPosEncabCab2 = $intFila+1;
						
						//Incrementar el indice para escribir los datos del siguiente registro
						$intFila += 2;
					}
				
					//Se agregan las columnas de cabecera 1
			        $objExcel->getActiveSheet()
			        		  ->setCellValue('A'.$intPosEncabezados, 
			        							 'MECANICO: '. $arrCol->CodMec.' '.$arrCol->Mecanico);

			       //Crea los titulos de la segunda cabecera 
				   $arrCabecera2 = array('ORDEN', 'FACTURA', 'FECHA', 'CLIENTE', 
				   						 'ORDEN DE REPARACIÓN', 'GARANTIA', 
										 'PRE ENTREGA', 'PEPS', 'SERVICIO INTERNO', 
										 'INTERNO TALLER', 'INTERNO VENTAS');

				   	//Asignar el número de columnas de la cabecera 2
	 				$intNumColCabecera2 = count($arrCabecera2);

	 				//Inicializar los indices para escribir los datos de la cabecera 2
        			$intIndColE =  $this->archivoExcel['intIndColInicial'];

        			//Asignar columna final
		    		$strColFinal = $this->ARR_COLUMNAS[$intNumColCabecera2];

				  	 //Hacer recorrido para obtener los datos de la cabecera 2
			    	foreach ($arrCabecera2 as $arrDet) 
			    	{
			    		//Asignar columna actual
			    		$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intPosEncabCab2;

			    		//Se agrega en el encabezado del archivo la cabecera 2
        				$objExcel->getActiveSheet()->setCellValue($strColActual, $arrDet);

        				//Incrementar indice de la columna
						$intIndColE++;  

			    	}//Cierre de foreach (cabecera 2)


			         //Combinar las siguientes celdas
			       	$objExcel->getActiveSheet()->mergeCells('A'.$intPosEncabezados.':'.$strColFinal.$intPosEncabezados);

					//Preferencias de color de relleno de celda
					 $objExcel->getActiveSheet()
			    			 ->getStyle('A'.$intPosEncabezados.':'.$strColFinal.$intPosEncabezados)
			    			 ->getFill()
			    			 ->applyFromArray($arrStyleColumnas);

			        $objExcel->getActiveSheet()
			    			 ->getStyle('A'.$intPosEncabCab2.':'.$strColFinal.$intPosEncabCab2)
			    			 ->getFill()
			    			 ->applyFromArray($arrStyleColumnas);

			    	//Preferencias de color de texto de la celda
			    	$objExcel->getActiveSheet()
		    			 	 ->getStyle('A'.$intPosEncabezados.':'.$strColFinal.$intPosEncabezados)
		    			 	 ->applyFromArray($arrStyleFuenteColumnas);

			    	$objExcel->getActiveSheet()
		    			 	 ->getStyle('A'.$intPosEncabCab2.':'.$strColFinal.$intPosEncabCab2)
		    			 	 ->applyFromArray($arrStyleFuenteColumnas);

		    	    //Cambiar alineación de las siguientes celdas
		    		$objExcel->getActiveSheet()
			            	 ->getStyle('A'.$intPosEncabCab2.':'.$strColFinal.$intPosEncabCab2)
			            	 ->getAlignment()
			            	 ->applyFromArray($arrStyleAlignmentCenter);


				}//Cierre de verificación de mecánico

				

				//Asignar id de la sucursal actual
				$intSucursalIDActual = $arrCol->sucursal_id;
				//Asignar id del mecánico actual
				$intMecanicoIDActual = $arrCol->mecanico_id;

				//Asignar objeto con los datos del registro
				$otdDatos = $this->get_datos('EXCEL', $arrCol, $intAcumOrdrep, $intAcumGar, $intAcumPreEnt, 
											 $intAcumPEP, $intAcumSerInt, $intAcumIntTal, $intAcumIntVen);

				//Asignar array con los datos del registro
				$arrDatos = $otdDatos['rows'];
				//Asignar acumulados de los servicios
				$intAcumOrdrep = $otdDatos['intAcumOrdrep'];
				$intAcumGar = $otdDatos['intAcumGar'];
				$intAcumPreEnt = $otdDatos['intAcumPreEnt'];
				$intAcumPEP = $otdDatos['intAcumPEP'];
				$intAcumSerInt = $otdDatos['intAcumSerInt'];
				$intAcumIntTal = $otdDatos['intAcumIntTal'];
				$intAcumIntVen = $otdDatos['intAcumIntVen'];

				//Inicializar los indices para escribir los datos del registro
        		$intIndColE =  $this->archivoExcel['intIndColInicial'];

				//Hacer recorrido para obtener los datos del registro
		    	foreach ($arrDatos as $arrDet) 
		    	{

		    		//Asignar columna actual
		    		$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFila;

		    		//Reemplazar '$' por cadena vacia
					$arrDet  = str_replace('$', '', $arrDet);
					//Reemplazar ',' por cadena vacia
					$arrDet  = str_replace(',', '', $arrDet);

		    		//Agregar información del registro
    				$objExcel->getActiveSheet()->setCellValue($strColActual, $arrDet);

    				//Incrementar indice de la columna
					$intIndColE++;  

		    	}//Cierre de foreach datos

	    		//Asignar columna final
		    	$strColFinal = $this->ARR_COLUMNAS[$intNumColCabecera2].$intFila;

		
			    //Cambiar contenido de las celdas a formato moneda
                $objExcel->getActiveSheet()
		        		 ->getStyle('E'.$intFila.':'.$strColFinal)
		        		 ->getNumberFormat()
		        		 ->setFormatCode('$#,##0.00'); 

	        	//Cambiar alineación de las siguientes celdas
		        $objExcel->getActiveSheet()
			        	 ->getStyle('C'.$intFila)
			        	 ->getAlignment()
			        	 ->applyFromArray($arrStyleAlignmentCenter);

	        	$objExcel->getActiveSheet()
			        	 ->getStyle('E'.$intFila.':'.$strColFinal)
			        	 ->getAlignment()
			        	 ->applyFromArray($arrStyleAlignmentRight);


		    	//Incrementar el indice para escribir los datos del siguiente registro
				$intFila++;

			}//Cierre de foreach

			//Escribir los totales del último mecánico
			if ($intMecanicoIDActual > 0)
			{
				//Inicializar array´s
		        $arrAuxiliar = array();
		        $arrAcumulados = array();

		        //Definir valores del array auxiliar de información (para cada mecánico)
				$arrAuxiliar["intAcumOrdrep"] = $intAcumOrdrep;
				$arrAuxiliar["intAcumGar"] = $intAcumGar;
				$arrAuxiliar["intAcumPreEnt"] = $intAcumPreEnt;
				$arrAuxiliar["intAcumPEP"] = $intAcumPEP;
				$arrAuxiliar["intAcumSerInt"] = $intAcumSerInt;
				$arrAuxiliar["intAcumIntTal"] = $intAcumIntTal;
				$arrAuxiliar["intAcumIntVen"] = $intAcumIntVen;
				//Asignar datos al array
           	 	array_push($arrAcumulados, $arrAuxiliar); 
           	 	//Hacer un llamado a la función para agregar totales y subtotales
	            $this->get_totales($objExcel, 'EXCEL', $arrAcumulados, NULL, NULL, 
	               	 			   $intFila);
		   	}

		}

		 //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'mano_obra.xls', 'mano de obra', $intNumMaxRegistros); 
		
	}


	//Función que se utiliza para regresar los subtotales y totales de los servicios de un mecánico
	public function get_totales($lib, $strTipoArchivo, $arrAcumulados, 
								$arrAlineacion2 = NULL, $arrAnchura2 = NULL, 
								$intFilaExcel = NULL)
	{

		//Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(17, 32);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('L', 'R');

		//Recorremos el arreglo 
		foreach ($arrAcumulados as $arrAcum)
		{
			//Agregar al array los acumulados de saldos vencidos y saldos por vencer
			$arrSubtotales = array('SUBTOTAL:');
			$arrSubtotales[] = '';
	    	$arrSubtotales[] = '';
	    	$arrSubtotales[] = '';
	    	//Si existe importe de la orden de reparación
	    	if ($arrAcum['intAcumOrdrep'] > 0)
			{	
				
				//Agregar datos al array
				$arrSubtotales[] = '$'.number_format($arrAcum['intAcumOrdrep'], 2, '.', ',');

			}
			else
			{
				$arrSubtotales[] = '';
			}

			//Si existe importe de la garantía
			if ($arrAcum['intAcumGar'] > 0)
			{
								
				//Agregar datos al array
				$arrSubtotales[] = '$'.number_format($arrAcum['intAcumGar'], 2, '.', ',');
				
			}
			else
			{
				$arrSubtotales[] = '';
			}


			//Si existe importe de la pre entrega
			if ($arrAcum['intAcumPreEnt'] > 0)
			{
				
				//Agregar datos al array
				$arrSubtotales[] = '$'.number_format($arrAcum['intAcumPreEnt'], 2, '.', ',');
				
			}
			else
			{
				$arrSubtotales[] = '';
			}

			//Si existe importe del PEPS
			if ($arrAcum['intAcumPEP'] > 0)
			{
				
				//Agregar datos al array
				$arrSubtotales[] = '$'.number_format($arrAcum['intAcumPEP'], 2, '.', ',');
				
			}
			else
			{
				$arrSubtotales[] = '';
			}

			//Si existe importe del servicio interno
			if ($arrAcum['intAcumSerInt'] > 0)
			{
				
				//Agregar datos al array
				$arrSubtotales[] = '$'.number_format($arrAcum['intAcumSerInt'], 2, '.', ',');
				
			}
			else
			{
				$arrSubtotales[] = '';
			}

			//Si existe importe del servicio interno de taller
			if ($arrAcum['intAcumIntTal'] > 0)
			{

				//Agregar datos al array
				$arrSubtotales[] = '$'.number_format($arrAcum['intAcumIntTal'], 2, '.', ',');
				
			}
			else
			{
				$arrSubtotales[] = '';
			}

			//Si existe importe del servicio interno de ventas
			if ($arrAcum['intAcumIntVen'] > 0)
			{
				
				//Agregar datos al array
				$arrSubtotales[] = '$'.number_format($arrAcum['intAcumIntVen'] , 2, '.', ',');
				
			}
			else
			{
				$arrSubtotales[] = '';
			}

			//Calcular importe total
			$intTotal = ($arrAcum['intAcumOrdrep'] + $arrAcum['intAcumGar'] + $arrAcum['intAcumPreEnt'] + 
						 $arrAcum['intAcumPEP'] + $arrAcum['intAcumSerInt'] + $arrAcum['intAcumIntTal'] + 
						 $arrAcum['intAcumIntVen']);


			//Si el tipo de archivo es PDF
			if($strTipoArchivo == 'PDF')
			{

				//Escribir totales
				//Cambiar el volumen de la fuente a bold
		   	 	$lib->strTipoLetraTabla = 'Negrita';

		   	 	//Establece el ancho de las columnas
				$lib->SetWidths($arrAnchura2);
				//Se agrega la información de los acumulados
		   		$lib->Row($arrSubtotales, $arrAlineacion2, 'ClippedCell');

		   		//Establece el ancho de las columnas
				$lib->SetWidths($arrAnchuraTotales);
				//Se agrega la información del total
		   		$lib->Row(array('TOTAL:', '$'.number_format($intTotal, 2, '.', ',')), 
		   				  $arrAlineacionTotales, 'ClippedCell');

		   		//Cambiar el volumen de la fuente a normal
		    	$lib->strTipoLetraTabla = '';

			}
			else //Si el tipo de archivo es Excel
			{

				//Asignar el número de columna donde se empezaran a escribir los totales 
				$intIndColE = $this->archivoExcel['intIndColInicial'];

				//Asignar el número de columnas de la cabecera 2
	 			$intNumColCabecera2 = count($arrSubtotales);

	 			//Asignar el indice de la fila para escribir los subtotales
	 			$intFilaSubtotal =  $intFilaExcel;

	 			//Asignar columna final
			    $strColFinal = $this->ARR_COLUMNAS[$intNumColCabecera2].$intFilaSubtotal;


				//Hacer recorrido para obtener los datos de los subtotales
				foreach ($arrSubtotales as $arrDet) 
				{	
					//Asignar columna actual
					$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaSubtotal;

					//Reemplazar '$' por cadena vacia
					$arrDet  = str_replace('$', '', $arrDet);
					//Reemplazar ',' por cadena vacia
					$arrDet  = str_replace(',', '', $arrDet);

					//Agregar información del acumulado
					$lib->getActiveSheet()
	                    ->setCellValue($strColActual, $arrDet);
	                    
	                //Incrementar indice de la columna
					$intIndColE++;     
					
				}//Cierre de foreach (subtotales)

				//Incrementar el indice para escribir los datos del total
				$intFilaExcel++;

				//Agregar información del total
				$lib->getActiveSheet()
                         ->setCellValue('A'.$intFilaExcel, 'TOTAL:')
                         ->setCellValue('C'.$intFilaExcel, $intTotal);

	            //Cambiar contenido de las celdas a formato moneda
                $lib->getActiveSheet()
	        		->getStyle('A'.$intFilaSubtotal.':'.$strColFinal)
	        		->getNumberFormat()
	        		->setFormatCode('$#,##0.00');  

	            $lib->getActiveSheet()
	        		->getStyle('C'.$intFilaExcel)
	        		->getNumberFormat()
	        		->setFormatCode('$#,##0.00');  

	        	//Cambiar alineación de las siguientes celdas
	        	$lib->getActiveSheet()
		        	 ->getStyle('E'.$intFilaSubtotal.':'.$strColFinal)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

	            $lib->getActiveSheet()
		        	 ->getStyle('C'.$intFilaExcel)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);


		        //Cambiar estilo de las siguientes celdas
		        $lib->getActiveSheet()
	                ->getStyle('A'.$intFilaSubtotal.':'.$strColFinal)
	                ->applyFromArray($arrStyleBold);

	            $lib->getActiveSheet()
	                ->getStyle('A'.$intFilaExcel.':C'.$intFilaExcel)
	                ->applyFromArray($arrStyleBold);


			}
			
	    }
	}

	//Función que se utiliza para regresar array con los datos de un registro
	public function get_datos($strTipoArchivo, $arrCol, $intAcumOrdrep, $intAcumGar, $intAcumPreEnt, 
							  $intAcumPEP, $intAcumSerInt, $intAcumIntTal, $intAcumIntVen)
	{
		

        //Array que se utiliza para enviar datos
		$arrDatos = array('rows' => NULL,
						  'intAcumOrdrep' => 0, 
						  'intAcumGar' => 0, 
						  'intAcumPreEnt' => 0, 
						  'intAcumPEP' => 0, 
						  'intAcumSerInt' => 0,
						  'intAcumIntTal' => 0, 
						  'intAcumIntVen' => 0);


		 //Array que se utiliza para agregar los datos de un registro
        $arrRegistro = array();

        //Si el tipo de archivo es PDF
        if($strTipoArchivo == 'PDF')
        {
        	$arrCol->razon_social = utf8_decode($arrCol->razon_social);
        }

        //Asignar al array los datos del registro
        $arrRegistro = array($arrCol->FolioOrden, $arrCol->FolioFactura, 
        				  $arrCol->fecha, $arrCol->razon_social);



        //Asignar importe del servicio
		$intImporteServicio = $arrCol->Importe;

        switch($arrCol->servicio_tipo_id)
		{
			case TIPO_SERVICIO_ORDEN_REP://Orden de reparación
				
				 //Importe del tipo de servicio
            	$arrRegistro[] = '$'.number_format($intImporteServicio, 2, '.', ',');
            	$arrRegistro[] = '';
            	$arrRegistro[] = '';
            	$arrRegistro[] = '';
            	$arrRegistro[] = '';
            	$arrRegistro[] = '';
            	$arrRegistro[] = '';
            	//Incrementar acumulado
				$intAcumOrdrep += $intImporteServicio;
				break;
			case TIPO_SERVICIO_GARANTIA://Garantía
				$arrRegistro[] = '';
				//Importe del tipo de servicio
            	$arrRegistro[] = '$'.number_format($intImporteServicio, 2, '.', ',');
            	$arrRegistro[] = '';
            	$arrRegistro[] = '';
            	$arrRegistro[] = '';
            	$arrRegistro[] = '';
            	$arrRegistro[] = '';
            	//Incrementar acumulado
				$intAcumGar += $intImporteServicio;
				break;
			case TIPO_SERVICIO_PREENTREGA: //Pre entrega
				$arrRegistro[] = '';
				$arrRegistro[] = '';
				//Importe del tipo de servicio
            	$arrRegistro[] = '$'.number_format($intImporteServicio, 2, '.', ',');
            	$arrRegistro[] = '';
            	$arrRegistro[] = '';
            	$arrRegistro[] = '';
            	$arrRegistro[] = '';
            	//Incrementar acumulado
				$intAcumPreEnt += $intImporteServicio;
				break;
			case TIPO_SERVICIO_PEPS://PEPS
				$arrRegistro[] = '';
				$arrRegistro[] = '';
				$arrRegistro[] = '';
				//Importe del tipo de servicio
            	$arrRegistro[] = '$'.number_format($intImporteServicio, 2, '.', ',');
            	$arrRegistro[] = '';
            	$arrRegistro[] = '';
            	$arrRegistro[] = '';
            	//Incrementar acumulado
				$intAcumPEP += $intImporteServicio;
				break;
			case TIPO_SERVICIO_INTERNO://Servicio interno
				$arrRegistro[] = '';
				$arrRegistro[] = '';
				$arrRegistro[] = '';
				$arrRegistro[] = '';
				//Importe del tipo de servicio
            	$arrRegistro[] = '$'.number_format($intImporteServicio, 2, '.', ',');
            	$arrRegistro[] = '';
            	$arrRegistro[] = '';
            	//Incrementar acumulado
				$intAcumSerInt += $intImporteServicio;
				break;
			case TIPO_SERVICIO_TALLER://Servicio interno taller
				$arrRegistro[] = '';
				$arrRegistro[] = '';
				$arrRegistro[] = '';
				$arrRegistro[] = '';
				$arrRegistro[] = '';
				//Importe del tipo de servicio
            	$arrRegistro[] = '$'.number_format($intImporteServicio, 2, '.', ',');
            	$arrRegistro[] = '';
            	//Incrementar acumulado
				$intAcumIntTal += $intImporteServicio;
				break;
			case TIPO_SERVICIO_VENTAS://Servicio interno ventas
				$arrRegistro[] = '';
				$arrRegistro[] = '';
				$arrRegistro[] = '';
				$arrRegistro[] = '';
				$arrRegistro[] = '';
				$arrRegistro[] = '';
				//Importe del tipo de servicio
            	$arrRegistro[] = '$'.number_format($intImporteServicio, 2, '.', ',');
            	//Incrementar acumulado
				$intAcumIntVen += $intImporteServicio;
				break;
		}



		//Agregar datos al array
		$arrDatos['rows'] = $arrRegistro;
		$arrDatos['intAcumOrdrep'] = $intAcumOrdrep;
		$arrDatos['intAcumGar'] = $intAcumGar;
		$arrDatos['intAcumPreEnt'] = $intAcumPreEnt;
		$arrDatos['intAcumPEP'] = $intAcumPEP;
		$arrDatos['intAcumSerInt'] = $intAcumSerInt;
		$arrDatos['intAcumIntTal'] = $intAcumIntTal;
		$arrDatos['intAcumIntVen'] = $intAcumIntVen;

		//Regresar array con los datos de del registro
		return $arrDatos;
	}

   
}	