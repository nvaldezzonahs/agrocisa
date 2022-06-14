<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movimientos_entradas_refacciones_compra extends MY_Controller {
	//Variable para identificar el tipo de movimiento
	var $intTipoMovimiento = ENTRADA_REFACCIONES_COMPRA;
	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;
	//Información que se utiliza para asignar el número de decimales a redondear
	var $intNumDecimales = NUM_DECIMALES_MOSTRAR_REFACCIONES;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar ruta de la carpeta principal
	    $this->archivo['strCarpetaPrincipal'] = './archivos/';
		//Asignar ruta de la carpeta destino
	    $this->archivo['strCarpetaDestino'] = './archivos/movimientos_entradas_refacciones/';
	    //Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de movimientos de refacciones
		$this->load->model('refacciones/movimientos_refacciones_model', 'movimientos');
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
		$this->cargar_vista('refacciones/movimientos_entradas_refacciones_compra', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->movimientos->filtro_entrada_compra($this->intTipoMovimiento,
												     $this->input->post('dteFechaInicial'),
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
		foreach ($result['movimientos'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionVerArchivoRegistro = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			$arrDet->mostrarAccionGenerarPoliza = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;
			 //Concatenar id del registro que hace referencia a la carpeta donde se encuentra el archivo
			$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$arrDet->proveedor_id;

			//Asignar el nombre del archivo que le corresponde al registro
		    $strNombreArchivo = $this->get_verifar_archivo_registro($strNombreCarpeta, $arrDet->movimiento_refacciones_id);

			//Si el estatus del registro es ACTIVO
			if($arrDet->estatus == 'ACTIVO')
			{

				//Si no existe id de la póliza
				if($arrDet->poliza_id == 0)
				{

					//Asignar cadena vacia para mostrar botón Generar póliza
    				$arrDet->mostrarAccionGenerarPoliza = '';
				}
					
				//Si el registro cuenta con salidas por devolución al proveedor
				if($arrDet->total_salidas_devolucion_proveedor > 0)
				{
					//Si el usuario cuenta con el permiso de acceso VER REGISTRO
					if (in_array('VER REGISTRO', $arrPermisos))
					{
						//Asignar cadena vacia para mostrar botón Ver registro
		        		$arrDet->mostrarAccionVerRegistro = '';	
					}

					
				}
				else
				{

					//Si no existe id de la póliza
					if($arrDet->poliza_id == 0)
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

						//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
						if (in_array('CAMBIAR ESTATUS', $arrPermisos))
						{
							//Asignar cadena vacia para mostrar botón Desactivar
							$arrDet->mostrarAccionDesactivar = '';
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
		$arrDatos = array('rows' => $result['movimientos'],
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
		$objMovimiento = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista 
		//Datos del movimiento
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objMovimiento->intMovimientoRefaccionesID = $this->input->post('intMovimientoRefaccionesID');
		$objMovimiento->intTipoMovimiento =  $this->intTipoMovimiento;
		$objMovimiento->dteFecha = $this->input->post('dteFecha');
		$objMovimiento->intMonedaID = $this->input->post('intMonedaID');
		$objMovimiento->intTipoCambio = $this->input->post('intTipoCambio');
		$objMovimiento->intReferenciaID = $this->input->post('intReferenciaID');
		$objMovimiento->intProveedorID = $this->input->post('intProveedorID');
		//Si no existe id del régimen fiscal asignar valor nulo
		$objMovimiento->intRegimenFiscalID = (($this->input->post('intRegimenFiscalID') !== '') ? 
										       $this->input->post('intRegimenFiscalID') : NULL);

		//Si no existe id del porcentaje de retención ISR asignar valor nulo
		$objMovimiento->intPorcentajeRetencionID = (($this->input->post('intPorcentajeRetencionID') !== '') ? 
										             $this->input->post('intPorcentajeRetencionID') : NULL);

		//Si no existe importe retenido de ISR asignar valor nulo
		$objMovimiento->intImporteRetenido = (($this->input->post('intImporteRetenido') !== '') ? 
										       $this->input->post('intImporteRetenido') : NULL);



		$objMovimiento->strFactura = mb_strtoupper($this->input->post('strFactura'));
		$objMovimiento->strRemision = mb_strtoupper($this->input->post('strRemision'));
		$objMovimiento->strTipoEntrada = $this->input->post('strTipoEntrada');
		$objMovimiento->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objMovimiento->intSucursalID = $this->session->userdata('sucursal_id');
		$objMovimiento->intUsuarioID = $this->session->userdata('usuario_id');
	    //Datos del inventario
		$objMovimiento->strLocalizaciones = $this->input->post('strLocalizaciones');
		//Datos de los detalles
		$objMovimiento->strRefaccionID = $this->input->post('strRefaccionID');
		$objMovimiento->strCodigos = $this->input->post('strCodigos'); 
		$objMovimiento->strDescripciones = $this->input->post('strDescripciones'); 
		$objMovimiento->strCodigosLineas = $this->input->post('strCodigosLineas'); 
		$objMovimiento->strCantidades = $this->input->post('strCantidades'); 
		$objMovimiento->strCostosUnitarios = $this->input->post('strCostosUnitarios'); 
		$objMovimiento->strDescuentosUnitarios = $this->input->post('strDescuentosUnitarios'); 
		$objMovimiento->strTasaCuotaIva = $this->input->post('strTasaCuotaIva'); 
		$objMovimiento->strIvasUnitarios = $this->input->post('strIvasUnitarios'); 
		$objMovimiento->strTasaCuotaIeps = $this->input->post('strTasaCuotaIeps'); 
		$objMovimiento->strIepsUnitarios = $this->input->post('strIepsUnitarios');
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;
		
		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objMovimiento->intMovimientoRefaccionesID))
		{

			$bolResultado = $this->movimientos->modificar_entrada_compra($objMovimiento);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objMovimiento->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objMovimiento->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{	
				$bolResultado = $this->movimientos->guardar_entrada_compra($objMovimiento); 

				/*Quitar '_'  de la cadena (resultadoTransaccion_movimientoRefaccionesID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $objMovimiento->intMovimientoRefaccionesID) = explode("_", $bolResultado); 
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
							 	  'movimiento_refacciones_id' => $objMovimiento->intMovimientoRefaccionesID,
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


	//Verifica la existencia del archivo XML para evitar guardar un registro.
    public function get_existenciaXML() 
    {	
    	//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('mensaje' => NULL);
    	//Variables que se utilizan para recuperar los valores de la vista
    	$intProveedorID = $this->input->post('intProveedorID');
    	$strFactura = $this->input->post('strFactura');



    	//Hacer un llamado al método para comprobar existencia del archivo XML
		$otdResultado = $this->movimientos->buscarXML_entrada_compra($this->intTipoMovimiento, $intProveedorID, $strFactura);
		
		//Si existen datos
		if($otdResultado)
		{
		    $arrDatos['mensaje'] = 'Ya existe una entrada con la información del XML.';
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
		$intID = $this->input->post('intMovimientoRefaccionesID');
		
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->movimientos->buscar_entrada_compra($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Concatenar id del registro que hace referencia a la carpeta donde se encuentra el archivo
			$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$otdResultado->proveedor_id;
			 //Asignar el nombre del archivo que le corresponde al registro
            $arrDatos['archivo'] = $this->get_verifar_archivo_registro($strNombreCarpeta, $intID);;
			$arrDatos['row'] = $otdResultado;
			//Seleccionar los datos de los detalles
			$otdDetalles = $this->movimientos->buscar_detalles_entrada_compra($intID);
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
		$this->form_validation->set_rules('intMovimientoRefaccionesID', 'ID', 'required|integer');
		$this->form_validation->set_rules('intPolizaID', 'Póliza', 'required|integer');
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
	        $intID = $this->input->post('intMovimientoRefaccionesID');
	        $intPolizaID = $this->input->post('intPolizaID');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->movimientos->set_estatus($intID, $this->intTipoMovimiento, 
															$intPolizaID);
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
			$otdResultado = $this->movimientos->autocomplete($strDescripcion, $this->intTipoMovimiento);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->movimiento, 
		        						'data' => $arrCol->movimiento_refacciones_id);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}


	//Método para subir el archivo de un registro
	public function subir_archivo()
	{

		//Variables que se utilizan para recuperar los valores de la vista 
		$intMovimientoRefaccionesID = $this->input->post('intMovimientoRefaccionesID');
		$intProveedorID = $this->input->post('intProveedorID');
		$strBotonArchivoID = $this->input->post('strBotonArchivoID');
		//Asignar el nombre de la carpeta 
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intProveedorID; 

		//Hacer un llamado a la función para subir el archivo
		$this->subir_archivo_reg($strBotonArchivoID, $this->archivo['strCarpetaPrincipal'], 
								 $this->archivo['strCarpetaDestino'], 
							     $strNombreCarpeta, $intMovimientoRefaccionesID);
    }

    //Método para descargar el archivo de un registro
    public function descargar_archivo()
	{

        //Variables que se utilizan para recuperar los valores de la vista
		$intProveedorID = $this->input->post('intProveedorID');
		$intMovimientoRefaccionesID = $this->input->post('intMovimientoRefaccionesID');

		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intProveedorID;

		//Hacer un llamado a la función para descargar el archivo
		$this->descargar_archivo_reg($strNombreCarpeta, $intMovimientoRefaccionesID);

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
		$arrEstatus = array('ACTIVO','INACTIVO'); 
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
		$otdResultado = $this->movimientos->buscar_entrada_compra(NULL, $this->intTipoMovimiento, $dteFechaInicial, 
														   		  $dteFechaFinal, $intProveedorID,$strEstatus, $strBusqueda);
		//Seleccionar los datos de las monedas que coinciden con el parámetro enviado
		$otdMonedas = $this->movimientos->buscar_distintas_monedas($this->intTipoMovimiento, $dteFechaInicial, 
																   $dteFechaFinal, $intProveedorID, $strEstatus, $strBusqueda);
		
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
		$pdf->strLinea1 =  'LISTADO DE ENTRADAS DE REFACCIONES POR COMPRA '.$strTituloRangoFechas;
		//Si existe id del proveedor
		if($intProveedorID > 0)
		{
			//Seleccionar los datos del proveedor que coincide con el id
			$otdProveedor =  $this->proveedores->buscar($intProveedorID);
			$pdf->strLinea2 =  'PROVEEDOR: '.utf8_decode($otdProveedor->codigo.' - '.$otdProveedor->razon_social);
		}

		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'PROVEEDOR', 'FECHA', 'FACTURA',  'SUBTOTAL', 'IVA', 'IEPS', 
						     	  'TOTAL', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(18, 45, 15, 18, 20, 18, 18, 18, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'L', 'R', 'R', 'R', 'R', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('R', 'L', 'L', 'L', 'L', 'R', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(16, 8, 20, 57, 20, 25, 25 );
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

			//Recorremos el arreglo para obtener la información de los movimientos
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
				$otdDetalles = $this->movimientos->buscar_detalles_entrada_compra($arrCol->movimiento_refacciones_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Variables que se utilizan para asignar valores del detalle
						$intCantidad = $arrDet->cantidad;

						//Si no existe tipo de cambio
						if($arrCol->tipo_cambio == 0)
						{
							//Asignar 1 para evitar errores
							$arrCol->tipo_cambio = 1;
						}

						//Convertir peso mexicano a tipo de cambio
						$intCostoUnitario = ($arrDet->costo_unitario / $arrCol->tipo_cambio);
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
						$intSubTotalUnitario = $intCantidad * $intCostoUnitario;

						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["cantidad"] = number_format($intCantidad,2);
						$arrAuxiliar["codigo_linea"] = utf8_decode($arrDet->codigo_linea);
						$arrAuxiliar["codigo"] = utf8_decode($arrDet->codigo);
						$arrAuxiliar["descripcion"] = utf8_decode($arrDet->descripcion);
						$arrAuxiliar["localizacion"] = utf8_decode($arrDet->localizacion);
		                $arrAuxiliar["costo_unitario"] = '$'.number_format($intCostoUnitario,$this->intNumDecimales);
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
								'$'.number_format($intTotal,$this->intNumDecimales), 
								$arrCol->estatus), $pdf->arrAlineacion, 'ClippedCell');
		        
		        //Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
		        //Si existe id de la orden de compra
		        if($arrCol->orden_compra_refacciones_id > 0)
		        {
		        	//Orden de compra
					$pdf->Cell(23, 4, 'ORDEN DE COMPRA:', 0, 0, 'L', 0);
				    $pdf->ClippedCell(15, 4, utf8_decode($arrCol->folio_orden_compra), 0, 0, 'L', 0);
		        }
				//Moneda
				$pdf->Cell(12, 4, 'MONEDA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(7, 4, utf8_decode($arrCol->codigo_moneda), 0, 0, 'L', 0);
		    	//Tipo de cambio
		    	$pdf->Cell(6, 4, 'T.C.:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(12, 4,'$'.number_format($arrCol->tipo_cambio, 4, '.', ','), 0, 0, 'R', 0);
			    //Tipo de entrada
		    	$pdf->Cell(21, 4, 'TIPO DE ENTRADA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(50, 4, $arrCol->tipo_entrada, 0, 0, 'L', 0);
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
					    $pdf->Row(array($arrDet['cantidad'], $arrDet['codigo_linea'],
					    				$arrDet['codigo'], $arrDet['descripcion'], $arrDet['localizacion'], 
					    				$arrDet['costo_unitario'],  $arrDet['subtotal']), 
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
					$pdf->Row(array($arrEst,
									'$'.number_format($arrSubtotalEstatus[$arrEst],$this->intNumDecimales), 
									'$'.number_format($arrIvaEstatus[$arrEst],$this->intNumDecimales), 
			    				    '$'.number_format($arrIepsEstatus[$arrEst],$this->intNumDecimales), 
			    				    '$'.number_format($arrTotalEstatus[$arrEst],$this->intNumDecimales)), 
									$arrAlineacionResumen);

					//Incrementar acumulados si el estatus es ACTIVO 
					if($arrEst == 'ACTIVO')
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
						$pdf->Row(array($arrEst,
										'$'.number_format($arrSubtotalMoneda[$arrMon->moneda_id][$arrEst],$this->intNumDecimales), 
										'$'.number_format($arrIvaMoneda[$arrMon->moneda_id][$arrEst],$this->intNumDecimales), 
				    				    '$'.number_format($arrIepsMoneda[$arrMon->moneda_id][$arrEst],$this->intNumDecimales), 
				    				    '$'.number_format($arrTotalMoneda[$arrMon->moneda_id][$arrEst],$this->intNumDecimales)), $arrAlineacionResumen);

						//Incrementar acumulados si el estatus es ACTIVO 
						if($arrEst == 'ACTIVO')
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
		$pdf->Output('entradas_refacciones.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro() 
	{	            
		//Variables que se utilizan para recuperar los valores de la vista
		$intMovimientoRefaccionesID = $this->input->post('intMovimientoRefaccionesID');
		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->movimientos->buscar_entrada_compra($intMovimientoRefaccionesID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->movimientos->buscar_detalles_entrada_compra($intMovimientoRefaccionesID);
		//Seleccionar los datos de las tasa de IEPS de los detalles del registro
		$otdTasasIeps = $this->movimientos->buscar_tasas_ieps_detalles_entrada_compra($intMovimientoRefaccionesID);
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
		//Array que se utiliza para asignar el acumulado del importe de IEPS por tasa
		$arrIepsTasa = array(); 
		//Variable que se utiliza para asignar el acumulado de la retención de ISR (proveedor)
		$intRetencionIsrProv = 0;
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'entrada_refacciones_';
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

			//Recorremos el arreglo para obtener la información de las tasas de IEPS
			foreach ($otdTasasIeps as $arrTasa)
			{
				//Inicializar variables
				$arrIepsTasa[$arrTasa->tasa_cuota_ieps] = 0;
			}

			

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
	        //---------- DATOS DEL MOVIMIENTO
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(108, 42);
			$pdf->ClippedCell(92, 3, 'ENTRADA DE REFACCIONES POR COMPRA', 0, 0, 'C', TRUE);
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
			//Orden de compra
			$pdf->SetXY(108, 52);
			$pdf->ClippedCell(32, 3, 'ORDEN DE COMPRA');
			//Factura o Remisión
			$pdf->SetXY(154, 52);
			//Variable que se utiliza para asignar título de factura o Remisión
			$strFacturaRemision = (($otdResultado->factura !== NULL && 
						        	empty($otdResultado->factura) === FALSE) ?
	                                'FACTURA' : utf8_decode('REMISIÓN'));
			$pdf->ClippedCell(32, 3, $strFacturaRemision);
			//Tipo de entrada
			$pdf->SetXY(108, 55);
			$pdf->ClippedCell(32, 3, 'TIPO DE ENTRADA');
			//Estatus
			$pdf->SetXY(108, 58);
			$pdf->ClippedCell(32, 3, 'ESTATUS');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(135, 46);
			$pdf->ClippedCell(76, 3, $otdResultado->folio);
			//Fecha
			$pdf->SetXY(178, 46);
			$pdf->ClippedCell(29, 3, $otdResultado->fecha);
			//Moneda
			$pdf->SetXY(135, 49);
			$pdf->ClippedCell(29, 3, $otdResultado->codigo_moneda);
			//Tipo de cambio
			$pdf->SetXY(178, 49);
			$pdf->ClippedCell(20, 3, '$'.number_format($intTipoCambio, 4, '.', ','));
			//Orden de compra
			$pdf->SetXY(135, 52);
			$pdf->ClippedCell(60, 3, $otdResultado->folio_orden_compra);
			//Factura o Remisión
		    $pdf->SetXY(178, 52);
			//Variable que se utiliza para asignar factura o Remisión
			$strFacturaRemision = (($otdResultado->factura !== NULL && 
						        	empty($otdResultado->factura) === FALSE) ?
	                                $otdResultado->factura : $otdResultado->remision);
			$pdf->ClippedCell(60, 3, $strFacturaRemision);
			//Tipo de entrada
			$pdf->SetXY(135, 55);
			$pdf->ClippedCell(60, 3, $otdResultado->tipo_entrada);
			//Estatus
			$pdf->SetXY(135, 58);
			$pdf->ClippedCell(60, 3, $otdResultado->estatus);

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DEL MOVIMIENTO
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
				//Tabla con los detalles del movimiento
				$pdf->SetXY(15, 74);
				//Crea los titulos de la cabecera
				$arrCabecera = array(utf8_decode('Línea'), utf8_decode('Código'), 
									 utf8_decode('Descripción'), utf8_decode('Localización'), 
									'Cantidad', 'Costo', 'Costo Ext.', 'Subtotal', 'Costo Promedio');
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(8, 20, 37, 20, 18, 20, 20, 20, 22);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'L', 'L', 'R', 'R', 'R', 'R', 'R');

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
					//Variable que se utiliza para asignar el importe de IVA
					$intImporteIva = 0;
					//Variable que se utiliza para asignar el importe de IEPS
					$intImporteIeps = 0;
					//Variables que se utilizan para asignar valores del detalle
					$intCantidad = $arrDet->cantidad;
					$intCostoUnitarioPesos = $arrDet->costo_unitario;
					$intCostoPromedio = $arrDet->actual_costo;
					//Variable que se utiliza para asignar el costo unitario cuando la moneda sea distinta al peso mexicano
					$intCostoUnitarioExt = '';

					//Si no existe tipo de cambio
					if($intTipoCambio == 0)
					{
						//Asignar 1 para evitar errores
						$intTipoCambio = 1;
					}



					//Convertir peso mexicano a tipo de cambio
					$intCostoUnitario = ($arrDet->costo_unitario / $intTipoCambio);
					$intIvaUnitario = ($arrDet->iva_unitario / $intTipoCambio);
					$intIepsUnitario = ($arrDet->ieps_unitario / $intTipoCambio);
					
					//Si el id de la moneda no corresponde al peso mexicano
					if($otdResultado->moneda_id != MONEDA_BASE)
					{
						//Asignar el costo unitario convertido al tipo de cambio
						$intCostoUnitarioExt = number_format($intCostoUnitario,$this->intNumDecimales);
					}


					//Asignar costo unitario
					$intSubTotalUnitario = $intCostoUnitario;

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

					    //Incrementar valor del array
					    $arrIepsTasa[$arrDet->tasa_cuota_ieps] += $intImporteIeps;
					}

					//Calcular subtotal
					$intSubTotalUnitario = $intCantidad * $intSubTotalUnitario;

					//Convertir subtotal a peso mexicano
					$intSubTotalUnitarioPesos = $intSubTotalUnitario * $intTipoCambio;

					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(utf8_decode($arrDet->codigo_linea),
									utf8_decode($arrDet->codigo), 
									utf8_decode($arrDet->descripcion), 
									utf8_decode($arrDet->localizacion),
								 	number_format($intCantidad,2), 
									number_format($intCostoUnitarioPesos,$this->intNumDecimales),
									$intCostoUnitarioExt,
									number_format($intSubTotalUnitarioPesos,$this->intNumDecimales), 
									number_format($intCostoPromedio,$this->intNumDecimales)), 
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
				$intTotalFormat = number_format($intTotal,$this->intNumDecimales);

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
				//Cambiar color de relleno de la celda
				$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
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
					$pdf->ClippedCell(20, 3, '$'.number_format($intAcumSubtotal,$this->intNumDecimales), 0, 0, 'R');
				}
				
				//Convertir subtotal a peso mexicano
				$intAcumSubtotalPesos = $intAcumSubtotal * $intTipoCambio;
				//Subtotal en pesos mexicanos
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumSubtotalPesos,$this->intNumDecimales), 0, 0, 'R');
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
						$pdf->ClippedCell(20, 3, '$'.number_format($intRetencionIsrProv, $this->intNumDecimales), 0, 0, 'R');
					}
					

					//Convertir retención ISR a peso mexicano
					$intRetencionIsrProvPesos = $intRetencionIsrProv * $intTipoCambio;

					//Retención ISR en pesos mexicanos
					$pdf->SetX(175);
					$pdf->ClippedCell(25, 3, '$'.number_format($intRetencionIsrProvPesos,$this->intNumDecimales), 0, 0, 'R');
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
					$pdf->ClippedCell(20, 3, '$'.number_format($intAcumIva,$this->intNumDecimales), 0, 0, 'R');
				}

				//Convertir IVA a peso mexicano
				$intAcumIvaPesos = $intAcumIva * $intTipoCambio;
				//IVA en pesos mexicanos
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIvaPesos,$this->intNumDecimales), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea

				//IEPS
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'IEPS');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Si el id de la moneda no corresponde al peso mexicano
				if($otdResultado->moneda_id != MONEDA_BASE)
				{
					//IEPS de la moneda extranjera (convertido al tipo de cambio)
					$pdf->SetX(158);
					$pdf->ClippedCell(20, 3, '$'.number_format($intAcumIeps,$this->intNumDecimales), 0, 0, 'R');
				}
				
				//Convertir IEPS a peso mexicano
				$intAcumIepsPesos = $intAcumIeps * $intTipoCambio;
				//IEPS en pesos mexicanos
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIepsPesos,$this->intNumDecimales), 0, 0, 'R');
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
					$pdf->ClippedCell(20, 3, '$'.number_format($intTotal,$this->intNumDecimales), 0, 0, 'R');
				}

				//Convertir total a peso mexicano
				$intTotalPesos = $intTotal * $intTipoCambio;
				//Total  en pesos mexicanos
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intTotalPesos,$this->intNumDecimales), 0, 0, 'R');

				//Asignar la posición de las tasas de IEPS
				$intPosYTasaIeps = $pdf->GetY();

				//Observaciones
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(15, $intPosYObs);
				$pdf->MultiCell(105, 3, utf8_decode($otdResultado->observaciones));

				//Recorremos el arreglo para obtener la información de los acumulados por tasa de IEPS
				if($otdTasasIeps)
				{
					//Incrementar posición de la ordenada
					$intPosYTasaIeps+=20;
					//Asignar posición para escribir los acumulados por tasa de IEPS
					$pdf->SetY($intPosYTasaIeps);
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraTasasIeps);
					//Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
					//Hacer recorrido para obtener totales por estatus
					foreach ($otdTasasIeps as $arrTasa)
					{
						$pdf->SetX(15);
						//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						$pdf->Row(array('IEPS',$arrTasa->porcentaje_ieps.'%',
										'$'.number_format($arrIepsTasa[$arrTasa->tasa_cuota_ieps],$this->intNumDecimales)), 
										 $arrAlineacionTasasIeps, 'ClippedCell');
					}

					//Cambiar el volumen de la fuente a normal
	      			$pdf->strTipoLetraTabla = '';
				}

			   //Persona que recibio entrada de refacciones
	            $pdf->SetXY(15,260);
	            //Persona que reviso entrada de refacciones
	            $pdf->SetXY(109, 260);
	            $pdf->Ln(5);//Espacios de salto de línea
	            $pdf->SetX(15);
	            //Persona que recibio entrada de refacciones
	            //Asigna el tipo y tamaño de letra
	            $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
	            $pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
	            $pdf->Cell(90, 3, 'RECIBIO', 0, 0, 'C',  TRUE);
	            //Persona que reviso la entrada de refacciones
	            $pdf->SetXY(109, 265);
	            $pdf->Cell(90, 3, 'REVISO', 0, 0, 'C',  TRUE);

	            //Fecha y hora de impresión (pie de pagina)
				$pdf->strUsuarioCreacion = $otdResultado->usuario_creacion;
				$pdf->dteFechaCreacion = $otdResultado->fecha_creacion;
				$pdf->strIncluirMembrete = 'SI';


			}//Cierre de verificación de detalles

			//Concatenar folio para identificar movimiento
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
		$otdResultado = $this->movimientos->buscar_entrada_compra(NULL, $this->intTipoMovimiento, $dteFechaInicial, 
														   		  $dteFechaFinal, $intProveedorID,$strEstatus, $strBusqueda);
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
			     ->setCellValue('A7', 'LISTADO DE ENTRADAS DE REFACCIONES POR COMPRA '.$strTituloRangoFechas);
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
        		 ->setCellValue('I'.$intPosEncabezados, 'ORDEN DE COMPRA')
        		 ->setCellValue('J'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('K'.$intPosEncabezados, 'T.C.')
        		 ->setCellValue('L'.$intPosEncabezados, 'REMISIÓN')
        		 ->setCellValue('M'.$intPosEncabezados, 'TIPO DE ENTRADA')
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
                     ->setCellValue('Q'.$intPosEncabezados, 'CÓDIGO DE LÍNEA')
                     ->setCellValue('R'.$intPosEncabezados, 'CÓDIGO')
			         ->setCellValue('S'.$intPosEncabezados, 'DESCRIPCIÓN')
			         ->setCellValue('T'.$intPosEncabezados, 'REFACCIONES LINEA')
			         ->setCellValue('U'.$intPosEncabezados, 'REFACCIONES MARCA')
			         ->setCellValue('V'.$intPosEncabezados, 'LOCALIZACIÓN')
			         ->setCellValue('W'.$intPosEncabezados,'COSTO UNITARIO')
			         ->setCellValue('X'.$intPosEncabezados, 'SUBTOTAL');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('P'.$intPosEncabezados.':X'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('P'.$intPosEncabezados.':X'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('P'.$intPosEncabezados.':X'.$intPosEncabezados)
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
				$otdDetalles = $this->movimientos->buscar_detalles_entrada_compra($arrCol->movimiento_refacciones_id);				
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Variable que se utiliza para contar el número de detalles
				    $intContDetMov = 0;

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

						//Si no existe tipo de cambio
						if($arrCol->tipo_cambio == 0)
						{
							//Asignar 1 para evitar errores
							$arrCol->tipo_cambio = 1;
						}



						//Convertir peso mexicano a tipo de cambio
						$intCostoUnitario = ($arrDet->costo_unitario / $arrCol->tipo_cambio);
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
						$intSubTotalUnitario = $intCantidad * $intCostoUnitario;

		                //Agregar datos al array
						$arrDetalles[$intContDetMov]["cantidad"] = $intCantidad;
						$arrDetalles[$intContDetMov]["codigo_linea"] = $arrDet->codigo_linea;
						$arrDetalles[$intContDetMov]["codigo"] = $arrDet->codigo;
						$arrDetalles[$intContDetMov]["descripcion"] = $arrDet->descripcion;
						$arrDetalles[$intContDetMov]["refacciones_linea"] = $arrDet->refacciones_linea;
						$arrDetalles[$intContDetMov]["refacciones_marca"] = $arrDet->refacciones_marca;
						$arrDetalles[$intContDetMov]["localizacion"] = $arrDet->localizacion;
		                $arrDetalles[$intContDetMov]["costo_unitario"] = $intCostoUnitario;
		                $arrDetalles[$intContDetMov]["subtotal"] = $intSubTotalUnitario;
		               
                        //Incrementar acumulados
						$intAcumSubtotal += $intSubTotalUnitario;
						$intAcumIva += $intImporteIva;
						$intAcumIeps += $intImporteIeps;

						//Incrementar el contador por cada registro
	                    $intContDetMov++;
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
	                         ->setCellValueExplicit('I'.$intFila, $arrCol->folio_orden_compra, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('J'.$intFila, $arrCol->moneda)
	                         ->setCellValue('K'.$intFila, $arrCol->tipo_cambio)
	                         ->setCellValue('L'.$intFila, $arrCol->remision)
	                         ->setCellValue('M'.$intFila, $arrCol->tipo_entrada)
	                         ->setCellValue('N'.$intFila, $arrCol->observaciones)
	                         ->setCellValue('O'.$intFila, $arrCol->estatus);

	                //Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
								 ->setCellValue('P'.$intFila, $arrDetalles[$intContDet]['cantidad'])
								 ->setCellValueExplicit('Q'.$intFila, $arrDetalles[$intContDet]['codigo_linea'], PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValueExplicit('R'.$intFila, $arrDetalles[$intContDet]['codigo'], PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValue('S'.$intFila, $arrDetalles[$intContDet]['descripcion'])
		                         ->setCellValue('T'.$intFila, $arrDetalles[$intContDet]['refacciones_linea'])
		                         ->setCellValue('U'.$intFila, $arrDetalles[$intContDet]['refacciones_marca'])
		                         ->setCellValue('V'.$intFila, $arrDetalles[$intContDet]['localizacion'])
						         ->setCellValue('W'.$intFila, $arrDetalles[$intContDet]['costo_unitario'])
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
            		 ->getStyle('E'.$intFilaInicial.':'.'H'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.0000');

           	$objExcel->getActiveSheet()
            		 ->getStyle('W'.$intFilaInicial.':'.'X'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.0000');

            $objExcel->getActiveSheet()
            		 ->getStyle('K'.$intFilaInicial.':'.'K'.$intFila)
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
		        	 ->getStyle('K'.$intFilaInicial.':'.'K'.$intFila)
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
		        	 ->getStyle('W'.$intFilaInicial.':'.'X'.$intFila)
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
        $this->get_pie_pagina_archivo_excel($objExcel, 'entradas_refacciones.xls', 'entradas de refacciones', 
        									$intFila);
	}
}