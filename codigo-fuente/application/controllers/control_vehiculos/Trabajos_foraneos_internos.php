<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trabajos_foraneos_internos extends MY_Controller {
	
	//Información que se utiliza para asignar el número de decimales a redondear
	var $intNumDecimales = NUM_DECIMALES_MOSTRAR_SERVICIO;
	//Información que se utiliza para asignar el número de decimales a redondear de la cantidad
	var $intNumDecimalesCantidad = NUM_DECIMALES_CANTIDAD_TF_SERVICIO;
	//Información que se utiliza para asignar el número de decimales a redondear del costo unitario
	var $intNumDecimalesCostoUnitario = NUM_DECIMALES_COSTO_UNIT_TF_SERVICIO;
	
	
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de trabajos foráneos internos
		$this->load->model('control_vehiculos/trabajos_foraneos_internos_model', 'trabajos');
		//Cargamos el modelo de pagos a proveedores (para saber si la orden de compra tiene pagos y/o descuentos)
		$this->load->model('cuentas_pagar/pagos_proveedores_model', 'pagos');
		//Cargamos el modelo de proveedores
		$this->load->model('cuentas_pagar/proveedores_model', 'proveedores');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('control_vehiculos/trabajos_foraneos_internos', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->trabajos->filtro($this->input->post('dteFechaInicial'),
										  $this->input->post('dteFechaFinal'),
										  $this->input->post('intProveedorID'),
										  trim($this->input->post('strEstatus')),
										  trim($this->input->post('strBusqueda')),
			                              $config['per_page'],
			                              $config['cur_page']);	
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Variable que se utiliza para asignar la fecha actual 
		$dteFechaCorte = date("Y-m-d");

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['trabajos'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			$arrDet->mostrarAccionGenerarPoliza = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;
           
			//Si el estatus del registro es ACTIVO
			if($arrDet->estatus == 'ACTIVO')
			{
				//Seleccionar los abonos del trabajo foráneo (primer posición del arreglo)
				$otdPagos = $this->pagos->buscar_ordenes_compra_importes(NULL, $dteFechaCorte, NULL, NULL,
																		 $arrDet->trabajo_foraneo_interno_id, 
																	     'SERVICIO INTERNO')[0];
				//Si el registro cuenta con descuentos y/o pagos a proveedor
				if($otdPagos->abonos > 0)
				{
					//Si el usuario cuenta con el permiso de acceso VER REGISTRO
					if (in_array('VER REGISTRO', $arrPermisos))
					{
						//Asignar cadena vacia para mostrar botón Ver registro
		        		$arrDet->mostrarAccionVerRegistro = '';	
					}

				}
				else
				{
					//Si no existe id de la póliza
					if($arrDet->poliza_id == 0)
					{
						//Si el usuario cuenta con el permiso de acceso EDITAR
						if (in_array('EDITAR', $arrPermisos))
						{
							//Asignar cadena vacia para mostrar botón Editar
							$arrDet->mostrarAccionEditar = '';
						}

						//Asignar cadena vacia para mostrar botón Generar póliza
	    				$arrDet->mostrarAccionGenerarPoliza = '';
					}
					else
					{

						//Si el usuario cuenta con el permiso de acceso VER REGISTRO
						if (in_array('VER REGISTRO', $arrPermisos))
						{
							//Asignar cadena vacia para mostrar botón Ver registro
			        		$arrDet->mostrarAccionVerRegistro = '';	
						}

						//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
						if (in_array('CAMBIAR ESTATUS', $arrPermisos))
						{
							//Asignar cadena vacia para mostrar botón Desactivar
							$arrDet->mostrarAccionDesactivar = '';
						}
					}
					
				}
			}
			else
			{
				//Si el usuario cuenta con el permiso de acceso VER REGISTRO
				if (in_array('VER REGISTRO', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Ver registro
	        		$arrDet->mostrarAccionVerRegistro = '';	
				}
				
			}

			//Si el usuario cuenta con el permiso de acceso IMPRIMIR REGISTRO
			if (in_array('IMPRIMIR REGISTRO', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón Imprimir
        		$arrDet->mostrarAccionImprimir = '';
			}

			

		}

		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['trabajos'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows']);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para guardar o modificar los datos de un registro
	public function guardar()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objTrabajoForaneo = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Datos del trabajo foráneo
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objTrabajoForaneo->intTrabajoForaneoInternoID = $this->input->post('intTrabajoForaneoInternoID');
		$objTrabajoForaneo->dteFecha = $this->input->post('dteFecha');
		$objTrabajoForaneo->intMonedaID = $this->input->post('intMonedaID');
		$objTrabajoForaneo->intTipoCambio = $this->input->post('intTipoCambio');
		$objTrabajoForaneo->strFactura = mb_strtoupper(trim($this->input->post('strFactura')));
		$objTrabajoForaneo->intOrdenCompraID = $this->input->post('intOrdenCompraID');
		//Si no existe id del régimen fiscal asignar valor nulo
		$objTrabajoForaneo->intRegimenFiscalID = (($this->input->post('intRegimenFiscalID') !== '') ? 
										         $this->input->post('intRegimenFiscalID') : NULL);

		//Si no existe id del porcentaje de retención ISR asignar valor nulo
		$objTrabajoForaneo->intPorcentajeRetencionID = (($this->input->post('intPorcentajeRetencionID') !== '') ? 
										              $this->input->post('intPorcentajeRetencionID') : NULL);

		//Si no existe importe retenido de ISR asignar valor nulo
		$objTrabajoForaneo->intImporteRetenido = (($this->input->post('intImporteRetenido') !== '') ? 
										           $this->input->post('intImporteRetenido') : NULL);
		$objTrabajoForaneo->intOrdenReparacionInternaID = $this->input->post('intOrdenReparacionInternaID');
		$objTrabajoForaneo->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objTrabajoForaneo->intSucursalID = $this->session->userdata('sucursal_id');
		$objTrabajoForaneo->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los detalles
		$objTrabajoForaneo->strConceptos = $this->input->post('strConceptos');
		$objTrabajoForaneo->strCantidades = $this->input->post('strCantidades'); 
		$objTrabajoForaneo->strCostosUnitarios = $this->input->post('strCostosUnitarios'); 
		$objTrabajoForaneo->strDescuentosUnitarios = $this->input->post('strDescuentosUnitarios'); 
		$objTrabajoForaneo->strTasaCuotaIva = $this->input->post('strTasaCuotaIva');
		$objTrabajoForaneo->strIvasUnitarios = $this->input->post('strIvasUnitarios'); 
		$objTrabajoForaneo->strTasaCuotaIeps = $this->input->post('strTasaCuotaIeps'); 
		$objTrabajoForaneo->strIepsUnitarios = $this->input->post('strIepsUnitarios');
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;
		
		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objTrabajoForaneo->intTrabajoForaneoInternoID))
		{
			$bolResultado = $this->trabajos->modificar($objTrabajoForaneo);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objTrabajoForaneo->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objTrabajoForaneo->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{	
				$bolResultado = $this->trabajos->guardar($objTrabajoForaneo);
				/*Quitar '_'  de la cadena (resultadoTransaccion_trabajoForaneoInternoID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $objTrabajoForaneo->intTrabajoForaneoInternoID) = explode("_", $bolResultado);  
				
			}
		}

		//Si se ejecutó acción en la base de datos
		if($bolResultado !== NULL)
		{
			//Si no se obtienen errores al ejecutar el proceso
			if($bolResultado)
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos = array('resultado' => TRUE,
							 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
							 	  'trabajo_foraneo_interno_id' => $objTrabajoForaneo->intTrabajoForaneoInternoID,
							      'mensaje' => MSJ_GUARDAR);

			}
			else
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_ERROR_GUARDAR);
			}
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

    //Método para regresar los datos de un registro
	public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intID = $this->input->post('intTrabajoForaneoInternoID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->trabajos->buscar($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
			//Seleccionar los datos de los detalles
			$otdDetalles = $this->trabajos->buscar_detalles($intID);
			//Si existen detalles del registro, se asignan al array
			if($otdDetalles)
			{
				$arrDatos['detalles'] = $otdDetalles;
			}
			
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intTrabajoForaneoInternoID', 'ID', 'required|integer');
		$this->form_validation->set_rules('intPolizaID', 'Póliza', 'required|integer');
		//Si no cumple con las validaciones
		if ($this->form_validation->run() == FALSE)
		{
			//Enviar el mensaje de error al formulario
			$arrDatos = array('resultado' => FALSE,
							  'tipo_mensaje' => TIPO_MSJ_ERROR,
							  'mensaje' => validation_errors());
		}
		else
		{
	        //Variables que se utilizan para recuperar los valores de la vista 
	        $intID = $this->input->post('intTrabajoForaneoInternoID');
	        $intPolizaID = $this->input->post('intPolizaID');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->trabajos->set_estatus($intID, $intPolizaID);
			//Si no se obtienen errores al ejecutar el proceso
			if($bolResultado)
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos = array('resultado' => TRUE,
							 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
							      'mensaje' => MSJ_CAMBIAR_ESTATUS);
			}
			else
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_ERROR_GUARDAR);
			}
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


    /*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte() 
	{	            
		
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProveedorID = $this->input->post('intProveedorID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strDetalles = $this->input->post('strDetalles');
		//Array que se utiliza para asignar los estatus 
		$arrEstatus = array('ACTIVO', 'INACTIVO'); 
		//Array que se utiliza para asignar el subtotal por estatus
		$arrSubtotalEstatus = array(); 
		//Array que se utiliza para asignar el IVA por estatus
		$arrIvaEstatus = array();
		//Array que se utiliza para asignar el IEPS por estatus
		$arrIepsEstatus = array(); 
		//Array que se utiliza para asignar el total por estatus
		$arrTotalEstatus = array();
		//Array que se utiliza para asignar el subtotal por moneda
		$arrSubtotalMoneda = array(); 
		//Array que se utiliza para asignar el IVA por moneda
		$arrIvaMoneda = array();
		//Array que se utiliza para asignar el IEPS por moneda
		$arrIepsMoneda = array(); 
		//Array que se utiliza para asignar el total por moneda
		$arrTotalMoneda = array();
		//Array que se utiliza para asignar el total de registros por moneda
		$arrTotalRegistrosMoneda = array();
		//Variable que se utiliza para asignar el acumulado del subtotal por estatus
		$intAcumSubtotalEstatus = 0;
		//Variable que se utiliza para asignar el acumulado del IVA por estatus
	    $intAcumIvaEstatus = 0;
	    //Variable que se utiliza para asignar el acumulado del IEPS por estatus
		$intAcumIepsEstatus = 0;
		//Variable que se utiliza para asignar el acumulado del total por estatus
		$intAcumTotalEstatus = 0;
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->trabajos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProveedorID, 
											   $strEstatus, $strBusqueda);
		//Seleccionar los datos de las monedas que coinciden con el parámetro enviado
		$otdMonedas = $this->trabajos->buscar_distintas_monedas($dteFechaInicial, $dteFechaFinal, $intProveedorID, 
											   					$strEstatus, $strBusqueda);
		
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
			$strTituloRangoFechas .= ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		}
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  utf8_decode('LISTADO DE TRABAJOS FORÁNEOS INTERNOS ').$strTituloRangoFechas;
		//Si existe id del proveedor
		if($intProveedorID > 0)
		{
			//Seleccionar los datos del proveedor que coincide con el id
			$otdProveedor =  $this->proveedores->buscar($intProveedorID);
			$pdf->strLinea2 =  'PROVEEDOR: '.utf8_decode($otdProveedor->codigo.' - '.$otdProveedor->razon_social);
		}

		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'PROVEEDOR', 'FECHA', 'FACTURA',  'SUBTOTAL', 'IVA', 'IEPS', 
						     	  'TOTAL', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(16, 47, 15, 18, 20, 18, 18, 18, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'L', 'R', 'R', 'R', 'R', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('R', 'L', 'R', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(16, 54, 25, 25 );
		//Agregar la primer pagina
		$pdf->AddPage();
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo para obtener la información de los estatus
			foreach ($arrEstatus as $arrEst)
			{
				//Inicializar variables
				$arrSubtotalEstatus[$arrEst] = 0;
				$arrIvaEstatus[$arrEst] = 0;
				$arrIepsEstatus[$arrEst] = 0;
				$arrTotalEstatus[$arrEst] = 0;
			}	

			//Recorremos el arreglo para obtener la información de las monedas
			foreach ($otdMonedas as $arrMon)
			{
				//Recorremos el arreglo para obtener la información de los estatus
				foreach ($arrEstatus as $arrEst)
				{
					//Inicializar variables
					$arrSubtotalMoneda[$arrMon->moneda_id][$arrEst] = 0;
					$arrIvaMoneda[$arrMon->moneda_id][$arrEst] = 0;
					$arrIepsMoneda[$arrMon->moneda_id][$arrEst] = 0;
					$arrTotalMoneda[$arrMon->moneda_id][$arrEst] = 0;
					$arrTotalRegistrosMoneda[$arrMon->moneda_id] = 0;
				}
			}

			//Recorremos el arreglo para obtener la información de los trabajos
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				//Array que se utiliza para agregar los detalles
		        $arrDetalles = array();
		        //Array que se utiliza para agregar los datos de un detalle
		        $arrAuxiliar = array();
		        //Variable que se utiliza para asignar el acumulado del subtotal
				$intAcumSubtotal = 0;
				//Variable que se utiliza para asignar el acumulado del IVA
				$intAcumIva = 0;
				//Variable que se utiliza para asignar el acumulado del IEPS
				$intAcumIeps = 0;

				//Asignar el importe retenido de ISR (proveedor)
				$intRetencionIsrProv = ($arrCol->importe_retenido / $arrCol->tipo_cambio);

				//Seleccionar los detalles del registro
				$otdDetalles = $this->trabajos->buscar_detalles($arrCol->trabajo_foraneo_interno_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Variables que se utilizan para asignar valores del detalle
						$intCantidad = $arrDet->cantidad;
						//Convertir peso mexicano a tipo de cambio
						$intCostoUnitario = ($arrDet->costo_unitario / $arrCol->tipo_cambio);
						$intIvaUnitario = ($arrDet->iva_unitario / $arrCol->tipo_cambio);
						$intIepsUnitario = ($arrDet->ieps_unitario / $arrCol->tipo_cambio);
						$intTasaCuotaIeps = $arrDet->tasa_cuota_ieps;
						$strTipoTasaCuotaIeps = $arrDet->tipo_ieps;
		   				$strFactorTasaCuotaIeps = $arrDet->factor_ieps;
						//Variable que se utiliza para asignar el importe de IVA
						$intImporteIva = 0;
						//Variable que se utiliza para asignar el importe de IEPS
						$intImporteIeps = 0;

						//Calcular subtotal
						$intSubTotalUnitario = $intCantidad * $intCostoUnitario;
					
					    //Calcular importe de IVA
					    $intImporteIva =  $intIvaUnitario * $intCantidad;

						//Si existe id de la tasa de cuota del IEPS
						if($intTasaCuotaIeps > 0)
						{

							//Calcular importe de IEPS
						    $intImporteIeps =  $intIepsUnitario * $intCantidad;

							//Si la tasa de cuota es de tipo RANGO y su factor es Cuota
							if($strTipoTasaCuotaIeps == 'RANGO' && $strFactorTasaCuotaIeps == 'Cuota')
							{
								//Sumarle al subtotal el importe de ieps
								$intSubTotalUnitario += $intImporteIeps;
								//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
					   	 		$intImporteIeps = 0;
							}
							
						}


						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["cantidad"] = number_format($intCantidad,$this->intNumDecimalesCantidad);
						$arrAuxiliar["concepto"] = utf8_decode($arrDet->concepto);
		                $arrAuxiliar["costo_unitario"] = '$'.number_format($intCostoUnitario,$this->intNumDecimalesCostoUnitario);
		                $arrAuxiliar["subtotal"] = '$'.number_format($intSubTotalUnitario,$this->intNumDecimales);
		                //Asignar datos al array
                        array_push($arrDetalles, $arrAuxiliar); 

                        //Incrementar acumulados
						$intAcumSubtotal += $intSubTotalUnitario;
						$intAcumIva += $intImporteIva;
						$intAcumIeps += $intImporteIeps;
					}

				}//Cierre de verificación de detalles


				//Decrementar importe de retención ISR (proveedor)
				$intAcumSubtotal -= $intRetencionIsrProv;

				//Calcular importe total
				$intTotal = $intAcumSubtotal +$intAcumIva + $intAcumIeps;
					
				//Incrementar valores de los siguientes arrays
				$arrSubtotalEstatus[$arrCol->estatus] += ($intAcumSubtotal * $arrCol->tipo_cambio);
		      	$arrIvaEstatus[$arrCol->estatus] += ($intAcumIva * $arrCol->tipo_cambio);
		      	$arrIepsEstatus[$arrCol->estatus] += ($intAcumIeps * $arrCol->tipo_cambio);
		      	$arrTotalEstatus[$arrCol->estatus] += ($intTotal* $arrCol->tipo_cambio);

		      	//Si el id de la moneda no corresponde al peso mexicano
		      	if($arrCol->moneda_id != MONEDA_BASE)
		      	{
		      		//Incrementar valores de los siguientes arrays
			      	$arrSubtotalMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intAcumSubtotal;
			      	$arrIvaMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intAcumIva;
			      	$arrIepsMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intAcumIeps;
			      	$arrTotalMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intTotal;
			      	$arrTotalRegistrosMoneda[$arrCol->moneda_id] += 1;
		      	}
				
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, utf8_decode($arrCol->proveedor), $arrCol->fecha,  
								$arrCol->factura, '$'.number_format($intAcumSubtotal,2),
								'$'.number_format($intAcumIva,2), '$'.number_format($intAcumIeps,2),
								'$'.number_format($intTotal,2), $arrCol->estatus), 
								$pdf->arrAlineacion, 'ClippedCell');
		        
		        //Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
		        //Orden de reparación
				$pdf->Cell(20, 4, utf8_decode('ORDEN DE REP.:'), 0, 0, 'L', 0);
				$pdf->ClippedCell(15, 4, utf8_decode($arrCol->folio_orden_reparacion), 0, 0, 'L', 0);
				//Vehículo o serie
				//Variable que se utiliza para asignar la referencia (vehículo/serie)
				$strReferencia = '';
				//Verificar si existe el id del vehículo
				if($arrCol->vehiculo_id > 0)
				{
					//Asignar datos del vehículo
					$strReferencia = $arrCol->vehiculo;
				}
				else
				{
					//Asignar serie
					$strReferencia = $arrCol->serie;
				}

				$pdf->Cell(20, 4, utf8_decode('VEHÍCULO/SERIE:'), 0, 0, 'L', 0);
				$pdf->ClippedCell(45, 4, utf8_decode($strReferencia), 0, 0, 'L', 0);
		        
		        //Orden de compra
				$pdf->Cell(25, 4, 'ORDEN DE COMPRA:', 0, 0, 'R', 0);
				$pdf->ClippedCell(15, 4, utf8_decode($arrCol->folio_orden_compra), 0, 0, 'L', 0);
		        
				//Moneda
				$pdf->Cell(12, 4, 'MONEDA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(7, 4, utf8_decode($arrCol->codigo_moneda), 0, 0, 'L', 0);
		    	//Tipo de cambio
		    	$pdf->Cell(6, 4, 'T.C.:', 0, 0, 'R', 0);
			    $pdf->ClippedCell(12, 4,'$'.number_format($arrCol->tipo_cambio, 4, '.', ','), 0, 0, 'R', 0);
				//Si se cumple la sentencia mostrar detalles del registro
				if($arrDetalles && $strDetalles == 'SI')
				{
					$pdf->Ln(5);//Deja un salto de línea
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraDetalles);
					//Recorremos el arreglo 
			        foreach ($arrDetalles as $arrDet) 
			        {
					   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					   $pdf->Row(array($arrDet['cantidad'], $arrDet['concepto'], $arrDet['costo_unitario'],  
									    $arrDet['subtotal']), $arrAlineacionDetalles, 'ClippedCell');
					}
				}//Cierre de verificación de detalles
		    	$pdf->Ln(5);//Deja un salto de línea
				//Incrementar el contador por cada registro
				$intContador++;
			}

			$pdf->Ln(5);//Deja un salto de linea

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- RESUMEN
	        //------------------------------------------------------------------------------------------------------------------------
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//Crea los titulos de la cabecera
			$arrCabeceraResumen = array('ESTATUS', 'SUBTOTAL', 'IVA', 'IEPS',  'TOTAL');
			//Establece el ancho de las columnas de cabecera
			$arrAnchuraResumen = array(25, 25, 25, 25, 25);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacionResumen = array('L', 'R', 'R', 'R', 'R');
			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Creación de la tabla Resumen
			$pdf->Cell(125, 4, 'RESUMEN GENERAL EN PESOS', 0, 0, 'C', TRUE);
			$pdf->Ln(4);//Deja un salto de linea
			//Recorre el array de titulos de encabezado para crearlos
			for ($intCont = 0; $intCont < count($arrCabeceraResumen); $intCont++)
			{
				//inserta los titulos de la cabecera
				$pdf->Cell($arrAnchuraResumen[$intCont], 5, $arrCabeceraResumen[$intCont], 1, 0, 
						   $arrAlineacionResumen[$intCont], TRUE);
			}
			$pdf->Ln(6);//Deja un salto de línea
			//Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchuraResumen);
			$pdf->SetTextColor(0); //establece el color de texto
			//Hacer recorrido para obtener totales por estatus
			foreach ($arrEstatus as $arrEst)
			{
				//Si existe subtotal
				if($arrSubtotalEstatus[$arrEst] > 0)
				{
				 	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($arrEst,'$'.number_format($arrSubtotalEstatus[$arrEst],$this->intNumDecimales), 
									'$'.number_format($arrIvaEstatus[$arrEst],$this->intNumDecimales), 
			    				    '$'.number_format($arrIepsEstatus[$arrEst],$this->intNumDecimales), 
			    				    '$'.number_format($arrTotalEstatus[$arrEst],$this->intNumDecimales)), 
									$arrAlineacionResumen);

					//Incrementar acumulados si el estatus es ACTIVO 
					if($arrEst == 'ACTIVO')
					{
						//Incrementar acumulados
						$intAcumSubtotalEstatus += $arrSubtotalEstatus[$arrEst];
						$intAcumIvaEstatus += $arrIvaEstatus[$arrEst];
						$intAcumIepsEstatus += $arrIepsEstatus[$arrEst];
						$intAcumTotalEstatus += $arrTotalEstatus[$arrEst];
					}
				}
			}

			//Asigna el tipo y tamaño de letra para los totales
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Escribir totales
	    	$pdf->Cell(12,3,'TOTALES: ', 0, 0, 'L');  
	    	//Total de registros
            $pdf->Cell(13,3,$intContador, 0, 0, 'R');
            //Acumulado del subtotal
            $pdf->Cell(25,3,'$'.number_format($intAcumSubtotalEstatus,$this->intNumDecimales), 0, 0, 'R');
            //Acumulado del IVA
            $pdf->Cell(25,3,'$'.number_format($intAcumIvaEstatus,$this->intNumDecimales), 0, 0, 'R');
           //Acumulado del IEPS
            $pdf->Cell(25,3,'$'.number_format($intAcumIepsEstatus,$this->intNumDecimales), 0, 0, 'R');
            //Acumulado del importe total
            $pdf->Cell(25,3,'$'.number_format($intAcumTotalEstatus,$this->intNumDecimales), 0, 0, 'R');
            $pdf->Ln(8);//Deja un salto de línea

            //Hacer recorrido para obtener el resumen por cada tipo de moneda
			foreach ($otdMonedas as $arrMon) 
			{
				//Limpiar las siguientes variables (por cada moneda recorrida)
				$intAcumSubtotalEstatus = 0;
				$intAcumIvaEstatus = 0;
				$intAcumIepsEstatus = 0;
				$intAcumTotalEstatus = 0;

				//Asigna el tipo y tamaño de letra para la cabecera de la tabla
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Creación de la tabla Resumen
				$pdf->ClippedCell(125, 4, 'RESUMEN POR MONEDA '.$arrMon->descripcion, 0, 0, 'C', TRUE);
			    $pdf->Ln(4);//Deja un salto de linea
				
				//Recorre el array de titulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabeceraResumen); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchuraResumen[$intCont], 5, $arrCabeceraResumen[$intCont], 1, 0, 
							   $arrAlineacionResumen[$intCont], TRUE);
				}
				$pdf->Ln(6);//Deja un salto de línea
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraResumen);
				$pdf->SetTextColor(0); //establece el color de texto
				//Hacer recorrido para obtener totales por estatus
				foreach ($arrEstatus as $arrEst)
				{
					//Si existe subtotal
					if($arrSubtotalMoneda[$arrMon->moneda_id][$arrEst] > 0)
					{
					 	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						$pdf->Row(array($arrEst,
										'$'.number_format($arrSubtotalMoneda[$arrMon->moneda_id][$arrEst],$this->intNumDecimales), 
										'$'.number_format($arrIvaMoneda[$arrMon->moneda_id][$arrEst],$this->intNumDecimales), 
				    				    '$'.number_format($arrIepsMoneda[$arrMon->moneda_id][$arrEst],$this->intNumDecimales), 
				    				    '$'.number_format($arrTotalMoneda[$arrMon->moneda_id][$arrEst],$this->intNumDecimales)), 
										$arrAlineacionResumen);

						//Incrementar acumulados si el estatus es ACTIVO 
						if($arrEst == 'ACTIVO')
						{
							//Incrementar acumulados
							$intAcumSubtotalEstatus += $arrSubtotalMoneda[$arrMon->moneda_id][$arrEst];
							$intAcumIvaEstatus += $arrIvaMoneda[$arrMon->moneda_id][$arrEst];
							$intAcumIepsEstatus += $arrIepsMoneda[$arrMon->moneda_id][$arrEst];
							$intAcumTotalEstatus += $arrTotalMoneda[$arrMon->moneda_id][$arrEst];
						}

					}

				}

				//Asigna el tipo y tamaño de letra para los totales
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Escribir totales
		    	$pdf->Cell(12,3,'TOTALES: ', 0, 0, 'L');  
		    	//Total de registros
	            $pdf->Cell(13,3,$arrTotalRegistrosMoneda[$arrMon->moneda_id], 0, 0, 'R');
	            //Acumulado del subtotal
	            $pdf->Cell(25,3,'$'.number_format($intAcumSubtotalEstatus,$this->intNumDecimales), 0, 0, 'R');
	            //Acumulado del IVA
	            $pdf->Cell(25,3,'$'.number_format($intAcumIvaEstatus,$this->intNumDecimales), 0, 0, 'R');
	           //Acumulado del IEPS
	            $pdf->Cell(25,3,'$'.number_format($intAcumIepsEstatus,$this->intNumDecimales), 0, 0, 'R');
	            //Acumulado del importe total
	            $pdf->Cell(25,3,'$'.number_format($intAcumTotalEstatus,$this->intNumDecimales), 0, 0, 'R');
	            $pdf->Ln(8);//Deja un salto de línea
			}
		}
		//Ejecutar la salida del reporte
		$pdf->Output('trabajos_foraneos_internos.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro() 
	{	            
		//Variables que se utilizan para recuperar los valores de la vista
		$intTrabajoForaneoInternoID = $this->input->post('intTrabajoForaneoInternoID');     
		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->trabajos->buscar($intTrabajoForaneoInternoID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->trabajos->buscar_detalles($intTrabajoForaneoInternoID);
		//Seleccionar los datos de las tasa de IEPS de los detalles del registro
		$otdTasasIeps = $this->trabajos->buscar_tasas_ieps_detalles($intTrabajoForaneoInternoID);
		//Seleccionar los datos de las tasa de IEPS de los detalles del registro
		//$otdTasasIeps = $this->trabajos->buscar_tasas_ieps_detalles($intTrabajoForaneoInternoID);
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variables que se utilizan para los acumulados del costo unitario
		//Variable que se utiliza para asignar el acumulado del subtotal
		$intAcumSubtotalCosto = 0;
		//Variable que se utiliza para asignar el acumulado del IVA
		$intAcumIvaCosto = 0;
		//Variable que se utiliza para asignar el acumulado del IEPS
		$intAcumIepsCosto = 0;
		//Variables que se utilizan para los acumulados del precio unitario
		//Variable que se utiliza para asignar el acumulado del subtotal
		$intAcumSubtotalPrecio = 0;
		//Variable que se utiliza para asignar el acumulado del IVA
		$intAcumIvaPrecio = 0;
		//Variable que se utiliza para asignar el acumulado del IEPS
		$intAcumIepsPrecio = 0;
		//Variable que se utiliza para asignar el acumulado de la retención de ISR (proveedor)
		$intRetencionIsrProv = 0;
		//Array que se utiliza para asignar el acumulado del importe de IEPS por tasa
		$arrIepsTasa = array(); 
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'trabajo_foraneo_interno_';
		//Establece el ancho de las columnas de cabecera de la tabla tasas de IEPS
		$arrAnchuraTasasIeps = array(10, 15, 20);
		//Establece la alineación de las celdas de la tabla tasas de IEPS
		$arrAlineacionTasasIeps = array('L', 'L', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
		$this->get_encabezado_archivo_pdf($pdf);

		//Verificar si hay información del registro
		if($otdResultado)
		{	
			//Hacer un llamado a la función para mostrar imagen del estatus (INACTIVO/TIMBRAR)
			$this->get_img_estatus_archivo_pdf($pdf, $otdResultado->estatus);

			//Recorremos el arreglo para obtener la información de las tasas de IEPS
			foreach ($otdTasasIeps as $arrTasa)
			{
				//Inicializar variables
				$arrIepsTasa[$arrTasa->tasa_cuota_ieps] = 0;
			}

			//Variable que se utiliza para asignar el tipo de cambio
			$intTipoCambio = $otdResultado->tipo_cambio;

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL PROVEEDOR
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 42);
			$pdf->ClippedCell(92, 3, 'PROVEEDOR', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0); //establece el color de texto
			//RFC
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, 46);
			$pdf->ClippedCell(10, 3, 'RFC');
			//Nombre comercial
			$pdf->SetXY(15, 49);
			$pdf->ClippedCell(22, 03, 'NOMBRE');
			//Domicilio
			$pdf->SetXY(15, 58);
			$pdf->ClippedCell(22, 3, 'DOMICILIO');
			//Teléfono
			$pdf->SetXY(75, 58);
			$pdf->ClippedCell(20, 3, utf8_decode('TELÉFONO'));
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//RFC
			$pdf->SetXY(25, 46);
			$pdf->ClippedCell(30, 3, $otdResultado->rfc);
			//Nombre comercial
			$pdf->SetXY(15, 52);
			$pdf->MultiCell(92, 3, utf8_decode($otdResultado->proveedor));
			//Teléfono
			$pdf->SetXY(92, 58);
			$pdf->ClippedCell(40, 3, $otdResultado->telefono_principal);
			//Variable que se utiliza para asignar el número interior
			$strNumInteriorProveedor = (($otdResultado->numero_interior !== NULL && 
						        	    empty($otdResultado->numero_interior) === FALSE) ?
	                                    ' INT. '.$otdResultado->numero_interior : '');
			//Concatenar datos para el domicilio
	    	$strDomicilioProveedor = $otdResultado->calle . ' NO.'.$otdResultado->numero_exterior.
	    							 $strNumInteriorProveedor.' COL. ' . $otdResultado->colonia.' C.P. '.
	    							 $otdResultado->codigo_postal.' '.$otdResultado->localidad. ', '. 
	    							 $otdResultado->municipio. ', '.$otdResultado->estado;

			//Domicilio
			$pdf->SetXY(15, 61);
			$pdf->MultiCell(92, 3, utf8_decode($strDomicilioProveedor));


			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL TRABAJO FORÁNEO INTERNO
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(108, 42);
			$pdf->ClippedCell(92, 3, utf8_decode('TRABAJO FORÁNEO INTERNO'), 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0);//establece el color de texto
			//Folio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, 46);
			$pdf->ClippedCell(15, 3, 'FOLIO');
			//Fecha 
			$pdf->SetXY(154, 46);
			$pdf->ClippedCell(15, 3, 'FECHA');
			//Moneda
			$pdf->SetXY(108, 49);
			$pdf->ClippedCell(15, 3, 'MONEDA');
			//Tipo de cambio
			$pdf->SetXY(154, 49);
			$pdf->ClippedCell(25, 3, 'TIPO DE CAMBIO');
			//Orden de reparación
			$pdf->SetXY(108, 52);
			$pdf->ClippedCell(32, 3, utf8_decode('ORDEN DE REP.'));
			//Vehículo o Serie
			$pdf->SetXY(108, 55);
			$pdf->ClippedCell(32, 3, utf8_decode('VEHÍCULO/SERIE'));
			//Orden de compra
			$pdf->SetXY(108, 58);
			$pdf->ClippedCell(32, 3, 'ORDEN DE COMPRA');
			//Factura
			$pdf->SetXY(154, 58);
			$pdf->ClippedCell(32, 3, 'FACTURA');
			//Estatus
			$pdf->SetXY(108, 61);
			$pdf->ClippedCell(32, 3, 'ESTATUS');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(135, 46);
			$pdf->ClippedCell(76, 3, $otdResultado->folio);
			//Fecha
			$pdf->SetXY(178, 46);
			$pdf->ClippedCell(29, 3, $otdResultado->fecha);
			//Moneda
			$pdf->SetXY(135, 49);
			$pdf->ClippedCell(29, 3, $otdResultado->codigo_moneda);
			//Tipo de cambio
			$pdf->SetXY(178, 49);
			$pdf->ClippedCell(20, 3, '$'.number_format($otdResultado->tipo_cambio, 4, '.', ','));
			//Orden de reparación
			$pdf->SetXY(135, 52);
			$pdf->ClippedCell(60, 3, $otdResultado->folio_orden_reparacion);
			//Vehículo o serie
			//Variable que se utiliza para asignar la referencia (vehículo/serie)
			$strReferencia = '';
			//Verificar si existe el id del vehículo
			if($otdResultado->vehiculo_id > 0)
			{
				//Asignar datos del vehículo
				$strReferencia = $otdResultado->vehiculo;
			}
			else
			{
				//Asignar serie
				$strReferencia = $otdResultado->serie;
			}

			$pdf->SetXY(135, 55);
			$pdf->ClippedCell(60, 3, utf8_decode($strReferencia));
			//Orden de compra
			$pdf->SetXY(135, 58);
			$pdf->ClippedCell(60, 3, $otdResultado->folio_orden_compra);
			//Factura
			$pdf->SetXY(178, 58);
			$pdf->ClippedCell(60, 3, $otdResultado->factura);
			//Estatus
			$pdf->SetXY(135, 61);
			$pdf->ClippedCell(60, 3, $otdResultado->estatus);

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DEL TRABAJO FORÁNEO INTERNO
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 70);
			$pdf->ClippedCell(185, 3, 'CONCEPTOS', 0, 0, 'C', TRUE);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			
			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				//Tabla con los detalles del movimiento
				$pdf->SetXY(15, 74);
				//Crea los titulos de la cabecera
				$arrCabecera = array(utf8_decode('Descripción'), 'Cantidad',  
									'Costo', 'Costo Ext.', 'Subtotal');
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(90, 27, 28, 20, 20);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'R', 'R', 'R', 'R');
				//Recorre el array de títulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchura[$intCont], 3, $arrCabecera[$intCont], 1, 0, 
							   $arrAlineacion[$intCont], TRUE);
				}
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchura);

				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDet)
				{ 
					$pdf->SetX(15);
					//Variables que se utilizan para asignar los importes de IVA y IEPS del costo unitario
					//Variable que se utiliza para asignar el importe de IVA
					$intImporteIvaCosto = 0;
					//Variable que se utiliza para asignar el importe de IEPS
					$intImporteIepsCosto = 0;
					//Variables que se utilizan para asignar los importes de IVA y IEPS del precio unitario
					//Variable que se utiliza para asignar el importe de IVA
					$intImporteIvaPrecio = 0;
					//Variable que se utiliza para asignar el importe de IEPS
					$intImporteIepsPrecio = 0;

					//Variables que se utilizan para asignar valores del detalle
					$intCantidad = $arrDet->cantidad;
					$intPorcentajeIva = $arrDet->porcentaje_iva;
		   			$intPorcentajeIeps = $arrDet->porcentaje_ieps;
		   			$intTasaCuotaIeps = $arrDet->tasa_cuota_ieps;
					$strTipoTasaCuotaIeps = $arrDet->tipo_ieps;
				    $strFactorTasaCuotaIeps = $arrDet->factor_ieps;
					$intCostoUnitarioPesos = $arrDet->costo_unitario;
					$intCostoUnitario = $arrDet->costo_unitario;


					//Variable que se utiliza para asignar el costo unitario cuando la moneda sea distinta al peso mexicano
					$intCostoUnitarioExt = '';

					//Convertir peso mexicano a tipo de cambio
					$intCostoUnitario = ($arrDet->costo_unitario / $intTipoCambio);
					$intIvaUnitario = ($arrDet->iva_unitario / $intTipoCambio);
					$intIepsUnitario = ($arrDet->ieps_unitario / $intTipoCambio);
					
				    /***Cálculos correspondientes al costo unitario***/
				    //Si el id de la moneda no corresponde al peso mexicano
					if($otdResultado->moneda_id != MONEDA_BASE)
					{
						//Asignar el costo unitario convertido al tipo de cambio
						$intCostoUnitarioExt = number_format($intCostoUnitario,$this->intNumDecimales);
					}

				    //Asignar costo unitario
					$intSubTotalCostoUnitario = $intCostoUnitario;
					
					//Calcular subtotal
					$intSubTotalCostoUnitario = $intCantidad * $intSubTotalCostoUnitario;
					
					//Si existe importe de IVA unitario
					if($intIvaUnitario > 0)
					{
						//Calcular importe de IVA
					    $intImporteIvaCosto =  $intIvaUnitario * $intCantidad;
					}

					//Si existe importe de IEPS unitario
					if($intIepsUnitario > 0)
					{

						//Calcular importe de IEPS
					    $intImporteIepsCosto =  $intIepsUnitario * $intCantidad;

					   
						//Si la tasa de cuota es de tipo RANGO y su factor es Cuota
						if($strTipoTasaCuotaIeps == 'RANGO' && $strFactorTasaCuotaIeps == 'Cuota')
						{
							//Sumarle al subtotal el importe de ieps
							$intSubTotalCostoUnitario += $intImporteIepsCosto;
							//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
				   	 		$intImporteIepsCosto = 0;
						}

					    //Incrementar valor del array
					    $arrIepsTasa[$arrDet->tasa_cuota_ieps] += $intImporteIepsCosto;
						
					}

					//Convertir subtotal a peso mexicano
					$intSubTotalUnitarioPesos = $intSubTotalCostoUnitario * $intTipoCambio;

				    //Incrementar acumulados
					$intAcumSubtotalCosto += $intSubTotalCostoUnitario;
					$intAcumIvaCosto += $intImporteIvaCosto;
					$intAcumIepsCosto += $intImporteIepsCosto;

					
				    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(utf8_decode($arrDet->concepto), 
								 	number_format($intCantidad,$this->intNumDecimalesCantidad), 
									number_format($intCostoUnitarioPesos,$this->intNumDecimalesCostoUnitario),
									$intCostoUnitarioExt,
									number_format($intSubTotalUnitarioPesos,$this->intNumDecimales)), 
									$arrAlineacion, 'ClippedCell');
					
				}

				//Asignar el importe retenido de ISR (proveedor)
				$intRetencionIsrProv = ($otdResultado->importe_retenido / $otdResultado->tipo_cambio);

				//Calcular importe total del costo
				$intTotalCosto = $intAcumSubtotalCosto +$intAcumIvaCosto + $intAcumIepsCosto;

				//Decrementar importe de la retención de ISR (proveedor)
				$intTotalCosto -= $intRetencionIsrProv;

				//Redondear importe total a dos decimales
				$intTotalFormat = number_format($intTotalCosto,$this->intNumDecimales);

				//Calcular importe total del precio
				$intTotalPrecio = $intAcumSubtotalPrecio +$intAcumIvaPrecio + $intAcumIepsPrecio;

				$pdf->Ln(2); //Deja un salto de línea
				$pdf->SetX(15);
				//Cantidad con letra
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(60, 3, 'CANTIDAD CON LETRA');
				$pdf->Ln(); //Deja un salto de línea
				$pdf->SetX(15);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->MultiCell(185, 3, 'SON: (' .$AifLibNumber->toCurrency($intTotalFormat, $otdResultado->codigo_moneda) . ')');
				$pdf->SetX(15);
				$pdf->ClippedCell(185, 3, '', 0, 0, 'C', TRUE);
				$pdf->Ln(); //Deja un salto de línea
				//Observaciones
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(15);
				$pdf->ClippedCell(30, 3, 'OBSERVACIONES');
				//Subtotal
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'SUBTOTAL');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			    //Si el id de la moneda no corresponde al peso mexicano
				if($otdResultado->moneda_id != MONEDA_BASE)
				{
					//Subtotal de la moneda extranjera (convertido al tipo de cambio)
					$pdf->SetX(160);
					$pdf->ClippedCell(20, 3, '$'.number_format($intAcumSubtotalCosto,$this->intNumDecimales), 0, 0, 'R');
				}

				//Convertir subtotal a peso mexicano
				$intAcumSubtotalPesos =  $intAcumSubtotalCosto * $intTipoCambio;
				//Subtotal en pesos mexicanos
				$pdf->SetX(180);
				$pdf->ClippedCell(20, 3, '$'.number_format($intAcumSubtotalPesos,$this->intNumDecimales), 0, 0, 'R');

				$pdf->Ln(); //Deja un salto de línea
				$intPosYObs = $pdf->GetY();
				//Si existe retención de ISR (proveedor)
				if($intRetencionIsrProv > 0)
				{

					//Retención de ISR
					$pdf->SetX(135);
					//Asigna el tipo y tamaño de letra
				    $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->ClippedCell(25, 3, utf8_decode('RET. ISR').' '.$otdResultado->porcentaje_isr);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);

					//Si el id de la moneda no corresponde al peso mexicano
					if($otdResultado->moneda_id != MONEDA_BASE)
					{
						//Retención ISR de la moneda extranjera (convertido al tipo de cambio)
						$pdf->SetX(160);
						$pdf->ClippedCell(20, 3, '$'.number_format($intRetencionIsrProv, $this->intNumDecimales), 0, 0, 'R');
					}
					

					//Convertir retención ISR a peso mexicano
					$intRetencionIsrProvPesos = $intRetencionIsrProv * $intTipoCambio;

					//Retención ISR en pesos mexicanos
					$pdf->SetX(180);
					$pdf->ClippedCell(20, 3, '$'.number_format($intRetencionIsrProvPesos,$this->intNumDecimales), 0, 0, 'R');
					$pdf->Ln(); //Deja un salto de línea
				}



				$intPosY = $pdf->GetY();


				//IVA
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(135, $intPosY);
				$pdf->ClippedCell(30, 3, 'IVA');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Si el id de la moneda no corresponde al peso mexicano
				if($otdResultado->moneda_id != MONEDA_BASE)
				{
					//Subtotal de la moneda extranjera (convertido al tipo de cambio)
					$pdf->SetX(160);
					$pdf->ClippedCell(20, 3, '$'.number_format($intAcumIvaCosto,$this->intNumDecimales), 0, 0, 'R');
				}

				//Convertir IVA a peso mexicano
				$intAcumIvaPesos =  $intAcumIvaCosto * $intTipoCambio;
				//IVA en pesos mexicanos
				$pdf->SetX(180);
				$pdf->ClippedCell(20, 3, '$'.number_format($intAcumIvaPesos,$this->intNumDecimales), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea


				//IEPS
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'IEPS');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Si el id de la moneda no corresponde al peso mexicano
				if($otdResultado->moneda_id != MONEDA_BASE)
				{
					//IEPS de la moneda extranjera (convertido al tipo de cambio)
					$pdf->SetX(160);
					$pdf->ClippedCell(20, 3, '$'.number_format($intAcumIepsCosto,$this->intNumDecimales), 0, 0, 'R');
				}

				//Convertir IEPS a peso mexicano
				$intAcumIepsPesos =  $intAcumIepsCosto * $intTipoCambio;
				//IEPS en pesos mexicanos
				$pdf->SetX(180);
				$pdf->ClippedCell(20, 3, '$'.number_format($intAcumIepsPesos,$this->intNumDecimales), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea


				//Total
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'TOTAL');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Si el id de la moneda no corresponde al peso mexicano
				if($otdResultado->moneda_id != MONEDA_BASE)
				{
					//Total de la moneda extranjera (convertido al tipo de cambio)
					$pdf->SetX(160);
					$pdf->ClippedCell(20, 3, '$'.number_format($intTotalCosto,$this->intNumDecimales), 0, 0, 'R');
				}

				//Convertir total a peso mexicano
				$intTotalPesos = $intTotalCosto * $intTipoCambio;
				//Total  en pesos mexicanos
				$pdf->SetX(180);
				$pdf->ClippedCell(20, 3, '$'.number_format($intTotalPesos,$this->intNumDecimales), 0, 0, 'R');

				//Asignar la posición de las tasas de IEPS
				$intPosYTasaIeps = $pdf->GetY();

				//Observaciones
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(15, $intPosYObs);
				$pdf->MultiCell(105, 3, utf8_decode($otdResultado->observaciones));

				//Recorremos el arreglo para obtener la información de los acumulados por tasa de IEPS
				if($otdTasasIeps)
				{
					//Incrementar posición de la ordenada
					$intPosYTasaIeps+=20;
					//Asignar posición para escribir los acumulados por tasa de IEPS
					$pdf->SetY($intPosYTasaIeps);
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraTasasIeps);
					//Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
					//Hacer recorrido para obtener totales por estatus
					foreach ($otdTasasIeps as $arrTasa)
					{
						$pdf->SetX(15);
						//Si existe acumulado del importe de IEPS
						if($arrIepsTasa[$arrTasa->tasa_cuota_ieps] > 0)
						{
							//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    	$pdf->Row(array('IEPS',$arrTasa->porcentaje_ieps.'%',
								  			'$'.number_format($arrIepsTasa[$arrTasa->tasa_cuota_ieps],$this->intNumDecimales)), 
											 $arrAlineacionTasasIeps, 'ClippedCell');
						}
						
						
					
					}

					//Cambiar el volumen de la fuente a normal
	      			$pdf->strTipoLetraTabla = '';
				}

			    //Persona que recibio trabajo foráneo
	            $pdf->SetXY(15,260);
	            //Persona que reviso trabajo foráneo
	            $pdf->SetXY(109, 260);
	            $pdf->Ln(5);//Espacios de salto de línea
	            $pdf->SetX(15);
	            //Persona que recibio trabajo foráneo
	            //Asigna el tipo y tamaño de letra
	            $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
	            $pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
	            $pdf->Cell(90, 3, 'RECIBIO', 0, 0, 'C',  TRUE);
	            //Persona que reviso la trabajo foráneo
	            $pdf->SetXY(109, 265);
	            $pdf->Cell(90, 3, 'REVISO', 0, 0, 'C',  TRUE);
	          

	            //Fecha y hora de impresión (pie de pagina)
				$pdf->strUsuarioCreacion = $otdResultado->usuario_creacion;
				$pdf->dteFechaCreacion = $otdResultado->fecha_creacion;
				$pdf->strIncluirMembrete = 'SI';

			}//Cierre de verificación de detalles

			//Concatenar folio para identificar movimiento
			$strNombreArchivo .= $otdResultado->folio;

		}//Cierre de verificación de información

		//Ejecutar la salida del reporte
		$pdf->Output($strNombreArchivo.'.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProveedorID = $this->input->post('intProveedorID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strDetalles = $this->input->post('strDetalles');
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->trabajos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProveedorID, 
											   $strEstatus, $strBusqueda);
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
			$strTituloRangoFechas .= ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		}
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE TRABAJOS FORÁNEOS INTERNOS '.$strTituloRangoFechas);
		//Si existe id del proveedor
		if($intProveedorID > 0)
		{   //Seleccionar los datos del proveedor que coincide con el id
			$otdProveedor =  $this->proveedores->buscar($intProveedorID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'PROVEEDOR: '.$otdProveedor->codigo.' - '.$otdProveedor->razon_social);
		}
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'PROVEEDOR')
        		 ->setCellValue('C'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('D'.$intPosEncabezados, 'FACTURA')
        		 ->setCellValue('E'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('F'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('G'.$intPosEncabezados, 'IEPS')
        		 ->setCellValue('H'.$intPosEncabezados, 'TOTAL')
        		 ->setCellValue('I'.$intPosEncabezados, 'ORDEN DE REPARACIÓN')
        		 ->setCellValue('J'.$intPosEncabezados, 'VEHÍCULO')
        		 ->setCellValue('K'.$intPosEncabezados, 'SERIE')
        		 ->setCellValue('L'.$intPosEncabezados, 'MOTOR')
        		 ->setCellValue('M'.$intPosEncabezados, 'ORDEN DE COMPRA')
        		 ->setCellValue('N'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('O'.$intPosEncabezados, 'T.C.')
        		 ->setCellValue('P'.$intPosEncabezados, 'OBSERVACIONES')
                 ->setCellValue('Q'.$intPosEncabezados, 'ESTATUS');
        

        //Definir estilos de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE,
    													'color' => array('rgb' => 'ffffff')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Combinar las siguientes celdas
       	$objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A8:D8');

       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A8:D8')
        		 ->applyFromArray($arrStyleBold);

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A10:Q10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:Q10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:Q10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('R'.$intPosEncabezados, 'CANTIDAD')
                     ->setCellValue('S'.$intPosEncabezados, 'CONCEPTO')
			         ->setCellValue('T'.$intPosEncabezados,'COSTO UNITARIO')
			         ->setCellValue('U'.$intPosEncabezados, 'SUBTOTAL');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('R'.$intPosEncabezados.':U'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('R'.$intPosEncabezados.':U'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('R'.$intPosEncabezados.':U'.$intPosEncabezados)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentCenter);
        }

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Array que se utiliza para agregar los detalles
		        $arrDetalles = array();
		        //Variable que se utiliza para asignar el número de detalles 
		        $intNumDetalles = 1;
		        //Variable que se utiliza para asignar el acumulado del subtotal
				$intAcumSubtotal = 0;
				//Variable que se utiliza para asignar el acumulado del IVA
				$intAcumIva = 0;
				//Variable que se utiliza para asignar el acumulado del IEPS
				$intAcumIeps = 0;
				//Asignar el importe retenido de ISR (proveedor)
				$intRetencionIsrProv =  ($arrCol->importe_retenido / $arrCol->tipo_cambio);

				//Seleccionar los detalles del registro
				$otdDetalles = $this->trabajos->buscar_detalles($arrCol->trabajo_foraneo_interno_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Variable que se utiliza para contar el número de detalles
				    $intContDetTrab = 0;

				    //Si se cumple la sentencia mostrar detalles del registro
				    if($strDetalles == 'SI')
				    {
				    	//Asignar el número de detalles
				    	$intNumDetalles = count($otdDetalles);
				    }
				    
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Variables que se utilizan para asignar valores del detalle
						$intCantidad = $arrDet->cantidad;
						//Convertir peso mexicano a tipo de cambio
						$intCostoUnitario = ($arrDet->costo_unitario / $arrCol->tipo_cambio);
						$intIvaUnitario = ($arrDet->iva_unitario / $arrCol->tipo_cambio);
						$intIepsUnitario = ($arrDet->ieps_unitario / $arrCol->tipo_cambio);
						$intCostoUnitario = ($arrDet->costo_unitario / $arrCol->tipo_cambio);
						$intTasaCuotaIeps = $arrDet->tasa_cuota_ieps;
						$strTipoTasaCuotaIeps = $arrDet->tipo_ieps;
					    $strFactorTasaCuotaIeps = $arrDet->factor_ieps;
						//Variable que se utiliza para asignar el importe de IVA
						$intImporteIva = 0;
						//Variable que se utiliza para asignar el importe de IEPS
						$intImporteIeps = 0;

						//Calcular subtotal
						$intSubTotalUnitario = $intCantidad * $intCostoUnitario;

						//Si existe importe de IVA unitario
						if($intIvaUnitario > 0)
						{
							//Calcular importe de IVA
						    $intImporteIva =  $intIvaUnitario * $intCantidad;
						}

						//Si existe id de la tasa de cuota del IEPS
						if($intTasaCuotaIeps > 0)
						{

							//Calcular importe de IEPS
						    $intImporteIeps =  $intIepsUnitario * $intCantidad;

							//Si la tasa de cuota es de tipo RANGO y su factor es Cuota
							if($strTipoTasaCuotaIeps == 'RANGO' && $strFactorTasaCuotaIeps == 'Cuota')
							{
								//Sumarle al subtotal el importe de ieps
								$intSubTotalUnitario += $intImporteIeps;
								//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
					   	 		$intImporteIeps = 0;
							}
							
						}
						

                        //Agregar datos al array
			        	$arrDetalles[$intContDetTrab]['cantidad'] = $intCantidad;
			        	$arrDetalles[$intContDetTrab]['concepto'] = $arrDet->concepto;
			        	$arrDetalles[$intContDetTrab]['costo_unitario'] = $intCostoUnitario;
			        	$arrDetalles[$intContDetTrab]['subtotal'] = $intSubTotalUnitario;

                        //Incrementar acumulados
						$intAcumSubtotal += $intSubTotalUnitario;
						$intAcumIva += $intImporteIva;
						$intAcumIeps += $intImporteIeps;

						//Incrementar el contador por cada registro
	                    $intContDetTrab++;
					}

				}//Cierre de verificación de detalles


				//Decrementar importe de retención ISR (proveedor)
				$intAcumSubtotal -= $intRetencionIsrProv;
				
				
				//Calcular importe total
				$intTotal = $intAcumSubtotal +$intAcumIva + $intAcumIeps;

				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    { 
			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
						 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValue('B'.$intFila, $arrCol->proveedor)
		                         ->setCellValue('C'.$intFila, $arrCol->fecha)
		                         ->setCellValue('D'.$intFila, $arrCol->factura)
		                         ->setCellValue('E'.$intFila, $intAcumSubtotal)
		                         ->setCellValue('F'.$intFila, $intAcumIva)
		                         ->setCellValue('G'.$intFila, $intAcumIeps)
		                         ->setCellValue('H'.$intFila, $intTotal)
		                         ->setCellValueExplicit('I'.$intFila, $arrCol->folio_orden_reparacion, PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValue('J'.$intFila, $arrCol->vehiculo)
		                         ->setCellValue('K'.$intFila, $arrCol->serie)
		                         ->setCellValue('L'.$intFila, $arrCol->motor)
		                         ->setCellValueExplicit('M'.$intFila, $arrCol->folio_orden_compra, PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValue('N'.$intFila, $arrCol->moneda)
		                         ->setCellValue('O'.$intFila, $arrCol->tipo_cambio)
		                         ->setCellValue('P'.$intFila, $arrCol->observaciones)
		                         ->setCellValue('Q'.$intFila, $arrCol->estatus);

		                //Si se cumple la sentencia mostrar detalles del registro
						if($arrDetalles && $strDetalles == 'SI')
						{
							//Agregar información del detalle
							$objExcel->setActiveSheetIndex(0)
							 	  ->setCellValue('R'.$intFila, $arrDetalles[$intContDet]['cantidad'])
		                         ->setCellValue('S'.$intFila,  $arrDetalles[$intContDet]['concepto'])
						         ->setCellValue('T'.$intFila,  $arrDetalles[$intContDet]['costo_unitario'])
						         ->setCellValue('U'.$intFila,  $arrDetalles[$intContDet]['subtotal']);
						}


			    	//Incrementar el indice para escribir los datos del siguiente registro
	                $intFila++; 
			    }

			    //Incrementar el contador por cada registro
				$intContador++;
				
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('E'.$intFilaInicial.':'.'H'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

           	$objExcel->getActiveSheet()
            		 ->getStyle('T'.$intFilaInicial.':'.'U'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.0000');

			//Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('O'.$intFilaInicial.':'.'O'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.0000');

            //Cambiar contenido de las celdas a formato númerico de 2 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('R'.$intFilaInicial.':'.'R'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('###0.00');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

    		$objExcel->getActiveSheet()
		        	 ->getStyle('E'.$intFilaInicial.':'.'H'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('O'.$intFilaInicial.':'.'O'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);
                	 		 
			$objExcel->getActiveSheet()
                	 ->getStyle('Q'.$intFilaInicial.':'.'Q'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
		        	 ->getStyle('R'.$intFilaInicial.':'.'R'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
		        	 ->getStyle('T'.$intFilaInicial.':'.'U'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('Q'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('Q'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'trabajos_foraneos_internos.xls', 'trabajos foráneos', 
        									$intFila);
	}

	/*******************************************************************************************************************
	Funciones de la tabla trabajos_foraneos_detalles
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion_detalles()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->trabajos->filtro_detalles($this->input->post('intOrdenReparacionInternaID'),
								                   $config['per_page'],
								                   $config['cur_page']);

		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Variable que se utiliza para asignar el acumulado de las unidades
		$intAcumUnidades = 0;
		//Variable que se utiliza para asignar el acumulado del descuento
	    $intAcumDescuento = 0;
		//Variable que se utiliza para asignar el acumulado del subtotal
	    $intAcumSubtotal = 0;
	    //Variable que se utiliza para asignar el acumulado del IVA
	    $intAcumIva = 0;
	    //Variable que se utiliza para asignar el acumulado del IEPS
	    $intAcumIeps = 0;
	    //Variable que se utiliza para asignar el acumulado del total
		$intAcumTotal = 0;

		//Hacer recorrido para incrementar acumulados
		foreach ($result["registros"] as $arrDet) 
		{
			//Si el estatus del registro es ACTIVO
			if($arrDet->estatus == 'ACTIVO')
			{
				//Variables que se utilizan para asignar valores del detalle
				//Convertir cantidad a dos decimales
				$intCantidad = number_format($arrDet->cantidad, 2, '.', '');
				$intCostoUnitario = $arrDet->costo_unitario;
				$intDescuentoUnitario = $arrDet->descuento_unitario;
				$intIvaUnitario = $arrDet->iva_unitario;
				$intIepsUnitario = $arrDet->ieps_unitario;
				$intTasaCuotaIeps = $arrDet->tasa_cuota_ieps;
		    	$strTipoTasaCuotaIeps = $arrDet->tipo_ieps;
		    	$strFactorTasaCuotaIeps = $arrDet->factor_ieps;
				//Variable que se utiliza para asignar el subtotal 
				$intSubTotal = 0;
			    //Variable que se utiliza para asignar el importe de iva
				$intImporteIva = 0;
				//Variable que se utiliza para asignar el importe de ieps
				$intImporteIeps = 0;	
			   
				//Calcular subtotal
				$intSubTotal = $intCantidad * $intCostoUnitario;

				//Calcular importe de IVA
				$intImporteIva = $intCantidad * $intIvaUnitario;

				//Si existe id de la tasa de cuota del IEPS
				if($intTasaCuotaIeps > 0)
				{

					//Calcular importe de IEPS
				    $intImporteIeps =  $intIepsUnitario * $intCantidad;

					//Si la tasa de cuota es de tipo RANGO y su factor es Cuota
					if($strTipoTasaCuotaIeps == 'RANGO' && $strFactorTasaCuotaIeps == 'Cuota')
					{
						//Sumarle al subtotal el importe de ieps
						$intSubTotal += $intImporteIeps;
						//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
			   	 		$intImporteIeps = 0;
					}
					
				}

				//Calcular importe total
				$intTotal = $intSubTotal + $intImporteIva + $intImporteIeps;

				//Incrementar acumulados
	            $intAcumUnidades += $intCantidad;
	            $intAcumDescuento += $intDescuentoUnitario;
				$intAcumSubtotal += $intSubTotal;
				$intAcumIva += $intImporteIva;
				$intAcumIeps += $intImporteIeps;
				$intAcumTotal += $intTotal;
			}

			//Incrementar el contador por cada registro
			$intContador++;
		}

		//Convertir cantidad a formato moneda
		$intAcumUnidades = number_format($intAcumUnidades,2);
		$intAcumDescuento = '$'.number_format($intAcumDescuento,2);
		$intAcumSubtotal = '$'.number_format($intAcumSubtotal,2);
		$intAcumIva = '$'.number_format($intAcumIva, $this->intNumDecimales);
		$intAcumIeps = '$'.number_format($intAcumIeps, $this->intNumDecimales);
		$intAcumTotal = '$'.number_format($intAcumTotal, $this->intNumDecimales);

		//Asignar el número de registros
		$config['total_rows'] = $intContador;

		//Hacer recorrido para calcular el importe total de cada registro
		foreach ($result['detalles'] as $arrDet)
		{
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = '';
			//Variables que se utilizan para asignar valores del detalle
			$intCantidad = number_format($arrDet->cantidad, 2, '.', '');
			$intCostoUnitario = $arrDet->costo_unitario;
			$intDescuentoUnitario = $arrDet->descuento_unitario;
			$intIvaUnitario = $arrDet->iva_unitario;
			$intIepsUnitario = $arrDet->ieps_unitario;
			$intTasaCuotaIeps = $arrDet->tasa_cuota_ieps;
	    	$strTipoTasaCuotaIeps = $arrDet->tipo_ieps;
	    	$strFactorTasaCuotaIeps = $arrDet->factor_ieps;
			//Variable que se utiliza para asignar el subtotal 
			$intSubTotal = 0;
		    //Variable que se utiliza para asignar el importe de iva
			$intImporteIva = 0;
			//Variable que se utiliza para asignar el importe de ieps
			$intImporteIeps = 0;	

			//Calcular subtotal
			$intSubTotal = $intCantidad * $intCostoUnitario;

			//Si existe importe del descuento
			if($intDescuentoUnitario > 0)
			{
				//Incrementar costo unitario
				$intCostoUnitario = $intCostoUnitario + $intDescuentoUnitario;
			}	

			//Calcular importe de IVA
			$intImporteIva = $intCantidad * $intIvaUnitario;

			//Si existe id de la tasa de cuota del IEPS
			if($intTasaCuotaIeps > 0)
			{

				//Calcular importe de IEPS
			    $intImporteIeps =  $intIepsUnitario * $intCantidad;

				//Si la tasa de cuota es de tipo RANGO y su factor es Cuota
				if($strTipoTasaCuotaIeps == 'RANGO' && $strFactorTasaCuotaIeps == 'Cuota')
				{
					//Sumarle al subtotal el importe de ieps
					$intSubTotal += $intImporteIeps;
					//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
		   	 		$intImporteIeps = 0;
				}
				
			}
			
			//Calcular importe total
			$intTotal = $intSubTotal + $intImporteIva + $intImporteIeps;

            //Convertir cantidad a formato moneda
            $arrDet->cantidad = number_format($intCantidad,2);
            $arrDet->costo_unitario = number_format($intCostoUnitario,2);
            $arrDet->descuento_unitario = number_format($intDescuentoUnitario,2);
            $arrDet->subtotal = number_format($intSubTotal,2);
            $arrDet->importe_iva = number_format($intImporteIva,$this->intNumDecimales);
            $arrDet->importe_ieps = number_format($intImporteIeps, $this->intNumDecimales);
            $arrDet->total = number_format($intTotal, $this->intNumDecimales);

            //Si el estatus del registro es INACTIVO
			if($arrDet->estatus == 'INACTIVO')
			{
				$arrDet->estiloRegistro = 'registro-INACTIVO';
			}
		}

		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['detalles'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows'],
						  'acumulado_cantidad' => $intAcumUnidades,
						  'acumulado_descuento' => $intAcumDescuento,
						  'acumulado_subtotal' => $intAcumSubtotal,
						  'acumulado_iva' => $intAcumIva,
						  'acumulado_ieps' => $intAcumIeps,
						  'acumulado_total' => $intAcumTotal);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}
}