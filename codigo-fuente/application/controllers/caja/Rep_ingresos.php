<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_ingresos extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de pagos
		$this->load->model('caja/pagos_model', 'pagos');
		//Cargamos el modelo de monedas
		$this->load->model('contabilidad/sat_monedas_model', 'monedas');
		//Cargamos el modelo de formas de pago
		$this->load->model('contabilidad/sat_forma_pago_model', 'formas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('caja/rep_ingresos', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con los ingresos del día
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{	        
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFecha = $this->input->post('dteFecha');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strModulos = trim($this->input->post('strModulos'));
		$intFormaPagoID = $this->input->post('intFormaPagoID');
	


		//Variable que se utiliza para asignar el acumulado del subtotal
		$intAcumSubtotal = 0;
		//Variable que se utiliza para asignar el acumulado del IVA
		$intAcumIva = 0;
		//Variable que se utiliza para asignar el acumulado del IEPS
		$intAcumIeps = 0;
		//Variable que se utiliza para asignar el acumulado del total
		$intAcumTotal = 0;
		//Array que se utiliza para asignar el importe por forma de pago
		$arrImporteFormaPago = array();
		//Array que se utiliza para agregar los datos de un ingreso
        $arrAuxiliar = array();
        //Array que se utiliza para agregar los ingresos del día
        $arrIngresos = array();

        //Variable que se utiliza para agregar las ventas y pagos de maquinaria
	     $strVtasModMaquinaria = "";
	     //Variable que se utiliza para agregar las ventas y pagos de refacciones
	     $strVtasModRefacciones = "";
	     //Variable que se utiliza para agregar las ventas y pagos de servicio
	     $strVtasModServicio = "";
	     //Variable que se utiliza para agregar las ventas y pagos de conceptos
	     $strVtasModConceptos = "";

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

			//Dependiendo del modulo asignar valor a la restricción que se utiliza para buscar datos de las facturas
			if($strModulo == 'MAQUINARIA')
			{
			   //Facturas y pagos de maquinaria
			   $strVtasModMaquinaria = $strModulo;
			}

			if($strModulo == 'REFACCIONES')
			{
				//Facturas y pagos de refacciones
				$strVtasModRefacciones = $strModulo;
			}
			
			if($strModulo == 'SERVICIO')
			{
				//Facturas y pagos de servicio
				$strVtasModServicio = $strModulo;
			}
			
			if($strModulo == 'CONCEPTOS')
			{
				//Facturas y pagos de conceptos
				$strVtasModConceptos = $strModulo;
			}

		}

		//Quitar último elemento de la cadena (,)
		$strTituloModulos = substr($strTituloModulos, 0, -2);


		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16 DE OCTUBRE DE 2017 
		$strTituloFecha = strtoupper($this->get_fecha_formato_letra($dteFecha, ''));
	    //Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = utf8_decode('INGRESOS DEL DÍA ').$strTituloFecha;
		//Asignar el valor de la línea dos del título
		$pdf->strLinea2 = utf8_decode('SUCURSALES: '.trim($strTituloSucursales));
		//Asignar el valor de la línea tres del título
		$pdf->strLinea3 = utf8_decode('MÓDULOS: '.trim($strTituloModulos));

		//Si existe forma de pago
		if($intFormaPagoID > 0)
		{
			//Seleccionar los datos de la forma de pago que coincide con el id
			$otdFormaPago = $this->formas->buscar($intFormaPagoID);

			//Asignar el valor de la línea cinco del título
			$pdf->strLinea5 = 'FORMA DE PAGO: '.strtoupper(utf8_decode($otdFormaPago->codigo.' - '.$otdFormaPago->descripcion));
		}
		
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('CONCEPTO'), 'FORMA DE PAGO', 'IMPORTE', 'DEBE HABER');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(83, 47, 30, 30);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'R', 'R');
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
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
				//Asignar la descripción de la moneda actual
				$strMoneda = strtoupper($arrMon->codigo.' - '.$arrMon->descripcion);
			  	
			  	//Inicializar objetos de datos
			  	//Módulo de maquinaria
			  	$otdVentasMaquinaria = NULL;
				$otdPagosMaquinaria = NULL;
			  	//Módulo de refacciones
			  	$otdVentasRefacciones = NULL;
			  	$otdPagosRefacciones = NULL;
			  	//Módulo de servicio
			  	$otdVentasServicio = NULL;
			  	$otdPagosServicio = NULL;
			  	//Módulo de conceptos
			  	$otdVentasConceptos  = NULL;
			  	$otdPagosConceptos = NULL;

			  	//Si se cumple la sentencia agregar facturas y pagos de maquinaria
			  	if($strVtasModMaquinaria != "")
			  	{
			  		//Seleccionar las ventas (facturas) de contado de maquinaria 
					$otdVentasMaquinaria = $this->pagos->buscar_ingresos_dia($dteFecha,
																			 $intMonedaID,  
																		    'FACTURAS MAQUINARIA', 
																			 $strSucursales, 
																			 $intFormaPagoID);

					//Seleccionar los pagos de ventas (facturas) de maquinaria
					$otdPagosMaquinaria = $this->pagos->buscar_ingresos_dia($dteFecha,
																	    $intMonedaID,  
																	    'PAGOS MAQUINARIA', 
																		 $strSucursales, 
																		 $intFormaPagoID);
			  	}

			  	//Si se cumple la sentencia agregar facturas y pagos de refacciones
			  	if($strVtasModRefacciones != "")
			  	{
			  		//Seleccionar las ventas (facturas) de contado de refacciones 
					$otdVentasRefacciones = $this->pagos->buscar_ingresos_dia($dteFecha,
																		  $intMonedaID,  
																	      'FACTURAS REFACCIONES', 
																		   $strSucursales, 
																		   $intFormaPagoID);

					//Seleccionar los pagos de ventas (facturas) de refacciones
					$otdPagosRefacciones = $this->pagos->buscar_ingresos_dia($dteFecha,
																		     $intMonedaID,  
																		     'PAGOS REFACCIONES', 
																			 $strSucursales, 
																			 $intFormaPagoID);


			  	}

			  	
			  	//Si se cumple la sentencia agregar facturas y pagos de servicio
				if($strVtasModServicio != "")
			  	{

				

					//Seleccionar las ventas (facturas) de contado de servicio
					$otdVentasServicio = $this->pagos->buscar_ingresos_dia($dteFecha,
																		   $intMonedaID,  
																		   'FACTURAS SERVICIO', 
																			$strSucursales, 
																			$intFormaPagoID);

					//Seleccionar los pagos de ventas (facturas) de servicio
					$otdPagosServicio = $this->pagos->buscar_ingresos_dia($dteFecha,
																		  $intMonedaID,  
																		  'PAGOS SERVICIO', 
																		   $strSucursales, 
																		   $intFormaPagoID);

				}

				//Si se cumple la sentencia agregar facturas y pagos de conceptos
				if($strVtasModConceptos != "")
			  	{
				   //Seleccionar las ventas (facturas) de contado de conceptos
					$otdVentasConceptos = $this->pagos->buscar_ingresos_dia($dteFecha,
																		   $intMonedaID,  
																		   'FACTURAS CONCEPTOS', 
																			$strSucursales, 
																			$intFormaPagoID);
					

					//Seleccionar los pagos de ventas (facturas) de conceptos
					$otdPagosConceptos = $this->pagos->buscar_ingresos_dia($dteFecha,
																		  $intMonedaID,  
																		  'PAGOS CONCEPTOS', 
																		   $strSucursales, 
																		   $intFormaPagoID);
				}


				//Seleccionar los pagos de ventas (facturas) de cartera
				$otdPagosCartera = $this->pagos->buscar_ingresos_dia($dteFecha,
																	 $intMonedaID,  
																	 'PAGOS CARTERA', 
																	  $strSucursales, 
																	  $intFormaPagoID);


				//Seleccionar los anticipos de clientes
				$otdAnticipos = $this->pagos->buscar_ingresos_dia($dteFecha,
																  $intMonedaID,  
															      'ANTICIPOS', 
																  $strSucursales, 
																  $intFormaPagoID);


				//Si hay información de ventas, pagos  y/o anticipos
				if($otdVentasMaquinaria OR $otdVentasRefacciones OR $otdVentasServicio
					OR $otdVentasConceptos OR $otdPagosMaquinaria OR $otdPagosRefacciones 
					OR $otdPagosServicio OR $otdPagosConceptos OR $otdPagosCartera OR $otdAnticipos)
				{

					//Seleccionar los datos de las distintas formas de pago 
					$otdFormasPago = $this->pagos->buscar_distintas_formas_pago_ingresos_dia($dteFecha, 
																						     $intMonedaID,
																						     $strSucursales, 
																						     $strModulos, 
																		 					 $intFormaPagoID);

					//Recorremos el arreglo para obtener la información de las formas de pago 
					foreach ($otdFormasPago as $arrFP)
					{
						//Inicializar variables
						$arrImporteFormaPago[$arrFP->forma_pago_id] = 0;
					}

					//Asignar el valor de la descripción (título de la lista de registros) del reporte
					$pdf->strLinea4 = utf8_decode('MONEDA: '.$strMoneda);

					//Agregar pagina
					$pdf->AddPage();
					
					//VENTAS (FACTURAS) DE CONTADO
				    //Ventas de maquinaria
				    //Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
				    $arrIngresos = array();
					//Si hay información de las ventas
					if($otdVentasMaquinaria)
					{
						//Recorremos el arreglo 
						foreach ($otdVentasMaquinaria as $arrVM)
						{
							//Asignar valores del registro
							$intImporte = $arrVM->importe;
							$intIva = $arrVM->iva;
							$intIeps = $arrVM->ieps;

							//Definir valores del array auxiliar de información (para cada ingreso)
							$arrAuxiliar["concepto"] = utf8_decode($arrVM->concepto);
							$arrAuxiliar["forma_pago"] =  utf8_decode($arrVM->forma_pago);
							$arrAuxiliar["importe"] = '$'.number_format($intImporte,2);
							//Asignar datos al array
                       		array_push($arrIngresos, $arrAuxiliar); 

						   //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;


						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;
						    //Incrementar valores del array
							$arrImporteFormaPago[$arrVM->forma_pago_id] += $intTotal;

						}


						//Cambiar el volumen de la fuente a bold
		      			$pdf->strTipoLetraTabla = 'Negrita';
		      			//Acumulado del importe
						$pdf->Row(array('VENTAS DE CONTADO DE MAQUINARIA', '', '',
										'$'.number_format($intAcumTotal, 2)),
										$pdf->arrAlineacion, 'ClippedCell');
						//Cambiar el volumen de la fuente a normal
		      			$pdf->strTipoLetraTabla = '';
						//Si se cumple la sentencia mostrar ingresos de maquinaria
						if($arrIngresos)
						{
							//Recorremos el arreglo 
					        foreach ($arrIngresos as $arrDet) 
					        {
							   	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							    $pdf->Row(array($arrDet['concepto'], $arrDet['forma_pago'], $arrDet['importe']), 
							    				$pdf->arrAlineacion, 'ClippedCell');
							}

						}//Cierre de verificación de ingresos

						//Acumulado del Subtotal
						$pdf->Row(array('SUBTOTAL DE CONTADO', '', '', 
										'$'.number_format( $intAcumSubtotal,2)), 
										 $pdf->arrAlineacion, 'ClippedCell');

						//Acumulado del IVA
						$pdf->Row(array('IVA TRASLADADO DE CONTADO', '', '', 
										'$'.number_format( $intAcumIva,2)), 
										 $pdf->arrAlineacion, 'ClippedCell');
						//Acumulado del IEPS
						$pdf->Row(array('IEPS TRASLADADO DE CONTADO', '', '', 
										'$'.number_format( $intAcumIeps,2)), 
										 $pdf->arrAlineacion, 'ClippedCell');

						$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de las ventas

					}//Cierre de verificación de ventas de maquinaria

					
					
					//Ventas de refacciones
					//Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
				    $arrIngresos = array();
					//Si hay información de las ventas
					if($otdVentasRefacciones)
					{
						//Recorremos el arreglo 
						foreach ($otdVentasRefacciones as $arrVR)
						{
							//Asignar valores del registro
							$intImporte = $arrVR->importe;
							$intIva = $arrVR->iva;
							$intIeps = $arrVR->ieps;

							//Definir valores del array auxiliar de información (para cada ingreso)
							$arrAuxiliar["concepto"] = utf8_decode($arrVR->concepto);
							$arrAuxiliar["forma_pago"] =  utf8_decode($arrVR->forma_pago);
							$arrAuxiliar["importe"] = '$'.number_format($intImporte,2);
							//Asignar datos al array
                       		array_push($arrIngresos, $arrAuxiliar); 

						    //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrVR->forma_pago_id] += $intTotal;
						}


						//Cambiar el volumen de la fuente a bold
		      			$pdf->strTipoLetraTabla = 'Negrita';
						//Acumulado del importe
						$pdf->Row(array('VENTAS DE CONTADO DE REFACCIONES', '', '', 
										'$'.number_format( $intAcumTotal,2)), 
										$pdf->arrAlineacion, 'ClippedCell');
					
						//Cambiar el volumen de la fuente a normal
		      			$pdf->strTipoLetraTabla = '';
						//Si se cumple la sentencia mostrar ingresos de refacciones
						if($arrIngresos)
						{
							//Recorremos el arreglo 
					        foreach ($arrIngresos as $arrDet) 
					        {
							   	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							    $pdf->Row(array($arrDet['concepto'], $arrDet['forma_pago'], $arrDet['importe']), 
							    				$pdf->arrAlineacion, 'ClippedCell');
							}

						}//Cierre de verificación de ingresos

						//Acumulado del Subtotal
						$pdf->Row(array('SUBTOTAL DE CONTADO', '', '', 
										'$'.number_format( $intAcumSubtotal,2)), 
										 $pdf->arrAlineacion, 'ClippedCell');
						//Acumulado del IVA
						$pdf->Row(array('IVA TRASLADADO DE CONTADO', '', '', 
										'$'.number_format( $intAcumIva,2)),  
										$pdf->arrAlineacion, 'ClippedCell');
						//Acumulado del IEPS
						$pdf->Row(array('IEPS TRASLADADO DE CONTADO', '', '', 
										'$'.number_format( $intAcumIeps,2)),
										$pdf->arrAlineacion, 'ClippedCell');
						$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de las ventas


					}//Cierre de verificación de ventas de refacciones

					

					//Ventas de servicio
					//Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
				    $arrIngresos = array();
					//Si hay información de las ventas
					if($otdVentasServicio)
					{
						//Recorremos el arreglo 
						foreach ($otdVentasServicio as $arrVS)
						{
							//Asignar valores del registro
							$intImporte = $arrVS->importe;
							$intIva = $arrVS->iva;
							$intIeps = $arrVS->ieps;

						    //Definir valores del array auxiliar de información (para cada ingreso)
							$arrAuxiliar["concepto"] = utf8_decode($arrVS->concepto);
							$arrAuxiliar["forma_pago"] =  utf8_decode($arrVS->forma_pago);
							$arrAuxiliar["importe"] = '$'.number_format($intImporte,2);
							//Asignar datos al array
                       		array_push($arrIngresos, $arrAuxiliar); 

						    //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrVS->forma_pago_id] += $intTotal;
						}

						//Cambiar el volumen de la fuente a bold
		      			$pdf->strTipoLetraTabla = 'Negrita';
						//Acumulado del importe
						$pdf->Row(array('VENTAS DE CONTADO DE SERVICIO', '', '', 
										'$'.number_format( $intAcumTotal,2)), 
										$pdf->arrAlineacion, 'ClippedCell');
						//Cambiar el volumen de la fuente a normal
		      			$pdf->strTipoLetraTabla = '';
						//Si se cumple la sentencia mostrar ingresos de servicio
						if($arrIngresos)
						{
							//Recorremos el arreglo 
					        foreach ($arrIngresos as $arrDet) 
					        {
							   	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							    $pdf->Row(array($arrDet['concepto'], $arrDet['forma_pago'], $arrDet['importe']), 
							    				$pdf->arrAlineacion, 'ClippedCell');
							}

						}//Cierre de verificación de ingresos


						//Acumulado del Subtotal
						$pdf->Row(array('SUBTOTAL DE CONTADO', '', '', 
										'$'.number_format( $intAcumSubtotal,2)), 
										 $pdf->arrAlineacion, 'ClippedCell');
						//Acumulado del IVA
						$pdf->Row(array('IVA TRASLADADO DE CONTADO', '', '', 
										'$'.number_format( $intAcumIva,2)),
										$pdf->arrAlineacion, 'ClippedCell');
						//Acumulado del IEPS
						$pdf->Row(array('IEPS TRASLADADO DE CONTADO', '', '', 
										'$'.number_format( $intAcumIeps,2)),
										$pdf->arrAlineacion, 'ClippedCell');
						$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de las ventas


					}//Cierre de verificación de ventas de servicio

					

					//Ventas de concepto
					//Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
				    $arrIngresos = array();
					//Si hay información de las ventas
					if($otdVentasConceptos)
					{
						//Recorremos el arreglo 
						foreach ($otdVentasConceptos as $arrVC)
						{
							//Asignar valores del registro
							$intImporte = $arrVC->importe;
							$intIva = $arrVC->iva;
							$intIeps = $arrVC->ieps;

						    //Definir valores del array auxiliar de información (para cada ingreso)
							$arrAuxiliar["concepto"] = utf8_decode($arrVC->concepto);
							$arrAuxiliar["forma_pago"] =  utf8_decode($arrVC->forma_pago);
							$arrAuxiliar["importe"] = '$'.number_format($intImporte,2);
							//Asignar datos al array
                       		array_push($arrIngresos, $arrAuxiliar); 

						    //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrVC->forma_pago_id] += $intTotal;
						}

						//Cambiar el volumen de la fuente a bold
		      			$pdf->strTipoLetraTabla = 'Negrita';
						//Acumulado del importe
						$pdf->Row(array('VENTAS DE CONTADO DE CONCEPTO', '', '', 
										'$'.number_format( $intAcumTotal,2)), 
										$pdf->arrAlineacion, 'ClippedCell');
						//Cambiar el volumen de la fuente a normal
		      			$pdf->strTipoLetraTabla = '';
						//Si se cumple la sentencia mostrar ingresos de servicio
						if($arrIngresos)
						{
							//Recorremos el arreglo 
					        foreach ($arrIngresos as $arrDet) 
					        {
							   	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							    $pdf->Row(array($arrDet['concepto'], $arrDet['forma_pago'], $arrDet['importe']), 
							    				$pdf->arrAlineacion, 'ClippedCell');
							}

						}//Cierre de verificación de ingresos

						//Acumulado del Subtotal
						$pdf->Row(array('SUBTOTAL DE CONTADO', '', '', 
										'$'.number_format( $intAcumSubtotal,2)), 
										 $pdf->arrAlineacion, 'ClippedCell');
						//Acumulado del IVA
						$pdf->Row(array('IVA TRASLADADO DE CONTADO', '', '', 
										'$'.number_format( $intAcumIva,2)),
										$pdf->arrAlineacion, 'ClippedCell');
						//Acumulado del IEPS
						$pdf->Row(array('IEPS TRASLADADO DE CONTADO', '', '', 
										'$'.number_format( $intAcumIeps,2)),
										$pdf->arrAlineacion, 'ClippedCell');
						$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de las ventas


					}//Cierre de verificación de ventas de conceptos

					
					
					//PAGOS DE VENTAS (FACTURAS)
					//Pagos de maquinaria
					//Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
				    $arrIngresos = array();
					//Si hay información de los pagos
					if($otdPagosMaquinaria)
					{
						//Recorremos el arreglo 
						foreach ($otdPagosMaquinaria as $arrPM)
						{
							//Asignar valores del registro
							$intImporte = $arrPM->importe;
							$intIva = $arrPM->iva;
							$intIeps = $arrPM->ieps;

						    //Definir valores del array auxiliar de información (para cada ingreso)
							$arrAuxiliar["concepto"] = utf8_decode($arrPM->concepto);
							$arrAuxiliar["forma_pago"] =  utf8_decode($arrPM->forma_pago);
							$arrAuxiliar["importe"] = '$'.number_format($intImporte,2);
							//Asignar datos al array
                       		array_push($arrIngresos, $arrAuxiliar); 

						   //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrPM->forma_pago_id] += $intTotal;
						}

						//Cambiar el volumen de la fuente a bold
		      			$pdf->strTipoLetraTabla = 'Negrita';
						//Acumulado del importe
						$pdf->Row(array(utf8_decode('PAGOS DE VENTA A CRÉDITO DE MAQUINARIA'), '', '', 
										'$'.number_format( $intAcumTotal,2)),
										 $pdf->arrAlineacion, 'ClippedCell');
						//Cambiar el volumen de la fuente a normal
		      			$pdf->strTipoLetraTabla = '';
		      			//Si se cumple la sentencia mostrar ingresos de pagos
						if($arrIngresos)
						{
							//Recorremos el arreglo 
					        foreach ($arrIngresos as $arrDet) 
					        {
							   	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							    $pdf->Row(array($arrDet['concepto'], $arrDet['forma_pago'], $arrDet['importe']), 
							    				$pdf->arrAlineacion, 'ClippedCell');
							}

						}//Cierre de verificación de ingresos

						//Acumulado del Subtotal
						$pdf->Row(array('SUBTOTAL DE CONTADO', '', '', 
										'$'.number_format( $intAcumSubtotal,2)), 
										 $pdf->arrAlineacion, 'ClippedCell');
						//Acumulado del IVA
						$pdf->Row(array(utf8_decode('IVA TRASLADADO DE CRÉDITO'), '', '', 
										'$'.number_format( $intAcumIva,2)),
										 $pdf->arrAlineacion, 'ClippedCell');
						//Acumulado del IEPS
						$pdf->Row(array(utf8_decode('IEPS TRASLADADO DE CRÉDITO'), '', '', 
										'$'.number_format( $intAcumIeps,2)),
										$pdf->arrAlineacion, 'ClippedCell');
						$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los pagos


					}//Cierre de verificación de pagos de maquinaria

					

					//Pagos de refacciones
					//Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
				    $arrIngresos = array();
					//Si hay información de los pagos 
					if($otdPagosRefacciones)
					{
						//Recorremos el arreglo 
						foreach ($otdPagosRefacciones as $arrPR)
						{
							//Asignar valores del registro
							$intImporte = $arrPR->importe;
							$intIva = $arrPR->iva;
							$intIeps = $arrPR->ieps;

						    //Definir valores del array auxiliar de información (para cada ingreso)
							$arrAuxiliar["concepto"] = utf8_decode($arrPR->concepto);
							$arrAuxiliar["forma_pago"] =  utf8_decode($arrPR->forma_pago);
							$arrAuxiliar["importe"] = '$'.number_format($intImporte,2);
							//Asignar datos al array
                       		array_push($arrIngresos, $arrAuxiliar); 

						    //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrPR->forma_pago_id] += $intTotal;
						}

						//Cambiar el volumen de la fuente a bold
		      			$pdf->strTipoLetraTabla = 'Negrita';
						//Acumulado del importe
						$pdf->Row(array(utf8_decode('PAGOS DE VENTA A CRÉDITO DE REFACCIONES'), '', '', 
										'$'.number_format( $intAcumTotal,2)),
										$pdf->arrAlineacion, 'ClippedCell');

						//Cambiar el volumen de la fuente a normal
		      			$pdf->strTipoLetraTabla = '';
		      			//Si se cumple la sentencia mostrar ingresos de pagos
						if($arrIngresos)
						{
							//Recorremos el arreglo 
					        foreach ($arrIngresos as $arrDet) 
					        {
							   	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							    $pdf->Row(array($arrDet['concepto'], $arrDet['forma_pago'], $arrDet['importe']), 
							    				$pdf->arrAlineacion, 'ClippedCell');
							}

						}//Cierre de verificación de ingresos

						//Acumulado del Subtotal
						$pdf->Row(array('SUBTOTAL DE CONTADO', '', '', 
										'$'.number_format( $intAcumSubtotal,2)), 
										 $pdf->arrAlineacion, 'ClippedCell');
						//Acumulado del IVA
						$pdf->Row(array(utf8_decode('IVA TRASLADADO DE CRÉDITO'), '', '', 
										'$'.number_format( $intAcumIva,2)), $pdf->arrAlineacion, 'ClippedCell');
						//Acumulado del IEPS
						$pdf->Row(array(utf8_decode('IEPS TRASLADADO DE CRÉDITO'), '', '', 
										'$'.number_format( $intAcumIeps,2)),
										$pdf->arrAlineacion, 'ClippedCell');
						$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los pagos

					}//Cierre de verificación de pagos de refacciones

					

					//Pagos de servicio
					//Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
				    $arrIngresos = array();
					//Si hay información de los pagos
					if($otdPagosServicio)
					{
						//Recorremos el arreglo 
						foreach ($otdPagosServicio as $arrPS)
						{
							//Asignar valores del registro
							$intImporte = $arrPS->importe;
							$intIva = $arrPS->iva;
							$intIeps = $arrPS->ieps;

						    //Definir valores del array auxiliar de información (para cada ingreso)
							$arrAuxiliar["concepto"] = utf8_decode($arrPS->concepto);
							$arrAuxiliar["forma_pago"] =  utf8_decode($arrPS->forma_pago);
							$arrAuxiliar["importe"] = '$'.number_format($intImporte,2);
							//Asignar datos al array
                       		array_push($arrIngresos, $arrAuxiliar); 

						    //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrPS->forma_pago_id] += $intTotal;
						}

						//Cambiar el volumen de la fuente a bold
		      			$pdf->strTipoLetraTabla = 'Negrita';
						//Acumulado del importe
						$pdf->Row(array(utf8_decode('PAGOS DE VENTA A CRÉDITO DE SERVICIO'), '', '', 
										'$'.number_format( $intAcumTotal,2)),
										$pdf->arrAlineacion, 'ClippedCell');
						//Cambiar el volumen de la fuente a normal
		      			$pdf->strTipoLetraTabla = '';
		      			//Si se cumple la sentencia mostrar ingresos de pagos
						if($arrIngresos)
						{
							//Recorremos el arreglo 
					        foreach ($arrIngresos as $arrDet) 
					        {
							   	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							    $pdf->Row(array($arrDet['concepto'], $arrDet['forma_pago'], $arrDet['importe']), 
							    				$pdf->arrAlineacion, 'ClippedCell');
							}

						}//Cierre de verificación de ingresos

						//Acumulado del Subtotal
						$pdf->Row(array('SUBTOTAL DE CONTADO', '', '', 
										'$'.number_format( $intAcumSubtotal,2)), 
										 $pdf->arrAlineacion, 'ClippedCell');
						//Acumulado del IVA
						$pdf->Row(array(utf8_decode('IVA TRASLADADO DE CRÉDITO'), '', '', 
										'$'.number_format($intAcumIva,2)),
										$pdf->arrAlineacion, 'ClippedCell');
						//Acumulado del IEPS
						$pdf->Row(array(utf8_decode('IEPS TRASLADADO DE CRÉDITO'), '', '', 
										'$'.number_format( $intAcumIeps,2)),
										$pdf->arrAlineacion, 'ClippedCell');
						$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los pagos


					}//Cierre de verificación de pagos de servicio

					

					//Pagos de concepto
					//Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
				    $arrIngresos = array();
					//Si hay información de los pagos
					if($otdPagosConceptos)
					{
						//Recorremos el arreglo 
						foreach ($otdPagosConceptos as $arrPC)
						{
							//Asignar valores del registro
							$intImporte = $arrPC->importe;
							$intIva = $arrPC->iva;
							$intIeps = $arrPC->ieps;

						    //Definir valores del array auxiliar de información (para cada ingreso)
							$arrAuxiliar["concepto"] = utf8_decode($arrPC->concepto);
							$arrAuxiliar["forma_pago"] =  utf8_decode($arrPC->forma_pago);
							$arrAuxiliar["importe"] = '$'.number_format($intImporte,2);
							//Asignar datos al array
                       		array_push($arrIngresos, $arrAuxiliar); 

						    //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrPC->forma_pago_id] += $intTotal;
						}

						//Cambiar el volumen de la fuente a bold
		      			$pdf->strTipoLetraTabla = 'Negrita';
						//Acumulado del importe
						$pdf->Row(array(utf8_decode('PAGOS DE VENTA A CRÉDITO DE CONCEPTO'), '', '', 
										'$'.number_format( $intAcumTotal,2)),
										$pdf->arrAlineacion, 'ClippedCell');
						//Cambiar el volumen de la fuente a normal
		      			$pdf->strTipoLetraTabla = '';
		      			//Si se cumple la sentencia mostrar ingresos de pagos
						if($arrIngresos)
						{
							//Recorremos el arreglo 
					        foreach ($arrIngresos as $arrDet) 
					        {
							   	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							    $pdf->Row(array($arrDet['concepto'], $arrDet['forma_pago'], $arrDet['importe']), 
							    				$pdf->arrAlineacion, 'ClippedCell');
							}

						}//Cierre de verificación de ingresos

						//Acumulado del Subtotal
						$pdf->Row(array('SUBTOTAL DE CONTADO', '', '', 
										'$'.number_format( $intAcumSubtotal,2)), 
										 $pdf->arrAlineacion, 'ClippedCell');
						//Acumulado del IVA
						$pdf->Row(array(utf8_decode('IVA TRASLADADO DE CRÉDITO'), '', '', 
										'$'.number_format($intAcumIva,2)),
										$pdf->arrAlineacion, 'ClippedCell');
						//Acumulado del IEPS
						$pdf->Row(array(utf8_decode('IEPS TRASLADADO DE CRÉDITO'), '', '', 
										'$'.number_format( $intAcumIeps,2)),
										$pdf->arrAlineacion, 'ClippedCell');
						$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los pagos


					}//Cierre de verificación de pagos de conceptos

					


					//Pagos de cartera
					//Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
				    $arrIngresos = array();
					//Si hay información de los pagos
					if($otdPagosCartera)
					{
						//Recorremos el arreglo 
						foreach ($otdPagosConceptos as $arrPC)
						{
							//Asignar valores del registro
							$intImporte = $arrPC->importe;
							$intIva = $arrPC->iva;
							$intIeps = $arrPC->ieps;

						    //Definir valores del array auxiliar de información (para cada ingreso)
							$arrAuxiliar["concepto"] = utf8_decode($arrPC->concepto);
							$arrAuxiliar["forma_pago"] =  utf8_decode($arrPC->forma_pago);
							$arrAuxiliar["importe"] = '$'.number_format($intImporte,2);
							//Asignar datos al array
                       		array_push($arrIngresos, $arrAuxiliar); 

						     //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;


						    //Incrementar valores del array
							$arrImporteFormaPago[$arrPC->forma_pago_id] += $intTotal;
						}

					}//Cierre de verificación de pagos


					//Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
					//Acumulado del importe
					$pdf->Row(array(utf8_decode('PAGOS DE CARTERA VENCIDA '), '', '', 
									'$'.number_format( $intAcumTotal,2)),
									$pdf->arrAlineacion, 'ClippedCell');
					//Cambiar el volumen de la fuente a normal
	      			$pdf->strTipoLetraTabla = '';
	      			//Si se cumple la sentencia mostrar ingresos de pagos
					if($arrIngresos)
					{
						//Recorremos el arreglo 
				        foreach ($arrIngresos as $arrDet) 
				        {
						   	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						    $pdf->Row(array($arrDet['concepto'], $arrDet['forma_pago'], $arrDet['importe']), 
						    				$pdf->arrAlineacion, 'ClippedCell');
						}

					}//Cierre de verificación de ingresos

					//Acumulado del Subtotal
				    $pdf->Row(array('SUBTOTAL DE CONTADO', '', '', 
										'$'.number_format( $intAcumSubtotal,2)), 
										 $pdf->arrAlineacion, 'ClippedCell');
					//Acumulado del IVA
					$pdf->Row(array(utf8_decode('IVA TRASLADADO DE CRÉDITO'), '', '', 
									'$'.number_format($intAcumIva,2)),
									$pdf->arrAlineacion, 'ClippedCell');
					//Acumulado del IEPS
					$pdf->Row(array(utf8_decode('IEPS TRASLADADO DE CRÉDITO'), '', '', 
									'$'.number_format( $intAcumIeps,2)),
									$pdf->arrAlineacion, 'ClippedCell');
					$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los pagos
			
					//ANTICIPOS DE CLIENTES
					//Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
				    $arrIngresos = array();
					//Si hay información de los anticipos
					if($otdAnticipos)
					{
						//Recorremos el arreglo 
						foreach ($otdAnticipos as $arrA)
						{
							//Asignar valores del registro
							$intImporte = $arrA->importe;
							$intIva = $arrA->iva;
							$intIeps = $arrA->ieps;

						    //Definir valores del array auxiliar de información (para cada ingreso)
							$arrAuxiliar["concepto"] = utf8_decode($arrA->concepto);
							$arrAuxiliar["forma_pago"] =  utf8_decode($arrA->forma_pago);
							$arrAuxiliar["importe"] = '$'.number_format($intImporte,2);
							//Asignar datos al array
                       		array_push($arrIngresos, $arrAuxiliar); 

						    //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;


						    //Incrementar valores del array
							$arrImporteFormaPago[$arrA->forma_pago_id] += $intTotal;
						}

					}//Cierre de verificación de anticipos

					//Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
	      			//Acumulado del importe
					$pdf->Row(array('ANTICIPOS DE CLIENTES', '', '',
									'$'.number_format($intAcumTotal, 2)), 
									$pdf->arrAlineacion, 'ClippedCell');
					//Cambiar el volumen de la fuente a normal
	      			$pdf->strTipoLetraTabla = '';
	      			//Si se cumple la sentencia mostrar ingresos de anticipos
					if($arrIngresos)
					{
						//Recorremos el arreglo 
				        foreach ($arrIngresos as $arrDet) 
				        {
						   	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						    $pdf->Row(array($arrDet['concepto'], $arrDet['forma_pago'], $arrDet['importe']), 
						    				$pdf->arrAlineacion, 'ClippedCell');
						}

					}//Cierre de verificación de ingresos

					//Acumulado del Subtotal
				    $pdf->Row(array('SUBTOTAL DE CONTADO', '', '', 
										'$'.number_format( $intAcumSubtotal,2)), 
										 $pdf->arrAlineacion, 'ClippedCell');
					//Acumulado del IVA
					$pdf->Row(array('IVA TRASLADADO', '', '', '$'.number_format( $intAcumIva,2)), 
									 $pdf->arrAlineacion, 'ClippedCell');
					//Acumulado del IEPS
					$pdf->Row(array('IEPS TRASLADADO', '', '', '$'.number_format( $intAcumIeps,2)),  
									$pdf->arrAlineacion, 'ClippedCell');
					$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los anticipos
					$pdf->Ln(2); //Deja un salto de línea



					//------------------------------------------------------------------------------------------------------------------------
			        //---------- RESUMEN
			        //------------------------------------------------------------------------------------------------------------------------
					//Variable que se utiliza para asignar acumulado total de ingresos
					$intAcumTotal = 0;
					//Recorremos el arreglo para obtener la información de las formas de pago 
					foreach ($otdFormasPago as $arrFP)
					{
						//Asignar el acumulado del importe (por cada forma de pago recorrida)
						$intAcumFormaPago = $arrImporteFormaPago[$arrFP->forma_pago_id];

						$pdf->Row(array('',utf8_decode($arrFP->forma_pago),
										'$'.number_format($intAcumFormaPago, 2), ''),
										$pdf->arrAlineacion, 'ClippedCell');

						//Incrementar acumulado total de ingresos
						$intAcumTotal += $intAcumFormaPago;
					}

					$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información del total 
					//Asigna el tipo y tamaño de letra
			        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->ClippedCell(130, 6, 'TOTAL:', 0, 0, 'R', 0);
					//Acumulado de ingresos
					$pdf->ClippedCell(30, 6, '$'.number_format($intAcumTotal,2), 0, 0, 'R', 0);

				}//Cierre de verificación de información de ventas, pagos y/o anticipos

			}

		}//Cierre de verificación de monedas

		//Ejecutar la salida del reporte
        $pdf->Output('ingresos_dia.pdf','I'); 
	}

   /*Método para generar un archivo XLS con los ingresos del día
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFecha = $this->input->post('dteFecha');
		$strSucursales = trim($this->input->post('strSucursales'));
		$strModulos = trim($this->input->post('strModulos'));
		$intFormaPagoID = $this->input->post('intFormaPagoID');

		//Número de fila donde se va a comenzar a rellenar
		$intFila = 14;
       //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 13;
        //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
		//Variable que se utiliza para asignar el acumulado del subtotal
		$intAcumSubtotal = 0;
		//Variable que se utiliza para asignar el acumulado del IVA
		$intAcumIva = 0;
		//Variable que se utiliza para asignar el acumulado del IEPS
		$intAcumIeps = 0;
		//Variable que se utiliza para asignar el acumulado del total
		$intAcumTotal = 0;
		//Array que se utiliza para asignar el importe por forma de pago
		$arrImporteFormaPago = array();
		//Variable que se utiliza para agregar las ventas y pagos de maquinaria
	     $strVtasModMaquinaria = "";
	     //Variable que se utiliza para agregar las ventas y pagos de refacciones
	     $strVtasModRefacciones = "";
	     //Variable que se utiliza para agregar las ventas y pagos de servicio
	     $strVtasModServicio = "";
	     //Variable que se utiliza para agregar las ventas y pagos de conceptos
	     $strVtasModConceptos = "";

		
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16 DE OCTUBRE DE 2017 
		$strTituloFecha = strtoupper($this->get_fecha_formato_letra($dteFecha, ''));

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

			//Dependiendo del modulo asignar valor a la restricción que se utiliza para buscar datos de las facturas
			if($strModulo == 'MAQUINARIA')
			{
			   //Facturas y pagos de maquinaria
			   $strVtasModMaquinaria = $strModulo;
			}

			if($strModulo == 'REFACCIONES')
			{
				//Facturas y pagos de refacciones
				$strVtasModRefacciones = $strModulo;
			}
			
			if($strModulo == 'SERVICIO')
			{
				//Facturas y pagos de servicio
				$strVtasModServicio = $strModulo;
			}
			
			if($strModulo == 'CONCEPTOS')
			{
				//Facturas y pagos de conceptos
				$strVtasModConceptos = $strModulo;
			}

		}

		//Quitar último elemento de la cadena (,)
		$strTituloModulos = substr($strTituloModulos, 0, -2);

		//Variable para asignar la descripción de la forma de pago
	    $strTituloFormaPago = '';

		//Si existe forma de pago
		if($intFormaPagoID > 0)
		{
			//Seleccionar los datos de la forma de pago que coincide con el id
			$otdFormaPago = $this->formas->buscar($intFormaPagoID);

			//Asignar el valor de la línea cinco del título
			$strTituloFormaPago = strtoupper($otdFormaPago->codigo.' - '.$otdFormaPago->descripcion);
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
				//Asignar la descripción de la moneda actual
				$strMoneda = strtoupper($arrMon->codigo.' - '.$arrMon->descripcion);
				
			    //Asignar el nombre de la hoja
				$strNombreHoja = 'ingresos '.$arrMon->codigo;


				 //Se agrega el título del archivo
					$objExcel->getActiveSheet()->setCellValue('A7', 'INGRESOS DEL DÍA '.$strTituloFecha);
					$objExcel->getActiveSheet()->setCellValue('A8', 'SUCURSALES: '.$strTituloSucursales);
				    $objExcel->getActiveSheet()->setCellValue('A9', 'MÓDULOS: '.$strTituloModulos);
					

					//Si existe forma de pago
					if($intFormaPagoID > 0)
					{

						$objExcel->getActiveSheet()->setCellValue('A11', 'FORMA DE PAGO: '.$strTituloFormaPago);
						
					}


					//Se agregan las columnas de cabecera
				    $objExcel->getActiveSheet()
				    		 ->setCellValue('A'.$intPosEncabezados, 'CONCEPTO')
				    		 ->setCellValue('B'.$intPosEncabezados, 'FORMA DE PAGO')
				    		 ->setCellValue('C'.$intPosEncabezados, 'IMPORTE')
				    		 ->setCellValue('D'.$intPosEncabezados, 'DEBE HABER');
 					

 					//Combinar las siguientes celdas
			       	$objExcel->getActiveSheet()->mergeCells('A8:D8');
			       	$objExcel->getActiveSheet()->mergeCells('A9:D9');
			       	$objExcel->getActiveSheet()->mergeCells('A10:D10');
			       	$objExcel->getActiveSheet()->mergeCells('A11:D11');

 					//Cambiar estilo de las siguientes celdas
			        $objExcel->getActiveSheet()
			        		 ->getStyle('A8:D11')
			        		 ->applyFromArray($arrStyleBold);

			          //Preferencias de color de relleno de celda 
			        $objExcel->getActiveSheet()
			    			 ->getStyle('A13:D13')
			    			 ->getFill()
			    			 ->applyFromArray($arrStyleColumnas);

			   		//Preferencias de color de texto de la celda 
		        	$objExcel->getActiveSheet()
		    			 ->getStyle('A9:D9')
		    			 ->applyFromArray($arrStyleFuenteColumnasPrinc);

			    	$objExcel->getActiveSheet()
			    			 ->getStyle('A13:D13')
			    			 ->applyFromArray($arrStyleFuenteColumnas);

			    	//Cambiar alineación de las siguientes celdas
					$objExcel->getActiveSheet()
			            	 ->getStyle('A9:D9')
			            	 ->getAlignment()
			            	 ->applyFromArray($arrStyleAlignmentLeft);

			        $objExcel->getActiveSheet()
			            	 ->getStyle('A13:D13')
			            	 ->getAlignment()
			            	 ->applyFromArray($arrStyleAlignmentCenter);
			            	 

				//Inicializar objetos de datos
			  	//Módulo de maquinaria
			  	$otdVentasMaquinaria = NULL;
				$otdPagosMaquinaria = NULL;
			  	//Módulo de refacciones
			  	$otdVentasRefacciones = NULL;
			  	$otdPagosRefacciones = NULL;
			  	//Módulo de servicio
			  	$otdVentasServicio = NULL;
			  	$otdPagosServicio = NULL;
			  	//Módulo de conceptos
			  	$otdVentasConceptos  = NULL;
			  	$otdPagosConceptos = NULL;


				//Si se cumple la sentencia agregar facturas y pagos de maquinaria
			  	if($strVtasModMaquinaria != "")
			  	{
			  		//Seleccionar las ventas (facturas) de contado de maquinaria 
					$otdVentasMaquinaria = $this->pagos->buscar_ingresos_dia($dteFecha,
																			 $intMonedaID,  
																		    'FACTURAS MAQUINARIA', 
																			 $strSucursales, 
																			 $intFormaPagoID);

					//Seleccionar los pagos de ventas (facturas) de maquinaria
					$otdPagosMaquinaria = $this->pagos->buscar_ingresos_dia($dteFecha,
																	    $intMonedaID,  
																	    'PAGOS MAQUINARIA', 
																		 $strSucursales, 
																		 $intFormaPagoID);
			  	}

			  	//Si se cumple la sentencia agregar facturas y pagos de refacciones
			  	if($strVtasModRefacciones != "")
			  	{
			  		//Seleccionar las ventas (facturas) de contado de refacciones 
					$otdVentasRefacciones = $this->pagos->buscar_ingresos_dia($dteFecha,
																		  $intMonedaID,  
																	      'FACTURAS REFACCIONES', 
																		   $strSucursales, 
																		   $intFormaPagoID);

					//Seleccionar los pagos de ventas (facturas) de refacciones
					$otdPagosRefacciones = $this->pagos->buscar_ingresos_dia($dteFecha,
																		     $intMonedaID,  
																		     'PAGOS REFACCIONES', 
																			 $strSucursales, 
																			 $intFormaPagoID);


			  	}

			  	
			  	//Si se cumple la sentencia agregar facturas y pagos de servicio
				if($strVtasModServicio != "")
			  	{

				

					//Seleccionar las ventas (facturas) de contado de servicio
					$otdVentasServicio = $this->pagos->buscar_ingresos_dia($dteFecha,
																		   $intMonedaID,  
																		   'FACTURAS SERVICIO', 
																			$strSucursales, 
																			$intFormaPagoID);

					//Seleccionar los pagos de ventas (facturas) de servicio
					$otdPagosServicio = $this->pagos->buscar_ingresos_dia($dteFecha,
																		  $intMonedaID,  
																		  'PAGOS SERVICIO', 
																		   $strSucursales, 
																		   $intFormaPagoID);

				}

				//Si se cumple la sentencia agregar facturas y pagos de conceptos
				if($strVtasModConceptos != "")
			  	{
				   //Seleccionar las ventas (facturas) de contado de conceptos
					$otdVentasConceptos = $this->pagos->buscar_ingresos_dia($dteFecha,
																		   $intMonedaID,  
																		   'FACTURAS CONCEPTOS', 
																			$strSucursales, 
																			$intFormaPagoID);
					

					//Seleccionar los pagos de ventas (facturas) de conceptos
					$otdPagosConceptos = $this->pagos->buscar_ingresos_dia($dteFecha,
																		  $intMonedaID,  
																		  'PAGOS CONCEPTOS', 
																		   $strSucursales, 
																		   $intFormaPagoID);
				}


				//Seleccionar los pagos de ventas (facturas) de cartera
				$otdPagosCartera = $this->pagos->buscar_ingresos_dia($dteFecha,
																	 $intMonedaID,  
																	 'PAGOS CARTERA', 
																	  $strSucursales, 
																	  $intFormaPagoID);


				//Seleccionar los anticipos de clientes
				$otdAnticipos = $this->pagos->buscar_ingresos_dia($dteFecha,
																  $intMonedaID,  
															      'ANTICIPOS', 
																  $strSucursales, 
																  $intFormaPagoID);


				//Si hay información de ventas, pagos  y/o anticipos
				if($otdVentasMaquinaria OR $otdVentasRefacciones OR $otdVentasServicio
					OR $otdVentasConceptos OR $otdPagosMaquinaria OR $otdPagosRefacciones 
					OR $otdPagosServicio OR $otdPagosConceptos OR $otdPagosCartera OR $otdAnticipos)
				{

					//Número de fila donde se va a comenzar a rellenar
				    $intFila = 14;
				    $intFilaInicial = 14;
					
					//Si el id de la moneda corresponde al peso mexicano
			      	if($arrMon->moneda_id == MONEDA_BASE)
			      	{
			      		//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
				        $this->get_encabezado_archivo_excel($objExcel);
				        //Marcar como activa la nueva hoja
				        $objExcel->setActiveSheetIndex($intContadorHojas);   
				     
					}
					else
					{
						//Incrementar contador por cada moneda
						$intContadorHojas++;
						//Agregar nueva hoja
						$objNuevaHoja = $objExcel->createSheet();
						//Marcar como activa la nueva hoja
						$objExcel->setActiveSheetIndex($intContadorHojas); 
						//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
			            $this->get_encabezado_archivo_excel($objNuevaHoja, 'nueva');
			            //Definir nombre de la hoja
						$objNuevaHoja->setTitle($strNombreHoja);

					}

					//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
			        $this->get_encabezado_archivo_excel($objExcel);
			        //Marcar como activa la nueva hoja
			        $objExcel->setActiveSheetIndex($intContadorHojas); 

			       
			        $objExcel->getActiveSheet()->setCellValue('A10', 'MONEDA: '.$strMoneda);

			        //Seleccionar los datos de las distintas formas de pago 
					$otdFormasPago = $this->pagos->buscar_distintas_formas_pago_ingresos_dia($dteFecha, 
																						     $intMonedaID,
																						     $strSucursales, 
																						     $strModulos, 
																		 					 $intFormaPagoID);

					//Recorremos el arreglo para obtener la información de las formas de pago 
					foreach ($otdFormasPago as $arrFP)
					{
						//Inicializar variables
						$arrImporteFormaPago[$arrFP->forma_pago_id] = 0;
					}

					//VENTAS (FACTURAS) DE CONTADO
				    //Ventas de maquinaria
				    //Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
					//Si hay información de las ventas
					if($otdVentasMaquinaria)
					{
						//Variable que se utiliza para asignar el indice de la fila correspondiente al encabezado de ventas
						$intFilaVentas = $intFila;
						//Incrementar el indice para escribir los datos de la venta
						$intFila++;	

						//Recorremos el arreglo 
						foreach ($otdVentasMaquinaria as $arrVM)
						{
							//Asignar valores del registro
							$intImporte = $arrVM->importe;
							$intIva = $arrVM->iva;
							$intIeps = $arrVM->ieps;

						     //Agregar información de la venta
	            	   	     $objExcel->getActiveSheet()
				                	  ->setCellValue('A'.$intFila, $arrVM->concepto)
				                	  ->setCellValue('B'.$intFila, $arrVM->forma_pago)
				                	  ->setCellValue('C'.$intFila, $intImporte);


						   //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrVM->forma_pago_id] += $intTotal;

							//Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;
						}

						//Se agrega encabezado
				    	$objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFilaVentas, 'VENTAS DE CONTADO DE MAQUINARIA')
				    	     	 ->setCellValue('D'.$intFilaVentas, $intAcumTotal);

					    //Cambiar estilo de la celda
			            $objExcel->getActiveSheet()
			            		 ->getStyle('A'.$intFilaVentas.':'.'D'.$intFilaVentas)
			            		 ->applyFromArray($arrStyleBold);

			            //Acumulado del Subtotal
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'SUBTOTAL DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumSubtotal);

				        //Incrementar el indice para escribir el acumulado del IVA
					    $intFila++;    

			           	//Agregar información del acumulado del IVA
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IVA TRASLADADO DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIva);

				        //Incrementar el indice para escribir el acumulado del IEPS
					    $intFila++;    	 

					    //Agregar información del acumulado del IEPS
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IEPS TRASLADADO DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIeps);


				    	//Incrementar el indice para escribir los datos del siguiente registro
					    $intFila+=2;  

					    


					}//Cierre de verificación de ventas de maquinaria

				  	

					
				    //Ventas de refacciones
				    //Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
					//Si hay información de las ventas
					if($otdVentasRefacciones)
					{
						//Variable que se utiliza para asignar el indice de la fila correspondiente al encabezado de ventas
						$intFilaVentas = $intFila;
						//Incrementar el indice para escribir los datos de la venta
						$intFila++;	

						//Recorremos el arreglo 
						foreach ($otdVentasRefacciones as $arrVR)
						{
							//Asignar valores del registro
							$intImporte = $arrVR->importe;
							$intIva = $arrVR->iva;
							$intIeps = $arrVR->ieps;

						     //Agregar información de la venta
	            	   	     $objExcel->getActiveSheet()
				                	  ->setCellValue('A'.$intFila, $arrVR->concepto)
				                	  ->setCellValue('B'.$intFila, $arrVR->forma_pago)
				                	  ->setCellValue('C'.$intFila, $intImporte);


						   //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrVR->forma_pago_id] += $intTotal;

							//Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;
						}


						//Se agrega encabezado
				    	$objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFilaVentas, 'VENTAS DE CONTADO DE REFACCIONES')
				    	     	 ->setCellValue('D'.$intFilaVentas, $intAcumTotal);

					    //Cambiar estilo de la celda
			            $objExcel->getActiveSheet()
			            		 ->getStyle('A'.$intFilaVentas.':'.'D'.$intFilaVentas)
			            		 ->applyFromArray($arrStyleBold);

			           //Acumulado del Subtotal
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'SUBTOTAL DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumSubtotal);

				        //Incrementar el indice para escribir el acumulado del IVA
					    $intFila++;    



			           	//Agregar información del acumulado del IVA
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IVA TRASLADADO DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIva);

				        //Incrementar el indice para escribir el acumulado del IEPS
					    $intFila++;    	 

					    //Agregar información del acumulado del IEPS
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IEPS TRASLADADO DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIeps);


				    	//Incrementar el indice para escribir los datos del siguiente registro
					    $intFila+=2;   


					}//Cierre de verificación de ventas de refacciones

				  	

				    
				    //Ventas de servicio
				    //Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;

					//Si hay información de las ventas
					if($otdVentasServicio)
					{
						//Variable que se utiliza para asignar el indice de la fila correspondiente al encabezado de ventas
						$intFilaVentas = $intFila;
						//Incrementar el indice para escribir los datos de la venta
						$intFila++;	

						//Recorremos el arreglo 
						foreach ($otdVentasServicio as $arrVS)
						{
							//Asignar valores del registro
							$intImporte = $arrVS->importe;
							$intIva = $arrVS->iva;
							$intIeps = $arrVS->ieps;

						     //Agregar información de la venta
	            	   	     $objExcel->getActiveSheet()
				                	  ->setCellValue('A'.$intFila, $arrVS->concepto)
				                	  ->setCellValue('B'.$intFila, $arrVS->forma_pago)
				                	  ->setCellValue('C'.$intFila, $intImporte);


						   //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrVS->forma_pago_id] += $intTotal;

							//Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;
						}

						//Se agrega encabezado
				    	$objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFilaVentas, 'VENTAS DE CONTADO DE SERVICIO')
				    	     	 ->setCellValue('D'.$intFilaVentas, $intAcumTotal);

					    //Cambiar estilo de la celda
			            $objExcel->getActiveSheet()
			            		 ->getStyle('A'.$intFilaVentas.':'.'D'.$intFilaVentas)
			            		 ->applyFromArray($arrStyleBold);


			            //Acumulado del Subtotal
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'SUBTOTAL DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumSubtotal);

				        //Incrementar el indice para escribir el acumulado del IVA
					    $intFila++; 

			           	//Agregar información del acumulado del IVA
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IVA TRASLADADO DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIva);

				        //Incrementar el indice para escribir el acumulado del IEPS
					    $intFila++;    	 

					    //Agregar información del acumulado del IEPS
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IEPS TRASLADADO DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIeps);


				    	//Incrementar el indice para escribir los datos del siguiente registro
					    $intFila+=2;   


					}//Cierre de verificación de ventas de servicio



					//Ventas de conceptos
				    //Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;

					//Si hay información de las ventas 
					if($otdVentasConceptos)
					{
						//Variable que se utiliza para asignar el indice de la fila correspondiente al encabezado de ventas
						$intFilaVentas = $intFila;
						//Incrementar el indice para escribir los datos de la venta
						$intFila++;	

						//Recorremos el arreglo 
						foreach ($otdVentasConceptos as $arrVC)
						{
							//Asignar valores del registro
							$intImporte = $arrVC->importe;
							$intIva = $arrVC->iva;
							$intIeps = $arrVC->ieps;

						     //Agregar información de la venta
	            	   	     $objExcel->getActiveSheet()
				                	  ->setCellValue('A'.$intFila, $arrVC->concepto)
				                	  ->setCellValue('B'.$intFila, $arrVC->forma_pago)
				                	  ->setCellValue('C'.$intFila, $intImporte);


						   //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrVC->forma_pago_id] += $intTotal;

							//Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;
						}

						//Se agrega encabezado
				    	$objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFilaVentas, 'VENTAS DE CONTADO DE CONCEPTOS')
				    	     	 ->setCellValue('D'.$intFilaVentas, $intAcumTotal);

					    //Cambiar estilo de la celda
			            $objExcel->getActiveSheet()
			            		 ->getStyle('A'.$intFilaVentas.':'.'D'.$intFilaVentas)
			            		 ->applyFromArray($arrStyleBold);


			            //Acumulado del Subtotal
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'SUBTOTAL DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumSubtotal);

				        //Incrementar el indice para escribir el acumulado del IVA
					    $intFila++; 

			           	//Agregar información del acumulado del IVA
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IVA TRASLADADO DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIva);

				        //Incrementar el indice para escribir el acumulado del IEPS
					    $intFila++;    	 

					    //Agregar información del acumulado del IEPS
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IEPS TRASLADADO DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIeps);


				    	//Incrementar el indice para escribir los datos del siguiente registro
					    $intFila+=2;   


					}//Cierre de verificación de ventas de conceptos


				  	

				    //PAGOS DE VENTAS (FACTURAS)
				    //Pagos de maquinaria
				    //Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
					//Si hay información de los pagos
					if($otdPagosMaquinaria)
					{

						//Variable que se utiliza para asignar el indice de la fila correspondiente al encabezado de pagos
						$intFilaPagos = $intFila;
						//Incrementar el indice para escribir los datos del pago
						$intFila++;	


						//Recorremos el arreglo 
						foreach ($otdPagosMaquinaria as $arrPM)
						{
							//Asignar valores del registro
							$intImporte = $arrPM->importe;
							$intIva = $arrPM->iva;
							$intIeps = $arrPM->ieps;

						    //Agregar información del pago
	            	   	    $objExcel->getActiveSheet()
				                	 ->setCellValue('A'.$intFila, $arrPM->concepto)
				                	 ->setCellValue('B'.$intFila, $arrPM->forma_pago)
				                	 ->setCellValue('C'.$intFila, $intImporte);


						   //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrPM->forma_pago_id] += $intTotal;

							//Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;
						}

						//Se agrega encabezado
				    	$objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFilaPagos, 'PAGOS DE VENTA A CRÉDITO DE MAQUINARIA')
				    	     	 ->setCellValue('D'.$intFilaPagos, $intAcumTotal);

					    //Cambiar estilo de la celda
			            $objExcel->getActiveSheet()
			            		 ->getStyle('A'.$intFilaPagos.':'.'D'.$intFilaPagos)
			            		 ->applyFromArray($arrStyleBold);

			            //Acumulado del Subtotal
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'SUBTOTAL DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumSubtotal);

				        //Incrementar el indice para escribir el acumulado del IVA
					    $intFila++; 

			           	//Agregar información del acumulado del IVA
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IVA TRASLADADO DE CRÉDITO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIva);

				        //Incrementar el indice para escribir el acumulado del IEPS
					    $intFila++;    	 

					    //Agregar información del acumulado del IEPS
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IEPS TRASLADADO DE CRÉDITO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIeps);


				    	//Incrementar el indice para escribir los datos del siguiente registro
					    $intFila+=2;  


					}//Cierre de verificación de pagos de maquinaria

				  	

				    
				    //Pagos de refacciones
				    //Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
					//Si hay información de los pagos
					if($otdPagosRefacciones)
					{

						//Variable que se utiliza para asignar el indice de la fila correspondiente al encabezado de pagos
						$intFilaPagos = $intFila;
						//Incrementar el indice para escribir los datos del pago
						$intFila++;	

						//Recorremos el arreglo 
						foreach ($otdPagosRefacciones as $arrPR)
						{
							//Asignar valores del registro
							$intImporte = $arrPR->importe;
							$intIva = $arrPR->iva;
							$intIeps = $arrPR->ieps;

						    //Agregar información del pago
	            	   	    $objExcel->getActiveSheet()
				                	 ->setCellValue('A'.$intFila, $arrPR->concepto)
				                	 ->setCellValue('B'.$intFila, $arrPR->forma_pago)
				                	 ->setCellValue('C'.$intFila, $intImporte);


						    //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrPR->forma_pago_id] += $intTotal;

							//Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;
						}


						//Se agrega encabezado
				    	$objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFilaPagos, 'PAGOS DE VENTA A CRÉDITO DE REFACCIONES')
				    	     	 ->setCellValue('D'.$intFilaPagos, $intAcumTotal);

					    //Cambiar estilo de la celda
			            $objExcel->getActiveSheet()
			            		 ->getStyle('A'.$intFilaPagos.':'.'D'.$intFilaPagos)
			            		 ->applyFromArray($arrStyleBold);

			            //Acumulado del Subtotal
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'SUBTOTAL DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumSubtotal);

				        //Incrementar el indice para escribir el acumulado del IVA
					    $intFila++; 

			           	//Agregar información del acumulado del IVA
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IVA TRASLADADO DE CRÉDITO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIva);

				        //Incrementar el indice para escribir el acumulado del IEPS
					    $intFila++;    	 

					    //Agregar información del acumulado del IEPS
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IEPS TRASLADADO DE CRÉDITO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIeps);


				    	//Incrementar el indice para escribir los datos del siguiente registro
					    $intFila+=2;  

					}//Cierre de verificación de pagos de refacciones

				  	

				  
				    //Pagos de servicio
				    //Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
					//Si hay información de los pagos
					if($otdPagosServicio)
					{
						
						//Variable que se utiliza para asignar el indice de la fila correspondiente al encabezado de pagos
						$intFilaPagos = $intFila;
						//Incrementar el indice para escribir los datos del pago
						$intFila++;	

						//Recorremos el arreglo 
						foreach ($otdPagosServicio as $arrPS)
						{
							//Asignar valores del registro
							$intImporte = $arrPS->importe;
							$intIva = $arrPS->iva;
							$intIeps = $arrPS->ieps;

						    //Agregar información del pago
	            	   	    $objExcel->getActiveSheet()
				                	 ->setCellValue('A'.$intFila, $arrPS->concepto)
				                	 ->setCellValue('B'.$intFila, $arrPS->forma_pago)
				                	 ->setCellValue('C'.$intFila, $intImporte);


						    //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrPR->forma_pago_id] += $intTotal;

							//Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;
						}


						//Se agrega encabezado
				    	$objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFilaPagos, 'PAGOS DE VENTA A CRÉDITO DE SERVICIO')
				    	     	 ->setCellValue('D'.$intFilaPagos, $intAcumTotal);

					    //Cambiar estilo de la celda
			            $objExcel->getActiveSheet()
			            		 ->getStyle('A'.$intFilaPagos.':'.'D'.$intFilaPagos)
			            		 ->applyFromArray($arrStyleBold);

			             //Acumulado del Subtotal
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'SUBTOTAL DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumSubtotal);

				        //Incrementar el indice para escribir el acumulado del IVA
					    $intFila++; 

			           	//Agregar información del acumulado del IVA
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IVA TRASLADADO DE CRÉDITO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIva);

				        //Incrementar el indice para escribir el acumulado del IEPS
					    $intFila++;    	 

					    //Agregar información del acumulado del IEPS
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IEPS TRASLADADO DE CRÉDITO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIeps);


				    	//Incrementar el indice para escribir los datos del siguiente registro
					    $intFila+=2;

					}//Cierre de verificación de pagos de servicio


					//Pagos de conceptos
				    //Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
					//Si hay información de los pagos
					if($otdPagosConceptos)
					{
						
						//Variable que se utiliza para asignar el indice de la fila correspondiente al encabezado de pagos
						$intFilaPagos = $intFila;
						//Incrementar el indice para escribir los datos del pago
						$intFila++;	

						//Recorremos el arreglo 
						foreach ($otdPagosConceptos as $arrPC)
						{
							//Asignar valores del registro
							$intImporte = $arrPC->importe;
							$intIva = $arrPC->iva;
							$intIeps = $arrPC->ieps;

						    //Agregar información del pago
	            	   	    $objExcel->getActiveSheet()
				                	 ->setCellValue('A'.$intFila, $arrPC->concepto)
				                	 ->setCellValue('B'.$intFila, $arrPC->forma_pago)
				                	 ->setCellValue('C'.$intFila, $intImporte);


						    //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrPC->forma_pago_id] += $intTotal;

							//Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;
						}


						//Se agrega encabezado
				    	$objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFilaPagos, 'PAGOS DE VENTA A CRÉDITO DE CONCEPTOS')
				    	     	 ->setCellValue('D'.$intFilaPagos, $intAcumTotal);

					    //Cambiar estilo de la celda
			            $objExcel->getActiveSheet()
			            		 ->getStyle('A'.$intFilaPagos.':'.'D'.$intFilaPagos)
			            		 ->applyFromArray($arrStyleBold);

			            //Acumulado del Subtotal
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'SUBTOTAL DE CONTADO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumSubtotal);

				        //Incrementar el indice para escribir el acumulado del IVA
					    $intFila++; 

			           	//Agregar información del acumulado del IVA
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IVA TRASLADADO DE CRÉDITO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIva);

				        //Incrementar el indice para escribir el acumulado del IEPS
					    $intFila++;    	 

					    //Agregar información del acumulado del IEPS
			            $objExcel->getActiveSheet()
				    			 ->setCellValue('A'.$intFila, 'IEPS TRASLADADO DE CRÉDITO')
				    	     	 ->setCellValue('D'.$intFila, $intAcumIeps);


				    	//Incrementar el indice para escribir los datos del siguiente registro
					    $intFila+=2;

					}//Cierre de verificación de pagos de conceptos



					//Pagos de cartera
					//Variable que se utiliza para asignar el indice de la fila correspondiente al encabezado de pagos
						$intFilaPagos = $intFila;
						//Incrementar el indice para escribir los datos del pago
						$intFila++;	
				    //Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
					//Si hay información de los pagos
					if($otdPagosCartera)
					{

						//Recorremos el arreglo 
						foreach ($otdPagosCartera as $arrPC)
						{
							//Asignar valores del registro
							$intImporte = $arrPC->importe;
							$intIva = $arrPC->iva;
							$intIeps = $arrPC->ieps;

						    //Agregar información del pago
	            	   	    $objExcel->getActiveSheet()
				                	 ->setCellValue('A'.$intFila, $arrPC->concepto)
				                	 ->setCellValue('B'.$intFila, $arrPC->forma_pago)
				                	 ->setCellValue('C'.$intFila, $intImporte);


						    //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrPC->forma_pago_id] += $intTotal;

							//Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;
						}


					}//Cierre de verificación de pagos de cartera

					//Se agrega encabezado
			    	$objExcel->getActiveSheet()
			    			 ->setCellValue('A'.$intFilaPagos, 'PAGOS DE CARTERA VENCIDA')
			    	     	 ->setCellValue('D'.$intFilaPagos, $intAcumTotal);

				    //Cambiar estilo de la celda
		            $objExcel->getActiveSheet()
		            		 ->getStyle('A'.$intFilaPagos.':'.'D'.$intFilaPagos)
		            		 ->applyFromArray($arrStyleBold);

		            //Acumulado del Subtotal
		            $objExcel->getActiveSheet()
			    			 ->setCellValue('A'.$intFila, 'SUBTOTAL DE CONTADO')
			    	     	 ->setCellValue('D'.$intFila, $intAcumSubtotal);

			        //Incrementar el indice para escribir el acumulado del IVA
				    $intFila++; 

		           	//Agregar información del acumulado del IVA
		            $objExcel->getActiveSheet()
			    			 ->setCellValue('A'.$intFila, 'IVA TRASLADADO DE CRÉDITO')
			    	     	 ->setCellValue('D'.$intFila, $intAcumIva);

			        //Incrementar el indice para escribir el acumulado del IEPS
				    $intFila++;    	 

				    //Agregar información del acumulado del IEPS
		            $objExcel->getActiveSheet()
			    			 ->setCellValue('A'.$intFila, 'IEPS TRASLADADO DE CRÉDITO')
			    	     	 ->setCellValue('D'.$intFila, $intAcumIeps);


			    	//Incrementar el indice para escribir los datos del siguiente registro
				    $intFila+=2;

				  	

				    //ANTICIPOS DE CLIENTES
				    //Variable que se utiliza para asignar el indice de la fila correspondiente al encabezado de anticipos
					$intFilaAnticipos = $intFila;
					//Incrementar el indice para escribir los datos del anticipo
					$intFila++;	
				    //Inicializar variables
				    $intAcumIva = 0;
				    $intAcumIeps = 0;
				    $intAcumSubtotal = 0;
				    $intAcumTotal = 0;
					//Si hay información de los anticipos
					if($otdAnticipos)
					{
						

						//Recorremos el arreglo 
						foreach ($otdAnticipos as $arrA)
						{
							//Asignar valores del registro
							$intImporte = $arrA->importe;
							$intIva = $arrA->iva;
							$intIeps = $arrA->ieps;

						     //Agregar información del anticipo
	            	   	     $objExcel->getActiveSheet()
				                	  ->setCellValue('A'.$intFila, $arrA->concepto)
				                	  ->setCellValue('B'.$intFila, $arrA->forma_pago)
				                	  ->setCellValue('C'.$intFila, $intImporte);


						    //Calcular importe total
						    $intTotal = $intImporte + $intIva + $intIeps;

						    //Incrementar acumulados
						    $intAcumIva +=  $intIva;
						    $intAcumIeps += $intIeps;
						    $intAcumSubtotal += $intImporte;
						    $intAcumTotal += $intTotal;

						    //Incrementar valores del array
							$arrImporteFormaPago[$arrA->forma_pago_id] += $intTotal;

							//Incrementar el indice para escribir los datos del siguiente registro
							$intFila++;
						}

					}//Cierre de verificación de anticipos
							
					//Se agrega encabezado
			    	$objExcel->getActiveSheet()
			    			 ->setCellValue('A'.$intFilaAnticipos, 'ANTICIPOS DE CLIENTES')
			    	     	 ->setCellValue('D'.$intFilaAnticipos, $intAcumTotal);

				    //Cambiar estilo de la celda
		            $objExcel->getActiveSheet()
		            		 ->getStyle('A'.$intFilaAnticipos.':'.'D'.$intFilaAnticipos)
		            		 ->applyFromArray($arrStyleBold);

	               //Acumulado del Subtotal
		            $objExcel->getActiveSheet()
			    			 ->setCellValue('A'.$intFila, 'SUBTOTAL DE CONTADO')
			    	     	 ->setCellValue('D'.$intFila, $intAcumSubtotal);

			        //Incrementar el indice para escribir el acumulado del IVA
				    $intFila++; 



		           	//Agregar información del acumulado del IVA
		            $objExcel->getActiveSheet()
			    			 ->setCellValue('A'.$intFila, 'IVA TRASLADADO')
			    	     	 ->setCellValue('D'.$intFila, $intAcumIva);

			        //Incrementar el indice para escribir el acumulado del IEPS
				    $intFila++;    	 

				    //Agregar información del acumulado del IEPS
		            $objExcel->getActiveSheet()
			    			 ->setCellValue('A'.$intFila, 'IEPS TRASLADADO')
			    	     	 ->setCellValue('D'.$intFila, $intAcumIeps);


	    	
					//Incrementar el indice para escribir los datos del siguiente registro
		    		$intFila+=2;  


				    //------------------------------------------------------------------------------------------------------------------------
			        //---------- RESUMEN
			        //------------------------------------------------------------------------------------------------------------------------
					//Variable que se utiliza para asignar acumulado total de ingresos
					$intAcumTotal = 0;
					//Recorremos el arreglo para obtener la información de las formas de pago 
					foreach ($otdFormasPago as $arrFP)
					{
						//Asignar el acumulado del importe (por cada forma de pago recorrida)
						$intAcumFormaPago = $arrImporteFormaPago[$arrFP->forma_pago_id];

						//Agregar información de la forma de pago
	            	   	$objExcel->getActiveSheet()
				               	 ->setCellValue('B'.$intFila, $arrFP->forma_pago)
				                 ->setCellValue('C'.$intFila, $intAcumFormaPago);

						//Incrementar acumulado total de ingresos
						$intAcumTotal += $intAcumFormaPago;
						//Incrementar el indice para escribir los datos del siguiente registro
						$intFila++;
					}

					//Agregar información del total de ingresos
		            $objExcel->getActiveSheet()
			    			 ->setCellValue('B'.$intFila, 'TOTAL')
			    	     	 ->setCellValue('C'.$intFila, $intAcumTotal);

			    	//Cambiar estilo de la celda
		            $objExcel->getActiveSheet()
		            		 ->getStyle('B'.$intFila.':'.'C'.$intFila)
		            		 ->applyFromArray($arrStyleBold);


			        //Cambiar contenido de las celdas a formato moneda
		            $objExcel->getActiveSheet()
		            		 ->getStyle('C'.$intFilaInicial.':'.'D'.$intFila)
		            		 ->getNumberFormat()
		            		 ->setFormatCode('$#,##0.00');

		            //Cambiar alineación de las siguientes celdas
		            $objExcel->getActiveSheet()
			        	     ->getStyle('B'.$intFila)
			        	     ->getAlignment()
			        	     ->applyFromArray($arrStyleAlignmentRight);

	                $objExcel->getActiveSheet()
			        	     ->getStyle('C'.$intFilaInicial.':'.'D'.$intFila)
			        	     ->getAlignment()
			        	     ->applyFromArray($arrStyleAlignmentRight);

				}//Cierre de verificación de información de ventas, pagos y/o anticipos

			}

		}//Cierre de verificación de monedas

        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'ingresos_dia.xls', 'ingresos', $intFila);
    }
}