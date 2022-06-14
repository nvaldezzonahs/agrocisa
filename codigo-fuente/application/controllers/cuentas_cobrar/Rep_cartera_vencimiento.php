<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_cartera_vencimiento extends MY_Controller {
	
	//Información que se utiliza para asignar los indices iniciales del archivo Excel
	var $archivoExcel = NULL;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();

		//Asignar el indice de la columna principal
	    $this->archivoExcel['intIndColInicial'] = 1;
	    //Asignar posición para escribir las descripciones de las columnas 
	    $this->archivoExcel['intPosEncabezados'] = 12;
	    //Asignar el número de fila donde se va a comenzar a rellenar
	    $this->archivoExcel['intFilaInicial'] = 14;
	    //Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de pagos
		$this->load->model('caja/pagos_model', 'pagos');
		//Cargamos el modelo de clientes
		$this->load->model('cuentas_cobrar/clientes_model', 'clientes');
		//Cargamos el modelo de monedas
		$this->load->model('contabilidad/sat_monedas_model', 'monedas');
	    //Cargamos el modelo de pedidos de maquinaria
		$this->load->model('maquinaria/pedidos_maquinaria_model', 'pedidos_maquinaria');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('cuentas_cobrar/rep_cartera_vencimiento', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con la cartera de vencimientos
	 *dependiendo de los criterios de búsqueda proporcionados*/ 
	public function get_reporte() 
	{
		
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte = $this->input->post('dteFechaCorte');
		$intProspectoID = $this->input->post('intProspectoID');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strModulos = trim($this->input->post('strModulos'));


		//Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo por vencer
	    $intAcumSaldoVencer = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido en 60 días
	    $intAcumSaldo60Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido en 90 días
	    $intAcumSaldo90Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido mayor a 90 días
	    $intAcumSaldoMayorA90Dias = 0;
		//Array que se utiliza para agregar los datos de las facturas
        $arrFacturas = array();
		//Array que se utiliza para agregar los datos de las sucursales
        $arrSucursales = array();
        //Array que se utiliza para agregar los datos de una sucursal
        $arrAuxiliar = array();

        //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFechaCorte = $this->get_fecha_formato_letra($dteFechaCorte, 'C');

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

			//Definir valores del array auxiliar de información (para cada sucursal)
			$arrAuxiliar["sucursal_id"] = $intSucursalID;
			$arrAuxiliar["nombre"] = $otdSucursal->nombre;
			 //Agregar datos al array
            array_push($arrSucursales, $arrAuxiliar);
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

		//Se crea una instancia de la clase PDF
		$pdf = new PDF('L','mm','legal');//orientación horizontal
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(210, 25, 25, 25, 25, 25);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R', 'R', 'R', 'R');

  		//Datos del primer título del reporte 
	    $strTituloLinea1 = 'CARTERA DE VENCIMIENTO  EN ';
	    $strTituloFechaCorte = 'FECHA DE CORTE: '.$strTituloFechaCorte;

	    //Asignar el valor de la descripción (título de la lista de registros) del reporte
	    $pdf->strLinea1 = $strTituloLinea1.'     '.$strTituloFechaCorte;
	    //Asignar el valor de la línea dos del título
		$pdf->strLinea2 = utf8_decode('SUCURSALES: '.trim($strTituloSucursales));
		//Asignar el valor de la línea tres del título
		$pdf->strLinea3 = utf8_decode('MÓDULOS: '.trim($strTituloModulos));

		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del cliente que coincide con el id
			$otdCliente = $this->clientes->buscar($intProspectoID);
			//Asignar el valor de la línea cuatro del título
			$pdf->strLinea4 =  'CLIENTE: '.utf8_decode($otdCliente->codigo.' - '.$otdCliente->razon_social);
		}

		//Establecer el color de línea
	    $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Seleccionar los datos de las monedas activas
		$otdMonedas = $this->monedas->buscar(NULL, NULL, NULL, 'ACTIVO');
		
		//Hacer recorrido para obtener el id de las sucursales
	    foreach ($arrSucursales as $arrSuc) 
	    {		    

	    	//Asignar el id de la sucursal actual
			$intSucursalID = $arrSuc['sucursal_id'];
			//Asignar el nombre de la sucursal
			$strSucursal = $arrSuc['nombre'];

	    	//Hacer recorrido para obtener las descripciones de los modulos 
		    foreach ($arrDescripcionesModulos as &$strModulo) 
		    {

	    		//Si hay información 
				if($otdMonedas)
				{
			    	//Recorremos el arreglo 
					foreach ($otdMonedas as $arrMon)
					{
						//Asignar el id de la moneda actual
						$intMonedaID = $arrMon->moneda_id;
						//Asignar la descripción de la moneda
						$strMoneda = strtoupper($arrMon->descripcion);
							
				    	//Inicializar variables
						$intAcumSaldo = 0;
						$intAcumSaldoVencer = 0;
						$intAcumSaldo60Dias = 0;
						$intAcumSaldo90Dias = 0;
						$intAcumSaldoMayorA90Dias = 0;
						$arrFacturas = array();

				    	//Asignar objeto con el saldo de los clientes en la fecha de corte
						$otdSaldoClientes = $this->get_saldo_clientes('PDF',$dteFechaCorte, $intMonedaID,  
														      		  $intSucursalID, $strModulo, 
														      		  $intProspectoID);

						//Asignar array con los datos de las facturas
						$arrFacturas = $otdSaldoClientes['rows'];
						//Asignar el acumulado del saldo de los clientes
						$intAcumSaldo =  $otdSaldoClientes['acumulado_saldo'];
						//Asignar el acumulado del saldo por vencer de los clientes
						$intAcumSaldoVencer =  $otdSaldoClientes['acumulado_saldo_vencer'];
						//Asignar el acumulado del saldo vencido en 60 días
						$intAcumSaldo60Dias =  $otdSaldoClientes['acumulado_saldo_60Dias'];
						//Asignar el acumulado del saldo vencido en 90 días
						$intAcumSaldo90Dias =  $otdSaldoClientes['acumulado_saldo_90Dias'];
						//Asignar el acumulado del saldo vencido mayor a 90 días
						$intAcumSaldoMayorA90Dias =  $otdSaldoClientes['acumulado_saldo_mayorA90Dias'];

						//Array que se utiliza para establecer los títulos de la cabecera
						$arrCabecera = array();
						//Array que se utiliza para establecer el ancho de las columnas de la cabecera
						$arrAnchura = array();
						//Array que se utiliza para establecer la alineación de la cabecera
						$arrAlineacion = array();

						//Array que se utiliza para establecer los títulos de la segunda cabecera
						$arrCabecera2 = array();
						//Array que se utiliza para establecer la alineación de la segunda cabecera
						$arrAnchura2 = array();
						//Array que se utiliza para establecer el ancho de las columnas de la segunda cabecera
						$arrAlineacion2 = array();
						//Variable que se utiliza para asignar el tamaño de la columna Cliente
					    $intTamColCliente = 141;

						//Dependiendo del módulo crear cabecera
						if ($strModulo == 'MAQUINARIA' OR $strModulo == 'REFACCIONES')
						{  
							//Definir anchura y alineación de la columna
							$intAnchuraCol = 64;
					   	    $strAlineacionCol = 'L';

							//Agregar datos a los arrays de la cabecera
							$arrCabecera[] = '';
							$arrAnchura[] = $intAnchuraCol;
							$arrAlineacion[] = $strAlineacionCol;

							//Agregar datos a los arrays de la segunda cabecera
							$arrCabecera2[] = 'VENDEDOR';
							$arrAnchura2[] =  $intAnchuraCol;
							$arrAlineacion2[] = $strAlineacionCol;
							//Cambiar el tamaño de la columna Cliente
							$intTamColCliente = 77;
						}

						//Agregar datos a los array de las cabeceras
						/****Cliente***/
					    $intAnchuraCol = $intTamColCliente;
					    $strAlineacionCol = 'L';
					    //Primer cabecera
					    $arrCabecera[] = '';
					    $arrAnchura[] = $intAnchuraCol;
					    $arrAlineacion[] = $strAlineacionCol;
					    //Segunda cabecera
					    $arrCabecera2[] = 'CLIENTE';
					    $arrAnchura2[] = $intAnchuraCol;
					    $arrAlineacion2[] = $strAlineacionCol;


					    /****Folio***/
					    $intAnchuraCol = 20;
					    $strAlineacionCol = 'L';
					    //Primer cabecera
					    $arrCabecera[] = '';
					    $arrAnchura[] = $intAnchuraCol;
					    $arrAlineacion[] = $strAlineacionCol;
					    //Segunda cabecera
					    $arrCabecera2[] = 'FOLIO';
					    $arrAnchura2[] = $intAnchuraCol;
					    $arrAlineacion2[] = $strAlineacionCol;

					    /****Fecha***/
					    $intAnchuraCol = 15;
					    $strAlineacionCol = 'C';
					    //Primer cabecera
					    $arrCabecera[] = '';
					    $arrAnchura[] = $intAnchuraCol;
					    $arrAlineacion[] = $strAlineacionCol;
					    //Segunda cabecera
					    $arrCabecera2[] = 'FECHA';
					    $arrAnchura2[] = $intAnchuraCol;
					    $arrAlineacion2[] = $strAlineacionCol;


					    /****Fecha de vencimiento***/
					    $intAnchuraCol = 18;
					    $strAlineacionCol = 'C';
					    //Primer cabecera
					    $arrCabecera[] = '';
					    $arrAnchura[] = $intAnchuraCol;
					    $arrAlineacion[] = $strAlineacionCol;
					    //Segunda cabecera
					    $arrCabecera2[] = 'FECHA VENC.';
					    $arrAnchura2[] = $intAnchuraCol;
					    $arrAlineacion2[] = $strAlineacionCol;


					    /****Días vencidos***/
					  	$intAnchuraCol = 16;
					    $strAlineacionCol = 'R';
					    //Primer cabecera
					    $arrCabecera[] = '';
					    $arrAnchura[] = $intAnchuraCol;
					    $arrAlineacion[] = $strAlineacionCol;
					    //Segunda cabecera
					    $arrCabecera2[] = utf8_decode('DÍAS VENC.');
					    $arrAnchura2[] = $intAnchuraCol;
					    $arrAlineacion2[] = $strAlineacionCol;

					    /****Saldo de la factura***/
					    $intAnchuraCol = 25;
					    $strAlineacionCol = 'R';
					    //Primer cabecera
					    $arrCabecera[] = '';
					    $arrAnchura[] = $intAnchuraCol;
					    $arrAlineacion[] = $strAlineacionCol;
					    //Segunda cabecera
					    $arrCabecera2[] = 'SALDO ACTUAL';
					    $arrAnchura2[] = $intAnchuraCol;
					    $arrAlineacion2[] = $strAlineacionCol;

					    /****Saldo por vencer***/
					    $intAnchuraCol = 25;
					    $strAlineacionCol = 'R';
					    //Primer cabecera
					    $arrCabecera[] = '';
					    $arrAnchura[] = $intAnchuraCol;
					    $arrAlineacion[] = $strAlineacionCol;
					    //Segunda cabecera
					    $arrCabecera2[] = 'POR VENCER';
					    $arrAnchura2[] = $intAnchuraCol;
					    $arrAlineacion2[] = $strAlineacionCol;

					    /****Rangos de vencimiento***/
					    $intAnchuraCol = 75;
					    $strAlineacionCol = 'C';
					    //Primer cabecera
					    $arrCabecera[] = 'VENCIMIENTO';
					    $arrAnchura[] = $intAnchuraCol;
					    $arrAlineacion[] = $strAlineacionCol;
					    //Segunda cabecera
					    $intAnchuraCol = 25;
					    $strAlineacionCol = 'R';
					   	//Rango de 1 a 60 días vencidos
					    $arrCabecera2[] =  utf8_decode('1-60 DÍAS');
					    $arrAnchura2[] = $intAnchuraCol;
					    $arrAlineacion2[] = $strAlineacionCol;
					    //Rango de 61 a 90 días vencidos
					    $arrCabecera2[] =  utf8_decode('61-90 DÍAS');
					    $arrAnchura2[] = $intAnchuraCol;
					    $arrAlineacion2[] = $strAlineacionCol;
					    //Rango mayor a 91 días vencidos
					    $arrCabecera2[] =  utf8_decode('MAS 90 DÍAS');
					    $arrAnchura2[] = $intAnchuraCol;
					    $arrAlineacion2[] = $strAlineacionCol;

	   					//Establece los títulos de las cabeceras
				    	$pdf->arrCabecera = $arrCabecera;
				    	$pdf->arrCabecera2 = $arrCabecera2;
				    	
				    	//Establece el ancho de las columnas de las cabeceras
				    	$pdf->arrAnchura = $arrAnchura;
				    	$pdf->arrAnchura2 = $arrAnchura2;
				    	
				    	//Establece la alineación de las celdas de las tablas
				    	$pdf->arrAlineacion = $arrAlineacion;
				    	$pdf->arrAlineacion2 = $arrAlineacion2;

						//Si existe saldo de los clientes
						if($intAcumSaldo > 0)
						{
							//Datos del primer título del reporte 
					   		$strTituloLinea1 = 'CARTERA DE '.$strModulo.' SUCURSAL '.$strSucursal.' EN ';
					  
							//Cambiar descripción de la primer línea del título 
							$strTituloLinea1 .= $strMoneda;
					
		           	    	//Asignar el valor de la descripción (título de la lista de registros) del reporte
   							$pdf->strLinea1 = $strTituloLinea1.'     '.$strTituloFechaCorte;
   							//Limpiar contenido de las variables para no mostrar títulos del segundo y tercer renglón
   							$pdf->strLinea2 = '';
	   						$pdf->strLinea3 = '';

		           	    	//Agregar pagina
							$pdf->AddPage();

							//Establece el ancho de las columnas
							$pdf->SetWidths($pdf->arrAnchura2);

							//Recorremos el arreglo 
							foreach ($arrFacturas as $arrFra)
							{
								//Array que se utiliza para agregar los datos de la factura
								$arrDatos = array();

								//Dependiendo del módulo agregar datos al array
			   					if ($strModulo == 'MAQUINARIA' OR $strModulo == 'REFACCIONES')
			   					{
			   						//Agregar al array el nombre del vendedor
			   						$arrDatos[] = utf8_decode($arrFra['vendedor']);
			   						
			   					}
			   					
			   					//Agregar al array los datos de la factura
			   					$arrDatos[] = utf8_decode($arrFra['cliente']);
			   					$arrDatos[] = $arrFra['folio'];
			   					$arrDatos[] = $arrFra['fecha'];
			   					$arrDatos[] = $arrFra['fecha_vencimiento'];
			   					$arrDatos[] = $arrFra['dias_vencidos'];
			           	    	$arrDatos[] = '$'.number_format($arrFra['saldo'],2);
						   		$arrDatos[] = '$'.number_format($arrFra['saldo_vencer'],2);
						   		$arrDatos[] = '$'.number_format($arrFra['saldo_60Dias'],2);
						   		$arrDatos[] = '$'.number_format($arrFra['saldo_90Dias'],2);
						   		$arrDatos[] = '$'.number_format($arrFra['saldo_mayorA90Dias'],2);

						   		//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						   		$pdf->Row($arrDatos, $pdf->arrAlineacion2, 'ClippedCell');

							}//Cierre de foreach (facturas)

							$pdf->Line(10, ($pdf->GetY() + 0.4), 345, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
							
							//Establece el ancho de las columnas
							$pdf->SetWidths($arrAnchuraTotales);
							//Cambiar el volumen de la letra
							$pdf->strTipoLetraTabla = 'Negrita';
							//Acumulados de los saldos generales por semana
					        $pdf->Row(array('TOTALES:', '$'.number_format($intAcumSaldo,2), 
					        			   '$'.number_format($intAcumSaldoVencer,2),
					        			   '$'.number_format($intAcumSaldo60Dias,2),
					        			   '$'.number_format($intAcumSaldo90Dias,2),
					        			   '$'.number_format($intAcumSaldoMayorA90Dias,2)), 
							    	  $arrAlineacionTotales, 'ClippedCell');
					        //Cambiar el volumen de la letra
							$pdf->strTipoLetraTabla = 'Normal';

						}//Cierre de verificación de información de saldos 

					}//Cierre de foreach (monedas)

				}//Cierre de verificación de monedas

			}//Cierre de foreach (módulos)

		}//Cierre de foreach (sucursales)

		//Ejecutar la salida del reporte
        $pdf->Output('cartera_vencimientos.pdf','I'); 
	}


	/*Método para generar un archivo XLS con la cartera de vencimientos
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte = $this->input->post('dteFechaCorte');
		$intProspectoID = $this->input->post('intProspectoID');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strModulos = trim($this->input->post('strModulos'));


        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
		//Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Array que se utiliza agregar el acumulado los saldos 
	    $arrAcumSaldos = array();
	    //Array que se utiliza para obtener los saldos de los documentos (formas de pago) de maquinaria
	    $arrDatosDocPedidosMaq = array();
		//Array que se utiliza para agregar los datos de las facturas
        $arrFacturas = array();
		//Array que se utiliza para agregar los datos de las sucursales
        $arrSucursales = array();
        //Array que se utiliza para agregar los datos de una sucursal
        $arrAuxiliar = array();
        //Variable que se utiliza para asignar el número de registros por cada moneda
		$intNumRegistros = 0; 
		//Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última moneda)
		$intNumMaxRegistros = 0;

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

			//Definir valores del array auxiliar de información (para cada sucursal)
			$arrAuxiliar["sucursal_id"] = $intSucursalID;
			$arrAuxiliar["nombre"] = $otdSucursal->nombre;
			 //Agregar datos al array
            array_push($arrSucursales, $arrAuxiliar);
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

	    //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFechaCorte = $this->get_fecha_formato_letra($dteFechaCorte, 'C');

	    //Concatenar datos para el primer encabezado del reporte
		$strTituloLinea1 = 'CARTERA DE VENCIMIENTO  EN ';
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

		//Hacer recorrido para obtener el id de las sucursales
	    foreach ($arrSucursales as $arrSuc) 
	    {	
	    	//Asignar el id de la sucursal actual
			$intSucursalID = $arrSuc['sucursal_id'];
			//Asignar el nombre de la sucursal
			$strSucursal = $arrSuc['nombre'];

	    	//Hacer recorrido para obtener las descripciones de los modulos 
		    foreach ($arrDescripcionesModulos as &$strModulo) 
		    {
		    	//Si hay información 
				if($otdMonedas)
				{
					//Recorremos el arreglo 
					foreach ($otdMonedas as $arrMon)
					{
						//Asignar el id de la moneda actual
						$intMonedaID = $arrMon->moneda_id;
						//Asignar la descripción de la moneda
						$strMoneda = strtoupper($arrMon->descripcion);
						//Asignar el código de la moneda
					    $strCodigoMoneda = $arrMon->codigo;

					    //Asignar el nombre de la hoja
						$strNombreHoja = 'CARTERA '.$strCodigoMoneda;
						$strNombreHoja .= '_'.$strModulo;

						//Concatenar datos para el primer encabezado del reporte
						$strEncabezado = $strTituloLinea1.'     '.$strTituloFechaCorte;

						//Inicializar variables
						$intAcumSaldo = 0;
						$arrAcumSaldos = array();
						$arrFacturas = array();
						$arrDatosDocPedidosMaq = array();
					
						//Array que se utiliza para establecer los títulos de la cabecera
						$arrCabecera = array();

						//Array que se utiliza para establecer los títulos de la segunda cabecera
						$arrCabecera2 = array();

						//Array que se utiliza para establecer los títulos de los documentos (formas de pago) de maquinaria
						$arrDocPedidosMaq = array();

						//Asignar objeto con el saldo de los clientes en la fecha de corte
						$otdSaldoClientes = $this->get_saldo_clientes('EXCEL', $dteFechaCorte, $intMonedaID,  
														      		  $intSucursalID, $strModulo, 
														      		  $intProspectoID);

						//Asignar array con los datos de las facturas
						$arrFacturas = $otdSaldoClientes['rows'];
						//Asignar el acumulado del saldo de los clientes
						$intAcumSaldo =  $otdSaldoClientes['acumulado_saldo'];
						//Agregar al array los acumulados de saldos
						$arrAcumSaldos[] =  $otdSaldoClientes['acumulado_saldo'];
						$arrAcumSaldos[] =  $otdSaldoClientes['acumulado_saldo_vencer'];
						$arrAcumSaldos[] =  $otdSaldoClientes['acumulado_saldo_60Dias'];
						$arrAcumSaldos[] =  $otdSaldoClientes['acumulado_saldo_90Dias'];
						$arrAcumSaldos[] =  $otdSaldoClientes['acumulado_saldo_mayorA90Dias'];
						//Asignar array con los datos de los saldos de documentos de maquinaria
						$arrDatosDocPedidosMaq =  $otdSaldoClientes['acumulado_saldo_maquinaria'];

						//Dependiendo del módulo crear cabecera
						if ($strModulo == 'MAQUINARIA' OR $strModulo == 'REFACCIONES')
						{
							//Agregar datos a los arrays de la cabecera
							$arrCabecera[] = '';
							//Agregar datos a los arrays de la segunda cabecera
							$arrCabecera2[] = 'VENDEDOR';
						}


						//Agregar datos a los array de las cabeceras
						/****Cliente***/
					    //Primer cabecera
					    $arrCabecera[] = '';
					    //Segunda cabecera
					    $arrCabecera2[] = 'CLIENTE';

					    /****Folio***/
					    //Primer cabecera
					    $arrCabecera[] = '';
					    //Segunda cabecera
					    $arrCabecera2[] = 'FOLIO';

					    /****Fecha***/
					    //Primer cabecera
					    $arrCabecera[] = '';
					    //Segunda cabecera
					    $arrCabecera2[] = 'FECHA';

					    /****Fecha de vencimiento***/
					    //Primer cabecera
					    $arrCabecera[] = '';
					    //Segunda cabecera
					    $arrCabecera2[] = 'FECHA VENCIMIENTO';

					    /****Días vencidos***/
					    //Primer cabecera
					    $arrCabecera[] = '';
					    //Segunda cabecera
					    $arrCabecera2[] =  'DÍAS VENCIDOS';

					    /****Saldo de la factura***/
					    //Primer cabecera
					    $arrCabecera[] = '';
					    //Segunda cabecera
					    $arrCabecera2[] = 'SALDO ACTUAL';

					    /****Saldo por vencer***/
					    //Primer cabecera
					    $arrCabecera[] = '';
					    //Segunda cabecera
					    $arrCabecera2[] = 'POR VENCER';

					    /****Rangos de vencimiento***/
					    //Primer cabecera
					    $arrCabecera[] = 'VENCIMIENTO';
					    //Segunda cabecera
					   	//Rango de 1 a 60 días vencidos
					    $arrCabecera2[] =  '1-60 DÍAS';
					    //Rango de 61 a 90 días vencidos
					    $arrCabecera2[] =  '61-90 DÍAS';
					    //Rango mayor a 91 días vencidos
					    $arrCabecera2[] =  'MAS 90 DÍAS';

					    //Si el módulo de maquinaria se encuentra seleccionado
						if($strModulo == 'MAQUINARIA' && $arrDatosDocPedidosMaq)
						{
							//Hacer recorrido para obtener los datos de los documentos (saldos) de maquinaria
							foreach ($arrDatosDocPedidosMaq as $arrDoc ) 
							{
								//Descripción del documento
								$arrCabecera2[] = $arrDoc['descripcion'];

							}//Cierre de verificación de formas de pago


						}//Cierre de verificación del módulo de maquinaria



					    //Si se cumple la sentencia (mostrar encabezado aunque no existan facturas con saldo)
						if($intContadorHojas == 0)
						{
							//Hacer un llamado a la función para escribir el encabezado en el archivo excel
							$this->get_encabezado_archivo_xls($objExcel, $strEncabezado, $intProspectoID, 
		    										  		  $arrCabecera, $arrCabecera2, $intAcumSaldo,
		    										  		  $strTituloSucursales, $strTituloModulos);
						}


						//Si existe saldo de los clientes
						if($intAcumSaldo > 0)
						{

							//Número de fila donde se va a comenzar a rellenar
						    $intFila = $this->archivoExcel['intFilaInicial'];
						    $intFilaInicial = $this->archivoExcel['intFilaInicial'];

						    //Concatenar moneda para el primer encabezado del reporte
							$strTituloLinea1 = 'CARTERA DE  '.$strModulo;
							$strTituloLinea1 .= ' SUCURSAL  '.$strSucursal.' EN ';
							$strTituloLinea1 .=  $strMoneda;
							
							//Cambiar descripción de la primer línea del título
							$strEncabezado = $strTituloLinea1.'     '.$strTituloFechaCorte;

							//Hacer un llamado a la función para agregar (o activar) una hoja en el archivo excel
				  			$intContadorHojas = $this->get_hoja_archivo_excel($objExcel, $strNombreHoja, $intContadorHojas); 

				  			 //Hacer un llamado a la función para escribir el encabezado en el archivo excel
					   		 $this->get_encabezado_archivo_xls($objExcel, $strEncabezado, $intProspectoID, 
		    										  		   $arrCabecera, $arrCabecera2);


					   		//Recorremos el arreglo 
							foreach ($arrFacturas as $arrFra)
							{
								//Array que se utiliza para agregar los datos de la factura
								$arrDatos = array();

								//Dependiendo del módulo agregar datos al array
			   					if ($strModulo == 'MAQUINARIA' OR $strModulo == 'REFACCIONES')
			   					{
			   						//Agregar al array el nombre del vendedor
			   						$arrDatos[] = $arrFra['vendedor'];
			   					}

			   					//Agregar al array los datos de la factura
			   					$arrDatos[] = $arrFra['cliente'];
			   					$arrDatos[] = $arrFra['folio'];
			   					$arrDatos[] = $arrFra['fecha'];
			   					$arrDatos[] = $arrFra['fecha_vencimiento'];
			   					$arrDatos[] = $arrFra['dias_vencidos'];
			           	    	$arrDatos[] = $arrFra['saldo'];
						   		$arrDatos[] = $arrFra['saldo_vencer'];
						   		$arrDatos[] = $arrFra['saldo_60Dias'];
						   		$arrDatos[] = $arrFra['saldo_90Dias'];
						   		$arrDatos[] = $arrFra['saldo_mayorA90Dias'];

								//Inicializar variable para escribir el saldo del documento
								$intIndColE =  $this->archivoExcel['intIndColInicial'];

								//Hacer recorrido para obtener los datos de la factura
								foreach ($arrDatos as $arrDet) 
								{
									//Asignar columna actual
									$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFila;

									//Agregar información del saldo por factura
									$objExcel->getActiveSheet()
					                    	 ->setCellValue($strColActual, $arrDet);
					                //Incrementar indice de la columna
									$intIndColE++;  

								}//Cierre de foreach (saldo del documento)

								//Si el módulo corresponde a Maquinaria
								if($strModulo == 'MAQUINARIA' && $arrDatosDocPedidosMaq)
								{
									//Hacer recorrido para obtener los datos de los documentos (saldos) de maquinaria
									foreach ($arrDatosDocPedidosMaq as $arrDet) 
									{
										//Asignar columna actual
										$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFila;

										//Asignar el saldo del documento de maquinaria
									    $intSaldoDocPedidosMaq = $arrFra['saldo_maquinaria'][$arrDet['documento_pago_id']];
									   
								    	//Agregar información del saldo por documento de maquinaria
										$objExcel->getActiveSheet()
					                    	 	 ->setCellValue($strColActual, $intSaldoDocPedidosMaq);
									   
						                //Incrementar indice de la columna
										$intIndColE++; 

									}//Cierre de verificación de formas de pago

								}//Cierre de verificación del módulo de maquinaria

				                //Incrementar el indice para escribir los datos del siguiente registro
								$intFila++;

							}//Cierre de foreach (facturas)


							//Hacer un llamado a la función para cambiar el estilo de las celdas
							$this->get_estilo_celda($objExcel, $arrCabecera2, $intFila, $arrAcumSaldos,
												    $arrDatosDocPedidosMaq);

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

					}//Cierre de foreach (monedas)

				}//Cierre de verificación de monedas

		    }//Cierre de foreach (módulos)

	    }//Cierre de foreach (sucursales)	


		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'cartera_vencimientos.xls', 'CARTERA', $intNumMaxRegistros);
	}


	//Función que se utiliza para escribir el encabezado del archivo Excel
    public function get_encabezado_archivo_xls($objExcel, $strEncabezado, $intProspectoID, 
    										   $arrCabecera, $arrCabecera2, $intAcumSaldo = NULL,
    										   $strTituloSucursales = NULL, $strTituloModulos = NULL)
    {	

    	//Asignar posición para escribir las descripciones de las columnas 
      	$intPosEncabezados = $this->archivoExcel['intPosEncabezados'];
      	//Variable que se utiliza para asignar el número de columna donde se empezaran a escribir los encabezados 
      	$intIndColE= $this->archivoExcel['intIndColInicial'];//Encabezados del reporte
      	//Asignar indice para escribir el nombre del cliente
		$intPosTituloCliente = 8;
	 	//Asignar el número de columnas de la cabecera 2
	 	$intNumColCabecera2 = count($arrCabecera2);

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

    	//Se agrega el título del archivo
		$objExcel->getActiveSheet()->setCellValue('A7', $strEncabezado);

		
		//Si no existen saldos de las facturas
		if($intAcumSaldo == 0 && $strTituloSucursales != NULL && $strTituloModulos != NULL)
		{
			$objExcel->getActiveSheet()->setCellValue('A8', 'SUCURSALES: '.$strTituloSucursales);
			$objExcel->getActiveSheet()->setCellValue('A9', 'MÓDULOS: '.$strTituloModulos);

			$intPosTituloCliente = 10;
		}
		
		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del cliente que coincide con el id
			$otdCliente = $this->clientes->buscar($intProspectoID);

			$objExcel->getActiveSheet()->setCellValue('A'.$intPosTituloCliente, 
												      'CLIENTE: '.$otdCliente->codigo.' - '.$otdCliente->razon_social);
		}

		//Combinar las siguientes celdas
       	$objExcel->getActiveSheet()->mergeCells('A8:D8');
       	$objExcel->getActiveSheet()->mergeCells('A9:D9');
        $objExcel->getActiveSheet()->mergeCells('A10:D10');

       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A8:D10')
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

        //Asignar columna final
        $strColFinal = $this->ARR_COLUMNAS[$intNumColCabecera2].$intPosEncabezados;

    	//Hacer recorrido para obtener los datos de la cabecera 1
    	foreach ($arrCabecera as $arrDet) 
    	{	
    		//Asignar columna inicial
    		$strColInicial = $this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados;

        	//Se agrega en el encabezado del archivo la cabecera 1
        	$objExcel->getActiveSheet()->setCellValue($strColInicial, $arrDet);

        	//Si la descripción de la columna es VENCIMIENTO
        	if($arrDet == 'VENCIMIENTO')
        	{
        		//Combinar las siguientes celdas
		       	$objExcel->getActiveSheet()->mergeCells($strColInicial.':'.$strColFinal);
        	}

        	//Cambiar estilo de las siguientes celdas
	        $objExcel->getActiveSheet()
	        		 ->getStyle($strColInicial.':'.$strColFinal)
	        		 ->applyFromArray($arrStyleBold);

	        //Cambiar alineación de las siguientes celdas
		    $objExcel->getActiveSheet()
		        	 ->getStyle($strColInicial.':'.$strColFinal)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);

	        //Preferencias de color de relleno de celda
       		$objExcel->getActiveSheet()
    			     ->getStyle($strColInicial.':'.$strColFinal)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

	        //Preferencias de color de texto de la celda
       	    $objExcel->getActiveSheet()
    			     ->getStyle($strColInicial.':'.$strColFinal)
    			     ->applyFromArray($arrStyleFuenteColumnas);

		    //Incrementar indice de la columna
			$intIndColE++;      

        }//Cierre de foreach (cabecera 1)


        //Incrementar los indices para escribir los datos de la cabecera 2
        $intIndColE = $this->archivoExcel['intIndColInicial'];
        $intPosEncabezados++;

        //Hacer recorrido para obtener los datos de la cabecera 2
    	foreach ($arrCabecera2 as $arrDet) 
    	{
    		//Asignar columna actual
    		$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados;

        	//Se agrega en el encabezado del archivo la cabecera 2
        	$objExcel->getActiveSheet()->setCellValue($strColActual, $arrDet);

        	 //Cambiar estilo de las siguientes celdas
	        $objExcel->getActiveSheet()
	        		 ->getStyle($strColActual)
	        		 ->applyFromArray($arrStyleBold);

	        //Cambiar alineación de las siguientes celdas
		    $objExcel->getActiveSheet()
		        	 ->getStyle($strColActual)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);

	        //Preferencias de color de relleno de celda
       		$objExcel->getActiveSheet()
    			     ->getStyle($strColActual)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

	        //Preferencias de color de texto de la celda
       	    $objExcel->getActiveSheet()
    			     ->getStyle($strColActual)
    			     ->applyFromArray($arrStyleFuenteColumnas);


		    //Incrementar indice de la columna
			$intIndColE++;  

        }//Cierre de foreach (cabecera 2)

    }

	
	//Función que se utiliza para cambiar el estilo de las celadas del archivo Excel
    public function get_estilo_celda($objExcel, $arrCabecera2, $intUltimaFila, 
    								 $arrAcumSaldos, $arrDatosDocPedidosMaq)
    {

    	//Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    	
    	//Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

	    //Inicializar variable para escribir el saldo del documento
	    $intIndiceCol =  $this->archivoExcel['intIndColInicial'];
	    //Variable que se utiliza para asignar el indice de la columna días vencidos
	    $intIndDiasVenc = 0;

	    //Asignar indice de fila donde se empezaran a escribir los totales
	    $intFilaTotales = $intUltimaFila + 1;

	 	//Hacer recorrido para obtener los datos de la cabecera 2
        foreach ($arrCabecera2 as $arrDet) 
        {
        	//Asignar columna actual
	        $strColActual = $this->ARR_COLUMNAS[$intIndiceCol];

	        //Buscar palabra FECHA -> para cambiar alineación de la celda
            $strCoincidencia = strpos($arrDet, 'FECHA');

            //Si existe coincidencia
            if($strCoincidencia !== FALSE)
	       	{
	       		//Cambiar alineación de las siguientes celdas
        		$objExcel->getActiveSheet()
			        	 ->getStyle($strColActual.$this->archivoExcel['intFilaInicial'].':'.$strColActual.$intFilaTotales)
			        	 ->getAlignment()
			        	 ->applyFromArray($arrStyleAlignmentCenter);
	       	}

	        //Si la descripción de la columna es DÍAS VENCIDOS
	        if($arrDet == 'DÍAS VENCIDOS')
	        {
	        	$intIndDiasVenc = $intIndiceCol;
	        }

	       	//Si se cumple la sentencia
	        if($intIndDiasVenc > 0 )
	        {
	        	//Si la columna corresponde a los saldos
	        	if($intIndiceCol > $intIndDiasVenc)
	        	{
	        		//Cambiar contenido de las celdas a formato moneda
           			$objExcel->getActiveSheet()
		            		 ->getStyle($strColActual.$this->archivoExcel['intFilaInicial'].':'.$strColActual.$intFilaTotales)
		            		 ->getNumberFormat()
		            		 ->setFormatCode('$#,##0.00');

	        	}
	        	
            	//Cambiar alineación de las siguientes celdas
        		$objExcel->getActiveSheet()
			        	 ->getStyle($strColActual.$this->archivoExcel['intFilaInicial'].':'.$strColActual.$intFilaTotales)
			        	 ->getAlignment()
			        	 ->applyFromArray($arrStyleAlignmentRight);


			    //Cambiar estilo de las siguientes celdas
			    $objExcel->getActiveSheet()
			             ->getStyle($strColActual.$intFilaTotales.':'.$strColActual.$intFilaTotales)
			             ->applyFromArray($arrStyleBold);

	        }

	        //Incrementar indice de la columna
	        $intIndiceCol++;

        }//Cierre de foreach (cabecera 2)

        

        //Escribir totales
        //Asignar índice de la columna donde se empezaran a escribir los totales
	    $strColTotales = $this->ARR_COLUMNAS[$intIndDiasVenc];

        //Agregar información de los acumulados
		$objExcel->getActiveSheet()
	             ->setCellValue($strColTotales.$intFilaTotales, 'TOTALES:');

	   //Inicializar variable para escribir acumulado de los saldos
		$intIndColE = $intIndDiasVenc + 1;

	    //Hacer recorrido para obtener los datos de acumulados
        foreach ($arrAcumSaldos as $arrAcum) 
        {
        	//Asignar columna actual
			$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaTotales;

			//Agregar información del acumulado
			$objExcel->getActiveSheet()
                	 ->setCellValue($strColActual, $arrAcum);
            
            //Incrementar indice de la columna
			$intIndColE++;  


        }//Cierre de foreach (acumulados de saldos)


        //Si existen datos de los documentos (formas de pago) de maquinaria
        if($arrDatosDocPedidosMaq)
        {
        	//Hacer recorrido para obtener los datos de acumulados de los documentos (formas de pago)
	        foreach ($arrDatosDocPedidosMaq as $arrDet) 
	        {
	        	//Asignar columna actual
				$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFilaTotales;
										   
				//Agregar información del acumulado
				$objExcel->getActiveSheet()
	                	 ->setCellValue($strColActual, $arrDet['acumulado_saldo']);
	            
	            //Incrementar indice de la columna
				$intIndColE++;  

	        }//Cierre de foreach (acumulados de saldos)

        }//Cierre de verificación de las formas de pago 
       
    }
	
	//Función que se utiliza para regresar clientes con saldo en la fecha de corte
	public function get_saldo_clientes($strTipoArchivo, $dteFechaCorte, $intMonedaID, $intSucursalID, 
									   $strModulo, $intProspectoID = NULL)
	{

		//Array que se utiliza para enviar datos
		$arrDatos = array('rows' => NULL, 
						  'acumulado_saldo' => '0.00',
						  'acumulado_saldo_vencer' => '0.00',
						  'acumulado_saldo_60Dias' => '0.00',
						  'acumulado_saldo_90Dias' => '0.00',
						  'acumulado_saldo_mayorA90Dias' => '0.00', 
						  'acumulado_saldo_maquinaria' => NULL);


		//Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo por vencer
	    $intAcumSaldoVencer = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido en 60 días
	    $intAcumSaldo60Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido en 90 días
	    $intAcumSaldo90Dias = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido mayor a 90 días
	    $intAcumSaldoMayorA90Dias = 0;
	    //Array que se utiliza para asignar el saldo del documento (formas de pago -> pedidos de maquinaria) por sucursal
	    $arrSaldoDocPedidosMaqSuc = array(); 
	    //Array que se utiliza para asignar los acumulados de documentos (formas de pago -> pedidos de maquinaria) por sucursal
	    $arrDatosSaldoDocPedidosMaqSuc = array();
		//Array que se utiliza para agregar los datos de las facturas
        $arrFacturas = array();

		//Seleccionar los datos de las facturas (con saldo) que coinciden con el parámetro enviado
		$otdResultado = $this->pagos->buscar_facturas_importes('reporte', $dteFechaCorte, $intProspectoID, 
																NULL, $intMonedaID, NULL, NULL, NULL,
													            $intSucursalID, $strModulo, NULL, 
										     				    NULL, 'saldo');


		//Si el módulo de maquinaria se encuentra seleccionado
		if($strTipoArchivo == 'EXCEL' &&  $strModulo == 'MAQUINARIA')
		{
			//Seleccionar los datos de los documentos de pedidos de maquinaria (pagos)
			$otdDocPedidosMaq = $this->pedidos_maquinaria->buscar_distintas_formas_pago($intSucursalID, 
																						$dteFechaCorte, 
																						$intMonedaID);
			//Si hay información
			if($otdDocPedidosMaq)
			{
				//Hacer recorrido para obtener el id de los documentos (formas de pago -> pedidos de maquinaria)
				foreach ($otdDocPedidosMaq as $arrDoc) 
				{
					//Inicializar variables
					$arrSaldoDocPedidosMaqSuc[$arrDoc->documento_pago_id] = 0;

				}//Cierre de foreach formas de pago de maquinaria


			}//Cierre de verificación de formas de pago


		}//Cierre de verificación del módulo de maquinaria


		//Si hay información
		if($otdResultado)
		{

			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{	
				//Variables que se utilizan para asignar el saldo vencido de la factura
				$intSaldoVencerFra = 0;
                $intSaldo60DiasFra = 0;
                $intSaldo90DiasFra = 0;
                $intSaldoMayorA90DiasFra = 0;
                //Variable que se utiliza para asignar el saldo por documentos (forma de pago) del pedido de maquinaria
				$intSaldoDocPedidosMaq = 0;
				//Array que se utiliza para asignar el saldo por documento (forma de pago) del pedido de maquinaria
				$arrSaldoDocPedidosMaq = array(); 
                //Variable que se utiliza para asignar el número de días vencidos
				$intDiasVencidos = "";
                //Array que se utiliza para agregar los datos de una factura
       			$arrAuxiliar = array();

				//Asignar el saldo de la factura
				$intSaldoFactura = $arrCol->saldo;
				//Variable que se utiliza para asignar el id de la factura
			    $intReferenciaID = $arrCol->referencia_id;
			    //Variable que se utiliza para asignar el tipo de referencia (MAQUINARIA/REFACCIONES/SERVICIO/CARTERA) de la factura 
			    $strTipoReferencia =  $arrCol->tipo_referencia;

				//Si la factura no se encuentra pagada
				//if (($intSaldoFactura >= 1) OR ($intSaldoFactura <= -1)) //Validación anterior
				if($intSaldoFactura > 0)
				{
					//Asignar fecha de vencimiento de la factura
	            	$dteFechaVencimiento = $arrCol->fecha_vencimiento;

	            	//Asignar acumulado de abonos (pagos) de la factura
					$intTotalAbonos = $arrCol->abonos;

					//Si se cumple la sentencia
					if($strTipoArchivo == 'EXCEL' &&  $strModulo == 'MAQUINARIA')
					{
						//Si el módulo corresponde a Maquinaria
						if($otdDocPedidosMaq)
						{
							//Hacer recorrido para obtener el id de los documentos (formas de pago -> pedidos de maquinaria)
							foreach ($otdDocPedidosMaq as $arrDoc) 
							{
	       						//Inicializar variables
								$arrSaldoDocPedidosMaq[$arrDoc->documento_pago_id] = 0;

							}//Cierre de foreach formas de pago de maquinaria

						}//Cierre de verificación del módulo

					}

					//Si el tipo de referencia corresponde a una factura de maquinaria
					if($strTipoArchivo == 'EXCEL' && $strModulo == 'MAQUINARIA' && 
					   $strTipoReferencia == 'MAQUINARIA')
					{

						//Seleccionar los pagos del pedido de maquinaria
						$otdPedidosMaq = $this->pedidos_maquinaria->buscar_formas_pago(NULL, 
																					   $intReferenciaID);

						//Si hay información
						if($otdPedidosMaq)
						{
							//Hacer recorrido para obtener los pagos del pedido de maquinaria
							foreach ($otdPedidosMaq as $arrDoc) 
							{
								//Asignar el importe de la forma de pago (pago del pedido)
								$intImpDocPago = $arrDoc->importe;

								//Si se cumple la sentencia (decrementar el acumulado de abonos)
								if($intTotalAbonos >= $intImpDocPago)
								{
									//Decrementar el acumulado de los abonos
									$intTotalAbonos -= $intImpDocPago;
									//Asignar valor cero para indicar que el pago ya esta saldado 
									$intImpDocPago = 0;
								}
								else
								{
									//Decrementar el importe del documento
									$intImpDocPago -= $intTotalAbonos;
									//Asignar valor cero para indicar que los abonos corresponden al documento
									$intTotalAbonos = 0;
								}


								//Si el documento del pago es PAGARÉ, ENGANCHE O CONTADO
								if($arrDoc->documento_pago_id == DOCUMENTO_PAGO_ENGANCHE OR 
									$arrDoc->documento_pago_id == DOCUMENTO_PAGO_PAGARE OR
									$arrDoc->documento_pago_id == DOCUMENTO_PAGO_CONTADO)
								{

									//Si la fecha de vencimiento es menor que la fecha de corte
					            	if ($arrDoc->fecha_vencimiento < $dteFechaCorte)
					            	{
				                        //Hacer un llamado a la función para calcular los días vencidos
					                   	$intDiasVencDoc = $this->get_dias_vencidos($dteFechaCorte, $arrDoc->fecha_vencimiento);

					                   	//Incrementar los días vencidos de la factura de maquinaria
					                    $intDiasVencidos += $intDiasVencDoc;

					                   	//Dependiendo de los días vencidos asignar saldo de la factura
					                   	if($intDiasVencDoc <= 60)
					                   	{
					                   		//Asignar el saldo vencido en 60 días
						                    $intSaldo60DiasFra += $intImpDocPago;
						                    //Incrementar acumulado del saldo vencido en 60 días
					                        $intAcumSaldo60Dias += $intImpDocPago;
					                   	}
					                   	else if (($intDiasVencDoc > 60) && 
						                 	 	($intDiasVencDoc <= 90))
					                   	{

					                   		//Asignar el saldo vencido en 90 días
					                        $intSaldo90DiasFra += $intImpDocPago;
					                        //Incrementar acumulado del saldo vencido en 90 días
					                        $intAcumSaldo90Dias += $intImpDocPago;
					                   	}
					                   	else
					                   	{
					                   		//Asignar el saldo vencido mayor a 90 días
					                        $intSaldoMayorA90DiasFra += $intImpDocPago;
					                        //Incrementar acumulado del saldo vencido mayor a 90 días
					                        $intAcumSaldoMayorA90Dias += $intImpDocPago;
					                   	}

					            	}
					            	else
					            	{
					            		//Asignar saldo de la factura
				                        $intSaldoVencerFra += $intImpDocPago;
					            		//Incrementar acumulado del saldo por vencer
										$intAcumSaldoVencer += $intImpDocPago;

					            	}

								}
								else
								{

									//Incrementar acumulado del saldo del documento por factura
  							        $arrSaldoDocPedidosMaq[$arrDoc->documento_pago_id] += $intImpDocPago;
									//Incrementar acumulado del saldo del documento por sucursal
			      					$arrSaldoDocPedidosMaqSuc[$arrDoc->documento_pago_id] += $intImpDocPago;
								}	


							}//Cierre de foreach pagos del pedido de maquinaria
						}
						else
						{

							//Si la fecha de vencimiento es menor que la fecha de corte
			            	if ($dteFechaVencimiento < $dteFechaCorte)
			            	{
		                        //Hacer un llamado a la función para calcular los días vencidos
			                   	$intDiasVencidos = $this->get_dias_vencidos($dteFechaCorte, $dteFechaVencimiento);

			                   	//Dependiendo de los días vencidos asignar saldo de la factura
			                   	if($intDiasVencidos <= 60)
			                   	{
			                   		//Asignar el saldo vencido en 60 días
				                    $intSaldo60DiasFra = $intSaldoFactura;
				                    //Incrementar acumulado del saldo vencido en 60 días
			                        $intAcumSaldo60Dias += $intSaldoFactura;
			                   	}
			                   	else if (($intDiasVencidos > 60) && 
				                 	 	($intDiasVencidos <= 90))
			                   	{

			                   		//Asignar el saldo vencido en 90 días
			                        $intSaldo90DiasFra = $intSaldoFactura;
			                        //Incrementar acumulado del saldo vencido en 90 días
			                        $intAcumSaldo90Dias += $intSaldoFactura;
			                   	}
			                   	else
			                   	{
			                   		//Asignar el saldo vencido mayor a 90 días
			                        $intSaldoMayorA90DiasFra = $intSaldoFactura;
			                        //Incrementar acumulado del saldo vencido mayor a 90 días
			                        $intAcumSaldoMayorA90Dias += $intSaldoFactura;
			                   	}

			            	}
			            	else
			            	{
			            		//Asignar saldo de la factura
		                        $intSaldoVencerFra = $intSaldoFactura;
			            		//Incrementar acumulado del saldo por vencer
								$intAcumSaldoVencer += $intSaldoFactura;

			            	}

						}
						
					}
	            	else 
	            	{
	            		//Si la fecha de vencimiento es menor que la fecha de corte
		            	if ($dteFechaVencimiento <  $dteFechaCorte)
		            	{
	                        //Hacer un llamado a la función para calcular los días vencidos
		                   	$intDiasVencidos = $this->get_dias_vencidos($dteFechaCorte, $dteFechaVencimiento);

		                   	//Dependiendo de los días vencidos asignar saldo de la factura
		                   	if($intDiasVencidos <= 60)
		                   	{
		                   		//Asignar el saldo vencido en 60 días
			                    $intSaldo60DiasFra = $intSaldoFactura;
			                    //Incrementar acumulado del saldo vencido en 60 días
		                        $intAcumSaldo60Dias += $intSaldoFactura;
		                   	}
		                   	else if (($intDiasVencidos > 60) && 
			                 	 	($intDiasVencidos <= 90))
		                   	{

		                   		//Asignar el saldo vencido en 90 días
		                        $intSaldo90DiasFra = $intSaldoFactura;
		                        //Incrementar acumulado del saldo vencido en 90 días
		                        $intAcumSaldo90Dias += $intSaldoFactura;
		                   	}
		                   	else
		                   	{
		                   		//Asignar el saldo vencido mayor a 90 días
		                        $intSaldoMayorA90DiasFra = $intSaldoFactura;
		                        //Incrementar acumulado del saldo vencido mayor a 90 días
		                        $intAcumSaldoMayorA90Dias += $intSaldoFactura;
		                   	}

		            	}
		            	else
		            	{
		            		//Asignar saldo de la factura
	                        $intSaldoVencerFra = $intSaldoFactura;
		            		//Incrementar acumulado del saldo por vencer
							$intAcumSaldoVencer += $intSaldoFactura;

		            	}
	            	}
	            	

                    //Definir valores del array auxiliar de información (para cada factura)
                    $arrAuxiliar["vendedor"] = $arrCol->vendedor;
                    $arrAuxiliar["cliente"] = $arrCol->razon_social;
					$arrAuxiliar["folio"] = $arrCol->folio;
					$arrAuxiliar["fecha"] = $arrCol->fecha_format;
					$arrAuxiliar["fecha_vencimiento"] = $arrCol->fecha_vencimiento_format;
					$arrAuxiliar["saldo"] = $intSaldoFactura;
					$arrAuxiliar["saldo_vencer"] = $intSaldoVencerFra;
					$arrAuxiliar["dias_vencidos"] = $intDiasVencidos;
					$arrAuxiliar["saldo_60Dias"] = $intSaldo60DiasFra;
					$arrAuxiliar["saldo_90Dias"] = $intSaldo90DiasFra;
					$arrAuxiliar["saldo_mayorA90Dias"] = $intSaldoMayorA90DiasFra;
					$arrAuxiliar["saldo_maquinaria"] = $arrSaldoDocPedidosMaq;
					//Asignar datos al array
	                array_push($arrFacturas, $arrAuxiliar); 

	                //Incrementar acumulado del saldo
					$intAcumSaldo += $intSaldoFactura;

				}//Cierre de verificación del saldo

			}//Cierre de foreach (facturas)

			//Si existen saldos de los documentos (formas de pago) de maquinaria
			if($arrSaldoDocPedidosMaqSuc && $otdDocPedidosMaq)
			{
				//Hacer recorrido para obtener los datos de los documentos (saldos) de maquinaria
				foreach ($otdDocPedidosMaq as $arrDoc) 
				{
					//Asignar el saldo del documento de maquinaria
					$intAcumSaldoDocMaqSuc = $arrSaldoDocPedidosMaqSuc[$arrDoc->documento_pago_id];

					//Si existe saldo del documento
					if($intAcumSaldoDocMaqSuc > 0)
					{
						//Definir valores del array auxiliar de información (para cada documento)
						$arrAuxiliar["documento_pago_id"] = $arrDoc->documento_pago_id;
						$arrAuxiliar["descripcion"] = $arrDoc->descripcion;
						$arrAuxiliar["acumulado_saldo"] = $intAcumSaldoDocMaqSuc;
						 //Agregar datos al array
			            array_push($arrDatosSaldoDocPedidosMaqSuc, $arrAuxiliar);
					}

				}//Cierre de verificación de formas de pago

			}//Cierre de verificación de formas de pago

			//Asignar datos al array
			$arrDatos['rows'] = $arrFacturas;
		    $arrDatos['acumulado_saldo'] = $intAcumSaldo;
		    $arrDatos['acumulado_saldo_vencer'] = $intAcumSaldoVencer;
			$arrDatos['acumulado_saldo_60Dias'] = $intAcumSaldo60Dias;
			$arrDatos['acumulado_saldo_90Dias'] = $intAcumSaldo90Dias;
			$arrDatos['acumulado_saldo_mayorA90Dias'] = $intAcumSaldoMayorA90Dias;
			$arrDatos['acumulado_saldo_maquinaria'] = $arrDatosSaldoDocPedidosMaqSuc;

		}//Cierre de verificación de facturas con adeudo

		//Regresar array con los saldos vencidos de los clientes
		return $arrDatos;
	}	

}