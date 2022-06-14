<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cajas_vales extends MY_Controller {
	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar ruta de la carpeta principal
	    $this->archivo['strCarpetaPrincipal'] = './archivos/';
		//Asignar ruta de la carpeta destino
	    $this->archivo['strCarpetaDestino'] = './archivos/vales_caja_chica/';
		//Cargamos el modelo
		$this->load->model('caja/cajas_vales_model', 'vales');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('caja/cajas_vales', $arrDatos);
	}

	/*******************************************************************************************************************
	Funciones de la tabla cajas_vales
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->vales->filtro($this->input->post('dteFechaInicial'),
									   $this->input->post('dteFechaFinal'),
									   $this->input->post('strTipoReferencia'),
									   $this->input->post('intReferenciaID'),
									   $this->input->post('intSucursalGastoID'),
									   $this->input->post('strEstatus'),
									   trim($this->input->post('strBusqueda')),
		                               $config['per_page'],
		                               $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['vales'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionFinalizar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionVerArchivoRegistro = 'no-mostrar';
			$arrDet->mostrarAccionAutorizar = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = '';

            //Concatenar id del registro que hace referencia a la carpeta donde se encuentran los archivos (de los detalles)
			$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$arrDet->caja_vale_id;

			//Asignar el total de archivos que contiene la carpeta del registro
			$intTotalArchivos = $this->get_total_archivos_registro($strNombreCarpeta);
		
            //Si no existe id del corte de caja
			if($arrDet->caja_corte_id == 0)
			{
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
						//Si el estatus del registro es AUTORIZADO
						if($arrDet->estatus == 'AUTORIZADO' && $arrDet->total_detalles > 0)
						{
							//Asignar cadena vacia para mostrar botón Finalizar
							$arrDet->mostrarAccionFinalizar = '';
						}

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

			//Si existen archivos del registro 
			if($intTotalArchivos > 0)
    		{
    			//Si el usuario cuenta con el permiso de acceso VER REGISTRO
				if (in_array('VER REGISTRO', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Ver archivo del registro
	        		$arrDet->mostrarAccionVerArchivoRegistro = '';
	        	}
    		}

			$arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;
			
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['vales'],
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
		$objCajaVale = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objCajaVale->intCajaValeID = $this->input->post('intCajaValeID');
		$objCajaVale->strFolioConsecutivo = $this->input->post('strFolioConsecutivo');
		$objCajaVale->dteFecha = $this->input->post('dteFecha');
		$objCajaVale->strTipoVale = $this->input->post('strTipoVale');
		//Si no existe id de la cuenta bancaria asignar valor nulo
		$objCajaVale->intCuentaBancariaID = ($this->input->post('intCuentaBancariaID') == ''? 
											 NULL :$this->input->post('intCuentaBancariaID'));
		$objCajaVale->strTipoReferencia = $this->input->post('strTipoReferencia');
		$objCajaVale->intReferenciaID = $this->input->post('intReferenciaID');
		$objCajaVale->intSucursalGasto = $this->input->post('intSucursalGasto');
		$objCajaVale->intDepartamentoID = $this->input->post('intDepartamentoID');
		$objCajaVale->strConcepto = mb_strtoupper(trim($this->input->post('strConcepto')));
		$objCajaVale->intImporte = $this->input->post('intImporte');
		$objCajaVale->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objCajaVale->intSucursalID = $this->session->userdata('sucursal_id');
		$objCajaVale->intUsuarioID = $this->session->userdata('usuario_id');
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objCajaVale->intCajaValeID))
		{
			$bolResultado = $this->vales->modificar($objCajaVale);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objCajaVale->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objCajaVale->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				
				$bolResultado = $this->vales->guardar($objCajaVale);

				/*Quitar '_'  de la cadena (resultadoTransaccion_cajaValeID_folioConsecutivo) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $objCajaVale->intCajaValeID, $objCajaVale->strFolioConsecutivo) = explode("_", $bolResultado); 
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
							 	  'caja_vale_id' => $objCajaVale->intCajaValeID,
							 	  'folio' => $objCajaVale->strFolioConsecutivo,
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
		$intID = $this->input->post('intCajaValeID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->vales->buscar($intID);
		//Concatenar id del registro que hace referencia a la carpeta donde se encuentran los archivos (de los detalles)
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intID;
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{	
			$arrDatos['row'] = $otdResultado;

			//Seleccionar los detalles del registro
			$otdDetalles = $this->vales->buscar_detalles($intID);

			//Si existen detalles del registro, se asignan al array
			if($otdDetalles)
			{
				//Hacer recorrido para verificar si el detalle tiene archivos
				foreach ($otdDetalles as $arrDet)
				{
				    //Concatenar renglón que hace referencia a la carpeta donde se encuentra el archivo
					$strNombreSubCarpeta = $strNombreCarpeta.'/'.$arrDet->renglon;

		            //Asignar cadena con los nombres de los archivos
		            $arrDet->archivos = $this->get_verifar_archivo_registro($strNombreSubCarpeta);
				}

				//Asignar el total de archivos que contiene la carpeta del registro
				$arrDatos['total_archivos'] = $this->get_total_archivos_registro($strNombreCarpeta);
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
		$this->form_validation->set_rules('intCajaValeID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intCajaValeID');
		    $strEstatus = $this->input->post('strEstatus');
		    //Si el estatus es diferente de CERRADO
		    if($strEstatus != 'CERRADO')
		    {
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
		    }
		    
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->vales->set_estatus($intID, $strEstatus);
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

	//Método para descargar archivos de un registro
    public function descargar_archivos($intCajaValeID, $strFolio)
	{

		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intCajaValeID;
		//Asignar nombre de la carpeta zip
		$strNombreCarpetaZIP = 'CV_'.$strFolio.'.zip';
		//Verificar si la carpeta es un directorio 
        if (is_dir($strNombreCarpeta))
        {
        	//Comprimir contenido del directorio
        	$this->zip->read_dir($strNombreCarpeta, FALSE);
        	//Descargar carpeta zip
			$this->zip->download($strNombreCarpetaZIP);
        }
	}

	//Método para enviar la autorización (o el rechazo) de un registro
	public function set_enviar_autorizacion()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intCajaValeID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intCajaValeID');
	        $strUsuarios = $this->input->post('strUsuarios');
	        $strMensaje = trim($this->input->post('strMensaje'));
	        //Si el tipo de acción corresponde a Guardar asignar valor nulo
			$strEstatus = (($this->input->post('strTipoAccion') === 'Guardar') ? 
							NULL : $this->input->post('strEstatus'));

	        //Hacer un llamado al método para autorizar o rechazar los datos de un registro
			$bolResultado = $this->vales->set_enviar_autorizacion($intID, $strUsuarios, $strMensaje, $strEstatus);
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
		$strTipo = $this->input->post('strTipo');
		$intEmpleadoID = $this->input->post('intEmpleadoID');

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->vales->autocomplete($strDescripcion, $strTipo, $intEmpleadoID);
			//Si se obtienen coincidencias	
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	//Si el Autocomplete es por referencias (empleados y proveedores)
					if($strTipo == 'referencias')
					{
						$arrDatos[] = array('value'=>$arrCol->referencia, 
											'data'=>$arrCol->referencia_id, 
		        							'tipo_referencia' =>$arrCol->tipo_referencia);
					}
					else
					{
						$arrDatos[] = array('value'=>$arrCol->descripcion, 
											'data'=>$arrCol->caja_vale_id, 
		        							'saldo' =>$arrCol->saldo);
					}
				}
	    	}

	    	//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}


	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $strTipoReferencia, $intReferenciaID,
						   		$intSucursalGastoID, $strEstatus, $strBusqueda = NULL) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		$strEstatus = trim(urldecode($strEstatus));
		//Array que se utiliza para asignar los estatus 
		$arrEstatus = array('ACTIVO', 'AUTORIZADO', 'RECHAZADO', 'CERRADO', 'INACTIVO'); 
		//Array que se utiliza para asignar el importe del vale por estatus
		$arrValeEstatus = array(); 
		//Array que se utiliza para asignar el importe de la comprobación por estatus
		$arrComprobacionEstatus = array(); 
		//Array que se utiliza para asignar la diferencia por estatus
		$arrDiferenciaEstatus = array();
		//Variable que se utiliza para asignar el acumulado del vale por estatus
		$intAcumValeEstatus = 0;
		//Variable que se utiliza para asignar el acumulado de la comprobación por estatus
	    $intAcumComprobacionEstatus = 0;
		//Variable que se utiliza para asignar el acumulado de la diferencia por estatus
		$intAcumDiferenciaEstatus = 0;
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;

		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->vales->buscar(NULL, NULL, NULL, $dteFechaInicial, $dteFechaFinal, $strTipoReferencia, 
											$intReferenciaID, $intSucursalGastoID, $strEstatus, $strBusqueda);
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
		$pdf->strLinea1 =  'VALES DE CAJA CHICA '.$strTituloRangoFechas;
		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA', 'TIPO DE VALE', 'REFERENCIA', 'IMPORTE', 
							 utf8_decode('COMPROBACIÓN'), 'DIFERENCIA', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(18, 16, 40, 40, 20, 21 ,18, 17);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L', 'R', 'R', 'R', 'C');

		//Establece el ancho de las columnas del concepto
		$arrAnchuraConcepto = array(18, 172);
		//Establece la alineación de las celdas del concepto
		$arrAlineacionConcepto = array('L', 'L');
		//Establece el ancho de las columnas del departamento, sucursal y/o cuenta bancaria
		$arrAnchuraSucursal = array(50, 50, 50);
		//Establece la alineación de las celdas del departamento, sucursal y/o cuenta bancaria
		$arrAlineacionSucursal = array('L', 'L', 'L');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('L', 'L',  'L', 'L',  'L', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(22, 15, 20, 55, 58, 20);
		//Establece la alineación de las celdas de la tabla tipo de gasto
	    $arrAlineacionTipoGasto = array('L',  'L',  'L', 'L', 'L');
	   //Establece el ancho de las columnas de la tabla tipo de gasto
		$arrAnchuraTipoGasto =  array(30, 30, 35, 35, 50);
		//Establece la alineación de las celdas de la tabla orden de compra
		$arrAlineacionOrdenCompra = array('L');
		//Establece el ancho de las columnas de la tabla orden de compra
		$arrAnchuraOrdenCompra = array(190);

		//Agregar la primer pagina
		$pdf->AddPage();

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo para obtener la información de los estatus
			foreach ($arrEstatus as $arrEst)
			{
				//Inicializar variables
				$arrValeEstatus[$arrEst] = 0;
				$arrComprobacionEstatus[$arrEst] = 0;
				$arrDiferenciaEstatus[$arrEst] = 0;
			}	

			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
			    //Array que se utiliza para agregar los detalles
		        $arrDetalles = array();
		        //Array que se utiliza para agregar los datos de un detalle
		        $arrAuxiliar = array();
				//Variable que se utiliza para asignar el importe del vale
				$intImporteVale = $arrCol->importe;
				//Variables que se utilizan para los acumulados de la comprobación
				//Variable que se utiliza para asignar el acumulado del subtotal
				$intAcumSubtotalComp = 0;
				//Variable que se utiliza para asignar el acumulado del IVA
				$intAcumIvaComp  = 0;
				//Variable que se utiliza para asignar el acumulado del IEPS
				$intAcumIepsComp  = 0;
				//Variable que se utiliza para asignar el acumulado del importe total
				$intAcumTotalComp = 0;

				//Seleccionar los detalles del registro
				$otdDetalles = $this->vales->buscar_detalles($arrCol->caja_vale_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						 //Variable que se utiliza para asignar los datos del vehículo
						$strVehiculo = '';
						//Variables que se utilizan para asignar valores del detalle
						$intSubtotal = $arrDet->subtotal;
						$intImporteIva = $arrDet->iva;
						$intImporteIeps = $arrDet->ieps;

						//Calcular importe total
						$intTotal = $intSubtotal + $intImporteIva + $intImporteIeps;

						//Si existe id del vehículo
						if($arrDet->vehiculo_id > 0)
						{
							//Asignar los datos del vehículo
						   $strVehiculo = $arrDet->vehiculo;
						}


						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["tipo"] = $arrDet->tipo;
						$arrAuxiliar["fecha"] = $arrDet->fecha_format;
						$arrAuxiliar["concepto"] = utf8_decode($arrDet->concepto);
						$arrAuxiliar["orden_compra"] = $arrDet->folio_orden_compra;
						$arrAuxiliar["proveedor"] = utf8_decode($arrDet->proveedor);
						$arrAuxiliar["factura"] = utf8_decode($arrDet->factura);
						$arrAuxiliar["tipo_gasto"] = utf8_decode($arrDet->tipo_gasto);
						$arrAuxiliar["sucursal"] = utf8_decode($arrDet->sucursal_detalle);
						$arrAuxiliar["modulo"] = utf8_decode($arrDet->modulo);
						$arrAuxiliar["gasto"] = utf8_decode($arrDet->gasto);
						$arrAuxiliar["vehiculo"] = utf8_decode($strVehiculo);
		                $arrAuxiliar["subtotal"] = '$'.number_format($intSubtotal,2);
		                //Asignar datos al array
                        array_push($arrDetalles, $arrAuxiliar); 

                        //Incrementar acumulados
						$intAcumSubtotalComp += $intSubtotal;
						$intAcumIvaComp += $intImporteIva;
						$intAcumIepsComp += $intImporteIeps;
						$intAcumTotalComp += $intTotal;
					}

				}//Cierre de verificación de detalles

				//Calcular diferencia de importes
				$intDiferencia = $intImporteVale - $intAcumTotalComp;

				//Incrementar valores de los siguientes arrays
				$arrValeEstatus[$arrCol->estatus] += $intImporteVale;
				$arrComprobacionEstatus[$arrCol->estatus] += $intAcumTotalComp;
				$arrDiferenciaEstatus[$arrCol->estatus] += $intDiferencia;

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, $arrCol->fecha, $arrCol->tipo_vale, 
								utf8_decode($arrCol->referencia),  
							    '$'.number_format($intImporteVale,2),
							    '$'.number_format($intAcumTotalComp,2),
							    '$'.number_format($intDiferencia,2), $arrCol->estatus), 
							     $pdf->arrAlineacion, 'ClippedCell');

				//Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
		        //Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraConcepto);
		        //Concepto
		        $pdf->Row(array('CONCEPTO:', utf8_decode($arrCol->concepto)), 
							     $arrAlineacionConcepto, 'ClippedCell', 'SI');

		        //Variable que se utiliza para asignar los datos de la sucursal
		        $strSucursal = '';
		        //Variable que se utiliza para asignar los datos del departamento
		        $strDepartamento = '';
		        //Variable que se utiliza para asignar los datos de la cuenta bancaria
		        $strCuentaBancaria = '';

			    //Si existe id de la sucursal
				if($arrCol->sucursal_gasto > 0)
				{
					//Sucursal
					$strSucursal = 'SUCURSAL:   ';
					$strSucursal .= utf8_decode($arrCol->sucursal);
				}

				//Si existe id del departamento
				if($arrCol->departamento_id > 0)
				{
				    //Departamento
					$strDepartamento = 'DEPARTAMENTO:   ';
					$strDepartamento .= utf8_decode($arrCol->departamento);
				}
			  
			   
				//Si el tipo de vale corresponde a una transferencia electrónica
				if($arrCol->tipo_vale == 'TRANSFERENCIA ELECTRONICA')
				{
				
					//Cuenta bancaria
					$strCuentaBancaria = 'CUENTA:   ';
					$strCuentaBancaria .= utf8_decode($arrCol->cuenta_bancaria);
				}

				//Si se cumple la sentencia
				if($strSucursal != '' OR $strDepartamento != '' OR $strCuentaBancaria != '')
				{
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraSucursal);

					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row(array($strSucursal, $strDepartamento, $strCuentaBancaria),
					    			$arrAlineacionSucursal, 'ClippedCell', 'SI');
				}
				
				$pdf->Ln(5);//Deja un salto de línea
				//Si existen detalles del registro
				if($arrDetalles)
				{
					
					//Recorremos el arreglo 
			        foreach ($arrDetalles as $arrDet) 
			        {
			        	//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraDetalles);
					   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array($arrDet['tipo'], $arrDet['fecha'],
					    				$arrDet['factura'], $arrDet['concepto'], 
					    				$arrDet['proveedor'], $arrDet['subtotal']),
					    				$arrAlineacionDetalles, 'ClippedCell');

					    //Si el tipo de vale es FISCAL
					    if($arrDet['tipo'] == 'FISCAL')
					    {

					    	//Si existe id de la orden de compra
							if($arrDet['orden_compra'] != '')
							{
								//Establece el ancho de las columnas
								$pdf->SetWidths($arrAnchuraOrdenCompra);
								//Se agrega la información de la orden de compra
								$pdf->Row(array($arrDet['orden_compra']),  
											    $arrAlineacionOrdenCompra, 'ClippedCell', 'SI');
							}
							else
							{

						    	//Establece el ancho de las columnas
								$pdf->SetWidths($arrAnchuraTipoGasto);
							    //Se agrega la información del tipo de gasto
								$pdf->Row(array($arrDet['sucursal'], $arrDet['tipo_gasto'], 
												$arrDet['modulo'], $arrDet['gasto'],
												$arrDet['vehiculo']),  
										   	    $arrAlineacionTipoGasto, 'ClippedCell', 'SI');
							}


							$pdf->Ln(2); //Deja un salto de línea
					    }
					    
					}


		    		//$pdf->Ln(5);//Deja un salto de línea
				}//Cierre de verificación de detalles
				
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
			$arrCabeceraResumen = array('ESTATUS', 'VALE', utf8_decode('COMPROBACIÓN'), 'DIFERENCIA');
			//Establece el ancho de las columnas de cabecera
			$arrAnchuraResumen = array(25.8, 25, 25, 25);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacionResumen = array('L', 'R', 'R', 'R');
			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Creación de la tabla Resumen
			$pdf->Cell(101, 4, 'RESUMEN GENERAL', 0, 0, 'C', TRUE);
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
				//Si existe importe del vale
				if($arrValeEstatus[$arrEst] > 0)
				{
				 	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($arrEst,'$'.number_format($arrValeEstatus[$arrEst],2), 
									'$'.number_format($arrComprobacionEstatus[$arrEst],2), 
			    				    '$'.number_format($arrDiferenciaEstatus[$arrEst],2)), 
									$arrAlineacionResumen);

					//Incrementar acumulados si el estatus es ACTIVO o AUTORIZADO o CERRADO
					if($arrEst == 'ACTIVO' OR  $arrEst == 'AUTORIZADO' OR  $arrEst == 'CERRADO')
					{
						//Incrementar acumulados
						$intAcumValeEstatus += $arrValeEstatus[$arrEst];
						$intAcumComprobacionEstatus += $arrComprobacionEstatus[$arrEst];
						$intAcumDiferenciaEstatus += $arrDiferenciaEstatus[$arrEst];
					}
				}
			}

			//Asigna el tipo y tamaño de letra para los totales
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Escribir totales
	    	$pdf->Cell(12,3,'TOTALES: ', 0, 0, 'L');  
	    	//Total de registros
            $pdf->Cell(13,3,$intContador, 0, 0, 'R');
            //Acumulado del vale
            $pdf->Cell(25.8,3,'$'.number_format($intAcumValeEstatus,2), 0, 0, 'R');
            //Acumulado de la comprobación
            $pdf->Cell(25,3,'$'.number_format($intAcumComprobacionEstatus,2), 0, 0, 'R');
           //Acumulado de la diferencia
            $pdf->Cell(25,3,'$'.number_format($intAcumDiferenciaEstatus,2), 0, 0, 'R');

		}

		//Ejecutar la salida del reporte
		$pdf->Output('vales_caja_chica.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro($intCajaValeID) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->vales->buscar($intCajaValeID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->vales->buscar_detalles($intCajaValeID);		
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'vale_caja_';
		//Agregar la primer pagina
		$pdf->AddPage();
		//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
		$this->get_encabezado_archivo_pdf($pdf);

		//Verificar si hay información del registro
		if($otdResultado)
		{	
			//Hacer un llamado a la función para mostrar imagen del estatus (INACTIVO/TIMBRAR)
			$this->get_img_estatus_archivo_pdf($pdf, $otdResultado->estatus);

			//Variable que se utiliza para asignar el importe del vale
			$intImporteVale = $otdResultado->importe;
		    //Variables que se utilizan para los acumulados de la comprobación
			//Variable que se utiliza para asignar el acumulado del subtotal
			$intAcumSubtotalComp = 0;
			//Variable que se utiliza para asignar el acumulado del IVA
			$intAcumIvaComp  = 0;
			//Variable que se utiliza para asignar el acumulado del IEPS
			$intAcumIepsComp  = 0;
			//Variable que se utiliza para asignar el acumulado del importe total
			$intAcumTotalComp = 0;

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL VALE DE CAJA 
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 42);
			$pdf->ClippedCell(185, 3, utf8_decode('INFORMACIÓN GENERAL'), 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0);//establece el color de texto
			//Folio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, 46);
			$pdf->ClippedCell(15, 3, 'FOLIO');
			//Fecha 
			$pdf->SetXY(96, 46);
			$pdf->ClippedCell(15, 3, 'FECHA');
			//Tipo de vale
		    $pdf->SetXY(15, 49);
			$pdf->ClippedCell(30, 3, 'TIPO DE VALE');
			//Sucursal
			$pdf->SetXY(15, 52);
			$pdf->ClippedCell(15, 3, 'SUCURSAL');
			//Departamento
			$pdf->SetXY(96, 52);
			$pdf->ClippedCell(25, 3, 'DEPARTAMENTO');
			//Referencia
			$pdf->SetXY(15, 55);
			$pdf->ClippedCell(32, 3, 'REFERENCIA');
			//Estatus
			$pdf->SetXY(15, 58);
			$pdf->ClippedCell(32, 3, 'ESTATUS');
			//Concepto
			$pdf->SetXY(15, 61);
			$pdf->ClippedCell(32, 3, 'CONCEPTO');
			//Importe del vale
			$pdf->SetXY(15, 70);
			$pdf->ClippedCell(32, 3, 'VALE POR');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(42, 46);
			$pdf->ClippedCell(20, 3, $otdResultado->folio);
			//Fecha
			$pdf->SetXY(125, 46);
			$pdf->ClippedCell(20, 3, $otdResultado->fecha);
			//Tipo de gasto
			$pdf->SetXY(42, 49);
			$pdf->ClippedCell(60, 3, $otdResultado->tipo_vale);

			//Si el tipo de vale corresponde a una transferencia electrónica
			if($otdResultado->tipo_vale == 'TRANSFERENCIA ELECTRONICA')
			{
				//Cuenta bancaria
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			    $pdf->SetXY(96, 49);
				$pdf->ClippedCell(30, 3, 'CUENTA');
				//Información
				$pdf->SetXY(125, 49);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(60, 3, $otdResultado->cuenta_bancaria);
			}
			
			//Sucursal
			$pdf->SetXY(42, 52);
			$pdf->ClippedCell(50, 3, utf8_decode($otdResultado->sucursal));
			//Departamento
			$pdf->SetXY(125, 52);
			$pdf->ClippedCell(72, 3, utf8_decode($otdResultado->departamento));
			//Referencia
			$pdf->SetXY(42, 55);
			$pdf->ClippedCell(155, 3, utf8_decode($otdResultado->referencia));
			//Estatus
			$pdf->SetXY(42, 58);
			$pdf->ClippedCell(30, 3, $otdResultado->estatus);
			//Concepto
			$pdf->SetXY(15, 64);
			$pdf->MultiCell(185, 3, utf8_decode($otdResultado->concepto));
			//Importe del vale
			$pdf->SetXY(42, 70);
			$pdf->ClippedCell(30, 3, '$'.number_format($intImporteVale, 2));

			//Cantidad con letra
			$pdf->SetXY(15, 73);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->ClippedCell(60, 3, 'CANTIDAD CON LETRA');
			$pdf->SetXY(15, 76);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->MultiCell(185, 3, 'SON: (' .$AifLibNumber->toCurrency($intImporteVale) . ')');

		    //------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DEL VALE DE CAJA
	        //------------------------------------------------------------------------------------------------------------------------
			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->SetXY(15, 85);
				$pdf->ClippedCell(185, 3, utf8_decode('COMPROBACIÓN'), 0, 0, 'C', TRUE);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Tabla con los detalles del vale de caja
				$pdf->SetXY(15, 89);
				//Crea los titulos de la cabecera
				$arrCabecera = array('Tipo de gasto', 'Fecha', 'Factura', 'Concepto', 
								     'Proveedor', 'Importe');
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(22, 15, 20, 55, 53, 20);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'L', 'L', 'L', 'R');
				//Establece el ancho de las columnas de la tabla tipo de gasto
				$arrAnchuraTipoGasto = array(40, 35, 40, 30, 40);
				//Establece la alineación de las celdas de la tabla tipo de gasto
				$arrAlineacionTipoGasto = array('L', 'L', 'L', 'L', 'L');
				//Establece el ancho de las columnas de la tabla orden de compra
				$arrAnchuraOrdenCompra = array(185);
				//Establece la alineación de las celdas de la tabla orden de compra
				$arrAlineacionOrdenCompra = array('L');
				//Recorre el array de títulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchura[$intCont], 3, $arrCabecera[$intCont], 1, 0, $arrAlineacion[$intCont], TRUE);
				}
				$pdf->Ln(); //Deja un salto de línea
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchura);
				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDet)
				{ 
					$pdf->SetX(15);
					//Variable que se utiliza para asignar el tipo de vale
					$strTipoVale = $arrDet->tipo;
					//Variables que se utilizan para asignar valores del detalle
					$intSubtotal = $arrDet->subtotal;
					$intImporteIva = $arrDet->iva;
					$intImporteIeps = $arrDet->ieps;

					//Calcular importe total
					$intTotal = $intSubtotal + $intImporteIva + $intImporteIeps;

					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchura);
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($strTipoVale, $arrDet->fecha_format, $arrDet->factura,  
									utf8_decode($arrDet->concepto),utf8_decode($arrDet->proveedor),
									number_format($intSubtotal,2)), 
									$arrAlineacion, 'ClippedCell');

					

					//Si el tipo de vale es Fiscal
					if($strTipoVale == 'FISCAL')
					{
						//Asignar posición
						$pdf->SetX(15);

						//Variable que se utiliza para asignar los datos del vehículo
						$strVehiculo = '';
						//Si existe id del vehículo
						if($arrDet->vehiculo_id > 0)
						{
							//Asignar los datos del vehículo
						   $strVehiculo = $arrDet->vehiculo;
						}
						

						//Si existe id de la orden de compra
						if($arrDet->orden_compra_id > 0)
						{
							//Establece el ancho de las columnas
							$pdf->SetWidths($arrAnchuraOrdenCompra);
							//Se agrega la información de la orden de compra
							$pdf->Row(array(utf8_decode($arrDet->folio_orden_compra)),  
										    $arrAlineacionOrdenCompra, 'ClippedCell', 'SI');

						}
						else
						{
							//Establece el ancho de las columnas
							$pdf->SetWidths($arrAnchuraTipoGasto);
							//Se agrega la información de la orden de compra
							$pdf->Row(array(utf8_decode($arrDet->sucursal_detalle),
											utf8_decode($arrDet->tipo_gasto),
											utf8_decode($arrDet->modulo),
											utf8_decode($arrDet->gasto),
											utf8_decode($strVehiculo)), 
										    $arrAlineacionTipoGasto, 'ClippedCell', 'SI');
							
						}

						$pdf->Ln(2); //Deja un salto de línea

					}
					

					//Incrementar acumulados
					$intAcumSubtotalComp += $intSubtotal;
					$intAcumIvaComp += $intImporteIva;
					$intAcumIepsComp += $intImporteIeps;
					$intAcumTotalComp += $intTotal;
				}
			}//Cierre de verificación de detalles

			//Calcular diferencia de importes
			$intDiferencia = $intImporteVale - $intAcumTotalComp;

			$pdf->Ln(2); //Deja un salto de línea
			$pdf->SetX(15);
			$pdf->ClippedCell(185, 3, '', 0, 0, 'C', TRUE);
			$pdf->Ln(); //Deja un salto de línea
			//Observaciones
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(15);
			$pdf->ClippedCell(30, 3, 'OBSERVACIONES');
			$intPosYObs = $pdf->GetY();
			$pdf->Ln(); //Deja un salto de línea
		    $intPosY = $pdf->GetY();
		    //Variable que se utiliza para asignar el tamaño de la celda observaciones
		    $intTamObservaciones = 185;
			
			//Si existen detalles del registro
			if($intAcumTotalComp > 0)
			{
				//Cambiar el tamaño de la celda
				$intTamObservaciones = 110;
				//Acumulados de la comprobación
				//Subtotal
				$pdf->SetXY(135, $intPosYObs);
				$pdf->ClippedCell(30, 3, 'SUBTOTAL');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumSubtotalComp,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();
				//IVA
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(135, $intPosY);
				$pdf->ClippedCell(30, 3, 'IVA');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIvaComp,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				//IEPS
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'IEPS');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIepsComp,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				//Total
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'TOTAL');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumTotalComp,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				
				//Diferencia
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'DIFERENCIA');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intDiferencia,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
			}
			
			//Observaciones
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, $intPosY);
			$pdf->MultiCell($intTamObservaciones, 3, utf8_decode($otdResultado->observaciones));
            //Persona que capturo el vale de caja
            $pdf->SetXY(15,260);
            $pdf->Cell(90, 6, $otdResultado->usuario_creacion, 0, 0, 'C');
            //Persona que autorizo el vale de caja
            $pdf->SetXY(109, 260);
            $pdf->Cell(90, 6, $otdResultado->usuario_autorizacion, 0, 0, 'C');
            $pdf->Ln(5);//Espacios de salto de línea
            $pdf->SetX(15);
            //Persona que capturo el vale de caja
            //Asigna el tipo y tamaño de letra
            $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
            $pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
            $pdf->Cell(90, 3, 'CAPTURO', 0, 0, 'C',  TRUE);
            //Persona que autorizo el vale de caja
            $pdf->SetXY(109, 265);
            $pdf->Cell(90, 3, 'AUTORIZO', 0, 0, 'C',  TRUE);

            //Fecha y hora de impresión (pie de pagina)
			$pdf->strUsuarioCreacion = $otdResultado->usuario_creacion;
			$pdf->dteFechaCreacion = $otdResultado->fecha_creacion;
			$pdf->strIncluirMembrete = 'SI';

			//Concatenar folio para identificar vale
			$strNombreArchivo .= $otdResultado->folio;

		}//Cierre de verificación de información
		
		//Ejecutar la salida del reporte
		$pdf->Output($strNombreArchivo.'.pdf','I'); 
		
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $strTipoReferencia, $intReferenciaID,
						   	$intSucursalGastoID, $strEstatus, $strBusqueda = NULL) 
	{	

		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		$strEstatus = trim(urldecode($strEstatus));
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->vales->buscar(NULL, NULL, NULL, $dteFechaInicial, $dteFechaFinal, $strTipoReferencia, 
											 $intReferenciaID, $intSucursalGastoID, $strEstatus, $strBusqueda);
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
			     ->setCellValue('A7', 'VALES DE CAJA CHICA '.$strTituloRangoFechas);
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('C'.$intPosEncabezados, 'TIPO DE VALE')
        		 ->setCellValue('D'.$intPosEncabezados, 'CUENTA')
        		 ->setCellValue('E'.$intPosEncabezados, 'REFERENCIA')
        		 ->setCellValue('F'.$intPosEncabezados, 'SUCURSAL')
        		 ->setCellValue('G'.$intPosEncabezados, 'DEPARTAMENTO')
        		 ->setCellValue('H'.$intPosEncabezados, 'CONCEPTO')
        		 ->setCellValue('I'.$intPosEncabezados, 'IMPORTE')
        		 ->setCellValue('J'.$intPosEncabezados, 'COMPROBACIÓN')
        		 ->setCellValue('K'.$intPosEncabezados, 'DIFERENCIA')
        		 ->setCellValue('L'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('M'.$intPosEncabezados, 'ESTATUS')
        		 ->setCellValue('N'.$intPosEncabezados, 'TIPO DE VALE')
        		 ->setCellValue('O'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('P'.$intPosEncabezados, 'CONCEPTO')
        		 ->setCellValue('Q'.$intPosEncabezados, 'ORDEN DE COMPRA')
        		 ->setCellValue('R'.$intPosEncabezados, 'PROVEEDOR')
        		 ->setCellValue('S'.$intPosEncabezados, 'FACTURA')
        		 ->setCellValue('T'.$intPosEncabezados, 'SUCURSAL')
		         ->setCellValue('U'.$intPosEncabezados, 'TIPO DE GASTO')
		         ->setCellValue('V'.$intPosEncabezados, 'DEPARTAMENTO')
		         ->setCellValue('W'.$intPosEncabezados, 'GASTO')
		         ->setCellValue('X'.$intPosEncabezados, 'VEHÍCULO')
        		 ->setCellValue('Y'.$intPosEncabezados, 'IMPORTE');

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
    			 ->getStyle('A9:Y9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Array que se utiliza para agregar los detalles
		        $arrDetalles = array();
		        //Variable que se utiliza para asignar el número de registros (detalles)
		        $intNumRegistros = 1;
		        //Variable que se utiliza para asignar el número de detalles
		        $intNumDetalles = 0;
				//Variable que se utiliza para asignar el importe del vale
				$intImporteVale = $arrCol->importe;
				//Variables que se utilizan para los acumulados de la comprobación
				//Variable que se utiliza para asignar el acumulado del subtotal
				$intAcumSubtotalComp = 0;
				//Variable que se utiliza para asignar el acumulado del IVA
				$intAcumIvaComp  = 0;
				//Variable que se utiliza para asignar el acumulado del IEPS
				$intAcumIepsComp  = 0;
				//Variable que se utiliza para asignar el acumulado del importe total
				$intAcumTotalComp = 0;

				//Seleccionar los detalles del registro
				$otdDetalles = $this->vales->buscar_detalles($arrCol->caja_vale_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Variable que se utiliza para contar el número de detalles
				    $intContDetVal = 0;
				    //Asignar el número de detalles
				    $intNumDetalles = count($otdDetalles);

				    //Si el número de detalles es mayor que el número de registros
					if($intNumDetalles > $intNumRegistros)
					{   
						//Asignar el número de detalles
						$intNumRegistros = $intNumDetalles;
					}

				    //Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Variable que se utiliza para asignar los datos del vehículo
						$strVehiculo = '';
						//Variables que se utilizan para asignar valores del detalle
						$intSubtotal = $arrDet->subtotal;
						$intImporteIva = $arrDet->iva;
						$intImporteIeps = $arrDet->ieps;

						//Calcular importe total
						$intTotal = $intSubtotal + $intImporteIva + $intImporteIeps;

						//Si existe id del vehículo
						if($arrDet->vehiculo_id > 0)
						{
							//Asignar los datos del vehículo
						   $strVehiculo = $arrDet->vehiculo;
						}

						//Agregar datos al array
			        	$arrDetalles[$intContDetVal]['tipo'] = $arrDet->tipo;
			        	$arrDetalles[$intContDetVal]['fecha'] = $arrDet->fecha_format;
			        	$arrDetalles[$intContDetVal]['concepto'] = $arrDet->concepto;
			        	$arrDetalles[$intContDetVal]['orden_compra'] = $arrDet->folio_orden_compra;
			        	$arrDetalles[$intContDetVal]['proveedor'] = $arrDet->proveedor;
			        	$arrDetalles[$intContDetVal]['factura'] = $arrDet->factura;
			        	$arrDetalles[$intContDetVal]['tipo_gasto'] = $arrDet->tipo_gasto;
			        	$arrDetalles[$intContDetVal]['sucursal'] = $arrDet->sucursal_detalle;
			        	$arrDetalles[$intContDetVal]['modulo'] = $arrDet->modulo;
			        	$arrDetalles[$intContDetVal]['gasto'] = $arrDet->gasto;
			        	$arrDetalles[$intContDetVal]['vehiculo'] = $strVehiculo;
			        	$arrDetalles[$intContDetVal]['subtotal'] = $intSubtotal;

			        	//Incrementar acumulados
						$intAcumSubtotalComp += $intSubtotal;
						$intAcumIvaComp += $intImporteIva;
						$intAcumIepsComp += $intImporteIeps;
						$intAcumTotalComp += $intTotal;

			        	//Incrementar el contador por cada registro
	                    $intContDetVal++;
					}
				}

				//Calcular diferencia de importes
				$intDiferencia = $intImporteVale - $intAcumTotalComp;

				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumRegistros; $intContDet++) 
			    {
					//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
	                         ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('B'.$intFila, $arrCol->fecha)
	                         ->setCellValue('C'.$intFila, $arrCol->tipo_vale)
	                         ->setCellValueExplicit('D'.$intFila, $arrCol->cuenta_bancaria, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('E'.$intFila, $arrCol->referencia)
	                         ->setCellValue('F'.$intFila, $arrCol->sucursal)
	                         ->setCellValue('G'.$intFila, $arrCol->departamento)
	                         ->setCellValue('H'.$intFila, $arrCol->concepto)
	                         ->setCellValue('I'.$intFila, $intImporteVale)
	                         ->setCellValue('J'.$intFila, $intAcumTotalComp)
	                         ->setCellValue('K'.$intFila, $intDiferencia)
	                         ->setCellValue('L'.$intFila, $arrCol->observaciones)
	                         ->setCellValue('M'.$intFila, $arrCol->estatus);

	                //Si existen detalles del registro
					if($intNumDetalles > 0)
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
						     	 ->setCellValue('N'.$intFila, $arrDetalles[$intContDet]['tipo'])
						     	 ->setCellValue('O'.$intFila, $arrDetalles[$intContDet]['fecha'])
						         ->setCellValue('P'.$intFila, $arrDetalles[$intContDet]['concepto'])
						         ->setCellValueExplicit('Q'.$intFila, $arrDetalles[$intContDet]['orden_compra'], PHPExcel_Cell_DataType::TYPE_STRING)
						         ->setCellValue('R'.$intFila, $arrDetalles[$intContDet]['proveedor'])
						         ->setCellValue('S'.$intFila, $arrDetalles[$intContDet]['factura'])
						         ->setCellValue('T'.$intFila, $arrDetalles[$intContDet]['sucursal'])
						         ->setCellValue('U'.$intFila, $arrDetalles[$intContDet]['tipo_gasto'])
						         ->setCellValue('V'.$intFila, $arrDetalles[$intContDet]['modulo'])
						         ->setCellValue('W'.$intFila, $arrDetalles[$intContDet]['gasto'])
						         ->setCellValue('X'.$intFila, $arrDetalles[$intContDet]['vehiculo'])
						         ->setCellValue('Y'.$intFila, $arrDetalles[$intContDet]['subtotal']);
					}
	                       
	                //Incrementar el indice para escribir los datos del siguiente registro
               		$intFila++; 
                }

                //Incrementar el contador por cada registro
				$intContador++;
			}
			
			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('I'.$intFilaInicial.':'.'K'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

           	 $objExcel->getActiveSheet()
            		 ->getStyle('Y'.$intFilaInicial.':'.'Y'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
                	 
            $objExcel->getActiveSheet()
                	 ->getStyle('I'.$intFilaInicial.':'.'K'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);		
                	  
			$objExcel->getActiveSheet()
                	 ->getStyle('M'.$intFilaInicial.':'.'M'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('O'.$intFilaInicial.':'.'O'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

             $objExcel->getActiveSheet()
                	 ->getStyle('Y'.$intFilaInicial.':'.'Y'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);	

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('M'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('M'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'vales_caja_chica.xls', 'vales', $intFila);
	}


	/*******************************************************************************************************************
	Funciones de la tabla cajas_vales_detalles
	*********************************************************************************************************************/
	//Método para guardar los detalles de un registro
	public function guardar_detalles()
	{
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objCajaValeDetalles = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		$objCajaValeDetalles->intCajaValeID = $this->input->post('intCajaValeID');
		//Datos de los detalles
		$objCajaValeDetalles->arrDetalles = json_decode($this->input->post('arrDetalles'));
		//Datos de los renglones
		$strRenglonesActuales = $this->input->post('strRenglonesActuales');
		$strRenglonesAnteriores = $this->input->post('strRenglonesAnteriores');

		//Hacer un llamado a la función para cambiar el nombre de las carpetas de los detalles del registro	
	    $strMensajeRenombrarCarpeta = $this->renombrar_carpetas($objCajaValeDetalles->intCajaValeID, 
	    														$strRenglonesActuales, 
	    														$strRenglonesAnteriores);

	    //Si no existen errores al momento de renombrar la carpetas e los detalles del registro
	    if($strMensajeRenombrarCarpeta == '')
	    {
	    	//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE,
						 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
						      'mensaje' => MSJ_GUARDAR);
		

	    	//Hacer un llamado a la función para eliminar las carpetas de los detalles del registro
		    $strMensajeEliminarCarpeta = $this->eliminar_carpetas($objCajaValeDetalles->intCajaValeID, 
		    													  $strRenglonesActuales);

		    //Si no existen errores al momento de eliminar las carpetas de los detalles del registro
		    if($strMensajeEliminarCarpeta == '')
		    {
		    	//Guardar los detalles del registro
				$bolResultado = $this->vales->guardar_detalles($objCajaValeDetalles);

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
					              'mensaje' => $strMensajeEliminarCarpeta);
		    }
	    }
	    else
	    {
    		//Enviar el mensaje de error al formulario
			$arrDatos = array('resultado' => FALSE,
						      'tipo_mensaje' => TIPO_MSJ_ERROR,
				              'mensaje' => $strMensajeRenombrarCarpeta);
	    }


		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para renombrar carpetas de los renglones anteriores (existentes en la base de datos) del registro
	public function renombrar_carpetas($intCajaValeID, $strRenglonesActuales, $strRenglonesAnteriores)
	{
		//Variable que se utiliza para asignar el mensaje de error
		$strMensaje = '';
		//Definir ubicación de la carpeta
		$strCarpetaDestino = $this->archivo['strCarpetaDestino'].$intCajaValeID; 
		/*Quitar | de la lista para obtener el renglon actual y renglonanterior
		*/
		$arrRenglonesActuales = explode("|", $strRenglonesActuales);
		$arrRenglonesAnteriores = explode("|", $strRenglonesAnteriores);

		//Verificar si la carpeta es un directorio 
        if (is_dir($strCarpetaDestino))
        {
        	
        	//Hacer recorrido para cambiar el nombre de la carpeta
			for ($intCon = 0; $intCon < sizeof($arrRenglonesActuales); $intCon++) 
			{

				//Asignar id del renglón (que se va a renombrar) anterior
				$intRenglonAnterior = $arrRenglonesAnteriores[$intCon];
				//Asignar id del renglón actual
				$intRenglonActual = $arrRenglonesActuales[$intCon];

				//Si se cumple la regla de validación
				if($intRenglonAnterior != $intRenglonActual)
				{
					//Asignar ruta de la subcarpeta
					$strArchivoRenglonAnterior = $strCarpetaDestino.'/'.$intRenglonAnterior;
					//Concatenar _temp para no perder el renglón actual por el que fue reemplazado el renglon anterior
					$strArchivoRenglonActual = $strCarpetaDestino.'/'.$intRenglonActual.'_temp';

					//Verificar si la subcarpeta es un directorio 
					if (is_dir($strArchivoRenglonAnterior))
					{
					    //Cambiar el nombre de la subcarpeta
		           		if(rename($strArchivoRenglonAnterior, $strArchivoRenglonActual)){}
		           		else
		           		{
		           			$strMensaje .= 'No es posible cambiar el nombre de la carpeta  '.$intRenglonAnterior.' ';
		           		}
					}
				}
			}

			//Hacer recorrido en la carpeta para obtener subcarpetas
            foreach (scandir($strCarpetaDestino) as $item) 
            {
            	if ($item == '.' OR $item == '..') continue;
            	//Asignar ruta de la subcarpeta
               	$strArchivoTemp = $strCarpetaDestino.'/'.$item;
               	//Reemplazar _temp por cadena vacia
               	$strArchivoRenglon = str_replace("_temp", "", $strArchivoTemp);

               	//Cambiar el nombre de la subcarpeta
               	if(rename($strArchivoTemp, $strArchivoRenglon)){}
               	else
           		{
           			$strMensaje .= 'No es posible cambiar el nombre de la carpeta  '.$strArchivoTemp.' ';
           		}
            }


        }

        //Regresar mensaje de error
        return $strMensaje;
	}	

	//Método para eliminar carpetas de los renglones no existentes en los detalles del registro
	public function eliminar_carpetas($intCajaValeID, $strRenglones)
	{
		//Variable que se utiliza para asignar el mensaje de error
		$strMensaje = '';
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intCajaValeID; 
		/*Quitar | de la lista para obtener el renglón*/
		$arrRenglones = explode("|", $strRenglones);
		//Array que se utiliza para agregar las subcarpetas (renglones) del  registro
		$arrSubcarpetas = array();

		//Verificar si la carpeta es un directorio 
        if (is_dir($strNombreCarpeta))
        {
        	//Hacer recorrido en la carpeta para obtener subcarpetas
            foreach (scandir($strNombreCarpeta) as $item) 
            {
            	if ($item == '.' OR $item == '..') continue;

            	//Agregar nombre (renglón) de la subcarpeta
            	$arrSubcarpetas[] = $item;
            }
        }

        //Hacer recorrido para eliminar subcarpetas correspondientes a los renglones que no se encuentran en los detalles
        foreach($arrSubcarpetas as $valor)
    	{
    		//Si la carpetar contiene renglones que no se encunetran en los detalles del registro
			if (!in_array($valor, $arrRenglones))
			{
				//Definir ubicación de la subcarpeta
				$strSubCarpeta = $strNombreCarpeta.'/'.$valor; 

				//Hacer recorrido en la subcarpeta para obtener archivos
	        	foreach(glob($strSubCarpeta . "/*") as $arc)
				{             
					//Borrar fichero del servidor
					if (!unlink($arc))
					{
						$strMensaje .= 'No es posible eliminar archivo '.$arc.' ';
					}
					
				}

				//Borrar subcarpeta del servidor
				if (!rmdir($strSubCarpeta))
				{
					$strMensaje .= 'No es posible eliminar subcarpeta '.$strSubCarpeta;
				}

			}
    		
    	}

        //Regresar mensaje de error
        return $strMensaje;
	}

	//Método para subir los archivos de un detalle
    public function subir_archivos()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$intCajaValeID = $_POST["intCajaValeID_detalles_cajas_vales_caja"];
		$intRenglon = $_POST["intRenglon_detalles_cajas_vales_caja"];
		$strBotonArchivoID = $_FILES["archivo_varios_detalles_cajas_vales_caja"];
		//Variable que se utiliza para asigar el nombre de los archivos que no se movieron a la carpeta
		$strArchivosNoMovidos = '';
		//Variable que se utiliza para asignar el número de archivos que contiene la carpeta del registro
		$intTotalArchivos = 0;
		
		//Recuperar los archivos seleccionados
		if(isset($strBotonArchivoID))
		{
			//Definir ubicación de la carpeta principal
			$strCarpetaDestino = $this->archivo['strCarpetaPrincipal']; 
			//Si no existe la carpeta crearla
			if(!is_dir($strCarpetaDestino))
			{ 
				@mkdir($strCarpetaDestino, 0700); 
			}

		    //Concaternar ubicación de la carpeta destino
			$strCarpetaDestino =  $this->archivo['strCarpetaDestino'];
			//Si no existe la carpeta crearla
			if(!is_dir($strCarpetaDestino))
			{ 
				@mkdir($strCarpetaDestino, 0700); 
			} 

			//Definir ubicación de la carpeta
			$strNombreCarpeta = $strCarpetaDestino.$intCajaValeID; 
			//Si no existe la carpeta crearla
			if(!is_dir($strNombreCarpeta))
			{ 
				@mkdir($strNombreCarpeta, 0700); 
			} 

			//Definir ubicación de la subcarpeta
			$strNombreSubCarpeta = $strNombreCarpeta.'/'.$intRenglon; 
			$strRuta = $strNombreSubCarpeta.'/';
			//Si no existe la carpeta crearla
			if(!is_dir($strNombreSubCarpeta))
			{ 
				@mkdir($strNombreSubCarpeta, 0700); 
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

	            	//Verificar si la carpeta es un directorio 
			        if (is_dir($strNombreSubCarpeta))
			        {
			        	//Hacer recorrido en la carpeta para obtener archivos
			            foreach (scandir($strNombreSubCarpeta) as $item) 
			            {
			                if ($item == '.' OR $item == '..') continue;
			                //Separar extensión del archivo
			                $arrArchivoCarp = explode(".", $item);

			                //Si existe archivo con la misma extensión
			                if($strExtension == $arrArchivoCarp[1])
			                {
			                	//Borrar fichero del servidor
								if (!unlink($strNombreSubCarpeta.'/'.$item))
								{
									$strArchivosNoMovidos .= 'No es posible eliminar archivo '.$item.' ';
								}
			                }
			            }

			        }

					//Mover archivo a la carpeta
					if (move_uploaded_file($strBotonArchivoID["tmp_name"][$intCont], $strRuta."$strArchivo")){}
					else
					{
						//Se concatena el nombre del archivo a la variable
						$strArchivosNoMovidos.= $strArchivo.' y ';
					}
		      	}
		      	
		    }

		    //Asignar el total de archivos que contiene la carpeta del registro
			$intTotalArchivos = $this->get_total_archivos_registro($strNombreCarpeta);


		    //Si hay archivos que no se movieron a la carpeta
		    if ($strArchivosNoMovidos != '') 
			{
				//Quitar el último simbolo concatenado y
		        $strArchivosNoMovidos = substr($strArchivosNoMovidos, 0, -2);

				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
							      'total_archivos' => $intTotalArchivos,
					              'mensaje' => 'Ocurrió un error al subir el archivo '.$strArchivosNoMovidos.', vuelva a intentarlo.');
			} 
			else 
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos = array('resultado' => TRUE,
							 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
							 	  'total_archivos' => $intTotalArchivos,
							      'mensaje' => 'El archivo se guardó correctamente.');
				
			}

			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}


	//Método para descargar archivos de un registro
    public function descargar_archivos_detalle($intCajaValeID, $intRenglon)
	{
		//Definir ubicación de la carpeta principal
		$strCarpetaDestino = $this->archivo['strCarpetaDestino'].$intCajaValeID.'/';
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $strCarpetaDestino.$intRenglon;

		//Asignar nombre de la carpeta zip
		$strNombreCarpetaZIP = 'CVR_'.$intCajaValeID.'_'.$intRenglon.'.zip';
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
	public function eliminar_carpeta_detalle()
	{	
		//Variable que se utiliza para asignar el mensaje de error
		$strMensaje = '';
		//Variable que se utiliza para asignar el número de archivos que contiene la carpeta del registro
		$intTotalArchivos = 0;

		//Variables que se utilizan para recuperar los valores de la vista 
		$intCajaValeID = $this->input->post('intCajaValeID');
		$intRenglon = $this->input->post('intRenglon');
		//Definir ubicación de la carpeta principal
		$strCarpetaDestino = $this->archivo['strCarpetaDestino'].$intCajaValeID;
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $strCarpetaDestino.'/'.$intRenglon;
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

        //Asignar el total de archivos que contiene la carpeta del registro
		$intTotalArchivos = $this->get_total_archivos_registro($strCarpetaDestino);

        //Si no existen errores al momento de eliminar la carpeta
        if($strMensaje != '')
        {
        	//Enviar el mensaje de error al formulario
			$arrDatos = array('resultado' => FALSE,
					          'tipo_mensaje' => TIPO_MSJ_ERROR,
					          'total_archivos' => $intTotalArchivos,
			                  'mensaje' => 'Ocurrió un error al eliminar el archivo, vuelva a intentarlo. '.$strMensaje);
        }
        else
        {
        	//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE,
						 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
						 	  'total_archivos' => $intTotalArchivos,
						      'mensaje' => 'El archivo se eliminó correctamente.');
        }

        //Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}
	
}