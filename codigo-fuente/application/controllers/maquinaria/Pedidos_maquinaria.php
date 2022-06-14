<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos_maquinaria extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de pedidos de maquinaria
		$this->load->model('maquinaria/pedidos_maquinaria_model', 'pedidos');
		//Cargamos el modelo de maquinaria descripciones
		$this->load->model('maquinaria/maquinaria_descripciones_model', 'maquinaria_descripciones');
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
		$this->cargar_vista('maquinaria/pedidos_maquinaria', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->pedidos->filtro($this->input->post('dteFechaInicial'),
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
		foreach ($result['pedidos'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionAutorizar = 'no-mostrar';
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

	
			    //Si el usuario cuenta con el permiso de acceso AUTORIZAR
				if (in_array('AUTORIZAR', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Autorizar
					$arrDet->mostrarAccionAutorizar = '';
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
		$arrDatos = array('rows' => $result['pedidos'],
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

	//Método para modificar los datos de un registro
	public function guardar()
	{ 

		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objPedidoMaquinaria = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista
		//Datos del pedido
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objPedidoMaquinaria->intPedidoMaquinariaID = $this->input->post('intPedidoMaquinariaID');
		$objPedidoMaquinaria->intVendedorID = $this->input->post('intVendedorID');
		$objPedidoMaquinaria->strFolioLegal = $this->input->post('strFolioLegal');
		$objPedidoMaquinaria->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objPedidoMaquinaria->strNotas =  mb_strtoupper(trim($this->input->post('strNotas')));
		$objPedidoMaquinaria->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de las formas de pago
		$objPedidoMaquinaria->strTiposPagoIDMaquinariaPago = $this->input->post('strTiposPagoIDMaquinariaPago'); 
		$objPedidoMaquinaria->strObservacionesMaquinariaPago = mb_strtoupper(trim($this->input->post('strObservacionesMaquinariaPago')));
		$objPedidoMaquinaria->strImportesMaquinariaPago = $this->input->post('strImportesMaquinariaPago');
		$objPedidoMaquinaria->strVencimientosMaquinariaPago = $this->input->post('strVencimientosMaquinariaPago');
		//Datos de los componentes(en caso de que aplique)
		$objPedidoMaquinaria->strMaquinariasDescripcionesID = $this->input->post('strMaquinariasDescripcionesID');

		//Actualizamos los datos del registro
		$bolResultado = $this->pedidos->modificar($objPedidoMaquinaria);

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
		$intID = $this->input->post('intPedidoMaquinariaID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->pedidos->buscar($intID);

		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;

			//Seleccionar las formas de pago del registro
			$otdFormasPago = $this->pedidos->buscar_formas_pago($otdResultado->pedido_maquinaria_id);
			//Si existen formas de pago del registro, se asignan al array
			if($otdFormasPago)
			{
				$arrDatos['formas_pago'] = $otdFormasPago;
			}

			//Seleccionar los componentes del registro
			$otdComponentesMaquinariaDetalles = $this->pedidos->buscar_componentes($otdResultado->pedido_maquinaria_id);	
			//Si existen componentes del registro, se asignan al array
			if($otdComponentesMaquinariaDetalles)
			{
				$arrDatos['componentes_maquinaria'] = $otdComponentesMaquinariaDetalles;
			}

			/*
			//Debemos verificar si una Maquinaria esta registrada en el catálogo con Componentes Adjuntos
			$otdComponentesMaquinaria = $this->maquinaria_descripciones->buscar_componentes($otdResultado->maquinaria_descripcion_id);
			//Si la Maquinaria cuenta con componentes adjuntos
			if($otdComponentesMaquinaria){
				//Verificamos que los componentes adjuntos contengan información en la tabla pedidos_maquinaria_detalles
				//En caso de cumplir con esta condición sobreescribiremos la información del objeto $otdComponentesMaquinaria
				$otdComponentesMaquinariaDetalles = $this->pedidos->buscar_componentes($otdResultado->pedido_maquinaria_id);
				
				if($otdComponentesMaquinariaDetalles){
					$arrDatos['componentes_maquinaria'] = $otdComponentesMaquinariaDetalles;
				}
				else{
					//Caso contrario enviaremos a la vista la información default del catálogo Componentes Adjuntos
					$arrDatos['componentes_maquinaria'] = $otdComponentesMaquinaria;
				}
			}
			*/

		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intPedidoMaquinariaID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intPedidoMaquinariaID');
		    $strEstatus = $this->input->post('strEstatus');

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->pedidos->set_estatus($intID, $strEstatus);
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
		$this->form_validation->set_rules('intPedidoMaquinariaID', 'ID', 'required|integer');
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
	        $intPedidoMaquinariaID = $this->input->post('intPedidoMaquinariaID');
	        $intCotizacionMaquinariaID = $this->input->post('intCotizacionMaquinariaID');
	        $strUsuarios = $this->input->post('strUsuarios');
	        $strMensaje = trim($this->input->post('strMensaje'));
	        //Si el tipo de acción corresponde a Guardar asignar valor nulo
			$strEstatus = (($this->input->post('strTipoAccion') === 'Guardar') ? 
							NULL : $this->input->post('strEstatus'));

	        //Hacer un llamado al método para autorizar o rechazar los datos de un registro
			$bolResultado = $this->pedidos->set_enviar_autorizacion($intPedidoMaquinariaID, 
																	$intCotizacionMaquinariaID,
																	$strUsuarios, 
																	$strMensaje, 
																	$strEstatus);
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
	
	//Método para enviar la autorización (o el rechazo) de un registro
	public function set_enviar_autorizacion_credito()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intPedidoMaquinariaID', 'ID', 'required|integer');
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
	        $intPedidoMaquinariaID = $this->input->post('intPedidoMaquinariaID');
	        $intCotizacionMaquinariaID = $this->input->post('intCotizacionMaquinariaID');
	        $strUsuarios = $this->input->post('strUsuarios');
	        $strMensaje = trim($this->input->post('strMensaje'));
	        //Si el tipo de acción corresponde a Guardar asignar valor nulo
			$strEstatus = (($this->input->post('strTipoAccion') === 'Guardar') ? 
							NULL : $this->input->post('strEstatus'));

	        //Hacer un llamado al método para autorizar o rechazar los datos de un registro
			$bolResultado = $this->pedidos->set_enviar_autorizacion_credito($intPedidoMaquinariaID, 
																			$intCotizacionMaquinariaID,
																			$strUsuarios, 
																			$strMensaje, 
																			$strEstatus);
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

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->pedidos->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->folio, 
		        						'data' => $arrCol->pedido_maquinaria_id,
		        						'regimen_fiscal_id'=> $arrCol->regimen_fiscal_id);
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
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProspectoID = $this->input->post('intProspectoID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strDetalles = $this->input->post('strDetalles');

		//Array que se utiliza para asignar los estatus 		
		$arrEstatus = array('ACTIVO', 'AUTORIZADO', 'RECHAZADO', 'FACTURADO', 'INACTIVO'); 
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->pedidos->buscar(NULL, $dteFechaInicial, $dteFechaFinal,$intProspectoID, $strEstatus, $strBusqueda);

		
		//Seleccionar los datos de las monedas que coinciden con el parámetro enviado
		$otdMonedas = $this->pedidos->buscar_distintas_monedas($dteFechaInicial, $dteFechaFinal, $intProspectoID, $strEstatus, $strBusqueda);
		
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
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
		$pdf->strLinea1 =  'LISTADO DE PEDIDOS DE MAQUINARIA '.$strTituloRangoFechas;
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
		$pdf->arrCabecera = array('FOLIO', 'PROSPECTO', 'FECHA', 'SUBTOTAL', 'IVA', 'IEPS', 'TOTAL', 'ESTATUS');
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

			//Recorremos el arreglo para obtener la información de las pedidos de maquinaria
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
								'$'.number_format($intImporteIva,2), 
								'$'.number_format($intImporteIeps,2),
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
					    			    utf8_decode($arrCol->descripcion_corta), 
					    			    '$'.number_format($intPrecio,2),  
									    '$'.number_format($intSubTotal,2)), 
					    				 $arrAlineacionDetalles, 'ClippedCell');
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
			$arrCabeceraResumen = array('ESTATUS', 'SUBTOTAL', 'IVA', 'IEPS',  'TOTAL');
			//Establece el ancho de las columnas de cabecera
			$arrAnchuraResumen = array(25, 25, 25, 25, 25);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacionResumen = array('L', 'R', 'R', 'R', 'R');
			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Creación de la tabla Resumen
			$pdf->Cell(125, 4, 'RESUMEN GENERAL EN PESOS', 0, 0, 'C', TRUE);
			$pdf->Ln(4);//Deja un salto de linea
			//Recorre el array de titulos de encabezado para crearlos
			for ($intCont = 0; $intCont < count($arrCabeceraResumen); $intCont++)
			{
				//Establecer el color de fondo para la cabecera
				$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
				//inserta los titulos de la cabecera
				$pdf->Cell($arrAnchuraResumen[$intCont], 5, $arrCabeceraResumen[$intCont], 1, 0, $arrAlineacionResumen[$intCont], TRUE);
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
					$pdf->Row(array($arrEst,'$'.number_format($arrSubtotalEstatus[$arrEst],2), 
									'$'.number_format($arrIvaEstatus[$arrEst],2), 
			    				    '$'.number_format($arrIepsEstatus[$arrEst],2), 
			    				    '$'.number_format($arrTotalEstatus[$arrEst],2)), 
									$arrAlineacionResumen);

					//Incrementar acumulados si el estatus es ACTIVO, AUTORIZADO o FACTURADO
					if($arrEst == 'ACTIVO' OR  $arrEst == 'AUTORIZADO' OR  $arrEst == 'FACTURADO')
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
				for ($intCont = 0; $intCont < count($arrCabeceraResumen); $intCont++)
				{
					//Establecer el color de fondo para la cabecera
					$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
					$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
					$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchuraResumen[$intCont], 5, $arrCabeceraResumen[$intCont], 1, 0, $arrAlineacionResumen[$intCont], TRUE);
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
						$pdf->Row(array($arrEst,'$'.number_format($arrSubtotalMoneda[$arrMon->moneda_id][$arrEst],2), 
										'$'.number_format($arrIvaMoneda[$arrMon->moneda_id][$arrEst],2), 
				    				    '$'.number_format($arrIepsMoneda[$arrMon->moneda_id][$arrEst],2), 
				    				    '$'.number_format($arrTotalMoneda[$arrMon->moneda_id][$arrEst],2)),  $arrAlineacionResumen);


						//Incrementar acumulados si el estatus es ACTIVO, AUTORIZADO o FACTURADO
						if($arrEst == 'ACTIVO' OR  $arrEst == 'AUTORIZADO' OR  $arrEst == 'FACTURADO')
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
		$pdf->Output('pedidos_maquinaria.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro() 
	{	            
		//Variables que se utilizan para recuperar los valores de la vista
		$intPedidoMaquinariaID = $this->input->post('intPedidoMaquinariaID');
		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->pedidos->buscar($intPedidoMaquinariaID);
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'pedido_maquinaria_';
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
	        //---------- DATOS DEL CLIENTE O PROSPECTO
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 42);
			$pdf->ClippedCell(92, 3, 'CLIENTE', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0); //establece el color de texto
			//RFC
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, 46);
			$pdf->ClippedCell(10, 3, 'RFC');
			//Nombre comercial
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
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
			
			//Verificar si el prospecto es un cliente
			if($otdResultado->cliente_estatus == 'ACTIVO')
			{
				//Asignar los datos del cliente
				$strNombreComercial = $otdResultado->cliente;
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
				$strNombreComercial = $otdResultado->prospecto;
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

			//Si no existe el número interior asignar cadena vacia
			$strNumInterior = (($strNumInterior !== NULL && 
				        	    empty($strNumInterior) === FALSE) ?
                                ' INT. '.$strNumInterior : '');

			//Si no existe el código postal asignar cadena vacia
			$strCodigoPostal = (($strCodigoPostal !== NULL && 
				        	     empty($strCodigoPostal) === FALSE) ?
                                 ' C.P. '.$strCodigoPostal : '');

			//Concatenar datos para el domicilio
	    	$strDomicilio =  $strCalle . ' NO.'.$strNumExterior;
	    	$strDomicilio .= $strNumInterior.' COL. ' . $strColonia;
	    	$strDomicilio .= $strCodigoPostal.' '.$strLocalidad. ', ';
	    	$strDomicilio .= $strMunicipio. ', '.$strEstado;

			//Nombre comercial
			$pdf->SetXY(15, 52);
			$pdf->MultiCell(92, 3, utf8_decode($strNombreComercial));
			//Teléfono
			$pdf->SetXY(92, 58);
			$pdf->ClippedCell(40, 3, $strTelefonoPrincipal);
			//Domicilio
			$pdf->SetXY(15, 61);
			$pdf->MultiCell(92, 3, utf8_decode($strDomicilio));



			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL PEDIDO
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(108, 42);
			$pdf->ClippedCell(92, 3, utf8_decode('PEDIDO'), 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0);//establece el color de texto
			//Folio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, 46);
			$pdf->ClippedCell(15, 3, 'FOLIO');
			//Fecha 
			$pdf->SetXY(154, 46);
			$pdf->ClippedCell(15, 3, 'FECHA');
			//Moneda
			$pdf->SetXY(108, 49);
			$pdf->ClippedCell(15, 3, 'MONEDA');
			//Tipo de cambio
			$pdf->SetXY(154, 49);
			$pdf->ClippedCell(25, 3, 'TIPO DE CAMBIO');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(135, 46);
			$pdf->ClippedCell(76, 3, $otdResultado->folio);
			//Fecha
			$pdf->SetXY(184, 46);
			$pdf->ClippedCell(29, 3, $otdResultado->fecha);
			//Moneda
			$pdf->SetXY(135, 49);
			$pdf->ClippedCell(29, 3, $otdResultado->codigo_moneda);
			//Tipo de cambio
			$pdf->SetXY(184, 49);
			$pdf->ClippedCell(20, 3, '$'.number_format($otdResultado->tipo_cambio, 4, '.', ','));


			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DEL PEDIDO
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 70);
			$pdf->ClippedCell(185, 3, 'CONCEPTOS', 0, 0, 'C', TRUE);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			
			//Tabla con los detalles del pedido
			$pdf->SetXY(15, 74);
			//Crea los titulos de la cabecera
			$arrCabecera = array('Cantidad', utf8_decode('Código'), utf8_decode('Descripción'), 'Unitario', 
								 'Descuento', 'Importe');
			//Establece el ancho de las columnas de cabecera
			$arrAnchura = array(15, 20, 75, 25, 25, 25);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacion = array('R', 'L', 'L', 'R', 'R', 'R');
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
			$pdf->SetX(15);
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

			//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
			$pdf->Row(array(number_format($intCantidad,2), utf8_decode($otdResultado->codigo),
							utf8_decode($otdResultado->descripcion), number_format($intPrecio,2), 
						    number_format($intImporteDescuento,2),  number_format($intSubTotal,2)),
						    $arrAlineacion, 'ClippedCell');

			//Calcular importe total
			$intTotal = $intSubTotal + $intImporteIva + $intImporteIeps;
			//Redondear importe total a dos decimales
			$intTotal = number_format($intTotal,2);

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
			//Cambiar color de relleno de la celda
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetX(15);
			$pdf->ClippedCell(185, 3, '', 0, 0, 'C', TRUE);
			$pdf->Ln(); //Deja un salto de línea
			//Notas
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(15);
			$pdf->ClippedCell(30, 3, 'NOTAS');
			//Subtotal
			$pdf->SetX(135);
			$pdf->ClippedCell(30, 3, 'SUBTOTAL');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(175);
			$pdf->ClippedCell(25, 3, '$'.number_format($intSubTotal,2), 0, 0, 'R');
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
			$pdf->ClippedCell(25, 3, '$'.number_format($intImporteIva,2), 0, 0, 'R');
			$pdf->Ln(); //Deja un salto de línea
			//IEPS
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(135);
			$pdf->ClippedCell(30, 3, 'IEPS');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(175);
			$pdf->ClippedCell(25, 3, '$'.number_format($intImporteIeps,2), 0, 0, 'R');
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
			//Notas
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, $intPosY);
			$pdf->MultiCell(110, 3, utf8_decode($otdResultado->notas));
			//Vendedor
            $pdf->SetXY(15,260);
            $pdf->Cell(185, 6, utf8_decode($otdResultado->vendedor), 0, 0, 'C');
            $pdf->Ln(5);//Espacios de salto de línea
            $pdf->SetX(15);
            //Vendedor
            //Asigna el tipo y tamaño de letra
            $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
            $pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
            $pdf->Cell(185, 3, 'VENDEDOR', 0, 0, 'C',  TRUE);

			//Concatenar folio para identificar cotización
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
		$otdResultado = $this->pedidos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, $strEstatus, $strBusqueda);
		
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
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
			     ->setCellValue('A7', 'LISTADO DE PEDIDOS DE MAQUINARIA '.$strTituloRangoFechas);
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
        		 ->setCellValue('C'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('D'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('E'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('F'.$intPosEncabezados, 'IEPS')
        		 ->setCellValue('G'.$intPosEncabezados, 'TOTAL')
        		 ->setCellValue('H'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('I'.$intPosEncabezados, 'T.C.')
        		 ->setCellValue('J'.$intPosEncabezados, 'VENDEDOR')
        		 ->setCellValue('K'.$intPosEncabezados, 'FOLIO PEDIDO FISICO')
        		 ->setCellValue('L'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('M'.$intPosEncabezados, 'NOTAS')
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
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('O'.$intPosEncabezados, 'CANTIDAD')
			         ->setCellValue('P'.$intPosEncabezados, 'CÓDIGO')
			         ->setCellValue('Q'.$intPosEncabezados,'DESCRIPCIÓN CORTA')
			         ->setCellValue('R'.$intPosEncabezados,'DESCRIPCION')
			         ->setCellValue('S'.$intPosEncabezados,'LÍNEA')
			         ->setCellValue('T'.$intPosEncabezados,'MARCA')
			         ->setCellValue('U'.$intPosEncabezados,'MODELO')
			         ->setCellValue('V'.$intPosEncabezados,'PRECIO UNITARIO')
			         ->setCellValue('W'.$intPosEncabezados, 'SUBTOTAL');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('O'.$intPosEncabezados.':W'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('O'.$intPosEncabezados.':W'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('O'.$intPosEncabezados.':W'.$intPosEncabezados)
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

				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
				 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->prospecto)
                         ->setCellValue('C'.$intFila, $arrCol->fecha)
                         ->setCellValue('D'.$intFila, $intPrecio)
                         ->setCellValue('E'.$intFila, $intImporteIva)
                         ->setCellValue('F'.$intFila, $intImporteIeps)
                         ->setCellValue('G'.$intFila, $intTotal)
                         ->setCellValue('H'.$intFila, $arrCol->moneda)
                         ->setCellValue('I'.$intFila, $arrCol->tipo_cambio)
                         ->setCellValue('J'.$intFila, $arrCol->vendedor)
                         ->setCellValue('K'.$intFila, $arrCol->folio_legal)
                         ->setCellValue('L'.$intFila, $arrCol->observaciones)
                         ->setCellValue('M'.$intFila, $arrCol->notas)
                         ->setCellValue('N'.$intFila, $arrCol->estatus);

				//Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
					$objExcel->setActiveSheetIndex(0)
	                         ->setCellValue('O'.$intFila, $intCantidad)
	                         ->setCellValueExplicit('P'.$intFila, $arrCol->codigo, PHPExcel_Cell_DataType::TYPE_STRING)
					         ->setCellValue('Q'.$intFila, $arrCol->descripcion_corta)
					         ->setCellValue('R'.$intFila, $arrCol->descripcion)
					         ->setCellValue('S'.$intFila, $arrCol->maquinaria_linea)
					         ->setCellValue('T'.$intFila, $arrCol->maquinaria_marca)
					         ->setCellValue('U'.$intFila, $arrCol->maquinaria_modelo)
					         ->setCellValue('V'.$intFila, $intPrecio)
					         ->setCellValue('W'.$intFila, $intSubTotal);
					
				}

				//Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
                //Incrementar el contador por cada registro
				$intContador++;
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('D'.$intFilaInicial.':'.'G'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

           	$objExcel->getActiveSheet()
            		 ->getStyle('X'.$intFilaInicial.':'.'Y'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.000000');

			//Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('I'.$intFilaInicial.':'.'I'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.0000');

            //Cambiar contenido de las celdas a formato númerico de 2 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('O'.$intFilaInicial.':'.'O'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('###0.00');

			//Cambiar alineación de las siguientes celdas
    		$objExcel->getActiveSheet()
		        	 ->getStyle('D'.$intFilaInicial.':'.'G'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('I'.$intFilaInicial.':'.'I'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);
                	 		 
			$objExcel->getActiveSheet()
                	 ->getStyle('N'.$intFilaInicial.':'.'N'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
		        	 ->getStyle('O'.$intFilaInicial.':'.'O'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
		        	 ->getStyle('W'.$intFilaInicial.':'.'W'.$intFila)
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
        $this->get_pie_pagina_archivo_excel($objExcel, 'pedidos_maquinaria.xls', 'pedidos de maquinaria', $intFila);
	}
}