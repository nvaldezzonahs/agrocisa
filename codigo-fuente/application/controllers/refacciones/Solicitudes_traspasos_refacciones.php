<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitudes_traspasos_refacciones extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de solicitudes de traspasos de refacciones
		$this->load->model('refacciones/solicitudes_traspasos_refacciones_model', 'solicitudes');
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
		$this->cargar_vista('refacciones/solicitudes_traspasos_refacciones', $arrDatos);
	}

	/*******************************************************************************************************************
	Funciones de la tabla solicitudes_traspasos_refacciones
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->solicitudes->filtro($this->input->post('dteFechaInicial'),
											 $this->input->post('dteFechaFinal'),
											 $this->input->post('intSucursalSalidaID'),
											 trim($this->input->post('strEstatus')),
											 trim($this->input->post('strBusqueda')),
				                             $config['per_page'],
				                             $config['cur_page']);	
		$config['total_rows'] = $result['total_rows'];

		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['solicitudes'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
            //Reemplazar cadena vacia por '_'
            $strEstiloEstatus =  str_replace (' ' , '_' ,  $arrDet->estatus);
            //Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$strEstiloEstatus;

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
					//Asignar cadena vacia para mostrar botón Ver registro
	        		$arrDet->mostrarAccionVerRegistro = '';	
				}

				//Si el estatus del registro es INACTIVO
				if($arrDet->estatus == 'INACTIVO')
				{
					//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
					if (in_array('CAMBIAR ESTATUS', $arrPermisos))
					{
						//Asignar cadena vacia para mostrar botón Restaurar
						$arrDet->mostrarAccionRestaurar = '';
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
		$arrDatos = array('rows' => $result['solicitudes'],
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
		$objSolicitudTraspaso = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Datos de la solicitud de traspaso
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objSolicitudTraspaso->intSolicitudTraspasoRefaccionesID = $this->input->post('intSolicitudTraspasoRefaccionesID');
		$objSolicitudTraspaso->dteFecha = $this->input->post('dteFecha');
		$objSolicitudTraspaso->intSucursalSalidaID = $this->input->post('intSucursalSalidaID');
		$objSolicitudTraspaso->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objSolicitudTraspaso->intSucursalID =  $this->session->userdata('sucursal_id');
		$objSolicitudTraspaso->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los detalles
		$objSolicitudTraspaso->strRefaccionID = $this->input->post('strRefaccionID');
		$objSolicitudTraspaso->strCodigos = $this->input->post('strCodigos'); 
		$objSolicitudTraspaso->strDescripciones = $this->input->post('strDescripciones'); 
		$objSolicitudTraspaso->strCantidades = $this->input->post('strCantidades'); 
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;
		
		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objSolicitudTraspaso->intSolicitudTraspasoRefaccionesID))
		{

			$bolResultado = $this->solicitudes->modificar($objSolicitudTraspaso);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objSolicitudTraspaso->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objSolicitudTraspaso->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{	
				$bolResultado = $this->solicitudes->guardar($objSolicitudTraspaso); 

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
		$intID = $this->input->post('intSolicitudTraspasoRefaccionesID');
		
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->solicitudes->buscar($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
			//Seleccionar los detalles del registro
			$otdDetalles = $this->solicitudes->buscar_detalles($intID);
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
		$this->form_validation->set_rules('intSolicitudTraspasoRefaccionesID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intSolicitudTraspasoRefaccionesID');
		    $strEstatus = $this->input->post('strEstatus');
		   
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->solicitudes->set_estatus($intID, $strEstatus);
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

	//Método para regresar todos los registros activos y parcialmente surtidos en un autocomplete
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
			//Hacer un llamado al método para obtener todos los registros (activos y parcialmente surtidos) 
			//que coincidan con la descripción
			$otdResultado = $this->solicitudes->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->solicitud, 
		        						'data' => $arrCol->solicitud_traspaso_refacciones_id);
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
		$intSucursalSalidaID = $this->input->post('intSucursalSalidaID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strDetalles = $this->input->post('strDetalles');

		//Array que se utiliza para asignar los estatus 
		$arrEstatus = array('ACTIVO', 'PARCIALMENTE SURTIDO', 'SURTIDO', 'INACTIVO');
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->solicitudes->buscar(NULL, $dteFechaInicial, $dteFechaFinal, 
												  $intSucursalSalidaID, $strEstatus, $strBusqueda);
		
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
		$pdf->strLinea1 =  utf8_decode('LISTADO DE SOLICITUDES DE TRASPASO DE REFACCIONES ').$strTituloRangoFechas;
		//Si existe id de la sucursal de salida
		if($intSucursalSalidaID > 0)
		{
			//Seleccionar los datos de la sucursal que coincide con el id
			$otdSucursal =  $this->sucursales->buscar($intSucursalSalidaID);
			$pdf->strLinea2 =  'SUCURSAL: '.utf8_decode($otdSucursal->nombre);
		}
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'SUCURSAL', 'FECHA', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(20, 112, 18, 40);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('R', 'L', 'L');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(16, 20, 65);
		//Agregar la primer pagina
		$pdf->AddPage();	
		//Si hay información
		if ($otdResultado)
		{	

			//Recorremos el arreglo para obtener la información de los solicitudes
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, utf8_decode($arrCol->sucursal_salida), $arrCol->fecha,  
								$arrCol->estatus),  
							    $pdf->arrAlineacion, 'ClippedCell');
		        
				//Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
					//Seleccionar los detalles del registro
					$otdDetalles = $this->solicitudes->buscar_detalles($arrCol->solicitud_traspaso_refacciones_id);
					//Verificar si existe información de los detalles 
					if($otdDetalles)
					{
						$pdf->Ln(2);//Deja un salto de línea
						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraDetalles);
						$pdf->SetTextColor(0); //establece el color de texto
						//Recorremos el arreglo 
				        foreach ($otdDetalles as $arrDet) 
				        {
						   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						    $pdf->Row(array(number_format($arrDet->cantidad,2),  utf8_decode($arrDet->codigo), 
						    				utf8_decode($arrDet->descripcion)), 
						    		       $arrAlineacionDetalles,  'ClippedCell');
						}
						
						$pdf->Ln(5);//Deja un salto de línea

					}//Cierre de verificación de detalles
				}
		    	
				//Incrementar el contador por cada registro
				$intContador++;
			}
		}

		$pdf->Ln();//Deja un salto de linea
		//Asigna el tipo y tamaño de letra para los totales
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		$pdf->Cell(0,3,'TOTAL: '.$intContador, 0, 0, 'R');
		//Ejecutar la salida del reporte
		$pdf->Output('solicitudes_traspasos_refacciones.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro() 
	{	            

		//Variables que se utilizan para recuperar los valores de la vista
		$intSolicitudTraspasoRefaccionesID = $this->input->post('intSolicitudTraspasoRefaccionesID');
		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->solicitudes->buscar($intSolicitudTraspasoRefaccionesID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->solicitudes->buscar_detalles($intSolicitudTraspasoRefaccionesID);
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variable que se utiliza para asignar el acumulado del subtotal
		$intAcumSubtotal = 0;
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'solicitud_traspaso_refacciones_';
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
	        //---------- DATOS DE LA SUCURSAL
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 42);
			$pdf->ClippedCell(92, 3, 'SUCURSAL', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0); //establece el color de texto
			//Sucursal
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, 46);
			$pdf->ClippedCell(12, 3, 'NOMBRE');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Sucursal
			$pdf->SetXY(27, 46);
			$pdf->ClippedCell(30, 3, utf8_decode($otdResultado->sucursal_salida));


			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DE LA SOLICITUD DE TRASPASO
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(108, 42);
			$pdf->ClippedCell(92, 3, utf8_decode('SOLICITUD DE TRASPASO DE REFACCIONES'), 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0);//establece el color de texto
			//Folio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, 46);
			$pdf->ClippedCell(15, 3, 'FOLIO');
			//Fecha 
			$pdf->SetXY(154, 46);
			$pdf->ClippedCell(15, 3, 'FECHA');
			//Estatus
			$pdf->SetXY(108, 49);
			$pdf->ClippedCell(15, 3, 'ESTATUS');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(135, 46);
			$pdf->ClippedCell(76, 3, $otdResultado->folio);
			//Fecha
			$pdf->SetXY(178, 46);
			$pdf->ClippedCell(29, 3, $otdResultado->fecha);
			//Estatus
			$pdf->SetXY(135, 49);
			$pdf->ClippedCell(29, 3, $otdResultado->estatus);

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DE LA SOLICITUD DE TRASPASO
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 57);
			$pdf->ClippedCell(185, 3, 'CONCEPTOS', 0, 0, 'C', TRUE);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			
			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				//Tabla con los detalles del movimiento
				$pdf->SetXY(15, 61);
				//Crea los titulos de la cabecera
				$arrCabecera = array('Cantidad', utf8_decode('Código'), utf8_decode('Descripción'));
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(15, 35, 135);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('R', 'L', 'L');
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
				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDet)
				{ 
					$pdf->SetX(15);
					
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(number_format($arrDet->cantidad,2), utf8_decode($arrDet->codigo), 
									utf8_decode($arrDet->descripcion)), 
					                $arrAlineacion, 'ClippedCell');

				}

				$pdf->Ln(2); //Deja un salto de línea


			}//Cierre de verificación de detalles

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
			$pdf->Ln(); //Deja un salto de línea
			$intPosY = $pdf->GetY();
			//Observaciones
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, $intPosY);
			$pdf->MultiCell(110, 3, utf8_decode($otdResultado->observaciones));
		   //Persona que recibio la solicitud de traspaso
            $pdf->SetXY(15,260);
            //Persona que reviso la solicitud de traspaso
            $pdf->SetXY(109, 260);
            $pdf->Ln(5);//Espacios de salto de línea
            $pdf->SetX(15);
            //Persona que recibio la solicitud de traspaso
            //Asigna el tipo y tamaño de letra
            $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
            $pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
            $pdf->Cell(90, 3, 'RECIBIO', 0, 0, 'C',  TRUE);
            //Persona que reviso la solicitud de traspaso
            $pdf->SetXY(109, 265);
            $pdf->Cell(90, 3, 'REVISO', 0, 0, 'C',  TRUE);
            
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
		$intSucursalSalidaID = $this->input->post('intSucursalSalidaID');
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
		$otdResultado = $this->solicitudes->buscar(NULL, $dteFechaInicial, $dteFechaFinal, 
												   $intSucursalSalidaID,$strEstatus, $strBusqueda);		
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
			     ->setCellValue('A7', 'LISTADO DE SOLICITUDES DE TRASPASO DE REFACCIONES '.$strTituloRangoFechas);
		//Si existe id de la sucursal de salida
		if($intSucursalSalidaID > 0)
		{   //Seleccionar los datos de la sucursal que coincide con el id
			$otdSucursal =  $this->sucursales->buscar($intSucursalSalidaID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'SUCURSAL: '.$otdSucursal->nombre);
		}
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'SUCURSAL')
        		 ->setCellValue('C'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('D'.$intPosEncabezados, 'OBSERVACIONES')
                 ->setCellValue('E'.$intPosEncabezados, 'ESTATUS');
        

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
    			 ->getStyle('A10:E10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:E10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:E10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('F'.$intPosEncabezados, 'CANTIDAD')
                     ->setCellValue('G'.$intPosEncabezados, 'CÓDIGO')
			         ->setCellValue('H'.$intPosEncabezados, 'DESCRIPCIÓN')
			         ->setCellValue('I'.$intPosEncabezados, 'REFACCIONES LINEA')
			         ->setCellValue('J'.$intPosEncabezados, 'REFACCIONES MARCA');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('F'.$intPosEncabezados.':J'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('F'.$intPosEncabezados.':J'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('F'.$intPosEncabezados.':J'.$intPosEncabezados)
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
					$otdDetalles = $this->solicitudes->buscar_detalles($arrCol->solicitud_traspaso_refacciones_id);

					//Verificar si existe información de los detalles
					if($otdDetalles)
				    {
				    	//Variable que se utiliza para contar el número de detalles
				    	$intContDetSolt = 0;
				    	//Asignar el número de detalles
						$intNumDetalles = count($otdDetalles); 

				    	//Recorremos el arreglo 
				        foreach ($otdDetalles as $arrDet) 
				        {
				        	//Agregar datos al array
				        	$arrDetalles[$intContDetSolt]['codigo']= $arrDet->codigo;
				        	$arrDetalles[$intContDetSolt]['descripcion']= $arrDet->descripcion;
				        	$arrDetalles[$intContDetSolt]['refacciones_linea']= $arrDet->refacciones_linea;
				        	$arrDetalles[$intContDetSolt]['refacciones_marca']= $arrDet->refacciones_marca;
				        	$arrDetalles[$intContDetSolt]['cantidad']= $arrDet->cantidad;
				        	//Incrementar el contador por cada registro
	                        $intContDetSolt++;
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
		                         ->setCellValue('B'.$intFila, $arrCol->sucursal_salida)
		                         ->setCellValue('C'.$intFila, $arrCol->fecha)
		                         ->setCellValue('D'.$intFila, $arrCol->observaciones)
		                         ->setCellValue('E'.$intFila, $arrCol->estatus);

		            //Si se cumple la sentencia mostrar detalles del registro
				    if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
								 ->setCellValue('F'.$intFila, $arrDetalles[$intContDet]['cantidad'])
		                         ->setCellValueExplicit('G'.$intFila, $arrDetalles[$intContDet]['codigo'], PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValue('H'.$intFila, $arrDetalles[$intContDet]['descripcion'])
		                         ->setCellValue('I'.$intFila, $arrDetalles[$intContDet]['refacciones_linea'])
		                         ->setCellValue('J'.$intFila, $arrDetalles[$intContDet]['refacciones_marca']);
					}

					//Incrementar el indice para escribir los datos del siguiente registro
	                $intFila++; 
			    }
				
                //Incrementar el contador por cada registro
				$intContador++;
			}

            //Cambiar contenido de las celdas a formato númerico de 2 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('###0.00');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
                	 
		    $objExcel->getActiveSheet()
                	 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('E'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('E'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
       $this->get_pie_pagina_archivo_excel($objExcel, 'solicitudes_traspasos_refacciones.xls', 
        									'solicitudes de traspasos', $intFila);
	}
}