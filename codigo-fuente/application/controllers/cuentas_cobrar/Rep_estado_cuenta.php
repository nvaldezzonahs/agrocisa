<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_estado_cuenta extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de pagos
		$this->load->model('caja/pagos_model', 'pagos');
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
		$this->cargar_vista('cuentas_cobrar/rep_estado_cuenta', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	/*Método para generar un reporte PDF con el estado de cuenta 
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProspectoID = $this->input->post('intProspectoID');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strModulos = trim($this->input->post('strModulos'));

		
		//Variable que se utiliza para asignar el saldo inicial
		$intSaldoInicial = 0;
		//Variable que se utiliza para asignar el saldo actual del cliente
		$intSaldoActual = 0;
		//Variable que se utiliza para asignar el acumulado de los cargos (facturas y notas de cargo)
		$intAcumCargos = 0;
		//Variable que se utiliza para asignar el acumulado de los abonos (pagos, recibos de ingreso, pólizas de abono y notas de crédito)
		$intAcumAbonos = 0;
		//Variable que se utiliza para asignar el acumulado del saldo actual
		$intAcumSaldoActual = 0;
		//Array que se utiliza para agregar los datos (movimientos) del cliente
	    $arrMovimientos = array();

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

		//Seleccionar los datos del cliente que coincide con el id
		$otdCliente = $this->clientes->buscar($intProspectoID);

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('DESCRIPCIÓN'), 'FOLIO', 'AFECTA', 'FECHA',  
								  'CARGO', 'ABONO', 'SALDO');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(60, 20, 20, 20, 20, 20, 30);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'C', 'R', 'R', 'R');
		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(120, 20, 20, 30);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R', 'R');
		//Datos del primer título del reporte 
		$strTituloLinea1 = 'ESTADO DE CUENTA EN ';
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
	    $pdf->strLinea1 = $strTituloLinea1.'     '.$strTituloRangoFechas;
	    //Asignar el valor de la línea dos del título
		$pdf->strLinea2 = utf8_decode('SUCURSALES: '.trim($strTituloSucursales));
		//Asignar el valor de la línea tres del título
		$pdf->strLinea3 = utf8_decode('MÓDULOS: '.trim($strTituloModulos));
		//Asignar el valor de la línea cuatro del título
		$pdf->strLinea4 =  'CLIENTE: '.utf8_decode($otdCliente->codigo.' - '.$otdCliente->razon_social);
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
				$intSaldoInicial = 0;
				$intSaldoActual = 0;
				$intAcumCargos = 0;
				$intAcumAbonos = 0;
				$intAcumSaldoActual = 0;
				$arrMovimientos = array();

				//Hacer un llamado a la función para obtener el saldo inicial del cliente
				$intSaldoInicial = $this->get_saldo_inicial($intProspectoID, $intMonedaID, $dteFechaInicial, 
														     $strSucursales, $strModulos);
				$intSaldoActual =  $intSaldoInicial;

				//Asignar objeto con los movimientos y saldos del cliente en el rango de fechas
			    $otdMovimientos = $this->get_movimientos($dteFechaInicial, $dteFechaFinal, $intProspectoID, 
			    										 $intMonedaID, $strSucursales, $strModulos, $intSaldoActual);

				//Asignar array con los datos de los movimientos
				$arrMovimientos = $otdMovimientos['rows'];
				//Asignar el acumulado de los cargos
				$intAcumCargos =  $otdMovimientos['acumulado_cargos'];
				//Asignar el acumulado de los abonos
				$intAcumAbonos =  $otdMovimientos['acumulado_abonos'];
				//Asignar el acumulado del saldo actual
				$intAcumSaldoActual =  $otdMovimientos['acumulado_saldo_actual'];


				//Si hay información del saldo inicial o movimientos del estado de cuenta
				if($arrMovimientos OR $intSaldoInicial > 0)
				{
					//Concatenar moneda para el primer encabezado del reporte
					$strTituloMoneda = $strTituloLinea1.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$pdf->strLinea1 = $strTituloMoneda.'     '.$strTituloRangoFechas;
					//Agregar pagina
					$pdf->AddPage();
					//Establece el ancho de las columnas
					$pdf->SetWidths($pdf->arrAnchura);

					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array('SALDO INICIAL', '', '', '', '$'.number_format($intSaldoInicial,2), '', 
						   			'$'.number_format($intSaldoActual,2)), 
						   			$pdf->arrAlineacion, 'ClippedCell');

					//Si hay información de los movimientos
					if($arrMovimientos)
					{

						//Recorremos el arreglo 
						foreach ($arrMovimientos as $arrMov)
						{
							//Variable que se utiliza para asignar el importe total de una factura o nota de cargo
							$intTotalCargo = $arrMov['cargo'];
							//Variable que se utiliza para asignar el importe total de un pago, póliza de abono, nota de crédito o recibo de ingreso
							$intTotalAbono = $arrMov['abono'];
							
							
							//Si el tipo de movimiento corresponde a un cargo (facturas)
						    if($arrMov['tipo'] == 'cargo')
							{
								//Cambiar cantidad a formato moneda
								$intTotalCargo = '$'. number_format($intTotalCargo, 2);
								
							}
							else
							{
								//Cambiar cantidad a formato moneda
								$intTotalAbono = '$'. number_format($intTotalAbono, 2);
							}

							//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						    $pdf->Row(array(utf8_decode($arrMov['descripcion']), $arrMov['folio'], 
						    				$arrMov['folio_referencia'], $arrMov['fecha'], 
						    				$intTotalCargo, $intTotalAbono, 
						    				'$'.number_format($arrMov['saldo_actual'],2)), 
						    		  $pdf->arrAlineacion, 'ClippedCell');
						}

					}//Cierre de verificación de información 
					

					$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales

					//Escribir totales
					//Establece el ancho de las columnas
		    		$pdf->SetWidths($arrAnchuraTotales);
			        //Cambiar el volumen de la letra
					$pdf->strTipoLetraTabla = 'Negrita';
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array('TOTALES: ', 
	   								'$'.number_format($intAcumCargos, 2), 
	   								'$'.number_format($intAcumAbonos, 2), 
	   								'$'.number_format($intAcumSaldoActual, 2)), 
	   								$arrAlineacionTotales, 'ClippedCell');
	   				//Cambiar el volumen de la letra
					$pdf->strTipoLetraTabla = 'Normal';	


				}//Cierre de verificación de movimientos
			}

		}//Cierre de verificación de monedas

		//Ejecutar la salida del reporte
        $pdf->Output('estado_cuenta_'.$otdCliente->codigo.'.pdf','I'); 

	}


    /*Método para generar un archivo XLS con el estado de cuenta 
      *dependiendo del criterio de búsqueda proporcionado*/
    public function get_xls()
    {

    	//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProspectoID = $this->input->post('intProspectoID');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strModulos = trim($this->input->post('strModulos'));


    	//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 12;
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
	    //Variable que se utiliza para asignar el saldo inicial
		$intSaldoInicial = 0;
		//Variable que se utiliza para asignar el saldo actual del cliente
		$intSaldoActual = 0;
		//Variable que se utiliza para asignar el acumulado de los cargos (facturas y notas de cargo)
		$intAcumCargos = 0;
		//Variable que se utiliza para asignar el acumulado de los abonos (pagos, recibos de ingreso, pólizas de abono y notas de crédito)
		$intAcumAbonos = 0;
		//Variable que se utiliza para asignar el acumulado del saldo actual
		$intAcumSaldoActual = 0;
	    //Array que se utiliza para agregar los datos (movimientos) del cliente
	    $arrMovimientos = array();
	    //Variable que se utiliza para asignar el número de registros por cada moneda
		$intNumRegistros = 0; 
		//Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última moneda)
		$intNumMaxRegistros = 0;
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

		//Seleccionar los datos del cliente que coincide con el id
		$otdCliente = $this->clientes->buscar($intProspectoID);


		//Concatenar datos para el primer encabezado del reporte
		$strTituloLinea1 = 'ESTADO DE CUENTA EN ';
	

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
				$strNombreHoja = 'estado de cuenta '.$arrMon->codigo;
				//Inicializar variables
				$intSaldoInicial = 0;
				$intSaldoActual = 0;
				$intAcumCargos = 0;
				$intAcumAbonos = 0;
				$intAcumSaldoActual = 0;
				$arrMovimientos = array();

				//Hacer un llamado a la función para obtener el saldo inicial del cliente
				$intSaldoInicial = $this->get_saldo_inicial($intProspectoID, $intMonedaID, $dteFechaInicial, 
														     $strSucursales, $strModulos);
				$intSaldoActual =  $intSaldoInicial;

				//Asignar objeto con los movimientos y saldos del cliente en el rango de fechas
			    $otdMovimientos = $this->get_movimientos($dteFechaInicial, $dteFechaFinal, $intProspectoID, 
			    										 $intMonedaID, $strSucursales, $strModulos, $intSaldoActual);


			    //Asignar array con los datos de los movimientos
				$arrMovimientos = $otdMovimientos['rows'];
				//Asignar el acumulado de los cargos
				$intAcumCargos =  $otdMovimientos['acumulado_cargos'];
				//Asignar el acumulado de los abonos
				$intAcumAbonos =  $otdMovimientos['acumulado_abonos'];
				//Asignar el acumulado del saldo actual
				$intAcumSaldoActual =  $otdMovimientos['acumulado_saldo_actual'];


				//Concatenar datos para el primer encabezado del reporte
				$strEncabezado = $strTituloLinea1.'     '.$strTituloRangoFechas;

				//Se agrega el título del archivo
				$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);
				$objExcel->getActiveSheet()->setCellValue('A8', 'SUCURSALES: '.$strTituloSucursales);
				$objExcel->getActiveSheet()->setCellValue('A9', 'MÓDULOS: '.$strTituloModulos);
				$objExcel->getActiveSheet()->setCellValue('A10', 'CLIENTE: '.$otdCliente->codigo.' - '.$otdCliente->razon_social);

				//Se agregan las columnas de cabecera
		        $objExcel->getActiveSheet()->setCellValue('A'.$intPosEncabezados, 'DESCRIPCIÓN')
		                 ->setCellValue('B'.$intPosEncabezados, 'FOLIO')
		                 ->setCellValue('C'.$intPosEncabezados, 'AFECTA')
		                 ->setCellValue('D'.$intPosEncabezados, 'FECHA')
		                 ->setCellValue('E'.$intPosEncabezados, 'CARGO')
		                 ->setCellValue('F'.$intPosEncabezados, 'ABONO')
		                 ->setCellValue('G'.$intPosEncabezados, 'SALDO');

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

		        //Preferencias de color de relleno de celda
		        $objExcel->getActiveSheet()
		    			 ->getStyle('A12:G12')
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
		    			 ->getStyle('A12:G12')
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
		            	 ->getStyle('A12:G12')
		            	 ->getAlignment()
		            	 ->applyFromArray($arrStyleAlignmentCenter);


		        //Si hay información del saldo inicial o movimientos del estado de cuenta
				if($arrMovimientos OR $intSaldoInicial > 0)
				{
					//Número de fila donde se va a comenzar a rellenar
				    $intFila = 13;
				    $intFilaInicial = 13;

				    //Asignar el número de registros
					$intNumRegistros = count($arrMovimientos);

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

					//Concatenar moneda para el primer encabezado del reporte
					$strTituloLinea1 = 'ESTADO DE CUENTA EN '.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$strEncabezado = $strTituloLinea1.'     '.$strTituloRangoFechas;

					//Se agrega el título del archivo
					$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);


					//Agregar información del saldo inicial
					$objExcel->getActiveSheet()
					 		 ->setCellValue('A'.$intFila, 'SALDO INICIAL')
	                         ->setCellValue('E'.$intFila, $intSaldoInicial)
	                         ->setCellValue('G'.$intFila, $intSaldoActual);
	                //Incrementar el indice para escribir los datos del siguiente registro
               		$intFila++;

               		//Si hay información de los movimientos
					if($arrMovimientos)
					{

						//Recorremos el arreglo 
						foreach ($arrMovimientos as $arrMov)
						{
						
						    //Agregar información del movimiento
				            $objExcel->getActiveSheet()
			                         ->setCellValue('A'.$intFila, $arrMov['descripcion'])
			                         ->setCellValue('B'.$intFila, $arrMov['folio'])
			                         ->setCellValue('C'.$intFila, $arrMov['folio_referencia'])
			                         ->setCellValue('D'.$intFila, $arrMov['fecha'])
			                         ->setCellValue('E'.$intFila, $arrMov['cargo'])
			                         ->setCellValue('F'.$intFila, $arrMov['abono'])
			                         ->setCellValue('G'.$intFila, $arrMov['saldo_actual']);

			                //Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;

						}

					}//Cierre de verificación de información 


               		//Incrementar contador por cada moneda
					$intContadorHojas++;

		            //Escribir totales
		        	//Agregar información de los totales
					$objExcel->getActiveSheet()
	                         ->setCellValue('D'.$intFila, 'TOTALES:')
	                         ->setCellValue('E'.$intFila, $intAcumCargos)
	                         ->setCellValue('F'.$intFila, $intAcumAbonos)
	                         ->setCellValue('G'.$intFila, $intAcumSaldoActual);


	                //Cambiar contenido de las celdas a formato moneda
	           		$objExcel->getActiveSheet()
		            		 ->getStyle('E'.$intFilaInicial.':'.'G'.$intFila)
		            		 ->getNumberFormat()
		            		 ->setFormatCode('$#,##0.00');

	                //Cambiar alineación de las siguientes celdas
		            $objExcel->getActiveSheet()
				        	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentCenter);

		    		$objExcel->getActiveSheet()
				        	 ->getStyle('E'.$intFilaInicial.':'.'G'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

	                //Cambiar estilo de las siguientes celdas
			        $objExcel->getActiveSheet()
			            		 ->getStyle('D'.$intFila.':'.'G'.$intFila)
			            		 ->applyFromArray($arrStyleBold);

	                //Si el número de registros (por cada moneda) es mayor que el número máximo de registros 
				    if($intNumRegistros > $intNumMaxRegistros)
		            {
		            	//Asignar número de registros
		            	$intNumMaxRegistros = $intNumRegistros;
		            }

				}//Cierre de verificación de movimientos
			  
			}

		}//Cierre de verificación de monedas

        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'estado_cuenta_'.$otdCliente->codigo.'.xls', 'estado de cuenta', $intNumMaxRegistros);
    }


    //Método que se utiliza para regresar el saldo inicial del cliente
	public function get_saldo_inicial($intProspectoID, $intMonedaID, $dteFechaInicial, $strSucursales, $strModulos)
	{
		//Variable que se utiliza para asignar el saldo inicial
		$intSaldoInicial = 0;

		//Seleccionar los datos de las facturas (con saldo) que coinciden con el parámetro enviado
		$otdResultado = $this->pagos->buscar_facturas_importes('reporte', NULL, $intProspectoID, NULL, 
															    $intMonedaID, NULL, NULL, $dteFechaInicial, 
															    $strSucursales, $strModulos, NULL, NULL, 'saldo');
		//Si hay información
		if($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Asignar el saldo de la factura
				$intSaldoFactura = $arrCol->saldo;
		
				//Si la factura no se encuentra pagada
				//if (($intSaldoFactura >= 1) OR ($intSaldoFactura <= -1))//Validación anterior
				if($intSaldoFactura > 0)
				{
					//Incrementar el saldo inicial
					$intSaldoInicial+= $intSaldoFactura;

				}//Cierre de verificación del saldo

			}
		}

		//Regresar el saldo inicial del cliente
		return $intSaldoInicial;
	}


	//Función que se utiliza para regresar movimientos del cliente en el rango de fechas
	public function get_movimientos($dteFechaInicial, $dteFechaFinal, $intProspectoID, $intMonedaID, 
								    $strSucursales, $strModulos, $intSaldoActual)
	{
		//Array que se utiliza para enviar datos
		$arrDatos = array('rows' => NULL, 
						  'acumulado_cargos' => '0.00',
						  'acumulado_abonos' => '0.00',
						  'acumulado_saldo_actual' => '0.00');

		//Variable que se utiliza para asignar el acumulado de los cargos (facturas y notas de cargo)
		$intAcumCargos = number_format($intSaldoActual, 2, '.','');
		//Variable que se utiliza para asignar el acumulado de los abonos (pagos, recibos de ingreso, pólizas de abono y notas de crédito)
		$intAcumAbonos = 0;
		//Array que se utiliza para agregar los datos de los movimientos
        $arrMovimientos = array();
        //Array que se utiliza para agregar los datos de un movimiento
        $arrAuxiliar = array();

        //Seleccionar los movimientos (facturas, notas de cargo, notas de crédito, pólizas de abono, recibos de ingreso y pagos) del cliente
	   $otdMovimientos = $this->pagos->buscar_movimientos_estado_cuenta($dteFechaInicial, $dteFechaFinal,
																	    $intProspectoID, $intMonedaID, 
																	     $strSucursales, $strModulos);

		//Recorremos el arreglo 
		foreach ($otdMovimientos as $arrMov)
		{
			//Variable que se utiliza para asignar el importe total de una factura o nota de cargo
			$intTotalCargo = '';
			//Variable que se utiliza para asignar el importe total de un pago, póliza de abono, nota de crédito o recibo de ingreso
			$intTotalAbono = '';
			//Variables que se utilizan para asignar valores del movimiento
			$intImporte = number_format($arrMov->importe, 2, '.',''); 
			$strEstatus =  $arrMov->estatus;
			$strDescripcion = $arrMov->descripcion;

			//Si el estatus del movimiento es INACTIVO
			if($strEstatus == 'INACTIVO')
			{
				//Concatenar estatus
				$strDescripcion .= ' - '.$strEstatus;
			}

			//Si el tipo de movimiento corresponde a un cargo (factura)
			if($arrMov->tipo == 'cargo')
			{
				//Asignar importe total de la factura o nota de cargo
				$intTotalCargo = $intImporte;
				
				//Si el estatus del movimiento es diferente a INACTIVO
				if($strEstatus != 'INACTIVO')
				{
					//Incrementar el saldo actual
					$intSaldoActual += $intImporte;
					//Incrementar acumulado
					$intAcumCargos += $intImporte;
				}
				
			}
			else
			{
				//Asignar el importe total del pago, nota de crédito, póliza de abono o recibo de ingreso			
				$intTotalAbono = $intImporte;

				//Si el estatus del movimiento es diferente a INACTIVO
				if($strEstatus != 'INACTIVO')
				{
					//Decrementar el saldo actual
					$intSaldoActual -= $intImporte;
					//Incrementar acumulado
					$intAcumAbonos += $intImporte;
				}
			}

			//Convertir cantidad a dos decimales
			$intSaldoActual = number_format($intSaldoActual, 2, '.',''); 

			//Definir valores del array auxiliar de información (para cada movimiento)
			$arrAuxiliar["folio"] = $arrMov->folio;
			$arrAuxiliar["fecha"] = $arrMov->fecha_format;
			$arrAuxiliar["descripcion"] = $strDescripcion;
			$arrAuxiliar["folio_referencia"] = $arrMov->folio_referencia;
			$arrAuxiliar["tipo"] = $arrMov->tipo;
		    $arrAuxiliar["cargo"] = $intTotalCargo;
		    $arrAuxiliar["abono"] = $intTotalAbono;
		    $arrAuxiliar["saldo_actual"] = $intSaldoActual;
            //Agregar datos al array
            array_push($arrMovimientos, $arrAuxiliar);

		}//Cierre de foreach

		//Agregar datos al array
		$arrDatos['rows'] = $arrMovimientos;
		$arrDatos['acumulado_cargos'] = $intAcumCargos;
	    $arrDatos['acumulado_abonos'] = $intAcumAbonos;
	    $arrDatos['acumulado_saldo_actual'] = $intSaldoActual;

	    //Regresar array con los movimientos del cliente
		return $arrDatos;
	}
}