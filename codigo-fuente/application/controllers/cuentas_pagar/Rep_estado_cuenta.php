<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_estado_cuenta extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de pagos a proveedores
		$this->load->model('cuentas_pagar/pagos_proveedores_model', 'pagos');
		//Cargamos el modelo de proveedores
		$this->load->model('cuentas_pagar/proveedores_model', 'proveedores');
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
		$this->cargar_vista('cuentas_pagar/rep_estado_cuenta', $arrDatos);
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
		$intProveedorID = $this->input->post('intProveedorID');

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .=  ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(70, 20, 20, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'C', 'R', 'R', 'R');
		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(130, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R', 'R');
		//Datos del primer título del reporte 
		$strTituloLinea1 = 'ESTADO DE CUENTA EN ';
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
	    $pdf->strLinea1 = $strTituloLinea1.'     '.$strTituloRangoFechas;
		//Seleccionar los datos del proveedor que coincide con el id
		$otdProveedor =  $this->proveedores->buscar($intProveedorID);
		$pdf->strLinea2 =  'PROVEEDOR: '.utf8_decode($otdProveedor->codigo.' - '.$otdProveedor->razon_social);

		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('DESCRIPCIÓN'), 'FOLIO', 'AFECTA', 'FECHA',  'CARGO', 
								 'ABONO', 'SALDO');
		
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

				//Variable que se utiliza para asignar el saldo inicial
				$intSaldoInicial = 0;
				//Variable que se utiliza para asignar el saldo actual del proveedor
				$intSaldoActual = 0;
				//Variable que se utiliza para asignar el acumulado de los cargos (ordenes de cuenta)
				$intAcumCargos = 0;
				//Variable que se utiliza para asignar el acumulado de los abonos (pagos, descuentos y anticipos)
				$intAcumAbonos = 0;

				//Hacer un llamado a la función para obtener el saldo inicial del proveedor
				$intSaldoInicial = $this->get_saldo_inicial($intProveedorID, $intMonedaID, $dteFechaInicial);
				$intSaldoActual =  $intSaldoInicial;
				
				//Seleccionar los movimientos (ordenes de compra, descuentos, pagos y anticipos) del proveedor
				$otdMovimientos = $this->pagos->buscar_movimientos_estado_cuenta($dteFechaInicial, $dteFechaFinal,
																				 $intProveedorID, $intMonedaID);

				//Si hay información del saldo inicial o movimientos del estado de cuenta
				if($otdMovimientos OR $intSaldoInicial > 0)
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
					

					//Recorremos el arreglo 
					foreach ($otdMovimientos as $arrMov)
					{
						//Variable que se utiliza para asignar el importe total de una orden de compra
						$intTotalCargo = '';
						//Variable que se utiliza para asignar el importe total de un pago, descuento o anticipo
						$intTotalAbono = '';
						//Asignar el importe del movimiento
						$intImporte = number_format($arrMov->importe, 2, '.','');  

						//Si el tipo de movimiento corresponde a un cargo (orden de compra)
						if($arrMov->tipo == 'cargo')
						{
							//Asignar importe total de la orden de compra
							$intTotalCargo = '$'. number_format($intImporte, 2);
							//Incrementar el saldo actual
							$intSaldoActual += $intImporte;
							//Incrementar acumulado
							$intAcumCargos += $intImporte;
						}
						else
						{
							//Asignar el importe total del pago, descuento o anticipo
							$intTotalAbono = '$'. number_format($intImporte, 2);
							//Decrementar el saldo actual
							$intSaldoActual -= $intImporte;
							//Incrementar acumulado
							$intAcumAbonos += $intImporte;
						}

						//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array(utf8_decode($arrMov->descripcion), $arrMov->folio, $arrMov->folio_referencia, 
					   					$arrMov->fecha_format, $intTotalCargo, $intTotalAbono,
					   					'$'.number_format($intSaldoActual,2)), $pdf->arrAlineacion, 'ClippedCell');
					}

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
	   								'$'.number_format($intSaldoActual, 2)), 
	   								$arrAlineacionTotales, 'ClippedCell');
	   				//Cambiar el volumen de la letra
					$pdf->strTipoLetraTabla = 'Normal';	

				}//Cierre de verificación de movimientos
			}

		}//Cierre de verificación de monedas

		//Ejecutar la salida del reporte
        $pdf->Output('estado_cuenta_'.$otdProveedor->codigo.'.pdf','I'); 
	}


    /*Método para generar un archivo XLS con el estado de cuenta 
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProveedorID = $this->input->post('intProveedorID');

        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 11;
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
		//Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última moneda)
		$intNumMaxRegistros = 0;

      	//Seleccionar los datos del proveedor que coincide con el id
		$otdProveedor =  $this->proveedores->buscar($intProveedorID);

		//Concatenar datos para el primer encabezado del reporte
		$strTituloLinea1 = 'ESTADO DE CUENTA EN ';

        //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

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
		if ($otdMonedas)
		{	
			//Recorremos el arreglo 
			foreach ($otdMonedas as $arrMon)
			{   

				//Asignar el id de la moneda actual
				$intMonedaID = $arrMon->moneda_id;
				
			    //Variable que se utiliza para asignar el saldo inicial
				$intSaldoInicial = 0;
				//Variable que se utiliza para asignar el saldo actual del proveedor
				$intSaldoActual = 0;
				//Variable que se utiliza para asignar el acumulado de los cargos (ordenes de cuenta)
				$intAcumCargos = 0;
				//Variable que se utiliza para asignar el acumulado de los abonos (pagos, descuentos y anticipos)
				$intAcumAbonos = 0;

			    //Asignar el nombre de la hoja
				$strNombreHoja = 'estado de cuenta '.$arrMon->codigo;

				//Hacer un llamado a la función para obtener el saldo inicial del proveedor
				$intSaldoInicial = $this->get_saldo_inicial($intProveedorID, $intMonedaID, $dteFechaInicial);
				$intSaldoActual =  $intSaldoInicial;

				//Seleccionar los movimientos (ordenes de compra, descuentos, pagos y anticipos) del proveedor
				$otdMovimientos = $this->pagos->buscar_movimientos_estado_cuenta($dteFechaInicial, $dteFechaFinal,
																				 $intProveedorID, $intMonedaID);

				//Concatenar datos para el primer encabezado del reporte
				$strEncabezado = $strTituloLinea1.'     '.$strTituloRangoFechas;

				//Se agrega el título del archivo
				$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);
				
				$objExcel->getActiveSheet()->setCellValue('A8', 'PROVEEDOR: '.$otdProveedor->codigo.' - '.$otdProveedor->razon_social);
			
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

		       	//Cambiar estilo de las siguientes celdas
		        $objExcel->getActiveSheet()
		        		 ->getStyle('A8:D8')
		        		 ->applyFromArray($arrStyleBold);

		        $objExcel->getActiveSheet()
		        		 ->getStyle('A9:D9')
		        		 ->applyFromArray($arrStyleBold);

		        //Preferencias de color de relleno de celda 
		        $objExcel->getActiveSheet()
		    			 ->getStyle('A9:D9')
		    			 ->applyFromArray($arrStyleFuenteColumnasPrinc);

		        $objExcel->getActiveSheet()
		    			 ->getStyle('A11:G11')
		    			 ->getFill()
		    			 ->applyFromArray($arrStyleColumnas);

		        //Preferencias de color de texto de la celda 
		    	$objExcel->getActiveSheet()
		    			 ->getStyle('A11:G11')
		    			 ->applyFromArray($arrStyleFuenteColumnas);
		    			 
		    	//Cambiar alineación de las siguientes celdas
		    	$objExcel->getActiveSheet()
		            	 ->getStyle('A9:D9')
		            	 ->getAlignment()
		            	 ->applyFromArray($arrStyleAlignmentLeft);	

				$objExcel->getActiveSheet()
		            	 ->getStyle('A11:G11')
		            	 ->getAlignment()
		            	 ->applyFromArray($arrStyleAlignmentCenter);


				//Si hay información del saldo inicial o movimientos del estado de cuenta
				if($otdMovimientos OR $intSaldoInicial > 0)
				{
					//Número de fila donde se va a comenzar a rellenar
				    $intFila = 12;
				    $intFilaInicial = 12;
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

				   	//Incrementar acumulado
					$intAcumCargos += $intSaldoActual;
				    
				    //Incrementar el indice para escribir los datos del siguiente registro
               		$intFila++;

					//Recorremos el arreglo 
					foreach ($otdMovimientos as $arrMov)
					{
						//Variable que se utiliza para asignar el importe total de una orden de compra
						$intTotalCargo = '';
						//Variable que se utiliza para asignar el importe total de un pago, descuento o anticipo
						$intTotalAbono = '';
						//Asignar el importe del movimiento
						$intImporte = number_format($arrMov->importe, 2, '.','');  


						//Si el tipo de movimiento corresponde a un cargo (orden de compra)
						if($arrMov->tipo == 'cargo')
						{
							//Asignar importe total de la orden de compra
							$intTotalCargo = $intImporte;
							//Incrementar el saldo actual
							$intSaldoActual += $intImporte;
							//Incrementar acumulado
							$intAcumCargos += $intImporte;
						}
						else
						{
							//Asignar el importe total del pago, descuento o anticipo
							$intTotalAbono = $intImporte;
							//Decrementar el saldo actual
							$intSaldoActual -= $intImporte;
							//Incrementar acumulado
							$intAcumAbonos += $intImporte;
						}

						//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
						//Agregar información del movimiento
						$objExcel->getActiveSheet()
						 		 ->setCellValue('A'.$intFila, $arrMov->descripcion)
						 		 ->setCellValueExplicit('B'.$intFila, $arrMov->folio, PHPExcel_Cell_DataType::TYPE_STRING)
						 		 ->setCellValueExplicit('C'.$intFila, $arrMov->folio_referencia, PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValue('D'.$intFila, $arrMov->fecha_format)
		                         ->setCellValue('E'.$intFila, $intTotalCargo)
		                         ->setCellValue('F'.$intFila, $intTotalAbono)
		                         ->setCellValue('G'.$intFila, $intSaldoActual);

		                //Incrementar el indice para escribir los datos del siguiente registro
                   		$intFila++;
					}

					//Asignar indice de fila donde se empezaran a escribir los totales
	       			$intFilaTotales = $intFila;

					//Escribir totales
		        	//Agregar información de los totales
					$objExcel->getActiveSheet()
	                         ->setCellValue('D'.$intFila, 'TOTALES:')
	                         ->setCellValue('E'.$intFila, $intAcumCargos)
	                         ->setCellValue('F'.$intFila, $intAcumAbonos)
	                         ->setCellValue('G'.$intFila, $intSaldoActual);

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
				        	 ->getStyle('D'.$intFilaTotales.':'.'D'.$intFilaTotales)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);
				        	 
		    		$objExcel->getActiveSheet()
				        	 ->getStyle('E'.$intFilaInicial.':'.'G'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

				    //Cambiar estilo de las siguientes celdas
		            $objExcel->getActiveSheet()
		            		 ->getStyle('D'.$intFila.':'.'G'.$intFila)
		            		 ->applyFromArray($arrStyleBold);


		            //Incrementar contador por cada moneda
					$intContadorHojas++;


					//Si el número de registros (por cada moneda) es mayor que el número máximo de registros 
				    if($intFila > $intNumMaxRegistros)
		            {
		            	//Asignar número de registros
		            	$intNumMaxRegistros = $intFila;
		            }

		            
	            }//Cierre de verificación de movimientos

			}

		}//Cierre de verificación de monedas

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'estado_cuenta_'.$otdProveedor->codigo.'.xls', 'estado de cuenta', $intNumMaxRegistros);
	}


	//Método que se utiliza para regresar el saldo inicial del proveedor
	public function get_saldo_inicial($intProveedorID, $intMonedaID, $dteFechaInicial)
	{
		//Variable que se utiliza para asignar el saldo inicial
		$intSaldoInicial = 0;

		//Seleccionar los datos de las ordenes de compra que coinciden con el parámetro enviado
		$otdResultado = $this->pagos->buscar_ordenes_compra_importes('reporte', NULL, $intProveedorID, 
																     $intMonedaID, NULL,  NULL, $dteFechaInicial);

		//Si hay información
		if($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Asignar el saldo de la orden de compra
				$intSaldo = $arrCol->saldo;

				//Si la orden de compra no se encuentra pagada
				if (($intSaldo >= 1) OR ($intSaldo <= -1))
				{
					//Incrementar el saldo inicial
					$intSaldoInicial+= $intSaldo;

				}//Cierre de verificación del saldo

			}
		}

		//Regresar el saldo inicial del proveedor
		return $intSaldoInicial;
	}
}