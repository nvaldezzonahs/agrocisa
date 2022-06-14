<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('mercadotecnia/eventos_model', 'eventos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('mercadotecnia/eventos', $arrDatos);
	}

	/*******************************************************************************************************************
	Funciones de la tabla eventos
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->eventos->filtro($this->input->post('dteFechaInicial'),
										 $this->input->post('dteFechaFinal'),
										 trim($this->input->post('strBusqueda')),
			                             $config['per_page'],
			                             $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Definir ubicación de la carpeta principal
		$strCarpetaDestino = './archivos/eventos/';

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['eventos'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionVerArchivoRegistro = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = '';
            //Variable que se utiliza para asignar el nombre del archivo
		    $strNombreArchivo = '';
		    //Definir ubicación de la carpeta
			$strNombreCarpeta = $strCarpetaDestino.$arrDet->evento_id;
			//Verificar si la carpeta es un directorio 
            if (is_dir($strNombreCarpeta))
            {
            	//Hacer recorrido en la carpeta para obtener archivos
                foreach (scandir($strNombreCarpeta) as $item) 
                {
                    if ($item == '.' OR $item == '..') continue;
                    //Separar extensión del archivo
                    $arrArchivo = explode(".", $item);
                    //Si el nombre del archivo es igual al id de la orden de compra 
                    if($arrArchivo[0] ==  $arrDet->evento_id)
                    {
                        //Asignar nombre completo del archivo (ejemplo: 1.xml)
                        $strNombreArchivo = $item;
                    }
                        
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
			//Si existe archivo del registro 
			if($strNombreArchivo != '')
    		{
    			//Si el usuario cuenta con el permiso de acceso VER REGISTRO
				if (in_array('VER REGISTRO', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Ver archivo del registro
	        		$arrDet->mostrarAccionVerArchivoRegistro = '';
	        	}
    		}
		}
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
		$intEventoID = $this->input->post('intEventoID');
		$strDescripcion = mb_strtoupper(trim($this->input->post('strDescripcion')));
		$dteFecha = $this->input->post('dteFecha');
		$dteHora = $this->input->post('dteHora');
		$strResponsable = mb_strtoupper(trim($this->input->post('strResponsable')));
		$strMarcas = mb_strtoupper(trim($this->input->post('strMarcas')));
		$strObjetivos = mb_strtoupper(trim($this->input->post('strObjetivos')));
		$strResultados = mb_strtoupper(trim($this->input->post('strResultados')));
		$intLocalidadID = $this->input->post('intLocalidadID');
		$strCantidades = $this->input->post('strCantidades');
		$strConceptos = $this->input->post('strConceptos');
		$strImportes = $this->input->post('strImportes');
		
		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($intEventoID))
		{
			$bolResultado = $this->eventos->modificar($intEventoID, 
													  $strDescripcion, 
													  $dteFecha, 
													  $dteHora,
													  $strResponsable,
													  $strMarcas,
													  $strObjetivos,
													  $strResultados,
													  $intLocalidadID,
													  $strCantidades,
													  $strConceptos,
													  $strImportes);
		}
		else
		{ 
			$bolResultado = $this->eventos->guardar($strDescripcion, 
													$dteFecha, 
													$dteHora,
													$strResponsable,
													$strMarcas,
													$strObjetivos,
													$strResultados,
													$intLocalidadID,
													$strCantidades,
													$strConceptos,
													$strImportes);

			/*Quitar '_'  de la cadena (resultadoTransaccion_eventoID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			list($bolResultado, $intEventoID) = explode("_", $bolResultado); 

		}
        //Si no se obtienen errores al ejecutar el proceso
		if($bolResultado)
		{
			//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE,
							  'evento_id' => $intEventoID,
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
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intID = $this->input->post('intEventoID');
		//Variable que se utiliza para asignar el nombre del archivo
	    $strNombreArchivo = '';
	    //Definir ubicación de la carpeta principal
	    $strCarpetaDestino = './archivos/eventos/';

		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->eventos->buscar($intID);

		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Definir ubicación de la carpeta
			$strNombreCarpeta = $strCarpetaDestino.$otdResultado->evento_id;
			//Verificar si la carpeta es un directorio 
	        if (is_dir($strNombreCarpeta))
	        {
	        	//Hacer recorrido en la carpeta para obtener archivos
	            foreach (scandir($strNombreCarpeta) as $item) 
	            {
	                if ($item == '.' OR $item == '..') continue;
	                //Separar extensión del archivo
	                $arrArchivo = explode(".", $item);
	                //Si el nombre del archivo es igual al id del evento
	                if($arrArchivo[0] ==  $otdResultado->evento_id)
	                {
	                    //Asignar nombre completo del archivo (ejemplo: 1.xml)
	                    $strNombreArchivo = $item;
	                }
	                    
	            }
	        }
	        $arrDatos['archivo'] = $strNombreArchivo;
			$arrDatos['row'] = $otdResultado;
			//Si existen datos, asignar los datos recuperados en el array
			if($otdResultado)
			{				
				
					//Seleccionar los datos de los detalles
					$otdDetalles = $this->eventos->buscar_detalles($intID);
					$arrDatos['detalles'] = $otdDetalles;
				
				
			}

			//Seleccionar los datos de los asistentes
			$otdAsistentes = $this->eventos->buscar_asistentes($intID);
			//Si existen asistentes del registro, se asignan al array
			if($otdAsistentes)
			{
				$arrDatos['asistentes'] = $otdAsistentes;
			}
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intEventoID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intEventoID');
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
			$bolResultado = $this->eventos->set_estatus($intID, $strEstatus);
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
	
	//Método para subir los archivos de un registro
    public function subir_archivos()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$intEventoID = $_POST["intEventoID_eventos_mercadotecnia"];
		$strBotonArchivoID = $_FILES["archivo_varios_eventos_mercadotecnia"];
		//Variable que se utiliza para asigar el nombre de los archivos que no se movieron a la carpeta
		$strArchivosNoMovidos = '';
		
		//Recuperar los archivos seleccionados
		if(isset($strBotonArchivoID))
		{
			//Definir ubicación de la carpeta principal
			$strCarpetaDestino = './archivos/';
			//Si no existe la carpeta crearla
			if(!is_dir($strCarpetaDestino))
			{ 
				@mkdir($strCarpetaDestino, 0700); 
			}

		    //Concaternar ubicación de la carpeta destino
			$strCarpetaDestino .= './eventos/';
			//Si no existe la carpeta crearla
			if(!is_dir($strCarpetaDestino))
			{ 
				@mkdir($strCarpetaDestino, 0700); 
			} 

			//Definir ubicación de la carpeta
			$strNombreCarpeta = $strCarpetaDestino.$intEventoID; 
			$strRuta = $strNombreCarpeta.'/';
			//Si no existe la carpeta crearla
			if(!is_dir($strNombreCarpeta))
			{ 
				@mkdir($strNombreCarpeta, 0700); 
			} 

			//Hacer recorrido para obtener archivos 
			for($intCont = 0; $intCont < count($strBotonArchivoID["name"]); $intCont++)
		    {
		    	$strBotonArchivoID["name"][$intCont];
		    	//Asignar array con los datos del archivo
		      	$strArchivo = $strBotonArchivoID["name"][$intCont];

		      	//Si existe archivo
		      	if($strArchivo != '')
		      	{
		      		$strExtension = pathinfo($strArchivo, PATHINFO_EXTENSION);
			      	//Convertir extension a minúsculas
	            	$strExtension = strtolower($strExtension);
			      	//Nombre del archivo 
					$strNombreArchivo = $intEventoID.'.'.$strExtension;

			      	//Hacer recorrido en la carpeta para obtener archivos
					foreach (scandir($strNombreCarpeta) as $item) 
					{
						if ($item == '.' OR $item == '..') continue;
						//Verificar si existe archivo de la orden de compra
						if($item == $strNombreArchivo)
						{
							//Borrar fichero del servidor
							unlink($strRuta.$item);
						}
					}//Cierre de foreach de los archivos del proveedor

					//Mover archivo a la carpeta
					if (move_uploaded_file($strBotonArchivoID["tmp_name"][$intCont], $strRuta."$strNombreArchivo")){}
					else
					{
						//Se concatena el nombre del archivo a la variable
						$strArchivosNoMovidos.= $strArchivo.' y ';
					}
		      	}
		      	
		    }

		    //Si hay archivos que no se movieron a la carpeta
		    if ($strArchivosNoMovidos != '') 
			{
				//Quitar el último simbolo concatenado y
		        $strArchivosNoMovidos = substr($strArchivosNoMovidos, 0, -2);

				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => 'Ocurrió un error al subir el archivo '.$strArchivosNoMovidos.', vuelva a intentarlo.');
			} 
			else 
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos = array('resultado' => TRUE,
							 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
							      'mensaje' => 'El archivo se guardó correctamente.');
				
			}

			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}

    //Método para descargar archivos de un registro
    public function descargar_archivos($intEventoID)
	{
		//Definir ubicación de la carpeta principal
		$strCarpetaDestino = './archivos/eventos/';
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $strCarpetaDestino.$intEventoID;
		//Asignar nombre de la carpeta zip
		$strNombreCarpetaZIP = 'E_'.$intEventoID.'.zip';
		//Verificar si la carpeta es un directorio 
        if (is_dir($strNombreCarpeta))
        {
        	//Comprimir contenido del directorio
        	$this->zip->read_dir($strNombreCarpeta, FALSE);
        	//Descargar carpeta zip
			$this->zip->download($strNombreCarpetaZIP);
        }
	}

	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $strBusqueda = NULL) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->eventos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $strBusqueda);
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
		$pdf->strLinea1=  'LISTADO DE EVENTOS '.$strTituloRangoFechas;
		//Agregar la primer pagina
		$pdf->AddPage();
		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Crea los titulos de la cabecera
		$arrCabecera = array('FECHA', 'EVENTO', 'LOCALIDAD', 'ASISTENTES', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$arrAchura = array(20, 62, 70, 18, 20);
		//Establece la alineación de las celdas de la tabla
		$arrAlineacion = array('L', 'L', 'L', 'R', 'C');
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
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Concatenar los datos de la localidad
				$strLocalidad = $arrCol->localidad.', '.$arrCol->municipio.', '.$arrCol->estado_rep.', '.
								$arrCol->pais_rep;

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->fecha, utf8_decode($arrCol->descripcion),  
								utf8_decode($strLocalidad), $arrCol->total_asistentes,
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
		$pdf->Output('eventos.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro($intEventoID) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para contar el número de asistentes
		$intContador = 0;
		//Seleccionar los datos del evento que coincide con el id
		$otdEvento = $this->eventos->buscar($intEventoID);
		//Seleccionar los datos de los asistentes del evento
		$otdAsistentes = $this->eventos->buscar_asistentes($intEventoID); 
		//Seleccionar los datos de los presupuesto del evento
		$otdDetalles = $this->eventos->buscar_detalles($intEventoID); 
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
		//Variable que se utiliza para asignar descripción del evento (y poder identificar reporte)
		$strDescripcion = '';
		//Agregar la primer pagina
		$pdf->AddPage();
		//Verificar si hay información del registro
		if($otdEvento)
		{
			//Asignar descripción del evento 
			$strDescripcion = $otdEvento->descripcion;
			//Cambiar color de relleno de la celda
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->Ln(10);//Espacios de salto de línea
			//Descripción del evento
	        //Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'EVENTO', 1, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(117, 5, utf8_decode($strDescripcion), 1, 0, 'L', 0);
			//Fecha
	        //Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(20, 5, 'FECHA', 1, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, $otdEvento->fecha, 1, 1, 'L', 0);
			//Localidad
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'LOCALIDAD', 1, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(157, 5, utf8_decode($otdEvento->localidad), 1, 1, 'L', 0);
			//Municipio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'MUNICIPIO', 1, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(42, 5, utf8_decode($otdEvento->municipio), 1, 0, 'L', 0);
			//Estado
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(18, 5, 'ESTADO', 1, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(40, 5, utf8_decode($otdEvento->estado), 1, 0, 'L', 0);
			//País
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(17, 5, utf8_decode('PAÍS'), 1, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(40, 5, utf8_decode($otdEvento->pais), 1, 1, 'L', 0);
			//Verificar si existe información de asistentes
			if($otdAsistentes)
			{
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
				$pdf->Cell(190, 5, utf8_decode('ASISTENTES'), 1, 1, 'C', 1);
				$pdf->SetTextColor(0); //establece el color de texto negro
				//Crea los titulos de la cabecera
				$arrCabecera = array('PROSPECTO', utf8_decode('TELÉFONO'), 'CORREO', 
									 utf8_decode('INTERÉS'), 'LOCALIDAD');
				//Establece el ancho de las columnas de cabecera
				$arrAchura = array(37, 18, 35, 50, 50);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'L', 'L', 'L');
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAchura);
				//Recorre el array de titulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabecera); $intCont++) 
				{ 
					$pdf->SetTextColor(0); //establece el color de texto
				   	//inserta los titulos de la cabecera
				    $pdf->Cell($arrAchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, 'C', FALSE);
				}
				$pdf->Ln(7);
				//Recorremos el arreglo 
				foreach ($otdAsistentes as $arrAsist)
				{ 
					//Concatenar los datos de la localidad
					$strLocalidad = $arrAsist->localidad.', '.$arrAsist->municipio.', '.$arrAsist->estado_rep;

					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row(array(utf8_decode($arrAsist->prospecto), $arrAsist->telefono, 
				    			    utf8_decode($arrAsist->correo_electronico), 
				    				utf8_decode($arrAsist->interesado),utf8_decode($strLocalidad)), 
				    			    $arrCabecera, $arrAchura, $arrAlineacion); 

				    //Incrementar el contador por cada registro
					$intContador++;
				}
				
				//Espacios de salto de línea
				$pdf->Ln();
				//Asigna el tipo y tamaño de letra para los totales
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Escribe la cadena concatenada con el total de registros
				$pdf->Cell(0,3,'TOTAL: '.$intContador, 0, 0, 'R');

			}//Cierre de verificación de asistentes
			//Verificar si existe información de asistentes
			if($otdDetalles)
			{
				$pdf->Ln(10);//Espacios de salto de línea
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
				$pdf->Cell(190, 5, utf8_decode('Presupuesto'), 1, 1, 'C', 1);
				$pdf->SetTextColor(0); //establece el color de texto negro
				//Crea los titulos de la cabecera
				$arrCabecera = array('Cantidad','Concepto', 'Importe Unitario', 'Total');
				//Establece el ancho de las columnas de cabecera
				$arrAchura = array(37, 53, 50, 50);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'R', 'R');
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAchura);
				//Recorre el array de titulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabecera); $intCont++) 
				{ 
					$pdf->SetTextColor(0); //establece el color de texto
				   	//inserta los titulos de la cabecera
				    $pdf->Cell($arrAchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, 'C', FALSE);
				}
				$pdf->Ln(7);
				$intContador = 0;
				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDetalles)
				{ 		
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row(array(number_format($arrDetalles->cantidad),
				    			    utf8_decode($arrDetalles->concepto), 
				    				"$".number_format($arrDetalles->importe_unitario ,2),
				    				"$".number_format($arrDetalles->total ,2)), 
				    			    $arrCabecera, $arrAchura, $arrAlineacion); 

				    //Incrementar el contador por cada registro
					$intContador++;
				}
				
				//Espacios de salto de línea
				$pdf->Ln();
				//Asigna el tipo y tamaño de letra para los totales
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Escribe la cadena concatenada con el total de registros
				$pdf->Cell(0,3,'TOTAL: '.$intContador, 0, 0, 'R');

			}//Cierre de verificación de asistentes
		}//Cierre de verificación de información
		//Ejecutar la salida del reporte
		$pdf->Output('evento_'.$strDescripcion.'.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $strBusqueda = NULL) 
	{	
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Variable que se utiliza para sumar lo toltal presupuesto
        $intTotalPresupuesto = 0;
		//Variable que se utiliza para contar el número de registros
        $intEventoTempID = 0;
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->eventos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $strBusqueda);	
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
			     ->setCellValue('A7', 'LISTADO DE EVENTOS '.$strTituloRangoFechas);
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('B'.$intPosEncabezados, 'EVENTO')
        		 ->setCellValue('C'.$intPosEncabezados, 'LOCALIDAD')
        		 ->setCellValue('D'.$intPosEncabezados, 'MUNICIPIO')
        		 ->setCellValue('E'.$intPosEncabezados, 'ESTADO')
        		 ->setCellValue('F'.$intPosEncabezados, 'PAÍS')
        		 ->setCellValue('G'.$intPosEncabezados, 'ASISTENTES')
        		 ->setCellValue('H'.$intPosEncabezados, 'PRESUPUESTO')
                 ->setCellValue('I'.$intPosEncabezados, 'ESTATUS');
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
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:I9')
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
                         ->setCellValue('A'.$intFila, $arrCol->fecha)
                         ->setCellValue('B'.$intFila, $arrCol->descripcion)
                         ->setCellValue('C'.$intFila, $arrCol->localidad)
                         ->setCellValue('D'.$intFila, $arrCol->municipio)
                         ->setCellValue('E'.$intFila, $arrCol->estado)
                         ->setCellValue('F'.$intFila, $arrCol->pais)
                         ->setCellValue('G'.$intFila, $arrCol->total_asistentes)
                         ->setCellValue('H'.$intFila, $arrCol->total_presupuesto)                    
                         ->setCellValue('I'.$intFila, $arrCol->estatus);                        
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)
                	 ->getAlignment()                	 
                	 ->applyFromArray($arrStyleAlignmentRight);

            //Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('H'.$intFilaInicial.':'.'H'.$intFila)                	 
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

			$objExcel->getActiveSheet()
                	 ->getStyle('I'.$intFilaInicial.':'.'I'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

             //Cambiar contenido de las celdas que contendrán formato moneda
             $objExcel->getActiveSheet()
                	 ->getStyle('H'.$intFilaInicial.':'.'H'.$intFila)
                	 ->getNumberFormat()
                	  ->setFormatCode('$#,##0.00');
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('I'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('I'.$intFila)
            		 ->applyFromArray($arrStyleBold);


		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'eventos.xls', 'eventos', $intFila);
	}

	/*******************************************************************************************************************
	Funciones de la tabla eventos_asistentes
	*********************************************************************************************************************/
    //Método para guardar los datos de un registro
	public function guardar_asistentes()
	{ 
		//Variables que se utilizan para recuperar los valores de la vista
		$intEventoID = $this->input->post('intEventoID');
		$strProspectoID =  $this->input->post('strProspectoID'); 
		$strTelefonos = $this->input->post('strTelefonos'); 
		$strCorreosElectronicos = $this->input->post('strCorreosElectronicos'); 
		$strLocalidadID = $this->input->post('strLocalidadID'); 
		$strInteresados = $this->input->post('strInteresados'); 

		//Guardamos los datos del registro
		$bolResultado = $this->eventos->guardar_asistentes($intEventoID, $strProspectoID, $strTelefonos, 
														   $strCorreosElectronicos, $strLocalidadID, 
														   $strInteresados);
		
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
			$otdResultado = $this->eventos->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->evento, 
		        						'data' => $arrCol->evento_id);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}


}