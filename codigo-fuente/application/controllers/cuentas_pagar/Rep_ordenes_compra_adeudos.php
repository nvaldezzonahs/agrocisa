<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_ordenes_compra_adeudos extends MY_Controller {
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
		$this->cargar_vista('cuentas_pagar/rep_ordenes_compra_adeudos', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con las ordenes de compra que tienen adeudos
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte = $this->input->post('dteFechaCorte');
		$intProveedorID = $this->input->post('intProveedorID');

		//Si existe id del proveedor
		if($intProveedorID > 0)
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado de ordenes de compra con adeudos de un proveedor
			$this->get_reporte_proveedor($dteFechaCorte, $intProveedorID);
		}
		else
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado general de ordenes de compra con adeudos
			$this->get_reporte_general($dteFechaCorte);
		}
	}


	//Método para generar un reporte PDF con el listado de ordenes de compra con adeudos de un proveedor
    public function get_reporte_proveedor($dteFechaCorte, $intProveedorID)
    {
    	
	    //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Variable que se utiliza para asignar el acumulado de anticipos
	    $intAcumAnticipos = 0;
	    //Variable que se utiliza para asignar el total del saldo
	    $intTotalSaldo = 0;
	    //Variable que se utiliza para asignar el total del saldo vencido
	    $intTotalSaldoVencido = 0;
	    //Variable que se utiliza para asignar los días de crédito
	    $intDiasCredito = 0;
	    //Variable que se utiliza para asignar el límite de crédito
	    $intLimiteCredito = 0;
	    //Array que se utiliza para agregar los datos de las ordenes de compra
	    $arrOrdenesCompra = array();
	    //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFechaCorte = $this->get_fecha_formato_letra($dteFechaCorte, 'C');

	    //Seleccionar los datos del proveedor que coincide con el id
		$otdProveedor = $this->proveedores->buscar($intProveedorID);

		//Asignación de valores crediticios del proveedor
		$intDiasCredito = $otdProveedor->dias_credito;
    	$intLimiteCredito = $otdProveedor->limite_credito;

	    //Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA', utf8_decode('DESCRIPCIÓN'), 
								  'IMPORTE',  'SALDO', 'VENCIMIENTO', utf8_decode('DÍAS VENC.'));
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(18, 18, 56, 30, 30, 20, 18);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'L', 'R', 'R', 'C', 'R');
		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(37, 16,  23, 20, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('L', 'R', 'R', 'R', 'R', 'R', 'R', 'R');
		//Datos del primer título del reporte 
		$strTituloLinea1 = 'ORDENES DE COMPRA CON ADEUDOS EN ';
		$strTituloFechaCorte = 'FECHA DE CORTE: '.$strTituloFechaCorte;
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
	    $pdf->strLinea1 = $strTituloLinea1.'     '.$strTituloFechaCorte;
		//Asignar el valor de la línea cuatro del título
		$pdf->strLinea2 =  'PROVEEDOR: '.utf8_decode($otdProveedor->codigo.' - '.$otdProveedor->razon_social);
				
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
				$intAcumSaldo = 0;
				$intAcumSaldoVencido = 0;
			    $intAcumAnticipos = 0;
				$arrOrdenesCompra = array();

				//Asignar objeto con el saldo del proveedor en la fecha de corte
				$otdSaldoProveedor = $this->get_saldo_proveedores($dteFechaCorte, $intMonedaID, $intProveedorID);

				//Asignar array con los datos de las ordenes de compra
				$arrOrdenesCompra = $otdSaldoProveedor['rows'];
				//Asignar el acumulado del saldo del proveedor
				$intAcumSaldo =  $otdSaldoProveedor['acumulado_saldo'];
				//Asignar el acumulado del saldo vencido del proveedor
				$intAcumSaldoVencido =  $otdSaldoProveedor['acumulado_saldo_vencido'];
				//Asignar el acumulado del saldo vencido del proveedor
				$intAcumAnticipos =  $otdSaldoProveedor['acumulado_anticipos'];

				//Si existe saldo del proveedor
				if($intAcumSaldo > 0)
				{
					//Concatenar moneda para el primer encabezado del reporte
					$strTituloMoneda = $strTituloLinea1.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$pdf->strLinea1 = $strTituloMoneda.'     '.$strTituloFechaCorte;
					//Agregar pagina
					$pdf->AddPage();
					//Establece el ancho de las columnas
					$pdf->SetWidths($pdf->arrAnchura);

					//Si hay información de las ordenes de compra
				    if($arrOrdenesCompra)
					{
					    //Recorremos el arreglo 
						foreach ($arrOrdenesCompra as $arrOrd)
						{
							//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					   		$pdf->Row(array($arrOrd['folio'], $arrOrd['fecha'],
					   						$arrOrd['referencia'],
					   						'$'.number_format($arrOrd['importe'],2),
					   						'$'.number_format($arrOrd['saldo'],2), 
					   						$arrOrd['fecha_vencimiento'],
					   						$arrOrd['dias_vencidos']), 
					    				    $pdf->arrAlineacion, 'ClippedCell');
						}

					}//Cierre de verificación de información 

					$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
					$pdf->Ln(1); //Deja un salto de línea

					//Calcular el total del saldo
					$intTotalSaldo = $intAcumSaldo - $intAcumAnticipos;
				
					//Calcular el total del saldo vencido
					$intTotalSaldoVencido = $intAcumSaldoVencido - $intAcumAnticipos;

					//Escribir totales
		   			//Establece el ancho de las columnas
			    	$pdf->SetWidths($arrAnchuraTotales);
				    //Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';


					//Días de crédito
					$pdf->Row(array(utf8_decode('DÍAS DE CRÉDITO:'), $intDiasCredito, 
									'SALDO:','$'.number_format($intAcumSaldo,2), 
									'ANTICIPO:','$'.number_format($intAcumAnticipos,2),
									'TOTAL:', '$'.number_format($intTotalSaldo,2)), 
						  			$arrAlineacionTotales, 'ClippedCell');

			

					//Límite de crédito
					$pdf->Row(array(utf8_decode('LÍMITE DE CRÉDITO:'), 
									'$'.number_format($intLimiteCredito,2), 
									'VENCIDO:','$'.number_format($intAcumSaldoVencido,2), 
									'ANTICIPO:','$'.number_format($intAcumAnticipos,2),
									'TOTAL:', '$'.number_format($intTotalSaldoVencido,2)), 
						  			$arrAlineacionTotales, 'ClippedCell');

	      			//Cambiar el volumen de la letra
    				$pdf->strTipoLetraTabla = 'Normal';

			    }//Cierre de verificación de información de saldo 
			}

		}//Cierre de verificación de monedas

		//Ejecutar la salida del reporte
        $pdf->Output('ordenes_adeudos_'.$otdProveedor->codigo.'.pdf','I'); 
    }

    
    //Método para generar un reporte PDF con el listado general de ordenes de compra con adeudos
    public function get_reporte_general($dteFechaCorte) 
	{	
	    //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Array que se utiliza para agregar los datos (saldos) de los proveedores
	    $arrProveedores = array();
	    //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFechaCorte = $this->get_fecha_formato_letra($dteFechaCorte, 'C');

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('PROVEEDOR', utf8_decode('DÍAS DE CRED.'), 'SALDO FECHA',  'SALDO VENCIDO', 
							 	  'FECHA VENCIDA', utf8_decode('DÍAS VENC.'), 'EDO. CRED.');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(54, 15, 30, 30, 25, 18, 18);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'R', 'R', 'R', 'C', 'R', 'C');
		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(69, 30, 30);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R');

		//Datos del primer título del reporte 
		$strTituloLinea1 = 'ORDENES DE COMPRA CON ADEUDOS EN ';
		$strTituloFechaCorte = 'FECHA DE CORTE: '.$strTituloFechaCorte;
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
	    $pdf->strLinea1 = $strTituloLinea1.'     '.$strTituloFechaCorte;
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
				$intAcumSaldo = 0;
				$intAcumSaldoVencido = 0;
				$arrProveedores = array();

				//Asignar objeto con el saldo de los proveedores en la fecha de corte
				$otdSaldoProveedores = $this->get_saldo_proveedores($dteFechaCorte, $intMonedaID);
				//Asignar array con los datos de los proveedores
				$arrProveedores = $otdSaldoProveedores['rows'];
				//Asignar el acumulado del saldo de los proveedores
				$intAcumSaldo =  $otdSaldoProveedores['acumulado_saldo'];
				//Asignar el acumulado del saldo vencido de los proveedores
				$intAcumSaldoVencido =  $otdSaldoProveedores['acumulado_saldo_vencido'];

				//Si existe saldo de los proveedores
				if($intAcumSaldo > 0)
				{
					//Concatenar moneda para el primer encabezado del reporte
					$strTituloMoneda = $strTituloLinea1.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$pdf->strLinea1 = $strTituloMoneda.'     '.$strTituloFechaCorte;
					//Agregar pagina
					$pdf->AddPage();
					//Establece el ancho de las columnas
					$pdf->SetWidths($pdf->arrAnchura);

					//Si hay información de proveedors
				    if($arrProveedores)
					{
					    //Recorremos el arreglo 
						foreach ($arrProveedores as $arrSal)
						{	
							//Variable que se utiliza para asignar el saldo vencido
							$intSaldoVencido = $arrSal['saldo_vencido'];

							//Si existe saldo vencido
							if($intSaldoVencido > 0)
							{	
								//Convertir cantidad a formato moneda
								$intSaldoVencido  = '$'.number_format($intSaldoVencido,2);
							}

							//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					   		$pdf->Row(array(utf8_decode($arrSal['proveedor']), 
					   						$arrSal['dias_credito'],
					   						'$'.number_format($arrSal['saldo'],2),
					   						$intSaldoVencido, 
					   						$arrSal['fecha_vencimiento'],
					   						$arrSal['dias_vencidos'],
					   						$arrSal['estado_credito']), 
					    				    $pdf->arrAlineacion, 'ClippedCell');
						}

					}//Cierre de verificación de información 

					$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales

					//Escribir totales
		   			//Establece el ancho de las columnas
			    	$pdf->SetWidths($arrAnchuraTotales);
				    //Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
	      			//Acumulado de los saldos
					$pdf->Row(array('TOTAL:', '$'.number_format($intAcumSaldo, 2),
									'$'.number_format($intAcumSaldoVencido, 2)), 
					    		    $arrAlineacionTotales, 'ClippedCell');
					//Cambiar el volumen de la fuente a normal
	      			$pdf->strTipoLetraTabla = '';

				}//Cierre de verificación de información de saldos 

			}

		}//Cierre de verificación de monedas

		//Ejecutar la salida del reporte
        $pdf->Output('ordenes_adeudos_general.pdf','I'); 
	}

   

	/*Método para generar un archivo XLS con las ordenes de compra que tienen adeudos
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte = $this->input->post('dteFechaCorte');
		$intProveedorID = $this->input->post('intProveedorID');

		//Si existe id del proveedor
		if($intProveedorID > 0)
		{
			//Hacer un llamado a la función para generar un archivo XLS con el listado de ordenes de compra con adeudos de un proveedor
			$this->get_xls_proveedor($dteFechaCorte, $intProveedorID);
		}
		else
		{
			//Hacer un llamado a la función para generar un archivo XLS con el listado general de ordenes de compra con adeudos
			$this->get_xls_general($dteFechaCorte);
		}
	}


	//Método para generar un archivo XLS con el listado de ordenes de compra con adeudos de un proveedor
     public function get_xls_proveedor($dteFechaCorte, $intProveedorID)
    {
    	
    	//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
	      //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Variable que se utiliza para asignar el acumulado de anticipos
	    $intAcumAnticipos = 0;
	    //Variable que se utiliza para asignar el total del saldo
	    $intTotalSaldo = 0;
	    //Variable que se utiliza para asignar el total del saldo vencido
	    $intTotalSaldoVencido = 0;
	    //Variable que se utiliza para asignar los días de crédito
	    $intDiasCredito = 0;
	    //Variable que se utiliza para asignar el límite de crédito
	    $intLimiteCredito = 0;
	    //Array que se utiliza para agregar los datos de las ordenes de compra
	    $arrOrdenesCompra = array();
		//Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última moneda)
		$intNumMaxRegistros = 0;
	    //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFechaCorte = $this->get_fecha_formato_letra($dteFechaCorte, 'C');

		//Datos del primer título del reporte 
		$strTituloLinea1 = 'ORDENES DE COMPRA CON ADEUDOS EN ';
		$strTituloFechaCorte = 'FECHA DE CORTE: '.$strTituloFechaCorte;

 		//Seleccionar los datos del proveedor que coincide con el id
		$otdProveedor = $this->proveedores->buscar($intProveedorID);

		//Asignación de valores crediticios del proveedor
		$intDiasCredito = $otdProveedor->dias_credito;
    	$intLimiteCredito = $otdProveedor->limite_credito;

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
				$strNombreHoja = 'ordenes de compra con adeudos '.$arrMon->codigo;
				//Inicializar variables
				$intAcumSaldo = 0;
				$intAcumSaldoVencido = 0;
				$intAcumAnticipos = 0;
				$arrOrdenesCompra = array();

				//Asignar objeto con el saldo del proveedor en la fecha de corte
				$otdSaldoProveedor = $this->get_saldo_proveedores($dteFechaCorte, $intMonedaID, $intProveedorID);

				//Asignar array con los datos de las ordenes de compra
				$arrOrdenesCompra = $otdSaldoProveedor['rows'];
				//Asignar el acumulado del saldo del proveedor
				$intAcumSaldo =  $otdSaldoProveedor['acumulado_saldo'];
				//Asignar el acumulado del saldo vencido del proveedor
				$intAcumSaldoVencido =  $otdSaldoProveedor['acumulado_saldo_vencido'];
				//Asignar el acumulado del saldo vencido del proveedor
				$intAcumAnticipos =  $otdSaldoProveedor['acumulado_anticipos'];

				//Concatenar datos para el primer encabezado del reporte
				$strEncabezado = $strTituloLinea1.'     '.$strTituloFechaCorte;
				//Se agrega el título del archivo
				$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);
				$objExcel->getActiveSheet()->setCellValue('A8', 'PROVEEDOR: '.$otdProveedor->codigo.' - '.
																			  $otdProveedor->razon_social);

				//Se agregan las columnas de cabecera
		        $objExcel->getActiveSheet()->setCellValue('A'.$intPosEncabezados, 'FOLIO')
		                 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
		                 ->setCellValue('C'.$intPosEncabezados, 'DESCRIPCIÓN')
		                 ->setCellValue('D'.$intPosEncabezados, 'IMPORTE')
		                 ->setCellValue('E'.$intPosEncabezados, 'SALDO')
		                 ->setCellValue('F'.$intPosEncabezados, 'VENCIMIENTO')
		                 ->setCellValue('G'.$intPosEncabezados, 'DÍAS VENCIDOS');

		        //Combinar las siguientes celdas
		       	$objExcel->getActiveSheet()->mergeCells('A8:D8');

		       	//Cambiar estilo de las siguientes celdas
		        $objExcel->getActiveSheet()
		        		 ->getStyle('A8:D8')
		        		 ->applyFromArray($arrStyleBold);

		        //Preferencias de color de relleno de celda
		        $objExcel->getActiveSheet()
		    			 ->getStyle('A10:G10')
		    			 ->getFill()
		    			 ->applyFromArray($arrStyleColumnas);
		     
		    	//Preferencias de color de texto de la celda
		    	$objExcel->getActiveSheet()
		    			 ->getStyle('A10:G10')
		    			 ->applyFromArray($arrStyleFuenteColumnas);

		    	//Cambiar alineación de las siguientes celdas
		    	$objExcel->getActiveSheet()
		            	 ->getStyle('A10:G10')
		            	 ->getAlignment()
		            	 ->applyFromArray($arrStyleAlignmentCenter);

				//Si existe saldo del proveedor
				if($intAcumSaldo > 0)
				{
					//Número de fila donde se va a comenzar a rellenar
				    $intFila = 11;
				    $intFilaInicial = 11;

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
					$strTituloLinea1 = 'ORDENES DE COMPRA CON ADEUDOS EN '.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$strEncabezado = $strTituloLinea1.'     '.$strTituloFechaCorte;

					//Se agrega el título del archivo
					$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);
					
			        //Si hay información de las ordenes de compra
				    if($arrOrdenesCompra)
					{
					    //Recorremos el arreglo 
						foreach ($arrOrdenesCompra as $arrOrd)
						{
					   		//Agregar información de la orden de compra
				            $objExcel->getActiveSheet()
			                         ->setCellValue('A'.$intFila, $arrOrd['folio'])
			                         ->setCellValue('B'.$intFila, $arrOrd['fecha'])
			                         ->setCellValue('C'.$intFila, $arrOrd['referencia'])
			                         ->setCellValue('D'.$intFila, $arrOrd['importe'])
			                         ->setCellValue('E'.$intFila, $arrOrd['saldo'])
			                         ->setCellValue('F'.$intFila, $arrOrd['fecha_vencimiento'])
			                         ->setCellValue('G'.$intFila, $arrOrd['dias_vencidos']);

			                //Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;

						}

						//Incrementar contador por cada moneda
						$intContadorHojas++;

					}//Cierre de verificación de información 


					//Cambiar contenido de las celdas a formato moneda
	           		$objExcel->getActiveSheet()
		            		 ->getStyle('D'.$intFilaInicial.':'.'E'.$intFila)
		            		 ->getNumberFormat()
		            		 ->setFormatCode('$#,##0.00');


		            //Cambiar alineación de las siguientes celdas
		            $objExcel->getActiveSheet()
				        	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentCenter);

		    		$objExcel->getActiveSheet()
				        	 ->getStyle('D'.$intFilaInicial.':'.'E'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

				    $objExcel->getActiveSheet()
				        	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentCenter);

				    $objExcel->getActiveSheet()
				        	 ->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);


					//Incrementar el indice para escribir los totales
		            $intFila++;
		            //Asignar indice de fila donde se empezaran a escribir los totales
		            $intFilaTotales =  $intFila;

			         //Calcular el total del saldo
					$intTotalSaldo = $intAcumSaldo - $intAcumAnticipos;
					
					//Calcular el total del saldo vencido
					$intTotalSaldoVencido = $intAcumSaldoVencido - $intAcumAnticipos;

			        //Escribir totales
	                //Agregar información del saldo
					$objExcel->getActiveSheet()
	                         ->setCellValue('A'.$intFila, 'DÍAS DE CRÉDITO: ')
	                         ->setCellValue('B'.$intFila, $intDiasCredito)
	                         ->setCellValue('D'.$intFila, 'SALDO:  '.'$'. number_format($intAcumSaldo, 2))
	                         ->setCellValue('E'.$intFila, 'ANTICIPO:  '.'$'. number_format($intAcumAnticipos, 2))
	                         ->setCellValue('F'.$intFila, 'TOTAL:  '.'$'. number_format($intTotalSaldo, 2));


	                //Incrementar el indice para escribir límite de crédito
			        $intFila++;

			        //Agregar información del saldo vencido
	                $objExcel->getActiveSheet()
	                         ->setCellValue('A'.$intFila, 'LÍMITE DE CRÉDITO: ')
	                         ->setCellValue('B'.$intFila, '$'. number_format($intLimiteCredito, 2))
	                         ->setCellValue('D'.$intFila, 'SALDO:  '. '$'. number_format($intAcumSaldoVencido, 2))
	                         ->setCellValue('E'.$intFila, 'ANTICIPO:  '.'$'. number_format($intAcumAnticipos, 2))
	                         ->setCellValue('F'.$intFila, 'TOTAL:  '.'$'. number_format($intTotalSaldoVencido, 2));


	                //Cambiar contenido de las celdas a formato moneda
	           		$objExcel->getActiveSheet()
		            		 ->getStyle('B'.$intFila.':'.'F'.$intFila)
		            		 ->getNumberFormat()
		            		 ->setFormatCode('$#,##0.00');


		           //Cambiar alineación de las siguientes celdas
		    		$objExcel->getActiveSheet()
				        	 ->getStyle('B'.$intFilaTotales.':'.'F'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

		           //Cambiar estilo de las siguientes celdas
			        $objExcel->getActiveSheet()
			            		 ->getStyle('A'.$intFilaTotales.':'.'F'.$intFila)
			            		 ->applyFromArray($arrStyleBold);


	                //Si el número de registros (por cada moneda) es mayor que el número máximo de registros 
				    if($intFila > $intNumMaxRegistros)
		            {
		            	//Asignar número de registros
		            	$intNumMaxRegistros = $intFila;
		            }


				}//Cierre de verificación de información de saldo 

			}

		}//Cierre de verificación de monedas


		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'ordenes_compra_adeudos_'.$otdProveedor->codigo.'.xls', 'ordenes de compra con adeudos', $intNumMaxRegistros);
    }



    //Método para generar un archivo XLS con el listado general de ordenes de compra con adeudos
    public function get_xls_general($dteFechaCorte)
    {
    	//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Array que se utiliza para agregar los datos (saldos) de los proveedores
	    $arrProveedores = array();
		//Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última moneda)
		$intNumMaxRegistros = 0;
	    //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFechaCorte = $this->get_fecha_formato_letra($dteFechaCorte, 'C');

		//Concatenar datos para el primer encabezado del reporte
		$strTituloLinea1 = 'ORDENES DE COMPRA CON ADEUDOS EN ';
		$strTituloFechaCorte = 'FECHA DE CORTE: '.$strTituloFechaCorte;

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
				$strNombreHoja = 'ordenes de compra con adeudos '.$arrMon->codigo;
				//Inicializar variables
				$intAcumSaldo = 0;
				$intAcumSaldoVencido = 0;
				$arrProveedores = array();

				//Asignar objeto con el saldo de los proveedores en la fecha de corte
				$otdSaldoProveedores = $this->get_saldo_proveedores($dteFechaCorte, $intMonedaID);

			    //Asignar array con los datos de los proveedores
				$arrProveedores = $otdSaldoProveedores['rows'];
				//Asignar el acumulado del saldo de los proveedores
				$intAcumSaldo =  $otdSaldoProveedores['acumulado_saldo'];
				//Asignar el acumulado del saldo vencido de los proveedores
				$intAcumSaldoVencido =  $otdSaldoProveedores['acumulado_saldo_vencido'];

				//Concatenar datos para el primer encabezado del reporte
				$strEncabezado = $strTituloLinea1.'     '.$strTituloFechaCorte;

				//Se agrega el título del archivo
				$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);

				//Se agregan las columnas de cabecera
		        $objExcel->getActiveSheet()->setCellValue('A'.$intPosEncabezados, 'PROVEEDOR')
		        		 ->setCellValue('B'.$intPosEncabezados, 'DÍAS DE CRÉDITO')
		                 ->setCellValue('C'.$intPosEncabezados, 'SALDO FECHA')
		                 ->setCellValue('D'.$intPosEncabezados, 'SALDO VENCIDO')
		                 ->setCellValue('E'.$intPosEncabezados, 'FECHA VENCIDA')
		                 ->setCellValue('F'.$intPosEncabezados, 'DÍAS VENCIDOS')
		                 ->setCellValue('G'.$intPosEncabezados, 'ESTADO DEL CRÉDITO');

			
		        //Preferencias de color de relleno de celda
		        $objExcel->getActiveSheet()
		    			 ->getStyle('A9:G9')
		    			 ->getFill()
		    			 ->applyFromArray($arrStyleColumnas);
		     
		    	//Preferencias de color de texto de la celda
		    	$objExcel->getActiveSheet()
		    			 ->getStyle('A9:G9')
		    			 ->applyFromArray($arrStyleFuenteColumnas);

		    	//Cambiar alineación de las siguientes celdas
		    	$objExcel->getActiveSheet()
		            	 ->getStyle('A9:G9')
		            	 ->getAlignment()
		            	 ->applyFromArray($arrStyleAlignmentCenter);

				//Si existe saldo de los proveedores
				if($intAcumSaldo > 0)
				{
					//Número de fila donde se va a comenzar a rellenar
				    $intFila = 10;
				    $intFilaInicial = 10;


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
					$strTituloLinea1 = 'ORDENES DE COMPRA CON ADEUDOS EN '.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$strEncabezado = $strTituloLinea1.'     '.$strTituloFechaCorte;


					//Se agrega el título del archivo
					$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);

			        //Si hay información de proveedores
				    if($arrProveedores)
					{
					    //Recorremos el arreglo 
						foreach ($arrProveedores as $arrSal)
						{

					   		//Agregar información del proveedor
				            $objExcel->getActiveSheet()
			                         ->setCellValue('A'.$intFila, $arrSal['proveedor'])
			                         ->setCellValue('B'.$intFila, $arrSal['dias_credito'])
			                         ->setCellValue('C'.$intFila, $arrSal['saldo'])
			                         ->setCellValue('D'.$intFila, $arrSal['saldo_vencido'])
			                         ->setCellValue('E'.$intFila, $arrSal['fecha_vencimiento'])
			                         ->setCellValue('F'.$intFila, $arrSal['dias_vencidos'])
			                         ->setCellValue('G'.$intFila, $arrSal['estado_credito']);

			                //Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;

						}

					    //Incrementar contador por cada moneda
						$intContadorHojas++;

					}//Cierre de verificación de información 
					
					//Incrementar el indice para escribir los totales
		            $intFila++;

	            	//Escribir totales
		        	//Agregar información de los totales
					$objExcel->getActiveSheet()
	                         ->setCellValue('B'.$intFila, 'TOTALES:')
	                         ->setCellValue('C'.$intFila, $intAcumSaldo)
	                         ->setCellValue('D'.$intFila, $intAcumSaldoVencido);


                   //Cambiar contenido de las celdas a formato moneda
	           		$objExcel->getActiveSheet()
		            		 ->getStyle('C'.$intFilaInicial.':'.'D'.$intFila)
		            		 ->getNumberFormat()
		            		 ->setFormatCode('$#,##0.00');


	             	//Cambiar alineación de las siguientes celdas
		    		$objExcel->getActiveSheet()
				        	 ->getStyle('B'.$intFilaInicial.':'.'D'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

				    $objExcel->getActiveSheet()
				        	 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentCenter);

				    $objExcel->getActiveSheet()
				        	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

				    $objExcel->getActiveSheet()
				        	 ->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentCenter);

				    //Cambiar estilo de las siguientes celdas
			        $objExcel->getActiveSheet()
			            		 ->getStyle('B'.$intFila.':'.'D'.$intFila)
			            		 ->applyFromArray($arrStyleBold);


				    //Si el número de registros (por cada moneda) es mayor que el número máximo de registros 
				    if($intFila > $intNumMaxRegistros)
		            {
		            	//Asignar número de registros
		            	$intNumMaxRegistros = $intFila;
		            }

				}//Cierre de verificación de información de saldos
			  
			}

		}//Cierre de verificación de monedas

        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'ordenes_compra_adeudos_general.xls', 'ordenes de compra con adeudos', $intNumMaxRegistros);
    }
    

    //Función que se utiliza para regresar proveedores con saldo en la fecha de corte
	public function get_saldo_proveedores($dteFechaCorte, $intMonedaID, $intProveedorBusqID = NULL)
	{
		//Array que se utiliza para enviar datos
		$arrDatos = array('rows' => NULL, 
						  'acumulado_saldo' => '0.00',
						  'acumulado_saldo_vencido' => '0.00',
						  'acumulado_anticipos' => '0.00');

		//Variable que se utiliza pra asignar el id actual del proveedor
	    $intProveedorIDActual = 0;
	    //Variable que se utiliza pra asignar la fecha vencida
	    $strFecha = '';
	    //Variable que se utiliza pra asignar el estado del crédito
	    $strEstadoCredito = '';
	    //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
		//Variable que se utiliza para asignar el acumulado de anticipos
	    $intAcumAnticipos = 0;
	    //Array que se utiliza para agregar los datos de los proveedores
        $arrProveedores = array();
        //Array que se utiliza para agregar los datos de un proveedor
        $arrAuxiliar = array();

        //Seleccionar los datos de las ordenes de compra que coinciden con el parámetro enviado
		$otdResultado = $this->pagos->buscar_ordenes_compra_importes('reporte', $dteFechaCorte, 
																	 $intProveedorBusqID, $intMonedaID);

		//Si hay información
		if($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{

				//Si la orden de compra no se encuentra pagada
				if (($arrCol->saldo >= 1) OR ($arrCol->saldo <= -1))
				{

					//Asignar el saldo de la orden de compra
					$intSaldoOrdenCompra = $arrCol->saldo;
                    
                    //Si no existe id del proveedor, significa que se van a obtener los datos para el reporte general
                    if($intProveedorBusqID == NULL)
                    {
                    	//Si el proveedor actual es diferente al anterior
						if ($intProveedorIDActual != $arrCol->proveedor_id)
						{
							//Si existe id del proveedor actual
							if ($intProveedorIDActual > 0)
							{
							   
								//Seleccionar el total de anticipos del proveedor
							    $otdAnticipos = $this->pagos->buscar_anticipo_ordenes_compra_adeudos('reporte',
																									 $dteFechaCorte, 
																									 $intProveedorIDActual,
																									 $intMonedaID);
							    //Si hay información
								if($otdAnticipos)
								{
									//Recorremos el arreglo 
									foreach ($otdAnticipos as $arrAnt)
									{
										//Asignar el total de anticipos
										$intAcumAnticipos += $arrAnt->importe;
									}

									//Decrementar saldos
		                            $intSaldo -=  $intAcumAnticipos;
		                            
		                            //Si existe saldo vencido
									$intSaldoVencido = (($intSaldoVencido > 0) ? 
														 $intSaldoVencido -= $intAcumAnticipos : $intSaldoVencido);

		                            //Decrementar acumulados
		                       		$intAcumSaldo -= $intAcumAnticipos;
		                       		
		                       		//Si existe acumulado del saldo vencido
									$intAcumSaldoVencido = (($intAcumSaldoVencido > 0) ? 
															$intAcumSaldoVencido -= $intAcumAnticipos : $intAcumSaldoVencido);
								}

								//Si existe fecha vencida
	                            if ($dteFechaVencimiento != "")
	                            {
	                            	//Separar fecha vencida
	                                $strFecha = substr($dteFechaVencimiento, 8, 2)."/";
	                                $strFecha.= substr($dteFechaVencimiento, 5, 2)."/";
	                                $strFecha.= substr($dteFechaVencimiento, 0, 4);
	                            }

	                            //Si existe saldo vencido
	                            if ($intSaldoVencido > 0)
	                            {
	                            	$strEstadoCredito = 'SUSP.';
	                            }
	                            else
	                            {
	                            	$strEstadoCredito = 'VIG.';
	                            }


	                            //Definir valores del array auxiliar de información (para cada proveedor)
								$arrAuxiliar["proveedor"] = $strProveedor;
								$arrAuxiliar["saldo"] = $intSaldo;
								$arrAuxiliar["saldo_vencido"] = $intSaldoVencido;
								$arrAuxiliar["fecha_vencimiento"] = $strFecha;
								$arrAuxiliar["dias_vencidos"] = $intDiasVencidos;
								$arrAuxiliar["dias_credito"] = $intCreditoDias;
								$arrAuxiliar["estado_credito"] = $strEstadoCredito;
				                //Agregar datos al array
				                array_push($arrProveedores, $arrAuxiliar);

							}

							//Asignar valores del proveedor
							$intProveedorIDActual = $arrCol->proveedor_id;
	                        $strProveedor = $arrCol->codigo.' '.$arrCol->razon_social;
	                        $intCreditoDias = $arrCol->dias_credito;
	                        $intSaldo = $intSaldoOrdenCompra;
	                        //Incrementar acumulado del saldo
	                        $intAcumSaldo += $intSaldoOrdenCompra;
	                        //Limpiar las siguientes variables (por cada proveedor recorrido)
	                        $intSaldoVencido = "";
	                        $dteFechaVencimiento = "";
	                        $intDiasVencidos = "";
	                        $strFecha = "";
							$intAcumAnticipos = 0;

	                        //Si la fecha de vencimiento es menor que la fecha de corte
	                        if ($arrCol->fecha_vencimiento < $dteFechaCorte)
	                        {
	                        	//Asignar saldo de la orden de compra
	                            $intSaldoVencido = $intSaldoOrdenCompra;
	                            //Incrementar acumulado del saldo vencido
	                            $intAcumSaldoVencido += $intSaldoOrdenCompra;
	                            //Asignar fecha de vencimiento de la orden de compra
	                            $dteFechaVencimiento = $arrCol->fecha_vencimiento;
	                            //Hacer un llamado a la función para calcular los días vencidos
	                        	$intDiasVencidos = $this->get_dias_vencidos($dteFechaCorte, $dteFechaVencimiento);
	                        }

	                        //Asignar fecha de la orden de compra
			                $strFechaUltVencimiento = $arrCol->fecha;

						}
						else
						{
							//Incrementar acumulados
							$intSaldo += $intSaldoOrdenCompra;
			                $intAcumSaldo += $intSaldoOrdenCompra;

			                //Si la fecha de vencimiento es menor que la fecha de corte
	                        if ($arrCol->fecha_vencimiento < $dteFechaCorte)
	                        {
	                        	//Incrementar el saldo vencido
			                    $intSaldoVencido += $intSaldoOrdenCompra;
	                            //Incrementar acumulado del saldo vencido
	                            $intAcumSaldoVencido += $intSaldoOrdenCompra;

	                            //Si la fecha de vencimiento es menor que la fecha vencida
	                            if (($arrCol->fecha_vencimiento < $dteFechaVencimiento) OR 
	                            	($dteFechaVencimiento == ""))
	                            {
	                            	//Asignar fecha de vencimiento de la orden de compra
	                                $dteFechaVencimiento = $arrCol->fecha_vencimiento;
	                                //Hacer un llamado a la función para calcular los días vencidos
	                        		$intDiasVencidos = $this->get_dias_vencidos($dteFechaCorte, $dteFechaVencimiento);
	                            }
	                        }

	                        //Si la fecha es mayor que la última fecha de vencimiento
	                        if ($arrCol->fecha > $strFechaUltVencimiento)
	                        {
	                        	//Asignar fecha de la orden de compra
	                            $strFechaUltVencimiento = $arrCol->fecha;
	                        }

						}

                    }
                    else //Obtener los datos para el reporte individual
                    {
                    	//Inicializar variables
	                    $intDiasVencidos = 0;
	                    //Asignar fecha de vencimiento de la orden de compra
	                    $dteFechaVencimiento = $arrCol->fecha_vencimiento;

						//Si la fecha de vencimiento es menor que la fecha de corte
	                    if ($dteFechaVencimiento < $dteFechaCorte)
	                    {
	                        //Incrementar acumulado del saldo vencido
	                        $intAcumSaldoVencido += $intSaldoOrdenCompra;
	                        //Hacer un llamado a la función para calcular los días vencidos
	                        $intDiasVencidos = $this->get_dias_vencidos($dteFechaCorte, $dteFechaVencimiento);
	                    }

	                    //Definir valores del array auxiliar de información del proveedor
						$arrAuxiliar["folio"] = $arrCol->folio;
						$arrAuxiliar["fecha"] = $arrCol->fecha_format;
						$arrAuxiliar["referencia"] = $arrCol->referencia;
						$arrAuxiliar["importe"] = $arrCol->importe;
						$arrAuxiliar["saldo"] = $intSaldoOrdenCompra;
						$arrAuxiliar["fecha_vencimiento"] = $arrCol->fecha_vencimiento_format;
						$arrAuxiliar["dias_vencidos"] = $intDiasVencidos;
		                //Agregar datos al array
		                array_push($arrProveedores, $arrAuxiliar);

		                //Incrementar acumulado del saldo
                   		$intAcumSaldo += $intSaldoOrdenCompra;
                    }
                    

				}//Cierre de verificación del saldo

			}

			//Escribir los acumulados del último proveedor (en caso de que sea el reporte general)
			if ($intProveedorIDActual > 0 && $intProveedorBusqID == NULL)
			{

				//Seleccionar el total de anticipos del proveedor
				$otdAnticipos = $this->pagos->buscar_anticipo_ordenes_compra_adeudos('reporte',
																					 $dteFechaCorte, 
																					 $intProveedorIDActual,
																					 $intMonedaID);


									

				//Si hay información
				if($otdAnticipos)
				{
					//Recorremos el arreglo 
					foreach ($otdAnticipos as $arrAnt)
					{
						//Asignar el total de anticipos
						$intAcumAnticipos += $arrAnt->importe;
					}

					//Decrementar saldos
                    $intSaldo -=  $intAcumAnticipos;
                    
                    //Si existe saldo vencido
					$intSaldoVencido = (($intSaldoVencido > 0) ? 
										 $intSaldoVencido -= $intAcumAnticipos : $intSaldoVencido);

                    //Decrementar acumulados
               		$intAcumSaldo -= $intAcumAnticipos;
               		
               		//Si existe acumulado del saldo vencido
					$intAcumSaldoVencido = (($intAcumSaldoVencido > 0) ? 
											$intAcumSaldoVencido -= $intAcumAnticipos : $intAcumSaldoVencido);
				}
						
				//Si existe fecha vencida
                if ($dteFechaVencimiento != "")
                {
                	//Separar fecha vencida
                    $strFecha = substr($dteFechaVencimiento, 8, 2)."/";
                    $strFecha.= substr($dteFechaVencimiento, 5, 2)."/";
                    $strFecha.= substr($dteFechaVencimiento, 0, 4);
                }

                //Si existe saldo vencido
                if ($intSaldoVencido > 0)
                {
                	$strEstadoCredito = 'SUSP.';
                }
                else
                {
                	$strEstadoCredito = 'VIG.';
                }


                //Definir valores del array auxiliar de información (para cada proveedor)
				$arrAuxiliar["proveedor"] = $strProveedor;
				$arrAuxiliar["saldo"] = $intSaldo;
				$arrAuxiliar["saldo_vencido"] = $intSaldoVencido;
				$arrAuxiliar["fecha_vencimiento"] = $strFecha;
				$arrAuxiliar["dias_vencidos"] = $intDiasVencidos;
			    $arrAuxiliar["dias_credito"] = $intCreditoDias;
				$arrAuxiliar["estado_credito"] = $strEstadoCredito;
                //Agregar datos al array
                array_push($arrProveedores, $arrAuxiliar);
			}

			//Agregar datos al array
		    $arrDatos['rows'] = $arrProveedores;
		    $arrDatos['acumulado_saldo'] = $intAcumSaldo;
			$arrDatos['acumulado_saldo_vencido'] = $intAcumSaldoVencido;

		}//Cierre de verificación de ordenes de compra con adeudo

		//Si existe id del proveedor, significa que se van a obtener los datos para el reporte individual
		if($intProveedorBusqID > 0)
		{

			//Inicializar variable
			$intAcumAnticipos = 0;

			//Seleccionar el total de anticipos del proveedor
			$otdAnticipos = $this->pagos->buscar_anticipo_ordenes_compra_adeudos('reporte',
																				 $dteFechaCorte, 
																				 $intProveedorBusqID,
																				 $intMonedaID);
			//Si hay información
			if($otdAnticipos)
			{
				//Recorremos el arreglo 
				foreach ($otdAnticipos as $arrAnt)
				{
					//Asignar el total de anticipos
					$intAcumAnticipos += $arrAnt->importe;
				
				}

			    //Agregar datos al array
				$arrDatos['acumulado_anticipos'] = $intAcumAnticipos;
			}
		}

		
		//Regresar array con los saldos vencidos de los proveedores
		return $arrDatos;
	}

}