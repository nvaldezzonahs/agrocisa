<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encuestas extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('mercadotecnia/encuestas_model', 'encuestas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('mercadotecnia/encuestas', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->encuestas->filtro(trim($this->input->post('strBusqueda')),
													 $config['per_page'],
													 $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['encuestas'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			$arrDet->mostrarAccionXLS = 'no-mostrar';
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

				//Asignar cadena vacia para mostrar botón Restaurar
				$arrDet->estiloRegistro = 'class=registro-INACTIVO';

			}


			//Si el usuario cuenta con el permiso de acceso IMPRIMIR REGISTRO
			if (in_array('IMPRIMIR REGISTRO', $arrPermisos))
			{
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
		$arrDatos = array('rows' => $result['encuestas'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows']);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_preguntas()
	{

		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->encuestas->buscar_preguntas($this->input->post('intEncuestaID'));
		
		$arrDatos = array('rows' => $result['preguntas']);
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
		$objEncuesta = json_decode($this->input->post('encuesta'));		
		$intEncuestaID = $objEncuesta->intEncuestaID;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($intEncuestaID))
		{
			$bolResultado = $this->encuestas->modificar($intEncuestaID, $objEncuesta);
		}
		else
		{
			$bolResultado = $this->encuestas->guardar($objEncuesta);
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
	public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL, 
						  'preguntas' => NULL
						);
		
		//Variables que se utilizan para asignar la pregunta anterior del recorrido de datos, de esta manera se verificará si paso a otra pregunta
   		$intPreguntaAnterior = 0;
   		$strPreguntaAnterior = '';
		//Array que se utiliza para guardar las preguntas de una encuesta
		$arrPreguntas = array();
		//Array que se utiliza para guardar las respuestas de una pregunta
		$arrRespuestas = array();

		//Variables que se utilizan para recuperar los valores de la vista 
		$intID = $this->input->post('intEncuestaID');

		//Dependiendo del tipo realizar la búsqueda de datos por ID
		$otdResultado = $this->encuestas->buscar($intID);
		
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Guardar encuesta_id, descripción y módulo de una Encuesta
			$arrDatos['row'] = $otdResultado[0];
			//Recorrer las localidades
			foreach ($otdResultado as $row)
			{
				//Si el renglon de la pregunta cambió
	   			if($intPreguntaAnterior != $row->renglonPregunta && $intPreguntaAnterior != 0)
	   			{
	   				//Agregar datos al array de preguntas
   					$arrPreguntas[] = array($strPreguntaAnterior, $arrRespuestas);
   					//Inicializar el array de Respuestas 
   					$arrRespuestas = array();
	   			}

	   			//Agregar respuesta al array de Respuestas
	   			$arrRespuestas[] = $row->respuesta;
				
				//Inicializar variable
   				$intPreguntaAnterior = $row->renglonPregunta;
   				$strPreguntaAnterior = $row->pregunta;
			}
			
			//Agregar datos de la última pregunta
	   		if($intPreguntaAnterior != 0)
			{
				//Agregar datos al array de preguntas
				$arrPreguntas[] = array($strPreguntaAnterior, $arrRespuestas);
			}

			$arrDatos['preguntas'] = $arrPreguntas;

		}
		
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intEncuestaID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intEncuestaID');
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
			$bolResultado = $this->encuestas->set_estatus($intID, $strEstatus);
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

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->encuestas->autocomplete($strDescripcion, $strEstatus);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->encuesta, 
		        						'data' => $arrCol->encuesta_id);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}


	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($strBusqueda = NULL) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->encuestas->buscar(NULL, $strBusqueda); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'LISTA DE ENCUESTAS';
		//Agregar la primer pagina
		$pdf->AddPage();
		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Crea los titulos de la cabecera
		$arrCabecera = array('ENCUESTA', utf8_decode('MÓDULO'), 'PREGUNTAS', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$arrAchura = array(100, 50, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$arrAlineacion = array('L', 'L', 'R', 'C');
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
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol->descripcion), $arrCol->modulo, $arrCol->total_preguntas, 
								$arrCol->estatus), $arrCabecera, $arrAchura, $arrAlineacion);
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
		$pdf->Output('encuestas.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro($intEncuestaID) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Seleccionar los datos de la encuesta que coincide con el id
		$otdEncuesta = $this->encuestas->buscar($intEncuestaID, NULL);
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
		if($otdEncuesta)
		{
			//Asignar la descripción de la encuesta 
			$strCodigo = $otdEncuesta[0]->descripcion;
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
			$pdf->Cell(33, 5, utf8_decode('DESCRIPCIÓN'), 1, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(157, 5, utf8_decode($otdEncuesta[0]->descripcion), 1, 1, 'L', 0);
			//Módulo
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, utf8_decode('MÓDULO'), 1, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(157, 5, utf8_decode($otdEncuesta[0]->modulo), 1, 1, 'L', 0);
			//Cambiar color de relleno de la celda
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//PREGUNTAS
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, 'PREGUNTAS', 1, 1, 'C', 1);
			$pdf->SetTextColor(0); //establece el color de texto negro
			
			//Impresión de las preguntas en la consulta
			//Inicializamos el renglón actual de la pregunta
			$intRenglonPregunta = 0;
			foreach ($otdEncuesta as $arrCol)
			{ 
				//Imprimir el titulo de una pregunta cuando sea diferente a la pregunta anterior
				if($intRenglonPregunta != $arrCol->renglonPregunta){
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->ClippedCell(190, 5, utf8_decode($arrCol->pregunta), 1, 1, 'L', 0);
				}

				//Respuestas
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->ClippedCell(190, 5, utf8_decode($arrCol->respuesta), 1, 1, 'L', 0);

				//Asignar ID del renglón anterior
				$intRenglonPregunta = $arrCol->renglonPregunta;	

			}//Cierre de impresión de preguntas y respuestas
		}//Cierre de verificación de información
		//Ejecutar la salida del reporte
		$pdf->Output('encuesta_'.$strCodigo.'.pdf','I'); 

	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($strBusqueda = NULL) 
	{
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->encuestas->buscar(NULL, $strBusqueda); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTA DE ENCUESTAS');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'ENCUESTA')
        		 ->setCellValue('B'.$intPosEncabezados, 'MÓDULO')
                 ->setCellValue('C'.$intPosEncabezados, 'PREGUNTAS')
                 ->setCellValue('D'.$intPosEncabezados, 'ESTATUS');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));
        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));
        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet(0)
        			->getStyle('A9:D9')
        			->getFill()
        			->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFila, $arrCol->descripcion)
                         ->setCellValue('B'.$intFila, $arrCol->modulo)
                         ->setCellValue('C'.$intFila, $arrCol->total_preguntas)
                         ->setCellValue('D'.$intFila, $arrCol->estatus);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

			$objExcel->getActiveSheet()
                	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('D'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('D'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'encuestas.xls', 'lista de encuestas', $intFila);
	}

	//Método para generar un archivo XLS con la información de un registro 
	public function get_xls_registro($intEncuestaID){

		//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;
        //Seleccionar los datos de la encuesta que coincide con el id
		$otdEncuesta = $this->encuestas->buscar($intEncuestaID, NULL); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);

         //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', $otdEncuesta[0]->descripcion);
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A8', $otdEncuesta[0]->modulo);	     
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'PREGUNTAS')
        		 ->setCellValue('B'.$intPosEncabezados, 'RESPUESTAS');
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

      
        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
        			->getStyle('A10:B10')
        			->getFill()
        			->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:D10')
    			 ->applyFromArray($arrStyleFuenteColumnas);

    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:D10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        $objExcel->getActiveSheet()
        			->getStyle('A7:A8')
        			->applyFromArray($arrStyleBold);	

		//Si hay información
        if($otdEncuesta){
        	//Recorremos el arreglo 
			foreach ($otdEncuesta as $arrCol)
			{
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFila, $arrCol->pregunta)
                         ->setCellValue('B'.$intFila, $arrCol->respuesta);
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}
        }			
		
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'encuestas_registro.xls', 'encuesta', $intFila);

	}

}