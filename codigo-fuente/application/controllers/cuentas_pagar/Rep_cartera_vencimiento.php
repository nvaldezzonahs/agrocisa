<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_cartera_vencimiento extends MY_Controller {
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
		$this->cargar_vista('cuentas_pagar/rep_cartera_vencimiento', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con las ordenes de compra que tienen adeudos (vencimientos)
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{	
		
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte = $this->input->post('dteFechaCorte');
		$intProveedorID = $this->input->post('intProveedorID');
		$strDetalles = $this->input->post('strDetalles');

		//Si existe id del proveedor
		if($intProveedorID > 0)
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado de ordenes de compra con adeudos de un proveedor
			$this->get_reporte_proveedor($dteFechaCorte, $intProveedorID);
		}
		else
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado general de ordenes de compra con adeudos
			$this->get_reporte_general($dteFechaCorte, $strDetalles);
		}
	}

	//Método para generar un reporte PDF con el listado de ordenes de compra con adeudos (vencimientos) de un proveedor
    public function get_reporte_proveedor($dteFechaCorte, $intProveedorID)
    {
    	
	    //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo por vencer a 30 días
	    $intAcumSaldo30Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo por vencer a 60 días
	    $intAcumSaldo60Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo por vencer a 90 días
	    $intAcumSaldo90Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo por vencer mayor a 90 días
	    $intAcumSaldoMayorA90Dias = 0;
	    //Variable que se utiliza para asignar el acumulado de anticipos
	    $intAcumAnticipos = 0;
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
		$pdf->arrCabecera = array('FOLIO', utf8_decode('DESCRIPCIÓN'), 'FECHA', 'VENC.', 
								  utf8_decode('DÍAS'), 'SALDO ACT.', 'VENCIDO', 
								  utf8_decode('30 DÍAS'), utf8_decode('60 DÍAS'), 
							 	  utf8_decode('90 DÍAS'), utf8_decode('MAS 90 DÍAS'));
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(18, 19, 16, 16, 7, 20, 20, 18, 18, 18, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'C', 'R', 'R', 'R', 'R', 'R', 'R', 'R');
		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(37, 16, 23, 20, 20, 18, 18, 18, 20);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('L', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R');
		//Datos del primer título del reporte 
		$strTituloLinea1 = 'VENCIMIENTO DE ORDENES EN ';
		$strTituloFechaCorte = 'FECHA DE CORTE: '.$strTituloFechaCorte;
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
	    $pdf->strLinea1 = $strTituloLinea1.'     '.$strTituloFechaCorte;
	    //Asignar el valor de la línea dos del título
		$pdf->strLinea2 = 'PROVEEDOR: '.utf8_decode($otdProveedor->codigo.' - '.$otdProveedor->razon_social);
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
				$intAcumSaldo30Dias = 0;
				$intAcumSaldo60Dias = 0;
				$intAcumSaldo90Dias = 0;
				$intAcumSaldoMayorA90Dias = 0;
				$intAcumAnticipos = 0;
				$arrOrdenesCompra = array();

				//Asignar objeto con el saldo del proveedor en la fecha de corte
				$otdSaldoProveedor = $this->get_saldo_proveedores($dteFechaCorte, $intMonedaID,  
														          'SI', $intProveedorID);

				//Asignar array con los datos de las ordenes de compra
				$arrOrdenesCompra = $otdSaldoProveedor['rows'][0]['detalles'];
				//Asignar el acumulado de anticipos del proveedor
				$intAcumAnticipos = $otdSaldoProveedor['rows'][0]['acumulado_anticipos'];

				//Asignar el acumulado del saldo de los proveedores
				$intAcumSaldo =  $otdSaldoProveedor['acumulado_saldo'];
				//Asignar el acumulado del saldo vencido de los proveedores
				$intAcumSaldoVencido =  $otdSaldoProveedor['acumulado_saldo_vencido'];
				//Asignar el acumulado del saldo por vencer en 30 días de los proveedores
				$intAcumSaldo30Dias =  $otdSaldoProveedor['acumulado_saldo_30Dias'];
				//Asignar el acumulado del saldo por vencer en 60 días de los proveedores
				$intAcumSaldo60Dias =  $otdSaldoProveedor['acumulado_saldo_60Dias'];
				//Asignar el acumulado del saldopor vencer en 90 días de los proveedores
				$intAcumSaldo90Dias =  $otdSaldoProveedor['acumulado_saldo_90Dias'];
				//Asignar el acumulado del saldopor vencer mayor a 90 días de los proveedores
				$intAcumSaldoMayorA90Dias =  $otdSaldoProveedor['acumulado_saldo_mayorA90Dias'];

				//Si existen ordenes de compra del proveedor
				if($arrOrdenesCompra)
				{
					//Concatenar moneda para el primer encabezado del reporte
					$strTituloMoneda = $strTituloLinea1.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$pdf->strLinea1 = $strTituloMoneda.'     '.$strTituloFechaCorte;
					//Agregar pagina
					$pdf->AddPage();
					//Establece el ancho de las columnas
					$pdf->SetWidths($pdf->arrAnchura);

				    //Recorremos el arreglo 
					foreach ($arrOrdenesCompra as $arrOrd)
					{
						//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				   		$pdf->Row(array($arrOrd['folio'], $arrOrd['tipo_referencia'],
				   						$arrOrd['fecha'], $arrOrd['fecha_vencimiento'],
				   						$arrOrd['dias_vencidos'], 
				   						'$'.number_format($arrOrd['saldo'],2), 
						   				'$'.number_format($arrOrd['saldo_vencido'],2), 
						   				'$'.number_format($arrOrd['saldo_30Dias'],2), 
						   				'$'.number_format($arrOrd['saldo_60Dias'],2), 
						   				'$'.number_format($arrOrd['saldo_90Dias'],2), 
						   				'$'.number_format($arrOrd['saldo_mayorA90Dias'],2)), 
				    				    $pdf->arrAlineacion, 'ClippedCell');
					}

					//Si existe importe total de anticipos
				    if($intAcumAnticipos > 0)
				    {
						//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						$pdf->Row(array('ANTICIPO', '', '', '',  '', 
						   			    '$'.number_format($intAcumAnticipos,2), 
						   				'', '', '', '', ''), $pdf->arrAlineacion, 'ClippedCell');
				    }

					$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
					$pdf->Ln(1); //Deja un salto de línea


					//Escribir totales
		   			//Establece el ancho de las columnas
			    	$pdf->SetWidths($arrAnchuraTotales);
				    //Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';

	      			//Acumulado de los saldos
					$pdf->Row(array(utf8_decode('DÍAS DE CRÉDITO:'),
								    $intDiasCredito, 
								    'TOTALES:', 
								    '$'.number_format($intAcumSaldo,2),
								    '$'.number_format($intAcumSaldoVencido,2),
									'$'.number_format($intAcumSaldo30Dias,2),
									'$'.number_format($intAcumSaldo60Dias,2),
									'$'.number_format($intAcumSaldo90Dias,2),
									'$'.number_format($intAcumSaldoMayorA90Dias,2)), 
									  $arrAlineacionTotales, 'ClippedCell');

					//Límite de crédito
					$pdf->Row(array(utf8_decode('LÍMITE DE CRÉDITO:'), 
		   							'$'.number_format($intLimiteCredito,2)), 
				   					$arrAlineacionTotales, 'ClippedCell');

	      			//Cambiar el volumen de la letra
    				$pdf->strTipoLetraTabla = 'Normal';

			    }//Cierre de verificación de información de saldo 
			}

		}//Cierre de verificación de monedas

		//Ejecutar la salida del reporte
        $pdf->Output('cartera_vencimiento_'.$otdProveedor->codigo.'.pdf','I'); 
    }
   

	//Método para generar un reporte PDF con el listado general de ordenes de compra con adeudos (vencimientos)
	public function get_reporte_general($dteFechaCorte, $strDetalles)
    {
	    //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido a 30 días
	    $intAcumSaldo30Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido a 60 días
	    $intAcumSaldo60Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido a 90 días
	    $intAcumSaldo90Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido mayor a 90 días
	    $intAcumSaldoMayorA90Dias = 0;
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
		$pdf->arrCabecera = array('PROVEEDOR', 'SALDO ACT.', 'VENCIDO', utf8_decode('30 DÍAS'), 
							 	  utf8_decode('60 DÍAS'), utf8_decode('90 DÍAS'), utf8_decode('MAS 90 DÍAS'));
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(76, 20, 20, 18, 18, 18, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'R', 'R', 'R', 'R', 'R', 'R');
		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(37, 16,  23, 20, 20, 20, 20, 20);
		//Establece el ancho de las columnas de la tabla detalles
		$arrAchuraDetalles = array(17, 20, 16, 16, 7, 20, 20, 18, 18, 18, 20 );
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('L', 'L', 'C', 'C', 'R', 'R', 'R', 'R', 'R', 'R', 'R');
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R', 'R', 'R', 'R', 'R');
		//Datos del primer título del reporte 
		$strTituloLinea1 = 'VENCIMIENTO DE ORDENES EN ';
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
				$intAcumSaldo30Dias = 0;
                $intAcumSaldo60Dias = 0;
                $intAcumSaldo90Dias = 0;
                $intAcumSaldoMayorA90Dias = 0;
				$arrProveedores = array();

				//Asignar objeto con el saldo de los proveedores en la fecha de corte
				$otdSaldoProveedores = $this->get_saldo_proveedores($dteFechaCorte, $intMonedaID,  
														       		$strDetalles);

				//Asignar array con los datos de los proveedores
				$arrProveedores = $otdSaldoProveedores['rows'];
				//Asignar el acumulado del saldo de los proveedores
				$intAcumSaldo =  $otdSaldoProveedores['acumulado_saldo'];
				//Asignar el acumulado del saldo vencido de los proveedores
				$intAcumSaldoVencido =  $otdSaldoProveedores['acumulado_saldo_vencido'];
				//Asignar el acumulado del saldo por vencer en 30 días de los proveedores
				$intAcumSaldo30Dias =  $otdSaldoProveedores['acumulado_saldo_30Dias'];
				//Asignar el acumulado del saldo por vencer en 60 días de los proveedores
				$intAcumSaldo60Dias =  $otdSaldoProveedores['acumulado_saldo_60Dias'];
				//Asignar el acumulado del saldopor vencer en 90 días de los proveedores
				$intAcumSaldo90Dias =  $otdSaldoProveedores['acumulado_saldo_90Dias'];
				//Asignar el acumulado del saldopor vencer mayor a 90 días de los proveedores
				$intAcumSaldoMayorA90Dias =  $otdSaldoProveedores['acumulado_saldo_mayorA90Dias'];

				//Si existen saldos de los proveedores
				if($arrProveedores)
				{

					//Concatenar moneda para el primer encabezado del reporte
					$strTituloMoneda = $strTituloLinea1.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$pdf->strLinea1 = $strTituloMoneda.'     '.$strTituloFechaCorte;
					//Agregar pagina
					$pdf->AddPage();
					

					//Recorremos el arreglo 
					foreach ($arrProveedores as $arrSal)
					{
						//Establece el ancho de las columnas
						$pdf->SetWidths($pdf->arrAnchura);
						//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					   	$pdf->Row(array(utf8_decode($arrSal['proveedor']), 
				   						'$'.number_format($arrSal['saldo'],2),
				   						'$'.number_format($arrSal['saldo_vencido'],2),
				   						'$'.number_format($arrSal['saldo_30Dias'],2),
				   						'$'.number_format($arrSal['saldo_60Dias'],2),
				   						'$'.number_format($arrSal['saldo_90Dias'],2),
				   						'$'.number_format($arrSal['saldo_mayorA90Dias'],2)), 
				    				    $pdf->arrAlineacion, 'ClippedCell');

					   	//Si se cumple la sentencia mostrar detalles del registro
						if($arrSal['detalles'] && $strDetalles == 'SI')
		   				{
		   					//Establece el ancho de las columnas
							$pdf->SetWidths($arrAchuraDetalles);
							//Recorremos el arreglo 
					        foreach ($arrSal['detalles'] as $arrDet) 
					        {
							   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							   $pdf->Row(array($arrDet['folio'], $arrDet['tipo_referencia'], 
							   					$arrDet['fecha'], $arrDet['fecha_vencimiento'],  
							   					$arrDet['dias_vencidos'], 
							   					'$'.number_format($arrDet['saldo'],2), 
							   					'$'.number_format($arrDet['saldo_vencido'],2), 
							   					'$'.number_format($arrDet['saldo_30Dias'],2), 
							   					'$'.number_format($arrDet['saldo_60Dias'],2), 
							   					'$'.number_format($arrDet['saldo_90Dias'],2), 
							   					'$'.number_format($arrDet['saldo_mayorA90Dias'],2)),
							    				$arrAlineacionDetalles, 'ClippedCell');

							}//Cierre de foreach detalles

							//Si existe importe total de anticipos
						    if($arrSal['acumulado_anticipos'] > 0)
						    {
						   	 	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
								$pdf->Row(array('ANTICIPO', '', '', '',  '', 
												'$'.number_format($arrSal['acumulado_anticipos'],2), 
						   						'', '', '', '', ''), $arrAlineacionDetalles, 'ClippedCell');
						    }

							$pdf->Ln(2);//Deja un salto de línea

		   				}//Cierre de verificación de detalles

					}//Cierre de foreach proveedores


					$pdf->Ln(-2);//Quitar un salto de línea
					$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales

					//Escribir totales
		   			//Establece el ancho de las columnas
			    	$pdf->SetWidths($pdf->arrAnchura);
				    //Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
	      			//Acumulado de los saldos
					$pdf->Row(array('TOTALES:', '$'.number_format($intAcumSaldo, 2),
									'$'.number_format($intAcumSaldoVencido, 2),
									'$'.number_format($intAcumSaldo30Dias, 2),
			   								'$'.number_format($intAcumSaldo60Dias, 2),
			   								'$'.number_format($intAcumSaldo90Dias, 2),
			   								'$'.number_format($intAcumSaldoMayorA90Dias, 2)), 
					    		    $arrAlineacionTotales, 'ClippedCell');
					//Cambiar el volumen de la fuente a normal
	      			$pdf->strTipoLetraTabla = '';

				}//Cierre de verificación de información de saldos

			}

		}//Cierre de verificación de monedas

		//Ejecutar la salida del reporte
        $pdf->Output('cartera_vencimiento_general.pdf','I'); 
    }


	/*Método para generar un archivo XLS con las ordenes de compra que tienen adeudos (vencimientos)
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte = $this->input->post('dteFechaCorte');
		$intProveedorID = $this->input->post('intProveedorID');
		$strDetalles = $this->input->post('strDetalles');

		//Si existe id del proveedor
		if($intProveedorID > 0)
		{
			//Hacer un llamado a la función para generar un archivo XLS con el listado de ordenes de compra con adeudos de un proveedor
			$this->get_xls_proveedor($dteFechaCorte, $intProveedorID);
		}
		else
		{
			//Hacer un llamado a la función para generar un archivo XLS el listado general de ordenes de compra con adeudos
			$this->get_xls_general($dteFechaCorte, $strDetalles);
		}
	}


	//Método para generar un archivo XLS con el listado de ordenes de compra con adeudos (vencimientos) de un proveedor
    public function get_xls_proveedor($dteFechaCorte, $intProveedorID)
    {
    
    	//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
		//Variable que se utiliza pra asignar el id actual de la moneda
	    $intMonedaIDActual = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido a 30 días
	    $intAcumSaldo30Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido a 60 días
	    $intAcumSaldo60Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido a 90 días
	    $intAcumSaldo90Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido mayor a 90 días
	    $intAcumSaldoMayorA90Dias = 0;
	    //Variable que se utiliza para asignar el acumulado de anticipos
	    $intAcumAnticipos = 0;
	    //Variable que se utiliza para asignar los días de crédito
	    $intDiasCredito = 0;
	    //Variable que se utiliza para asignar el límite de crédito
	    $intLimiteCredito = 0;
	    //Array que se utiliza para agregar los datos de las ordenes de compra
	    $arrOrdenesCompra = array();
	    //Variable que se utiliza para asignar el número de registros por cada moneda
		$intNumRegistros = 0; 
		//Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última moneda)
		$intNumMaxRegistros = 0;
		 //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFechaCorte = $this->get_fecha_formato_letra($dteFechaCorte, 'C');

		//Datos del primer título del reporte 
		$strTituloLinea1 = 'VENCIMIENTO DE ORDENES EN ';
		$strTituloFechaCorte = 'FECHA DE CORTE: '.$strTituloFechaCorte;

	  
		//Seleccionar los datos del proveedor que coincide con el id
		$otdProveedor =  $this->proveedores->buscar($intProveedorID);
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
				$strNombreHoja = 'cartera '.$arrMon->codigo;
				//Inicializar variables
				$intAcumSaldo = 0;
				$intAcumSaldoVencido = 0;
				$intAcumSaldo30Dias = 0;
				$intAcumSaldo60Dias = 0;
				$intAcumSaldo90Dias = 0;
				$intAcumSaldoMayorA90Dias = 0;
				$intAcumAnticipos = 0;
				$arrOrdenesCompra = array();

				//Asignar objeto con el saldo del proveedor en la fecha de corte
				$otdSaldoProveedor = $this->get_saldo_proveedores($dteFechaCorte, $intMonedaID,  
														          'SI', $intProveedorID);

				//Asignar array con los datos de las ordenes de compra
				$arrOrdenesCompra = $otdSaldoProveedor['rows'][0]['detalles'];
				//Asignar el acumulado de anticipos del proveedor
				$intAcumAnticipos = $otdSaldoProveedor['rows'][0]['acumulado_anticipos'];

				//Asignar el acumulado del saldo de los proveedores
				$intAcumSaldo =  $otdSaldoProveedor['acumulado_saldo'];
				//Asignar el acumulado del saldo vencido de los proveedores
				$intAcumSaldoVencido =  $otdSaldoProveedor['acumulado_saldo_vencido'];
				//Asignar el acumulado del saldo por vencer en 30 días de los proveedores
				$intAcumSaldo30Dias =  $otdSaldoProveedor['acumulado_saldo_30Dias'];
				//Asignar el acumulado del saldo por vencer en 60 días de los proveedores
				$intAcumSaldo60Dias =  $otdSaldoProveedor['acumulado_saldo_60Dias'];
				//Asignar el acumulado del saldopor vencer en 90 días de los proveedores
				$intAcumSaldo90Dias =  $otdSaldoProveedor['acumulado_saldo_90Dias'];
				//Asignar el acumulado del saldopor vencer mayor a 90 días de los proveedores
				$intAcumSaldoMayorA90Dias =  $otdSaldoProveedor['acumulado_saldo_mayorA90Dias'];

				//Concatenar datos para el primer encabezado del reporte
				$strEncabezado = $strTituloLinea1.'     '.$strTituloFechaCorte;
				//Se agrega el título del archivo
				$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);
				$objExcel->getActiveSheet()->setCellValue('A8', 'PROVEEDOR: '.$otdProveedor->codigo.' - '.$otdProveedor->razon_social);

				//Se agregan las columnas de cabecera
		        $objExcel->getActiveSheet()->setCellValue('A'.$intPosEncabezados, 'FOLIO')
		                 ->setCellValue('B'.$intPosEncabezados, 'DESCRIPCIÓN')
		                 ->setCellValue('C'.$intPosEncabezados, 'FECHA')
		                 ->setCellValue('D'.$intPosEncabezados, 'VENCIMIENTO')
		                 ->setCellValue('E'.$intPosEncabezados, 'DÍAS VENCIDOS')
		                 ->setCellValue('F'.$intPosEncabezados, 'SALDO ACTUAL')
		                 ->setCellValue('G'.$intPosEncabezados, 'VENCIDO')
		                 ->setCellValue('H'.$intPosEncabezados, '30 DÍAS')
		                 ->setCellValue('I'.$intPosEncabezados, '60 DÍAS')
		                 ->setCellValue('J'.$intPosEncabezados, '90 DÍAS')
		                 ->setCellValue('K'.$intPosEncabezados, 'MAS 90 DÍAS');

		        //Combinar las siguientes celdas
				$objExcel->getActiveSheet()->mergeCells('A8:D8');

				//Cambiar estilo de las siguientes celdas
		        $objExcel->getActiveSheet()
		        		 ->getStyle('A8:D8')
		        		 ->applyFromArray($arrStyleBold);

		        //Preferencias de color de relleno de celda
		        $objExcel->getActiveSheet()
		    			 ->getStyle('A10:K10')
		    			 ->getFill()
		    			 ->applyFromArray($arrStyleColumnas);

		    	//Preferencias de color de texto de la celda
		    	$objExcel->getActiveSheet()
		    			 ->getStyle('A10:K10')
		    			 ->applyFromArray($arrStyleFuenteColumnas);

		    	//Cambiar alineación de las siguientes celdas
		        $objExcel->getActiveSheet()
		            	 ->getStyle('A10:K10')
		            	 ->getAlignment()
		            	 ->applyFromArray($arrStyleAlignmentCenter);

				//Si existen ordenes de compra del proveedor
				if($arrOrdenesCompra)
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
					$strTituloLinea1 = 'VENCIMIENTO DE ORDENES EN '.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$strEncabezado = $strTituloLinea1.'     '.$strTituloFechaCorte;

					//Se agrega el título del archivo
					$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);

					//Recorremos el arreglo 
					foreach ($arrOrdenesCompra as $arrOrd)
					{
				   		//Agregar información de la orden de compra
			            $objExcel->getActiveSheet()
		                         ->setCellValue('A'.$intFila, $arrOrd['folio'])
		                         ->setCellValue('B'.$intFila, $arrOrd['tipo_referencia'])
		                         ->setCellValue('C'.$intFila, $arrOrd['fecha'])
		                         ->setCellValue('D'.$intFila, $arrOrd['fecha_vencimiento'])
		                         ->setCellValue('E'.$intFila, $arrOrd['dias_vencidos'])
		                         ->setCellValue('F'.$intFila, $arrOrd['saldo'])
		                         ->setCellValue('G'.$intFila, $arrOrd['saldo_vencido'])
		                         ->setCellValue('H'.$intFila, $arrOrd['saldo_30Dias'])
		                         ->setCellValue('I'.$intFila, $arrOrd['saldo_60Dias'])
		                         ->setCellValue('J'.$intFila, $arrOrd['saldo_90Dias'])
		                         ->setCellValue('K'.$intFila, $arrOrd['saldo_mayorA90Dias']);

		                //Incrementar el indice para escribir los datos del siguiente registro
						$intFila++;
					}


					//Si existe importe total de anticipos
				    if($intAcumAnticipos > 0)
				    {
				    	//Agregar información del acumulado de anticipos
			            $objExcel->getActiveSheet()
		                         ->setCellValue('A'.$intFila, 'ANTICIPO')
		                         ->setCellValue('F'.$intFila, $intAcumAnticipos);

				    	//Incrementar el indice para escribir los datos del siguiente registro
						$intFila++;
				    }


				    //Incrementar el indice para escribir los totales
		            $intFila++;
		             //Asignar indice de fila donde se empezaran a escribir los totales
		            $intFilaTotales =  $intFila;

		            //Escribir totales
		        	//Agregar información del acumulado de saldos
					$objExcel->getActiveSheet()
	                         ->setCellValue('A'.$intFila, 'DÍAS DE CRÉDITO:')
	                         ->setCellValue('B'.$intFila, $intDiasCredito)
	                         ->setCellValue('E'.$intFila, 'TOTALES:')
	                         ->setCellValue('F'.$intFila, $intAcumSaldo)
	                         ->setCellValue('G'.$intFila, $intAcumSaldoVencido)
	                         ->setCellValue('H'.$intFila, $intAcumSaldo30Dias)
	                         ->setCellValue('I'.$intFila, $intAcumSaldo60Dias)
	                         ->setCellValue('J'.$intFila, $intAcumSaldo90Dias)
	                         ->setCellValue('K'.$intFila, $intAcumSaldoMayorA90Dias);


	                //Incrementar el indice para escribir límite de crédito
			        $intFila++;

			         //Agregar información del límite de crédito
					$objExcel->getActiveSheet()
	                         ->setCellValue('A'.$intFila, 'LÍMITE DE CRÉDITO:')
	                         ->setCellValue('B'.$intFila, $intLimiteCredito);

					//Cambiar contenido de las celdas a formato moneda
		           	$objExcel->getActiveSheet()
			            		 ->getStyle('F'.$intFilaInicial.':'.'K'.$intFila)
			            		 ->getNumberFormat()
			            		 ->setFormatCode('$#,##0.00');


			        //Cambiar alineación de las siguientes celdas
			        $objExcel->getActiveSheet()
				        	 ->getStyle('C'.$intFilaInicial.':'.'D'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentCenter);

		    		$objExcel->getActiveSheet()
				        	 ->getStyle('E'.$intFilaInicial.':'.'K'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);


				    //Cambiar estilo de las siguientes celdas
			        $objExcel->getActiveSheet()
			            		 ->getStyle('A'.$intFilaTotales.':'.'K'.$intFila)
			            		 ->applyFromArray($arrStyleBold);


			        //Incrementar contador por cada moneda
					$intContadorHojas++;
			        
			        //Asignar el número de registros (filas)   		 
			        $intNumRegistros = $intFila;

			        //Si el número de registros (por cada moneda) es mayor que el número máximo de registros 
				    if($intNumRegistros > $intNumMaxRegistros)
		            {
		            	//Asignar número de registros
		            	$intNumMaxRegistros = $intNumRegistros;
		            }

				}//Cierre de verificación de información de saldo 

			}

		}//Cierre de verificación de monedas


		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'cartera_vencimiento_'.$otdProveedor->codigo.'.xls', 'cartera', $intNumMaxRegistros);
    }


    //Método para generar un archivo XLS con el listado general de ordenes de compra con adeudos (vencimientos)
   	public function get_xls_general($dteFechaCorte, $strDetalles)
    {
    	//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
		//Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido a 30 días
	    $intAcumSaldo30Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido a 60 días
	    $intAcumSaldo60Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido a 90 días
	    $intAcumSaldo90Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido mayor a 90 días
	    $intAcumSaldoMayorA90Dias = 0;
	    //Array que se utiliza para agregar los datos (saldos) de los proveedores
	    $arrProveedores = array();
	    //Variable que se utiliza para asignar el número de registros por cada moneda
		$intNumRegistros = 0; 
		//Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última moneda)
		$intNumMaxRegistros = 0;
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFechaCorte = $this->get_fecha_formato_letra($dteFechaCorte, 'C');
		//Concatenar datos para el primer encabezado del reporte
		$strTituloLinea1 = 'VENCIMIENTO DE ORDENES EN ';
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
				$strNombreHoja = 'cartera '.$arrMon->codigo;
				//Inicializar variables
				$intAcumSaldo = 0;
				$intAcumSaldoVencido = 0;
				$intAcumSaldo30Dias = 0;
                $intAcumSaldo60Dias = 0;
                $intAcumSaldo90Dias = 0;
                $intAcumSaldoMayorA90Dias = 0;
				$arrProveedores = array();

				//Asignar objeto con el saldo de los proveedores en la fecha de corte
				$otdSaldoProveedores = $this->get_saldo_proveedores($dteFechaCorte, $intMonedaID,  
														       		$strDetalles);

				//Asignar array con los datos de los proveedores
				$arrProveedores = $otdSaldoProveedores['rows'];
				//Asignar el acumulado del saldo de los proveedores
				$intAcumSaldo =  $otdSaldoProveedores['acumulado_saldo'];
				//Asignar el acumulado del saldo vencido de los proveedores
				$intAcumSaldoVencido =  $otdSaldoProveedores['acumulado_saldo_vencido'];
				//Asignar el acumulado del saldo por vencer en 30 días de los proveedores
				$intAcumSaldo30Dias =  $otdSaldoProveedores['acumulado_saldo_30Dias'];
				//Asignar el acumulado del saldo por vencer en 60 días de los proveedores
				$intAcumSaldo60Dias =  $otdSaldoProveedores['acumulado_saldo_60Dias'];
				//Asignar el acumulado del saldopor vencer en 90 días de los proveedores
				$intAcumSaldo90Dias =  $otdSaldoProveedores['acumulado_saldo_90Dias'];
				//Asignar el acumulado del saldopor vencer mayor a 90 días de los proveedores
				$intAcumSaldoMayorA90Dias =  $otdSaldoProveedores['acumulado_saldo_mayorA90Dias'];

				//Concatenar datos para el primer encabezado del reporte
				$strEncabezado = $strTituloLinea1.'     '.$strTituloFechaCorte;

				//Se agrega el título del archivo
				$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);


				//Se agregan las columnas de cabecera
			    $objExcel->getActiveSheet()
				 		 ->setCellValue('A'.$intPosEncabezados, 'PROVEEDOR')
		                 ->setCellValue('B'.$intPosEncabezados, 'DÍAS DE CRÉDITO')
		                 ->setCellValue('C'.$intPosEncabezados, 'LÍMITE DE CRÉDITO');


		        //Si se cumple la sentencia dar estilo a la columna detalles
				if($strDetalles == 'SI')
				{
					//Se agregan las columnas de cabecera
					$objExcel->getActiveSheet()->setCellValue('D'.$intPosEncabezados, 'FOLIO')
				             ->setCellValue('E'.$intPosEncabezados, 'DESCRIPCIÓN')
			                 ->setCellValue('F'.$intPosEncabezados, 'FECHA')
			                 ->setCellValue('G'.$intPosEncabezados, 'VENCIMIENTO')
			                 ->setCellValue('H'.$intPosEncabezados, 'DÍAS VENCIDOS')
			                 ->setCellValue('I'.$intPosEncabezados, 'SALDO ACTUAL')
			                 ->setCellValue('J'.$intPosEncabezados, 'VENCIDO')
			                 ->setCellValue('K'.$intPosEncabezados, '30 DÍAS')
			                 ->setCellValue('L'.$intPosEncabezados, '60 DÍAS')
			                 ->setCellValue('M'.$intPosEncabezados, '90 DÍAS')
			                 ->setCellValue('N'.$intPosEncabezados, 'MAS 90 DÍAS');

			        //Asignar indice de la primer columna de tipo moneda
			        $strPrimerColumnaMoneda = 'I';
			        //Asignar indice de la última columna
			        $strUltimaColumna = 'N';
			        //Inicializar indice de la columna para empezar en la columna 8-H (totales)
				    $intIndColTotales = 8;
				}
				else
				{
					
					//Se agregan las columnas de cabecera
					$objExcel->getActiveSheet()
							 ->setCellValue('D'.$intPosEncabezados, 'SALDO ACTUAL')
				             ->setCellValue('E'.$intPosEncabezados, 'VENCIDO')
				             ->setCellValue('F'.$intPosEncabezados, '30 DÍAS')
				             ->setCellValue('G'.$intPosEncabezados, '60 DÍAS')
				             ->setCellValue('H'.$intPosEncabezados, '90 DÍAS')
				             ->setCellValue('I'.$intPosEncabezados, 'MAS 90 DÍAS');

				    //Asignar indice de la primer columna de tipo moneda
			        $strPrimerColumnaMoneda = 'D';
			        //Asignar indice de la última columna
			        $strUltimaColumna = 'I';
			        //Inicializar indice de la columna para empezar en la columna 3-C (totales)
					$intIndColTotales = 3;
				}
				

		        //Preferencias de color de relleno de celda
		        $objExcel->getActiveSheet()
		    			 ->getStyle('A9:'.$strUltimaColumna.'9')
		    			 ->getFill()
		    			 ->applyFromArray($arrStyleColumnas);

		    	//Preferencias de color de texto de la celda
		    	$objExcel->getActiveSheet()
		    			 ->getStyle('A9:'.$strUltimaColumna.'9')
		    			 ->applyFromArray($arrStyleFuenteColumnas);

		    	//Cambiar alineación de las siguientes celdas
		        $objExcel->getActiveSheet()
		            	 ->getStyle('A9:'.$strUltimaColumna.'9')
		            	 ->getAlignment()
		            	 ->applyFromArray($arrStyleAlignmentCenter);


		        //Si existen saldos de los proveedores
				if($arrProveedores)
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
					$strTituloLinea1 = 'VENCIMIENTO DE ORDENES EN '.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$strEncabezado = $strTituloLinea1.'     '.$strTituloFechaCorte;

					//Se agrega el título del archivo
					$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);


					
					//Recorremos el arreglo 
					foreach ($arrProveedores as $arrSal)
					{
						//Agregar información del proveedor
			            $objExcel->getActiveSheet()
		                         ->setCellValue('A'.$intFila, $arrSal['proveedor'])
		                         ->setCellValue('B'.$intFila, $arrSal['dias_credito'])
		                         ->setCellValue('C'.$intFila, $arrSal['limite_credito']);

						//Si se cumple la sentencia mostrar detalles del registro
						if($arrSal['detalles'] && $strDetalles == 'SI')
		   				{
		   					//Agregar acumulado de los saldos del proveedor
				            $objExcel->getActiveSheet()
			                         ->setCellValue('I'.$intFila, $arrSal['saldo'])
			                         ->setCellValue('J'.$intFila, $arrSal['saldo_vencido'])
			                         ->setCellValue('K'.$intFila, $arrSal['saldo_30Dias'])
			                         ->setCellValue('L'.$intFila, $arrSal['saldo_60Dias'])
			                         ->setCellValue('M'.$intFila, $arrSal['saldo_90Dias'])
			                         ->setCellValue('N'.$intFila, $arrSal['saldo_mayorA90Dias']);

			                //Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;

							//Recorremos el arreglo 
					        foreach ($arrSal['detalles'] as $arrDet) 
					        {
					        	//Agregar información de la orden de compra
					        	$objExcel->getActiveSheet()
			                         ->setCellValue('D'.$intFila, $arrDet['folio'])
			                         ->setCellValue('E'.$intFila, $arrDet['tipo_referencia'])
			                         ->setCellValue('F'.$intFila, $arrDet['fecha'])
			                         ->setCellValue('G'.$intFila, $arrDet['fecha_vencimiento'])
			                         ->setCellValue('H'.$intFila, $arrDet['dias_vencidos'])
			                         ->setCellValue('I'.$intFila, $arrDet['saldo'])
			                         ->setCellValue('J'.$intFila, $arrDet['saldo_vencido'])
			                         ->setCellValue('K'.$intFila, $arrDet['saldo_30Dias'])
			                         ->setCellValue('L'.$intFila, $arrDet['saldo_60Dias'])
			                         ->setCellValue('M'.$intFila, $arrDet['saldo_90Dias'])
			                         ->setCellValue('N'.$intFila, $arrDet['saldo_mayorA90Dias']);

				                //Incrementar el indice para escribir los datos del siguiente registro
								$intFila++;

					        }//Cierre de foreach detalles

					        //Cambiar alineación de las siguientes celdas
							$objExcel->getActiveSheet()
				                	 ->getStyle('F'.$intFilaInicial.':'.'G'.$intFila)
				                	 ->getAlignment()
				                	 ->applyFromArray($arrStyleAlignmentCenter);


					        //Si existe importe total de anticipos
						    if($arrSal['acumulado_anticipos'] > 0)
						    {
						    	//Agregar información del anticipo
								$objExcel->getActiveSheet()
										  ->setCellValue('D'.$intFila, 'ANTICIPO')
										  ->setCellValue('I'.$intFila, $arrSal['acumulado_anticipos']);

								//Incrementar el indice para escribir los datos del siguiente registro
		   						$intFila++;

						    }

						}
						else
						{
							//Agregar información del proveedor
				            $objExcel->getActiveSheet()
			                         ->setCellValue('D'.$intFila, $arrSal['saldo'])
			                         ->setCellValue('E'.$intFila, $arrSal['saldo_vencido'])
			                         ->setCellValue('F'.$intFila, $arrSal['saldo_30Dias'])
			                         ->setCellValue('G'.$intFila, $arrSal['saldo_60Dias'])
			                         ->setCellValue('H'.$intFila, $arrSal['saldo_90Dias'])
			                         ->setCellValue('I'.$intFila, $arrSal['saldo_mayorA90Dias']);

			                //Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;
						}
				   		

					}//Cierre de foreach proveedores

					
					//Incrementar el indice para escribir los totales
		            $intFila++;
		            
					//Escribir totales
		        	//Agregar información de los totales
					$objExcel->getActiveSheet()
	                         ->setCellValue($this->ARR_COLUMNAS[$intIndColTotales].$intFila, 'TOTALES:')
	                         ->setCellValue($this->ARR_COLUMNAS[$intIndColTotales+1].$intFila, $intAcumSaldo)
	                         ->setCellValue($this->ARR_COLUMNAS[$intIndColTotales+2].$intFila, $intAcumSaldoVencido)
	                         ->setCellValue($this->ARR_COLUMNAS[$intIndColTotales+3].$intFila, $intAcumSaldo30Dias)
	                         ->setCellValue($this->ARR_COLUMNAS[$intIndColTotales+4].$intFila, $intAcumSaldo60Dias)
	                         ->setCellValue($this->ARR_COLUMNAS[$intIndColTotales+5].$intFila, $intAcumSaldo90Dias)
	                         ->setCellValue($this->ARR_COLUMNAS[$intIndColTotales+6].$intFila, $intAcumSaldoMayorA90Dias);

				
					//Cambiar contenido de las celdas a formato moneda
	                $objExcel->getActiveSheet()
		            		 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
		            		 ->getNumberFormat()
		            		 ->setFormatCode('$#,##0.00');

	           		$objExcel->getActiveSheet()
		            		 ->getStyle($strPrimerColumnaMoneda.$intFilaInicial.':'.$strUltimaColumna.$intFila)
		            		 ->getNumberFormat()
		            		 ->setFormatCode('$#,##0.00');

		           	//Cambiar alineación de las siguientes celdas
		    		$objExcel->getActiveSheet()
				        	 ->getStyle('B'.$intFilaInicial.':'.'C'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

				    $objExcel->getActiveSheet()
				        	 ->getStyle('H'.$intFilaInicial.':'.'H'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

				    $objExcel->getActiveSheet()
				        	 ->getStyle($strPrimerColumnaMoneda.$intFilaInicial.':'.$strUltimaColumna.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);


				    //Cambiar estilo de las siguientes celdas
		            $objExcel->getActiveSheet()
		            		 ->getStyle('B'.$intFila.':'.$strUltimaColumna.$intFila)
		            		 ->applyFromArray($arrStyleBold);


			        //Incrementar contador por cada moneda
					$intContadorHojas++;
			        
			        //Asignar el número de registros (filas)   		 
			        $intNumRegistros = $intFila;

			        //Si el número de registros (por cada moneda) es mayor que el número máximo de registros 
				    if($intNumRegistros > $intNumMaxRegistros)
		            {
		            	//Asignar número de registros
		            	$intNumMaxRegistros = $intNumRegistros;
		            }

				}//Cierre de verificación de información de saldos

			}

		}//Cierre de verificación de monedas

        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'cartera_vencimiento_general.xls', 'cartera', $intNumMaxRegistros);
    }
  

    //Función que se utiliza para regresar proveedores con saldo vencido y/o saldo por vencer en el rango de fechas
	public function get_saldo_proveedores($dteFechaCorte, $intMonedaID, $strDetalles = NULL, 
										  $intProveedorBusqID = NULL)
	{

		//Array que se utiliza para enviar datos
		$arrDatos = array('rows' => NULL, 
						  'acumulado_saldo' => '0.00',
						  'acumulado_saldo_vencido' => '0.00',
						  'acumulado_saldo_30Dias' => '0.00',
						  'acumulado_saldo_60Dias' => '0.00',
						  'acumulado_saldo_90Dias' => '0.00',
						  'acumulado_saldo_mayorA90Dias' => '0.00');

		//Variable que se utiliza pra asignar el id actual del proveedor
	    $intProveedorIDActual = 0;
		//Sumar 30 días a la fecha de corte
		$dteFechaR30Dias = $this->sumar_dias_fecha(30, $dteFechaCorte);
		//Sumar 60 días a la fecha de corte
		$dteFechaR60Dias = $this->sumar_dias_fecha(60, $dteFechaCorte);
		//Sumar 90 días a la fecha de corte
		$dteFechaR90Dias = $this->sumar_dias_fecha(90, $dteFechaCorte);
		//Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
		//Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido a 30 días
	    $intAcumSaldo30Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido a 60 días
	    $intAcumSaldo60Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido a 90 días
	    $intAcumSaldo90Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido mayor a 90 días
	    $intAcumSaldoMayorA90Dias = 0;
	    //Variable que se utiliza para asignar el acumulado de anticipos
	    $intAcumAnticipos = 0;
	    //Variables que se utilizan para asignar los saldos del proveedor
	    $intSaldo = 0;
	    $intSaldoVencido = 0;
	    $intSaldo30Dias = 0;
	    $intSaldo60Dias = 0;
	    $intSaldo90Dias = 0;
	    $intSaldoMayorA90Dias = 0;

	    //Array que se utiliza para agregar los datos de los proveedores
        $arrProveedores = array();
        //Array que se utiliza para agregar los datos de un proveedor
        $arrAuxiliar = array();
        //Array que se utiliza para agregar los detalles de un proveedor
        $arrDetalles = array();

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


						//Asignar fecha de vencimiento de la orden de compra
	                    $dteFechaVencimiento = $arrCol->fecha_vencimiento;

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

									//Decrementar saldos y acumulados
		                            $intSaldo -=  $intAcumAnticipos;
		                       		$intAcumSaldo -= $intAcumAnticipos;

		                            //Si existe saldo vencido
		                            if($intSaldoVencido > 0)
		                            {
		                            	$intSaldoVencido -= $intAcumAnticipos;
		                            	$intAcumSaldoVencido -= $intAcumAnticipos;
		                            }
		                            else if($intSaldo30Dias > 0)//Si existe saldo por vencer en 30 días
	                            	{
	                            		$intSaldo30Dias -= $intAcumAnticipos;
	                            		$intAcumSaldo30Dias -= $intAcumAnticipos;
	                            	}
	                            	else if($intSaldo60Dias > 0)//Si existe saldo por vencer en 60 días
	                            	{
	                            		$intSaldo60Dias -= $intAcumAnticipos;
	                            		$intAcumSaldo60Dias -= $intAcumAnticipos;

	                            	}
	                            	else if($intSaldo90Dias > 0)//Si existe saldo por vencer en 90 días
	                            	{
	                            		$intSaldo90Dias -= $intAcumAnticipos;
	                            		$intAcumSaldo90Dias -= $intAcumAnticipos;
	                            	}
	                            	else //Si existe saldo por vencer mayor a 90 días
	                            	{
	                            		$intSaldoMayorA90Dias -= $intAcumAnticipos;
	                            		$intAcumSaldoMayorA90Dias -= $intAcumAnticipos;
	                            	}

								}//Cierre de verificación de anticipos
	                        	
	                        	//Definir valores del array auxiliar de información (para cada proveedor)
								$arrAuxiliar["proveedor"] = $strProveedor;
								$arrAuxiliar["dias_credito"] = $intCreditoDias;
								$arrAuxiliar["limite_credito"] = $intLimiteCredito;
								$arrAuxiliar["saldo"] = $intSaldo;
								$arrAuxiliar["saldo_vencido"] = $intSaldoVencido;
								$arrAuxiliar["saldo_30Dias"] = $intSaldo30Dias;
								$arrAuxiliar["saldo_60Dias"] = $intSaldo60Dias;
								$arrAuxiliar["saldo_90Dias"] = $intSaldo90Dias;
								$arrAuxiliar["saldo_mayorA90Dias"] = $intSaldoMayorA90Dias;
								$arrAuxiliar["acumulado_anticipos"] = $intAcumAnticipos;
								$arrAuxiliar["detalles"] = $arrDetalles;
				                //Agregar datos al array
				                array_push($arrProveedores, $arrAuxiliar); 

							}

							//Asignar valores del proveedor
							$intProveedorIDActual = $arrCol->proveedor_id;
	                        $strProveedor = $arrCol->codigo.' '.$arrCol->razon_social;
	                        $intCreditoDias = $arrCol->dias_credito;
	                        $intLimiteCredito = $arrCol->limite_credito;
	                        $intSaldo = $intSaldoOrdenCompra;
	                        //Incrementar acumulado del saldo
	                        $intAcumSaldo += $intSaldoOrdenCompra;
	                        //Limpiar las siguientes variables (por cada proveedor recorrido)
	                        $intSaldoVencido = 0;
	                        $intSaldo30Dias = 0;
	                        $intSaldo60Dias = 0;
	                        $intSaldo90Dias = 0;
	                        $intSaldoMayorA90Dias = 0;
	                        $intAcumAnticipos =  0;
	                        $arrDetalles = array();
	                        
	                        //Si la fecha de vencimiento es menor que la fecha de corte
	                        if ($dteFechaVencimiento < $dteFechaCorte)
	                        {
	                        	//Asignar saldo de la orden de compra
	                            $intSaldoVencido = $intSaldoOrdenCompra;
	                            //Incrementar acumulado del saldo vencido
	                            $intAcumSaldoVencido += $intSaldoOrdenCompra;
	                        }
	                        else if (($dteFechaVencimiento >= $dteFechaCorte) && 
	                        		 ($dteFechaVencimiento <= $dteFechaR30Dias))
	                        {
	                        	//Incrementar el saldo por vencer en 30 días
	                            $intSaldo30Dias += $intSaldoOrdenCompra;
	                        	//Incrementar acumulado del saldo por vencer en 30 días
	                        	$intAcumSaldo30Dias += $intSaldoOrdenCompra;
	                   		}
		                    else if (($dteFechaVencimiento > $dteFechaR30Dias) && 
		                    		 ($dteFechaVencimiento <= $dteFechaR60Dias))
		                    {
		                    	//Incrementar el saldo por vencer en 60 días
	                            $intSaldo60Dias += $intSaldoOrdenCompra;
		                    	//Incrementar acumulado del saldo por vencer en 60 días
		                        $intAcumSaldo60Dias += $intSaldoOrdenCompra;
		                    }
			                else if (($dteFechaVencimiento > $dteFechaR60Dias) && 
			                		 ($dteFechaVencimiento <= $dteFechaR90Dias))
			                {
		                        
		                        //Incrementar el saldo por vencer en 90 días
	                            $intSaldo90Dias += $intSaldoOrdenCompra;
		                        //Incrementar acumulado del saldo por vencer en 90 días
		                        $intAcumSaldo90Dias += $intSaldoOrdenCompra;
		                    }
		                    else
		                    {
		                    	//Incrementar el saldo por vencer mayor a 90 días
	                            $intSaldoMayorA90Dias += $intSaldoOrdenCompra;
		                    	//Incrementar acumulado del saldo por vencer mayor a 90 días
		                        $intAcumSaldoMayorA90Dias += $intSaldoOrdenCompra;
		                    } 

						}
						else
						{
							//Incrementar acumulados
							$intSaldo += $intSaldoOrdenCompra;
	                        $intAcumSaldo +=  $intSaldoOrdenCompra;

	                        //Si la fecha de vencimiento es menor que la fecha de corte
	                        if ($dteFechaVencimiento < $dteFechaCorte)
	                        {
	                        	//Incrementar el saldo vencido
	                            $intSaldoVencido += $intSaldoOrdenCompra;
	                            //Incrementar acumulado del saldo vencido
	                            $intAcumSaldoVencido += $intSaldoOrdenCompra;
	                        }
	                        else if (($dteFechaVencimiento >= $dteFechaCorte) && 
	                        		 ($dteFechaVencimiento <= $dteFechaR30Dias))
	                        {
	                        	//Incrementar el saldo por vencer en 30 días
	                            $intSaldo30Dias += $intSaldoOrdenCompra;
	                        	//Incrementar acumulado del saldo por vencer en 30 días
	                        	$intAcumSaldo30Dias += $intSaldoOrdenCompra;
	                   		}
		                    else if (($dteFechaVencimiento > $dteFechaR30Dias) && 
		                    		 ($dteFechaVencimiento <= $dteFechaR60Dias))
		                    {
		                    	//Incrementar el saldo por vencer en 60 días
	                            $intSaldo60Dias += $intSaldoOrdenCompra;
		                    	//Incrementar acumulado del saldo por vencer en 60 días
		                        $intAcumSaldo60Dias += $intSaldoOrdenCompra;
		                    }
			                else if (($dteFechaVencimiento > $dteFechaR60Dias) && 
			                		 ($dteFechaVencimiento <= $dteFechaR90Dias))
			                {
		                        
		                        //Incrementar el saldo por vencer en 90 días
	                            $intSaldo90Dias += $intSaldoOrdenCompra;
		                        //Incrementar acumulado del saldo por vencer en 90 días
		                        $intAcumSaldo90Dias += $intSaldoOrdenCompra;
		                    }
		                    else
		                    {
		                    	//Incrementar el saldo por vencer mayor a 90 días
	                            $intSaldoMayorA90Dias += $intSaldoOrdenCompra;
		                    	//Incrementar acumulado del saldo por vencer mayor a 90 días
		                        $intAcumSaldoMayorA90Dias += $intSaldoOrdenCompra;
		                    }
						}


						//Si se cumple la sentencia mostrar detalles del registro
						if($strDetalles == 'SI')
						{
							//Array que se utiliza para agregar los datos de una orden de compra
			       			$arrAuxiliar = array();

							//Variables que se utilizan para asignar el saldo vencido de la orden de compra
							$intSaldoVencidoOrden = 0;
							$intSaldo30DiasOrden = 0;
	                        $intSaldo60DiasOrden = 0;
	                        $intSaldo90DiasOrden = 0;
	                        $intSaldoMayorA90DiasOrden = 0;
	                   		//Variable que se utiliza para asignar el número de días vencidos
							$intDiasVencidos = "";

	                   		//Si la fecha de vencimiento es menor que la fecha de corte
	                        if ($dteFechaVencimiento < $dteFechaCorte)
	                        {
	                        	//Asignar saldo de la orden de compra
	                            $intSaldoVencidoOrden = $intSaldoOrdenCompra;
	                            //Hacer un llamado a la función para calcular los días vencidos
	                   			$intDiasVencidos = $this->get_dias_vencidos($dteFechaCorte, $dteFechaVencimiento);
	                        }
	                        else if (($dteFechaVencimiento >= $dteFechaCorte) && 
	                        		 ($dteFechaVencimiento <= $dteFechaR30Dias))
	                        {
	                        	//Asignar el saldo por vencer en 30 días
	                            $intSaldo30DiasOrden = $intSaldoOrdenCompra;
	                   		}
		                    else if (($dteFechaVencimiento > $dteFechaR30Dias) && 
		                    		 ($dteFechaVencimiento <= $dteFechaR60Dias))
		                    {
		                    	//Asignar el saldo por vencer en 60 días
	                            $intSaldo60DiasOrden = $intSaldoOrdenCompra;
		                    }
			                else if (($dteFechaVencimiento > $dteFechaR60Dias) && 
			                		 ($dteFechaVencimiento <= $dteFechaR90Dias))
			                {
		                        
		                        //Asignar el saldo por vencer en 90 días
	                            $intSaldo90DiasOrden = $intSaldoOrdenCompra;
		                    }
		                    else
		                    {
		                    	//Asignar el saldo por vencer mayor a 90 días
	                            $intSaldoMayorA90DiasOrden = $intSaldoOrdenCompra;
		                    } 

							//Definir valores del array auxiliar de información (para cada detalle)
							$arrAuxiliar["folio"] = $arrCol->folio;
							$arrAuxiliar["tipo_referencia"] = $arrCol->tipo_referencia;
							$arrAuxiliar["fecha"] = $arrCol->fecha_format;
							$arrAuxiliar["fecha_vencimiento"] = $arrCol->fecha_vencimiento_format;
							$arrAuxiliar["saldo"] = $intSaldoOrdenCompra;
							$arrAuxiliar["saldo_vencido"] = $intSaldoVencidoOrden;
							$arrAuxiliar["dias_vencidos"] = $intDiasVencidos;
							$arrAuxiliar["saldo_30Dias"] = $intSaldo30DiasOrden;
							$arrAuxiliar["saldo_60Dias"] = $intSaldo60DiasOrden;
							$arrAuxiliar["saldo_90Dias"] = $intSaldo90DiasOrden;
							$arrAuxiliar["saldo_mayorA90Dias"] = $intSaldoMayorA90DiasOrden;
							//Asignar datos al array
	                        array_push($arrDetalles, $arrAuxiliar); 
						}

					}//Cierre de verificación del saldo

			}

			//Escribir los acumulados del último proveedor 
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

					//Decrementar saldos y acumulados
                    $intSaldo -=  $intAcumAnticipos;
               		$intAcumSaldo -= $intAcumAnticipos;

               		//Si existe saldo vencido
                    if($intSaldoVencido > 0)
                    {
                    	$intSaldoVencido -= $intAcumAnticipos;
                    	$intAcumSaldoVencido -= $intAcumAnticipos;
                	}
                	else if($intSaldo30Dias > 0)//Si existe saldo por vencer en 30 días
                	{
                		$intSaldo30Dias -= $intAcumAnticipos;
                		$intAcumSaldo30Dias -= $intAcumAnticipos;
                	}
                	else if($intSaldo60Dias > 0)//Si existe saldo por vencer en 60 días
                	{
                		$intSaldo60Dias -= $intAcumAnticipos;
                		$intAcumSaldo60Dias -= $intAcumAnticipos;

                	}
                	else if($intSaldo90Dias > 0)//Si existe saldo por vencer en 90 días
                	{
                		$intSaldo90Dias -= $intAcumAnticipos;
                		$intAcumSaldo90Dias -= $intAcumAnticipos;
                	}
                	else //Si existe saldo por vencer mayor a 90 días
                	{
                		$intSaldoMayorA90Dias -= $intAcumAnticipos;
                		$intAcumSaldoMayorA90Dias -= $intAcumAnticipos;
                	}

				}//Cierre de verificación de anticipos

   				//Definir valores del array auxiliar de información (para cada proveedor)
				$arrAuxiliar["proveedor"] = $strProveedor;
				$arrAuxiliar["dias_credito"] = $intCreditoDias;
				$arrAuxiliar["limite_credito"] = $intLimiteCredito;
				$arrAuxiliar["saldo"] = $intSaldo;
				$arrAuxiliar["saldo_vencido"] = $intSaldoVencido;
				$arrAuxiliar["saldo_30Dias"] = $intSaldo30Dias;
				$arrAuxiliar["saldo_60Dias"] = $intSaldo60Dias;
				$arrAuxiliar["saldo_90Dias"] = $intSaldo90Dias;
				$arrAuxiliar["saldo_mayorA90Dias"] = $intSaldoMayorA90Dias;
				$arrAuxiliar["acumulado_anticipos"] = $intAcumAnticipos;
				$arrAuxiliar["detalles"] = $arrDetalles;
                //Agregar datos al array
                array_push($arrProveedores, $arrAuxiliar); 

		    }


			$arrDatos['rows'] = $arrProveedores;
		    $arrDatos['acumulado_saldo'] = $intAcumSaldo;
			$arrDatos['acumulado_saldo_vencido'] = $intAcumSaldoVencido;
			$arrDatos['acumulado_saldo_30Dias'] = $intAcumSaldo30Dias;
			$arrDatos['acumulado_saldo_60Dias'] = $intAcumSaldo60Dias;
			$arrDatos['acumulado_saldo_90Dias'] = $intAcumSaldo90Dias;
			$arrDatos['acumulado_saldo_mayorA90Dias'] = $intAcumSaldoMayorA90Dias;

		}//Cierre de verificación de ordenes de compra con adeudo


		//Regresar array con los saldos vencidos y por vencer de los proveedores
		return $arrDatos;
	}

}