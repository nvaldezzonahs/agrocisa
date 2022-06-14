<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prospectos extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de prospectos
		$this->load->model('crm/prospectos_model', 'prospectos');
		//Cargamos el modelo de módulos
		$this->load->model('crm/modulos_model', 'modulos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('crm/prospectos', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->prospectos->filtro(trim($this->input->post('strBusqueda')),
			                                 $config['per_page'],
			                                 $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['prospectos'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionValidacion = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro =  'registro-'.$arrDet->estatus;

		    //Concatenar datos para la localidad
	    	$arrDet->localidad = $arrDet->localidad . ', ' . $arrDet->municipio. ', ' . 
	    						 $arrDet->estado. ', ' .$arrDet->pais;

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

				/*Si el prospecto no se encuentra en la tabla clientes
				  o el cliente (prospecto) se encuentra rechazado*/
				if($arrDet->cliente == '' OR $arrDet->cliente_estatus == 'RECHAZADO')
				{
					//Si el usuario cuenta con el permiso de acceso VALIDAR
					if (in_array('VALIDAR', $arrPermisos))
					{
						//Asignar cadena vacia para mostrar botón Validación
						$arrDet->mostrarAccionValidacion = '';
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

	    		//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
				if (in_array('CAMBIAR ESTATUS', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Restaurar
					$arrDet->mostrarAccionRestaurar = '';
				}

	    	}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['prospectos'],
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
		$objProspecto = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Datos del prospecto
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
		$objProspecto->intProspectoID = $this->input->post('intProspectoID');
		$objProspecto->strNombreComercial = mb_strtoupper(trim($this->input->post('strNombreComercial')));
		$objProspecto->strTelefonoPrincipal = $this->input->post('strTelefonoPrincipal');
		$objProspecto->strTelefonoSecundario = $this->input->post('strTelefonoSecundario');
		$objProspecto->strCorreoElectronico = mb_strtolower(trim($this->input->post('strCorreoElectronico')));
		$objProspecto->strPaginaWeb = trim($this->input->post('strPaginaWeb'));
		$objProspecto->strCalle = mb_strtoupper(trim($this->input->post('strCalle')));
		$objProspecto->strNumeroExterior = mb_strtoupper($this->input->post('strNumeroExterior'));
		$objProspecto->strNumeroInterior = mb_strtoupper($this->input->post('strNumeroInterior'));
		$objProspecto->strColonia = mb_strtoupper(trim($this->input->post('strColonia')));
		$objProspecto->strReferencia =  mb_strtoupper(trim($this->input->post('strReferencia')));
		//Si no existe id del código postal asignar valor nulo
		$objProspecto->intCodigoPostalID = (($this->input->post('intCodigoPostalID') !== '') ? 
											 $this->input->post('intCodigoPostalID') : NULL);
		$objProspecto->intLocalidadID = $this->input->post('intLocalidadID');
		$objProspecto->strContactoNombre =  mb_strtoupper(trim($this->input->post('strContactoNombre')));
		//Si la fecha esta vacia asignar valor nulo
		$objProspecto->dteContactoFechaNacimiento = (($this->input->post('dteContactoFechaNacimiento') !== '') ? 
												      $this->input->post('dteContactoFechaNacimiento') : NULL);
		$objProspecto->strContactoTelefono = $this->input->post('strContactoTelefono');
		$objProspecto->strContactoExtension = trim($this->input->post('strContactoExtension'));
		$objProspecto->strContactoCelular = $this->input->post('strContactoCelular');
		$objProspecto->strContactoCorreoElectronico =  mb_strtolower(trim($this->input->post('strContactoCorreoElectronico')));
		$objProspecto->strContactoHobbies = mb_strtoupper(trim($this->input->post('strContactoHobbies')));
		$objProspecto->strImportante = $this->input->post('strImportante');
		$objProspecto->intHectareasTemporal = $this->input->post('intHectareasTemporal');
		$objProspecto->intHectareasRiego = $this->input->post('intHectareasRiego');
		$objProspecto->intHectareasOtras = $this->input->post('intHectareasOtras');
		$objProspecto->intTerrenoArenoso = $this->input->post('intTerrenoArenoso');
		$objProspecto->intTerrenoArcilloso = $this->input->post('intTerrenoArcilloso');
		$objProspecto->intTerrenoCompacto = $this->input->post('intTerrenoCompacto');
		$objProspecto->intTerrenoPedregoso = $this->input->post('intTerrenoPedregoso');
		$objProspecto->intTerrenoOtros = $this->input->post('intTerrenoOtros');
		$objProspecto->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos del inventario
		$objProspecto->strSeries = $this->input->post('strSeries'); 
		$objProspecto->strMaquinariaMarcaID = $this->input->post('strMaquinariaMarcaID'); 
		$objProspecto->strMaquinariaModeloID = $this->input->post('strMaquinariaModeloID'); 
		$objProspecto->strDescripciones =  $this->input->post('strDescripciones'); 
		$objProspecto->strAnios = $this->input->post('strAnios'); 
		$objProspecto->strHoras = $this->input->post('strHoras');
		$objProspecto->strCaballos = $this->input->post('strCaballos');
		$objProspecto->strTracciones = $this->input->post('strTracciones');
		$objProspecto->strRecambios = $this->input->post('strRecambios');
		//Datos de las actividades
		$objProspecto->strActividadID = $this->input->post('strActividadID');
		//Datos de los cultivos
		$objProspecto->strCultivoID =  $this->input->post('strCultivoID');
		$objProspecto->strHectareas = $this->input->post('strHectareas');

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objProspecto->intProspectoID))
		{
			$bolResultado = $this->prospectos->modificar($objProspecto);
		}
		else
		{ 
			$bolResultado = $this->prospectos->guardar($objProspecto);
			
			/*Quitar '_'  de la cadena (resultadoTransaccion_prospectoID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro */
		    list($bolResultado, $objProspecto->intProspectoID) = explode("_", $bolResultado); 
		}
        //Si no se obtienen errores al ejecutar el proceso
		if($bolResultado)
		{
			//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE,
						 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
						 	  'prospecto_id' => $objProspecto->intProspectoID,
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
		$intID = $this->input->post('intProspectoID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->prospectos->buscar($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado[0];
			
			//Seleccionar el inventario del registro
			$otdInventario = $this->prospectos->buscar_inventario($intID);
			//Si existe inventario del registro, se asignan al array
			if($otdInventario)
			{
				$arrDatos['inventario'] = $otdInventario;
			}

			//Seleccionar las actividades del registro
			$otdActividades = $this->prospectos->buscar_actividades($intID);
			//Si existen actividades del registro, se asignan al array
			if($otdActividades)
			{
				$arrDatos['actividades'] = $otdActividades;
			}

			//Seleccionar los cultivos del registro
			$otdCultivos = $this->prospectos->buscar_cultivos($intID);
			//Si existen cultivos del registro, se asignan al array
			if($otdCultivos)
			{
				$arrDatos['cultivos'] = $otdCultivos;
			}
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intProspectoID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intProspectoID');
		    $strEstatus = $this->input->post('strEstatus');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->prospectos->set_estatus($intID, $strEstatus);
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

	//Método para  enviar a validación los datos de un registro
	public function set_validacion()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intProspectoID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intProspectoID');
	        $strEstatusCliente = $this->input->post('strEstatusCliente');
	        $strUsuarios = $this->input->post('strUsuarios');
	        $strMensaje = trim($this->input->post('strMensaje'));
	        //Hacer un llamado al método para validar los datos de un registro
			$bolResultado = $this->prospectos->set_validacion($intID, $strEstatusCliente, $strUsuarios, $strMensaje);
			//Si no se obtienen errores al ejecutar el proceso
			if($bolResultado)
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos = array('resultado' => TRUE,
							 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
							      'mensaje' => 'La notificación se envió correctamente.');
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
		$strTipo = $this->input->post('strTipo');
		$strFacturar = $this->input->post('strFacturar');
		$intProspectoID = $this->input->post('intProspectoID');
		//Variable que se utiliza para realizar búsqueda de datos
		$strBuscarDatos = 'SI';

		//Si se cumple la sentencia (en caso de que el tipo de búsqueda sea series es obligatorio el tipo de servicio (Facturar = SI/NO))
		if($strTipo == 'series' && $strFacturar == '')
		{
			//No realizar búsqueda de datos
			$strBuscarDatos = 'NO';
		}
		

		//Si existe descripción
		if(isset($strDescripcion) && $strBuscarDatos == 'SI')
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
		
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->prospectos->autocomplete($strDescripcion, $strEstatus, $strTipo,
														    $strFacturar, $intProspectoID);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
					/*************************************************************************************
					*Array ques se utiliza para agregar datos del registro
					**************************************************************************************/
					//Si el Autocomplete es por serie (prospectos_inventario y maquinaria_inventario)
				    if($strTipo == 'series')
					{
						//Array que se utiliza para enviar datos
						$arrRegistro = array('value' => $arrCol->serie,
								  	    	 'data' => $arrCol->referencia_id);	
					}
					else
					{
						//Array que se utiliza para enviar datos
						$arrRegistro = array('value' => $arrCol->prospecto,
								  	         'data' => $arrCol->prospecto_id);

						//Si el Autocomplete es por referencias (clientes y prospectos)
						if($strTipo == 'referencias')
						{
							//Agregar elemento en el array
							$arrRegistro['refacciones_lista_precio_id'] = $arrCol->refacciones_lista_precio_id; 
							$arrRegistro['servicio_lista_precio_id'] = $arrCol->servicio_lista_precio_id;
							$arrRegistro['maquinaria_lista_precio_id'] = $arrCol->maquinaria_lista_precio_id;
						}
					}
					


					$arrDatos[] = $arrRegistro;
		        	
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
		$strBusqueda = trim($this->input->post('strBusqueda'));
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;

		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->prospectos->buscar(NULL, $strBusqueda); 
		
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1= 'LISTADO DE PROSPECTOS';
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('CÓDIGO'), 'NOMBRE', 'CONTACTO', 'LOCALIDAD', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(15, 55, 50, 50, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L', 'C');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Concatenar datos para la localidad
	    		$strLocalidad = $arrCol->localidad .', '. $arrCol->municipio. ', ';
	    		$strLocalidad .= $arrCol->estado_rep.', '.$arrCol->pais_rep;

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->codigo, utf8_decode($arrCol->nombre_comercial), 
								utf8_decode($arrCol->contacto_nombre), utf8_decode($strLocalidad), 
								$arrCol->estatus), $pdf->arrAlineacion);
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
		$pdf->Output('prospectos.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strDetalles = $this->input->post('strDetalles');
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Array que se utiliza para establecer los títulos de la cabecera detalles
		$arrCabeceraDet = array();
        //Variables que se utilizan para asignar el número de columna donde se empezaran a escribir los detalles 
        $intIndColDet = 34;
        $intIndColE = $intIndColDet;
       
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->prospectos->buscar(NULL, $strBusqueda); 
		//Seleccionar los datos de los módulos activos
		$otdModulos = $this->modulos->buscar(NULL, NULL, NULL, 'ACTIVO');
     	
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE PROSPECTOS');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'CÓDIGO')
        		 ->setCellValue('B'.$intPosEncabezados, 'NOMBRE COMERCIAL')
        		 ->setCellValue('C'.$intPosEncabezados, 'TELÉFONO PRINCIPAL')
        		 ->setCellValue('D'.$intPosEncabezados, 'TELÉFONO SECUNDARIO')
        		 ->setCellValue('E'.$intPosEncabezados, 'CORREO ELECTRÓNICO')
        		 ->setCellValue('F'.$intPosEncabezados, 'PÁGINA WEB')
        		 ->setCellValue('G'.$intPosEncabezados, 'CALLE')
                 ->setCellValue('H'.$intPosEncabezados, 'NO. EXTERIOR')
                 ->setCellValue('I'.$intPosEncabezados, 'NO. INTERIOR')
                 ->setCellValue('J'.$intPosEncabezados, 'CÓDIGO POSTAL')
                 ->setCellValue('K'.$intPosEncabezados, 'COLONIA')
                 ->setCellValue('L'.$intPosEncabezados, 'LOCALIDAD')
                 ->setCellValue('M'.$intPosEncabezados, 'REFERENCIA')
                 ->setCellValue('N'.$intPosEncabezados, 'MUNICIPIO')
                 ->setCellValue('O'.$intPosEncabezados, 'ESTADO')
                 ->setCellValue('P'.$intPosEncabezados, 'PAÍS')
                 ->setCellValue('Q'.$intPosEncabezados, 'NOMBRE DE CONTACTO')
                 ->setCellValue('R'.$intPosEncabezados, 'FECHA DE NACIMIENTO')
                 ->setCellValue('S'.$intPosEncabezados, 'TELÉFONO DE OFICINA')
                 ->setCellValue('T'.$intPosEncabezados, 'EXTENSIÓN')
                 ->setCellValue('U'.$intPosEncabezados, 'CELULAR')
                 ->setCellValue('V'.$intPosEncabezados, 'CORREO ELECTRÓNICO')
                 ->setCellValue('W'.$intPosEncabezados, 'HOBBIES')
                 ->setCellValue('X'.$intPosEncabezados, 'CLIENTE IMPORTANTE PARA')
                 ->setCellValue('Y'.$intPosEncabezados, 'NO. HECTÁREAS TEMPORAL')
                 ->setCellValue('Z'.$intPosEncabezados, 'RIEGO')
                 ->setCellValue('AA'.$intPosEncabezados, 'OTRAS')
                 ->setCellValue('AB'.$intPosEncabezados, 'HECTÁREAS TIPO ARENOSO')
                 ->setCellValue('AC'.$intPosEncabezados, 'ARCILLOSO')
                 ->setCellValue('AD'.$intPosEncabezados, 'COMPACTO')
                 ->setCellValue('AE'.$intPosEncabezados, 'PEDREGOSO')
                 ->setCellValue('AF'.$intPosEncabezados, 'OTROS')
                 ->setCellValue('AG'.$intPosEncabezados, 'ESTATUS');

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
    			 ->getStyle('A9:AG9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);
        
         //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {

        	//Verificar si existe información de módulos 
        	if($otdModulos)
        	{
        		//Hacer recorrido para obtener los datos de los módulos
				foreach ($otdModulos as $arrMod) 
				{
					//Descripción del módulo
					$arrCabeceraDet[] = 'VENDEDOR '.$arrMod->descripcion;
				}

        	}//Cierre de verificación de módulos


        	//Agregar datos a los array de la cabecera detalles
        	$arrCabeceraDet[] = 'VENDEDOR ÚLTIMA VISITA';
        	$arrCabeceraDet[] = 'MADUREZ';
        	$arrCabeceraDet[] = 'ÚLTIMA VISITA';
        	$arrCabeceraDet[] = 'PRÓXIMA VISITA';
        	$arrCabeceraDet[] = 'COMENTARIOS';
        	$arrCabeceraDet[] = 'INVENTARIO DESCRIPCIÓN';
        	$arrCabeceraDet[] = 'AÑO';
        	$arrCabeceraDet[] = 'SERIE';
        	$arrCabeceraDet[] = 'MARCA';
        	$arrCabeceraDet[] = 'MODELO';
        	$arrCabeceraDet[] = 'HORAS';
        	$arrCabeceraDet[] = 'CABALLOS';
        	$arrCabeceraDet[] = 'TRACCIÓN';
        	$arrCabeceraDet[] = 'RECAMBIO';
        	$arrCabeceraDet[] = 'ACTIVIDAD';
        	$arrCabeceraDet[] = 'CULTIVO';
        	$arrCabeceraDet[] = 'HECTÁREAS';


	        //Hacer recorrido para obtener los datos de la cabecera detalles
	    	foreach ($arrCabeceraDet as $arrDet) 
	    	{
	    		//Asignar columna actual
	    		$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados;

	        	//Se agrega en el encabezado del archivo 
	        	$objExcel->getActiveSheet()->setCellValue($strColActual, $arrDet);

	        	 //Cambiar estilo de las siguientes celdas
		        $objExcel->getActiveSheet()
		        		 ->getStyle($strColActual)
		        		 ->applyFromArray($arrStyleBold);

		        //Cambiar alineación de las siguientes celdas
			    $objExcel->getActiveSheet()
			        	 ->getStyle($strColActual)
			        	 ->getAlignment()
			        	 ->applyFromArray($arrStyleAlignmentCenter);

		        //Preferencias de color de relleno de celda
	       		$objExcel->getActiveSheet()
	    			     ->getStyle($strColActual)
	    			     ->getFill()
	    			     ->applyFromArray($arrStyleColumnas);

		        //Preferencias de color de texto de la celda
	       	    $objExcel->getActiveSheet()
	    			     ->getStyle($strColActual)
	    			     ->applyFromArray($arrStyleFuenteColumnas);


			    //Incrementar indice de la columna
				$intIndColE++;  

	        }//Cierre de foreach (cabecera detalles)
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
		        //Variable que se utiliza para asignar el número de actividades
		        $intNumActividades = 0;
		        //Variable que se utiliza para asignar el número de cultivos 
		        $intNumCultivos = 0;
		        //Variable que se utiliza para asignar el número de inventarios
		        $intNumInventarios = 0;
		        //Asignar el id del prospecto
		        $intProspectoID = $arrCol->prospecto_id;

		         //Buscar la descripción de los módulos del prospecto
			    $strModulos = '';
		        //Asignar ID´s de los módulos importantes
		        $strImportante = $arrCol->importante;

		        //Si existen módulos
		        if($strImportante != '')
		        {
		        	 $arrModulosID = explode('|', $strImportante);
				    //Hacer recorrido para obtener el id de los módulos
				    foreach ($arrModulosID as &$intModuloID) 
				    {		    
					    //Seleccionar los datos del módulo
						$otdModulo = $this->modulos->buscar($intModuloID);
						//Si existe información del módulo
						if($otdModulo)
						{
							//Concatenamos la descripción del módulo a la variable de impresión
							$strModulos .= $otdModulo->descripcion.', ';

						}//Cierre de verificación del módulo
						
					}

					//Quitar último elemento de la cadena (,)
					$strModulos = substr($strModulos, 0, -2);
		        }


		        //Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
					//Seleccionar el inventario del registro
					$otdInventario = $this->prospectos->buscar_inventario($intProspectoID);
					//Verificar si existe información del inventario
					if($otdInventario)
				    {
				    	//Variable que se utiliza para contar el número de inventarios
				    	$intContInv = 0;
				    	//Asignar el número de inventarios
				    	$intNumInventarios = count($otdInventario);
				    	//Si el número de inventarios es mayor que el número de detalles
						if($intNumInventarios > $intNumDetalles)
						{   
							//Asignar el número de inventarios
							$intNumDetalles = $intNumInventarios;
						}

						//Recorremos el arreglo 
				        foreach ($otdInventario as $arrInv) 
				        {
				        	//Asignar datos al array
				        	$arrDetalles[$intContInv]['descripcion']= $arrInv->descripcion;
				        	$arrDetalles[$intContInv]['anio']= $arrInv->anio;
				        	$arrDetalles[$intContInv]['serie']= $arrInv->serie;
				        	$arrDetalles[$intContInv]['maquinaria_marca']= $arrInv->maquinaria_marca;
				        	$arrDetalles[$intContInv]['maquinaria_modelo']= $arrInv->maquinaria_modelo;
				        	$arrDetalles[$intContInv]['horas']= $arrInv->horas;
				        	$arrDetalles[$intContInv]['caballos']= $arrInv->caballos;
				        	$arrDetalles[$intContInv]['traccion']= $arrInv->traccion;
				        	$arrDetalles[$intContInv]['recambio']= $arrInv->recambio;
				        	//Incrementar el contador por cada registro
	                        $intContInv++;
				        }

				    }//Cierre de verificación de inventario

					//Seleccionar las actividades del registro
					$otdActividades = $this->prospectos->buscar_actividades($intProspectoID);
					//Verificar si existe información de las actividades 
				    if($otdActividades)
				    {
				    	//Variable que se utiliza para contar el número de actividades
				    	$intContAct = 0;
				    	//Asignar el número de actividades
				    	$intNumActividades = count($otdActividades);
				    	//Si el número de actividades es mayor que el número de detalles
						if($intNumActividades > $intNumDetalles)
						{	
							//Asignar el número de actividades
							$intNumDetalles = $intNumActividades;
						}
						
						//Recorremos el arreglo 
				        foreach ($otdActividades as $arrAct) 
				        {
				        	//Asignar datos al array
				        	$arrDetalles[$intContAct]['actividad']= $arrAct->actividad;
							//Incrementar el contador por cada registro
	                        $intContAct++;
				        }

				    }//Cierre de verificación de actividades

					//Seleccionar los cultivos del registro
				    $otdCultivos = $this->prospectos->buscar_cultivos($intProspectoID);
				    //Verificar si existe información de los cultivos 
				    if($otdCultivos)
				    {
				    	//Variable que se utiliza para contar el número de cultivos
				    	$intContCult = 0;
				    	//Asignar el número de cultivos
				    	$intNumCultivos = count($otdCultivos);
				    	//Si el número de cultivos es mayor que el número de detalles
				    	if($intNumCultivos > $intNumDetalles)
						{
							//Asignar el número de cultivos
							$intNumDetalles = $intNumCultivos;
						}

						//Recorremos el arreglo 
				        foreach ($otdCultivos as $arrCult) 
				        {
				        	//Asignar datos al array
				        	$arrDetalles[$intContCult]['cultivo']= $arrCult->cultivo;
				        	$arrDetalles[$intContCult]['hectareas']= $arrCult->hectareas;
				        	//Incrementar el contador por cada registro
	                        $intContCult++;
				        }

				    }//Cierre de verificación de cultivos

				}//Cierre de verificación de detalles
			    
			    //Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    { 
					//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
							 ->setCellValueExplicit('A'.$intFila, $arrCol->codigo, PHPExcel_Cell_DataType::TYPE_STRING)
			        		 ->setCellValue('B'.$intFila, $arrCol->nombre_comercial)
			        		 ->setCellValue('C'.$intFila, $arrCol->telefono_principal)
			        		 ->setCellValue('D'.$intFila, $arrCol->telefono_secundario)
			        		 ->setCellValue('E'.$intFila, $arrCol->correo_electronico)
			        		 ->setCellValue('F'.$intFila, $arrCol->pagina_web)
			        		 ->setCellValue('G'.$intFila, $arrCol->calle)
			                 ->setCellValue('H'.$intFila, $arrCol->numero_exterior)
			                 ->setCellValue('I'.$intFila, $arrCol->numero_interior)
			                 ->setCellValue('J'.$intFila, $arrCol->codigo_postal)
			                 ->setCellValue('K'.$intFila, $arrCol->colonia)
			                 ->setCellValue('L'.$intFila, $arrCol->localidad)
			                 ->setCellValue('M'.$intFila, $arrCol->referencia)
			                 ->setCellValue('N'.$intFila, $arrCol->municipio)
			                 ->setCellValue('O'.$intFila, $arrCol->estado)
			                 ->setCellValue('P'.$intFila, $arrCol->pais)
			                 ->setCellValue('Q'.$intFila, $arrCol->contacto_nombre)
			                 ->setCellValue('R'.$intFila, $arrCol->fecha_nacimiento)
			                 ->setCellValue('S'.$intFila, $arrCol->contacto_telefono)
			                 ->setCellValue('T'.$intFila, $arrCol->contacto_extension)
			                 ->setCellValue('U'.$intFila, $arrCol->contacto_celular)
			                 ->setCellValue('V'.$intFila, $arrCol->contacto_correo_electronico)
			                 ->setCellValue('W'.$intFila, $arrCol->contacto_hobbies)
			                 ->setCellValue('X'.$intFila, $strModulos)
			                 ->setCellValue('Y'.$intFila, $arrCol->hectareas_temporal)
			                 ->setCellValue('Z'.$intFila, $arrCol->hectareas_riego)
			                 ->setCellValue('AA'.$intFila, $arrCol->hectareas_otras)
			                 ->setCellValue('AB'.$intFila, $arrCol->terreno_arenoso)
			                 ->setCellValue('AC'.$intFila, $arrCol->terreno_arcilloso)
			                 ->setCellValue('AD'.$intFila, $arrCol->terreno_compacto)
			                 ->setCellValue('AE'.$intFila, $arrCol->terreno_pedregoso)
			                 ->setCellValue('AF'.$intFila, $arrCol->terreno_otros)
			                 ->setCellValue('AG'.$intFila, $arrCol->estatus);

			        //Si se cumple la sentencia mostrar detalles del registro
					if($strDetalles == 'SI')
					{
						//Inicializar variable para escribir los detalles del prospecto
						$intIndColE = $intIndColDet;

						//Verificar si existe información de módulos 
						if($otdModulos)
			        	{
			        		//Hacer recorrido para obtener los datos del vendedor
							foreach ($otdModulos as $arrMod) 
							{
								
							    //Seleccionar los datos del vendedor asignado al módulo
							    $otdVendedor = $this->prospectos->buscar_vendedores_prospecto($intProspectoID, $arrMod->modulo_id);
							    //Tomar primer elemento del array
								$otdVendedor = $otdVendedor[0]; 
								//Si existe información del vendedor
							    if($otdVendedor)
							    {
							    	//Asignar columna actual
							   		$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFila;

							    	//Agregar información del vendedor
									$objExcel->getActiveSheet()
					                    	 ->setCellValue($strColActual, $otdVendedor->vendedor);

							    }//Cierre de verificación de vendedor en el módulo

					            //Incrementar indice de la columna
								$intIndColE++;  

							}//Cierre de foreach

			        	}//Cierre de verificación de módulos


					    //Agregar información de la última visita
					    $objExcel->setActiveSheetIndex(0)
					   			 ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intFila, $arrCol->vendedor)
			                 	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+1].$intFila, $arrCol->madurez)
			                 	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+2].$intFila, $arrCol->ultima_visita)
			                 	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+3].$intFila, $arrCol->proxima_visita)
			                 	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+4].$intFila, $arrCol->comentario);

			           	//Cambiar alineación de las siguientes celdas
			            $objExcel->getActiveSheet()
			                	 ->getStyle($this->ARR_COLUMNAS[$intIndColE+1].$intFila.':'.
			                	 			$this->ARR_COLUMNAS[$intIndColE+3].$intFila)
			                	 ->getAlignment()
			                	 ->applyFromArray($arrStyleAlignmentCenter);

			            //Incrementar indice de la columna (sumar el número de columnas correspondientes a la última visita)
			            $intIndColE = $intIndColE+5;

				        //Si existen inventarios
			            if($intNumInventarios > 0)
			            {
			            	//Agregar información del inventario
							$objExcel->setActiveSheetIndex(0)
						        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intFila, $arrDetalles[$intContDet]['descripcion'])
						        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+1].$intFila, $arrDetalles[$intContDet]['anio'])
						        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+2].$intFila, $arrDetalles[$intContDet]['serie'])
						        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+3].$intFila, $arrDetalles[$intContDet]['maquinaria_marca'])
						        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+4].$intFila, $arrDetalles[$intContDet]['maquinaria_modelo'])
						        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+5].$intFila, $arrDetalles[$intContDet]['horas'])
						        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+6].$intFila, $arrDetalles[$intContDet]['caballos'])
						        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+7].$intFila, $arrDetalles[$intContDet]['traccion'])
						        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+8].$intFila, $arrDetalles[$intContDet]['recambio']);

						    //Decrementar el número de inventarios
						    $intNumInventarios --;
			            }

			            //Incrementar indice de la columna (sumar el número de columnas correspondientes al inventario)
			            $intIndColE = $intIndColE+9;

			            //Si existen actividades
			            if($intNumActividades > 0)
			            {
			            	//Agregar información de la actividad
							$objExcel->setActiveSheetIndex(0)
						        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intFila, $arrDetalles[$intContDet]['actividad']);

						    //Decrementar el número de actividades
						    $intNumActividades --;
			            }

			            //Incrementar indice de la columna (sumar el número de columnas correspondientes a las actividades)
			            $intIndColE++;

			            //Si existen cultivos
			            if($intNumCultivos > 0)
			            {
			            	//Agregar información del cultivo
							$objExcel->setActiveSheetIndex(0)
							 		 ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intFila, $arrDetalles[$intContDet]['cultivo'])
						             ->setCellValue($this->ARR_COLUMNAS[$intIndColE+1].$intFila, $arrDetalles[$intContDet]['hectareas']);


				            //Cambiar contenido de la celda a formato númerico de 2 decimales
					        $objExcel->getActiveSheet()
					                 ->getStyle($this->ARR_COLUMNAS[$intIndColE+1].$intFila)
					                 ->getNumberFormat()
            		 				 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

					        //Cambiar alineación de la celda
				            $objExcel->getActiveSheet()
				                	 ->getStyle($this->ARR_COLUMNAS[$intIndColE+1].$intFila)
				                	 ->getAlignment()
				                	 ->applyFromArray($arrStyleAlignmentRight);


						    //Decrementar el número de cultivos
						    $intNumCultivos --;
			            }
			        }
	                
	                //Incrementar el indice para escribir los datos del siguiente registro
	                $intFila++; 
                }

                //Incrementar el contador por cada registro
			    $intContador++;
			}

			//Cambiar contenido de las celdas a formato númerico
            $objExcel->getActiveSheet()
            		 ->getStyle('Y'.$intFilaInicial.':'.'AF'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

			//Cambiar alineación de las siguientes celdas
           	 $objExcel->getActiveSheet()
                	 ->getStyle('R'.$intFilaInicial.':'.'R'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('Y'.$intFilaInicial.':'.'AF'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
                	 ->getStyle('AG'.$intFilaInicial.':'.'AG'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('AG'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('AG'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'prospectos.xls', 'prospectos', $intFila);
	}
}