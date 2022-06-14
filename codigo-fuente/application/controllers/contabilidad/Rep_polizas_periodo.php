<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_polizas_periodo extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de pólizas
		$this->load->model('contabilidad/polizas_model', 'polizas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('contabilidad/rep_polizas_periodo.php', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el listado de pólizas por periodo
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strTipoPoliza =  $this->input->post('strTipoPoliza');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strModulos = trim($this->input->post('strModulos'));


		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');


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
		}

		//Quitar último elemento de la cadena (,)
		$strTituloSucursales = substr($strTituloSucursales, 0, -2);

		//Buscar el nombre de los Módulos que han sido seleccionados y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 3
	    $strTituloModulos = '';
	    $arrDescripcionesModulos = explode('|', $strModulos);
	    //Hacer recorrido para obtener las descripciones de los modulos 
	    foreach ($arrDescripcionesModulos as &$strModulo) 
	    {
			//Concatenamos el nombre del modulo a la variable de impresión
			$strTituloModulos .= $strModulo.', ';
		}

		//Quitar último elemento de la cadena (,)
		$strTituloModulos = substr($strTituloModulos, 0, -2);

		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->polizas->buscar_polizas($dteFechaInicial, $dteFechaFinal,
								  					   NULL, NULL, $strTipoPoliza,  
								  					   $strSucursales, $strModulos);


		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  utf8_decode('LISTADO DE PÓLIZAS DEL PERIODO ').$strTituloRangoFechas;
		//Asignar el valor de la línea dos del título
		$pdf->strLinea2 = utf8_decode('SUCURSALES: '.trim($strTituloSucursales));
		//Asignar el valor de la línea tres del título
		$pdf->strLinea3 = utf8_decode('MÓDULOS: '.trim($strTituloModulos));

		//Si existe tipo de póliza
		if($strTipoPoliza != '')
		{
			//Asignar el valor de la línea cuatro del título
			$pdf->strLinea4 =  utf8_decode('TIPO DE PÓLIZA: '.$strTipoPoliza);
		}
		
		
		//Agregar la primer pagina
		$pdf->AddPage();
		//Crea los titulos de la cabecera detalles de la póliza
		$arrCabecera = array('Ren.', 'Cuenta', utf8_decode('Descripción'), 'Cargo', 'Abono');
		//Establece el ancho de las columnas de cabecera
		$arrAnchura = array(15, 25, 100, 25, 25);
		//Establece la alineación de las celdas de la tabla
		$arrAlineacion = array('C', 'L', 'L', 'R', 'R');

	    //Establecer el color de fondo para la cabecera
		$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		//$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Si hay información
		if($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//------------------------------------------------------------------------------------------------------------------------
		        //---------- DATOS DE LA PÓLIZA
		        //------------------------------------------------------------------------------------------------------------------------
				//Dibuja una línea para separar la información de cada póliza
	    		$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
	    		$pdf->Ln(1);//Deja un salto de línea
				$pdf->SetTextColor(0); //establece el color de texto
				//Folio
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(10, 3, 'FOLIO');
				//Sucursal
				$pdf->SetX(80);
				$pdf->ClippedCell(15, 3, 'SUCURSAL');
				//Fecha
				$pdf->SetX(160);
				$pdf->ClippedCell(15, 3, 'FECHA');
				//Información
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Folio
				$pdf->SetX(40);
				$pdf->ClippedCell(30, 3, $arrCol->folio);
				//Sucursal
				$pdf->SetX(98);
				$pdf->ClippedCell(60, 3, utf8_decode($arrCol->sucursal));
				//Fecha
				$pdf->SetX(180);
				$pdf->ClippedCell(30, 3, $arrCol->fecha);
				$pdf->Ln(3);//Deja un salto de línea
				//Tipo de póliza
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(25, 3, utf8_decode('TIPO DE PÓLIZA'));
				//Estatus
				$pdf->SetX(80);
				$pdf->ClippedCell(18, 3, 'ESTATUS');
				//Información
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Tipo de póliza
				$pdf->SetX(40);
				$pdf->ClippedCell(45, 3, $arrCol->tipo);
				//Sucursal
				$pdf->SetX(98);
				$pdf->ClippedCell(40, 3, $arrCol->estatus);
				$pdf->Ln(3);//Deja un salto de línea
				//Módulo
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(20, 3, utf8_decode('MÓDULO'));
				//Proceso
				$pdf->SetX(80);
				$pdf->ClippedCell(20, 3, 'PROCESO');
				//Referencia
				$pdf->SetX(160);
				$pdf->ClippedCell(20, 3, 'REFERENCIA');
				//Información
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Módulo
				$pdf->SetX(40);
				$pdf->ClippedCell(40, 3, $arrCol->modulo);
				//Proceso
				$pdf->SetX(98);
				$pdf->ClippedCell(90, 3, $arrCol->proceso);
				//Referencia
				$pdf->SetX(180);
				$pdf->ClippedCell(20, 3, $arrCol->referencia);
				$pdf->Ln(3);//Deja un salto de línea
				//Concepto
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(25, 3, 'CONCEPTO');
				$pdf->SetX(40);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(155, 3, utf8_decode($arrCol->concepto));
				$pdf->Ln(5);//Deja un salto de línea

				//------------------------------------------------------------------------------------------------------------------------
		        //---------- DETALLES DE LA PÓLIZA
		        //------------------------------------------------------------------------------------------------------------------------	
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);

				//Seleccionar los detalles de la póliza
				$otdDetalles = $this->polizas->buscar_detalles($arrCol->poliza_id);
				//Variable que se utiliza para asignar el acumulado de los cargos
				$intAcumCargos = 0;
				//Variable que se utiliza para asignar el acumulado de los abonos
				$intAcumAbonos = 0;

				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{

					//Recorre el array de títulos de encabezado para crearlos
					for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
					{
						//inserta los titulos de la cabecera
						$pdf->Cell($arrAnchura[$intCont], 3, $arrCabecera[$intCont], 1, 0, 
								   $arrAlineacion[$intCont], TRUE);
					}
					$pdf->Ln(); //Deja un salto de línea
					
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{ 
						//Variable que se utiliza para asignar el concepto 
						$strConcepto = $arrDet->concepto;
						//Variable que se utiliza para asignar la referencia  
						$strReferencia = $arrDet->referencia;
						//Variable que se utiliza para asignar el importe del cargo
						$intCargo = 0;
						//Variable que se utiliza para asignar el importe del cargo con formato moneda
						$strCargo = '';
						//Variable que se utiliza para asignar el importe del abono
						$intAbono = 0;
						//Variable que se utiliza para asignar el importe del abono con formato moneda
						$strAbono = '';
						//Variable que se utiliza para asignar la naturaleza
						$strNaturaleza = $arrDet->naturaleza;
						//Variable que se utiliza para asignar el importe
						$intImporte = $arrDet->importe;


						//Dependiendo de la naturaleza, asignar importe
						if($strNaturaleza == 'CARGO')
						{
							$intCargo =  $intImporte;
							$strCargo = '$'.number_format($intImporte,2);
						}
						else
						{
							$intAbono =  $intImporte;
							$strAbono = '$'.number_format($intImporte,2);
						}


						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchura);
						//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						$pdf->Row(array($arrDet->renglon, 
									    utf8_decode($arrDet->cuenta),
									    utf8_decode($arrDet->cuenta_descripcion), $strCargo, 
									    $strAbono), 
										$arrAlineacion, 'ClippedCell');

						//Si existe concepto o referencia
						if($strConcepto != '' OR $strReferencia != '')
						{
							//Asigna el tipo y tamaño de letra
					        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
							//Si existe concepto
							if($strConcepto != '')
							{
								//Concepto
								$pdf->Cell(15, 4, 'CONCEPTO:', 0, 0, 'L', 0);
						    	$pdf->ClippedCell(60, 4, utf8_decode($strConcepto), 0, 0, 'L', 0);
							}

							//Si existe referencia
							if($strReferencia != '')
							{
								//Referencia
					    		$pdf->Cell(17, 4, 'REFERENCIA:', 0, 0, 'L', 0);
						   	    $pdf->ClippedCell(60, 4, utf8_decode($strReferencia), 0, 0, 'L', 0);
							}
							
					    	
						    $pdf->Ln(4);//Deja un salto de línea
						}

						//Incrementar acumulados
						$intAcumCargos += $intCargo;
						$intAcumAbonos += $intAbono;

					}

					//Dibuja una línea para separar la información de cada prospecto
			    	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
			    	$pdf->Ln(1); //Deja un salto de línea
			    	//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			    	//Total
					$pdf->SetX(120);
					$pdf->ClippedCell(30, 3, 'TOTALES:', 0, 0, 'R');
					//Acumulado del cargo
					$pdf->ClippedCell(25, 3, '$'.number_format($intAcumCargos,2), 0, 0, 'R');
					//Acumulado del abono
					$pdf->ClippedCell(25, 3, '$'.number_format($intAcumAbonos,2), 0, 0, 'R'); 
					$pdf->Ln(4); //Deja un salto de línea


				}//Cierre de verificación de detalles

		    	
			}

		}//Cierre de verificación de información


		//Ejecutar la salida del reporte
        $pdf->Output('listado_polizas_periodo.pdf','I'); 
	}
	

	/*Método para generar un archivo XLS con el listado de pólizas  por periodo
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strTipoPoliza =  $this->input->post('strTipoPoliza');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strModulos = trim($this->input->post('strModulos'));
		
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 11;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 12;
        $intFilaInicial = 12;
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
		}

		//Quitar último elemento de la cadena (,)
		$strTituloSucursales = substr($strTituloSucursales, 0, -2);

		//Buscar el nombre de los Módulos que han sido seleccionados y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 3
	    $strTituloModulos = '';
	    $arrDescripcionesModulos = explode('|', $strModulos);
	    //Hacer recorrido para obtener las descripciones de los modulos 
	    foreach ($arrDescripcionesModulos as &$strModulo) 
	    {
			//Concatenamos el nombre del modulo a la variable de impresión
			$strTituloModulos .= $strModulo.', ';
		}

		//Quitar último elemento de la cadena (,)
		$strTituloModulos = substr($strTituloModulos, 0, -2);

		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->polizas->buscar_polizas($dteFechaInicial, $dteFechaFinal,
								  					   NULL, NULL, $strTipoPoliza,  
								  					   $strSucursales, $strModulos);


     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE PÓLIZAS DEL PERIODO '.$strTituloRangoFechas)
			     ->setCellValue('A8', 'SUCURSALES: '.$strTituloSucursales)
			     ->setCellValue('A9', 'MÓDULOS: '.$strTituloModulos);

		//Si existe tipo de póliza
		if($strTipoPoliza != NULL)
		{
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A10', 'TIPO DE PÓLIZA: '.$strTipoPoliza);
		}

		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'SUCURSAL')
        		 ->setCellValue('C'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('D'.$intPosEncabezados, 'TIPO DE PÓLIZA')
        		 ->setCellValue('E'.$intPosEncabezados, 'ESTATUS')
        		 ->setCellValue('F'.$intPosEncabezados, 'MÓDULO')
        		 ->setCellValue('G'.$intPosEncabezados, 'PROCESO')
        		 ->setCellValue('H'.$intPosEncabezados, 'REFERENCIA')
        		 ->setCellValue('I'.$intPosEncabezados, 'CONCEPTO')
        		 ->setCellValue('J'.$intPosEncabezados, 'RENGLÓN')
        		 ->setCellValue('K'.$intPosEncabezados, 'CUENTA')
        		 ->setCellValue('L'.$intPosEncabezados, 'DESCRIPCIÓN')
        		 ->setCellValue('M'.$intPosEncabezados, 'CONCEPTO')
        		 ->setCellValue('N'.$intPosEncabezados, 'REFERENCIA')
        		 ->setCellValue('O'.$intPosEncabezados, 'CARGO')
        		 ->setCellValue('P'.$intPosEncabezados, 'ABONO');
        		 

        //Definir estilos de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE,
    													'color' => array('rgb' => 'ffffff')));

        $arrStyleFuenteEncabezado = array('font' => array('bold' => TRUE,
        												  'name' => 'Arial',
        												  'size' => 10,
    									  				  'color' => array('rgb' => '000000')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

         //Definir estilo para alinear a la izquierda el contenido de la celda
        $arrStyleAlignmentLeft = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        
        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Combinar las siguientes celdas
       	$objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A8:D8');

       	$objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A9:D9');

       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A8:D8')
        		 ->applyFromArray($arrStyleBold);

        $objExcel->getActiveSheet()
        		 ->getStyle('A9:D9')
        		 ->applyFromArray($arrStyleFuenteEncabezado);

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A11:P11')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A11:P11')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
    	$objExcel->getActiveSheet()
    			 ->getStyle('A9:D9')
    			 ->getAlignment()
    			 ->applyFromArray($arrStyleAlignmentLeft);

		$objExcel->getActiveSheet()
            	 ->getStyle('A11:P11')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Array que se utiliza para agregar los detalles
		        $arrDetalles = array();
		        //Variable que se utiliza para asignar el número de detalles 
		        $intNumDetalles = 1;
		        //Variable que se utiliza para asignar el acumulado de los cargos
				$intAcumCargos = 0;
				//Variable que se utiliza para asignar el acumulado de los abonos
				$intAcumAbonos = 0;

				//------------------------------------------------------------------------------------------------------------------------
		        //---------- DETALLES DE LA PÓLIZA
		        //------------------------------------------------------------------------------------------------------------------------	
				//Seleccionar los detalles del registro
				$otdDetalles = $this->polizas->buscar_detalles($arrCol->poliza_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Variable que se utiliza para contar el número de detalles
				    $intContDetPol = 0;
			    	//Asignar el número de detalles
			    	$intNumDetalles = count($otdDetalles);


			    	//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Variable que se utiliza para asignar el importe del cargo
						$intCargo = 0;
						//Variable que se utiliza para asignar el importe del cargo con formato moneda
						$strCargo = '';
						//Variable que se utiliza para asignar el importe del abono
						$intAbono = 0;
						//Variable que se utiliza para asignar el importe del abono con formato moneda
						$strAbono = '';
						//Variable que se utiliza para asignar la naturaleza
						$strNaturaleza = $arrDet->naturaleza;
						//Variable que se utiliza para asignar el importe
						$intImporte = $arrDet->importe; 

						//Dependiendo de la naturaleza, asignar importe
						if($strNaturaleza == 'CARGO')
						{
							$intCargo =  $intImporte;
							$strCargo = $intImporte;
						}
						else
						{
							$intAbono =  $intImporte;
							$strAbono =  $intImporte;
						}


						//Agregar datos al array
	                    $arrDetalles[$intContDetPol]['renglon']  = $arrDet->renglon;
	                    $arrDetalles[$intContDetPol]['cuenta']  = $arrDet->cuenta;
	                    $arrDetalles[$intContDetPol]['descripcion']  = $arrDet->cuenta_descripcion;
	                    $arrDetalles[$intContDetPol]['concepto']  = $arrDet->concepto;
	                    $arrDetalles[$intContDetPol]['referencia']  = $arrDet->referencia;
	                    $arrDetalles[$intContDetPol]['cargo']  = $strCargo;
	                    $arrDetalles[$intContDetPol]['abono']  = $strAbono;
	                    //Incrementar el contador por cada registro
		                $intContDetPol++;

		                //Incrementar acumulados
						$intAcumCargos += $intCargo;
						$intAcumAbonos += $intAbono;

		            }//Cierre de foreach

				}//Cierre de verificación de detalles

		
				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    {

			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('B'.$intFila, $arrCol->sucursal)
	                         ->setCellValue('C'.$intFila, $arrCol->fecha)
	                         ->setCellValue('D'.$intFila, $arrCol->tipo)
	                         ->setCellValue('E'.$intFila, $arrCol->estatus)
	                         ->setCellValue('F'.$intFila, $arrCol->modulo)
	                         ->setCellValue('G'.$intFila, $arrCol->proceso)
	                         ->setCellValue('H'.$intFila, $arrCol->referencia)
	                         ->setCellValue('I'.$intFila, $arrCol->concepto);

	                //Si existen detalles del registro
					if($arrDetalles)
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
								 ->setCellValue('J'.$intFila, $arrDetalles[$intContDet]['renglon'])
						 		 ->setCellValueExplicit('K'.$intFila, $arrDetalles[$intContDet]['cuenta'], PHPExcel_Cell_DataType::TYPE_STRING)
						         ->setCellValue('L'.$intFila, $arrDetalles[$intContDet]['descripcion'])
						         ->setCellValue('M'.$intFila, $arrDetalles[$intContDet]['concepto'])
						         ->setCellValue('N'.$intFila, $arrDetalles[$intContDet]['referencia'])
						         ->setCellValue('O'.$intFila, $arrDetalles[$intContDet]['cargo'])
						         ->setCellValue('P'.$intFila, $arrDetalles[$intContDet]['abono']);
						

						
					}

	                //Incrementar el indice para escribir los datos del siguiente registro
                    $intFila++;


			    }

			    //Si existen detalles del registro
				if($arrDetalles)
				{
				    //Agregar información de los acumulados
			   		$objExcel->setActiveSheetIndex(0)
							 ->setCellValue('N'.$intFila, 'TOTALES:')
							 ->setCellValue('O'.$intFila, $intAcumCargos)
						     ->setCellValue('P'.$intFila, $intAcumAbonos);

					
					//Cambiar alineación de las siguientes celdas	     
					$objExcel->getActiveSheet()
			        	 ->getStyle('N'.$intFila)
			        	 ->getAlignment()
			        	 ->applyFromArray($arrStyleAlignmentRight);

				   	//Cambiar estilo de la celda
	            	$objExcel->getActiveSheet()
		            		 ->getStyle('N'.$intFila.':'.'P'.$intFila)
		            		 ->applyFromArray($arrStyleBold);

	                //Incrementar el indice para escribir los datos del siguiente registro		 
            		$intFila+=2;
	            }
	          

			}//Cierre de foreach

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('O'.$intFilaInicial.':'.'P'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('O'.$intFilaInicial.':'.'P'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);
                	 		 
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'listado_polizas_periodo.xls', 'listado de pólizas', $intFila);
	}
}