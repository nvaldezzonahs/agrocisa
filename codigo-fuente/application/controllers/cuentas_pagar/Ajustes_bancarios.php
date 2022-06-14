<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajustes_bancarios extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('cuentas_pagar/ajustes_bancarios_model', 'ajustes');
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
		$this->cargar_vista('cuentas_pagar/ajustes_bancarios', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->ajustes->filtro($this->input->post('dteFechaInicial'),
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
		foreach ($result['ajustes'] as $arrDet)
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
		$arrDatos = array('rows' => $result['ajustes'],
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
		$objAjusteBancario = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objAjusteBancario->intAjusteBancarioID = $this->input->post('intAjusteBancarioID');
		$objAjusteBancario->strFolioConsecutivo = $this->input->post('strFolioConsecutivo');
		$objAjusteBancario->dteFecha = $this->input->post('dteFecha');
		$objAjusteBancario->intMonedaID = $this->input->post('intMonedaID');
		$objAjusteBancario->intTipo = mb_strtoupper( $this->input->post('intTipo') );
		$objAjusteBancario->strConcepto = mb_strtoupper( $this->input->post('strConcepto') );
		$objAjusteBancario->strObservaciones = mb_strtoupper($this->input->post('strObservaciones'));
		$objAjusteBancario->intCuentaBancariaID = $this->input->post('intCuentaBancariaID');
		$objAjusteBancario->intSubtotal = $this->input->post('intSubtotal');
		$objAjusteBancario->intTasaCuotaIva = $this->input->post('intTasaCuotaIva');
		$objAjusteBancario->intIva = $this->input->post('intIva');
		$objAjusteBancario->intUsuarioID = $this->session->userdata('usuario_id');
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objAjusteBancario->intAjusteBancarioID))
		{
			$bolResultado = $this->ajustes->modificar($objAjusteBancario);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objAjusteBancario->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objAjusteBancario->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{	
				$bolResultado = $this->ajustes->guardar($objAjusteBancario); 
				
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
		$intID = $this->input->post('intAjusteBancarioID');

		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->ajustes->buscar($intID, NULL, NULL);

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
		$this->form_validation->set_rules('intAjusteBancarioID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intAjusteBancarioID');
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
			$bolResultado = $this->ajustes->set_estatus($intID, $strEstatus);
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
		//Array que se utiliza para asignar los estatus 
		$arrEstatus = array('ACTIVO', 'INACTIVO'); 
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->ajustes->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intCuentaBancariaID,
											   $strEstatus, $strBusqueda);
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
		$pdf->strLinea1=  'LISTADO DE AJUSTES BANCARIOS '.$strTituloRangoFechas;
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
	    $arrAlineacionDetalles = array('L');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(190);
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
				$pdf->Row(array($arrCol->folio, $arrCol->fecha, utf8_decode($arrCol->cuenta),  
								 $arrCol->tipo, utf8_decode($arrCol->concepto),
								'$'.number_format($intTotal, 2, '.', ','),
								$arrCol->estatus), $pdf->arrAlineacion, 'ClippedCell');

		        //Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraDetalles);
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array('OBSERVACIONES: ' . $strObservaciones),
					    			$arrAlineacionDetalles, NULL, 'SI');
					$pdf->Ln(2);//Deja un salto de línea
					
				}//Cierre de verificación de detalles
				
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
		$pdf->Output('ajustes_bancarios.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro($intAjusteBancarioID) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para contar el número de asistentes
		$intContador = 0;
		//Seleccionar los datos del evento que coincide con el id
		$otdAjuste = $this->ajustes->buscar($intAjusteBancarioID);
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1=  '';
		//Variable que se utiliza para asignar descripción del evento (y poder identificar reporte)
		$strDescripcion = '';
		//Agregar la primer pagina
		$pdf->AddPage();
		//Verificar si hay información del registro
		if($otdAjuste)
		{

			//Cambiar color de relleno de la celda
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(190, 3, utf8_decode('AJUSTE BANCARIO'), 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0);//establece el color de texto
			 $pdf->Ln();//Deja un salto de línea
			
			//----------------------------------------------------------------------
			//Folio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'FOLIO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(42, 5, utf8_decode($otdAjuste->folio), 0, 0, 'L', 0);
			//Fecha
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(15, 5, 'FECHA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(40, 5, utf8_decode($otdAjuste->fecha), 0, 0, 'L', 0);
			//Moneda
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(20, 5, utf8_decode('MONEDA'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(40, 5, utf8_decode($otdAjuste->codigo_moneda), 0, 1, 'L', 0);

			//-----------------------------------------------------------------------
			//Cuenta
	        //Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'CUENTA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(157, 5, utf8_decode($otdAjuste->cuenta), 0, 1, 'L', 0);

			//----------------------------------------------------------------------
			//Subtotal
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'SUBTOTAL', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(42, 5, '$'.number_format($otdAjuste->subtotal, 2, '.', ','), 0, 0, 'L', 0);
			//IVA
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(15, 5, 'IVA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(40, 5, '$'.number_format($otdAjuste->iva, 2, '.', ','), 0, 0, 'L', 0);
			//IMPORTE TOTAL
			//Calcular importe total
			$intTotal = $otdAjuste->subtotal + $otdAjuste->iva;

			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(20, 5, utf8_decode('TOTAL'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(40, 5, '$'.number_format($intTotal, 2, '.', ','), 0, 1, 'L', 0);

			//-----------------------------------------------------------------------
			//Concepto
	        //Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'CONCEPTO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(97, 5, utf8_decode($otdAjuste->concepto), 0, 0, 'L', 0);
			//Tipo
	        //Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(20, 5, 'TIPO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(40, 5, utf8_decode($otdAjuste->tipo), 0, 1, 'L', 0);


			//-----------------------------------------------------------------------
			//Observaciones
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'OBSERVACIONES', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(157, 5, utf8_decode($otdAjuste->observaciones), 0, 1, 'L', 0);

			$pdf->SetXY(15,260);
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
            $pdf->Ln(5);//Espacios de salto de línea
            //Fecha y hora de impresión
            $intPosY = $pdf->GetY();
            $pdf->SetXY(109,$intPosY);
            $pdf->SetTextColor(0);//establece el color de texto
            //Seleccionar la fecha en español
            setlocale(LC_ALL,"es_ES");
            //Asignar fecha actual Ejemplo: 09/08/2017
            $dteFecha = strftime("%d/%m/%Y");
            //Cadena concatenada con la fecha y hora actual (a se utiliza para 
            //antes del mediodía, despues del mediodía, am o pm (minúsculas))
            $dteFecha = $dteFecha.' '.date("h:i:s a");
            //se crea una cadena con acentos y tildes correctamente para colocarlo en el pie de pagina
            $strPiePagina = utf8_decode('IMPRESO: '.$dteFecha.'    CAPTURO: '.$otdAjuste->usuario_creacion);
            $pdf->ClippedCell(90, 5, $strPiePagina, 0, 0, 'R');				

		}//Cierre de verificación de información

		//Ejecutar la salida del reporte
		$pdf->Output('ajuste_bancario_'.$otdAjuste->folio.'.pdf','I');

	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $intCuentaBancariaID,
						    $strEstatus, $strDetalles, $strBusqueda = NULL) 
	{	
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
		$otdResultado = $this->ajustes->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intCuentaBancariaID,
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
			     ->setCellValue('A7', 'LISTADO DE AJUSTES BANCARIOS '.$strTituloRangoFechas);
		    
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
        		 ->setCellValue('E'.$intPosEncabezados, 'CONCEPTO')
        		 ->setCellValue('F'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('G'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('H'.$intPosEncabezados, 'IMPORTE')
        		 ->setCellValue('I'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('J'.$intPosEncabezados, 'OBSERVACIONES')
                 ->setCellValue('K'.$intPosEncabezados, 'ESTATUS');
        
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
       			 ->mergeCells('A8:K8');

       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A8:K8')
        		 ->applyFromArray($arrStyleBold);

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A10:K10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:K10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:K10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

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

				//Hacer recorrido para obtener información del registro
			    //La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
				 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->fecha)
                         ->setCellValue('C'.$intFila, $arrCol->cuenta)
                         ->setCellValue('D'.$intFila, $arrCol->tipo)
                         ->setCellValue('E'.$intFila, $arrCol->concepto)
                         ->setCellValue('F'.$intFila, $arrCol->subtotal)
                         ->setCellValue('G'.$intFila, $arrCol->iva)
                         ->setCellValue('H'.$intFila, $intTotal)
                         ->setCellValue('I'.$intFila, $arrCol->moneda)
                         ->setCellValue('J'.$intFila, $arrCol->observaciones)
                         ->setCellValue('K'.$intFila, $arrCol->estatus);

                $intFila++; 
			    
                //Incrementar el contador por cada registro
				$intContador++;
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('F'.$intFilaInicial.':'.'H'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            //Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
		        	 ->getStyle('F'.$intFilaInicial.':'.'H'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			$objExcel->getActiveSheet()
                	 ->getStyle('K'.$intFilaInicial.':'.'K'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
                	 

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('K'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('K'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'ajustes_bancarios.xls', 'ajustes bancarios', $intFila);
	}
}