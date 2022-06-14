<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verificaciones extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('control_vehiculos/verificaciones_model', 'verificaciones');
		$this->load->model('control_vehiculos/vehiculos_model', 'vehiculos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('control_vehiculos/verificaciones', $arrDatos);
	}
	
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->verificaciones->filtro($this->input->post('dteFechaInicial'),
									     $this->input->post('dteFechaFinal'),
									     $this->input->post('intVehiculoID'),
									     $this->input->post('strEstatus'),
		                                 $config['per_page'],
		                                 $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['verificaciones'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
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

				//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
				if (in_array('CAMBIAR ESTATUS', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Desactivar
					$arrDet->mostrarAccionDesactivar = '';
				}
			}
			else
			{
				//Si el usuario cuenta con el permiso de acceso VER REGISTRO
				if (in_array('VER REGISTRO', $arrPermisos))
				{
					$arrDet->mostrarAccionVerRegistro = '';
				}
				
				//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
				if (in_array('CAMBIAR ESTATUS', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Restaurar
					$arrDet->mostrarAccionRestaurar = '';
				}

				$arrDet->estiloRegistro = 'registro-INACTIVO';
			}

		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['verificaciones'],
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
		$objVerificacion = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objVerificacion->intVerificacionID = $this->input->post('intVerificacionID');
		$objVerificacion->dteFecha = $this->input->post('dteFecha');
		$objVerificacion->strTipo = $this->input->post('strTipo');
		$objVerificacion->intVehiculoID = $this->input->post('intVehiculoID');
		$objVerificacion->strAnio = $this->input->post('strAnio');
		$objVerificacion->strPlacas = $this->input->post('strPlacas');
		$objVerificacion->strFolioVerificacion = $this->input->post('strFolioVerificacion');
		$objVerificacion->dteFechaVerificacion = $this->input->post('dteFechaVerificacion');
		$objVerificacion->strSemestre = $this->input->post('strSemestre');
		$objVerificacion->strCentroVerificacion = $this->input->post('strCentroVerificacion');
		$objVerificacion->strResultado = $this->input->post('strResultado');
		$objVerificacion->strAutorizacion = $this->input->post('strAutorizacion');
		$objVerificacion->intCosto = $this->input->post('intCosto');
		$objVerificacion->strObservaciones = mb_strtoupper($this->input->post('strObservaciones'));
		$objVerificacion->intUsuarioID = $this->session->userdata('usuario_id');
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));

		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objVerificacion->intVerificacionID))
		{
			$bolResultado = $this->verificaciones->modificar($objVerificacion);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objVerificacion->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objVerificacion->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
	
				$bolResultado = $this->verificaciones->guardar($objVerificacion); 
												  			
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
		$strBusqueda = $this->input->post('strBusqueda');
		$strTipo = $this->input->post('strTipo');
		//Dependiendo del tipo realizar la búsqueda de datos
		//Seleccionar los datos del registro que coincide con el parámetro enviado
		if($strTipo == 'id')
		{
			$otdResultado = $this->verificaciones->buscar($strBusqueda);
		}
		else 
		{
    		$otdResultado = $this->verificaciones->buscar(NULL, $strBusqueda);
		}
		
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
		$this->form_validation->set_rules('intVerificacionID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intVerificacionID');
		    $strEstatus = $this->input->post('strEstatus');
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

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->verificaciones->set_estatus($intID, $strEstatus);
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
			$otdResultado = $this->vehiculos->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->vehiculo, 
		        						'data' => $arrCol->vehiculo_id);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}

	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $intVehiculoID, $strEstatus, $strDetalles) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->verificaciones->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intVehiculoID, $strEstatus);

		//Si existe rango de fechas
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal  != '0000-00-00')
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
		$pdf->strLinea1 =  utf8_decode('LISTADO DE VERIFICACIONES ').$strTituloRangoFechas;

		//Si existe id del vehículo
		if($intVehiculoID > 0)
		{
			//Seleccionar los datos del vehículo que coincide con el id
			$otdVehiculo =  $this->vehiculos->buscar($intVehiculoID);
			$pdf->strLinea2 =  utf8_decode('VEHÍCULO: ').$otdVehiculo->codigo.' - '.$otdVehiculo->modelo.' '.$otdVehiculo->marca;
		}

		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA', utf8_decode('VEHÍCULO'), utf8_decode('FECHA DE VERIFICACIÓN'),
							 'TIPO', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(20, 20, 60, 40, 30, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'L', 'C', 'C', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles1 = array('L', 'L', 'L');
		$arrAnchuraDetalles1 = array(50, 50, 90 );
	    $arrAlineacionDetalles2 = array('L');
		$arrAnchuraDetalles2 = array(190);

		//Agregar la primer pagina
		$pdf->AddPage();

		//Si hay información
		if ($otdResultado)
		{	

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, $arrCol->fecha,
								utf8_decode($arrCol->vehiculo).' '.$arrCol->placas.' '.$arrCol->anio,
								$arrCol->fecha_verificacion,   
								utf8_decode($arrCol->tipo), $arrCol->estatus), 
						  $pdf->arrAlineacion, 'ClippedCell');
		        
		        //Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);

				//Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
					
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraDetalles1);
				    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row(array(utf8_decode('FOLIO DE VERIFICACIÓN: ').$arrCol->folio_verificacion, 
				    				utf8_decode('SEMESTRE: ').$arrCol->semestre, 
				    				utf8_decode('AUTORIZACIÓN: ').$arrCol->autorizacion), 
				    		   $arrAlineacionDetalles1, 'ClippedCell');

				    //Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraDetalles2);
				    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row(array(utf8_decode('CENTRO DE VERIFICACIÓN: ').$arrCol->centro_verificacion), 
				    		  $arrAlineacionDetalles2, 'ClippedCell');

				    $pdf->Row(array(utf8_decode('RESULTADO: ').$arrCol->resultado), 
				    		  $arrAlineacionDetalles2, 'ClippedCell');

				    $pdf->Row(array(utf8_decode('OBSERVACIONES: ').$arrCol->observaciones), 
				    		  $arrAlineacionDetalles2, 'ClippedCell');

				    $pdf->Ln();
					
				}//Cierre de verificación de detalles
				//Incrementar el contador por cada registro
				$intContador++;
			}

			$pdf->Ln(5);//Deja un salto de linea
		}

		//Ejecutar la salida del reporte
		$pdf->Output('verificaciones.pdf','I'); 
	}


	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro($intVerificacionID) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		
		//Seleccionar los datos de la encuesta que coincide con el id
		$otdResultado = $this->verificaciones->buscar($intVerificacionID);
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1=  '';
		//Variable que se utiliza para asignar código de la encuesta (y poder identificar reporte)
		$strCodigo  = '';
		//Agregar la primer pagina
		$pdf->AddPage();
		
		//Verificar si hay información del registro
		if($otdResultado)
		{
			
			//Cambiar color de relleno de la celda
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->Ln(10);//Espacios de salto de línea
			//ENCUESTA
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, utf8_decode('VERIFICACIÓN'), 1, 1, 'C', 1);
			$pdf->SetTextColor(0); //establece el color de texto negro
			
			
			//FOLIO
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('FOLIO:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado->folio), 0, 1, 'L', 0);

			//FECHA
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('FECHA:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado->fecha), 0, 1, 'L', 0);

			//TIPO
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('TIPO:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado->tipo), 0, 1, 'L', 0);

			//VEHÍCULO
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('VEHÍCULO:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado->vehiculo.' '.$otdResultado->anio), 0, 1, 'L', 0);

			//PLACAS
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('PLACAS:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado->placas), 0, 1, 'L', 0);

			//FOLIO DE VERIFICACIÓN
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('FOLIO DE VERIFICACIÓN:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado->folio_verificacion), 0, 1, 'L', 0);

			//FECHA DE VERIFICACIÓN
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('FECHA DE VERIFICACIÓN:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado->fecha_verificacion), 0, 1, 'L', 0);

			//SEMESTRE
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('SEMESTRE:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado->semestre), 0, 1, 'L', 0);

			//AUTORIZACIÓN
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('AUTORIZACIÓN:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado->autorizacion), 0, 1, 'L', 0);

			//COSTO
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('COSTO:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, '$'.number_format($otdResultado->costo, 2), 0, 1, 'L', 0);

			//CENTRO DE VERIFICACIÓN
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('CENTRO DE VERIFICACIÓN:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado->centro_verificacion), 0, 1, 'L', 0);

			//RESULTADO
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('RESULTADO:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado->resultado), 0, 1, 'L', 0);

			//OBSERVACIONES
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('OBSERVACIONES:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado->observaciones), 0, 1, 'L', 0);
			
			//Espacios de salto de línea
			$pdf->Ln();

		}//Cierre de verificación de información
		

		//Ejecutar la salida del reporte
		$pdf->Output('encuesta_aplicada_'.$strCodigo.'.pdf','I');

	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $intVehiculoID, $strEstatus, $strDetalles) 
	{	
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
		$otdResultado = $this->verificaciones->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intVehiculoID, $strEstatus);

		//Si existe rango de fechas
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal  != '0000-00-00')
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
			     ->setCellValue('A7', 'LISTADO DE VERIFICACIONES '.$strTituloRangoFechas);
		//Si existe id del vehículo
		if($intVehiculoID > 0)
		{
			//Seleccionar los datos del vehículo que coincide con el id
			$otdVehiculo =  $this->vehiculos->buscar($intVehiculoID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'VEHÍCULO: '.$otdVehiculo->codigo.' - '.$otdVehiculo->modelo.' '.$otdVehiculo->marca);
		}

		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('C'.$intPosEncabezados, 'VEHÍCULO')
        		 ->setCellValue('D'.$intPosEncabezados, 'FECHA DE VERIFICACIÓN')
        		 ->setCellValue('E'.$intPosEncabezados, 'TIPO')
        		 ->setCellValue('F'.$intPosEncabezados, 'ESTATUS');

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
    			 ->getStyle('A10:F10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:F10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:F10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('G'.$intPosEncabezados, 'FOLIO DE VERIFICACIÓN')
			         ->setCellValue('H'.$intPosEncabezados, 'SEMESTRE')
			         ->setCellValue('I'.$intPosEncabezados,'AUTORIZACIÓN')
			         ->setCellValue('J'.$intPosEncabezados,'CENTRO DE VERIFICACIÓN')
			         ->setCellValue('K'.$intPosEncabezados,'RESULTADO')
			         ->setCellValue('L'.$intPosEncabezados, 'OBSERVACIONES');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('G'.$intPosEncabezados.':L'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('G'.$intPosEncabezados.':L'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
        }

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   	
				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
				 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->fecha)
                         ->setCellValue('C'.$intFila, $arrCol->vehiculo)
                         ->setCellValue('D'.$intFila, $arrCol->fecha_verificacion)
                         ->setCellValue('E'.$intFila, $arrCol->tipo)
                         ->setCellValue('F'.$intFila, $arrCol->estatus);

                //Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
					//Agregar información del detalle
					$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValue('G'.$intFila,  $arrCol->folio_verificacion)
					         ->setCellValue('H'.$intFila,  $arrCol->semestre)
					         ->setCellValue('I'.$intFila,  $arrCol->autorizacion)
					         ->setCellValue('J'.$intFila,  $arrCol->centro_verificacion)
					         ->setCellValue('K'.$intFila,  $arrCol->resultado)
					         ->setCellValue('L'.$intFila,  $arrCol->observaciones);
				}
				//Incrementar el indice para escribir el total
            	$intFila++;
			}
	
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)->setCellValue('F'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()->getStyle('F'.$intFila)->applyFromArray($arrStyleBold);

		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'verificaciones.xls', 'verificaciones', $intFila);
	}


}