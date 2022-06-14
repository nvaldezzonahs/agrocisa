<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes_reparacion_internas extends MY_Controller {
	//Variable para identificar el tipo de movimiento
	var $intTipoMovimiento = SALIDA_REFACCIONES_INTERNAS;
	var $intTipoMovimientoDev = ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER; 

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
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
		$this->cargar_vista('control_vehiculos/ordenes_reparacion_internas', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->ordenes->filtro($this->input->post('dteFechaInicial'),
									     $this->input->post('dteFechaFinal'),
									     $this->input->post('intVehiculoID'),
									     trim($this->input->post('strEstatus')),
									     trim($this->input->post('strBusqueda')),
		                                 $config['per_page'],
		                                 $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['ordenes'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionFinalizar = 'no-mostrar';
			$arrDet->mostrarAccionReactivar = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			$arrDet->mostrarAccionGenerarPoliza = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;

            //Verificar existencia de la póliza
		    if($arrDet->poliza_id == 0 && $arrDet->estatus == 'FINALIZADO')
		    {
		    	//Asignar cadena vacia para mostrar botón Generar póliza
		    	$arrDet->mostrarAccionGenerarPoliza = '';
		    }


	    	//Si el estatus del registro es ACTIVO
			if($arrDet->estatus == 'ACTIVO')
	    	{
	    		//Si el usuario cuenta con el permiso de acceso EDITAR
				if (in_array('EDITAR', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Editar
					$arrDet->mostrarAccionEditar = '';
				}

				//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
				if (in_array('CAMBIAR ESTATUS', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Desactivar
					$arrDet->mostrarAccionDesactivar = '';
				}

				//Si el usuario cuenta con el permiso de acceso FINALIZAR ORDEN DE REPARACION
				if (in_array('FINALIZAR ORDEN DE REPARACION', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Finalizar
					$arrDet->mostrarAccionFinalizar = '';
				}

	    	}
	    	else 
	    	{
	    		//Si el usuario cuenta con el permiso de acceso VER REGISTRO
				if (in_array('VER REGISTRO', $arrPermisos))
				{
					$arrDet->mostrarAccionVerRegistro = '';
				}

				//Si el estatus del registro es FINALIZADO
				if($arrDet->estatus == 'FINALIZADO')
				{
					//Si el usuario cuenta con el permiso de acceso REACTIVAR ORDEN DE REPARACION
					if (in_array('REACTIVAR ORDEN DE REPARACION', $arrPermisos))
					{
						//Asignar cadena vacia para mostrar botón Reactivar
						$arrDet->mostrarAccionReactivar = '';
					}
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
		$arrDatos = array('rows' => $result['ordenes'],
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
		$objOrdenReparacionInterna = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Datos de la orden de reparación 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
		$objOrdenReparacionInterna->intOrdenReparacionInternaID = $this->input->post('intOrdenReparacionInternaID');
		$objOrdenReparacionInterna->dteFecha = $this->input->post('dteFecha');
		$objOrdenReparacionInterna->intServicioInternoTipoID = $this->input->post('intServicioInternoTipoID');
		//Si no existe id del vehículo asignar valor nulo
		$objOrdenReparacionInterna->intVehiculoID = (($this->input->post('intVehiculoID') !== '') ? 
						   	   						  $this->input->post('intVehiculoID') : NULL);
		$objOrdenReparacionInterna->strSerie = mb_strtoupper(trim($this->input->post('strSerie')));
		$objOrdenReparacionInterna->strMotor = mb_strtoupper(trim($this->input->post('strMotor')));
		$objOrdenReparacionInterna->intKilometraje = $this->input->post('intKilometraje');
		$objOrdenReparacionInterna->strFalla = mb_strtoupper(trim($this->input->post('strFalla')));
		$objOrdenReparacionInterna->strCausa = mb_strtoupper(trim($this->input->post('strCausa')));
		$objOrdenReparacionInterna->strSolucion = mb_strtoupper(trim($this->input->post('strSolucion')));
		$objOrdenReparacionInterna->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objOrdenReparacionInterna->intSucursalID = $this->session->userdata('sucursal_id');
		$objOrdenReparacionInterna->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los servicios
		$objOrdenReparacionInterna->strServicioInternoID =  $this->input->post('strServicioInternoID');
		$objOrdenReparacionInterna->strHoras = $this->input->post('strHoras');
		$objOrdenReparacionInterna->strMecanicoInternoID = $this->input->post('strMecanicoInternoID');
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objOrdenReparacionInterna->intOrdenReparacionInternaID))
		{
			$bolResultado = $this->ordenes->modificar($objOrdenReparacionInterna);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objOrdenReparacionInterna->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objOrdenReparacionInterna->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->ordenes->guardar($objOrdenReparacionInterna); 
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
		$intID = $this->input->post('intOrdenReparacionInternaID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->ordenes->buscar($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
			//Seleccionar los servicios del registro
			$otdServicios = $this->ordenes->buscar_servicios($intID);
			//Si existe servicios del registro, se asignan al array
			if($otdServicios)
			{
				$arrDatos['servicios'] = $otdServicios;
			}
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intOrdenReparacionInternaID', 'ID', 'required|integer');
		$this->form_validation->set_rules('strEstatus', 'Estatus', 'required');
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
	        $intID = $this->input->post('intOrdenReparacionInternaID');
		    $strEstatus = $this->input->post('strEstatus');
		    $intPolizaID = $this->input->post('intPolizaID');

		    //Si el estatus es ACTIVO o INACTIVO
		    if($strEstatus == 'ACTIVO' OR $strEstatus == 'INACTIVO')
		    {
		    	//Dependiendo del estatus cambiar su valor
		        //ACTIVO a INACTIVO o viceversa
				if ($strEstatus == "ACTIVO")
				{
					$strEstatus = "INACTIVO";
				}
				else
				{
					$strEstatus = "ACTIVO";
				}
		    }

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->ordenes->set_estatus($intID, $strEstatus, $intPolizaID);
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

	//Método para regresar todos los registros activos en un autocomplete
	public function autocomplete()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$strDescripcion = trim($this->input->post('strDescripcion'));

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->ordenes->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
					//Variable que se utiliza para asignar la referencia (vehículo/serie)
					$strReferencia = '';

					//Si existe id del vehículo
					if($arrCol->vehiculo_id > 0)
					{
						//Asignar datos del vehículo
						$strReferencia =  $arrCol->vehiculo;
					}
					else
					{
						//Asignar serie
						$strReferencia =  $arrCol->serie;
					}

		        	$arrDatos[] = array('value' => $arrCol->folio, 
		        						'data' => $arrCol->orden_reparacion_interna_id,
		        					    'referencia' => $strReferencia);
				}

	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}

	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte() 
	{	            
		
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intVehiculoID = $this->input->post('intVehiculoID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strDetalles = $this->input->post('strDetalles');

		//Array que se utiliza para asignar los estatus 
		$arrEstatus = array('ACTIVO', 'FINALIZADO', 'INACTIVO'); 
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
		//Variable que se utiliza pra asignar el id actual de la orden de reparación interna
		$intOrdenReparacionInternaIDActual = 0;
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->ordenes->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intVehiculoID, 								    		   $strEstatus, $strBusqueda);

		//Seleccionar los datos de las monedas que coinciden con el parámetro enviado
		$otdMonedas = $this->ordenes->buscar_distintas_monedas($dteFechaInicial, $dteFechaFinal, 
														       $intVehiculoID, $strEstatus,
														       $strBusqueda);
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal !=  '')
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
		$pdf->strLinea1 = 'LISTADO DE ORDENES DE TRABAJO INTERNAS '.$strTituloRangoFechas;
		//Si existe id del vehículo
		if($intVehiculoID > 0)
		{
			//Seleccionar los datos del vehículo que coincide con el id
			$otdVehiculo =  $this->vehiculos->buscar($intVehiculoID);
			//Concatenar datos del vehículo
			$strVehiculo = $otdVehiculo->codigo.' - '.$otdVehiculo->modelo.' '.$otdVehiculo->marca.' ';
			$strVehiculo .= $otdVehiculo->placas;
			$pdf->strLinea2 =  utf8_decode('VEHÍCULO: '.$strVehiculo);
		}
		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'TIPO DE SERVICIO', 'FECHA', utf8_decode('VEHÍCULO'), 
							      'SERIE','MOTOR', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(18, 37, 15, 30, 40, 30 ,20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'L', 'L', 'L', 'C');

		//Crea los titulos de la cabecera de servicios
		$arrCabeceraServicios = array(utf8_decode('CÓDIGO'), utf8_decode('DESCRIPCIÓN'), 
									  'HORAS', utf8_decode('MECÁNICO'));
		//Establece el ancho de las columnas de la tabla servicios
		$arrAnchuraServicios = array(16, 100, 20, 54);
		//Establece la alineación de las celdas de la tabla servicios
		$arrAlineacionServicios = array('L', 'L', 'R', 'L');
		//Establece el ancho de las columnas de los totales: servicios
		$arrAnchuraTotalesServ = array(16, 120);
		//Establece la alineación de las celdas de la tabla totales: servicios
		$arrAlineacionTotalesServ = array('L', 'R');
		
		//Crea los titulos de la cabecera de salidas de refacciones
		$arrCabeceraSalidasRefacciones = array(utf8_decode('FOLIO'), 'FECHA', utf8_decode('CÓDIGO'), 
											   utf8_decode('DESCRIPCIÓN'), 'CANTIDAD', 'COSTO', 'SUBTOTAL');
		//Establece la alineación de las celdas de la tabla salidas de refacciones
		$arrAnchuraSalidasRefacciones = array(20, 15, 20, 70, 15, 25, 25);
		//Establece la alineación de las celdas de la tabla salidas de refacciones
		$arrAlineacionSalidasRefacciones = array('L', 'C', 'L', 'L', 'R', 'R', 'R');
		//Establece el ancho de las columnas de los totales: refacciones y trabajos foráneos
		$arrAnchuraTotalesRef = array(20, 120, 50);
		//Establece la alineación de las celdas de la tabla totales: refacciones  y trabajos foráneos
		$arrAlineacionTotalesRef = array('L', 'R', 'R');
		
		//Crea los titulos de la cabecera trabajos foráneos
		$arrCabeceraTrabajosForaneos = array(utf8_decode('FOLIO'), 'FECHA', 'PROVEEDOR', 
											 utf8_decode('DESCRIPCIÓN'), 'CANTIDAD', 'COSTO', 'SUBTOTAL');
		//Establece el ancho de las columnas de la tabla trabajos foráneos
		$arrAnchuraTrabajosForaneos = array(16, 15, 49, 45, 15, 25, 25);
		//Establece la alineación de las celdas de la tabla trabajos foráneos
		$arrAlineacionTrabajosForaneos = array('L', 'C', 'L', 'L', 'R', 'R', 'R');
		//Establece el ancho de las columnas de los totales: general
		$arrAnchuraTotalesGral = array(165, 25);
		//Establece la alineación de las celdas de la tabla totales: general
		$arrAlineacionTotalesGral = array('R', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();

		//Establecer el color de fondo para la cabecera
        $pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
        $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Si hay información
		if($otdResultado)
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

			//Recorremos el arreglo para obtener la información de las ordenes de reparación
			foreach ($otdResultado as $arrCol)
			{ 
				
				//Variable que se utiliza para asignar el acumulado del subtotal de la orden de reparación
			    $intAcumSubtotalOrden = 0;
			    //Variable que se utiliza para asignar el acumulado del IVA de la orden de reparación
			    $intAcumIvaOrden = 0;
			    //Variable que se utiliza para asignar el acumulado del IEPS de la orden de reparación
			    $intAcumIepsOrden = 0;

				//Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI' &&  ($intOrdenReparacionInternaIDActual != $arrCol->orden_reparacion_interna_id && $intOrdenReparacionInternaIDActual > 0))
				{
					$pdf->Ln(2);//Deja un salto de línea 
					//Asigna el tipo y tamaño de letra para la cabecera de la tabla
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Recorre el array de titulos de encabezado para crearlos
					for ($intCont = 0; $intCont < count($pdf->arrCabecera); $intCont++)
					{
						$pdf->SetTextColor(COLOR_TEXTO);  //establece el color de texto blanco
						//inserta los titulos de la cabecera
						$pdf->Cell($pdf->arrAnchura[$intCont], 7, $pdf->arrCabecera[$intCont], 1, 0, $pdf->arrAlineacion[$intCont], TRUE);
					}
					$pdf->Ln(); //Deja un salto de línea
				}

				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, utf8_decode($arrCol->servicio_interno_tipo),
								$arrCol->fecha, utf8_decode($arrCol->vehiculo), utf8_decode($arrCol->serie), 
								utf8_decode($arrCol->motor), $arrCol->estatus), 
							    $pdf->arrAlineacion, 'ClippedCell');

				//Array que se utiliza para agregar las salidas de refacciones
		        $arrSalidasRefacciones = array();
		        //Array que se utiliza para agregar los trabajos foráneos
		        $arrTrabajosForaneos = array();
		        //Array que se utiliza para agregar los datos de un detalle
		        $arrAuxiliar = array();

		        //Seleccionar las salidas de refacciones del registro
				$otdSalidasRefacciones = $this->movimientos->buscar_detalles_salida(NULL, NULL, 
																					$this->intTipoMovimiento, 
																					$arrCol->orden_reparacion_interna_id);

				//Verificar si existe información de las salidas de refacciones
				if($otdSalidasRefacciones)
				{
					//Variable que se utiliza para asignar el acumulado de las unidades
					$intAcumUnidadesSR = 0;
					//Variable que se utiliza para asignar el acumulado del subtotal
				    $intAcumSubtotalSR = 0;

				    //Recorremos el arreglo 
			        foreach ($otdSalidasRefacciones as $arrSal) 
			        {
			        	//Variables que se utilizan para asignar valores del detalle
						$intCantidadSurtida = $arrSal->cantidad;
						$intCantidadDevolucion = $arrSal->cantidad_devolucion;
			        	$intCostoUnitario = $arrSal->costo_unitario;
					    //Variable que se utiliza para asignar el importe de iva
						$intImporteIva = 0;
						//Variable que se utiliza para asignar el importe de ieps
						$intImporteIeps = 0;		
					    //Variable que se utiliza para asignar el subtotal 
						$intSubTotalUnitario = 0;

						//Decrementar cantidad devuelta
						$intCantidadFacturar = $intCantidadSurtida - $intCantidadDevolucion;

						//Calcular subtotal
						$intSubTotalUnitario = $intCantidadFacturar * $intCostoUnitario;


						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["folio"] = $arrSal->folio;
						$arrAuxiliar["fecha"] = $arrSal->fecha;
						$arrAuxiliar["folio_requisicion"] = $arrSal->folio_requisicion;
						$arrAuxiliar["codigo"] = utf8_decode($arrSal->codigo);
						$arrAuxiliar["descripcion"] = utf8_decode($arrSal->descripcion);
						$arrAuxiliar["cantidad_solicitada"] = number_format($arrSal->cantidad_solicitada,2);
						$arrAuxiliar["cantidad"] = number_format($intCantidadFacturar,2);
		                $arrAuxiliar["costo_unitario"] = '$'.number_format($intCostoUnitario,2);
		                $arrAuxiliar["subtotal"] = '$'.number_format($intSubTotalUnitario,2);
		                //Asignar datos al array
                        array_push($arrSalidasRefacciones, $arrAuxiliar); 

                        //Incrementar valores de los siguientes arrays
						$arrSubtotalEstatus[$arrCol->estatus] += $intSubTotalUnitario;
				      	$arrTotalEstatus[$arrCol->estatus] += $intSubTotalUnitario;		

					    //Incrementar acumulados por cada registro
					    $intAcumUnidadesSR += $intCantidadFacturar;
					    $intAcumSubtotalSR += $intSubTotalUnitario;
			        }
					
				}//Cierre de verificación de salidas de refacciones

				//Seleccionar los trabajos foráneos del registro
                $otdTrabajosForaneos = $this->trabajos->buscar_detalles(NULL, $arrCol->orden_reparacion_interna_id);

                //Verificar si existe información de los trabajos foráneos 
				if($otdTrabajosForaneos)
				{
					//Variable que se utiliza para asignar el acumulado de las unidades
					$intAcumUnidadesTF = 0;
					//Variable que se utiliza para asignar el acumulado del subtotal
				    $intAcumSubtotalTF = 0;
				    //Variable que se utiliza para asignar el acumulado del IVA
				    $intAcumIvaTF = 0;
				    //Variable que se utiliza para asignar el acumulado del IEPS
				    $intAcumIepsTF = 0;
				    //Recorremos el arreglo 
			        foreach ($otdTrabajosForaneos as $arrTrab) 
			        {
			        	//Variables que se utilizan para asignar valores del detalle
						$intCantidad = $arrTrab->cantidad;
						//Convertir peso mexicano a tipo de cambio
						$intCostoUnitario = ($arrTrab->costo_unitario / $arrTrab->tipo_cambio);
						$intIvaUnitario = ($arrTrab->iva_unitario / $arrTrab->tipo_cambio);
						$intIepsUnitario = ($arrTrab->ieps_unitario / $arrTrab->tipo_cambio);
						$intTasaCuotaIeps = $arrTrab->tasa_cuota_ieps;
				    	$strTipoTasaCuotaIeps = $arrTrab->tipo_ieps;
				    	$strFactorTasaCuotaIeps = $arrTrab->factor_ieps;
				    	//Variable que se utiliza para asignar el subtotal 
						$intSubTotalUnitario = 0;
						//Variable que se utiliza para asignar el importe de IVA
						$intImporteIva = 0;
						//Variable que se utiliza para asignar el importe de IEPS
						$intImporteIeps = 0;

					    //Calcular subtotal
						$intSubTotalUnitario = $intCantidad * $intCostoUnitario;

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
								$intSubTotalUnitario += $intImporteIeps;
								//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
					   	 		$intImporteIeps = 0;
							}
							
						}

						//Calcular importe total
						$intTotal = $intSubTotalUnitario + $intImporteIva + $intImporteIeps;

						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["folio"] = $arrTrab->folio;
						$arrAuxiliar["fecha"] = $arrTrab->fecha;
						$arrAuxiliar["proveedor"] = utf8_decode($arrTrab->proveedor);
						$arrAuxiliar["concepto"] = utf8_decode($arrTrab->concepto);
						$arrAuxiliar["cantidad"] = number_format($intCantidad,2);
		                $arrAuxiliar["costo_unitario"] = '$'.number_format($intCostoUnitario,2);
		                $arrAuxiliar["subtotal"] = '$'.number_format($intSubTotalUnitario,2);
		                //Asignar datos al array
                        array_push($arrTrabajosForaneos, $arrAuxiliar); 

                        //Incrementar valores de los siguientes arrays
						$arrSubtotalEstatus[$arrCol->estatus] += ($intSubTotalUnitario * $arrTrab->tipo_cambio);
				      	$arrIvaEstatus[$arrCol->estatus] += ($intImporteIva * $arrTrab->tipo_cambio);
				      	$arrIepsEstatus[$arrCol->estatus] += ($intImporteIeps * $arrTrab->tipo_cambio);
				      	$arrTotalEstatus[$arrCol->estatus] += ($intTotal* $arrTrab->tipo_cambio);

				      	//Si el id de la moneda no corresponde al peso mexicano
				      	if($arrTrab->moneda_id != MONEDA_BASE)
				      	{
				      		//Incrementar valores de los siguientes arrays
					      	$arrSubtotalMoneda[$arrTrab->moneda_id][$arrCol->estatus] += $intSubTotalUnitario;
					      	$arrIvaMoneda[$arrTrab->moneda_id][$arrCol->estatus] += $intImporteIva;
					      	$arrIepsMoneda[$arrTrab->moneda_id][$arrCol->estatus] += $intImporteIeps;
					      	$arrTotalMoneda[$arrTrab->moneda_id][$arrCol->estatus] += $intTotal;
				      	}

						//Si el id de la moneda no corresponde al peso mexicano
						if($arrTrab->moneda_id != MONEDA_BASE)
						{
						    $arrTotalRegistrosMoneda[$arrTrab->moneda_id] += 1;
						}

						//Incrementar acumulados por cada registro
					    $intAcumUnidadesTF += $intCantidad;
					    $intAcumSubtotalTF += $intSubTotalUnitario;
					    $intAcumIvaTF += $intImporteIva;
						$intAcumIepsTF += $intImporteIeps;
			        }

				}//Cierre de verificación de trabajos foráneos


				//Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
					//Seleccionar los servicios del registro
			    	$otdServicios = $this->ordenes->buscar_servicios($arrCol->orden_reparacion_interna_id);

			    	//Verificar si existe información de los servicios 
					if($otdServicios)
					{
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						//$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
						$pdf->Cell(190, 5, utf8_decode('MANO DE OBRA'), 0, 1, 'L', 0);
						$pdf->SetTextColor(0); //establece el color de texto negro
						//Variable que se utiliza para asignar el total de horas
						$intTotalHoras = 0;
						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraServicios);
						//Recorre el array de titulos de encabezado para crearlos
						for ($intCont = 0; $intCont < count($arrCabeceraServicios); $intCont++) 
						{ 
						   	//inserta los titulos de la cabecera
						    $pdf->Cell($arrAnchuraServicios[$intCont], 5, $arrCabeceraServicios[$intCont], 0, 0, 
						    		   $arrAlineacionServicios[$intCont], FALSE);
						}
						$pdf->Ln(4);//Deja un salto de línea 
						//Recorremos el arreglo 
				        foreach ($otdServicios as $arrSer) 
				        {
						   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						    $pdf->Row(array(utf8_decode($arrSer->codigo), utf8_decode($arrSer->descripcion), 
						    				number_format($arrSer->horas,2), utf8_decode($arrSer->mecanico)), 
						                    $arrAlineacionServicios, 'ClippedCell');

						    //Acumular horas por cada registro
						    $intTotalHoras += $arrSer->horas;
						}

						//Dibuja una línea para separar el total
	    				$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraTotalesServ);

	    				//Cambiar el volumen de la fuente a bold
	      				$pdf->strTipoLetraTabla = 'Negrita';
						//Total de horas
						$pdf->Row(array('TOTAL:', number_format($intTotalHoras,2)), 
									   $arrAlineacionTotalesServ, 'ClippedCell');
						//Cambiar el volumen de la letra
    					$pdf->strTipoLetraTabla = 'Normal';
						
	    				$pdf->Ln(2);//Deja un salto de línea 

					}//Cierre de verificación de servicios

					//Verificar si existe información de las salidas de refacciones
					if($arrSalidasRefacciones)
					{
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->Cell(190, 5, utf8_decode('REFACCIONES'), 0, 1, 'L', 0);
						$pdf->SetTextColor(0); //establece el color de texto negro
						
					    //Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraSalidasRefacciones);
						//Recorre el array de titulos de encabezado para crearlos
						for ($intCont = 0; $intCont < count($arrCabeceraSalidasRefacciones); $intCont++) 
						{ 
						   	//inserta los titulos de la cabecera
						    $pdf->Cell($arrAnchuraSalidasRefacciones[$intCont], 5, 
						    		   $arrCabeceraSalidasRefacciones[$intCont], 0, 0, 
						    		   $arrAlineacionSalidasRefacciones[$intCont], FALSE);
						}
						$pdf->Ln(4);//Deja un salto de línea 
						//Recorremos el arreglo 
				        foreach ($arrSalidasRefacciones as $arrSal) 
				        {
						    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						    $pdf->Row(array($arrSal['folio'], $arrSal['fecha'], $arrSal['codigo'], 
						    				$arrSal['descripcion'], $arrSal['cantidad'], 
						    				$arrSal['costo_unitario'], $arrSal['subtotal']), 
						                    $arrAlineacionSalidasRefacciones, 'ClippedCell');
						}

						//Incrementar acumulados de la orden de reparación
						$intAcumSubtotalOrden += $intAcumSubtotalSR;

						//Dibuja una línea para separar el total
	    				$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
	    				
	    				//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraTotalesRef);

						//Cambiar el volumen de la fuente a bold
	      				$pdf->strTipoLetraTabla = 'Negrita';
						//Totales
						$pdf->Row(array('TOTAL:', number_format($intAcumUnidadesSR,2), 
										'$'.number_format($intAcumSubtotalSR,2)), 
									   $arrAlineacionTotalesRef, 'ClippedCell');
						//Cambiar el volumen de la letra
    					$pdf->strTipoLetraTabla = 'Normal';

	    				$pdf->Ln(2);//Deja un salto de línea 
					}//Cierre de verificación de salidas de refacciones

                    //Verificar si existe información de los trabajos foráneos 
					if($arrTrabajosForaneos)
					{
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->Cell(190, 5, utf8_decode('TRABAJOS FORÁNEOS'), 0, 1, 'L', 0);
						$pdf->SetTextColor(0); //establece el color de texto negro
						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraTrabajosForaneos);
						//Recorre el array de titulos de encabezado para crearlos
						for ($intCont = 0; $intCont < count($arrCabeceraTrabajosForaneos); $intCont++) 
						{ 
						   	//inserta los titulos de la cabecera
						    $pdf->Cell($arrAnchuraTrabajosForaneos[$intCont], 5, 
						    		   $arrCabeceraTrabajosForaneos[$intCont], 0, 0, 
						    		   $arrAlineacionTrabajosForaneos[$intCont], FALSE);
						}
						$pdf->Ln(4);//Deja un salto de línea 
						//Recorremos el arreglo 
				        foreach ($arrTrabajosForaneos as $arrTrab) 
				        {
						    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						    $pdf->Row(array($arrTrab['folio'], $arrTrab['fecha'], $arrTrab['proveedor'], 
						    				$arrTrab['concepto'], $arrTrab['cantidad'], 
						    				$arrTrab['costo_unitario'], $arrTrab['subtotal']),
						                    $arrAlineacionTrabajosForaneos, 'ClippedCell');
						}

						//Incrementar acumulados de la orden de reparación
						$intAcumSubtotalOrden += $intAcumSubtotalTF;
						$intAcumIvaOrden += $intAcumIvaTF;
						$intAcumIepsOrden += $intAcumIepsTF;


	    				//Dibuja una línea para separar el total
	    				$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
	    				
	    				//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraTotalesRef);
						//Cambiar el volumen de la fuente a bold
	      				$pdf->strTipoLetraTabla = 'Negrita';
						//Totales
						$pdf->Row(array('TOTAL:', number_format($intAcumUnidadesTF,2), 
										'$'.number_format($intAcumSubtotalTF,2)), 
									   $arrAlineacionTotalesRef, 'ClippedCell');
						//Cambiar el volumen de la letra
    					$pdf->strTipoLetraTabla = 'Normal';

	    				$pdf->Ln(2);//Deja un salto de línea 

					}//Cierre de verificación de trabajos foráneos

					//Calcular importe total
					$intTotalOrden = $intAcumSubtotalOrden + $intAcumIvaOrden + $intAcumIepsOrden;

					
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraTotalesGral);

					//Subtotal (se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
					$pdf->Row(array('SUBTOTAL GENERAL:|Negrita', number_format($intAcumSubtotalOrden,2)), 
								   $arrAlineacionTotalesGral, 'ClippedCell');

					//IVA (se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
					$pdf->Row(array('IVA GENERAL:|Negrita', number_format($intAcumIvaOrden,2)), 
								   $arrAlineacionTotalesGral, 'ClippedCell');

					//IEPS (se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
					$pdf->Row(array('IEPS GENERAL:|Negrita', number_format($intAcumIepsOrden,2)), 
								   $arrAlineacionTotalesGral, 'ClippedCell');

					//Total (se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
					$pdf->Row(array('TOTAL GENERAL:|Negrita', number_format($intTotalOrden,2)), 
								   $arrAlineacionTotalesGral, 'ClippedCell');

					//Espacios de salto de línea
					$pdf->Ln();
				}
		       
				//Incrementar el contador por cada registro
				$intContador++;

				//Asignar id de la orden de reparación actual
      			$intOrdenReparacionInternaIDActual = $arrCol->orden_reparacion_interna_id;
			}

			$pdf->Ln(5);//Deja un salto de linea

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- RESUMEN
	        //------------------------------------------------------------------------------------------------------------------------
			//Crea los titulos de la cabecera
			$arrCabeceraResumen = array('ESTATUS', 'SUBTOTAL', 'IVA', 'IEPS',  'TOTAL');
			//Establece el ancho de las columnas de cabecera
			$arrAnchuraResumen = array(49.8, 25, 25, 25, 25);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacionResumen = array('L', 'R', 'R', 'R', 'R');
			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Creación de la tabla Resumen
			$pdf->Cell(150, 4, 'RESUMEN GENERAL EN PESOS', 0, 0, 'C', TRUE);
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

					//Incrementar acumulados si el estatus es ACTIVO o FINALIZADO
					if($arrEst == 'ACTIVO' OR  $arrEst == 'FINALIZADO')
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
	    	$pdf->Cell(36.8,3,'TOTAL DE ORDENES: ', 0, 0, 'L');  
	    	//Total de registros
            $pdf->Cell(13,3,$intContador, 0, 0, 'R');
            //Acumulado del subtotal
            $pdf->Cell(25,3,'$'.number_format($intAcumSubtotalEstatus,2), 0, 0, 'R');
            //Acumulado del IVA
            $pdf->Cell(25,3,'$'.number_format($intAcumIvaEstatus,2), 0, 0, 'R');
           //Acumulado del IEPS
            $pdf->Cell(25,3,'$'.number_format($intAcumIepsEstatus,2), 0, 0, 'R');
            //Acumulado del importe total
            $pdf->Cell(25,3,'$'.number_format($intAcumTotalEstatus,2), 0, 0, 'R');
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
				$pdf->ClippedCell(150, 4, 'RESUMEN POR MONEDA '.$arrMon->descripcion, 0, 0, 'C', TRUE);
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
						$pdf->Row(array($arrEst,
										'$'.number_format($arrSubtotalMoneda[$arrMon->moneda_id][$arrEst],2), 
										'$'.number_format($arrIvaMoneda[$arrMon->moneda_id][$arrEst],2), 
				    				    '$'.number_format($arrIepsMoneda[$arrMon->moneda_id][$arrEst],2), 
				    				    '$'.number_format($arrTotalMoneda[$arrMon->moneda_id][$arrEst],2)), 
										$arrAlineacionResumen);


						//Incrementar acumulados si el estatus es ACTIVO o FINALIZADO
						if($arrEst == 'ACTIVO' OR  $arrEst == 'FINALIZADO')
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
		    	$pdf->Cell(36.8,3,utf8_decode('TOTAL DE TRABAJOS FORÁNEOS: '), 0, 0, 'L');  
		    	//Total de registros
	            $pdf->Cell(13,3,$arrTotalRegistrosMoneda[$arrMon->moneda_id], 0, 0, 'R');
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
		$pdf->Output('ordenes_trabajo_internas.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro() 
	{	            

		//Variables que se utilizan para recuperar los valores de la vista
		$intOrdenReparacionInternaID = $this->input->post('intOrdenReparacionInternaID');
		
		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->ordenes->buscar($intOrdenReparacionInternaID);
		//Seleccionar los servicios del registro
		$otdServicios = $this->ordenes->buscar_servicios($intOrdenReparacionInternaID);
		//Seleccionar los trabajos foráneos del registro
		$otdTrabajosForaneos = $this->trabajos->buscar_detalles(NULL, $intOrdenReparacionInternaID, 
																$intOrdenReparacionInternaID);
		//Seleccionar las salidas de refacciones del registro
		$otdSalidasRefacciones = $this->movimientos->buscar_detalles_salida(NULL, NULL, 
																			$this->intTipoMovimiento, 
																			$intOrdenReparacionInternaID);

		//Array que se utiliza para agregar los detalles
		$arrDetalles = array();
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Variable que se utiliza para asignar el acumulado de las unidades
		$intAcumUnidades = 0;
		//Variable que se utiliza para asignar el acumulado del subtotal
	    $intAcumSubtotal = 0;

		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variable que se utiliza para asignar el acumulado del subtotal general
	    $intAcumSubtotalGeneral = 0;
	    //Variable que se utiliza para asignar el acumulado del IVA general
	    $intAcumIvaGeneral = 0;
	    //Variable que se utiliza para asignar el acumulado del IEPS general
	    $intAcumIepsGeneral = 0;
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'orden_trabajo_interna_';
		//Establece el ancho de las columnas de los totales: refacciones y trabajos foráneos
		$arrAnchuraTotalesRef = array(20, 115, 50);
		//Establece la alineación de las celdas de la tabla totales: refacciones  y trabajos foráneos
		$arrAlineacionTotalesRef = array('L', 'R', 'R');

		//Agregar la primer pagina
		$pdf->AddPage();
		//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
		$this->get_encabezado_archivo_pdf($pdf);

		//Verificar si hay información del registro
		if($otdResultado)
		{	
			//Hacer un llamado a la función para mostrar imagen del estatus (INACTIVO/TIMBRAR)
			$this->get_img_estatus_archivo_pdf($pdf, $otdResultado->estatus);

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL VEHÍCULO
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 42);
			$pdf->ClippedCell(92, 3, utf8_decode('VEHÍCULO'), 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0); //establece el color de texto
			
			//Verificar si existe el id del vehículo
			if($otdResultado->vehiculo_id > 0)
			{

				//Código
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(15, 46);
				$pdf->ClippedCell(16, 3, utf8_decode('CÓDIGO'));
				//Modelo
				$pdf->SetXY(15, 49);
				$pdf->ClippedCell(22, 03, 'MODELO');
				//Marca
				$pdf->SetXY(15, 52);
				$pdf->ClippedCell(22, 3, 'MARCA');
				//Placas
				$pdf->SetXY(15, 55);
				$pdf->ClippedCell(20, 3, utf8_decode('PLACAS'));
				//Información
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Código
				$pdf->SetXY(30, 46);
				$pdf->ClippedCell(30, 3, utf8_decode($otdResultado->codigo_vehiculo));
				//Modelo
				$pdf->SetXY(30, 49);
				$pdf->ClippedCell(75, 3, utf8_decode($otdResultado->modelo_vehiculo));
				//Marca
				$pdf->SetXY(30, 52);
				$pdf->ClippedCell(75, 3, utf8_decode($otdResultado->marca_vehiculo));
				//Placas
				$pdf->SetXY(30, 55);
				$pdf->ClippedCell(75, 3, utf8_decode($otdResultado->placas_vehiculo));
			}
			else
			{

				//Serie
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(15, 46);
				$pdf->ClippedCell(16, 3, utf8_decode('SERIE'));
				//Motor
				$pdf->SetXY(15, 49);
				$pdf->ClippedCell(22, 03, 'MOTOR');
				//Información
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Serie
				$pdf->SetXY(30, 46);
				$pdf->ClippedCell(30, 3, utf8_decode($otdResultado->serie));
				//Motor
				$pdf->SetXY(30, 49);
				$pdf->ClippedCell(75, 3, utf8_decode($otdResultado->motor));
			}

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DE LA ORDEN DE REPARACIÓN
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(108, 42);
			$pdf->ClippedCell(92, 3, 'ORDEN DE TRABAJO INTERNA', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0);//establece el color de texto
			//Folio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, 46);
			$pdf->ClippedCell(15, 3, 'FOLIO');
			//Fecha 
			$pdf->SetXY(154, 46);
			$pdf->ClippedCell(15, 3, 'FECHA');
			//Fecha de finalización
			$pdf->SetXY(108, 49);
			$pdf->ClippedCell(28, 3, utf8_decode('FINALIZACIÓN'));
			//Usuario de finalización
			$pdf->SetXY(154, 49);
			$pdf->ClippedCell(25, 3, 'USUARIO');
			//Estatus
			$pdf->SetXY(108, 52);
			$pdf->ClippedCell(32, 3, 'ESTATUS');
			
			//Falla
			$pdf->SetXY(15, 60);
			$pdf->ClippedCell(32, 3, 'FALLA');
			//Causa
			$pdf->SetXY(15, 63);
			$pdf->ClippedCell(32, 3, 'CAUSA');
			//Solución
			$pdf->SetXY(15, 66);
			$pdf->ClippedCell(32, 3, utf8_decode('SOLUCIÓN'));
			
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(128, 46);
			$pdf->ClippedCell(76, 3, $otdResultado->folio);
			//Fecha
			$pdf->SetXY(170, 46);
			$pdf->ClippedCell(29, 3, $otdResultado->fecha);
			//Fecha de finalización
			$pdf->SetXY(128, 49);
			$pdf->ClippedCell(29, 3, $otdResultado->fecha_finalizacion);
			//Usuario de finalización
			$pdf->SetXY(170, 49);
			$pdf->ClippedCell(30, 3, utf8_decode($otdResultado->usuario_finalizacion));
			//Estatus
			$pdf->SetXY(128, 52);
			$pdf->ClippedCell(30, 3, $otdResultado->estatus);
			
			//Falla
			$pdf->SetXY(30, 60);
			$pdf->ClippedCell(170, 3, utf8_decode($otdResultado->falla));
			//Causa
			$pdf->SetXY(30, 63);
			$pdf->ClippedCell(170, 3, utf8_decode($otdResultado->causa));
			//Solución
			$pdf->SetXY(30, 66);
			$pdf->ClippedCell(170, 3, utf8_decode($otdResultado->solucion));
		

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DE LA ORDEN DE REPARACIÓN
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetXY(15, 73);
			//Verificar si existe información de los servicios 
			if($otdServicios)
			{
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->ClippedCell(185, 3, 'MANO DE OBRA', 0, 0, 'L', TRUE);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$intPosY = $pdf->GetY() + 4;
				//Tabla con los detalles de la orden de reparación
				$pdf->SetXY(15, $intPosY);
				//Variable que se utiliza para asignar el total de horas
				$intTotalHoras = 0;
				//Crea los titulos de la cabecera de servicios
				$arrCabeceraServicios = array(utf8_decode('Código'), utf8_decode('Descripción'), 
											  'Horas', utf8_decode('Mecánico'));
				//Establece el ancho de las columnas de la tabla servicios
				$arrAnchuraServicios = array(16, 95, 20, 54);
				//Establece la alineación de las celdas de la tabla servicios
				$arrAlineacionServicios = array('L', 'L', 'R', 'L');
				//Establece el ancho de las columnas de los totales: servicios
				$arrAnchuraTotalesServ = array(16, 115);
				//Establece la alineación de las celdas de la tabla totales: servicios
				$arrAlineacionTotalesServ = array('L', 'R');
				//Recorre el array de títulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabeceraServicios); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchuraServicios[$intCont], 3, $arrCabeceraServicios[$intCont], 1, 0, 
							   $arrAlineacionServicios[$intCont], TRUE);
				}
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraServicios);
				//Recorremos el arreglo 
		        foreach ($otdServicios as $arrSer) 
		        {
		        	$pdf->SetX(15);
				   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row(array(utf8_decode($arrSer->codigo), utf8_decode($arrSer->descripcion), 
				    				number_format($arrSer->horas,2), $arrSer->mecanico), 
				                    $arrAlineacionServicios,'ClippedCell');
				    //Acumular horas por cada registro
				    $intTotalHoras += $arrSer->horas;
				}

				$pdf->SetX(15);
				//Dibuja una línea para separar el total
				$pdf->Line(15, $pdf->GetY(), 200, $pdf->GetY());
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraTotalesServ);

				//Cambiar el volumen de la fuente a bold
  				$pdf->strTipoLetraTabla = 'Negrita';
				//Total de horas
				$pdf->Row(array('TOTAL:', number_format($intTotalHoras,2)), 
							   $arrAlineacionTotalesServ, 'ClippedCell');
				//Cambiar el volumen de la letra
				$pdf->strTipoLetraTabla = 'Normal';

				$pdf->Ln(2);//Deja un salto de línea 

			}//Cierre de verificación de servicios

			
			//Verificar si existe información de las salidas de refacciones 
			if($otdSalidasRefacciones)
			{
				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->ClippedCell(185, 3, utf8_decode('REFACCIONES'), 0, 0, 'L', TRUE);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$intPosY = $pdf->GetY() + 4;
				//Tabla con las salidas de refacciones
				$pdf->SetXY(15, $intPosY);
				//Variable que se utiliza para asignar el acumulado de las unidades
				$intAcumUnidades = 0;
				//Variable que se utiliza para asignar el acumulado del subtotal
			    $intAcumSubtotal = 0;
		     	//Variable que se utiliza para asignar el acumulado del IVA
			    $intAcumIva = 0;
			    //Variable que se utiliza para asignar el acumulado del IEPS
			    $intAcumIeps = 0;

			    //Crea los titulos de la cabecera de salidas de refacciones
				$arrCabeceraSalidasRefacciones = array(utf8_decode('Folio'), 'Fecha', utf8_decode('Requisición'),
													   utf8_decode('Código'), utf8_decode('Descripción'), 
													   'Solicitado', 'Cantidad', 'Costo', 'Subtotal');
				//Establece la alineación de las celdas de la tabla salidas de refacciones
				$arrAnchuraSalidasRefacciones = array(18, 15, 20, 20, 32, 15, 15, 25, 25);
				//Establece la alineación de las celdas de la tabla salidas de refacciones
				$arrAlineacionSalidasRefacciones = array('L', 'C', 'L', 'L', 'L', 'R', 'R', 'R', 'R');
				//Recorre el array de títulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabeceraSalidasRefacciones); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchuraSalidasRefacciones[$intCont], 3, 
							   $arrCabeceraSalidasRefacciones[$intCont], 1, 0, 
							   $arrAlineacionSalidasRefacciones[$intCont], TRUE);
				}
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraSalidasRefacciones);
				//Recorremos el arreglo 
		        foreach ($otdSalidasRefacciones as $arrSal) 
		        {
		        	$pdf->SetX(15);
					//Variables que se utilizan para asignar valores del detalle
					$intCantidadSurtida = $arrSal->cantidad;
					$intCantidadDevolucion = $arrSal->cantidad_devolucion;
		        	$intCostoUnitario = $arrSal->costo_unitario;
				    //Variable que se utiliza para asignar el subtotal 
					$intSubTotalUnitario = 0;

					//Decrementar cantidad devuelta
					$intCantidadFacturar = $intCantidadSurtida - $intCantidadDevolucion;

					//Calcular subtotal
					$intSubTotalUnitario = $intCantidadFacturar * $intCostoUnitario;

				    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row(array($arrSal->folio, $arrSal->fecha, $arrSal->folio_requisicion,
				    			    utf8_decode($arrSal->codigo), utf8_decode($arrSal->descripcion), 
				    			    number_format($arrSal->cantidad_solicitada,2), 
				    			    number_format($intCantidadFacturar,2), 
				    				number_format($intCostoUnitario,2), 
				    				number_format($intSubTotalUnitario,2)),
				    				$arrAlineacionSalidasRefacciones, 'ClippedCell');

				    //Incrementar acumulados por cada registro
				    $intAcumUnidades += $intCantidadFacturar;
				    $intAcumSubtotal += $intSubTotalUnitario;

				}

				//Incrementar acumulados generales
				$intAcumSubtotalGeneral += $intAcumSubtotal;

				$pdf->SetX(15);
		
				//Dibuja una línea para separar el total
				$pdf->Line(15, $pdf->GetY(), 200, $pdf->GetY()); 
				
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraTotalesRef);

				//Cambiar el volumen de la fuente a bold
  				$pdf->strTipoLetraTabla = 'Negrita';
				//Totales
				$pdf->Row(array('TOTAL:', number_format($intAcumUnidades,2), 
								'$'.number_format($intAcumSubtotal,2)), 
							   $arrAlineacionTotalesRef, 'ClippedCell');
				//Cambiar el volumen de la letra
				$pdf->strTipoLetraTabla = 'Normal';

				$pdf->Ln(2);//Deja un salto de línea 

			}//Cierre de verificación de salidas de refacciones


			//Verificar si existe información de los trabajos foráneos 
			if($otdTrabajosForaneos)
			{

				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->ClippedCell(185, 3, utf8_decode('TRABAJOS FORÁNEOS'), 0, 0, 'L', TRUE);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$intPosY = $pdf->GetY() + 4;
				//Tabla con los trabajos foráneos
				$pdf->SetXY(15, $intPosY);
				//Variable que se utiliza para asignar el acumulado de las unidades
				$intAcumUnidades = 0;
				//Variable que se utiliza para asignar el acumulado del subtotal
			    $intAcumSubtotal = 0;
			    //Variable que se utiliza para asignar el acumulado del IVA
			    $intAcumIva = 0;
			    //Variable que se utiliza para asignar el acumulado del IEPS
			    $intAcumIeps = 0;
			    //Crea los titulos de la cabecera trabajos foráneos
				$arrCabeceraTrabajosForaneos = array(utf8_decode('Folio'), 'Fecha', 
													 'Proveedor', utf8_decode('Descripción'), 
													 'Cantidad', 'Costo', 'Subtotal');
				//Establece el ancho de las columnas de la tabla trabajos foráneos
				$arrAnchuraTrabajosForaneos = array(16, 15, 49, 40, 15, 25, 25);
				//Establece la alineación de las celdas de la tabla trabajos foráneos
				$arrAlineacionTrabajosForaneos = array('L', 'C', 'L', 'L', 'R', 'R', 'R');
				
				//Recorre el array de títulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabeceraTrabajosForaneos); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchuraTrabajosForaneos[$intCont], 3, $arrCabeceraTrabajosForaneos[$intCont], 1, 0, $arrAlineacionTrabajosForaneos[$intCont], TRUE);
				}
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraTrabajosForaneos);
				//Recorremos el arreglo 
		        foreach ($otdTrabajosForaneos as $arrTrab) 
		        {
		        	$pdf->SetX(15);
		        	//Variables que se utilizan para asignar valores del detalle
					$intCantidad = $arrTrab->cantidad;
					//Convertir peso mexicano a tipo de cambio
					$intCostoUnitario = ($arrTrab->costo_unitario / $arrTrab->tipo_cambio);
					$intIvaUnitario = ($arrTrab->iva_unitario / $arrTrab->tipo_cambio);
					$intIepsUnitario = ($arrTrab->ieps_unitario / $arrTrab->tipo_cambio);
					$intTasaCuotaIeps = $arrTrab->tasa_cuota_ieps;
			    	$strTipoTasaCuotaIeps = $arrTrab->tipo_ieps;
			    	$strFactorTasaCuotaIeps = $arrTrab->factor_ieps;
			    	//Variable que se utiliza para asignar el subtotal 
					$intSubTotalUnitario = 0;
					//Variable que se utiliza para asignar el importe de IVA
					$intImporteIva = 0;
					//Variable que se utiliza para asignar el importe de IEPS
					$intImporteIeps = 0;

				    //Calcular subtotal
					$intSubTotalUnitario = $intCantidad * $intCostoUnitario;

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
							$intSubTotalUnitario += $intImporteIeps;
							//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
				   	 		$intImporteIeps = 0;
						}
						
					}
					
				    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row(array($arrTrab->folio, 
				    				$arrTrab->fecha, 
				    				utf8_decode($arrTrab->proveedor), 
				    				utf8_decode($arrTrab->concepto), 
				    				number_format($intCantidad, 2), 
				    				number_format($intCostoUnitario, 2), 
				    				number_format($intSubTotalUnitario, 2)),
				    				$arrAlineacionTrabajosForaneos, 
				    				'ClippedCell');
				    //Incrementar acumulados por cada registro
				    $intAcumUnidades += $intCantidad;
				    $intAcumSubtotal += $intSubTotalUnitario;
				    $intAcumIva += $intImporteIva;
					$intAcumIeps += $intImporteIeps;
				}

				//Incrementar acumulados generales
				$intAcumSubtotalGeneral += $intAcumSubtotal;
				$intAcumIvaGeneral += $intAcumIva;
				$intAcumIepsGeneral += $intAcumIeps;

				$pdf->SetX(15);

				//Dibuja una línea para separar el total
				$pdf->Line(15, $pdf->GetY(), 200, $pdf->GetY()); 
				
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraTotalesRef);

				//Cambiar el volumen de la fuente a bold
  				$pdf->strTipoLetraTabla = 'Negrita';
				//Totales
				$pdf->Row(array('TOTAL:', number_format($intAcumUnidades,2), 
								'$'.number_format($intAcumSubtotal,2)), 
							   $arrAlineacionTotalesRef, 'ClippedCell');
				//Cambiar el volumen de la letra
				$pdf->strTipoLetraTabla = 'Normal';

				$pdf->Ln(2);//Deja un salto de línea 

			}//Cierre de verificación de trabajos foráneos

			//Calcular importe total
			$intTotalGeneral = $intAcumSubtotalGeneral + $intAcumIvaGeneral + $intAcumIepsGeneral;
			//Redondear importe total a dos decimales
			$intTotalGeneral = number_format($intTotalGeneral, 2);

			$pdf->SetX(15);
			//Cantidad con letra
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->ClippedCell(60, 3, 'CANTIDAD CON LETRA');
			$pdf->Ln(); //Deja un salto de línea
			$pdf->SetX(15);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->MultiCell(185, 3, 'SON: (' .$AifLibNumber->toCurrency($intTotalGeneral) . ')');
			$pdf->SetX(15);
			$pdf->ClippedCell(185, 3, '', 0, 0, 'C', TRUE);
			$pdf->Ln(); //Deja un salto de línea
			//Observaciones
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(15);
			$pdf->ClippedCell(30, 3, 'OBSERVACIONES');
			//Subtotal general
			$pdf->SetX(135);
			$intPosY = $pdf->GetY();
			$pdf->drawTextBox('SUBTOTAL GENERAL', 30, 3, 'L');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(175,$intPosY);
			$pdf->drawTextBox('$'.number_format($intAcumSubtotalGeneral,2), 25, 3, 'R');
			$pdf->Ln(1); //Deja un salto de línea
			$intPosYObs = $pdf->GetY();
			$intPosY = $pdf->GetY();
			//IVA general
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(135, $intPosY);
			$pdf->drawTextBox('IVA GENERAL', 30, 3, 'L');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(175, $intPosY);
			$pdf->drawTextBox('$'.number_format($intAcumIvaGeneral,2), 25, 3, 'R');
			$pdf->Ln(1); //Deja un salto de línea
			$intPosY = $pdf->GetY();
			//IEPS general
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(135, $intPosY);
			$pdf->drawTextBox('IEPS GENERAL', 30, 3, 'L');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(175, $intPosY);
			$pdf->drawTextBox('$'.number_format($intAcumIepsGeneral,2), 25, 3, 'R');
			$pdf->Ln(1); //Deja un salto de línea
			$intPosY = $pdf->GetY();
			//Total general
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(135, $intPosY);
			$pdf->drawTextBox('TOTAL GENERAL', 30, 3, 'L');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(175, $intPosY);
			$pdf->drawTextBox('$'.$intTotalGeneral, 25, 3, 'R');
			$pdf->Ln(); //Deja un salto de línea

			//Observaciones
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, $intPosYObs);
			$pdf->MultiCell(110, 3, utf8_decode($otdResultado->observaciones));

			//Gerente de taller
            $pdf->SetXY(15,260);
            $pdf->Cell(90, 6,'', 0, 0, 'C');
            //Mecánico
            $pdf->SetXY(109, 260);
            $pdf->Cell(90, 6, '', 0, 0, 'C');
            $pdf->Ln(5);//Espacios de salto de línea
            $pdf->SetX(15);
            //Gerente de taller
            //Asigna el tipo y tamaño de letra
            $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
            $pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
            $pdf->Cell(90, 3, 'GERENTE DE TALLER', 0, 0, 'C',  TRUE);
             //Mecánico
            $pdf->SetXY(109, 265);
            $pdf->Cell(90, 3, utf8_decode('MECÁNICO'), 0, 0, 'C',  TRUE);
            //Fecha y hora de impresión (pie de pagina)
			$pdf->strUsuarioCreacion = $otdResultado->usuario_creacion;
			$pdf->dteFechaCreacion = $otdResultado->fecha_creacion;
			$pdf->strIncluirMembrete = 'SI';
		
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
		$intVehiculoID = $this->input->post('intVehiculoID');
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
		$otdResultado = $this->ordenes->buscar(NULL, $dteFechaInicial, $dteFechaFinal,  $intVehiculoID, 
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
			     ->setCellValue('A7', 'LISTADO DE ORDENES DE TRABAJO INTERNAS '.$strTituloRangoFechas);
		//Si existe id del vehículo
		if($intVehiculoID > 0)
		{   
			//Seleccionar los datos del vehículo que coincide con el id
			$otdVehiculo =  $this->vehiculos->buscar($intVehiculoID);
			//Concatenar datos del vehículo
			$strVehiculo = $otdVehiculo->codigo.' - '.$otdVehiculo->modelo.' '.$otdVehiculo->marca.' ';
			$strVehiculo .= $otdVehiculo->placas;
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'VEHÍCULO: '.$strVehiculo);
		}

		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'TIPO DE SERVICIO')
        		 ->setCellValue('C'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('D'.$intPosEncabezados, 'FECHA DE FINALIZACIÓN')
        		 ->setCellValue('E'.$intPosEncabezados, 'USUARIO')
        		 ->setCellValue('F'.$intPosEncabezados, 'VEHÍCULO')
        		 ->setCellValue('G'.$intPosEncabezados, 'KILOMETRAJE')
        		 ->setCellValue('H'.$intPosEncabezados, 'SERIE')
        		 ->setCellValue('I'.$intPosEncabezados, 'MOTOR')
        		 ->setCellValue('J'.$intPosEncabezados, 'FALLA')
        		 ->setCellValue('K'.$intPosEncabezados, 'CAUSA')
        		 ->setCellValue('L'.$intPosEncabezados, 'SOLUCIÓN')
        		 ->setCellValue('M'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('N'.$intPosEncabezados, 'ESTATUS');

        //Definir estilos de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE, 'color' => array('rgb' => 'ffffff')));

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
    			 ->getStyle('A10:N10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:N10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:N10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
            //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('O'.$intPosEncabezados, 'MANO DE OBRA CÓDIGO')
			         ->setCellValue('P'.$intPosEncabezados, 'DESCRIPCIÓN')
			         ->setCellValue('Q'.$intPosEncabezados,'HORAS')
			         ->setCellValue('R'.$intPosEncabezados, 'MECÁNICO');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('O'.$intPosEncabezados.':R'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('O'.$intPosEncabezados.':R'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('O'.$intPosEncabezados.':R'.$intPosEncabezados)
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

				//Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
				    //Seleccionar los servicios del registro
					$otdServicios = $this->ordenes->buscar_servicios($arrCol->orden_reparacion_interna_id);
					//Verificar si existe información de los servicios
					if($otdServicios)
				    {
				    	//Variable que se utiliza para contar el número de servicios
				    	$intContServ = 0;
				    	//Asignar el número de servicios
						$intNumDetalles = count($otdServicios); 

				    	//Recorremos el arreglo 
				        foreach ($otdServicios as $arrServ) 
				        {
				        	//Agregar datos al array
				        	$arrDetalles[$intContServ]['codigo']= $arrServ->codigo;
				        	$arrDetalles[$intContServ]['descripcion']= $arrServ->descripcion;
				        	$arrDetalles[$intContServ]['horas']= $arrServ->horas;
				        	$arrDetalles[$intContServ]['mecanico']= $arrServ->mecanico;
				        	//Incrementar el contador por cada registro
	                        $intContServ++;
				        }

				    }//Cierre de verificación de servicios
				    
				}//Cierre de verificación de detalles

				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    { 
			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
					 		 ->setCellValue('B'.$intFila, $arrCol->servicio_interno_tipo)
					 		 ->setCellValue('C'.$intFila, $arrCol->fecha)
					 		 ->setCellValue('D'.$intFila, $arrCol->fecha_finalizacion)
	                         ->setCellValue('E'.$intFila, $arrCol->usuario_finalizacion)
	                         ->setCellValue('F'.$intFila, $arrCol->vehiculo)
	                         ->setCellValue('G'.$intFila, $arrCol->kilometraje)
	                         ->setCellValue('H'.$intFila, $arrCol->serie)
	                         ->setCellValue('I'.$intFila, $arrCol->motor)
	                         ->setCellValue('J'.$intFila, $arrCol->falla)
	                         ->setCellValue('K'.$intFila, $arrCol->causa)
	                         ->setCellValue('L'.$intFila, $arrCol->solucion)
	                         ->setCellValue('M'.$intFila, $arrCol->observaciones)
	                         ->setCellValue('N'.$intFila, $arrCol->estatus);

		                //Si se cumple la sentencia mostrar detalles del registro
					    if($arrDetalles && $strDetalles == 'SI')
			            {
						    //Agregar información del servicio
							$objExcel->setActiveSheetIndex(0)
								 ->setCellValueExplicit('O'.$intFila, $arrDetalles[$intContDet]['codigo'], PHPExcel_Cell_DataType::TYPE_STRING)
	                             ->setCellValue('P'.$intFila, $arrDetalles[$intContDet]['descripcion'])
	                             ->setCellValue('Q'.$intFila, $arrDetalles[$intContDet]['horas'])
	                             ->setCellValue('R'.$intFila,  $arrDetalles[$intContDet]['mecanico']);
			            }

					//Incrementar el indice para escribir los datos del siguiente registro
	                $intFila++; 
	            }

                //Incrementar el contador por cada registro
				$intContador++;
			}
			
			//Cambiar contenido de las celdas a formato númerico
			$objExcel->getActiveSheet()
            		 ->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

			$objExcel->getActiveSheet()
            		 ->getStyle('Q'.$intFilaInicial.':'.'Q'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

			//Cambiar alineación de las siguientes celdas
           	$objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'D'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

           	$objExcel->getActiveSheet()
		        	 ->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			$objExcel->getActiveSheet()
                	 ->getStyle('N'.$intFilaInicial.':'.'N'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

           	$objExcel->getActiveSheet()
		        	 ->getStyle('Q'.$intFilaInicial.':'.'Q'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('N'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()->getStyle('N'.$intFila)->applyFromArray($arrStyleBold);
            
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'ordenes_trabajo_internas.xls', 'ordenes de trabajo', $intFila);
	}
}