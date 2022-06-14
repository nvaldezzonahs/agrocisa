<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos_proveedores extends MY_Controller {
	
	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;

	//Información que se utiliza para asignar el número de decimales a redondear
	var $intNumDecimales = NUM_DECIMALES_MOSTRAR_CUENTAS_PAGAR;
	//Información que se utiliza para asignar el número de decimales a redondear del IVA unitario
	var $intNumDecimalesIvaUnitario = NUM_DECIMALES_IVA_UNIT_OC_CUENTAS_PAGAR;
	//Información que se utiliza para asignar el número de decimales a redondear del IEPS unitario
	var $intNumDecimalesIepsUnitario = NUM_DECIMALES_IEPS_UNIT_OC_CUENTAS_PAGAR;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		 //Asignar ruta de la carpeta temporal
	    $this->archivo['strCarpetaTemporal'] = './pagos_proveedores_temporal_';
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de pagos a proveedores
		$this->load->model('cuentas_pagar/pagos_proveedores_model', 'pagos');
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
		$this->cargar_vista('cuentas_pagar/pagos_proveedores', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->pagos->filtro($this->input->post('dteFechaInicial'),
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
		foreach ($result['pagos'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
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
		$arrDatos = array('rows' => $result['pagos'],
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
		$objPagoProveedor = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Datos del pago
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objPagoProveedor->intPagoProveedorID = $this->input->post('intPagoProveedorID');
		$objPagoProveedor->dteFecha = $this->input->post('dteFecha');
		$objPagoProveedor->intMonedaID = $this->input->post('intMonedaID');
		$objPagoProveedor->intTipoCambio = $this->input->post('intTipoCambio');
		$objPagoProveedor->intProveedorID = $this->input->post('intProveedorID');
		$objPagoProveedor->strRazonSocial =  mb_strtoupper(trim($this->input->post('strRazonSocial')));
		$objPagoProveedor->strRfc =  mb_strtoupper(trim($this->input->post('strRfc')));
		$objPagoProveedor->strCalle =  mb_strtoupper(trim($this->input->post('strCalle')));
		$objPagoProveedor->strNumeroExterior = mb_strtoupper($this->input->post('strNumeroExterior'));
		$objPagoProveedor->strNumeroInterior = mb_strtoupper($this->input->post('strNumeroInterior'));
		$objPagoProveedor->strCodigoPostal = $this->input->post('strCodigoPostal');
		$objPagoProveedor->strColonia =  mb_strtoupper(trim($this->input->post('strColonia')));
		$objPagoProveedor->strLocalidad =  mb_strtoupper(trim($this->input->post('strLocalidad')));
		$objPagoProveedor->strMunicipio = mb_strtoupper(trim($this->input->post('strMunicipio')));
		$objPagoProveedor->strEstado =  mb_strtoupper(trim($this->input->post('strEstado')));
		$objPagoProveedor->strPais = mb_strtoupper(trim($this->input->post('strPais')));
		$objPagoProveedor->intCuentaBancariaID = $this->input->post('intCuentaBancariaID');
		$objPagoProveedor->intFormaPagoID = $this->input->post('intFormaPagoID');
		$objPagoProveedor->intImporte = $this->input->post('intImporte');	
		$objPagoProveedor->strObservaciones = mb_strtoupper($this->input->post('strObservaciones'));
		$objPagoProveedor->intSucursalID = $this->session->userdata('sucursal_id');
		$objPagoProveedor->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los detalles
		$objPagoProveedor->strReferencias = $this->input->post('strReferencias'); 
		$objPagoProveedor->strReferenciaID = $this->input->post('strReferenciaID'); 
		$objPagoProveedor->strImportes = $this->input->post('strImportes'); 
		$objPagoProveedor->strTasaCuotaIva = $this->input->post('strTasaCuotaIva'); 
		$objPagoProveedor->strIvas = $this->input->post('strIvas'); 
		$objPagoProveedor->strTasaCuotaIeps = $this->input->post('strTasaCuotaIeps'); 
		$objPagoProveedor->strIeps = $this->input->post('strIeps'); 
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objPagoProveedor->intPagoProveedorID))
		{
			$bolResultado = $this->pagos->modificar($objPagoProveedor);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objPagoProveedor->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objPagoProveedor->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->pagos->guardar($objPagoProveedor); 
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
		$intID = $this->input->post('intPagoProveedorID');

		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->pagos->buscar($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
			//Seleccionar los detalles del registro
			$otdDetalles = $this->pagos->buscar_detalles($intID);
			//Si existen detalles del registro, se asignan al array
			if($otdDetalles)
			{
				//Hacer un llamado a la función para obtener detalles de la referencia
				$arrDatos['detalles'] = $this->get_datos_detalles_pagos_proveedor($otdDetalles);
			}
		}
		
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intPagoProveedorID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intPagoProveedorID');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->pagos->set_estatus($intID);
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

	
	//Método para enviar orden de compra al correo electrónico del proveedor
	public function enviar_correo_electronico_proveedor()
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$intPagoProveedorID = $this->input->post('intPagoProveedorID');
		$strCorreoElectronico = $this->input->post('strCorreoElectronico');
		$strCopiaCorreoElectronico = $this->input->post('strCopiaCorreoElectronico');
		
	 	//Generar el archivo PDFget_re
        $strRuta = $this->get_reporte_registro($intPagoProveedorID, 'SI');

         //Array que se utiliza para enviar correo electrónico
		$arrDatos =  array('intReferenciaID' => $intPagoProveedorID,
						   'strTitulo' => utf8_decode('Pago'),
						   'strRuta' => $strRuta,
						   'strCorreoElectronico'  => $strCorreoElectronico,
						   'strCopiaCorreoElectronico' => $strCopiaCorreoElectronico,
						   'strComentarios' => 'Pago.');

		//Hacer un llamado a la función para enviar correo electrónico
		$this->set_enviar_correo($arrDatos);
	}
	
	//Método para eliminar carpeta temporal
	public function eliminar_carpeta_temporal($intPagoProveedorID)
	{
        //Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaTemporal'].$intPagoProveedorID; 
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
		$intProveedorID = $this->input->post('intProveedorID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strDetalles = $this->input->post('strDetalles');

		//Array que se utiliza para asignar los estatus 
		$arrEstatus = array('ACTIVO', 'INACTIVO');
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
		$otdResultado = $this->pagos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProveedorID,  
											$strEstatus, $strBusqueda);
		//Seleccionar los datos de las monedas que coinciden con el parámetro enviado
		$otdMonedas = $this->pagos->buscar_distintas_monedas($dteFechaInicial, $dteFechaFinal, $intProveedorID,  
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
		$pdf->strLinea1 =  'LISTADO DE PAGOS A PROVEEDORES '.$strTituloRangoFechas;
		//Si existe id del proveedor
		if($intProveedorID > 0)
		{
			//Seleccionar los datos del proveedor que coincide con el id
			$otdProveedor =  $this->proveedores->buscar($intProveedorID);
			$pdf->strLinea2 =  'PROVEEDOR: '.utf8_decode($otdProveedor->codigo.' - '.$otdProveedor->razon_social);
		}

		
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'PROVEEDOR', 'FECHA',  'SUBTOTAL', 'IVA', 'IEPS', 
						     	  'TOTAL', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(16, 65, 15, 20, 18, 18, 18, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'R', 'R', 'R', 'R', 'C');
		//Establece el ancho de las columnas de la moneda, tipo de cambio, etc.
		$arrAnchuraMoneda = array(12, 7, 8, 12, 21, 40, 12, 78);
		//Establece la alineación de las celdas de la moneda, tipo de cambio, etc.
		$arrAlineacionMoneda = array('L', 'R', 'L', 'R', 'L', 'L', 'L', 'L');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('L', 'L', 'L', 'L', 'R', 'R', 'R', 'R', 'R', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(16, 15, 20, 40, 17, 16, 16, 16, 16, 18);
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

			//Recorremos el arreglo para obtener la información de los pagos
			foreach ($otdResultado as $arrCol)
			{ 
				
		         //Variable que se utiliza para asignar el acumulado del subtotal
				$intAcumSubtotal = $arrCol->subtotal;
				//Variable que se utiliza para asignar el acumulado del IVA
				$intAcumIva = $arrCol->iva;
				//Variable que se utiliza para asignar el acumulado del IEPS
				$intAcumIeps = $arrCol->ieps;

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
					
				
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, utf8_decode($arrCol->proveedor), $arrCol->fecha,  
								'$'.number_format($intAcumSubtotal,2),
								'$'.number_format($intAcumIva,2), '$'.number_format($intAcumIeps,2),
								'$'.number_format($intTotal,2), $arrCol->estatus), 
								$pdf->arrAlineacion, 'ClippedCell');
		        

		        //Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraMoneda);

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
			    $pdf->Row(array('MONEDA:', $arrCol->codigo_moneda, 'T.C.:',
								'$'.number_format($arrCol->tipo_cambio, 4, '.', ','),
								'FORMA DE PAGO:', utf8_decode($arrCol->forma_pago),
								'CUENTA:', utf8_decode($arrCol->cuenta_bancaria)),
				    			$arrAlineacionMoneda, 'ClippedCell', 'SI');

				//Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
					//Seleccionar los detalles del registro
					$otdDetalles = $this->pagos->buscar_detalles($arrCol->pago_proveedor_id);

					//Hacer un llamado a la función para obtener detalles de la referencia
					$otdDetallesOrden = $this->get_datos_detalles_pagos_proveedor($otdDetalles, $arrCol->tipo_cambio);
				
					//Verificar si existe información de los detalles (con datos de la orden de compra)
					if($otdDetallesOrden)
					{

						$pdf->Ln(2);//Deja un salto de línea
						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraDetalles);

						//Recorremos el arreglo 
						foreach ($otdDetallesOrden as $arrDet)
						{
							//Concatenar impuestos trasladados
							$strImpuestos = "IVA%";
							$strImpuestos .= $arrDet->porcentaje_iva."|";
							$strImpuestos .= "IEPS%";
							$strImpuestos .= $arrDet->porcentaje_ieps;


	                      	 //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    	$pdf->Row(array($arrDet->folio, $arrDet->fecha, $arrDet->referencia, 
					    					$strImpuestos, 
					    					'$'.number_format($arrDet->subtotal_orden_auxiliar,2), 
					    					'$'.number_format($arrDet->iva_orden_auxiliar,2), 
					    					'$'.number_format($arrDet->ieps_orden_auxiliar,2), 
					    					'$'.number_format($arrDet->total_orden_auxiliar,2), 
											'$'.number_format($arrDet->abono,2), 
											'$'.number_format($arrDet->saldo_orden,2)),
					    			    $arrAlineacionDetalles, 'ClippedCell');
						}

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
		$pdf->Output('pagos_proveedores.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro($intPagoProveedorID = NULL, $strEnviarCorreo = NULL) 
	{	            
		
		//Si el reporte no se enviara por correo electrónico
		if($strEnviarCorreo == NULL)
		{
			//Variables que se utilizan para recuperar los valores de la vista
			$intPagoProveedorID = $this->input->post('intPagoProveedorID');
		}

		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->pagos->buscar($intPagoProveedorID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->pagos->buscar_detalles($intPagoProveedorID);
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variables que se utilizan para los acumulados de las ordenes de compra
		//Variable que se utiliza para asignar el acumulado del subtotal
		$intAcumSubtotalOrdenCompra = 0;
		//Variable que se utiliza para asignar el acumulado del IVA
		$intAcumIvaOrdenCompra = 0;
		//Variable que se utiliza para asignar el acumulado del IEPS
		$intAcumIepsOrdenCompra = 0;
		//Variable que se utiliza para asignar el acumulado del total de la orden de compra
		$intAcumTotalOrdenCompra = 0;
		//Variables que se utilizan para los acumulados del detalle
		//Variable que se utiliza para asignar el acumulado del subtotal
		$intAcumSubtotal = 0;
		//Variable que se utiliza para asignar el acumulado del IVA
		$intAcumIva = 0;
		//Variable que se utiliza para asignar el acumulado del IEPS
		$intAcumIeps = 0;
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'pago_proveedor_';
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
	        //---------- DATOS DEL PAGO
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(108, 42);
			$pdf->ClippedCell(92, 3, 'PAGO A PROVEEDORES', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0);//establece el color de texto
			//Folio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, 46);
			$pdf->ClippedCell(15, 3, 'FOLIO');
			//Fecha 
			$pdf->SetXY(154, 46);
			$pdf->ClippedCell(15, 3, 'FECHA');
			//Forma de pago
		    $pdf->SetXY(108, 49);
			$pdf->ClippedCell(30, 3, 'FORMA DE PAGO');
			//Cuenta bancaria
		    $pdf->SetXY(108, 52);
			$pdf->ClippedCell(30, 3, 'CUENTA');
			//Moneda
			$pdf->SetXY(108, 55);
			$pdf->ClippedCell(15, 3, 'MONEDA');
			//Tipo de cambio
			$pdf->SetXY(154, 55);
			$pdf->ClippedCell(25, 3, 'TIPO DE CAMBIO');
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
			$pdf->SetXY(184, 46);
			$pdf->ClippedCell(29, 3, $otdResultado->fecha);
			//Forma de pago
			$pdf->SetXY(135, 49);
			$pdf->ClippedCell(63, 3, utf8_decode($otdResultado->forma_pago));
			//Cuenta bancaria
			$pdf->SetXY(135, 52);
			$pdf->ClippedCell(63, 3, $otdResultado->cuenta_bancaria);
			//Moneda
			$pdf->SetXY(135, 55);
			$pdf->ClippedCell(29, 3, $otdResultado->codigo_moneda);
			//Tipo de cambio
			$pdf->SetXY(184, 55);
			$pdf->ClippedCell(20, 3, '$'.number_format($otdResultado->tipo_cambio, 4, '.', ','));
			//Estatus
			$pdf->SetXY(135, 58);
			$pdf->ClippedCell(60, 3, $otdResultado->estatus);

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DEL PAGO
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 70);
			$pdf->ClippedCell(185, 3, 'CONCEPTOS', 0, 0, 'C', TRUE);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);

			//Hacer un llamado a la función para obtener detalles de la referencia
			$otdDetallesOrden = $this->get_datos_detalles_pagos_proveedor($otdDetalles, $otdResultado->tipo_cambio);
		
			//Verificar si existe información de los detalles (con datos de la orden de compra)
			if($otdDetallesOrden)
			{
				//Tabla con los detalles del pago
				$pdf->SetXY(15, 74);
				//Crea los titulos de la cabecera
				$arrCabecera = array('Folio', 'Fecha', utf8_decode('Módulo'), 'IVA %', 'IEPS %', 
									 'Importe', 'Abono');
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(16, 16, 53, 25, 25, 25, 25);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'L', 'R', 'R', 'R', 'R');
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
				foreach ($otdDetallesOrden as $arrDet)
				{ 
					$pdf->SetX(15);
					
				    //Asignar datos de la orden de compra
					$intSubtotalOrdenCompra = $arrDet->subtotal_orden_auxiliar;
					$intIvaOrdenCompra = $arrDet->iva_orden_auxiliar;
					$intIepsOrdenCompra = $arrDet->ieps_orden_auxiliar;
					$intTotalOrdenCompra = $arrDet->total_orden_auxiliar;
				
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($arrDet->folio, $arrDet->fecha, $arrDet->referencia,
									$arrDet->porcentaje_iva, $arrDet->porcentaje_ieps, 
									number_format($intSubtotalOrdenCompra,4),
								    number_format($arrDet->importe_auxiliar,4)), 
									$arrAlineacion, 'ClippedCell');

					
					//Incrementar acumulados de las ordenes de compra
					$intAcumSubtotalOrdenCompra += $intSubtotalOrdenCompra;
					$intAcumIvaOrdenCompra += $intIvaOrdenCompra;
					$intAcumIepsOrdenCompra += $intIepsOrdenCompra;
					$intAcumTotalOrdenCompra  += $intTotalOrdenCompra;
				}

				//Asignar acumulados
			    $intAcumSubtotal = $otdResultado->subtotal;
			    $intAcumIva = $otdResultado->iva;
			    $intAcumIeps = $otdResultado->ieps;


				//Calcular importe total
				$intTotal = $intAcumSubtotal+$intAcumIva+$intAcumIeps;

				//Asignar el importe del pago (convertido a tipo de cambio)
				$intImportePago = ($otdResultado->importe / $otdResultado->tipo_cambio);

				//Calcular diferencia
				$intDiferencia = $intImportePago - $intTotal;

				//Redondear importe total a dos decimales
				$intTotal = number_format($intTotal,2);

			    //Calcular importe total de las ordenes de compra
				$intTotalOrdenCompra = $intAcumTotalOrdenCompra;
				//Redondear importe total a dos decimales
				$intTotalOrdenCompra = number_format($intTotalOrdenCompra,2);

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
				$pdf->SetX(150);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumSubtotalOrdenCompra,2), 0, 0, 'R');
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
				$pdf->SetX(150);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIvaOrdenCompra,2), 0, 0, 'R');
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
				$pdf->SetX(150);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIepsOrdenCompra,2), 0, 0, 'R');
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
				$pdf->SetX(150);
				$pdf->ClippedCell(25, 3, '$'.$intTotalOrdenCompra, 0, 0, 'R');
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.$intTotal, 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				//Importe del pago
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'TOTAL PAGO');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intImportePago,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				//Diferencia
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'DIFERENCIA');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intDiferencia,2), 0, 0, 'R');
				//Observaciones
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(15, $intPosY);
				$pdf->MultiCell(110, 3, utf8_decode($otdResultado->observaciones));
				//Persona que recibio el pago
	            $pdf->SetXY(15,260);
	            //Persona que reviso el pago
	            $pdf->SetXY(109, 260);
	            $pdf->Ln(5);//Espacios de salto de línea
	            $pdf->SetX(15);
	            //Persona que recibio el pago
	            //Asigna el tipo y tamaño de letra
	            $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
	            $pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
	            $pdf->Cell(90, 3, 'RECIBIO', 0, 0, 'C',  TRUE);
	            //Persona que reviso el pago
	            $pdf->SetXY(109, 265);
	            $pdf->Cell(90, 3, 'REVISO', 0, 0, 'C',  TRUE);
	           
	            //Fecha y hora de impresión (pie de pagina)
				$pdf->strUsuarioCreacion = $otdResultado->usuario_creacion;
				$pdf->dteFechaCreacion = $otdResultado->fecha_creacion;
				$pdf->strIncluirMembrete = 'SI';

			}//Cierre de verificación de detalles

			//Concatenar folio para identificar pago
			$strNombreArchivo .= $otdResultado->folio;

		}//Cierre de verificación de información

		//Si la opción es enviar reporte por correo electrónico
		if($strEnviarCorreo == 'SI')
		{	
            //Definir ubicación de la carpeta
			$strCarpetaDestino =  $this->archivo['strCarpetaTemporal'].$intPagoProveedorID.'/'; 
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
		$otdResultado = $this->pagos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProveedorID,
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
			     ->setCellValue('A7', 'LISTADO DE PAGOS A PROVEEDORES '.$strTituloRangoFechas);
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
        		 ->setCellValue('D'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('E'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('F'.$intPosEncabezados, 'IEPS')
        		 ->setCellValue('G'.$intPosEncabezados, 'TOTAL')
        		 ->setCellValue('H'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('I'.$intPosEncabezados, 'T.C.')
        		 ->setCellValue('J'.$intPosEncabezados, 'FORMA DE PAGO')
        		 ->setCellValue('K'.$intPosEncabezados, 'CUENTA')
        		 ->setCellValue('L'.$intPosEncabezados, 'MONTO')
        		 ->setCellValue('M'.$intPosEncabezados, 'OBSERVACIONES')
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
                     ->setCellValue('O'.$intPosEncabezados, 'FOLIO')
			         ->setCellValue('P'.$intPosEncabezados, 'FECHA')
			         ->setCellValue('Q'.$intPosEncabezados,'REFERENCIA')
			         ->setCellValue('R'.$intPosEncabezados,'IVA %')
			         ->setCellValue('S'.$intPosEncabezados,'IEPS %')
			         ->setCellValue('T'.$intPosEncabezados, 'SUBTOTAL')
			         ->setCellValue('U'.$intPosEncabezados, 'IVA')
			         ->setCellValue('V'.$intPosEncabezados, 'IEPS')
			         ->setCellValue('W'.$intPosEncabezados, 'TOTAL')
			         ->setCellValue('X'.$intPosEncabezados, 'ABONO')
			         ->setCellValue('Y'.$intPosEncabezados, 'SALDO');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('O'.$intPosEncabezados.':Y'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('O'.$intPosEncabezados.':Y'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('O'.$intPosEncabezados.':Y'.$intPosEncabezados)
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
				$intAcumSubtotal = $arrCol->subtotal;
				//Variable que se utiliza para asignar el acumulado del IVA
				$intAcumIva = $arrCol->iva;
				//Variable que se utiliza para asignar el acumulado del IEPS
				$intAcumIeps = $arrCol->ieps;

				//Si se cumple la sentencia mostrar detalles del registro
			    if($strDetalles == 'SI')
			    {
					//Seleccionar los detalles del registro
					$otdDetalles = $this->pagos->buscar_detalles($arrCol->pago_proveedor_id);
					//Hacer un llamado a la función para obtener detalles de la referencia
					$otdDetallesOrden = $this->get_datos_detalles_pagos_proveedor($otdDetalles, $arrCol->tipo_cambio);
				
					//Verificar si existe información de los detalles 
					if($otdDetallesOrden)
					{
						//Variable que se utiliza para contar el número de detalles
					    $intContDetPag = 0;

					    //Asignar el número de detalles
					    $intNumDetalles = count($otdDetallesOrden);
					    
						//Recorremos el arreglo 
						foreach ($otdDetallesOrden as $arrDet)
						{
							
						    //Definir valores del array auxiliar de información (para cada detalle)
							$arrDetalles[$intContDetPag]['folio'] = $arrDet->folio;
							$arrDetalles[$intContDetPag]['fecha'] = $arrDet->fecha;
							$arrDetalles[$intContDetPag]['referencia'] = $arrDet->referencia;
							$arrDetalles[$intContDetPag]['porcentaje_iva'] = $arrDet->porcentaje_iva;
							$arrDetalles[$intContDetPag]['porcentaje_ieps'] = $arrDet->porcentaje_ieps;
							$arrDetalles[$intContDetPag]['subtotal_orden'] = $arrDet->subtotal_orden_auxiliar;
							$arrDetalles[$intContDetPag]['iva_orden'] = $arrDet->iva_orden_auxiliar;
							$arrDetalles[$intContDetPag]['ieps_orden'] = $arrDet->ieps_orden_auxiliar;
							$arrDetalles[$intContDetPag]['total_orden'] = $arrDet->total_orden_auxiliar;
							$arrDetalles[$intContDetPag]['abono'] =  $arrDet->abono;
							$arrDetalles[$intContDetPag]['saldo_orden'] = $arrDet->saldo_orden;

							//Incrementar el contador por cada registro
		                    $intContDetPag++;
						}

					}

				}//Cierre de verificación de detalles

				//Calcular importe total
				$intTotal = $intAcumSubtotal+$intAcumIva+$intAcumIeps;

				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    {
			    	
			    	//Asignar el importe del pago (convertido a tipo de cambio)
					$intImportePago = ($arrCol->importe / $arrCol->tipo_cambio);

			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('B'.$intFila, $arrCol->proveedor)
	                         ->setCellValue('C'.$intFila, $arrCol->fecha)
	                         ->setCellValue('D'.$intFila, $intAcumSubtotal)
	                         ->setCellValue('E'.$intFila, $intAcumIva)
	                         ->setCellValue('F'.$intFila, $intAcumIeps)
	                         ->setCellValue('G'.$intFila, $intTotal)
	                         ->setCellValue('H'.$intFila, $arrCol->moneda)
	                         ->setCellValue('I'.$intFila, $arrCol->tipo_cambio)
	                         ->setCellValue('J'.$intFila, $arrCol->forma_pago)
	                         ->setCellValue('K'.$intFila, $arrCol->cuenta_bancaria)
	                         ->setCellValue('L'.$intFila, $intImportePago)
	                         ->setCellValue('M'.$intFila, $arrCol->observaciones)
	                         ->setCellValue('N'.$intFila, $arrCol->estatus);

	                //Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
								 ->setCellValueExplicit('O'.$intFila, $arrDetalles[$intContDet]['folio'], PHPExcel_Cell_DataType::TYPE_STRING)
						         ->setCellValue('P'.$intFila, $arrDetalles[$intContDet]['fecha'])
						         ->setCellValue('Q'.$intFila, $arrDetalles[$intContDet]['referencia'])
						         ->setCellValueExplicit('R'.$intFila, $arrDetalles[$intContDet]['porcentaje_iva'], PHPExcel_Cell_DataType::TYPE_STRING)
						         ->setCellValueExplicit('S'.$intFila, $arrDetalles[$intContDet]['porcentaje_ieps'], PHPExcel_Cell_DataType::TYPE_STRING)
						         ->setCellValue('T'.$intFila, $arrDetalles[$intContDet]['subtotal_orden'])
						         ->setCellValue('U'.$intFila, $arrDetalles[$intContDet]['iva_orden'])
						         ->setCellValue('V'.$intFila, $arrDetalles[$intContDet]['ieps_orden'])
						         ->setCellValue('W'.$intFila, $arrDetalles[$intContDet]['total_orden'])
						         ->setCellValue('X'.$intFila, $arrDetalles[$intContDet]['abono'])
						         ->setCellValue('Y'.$intFila, $arrDetalles[$intContDet]['saldo_orden']);
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
            		 ->getStyle('L'.$intFilaInicial.':'.'L'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

           	$objExcel->getActiveSheet()
            		 ->getStyle('T'.$intFilaInicial.':'.'Y'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.0000');

			//Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('I'.$intFilaInicial.':'.'I'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.0000');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
		        	 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);
		        	 
    		$objExcel->getActiveSheet()
		        	 ->getStyle('D'.$intFilaInicial.':'.'G'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('L'.$intFilaInicial.':'.'L'.$intFila)
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
                	 ->getStyle('P'.$intFilaInicial.':'.'P'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

			$objExcel->getActiveSheet()
                	 ->getStyle('T'.$intFilaInicial.':'.'Y'.$intFila)
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
        $this->get_pie_pagina_archivo_excel($objExcel, 'pagos_proveedores.xls', 'pagos', $intFila);
	}

	/*******************************************************************************************************************
	Funciones de las ordenes de compra con adeudo
	*********************************************************************************************************************/
	//Método para regresar las ordenes de compra con adeudos de un proveedor
	public function get_ordenes_adeudos()
	{

		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('rows' => NULL, 
						  'acumulado_saldo' => '$0.00', 
						  'acumulado_saldo_vencido' => '$0.00', 
						  'acumulado_anticipos' => '$0.00');
		//Variables que se utilizan para recuperar los valores de la vista 
		$intProveedorID = $this->input->post('intProveedorID');
		$intMonedaIDPago = $this->input->post('intMonedaIDPago');
		$intTipoCambioPago = $this->input->post('intTipoCambioPago');

		//Variable que se utiliza para asignar la fecha actual 
		$dteFechaCorte = date("Y-m-d");
		//Array que se utiliza para agregar las orden de compras con adeudo
        $arrOrdenesCompra = array();
        //Array que se utiliza para agregar los datos de una orden de compra
        $arrAuxiliar = array();
        //Variable que se utiliza para asignar el acumulado del saldo
	    $intAcumSaldo = 0;
	    //Variable que se utiliza para asignar el acumulado del saldo vencido
	    $intAcumSaldoVencido = 0;
	    //Variable que se utiliza para asignar el acumulado de anticipos
	    $intAcumAnticipos = 0;

		//Seleccionar los datos de las ordenes de compra que coinciden con el parámetro enviado
		$otdResultado = $this->pagos->buscar_ordenes_compra_importes('grid_view', $dteFechaCorte, $intProveedorID);

		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Hacer recorrido para obtener ordenes de compra
			foreach ($otdResultado as $arrCol)
			{
				//Variable que se utiliza para asignar el id de la orden de compra
				$intReferenciaID = $arrCol->referencia_id;
				//Variable que se utiliza para asignar el tipo de referencia (MAQUINARIA/REFACCIONES/SERVICIO/GENERAL) de la orden de compra 
				$strTipoReferencia =  $arrCol->tipo_referencia;
				//Variable que se utiliza para asignar el saldo de la orden de compra
			    $intSaldoOrdenCompra = $arrCol->saldo;

			    //Si la orden de compra no se encuentra pagada
				if (($intSaldoOrdenCompra >= 1) OR ($intSaldoOrdenCompra <= -1))
				{

					//Seleccionar las tasas de los detalles (agrupados por tasa_cuota_iva y tasa_cuota_ieps) de la orden de compra 
					$otdTasas =  $this->pagos->buscar_tasas_detalles_orden_compra($intReferenciaID, $strTipoReferencia);
					
					//Si hay información
					if($otdTasas)
					{
						//Hacer recorrido para obtener las distintas tasas de los detalles de la orden de compra
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

							//Seleccionar los importes de la orden de compra (primer posición del arreglo)
							$otdImportesTasa = $this->pagos->buscar_ordenes_compra_importes(NULL, $dteFechaCorte, 
									 													    NULL, NULL, $intReferenciaID,
																						    $strTipoReferencia, NULL,
																					   	 	$intTasaCuotaIva, 
																					   	 	$intTasaCuotaIeps)[0];
							//Si hay información
							if($otdImportesTasa)
							{ 
								
								//Si la orden de compra no se encuentra pagada
								if (($otdImportesTasa->saldo >= 1) OR ($otdImportesTasa->saldo <= -1))
								{
									//Variables que se utilizan para asignar valores de la orden de compra
									$intSaldoVencido = 0;
				                    $dteFechaVencimiento = $arrCol->fecha_vencimiento;
				                    $intMonedaID =  $arrCol->moneda_id;
				                    $intTipoCambio =  $arrCol->tipo_cambio;
				                    $intSubtotalOrdenCompra = $otdImportesTasa->subtotal;
				                    $intIepsOrdenCompra = $otdImportesTasa->ieps;

				                    //Variable que se utiliza para asignar el saldo de la orden de compra (correspondiente a la moneda del pago)
			      			        $intSaldoAux = number_format($otdImportesTasa->saldo, 2, '.', '');

				                    //Si el tipo de moneda de la orden de compra es diferente a la moneda del pago
									if($intMonedaID !== $intMonedaIDPago )
									{
										//Convertir importe a peso mexicano
										$intSaldoAux = $intSaldoAux *  $intTipoCambio;

										//Si el tipo de moneda de la orden de compra corresponde a peso mexicano
									    if($intMonedaID == MONEDA_BASE)
										{
											//Convertir peso mexicano a tipo de cambio
											$intSaldoAux = $intSaldoAux / $intTipoCambioPago;
										}
									}


									//Si la fecha de vencimiento es menor que la fecha de corte
				                    if ($dteFechaVencimiento < $dteFechaCorte)
				                    {
				                    	//Asignar saldo de la orden de compra
				                        $intSaldoVencido = $otdImportesTasa->saldo;
				                        //Incrementar acumulado del saldo vencido
				                        $intAcumSaldoVencido += $intSaldoAux;
				                    }
				                    

					                //Si la tasa de cuota es de tipo RANGO y su factor es Cuota
									if($strTipoTasaCuotaIeps == 'RANGO' && $strFactorTasaCuotaIeps == 'Cuota')
									{
										//Sumarle al subtotal el importe de ieps
										$intSubtotalOrdenCompra += $intIepsOrdenCompra;
										//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
							   	 		$intIepsOrdenCompra = 0;
									}

					                   
				                    //Definir valores del array auxiliar de información (para cada orden de compra)
									$arrAuxiliar["referencia_id"] = $arrCol->referencia_id;
									$arrAuxiliar["tipo_referencia"] = $arrCol->tipo_referencia;
									$arrAuxiliar["folio"] = $arrCol->folio;
									$arrAuxiliar["moneda_id"] =  $intMonedaID;
									$arrAuxiliar["moneda_tipo"] = $arrCol->moneda_tipo;
									$arrAuxiliar["tipo_cambio"] = $intTipoCambio;
									$arrAuxiliar["fecha"] = $arrCol->fecha_format;
									$arrAuxiliar["vencimiento"] = $arrCol->fecha_vencimiento_format;
									$arrAuxiliar["subtotal"] = number_format($intSubtotalOrdenCompra, $this->intNumDecimales);
									$arrAuxiliar["tasa_cuota_iva"] = $arrTasa->tasa_cuota_iva;
									$arrAuxiliar["porcentaje_iva"] = $arrTasa->porcentaje_iva;
									$arrAuxiliar["iva"] = number_format($otdImportesTasa->iva, $this->intNumDecimalesIvaUnitario);
									$arrAuxiliar["tasa_cuota_ieps"] = $arrTasa->tasa_cuota_ieps;
									$arrAuxiliar["porcentaje_ieps"] = $arrTasa->porcentaje_ieps;
									$arrAuxiliar["ieps"] = number_format($intIepsOrdenCompra, $this->intNumDecimalesIepsUnitario);
									$arrAuxiliar["importe"] = number_format($otdImportesTasa->importe, 2);
									$arrAuxiliar["importe_auxiliar"] = $otdImportesTasa->importe;
									$arrAuxiliar["saldo"] = number_format($otdImportesTasa->saldo, 2);
									$arrAuxiliar["saldo_auxiliar"] = $otdImportesTasa->saldo;
									$arrAuxiliar["saldo_vencido"] = number_format($intSaldoVencido, 2);
									$arrAuxiliar["tipo_ieps"] = $strTipoTasaCuotaIeps;
									$arrAuxiliar["factor_ieps"] = $strFactorTasaCuotaIeps;
									//Asignar datos al array
				                    array_push($arrOrdenesCompra, $arrAuxiliar); 

				                    //Incrementar acumulado del saldo
				                    $intAcumSaldo += $intSaldoAux;

								}//Cierre de verificación del saldo

							}//Cierre de verificación de importe y saldo de la orden	

						}//Cierre de foreach tasas de los detalles de la orden de compra

					}//Cierre de verificación de tasas de los detalles de la orden de compra
				}//Cierre de verificación del saldo
				
			}//Cierre de foreach ordenes de compra

			$arrDatos['rows'] = $arrOrdenesCompra;

			//Seleccionar el total de anticipos del proveedor
			$otdAnticipos = $this->pagos->buscar_anticipo_ordenes_compra_adeudos('grid_view',
																				 $dteFechaCorte, 
																		   		 $intProveedorID);
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

						//Si el tipo de moneda de la orden de compra corresponde a peso mexicano
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

}