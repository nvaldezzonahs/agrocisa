<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes_compra_especiales extends MY_Controller {

	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;
	//Información que se utiliza para asignar el número de decimales a redondear
	var $intNumDecimales = NUM_DECIMALES_MOSTRAR_CUENTAS_PAGAR;
	//Información que se utiliza para asignar el número de decimales a redondear de la cantidad
	var $intNumDecimalesCantidad = NUM_DECIMALES_CANTIDAD_OC_CUENTAS_PAGAR;
    //Información que se utiliza para asignar el número de decimales a redondear del precio unitario
	var $intNumDecimalesPrecioUnitario = NUM_DECIMALES_PRECIO_UNIT_OC_CUENTAS_PAGAR;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar ruta de la carpeta principal
	    $this->archivo['strCarpetaPrincipal'] = './archivos/';
		//Asignar ruta de la carpeta destino
	    $this->archivo['strCarpetaDestino'] = './archivos/ordenes_compra_especiales/';
	    //Asignar ruta de la carpeta temporal
	    $this->archivo['strCarpetaTemporal'] = './orden_compra_especial_temporal_';
	    //Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de ordenes de compra especiales
		$this->load->model('cuentas_pagar/ordenes_compra_especiales_model', 'ordenes');
		//Cargamos el modelo de proveedores
		$this->load->model('cuentas_pagar/proveedores_model', 'proveedores');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('cuentas_pagar/ordenes_compra_especiales', $arrDatos);
	}

	/*******************************************************************************************************************
	Funciones de la tabla ordenes_compra_especiales
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
										 $this->input->post('intProveedorID'),
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
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionAdjuntar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionVerArchivoRegistro = 'no-mostrar';
			$arrDet->mostrarAccionEliminarArchivoRegistro = 'no-mostrar';
			$arrDet->mostrarAccionAutorizar = 'no-mostrar';
			$arrDet->mostrarAccionEnviarCorreo = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;

            //Asignar el id de la orden de compra
            $intOrdenCompraEspecialID = $arrDet->orden_compra_especial_id;
            //Concatenar id del registro que hace referencia a la carpeta donde se encuentra el archivo
			$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intOrdenCompraEspecialID;

            //Asignar el nombre del archivo que le corresponde al registro
		    $strNombreArchivo = $this->get_verifar_archivo_registro($strNombreCarpeta, $intOrdenCompraEspecialID);

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

				//Si el usuario cuenta con el permiso de acceso AUTORIZAR
				if (in_array('AUTORIZAR', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Autorizar
					$arrDet->mostrarAccionAutorizar = '';
				}

				//Si el usuario cuenta con el permiso de acceso ADJUNTAR
				if (in_array('ADJUNTAR', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Adjuntar
		        	$arrDet->mostrarAccionAdjuntar = '';
				}

				//Si el usuario cuenta con el permiso de acceso ENVIAR CORREO
				if (in_array('ENVIAR CORREO', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Enviar Correo
					$arrDet->mostrarAccionEnviarCorreo = '';
				}
			}
			else
			{
				//Si el estatus del registro es RECHAZADO
				if($arrDet->estatus == 'RECHAZADO')
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
					else
					{
						//Si el usuario cuenta con el permiso de acceso ENVIAR CORREO
						if (in_array('ENVIAR CORREO', $arrPermisos))
						{
							//Asignar cadena vacia para mostrar botón Enviar Correo
							$arrDet->mostrarAccionEnviarCorreo = '';
						}
					}

				}

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

	        	//Si el usuario cuenta con el permiso de acceso ADJUNTAR
				if (in_array('ADJUNTAR', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Eliminar archivo del registro
	        		$arrDet->mostrarAccionEliminarArchivoRegistro = '';
				}
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
		$objOrdenCompra = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Datos de la orden de compra
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objOrdenCompra->intOrdenCompraEspecialID = $this->input->post('intOrdenCompraEspecialID');
		$objOrdenCompra->strFolioConsecutivo = $this->input->post('strFolioConsecutivo');
		$objOrdenCompra->dteFecha = $this->input->post('dteFecha');
		$objOrdenCompra->dteFechaEntrega = $this->input->post('dteFechaEntrega');
		$objOrdenCompra->dteFechaVencimiento = $this->input->post('dteFechaVencimiento');
		$objOrdenCompra->strCondicionesPago = $this->input->post('strCondicionesPago');
		$objOrdenCompra->intMonedaID = $this->input->post('intMonedaID');
		$objOrdenCompra->intTipoCambio = $this->input->post('intTipoCambio');
		$objOrdenCompra->strFactura = mb_strtoupper($this->input->post('strFactura'));
		$objOrdenCompra->intProveedorID = $this->input->post('intProveedorID');
		//Si no existe id del régimen fiscal asignar valor nulo
		$objOrdenCompra->intRegimenFiscalID = (($this->input->post('intRegimenFiscalID') !== '') ? 
										         $this->input->post('intRegimenFiscalID') : NULL);

		//Si no existe id del porcentaje de retención ISR asignar valor nulo
		$objOrdenCompra->intPorcentajeRetencionID = (($this->input->post('intPorcentajeRetencionID') !== '') ? 
										              $this->input->post('intPorcentajeRetencionID') : NULL);

		//Si no existe importe retenido de ISR asignar valor nulo
		$objOrdenCompra->intImporteRetenido = (($this->input->post('intImporteRetenido') !== '') ? 
										        $this->input->post('intImporteRetenido') : NULL);
		

		$objOrdenCompra->intSolicitaID = $this->input->post('intSolicitaID');
		$objOrdenCompra->strObservaciones = mb_strtoupper($this->input->post('strObservaciones'));
		$objOrdenCompra->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los detalles
		$objOrdenCompra->strCuentaID = $this->input->post('strCuentaID'); 
		$objOrdenCompra->strConceptos = $this->input->post('strConceptos'); 
		$objOrdenCompra->strCantidades = $this->input->post('strCantidades'); 
		$objOrdenCompra->strPreciosUnitarios = $this->input->post('strPreciosUnitarios'); 
		$objOrdenCompra->strDescuentosUnitarios = $this->input->post('strDescuentosUnitarios'); 
		$objOrdenCompra->strTasaCuotaIva = $this->input->post('strTasaCuotaIva'); 
		$objOrdenCompra->strIvasUnitarios = $this->input->post('strIvasUnitarios');
		$objOrdenCompra->strTasaCuotaIeps = $this->input->post('strTasaCuotaIeps'); 
		$objOrdenCompra->strIepsUnitarios = $this->input->post('strIepsUnitarios'); 
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objOrdenCompra->intOrdenCompraEspecialID))
		{
			$bolResultado = $this->ordenes->modificar($objOrdenCompra);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objOrdenCompra->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objOrdenCompra->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->ordenes->guardar($objOrdenCompra); 

				/*Quitar '_'  de la cadena (resultadoTransaccion_ordenCompraID_folioConsecutivo) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $objOrdenCompra->intOrdenCompraEspecialID, $objOrdenCompra->strFolioConsecutivo) = explode("_", $bolResultado); 
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
							 	  'orden_compra_especial_id' => $objOrdenCompra->intOrdenCompraEspecialID,
							 	  'folio' => $objOrdenCompra->strFolioConsecutivo,
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

	
    //Método para regresar los datos de una orden de compra especifica
	public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intID = $this->input->post('intOrdenCompraEspecialID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->ordenes->buscar($intID);
	     //Concatenar id del registro que hace referencia a la carpeta donde se encuentra el archivo
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intID;
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Asignar el nombre del archivo que le corresponde al registro
	        $arrDatos['archivo'] = $this->get_verifar_archivo_registro($strNombreCarpeta, $intID);
			$arrDatos['row'] = $otdResultado;
			//Seleccionar los detalles del registro
			$otdDetalles = $this->ordenes->buscar_detalles($intID);
			//Si existen detalles del registro, se asignan al array
			if($otdDetalles)
			{


				//Hacer un llamado a la función para cambiar indices de las cuentas (en caso de que no exista la cuenta del nivel 3, es decir, donde la cuenta principal sea la 603)
				$arrDatos['detalles'] = $this->get_detalles($otdDetalles);
			}
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Función que se utiliza para cambiar las descripciones e id´s de los niveles: 1, 2 y 3, en caso de que la cuenta principal sea 603: GASTOS DE ADMINISTRACION
	public function get_detalles($otdDetalles)
	{
		//Hacer recorrido para cambiar la posición de los niveles en caso de que la cuenta principal sea 603
		foreach ($otdDetalles as $arrDet)
		{
			//Asignar datos de la cuenta del nivel 1
			$intCuentaIDNivel1 = $arrDet->cuentaID_nivel1;
			//Asignar datos de la cuenta del nivel 2
			$intCuentaIDNivel2 = $arrDet->cuentaID_nivel2;
			$strCuentaNivel2 = $arrDet->cuenta_nivel2;
			//Asignar datos de la cuenta del nivel 3
			$intCuentaIDNivel3 = $arrDet->cuentaID_nivel3;
			$strCuentaNivel3 =  $arrDet->cuenta_nivel3;

			//Si la cuenta del nivel 2 corresponde a Gastod Financieros
			if($strCuentaNivel2 == 'GASTOS FINANCIEROS')
			{

				//Cambiar indices de las cuentas para mostrar correctamente la información de la cuenta 703
				//Cambiar posición de la cuenta del nivel 2
				$arrDet->cuentaID_nivel1 = $intCuentaIDNivel2;
				$arrDet->cuenta_nivel1 = $strCuentaNivel2;
				//Cambiar posición de la cuenta del nivel 3
				$arrDet->cuentaID_nivel2 = $intCuentaIDNivel3;
				$arrDet->cuenta_nivel2 = $strCuentaNivel3;
				//Asignar cadena vacia porque la cuenta 603 no tiene nivel 3 (departamento)
				$arrDet->cuentaID_nivel3 = '';
				$arrDet->cuenta_nivel3 = '';

			}
			else
			{
				//Si no existe id de la cuenta del nivel 1, significa que la cuenta principal es la 603
				if($intCuentaIDNivel1 == '')
				{
					
					//Cambiar indices de las cuentas para mostrar correctamente la información de la cuenta 603
					//Cambiar posición de la cuenta del nivel 2
					$arrDet->cuentaID_nivel1 = $intCuentaIDNivel2;
					$arrDet->cuenta_nivel1 = $strCuentaNivel2;
					//Cambiar posición de la cuenta del nivel 3
					$arrDet->cuentaID_nivel2 = $intCuentaIDNivel3;
					$arrDet->cuenta_nivel2 = $strCuentaNivel3;
					//Asignar id de la cuenta del nivel 3 para cargar en el combobox las cuentas del nivel 4
					$arrDet->cuentaID_nivel3 = $intCuentaIDNivel3;
					//Asignar cadena vacia porque la cuenta 603 no tiene nivel 3 (departamento)
					$arrDet->cuenta_nivel3 = '';

				}
			}


			

		}

		//Regresar el objeto con los detalles del registro
		return $otdDetalles;
	}
	

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intOrdenCompraEspecialID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intOrdenCompraEspecialID');
		    $strEstatus = $this->input->post('strEstatus');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->ordenes->set_estatus($intID, $strEstatus);
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
			$otdResultado = $this->ordenes->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->orden_proveedor, 
		        						'data' => $arrCol->orden_compra_especial_id);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}


	//Método para enviar la autorización (o el rechazo) de un registro
	public function set_enviar_autorizacion()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intOrdenCompraEspecialID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intOrdenCompraEspecialID');
	        $strUsuarios = $this->input->post('strUsuarios');
	        $strMensaje = trim($this->input->post('strMensaje'));
	        //Si el tipo de acción corresponde a Guardar asignar valor nulo
			$strEstatus = (($this->input->post('strTipoAccion') === 'Guardar') ? 
							NULL : $this->input->post('strEstatus'));

	        //Hacer un llamado al método para autorizar o rechazar los datos de un registro
			$bolResultado = $this->ordenes->set_enviar_autorizacion($intID, $strUsuarios, $strMensaje, $strEstatus);
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

    //Método para subir los archivos de un registro
    public function subir_archivos()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$intOrdenCompraEspecialID = $_POST["intOrdenCompraEspecialID_ordenes_compra_especiales_cuentas_pagar"];
		$strBotonArchivoID = $_FILES["archivo_varios_ordenes_compra_especiales_cuentas_pagar"];
		//Asignar el nombre de la carpeta 
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intOrdenCompraEspecialID; 

		//Hacer un llamado a la función para subir el archivo
		$this->subir_archivo_reg($strBotonArchivoID, $this->archivo['strCarpetaPrincipal'], 
								 $this->archivo['strCarpetaDestino'], 
							     $strNombreCarpeta, $intOrdenCompraEspecialID, TRUE);
	}

    //Método para descargar archivos de un registro
    public function descargar_archivos()
	{
        //Variables que se utilizan para recuperar los valores de la vista
		$intOrdenCompraEspecialID = $this->input->post('intOrdenCompraEspecialID');
		$strFolio = $this->input->post('strFolio');

		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intOrdenCompraEspecialID;
		//Asignar nombre de la carpeta zip
		$strNombreCarpetaZIP = 'OCE_'.$strFolio.'.zip';

		//Hacer un llamado a la función para descargar el archivo
		$this->descargar_archivo_reg($strNombreCarpeta, NULL,  $strNombreCarpetaZIP);
	}

	//Método para eliminar los archivos de un registro
	public function eliminar_carpeta_registro()
	{	
		//Variables que se utilizan para recuperar los valores de la vista 
		$intOrdenCompraEspecialID = $this->input->post('intOrdenCompraEspecialID');
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intOrdenCompraEspecialID;

		//Hacer un llamado a la función para eliminar la carpeta
		$this->eliminar_carpeta_reg($strNombreCarpeta, TRUE);
	}

	
	//Método para enviar orden de compra al correo electrónico del proveedor
	public function enviar_correo_electronico_proveedor()
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$intOrdenCompraEspecialID = $this->input->post('intOrdenCompraEspecialID');
		$strCorreoElectronico = $this->input->post('strCorreoElectronico');
		$strCopiaCorreoElectronico = $this->input->post('strCopiaCorreoElectronico');
		
	 	//Generar el archivo PDF
        $strRuta = $this->get_reporte_registro($intOrdenCompraEspecialID, 'SI');

         //Array que se utiliza para enviar correo electrónico
		$arrDatos =  array('intReferenciaID' => $intOrdenCompraEspecialID,
						   'strTitulo' => utf8_decode('Solicitud de Orden de Compra Especial'),
						   'strRuta' => $strRuta,
						   'strCorreoElectronico'  => $strCorreoElectronico,
						   'strCopiaCorreoElectronico' => $strCopiaCorreoElectronico,
						   'strComentarios' => 'Favor de darle seguimiento.');

		//Hacer un llamado a la función para enviar correo electrónico
		$this->set_enviar_correo($arrDatos);
	}
	
	//Método para eliminar carpeta temporal
	public function eliminar_carpeta_temporal($intOrdenCompraEspecialID)
	{
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaTemporal'].$intOrdenCompraEspecialID; 
		//Hacer un llamado a la función para eliminar la carpeta temporal
		$this->eliminar_carpeta_reg($strNombreCarpeta);
	}

	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte() 
	{	            
	
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProveedorID = $this->input->post('intProveedorID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strDetalles = $this->input->post('strDetalles');
		//Array que se utiliza para asignar los estatus 
		$arrEstatus = array('ACTIVO', 'AUTORIZADO', 'PARCIAL', 'SURTIDO', 'RECHAZADO', 'INACTIVO'); 
		//Array que se utiliza para asignar el subtotal por estatus
		$arrSubtotalEstatus = array(); 
		//Array que se utiliza para asignar el IVA por estatus
		$arrIvaEstatus = array();
		//Array que se utiliza para asignar el IEPS por estatus
		$arrIepsEstatus = array(); 
		//Array que se utiliza para asignar el total por estatus
		$arrTotalEstatus = array();
		//Array que se utiliza para asignar el subtotal por moneda
		$arrSubtotalMoneda = array(); 
		//Array que se utiliza para asignar el IVA por moneda
		$arrIvaMoneda = array();
		//Array que se utiliza para asignar el IEPS por moneda
		$arrIepsMoneda = array(); 
		//Array que se utiliza para asignar el total por moneda
		$arrTotalMoneda = array();
		//Array que se utiliza para asignar el total de registros por moneda
		$arrTotalRegistrosMoneda = array();
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
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->ordenes->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProveedorID, 
											   $strEstatus, $strBusqueda);
		//Seleccionar los datos de las monedas que coinciden con el parámetro enviado
		$otdMonedas = $this->ordenes->buscar_distintas_monedas($dteFechaInicial, $dteFechaFinal, $intProveedorID, 
															   $strEstatus, $strBusqueda);
		
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal != '')
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
		$pdf->strLinea1 =  'LISTADO DE ORDENES DE COMPRA ESPECIALES '.$strTituloRangoFechas;
		//Si existe id del proveedor
		if($intProveedorID > 0)
		{
			//Seleccionar los datos del proveedor que coincide con el id
			$otdProveedor =  $this->proveedores->buscar($intProveedorID);
			$pdf->strLinea2 =  'PROVEEDOR: '.utf8_decode($otdProveedor->codigo.' - '.$otdProveedor->razon_social);
		}

		
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'PROVEEDOR', 'FECHA', 'FACTURA',  'SUBTOTAL', 
								  'IVA', 'IEPS', 'TOTAL', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(16, 47, 15, 18, 20, 18, 18, 18, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'L', 'R', 'R', 'R', 'R', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('R', 'L', 'L', 'R', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(16, 50, 35, 25, 25 );
		//Agregar la primer pagina
		$pdf->AddPage();
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo para obtener la información de los estatus
			foreach ($arrEstatus as $arrEst)
			{
				//Inicializar variables
				$arrSubtotalEstatus[$arrEst] = 0;
				$arrIvaEstatus[$arrEst] = 0;
				$arrIepsEstatus[$arrEst] = 0;
				$arrTotalEstatus[$arrEst] = 0;
			}	

			//Recorremos el arreglo para obtener la información de las monedas
			foreach ($otdMonedas as $arrMon)
			{
				//Recorremos el arreglo para obtener la información de los estatus
				foreach ($arrEstatus as $arrEst)
				{
					//Inicializar variables
					$arrSubtotalMoneda[$arrMon->moneda_id][$arrEst] = 0;
					$arrIvaMoneda[$arrMon->moneda_id][$arrEst] = 0;
					$arrIepsMoneda[$arrMon->moneda_id][$arrEst] = 0;
					$arrTotalMoneda[$arrMon->moneda_id][$arrEst] = 0;
					$arrTotalRegistrosMoneda[$arrMon->moneda_id] = 0;
				}
			}

			//Recorremos el arreglo para obtener la información de las ordenes de compra
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				//Array que se utiliza para agregar los detalles
		        $arrDetalles = array();
		        //Array que se utiliza para agregar los datos de un detalle
		        $arrAuxiliar = array();
		        //Variable que se utiliza para asignar el acumulado del subtotal
				$intAcumSubtotal = 0;
				//Variable que se utiliza para asignar el acumulado del IVA
				$intAcumIva = 0;
				//Variable que se utiliza para asignar el acumulado del IEPS
				$intAcumIeps = 0;

				//Asignar el importe retenido de ISR (proveedor)
				$intRetencionIsrProv = ($arrCol->importe_retenido / $arrCol->tipo_cambio);
				

				//Seleccionar los detalles del registro
				$otdDetalles = $this->ordenes->buscar_detalles($arrCol->orden_compra_especial_id);
				
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Hacer un llamado a la función para cambiar indices de las cuentas (en caso de que no exista la cuenta del nivel 3, es decir, donde la cuenta principal sea la 603)
					$otdDetalles = $this->get_detalles($otdDetalles);

					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Variables que se utilizan para asignar valores del detalle
						$intCantidad = $arrDet->cantidad;
						//Convertir peso mexicano a tipo de cambio
						$intPrecioUnitario = ($arrDet->precio_unitario / $arrCol->tipo_cambio);
						$intIvaUnitario = ($arrDet->iva_unitario / $arrCol->tipo_cambio);
						$intIepsUnitario = ($arrDet->ieps_unitario / $arrCol->tipo_cambio);
						//Variable que se utiliza para asignar el importe de IVA
						$intImporteIva = 0;
						//Variable que se utiliza para asignar el importe de IEPS
						$intImporteIeps = 0;

						//Si existe importe de IVA unitario
						if($intIvaUnitario > 0)
						{
							//Calcular importe de IVA
						    $intImporteIva =  $intIvaUnitario * $intCantidad;
						}

						//Si existe importe de IEPS unitario
						if($intIepsUnitario > 0)
						{
							//Calcular importe de IEPS
						    $intImporteIeps =  $intIepsUnitario * $intCantidad;
						}

						//Calcular subtotal
						$intSubTotalUnitario = $intCantidad * $intPrecioUnitario;

						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["cantidad"] = number_format($intCantidad,$this->intNumDecimalesCantidad);
						$arrAuxiliar["concepto"] = utf8_decode($arrDet->concepto);
						$arrAuxiliar["cuenta"] = utf8_decode($arrDet->cuenta_nivel4);
		                $arrAuxiliar["precio_unitario"] = '$'.number_format($intPrecioUnitario,$this->intNumDecimalesPrecioUnitario);
		                $arrAuxiliar["subtotal"] = '$'.number_format($intSubTotalUnitario,$this->intNumDecimales);
		                //Asignar datos al array
                        array_push($arrDetalles, $arrAuxiliar); 

                        //Incrementar acumulados
						$intAcumSubtotal += $intSubTotalUnitario;
						$intAcumIva += $intImporteIva;
						$intAcumIeps += $intImporteIeps;
					}

				}//Cierre de verificación de detalles


				//Decrementar importe de retención ISR (proveedor)
				$intAcumSubtotal -= $intRetencionIsrProv;

				//Calcular importe total
				$intTotal = $intAcumSubtotal +$intAcumIva + $intAcumIeps;
				
				//Incrementar valores de los siguientes arrays
				$arrSubtotalEstatus[$arrCol->estatus] += ($intAcumSubtotal * $arrCol->tipo_cambio);
		      	$arrIvaEstatus[$arrCol->estatus] += ($intAcumIva * $arrCol->tipo_cambio);
		      	$arrIepsEstatus[$arrCol->estatus] += ($intAcumIeps * $arrCol->tipo_cambio);
		      	$arrTotalEstatus[$arrCol->estatus] += ($intTotal* $arrCol->tipo_cambio);

		      	//Si el id de la moneda no corresponde al peso mexicano
		      	if($arrCol->moneda_id != MONEDA_BASE)
		      	{
		      		//Incrementar valores de los siguientes arrays
			      	$arrSubtotalMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intAcumSubtotal;
			      	$arrIvaMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intAcumIva;
			      	$arrIepsMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intAcumIeps;
			      	$arrTotalMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intTotal;
			      	$arrTotalRegistrosMoneda[$arrCol->moneda_id] += 1;
		      	}
					
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, utf8_decode($arrCol->proveedor), $arrCol->fecha,  
								$arrCol->factura, 
								'$'.number_format($intAcumSubtotal,$this->intNumDecimales),
								'$'.number_format($intAcumIva,$this->intNumDecimales),
								'$'.number_format($intAcumIeps,$this->intNumDecimales),
								'$'.number_format($intTotal,$this->intNumDecimales), $arrCol->estatus), 
								$pdf->arrAlineacion, 'ClippedCell');
		        
		        //Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
				//Moneda
				$pdf->Cell(12, 4, 'MONEDA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(7, 4, utf8_decode($arrCol->codigo_moneda), 0, 0, 'L', 0);
		    	//Tipo de cambio
		    	$pdf->Cell(6, 4, 'T.C.:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(12, 4,'$'.number_format($arrCol->tipo_cambio, 4, '.', ','), 0, 0, 'R', 0);
				//Fecha de entrega
				$pdf->Cell(12, 4, 'ENTREGA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(13, 4, utf8_decode($arrCol->fecha_entrega), 0, 0, 'L', 0);
				//Fecha de vencimiento
				$pdf->Cell(16, 4, 'VENCIMIENTO:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(13, 4, utf8_decode($arrCol->fecha_vencimiento), 0, 0, 'L', 0);
			    //Condiciones de pago
			    $pdf->Cell(17, 4, 'CONDICIONES:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(13, 4, utf8_decode($arrCol->condiciones_pago), 0, 0, 'L', 0);
			   
				//Si se cumple la sentencia mostrar detalles del registro
				if($arrDetalles && $strDetalles == 'SI')
				{
					$pdf->Ln(5);//Deja un salto de línea
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraDetalles);
					//Recorremos el arreglo 
			        foreach ($arrDetalles as $arrDet) 
			        {
					   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array($arrDet['cantidad'], $arrDet['concepto'], 
					    				$arrDet['cuenta'], $arrDet['precio_unitario'],  
									    $arrDet['subtotal']), $arrAlineacionDetalles, 'ClippedCell');
					}
				}//Cierre de verificación de detalles
		    	$pdf->Ln(5);//Deja un salto de línea
				//Incrementar el contador por cada registro
				$intContador++;
			}

			$pdf->Ln(5);//Deja un salto de linea

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- RESUMEN
	        //------------------------------------------------------------------------------------------------------------------------
	        //Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//Crea los titulos de la cabecera
			$arrCabeceraResumen = array('ESTATUS', 'SUBTOTAL', 'IVA', 'IEPS',  'TOTAL');
			//Establece el ancho de las columnas de cabecera
			$arrAnchuraResumen = array(25, 25, 25, 25, 25);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacionResumen = array('L', 'R', 'R', 'R', 'R');
			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Creación de la tabla Resumen
			$pdf->Cell(125, 4, 'RESUMEN GENERAL EN PESOS', 0, 0, 'C', TRUE);
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
									'$'.number_format($arrSubtotalEstatus[$arrEst],$this->intNumDecimales), 
									'$'.number_format($arrIvaEstatus[$arrEst],$this->intNumDecimales), 
			    				    '$'.number_format($arrIepsEstatus[$arrEst],$this->intNumDecimales), 
			    				    '$'.number_format($arrTotalEstatus[$arrEst],$this->intNumDecimales)), 
									 $arrAlineacionResumen);

					//Incrementar acumulados si el estatus es diferente de INACTIVO o RECHAZADO
					if($arrEst != 'INACTIVO' &&  $arrEst != 'RECHAZADO')
					{
						//Incrementar acumulados
						$intAcumSubtotalEstatus += $arrSubtotalEstatus[$arrEst];
						$intAcumIvaEstatus += $arrIvaEstatus[$arrEst];
						$intAcumIepsEstatus += $arrIepsEstatus[$arrEst];
						$intAcumTotalEstatus += $arrTotalEstatus[$arrEst];
					}
				}
			}

			//Asigna el tipo y tamaño de letra para los totales
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Escribir totales
	    	$pdf->Cell(12,3,'TOTALES: ', 0, 0, 'L');  
	    	//Total de registros
            $pdf->Cell(13,3,$intContador, 0, 0, 'R');
            //Acumulado del subtotal
            $pdf->Cell(25,3,'$'.number_format($intAcumSubtotalEstatus,$this->intNumDecimales), 0, 0, 'R');
            //Acumulado del IVA
            $pdf->Cell(25,3,'$'.number_format($intAcumIvaEstatus,$this->intNumDecimales), 0, 0, 'R');
           //Acumulado del IEPS
            $pdf->Cell(25,3,'$'.number_format($intAcumIepsEstatus,$this->intNumDecimales), 0, 0, 'R');
            //Acumulado del importe total
            $pdf->Cell(25,3,'$'.number_format($intAcumTotalEstatus,$this->intNumDecimales), 0, 0, 'R');
            $pdf->Ln(8);//Deja un salto de línea

            //Hacer recorrido para obtener el resumen por cada tipo de moneda
			foreach ($otdMonedas as $arrMon) 
			{
				//Limpiar las siguientes variables (por cada moneda recorrida)
				$intAcumSubtotalEstatus = 0;
				$intAcumIvaEstatus = 0;
				$intAcumIepsEstatus = 0;
				$intAcumTotalEstatus = 0;

				//Asigna el tipo y tamaño de letra para la cabecera de la tabla
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Creación de la tabla Resumen
				$pdf->ClippedCell(125, 4, 'RESUMEN POR MONEDA '.$arrMon->descripcion, 0, 0, 'C', TRUE);
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
					if($arrSubtotalMoneda[$arrMon->moneda_id][$arrEst] > 0)
					{
					 	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						$pdf->Row(array($arrEst,
										'$'.number_format($arrSubtotalMoneda[$arrMon->moneda_id][$arrEst],$this->intNumDecimales), 
										'$'.number_format($arrIvaMoneda[$arrMon->moneda_id][$arrEst],$this->intNumDecimales), 
				    				    '$'.number_format($arrIepsMoneda[$arrMon->moneda_id][$arrEst],$this->intNumDecimales), 
				    				    '$'.number_format($arrTotalMoneda[$arrMon->moneda_id][$arrEst],$this->intNumDecimales)), 
										$arrAlineacionResumen);


						//Incrementar acumulados si el estatus es diferente de INACTIVO o RECHAZADO
						if($arrEst != 'INACTIVO' &&  $arrEst != 'RECHAZADO')
						{
							//Incrementar acumulados
							$intAcumSubtotalEstatus += $arrSubtotalMoneda[$arrMon->moneda_id][$arrEst];
							$intAcumIvaEstatus += $arrIvaMoneda[$arrMon->moneda_id][$arrEst];
							$intAcumIepsEstatus += $arrIepsMoneda[$arrMon->moneda_id][$arrEst];
							$intAcumTotalEstatus += $arrTotalMoneda[$arrMon->moneda_id][$arrEst];
						}

					}

				}

				//Asigna el tipo y tamaño de letra para los totales
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Escribir totales
		    	$pdf->Cell(12,3,'TOTALES: ', 0, 0, 'L');  
		    	//Total de registros
	            $pdf->Cell(13,3,$arrTotalRegistrosMoneda[$arrMon->moneda_id], 0, 0, 'R');
	            //Acumulado del subtotal
	            $pdf->Cell(25,3,'$'.number_format($intAcumSubtotalEstatus,$this->intNumDecimales), 0, 0, 'R');
	            //Acumulado del IVA
	            $pdf->Cell(25,3,'$'.number_format($intAcumIvaEstatus,$this->intNumDecimales), 0, 0, 'R');
	           //Acumulado del IEPS
	            $pdf->Cell(25,3,'$'.number_format($intAcumIepsEstatus,$this->intNumDecimales), 0, 0, 'R');
	            //Acumulado del importe total
	            $pdf->Cell(25,3,'$'.number_format($intAcumTotalEstatus,$this->intNumDecimales), 0, 0, 'R');
	            $pdf->Ln(8);//Deja un salto de línea
			}
		}
		//Ejecutar la salida del reporte
		$pdf->Output('ordenes_compra_especiales.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro($intOrdenCompraEspecialID =  NULL, $strEnviarCorreo = NULL) 
	{	            
		//Si el reporte no se enviara por correo electrónico
		if($strEnviarCorreo == NULL)
		{
			//Variables que se utilizan para recuperar los valores de la vista
			$intOrdenCompraEspecialID = $this->input->post('intOrdenCompraEspecialID');
		}

		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->ordenes->buscar($intOrdenCompraEspecialID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->ordenes->buscar_detalles($intOrdenCompraEspecialID);
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variable que se utiliza para asignar el acumulado del subtotal
		$intAcumSubtotal = 0;
		//Variable que se utiliza para asignar el acumulado del IVA
		$intAcumIva = 0;
		//Variable que se utiliza para asignar el acumulado del IEPS
		$intAcumIeps = 0;
		//Variable que se utiliza para asignar el acumulado de la retención de ISR (proveedor)
		$intRetencionIsrProv = 0;
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'orden_compra_especial_';
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
	        //---------- DATOS DEL PROVEEDOR
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 42);
			$pdf->ClippedCell(92, 3, 'PROVEEDOR', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0); //establece el color de texto
			//RFC
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, 46);
			$pdf->ClippedCell(10, 3, 'RFC');
			//Nombre comercial
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
			//Nombre comercial
			$pdf->SetXY(15, 52);
			$pdf->MultiCell(92, 3, utf8_decode($otdResultado->proveedor));
			//Teléfono
			$pdf->SetXY(92, 58);
			$pdf->ClippedCell(40, 3, $otdResultado->telefono_principal);
			//Variable que se utiliza para asignar el número interior
			$strNumInteriorProveedor = (($otdResultado->numero_interior !== NULL && 
						        	    empty($otdResultado->numero_interior) === FALSE) ?
	                                    ' INT. '.$otdResultado->numero_interior : '');
			//Concatenar datos para el domicilio
	    	$strDomicilioProveedor = $otdResultado->calle . ' NO.'.$otdResultado->numero_exterior.
	    							 $strNumInteriorProveedor.' COL. ' . $otdResultado->colonia.' C.P. '.
	    							 $otdResultado->codigo_postal.' '.$otdResultado->localidad. ', '. 
	    							 $otdResultado->municipio. ', '.$otdResultado->estado;

			//Domicilio
			$pdf->SetXY(15, 61);
			$pdf->MultiCell(92, 3, utf8_decode($strDomicilioProveedor));


			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DE LA ORDEN DE COMPRA
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(108, 42);
			$pdf->ClippedCell(92, 3, 'ORDEN DE COMPRA ESPECIAL', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0);//establece el color de texto
			//Folio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, 46);
			$pdf->ClippedCell(15, 3, 'FOLIO');
			//Fecha 
			$pdf->SetXY(154, 46);
			$pdf->ClippedCell(15, 3, 'FECHA');
			//Fecha de entrega
		    $pdf->SetXY(108, 49);
			$pdf->ClippedCell(30, 3, 'FECHA ENTREGA');
			//Fecha de vencimiento
		    $pdf->SetXY(154, 49);
			$pdf->ClippedCell(32, 3, 'FECHA VENCIMIENTO');
			//Moneda
			$pdf->SetXY(108, 52);
			$pdf->ClippedCell(15, 3, 'MONEDA');
			//Tipo de cambio
			$pdf->SetXY(154, 52);
			$pdf->ClippedCell(25, 3, 'TIPO DE CAMBIO');
			//Condiciones de pago
			$pdf->SetXY(108, 55);
			$pdf->ClippedCell(32, 3, 'CONDICIONES DE PAGO');
			//Factura
			$pdf->SetXY(154, 55);
			$pdf->ClippedCell(32, 3, 'FACTURA');
			//Estatus
			$pdf->SetXY(108, 58);
			$pdf->ClippedCell(32, 3, 'ESTATUS');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(135, 46);
			$pdf->ClippedCell(29, 3, $otdResultado->folio);
			//Fecha
			$pdf->SetXY(184, 46);
			$pdf->ClippedCell(29, 3, $otdResultado->fecha);
			//Fecha de entrega
			$pdf->SetXY(135, 49);
			$pdf->ClippedCell(30, 3, $otdResultado->fecha_entrega);
			//Fecha de vencimiento
			$pdf->SetXY(184, 49);
			$pdf->ClippedCell(30, 3, $otdResultado->fecha_vencimiento);
			//Moneda
			$pdf->SetXY(135, 52);
			$pdf->ClippedCell(29, 3, $otdResultado->codigo_moneda);
			//Tipo de cambio
			$pdf->SetXY(184, 52);
			$pdf->ClippedCell(20, 3, '$'.number_format($otdResultado->tipo_cambio, 4, '.', ','));
			//Condiciones de pago
			$pdf->SetXY(140, 55);
			$pdf->ClippedCell(60, 3, $otdResultado->condiciones_pago);
			//Factura
			$pdf->SetXY(184, 55);
			$pdf->ClippedCell(60, 3, $otdResultado->factura);
			//Estatus
			$pdf->SetXY(124, 58);
			$pdf->ClippedCell(60, 3, $otdResultado->estatus);

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DE LA ORDEN DE COMPRA
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 70);
			$pdf->ClippedCell(185, 3, 'CONCEPTOS', 0, 0, 'C', TRUE);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			
			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				//Tabla con los detalles de la orden de compra
				$pdf->SetXY(15, 74);
				//Crea los titulos de la cabecera
				$arrCabecera = array('Cantidad', utf8_decode('Descripción'), 'Gasto', 'Unitario', 
									  'Descuento', 'Importe');
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(15, 60, 35, 25, 25, 25);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('R', 'L', 'L', 'R', 'R', 'R');
				//Recorre el array de títulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchura[$intCont], 3, $arrCabecera[$intCont], 1, 0, 
							   $arrAlineacion[$intCont], TRUE);
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
					//Variables que se utilizan para asignar valores del detalle
					$intCantidad = $arrDet->cantidad;
					//Convertir peso mexicano a tipo de cambio
					$intPrecioUnitario = ($arrDet->precio_unitario / $otdResultado->tipo_cambio);
					$intDescuentoUnitario = ($arrDet->descuento_unitario / $otdResultado->tipo_cambio);
					$intIvaUnitario = ($arrDet->iva_unitario / $otdResultado->tipo_cambio);
					$intIepsUnitario = ($arrDet->ieps_unitario / $otdResultado->tipo_cambio);
					$intSubTotalUnitario = $intPrecioUnitario;
					//Variable que se utiliza para asignar el importe de IVA
					$intImporteIva = 0;
					//Variable que se utiliza para asignar el importe de IEPS
					$intImporteIeps = 0;

					//Si existe importe del descuento
					if($intDescuentoUnitario > 0)
					{
						$intPrecioUnitario = $intPrecioUnitario + $intDescuentoUnitario;
					}

					//Si existe importe de IVA unitario
					if($intIvaUnitario > 0)
					{
						//Calcular importe de IVA
					    $intImporteIva =  $intIvaUnitario * $intCantidad;
					}

					//Si existe importe de IEPS unitario
					if($intIepsUnitario > 0)
					{
						//Calcular importe de IEPS
					    $intImporteIeps =  $intIepsUnitario * $intCantidad;
					}

					//Calcular subtotal
					$intSubTotalUnitario = $intCantidad * $intSubTotalUnitario;
				
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(number_format($intCantidad,$this->intNumDecimalesCantidad), 
									utf8_decode($arrDet->concepto),  
									utf8_decode($arrDet->cuenta_nivel4), 
								    number_format($intPrecioUnitario, $this->intNumDecimalesPrecioUnitario), 
								    number_format($intDescuentoUnitario, $this->intNumDecimales), 
								    number_format($intSubTotalUnitario, $this->intNumDecimales)),  
								    $arrAlineacion, 'ClippedCell');

					//Incrementar acumulados
					$intAcumSubtotal += $intSubTotalUnitario;
					$intAcumIva += $intImporteIva;
					$intAcumIeps += $intImporteIeps;
				}

				//Asignar el importe retenido de ISR (proveedor)
				$intRetencionIsrProv = ($otdResultado->importe_retenido / $otdResultado->tipo_cambio);
				//Calcular importe total
				$intTotal = $intAcumSubtotal +$intAcumIva + $intAcumIeps;
				//Decrementar importe de la retención de ISR (proveedor)
				$intTotal -= $intRetencionIsrProv;
				//Redondear importe total a dos decimales
				$intTotal = number_format($intTotal,$this->intNumDecimales);

				$pdf->Ln(2); //Deja un salto de línea
				$pdf->SetX(15);
				//Cantidad con letra
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(60, 3, 'CANTIDAD CON LETRA');
				$pdf->Ln(); //Deja un salto de línea
				$pdf->SetX(15);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->MultiCell(185, 3, 'SON: (' .$AifLibNumber->toCurrency($intTotal, $otdResultado->codigo_moneda) . ')');
				$pdf->SetX(15);
				$pdf->ClippedCell(185, 3, '', 0, 0, 'C', TRUE);
				$pdf->Ln(); //Deja un salto de línea
				//Observaciones
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(15);
				$pdf->ClippedCell(30, 3, 'OBSERVACIONES');
				//Subtotal
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'SUBTOTAL');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumSubtotal, $this->intNumDecimales), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				$intPosYObs = $pdf->GetY();
				
				//Si existe retención de ISR (proveedor)
				if($intRetencionIsrProv > 0)
				{

					//Retención de ISR
					$pdf->SetX(135);
					//Asigna el tipo y tamaño de letra
				   $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->ClippedCell(40, 3, utf8_decode('RET. ISR').' '.$otdResultado->porcentaje_isr);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetX(175);
					$pdf->ClippedCell(25, 3, '$'.number_format($intRetencionIsrProv, $this->intNumDecimales), 0, 0, 'R');
					$pdf->Ln(); //Deja un salto de líneas
				}

				$intPosY = $pdf->GetY();
				//IVA
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(135, $intPosY);
				$pdf->ClippedCell(30, 3, 'IVA');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIva, $this->intNumDecimales), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				//IEPS
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'IEPS');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIeps,$this->intNumDecimales), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				//Total
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'TOTAL');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.$intTotal, 0, 0, 'R');
				//Observaciones
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(15, $intPosYObs);
				$pdf->MultiCell(110, 3, utf8_decode($otdResultado->observaciones));
				//Persona que solicito la orden de compra
	            $pdf->SetXY(15,260);
	            $pdf->Cell(90, 6, $otdResultado->solicita, 0, 0, 'C');
	            //Persona que autorizo la orden de compra
	            $pdf->SetXY(109, 260);
	            $pdf->Cell(90, 6, $otdResultado->usuario_autorizacion, 0, 0, 'C');
	            $pdf->Ln(5);//Espacios de salto de línea
	            $pdf->SetX(15);
	            //Persona que solicito la orden de compra
	            //Asigna el tipo y tamaño de letra
	            $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
	            $pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
	            $pdf->Cell(90, 3, 'SOLICITO', 0, 0, 'C',  TRUE);
	            //Persona que autorizo la orden de compra
	            $pdf->SetXY(109, 265);
	            $pdf->Cell(90, 3, 'AUTORIZO', 0, 0, 'C',  TRUE);
	            
	             //Fecha y hora de impresión (pie de pagina)
				$pdf->strUsuarioCreacion = $otdResultado->usuario_creacion;
				$pdf->dteFechaCreacion = $otdResultado->fecha_creacion;
				$pdf->strIncluirMembrete = 'SI';

			}//Cierre de verificación de detalles

			//Concatenar folio para identificar orden de compra
			$strNombreArchivo .= $otdResultado->folio;

		}//Cierre de verificación de información

		//Si la opción es enviar reporte por correo electrónico
		if($strEnviarCorreo == 'SI')
		{	
            //Definir ubicación de la carpeta
			$strCarpetaDestino =  $this->archivo['strCarpetaTemporal'].$intOrdenCompraEspecialID.'/'; 
			//Hacer un llamado a la función para guardar un archivo PDF 
			$strRuta = $this->guardar_archivo_pdf($pdf, $strCarpetaDestino, $strNombreArchivo);
			//Regresar la ruta del archivo
			return $strRuta;

		}
		else
		{
			//Ejecutar la salida del reporte
			$pdf->Output($strNombreArchivo.'.pdf','I'); 
		}
		
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProveedorID = $this->input->post('intProveedorID');
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
		$otdResultado = $this->ordenes->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProveedorID, 
											   $strEstatus, $strBusqueda);
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal != '')
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
			     ->setCellValue('A7', 'LISTADO DE ORDENES DE COMPRA ESPECIALES '.$strTituloRangoFechas);
		//Si existe id del proveedor
		if($intProveedorID > 0)
		{   //Seleccionar los datos del proveedor que coincide con el id
			$otdProveedor =  $this->proveedores->buscar($intProveedorID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'PROVEEDOR: '.$otdProveedor->codigo.' - '.$otdProveedor->razon_social);
		}
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'PROVEEDOR')
        		 ->setCellValue('C'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('D'.$intPosEncabezados, 'FACTURA')
        		 ->setCellValue('E'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('F'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('G'.$intPosEncabezados, 'IEPS')
        		 ->setCellValue('H'.$intPosEncabezados, 'TOTAL')
        		 ->setCellValue('I'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('J'.$intPosEncabezados, 'T.C.')
        		 ->setCellValue('K'.$intPosEncabezados, 'ENTREGA')
        		 ->setCellValue('L'.$intPosEncabezados, 'VENCIMIENTO')
        		 ->setCellValue('M'.$intPosEncabezados, 'CONDICIONES')
        		 ->setCellValue('N'.$intPosEncabezados, 'OBSERVACIONES')
                 ->setCellValue('O'.$intPosEncabezados, 'ESTATUS');

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
    			 ->getStyle('A10:O10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:O10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:O10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('P'.$intPosEncabezados, 'CANTIDAD')
			         ->setCellValue('Q'.$intPosEncabezados, 'CONCEPTO')
			         ->setCellValue('R'.$intPosEncabezados, 'TIPO DE GASTO')
			         ->setCellValue('S'.$intPosEncabezados, 'SUCURSAL')
			         ->setCellValue('T'.$intPosEncabezados, 'DEPARTAMENTO')
			         ->setCellValue('U'.$intPosEncabezados, 'GASTO')
			         ->setCellValue('V'.$intPosEncabezados,'PRECIO UNITARIO')
			         ->setCellValue('W'.$intPosEncabezados, 'SUBTOTAL');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('P'.$intPosEncabezados.':W'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('P'.$intPosEncabezados.':W'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('P'.$intPosEncabezados.':W'.$intPosEncabezados)
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
				//Asignar el importe retenido de ISR (proveedor)
				$intRetencionIsrProv =  ($arrCol->importe_retenido / $arrCol->tipo_cambio);

				//Seleccionar los detalles del registro
				$otdDetalles = $this->ordenes->buscar_detalles($arrCol->orden_compra_especial_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Hacer un llamado a la función para cambiar indices de las cuentas (en caso de que no exista la cuenta del nivel 3, es decir, donde la cuenta principal sea la 603)
					$otdDetalles = $this->get_detalles($otdDetalles);

					//Variable que se utiliza para contar el número de detalles
				    $intContDetOrd = 0;

				    //Si se cumple la sentencia mostrar detalles del registro
				    if($strDetalles == 'SI')
				    {
				    	//Asignar el número de detalles
				    	$intNumDetalles = count($otdDetalles);
				    }

					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Variables que se utilizan para asignar valores del detalle
						$intCantidad = $arrDet->cantidad;
						//Convertir peso mexicano a tipo de cambio
						$intPrecioUnitario = ($arrDet->precio_unitario / $arrCol->tipo_cambio);
						$intIvaUnitario = ($arrDet->iva_unitario / $arrCol->tipo_cambio);
						$intIepsUnitario = ($arrDet->ieps_unitario / $arrCol->tipo_cambio);
						//Variable que se utiliza para asignar el importe de IVA
						$intImporteIva = 0;
						//Variable que se utiliza para asignar el importe de IEPS
						$intImporteIeps = 0;

						//Si existe importe de IVA unitario
						if($intIvaUnitario > 0)
						{
							//Calcular importe de IVA
						    $intImporteIva =  $intIvaUnitario * $intCantidad;
						}

						//Si existe importe de IEPS unitario
						if($intIepsUnitario > 0)
						{
							//Calcular importe de IEPS
						    $intImporteIeps =  $intIepsUnitario * $intCantidad;
						}

						//Calcular subtotal
						$intSubTotalUnitario = $intCantidad * $intPrecioUnitario;

                        //Agregar datos al array
			        	$arrDetalles[$intContDetOrd]['cantidad'] = $intCantidad;
			        	$arrDetalles[$intContDetOrd]['concepto'] = $arrDet->concepto;
			        	$arrDetalles[$intContDetOrd]['cuenta_nivel1'] = $arrDet->cuenta_nivel1;
			        	$arrDetalles[$intContDetOrd]['cuenta_nivel2'] = $arrDet->cuenta_nivel2;
			        	$arrDetalles[$intContDetOrd]['cuenta_nivel3'] = $arrDet->cuenta_nivel3;
			        	$arrDetalles[$intContDetOrd]['cuenta_nivel4'] = $arrDet->cuenta_nivel4;
			        	$arrDetalles[$intContDetOrd]['precio_unitario'] = $intPrecioUnitario;
			        	$arrDetalles[$intContDetOrd]['subtotal'] = $intSubTotalUnitario;

                        //Incrementar acumulados
						$intAcumSubtotal += $intSubTotalUnitario;
						$intAcumIva += $intImporteIva;
						$intAcumIeps += $intImporteIeps;

						//Incrementar el contador por cada registro
	                    $intContDetOrd++;
					}

				}//Cierre de verificación de detalles

				//Decrementar importe de retención ISR (proveedor)
				$intAcumSubtotal -= $intRetencionIsrProv;
				
				//Calcular importe total
				$intTotal = $intAcumSubtotal +$intAcumIva + $intAcumIeps;


				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    {
			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('B'.$intFila, $arrCol->proveedor)
	                         ->setCellValue('C'.$intFila, $arrCol->fecha)
	                         ->setCellValue('D'.$intFila, $arrCol->factura)
	                         ->setCellValue('E'.$intFila, $intAcumSubtotal)
	                         ->setCellValue('F'.$intFila, $intAcumIva)
	                         ->setCellValue('G'.$intFila, $intAcumIeps)
	                         ->setCellValue('H'.$intFila, $intTotal)
	                         ->setCellValue('I'.$intFila, $arrCol->moneda)
	                         ->setCellValue('J'.$intFila, $arrCol->tipo_cambio)
	                         ->setCellValue('K'.$intFila, $arrCol->fecha_entrega)
	                         ->setCellValue('L'.$intFila, $arrCol->fecha_vencimiento)
	                         ->setCellValue('M'.$intFila, $arrCol->condiciones_pago)
	                         ->setCellValue('N'.$intFila, $arrCol->observaciones)
	                         ->setCellValue('O'.$intFila, $arrCol->estatus);

	                //Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
						 		 ->setCellValue('P'.$intFila, $arrDetalles[$intContDet]['cantidad'])
						         ->setCellValue('Q'.$intFila, $arrDetalles[$intContDet]['concepto'])
						         ->setCellValue('R'.$intFila, $arrDetalles[$intContDet]['cuenta_nivel1'])
						         ->setCellValue('S'.$intFila, $arrDetalles[$intContDet]['cuenta_nivel2'])
						         ->setCellValue('T'.$intFila, $arrDetalles[$intContDet]['cuenta_nivel3'])
						         ->setCellValue('U'.$intFila, $arrDetalles[$intContDet]['cuenta_nivel4'])
						         ->setCellValue('V'.$intFila, $arrDetalles[$intContDet]['precio_unitario'])
						         ->setCellValue('W'.$intFila, $arrDetalles[$intContDet]['subtotal']);
					}

	                //Incrementar el indice para escribir los datos del siguiente registro
                    $intFila++;
			    }

                //Incrementar el contador por cada registro
				$intContador++;
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('E'.$intFilaInicial.':'.'H'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

           	$objExcel->getActiveSheet()
            		 ->getStyle('V'.$intFilaInicial.':'.'W'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.0000');

			//Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.0000');

            //Cambiar contenido de las celdas a formato númerico de 2 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('P'.$intFilaInicial.':'.'P'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('###0.00');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

    		$objExcel->getActiveSheet()
		        	 ->getStyle('E'.$intFilaInicial.':'.'H'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);
                	 		 
			$objExcel->getActiveSheet()
                	 ->getStyle('O'.$intFilaInicial.':'.'O'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
		        	 ->getStyle('P'.$intFilaInicial.':'.'P'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
		        	 ->getStyle('V'.$intFilaInicial.':'.'W'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('O'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('O'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'ordenes_compra_especiales.xls', 'ordenes de compra', $intFila);
	}

}