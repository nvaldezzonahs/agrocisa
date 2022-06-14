<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encuestas_prospectos extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('mercadotecnia/encuestas_prospectos_model', 'encuestas_prospectos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('mercadotecnia/encuestas_prospectos', $arrDatos);
	}

	/*******************************************************************************************************************
	Funciones de la tabla encuestas_prospectos
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->encuestas_prospectos->filtro($this->input->post('dteFechaInicial'),
										 			  $this->input->post('dteFechaFinal'),
										 			  $this->input->post('intProspectoID'),
										 			  $this->input->post('intVendedorID'),
										 			  $this->input->post('intEncuestaID'),
										 			  $this->input->post('intModuloID'),
			                             			  $config['per_page'],
			                             			  $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['encuestas_prospectos'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			$arrDet->mostrarAccionXLS = 'no-mostrar';
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

			//Si el usuario cuenta con el permiso de acceso IMPRIMIR REGISTRO
			if (in_array('IMPRIMIR REGISTRO', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón Imprimir
        		$arrDet->mostrarAccionImprimir = '';
			}
			//Si el usuario cuenta con el permiso de acceso DESCARGAR XLS REGISTRO
			if (in_array('DESCARGAR XLS REGISTRO', $arrPermisos))
			{
				$arrDet->mostrarAccionXLS = '';
			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['encuestas_prospectos'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows']);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion_preguntas()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		$config['total_rows'] = $result['total_rows'];

		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['eventos'],
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
		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
		$objEncuestaProspecto = json_decode( $this->input->post('objEncuestaProspecto') );
		$intEncuestaProspectoID = $objEncuestaProspecto->intEncuestaProspectoID;	
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($intEncuestaProspectoID))
		{
			$bolResultado = $this->encuestas_prospectos->modificar($intEncuestaProspectoID, $objEncuestaProspecto);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->encuestas_prospectos->guardar($strFolio, $objEncuestaProspecto);
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
		$intID = $this->input->post('intEncuestaProspectoID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->encuestas_prospectos->buscar($intID);
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
		$this->form_validation->set_rules('intEncuestaProspectoID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intEncuestaProspectoID');
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
			$bolResultado = $this->encuestas_prospectos->set_estatus($intID, $strEstatus);
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
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $intProspectoID, $intVendedorID, $intEncuestaID, $intModuloID) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->encuestas_prospectos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID,
															$intVendedorID, $intEncuestaID, $intModuloID); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = utf8_decode('LISTADO DE ENCUESTAS APLICADAS');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Crea los titulos de la cabecera
		$arrCabecera = array('FOLIO', 'FECHA', 'NO. PREGUNTAS', 'NO. RESPUESTAS', 'ESTATUS');
		$arrCabecera2 = array('ENCUESTA', utf8_decode('MÓDULO'));
		$arrCabecera3 = array('PROSPECTO');
		$arrCabecera4 = array('VENDEDOR');
		$arrCabecera5 = array('OBSERVACIONES');

		//Establece el ancho de las columnas de cabecera
		$arrAnchura = array(30, 30, 50, 50, 30);
		$arrAnchura2 = array(110, 80);
		$arrAnchura3 = array(190);
		
		//Establece la alineación de las celdas de la tabla
		$arrAlineacion = array('L', 'L', 'L', 'L', 'L', 'L');
		$arrAlineacion2 = array('L', 'L');
		$arrAlineacion3 = array('L');
		
		//Recorre el array de titulos de encabezado para crearlos
		for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
		{
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//inserta los titulos de la cabecera
			$pdf->Cell($arrAnchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, 'L', TRUE);
		}
		$pdf->Ln(); //Deja un salto de línea
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAnchura);

		//Recorre el array de titulos de encabezado para crearlos
		for ($intCont = 0; $intCont < count($arrCabecera2); $intCont++)
		{
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//inserta los titulos de la cabecera
			$pdf->Cell($arrAnchura2[$intCont], 7, $arrCabecera2[$intCont], 1, 0, 'L', TRUE);
		}
		$pdf->Ln(); //Deja un salto de línea
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAnchura2);

		//Recorre el array de titulos de encabezado para crearlos
		for ($intCont = 0; $intCont < count($arrCabecera3); $intCont++)
		{
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//inserta los titulos de la cabecera
			$pdf->Cell($arrAnchura3[$intCont], 7, $arrCabecera3[$intCont], 1, 0, 'L', TRUE);
		}
		$pdf->Ln(); //Deja un salto de línea
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAnchura3);

		//Recorre el array de titulos de encabezado para crearlos
		for ($intCont = 0; $intCont < count($arrCabecera4); $intCont++)
		{
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//inserta los titulos de la cabecera
			$pdf->Cell($arrAnchura3[$intCont], 7, $arrCabecera4[$intCont], 1, 0, 'L', TRUE);
		}
		$pdf->Ln(); //Deja un salto de línea
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAnchura3);

		//Recorre el array de titulos de encabezado para crearlos
		for ($intCont = 0; $intCont < count($arrCabecera5); $intCont++)
		{
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//inserta los titulos de la cabecera
			$pdf->Cell($arrAnchura3[$intCont], 7, $arrCabecera5[$intCont], 1, 0, 'L', TRUE);
		}
		$pdf->Ln(); //Deja un salto de línea
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAnchura3);

		//Si hay información
		$resultado = $otdResultado["encuestas_prospectos"];
		
		if($resultado)
		{
			//Recorremos el arreglo 
			foreach ($resultado as $arrCol)
			{ 
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->SetWidths($arrAnchura);
				$pdf->Row(
							array($arrCol->folio,  
								  $arrCol->fecha, 
								  $arrCol->numeroPreguntas, 
								  $arrCol->numeroRespuestas, 
								  $arrCol->estatus
								  ), $arrCabecera, $arrAnchura, $arrAlineacion, FALSE, FALSE
						);
				$pdf->SetWidths($arrAnchura2);
				$pdf->Row(array(utf8_decode($arrCol->encuesta), $arrCol->modulo), $arrCabecera2, $arrAnchura2, $arrAlineacion2, FALSE, FALSE);
				$pdf->SetWidths($arrAnchura3);
				$pdf->Row(array(utf8_decode($arrCol->prospecto)), $arrCabecera3, $arrAnchura3, $arrAlineacion3, FALSE, FALSE);
				$pdf->Row(array(utf8_decode($arrCol->vendedor)), $arrCabecera4, $arrAnchura3, $arrAlineacion3, FALSE, FALSE);
				$pdf->Row(array(utf8_decode($arrCol->observaciones)), $arrCabecera5, $arrAnchura3, $arrAlineacion3, FALSE, FALSE);

				//Dibuja una línea para separar la información de cada prospecto
	    		$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

				//Incrementar el contador por cada registro
				$intContador++;
			}
		}
		
		//Espacios de salto de línea
		$pdf->Ln();
		//Asigna el tipo y tamaño de letra para los totales
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Escribe la cadena concatenada con el total de registros
		$pdf->Cell(0,3,'TOTAL: '.$intContador, 0, 0, 'R');
		//Ejecutar la salida del reporte
		$pdf->Output('encuestas_aplicadas.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro($intEncuestaProspectoID) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		
		//Seleccionar los datos de la encuesta que coincide con el id
		$otdResultado = $this->encuestas_prospectos->buscar($intEncuestaProspectoID);
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
			//Asignar la descripción de la encuesta 
			$strCodigo = $otdResultado['encuesta']->folio;
			//Cambiar color de relleno de la celda
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->Ln(10);//Espacios de salto de línea
			//ENCUESTA
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, 'ENCUESTA', 1, 1, 'C', 1);
			$pdf->SetTextColor(0); //establece el color de texto negro
			
			//Descripción de la Encuesta
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('NOMBRE DE LA ENCUESTA:'), 1, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado['encuesta']->encuesta), 1, 1, 'L', 0);

			//Descripción del Prospecto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('NOMBRE DEL PROSPECTO / CLIENTE:'), 1, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado['encuesta']->prospecto), 1, 1, 'L', 0);

			//FOLIO
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('FOLIO:'), 1, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado['encuesta']->folio), 1, 1, 'L', 0);

			//FECHA
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(60, 5, utf8_decode('FECHA:'), 1, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(130, 5, utf8_decode($otdResultado['encuesta']->fecha), 1, 1, 'L', 0);
			
			//PREGUNTAS Y RESPUESTAS
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(0); //establece el color de texto negro
			//Crea los titulos de la cabecera
			$arrCabecera = array('PREGUNTA', 'RESPUESTA', 'COMENTARIOS');
			//Establece el ancho de las columnas de cabecera
			$arrAchura = array(64, 63, 63);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacion = array('L', 'L', 'L');
			//Recorre el array de titulos de encabezado para crearlos
			for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
			{
				//Establecer el color de fondo para la cabecera
				$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
				//inserta los titulos de la cabecera
				$pdf->Cell($arrAchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, 'C', TRUE);
			}
			$pdf->Ln(); //Deja un salto de línea
			//Establece el ancho de las columnas
			$pdf->SetWidths($arrAchura);
			$pdf->SetTextColor(0); //Establecer el color de texto por defecto
			
			$otdPreguntasRespuestas = $otdResultado['preguntas_respuestas'];
			//Si hay información
			if ($otdPreguntasRespuestas)
			{	
				//Recorremos el arreglo 
				foreach ($otdPreguntasRespuestas as $arrCol)
				{ 
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(utf8_decode($arrCol->pregunta), $arrCol->respuesta, $arrCol->comentarios), $arrCabecera, $arrAchura, $arrAlineacion);
				}
			}
			//Espacios de salto de línea
			$pdf->Ln();

		}//Cierre de verificación de información
		//Ejecutar la salida del reporte
		$pdf->Output('encuesta_aplicada_'.$strCodigo.'.pdf','I');

		
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $intProspectoID, $intVendedorID, 
							$intEncuestaID, $intModuloID) 
	{	
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Seleccionar los datos de la encuesta aplciada que coincide con el id
		$otdResultado = $this->encuestas_prospectos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, 
														    $intVendedorID, $intEncuestaID, $intModuloID); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);

         //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE ENCUESTAS APLICADAS');
		    
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('C'.$intPosEncabezados, 'NO. PREGUNTAS')
        		 ->setCellValue('D'.$intPosEncabezados, 'NO. RESPUESTAS')
        		 ->setCellValue('E'.$intPosEncabezados, 'ENCUESTA')
        		 ->setCellValue('F'.$intPosEncabezados, 'MÓDULO')
        		 ->setCellValue('G'.$intPosEncabezados, 'PROSPECTO')
        		 ->setCellValue('H'.$intPosEncabezados, 'VENDEDOR')
        		 ->setCellValue('I'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('J'.$intPosEncabezados, 'ESTATUS');

        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA),
                                  'font'  => [ 'color' => ['rgb' => 'FFFFFF'] ]
                              	 );
        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        $link_style_array = [
		  'font'  => [
		    'color' => ['rgb' => 'FFFFFF'] ]
		];	

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
        			->getStyle('A9:J9')
        			->getFill()
        			->applyFromArray($arrStyleColumnas);
        		
        $resultado = $otdResultado["encuestas_prospectos"];
		//Si hay información
        if($resultado){
        	//Recorremos el arreglo 
			foreach ($resultado as $arrCol)
			{
				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
                         ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->fecha)
                         ->setCellValue('C'.$intFila, $arrCol->numeroPreguntas)
                         ->setCellValue('D'.$intFila, $arrCol->numeroRespuestas)
                         ->setCellValue('E'.$intFila, $arrCol->encuesta)
                         ->setCellValue('F'.$intFila, $arrCol->modulo)
                         ->setCellValue('G'.$intFila, $arrCol->prospecto)
                         ->setCellValue('H'.$intFila, $arrCol->vendedor)
                         ->setCellValue('I'.$intFila, $arrCol->observaciones)
                         ->setCellValue('J'.$intFila, $arrCol->estatus);
                 //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'D'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);


			$objExcel->getActiveSheet()
                	 ->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            //Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('J'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('J'.$intFila)
            		 ->applyFromArray($arrStyleBold);
        }
		
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'encuestas_aplicadas_registro.xls', 'encuestas_aplicadas', $intFila);

	}

	//Método para generar un archivo XLS con la información de un registro 
	public function get_xls_registro($intEncuestaProspectoID){

		//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Seleccionar los datos de la encuesta aplciada que coincide con el id
		$otdResultado = $this->encuestas_prospectos->buscar($intEncuestaProspectoID); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);

         //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)->setCellValue('A7', 'ENCUESTA: '. $otdResultado['encuesta']->encuesta);
		$objExcel->setActiveSheetIndex(0)->setCellValue('A8', 'PROSPECTO: '. $otdResultado['encuesta']->prospecto);	     
		$objExcel->setActiveSheetIndex(0)->setCellValue('B8', 'FOLIO: '. $otdResultado['encuesta']->folio);
		$objExcel->setActiveSheetIndex(0)->setCellValue('C8', 'FECHA: '. $otdResultado['encuesta']->fecha);	     

		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'PREGUNTAS')
        		 ->setCellValue('B'.$intPosEncabezados, 'RESPUESTAS')
        		 ->setCellValue('C'.$intPosEncabezados, 'COMENTARIOS');

        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));
        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()->getStyle('A7:C9')->applyFromArray($arrStyleBold);	
        $objExcel->getActiveSheet()->getStyle('A9:C9')->getFill()->applyFromArray($arrStyleColumnas);		
        		
        $otdPreguntasRespuestas = $otdResultado['preguntas_respuestas'];
		//Si hay información
        if($otdPreguntasRespuestas){
        	//Recorremos el arreglo 
			foreach ($otdPreguntasRespuestas as $arrCol)
			{
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFila, $arrCol->pregunta)
                         ->setCellValue('B'.$intFila, $arrCol->respuesta)
                         ->setCellValue('C'.$intFila, $arrCol->comentarios);
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}
        }

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'encuesta_aplicada_registro.xls', 'encuesta_aplicada', $intFila);

	}

	

}