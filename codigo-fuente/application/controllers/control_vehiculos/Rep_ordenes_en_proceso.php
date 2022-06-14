<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_ordenes_en_proceso extends MY_Controller {

	//Variable para identificar el tipo de movimiento
	var $intTipoMovimiento = SALIDA_REFACCIONES_INTERNAS;
	var $intTipoMovimientoDev = ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER; 

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('control_vehiculos/rep_ordenes_en_proceso_model', 'rep_ordenes');
		$this->load->model('administracion/empresas_model', 'empresas');
		$this->load->model('administracion/sucursales_model', 'sucursales');

		//Cargamos el modelo de ordenes de reparación internas
		$this->load->model('control_vehiculos/ordenes_reparacion_internas_model', 'ordenes');
		//Cargamos el modelo de vehículos
		$this->load->model('control_vehiculos/vehiculos_model', 'vehiculos');
		//Cargamos el modelo de movimientos de refacciones internas
		$this->load->model('control_vehiculos/movimientos_refacciones_internas_model', 'movimientos');
		//Cargamos el modelo de trabajos foráneos internos
		$this->load->model('control_vehiculos/trabajos_foraneos_internos_model', 'trabajos');

	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('control_vehiculos/rep_ordenes_en_proceso', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($dteFechaCorte, $intSucursalID, $intVehiculoID, $intMecanicoID) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Array que se utiliza para agregar los datos de un detalle
		$arrAuxiliar = array();
		//Variable que se utiliza para asignar título de la fecha
		$strTituloFecha = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;

		//Seleccionar los datos del registro que coincide con la fecha
		$otdResultado = $this->rep_ordenes->consultar($dteFechaCorte, $intSucursalID, $intVehiculoID, $intMecanicoID);

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFecha = $this->get_fecha_formato_letra($dteFechaCorte, 'C');
		
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  'LISTADO DE ORDENES DE TRABAJO INTERNAS EN PROCESO HASTA EL: '.$strTituloFecha;
		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('FOLIO'), utf8_decode('CÓDIGO'), utf8_decode('VEHÍCULO'), 
								  'PLACAS', 'FECHA');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(25, 50, 55, 30, 30);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L', 'C');
		//Establece la alineación de las celdas de la tabla salidas de refacciones
		$arrAnchuraSalidasRefacciones = array(25, 50, 55, 30, 30);
		//Establece la alineación de las celdas de la tabla salidas de refacciones
		$arrAlineacionSalidasRefacciones = array('L', 'L', 'C', 'R', 'L');
		//Establece la alineación de las celdas de la tabla trabajos foráneos
		$arrAnchuraTrabajosForaneos = array(25, 50, 55, 30, 30);
		//Establece la alineación de las celdas de la tabla salidas de refacciones
		$arrAlineacionTrabajosForaneos = array('L', 'L', 'C', 'R', 'L');
		//Establece la alineación de las celdas de la tabla servicios
		$arrAnchuraServicios = array(25, 50, 55, 30, 30);
		//Establece la alineación de las celdas de la tabla servicios
		$arrAlineacionServicios = array('L', 'L', 'C', 'R', 'L');
		//Agregar la primer pagina
		$pdf->AddPage();
		
		//Si hay información
		if ($otdResultado)
		{
			//Variable que se utiliza para el acumulado general en importe de refacciones
		    $intAcumRefaccionesGlobal = 0;
			//Variable que se utiliza para el acumulado general en importe de trabajos foraneos
		    $intAcumTrabajosForaneosGlobal = 0;
		    //Variable que se utiliza para el acumulado general en horas de mano de obra
		    $intAcumManoObraGlobal = 0;

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdResultado as $arrCol)
			{
				//Variable que se utiliza para el acumulado en importe de refacciones por registro
			    $intAcumRefaccionesReg = 0;
				//Variable que se utiliza para el acumulado en importe de trabajos foraneos por registro
			    $intAcumTrabajosForaneosReg = 0;
			    //Variable que se utiliza para el acumulado en horas de mano de obra  por registro
			    $intAcumManoObraReg = 0;

				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);

				//Seleccionar los servicios del registro
				$otdServicios = $this->ordenes->buscar_servicios($arrCol->orden_reparacion_interna_id);
				//Seleccionar los trabajos foráneos del registro
				$otdTrabajosForaneos = $this->trabajos->buscar_detalles(NULL, $arrCol->orden_reparacion_interna_id, $arrCol->orden_reparacion_interna_id);
				//Seleccionar las salidas de refacciones del registro
				$otdSalidasRefacciones = $this->movimientos->buscar_salidas($this->intTipoMovimiento, $arrCol->orden_reparacion_interna_id);

				//Impresión de variables
				$pdf->Row(array($arrCol->folio, utf8_decode($arrCol->codigo), utf8_decode($arrCol->vehiculo), 
							    $arrCol->placas, $arrCol->fecha), 
						   $pdf->arrAlineacion, 'ClippedCell');

				$pdf->ClippedCell(180, 4, 'FALLA: '.utf8_decode($arrCol->falla), 0, 0, 'L', 0);$pdf->Ln();
				$pdf->ClippedCell(180, 4, utf8_decode('CAUSA: ').utf8_decode($arrCol->causa), 0, 0, 'L', 0);$pdf->Ln();
				

				//Verificar si existe información de las salidas de refacciones
				if($otdSalidasRefacciones)
				{
					
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraSalidasRefacciones);

					//Recorremos el arreglo 
			        foreach ($otdSalidasRefacciones as $arrSal) 
			        {
			        	
			        	$intMovimientoRefaccionesInternasID = $arrSal->movimiento_refacciones_internas_id;
			    		$intOrdenReparacionInternaID = $arrSal->orden_reparacion_interna_id;
			    		$salidas_devoluciones = $this->movimientos->buscar_salidas_con_devoluciones($this->intTipoMovimiento, $this->intTipoMovimientoDev, $intMovimientoRefaccionesInternasID, $intOrdenReparacionInternaID);
		  		
			    		//En caso de que una salida tenga devoluciones
			    		if($salidas_devoluciones){

			    			foreach($salidas_devoluciones as $arrDet2){

			    				//Si el estatus del registro es ACTIVO
								if($arrDet2->estatus == 'ACTIVO')
								{
									//$pdf->SetX(15);
									//Variables que se utilizan para asignar valores del detalle
									$intCantidad = $arrDet2->cantidad;
									$intPrecioUnitario = $arrDet2->precio_unitario;
									//Calcular subtotal
					            	$intSubTotalUnitario =  $intCantidad * $intPrecioUnitario;

									//Verificamos si el movimiento efectuado fué de SALIDA(+) ó DEVOLUCIÓN(-)
									if($arrDet2->tipo == 'SALIDA'){ //Importe $0.00
										
										$pdf->Row(array($arrDet2->folio, 'REFACCIONES', $arrDet2->fecha, 
														'$'.number_format($intSubTotalUnitario, 2), ''),
								    				$arrAlineacionSalidasRefacciones, 'ClippedCell');

										$intAcumRefaccionesReg += $intSubTotalUnitario;

									}
									else{ // Importe $-0.00
										
										$pdf->Row(array($arrDet2->folio, 'REFACCIONES', $arrDet2->fecha, 
														'$-'.number_format($intSubTotalUnitario, 2), ''),
								    			  $arrAlineacionSalidasRefacciones, 'ClippedCell');

										$intAcumRefaccionesReg -= $intSubTotalUnitario;

									} 								    
								    
					            }
					        }
					    } 
					}
				}//Cierre de verificación de salidas de refacciones
				
				
				//Verificar si existe información de los trabajos foráneos 
				if($otdTrabajosForaneos)
				{
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraTrabajosForaneos);

					//Recorremos el arreglo 
			        foreach ($otdTrabajosForaneos as $arrTrab) 
			        {
			        	//Variables que se utilizan para asignar valores del detalle
						$intCantidad = $arrTrab->cantidad;
						//Convertir peso mexicano a tipo de cambio
						$intPrecioUnitario = ($arrTrab->precio_unitario / $arrTrab->tipo_cambio);
						$intIvaUnitario = ($arrTrab->iva_unitario / $arrTrab->tipo_cambio);
						$intIepsUnitario = ($arrTrab->ieps_unitario / $arrTrab->tipo_cambio);
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
						$intSubTotalUnitario = $intCantidad * $intPrecioUnitario;

					    $pdf->Row(array($arrTrab->folio, 'TRABAJOS FORANEOS', 
					    				$arrTrab->fecha, '$'.number_format($intSubTotalUnitario, 2), ''),  
					    				$arrAlineacionTrabajosForaneos, 'ClippedCell');	

					    $intAcumTrabajosForaneosReg += $intSubTotalUnitario;							

					}
					
				}//Cierre de verificación de trabajos foráneos

				
				//Verificar si existe información de los servicios 
				if($otdServicios)
				{
					
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraServicios);
					
					//Recorremos el arreglo 
			        foreach ($otdServicios as $arrSer) 
			        {	
			        	
			        	//$pdf->SetX(0);
					    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array(utf8_decode($arrSer->codigo), 'MANO DE OBRA', '', 
					    				number_format($arrSer->horas, 2), ''), 
					               $arrAlineacionServicios, 'ClippedCell'); 

					    $intAcumManoObraReg += $arrSer->horas;
	                        
					}
				}//Cierre de verificación de servicios
		

				//Agregamos el SUBTOTAL correspondiente a cada registro
				$subtotal = $intAcumRefaccionesReg + $intAcumTrabajosForaneosReg;
				
				//Se agrega la informacion al reporte
				$pdf->SetWidths($arrAnchuraServicios);
				$pdf->Row(array('', '', 'SUBTOTAL:     ', '$'.number_format($subtotal, 2), ''), 
					      $arrAlineacionServicios, 'ClippedCell'); 

				$pdf->Ln();$pdf->Ln();

				//Sección de acumulación de totales globales
				$intAcumRefaccionesGlobal += $intAcumRefaccionesReg;
				$intAcumTrabajosForaneosGlobal += $intAcumTrabajosForaneosReg;
				$intAcumManoObraGlobal += $intAcumManoObraReg;
		
			}


			//------------------------------------------------------------------------------------------------------------------------
	        //---------- RESUMEN
	        //------------------------------------------------------------------------------------------------------------------------
			//Establece el ancho de las columnas de cabecera
			$arrAnchuraResumen = array(50, 50);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacionResumen = array('L', 'R');
			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Creación de la tabla Resumen
			$pdf->Cell(100, 4, 'RESUMEN GENERAL', 0, 0, 'C', TRUE);
			$pdf->Ln(4);//Deja un salto de linea
			//Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchuraResumen);
			
			//Agregamos la información de los totales
			$pdf->Row(array('TOTAL DE REFACCIONES: ', '$'.number_format($intAcumRefaccionesGlobal, 2)), 
					   $arrAlineacionResumen, 'ClippedCell'); 

			$pdf->Row(array('TOTAL DE TRABAJOS FORANEOS: ', '$'.number_format($intAcumTrabajosForaneosGlobal, 2)), 
					        $arrAlineacionResumen, 'ClippedCell'); 

			$pdf->Row(array('TOTAL DE MANO DE OBRA: ', number_format($intAcumManoObraGlobal, 2)), 
					    	$arrAlineacionResumen, 'ClippedCell'); 
			
		}
		
		//Ejecutar la salida del reporte
		$pdf->Output('reporte_ordenes_en_proceso.pdf','I');	            
		
	}


}	