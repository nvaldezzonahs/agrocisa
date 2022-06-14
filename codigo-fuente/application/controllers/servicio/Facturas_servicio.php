<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facturas_servicio extends MY_Controller {
	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;
	//Información que se utiliza para asignar los indices iniciales del archivo Excel
	var $archivoExcel = NULL;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar el indice de la columna principal
	    $this->archivoExcel['intIndColInicial'] = 1;
		//Asignar ruta de la carpeta principal
	    $this->archivo['strCarpetaPrincipal'] = './archivos/';
		//Asignar ruta de la carpeta destino
	    $this->archivo['strCarpetaDestino'] = './archivos/facturas_servicio/';
	    //Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de facturas de servicio
		$this->load->model('servicio/facturas_servicio_model', 'facturas');
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
		$this->cargar_vista('servicio/facturas_servicio', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Definir ubicación de la carpeta principal
		$strCarpetaDestino = './archivos/facturas_servicio/';
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->facturas->filtro(
											$this->input->post('dteFechaInicial'),
										  	$this->input->post('dteFechaFinal'),
										  	$this->input->post('intProspectoID'),
										  	trim($this->input->post('strEstatus')),
										 	trim($this->input->post('strBusqueda')),
			                              	$config['per_page'],
			                              	$config['cur_page']
			                              );
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['facturas'] as $arrDet)
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
			$arrDet->mostrarAccionMotivoCancelacion = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;

            //Concatenar id del registro que hace referencia a la carpeta donde se encuentra el archivo
			$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$arrDet->factura_servicio_id;

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
					//Si existe id de la cancelación del CFDI (timbrado)
					if($arrDet->cancelacion_id > 0)
					{
						//Asignar cadena vacia para mostrar botón Motivo de cancelación
						$arrDet->mostrarAccionMotivoCancelacion = '';
					}

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
		$objFacturaServicio = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objFacturaServicio->intFacturaServicioID = $this->input->post('intFacturaServicioID');
		$objFacturaServicio->dteFecha = $this->input->post('dteFecha');
		$objFacturaServicio->strCondicionesPago = $this->input->post('strCondicionesPago');
		//Si la fecha esta vacia asignar valor nulo
		$objFacturaServicio->dteVencimiento = (($this->input->post('dteVencimiento') !== '') ? 
							              $this->input->post('dteVencimiento') : NULL);
		$objFacturaServicio->intMonedaID = $this->input->post('intMonedaID');
		$objFacturaServicio->intTipoCambio = $this->input->post('intTipoCambio');
		$objFacturaServicio->intOrdenReparacionID = $this->input->post('intOrdenReparacionID');
		$objFacturaServicio->intEstrategiaID = $this->input->post('intEstrategiaID');
		$objFacturaServicio->intProspectoID = $this->input->post('intProspectoID');
		$objFacturaServicio->strRazonSocial =  mb_strtoupper(trim($this->input->post('strRazonSocial')));
		$objFacturaServicio->strRfc =  mb_strtoupper(trim($this->input->post('strRfc')));
		$objFacturaServicio->intRegimenFiscalID = (($this->input->post('intRegimenFiscalID') !== '') ? 
							          			   	$this->input->post('intRegimenFiscalID') : NULL);
		$objFacturaServicio->strCalle =  mb_strtoupper(trim($this->input->post('strCalle')));
		$objFacturaServicio->strNumeroExterior = mb_strtoupper($this->input->post('strNumeroExterior'));
		$objFacturaServicio->strNumeroInterior = mb_strtoupper($this->input->post('strNumeroInterior'));
		$objFacturaServicio->strCodigoPostal = $this->input->post('strCodigoPostal');
		$objFacturaServicio->strColonia =  mb_strtoupper(trim($this->input->post('strColonia')));
		$objFacturaServicio->strLocalidad =  mb_strtoupper(trim($this->input->post('strLocalidad')));
		$objFacturaServicio->strMunicipio = mb_strtoupper(trim($this->input->post('strMunicipio')));
		$objFacturaServicio->strEstado =  mb_strtoupper(trim($this->input->post('strEstado')));
		$objFacturaServicio->strPais = mb_strtoupper(trim($this->input->post('strPais')));
		$objFacturaServicio->intGastosServicio =  $this->input->post('intGastosServicio');
		$objFacturaServicio->intGastosServicioIva = $this->input->post('intGastosServicioIva');
		$objFacturaServicio->intFormaPagoID = $this->input->post('intFormaPagoID');
		$objFacturaServicio->intMetodoPagoID = $this->input->post('intMetodoPagoID');
		$objFacturaServicio->intUsoCfdiID = $this->input->post('intUsoCfdiID');
		//Si no existe id del tipo de relación asignar valor nulo
		$objFacturaServicio->intTipoRelacionID = (($this->input->post('intTipoRelacionID') !== '') ? 
						   	   				 $this->input->post('intTipoRelacionID') : NULL);
		//Si no existe id de la exportación asignar valor nulo
		$objFacturaServicio->intExportacionID = (($this->input->post('intExportacionID') !== '') ? 
						   	   					 $this->input->post('intExportacionID') : NULL);
		$objFacturaServicio->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objFacturaServicio->strNotas = mb_strtoupper(trim($this->input->post('strNotas')));
		$objFacturaServicio->intSucursalID = $this->session->userdata('sucursal_id');
		$objFacturaServicio->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los CFDI relacionados
		$objFacturaServicio->strCfdiRelacionado = $this->input->post('strCfdiRelacionado'); 
		$objFacturaServicio->strTiposRelacion = $this->input->post('strTiposRelacion'); 
		//Datos de los servicios de mano de obra
		$objFacturaServicio->arrServiciosManoObra = json_decode($this->input->post('arrServiciosManoObra'));	
		//Datos de las refacciones
		$objFacturaServicio->arrRefacciones = json_decode($this->input->post('arrRefacciones'));	
		//Datos de los trabajos foráneos
		$objFacturaServicio->arrTrabajosForaneos = json_decode($this->input->post('arrTrabajosForaneos'));	
		//Datos de otros servicios
		$objFacturaServicio->arrOtros = json_decode($this->input->post('arrOtros'));	
		//Datos de la clave de autorización (clave generada cuando se excede el límite de crédito/saldo vencido)
		$objFacturaServicio->intClaveAutorizacionID = $this->input->post('intClaveAutorizacionID'); 

		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;


		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objFacturaServicio->intFacturaServicioID))
		{
			$bolResultado = $this->facturas->modificar($objFacturaServicio);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objFacturaServicio->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objFacturaServicio->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->facturas->guardar($objFacturaServicio); 

				/*Quitar '_'  de la cadena (resultadoTransaccion_facturaServicioID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $objFacturaServicio->intFacturaServicioID) = explode("_", $bolResultado); 

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
							 	  'factura_servicio_id' => $objFacturaServicio->intFacturaServicioID,
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
		$arrDatos = array('row' => NULL, 
						  'mano_obra' => NULL, 
						  'refacciones' => NULL, 
						  'trabajos_foraneos' => NULL, 
						  'otros' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intID = $this->input->post('intFacturaServicioID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->facturas->buscar($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Concatenar id del registro que hace referencia a la carpeta donde se encuentra el archivo
			$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intID;
			//Asignar el nombre del archivo que le corresponde al registro
	        $arrDatos['archivo'] = $this->get_verifar_archivo_registro($strNombreCarpeta, $otdResultado->folio);
			$arrDatos['row'] = $otdResultado;
			//Asignar importe de pagos (abonos) de la factura
			$arrDatos['abonos'] =  $this->get_abonos_factura($intID, 'SERVICIO', $otdResultado->estatus);

			//Seleccionar los servicios de mano de obra del registro
			$otdServiciosManoObra = $this->facturas->buscar_servicios_mano_obra($intID);
			//Seleccionar las refacciones del registro
			$otdRefacciones = $this->facturas->buscar_refacciones($intID);
			//Seleccionar los trabajos foráneos del registro
			$otdTrabajosForaneos = $this->facturas->buscar_trabajos_foraneos($intID);
			//Seleccionar los otros servicios del registro
			$otdOtros = $this->facturas->buscar_otros($intID);
			
			//Verificar si existe información de los servicios de mano de obra
			if($otdServiciosManoObra)
			{
				$arrDatos['mano_obra'] = $otdServiciosManoObra;
			}//Cierre de verificación de servicios
			
			//Verificar si existe información de las refacciones
			if($otdRefacciones)
			{
				$arrDatos['refacciones'] = $otdRefacciones;
			}//Cierre de verificación de refacciones

			//Verificar si existe información de los trabajos foráneos 
			if($otdTrabajosForaneos)
			{
				$arrDatos['trabajos_foraneos'] = $otdTrabajosForaneos;
			}//Cierre de verificación de trabajos foráneos

			//Verificar si existe información de los otros servicios
			if($otdOtros)
			{
				$arrDatos['otros'] = $otdOtros;
			}//Cierre de verificación de otros servicios
		}

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	
	

	//Método para regresar todos los registros activos en un autocomplete
	public function autocomplete()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$strDescripcion = trim($this->input->post('strDescripcion'));
		$strFormulario = $this->input->post('strFormulario');
		$intReferenciaID = $this->input->post('intReferenciaID');

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->facturas->autocomplete($strDescripcion, $strFormulario, $intReferenciaID);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->folio, 
		        						'data' => $arrCol->factura_servicio_id, 
		        						'uuid' => $arrCol->uuid, 
		        						'regimen_fiscal_id' => $arrCol->regimen_fiscal_id);
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
		$arrEstatus = array('ACTIVO', 'TIMBRAR', 'INACTIVO'); 
		//Array que se utiliza para asignar el subtotal por estatus
		$arrSubtotalEstatus = array(); 
		//Array que se utiliza para asignar el IVA por estatus
		$arrIvaEstatus = array();
		//Array que se utiliza para asignar el IEPS por estatus
		$arrIepsEstatus = array(); 
		//Array que se utiliza para asignar el total por estatus
		$arrTotalEstatus = array();
		//Array que se utiliza para asignar el costo por estatus
		$arrCostoEstatus = array();
		//Array que se utiliza para asignar la utilidad por estatus
		$arrUtilidadEstatus = array();
		//Array que se utiliza para asignar el subtotal por moneda
		$arrSubtotalMoneda = array(); 
		//Array que se utiliza para asignar el IVA por moneda
		$arrIvaMoneda = array();
		//Array que se utiliza para asignar el IEPS por moneda
		$arrIepsMoneda = array(); 
		//Array que se utiliza para asignar el total por moneda
		$arrTotalMoneda = array();
		//Array que se utiliza para asignar el costo por moneda
		$arrCostoMoneda = array();
		//Array que se utiliza para asignar el utilidad por moneda
		$arrUtilidadMoneda = array();
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
		//Variable que se utiliza para asignar el acumulado del costo por estatus
		$intAcumCostoEstatus = 0;
		//Variable que se utiliza para asignar el acumulado de la utilidad por estatus
		$intAcumUtilidadEstatus = 0;
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Array que se utiliza para agregar los datos de las facturas
	    $arrFacturas = array();
	    //Variable que se utiliza para asignar el acumulado general del subtotal
        $intAcumGralSubtotal = 0;
        //Variable que se utiliza para asignar el acumulado general del IVA
        $intAcumGralIva = 0;
        //Variable que se utiliza para asignar el acumulado general del IEPS
        $intAcumGralIeps = 0;
        //Variable que se utiliza para asignar el acumulado general del total
        $intAcumGralTotal = 0;
        //Variable que se utiliza para asignar el acumulado general del costo
        $intAcumGralCosto = 0;
        //Variable que se utiliza para asignar el acumulado  generalde la utilidad
        $intAcumGralUtilidad = 0;

		//Seleccionar los datos de las monedas que coinciden con el parámetro enviado
		$otdMonedas = $this->facturas->buscar_distintas_monedas($dteFechaInicial, $dteFechaFinal, 
															    $intProspectoID, $strEstatus, $strBusqueda);
		
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
		$pdf->strLinea1 =  'LISTADO DE FACTURAS DE SERVICIO '.$strTituloRangoFechas;
		//Si existe id del cliente
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del cliente que coincide con el id
			$otdProspecto =  $this->clientes->buscar($intProspectoID);
			$pdf->strLinea2 = utf8_decode('RAZÓN SOCIAL: '.$otdProspecto->razon_social);
		}

		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', utf8_decode('RAZÓN SOCIAL'), 'FECHA', 
								  'SUBTOTAL', 'IVA', 'IEPS', 'TOTAL', 'COSTO', 
								  'UTILIDAD', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(18, 32, 17, 18, 18, 18, 18, 18, 18, 15);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'R', 'R', 'R', 'R', 'R',
							   		'R', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('R', 'L', 'R', 'R', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(20, 81, 18, 18, 18);
		//Establece la alineación de las celdas de la tabla movimientos de refacciones de la orden de reparación
	    $arrAlineacionMovRefacciones = array('R', 'L', 'L', 'C', 'R', 'R', 'C');
	    //Establece el ancho de las columnas de la tabla movimientos de refacciones de la orden de reparación
		$arrAnchuraMovRefacciones = array(20, 45, 18, 18, 18, 18, 18);


		//Agregar la primer pagina
		$pdf->AddPage();

		///Asignar objeto con las facturas  que coinciden con el parámetro enviado
		$otdFacturas = $this->get_facturas($dteFechaInicial, $dteFechaFinal, $intProspectoID, 
								 		   $strEstatus, $strBusqueda);
		//Asignar array con los datos de las facturs
		$arrFacturas = $otdFacturas['facturas'];


	
		//Si hay información
		if ($arrFacturas)
		{	

			//Recorremos el arreglo para obtener la información de los estatus
			foreach ($arrEstatus as $arrEst)
			{
				//Inicializar variables
				$arrSubtotalEstatus[$arrEst] = 0;
				$arrIvaEstatus[$arrEst] = 0;
				$arrIepsEstatus[$arrEst] = 0;
				$arrTotalEstatus[$arrEst] = 0;
				$arrCostoEstatus[$arrEst] = 0;
				$arrUtilidadEstatus[$arrEst] = 0;
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
					$arrCostoMoneda[$arrMon->moneda_id][$arrEst] = 0;
					$arrUtilidadMoneda[$arrMon->moneda_id][$arrEst] = 0;
					$arrTotalRegistrosMoneda[$arrMon->moneda_id] = 0;
				}
			}

			//Recorremos el arreglo para obtener la información de las facturas
			foreach ($arrFacturas as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);

				//Variables que se utilizan para asignar los datos de la factura
			    $intTipoCambioFactura = $arrCol['tipo_cambio'];
			    $strEstatus = $arrCol['estatus'];
			    $intMonedaID = $arrCol['moneda_id'];
			    $intAcumSubtotal = $arrCol['subtotal'];
			    $intAcumIva = $arrCol['iva'];
			    $intAcumIeps = $arrCol['ieps'];
			    $intTotal = $arrCol['importe'];
			    $intAcumCosto = $arrCol['acumulado_costo'];
			    $intAcumUtilidad = $arrCol['utilidad'];


				//Incrementar valores de los siguientes arrays
				$arrSubtotalEstatus[$strEstatus] += ($intAcumSubtotal * $intTipoCambioFactura);
		      	$arrIvaEstatus[$strEstatus] += ($intAcumIva * $intTipoCambioFactura);
		      	$arrIepsEstatus[$strEstatus] += ($intAcumIeps * $intTipoCambioFactura);
		      	$arrTotalEstatus[$strEstatus] += ($intTotal * $intTipoCambioFactura);
		      	$arrCostoEstatus[$strEstatus] += ($intAcumCosto * $intTipoCambioFactura);
		      	$arrUtilidadEstatus[$strEstatus] += ($intAcumUtilidad * $intTipoCambioFactura);

		        //Si el id de la moneda no corresponde al peso mexicano
		      	if($intMonedaID != MONEDA_BASE)
		      	{
		      		//Incrementar valores de los siguientes arrays
			      	$arrSubtotalMoneda[$intMonedaID][$strEstatus] += $intAcumSubtotal;
			      	$arrIvaMoneda[$intMonedaID][$strEstatus] += $intAcumIva;
			      	$arrIepsMoneda[$intMonedaID][$strEstatus] += $intAcumIeps;
			      	$arrTotalMoneda[$intMonedaID][$strEstatus] += $intTotal;
			      	$arrCostoMoneda[$intMonedaID][$strEstatus] += $intAcumCosto;
			      	$arrUtilidadMoneda[$intMonedaID][$strEstatus] += $intAcumUtilidad;
			      	$arrTotalRegistrosMoneda[$intMonedaID] += 1;
		      	}

		        //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol['folio'], utf8_decode($arrCol['razon_social']), 
								$arrCol['fecha'],  
								'$'.number_format($intAcumSubtotal,2),
								'$'.number_format($intAcumIva,2), 
								'$'.number_format($intAcumIeps,2),
								'$'.number_format($intTotal,2),
								'$'.number_format($intAcumCosto,2),
								'$'.number_format($intAcumUtilidad,2), 
								 $strEstatus), 
								 $pdf->arrAlineacion, 'ClippedCell');
				
				//Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
				//Moneda
				$pdf->Cell(12, 4, 'MONEDA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(7, 4, utf8_decode($arrCol['codigo_moneda']), 0, 0, 'L', 0);
		    	//Tipo de cambio
		    	$pdf->Cell(6, 4, 'T.C.:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(12, 4,'$'.number_format($arrCol['tipo_cambio'], 4, '.', ','), 0, 0, 'R', 0);
			    //Orden de reparación
		    	$pdf->Cell(18, 4, 'NO. DE ORDEN:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(18, 4, $arrCol['folio_orden_reparacion'], 0, 0, 'L', 0);
			     //Condiciones de pago
			    $pdf->Cell(18, 4, 'TIPO DE VENTA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(13, 4, utf8_decode($arrCol['condiciones_pago']), 0, 0, 'L', 0);


				//Si se cumple la sentencia mostrar detalles del registro
				if($arrCol['detalles'][0] && $strDetalles == 'SI')
				{
					$pdf->Ln(5);//Deja un salto de línea
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraDetalles);

					/*
					*****************************************************************************************************************
					* DETALLES DE LA FACTURA
					*****************************************************************************************************************
					*/
					//Recorremos el arreglo 
			        foreach ($arrCol['detalles'][0] as $arrDet) 
			        {
			        	//Variable que se utiliza para asignar el acumulado del costo
				    	$strCosto =   (($arrDet['acumulado_costo'] != '') ? 
						  				'$'.number_format($arrDet['acumulado_costo'],2) : '');

					    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array($arrDet['folio_orden'], 
					    				utf8_decode($arrDet['descripcion']), 
					    				'$'.number_format($arrDet['subtotal'],2), 
					    				 $strCosto, 
					    				'$'.number_format($arrDet['utilidad'],2)),
					    				$arrAlineacionDetalles,'ClippedCell');
					  

					}//Cierre de foreach detalles de la factura


					/*
					*****************************************************************************************************************
					* MOVIMIENTOS DE REFACCIONES
					*****************************************************************************************************************
					*/
					//Verificar si existe información de los movimientos de refacciones
					if($arrCol['movimientos_refacciones'][0])
					{
						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraMovRefacciones);
						//Recorremos el arreglo 
						foreach ($arrCol['movimientos_refacciones'][0] as $arrMov) 
				        {
							//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						    $pdf->Row(array($arrMov['folio_movimiento'], 
						    				utf8_decode($arrMov['descripcion']), 
						    				$arrMov['folio_requisicion'], 
						    				$arrMov['fecha'],
						    				'$'.number_format($arrMov['subtotal'],2), 
						    			    '$'.number_format($arrMov['acumulado_costo'],2), 
						    				$arrMov['estatus']),
						    				$arrAlineacionMovRefacciones, 'ClippedCell');
						}

					}//Cierre de verificación de movimientos de refacciones

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
			$arrCabeceraResumen = array('ESTATUS', 'SUBTOTAL', 'IVA', 'IEPS',  'TOTAL', 'COSTO', 'UTILIDAD');
			//Establece el ancho de las columnas de cabecera
			$arrAnchuraResumen = array(25, 25, 25, 25, 25, 25, 25);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacionResumen = array('L', 'R', 'R', 'R', 'R', 'R', 'R');
			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Creación de la tabla Resumen
			$pdf->Cell(175, 4, 'RESUMEN GENERAL EN PESOS', 0, 0, 'C', TRUE);
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
					$pdf->Row(array($arrEst,'$'.number_format($arrSubtotalEstatus[$arrEst],2), 
									'$'.number_format($arrIvaEstatus[$arrEst],2), 
			    				    '$'.number_format($arrIepsEstatus[$arrEst],2), 
			    				    '$'.number_format($arrTotalEstatus[$arrEst],2),
			    				    '$'.number_format($arrCostoEstatus[$arrEst],2),
			    					'$'.number_format($arrUtilidadEstatus[$arrEst],2)), 
									$arrAlineacionResumen);

					//Incrementar acumulados si el estatus es ACTIVO o TIMBRAR
					if($arrEst == 'ACTIVO' ||  $arrEst == 'TIMBRAR')
					{
						//Incrementar acumulados
						$intAcumSubtotalEstatus += $arrSubtotalEstatus[$arrEst];
						$intAcumIvaEstatus += $arrIvaEstatus[$arrEst];
						$intAcumIepsEstatus += $arrIepsEstatus[$arrEst];
						$intAcumTotalEstatus += $arrTotalEstatus[$arrEst];
						$intAcumCostoEstatus += $arrCostoEstatus[$arrEst];
						$intAcumUtilidadEstatus += $arrUtilidadEstatus[$arrEst];
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
            //Acumulado del costo
            $pdf->Cell(25,3,'$'.number_format($intAcumCostoEstatus,2), 0, 0, 'R');
            //Acumulado de la utilidad
            $pdf->Cell(25,3,'$'.number_format($intAcumUtilidadEstatus,2), 0, 0, 'R');

            $pdf->Ln(8);//Deja un salto de línea
          
            //Hacer recorrido para obtener el resumen por cada tipo de moneda
			foreach ($otdMonedas as $arrMon) 
			{
				//Limpiar las siguientes variables (por cada moneda recorrida)
				$intAcumSubtotalEstatus = 0;
				$intAcumIvaEstatus = 0;
				$intAcumIepsEstatus = 0;
				$intAcumTotalEstatus = 0;
				$intAcumCostoEstatus = 0;
				$intAcumUtilidadEstatus = 0;

				//Asigna el tipo y tamaño de letra para la cabecera de la tabla
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Creación de la tabla Resumen
				$pdf->ClippedCell(175, 4, 'RESUMEN POR MONEDA '.mb_strtoupper($arrMon->descripcion), 0, 0, 'C', TRUE);
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
						$pdf->Row(array($arrEst,'$'.number_format($arrSubtotalMoneda[$arrMon->moneda_id][$arrEst],2), 
										'$'.number_format($arrIvaMoneda[$arrMon->moneda_id][$arrEst],2), 
				    				    '$'.number_format($arrIepsMoneda[$arrMon->moneda_id][$arrEst],2), 
				    				    '$'.number_format($arrTotalMoneda[$arrMon->moneda_id][$arrEst],2),
				    				    '$'.number_format($arrCostoMoneda[$arrMon->moneda_id][$arrEst],2),
				    					'$'.number_format($arrUtilidadMoneda[$arrMon->moneda_id][$arrEst],2)), 
										 $arrAlineacionResumen);


						//Incrementar acumulados si el estatus es ACTIVO o TIMBRAR
						if($arrEst == 'ACTIVO' ||  $arrEst == 'TIMBRAR')
						{
							//Incrementar acumulados
							$intAcumSubtotalEstatus += $arrSubtotalMoneda[$arrMon->moneda_id][$arrEst];
							$intAcumIvaEstatus += $arrIvaMoneda[$arrMon->moneda_id][$arrEst];
							$intAcumIepsEstatus += $arrIepsMoneda[$arrMon->moneda_id][$arrEst];
							$intAcumTotalEstatus += $arrTotalMoneda[$arrMon->moneda_id][$arrEst];
							$intAcumCostoEstatus += $arrCostoMoneda[$arrMon->moneda_id][$arrEst];
							$intAcumUtilidadEstatus += $arrUtilidadMoneda[$arrMon->moneda_id][$arrEst];
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
	            //Acumulado del costo
	            $pdf->Cell(25,3,'$'.number_format($intAcumCostoEstatus,2), 0, 0, 'R');
	            //Acumulado de la utilidad
	            $pdf->Cell(25,3,'$'.number_format($intAcumUtilidadEstatus,2), 0, 0, 'R');
	            $pdf->Ln(8);//Deja un salto de línea
			}

		}
		//Ejecutar la salida del reporte
		$pdf->Output('facturas_servicio.pdf','I'); 
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
			     ->setCellValue('A7', 'LISTADO DE FACTURAS DE SERVICIO '.$strTituloRangoFechas);
		//Si existe id del cliente
		if($intProspectoID > 0)
		{   
			//Seleccionar los datos del cliente que coincide con el id
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
        		 ->setCellValue('E'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('F'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('G'.$intPosEncabezados, 'IEPS')
        		 ->setCellValue('H'.$intPosEncabezados, 'TOTAL')
        		 ->setCellValue('I'.$intPosEncabezados, 'COSTO')
        		 ->setCellValue('J'.$intPosEncabezados, 'UTILIDAD')
        		 ->setCellValue('K'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('L'.$intPosEncabezados, 'T.C.')
        		 ->setCellValue('M'.$intPosEncabezados, 'NO. DE ORDEN')
        		 ->setCellValue('N'.$intPosEncabezados, 'TIPO DE VENTA')
        		 ->setCellValue('O'.$intPosEncabezados, 'ESTRATEGIA')
        		 ->setCellValue('P'.$intPosEncabezados, 'FORMA DE PAGO')
        		 ->setCellValue('Q'.$intPosEncabezados, 'MÉTODO DE PAGO')
        		 ->setCellValue('R'.$intPosEncabezados, 'USO DEL CFDI')
        		 ->setCellValue('S'.$intPosEncabezados, 'TIPO DE RELACIÓN')
        		 ->setCellValue('T'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('U'.$intPosEncabezados, 'NOTAS')
                 ->setCellValue('V'.$intPosEncabezados, 'ESTATUS');

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
    			 ->getStyle('A10:V10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:V10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:V10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('W'.$intPosEncabezados, 'FOLIO DEL MOVIMIENTO')
                     ->setCellValue('X'.$intPosEncabezados, 'DESCRIPCIÓN')
			         ->setCellValue('Y'.$intPosEncabezados, 'REQUISICIÓN')
			         ->setCellValue('Z'.$intPosEncabezados, 'FECHA')
			         ->setCellValue('AA'.$intPosEncabezados, 'SUBTOTAL')
			         ->setCellValue('AB'.$intPosEncabezados, 'COSTO')
			         ->setCellValue('AC'.$intPosEncabezados, 'UTILIDAD')
			         ->setCellValue('AD'.$intPosEncabezados, 'ESTATUS');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('W'.$intPosEncabezados.':AD'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('W'.$intPosEncabezados.':AD'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('W'.$intPosEncabezados.':AD'.$intPosEncabezados)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentCenter);
        }


        ///Asignar objeto con las facturas  que coinciden con el parámetro enviado
		$otdFacturas = $this->get_facturas($dteFechaInicial, $dteFechaFinal, $intProspectoID, 
								 		   $strEstatus, $strBusqueda);
		//Asignar array con los datos de las facturs
		$arrFacturas = $otdFacturas['facturas'];


		//Si hay información
		if ($arrFacturas)
		{	
			//Recorremos el arreglo 
			foreach ($arrFacturas as $arrCol)
			{   
				//Variable que se utiliza para asignar el tipo de cambio de la factura
			    $intAcumSubtotal = $arrCol['subtotal'];
			    $intAcumIva = $arrCol['iva'];
			    $intAcumIeps = $arrCol['ieps'];
			    $intTotal = $arrCol['importe'];
			    $intAcumCosto = $arrCol['acumulado_costo'];
			    $intAcumUtilidad = $arrCol['utilidad'];

		    	//Array que se utiliza para agregar los datos de la factura
			    $arrDatosFra = array();
			    $arrDatosFra[] = $arrCol['folio'];
			    $arrDatosFra[] = $arrCol['razon_social'];
			    $arrDatosFra[] = $arrCol['rfc'];
			    $arrDatosFra[] = $arrCol['fecha'];
			    $arrDatosFra[] = $intAcumSubtotal;
			    $arrDatosFra[] = $intAcumIva;
			    $arrDatosFra[] = $intAcumIeps;
			    $arrDatosFra[] = $intTotal;
			    $arrDatosFra[] = $intAcumCosto;
			    $arrDatosFra[] = $intAcumUtilidad;
			    $arrDatosFra[] = $arrCol['moneda'];
			    $arrDatosFra[] = $arrCol['tipo_cambio'];
			    $arrDatosFra[] = $arrCol['folio_orden_reparacion'];
			    $arrDatosFra[] = $arrCol['condiciones_pago'];
			    $arrDatosFra[] =  $arrCol['estrategia'];
                $arrDatosFra[] = $arrCol['forma_pago'];
                $arrDatosFra[] = $arrCol['metodo_pago'];
                $arrDatosFra[] = $arrCol['uso_cfdi'];
                $arrDatosFra[] = $arrCol['tipo_relacion'];
                $arrDatosFra[] = $arrCol['observaciones'];
                $arrDatosFra[] = $arrCol['notas'];
                $arrDatosFra[] = $arrCol['estatus'];

                //Hacer un llamado a la función para escribir los datos de la factura
				$this->get_datos_registro_excel($objExcel, $arrDatosFra, 
												$this->archivoExcel['intIndColInicial'], 
											    $intFila);

				//Asignar el número de columna donde se empezaran a escribir los datos de un detalle 
				$intIndColDetalle = count($arrDatosFra) + 1;

		    	//Si se cumple la sentencia mostrar detalles del registro
				if($arrCol['detalles'][0] && $strDetalles == 'SI')
				{

					/*
					*****************************************************************************************************************
					* DETALLES DE LA FACTURA
					*****************************************************************************************************************
					*/
					//Recorremos el arreglo 
			        foreach ($arrCol['detalles'][0] as $arrDet) 
			        {
			        	//Hacer un llamado a la función para escribir los datos de la factura
						$this->get_datos_registro_excel($objExcel, $arrDatosFra, 
													  $this->archivoExcel['intIndColInicial'], 
													  $intFila);

			        	//Array que se utiliza para agregar los datos del detalle
						$arrDatos = array();
						$arrDatos[] = $arrDet['folio_orden'];
						$arrDatos[] = $arrDet['descripcion'];
						$arrDatos[] = '';//folio de la requisición
						$arrDatos[] = '';//fecha
						$arrDatos[] = $arrDet['subtotal'];
				    	$arrDatos[] = $arrDet['acumulado_costo'];
						$arrDatos[] = $arrDet['utilidad'];

						//Hacer un llamado a la función para escribir los datos del detalle
					    $this->get_datos_registro_excel($objExcel, $arrDatos, 
													  $intIndColDetalle, 
													  $intFila);



				    	//Incrementar el indice para escribir los datos del siguiente registro
						$intFila++;

			        }//Cierre de foreach detalles de la factura



					/*
					*****************************************************************************************************************
					* MOVIMIENTOS DE REFACCIONES
					*****************************************************************************************************************
					*/
					//Verificar si existe información de los movimientos de refacciones
					if($arrCol['movimientos_refacciones'][0])
					{

						//Recorremos el arreglo 
				        foreach ($arrCol['movimientos_refacciones'][0] as $arrMov) 
				        {
				        	//Hacer un llamado a la función para escribir los datos de la factura
							$this->get_datos_registro_excel($objExcel, $arrDatosFra, 
													      $this->archivoExcel['intIndColInicial'], 
													      $intFila);
				        	//Array que se utiliza para agregar los datos del movimiento
							$arrDatos = array();
							$arrDatos[] = $arrMov['folio_movimiento'];
							$arrDatos[] = $arrMov['descripcion'];
							$arrDatos[] = $arrMov['folio_requisicion'];
							$arrDatos[] = $arrMov['fecha'];
							$arrDatos[] = $arrMov['subtotal'];	
					    	$arrDatos[] = $arrMov['acumulado_costo'];
					    	$arrDatos[] = '';//utilidad
							$arrDatos[] = $arrMov['estatus'];

							//Hacer un llamado a la función para escribir los datos del movimiento
					   		$this->get_datos_registro_excel($objExcel, $arrDatos, 
													  	  $intIndColDetalle, 
													      $intFila);

					    	//Incrementar el indice para escribir los datos del siguiente registro
						    $intFila++;

				        }//Cierre de foreach movimientos de refacciones 


				    }//Cierre de verificación de movimientos de refacciones


				}//Cierre de verificación de detalles

			    //Incrementar el indice para escribir los datos del siguiente registro
				$intFila++;

                //Incrementar el contador por cada registro
				$intContador++;

			}//Cierre de foreach de facturas

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('E'.$intFilaInicial.':'.'J'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

           	$objExcel->getActiveSheet()
            		 ->getStyle('AA'.$intFilaInicial.':'.'AC'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('L'.$intFilaInicial.':'.'L'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.0000');


			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('E'.$intFilaInicial.':'.'J'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		     $objExcel->getActiveSheet()
		        	 ->getStyle('L'.$intFilaInicial.':'.'L'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);
                	 		 
			$objExcel->getActiveSheet()
                	 ->getStyle('V'.$intFilaInicial.':'.'V'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
		        	 ->getStyle('Z'.$intFilaInicial.':'.'Z'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
		        	 ->getStyle('AA'.$intFilaInicial.':'.'AC'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		    $objExcel->getActiveSheet()
                	 ->getStyle('AD'.$intFilaInicial.':'.'AD'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('V'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('V'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'facturas_servicio.xls', 'facturas de servicio', $intFila);
	}

	
	//Función que se utiliza para regresar facturas que coincidan con el parámetro enviado
	public function get_facturas($dteFechaInicial, $dteFechaFinal, $intProspectoID, 
								 $strEstatus, $strBusqueda)
	{

		//Array que se utiliza para enviar datos
		$arrDatos = array('facturas' => NULL, 
						  'acumulado_subtotal' => '0.00',
						  'acumulado_iva' => '0.00',
						  'acumulado_ieps' => '0.00', 
						  'acumulado_total' => '0.00', 
						  'acumulado_costo' => '0.00',
						  'acumulado_utilidad' => '0.00');


		//Array que se utiliza para agregar los datos de las facturas
        $arrFacturas = array();
        //Array que se utiliza para agregar los datos de un registro
        $arrAuxiliar = array();
        //Variable que se utiliza para asignar el acumulado general del subtotal
        $intAcumGralSubtotal = 0;
        //Variable que se utiliza para asignar el acumulado general del IVA
        $intAcumGralIva = 0;
        //Variable que se utiliza para asignar el acumulado general del IEPS
        $intAcumGralIeps = 0;
        //Variable que se utiliza para asignar el acumulado general del total
        $intAcumGralTotal = 0;
        //Variable que se utiliza para asignar el acumulado general del costo
        $intAcumGralCosto = 0;
        //Variable que se utiliza para asignar el acumulado  generalde la utilidad
        $intAcumGralUtilidad = 0;
       

		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdFacturas = $this->facturas->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, 
												$strEstatus, $strBusqueda);


		//Si hay información de las facturas
		if($otdFacturas)
		{
			//Recorremos el arreglo 
			foreach ($otdFacturas as $arrFra)
			{	
				//Variable que se utiliza para asignar el tipo de cambio de la factura
			    $intTipoCambioFactura = $arrFra->tipo_cambio;
			    //Asignar el id de la factura 
				$intFacturaServicioID = $arrFra->factura_servicio_id;
				//Asignar el id de la orden de reparación 
				$intOrdenReparacionID = $arrFra->orden_reparacion_id;
				//Variable que se utiliza para asignar el estatus de la factura
			    $strEstatus = $arrFra->estatus;
			    //Array que se utiliza para agregar los detalles de la factura
				$arrDetalles = array();
				//Array que se utiliza para agregar los movimientos de refacciones
		        $arrMovRefacciones = array();

				//Variable que se utiliza para asignar el acumulado del subtotal
		        $intAcumSubtotal = 0;
		        //Variable que se utiliza para asignar el acumulado del IVA
		        $intAcumIva = 0;
		        //Variable que se utiliza para asignar el acumulado del IEPS
		        $intAcumIeps = 0;
		        //Variable que se utiliza para asignar el acumulado del costo
		        $intAcumCosto = 0;
		        //Variable que se utiliza para asignar el acumulado de la utilidad
		        $intAcumUtilidad = 0;

				//Variables que se utilizan para asignar acumulados de los servicios de mano de obra
				$intAcumSubtotalMO = 0;
				$intAcumIvaMO = 0;
				$intAcumIepsMO = 0;
				$intAcumCostoMO = 0;
				$intUtilidadMO = 0;

		        //Variables que se utilizan para asignar acumulados de las refacciones
				$intAcumSubtotalRef = 0;
				$intAcumIvaRef = 0;
			    $intAcumIepsRef = 0;
			    $intAcumCostoRef = 0;
			    $intUtilidadRef = 0;

			    //Variables que se utilizan para asignar acumulados de los trabajos foráneos
				$intAcumSubtotalTF = 0;
				$intAcumIvaTF = 0;
				$intAcumIepsTF = 0;
				$intAcumCostoTF = 0;
				$intUtilidadTF = 0;

				//Variables que se utilizan para asignar acumulados de los otros servicios
				$intAcumSubtotalOtros = 0;
				$intAcumIvaOtros = 0;
				$intAcumIepsOtros = 0;
				$intAcumCostoOtros = 0;
				$intUtilidadOtros = 0;

				//Seleccionar los servicios de mano de obra del registro
				$otdServiciosManoObra = $this->facturas->buscar_servicios_mano_obra($intFacturaServicioID);
				//Seleccionar las refacciones del registro
				$otdRefacciones = $this->facturas->buscar_refacciones($intFacturaServicioID);
				//Seleccionar los trabajos foráneos del registro
				$otdTrabajosForaneos = $this->facturas->buscar_trabajos_foraneos($intFacturaServicioID);
				//Seleccionar los otros servicios del registro
				$otdOtros = $this->facturas->buscar_otros($intFacturaServicioID);
				//Seleccionar el acumulado de costos de la orden de reparación
				$otdAcumuladoCostosOrden = $this->facturas->buscar_acumulados_costo_orden_reparacion($intOrdenReparacionID);
				//Seleccionar los movimientos de salidas y entradas por devolución de la orden de reparación
				$otdMovimientosOrden = $this->facturas->buscar_refacciones_orden_reparacion($intOrdenReparacionID);


				/*
				*****************************************************************************************************************
				* ACUMULADO DE COSTOS UNITARIOS DE LA ORDEN DE REPARACIÓN
				*****************************************************************************************************************
				*/
				//Verificar si existe información de los acumulados del costo
				if($otdAcumuladoCostosOrden)
				{
					//Recorremos el arreglo 
					foreach ($otdAcumuladoCostosOrden as $arrAcum)
					{
						//Convertir peso mexicano a tipo de cambio
						$intAcumCostoMO = ($arrAcum->acumulado_mano_obra / $intTipoCambioFactura);
						$intAcumCostoTF = ($arrAcum->acumulado_trabajos_foraneos / $intTipoCambioFactura);
					}


					//Convertir cantidad a dos decimales
					$intAcumCostoMO =  number_format($intAcumCostoMO, 2, '.', '');
					$intAcumCostoTF = number_format($intAcumCostoTF, 2, '.', '');


					//Incrementar acumulado del costo
					$intAcumCosto = $intAcumCostoMO + $intAcumCostoTF;

				}//Cierre de verificación de acumulados


				/*
				*****************************************************************************************************************
				* MANO DE OBRA
				*****************************************************************************************************************
				*/
				//Verificar si existe información de los servicios de mano de obra
				if($otdServiciosManoObra)
				{
					//Recorremos el arreglo 
					foreach ($otdServiciosManoObra as $arrMO)
					{
						//Variables que se utilizan para asignar valores del detalle
						//Convertir peso mexicano a tipo de cambio
						$intPrecioUnitario = ($arrMO->precio_unitario / $intTipoCambioFactura);
						$intIvaUnitario =  ($arrMO->iva_unitario / $intTipoCambioFactura);
						$intIepsUnitario = ($arrMO->ieps_unitario/ $intTipoCambioFactura);

						//Convertir cantidad a dos decimales
						$intPrecioUnitario =  number_format($intPrecioUnitario, 2, '.', '');
						$intIvaUnitario = number_format($intIvaUnitario, 2, '.', '');
						$intIepsUnitario = number_format($intIepsUnitario, 2, '.', '');


						//Incrementar acumulados
						$intAcumSubtotalMO += $intPrecioUnitario;
						$intAcumIvaMO +=  $intIvaUnitario;
						$intAcumIepsMO += $intIepsUnitario;
					}

					//Calcular utilidad de los servicios de mano de obra
					$intUtilidadMO = $intAcumSubtotalMO - $intAcumCostoMO;

					//Incrementar subtotales generales
					$intAcumSubtotal += $intAcumSubtotalMO;
				    $intAcumIva += $intAcumIvaMO;
				    $intAcumIeps += $intAcumIepsMO;
					$intAcumUtilidad+= $intUtilidadMO;


					//Definir valores del array auxiliar de información
					$arrAuxiliar["folio_orden"] = $arrFra->folio_orden_reparacion;
					$arrAuxiliar["descripcion"] = 'MANO DE OBRA';
					$arrAuxiliar["subtotal"] = $intAcumSubtotalMO;
					$arrAuxiliar["acumulado_costo"] = $intAcumCostoMO;
					$arrAuxiliar["utilidad"] = $intUtilidadMO;
	                //Asignar datos al array
	                array_push($arrDetalles, $arrAuxiliar); 

				}//Cierre de verificación de servicios


				/*
				*****************************************************************************************************************
				* REFACCIONES
				*****************************************************************************************************************
				*/
				//Verificar si existe información de las refacciones
				if($otdRefacciones)
				{

					/*
					*****************************************************************************************************************
					* MOVIMIENTOS DE REFACCIONES DE LA ORDEN DE REPARACIÓN
					*****************************************************************************************************************
					*/
					//Verificar si existe información de los movimientos (salidas y entradas por devolución) de refacciones
					if($otdMovimientosOrden)
					{
						//Recorremos el arreglo 
						foreach ($otdMovimientosOrden as $arrMov)
						{	
							//Variables que se utilizan para asignar valores del detalle
							//Convertir peso mexicano a tipo de cambio
							$intSubtotal =  ($arrMov->subtotal / $intTipoCambioFactura); 
							$intCosto =  ($arrMov->acumulado_costo / $intTipoCambioFactura);
							$strTipoMovimiento = $arrMov->tipo;

							//Convertir cantidad a dos decimales
							$intSubtotal =  number_format($intSubtotal, 2, '.', '');
							$intCosto = number_format($intCosto, 2, '.', '');

							//Si el tipo de movimiento corresponde a una entrada por devolución
							if($strTipoMovimiento == 'entrada')
							{
								//Concatenar '-' para indicar al usuario que el importe se decrementa
								$intSubtotal = '-'.$intSubtotal;
								$intCosto = '-'.$intCosto;
							}

							//Definir valores del array auxiliar de información
							$arrAuxiliar["folio_movimiento"] = $arrMov->folio;
							$arrAuxiliar["descripcion"] =  $arrMov->descripcion;
							$arrAuxiliar["folio_requisicion"] = $arrMov->folio_requisicion;
							$arrAuxiliar["fecha"] = $arrMov->fecha_format;
							$arrAuxiliar["subtotal"] = $intSubtotal;
							$arrAuxiliar["acumulado_costo"] = $intCosto;
							$arrAuxiliar["estatus"] = $arrMov->estatus;
			                //Asignar datos al array
			                array_push($arrMovRefacciones, $arrAuxiliar); 
				            

			                //Incrementar acumulado del costo
							$intAcumCostoRef+=$intCosto;
						}

					}//Cierre de verificación de movimientos de refacciones

					//Recorremos el arreglo 
					foreach ($otdRefacciones as $arrRef)
					{
						//Variables que se utilizan para asignar valores del detalle
						$intCantidad = $arrRef->cantidad;
						//Convertir peso mexicano a tipo de cambio
						$intPrecioUnitario = ($arrRef->precio_unitario / $intTipoCambioFactura);
						$intIvaUnitario = ($arrRef->iva_unitario / $intTipoCambioFactura);
						$intIepsUnitario = ($arrRef->ieps_unitario / $intTipoCambioFactura);
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
						$intSubtotal = $intCantidad * $intPrecioUnitario;

						//Convertir cantidad a dos decimales
						$intSubtotal =  number_format($intSubtotal, 2, '.', '');
						$intImporteIva = number_format($intImporteIva, 2, '.', '');
						$intImporteIeps = number_format($intImporteIeps, 2, '.', '');


						//Incrementar acumulados
						$intAcumSubtotalRef += $intSubtotal;
						$intAcumIvaRef += $intImporteIva;
						$intAcumIepsRef += $intImporteIeps;
					}

					//Calcular utilidad de los movimientos de refacciones
					$intUtilidadRef = $intAcumSubtotalRef - $intAcumCostoRef;


					//Incrementar subtotales generales
					$intAcumSubtotal += $intAcumSubtotalRef;
				    $intAcumIva += $intAcumIvaRef;
				    $intAcumIeps += $intAcumIepsRef;
					$intAcumCosto += $intAcumCostoRef;
					$intAcumUtilidad+= $intUtilidadRef;


					//Definir valores del array auxiliar de información
					$arrAuxiliar["folio_orden"] = '';
					$arrAuxiliar["descripcion"] = 'REFACCIONES';
					$arrAuxiliar["subtotal"] = $intAcumSubtotalRef;
					$arrAuxiliar["acumulado_costo"] = $intAcumCostoRef;
					$arrAuxiliar["utilidad"] = $intUtilidadRef;
	                //Asignar datos al array
	                array_push($arrDetalles, $arrAuxiliar); 


				}//Cierre de verificación de refacciones


				/*
				*****************************************************************************************************************
				* TRABAJOS FORÁNEOS
				*****************************************************************************************************************
				*/
				//Verificar si existe información de los trabajos foráneos 
				if($otdTrabajosForaneos)
				{
					//Recorremos el arreglo 
					foreach ($otdTrabajosForaneos as $arrTF)
					{
						//Variables que se utilizan para asignar valores del detalle
						$intCantidad = $arrTF->cantidad;
						//Convertir peso mexicano a tipo de cambio
						$intPrecioUnitario = ($arrTF->precio_unitario / $intTipoCambioFactura);
						$intIvaUnitario = ($arrTF->iva_unitario / $intTipoCambioFactura);
						$intIepsUnitario = ($arrTF->ieps_unitario / $intTipoCambioFactura);
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
						$intSubtotal = $intCantidad * $intPrecioUnitario;

						//Convertir cantidad a dos decimales
						$intSubtotal =  number_format($intSubtotal, 2, '.', '');
						$intImporteIva = number_format($intImporteIva, 2, '.', '');
						$intImporteIeps = number_format($intImporteIeps, 2, '.', '');

						//Incrementar acumulados
						$intAcumSubtotalTF += $intSubtotal;
						$intAcumIvaTF += $intImporteIva;
						$intAcumIepsTF += $intImporteIeps;
					}

					//Calcular utilidad de los trabajos foráneos
					$intUtilidadTF = $intAcumSubtotalTF - $intAcumCostoTF;

					//Incrementar subtotales generales
					$intAcumSubtotal += $intAcumSubtotalTF;
					$intAcumIva += $intAcumIvaTF;
					$intAcumIeps += $intAcumIepsTF;
					$intAcumUtilidad+= $intUtilidadTF;


					//Definir valores del array auxiliar de información
					$arrAuxiliar["folio_orden"] = '';
					$arrAuxiliar["descripcion"] = 'TRABAJOS FORÁNEOS';
					$arrAuxiliar["subtotal"] = $intAcumSubtotalTF;
					$arrAuxiliar["acumulado_costo"] = $intAcumCostoTF;
					$arrAuxiliar["utilidad"] = $intUtilidadTF;
	                //Asignar datos al array
	                array_push($arrDetalles, $arrAuxiliar); 

				}//Cierre de verificación de trabajos foráneos


				/*
				*****************************************************************************************************************
				* GASTOS DE SERVICIO
				*****************************************************************************************************************
				*/
				//Variables que se utilizan para asignar el gasto de servicio
				$intGastosServicioSubtotal = $arrFra->gastos_servicio;
				$intGastosServicioIva = $arrFra->gastos_servicio_iva;

			    //Convertir peso mexicano a tipo de cambio
				$intGastosServicioSubtotal = ($intGastosServicioSubtotal / $intTipoCambioFactura);
				$intGastosServicioIva = ($intGastosServicioIva / $intTipoCambioFactura);

				//Convertir cantidad a dos decimales
				$intGastosServicioSubtotal =  number_format($intGastosServicioSubtotal, 2, '.', '');
				$intGastosServicioIva = number_format($intGastosServicioIva, 2, '.', '');

				//Si existen gastos de servicio
				if($intGastosServicioSubtotal > 0)
				{
					//Definir valores del array auxiliar de información
					$arrAuxiliar["folio_orden"] = '';
					$arrAuxiliar["descripcion"] = 'GASTOS DE SERVICIO';
					$arrAuxiliar["subtotal"] = $intGastosServicioSubtotal;
					$arrAuxiliar["acumulado_costo"] = '';
					$arrAuxiliar["utilidad"] = $intGastosServicioSubtotal;
	                //Asignar datos al array
	                array_push($arrDetalles, $arrAuxiliar); 

				}//Cierre de verificación de gastos de servicio
				

				//Incrementar subtotales generales
				$intAcumSubtotal += $intGastosServicioSubtotal;
				$intAcumIva += $intGastosServicioIva;
				$intAcumUtilidad+= $intGastosServicioSubtotal;


				/*
				*****************************************************************************************************************
				* OTROS
				*****************************************************************************************************************
				*/
				//Verificar si existe información de los otros servicios
				if($otdOtros)
				{
					//Recorremos el arreglo 
					foreach ($otdOtros as $arrOtro)
					{
						//Variables que se utilizan para asignar valores del detalle
						$intCantidad = $arrOtro->cantidad;
						//Convertir peso mexicano a tipo de cambio
						$intPrecioUnitario = ($arrOtro->precio_unitario / $intTipoCambioFactura);
						$intIvaUnitario = ($arrOtro->iva_unitario / $intTipoCambioFactura);
						$intIepsUnitario = ($arrOtro->ieps_unitario / $intTipoCambioFactura);
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
						$intSubtotal = $intCantidad * $intPrecioUnitario;

						//Convertir cantidad a dos decimales
					    $intSubtotal =  number_format($intSubtotal, 2, '.', '');
					    $intImporteIva =  number_format($intImporteIva, 2, '.', '');
					    $intImporteIeps =  number_format($intImporteIeps, 2, '.', '');


						//Incrementar acumulados
						$intAcumSubtotalOtros += $intSubtotal;
						$intAcumIvaOtros += $intImporteIva;
						$intAcumIepsOtros += $intImporteIeps;
					}

					//Incrementar subtotales generales
					$intAcumSubtotal += $intAcumSubtotalOtros;
					$intAcumIva += $intAcumIvaOtros;
					$intAcumIeps += $intAcumIepsOtros;
					$intAcumUtilidad+= $intAcumSubtotalOtros;

					//Definir valores del array auxiliar de información
					$arrAuxiliar["folio_orden"] = '';
					$arrAuxiliar["descripcion"] = 'OTROS';
					$arrAuxiliar["subtotal"] = $intAcumSubtotalOtros;
					$arrAuxiliar["acumulado_costo"] = '';
					$arrAuxiliar["utilidad"] = $intAcumSubtotalOtros;
	                //Asignar datos al array
	                array_push($arrDetalles, $arrAuxiliar);

				}//Cierre de verificación de otros servicios

				//Calcular importe total
				$intTotal = $intAcumSubtotal +$intAcumIva + $intAcumIeps;


				//Definir valores del array auxiliar de información (para cada factura)
				$arrAuxiliar["folio"] = $arrFra->folio;
				$arrAuxiliar["razon_social"] = $arrFra->razon_social;
				$arrAuxiliar["rfc"] = $arrFra->rfc;
				$arrAuxiliar["fecha"] = $arrFra->fecha_format;
				$arrAuxiliar["subtotal"] = $intAcumSubtotal;
				$arrAuxiliar["iva"] = $intAcumIva;
				$arrAuxiliar["ieps"] = $intAcumIeps;
				$arrAuxiliar["importe"] = $intTotal;
				$arrAuxiliar["acumulado_costo"] = $intAcumCosto;
			    $arrAuxiliar["utilidad"] = $intAcumUtilidad;
			    $arrAuxiliar["estatus"] = $strEstatus;
			    $arrAuxiliar["moneda_id"] = $arrFra->moneda_id;
			    $arrAuxiliar["codigo_moneda"] = $arrFra->MonedaTipo;
			    $arrAuxiliar["moneda"] = $arrFra->moneda;
			    $arrAuxiliar["tipo_cambio"] = $arrFra->tipo_cambio;
			    $arrAuxiliar["folio_orden_reparacion"] = $arrFra->folio_orden_reparacion;
			    $arrAuxiliar["condiciones_pago"] = $arrFra->condiciones_pago;
			    $arrAuxiliar["estrategia"] = $arrFra->estrategia;
			    $arrAuxiliar["forma_pago"] = $arrFra->forma_pago;
			    $arrAuxiliar["metodo_pago"] = $arrFra->metodo_pago;
			    $arrAuxiliar["uso_cfdi"] = $arrFra->uso_cfdi;
			    $arrAuxiliar["tipo_relacion"] = $arrFra->tipo_relacion;
			    $arrAuxiliar["observaciones"] = $arrFra->observaciones;
			    $arrAuxiliar["notas"] = $arrFra->notas;
			    $arrAuxiliar["detalles"] = array($arrDetalles);
			    $arrAuxiliar["movimientos_refacciones"] = array($arrMovRefacciones);
			    //Agregar datos al array
            	array_push($arrFacturas, $arrAuxiliar);

            	//Incrementar acumulados si el estatus es ACTIVO o TIMBRAR
				if($strEstatus == 'ACTIVO' OR  $strEstatus == 'TIMBRAR')
				{
	            	//Incrementar acumulados generales
					$intAcumGralSubtotal += $intAcumSubtotal;
					$intAcumGralIva += $intAcumIva;
					$intAcumGralIeps += $intAcumIeps;
					$intAcumGralTotal += $intTotal;
					$intAcumGralCosto += $intAcumCosto;
					$intAcumGralUtilidad += $intAcumUtilidad;
				}


			}//Cierre de foreach facturas


			//Agregar datos al array
		    $arrDatos['facturas'] = $arrFacturas;
		    $arrDatos['acumulado_subtotalFra'] = $intAcumGralSubtotal;
		    $arrDatos['acumulado_ivaFra'] = $intAcumGralIva;
		    $arrDatos['acumulado_iepsFra'] = $intAcumGralIeps;
		    $arrDatos['acumulado_totalFra'] = $intAcumGralTotal;
		    $arrDatos['acumulado_costoFra'] = $intAcumGralCosto;
		    $arrDatos['acumulado_utilidadFra'] = $intAcumGralUtilidad;

		}//Cierre de verificación de facturas

		

		//Regresar array con los datos
		return $arrDatos;
	}
	
}