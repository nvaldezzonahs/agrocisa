<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facturas_refacciones extends MY_Controller {

	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar ruta de la carpeta principal
	    $this->archivo['strCarpetaPrincipal'] = './archivos/';
		//Asignar ruta de la carpeta destino
	    $this->archivo['strCarpetaDestino'] = './archivos/facturas_refacciones/';
	    //Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de facturas de refacciones
		$this->load->model('refacciones/facturas_refacciones_model', 'facturas');
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
		$this->cargar_vista('refacciones/facturas_refacciones', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->facturas->filtro($this->input->post('dteFechaInicial'),
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
		$objFacturaRefacciones = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista
		//Datos de la factura
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objFacturaRefacciones->intFacturaRefaccionesID = $this->input->post('intFacturaRefaccionesID');
		$objFacturaRefacciones->dteFecha = $this->input->post('dteFecha');
		$objFacturaRefacciones->strCondicionesPago = $this->input->post('strCondicionesPago');
		$objFacturaRefacciones->dteVencimiento = $this->input->post('dteVencimiento');
		$objFacturaRefacciones->intMonedaID = $this->input->post('intMonedaID');
		$objFacturaRefacciones->intTipoCambio = $this->input->post('intTipoCambio');
		//Si no existe id de la referencia asignar valor nulo
		$objFacturaRefacciones->strTipoReferencia = (($this->input->post('strTipoReferencia') !== '') ? 
							          			   	  $this->input->post('strTipoReferencia') : NULL);

		$objFacturaRefacciones->intReferenciaID = (($this->input->post('intReferenciaID') !== '') ? 
							          			   	  $this->input->post('intReferenciaID') : NULL);

		$objFacturaRefacciones->intVendedorID = $this->input->post('intVendedorID');
		$objFacturaRefacciones->intEstrategiaID = $this->input->post('intEstrategiaID');
		$objFacturaRefacciones->strTipo = $this->input->post('strTipo');
		$objFacturaRefacciones->intProspectoID = $this->input->post('intProspectoID');
		$objFacturaRefacciones->strRazonSocial =  mb_strtoupper(trim($this->input->post('strRazonSocial')));
		$objFacturaRefacciones->strRfc =  mb_strtoupper(trim($this->input->post('strRfc')));
		$objFacturaRefacciones->intRegimenFiscalID = (($this->input->post('intRegimenFiscalID') !== '') ? 
							          			   	   $this->input->post('intRegimenFiscalID') : NULL);
		$objFacturaRefacciones->strCalle =  mb_strtoupper(trim($this->input->post('strCalle')));
		$objFacturaRefacciones->strNumeroExterior = mb_strtoupper($this->input->post('strNumeroExterior'));
		$objFacturaRefacciones->strNumeroInterior = mb_strtoupper($this->input->post('strNumeroInterior'));
		$objFacturaRefacciones->strCodigoPostal = $this->input->post('strCodigoPostal');
		$objFacturaRefacciones->strColonia =  mb_strtoupper(trim($this->input->post('strColonia')));
		$objFacturaRefacciones->strLocalidad =  mb_strtoupper(trim($this->input->post('strLocalidad')));
		$objFacturaRefacciones->strMunicipio = mb_strtoupper(trim($this->input->post('strMunicipio')));
		$objFacturaRefacciones->strEstado =  mb_strtoupper(trim($this->input->post('strEstado')));
		$objFacturaRefacciones->strPais = mb_strtoupper(trim($this->input->post('strPais')));
		$objFacturaRefacciones->intGastosPaqueteria = $this->input->post('intGastosPaqueteria');
		$objFacturaRefacciones->intGastosPaqueteriaIva = $this->input->post('intGastosPaqueteriaIva');
		$objFacturaRefacciones->intFormaPagoID = $this->input->post('intFormaPagoID');
		$objFacturaRefacciones->intMetodoPagoID = $this->input->post('intMetodoPagoID');
		$objFacturaRefacciones->intUsoCfdiID = $this->input->post('intUsoCfdiID');
		//Si no existe id del tipo de relación asignar valor nulo
		$objFacturaRefacciones->intTipoRelacionID = (($this->input->post('intTipoRelacionID') !== '') ? 
						   	   						  $this->input->post('intTipoRelacionID') : NULL);
		//Si no existe id de la exportación asignar valor nulo
		$objFacturaRefacciones->intExportacionID = (($this->input->post('intExportacionID') !== '') ? 
						   	   						 $this->input->post('intExportacionID') : NULL);

		$objFacturaRefacciones->strObservaciones = mb_strtoupper($this->input->post('strObservaciones'));
		$objFacturaRefacciones->strNotas = mb_strtoupper($this->input->post('strNotas'));
		$objFacturaRefacciones->intSucursalID = $this->session->userdata('sucursal_id');
		$objFacturaRefacciones->intUsuarioID = $this->session->userdata('usuario_id');

		//Datos de los detalles
		$objFacturaRefacciones->strRefaccionID = $this->input->post('strRefaccionID'); 
		$objFacturaRefacciones->strCodigos = $this->input->post('strCodigos'); 
		$objFacturaRefacciones->strDescripciones = $this->input->post('strDescripciones');
		$objFacturaRefacciones->strCodigosLineas = $this->input->post('strCodigosLineas');  
		$objFacturaRefacciones->strCodigosSat = $this->input->post('strCodigosSat'); 
		$objFacturaRefacciones->strUnidadesSat = $this->input->post('strUnidadesSat'); 
		$objFacturaRefacciones->strObjetoImpuestoSat = $this->input->post('strObjetoImpuestoSat'); 
		$objFacturaRefacciones->strCantidades = $this->input->post('strCantidades'); 
		$objFacturaRefacciones->strPreciosUnitarios = $this->input->post('strPreciosUnitarios');
		$objFacturaRefacciones->strDescuentosUnitarios = $this->input->post('strDescuentosUnitarios'); 
		$objFacturaRefacciones->strTasaCuotaIva = $this->input->post('strTasaCuotaIva'); 
		$objFacturaRefacciones->strIvasUnitarios = $this->input->post('strIvasUnitarios');
		$objFacturaRefacciones->strTasaCuotaIeps = $this->input->post('strTasaCuotaIeps');  
		$objFacturaRefacciones->strIepsUnitarios = $this->input->post('strIepsUnitarios');
		$objFacturaRefacciones->strCostosUnitarios = $this->input->post('strCostosUnitarios'); 

		//Datos de los CFDI relacionados
		$objFacturaRefacciones->strCfdiRelacionado = $this->input->post('strCfdiRelacionado'); 
		$objFacturaRefacciones->strTiposRelacion = $this->input->post('strTiposRelacion');  


		//Datos de la clave de autorización (clave generada cuando se excede el límite de crédito/saldo vencido)
		$objFacturaRefacciones->intClaveAutorizacionID = $this->input->post('intClaveAutorizacionID'); 

		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objFacturaRefacciones->intFacturaRefaccionesID))
		{
			$bolResultado = $this->facturas->modificar($objFacturaRefacciones);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objFacturaRefacciones->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objFacturaRefacciones->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->facturas->guardar($objFacturaRefacciones);

				/*Quitar '_'  de la cadena (resultadoTransaccion_facturaRefaccionesID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $objFacturaRefacciones->intFacturaRefaccionesID) = explode("_", $bolResultado); 
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
							 	  'factura_refacciones_id' => $objFacturaRefacciones->intFacturaRefaccionesID,
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
		$intID = $this->input->post('intFacturaRefaccionesID');
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
			$arrDatos['abonos'] =  $this->get_abonos_factura($intID, 'REFACCIONES', $otdResultado->estatus);

			//Seleccionar los detalles del registro
			$otdDetalles = $this->facturas->buscar_detalles($intID);
			//Si existen detalles del registro, se asignan al array
			if($otdDetalles)
			{
				$arrDatos['detalles'] = $otdDetalles;
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
		$intReferenciaID = $this->input->post('intReferenciaID');
		$strFormulario = $this->input->post('strFormulario');


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
		        						'data' => $arrCol->factura_refacciones_id, 
		        						'uuid' => $arrCol->uuid);
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
		$otdResultado = $this->facturas->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, 
											    $strEstatus, $strBusqueda);
		//Seleccionar los datos de las monedas que coinciden con el parámetro enviado
		$otdMonedas = $this->facturas->buscar_distintas_monedas($dteFechaInicial, $dteFechaFinal, $intProspectoID, 
																$strEstatus, $strBusqueda);
		
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
		$pdf->strLinea1 =  'LISTADO DE FACTURAS DE REFACCIONES '.$strTituloRangoFechas;
		//Si existe id del cliente
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del cliente que coincide con el id
			$otdProspecto =  $this->clientes->buscar($intProspectoID);
			$pdf->strLinea2 =  utf8_decode('RAZÓN SOCIAL: '.$otdProspecto->razon_social);
		}

		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', utf8_decode('RAZÓN SOCIAL'), 'FECHA', 'SUBTOTAL', 'IVA', 'IEPS', 
						     	  'TOTAL', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(20, 61, 15, 20, 18, 18, 18, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'R', 'R', 'R', 'R', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('R', 'L', 'L', 'L', 'L', 'L', 'R', 'R', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(16, 15, 10, 20, 35, 20, 22, 22, 22);
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

			//Recorremos el arreglo para obtener la información de las facturas de compra
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
				$otdDetalles = $this->facturas->buscar_detalles($arrCol->factura_refacciones_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Variables que se utilizan para asignar valores del detalle
						$intCantidad = $arrDet->cantidad;
						//Convertir peso mexicano a tipo de cambio
						$intCostoUnitario = ($arrDet->costo_unitario / $arrCol->tipo_cambio);
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

						//Convertir cantidad a dos decimales
						$intPrecioUnitario = number_format($intPrecioUnitario, 2, '.', '');
						$intSubTotalUnitario = number_format($intSubTotalUnitario, 2, '.', '');
						$intImporteIva = number_format($intImporteIva, 2, '.', '');
						$intImporteIeps = number_format($intImporteIeps, 2, '.', '');

						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["cantidad"] = number_format($intCantidad, 2);
						$arrAuxiliar["codigo_sat"] = utf8_decode($arrDet->codigo_sat);
						$arrAuxiliar["unidad_sat"] = utf8_decode($arrDet->unidad_sat);
						$arrAuxiliar["codigo"] = utf8_decode($arrDet->codigo);
						$arrAuxiliar["descripcion"] = utf8_decode($arrDet->descripcion);
						$arrAuxiliar["localizacion"] = utf8_decode($arrDet->localizacion);
		                $arrAuxiliar["precio_unitario"] = '$'.number_format($intPrecioUnitario, 2);
		                $arrAuxiliar["costo_unitario"] = '$'.number_format($intCostoUnitario, 2);
		                $arrAuxiliar["subtotal"] = '$'.number_format($intSubTotalUnitario, 2);
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

					//Convertir cantidad a dos decimales
					$intGatosPaqueteriaSubtotal = number_format($intGatosPaqueteriaSubtotal, 2, '.', '');
					$intGatosPaqueteriaIva = number_format($intGatosPaqueteriaIva, 2, '.', '');

					//Definir valores del array auxiliar de información (para cada detalle)
					$arrAuxiliar["cantidad"] = number_format(1, 2);
					$arrAuxiliar["codigo_sat"] = '';
					$arrAuxiliar["unidad_sat"] ='';
					$arrAuxiliar["codigo"] = '';
					$arrAuxiliar["descripcion"] = utf8_decode('GASTOS DE PAQUETERÍA');
					$arrAuxiliar["localizacion"] = "";
	                $arrAuxiliar["precio_unitario"] = '$'.number_format($intGatosPaqueteriaSubtotal, 2);
	                $arrAuxiliar["costo_unitario"] = "";
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
				$pdf->Row(array($arrCol->folio, utf8_decode($arrCol->razon_social), $arrCol->fecha_format,  
								'$'.number_format($intAcumSubtotal, 2),
								'$'.$intAcumIva, '$'.number_format($intAcumIeps, 2),
								'$'.number_format($intTotal, 2), $arrCol->estatus), 
								 $pdf->arrAlineacion, 'ClippedCell');
		        
		        //Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
				//Moneda
				$pdf->Cell(12, 4, 'MONEDA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(7, 4, utf8_decode($arrCol->MonedaTipo), 0, 0, 'L', 0);
		    	//Tipo de cambio
		    	$pdf->Cell(6, 4, 'T.C.:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(12, 4,'$'.number_format($arrCol->tipo_cambio, 4, '.', ','), 0, 0, 'R', 0);
			    //Si existe id del tipo de referencia (COTIZACION/REMISION/PEDIDO)
			    if($arrCol->referencia_id > 0)
			    {
			    	//Tipo de referencia
					$pdf->Cell(15, 4, 'REFERENCIA:', 0, 0, 'L', 0);
				    $pdf->ClippedCell(50, 4, utf8_decode($arrCol->folio_referencia), 0, 0, 'L', 0);
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
					    $pdf->Row(array($arrDet['cantidad'], $arrDet['codigo_sat'], $arrDet['unidad_sat'],
					    	            $arrDet['codigo'], $arrDet['descripcion'], $arrDet['localizacion'], 
					    	            $arrDet['precio_unitario'], $arrDet['costo_unitario'],  $arrDet['subtotal']), 
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
					$pdf->Row(array($arrEst,'$'.number_format($arrSubtotalEstatus[$arrEst], 2), 
									'$'.number_format($arrIvaEstatus[$arrEst], 2), 
			    				    '$'.number_format($arrIepsEstatus[$arrEst], 2), 
			    				    '$'.number_format($arrTotalEstatus[$arrEst], 2)), 
									$arrAlineacionResumen);

					//Incrementar acumulados si el estatus es ACTIVO o TIMBRAR
					if($arrEst == 'ACTIVO' OR $arrEst == 'TIMBRAR')
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
						$pdf->Row(array($arrEst,'$'.number_format($arrSubtotalMoneda[$arrMon->moneda_id][$arrEst], 2), 
										'$'.number_format($arrIvaMoneda[$arrMon->moneda_id][$arrEst], 2), 
				    				    '$'.number_format($arrIepsMoneda[$arrMon->moneda_id][$arrEst], 2), 
				    				    '$'.number_format($arrTotalMoneda[$arrMon->moneda_id][$arrEst], 2)), 
										$arrAlineacionResumen);


						//Incrementar acumulados si el estatus es ACTIVO o TIMBRAR
						if($arrEst == 'ACTIVO' OR $arrEst == 'TIMBRAR')
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
	            $pdf->Cell(25,3,'$'.number_format($intAcumSubtotalEstatus, 2), 0, 0, 'R');
	            //Acumulado del IVA
	            $pdf->Cell(25,3,'$'.number_format($intAcumIvaEstatus, 2), 0, 0, 'R');
	           //Acumulado del IEPS
	            $pdf->Cell(25,3,'$'.number_format($intAcumIepsEstatus, 2), 0, 0, 'R');
	            //Acumulado del importe total
	            $pdf->Cell(25,3,'$'.number_format($intAcumTotalEstatus, 2), 0, 0, 'R');
	            $pdf->Ln(8);//Deja un salto de línea
			}
		}
		//Ejecutar la salida del reporte
		$pdf->Output('facturas_refacciones.pdf','I'); 
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
		$otdResultado = $this->facturas->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, 
												$strEstatus, $strBusqueda);
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
			     ->setCellValue('A7', 'LISTADO DE FACTURAS DE REFACCIONES '.$strTituloRangoFechas);
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
        		 ->setCellValue('I'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('J'.$intPosEncabezados, 'T.C.')
        		 ->setCellValue('K'.$intPosEncabezados, 'VENDEDOR')
        		 ->setCellValue('L'.$intPosEncabezados, 'ESTRATEGIA')
        		 ->setCellValue('M'.$intPosEncabezados, 'TIPO')
        		 ->setCellValue('N'.$intPosEncabezados, 'TIPO DE REFERENCIA')
        		 ->setCellValue('O'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('P'.$intPosEncabezados, 'TIPO DE VENTA')
        		 ->setCellValue('Q'.$intPosEncabezados, 'FORMA DE PAGO')
        		 ->setCellValue('R'.$intPosEncabezados, 'MÉTODO DE PAGO')
        		 ->setCellValue('S'.$intPosEncabezados, 'USO DEL CFDI')
        		 ->setCellValue('T'.$intPosEncabezados, 'TIPO DE RELACIÓN')
        		 ->setCellValue('U'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('V'.$intPosEncabezados, 'NOTAS')
                 ->setCellValue('W'.$intPosEncabezados, 'ESTATUS');

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
    			 ->getStyle('A10:W10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:W10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:W10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('X'.$intPosEncabezados, 'CANTIDAD')
			         ->setCellValue('Y'.$intPosEncabezados, 'CÓDIGO SAT')
			         ->setCellValue('Z'.$intPosEncabezados, 'UNIDAD SAT')
			         ->setCellValue('AA'.$intPosEncabezados, 'OBJETO DE IMPUESTO SAT')
			         ->setCellValue('AB'.$intPosEncabezados, 'CÓDIGO')
			         ->setCellValue('AC'.$intPosEncabezados, 'DESCRIPCIÓN')
			         ->setCellValue('AD'.$intPosEncabezados, 'LÍNEA')
			         ->setCellValue('AE'.$intPosEncabezados, 'MARCA')
			         ->setCellValue('AF'.$intPosEncabezados, 'LOCALIZACIÓN')
			         ->setCellValue('AG'.$intPosEncabezados,'PRECIO UNITARIO')
			         ->setCellValue('AH'.$intPosEncabezados, 'COSTO UNITARIO')
			         ->setCellValue('AI'.$intPosEncabezados, 'SUBTOTAL');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('X'.$intPosEncabezados.':AI'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('X'.$intPosEncabezados.':AI'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('X'.$intPosEncabezados.':AI'.$intPosEncabezados)
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
				$otdDetalles = $this->facturas->buscar_detalles($arrCol->factura_refacciones_id);
				
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Variable que se utiliza para contar el número de detalles
				    $intContDetFact = 0;

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
						$intCostoUnitario = ($arrDet->costo_unitario / $arrCol->tipo_cambio);
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

						//Convertir cantidad a dos decimales
						$intPrecioUnitario = number_format($intPrecioUnitario, 2, '.', '');
						$intSubTotalUnitario = number_format($intSubTotalUnitario, 2, '.', '');
						$intImporteIva = number_format($intImporteIva, 2, '.', '');
						$intImporteIeps = number_format($intImporteIeps, 2, '.', '');

                        //Agregar datos al array
			        	$arrDetalles[$intContDetFact]['cantidad'] = $intCantidad;
			        	$arrDetalles[$intContDetFact]['codigo_sat'] = $arrDet->codigo_sat;
			        	$arrDetalles[$intContDetFact]['unidad_sat'] = $arrDet->unidad_sat;
			        	$arrDetalles[$intContDetFact]['objeto_impuesto_sat'] = $arrDet->objeto_impuesto_sat;
			        	$arrDetalles[$intContDetFact]['codigo'] = $arrDet->codigo;
			        	$arrDetalles[$intContDetFact]['descripcion'] = $arrDet->descripcion;
			        	$arrDetalles[$intContDetFact]['linea'] = $arrDet->refacciones_linea;
			        	$arrDetalles[$intContDetFact]['marca'] = $arrDet->refacciones_marca;
			        	$arrDetalles[$intContDetFact]["localizacion"] = $arrDet->localizacion;
			        	$arrDetalles[$intContDetFact]["costo_unitario"] = $intCostoUnitario;
			        	$arrDetalles[$intContDetFact]['precio_unitario'] = $intPrecioUnitario;
			        	$arrDetalles[$intContDetFact]['subtotal'] = $intSubTotalUnitario;

                        //Incrementar acumulados
						$intAcumSubtotal += $intSubTotalUnitario;
						$intAcumIva += $intImporteIva;
						$intAcumIeps += $intImporteIeps;

						//Incrementar el contador por cada registro
	                    $intContDetFact++;
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

					//Convertir cantidad a dos decimales
					$intGatosPaqueteriaSubtotal = number_format($intGatosPaqueteriaSubtotal, 2, '.', '');
					$intGatosPaqueteriaIva = number_format($intGatosPaqueteriaIva, 2, '.', '');

					//Si se cumple la sentencia mostrar detalles del registro
					if($strDetalles == 'SI')
					{
						//Agregar datos al array
						$arrDetalles[$intContDetFact]['cantidad'] = 1;
						$arrDetalles[$intContDetFact]['codigo_sat'] = '';
			        	$arrDetalles[$intContDetFact]['unidad_sat'] = '';
			        	$arrDetalles[$intContDetFact]['objeto_impuesto_sat'] = '';
		        		$arrDetalles[$intContDetFact]['codigo'] = '';
		        		$arrDetalles[$intContDetFact]['descripcion'] = 'GASTOS DE PAQUETERÍA';
		        		$arrDetalles[$intContDetFact]['linea'] = '';
				        $arrDetalles[$intContDetFact]['marca'] = '';
				        $arrDetalles[$intContDetFact]["localizacion"] = '';
		        		$arrDetalles[$intContDetFact]['precio_unitario']= $intGatosPaqueteriaSubtotal;
		        		$arrDetalles[$intContDetFact]["costo_unitario"] = '';
		        		$arrDetalles[$intContDetFact]['subtotal'] = $intGatosPaqueteriaSubtotal;
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
			    	//Variable que se utiliza para asignar el folio de la referencia
			    	$strTipoReferencia = $arrCol->tipo_referencia;
			    	$strFolioReferencia = '';
			    	//Dependiendo del tipo de referencia asignar el folio
			    	if($strTipoReferencia == 'COTIZACION')
			    	{
			    		//Cambiar el folio de la referencia
			    		$strFolioReferencia = $arrCol->folio_cotizacion;
			    	}
			    	else if($strTipoReferencia == 'PEDIDO')
			    	{
			    		//Cambiar el folio de la referencia
			    		$strFolioReferencia = $arrCol->folio_pedido;
			    	}
			    	else //Remisión
			    	{
			    		//Cambiar el folio de la referencia
			    		$strFolioReferencia = $arrCol->folio_remision;
			    	}

			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('B'.$intFila, $arrCol->razon_social)
	                         ->setCellValue('C'.$intFila, $arrCol->rfc)
	                         ->setCellValue('D'.$intFila, $arrCol->fecha_format)
	                         ->setCellValue('E'.$intFila, $intAcumSubtotal)
	                         ->setCellValue('F'.$intFila, $intAcumIva)
	                         ->setCellValue('G'.$intFila, $intAcumIeps)
	                         ->setCellValue('H'.$intFila, $intTotal)
	                         ->setCellValue('I'.$intFila, $arrCol->moneda)
	                         ->setCellValue('J'.$intFila, $arrCol->tipo_cambio)
	                         ->setCellValue('K'.$intFila, $arrCol->vendedor)
	                         ->setCellValue('L'.$intFila, $arrCol->estrategia)
	                         ->setCellValue('M'.$intFila, $arrCol->tipo)
	                         ->setCellValue('N'.$intFila, $strTipoReferencia)
	                         ->setCellValueExplicit('O'.$intFila, $strFolioReferencia, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('P'.$intFila, $arrCol->condiciones_pago)
	                         ->setCellValue('Q'.$intFila, $arrCol->forma_pago)
	                         ->setCellValue('R'.$intFila, $arrCol->metodo_pago)
	                         ->setCellValue('S'.$intFila, $arrCol->uso_cfdi)
	                         ->setCellValue('T'.$intFila, $arrCol->tipo_relacion)
	                         ->setCellValue('U'.$intFila, $arrCol->observaciones)
	                         ->setCellValue('V'.$intFila, $arrCol->notas)
	                         ->setCellValue('W'.$intFila, $arrCol->estatus);

	                //Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
						 		 ->setCellValue('X'.$intFila, $arrDetalles[$intContDet]['cantidad'])
						         ->setCellValueExplicit('Y'.$intFila,  $arrDetalles[$intContDet]['codigo_sat'], PHPExcel_Cell_DataType::TYPE_STRING)
						         ->setCellValue('Z'.$intFila, $arrDetalles[$intContDet]['unidad_sat'])
						         ->setCellValue('AA'.$intFila, $arrDetalles[$intContDet]['objeto_impuesto_sat'])
						         ->setCellValueExplicit('AB'.$intFila,  $arrDetalles[$intContDet]['codigo'], PHPExcel_Cell_DataType::TYPE_STRING)
						         ->setCellValue('AC'.$intFila, $arrDetalles[$intContDet]['descripcion'])
						         ->setCellValue('AD'.$intFila, $arrDetalles[$intContDet]['linea'])
						         ->setCellValue('AE'.$intFila, $arrDetalles[$intContDet]['marca'])
						         ->setCellValue('AF'.$intFila, $arrDetalles[$intContDet]['localizacion'])
						         ->setCellValue('AG'.$intFila, $arrDetalles[$intContDet]['precio_unitario'])
						         ->setCellValue('AH'.$intFila, $arrDetalles[$intContDet]['costo_unitario'])
						         ->setCellValue('AI'.$intFila, $arrDetalles[$intContDet]['subtotal']);
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
            		 ->getStyle('AG'.$intFilaInicial.':'.'AI'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.0000');

            //Cambiar contenido de las celdas a formato númerico de 2 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('X'.$intFilaInicial.':'.'X'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('###0.00');

			//Cambiar alineación de las siguientes celdas
    		$objExcel->getActiveSheet()
		        	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
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
                	 ->getStyle('W'.$intFilaInicial.':'.'W'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
		        	 ->getStyle('X'.$intFilaInicial.':'.'X'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
		        	 ->getStyle('AG'.$intFilaInicial.':'.'AI'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('W'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('W'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'facturas_refacciones.xls', 'facturas de refacciones', $intFila);
	}
}