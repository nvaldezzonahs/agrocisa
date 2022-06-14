<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movimientos_bancarios extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo de movimientos bancarios
		$this->load->model('cuentas_pagar/movimientos_bancarios_model', 'movimientos');
		//Cargamos el modelo de cuentas bancarias
		$this->load->model('cuentas_pagar/cuentas_bancarias_model', 'cuentas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('cuentas_pagar/movimientos_bancarios', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->movimientos->filtro($this->input->post('dteFechaInicial'),
										 $this->input->post('dteFechaFinal'),
										 $this->input->post('intCuentaBancariaID'),
										 $this->input->post('strEstatus'),
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
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
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
					//Asignar cadena vacia para mostrar botón Restaurar
					$arrDet->mostrarAccionRestaurar = '';
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
		$objMovimientoBancario = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Datos del movimiento bancario
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objMovimientoBancario->intMovimientoBancarioID = $this->input->post('intMovimientoBancarioID');
		$objMovimientoBancario->dteFecha = $this->input->post('dteFecha');
		$objMovimientoBancario->strTipo = $this->input->post('strTipo');
		$objMovimientoBancario->intMovimientoBancarioTipoID = $this->input->post('intMovimientoBancarioTipoID');
		$objMovimientoBancario->intCuentaBancariaID = $this->input->post('intCuentaBancariaID');
		$objMovimientoBancario->intSubtotal = $this->input->post('intSubtotal');
		$objMovimientoBancario->intTasaCuotaIva = $this->input->post('intTasaCuotaIva');
		$objMovimientoBancario->intIva = $this->input->post('intIva');
		$objMovimientoBancario->strConcepto = mb_strtoupper( $this->input->post('strConcepto') );
		$objMovimientoBancario->strObservaciones = mb_strtoupper($this->input->post('strObservaciones'));
		$objMovimientoBancario->intUsuarioID = $this->session->userdata('usuario_id');
	   //Datos de los detalles
		$objMovimientoBancario->arrDetalles = json_decode($this->input->post('arrDetalles'));
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objMovimientoBancario->intMovimientoBancarioID))
		{
			$bolResultado = $this->movimientos->modificar($objMovimientoBancario);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objMovimientoBancario->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objMovimientoBancario->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{	
				$bolResultado = $this->movimientos->guardar($objMovimientoBancario); 
				
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
		$intID = $this->input->post('intMovimientoBancarioID');

		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->movimientos->buscar($intID);

		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{	
			$arrDatos['row'] = $otdResultado;
			//Seleccionar los detalles del registro
			$otdDetalles = $this->movimientos->buscar_detalles($intID);
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
		$this->form_validation->set_rules('intMovimientoBancarioID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intMovimientoBancarioID');
		    $strEstatus = $this->input->post('strEstatus');
		    //Dependiendo del estatus cambiar su valor
	        //ACTIVO a INACTIVO o viceversa
			if ($strEstatus == "ACTIVO")
			{
				$strEstatus = "INACTIVO";
			}
			else
			{
				$strEstatus = "ACTIVO";
			}

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->movimientos->set_estatus($intID, $strEstatus);
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

	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $intCuentaBancariaID, $strEstatus, 
								$strDetalles, $strBusqueda = NULL) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		$strEstatus = trim(urldecode($strEstatus));
		//Array que se utiliza para asignar los estatus 
		$arrEstatus = array('ACTIVO', 'INACTIVO'); 
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->movimientos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, 
												   $intCuentaBancariaID, $strEstatus, $strBusqueda);
		//Si existe rango de fechas
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal  != '0000-00-00')
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
		$pdf->strLinea1=  'LISTADO DE MOVIMIENTOS BANCARIOS '.$strTituloRangoFechas;
		//Si existe id de la cuenta
		if($intCuentaBancariaID > 0)
		{
			//Seleccionar los datos del proveedor que coincide con el id
			$otdCuenta =  $this->cuentas->buscar($intCuentaBancariaID);
			$pdf->strLinea2 =  'CUENTA: '.utf8_decode($otdCuenta->cuenta.' - '.$otdCuenta->descripcion);
		}
	
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA', 'CUENTA', 'TIPO', 'CONCEPTO', 'IMPORTE', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(20, 20, 40, 15, 55, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'L', 'L', 'L', 'R', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('L', 'L', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(22, 123, 25);
		//Agregar la primer pagina
		$pdf->AddPage();
		
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);

		//Si hay información
		if ($otdResultado)
		{
			//Recorremos el arreglo para obtener la información de las ordenes de compra
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);

				//Calcular importe total
				$intTotal = $arrCol->subtotal + $arrCol->iva;

				//Agregar la información principal
				$pdf->Row(array($arrCol->folio, $arrCol->fecha, utf8_decode($arrCol->cuenta_bancaria),  
								 $arrCol->tipo, utf8_decode($arrCol->concepto),
								'$'.number_format($intTotal, 2),
								$arrCol->estatus), $pdf->arrAlineacion, 'ClippedCell');

				//Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
				//Moneda
				$pdf->Cell(12, 4, 'MONEDA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(7, 4, utf8_decode($arrCol->codigo_moneda), 0, 0, 'L', 0);
				//Tipo de movimiento
				$pdf->Cell(25, 4, 'TIPO DE MOVIMIENTO:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(147, 4, utf8_decode($arrCol->movimiento_bancario_tipo), 0, 0, 'L', 0);

		        //Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
					//Seleccionar los detalles del registro
					$otdDetalles = $this->movimientos->buscar_detalles($arrCol->movimiento_bancario_id);
					//Verificar si existe información de los detalles 
					if($otdDetalles)
					{
						$pdf->Ln(5);//Deja un salto de línea
						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraDetalles);
						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    	$pdf->Row(array($arrDet->cuenta, 
					    	  			       utf8_decode($arrDet->cuenta_descripcion),
					    	  			       '$'.number_format($arrDet->importe,2)),
					    				$arrAlineacionDetalles,'ClippedCell');
						}


					}
					
				}//Cierre de verificación de detalles
				
				$pdf->Ln(5);//Deja un salto de línea
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
		$pdf->Output('movimientos_bancarios.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro($intMovimientoBancarioID) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->movimientos->buscar($intMovimientoBancarioID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->movimientos->buscar_detalles($intMovimientoBancarioID);
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'movimiento_bancario_';
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
	        //---------- DATOS DEL MOVIMIENTO BANCARIO
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 42);
			$pdf->ClippedCell(185, 3, utf8_decode('MOVIMIENTO BANCARIO'), 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0); //establece el color de texto
			//Folio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, 46);
			$pdf->ClippedCell(10, 3, 'FOLIO');
			//Fecha
			$pdf->SetXY(80, 46);
			$pdf->ClippedCell(15, 3, 'FECHA');
			//Tipo
			$pdf->SetXY(160, 46);
			$pdf->ClippedCell(10, 3, 'TIPO');
			//Tipo de movimiento
			$pdf->SetXY(15, 49);
			$pdf->ClippedCell(35, 03, utf8_decode('TIPO DE MOVIMIENTO'));
			//Estatus
			$pdf->SetXY(160, 49);
			$pdf->ClippedCell(22, 03, 'ESTATUS');
			//Cuenta bancaria
			$pdf->SetXY(15, 52);
			$pdf->ClippedCell(22, 03, utf8_decode('CUENTA'));
			//Moneda
			$pdf->SetXY(160, 52);
			$pdf->ClippedCell(22, 03, 'MONEDA');
			//Concepto
			$pdf->SetXY(15, 55);
			$pdf->ClippedCell(22, 3, 'CONCEPTO');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(45, 46);
			$pdf->ClippedCell(30, 3, $otdResultado->folio);
			//Fecha
			$pdf->SetXY(96, 46);
			$pdf->ClippedCell(30, 3, $otdResultado->fecha);
			//Tipo
			$pdf->SetXY(180, 46);
			$pdf->ClippedCell(30, 3, $otdResultado->tipo);
			//Tipo de movimiento
			$pdf->SetXY(45, 49);
			$pdf->ClippedCell(110, 3, utf8_decode($otdResultado->movimiento_bancario_tipo));
			//Estatus
			$pdf->SetXY(180, 49);
			$pdf->ClippedCell(30, 3, $otdResultado->estatus);
			//Cuenta bancaria
			$pdf->SetXY(45, 52);
			$pdf->ClippedCell(155, 3, utf8_decode($otdResultado->cuenta_bancaria));
			//Moneda
			$pdf->SetXY(180, 52);
			$pdf->ClippedCell(30, 3, $otdResultado->codigo_moneda);
			//Concepto
			$pdf->SetXY(45, 55);
			$pdf->ClippedCell(155, 3, utf8_decode($otdResultado->concepto));


			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DEL MOVIMIENTO BANCARIO
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 60);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				//Tabla con los detalles del movimiento bancario
				$pdf->SetXY(15, 60);
				//Crea los titulos de la cabecera
				$arrCabecera = array('Cuenta', utf8_decode('Descripción'), 'Importe');
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(22, 138, 25);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'R');
				//Recorre el array de títulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchura[$intCont], 3, $arrCabecera[$intCont], 1, 0, $arrAlineacion[$intCont], TRUE);
				}
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
				
				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDet)
				{ 
					$pdf->SetX(15);
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchura);
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(utf8_decode($arrDet->cuenta),
								    utf8_decode($arrDet->cuenta_descripcion), 
								    '$'.number_format($arrDet->importe,2)), 
									$arrAlineacion, 'ClippedCell');
				}

			}//Cierre de verificación de detalles

			//Asignar subtotal
			$intAcumSubtotal = $otdResultado->subtotal;
			//Asignar importe de IVA
			$intAcumIva =  $otdResultado->iva;

			//Calcular importe total
			$intTotal = $intAcumSubtotal + $intAcumIva;

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
			$pdf->SetX(175);
			$pdf->ClippedCell(25, 3, '$'.number_format($intAcumSubtotal, 2), 0, 0, 'R');
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
			$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIva, 2), 0, 0, 'R');
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
			$pdf->MultiCell(110, 3, utf8_decode($otdResultado->observaciones));
			//Persona que recibio el movimiento bancario
			$pdf->SetXY(15,260);
            //Persona que reviso el movimiento bancario
            $pdf->SetXY(109, 260);
            $pdf->Ln(5);//Espacios de salto de línea
            $pdf->SetX(15);
            //Asigna el tipo y tamaño de letra
            $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
            $pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
            $pdf->Cell(90, 3, 'RECIBIO', 0, 0, 'C',  TRUE);
            //Persona que reviso el anticipo
            $pdf->SetXY(109, 265);
            $pdf->Cell(90, 3, 'REVISO', 0, 0, 'C',  TRUE);

			//Fecha y hora de impresión (pie de pagina)
			$pdf->strUsuarioCreacion = $otdResultado->usuario_creacion;
			$pdf->dteFechaCreacion = $otdResultado->fecha_creacion;
			$pdf->strIncluirMembrete = 'SI';

			//Concatenar folio para identificar movimiento
			$strNombreArchivo .= $otdResultado->folio;

		}//Cierre de verificación de información

		//Ejecutar la salida del reporte
		$pdf->Output($strNombreArchivo.'.pdf','I'); 

	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $intCuentaBancariaID,
						    $strEstatus, $strDetalles, $strBusqueda = NULL) 
	{	

		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		$strEstatus = trim(urldecode($strEstatus));

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
		$otdResultado = $this->movimientos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intCuentaBancariaID,
											   $strEstatus, $strBusqueda);

		//Si existe rango de fechas
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal  != '0000-00-00')
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
			     ->setCellValue('A7', 'LISTADO DE MOVIMIENTOS BANCARIOS '.$strTituloRangoFechas);
		    
		//Si existe id de la cuenta bancaria
		if($intCuentaBancariaID > 0)
		{   //Seleccionar los datos de la cuenta bancaria que coincide con el id
			$otdCuenta =  $this->cuentas->buscar($intCuentaBancariaID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'CUENTA: '.$otdCuenta->cuenta.' - '.$otdCuenta->descripcion);
		}
		

		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('C'.$intPosEncabezados, 'CUENTA')
        		 ->setCellValue('D'.$intPosEncabezados, 'TIPO')
        		 ->setCellValue('E'.$intPosEncabezados, 'TIPO DE MOVIMIENTO')
        		 ->setCellValue('F'.$intPosEncabezados, 'CONCEPTO')
        		 ->setCellValue('G'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('H'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('I'.$intPosEncabezados, 'TOTAL')
        		 ->setCellValue('J'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('K'.$intPosEncabezados, 'OBSERVACIONES')
                 ->setCellValue('L'.$intPosEncabezados, 'ESTATUS');
        
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
       			 ->mergeCells('A8:L8');

       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A8:L8')
        		 ->applyFromArray($arrStyleBold);

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A10:L10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:L10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:L10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

         //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	//Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('M'.$intPosEncabezados, 'CUENTA')
			         ->setCellValue('N'.$intPosEncabezados, 'DESCRIPCIÓN')
			         ->setCellValue('O'.$intPosEncabezados, 'IMPORTE');

			//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('M'.$intPosEncabezados.':O'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		//Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('M'.$intPosEncabezados.':O'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('M'.$intPosEncabezados.':O'.$intPosEncabezados)
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
				//Calcular importe total
				$intTotal = $arrCol->subtotal + $arrCol->iva;

				//Seleccionar los detalles del registro
				$otdDetalles = $this->movimientos->buscar_detalles($arrCol->movimiento_bancario_id);

				//Verificar si existe información de los detalles 
				if($otdDetalles && $strDetalles == 'SI')
				{
					//Variable que se utiliza para contar el número de detalles
				    $intContDetMov = 0;

				    //Asignar el número de detalles
				    $intNumDetalles = count($otdDetalles);
				    
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
                        //Agregar datos al array
			        	$arrDetalles[$intContDetMov]['cuenta'] = $arrDet->cuenta;
			        	$arrDetalles[$intContDetMov]['cuenta_descripcion'] = $arrDet->cuenta_descripcion;
			        	$arrDetalles[$intContDetMov]['importe'] = $arrDet->importe;

						//Incrementar el contador por cada registro
	                    $intContDetMov++;
					}

				}//Cierre de verificación de detalles

			    //Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    {

					//Hacer recorrido para obtener información del registro
				    //La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('B'.$intFila, $arrCol->fecha)
	                         ->setCellValue('C'.$intFila, $arrCol->cuenta_bancaria)
	                         ->setCellValue('D'.$intFila, $arrCol->tipo)
	                         ->setCellValue('E'.$intFila, $arrCol->movimiento_bancario_tipo)
	                         ->setCellValue('F'.$intFila, $arrCol->concepto)
	                         ->setCellValue('G'.$intFila, $arrCol->subtotal)
	                         ->setCellValue('H'.$intFila, $arrCol->iva)
	                         ->setCellValue('I'.$intFila, $intTotal)
	                         ->setCellValue('J'.$intFila, $arrCol->moneda)
	                         ->setCellValue('K'.$intFila, $arrCol->observaciones)
	                         ->setCellValue('L'.$intFila, $arrCol->estatus);

	                 //Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
						 		 ->setCellValue('M'.$intFila, $arrDetalles[$intContDet]['cuenta'])
						 		 ->setCellValue('N'.$intFila, $arrDetalles[$intContDet]['cuenta_descripcion'])
						 		 ->setCellValue('O'.$intFila, $arrDetalles[$intContDet]['importe']);
					}
					
					//Incrementar el indice para escribir los datos del siguiente registro
                    $intFila++;
	               
                }
			    
                //Incrementar el contador por cada registro
				$intContador++;
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('G'.$intFilaInicial.':'.'I'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            $objExcel->getActiveSheet()
            		 ->getStyle('P'.$intFilaInicial.':'.'P'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            //Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
		        	 ->getStyle('G'.$intFilaInicial.':'.'I'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			$objExcel->getActiveSheet()
                	 ->getStyle('L'.$intFilaInicial.':'.'L'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
		        	 ->getStyle('O'.$intFilaInicial.':'.'O'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);
                	 

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('L'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('L'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'movimientos_bancarios.xls', 'movimientos bancarios', $intFila);
	}
}