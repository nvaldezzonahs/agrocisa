<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anticipos extends MY_Controller {
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
	    $this->archivo['strCarpetaDestino'] = './archivos/anticipos/';
		//Cargamos el modelo de anticipos
		$this->load->model('caja/anticipos_model', 'anticipos');
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
		$this->cargar_vista('caja/anticipos', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->anticipos->filtro($this->input->post('dteFechaInicial'),
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
		foreach ($result['anticipos'] as $arrDet)
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
            $arrDet->estiloRegistro = '';
            //Reemplazar cadena vacia por '_'
            $strEstiloEstatus =  str_replace (' ' , '_' ,  $arrDet->estatus);

            //Asignar el id del anticipo
            $intAnticipoID = $arrDet->anticipo_id;

            //Concatenar id del registro que hace referencia a la carpeta donde se encuentra el archivo
			$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intAnticipoID;

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

					 //Asignar array con el número de operaciones del anticipo (aplicación de anticipos/ devoluciones/pedidos de refacciones/etc.)
					$arrOperacionesAnticipo = $this->get_saldo_anticipo($intAnticipoID);
					//Si no existen operaciones del anticipo
					if($arrOperacionesAnticipo['numero_operaciones'] == 0 && $arrDet->poliza_id > 0)
					{
						//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
						if (in_array('CAMBIAR ESTATUS', $arrPermisos))
						{
							//Asignar cadena vacia para mostrar botón Desactivar
							$arrDet->mostrarAccionDesactivar = '';
						}
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


			$arrDet->estiloRegistro = 'registro-'.$strEstiloEstatus;
			
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
		$arrDatos = array('rows' => $result['anticipos'],
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
		$objAnticipo = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Datos del anticipo
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objAnticipo->intAnticipoID = $this->input->post('intAnticipoID');
		$objAnticipo->dteFecha = $this->input->post('dteFecha');
		$objAnticipo->dteFechaCobro = $this->input->post('dteFechaCobro');
		$objAnticipo->intMonedaID = $this->input->post('intMonedaID');
		$objAnticipo->intTipoCambio = $this->input->post('intTipoCambio');
		$objAnticipo->intModuloID = (($this->input->post('intModuloID') !== '') ? 
						   	   		  $this->input->post('intModuloID') : NULL); 
		$objAnticipo->intProspectoID = $this->input->post('intProspectoID');
		$objAnticipo->strRazonSocial =  mb_strtoupper(trim($this->input->post('strRazonSocial')));
		$objAnticipo->strRfc =  mb_strtoupper(trim($this->input->post('strRfc')));
		$objAnticipo->intRegimenFiscalID = (($this->input->post('intRegimenFiscalID') !== '') ? 
							          			   	$this->input->post('intRegimenFiscalID') : NULL);
		$objAnticipo->strCalle =  mb_strtoupper(trim($this->input->post('strCalle')));
		$objAnticipo->strNumeroExterior = mb_strtoupper($this->input->post('strNumeroExterior'));
		$objAnticipo->strNumeroInterior = mb_strtoupper($this->input->post('strNumeroInterior'));
		$objAnticipo->strCodigoPostal = $this->input->post('strCodigoPostal');
		$objAnticipo->strColonia =  mb_strtoupper(trim($this->input->post('strColonia')));
		$objAnticipo->strLocalidad =  mb_strtoupper(trim($this->input->post('strLocalidad')));
		$objAnticipo->strMunicipio = mb_strtoupper(trim($this->input->post('strMunicipio')));
		$objAnticipo->strEstado =  mb_strtoupper(trim($this->input->post('strEstado')));
		$objAnticipo->strPais = mb_strtoupper(trim($this->input->post('strPais')));		
		$objAnticipo->strConcepto = mb_strtoupper(trim($this->input->post('strConcepto')));
		$objAnticipo->intSubtotal =$this->input->post('intSubtotal');
		$objAnticipo->intTasaCuotaIva =$this->input->post('intTasaCuotaIva');
		$objAnticipo->intIva =  $this->input->post('intIva');
		$objAnticipo->intTasaCuotaIeps = (($this->input->post('intTasaCuotaIeps') !== '') ? 
						   	   			   $this->input->post('intTasaCuotaIeps') : NULL); 
		$objAnticipo->intIeps = $this->input->post('intIeps');
		$objAnticipo->intFormaPagoID = $this->input->post('intFormaPagoID');
		$objAnticipo->intMetodoPagoID = $this->input->post('intMetodoPagoID');
		$objAnticipo->intUsoCfdiID = $this->input->post('intUsoCfdiID');
		//Si no existe id del tipo de relación asignar valor nulo
		$objAnticipo->intTipoRelacionID = (($this->input->post('intTipoRelacionID') !== '') ? 
						   	   				 $this->input->post('intTipoRelacionID') : NULL);

		//Si no existe id de la exportación asignar valor nulo
		$objAnticipo->intExportacionID = (($this->input->post('intExportacionID') !== '') ? 
						   	   			   $this->input->post('intExportacionID') : NULL);

		//Si no existe código del objeto impuesto asignar valor nulo
		$objAnticipo->strObjetoImpuestoSat = (($this->input->post('strObjetoImpuestoSat') !== '') ? 
										       $this->input->post('strObjetoImpuestoSat') : NULL);

		$objAnticipo->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objAnticipo->intSucursalID = $this->session->userdata('sucursal_id');
		$objAnticipo->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los CFDI relacionados
		$objAnticipo->strCfdiRelacionado = $this->input->post('strCfdiRelacionado'); 
		$objAnticipo->strTiposRelacion = $this->input->post('strTiposRelacion'); 						
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objAnticipo->intAnticipoID))
		{
			$bolResultado = $this->anticipos->modificar($objAnticipo);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objAnticipo->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objAnticipo->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->anticipos->guardar($objAnticipo);

				/*Quitar '_'  de la cadena (resultadoTransaccion_anticipoID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $objAnticipo->intAnticipoID) = explode("_", $bolResultado); 
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
							 	  'anticipo_id' => $objAnticipo->intAnticipoID,
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
		$intID = $this->input->post('intAnticipoID');
		$strFormulario = $this->input->post('strFormulario');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->anticipos->buscar($intID);
	  
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Variable que se utiliza para asignar el saldo del anticipo
			$intSaldo = 0;
			//Variable que se utiliza para asignar el número de operaciones (anticipo aplicado)
			$intNumOperaciones = 0;
			
			//Concatenar id del registro que hace referencia a la carpeta donde se encuentra el archivo
			$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intID;
			//Asignar el nombre del archivo que le corresponde al registro
	        $arrDatos['archivo'] = $this->get_verifar_archivo_registro($strNombreCarpeta, $otdResultado->folio);
	       
	       //Si el estatus es diferente de INACTIVO
	        if($otdResultado->estatus != 'INACTIVO')
	        {
	        	//Asignar array con el saldo por aplicar del anticipo
				$arrSaldoAnticipo = $this->get_saldo_anticipo($intID, NULL, NULL, $strFormulario);
		        //Asignar saldo del anticipo
		        $intSaldo  = $arrSaldoAnticipo['saldo'];
		         //Asignar número de operaciones del anticipo
		        $intNumOperaciones = $arrSaldoAnticipo['numero_operaciones'];
	        }
	     

	        //Asignar el saldo por aplicar del anticipo
	        $arrDatos['total_aplicar'] = $intSaldo;
	        $arrDatos['numero_operaciones'] = $intNumOperaciones;

			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	

	//Método para regresar todos los registros activos en un autocomplete
	public function autocomplete()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$strDescripcion = trim($this->input->post('strDescripcion'));
		$intMonedaID = $this->input->post('intMonedaID');
		$intProspectoID = $this->input->post('intProspectoID');
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
			$otdResultado = $this->anticipos->autocomplete($strDescripcion, $intMonedaID, $intProspectoID, $strFormulario, $intReferenciaID);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->folio, 
		        						'data' => $arrCol->anticipo_id, 
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

		//Array que se utiliza para asignar los estatus 
		$arrEstatus = array('ACTIVO','TIMBRAR','INACTIVO');
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
		$otdResultado = $this->anticipos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, 
		 										 $strEstatus, $strBusqueda);
		//Seleccionar los datos de las monedas que coinciden con el parámetro enviado
		$otdMonedas = $this->anticipos->buscar_distintas_monedas($dteFechaInicial, $dteFechaFinal, $intProspectoID, 
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
		$pdf->strLinea1 =  'LISTADO DE ANTICIPOS '.$strTituloRangoFechas;
		//Si existe id del cliente
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del cliente que coincide con el id
			$otdProspecto =  $this->clientes->buscar($intProspectoID);
			$pdf->strLinea2 = utf8_decode('RAZÓN SOCIAL: '.$otdProspecto->razon_social);
		}

		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', utf8_decode('RAZÓN SOCIAL'), 'FECHA',
							      'CONCEPTO', 'SUBTOTAL', 'IVA', 'IEPS', 'TOTAL', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(16, 30, 15, 35, 18, 18, 18, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'L',  'R', 'R', 'R', 'R', 'C');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
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

			//Recorremos el arreglo para obtener la información de los anticipos
			foreach ($otdResultado as $arrCol)
			{ 
				//Convertir peso mexicano a tipo de cambio
				$intSubTotal = ($arrCol->subtotal / $arrCol->tipo_cambio);
				$intImporteIva = ($arrCol->iva / $arrCol->tipo_cambio);
				$intImporteIeps = ($arrCol->ieps / $arrCol->tipo_cambio);

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
					 			utf8_decode($arrCol->concepto), '$'.number_format($intSubTotal,2),
								'$'.number_format($intImporteIva,2), '$'.number_format($intImporteIeps,2),
								'$'.number_format($intTotal,2), $arrCol->estatus), 
								$pdf->arrAlineacion, 'ClippedCell');

				 //Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
		        //Si existe fecha de cobro
		        if($arrCol->fecha_cobro_format != '')
		        {
		        	//Fecha de cobro
					$pdf->Cell(21, 4, 'FECHA DE COBRO:', 0, 0, 'L', 0);
				    $pdf->ClippedCell(12, 4, utf8_decode($arrCol->fecha_cobro_format), 0, 0, 'L', 0);
		        }
				
				//Moneda
				$pdf->Cell(12, 4, 'MONEDA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(7, 4, utf8_decode($arrCol->MonedaTipo), 0, 0, 'L', 0);
		    	//Tipo de cambio
		    	$pdf->Cell(6, 4, 'T.C.:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(12, 4,'$'.number_format($arrCol->tipo_cambio, 4, '.', ','), 0, 0, 'R', 0);
			    //Forma de pago
		    	$pdf->Cell(20, 4, 'FORMA DE PAGO:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(40, 4,utf8_decode($arrCol->forma_pago), 0, 0, 'L', 0);
			    //Método de pago
		    	$pdf->Cell(21, 4, utf8_decode('MÉTODO DE PAGO:'), 0, 0, 'L', 0);
			    $pdf->ClippedCell(38, 4,utf8_decode($arrCol->metodo_pago), 0, 0, 'L', 0);
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
			$arrAnchuraResumen = array(33, 25, 25, 25, 25);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacionResumen = array('L', 'R', 'R', 'R', 'R');
			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Creación de la tabla Resumen
			$pdf->Cell(133, 4, 'RESUMEN GENERAL EN PESOS', 0, 0, 'C', TRUE);
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
            $pdf->Cell(21,3,$intContador, 0, 0, 'R');
            //Acumulado del subtotal
            $pdf->Cell(25,3,'$'.number_format($intAcumSubtotalEstatus,2), 0, 0, 'R');
            //Acumulado del IVA
            $pdf->Cell(25,3,'$'.number_format($intAcumIvaEstatus,2), 0, 0, 'R');
           //Acumulado del IEPS
            $pdf->Cell(25,3,'$'.number_format($intAcumIepsEstatus,2), 0, 0, 'R');
            //Acumulado del importe total
            $pdf->Cell(25,3,'$'.number_format($intAcumTotalEstatus,2), 0, 0, 'R');
            $pdf->Ln(8);//Deja un salto de línea*/

            //Hacer recorrido para obtener el resumen por cada tipo de moneda
			foreach ($otdMonedas as $arrMon) 
			{
				//Limpiar las siguientes variables (por cada moneda recorrida)
				$intAcumSubtotalEstatus = 0;
				$intAcumIvaEstatus = 0;
				$intAcumIepsEstatus = 0;
				$intAcumTotalEstatus = 0;

				//Asigna el tipo y tamaño de letra para la cabecera de la tabla
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Creación de la tabla Resumen
				$pdf->ClippedCell(133, 4, 'RESUMEN POR MONEDA '.$arrMon->descripcion, 0, 0, 'C', TRUE);
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
	            $pdf->Cell(21,3,$arrTotalRegistrosMoneda[$arrMon->moneda_id], 0, 0, 'R');
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
		$pdf->Output('anticipos.pdf','I'); 
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
		$otdResultado = $this->anticipos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID,  
												 $strEstatus,  $strBusqueda);
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
			     ->setCellValue('A7', 'LISTADO DE ANTICIPOS '.$strTituloRangoFechas);
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
        		 ->setCellValue('E'.$intPosEncabezados, 'FECHA DE COBRO')
        		 ->setCellValue('F'.$intPosEncabezados, 'CONCEPTO')
        		 ->setCellValue('G'.$intPosEncabezados, 'OBJETO DE IMPUESTO SAT')
        		 ->setCellValue('H'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('I'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('J'.$intPosEncabezados, 'IEPS')
        		 ->setCellValue('K'.$intPosEncabezados, 'TOTAL')
        		 ->setCellValue('L'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('M'.$intPosEncabezados, 'T.C.')
        		 ->setCellValue('N'.$intPosEncabezados, 'FORMA DE PAGO')
        		 ->setCellValue('O'.$intPosEncabezados, 'MÉTODO DE PAGO')
        		 ->setCellValue('P'.$intPosEncabezados, 'USO DEL CFDI')
        		 ->setCellValue('Q'.$intPosEncabezados, 'TIPO DE RELACIÓN')
        		 ->setCellValue('R'.$intPosEncabezados, 'ANTICIPO DE CLIENTE PARA')
        		 ->setCellValue('S'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('T'.$intPosEncabezados, 'ESTATUS');
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
    			 ->getStyle('A10:T10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

    	//Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:T10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:T10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   

				//Convertir peso mexicano a tipo de cambio
				$intSubtotal = ($arrCol->subtotal / $arrCol->tipo_cambio);
				$intImporteIva = ($arrCol->iva / $arrCol->tipo_cambio);
				$intImporteIeps = ($arrCol->ieps / $arrCol->tipo_cambio);
				//Calcular importe total
				$intImporteTotal = $intSubtotal + $intImporteIva + $intImporteIeps;

				//Asignar descripción del módulo
				$strModulo = $arrCol->modulo;

				//Si el porcentaje de IVA es cero
				if($arrCol->porcentaje_iva == PORCENTAJE_IVA_CERO)
				{
					//Concatenar porcentaje de IVA (0.000000)
					$strModulo .= ' 0%';
				}
				else 
				{
					//Concatenar porcentaje de IVA (0.160000)
					$strModulo .= ' 16%';
				}

				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
                         ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->razon_social)
                         ->setCellValue('C'.$intFila, $arrCol->rfc)
                         ->setCellValue('D'.$intFila, $arrCol->fecha_format)
                         ->setCellValue('E'.$intFila, $arrCol->fecha_cobro_format)
                         ->setCellValue('F'.$intFila, $arrCol->concepto)
                         ->setCellValueExplicit('G'.$intFila, $arrCol->objeto_impuesto, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('H'.$intFila, $intSubtotal)
                         ->setCellValue('I'.$intFila, $intImporteIva)
                         ->setCellValue('J'.$intFila, $intImporteIeps)
                         ->setCellValue('K'.$intFila, $intImporteTotal)
                         ->setCellValue('L'.$intFila, $arrCol->moneda)
                         ->setCellValue('M'.$intFila, $arrCol->tipo_cambio)
                         ->setCellValue('N'.$intFila, $arrCol->forma_pago)
                         ->setCellValue('O'.$intFila, $arrCol->metodo_pago)
                         ->setCellValue('P'.$intFila, $arrCol->uso_cfdi)
                         ->setCellValue('Q'.$intFila, $arrCol->tipo_relacion)
                         ->setCellValue('R'.$intFila, $strModulo)
                         ->setCellValue('S'.$intFila, $arrCol->observaciones)
                         ->setCellValue('T'.$intFila, $arrCol->estatus);


                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}
			
			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('H'.$intFilaInicial.':'.'K'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            //Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('M'.$intFilaInicial.':'.'M'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.0000');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('D'.$intFilaInicial.':'.'E'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('H'.$intFilaInicial.':'.'K'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);		

            $objExcel->getActiveSheet()
		        	 ->getStyle('M'.$intFilaInicial.':'.'M'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);
                	  
			$objExcel->getActiveSheet()
                	 ->getStyle('T'.$intFilaInicial.':'.'T'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('T'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('T'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'anticipos.xls', 'anticipos', $intFila);
	}


	//Método para regresar los anticipos (Fiscales/No fiscales) con saldo de un cliente
	public function get_anticipos_saldo()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('rows' => NULL, 
						  'acumulado_saldo' => '$0.00');

		//Variables que se utilizan para recuperar los valores de la vista 
		$intProspectoID = $this->input->post('intProspectoID');
		$intMonedaID = $this->input->post('intMonedaID');
		//Variable que se utiliza para asignar la fecha actual 
		$dteFechaCorte = date("Y-m-d");

		//Array que se utiliza para agregar los anticipos 
        $arrAnticipos = array();
        //Array que se utiliza para agregar los datos de un anticipo
        $arrAuxiliar = array();
   		//Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;

	    //Seleccionar los datos de los anticipos que coinciden con el parámetro enviado
		$otdResultado = $this->anticipos->buscar_saldos_anticipos($dteFechaCorte, NULL, $intMonedaID, 
																  NULL, NULL, $intProspectoID);

		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Hacer recorrido para obtener anticipos
			foreach ($otdResultado as $arrCol)
			{
				//Variable que se utiliza para asignar el saldo del anticipo
			    $intSaldo = $arrCol->saldo;

			    //Si el anticipo no se encuentra aplicado
				if (($intSaldo >= 1) OR ($intSaldo <= -1))
				{
					
					//Definir valores del array auxiliar de información (para cada anticipo)
					$arrAuxiliar["referencia_id"] = $arrCol->referencia_id;
					$arrAuxiliar["tipo_referencia"] = $arrCol->tipo_referencia;
					$arrAuxiliar["tipo_cambio"] = $arrCol->tipo_cambio;
					$arrAuxiliar["folio"] = $arrCol->folio;
					$arrAuxiliar["fecha"] = $arrCol->fecha_format;
					$arrAuxiliar["concepto"] = $arrCol->concepto;
					$arrAuxiliar["subtotal"] = number_format($arrCol->subtotal, 2);
					$arrAuxiliar["tasa_cuota_iva"] = $arrCol->tasa_cuota_iva;
					$arrAuxiliar["porcentaje_iva"] = $arrCol->porcentaje_iva;
					$arrAuxiliar["iva"] = number_format($arrCol->iva, 2);
					$arrAuxiliar["tasa_cuota_ieps"] = $arrCol->tasa_cuota_ieps;
					$arrAuxiliar["porcentaje_ieps"] = $arrCol->porcentaje_ieps;
					$arrAuxiliar["ieps"] = number_format($arrCol->ieps, 2);
					$arrAuxiliar["importe"] = number_format($arrCol->importe, 2);
					$arrAuxiliar["saldo"] = number_format($intSaldo, 2);
					//Asignar datos al array
	                array_push($arrAnticipos, $arrAuxiliar); 
	                
	                //Incrementar acumulado del saldo
	                $intAcumSaldo += $intSaldo;

				}//Cierre de verificación del saldo

				
			}//Cierre de foreach anticipos

			//Agregar datos al array
			$arrDatos['rows'] = $arrAnticipos;
			//Convertir cantidad a formato moneda
			$arrDatos['acumulado_saldo'] = '$'.number_format($intAcumSaldo,2);

		}//Cierre de verificación de información

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}
}