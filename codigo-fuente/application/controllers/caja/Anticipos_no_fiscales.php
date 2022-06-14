<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anticipos_no_fiscales extends MY_Controller {
	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de anticipos no fiscales
		$this->load->model('caja/anticipos_no_fiscales_model', 'anticipos');
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
		$this->cargar_vista('caja/anticipos_no_fiscales', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->anticipos->filtro($this->input->post('dteFechaInicial'),
										   $this->input->post('dteFechaFinal'),
										   $this->input->post('intProspectoID'),
										   trim($this->input->post('strEstatus')),
									  	   trim($this->input->post('strBusqueda')),
			                               $config['per_page'],
			                               $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['anticipos'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			$arrDet->mostrarAccionGenerarPoliza = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro =  'registro-'.$arrDet->estatus;

			//Si el estatus del registro es ACTIVO
			if($arrDet->estatus == 'ACTIVO')
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
			else
			{
				//Si el usuario cuenta con el permiso de acceso VER REGISTRO
				if (in_array('VER REGISTRO', $arrPermisos))
				{
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
		$arrDatos = array('rows' => $result['anticipos'],
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
		$objAnticipoNoFiscal = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Datos del anticipo
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objAnticipoNoFiscal->intAnticipoNoFiscalID = $this->input->post('intAnticipoNoFiscalID');
		$objAnticipoNoFiscal->dteFecha = $this->input->post('dteFecha');
		$objAnticipoNoFiscal->intMonedaID = $this->input->post('intMonedaID');
		$objAnticipoNoFiscal->intTipoCambio = $this->input->post('intTipoCambio');
		$objAnticipoNoFiscal->intProspectoID = $this->input->post('intProspectoID');
		$objAnticipoNoFiscal->strRazonSocial =  mb_strtoupper(trim($this->input->post('strRazonSocial')));
		$objAnticipoNoFiscal->strRfc =  mb_strtoupper(trim($this->input->post('strRfc')));
		$objAnticipoNoFiscal->strCalle =  mb_strtoupper(trim($this->input->post('strCalle')));
		$objAnticipoNoFiscal->strNumeroExterior = mb_strtoupper($this->input->post('strNumeroExterior'));
		$objAnticipoNoFiscal->strNumeroInterior = mb_strtoupper($this->input->post('strNumeroInterior'));
		$objAnticipoNoFiscal->strCodigoPostal = $this->input->post('strCodigoPostal');
		$objAnticipoNoFiscal->strColonia =  mb_strtoupper(trim($this->input->post('strColonia')));
		$objAnticipoNoFiscal->strLocalidad =  mb_strtoupper(trim($this->input->post('strLocalidad')));
		$objAnticipoNoFiscal->strMunicipio = mb_strtoupper(trim($this->input->post('strMunicipio')));
		$objAnticipoNoFiscal->strEstado =  mb_strtoupper(trim($this->input->post('strEstado')));
		$objAnticipoNoFiscal->strPais = mb_strtoupper(trim($this->input->post('strPais')));		
		$objAnticipoNoFiscal->intModuloID =$this->input->post('intModuloID');
		$objAnticipoNoFiscal->strConcepto = mb_strtoupper(trim($this->input->post('strConcepto')));
		$objAnticipoNoFiscal->intSubtotal =$this->input->post('intSubtotal');
		$objAnticipoNoFiscal->intTasaCuotaIva =$this->input->post('intTasaCuotaIva');
		$objAnticipoNoFiscal->intIva =  $this->input->post('intIva');
		$objAnticipoNoFiscal->intTasaCuotaIeps = (($this->input->post('intTasaCuotaIeps') !== '') ? 
						   	   			   $this->input->post('intTasaCuotaIeps') : NULL); 
		$objAnticipoNoFiscal->intIeps = $this->input->post('intIeps');
		$objAnticipoNoFiscal->intFormaPagoID = $this->input->post('intFormaPagoID');
		$objAnticipoNoFiscal->intCuentaBancariaID = $this->input->post('intCuentaBancariaID');
		$objAnticipoNoFiscal->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objAnticipoNoFiscal->intSucursalID = $this->session->userdata('sucursal_id');
		$objAnticipoNoFiscal->intUsuarioID = $this->session->userdata('usuario_id');
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objAnticipoNoFiscal->intAnticipoNoFiscalID))
		{
			$bolResultado = $this->anticipos->modificar($objAnticipoNoFiscal);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objAnticipoNoFiscal->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objAnticipoNoFiscal->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->anticipos->guardar($objAnticipoNoFiscal);

				/*Quitar '_'  de la cadena (resultadoTransaccion_anticipoNoFiscalID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $objAnticipoNoFiscal->intAnticipoNoFiscalID) = explode("_", $bolResultado); 
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
							 	  'anticipo_no_fiscal_id' => $objAnticipoNoFiscal->intAnticipoNoFiscalID,
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
		$intID = $this->input->post('intAnticipoNoFiscalID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->anticipos->buscar($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{

			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intAnticipoNoFiscalID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intAnticipoNoFiscalID');
	        $intPolizaID = $this->input->post('intPolizaID');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->anticipos->set_estatus($intID, $intPolizaID);
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
		$intProspectoID = $this->input->post('intProspectoID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));


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
		$otdResultado = $this->anticipos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, 
		 										 $strEstatus, $strBusqueda);
		//Seleccionar los datos de las monedas que coinciden con el parámetro enviado
		$otdMonedas = $this->anticipos->buscar_distintas_monedas($dteFechaInicial, $dteFechaFinal, $intProspectoID, 
																  $strEstatus, $strBusqueda);
		//Si existe rango de fechas
		if($dteFechaInicial !== '' && $dteFechaFinal !== '')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C'). ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
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
		$pdf->strLinea1 =  'LISTADO DE RECIBOS INTERNOS DE ANTICIPO  '.$strTituloRangoFechas;
		//Si existe id del cliente
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del cliente que coincide con el id
			$otdProspecto =  $this->clientes->buscar($intProspectoID);
			$pdf->strLinea2 = utf8_decode('RAZÓN SOCIAL: '.$otdProspecto->razon_social);
		}

		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', utf8_decode('RAZÓN SOCIAL'), 'FECHA',
							      'CONCEPTO', 'SUBTOTAL', 'IVA', 'TOTAL', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(20, 35, 15, 40, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'L', 'R', 'R', 'R',  'C');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
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

			//Recorremos el arreglo para obtener la información de los anticipos
			foreach ($otdResultado as $arrCol)
			{ 
				//Convertir peso mexicano a tipo de cambio
				$intSubTotal = ($arrCol->subtotal / $arrCol->tipo_cambio);
				$intImporteIva = ($arrCol->iva / $arrCol->tipo_cambio);
				$intImporteIeps = ($arrCol->ieps / $arrCol->tipo_cambio);

				//Calcular importe total
				$intTotal = $intSubTotal + $intImporteIva + $intImporteIeps;
	
				//Incrementar valores de los siguientes arrays
				$arrSubtotalEstatus[$arrCol->estatus] += ($intSubTotal * $arrCol->tipo_cambio);
		      	$arrIvaEstatus[$arrCol->estatus] += ($intImporteIva * $arrCol->tipo_cambio);
		      	$arrIepsEstatus[$arrCol->estatus] += ($intImporteIeps * $arrCol->tipo_cambio);
		      	$arrTotalEstatus[$arrCol->estatus] += ($intTotal* $arrCol->tipo_cambio);

		      	//Si el id de la moneda no corresponde al peso mexicano
		      	if($arrCol->moneda_id != MONEDA_BASE)
		      	{
		      		//Incrementar valores de los siguientes arrays
			      	$arrSubtotalMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intSubTotal;
			      	$arrIvaMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intImporteIva;
			      	$arrIepsMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intImporteIeps;
			      	$arrTotalMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intTotal;
			      	$arrTotalRegistrosMoneda[$arrCol->moneda_id] += 1;
		      	}
				
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, utf8_decode($arrCol->razon_social), $arrCol->fecha,
					 			utf8_decode($arrCol->concepto), '$'.number_format($intSubTotal,2),
								'$'.number_format($intImporteIva,2),
								'$'.number_format($intTotal,2), $arrCol->estatus), 
								$pdf->arrAlineacion, 'ClippedCell');
		        //Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
				//Moneda
				$pdf->Cell(12, 4, 'MONEDA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(7, 4, utf8_decode($arrCol->codigo_moneda), 0, 0, 'L', 0);
		    	//Tipo de cambio
		    	$pdf->Cell(6, 4, 'T.C.:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(12, 4,'$'.number_format($arrCol->tipo_cambio, 4, '.', ','), 0, 0, 'R', 0);
			    //Forma de pago
		    	$pdf->Cell(20, 4, 'FORMA DE PAGO:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(40, 4,utf8_decode($arrCol->forma_pago), 0, 0, 'L', 0);
			    //Cuenta bancaria
		    	$pdf->Cell(22, 4, 'CUENTA BANCARIA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(70, 4,utf8_decode($arrCol->cuenta_bancaria), 0, 0, 'L', 0);
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
			$arrAnchuraResumen = array(33, 25, 25, 25, 25);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacionResumen = array('L', 'R', 'R', 'R', 'R');
			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Creación de la tabla Resumen
			$pdf->Cell(133, 4, 'RESUMEN GENERAL EN PESOS', 0, 0, 'C', TRUE);
			$pdf->Ln(4);//Deja un salto de linea
			//Recorre el array de titulos de encabezado para crearlos
			for ($intCont = 0; $intCont < count($arrCabeceraResumen); $intCont++)
			{
				//inserta los titulos de la cabecera
				$pdf->Cell($arrAnchuraResumen[$intCont], 5, $arrCabeceraResumen[$intCont], 1, 0, $arrAlineacionResumen[$intCont], TRUE);
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
					$pdf->Row(array($arrEst,'$'.number_format($arrSubtotalEstatus[$arrEst],2), 
									'$'.number_format($arrIvaEstatus[$arrEst],2), 
			    				    '$'.number_format($arrIepsEstatus[$arrEst],2), 
			    				    '$'.number_format($arrTotalEstatus[$arrEst],2)), 
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
            $pdf->Cell(21,3,$intContador, 0, 0, 'R');
            //Acumulado del subtotal
            $pdf->Cell(25,3,'$'.number_format($intAcumSubtotalEstatus,2), 0, 0, 'R');
            //Acumulado del IVA
            $pdf->Cell(25,3,'$'.number_format($intAcumIvaEstatus,2), 0, 0, 'R');
           //Acumulado del IEPS
            $pdf->Cell(25,3,'$'.number_format($intAcumIepsEstatus,2), 0, 0, 'R');
            //Acumulado del importe total
            $pdf->Cell(25,3,'$'.number_format($intAcumTotalEstatus,2), 0, 0, 'R');
            $pdf->Ln(8);//Deja un salto de línea*/

            //Hacer recorrido para obtener el resumen por cada tipo de moneda
			foreach ($otdMonedas as $arrMon) 
			{
				//Limpiar las siguientes variables (por cada moneda recorrida)
				$intAcumSubtotalEstatus = 0;
				$intAcumIvaEstatus = 0;
				$intAcumIepsEstatus = 0;
				$intAcumTotalEstatus = 0;

				//Asigna el tipo y tamaño de letra para la cabecera de la tabla
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Creación de la tabla Resumen
				$pdf->ClippedCell(133, 4, 'RESUMEN POR MONEDA '.$arrMon->descripcion, 0, 0, 'C', TRUE);
			    $pdf->Ln(4);//Deja un salto de linea
				
				//Recorre el array de titulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabeceraResumen); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchuraResumen[$intCont], 5, $arrCabeceraResumen[$intCont], 1, 0, $arrAlineacionResumen[$intCont], TRUE);
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
						$pdf->Row(array($arrEst,'$'.number_format($arrSubtotalMoneda[$arrMon->moneda_id][$arrEst],2), 
										'$'.number_format($arrIvaMoneda[$arrMon->moneda_id][$arrEst],2), 
				    				    '$'.number_format($arrIepsMoneda[$arrMon->moneda_id][$arrEst],2), 
				    				    '$'.number_format($arrTotalMoneda[$arrMon->moneda_id][$arrEst],2)), 
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
	            $pdf->Cell(21,3,$arrTotalRegistrosMoneda[$arrMon->moneda_id], 0, 0, 'R');
	            //Acumulado del subtotal
	            $pdf->Cell(25,3,'$'.number_format($intAcumSubtotalEstatus,2), 0, 0, 'R');
	            //Acumulado del IVA
	            $pdf->Cell(25,3,'$'.number_format($intAcumIvaEstatus,2), 0, 0, 'R');
	           //Acumulado del IEPS
	            $pdf->Cell(25,3,'$'.number_format($intAcumIepsEstatus,2), 0, 0, 'R');
	            //Acumulado del importe total
	            $pdf->Cell(25,3,'$'.number_format($intAcumTotalEstatus,2), 0, 0, 'R');
	            $pdf->Ln(8);//Deja un salto de línea
			}
		}
		//Ejecutar la salida del reporte
		$pdf->Output('recibos_internos_anticipo.pdf','I'); 
	}

	//Método para generar un archivo PDF con los datos de timbrado
	public function get_reporte_registro()
	{
		
		//Variables que se utilizan para recuperar los valores de la vista
		$intAnticipoNoFiscalID = $this->input->post('intAnticipoNoFiscalID');

        //Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->anticipos->buscar($intAnticipoNoFiscalID);
		//Asignar el nombre del archivo PDF
		$strNombreArchivo = $otdResultado->folio.'.pdf';
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variable que se utiliza para asignar el acumulado del subtotal
		$intAcumSubtotal = 0;
		//Variable que se utiliza para asignar el acumulado del IVA
		$intAcumIva = 0;
		//Variable que se utiliza para asignar el acumulado del IEPS
		$intAcumIeps = 0;
		$arrIVA = Array();
		$numEleIVA = 0;
		$arrIEPS = Array();
		$numEleIEPS = 0;
		//Variable que se utiliza para asignar el acumulado del descuento
		$intAcumDescuento = 0;
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'recibo_interno_anticipo_';
		//Agregar la primer pagina
		$pdf->AddPage();
		//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
		$this->get_encabezado_archivo_pdf($pdf, 'FISCAL');

		//Verificar si hay información del registro
		if($otdResultado)
		{	
			//Hacer un llamado a la función para mostrar imagen del estatus (INACTIVO/TIMBRAR)
			$this->get_img_estatus_archivo_pdf($pdf, $otdResultado->estatus);

			//------------------------------------------------------------------------------------------------------------------------
	        //----------  DATOS DEL CLIENTE
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 42);
			$pdf->ClippedCell(92, 3, 'RECEPTOR', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0); //establece el color de texto
			//RFC
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, 46);
			$pdf->ClippedCell(10, 3, 'RFC');
			//Nombre comercial
			$pdf->SetXY(15, 49);
			$pdf->ClippedCell(22, 03, 'NOMBRE');
			//Módulo
			$pdf->SetXY(15, 58);
			$pdf->ClippedCell(60, 3, 'ANTICIPO DE CLIENTE PARA');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//RFC
			$pdf->SetXY(25, 46);
			$pdf->ClippedCell(30, 3, $otdResultado->rfc);
			//Nombre comercial y razón social
			//Variable que se utiliza para concatenar los datos del cliente
			$strCliente = $otdResultado->CodigoProspecto.' '.$otdResultado->razon_social;
			$pdf->SetXY(15, 52);
			$pdf->MultiCell(92, 3, utf8_decode($strCliente));
			//Asignar descripción del módulo
			$strModulo = $otdResultado->modulo;

			//Si el porcentaje de IVA es cero
			if($otdResultado->porcentaje_iva == PORCENTAJE_IVA_CERO)
			{
				//Concatenar porcentaje de IVA (0.000000)
				$strModulo .= ' 0%';
			}
			else 
			{
				//Concatenar porcentaje de IVA (0.160000)
				$strModulo .= ' 16%';
			}

			//Módulo
			$pdf->SetXY(15, 61);
			$pdf->MultiCell(92, 3, utf8_decode($strModulo));

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL ANTICIPO 
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(108, 42);
			$pdf->ClippedCell(92, 3, utf8_decode('RECIBO INTERNO DE ANTICIPO'), 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0);//establece el color de texto
		
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, 46);
			$pdf->ClippedCell(15, 3, 'FOLIO');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(135, 46);
			$pdf->ClippedCell(64, 3, $otdResultado->folio);
			//Fecha
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(160, 46);
			$pdf->ClippedCell(15, 3, 'FECHA');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(184, 46);
			$pdf->ClippedCell(29, 3, $otdResultado->fecha);
			
			//Moneda
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, 49);
			$pdf->ClippedCell(15, 3, 'MONEDA');
			//Tipo de cambio
			$pdf->SetXY(160, 49);
			$pdf->ClippedCell(25, 3, 'TIPO DE CAMBIO');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Información 
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Moneda
			$pdf->SetXY(135, 49);
			$pdf->ClippedCell(29, 3, $otdResultado->codigo_moneda);
			//Tipo de cambio
			$pdf->SetXY(184, 49);
			$pdf->ClippedCell(20, 3, '$'.number_format($otdResultado->tipo_cambio, 4, '.', ','));
			//Forma de pago
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, 52);
			$pdf->ClippedCell(32, 3, 'FORMA DE PAGO');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(135, 52);
			$pdf->ClippedCell(60, 3, utf8_decode($otdResultado->forma_pago));
			//Cuenta bancaria
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, 55);
			$pdf->ClippedCell(32, 3, 'CUENTA BANCARIA');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(135, 55);
			$pdf->ClippedCell(64, 3, utf8_decode($otdResultado->cuenta_bancaria));
			
			//Variable que se utiliza para asignar el tipo de cambio
			$intTipoCambio = (float)$otdResultado->tipo_cambio;
			
			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DEL ANTICIPO
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 67);
			$pdf->ClippedCell(185, 3, 'CONCEPTOS', 0, 0, 'C', TRUE);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Tabla con los detalles del anticipo
			$pdf->SetXY(15, 71);
			//Crea los titulos de la cabecera
			$arrCabecera = array('Cantidad', utf8_decode('Descripción'), 'Unitario', 'Importe');
			//Establece el ancho de las columnas de cabecera
			$arrAnchura = array(15, 120, 25, 25);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacion = array('R', 'L', 'R', 'R');
			//Recorre el array de títulos de encabezado para crearlos
			for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
			{
				//inserta los titulos de la cabecera
				$pdf->Cell($arrAnchura[$intCont], 3, $arrCabecera[$intCont], 1, 0, $arrAlineacion[$intCont], TRUE);
			}
			$pdf->Ln(); //Deja un salto de línea
			$intPosY = $pdf->GetY();
			$pdf->SetXY(15, $intPosY);
			//Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchura);
			//Variable que se utiliza para asignar el tipo de cambio
			$intTipoCambio = (float)$otdResultado->tipo_cambio;
			 
			$pdf->SetX(15);
			//Variables que se utilizan para asignar valores del detalle
			$intCantidad = 1;
			$intPrecioUnitario = $otdResultado->subtotal;
			$intIvaUnitario = $otdResultado->iva;
			$intIepsUnitario = $otdResultado->ieps;
			
			//Convertir peso mexicano a tipo de cambio
			$intPrecioUnitario = ($intPrecioUnitario / $intTipoCambio);
			$intIvaUnitario = ($intIvaUnitario / $intTipoCambio);
			$intIepsUnitario = ($intIepsUnitario / $intTipoCambio);
			$intSubTotalUnitario = $intPrecioUnitario;
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
			$intSubTotalUnitario = $intCantidad * $intSubTotalUnitario;
			//Convertir cantidad a dos decimales
			$intPrecioUnitario = number_format($intPrecioUnitario, 2, '.', '');
			$intIvaUnitario = number_format($intIvaUnitario, 2, '.', '');
			$intIepsUnitario = number_format($intIepsUnitario, 2, '.', '');
			$intSubTotalUnitario = number_format($intSubTotalUnitario, 2, '.', '');
			$intImporteIva = number_format($intImporteIva, 2, '.', '');
			$intImporteIeps = number_format($intImporteIeps, 2, '.', '');
			//Convertir cantidad a seis decimales
			$intPorcentajeIva = number_format($otdResultado->porcentaje_iva, 6, '.', '');
			$intPorcentajeIeps = number_format($otdResultado->porcentaje_ieps, 6, '.', '');
			//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
			$pdf->Row(array(number_format($intCantidad,2),   utf8_decode($otdResultado->concepto), 
						    $intPrecioUnitario, $intSubTotalUnitario), $arrAlineacion);

			//Incrementar acumulados
			$intAcumSubtotal += $intSubTotalUnitario;
			$intAcumIva += $intImporteIva;
			$intAcumIeps += $intImporteIeps;
			//Array que contiene el impuesto de IVA
			$bolEntroIVA = FALSE;
			for ($intConIVA = 0; $intConIVA < $numEleIVA; $intConIVA++)
			{
				if ($arrIVA[$intConIVA][2] == $intPorcentajeIva)
				{
					$arrIVA[$intConIVA][3] += $intImporteIva;
					$bolEntroIVA = TRUE;
					$intConIVA = $numEleIVA;
				}
			}
			if (!$bolEntroIVA)
			{
				$arrIVA[$numEleIVA][0] = $otdResultado->ImpuestoIva.' IVA';
				$arrIVA[$numEleIVA][1] = $otdResultado->FactorIva;
				$arrIVA[$numEleIVA][2] = $intPorcentajeIva;
				$arrIVA[$numEleIVA][3] = $intImporteIva;
				
				$numEleIVA++;
			}
			//Si existe importe de IEPS
			if ($intImporteIeps > 0)
			{
			    //Array que contiene el impuesto de IEPS
				$bolEntroIEPS = FALSE;
				for ($intConIEPS = 0; $intConIEPS < $numEleIEPS; $intConIEPS++)
				{
					if ($arrIEPS[$intConIEPS][2] == $intPorcentajeIeps)
					{
						$arrIEPS[$intConIEPS][3] += $intImporteIeps;
						$bolEntroIEPS = TRUE;
						$intConIEPS = $numEleIEPS;
					}
				}
				if (!$bolEntroIEPS)
				{
					$arrIEPS[$numEleIEPS][0] = $arrDet->ImpuestoIeps.' IEPS';
					$arrIEPS[$numEleIEPS][1] = $arrDet->FactorIeps;
					$arrIEPS[$numEleIEPS][2] = $intPorcentajeIeps;
					$arrIEPS[$numEleIEPS][3] = $intImporteIeps;
					$numEleIEPS++;
				}
			}

			//Calcular importe total
			$intTotal = $intAcumSubtotal + $intAcumIva + $intAcumIeps;
			//Redondear importe total a dos decimales
			$intTotal = number_format($intTotal,2);
			$pdf->Ln(2); //Deja un salto de línea
			//Asignar la posición de los totales
			$intPosYTotales = $pdf->GetY();


			//Reestablecer posición
			$pdf->SetXY(15, $intPosYTotales);
			//------------------------------------------------------------------------------------------------------------------------
			//---------- INFORMACIÓN DE IMPUESTOS TRASLADOS
			//------------------------------------------------------------------------------------------------------------------------
		
			//Variable que se utiliza para formar cadena de impuestos trasladados
			$strCadenaTraslado = 'Base:';
			//--a. Base
			$strCadenaTraslado.= number_format(($intAcumSubtotal), 2, '.', '')."|";
			//---------- IVA
			for ($intConIVA = 0; $intConIVA < $numEleIVA; $intConIVA++)
			{
				$strCadenaTraslado.= "Impuesto:";//--a. Impuesto
				$strCadenaTraslado.= $arrIVA[$intConIVA][0]."|";//--a. Impuesto
				$strCadenaTraslado.= "Tipo Factor:";//--b. TipoFactor
				$strCadenaTraslado.= $arrIVA[$intConIVA][1]."|";//--b. TipoFactor
				$strCadenaTraslado.= "Tasa o Cuota:";//--c. TasaOCuota
				$strCadenaTraslado.= $arrIVA[$intConIVA][2]."|";//--c. TasaOCuota
				$strCadenaTraslado.= "Importe:";//--d. Importe
				$strCadenaTraslado.= number_format($arrIVA[$intConIVA][3], 2, '.', '');//--d. Importe
			}
			//---------- IEPS
			for ($intConIEPS = 0; $intConIEPS < $numEleIEPS; $intConIEPS++)
			{
				$strCadenaTraslado.= "|";
				$strCadenaTraslado.= "Impuesto:";//--a. Impuesto
				$strCadenaTraslado.= $arrIEPS[$intConIEPS][0]."|";//--a. Impuesto
				$strCadenaTraslado.= "Tipo Factor:";//--b. TipoFactor
				$strCadenaTraslado.= $arrIEPS[$intConIEPS][1]."|";//--b. TipoFactor
				$strCadenaTraslado.= "Tasa o Cuota:";//--c. TasaOCuota
				$strCadenaTraslado.= $arrIEPS[$intConIEPS][2]."|";//--c. TasaOCuota
				$strCadenaTraslado.= "Importe:";//--d. Importe
				$strCadenaTraslado.= number_format($arrIEPS[$intConIEPS][3], 2, '.', '');//--d. Importe
			}
			//Cantidad con letra
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_PIE_PAGINA_PDF);
			$pdf->ClippedCell(22, 3, 'Impuestos Traslados:', 0, 0, 'L');
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
			$pdf->ClippedCell(163, 3, $strCadenaTraslado, 0, 0, 'L');
			$pdf->Ln(7); //Deja un salto de línea
			$pdf->SetX(15);

			//Cantidad con letra
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->ClippedCell(60, 3, 'CANTIDAD CON LETRA');
			$pdf->Ln(); //Deja un salto de línea
			$pdf->SetX(15);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->MultiCell(185, 3, 'SON: (' .$AifLibNumber->toCurrency($intTotal, $otdResultado->codigo_moneda) . ')');
			//Cambiar color de relleno de la celda
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
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
			$pdf->SetX(175);
			$pdf->ClippedCell(25, 3, '$'.number_format($intAcumSubtotal,2), 0, 0, 'R');
			$pdf->Ln(); //Deja un salto de línea
			$intPosY = $pdf->GetY();
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(135, $intPosY);

			//IVA
			if($otdResultado->porcentaje_iva != NULL)
			{
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, $otdResultado->ImpuestoIva.' '.'IVA'.' '.'TASA'.' '.$otdResultado->porcentaje_iva);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIva,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
			}
			//IEPS
			if($otdResultado->porcentaje_ieps != NULL)
			{
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, $otdResultado->ImpuestoIeps.' '.'IEPS'.' '.'TASA'.' '.$otdResultado->porcentaje_ieps);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIeps,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
			}
		
			//Total
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(135);
			$pdf->ClippedCell(30, 3, 'TOTAL');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(175);
			$pdf->ClippedCell(25, 3, '$'.$intTotal, 0, 0, 'R');
			//Observaciones
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, $intPosY);
			$pdf->MultiCell(110, 3, utf8_decode($otdResultado->observaciones));
		
			 //Fecha y hora de impresión (pie de pagina)
			$pdf->strUsuarioCreacion = $otdResultado->usuario_creacion;
			$pdf->dteFechaCreacion = $otdResultado->fecha_creacion;
			$pdf->strIncluirMembrete = 'SI';
			
		}//Cierre de verificación de información

		//Concatenar folio para identificar orden de compra
		$strNombreArchivo .= $otdResultado->folio;

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
		$intProspectoID = $this->input->post('intProspectoID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));

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
		$otdResultado = $this->anticipos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID,  
												 $strEstatus,  $strBusqueda);
		//Si existe rango de fechas
		if($dteFechaInicial !== '' && $dteFechaFinal !== '')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C'). ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		}
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE RECIBOS INTERNOS DE ANTICIPO  '.$strTituloRangoFechas);
		//Si existe id del cliente
		if($intProspectoID > 0)
		{   //Seleccionar los datos del cliente que coincide con el id
			$otdProspecto =  $this->clientes->buscar($intProspectoID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'RAZÓN SOCIAL: '.$otdProspecto->razon_social);
		}
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'RAZÓN SOCIAL')
        		 ->setCellValue('C'.$intPosEncabezados, 'RFC')
        		 ->setCellValue('D'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('E'.$intPosEncabezados, 'CONCEPTO')
        		 ->setCellValue('F'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('G'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('H'.$intPosEncabezados, 'TOTAL')
        		 ->setCellValue('I'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('J'.$intPosEncabezados, 'T.C.')
        		 ->setCellValue('K'.$intPosEncabezados, 'FORMA DE PAGO')
        		 ->setCellValue('L'.$intPosEncabezados, 'CUENTA BANCARIA')
        		 ->setCellValue('M'.$intPosEncabezados, 'ANTICIPO DE CLIENTE PARA')
        		 ->setCellValue('N'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('O'.$intPosEncabezados, 'ESTATUS');
        //Definir estilo de las celdas correspondientes a los encabezados
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
    			 ->getStyle('A10:O10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

    	//Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:O10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:O10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   

				//Convertir peso mexicano a tipo de cambio
				$intSubtotal = ($arrCol->subtotal / $arrCol->tipo_cambio);
				$intImporteIva = ($arrCol->iva / $arrCol->tipo_cambio);
				$intImporteIeps = ($arrCol->ieps / $arrCol->tipo_cambio);
				//Calcular importe total
				$intImporteTotal = $intSubtotal + $intImporteIva + $intImporteIeps;
				//Asignar descripción del módulo
				$strModulo = $arrCol->modulo;

				//Si el porcentaje de IVA es cero
				if($arrCol->porcentaje_iva == PORCENTAJE_IVA_CERO)
				{
					//Concatenar porcentaje de IVA (0.000000)
					$strModulo .= ' 0%';
				}
				else 
				{
					//Concatenar porcentaje de IVA (0.160000)
					$strModulo .= ' 16%';
				}

				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
                         ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->razon_social)
                         ->setCellValue('C'.$intFila, $arrCol->rfc)
                         ->setCellValue('D'.$intFila, $arrCol->fecha)
                         ->setCellValue('E'.$intFila, $arrCol->concepto)
                         ->setCellValue('F'.$intFila, $intSubtotal)
                         ->setCellValue('G'.$intFila, $intImporteIva)
                         ->setCellValue('H'.$intFila, $intImporteTotal)
                         ->setCellValue('I'.$intFila, $arrCol->moneda)
                         ->setCellValue('J'.$intFila, $arrCol->tipo_cambio)
                         ->setCellValue('K'.$intFila, $arrCol->forma_pago)
                         ->setCellValue('L'.$intFila, $arrCol->cuenta_bancaria)
                         ->setCellValue('M'.$intFila, $strModulo)
                         ->setCellValue('N'.$intFila, $arrCol->observaciones)
                         ->setCellValue('O'.$intFila, $arrCol->estatus);

                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}
			
			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('F'.$intFilaInicial.':'.'H'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            //Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.0000');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('F'.$intFilaInicial.':'.'H'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);		

            $objExcel->getActiveSheet()
		        	 ->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);
                	  
			$objExcel->getActiveSheet()
                	 ->getStyle('O'.$intFilaInicial.':'.'O'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('O'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('O'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'recibos_internos_anticipo.xls', 'anticipos', $intFila);
	}
}