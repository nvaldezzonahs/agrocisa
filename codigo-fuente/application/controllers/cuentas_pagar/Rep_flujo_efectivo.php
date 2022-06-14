<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_flujo_efectivo extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de pagos de clientes
		$this->load->model('caja/pagos_model', 'pagos_clientes');
		//Cargamos el modelo de pagos a proveedores
		$this->load->model('cuentas_pagar/pagos_proveedores_model', 'pagos_proveedores');
		//Cargamos el modelo de monedas
		$this->load->model('contabilidad/sat_monedas_model', 'monedas');
		//Cargamos el modelo de cuentas bancarias
		$this->load->model('cuentas_pagar/cuentas_bancarias_model', 'cuentas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('cuentas_pagar/rep_flujo_efectivo', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el flujo de efectivo (vencimientos)
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');

		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal != '')
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado de proveedores con saldo vencido y saldo por vencer
			$this->get_reporte_detalles($dteFechaInicial, $dteFechaFinal);
		}
		else
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado general de saldos vencidos
			$this->get_reporte_general($dteFechaInicial);
		}
	}


	//Método para generar un reporte PDF con el listado de proveedores con saldo vencido y saldo por vencer
    public function get_reporte_detalles($dteFechaInicial, $dteFechaFinal)
    {
    	
	    //Asignar los días de diferencia entre las dos fechas
		$intDiasDiferencia = $this->diferencia_dias_fechas($dteFechaInicial, $dteFechaFinal);
		 //Array que se utiliza para asignar el saldo por vencer por día
        $arrVencimientoDia = array();
        //Array que se utiliza para asignar el  acumulado del saldo por vencer por día
        $arrAcumVencimientoDia = array();
        //Array que se utiliza para asignar los días (fechas) correspondientes al rango de fechas
        $arrDias = array();
        //Array que se utiliza para agregar los datos (saldo vencido y saldo por vencer) de los proveedores
	    $arrProveedores = array();
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas =  $this->get_fecha_formato_letra($dteFechaInicial, 'C'). ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		//Se crea una instancia de la clase PDF
        $pdf = new PDF('L','mm','letter');//orientación horizontal
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		
	    //Crea los titulos de la cabecera
		$pdf->arrCabecera = array('PROVEEDOR', 'VENCIDO', 'POR VENCER');
		//Establece el ancho de las columnas de cabecera
        $pdf->arrAnchura = array(60, 20, 20);
		//Variable que se utiliza para asignar el tamaño de los encabezados de las columnas fijas 
	    $intTamColFijas = 100;
	    //Variable que se utiliza para asignar el tamaño restante de la hoja doble cara
	    $intTamHDC = (262 - $intTamColFijas);
	     //Variable que se utiliza para asignar el tamaño de las columnas  detalles del movimiento de nómina
	    $intTamColDia =  ($intTamHDC / $intDiasDiferencia);
        //Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'R', 'R');

		//Datos del primer título del reporte 
		$strTituloLinea1 = 'FLUJO DE EFECTIVO EN ';
		$strTituloRangoFechas = 'ENTRE '.$strTituloRangoFechas;
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  $strTituloLinea1.' '.$strTituloRangoFechas;

		//Establecer el color de línea
	    $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Hacer recorrido para agregar a la cabecera los días del mes
        for ($intContDias = 1; $intContDias <= $intDiasDiferencia;  $intContDias++)
        {
        	 //Si el contador es mayor que 1 (no considerar el primer día (corresponde a la fecha inicial))
        	 if($intContDias > 1)
        	 {
        	 	 //Sumar un día a la fecha actual
			 	 $dteFechaCol = $this->sumar_dias_fecha(1, $dteFechaActual);
        	 }
        	 else
        	 {
        	 	//Asignar fecha inicial
        	 	$dteFechaCol =  $dteFechaInicial;
        	 }
        	 
        	//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
        	$strFechaCol = $this->get_fecha_formato_letra($dteFechaCol, 'MDIAC');

        	//Agregar datos al array
            $pdf->arrCabecera[] = $strFechaCol;
            $pdf->arrAnchura[] =  $intTamColDia;
            $pdf->arrAlineacion[] = 'R';
            $arrDias[] = $dteFechaCol;

            //Inicializar el saldo vencido del día
			$arrVencimientoDia[$dteFechaCol] = 0; 
			//Inicializar el acumulado de vencimientos del día
			$arrAcumVencimientoDia[$dteFechaCol] = 0;
			
            //Asigar fecha actual para incrementarle un día (obtener la siguiente fecha)
            $dteFechaActual =  $dteFechaCol;
        }

        //Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
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
				//Inicializar array
		        $arrProveedores = array();

				//Asignar objeto con el saldo vencido y el saldo por vencer de los proveedores en el rango de fechas
				$otdSaldoProveedores = $this->get_saldo_proveedores_detalles($dteFechaInicial, 
																			 $dteFechaFinal, 
																			 $intMonedaID, 
																			 $arrDias, 
																			 $arrVencimientoDia, 
																			 $arrAcumVencimientoDia);
				//Asignar array con los datos de los proveedores
				$arrProveedores = $otdSaldoProveedores['rows'];
				//Si hay información de saldos de proveedores
			    if($arrProveedores)
				{

					//Concatenar moneda para el primer encabezado del reporte
					$strTituloMoneda = $strTituloLinea1.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$pdf->strLinea1 = $strTituloMoneda.' '.$strTituloRangoFechas;

				    //Agregar pagina
					$pdf->AddPage();

				    //Recorremos el arreglo 
					foreach ($arrProveedores as $arrSal)
					{
					   //Agregar al array los datos del proveedor
            		   $arrDatos = array(utf8_decode($arrSal['proveedor']), 
            		   					'$'.number_format($arrSal['saldo_vencido'],2), 
            		   					'$'.number_format($arrSal['saldo_vencer'],2));


            		    //Si hay información de los días correspondientes al rango de fechas
					    if ($arrDias) 
				        { 	
				            //Recorremos el arreglo 
				        	foreach ($arrDias as $dteDia) 
				        	{
				        		//Agregar al array el saldo por vencer en el día
						        $arrDatos[] = '$'.number_format($arrSal[$dteDia],2);
				        	}

				        }//Cierre de verificación de días


						//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				   		$pdf->Row($arrDatos, $pdf->arrAlineacion, 'ClippedCell');
					}


				    //Agregar al array los acumulados de saldos vencidos y saldos por vencer
					$arrTotales = array('TOTALES:', 
            		   					'$'.number_format($otdSaldoProveedores['acumulado_saldo_vencido'],2), 
            		   					'$'.number_format($otdSaldoProveedores['acumulado_saldo_vencer'],2));

					//Si hay información de los días correspondientes al rango de fechas
				    if ($arrDias) 
			        { 	
			            //Recorremos el arreglo 
			        	foreach ($arrDias as $dteDia) 
			        	{
			        		//Agregar al array el acumulado del saldo por vencer en el día
					        $arrTotales[] = '$'.number_format($otdSaldoProveedores['arrAcumVencimientoDia'][$dteDia],2);
			        	}

			        }//Cierre de verificación de días

					$pdf->Line(10, ($pdf->GetY() + 0.4), 272, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
					//Escribir totales
					//Cambiar el volumen de la fuente a bold
				    $pdf->strTipoLetraTabla = 'Negrita';
				    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				   	$pdf->Row($arrTotales, $pdf->arrAlineacion, 'ClippedCell');
					//Cambiar el volumen de la fuente a normal
				    $pdf->strTipoLetraTabla = '';

				}//Cierre de verificación de saldos de proveedores

			}

		}//Cierre de verificación de monedas

		//Ejecutar la salida del reporte
        $pdf->Output('flujo_efectivo_detallado.pdf','I'); 
    }

	//Método para generar un reporte PDF con el listado general de saldos vencidos
	public function get_reporte_general($dteFechaCorte) 
	{	
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFecha = 'FECHA DE CORTE: '.$this->get_fecha_formato_letra($dteFechaCorte, 'C');
	    //Sumar 7 días a la fecha de corte
		$dteFechaR7Dias = $this->sumar_dias_fecha(7, $dteFechaCorte);
		//Variable que se utiliza para asignar el acumulado del saldo actual de las cuentas bancarias
		$intAcumSaldoBancos = 0;
		//Variable que se utiliza para asignar el acumulado del saldo vencido (y saldo por vencer en 7 días) de los clientes
		$intAcumSaldoVencidoClientes = 0;
		//Variable que se utiliza para asignar el acumulado del saldo vencido (y saldo por vencer en 7 días) de los proveedores
		$intAcumSaldoVencidoProveedores = 0;
	    //Array que se utiliza para agregar los datos (saldo actual) de las cuentas bancarias
	    $arrCuentasBancarias = array();
	    //Array que se utiliza para agregar los datos (saldo vencido y saldo por vencer en 7 días) de los proveedores
	    $arrProveedores = array();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');

		//Datos del primer título del reporte 
		$strTituloLinea1 = 'FLUJO DE EFECTIVO EN  ';
	
		//Crea los titulos de la cabecera
		$arrCabecera = array('CONCEPTO', 'SALDO');
		//Establece el ancho de las columnas de cabecera
		$arrAnchura = array(100, 30);
		//Establece la alineación de las celdas de la tabla
		$arrAlineacion = array('L', 'R');
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R');
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAnchura);
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
	    $pdf->strLinea1 = $strTituloLinea1.'     '.$strTituloFecha;
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
				$intAcumSaldoBancos = 0;
				$intAcumSaldoVencidoClientes = 0;
				$intAcumSaldoVencidoProveedores = 0;
		        $arrCuentasBancarias = array();
		        $arrProveedores = array();

		     
	        	//Asignar objeto con el saldo actual de las cuentas bancarias
				$otdSaldoCuentasBancarias = $this->get_saldo_cuentas_bancarias($dteFechaCorte, $intMonedaID);
				//Asignar array con los datos de las cuentas bancarias
				$arrCuentasBancarias = $otdSaldoCuentasBancarias['rows'];
				//Asignar el acumulado del saldo actual de las cuentas bancarias
				$intAcumSaldoBancos =  $otdSaldoCuentasBancarias['acumulado_saldo'];
				
				//Asignar el acumulado del saldo vencido y saldo por vencer (en 7 días) de los clientes
				$intAcumSaldoVencidoClientes = $this->get_saldo_clientes($dteFechaCorte, $intMonedaID);

				//Asignar objeto con el saldo vencido y saldo por vencer (en 7 días) de los proveedores
				$otdSaldoProveedores = $this->get_saldo_proveedores($dteFechaCorte, $intMonedaID);
				//Asignar array con los datos de los proveedores
				$arrProveedores = $otdSaldoProveedores['rows'];
				//Asignar el acumulado del saldo vencido y saldo por vencer (en 7 días) de los proveedores
				$intAcumSaldoVencidoProveedores =  $otdSaldoProveedores['acumulado_saldo_vencido'];

				//Si hay información de saldos bancarios, saldos de clientes y/o saldos de proveedores
				if($arrCuentasBancarias OR $intAcumSaldoVencidoClientes > 0 OR 
				   $intAcumSaldoVencidoProveedores > 0)
				{

					 //Concatenar moneda para el primer encabezado del reporte
					$strTituloMoneda =  $strTituloLinea1.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$pdf->strLinea1 = $strTituloMoneda.'     '.$strTituloFecha;

					//Agregar pagina
					$pdf->AddPage();

				    //Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
	      			//Acumulado del saldo bancario
					$pdf->Row(array('BANCOS', '$'.number_format($intAcumSaldoBancos, 2)), 
					    		    $arrAlineacion, 'ClippedCell');
					//Cambiar el volumen de la fuente a normal
	      			$pdf->strTipoLetraTabla = '';

				    //Si hay información de saldos bancarios
				    if($arrCuentasBancarias)
					{
					    //Recorremos el arreglo 
						foreach ($arrCuentasBancarias as $arrSal)
						{
							//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					   		$pdf->Row(array(utf8_decode($arrSal['cuenta']), 
					   						'$'.number_format($arrSal['saldo'],2)), 
					    				    $arrAlineacion, 'ClippedCell');
						}

					}//Cierre de verificación de saldos bancarios

					//Calcular el total de ingresos
				    $intTotalIngresos = $intAcumSaldoBancos + $intAcumSaldoVencidoClientes;

				 
				    $pdf->Ln(5); //Deja un salto de línea
				    //Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
	      			//Total de ingresos
					$pdf->Row(array('INGRESOS', '$'.number_format($intTotalIngresos, 2)), 
					    		    $arrAlineacion, 'ClippedCell');
					//Cambiar el volumen de la fuente a normal
	      			$pdf->strTipoLetraTabla = '';

					//Si existe saldo vencido y saldo por vencer (en 7 días) de los clientes
					if($intAcumSaldoVencidoClientes > 0)
					{
						//Acumulado del saldo por vencer de los clientes
					    $pdf->Row(array(utf8_decode('RECUPERACIÓN DE CARTERA'), 
					    				'$'.number_format($intAcumSaldoVencidoClientes, 2)), 
					    				$arrAlineacion, 'ClippedCell');


					}//Cierre de verificación de saldos de clientes
					
					
					//Si existe saldo vencido y saldo por vencer (en 7 días) de los proveedores
					if($intAcumSaldoVencidoProveedores > 0)
					{
						$pdf->Ln(5); //Deja un salto de línea
						//Cambiar el volumen de la fuente a bold
	      				$pdf->strTipoLetraTabla = 'Negrita';
						//Proveedores
						$pdf->Row(array('PROVEEDORES'), $arrAlineacion, 'ClippedCell');
						//Cambiar el volumen de la fuente a normal
	      				$pdf->strTipoLetraTabla = '';

						//Si hay información de saldos de proveedores
					    if($arrProveedores)
						{
						    //Recorremos el arreglo 
							foreach ($arrProveedores as $arrSal)
							{
								//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						   		$pdf->Row(array(utf8_decode($arrSal['proveedor']), 
						   						'$'.number_format($arrSal['saldo_vencido'],2)), 
						    				    $arrAlineacion, 'ClippedCell');
							}

						}//Cierre de verificación de saldos de proveedores

						$pdf->Line(10, ($pdf->GetY() + 0.4), 140, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información del total 

					    //Cambiar el volumen de la fuente a bold
		      			$pdf->strTipoLetraTabla = 'Negrita';
		      			//Acumulado del saldo vencido y saldo por vencer (en 7 días)
						$pdf->Row(array('TOTAL:', '$'.number_format($intAcumSaldoVencidoProveedores, 2)), 
						    		    $arrAlineacionTotales, 'ClippedCell');
						//Cambiar el volumen de la fuente a normal
		      			$pdf->strTipoLetraTabla = '';

					}//Cierre de verificación de saldos de proveedores
	      		
					//Calcular el diferencia de saldos 
				    $intDiferencia = $intTotalIngresos - $intAcumSaldoVencidoProveedores;

				    $pdf->Ln(2); //Deja un salto de línea
				    //Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
	      			//Diferencia de saldos
					$pdf->Row(array('DIFERENCIA:', '$'.number_format($intDiferencia, 2)), 
					    		    $arrAlineacionTotales, 'ClippedCell');
					//Cambiar el volumen de la fuente a normal
	      			$pdf->strTipoLetraTabla = '';

				}//Cierre de verificación de información de saldos bancarios, saldos de clientes y/o saldos de proveedores

			}

		}//Cierre de verificación de monedas

		//Ejecutar la salida del reporte
        $pdf->Output('flujo_efectivo_general.pdf','I'); 
	}

	

	/*Método para generar un archivo XLS el flujo de efectivo (vencimientos)
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');

		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal != '')
		{
			//Hacer un llamado a la función para generar un archivo XLS con el listado de proveedores con saldo vencido y saldo por vencer
			$this->get_xls_detalles($dteFechaInicial, $dteFechaFinal);
		}
		else
		{
			//Hacer un llamado a la función para generar un archivo XLS con el listado general de saldos vencidos
			$this->get_xls_general($dteFechaInicial);
		}
	}


	//Método para generar un archivo XLS con el listado de proveedores con saldo vencido y saldo por vencer
    public function get_xls_detalles($dteFechaInicial, $dteFechaFinal)
    {
    	//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Variable que se utiliza para asignar el número de columna donde se empezara a escribir la información del proveedor
	    $intIndPrimerCol = 1;
        //Variable que se utiliza para asignar el número de columna donde se empezaran a escribir los días
	    $intIndColDias = 4;
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
    	//Asignar los días de diferencia entre las dos fechas
		$intDiasDiferencia = $this->diferencia_dias_fechas($dteFechaInicial, $dteFechaFinal);
		//Array que se utiliza para asignar el saldo por vencer por día
        $arrVencimientoDia = array();
        //Array que se utiliza para asignar el  acumulado del saldo por vencer por día
        $arrAcumVencimientoDia = array();
        //Array que se utiliza para asignar los días (fechas) correspondientes al rango de fechas
        $arrDias = array();
        //Array que se utiliza para asignar los días (fechas con formato de letra)  correspondientes al rango de fechas
        $arrDiasFormato = array();
        //Array que se utiliza para agregar los datos (saldo vencido y saldo por vencer) de los proveedores
	    $arrProveedores = array();
	    //Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última moneda)
		$intNumMaxRegistros = 0;

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = $this->get_fecha_formato_letra($dteFechaInicial, 'C'). ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

		//Concatenar datos para el primer encabezado del reporte
		$strTituloLinea1 = 'FLUJO DE EFECTIVO EN ';
		$strTituloRangoFechas = 'ENTRE '.$strTituloRangoFechas;

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

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		//Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

		//Hacer recorrido para agregar a la cabecera los días del mes
        for ($intContDias = 1; $intContDias <= $intDiasDiferencia;  $intContDias++)
        {
        	 //Si el contador es mayor que 1 (no considerar el primer día (corresponde a la fecha inicial))
        	 if($intContDias > 1)
        	 {
        	 	 //Sumar un día a la fecha actual
			 	 $dteFechaCol = $this->sumar_dias_fecha(1, $dteFechaActual);
        	 }
        	 else
        	 {
        	 	//Asignar fecha inicial
        	 	$dteFechaCol =  $dteFechaInicial;
        	 }
        	 
        	//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
        	$strFechaCol = $this->get_fecha_formato_letra($dteFechaCol, 'MDIAC');
        	
        	//Inicializar el saldo vencido del día
			$arrVencimientoDia[$dteFechaCol] = 0; 
			//Inicializar el acumulado de vencimientos del día
			$arrAcumVencimientoDia[$dteFechaCol] = 0;
			//Agregar fecha al array
			$arrDias[] = $dteFechaCol;
			//Agregar fecha con formato de letra al array
			$arrDiasFormato[] = $strFechaCol;

            //Asigar fecha actual para incrementarle un día (obtener la siguiente fecha)
            $dteFechaActual =  $dteFechaCol;
        }

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
				$strNombreHoja = 'flujo '.$arrMon->codigo;
				//Inicializar array
		        $arrProveedores = array();
		   

		        //Asignar objeto con el saldo vencido y el saldo por vencer de los proveedores en el rango de fechas
				$otdSaldoProveedores = $this->get_saldo_proveedores_detalles($dteFechaInicial, 
																			 $dteFechaFinal, 
																			 $intMonedaID, 
																			 $arrDias, 
																			 $arrVencimientoDia, 
																			 $arrAcumVencimientoDia);

				//Asignar array con los datos de los proveedores
				$arrProveedores = $otdSaldoProveedores['rows'];

				//Concatenar datos para el primer encabezado del reporte
				$strEncabezado = $strTituloLinea1.'  '.$strTituloRangoFechas;

				//Se agrega el título del archivo
				$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);
				
				//Se agregan las columnas de cabecera
			    $objExcel->getActiveSheet()
			    		->setCellValue('A'.$intPosEncabezados, 'PROVEEDOR')
			    		->setCellValue('B'.$intPosEncabezados, 'VENCIDO')
			    		->setCellValue('C'.$intPosEncabezados, 'POR VENCER');

			    $intIndColE = $intIndColDias;//Empezar en la columna 4-D (Encabezados de los días)

			    //Si hay información de los días correspondientes al rango de fechas
			    if ($arrDiasFormato) 
		        { 	//Recorremos el arreglo 
		        	foreach ($arrDiasFormato as $dteDia) 
		        	{
		        		//Se agrega en el encabezado del archivo los días correspondientes al rango de fechas
    	  		 		$objExcel->getActiveSheet()
	               			     ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados, $dteDia);

	               	
	               		//Incrementar indice de la columna
		  			    $intIndColE++;    
		        	}

		        }//Cierre de verificación de días


		        //Combinar las siguientes celdas
	       		$objExcel->getActiveSheet()->mergeCells('A8:D8');

	       		//Cambiar estilo de las siguientes celdas
		        $objExcel->getActiveSheet()
		        		 ->getStyle('A8:D8')
		        		 ->applyFromArray($arrStyleBold);

		        //Decrementar indice para no rellenar última columma 
		        $intIndColE--;

		        //Preferencias de color de relleno de celda 
		        $objExcel->getActiveSheet()
		    			 ->getStyle('A10:'.$this->ARR_COLUMNAS[$intIndColE].'10')
		    			 ->getFill()
		    			 ->applyFromArray($arrStyleColumnas);

		   		//Preferencias de color de texto de la celda 
		    	$objExcel->getActiveSheet()
		    			 ->getStyle('A10:'.$this->ARR_COLUMNAS[$intIndColE].'10')
		    			 ->applyFromArray($arrStyleFuenteColumnas);

		    	//Cambiar alineación de las siguientes celdas
				$objExcel->getActiveSheet()
		            	 ->getStyle('A10:'.$this->ARR_COLUMNAS[$intIndColE].'10')
		            	 ->getAlignment()
		            	 ->applyFromArray($arrStyleAlignmentCenter);


				//Si hay información de saldos de proveedores
			    if($arrProveedores)
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
					$strTituloLinea1 = 'FLUJO DE EFECTIVO EN '.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$strEncabezado = $strTituloLinea1.'  '.$strTituloRangoFechas;

					//Se agrega el título del archivo
					$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);


			        //Recorremos el arreglo 
					foreach ($arrProveedores as $arrSal)
					{

						//Agregar al array los datos del proveedor
            		    $arrDatos = array($arrSal['proveedor'], 
            		   					  $arrSal['saldo_vencido'], 
            		   					  $arrSal['saldo_vencer']);

            		    //Si hay información de los días correspondientes al rango de fechas
					    if ($arrDias) 
				        { 	
				            //Recorremos el arreglo 
				        	foreach ($arrDias as $dteDia) 
				        	{
				        		//Agregar al array el saldo por vencer en el día
						        $arrDatos[] = $arrSal[$dteDia];
				        	}

				        }//Cierre de verificación de días


				        $intIndColDet = $intIndPrimerCol;//Empezar en la columna 1-A (información del proveedor) 

				        //Recorremos el arreglo 
			        	foreach ($arrDatos as $arrDet) 
			        	{
			        		//Agregar información del proveedor
	            	   	    $objExcel->getActiveSheet()
				                	 ->setCellValue($this->ARR_COLUMNAS[$intIndColDet].$intFila, 
				                   					$arrDet);

				             //Incrementar indice de la columna
				             $intIndColDet++;
				              
			        	}

						//Incrementar el indice para escribir los datos del siguiente registro
   					    $intFila++;
					}

					//Agregar al array los acumulados de saldos vencidos y saldos por vencer
					$arrTotales = array('TOTALES:', 
            		   					$otdSaldoProveedores['acumulado_saldo_vencido'], 
            		   					$otdSaldoProveedores['acumulado_saldo_vencer']);

					//Si hay información de los días correspondientes al rango de fechas
				    if ($arrDias) 
			        { 	
			            //Recorremos el arreglo 
			        	foreach ($arrDias as $dteDia) 
			        	{
			        		//Agregar al array el acumulado del saldo por vencer en el día
					        $arrTotales[] = $otdSaldoProveedores['arrAcumVencimientoDia'][$dteDia];
			        	}

			        }//Cierre de verificación de días


			        //Escribir totales
			        $intIndColDet = $intIndPrimerCol;  //Empezar en la columna 1-A (información de los totales)
			        //Recorremos el arreglo 
		        	foreach ($arrTotales as $arrDet) 
		        	{
		        		//Agregar información del acumulado de vencimientos
            	   	    $objExcel->getActiveSheet()
			                	 ->setCellValue($this->ARR_COLUMNAS[$intIndColDet].$intFila, 
			                   					$arrDet);

			              //Incrementar indice de la columna
			             $intIndColDet++;
			              
		        	}

		        	//Cambiar contenido de las celdas a formato moneda
		            $objExcel->getActiveSheet()
		            		 ->getStyle('B'.$intFilaInicial.':'.$this->ARR_COLUMNAS[$intIndColDet].$intFila)
		            		 ->getNumberFormat()
		            		 ->setFormatCode('$#,##0.00');

		            //Cambiar alineación de las siguientes celdas
		            $objExcel->getActiveSheet()
				        	 ->getStyle('B'.$intFilaInicial.':'.$this->ARR_COLUMNAS[$intIndColDet].$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

				    $objExcel->getActiveSheet()
				        	 ->getStyle('A'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

				     //Cambiar estilo de la celda
		            $objExcel->getActiveSheet()
		            		 ->getStyle('A'.$intFila.':'.$this->ARR_COLUMNAS[$intIndColDet].$intFila)
		            		 ->applyFromArray($arrStyleBold);

		            //Incrementar contador por cada moneda
					$intContadorHojas++;

					//Si el número de registros (por cada moneda) es mayor que el número máximo de registros 
				    if($intFila > $intNumMaxRegistros)
		            {
		            	//Asignar número de registros
		            	$intNumMaxRegistros = $intFila;
		            }

				}//Cierre de verificación de saldos de proveedores
			}

		}//Cierre de verificación de monedas

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'flujo_efectivo_detallado.xls', 'flujo', $intNumMaxRegistros);
    }


    //Método para generar un archivo XLS con el listado general de saldos vencidos
    public function get_xls_general($dteFechaCorte)
    {
    	//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
		//Sumar 7 días a la fecha de corte
		$dteFechaR7Dias = $this->sumar_dias_fecha(7, $dteFechaCorte);
		//Variable que se utiliza para asignar el acumulado del saldo actual de las cuentas bancarias
		$intAcumSaldoBancos = 0;
		//Variable que se utiliza para asignar el acumulado del saldo vencido (y saldo por vencer en 7 días) de los clientes
		$intAcumSaldoVencidoClientes = 0;
		//Variable que se utiliza para asignar el acumulado del saldo vencido (y saldo por vencer en 7 días) de los proveedores
		$intAcumSaldoVencidoProveedores = 0;
	    //Array que se utiliza para agregar los datos (saldo actual) de las cuentas bancarias
	    $arrCuentasBancarias = array();
	    //Array que se utiliza para agregar los datos (saldo vencido y saldo por vencer en 7 días) de los proveedores
	    $arrProveedores = array();
	    //Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última moneda)
		$intNumMaxRegistros = 0;

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFechaCorte = $this->get_fecha_formato_letra($dteFechaCorte, 'C');

		//Concatenar datos para el primer encabezado del reporte
		$strTituloLinea1 = 'FLUJO DE EFECTIVO EN ';
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

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

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
				$strNombreHoja = 'flujo '.$arrMon->codigo;
				//Inicializar variables
				$intAcumSaldoBancos = 0;
				$intAcumSaldoVencidoClientes = 0;
				$intAcumSaldoVencidoProveedores = 0;
		        $arrCuentasBancarias = array();
		        $arrProveedores = array();
		      

		        //Asignar objeto con el saldo actual de las cuentas bancarias
				$otdSaldoCuentasBancarias = $this->get_saldo_cuentas_bancarias($dteFechaCorte, $intMonedaID);
				//Asignar array con los datos de las cuentas bancarias
				$arrCuentasBancarias = $otdSaldoCuentasBancarias['rows'];
				//Asignar el acumulado del saldo actual de las cuentas bancarias
				$intAcumSaldoBancos =  $otdSaldoCuentasBancarias['acumulado_saldo'];
				
				//Asignar el acumulado del saldo vencido y saldo por vencer (en 7 días) de los clientes
				$intAcumSaldoVencidoClientes = $this->get_saldo_clientes($dteFechaCorte, $intMonedaID);

				//Asignar objeto con el saldo vencido y saldo por vencer (en 7 días) de los proveedores
				$otdSaldoProveedores = $this->get_saldo_proveedores($dteFechaCorte, $intMonedaID);
				//Asignar array con los datos de los proveedores
				$arrProveedores = $otdSaldoProveedores['rows'];
				//Asignar el acumulado del saldo vencido y saldo por vencer (en 7 días) de los proveedores
				$intAcumSaldoVencidoProveedores =  $otdSaldoProveedores['acumulado_saldo_vencido'];

				//Concatenar datos para el primer encabezado del reporte
				$strEncabezado = $strTituloLinea1.'  '.$strTituloFechaCorte;

				//Se agrega el título del archivo
				$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);


				//Si hay información de saldos bancarios, saldos de clientes y/o saldos de proveedores
				if($arrCuentasBancarias OR $intAcumSaldoVencidoClientes > 0 OR 
				   $intAcumSaldoVencidoProveedores > 0)
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
					$strTituloLinea1 = 'FLUJO DE EFECTIVO EN '.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$strEncabezado = $strTituloLinea1.'  '.$strTituloFechaCorte;

			        //Se agrega el título del archivo
					$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);

				    //Se agrega información del acumulado del saldo bancario
			    	$objExcel->getActiveSheet()
			    			 ->setCellValue('A'.$intFila, 'BANCOS')
			    	     	 ->setCellValue('B'.$intFila, $intAcumSaldoBancos);

			        //Cambiar estilo de la celda
		            $objExcel->getActiveSheet()
		            		 ->getStyle('A'.$intFila.':'.'B'.$intFila)
		            		 ->applyFromArray($arrStyleBold);


			    	//Incrementar el indice para escribir los datos del siguiente registro
					$intFila++;		

				    //Si hay información de saldos bancarios
				    if($arrCuentasBancarias)
					{
					    //Recorremos el arreglo 
						foreach ($arrCuentasBancarias as $arrSal)
						{
							//Agregar información de la cuenta bancaria
				            $objExcel->getActiveSheet()
			                         ->setCellValue('A'.$intFila, $arrSal['cuenta'])
			                         ->setCellValue('B'.$intFila, $arrSal['saldo']);

							//Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;
						}

						//Incrementar el indice para escribir los datos del siguiente registro
				    	$intFila+=2;

					}//Cierre de verificación de saldos bancarios

				 	//Calcular el total de ingresos
				    $intTotalIngresos = $intAcumSaldoBancos + $intAcumSaldoVencidoClientes;

				    //Se agrega información del total de ingresos
					$objExcel->getActiveSheet()
		    			 	 ->setCellValue('A'.$intFila, 'INGRESOS')
		    			 	 ->setCellValue('B'.$intFila, $intTotalIngresos);

		    		//Cambiar estilo de la celda
		            $objExcel->getActiveSheet()
		            		 ->getStyle('A'.$intFila.':'.'B'.$intFila)
		            		 ->applyFromArray($arrStyleBold);

		           	//Incrementar el indice para escribir los datos del siguiente registro
					$intFila++;
					
					//Si existe saldo vencido y saldo por vencer (en 7 días) de los clientes
					if($intAcumSaldoVencidoClientes > 0)
					{
						//Se agrega información del acumulado del saldo por vencer de los clientes
						$objExcel->getActiveSheet()
		    			 		 ->setCellValue('A'.$intFila, 'RECUPERACIÓN DE CARTERA')
		    			 		 ->setCellValue('B'.$intFila, $intAcumSaldoVencidoClientes);

		    			//Incrementar el indice para escribir los datos del siguiente registro
						$intFila+=2;

					}//Cierre de verificación de saldos de clientes


					//Si existe saldo vencido y saldo por vencer (en 7 días) de los proveedores
					if($intAcumSaldoVencidoProveedores > 0)
					{

						//Se agrega información de los proveedores
						$objExcel->getActiveSheet()
			    			 	 ->setCellValue('A'.$intFila, 'PROVEEDORES:');

			    		//Cambiar estilo de la celda
			            $objExcel->getActiveSheet()
			            		 ->getStyle('A'.$intFila)
			            		 ->applyFromArray($arrStyleBold);

			            //Si hay información de saldos de proveedores
					    if($arrProveedores)
						{
						    //Recorremos el arreglo 
							foreach ($arrProveedores as $arrSal)
							{
						   		//Agregar información del proveedor
						   		$objExcel->getActiveSheet()
					                     ->setCellValue('A'.$intFila, $arrSal['proveedor'])
					                     ->setCellValue('B'.$intFila, $arrSal['saldo_vencido']);

					            //Incrementar el indice para escribir los datos del siguiente registro
								$intFila++;

							}

						}//Cierre de verificación de saldos de proveedores

					    //Agregar información del acumulado del saldo vencido y saldo por vencer (en 7 días)
						$objExcel->getActiveSheet()
			    			 	 ->setCellValue('A'.$intFila, 'TOTAL:')
			    			 	 ->setCellValue('B'.$intFila, $intAcumSaldoVencidoProveedores);

			    		//Cambiar estilo de la celda
			            $objExcel->getActiveSheet()
			            		 ->getStyle('A'.$intFila.':'.'B'.$intFila)
			            		 ->applyFromArray($arrStyleBold);

			            //Cambiar alineación de las siguientes celdas
		                $objExcel->getActiveSheet()
				        	     ->getStyle('A'.$intFila)
				        	     ->getAlignment()
				        	     ->applyFromArray($arrStyleAlignmentRight);


					}//Cierre de verificación de saldos de proveedores

					//Calcular el diferencia de saldos 
				    $intDiferencia = $intTotalIngresos - $intAcumSaldoVencidoProveedores;
					//Incrementar el indice para escribir los datos del siguiente registro
				    $intFila+=2;

				    //Agregar información de la diferencia de saldos
				    $objExcel->getActiveSheet()
			                         ->setCellValue('A'.$intFila,'DIFERENCIA:')
			                         ->setCellValue('B'.$intFila, $intDiferencia);


			        //Cambiar contenido de las celdas a formato moneda
		            $objExcel->getActiveSheet()
		            		 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
		            		 ->getNumberFormat()
		            		 ->setFormatCode('$#,##0.00');

		            //Cambiar alineación de las siguientes celdas
	                $objExcel->getActiveSheet()
			        	     ->getStyle('A'.$intFila)
			        	     ->getAlignment()
			        	     ->applyFromArray($arrStyleAlignmentRight);

		            $objExcel->getActiveSheet()
				        	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);


				    //Cambiar estilo de la celda
		            $objExcel->getActiveSheet()
		            		 ->getStyle('A'.$intFila.':'.'B'.$intFila)
		            		 ->applyFromArray($arrStyleBold);

				 
					//Incrementar contador por cada moneda
					$intContadorHojas++;

					//Si el número de registros (por cada moneda) es mayor que el número máximo de registros 
				    if($intFila > $intNumMaxRegistros)
		            {
		            	//Asignar número de registros
		            	$intNumMaxRegistros = $intFila;
		            }

				}//Cierre de verificación de información de saldos bancarios, saldos de clientes y/o saldos de proveedores

			}

		}//Cierre de verificación de monedas

        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'flujo_efectivo_general.xls', 'flujo', $intNumMaxRegistros);
    }


    //Función que se utiliza para regresar el saldo actual de las cuentas bancarias
    public function get_saldo_cuentas_bancarias($dteFechaCorte, $intMonedaID)
	{
		//Array que se utiliza para enviar datos
		$arrDatos = array('rows' => NULL, 'acumulado_saldo' => '0.00');
		//Variable que se utiliza para asignar el acumulado del saldo actual de las cuentas bancarias
		$intAcumSaldoBancos = 0;
		//Array que se utiliza para agregar el saldo actual de las cuentas bancarias
        $arrCuentasBancarias = array();
        //Array que se utiliza para agregar los datos de una cuenta bancaria
        $arrAuxiliar = array();

		//Seleccionar las cuentas bancarias que coincidan con el id de la moneda
		$otdCuentasBancarias = $this->cuentas->buscar(NULL, NULL, NULL, $intMonedaID);

		//Si hay información de las cuentas bancarias
		if($otdCuentasBancarias)
		{
			//Recorremos el arreglo 
			foreach ($otdCuentasBancarias as $arrCta)
			{
				//Seleccionar el saldo actual de la cuenta bancaria (primer posición del arreglo)
				$otdSaldoActual = $this->cuentas->buscar_saldo_cuenta_bancaria($arrCta->cuenta_bancaria_id, 
																			   $dteFechaCorte, 
																			   NULL,
																			   'saldo_actual')[0];
				//Asignar el saldo actual
				$intSaldo = $otdSaldoActual->saldo;

				//Concatenar datos de la cuenta bancaria
				$strCuentaBancaria = $arrCta->cuenta.' - '.$arrCta->descripcion;

				//Definir valores del array auxiliar de información (para cada cuenta bancaria)
				$arrAuxiliar["cuenta"] = $strCuentaBancaria;
				$arrAuxiliar["saldo"] = $intSaldo;
                //Agregar datos al array
                array_push($arrCuentasBancarias, $arrAuxiliar); 

                //Incrementar acumulado
				$intAcumSaldoBancos += $intSaldo;
			}

			//Agregar datos al array
			$arrDatos['rows'] = $arrCuentasBancarias;
			$arrDatos['acumulado_saldo'] = $intAcumSaldoBancos;

		}//Cierre de verificación de cuentas bancarias

		//Regresar array con los saldos de las cuentas bancarias
		return $arrDatos;
	}

	//Función que se utiliza para regresar el acumulado del saldo vencido y saldo por vencer (en 7 días) de los clientes
	public function get_saldo_clientes($dteFechaCorte, $intMonedaID)
	{
		//Variable que se utiliza pra asignar el id actual del cliente
	    $intClienteIDActual = 0;
	    //Sumar 7 días a la fecha de corte
		$dteFechaR7Dias = $this->sumar_dias_fecha(7, $dteFechaCorte);
		//Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo por vencer en 7 días
	    $intAcumSaldo7Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido (y por vencer en 7 días) de los clientes
		$intAcumSaldoVencidoClientes = 0;

	    //Seleccionar los datos de las facturas (con saldo) que coinciden con el parámetro enviado
		$otdResultado = $this->pagos_clientes->buscar_facturas_importes('reporte', $dteFechaCorte, 
																		NULL, NULL, $intMonedaID, 
																		NULL,  NULL, NULL, 
										    						    NULL, NULL, NULL, NULL, 'saldo');
		//Si hay información de las facturas
		if($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Asignar el saldo de la factura
				$intSaldoFactura = $arrCol->saldo;

				//Si la factura no se encuentra pagada
				//if (($intSaldoFactura >= 1) OR ($intSaldoFactura <= -1))  //Validación anterior
				if($intSaldoFactura > 0)
				{
					//Asignar fecha de vencimiento de la factura
                    $dteFechaVencimiento = $arrCol->fecha_vencimiento;
					
					//Si el cliente actual es diferente al anterior
					if ($intClienteIDActual != $arrCol->prospecto_id)
					{
						
						//Asignar valores del cliente
						$intClienteIDActual = $arrCol->prospecto_id;
                        //Limpiar las siguientes variables (por cada cliente recorrido)
                        $intSaldoVencido = 0;
                        $intSaldo7Dias = 0;

                        //Si la fecha de vencimiento es menor que la fecha de corte
                        if ($dteFechaVencimiento < $dteFechaCorte)
                        {
                        	//Asignar saldo de la factura
                            $intSaldoVencido = $intSaldoFactura;
                            //Incrementar acumulado del saldo vencido
                            $intAcumSaldoVencido += $intSaldoFactura;
                        }
                        else if (($dteFechaVencimiento >= $dteFechaCorte) && 
                        		 ($dteFechaVencimiento <= $dteFechaR7Dias))
                        {
                        	//Incrementar el saldo por vencer en 7 días
                            $intSaldo7Dias += $intSaldoFactura;
                        	//Incrementar acumulado del saldo por vencer en 7 días
                        	$intAcumSaldo7Dias += $intSaldoFactura;
                   		} 

					}
					else
					{

                        //Si la fecha de vencimiento es menor que la fecha de corte
                        if ($dteFechaVencimiento < $dteFechaCorte)
                        {
                        	//Incrementar el saldo vencido
                            $intSaldoVencido += $intSaldoFactura;
                            //Incrementar acumulado del saldo vencido
                            $intAcumSaldoVencido += $intSaldoFactura;
                        }
                        else if (($dteFechaVencimiento >= $dteFechaCorte) && 
                        		 ($dteFechaVencimiento <= $dteFechaR7Dias))
                        {
                        	//Incrementar el saldo por vencer en 7 días
                            $intSaldo7Dias += $intSaldoFactura;
                        	//Incrementar acumulado del saldo por vencer en 7 días
                        	$intAcumSaldo7Dias += $intSaldoFactura;
                   		}
	                    
					}

				}//Cierre de verificación del saldo

			}


		    //Calcular el saldo vencido de los clientes
		    $intAcumSaldoVencidoClientes = $intAcumSaldoVencido + $intAcumSaldo7Dias;

		}//Cierre de verificación de facturas con adeudo

		//Regresar el saldo vencido de los clientes
		return $intAcumSaldoVencidoClientes;
	}

	//Función que se utiliza para regresar proveedores con saldo vencido y saldo por vencer (en 7 días)
	public function get_saldo_proveedores($dteFechaCorte, $intMonedaID)
	{
		//Array que se utiliza para enviar datos
		$arrDatos = array('rows' => NULL, 'acumulado_saldo_vencido' => '0.00');
		//Variable que se utiliza pra asignar el id actual del proveedor
	    $intProveedorIDActual = 0;
	    //Sumar 7 días a la fecha de corte
		$dteFechaR7Dias = $this->sumar_dias_fecha(7, $dteFechaCorte);
		//Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo por vencer en 7 días
	    $intAcumSaldo7Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido (y por vencer en 7 días) de los proveedores
		$intAcumSaldoVencidoProveedores = 0;
		//Variable que se utiliza para asignar el acumulado de anticipos
	    $intAcumAnticipos = 0;
	    //Array que se utiliza para agregar el saldo vencido y saldo por vencer (en 7 días) de los proveedores
        $arrProveedores = array();
        //Array que se utiliza para agregar los datos de un proveedor
        $arrAuxiliar = array();

		//Seleccionar los datos de las ordenes de compra que coinciden con el parámetro enviado
		$otdResultado = $this->pagos_proveedores->buscar_ordenes_compra_importes('reporte', $dteFechaCorte, 
																				  NULL, $intMonedaID);

	

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

					//Asignar fecha de vencimiento de la orden de compra
                    $dteFechaVencimiento = $arrCol->fecha_vencimiento;

					//Si el proveedor actual es diferente al anterior
					if ($intProveedorIDActual != $arrCol->proveedor_id)
					{
						//Si existe id del proveedor actual
						if ($intProveedorIDActual > 0)
						{

							//Seleccionar el total de anticipos del proveedor
							$otdAnticipos = $this->pagos_proveedores->buscar_anticipo_ordenes_compra_adeudos('reporte',
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


	                            //Si existe saldo vencido
	                            if($intSaldoVencido > 0)
	                            {
	                            	//Decrementar acumulados
	                            	$intSaldoVencido -= $intAcumAnticipos;
	                            	$intAcumSaldoVencido -= $intAcumAnticipos;
	                            }
	                            else if($intSaldo7Dias > 0) //Si existe saldo por vencer en 7 días
                            	{
                            		//Decrementar acumulados
                            		$intSaldo7Dias -= $intAcumAnticipos;
                            		$intAcumSaldo7Dias -= $intAcumAnticipos;
                            	}
                            	
							}

							//Incrementar el saldo vencido del proveedor
			                $intSaldoVencido +=  $intSaldo7Dias;

			                //Si existe saldo vencido
			                if($intSaldoVencido > 0)
			                {
			                	//Definir valores del array auxiliar de información (para cada proveedor)
								$arrAuxiliar["proveedor"] = $strProveedor;
								$arrAuxiliar["saldo_vencido"] = $intSaldoVencido;
				                //Agregar datos al array
				                array_push($arrProveedores, $arrAuxiliar); 

			                }//Cierre de verificación de saldo
						}

						//Asignar valores del proveedor
						$intProveedorIDActual = $arrCol->proveedor_id;
                        $strProveedor = $arrCol->codigo.' '.$arrCol->razon_social;
                        //Limpiar las siguientes variables (por cada proveedor recorrido)
                        $intSaldoVencido = 0;
                        $intSaldo7Dias = 0;
                        $intAcumAnticipos =  0;
                        
                        //Si la fecha de vencimiento es menor que la fecha de corte
                        if ($dteFechaVencimiento < $dteFechaCorte)
                        {
                        	//Asignar saldo de la orden de compra
                            $intSaldoVencido = $intSaldoOrdenCompra;
                            //Incrementar acumulado del saldo vencido
                            $intAcumSaldoVencido += $intSaldoOrdenCompra;
                        }
                        else if (($dteFechaVencimiento >= $dteFechaCorte) && 
                        		 ($dteFechaVencimiento <= $dteFechaR7Dias))
                        {
                        	//Incrementar el saldo por vencer en 7 días
                            $intSaldo7Dias += $intSaldoOrdenCompra;
                        	//Incrementar acumulado del saldo por vencer en 7 días
                        	$intAcumSaldo7Dias += $intSaldoOrdenCompra;
                   		}
	                    

					}
					else
					{

                        //Si la fecha de vencimiento es menor que la fecha de corte
                        if ($dteFechaVencimiento < $dteFechaCorte)
                        {
                        	//Incrementar el saldo vencido
                            $intSaldoVencido += $intSaldoOrdenCompra;
                            //Incrementar acumulado del saldo vencido
                            $intAcumSaldoVencido += $intSaldoOrdenCompra;
                        }
                        else if (($dteFechaVencimiento >= $dteFechaCorte) && 
                        		 ($dteFechaVencimiento <= $dteFechaR7Dias))
                        {
                        	//Incrementar el saldo por vencer en 7 días
                            $intSaldo7Dias += $intSaldoOrdenCompra;
                        	//Incrementar acumulado del saldo por vencer en 7 días
                        	$intAcumSaldo7Dias += $intSaldoOrdenCompra;
                   		}
	                    
					}

				}//Cierre de verificación del saldo
				

			}

			//Escribir los acumulados del último proveedor
			if ($intProveedorIDActual > 0)
			{
				//Seleccionar el total de anticipos del proveedor
				$otdAnticipos = $this->pagos_proveedores->buscar_anticipo_ordenes_compra_adeudos('reporte',
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

               		//Si existe saldo vencido
                    if($intSaldoVencido > 0)
                    {
                    	//Decrementar acumulados
                    	$intSaldoVencido -= $intAcumAnticipos;
                    	$intAcumSaldoVencido -= $intAcumAnticipos;
                	}
                	else if($intSaldo7Dias > 0)//Si existe saldo por vencer en 7 días
                	{
                		//Decrementar acumulados
                		$intSaldo7Dias -= $intAcumAnticipos;
                		$intAcumSaldo7Dias -= $intAcumAnticipos;
                	}
                	
				}

				//Incrementar el saldo vencido del proveedor
                $intSaldoVencido +=  $intSaldo7Dias;

                //Si existe saldo vencido
                if($intSaldoVencido > 0)
                {  	
					//Definir valores del array auxiliar de información (para cada proveedor)
					$arrAuxiliar["proveedor"] = $strProveedor;
					$arrAuxiliar["saldo_vencido"] = $intSaldoVencido;
	                //Agregar datos al array
	                array_push($arrProveedores, $arrAuxiliar);

	            }//Cierre de verificación de saldo
			
		    }

		    //Calcular el saldo vencido de los proveedores
			$intAcumSaldoVencidoProveedores = $intAcumSaldoVencido + $intAcumSaldo7Dias;

		    //Agregar datos al array
		    $arrDatos['rows'] = $arrProveedores;
			$arrDatos['acumulado_saldo_vencido'] = $intAcumSaldoVencidoProveedores;

		}//Cierre de verificación de ordenes de compra con adeudo

		//Regresar array con los saldos vencidos de los proveedores
		return $arrDatos;
	}


	//Función que se utiliza para regresar proveedores con saldo vencido y/o saldo por vencer en el rango de fechas
	public function get_saldo_proveedores_detalles($dteFechaInicial, $dteFechaFinal, $intMonedaID, 
												   $arrDias, $arrVencimientoDia, $arrAcumVencimientoDia)
	{
		//Array que se utiliza para enviar datos
		$arrDatos = array('rows' => NULL, 
						  'acumulado_saldo_vencido' => '0.00', 
						  'acumulado_saldo_vencer' => '0.00', 
						  'arrAcumVencimientoDia' => array());

		//Variable que se utiliza pra asignar el id actual del proveedor
	    $intProveedorIDActual = 0;
		//Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo por vencer
	    $intAcumSaldoVencer = 0;
	    //Array que se utiliza para agregar el saldo vencido y saldo por vencer de los proveedores
        $arrProveedores = array();
        //Variable que se utiliza para asignar el acumulado de anticipos
	    $intAcumAnticipos = 0;
	    //Variable que se utiliza para asignar el acumulado de anticipos por día
	    $intAcumAnticiposDia = 0;
        //Array que se utiliza para agregar los datos de un proveedor
        $arrAuxiliar = array();

		//Seleccionar los datos de las ordenes de compra que coinciden con el parámetro enviado
		$otdResultado = $this->pagos_proveedores->buscar_ordenes_compra_importes('reporte', $dteFechaFinal, 
																			     NULL, $intMonedaID);

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

					//Asignar fecha de vencimiento de la orden de compra
                    $dteFechaVencimiento = $arrCol->fecha_vencimiento;

					//Si el proveedor actual es diferente al anterior
					if ($intProveedorIDActual != $arrCol->proveedor_id)
					{
						//Si existe id del proveedor actual
						if ($intProveedorIDActual > 0)
						{

							//Seleccionar el total de anticipos del proveedor
							$otdAnticipos = $this->pagos_proveedores->buscar_anticipo_ordenes_compra_adeudos('reporte',
																											 $dteFechaInicial, 
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
							}

							//Si existe saldo vencido
                            if($intSaldoVencido > 0)
                            {
                            	//Decrementar acumulados
                            	$intSaldoVencido -= $intAcumAnticipos;
                            	$intAcumSaldoVencido -= $intAcumAnticipos;
                            }

                            //Si existe saldo vencido o saldo por vencer
			                if($intSaldoVencido > 0 OR $intSaldoVencer > 0)
			                {
			                	//Definir valores del array auxiliar de información (para cada proveedor)
								$arrAuxiliar["proveedor"] = $strProveedor;
								$arrAuxiliar["saldo_vencido"] = $intSaldoVencido;
								
								//Si hay información de los días correspondientes al rango de fechas
							    if ($arrDias) 
						        {
									//Recorremos el arreglo 
						        	foreach ($arrDias as $dteDia) 
						        	{	

						        		//Inicializar variable
						        		$intAcumAnticiposDia =  0;

						        		//Seleccionar el total de anticipos del proveedor en el día
										$otdAnticiposDia = $this->pagos_proveedores->buscar_anticipo_ordenes_compra_adeudos('reporte',
																															NULL, 
																															$intProveedorIDActual,
																															$intMonedaID, 
																															$dteDia);

										//Si hay información
										if($otdAnticiposDia)
										{
											//Recorremos el arreglo 
											foreach ($otdAnticiposDia as $arrAnt)
											{
												//Asignar el total de anticipos en el día
												$intAcumAnticiposDia += $arrAnt->importe;
											}
										}


										//Si existe saldo por vencer en el día
										if($arrVencimientoDia[$dteDia] > 0)
										{
											//Decrementar acumulados
											$arrVencimientoDia[$dteDia] -= $intAcumAnticiposDia;
											$arrAcumVencimientoDia[$dteDia] -= $intAcumAnticiposDia;
											$intSaldoVencer -= $intAcumAnticiposDia;
											$intAcumSaldoVencer -= $intAcumAnticiposDia;
										}

										//Asignar el saldo por vencer en el día
						        		$arrAuxiliar[$dteDia] = $arrVencimientoDia[$dteDia];

						        		//Inicializar array
						        		$arrVencimientoDia[$dteDia] = 0;
						        	}

						        }//Cierre de verificación de días

						        //Asignar el saldo por vencer
						        $arrAuxiliar["saldo_vencer"] = $intSaldoVencer;

				                //Agregar datos al array
				                array_push($arrProveedores, $arrAuxiliar); 

				            }//Cierre de verificación de saldos
			                
						}

						//Asignar valores del proveedor
						$intProveedorIDActual = $arrCol->proveedor_id;
                        $strProveedor = $arrCol->codigo.' '.$arrCol->razon_social;
                        //Limpiar las siguientes variables (por cada proveedor recorrido)
	                    $intSaldoVencer = 0;
	                    $intSaldoVencido = 0;
	                    $intAcumAnticipos =  0;
                        
                        //Si la fecha de vencimiento es menor que la fecha de inicio
                        if ($dteFechaVencimiento < $dteFechaInicial)
                        {
                        	//Asignar saldo de la orden de compra
                            $intSaldoVencido = $intSaldoOrdenCompra;
                            //Incrementar acumulado del saldo vencido
                            $intAcumSaldoVencido += $intSaldoOrdenCompra;
                        }
                        else if (($dteFechaVencimiento >= $dteFechaInicial) && 
                        		 ($dteFechaVencimiento <= $dteFechaFinal))
                        {

                        	//Si hay información de los días correspondientes al rango de fechas
						    if ($arrDias) 
					        {
					        	//Recorremos el arreglo 
					        	foreach ($arrDias as $dteDia) 
					        	{
					        		//Si el día tiene fecha de vencimiento
					        		if($dteFechaVencimiento == $dteDia)
					        		{
					        		    //Incrementar el saldo por vencer en el día
					        			$arrVencimientoDia[$dteDia] += $intSaldoOrdenCompra;
					        			//Incrementar acumulado del saldo por vencer en el día
										$arrAcumVencimientoDia[$dteDia] += $intSaldoOrdenCompra;

										//Incrementar el saldo por vencer
										$intSaldoVencer += $intSaldoOrdenCompra;
										//Incrementar acumulado del saldo por vencer
										$intAcumSaldoVencer += $intSaldoOrdenCompra;
										
					        		}
					        	}

					        }//Cierre de verificación de días

                   		}
	                    

					}
					else
					{

                        //Si la fecha de vencimiento es menor que la fecha de inicio
                        if ($dteFechaVencimiento < $dteFechaInicial)
                        {
                        	//Incrementar el saldo vencido
                            $intSaldoVencido += $intSaldoOrdenCompra;
                            //Incrementar acumulado del saldo vencido
                            $intAcumSaldoVencido += $intSaldoOrdenCompra;
                        }
                        else if (($dteFechaVencimiento >= $dteFechaInicial) && 
                        		 ($dteFechaVencimiento <= $dteFechaFinal))
                        {

                        	//Si hay información de los días correspondientes al rango de fechas
						    if ($arrDias) 
					        {
					        	//Recorremos el arreglo 
					        	foreach ($arrDias as $dteDia) 
					        	{
					        		//Si el día tiene fecha de vencimiento
					        		if($dteFechaVencimiento == $dteDia)
					        		{	
					        			//Incrementar el saldo por vencer en el día
					        			$arrVencimientoDia[$dteDia] += $intSaldoOrdenCompra;
					        			//Incrementar acumulado del saldo por vencer en el día
										$arrAcumVencimientoDia[$dteDia] += $intSaldoOrdenCompra;

										//Incrementar el saldo por vencer
										$intSaldoVencer += $intSaldoOrdenCompra;
										//Incrementar acumulado del saldo por vencer
										$intAcumSaldoVencer += $intSaldoOrdenCompra;
					        		}
					        	}

					        }//Cierre de verificación de días

                   		}
	                    
					}

				}//Cierre de verificación del saldo


			}



			//Escribir los acumulados del último proveedor
			if ($intProveedorIDActual > 0)
			{
				//Seleccionar el total de anticipos del proveedor
				$otdAnticipos = $this->pagos_proveedores->buscar_anticipo_ordenes_compra_adeudos('reporte',
																								 $dteFechaInicial, 
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
				}

				//Si existe saldo vencido
                if($intSaldoVencido > 0)
                {
                	//Decrementar acumulados
                	$intSaldoVencido -= $intAcumAnticipos;
                	$intAcumSaldoVencido -= $intAcumAnticipos;
                }

                //Si existe saldo vencido o saldo por vencer
				if($intSaldoVencido > 0 OR $intSaldoVencer > 0)
				{

	            	//Definir valores del array auxiliar de información (para cada proveedor)
					$arrAuxiliar["proveedor"] = $strProveedor;
					$arrAuxiliar["saldo_vencido"] = $intSaldoVencido;
					
					//Si hay información de los días correspondientes al rango de fechas
				    if ($arrDias) 
			        {
						//Recorremos el arreglo 
			        	foreach ($arrDias as $dteDia) 
			        	{	

			        		//Inicializar variable
			        		$intAcumAnticiposDia =  0;

			        		//Seleccionar el total de anticipos del proveedor en el día
							$otdAnticiposDia = $this->pagos_proveedores->buscar_anticipo_ordenes_compra_adeudos('reporte',
																												NULL, 
																												$intProveedorIDActual,
																												$intMonedaID, 
																												$dteDia);

							//Si hay información
							if($otdAnticiposDia)
							{
								//Recorremos el arreglo 
								foreach ($otdAnticiposDia as $arrAnt)
								{
									//Asignar el total de anticipos en el día
									$intAcumAnticiposDia += $arrAnt->importe;
								}
							}


							//Si existe saldo por vencer en el día
							if($arrVencimientoDia[$dteDia] > 0)
							{
								//Decrementar acumulados
								$arrVencimientoDia[$dteDia] -= $intAcumAnticiposDia;
								$arrAcumVencimientoDia[$dteDia] -= $intAcumAnticiposDia;
								$intSaldoVencer -= $intAcumAnticiposDia;
								$intAcumSaldoVencer -= $intAcumAnticiposDia;
							}

							//Asignar el saldo por vencer en el día
			        		$arrAuxiliar[$dteDia] = $arrVencimientoDia[$dteDia];

			        		//Inicializar array
			        		$arrVencimientoDia[$dteDia] = 0;
			        	}

			        }//Cierre de verificación de días

			        //Asignar el saldo por vencer
			        $arrAuxiliar["saldo_vencer"] = $intSaldoVencer;

	                //Agregar datos al array
	                array_push($arrProveedores, $arrAuxiliar); 

	            }//Cierre de verificación de saldos
			
		    }


		    //Agregar datos al array
		    $arrDatos['rows'] = $arrProveedores;
			$arrDatos['acumulado_saldo_vencido'] = $intAcumSaldoVencido;
			$arrDatos['acumulado_saldo_vencer'] = $intAcumSaldoVencer;
			$arrDatos['arrAcumVencimientoDia'] = $arrAcumVencimientoDia;
			

		}//Cierre de verificación de ordenes de compra con adeudo

		//Regresar array con los saldos vencidos y saldos por vencer de los proveedores
		return $arrDatos;
	}
}