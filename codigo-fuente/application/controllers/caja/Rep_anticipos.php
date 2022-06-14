<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_anticipos extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de anticipos
		$this->load->model('caja/anticipos_model', 'anticipos');
		//Cargamos el modelo de aplicación de anticipo
		$this->load->model('caja/anticipos_aplicacion_model', 'aplicacion');
		//Cargamos el modelo de clientes
		$this->load->model('cuentas_cobrar/clientes_model', 'clientes');
		//Cargamos el modelo de monedas
		$this->load->model('contabilidad/sat_monedas_model', 'monedas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('caja/rep_anticipos', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	//Método para generar un reporte PDF con el listado general de anticipos con saldo (o aplicaciones)
	public function get_reporte() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$strTipoReporte = $this->input->post('strTipoReporte');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strTiposAnticipos = trim($this->input->post('strTiposAnticipos'));
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProspectoID = $this->input->post('intProspectoID');


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

		//Buscar el nombre de los tipos de anticipos que han sido seleccionados y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 3
	    $strTituloTiposAnticipos = '';
	    $arrDescripcionesTiposAnticipos = explode('|', $strTiposAnticipos);


	    //Hacer recorrido para obtener las descripciones de los tipos de anticipos 
	    foreach ($arrDescripcionesTiposAnticipos as &$strTiposAnticipo) 
	    {
			//Concatenamos el nombre del tipo de anticipo a la variable de impresión
			$strTituloTiposAnticipos .= $strTiposAnticipo.', ';
		}

		//Quitar último elemento de la cadena (,)
		$strTituloTiposAnticipos = substr($strTituloTiposAnticipos, 0, -2);


		//Variable que se utiliza para asignar el acumulado del importe
	    $intAcumImporte = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Array que se utiliza para agregar los datos de los anticipos
	    $arrAnticipos = array();
	    //Variable que se utiliza para asignar título de la fecha de corte o rango de fechas
		$strTituloFecha = '';
		//Variable que se utiliza para asignar el nombre del archivo 
		$strNombreArchivo = '';
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA', utf8_decode('RAZÓN SOCIAL'), 'CONCEPTO', 
							      'IMPORTE', 'SALDO');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(20, 20, 40, 60, 25, 25);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L', 'R', 'R');
		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(140, 25, 25);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R');

		//Dependiendo del tipo definir encabezado del reporte
		if($strTipoReporte == 'Saldo')//Sólo anticipos con saldo
		{
			//Datos del primer título del reporte 
			$strTituloLinea1 = 'ANTICIPOS CON SALDO EN ';
			$strTituloFecha =  'FECHA DE CORTE: '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
			$strNombreArchivo = 'anticipos_saldo';

		}
		else //Anticipos y aplicaciones
		{
			//Datos del primer título del reporte 
			$strTituloLinea1 = 'ANTICIPOS Y APLICACIONES EN ';
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloFecha = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C'). ' AL ';
			$strTituloFecha .= $this->get_fecha_formato_letra($dteFechaFinal, 'C');
			$strNombreArchivo = 'anticipos_aplicaciones';
		}
		
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
	    $pdf->strLinea1 = $strTituloLinea1.'     '.$strTituloFecha;
	     //Asignar el valor de la línea dos del título
		$pdf->strLinea2 = utf8_decode('SUCURSALES: '.trim($strTituloSucursales));
		//Asignar el valor de la línea tres del título
		$pdf->strLinea3 = utf8_decode('ANTICIPOS: '.trim($strTituloTiposAnticipos));

	    //Si existe id del cliente
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del cliente que coincide con el id
			$otdProspecto =  $this->clientes->buscar($intProspectoID);
			$pdf->strLinea4 = utf8_decode('RAZÓN SOCIAL: '.$otdProspecto->razon_social);
		}

		//Establecer el color de línea
	    $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

	    //Seleccionar los datos de las monedas activas
		$otdMonedas = $this->monedas->buscar(NULL, NULL, NULL, 'ACTIVO');
		//Si hay información
		if($otdMonedas)
		{
			//Recorremos el arreglo 
			foreach ($otdMonedas as $arrMon)
			{
				//Asignar el id de la moneda actual
				$intMonedaID = $arrMon->moneda_id;
				
				//Inicializar variables
				$intAcumImporte = 0;
				$intAcumSaldo = 0;
				$arrAnticipos = array();

				//Asignar objeto con el saldo de los anticipos en en el rango de fechas (o fecha de corte)
				$otdAnticipos = $this->get_anticipos($strTipoReporte, $dteFechaInicial, $dteFechaFinal, 
												     $intMonedaID, $strSucursales, $strTiposAnticipos, 
												     $intProspectoID);

				//Asignar array con los datos de los antcipos
				$arrAnticipos = $otdAnticipos['rows'];
				//Asignar el acumulado del importe de los anticipos
				$intAcumImporte =  $otdAnticipos['acumulado_importe'];
			    //Asignar el acumulado del saldo de los anticipos
				$intAcumSaldo =  $otdAnticipos['acumulado_saldo'];
				

				//Si hay información de anticipos
				if($arrAnticipos)
				{
					//Concatenar moneda para el primer encabezado del reporte
					$strTituloMoneda = $strTituloLinea1.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$pdf->strLinea1 = $strTituloMoneda.'     '.$strTituloFecha;
					//Agregar pagina
					$pdf->AddPage();
					//Establece el ancho de las columnas
					$pdf->SetWidths($pdf->arrAnchura);

					//Recorremos el arreglo 
					foreach ($arrAnticipos as $arrAnt)
					{
						//Asignar el id del anticipo
						$intAnticipoID = $arrAnt['referencia_id'];
						//Asignar el tipo de refencia
						$strTipoReferencia = $arrAnt['tipo_referencia'];

						//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					   	$pdf->Row(array($arrAnt['folio'], $arrAnt['fecha'], 
					   					utf8_decode($arrAnt['razon_social']), 
					   					utf8_decode($arrAnt['concepto']),
					   					'$'.number_format($arrAnt['importe'],2),
					   					'$'.number_format($arrAnt['saldo'],2)), 
					    		   	$pdf->arrAlineacion, 'ClippedCell');

					  	//Si el tipo de reporte corresponde a Anticipos y aplicaciones
					   	if($strTipoReporte == 'Aplicaciones' && $strTipoReferencia == 'FISCAL')
					   	{
					   		//Seleccionar las aplicaciones del anticipo
							$otdAplicaciones = $this->aplicacion->buscar(NULL, $dteFechaInicial, $dteFechaFinal, 
																	 	 NULL, NULL, NULL, $intAnticipoID);


							//Verificar si existe información de las aplicaciones del anticipo
							if($otdAplicaciones)
							{
								$pdf->Ln(1); //Deja un salto de línea
								//Asigna el tipo y tamaño de letra
		       				    $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
								//Aplicaciones del anticipo
								$pdf->Cell(11, 4, 'APLICACIONES:', 0, 0, 'L', 0);
								$pdf->Ln(4); //Deja un salto de línea

								//Recorremos el arreglo 
								foreach ($otdAplicaciones as $arrAAnt)
								{
									//Convertir peso mexicano a tipo de cambio
									$intSubTotal = ($arrAAnt->subtotal / $arrAAnt->tipo_cambio);
									$intImporteIva = ($arrAAnt->iva / $arrAAnt->tipo_cambio);
									$intImporteIeps = ($arrAAnt->ieps / $arrAAnt->tipo_cambio);

									//Calcular importe total
									$intTotal = $intSubTotal + $intImporteIva + $intImporteIeps;


									//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
								   	$pdf->Row(array($arrAAnt->folio, $arrAAnt->fecha_format, 
								   					utf8_decode($arrAAnt->razon_social), 
								   					utf8_decode($arrAAnt->concepto),
								   					'$'.number_format($intTotal,2),
								   					$arrAAnt->estatus), 
								    		   	$pdf->arrAlineacion, 'ClippedCell');
								}

							}  //Cierre de verificación de aplicaciones del anticipo
							
							$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de cada anticipo

							$pdf->Ln(1); //Deja un salto de línea
					   	}

					   
					}

					//Si el tipo de reporte corresponde a Sólo anticipos con saldo
					if($strTipoReporte == 'Saldo')
					{
						$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
					}
					

					//Escribir totales
		   			//Establece el ancho de las columnas
			    	$pdf->SetWidths($arrAnchuraTotales);
				    //Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
	      			//Acumulado de los saldos
					$pdf->Row(array('TOTAL:', '$'.number_format($intAcumImporte, 2), 
									'$'.number_format($intAcumSaldo, 2)), 
					    		    $arrAlineacionTotales, 'ClippedCell');
					//Cambiar el volumen de la fuente a normal
	      			$pdf->strTipoLetraTabla = '';

				}//Cierre de verificación de anticipos 

			}	

		}//Cierre de verificación de monedas
		
		//Ejecutar la salida del reporte
        $pdf->Output($strNombreArchivo.'.pdf','I'); 
	}


	/*Método para generar un archivo XLS con los anticipos (con saldo o aplicaciones)
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{

		//Variables que se utilizan para recuperar los valores de la vista
		$strTipoReporte = $this->input->post('strTipoReporte');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strTiposAnticipos = trim($this->input->post('strTiposAnticipos'));
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProspectoID = $this->input->post('intProspectoID');

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

		//Buscar el nombre de los tipos de anticipos que han sido seleccionados y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 3
	    $strTituloTiposAnticipos = '';
	    $arrDescripcionesTiposAnticipos = explode('|', $strTiposAnticipos);
	    //Hacer recorrido para obtener las descripciones de los tipos de anticipos 
	    foreach ($arrDescripcionesTiposAnticipos as &$strTiposAnticipo) 
	    {
			//Concatenamos el nombre del tipo de anticipo a la variable de impresión
			$strTituloTiposAnticipos .= $strTiposAnticipo.', ';
		}

		//Quitar último elemento de la cadena (,)
		$strTituloTiposAnticipos = substr($strTituloTiposAnticipos, 0, -2);
		
		//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 12;
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
	 	//Variable que se utiliza para asignar el acumulado del importe
	    $intAcumImporte = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Array que se utiliza para agregar los datos de los anticipos
	    $arrAnticipos = array();
	    //Variable que se utiliza para asignar título de la fecha de corte o rango de fechas
		$strTituloFecha = '';
		//Variable que se utiliza para asignar el nombre del archivo 
		$strNombreArchivo = '';
	    //Variable que se utiliza para asignar el número de registros por cada moneda
		$intNumRegistros = 0; 
		//Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última moneda)
		$intNumMaxRegistros = 0;

	    //Dependiendo del tipo definir encabezado del reporte
		if($strTipoReporte == 'Saldo')//Sólo anticipos con saldo
		{
			//Datos del primer título del reporte 
			$strTituloLinea1 = 'ANTICIPOS CON SALDO EN ';
			$strTituloFecha =  'FECHA DE CORTE: '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
			$strNombreArchivo = 'anticipos_saldo';

		}
		else //Anticipos y aplicaciones
		{
			//Datos del primer título del reporte 
			$strTituloLinea1 = 'ANTICIPOS Y APLICACIONES EN ';
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloFecha = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C'). ' AL ';
			$strTituloFecha .= $this->get_fecha_formato_letra($dteFechaFinal, 'C');
			$strNombreArchivo = 'anticipos_aplicaciones';
		}

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

        //Definir estilo para alinear a la izquierda el contenido de la celda
        $arrStyleAlignmentLeft = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Seleccionar los datos de las monedas activas
		$otdMonedas = $this->monedas->buscar(NULL, NULL, NULL, 'ACTIVO');
		//Si hay información
		if($otdMonedas)
		{
			//Recorremos el arreglo 
			foreach ($otdMonedas as $arrMon)
			{
				//Asignar el id de la moneda actual
				$intMonedaID = $arrMon->moneda_id;
				//Asignar el nombre de la hoja
				$strNombreHoja = 'anticipos '.$arrMon->codigo;
				//Inicializar variables
				$intAcumImporte = 0;
				$intAcumSaldo = 0;
				$arrAnticipos = array();

				//Asignar objeto con el saldo de los anticipos en en el rango de fechas (o fecha de corte)
				$otdAnticipos = $this->get_anticipos($strTipoReporte, $dteFechaInicial, $dteFechaFinal, 
													 $intMonedaID, $strSucursales, $strTiposAnticipos,
													 $intProspectoID);

				//Asignar array con los datos de los antcipos
				$arrAnticipos = $otdAnticipos['rows'];
				//Asignar el acumulado del importe de los anticipos
				$intAcumImporte =  $otdAnticipos['acumulado_importe'];
			    //Asignar el acumulado del saldo de los anticipos
				$intAcumSaldo =  $otdAnticipos['acumulado_saldo'];

				//Concatenar datos para el primer encabezado del reporte
				$strEncabezado = $strTituloLinea1.'     '.$strTituloFecha;

				//Se agrega el título del archivo
				$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);
				$objExcel->getActiveSheet()->setCellValue('A8', 'SUCURSALES: '.$strTituloSucursales);
				$objExcel->getActiveSheet()->setCellValue('A9', 'ANTICIPOS: '.$strTituloTiposAnticipos);

				//Si existe id del cliente
				if($intProspectoID > 0)
				{
					//Seleccionar los datos del cliente que coincide con el id
					$otdProspecto =  $this->clientes->buscar($intProspectoID);
					$objExcel->setActiveSheetIndex(0)
					         ->setCellValue('A10', 'RAZÓN SOCIAL: '.$otdProspecto->razon_social);
				}


				//Se agregan las columnas de cabecera
		        $objExcel->getActiveSheet()->setCellValue('A'.$intPosEncabezados, 'FOLIO')
		                 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
		                 ->setCellValue('C'.$intPosEncabezados, 'RAZÓN SOCIAL')
		                 ->setCellValue('D'.$intPosEncabezados, 'CONCEPTO')
		                 ->setCellValue('E'.$intPosEncabezados, 'IMPORTE')
		                 ->setCellValue('F'.$intPosEncabezados, 'SALDO');

					//Combinar las siguientes celdas
		       	$objExcel->getActiveSheet()->mergeCells('A8:D8');
		       	$objExcel->getActiveSheet()->mergeCells('A9:D9');
		       	$objExcel->getActiveSheet()->mergeCells('A10:D10');

		       	//Cambiar estilo de las siguientes celdas
		        $objExcel->getActiveSheet()
		        		 ->getStyle('A8:D8')
		        		 ->applyFromArray($arrStyleBold);

		        $objExcel->getActiveSheet()
		        		 ->getStyle('A9:D9')
		        		 ->applyFromArray($arrStyleBold);

		        $objExcel->getActiveSheet()
		        		 ->getStyle('A10:D10')
		        		 ->applyFromArray($arrStyleBold);

		        //Preferencias de color de relleno de celda
		        $objExcel->getActiveSheet()
		    			 ->getStyle('A12:F12')
		    			 ->getFill()
		    			 ->applyFromArray($arrStyleColumnas);
		     
		    	//Preferencias de color de texto de la celda
		        $objExcel->getActiveSheet()
		    			 ->getStyle('A9:D9')
		    			 ->applyFromArray($arrStyleFuenteColumnasPrinc);

		         $objExcel->getActiveSheet()
		    			 ->getStyle('A10:D10')
		    			 ->applyFromArray($arrStyleFuenteColumnasPrinc);

		    	$objExcel->getActiveSheet()
		    			 ->getStyle('A12:F12')
		    			 ->applyFromArray($arrStyleFuenteColumnas);

		    	//Cambiar alineación de las siguientes celdas
		    	$objExcel->getActiveSheet()
		            	 ->getStyle('A9:D9')
		            	 ->getAlignment()
		            	 ->applyFromArray($arrStyleAlignmentLeft);

		        $objExcel->getActiveSheet()
		            	 ->getStyle('A10:D10')
		            	 ->getAlignment()
		            	 ->applyFromArray($arrStyleAlignmentLeft);

		    	$objExcel->getActiveSheet()
		            	 ->getStyle('A12:F12')
		            	 ->getAlignment()
		            	 ->applyFromArray($arrStyleAlignmentCenter);

				//Si hay información de anticipos
				if($arrAnticipos)
				{
					//Número de fila donde se va a comenzar a rellenar
				    $intFila = 13;
				    $intFilaInicial = 13;

				    //Asignar el número de registros
					$intNumRegistros = count($arrAnticipos);

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

				  	
					//Dependiendo del tipo definir encabezado del reporte
					if($strTipoReporte == 'Saldo')//Sólo anticipos con saldo
					{
						 //Concatenar moneda para el primer encabezado del reporte
						$strTituloLinea1 = 'ANTICIPOS CON SALDO EN '.strtoupper($arrMon->descripcion);

					}
					else //Anticipos y aplicaciones
					{
						 //Concatenar moneda para el primer encabezado del reporte
						$strTituloLinea1 = 'ANTICIPOS Y APLICACIONES EN '.strtoupper($arrMon->descripcion);
					}

					//Cambiar descripción de la primer línea del título
					$strEncabezado = $strTituloLinea1.'     '.$strTituloFecha;

					//Se agrega el título del archivo
					$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);


				    //Recorremos el arreglo 
					foreach ($arrAnticipos as $arrAnt)
					{
						//Asignar el id del anticipo
						$intAnticipoID = $arrAnt['referencia_id'];
						//Asignar el tipo de refencia
						$strTipoReferencia = $arrAnt['tipo_referencia'];

				   		//Agregar información del anticipo
			            $objExcel->getActiveSheet()
		                         ->setCellValue('A'.$intFila, $arrAnt['folio'])
		                         ->setCellValue('B'.$intFila, $arrAnt['fecha'])
		                         ->setCellValue('C'.$intFila, $arrAnt['razon_social'])
		                         ->setCellValue('D'.$intFila, $arrAnt['concepto'])
		                         ->setCellValue('E'.$intFila, $arrAnt['importe'])
		                         ->setCellValue('F'.$intFila, $arrAnt['saldo']);

		               
		                //Incrementar el indice para escribir los datos del siguiente registro
					    $intFila++;
					    
						//Si el tipo de reporte corresponde a Anticipos y aplicaciones
					   	if($strTipoReporte == 'Aplicaciones' && $strTipoReferencia == 'FISCAL')
					   	{
					   		//Seleccionar las aplicaciones del anticipo
							$otdAplicaciones = $this->aplicacion->buscar(NULL, $dteFechaInicial, $dteFechaFinal, 
																	 	 NULL, NULL, NULL, $intAnticipoID);

							//Verificar si existe información de las aplicaciones del anticipo
							if($otdAplicaciones)
							{
								
								//Encabezado de las aplicaciones del anticipo
								$objExcel->getActiveSheet()
		                         		 ->setCellValue('A'.$intFila, 'APLICACIONES:');

		                        //Cambiar estilo de la celda
						        $objExcel->getActiveSheet()
						            		 ->getStyle('A'.$intFila)
						            		 ->applyFromArray($arrStyleBold);

		                        //Incrementar el indice para escribir los datos del siguiente registro
								$intFila++;
								//Incrementar el número de registros para escribir el pie de página
								$intNumRegistros++;
								

								//Recorremos el arreglo 
								foreach ($otdAplicaciones as $arrAAnt)
								{
									//Convertir peso mexicano a tipo de cambio
									$intSubTotal = ($arrAAnt->subtotal / $arrAAnt->tipo_cambio);
									$intImporteIva = ($arrAAnt->iva / $arrAAnt->tipo_cambio);
									$intImporteIeps = ($arrAAnt->ieps / $arrAAnt->tipo_cambio);

									//Calcular importe total
									$intTotal = $intSubTotal + $intImporteIva + $intImporteIeps;

								   	//Agregar información de la aplicación
						            $objExcel->getActiveSheet()
					                         ->setCellValue('A'.$intFila, $arrAAnt->folio)
					                         ->setCellValue('B'.$intFila, $arrAAnt->fecha_format)
					                         ->setCellValue('C'.$intFila, $arrAAnt->razon_social)
					                         ->setCellValue('D'.$intFila, $arrAAnt->concepto)
					                         ->setCellValue('E'.$intFila, $intTotal)
					                         ->setCellValue('F'.$intFila, $arrAAnt->estatus);


								   //Incrementar el indice para escribir los datos del siguiente registro
								   $intFila++;
								   //Incrementar el número de registros para escribir el pie de página
								   $intNumRegistros++;
								}

							}//Cierre de verificación de aplicaciones del anticipo
							
							//Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;
							//Incrementar el número de registros para escribir el pie de página
						    $intNumRegistros++;
					   	}

					}

					//Incrementar contador por cada moneda
					$intContadorHojas++;


					//Incrementar el indice para escribir los totales
		            $intFila++;

	            	//Escribir totales
		        	//Agregar información de los totales
					$objExcel->getActiveSheet()
	                         ->setCellValue('A'.$intFila, 'TOTALES:')
	                         ->setCellValue('E'.$intFila, $intAcumImporte)
	                         ->setCellValue('F'.$intFila, $intAcumSaldo);


                   //Cambiar contenido de las celdas a formato moneda
	           		$objExcel->getActiveSheet()
		            		 ->getStyle('E'.$intFilaInicial.':'.'F'.$intFila)
		            		 ->getNumberFormat()
		            		 ->setFormatCode('$#,##0.00');


	             	//Cambiar alineación de las siguientes celdas
		    		$objExcel->getActiveSheet()
				        	 ->getStyle('E'.$intFilaInicial.':'.'F'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

				    $objExcel->getActiveSheet()
				        	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentCenter);

				    $objExcel->getActiveSheet()
				        	 ->getStyle('E'.$intFilaInicial.':'.'F'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

				    //Cambiar estilo de las siguientes celdas
			        $objExcel->getActiveSheet()
			            		 ->getStyle('A'.$intFila.':'.'F'.$intFila)
			            		 ->applyFromArray($arrStyleBold);


				    //Si el número de registros (por cada moneda) es mayor que el número máximo de registros 
				    if($intNumRegistros > $intNumMaxRegistros)
		            {
		            	//Asignar número de registros
		            	$intNumMaxRegistros = $intNumRegistros;

		            }

				}//Cierre de verificación de información de anticipos
			  
			}

		}//Cierre de verificación de monedas

        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, $strNombreArchivo.'.xls', 'anticipos', $intNumMaxRegistros);
	}


	//Función que se utiliza para regresar anticipos con saldo en la fecha de corte 
	//(o todos los anticipos en el rango de fechas)
	public function get_anticipos($strTipoReporte, $dteFechaInicial, $dteFechaFinal, $intMonedaID,
								  $strSucursales, $strTiposAnticipos, $intProspectoID = NULL)
	{
		//Array que se utiliza para enviar datos
		$arrDatos = array('rows' => NULL, 
			 			  'acumulado_importe' => '0.00',
						  'acumulado_saldo' => '0.00');

		//Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del importe
	    $intAcumImporte = 0;
	    //Array que se utiliza para agregar los datos de los anticipos
        $arrAnticipos = array();
        //Array que se utiliza para agregar los datos de un anticipo
        $arrAuxiliar = array();

        //Seleccionar los datos de los anticipos que coinciden con el parámetro enviado
		$otdResultado = $this->anticipos->buscar_saldos_anticipos($dteFechaInicial, $dteFechaFinal, $intMonedaID, 
																  $strSucursales, $strTiposAnticipos, $intProspectoID);

		//Si hay información
		if($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{	
				//Asignar el saldo del anticipo
				$intSaldo = $arrCol->saldo;
				//Asignar el importe del anticipo
				$intImporte = $arrCol->importe;

				//Definir valores del array auxiliar de información del anticipo
				$arrAuxiliar["referencia_id"] = $arrCol->referencia_id;
				$arrAuxiliar["tipo_referencia"] = $arrCol->tipo_referencia;
				$arrAuxiliar["folio"] = $arrCol->folio;
				$arrAuxiliar["fecha"] = $arrCol->fecha_format;
				$arrAuxiliar["razon_social"] = $arrCol->razon_social;
				$arrAuxiliar["concepto"] = $arrCol->concepto;
				$arrAuxiliar["importe"] = $intImporte;
				$arrAuxiliar["saldo"] = $intSaldo;

				//Dependiendo del tipo de reporte agregar datos al array
				if($strTipoReporte == 'Saldo')//Sólo anticipos con saldo
				{
					//Si el anticipo no se encuentra aplicado
					if (($intSaldo >= 1) OR ($intSaldo <= -1))
					{
						//Agregar datos al array
				        array_push($arrAnticipos, $arrAuxiliar);

				         //Incrementar acumulados
				         $intAcumImporte += $intImporte;
				         $intAcumSaldo += $intSaldo;

					}//Cierre de verificación del saldo

				}
				else //Anticipos y aplicaciones
				{
					//Agregar datos al array
				    array_push($arrAnticipos, $arrAuxiliar);
				    
				    //Incrementar acumulados
				    $intAcumImporte += $intImporte;
				    $intAcumSaldo += $intSaldo;
				}
			}


			//Agregar datos al array
		    $arrDatos['rows'] = $arrAnticipos;
		    $arrDatos['acumulado_importe'] = $intAcumImporte;
		    $arrDatos['acumulado_saldo'] = $intAcumSaldo;

		}//Cierre de verificación de anticipos


		//Regresar array con los anticipos (todos/sólo con saldo)
		return $arrDatos;
	}
   
}