<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campanas_publicitarias extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('mercadotecnia/campanas_publicitarias_model', 'campanas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('mercadotecnia/campanas_publicitarias', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->campanas->filtro($this->input->post('dteFechaInicial'),
										  $this->input->post('dteFechaFinal'),
										  $this->input->post('intModuloID'),
										  $this->input->post('intZonaID'),
										  $this->input->post('intLocalidadID'),
										  $this->input->post('intMunicipioID'),
										  $this->input->post('intEstadoID'),
			                              $config['per_page'],
			                              $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['campanas'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			
			//Variable que se utiliza para asignar la zona
			$strZona = (($arrDet->zona !== NULL && 
						 empty($arrDet->zona) === FALSE) ?
	                     ' ZONA: '.$arrDet->zona : '');

			//Variable que se utiliza para asignar la localidad
			$strLocalidad = (($arrDet->localidad !== NULL && 
						 	  empty($arrDet->localidad) === FALSE) ?
	                         ' LOC. '.$arrDet->localidad : '');

			//Variable que se utiliza para asignar el municipio
			$strMunicipio = (($arrDet->municipio !== NULL && 
						 	  empty($arrDet->municipio) === FALSE) ?
	                          ', '.$arrDet->municipio : '');

			//Variable que se utiliza para asignar el estado
			$strEstado = (($arrDet->estado !== NULL && 
						   empty($arrDet->estado) === FALSE) ?
	                       ', '.$arrDet->estado : '');

			//Concatenar datos para la referencia
			$arrDet->referencia = $strZona.$strLocalidad.$strMunicipio.$strEstado;

			//Si el usuario cuenta con el permiso de acceso VER REGISTRO
			if (in_array('VER REGISTRO', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón Ver registro
        		$arrDet->mostrarAccionVerRegistro = '';	
			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['campanas'],
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

	//Método para guardar los datos de un registro
	public function guardar()
	{ 
		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$strTipo = $this->input->post('strTipo');
		$intModuloID = $this->input->post('intModuloID');
		$intZonaID = $this->input->post('intZonaID');
		$intLocalidadID = $this->input->post('intLocalidadID');
		$intMunicipioID = $this->input->post('intMunicipioID');
		$intEstadoID = $this->input->post('intEstadoID');
		$strTitulo =  mb_strtoupper(trim($this->input->post('strTitulo')));
		$strComentarios =  mb_strtoupper(trim($this->input->post('strComentarios')));
		$strArchivo = $this->input->post('strArchivo');
		//Variable que se utiliza para asignar el id del usuario logeado en el sistema
		$intUsuarioID = $this->session->userdata('usuario_id');
		//Variable para concatenar los correos electrónicos del tipo
		$strCorreosEletronicos = '';
		//Variable para asignar el número de correos electrónicos a los que se le envio la campaña publicitaria
		$intAlcance = 0;

		//Dependiendo del tipo, seleccionar los correos electrónicos de los registros activos
		$otdCorreosEletronicos = $this->campanas->buscar_correos_electronicos($strTipo);

		//Verificar si existe información de correos electrónicos 
		if($otdCorreosEletronicos)
		{
			//Recorremos el arreglo 
			foreach ($otdCorreosEletronicos as $arrCorr)
			{	
				//Variable que se utiliza para asignar el correo electrónico
				$strCorreoElectronico = '';
				//Variable que se utiliza para asignar el correo electrónico del contacto
				$strContactoCorreoElectronico = '';

				//Verificar si los correos son iguales
				if($arrCorr->correo_electronico == $arrCorr->contacto_correo_electronico)
				{
					$strCorreoElectronico = $arrCorr->correo_electronico;
				}
				else
				{
					$strCorreoElectronico =  $arrCorr->correo_electronico;
					$strContactoCorreoElectronico =  $arrCorr->contacto_correo_electronico;

				}

				//Si existe correo electrónico
				if($strCorreoElectronico != '')
				{
					//Se concatena el correo electrónico a la variable
					$strCorreosEletronicos.= $strCorreoElectronico.',';
					//Incrementar alcance
					$intAlcance++;
				}

				//Si existe correo electrónico del contacto
				if($strContactoCorreoElectronico != '')
				{
					//Se concatena el correo electrónico a la variable
					$strCorreosEletronicos.= $strContactoCorreoElectronico.',';
					//Incrementar alcance
					$intAlcance++;
				}
			}

			//Quitar el último simbolo concatenado ,
			$strCorreosEletronicos = substr($strCorreosEletronicos, 0, -1);

		}//Cierre de verificación de correos electrónicos

		//Si la lista tiene al menos un correo electrónico
		if($strCorreosEletronicos != '')
		{
			//Inicializar configuraciones para enviar email
			$this->email->initialize($this->ARR_CONFIG_EMAIL);
			//Correo que envía mensaje
			$this->email->from(CORREO_CONFIGURACION, TITULO_NAVEGADOR);
			//Copia oculta
			$this->email->bcc($strCorreosEletronicos);
			//Asunto
			$this->email->subject($strTitulo);
			//Asignar los comentarios en el array para mostrarlos en la plantilla (email)
			$arrDatosEmail["strTitulo"] = $strTitulo;
			$arrDatosEmail["strComentarios"] = $strComentarios;
			//Cargar plantilla email
			$objMensaje = $this->load->view('pages/plantilla_email', $arrDatosEmail, TRUE);
			//Mensaje
			$this->email->message($objMensaje);
			//Si existe archivo del registro
			if($strArchivo != '')
			{
				//Definir ubicación del archivo temporal
				$strCarpetaDestino = './archivos/campanas_publicitarias/';
				//Definir ubicación de la carpeta
				$strNombreCarpeta = $strCarpetaDestino.$intUsuarioID;
				$strRuta = $strNombreCarpeta.'/'.$strArchivo;
				//Adjuntar archivo
				$this->email->attach($strRuta);
			}
			
			//Si no se obtienen errores al enviar el correo electrónico
			if($this->email->send())
			{	
				//Guardamos los datos del registro
				$bolResultado = $this->campanas->guardar($strTipo, $intModuloID, $intZonaID, $intLocalidadID, 
														 $intMunicipioID, $intEstadoID, $strTitulo, $strComentarios, 
														 $intAlcance);
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
			else
			{

				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => 'Ocurrió un error al enviar correo electrónico, vuelva a intentarlo.');
			}

		}
		else
		{
			//Enviar el mensaje de error al formulario
			$arrDatos = array('resultado' => FALSE,
						      'tipo_mensaje' => TIPO_MSJ_ERROR,
				              'mensaje' => 'No se encontraron correos electrónicos de '.$strTipo.'.');
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
		$intID = $this->input->post('intCampanaPublicitariaID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->campanas->buscar($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para subir el archivo (o imagen) de un registro
	public function subir_archivo()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$strBotonArchivoID = $this->input->post('strBotonArchivoID');
		//Variable que se utiliza para asignar el id del usuario logeado en el sistema
		$intUsuarioID = $this->session->userdata('usuario_id');
		//Variable que se utiliza para asignar el nombre del archivo
		$strNombreArchivo = '';
		//Recuperar el archivo seleccionado
		if (isset($_FILES[$strBotonArchivoID])) 
		{
			//Asignar array con los datos del archivo
			$strArchivo = $_FILES[$strBotonArchivoID];
			$strExtension = pathinfo($strArchivo['name'], PATHINFO_EXTENSION);
			//Convertir extension a minúsculas
            $strExtension = strtolower($strExtension);
			//Nombre del archivo o imagen
			$strNombreArchivo = date("YmdHis").'_'.$intUsuarioID.'.'.$strExtension;
			//Definir ubicación de la carpeta principal
			$strCarpetaDestino = './archivos/';
			//Si no existe la carpeta crearla
			if(!is_dir($strCarpetaDestino))
			{ 
				@mkdir($strCarpetaDestino, 0700); 
			}

			//Concaternar ubicación de la carpeta destino
			$strCarpetaDestino .= '/campanas_publicitarias/';
			//Si no existe la carpeta crearla
			if(!is_dir($strCarpetaDestino))
			{ 
				@mkdir($strCarpetaDestino, 0700); 
			}
 			
 			//Definir ubicación de la carpeta
			$strNombreCarpeta = $strCarpetaDestino.$intUsuarioID; 
			$strRuta = $strNombreCarpeta.'/';
			//Si no existe la carpeta crearla
			if(!is_dir($strNombreCarpeta))
			{ 
				@mkdir($strNombreCarpeta, 0700); 
			} 
		
			//Mover archivo a la carpeta
			if (move_uploaded_file($strArchivo['tmp_name'],$strRuta."$strNombreArchivo")) 
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos = array('resultado' => TRUE,
							 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
							 	  'archivo' => $strNombreArchivo,
							      'mensaje' => 'El archivo se guardó correctamente.');
			} 
			else 
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => 'Ocurrió un error al subir el archivo, vuelva a intentarlo.');
			}

			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
    }

    //Método para eliminar el archivo (o imagen) de un registro
	public function eliminar_archivo()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$strNombreArchivo = $this->input->post('strArchivo');
		//Variable que se utiliza para asignar el id del usuario logeado en el sistema
		$intUsuarioID = $this->session->userdata('usuario_id');
		//Variable que se utiliza para contar el número de archivos que contiene la carpeta del usuario
        $intContador = 0;

        //Definir ubicación de la carpeta principal
		$strCarpetaDestino = './archivos/campanas_publicitarias/';
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $strCarpetaDestino.$intUsuarioID;
		//Asignar la ruta del archivo
        $strRuta = $strNombreCarpeta.'/'.$strNombreArchivo;

		//Verificar si la carpeta es un directorio 
        if (is_dir($strNombreCarpeta))
        {
        	//Hacer recorrido en la carpeta para obtener archivos
            foreach (scandir($strNombreCarpeta) as $item) 
            {
                if ($item == '.' OR $item == '..') continue;
                //Incrementar el contador por cada archivo
                $intContador++;
                //Si existe el archivo temporal
                if($item == $strNombreArchivo)
                {
                	//Borrar fichero del servidor
					if (!unlink($strRuta))
					{
						//Enviar el mensaje de error al formulario
						$arrDatos = array('resultado' => FALSE,
								          'tipo_mensaje' => TIPO_MSJ_ERROR,
						                  'mensaje' => 'Ocurrió un error al eliminar el archivo, vuelva a intentarlo.');
					}
					else
					{
						//Decrementar el contador, para indicar que se eliminó el archivo temporal
						$intContador--;

						//Enviar el mensaje de éxito al formulario
						$arrDatos = array('resultado' => TRUE,
									 	  'tipo_mensaje' => TIPO_MSJ_EXITO);
					}

                }
            }

            //Si no existen archivos en la carpeta del usuario
            if($intContador == 0)
            {
            	//Borrar carpeta del servidor
            	if (!rmdir($strNombreCarpeta))
				{
					//Enviar el mensaje de error al formulario
    				$arrDatos = array('resultado' => FALSE,
    								  'tipo_mensaje' => TIPO_MSJ_ERROR,
			              		      'mensaje' => 'No es posible eliminar carpeta temporal');
				}
				else
				{
					//Enviar el mensaje de éxito al formulario
					$arrDatos = array('resultado' => TRUE,
								 	  'tipo_mensaje' => TIPO_MSJ_EXITO);
				}
            }
            
            //Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
        }
	}

	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $intModuloID, $intZonaID, 
							    $intLocalidadID, $intMunicipioID, $intEstadoID) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->campanas->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intModuloID, $intZonaID, 
							    				$intLocalidadID, $intMunicipioID, $intEstadoID); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = utf8_decode('LISTADO DE CAMPAÑAS PUBLICITARIAS');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Crea los titulos de la cabecera
		$arrCabecera = array('FECHA', 'TIPO', utf8_decode('MÓDULO'), 'ALCANCE', 'ENVIADO A');
		//Establece el ancho de las columnas de cabecera
		$arrAchura = array(20, 20, 25, 15, 110);
		//Establece la alineación de las celdas de la tabla
		$arrAlineacion = array('L', 'L', 'L', 'R', 'L');
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
				//Variable que se utiliza para asignar la zona
				$strZona = (($arrCol->zona !== NULL && 
							 empty($arrCol->zona) === FALSE) ?
		                     ' ZONA: '.$arrCol->zona : '');

				//Variable que se utiliza para asignar la localidad
				$strLocalidad = (($arrCol->localidad !== NULL && 
							 	  empty($arrCol->localidad) === FALSE) ?
		                         ' LOC. '.$arrCol->localidad : '');

				//Variable que se utiliza para asignar el municipio
				$strMunicipio = (($arrCol->municipio !== NULL && 
							 	  empty($arrCol->municipio) === FALSE) ?
		                          ', '.$arrCol->municipio : '');

				//Variable que se utiliza para asignar el estado
				$strEstado = (($arrCol->estado_rep !== NULL && 
							   empty($arrCol->estado_rep) === FALSE) ?
		                       ', '.$arrCol->estado_rep : '');

				//Concatenar datos para la referencia
				$strReferencia = $strZona.$strLocalidad.$strMunicipio.$strEstado;

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->fecha,  $arrCol->tipo, $arrCol->modulo, $arrCol->alcance,
								utf8_decode($strReferencia)), $arrCabecera, $arrAchura, $arrAlineacion);
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
		$pdf->Output('campanas_publicitarias.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $intModuloID, $intZonaID, 
							$intLocalidadID, $intMunicipioID, $intEstadoID) 
	{	
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->campanas->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intModuloID, $intZonaID, 
							    				$intLocalidadID, $intMunicipioID, $intEstadoID); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE CAMPAÑAS PUBLICITARIAS');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'TIPO')
        		 ->setCellValue('B'.$intPosEncabezados, 'MÓDULO')
        		 ->setCellValue('C'.$intPosEncabezados, 'ZONA')
        		 ->setCellValue('D'.$intPosEncabezados, 'LOCALIDAD')
        		 ->setCellValue('E'.$intPosEncabezados, 'MUNICIPIO')
        		 ->setCellValue('F'.$intPosEncabezados, 'ESTADO')
        		 ->setCellValue('G'.$intPosEncabezados, 'ALCANCE')
        		 ->setCellValue('H'.$intPosEncabezados, 'TÍTULO')
                 ->setCellValue('I'.$intPosEncabezados, 'COMENTARIOS');
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
                         ->setCellValue('A'.$intFila, $arrCol->tipo)
                         ->setCellValue('B'.$intFila, $arrCol->modulo)
                         ->setCellValue('C'.$intFila, $arrCol->zona)
                         ->setCellValue('D'.$intFila, $arrCol->localidad)
                         ->setCellValue('E'.$intFila, $arrCol->municipio)
                         ->setCellValue('F'.$intFila, $arrCol->estado)
                         ->setCellValue('G'.$intFila, $arrCol->alcance)
                         ->setCellValue('H'.$intFila, $arrCol->titulo)
                         ->setCellValue('I'.$intFila, $arrCol->comentarios);
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

			$objExcel->getActiveSheet()
                	 ->getStyle('I'.$intFilaInicial.':'.'I'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
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
        $this->get_pie_pagina_archivo_excel($objExcel, 'campanas_publicitarias.xls', 'campañas', $intFila);
	}
}