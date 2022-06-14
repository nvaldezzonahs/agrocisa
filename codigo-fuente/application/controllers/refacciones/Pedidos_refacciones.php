<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos_refacciones extends MY_Controller {

	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		 //Asignar ruta de la carpeta destino
	    $this->archivo['strCarpetaTemporal'] = './pedidos_refacciones_temporal_';
		 //Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de pedidos
		$this->load->model('refacciones/pedidos_refacciones_model', 'pedidos');
		//Cargamos el modelo de facturas de refacciones
		$this->load->model('refacciones/facturas_refacciones_model', 'facturas');
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
		$this->cargar_vista('refacciones/pedidos_refacciones', $arrDatos);
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
			$arrDet->mostrarAccionEnviarCorreo = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;

            //Asignar el tipo de referencia de la cotización (factura/remision/etc.)
           $strReferenciaPedido = $this->get_referencia_pedido_refacciones($arrDet->pedido_refacciones_id);

            //Si el estatus del registro es ACTIVO
			if($arrDet->estatus == 'ACTIVO')
			{

				//Si el registro cuenta con factura
				if($strReferenciaPedido != '')
				{
					//Si el usuario cuenta con el permiso de acceso VER REGISTRO
					if (in_array('VER REGISTRO', $arrPermisos))
					{
						$arrDet->mostrarAccionVerRegistro = '';
					}
				}
				else
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
				}
				
				
			}
			else 
			{
				//Si el usuario cuenta con el permiso de acceso VER REGISTRO
				if (in_array('VER REGISTRO', $arrPermisos))
				{
					$arrDet->mostrarAccionVerRegistro = '';
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

	//Método para guardar o modificar los datos de un registro
	public function guardar()
	{ 

		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objPedidoRefacciones = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista
		//Datos del pedido
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objPedidoRefacciones->intPedidoRefaccionesID = $this->input->post('intPedidoRefaccionesID');
		$objPedidoRefacciones->dteFecha = $this->input->post('dteFecha');
		$objPedidoRefacciones->intMonedaID = $this->input->post('intMonedaID');
		$objPedidoRefacciones->intTipoCambio = $this->input->post('intTipoCambio');
		//Si no existe id de la cotización asignar valor nulo
		$objPedidoRefacciones->intCotizacionRefaccionesID = (($this->input->post('intCotizacionRefaccionesID') !== '') ? 
							          			   			  $this->input->post('intCotizacionRefaccionesID') : NULL);
		$objPedidoRefacciones->intVendedorID = $this->input->post('intVendedorID');
		$objPedidoRefacciones->intEstrategiaID = $this->input->post('intEstrategiaID');
		$objPedidoRefacciones->strTipo = $this->input->post('strTipo');
		//Si no existe id del anticipo asignar valor nulo
		$objPedidoRefacciones->intAnticipoID = (($this->input->post('intAnticipoID') !== '') ? 
							          			 $this->input->post('intAnticipoID') : NULL);
		$objPedidoRefacciones->intProspectoID = $this->input->post('intProspectoID');
		$objPedidoRefacciones->intGastosPaqueteria = $this->input->post('intGastosPaqueteria');
		$objPedidoRefacciones->intGastosPaqueteriaIva = $this->input->post('intGastosPaqueteriaIva');
		$objPedidoRefacciones->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objPedidoRefacciones->strNotas = mb_strtoupper($this->input->post('strNotas'));
		$objPedidoRefacciones->intSucursalID = $this->session->userdata('sucursal_id');
		$objPedidoRefacciones->intUsuarioID = $this->session->userdata('usuario_id');

		//Datos de los detalles
		$objPedidoRefacciones->strRefaccionID = $this->input->post('strRefaccionID'); 
		$objPedidoRefacciones->strCodigos = $this->input->post('strCodigos'); 
		$objPedidoRefacciones->strDescripciones = $this->input->post('strDescripciones'); 
		$objPedidoRefacciones->strCodigosLineas = $this->input->post('strCodigosLineas'); 
		$objPedidoRefacciones->strCantidades = $this->input->post('strCantidades'); 
		$objPedidoRefacciones->strPreciosUnitarios = $this->input->post('strPreciosUnitarios'); 
		$objPedidoRefacciones->strDescuentosUnitarios = $this->input->post('strDescuentosUnitarios'); 
		$objPedidoRefacciones->strTasaCuotaIva = $this->input->post('strTasaCuotaIva'); 
		$objPedidoRefacciones->strIvasUnitarios = $this->input->post('strIvasUnitarios'); 
		$objPedidoRefacciones->strTasaCuotaIeps = $this->input->post('strTasaCuotaIeps');
		$objPedidoRefacciones->strIepsUnitarios = $this->input->post('strIepsUnitarios'); 

		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objPedidoRefacciones->intPedidoRefaccionesID))
		{
			$bolResultado = $this->pedidos->modificar($objPedidoRefacciones);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objPedidoRefacciones->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objPedidoRefacciones->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->pedidos->guardar($objPedidoRefacciones); 

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
		$intID = $this->input->post('intPedidoRefaccionesID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->pedidos->buscar($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Variable que se utiliza para asignar el saldo del anticipo
			$intSaldoAnticipo = 0;
			//Asignar el id del anticipo
			$intAnticipoID = $otdResultado->anticipo_id;

			//Si existe id del anticipo
			if($intAnticipoID > 0)
			{
				//Asignar array con el saldo por aplicar del anticipo
				$arrSaldoAnticipo = $this->get_saldo_anticipo($intAnticipoID, $intID, 'pedido_refacciones');
				$intSaldoAnticipo = $arrSaldoAnticipo['saldo'];
				
			}
			
			//Asignar el saldo por aplicar del anticipo
		    $arrDatos['saldo_anticipo'] = $intSaldoAnticipo;
			$arrDatos['row'] = $otdResultado;
			//Seleccionar los detalles del registro
			$otdDetalles = $this->pedidos->buscar_detalles($intID);
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
		$this->form_validation->set_rules('intPedidoRefaccionesID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intPedidoRefaccionesID');
		    $strEstatus = $this->input->post('strEstatus');
		    $intCotizacionRefaccionesID = $this->input->post('intCotizacionRefaccionesID');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->pedidos->set_estatus($intID, $strEstatus, 
													    $intCotizacionRefaccionesID);
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
		$strTipo = $this->input->post('strTipo');
		$intMonedaID = $this->input->post('intMonedaID');
		$intProspectoID = $this->input->post('intProspectoID');

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->pedidos->autocomplete($strDescripcion, $strTipo, 
														 $intMonedaID, $intProspectoID);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->folio, 
		        						'data' => $arrCol->pedido_refacciones_id,
		        						'anticipo_id' => $arrCol->anticipo_id,
		        						'regimen_fiscal_id'=> $arrCol->regimen_fiscal_id);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}

  
	
	//Método para enviar orden de compra al correo electrónico del prospecto
	public function enviar_correo_electronico_prospecto()
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$intPedidoRefaccionesID = $this->input->post('intPedidoRefaccionesID');
		$strCorreoElectronico = $this->input->post('strCorreoElectronico');
		$strCopiaCorreoElectronico = $this->input->post('strCopiaCorreoElectronico');

	 	//Generar el archivo PDF
        $strRuta = $this->get_reporte_registro($intPedidoRefaccionesID, 'SI');

        //Array que se utiliza para enviar correo electrónico
		$arrDatos =  array('intReferenciaID' => $intPedidoRefaccionesID,
						   'strTitulo' => utf8_decode('Pedido de Refacciones'),
						   'strRuta' => $strRuta,
						   'strCorreoElectronico'  => $strCorreoElectronico,
						   'strCopiaCorreoElectronico' => $strCopiaCorreoElectronico,
						   'strComentarios' => 'Pedido.');

		//Hacer un llamado a la función para enviar correo electrónico
		$this->set_enviar_correo($arrDatos);
	}
	

	//Método para eliminar carpeta temporal
	public function eliminar_carpeta_temporal($intPedidoRefaccionesID)
	{
        //Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaTemporal'].$intPedidoRefaccionesID; 

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
		$arrEstatus = array('ACTIVO', 'REMISION','FACTURADO', 'INACTIVO'); 
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->pedidos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, $strEstatus, $strBusqueda);
		//Seleccionar los datos de las monedas que coinciden con el parámetro enviado
		$otdMonedas = $this->pedidos->buscar_distintas_monedas($dteFechaInicial, $dteFechaFinal, $intProspectoID, $strEstatus, $strBusqueda);
		
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
		$pdf->strLinea1 =  'LISTADO DE PEDIDOS DE REFACCIONES '.$strTituloRangoFechas;
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

			//Recorremos el arreglo para obtener la información de las pedidos de compra
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

				//Seleccionar los detalles del registro
				$otdDetalles = $this->pedidos->buscar_detalles($arrCol->pedido_refacciones_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
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
						$arrAuxiliar["cantidad"] = number_format($intCantidad,2);
						$arrAuxiliar["codigo"] = utf8_decode($arrDet->codigo);
						$arrAuxiliar["descripcion"] = utf8_decode($arrDet->descripcion);
		                $arrAuxiliar["precio_unitario"] = '$'.number_format($intPrecioUnitario,6);
		                $arrAuxiliar["subtotal"] = '$'.number_format($intSubTotalUnitario,6);
		                //Asignar datos al array
                        array_push($arrDetalles, $arrAuxiliar); 

                        //Incrementar acumulados
						$intAcumSubtotal += $intSubTotalUnitario;
						$intAcumIva += $intImporteIva;
						$intAcumIeps += $intImporteIeps;
					}

				}//Cierre de verificación de detalles


				/*
				*****************************************************************************************************************
				* GASTOS DE PAQUETERÍA
				*****************************************************************************************************************
				*/
				//Si existe importe de gastos de paquetería 
				if($arrCol->gastos_paqueteria > 0)
				{
					//Asignar subtotal del gasto de paquetería
					$intGatosPaqueteriaSubtotal = $arrCol->gastos_paqueteria /  $arrCol->tipo_cambio;
					//Asignar IVA del gasto de paquetería
					$intGatosPaqueteriaIva = $arrCol->gastos_paqueteria_iva /  $arrCol->tipo_cambio;

					//Definir valores del array auxiliar de información (para cada detalle)
					$arrAuxiliar["cantidad"] = number_format(1, 2);
					$arrAuxiliar["codigo"] = '';
					$arrAuxiliar["descripcion"] = utf8_decode('GASTOS DE PAQUETERÍA');
	                $arrAuxiliar["precio_unitario"] = '$'.number_format($intGatosPaqueteriaSubtotal, 2);
	                $arrAuxiliar["subtotal"] = '$'.number_format($intGatosPaqueteriaSubtotal, 2);
	                array_push($arrDetalles, $arrAuxiliar); 

	                //Incrementar acumulados generales
	                $intAcumSubtotal += $intGatosPaqueteriaSubtotal;
	                $intAcumIva += $intGatosPaqueteriaIva;
				}

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
				$pdf->Row(array($arrCol->folio, utf8_decode($arrCol->prospecto), $arrCol->fecha,  
								'$'.number_format($intAcumSubtotal,2),
								'$'.number_format($intAcumIva,2), '$'.number_format($intAcumIeps,2),
								'$'.number_format($intTotal,2), $arrCol->estatus), $pdf->arrAlineacion, 'ClippedCell');
		        
		        //Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
				//Moneda
				$pdf->Cell(12, 4, 'MONEDA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(7, 4, utf8_decode($arrCol->codigo_moneda), 0, 0, 'L', 0);
		    	//Tipo de cambio
		    	$pdf->Cell(6, 4, 'T.C.:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(12, 4,'$'.number_format($arrCol->tipo_cambio, 4, '.', ','), 0, 0, 'R', 0);
				
				//Si existe id del anticipo 
			    if($arrCol->anticipo_id > 0)
			    {

			    	//Anticipo 
					$pdf->Cell(11, 4, utf8_decode('ANTICIPO:'), 0, 0, 'L', 0);
				    $pdf->ClippedCell(18, 4, utf8_decode($arrCol->folio_anticipo), 0, 0, 'L', 0);
			    }

			    //Si existe id de la cotización 
			    if($arrCol->cotizacion_refacciones_id > 0)
			    {

			    	//Cotización 
					$pdf->Cell(15, 4, utf8_decode('COTIZACIÓN:'), 0, 0, 'L', 0);
				    $pdf->ClippedCell(20, 4, utf8_decode($arrCol->folio_cotizacion), 0, 0, 'L', 0);
			    }

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
					    $pdf->Row(array($arrDet['cantidad'], $arrDet['codigo'], $arrDet['descripcion'],
					    				$arrDet['precio_unitario'], $arrDet['subtotal']), $arrAlineacionDetalles, 'ClippedCell');
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

					//Incrementar acumulados si el estatus es diferente de INACTIVO
					if($arrEst != 'INACTIVO')
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
				    				    '$'.number_format($arrTotalMoneda[$arrMon->moneda_id][$arrEst],2)), $arrAlineacionResumen);


						//Incrementar acumulados si el estatus es diferente de INACTIVO
						if($arrEst != 'INACTIVO')
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
		$pdf->Output('pedidos_refacciones.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro($intPedidoRefaccionesID =  NULL, $strEnviarCorreo = NULL) 
	{	            

		//Si el reporte no se enviara por correo electrónico
		if($strEnviarCorreo == NULL)
		{
			//Variables que se utilizan para recuperar los valores de la vista
			$intPedidoRefaccionesID = $this->input->post('intPedidoRefaccionesID');
		}

		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->pedidos->buscar($intPedidoRefaccionesID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->pedidos->buscar_detalles($intPedidoRefaccionesID);
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
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'pedido_refacciones_';
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
			$pdf->ClippedCell(92, 3, utf8_decode('PEDIDO DE REFACCIONES'), 0, 0, 'C', TRUE);
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
			
			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				//Tabla con los detalles del pedido
				$pdf->SetXY(15, 74);
				//Crea los titulos de la cabecera
				$arrCabecera = array('Cantidad', utf8_decode('Código'), utf8_decode('Descripción'), 
									 'Unitario', 'Descuento', 'Importe');
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(15, 30, 65, 25, 25, 25);
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
					$pdf->Row(array(number_format($intCantidad,2), utf8_decode($arrDet->codigo), 
									utf8_decode($arrDet->descripcion),  number_format($intPrecioUnitario,2), 
									number_format($intDescuentoUnitario,2), number_format($intSubTotalUnitario,2)),$arrAlineacion, 'ClippedCell');

					//Incrementar acumulados
					$intAcumSubtotal += $intSubTotalUnitario;
					$intAcumIva += $intImporteIva;
					$intAcumIeps += $intImporteIeps;
				}

				//Si existe importe de gastos de paqueteria 
				if($otdResultado->gastos_paqueteria > 0)
				{
					$pdf->SetX(15);
					//Asignar subtotal del gasto de paqueteria
					$intGatosPaqueteriaSubtotal = $otdResultado->gastos_paqueteria / $otdResultado->tipo_cambio;
					//Asignar IVA del gasto de paqueteria
					$intGatosPaqueteriaIva = $otdResultado->gastos_paqueteria_iva / $otdResultado->tipo_cambio;
					
					//Gastos de paqueterías
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->ClippedCell(40, 4, utf8_decode('GASTOS DE PAQUETERÍA'), 0, 0, 'L', 0);
					//Subtotal de gastos de paqueterías
					$pdf->ClippedCell(145, 4,  '$'.number_format($intGatosPaqueteriaSubtotal,2), 0, 0, 'R', 0);

					//Incrementar acumulados generales
					$intAcumSubtotal += $intGatosPaqueteriaSubtotal;
					$intAcumIva += $intGatosPaqueteriaIva;

					$pdf->Ln(5); //Deja un salto de línea

				}//Cierre de verificación de gastos de paqueteria

				//Calcular importe total
				$intTotal = $intAcumSubtotal +$intAcumIva + $intAcumIeps;
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
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumSubtotal,2), 0, 0, 'R');
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
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIva,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				//IEPS
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'IEPS');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIeps,2), 0, 0, 'R');
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
	            
	            
			}//Cierre de verificación de detalles
			//Fecha y hora de impresión (pie de pagina)
			$pdf->strUsuarioCreacion = $otdResultado->usuario_creacion;
			$pdf->dteFechaCreacion = $otdResultado->fecha_creacion;
			$pdf->strIncluirMembrete = 'SI';
			//Concatenar folio para identificar orden de compra
			$strNombreArchivo .= $otdResultado->folio;

		}//Cierre de verificación de información

		//Si la opción es enviar reporte por correo electrónico
		if($strEnviarCorreo == 'SI')
		{	
			 //Definir ubicación de la carpeta
			$strCarpetaDestino =  $this->archivo['strCarpetaTemporal'].$intPedidoRefaccionesID.'/'; 
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
			     ->setCellValue('A7', 'LISTADO DE PEDIDOS DE REFACCIONES '.$strTituloRangoFechas);
		//Si existe id del prospecto
		if($intProspectoID > 0)
		{   
			//Seleccionar los datos del prospecto que coincide con el id
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
        		 ->setCellValue('K'.$intPosEncabezados, 'ESTRATEGIA')
        		 ->setCellValue('L'.$intPosEncabezados, 'TIPO')
        		 ->setCellValue('M'.$intPosEncabezados, 'ANTICIPO')       
        		 ->setCellValue('N'.$intPosEncabezados, 'COTIZACIÓN')        		 
        		 ->setCellValue('O'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('P'.$intPosEncabezados, 'NOTAS')
                 ->setCellValue('Q'.$intPosEncabezados, 'ESTATUS');

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
    			 ->getStyle('A10:Q10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:Q10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:Q10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('R'.$intPosEncabezados, 'CANTIDAD')
			         ->setCellValue('S'.$intPosEncabezados, 'CÓDIGO')
			         ->setCellValue('T'.$intPosEncabezados, 'DESCRIPCIÓN')
			         ->setCellValue('U'.$intPosEncabezados, 'REFACCIONES LINEA')
			         ->setCellValue('V'.$intPosEncabezados, 'REFACCIONES MARCA')
			         ->setCellValue('W'.$intPosEncabezados,'PRECIO UNITARIO')
			         ->setCellValue('X'.$intPosEncabezados, 'SUBTOTAL');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('R'.$intPosEncabezados.':X'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('R'.$intPosEncabezados.':X'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('R'.$intPosEncabezados.':X'.$intPosEncabezados)
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

				//Seleccionar los detalles del registro
				$otdDetalles = $this->pedidos->buscar_detalles($arrCol->pedido_refacciones_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Variable que se utiliza para contar el número de detalles
				    $intContDetPed = 0;

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
			        	$arrDetalles[$intContDetPed]['cantidad'] = $intCantidad;
			        	$arrDetalles[$intContDetPed]['codigo'] = $arrDet->codigo;
			        	$arrDetalles[$intContDetPed]['descripcion'] = $arrDet->descripcion;
			        	$arrDetalles[$intContDetPed]['linea'] = $arrDet->refacciones_linea;
			        	$arrDetalles[$intContDetPed]['marca'] = $arrDet->refacciones_marca;
			        	$arrDetalles[$intContDetPed]['precio_unitario'] = $intPrecioUnitario;
			        	$arrDetalles[$intContDetPed]['subtotal'] = $intSubTotalUnitario;
                        //Incrementar acumulados
						$intAcumSubtotal += $intSubTotalUnitario;
						$intAcumIva += $intImporteIva;
						$intAcumIeps += $intImporteIeps;

						//Incrementar el contador por cada registro
	                    $intContDetPed++;
					}

				}//Cierre de verificación de detalles


				/*
				*****************************************************************************************************************
				* GASTOS DE PAQUETERÍA
				*****************************************************************************************************************
				*/
				//Si existe importe de gastos de paquetería 
				if($arrCol->gastos_paqueteria > 0)
	        	{
	        		//Asignar subtotal del gasto de paquetería
					$intGatosPaqueteriaSubtotal = $arrCol->gastos_paqueteria / $arrCol->tipo_cambio;
					//Asignar IVA del gasto de paquetería
					$intGatosPaqueteriaIva = $arrCol->gastos_paqueteria_iva / $arrCol->tipo_cambio;

					//Si se cumple la sentencia mostrar detalles del registro
					if($strDetalles == 'SI')
					{
						//Agregar datos al array
						$arrDetalles[$intContDetPed]['cantidad'] = 1;
		        		$arrDetalles[$intContDetPed]['codigo'] = '';
		        		$arrDetalles[$intContDetPed]['descripcion'] = 'GASTOS DE PAQUETERÍA';
		        		$arrDetalles[$intContDetPed]['linea'] = '';
				        $arrDetalles[$intContDetPed]['marca'] = '';
		        		$arrDetalles[$intContDetPed]['precio_unitario']= $intGatosPaqueteriaSubtotal;
		        		$arrDetalles[$intContDetPed]['subtotal'] = $intGatosPaqueteriaSubtotal;
		        		//Incrementar número de detalles
		        		$intNumDetalles++;
		        	}

					//Incrementar acumulados generales
					$intAcumSubtotal += $intGatosPaqueteriaSubtotal;
					$intAcumIva += $intGatosPaqueteriaIva;

	        	}//Cierre de verificación de gastos de paquetería 

				//Calcular importe total
				$intTotal = $intAcumSubtotal +$intAcumIva + $intAcumIeps;

				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    {
			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('B'.$intFila, $arrCol->prospecto)
	                         ->setCellValue('C'.$intFila, $arrCol->fecha)
	                         ->setCellValue('D'.$intFila, $intAcumSubtotal)
	                         ->setCellValue('E'.$intFila, $intAcumIva)
	                         ->setCellValue('F'.$intFila, $intAcumIeps)
	                         ->setCellValue('G'.$intFila, $intTotal)
	                         ->setCellValue('H'.$intFila, $arrCol->moneda)
	                         ->setCellValue('I'.$intFila, $arrCol->tipo_cambio)
	                         ->setCellValue('J'.$intFila, $arrCol->vendedor)
	                         ->setCellValue('K'.$intFila, $arrCol->estrategia)
	                         ->setCellValue('L'.$intFila, $arrCol->tipo)
	                         ->setCellValueExplicit('M'.$intFila, $arrCol->folio_anticipo, PHPExcel_Cell_DataType::TYPE_STRING)   
	                          ->setCellValueExplicit('N'.$intFila, $arrCol->folio_cotizacion, PHPExcel_Cell_DataType::TYPE_STRING)                   
	                         ->setCellValue('O'.$intFila, $arrCol->observaciones)
	                         ->setCellValue('P'.$intFila, $arrCol->notas)
	                         ->setCellValue('Q'.$intFila, $arrCol->estatus);

	                //Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
						 		 ->setCellValue('R'.$intFila, $arrDetalles[$intContDet]['cantidad'])
						         ->setCellValue('S'.$intFila, $arrDetalles[$intContDet]['codigo'])
						         ->setCellValue('T'.$intFila, $arrDetalles[$intContDet]['descripcion'])
						         ->setCellValue('U'.$intFila, $arrDetalles[$intContDet]['linea'])
						         ->setCellValue('V'.$intFila, $arrDetalles[$intContDet]['marca'])
						         ->setCellValue('W'.$intFila, $arrDetalles[$intContDet]['precio_unitario'])
						         ->setCellValue('X'.$intFila, $arrDetalles[$intContDet]['subtotal']);
					}

	                //Incrementar el indice para escribir los datos del siguiente registro
                    $intFila++;
			    }

                //Incrementar el contador por cada registro
				$intContador++;
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('D'.$intFilaInicial.':'.'G'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

           	$objExcel->getActiveSheet()
            		 ->getStyle('W'.$intFilaInicial.':'.'X'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('I'.$intFilaInicial.':'.'I'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.0000');

            //Cambiar contenido de las celdas a formato númerico de 2 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('R'.$intFilaInicial.':'.'R'.$intFila)
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
                	 ->getStyle('Q'.$intFilaInicial.':'.'Q'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

             $objExcel->getActiveSheet()
		        	 ->getStyle('O'.$intFilaInicial.':'.'O'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);
                	 		 
			$objExcel->getActiveSheet()
                	 ->getStyle('Q'.$intFilaInicial.':'.'Q'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

          $objExcel->getActiveSheet()
		        	 ->getStyle('R'.$intFilaInicial.':'.'R'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
		        	 ->getStyle('W'.$intFilaInicial.':'.'X'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('Q'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('Q'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'pedidos_refacciones.xls', 'pedidos de refacciones', $intFila);
	}
}