<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facturas_maquinaria extends MY_Controller {
	
	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar ruta de la carpeta principal
	    $this->archivo['strCarpetaPrincipal'] = './archivos/';
		//Asignar ruta de la carpeta destino
	    $this->archivo['strCarpetaDestino'] = './archivos/facturas_maquinaria/';
	    //Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de facturas de maquinaria
		$this->load->model('maquinaria/facturas_maquinaria_model', 'facturas');
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
		$this->cargar_vista('maquinaria/facturas_maquinaria', $arrDatos);
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
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
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
			$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$arrDet->factura_maquinaria_id;

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
		$objFacturaMaquinaria = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objFacturaMaquinaria->intFacturaMaquinariaID = $this->input->post('intFacturaMaquinariaID');
		$objFacturaMaquinaria->dteFecha = $this->input->post('dteFecha');
		$objFacturaMaquinaria->strCondicionesPago = $this->input->post('strCondicionesPago');
		//Si la fecha esta vacia asignar valor nulo
		$objFacturaMaquinaria->dteVencimiento = (($this->input->post('dteVencimiento') !== '') ? 
											      $this->input->post('dteVencimiento') : NULL);
		$objFacturaMaquinaria->intMonedaID = $this->input->post('intMonedaID');
		$objFacturaMaquinaria->intTipoCambio = $this->input->post('intTipoCambio');
		$objFacturaMaquinaria->intPedidoMaquinariaID = $this->input->post('intPedidoMaquinariaID');
		$objFacturaMaquinaria->intVendedorID = $this->input->post('intVendedorID');
		$objFacturaMaquinaria->intProspectoID = $this->input->post('intProspectoID');
		$objFacturaMaquinaria->strRazonSocial =  mb_strtoupper(trim($this->input->post('strRazonSocial')));
		$objFacturaMaquinaria->strRfc =  mb_strtoupper(trim($this->input->post('strRfc')));
		$objFacturaMaquinaria->intRegimenFiscalID = (($this->input->post('intRegimenFiscalID') !== '') ? 
							          			   	   $this->input->post('intRegimenFiscalID') : NULL);
		$objFacturaMaquinaria->strCalle =  mb_strtoupper(trim($this->input->post('strCalle')));
		$objFacturaMaquinaria->strNumeroExterior = mb_strtoupper($this->input->post('strNumeroExterior'));
		$objFacturaMaquinaria->strNumeroInterior = mb_strtoupper($this->input->post('strNumeroInterior'));
		$objFacturaMaquinaria->strCodigoPostal = $this->input->post('strCodigoPostal');
		$objFacturaMaquinaria->strColonia =  mb_strtoupper(trim($this->input->post('strColonia')));
		$objFacturaMaquinaria->strLocalidad =  mb_strtoupper(trim($this->input->post('strLocalidad')));
		$objFacturaMaquinaria->strMunicipio = mb_strtoupper(trim($this->input->post('strMunicipio')));
		$objFacturaMaquinaria->strEstado =  mb_strtoupper(trim($this->input->post('strEstado')));
		$objFacturaMaquinaria->strPais = mb_strtoupper(trim($this->input->post('strPais')));
		$objFacturaMaquinaria->intFormaPagoID = $this->input->post('intFormaPagoID');
		$objFacturaMaquinaria->intMetodoPagoID = $this->input->post('intMetodoPagoID');
		$objFacturaMaquinaria->intUsoCfdiID = $this->input->post('intUsoCfdiID');
		//Si no existe id del tipo de relación asignar valor nulo
		$objFacturaMaquinaria->intTipoRelacionID = (($this->input->post('intTipoRelacionID') !== '') ? 
						   	   						  $this->input->post('intTipoRelacionID') : NULL);

		//Si no existe id de la exportación asignar valor nulo
		$objFacturaMaquinaria->intExportacionID = (($this->input->post('intExportacionID') !== '') ? 
						   	   			   			$this->input->post('intExportacionID') : NULL);

		$objFacturaMaquinaria->intMaquinariaDescripcionID = $this->input->post('intMaquinariaDescripcionID');
		$objFacturaMaquinaria->strSerie =  mb_strtoupper(trim($this->input->post('strSerie')));
		$objFacturaMaquinaria->strMotor =  mb_strtoupper(trim($this->input->post('strMotor')));
		$objFacturaMaquinaria->strConsignacion = $this->input->post('strConsignacion');
		$objFacturaMaquinaria->strCodigo = mb_strtoupper(trim($this->input->post('strCodigo')));
		$objFacturaMaquinaria->strDescripcionCorta = mb_strtoupper(trim($this->input->post('strDescripcionCorta')));
		$objFacturaMaquinaria->strDescripcion = mb_strtoupper(trim($this->input->post('strDescripcion')));
		$objFacturaMaquinaria->strCodigoSat =	trim($this->input->post('strCodigoSat'));
		$objFacturaMaquinaria->strUnidadSat = mb_strtoupper(trim($this->input->post('strUnidadSat')));
		$objFacturaMaquinaria->strObjetoImpuestoSat =	trim($this->input->post('strObjetoImpuestoSat'));
		$objFacturaMaquinaria->intPrecio = $this->input->post('intPrecio');
		$objFacturaMaquinaria->intDescuento = $this->input->post('intDescuento');
		//Si no existe id de la tasa o cuota del impuesto de IVA asignar valor nulo
		$objFacturaMaquinaria->intTasaCuotaIva = (($this->input->post('intTasaCuotaIva') !== '') ? 
						   	   					  $this->input->post('intTasaCuotaIva') : NULL);
		$objFacturaMaquinaria->intIva = $this->input->post('intIva');
		//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
		$objFacturaMaquinaria->intTasaCuotaIeps = (($this->input->post('intTasaCuotaIeps') !== '') ? 
						   	   					    $this->input->post('intTasaCuotaIeps') : NULL);
		$objFacturaMaquinaria->intIeps = $this->input->post('intIeps');
		$objFacturaMaquinaria->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objFacturaMaquinaria->strNotas = mb_strtoupper(trim($this->input->post('strNotas')));
		$objFacturaMaquinaria->intSucursalID = $this->session->userdata('sucursal_id');
		$objFacturaMaquinaria->intUsuarioID = $this->session->userdata('usuario_id');

		//Datos de los componentes(en caso de que aplique)
		$objFacturaMaquinaria->strRenglonID = $this->input->post('strRenglonID');
		$objFacturaMaquinaria->strMaquinariaDescripcionID = $this->input->post('strMaquinariaDescripcionID'); 
		$objFacturaMaquinaria->strSeries = $this->input->post('strSeries');
		$objFacturaMaquinaria->strMotores = $this->input->post('strMotores');
		//Datos de los CFDI relacionados
		$objFacturaMaquinaria->strCfdiRelacionado = $this->input->post('strCfdiRelacionado'); 
		$objFacturaMaquinaria->strTiposRelacion = $this->input->post('strTiposRelacion'); 
		//Datos de la clave de autorización (clave generada cuando se excede el límite de crédito/saldo vencido)
		$objFacturaMaquinaria->intClaveAutorizacionID = $this->input->post('intClaveAutorizacionID'); 
		
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objFacturaMaquinaria->intFacturaMaquinariaID))
		{
			
			$bolResultado = $this->facturas->modificar($objFacturaMaquinaria);
			
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objFacturaMaquinaria->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objFacturaMaquinaria->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->facturas->guardar($objFacturaMaquinaria); 

				/*Quitar '_'  de la cadena (resultadoTransaccion_facturaMaquinariaID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $objFacturaMaquinaria->intFacturaMaquinariaID) = explode("_", $bolResultado); 	
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
							 	  'factura_maquinaria_id' => $objFacturaMaquinaria->intFacturaMaquinariaID,
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
		$intID = $this->input->post('intFacturaMaquinariaID');
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
			$arrDatos['abonos'] =  $this->get_abonos_factura($intID, 'MAQUINARIA', $otdResultado->estatus);
			
			//Seleccionar los detalles del registro
			$otdDetalles = $this->facturas->buscar_detalles($intID);
			//Si existe maquinaria usada del registro, se asignan al array
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
		        						'data' => $arrCol->factura_maquinaria_id,
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
		$pdf->strLinea1 =  'LISTADO DE FACTURAS DE MAQUINARIA '.$strTituloRangoFechas;
		//Si existe id del cliente
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del cliente que coincide con el id
			$otdProspecto =  $this->clientes->buscar($intProspectoID);
			$pdf->strLinea2 =  utf8_decode('RAZÓN SOCIAL: '.$otdProspecto->razon_social);
		}

		///Establece los títulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', utf8_decode('RAZÓN SOCIAL'), 'FECHA', 'SUBTOTAL', 'IVA', 'IEPS', 
								  'TOTAL', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(20, 61, 15, 20, 18, 18, 18, 20);
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

			//Recorremos el arreglo para obtener la información de las facturas de maquinaria
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
				

				//Convertir cantidad a dos decimales
				$intPrecio = number_format($intPrecio, 2, '.', '');
				$intSubTotal = number_format($intSubTotal, 2, '.', '');
				$intImporteIva = number_format($intImporteIva, 2, '.', '');
				$intImporteIeps = number_format($intImporteIeps, 2, '.', '');


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
				$pdf->Row(array($arrCol->folio, utf8_decode($arrCol->razon_social), $arrCol->fecha_format,
								'$'.number_format($intSubTotal,2),
								'$'.number_format($intImporteIva,2), '$'.number_format($intImporteIeps,2),
								'$'.number_format($intTotal,2), $arrCol->estatus), 
								 $pdf->arrAlineacion, 'ClippedCell');
		        
		        //Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
				//Moneda
				$pdf->Cell(12, 4, 'MONEDA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(7, 4, utf8_decode($arrCol->MonedaTipo), 0, 0, 'L', 0);
		    	//Tipo de cambio
		    	$pdf->Cell(6, 4, 'T.C.:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(12, 4,'$'.number_format($arrCol->tipo_cambio, 4, '.', ','), 0, 0, 'R', 0);
			    //Condiciones de pago
				$pdf->Cell(18, 4, 'TIPO DE VENTA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(14, 4, utf8_decode($arrCol->condiciones_pago), 0, 0, 'L', 0);

				//Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
					$pdf->Ln(5);//Deja un salto de línea
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraDetalles);
					
					   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array(number_format($intCantidad,2), utf8_decode($arrCol->codigo), 
					    			    utf8_decode($arrCol->descripcion_corta), '$'.number_format($intPrecio,2),  
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
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
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

					//Incrementar acumulados si el estatus es ACTIVO o TIMBRAR
					if($arrEst == 'ACTIVO' ||  $arrEst == 'TIMBRAR')
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
				    				    '$'.number_format($arrTotalMoneda[$arrMon->moneda_id][$arrEst],2)), 
										$arrAlineacionResumen);


						//Incrementar acumulados si el estatus es ACTIVO o TIMBRAR
						if($arrEst == 'ACTIVO' ||  $arrEst == 'TIMBRAR')
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
		$pdf->Output('facturas_maquinaria.pdf','I'); 
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
		$otdResultado = $this->facturas->buscar(NULL, $dteFechaInicial, $dteFechaFinal, 
													  $intProspectoID, $strEstatus, $strBusqueda);
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
			     ->setCellValue('A7', 'LISTADO DE FACTURAS DE MAQUINARIA '.$strTituloRangoFechas);
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
        		 ->setCellValue('E'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('F'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('G'.$intPosEncabezados, 'IEPS')
        		 ->setCellValue('H'.$intPosEncabezados, 'TOTAL')
        		 ->setCellValue('I'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('J'.$intPosEncabezados, 'T.C.')
        		 ->setCellValue('K'.$intPosEncabezados, 'TIPO DE VENTA')
        		 ->setCellValue('L'.$intPosEncabezados, 'PEDIDO')
        		 ->setCellValue('M'.$intPosEncabezados, 'VENDEDOR')
        		 ->setCellValue('N'.$intPosEncabezados, 'FORMA DE PAGO')
        		 ->setCellValue('O'.$intPosEncabezados, 'MÉTODO DE PAGO')
        		 ->setCellValue('P'.$intPosEncabezados, 'USO DEL CFDI')
        		 ->setCellValue('Q'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('R'.$intPosEncabezados, 'NOTAS')
                 ->setCellValue('S'.$intPosEncabezados, 'ESTATUS');

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
    			 ->getStyle('A10:S10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:S10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:S10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('T'.$intPosEncabezados, 'CANTIDAD')
                     ->setCellValue('U'.$intPosEncabezados, 'SERIE')
                     ->setCellValue('V'.$intPosEncabezados, 'MOTOR')
			         ->setCellValue('W'.$intPosEncabezados, 'CÓDIGO')
			         ->setCellValue('X'.$intPosEncabezados,'DESCRIPCIÓN CORTA')
			         ->setCellValue('Y'.$intPosEncabezados,'DESCRIPCION')
			         ->setCellValue('Z'.$intPosEncabezados,'LÍNEA')
			         ->setCellValue('AA'.$intPosEncabezados,'MARCA')
			         ->setCellValue('AB'.$intPosEncabezados,'MODELO')
			         ->setCellValue('AC'.$intPosEncabezados,'PRECIO UNITARIO')
			         ->setCellValue('AD'.$intPosEncabezados, 'SUBTOTAL');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('T'.$intPosEncabezados.':AD'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('T'.$intPosEncabezados.':AD'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('T'.$intPosEncabezados.':AD'.$intPosEncabezados)
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

				//Convertir cantidad a dos decimales
				$intPrecio = number_format($intPrecio, 2, '.', '');
				$intSubTotal = number_format($intSubTotal, 2, '.', '');
				$intImporteIva = number_format($intImporteIva, 2, '.', '');
				$intImporteIeps = number_format($intImporteIeps, 2, '.', '');

				//Calcular importe total
				$intTotal = $intSubTotal + $intImporteIva + $intImporteIeps;

				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
				 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
		        		 ->setCellValue('B'.$intFila, $arrCol->razon_social)
		        		 ->setCellValue('C'.$intFila, $arrCol->rfc)
		        		 ->setCellValue('D'.$intFila, $arrCol->fecha_format)
		        		 ->setCellValue('E'.$intFila, $intPrecio)
		        		 ->setCellValue('F'.$intFila, $intImporteIva)
		        		 ->setCellValue('G'.$intFila, $intImporteIeps)
		        		 ->setCellValue('H'.$intFila, $intTotal)
		        		 ->setCellValue('I'.$intFila, $arrCol->moneda)
		        		 ->setCellValue('J'.$intFila, $arrCol->tipo_cambio)
		        		 ->setCellValue('K'.$intFila, $arrCol->condiciones_pago)
		        		 ->setCellValue('L'.$intFila, $arrCol->folio_pedido)
		        		 ->setCellValue('M'.$intFila, $arrCol->vendedor)
		        		 ->setCellValue('N'.$intFila, $arrCol->forma_pago)
		        		 ->setCellValue('O'.$intFila, $arrCol->metodo_pago)
		        		 ->setCellValue('P'.$intFila, $arrCol->uso_cfdi)
		        		 ->setCellValue('Q'.$intFila, $arrCol->observaciones)
		        		 ->setCellValue('R'.$intFila, $arrCol->notas)
		                 ->setCellValue('S'.$intFila, $arrCol->estatus);

				//Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
			         $objExcel->setActiveSheetIndex(0)
		                      ->setCellValue('T'.$intFila, $intCantidad)
		                      ->setCellValueExplicit('U'.$intFila, $arrCol->serie, PHPExcel_Cell_DataType::TYPE_STRING)
		                      ->setCellValueExplicit('V'.$intFila, $arrCol->motor, PHPExcel_Cell_DataType::TYPE_STRING)
		                      ->setCellValueExplicit('W'.$intFila, $arrCol->codigo, PHPExcel_Cell_DataType::TYPE_STRING)
					          ->setCellValue('X'.$intFila, $arrCol->descripcion_corta)
					          ->setCellValue('Y'.$intFila, $arrCol->descripcion)
					          ->setCellValue('Z'.$intFila, $arrCol->maquinaria_linea)
					          ->setCellValue('AA'.$intFila, $arrCol->maquinaria_marca)
					          ->setCellValue('AB'.$intFila, $arrCol->maquinaria_modelo)
					          ->setCellValue('AC'.$intFila, $intPrecio)
					          ->setCellValue('AD'.$intFila, $intSubTotal);
					
				}

				//Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
                //Incrementar el contador por cada registro
				$intContador++;
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('E'.$intFilaInicial.':'.'H'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

           	$objExcel->getActiveSheet()
            		 ->getStyle('AC'.$intFilaInicial.':'.'AD'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');
            		 		 
			//Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('###0.0000');

           //Cambiar contenido de las celdas a formato númerico de 2 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('T'.$intFilaInicial.':'.'T'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('###0.00');


			//Cambiar alineación de las siguientes celdas
    		$objExcel->getActiveSheet()
		        	 ->getStyle('E'.$intFilaInicial.':'.'H'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);
                	 		 
			$objExcel->getActiveSheet()
                	 ->getStyle('S'.$intFilaInicial.':'.'S'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
		        	 ->getStyle('T'.$intFilaInicial.':'.'T'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
		        	 ->getStyle('AC'.$intFilaInicial.':'.'AD'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('S'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('S'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'facturas_maquinaria.xls', 'facturas de maquinaria', $intFila);
	}
}