<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes_reparacion extends MY_Controller {
	//Variable para identificar el tipo de movimiento
	var $intTipoMovimiento = SALIDA_REFACCIONES_TALLER; 
	//Variables para identificar la póliza de un registro
	var $strModuloPoliza = 'SERVICIO';
	var $strProcesoPoliza = 'ORDEN DE TRABAJO'; 

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de ordenes de reparación
		$this->load->model('servicio/ordenes_reparacion_model', 'ordenes');
		//Cargamos el modelo de prospectos
		 $this->load->model('crm/prospectos_model', 'prospectos');
		//Cargamos el modelo de movimientos de refacciones
		$this->load->model('refacciones/movimientos_refacciones_model', 'movimientos');
		//Cargamos el modelo de trabajos foráneos internos
		 $this->load->model('servicio/trabajos_foraneos_model', 'trabajos');

	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('servicio/ordenes_reparacion', $arrDatos);
	}

	/*******************************************************************************************************************
	Funciones de la tabla ordenes_reparacion
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->ordenes->filtro($this->input->post('dteFechaInicial'),
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
		foreach ($result['ordenes'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionFinalizar = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			$arrDet->mostrarAccionGenerarPoliza = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;

            //Verificar existencia de la póliza
		    if($arrDet->estatus == 'FINALIZADO' && 
				$arrDet->facturar_servicio_tipo == 'NO')
		    {

		    	//Si no existe id de la póliza
		    	if($arrDet->poliza_id == 0)
		    	{
					//Asignar cadena vacia para mostrar botón Generar póliza
		    		$arrDet->mostrarAccionGenerarPoliza = '';
		    	}
		    	
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

				//Si no existen requisiciones de refacciones ACTIVAS O PARCIALMENTE SURTIDO 
				if($arrDet->total_requisiciones == 0)
				{
					//Si el usuario cuenta con el permiso de acceso FINALIZAR ORDEN DE REPARACION
					if (in_array('FINALIZAR ORDEN DE REPARACION', $arrPermisos))
					{
						//Asignar cadena vacia para mostrar botón Finalizar
						$arrDet->mostrarAccionFinalizar = '';
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
		$objOrdenReparacion = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objOrdenReparacion->intOrdenReparacionID = $this->input->post('intOrdenReparacionID');
		$objOrdenReparacion->dteFecha = $this->input->post('dteFecha');
		$objOrdenReparacion->intServicioTipoID = $this->input->post('intServicioTipoID');
		$objOrdenReparacion->strTipoReparacion = $this->input->post('strTipoReparacion');
	    $objOrdenReparacion->strUbicacion = $this->input->post('strUbicacion');
		$objOrdenReparacion->intProspectoID = $this->input->post('intProspectoID');
		$objOrdenReparacion->strSerie = mb_strtoupper(trim($this->input->post('strSerie')));
		$objOrdenReparacion->strMotor = mb_strtoupper(trim($this->input->post('strMotor')));
		$objOrdenReparacion->intEquipoTipoID = $this->input->post('intEquipoTipoID');
		$objOrdenReparacion->intMaquinariaDescripcionID = $this->input->post('intMaquinariaDescripcionID');
		$objOrdenReparacion->intHoras = $this->input->post('intHoras');
		$objOrdenReparacion->strFalla = mb_strtoupper(trim($this->input->post('strFalla')));
		$objOrdenReparacion->strCausa = mb_strtoupper(trim($this->input->post('strCausa')));
		$objOrdenReparacion->strSolucion = mb_strtoupper(trim($this->input->post('strSolucion')));
		$objOrdenReparacion->intGastosServicio = $this->input->post('intGastosServicio');
		$objOrdenReparacion->intGastosServicioIva = $this->input->post('intGastosServicioIva');
		$objOrdenReparacion->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objOrdenReparacion->intSucursalID = $this->session->userdata('sucursal_id');
		$objOrdenReparacion->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de otros servicios
		$objOrdenReparacion->arrOtros = json_decode($this->input->post('arrOtros'));
		$intProcesoMenuID = $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objOrdenReparacion->intOrdenReparacionID))
		{
			$bolResultado = $this->ordenes->modificar($objOrdenReparacion);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objOrdenReparacion->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objOrdenReparacion->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->ordenes->guardar($objOrdenReparacion); 

				/*Quitar '_'  de la cadena (resultadoTransaccion_ordenReparacionID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $objOrdenReparacion->intOrdenReparacionID) = explode("_", $bolResultado); 
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
							 	  'orden_reparacion_id' => $objOrdenReparacion->intOrdenReparacionID,
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
		$intID = $this->input->post('intOrdenReparacionID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->ordenes->buscar($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
			//Seleccionar los servicios del registro
			$otdServicios = $this->ordenes->buscar_servicios($intID);
		    //Seleccionar los otros servicios del registro
			$otdOtros = $this->ordenes->buscar_otros($intID);
			
			//Si existen servicios del registro, se asignan al array
			if($otdServicios)
			{
				$arrDatos['servicios'] = $otdServicios;

			}//Cierre de verificación de servicios

			//Si existen otros servicios del registro, se asignan al array
			if($otdOtros)
			{
				$arrDatos['otros'] = $otdOtros;

			}//Cierre de verificación de otros servicios
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intOrdenReparacionID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intOrdenReparacionID');
		    $strEstatus = $this->input->post('strEstatus');
		    $strSerie = mb_strtoupper($this->input->post('strSerie'));

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->ordenes->set_estatus($intID, $strEstatus, $strSerie);
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
		$strEstatus = $this->input->post('strEstatus');
		$intProspectoID = $this->input->post('intProspectoID');

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);

			//Hacer un llamado al método para obtener todos los registros (activos/finalizados) 
			//que coincidan con la descripción
			$otdResultado = $this->ordenes->autocomplete($strDescripcion, $strEstatus, $intProspectoID);
		
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->folio, 
		        						'data' => $arrCol->orden_reparacion_id, 
		        						'prospecto' => $arrCol->prospecto, 
		        						'tipo_reparacion' => $arrCol->tipo_reparacion,
		        						'servicio_lista_precio_id' => $arrCol->servicio_lista_precio_id, 
		        						'porcentaje_trabajos_foraneos' => $arrCol->porcentaje_trabajos_foraneos, 
		        						'regimen_fiscal_id'=> $arrCol->regimen_fiscal_id);
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
		$intProspectoID = $this->input->post('intProspectoID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strDetalles = $this->input->post('strDetalles');
		//Array que se utiliza para asignar los estatus 
		$arrEstatus = array('ACTIVO', 'FINALIZADO','FACTURADO', 'INACTIVO'); 
		//Array que se utiliza para asignar el costo por estatus
		$arrCostoEstatus = array(); 
		//Array que se utiliza para asignar el subtotal por estatus
		$arrSubtotalEstatus = array(); 
		//Array que se utiliza para asignar el IVA por estatus
		$arrIvaEstatus = array();
		//Array que se utiliza para asignar el IEPS por estatus
		$arrIepsEstatus = array(); 
		//Array que se utiliza para asignar el total por estatus
		$arrTotalEstatus = array();
		//Variable que se utiliza para asignar el acumulado del costo por estatus
		$intAcumCostoEstatus = 0;
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
		$intOrdenReparacionIDActual = 0;
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->ordenes->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, $strEstatus, $strBusqueda);
		
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
		$pdf->strLinea1 = 'LISTADO DE ORDENES DE TRABAJO '.$strTituloRangoFechas;
		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del prospecto que coincide con el id
			$otdProspecto =  $this->prospectos->buscar($intProspectoID, NULL, 'referencias');
			$pdf->strLinea2 =  'CLIENTE: '.utf8_decode($otdProspecto->prospecto);
		}
		
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', utf8_decode('CLIENTE'), 'FECHA', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(16, 139, 15, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'C');
		//Crea los titulos de la cabecera de servicios
		$arrCabeceraServicios = array(utf8_decode('CÓDIGO'), utf8_decode('DESCRIPCIÓN'), 
									  utf8_decode('MECÁNICO'), 'HORAS', 'COSTO', 'PRECIO', 'SUBTOTAL');
		//Establece el ancho de las columnas de la tabla servicios
		$arrAnchuraServicios = array(16, 48, 51, 15, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla servicios
		$arrAlineacionServicios = array('L', 'L', 'L' , 'R', 'R', 'R', 'R');
		
		//Crea los titulos de la cabecera de salidas de refacciones por taller
		$arrCabeceraSalidasRefacciones = array(utf8_decode('FOLIO'), 'FECHA', utf8_decode('REQUISICIÓN'), 
											   utf8_decode('CÓDIGO'), utf8_decode('DESCRIPCIÓN'), 
											   'SOLICITADO', 'CANTIDAD', 'COSTO', 'PRECIO', 'SUBTOTAL');
		//Establece la alineación de las celdas de la tabla salidas de refacciones por taller
		$arrAnchuraSalidasRefacciones = array(16, 13, 18, 18, 35, 15, 15, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla salidas de refacciones por taller
		$arrAlineacionSalidasRefacciones = array('L', 'C', 'L', 'L', 'L', 'R', 'R', 'R', 'R', 'R');
		
		//Crea los titulos de la cabecera trabajos foráneos
		$arrCabeceraTrabajosForaneos = array(utf8_decode('FOLIO'), 'FECHA', 'PROVEEDOR', 
											 utf8_decode('DESCRIPCIÓN'), 'CANTIDAD', 
											 'COSTO', 'PRECIO', 'SUBTOTAL');
		//Establece el ancho de las columnas de la tabla trabajos foráneos
		$arrAnchuraTrabajosForaneos = array(16, 13, 46, 40, 15, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla trabajos foráneos
		$arrAlineacionTrabajosForaneos = array('L', 'C', 'L', 'L', 'R', 'R', 'R', 'R');

		//Crea los titulos de la cabecera otros servicios
		$arrCabeceraOtros = array('CONCEPTO', utf8_decode('CÓDIGO SAT'), 'UNIDAD SAT', 
								  'CANTIDAD', 'PRECIO', 'SUBTOTAL');
		//Establece el ancho de las columnas de la tabla otros servicioss
		$arrAnchuraOtros = array(45, 45, 40, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla otros servicioss
		$arrAlineacionOtros = array('L', 'L', 'L', 'R', 'R', 'R');

		//Agregar la primer pagina
		$pdf->AddPage();
		//Establecer el color de fondo para la cabecera
        $pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		//Establecer el color de línea
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
					
		//Si hay información
		if($otdResultado)
		{	
			//Recorremos el arreglo para obtener la información de los estatus
			foreach ($arrEstatus as $arrEst)
			{
				//Inicializar variables
				$arrCostoEstatus[$arrEst] = 0;
				$arrSubtotalEstatus[$arrEst] = 0;
				$arrIvaEstatus[$arrEst] = 0;
				$arrIepsEstatus[$arrEst] = 0;
				$arrTotalEstatus[$arrEst] = 0;
			}	

			//Recorremos el arreglo para obtener la información de las ordenes de reparación
			foreach ($otdResultado as $arrCol)
			{ 
				
				//Variable que se utiliza para asignar el acumulado del costo de la orden de reparación
			    $intAcumCostoOrden = 0;
				//Variable que se utiliza para asignar el acumulado del subtotal de la orden de reparación
			    $intAcumSubtotalOrden = 0;
			    //Variable que se utiliza para asignar el acumulado del IVA de la orden de reparación
			    $intAcumIvaOrden = 0;
			    //Variable que se utiliza para asignar el acumulado del IEPS de la orden de reparación
			    $intAcumIepsOrden = 0;
			    //Asignar subtotal del gasto de servicio
			    $intGatosServiciosSubtotal = $arrCol->gastos_servicio;

				//Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI' &&  ($intOrdenReparacionIDActual != $arrCol->orden_reparacion_id && 
					$intOrdenReparacionIDActual > 0))
				{
					$pdf->Ln(2);//Deja un salto de línea
					$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto			
					//Asigna el tipo y tamaño de letra para la cabecera de la tabla
       				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Recorre el array de titulos de encabezado para crearlos
					for ($intCont = 0; $intCont < count($pdf->arrCabecera); $intCont++)
					{

						//inserta los titulos de la cabecera
						$pdf->Cell($pdf->arrAnchura[$intCont], 7, $pdf->arrCabecera[$intCont], 1, 0, 
								   $pdf->arrAlineacion[$intCont], TRUE);
					}
					$pdf->Ln(); //Deja un salto de línea
				    $pdf->SetTextColor(0); //establece el color de texto		
				}

				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, utf8_decode($arrCol->prospecto), $arrCol->fecha,  
								$arrCol->estatus), $pdf->arrAlineacion, 'ClippedCell');

				//Array que se utiliza para agregar las salidas de refacciones por taller
		        $arrSalidasRefacciones = array();
		        //Array que se utiliza para agregar los trabajos foráneos
		        $arrTrabajosForaneos = array();
		        //Array que se utiliza para agregar los servicios de mano de obra
		        $arrServiciosManoObra = array();
		        //Array que se utiliza para agregar los otros servicios
		        $arrOtros = array();
		        //Array que se utiliza para agregar los datos de un detalle
		        $arrAuxiliar = array();

		        //Seleccionar las salidas de refacciones del registro
				$otdSalidasRefacciones = $this->movimientos->buscar_detalles_salida_taller(NULL, NULL, $this->intTipoMovimiento, $arrCol->orden_reparacion_id);

				//Verificar si existe información de las salidas de refacciones por taller
				if($otdSalidasRefacciones)
				{
					//Variable que se utiliza para asignar el acumulado de las unidades
					$intAcumUnidadesSR = 0;
					//Variable que se utiliza para asignar el acumulado del costo
			   		$intAcumCostoSR = 0;
					//Variable que se utiliza para asignar el acumulado del subtotal
				    $intAcumSubtotalSR = 0;
				    //Variable que se utiliza para asignar el acumulado del IVA
				    $intAcumIvaSR = 0;
				    //Variable que se utiliza para asignar el acumulado del IEPS
				    $intAcumIepsSR = 0;

					//Recorremos el arreglo 
			        foreach ($otdSalidasRefacciones as $arrSal) 
			        {
			        	//Variables que se utilizan para asignar valores del detalle
						$intCantidadSurtida = $arrSal->cantidad;
						$intCantidadDevolucion = $arrSal->cantidad_devolucion;
						$intTasaCuotaIeps = $arrSal->tasa_cuota_ieps;
			        	$intPorcentajeIva = $arrSal->porcentaje_iva;
			        	$intPorcentajeIeps = $arrSal->porcentaje_ieps;
			        	$intPrecioUnitario = $arrSal->precio_unitario;
			        	$intCostoUnitario = $arrSal->costo_unitario;

					    //Variable que se utiliza para asignar el importe de iva
						$intImporteIva = 0;
						//Variable que se utiliza para asignar el importe de ieps
						$intImporteIeps = 0;		
					    //Variable que se utiliza para asignar el subtotal 
						$intSubtotalUnitario = 0;
						//Variable que se utiliza para asignar el costo 
						$intCostoTotal = 0;

						//Decrementar cantidad devuelta
						$intCantidadFacturar = $intCantidadSurtida - $intCantidadDevolucion;

						//Calcular subtotal
						$intSubtotalUnitario = $intCantidadFacturar * $intPrecioUnitario;

						//Calcular costo
		        		$intCostoTotal  = $intCantidadFacturar * $intCostoUnitario;

						//Calcular importe de IVA
						$intImporteIva = $intSubtotalUnitario * $intPorcentajeIva;

						//Si existe id de la tasa de cuota del IEPS
						if($intTasaCuotaIeps > 0)
						{
							//Calcular importe de IEPS
							$intImporteIeps = $intSubtotalUnitario * $intPorcentajeIeps;
						}


						//Calcular importe total
						$intTotal = $intSubtotalUnitario + $intImporteIva + $intImporteIeps;

						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["folio"] = $arrSal->folio;
						$arrAuxiliar["fecha"] = $arrSal->fecha;
						$arrAuxiliar["folio_requisicion"] = $arrSal->folio_requisicion;
						$arrAuxiliar["codigo"] = utf8_decode($arrSal->codigo);
						$arrAuxiliar["descripcion"] = utf8_decode($arrSal->descripcion);
						$arrAuxiliar["cantidad_solicitada"] = number_format($arrSal->cantidad_solicitada,2);
						$arrAuxiliar["cantidad"] = number_format($intCantidadFacturar,2);
						$arrAuxiliar["costo_unitario"] = '$'.number_format($intCostoUnitario,2);
		                $arrAuxiliar["precio_unitario"] = '$'.number_format($intPrecioUnitario,2);
		                $arrAuxiliar["subtotal"] = '$'.number_format($intSubtotalUnitario,2);
		                //Asignar datos al array
                        array_push($arrSalidasRefacciones, $arrAuxiliar); 

                        //Incrementar valores de los siguientes arrays
                        $arrCostoEstatus[$arrCol->estatus] += $intCostoTotal;
						$arrSubtotalEstatus[$arrCol->estatus] += $intSubtotalUnitario;
				      	$arrIvaEstatus[$arrCol->estatus] += $intImporteIva;
				      	$arrIepsEstatus[$arrCol->estatus] += $intImporteIeps;
				      	$arrTotalEstatus[$arrCol->estatus] += $intTotal;		

					    //Incrementar acumulados por cada registro
					    $intAcumUnidadesSR += $intCantidadFacturar;
					    $intAcumCostoSR += $intCostoTotal;
					    $intAcumSubtotalSR += $intSubtotalUnitario;
					    $intAcumIvaSR += $intImporteIva;
						$intAcumIepsSR += $intImporteIeps;

			        }
					
				}//Cierre de verificación de salidas de refacciones

				//Seleccionar los trabajos foráneos del registro
                $otdTrabajosForaneos = $this->trabajos->buscar_detalles(NULL, $arrCol->orden_reparacion_id);

                //Verificar si existe información de los trabajos foráneos 
				if($otdTrabajosForaneos)
				{
					//Variable que se utiliza para asignar el acumulado de las unidades
					$intAcumUnidadesTF = 0;
					//Variable que se utiliza para asignar el acumulado del costo
			   		$intAcumCostoTF = 0;
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
						$intCantidad =  number_format($arrTrab->cantidad, 2, '.', '');
						$intCantidadCosto = $arrTrab->cantidad;
						$intPrecioUnitario = $arrTrab->precio_unitario;
						$intCostoUnitario = $arrTrab->costo_unitario;
					    $intPorcentajeIva = $arrTrab->porcentaje_iva;
					    $intPorcentajeIeps = $arrTrab->porcentaje_ieps;
					    $intTasaCuotaIeps = $arrTrab->tasa_cuota_ieps;
					    $strTipoTasaCuotaIeps = $arrTrab->tipo_ieps;
	    				$strFactorTasaCuotaIeps = $arrTrab->factor_ieps;
						$intIepsUnitario =  $arrTrab->ieps_unitario;
						//Variable que se utiliza para asignar el importe de IVA
						$intImporteIva = 0;
						//Variable que se utiliza para asignar el importe de IEPS
						$intImporteIepsCosto = 0;	
					    //Variable que se utiliza para asignar el subtotal 
						$intSubtotalUnitario = 0;
						//Variable que se utiliza para asignar el costo 
						$intCostoTotal = 0;

						//Calcular subtotal
						$intSubtotalUnitario = $intCantidad * $intPrecioUnitario;

						//Calcular costo
		        		$intCostoTotal  = $intCantidadCosto * $intCostoUnitario;

						//Calcular importe de IVA
						$intImporteIva = $intSubtotalUnitario * $intPorcentajeIva;

						//Si existe id de la tasa de cuota del IEPS
						if($intTasaCuotaIeps > 0)
						{
							//Si la tasa de cuota no es de tipo RANGO ni su factor es Cuota
							if($strTipoTasaCuotaIeps !== 'RANGO' && $strFactorTasaCuotaIeps !=='Cuota')
							{
								//Calcular importe de IEPS
								$intImporteIeps = $intSubtotalUnitario * $intPorcentajeIeps;
							}



						    //Si la tasa de cuota es de tipo RANGO y su factor es Cuota
							if($strTipoTasaCuotaIeps == 'RANGO' && $strFactorTasaCuotaIeps == 'Cuota')
							{
								//Calcular importe de IEPS
						    	$intImporteIepsCosto =  $intIepsUnitario * $intCantidadCosto;
								//Sumarle al subtotal el importe de ieps
								$intCostoTotal += $intImporteIepsCosto;
							}
						}

						//Calcular importe total
						$intTotal = $intSubtotalUnitario + $intImporteIva + $intImporteIeps;

						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["folio"] = $arrTrab->folio;
						$arrAuxiliar["fecha"] = $arrTrab->fecha;
						$arrAuxiliar["proveedor"] = utf8_decode($arrTrab->proveedor);
						$arrAuxiliar["concepto"] = utf8_decode($arrTrab->concepto);
						$arrAuxiliar["cantidad"] = number_format($intCantidad,2);
						$arrAuxiliar["costo_unitario"] = '$'.number_format($intCostoUnitario,2);
		                $arrAuxiliar["precio_unitario"] = '$'.number_format($intPrecioUnitario,2);
		                $arrAuxiliar["subtotal"] = '$'.number_format($intSubtotalUnitario,2);
		                //Asignar datos al array
                        array_push($arrTrabajosForaneos, $arrAuxiliar); 


                        //Incrementar valores de los siguientes arrays
                        $arrCostoEstatus[$arrCol->estatus] += $intCostoTotal;
						$arrSubtotalEstatus[$arrCol->estatus] += $intSubtotalUnitario;
				      	$arrIvaEstatus[$arrCol->estatus] += $intImporteIva;
				      	$arrIepsEstatus[$arrCol->estatus] += $intImporteIeps;
				      	$arrTotalEstatus[$arrCol->estatus] += $intTotal;

						//Incrementar acumulados por cada registro
					    $intAcumUnidadesTF += $intCantidad;
					    $intAcumCostoTF +=   number_format($intCostoTotal,5, '.', '');
					    $intAcumSubtotalTF += $intSubtotalUnitario;
					    $intAcumIvaTF += $intImporteIva;
						$intAcumIepsTF += $intImporteIeps;
			        }

				}//Cierre de verificación de trabajos foráneos

				//Seleccionar los servicios del registro
			    $otdServicios = $this->ordenes->buscar_servicios($arrCol->orden_reparacion_id, 
			    											     NULL, 'FINALIZADO');
				
				//Verificar si existe información de los servicios de mano de obra
				if($otdServicios)
				{
					//Variable que se utiliza para asignar el total de horas
					$intTotalHoras = 0;
					//Variable que se utiliza para asignar el acumulado del costo
			   		$intAcumCostoMO = 0;
					//Variable que se utiliza para asignar el acumulado del subtotal
		    		$intAcumSubtotalMO = 0;
		    		//Variable que se utiliza para asignar el acumulado del IVA
				    $intAcumIvaMO = 0;
				    //Variable que se utiliza para asignar el acumulado del IEPS
				    $intAcumIepsMO = 0;

					//Recorremos el arreglo 
			        foreach ($otdServicios as $arrServ) 
			        {
			        	//Variable que se utiliza para asignar el importe de iva
						$intImporteIva = 0;
						//Variable que se utiliza para asignar el importe de ieps
						$intImporteIeps = 0;
						//Variable que se utiliza para asignar el subtotal 
						$intSubtotalUnitario = 0;
						//Variable que se utiliza para asignar el costo 
						$intCostoTotal = 0;

			        	//Asignar el porcentaje del IVA
			        	$intPorcentajeIva = $arrServ->porcentaje_iva;
			        	//Asignar el porcentaje del IEPS
			        	$intPorcentajeIeps = $arrServ->porcentaje_ieps;
			        	//Asignar horas de la mano de obra
			        	$intHoras = $arrServ->horas;
			        	//Asignar precio del servicio por mano de obra
			        	$intPrecio = $arrServ->precio;
			        	//Asignar costo del servicio por mano de obra
		        		$intCosto = $arrServ->costo;

			        	//Calcular subtotal
			        	$intSubtotalUnitario = $intHoras * $intPrecio;

			        	//Calcular costo
		        		$intCostoTotal  = $intHoras * $intCosto;

			        	//Calcular importe de IVA
						$intImporteIva = $intSubtotalUnitario * $intPorcentajeIva;

						//Si existe porcentaje de IEPS
						if($intPorcentajeIeps != '')
						{
							//Calcular importe de IEPS
							$intImporteIeps = $intSubtotalUnitario * $intPorcentajeIeps;
						}

						//Calcular importe total
						$intTotal = $intSubtotalUnitario + $intImporteIva + $intImporteIeps;


					    //Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["codigo"] = $arrServ->codigo;
						$arrAuxiliar["descripcion"] = utf8_decode($arrServ->descripcion);
						$arrAuxiliar["horas"] = number_format($intHoras,2);
						$arrAuxiliar["costo"] = '$'.number_format($intCosto, 2);
						$arrAuxiliar["precio"] = '$'.number_format($intPrecio, 2);
						$arrAuxiliar["subtotal"] = '$'.number_format($intSubtotalUnitario,2);
		                $arrAuxiliar["mecanico"] = utf8_decode($arrServ->mecanico);
		                //Asignar datos al array
                        array_push($arrServiciosManoObra, $arrAuxiliar); 

					    
					    //Incrementar valores de los siguientes arrays
					    $arrCostoEstatus[$arrCol->estatus] += $intCostoTotal;
						$arrSubtotalEstatus[$arrCol->estatus] += $intSubtotalUnitario;
				      	$arrIvaEstatus[$arrCol->estatus] += $intImporteIva;
				      	$arrIepsEstatus[$arrCol->estatus] += $intImporteIeps;
				      	$arrTotalEstatus[$arrCol->estatus] += $intTotal;	

					    //Acumular horas por cada registro
					    $intTotalHoras += $intHoras;
					    $intAcumCostoMO += $intCostoTotal;
					    $intAcumSubtotalMO += $intSubtotalUnitario;
					    $intAcumIvaMO += $intImporteIva;
						$intAcumIepsMO += $intImporteIeps;
							
					}

				}//Cierre de verificación de servicios de mano de obra


				//Seleccionar los otros servicios del registro
                $otdOtros = $this->ordenes->buscar_otros($arrCol->orden_reparacion_id);

                //Verificar si existe información de los otros servicios
				if($otdOtros)
				{
					//Variable que se utiliza para asignar el acumulado de las unidades
					$intAcumUnidadesOtros = 0;
					//Variable que se utiliza para asignar el acumulado del subtotal
				    $intAcumSubtotalOtros = 0;
				    //Variable que se utiliza para asignar el acumulado del IVA
				    $intAcumIvaOtros = 0;
				    //Variable que se utiliza para asignar el acumulado del IEPS
				    $intAcumIepsOtros = 0;
				    //Recorremos el arreglo 
			        foreach ($otdOtros as $arrOtro) 
			        {

						//Variables que se utilizan para asignar valores del detalle
						$intCantidad =  number_format($arrOtro->cantidad, 2, '.', '');
						$intPrecioUnitario = $arrOtro->precio_unitario;
					    $intPorcentajeIva = $arrOtro->porcentaje_iva;
					    $intPorcentajeIeps = $arrOtro->porcentaje_ieps;
					    $intTasaCuotaIeps = $arrOtro->tasa_cuota_ieps;
						//Variable que se utiliza para asignar el importe de iva
						$intImporteIva = 0;
						//Variable que se utiliza para asignar el importe de ieps
						$intImporteIeps = 0;		
					    //Variable que se utiliza para asignar el subtotal 
						$intSubtotalUnitario = 0;

						//Calcular subtotal
						$intSubtotalUnitario = $intCantidad * $intPrecioUnitario;

						//Calcular importe de IVA
						$intImporteIva = $intSubtotalUnitario * $intPorcentajeIva;

						//Si existe id de la tasa de cuota del IEPS
						if($intTasaCuotaIeps > 0)
						{
							//Calcular importe de IEPS
						    $intImporteIeps = $intSubtotalUnitario * $intPorcentajeIeps;
						}

						//Calcular importe total
						$intTotal = $intSubtotalUnitario + $intImporteIva + $intImporteIeps;

						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["concepto"] = utf8_decode($arrOtro->concepto);
						$arrAuxiliar["producto_servicio"] = utf8_decode($arrOtro->producto_servicio);
						$arrAuxiliar["unidad"] = utf8_decode($arrOtro->unidad);
						$arrAuxiliar["cantidad"] = number_format($intCantidad,2);
		                $arrAuxiliar["precio_unitario"] = '$'.number_format($intPrecioUnitario,2);
		                $arrAuxiliar["subtotal"] = '$'.number_format($intSubtotalUnitario,2);
		                //Asignar datos al array
                        array_push($arrOtros, $arrAuxiliar); 

                        //Incrementar valores de los siguientes arrays
						$arrSubtotalEstatus[$arrCol->estatus] += $intSubtotalUnitario;
				      	$arrIvaEstatus[$arrCol->estatus] += $intImporteIva;
				      	$arrIepsEstatus[$arrCol->estatus] += $intImporteIeps;
				      	$arrTotalEstatus[$arrCol->estatus] += $intTotal;

						//Incrementar acumulados por cada registro
					    $intAcumUnidadesOtros += $intCantidad;
					    $intAcumSubtotalOtros += $intSubtotalUnitario;
					    $intAcumIvaOtros += $intImporteIva;
						$intAcumIepsOtros += $intImporteIeps;
			        }

				}//Cierre de verificación de otros servicios

				//Si existe importe de gastos de servicio 
				if($intGatosServiciosSubtotal > 0)
				{
					//Asignar IVA del gasto de servicio
					$intGatosServiciosIva = $arrCol->gastos_servicio_iva;
					//Calcular total del gasto de servicio
					$intGatosServiciosTotal = $intGatosServiciosSubtotal + $intGatosServiciosIva;

					//Incrementar valores de los siguientes arrays
					$arrSubtotalEstatus[$arrCol->estatus] += $intGatosServiciosSubtotal;
			      	$arrIvaEstatus[$arrCol->estatus] += $intGatosServiciosIva;
			      	$arrTotalEstatus[$arrCol->estatus] += $intGatosServiciosTotal;	

					//Incrementar acumulados de la orden de reparación
					$intAcumSubtotalOrden += $intGatosServiciosSubtotal;
					$intAcumIvaOrden += $intGatosServiciosIva;

				}//Cierre de verificación de gastos de servicio 

				//Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
			    	//Verificar si existe información de los servicios 
					if($arrServiciosManoObra)
					{
	
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->Cell(190, 5, utf8_decode('MANO DE OBRA'), 0, 1, 'L', 0);
						$pdf->SetTextColor(0); //establece el color de texto negro
						
						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraServicios);
						//Recorre el array de titulos de encabezado para crearlos
						for ($intCont = 0; $intCont < count($arrCabeceraServicios); $intCont++) 
						{ 
							$pdf->SetTextColor(0); //establece el color de texto
						   	//inserta los titulos de la cabecera
						    $pdf->Cell($arrAnchuraServicios[$intCont], 5, $arrCabeceraServicios[$intCont], 0, 0, 
						    		   $arrAlineacionServicios[$intCont], FALSE);
						}
						$pdf->Ln(4);//Deja un salto de línea 
						//Recorremos el arreglo 
				       	foreach ($arrServiciosManoObra as $arrServ) 
				        {

						   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						    $pdf->Row(array($arrServ['codigo'], $arrServ['descripcion'], 
						    				$arrServ['mecanico'], $arrServ['horas'], 
						    				$arrServ['costo'], $arrServ['precio'], 
						    				$arrServ['subtotal']),
						                    $arrAlineacionServicios, 'ClippedCell');
								
						}

						//Incrementar acumulados de la orden de reparación
						$intAcumCostoOrden += $intAcumCostoMO;
						$intAcumSubtotalOrden += $intAcumSubtotalMO;
						$intAcumIvaOrden += $intAcumIvaMO;
						$intAcumIepsOrden += $intAcumIepsMO;

						//Total de horas
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->ClippedCell(16, 4, 'TOTAL:', 0, 0, 'L', 0);
						//Acumulado de horas
						$pdf->ClippedCell(114, 4, number_format($intTotalHoras,2), 0, 0, 'R', 0);
						//Acumulado del costo
						$pdf->ClippedCell(20, 4, '$'.number_format($intAcumCostoMO,2), 0, 0, 'R', 0);
						//Acumulado del subtotal
						$pdf->ClippedCell(40, 4, '$'.number_format($intAcumSubtotalMO,2), 0, 0, 'R', 0);
						//Dibuja una línea para separar el total
	    				$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
	    				$pdf->Ln(5);//Deja un salto de línea 

					}//Cierre de verificación de servicios

					//Verificar si existe información de las salidas de refacciones por taller
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
						    $pdf->Row(array($arrSal['folio'], $arrSal['fecha'], $arrSal['folio_requisicion'], 
						    				$arrSal['codigo'], $arrSal['descripcion'], 
						    				$arrSal['cantidad_solicitada'], $arrSal['cantidad'], 
						    				$arrSal['costo_unitario'], $arrSal['precio_unitario'], 
						    				$arrSal['subtotal']), 	
						    				$arrAlineacionSalidasRefacciones, 'ClippedCell');
						}

						//Incrementar acumulados de la orden de reparación
						$intAcumCostoOrden += $intAcumCostoSR;
						$intAcumSubtotalOrden += $intAcumSubtotalSR;
						$intAcumIvaOrden += $intAcumIvaSR;
						$intAcumIepsOrden += $intAcumIepsSR;

						//Totales
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->ClippedCell(16, 4, 'TOTAL:', 0, 0, 'L', 0);
						//Acumulado de unidades
						$pdf->ClippedCell(114, 4, number_format($intAcumUnidadesSR,2), 0, 0, 'R', 0);
						//Acumulado del costo
						$pdf->ClippedCell(20, 4, '$'.number_format($intAcumCostoSR,2), 0, 0, 'R', 0);
						//Acumulado del subtotal
						$pdf->ClippedCell(40, 4, '$'.number_format($intAcumSubtotalSR,2), 0, 0, 'R', 0);
						//Dibuja una línea para separar el total
	    				$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
	    				$pdf->Ln(5);//Deja un salto de línea 
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
						    				$arrTrab['costo_unitario'], $arrTrab['precio_unitario'],
						    				$arrTrab['subtotal']),
						                    $arrAlineacionTrabajosForaneos, 'ClippedCell');
						}

						//Incrementar acumulados de la orden de reparación
						$intAcumCostoOrden += $intAcumCostoTF;
						$intAcumSubtotalOrden += $intAcumSubtotalTF;
						$intAcumIvaOrden += $intAcumIvaTF;
						$intAcumIepsOrden += $intAcumIepsTF;

						//Totales
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->ClippedCell(16, 4, 'TOTAL:', 0, 0, 'L', 0);
						//Acumulado de unidades
						$pdf->ClippedCell(114, 4, number_format($intAcumUnidadesTF,2), 0, 0, 'R', 0);
						//Acumulado del costo
						$pdf->ClippedCell(20, 4, '$'.number_format($intAcumCostoTF,2), 0, 0, 'R', 0);
						//Acumulado del subtotal
						$pdf->ClippedCell(40, 4, '$'.number_format($intAcumSubtotalTF,2), 0, 0, 'R', 0);
						//Dibuja una línea para separar el total
	    				$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
	    				$pdf->Ln(5);//Deja un salto de línea 

					}//Cierre de verificación de trabajos foráneos


					//Verificar si existe información de los otros servicios 
					if($arrOtros)
					{
	
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->Cell(190, 5, utf8_decode('OTROS'), 0, 1, 'L', 0);
						$pdf->SetTextColor(0); //establece el color de texto negro
						
						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraOtros);
						//Recorre el array de titulos de encabezado para crearlos
						for ($intCont = 0; $intCont < count($arrCabeceraOtros); $intCont++) 
						{ 
							$pdf->SetTextColor(0); //establece el color de texto
						   	//inserta los titulos de la cabecera
						    $pdf->Cell($arrAnchuraOtros[$intCont], 5, $arrCabeceraOtros[$intCont], 0, 0, 
						    		   $arrAlineacionOtros[$intCont], FALSE);
						}
						$pdf->Ln(4);//Deja un salto de línea 
						//Recorremos el arreglo 
				       	foreach ($arrOtros as $arrOtro) 
				        {

						   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						    $pdf->Row(array($arrOtro['concepto'], $arrOtro['producto_servicio'], 
						    				$arrOtro['unidad'], $arrOtro['cantidad'], $arrOtro['precio_unitario'], 
						    				$arrOtro['subtotal']),
						                    $arrAlineacionOtros, 'ClippedCell');
								
						}

						//Incrementar acumulados de la orden de reparación
						$intAcumSubtotalOrden += $intAcumSubtotalOtros;
						$intAcumIvaOrden += $intAcumIvaOtros;
						$intAcumIepsOrden += $intAcumIepsOtros;

						//Total de horas
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->ClippedCell(16, 4, 'TOTAL:', 0, 0, 'L', 0);
						//Acumulado de horas
						$pdf->ClippedCell(134, 4, number_format($intAcumUnidadesOtros,2), 0, 0, 'R', 0);
						//Acumulado del subtotal
						$pdf->ClippedCell(40, 4, '$'.number_format($intAcumSubtotalOtros,2), 0, 0, 'R', 0);
						//Dibuja una línea para separar el total
	    				$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
	    				$pdf->Ln(5);//Deja un salto de línea 

					}//Cierre de verificación de otros servicios

					//Si existe importe de gastos de servicio 
					if($intGatosServiciosSubtotal > 0)
					{
						//Gastos de servicio
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->ClippedCell(30, 4, 'GASTOS DE SERVICIO', 0, 0, 'L', 0);
						//Subtotal de gastos de servicios
						$pdf->ClippedCell(160, 4, '$'.number_format($intGatosServiciosSubtotal,2), 0, 0, 'R', 0);
						$pdf->Ln(5);//Deja un salto de línea 
					}//Cierre de verificación de gastos de servicio 


					//Calcular importe total
					$intTotalOrden = $intAcumSubtotalOrden + $intAcumIvaOrden + $intAcumIepsOrden;

					//Asigna el tipo y tamaño de letra para los totales
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->ClippedCell(130, 3, 'SUBTOTAL GENERAL', 0, 0, 'R');
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Costo general
					$pdf->ClippedCell(20, 3, '$'.number_format($intAcumCostoOrden,2), 0, 0, 'R');
					//Subtotal general
					$pdf->ClippedCell(40, 3, '$'.number_format($intAcumSubtotalOrden,2), 0, 0, 'R');
					//Espacios de salto de línea
					$pdf->Ln();
					//Asigna el tipo y tamaño de letra para los totales
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->ClippedCell(130, 3, 'IVA GENERAL', 0, 0, 'R');
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					//IVA del costo
					$pdf->ClippedCell(20, 3, '$0.00', 0, 0, 'R');
					//IVA del precio
					$pdf->ClippedCell(40, 3, '$'.number_format($intAcumIvaOrden,2), 0, 0, 'R');
					//Espacios de salto de línea
					$pdf->Ln();
					//Asigna el tipo y tamaño de letra para los totales
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->ClippedCell(130, 3, 'IEPS GENERAL', 0, 0, 'R');
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				    //IEPS del costo
				    $pdf->ClippedCell(20, 3, '$0.00', 0, 0, 'R');
				    //IEPS del precio
					$pdf->ClippedCell(40, 3, '$'.number_format($intAcumIepsOrden,2), 0, 0, 'R');
					//Espacios de salto de línea
					$pdf->Ln();
					//Asigna el tipo y tamaño de letra para los totales
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->ClippedCell(130, 3, 'TOTAL GENERAL', 0, 0, 'R');
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Total del costo
					$pdf->ClippedCell(20, 3, '$'.number_format($intAcumCostoOrden,2), 0, 0, 'R');
					//Total del precio
					$pdf->ClippedCell(40, 3, '$'.number_format($intTotalOrden,2), 0, 0, 'R');
					//Espacios de salto de línea
					$pdf->Ln();
				}
		       
				//Incrementar el contador por cada registro
				$intContador++;

				//Asignar id de la orden de reparación actual
      			$intOrdenReparacionIDActual = $arrCol->orden_reparacion_id;
			}

			$pdf->Ln(5);//Deja un salto de linea

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- RESUMEN
	        //------------------------------------------------------------------------------------------------------------------------
	        //Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//Crea los titulos de la cabecera
			$arrCabeceraResumen = array('ESTATUS', 'COSTO', 'SUBTOTAL', 'IVA', 'IEPS',  'TOTAL');
			//Establece el ancho de las columnas de cabecera
			$arrAnchuraResumen = array(49.8, 20, 20, 20, 20, 20);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacionResumen = array('L', 'R', 'R', 'R', 'R', 'R');
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
					$pdf->Row(array($arrEst,
									'$'.number_format($arrCostoEstatus[$arrEst],2),
									'$'.number_format($arrSubtotalEstatus[$arrEst],2), 
									'$'.number_format($arrIvaEstatus[$arrEst],2), 
			    				    '$'.number_format($arrIepsEstatus[$arrEst],2), 
			    				    '$'.number_format($arrTotalEstatus[$arrEst],2)), 
									$arrAlineacionResumen);

					//Incrementar acumulados si el estatus es  diferente de INACTIVO
					if($arrEst != 'INACTIVO')
					{
						//Incrementar acumulados
						$intAcumCostoEstatus += $arrCostoEstatus[$arrEst];
						$intAcumSubtotalEstatus += $arrSubtotalEstatus[$arrEst];
						$intAcumIvaEstatus += $arrIvaEstatus[$arrEst];
						$intAcumIepsEstatus += $arrIepsEstatus[$arrEst];
						$intAcumTotalEstatus += $arrTotalEstatus[$arrEst];
					}
				}
			}

			$pdf->SetTextColor(0); //establece el color de texto
			//Asigna el tipo y tamaño de letra para los totales
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Escribir totales
	    	$pdf->Cell(36.8,3,'TOTAL DE ORDENES: ', 0, 0, 'L');  
	    	//Total de registros
            $pdf->Cell(13,3,$intContador, 0, 0, 'R');
            //Acumulado del costo
            $pdf->Cell(20,3,'$'.number_format($intAcumCostoEstatus,2), 0, 0, 'R');
            //Acumulado del subtotal
            $pdf->Cell(20,3,'$'.number_format($intAcumSubtotalEstatus,2), 0, 0, 'R');
            //Acumulado del IVA
            $pdf->Cell(20,3,'$'.number_format($intAcumIvaEstatus,2), 0, 0, 'R');
           //Acumulado del IEPS
            $pdf->Cell(20,3,'$'.number_format($intAcumIepsEstatus,2), 0, 0, 'R');
            //Acumulado del importe total
            $pdf->Cell(20,3,'$'.number_format($intAcumTotalEstatus,2), 0, 0, 'R');
            $pdf->Ln(8);//Deja un salto de línea

		}
		
		//Ejecutar la salida del reporte
		$pdf->Output('ordenes_trabajo_servicio.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro() 
	{	            
		
		//Variables que se utilizan para recuperar los valores de la vista
		$strTipoReporte = $this->input->post('strTipoReporte');
		$intOrdenReparacionID = $this->input->post('intOrdenReparacionID');

		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->ordenes->buscar($intOrdenReparacionID);
		//Seleccionar los servicios del registro
		$otdServicios = $this->ordenes->buscar_servicios($intOrdenReparacionID, NULL, 'FINALIZADO');
		//Seleccionar los otros servicios del registro
		$otdOtros = $this->ordenes->buscar_otros($intOrdenReparacionID);
		//Seleccionar los trabajos foráneos del registro
		$otdTrabajosForaneos = $this->trabajos->buscar_detalles(NULL, $intOrdenReparacionID);
		//Seleccionar las salidas de refacciones del registro
		$otdSalidasRefacciones = $this->movimientos->buscar_detalles_salida_taller(NULL, NULL, 
																				   $this->intTipoMovimiento,
																			       $intOrdenReparacionID);
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variable que se utiliza para asignar el acumulado del costo general
	    $intAcumCostoGeneral = 0;
		//Variable que se utiliza para asignar el acumulado del subtotal general
	    $intAcumSubtotalGeneral = 0;
	    //Variable que se utiliza para asignar el acumulado del IVA general
	    $intAcumIvaGeneral = 0;
	    //Variable que se utiliza para asignar el acumulado del IEPS general
	    $intAcumIepsGeneral = 0;
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'orden_trabajo_servicio_';
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
	        //---------- DATOS DEL CLIENTE O PROSPECTO
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 42);
			$pdf->ClippedCell(92, 3, 'CLIENTE', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0); //establece el color de texto
			//RFC
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, 46);
			$pdf->ClippedCell(10, 3, 'RFC');
			//Nombre comercial
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
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

			//Verificar si el prospecto es un cliente
			if($otdResultado->cliente_estatus == 'ACTIVO')
			{
				//Asignar los datos del cliente
				$strNombreComercial = $otdResultado->razon_social;
				$strTelefonoPrincipal = $otdResultado->cliente_telefono_principal;
				$strCalle = $otdResultado->cliente_calle;
				$strNumExterior = $otdResultado->cliente_numero_exterior;
				$strNumInterior = $otdResultado->cliente_numero_interior;
				$strColonia = $otdResultado->cliente_colonia;
				$strCodigoPostal = $otdResultado->cliente_codigo_postal;
				$strLocalidad = $otdResultado->cliente_localidad;
				$strMunicipio = $otdResultado->cliente_municipio;
				$strEstado = $otdResultado->cliente_estado;
			}
			else
			{
				//Asignar los datos del prospecto
				$strNombreComercial = $otdResultado->prospecto;
				$strTelefonoPrincipal = $otdResultado->telefono_principal;
				$strCalle = $otdResultado->calle;
				$strNumExterior = $otdResultado->numero_exterior;
				$strNumInterior = $otdResultado->numero_interior;
				$strColonia = $otdResultado->colonia;
				$strCodigoPostal = $otdResultado->codigo_postal;
				$strLocalidad = $otdResultado->localidad;
				$strMunicipio = $otdResultado->municipio;
				$strEstado = $otdResultado->estado;
			}

			//Si no existe el número interior asignar cadena vacia
			$strNumInterior = (($strNumInterior !== NULL && 
				        	    empty($strNumInterior) === FALSE) ?
                                ' INT. '.$strNumInterior : '');

			//Si no existe el código postal asignar cadena vacia
			$strCodigoPostal = (($strCodigoPostal !== NULL && 
				        	     empty($strCodigoPostal) === FALSE) ?
                                 ' C.P. '.$strCodigoPostal : '');

			//Concatenar datos para el domicilio
	    	$strDomicilio =  $strCalle . ' NO.'.$strNumExterior;
	    	$strDomicilio .= $strNumInterior.' COL. ' . $strColonia;
	    	$strDomicilio .= $strCodigoPostal.' '.$strLocalidad. ', ';
	    	$strDomicilio .= $strMunicipio. ', '.$strEstado;

			//Nombre comercial
			$pdf->SetXY(15, 52);
			$pdf->MultiCell(92, 3, utf8_decode($strNombreComercial));
			//Teléfono
			$pdf->SetXY(92, 58);
			$pdf->ClippedCell(40, 3, $strTelefonoPrincipal);
			//Domicilio
			$pdf->SetXY(15, 61);
			$pdf->MultiCell(92, 3, utf8_decode($strDomicilio));


			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DE LA ORDEN DE REPARACIÓN
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(108, 42);
			$pdf->ClippedCell(92, 3, 'ORDEN DE TRABAJO SERVICIO', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0);//establece el color de texto
			//Folio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, 46);
			$pdf->ClippedCell(15, 3, 'FOLIO');
			//Fecha 
			$pdf->SetXY(160, 46);
			$pdf->ClippedCell(15, 3, 'FECHA');
			//Estatus
			$pdf->SetXY(108, 49);
			$pdf->ClippedCell(32, 3, 'ESTATUS');
			//Fecha de finalización
			$pdf->SetXY(108, 52);
			$pdf->ClippedCell(28, 3, utf8_decode('FINALIZACIÓN'));
			//Usuario de finalización
			$pdf->SetXY(160, 52);
			$pdf->ClippedCell(25, 3, 'USUARIO');
			//Tipo de servicio
			$pdf->SetXY(108, 55);
			$pdf->ClippedCell(28, 3, 'TIPO DE SERVICIO');
			//Tipo de reparación
			$pdf->SetXY(108, 58);
			$pdf->ClippedCell(28, 3, utf8_decode('TIPO REPARACIÓN'));
			//Motor
			$pdf->SetXY(160, 58);
			$pdf->ClippedCell(25, 3, utf8_decode('UBICACIÓN'));
			//Serie
			$pdf->SetXY(108, 61);
			$pdf->ClippedCell(28, 3, utf8_decode('SERIE'));
			//Motor
			$pdf->SetXY(160, 61);
			$pdf->ClippedCell(25, 3, 'MOTOR');
			//Tipo de equipo
			$pdf->SetXY(108, 64);
			$pdf->ClippedCell(28, 3, 'TIPO DE EQUIPO');
			//Falla
			$pdf->SetXY(15, 68);
			$pdf->ClippedCell(32, 3, 'FALLA');
			//Causa
			$pdf->SetXY(15, 71);
			$pdf->ClippedCell(32, 3, 'CAUSA');
			//Solución
			$pdf->SetXY(15, 74);
			$pdf->ClippedCell(32, 3, utf8_decode('SOLUCIÓN'));
			
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(135, 46);
			$pdf->ClippedCell(76, 3, $otdResultado->folio);
			//Fecha
			$pdf->SetXY(175, 46);
			$pdf->ClippedCell(29, 3, $otdResultado->fecha);
			//Estatus
			$pdf->SetXY(135, 49);
			$pdf->ClippedCell(30, 3, $otdResultado->estatus);
			//Fecha de finalización
			$pdf->SetXY(135, 52);
			$pdf->ClippedCell(30, 3, $otdResultado->fecha_finalizacion);
			//Usuario de finalización
			$pdf->SetXY(175, 52);
			$pdf->ClippedCell(30, 3, utf8_decode($otdResultado->usuario_finalizacion));
			//Tipo de servicio
			$pdf->SetXY(135, 55);
			$pdf->ClippedCell(60, 3, utf8_decode($otdResultado->servicio_tipo));
			//Tipo de reparación
			$pdf->SetXY(135, 58);
			$pdf->ClippedCell(30, 3, utf8_decode($otdResultado->tipo_reparacion));
			//Ubicación
			$pdf->SetXY(175, 58);
			$pdf->ClippedCell(30, 3, utf8_decode($otdResultado->ubicacion));
			//Serie
			$pdf->SetXY(135, 61);
			$pdf->ClippedCell(30, 3, utf8_decode($otdResultado->serie));
			//Motor
			$pdf->SetXY(175, 61);
			$pdf->ClippedCell(30, 3, utf8_decode($otdResultado->motor));
			//Tipo de equipo
			$pdf->SetXY(135, 64);
			$pdf->ClippedCell(60, 3, utf8_decode($otdResultado->equipo_tipo));
			
			//Falla
			$pdf->SetXY(30, 68);
			$pdf->ClippedCell(170, 3, utf8_decode($otdResultado->falla));
			//Causa
			$pdf->SetXY(30, 71);
			$pdf->ClippedCell(170, 3, utf8_decode($otdResultado->causa));
			//Solución
			$pdf->SetXY(30, 74);
			$pdf->ClippedCell(170, 3, utf8_decode($otdResultado->solucion));
		

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DE LA ORDEN DE REPARACIÓN
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetXY(15, 80);
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
			    //Variable que se utiliza para asignar el acumulado del costo
			    $intAcumCosto = 0;
				//Variable que se utiliza para asignar el acumulado del subtotal
			    $intAcumSubtotal = 0;
			    //Variable que se utiliza para asignar el acumulado del IVA
			    $intAcumIva = 0;
			    //Variable que se utiliza para asignar el acumulado del IEPS
			    $intAcumIeps = 0;

			    //Array que se utiliza para establecer los títulos de la cabecera
			    $arrCabeceraServicios = array();
			    //Array que se utiliza para establecer el ancho de las columnas de la cabecera
				$arrAnchuraServicios = array();
				//Array que se utiliza para establecer la alineación de la cabecera
			    $arrAlineacionServicios = array();
			    //Variable que se utiliza para cambiar el tamaño de la columna descripción
			    $intAnchDescripcion = 63;
			    //Variable que se utiliza para asignar el tamaño de la celda acumulado de las horas
			    $intTamHoras = 129;

			    //Si el reporte es con costos
			    if($strTipoReporte == 'ConCostos')
			    {
			    	//Cambiar el tamaño de la columna
			    	$intAnchDescripcion = 43;
			    	//Cambiar el tamaño de la celda
			    	$intTamHoras = 109;
			    }

			    //Agregar datos a los arrays de la cabecera
			    //Código
				$arrCabeceraServicios[] = utf8_decode('Código');
				$arrAnchuraServicios[] = 16;
				$arrAlineacionServicios[] = 'L';

				//Descripción
				$arrCabeceraServicios[] = utf8_decode('Descripción');
				$arrAnchuraServicios[] = $intAnchDescripcion;
				$arrAlineacionServicios[] = 'L';

				//Mecánico
				$arrCabeceraServicios[] = utf8_decode('Mecánico');
				$arrAnchuraServicios[] = 51;
				$arrAlineacionServicios[] = 'L';
				
				//Horas
				$arrCabeceraServicios[] = 'Horas';
				$arrAnchuraServicios[] = 15;
				$arrAlineacionServicios[] = 'R';

			    //Si el reporte es con costos
			    if($strTipoReporte == 'ConCostos')
			    {
			    	//Costo
			    	$arrCabeceraServicios[] = 'Costo';
			    	$arrAnchuraServicios[] = 20;
			    	$arrAlineacionServicios[] = 'R';
			    }

			    //Precio
			    $arrCabeceraServicios[] = 'Precio';
			    $arrAnchuraServicios[] = 20;
			    $arrAlineacionServicios[] = 'R';

			    //Subtotal
			    $arrCabeceraServicios[] = 'Subtotal';
			    $arrAnchuraServicios[] = 20;
			    $arrAlineacionServicios[] = 'R';


				
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
		        foreach ($otdServicios as $arrServ) 
		        {
		        	$pdf->SetX(15);
		        	//Array que se utiliza para agregar los datos del servicio
					$arrDatos = array();
					//Variable que se utiliza para asignar el importe de iva
					$intImporteIva = 0;
					//Variable que se utiliza para asignar el importe de ieps
					$intImporteIeps = 0;
					//Variable que se utiliza para asignar el subtotal 
					$intSubtotalUnitario = 0;
					//Variable que se utiliza para asignar el costo 
					$intCostoTotal = 0;

		        	//Asignar el porcentaje del IVA
		        	$intPorcentajeIva = $arrServ->porcentaje_iva;
		        	//Asignar el porcentaje del IEPS
		        	$intPorcentajeIeps = $arrServ->porcentaje_ieps;
		        	//Asignar horas de la mano de obra
		        	$intHoras = $arrServ->horas;
		        	//Asignar precio del servicio por mano de obra
		        	$intPrecio = $arrServ->precio;
		        	//Asignar costo del servicio por mano de obra
		        	$intCosto = $arrServ->costo;

		        	//Calcular subtotal
		        	$intSubtotalUnitario = $intHoras * $intPrecio;

		        	//Calcular costo
		        	$intCostoTotal  = $intHoras * $intCosto;

		        	//Calcular importe de IVA
					$intImporteIva = $intSubtotalUnitario * $intPorcentajeIva;

					//Si existe porcentaje de IEPS
					if($intPorcentajeIeps != '')
					{
						//Calcular importe de IEPS
						$intImporteIeps = $intSubtotalUnitario * $intPorcentajeIeps;
					}


					//Agregar al array los datos del servicio
			   	    $arrDatos[] = utf8_decode($arrServ->codigo);
			   	    $arrDatos[] = utf8_decode($arrServ->descripcion);
			   	    $arrDatos[] = utf8_decode($arrServ->mecanico);
			   	    $arrDatos[] = number_format($intHoras,2);

			   	    //Si el reporte es con costos
			   		if($strTipoReporte == 'ConCostos')
			    	{
			    		$arrDatos[] = '$'.number_format($intCosto,2);
			    	}

			    	$arrDatos[] = '$'.number_format($intPrecio,2);
			    	$arrDatos[] = '$'.number_format($intSubtotalUnitario,2);


				   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row($arrDatos,
				              $arrAlineacionServicios, 'ClippedCell');

				    //Incrementar acumulados por cada registro
				    $intTotalHoras += $intHoras;
				    $intAcumCosto += $intCostoTotal;
				    $intAcumSubtotal += $intSubtotalUnitario;
				    $intAcumIva += $intImporteIva;
					$intAcumIeps += $intImporteIeps;
				}

				//Incrementar acumulados generales
				$intAcumCostoGeneral += $intAcumCosto;
				$intAcumSubtotalGeneral += $intAcumSubtotal;
				$intAcumIvaGeneral += $intAcumIva;
				$intAcumIepsGeneral += $intAcumIeps;

				$pdf->SetX(15);
				//Total de horas
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(16, 4, 'TOTAL:', 0, 0, 'L', 0);
				//Acumulado de horas
				$pdf->ClippedCell($intTamHoras, 4, number_format($intTotalHoras,2), 0, 0, 'R', 0);
				//Si el reporte es con costos
			    if($strTipoReporte == 'ConCostos')
			    {
			    	//Acumulado del costo
					$pdf->ClippedCell(20, 4, '$'.number_format($intAcumCosto,2), 0, 0, 'R', 0);
				}
				
				//Acumulado del subtotal
				$pdf->ClippedCell(40, 4, '$'.number_format($intAcumSubtotal,2), 0, 0, 'R', 0);
				
				//Dibuja una línea para separar el total
				$pdf->Line(15, $pdf->GetY(), 200, $pdf->GetY());
				$pdf->Ln(6);//Deja un salto de línea
			}//Cierre de verificación de servicios

			//Verificar si existe información de las salidas de refacciones por taller
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
				//Variable que se utiliza para asignar el acumulado del costo
			    $intAcumCosto = 0;
				//Variable que se utiliza para asignar el acumulado del subtotal
			    $intAcumSubtotal = 0;
		     	//Variable que se utiliza para asignar el acumulado del IVA
			    $intAcumIva = 0;
			    //Variable que se utiliza para asignar el acumulado del IEPS
			    $intAcumIeps = 0;

			    //Array que se utiliza para establecer los títulos de la cabecera
			    $arrCabeceraSalidasRefacciones = array();
			    //Array que se utiliza para establecer el ancho de las columnas de la cabecera
				$arrAnchuraSalidasRefacciones = array();
				//Array que se utiliza para establecer la alineación de la cabecera
			    $arrAlineacionSalidasRefacciones = array();
			    //Variable que se utiliza para cambiar el tamaño de la columna descripción
			    $intAnchDescripcion = 49;
			    //Variable que se utiliza para asignar el tamaño de la celda acumulado de la cantidad
			    $intTamCantidad = 129;

			    //Si el reporte es con costos
			    if($strTipoReporte == 'ConCostos')
			    {
			    	//Cambiar el tamaño de la columna
			    	$intAnchDescripcion = 29;
			    	//Cambiar el tamaño de la celda
			    	$intTamCantidad = 109;
			    }

			    //Agregar datos a los arrays de la cabecera
			    //Folio
				$arrCabeceraSalidasRefacciones[] = 'Folio';
				$arrAnchuraSalidasRefacciones[] = 17;
				$arrAlineacionSalidasRefacciones[] = 'L';

				//Fecha
				$arrCabeceraSalidasRefacciones[] = 'Fecha';
				$arrAnchuraSalidasRefacciones[] = 13;
				$arrAlineacionSalidasRefacciones[] = 'C';

				//Requisición
				$arrCabeceraSalidasRefacciones[] =  utf8_decode('Requisición');
				$arrAnchuraSalidasRefacciones[] = 18;
				$arrAlineacionSalidasRefacciones[] = 'L';

				//Código
				$arrCabeceraSalidasRefacciones[] =  utf8_decode('Código');
				$arrAnchuraSalidasRefacciones[] = 18;
				$arrAlineacionSalidasRefacciones[] = 'L';


				//Descripción
				$arrCabeceraSalidasRefacciones[] =  utf8_decode('Descripción');
				$arrAnchuraSalidasRefacciones[] = $intAnchDescripcion;
				$arrAlineacionSalidasRefacciones[] = 'L';

				//Cantidad solicitada
				$arrCabeceraSalidasRefacciones[] =  'Solicitado';
				$arrAnchuraSalidasRefacciones[] = 15;
				$arrAlineacionSalidasRefacciones[] = 'R';

				//Cantidad
				$arrCabeceraSalidasRefacciones[] =  'Cantidad';
				$arrAnchuraSalidasRefacciones[] = 15;
				$arrAlineacionSalidasRefacciones[] = 'R';
			
				//Si el reporte es con costos
			    if($strTipoReporte == 'ConCostos')
			    {
			    	//Costo
			    	$arrCabeceraSalidasRefacciones[] = 'Costo';
			    	$arrAnchuraSalidasRefacciones[] = 20;
			    	$arrAlineacionSalidasRefacciones[] = 'R';
			    }

			    //Precio
			    $arrCabeceraSalidasRefacciones[] = 'Precio';
			    $arrAnchuraSalidasRefacciones[] = 20;
			    $arrAlineacionSalidasRefacciones[] = 'R';

			    //Subtotal
			    $arrCabeceraSalidasRefacciones[] = 'Subtotal';
			    $arrAnchuraSalidasRefacciones[] = 20;
			    $arrAlineacionSalidasRefacciones[] = 'R';

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
		        	//Array que se utiliza para agregar los datos de la salida de refacciones
					$arrDatos = array();
					//Variables que se utilizan para asignar valores del detalle
					$intCantidadSurtida = $arrSal->cantidad;
					$intCantidadDevolucion = $arrSal->cantidad_devolucion;
					$intTasaCuotaIeps = $arrSal->tasa_cuota_ieps;
		        	$intPorcentajeIva = $arrSal->porcentaje_iva;
		        	$intPorcentajeIeps = $arrSal->porcentaje_ieps;
		        	$intPrecioUnitario = $arrSal->precio_unitario;
		        	$intCostoUnitario = $arrSal->costo_unitario;

				    //Variable que se utiliza para asignar el importe de iva
					$intImporteIva = 0;
					//Variable que se utiliza para asignar el importe de ieps
					$intImporteIeps = 0;		
				    //Variable que se utiliza para asignar el subtotal 
					$intSubtotalUnitario = 0;
					//Variable que se utiliza para asignar el costo 
					$intCostoTotal = 0;

					//Decrementar cantidad devuelta
					$intCantidadFacturar = $intCantidadSurtida - $intCantidadDevolucion;

					//Calcular subtotal
					$intSubtotalUnitario = $intCantidadFacturar * $intPrecioUnitario;

					//Calcular costo
		        	$intCostoTotal  = $intCantidadFacturar * $intCostoUnitario;

					//Calcular importe de IVA
					$intImporteIva = $intSubtotalUnitario * $intPorcentajeIva;

					//Si existe id de la tasa de cuota del IEPS
					if($intTasaCuotaIeps > 0)
					{
						//Calcular importe de IEPS
						$intImporteIeps = $intSubtotalUnitario * $intPorcentajeIeps;
					}



					//Agregar al array los datos de la salida de refacciones
			   	    $arrDatos[] = $arrSal->folio;
			   	    $arrDatos[] = $arrSal->fecha;
			   	    $arrDatos[] = $arrSal->folio_requisicion;
			   	    $arrDatos[] = utf8_decode($arrSal->codigo);
			   	    $arrDatos[] = utf8_decode($arrSal->descripcion);
			   	    $arrDatos[] = number_format($arrSal->cantidad_solicitada,2);
			   	    $arrDatos[] = number_format($intCantidadFacturar,2);

			   	    //Si el reporte es con costos
			   		if($strTipoReporte == 'ConCostos')
			    	{
			    		$arrDatos[] = '$'.number_format($intCostoUnitario,2);
			    	}

			    	$arrDatos[] = '$'.number_format($intPrecioUnitario,2);
			    	$arrDatos[] = '$'.number_format($intSubtotalUnitario,2);



				    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row($arrDatos, $arrAlineacionSalidasRefacciones, 'ClippedCell');

				    //Incrementar acumulados por cada registro
				    $intAcumUnidades += $intCantidadFacturar;
				    $intAcumCosto += $intCostoTotal;
				    $intAcumSubtotal += $intSubtotalUnitario;
				    $intAcumIva += $intImporteIva;
				    $intAcumIeps += $intImporteIeps;

				}

				//Incrementar acumulados generales
				$intAcumCostoGeneral += $intAcumCosto;
				$intAcumSubtotalGeneral += $intAcumSubtotal;
				$intAcumIvaGeneral += $intAcumIva;
				$intAcumIepsGeneral += $intAcumIeps;

				$pdf->SetX(15);
				//Totales
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(16, 4, 'TOTAL:', 0, 0, 'L', 0);
				//Acumulado de unidades
				$pdf->ClippedCell($intTamCantidad, 4, number_format($intAcumUnidades,2), 0, 0, 'R', 0);
			    //Si el reporte es con costos
			    if($strTipoReporte == 'ConCostos')
			    {
				    //Acumulado del costo
					$pdf->ClippedCell(20, 4, '$'.number_format($intAcumCosto,2), 0, 0, 'R', 0);
				}
				//Acumulado del subtotal
				$pdf->ClippedCell(40, 4, '$'.number_format($intAcumSubtotal,2), 0, 0, 'R', 0);
				//Dibuja una línea para separar el total
				$pdf->Line(15, $pdf->GetY(), 200, $pdf->GetY());
				$pdf->Ln(6);//Deja un salto de línea

			}//Cierre de verificación de salidas de refacciones por taller

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
				//Variable que se utiliza para asignar el acumulado del costo
			    $intAcumCosto = 0;
				//Variable que se utiliza para asignar el acumulado del subtotal
			    $intAcumSubtotal = 0;
			    //Variable que se utiliza para asignar el acumulado del IVA
			    $intAcumIva = 0;
			    //Variable que se utiliza para asignar el acumulado del IEPS
			    $intAcumIeps = 0;

			    //Array que se utiliza para establecer los títulos de la cabecera
			    $arrCabeceraTrabajosForaneos = array();
			    //Array que se utiliza para establecer el ancho de las columnas de la cabecera
				$arrAnchuraTrabajosForaneos = array();
				//Array que se utiliza para establecer la alineación de la cabecera
			    $arrAlineacionTrabajosForaneos = array();
			    //Variable que se utiliza para cambiar el tamaño de la columna proveedor
			    $intAnchProveedor = 51;
			    //Variable que se utiliza para cambiar el tamaño de la columna descripción
			    $intAnchDescripcion = 50;
			    //Variable que se utiliza para asignar el tamaño de la celda acumulado de la cantidad
			    $intTamCantidad = 129;

			    //Si el reporte es con costos
			    if($strTipoReporte == 'ConCostos')
			    {
			    	//Cambiar el tamaño de las columnas
			    	$intAnchProveedor = 41;
			    	$intAnchDescripcion = 40;
			    	//Cambiar el tamaño de la celda
			    	$intTamCantidad = 109;
			    }

			    //Agregar datos a los arrays de la cabecera
			    //Folio
				$arrCabeceraTrabajosForaneos[] = 'Folio';
				$arrAnchuraTrabajosForaneos[] = 16;
				$arrAlineacionTrabajosForaneos[] = 'L';

				//Fecha
				$arrCabeceraTrabajosForaneos[] = 'Fecha';
				$arrAnchuraTrabajosForaneos[] = 13;
				$arrAlineacionTrabajosForaneos[] = 'C';

				//Proveedor
				$arrCabeceraTrabajosForaneos[] = 'Proveedor';
				$arrAnchuraTrabajosForaneos[] = $intAnchProveedor;
				$arrAlineacionTrabajosForaneos[] = 'L';

				//Descripción
				$arrCabeceraTrabajosForaneos[] = utf8_decode('Descripción');
				$arrAnchuraTrabajosForaneos[] = $intAnchDescripcion;
				$arrAlineacionTrabajosForaneos[] = 'L';

				//Cantidad
				$arrCabeceraTrabajosForaneos[] = 'Cantidad';
				$arrAnchuraTrabajosForaneos[] = 15;
				$arrAlineacionTrabajosForaneos[] = 'R';


				//Si el reporte es con costos
			    if($strTipoReporte == 'ConCostos')
			    {
			    	//Costo
			    	$arrCabeceraTrabajosForaneos[] = 'Costo';
			    	$arrAnchuraTrabajosForaneos[] = 20;
			    	$arrAlineacionTrabajosForaneos[] = 'R';
			    }

			    //Precio
			    $arrCabeceraTrabajosForaneos[] = 'Precio';
			    $arrAnchuraTrabajosForaneos[] = 20;
			    $arrAlineacionTrabajosForaneos[] = 'R';

			    //Subtotal
			    $arrCabeceraTrabajosForaneos[] = 'Subtotal';
			    $arrAnchuraTrabajosForaneos[] = 20;
			    $arrAlineacionTrabajosForaneos[] = 'R';
				
				//Recorre el array de títulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabeceraTrabajosForaneos); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchuraTrabajosForaneos[$intCont], 3, 
							   $arrCabeceraTrabajosForaneos[$intCont], 1, 0, 
							   $arrAlineacionTrabajosForaneos[$intCont], TRUE);
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
		        	//Array que se utiliza para agregar los datos del trabajo foráneo
					$arrDatos = array();
		        	//Variables que se utilizan para asignar valores del detalle
					$intCantidad = number_format($arrTrab->cantidad, 2, '.', '');
					$intCantidadCosto = $arrTrab->cantidad;
					$intPrecioUnitario = $arrTrab->precio_unitario;
					$intCostoUnitario = $arrTrab->costo_unitario;
				    $intPorcentajeIva = $arrTrab->porcentaje_iva;
				    $intPorcentajeIeps = $arrTrab->porcentaje_ieps;
				    $intTasaCuotaIeps = $arrTrab->tasa_cuota_ieps;
				    $strTipoTasaCuotaIeps = $arrTrab->tipo_ieps;
    				$strFactorTasaCuotaIeps = $arrTrab->factor_ieps;
    				$intIepsUnitario =  $arrTrab->ieps_unitario;
					//Variable que se utiliza para asignar el importe de IVA
					$intImporteIva = 0;
					//Variable que se utiliza para asignar el importe de IEPS
					$intImporteIepsCosto = 0;	
				    //Variable que se utiliza para asignar el subtotal 
					$intSubtotalUnitario = 0;
					//Variable que se utiliza para asignar el costo 
					$intCostoTotal = 0;

		        	//Calcular subtotal
					$intSubtotalUnitario = $intCantidad * $intPrecioUnitario;

					//Calcular costo
		        	$intCostoTotal  = $intCantidadCosto * $intCostoUnitario;

					//Calcular importe de IVA
					$intImporteIva = $intSubtotalUnitario * $intPorcentajeIva;

					//Si existe id de la tasa de cuota del IEPS
					if($intTasaCuotaIeps > 0)
					{
						//Si la tasa de cuota no es de tipo RANGO ni su factor es Cuota
						if($strTipoTasaCuotaIeps !== 'RANGO' && $strFactorTasaCuotaIeps !=='Cuota')
						{
							//Calcular importe de IEPS
							$intImporteIeps = $intSubtotalUnitario * $intPorcentajeIeps;
						}

					    //Si la tasa de cuota es de tipo RANGO y su factor es Cuota
						if($strTipoTasaCuotaIeps == 'RANGO' && $strFactorTasaCuotaIeps == 'Cuota')
						{
							//Calcular importe de IEPS
					    	$intImporteIepsCosto =  $intIepsUnitario * $intCantidadCosto;
							//Sumarle al subtotal el importe de ieps
							$intCostoTotal += $intImporteIepsCosto;
						}
					}

					//Agregar al array los datos del trabajo foráneo
			   	    $arrDatos[] = $arrTrab->folio;
			   	    $arrDatos[] = $arrTrab->fecha;
			   	    $arrDatos[] = utf8_decode($arrTrab->proveedor);
			   	    $arrDatos[] = utf8_decode($arrTrab->concepto);
			   	    $arrDatos[] = number_format($intCantidad,2);

			   	    //Si el reporte es con costos
			   		if($strTipoReporte == 'ConCostos')
			    	{
			    		$arrDatos[] = '$'.number_format($intCostoUnitario,2);
			    	}

			    	$arrDatos[] = '$'.number_format($intPrecioUnitario,2);
			    	$arrDatos[] = '$'.number_format($intSubtotalUnitario,2);




				    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row($arrDatos, $arrAlineacionTrabajosForaneos, 'ClippedCell');


				    //Incrementar acumulados por cada registro
				    $intAcumUnidades += $intCantidad;
				    $intAcumCosto += $intCostoTotal;
				    $intAcumSubtotal += $intSubtotalUnitario;
				    $intAcumIva += $intImporteIva;
					$intAcumIeps += $intImporteIeps;
				}

				//Incrementar acumulados generales
				$intAcumCostoGeneral += $intAcumCosto;
				$intAcumSubtotalGeneral += $intAcumSubtotal;
				$intAcumIvaGeneral += $intAcumIva;
				$intAcumIepsGeneral += $intAcumIeps;

				$pdf->SetX(15);
				//Totales
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(16, 4, 'TOTAL:', 0, 0, 'L', 0);
				//Acumulado de unidades
				$pdf->ClippedCell($intTamCantidad, 4, number_format($intAcumUnidades,2), 0, 0, 'R', 0);
				//Si el reporte es con costos
			    if($strTipoReporte == 'ConCostos')
			    {
					//Acumulado del costo
					$pdf->ClippedCell(20, 4, '$'.number_format($intAcumCosto,2), 0, 0, 'R', 0);
				}
				//Acumulado del subtotal
				$pdf->ClippedCell(40, 4, '$'.number_format($intAcumSubtotal,2), 0, 0, 'R', 0);
				//Dibuja una línea para separar el total
				$pdf->Line(15, $pdf->GetY(), 200, $pdf->GetY());
				$pdf->Ln(6);//Deja un salto de línea

			}//Cierre de verificación de trabajos foráneos



			//Verificar si existe información de los otros servicio
			if($otdOtros)
			{
				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->ClippedCell(185, 3, utf8_decode('OTROS'), 0, 0, 'L', TRUE);
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

			    //Array que se utiliza para establecer los títulos de la cabecera
			    $arrCabeceraOtros = array('Concepto', utf8_decode('Código SAT'), 'Unidad SAT', 'Cantidad',
										  'Precio', 'Subtotal');
			    //Array que se utiliza para establecer el ancho de las columnas de la cabecera
				$arrAnchuraOtros = array(45, 45, 35, 20, 20, 20);
				//Array que se utiliza para establecer la alineación de la cabecera
			    $arrAlineacionOtros = array('L', 'L', 'L', 'R', 'R', 'R');
			    
				//Recorre el array de títulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabeceraOtros); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchuraOtros[$intCont], 3, 
							   $arrCabeceraOtros[$intCont], 1, 0, 
							   $arrAlineacionOtros[$intCont], TRUE);
				}
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraOtros);
				//Recorremos el arreglo 
		        foreach ($otdOtros as $arrOtro) 
		        {
		        	$pdf->SetX(15);
		        	//Variables que se utilizan para asignar valores del detalle
					$intCantidad = number_format($arrOtro->cantidad, 2, '.', '');
					$intPrecioUnitario = $arrOtro->precio_unitario;
				    $intPorcentajeIva = $arrOtro->porcentaje_iva;
				    $intPorcentajeIeps = $arrOtro->porcentaje_ieps;
				    $intTasaCuotaIeps = $arrOtro->tasa_cuota_ieps;
					//Variable que se utiliza para asignar el importe de IVA
					$intImporteIva = 0;
					//Variable que se utiliza para asignar el importe de IEPS
					$intImporteIeps = 0;
				    //Variable que se utiliza para asignar el subtotal 
					$intSubtotalUnitario = 0;

		        	//Calcular subtotal
					$intSubtotalUnitario = $intCantidad * $intPrecioUnitario;

					//Calcular importe de IVA
					$intImporteIva = $intSubtotalUnitario * $intPorcentajeIva;

					//Si existe id de la tasa de cuota del IEPS
					if($intTasaCuotaIeps > 0)
					{
						//Calcular importe de IEPS
						$intImporteIeps = $intSubtotalUnitario * $intPorcentajeIeps;
					}


				    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row(array(utf8_decode($arrOtro->concepto), 
				    				utf8_decode($arrOtro->producto_servicio),
				    				utf8_decode($arrOtro->unidad),  
				    				number_format($intCantidad,2), 
				    				'$'.number_format($intPrecioUnitario,2),
				    				'$'.number_format($intSubtotalUnitario,2)), 
				    				$arrAlineacionOtros, 'ClippedCell');

				    //Incrementar acumulados por cada registro
				    $intAcumUnidades += $intCantidad;
				    $intAcumSubtotal += $intSubtotalUnitario;
				    $intAcumIva += $intImporteIva;
					$intAcumIeps += $intImporteIeps;
				}

				//Incrementar acumulados generales
				$intAcumSubtotalGeneral += $intAcumSubtotal;
				$intAcumIvaGeneral += $intAcumIva;
				$intAcumIepsGeneral += $intAcumIeps;

				$pdf->SetX(15);
				//Totales
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(16, 4, 'TOTAL:', 0, 0, 'L', 0);
				//Acumulado de unidades
				$pdf->ClippedCell(129, 4, number_format($intAcumUnidades,2), 0, 0, 'R', 0);
				//Acumulado del subtotal
				$pdf->ClippedCell(40, 4, '$'.number_format($intAcumSubtotal,2), 0, 0, 'R', 0);
				//Dibuja una línea para separar el total
				$pdf->Line(15, $pdf->GetY(), 200, $pdf->GetY());
				$pdf->Ln(6);//Deja un salto de línea

			}//Cierre de verificación de otros servicios

			//Si existe importe de gastos de servicio 
			if($otdResultado->gastos_servicio > 0)
			{
				$pdf->SetX(15);
				//Asignar subtotal del gasto de servicio
				$intGatosServiciosSubtotal = $otdResultado->gastos_servicio;
				//Asignar IVA del gasto de servicio
				$intGatosServiciosIva = $otdResultado->gastos_servicio_iva;
				
				//Gastos de servicios
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(30, 4, 'GASTOS DE SERVICIO', 0, 0, 'L', 0);
				//Subtotal de gastos de servicios
				$pdf->ClippedCell(155, 4,  '$'.number_format($intGatosServiciosSubtotal,2), 0, 0, 'R', 0);

				//Incrementar acumulados generales
				$intAcumSubtotalGeneral += $intGatosServiciosSubtotal;
				$intAcumIvaGeneral += $intGatosServiciosIva;

				$pdf->Ln(5); //Deja un salto de línea

			}//Cierre de verificación de gastos de servicio 

			//Calcular importe total
			$intTotalGeneral = $intAcumSubtotalGeneral + $intAcumIvaGeneral + $intAcumIepsGeneral;
			//Redondear importe total a dos decimales
			$intTotalGeneral = number_format($intTotalGeneral,2);

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
			//Cambiar color de relleno de la celda
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetX(15);
			$pdf->ClippedCell(185, 3, '', 0, 0, 'C', TRUE);
			$pdf->Ln(); //Deja un salto de línea
			$intPosY = $pdf->GetY();
			//Observaciones
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(15);
			$pdf->ClippedCell(30, 3, 'OBSERVACIONES');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
		    
		   
		   //Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		   //Subtotal general
			$pdf->SetXY(112, $intPosY);
			$pdf->ClippedCell(30, 3, 'SUBTOTAL GENERAL');

			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Si el reporte es con costos
			if($strTipoReporte == 'ConCostos')
			{
				//Costo general
				$pdf->SetX(140);
				$pdf->ClippedCell(20, 3, '$'.number_format($intAcumCostoGeneral,2), 0, 0, 'R');
			}
			//Subtotal general
			$pdf->SetX(180);
			$pdf->ClippedCell(20, 3, '$'.number_format($intAcumSubtotalGeneral,2), 0, 0, 'R');
			$pdf->Ln(); //Deja un salto de línea
		    $intPosY = $pdf->GetY();

		    //Observaciones
		    $pdf->SetX(15);
		    $pdf->MultiCell(105, 3, utf8_decode($otdResultado->observaciones));


		    //Si se cumple la sentencia
			if($intPosY >= 260)
			{
				 $intPosY = $pdf->GetY();
				 $pdf->Ln(); //Deja un salto de línea
				
		    }

			//IVA general
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(112,$intPosY);
			$pdf->ClippedCell(30, 3, 'IVA GENERAL');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Si el reporte es con costos
			if($strTipoReporte == 'ConCostos')
			{
				//Iva del costo
				$pdf->SetX(140);
				$pdf->ClippedCell(20, 3, '$0.00', 0, 0, 'R');
			}
			//IVA del precio
			$pdf->SetX(180);
			$pdf->ClippedCell(20, 3, '$'.number_format($intAcumIvaGeneral,2), 0, 0, 'R');
			$pdf->Ln(); //Deja un salto de línea
			//IEPS general
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(112);
			$pdf->ClippedCell(20, 3, 'IEPS GENERAL');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Si el reporte es con costos
			if($strTipoReporte == 'ConCostos')
			{
				//IEPS del costo
				$pdf->SetX(140);
				$pdf->ClippedCell(20, 3, '$0.00', 0, 0, 'R');
			}
			//IEPS del precio
			$pdf->SetX(180);
			$pdf->ClippedCell(20, 3, '$'.number_format($intAcumIepsGeneral,2), 0, 0, 'R');
			$pdf->Ln(); //Deja un salto de línea
			//Total general
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(112);
			$pdf->ClippedCell(30, 3, 'TOTAL GENERAL');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Si el reporte es con costos
			if($strTipoReporte == 'ConCostos')
			{
				//Total del costo
				$pdf->SetX(140);
				$pdf->ClippedCell(20, 3,'$'.number_format($intAcumCostoGeneral,2), 0, 0, 'R');
			}
			//Total del precio
			$pdf->SetX(180);
			$pdf->ClippedCell(20, 3, '$'.$intTotalGeneral, 0, 0, 'R');
			$pdf->Ln(); //Deja un salto de línea
			
			//Asignar posición de la ordenada
			$intPosY = $pdf->GetY();

			//Si se cumple la sentencia
			if($intPosY >= POSY_SALTO_PAGINA)
			{
				 //Emitir un salto de página
				 $pdf->CheckPageBreak($intPosY);

			}
			
			//Gerente de taller
            $pdf->SetXY(15, 260);
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
           	$pdf->SetX(109);
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
		$intProspectoID = $this->input->post('intProspectoID');
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
		$otdResultado = $this->ordenes->buscar(NULL, $dteFechaInicial, $dteFechaFinal,  $intProspectoID, 
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
			     ->setCellValue('A7', 'LISTADO DE ORDENES DE TRABAJO '.$strTituloRangoFechas);
		//Si existe id del prospecto
		if($intProspectoID > 0)
		{   
			//Seleccionar los datos del prospecto que coincide con el id
			$otdProspecto =  $this->prospectos->buscar($intProspectoID, NULL, 'referencias');
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'CLIENTE: '.$otdProspecto->prospecto);
		}

		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'CLIENTE')
        		 ->setCellValue('C'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('D'.$intPosEncabezados, 'FECHA DE FINALIZACIÓN')
        		 ->setCellValue('E'.$intPosEncabezados, 'USUARIO')
        		 ->setCellValue('F'.$intPosEncabezados, 'TIPO DE SERVICIO')
        		 ->setCellValue('G'.$intPosEncabezados, 'TIPO DE REPARACIÓN')
        		 ->setCellValue('H'.$intPosEncabezados, 'UBICACIÓN')
        		 ->setCellValue('I'.$intPosEncabezados, 'SERIE')
        		 ->setCellValue('J'.$intPosEncabezados, 'MOTOR')
        		 ->setCellValue('K'.$intPosEncabezados, 'TIPO DE EQUIPO')
        		 ->setCellValue('L'.$intPosEncabezados, 'MAQUINARIA')
        		 ->setCellValue('M'.$intPosEncabezados, 'HORAS DE USO')
        		 ->setCellValue('N'.$intPosEncabezados, 'GASTOS DE SERVICIO')
        		 ->setCellValue('O'.$intPosEncabezados, 'FALLA')
        		 ->setCellValue('P'.$intPosEncabezados, 'CAUSA')
        		 ->setCellValue('Q'.$intPosEncabezados, 'SOLUCIÓN')
        		 ->setCellValue('R'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('S'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('T'.$intPosEncabezados, 'IEPS')
        		 ->setCellValue('U'.$intPosEncabezados, 'TOTAL')
        		 ->setCellValue('V'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('W'.$intPosEncabezados, 'ESTATUS');

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
    			 ->getStyle('A10:W10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:W10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:W10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
            //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('X'.$intPosEncabezados, 'MANO DE OBRA CÓDIGO')
			         ->setCellValue('Y'.$intPosEncabezados, 'DESCRIPCIÓN')
			         ->setCellValue('Z'.$intPosEncabezados,'HORAS')
			         ->setCellValue('AA'.$intPosEncabezados,'PRECIO')
			         ->setCellValue('AB'.$intPosEncabezados,'SUBTOTAL')
			         ->setCellValue('AC'.$intPosEncabezados, 'MECÁNICO')
			         ->setCellValue('AD'.$intPosEncabezados, 'ESTATUS');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('X'.$intPosEncabezados.':AD'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('X'.$intPosEncabezados.':AD'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('X'.$intPosEncabezados.':AD'.$intPosEncabezados)
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

		        
			    //Seleccionar los servicios del registro
				$otdServicios = $this->ordenes->buscar_servicios($arrCol->orden_reparacion_id);
				//Verificar si existe información de los servicios
				if($otdServicios)
			    {
			    	//Variable que se utiliza para contar el número de servicios
			    	$intContServ = 0;

			    	//Si se cumple la sentencia mostrar detalles del registro
					if($strDetalles == 'SI')
					{
					   //Asignar el número de servicios
						$intNumDetalles = count($otdServicios); 
					}//Cierre de verificación de detalles

			    	//Recorremos el arreglo 
			        foreach ($otdServicios as $arrServ) 
			        {
			        	//Variable que se utiliza para asignar el importe de iva
						$intImporteIva = 0;
						//Variable que se utiliza para asignar el importe de ieps
						$intImporteIeps = 0;
			        	//Asignar el porcentaje del IVA
			        	$intPorcentajeIva = $arrServ->porcentaje_iva;
			        	//Asignar el porcentaje del IEPS
			        	$intPorcentajeIeps = $arrServ->porcentaje_ieps;
			        	//Asignar horas de la mano de obra
			        	$intHoras = $arrServ->horas;
			        	//Asignar precio del servicio por mano de obra
			        	$intPrecio = $arrServ->precio;

			        	//Calcular subtotal
			        	$intSubtotalUnitario = $intHoras * $intPrecio;

			        	//Calcular importe de IVA
						$intImporteIva = $intSubtotalUnitario * $intPorcentajeIva;

						//Si existe porcentaje de IEPS
						if($intPorcentajeIeps != '')
						{
							//Calcular importe de IEPS
							$intImporteIeps = $intSubtotalUnitario * $intPorcentajeIeps;
						}


			        	//Agregar datos al array
			        	$arrDetalles[$intContServ]['codigo']= $arrServ->codigo;
			        	$arrDetalles[$intContServ]['descripcion']= $arrServ->descripcion;
			        	$arrDetalles[$intContServ]['horas']= $intHoras;
			        	$arrDetalles[$intContServ]['precio']= $intPrecio;
			        	$arrDetalles[$intContServ]['subtotal']= $intSubtotalUnitario;
			        	$arrDetalles[$intContServ]['mecanico']= $arrServ->mecanico;
			            $arrDetalles[$intContServ]['estatus']= $arrServ->estatus;


			        	//Incrementar acumulados
						$intAcumSubtotal += $intSubtotalUnitario;
						$intAcumIva += $intImporteIva;
						$intAcumIeps += $intImporteIeps;

			        	//Incrementar el contador por cada registro
                        $intContServ++;
			        }

			    }//Cierre de verificación de servicios
				    
				

				//Calcular importe total
				$intTotal = $intAcumSubtotal +$intAcumIva + $intAcumIeps;


				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    {
			    	//Calcular el importe total del gasto de servicio
					$intGastosServicioTotal =  $arrCol->gastos_servicio + $arrCol->gastos_servicio_iva;

			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('B'.$intFila, $arrCol->prospecto)
	                         ->setCellValue('C'.$intFila, $arrCol->fecha)
	                         ->setCellValue('D'.$intFila, $arrCol->fecha_finalizacion)
	                         ->setCellValue('E'.$intFila, $arrCol->usuario_finalizacion)
	                         ->setCellValue('F'.$intFila, $arrCol->servicio_tipo)
	                         ->setCellValue('G'.$intFila, $arrCol->tipo_reparacion)
	                         ->setCellValue('H'.$intFila, $arrCol->ubicacion)
	                         ->setCellValue('I'.$intFila, $arrCol->serie)
	                         ->setCellValue('J'.$intFila, $arrCol->motor)
	                         ->setCellValue('K'.$intFila, $arrCol->equipo_tipo)
	                         ->setCellValue('L'.$intFila, $arrCol->maquinaria_descripcion)
	                         ->setCellValue('M'.$intFila, $arrCol->horas)
	                         ->setCellValue('N'.$intFila, $intGastosServicioTotal)
	                         ->setCellValue('O'.$intFila, $arrCol->falla)
	                         ->setCellValue('P'.$intFila, $arrCol->causa)
	                         ->setCellValue('Q'.$intFila, $arrCol->solucion)
	                         ->setCellValue('R'.$intFila, $intAcumSubtotal)
	                         ->setCellValue('S'.$intFila, $intAcumIva)
	                         ->setCellValue('T'.$intFila, $intAcumIeps)
	                         ->setCellValue('U'.$intFila, $intTotal)
	                         ->setCellValue('V'.$intFila, $arrCol->observaciones)
	                         ->setCellValue('W'.$intFila, $arrCol->estatus);


	                 //Si se cumple la sentencia mostrar detalles del registro
				    if($arrDetalles && $strDetalles == 'SI')
		            {
					    //Agregar información del servicio
						$objExcel->setActiveSheetIndex(0)
								 ->setCellValueExplicit('X'.$intFila, $arrDetalles[$intContDet]['codigo'], PHPExcel_Cell_DataType::TYPE_STRING)
	                             ->setCellValue('Y'.$intFila, $arrDetalles[$intContDet]['descripcion'])
	                             ->setCellValue('Z'.$intFila, $arrDetalles[$intContDet]['horas'])
	                             ->setCellValue('AA'.$intFila, $arrDetalles[$intContDet]['precio'])
	                             ->setCellValue('AB'.$intFila, $arrDetalles[$intContDet]['subtotal'])
	                             ->setCellValue('AC'.$intFila,  $arrDetalles[$intContDet]['mecanico'])
	                             ->setCellValue('AD'.$intFila,  $arrDetalles[$intContDet]['estatus']);
		            }

	                //Incrementar el indice para escribir los datos del siguiente registro
                	$intFila++; 

			    }
				
                //Incrementar el contador por cada registro
				$intContador++;
			}
			
			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('N'.$intFilaInicial.':'.'N'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

           	$objExcel->getActiveSheet()
            		 ->getStyle('R'.$intFilaInicial.':'.'U'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            $objExcel->getActiveSheet()
            		 ->getStyle('AA'.$intFilaInicial.':'.'AB'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar contenido de las celdas a formato númerico
			$objExcel->getActiveSheet()
            		 ->getStyle('M'.$intFilaInicial.':'.'M'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

			$objExcel->getActiveSheet()
            		 ->getStyle('Z'.$intFilaInicial.':'.'Z'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'D'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

           	$objExcel->getActiveSheet()
		        	 ->getStyle('M'.$intFilaInicial.':'.'N'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('R'.$intFilaInicial.':'.'U'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			$objExcel->getActiveSheet()
                	 ->getStyle('W'.$intFilaInicial.':'.'W'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

           	$objExcel->getActiveSheet()
		        	 ->getStyle('Z'.$intFilaInicial.':'.'AB'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		    $objExcel->getActiveSheet()
                	 ->getStyle('AD'.$intFilaInicial.':'.'AD'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('W'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('W'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'ordenes_trabajo_servicio.xls', 'ordenes de trabajo', $intFila);
	}


	/*******************************************************************************************************************
	Funciones de la tabla ordenes_reparacion_servicios
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion_servicios()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->ordenes->filtro_servicios($this->input->post('intOrdenReparacionID'),
					                               $config['per_page'],
					                               $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Asignar el estatus de la orden de reparación
		$strEstatusOrdenReparacion = $this->input->post('strEstatusOrdenReparacion');
		//Asignar el total de servicios activos
		$intTotalServiciosActivos = $result['total_servicios_activos'];

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['servicios'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionFinalizar = 'no-mostrar';
			$arrDet->mostrarAccionReactivar = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = '';

            //Si el estatus de la orden de reparación es ACTIVO (mostrar botones)
            if($strEstatusOrdenReparacion == 'ACTIVO')
            {
            	//Si el estatus del registro es ACTIVO
				if($arrDet->estatus == 'ACTIVO')
				{
					//Si el usuario cuenta con el permiso de acceso EDITAR
					if (in_array('EDITAR', $arrPermisos))
					{
						//Asignar cadena vacia para mostrar botón Editar
						$arrDet->mostrarAccionEditar = '';
					}
				}
				else
				{
					//Si el usuario cuenta con el permiso de acceso VER REGISTRO
					if (in_array('VER REGISTRO', $arrPermisos))
					{
						$arrDet->mostrarAccionVerRegistro = '';
					}

					//Si el estatus del registro es SUSPENDIDO
					if($arrDet->estatus == 'SUSPENDIDO')
					{
						//Si no existen servicios activos
						if($intTotalServiciosActivos == 0)
						{
							//Si el usuario cuenta con el permiso de acceso REACTIVAR ORDEN DE REPARACION
							if (in_array('REACTIVAR ORDEN DE REPARACION', $arrPermisos))
							{
								//Asignar cadena vacia para mostrar botón Reactivar
								$arrDet->mostrarAccionReactivar = '';
							}
						}
						
					}

					
				}

				//Si el usuario cuenta con el permiso de acceso FINALIZAR ORDEN DE REPARACION
				if (in_array('FINALIZAR ORDEN DE REPARACION', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Finalizar
					$arrDet->mostrarAccionFinalizar = '';
				}
            }
			

			$arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['servicios'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_servicios_activos' => $intTotalServiciosActivos,
						  'total_rows' => $config['total_rows']);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para guardar o modificar los datos de un registro
	public function guardar_servicios()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objServicioMO = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objServicioMO->intOrdenReparacionID = $this->input->post('intOrdenReparacionID');
		$objServicioMO->intRenglon = $this->input->post('intRenglon');
		$objServicioMO->intServicioID = $this->input->post('intServicioID');
		$objServicioMO->intHoras = $this->input->post('intHoras');
		$objServicioMO->intPrecio = $this->input->post('intPrecio');
		$objServicioMO->intCosto = $this->input->post('intCosto');
		$objServicioMO->intMecanicoID = $this->input->post('intMecanicoID');
		$objServicioMO->intUsuarioID = $this->session->userdata('usuario_id');
        //Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objServicioMO->intRenglon))
		{
			$bolResultado = $this->ordenes->modificar_servicios($objServicioMO);
		}
		else
		{ 
			$bolResultado = $this->ordenes->guardar_servicios($objServicioMO);
		}
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

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

    //Método para regresar los datos de un registro
	public function get_datos_servicios()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intOrdenReparacionID = $this->input->post('intOrdenReparacionID');
		$intRenglon = $this->input->post('intRenglon');
		//Seleccionar los datos del registro que coincide con los id's
		$otdResultado = $this->ordenes->buscar_servicios($intOrdenReparacionID, $intRenglon);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
		}

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus_servicios()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intOrdenReparacionID', 'ID', 'required|integer');
		$this->form_validation->set_rules('intRenglon', 'Renglón', 'required|integer');
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
	        $intOrdenReparacionID = $this->input->post('intOrdenReparacionID');
	        $intRenglon = $this->input->post('intRenglon');

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->ordenes->set_estatus_servicios($intOrdenReparacionID, $intRenglon);
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

	/*******************************************************************************************************************
	Funciones de la tabla ordenes_reparacion_servicios_tiempos
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion_servicios_tiempos()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->ordenes->filtro_servicios_tiempos($this->input->post('intOrdenReparacionID'),
											       		   $this->input->post('intServicioID'),
											       		   $this->input->post('intRenglon'),
					                                       $config['per_page'],
					                                       $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['tiempos'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = '';

			//Si el estatus del registro es ACTIVO
			if($arrDet->estatus == 'ACTIVO')
			{
				//Si el usuario cuenta con el permiso de acceso EDITAR
				if (in_array('EDITAR', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Editar
					$arrDet->mostrarAccionEditar = '';
				}
			}
			else
			{
				//Si el usuario cuenta con el permiso de acceso VER REGISTRO
				if (in_array('VER REGISTRO', $arrPermisos))
				{
					$arrDet->mostrarAccionVerRegistro = '';
				}

				$arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;
			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['tiempos'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows']);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para  modificar los datos de un registro
	public function modificar_servicios_tiempos()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objServicioT = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		$objServicioT->intOrdenReparacionTiempoID = $this->input->post('intOrdenReparacionTiempoID');
		$objServicioT->intOrdenReparacionID = $this->input->post('intOrdenReparacionID');
		$objServicioT->intRenglon = $this->input->post('intRenglon');
		$objServicioT->intMotivoSuspensionID = $this->input->post('intMotivoSuspensionID');
		$objServicioT->intUsuarioID = $this->session->userdata('usuario_id');

		//Actualizamos los datos del registro
		$bolResultado = $this->ordenes->modificar_servicios_tiempos($objServicioT);

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
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para regresar los datos de un registro
	public function get_datos_servicios_tiempos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intOrdenReparacionTiempoID = $this->input->post('intOrdenReparacionTiempoID');
		//Seleccionar los datos del registro que coincide con los id
		$otdResultado = $this->ordenes->buscar_servicios_tiempos($intOrdenReparacionTiempoID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
		}

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*******************************************************************************************************************
	Funciones de para obtener los detalles correspondientes a la orden de reparación. 
	Mismos que posteriormente serán de la factura
	*********************************************************************************************************************/
	//Función para obtener los detalles (mano de obra, refacciones y trabajos foráneos) de la orden de reparación
	public function get_detalles_factura(){
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('mano_obra' => NULL, 
						  'refacciones' => NULL, 
						  'trabajos_foraneos' => NULL, 
						  'otros' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intOrdenReparacionID = $this->input->post('intOrdenReparacionID');
		//Seleccionar los servicios finalizados de la orden de reparación
		$otdServicios = $this->ordenes->buscar_servicios($intOrdenReparacionID, NULL, 'FINALIZADO');
		//Seleccionar los trabajos foráneos de la orden de reparación
		$otdTrabajosForaneos = $this->trabajos->buscar_detalles(NULL, $intOrdenReparacionID);
		//Seleccionar las salidas de refacciones del registro
		$otdSalidasRefacciones = $this->movimientos->buscar_detalles_salida_taller(NULL, NULL, 
																				   $this->intTipoMovimiento,
																			       $intOrdenReparacionID);
		//Seleccionar los otros servicios del registro
		$otdOtros = $this->ordenes->buscar_otros($intOrdenReparacionID);

		//Verificar si existe información de los servicios
		if($otdServicios)
		{
			$arrDatos['mano_obra'] = $otdServicios;

		}//Cierre de verificación de servicios

		//Verificar si existe información de las salidas de refacciones por taller
		if($otdSalidasRefacciones)
		{
			$arrDatos['refacciones'] = $otdSalidasRefacciones;

		}//Cierre de verificación de salidas de refacciones por taller

		//Verificar si existe información de los trabajos foráneos 
		if($otdTrabajosForaneos)
		{
			$arrDatos['trabajos_foraneos'] = $otdTrabajosForaneos;
		}//Cierre de verificación de trabajos foráneos

		//Verificar si existe información de los otros servicios
		if($otdOtros)
		{
			$arrDatos['otros'] = $otdOtros;

		}//Cierre de verificación de otros servicios

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


}