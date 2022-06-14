<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_comisiones extends MY_Controller {
	
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
		//Cargamos el modelo de facturas
		$this->load->model('refacciones/facturas_refacciones_model', 'facturas');
		//Cargamos el modelo de vendedores
		$this->load->model('crm/vendedores_model', 'vendedores');
	
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrRegistro = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('refacciones/rep_comisiones', $arrRegistro);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrRegistro = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrRegistro));
	}

	

	/*Método para generar un reporte PDF con las comisiones de refacciones
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
	
		
		//Se crea una instancia de la clase PDF
        $pdf = new PDF('L','mm','letter');//orientación horizontal
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'REPORTE DE COMISIONES DE REFACCIONES';
		$pdf->strLinea2 = mb_strtoupper($strTituloRangoFechas);
		//Crea los titulos de la primer cabecera 
		$arrCabecera = array('NO.', 'VENTAS CONTADO', utf8_decode('RECUPERACIÓN FRAS'), 
							 utf8_decode('RECUPERACIÓN'), 'DEV. DE CONTADO',
							 'TOTAL RECUPERADO', 'PORCENTAJE', 'IMPORTE');
		//Crea los titulos de la segunda cabecera 
		$arrCabecera2 = array('VENDEDOR','NOMBRE VENDEDOR', 'CON IVA 16%', 'CON IVA 0%',
							  'CON IVA 16%', 'CON IVA 0%', 'TOTAL', 'CON IVA 16%', 'CON IVA 0%',
							  'NETO', 'SIN IVA', utf8_decode('DE COMISIÓN'), 
							  utf8_decode('COMISIÓN'));


		//Establecer el color de fondo para la cabecera
		$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Establece el ancho de las columnas de las cabeceras
		$arrAnchura = array(60, 40, 36, 18, 36, 36, 18, 18);
		$arrAnchura2 = array(15, 45, 20, 20, 18, 18, 18, 18, 18, 18, 18, 18, 18);

	    //Establece la alineación de las celdas de las tablas
		$arrAlineacion = array('L', 'C', 'C', 'C', 'C', 'C', 'R', 'R');
		$arrAlineacion2 = array('L', 'L', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R');
		
		
		//Variable que se utiliza pra asignar el id actual de la sucursal
		$intSucursalIDActual = 0;
		//Variables que se utilizan para asignar los acumulados
		$intAcumSubTotVenConIVA16 = 0;
		$intAcumIVAVenCon = 0;
		$intAcumSubTotVenConIVA0 = 0;
		$intAcumSubTotRecIVA16 = 0;
		$intAcumIVARec = 0;
		$intAcumSubTotRecIVA0 = 0;
		$intAcumTotalComisiones = 0;
		$intAcumSubTotDevConIVA16 = 0;
		$intAcumIVADevConIVA16 = 0;
		$intAcumDevConIVA0 = 0;
		//Array que se utiliza para agregar los datos de un mecánico
        $arrAuxiliar = array();
        //Array que se utiliza para asignar los acumulados del mecánico 
        $arrAcumulados = array();

		//Seleccionar vendedores del módulo de refacciones
		$otdVendedores = $this->vendedores->buscar_modulo(MODULO_REFACCIONES); 

		//Si hay información
		if ($otdVendedores)
		{	

			//Recorremos el arreglo 
			foreach ($otdVendedores as $arrCol)
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

				        //Definir valores del array auxiliar de información (para cada sucursal)
						$arrAuxiliar["intAcumSubTotVenConIVA16"] = $intAcumSubTotVenConIVA16;
						$arrAuxiliar["intAcumIVAVenCon"] = $intAcumIVAVenCon;
						$arrAuxiliar["intAcumSubTotVenConIVA0"] = $intAcumSubTotVenConIVA0;
						$arrAuxiliar["intAcumSubTotRecIVA16"] = $intAcumSubTotRecIVA16;
						$arrAuxiliar["intAcumIVARec"] = $intAcumIVARec;
						$arrAuxiliar["intAcumSubTotRecIVA0"] = $intAcumSubTotRecIVA0;
						$arrAuxiliar["intAcumTotalComisiones"] = $intAcumTotalComisiones;
						$arrAuxiliar["intAcumSubTotDevConIVA16"] = $intAcumSubTotDevConIVA16;
						$arrAuxiliar["intAcumIVADevConIVA16"] = $intAcumIVADevConIVA16;
						$arrAuxiliar["intAcumDevConIVA0"] = $intAcumDevConIVA0;
						//Asignar datos al array
	               	 	array_push($arrAcumulados, $arrAuxiliar); 
	               	 	//Hacer un llamado a la función para agregar totales y subtotales
	               	 	$this->get_totales($pdf, 'PDF', $arrAcumulados, $dteFechaInicial,
										   $dteFechaFinal, $intSucursalIDActual);

	               	 	
	               	 
	               	 	//Inicializar variables
	               	 	$intAcumSubTotVenConIVA16 = 0;
						$intAcumIVAVenCon = 0;
						$intAcumSubTotVenConIVA0 = 0;
						$intAcumSubTotRecIVA16 = 0;
						$intAcumIVARec = 0;
						$intAcumSubTotRecIVA0 = 0;
						$intAcumTotalComisiones = 0;
						$intAcumSubTotDevConIVA16 = 0;
						$intAcumIVADevConIVA16 = 0;
						$intAcumDevConIVA0 = 0;
					}

					//Asignar el valor de la descripción (título de la lista de registros) del reporte
					$pdf->strLinea1 = 'REPORTE DE COMISIONES DE REFACCIONES';
					$pdf->strLinea2 = mb_strtoupper($strTituloRangoFechas);
					$pdf->strLinea3 = 'SUCURSAL: '.$arrCol->Sucursal;

					//Agregar la primer pagina
					$pdf->AddPage();

					$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);

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

				}//Cierre de verificación de sucursal

				
				//Asignar id de la sucursal actual
				$intSucursalIDActual = $arrCol->sucursal_id;


				$pdf->SetTextColor(0); //establece el color de texto
				//Asignar objeto con los datos del registro
				$otdDatos = $this->get_datos('PDF', $arrCol, $dteFechaInicial, $dteFechaFinal, 
											 $intAcumSubTotVenConIVA16, $intAcumIVAVenCon,
											 $intAcumSubTotVenConIVA0, $intAcumSubTotRecIVA16,
											 $intAcumIVARec, $intAcumSubTotRecIVA0,
											 $intAcumTotalComisiones, $intAcumSubTotDevConIVA16,
											 $intAcumIVADevConIVA16, $intAcumDevConIVA0);

				//Asignar array con los datos del registro
				$arrDatos = $otdDatos['rows'];
				//Asignar acumulados de las ventas
				$intAcumSubTotVenConIVA16 = $otdDatos['intAcumSubTotVenConIVA16'];
				$intAcumIVAVenCon = $otdDatos['intAcumIVAVenCon'];
				$intAcumSubTotVenConIVA0 = $otdDatos['intAcumSubTotVenConIVA0'];
				$intAcumSubTotRecIVA16 = $otdDatos['intAcumSubTotRecIVA16'];
				$intAcumIVARec = $otdDatos['intAcumIVARec'];
				$intAcumSubTotRecIVA0 = $otdDatos['intAcumSubTotRecIVA0'];
				$intAcumTotalComisiones = $otdDatos['intAcumTotalComisiones'];
				$intAcumSubTotDevConIVA16 = $otdDatos['intAcumSubTotDevConIVA16'];
				$intAcumIVADevConIVA16 = $otdDatos['intAcumIVADevConIVA16'];
				$intAcumDevConIVA0 = $otdDatos['intAcumDevConIVA0'];

				//Si el vendedor tiene comisiones
				if($arrDatos)
				{
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchura2);

					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row($arrDatos, $arrAlineacion2, 'ClippedCell');

				}//Cierre de verificación de comisiones

			}//Cierre de foreach

			//Escribir los totales del última sucursal
			if ($intSucursalIDActual > 0)
			{
				//Inicializar array´s
		        $arrAuxiliar = array();
		        $arrAcumulados = array();

		        //Definir valores del array auxiliar de información (para cada sucursal)
				$arrAuxiliar["intAcumSubTotVenConIVA16"] = $intAcumSubTotVenConIVA16;
				$arrAuxiliar["intAcumIVAVenCon"] = $intAcumIVAVenCon;
				$arrAuxiliar["intAcumSubTotVenConIVA0"] = $intAcumSubTotVenConIVA0;
				$arrAuxiliar["intAcumSubTotRecIVA16"] = $intAcumSubTotRecIVA16;
				$arrAuxiliar["intAcumIVARec"] = $intAcumIVARec;
				$arrAuxiliar["intAcumSubTotRecIVA0"] = $intAcumSubTotRecIVA0;
				$arrAuxiliar["intAcumTotalComisiones"] = $intAcumTotalComisiones;
				$arrAuxiliar["intAcumSubTotDevConIVA16"] = $intAcumSubTotDevConIVA16;
				$arrAuxiliar["intAcumIVADevConIVA16"] = $intAcumIVADevConIVA16;
				$arrAuxiliar["intAcumDevConIVA0"] = $intAcumDevConIVA0;
				//Asignar datos al array
           	 	array_push($arrAcumulados, $arrAuxiliar); 
           	 	//Hacer un llamado a la función para agregar totales y subtotales
           	 	$this->get_totales($pdf, 'PDF', $arrAcumulados, $dteFechaInicial,
								   $dteFechaFinal, $intSucursalIDActual);

		   	}

		}//Cierre de verificación de vendedores

		//Ejecutar la salida del reporte
		$pdf->Output('comisiones_refacciones.pdf','I'); 
	}


	/*Método para generar un archivo XLS con las comisiones de refacciones
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
		
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
		
		
		//Crea los titulos de la segunda cabecera 
		$arrCabecera2 = array('VENDEDOR','NOMBRE VENDEDOR', 'CON IVA 16%', 'CON IVA 0%',
							  'CON IVA 16%', 'CON IVA 0%', 'TOTAL', 'CON IVA 16%', 'CON IVA 0%',
							  'NETO', 'SIN IVA', 'DE COMISION', 'COMISION');

		//Variable que se utiliza pra asignar el id actual de la sucursal
		$intSucursalIDActual = 0;
		//Variables que se utilizan para asignar los acumulados
		$intAcumSubTotVenConIVA16 = 0;
		$intAcumIVAVenCon = 0;
		$intAcumSubTotVenConIVA0 = 0;
		$intAcumSubTotRecIVA16 = 0;
		$intAcumIVARec = 0;
		$intAcumSubTotRecIVA0 = 0;
		$intAcumTotalComisiones = 0;
		$intAcumSubTotDevConIVA16 = 0;
		$intAcumIVADevConIVA16 = 0;
		$intAcumDevConIVA0 = 0;
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


        //Seleccionar vendedores del módulo de refacciones
		$otdVendedores = $this->vendedores->buscar_modulo(MODULO_REFACCIONES); 

		//Si hay información
		if ($otdVendedores)
		{	

			//Recorremos el arreglo 
			foreach ($otdVendedores as $arrCol)
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

	               	  	//Definir valores del array auxiliar de información (para cada sucursal)
						$arrAuxiliar["intAcumSubTotVenConIVA16"] = $intAcumSubTotVenConIVA16;
						$arrAuxiliar["intAcumIVAVenCon"] = $intAcumIVAVenCon;
						$arrAuxiliar["intAcumSubTotVenConIVA0"] = $intAcumSubTotVenConIVA0;
						$arrAuxiliar["intAcumSubTotRecIVA16"] = $intAcumSubTotRecIVA16;
						$arrAuxiliar["intAcumIVARec"] = $intAcumIVARec;
						$arrAuxiliar["intAcumSubTotRecIVA0"] = $intAcumSubTotRecIVA0;
						$arrAuxiliar["intAcumTotalComisiones"] = $intAcumTotalComisiones;
						$arrAuxiliar["intAcumSubTotDevConIVA16"] = $intAcumSubTotDevConIVA16;
						$arrAuxiliar["intAcumIVADevConIVA16"] = $intAcumIVADevConIVA16;
						$arrAuxiliar["intAcumDevConIVA0"] = $intAcumDevConIVA0;
						//Asignar datos al array
	               	 	array_push($arrAcumulados, $arrAuxiliar); 
	               	 	//Hacer un llamado a la función para agregar totales y subtotales
	               	 	$this->get_totales($objExcel, 'EXCEL', $arrAcumulados, $dteFechaInicial,
										   $dteFechaFinal, $intSucursalIDActual, $intFila);


	               	 	//Inicializar variables
	               	 	$intAcumSubTotVenConIVA16 = 0;
						$intAcumIVAVenCon = 0;
						$intAcumSubTotVenConIVA0 = 0;
						$intAcumSubTotRecIVA16 = 0;
						$intAcumIVARec = 0;
						$intAcumSubTotRecIVA0 = 0;
						$intAcumTotalComisiones = 0;
						$intAcumSubTotDevConIVA16 = 0;
						$intAcumIVADevConIVA16 = 0;
						$intAcumDevConIVA0 = 0;

					
	               	 	//Si el número de registros (por cada sucursal) es mayor que el número máximo de registros 
					    if($intFila > $intNumMaxRegistros)
			            {
			            	//Asignar número de registros
			            	$intNumMaxRegistros = $intFila;
			            }

					}


					//Asignar el nombre de la hoja
					$strNombreHoja = 'comisiones '.$arrCol->Sucursal;
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
					$objExcel->getActiveSheet()->setCellValue('A7', 'REPORTE DE COMISIONES DE REFACCIONES ');
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



		           //Se agregan las columnas de cabecera
			        $objExcel->getActiveSheet()
			        		 ->setCellValue('A'.$intPosEncabezados, 'NO.')
			        		 ->setCellValue('C'.$intPosEncabezados, 'VENTAS CONTADO')
			        		 ->setCellValue('E'.$intPosEncabezados, 'RECUPERACIÓN FACTURAS')
			                 ->setCellValue('G'.$intPosEncabezados, 'RECUPERACIÓN')
			                 ->setCellValue('H'.$intPosEncabezados, 'DEVOLUCIONES DE CONTADO')
			                 ->setCellValue('J'.$intPosEncabezados, 'TOTAL RECUPERADO')
			                 ->setCellValue('L'.$intPosEncabezados, 'PORCENTAJE')
			                 ->setCellValue('M'.$intPosEncabezados, 'IMPORTE');


			        //Combinar las siguientes celdas
			       	$objExcel->getActiveSheet()->mergeCells('C'.$intPosEncabezados.':D'.$intPosEncabezados);
			       	$objExcel->getActiveSheet()->mergeCells('E'.$intPosEncabezados.':F'.$intPosEncabezados);
			       	$objExcel->getActiveSheet()->mergeCells('H'.$intPosEncabezados.':I'.$intPosEncabezados);
			       	$objExcel->getActiveSheet()->mergeCells('J'.$intPosEncabezados.':K'.$intPosEncabezados);


			    	//Asignar el número de columnas de la cabecera 2
	 				$intNumColCabecera2 = count($arrCabecera2);

	 				//Inicializar los indices para escribir los datos de la cabecera 1
        			$intIndColE =  $this->archivoExcel['intIndColInicial'];

        			//Asignar columna final
		    		$strColFinal = $this->ARR_COLUMNAS[$intNumColCabecera2];

				  	//Hacer recorrido para obtener los datos de la cabecera 1
			    	foreach ($arrCabecera2 as $arrDet) 
			    	{
			    		//Asignar columna actual
			    		$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intPosEncabCab2;

			    		//Se agrega en el encabezado del archivo la cabecera 2
        				$objExcel->getActiveSheet()->setCellValue($strColActual, $arrDet);

        				//Incrementar indice de la columna
						$intIndColE++;  

			    	}//Cierre de foreach (cabecera 2)


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
	            	 ->getStyle('A'.$intPosEncabezados.':M'.$intPosEncabezados)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentCenter);

		    		$objExcel->getActiveSheet()
			            	 ->getStyle('A'.$intPosEncabCab2.':'.$strColFinal.$intPosEncabCab2)
			            	 ->getAlignment()
			            	 ->applyFromArray($arrStyleAlignmentCenter);


					//Incrementar contador por cada sucursal
					$intContadorHojas++;

				}//Cierre de verificación de sucursal


				//Asignar id de la sucursal actual
				$intSucursalIDActual = $arrCol->sucursal_id;

				//Asignar objeto con los datos del registro
				$otdDatos = $this->get_datos('EXCEL', $arrCol, $dteFechaInicial, $dteFechaFinal, 
											 $intAcumSubTotVenConIVA16, $intAcumIVAVenCon,
											 $intAcumSubTotVenConIVA0, $intAcumSubTotRecIVA16,
											 $intAcumIVARec, $intAcumSubTotRecIVA0,
											 $intAcumTotalComisiones, $intAcumSubTotDevConIVA16,
											 $intAcumIVADevConIVA16, $intAcumDevConIVA0);


				//Asignar array con los datos del registro
				$arrDatos = $otdDatos['rows'];
				//Asignar acumulados de las ventas
				$intAcumSubTotVenConIVA16 = $otdDatos['intAcumSubTotVenConIVA16'];
				$intAcumIVAVenCon = $otdDatos['intAcumIVAVenCon'];
				$intAcumSubTotVenConIVA0 = $otdDatos['intAcumSubTotVenConIVA0'];
				$intAcumSubTotRecIVA16 = $otdDatos['intAcumSubTotRecIVA16'];
				$intAcumIVARec = $otdDatos['intAcumIVARec'];
				$intAcumSubTotRecIVA0 = $otdDatos['intAcumSubTotRecIVA0'];
				$intAcumTotalComisiones = $otdDatos['intAcumTotalComisiones'];
				$intAcumSubTotDevConIVA16 = $otdDatos['intAcumSubTotDevConIVA16'];
				$intAcumIVADevConIVA16 = $otdDatos['intAcumIVADevConIVA16'];
				$intAcumDevConIVA0 = $otdDatos['intAcumDevConIVA0'];

				//Inicializar los indices para escribir los datos del registro
        		$intIndColE =  $this->archivoExcel['intIndColInicial'];


        		//Si el vendedor tiene comisiones
				if($arrDatos)
				{
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
			        		 ->getStyle('C'.$intFila.':'.$strColFinal)
			        		 ->getNumberFormat()
			        		 ->setFormatCode('$#,##0.00'); 

		        	//Cambiar alineación de las siguientes celdas
		        	$objExcel->getActiveSheet()
				        	 ->getStyle('C'.$intFila.':'.$strColFinal)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);


			    	//Incrementar el indice para escribir los datos del siguiente registro
					$intFila++;

				}//Cierre de verificación de comisiones

			}//Cierre de foreach

			//Escribir los totales del última sucursal
			if ($intSucursalIDActual > 0)
			{
				//Inicializar array´s
		        $arrAuxiliar = array();
		        $arrAcumulados = array();

		       //Definir valores del array auxiliar de información (para cada sucursal)
				$arrAuxiliar["intAcumSubTotVenConIVA16"] = $intAcumSubTotVenConIVA16;
				$arrAuxiliar["intAcumIVAVenCon"] = $intAcumIVAVenCon;
				$arrAuxiliar["intAcumSubTotVenConIVA0"] = $intAcumSubTotVenConIVA0;
				$arrAuxiliar["intAcumSubTotRecIVA16"] = $intAcumSubTotRecIVA16;
				$arrAuxiliar["intAcumIVARec"] = $intAcumIVARec;
				$arrAuxiliar["intAcumSubTotRecIVA0"] = $intAcumSubTotRecIVA0;
				$arrAuxiliar["intAcumTotalComisiones"] = $intAcumTotalComisiones;
				$arrAuxiliar["intAcumSubTotDevConIVA16"] = $intAcumSubTotDevConIVA16;
				$arrAuxiliar["intAcumIVADevConIVA16"] = $intAcumIVADevConIVA16;
				$arrAuxiliar["intAcumDevConIVA0"] = $intAcumDevConIVA0;
				//Asignar datos al array
           	 	array_push($arrAcumulados, $arrAuxiliar); 
           	 	//Hacer un llamado a la función para agregar totales y subtotales
	            $this->get_totales($objExcel, 'EXCEL', $arrAcumulados, $dteFechaInicial,
								   $dteFechaFinal, $intSucursalIDActual, $intFila);
		   	}

		}

		 //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'comisiones_refacciones.xls', 'comisiones', $intNumMaxRegistros); 
		
	}


	//Función que se utiliza para regresar los subtotales y totales de los vendedores
	public function get_totales($lib, $strTipoArchivo, $arrAcumulados, $dteFechaInicial,
								$dteFechaFinal, $intSucursalID, $intFilaExcel = NULL)
	{

		//Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));


		//Establece el ancho de las columnas de las cabeceras
		$arrAnchura = array(60, 20, 20, 18, 18, 18, 18, 18, 18, 18, 18, 18);

	    //Establece la alineación de las celdas de las tablas
		$arrAlineacion = array('L', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R');

		//Recorremos el arreglo 
		foreach ($arrAcumulados as $arrAcum)
		{

			/**********SUBTOTALES***********/
			//Calcular ventas de contado con IVA del 16%
			$intVentasConIVA16 = ($arrAcum['intAcumSubTotVenConIVA16'] + $arrAcum['intAcumIVAVenCon']);

			//Calcular recuperación de facturas con IVA del 16%
			$intRecFrasIVA16 = ($arrAcum['intAcumSubTotRecIVA16'] + $arrAcum['intAcumIVARec']);

			//Calcular recuperación total de facturas
			$intRecTotalFras = ($arrAcum['intAcumSubTotRecIVA16'] + $arrAcum['intAcumIVARec'] + 
								$arrAcum['intAcumSubTotRecIVA0']);


			//Calcular neto recuperado
			$intNeto = ($arrAcum['intAcumSubTotVenConIVA16'] + $arrAcum['intAcumIVAVenCon'] + 
						$arrAcum['intAcumSubTotVenConIVA0'] + $arrAcum['intAcumSubTotRecIVA16'] + 
						$arrAcum['intAcumIVARec'] + $arrAcum['intAcumSubTotRecIVA0'] - 
						$arrAcum['intAcumSubTotDevConIVA16'] - $arrAcum['intAcumIVADevConIVA16'] - 
						$arrAcum['intAcumDevConIVA0']);

			//Calcular neto recuperado sin IVA
			$intNetoSinIVA = ($arrAcum['intAcumSubTotVenConIVA16'] + $arrAcum['intAcumSubTotVenConIVA0'] + 
							  $arrAcum['intAcumSubTotRecIVA16'] + $arrAcum['intAcumSubTotRecIVA0'] - 
							  $arrAcum['intAcumSubTotDevConIVA16'] -  $arrAcum['intAcumDevConIVA0']);


			//Agregar al array los acumulados de subtotales
			$arrSubtotales = array('SUBTOTAL:');
			$arrSubtotales[] = '$'.number_format($intVentasConIVA16, 2, '.', ',');
	    	$arrSubtotales[] = '$'.number_format($arrAcum['intAcumSubTotVenConIVA0'], 2, '.', ',');
	    	$arrSubtotales[] = '$'.number_format($intRecFrasIVA16, 2, '.', ',');
			$arrSubtotales[] = '$'.number_format($arrAcum['intAcumSubTotRecIVA0'], 2, '.', ',');
		    $arrSubtotales[] = '$'.number_format($intRecTotalFras, 2, '.', ',');
			$arrSubtotales[] = '';
			$arrSubtotales[] = '';
			$arrSubtotales[] = '$'.number_format($intNeto, 2, '.', ',');
			$arrSubtotales[] = '$'.number_format($intNetoSinIVA, 2, '.', ',');
			$arrSubtotales[] = '';
			$arrSubtotales[] = '';
			

			/**********IMPORTE POR DEVOLUCIONES***********/
			//Seleccionar las devoluciones de la sucursal
	 		$otdDevolucionesSuc =  $this->facturas->buscar_devoluciones_sucursal($dteFechaInicial, 
	 																		 	$dteFechaFinal, 
	 																			$intSucursalID);

	 		//Variables que se utilizan para asignar acumulados
			$intAcumDevCreIVA16 = 0;
			$intAcumDevCreIVA0 = 0;

			//Verificar si  la sucursal tiene devoluciones de facturas
			if($otdDevolucionesSuc)
			{
				//Recorremos el arreglo 
				foreach ($otdDevolucionesSuc as $arrDev)
				{
					//Si la devolución tiene importe de IVA
					if ($arrDev->IVA > 0)
					{
						//Incrementar acumulado
						$intAcumDevCreIVA16 += ($arrDev->Subtotal + $arrDev->IVA + $arrDev->IEPS);
					}
					else
					{
						//Incrementar acumulado
						$intAcumDevCreIVA0 += ($arrDev->Subtotal + $arrDev->IEPS);
					}
				}

			}//Cierre de verificación de devoluciones


			//Calcular devoluciones de contado con IVA del 16%
			$intDevConIVA16 = ($arrAcum['intAcumSubTotDevConIVA16'] + $arrAcum['intAcumIVADevConIVA16']);

			//Calcular neto recuperado
			$intNetoDev = ($arrAcum['intAcumSubTotDevConIVA16'] + $arrAcum['intAcumIVADevConIVA16'] + 
						   $arrAcum['intAcumDevConIVA0'] + $intAcumDevCreIVA16 + 
						   $intAcumDevCreIVA0);

			//Agregar al array los acumulados de devoluciones
			$arrDevoluciones = array('IMPORTE POR DEVOLUCIONES:');
			$arrDevoluciones[] = '';
			$arrDevoluciones[] = '';
			$arrDevoluciones[] = '$'.number_format($intAcumDevCreIVA16, 2, '.', ',');
			$arrDevoluciones[] = '$'.number_format($intAcumDevCreIVA0, 2, '.', ',');
			$arrDevoluciones[] = '';
			$arrDevoluciones[] = '$'.number_format($intDevConIVA16, 2, '.', ',');
			$arrDevoluciones[] = '$'.number_format($arrAcum['intAcumDevConIVA0'], 2, '.', ',');
			$arrDevoluciones[] = '$'.number_format($intNetoDev, 2, '.', ',');
			$arrDevoluciones[] = '';
			$arrDevoluciones[] = '';
			$arrDevoluciones[] = '';


			/**********IMPORTE POR DESCUENTOS***********/
			//Seleccionar los descuentos de la sucursal
	 		$otdDescuentosSuc =  $this->facturas->buscar_descuentos_sucursal($dteFechaInicial, 
	 																	 	 $dteFechaFinal, 
	 																	     $intSucursalID);

	 		//Variables que se utilizan para asignar acumulados
			$intAcumDesConIVA16 = 0;
			$intAcumDesConIVA0 = 0;
			$intAcumDesCreIVA16 = 0;
			$intAcumDesCreIVA0 = 0;

			//Verificar si la sucursal tiene descuentos
			if($otdDescuentosSuc)
			{
				//Recorremos el arreglo 
				foreach ($otdDescuentosSuc as $arrDesc)
				{
					//Dependiendo de las condiciones de pago incrementar acumulados
					if ($arrDesc->condiciones_pago == 'CONTADO')
					{
						//Si el descuento tiene importe de IVA
						if ($arrDesc->iva > 0)
						{
							//Incrementar acumulado
							$intAcumDesConIVA16 += ($arrDesc->precio + $arrDesc->iva + $arrDesc->ieps);
						}
						else
						{
							//Incrementar acumulado
							$intAcumDesConIVA0 += ($arrDesc->precio + $arrDesc->ieps);
						}
					}
					else
					{
						//Si el descuento tiene importe de IVA
						if ($arrDesc->iva > 0)
						{
							//Incrementar acumulado
							$intAcumDesCreIVA16 += ($arrDesc->precio + $arrDesc->iva + $arrDesc->ieps);
						}
						else
						{
							//Incrementar acumulado
							$intAcumDesCreIVA0 += ($arrDesc->precio + $arrDesc->ieps);
						}
					}
				}

			}//Cierre de verificación de descuentos


			//Calcular neto recuperado
			$intNetoDesc = ($intAcumDesConIVA16 + $intAcumDesConIVA0 + 
							$intAcumDesCreIVA16 + $intAcumDesCreIVA0);

			//Agregar al array los acumulados de descuentos
			$arrDescuentos = array('IMPORTE POR DESCUENTOS:');
			$arrDescuentos[] = '$'.number_format($intAcumDesConIVA16, 2, '.', ',');
			$arrDescuentos[] = '$'.number_format($intAcumDesConIVA0, 2, '.', ',');
			$arrDescuentos[] = '$'.number_format($intAcumDesCreIVA16, 2, '.', ',');
			$arrDescuentos[] = '$'.number_format($intAcumDesCreIVA0, 2, '.', ',');
			$arrDescuentos[] = '';
			$arrDescuentos[] = '';
			$arrDescuentos[] = '';
			$arrDescuentos[] = '$'.number_format($intNetoDesc, 2, '.', ',');
			$arrDescuentos[] = '';
			$arrDescuentos[] = '';
			$arrDescuentos[] = '';


			/**********TOTAL DISMINUIDO DE CODIGOS CLIENTES***********/
			//Calcular ventas de contado con IVA del 16%
			$intVentasCtesConIVA16 = ($arrAcum['intAcumSubTotVenConIVA16'] + $arrAcum['intAcumIVAVenCon'] + 
									  $intAcumDesConIVA16);

			//Calcular ventas de contado con IVA del 0%
			$intVentasCtesConIVA0 = ($arrAcum['intAcumSubTotVenConIVA0'] + $intAcumDesConIVA0);

			//Calcular recuperación de facturas con IVA del 16%
			$intRecCtesFrasIVA16 = ($arrAcum['intAcumSubTotRecIVA16'] + $arrAcum['intAcumIVARec'] + 
									$intAcumDevCreIVA16 + $intAcumDesCreIVA16);

			//Calcular recuperación de facturas con IVA del 0%
			$intRecCtesFrasIVA0 = ($arrAcum['intAcumSubTotRecIVA0'] + $intAcumDevCreIVA0 + $intAcumDesCreIVA0);

			//Calcular recuperación total de facturas
			$intRecCtesTotalFras = ($arrAcum['intAcumSubTotRecIVA16'] + $arrAcum['intAcumIVARec']  + 
									$intAcumDevCreIVA16 + $intAcumDesCreIVA16 + 
									$arrAcum['intAcumSubTotRecIVA0'] + $intAcumDevCreIVA0 + $intAcumDesCreIVA0);

			//Calcular neto recuperado
			$intNetoCtes = ($arrAcum['intAcumSubTotVenConIVA16'] + $arrAcum['intAcumIVAVenCon']+ 
							$arrAcum['intAcumSubTotVenConIVA0'] + $arrAcum['intAcumSubTotRecIVA16'] + 
							$arrAcum['intAcumIVARec'] + $arrAcum['intAcumSubTotRecIVA0'] + 
							$intAcumDevCreIVA16 + $intAcumDevCreIVA0 + $intAcumDesConIVA16 + 
							$intAcumDesConIVA0 + $intAcumDesCreIVA16 + $intAcumDesCreIVA0);

			//Agregar al array los acumulados de lo disminuido de códigos de clientes
			$arrDisminuidosCtes = array('TOTAL DISMINUIDO DE CODIGOS CLIENTES:');
			$arrDisminuidosCtes[] = '$'.number_format($intVentasCtesConIVA16, 2, '.', ',');
		    $arrDisminuidosCtes[] = '$'.number_format($intVentasCtesConIVA0, 2, '.', ',');
 			$arrDisminuidosCtes[] = '$'.number_format($intRecCtesFrasIVA16, 2, '.', ',');
			$arrDisminuidosCtes[] = '$'.number_format($intRecCtesFrasIVA0, 2, '.', ',');
			$arrDisminuidosCtes[] = '$'.number_format($intRecCtesTotalFras, 2, '.', ',');
			$arrDisminuidosCtes[] = '';
			$arrDisminuidosCtes[] = '';
			$arrDisminuidosCtes[] = '$'.number_format($intNetoCtes, 2, '.', ',');
			$arrDisminuidosCtes[] = '';
			$arrDisminuidosCtes[] = '';
			$arrDisminuidosCtes[] = '';


			/**********COMISIONES FIJAS***********/
			//Calcular recuperación total de facturas
			$intRecComisTotalFras = ($arrAcum['intAcumSubTotVenConIVA16'] + $arrAcum['intAcumSubTotVenConIVA0'] 
									 + $arrAcum['intAcumSubTotRecIVA16'] + $arrAcum['intAcumSubTotRecIVA0'] - 
									  $arrAcum['intAcumSubTotDevConIVA16'] -  $arrAcum['intAcumDevConIVA0']);

			//Agregar al array el importe base para comisiones fijas
			$arrComisionesFijas = array('IMPORTE BASE PARA COMISIONES FIJAS:');
			$arrComisionesFijas[] = '';
			$arrComisionesFijas[] = '';
			$arrComisionesFijas[] = '';
			$arrComisionesFijas[] = '';
			$arrComisionesFijas[] = '';
			$arrComisionesFijas[] = '';
			$arrComisionesFijas[] = '';
			$arrComisionesFijas[] = '';
			$arrComisionesFijas[] = '$'.number_format($intRecComisTotalFras, 2, '.', ',');
			$arrComisionesFijas[] = '';
			$arrComisionesFijas[] = '';


			/**********REFACCIONES FACTURADAS POR TALLER***********/
			//Seleccionar las refacciones de la sucursal facturadas por taller
	 		$otdRefTallSuc = $this->facturas->buscar_refacciones_taller($dteFechaInicial, 
																    	$dteFechaFinal, 
																    	$intSucursalID);


			//Variable que se utilizan para asignar acumulado
			$intAcumRefTal = 0;

			//Verificar si la sucursal tiene refacciones facturadas por taller
			if($otdRefTallSuc)
			{
				//Recorremos el arreglo 
				foreach ($otdRefTallSuc as $arrRef)
				{
					//Si existe saldo de la factura
					if (($arrRef->Saldo < 1) && ($arrRef->Saldo > -1))
					{
						//Incrementar acumulado
						$intAcumRefTal += $arrRef->ImporteRefacciones;
					}
				}

			}//Cierre de verificación de refacciones facturadas por taller

			//Agregar al array los acumulados de las refacciones facturadas por taller
			$arrRefTaller = array('REFACCIONES FACTURADAS POR TALLER:');
			$arrRefTaller[] = '';
			$arrRefTaller[] = '';
			$arrRefTaller[] = '';
			$arrRefTaller[] = '';
			$arrRefTaller[] = '';
			$arrRefTaller[] = '';
			$arrRefTaller[] = '';
			$arrRefTaller[] = '';
			$arrRefTaller[] = '$'.number_format($intAcumRefTal, 2, '.', ',');
			$arrRefTaller[] = '';
			$arrRefTaller[] = '';



			//Si el tipo de archivo es PDF
			if($strTipoArchivo == 'PDF')
			{

				//Escribir totales
				//Cambiar el volumen de la fuente a bold
		   	 	$lib->strTipoLetraTabla = 'Negrita';

		   	 	//Establece el ancho de las columnas
				$lib->SetWidths($arrAnchura);
				//Se agrega la información de los acumulados
		   		$lib->Row($arrSubtotales, $arrAlineacion, 'ClippedCell');

		   		//Se agrega la información de las devoluciones
		   		$lib->Row($arrDevoluciones, $arrAlineacion, 'ClippedCell');

		   		//Se agrega la información de los descuentos
		   		$lib->Row($arrDescuentos, $arrAlineacion, 'ClippedCell');

		   		//Se agrega la información del total disminuido de códigos clientes
		   		$lib->Row($arrDisminuidosCtes, $arrAlineacion, 'ClippedCell');

		   		//Se agrega la información de las comisiones fijas
		   		$lib->Row($arrComisionesFijas, $arrAlineacion, 'ClippedCell');

		   		//Se agrega la información de las refacciones facturadas por taller
		   		$lib->Row($arrRefTaller, $arrAlineacion, 'ClippedCell');

		   		//Cambiar el volumen de la fuente a normal
		    	$lib->strTipoLetraTabla = '';

			}
			else //Si el tipo de archivo es Excel
			{

				//Asignar el número de columna donde se empezaran a escribir los subtotales 
				$intIndColE = $this->archivoExcel['intIndColInicial'];

				//Asignar el número de columnas de la cabecera 2
	 			$intNumColCabecera2 = count($arrSubtotales);

	 			//Asignar el indice de la fila para escribir los subtotales
	 			$intFilaSubtotal =  $intFilaExcel;

	 			//Asignar el indice de la columna nombre del vendedor
			    $intIndColNomVend = 2;


				//Hacer recorrido para obtener los datos de los subtotales
				foreach ($arrSubtotales as $arrDet) 
				{	
					//Si el indice de la columna corresponde al nombre del vendedor
					if ($intIndColE == $intIndColNomVend) 
					{	
						//Incrementar indice para escribir acumulados
					    $intIndColE++;
					}

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

				//Incrementar el indice para escribir los datos de las devoluciones
				$intFilaExcel++;


				//Asignar el número de columna donde se empezaran a escribir las devoluciones
				$intIndColE = $this->archivoExcel['intIndColInicial'];

				//Hacer recorrido para obtener los datos de las devoluciones
				foreach ($arrDevoluciones as $arrDet) 
				{	
					//Si el indice de la columna corresponde al nombre del vendedor
					if ($intIndColE == $intIndColNomVend) 
					{	
						//Incrementar indice para escribir acumulados
					    $intIndColE++;
					}

					//Asignar columna actual
					$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaExcel;

					//Reemplazar '$' por cadena vacia
					$arrDet  = str_replace('$', '', $arrDet);
					//Reemplazar ',' por cadena vacia
					$arrDet  = str_replace(',', '', $arrDet);

					//Agregar información del acumulado
					$lib->getActiveSheet()
	                    ->setCellValue($strColActual, $arrDet);
	                    
	                //Incrementar indice de la columna
					$intIndColE++;     
					
				}//Cierre de foreach (devoluciones)


				//Incrementar el indice para escribir los datos de los descuentos
				$intFilaExcel++;


				//Asignar el número de columna donde se empezaran a escribir los descuentos
				$intIndColE = $this->archivoExcel['intIndColInicial'];

				//Hacer recorrido para obtener los datos de los descuentos
				foreach ($arrDescuentos as $arrDet) 
				{	
					//Si el indice de la columna corresponde al nombre del vendedor
					if ($intIndColE == $intIndColNomVend) 
					{	
						//Incrementar indice para escribir acumulados
					    $intIndColE++;
					}

					//Asignar columna actual
					$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaExcel;

					//Reemplazar '$' por cadena vacia
					$arrDet  = str_replace('$', '', $arrDet);
					//Reemplazar ',' por cadena vacia
					$arrDet  = str_replace(',', '', $arrDet);

					//Agregar información del acumulado
					$lib->getActiveSheet()
	                    ->setCellValue($strColActual, $arrDet);
	                    
	                //Incrementar indice de la columna
					$intIndColE++;     
					
				}//Cierre de foreach (descuentos)


				//Incrementar el indice para escribir los datos del total disminuido de códigos clientes
				$intFilaExcel++;


				//Asignar el número de columna donde se empezaran a escribir el total disminuido de códigos clientes
				$intIndColE = $this->archivoExcel['intIndColInicial'];

				//Hacer recorrido para obtener los datos del total disminuido de códigos clientes
				foreach ($arrDisminuidosCtes as $arrDet) 
				{	
					//Si el indice de la columna corresponde al nombre del vendedor
					if ($intIndColE == $intIndColNomVend) 
					{	
						//Incrementar indice para escribir acumulados
					    $intIndColE++;
					}

					//Asignar columna actual
					$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaExcel;

					//Reemplazar '$' por cadena vacia
					$arrDet  = str_replace('$', '', $arrDet);
					//Reemplazar ',' por cadena vacia
					$arrDet  = str_replace(',', '', $arrDet);

					//Agregar información del acumulado
					$lib->getActiveSheet()
	                    ->setCellValue($strColActual, $arrDet);
	                    
	                //Incrementar indice de la columna
					$intIndColE++;     
					
				}//Cierre de foreach (disminuido de códigos clientes)


				//Incrementar el indice para escribir los datos de las comisiones fijas
				$intFilaExcel++;


				//Asignar el número de columna donde se empezaran a escribir las comisiones fijas
				$intIndColE = $this->archivoExcel['intIndColInicial'];
				
				//Hacer recorrido para obtener los datos de las comisiones fijas
				foreach ($arrComisionesFijas as $arrDet) 
				{	
					//Si el indice de la columna corresponde al nombre del vendedor
					if ($intIndColE == $intIndColNomVend) 
					{	
						//Incrementar indice para escribir acumulados
					    $intIndColE++;
					}

					//Asignar columna actual
					$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaExcel;

					//Reemplazar '$' por cadena vacia
					$arrDet  = str_replace('$', '', $arrDet);
					//Reemplazar ',' por cadena vacia
					$arrDet  = str_replace(',', '', $arrDet);

					//Agregar información del acumulado
					$lib->getActiveSheet()
	                    ->setCellValue($strColActual, $arrDet);
	                    
	                //Incrementar indice de la columna
					$intIndColE++;     
					
				}//Cierre de foreach (comisiones fijas)



				//Incrementar el indice para escribir los datos de las refacciones facturadas por taller
				$intFilaExcel++;


				//Asignar el número de columna donde se empezaran a escribir las refacciones facturadas por taller
				$intIndColE = $this->archivoExcel['intIndColInicial'];

				//Hacer recorrido para obtener los datos de las refacciones facturadas por taller
				foreach ($arrRefTaller as $arrDet) 
				{	
					//Si el indice de la columna corresponde al nombre del vendedor
					if ($intIndColE == $intIndColNomVend) 
					{	
						//Incrementar indice para escribir acumulados
					    $intIndColE++;
					}

					//Asignar columna actual
					$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaExcel;

					//Reemplazar '$' por cadena vacia
					$arrDet  = str_replace('$', '', $arrDet);
					//Reemplazar ',' por cadena vacia
					$arrDet  = str_replace(',', '', $arrDet);

					//Agregar información del acumulado
					$lib->getActiveSheet()
	                    ->setCellValue($strColActual, $arrDet);
	                    
	                //Incrementar indice de la columna
					$intIndColE++;     
					
				}//Cierre de foreach (refacciones facturadas por taller)


			    //Asignar columna final
			    $strColFinal = $this->ARR_COLUMNAS[$intNumColCabecera2].$intFilaExcel;

	            //Cambiar contenido de las celdas a formato moneda
                $lib->getActiveSheet()
	        		->getStyle('C'.$intFilaSubtotal.':'.$strColFinal)
	        		->getNumberFormat()
	        		->setFormatCode('$#,##0.00');  


	        	//Cambiar alineación de las siguientes celdas
	        	$lib->getActiveSheet()
		        	 ->getStyle('C'.$intFilaSubtotal.':'.$strColFinal)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);


		        //Cambiar estilo de las siguientes celdas
		        $lib->getActiveSheet()
	                ->getStyle('A'.$intFilaSubtotal.':'.$strColFinal)
	                ->applyFromArray($arrStyleBold);

			}
			
	    }
	}

	//Función que se utiliza para regresar array con los datos de un registro
	public function get_datos($strTipoArchivo, $arrCol, $dteFechaInicial, $dteFechaFinal, 
							 $intAcumSubTotVenConIVA16, $intAcumIVAVenCon,
							 $intAcumSubTotVenConIVA0, $intAcumSubTotRecIVA16,
							 $intAcumIVARec, $intAcumSubTotRecIVA0,
							 $intAcumTotalComisiones, $intAcumSubTotDevConIVA16,
							 $intAcumIVADevConIVA16, $intAcumDevConIVA0)
	{
		

        //Array que se utiliza para enviar datos
		$arrDatos = array('rows' => NULL,
						   'intAcumSubTotVenConIVA16' => 0, 
						   'intAcumIVAVenCon'  => 0, 
						   'intAcumSubTotVenConIVA0' => 0, 
						   'intAcumSubTotRecIVA16' => 0, 
						   'intAcumIVARec' => 0, 
						   'intAcumSubTotRecIVA0' => 0, 
						   'intAcumTotalComisiones' => 0, 
						   'intAcumSubTotDevConIVA16' => 0, 
						   'intAcumIVADevConIVA16' => 0, 
						   'intAcumDevConIVA0' => 0);


		 //Array que se utiliza para agregar los datos de un registro
        $arrRegistro = array();

        //Si el tipo de archivo es PDF
        if($strTipoArchivo == 'PDF')
        {
        	$arrCol->Vendedor = utf8_decode($arrCol->Vendedor);
        }

       
		/**********VENTAS DE CONTADO***********/
		//Seleccionar las ventas de contado del vendedor
        $otdVentasContado = $this->facturas->buscar_ventas_contado_vendedor($dteFechaInicial, $dteFechaFinal, 
        															 $arrCol->vendedor_id);
        //Variables que se utilizan para asignar acumulados
        $intAcumTotalRecuperado = 0;
		$intAcumTotIVA0 = 0;
		$intAcumIVA16Con = 0;
		$intAcumIVA0Con = 0;
		$intAcumComisiones = 0;

		//Verificar si el vendedor tiene ventas de contado
		if($otdVentasContado)
		{
			//Recorremos el arreglo 
			foreach ($otdVentasContado as $arrVtas)
			{
				//Si existe importe de IVA
				if ($arrVtas->IVA > 0)
				{
					//Incrementar acumulados
					$intAcumIVA16Con += $arrVtas->Subtotal + $arrVtas->IVA + $arrVtas->IEPS;
					$intAcumSubTotVenConIVA16 += $arrVtas->Subtotal + $arrVtas->IEPS;
					$intAcumIVAVenCon += $arrVtas->IVA;
				}
				else
				{
					//Incrementar acumulados
					$intAcumIVA0Con += $arrVtas->Subtotal + $arrVtas->IEPS;
					$intAcumSubTotVenConIVA0 += $arrVtas->Subtotal;
				}

				//Incrementar acumulados
				$intAcumComisiones += $arrVtas->Subtotal;
				$intAcumTotalRecuperado += $arrVtas->Subtotal + $arrVtas->IVA + $arrVtas->IEPS;
			}




		}//Cierre de verificación de ventas de contado


		/**********ABONOS***********/
		//Seleccionar las ventas de contado del vendedor
        $otdAbonos = $this->facturas->buscar_abonos_vendedor($dteFechaInicial, $dteFechaFinal, 
        													 $arrCol->vendedor_id);

        //Variables que se utilizan para asignar acumulados
        $intAcumIVA16Cre = 0;
	    $intAcumIVA0Cre = 0;


	    //Verificar si el vendedor tiene abonos
		if($otdAbonos)
		{
			//Recorremos el arreglo 
			foreach ($otdAbonos as $arrRec)
			{
				//Si existe importe de IVA
				if ($arrRec->IVA > 0)
				{
					//Incrementar acumulados
					$intAcumIVA16Cre += $arrRec->Abono;
					$intAcumSubTotRecIVA16 += $arrRec->Abono/1.16;
					$intAcumIVARec += ($arrRec->Abono - ($arrRec->Abono/1.16));
					$intAcumComisiones += $arrRec->Abono/1.16;
				}
				else
				{
					//Incrementar acumulados
					$intAcumIVA0Cre += $arrRec->Abono;
					$intAcumSubTotRecIVA0 += $arrRec->Abono;
					$intAcumComisiones += $arrRec->Abono;
				}

				//Incrementar acumulado
				$intAcumTotalRecuperado += $arrRec->Abono;
			}

		}//Cierre de verificación de abonos

		
		/**********DEVOLUCIONES***********/
		//Seleccionar las devoluciones del vendedor
        $otdDevoluciones = $this->facturas->buscar_devoluciones_vendedor($dteFechaInicial, $dteFechaFinal, 
        													 	   		 $arrCol->vendedor_id);
        //Variables que se utilizan para asignar acumulados
        $intAcumIVA16Dev = 0;
	    $intAcumIVA0Dev = 0;

         //Verificar si el vendedor tiene devoluciones
		if($otdDevoluciones)
		{
			//Recorremos el arreglo 
			foreach ($otdDevoluciones as $arrDev)
			{
				//Si existe importe de IVA
				if ($arrDev->IVA > 0)
				{
					//Incrementar acumulados
					$intAcumSubTotDevConIVA16 += ($arrDev->Subtotal + $arrDev->IEPS);
					$intAcumIVADevConIVA16 += $arrDev->IVA;
					$intAcumIVA16Dev += ($arrDev->Subtotal + $arrDev->IVA + $arrDev->IEPS);
				}
				else
				{
					//Incrementar acumulados
					$intAcumDevConIVA0 += ($arrDev->Subtotal + $arrDev->IEPS);
					$intAcumIVA0Dev += ($arrDev->Subtotal + $arrDev->IEPS);
				}

				//Incrementar acumulado
				$intAcumComisiones -= ($arrDev->Subtotal + $arrDev->IEPS);
			}

		}//Cierre de verificación de devoluciones


		//Si el vendedor tiene comisiones
		if ($intAcumComisiones > 0)
	    {
	    	//Calcular recuperación total
			$intRecTotal = ($intAcumIVA16Cre + $intAcumIVA0Cre);

			//Calcular neto recuperado
			$intNeto = ($intAcumTotalRecuperado - $intAcumIVA16Dev - $intAcumIVA0Dev);

			//Asignar al array los datos del registro
        	$arrRegistro = array($arrCol->codigo, $arrCol->Vendedor);
        	$arrRegistro[] = '$'.number_format($intAcumIVA16Con, 2, '.', ',');
			$arrRegistro[] = '$'.number_format($intAcumIVA0Con, 2, '.', ',');
			$arrRegistro[] = '$'.number_format($intAcumIVA16Cre, 2, '.', ',');
			$arrRegistro[] = '$'.number_format($intAcumIVA0Cre, 2, '.', ',');
			$arrRegistro[] = '$'.number_format($intRecTotal, 2, '.', ',');
			$arrRegistro[] = '$'.number_format($intAcumIVA16Dev, 2, '.', ',');
			$arrRegistro[] = '$'.number_format($intAcumIVA0Dev, 2, '.', ',');
			$arrRegistro[] = '$'.number_format($intNeto, 2, '.', ',');
			$arrRegistro[] = '$'.number_format($intAcumComisiones, 2, '.', ',');
			$arrRegistro[] = '';
			$arrRegistro[] = '';

		}//Cierre de verificación de comisiones


		//Agregar datos al array
		$arrDatos['rows'] = $arrRegistro;
		$arrDatos['intAcumSubTotVenConIVA16'] = $intAcumSubTotVenConIVA16;
		$arrDatos['intAcumIVAVenCon'] = $intAcumIVAVenCon;
		$arrDatos['intAcumSubTotVenConIVA0'] = $intAcumSubTotVenConIVA0;
		$arrDatos['intAcumSubTotRecIVA16'] = $intAcumSubTotRecIVA16;
		$arrDatos['intAcumIVARec'] = $intAcumIVARec;
		$arrDatos['intAcumSubTotRecIVA0'] = $intAcumSubTotRecIVA0;
		$arrDatos['intAcumTotalComisiones'] = $intAcumTotalComisiones;
		$arrDatos['intAcumSubTotDevConIVA16'] = $intAcumSubTotDevConIVA16;
		$arrDatos['intAcumIVADevConIVA16'] = $intAcumIVADevConIVA16;
		$arrDatos['intAcumDevConIVA0'] = $intAcumDevConIVA0;

		//Regresar array con los datos de del registro
		return $arrDatos;
	}

   
}	