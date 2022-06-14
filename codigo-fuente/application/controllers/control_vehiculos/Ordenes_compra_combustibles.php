<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes_compra_combustibles extends MY_Controller {

	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar ruta de la carpeta principal
	    $this->archivo['strCarpetaPrincipal'] = './archivos/';
	    //Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Asignar ruta de la carpeta destino
	    $this->archivo['strCarpetaDestino'] = './archivos/ordenes_compra_combustibles/';
		//Cargamos el modelo de ordenes de compra
		$this->load->model('control_vehiculos/ordenes_compra_combustibles_model', 'ordenes');
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
		$this->cargar_vista('control_vehiculos/ordenes_compra_combustibles', $arrDatos);
	}


	/*******************************************************************************************************************
	Funciones de la tabla ordenes_compra_combustibles
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
										 $this->input->post('strEstatus'),
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
			$arrDet->mostrarAccionAdjuntar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionVerArchivoRegistro = 'no-mostrar';
			$arrDet->mostrarAccionEliminarArchivoRegistro = 'no-mostrar';
			$arrDet->mostrarAccionAutorizar = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;

            //Asignar el id de la orden de compra
            $intOrdenCompraCombustibleID = $arrDet->orden_compra_combustible_id;
            //Concatenar id del registro que hace referencia a la carpeta donde se encuentra el archivo
			$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intOrdenCompraCombustibleID;

            //Asignar el nombre del archivo que le corresponde al registro
		    $strNombreArchivo = $this->get_verifar_archivo_registro($strNombreCarpeta, $intOrdenCompraCombustibleID);

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

			}
			else
			{
				
				//Si el usuario cuenta con el permiso de acceso VER REGISTRO
				if (in_array('VER REGISTRO', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Ver registro
	        		$arrDet->mostrarAccionVerRegistro = '';	
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
		$objOrdenCompra->intOrdenCompraCombustibleID = $this->input->post('intOrdenCompraCombustibleID');
		$objOrdenCompra->strFolioConsecutivo = $this->input->post('strFolioConsecutivo');
		$objOrdenCompra->dteFecha = $this->input->post('dteFecha');
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
		$objOrdenCompra->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objOrdenCompra->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los detalles
		$objOrdenCompra->strValeGasolinaID = $this->input->post('strValeGasolinaID');
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;
		
		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objOrdenCompra->intOrdenCompraCombustibleID))
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
				/*Quitar '_'  de la cadena (resultadoTransaccion_ordenCompraCombustibleID_folioConsecutivo) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $objOrdenCompra->intOrdenCompraCombustibleID, $objOrdenCompra->strFolioConsecutivo) = explode("_", $bolResultado); 
				
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
							 	  'orden_compra_combustible_id' => $objOrdenCompra->intOrdenCompraCombustibleID,
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

	///Método para regresar los datos de un registro
	public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intID = $this->input->post('intOrdenCompraCombustibleID');
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
			$otdDetalles = $this->ordenes->buscar_vales_gasolina($intID);
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
		$this->form_validation->set_rules('intOrdenCompraCombustibleID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intOrdenCompraCombustibleID');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->ordenes->set_estatus($intID);
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

	//Método para enviar la autorización (o el rechazo) de un registro
	public function set_enviar_autorizacion()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intOrdenCompraCombustibleID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intOrdenCompraCombustibleID');
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
		$intOrdenCompraCombustibleID = $_POST["intOrdenCompraCombustibleID_ordenes_compra_combustibles_control_vehiculos"];
		$strBotonArchivoID = $_FILES["archivo_varios_ordenes_compra_combustibles_control_vehiculos"];
		//Variable que se utiliza para asigar el nombre de los archivos que no se movieron a la carpeta
		$strArchivosNoMovidos = '';
		
		//Recuperar los archivos seleccionados
		if(isset($strBotonArchivoID))
		{
			//Definir ubicación de la carpeta principal
			$strCarpetaPrincipal = $this->archivo['strCarpetaPrincipal']; 
			//Si no existe la carpeta crearla
			if(!is_dir($strCarpetaPrincipal))
			{ 
				@mkdir($strCarpetaPrincipal, 0700); 
			}

		    //Asignar ubicación de la carpeta destino
			$strCarpetaDestino = $this->archivo['strCarpetaDestino'];
			//Si no existe la carpeta crearla
			if(!is_dir($strCarpetaDestino))
			{ 
				@mkdir($strCarpetaDestino, 0700); 
			} 

			//Definir ubicación de la carpeta
			$strNombreCarpeta = $strCarpetaDestino.$intOrdenCompraCombustibleID; 
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
					$strNombreArchivo = $intOrdenCompraCombustibleID.'.'.$strExtension;

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
    public function descargar_archivos($intOrdenCompraCombustibleID, $strFolio)
	{
		//Definir ubicación de la carpeta
		$strNombreCarpeta =  $this->archivo['strCarpetaDestino'].$intOrdenCompraCombustibleID;
		//Asignar nombre de la carpeta zip
		$strNombreCarpetaZIP = 'OCC_'.$strFolio.'.zip';
		//Verificar si la carpeta es un directorio 
        if (is_dir($strNombreCarpeta))
        {
        	//Comprimir contenido del directorio
        	$this->zip->read_dir($strNombreCarpeta, FALSE);
        	//Descargar carpeta zip
			$this->zip->download($strNombreCarpetaZIP);
        }
	}

	//Método para eliminar los archivos de un registro
	public function eliminar_carpeta_registro()
	{	
		//Variable que se utiliza para asignar el mensaje de error
		$strMensaje = '';
		//Variables que se utilizan para recuperar los valores de la vista 
		$intOrdenCompraCombustibleID = $this->input->post('intOrdenCompraCombustibleID');
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intOrdenCompraCombustibleID;

		//Verificar si la carpeta es un directorio 
        if (is_dir($strNombreCarpeta))
        {
        	//Hacer recorrido en la carpeta para obtener archivos
        	foreach(glob($strNombreCarpeta . "/*") as $arc)
			{      
				//Borrar fichero del servidor
				if (!unlink($arc))
				{
					$strMensaje .= 'No es posible eliminar archivo '.$arc.' ';
				}
				
			}

			//Borrar subcarpeta del servidor
			if (!rmdir($strNombreCarpeta))
			{
				$strMensaje .= 'No es posible eliminar carpeta '.$strNombreCarpeta;
			}
        	
        }

        //Si no existen errores al momento de eliminar la carpeta
        if($strMensaje != '')
        {
        	//Enviar el mensaje de error al formulario
			$arrDatos = array('resultado' => FALSE,
					          'tipo_mensaje' => TIPO_MSJ_ERROR,
			                  'mensaje' => 'Ocurrió un error al eliminar el archivo, vuelva a intentarlo. '.$strMensaje);
        }
        else
        {
        	//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE,
						 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
						      'mensaje' => 'El archivo se eliminó correctamente.');
        }

        //Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
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
		$arrEstatus = array('ACTIVO', 'AUTORIZADO', 'RECHAZADO', 'INACTIVO'); 
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
		$pdf->strLinea1 =  'LISTADO DE ORDENES DE COMPRA COMBUSTIBLES '.$strTituloRangoFechas;
		//Si existe id del proveedor
		if($intProveedorID > 0)
		{
			//Seleccionar los datos del proveedor que coincide con el id
			$otdProveedor =  $this->proveedores->buscar($intProveedorID);
			$pdf->strLinea2 =  'PROVEEDOR: '.utf8_decode($otdProveedor->codigo.' - '.$otdProveedor->razon_social);
		}

		
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'PROVEEDOR', 'FECHA', 'FACTURA',  'SUBTOTAL', 
								  'IVA', 'TOTAL', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(20, 55, 15, 20, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'L', 'R', 'R', 'R', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('L', 'L', 'L', 'L', 'L', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(20, 15, 20, 40, 35, 20);

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

				//Asignar el importe retenido de ISR (proveedor)
				$intRetencionIsrProv = ($arrCol->importe_retenido / $arrCol->tipo_cambio);


				//Seleccionar los detalles del registro
				$otdDetalles = $this->ordenes->buscar_vales_gasolina($arrCol->orden_compra_combustible_id);
				
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
				
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Convertir peso mexicano a tipo de cambio
						$intSubTotalUnitario = ($arrDet->subtotal / $arrCol->tipo_cambio);
						$intImporteIva = ($arrDet->iva / $arrCol->tipo_cambio);

						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["folio"] = $arrDet->folio;
						$arrAuxiliar["fecha"] = $arrDet->fecha;
						$arrAuxiliar["factura"] = $arrDet->factura;
						$arrAuxiliar["vehiculo"] = utf8_decode($arrDet->vehiculo);
						$arrAuxiliar["empleado"] = utf8_decode($arrDet->empleado);
		                $arrAuxiliar["subtotal"] = '$'.number_format($intSubTotalUnitario,2);
		                //Asignar datos al array
                        array_push($arrDetalles, $arrAuxiliar); 

                        //Incrementar acumulados
						$intAcumSubtotal += $intSubTotalUnitario;
						$intAcumIva += $intImporteIva;
					}

				}//Cierre de verificación de detalles

				//Decrementar importe de retención ISR (proveedor)
				$intAcumSubtotal -= $intRetencionIsrProv;
				
				//Calcular importe total
				$intTotal = $intAcumSubtotal + $intAcumIva;
			
				//Incrementar valores de los siguientes arrays
				$arrSubtotalEstatus[$arrCol->estatus] += ($intAcumSubtotal * $arrCol->tipo_cambio);
		      	$arrIvaEstatus[$arrCol->estatus] += ($intAcumIva * $arrCol->tipo_cambio);
		      	$arrTotalEstatus[$arrCol->estatus] += ($intTotal* $arrCol->tipo_cambio);

		      	//Si el id de la moneda no corresponde al peso mexicano
		      	if($arrCol->moneda_id != MONEDA_BASE)
		      	{
		      		//Incrementar valores de los siguientes arrays
			      	$arrSubtotalMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intAcumSubtotal;
			      	$arrIvaMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intAcumIva;
			        $arrTotalMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intTotal;
			      	$arrTotalRegistrosMoneda[$arrCol->moneda_id] += 1;
		      	}
					
				//Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, utf8_decode($arrCol->proveedor), $arrCol->fecha,  
								$arrCol->factura, 
								'$'.number_format($intAcumSubtotal,2),
								'$'.number_format($intAcumIva,2),
								'$'.number_format($intTotal,2), $arrCol->estatus), 
								$pdf->arrAlineacion, 'ClippedCell');
		        
		        //Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
				//Moneda
				$pdf->Cell(12, 4, 'MONEDA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(7, 4, utf8_decode($arrCol->codigo_moneda), 0, 0, 'L', 0);
		    	//Tipo de cambio
		    	$pdf->Cell(6, 4, 'T.C.:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(12, 4,'$'.number_format($arrCol->tipo_cambio, 4, '.', ','), 0, 0, 'R', 0);
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
					
					//Recorremos el arreglo 
			        foreach ($arrDetalles as $arrDet) 
			        {
			        	//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraDetalles);
					    
					    //Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array($arrDet['folio'], $arrDet['fecha'], 
					    				$arrDet['factura'], $arrDet['vehiculo'],  
					    				$arrDet['empleado'], $arrDet['subtotal']), 
					    			   $arrAlineacionDetalles, 'ClippedCell');
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
			$arrCabeceraResumen = array('ESTATUS', 'SUBTOTAL', 'IVA',  'TOTAL');
			//Establece el ancho de las columnas de cabecera
			$arrAnchuraResumen = array(25, 25, 25, 25);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacionResumen = array('L', 'R', 'R', 'R');
			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Creación de la tabla Resumen
			$pdf->Cell(100, 4, 'RESUMEN GENERAL EN PESOS', 0, 0, 'C', TRUE);
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
				 	//Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($arrEst,
									'$'.number_format($arrSubtotalEstatus[$arrEst],2), 
									'$'.number_format($arrIvaEstatus[$arrEst],2), 
			    				    '$'.number_format($arrTotalEstatus[$arrEst],2)), 
									 $arrAlineacionResumen);

					//Incrementar acumulados si el estatus es diferente de INACTIVO o RECHAZADO
					if($arrEst != 'INACTIVO' &&  $arrEst != 'RECHAZADO')
					{
						//Incrementar acumulados
						$intAcumSubtotalEstatus += $arrSubtotalEstatus[$arrEst];
						$intAcumIvaEstatus += $arrIvaEstatus[$arrEst];
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
            $pdf->Cell(25,3,'$'.number_format($intAcumSubtotalEstatus,2), 0, 0, 'R');
            //Acumulado del IVA
            $pdf->Cell(25,3,'$'.number_format($intAcumIvaEstatus,2), 0, 0, 'R');
            //Acumulado del importe total
            $pdf->Cell(25,3,'$'.number_format($intAcumTotalEstatus,2), 0, 0, 'R');
            $pdf->Ln(8);//Deja un salto de línea

            //Hacer recorrido para obtener el resumen por cada tipo de moneda
			foreach ($otdMonedas as $arrMon) 
			{
				//Limpiar las siguientes variables (por cada moneda recorrida)
				$intAcumSubtotalEstatus = 0;
				$intAcumIvaEstatus = 0;
				$intAcumTotalEstatus = 0;

				//Asigna el tipo y tamaño de letra para la cabecera de la tabla
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Creación de la tabla Resumen
				$pdf->ClippedCell(100, 4, 'RESUMEN POR MONEDA '.$arrMon->descripcion, 0, 0, 'C', TRUE);
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
					 	//Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
						$pdf->Row(array($arrEst,
										'$'.number_format($arrSubtotalMoneda[$arrMon->moneda_id][$arrEst],2), 
										'$'.number_format($arrIvaMoneda[$arrMon->moneda_id][$arrEst],2), 
				    				    '$'.number_format($arrTotalMoneda[$arrMon->moneda_id][$arrEst],2)), 
										$arrAlineacionResumen);


						//Incrementar acumulados si el estatus es diferente de INACTIVO o RECHAZADO
						if($arrEst != 'INACTIVO' &&  $arrEst != 'RECHAZADO')
						{
							//Incrementar acumulados
							$intAcumSubtotalEstatus += $arrSubtotalMoneda[$arrMon->moneda_id][$arrEst];
							$intAcumIvaEstatus += $arrIvaMoneda[$arrMon->moneda_id][$arrEst];
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
	            $pdf->Cell(25,3,'$'.number_format($intAcumSubtotalEstatus,2), 0, 0, 'R');
	            //Acumulado del IVA
	            $pdf->Cell(25,3,'$'.number_format($intAcumIvaEstatus,2), 0, 0, 'R');
	            //Acumulado del importe total
	            $pdf->Cell(25,3,'$'.number_format($intAcumTotalEstatus,2), 0, 0, 'R');
	            $pdf->Ln(8);//Deja un salto de línea
			}
		}
		//Ejecutar la salida del reporte
		$pdf->Output('ordenes_compra_combustibles.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro() 
	{	 
		//Variables que se utilizan para recuperar los valores de la vista
		$intOrdenCompraCombustibleID = $this->input->post('intOrdenCompraCombustibleID');
		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->ordenes->buscar($intOrdenCompraCombustibleID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->ordenes->buscar_vales_gasolina($intOrdenCompraCombustibleID);
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
		//Variable que se utiliza para asignar el acumulado de la retención de ISR (proveedor)
		$intRetencionIsrProv = 0;
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'orden_compra_combustibles_';
		//Establece el ancho de las columnas de cabecera de la tabla tasas de IEPS
		$arrAnchuraTasasIeps = array(10, 15, 20);
		//Establece la alineación de las celdas de la tabla tasas de IEPS
		$arrAlineacionTasasIeps = array('L', 'L', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
		$this->get_encabezado_archivo_pdf($pdf);

		//Verificar si hay información del registro
		if($otdResultado)
		{	
			//Hacer un llamado a la función para mostrar imagen del estatus (INACTIVO/TIMBRAR)
			$this->get_img_estatus_archivo_pdf($pdf, $otdResultado->estatus);

			//Variable que se utiliza para asignar el tipo de cambio
			$intTipoCambio = $otdResultado->tipo_cambio;


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
			$pdf->ClippedCell(92, 3, 'ORDEN DE COMPRA COMBUSTIBLES', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0);//establece el color de texto
			//Folio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, 46);
			$pdf->ClippedCell(15, 3, 'FOLIO');
			//Fecha 
			$pdf->SetXY(154, 46);
			$pdf->ClippedCell(15, 3, 'FECHA');
			//Fecha de vencimiento
		    $pdf->SetXY(108, 49);
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
			$pdf->SetXY(124, 46);
			$pdf->ClippedCell(76, 3, $otdResultado->folio);
			//Fecha
			$pdf->SetXY(184, 46);
			$pdf->ClippedCell(29, 3, $otdResultado->fecha);
			//Fecha de vencimiento
			$pdf->SetXY(138, 49);
			$pdf->ClippedCell(30, 3, $otdResultado->fecha_vencimiento);
			//Moneda
			$pdf->SetXY(124, 52);
			$pdf->ClippedCell(29, 3, $otdResultado->codigo_moneda);
			//Tipo de cambio
			$pdf->SetXY(184, 52);
			$pdf->ClippedCell(20, 3, '$'.number_format($otdResultado->tipo_cambio, 4, '.', ','));
			//Condiciones de pago
			$pdf->SetXY(140, 55);
			$pdf->ClippedCell(60, 3, $otdResultado->condiciones_pago);
			//Factura
			$pdf->SetXY(183, 55);
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
				$arrCabecera = array('Folio', 'Fecha', 'Factura', utf8_decode('Vehículo'), 
									 'Empleado', 'Subtotal', 'IVA');
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(20, 20, 20, 40, 45, 20, 20);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'L', 'L', 'L', 'R', 'R');

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

					//Variables que se utilizan para asignar valores del detalle
					$intSubTotalUnitarioPesos = $arrDet->subtotal;
					$intImporteIvaPesos = $arrDet->iva;

					//Convertir peso mexicano a tipo de cambio
					$intSubTotalUnitario = ($arrDet->subtotal / $otdResultado->tipo_cambio);
					$intImporteIva = ($arrDet->iva / $otdResultado->tipo_cambio);
					

					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($arrDet->folio, $arrDet->fecha, $arrDet->factura,
									utf8_decode($arrDet->vehiculo),
									utf8_decode($arrDet->empleado), 
								    number_format($intSubTotalUnitarioPesos,2), 
									number_format($intImporteIvaPesos,2)), 
									$arrAlineacion, 'ClippedCell');

					//Incrementar acumulados
					$intAcumSubtotal += $intSubTotalUnitario;
					$intAcumIva += $intImporteIva;
				}

				//Asignar el importe retenido de ISR (proveedor)
				$intRetencionIsrProv = ($otdResultado->importe_retenido / $otdResultado->tipo_cambio);

				//Calcular importe total
				$intTotal = $intAcumSubtotal +$intAcumIva;
				//Decrementar importe de la retención de ISR (proveedor)
				$intTotal -= $intRetencionIsrProv;
				//Redondear importe total a dos decimales
				$intTotalFormat = number_format($intTotal,2);

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
				$pdf->MultiCell(185, 3, 'SON: (' .$AifLibNumber->toCurrency($intTotalFormat, $otdResultado->codigo_moneda) . ')');	
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
			    //Si el id de la moneda no corresponde al peso mexicano
				if($otdResultado->moneda_id != MONEDA_BASE)
				{
					//Subtotal de la moneda extranjera (convertido al tipo de cambio)
					$pdf->SetX(158);
					$pdf->ClippedCell(20, 3, '$'.number_format($intAcumSubtotal,2), 0, 0, 'R');
				}

				//Convertir subtotal a peso mexicano
				$intAcumSubtotalPesos = $intAcumSubtotal * $intTipoCambio;
				//Subtotal en pesos mexicanos
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumSubtotalPesos,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				$intPosYObs = $pdf->GetY();

				//Si existe retención de ISR (proveedor)
				if($intRetencionIsrProv > 0)
				{

					//Retención de ISR
					$pdf->SetX(135);
					//Asigna el tipo y tamaño de letra
				    $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->ClippedCell(25, 3, utf8_decode('RET. ISR').' '.$otdResultado->porcentaje_isr);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);

					//Si el id de la moneda no corresponde al peso mexicano
					if($otdResultado->moneda_id != MONEDA_BASE)
					{
						//Retención ISR de la moneda extranjera (convertido al tipo de cambio)
						$pdf->SetX(158);
						$pdf->ClippedCell(20, 3, '$'.number_format($intRetencionIsrProv, 2), 0, 0, 'R');
					}
					

					//Convertir retención ISR a peso mexicano
					$intRetencionIsrProvPesos = $intRetencionIsrProv * $intTipoCambio;

					//Retención ISR en pesos mexicanos
					$pdf->SetX(175);
					$pdf->ClippedCell(25, 3, '$'.number_format($intRetencionIsrProvPesos,2), 0, 0, 'R');
					$pdf->Ln(); //Deja un salto de línea
				}

				$intPosY = $pdf->GetY();


				//IVA
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(135, $intPosY);
				$pdf->ClippedCell(30, 3, 'IVA');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Si el id de la moneda no corresponde al peso mexicano
				if($otdResultado->moneda_id != MONEDA_BASE)
				{
					//IVA de la moneda extranjera (convertido al tipo de cambio)
					$pdf->SetX(158);
					$pdf->ClippedCell(20, 3, '$'.number_format($intAcumIva,2), 0, 0, 'R');
				}

				//Convertir IVA a peso mexicano
				$intAcumIvaPesos = $intAcumIva * $intTipoCambio;
				//IVA en pesos mexicanos
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIvaPesos,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea

				//Total
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'TOTAL');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Si el id de la moneda no corresponde al peso mexicano
				if($otdResultado->moneda_id != MONEDA_BASE)
				{
					//Total de la moneda extranjera (convertido al tipo de cambio)
					$pdf->SetX(158);
					$pdf->ClippedCell(20, 3, '$'.number_format($intTotal,2), 0, 0, 'R');
				}

				//Convertir total a peso mexicano
				$intTotalPesos = $intTotal * $intTipoCambio;
				//Total  en pesos mexicanos
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intTotalPesos,2), 0, 0, 'R');

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
			     ->setCellValue('A7', 'LISTADO DE ORDENES DE COMPRA COMBUSTIBLES '.$strTituloRangoFechas);
		//Si existe id del proveedor
		if($intProveedorID > 0)
		{   //Seleccionar los datos del empleado que coincide con el id
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
        		 ->setCellValue('G'.$intPosEncabezados, 'TOTAL')
        		 ->setCellValue('H'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('I'.$intPosEncabezados, 'T.C.')
        		 ->setCellValue('J'.$intPosEncabezados, 'VENCIMIENTO')
        		 ->setCellValue('K'.$intPosEncabezados, 'CONDICIONES')
        		 ->setCellValue('L'.$intPosEncabezados, 'SOLICITA')
        		 ->setCellValue('M'.$intPosEncabezados, 'OBSERVACIONES')
                 ->setCellValue('N'.$intPosEncabezados, 'ESTATUS');

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
    			 ->getStyle('A10:N10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:N10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:N10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	//Se agregan las columnas de cabecera
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('O'.$intPosEncabezados, 'FOLIO')
                     ->setCellValue('P'.$intPosEncabezados, 'FECHA')
	        		 ->setCellValue('Q'.$intPosEncabezados, 'FACTURA')
	        		 ->setCellValue('R'.$intPosEncabezados, 'VEHÍCULO')
	        		 ->setCellValue('S'.$intPosEncabezados, 'EMPLEADO')
	        		 ->setCellValue('T'.$intPosEncabezados, 'SUBTOTAL');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('O'.$intPosEncabezados.':T'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('O'.$intPosEncabezados.':T'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('O'.$intPosEncabezados.':T'.$intPosEncabezados)
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

				//Asignar el importe retenido de ISR (proveedor)
				$intRetencionIsrProv =  ($arrCol->importe_retenido / $arrCol->tipo_cambio);

				//Seleccionar los detalles de la orden de compra
	    		$otdDetalles = $this->ordenes->buscar_vales_gasolina($arrCol->orden_compra_combustible_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
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
						
						//Convertir peso mexicano a tipo de cambio
						$intSubTotalUnitario = ($arrDet->subtotal / $arrCol->tipo_cambio);
						$intImporteIva = ($arrDet->iva / $arrCol->tipo_cambio);
						
                        //Agregar datos al array
                        $arrDetalles[$intContDetOrd]['folio'] = $arrDet->folio;
                        $arrDetalles[$intContDetOrd]['fecha'] = $arrDet->fecha;
			        	$arrDetalles[$intContDetOrd]['factura'] = $arrDet->factura;
			        	$arrDetalles[$intContDetOrd]['vehiculo'] = $arrDet->vehiculo;
			        	$arrDetalles[$intContDetOrd]['empleado'] = $arrDet->empleado;
			        	$arrDetalles[$intContDetOrd]['subtotal'] = $intSubTotalUnitario;

                     	//Incrementar acumulados
						$intAcumSubtotal += $intSubTotalUnitario;
						$intAcumIva += $intImporteIva;

						//Incrementar el contador por cada registro
	                    $intContDetOrd++;
					}

				}//Cierre de verificación de detalles

				//Decrementar importe de retención ISR (proveedor)
				$intAcumSubtotal -= $intRetencionIsrProv;

				//Calcular importe total
				$intTotal = $intAcumSubtotal + $intAcumIva;


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
	                         ->setCellValue('G'.$intFila, $intTotal)
	                         ->setCellValue('H'.$intFila, $arrCol->moneda)
	                         ->setCellValue('I'.$intFila, $arrCol->tipo_cambio)
	                         ->setCellValue('J'.$intFila, $arrCol->fecha_vencimiento)
	                         ->setCellValue('K'.$intFila, $arrCol->condiciones_pago)
	                         ->setCellValue('L'.$intFila, $arrCol->solicita)
	                         ->setCellValue('M'.$intFila, $arrCol->observaciones)
	                         ->setCellValue('N'.$intFila, $arrCol->estatus);

			        //Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
								 ->setCellValueExplicit('O'.$intFila, $arrDetalles[$intContDet]['folio'], PHPExcel_Cell_DataType::TYPE_STRING)
						 		 ->setCellValue('P'.$intFila, $arrDetalles[$intContDet]['fecha'])
				        		 ->setCellValue('Q'.$intFila, $arrDetalles[$intContDet]['factura'])
				        		 ->setCellValue('R'.$intFila, $arrDetalles[$intContDet]['vehiculo'])
				        		 ->setCellValue('S'.$intFila, $arrDetalles[$intContDet]['empleado'])
				        		 ->setCellValue('T'.$intFila, $arrDetalles[$intContDet]['subtotal']);
					}

	                //Incrementar el indice para escribir los datos del siguiente registro
                    $intFila++;
			    }

                //Incrementar el contador por cada registro
				$intContador++;
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('E'.$intFilaInicial.':'.'G'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            $objExcel->getActiveSheet()
            		 ->getStyle('T'.$intFilaInicial.':'.'T'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.00');

            //Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('I'.$intFilaInicial.':'.'I'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.0000');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

    		$objExcel->getActiveSheet()
		        	 ->getStyle('E'.$intFilaInicial.':'.'G'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('I'.$intFilaInicial.':'.'I'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		    $objExcel->getActiveSheet()
                	 ->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

		    $objExcel->getActiveSheet()
                	 ->getStyle('N'.$intFilaInicial.':'.'N'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('P'.$intFilaInicial.':'.'P'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('T'.$intFilaInicial.':'.'T'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);


			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('N'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('N'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'ordenes_compra_combustibles.xls', 'ordenes de compra', $intFila);
	}


	/*******************************************************************************************************************
	Funciones de los vales de gasolina por pagar 
	*********************************************************************************************************************/
	//Método para regresar los vales de gasolina del proveedor
	public function get_vales_gasolina()
	{

		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('rows' => NULL, 
						  'acumulado_subtotal' => '$0.00',
						  'acumulado_iva' => '$0.00', 
						  'acumulado_total' => '$0.00');
		
		//Variables que se utilizan para recuperar los valores de la vista 
		$intProveedorID = $this->input->post('intProveedorID');
		$intMonedaIDOrden = $this->input->post('intMonedaIDOrden');
		$intTipoCambioOrden = $this->input->post('intTipoCambioOrden');
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strBusqueda = trim($this->input->post('strBusqueda'));
		
		//Array que se utiliza para agregar los vales de gasolina pendientes por pagar
        $arrValesGasolina = array();
        //Array que se utiliza para agregar los datos de un vale de gasolina
        $arrAuxiliar = array();
        //Variable que se utiliza para asignar el acumulado del subtotal
		$intAcumSubtotal = 0;
		//Variable que se utiliza para asignar el acumulado del IVA
		$intAcumIva = 0;
        //Variable que se utiliza para asignar el acumulado del importe total
	    $intAcumTotal = 0;

		//Seleccionar los datos de los vales de gasolina que coinciden con el parámetro enviado
		$otdResultado = $this->ordenes->buscar_vales_gasolina(NULL, $intProveedorID, $dteFechaInicial, 
															  $dteFechaFinal, $strBusqueda);
		
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Hacer recorrido para obtener vales de gasolina
			foreach ($otdResultado as $arrCol)
			{

				//Variables que se utilizan para asignar valores del vale de gasolina
				$intMonedaID =  $arrCol->moneda_id;
				$intTipoCambio =  $arrCol->tipo_cambio;

			    //Variable que se utiliza para asignar el importe del vale de gasolina (correspondiente a la moneda de la orden de compra)
			    $intSubtotalAux = number_format($arrCol->subtotal, 2, '.', '');
			    $intIvaAux = number_format($arrCol->iva, 2, '.', '');
			    $intTotalAux = number_format($arrCol->total, 2, '.', '');

			   //Si el tipo de moneda del vale de gasolina a es diferente a la moneda de la orden de compra
				if($intMonedaID !== $intMonedaIDOrden)
				{
					//Convertir importe a peso mexicano
					$intSubtotalAux = $intSubtotalAux *  $intTipoCambio;
					$intIvaAux = $intIvaAux *  $intTipoCambio;
					$intTotalAux = $intTotalAux *  $intTipoCambio;

					//Si el tipo de moneda de la orden de compra corresponde a peso mexicano
				    if($intMonedaID == MONEDA_BASE)
					{
						//Convertir peso mexicano a tipo de cambio
						$intSubtotalAux = $intSubtotalAux / $intTipoCambioOrden;
						$intIvaAux = $intIvaAux / $intTipoCambioOrden;
						$intTotalAux = $intTotalAux / $intTipoCambioOrden;
					}
				}


	            //Definir valores del array auxiliar de información (para cada vale de gasolina)
				$arrAuxiliar["vale_gasolina_id"] = $arrCol->vale_gasolina_id;
				$arrAuxiliar["folio"] = $arrCol->folio;
				$arrAuxiliar["fecha"] = $arrCol->fecha;
				$arrAuxiliar["factura"] = $arrCol->factura;
				$arrAuxiliar["vehiculo"] = $arrCol->vehiculo;
				$arrAuxiliar["empleado"] = $arrCol->empleado;
				$arrAuxiliar["moneda_id"] =  $intMonedaID;
				$arrAuxiliar["moneda_tipo"] = $arrCol->moneda_tipo;
				$arrAuxiliar["tipo_cambio"] = $intTipoCambio;
				$arrAuxiliar["subtotal"] = number_format($arrCol->subtotal,2);
				$arrAuxiliar["iva"] = number_format($arrCol->iva,2);
				$arrAuxiliar["total"] = number_format($arrCol->total,2);
				//Asignar datos al array
                array_push($arrValesGasolina, $arrAuxiliar); 

                //Incrementar acumulado del importe
				$intAcumSubtotal += $intSubtotalAux;
				$intAcumIva += $intIvaAux;
				$intAcumTotal += $intTotalAux;
			}


			$arrDatos['rows'] = $arrValesGasolina;
			//Convertir cantidad a formato moneda
			$arrDatos['acumulado_subtotal'] = '$'.number_format($intAcumSubtotal,2);
			$arrDatos['acumulado_iva'] = '$'.number_format($intAcumIva,2);
			$arrDatos['acumulado_total'] = '$'.number_format($intAcumTotal,2);


		}//Cierre de verificación de información

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}
	
}