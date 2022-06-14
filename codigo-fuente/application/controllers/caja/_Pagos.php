<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos extends MY_Controller {

	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Asignar ruta de la carpeta principal
	    $this->archivo['strCarpetaPrincipal'] = './archivos/';
		//Asignar ruta de la carpeta destino
	    $this->archivo['strCarpetaDestino'] = './archivos/pagos/';
		//Cargamos el modelo de pagos
		$this->load->model('caja/pagos_model', 'pagos');
		//Cargamos el modelo de clientes
		$this->load->model('cuentas_cobrar/clientes_model', 'clientes');

	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('caja/pagos', $arrDatos);
	}

	/*******************************************************************************************************************
	Funciones de la tabla pagos
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function _get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->pagos->filtro($this->input->post('dteFechaInicial'),
									   $this->input->post('dteFechaFinal'),
									   $this->input->post('intProspectoID'),
									   $this->input->post('strEstatus'),
									   trim($this->input->post('strBusqueda')),
			                           $config['per_page'],
			                           $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		
		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['pagos'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionVerArchivoRegistro = 'no-mostrar';
			$arrDet->mostrarAccionEnviarCorreo = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			$arrDet->mostrarAccionTimbrar = 'no-mostrar';
			$arrDet->mostrarAccionGenerarPoliza = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;

		    //Concatenar id del registro que hace referencia a la carpeta donde se encuentra el archivo
			$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$arrDet->pago_id;

			//Asignar el nombre del archivo que le corresponde al registro
		    $strNombreArchivo = $this->get_verifar_archivo_registro($strNombreCarpeta, $arrDet->folio);

			//Si no existe UUID
			if($arrDet->uuid == '')
			{
				//Asignar cadena vacia para mostrar botón Timbrar
				$arrDet->mostrarAccionTimbrar = '';
			}

			//Si no existe id de la póliza
			if($arrDet->poliza_id == 0  && ($arrDet->estatus == 'TIMBRAR' OR $arrDet->estatus == 'ACTIVO'))
		    {
		    	//Asignar cadena vacia para mostrar botón Generar póliza
		    	$arrDet->mostrarAccionGenerarPoliza = '';
		    }

			//Si el estatus del registro es TIMBRAR
			if($arrDet->estatus == 'TIMBRAR')
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
					$arrDet->mostrarAccionVerRegistro = '';
				}

				//Si el estatus del registro es ACTIVO
			    if($arrDet->estatus == 'ACTIVO')
			    {

			    	//Si el usuario cuenta con el permiso de acceso ENVIAR CORREO
					if (in_array('ENVIAR CORREO', $arrPermisos))
					{
						//Asignar cadena vacia para mostrar botón Enviar Correo
						$arrDet->mostrarAccionEnviarCorreo = '';
					}

					//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
					if (in_array('CAMBIAR ESTATUS', $arrPermisos))
					{
						//Si se cumple la sentencia
						if(($arrDet->poliza_id > 0 && $arrDet->generarPoliza == 'SI') || $arrDet->generarPoliza == 'NO')
						{
							//Asignar cadena vacia para mostrar botón Desactivar
							$arrDet->mostrarAccionDesactivar = '';
						}
						
					}
					
			    }
				else
				{
					//Agregar clase para ocultar botón Timbrar
					$arrDet->mostrarAccionTimbrar = 'no-mostrar';	
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
    		}
	
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['pagos'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows']);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{

		/*$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->pagos->filtro($this->input->post('dteFechaInicial'),
										  $this->input->post('dteFechaFinal'),
										  $this->input->post('intProspectoID'),
										  trim($this->input->post('strEstatus')),
										  trim($this->input->post('strBusqueda')),
			                              $config['per_page'],
			                              $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		
		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['pagos'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionVerArchivoRegistro = 'no-mostrar';
			$arrDet->mostrarAccionEnviarCorreo = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			$arrDet->mostrarAccionTimbrar = 'no-mostrar';
			$arrDet->mostrarAccionGenerarPoliza = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;
            
            //Concatenar id del registro que hace referencia a la carpeta donde se encuentra el archivo
			$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$arrDet->factura_refacciones_id;

			//Asignar el nombre del archivo que le corresponde al registro
		    $strNombreArchivo = $this->get_verifar_archivo_registro($strNombreCarpeta, $arrDet->folio);
		  
			
			//Si no existe UUID
			if($arrDet->uuid == '')
			{
				//Asignar cadena vacia para mostrar botón Timbrar
				$arrDet->mostrarAccionTimbrar = '';
			}
           

			//Si no existe id de la póliza
			if($arrDet->poliza_id == 0 && ($arrDet->estatus == 'TIMBRAR' OR $arrDet->estatus == 'ACTIVO'))
		    {
		    	//Asignar cadena vacia para mostrar botón Generar póliza
		    	$arrDet->mostrarAccionGenerarPoliza = '';
		    }

		    
		   
			//Si el estatus del registro es TIMBRAR
			if($arrDet->estatus == 'TIMBRAR')
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
					$arrDet->mostrarAccionVerRegistro = '';
				}

				//Si el estatus del registro es ACTIVO
			    if($arrDet->estatus == 'ACTIVO')
			    {

			    	//Si el usuario cuenta con el permiso de acceso ENVIAR CORREO
					if (in_array('ENVIAR CORREO', $arrPermisos))
					{
						//Asignar cadena vacia para mostrar botón Enviar Correo
						$arrDet->mostrarAccionEnviarCorreo = '';
					}

					//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
					if (in_array('CAMBIAR ESTATUS', $arrPermisos) && $arrDet->poliza_id > 0)
					{
						//Asignar cadena vacia para mostrar botón Desactivar
						$arrDet->mostrarAccionDesactivar = '';
					}

			    }
				else 
				{
					//Agregar clase para ocultar botón Timbrar
					$arrDet->mostrarAccionTimbrar = 'no-mostrar';
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
    		}

		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['facturas'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows']);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));*/
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
		$objPago = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista
		//Datos del pago
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objPago->intPagoID = $this->input->post('intPagoID');
		$objPago->dteFecha = $this->input->post('dteFecha');
		$objPago->strMoneda = MONEDA_PAGOS;
		$objPago->intTipoCambio = TIPO_CAMBIO_PAGOS;
		$objPago->intProspectoID = $this->input->post('intProspectoID');
		$objPago->strRazonSocial =  mb_strtoupper(trim($this->input->post('strRazonSocial')));
		$objPago->strRfc =  mb_strtoupper(trim($this->input->post('strRfc')));
		$objPago->strCalle =  mb_strtoupper(trim($this->input->post('strCalle')));
		$objPago->strNumeroExterior = mb_strtoupper($this->input->post('strNumeroExterior'));
		$objPago->strNumeroInterior = mb_strtoupper($this->input->post('strNumeroInterior'));
		$objPago->strCodigoPostal = $this->input->post('strCodigoPostal');
		$objPago->strColonia =  mb_strtoupper(trim($this->input->post('strColonia')));
		$objPago->strLocalidad =  mb_strtoupper(trim($this->input->post('strLocalidad')));
		$objPago->strMunicipio = mb_strtoupper(trim($this->input->post('strMunicipio')));
		$objPago->strEstado =  mb_strtoupper(trim($this->input->post('strEstado')));
		$objPago->strPais = mb_strtoupper(trim($this->input->post('strPais')));
		$objPago->intUsoCfdiID = $this->input->post('intUsoCfdiID');
	    //Si no existe id del tipo de relación asignar valor nulo
		$objPago->intTipoRelacionID = (($this->input->post('intTipoRelacionID') !== '') ? 
						   	   $this->input->post('intTipoRelacionID') : NULL);
		$objPago->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objPago->intSucursalID = $this->session->userdata('sucursal_id');
		$objPago->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los CFDI relacionados
		$objPago->strCfdiRelacionado = $this->input->post('strCfdiRelacionado'); 
		$objPago->strTiposRelacion = $this->input->post('strTiposRelacion'); 
		//Datos de los detalles del pago
		$objPago->arrDetalles = json_decode($this->input->post('arrDetalles'));	
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));

		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objPago->intPagoID))
		{
			$bolResultado = $this->pagos->modificar($objPago);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objPago->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objPago->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->pagos->guardar($objPago);

				/*Quitar '_'  de la cadena (resultadoTransaccion_pagoID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $objPago->intPagoID) = explode("_", $bolResultado); 
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
							 	  'pago_id' => $objPago->intPagoID,
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
		$intID = $this->input->post('intPagoID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->pagos->buscar($intID);
	    //Variable que se utiliza para asignar la fecha actual 
		$dteFechaCorte = date("Y-m-d");

		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Concatenar id del registro que hace referencia a la carpeta donde se encuentra el archivo
			$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intID;

			//Asignar el nombre del archivo que le corresponde al registro
	        $arrDatos['archivo'] = $this->get_verifar_archivo_registro($strNombreCarpeta, $otdResultado->folio);
			$arrDatos['row'] = $otdResultado;

			//Seleccionar los detalles del registro
			$otdDetalles = $this->pagos->buscar_detalles($intID);
			//Si existen detalles del registro, se asignan al array
			if($otdDetalles)
			{
				//Hacer recorrido para agregar los detalles relacionados del registro
				foreach ($otdDetalles as $arrDet)
				{
					//Seleccionar los detalles relacionados del registro
					$otdDetallesRelacionados = $this->pagos->buscar_detalles_relacionados($intID, $arrDet->renglon);
					//Si existen detalles relacionados del registro, se asignan al array
					if($otdDetallesRelacionados)
					{
						//Hacer recorrido para obtener el saldo actual de la factura 
						foreach ($otdDetallesRelacionados as $arrDetRel)
						{
						    //Asignar saldo actual de la factura
							$intSaldoFactura = $this->get_saldo_factura($arrDetRel->referencia_id, 
													 				    $arrDetRel->tipo_referencia);

							//Asignar el saldo actual de la factura
							$arrDetRel->saldo_factura = $intSaldoFactura;

						}

						$arrDet->arrDetallesRelacionados =  $otdDetallesRelacionados;
					}
				}

				$arrDatos['detalles'] = $otdDetalles;

			}

		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Función para cancelar administrativamente un registro
	public function set_cancelar()
	{
	     //Definir las reglas de validación
		$this->form_validation->set_rules('intPagoID', 'ID', 'required|integer');
		//Si no cumple con las validaciones
		if ($this->form_validation->run() == FALSE)
		{
			//Enviar el mensaje de error al formulario
			$arrDatos = array('resultado' => FALSE, 'tipo_mensaje' => TIPO_MSJ_ERROR, 'mensaje' => validation_errors());
		}
		else
		{   
			//Variables que se utilizan para recuperar los valores de la vista 
	        $intID = $this->input->post('intPagoID');
	        $intPolizaID = $this->input->post('intPolizaID');
	        //Hacer un llamado al método para cancelar un pago
			$bolResultado = $this->pagos->set_cancelar($intID, $intPolizaID);
			//Si no se obtienen errores al ejecutar el proceso
			if($bolResultado)
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos = array('resultado' => TRUE, 
								  'tipo_mensaje' => TIPO_MSJ_EXITO, 
								  'mensaje' => MSJ_CANCELACION);
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
	public function get_reporte() 
	{	            
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProspectoID = $this->input->post('intProspectoID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strDetalles = $this->input->post('strDetalles');

		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->pagos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, 
		 									 $strEstatus, $strBusqueda);
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
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
		$pdf->strLinea1 =  'LISTADO DE PAGOS '.$strTituloRangoFechas;
		//Si existe id del cliente
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del cliente que coincide con el id
			$otdProspecto =  $this->clientes->buscar($intProspectoID);
			$pdf->strLinea2 = utf8_decode('RAZÓN SOCIAL: '.$otdProspecto->razon_social);
		}

		//Establece los títulos de la cabeceras
		$pdf->arrCabecera = array('FOLIO', utf8_decode('RAZÓN SOCIAL'),  'RFC',
								  'FECHA', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(20, 100, 30, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'C', 'C');
		//Establece el ancho de las columnas de cabecera detalles del pago
		$arrAnchuraDetalles = array(30, 40, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla detalles del pago
		$arrAlineacionDetalles = array('L', 'L', 'C', 'R', 'R');
		//Establece el ancho de las columnas de cabecera detalles relacionados del pago
		$arrAnchuraDetRelPago = array(45, 15, 15, 15, 15, 15, 18, 20, 20);
		//Establece la alineación de las celdas de la tabla detalles relacionados del pago
		$arrAlineacionDetRelPago = array('L', 'L', 'C',  'R', 'C', 'R', 'R', 'R', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo para obtener la información de los pagos
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, utf8_decode($arrCol->razon_social), 
								$arrCol->rfc, $arrCol->fecha_format, $arrCol->estatus), 
							    $pdf->arrAlineacion, 'ClippedCell');
				
				//Seleccionar los detalles del pago
	    		$otdDetalles = $this->pagos->buscar_detalles($arrCol->pago_id);
	    		//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDetP)
					{
						$pdf->SetX(15);
						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraDetalles);

						//Variable que se utiliza para asignar la fecha de pago del detalle
						$strFechaPago = substr($arrDetP->fecha, 0, 10)."T".substr($arrDetP->fecha_pago, 11);
						//Variable que se utiliza para asignar la moneda del pago
						$intMonedaIDDetallePago = $arrDetP->moneda_id;
						//Asignar tipo de cambio del detalle
						$intTipoCambioP = number_format($arrDetP->tipo_cambio, 4, '.', '');

						//Convertir peso mexicano a tipo de cambio
						$intMonto = ($arrDetP->monto / $intTipoCambioP);

						//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						$pdf->Row(array($strFechaPago, utf8_decode($arrDetP->forma_pago), $arrDetP->MonedaTipo, 
										'$'.$intTipoCambioP, '$'.number_format($intMonto, 2)), 
										$arrAlineacionDetalles, 'ClippedCell');

						
						//Asignar el id de la 
						//Seleccionar los detalles relacionados del pago
	    				$otdDetallesRelPago = $this->pagos->buscar_detalles_relacionados($arrCol->pago_id, $arrDetP->renglon);
	    				//Verificar si existe información de los detalles relacionados
						if ($otdDetallesRelPago) 
						{
							//Establece el ancho de las columnas
							$pdf->SetWidths($arrAnchuraDetRelPago);
							
							//Recorremos el arreglo 
							foreach ($otdDetallesRelPago as $arrDetRP)
							{
								$pdf->SetX(18);

								//Variable que se utiliza para asignar el id de la moneda del detalle relacionado
								$intMonedaIDRP = $arrDetRP->moneda_id;
								//Variable que se utiliza para asignar el tipo de cambio del detalle relacionado
								$intTipoCambioRP = number_format($arrDetRP->tipo_cambio, 4, '.', '');
								//Convertir tipo de cambio (detalle relacionado) a flotante
								$intConvTipoCambioRP = (float)$intTipoCambioRP;
								//Variable que se utiliza para asignar el saldo anterior del detalle relacionado
								$intImpSaldoAntRP = $arrDetRP->imp_saldo_ant;
								//Variable que se utiliza para asignar el importe pagado del detalle relacionado
								$intImpPagadoRP = $arrDetRP->imp_pagado;
								//Variable que se utiliza para asignar el saldo insoluto del detalle relacionado
								$intImpSaldoInsolutoRP = $arrDetRP->imp_saldo_insoluto;

								//Convertir tipo de cambio (detalle del pago) a flotante
								$intTipoCambioDetallePago = (float)$intTipoCambioP;


								//Si la moneda del pago es diferente a la moneda de la factura
								if($intMonedaIDDetallePago != $intMonedaIDRP)
								{
								    //Asignar el tipo de cambio de la factura
									$intTipoCambioDetallePago = $intConvTipoCambioRP;
								}


								//Convertir peso mexicano a tipo de cambio del pago
								$intImpSaldoAntRP = ($intImpSaldoAntRP / $intTipoCambioDetallePago);
							    $intImpPagadoRP = ($intImpPagadoRP / $intTipoCambioDetallePago);
							    $intImpSaldoInsolutoRP = ($intImpSaldoInsolutoRP / $intTipoCambioDetallePago);

								
								//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
								$pdf->Row(array($arrDetRP->uuid, $arrDetRP->folio, $arrDetRP->moneda_tipo, 
												'$'.$intTipoCambioRP, $arrDetRP->metodo_pago,
											    $arrDetRP->num_parcialidad, '$'.number_format($intImpSaldoAntRP,2), 
											    '$'.number_format($intImpPagadoRP,2),
											    '$'.number_format($intImpSaldoInsolutoRP,2)), 
												$arrAlineacionDetRelPago, 'ClippedCell', 'SI');
							}

							$pdf->Ln(2);//Deja un salto de línea

						}//Cierre de verificación de detalles relacionados

					}

					$pdf->Ln(2);//Deja un salto de línea
				
				}//Cierre de verificación de detalles del pago

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
		$pdf->Output('pagos.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProspectoID = $this->input->post('intProspectoID');
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
		$otdResultado = $this->pagos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, 
											 $strEstatus,  $strBusqueda);
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
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
			     ->setCellValue('A7', 'LISTADO DE PAGOS '.$strTituloRangoFechas);
		//Si existe id del cliente
		if($intProspectoID > 0)
		{   //Seleccionar los datos del cliente que coincide con el id
			$otdProspecto =  $this->clientes->buscar($intProspectoID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'RAZÓN SOCIAL: '.$otdProspecto->razon_social);
		}
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'RAZÓN SOCIAL')
        		 ->setCellValue('C'.$intPosEncabezados, 'RFC')
        		 ->setCellValue('D'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('E'.$intPosEncabezados, 'USO DEL CFDI')
        		 ->setCellValue('F'.$intPosEncabezados, 'TIPO DE RELACIÓN')
        		 ->setCellValue('G'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('H'.$intPosEncabezados, 'ESTATUS')
        		 ->setCellValue('I'.$intPosEncabezados, 'FECHA DE PAGO')
        		 ->setCellValue('J'.$intPosEncabezados, 'FORMA DE PAGO')
        		 ->setCellValue('K'.$intPosEncabezados, 'MONEDA DE PAGO')
        		 ->setCellValue('L'.$intPosEncabezados, 'TIPO DE CAMBIO')
        		 ->setCellValue('M'.$intPosEncabezados, 'MONTO')
        		 ->setCellValue('N'.$intPosEncabezados, 'NÚMERO DE OPERACIÓN')
        		 ->setCellValue('O'.$intPosEncabezados, 'RFC CUENTA ORDENANTE')
        		 ->setCellValue('P'.$intPosEncabezados, 'CUENTA ORDENANTE')
        		 ->setCellValue('Q'.$intPosEncabezados, 'BANCO ORDENANTE')
        		 ->setCellValue('R'.$intPosEncabezados, 'RFC CUENTA BENEFICIARIO')
        		 ->setCellValue('S'.$intPosEncabezados, 'CUENTA BENEFICIARIO')
        		 ->setCellValue('T'.$intPosEncabezados, 'TIPO DE CADENA DE PAGO')
        		 ->setCellValue('U'.$intPosEncabezados, 'CERTIFICADO DE PAGO')
        		 ->setCellValue('V'.$intPosEncabezados, 'CADENA DE PAGO')
        		 ->setCellValue('W'.$intPosEncabezados, 'SELLO DE PAGO')
        		 ->setCellValue('X'.$intPosEncabezados, 'UUID')
        		 ->setCellValue('Y'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('Z'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('AA'.$intPosEncabezados, 'TIPO DE CAMBIO')
        		 ->setCellValue('AB'.$intPosEncabezados, 'MÉTODO PAGO')
        		 ->setCellValue('AC'.$intPosEncabezados, 'PARCIALIDAD')
        		 ->setCellValue('AD'.$intPosEncabezados, 'ANTERIOR')
        		 ->setCellValue('AE'.$intPosEncabezados, 'PAGADO')
        		 ->setCellValue('AF'.$intPosEncabezados, 'INSOLUTO');
        //Definir estilo de las celdas correspondientes a los encabezados
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
    			 ->getStyle('A10:AF10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

    	//Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:AF10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:AF10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				
                //Seleccionar los detalles del pago
	    		$otdDetalles = $this->pagos->buscar_detalles($arrCol->pago_id);
	    		//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDetP)
					{
						//Variable que se utiliza para asignar la fecha de pago del detalle
						$strFechaPago = substr($arrDetP->fecha, 0, 10)."T".substr($arrDetP->fecha_pago, 11);
						//Variable que se utiliza para asignar la moneda del pago
						$intMonedaIDDetallePago = $arrDetP->moneda_id;
						//Asignar tipo de cambio del detalle
						$intTipoCambioP = number_format($arrDetP->tipo_cambio, 4, '.', '');

					    //Convertir peso mexicano a tipo de cambio
						$intMonto = ($arrDetP->monto / $intTipoCambioP);

						//Seleccionar los detalles relacionados del pago
	    				$otdDetallesRelPago = $this->pagos->buscar_detalles_relacionados($arrCol->pago_id, $arrDetP->renglon);
	    				//Verificar si existe información de los detalles relacionados
						if ($otdDetallesRelPago) 
						{
							
							//Recorremos el arreglo 
							foreach ($otdDetallesRelPago as $arrDetRP)
							{

								//Variable que se utiliza para asignar el id de la moneda del detalle relacionado
								$intMonedaIDRP = $arrDetRP->moneda_id;
								//Variable que se utiliza para asignar el tipo de cambio del detalle relacionado
								$intTipoCambioRP = number_format($arrDetRP->tipo_cambio, 4, '.', '');
								//Convertir tipo de cambio (detalle relacionado) a flotante
								$intConvTipoCambioRP = (float)$intTipoCambioRP;
								//Variable que se utiliza para asignar el saldo anterior del detalle relacionado
								$intImpSaldoAntRP = $arrDetRP->imp_saldo_ant;
								//Variable que se utiliza para asignar el importe pagado del detalle relacionado
								$intImpPagadoRP = $arrDetRP->imp_pagado;
								//Variable que se utiliza para asignar el saldo insoluto del detalle relacionado
								$intImpSaldoInsolutoRP = $arrDetRP->imp_saldo_insoluto;

								//Convertir tipo de cambio (detalle del pago) a flotante
								$intTipoCambioDetallePago = (float)$intTipoCambioP;

								//Si la moneda del pago es diferente a la moneda de la factura
								if($intMonedaIDDetallePago != $intMonedaIDRP)
								{
								    //Asignar el tipo de cambio de la factura
									$intTipoCambioDetallePago = $intConvTipoCambioRP;
								}

								//Convertir peso mexicano a tipo de cambio del pago
								$intImpSaldoAntRP = ($intImpSaldoAntRP / $intTipoCambioDetallePago);
							    $intImpPagadoRP = ($intImpPagadoRP / $intTipoCambioDetallePago);
							    $intImpSaldoInsolutoRP = ($intImpSaldoInsolutoRP / $intTipoCambioDetallePago);

					        	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
								//Agregar información del registro
								$objExcel->setActiveSheetIndex(0)
								 		->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
								 		->setCellValue('B'.$intFila, $arrCol->razon_social)
				                        ->setCellValue('C'.$intFila, $arrCol->rfc)
				                        ->setCellValue('D'.$intFila, $arrCol->fecha_format)
				                        ->setCellValue('E'.$intFila, $arrCol->uso_cfdi)
				                        ->setCellValue('F'.$intFila, $arrCol->tipo_relacion)
				                        ->setCellValue('G'.$intFila, $arrCol->observaciones)
				                        ->setCellValue('H'.$intFila, $arrCol->estatus)
				                        ->setCellValue('I'.$intFila, $strFechaPago)
						        		->setCellValue('J'.$intFila, $arrDetP->forma_pago)
						        		->setCellValue('K'.$intFila, $arrDetP->moneda)
						        		->setCellValue('L'.$intFila, $intTipoCambioP)
						        		->setCellValue('M'.$intFila, $intMonto)
						        		->setCellValueExplicit('N'.$intFila, $arrDetP->num_operacion, PHPExcel_Cell_DataType::TYPE_STRING)
						        		->setCellValue('O'.$intFila, $arrDetP->rfc_emisor_cta_ord)
						        		->setCellValueExplicit('P'.$intFila, $arrDetP->cta_ordenante, PHPExcel_Cell_DataType::TYPE_STRING)
						        		->setCellValue('Q'.$intFila, $arrDetP->nom_banco_ord_ext)
						        		->setCellValue('R'.$intFila, $arrDetP->rfc_emisor_cta_ben)
						        		->setCellValueExplicit('S'.$intFila, $arrDetP->cta_beneficiario, PHPExcel_Cell_DataType::TYPE_STRING)
						        		->setCellValue('T'.$intFila, $arrDetP->cadena_pago)
						        		->setCellValueExplicit('U'.$intFila, $arrDetP->cer_pago, PHPExcel_Cell_DataType::TYPE_STRING)
						        		->setCellValueExplicit('V'.$intFila, $arrDetP->cad_pago, PHPExcel_Cell_DataType::TYPE_STRING)
						        		->setCellValueExplicit('W'.$intFila, $arrDetP->sello_pago, PHPExcel_Cell_DataType::TYPE_STRING)
						        		->setCellValueExplicit('X'.$intFila, $arrDetRP->uuid, PHPExcel_Cell_DataType::TYPE_STRING)
						        		->setCellValueExplicit('Y'.$intFila, $arrDetRP->folio, PHPExcel_Cell_DataType::TYPE_STRING)
						        		->setCellValue('Z'.$intFila, $arrDetRP->moneda)
						        		->setCellValue('AA'.$intFila, $arrDetRP->tipo_cambio)
						        		->setCellValue('AB'.$intFila, $arrDetRP->metodo_pago)
						        		->setCellValue('AC'.$intFila, $arrDetRP->num_parcialidad)
						        		->setCellValue('AD'.$intFila, $intImpSaldoAntRP)
						        		->setCellValue('AE'.$intFila, $intImpPagadoRP)
						        		->setCellValue('AF'.$intFila, $intImpSaldoInsolutoRP);
	                    		
	                    		//Incrementar el indice para escribir los datos del siguiente registro
	               				$intFila++;


							}

						}//Cierre de verificación de detalles relacionados

					}
				
				}//Cierre de verificación de detalles del pago


			    //Incrementar el contador por cada registro
				$intContador++;
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('M'.$intFilaInicial.':'.'M'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            $objExcel->getActiveSheet()
            		 ->getStyle('AD'.$intFilaInicial.':'.'AF'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');


            //Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('L'.$intFilaInicial.':'.'L'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.0000');

            $objExcel->getActiveSheet()
            		 ->getStyle('AA'.$intFilaInicial.':'.'AA'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.0000');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('H'.$intFilaInicial.':'.'I'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('L'.$intFilaInicial.':'.'M'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);		

            $objExcel->getActiveSheet()
		        	 ->getStyle('AA'.$intFilaInicial.':'.'AA'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);
                	  
			$objExcel->getActiveSheet()
                	 ->getStyle('AC'.$intFilaInicial.':'.'AF'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('H'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('H'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'pagos.xls', 'pagos', $intFila);
	}

	

	/*******************************************************************************************************************
	Funciones de las facturas
	*********************************************************************************************************************/
	//Método para regresar todas las facturas de un cliente (historial)
	public function get_historial_facturas()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('rows' => NULL, 
						  'acumulado_importe' => '$0.00', 
						  'acumulado_anticipos' => '$0.00');

		//Variables que se utilizan para recuperar los valores de la vista 
		$intProspectoID = $this->input->post('intProspectoID');
		$intMonedaIDPago = $this->input->post('intMonedaIDPago');
		$intTipoCambioPago = $this->input->post('intTipoCambioPago');
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');

		//Array que se utiliza para agregar las facturas 
        $arrFacturas = array();
        //Array que se utiliza para agregar los datos de una factura
        $arrAuxiliar = array();
        //Variable que se utiliza para asignar el acumulado del importe de la factura
	    $intAcumImporteFactura = 0;
	    //Variable que se utiliza para asignar el acumulado de anticipos
	    $intAcumAnticipos = 0;
		
		//Seleccionar los datos de las facturas que coinciden con el parámetro enviado
		$otdResultado = $this->pagos->buscar_facturas_importes('grid_view', $dteFechaFinal, $intProspectoID, 
															    NULL, NULL, NULL, NULL, $dteFechaInicial);

		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Hacer recorrido para obtener facturas
			foreach ($otdResultado as $arrCol)
			{
				//Variable que se utiliza para asignar el id de la factura
				$intReferenciaID = $arrCol->referencia_id;
				//Variable que se utiliza para asignar el tipo de referencia (MAQUINARIA/REFACCIONES/SERVICIO/CARTERA) de la factura 
				$strTipoReferencia =  $arrCol->tipo_referencia;

				//Asignar el importe total de la factura (se usa en el cfdi relacionado) sin separarlo por sus tasas
				$intImporteFacturaCfdi = $arrCol->importe;


				//Seleccionar las tasas de los detalles (agrupados por tasa_cuota_iva y tasa_cuota_ieps) de la factura 
	            $otdTasas =  $this->pagos->buscar_tasas_detalles_facturas($intReferenciaID, $strTipoReferencia);

	            //Si hay información
				if($otdTasas)
				{
					//Hacer recorrido para obtener las distintas tasas de los detalles de la factura
					foreach ($otdTasas as $arrTasa)
					{
						//Variable que se utiliza para asignar el tipo de la tasa o cuota del impuesto de IEPS
					    $strTipoTasaCuotaIeps = $arrTasa->tipo_ieps;
					    //Variable que se utiliza para asignar el factor de la tasa o cuota del impuesto de IEPS
		   				$strFactorTasaCuotaIeps = $arrTasa->factor_ieps;

						//Seleccionar los importes de la factura por su tasa
						$otdImportesTasa = $this->pagos->buscar_facturas_importes(NULL, NULL, NULL, NULL, NULL, 
																				  $intReferenciaID, $strTipoReferencia, 
																				   NULL, NULL, NULL, 
																				   $arrTasa->tasa_cuota_iva, 
																   				   $arrTasa->tasa_cuota_ieps);

						//Si hay información
						if($otdImportesTasa)
						{
							//Asignar primer posición del arreglo
							$otdImportesTasa = $otdImportesTasa[0];
							//Variables que se utilizan para asignar valores de la factura
							$intMonedaID =  $arrCol->moneda_id;
		                    $intTipoCambio =  $arrCol->tipo_cambio;
		                    $intSubtotalFactura = $otdImportesTasa->subtotal;
		                    $intIepsFactura = $otdImportesTasa->ieps;
		                    $intImporteFactura = $otdImportesTasa->importe;

		                    //Variable que se utiliza para asignar el importe de la factura (correspondiente a la moneda del pago)
	      			        $intImporteFacturaAux = number_format($intImporteFactura, 2, '.', '');



		                    //Si el tipo de moneda de la factura es diferente a la moneda del pago
							if($intMonedaID !== $intMonedaIDPago )
							{
								//Convertir importe a peso mexicano
								$intImporteFacturaAux = $intImporteFacturaAux *  $intTipoCambio;

								//Si el tipo de moneda de la factura corresponde a peso mexicano
							    if($intMonedaID == MONEDA_BASE)
								{
									//Convertir peso mexicano a tipo de cambio
									$intImporteFacturaAux = $intImporteFacturaAux / $intTipoCambioPago;
								}
							}

							 //Si la tasa de cuota es de tipo RANGO y su factor es Cuota
							if($strTipoTasaCuotaIeps == 'RANGO' && $strFactorTasaCuotaIeps == 'Cuota')
							{
								//Sumarle al subtotal el importe de ieps
								$intSubtotalFactura += $intIepsFactura;
								//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
					   	 		$intIepsFactura = 0;
							}


							//Definir valores del array auxiliar de información (para cada factura)
							$arrAuxiliar["referencia_id"] = $arrCol->referencia_id;
							$arrAuxiliar["tipo_referencia"] = $arrCol->tipo_referencia;
							$arrAuxiliar["uuid"] = $arrCol->uuid;
							$arrAuxiliar["folio"] = $arrCol->folio;
							$arrAuxiliar["moneda_id"] =  $intMonedaID;
							$arrAuxiliar["moneda_tipo"] = $arrCol->moneda_tipo;
							$arrAuxiliar["tipo_cambio"] = $intTipoCambio;
							$arrAuxiliar["metodo_pago_id"] = $arrCol->metodo_pago_id;
							$arrAuxiliar["metodo_pago"] = $arrCol->metodo_pago;
							$arrAuxiliar["fecha"] = $arrCol->fecha_format;
							$arrAuxiliar["subtotal"] = number_format($intSubtotalFactura, 2);
							$arrAuxiliar["tasa_cuota_iva"] = $arrTasa->tasa_cuota_iva;
							$arrAuxiliar["porcentaje_iva"] = $arrTasa->porcentaje_iva;
							$arrAuxiliar["iva"] = number_format($otdImportesTasa->iva, 2);
							$arrAuxiliar["tasa_cuota_ieps"] = $arrTasa->tasa_cuota_ieps;
							$arrAuxiliar["porcentaje_ieps"] = $arrTasa->porcentaje_ieps;
							$arrAuxiliar["ieps"] = number_format($intIepsFactura, 2);
							$arrAuxiliar["importe"] = number_format($intImporteFactura, 2);
							$arrAuxiliar["tipo_ieps"] = $strTipoTasaCuotaIeps;
							$arrAuxiliar["factor_ieps"] = $strFactorTasaCuotaIeps;
							$arrAuxiliar["tipo_referencia_cfdi"] = $arrCol->tipo_referencia_cfdi;
							$arrAuxiliar["importe_fra_cfdi"] = '$'.number_format($intImporteFacturaCfdi,2);
							//Asignar datos al array
		                    array_push($arrFacturas, $arrAuxiliar); 

		                    //Incrementar acumulado del importe de la factura
						    $intAcumImporteFactura += $intImporteFacturaAux;

						}//Cierre de verificación de importe de la factura		


					}//Cierre de foreach tasas de los detalles de la factura

				}//Cierre de verificación de tasas de los detalles de la factura
				
			}//Cierre de foreach facturas

			//Agregar valores al array
			$arrDatos['rows'] = $arrFacturas;

			//Seleccionar el total de anticipos del cliente
			$otdAnticipos = $this->pagos->buscar_anticipo_facturas_adeudos($dteFechaFinal, 
																		   $intProspectoID);
			//Si hay información
			if($otdAnticipos)
			{
				//Recorremos el arreglo 
				foreach ($otdAnticipos as $arrAnt)
				{
					//Variables que se utilizan para asignar valores del anticipo
					$intMonedaID =  $arrAnt->moneda_id;
					$intTipoCambio =  $arrAnt->tipo_cambio;
					//Variable que se utiliza para asignar el importe del anticipo (correspondiente a la moneda del pago)
               		$intAnticipo = $arrAnt->importe;

					//Si el tipo de moneda del anticipo es diferente a la moneda del pago
					if($intMonedaID !== $intMonedaIDPago )
					{
						//Convertir importe a peso mexicano
						$intAnticipo = $intAnticipo *  $intTipoCambio;

						//Si el tipo de moneda de la factura corresponde a peso mexicano
					    if($intMonedaID == MONEDA_BASE)
						{
							//Convertir peso mexicano a tipo de cambio
							$intAnticipo = $intAnticipo / $intTipoCambioPago;
						}
					}

					 //Incrementar acumulado del anticipo
					$intAcumAnticipos += $intAnticipo;
				
				}

			}//Cierre de verificación de anticipos


			//Convertir cantidad a formato moneda
			$arrDatos['acumulado_importe'] = '$'.number_format($intAcumImporteFactura,2);
			$arrDatos['acumulado_anticipos'] = '$'.number_format($intAcumAnticipos,2);

		}//Cierre de verificación de información

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	//Método para regresar las facturas con adeudos de un cliente
	public function get_facturas_adeudos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('rows' => NULL, 
						  'acumulado_saldo' => '$0.00', 
						  'acumulado_saldo_vencido' => '$0.00', 
						  'acumulado_anticipos' => '$0.00');
		//Variables que se utilizan para recuperar los valores de la vista 
		$intProspectoID = $this->input->post('intProspectoID');
		$intMonedaIDPago = $this->input->post('intMonedaIDPago');
		$intTipoCambioPago = $this->input->post('intTipoCambioPago');
		$strTipo = $this->input->post('strTipo');
		//Variable que se utiliza para asignar la fecha actual 
		$dteFechaCorte = date("Y-m-d");
		//Array que se utiliza para agregar las facturas con adeudo
        $arrFacturas = array();
        //Array que se utiliza para agregar los datos de una factura
        $arrAuxiliar = array();
        //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Variable que se utiliza para asignar el acumulado de anticipos
	    $intAcumAnticipos = 0;

		//Seleccionar los datos de las facturas que coinciden con el parámetro enviado
		$otdResultado = $this->pagos->buscar_facturas_importes('grid_view', $dteFechaCorte, $intProspectoID, $strTipo);

		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Hacer recorrido para obtener facturas
			foreach ($otdResultado as $arrCol)
			{
				//Variable que se utiliza para asignar el id de la factura
				$intReferenciaID = $arrCol->referencia_id;
				//Variable que se utiliza para asignar el tipo de referencia (MAQUINARIA/REFACCIONES/SERVICIO/CARTERA) de la factura 
				$strTipoReferencia =  $arrCol->tipo_referencia;
				//Variable que se utiliza para asignar el saldo de la factura
			    $intSaldoFactura = $arrCol->saldo;

				//Si el tipo de referencia no corresponde a PAGO (agrupar facturas por tasas)
				if($strTipo != 'PAGO')
				{
					//Variable que se utiliza para asignar el total de pagos (recepción de pagos) aplicados a la factura 
					$intTotalPagos = 0;

					//Si la factura no se encuentra pagada
					//if (($intSaldoFactura >= 1) OR ($intSaldoFactura <= -1)) //Validación anterior
					if ($intSaldoFactura > 0)
					{
						//Asignar acumulado de pagos (recepción de pagos)
						$intTotalPagos = $arrCol->pagos;

						//Seleccionar las tasas de los detalles (agrupados por tasa_cuota_iva y tasa_cuota_ieps) de la factura 
	               		$otdTasas =  $this->pagos->buscar_tasas_detalles_facturas($intReferenciaID, $strTipoReferencia);

	               		//Si hay información
						if($otdTasas)
						{
							//Hacer recorrido para obtener las distintas tasas de los detalles de la factura
							foreach ($otdTasas as $arrTasa)
							{
								//Variable que se utiliza para asignar el id de la tasa o cuota del impuesto de IVA
							    $intTasaCuotaIva = $arrTasa->tasa_cuota_iva;
							    //Variable que se utiliza para asignar el id de la tasa o cuota del impuesto de IEPS
							    $intTasaCuotaIeps = $arrTasa->tasa_cuota_ieps;

								//Variable que se utiliza para asignar el tipo de la tasa o cuota del impuesto de IEPS
							    $strTipoTasaCuotaIeps = $arrTasa->tipo_ieps;
							    //Variable que se utiliza para asignar el factor de la tasa o cuota del impuesto de IEPS
				   				$strFactorTasaCuotaIeps = $arrTasa->factor_ieps;


								//Seleccionar los importes de la factura por su tasa
								$otdImportesTasa = $this->pagos->buscar_facturas_importes(NULL, $dteFechaCorte, NULL, 
											   				  		   				  NULL, NULL, $intReferenciaID, 
											   				           				  $strTipoReferencia, NULL, NULL, 
											   				           				  NULL, $intTasaCuotaIva, 
											   				           				  $intTasaCuotaIeps);


								//Si hay información
								if($otdImportesTasa)
								{
									//Asignar primer posición del arreglo
									$otdImportesTasa = $otdImportesTasa[0];

									//Asignar el saldo de la factura que le corresponde a la tasa
									$intSaldoTasa = $otdImportesTasa->saldo_tasa;


									//Si la factura no se encuentra pagada 
									//if (($intSaldoTasa >= 1) OR ($intSaldoTasa <= -1)) //Validación anterior
									if ($intSaldoTasa > 0)
									{
										//Variables que se utilizan para asignar valores de la factura
										$intSaldoVencido = 0;
					                    $dteFechaVencimiento = $arrCol->fecha_vencimiento;
					                    $intMonedaID =  $arrCol->moneda_id;
					                    $intTipoCambio =  $arrCol->tipo_cambio;
					                    $intSubtotalFactura = $otdImportesTasa->subtotal;
					                    $intIepsFactura = $otdImportesTasa->ieps;

										//Si se cumple la sentencia (decrementar el acumulado de los pagos)
					                    if($intTotalPagos > $intSaldoTasa)
					                    {
					                    	//Decrementar el acumulado de los pagos (recepción de pagos)
					                    	$intTotalPagos -= $intSaldoTasa;
					                    	//Asignar valor cero para indicar que ya se saldo la factura con esta tasa
					                    	$intSaldoTasa = 0;
					                    }
					                    else
					                    {
					                    	//Decrementar el saldo de la tasa
					                    	$intSaldoTasa -= $intTotalPagos;
					                    	//Asignar valor cero para evitar decrementar el resto del acumulado de pagos
					                    	$intTotalPagos = 0;

					                    }


										//Variable que se utiliza para asignar el saldo de la factura (correspondiente a la moneda del pago)
				      			        $intSaldoAux = number_format($intSaldoTasa, 2, '.', '');

					                    //Si el tipo de moneda de la factura es diferente a la moneda del pago
										if($intMonedaID !== $intMonedaIDPago )
										{
											//Convertir importe a peso mexicano
											$intSaldoAux = $intSaldoAux *  $intTipoCambio;

											//Si el tipo de moneda de la factura corresponde a peso mexicano
										    if($intMonedaID == MONEDA_BASE)
											{
												//Convertir peso mexicano a tipo de cambio
												$intSaldoAux = $intSaldoAux / $intTipoCambioPago;
											}
										}


										//Si la fecha de vencimiento es menor que la fecha de corte
					                    if ($dteFechaVencimiento < $dteFechaCorte)
					                    {
					                    	//Asignar saldo de la factura
					                        $intSaldoVencido = $intSaldoTasa;
					                        //Incrementar acumulado del saldo vencido
					                        $intAcumSaldoVencido += $intSaldoAux;
					                    }
					                    

						                //Si la tasa de cuota es de tipo RANGO y su factor es Cuota
										if($strTipoTasaCuotaIeps == 'RANGO' && $strFactorTasaCuotaIeps == 'Cuota')
										{
											//Sumarle al subtotal el importe de ieps
											$intSubtotalFactura += $intIepsFactura;
											//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
								   	 		$intIepsFactura = 0;
										}


										//Si existe saldo de la tasa
						                if($intSaldoTasa > 0)
						                {
						                	//Definir valores del array auxiliar de información (para cada factura)
											$arrAuxiliar["referencia_id"] = $arrCol->referencia_id;
											$arrAuxiliar["tipo_referencia"] = $arrCol->tipo_referencia;
											$arrAuxiliar["uuid"] = $arrCol->uuid;
											$arrAuxiliar["folio"] = $arrCol->folio;
											$arrAuxiliar["moneda_id"] =  $intMonedaID;
											$arrAuxiliar["moneda_tipo"] = $arrCol->moneda_tipo;
											$arrAuxiliar["tipo_cambio"] = $intTipoCambio;
											$arrAuxiliar["metodo_pago_id"] = $arrCol->metodo_pago_id;
											$arrAuxiliar["metodo_pago"] = $arrCol->metodo_pago;
											$arrAuxiliar["fecha"] = $arrCol->fecha_format;
											$arrAuxiliar["vencimiento"] = $arrCol->fecha_vencimiento_format;
											$arrAuxiliar["subtotal"] = number_format($intSubtotalFactura, 2);
											$arrAuxiliar["tasa_cuota_iva"] = $arrTasa->tasa_cuota_iva;
											$arrAuxiliar["porcentaje_iva"] = $arrTasa->porcentaje_iva;
											$arrAuxiliar["iva"] = number_format($otdImportesTasa->iva, 2);
											$arrAuxiliar["tasa_cuota_ieps"] = $arrTasa->tasa_cuota_ieps;
											$arrAuxiliar["porcentaje_ieps"] = $arrTasa->porcentaje_ieps;
											$arrAuxiliar["ieps"] = number_format($intIepsFactura, 2);
											$arrAuxiliar["importe"] = number_format($otdImportesTasa->importe, 2);
											$arrAuxiliar["saldo"] = number_format($intSaldoTasa, 2);
											$arrAuxiliar["saldo_vencido"] = number_format($intSaldoVencido, 2);
											$arrAuxiliar["tipo_ieps"] = $strTipoTasaCuotaIeps;
											$arrAuxiliar["factor_ieps"] = $strFactorTasaCuotaIeps;
											$arrAuxiliar["tipo_referencia_cfdi"] = $arrCol->tipo_referencia_cfdi;
											$arrAuxiliar["importe_fra_cfdi"] = '$'.number_format($arrCol->importe,2);
											//Asignar datos al array
						                    array_push($arrFacturas, $arrAuxiliar); 

						                    //Incrementar acumulado del saldo
						                    $intAcumSaldo += $intSaldoAux;

						                }//Cierre de verificación del saldo por su tasa

									}//Cierre de verificación del saldo

								}//Cierre de verificación de importe y saldo de la factura	

							}//Cierre de foreach tasas de los detalles de la factura

						}//Cierre de verificación de tasas de los detalles de la factura

					}//Cierre de verificación del saldo
				}
				else
				{
					
					//Si la factura no se encuentra pagada
					//if (($intSaldoFactura >= 1) OR ($intSaldoFactura <= -1))//Validación anterior
					if($intSaldoFactura > 0)
					{
						//Variables que se utilizan para asignar valores de la factura
						$intSaldoVencido = 0;
	                    $dteFechaVencimiento = $arrCol->fecha_vencimiento;
	                    $intMonedaID =  $arrCol->moneda_id;
	                    $intTipoCambio =  $arrCol->tipo_cambio;
	                    $intSubtotalFactura = $arrCol->subtotal;
	                    $intIepsFactura = $arrCol->ieps;

	                    //Variable que se utiliza para asignar el saldo de la factura (correspondiente a la moneda del pago)
      			        $intSaldoAux = number_format($intSaldoFactura, 2, '.', '');

	                    //Si el tipo de moneda de la factura es diferente a la moneda del pago
						if($intMonedaID !== $intMonedaIDPago )
						{
							//Convertir importe a peso mexicano
							$intSaldoAux = $intSaldoAux *  $intTipoCambio;

							//Si el tipo de moneda de la factura corresponde a peso mexicano
						    if($intMonedaID == MONEDA_BASE)
							{
								//Convertir peso mexicano a tipo de cambio
								$intSaldoAux = $intSaldoAux / $intTipoCambioPago;
							}
						}


						//Si la fecha de vencimiento es menor que la fecha de corte
	                    if ($dteFechaVencimiento < $dteFechaCorte)
	                    {
	                    	//Asignar saldo de la factura
	                        $intSaldoVencido = $intSaldoFactura;
	                        //Incrementar acumulado del saldo vencido
	                        $intAcumSaldoVencido += $intSaldoAux;
	                    }
	                    
		                   
	                    //Definir valores del array auxiliar de información (para cada factura)
						$arrAuxiliar["referencia_id"] = $arrCol->referencia_id;
						$arrAuxiliar["tipo_referencia"] = $arrCol->tipo_referencia;
						$arrAuxiliar["uuid"] = $arrCol->uuid;
						$arrAuxiliar["folio"] = $arrCol->folio;
						$arrAuxiliar["moneda_id"] =  $intMonedaID;
						$arrAuxiliar["moneda_tipo"] = $arrCol->moneda_tipo;
						$arrAuxiliar["tipo_cambio"] = $intTipoCambio;
						$arrAuxiliar["metodo_pago_id"] = $arrCol->metodo_pago_id;
						$arrAuxiliar["metodo_pago"] = $arrCol->metodo_pago;
						$arrAuxiliar["fecha"] = $arrCol->fecha_format;
						$arrAuxiliar["vencimiento"] = $arrCol->fecha_vencimiento_format;
						$arrAuxiliar["importe"] = number_format($arrCol->importe, 2);
						$arrAuxiliar["saldo"] = number_format($arrCol->saldo, 2);
						$arrAuxiliar["saldo_vencido"] = number_format($intSaldoVencido, 2);
						$arrAuxiliar["parcialidades"] = $arrCol->parcialidades + 1;
						//Asignar datos al array
	                    array_push($arrFacturas, $arrAuxiliar); 
	                    //Incrementar acumulado del saldo
	                    $intAcumSaldo += $intSaldoAux;

					}//Cierre de verificación del saldo

				}
				
			}//Cierre de foreach facturas

			//Agregar valores al array
			$arrDatos['rows'] = $arrFacturas;

			//Seleccionar el total de anticipos del cliente
			$otdAnticipos = $this->pagos->buscar_anticipo_facturas_adeudos($dteFechaCorte, 
																		   $intProspectoID);
			//Si hay información
			if($otdAnticipos)
			{
				//Recorremos el arreglo 
				foreach ($otdAnticipos as $arrAnt)
				{
					//Variables que se utilizan para asignar valores del anticipo
					$intMonedaID =  $arrAnt->moneda_id;
					$intTipoCambio =  $arrAnt->tipo_cambio;
					//Variable que se utiliza para asignar el importe del anticipo (correspondiente a la moneda del pago)
               		$intAnticipo = $arrAnt->importe;

					//Si el tipo de moneda del anticipo es diferente a la moneda del pago
					if($intMonedaID !== $intMonedaIDPago )
					{
						//Convertir importe a peso mexicano
						$intAnticipo = $intAnticipo *  $intTipoCambio;

						//Si el tipo de moneda de la factura corresponde a peso mexicano
					    if($intMonedaID == MONEDA_BASE)
						{
							//Convertir peso mexicano a tipo de cambio
							$intAnticipo = $intAnticipo / $intTipoCambioPago;
						}
					}

					 //Incrementar acumulado del anticipo
					$intAcumAnticipos += $intAnticipo;
				
				}

			}//Cierre de verificación de anticipos


			//Convertir cantidad a formato moneda
			$arrDatos['acumulado_saldo'] = '$'.number_format($intAcumSaldo,2);
			$arrDatos['acumulado_saldo_vencido'] = '$'.number_format($intAcumSaldoVencido,2);
			$arrDatos['acumulado_anticipos'] = '$'.number_format($intAcumAnticipos,2);

		}//Cierre de verificación de información

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	//Método para regresar el saldo actual de una factura
    public function get_saldo_factura($intReferenciaID, $strTipoReferencia)
	{
		
        //Variable que se utiliza para asignar el saldo de la factura
        $intSaldo = 0;
		//Variable que se utiliza para asignar la fecha actual 
		$dteFechaCorte = date("Y-m-d");
		//Seleccionar los importes de la factura (primer posición del arreglo)
		$otdImportes = $this->pagos->buscar_facturas_importes(NULL, $dteFechaCorte, NULL, 
											   				  NULL, NULL, $intReferenciaID, 
											   				  $strTipoReferencia)[0];

		//Si hay información
		if($otdImportes)
		{
			
			//Variable que se utiliza para asignar el saldo de la factura
			//Si la factura no se encuentra pagada
			//if (($otdImportes->saldo >= 1) OR ($otdImportes->saldo <= -1))//Validación anterior
			if($otdImportes->saldo > 0) 
			{
				$intSaldo = $otdImportes->saldo;

			}//Cierre de verificación del saldo

		}//Cierre de verificación de información	

		//Regresar el saldo de la factura
		return $intSaldo;
	}

	
	//Método para regresar los importes de una factura agrupados por tasa (tasa_cuota_iva y tasa_cuota_ieps)
    public function get_tasas_factura()
	{

		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('rows' => NULL);

		//Variables que se utilizan para recuperar los valores de la vista 
		//Variable que se utiliza para asignar el id de la factura
		$intReferenciaID = $this->input->post('intReferenciaID');
		//Variable que se utiliza para asignar el tipo de referencia (MAQUINARIA/REFACCIONES/SERVICIO/CARTERA) de la factura 
		$strTipoReferencia = $this->input->post('strTipoReferencia');
		//Asignar el tipo de cambio de la factura
		$intTipoCambioFra = $this->input->post('intTipoCambioFra');
		//Array que se utiliza para agregar datos de las tasas de la factura 
        $arrTasas = array();
        //Array que se utiliza para agregar los datos de una tasa
        $arrAuxiliar = array();

        //Seleccionar las tasas de los detalles (agrupados por tasa_cuota_iva y tasa_cuota_ieps) de la factura 
	    $otdTasas =  $this->pagos->buscar_tasas_detalles_facturas($intReferenciaID, $strTipoReferencia);
	    //Si hay información
		if($otdTasas)
		{
			//Hacer recorrido para obtener las distintas tasas de los detalles de la factura
		    foreach ($otdTasas as $arrTasa)
		    {
		    	//Variable que se utiliza para asignar el tipo de la tasa o cuota del impuesto de IEPS
			    $strTipoTasaCuotaIeps = $arrTasa->tipo_ieps;
			    //Variable que se utiliza para asignar el factor de la tasa o cuota del impuesto de IEPS
   				$strFactorTasaCuotaIeps = $arrTasa->factor_ieps;

   			    //Seleccionar los importes de la factura por su tasa
				$otdImportesTasa = $this->pagos->buscar_facturas_importes(NULL, NULL, NULL, NULL, NULL, 
																		  $intReferenciaID, $strTipoReferencia, 
																		   NULL, NULL, NULL, 
																		   $arrTasa->tasa_cuota_iva, 
														   				   $arrTasa->tasa_cuota_ieps);

				//Si hay información
				if($otdImportesTasa)
				{
					//Asignar primer posición del arreglo
					$otdImportesTasa = $otdImportesTasa[0];
					//Variables que se utilizan para asignar valores de la factura
					$intSubtotalFactura = $otdImportesTasa->subtotal;
					$intIvaFactura = $otdImportesTasa->iva;
		            $intIepsFactura = $otdImportesTasa->ieps;
		            $intImporteFactura = $otdImportesTasa->importe;

		            //Si existe el tipo de cambio de la factura
		            if($intTipoCambioFra != '')
		            {
		            	//Convertir importe a peso mexicano
						$intSubtotalFactura = $intSubtotalFactura * $intTipoCambioFra;
						$intIvaFactura = $intIvaFactura * $intTipoCambioFra;
						$intIepsFactura = $intIepsFactura * $intTipoCambioFra;
						$intImporteFactura = $intImporteFactura * $intTipoCambioFra;
		            }
		          

		            //Si la tasa de cuota es de tipo RANGO y su factor es Cuota
					if($strTipoTasaCuotaIeps == 'RANGO' && $strFactorTasaCuotaIeps == 'Cuota')
					{
						//Sumarle al subtotal el importe de ieps
						$intSubtotalFactura += $intIepsFactura;
						//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
			   	 		$intIepsFactura = 0;
					}

					//Convertir cantidad a dos decimales
					$intSubtotalFactura = number_format($intSubtotalFactura, 2, '.', '');
					$intIvaFactura = number_format($intIvaFactura, 2, '.', '');
					$intIepsFactura = number_format($intIepsFactura, 2, '.', '');
					$intImporteFactura = number_format($intImporteFactura, 2, '.', '');

					//Definir valores del array auxiliar de información (para cada tasa)
					$arrAuxiliar["subtotal"] = $intSubtotalFactura;
					$arrAuxiliar["precio"] = $intSubtotalFactura;
					$arrAuxiliar["tasa_cuota_iva"] = $arrTasa->tasa_cuota_iva;
					$arrAuxiliar["iva"] = $intIvaFactura;
					$arrAuxiliar["tasa_cuota_ieps"] = $arrTasa->tasa_cuota_ieps;
					$arrAuxiliar["ieps"] = $intIepsFactura;
					$arrAuxiliar["importe"] = $intImporteFactura;
					//Asignar datos al array
		            array_push($arrTasas, $arrAuxiliar); 

				}//Cierre de verificación de importe de la factura

		    }//Cierre de foreach tasas de los detalles de la factura

		    //Agregar valores al array
		    $arrDatos['rows'] = $arrTasas;

		}//Cierre de verificación de tasas de los detalles de la factura

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	//Método para regresar los saldos (facturas con adeudo) de un cliente 
	public function get_saldos_cliente()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL, 
						  'saldo_maquinaria' => '0.00',
						  'saldo_vencido_maquinaria' => '0.00', 
						  'saldo_refacciones' =>'0.00',
						  'saldo_vencido_refacciones' => '0.00',
						  'saldo_servicio' => '0.00', 
						  'saldo_vencido_servicio' => '0.00',
						  'acumulado_saldo' => '0.00',
						  'acumulado_saldo_vencido' => '0.00');

		//Variable que se utiliza para asignar el acumulado del saldo (facturas de maquinaria)
	    $intSaldoMaquinaria = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido (facturas de maquinaria)
	    $intSaldoVencMaquinaria = 0;

	    //Variable que se utiliza para asignar el acumulado del saldo (facturas de refacciones)
	    $intSaldoRefacciones = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido (facturas de refacciones)
	    $intSaldoVencRefacciones = 0;

	    //Variable que se utiliza para asignar el acumulado del saldo (facturas de servicio)
	    $intSaldoServicio = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido (facturas de servicio)
	    $intSaldoVencServicio = 0;

		//Variable que se utiliza para asignar el acumulado del saldo (general)
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido (general)
	    $intAcumSaldoVencido = 0;

	    //Variables que se utilizan para recuperar los valores de la vista 
		$intProspectoID = $this->input->post('intProspectoID');
		$intReferenciaID = $this->input->post('intReferenciaID');
		$strReferencia = $this->input->post('strReferencia');
	
		//Asignar fecha actual
		$dteFechaCorte =  date("Y-m-d");

		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->clientes->buscar($intProspectoID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;

			//Asignar lista de modulos (crédito de cliente)
			$strModulos = 'MAQUINARIA|REFACCIONES|SERVICIO';

			//Seleccionar los datos de las facturas que coinciden con el parámetro enviado
			$otdFacturas = $this->pagos->buscar_facturas_importes('saldos', $dteFechaCorte, $intProspectoID, NULL, 
																   NULL, NULL, NULL, NULL,
													               NULL, $strModulos);

			
			//Si hay información de facturas con adeudo
			if($otdFacturas)
			{
				//Recorremos el arreglo 
				foreach ($otdFacturas as $arrFra)
				{
					//Variable que se utiliza para asignar el saldo de la factura
			    	$intSaldoFactura = $arrFra->saldo;

			    	//Si se cumple la sentencia, significa que se modificó el importe de una factura sin timbrar (y no tiene pagos)
			    	if($intReferenciaID == $arrFra->referencia_id && $strReferencia == $arrFra->tipo_referencia)
			    	{
			    		//Inicializar el saldo de la factura para no considerarlo 
			    		$intSaldoFactura = 0;
			    	}


					//Si la factura no se encuentra pagada
					if ($intSaldoFactura > 0)
					{
						//Variables que se utilizan para asignar valores de la factura
						$intSaldoVencido = 0;
	                    $dteFechaVencimiento = $arrFra->fecha_vencimiento;
	                    $intTipoCambio =  $arrFra->tipo_cambio;
	                    $strTipoReferencia = $arrFra->tipo_referencia;

	                    //Convertir importe a peso mexicano
						$intSaldoAux = $intSaldoFactura *  $intTipoCambio;

						//Si la fecha de vencimiento es menor que la fecha de corte
	                    if ($dteFechaVencimiento < $dteFechaCorte)
	                    {
	                    	//Asignar saldo de la factura
	                        $intSaldoVencido = $intSaldoAux;

	                        //Incrementar acumulado del saldo vencido
	                        $intAcumSaldoVencido += $intSaldoAux;
	                    }

	                    //Dependiendo del tipo de referencia incrementar acumulados
	                    if($strTipoReferencia == 'MAQUINARIA')
	                    {
	                    	 //Incrementar acumulados
	                    	 $intSaldoMaquinaria += $intSaldoAux;
	   						 $intSaldoVencMaquinaria += $intSaldoVencido;

	                    }
	                    else if($strTipoReferencia == 'REFACCIONES')
	                    {
	                    	//Incrementar acumulados
	                    	 $intSaldoRefacciones += $intSaldoAux;
	    					 $intSaldoVencRefacciones += $intSaldoVencido;

	                    }
	                    else //Servicio
	                    {
	                    	//Incrementar acumulados
	                        $intSaldoServicio += $intSaldoAux;
	    					$intSaldoVencServicio += $intSaldoVencido;

	                    }

	                    //Incrementar acumulado del saldo
	                    $intAcumSaldo += $intSaldoAux;


					}//Cierre de verificación del saldos

				}//Cierre de foreach


				//Agregar datos al array
				$arrDatos['saldo_maquinaria'] = number_format($intSaldoMaquinaria,2);
				$arrDatos['saldo_vencido_maquinaria'] = number_format($intSaldoVencMaquinaria,2);
				$arrDatos['saldo_refacciones'] = number_format($intSaldoRefacciones,2);
				$arrDatos['saldo_vencido_refacciones'] = number_format($intSaldoVencRefacciones,2);
				$arrDatos['saldo_servicio'] = number_format($intSaldoServicio,2);
				$arrDatos['saldo_vencido_servicio'] = number_format($intSaldoVencServicio,2);
				$arrDatos['acumulado_saldo'] = number_format($intAcumSaldo,2);
				$arrDatos['acumulado_saldo_vencido'] = number_format($intAcumSaldoVencido,2);

			}//Cierre de verificación de facturas


		}//Cierre de verificación de información


		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

}