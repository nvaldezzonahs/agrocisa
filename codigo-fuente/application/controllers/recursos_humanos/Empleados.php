<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados extends MY_Controller {

	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();

		//Asignar ruta de la carpeta principal
	    $this->archivo['strCarpetaPrincipal'] = './archivos/';
	    //Asignar ruta de la carpeta destino
	    $this->archivo['strCarpetaDestino'] = './archivos/empleados_expediente/';
	    //Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de empleados
		$this->load->model('recursos_humanos/empleados_model', 'empleados');
		//Cargamos el modelo de documentos
		$this->load->model('recursos_humanos/documentos_empleados_model', 'documentos');
		//Cargamos el modelo de incidencias
		$this->load->model('recursos_humanos/empleados_incidencias_model', 'incidencias');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('recursos_humanos/empleados', $arrDatos);
	}

	

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->empleados->filtro(trim($this->input->post('strBusqueda')),
			                               $config['per_page'],
			                               $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['empleados'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
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

			//Si el usuario cuenta con el permiso de acceso IMPRIMIR REGISTRO
			if (in_array('IMPRIMIR REGISTRO', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón Imprimir
        		$arrDet->mostrarAccionImprimir = '';
			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['empleados'],
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
		$objEmpleado = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Datos del empleado
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objEmpleado->intEmpleadoID = $this->input->post('intEmpleadoID');
		$objEmpleado->strCodigo = $this->input->post('strCodigo');
		$objEmpleado->strCodigoAnterior = $this->input->post('strCodigoAnterior');
		$objEmpleado->strNombre = mb_strtoupper(trim($this->input->post('strNombre')));
		$objEmpleado->strApellidoPaterno = mb_strtoupper(trim($this->input->post('strApellidoPaterno')));
		$objEmpleado->strApellidoMaterno = mb_strtoupper(trim($this->input->post('strApellidoMaterno')));
		$objEmpleado->strRfc = mb_strtoupper(trim($this->input->post('strRfc')));
		$objEmpleado->strRfcAnterior = mb_strtoupper(trim($this->input->post('strRfcAnterior')));
		$objEmpleado->strCurp = mb_strtoupper(trim($this->input->post('strCurp')));
		$objEmpleado->strCurpAnterior = mb_strtoupper(trim($this->input->post('strCurpAnterior')));
		$objEmpleado->strEstadoCivil = mb_strtoupper(trim($this->input->post('strEstadoCivil')));
		$objEmpleado->strSexo = $this->input->post('strSexo');
		//Si la fecha esta vacia asignar valor nulo
		$objEmpleado->dteFechaNacimiento = (($this->input->post('dteFechaNacimiento') !== '') ? 
								$this->input->post('dteFechaNacimiento') : NULL);

		//Si no existe id del municipio de nacimiento asignar valor nulo
		$objEmpleado->intMunicipioNacimientoID = (($this->input->post('intMunicipioNacimientoID') !== '') ? 
							          			   $this->input->post('intMunicipioNacimientoID') : NULL);
		$objEmpleado->strCalle = mb_strtoupper(trim($this->input->post('strCalle')));
		$objEmpleado->strNumeroExterior = mb_strtoupper(trim($this->input->post('strNumeroExterior')));
		$objEmpleado->strNumeroInterior = mb_strtoupper(trim($this->input->post('strNumeroInterior')));
		//Si no existe id del código postal asignar valor nulo
		$objEmpleado->intCodigoPostalID = (($this->input->post('intCodigoPostalID') !== '') ? 
							   $this->input->post('intCodigoPostalID') : NULL);
		$objEmpleado->strColonia = mb_strtoupper(trim($this->input->post('strColonia')));
		$objEmpleado->strLocalidad = mb_strtoupper(trim($this->input->post('strLocalidad')));
		//Si no existe id del municipio asignar valor nulo
		$objEmpleado->intMunicipioID = (($this->input->post('intMunicipioID') !== '') ? 
						    			 $this->input->post('intMunicipioID') : NULL);
		$objEmpleado->strTelefonoParticular = $this->input->post('strTelefonoParticular');
		$objEmpleado->strCorreoElectronico = mb_strtolower(trim($this->input->post('strCorreoElectronico')));
		$objEmpleado->strEmergenciaNombre = mb_strtoupper(trim($this->input->post('strEmergenciaNombre')));
		$objEmpleado->strEmergenciaTelefono = $this->input->post('strEmergenciaTelefono');
		$objEmpleado->strEmergenciaParentesco = mb_strtoupper(trim($this->input->post('strEmergenciaParentesco')));
		//Si la fecha esta vacia asignar valor nulo
		$objEmpleado->dteFechaIngreso = (($this->input->post('dteFechaIngreso') !== '') ? 
										  $this->input->post('dteFechaIngreso') : NULL);

		$objEmpleado->intSucursalID = (($this->input->post('intSucursalID') !== '') ? 
										  $this->input->post('intSucursalID') : NULL);
		$objEmpleado->intDepartamentoID = $this->input->post('intDepartamentoID');
		$objEmpleado->intPuestoID = $this->input->post('intPuestoID');
		$objEmpleado->strLicenciaManejo = mb_strtoupper(trim($this->input->post('strLicenciaManejo')));
		$objEmpleado->strLicenciaTipo = $this->input->post('strLicenciaTipo');
		//Si la fecha esta vacia asignar valor nulo
		$objEmpleado->dteLicenciaExpedicion = (($this->input->post('dteLicenciaExpedicion') !== '') ? 
								   $this->input->post('dteLicenciaExpedicion') : NULL);
		//Si la fecha esta vacia asignar valor nulo
		$objEmpleado->dteLicenciaVigencia = (($this->input->post('dteLicenciaVigencia') !== '') ? 
							   $this->input->post('dteLicenciaVigencia') : NULL);
		$objEmpleado->strCuentaBancaria = trim($this->input->post('strCuentaBancaria'));
		$objEmpleado->strClabe = trim($this->input->post('strClabe'));
		$objEmpleado->strNss = trim($this->input->post('strNss'));
		$objEmpleado->strClinica = mb_strtoupper(trim($this->input->post('strClinica')));
		$objEmpleado->strInfonavit = trim($this->input->post('strInfonavit'));
		$objEmpleado->strTipoRetencion = $this->input->post('strTipoRetencion');
		$objEmpleado->intImporte = trim($this->input->post('intImporte'));
		//Si la fecha esta vacia asignar valor nulo
		$objEmpleado->dteFechaInfonavit = (($this->input->post('dteFechaInfonavit') !== '') ? 
							 			    $this->input->post('dteFechaInfonavit') : NULL);
		$objEmpleado->strTipoSangre = mb_strtoupper(trim($this->input->post('strTipoSangre')));
		$objEmpleado->strTallaCamisa = mb_strtoupper(trim($this->input->post('strTallaCamisa')));
		$objEmpleado->strTallaPantalon = mb_strtoupper(trim($this->input->post('strTallaPantalon')));
		$objEmpleado->strTallaZapatos = mb_strtoupper(trim($this->input->post('strTallaZapatos')));
		$objEmpleado->strNumeroAfore = trim($this->input->post('strNumeroAfore'));
		$objEmpleado->strAfore = mb_strtoupper(trim($this->input->post('strAfore')));
		$objEmpleado->strGradoEstudios = mb_strtoupper(trim($this->input->post('strGradoEstudios')));
		$objEmpleado->strLicenciaturaTitulo = mb_strtoupper(trim($this->input->post('strLicenciaturaTitulo')));
		$objEmpleado->strLicenciaturaInstitucion = mb_strtoupper(trim($this->input->post('strLicenciaturaInstitucion')));
		//Si la fecha esta vacia asignar valor nulo
		$objEmpleado->dteLicenciaturaFecha = (($this->input->post('dteLicenciaturaFecha') !== '') ? 
							      			   $this->input->post('dteLicenciaturaFecha') : NULL);
		$objEmpleado->strMaestriaTitulo = mb_strtoupper(trim($this->input->post('strMaestriaTitulo')));
		$objEmpleado->strMaestriaInstitucion = mb_strtoupper(trim($this->input->post('strMaestriaInstitucion')));
		//Si la fecha esta vacia asignar valor nulo
		$objEmpleado->dteMaestriaFecha = (($this->input->post('dteMaestriaFecha') !== '') ? 
							  			   $this->input->post('dteMaestriaFecha') : NULL);
		$objEmpleado->intInglesComprension = trim($this->input->post('intInglesComprension'));
		$objEmpleado->intInglesLectura = trim($this->input->post('intInglesLectura'));
		$objEmpleado->intInglesEscritura = trim($this->input->post('intInglesEscritura'));
		$objEmpleado->intFrancesComprension = trim($this->input->post('intFrancesComprension'));
		$objEmpleado->intFrancesLectura = trim($this->input->post('intFrancesLectura'));
		$objEmpleado->intFrancesEscritura = trim($this->input->post('intFrancesEscritura'));
		$objEmpleado->strOtroIdioma = mb_strtoupper(trim($this->input->post('strOtroIdioma')));
		$objEmpleado->intOtroComprension = trim($this->input->post('intOtroComprension'));
		$objEmpleado->intOtroLectura = trim($this->input->post('intOtroLectura'));
		$objEmpleado->intOtroEscritura = trim($this->input->post('intOtroEscritura'));
		$objEmpleado->intExcel = trim($this->input->post('intExcel'));
		$objEmpleado->intWord = trim($this->input->post('intWord'));
		$objEmpleado->intPowerPoint = trim($this->input->post('intPowerPoint'));
		$objEmpleado->intAccess = trim($this->input->post('intAccess'));
		$objEmpleado->strOtrasHabilidades = mb_strtoupper(trim($this->input->post('strOtrasHabilidades')));
		$objEmpleado->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los dependientes
		$objEmpleado->strNombres = $this->input->post('strNombres');
		$objEmpleado->strSexos = $this->input->post('strSexos');
		$objEmpleado->strParentescos = $this->input->post('strParentescos');
		$objEmpleado->strFechasNacimiento = $this->input->post('strFechasNacimiento');

		
		//Definir las reglas de validación
		//Validar que el código sea único
		if (($objEmpleado->intEmpleadoID == '') OR 
			($objEmpleado->strCodigoAnterior != $objEmpleado->strCodigo))
        {
            $this->form_validation->set_rules('strCodigo', 'código',
             								  'required|is_unique[empleados.codigo]');
        }

		//Validar que el rfc sea único
		if (($objEmpleado->intEmpleadoID == '') OR 
			($objEmpleado->strRfcAnterior != $objEmpleado->strRfc))
		{
            $this->form_validation->set_rules('strRfc', 'rfc',
            								  'required|is_unique[empleados.rfc]');
        }


        //Validar que el curp sea único
        if (($objEmpleado->intEmpleadoID == '' && $objEmpleado->strCurp != '') OR 
        	($objEmpleado->strCurpAnterior != $objEmpleado->strCurp  && $objEmpleado->strCurp != ''))
        {
            $this->form_validation->set_rules('strCurp', 'curp',
            								  'required|is_unique[empleados.curp]');
        }
        $this->form_validation->set_rules('strNombre', 'nombre', 'required');
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
			if (is_numeric($objEmpleado->intEmpleadoID))
			{
				$bolResultado = $this->empleados->modificar($objEmpleado);
														    
			}
			else
			{ 
				$bolResultado = $this->empleados->guardar($objEmpleado);

				/*Quitar '_'  de la cadena (resultadoTransaccion_empleadoID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $objEmpleado->intEmpleadoID) = explode("_", $bolResultado); 
			    //Definir ubicación de la carpeta temporal
				$strNombreCarpeta = $this->archivo['strCarpetaDestino'].'temporal';
				//Verificar si la carpeta es un directorio 
	            if (is_dir($strNombreCarpeta))
	            {
	            	//Cambiar el nombre de la carpeta
	            	rename($strNombreCarpeta, $this->archivo['strCarpetaDestino'].$objEmpleado->intEmpleadoID);
	            }
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
			$otdResultado = $this->empleados->buscar($strBusqueda);
		}
		else if($strTipo == 'codigo')
		{
    		$otdResultado = $this->empleados->buscar(NULL, $strBusqueda);
		}
		else if($strTipo == 'rfc')
		{
    		$otdResultado = $this->empleados->buscar(NULL, NULL, $strBusqueda);
		}
		else 
		{
    		$otdResultado = $this->empleados->buscar(NULL, NULL, NULL, $strBusqueda);
		}
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
			//Seleccionar los datos de los dependientes (familiares)
			$otdDependientes = $this->empleados->buscar_dependientes($otdResultado->empleado_id);
			//Si existen dependientes del registro, se asignan al array
			if($otdDependientes)
			{
				$arrDatos['dependientes'] = $otdDependientes;
			}
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intEmpleadoID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intEmpleadoID');
		    $strEstatus = $this->input->post('strEstatus');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->empleados->set_estatus($intID, $strEstatus);
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
	public function subir_archivo()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$intDocumentoID = $this->input->post('intDocumentoID');
		//Si el id del empleado esta vacio el nombre de la carpeta será temporal 
		$intEmpleadoID = (($this->input->post('intEmpleadoID') !== '') ? 
						   $this->input->post('intEmpleadoID') : 'temporal');
		$strBotonArchivoID = $this->input->post('strBotonArchivoID');
		//Asignar el nombre de la carpeta 
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intEmpleadoID; 

		//Hacer un llamado a la función para subir el archivo
		$this->subir_archivo_reg($strBotonArchivoID, $this->archivo['strCarpetaPrincipal'], 
								 $this->archivo['strCarpetaDestino'], 
							     $strNombreCarpeta, $intDocumentoID);
    }

    //Método para descargar el archivo (o imagen) de un registro
    public function descargar_archivo()
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$intEmpleadoID = $this->input->post('intEmpleadoID');
		$intDocumentoID = $this->input->post('intDocumentoID');
		
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intEmpleadoID;

		//Hacer un llamado a la función para descargar el archivo
		$this->descargar_archivo_reg($strNombreCarpeta, $intDocumentoID);
	}
	
	//Método para eliminar el archivo (o imagen) de un registro
	public function eliminar_archivo()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$intEmpleadoID = $this->input->post('intEmpleadoID');
		$intDocumentoID = $this->input->post('intDocumentoID');
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intEmpleadoID;

		//Hacer un llamado a la función para eliminar el archivo
		$this->eliminar_archivo_reg($strNombreCarpeta, $intDocumentoID);
	}

	//Método para eliminar carpeta temporal
	public function eliminar_carpeta_temporal()
	{
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].'temporal';

		//Hacer un llamado a la función para eliminar la carpeta temporal
		$this->eliminar_carpeta_reg($strNombreCarpeta, TRUE);
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
			$otdResultado = $this->empleados->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->empleado, 
		        						'data' => $arrCol->empleado_id);
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
		$otdResultado = $this->empleados->buscar(NULL, NULL, NULL, NULL, $strBusqueda); 
		
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1= 'LISTADO DE EMPLEADOS';
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('CÓDIGO'), 'NOMBRE', 'CORP.', 'SUCURSAL', 
								  'DEPARTAMENTO', 'PUESTO', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(15, 40, 15, 25, 40, 40, 15);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'L', 'L', 'L', 'C');
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
				//Concatenar datos para el nombre completo
	         	$strNombre = $arrCol->apellido_paterno.' '.$arrCol->apellido_materno.' '.$arrCol->nombre;
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->codigo, utf8_decode($strNombre), $arrCol->corporativo,
								utf8_decode($arrCol->sucursal), utf8_decode($arrCol->departamento), 
								utf8_decode($arrCol->puesto),
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
		$pdf->Output('empleados.pdf','I'); 
	}

    //Método para generar un reporte PDF con los datos del registro dependiendo del formato seleccionado
    public function get_reporte_formato() 
    {
    	
    	//Variables que se utilizan para recuperar los valores de la vista
    	$strFormato = trim($this->input->post('strFormato'));
    	$strMembrete = $this->input->post('strMembrete');
    	$intEmpleadoID = $this->input->post('intEmpleadoID');
		$intSueldo = $this->input->post('intSueldo');
		$strTiempo = $this->input->post('strTiempo');
		$dteFechaVencimiento = $this->input->post('dteFechaVencimiento');
		$strJuntaConciliacion = $this->input->post('strJuntaConciliacion');
		$strActividades = $this->input->post('strActividades');

		//Se crea una instancia de la clase PDF
        $pdf = new PDF();//orientación vertical
        $pdf->strIncluirMembrete = $strMembrete;
        //Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
        //Si el tipo de formato es hoja de datos
        if($strFormato == 'HOJA DE DATOS')
        {
        	//Hacer un llamado a la función para generar reporte de hoja de datos
        	$this->get_reporte_hoja_datos($pdf, $intEmpleadoID);
        }
        else if($strFormato == 'CARTA DE RECOMENDACION')//Si el tipo de formato es carta de recomendación
        {
        	//Hacer un llamado a la función para generar reporte de carta de recomendación
        	$this->get_reporte_carta_recomendacion($pdf, $intEmpleadoID);
        }
        else if($strFormato == 'CONSTANCIA LABORAL')//Si el tipo de formato es constancia laboral
        {
        	//Hacer un llamado a la función para generar reporte de constancia laboral
        	$this->get_reporte_constancia_laboral($pdf, $intEmpleadoID);
     
        }
        else //Si el tipo de formato es contrato
        {	
			
			//Dependiendo del tiempo, generar reporte del contrato
			if($strTiempo == 'INDETERMINADO')
			{
				//Hacer un llamado a la función para generar reporte de contrato indeterminado
        		$this->get_reporte_contrato_indeterminado($pdf, $intEmpleadoID, $intSueldo, 
        										 		  $strJuntaConciliacion);
			}
			else
			{

				 //Hacer un llamado a la función para generar reporte de contrato determinado
        		$this->get_reporte_contrato_determinado($pdf, $intEmpleadoID, $intSueldo, $strTiempo, 
        								    	  	    $dteFechaVencimiento, $strJuntaConciliacion, 
        								    	        $strActividades);

				
			}
			
        }
    }

    //Método para generar un reporte PDF en formato hoja de datos con la información de un registro 
    public function get_reporte_hoja_datos( $pdf, $intEmpleadoID)
    {
		//Seleccionar los datos del empleado que coincide con el id
		$otdEmpleado = $this->empleados->buscar($intEmpleadoID); 
		//Seleccionar los datos de los dependientes (familiares)
	    $otdDependientes = $this->empleados->buscar_dependientes($intEmpleadoID); 
	    //Seleccionar los documentos activos
		$otdDocumentos = $this->documentos->buscar(NULL, NULL, NULL, 'ACTIVO');
		//Variable que se utiliza para concatenar los documentos que se encuentran en el expediente del empleado
		$strExpediente = '';
		//Seleccionar los datos de las incidencias
		$otdIncidencias = $this->incidencias->buscar(NULL, NULL, '0000-00-00', '0000-00-00', $intEmpleadoID); 
		//Variable que se utiliza para asignar el nombre completo del empleado
		$strNombre  = '';
		//Agregar la primer pagina
		$pdf->AddPage();
		//Verificar si hay información del registro
		if($otdEmpleado)
		{
			//Concatenar nombre y apellidos del empleado
			$strNombre = $otdEmpleado->nombre.' '.$otdEmpleado->apellido_paterno.' '.$otdEmpleado->apellido_materno;
			//Cambiar color de relleno de la celda
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->Ln(20);//Espacios de salto de línea
			//Asigna el tipo y tamaño de letra para el encabezado del documento
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Título del reporte
			$pdf->Cell(190, 5, utf8_decode('HOJA DE DATOS'), 0, 0, 'C', 0);
			$pdf->Ln(10);//Espacios de salto de línea
			//Datos personales
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, 'DATOS PERSONALES', 1, 1, 'C', 1);
			$pdf->SetTextColor(0); //establece el color de texto negro
			//Código
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, utf8_decode('CÓDIGO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(27, 5, $otdEmpleado->codigo, 0, 0, 'L', 0);
			//Nombre
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(15, 5, 'NOMBRE', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(121, 5, utf8_decode($strNombre), 0, 1, 'L', 0);
			//RFC
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'RFC', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(27, 5, utf8_decode($otdEmpleado->rfc), 0, 0, 'L', 0);
			//CURP
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(15, 5, 'CURP', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(33, 5, utf8_decode($otdEmpleado->curp), 0, 0, 'L', 0);
			//Estado civil
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(25, 5, 'ESTADO CIVIL', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(30, 5, utf8_decode($otdEmpleado->estado_civil), 0, 0, 'L', 0);
			//Sexo
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(12, 5, 'SEXO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(21, 5, utf8_decode($otdEmpleado->sexo), 0, 1, 'L', 0);
			//Fecha de nacimiento
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'FECHA DE NAC.', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(27, 5, $otdEmpleado->fecha_nacimiento, 0, 0, 'L', 0);
			//Lugar de nacimiento
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(38, 5, 'LUGAR DE NACIMIENTO', 0, 0, 'L', 0);
			//Variable que se utiliza para asignar municipio del lugar de nacimiento
			$strMunicipioNacimientoEmp = (($otdEmpleado->municipio_nacimiento !== NULL && 
								      empty($otdEmpleado->municipio_nacimiento) === FALSE) ?
			            		      $otdEmpleado->municipio_nacimiento.', '.$otdEmpleado->estado_nacimiento_rep.', '.$otdEmpleado->pais_nacimiento_rep : '');
			
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
			$strMunicipioNacimientoEmp = mb_strtoupper($strMunicipioNacimientoEmp);

			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(88, 5, utf8_decode($strMunicipioNacimientoEmp), 0, 1, 'L', 0);
			//Domicilio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(190, 5, 'DOMICILIO', 0, 1, 'L', 0);
			//Variables que se utilizan para asignar datos del domicilio
			$strCalle = (($otdEmpleado->calle !== NULL && 
						empty($otdEmpleado->calle) === FALSE) ?
			            'C. '.$otdEmpleado->calle : '');

			$strNumeroExterior = (($otdEmpleado->numero_exterior !== NULL && 
								  empty($otdEmpleado->numero_exterior) === FALSE) ?
			            		'NO. '.$otdEmpleado->numero_exterior : '');

			$strNumeroInterior = (($otdEmpleado->numero_interior !== NULL && 
								  empty($otdEmpleado->numero_interior) === FALSE) ?
			            		'INT. '.$otdEmpleado->numero_interior : '');

			$strCodigoPostal = (($otdEmpleado->codigo_postal !== NULL && 
								  empty($otdEmpleado->codigo_postal) === FALSE) ?
			            		'CP: '.$otdEmpleado->codigo_postal : '');

			$strColonia = (($otdEmpleado->colonia !== NULL && 
								  empty($otdEmpleado->colonia) === FALSE) ?
			            		' '.$otdEmpleado->colonia : '');

			$strLocalidad = (($otdEmpleado->localidad !== NULL && 
								  empty($otdEmpleado->localidad) === FALSE) ?
			            		'LOC. '.$otdEmpleado->localidad.', ' : '');

			$strMunicipio = (($otdEmpleado->municipio !== NULL && 
								  empty($otdEmpleado->municipio) === FALSE) ?
			            		  $otdEmpleado->municipio.', '.$otdEmpleado->estado_rep.', '.$otdEmpleado->pais_rep : '');
			//Concatenar los datos del domicilio
			$strDomicilio = $strCalle.' '.$strNumeroExterior.' '.$strNumeroInterior.' '.
						   $strColonia.' '.$strLocalidad.' '.$strMunicipio.' '.$strCodigoPostal;

			$strDomicilio = mb_strtoupper($strDomicilio);

			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->MultiCell(190, 4, utf8_decode($strDomicilio), 0, 'J', 0);
			//Teléfono particular
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, utf8_decode('TELÉFONO PART.'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(27, 5, utf8_decode($otdEmpleado->telefono_particular), 0, 0, 'L', 0);
			//Correo electrónico
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(38, 5, utf8_decode('CORREO ELECTRÓNICO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(88, 5, utf8_decode($otdEmpleado->correo_electronico), 0, 1, 'L', 0);
			//En caso de emergencia
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(190, 5, 'EN CASO DE EMERGENCIA LLAMAR', 0, 1, 'L', 0);
			//Nombre de la persona que atendera la emergencia
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'NOMBRE', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(163, 5, utf8_decode($otdEmpleado->emergencia_nombre), 0, 1, 'L', 0);
			//Teléfono de la persona que atendera la emergencia
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, utf8_decode('TÉLEFONO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(27, 5, utf8_decode($otdEmpleado->emergencia_telefono), 0, 0, 'L', 0);
			//Parentesco de la persona que atendera la emergencia
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(25, 5, 'PARENTESCO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(63, 5, utf8_decode($otdEmpleado->emergencia_parentesco), 0, 1, 'L', 0);
			//Datos laborales
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, 'DATOS LABORALES', 1, 1, 'C', 1);
			$pdf->SetTextColor(0); //establece el color de texto negro
			//Fecha de ingreso
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'FECHA DE ING.', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(27, 5, $otdEmpleado->fecha_ingreso, 0, 0, 'L', 0);

			//Si existe id de la sucursal, significa que el empleado pertenece a una sucursal
			if($otdEmpleado->sucursal_id > 0)
			{
				//Asignar descripción de la etiqueta 
				$strTituloReferencia = 'SUCURSAL';
				//Asignar nombre de la sucursal
				$strReferencia = $otdEmpleado->sucursal;
			}
			else
			{
				//Asignar descripción de la etiqueta 
				$strTituloReferencia = 'CORPORATIVO';
				//Asignar SI - para indicar que el empleado no pertenece a una sucursal
				$strReferencia = 'SI';
			}
			
			//Sucursal/Corporativo
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(25, 5, $strTituloReferencia, 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(48, 5, utf8_decode($strReferencia), 0, 0, 'L', 0);
			//Departamento
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(13, 5, 'DEPTO.', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(50, 5, utf8_decode($otdEmpleado->departamento), 0, 1, 'L', 0);
			//Puesto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'PUESTO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(79, 5, utf8_decode($otdEmpleado->puesto), 0, 0, 'L', 0);
			//Licencia de manejo
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(34, 5, 'LICENCIA DE MANEJO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(21, 5, utf8_decode($otdEmpleado->licencia_manejo), 0, 0, 'L', 0);
			//Tipo de licencia
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(12, 5, 'TIPO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(50, 5, utf8_decode($otdEmpleado->licencia_tipo), 0, 1, 'L', 0);
			//Fecha de expedición
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'FECHA DE EXP.', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(27, 5, $otdEmpleado->licencia_expedicion, 0, 0, 'L', 0);
		    //Fecha de vigencia
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(32, 5, 'FECHA DE VIGENCIA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, $otdEmpleado->licencia_expedicion, 0, 0, 'L', 0);
			//Cuenta bancaria
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(21, 5, 'CUENTA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(63, 5, utf8_decode($otdEmpleado->cuenta_bancaria), 0, 1, 'L', 0);
			//Clabe
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'CLABE', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(27, 5, utf8_decode($otdEmpleado->clabe), 0, 0, 'L', 0);
			//Número de seguridad social
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(32, 5, utf8_decode('NO. SEGURIDAD SOC.'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, $otdEmpleado->nss, 0, 0, 'L', 0);
			//Clínica
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(21, 5, utf8_decode('CLÍNICA'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(63, 5, utf8_decode($otdEmpleado->clinica), 0, 1, 'L', 0);
			//Número de Infonavit
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'NO. DE INFONAVIT', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(59, 5, $otdEmpleado->infonavit, 0, 0, 'L', 0);
			//Tipo de retención
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(20, 5, utf8_decode('RETENCIÓN'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(21, 5, utf8_decode($otdEmpleado->tipo_retencion), 0, 0, 'L', 0);
			//Importe
			//Si el tipo de retención es porcentaje
			if($otdEmpleado->tipo_retencion == 'PORCENTAJE')
			{
				$otdEmpleado->importe .='%';
			}
			else
			{
				$otdEmpleado->importe = '$'.number_format($otdEmpleado->importe,2);
			}

			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(13, 5, 'IMPT.', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(14, 5, $otdEmpleado->importe, 0, 0, 'L', 0);
			//Fecha de infonavit
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(18, 5, 'FECHA INIC.', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(16, 5, $otdEmpleado->fecha_infonavit, 0, 1, 'L', 0);
			//Tipo de sangre
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'TIPO DE SANGRE', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(27, 5, utf8_decode($otdEmpleado->tipo_sangre), 0, 0, 'L', 0);
			//Talla de camisa
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(32, 5, 'TALLA DE CAMISA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, utf8_decode($otdEmpleado->talla_camisa), 0, 0, 'L', 0);
			//Talla de pantalón
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(34, 5, utf8_decode('TALLA DE PANTALÓN'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(14, 5, utf8_decode($otdEmpleado->talla_pantalon), 0, 0, 'L', 0);
			//Talla de zapatos
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(30, 5, 'TALLA DE ZAPATOS', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(16, 5, utf8_decode($otdEmpleado->talla_zapatos), 0, 1, 'L', 0);
			//Número de Afore
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'NO. DE AFORE', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(59, 5, $otdEmpleado->numero_afore, 0, 0, 'L', 0);
			//Afore
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(41, 5, utf8_decode('INSTITUCIÓN DE AFORE'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(63, 5, utf8_decode($otdEmpleado->afore), 0, 1, 'L', 0);
			//Datos académicos
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, utf8_decode('DATOS ACADÉMICOS'), 1, 1, 'C', 1);
			$pdf->SetTextColor(0); //establece el color de texto negro
			//Grado de estudios
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'GRADO DE EST.', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(45, 5, utf8_decode($otdEmpleado->grado_estudios), 0, 0, 'L', 0);
			//Nivel de licenciatura
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'LICENCIATURA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			//Variable que se utilizan para asignar nombre de la  institución 
			$strLicenciaturaInstitucion = (($otdEmpleado->licenciatura_institucion !== NULL && 
								 		 empty($otdEmpleado->licenciatura_institucion) === FALSE) ?
			            		       'INST. '.$otdEmpleado->licenciatura_institucion : '');

			//Concatenar datos del nivel de licenciatura
			$strNivelLicenciatura = $otdEmpleado->licenciatura_titulo.' '.$strLicenciaturaInstitucion.' '.$otdEmpleado->licenciatura_fecha ;
			$pdf->ClippedCell(91, 5, utf8_decode($strNivelLicenciatura), 0, 1, 'L', 0);
			//Nivel de maestría
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, utf8_decode('MAESTRÍA'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			//Variable que se utilizan para asignar nombre de la  institución 
			$strMaestriaInstitucion = (($otdEmpleado->maestria_institucion !== NULL && 
								 		 empty($otdEmpleado->maestria_institucion) === FALSE) ?
			            		       'INST. '.$otdEmpleado->maestria_institucion : '');

			//Concatenar datos del nivel de maestría
			$strNivelMaestria = $otdEmpleado->maestria_titulo.' '.$strMaestriaInstitucion.' '.$otdEmpleado->maestria_fecha;
			$pdf->ClippedCell(163, 5, utf8_decode($strNivelMaestria), 0, 1, 'L', 0);
			//Nivel del idioma Inglés
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, utf8_decode('INGLÉS'), 0, 0, 'L', 0);
			//Comprensión
			$pdf->Cell(27, 5, utf8_decode('COMPRENSIÓN'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(18, 5, utf8_decode((($otdEmpleado->ingles_comprension !== NULL &&
											   empty($otdEmpleado->ingles_comprension) === FALSE) ?
			                			       $otdEmpleado->ingles_comprension.'%' : '')), 0, 0, 'L', 0);
			//Lectura
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'LECTURA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, utf8_decode((($otdEmpleado->ingles_lectura !== NULL &&
											   empty($otdEmpleado->ingles_lectura) === FALSE) ?
			                			       $otdEmpleado->ingles_lectura.'%' : '')), 0, 0, 'L', 0);
			//Escritura
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(22, 5, 'ESCRITURA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(30, 5, utf8_decode((($otdEmpleado->ingles_escritura !== NULL &&
											   empty($otdEmpleado->ingles_escritura) === FALSE) ?
			                			       $otdEmpleado->ingles_escritura.'%' : '')), 0, 1, 'L', 0);
			//Nivel del idioma Francés
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, utf8_decode('FRANCÉS'), 0, 0, 'L', 0);
			//Comprensión
			$pdf->Cell(27, 5, utf8_decode('COMPRENSIÓN'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(18, 5, utf8_decode((($otdEmpleado->frances_comprension !== NULL &&
											   empty($otdEmpleado->frances_comprension) === FALSE) ?
			                			       $otdEmpleado->frances_comprension.'%' : '')), 0, 0, 'L', 0);
			//Lectura
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'LECTURA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, utf8_decode((($otdEmpleado->frances_lectura !== NULL &&
											   empty($otdEmpleado->frances_lectura) === FALSE) ?
			                			       $otdEmpleado->frances_lectura.'%' : '')), 0, 0, 'L', 0);
			//Escritura
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(22, 5, 'ESCRITURA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(30, 5, utf8_decode((($otdEmpleado->frances_escritura !== NULL &&
											   empty($otdEmpleado->frances_escritura) === FALSE) ?
			                			       $otdEmpleado->frances_escritura.'%' : '')) , 0, 1, 'L', 0);
			//Nivel de otro idioma
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'OTRO IDIOMA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(45, 5, $otdEmpleado->otro_idioma , 0, 0, 'L', 0);
			//Comprensión
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, utf8_decode('COMPRENSIÓN'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, utf8_decode((($otdEmpleado->otro_comprension !== NULL &&
											   empty($otdEmpleado->otro_comprension) === FALSE) ?
			                			       $otdEmpleado->otro_comprension.'%' : '')), 0, 0, 'L', 0);
		
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(22, 5, 'LECTURA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, utf8_decode((($otdEmpleado->otro_lectura !== NULL &&
											   empty($otdEmpleado->otro_lectura) === FALSE) ?
			                			       $otdEmpleado->otro_lectura.'%' : '')), 0, 0, 'L', 0);
			//Escritura
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(19, 5, 'ESCRITURA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(16, 5, utf8_decode((($otdEmpleado->otro_escritura !== NULL &&
											   empty($otdEmpleado->otro_escritura) === FALSE) ?
			                			       $otdEmpleado->otro_escritura.'%' : '')), 0, 1, 'L', 0);
			//Excel
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'EXCEL', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(45, 5, (($otdEmpleado->excel !== NULL &&
									   empty($otdEmpleado->excel) === FALSE) ?
	                			       $otdEmpleado->excel.'%' : ''), 0, 0, 'L', 0);
			//Word
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(27, 5, 'WORD', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, (($otdEmpleado->word !== NULL &&
									   empty($otdEmpleado->word) === FALSE) ?
	                			       $otdEmpleado->word.'%' : ''), 0, 0, 'L', 0);
			//Power Point
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(22, 5, 'POWER POINT', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5,  (($otdEmpleado->power_point !== NULL &&
									   empty($otdEmpleado->power_point) === FALSE) ?
	                			       $otdEmpleado->power_point.'%' : ''), 0, 0, 'L', 0);
			//Access
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(19, 5, 'ACCESS', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(16, 5,(($otdEmpleado->access !== NULL &&
									  empty($otdEmpleado->access) === FALSE) ?
	                			      $otdEmpleado->access.'%' : ''), 0, 1, 'L', 0);
			//Otras habilidades
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(190, 5, 'OTRAS HABILIDADES', 0, 1, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->MultiCell(190, 4, utf8_decode($otdEmpleado->otras_habilidades), 0, 'J', 0);
			//Verificar si existe información de dependientes 
			if($otdDependientes)
			{	
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
				$pdf->Cell(190, 5, utf8_decode('DEPENDIENTES'), 1, 1, 'C', 1);
				$pdf->SetTextColor(0); //establece el color de texto negro
				//Crea los titulos de la cabecera
				$arrCabeceraDep = array('NOMBRE', 'SEXO', 'PARENTESCO', 'FECHA DE NAC.');
				//Establece el ancho de las columnas de cabecera
				$arrAnchuraDep = array(88, 20, 57, 25);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacionDep = array('L', 'L', 'L', 'L');
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraDep);
				//Recorre el array de titulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabeceraDep); $intCont++) 
				{ 
					$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				   	//inserta los titulos de la cabecera
				    $pdf->Cell($arrAnchuraDep[$intCont], 7, $arrCabeceraDep[$intCont], 1, 0, 
				    		  $arrAlineacionDep[$intCont], TRUE);
				}
				$pdf->SetTextColor(0); //establece el color de texto negro
				$pdf->Ln(); //Deja un salto de linea
				//Recorremos el arreglo 
				foreach ($otdDependientes as $arrDep)
				{ 
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row(array(utf8_decode($arrDep->nombre), $arrDep->sexo, 
				    				utf8_decode($arrDep->parentesco), $arrDep->fecha_nacimiento), 
				                    $arrAlineacionDep); 
				}
			}//Cierre de verificación de dependientes
			//Cambiar color de relleno de la celda
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//Verificar si existe información de documentos activos 
			if($otdDocumentos)
			{
				//Definir ubicación de la carpeta
				$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intEmpleadoID;

				//Recorremos el arreglo 
				foreach ($otdDocumentos as $arrExp)
				{
					//Variable que se utiliza para asignar el nombre del archivo
		  			 $strNombreArchivo = '';

					//Verificar si la carpeta es un directorio 
		            if (is_dir($strNombreCarpeta))
		            {
		            	//Hacer recorrido en la carpeta para obtener archivos
		                foreach (scandir($strNombreCarpeta) as $item) 
		                {
		                    if ($item == '.' OR $item == '..') continue;
		                    //Separar extensión del archivo
		                    $arrArchivo = explode(".", $item);
		                    //Si el nombre del archivo es igual al id del documento
		                    if($arrArchivo[0] ==  $arrExp->documento_empleado_id)
		                    {
		                        //Asignar nombre completo del archivo (ejemplo: 1.gif)
		                        $strNombreArchivo = $item;
		                    }
		                        
		                }
		            }

		            //Si existe archivo del documento
		            if( $strNombreArchivo != '')
		            {
		            	$strExpediente.= $arrExp->descripcion.",";
		            }
				}

				//Si existe expediente del empleado
				if($strExpediente != '')
				{
					//Quitar el último simbolo concatenado ,
					$strExpediente = substr($strExpediente, 0, -1);
	            	///EXPEDIENTE
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
					$pdf->Cell(190, 5, utf8_decode('EXPEDIENTE'), 1, 1, 'C', 1);
					$pdf->SetTextColor(0); //establece el color de texto negro
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->MultiCell(190, 4, utf8_decode($strExpediente), 0, 'J', 0);
				}

			}//Cierre de verificación  del expediente 

			//Verificar si existe información de incidencias 
			if($otdIncidencias)
			{	
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
				$pdf->Cell(190, 5, utf8_decode('INCIDENCIAS'), 1, 1, 'C', 1);
				$pdf->SetTextColor(0); //establece el color de texto negro
				//Crea los titulos de la cabecera
				$arrCabeceraInc = array('FECHA', 'COMENTARIO');
				//Establece el ancho de las columnas
				$arrAnchuraInc = array(27, 163);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacionInc = array('L', 'L');
				//Establece el ancho de las columnas de incidencias
				$pdf->SetWidths($arrAnchuraInc);
				//Recorre el array de titulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabeceraInc); $intCont++) 
				{ 

				    $pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				   	//inserta los titulos de la cabecera
				    $pdf->Cell($arrAnchuraInc[$intCont], 7, $arrCabeceraInc[$intCont], 1, 0, 
				    		   $arrAlineacionInc[$intCont], TRUE);

				}
				$pdf->Ln(7);
				//Recorremos el arreglo 
				foreach ($otdIncidencias as $arrInc) 
				{ 
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row(array($arrInc->fecha,utf8_decode($arrInc->comentario)),
				    			    $arrAlineacionInc); 
				}
			}//Cierre de verificación de incidencias
		}//Cierre de verificación de información
		//Ejecutar la salida del reporte
		$pdf->Output('hoja_datos_'.$strNombre.'.pdf','I');
    }

    //Método para generar un reporte PDF en formato carta de recomendación con la información de un registro 
    public function get_reporte_carta_recomendacion($pdf, $intEmpleadoID)
    {
		//Seleccionar los datos de la sucursal que coincide con el id
		$otdSucursal = $this->sucursales->buscar($pdf->intSucursalID); 
		//Seleccionar los datos del empleado que coincide con el id
		$otdEmpleado = $this->empleados->buscar($intEmpleadoID); 
		//Variable que se utiliza para asignar el nombre completo del empleado
		$strNombre = '';
		//Variable que se utiliza para  concatenar estado y municipio de la sucursal seleccionada
		$strEstadoSucursal = ucwords(strtolower(utf8_decode($otdSucursal->municipio.', '.$otdSucursal->estado_rep)));

		//Hacer un llamado a la función get_fecha_formato_letra para obtener la fecha actual ejemplo: 23 de agosto de 2017
		$strFechaActual = $this->get_fecha_formato_letra();

		//Agregar la primer pagina
		$pdf->AddPage();
		//Verificar si hay información del registro
		if($otdEmpleado)
		{
			//Concatenar nombre y apellidos del empleado
			$strNombre = $otdEmpleado->nombre.' '.$otdEmpleado->apellido_paterno.' '.$otdEmpleado->apellido_materno;
			$pdf->Ln(40);//Espacios de salto de línea
			//Asigna el tipo y tamaño de letra para el encabezado del documento
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_ENCABEZADO_PDF);
			$pdf->Cell(0,3,$strEstadoSucursal.' a '.$strFechaActual, 0, 0, 'R');
			$pdf->Ln(25);//Espacios de salto de línea
			//A quien corresponda
			$pdf->Cell(0,3,'A QUIEN CORRESPONDA:', 0, 0, 'L');
			$pdf->Ln(12);//Espacios de salto de línea
			//Presente
			$pdf->Cell(0,3,'P R E S E N T E', 0, 0, 'L');
			$pdf->Ln(12);//Espacios de salto de línea
			//Primer Párrafo
			//Justificar letra
			$pdf->newFlowingBlock(188, 10, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_ENCABEZADO_PDF);
			//Variable que se utiliza para escribir el tipo de ciudadado dependiendo del sexo del empleado
			$strTipoCiudadano = (($otdEmpleado->sexo === 'MASCULINO') ?
			            		'el ' : 'la');
			$strTipoInteresado = (($otdEmpleado->sexo === 'MASCULINO') ?
			            		'el interesado' : 'la interesada');
			//Agregar texto 
			$strLineaTexto = utf8_decode('     		  Por medio de la presente y para los fines que pretenda '.$strTipoInteresado.', hago de su conocimiento que '.$strTipoCiudadano.' ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_ENCABEZADO_PDF);
			//Agregar texto 
			$strLineaTexto = 'C. '.strtoupper(utf8_decode($strNombre)).' ';
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_ENCABEZADO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('laboró en esta empresa en el departamento de ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_ENCABEZADO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode($otdEmpleado->departamento).' ';
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_ENCABEZADO_PDF);
			//Variable que se utiliza para asignar la fecha de ingreso del empleado
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2015-03-16 a 16 de marzo del 2015 
			$strFechaIngreso = (($otdEmpleado->fecha_ingreso_rep !== NULL && 
								  empty($otdEmpleado->fecha_ingreso_rep) === FALSE) ?
			            		 $this->get_fecha_formato_letra($otdEmpleado->fecha_ingreso_rep,'') : 
			            		 $this->get_fecha_formato_letra(date("Y-m-d"),''));

			//Variable que se utiliza para asignar la fecha de eliminación del empleado
			$strFechaEliminacion = (($otdEmpleado->fecha_eliminacion_rep !== NULL && 
								  empty($otdEmpleado->fecha_eliminacion_rep) === FALSE) ?
			            		 $this->get_fecha_formato_letra($otdEmpleado->fecha_eliminacion_rep,'') : 
			            		 $this->get_fecha_formato_letra(date("Y-m-d"),''));

			$strLineaTexto = 'durante el periodo del '.$strFechaIngreso.' al '.$strFechaEliminacion.'. Cumpliendo con responsabilidad las funciones que le fueron delegadas. Por lo cual lo recomendamos ampliamente.';
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Párrafo
			$pdf->finishFlowingBlock();
			$pdf->Ln(10); //Espacios de salto de línea
			//Segundo Párrafo
			//Justificar letra
			$pdf->newFlowingBlock(188, 10, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_ENCABEZADO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Se extiende la presente a solicitud del interesado y para los fines que juzgue convenientes.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Párrafo
			$pdf->finishFlowingBlock();
			$pdf->Ln(40);//Espacios de salto de línea
			//Firma (nombre y puesto) del empleado logeado en el sistema
			$pdf->Cell(190, 5, utf8_decode('___________________________________________  '), 0, 1, 'C', 0);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_ENCABEZADO_PDF);
			$pdf->Cell(190, 5, utf8_decode($this->session->userdata('empleado_firma')), 0, 1, 'C', 0);
			$pdf->Cell(190, 5, utf8_decode($this->session->userdata('puesto_empleado')), 0, 1, 'C', 0);
		}//Cierre de verificación de información
		//Ejecutar la salida del reporte
		$pdf->Output('carta_recomendacion_'.$strNombre.'.pdf','I');
    }

    //Método para generar un reporte PDF en formato constancia laboral con la información de un registro
    public function get_reporte_constancia_laboral($pdf, $intEmpleadoID)
    {
		//Seleccionar los datos de la sucursal que coincide con el id
		$otdSucursal = $this->sucursales->buscar($pdf->intSucursalID); 
		//Seleccionar los datos del empleado que coincide con el id
		$otdEmpleado = $this->empleados->buscar($intEmpleadoID); 
		//Variable que se utiliza para asignar el nombre completo del empleado
		$strNombre = '';
		//Variable que se utiliza para  concatenar estado y municipio de la sucursal seleccionada
		$strEstadoSucursal = ucwords(strtolower(utf8_decode($otdSucursal->municipio.', '.$otdSucursal->estado_rep)));

		//Hacer un llamado a la función get_fecha_formato_letra para obtener la fecha actual ejemplo: 23 de agosto de 2017
		$strFechaActual = $this->get_fecha_formato_letra();

		//Agregar la primer pagina
		$pdf->AddPage();
		//Verificar si hay información del registro
		if($otdEmpleado)
		{	
			//Concatenar nombre y apellidos del empleado
			$strNombre = $otdEmpleado->nombre.' '.$otdEmpleado->apellido_paterno.' '.$otdEmpleado->apellido_materno;
			$pdf->Ln(40);//Espacios de salto de línea
			//Asigna el tipo y tamaño de letra para el encabezado del documento
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_ENCABEZADO_PDF);
			$pdf->Cell(0,3,$strEstadoSucursal.' a '.$strFechaActual, 0, 0, 'R');
			$pdf->Ln(25);//Espacios de salto de línea
			//A quien corresponda
			$pdf->Cell(0,3,'A QUIEN CORRESPONDA:', 0, 0, 'L');
			$pdf->Ln(12);//Espacios de salto de línea
			//Presente
			$pdf->Cell(0,3,'P R E S E N T E', 0, 0, 'L');
			$pdf->Ln(12);//Espacios de salto de línea
			//Primer Párrafo
			//Justificar letra
			$pdf->newFlowingBlock(188, 10, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_ENCABEZADO_PDF);
			//Variable que se utiliza para escribir el tipo de ciudadado dependiendo del sexo del empleado
			$strTipoCiudadano = (($otdEmpleado->sexo === 'MASCULINO') ?
					'el ' : 'la');
			$strTipoInteresado = (($otdEmpleado->sexo === 'MASCULINO') ?
					'el interesado' : 'la interesada');
			//Agregar texto 
			$strLineaTexto = utf8_decode('     		  Por medio de la presente y para los fines que pretenda '.$strTipoInteresado.', hago de su conocimiento que '.$strTipoCiudadano.' ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_ENCABEZADO_PDF);
			//Agregar texto 
			$strLineaTexto = 'C. '.strtoupper(utf8_decode($strNombre)).' ';
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_ENCABEZADO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('laboró en esta empresa en el departamento de ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_ENCABEZADO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode($otdEmpleado->departamento).' COMO  '.utf8_decode($otdEmpleado->puesto).' ';
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_ENCABEZADO_PDF);
			//Variable que se utiliza para asignar la fecha de ingreso del empleado
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2015-03-16 a 16 de marzo del 2015 
			$strFechaIngreso = (($otdEmpleado->fecha_ingreso_rep !== NULL && 
					  empty($otdEmpleado->fecha_ingreso_rep) === FALSE) ?
					 $this->get_fecha_formato_letra($otdEmpleado->fecha_ingreso_rep,'') : 
					 $this->get_fecha_formato_letra(date("Y-m-d"),''));

			//Variable que se utiliza para asignar la fecha de eliminación del empleado
			$strFechaEliminacion = (($otdEmpleado->fecha_eliminacion_rep !== NULL && 
					  empty($otdEmpleado->fecha_eliminacion_rep) === FALSE) ?
					  $this->get_fecha_formato_letra($otdEmpleado->fecha_eliminacion_rep,'') : 
					  $this->get_fecha_formato_letra(date("Y-m-d"),''));

			$strLineaTexto = 'durante el periodo del '.$strFechaIngreso.' al '.$strFechaEliminacion.'.';
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Párrafo
			$pdf->finishFlowingBlock();
			$pdf->Ln(10); //Espacios de salto de línea
			//Segundo Párrafo
			//Justificar letra
			$pdf->newFlowingBlock(188, 10, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_ENCABEZADO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Se extiende la presente a solicitud del interesado y para los fines que juzgue convenientes.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Párrafo
			$pdf->finishFlowingBlock();
			$pdf->Ln(40);//Espacios de salto de línea
			//Firma (nombre y puesto) del empleado logeado en el sistema
			$pdf->Cell(190, 6, utf8_decode('___________________________________________  '), 0, 1, 'C', 0);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_ENCABEZADO_PDF);
			$pdf->Cell(190, 6, utf8_decode($this->session->userdata('empleado_firma')), 0, 1, 'C', 0);
			$pdf->Cell(190, 6, utf8_decode($this->session->userdata('puesto_empleado')), 0, 1, 'C', 0);
		}//Cierre de verificación de información
		//Ejecutar la salida del reporte
		$pdf->Output('constancia_laboral_'.$strNombre.'.pdf','I');
    }

    //Método para generar un reporte PDF con la información de un registro en formato de contrato determinado
    public function get_reporte_contrato_determinado($pdf, $intEmpleadoID, $intSueldo, $strTiempo, 
    								     		    $dteFechaVencimiento, $strJuntaConciliacion,
    								     			$strActividades)
    {

		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Seleccionar los datos de la empresa 
		$otdEmpresa = $this->empresas->buscar($this->session->userdata('empresa_id')); 
		//Seleccionar los datos de la sucursal que coincide con el id
		$otdSucursal = $this->sucursales->buscar($pdf->intSucursalID); 
		//Seleccionar los datos del empleado que coincide con el id
		$otdEmpleado = $this->empleados->buscar($intEmpleadoID);
		//Variable que se utiliza para asignar el nombre completo del empleado
		$strNombre = '';
		//Variable que se utiliza para  concatenar estado y municipio de la sucursal seleccionada
		$strEstadoSucursal = ucwords(strtolower(utf8_decode($otdSucursal->municipio.', '.$otdSucursal->estado_rep)));

		//Hacer un llamado a la función get_fecha_formato_letra para obtener la fecha actual ejemplo: 23 de agosto de 2017
		$strFechaActual = $this->get_fecha_formato_letra();

		//Variable que se utiliza para asignar la anchura del párrafo
		$intAnchuraParrafo = 186;

		//Agregar la primer pagina
		$pdf->AddPage();
		//Verificar si hay información del registro
		if($otdEmpleado)
		{
			//Concatenar nombre y apellidos del empleado
			$strNombre = $otdEmpleado->nombre.' '.$otdEmpleado->apellido_paterno.' '.$otdEmpleado->apellido_materno;

			//Variables que se utilizan para asignar datos del domicilio
			$strCalle = (($otdEmpleado->calle !== NULL && 
					empty($otdEmpleado->calle) === FALSE) ?
			        'C. '.$otdEmpleado->calle : '');

			$strNumeroExterior = (($otdEmpleado->numero_exterior !== NULL && 
							  empty($otdEmpleado->numero_exterior) === FALSE) ?
			        		'NO. '.$otdEmpleado->numero_exterior : '');

			$strNumeroInterior = (($otdEmpleado->numero_interior !== NULL && 
							  empty($otdEmpleado->numero_interior) === FALSE) ?
			        		'INT. '.$otdEmpleado->numero_interior : '');

			$strCodigoPostal = (($otdEmpleado->codigo_postal !== NULL && 
							  empty($otdEmpleado->codigo_postal) === FALSE) ?
			        		'CP: '.$otdEmpleado->codigo_postal : '');

			$strColonia = (($otdEmpleado->colonia !== NULL && 
							  empty($otdEmpleado->colonia) === FALSE) ?
			        		' '.$otdEmpleado->colonia : '');

			$strLocalidad = (($otdEmpleado->localidad !== NULL && 
							  empty($otdEmpleado->localidad) === FALSE) ?
			        		'LOC. '.$otdEmpleado->localidad.', ' : '');

			$strMunicipio = (($otdEmpleado->municipio !== NULL && 
							  empty($otdEmpleado->municipio) === FALSE) ?
			        		  $otdEmpleado->municipio.', '.$otdEmpleado->estado_rep.', '.$otdEmpleado->pais_rep : '');

			//Concatenar los datos del domicilio
			$strDomicilio = $strCalle.' '.$strNumeroExterior.' '.$strNumeroInterior.' '.
					        $strColonia.' '.$strLocalidad.' '.$strMunicipio.' '.$strCodigoPostal;

		    //Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
			$strDomicilio = mb_strtoupper($strDomicilio);

			//Variable que se utiliza para asignar el nombre de la sucursal
			$strSucursalEmp = '';
			//Si existe id de la sucursal
			if($otdEmpleado->sucursal_id > 0)
			{
				//Concatenar datos de la sucursal
				$strSucursalEmp = ', en sucursal '.$otdEmpleado->sucursal;
				$strSucursalEmp .= ', '.$otdEmpleado->estado_sucursal;
			}	

			$pdf->Ln(15);//Espacios de salto de línea
			//Asigna el tipo y tamaño de letra para el encabezado del documento
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Título del reporte
			$pdf->Cell(190, 6, utf8_decode('CONTRATO INDIVIDUAL DE TRABAJO '), 0, 0, 'C', 0);
			$pdf->Ln(12);//Espacios de salto de línea
			//Primer Párrafo
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('     		  En la ciudad de  '.$strEstadoSucursal.' a '.$strFechaActual.' los que suscribimos el presente, a saber ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode($otdEmpresa->razon_social.' ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('representada por el señor '. NOMBRE_DUENO_EMPRESA.' administrador único de dicha sociedad, quien en el curso del presente contrato se denominará ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('"el patrón"');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode(', y por la otra, al C. '.$strNombre.' por su propio derecho, como trabajador, a quien en adelante se denominará ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('"el trabajador"');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode(', hacemos constar que hemos convenido en celebrar un contrato individual de trabajo al tenor de las siguiente:');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Párrafo
			$pdf->finishFlowingBlock();
			$pdf->Ln(2);//Espacios de salto de línea
			//Cláusulas
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->Cell(190, 6, utf8_decode('CLÁUSULAS'), 0, 0, 'C', 0);
			$pdf->Ln(10);//Espacios de salto de línea
			
			//Primera Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Primera. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('El señor ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode(NOMBRE_DUENO_EMPRESA.' ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('declara que su representada es una sociedad mexicana, dedicada a prestar el servicio de compraventa de Maquinaria Agrícola y Refacciones, con poder amplio, en forma enunciativa y no limitativa, como consta en la cláusula Vigésima Cuarta de los estatutos sociales, del instrumento notarial No. 7,747 (siete mil setecientos cuarenta y siete) Volumen 88 (ochenta y ocho) Notaria Pública No. 23 del Lic. JUAN CUTBERTO TENORIO GONZALEZ con ejercicio en la ciudad de Jiquilpan Michoacán, México. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('El trabajador ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('declara llamarse ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode($strNombre);
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode(' de nacionalidad Mexicana, con domicilio en '.$strDomicilio.'.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea
			
			//Segunda Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Segunda. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Tanto la empresa como el trabajador (a), podrá poner fin en cualquier momento al presente contrato que se celebren por tiempo determinado de ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = $strTiempo;
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode(' con vencimiento el ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = $this->get_fecha_formato_letra($dteFechaVencimiento,'').' ';
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('sujetándose a las disposiciones legales vigentes, pero el  trabajador(a) no podrá separarse sin presentar el informe concerniente al puesto que desempeña. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea

			//Tercera Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Tercera. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Se obliga a prestar sus servicios personales, subordinado jurídicamente al patrón, consistentes en '.$strActividades.' inherentes a un  '.$otdEmpleado->puesto.', en el departamento de '.$otdEmpleado->departamento.$strSucursalEmp.'.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			$pdf->finishFlowingBlock();
			$pdf->Ln(2);//Espacios de salto de línea
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Este trabajo deberá desarrollarlo con esmero y eficiencia. Queda expresamente convenido que el trabajador acatará en el desempeño de su trabajo todas las disposiciones del Reglamento Interior de Trabajo, todas las órdenes, circulares y disposiciones que dicte el patrón y todos los ordenamientos legales que le sean aplicables.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea

			//Cuarta Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Cuarta. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('El trabajador(a) deberá ceñirse estrictamente, en la realización de sus funciones, a las condiciones y ordenes dadas por el patrón, las cuales no podrán variar en forma alguna, si no es con autorización previa dada por escrito por el patrón.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea
			
			//Quinta Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Quinta. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('La jornada de trabajo será de ocho horas diarias, de lunes a viernes de acuerdo con el siguiente horario, de las '.HORARIO_NORMAL_EMPRESA.' gozando de una hora para el consumo de sus comidas y los sábados de '.HORARIO_SABADO_EMPRESA);
			$pdf->WriteFlowingBlock($strLineaTexto);
			$pdf->finishFlowingBlock();
			$pdf->Ln(2);//Espacios de salto de línea
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('El trabajador no está autorizado para laborar en tiempo extra ordinario, salvo que haya orden expresa y por escrito del patrón; en cuyo caso, se estará a lo dispuesto en la Ley Federal del Trabajo.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea

			//Sexta Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Sexta. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('El trabajador percibirá de su sueldo quincenal, según sea lo convenido por las partes $'.number_format($intSueldo,2).' (' .$AifLibNumber->toCurrency($intSueldo) . '), el anterior salario, cubre todos  los días laborales e incluye así mismo el pago quincenal y de descanso obligatorio.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea
			
			//Séptima Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Séptima. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('El trabajador está obligado a checar asistencia en el reloj checador, en las oficinas.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea
			
			//Octava Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Octava. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('El patrón podrá rescindir la relación de trabajo con el trabajador, sin responsabilidad, en el caso de que el trabajador incurra en alguna de las causales previstas en el artículo 47 de La Ley Federal del Trabajo, salvo que concurran circunstancias justificativas.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea
			

			//Novena Cláusula
			//Justificar letra
			$pdf->newFlowingBlock(185, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Novena. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('El trabajador, después de un año de servicios continuos, disfrutará de un periodo anual de vacaciones pagadas, de seis días laborables, que aumentará en dos días laborables, hasta llegar a doce, por cada año subsiguiente de servicios. Después del cuarto año, el periodo de vacaciones aumentará en dos días por cada cinco años de servicios.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			$pdf->finishFlowingBlock();
			$pdf->Ln(2);//Espacios de salto de línea
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Los salarios correspondientes a las vacaciones se cubrirán con una prima del veinticinco por ciento sobre los mismos.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			$pdf->finishFlowingBlock();
			$pdf->Ln(3);//Espacios de salto de línea
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('En caso de faltas injustificadas de asistencia al trabajo, se podrán deducir dichas faltas del periodo de prestación de servicios computable para fijar las vacaciones, reduciéndose éstas proporcionalmente.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			$pdf->finishFlowingBlock();
			$pdf->Ln(2);//Espacios de salto de línea
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Las vacaciones no podrán compensarse con una remuneración');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea

			//Décima Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Décima. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('El trabajador percibirá un aguinaldo anual, que deberá pagarse antes del veinte de diciembre, equivalente a quince días de salario.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			$pdf->finishFlowingBlock();
			$pdf->Ln(2);//Espacios de salto de línea
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Cuando no haya cumplido el año de servicios, tendrá derecho a que se le pague en proporción al tiempo trabajado.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea
			

			//Décima primera Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Décima primera. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Los salarios correspondientes a las vacaciones y aguinaldo, se pagarán tomando como salario base el promedio que resulte de los salarios devengados en el último año, o del total de los percibidos.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea
			//Décima segunda Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Décima segunda. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('El trabajador será capacitado o adiestrado en los términos de los planes y programas establecidos (o que se establezcan), por el patrón, conforme a lo dispuesto en el Capítulo III Bis, Título Cuarto, de la Ley Federal del Trabajo.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea
			//Variable que se utiliza para asignar la fecha de ingreso del empleado
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2015-03-16 a 16 de marzo del 2015 
			$strFechaIngreso = (($otdEmpleado->fecha_ingreso_rep !== NULL && 
							  empty($otdEmpleado->fecha_ingreso_rep) === FALSE) ?
			        		 $this->get_fecha_formato_letra($otdEmpleado->fecha_ingreso_rep,'') : 
			        		 $this->get_fecha_formato_letra(date("Y-m-d"),''));

			//Décima tercera Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Décima tercera. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Para los efectos de su antigüedad queda establecido que el trabajador(a) ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode($strNombre);
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode(' entró a prestar sus servicios el día '.$strFechaIngreso.'.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea
		

			//Décima cuarta Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Décima cuarta. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Las partes convienen en que todo lo no previsto en el presente contrato se regirá por lo dispuesto en la Ley Federal del Trabajo y en que, para todo lo que se refiera a interpretación, ejecución y cumplimiento del mismo, se someten expresamente a la jurisdicción y competencia de la '.$strJuntaConciliacion);
			$pdf->WriteFlowingBlock($strLineaTexto);
			$pdf->finishFlowingBlock();
			$pdf->Ln(2);//Espacios de salto de línea
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Leído que fue el presente contrato por las partes, e impuestas de su contenido y fuerza legal, lo firmaron, quedando un ejemplar en poder de cada una de las mismas.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(15);//Espacios de salto de línea
			
			//Firmas del patrón  y trabajador
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//línea para escribir la firma del patrón
			$pdf->Cell(90,3,'__________________________________', 0, 0, 'C');
			//línea para escribir la firma del trabajador
			$pdf->Cell(90,3,'__________________________________', 0, 0, 'C');
			$pdf->Ln(5);//Espacios de salto de línea
			//Nombre del dueño de la empresa
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->Cell(90,3,utf8_decode(NOMBRE_DUENO_EMPRESA), 0, 0, 'C');  
			//Nombre del trabajador
			$pdf->Cell(90,3,utf8_decode($strNombre), 0, 0, 'C');  
			$pdf->Ln(5);//Espacios de salto de línea
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->Cell(90,3,utf8_decode('EL PATRÓN'), 0, 0, 'C'); 
			$pdf->Cell(90,3,utf8_decode('TRABAJADOR'), 0, 0, 'C'); 
			$pdf->Ln(15);//Espacios de salto de línea
			//Firmas de los testigos
			//línea para escribir la firma del testigo 1
			$pdf->Cell(90,3,'__________________________________', 0, 0, 'C');
			//línea para escribir la firma del testigo 2
			$pdf->Cell(90,3,'__________________________________', 0, 0, 'C');
			$pdf->Ln(5);//Espacios de salto de línea
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->Cell(90,3,utf8_decode('TESTIGO'), 0, 0, 'C'); 
			$pdf->Cell(90,3,utf8_decode('TESTIGO'), 0, 0, 'C');  

		}//Cierre de verificación de información

		//Ejecutar la salida del reporte
		$pdf->Output('contrato_'.$strNombre.'.pdf','I');
    }


    //Método para generar un reporte PDF con la información de un registro en formato de contrato indeterminado
    public function get_reporte_contrato_indeterminado($pdf, $intEmpleadoID, $intSueldo, 
    												   $strJuntaConciliacion)
    {

		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Seleccionar los datos de la empresa 
		$otdEmpresa = $this->empresas->buscar($this->session->userdata('empresa_id')); 
		//Seleccionar los datos de la sucursal que coincide con el id
		$otdSucursal = $this->sucursales->buscar($pdf->intSucursalID); 
		//Seleccionar los datos del empleado que coincide con el id
		$otdEmpleado = $this->empleados->buscar($intEmpleadoID);
		//Variable que se utiliza para asignar el nombre completo del empleado
		$strNombre = '';
		//Variable que se utiliza para  concatenar estado y municipio de la sucursal seleccionada
		$strEstadoSucursal = ucwords(strtolower(utf8_decode($otdSucursal->municipio.', '.$otdSucursal->estado_rep)));

		//Variable que se utiliza para asignar el número interior
		$strNumInteriorSucursal = (($otdSucursal->numero_interior !== NULL && 
					        	    empty($otdSucursal->numero_interior) === FALSE) ?
                                    ' INT. '.$otdSucursal->numero_interior : '');

		//Concatenar datos para el domicilio
        $strDomicilioSucursal = $otdSucursal->calle . ' NO.'.$otdSucursal->numero_exterior.
	    							$strNumInteriorSucursal.' COL. ' . $otdSucursal->colonia.' C.P. '.
	    							$otdSucursal->codigo_postal.' '.$otdSucursal->localidad. ', '. 
	    							$otdSucursal->municipio. ', '.$otdSucursal->estado_rep;

	    //Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$strDomicilioSucursal = mb_strtoupper($strDomicilioSucursal);							

		//Hacer un llamado a la función get_fecha_formato_letra para obtener la fecha actual ejemplo: 23 de agosto de 2017
		$strFechaActual = $this->get_fecha_formato_letra();
		
		//Variable que se utiliza para asignar la anchura del párrafo
		$intAnchuraParrafo = 186;

		//Agregar la primer pagina
		$pdf->AddPage();
		//Verificar si hay información del registro
		if($otdEmpleado)
		{
			//Concatenar nombre y apellidos del empleado
			$strNombre = $otdEmpleado->nombre.' '.$otdEmpleado->apellido_paterno.' '.$otdEmpleado->apellido_materno;

				//Variables que se utilizan para asignar datos del domicilio
			$strCalle = (($otdEmpleado->calle !== NULL && 
					empty($otdEmpleado->calle) === FALSE) ?
			        'C. '.$otdEmpleado->calle : '');

			$strNumeroExterior = (($otdEmpleado->numero_exterior !== NULL && 
							  empty($otdEmpleado->numero_exterior) === FALSE) ?
			        		'NO. '.$otdEmpleado->numero_exterior : '');

			$strNumeroInterior = (($otdEmpleado->numero_interior !== NULL && 
							  empty($otdEmpleado->numero_interior) === FALSE) ?
			        		'INT. '.$otdEmpleado->numero_interior : '');

			$strCodigoPostal = (($otdEmpleado->codigo_postal !== NULL && 
							  empty($otdEmpleado->codigo_postal) === FALSE) ?
			        		'CP: '.$otdEmpleado->codigo_postal : '');

			$strColonia = (($otdEmpleado->colonia !== NULL && 
							  empty($otdEmpleado->colonia) === FALSE) ?
			        		' '.$otdEmpleado->colonia : '');

			$strLocalidad = (($otdEmpleado->localidad !== NULL && 
							  empty($otdEmpleado->localidad) === FALSE) ?
			        		'LOC. '.$otdEmpleado->localidad.', ' : '');

			$strMunicipio = (($otdEmpleado->municipio !== NULL && 
							  empty($otdEmpleado->municipio) === FALSE) ?
			        		  $otdEmpleado->municipio.', '.$otdEmpleado->estado_rep.', '.$otdEmpleado->pais_rep : '');

			//Concatenar los datos del domicilio
			$strDomicilio = $strCalle.' '.$strNumeroExterior.' '.$strNumeroInterior.' '.
					        $strColonia.' '.$strLocalidad.' '.$strMunicipio.' '.$strCodigoPostal;

		    //Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
			$strDomicilio = mb_strtoupper($strDomicilio);		

			//Fecha de ingreso
			//Variable que se utiliza para asignar la fecha de ingreso del empleado
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2015-03-16 a 16 de marzo del 2015 
			$strFechaIngreso = (($otdEmpleado->fecha_ingreso_rep !== NULL && 
							    empty($otdEmpleado->fecha_ingreso_rep) === FALSE) ?
			        		    $this->get_fecha_formato_letra($otdEmpleado->fecha_ingreso_rep,'') : 
			        		    $this->get_fecha_formato_letra(date("Y-m-d"),''));

			$pdf->Ln(15);//Espacios de salto de línea
			//Asigna el tipo y tamaño de letra para el encabezado del documento
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Título del reporte
			$pdf->Cell(190, 6, utf8_decode('CONTRATO INDIVIDUAL DE TRABAJO'), 0, 1, 'C', 0);
			$pdf->Cell(190, 6, utf8_decode('CUADRO DE DATOS'), 0, 0, 'C', 0);
			$pdf->Ln(12);//Espacios de salto de línea
			
			//Datos generales del empleado
			$pdf->Cell(190, 6, utf8_decode('1.- GENERALES DEL TRABAJADOR'), 0, 0, 'L', 0);
			$pdf->Ln(8);//Espacios de salto de línea

			//Nombre del empleado
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->Cell(18, 5, utf8_decode('NOMBRE:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->ClippedCell(168, 5, utf8_decode($strNombre), 0, 0, 'L', 0);
			$pdf->Ln(8);//Espacios de salto de línea
			
			//Domicilio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->Cell(22, 5, utf8_decode('DOMICILIO:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->MultiCell(164, 5, utf8_decode($strDomicilio));
			$pdf->Ln(3);//Espacios de salto de línea
			
			//Nacionalidad
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->Cell(30, 5, utf8_decode('NACIONALIDAD:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->ClippedCell(30, 5, 'MEXICANA', 0, 0, 'L', 0);

			//Sexo
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->Cell(12, 5, utf8_decode('SEXO:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->ClippedCell(30, 5, $otdEmpleado->sexo, 0, 0, 'L', 0);

			//Estado civil
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->Cell(28, 5, utf8_decode('ESTADO CIVIL:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->ClippedCell(30, 5, $otdEmpleado->estado_civil, 0, 0, 'L', 0);
			$pdf->Ln(8);//Espacios de salto de línea

			//Puesto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->Cell(24, 5, utf8_decode('2.- PUESTO:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->ClippedCell(162, 5, utf8_decode($otdEmpleado->puesto), 0, 0, 'L', 0);
			$pdf->Ln(8);//Espacios de salto de línea

			//Departamento
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->Cell(33, 5, utf8_decode('DEPARTAMENTO:'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->ClippedCell(153, 5, utf8_decode($otdEmpleado->departamento), 0, 0, 'L', 0);
			$pdf->Ln(8);//Espacios de salto de línea

			

			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->Cell(62, 5, utf8_decode('FECHA EN QUE ENTRA EN VIGOR: '), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->ClippedCell(124, 5, strtoupper ($strFechaIngreso), 0, 0, 'L', 0);
			$pdf->Ln(12);//Espacios de salto de línea


			//Primer Párrafo
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('CONTRATO INDIVIDUAL DE TRABAJO POR TIEMPO ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('INDETERMINADO ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('QUE CELEBRAN  ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode($otdEmpresa->razon_social);
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('  CON DOMICILIO  EN EL '.$strDomicilioSucursal.'.');
			$strLineaTexto .=  utf8_decode(' COMO PATRON Y REPRESENTADA POR EL ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('C. '.NOMBRE_DUENO_EMPRESA);
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode(' DECLARANDO QUE LA EMPRESA REPRESENTADA ES UNA SOCIEDAD MEXICANA DEDICADA A PRESTAR EL SERVICIO DE COMPRA VENTA DE MAQUINARIA AGRICOLA Y REFACCIONES CON PODER AMPLIO, EN FORMA ENUNCIATIVA Y NO LIMITATIVA COMO CONSTA EN LA CLÁUSULA VIGÉSIMA CUARTA DE LOS ESTATUTOS SOCIALES, LA CUAL ESTA CONSTITUIDA MEDIANTE EL INSTRUMENTO NOTARIAL NUM. 7,747 VOLUMEN 88 NOTARIA PUBLICA NO. 23 DEL LIC. JUAN CUTBERTO TENORIO GONZALEZ CON EJERCICIO EN LA CIUDAD DE JIQUILPAN MICHOACÁN, MÉXICO, POR LA OTRA, ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode($strNombre);
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode(' CUYO NOMBRE Y GENERALES FIGURAN BAJO EL CUADRO DE DATOS DEL TRABAJADOR(A) Y QUE POR RAZON DE BREVEDAD, SE DENOMINAN EN EL PRESENTE CONTRATO LA EMPRESA Y EL TRABAJADOR(A), A LAS PARTES DE CONFORMIDAD A LAS SIGUIENTES: ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Párrafo
			$pdf->finishFlowingBlock();
			$pdf->Ln(5);//Espacios de salto de línea

			//Cláusulas
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->Cell(190, 6, utf8_decode('CLÁUSULAS'), 0, 0, 'C', 0);
			$pdf->Ln(10);//Espacios de salto de línea

			//Primera Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('PRIMERA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('La Empresa toma a su servicio al trabajador(a), para que desempeñe el puesto indicado en el número 2 del cuadro de datos, y quien desempeñara su trabajo en el departamento indicado.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea

			//Segunda Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('SEGUNDA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('La Empresa se reserva el derecho de cambiar al trabajador(a) a cualquier otro departamento que se le ha designado para el desempeño de sus funciones.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea


			//Tercera Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('TERCERA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Queda expresamente convenida la obligación del trabajador(a) a ejecutar sus labores con la intensidad y cuidados, en la forma, tiempo y lugar en que este contrato se precise.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea

			//Cuarta Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('CUARTA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Tanto la empresa como el trabajador(a), podrá poner fin en cualquier momento al presente contrato que celebren, por tiempo, ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('indeterminado. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Sujetándose a las disposiciones legales vigentes, pero el trabajador(a) no podrá separarse sin presentar el informe concerniente al puesto que desempeña.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea

			//Quinta Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('QUINTA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('El trabajador(a) se compromete a cumplir fielmente las ordenes e instrucciones que le sean dadas por los representantes de la Empresa y ejecutar el trabajo con mayor intensidad, cuidado y esmero.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			$pdf->finishFlowingBlock();
			$pdf->Ln(2);//Espacios de salto de línea
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Dentro de los primeros TREINTA días que el trabajador(a) preste sus servicios a la empresa y con fundamento en la fracción I del articulo 47 de la Ley Federal del Trabajo, la empresa podrá rescindir este contrato sin responsabilidad para la misma si el trabajador(a) carece de la capacidad, conocimientos, aptitudes, adiestramiento o facultades necesarias para desempeñar el trabajo que se le encomiende.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea


			//Sexta Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('SEXTA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('La Jornada semanal de trabajo diurno será de cuarenta y ocho horas de trabajo, de cuarenta y cinco horas la mixta y de cuarenta y dos horas la de trabajo nocturno. La Empresa, podrá distribuir el trabajo semanal de acuerdo con el Reglamento Interior de Trabajo, por consiguiente el tiempo extraordinario se calculara después de una labor semanal de cuarenta y ocho horas, de cuarenta y cinco horas y de cuarenta y dos horas, según se trate de labores desarrolladas en jornadas diurnas, mixtas o nocturnas y solamente que el trabajador labore mas de las horas fijadas en el trabajo semanal, tendrá derecho a recibir salario extraordinario.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea


			//Séptima Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('SÉPTIMA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Por no requerir la naturaleza del trabajo, queda estrictamente prohibido al trabajador. Trabajar tiempo extraordinario por lo que la Empresa no le reconocerá cantidad alguna por las labores ejecutadas con exceso a la jornada de ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('ocho ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('horas diarias, por tres días a la semana únicamente. Cuando el trabajador sea requerido por la empresa para que presta sus servicios en horas extraordinarias no podrá iniciar dicho trabajo en horas extras si antes no ha recibido la correspondiente autorización precisamente por escrito de su jefe inmediato.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea


			//Octava Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('OCTAVA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Se señala como día de descanso semanal, el día DOMINGO de cada semana, el cual, si las necesidades del servicio lo requieren, podrá ser cambiado por cualquier otro día.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea

			//Novena Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('NOVENA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Queda expresamente convenido y aceptado por las partes que se considera como causa de rescisión del presente contrato, la falta de cumplimiento adecuado por parte del trabajador(a) de las instrucciones que en forma verbal o expresa estén en vigor en la fecha de firma de este documento o sean emitidas en el futuro por la empresa, por sus representantes autorizados, tendientes a instruir o regular las operaciones de la empresa por lo que se refiere a las instrucciones que directa o indirectamente se relacionen con las actividades encomendadas al trabajador o tengan que ver con el puesto que este asignado.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea

			//Décima Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('DÉCIMA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('El trabajador(a) disfrutara de su sueldo mensual, quincenal o semanal, según sea lo convenido por las partes $'.number_format($intSueldo,2).' (' .$AifLibNumber->toCurrency($intSueldo) . ') el anterior salario, cubre todos los días laborables e incluye así mismo el pago semanal y de descanso obligatorio en la cláusula siguiente:');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea

			//Décima primera Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('DÉCIMA PRIMERA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Serán días de descanso obligatorio y con derecho para recibir el trabajador(a), salario integro, los siguientes 1 de enero; el primer lunes de febrero en conmemoraciones del 5 de febrero; el 1ro de mayo; el tercer lunes de noviembre en conmemoración del 20 de noviembre; 1 de diciembre de cada 6 años cuando corresponda a la transmisión del poder ejecutivo federal y el 25 de diciembre de cada año.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea

			//Décima segunda Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('DÉCIMA SEGUNDA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Las partes convienen en considerar como falta de probidad que el trabajador utilice en actividades ajenas a la empresa, todo o parte del tiempo que por razón de este contrato queda obligado a trabajar para la misma.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea

			//Décima tercera Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('DÉCIMA TERCERA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('El trabajador(a) manifiesta bajo protesta de decir verdad, que tiene la capacidad, los conocimientos y habilidades necesarios para desempeñar el trabajo estipulado en las cláusulas anteriores y anexo de este contrato. En las mismas condiciones ratifica la veracidad de los datos e informes proporcionados a la empresa previamente a la celebración de este.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			$pdf->finishFlowingBlock();
			$pdf->Ln(2);//Espacios de salto de línea
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Agregar texto 
			$strLineaTexto = utf8_decode('Por lo tanto, convienen las partes que será causa de rescisión la falta de veracidad, en los datos y capacidad del trabajador(a), y señala el trabajador(a) que para cualquier notificación subsistirá el domicilio señalando en el cuadro de datos, hasta en tanto no proporcione ningún cambio.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea


			//Décima cuarta Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('DÉCIMA CUARTA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('La Empresa, después de que el trabajador(a) cumpla un año de servicios, concederá a este sus vacaciones con goce de sueldo, las cuales nunca serán menores a la que marca la Ley Federal del Trabajo.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea

			//Décima quinta Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('DÉCIMA QUINTA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Este contrato se firma por duplicado y la empresa entrega al trabajador(a) un ejemplar del mismo, al tiempo de firmarlo.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(4);//Espacios de salto de línea

			//Décima sexta Cláusula
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('DÉCIMA SEXTA. ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode('Convienen expresamente ambas partes, que para todo lo referente a interpretación y ejecución al incumplimiento del contrato, las partes se someterán expresamente a la jurisdicción y competencia de la ');
			$pdf->WriteFlowingBlock($strLineaTexto);
			$pdf->finishFlowingBlock();
		    //Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//Agregar texto 
			$strLineaTexto = utf8_decode($strJuntaConciliacion.' Lugar de contratación del trabajador(a), renunciando a cualquier otra competencia que por domicilio o por cualquier otra razón pudiere corresponderle.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(10);//Espacios de salto de línea

			//Fecha actual
			//Justificar letra
			$pdf->newFlowingBlock($intAnchuraParrafo, 5, '', 'J' );
			//Agregar texto 
			$strLineaTexto = utf8_decode(' En la población de '.$strEstadoSucursal.' a '.$strFechaActual.'.');
			$pdf->WriteFlowingBlock($strLineaTexto);
			//Cierre de Cláusula
			$pdf->finishFlowingBlock();
			$pdf->Ln(15);//Espacios de salto de línea

			//Firmas del patrón  y trabajador
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			//línea para escribir la firma del patrón
			$pdf->Cell(90,3,'__________________________________', 0, 0, 'C');
			//línea para escribir la firma del trabajador
			$pdf->Cell(90,3,'__________________________________', 0, 0, 'C');
			$pdf->Ln(5);//Espacios de salto de línea
			//Nombre del dueño de la empresa
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->Cell(90,3,utf8_decode(NOMBRE_DUENO_EMPRESA), 0, 0, 'C');  
			//Nombre del trabajador
			$pdf->Cell(90,3,utf8_decode($strNombre), 0, 0, 'C');  
			$pdf->Ln(5);//Espacios de salto de línea
			//Tamaño y tipo de letra de la fuente
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->Cell(90,3,utf8_decode('EMPRESA'), 0, 0, 'C'); 
			$pdf->Cell(90,3,utf8_decode('TRABAJADOR'), 0, 0, 'C'); 
		

		}//Cierre de verificación de información

		//Ejecutar la salida del reporte
		$pdf->Output('contrato_'.$strNombre.'.pdf','I');
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
		$otdResultado = $this->empleados->buscar(NULL, NULL, NULL, NULL, $strBusqueda); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE EMPLEADOS');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
         		 ->setCellValue('A'.$intPosEncabezados, 'CÓDIGO')
        		 ->setCellValue('B'.$intPosEncabezados, 'NOMBRE (S)')
        		 ->setCellValue('C'.$intPosEncabezados, 'APELLIDO PATERNO')
        		 ->setCellValue('D'.$intPosEncabezados, 'APELLIDO MATERNO')
        		 ->setCellValue('E'.$intPosEncabezados, 'RFC')
        		 ->setCellValue('F'.$intPosEncabezados, 'CURP')
        		 ->setCellValue('G'.$intPosEncabezados, 'ESTADO CIVIL')
        		 ->setCellValue('H'.$intPosEncabezados, 'SEXO')
        		 ->setCellValue('I'.$intPosEncabezados, 'FECHA DE NACIMIENTO')
        		 ->setCellValue('J'.$intPosEncabezados, 'LUGAR DE NACIMIENTO')
        		 ->setCellValue('K'.$intPosEncabezados, 'ESTADO')
        		 ->setCellValue('L'.$intPosEncabezados, 'PAÍS')
        		 ->setCellValue('M'.$intPosEncabezados, 'CALLE')
        		 ->setCellValue('N'.$intPosEncabezados, 'NO. EXTERIOR')
        		 ->setCellValue('O'.$intPosEncabezados, 'NO. INTERIOR')
        		 ->setCellValue('P'.$intPosEncabezados, 'CÓDIGO POSTAL')
        		 ->setCellValue('Q'.$intPosEncabezados, 'COLONIA')
        		 ->setCellValue('R'.$intPosEncabezados, 'LOCALIDAD')
        		 ->setCellValue('S'.$intPosEncabezados, 'MUNICIPIO')
        		 ->setCellValue('T'.$intPosEncabezados, 'ESTADO')
        		 ->setCellValue('U'.$intPosEncabezados, 'PAÍS')
        		 ->setCellValue('V'.$intPosEncabezados, 'TELÉFONO PARTICULAR')
        		 ->setCellValue('W'.$intPosEncabezados, 'CORREO ELECTRÓNICO')
        		 ->setCellValue('X'.$intPosEncabezados, 'NOMBRE DE CONTACTO')
        		 ->setCellValue('Y'.$intPosEncabezados, 'TELÉFONO')
        		 ->setCellValue('Z'.$intPosEncabezados, 'PARENTESCO')
        		 ->setCellValue('AA'.$intPosEncabezados, 'FECHA DE INGRESO')
        		 ->setCellValue('AB'.$intPosEncabezados, 'CORPORATIVO')
        		 ->setCellValue('AC'.$intPosEncabezados, 'SUCURSAL')
        		 ->setCellValue('AD'.$intPosEncabezados, 'DEPARTAMENTO')
        		 ->setCellValue('AE'.$intPosEncabezados, 'PUESTO')
        		 ->setCellValue('AF'.$intPosEncabezados, 'LICENCIA DE MANEJO')
        		 ->setCellValue('AG'.$intPosEncabezados, 'TIPO DE LICENCIA')
        		 ->setCellValue('AH'.$intPosEncabezados, 'FECHA DE EXPEDICIÓN')
        		 ->setCellValue('AI'.$intPosEncabezados, 'FECHA DE VIGENCIA')
        		 ->setCellValue('AJ'.$intPosEncabezados, 'CUENTA')
        		 ->setCellValue('AK'.$intPosEncabezados, 'CLABE')
        		 ->setCellValue('AL'.$intPosEncabezados, 'NÚMERO DE SEGURIDAD SOCIAL')
        		 ->setCellValue('AM'.$intPosEncabezados, 'CLÍNICA')
        		 ->setCellValue('AN'.$intPosEncabezados, 'NÚMERO DE INFONAVIT')
        		 ->setCellValue('AO'.$intPosEncabezados, 'TIPO DE RETENCIÓN')
        		 ->setCellValue('AP'.$intPosEncabezados, 'IMPORTE')
        		 ->setCellValue('AQ'.$intPosEncabezados, 'FECHA DE INICIO')
        		 ->setCellValue('AR'.$intPosEncabezados, 'TIPO DE SANGRE')
        		 ->setCellValue('AS'.$intPosEncabezados, 'TALLA DE CAMISA')
        		 ->setCellValue('AT'.$intPosEncabezados, 'TALLA DE PANTALÓN')
        		 ->setCellValue('AU'.$intPosEncabezados, 'TALLA DE ZAPATOS')
        		 ->setCellValue('AV'.$intPosEncabezados, 'NÚMERO DE AFORE')
        		 ->setCellValue('AW'.$intPosEncabezados, 'INSTITUCIÓN DE AFORE')
        		 ->setCellValue('AX'.$intPosEncabezados, 'GRADO DE ESTUDIOS')
        		 ->setCellValue('AY'.$intPosEncabezados, 'NIVEL LICENCIATURA')
        		 ->setCellValue('AZ'.$intPosEncabezados, 'INSTITUCIÓN')
        		 ->setCellValue('BA'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('BB'.$intPosEncabezados, 'NIVEL MAESTRÍA')
        		 ->setCellValue('BC'.$intPosEncabezados, 'INSTITUCIÓN')
        		 ->setCellValue('BD'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('BE'.$intPosEncabezados, 'INGLÉS COMPRENSIÓN')
        		 ->setCellValue('BF'.$intPosEncabezados, 'LECTURA')
        		 ->setCellValue('BG'.$intPosEncabezados, 'ESCRITURA')
        		 ->setCellValue('BH'.$intPosEncabezados, 'FRANCÉS COMPRENSIÓN')
        		 ->setCellValue('BI'.$intPosEncabezados, 'LECTURA')
        		 ->setCellValue('BJ'.$intPosEncabezados, 'ESCRITURA')
        		 ->setCellValue('BK'.$intPosEncabezados, 'OTRO')
        		 ->setCellValue('BL'.$intPosEncabezados, 'COMPRENSIÓN')
        		 ->setCellValue('BM'.$intPosEncabezados, 'LECTURA')
        		 ->setCellValue('BN'.$intPosEncabezados, 'ESCRITURA')
        		 ->setCellValue('BO'.$intPosEncabezados, 'EXCEL')
        		 ->setCellValue('BP'.$intPosEncabezados, 'WORD')
        		 ->setCellValue('BQ'.$intPosEncabezados, 'POWER POINT')
        		 ->setCellValue('BR'.$intPosEncabezados, 'ACCESS')
        		 ->setCellValue('BS'.$intPosEncabezados, 'OTRAS HABILIDADES')
                 ->setCellValue('BT'.$intPosEncabezados, 'ESTATUS');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo para cambiar el formato de la celda a porcentaje
        $arrStylePorcentaje = array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:BT9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Convertir cantidad a porcentaje para que aparezca correctamente al cambiar el formato de la celda
				$arrCol->ingles_comprension = $arrCol->ingles_comprension / 100;
				$arrCol->ingles_lectura = $arrCol->ingles_lectura / 100;
				$arrCol->ingles_escritura = $arrCol->ingles_escritura / 100;
				$arrCol->frances_comprension = $arrCol->frances_comprension / 100;
				$arrCol->frances_lectura = $arrCol->frances_lectura / 100;
				$arrCol->frances_escritura = $arrCol->frances_escritura / 100;
				$arrCol->otro_comprension = $arrCol->otro_comprension / 100;
				$arrCol->otro_lectura = $arrCol->otro_lectura / 100;
				$arrCol->otro_escritura = $arrCol->otro_lectura / 100;
				$arrCol->excel = $arrCol->excel / 100;
				$arrCol->word = $arrCol->word / 100;
				$arrCol->power_point = $arrCol->power_point / 100;
				$arrCol->access = $arrCol->access / 100;

				//Si el tipo de retención es porcentaje
				if($arrCol->tipo_retencion == 'PORCENTAJE')
				{
					$arrCol->importe = $arrCol->importe / 100;

					//Cambiar contenido de las celdas a formato porcentaje
					$objExcel->getActiveSheet()
		            		 ->getStyle('AO'.$intFila.':'.'AO'.$intFila)
		            		 ->getNumberFormat()
		            		 ->applyFromArray($arrStylePorcentaje);
				}
				else
				{
					//Cambiar contenido de las celdas a formato moneda
            		$objExcel->getActiveSheet()
	            		     ->getStyle('AO'.$intFila.':'.'AO'.$intFila)
	            		     ->getNumberFormat()
	            		     ->setFormatCode('$#,##0.00');
				}

				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
		         		 ->setCellValueExplicit('A'.$intFila, $arrCol->codigo, PHPExcel_Cell_DataType::TYPE_STRING)
		        		 ->setCellValue('B'.$intFila, $arrCol->nombre)
		        		 ->setCellValue('C'.$intFila, $arrCol->apellido_paterno)
		        		 ->setCellValue('D'.$intFila, $arrCol->apellido_materno)
		        		 ->setCellValue('E'.$intFila, $arrCol->rfc)
		        		 ->setCellValue('F'.$intFila, $arrCol->curp)
		        		 ->setCellValue('G'.$intFila, $arrCol->estado_civil)
		        		 ->setCellValue('H'.$intFila, $arrCol->sexo)
		        		 ->setCellValue('I'.$intFila, $arrCol->fecha_nacimiento)
		        		 ->setCellValue('J'.$intFila, $arrCol->municipio_nacimiento)
		        		 ->setCellValue('K'.$intFila, $arrCol->estado_nacimiento)
		        		 ->setCellValue('L'.$intFila, $arrCol->pais_nacimiento)
		        		 ->setCellValue('M'.$intFila, $arrCol->calle)
		        		 ->setCellValue('N'.$intFila, $arrCol->numero_exterior)
		        		 ->setCellValue('O'.$intFila, $arrCol->numero_interior)
		        		 ->setCellValueExplicit('P'.$intFila, $arrCol->codigo_postal, PHPExcel_Cell_DataType::TYPE_STRING)
		        		 ->setCellValue('Q'.$intFila, $arrCol->colonia)
		        		 ->setCellValue('R'.$intFila, $arrCol->localidad)
		        		 ->setCellValue('S'.$intFila, $arrCol->municipio)
		        		 ->setCellValue('T'.$intFila, $arrCol->estado)
		        		 ->setCellValue('U'.$intFila, $arrCol->pais)
		        		 ->setCellValue('V'.$intFila, $arrCol->telefono_particular)
		        		 ->setCellValue('W'.$intFila, $arrCol->correo_electronico)
		        		 ->setCellValue('X'.$intFila, $arrCol->emergencia_nombre)
		        		 ->setCellValue('Y'.$intFila, $arrCol->emergencia_telefono)
		        		 ->setCellValue('Z'.$intFila, $arrCol->emergencia_parentesco)
		        		 ->setCellValue('AA'.$intFila, $arrCol->fecha_ingreso)
		        		 ->setCellValue('AB'.$intFila, $arrCol->corporativo)
		        		 ->setCellValue('AC'.$intFila, $arrCol->sucursal)
		        		 ->setCellValue('AD'.$intFila, $arrCol->departamento)
		        		 ->setCellValue('AE'.$intFila, $arrCol->puesto)
		        		 ->setCellValue('AF'.$intFila, $arrCol->licencia_manejo)
		        		 ->setCellValue('AG'.$intFila, $arrCol->licencia_tipo)
		        		 ->setCellValue('AH'.$intFila, $arrCol->licencia_expedicion)
		        		 ->setCellValue('AI'.$intFila, $arrCol->licencia_vigencia)
		        		 ->setCellValueExplicit('AJ'.$intFila, $arrCol->cuenta_bancaria, PHPExcel_Cell_DataType::TYPE_STRING)
		        		 ->setCellValueExplicit('AK'.$intFila, $arrCol->clabe, PHPExcel_Cell_DataType::TYPE_STRING)
		        		 ->setCellValueExplicit('AL'.$intFila, $arrCol->nss, PHPExcel_Cell_DataType::TYPE_STRING)
		        		 ->setCellValue('AM'.$intFila, $arrCol->clinica)
		        		 ->setCellValueExplicit('AN'.$intFila, $arrCol->infonavit, PHPExcel_Cell_DataType::TYPE_STRING)
		        		 ->setCellValue('AO'.$intFila, $arrCol->tipo_retencion)
		        		 ->setCellValue('AP'.$intFila, $arrCol->importe)
		        		 ->setCellValue('AQ'.$intFila, $arrCol->fecha_infonavit)
		        		 ->setCellValue('AR'.$intFila, $arrCol->tipo_sangre)
		        		 ->setCellValue('AS'.$intFila, $arrCol->talla_camisa)
		        		 ->setCellValue('AT'.$intFila, $arrCol->talla_pantalon)
		        		 ->setCellValue('AU'.$intFila, $arrCol->talla_zapatos)
		        		 ->setCellValueExplicit('AV'.$intFila, $arrCol->numero_afore, PHPExcel_Cell_DataType::TYPE_STRING)
		        		 ->setCellValue('AW'.$intFila, $arrCol->afore)
		        		 ->setCellValue('AX'.$intFila, $arrCol->grado_estudios)
		        		 ->setCellValue('AY'.$intFila, $arrCol->licenciatura_titulo)
		        		 ->setCellValue('AZ'.$intFila, $arrCol->licenciatura_institucion)
		        		 ->setCellValue('BA'.$intFila, $arrCol->licenciatura_fecha)
		        		 ->setCellValue('BB'.$intFila, $arrCol->maestria_titulo)
		        		 ->setCellValue('BC'.$intFila, $arrCol->maestria_institucion)
		        		 ->setCellValue('BD'.$intFila, $arrCol->maestria_fecha)
		        		 ->setCellValue('BE'.$intFila, $arrCol->ingles_comprension)
		        		 ->setCellValue('BF'.$intFila, $arrCol->ingles_lectura)
		        		 ->setCellValue('BG'.$intFila, $arrCol->ingles_escritura)
		        		 ->setCellValue('BH'.$intFila, $arrCol->frances_comprension)
		        		 ->setCellValue('BI'.$intFila, $arrCol->frances_lectura)
		        		 ->setCellValue('BJ'.$intFila, $arrCol->frances_escritura)
		        		 ->setCellValue('BK'.$intFila, $arrCol->otro_idioma)
		        		 ->setCellValue('BL'.$intFila, $arrCol->otro_comprension)
		        		 ->setCellValue('BM'.$intFila, $arrCol->otro_lectura)
		        		 ->setCellValue('BN'.$intFila, $arrCol->otro_escritura)
		        		 ->setCellValue('BO'.$intFila, $arrCol->excel)
		        		 ->setCellValue('BP'.$intFila, $arrCol->word)
		        		 ->setCellValue('BQ'.$intFila, $arrCol->power_point)
		        		 ->setCellValue('BR'.$intFila, $arrCol->access)
		        		 ->setCellValue('BS'.$intFila, $arrCol->otras_habilidades)
		                 ->setCellValue('BT'.$intFila, $arrCol->estatus);

				
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar contenido de las celdas a formato porcentaje
            $objExcel->getActiveSheet()
            		 ->getStyle('BE'.$intFilaInicial.':'.'BJ'.$intFila)
            		 ->getNumberFormat()
            		 ->applyFromArray($arrStylePorcentaje);

             $objExcel->getActiveSheet()
            		  ->getStyle('BL'.$intFilaInicial.':'.'BR'.$intFila)
            		  ->getNumberFormat()
            		  ->applyFromArray($arrStylePorcentaje);

			//Cambiar alineación de las siguientes celdas
           	$objExcel->getActiveSheet()
                	 ->getStyle('AB'.$intFilaInicial.':'.'AB'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

           	$objExcel->getActiveSheet()
                	 ->getStyle('AP'.$intFilaInicial.':'.'AP'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
                	 ->getStyle('BB'.$intFilaInicial.':'.'BG'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

             $objExcel->getActiveSheet()
                	  ->getStyle('BE'.$intFilaInicial.':'.'BJ'.$intFila)
                	  ->getAlignment()
                	  ->applyFromArray($arrStyleAlignmentRight);

			$objExcel->getActiveSheet()
                	 ->getStyle('BL'.$intFilaInicial.':'.'BR'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
                	 ->getStyle('BT'.$intFilaInicial.':'.'BT'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('BT'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('BT'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'empleados.xls', 'empleados', $intFila);
	}
}