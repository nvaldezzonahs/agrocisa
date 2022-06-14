<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_facturacion_refacciones extends MY_Controller {

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
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de facturas de refacciones
		$this->load->model('refacciones/facturas_refacciones_model', 'facturas');
		//Cargamos el modelo de notas de crédito digitales
		$this->load->model('cuentas_cobrar/notas_credito_digitales_model', 'notas_digitales');
		//Cargamos el modelo de monedas
		$this->load->model('contabilidad/sat_monedas_model', 'monedas');
		//Cargamos el modelo de movimientos de refacciones
		$this->load->model('refacciones/movimientos_refacciones_model', 'movimientos');
		//Cargamos el modelo de clientes
		$this->load->model('cuentas_cobrar/clientes_model', 'clientes');
		
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('refacciones/rep_facturacion_refacciones', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}



	/*Método para generar un reporte PDF con las facturas de refacciones 
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProspectoID = $this->input->post('intProspectoID');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strTipos = trim($this->input->post('strTipos'));
		$strTipoReporte = $this->input->post('strTipoReporte');
		$strIncluirCostos = $this->input->post('strIncluirCostos');
		$strIncluirNotasCredito = $this->input->post('strIncluirNotasCredito');
		$strIncluirDevoluciones = $this->input->post('strIncluirDevoluciones');
		$strIncluirDetalleFras = $this->input->post('strIncluirDetalleFras');


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


		//Buscar el nombre de las sucursales que han sido seleccionadas y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 3
	    $strTituloTipos = '';
	    $arrTipos = explode('|', $strTipos);
	     //Hacer recorrido para obtener el id de los tipos de venta
	    foreach ($arrTipos as &$strTipo) 
	    {		    
			//Concatenamos el nombre del tipo de venta a la variable de impresión
			$strTituloTipos .= $strTipo.', ';
		}

		//Quitar último elemento de la cadena (,)
		$strTituloTipos = substr($strTituloTipos, 0, -2);

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Datos del primer título del reporte 
		$strTituloLinea1 = 'LISTADO DE MOVIMIENTOS EN ';
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
	    $pdf->strLinea1 = $strTituloLinea1.'     '.$strTituloRangoFechas;
	    //Si se cumple la sentencia mostrar detalles
	    if($strIncluirDetalleFras == 'SI')
	    {
	     	//Asignar el valor de la línea dos del título
	    	$pdf->strLinea2 = 'DETALLADO DE VENTAS';
	    }
		
	    //Asignar el valor de la línea tres del título
		$pdf->strLinea3 = utf8_decode('SUCURSALES: '.trim($strTituloSucursales));
		 //Asignar el valor de la línea cuatro del título
		$pdf->strLinea4 = utf8_decode('TIPOS: '.trim($strTituloTipos));
		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del cliente que coincide con el id
			$otdCliente = $this->clientes->buscar($intProspectoID);
			//Asignar el valor de la línea cinco del título
			$pdf->strLinea5 =  'CLIENTE: '.utf8_decode($otdCliente->codigo.' - '.$otdCliente->razon_social);
		}

		//Array que se utiliza para establecer los títulos de la segunda cabecera
	    $arrCabecera2 = array();
	    //Array que se utiliza para establecer el ancho de las columnas de la segunda cabecera
	    $arrAnchura2 = array();
	    //Array que se utiliza para establecer la alineación de la segunda cabecera
		$arrAlineacion2 = array();
		//Variable que se utiliza para asignar el tamaño de la columna cliente
		$intTamColCliente = 70;
		//Definir anchura y alineación de la columnas normales
		$intAnchuraCol = 18;
		$strAlineacionCol = 'L';
	    //Agregar datos a los arrays de la segunda cabecera
	    //Factura
		$arrCabecera2[] = 'FACTURA';
		$arrAnchura2[] = $intAnchuraCol;
		$arrAlineacion2[] = $strAlineacionCol;
		//Cliente
		$arrCabecera2[] = 'CLIENTE';
		$arrAnchura2[] = $intTamColCliente;
		$arrAlineacion2[] = $strAlineacionCol;
		//Fecha
		$arrCabecera2[] = 'FECHA';
		$arrAnchura2[] = 15;
		$arrAlineacion2[] = 'C';

		//Definir alineación de las columnas numéricas
		$strAlineacionCol = 'R';

		//Subtotal
		$arrCabecera2[] = 'SUBTOTAL';
		$arrAnchura2[] = $intAnchuraCol;
		$arrAlineacion2[] = $strAlineacionCol;
		//IVA
		$arrCabecera2[] = 'IVA';
		$arrAnchura2[] = $intAnchuraCol;
		$arrAlineacion2[] = $strAlineacionCol;
		//IEPS
		$arrCabecera2[] = 'IEPS';
		$arrAnchura2[] = $intAnchuraCol;
		$arrAlineacion2[] = $strAlineacionCol;
		//Total
		$arrCabecera2[] = 'TOTAL';
		$arrAnchura2[] = $intAnchuraCol;
		$arrAlineacion2[] = $strAlineacionCol;
		
		//Si se cumple la sentencia mostrar agregar columnas de costos
	    if($strIncluirCostos == 'SI')
	    {	
	    	//Cambiar el tamaño de la columna cliente
	    	$intTamColCliente = 34;
	    	//Costo
			$arrCabecera2[] = 'COSTO';
			$arrAnchura2[] = $intAnchuraCol;
			$arrAlineacion2[] = $strAlineacionCol;
			//Utilidad
			$arrCabecera2[] = 'UTILIDAD';
			$arrAnchura2[] = $intAnchuraCol;
			$arrAlineacion2[] = $strAlineacionCol;

			//Cambiar anchura de la columna cliente
			$arrAnchura2[1] = $intTamColCliente;

		}//Cierre de verificación de costos

		//Estatus
		$arrCabecera2[] = 'ESTATUS';
		$arrAnchura2[] = 15;
		$arrAlineacion2[] = 'C';
		//Crea los titulos de la segunda cabecera
		$pdf->arrCabecera2 = $arrCabecera2;
		//Establece el ancho de las columnas de las cabeceras
		$pdf->arrAnchura = array(190);
		$pdf->arrAnchura2 = $arrAnchura2;
		//Establece la alineación de las celdas de las tablas
		$pdf->arrAlineacion = array('L');
		$pdf->arrAlineacion2 = $arrAlineacion2;

		//Variable que se utiliza para asignar el tamaño de la columna total
		$intTamColTotal = $intTamColCliente + 33;

		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array($intTamColTotal, 18, 18, 18, 18, 18, 18);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R', 'R', 'R', 'R', 'R');

		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('L', 'L', 'R', 'R', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(20, 81, 18, 18, 18);

		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDevoluciones = array('R', 'L', 'R', 'R', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDevoluciones = array(20, 81, 18, 18, 18);
		
		//Array que se utiliza para agregar los datos de las facturas
	    $arrFacturas = array();
	    //Array que se utiliza para agregar los datos de las devoluciones
	    $arrDevoluciones = array();
	    //Array que se utiliza para agregar los datos de las notas de crédito digitales
	    $arrNotasCreditoDigitales = array();

		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Variable que se utiliza pra asignar el id actual del tipo (Mostrador, Refaccionario, Campo, etc.)
		$strTipoActual = '';
		//Variable que se utiliza pra asignar el id actual de la moneda
		$intMonedaIDActual = 0;
		//Variable que se utiliza para asignar el acumulado general del subtotal de facturas
        $intAcumGralSubtotalFras = 0;
        //Variable que se utiliza para asignar el acumulado general del IVA de facturas
        $intAcumGralIvaFras = 0;
        //Variable que se utiliza para asignar el acumulado general del IEPS de facturas
        $intAcumGralIepsFras = 0;
        //Variable que se utiliza para asignar el acumulado general del total de facturas
        $intAcumGralTotalFras = 0;
        //Variable que se utiliza para asignar el acumulado general del costo de facturas
        $intAcumGralCostoFras = 0;
        //Variable que se utiliza para asignar el acumulado  generalde la utilidad de facturas
        $intAcumGralUtilidadFras = 0;
       

		//Establecer el color de fondo para la cabecera
		$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		//$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Seleccionar los datos de las monedas activas
		$otdMonedas = $this->monedas->buscar(NULL, NULL, NULL, 'ACTIVO');

		//Si hay información
		if($otdMonedas)
		{
			//Recorremos el arreglo 
			foreach ($otdMonedas as $arrMon)
			{
				
				//Inicializar variables
				$arrFacturas = array();
				$arrDevoluciones = array();
				$arrNotasCreditoDigitales = array();
				$intAcumGralSubtotalFras = 0;
		        $intAcumGralIvaFras = 0;
		        $intAcumGralIepsFras = 0;
		        $intAcumGralTotalFras = 0;
		        $intAcumGralCostoFras = 0;
		        $intAcumGralUtilidadFras = 0;

				///Asignar objeto con los movimientos de clientes en el rango de fechas
			    $otdMovimientosCtes = $this->get_movimientos($dteFechaInicial, $dteFechaFinal, 
			    											 $intProspectoID, $arrMon->moneda_id, 
			    											 $strSucursales, $strTipos, 
			    								      		 $strTipoReporte, $strIncluirDevoluciones,
			    								             $strIncluirNotasCredito);



			    //Asignar array con los datos de las facturs
				$arrFacturas = $otdMovimientosCtes['facturas'];
				//Asignar array con los datos de las devoluciones
				$arrDevoluciones = $otdMovimientosCtes['devoluciones'];
				//Asignar array con los datos de las notas de crédito digitales
				$arrNotasCreditoDigitales = $otdMovimientosCtes['notas_credito_digitales'];
				//Asignar acumulados generales
				//Subtotales generales
				$intAcumGralSubtotal = $otdMovimientosCtes['acumulado_subtotalFra'];
		        $intAcumGralCosto = $otdMovimientosCtes['acumulado_costoFra'];
		        $intAcumGralUtilidad = $otdMovimientosCtes['acumulado_utilidadFra'];
		        //Refacciones
		        $intAcumGralSubtotalRef = $otdMovimientosCtes['acumulado_subtotalRef'];
		        $intAcumGralCostoRef =  $otdMovimientosCtes['acumulado_costoRef'];
		        $intAcumGralUtilidadRef =  $otdMovimientosCtes['acumulado_utilidadRef'];
		        //Gastos de servicio
		        $intAcumGralSubtotalGS = $otdMovimientosCtes['acumulado_subtotalGS'];
		        $intAcumGralCostoGS = $otdMovimientosCtes['acumulado_costoGS'];
		        $intAcumGralUtilidadGS = $otdMovimientosCtes['acumulado_utilidadGS'];
		        //Devoluciones
				$intAcumGralSubtotalDev = $otdMovimientosCtes['acumulado_subtotalDev'];
		        $intAcumGralIvaDev = $otdMovimientosCtes['acumulado_ivaDev'];
		        $intAcumGralIepsDev = $otdMovimientosCtes['acumulado_iepsDev'];
		        $intAcumGralTotalDev = $otdMovimientosCtes['acumulado_totalDev'];
		        $intAcumGralCostoDev = $otdMovimientosCtes['acumulado_costoDev'];
		        $intAcumGralUtilidadDev = $otdMovimientosCtes['acumulado_utilidadDev'];
		        //Notas de crédito digitales
				$intAcumGralSubtotalNCD = $otdMovimientosCtes['acumulado_subtotalNCD'];
		        $intAcumGralIvaNCD = $otdMovimientosCtes['acumulado_ivaNCD'];
		        $intAcumGralIepsNCD = $otdMovimientosCtes['acumulado_iepsNCD'];
		        $intAcumGralTotalNCD = $otdMovimientosCtes['acumulado_totalNCD'];
		        $intAcumGralCostoNCD = $otdMovimientosCtes['acumulado_costoNCD'];
		        $intAcumGralUtilidadNCD = $otdMovimientosCtes['acumulado_utilidadNCD'];

		       

		        //Calcular importe de los abonos generales
		        $intAcumAbonosSubtotal = ($intAcumGralSubtotalDev + 
		        						  $intAcumGralSubtotalNCD);

		        $intAcumAbonosCosto = ($intAcumGralCostoDev + $intAcumGralCostoNCD);

		        $intAcumAbonosUtilidad = ($intAcumGralUtilidadDev  + 
		        						  $intAcumGralUtilidadNCD);

		      	
		      	//Si hay información de las facturas
		      	if($arrFacturas)
		      	{
		      		//Decrementar acumulado general de las facturas
		  			$intAcumGralSubtotal -= $intAcumAbonosSubtotal;
					$intAcumGralCosto -= $intAcumAbonosCosto;
					$intAcumGralUtilidad -= $intAcumAbonosUtilidad;
		      	}
		      	else
		      	{
		      		//Asignar acumulado general de abonos
		      		$intAcumGralSubtotal = $intAcumAbonosSubtotal;
					$intAcumGralCosto = $intAcumAbonosCosto;
					$intAcumGralUtilidad = $intAcumAbonosUtilidad;
		      	}
		      	

				//Si hay información de las facturas, devoluciones y/o notas de crédito
				if($arrFacturas OR $arrDevoluciones OR $arrNotasCreditoDigitales)
				{
					//Concatenar moneda para el primer encabezado del reporte
					$strTituloMoneda = $strTituloLinea1.strtoupper($arrMon->descripcion);

					//Cambiar descripción de la primer línea del título
					$pdf->strLinea1 = $strTituloMoneda.'     '.$strTituloRangoFechas;
					
					//Si el tipo de reporte no corresponde a separado por tipo (Mostrador, Refaccionario, Campo, etc.)
					if($strTipoReporte != 'SEPARADO_TIPO' && $strTipoReporte != 'SEPARADO_CONDICIONES_PAGO' )
					{
		      			//Crea los titulos de la primer cabecera 
						$pdf->arrCabecera = array();

						//Agregar pagina
						$pdf->AddPage();

						//Asignar acumulados generales
						$intAcumGralSubtotalFras = $otdMovimientosCtes['acumulado_subtotalFra'];
				        $intAcumGralIvaFras = $otdMovimientosCtes['acumulado_ivaFra'];
				        $intAcumGralIepsFras = $otdMovimientosCtes['acumulado_iepsFra'];
				        $intAcumGralTotalFras = $otdMovimientosCtes['acumulado_totalFra'];
				        $intAcumGralCostoFras = $otdMovimientosCtes['acumulado_costoFra'];
				        $intAcumGralUtilidadFras = $otdMovimientosCtes['acumulado_utilidadFra'];

					}//Cierre de verificación del tipo de reporte

					//Si hay información de las facturas
					if($arrFacturas)
					{
						//Cambiar descripción de la primer columna
		      			$arrCabecera2[0] = 'FACTURA';
		      			//Cambiar los títulos de la segunda cabecera 
		      			$pdf->arrCabecera2 = $arrCabecera2;

						//Recorremos el arreglo 
						foreach ($arrFacturas as $arrFra)
						{

							//Si el tipo de reporte corresponde a separado por tipo (Mostrador, Refaccionario, Campo, etc.)
							if($strTipoReporte == 'SEPARADO_TIPO' OR $strTipoReporte == 'SEPARADO_CONDICIONES_PAGO')
							{
								//Dependiendo del reporte asignar tipo
								$strReferencia = (($strTipoReporte == 'SEPARADO_TIPO') ? 
							          			   $arrFra['tipo'] : $arrFra['condiciones_pago']);


								//Si se cumple la sentencia
					      		if ($strTipoActual == '' OR 
					      			$strTipoActual != $strReferencia)
					      		{

					      			//Cambiar el título de la primer cabecera
					      			$strTituloCabecera = utf8_decode('FACTURACIÓN DE '.$strReferencia);

					      			//Crea los titulos de la primer cabecera 
									$pdf->arrCabecera = array($strTituloCabecera);

									//Si el tipo actual es igual a cadena vacia (primer tipo)
					      			if(($strTipoActual == '') OR 
					      			   ($intMonedaIDActual > 0 && $intMonedaIDActual != $arrMon->moneda_id)) 
					      			{
					      				//Agregar la primer pagina
										$pdf->AddPage();

										//Si cambia el cambia el id de la moneda actual
										if($intMonedaIDActual > 0 && $intMonedaIDActual != $arrMon->moneda_id)
										{
											//Inicializar variables
											$intAcumGralSubtotalFras = 0;
									        $intAcumGralIvaFras = 0;
									        $intAcumGralIepsFras = 0;
									        $intAcumGralTotalFras = 0;
									        $intAcumGralCostoFras = 0;
									        $intAcumGralUtilidadFras = 0;
										}
					      			}
					      			else
					      			{

					      				$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
											
					      				//Escribir totales
							   			//Establece el ancho de las columnas
								    	$pdf->SetWidths($arrAnchuraTotales);
									    //Cambiar el volumen de la fuente a bold
						      			$pdf->strTipoLetraTabla = 'Negrita';

						      			//Array que se utiliza para agregar los datos de los acumulados
										$arrDatos = array();
										$arrDatos[] = 'TOTAL:';
										$arrDatos[] = '$'.number_format($intAcumGralSubtotalFras,2);
										$arrDatos[] = '$'.number_format($intAcumGralIvaFras,2);
										$arrDatos[] = '$'.number_format($intAcumGralIepsFras,2);
										$arrDatos[] = '$'.number_format($intAcumGralTotalFras,2);

										//Si se cumple la sentencia mostrar agregar columnas de costos
									    if($strIncluirCostos == 'SI')
									    {
									    	$arrDatos[] = '$'.number_format($intAcumGralCostoFras,2);
									    	$arrDatos[] = '$'.number_format($intAcumGralUtilidadFras,2);
									    }

						      			//Acumulados
										$pdf->Row($arrDatos, $arrAlineacionTotales, 'ClippedCell');
										//Cambiar el volumen de la fuente a normal
						      			$pdf->strTipoLetraTabla = '';

					      				$pdf->Ln(5); //Deja un salto de línea
										$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
										//Asigna el tipo y tamaño de letra
										$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
										//Asigna el tipo y tamaño de letra
										$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);

										//Asignar posición de la ordenada
										$intPosY = $pdf->GetY();

										//Si se cumple la sentencia
										if($intPosY >= POSY_SALTO_PAGINA)
										{
											 //Emitir un salto de página
											 $pdf->CheckPageBreak($intPosY);

										}
										else
										{
											//inserta el titulo de la primer cabecera
											$pdf->Cell(190, 5, $strTituloCabecera, 1, 0, 'L', TRUE);
											$pdf->Ln(5); //Deja un salto de línea
											//Cambiar título de la primer cabecera
											$pdf->arrCabecera = array($strTituloCabecera);

						      				//Recorre el array de títulos del segundo encabezado para crearlos 
											for ($intCont = 0; $intCont < count($pdf->arrCabecera2); $intCont++)
											{
												//inserta los titulos de la segunda cabecera
												$pdf->Cell($pdf->arrAnchura2[$intCont], 5, 
														   $pdf->arrCabecera2[$intCont], 1, 0, 
														   $pdf->arrAlineacion2[$intCont], TRUE);
											}

											$pdf->Ln(); //Deja un salto de línea
										}

										//Inicializar variables
										$intAcumGralSubtotalFras = 0;
								        $intAcumGralIvaFras = 0;
								        $intAcumGralIepsFras = 0;
								        $intAcumGralTotalFras = 0;
								        $intAcumGralCostoFras = 0;
								        $intAcumGralUtilidadFras = 0;
					      			}

									//Asignar el tipo actual (Mostrador, Refaccionario, Campo, etc.) 
						      	    $strTipoActual = (($strTipoReporte == 'SEPARADO_TIPO') ? 
							          			   $arrFra['tipo'] : $arrFra['condiciones_pago']);

					      		}

					      		//Incrementar acumulados si el estatus es ACTIVO o TIMBRAR
								if($arrFra['estatus'] == 'ACTIVO' OR $arrFra['estatus'] == 'TIMBRAR')
								{

									$intAcumGralSubtotalFras += $arrFra['subtotal'];
							        $intAcumGralIvaFras += $arrFra['iva'];
							        $intAcumGralIepsFras += $arrFra['ieps'];
							        $intAcumGralTotalFras += $arrFra['importe'];
							        $intAcumGralCostoFras += $arrFra['acumulado_costo'];
							        $intAcumGralUtilidadFras += $arrFra['utilidad'];
								}

							}//Cierre de verificación del tipo de reporte

							//Array que se utiliza para agregar los datos de la factura
							$arrDatos = array();
							$arrDatos[] = $arrFra['folio'];
							$arrDatos[] = utf8_decode($arrFra['razon_social']);
							$arrDatos[] = $arrFra['fecha'];
							$arrDatos[] = '$'.number_format($arrFra['subtotal'],2);
							$arrDatos[] = '$'.number_format($arrFra['iva'],2);
							$arrDatos[] = '$'.number_format($arrFra['ieps'],2);
							$arrDatos[] = '$'.number_format($arrFra['importe'],2);

							//Si se cumple la sentencia mostrar agregar columnas de costos
						    if($strIncluirCostos == 'SI')
						    {
						    	$arrDatos[] = '$'.number_format($arrFra['acumulado_costo'],2);
								$arrDatos[] = '$'.number_format($arrFra['utilidad'],2);
							}

							$arrDatos[] = $arrFra['estatus'];
							//Establece el ancho de las columnas
							$pdf->SetWidths($pdf->arrAnchura2);
							//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							$pdf->Row($arrDatos, $pdf->arrAlineacion2, 'ClippedCell');
							//Asigna el tipo y tamaño de letra
					        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
						    //Tipo (Mostrador, Refaccionario, Campo, etc.)
							$pdf->Cell(8, 4, 'TIPO:', 0, 0, 'L', 0);
						    $pdf->ClippedCell(35, 4, utf8_decode($arrFra['tipo']), 0, 0, 'L', 0);
						    //Condiciones de pago (Crédito/Contado)
							$pdf->Cell(18, 4, 'TIPO DE VENTA:', 0, 0, 'L', 0);
						    $pdf->ClippedCell(27, 4, utf8_decode($arrFra['condiciones_pago']), 0, 0, 'L', 0);
						    //Sucursal
							$pdf->Cell(14, 4, 'SUCURSAL:', 0, 0, 'L', 0);
						    $pdf->ClippedCell(40, 4, utf8_decode($arrFra['sucursal']), 0, 0, 'L', 0);

						    //Si se cumple la sentencia mostrar detalles del registro
							if($arrFra['detalles'][0] && $strIncluirDetalleFras == 'SI')
							{
								$pdf->Ln(5);//Deja un salto de línea
								//Establece el ancho de las columnas
								$pdf->SetWidths($arrAnchuraDetalles);

								/*
								*****************************************************************************************************************
								* DETALLES DE LA FACTURA
								*****************************************************************************************************************
								*/
								//Recorremos el arreglo 
						        foreach ($arrFra['detalles'][0] as $arrDet) 
						        {

						        	//Array que se utiliza para agregar los datos del detalle
									$arrDatos = array();
									$arrDatos[] = $arrDet['codigo'];
									$arrDatos[] = utf8_decode($arrDet['descripcion']);
									$arrDatos[] = '$'.number_format($arrDet['subtotal'],2);
									
									//Si se cumple la sentencia mostrar agregar columnas de costos
								    if($strIncluirCostos == 'SI')
								    {	
								    	//Variable que se utiliza para asignar el acumulado del costo
				    					$strCosto =   (($arrDet['acumulado_costo'] != '') ? 
						  								'$'.number_format($arrDet['acumulado_costo'],2) : '');

								    	$arrDatos[] = $strCosto;
										$arrDatos[] = '$'.number_format($arrDet['utilidad'],2);
									}


									//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
									$pdf->Row($arrDatos, $arrAlineacionDetalles, 'ClippedCell');

						        }//Cierre de foreach detalles de la factura


							}//Cierre de verificación de detalles


						    $pdf->Ln(5);//Deja un salto de línea

						}//Cierre de foreach de facturas



						$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
						
	      				//Escribir totales
			   			//Establece el ancho de las columnas
				    	$pdf->SetWidths($arrAnchuraTotales);
					    //Cambiar el volumen de la fuente a bold
		      			$pdf->strTipoLetraTabla = 'Negrita';

		      			//Array que se utiliza para agregar los datos de los acumulados
						$arrDatos = array();
						$arrDatos[] = 'TOTAL:';
						$arrDatos[] = '$'.number_format($intAcumGralSubtotalFras,2);
						$arrDatos[] = '$'.number_format($intAcumGralIvaFras,2);
						$arrDatos[] = '$'.number_format($intAcumGralIepsFras,2);
						$arrDatos[] = '$'.number_format($intAcumGralTotalFras,2);

						//Si se cumple la sentencia mostrar agregar columnas de costos
					    if($strIncluirCostos == 'SI')
					    {
					    	$arrDatos[] = '$'.number_format($intAcumGralCostoFras,2);
					    	$arrDatos[] = '$'.number_format($intAcumGralUtilidadFras,2);
					    }

		      			//Acumulados
						$pdf->Row($arrDatos, $arrAlineacionTotales, 'ClippedCell');
						//Cambiar el volumen de la fuente a normal
						$pdf->strTipoLetraTabla = '';

					}//Cierre de verificación de facturas


					//Si se cumple la sentencia incluir notas de crédito (digitales/servicio)
					if($strIncluirNotasCredito == 'SI')
					{
						//Si hay información de las  notas de crédito digitales
						if($arrNotasCreditoDigitales)
						{
							//Cambiar el título de la primer cabecera
			      			$strTituloCabecera = utf8_decode('NOTAS DE CRÉDITO DIGITALES');
			      			//Cambiar descripción de la primer columna
			      			$arrCabecera2[0] = 'FOLIO';
			      			//Cambiar los títulos de la segunda cabecera 
			      			$pdf->arrCabecera2 = $arrCabecera2;

			      			//Crea los titulos de la primer cabecera 
							$pdf->arrCabecera = array($strTituloCabecera);
							//Agregar pagina
							$pdf->AddPage();

						    //Recorremos el arreglo 
							foreach ($arrNotasCreditoDigitales as $arrNCD)
							{
								//Array que se utiliza para agregar los datos de la notas de crédito
								$arrDatos = array();
								$arrDatos[] = $arrNCD['folio'];
								$arrDatos[] = utf8_decode($arrNCD['razon_social']);
								$arrDatos[] = $arrNCD['fecha'];
								$arrDatos[] = '$'.number_format($arrNCD['subtotal'],2);
								$arrDatos[] = '$'.number_format($arrNCD['iva'],2);
								$arrDatos[] = '$'.number_format($arrNCD['ieps'],2);
								$arrDatos[] = '$'.number_format($arrNCD['importe'],2);

								//Si se cumple la sentencia mostrar agregar columnas de costos
							    if($strIncluirCostos == 'SI')
							    {
							    	$arrDatos[] = '$'.number_format($arrNCD['acumulado_costo'],2);
									$arrDatos[] = '$'.number_format($arrNCD['utilidad'],2);
								}

								$arrDatos[] = $arrNCD['estatus'];
								//Establece el ancho de las columnas
								$pdf->SetWidths($pdf->arrAnchura2);
								//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
								$pdf->Row($arrDatos, $pdf->arrAlineacion2, 'ClippedCell');
								//Asigna el tipo y tamaño de letra
						        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
						        //Folio de la factura
					    		$pdf->Cell(12, 4, 'FACTURA:', 0, 0, 'L', 0);
						    	$pdf->ClippedCell(18, 4, $arrNCD['folio_factura'], 0, 0, 'L', 0);
							    //Orden de reparación
						    	$pdf->Cell(8, 4, 'TIPO:', 0, 0, 'L', 0);
							    $pdf->ClippedCell(35, 4, $arrNCD['tipo'], 0, 0, 'L', 0);
							    //tipo (Mostrador, Refaccionario, Campo, etc.)
								$pdf->Cell(18, 4, 'TIPO DE VENTA:', 0, 0, 'L', 0);
							    $pdf->ClippedCell(27, 4, utf8_decode($arrNCD['condiciones_pago']), 0, 0, 'L', 0);
							    //Sucursal
								$pdf->Cell(14, 4, 'SUCURSAL:', 0, 0, 'L', 0);
							    $pdf->ClippedCell(38, 4, utf8_decode($arrNCD['sucursal']), 0, 0, 'L', 0);
							    
							    $pdf->Ln(5);//Deja un salto de línea

							}//Cierre de foreach de notas de crédito digitales


							 $pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
							
		      				//Escribir totales
				   			//Establece el ancho de las columnas
					    	$pdf->SetWidths($arrAnchuraTotales);
						    //Cambiar el volumen de la fuente a bold
			      			$pdf->strTipoLetraTabla = 'Negrita';

			      			//Array que se utiliza para agregar los datos de los acumulados
							$arrDatos = array();
							$arrDatos[] = 'TOTAL:';
							$arrDatos[] = '$'.number_format($intAcumGralSubtotalNCD,2);
							$arrDatos[] = '$'.number_format($intAcumGralIvaNCD,2);
							$arrDatos[] = '$'.number_format($intAcumGralIepsNCD,2);
							$arrDatos[] = '$'.number_format($intAcumGralTotalNCD,2);

							//Si se cumple la sentencia mostrar agregar columnas de costos
						    if($strIncluirCostos == 'SI')
						    {
						    	$arrDatos[] = '$'.number_format($intAcumGralCostoNCD,2);
						    	$arrDatos[] = '$'.number_format($intAcumGralUtilidadNCD,2);
						    }

			      			//Acumulados
							$pdf->Row($arrDatos, $arrAlineacionTotales, 'ClippedCell');
							//Cambiar el volumen de la fuente a normal
			      			$pdf->strTipoLetraTabla = '';

						}//Cierre de verificación de notas de crédito



					}//Cierre de verificación para incluir notas de crédito


					//Si hay información de las devoluciones
					if($arrDevoluciones && $strIncluirDevoluciones == 'SI')
					{

						//Cambiar el título de la primer cabecera
		      			$strTituloCabecera = utf8_decode('DEVOLUCIONES');
		      			//Cambiar descripción de la primer columna
		      			$arrCabecera2[0] = 'FOLIO';
		      			//Cambiar los títulos de la segunda cabecera 
		      			$pdf->arrCabecera2 = $arrCabecera2;

		      			//Crea los titulos de la primer cabecera 
						$pdf->arrCabecera = array($strTituloCabecera);
						//Agregar pagina
						$pdf->AddPage();

						//Recorremos el arreglo 
						foreach ($arrDevoluciones as $arrDev)
						{
							//Array que se utiliza para agregar los datos de la devolución
							$arrDatos = array();
							$arrDatos[] = $arrDev['folio'];
							$arrDatos[] = utf8_decode($arrDev['razon_social']);
							$arrDatos[] = $arrDev['fecha'];
							$arrDatos[] = '$'.number_format($arrDev['subtotal'],2);
							$arrDatos[] = '$'.number_format($arrDev['iva'],2);
							$arrDatos[] = '$'.number_format($arrDev['ieps'],2);
							$arrDatos[] = '$'.number_format($arrDev['importe'],2);

							//Si se cumple la sentencia mostrar agregar columnas de costos
						    if($strIncluirCostos == 'SI')
						    {
						    	$arrDatos[] = '$'.number_format($arrDev['acumulado_costo'],2);
								$arrDatos[] = '$'.number_format($arrDev['utilidad'],2);
							}

							$arrDatos[] = $arrDev['estatus'];
							//Establece el ancho de las columnas
							$pdf->SetWidths($pdf->arrAnchura2);
							//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							$pdf->Row($arrDatos, $pdf->arrAlineacion2, 'ClippedCell');
							//Asigna el tipo y tamaño de letra
					        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
					        //Folio de la factura
					    	$pdf->Cell(12, 4, 'FACTURA:', 0, 0, 'L', 0);
						    $pdf->ClippedCell(18, 4, $arrDev['folio_factura'], 0, 0, 'L', 0);
						    //tipo (Mostrador, Refaccionario, Campo, etc.)
							$pdf->Cell(22, 4, 'TIPO:', 0, 0, 'L', 0);
						    $pdf->ClippedCell(35, 4, utf8_decode($arrDev['tipo']), 0, 0, 'L', 0);
						    //Sucursal
							$pdf->Cell(14, 4, 'SUCURSAL:', 0, 0, 'L', 0);
						    $pdf->ClippedCell(38, 4, utf8_decode($arrDev['sucursal']), 0, 0, 'L', 0);

						     //Si se cumple la sentencia mostrar detalles del registro
							if($arrDev['detalles'][0] && $strIncluirDetalleFras == 'SI')
							{
								$pdf->Ln(5);//Deja un salto de línea
								//Establece el ancho de las columnas
								$pdf->SetWidths($arrAnchuraDetalles);

								/*
								*****************************************************************************************************************
								* DETALLES DE LA DEVOLUCIÓN
								*****************************************************************************************************************
								*/
								//Recorremos el arreglo 
						        foreach ($arrDev['detalles'][0] as $arrDet) 
						        {

						        	//Array que se utiliza para agregar los datos del detalle
									$arrDatos = array();
									$arrDatos[] = utf8_decode($arrDet['codigo']);
									$arrDatos[] = utf8_decode($arrDet['descripcion']);
									$arrDatos[] = '$'.number_format($arrDet['subtotal'],2);
									
									//Si se cumple la sentencia mostrar agregar columnas de costos
								    if($strIncluirCostos == 'SI')
								    {	
								    	//Variable que se utiliza para asignar el acumulado del costo
				    					$strCosto =   (($arrDet['acumulado_costo'] != '') ? 
						  								'$'.number_format($arrDet['acumulado_costo'],2) : '');

								    	$arrDatos[] = $strCosto;
										$arrDatos[] = '$'.number_format($arrDet['utilidad'],2);
									}


									//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
									$pdf->Row($arrDatos, $arrAlineacionDetalles, 'ClippedCell');

						        }//Cierre de foreach detalles de la devolución

							}//Cierre de verificación de detalles


						    $pdf->Ln(5);//Deja un salto de línea

						}//Cierre de foreach de devoluciones


						 $pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
						
	      				//Escribir totales
			   			//Establece el ancho de las columnas
				    	$pdf->SetWidths($arrAnchuraTotales);
					    //Cambiar el volumen de la fuente a bold
		      			$pdf->strTipoLetraTabla = 'Negrita';

		      			//Array que se utiliza para agregar los datos de los acumulados
						$arrDatos = array();
						$arrDatos[] = 'TOTAL:';
						$arrDatos[] = '$'.number_format($intAcumGralSubtotalDev,2);
						$arrDatos[] = '$'.number_format($intAcumGralIvaDev,2);
						$arrDatos[] = '$'.number_format($intAcumGralIepsDev,2);
						$arrDatos[] = '$'.number_format($intAcumGralTotalDev,2);

						//Si se cumple la sentencia mostrar agregar columnas de costos
					    if($strIncluirCostos == 'SI')
					    {
					    	$arrDatos[] = '$'.number_format($intAcumGralCostoDev,2);
					    	$arrDatos[] = '$'.number_format($intAcumGralUtilidadDev,2);
					    }

		      			//Acumulados
						$pdf->Row($arrDatos, $arrAlineacionTotales, 'ClippedCell');
						//Cambiar el volumen de la fuente a normal
		      			$pdf->strTipoLetraTabla = '';

					}//Cierre de verificación de devoluciones



					/*
					*****************************************************************************************************************
					* SUBTOTALES GENERALES
					*****************************************************************************************************************
					*/
					$pdf->Ln(15);//Deja un salto de línea

					//Establece el ancho de las columnas
				    $pdf->SetWidths($arrAnchuraTotales);

					//Escribir acumulados generales del subtotal
					$pdf->Row(array('SUBTOTALES GENERALES:|Negrita'), $arrAlineacionTotales, 'ClippedCell');
					
					

					//Si existe subtotal general de refacciones
					if($intAcumGralSubtotalRef > 0)
					{
						/*****REFACCIONES**/
						//Array que se utiliza para agregar los datos de los acumulados
						$arrDatos = array();
						$arrDatos[] = 'REFACCIONES:';
						$arrDatos[] = '$'.number_format($intAcumGralSubtotalRef,2);
						
						//Si se cumple la sentencia mostrar agregar columnas de costos
					    if($strIncluirCostos == 'SI')
					    {
					    	$arrDatos[] = '$'.number_format($intAcumGralCostoRef,2);
							$arrDatos[] = '$'.number_format($intAcumGralUtilidadRef,2);
					    }

		      			//Acumulados
						$pdf->Row($arrDatos, $arrAlineacionTotales, 'ClippedCell');

					}//Cierre de verificación de acumulado de refacciones



				

					//Si existe subtotal general de gastos de servicio
					if($intAcumGralSubtotalGS > 0)
					{
						/*****GASTOS DE SERVICIO*****/
						//Array que se utiliza para agregar los datos de los acumulados
						$arrDatos = array();
						$arrDatos[] = 'GASTOS DE PAQUETERIA:';
						$arrDatos[] = '$'.number_format($intAcumGralSubtotalGS,2);
						
						//Si se cumple la sentencia mostrar agregar columnas de costos
					    if($strIncluirCostos == 'SI')
					    {
					    	$arrDatos[] = '';
							$arrDatos[] = '$'.number_format($intAcumGralUtilidadGS,2);
					    }

		      			//Acumulados
						$pdf->Row($arrDatos, $arrAlineacionTotales, 'ClippedCell');

					}//Cierre de verificación de acumulado de gastos de servicio

					//Si existe subtotal general de notas de crédito digitales
					if($intAcumGralSubtotalNCD > 0)
					{
						/*****NOTAS DE CRÉDITO DIGITALES*****/
						//Array que se utiliza para agregar los datos de los acumulados
						$arrDatos = array();
						$arrDatos[] = utf8_decode('NOTAS DE CRÉDITO DIGITALES:');
						$arrDatos[] = '$'.number_format($intAcumGralSubtotalNCD,2);
						
						//Si se cumple la sentencia mostrar agregar columnas de costos
					    if($strIncluirCostos == 'SI')
					    {
					    	$arrDatos[] = '';
							$arrDatos[] = '$'.number_format($intAcumGralUtilidadNCD,2);
					    }

		      			//Acumulados
						$pdf->Row($arrDatos, $arrAlineacionTotales, 'ClippedCell');

					}//Cierre de verificación de acumulado de notas de crédito digitales

				

					//Si existe subtotal general de devoluciones
					if($intAcumGralSubtotalDev > 0)
					{
						/*****DEVOLUCIONES*****/
						//Array que se utiliza para agregar los datos de los acumulados
						$arrDatos = array();
						$arrDatos[] = 'DEVOLUCIONES:';
						$arrDatos[] = '$'.number_format($intAcumGralSubtotalDev,2);
						
						//Si se cumple la sentencia mostrar agregar columnas de costos
					    if($strIncluirCostos == 'SI')
					    {
					    	$arrDatos[] = '$'.number_format($intAcumGralCostoDev,2);
							$arrDatos[] = '$'.number_format($intAcumGralUtilidadDev,2);
					    }

		      			//Acumulados
						$pdf->Row($arrDatos, $arrAlineacionTotales, 'ClippedCell');

					}//Cierre de verificación de acumulado de devoluciones


					$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los acumulados

					//Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';

	      			//Array que se utiliza para agregar los datos de los acumulados
					$arrDatos = array();
					$arrDatos[] = 'SUBTOTAL:';
					$arrDatos[] = '$'.number_format($intAcumGralSubtotal,2);

					//Si se cumple la sentencia mostrar agregar columnas de costos
				    if($strIncluirCostos == 'SI')
				    {
				    	$arrDatos[] = '$'.number_format($intAcumGralCosto,2);
				    	$arrDatos[] = '$'.number_format($intAcumGralUtilidad,2);
				    }

	      			//Acumulados
					$pdf->Row($arrDatos, $arrAlineacionTotales, 'ClippedCell');
					//Cambiar el volumen de la fuente a normal
	      			$pdf->strTipoLetraTabla = '';

			    }//Cierre de verificación de facturas, devoluciones y/o notas de crédito


				//Asignar el id de la moneda actual
				$intMonedaIDActual = $arrMon->moneda_id;

			}//Cierre de foreach de monedas

		}//Cierre de verificación de monedas

		//Ejecutar la salida del reporte
        $pdf->Output('facturacion_refacciones.pdf','I'); 
	}




    /*Método para generar un archivo XLS con las facturas de refacciones 
      *dependiendo del criterio de búsqueda proporcionado*/
     public function get_xls()
    {
    	///Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProspectoID = $this->input->post('intProspectoID');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strTipos = trim($this->input->post('strTipos'));
		$strTipoReporte = $this->input->post('strTipoReporte');
		$strIncluirCostos = $this->input->post('strIncluirCostos');
		$strIncluirNotasCredito = $this->input->post('strIncluirNotasCredito');
		$strIncluirDevoluciones = $this->input->post('strIncluirDevoluciones');
		$strIncluirDetalleFras = $this->input->post('strIncluirDetalleFras');

    	//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 12;
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
	    //Array que se utiliza para agregar los datos de las facturas
	    $arrFacturas = array();
	    //Array que se utiliza para agregar los datos de las devoluciones
	    $arrDevoluciones = array();
	    //Array que se utiliza para agregar los datos de las notas de crédito digitales
	    $arrNotasCreditoDigitales = array();
		//Variable que se utiliza para asignar el acumulado general del subtotal de facturas
        $intAcumGralSubtotalFras = 0;
        //Variable que se utiliza para asignar el acumulado general del IVA de facturas
        $intAcumGralIvaFras = 0;
        //Variable que se utiliza para asignar el acumulado general del IEPS de facturas
        $intAcumGralIepsFras = 0;
        //Variable que se utiliza para asignar el acumulado general del total de facturas
        $intAcumGralTotalFras = 0;
        //Variable que se utiliza para asignar el acumulado general del costo de facturas
        $intAcumGralCostoFras = 0;
        //Variable que se utiliza para asignar el acumulado  generalde la utilidad de facturas
        $intAcumGralUtilidadFras = 0;
	    //Variable que se utiliza para asignar el número de registros por cada moneda
		$intNumRegistros = 0; 
		//Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última moneda)
		$intNumMaxRegistros = 0;
	   	//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

		//Quitar espacios vacíos y decodificar cadena cifrada
		$strSucursales = trim(urldecode($strSucursales));

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


		
		//Buscar el nombre de las sucursales que han sido seleccionadas y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 3
	    $strTituloTipos = '';
	    $arrTipos = explode('|', $strTipos);
	     //Hacer recorrido para obtener el id de los tipos de venta
	    foreach ($arrTipos as &$strTipo) 
	    {		    
			//Concatenamos el nombre del tipo de venta a la variable de impresión
			$strTituloTipos .= $strTipo.', ';
		}

		//Quitar último elemento de la cadena (,)
		$strTituloTipos = substr($strTituloTipos, 0, -2);

		

		
		//Array que se utiliza para establecer los títulos de las cabeceras
	    $arrCabeceraFra = array('FACTURA', 'CLIENTE', 'FECHA', 'SUBTOTAL', 'IVA', 'IEPS', 'TOTAL');
	    $arrCabeceraDev = array('FOLIO', 'CLIENTE', 'FECHA', 'SUBTOTAL', 'IVA', 'IEPS', 'TOTAL');
	    $arrCabeceraNC = array('FOLIO', 'CLIENTE', 'FECHA', 'SUBTOTAL', 'IVA', 'IEPS', 'TOTAL');

		//Si se cumple la sentencia mostrar agregar columnas de costos
	    if($strIncluirCostos == 'SI')
	    {	
	    	//Costo
			$arrCabeceraFra[] = 'COSTO';
			$arrCabeceraDev[] = 'COSTO';
			$arrCabeceraNC[] = 'COSTO';
			//Utilidad
			$arrCabeceraFra[] = 'UTILIDAD';
			$arrCabeceraDev[] = 'UTILIDAD';
			$arrCabeceraNC[] = 'UTILIDAD';

		}//Cierre de verificación de costos

		//Folio de la factura
		$arrCabeceraDev[] = 'FACTURA';
		$arrCabeceraNC[] = 'FACTURA';

		//Tipo
		$arrCabeceraFra[] = 'TIPO';
		$arrCabeceraDev[] = 'TIPO';
		$arrCabeceraNC[] = 'TIPO';
		//Condiciones de pago
		$arrCabeceraFra[] = 'TIPO DE VENTA';
		$arrCabeceraDev[] = 'TIPO DE VENTA';
		$arrCabeceraNC[] = 'TIPO DE VENTA';
		//Sucursal
		$arrCabeceraFra[] = 'SUCURSAL';
		$arrCabeceraDev[] = 'SUCURSAL';
		$arrCabeceraNC[] = 'SUCURSAL';
		//Estatus
		$arrCabeceraFra[] = 'ESTATUS';
	    $arrCabeceraDev[] = 'ESTATUS';
	    $arrCabeceraNC[] = 'ESTATUS';

		//Si se cumple la sentencia agregar las columnas que corresponden a los detalles
		if($strIncluirDetalleFras == 'SI')
		{	

			//Columnas de los detalles
			$arrCabeceraFra[] = 'CÓDIGO';
			$arrCabeceraDev[] = 'CÓDIGO';
			$arrCabeceraFra[] = 'DESCRIPCIÓN';
			$arrCabeceraDev[] = 'DESCRIPCIÓN';
			$arrCabeceraFra[] = 'SUBTOTAL';
			$arrCabeceraDev[] = 'SUBTOTAL';
			//Si se cumple la sentencia mostrar agregar columnas de costos
	    	if($strIncluirCostos == 'SI')
	    	{
				$arrCabeceraFra[] = 'COSTO';
				$arrCabeceraDev[] = 'COSTO';
				$arrCabeceraFra[] = 'UTILIDAD';
				$arrCabeceraDev[] = 'UTILIDAD';
			}//Cierre de verificación de costos

		}



		//Concatenar datos para el primer encabezado del reporte
		$strTituloLinea1 = 'LISTADO DE MOVIMIENTOS EN ';
		$strTituloDetalles = '';

		//Si se cumple la sentencia mostrar detalles
	    if($strIncluirDetalleFras == 'SI')
	    {
	     	//Asignar el valor de la línea dos del título
	    	$strTituloDetalles = 'DETALLADO DE VENTAS';
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
				$strNombreHoja = 'facturas '.$arrMon->codigo;
				//Inicializar variables
				$arrFacturas = array();
				$arrDevoluciones = array();
				$arrNotasCreditoDigitales = array();
		        $intAcumGralSubtotalFras = 0;
		        $intAcumGralIvaFras = 0;
		        $intAcumGralIepsFras = 0;
		        $intAcumGralTotalFras = 0;
		        $intAcumGralCostoFras = 0;
		        $intAcumGralUtilidadFras = 0;

				//Asignar objeto con los movimientos de clientes en el rango de fechas
			    $otdMovimientosCtes = $this->get_movimientos($dteFechaInicial, $dteFechaFinal, 
			    											 $intProspectoID, $arrMon->moneda_id, 
			    											 $strSucursales, $strTipos, 
			    								      		 $strTipoReporte, $strIncluirDevoluciones,
			    								             $strIncluirNotasCredito);


			    
			    //Asignar array con los datos de las facturs
				$arrFacturas = $otdMovimientosCtes['facturas'];
				//Asignar array con los datos de las devoluciones
				$arrDevoluciones = $otdMovimientosCtes['devoluciones'];
				//Asignar array con los datos de las notas de crédito digitales
				$arrNotasCreditoDigitales = $otdMovimientosCtes['notas_credito_digitales'];
				
				//Asignar acumulados generales
		        //Subtotales generales
				$intAcumGralSubtotal = $otdMovimientosCtes['acumulado_subtotalFra'];
		        $intAcumGralCosto = $otdMovimientosCtes['acumulado_costoFra'];
		        $intAcumGralUtilidad = $otdMovimientosCtes['acumulado_utilidadFra'];
		        //Facturas
		        $intAcumGralSubtotalFras = $otdMovimientosCtes['acumulado_subtotalFra'];
		        $intAcumGralIvaFras = $otdMovimientosCtes['acumulado_ivaFra'];
		        $intAcumGralIepsFras = $otdMovimientosCtes['acumulado_iepsFra'];
		        $intAcumGralTotalFras = $otdMovimientosCtes['acumulado_totalFra'];
		        $intAcumGralCostoFras = $otdMovimientosCtes['acumulado_costoFra'];
		        $intAcumGralUtilidadFras = $otdMovimientosCtes['acumulado_utilidadFra'];
		        //Mano de obra
		        $intAcumGralSubtotalMO = $otdMovimientosCtes['acumulado_subtotalMO'];
		        $intAcumGralCostoMO = $otdMovimientosCtes['acumulado_costoMO'];
		        $intAcumGralUtilidadMO = $otdMovimientosCtes['acumulado_utilidadMO'];
		        //Refacciones
		        $intAcumGralSubtotalRef = $otdMovimientosCtes['acumulado_subtotalRef'];
		        $intAcumGralCostoRef =  $otdMovimientosCtes['acumulado_costoRef'];
		        $intAcumGralUtilidadRef =  $otdMovimientosCtes['acumulado_utilidadRef'];
		        //Trabajos foráneos
		        $intAcumGralSubtotalTF = $otdMovimientosCtes['acumulado_subtotalTF'];
		        $intAcumGralCostoTF = $otdMovimientosCtes['acumulado_costoTF'];
		        $intAcumGralUtilidadTF = $otdMovimientosCtes['acumulado_utilidadTF'];
		        //Otros
		        $intAcumGralSubtotalOtros = $otdMovimientosCtes['acumulado_subtotalOtros'];
		        $intAcumGralCostoOtros = $otdMovimientosCtes['acumulado_costoOtros'];
		        $intAcumGralUtilidadOtros = $otdMovimientosCtes['acumulado_utilidadOtros'];
		        //Gastos de servicio
		        $intAcumGralSubtotalGS = $otdMovimientosCtes['acumulado_subtotalGS'];
		        $intAcumGralCostoGS = $otdMovimientosCtes['acumulado_costoGS'];
		        $intAcumGralUtilidadGS = $otdMovimientosCtes['acumulado_utilidadGS'];
		        //Devoluciones
				$intAcumGralSubtotalDev = $otdMovimientosCtes['acumulado_subtotalDev'];
		        $intAcumGralIvaDev = $otdMovimientosCtes['acumulado_ivaDev'];
		        $intAcumGralIepsDev = $otdMovimientosCtes['acumulado_iepsDev'];
		        $intAcumGralTotalDev = $otdMovimientosCtes['acumulado_totalDev'];
		        $intAcumGralCostoDev = $otdMovimientosCtes['acumulado_costoDev'];
		        $intAcumGralUtilidadDev = $otdMovimientosCtes['acumulado_utilidadDev'];
		        //Notas de crédito digitales
				$intAcumGralSubtotalNCD = $otdMovimientosCtes['acumulado_subtotalNCD'];
		        $intAcumGralIvaNCD = $otdMovimientosCtes['acumulado_ivaNCD'];
		        $intAcumGralIepsNCD = $otdMovimientosCtes['acumulado_iepsNCD'];
		        $intAcumGralTotalNCD = $otdMovimientosCtes['acumulado_totalNCD'];
		        $intAcumGralCostoNCD = $otdMovimientosCtes['acumulado_costoNCD'];
		        $intAcumGralUtilidadNCD = $otdMovimientosCtes['acumulado_utilidadNCD'];

		        //Calcular importe de los abonos generales
		        $intAcumAbonosSubtotal = ($intAcumGralSubtotalDev + $intAcumGralSubtotalNCD);

		        $intAcumAbonosCosto = ($intAcumGralCostoDev + $intAcumGralCostoNCD);

		        $intAcumAbonosUtilidad = ($intAcumGralUtilidadDev + 
		        						  $intAcumGralUtilidadNCD);

		      	
		      	//Si hay información de las facturas
		      	if($arrFacturas)
		      	{
		      		//Decrementar acumulado general de las facturas
		  			$intAcumGralSubtotal -= $intAcumAbonosSubtotal;
					$intAcumGralCosto -= $intAcumAbonosCosto;
					$intAcumGralUtilidad -= $intAcumAbonosUtilidad;
		      	}
		      	else
		      	{
		      		//Asignar acumulado general de abonos
		      		$intAcumGralSubtotal = $intAcumAbonosSubtotal;
					$intAcumGralCosto = $intAcumAbonosCosto;
					$intAcumGralUtilidad = $intAcumAbonosUtilidad;
		      	}


				//Concatenar datos para el primer encabezado del reporte
				$strEncabezado = $strTituloLinea1.'     '.$strTituloRangoFechas.'     '.$strTituloDetalles;
			
				//Se agrega el título del archivo
				//Hacer un llamado a la función para escribir el encabezado en el archivo excel
				$this->get_encabezado_archivo_xls($objExcel, $strEncabezado, $strTituloSucursales, 
				 								  $strTituloTipos, $intProspectoID);


		        //Si hay información de las facturas, devoluciones y/o notas de crédito
				if($arrFacturas OR $arrDevoluciones OR $arrNotasCreditoDigitales)
				{
					


					//Hacer un llamado a la función para agregar (o activar) una hoja en el archivo excel
				    $intContadorHojas = $this->get_hoja_archivo_excel($objExcel, $strNombreHoja, 
				    												  $intContadorHojas);

					//Concatenar moneda para el primer encabezado del reporte
					$strTituloLinea1 = 'LISTADO DE MOVIMIENTOS EN '.strtoupper($arrMon->descripcion);
					//Cambiar descripción de la primer línea del título
					$strEncabezado = $strTituloLinea1.'     '.$strTituloRangoFechas.'     '.$strTituloDetalles;
				

               		//Si hay información de las facturas
					if($arrFacturas)
					{
						//Número de fila donde se va a comenzar a rellenar
					    $intFila = 13;
					    $intFilaInicial = 13;

					    //Hacer un llamado a la función para escribir el encabezado en el archivo excel
				 		$this->get_encabezado_archivo_xls($objExcel, $strEncabezado, $strTituloSucursales, 
				 								  	      $strTituloTipos, $intProspectoID, 
				 								  	      $arrCabeceraFra);

						//Recorremos el arreglo 
						foreach ($arrFacturas as $arrFra)
						{

							//Array que se utiliza para agregar los datos de la factura
							$arrDatosFra = array();
							$arrDatosFra[] = $arrFra['folio'];
							$arrDatosFra[] = $arrFra['razon_social'];
							$arrDatosFra[] = $arrFra['fecha'];
							$arrDatosFra[] = $arrFra['subtotal'];
							$arrDatosFra[] = $arrFra['iva'];
							$arrDatosFra[] = $arrFra['ieps'];
							$arrDatosFra[] = $arrFra['importe'];

							//Si se cumple la sentencia mostrar agregar columnas de costos
						    if($strIncluirCostos == 'SI')
						    {
						    	$arrDatosFra[] = $arrFra['acumulado_costo'];
								$arrDatosFra[] = $arrFra['utilidad'];
							}

							$arrDatosFra[] = $arrFra['tipo'];
							$arrDatosFra[] = $arrFra['condiciones_pago'];
							$arrDatosFra[] = $arrFra['sucursal'];
							$arrDatosFra[] = $arrFra['estatus'];

							//Hacer un llamado a la función para escribir los datos de la factura
							$this->get_datos_registro_excel($objExcel, $arrDatosFra, 
														  $this->archivoExcel['intIndColInicial'], 
														  $intFila);



							//Asignar el número de columna donde se empezaran a escribir los datos de un detalle 
							$intIndColDetalle = count($arrDatosFra) + 1;

					    	//Si se cumple la sentencia mostrar detalles del registro
							if($arrFra['detalles'][0] && $strIncluirDetalleFras == 'SI')
							{

								/*
								*****************************************************************************************************************
								* DETALLES DE LA FACTURA
								*****************************************************************************************************************
								*/
								//Recorremos el arreglo 
						        foreach ($arrFra['detalles'][0] as $arrDet) 
						        {
						        	//Hacer un llamado a la función para escribir los datos de la factura
									$this->get_datos_registro_excel($objExcel, $arrDatosFra, 
																  $this->archivoExcel['intIndColInicial'], 
																  $intFila);

						        	//Array que se utiliza para agregar los datos del detalle
									$arrDatos = array();
									$arrDatos[] = $arrDet['codigo'];
									$arrDatos[] = $arrDet['descripcion'];
									$arrDatos[] = $arrDet['subtotal'];
									
									//Si se cumple la sentencia mostrar agregar columnas de costos
								    if($strIncluirCostos == 'SI')
								    {	
								    	
								    	$arrDatos[] = $arrDet['acumulado_costo'];
										$arrDatos[] = $arrDet['utilidad'];
									}

									//Hacer un llamado a la función para escribir los datos del detalle
								    $this->get_datos_registro_excel($objExcel, $arrDatos, 
																  $intIndColDetalle, 
																  $intFila);



							    	//Incrementar el indice para escribir los datos del siguiente registro
									$intFila++;

						        }//Cierre de foreach detalles de la factura



							}//Cierre de verificación de detalles

					    	//Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;
						   

						}//Cierre de foreach de facturas


						//Escribir totales
						//Array que se utiliza para agregar los datos de los acumulados
						$arrDatos = array();
						$arrDatos[] = '';//Factura
						$arrDatos[] = '';//Cliente
						$arrDatos[] = 'TOTAL:';
						$arrDatos[] = $intAcumGralSubtotalFras;
						$arrDatos[] = $intAcumGralIvaFras;
						$arrDatos[] = $intAcumGralIepsFras;
						$arrDatos[] = $intAcumGralTotalFras;

						//Si se cumple la sentencia mostrar agregar columnas de costos
					    if($strIncluirCostos == 'SI')
					    {
					    	$arrDatos[] = $intAcumGralCostoFras;
					    	$arrDatos[] = $intAcumGralUtilidadFras;
					    }


					    //Hacer un llamado a la función para escribir los datos de los acumulados
						$this->get_datos_registro_excel($objExcel, $arrDatos, 
														$this->archivoExcel['intIndColInicial'], 
													    $intFila);

						//Hacer un llamado a la función para cambiar el estilo de las celdas
						$this->get_estilo_celda($objExcel, $arrCabeceraFra, $intFilaInicial, $intFila);


						//Incrementar el número de registros (filas)
						$intNumRegistros += $intFila;

					}//Cierre de verificación de facturas



					//Si se cumple la sentencia incluir notas de crédito (digitales)
					if($strIncluirNotasCredito == 'SI')
					{
						//Si hay información de las  notas de crédito digitales
						if($arrNotasCreditoDigitales)
						{
							//Número de fila donde se va a comenzar a rellenar
						    $intFila = 14;
						    $intFilaInicial = 14;
							
							//Asignar el nombre de la hoja
							$strNombreHoja = 'notas digitales'.$arrMon->codigo;

							//Array que se utiliza para establecer los títulos de la cabecera
	   						$arrCabecera = array('NOTAS DE CRÉDITO DIGITALES');

	   						//Incrementar contador por cada hoja nueva
							$intContadorHojas++;

							//Hacer un llamado a la función para agregar (o activar) una hoja en el archivo excel
				   			$intContadorHojas = $this->get_hoja_archivo_excel($objExcel, $strNombreHoja, $intContadorHojas);

					         //Hacer un llamado a la función para escribir el encabezado en el archivo excel
				 			$this->get_encabezado_archivo_xls($objExcel, $strEncabezado, $strTituloSucursales, 
				 								  			  $strTituloTipos, $intProspectoID,
				 								  			  $arrCabeceraNC, $arrCabecera);


				 			//Recorremos el arreglo 
							foreach ($arrNotasCreditoDigitales as $arrNCD)
							{
								//Array que se utiliza para agregar los datos de la notas de crédito
								$arrDatos = array();
								$arrDatos[] = $arrNCD['folio'];
								$arrDatos[] = $arrNCD['razon_social'];
								$arrDatos[] = $arrNCD['fecha'];
								$arrDatos[] = $arrNCD['subtotal'];
								$arrDatos[] = $arrNCD['iva'];
								$arrDatos[] = $arrNCD['ieps'];
								$arrDatos[] = $arrNCD['importe'];

								//Si se cumple la sentencia mostrar agregar columnas de costos
							    if($strIncluirCostos == 'SI')
							    {
							    	$arrDatos[] = $arrNCD['acumulado_costo'];
									$arrDatos[] = $arrNCD['utilidad'];
								}

								$arrDatos[] = $arrNCD['folio_factura'];
								$arrDatos[] = $arrNCD['tipo'];
								$arrDatos[] = $arrNCD['condiciones_pago'];
								$arrDatos[] = $arrNCD['sucursal'];
								$arrDatos[] = $arrNCD['estatus'];

								//Hacer un llamado a la función para escribir los datos de la nota de crédito
								$this->get_datos_registro_excel($objExcel, $arrDatos, 
														  		$this->archivoExcel['intIndColInicial'], 
														  		$intFila);

								//Incrementar el indice para escribir los datos del siguiente registro
								$intFila++;

							}//Cierre de foreach de notas de crédito digitales

							//Incrementar el indice para escribir los datos del total
							$intFila++;

							//Escribir totales
							//Array que se utiliza para agregar los datos de los acumulados
							$arrDatos = array();
							$arrDatos[] = '';//Folio
							$arrDatos[] = '';//Cliente
							$arrDatos[] = 'TOTAL:';
							$arrDatos[] = $intAcumGralSubtotalNCD;
							$arrDatos[] = $intAcumGralIvaNCD;
							$arrDatos[] = $intAcumGralIepsNCD;
							$arrDatos[] = $intAcumGralTotalNCD;

							//Si se cumple la sentencia mostrar agregar columnas de costos
						    if($strIncluirCostos == 'SI')
						    {
						    	$arrDatos[] = $intAcumGralCostoNCD;
						    	$arrDatos[] = $intAcumGralUtilidadNCD;
						    }


						    //Hacer un llamado a la función para escribir los datos de los acumulados
							$this->get_datos_registro_excel($objExcel, $arrDatos, 
															$this->archivoExcel['intIndColInicial'], 
														    $intFila);

							//Hacer un llamado a la función para cambiar el estilo de las celdas
							$this->get_estilo_celda($objExcel, $arrCabeceraNC, $intFilaInicial, $intFila);

							//Incrementar el número de registros (filas)
							$intNumRegistros += $intFila;

						}//Cierre de verificación de notas de crédito digitales


					}//Cierre de verificación para incluir notas de crédito


					//Si hay información de las devoluciones
					if($arrDevoluciones && $strIncluirDevoluciones == 'SI')
					{	
						//Número de fila donde se va a comenzar a rellenar
					    $intFila = 14;
					    $intFilaInicial = 14;

						//Asignar el nombre de la hoja
						$strNombreHoja = 'devoluciones'.$arrMon->codigo;

						//Array que se utiliza para establecer los títulos de la cabecera
   						$arrCabecera = array('DEVOLUCIONES');

						//Incrementar contador por cada hoja nueva
						$intContadorHojas++;
							
					    //Hacer un llamado a la función para agregar (o activar) una hoja en el archivo excel
				   		$intContadorHojas = $this->get_hoja_archivo_excel($objExcel, $strNombreHoja, $intContadorHojas);

				    	//Hacer un llamado a la función para escribir el encabezado en el archivo excel
			 			$this->get_encabezado_archivo_xls($objExcel, $strEncabezado, $strTituloSucursales, 
			 								  			  $strTituloTipos, $intProspectoID,
			 								  			  $arrCabeceraDev, $arrCabecera);

			 			//Recorremos el arreglo 
						foreach ($arrDevoluciones as $arrDev)
						{
							//Array que se utiliza para agregar los datos de la devolución
							$arrDatosDev = array();
							$arrDatosDev[] = $arrDev['folio'];
							$arrDatosDev[] = $arrDev['razon_social'];
							$arrDatosDev[] = $arrDev['fecha'];
							$arrDatosDev[] = $arrDev['subtotal'];
							$arrDatosDev[] = $arrDev['iva'];
							$arrDatosDev[] = $arrDev['ieps'];
							$arrDatosDev[] = $arrDev['importe'];

							//Si se cumple la sentencia mostrar agregar columnas de costos
						    if($strIncluirCostos == 'SI')
						    {
						    	$arrDatosDev[] = $arrDev['acumulado_costo'];
								$arrDatosDev[] = $arrDev['utilidad'];
							}

							$arrDatosDev[] = $arrDev['folio_factura'];
							$arrDatosDev[] = $arrDev['tipo'];
							$arrDatosDev[] = $arrDev['condiciones_pago'];
							$arrDatosDev[] = $arrDev['sucursal'];
							$arrDatosDev[] = $arrDev['estatus'];

							//Hacer un llamado a la función para escribir los datos de la devolución
							$this->get_datos_registro_excel($objExcel, $arrDatosDev, 
														    $this->archivoExcel['intIndColInicial'], 
														    $intFila);

							//Asignar el número de columna donde se empezaran a escribir los datos de un detalle 
							$intIndColDetalle = count($arrDatosDev) + 1;

							//Si se cumple la sentencia mostrar detalles del registro
							if($arrDev['detalles'][0] && $strIncluirDetalleFras == 'SI')
							{

					  			/*
								*****************************************************************************************************************
								* DETALLES DE LA DEVOLUCIÓN
								*****************************************************************************************************************
								*/
								//Recorremos el arreglo 
						        foreach ($arrDev['detalles'][0] as $arrDet) 
						        {

						        	//Hacer un llamado a la función para escribir los datos de la devolución
									$this->get_datos_registro_excel($objExcel, $arrDatosDev, 
																    $this->archivoExcel['intIndColInicial'], 
																    $intFila);


  									//Array que se utiliza para agregar los datos del detalle
  									$arrDatos = array();
									$arrDatos[] = $arrDet['codigo'];
									$arrDatos[] = $arrDet['descripcion'];
									$arrDatos[] = $arrDet['subtotal'];

									//Si se cumple la sentencia mostrar agregar columnas de costos
								    if($strIncluirCostos == 'SI')
								    {
								    	$arrDatos[] = $arrDet['acumulado_costo'];
										$arrDatos[] = $arrDet['utilidad'];
									}


									//Hacer un llamado a la función para escribir los datos del detalle
								    $this->get_datos_registro_excel($objExcel, $arrDatos, 
																  $intIndColDetalle, 
																  $intFila);

							    	//Incrementar el indice para escribir los datos del siguiente registro
									$intFila++;


						        }//Cierre de foreach detalles de la devolución


							}//Cierre de verificación de detalles

							//Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;


						}//Cierre de foreach de devoluciones


						//Escribir totales
						//Array que se utiliza para agregar los datos de los acumulados
						$arrDatos = array();
						$arrDatos[] = '';//Folio
						$arrDatos[] = '';//Cliente
						$arrDatos[] = 'TOTAL:';
						$arrDatos[] = $intAcumGralSubtotalDev;
						$arrDatos[] = $intAcumGralIvaDev;
						$arrDatos[] = $intAcumGralIepsDev;
						$arrDatos[] = $intAcumGralTotalDev;

						//Si se cumple la sentencia mostrar agregar columnas de costos
					    if($strIncluirCostos == 'SI')
					    {
					    	$arrDatos[] = $intAcumGralCostoDev;
					    	$arrDatos[] = $intAcumGralUtilidadDev;
					    }


					    //Hacer un llamado a la función para escribir los datos de los acumulados
						$this->get_datos_registro_excel($objExcel, $arrDatos, 
														$this->archivoExcel['intIndColInicial'], 
													    $intFila);

						//Hacer un llamado a la función para cambiar el estilo de las celdas
						$this->get_estilo_celda($objExcel, $arrCabeceraDev, $intFilaInicial, $intFila);

						//Incrementar el número de registros (filas)
						$intNumRegistros += $intFila;

					}//Cierre de verificación de devoluciones

					
					/*
					*****************************************************************************************************************
					* SUBTOTALES GENERALES
					*****************************************************************************************************************
					*/
					//Incrementar el indice para escribir los datos del siguiente registro
					$intFila+=10;
					$intFilaInicial = $intFila;

					//Agregar información de los subtotales generales
					$objExcel->getActiveSheet()
	                         ->setCellValue('A'.$intFila, 'SUBTOTALES GENERALES:');


					

					//Si existe subtotal general de refacciones
					if($intAcumGralSubtotalRef > 0)
					{
						//Incrementar el indice para escribir los datos del siguiente registro
						$intFila++;

						/*****REFACCIONES**/
						//Array que se utiliza para agregar los datos de los acumulados
						$arrDatos = array();
						$arrDatos[] = 'REFACCIONES:';
						$arrDatos[] = $intAcumGralSubtotalRef;
						
						//Si se cumple la sentencia mostrar agregar columnas de costos
					    if($strIncluirCostos == 'SI')
					    {
					    	$arrDatos[] = $intAcumGralCostoRef;
							$arrDatos[] = $intAcumGralUtilidadRef;
					    }

		      		    //Hacer un llamado a la función para escribir los datos de los acumulados
						$this->get_datos_registro_excel($objExcel, $arrDatos, 
														$this->archivoExcel['intIndColInicial'], 
													    $intFila);

					}//Cierre de verificación de acumulado de refacciones


				
					
					//Si existe subtotal general de gastos de paquetería
					if($intAcumGralSubtotalGS > 0)
					{
						//Incrementar el indice para escribir los datos del siguiente registro
						$intFila++;

						/*****GASTOS DE PAQUETERÍA*****/
						//Array que se utiliza para agregar los datos de los acumulados
						$arrDatos = array();
						$arrDatos[] = 'GASTOS DE PAQUETERÍA:';
						$arrDatos[] = $intAcumGralSubtotalGS;
						
						//Si se cumple la sentencia mostrar agregar columnas de costos
					    if($strIncluirCostos == 'SI')
					    {
					    	$arrDatos[] = '';
							$arrDatos[] = $intAcumGralUtilidadGS;
					    }

		      			//Hacer un llamado a la función para escribir los datos de los acumulados
						$this->get_datos_registro_excel($objExcel, $arrDatos, 
														$this->archivoExcel['intIndColInicial'], 
													    $intFila);

					}//Cierre de verificación de acumulado de gastos de servicio

					//Si existe subtotal general de notas de crédito digitales
					if($intAcumGralSubtotalNCD > 0)
					{
						//Incrementar el indice para escribir los datos del siguiente registro
						$intFila++;

						/*****NOTAS DE CRÉDITO DIGITALES*****/
						//Array que se utiliza para agregar los datos de los acumulados
						$arrDatos = array();
						$arrDatos[] = 'NOTAS DE CRÉDITO DIGITALES:';
						$arrDatos[] =  $intAcumGralSubtotalNCD;
						
						//Si se cumple la sentencia mostrar agregar columnas de costos
					    if($strIncluirCostos == 'SI')
					    {
					    	$arrDatos[] = '';
							$arrDatos[] = $intAcumGralUtilidadNCD;
					    }

		      			//Hacer un llamado a la función para escribir los datos de los acumulados
						$this->get_datos_registro_excel($objExcel, $arrDatos, 
														$this->archivoExcel['intIndColInicial'], 
													    $intFila);

					}//Cierre de verificación de acumulado de notas de crédito digitales


					//Si existe subtotal general de devoluciones
					if($intAcumGralSubtotalDev > 0)
					{
						//Incrementar el indice para escribir los datos del siguiente registro
						$intFila++;

						/*****DEVOLUCIONES*****/
						//Array que se utiliza para agregar los datos de los acumulados
						$arrDatos = array();
						$arrDatos[] = 'DEVOLUCIONES:';
						$arrDatos[] = $intAcumGralSubtotalDev;
						
						//Si se cumple la sentencia mostrar agregar columnas de costos
					    if($strIncluirCostos == 'SI')
					    {
					    	$arrDatos[] = $intAcumGralCostoDev;
							$arrDatos[] = $intAcumGralUtilidadDev;
					    }

		      			//Hacer un llamado a la función para escribir los datos de los acumulados
						$this->get_datos_registro_excel($objExcel, $arrDatos, 
														$this->archivoExcel['intIndColInicial'], 
													    $intFila);

					}//Cierre de verificación de acumulado de devoluciones


					//Incrementar el indice para escribir los datos del siguiente registro
					$intFila++;

					//Array que se utiliza para agregar los datos de los acumulados
					$arrDatos = array();
					$arrDatos[] = 'SUBTOTAL:';
					$arrDatos[] = $intAcumGralSubtotal;

					//Si se cumple la sentencia mostrar agregar columnas de costos
				    if($strIncluirCostos == 'SI')
				    {
				    	$arrDatos[] = $intAcumGralCosto;
				    	$arrDatos[] = $intAcumGralUtilidad;
				    }

				    //Hacer un llamado a la función para escribir los datos de los acumulados
					$this->get_datos_registro_excel($objExcel, $arrDatos, 
													$this->archivoExcel['intIndColInicial'], 
													$intFila);



					//Cambiar contenido de las celdas a formato moneda
		            $objExcel->getActiveSheet()
		            		 ->getStyle('B'.$intFilaInicial.':'.'D'.$intFila)
		            		 ->getNumberFormat()
		            		 ->setFormatCode('$#,##0.00');

		            //Cambiar alineación de las siguientes celdas
		            $objExcel->getActiveSheet()
				        	 ->getStyle('A'.$intFilaInicial.':'.'D'.$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

				    //Cambiar estilo de las siguientes celdas
				    $objExcel->getActiveSheet()
		            		 ->getStyle('A'.$intFilaInicial)
		            		 ->applyFromArray($arrStyleBold);

			        $objExcel->getActiveSheet()
			            		 ->getStyle('A'.$intFila.':'.'D'.$intFila)
			            		 ->applyFromArray($arrStyleBold);


					//Incrementar el número de registros (filas)
					$intNumRegistros += $intFila;

               		//Incrementar contador por cada moneda
					$intContadorHojas++;

	                //Si el número de registros (por cada moneda) es mayor que el número máximo de registros 
				    if($intNumRegistros > $intNumMaxRegistros)
		            {
		            	//Asignar número de registros
		            	$intNumMaxRegistros = $intNumRegistros;
		            }

				}//Cierre de verificación de facturas, devoluciones y/o notas de crédito
			  

			}//Cierre de foreach de monedas

		}//Cierre de verificación de monedas

        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'facturacion_refacciones.xls', 'facturas', $intNumMaxRegistros);
    }


   
     //Función que se utiliza para escribir el encabezado del archivo Excel
     public function get_encabezado_archivo_xls($objExcel, $strEncabezado, $strTituloSucursales, 
     										    $strTituloTipos, $intProspectoID, $arrCabecera2 = NULL, 
     										    $arrCabecera = NULL)
    {	

    	//Asignar posición para escribir las descripciones de las columnas 
      	$intPosEncabezados = $this->archivoExcel['intPosEncabezados'];
      	//Variable que se utiliza para asignar el número de columna donde se empezaran a escribir los encabezados 
      	$intIndColE= $this->archivoExcel['intIndColInicial'];//Encabezados del reporte

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
		$objExcel->getActiveSheet()->setCellValue('A8', 'SUCURSALES: '.$strTituloSucursales);
		$objExcel->getActiveSheet()->setCellValue('A9', 'TIPOS: '.$strTituloTipos);
		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del cliente que coincide con el id
			$otdCliente = $this->clientes->buscar($intProspectoID);
			$objExcel->getActiveSheet()->setCellValue('A10', 'CLIENTE: '.$otdCliente->codigo.' - '.
															  $otdCliente->razon_social);
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
    			 ->getStyle('A9:D10')
    			 ->applyFromArray($arrStyleFuenteColumnasPrinc);

 
    	//Cambiar alineación de las siguientes celdas
    	$objExcel->getActiveSheet()
            	 ->getStyle('A9:D10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentLeft);


        //Asignar el número de columnas de la cabecera 2
	 	$intNumColCabecera = count($arrCabecera2);

	 	

    	//Si hay datos en la primer cabecera
        if($arrCabecera)
        {
        	//Asignar columna inicial
    		$strColInicial = $this->ARR_COLUMNAS[$this->archivoExcel['intIndColInicial']].$intPosEncabezados;
    		//Asignar columna final
    		$strColFinal = $this->ARR_COLUMNAS[$intNumColCabecera].$intPosEncabezados;

        	//Hacer recorrido para obtener los datos de la cabecera 1
	    	foreach ($arrCabecera as $arrDet) 
	    	{
	    		//Se agrega en el encabezado del archivo la cabecera 1
	        	$objExcel->getActiveSheet()->setCellValue($strColInicial, $arrDet);
			   
			    //Combinar las siguientes celdas
	        	$objExcel->getActiveSheet()->mergeCells($strColInicial.':'.$strColFinal);

	        	//Cambiar estilo de las siguientes celdas
		        $objExcel->getActiveSheet()
		        		 ->getStyle($strColInicial.':'.$strColFinal)
		        		 ->applyFromArray($arrStyleBold);

		        //Cambiar alineación de las siguientes celdas
			    $objExcel->getActiveSheet()
			        	 ->getStyle($strColInicial.':'.$strColFinal)
			        	 ->getAlignment()
			        	 ->applyFromArray($arrStyleAlignmentLeft);

		        //Preferencias de color de relleno de celda
	       		$objExcel->getActiveSheet()
	    			     ->getStyle($strColInicial.':'.$strColFinal)
	    			     ->getFill()
	    			     ->applyFromArray($arrStyleColumnas);

		        //Preferencias de color de texto de la celda
	       	    $objExcel->getActiveSheet()
	    			     ->getStyle($strColInicial.':'.$strColFinal)
	    			     ->applyFromArray($arrStyleFuenteColumnas);

	    	}//Cierre de foreach (cabecera 1)

	    	//Incrementar los indices para escribir los datos de la cabecera 2
	    	$intPosEncabezados++;
	    	

        }//Cierre de verificación de cabecera 1
        

        //Si hay datos en la segunda cabecera
        if($arrCabecera2)
        {
	    	//Asignar columna final
			$strColFinal = $this->ARR_COLUMNAS[$intNumColCabecera].$intPosEncabezados;

	        //Hacer recorrido para obtener los datos de la cabecera 2
	    	foreach ($arrCabecera2 as $arrDet) 
	    	{
	    		//Asignar columna inicial
	    		$strColInicial = $this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados;

	        	//Se agrega en el encabezado del archivo la cabecera 1
	        	$objExcel->getActiveSheet()->setCellValue($strColInicial, $arrDet);

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

	    	}//Cierre de foreach (cabecera 2)

	    }//Cierre de verificación de cabecera 2

    }


    //Función que se utiliza para cambiar el estilo de las celadas del archivo Excel
    public function get_estilo_celda($objExcel, $arrCabecera, $intFilaInicial = NULL, $intUltimaFila = NULL)
    {

    	//Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    	//Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    	//Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Asignar posición para cambiar estilo de las celdas
        $intIndiceCol = $this->archivoExcel['intIndColInicial'];

    	//Hacer recorrido para obtener los datos de la cabecera
        foreach ($arrCabecera as $arrDet) 
        {
        	//Asignar columna actual
	        $strColActual = $this->ARR_COLUMNAS[$intIndiceCol];

	        //Dependiendo de la descripción de la columna dar estilo a la celda
        	if($arrDet == 'SUBTOTAL' OR $arrDet == 'IVA' OR $arrDet == 'IEPS'
        	   OR $arrDet == 'TOTAL' OR $arrDet == 'COSTO' OR $arrDet == 'UTILIDAD'
        	   OR $arrDet == 'FECHA' OR $arrDet == 'ESTATUS')
        	{

				//Si la descripción de la columna es FECHA o ESTATUS
	        	if($arrDet == 'FECHA' OR $arrDet == 'ESTATUS')
	        	{
	        		//Cambiar alineación de las siguientes celdas
		        	$objExcel->getActiveSheet()
					         ->getStyle($strColActual.$intFilaInicial.':'.$strColActual.$intUltimaFila)
					         ->getAlignment()
					         ->applyFromArray($arrStyleAlignmentCenter);

	        	}
	        	else
	        	{

	        		//Cambiar contenido de las celdas a formato moneda
	           		$objExcel->getActiveSheet()
	            			 ->getStyle($strColActual.$intFilaInicial.':'.$strColActual.$intUltimaFila)
	            		     ->getNumberFormat()
	            		     ->setFormatCode('$#,##0.00');

	            	//Cambiar alineación de las siguientes celdas
		        	$objExcel->getActiveSheet()
					         ->getStyle($strColActual.$intFilaInicial.':'.$strColActual.$intUltimaFila)
					         ->getAlignment()
					         ->applyFromArray($arrStyleAlignmentRight);


	        	}

	        	//Cambiar alineación de la última celda (corresponde al total)
	        	$objExcel->getActiveSheet()
					         ->getStyle($strColActual.$intUltimaFila.':'.$strColActual.$intUltimaFila)
					         ->getAlignment()
					         ->applyFromArray($arrStyleAlignmentRight);

			    //Cambiar estilo de la última celda
	            $objExcel->getActiveSheet()
	            		 ->getStyle($strColActual.$intUltimaFila.':'.$strColActual.$intUltimaFila)
	            		 ->applyFromArray($arrStyleBold);


	        }

        	//Incrementar indice de la columna
	        $intIndiceCol++;

        }//Cierre de foreach (cabecera)

    }



	//Función que se utiliza para regresar movimientos del cliente en el rango de fechas
	public function get_movimientos($dteFechaInicial, $dteFechaFinal, $intProspectoID, $intMonedaID, 
								 	$strSucursales, $strTipos, $strTipoReporte, 
								 	$strIncluirDevoluciones, $strIncluirNotasCredito)
	{


		//Array que se utiliza para enviar datos
		$arrDatos = array('facturas' => NULL,
						  'devoluciones' => NULL, 
						  'notas_credito_digitales' => NULL, 
						  'notas_credito_servicio' => NULL,
						  'acumulado_subtotalMO' => '0.00',
						  'acumulado_costoMO' => '0.00',
						  'acumulado_utilidadMO' => '0.00',
						  'acumulado_subtotalRef' => '0.00',
						  'acumulado_costoRef' => '0.00',
						  'acumulado_utilidadRef' => '0.00',
						  'acumulado_subtotalTF' => '0.00',
						  'acumulado_costoTF' => '0.00',
						  'acumulado_utilidadTF' => '0.00',
						  'acumulado_subtotalOtros' => '0.00',
						  'acumulado_costoOtros' => '0.00',
						  'acumulado_utilidadOtros' => '0.00',
						  'acumulado_subtotalGS' => '0.00',
						  'acumulado_costoGS' => '0.00',
						  'acumulado_utilidadGS' => '0.00',
						  'acumulado_subtotalFra' => '0.00',
						  'acumulado_ivaFra' => '0.00',
						  'acumulado_iepsFra' => '0.00', 
						  'acumulado_totalFra' => '0.00', 
						  'acumulado_costoFra' => '0.00',
						  'acumulado_utilidadFra' => '0.00', 
						  'acumulado_subtotalDev' => '0.00',
						  'acumulado_ivaDev' => '0.00',
						  'acumulado_iepsDev' => '0.00', 
						  'acumulado_totalDev' => '0.00', 
						  'acumulado_costoDev' => '0.00',
						  'acumulado_utilidadDev' => '0.00', 
						  'acumulado_subtotalNCD' => '0.00',
						  'acumulado_ivaNCD' => '0.00',
						  'acumulado_iepsNCD' => '0.00', 
						  'acumulado_totalNCD' => '0.00', 
						  'acumulado_costoNCD' => '0.00',
						  'acumulado_utilidadNCD' => '0.00', 
						  'acumulado_subtotalNCS' => '0.00',
						  'acumulado_ivaNCS' => '0.00',
						  'acumulado_iepsNCS' => '0.00', 
						  'acumulado_totalNCS' => '0.00', 
						  'acumulado_costoNCS' => '0.00',
						  'acumulado_utilidadNCS' => '0.00');


	
		//Array que se utiliza para agregar los datos de las facturas
        $arrFacturas = array();
        //Array que se utiliza para agregar los datos de las devoluciones
        $arrDevoluciones = array();
        //Array que se utiliza para agregar los datos de las notas de crédito digitales
        $arrNotasCreditoDigitales = array();
        //Array que se utiliza para agregar los datos de un registro
        $arrAuxiliar = array();
        //Variable que se utiliza para asignar el acumulado general del subtotal
        $intAcumGralSubtotal = 0;
        //Variable que se utiliza para asignar el acumulado general del IVA
        $intAcumGralIva = 0;
        //Variable que se utiliza para asignar el acumulado general del IEPS
        $intAcumGralIeps = 0;
        //Variable que se utiliza para asignar el acumulado general del total
        $intAcumGralTotal = 0;
        //Variable que se utiliza para asignar el acumulado general del costo
        $intAcumGralCosto = 0;
        //Variable que se utiliza para asignar el acumulado  generalde la utilidad
        $intAcumGralUtilidad = 0;

        //Variables que se utilizan para el acumulado general
        //Refacciones
        $intAcumGralSubtotalRef = 0;
        $intAcumGralCostoRef = 0;
        $intAcumGralUtilidadRef = 0;
        //Gastos de servicio
        $intAcumGralSubtotalGS = 0;
        $intAcumGralCostoGS = 0;
        $intAcumGralUtilidadGS = 0;


		//Seleccionar las facturas que coinciden con el parámetro enviado
		$otdFacturas = $this->facturas->buscar_facturas($dteFechaInicial, $dteFechaFinal, $intProspectoID, 
														$intMonedaID, $strSucursales, $strTipos,
														$strTipoReporte);

		//Si hay información de las facturas
		if($otdFacturas)
		{
			//Recorremos el arreglo 
			foreach ($otdFacturas as $arrFra)
			{	
				//Variable que se utiliza para asignar el tipo de cambio de la factura
			    $intTipoCambioFactura = $arrFra->tipo_cambio;
			    //Asignar el id de la factura 
				$intFacturaRefaccionesID = $arrFra->factura_refacciones_id;
				//Variable que se utiliza para asignar el estatus de la factura
			    $strEstatus = $arrFra->estatus;
			    //Array que se utiliza para agregar los detalles de la factura
				$arrDetalles = array();
				//Array que se utiliza para agregar los movimientos de refacciones
		        $arrMovRefacciones = array();

				//Variable que se utiliza para asignar el acumulado del subtotal
		        $intAcumSubtotal = 0;
		        //Variable que se utiliza para asignar el acumulado del IVA
		        $intAcumIva = 0;
		        //Variable que se utiliza para asignar el acumulado del IEPS
		        $intAcumIeps = 0;
		        //Variable que se utiliza para asignar el acumulado del costo
		        $intAcumCosto = 0;
		        //Variable que se utiliza para asignar el acumulado de la utilidad
		        $intAcumUtilidad = 0;


		        //Variables que se utilizan para asignar acumulados de las refacciones
				$intAcumSubtotalRef = 0;
				$intAcumIvaRef = 0;
			    $intAcumIepsRef = 0;
			    $intAcumCostoRef = 0;
			    $intUtilidadRef = 0;



				//Seleccionar las refacciones del registro
				$otdRefacciones = $this->facturas->buscar_detalles($intFacturaRefaccionesID);

				/*
				*****************************************************************************************************************
				* REFACCIONES
				*****************************************************************************************************************
				*/
				//Verificar si existe información de las refacciones
				if($otdRefacciones)
				{

					//Recorremos el arreglo 
					foreach ($otdRefacciones as $arrRef)
					{
						//Variables que se utilizan para asignar valores del detalle
						$intCantidad = $arrRef->cantidad;
						//Convertir peso mexicano a tipo de cambio
						$intPrecioUnitario = ($arrRef->precio_unitario / $intTipoCambioFactura);
						$intCostoUnitario =  ($arrRef->costo_unitario / $intTipoCambioFactura);
						$intIvaUnitario = ($arrRef->iva_unitario / $intTipoCambioFactura);
						$intIepsUnitario = ($arrRef->ieps_unitario / $intTipoCambioFactura);
						//Variable que se utiliza para asignar el importe de IVA
						$intImporteIva = 0;
						//Variable que se utiliza para asignar el importe de IEPS
						$intImporteIeps = 0;

						//Si existe importe de IVA unitario
						if($intIvaUnitario > 0)
						{
							//Calcular importe de IVA
						    $intImporteIva =  $intIvaUnitario * $intCantidad;
						}

						//Si existe importe de IEPS unitario
						if($intIepsUnitario > 0)
						{
							//Calcular importe de IEPS
						    $intImporteIeps =  $intIepsUnitario * $intCantidad;
						}
						
						//Calcular subtotal
						$intSubtotal = $intCantidad * $intPrecioUnitario;

						//Calcular costo
						$intCosto = $intCantidad * $intCostoUnitario;

						//Convertir cantidad a dos decimales
						$intSubtotal =  number_format($intSubtotal, 2, '.', '');
						$intImporteIva = number_format($intImporteIva, 2, '.', '');
						$intImporteIeps = number_format($intImporteIeps, 2, '.', '');
						$intCosto =  number_format($intCosto, 2, '.', '');

						//Calcular utilidad
						$intUtilidad = $intSubtotal - $intCosto;

						//Definir valores del array auxiliar de información
						$arrAuxiliar["codigo"] = $arrRef->codigo;
						$arrAuxiliar["descripcion"] = $arrRef->descripcion;
						$arrAuxiliar["subtotal"] = $intSubtotal;
					    $arrAuxiliar["acumulado_costo"] = $intCosto;
						$arrAuxiliar["utilidad"] = $intUtilidad;
		                //Asignar datos al array
		                array_push($arrDetalles, $arrAuxiliar); 

						//Incrementar acumulados
						$intAcumSubtotalRef += $intSubtotal;
						$intAcumCostoRef += $intCosto;
						$intAcumIvaRef += $intImporteIva;
						$intAcumIepsRef += $intImporteIeps;
					}

					//Calcular utilidad de los movimientos de refacciones
					$intUtilidadRef = $intAcumSubtotalRef - $intAcumCostoRef;


					//Incrementar subtotales generales
					$intAcumSubtotal += $intAcumSubtotalRef;
				    $intAcumIva += $intAcumIvaRef;
				    $intAcumIeps += $intAcumIepsRef;
					$intAcumCosto += $intAcumCostoRef;
					$intAcumUtilidad+= $intUtilidadRef;

	                //Incrementar acumulados si el estatus es ACTIVO o TIMBRAR
					if($strEstatus == 'ACTIVO' OR  $strEstatus == 'TIMBRAR')
					{
						//Incrementar acumulados
						$intAcumGralSubtotalRef += $intAcumSubtotalRef;
						$intAcumGralCostoRef += $intAcumCostoRef;
						$intAcumGralUtilidadRef += $intUtilidadRef;
					}


				}//Cierre de verificación de refacciones



				/*
				*****************************************************************************************************************
				* GASTOS DE PAQUETERÍA
				*****************************************************************************************************************
				*/
				//Variables que se utilizan para asignar el gasto de paquetería
				$intGastosPaqueteriaSubtotal = $arrFra->gastos_paqueteria;
				$intGastosPaqueteriaIva = $arrFra->gastos_paqueteria_iva;

			    //Convertir peso mexicano a tipo de cambio
				$intGastosPaqueteriaSubtotal = ($intGastosPaqueteriaSubtotal / $intTipoCambioFactura);
				$intGastosPaqueteriaIva = ($intGastosPaqueteriaIva / $intTipoCambioFactura);

				//Convertir cantidad a dos decimales
				$intGastosPaqueteriaSubtotal =  number_format($intGastosPaqueteriaSubtotal, 2, '.', '');
				$intGastosPaqueteriaIva = number_format($intGastosPaqueteriaIva, 2, '.', '');

				//Si existen gastos de paquetería
				if($intGastosPaqueteriaSubtotal > 0)
				{
					//Definir valores del array auxiliar de información
					$arrAuxiliar["codigo"] = '';
					$arrAuxiliar["descripcion"] = 'GASTOS DE PAQUETERÍA';
					$arrAuxiliar["subtotal"] = $intGastosPaqueteriaSubtotal;
					$arrAuxiliar["acumulado_costo"] = '';
					$arrAuxiliar["utilidad"] = $intGastosPaqueteriaSubtotal;
	                //Asignar datos al array
	                array_push($arrDetalles, $arrAuxiliar); 

	                //Incrementar acumulados si el estatus es ACTIVO o TIMBRAR
					if($strEstatus == 'ACTIVO' OR  $strEstatus == 'TIMBRAR')
					{
						//Incrementar acumulados
						$intAcumGralSubtotalGS += $intGastosPaqueteriaSubtotal;
						$intAcumGralUtilidadGS += $intGastosPaqueteriaSubtotal;
					}



				}//Cierre de verificación de gastos de paquetería
				

				//Incrementar subtotales generales
				$intAcumSubtotal += $intGastosPaqueteriaSubtotal;
				$intAcumIva += $intGastosPaqueteriaIva;
				$intAcumUtilidad+= $intGastosPaqueteriaSubtotal;


				//Calcular importe total
				$intTotal = $intAcumSubtotal +$intAcumIva + $intAcumIeps;


				//Definir valores del array auxiliar de información (para cada factura)
				$arrAuxiliar["folio"] = $arrFra->folio;
				$arrAuxiliar["razon_social"] = $arrFra->razon_social;
				$arrAuxiliar["fecha"] = $arrFra->fecha;
				$arrAuxiliar["subtotal"] = $arrFra->subtotal;
				$arrAuxiliar["iva"] = $arrFra->iva;
				$arrAuxiliar["ieps"] = $arrFra->ieps;
				$arrAuxiliar["importe"] = $arrFra->importe;
				$arrAuxiliar["acumulado_costo"] = $intAcumCosto;
			    $arrAuxiliar["utilidad"] = $intAcumUtilidad;
			    $arrAuxiliar["estatus"] = $strEstatus;
			    $arrAuxiliar["tipo"] = $arrFra->tipo;
			    $arrAuxiliar["condiciones_pago"] = $arrFra->condiciones_pago;
			    $arrAuxiliar["sucursal"] = $arrFra->sucursal;
			    $arrAuxiliar["detalles"] = array($arrDetalles);
			    //Agregar datos al array
            	array_push($arrFacturas, $arrAuxiliar);

            	//Incrementar acumulados si el estatus es ACTIVO o TIMBRAR
				if($strEstatus == 'ACTIVO' OR  $strEstatus == 'TIMBRAR')
				{
	            	//Incrementar acumulados generales
					$intAcumGralSubtotal += $intAcumSubtotal;
					$intAcumGralIva += $intAcumIva;
					$intAcumGralIeps += $intAcumIeps;
					$intAcumGralTotal += $intTotal;
					$intAcumGralCosto += $intAcumCosto;
					$intAcumGralUtilidad += $intAcumUtilidad;
				}


			}//Cierre de foreach facturas


			//Agregar datos al array
		    $arrDatos['facturas'] = $arrFacturas;
		    $arrDatos['acumulado_subtotalFra'] = $intAcumGralSubtotal;
		    $arrDatos['acumulado_ivaFra'] = $intAcumGralIva;
		    $arrDatos['acumulado_iepsFra'] = $intAcumGralIeps;
		    $arrDatos['acumulado_totalFra'] = $intAcumGralTotal;
		    $arrDatos['acumulado_costoFra'] = $intAcumGralCosto;
		    $arrDatos['acumulado_utilidadFra'] = $intAcumGralUtilidad;
		    //Acumulados generales
		    //Refacciones
		    $arrDatos['acumulado_subtotalRef'] = $intAcumGralSubtotalRef;
		    $arrDatos['acumulado_costoRef'] = $intAcumGralCostoRef;
		    $arrDatos['acumulado_utilidadRef'] = $intAcumGralUtilidadRef;
		    //Gastos de servicio
		    $arrDatos['acumulado_subtotalGS'] = $intAcumGralSubtotalGS;
		    $arrDatos['acumulado_costoGS'] = $intAcumGralCostoGS;
		    $arrDatos['acumulado_utilidadGS'] = $intAcumGralUtilidadGS;

		}//Cierre de verificación de facturas


		//Si se cumple la sentencia buscar devoluciones
		if($strIncluirDevoluciones == 'SI')
		{
			//Seleccionar las devoluciones que coinciden con el parámetro enviado
			$otdDevoluciones = $this->movimientos->buscar_devoluciones_facturas($dteFechaInicial, $dteFechaFinal, 
																	        $intProspectoID, $intMonedaID, 
																	        'REFACCIONES',$strSucursales, 
																	        $strTipos);
			//Si hay información de las devoluciones
			if($otdDevoluciones)
			{

				//Inicializar variables
		        $intAcumGralSubtotal = 0;
		        $intAcumGralIva = 0;
		        $intAcumGralIeps = 0;
		        $intAcumGralTotal = 0;
		        $intAcumGralCosto = 0;
		        $intAcumGralUtilidad = 0;
	       		$arrAuxiliar = array();

				//Recorremos el arreglo 
				foreach ($otdDevoluciones as $arrDev)
				{

					//Variable que se utiliza para asignar el tipo de cambio de la devolución
			    	$intTipoCambioDev = $arrDev->tipo_cambio;
					//Variable que se utiliza para asignar el estatus de la devolución
				    $strEstatus = $arrDev->estatus;
				    //Asignar el subtotal de la devolución
				    $intAcumSubtotal = $arrDev->subtotal;
				    //Asignar el importe de IVA de la devolución
				    $intAcumIva = $arrDev->iva;
				    //Asignar el importe de IEPS de la devolución
				    $intAcumIeps = $arrDev->ieps;
				    //Asignar el total de la devolución
				    $intTotal = $arrDev->importe;
				    //Variable que se utiliza para asignar el acumulado del costo
			        $intAcumCosto = 0;
			        //Variable que se utiliza para asignar el acumulado de la utilidad
			        $intAcumUtilidad = 0;
				    //Array que se utiliza para agregar los detalles de la devolución
					$arrDetalles = array();


				    /*
					*****************************************************************************************************************
					* DETALLES
					*****************************************************************************************************************
					*/
					//Seleccionar los detalles del registro
					$otdDetalles = $this->movimientos->buscar_detalles_entrada_devolucion_factura($arrDev->movimiento_refacciones_id);

					//Verificar si existe información de los detalles 
					if($otdDetalles)
					{
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Variables que se utilizan para asignar valores del detalle
							$intCantidad = $arrDet->cantidad;
							//Convertir peso mexicano a tipo de cambio
							$intCostoUnitario = ($arrDet->costo_unitario / $intTipoCambioDev);
							$intPrecioUnitario = ($arrDet->precio_unitario / $intTipoCambioDev);

							//Calcular subtotal
							$intSubtotal = $intCantidad * $intPrecioUnitario;

							//Calcular costo
							$intCosto = $intCantidad * $intCostoUnitario;

							//Convertir cantidad a dos decimales
							$intSubtotal =  number_format($intSubtotal, 2, '.', '');
							$intCosto = number_format($intCosto, 2, '.', '');

							//Calcular utilidad
							$intUtilidad = $intSubtotal - $intCosto;

							//Definir valores del array auxiliar de información
							$arrAuxiliar["codigo"] = $arrDet->codigo;
							$arrAuxiliar["descripcion"] = $arrDet->descripcion;
							$arrAuxiliar["subtotal"] = $intSubtotal;
							$arrAuxiliar["acumulado_costo"] = $intCosto;
							$arrAuxiliar["utilidad"] = $intUtilidad;
						    //Asignar datos al array
	                		array_push($arrDetalles, $arrAuxiliar); 

	                		//Incrementar acumulados
	                		$intAcumCosto += $intCosto;
	                		$intAcumUtilidad += $intUtilidad;
						}

					}//Cierre de verificación de detalles



					//Definir valores del array auxiliar de información (para cada devolución)
					$arrAuxiliar["folio"] = $arrDev->folio;
					$arrAuxiliar["razon_social"] = $arrDev->razon_social;
					$arrAuxiliar["fecha"] = $arrDev->fecha;
					$arrAuxiliar["subtotal"] = $intAcumSubtotal;
					$arrAuxiliar["iva"] = $intAcumIva;
					$arrAuxiliar["ieps"] = $intAcumIeps;
					$arrAuxiliar["importe"] = $intTotal;
					$arrAuxiliar["acumulado_costo"] = $intAcumCosto;
			   	    $arrAuxiliar["utilidad"] = $intAcumUtilidad;
				    $arrAuxiliar["estatus"] = $strEstatus;
				    $arrAuxiliar["tipo"] = $arrDev->tipo;
			   		$arrAuxiliar["condiciones_pago"] = $arrDev->condiciones_pago;
				    $arrAuxiliar["sucursal"] = $arrDev->sucursal;
				    $arrAuxiliar["folio_factura"] = $arrDev->folio_factura;
				    $arrAuxiliar["detalles"] = array($arrDetalles);
				    //Agregar datos al array
	            	array_push($arrDevoluciones, $arrAuxiliar);

	            	//Incrementar acumulados si el estatus es ACTIVO o TIMBRAR
					if($strEstatus == 'ACTIVO' OR  $strEstatus == 'TIMBRAR')
					{
		            	//Incrementar acumulados generales
						$intAcumGralSubtotal += $intAcumSubtotal;
						$intAcumGralIva += $intAcumIva;
						$intAcumGralIeps += $intAcumIeps;
						$intAcumGralTotal += $intTotal;
						$intAcumGralCosto += $intAcumCosto;
						$intAcumGralUtilidad += $intAcumUtilidad;
					}

				}//Cierre de foreach devoluciones


				//Agregar datos al array
			    $arrDatos['devoluciones'] = $arrDevoluciones;
			    $arrDatos['acumulado_subtotalDev'] = $intAcumGralSubtotal;
			    $arrDatos['acumulado_ivaDev'] = $intAcumGralIva;
			    $arrDatos['acumulado_iepsDev'] = $intAcumGralIeps;
			    $arrDatos['acumulado_totalDev'] = $intAcumGralTotal;
			    $arrDatos['acumulado_costoDev'] = $intAcumGralCosto;
			   $arrDatos['acumulado_utilidadDev'] = $intAcumGralUtilidad;

			}//Cierre de verificación de devoluciones

		}//Cierre de verificación de devoluciones


		//Si se cumple la sentencia buscar notas de crédito (digitales/sevicio)
		if($strIncluirNotasCredito == 'SI')
		{
			//Seleccionar las notas de crédito digitales que coinciden con el parámetro enviado
			$otdNotasCredDigitales = $this->notas_digitales->buscar_notas_credito_facturas($dteFechaInicial, 
																						   $dteFechaFinal, 
																	        			   $intProspectoID, 
																	        			   $intMonedaID, 
																	        			  'REFACCIONES',
																	        			   $strSucursales, 
																	        			   $strTipos);

			
			//Si hay información de las notas de crédito digitales
			if($otdNotasCredDigitales)
			{
				//Inicializar variables
		        $intAcumGralSubtotal = 0;
		        $intAcumGralIva = 0;
		        $intAcumGralIeps = 0;
		        $intAcumGralTotal = 0;
		        $intAcumGralCosto = 0;
		        $intAcumGralUtilidad = 0;
	       		$arrAuxiliar = array();

	       		//Recorremos el arreglo 
				foreach ($otdNotasCredDigitales as $arrNCD)
				{
					//Variable que se utiliza para asignar el tipo de cambio de la nota de crédito digital
			    	$intTipoCambioNCD = $arrNCD->tipo_cambio;
					//Variable que se utiliza para asignar el estatus de la nota de crédito digital
				    $strEstatus = $arrNCD->estatus;
				    //Asignar el subtotal de la nota de crédito digital
				    $intAcumSubtotal = $arrNCD->subtotal;
				    //Asignar el importe de IVA de la nota de crédito digital
				    $intAcumIva = $arrNCD->iva;
				    //Asignar el importe de IEPS de la nota de crédito digital
				    $intAcumIeps = $arrNCD->ieps;
				    //Asignar el total de la nota de crédito digital
				    $intTotal = $arrNCD->importe;
				    //Asignar el subtotal de la nota de crédito digital
				    $intAcumUtilidad = $arrNCD->subtotal;


				    //Definir valores del array auxiliar de información (para cada nota de crédito)
					$arrAuxiliar["folio"] = $arrNCD->folio;
					$arrAuxiliar["razon_social"] = $arrNCD->razon_social;
					$arrAuxiliar["fecha"] = $arrNCD->fecha;
					$arrAuxiliar["subtotal"] = $intAcumSubtotal;
					$arrAuxiliar["iva"] = $intAcumIva;
					$arrAuxiliar["ieps"] = $intAcumIeps;
					$arrAuxiliar["importe"] = $intTotal;
					$arrAuxiliar["acumulado_costo"] = 0;
			   	    $arrAuxiliar["utilidad"] = $intAcumUtilidad;
				    $arrAuxiliar["estatus"] = $strEstatus;
				    $arrAuxiliar["tipo"] = $arrNCD->tipo;
			   		$arrAuxiliar["condiciones_pago"] = $arrNCD->condiciones_pago;
				    $arrAuxiliar["sucursal"] = $arrNCD->sucursal;
				    $arrAuxiliar["folio_factura"] = $arrNCD->folio_factura;
				    //Agregar datos al array
	            	array_push($arrNotasCreditoDigitales, $arrAuxiliar);

	            	//Incrementar acumulados si el estatus es ACTIVO o TIMBRAR
					if($strEstatus == 'ACTIVO' OR  $strEstatus == 'TIMBRAR')
					{
		            	//Incrementar acumulados generales
						$intAcumGralSubtotal += $intAcumSubtotal;
						$intAcumGralIva += $intAcumIva;
						$intAcumGralIeps += $intAcumIeps;
						$intAcumGralTotal += $intTotal;
						$intAcumGralUtilidad += $intAcumUtilidad;
					}

				}//Cierre de foreach notas de crédito digitales


				//Agregar datos al array
			    $arrDatos['notas_credito_digitales'] = $arrNotasCreditoDigitales;
			    $arrDatos['acumulado_subtotalNCD'] = $intAcumGralSubtotal;
			    $arrDatos['acumulado_ivaNCD'] = $intAcumGralIva;
			    $arrDatos['acumulado_iepsNCD'] = $intAcumGralIeps;
			    $arrDatos['acumulado_totalNCD'] = $intAcumGralTotal;
			    $arrDatos['acumulado_costoNCD'] = $intAcumGralCosto;
			   $arrDatos['acumulado_utilidadNCD'] = $intAcumGralUtilidad;

			}//Cierre de verificación de notas de crédito digitales



		}//Cierre de verificación para incluir notas de crédito

		//Regresar array con los datos
		return $arrDatos;
	}

}