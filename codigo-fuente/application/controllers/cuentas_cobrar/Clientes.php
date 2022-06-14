<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends MY_Controller {
	
	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar ruta de la carpeta principal
	    $this->archivo['strCarpetaPrincipal'] = './archivos/';
		//Asignar ruta de la carpeta destino
	    $this->archivo['strCarpetaDestino'] = './archivos/clientes_expediente/';
	    //Asignar ruta de la carpeta destino de personas autorizadas
	    $this->archivo['strCarpetaDestinoPA'] =  './archivos/clientes_personas_autorizadas/';
	    //Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('cuentas_cobrar/clientes_model', 'clientes');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('cuentas_cobrar/clientes', $arrDatos);
	}

	/*******************************************************************************************************************
	Funciones de la tabla clientes
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->clientes->filtro(trim($this->input->post('strBusqueda')),
										  NULL,
			                              $config['per_page'],
			                              $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['clientes'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro =  'registro-'.$arrDet->estatus;

			//Variable que se utiliza para asignar el número interior
			$strNumInterior = (($arrDet->numero_interior !== NULL && 
						        empty($arrDet->numero_interior) === FALSE) ?
	                            ' INT. '.$arrDet->numero_interior : '');

		    //Variable que se utiliza para asignar el código postal
			$strCodigoPostal = (($arrDet->codigo_postal !== NULL && 
						        empty($arrDet->codigo_postal) === FALSE) ?
	                            ' C.P. '.$arrDet->codigo_postal : '');

			//Variable que se utiliza para concatenar municipio, estado y país
			$strMunicipio = (($arrDet->municipio !== NULL && 
						        empty($arrDet->municipio) === FALSE) ?
	                            ', '. $arrDet->municipio.', '.
	    						 $arrDet->estado.', '.$arrDet->pais : '');

			//Concatenar datos para el domicilio
	    	$arrDet->domicilio = $arrDet->calle.' #'.$arrDet->numero_exterior.$strNumInterior.
	    						 ' COL. ' .$arrDet->colonia.$strCodigoPostal. ' ' .
	    						 $arrDet->localidad.$strMunicipio;

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
		$arrDatos = array('rows' => $result['clientes'],
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

	//Método para modificar los datos generales de un registro
	public function modificar_datos_generales()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objCliente = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objCliente->intProspectoID = $this->input->post('intProspectoID');
		$objCliente->strTipoPersona = mb_strtoupper(trim($this->input->post('strTipoPersona')));
		$objCliente->strRazonSocial = mb_strtoupper(trim($this->input->post('strRazonSocial')));
		$objCliente->strRfc = mb_strtoupper(trim($this->input->post('strRfc')));
		$objCliente->intRegimenFiscalID = $this->input->post('intRegimenFiscalID');
		$objCliente->strNombreComercial = mb_strtoupper(trim($this->input->post('strNombreComercial')));
		$objCliente->strRepresentanteLegal = ($this->input->post('strRepresentanteLegal'))?mb_strtoupper(trim($this->input->post('strRepresentanteLegal'))):'';
		$objCliente->strTelefonoPrincipal = $this->input->post('strTelefonoPrincipal');
		$objCliente->strTelefonoSecundario = $this->input->post('strTelefonoSecundario');
		$objCliente->strCorreoElectronico = mb_strtolower(trim($this->input->post('strCorreoElectronico')));
		$objCliente->strCalle = mb_strtoupper(trim($this->input->post('strCalle')));
		$objCliente->strNumeroExterior = mb_strtoupper($this->input->post('strNumeroExterior'));
		$objCliente->strNumeroInterior = mb_strtoupper($this->input->post('strNumeroInterior'));
		$objCliente->intCodigoPostalID = $this->input->post('intCodigoPostalID');
		$objCliente->strColonia = mb_strtoupper(trim($this->input->post('strColonia')));
		$objCliente->strLocalidad = mb_strtoupper(trim($this->input->post('strLocalidad')));
		$objCliente->strReferencia =  mb_strtoupper(trim($this->input->post('strReferencia')));
		$objCliente->intMunicipioID =  $this->input->post('intMunicipioID');
		$objCliente->strContactoNombre =  mb_strtoupper(trim($this->input->post('strContactoNombre')));
		$objCliente->strContactoTelefono = $this->input->post('strContactoTelefono');
		$objCliente->strContactoExtension = $this->input->post('strContactoExtension');
		$objCliente->strContactoCelular = $this->input->post('strContactoCelular');
		$objCliente->strContactoCorreoElectronico =  mb_strtolower(trim($this->input->post('strContactoCorreoElectronico')));
		$objCliente->strEstatus = (($this->input->post('strEstatus') !== '')? $this->input->post('strEstatus') : NULL);
		$objCliente->intUsuarioID = $this->session->userdata('usuario_id');
		//Actualizamos los datos generales del registro
		$bolResultado = $this->clientes->modificar($objCliente);		
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

	//Método para modificar los datos crediticios de un registro
	public function modificar_datos_crediticios()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objCliente = new stdClass();		
		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objCliente->intProspectoID = $this->input->post('intProspectoID');
		$objCliente->strCreditoSolicitud = mb_strtoupper(trim($this->input->post('strCreditoSolicitud')));
		//Si la fecha esta vacia asignar valor nulo
		$objCliente->dteCreditoInicio = (($this->input->post('dteCreditoInicio') !== '') ? 
								$this->input->post('dteCreditoInicio') : NULL);
		$objCliente->intUsoCFDIID = (($this->input->post('intUsoCFDIID') !== '') ? 
							             $this->input->post('intUsoCFDIID') : NULL);
		$objCliente->strDiasRevision = mb_strtoupper(trim($this->input->post('strDiasRevision')));
		$objCliente->strDiasPago = mb_strtoupper(trim($this->input->post('strDiasPago')));
		$objCliente->strEncargadoCompras = mb_strtoupper(trim($this->input->post('strEncargadoCompras')));
		$objCliente->strEncargadoPagos = mb_strtoupper(trim($this->input->post('strEncargadoPagos')));
		$objCliente->strComentariosCredito = mb_strtoupper(trim($this->input->post('strComentariosCredito')));
		$objCliente->intMaquinariaCreditoLimite = trim($this->input->post('intMaquinariaCreditoLimite'));
		$objCliente->intMaquinariaCreditoDias = $this->input->post('intMaquinariaCreditoDias');
		$objCliente->intMaquinariaApoyo = trim($this->input->post('intMaquinariaApoyo'));
		//Si no existe id de la lista de precios de maquinaria asignar valor nulo
		$objCliente->intMaquinariaListaPrecioID = (($this->input->post('intMaquinariaListaPrecioID') !== '') ? 
							            $this->input->post('intMaquinariaListaPrecioID') : NULL);
		$objCliente->intRefaccionesCreditoLimite = trim($this->input->post('intRefaccionesCreditoLimite'));
		$objCliente->intRefaccionesCreditoDias = $this->input->post('intRefaccionesCreditoDias');
		$objCliente->intRefaccionesApoyo =  trim($this->input->post('intRefaccionesApoyo'));
		//Si no existe id de la lista de precios de refacciones asignar valor nulo
		$objCliente->intRefaccionesListaPrecioID = (($this->input->post('intRefaccionesListaPrecioID') !== '') ? 
							             $this->input->post('intRefaccionesListaPrecioID') : NULL);
		$objCliente->intServicioCreditoLimite = trim($this->input->post('intServicioCreditoLimite'));
		$objCliente->intServicioCreditoDias = $this->input->post('intServicioCreditoDias');
		$objCliente->intServicioListaPrecioID = (($this->input->post('intServicioListaPrecioID') !== '') ? 
							             $this->input->post('intServicioListaPrecioID') : NULL);
		$objCliente->intServicioApoyo = trim($this->input->post('intServicioApoyo'));
		$objCliente->intUsuarioID = $this->session->userdata('usuario_id');

		//Actualizamos los datos crediticios del registro
		$bolResultado = $this->clientes->modificar_datos_crediticios($objCliente);
		
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
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intID = $this->input->post('intProspectoID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->clientes->buscar($intID);
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
			$bolResultado = $this->clientes->set_estatus($intID, $strEstatus);
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
		$strTipo =  $this->input->post('strTipo');

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->clientes->autocomplete($strDescripcion, $strTipo);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
					

					//Si el autocomplete se va a mostrar en los reportes de saldos
					if($strTipo == 'saldos')
					{
						//Concatenar el estatus del registro
						$strRazonSocial = $arrCol->codigo.' - '.$arrCol->razon_social;
						$strRazonSocial .= ' ('.$arrCol->estatus.')';
					}
					else
					{
						//Asignar la razón social del cliente
						$strRazonSocial =  $arrCol->razon_social;
					}

					//Agregar datos al array
		        	$arrDatos[] = array('value' => $strRazonSocial, 
		        						'data' => $arrCol->prospecto_id,
		        					    'telefono'=> $arrCol->telefono_principal, 
		        					    'refacciones_lista_precio_id' => $arrCol->refacciones_lista_precio_id, 
		        						'regimen_fiscal_id'=> $arrCol->regimen_fiscal_id);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}



	//Método para subir el archivo (o imagen) de un registro
	public function subir_archivo()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$intDocumentoID = $this->input->post('intDocumentoID');
		$intProspectoID = $this->input->post('intProspectoID');
		$strBotonArchivoID = $this->input->post('strBotonArchivoID');
		//Asignar el nombre de la carpeta 
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intProspectoID; 

		//Hacer un llamado a la función para subir el archivo
		$this->subir_archivo_reg($strBotonArchivoID, $this->archivo['strCarpetaPrincipal'], 
								 $this->archivo['strCarpetaDestino'], 
							     $strNombreCarpeta, $intDocumentoID);
    }

    //Método para descargar el archivo (o imagen) de un registro
    public function descargar_archivo()
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$intProspectoID = $this->input->post('intProspectoID');
		$intDocumentoID = $this->input->post('intDocumentoID');

		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intProspectoID;

		//Hacer un llamado a la función para descargar el archivo
		$this->descargar_archivo_reg($strNombreCarpeta, $intDocumentoID);
	}
	
	//Método para eliminar el archivo (o imagen) de un registro
	public function eliminar_archivo()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$intProspectoID = $this->input->post('intProspectoID');
		$intDocumentoID = $this->input->post('intDocumentoID');
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intProspectoID;

		//Hacer un llamado a la función para eliminar el archivo
		$this->eliminar_archivo_reg($strNombreCarpeta, $intDocumentoID);
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
		$otdResultado = $this->clientes->buscar(NULL, NULL, $strBusqueda); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  'LISTADO DE CLIENTES';
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('CÓDIGO'), 'CLIENTE', 'DOMICILIO', utf8_decode('TELÉFONOS'), 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(15, 55, 80, 20, 20);
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
				//Variable que se utiliza para asignar el número interior
				$strNumInterior = (($arrCol->numero_interior !== NULL && 
							        empty($arrCol->numero_interior) === FALSE) ?
		                            ' INT. '.$arrCol->numero_interior : '');

			    //Variable que se utiliza para asignar el código postal
				$strCodigoPostal = (($arrCol->codigo_postal !== NULL && 
							        empty($arrCol->codigo_postal) === FALSE) ?
		                            ' C.P. '.$arrCol->codigo_postal : '');

				//Variable que se utiliza para concatenar municipio, estado y país
				$strMunicipio = (($arrCol->municipio !== NULL && 
							        empty($arrCol->municipio) === FALSE) ?
		                            ', '. $arrCol->municipio.', '.
		    						 $arrCol->estado_rep.', '.$arrCol->pais_rep : '');

				//Concatenar datos para el domicilio
		    	$strDomicilio = $arrCol->calle.' #'.$arrCol->numero_exterior.$strNumInterior.
		    				    ' COL. ' .$arrCol->colonia.$strCodigoPostal. ' ' .
		    					$arrCol->localidad.$strMunicipio;

		    	//Variable que se utiliza para asignar el teléfono secundario
				$strTelefonoSecundario = (($arrCol->telefono_secundario !== NULL && 
							       		   empty($arrCol->telefono_secundario) === FALSE) ?
		                                   ' '.$arrCol->telefono_secundario : '');
				//Concatenar teléfonos
				$strTelefonos = $arrCol->telefono_principal.$strTelefonoSecundario;

                 
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->codigo, utf8_decode($arrCol->razon_social), utf8_decode($strDomicilio),
							   $strTelefonos, $arrCol->estatus), $pdf->arrAlineacion);
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
		$pdf->Output('clientes.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro() 
	{	  
		//Variables que se utilizan para recuperar los valores de la vista
		$intProspectoID = $this->input->post('intProspectoID');          
		//Seleccionar los datos del cliente que coincide con el id
		$otdCliente = $this->clientes->buscar($intProspectoID);
		//Seleccionar los datos de los vendedores del cliente
		$otdVendedores = $this->clientes->buscar_vendedores_cliente($intProspectoID); 
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
		//Variable que se utiliza para asignar código del cliente (y poder identificar reporte)
		$strCodigo  = '';
		//Agregar la primer pagina
		$pdf->AddPage();
		//Verificar si hay información del registro
		if($otdCliente)
		{
			//Asignar código del cliente 
			$strCodigo = $otdCliente->codigo;
			//Cambiar color de relleno de la celda
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->Ln(10);//Espacios de salto de línea
			//Datos generales
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, 'DATOS GENERALES', 0, 1, 'C', 1);
			$pdf->SetTextColor(0); //establece el color de texto negro
			//Código
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, utf8_decode('CÓDIGO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, $strCodigo, 0, 0, 'L', 0);
			//Razón social
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(25, 5, utf8_decode('RAZÓN SOCIAL'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(55, 5, utf8_decode($otdCliente->razon_social), 0, 0, 'L', 0);
			//Tipo de persona
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(25, 5, utf8_decode('TIPO PERSONA'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(32, 5, utf8_decode($otdCliente->tipo_persona), 0, 1, 'L', 0);
			//RFC
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'RFC', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(62, 5, utf8_decode($otdCliente->rfc), 0, 0, 'L', 0);
			//Fecha de creación
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(26, 5, 'FECHA INGRESO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(37, 5, utf8_decode($otdCliente->fecha_creacion), 0, 0, 'L', 0);
			//Estatus
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(18, 5, 'ESTATUS', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, utf8_decode($otdCliente->estatus), 0, 1, 'L', 0);
			//Régimen fiscal
			//Asigna el tipo y tamaño de letra
		    $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, utf8_decode('RÉGIMEN FISCAL'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(90, 5, mb_strtoupper($otdCliente->regimen_fiscal), 0, 1, 'L', 0);
			//Nombre comercial
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'NOMBRE COMERCIAL', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(62, 5, utf8_decode($otdCliente->nombre_comercial), 0, 0, 'L', 0);
			//Representante legal
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(38, 5, 'REPRESENTANTE LEGAL', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(57, 5, utf8_decode($otdCliente->representante_legal), 0, 1, 'L', 0);
			//Teléfono principal
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, utf8_decode('TELÉFONO PRINCIPAL'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, $otdCliente->telefono_principal, 0, 0, 'L', 0);
			//Teléfono secundario
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(22, 5, utf8_decode('SECUNDARIO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, $otdCliente->telefono_principal, 0, 0, 'L', 0);
			//Correo electrónico
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(38, 5, utf8_decode('CORREO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(57, 5, utf8_decode($otdCliente->correo_electronico), 0, 1, 'L', 0);
			//Domicilio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(190, 5, 'DOMICILIO', 0, 1, 'L', 0);
			//Calle
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'CALLE', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(62, 5, utf8_decode($otdCliente->calle), 0, 0, 'L', 0);
			//Número exterior
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(15, 5, 'NO. EXT.', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, utf8_decode($otdCliente->numero_exterior), 0, 0, 'L', 0);
			//Número exterior
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(15, 5, 'NO. INT.', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, utf8_decode($otdCliente->numero_interior), 0, 0, 'L', 0);
			//Código postal
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(10, 5, 'C.P.', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(15, 5, $otdCliente->codigo_postal, 0, 1, 'L', 0);
			//Colonia
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'COLONIA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(42, 5, utf8_decode($otdCliente->colonia), 0, 0, 'L', 0);
			//Localidad
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(20, 5, 'LOCALIDAD', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(35, 5, utf8_decode($otdCliente->localidad), 0, 0, 'L', 0);
			//Referencia
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(21, 5, 'REFERENCIA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(39, 5, utf8_decode($otdCliente->referencia), 0, 1, 'L', 0);
			//Municipio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'MUNICIPIO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(42, 5, utf8_decode($otdCliente->municipio), 0, 0, 'L', 0);
			//Estado
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(20, 5, 'ESTADO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(35, 5, utf8_decode($otdCliente->estado), 0, 0, 'L', 0);
			//País
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(21, 5, utf8_decode('PAÍS'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(39, 5, utf8_decode($otdCliente->pais), 0, 1, 'L', 0);
			//Datos de contacto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(190, 5, 'DATOS DE CONTACTO', 0, 1, 'L', 0);
			//Nombre
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'NOMBRE', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(157, 5, utf8_decode($otdCliente->contacto_nombre), 0, 1, 'L', 0);
			//Teléfono 
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, utf8_decode('TELÉFONO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, $otdCliente->contacto_telefono, 0, 0, 'L', 0);
			//Celular
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(22, 5, utf8_decode('CELULAR'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, $otdCliente->contacto_celular, 0, 0, 'L', 0);
			//Extensión
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(20, 5, utf8_decode('EXTENSIÓN'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(15, 5, utf8_decode($otdCliente->contacto_extension), 0, 0, 'L', 0);
			//Correo electrónico
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(15, 5, utf8_decode('CORREO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(45, 5, utf8_decode($otdCliente->contacto_correo_electronico), 0, 1, 'L', 0);
			//Datos crediticios
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, 'DATOS CREDITICIOS', 0, 1, 'C', 1);
			$pdf->SetTextColor(0); //establece el color de texto negro
			//Solicitud de crédito
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, utf8_decode('SOLICITUD  CRÉDITO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, $otdCliente->credito_solicitud, 0, 0, 'L', 0);
			//Fecha de inicio de crédito
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(22, 5, utf8_decode('FECHA INICIO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, $otdCliente->credito_inicio, 0, 0, 'L', 0);
			//Uso del CFDI
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'USO DEL CFDI', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(68, 5, utf8_decode($otdCliente->uso_cfdi), 0, 1, 'L', 0);
			//Días de revisión
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, utf8_decode('DÍAS DE REVISIÓN'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(62, 5, $otdCliente->dias_revision, 0, 0, 'L', 0);
			//Días de pago
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(38, 5, utf8_decode('DÍAS DE PAGO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(57, 5, utf8_decode($otdCliente->dias_pago), 0, 1, 'L', 0);
			//Encargado de compras
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'ENCARGADO CPRAS', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(62, 5, utf8_decode($otdCliente->encargado_compras), 0, 0, 'L', 0);
			//Encargado de pagos
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(38, 5, 'ENCARGADO DE PAGOS', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(57, 5, utf8_decode($otdCliente->encargado_pagos), 0, 1, 'L', 0);
			//Maquinaria
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(190, 5, 'MAQUINARIA', 0, 1, 'L', 0);
			//Límite de crédito
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(30, 5, utf8_decode('LÍMITE DE CRÉDITO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(40, 5, '$'.$otdCliente->maquinaria_credito_limite, 0, 0, 'L', 0);
			//Días de crédito
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(22, 5, utf8_decode('DÍAS CRÉDITO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(30, 5, $otdCliente->maquinaria_credito_dias, 0, 0, 'L', 0);
			//Lista de precios
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(29, 5, 'LISTA DE PRECIOS', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(39, 5, utf8_decode($otdCliente->maquinaria_lista_precio), 0, 1, 'L', 0);
			$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para 
			//maquinaria
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(190, 5, 'REFACCIONES', 0, 1, 'L', 0);
			//Límite de crédito
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(30, 5, utf8_decode('LÍMITE DE CRÉDITO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(40, 5, '$'.$otdCliente->refacciones_credito_limite, 0, 0, 'L', 0);
			//Días de crédito
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(22, 5, utf8_decode('DÍAS CRÉDITO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(30, 5, $otdCliente->refacciones_credito_dias, 0, 0, 'L', 0);
			//Lista de precios
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(29, 5, 'LISTA DE PRECIOS', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(39, 5, utf8_decode($otdCliente->refacciones_lista_precio), 0, 1, 'L', 0);
			$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para 
			//refacciones
			//Servicio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(190, 5, 'SERVICIO', 0, 1, 'L', 0);
			//Límite de crédito
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(30, 5, utf8_decode('LÍMITE DE CRÉDITO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(40, 5, '$'.$otdCliente->servicio_credito_limite, 0, 0, 'L', 0);
			//Días de crédito
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(22, 5, utf8_decode('DÍAS CRÉDITO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(30, 5, $otdCliente->servicio_credito_dias, 0, 0, 'L', 0);
			$pdf->Line(10, ($pdf->GetY() + 4.5), 200, ($pdf->GetY() +4.5)); //dibuja una linea para 
			//Verificar si hay información de los vendedores
			if($otdVendedores)
			{
				//Vendedores
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->Cell(190, 5, 'VENDEDOR', 0, 1, 'L', 0);
				//Recorremos el arreglo 
				foreach ($otdVendedores as $arrCol)
				{ 
					//Nombre
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->Cell(50, 5, utf8_decode($arrCol->modulo), 0, 0, 'L', 0);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->ClippedCell(157, 5, utf8_decode($arrCol->vendedor), 0, 1, 'L', 0);
				}
			}//Cierre de verificación de vendedores
		}//Cierre de verificación de información
		//Ejecutar la salida del reporte
		$pdf->Output('cliente_'.$strCodigo.'.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$strBusqueda = trim($this->input->post('strBusqueda'));
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->clientes->buscar(NULL, NULL, $strBusqueda); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE CLIENTES');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$intPosEncabezados, 'CÓDIGO')
                 ->setCellValue('B'.$intPosEncabezados, 'TIPO DE PERSONA')
                 ->setCellValue('C'.$intPosEncabezados, 'RAZÓN SOCIAL')
                 ->setCellValue('D'.$intPosEncabezados, 'RFC')
                 ->setCellValue('E'.$intPosEncabezados, 'RÉGIMEN FISCAL')
                 ->setCellValue('F'.$intPosEncabezados, 'NOMBRE COMERCIAL')
                 ->setCellValue('G'.$intPosEncabezados, 'REPRESENTANTE LEGAL')
                 ->setCellValue('H'.$intPosEncabezados, 'TELÉFONO PRINCIPAL')
                 ->setCellValue('I'.$intPosEncabezados, 'TELÉFONO SECUNDARIO')
                 ->setCellValue('J'.$intPosEncabezados, 'CORREO ELECTRÓNICO')
                 ->setCellValue('K'.$intPosEncabezados, 'CALLE')
                 ->setCellValue('L'.$intPosEncabezados, 'NO. EXTERIOR')
                 ->setCellValue('M'.$intPosEncabezados, 'NO. INTERIOR')
                 ->setCellValue('N'.$intPosEncabezados, 'CÓDIGO POSTAL')
                 ->setCellValue('O'.$intPosEncabezados, 'COLONIA')
                 ->setCellValue('P'.$intPosEncabezados, 'LOCALIDAD')
                 ->setCellValue('Q'.$intPosEncabezados, 'REFERENCIA')
                 ->setCellValue('R'.$intPosEncabezados, 'MUNICIPIO')
                 ->setCellValue('S'.$intPosEncabezados, 'ESTADO')
                 ->setCellValue('T'.$intPosEncabezados, 'PAÍS')
                 ->setCellValue('U'.$intPosEncabezados, 'NOMBRE DE CONTACTO')
                 ->setCellValue('V'.$intPosEncabezados, 'TELÉFONO DE OFICINA')
                 ->setCellValue('W'.$intPosEncabezados, 'EXTENSIÓN')
                 ->setCellValue('X'.$intPosEncabezados, 'CELULAR')
                 ->setCellValue('Y'.$intPosEncabezados, 'CORREO ELECTRÓNICO')
                 ->setCellValue('Z'.$intPosEncabezados, 'SOLICITUD DE CRÉDITO')
                 ->setCellValue('AA'.$intPosEncabezados, 'FECHA INICIO DE CRÉDITO')
                 ->setCellValue('AB'.$intPosEncabezados, 'USO DEL CFDI')
                 ->setCellValue('AC'.$intPosEncabezados, 'DÍAS DE REVISIÓN')
                 ->setCellValue('AD'.$intPosEncabezados, 'DÍAS DE PAGO')
                 ->setCellValue('AE'.$intPosEncabezados, 'ENCARGADO DE COMPRAS')
                 ->setCellValue('AF'.$intPosEncabezados, 'ENCARGADO DE PAGOS')
                 ->setCellValue('AG'.$intPosEncabezados, 'COMENTARIOS DEL CRÉDITO')
                 ->setCellValue('AH'.$intPosEncabezados, 'LÍMITE DE CRÉDITO DE MAQUINARIA')
                 ->setCellValue('AI'.$intPosEncabezados, 'DÍAS DE CRÉDITO')
                 ->setCellValue('AJ'.$intPosEncabezados, 'LISTA DE PRECIOS')
                 ->setCellValue('AK'.$intPosEncabezados, 'LÍMITE DE CRÉDITO DE REFACCIONES')
                 ->setCellValue('AL'.$intPosEncabezados, 'DÍAS DE CRÉDITO')
                 ->setCellValue('AM'.$intPosEncabezados, 'LISTA DE PRECIOS')
                 ->setCellValue('AN'.$intPosEncabezados, 'LÍMITE DE CRÉDITO DE SERVICIO')
                 ->setCellValue('AO'.$intPosEncabezados, 'DÍAS DE CRÉDITO')
                 ->setCellValue('AP'.$intPosEncabezados, 'ESTATUS');
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
    			 ->getStyle('A9:AP9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
						 ->setCellValueExplicit('A'.$intFila, $arrCol->codigo, PHPExcel_Cell_DataType::TYPE_STRING)
						 ->setCellValue('B'.$intFila,  $arrCol->tipo_persona)
		                 ->setCellValue('C'.$intFila,  $arrCol->razon_social)
		                 ->setCellValue('D'.$intFila,  $arrCol->rfc)
		                 ->setCellValue('E'.$intFila,  $arrCol->regimen_fiscal)
		                 ->setCellValue('F'.$intFila,  $arrCol->nombre_comercial)
		                 ->setCellValue('G'.$intFila,  $arrCol->representante_legal)
		                 ->setCellValue('H'.$intFila,  $arrCol->telefono_principal)
		                 ->setCellValue('I'.$intFila,  $arrCol->telefono_secundario)
		                 ->setCellValue('J'.$intFila,  $arrCol->correo_electronico)
		                 ->setCellValue('K'.$intFila,  $arrCol->calle)
		                 ->setCellValue('L'.$intFila,  $arrCol->numero_exterior)
		                 ->setCellValue('M'.$intFila,  $arrCol->numero_interior)
		                 ->setCellValue('N'.$intFila,  $arrCol->codigo_postal)
		                 ->setCellValue('O'.$intFila,  $arrCol->colonia)
		                 ->setCellValue('P'.$intFila,  $arrCol->localidad)
		                 ->setCellValue('Q'.$intFila,  $arrCol->referencia)
		                 ->setCellValue('R'.$intFila,  $arrCol->municipio)
		                 ->setCellValue('S'.$intFila,  $arrCol->estado)
		                 ->setCellValue('T'.$intFila,  $arrCol->pais)
		                 ->setCellValue('U'.$intFila,  $arrCol->contacto_nombre)
		                 ->setCellValue('V'.$intFila,  $arrCol->contacto_telefono)
		                 ->setCellValue('W'.$intFila,  $arrCol->contacto_extension)
		                 ->setCellValue('X'.$intFila,  $arrCol->contacto_celular)
		                 ->setCellValue('Y'.$intFila,  $arrCol->contacto_correo_electronico)
		                 ->setCellValue('Z'.$intFila,  $arrCol->credito_solicitud)
		                 ->setCellValue('AA'.$intFila,  $arrCol->credito_inicio)
		                 ->setCellValue('AB'.$intFila,  $arrCol->uso_cfdi)
		                 ->setCellValue('AC'.$intFila, $arrCol->dias_revision)
		                 ->setCellValue('AD'.$intFila, $arrCol->dias_pago)
		                 ->setCellValue('AE'.$intFila, $arrCol->encargado_compras)
		                 ->setCellValue('AF'.$intFila, $arrCol->encargado_pagos)
		                 ->setCellValue('AG'.$intFila, $arrCol->comentarios_credito)
		                 ->setCellValue('AH'.$intFila, $arrCol->maquinaria_credito_limite_rep)
		                 ->setCellValue('AI'.$intFila, $arrCol->maquinaria_credito_dias)
		                 ->setCellValue('AJ'.$intFila, $arrCol->maquinaria_lista_precio)
		                 ->setCellValue('AK'.$intFila, $arrCol->refacciones_credito_limite_rep)
		                 ->setCellValue('AL'.$intFila, $arrCol->refacciones_credito_dias)
		                 ->setCellValue('AM'.$intFila, $arrCol->refacciones_lista_precio)
		                 ->setCellValue('AN'.$intFila, $arrCol->servicio_credito_limite_rep)
		                 ->setCellValue('AO'.$intFila, $arrCol->servicio_credito_dias)
		                 ->setCellValue('AP'.$intFila, $arrCol->estatus);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('AH'.$intFilaInicial.':'.'AI'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            $objExcel->getActiveSheet()
        		     ->getStyle('AK'.$intFilaInicial.':'.'AL'.$intFila)
        		     ->getNumberFormat()
        		     ->setFormatCode('$#,##0.00');

        	$objExcel->getActiveSheet()
        		     ->getStyle('AN'.$intFilaInicial.':'.'AO'.$intFila)
        		     ->getNumberFormat()
        		     ->setFormatCode('$#,##0.00');

			//Cambiar alineación de las siguientes celdas
        	$objExcel->getActiveSheet()
                	 ->getStyle('AA'.$intFilaInicial.':'.'AA'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
                	 
			$objExcel->getActiveSheet()
                	 ->getStyle('AP'.$intFilaInicial.':'.'AP'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
	            	 ->getStyle('AH'.$intFilaInicial.':'.'AI'.$intFila)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentRight);

	        $objExcel->getActiveSheet()
	            	 ->getStyle('AK'.$intFilaInicial.':'.'AL'.$intFila)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentRight);

	        $objExcel->getActiveSheet()
	            	 ->getStyle('AN'.$intFilaInicial.':'.'AO'.$intFila)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentRight);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('AP'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('AP'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'clientes.xls', 'clientes', $intFila);
	}

	/*******************************************************************************************************************
	Funciones de la tabla clientes_referencias
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion_referencias()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->clientes->filtro_referencias($this->input->post('intProspectoID'),
						                              $config['per_page'],
						                              $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['referencias'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro =  'registro-'.$arrDet->estatus;

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

			}

		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['referencias'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows']);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}
	
	//Método para guardar o modificar los datos de un registro
	public function guardar_referencias()
	{ 
		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$intProspectoID = $this->input->post('intProspectoID');
		$intRenglon = $this->input->post('intRenglon');
		$strNombre = mb_strtoupper(trim($this->input->post('strNombre')));
		$strNombreAnterior = mb_strtoupper(trim($this->input->post('strNombreAnterior')));
		$strContacto = mb_strtoupper(trim($this->input->post('strContacto')));
		$strTelefono = $this->input->post('strTelefono');
		$strExtension = trim($this->input->post('strExtension'));
		$strCalificacion = mb_strtoupper(trim($this->input->post('strCalificacion')));
		$strTipo = $this->input->post('strTipo');
		$strClienteDesde = mb_strtoupper(trim($this->input->post('strClienteDesde')));
		$strManejaCredito = $this->input->post('strManejaCredito');
		$intImporteCredito = trim($this->input->post('intImporteCredito'));
		$intPlazoCredito = trim($this->input->post('intPlazoCredito'));
		$strFormaPago = mb_strtoupper(trim($this->input->post('strFormaPago')));
		$strChequeSinFondos = $this->input->post('strChequeSinFondos');
		$strAtrasos = $this->input->post('strAtrasos');
		$strGarantiaAdicional = $this->input->post('strGarantiaAdicional');
		$strExperienciaGeneral = mb_strtoupper(trim($this->input->post('strExperienciaGeneral')));
		$strTipoServicio = mb_strtoupper(trim($this->input->post('strTipoServicio')));
		$strComentarios = mb_strtoupper(trim($this->input->post('strComentarios')));
		$strNombreReferencia = mb_strtoupper(trim($this->input->post('strNombreReferencia')));
		$strPuestoReferencia = mb_strtoupper(trim($this->input->post('strPuestoReferencia')));
		
        //Definir las reglas de validación
		//Validar que el nombre sea único
        if (($intRenglon == '') OR ($strNombreAnterior != $strNombre))
        {
        	$this->form_validation->set_rules('strNombre', 'nombre', 
        									  'required|callback_get_existencia_referencias['.$intProspectoID.']');
        }
        else
        {
        	$this->form_validation->set_rules('strNombre', 'nombre', 'required');
        }

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
			//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
			if (is_numeric($intRenglon))
			{
				$bolResultado = $this->clientes->modificar_referencias($intProspectoID, $intRenglon, $strNombre, 
																	  $strContacto, $strTelefono, $strExtension, 
																	  $strCalificacion, $strTipo, $strClienteDesde, 
																	  $strManejaCredito, $intImporteCredito, 
																	  $intPlazoCredito, $strFormaPago, 
																	  $strChequeSinFondos, $strAtrasos, $strGarantiaAdicional,
																	  $strExperienciaGeneral, $strTipoServicio, 
																	  $strComentarios, $strNombreReferencia, 
																	  $strPuestoReferencia);
			}
			else
			{ 
				$bolResultado = $this->clientes->guardar_referencias($intProspectoID, $strNombre, $strContacto, 
																	$strTelefono, $strExtension, $strCalificacion,
																    $strTipo, $strClienteDesde, $strManejaCredito,
																    $intImporteCredito, $intPlazoCredito, 
																    $strFormaPago, $strChequeSinFondos, $strAtrasos, $strGarantiaAdicional,
																    $strExperienciaGeneral, $strTipoServicio, 
																    $strComentarios, $strNombreReferencia, 
																    $strPuestoReferencia);
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
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Verifica la existencia del nombre
	//para evitar duplicación de datos al momento de modificar o guardar un registro.
    public function get_existencia_referencias($strNombre, $intProspectoID) 
    {	
		//Hacer un llamado al método para comprobar la existencia del nombre
		$otdResultado = $this->clientes->buscar_referencias($intProspectoID, NULL, $strNombre);
		//Si existen datos
		if($otdResultado)
		{
		    //Enviar mensaje de error
		    $this->form_validation->set_message('get_existencia_referencias', 'El  %s ya ha sido registrado, favor de verificar.');
		    //Regresar FALSE para no permitir registrar o actualizar datos
		    return FALSE;
		}
		else
		{
			//Regresar TRUE para permitir registrar o actualizar datos
			return TRUE;
		}
    }

     //Método para regresar los datos de un registro
	public function get_datos_referencias()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intProspectoID = $this->input->post('intProspectoID');
		$strBusqueda = $this->input->post('strBusqueda');
		$strTipo = $this->input->post('strTipo');
		//Dependiendo del tipo realizar la búsqueda de datos
		//Seleccionar los datos del registro que coincide con el parámetro enviado
		if($strTipo == 'id')
		{
			$otdResultado = $this->clientes->buscar_referencias($intProspectoID, $strBusqueda);
		}
		else 
		{
    		$otdResultado = $this->clientes->buscar_referencias($intProspectoID, NULL, $strBusqueda);
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
	public function set_estatus_referencias()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intProspectoID', 'ID', 'required|integer');
		$this->form_validation->set_rules('intRenglon', 'Renglón', 'required|integer');
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
	        $intProspectoID = $this->input->post('intProspectoID');
	        $intRenglon = $this->input->post('intRenglon');
		    $strEstatus = $this->input->post('strEstatus');
		   

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->clientes->set_estatus_referencias($intProspectoID, $intRenglon, $strEstatus);
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
	Funciones de la tabla clientes_personas_autorizadas
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion_personas_autorizadas()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Asignar id del prospecto
		$intProspectoID = $this->input->post('intProspectoID');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->clientes->filtro_personas_autorizadas($intProspectoID,
								                               $config['per_page'],
								                               $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['personas'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerIFE = 'no-mostrar';
			$arrDet->mostrarAccionVerCarta = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro =  'registro-'.$arrDet->estatus;

			//Variables que se utiliza para asignar el nombre de los archivos
		    $strNombreArchivoIFE = '';
		    $strNombreArchivoCarta = '';

		    //Definir ubicación de la carpeta
			$strNombreCarpeta = $this->archivo['strCarpetaDestinoPA'].$intProspectoID;
			//Verificar si la carpeta es un directorio 
            if (is_dir($strNombreCarpeta))
            {
            	//Hacer recorrido en la carpeta para obtener archivos
                foreach (scandir($strNombreCarpeta) as $item) 
                {
                    if ($item == '.' OR $item == '..') continue;
                    //Separar extensión del archivo
                    $arrArchivo = explode(".", $item);
                    //Si el nombre del archivo corresponde al IFE
                    if($arrArchivo[0] ==  'ife_'.$arrDet->renglon)
                    {
                        //Asignar nombre completo del archivo (ejemplo: ife_1.png)
                        $strNombreArchivoIFE = $item;
                    }

                     //Si el nombre del archivo corresponde a la carta
                    if($arrArchivo[0] ==  'carta_'.$arrDet->renglon)
                    {
                        //Asignar nombre completo del archivo (ejemplo: carta_1.gif)
                        $strNombreArchivoCarta = $item;
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

			}

			//Si el usuario cuenta con el permiso de acceso VER REGISTRO
			if (in_array('VER REGISTRO', $arrPermisos))
			{
				//Si existe archivo del IFE
				if($strNombreArchivoIFE != '')
				{
					$arrDet->mostrarAccionVerIFE = '';
				}

				//Si existe archivo de la carta
				if($strNombreArchivoCarta != '')
				{
					$arrDet->mostrarAccionVerCarta = '';
				}
			}
			
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['personas'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows']);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}
	
	//Método para guardar o modificar los datos de un registro
	public function guardar_personas_autorizadas()
	{ 
		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$intProspectoID = $this->input->post('intProspectoID');
		$intRenglon = $this->input->post('intRenglon');
		$strNombre = mb_strtoupper(trim($this->input->post('strNombre')));
		$strNombreAnterior = mb_strtoupper(trim($this->input->post('strNombreAnterior')));
        //Definir las reglas de validación
		//Validar que el nombre sea único
        if (($intRenglon == '') OR ($strNombreAnterior != $strNombre))
        {
        	$this->form_validation->set_rules('strNombre', 'nombre', 
        									  'required|callback_get_existencia_personas_autorizadas['.$intProspectoID.']');
        }
        else
        {
        	$this->form_validation->set_rules('strNombre', 'nombre', 'required');
        }

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
			//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
			if (is_numeric($intRenglon))
			{
				$bolResultado = $this->clientes->modificar_personas_autorizadas($intProspectoID, $intRenglon, 
																			   $strNombre);
			}
			else
			{ 
				//Asignar renglón consecutivo
				$intRenglon = $this->clientes->get_renglon_consecutivo_personas_autorizadas($intProspectoID);
				$bolResultado = $this->clientes->guardar_personas_autorizadas($intProspectoID, $intRenglon,
																			  $strNombre);
			}
            //Si no se obtienen errores al ejecutar el proceso
			if($bolResultado)
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos = array('resultado' => TRUE,
							 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
							 	  'renglon' => $intRenglon,
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

	//Verifica la existencia del nombre
	//para evitar duplicación de datos al momento de modificar o guardar un registro.
    public function get_existencia_personas_autorizadas($strNombre, $intProspectoID) 
    {	
		//Hacer un llamado al método para comprobar la existencia del nombre
		$otdResultado = $this->clientes->buscar_personas_autorizadas($intProspectoID, NULL, $strNombre);
		//Si existen datos
		if($otdResultado)
		{
		    //Enviar mensaje de error
		    $this->form_validation->set_message('get_existencia_personas_autorizadas', 'El  %s ya ha sido registrado, favor de verificar.');
		    //Regresar FALSE para no permitir registrar o actualizar datos
		    return FALSE;
		}
		else
		{
			//Regresar TRUE para permitir registrar o actualizar datos
			return TRUE;
		}
    }

     //Método para regresar los datos de un registro
	public function get_datos_personas_autorizadas()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intProspectoID = $this->input->post('intProspectoID');
		$strBusqueda = $this->input->post('strBusqueda');
		$strTipo = $this->input->post('strTipo');
		//Variables que se utiliza para asignar el nombre de los archivos
	    $strNombreArchivoIFE = '';
	    $strNombreArchivoCarta = '';
	   //Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestinoPA'].$intProspectoID;

		//Dependiendo del tipo realizar la búsqueda de datos
		//Seleccionar los datos del registro que coincide con el parámetro enviado
		if($strTipo == 'id')
		{
			$otdResultado = $this->clientes->buscar_personas_autorizadas($intProspectoID, $strBusqueda);
		}
		else 
		{
    		$otdResultado = $this->clientes->buscar_personas_autorizadas($intProspectoID, NULL, $strBusqueda);
		}
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Verificar si la carpeta es un directorio 
            if (is_dir($strNombreCarpeta))
            {
            	//Hacer recorrido en la carpeta para obtener archivos
                foreach (scandir($strNombreCarpeta) as $item) 
                {
                    if ($item == '.' OR $item == '..') continue;
                    //Separar extensión del archivo
                    $arrArchivo = explode(".", $item);
                    //Si el nombre del archivo corresponde al IFE
                    if($arrArchivo[0] ==  'ife_'.$otdResultado->renglon)
                    {
                        //Asignar nombre completo del archivo (ejemplo: ife_1.png)
                        $strNombreArchivoIFE = $item;
                    }

                     //Si el nombre del archivo corresponde a la carta
                    if($arrArchivo[0] ==  'carta_'.$otdResultado->renglon)
                    {
                        //Asignar nombre completo del archivo (ejemplo: carta_1.gif)
                        $strNombreArchivoCarta = $item;
                    }
                        
                }
            }

            $arrDatos['archivo_ife'] = $strNombreArchivoIFE;
            $arrDatos['archivo_carta'] = $strNombreArchivoCarta;
			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

    //Método para modificar el estatus de un registro
	public function set_estatus_personas_autorizadas()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intProspectoID', 'ID', 'required|integer');
		$this->form_validation->set_rules('intRenglon', 'Renglón', 'required|integer');
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
	        $intProspectoID = $this->input->post('intProspectoID');
	        $intRenglon = $this->input->post('intRenglon');
		    $strEstatus = $this->input->post('strEstatus');
		   

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->clientes->set_estatus_personas_autorizadas($intProspectoID, $intRenglon, $strEstatus);
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

	//Método para subir el archivo (o imagen) de un registro
	public function subir_archivo_personas_autorizadas()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$intProspectoID = $this->input->post('intProspectoID');
		$intRenglon = $this->input->post('intRenglon');
		$strBotonArchivoID = $this->input->post('strBotonArchivoID');
		$strTipoArchivo = $this->input->post('strTipoArchivo');
		//Asignar el nombre de la carpeta 
		$strNombreCarpeta = $this->archivo['strCarpetaDestinoPA'].$intProspectoID; 
		//Nombre del archivo o imagen
		$strNombreArchivo = $strTipoArchivo.'_'.$intRenglon;

		//Hacer un llamado a la función para subir el archivo
		$this->subir_archivo_reg($strBotonArchivoID, $this->archivo['strCarpetaPrincipal'], 
								 $this->archivo['strCarpetaDestinoPA'], 
							     $strNombreCarpeta, $strNombreArchivo);
    }

    //Método para descargar el archivo (o imagen) de un registro
    public function descargar_archivo_personas_autorizadas()
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$intProspectoID = $this->input->post('intProspectoID');
		$intRenglon = $this->input->post('intRenglon');
		$strTipoArchivo = $this->input->post('strTipoArchivo');

		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestinoPA'].$intProspectoID;
		//Nombre del archivo o imagen
	    $strNombreArchivo = $strTipoArchivo.'_'.$intRenglon;

		//Hacer un llamado a la función para descargar el archivo
		$this->descargar_archivo_reg($strNombreCarpeta, $strNombreArchivo);
	}

    //Método para compobar que la extensión de un archivo (o imagen) sea válida
	public function comprobar_extension_archivo()
	{	
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('tipo_mensaje' => '',
						  'mensaje' => '');

		//Variable que se utiliza para recuperar la extensión del archivo
		$strExtension = strtolower($this->input->post('strExtension'));
		//Si la extensión del archivo se encuentra en el array de extensiones
        if(!in_array($strExtension, $this->ARR_EXTENSIONES))
        {
        	//Enviar el mensaje de error al formulario
        	$arrDatos = array('tipo_mensaje' => TIPO_MSJ_ERROR,
				              'mensaje' => $this->STR_MENSAJE_EXTENSIONES);
        }

        //Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*******************************************************************************************************************
	Funciones de la tabla clientes_cuentas_bancarias
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion_cuentas_bancarias()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->clientes->filtro_cuentas_bancarias($this->input->post('intProspectoID'),
						                              	    $config['per_page'],
						                                    $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['cuentas'] as $arrDet)
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
		$arrDatos = array('rows' => $result['cuentas'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows']);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}
	
	//Método para guardar o modificar los datos de un registro
	public function guardar_cuentas_bancarias()
	{ 
		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$intProspectoID = $this->input->post('intProspectoID');
		$intRenglon = $this->input->post('intRenglon');
		$intBancoID = $this->input->post('intBancoID');
		$strCuenta = trim($this->input->post('strCuenta'));
		$strCuentaAnterior = trim($this->input->post('strCuentaAnterior'));
        //Definir las reglas de validación
		//Validar que la cuenta bancaria sea única
        if (($intRenglon == '') OR ($strCuentaAnterior != $strCuenta))
        {
        	$this->form_validation->set_rules('strCuenta', 'cuenta bancaria', 
        									  'required|callback_get_existencia_cuentas_bancarias['.$intProspectoID.']');
        }
        else
        {
        	$this->form_validation->set_rules('strCuenta', 'cuenta bancaria', 'required');
        }

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
			//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
			if (is_numeric($intRenglon))
			{
				$bolResultado = $this->clientes->modificar_cuentas_bancarias($intProspectoID, $intRenglon, $intBancoID, 
																			 $strCuenta);
			}
			else
			{ 
				$bolResultado = $this->clientes->guardar_cuentas_bancarias($intProspectoID, $intBancoID, $strCuenta);
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
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Verifica la existencia de la cuenta bancaria
	//para evitar duplicación de datos al momento de modificar o guardar un registro.
    public function get_existencia_cuentas_bancarias($strCuenta, $intProspectoID) 
    {	
		//Hacer un llamado al método para comprobar la existencia del nombre
		$otdResultado = $this->clientes->buscar_referencias($intProspectoID, NULL, $strCuenta);
		//Si existen datos
		if($otdResultado)
		{
		    //Enviar mensaje de error
		    $this->form_validation->set_message('get_existencia_referencias', 'La  %s ya ha sido registrada, favor de verificar.');
		    //Regresar FALSE para no permitir registrar o actualizar datos
		    return FALSE;
		}
		else
		{
			//Regresar TRUE para permitir registrar o actualizar datos
			return TRUE;
		}
    }

     //Método para regresar los datos de un registro
	public function get_datos_cuentas_bancarias()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intProspectoID = $this->input->post('intProspectoID');
		$strBusqueda = $this->input->post('strBusqueda');
		$strTipo = $this->input->post('strTipo');
		//Dependiendo del tipo realizar la búsqueda de datos
		//Seleccionar los datos del registro que coincide con el parámetro enviado
		if($strTipo == 'id')
		{
			$otdResultado = $this->clientes->buscar_cuentas_bancarias($intProspectoID, $strBusqueda);
		}
		else 
		{
    		$otdResultado = $this->clientes->buscar_cuentas_bancarias($intProspectoID, NULL, $strBusqueda);
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
	public function set_estatus_cuentas_bancarias()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intProspectoID', 'ID', 'required|integer');
		$this->form_validation->set_rules('intRenglon', 'Renglón', 'required|integer');
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
	        $intProspectoID = $this->input->post('intProspectoID');
	        $intRenglon = $this->input->post('intRenglon');
		    $strEstatus = $this->input->post('strEstatus');
		   

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->clientes->set_estatus_cuentas_bancarias($intProspectoID, $intRenglon, $strEstatus);
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
	public function autocomplete_cuentas_bancarias()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$intProspectoID = $this->input->post('intProspectoID');
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
			$otdResultado = $this->clientes->autocomplete_cuentas_bancarias($intProspectoID, $strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
					
		        	$arrDatos[] = array('value' => $arrCol->cuenta, 
		        						'data' => $arrCol->cuenta,
		        					    'razon_social_banco'=> $arrCol->razon_social_banco, 
		        					    'rfc_banco' => $arrCol->rfc_banco, 
		        						'banco_id' => $arrCol->banco_id,
		        						'banco' => $arrCol->banco);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}
	
}