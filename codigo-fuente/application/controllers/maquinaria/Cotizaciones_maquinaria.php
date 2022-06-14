<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cotizaciones_maquinaria extends MY_Controller {
	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		 //Asignar ruta de la carpeta destino
	    $this->archivo['strCarpetaTemporal'] = './cotizacion_maquinaria_temporal_';
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de cotizaciones de maquinaria
		$this->load->model('maquinaria/cotizaciones_maquinaria_model', 'cotizaciones');
		//Cargamos el modelo de prospectos
		$this->load->model('crm/prospectos_model', 'prospectos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('maquinaria/cotizaciones_maquinaria', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->cotizaciones->filtro($this->input->post('dteFechaInicial'),
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
		foreach ($result['cotizaciones'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionAutorizar = 'no-mostrar';
			$arrDet->mostrarAccionEnviarCorreo = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;
          
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

				//Si el usuario cuenta con el permiso de acceso ENVIAR CORREO
				if (in_array('ENVIAR CORREO', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Enviar Correo
					$arrDet->mostrarAccionEnviarCorreo = '';
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

		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['cotizaciones'],
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
		$objCotizacionMaquinaria = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objCotizacionMaquinaria->intCotizacionMaquinariaID = $this->input->post('intCotizacionMaquinariaID');
		$objCotizacionMaquinaria->dteFecha = $this->input->post('dteFecha');
		$objCotizacionMaquinaria->intMonedaID = $this->input->post('intMonedaID');
		$objCotizacionMaquinaria->intTipoCambio = $this->input->post('intTipoCambio');
		$objCotizacionMaquinaria->intProspectoID = $this->input->post('intProspectoID');
		$objCotizacionMaquinaria->intVendedorID = $this->input->post('intVendedorID');
		$objCotizacionMaquinaria->strMadurez = $this->input->post('strMadurez');
		$objCotizacionMaquinaria->intEstrategiaID= $this->input->post('intEstrategiaID');
		$objCotizacionMaquinaria->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objCotizacionMaquinaria->strNotas = mb_strtoupper(trim($this->input->post('strNotas')));
		$objCotizacionMaquinaria->intMaquinariaDescripcionID = $this->input->post('intMaquinariaDescripcionID');
		$objCotizacionMaquinaria->strCodigo =  mb_strtoupper(trim($this->input->post('strCodigo')));
		$objCotizacionMaquinaria->strDescripcionCorta =  mb_strtoupper(trim($this->input->post('strDescripcionCorta')));
		$objCotizacionMaquinaria->strDescripcion = mb_strtoupper(trim($this->input->post('strDescripcion')));
		$objCotizacionMaquinaria->intPrecio = $this->input->post('intPrecio');
		$objCotizacionMaquinaria->intDescuento = $this->input->post('intDescuento');
		//Si no existe id de la tasa o cuota del impuesto de IVA asignar valor nulo
		$objCotizacionMaquinaria->intTasaCuotaIva = (($this->input->post('intTasaCuotaIva') !== '') ? 
						   	   					  	  $this->input->post('intTasaCuotaIva') : NULL);
		$objCotizacionMaquinaria->intIva = $this->input->post('intIva');
		//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
		$objCotizacionMaquinaria->intTasaCuotaIeps = (($this->input->post('intTasaCuotaIeps') !== '') ? 
						   	   					       $this->input->post('intTasaCuotaIeps') : NULL);
		$objCotizacionMaquinaria->intIeps = $this->input->post('intIeps');
		$objCotizacionMaquinaria->intSucursalID = $this->session->userdata('sucursal_id');
		$objCotizacionMaquinaria->intUsuarioID = $this->session->userdata('usuario_id');
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objCotizacionMaquinaria->intCotizacionMaquinariaID))
		{
			$bolResultado = $this->cotizaciones->modificar($objCotizacionMaquinaria);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objCotizacionMaquinaria->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objCotizacionMaquinaria->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->cotizaciones->guardar($objCotizacionMaquinaria); 

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
		$intID = $this->input->post('intCotizacionMaquinariaID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->cotizaciones->buscar($intID);
	    
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
		$this->form_validation->set_rules('intCotizacionMaquinariaID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intCotizacionMaquinariaID');
		    $strEstatus = $this->input->post('strEstatus');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->cotizaciones->set_estatus($intID, $strEstatus);
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

	//Método para enviar a pedido los datos de un registro
	public function set_enviar_pedido()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intCotizacionMaquinariaID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intCotizacionMaquinariaID');
	        $strUsuarios = $this->input->post('strUsuarios');
	        $strMensaje = trim($this->input->post('strMensaje'));

	        //Hacer un llamado al método para enviar a pedido los datos de un registro
			$bolResultado = $this->cotizaciones->set_enviar_pedido($intID, $strUsuarios, $strMensaje);
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
	
	//Método para enviar orden de compra al correo electrónico del prospecto
	public function enviar_correo_electronico_prospecto()
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$intCotizacionMaquinariaID = $this->input->post('intCotizacionMaquinariaID');
		$strCorreoElectronico = $this->input->post('strCorreoElectronico');
		$strCopiaCorreoElectronico = $this->input->post('strCopiaCorreoElectronico');
		
	 	//Generar el archivo PDF
        $strRuta = $this->get_reporte_registro($intCotizacionMaquinariaID, 'ConMembrete', 'SI');

         //Array que se utiliza para enviar correo electrónico
		$arrDatos =  array('intReferenciaID' => $intCotizacionMaquinariaID,
						   'strTitulo' => utf8_decode('Solicitud de Cotización de Maquinaria'),
						   'strRuta' => $strRuta,
						   'strCorreoElectronico'  => $strCorreoElectronico,
						   'strCopiaCorreoElectronico' => $strCopiaCorreoElectronico,
						   'strComentarios' => 'Cotización solicitada.');

		//Hacer un llamado a la función para enviar correo electrónico
		$this->set_enviar_correo($arrDatos);
	}

	//Método para eliminar carpeta temporal
	public function eliminar_carpeta_temporal($intCotizacionMaquinariaID)
	{
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaTemporal'].$intCotizacionMaquinariaID; 

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
		$intProspectoID = $this->input->post('intProspectoID');
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strEstatus = trim($this->input->post('strEstatus'));
		$strDetalles = $this->input->post('strDetalles');

		//Array que se utiliza para asignar los estatus 
		$arrEstatus = array('ACTIVO','PEDIDO','FACTURADO', 'RECHAZADO', 'INACTIVO'); 
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->cotizaciones->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, $strEstatus, $strBusqueda);
		//Seleccionar los datos de las monedas que coinciden con el parámetro enviado
		$otdMonedas = $this->cotizaciones->buscar_distintas_monedas($dteFechaInicial, $dteFechaFinal, $intProspectoID,$strEstatus, $strBusqueda );
		
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
			$strTituloRangoFechas .=  ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
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
		$pdf->strLinea1 =  'LISTADO DE COTIZACIONES DE MAQUINARIA '.$strTituloRangoFechas;
		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del prospecto que coincide con el id
			$otdProspecto =  $this->prospectos->buscar($intProspectoID, NULL, 'referencias');
			$pdf->strLinea2 =  'PROSPECTO: '.utf8_decode($otdProspecto->prospecto);
		}


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
		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'PROSPECTO', 'FECHA', 'SUBTOTAL', 'IVA', 'IEPS', 
						     'TOTAL', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(16, 65, 15, 20, 18, 18, 18, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'R', 'R', 'R', 'R', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('R', 'L', 'L', 'R', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(16, 20, 35, 25, 25 );
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

			//Recorremos el arreglo para obtener la información de las cotizaciones de maquinaria
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);

				//Variables que se utilizan para asignar valores del detalle
				$intCantidad = 1;
				//Convertir peso mexicano a tipo de cambio
				$intPrecio = ($arrCol->precio / $arrCol->tipo_cambio);
				$intImporteIva = ($arrCol->iva / $arrCol->tipo_cambio);
				$intImporteIeps = ($arrCol->ieps / $arrCol->tipo_cambio);
			    $intSubTotal = $intPrecio;
			
				//Calcular importe total
				$intTotal = $intSubTotal + $intImporteIva + $intImporteIeps;

				//Incrementar valores de los siguientes arrays
				$arrSubtotalEstatus[$arrCol->estatus] += ($intSubTotal * $arrCol->tipo_cambio);
		      	$arrIvaEstatus[$arrCol->estatus] += ($intImporteIva * $arrCol->tipo_cambio);
		      	$arrIepsEstatus[$arrCol->estatus] += ($intImporteIeps * $arrCol->tipo_cambio);
		      	$arrTotalEstatus[$arrCol->estatus] += ($intTotal* $arrCol->tipo_cambio);

		      	//Si el id de la moneda no corresponde al peso mexicano
		      	if($arrCol->moneda_id != MONEDA_BASE)
		      	{
		      		//Incrementar valores de los siguientes arrays
			      	$arrSubtotalMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intSubTotal;
			      	$arrIvaMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intImporteIva;
			      	$arrIepsMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intImporteIeps;
			      	$arrTotalMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intTotal;
			      	$arrTotalRegistrosMoneda[$arrCol->moneda_id] += 1;
		      	}
		      	
				
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, utf8_decode($arrCol->prospecto), $arrCol->fecha,
								'$'.number_format($intSubTotal,2),
								'$'.number_format($intImporteIva,2), '$'.number_format($intImporteIeps,2),
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
				
				//Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
					$pdf->Ln(5);//Deja un salto de línea
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraDetalles);
					
					   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array(number_format($intCantidad,2), utf8_decode($arrCol->codigo), 
					    			    utf8_decode($arrCol->descripcion_corta), '$'.number_format($intPrecio,6),  
									    '$'.number_format($intSubTotal,6)),$arrAlineacionDetalles,'ClippedCell');
				}//Cierre de verificación de detalles
		    	$pdf->Ln(5);//Deja un salto de línea
				//Incrementar el contador por cada registro
				$intContador++;
			}

			$pdf->Ln(5);//Deja un salto de linea

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- RESUMEN
	        //------------------------------------------------------------------------------------------------------------------------
			//Crea los titulos de la cabecera
			$pdf->arrCabeceraResumen = array('ESTATUS', 'SUBTOTAL', 'IVA', 'IEPS',  'TOTAL');
			//Establece el ancho de las columnas de cabecera
			$pdf->arrAnchuraResumen = array(25, 25, 25, 25, 25);
			//Establece la alineación de las celdas de la tabla
			$pdf->arrAlineacionResumen = array('L', 'R', 'R', 'R', 'R');
			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Creación de la tabla Resumen
			$pdf->Cell(125, 4, 'RESUMEN GENERAL EN PESOS', 0, 0, 'C', TRUE);
			$pdf->Ln(4);//Deja un salto de linea
			//Recorre el array de titulos de encabezado para crearlos
			for ($intCont = 0; $intCont < count($pdf->arrCabeceraResumen); $intCont++)
			{
				//Establecer el color de fondo para la cabecera
				$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
				//inserta los titulos de la cabecera
				$pdf->Cell($pdf->arrAnchuraResumen[$intCont], 5, $pdf->arrCabeceraResumen[$intCont], 1, 0, $pdf->arrAlineacionResumen[$intCont], TRUE);
			}
			$pdf->Ln(6);//Deja un salto de línea
			//Establece el ancho de las columnas
			$pdf->SetWidths($pdf->arrAnchuraResumen);
			$pdf->SetTextColor(0); //establece el color de texto
			//Hacer recorrido para obtener totales por estatus
			foreach ($arrEstatus as $arrEst)
			{
				//Si existe subtotal
				if($arrSubtotalEstatus[$arrEst] > 0)
				{
				 	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($arrEst,'$'.number_format($arrSubtotalEstatus[$arrEst],2), 
									'$'.number_format($arrIvaEstatus[$arrEst],2), 
			    				    '$'.number_format($arrIepsEstatus[$arrEst],2), 
			    				    '$'.number_format($arrTotalEstatus[$arrEst],2)), 
									$pdf->arrAlineacionResumen,'ClippedCell');


					//Incrementar acumulados si el estatus es ACTIVO, PEDIDO o FACTURADO
					if($arrEst == 'ACTIVO' OR  $arrEst == 'PEDIDO' OR  $arrEst == 'FACTURADO')
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
            $pdf->Cell(25,3,'$'.number_format($intAcumSubtotalEstatus,2), 0, 0, 'R');
            //Acumulado del IVA
            $pdf->Cell(25,3,'$'.number_format($intAcumIvaEstatus,2), 0, 0, 'R');
           //Acumulado del IEPS
            $pdf->Cell(25,3,'$'.number_format($intAcumIepsEstatus,2), 0, 0, 'R');
            //Acumulado del importe total
            $pdf->Cell(25,3,'$'.number_format($intAcumTotalEstatus,2), 0, 0, 'R');
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
				for ($intCont = 0; $intCont < count($pdf->arrCabeceraResumen); $intCont++)
				{
					//Establecer el color de fondo para la cabecera
					$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
					$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
					$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
					//inserta los titulos de la cabecera
					$pdf->Cell($pdf->arrAnchuraResumen[$intCont], 5, $pdf->arrCabeceraResumen[$intCont], 1, 0, $pdf->arrAlineacionResumen[$intCont], TRUE);
				}
				$pdf->Ln(6);//Deja un salto de línea
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchuraResumen);
				//Hacer recorrido para obtener totales por estatus
				foreach ($arrEstatus as $arrEst)
				{
					//Si existe subtotal
					if($arrSubtotalMoneda[$arrMon->moneda_id][$arrEst] > 0)
					{
					 	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						$pdf->Row(array($arrEst,'$'.number_format($arrSubtotalMoneda[$arrMon->moneda_id][$arrEst],2), 
										'$'.number_format($arrIvaMoneda[$arrMon->moneda_id][$arrEst],2), 
				    				    '$'.number_format($arrIepsMoneda[$arrMon->moneda_id][$arrEst],2), 
				    				    '$'.number_format($arrTotalMoneda[$arrMon->moneda_id][$arrEst],2)), 
										$pdf->arrAlineacionResumen,'ClippedCell');


						//Incrementar acumulados si el estatus es ACTIVO, PEDIDO o FACTURADO
						if($arrEst == 'ACTIVO' OR  $arrEst == 'PEDIDO' OR  $arrEst == 'FACTURADO')
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
	            $pdf->Cell(25,3,'$'.number_format($intAcumSubtotalEstatus,2), 0, 0, 'R');
	            //Acumulado del IVA
	            $pdf->Cell(25,3,'$'.number_format($intAcumIvaEstatus,2), 0, 0, 'R');
	           //Acumulado del IEPS
	            $pdf->Cell(25,3,'$'.number_format($intAcumIepsEstatus,2), 0, 0, 'R');
	            //Acumulado del importe total
	            $pdf->Cell(25,3,'$'.number_format($intAcumTotalEstatus,2), 0, 0, 'R');
	            $pdf->Ln(8);//Deja un salto de línea
			}
		}
		//Ejecutar la salida del reporte
		$pdf->Output('cotizaciones_maquinaria.pdf','I'); 
	}


	/*Método para generar un reporte PDF dependiendo de los criterios de búsqueda proporcionados y el tipo de reporte*/
	public function get_reporte_registro($intCotizacionMaquinariaID = NULL, 
										 $strTipoReporte = NULL, $strEnviarCorreo = NULL) 
	{            

		//Si el reporte no se enviara por correo electrónico
		if($strEnviarCorreo == NULL)
		{
			//Variables que se utilizan para recuperar los valores de la vista
			$intCotizacionMaquinariaID = $this->input->post('intCotizacionMaquinariaID');
			$strTipoReporte = $this->input->post('strTipoReporte');
		}
		

		//Seleccionar los datos de la empresa que coincide con el id 
        $otdEmpresa = $this->empresas->buscar(1);
		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->cotizaciones->buscar($intCotizacionMaquinariaID);
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'cotizacion_maquinaria_';
		//Agregar la primer pagina
		$pdf->AddPage();

		//Si el reporte es con membrete
		if($strTipoReporte == 'ConMembrete')
		{
			//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
			$this->get_encabezado_archivo_pdf($pdf, NULL, TAMANO_LETRA_TITULO_PDF, '');

		}
	
		//Verificar si hay información del registro
		if($otdResultado)
		{	
			//Hacer un llamado a la función para mostrar imagen del estatus (INACTIVO/TIMBRAR)
			$this->get_img_estatus_archivo_pdf($pdf, $otdResultado->estatus);

			$pdf->SetTextColor(0); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(108, 50);
			$pdf->ClippedCell(92, 3, 'COTIZACION DE MAQUINARIA', 0, 0, 'C', FALSE);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(108, 54);
			$pdf->ClippedCell(92, 3, strtoupper( $this->get_fecha_formato_letra($otdResultado->fecha_reporte, '') ), 0, 0, 'C', FALSE);

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL CLIENTE O PROSPECTO
	        //------------------------------------------------------------------------------------------------------------------------
			//Verificar si el prospecto es un cliente
			if($otdResultado->cliente_estatus == 'ACTIVO')
			{
				//Asignar los datos del cliente
				$strNombreComercial = utf8_decode($otdResultado->cliente);
				$strTelefonoPrincipal = $otdResultado->cliente_telefono_principal;
				$strCalle = $otdResultado->cliente_calle;
				$strNumExterior = $otdResultado->cliente_numero_exterior;
				$strNumInterior = $otdResultado->cliente_numero_interior;
				$strColonia = $otdResultado->cliente_colonia;
				$strCodigoPostal = $otdResultado->cliente_codigo_postal;
				$strLocalidad = $otdResultado->cliente_localidad;
				$strMunicipio = $otdResultado->cliente_municipio;
				$strEstado = $otdResultado->cliente_estado;
			}
			else
			{
				//Asignar los datos del prospecto
				$strNombreComercial = utf8_decode($otdResultado->prospecto);
				$strTelefonoPrincipal = $otdResultado->telefono_principal;
				$strCalle = $otdResultado->calle;
				$strNumExterior = $otdResultado->numero_exterior;
				$strNumInterior = $otdResultado->numero_interior;
				$strColonia = $otdResultado->colonia;
				$strCodigoPostal = $otdResultado->codigo_postal;
				$strLocalidad = $otdResultado->localidad;
				$strMunicipio = $otdResultado->municipio;
				$strEstado = $otdResultado->estado;
			}

			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(15, 62);
			$pdf->ClippedCell(30, 4, 'FOLIO:', 0, 0, 'L', FALSE);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(46, 62);
			$pdf->ClippedCell(92, 4, $otdResultado->folio, 0, 0, 'L', FALSE);


			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(15, 66);
			$pdf->ClippedCell(30, 4, 'CLIENTE:', 0, 0, 'L', FALSE);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(46, 66);
			$pdf->ClippedCell(155, 4, utf8_decode($strNombreComercial), 0, 0, 'L', FALSE);

			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(15, 70);
			$pdf->ClippedCell(30, 4, 'RFC:', 0, 0, 'L', FALSE);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(46, 70);
			$pdf->ClippedCell(30, 4, $otdResultado->rfc, 0, 0, 'L', FALSE);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(97, 70);
			$pdf->ClippedCell(20, 4, 'CP:', 0, 0, 'L', FALSE);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(118, 70);
			$pdf->ClippedCell(20, 4, $otdResultado->codigo_postal, 0, 0, 'L', FALSE);

			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(15, 74);
			$pdf->ClippedCell(30, 4, 'DOMICILIO:', 0, 0, 'L', FALSE);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(46, 74);
			//Concatenar datos para el domicilio
			if($strNumExterior != '')
			{
				$strDomicilio =  $strCalle . ' NO.'.$strNumExterior;
			}
			else
			{
				$strDomicilio =  $strCalle;
			}

			if($strColonia  != '')
			{
				$strDomicilio .= ' COL. ' . $strColonia;
			}

		
			$pdf->ClippedCell(155, 4, strtoupper(utf8_decode($strDomicilio)), 0, 0, 'L', FALSE);

			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(15, 78);
			$pdf->ClippedCell(30, 4, 'POBLACION:', 0, 0, 'L', FALSE);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(46, 78);
			$pdf->ClippedCell(92, 4, strtoupper( utf8_decode( $strLocalidad ) ), 0, 0, 'L', FALSE);

			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(15, 82);
			$pdf->ClippedCell(30, 4, 'MUNICIPIO:', 0, 0, 'L', FALSE);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(46, 82);
			$pdf->ClippedCell(92, 4, strtoupper( utf8_decode($strMunicipio) ), 0, 0, 'L', FALSE);
			$pdf->SetXY(97, 82);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->ClippedCell(20, 4, 'ESTADO:', 0, 0, 'L', FALSE);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(118, 82);
			$pdf->ClippedCell(80, 4, strtoupper(utf8_decode($strEstado) ), 0, 0, 'L', FALSE);	

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DE LA COTIZACIÓN
	        //------------------------------------------------------------------------------------------------------------------------	
			//Tabla con los detalles de la cotización
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->SetXY(15, 90);
			$pdf->ClippedCell(185, 3, 'POR MEDIO DE LA PRESENTE LE ESTAMOS COTIZANDO LA SIGUIENTE MAQUINARIA:', 0, 0, 'L', FALSE);

			$pdf->SetXY(50, 98);
			$pdf->MultiCell(110, 3, '(1)'.'    '.utf8_decode($otdResultado->descripcion) );

			$pdf->Ln(); //Deja un salto de línea
			
			//Variables que se utilizan para asignar valores del detalle
			$intCantidad = 1;
			//Convertir peso mexicano a tipo de cambio
			$intPrecio = ($otdResultado->precio / $otdResultado->tipo_cambio);
			$intImporteDescuento = ($otdResultado->descuento / $otdResultado->tipo_cambio);
			$intImporteIva = ($otdResultado->iva / $otdResultado->tipo_cambio);
			$intImporteIeps = ($otdResultado->ieps / $otdResultado->tipo_cambio);
			$intSubTotal = $intPrecio;
			//Si existe importe del descuento
			if($intImporteDescuento > 0)
			{
				$intPrecio = $intPrecio + $intImporteDescuento;
			}
			//Calcular importe total
			$intTotal = $intSubTotal + $intImporteIva + $intImporteIeps;

			//Si se cumple la sentencia, desglosar IVA, IEPS y Descuento
			if(($intImporteDescuento > 0) OR ($intImporteIva > 0) OR ($intImporteIeps > 0))
			{
				
				//Si existe importe del descuento
				if($intImporteDescuento > 0)
				{
					//Precio
					$pdf->SetXY(79, $pdf->GetY() + 4);
					$pdf->ClippedCell(30, 3, 'PRECIO');
					$pdf->ClippedCell(27, 3, '$'.number_format($intPrecio, 2), 0, 0, 'R');

					//Descuento
					$pdf->SetXY(79, $pdf->GetY() + 4);
					$pdf->ClippedCell(30, 3, 'DESCUENTO');
					$pdf->ClippedCell(27, 3, '$'.number_format($intImporteDescuento, 2), 0, 0, 'R');

					//Subtotal
					$pdf->SetXY(79, $pdf->GetY() + 4);
					$pdf->ClippedCell(30, 3, 'SUBTOTAL');
					$pdf->ClippedCell(27, 3, '$'.number_format($intSubTotal, 2), 0, 0, 'R');
				}
				else
				{
					//Subtotal
					$pdf->SetXY(79, $pdf->GetY() + 4);
					$pdf->ClippedCell(30, 3, 'SUBTOTAL');
					$pdf->ClippedCell(27, 3, '$'.number_format($intPrecio, 2), 0, 0, 'R');
				}



				//Si existe importe de IVA
				if($intImporteIva > 0)
				{
					//IVA
					$pdf->SetXY(79, $pdf->GetY() + 4);
					$pdf->ClippedCell(30, 3, 'IVA');
					$pdf->ClippedCell(27, 3, '$'.number_format($intImporteIva, 2), 0, 0, 'R');
				}

				//Si existe importe de IEPS
				if($intImporteIeps > 0)
				{
					//IEPS
					$pdf->SetXY(79, $pdf->GetY() + 4);
					$pdf->ClippedCell(30, 3, 'IEPS');
					$pdf->ClippedCell(27, 3, '$'.number_format($intImporteIeps, 2), 0, 0, 'R');
					
				}
			}

			//Total
			$pdf->SetX(15, $pdf->GetY() + 4);
			$pdf->ClippedCell(30, 3, '', 0, 0, 'L', FALSE);
			$pdf->SetXY(15, $pdf->GetY() + 4);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->ClippedCell(185, 3, 'PRECIO DE CONTADO '.'$'. number_format($intTotal, 2), 0, 0, 'C', FALSE);

				//Cantidad con letra
			$pdf->Ln(); //Deja un salto de línea
			$pdf->SetXY(15, $pdf->GetY() + 4);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->MultiCell(185, 3, 'SON: (' .$AifLibNumber->toCurrency($intTotal, $otdResultado->codigo_moneda) . ')');

			$pdf->Ln(30); //Deja un salto de línea

			$pdf->SetXY(15, $pdf->GetY() + 4);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->MultiCell(185, 3, '* PRECIOS Y CONDICIONES SUJETAS A CAMBIO SIN PREVIO AVISO');
			$pdf->SetXY(15, $pdf->GetY() + 4);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->MultiCell(185, 3, 'SIN MAS POR EL MOMENTO Y AGRADECIENDO LA ATENCION A EL PRESENTE SE DESPIDE DE USTEDES SU AMIGO Y SEGURO SERVIDOR.');

			$pdf->Ln(5); //Deja un salto de línea
			$pdf->SetXY(15, $pdf->GetY() + 4);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->ClippedCell(185, 3, 'ATENTAMENTE', 0, 0, 'C', FALSE);

			$pdf->SetXY(15, $pdf->GetY() + 20);
			$pdf->ClippedCell(185, 3, '_________________________________________________', 0, 0, 'C', FALSE);
			$pdf->Ln();
			$pdf->SetXY(15, $pdf->GetY() + 2);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->ClippedCell(185, 3, utf8_decode($otdEmpresa->razon_social), 0, 0, 'C', FALSE);

			$pdf->SetXY(15, $pdf->GetY() + 4);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_PDF);
			$pdf->ClippedCell(185, 3, utf8_decode($otdEmpresa->rfc), 0, 0, 'C', FALSE);

			$pdf->SetXY(15, $pdf->GetY() + 4);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_PDF);
			$pdf->ClippedCell(185, 3, utf8_decode($otdResultado->nombre_vendedor), 0, 0, 'C', FALSE);

			//Concatenar folio para identificar cotización
			$strNombreArchivo .= $otdResultado->folio;

		}//Cierre de verificación de información


		//Si la opción es enviar reporte por correo electrónico
		if($strEnviarCorreo == 'SI')
		{	
            //Definir ubicación de la carpeta
			$strCarpetaDestino =  $this->archivo['strCarpetaTemporal'].$intCotizacionMaquinariaID.'/'; 
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
		$intProspectoID = $this->input->post('intProspectoID');
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strEstatus = trim($this->input->post('strEstatus'));
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
		$otdResultado = $this->cotizaciones->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID,  $strEstatus, $strBusqueda);
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
			$strTituloRangoFechas .=  ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		}
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE COTIZACIONES DE MAQUINARIA '.$strTituloRangoFechas);
		//Si existe id del prospecto
		if($intProspectoID > 0)
		{   //Seleccionar los datos del prospecto que coincide con el id
			$otdProspecto =  $this->prospectos->buscar($intProspectoID, NULL, 'referencias');
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'PROSPECTO: '.$otdProspecto->prospecto);
		}

		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'PROSPECTO')
        		 ->setCellValue('C'.$intPosEncabezados, 'CALLE')
        		 ->setCellValue('D'.$intPosEncabezados, 'NO. EXTERIOR')
        		 ->setCellValue('E'.$intPosEncabezados, 'NO. INTERIOR')
        		 ->setCellValue('F'.$intPosEncabezados, 'CÓDIGO POSTAL')
        		 ->setCellValue('G'.$intPosEncabezados, 'COLONIA')
        		 ->setCellValue('H'.$intPosEncabezados, 'LOCALIDAD')
        		 ->setCellValue('I'.$intPosEncabezados, 'REFERENCIA')
        		 ->setCellValue('J'.$intPosEncabezados, 'MUNICIPIO')
        		 ->setCellValue('K'.$intPosEncabezados, 'ESTADO')
        		 ->setCellValue('L'.$intPosEncabezados, 'PAÍS')
        		 ->setCellValue('M'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('N'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('O'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('P'.$intPosEncabezados, 'IEPS')
        		 ->setCellValue('Q'.$intPosEncabezados, 'TOTAL')
        		 ->setCellValue('R'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('S'.$intPosEncabezados, 'T.C.')
        		 ->setCellValue('T'.$intPosEncabezados, 'VENDEDOR')
        		 ->setCellValue('U'.$intPosEncabezados, 'MADUREZ')
        		 ->setCellValue('V'.$intPosEncabezados, 'ESTRATEGIA')
        		 ->setCellValue('W'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('X'.$intPosEncabezados, 'NOTAS')
                 ->setCellValue('Y'.$intPosEncabezados, 'ESTATUS');

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
    			 ->getStyle('A10:Y10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:Y10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:Y10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('Z'.$intPosEncabezados, 'CANTIDAD')
			         ->setCellValue('AA'.$intPosEncabezados, 'CÓDIGO')
			         ->setCellValue('AB'.$intPosEncabezados,'DESCRIPCIÓN CORTA')
			         ->setCellValue('AC'.$intPosEncabezados,'DESCRIPCION')
			         ->setCellValue('AD'.$intPosEncabezados,'LÍNEA')
			         ->setCellValue('AE'.$intPosEncabezados,'MARCA')
			         ->setCellValue('AF'.$intPosEncabezados,'MODELO')
			         ->setCellValue('AG'.$intPosEncabezados,'PRECIO UNITARIO')
			         ->setCellValue('AH'.$intPosEncabezados, 'SUBTOTAL');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('Z'.$intPosEncabezados.':AH'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('Z'.$intPosEncabezados.':AH'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('Z'.$intPosEncabezados.':AH'.$intPosEncabezados)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentCenter);
        }

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Variables que se utilizan para asignar valores del detalle
				$intCantidad = 1;
				//Convertir peso mexicano a tipo de cambio
				$intPrecio = ($arrCol->precio / $arrCol->tipo_cambio);
				$intImporteIva = ($arrCol->iva / $arrCol->tipo_cambio);
				$intImporteIeps = ($arrCol->ieps / $arrCol->tipo_cambio);
				$intSubTotal = $intPrecio;

				//Calcular importe total
				$intTotal = $intSubTotal + $intImporteIva + $intImporteIeps;

				//Verificar si el prospecto es un cliente
				if($arrCol->cliente_estatus == 'ACTIVO')
				{
					//Asignar los datos del cliente
					$strCalle = $arrCol->cliente_calle;
					$strNumExterior = $arrCol->cliente_numero_exterior;
					$strNumInterior = $arrCol->cliente_numero_interior;
					$strColonia = $arrCol->cliente_colonia;
					$strCodigoPostal = $arrCol->cliente_codigo_postal;
					$strLocalidad = $arrCol->cliente_localidad;
					$strReferencia = $arrCol->cliente_referencia;
					$strMunicipio = $arrCol->cliente_municipio;
					$strEstado = $arrCol->cliente_estado;
					$strPais = $arrCol->cliente_pais;
				}
				else
				{
					//Asignar los datos del prospecto
					$strCalle = $arrCol->calle;
					$strNumExterior = $arrCol->numero_exterior;
					$strNumInterior = $arrCol->numero_interior;
					$strColonia = $arrCol->colonia;
					$strCodigoPostal = $arrCol->codigo_postal;
					$strLocalidad = $arrCol->localidad;
					$strReferencia = $arrCol->referencia;
					$strMunicipio = $arrCol->municipio;
					$strEstado = $arrCol->estado;
					$strPais = $arrCol->pais;
				}


				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
				 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->prospecto)
                         ->setCellValue('C'.$intFila, $strCalle)
		                 ->setCellValue('D'.$intFila, $strNumExterior)
		                 ->setCellValue('E'.$intFila, $strNumInterior)
		                 ->setCellValue('F'.$intFila, $strCodigoPostal)
		                 ->setCellValue('G'.$intFila, $strColonia)
		                 ->setCellValue('H'.$intFila, $strLocalidad)
		                 ->setCellValue('I'.$intFila, $strReferencia)
		                 ->setCellValue('J'.$intFila, $strMunicipio)
		                 ->setCellValue('K'.$intFila, $strEstado)
		                 ->setCellValue('L'.$intFila, $strPais)
                         ->setCellValue('M'.$intFila, $arrCol->fecha)
                         ->setCellValue('N'.$intFila, $intPrecio)
                         ->setCellValue('O'.$intFila, $intImporteIva)
                         ->setCellValue('P'.$intFila, $intImporteIeps)
                         ->setCellValue('Q'.$intFila, $intTotal)
                         ->setCellValue('R'.$intFila, $arrCol->moneda)
                         ->setCellValue('S'.$intFila, $arrCol->tipo_cambio)
                         ->setCellValue('T'.$intFila, $arrCol->vendedor)
                         ->setCellValue('U'.$intFila, $arrCol->madurez)
                         ->setCellValue('V'.$intFila, $arrCol->estrategia)
                         ->setCellValue('W'.$intFila, $arrCol->observaciones)
                         ->setCellValue('X'.$intFila, $arrCol->notas)
                         ->setCellValue('Y'.$intFila, $arrCol->estatus);


                         //Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'PROSPECTO')
        		 ->setCellValue('C'.$intPosEncabezados, 'CALLE')
        		 ->setCellValue('D'.$intPosEncabezados, 'NÚMERO EXTERIOR')
        		 ->setCellValue('E'.$intPosEncabezados, 'NÚMERO INTERIOR')
        		 ->setCellValue('F'.$intPosEncabezados, 'CÓDIGO POSTAL')
        		 ->setCellValue('G'.$intPosEncabezados, 'COLONIA')
        		 ->setCellValue('H'.$intPosEncabezados, 'LOCALIDAD')
        		 ->setCellValue('I'.$intPosEncabezados, 'REFERENCIA')
        		 ->setCellValue('J'.$intPosEncabezados, 'MUNICIPIO')
        		 ->setCellValue('K'.$intPosEncabezados, 'ESTADO')
        		 ->setCellValue('L'.$intPosEncabezados, 'PAÍS')
        		 ->setCellValue('M'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('N'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('O'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('P'.$intPosEncabezados, 'IEPS')
        		 ->setCellValue('Q'.$intPosEncabezados, 'TOTAL')
        		 ->setCellValue('R'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('S'.$intPosEncabezados, 'T.C.')
        		 ->setCellValue('T'.$intPosEncabezados, 'VENDEDOR')
        		 ->setCellValue('U'.$intPosEncabezados, 'MADUREZ')
        		 ->setCellValue('V'.$intPosEncabezados, 'ESTRATEGIA')
        		 ->setCellValue('W'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('X'.$intPosEncabezados, 'NOTAS')
                 ->setCellValue('Y'.$intPosEncabezados, 'ESTATUS');

				//Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
					$objExcel->setActiveSheetIndex(0)
                         ->setCellValue('Z'.$intFila, $intCantidad)
                         ->setCellValueExplicit('AA'.$intFila, $arrCol->codigo, PHPExcel_Cell_DataType::TYPE_STRING)
				         ->setCellValue('AB'.$intFila, $arrCol->descripcion_corta)
				         ->setCellValue('AC'.$intFila, $arrCol->descripcion)
				         ->setCellValue('AD'.$intFila, $arrCol->maquinaria_linea)
					     ->setCellValue('AE'.$intFila, $arrCol->maquinaria_marca)
					     ->setCellValue('AF'.$intFila, $arrCol->maquinaria_modelo)
				         ->setCellValue('AG'.$intFila, $intPrecio)
				         ->setCellValue('AH'.$intFila, $intSubTotal);
					
				}

				//Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
                //Incrementar el contador por cada registro
				$intContador++;
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('N'.$intFilaInicial.':'.'Q'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

           	$objExcel->getActiveSheet()
            		 ->getStyle('AG'.$intFilaInicial.':'.'AH'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('S'.$intFilaInicial.':'.'S'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.0000');

            //Cambiar contenido de las celdas a formato númerico de 2 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('Z'.$intFilaInicial.':'.'Z'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('###0.00');

			//Cambiar alineación de las siguientes celdas
    		$objExcel->getActiveSheet()
		        	 ->getStyle('N'.$intFilaInicial.':'.'Q'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('S'.$intFilaInicial.':'.'S'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);
            
            $objExcel->getActiveSheet()
                	 ->getStyle('M'.$intFilaInicial.':'.'M'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('U'.$intFilaInicial.':'.'U'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);


			$objExcel->getActiveSheet()
                	 ->getStyle('Y'.$intFilaInicial.':'.'Y'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
		        	 ->getStyle('Z'.$intFilaInicial.':'.'Z'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('AG'.$intFilaInicial.':'.'AH'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('Y'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('Y'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'cotizaciones_maquinaria.xls', 'cotizaciones de maquinaria', $intFila);
	}
}