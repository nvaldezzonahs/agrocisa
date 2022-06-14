<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_facturas_adeudos extends MY_Controller {
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
		//Cargamos el modelo de sucursales
		$this->load->model('administracion/sucursales_model', 'sucursales');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('cuentas_cobrar/rep_facturas_adeudos', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con las facturas que tienen adeudos
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte = $this->input->post('dteFechaCorte');
		$intProspectoID = $this->input->post('intProspectoID');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strModulos = trim($this->input->post('strModulos'));

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

		//Si existe id del cliente
		if($intProspectoID > 0)
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado de facturas con adeudos de un cliente
			$this->get_reporte_cliente($strSucursales, $strModulos, $strTituloSucursales, 
									   $strTituloModulos, $dteFechaCorte, $intProspectoID);
		}
		else
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado general de facturas con adeudos
			$this->get_reporte_general($strSucursales, $strModulos, $strTituloSucursales, 
									   $strTituloModulos, $dteFechaCorte);
		}
		
	}

	//Método para generar un reporte PDF con el listado de facturas con adeudos de un cliente
    public function get_reporte_cliente($strSucursales, $strModulos, $strTituloSucursales, 
									    $strTituloModulos, $dteFechaCorte, $intProspectoID)
    {
    	
	    //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Variable que se utiliza para asignar los días de crédito en Maquinaria
	    $intDiasCreditoMaquinaria = 0;
	    //Variable que se utiliza para asignar el límite de crédito en Maquinaria
	    $intLimiteCreditoMaquinaria = 0;
	    //Variable que se utiliza para asignar los días de crédito en Refacciones
	    $intDiasCreditoRefacciones = 0;
	    //Variable que se utiliza para asignar el límite de crédito en Refacciones
	    $intLimiteCreditoRefacciones = 0;
	    //Variable que se utiliza para asignar los días de crédito en Servicio
	    $intDiasCreditoServicio = 0;
	    //Variable que se utiliza para asignar el límite de crédito en Servicio
	    $intLimiteCreditoServicio = 0;
	    //Array que se utiliza para agregar los datos de las facturas
	    $arrFacturas = array();
	    //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFechaCorte = $this->get_fecha_formato_letra($dteFechaCorte, 'C');

	    //Seleccionar los datos del cliente que coincide con el id
		$otdCliente = $this->clientes->buscar($intProspectoID);

		//Asignación de valores crediticios del cliente
		$intDiasCreditoMaquinaria = $otdCliente->maquinaria_credito_dias;
    	$intLimiteCreditoMaquinaria = $otdCliente->maquinaria_credito_limite_rep;
    	$intDiasCreditoRefacciones = $otdCliente->refacciones_credito_dias;
    	$intLimiteCreditoRefacciones = $otdCliente->refacciones_credito_limite_rep;
    	$intDiasCreditoServicio = $otdCliente->servicio_credito_dias;
    	$intLimiteCreditoServicio = $otdCliente->servicio_credito_limite_rep;

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
		$arrAnchuraTotales = array(34, 30, 33, 30, 33, 30);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('L', 'L', 'L', 'L', 'L', 'L');
		//Datos del primer título del reporte 
		$strTituloLinea1 = 'FACTURAS CON ADEUDOS EN ';
		$strTituloFechaCorte = 'FECHA DE CORTE: '.$strTituloFechaCorte;
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
	    $pdf->strLinea1 = $strTituloLinea1.'     '.$strTituloFechaCorte;
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
				$intAcumSaldo = 0;
				$intAcumSaldoVencido = 0;
				$arrFacturas = array();

				//Asignar objeto con el saldo del cliente en la fecha de corte
				$otdSaldoCliente = $this->get_saldo_clientes($dteFechaCorte, $intMonedaID,  
														     $strSucursales, $strModulos, $intProspectoID);

				//Asignar array con los datos de las facturas
				$arrFacturas = $otdSaldoCliente['rows'];
				//Asignar el acumulado del saldo de los clientes
				$intAcumSaldo =  $otdSaldoCliente['acumulado_saldo'];
				//Asignar el acumulado del saldo vencido de los clientes
				$intAcumSaldoVencido =  $otdSaldoCliente['acumulado_saldo_vencido'];

				//Si existe saldo del cliente
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

					//Si hay información de las facturas
				    if($arrFacturas)
					{
					    //Recorremos el arreglo 
						foreach ($arrFacturas as $arrFra)
						{
							//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					   		$pdf->Row(array($arrFra['folio'], $arrFra['fecha'],
					   						$arrFra['tipo_referencia'],
					   						'$'.number_format($arrFra['importe'],2),
					   						'$'.number_format($arrFra['saldo'],2), 
					   						$arrFra['fecha_vencimiento'],
					   						$arrFra['dias_vencidos']), 
					    				    $pdf->arrAlineacion, 'ClippedCell');
						}

					}//Cierre de verificación de información 

					$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
					$pdf->Ln(1); //Deja un salto de línea


					//Escribir totales
		   			//Establece el ancho de las columnas
			    	$pdf->SetWidths($arrAnchuraTotales);
				    //Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';

	      			//Acumulado de los saldos
					$pdf->Row(array('SALDO:', 
									'$'.number_format($intAcumSaldo,2), 
									'SALDO VENCIDO:',
									'$'.number_format($intAcumSaldoVencido,2)), 
									  $arrAlineacionTotales, 'ClippedCell');
					//Días de crédito
					$pdf->Row(array(utf8_decode('DÍAS CRÉDITO MAQ.:'), 
		   							$intDiasCreditoMaquinaria,
		   							utf8_decode('DÍAS CRÉDITO REF.:'),
		   							$intDiasCreditoRefacciones, 
		   							utf8_decode('DÍAS CRÉDITO SERV.:'), 
		   							$intDiasCreditoServicio), 
				   					$arrAlineacionTotales, 'ClippedCell');

					//Límite de crédito
					$pdf->Row(array(utf8_decode('LÍMITE CRÉDITO MAQ.:'), 
		   							'$'.number_format($intLimiteCreditoMaquinaria,2),
		   							utf8_decode('LÍMITE CRÉDITO REF.:'),
		   							'$'.number_format($intLimiteCreditoRefacciones,2), 
		   							utf8_decode('LÍMITE CRÉDITO SERV.:'), 
		   							'$'.number_format($intLimiteCreditoServicio,2)), 
				   					$arrAlineacionTotales, 'ClippedCell');

	      			//Cambiar el volumen de la letra
    				$pdf->strTipoLetraTabla = 'Normal';

			    }//Cierre de verificación de información de saldo 
			}

		}//Cierre de verificación de monedas

		//Ejecutar la salida del reporte
        $pdf->Output('facturas_adeudos_'.$otdCliente->codigo.'.pdf','I'); 
    }


	//Método para generar un reporte PDF con el listado general de facturas con adeudos
	public function get_reporte_general($strSucursales, $strModulos, $strTituloSucursales, 
									    $strTituloModulos, $dteFechaCorte) 
	{	
		
	    //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Array que se utiliza para agregar los datos (saldos) de los clientes
	    $arrClientes = array();
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
		$pdf->arrCabecera = array('CLIENTE', 'SALDO FECHA',  'SALDO VENCIDO', 'FECHA VENCIDA', 
								  utf8_decode('DÍAS VENC.'));
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(87, 30, 30, 25, 18);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'R', 'R', 'C', 'R');
		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(87, 30, 30);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R');

		//Datos del primer título del reporte 
		$strTituloLinea1 = 'FACTURAS CON ADEUDOS EN ';
		$strTituloFechaCorte = 'FECHA DE CORTE: '.$strTituloFechaCorte;
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
	    $pdf->strLinea1 = $strTituloLinea1.'     '.$strTituloFechaCorte;
	    //Asignar el valor de la línea dos del título
		$pdf->strLinea2 = utf8_decode('SUCURSALES: '.trim($strTituloSucursales));
		//Asignar el valor de la línea tres del título
		$pdf->strLinea3 = utf8_decode('MÓDULOS: '.trim($strTituloModulos));
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
				$arrClientes = array();

				//Asignar objeto con el saldo de los clientes en la fecha de corte
				$otdSaldoClientes = $this->get_saldo_clientes($dteFechaCorte, $intMonedaID,  
														      $strSucursales, $strModulos);
				//Asignar array con los datos de los clientes
				$arrClientes = $otdSaldoClientes['rows'];
				//Asignar el acumulado del saldo de los clientes
				$intAcumSaldo =  $otdSaldoClientes['acumulado_saldo'];
				//Asignar el acumulado del saldo vencido de los clientes
				$intAcumSaldoVencido =  $otdSaldoClientes['acumulado_saldo_vencido'];

				//Si existe saldo de los clientes
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

					//Si hay información de clientes
				    if($arrClientes)
					{
					    //Recorremos el arreglo 
						foreach ($arrClientes as $arrSal)
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
					   		$pdf->Row(array(utf8_decode($arrSal['cliente']), 
					   						'$'.number_format($arrSal['saldo'],2),
					   						$intSaldoVencido, 
					   						$arrSal['fecha_vencimiento'],
					   						$arrSal['dias_vencidos']), 
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
        $pdf->Output('facturas_adeudos_general.pdf','I'); 
	}


	/*Método para generar un archivo XLS con las facturas que tienen adeudos
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte = $this->input->post('dteFechaCorte');
		$intProspectoID = $this->input->post('intProspectoID');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strModulos = trim($this->input->post('strModulos'));

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

		//Si existe id del cliente
		if($intProspectoID > 0)
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado de facturas con adeudos de un cliente
			$this->get_xls_cliente($strSucursales, $strModulos, $strTituloSucursales, 
								   $strTituloModulos, $dteFechaCorte, $intProspectoID);
		}
		else
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado general de facturas con adeudos
			$this->get_xls_general($strSucursales, $strModulos, $strTituloSucursales, 
								   $strTituloModulos, $dteFechaCorte);
		}
	}


	//Método para generar un archivo XLS con el listado de facturas con adeudos de un cliente
    public function get_xls_cliente($strSucursales, $strModulos, $strTituloSucursales, 
									$strTituloModulos, $dteFechaCorte, $intProspectoID)
    {
    	
    	//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 12;
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
	      //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Variable que se utiliza para asignar los días de crédito en Maquinaria
	    $intDiasCreditoMaquinaria = 0;
	    //Variable que se utiliza para asignar el límite de crédito en Maquinaria
	    $intLimiteCreditoMaquinaria = 0;
	    //Variable que se utiliza para asignar los días de crédito en Refacciones
	    $intDiasCreditoRefacciones = 0;
	    //Variable que se utiliza para asignar el límite de crédito en Refacciones
	    $intLimiteCreditoRefacciones = 0;
	    //Variable que se utiliza para asignar los días de crédito en Servicio
	    $intDiasCreditoServicio = 0;
	    //Variable que se utiliza para asignar el límite de crédito en Servicio
	    $intLimiteCreditoServicio = 0;
	   //Array que se utiliza para agregar los datos de las facturas
	    $arrFacturas = array();
	    //Variable que se utiliza para asignar el número de registros por cada moneda
		$intNumRegistros = 0; 
		//Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última moneda)
		$intNumMaxRegistros = 0;
	    //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFechaCorte = $this->get_fecha_formato_letra($dteFechaCorte, 'C');

		//Datos del primer título del reporte 
		$strTituloLinea1 = 'FACTURAS CON ADEUDOS EN ';
		$strTituloFechaCorte = 'FECHA DE CORTE: '.$strTituloFechaCorte;


		//Seleccionar los datos del cliente que coincide con el id
		$otdCliente = $this->clientes->buscar($intProspectoID);

		//Asignación de valores crediticios del cliente
		$intDiasCreditoMaquinaria = $otdCliente->maquinaria_credito_dias;
    	$intLimiteCreditoMaquinaria = $otdCliente->maquinaria_credito_limite_rep;
    	$intDiasCreditoRefacciones = $otdCliente->refacciones_credito_dias;
    	$intLimiteCreditoRefacciones = $otdCliente->refacciones_credito_limite_rep;
    	$intDiasCreditoServicio = $otdCliente->servicio_credito_dias;
    	$intLimiteCreditoServicio = $otdCliente->servicio_credito_limite_rep;


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
				$strNombreHoja = 'facturas con adeudos '.$arrMon->codigo;
				//Inicializar variables
				$intAcumSaldo = 0;
				$intAcumSaldoVencido = 0;
				$arrFacturas = array();

				//Asignar objeto con el saldo del cliente en la fecha de corte
				$otdSaldoCliente = $this->get_saldo_clientes($dteFechaCorte, $intMonedaID,  
														     $strSucursales, $strModulos, $intProspectoID);

				//Asignar array con los datos de las facturas
				$arrFacturas = $otdSaldoCliente['rows'];
				//Asignar el acumulado del saldo de los clientes
				$intAcumSaldo =  $otdSaldoCliente['acumulado_saldo'];
				//Asignar el acumulado del saldo vencido de los clientes
				$intAcumSaldoVencido =  $otdSaldoCliente['acumulado_saldo_vencido'];

				//Concatenar datos para el primer encabezado del reporte
				$strEncabezado = $strTituloLinea1.'     '.$strTituloFechaCorte;
				//Se agrega el título del archivo
				$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);
				$objExcel->getActiveSheet()->setCellValue('A8', 'SUCURSALES: '.$strTituloSucursales);
				$objExcel->getActiveSheet()->setCellValue('A9', 'MÓDULOS: '.$strTituloModulos);
				$objExcel->getActiveSheet()->setCellValue('A10', 'CLIENTE: '.$otdCliente->codigo.' - '.$otdCliente->razon_social);

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

				//Si existe saldo del cliente
				if($intAcumSaldo > 0)
				{
					//Número de fila donde se va a comenzar a rellenar
				    $intFila = 13;
				    $intFilaInicial = 13;

				    //Asignar el número de registros
					$intNumRegistros = count($arrFacturas);

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
					$strTituloLinea1 = 'FACTURAS CON ADEUDOS EN '.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$strEncabezado = $strTituloLinea1.'     '.$strTituloFechaCorte;

					//Se agrega el título del archivo
					$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);
					
			        //Si hay información de las facturas
				    if($arrFacturas)
					{
					    //Recorremos el arreglo 
						foreach ($arrFacturas as $arrFra)
						{
					   		//Agregar información de la factura
				            $objExcel->getActiveSheet()
			                         ->setCellValue('A'.$intFila, $arrFra['folio'])
			                         ->setCellValue('B'.$intFila, $arrFra['fecha'])
			                         ->setCellValue('C'.$intFila, $arrFra['tipo_referencia'])
			                         ->setCellValue('D'.$intFila, $arrFra['importe'])
			                         ->setCellValue('E'.$intFila, $arrFra['saldo'])
			                         ->setCellValue('F'.$intFila, $arrFra['fecha_vencimiento'])
			                         ->setCellValue('G'.$intFila, $arrFra['dias_vencidos']);

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

		            //Escribir totales
		        	//Agregar información del saldo
					$objExcel->getActiveSheet()
	                         ->setCellValue('A'.$intFila, 'SALDO:')
	                         ->setCellValue('B'.$intFila, $intAcumSaldo)
	                         ->setCellValue('C'.$intFila, 'SALDO VENCIDO:')
	                         ->setCellValue('D'.$intFila, $intAcumSaldoVencido);

	              
	                //Cambiar contenido de las celdas a formato moneda
	           		$objExcel->getActiveSheet()
		            		 ->getStyle('B'.$intFila.':'.'D'.$intFila)
		            		 ->getNumberFormat()
		            		 ->setFormatCode('$#,##0.00');


	                //Incrementar el indice para escribir días de crédito
			        $intFila++;

	                //Agregar información de los días de crédito
					$objExcel->getActiveSheet()
	                         ->setCellValue('A'.$intFila, 'DÍAS CRÉDITO MAQ.:')
	                         ->setCellValue('B'.$intFila,  $intDiasCreditoMaquinaria)
	                         ->setCellValue('C'.$intFila, 'DÍAS CRÉDITO REF.:')
	                         ->setCellValue('D'.$intFila, $intDiasCreditoRefacciones)
	                         ->setCellValue('E'.$intFila, 'DÍAS CRÉDITO SERV.:')
	                         ->setCellValue('F'.$intFila, $intDiasCreditoServicio);


	                //Incrementar el indice para escribir límite de crédito
			        $intFila++;

	                //Agregar información de los límites de crédito
					$objExcel->getActiveSheet()
	                         ->setCellValue('A'.$intFila, 'LÍMITE CRÉDITO MAQ.:')
	                         ->setCellValue('B'.$intFila, $intLimiteCreditoMaquinaria)
	                         ->setCellValue('C'.$intFila, 'LÍMITE CRÉDITO REF.:')
	                         ->setCellValue('D'.$intFila, $intLimiteCreditoRefacciones)
	                         ->setCellValue('E'.$intFila, 'LÍMITE CRÉDITO SERV.:')
	                         ->setCellValue('F'.$intFila, $intLimiteCreditoServicio);


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
				    if($intNumRegistros > $intNumMaxRegistros)
		            {
		            	//Asignar número de registros
		            	$intNumMaxRegistros = $intNumRegistros;
		            }


				}//Cierre de verificación de información de saldo 

			}

		}//Cierre de verificación de monedas


		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'facturas_adeudos_'.$otdCliente->codigo.'.xls', 'facturas con adeudos', $intNumMaxRegistros);
    }


    //Método para generar un archivo XLS con el listado general de facturas con adeudos
    public function get_xls_general($strSucursales, $strModulos, $strTituloSucursales, 
									$strTituloModulos, $dteFechaCorte)
    {
    	//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 11;
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Array que se utiliza para agregar los datos (saldos) de los clientes
	    $arrClientes = array();
	    //Variable que se utiliza para asignar el número de registros por cada moneda
		$intNumRegistros = 0; 
		//Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última moneda)
		$intNumMaxRegistros = 0;
	    //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFechaCorte = $this->get_fecha_formato_letra($dteFechaCorte, 'C');

		//Concatenar datos para el primer encabezado del reporte
		$strTituloLinea1 = 'FACTURAS CON ADEUDOS EN ';
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
				$strNombreHoja = 'facturas con adeudos '.$arrMon->codigo;
				//Inicializar variables
				$intAcumSaldo = 0;
				$intAcumSaldoVencido = 0;
				$arrClientes = array();

				//Asignar objeto con el saldo de los clientes en la fecha de corte
				$otdSaldoClientes = $this->get_saldo_clientes($dteFechaCorte, $intMonedaID,  
														      $strSucursales, $strModulos);

			    //Asignar array con los datos de los clientes
				$arrClientes = $otdSaldoClientes['rows'];
				//Asignar el acumulado del saldo de los clientes
				$intAcumSaldo =  $otdSaldoClientes['acumulado_saldo'];
				//Asignar el acumulado del saldo vencido de los clientes
				$intAcumSaldoVencido =  $otdSaldoClientes['acumulado_saldo_vencido'];

				//Concatenar datos para el primer encabezado del reporte
				$strEncabezado = $strTituloLinea1.'     '.$strTituloFechaCorte;

				//Se agrega el título del archivo
				$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);
				$objExcel->getActiveSheet()->setCellValue('A8', 'SUCURSALES: '.$strTituloSucursales);
				$objExcel->getActiveSheet()->setCellValue('A9', 'MÓDULOS: '.$strTituloModulos);

				//Se agregan las columnas de cabecera
		        $objExcel->getActiveSheet()->setCellValue('A'.$intPosEncabezados, 'CLIENTE')
		                 ->setCellValue('B'.$intPosEncabezados, 'SALDO FECHA')
		                 ->setCellValue('C'.$intPosEncabezados, 'SALDO VENCIDO')
		                 ->setCellValue('D'.$intPosEncabezados, 'FECHA VENCIDA')
		                 ->setCellValue('E'.$intPosEncabezados, 'DÍAS VENCIDOS');

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
		    			 ->getStyle('A11:E11')
		    			 ->getFill()
		    			 ->applyFromArray($arrStyleColumnas);
		     
		    	//Preferencias de color de texto de la celda
		        $objExcel->getActiveSheet()
		    			 ->getStyle('A9:D9')
		    			 ->applyFromArray($arrStyleFuenteColumnasPrinc);

		    	$objExcel->getActiveSheet()
		    			 ->getStyle('A11:E11')
		    			 ->applyFromArray($arrStyleFuenteColumnas);

		    	//Cambiar alineación de las siguientes celdas
		    	$objExcel->getActiveSheet()
		            	 ->getStyle('A9:D9')
		            	 ->getAlignment()
		            	 ->applyFromArray($arrStyleAlignmentLeft);

		    	$objExcel->getActiveSheet()
		            	 ->getStyle('A11:E11')
		            	 ->getAlignment()
		            	 ->applyFromArray($arrStyleAlignmentCenter);

				//Si existe saldo de los clientes
				if($intAcumSaldo > 0)
				{
					//Número de fila donde se va a comenzar a rellenar
				    $intFila = 12;
				    $intFilaInicial = 12;

				    //Asignar el número de registros
					$intNumRegistros = count($arrClientes);

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
					$strTituloLinea1 = 'FACTURAS CON ADEUDOS EN '.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$strEncabezado = $strTituloLinea1.'     '.$strTituloFechaCorte;


					//Se agrega el título del archivo
					$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);

			        //Si hay información de clientes
				    if($arrClientes)
					{
					    //Recorremos el arreglo 
						foreach ($arrClientes as $arrSal)
						{

					   		//Agregar información del cliente
				            $objExcel->getActiveSheet()
			                         ->setCellValue('A'.$intFila, $arrSal['cliente'])
			                         ->setCellValue('B'.$intFila, $arrSal['saldo'])
			                         ->setCellValue('C'.$intFila, $arrSal['saldo_vencido'])
			                         ->setCellValue('D'.$intFila, $arrSal['fecha_vencimiento'])
			                         ->setCellValue('E'.$intFila, $arrSal['dias_vencidos']);

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
	                         ->setCellValue('A'.$intFila, 'TOTALES:')
	                         ->setCellValue('B'.$intFila, $intAcumSaldo)
	                         ->setCellValue('C'.$intFila, $intAcumSaldoVencido);


                   //Cambiar contenido de las celdas a formato moneda
	           		$objExcel->getActiveSheet()
		            		 ->getStyle('B'.$intFilaInicial.':'.'C'.$intFila)
		            		 ->getNumberFormat()
		            		 ->setFormatCode('$#,##0.00');


	             	//Cambiar alineación de las siguientes celdas
		    		$objExcel->getActiveSheet()
				        	 ->getStyle('B'.$intFilaInicial.':'.'C'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

				    $objExcel->getActiveSheet()
				        	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentCenter);

				    $objExcel->getActiveSheet()
				        	 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

				    //Cambiar estilo de las siguientes celdas
			        $objExcel->getActiveSheet()
			            		 ->getStyle('A'.$intFila.':'.'C'.$intFila)
			            		 ->applyFromArray($arrStyleBold);


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
        $this->get_pie_pagina_archivo_excel($objExcel, 'facturas_adeudos_general.xls', 'facturas con adeudos', $intNumMaxRegistros);
    }


    //Función que se utiliza para regresar clientes con saldo en la fecha de corte
	public function get_saldo_clientes($dteFechaCorte, $intMonedaID, $strSucursales, $strModulos, 
									   $intProspectoBusqID = NULL)
	{
		//Array que se utiliza para enviar datos
		$arrDatos = array('rows' => NULL, 
						  'acumulado_saldo' => '0.00',
						  'acumulado_saldo_vencido' => '0.00');

	    //Variable que se utiliza pra asignar el id actual del cliente
	    $intProspectoIDActual = 0;
	    //Variable que se utiliza pra asignar la fecha vencida
	    $strFecha = '';
	    //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Array que se utiliza para agregar los datos de los clientes
        $arrClientes = array();
        //Array que se utiliza para agregar los datos de un cliente
        $arrAuxiliar = array();
       

		//Seleccionar los datos de las facturas (con saldo) que coinciden con el parámetro enviado
		$otdResultado = $this->pagos->buscar_facturas_importes('reporte', $dteFechaCorte, $intProspectoBusqID, 
																NULL, $intMonedaID, NULL, NULL, NULL,
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
				//if (($intSaldoFactura >= 1) OR ($intSaldoFactura <= -1)) //Validación anterior
				if($intSaldoFactura > 0)
				{
					
                    //Si no existe id del prospecto, significa que se van a obtener los datos para el reporte general
                    if($intProspectoBusqID == NULL)
                    {
                    	//Si el cliente actual es diferente al anterior
						if ($intProspectoIDActual != $arrCol->prospecto_id)
						{
							//Si existe id del cliente actual
							if ($intProspectoIDActual > 0)
							{
								//Si existe fecha vencida
	                            if ($dteFechaVencimiento != "")
	                            {
	                            	//Separar fecha vencida
	                                $strFecha = substr($dteFechaVencimiento, 8, 2)."/";
	                                $strFecha.= substr($dteFechaVencimiento, 5, 2)."/";
	                                $strFecha.= substr($dteFechaVencimiento, 0, 4);
	                            }

	                            //Definir valores del array auxiliar de información (para cada cliente)
								$arrAuxiliar["cliente"] = $strCliente;
								$arrAuxiliar["saldo"] = $intSaldo;
								$arrAuxiliar["saldo_vencido"] = $intSaldoVencido;
								$arrAuxiliar["fecha_vencimiento"] = $strFecha;
								$arrAuxiliar["dias_vencidos"] = $intDiasVencidos;
				                //Agregar datos al array
				                array_push($arrClientes, $arrAuxiliar);

							}

							//Asignar valores del cliente
							$intProspectoIDActual = $arrCol->prospecto_id;
	                        $strCliente = $arrCol->razon_social;
	                        $intCreditoDias = $arrCol->dias_credito;
	                        $intSaldo = $intSaldoFactura;
	                        //Incrementar acumulado del saldo
	                        $intAcumSaldo += $intSaldoFactura;
	                        //Limpiar las siguientes variables (por cada cliente recorrido)
	                        $intSaldoVencido = "";
	                        $dteFechaVencimiento = "";
	                        $intDiasVencidos = "";
	                        $strFecha = "";

	                        //Si la fecha de vencimiento es menor que la fecha de corte
	                        if ($arrCol->fecha_vencimiento < $dteFechaCorte)
	                        {
	                        	//Asignar saldo de la factura
	                            $intSaldoVencido = $intSaldoFactura;
	                            //Incrementar acumulado del saldo vencido
	                            $intAcumSaldoVencido += $intSaldoFactura;
	                            //Asignar fecha de vencimiento de la factura
	                            $dteFechaVencimiento = $arrCol->fecha_vencimiento;
	                            //Hacer un llamado a la función para calcular los días vencidos
	                        	$intDiasVencidos = $this->get_dias_vencidos($dteFechaCorte, $dteFechaVencimiento);
	                        }

	                        //Asignar fecha de la factura
			                $strFechaUltVencimiento = $arrCol->fecha;

						}
						else
						{
							//Incrementar acumulados
							$intSaldo += $intSaldoFactura;
			                $intAcumSaldo += $intSaldoFactura;

			                //Si la fecha de vencimiento es menor que la fecha de corte
	                        if ($arrCol->fecha_vencimiento < $dteFechaCorte)
	                        {
	                        	//Incrementar el saldo vencido
			                    $intSaldoVencido += $intSaldoFactura;
	                            //Incrementar acumulado del saldo vencido
	                            $intAcumSaldoVencido += $intSaldoFactura;

	                            //Si la fecha de vencimiento es menor que la fecha vencida
	                            if (($arrCol->fecha_vencimiento < $dteFechaVencimiento) OR 
	                            	($dteFechaVencimiento == ""))
	                            {
	                            	//Asignar fecha de vencimiento de la factura
	                                $dteFechaVencimiento = $arrCol->fecha_vencimiento;
	                                //Hacer un llamado a la función para calcular los días vencidos
	                        		$intDiasVencidos = $this->get_dias_vencidos($dteFechaCorte, $dteFechaVencimiento);
	                            }
	                        }

	                        //Si la fecha es mayor que la última fecha de vencimiento
	                        if ($arrCol->fecha > $strFechaUltVencimiento)
	                        {
	                        	//Asignar fecha de la factura
	                            $strFechaUltVencimiento = $arrCol->fecha;
	                        }

						}

                    }
                    else //Obtener los datos para el reporte individual
                    {
                    	//Inicializar variables
	                    $intDiasVencidos = 0;
	                    //Asignar fecha de vencimiento de la factura
	                    $dteFechaVencimiento = $arrCol->fecha_vencimiento;

						//Si la fecha de vencimiento es menor que la fecha de corte
	                    if ($dteFechaVencimiento < $dteFechaCorte)
	                    {
	                        //Incrementar acumulado del saldo vencido
	                        $intAcumSaldoVencido += $intSaldoFactura;
	                        //Hacer un llamado a la función para calcular los días vencidos
	                        $intDiasVencidos = $this->get_dias_vencidos($dteFechaCorte, $dteFechaVencimiento);
	                    }

	                    //Definir valores del array auxiliar de información del cliente
						$arrAuxiliar["folio"] = $arrCol->folio;
						$arrAuxiliar["fecha"] = $arrCol->fecha_format;
						$arrAuxiliar["tipo_referencia"] = $arrCol->tipo_referencia;
						$arrAuxiliar["importe"] = $arrCol->importe;
						$arrAuxiliar["saldo"] = $intSaldoFactura;
						$arrAuxiliar["fecha_vencimiento"] = $arrCol->fecha_vencimiento_format;
						$arrAuxiliar["dias_vencidos"] = $intDiasVencidos;
		                //Agregar datos al array
		                array_push($arrClientes, $arrAuxiliar);

		                //Incrementar acumulado del saldo
                   		$intAcumSaldo += $intSaldoFactura;
                    }
                    

				}//Cierre de verificación del saldo

			}

			//Escribir los acumulados del último cliente (en caso de que sea el reporte general)
			if ($intProspectoIDActual > 0 && $intProspectoBusqID == NULL)
			{
				//Si existe fecha vencida
                if ($dteFechaVencimiento != "")
                {
                	//Separar fecha vencida
                    $strFecha = substr($dteFechaVencimiento, 8, 2)."/";
                    $strFecha.= substr($dteFechaVencimiento, 5, 2)."/";
                    $strFecha.= substr($dteFechaVencimiento, 0, 4);
                }

                //Definir valores del array auxiliar de información (para cada cliente)
				$arrAuxiliar["cliente"] = $strCliente;
				$arrAuxiliar["saldo"] = $intSaldo;
				$arrAuxiliar["saldo_vencido"] = $intSaldoVencido;
				$arrAuxiliar["fecha_vencimiento"] = $strFecha;
				$arrAuxiliar["dias_vencidos"] = $intDiasVencidos;
                //Agregar datos al array
                array_push($arrClientes, $arrAuxiliar);
			}

			//Agregar datos al array
		    $arrDatos['rows'] = $arrClientes;
		    $arrDatos['acumulado_saldo'] = $intAcumSaldo;
			$arrDatos['acumulado_saldo_vencido'] = $intAcumSaldoVencido;

		}//Cierre de verificación de facturas con adeudo

		//Regresar array con los saldos vencidos de los clientes
		return $arrDatos;
	}

}