<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movimientos_salidas_refacciones_internas_por_ajuste extends MY_Controller {
	
	//Variable para identificar el tipo de movimiento
	var $intTipoMovimiento = SALIDA_REFACCIONES_INTERNAS_POR_AJUSTE;
	
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo de movimientos de refacciones internas
		$this->load->model('control_vehiculos/movimientos_refacciones_internas_model', 'movimientos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('control_vehiculos/movimientos_salidas_refacciones_internas_por_ajuste', $arrDatos);
	}

	/*******************************************************************************************************************
	Funciones de la tabla movimientos_refacciones_internas
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->movimientos->filtro_salida_por_ajuste($this->intTipoMovimiento, 
													$this->input->post('dteFechaInicial'), 
													$this->input->post('dteFechaFinal'),
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
            $arrDet->estiloRegistro = '';
            
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
					
				$arrDet->estiloRegistro = 'registro-INACTIVO';
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
		//Variables que se utilizan para recuperar los valores de la vista 
		//Datos del movimiento
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$intMovimientoRefaccionesInternasID = $this->input->post('intMovimientoRefaccionesInternasID');
		$dteFecha = $this->input->post('dteFecha');
		$strObservaciones = mb_strtoupper($this->input->post('strObservaciones'));
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Datos de los detalles
		$strRefaccionInternaID = $this->input->post('strRefaccionInternaID');
		$strCantidades = $this->input->post('strCantidades'); 
		$strPreciosUnitarios = $this->input->post('strPreciosUnitarios'); 
		$strDescuentosUnitarios = $this->input->post('strDescuentosUnitarios'); 
		$strIvasUnitarios = $this->input->post('strIvasUnitarios'); 
		$strIepsUnitarios = $this->input->post('strIepsUnitarios');
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($intMovimientoRefaccionesInternasID))
		{

			$bolResultado = $this->movimientos->modificar_salida_por_ajuste($intMovimientoRefaccionesInternasID, 
																  $this->intTipoMovimiento, 
																  $dteFecha,
															      $strObservaciones, 
															      $strRefaccionInternaID, 
															      $strCantidades, 
															      $strPreciosUnitarios, 
															      $strDescuentosUnitarios, 
															      $strIvasUnitarios, 
															      $strIepsUnitarios);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{	
				$bolResultado = $this->movimientos->guardar_salida_por_ajuste($strFolio, 
																	$this->intTipoMovimiento, 
																	$dteFecha, 
																    $strObservaciones, 
																    $strRefaccionInternaID, 
																    $strCantidades, 
																    $strPreciosUnitarios, 
																    $strDescuentosUnitarios, 
																    $strIvasUnitarios, 
																    $strIepsUnitarios); 

				//Quitar '_'  de la cadena (resultadoTransaccion_movimientoRefaccionesInternasID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
			    list($bolResultado, $intMovimientoRefaccionesInternasID) = explode("_", $bolResultado); 
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
							 	  'movimiento_refacciones_internas_id' => $intMovimientoRefaccionesInternasID,
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
		$intID = $this->input->post('intMovimientoRefaccionesInternasID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->movimientos->buscar_salida_por_ajuste($intID);
	  
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
			//Seleccionar los detalles del registro
			$otdDetalles = $this->movimientos->buscar_detalles_salida_por_ajuste($intID);
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
		$this->form_validation->set_rules('intMovimientoRefaccionesInternasID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intMovimientoRefaccionesInternasID');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->movimientos->set_estatus($intID);
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
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $strDetalles) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->movimientos->buscar_salida_por_ajuste(NULL, $this->intTipoMovimiento, $dteFechaInicial, $dteFechaFinal);

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
		$pdf->strLinea1 =  'LISTADO DE SALIDAS DE REFACCIONES INTERNAS POR AJUSTE '.$strTituloRangoFechas;
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA', 'CANTIDAD', 'DESCUENTO', 'SUBTOTAL', 
								  'IVA', 'IEPS', 'TOTAL', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(25, 25, 20, 20, 20, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'R', 'R', 'R', 'R', 'R', 'R', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('L', 'L', 'R', 'R', 'R', 'R', 'R', 'R', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(40, 10, 20, 20, 20, 20, 20, 20, 20, 20);
		//Agregar la primer pagina
		$pdf->AddPage();
		//Si hay información
		if ($otdResultado)
		{	
			
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

				//Seleccionar los detalles del registro
				$otdDetalles = $this->movimientos->buscar_detalles_salida_por_ajuste($arrCol->movimiento_refacciones_internas_id);
				
				
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{

					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{

						//Variables que se utilizan para asignar valores del detalle
						$intCantidad = $arrDet->cantidad;
						$intPrecioUnitario = $arrDet->precio_unitario;
						$intDescuentoUnitario = $arrDet->descuento_unitario;
						$intIvaUnitario = $arrDet->iva_unitario;
						$intIepsUnitario = $arrDet->ieps_unitario;

						//Calcular subtotal
						$intSubTotalUnitario = $intCantidad * $intPrecioUnitario;
						$intSubTotalUnitario = $intSubTotalUnitario - $intDescuentoUnitario;

						//Calcular importe total
						$intTotal = $intSubTotalUnitario + $intIvaUnitario + $intIepsUnitario;

						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["codigo_descripcion"] = utf8_decode($arrDet->codigo).'-'.utf8_decode($arrDet->descripcion);
						$arrAuxiliar["unidad"] = utf8_decode($arrDet->unidad);
						$arrAuxiliar["cantidad"] = number_format($intCantidad, 2);
						$arrAuxiliar["precio_unitario"] = '$'.number_format($intPrecioUnitario, 2);
						$arrAuxiliar["descuento"] = '$'.number_format($intDescuentoUnitario, 2);
						$arrAuxiliar["subtotal"] = '$'.number_format($intSubTotalUnitario, 2);
						$arrAuxiliar["iva"] = '$'.number_format($intIvaUnitario, 2);
		                $arrAuxiliar["ieps"] = '$'.number_format($intIepsUnitario, 2);
		                $arrAuxiliar["total"] = '$'.number_format($intTotal, 2);

		                //Asignar datos al array
                        array_push($arrDetalles, $arrAuxiliar); 

					}

				}//Cierre de verificación de detalles

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, 
								$arrCol->fecha, 
								number_format($arrCol->cantidad, 2),  
								'$'.number_format($arrCol->descuento, 2), 
								'$'.number_format($arrCol->subtotal, 2),
								'$'.number_format($arrCol->iva, 2), 
								'$'.number_format($arrCol->ieps, 2),
								'$'.number_format($arrCol->importe, 2), 
								$arrCol->estatus), $pdf->arrAlineacion, 'ClippedCell');
		        
				//Si se cumple la sentencia mostrar detalles del registro
				if($arrDetalles && $strDetalles == 'SI')
				{
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraDetalles);
					//Recorremos el arreglo 
			        foreach ($arrDetalles as $arrDet) 
			        {
					   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array($arrDet['codigo_descripcion'], 
					    				$arrDet['unidad'], 
					    				$arrDet['cantidad'], 
					    				$arrDet['precio_unitario'], 
					    				$arrDet['descuento'],  
					    				$arrDet['subtotal'],
					    				$arrDet['iva'],
					    				$arrDet['ieps'],
					    				$arrDet['total']), 
					    		        $arrAlineacionDetalles, 'ClippedCell');
					}
				}//Cierre de verificación de detalles

				//Incrementar el contador por cada registro
				$intContador++;
			}

		}
		//Ejecutar la salida del reporte
		$pdf->Output('salidas_refacciones_internas_por_ajuste.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro($intMovimientoRefaccionesInternasID) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->movimientos->buscar_salida_por_ajuste($intMovimientoRefaccionesInternasID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->movimientos->buscar_detalles_salida_por_ajuste($intMovimientoRefaccionesInternasID, $this->intTipoMovimiento);
		
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
		$strNombreArchivo  = 'salida_refacciones_internas_por_ajuste_';
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
	        //---------- DATOS DEL MOVIMIENTO
	        //------------------------------------------------------------------------------------------------------------------------
			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL MOVIMIENTO DE SALIDA POR AJUSTE DE REFACCIONES INTERNAS
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 42);
			$pdf->ClippedCell(185, 3, utf8_decode('SALIDA DE REFACCIONES INTERNAS POR AJUSTE'), 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0);//establece el color de texto
			//Folio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, 46);
			$pdf->ClippedCell(15, 3, 'FOLIO');
			//Fecha 
			$pdf->SetXY(15, 49);
			$pdf->ClippedCell(15, 3, 'FECHA');
			//Estatus
			$pdf->SetXY(15, 52);
			$pdf->ClippedCell(32, 3, 'ESTATUS');
			//Observaciones
			$pdf->SetXY(15, 55);
			$pdf->ClippedCell(32, 3, 'OBSERVACIONES');

			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(40, 46);
			$pdf->ClippedCell(76, 3, $otdResultado->folio);
			//Fecha
			$pdf->SetXY(40, 49);
			$pdf->ClippedCell(29, 3, $otdResultado->fecha);
			//Estatus
			$pdf->SetXY(40, 52);
			$pdf->ClippedCell(60, 3, $otdResultado->estatus);
			//Observaciones
			$pdf->SetXY(40, 55);
			$pdf->ClippedCell(60, 3, $otdResultado->observaciones);

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DEL MOVIMIENTO
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 60);
			$pdf->ClippedCell(185, 3, 'CONCEPTOS', 0, 0, 'C', TRUE);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			
			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				//Tabla con los detalles del movimiento
				$pdf->SetXY(15, 64);
				//Crea los titulos de la cabecera
				//$arrCabecera = array('Cantidad', utf8_decode('Código'), 'Unidad', utf8_decode('Descripción'), 'Unitario', 'Descuento', 'Importe');
				$arrCabecera = array(utf8_decode('Código'), utf8_decode('Descripción'), 'Unidad', 'Cantidad', 'P. Unitario', 'Descuento', 'Subtotal', 'IVA', 'IEPS', 'Importe');

				//Establece el ancho de las columnas de cabecera
				//$arrAnchura = array(15, 20, 20, 55, 25, 25, 25);
				$arrAnchura = array(15, 32, 15, 15, 18, 18, 18, 18, 18, 18);

				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'C', 'C', 'L', 'L', 'L', 'L', 'L', 'L');
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
					$intPrecioUnitario = ($arrDet->precio_unitario);
					$intDescuentoUnitario = ($arrDet->descuento_unitario);
					$intIvaUnitario = ($arrDet->iva_unitario);
					$intIepsUnitario = ($arrDet->ieps_unitario);
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

					$intTotalReg = $intSubTotalUnitario + $intIvaUnitario + $intIepsUnitario;
				
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(utf8_decode($arrDet->codigo),
									utf8_decode($arrDet->descripcion),
									utf8_decode($arrDet->unidad),  
									number_format($intCantidad, 2), 
									number_format($intPrecioUnitario, 6), 
									number_format($intDescuentoUnitario, 6),
									number_format($intSubTotalUnitario, 6),
									number_format($intIvaUnitario, 6),
									number_format($intIepsUnitario, 6),
									number_format($intTotalReg, 6)), $arrAlineacion, 'ClippedCell');

					//Incrementar acumulados
					$intAcumSubtotal += $intSubTotalUnitario;
					$intAcumIva += $intIvaUnitario;
					$intAcumIeps += $intIepsUnitario;
					
				}

				//Calcular importe total
				$intTotal = $intAcumSubtotal + $intAcumIva + $intAcumIeps;

				//Redondear importe total a dos decimales
				$intTotal = number_format($intTotal, 2);

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
				$pdf->MultiCell(185, 3, 'SON: (' .$AifLibNumber->toCurrency($intTotal) . ')');
				$pdf->SetX(15);
				$pdf->ClippedCell(185, 3, '', 0, 0, 'C', TRUE);
				$pdf->Ln(); //Deja un salto de línea
				
				//Subtotal
				$pdf->SetX(135);
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(30, 3, 'SUBTOTAL');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumSubtotal,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();
				
				//IVA
				$pdf->SetX(135);
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(30, 3, 'IVA');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIva,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();

				//IEPS
				$pdf->SetX(135);
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(30, 3, 'IEPS');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIeps,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();		

				//Total
				//Asigna el tipo y tamaño de letra
				$pdf->SetX(135);
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(30, 3, 'TOTAL');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.$intTotal, 0, 0, 'R');

			   //Persona que recibio
	            $pdf->SetXY(15,260);
	            //Persona que reviso
	            $pdf->SetXY(109, 260);
	            $pdf->Ln(5);//Espacios de salto de línea
	            $pdf->SetX(15);
	            //Persona que recibio entrada
	            //Asigna el tipo y tamaño de letra
	            $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
	            $pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
	            $pdf->Cell(90, 3, 'RECIBIO', 0, 0, 'C',  TRUE);
	            //Persona que reviso la entrada
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
	            $strPiePagina = utf8_decode('IMPRESO: '.$dteFecha.'    CAPTURO: '.$otdResultado->usuario_creacion);
	            $pdf->ClippedCell(90, 5, $strPiePagina, 0, 0, 'R');

			}//Cierre de verificación de detalles

			//Concatenar folio para identificar movimiento
			$strNombreArchivo .= $otdResultado->folio;

		}//Cierre de verificación de información

		//Ejecutar la salida del reporte
		$pdf->Output($strNombreArchivo.'.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $strDetalles) 
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
		$otdResultado = $this->movimientos->buscar_salida_por_ajuste(NULL, $this->intTipoMovimiento, $dteFechaInicial, $dteFechaFinal);

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
		$objExcel->setActiveSheetIndex(0)->setCellValue('A7', 'LISTADO DE SALIDAS DE REFACCIONES INTERNAS POR AJUSTE '.$strTituloRangoFechas);

		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('C'.$intPosEncabezados, 'CANTIDAD')
        		 ->setCellValue('D'.$intPosEncabezados, 'DESCUENTO')
        		 ->setCellValue('E'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('F'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('G'.$intPosEncabezados, 'IEPS')
        		 ->setCellValue('H'.$intPosEncabezados, 'TOTAL')
                 ->setCellValue('I'.$intPosEncabezados, 'ESTATUS');      
                 
        //Definir estilos de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE, 'color' => array('rgb' => 'ffffff')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Combinar las siguientes celdas
       	$objExcel->setActiveSheetIndex(0)->mergeCells('A8:D8');

       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()->getStyle('A8:D8')->applyFromArray($arrStyleBold);

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()->getStyle('A10:I10')->getFill()->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()->getStyle('A10:I10')->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()->getStyle('A10:I10')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	
        	//Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('J'.$intPosEncabezados, 'CANTIDAD')
                     ->setCellValue('K'.$intPosEncabezados, 'CÓDIGO')
                     ->setCellValue('L'.$intPosEncabezados, 'DESCRIPCIÓN')
			         ->setCellValue('M'.$intPosEncabezados, 'UNIDAD')
			         ->setCellValue('N'.$intPosEncabezados,'PRECIO UNITARIO')
			         ->setCellValue('O'.$intPosEncabezados,'DESCUENTO UNITARIO')
			         ->setCellValue('P'.$intPosEncabezados,'IVA UNITARIO')
			         ->setCellValue('Q'.$intPosEncabezados, 'IEPS UNITARIO');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('J'.$intPosEncabezados.':Q'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('J'.$intPosEncabezados.':Q'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('J'.$intPosEncabezados.':Q'.$intPosEncabezados)
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
				$otdDetalles = $this->movimientos->buscar_detalles_salida_por_ajuste($arrCol->movimiento_refacciones_internas_id);

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
						$intPrecioUnitario = $arrDet->precio_unitario;
						$intDescuentoUnitario = $arrDet->descuento_unitario;
						$intIvaUnitario = $arrDet->iva_unitario;
						$intIepsUnitario = $arrDet->ieps_unitario;;

		                //Agregar datos al array
		                $arrDetalles[$intContDetMov]['cantidad'] = $intCantidad;
		                $arrDetalles[$intContDetMov]['codigo'] = $arrDet->codigo;
			        	$arrDetalles[$intContDetMov]['descripcion'] = $arrDet->descripcion;
			        	$arrDetalles[$intContDetMov]['unidad'] = $arrDet->unidad;
			        	$arrDetalles[$intContDetMov]['precio_unitario'] = $intPrecioUnitario;
			        	$arrDetalles[$intContDetMov]['descuento_unitario']= $intDescuentoUnitario;
			        	$arrDetalles[$intContDetMov]['iva_unitario'] =  $intIvaUnitario;
			        	$arrDetalles[$intContDetMov]['ieps_unitario'] = $intIepsUnitario;

						//Incrementar el contador por cada registro
	                    $intContDetMov++;
					}

				}//Cierre de verificación de detalles


				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    {
			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('B'.$intFila, $arrCol->fecha)
	                         ->setCellValueExplicit('C'.$intFila, $arrCol->cantidad)
	                         ->setCellValueExplicit('D'.$intFila, $arrCol->descuento)
	                         ->setCellValue('E'.$intFila, $arrCol->subtotal)
	                         ->setCellValue('F'.$intFila, $arrCol->iva)
	                         ->setCellValue('G'.$intFila, $arrCol->ieps)
	                         ->setCellValue('H'.$intFila, $arrCol->importe)
	                         ->setCellValue('I'.$intFila, $arrCol->estatus);

	                //Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
							 	 ->setCellValue('J'.$intFila, $arrDetalles[$intContDet]['cantidad'])
		                         ->setCellValueExplicit('K'.$intFila, $arrDetalles[$intContDet]['codigo'], PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValue('L'.$intFila, $arrDetalles[$intContDet]['descripcion'])
		                         ->setCellValue('M'.$intFila, $arrDetalles[$intContDet]['unidad'])
						         ->setCellValue('N'.$intFila, $arrDetalles[$intContDet]['precio_unitario'])
						         ->setCellValue('O'.$intFila, $arrDetalles[$intContDet]['descuento_unitario'])
						         ->setCellValue('P'.$intFila, $arrDetalles[$intContDet]['iva_unitario'])
						         ->setCellValue('Q'.$intFila, $arrDetalles[$intContDet]['ieps_unitario']);
					}

					//Incrementar el indice para escribir los datos del siguiente registro
	                $intFila++; 
			    }

                //Incrementar el contador por cada registro
				$intContador++;
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)->getNumberFormat()->setFormatCode('###0.0000');		 
           	$objExcel->getActiveSheet()->getStyle('D'.$intFilaInicial.':'.'H'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.000000');

            //Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)->getNumberFormat()->setFormatCode('###0.0000');		 
           	$objExcel->getActiveSheet()->getStyle('N'.$intFilaInicial.':'.'Q'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.000000');

			//Cambiar alineación de las siguientes celdas
           	$objExcel->getActiveSheet()->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
           	$objExcel->getActiveSheet()->getStyle('C'.$intFilaInicial.':'.'H'.$intFila)->getAlignment()->applyFromArray($arrStyleAlignmentRight);
           	$objExcel->getActiveSheet()->getStyle('I'.$intFilaInicial.':'.'I'.$intFila)->getAlignment()->applyFromArray($arrStyleAlignmentCenter);

    		$objExcel->getActiveSheet()->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)->getAlignment()->applyFromArray($arrStyleAlignmentRight);
		    $objExcel->getActiveSheet()->getStyle('N'.$intFilaInicial.':'.'Q'.$intFila)->getAlignment()->applyFromArray($arrStyleAlignmentRight);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)->setCellValue('I'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()->getStyle('I'.$intFila)->applyFromArray($arrStyleBold);

		}//Cierre de verificación de información

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'salidas_refacciones_internas_por_ajuste.xls', 'salidas por ajuste', $intFila);

	}

	/*******************************************************************************************************************
	Funciones de la tabla movimientos_refacciones_internas_detalles
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion_detalles()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->movimientos->filtro_detalles_salida($this->intTipoMovimiento,
															 $this->input->post('intOrdenReparacionInternaID'),
								                             $config['per_page'],
								                             $config['cur_page']);

		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Variable que se utiliza para asignar el acumulado de las unidades
		$intAcumUnidades = 0;
		//Variable que se utiliza para asignar el acumulado del subtotal
	    $intAcumSubtotal = 0;

		//Hacer recorrido para incrementar acumulados
		foreach ($result["registros"] as $arrDet) 
		{
			//Si el estatus del registro es ACTIVO
			if($arrDet->estatus == 'ACTIVO')
			{
				//Variables que se utilizan para asignar valores del detalle
				$intCantidad = $arrDet->cantidad;
				$intPrecioUnitario = $arrDet->precio_unitario;
				
				//Calcular subtotal
            	$intSubTotalUnitario =  $intCantidad * $intPrecioUnitario;

				//Incrementar acumulados
	            $intAcumUnidades += $intCantidad;
	            $intAcumSubtotal += $intSubTotalUnitario;	
			}

			//Incrementar el contador por cada registro
			$intContador++;
		}

		//Convertir cantidad a formato moneda
		$intAcumUnidades = number_format($intAcumUnidades,2);
		$intAcumSubtotal = '$'.number_format($intAcumSubtotal,2);

		//Asignar el número de registros
		$config['total_rows'] = $intContador;


		//Hacer recorrido para calcular el importe total de cada registro
		foreach ($result['detalles'] as $arrDet)
		{
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = '';

            //Variables que se utilizan para asignar valores del detalle
			$intCantidad = $arrDet->cantidad;
			$intPrecioUnitario = $arrDet->precio_unitario;

            //Calcular subtotal
            $intSubTotalUnitario =  $intCantidad * $intPrecioUnitario;

            //Convertir cantidad a formato moneda
            $arrDet->cantidad = number_format($intCantidad,2);
            $arrDet->precio_unitario = number_format($intPrecioUnitario,2);
            $arrDet->total = number_format($intSubTotalUnitario,2);

            //Si el estatus del registro es INACTIVO
			if($arrDet->estatus == 'INACTIVO')
			{
				$arrDet->estiloRegistro = 'registro-INACTIVO';
			}
		}

		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['detalles'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows'],
						  'acumulado_cantidad' => $intAcumUnidades,
						  'acumulado_total' => $intAcumSubtotal);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método  que regresa un listado de los registros (detalles) de refacciones que han tenido una salida junto con las devoluciones de taller para cada refacción. Todo esto en formato JSON.
	public function get_salidas_devoluciones_detalles()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');

		//Array que se utiliza para agregar los detalles
		$arrDetalles = array();

		//Seleccionar las salidas de refacción correspondientes a una orden de reparación interna
		$salidas = $this->movimientos->buscar_salidas($this->intTipoMovimiento, $this->input->post('intOrdenReparacionInternaID'));

		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Variable que se utiliza para asignar el acumulado de las unidades
		$intAcumUnidades = 0;
		//Variable que se utiliza para asignar el acumulado del subtotal
	    $intAcumSubtotal = 0;

	    //Si se encuentran salidas de refacciones internas para la orden de reparación seleccionada
	    if($salidas){

	    	//Variable que se utiliza para contar el número de detalles
			$intContDetMov = 0;

	    	foreach($salidas as $arrDet){

	    		$intMovimientoRefaccionesInternasID = $arrDet->movimiento_refacciones_internas_id;
	    		$intOrdenReparacionInternaID = $arrDet->orden_reparacion_interna_id;
	    		$salidas_devoluciones = $this->movimientos->buscar_salidas_con_devoluciones($this->intTipoMovimiento, $this->intTipoMovimientoDev, $intMovimientoRefaccionesInternasID, $intOrdenReparacionInternaID);

	    		//En caso de que una salida tenga devoluciones
	    		if($salidas_devoluciones){

	    			foreach($salidas_devoluciones as $arrDet2){

	    				//Si el estatus del registro es ACTIVO
						if($arrDet2->estatus == 'ACTIVO')
						{
							//Variables que se utilizan para asignar valores del detalle
							$intCantidad = $arrDet2->cantidad;
							$intPrecioUnitario = $arrDet2->precio_unitario;
							//Calcular subtotal
			            	$intSubTotalUnitario =  $intCantidad * $intPrecioUnitario;

			            	//Creamos el objeto que será insertado en el array general de registros
		    				$obj = (object) array(	
		    										'tipo_folio'=> $arrDet2->tipo_folio, 
		    										'fecha' => $arrDet2->fecha,
		    										'codigo' => $arrDet2->codigo,
		    										'descripcion' => $arrDet2->descripcion,
		    										'unidad' => $arrDet2->unidad,
		    										'cantidad' => number_format($arrDet2->cantidad, 2),
		    										'precio_unitario' => number_format($arrDet2->precio_unitario, 2),
		    										'estatus' => $arrDet2->estatus,
		    										'total' => number_format($intSubTotalUnitario, 2)
		    									);

							array_push($arrDetalles, $obj);

							//Incrementar acumulados
							//Preguntamos si es un movimiento de tipo SALIDA
							if($arrDet2->sort_col2 == 1){
								$intAcumUnidades += $intCantidad;
				            	$intAcumSubtotal += $intSubTotalUnitario;
							}
							else{
								$intAcumUnidades -= $intCantidad;
				            	$intAcumSubtotal -= $intSubTotalUnitario;
							}
				       	}
						
						//Incrementar el contador por cada registro
						$intContador++;

	    			}
	    		}
	    	}
	    }

	    //Convertir cantidad a formato moneda
		$intAcumUnidades = number_format($intAcumUnidades,2);
		$intAcumSubtotal = '$'.number_format($intAcumSubtotal,2);
		//Asignar el número de registros
		$config['total_rows'] = $intContador;

		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $arrDetalles,
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows'],
						  'acumulado_cantidad' => $intAcumUnidades,
						  'acumulado_total' => $intAcumSubtotal);
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
			$otdResultado = $this->movimientos->autocomplete_salidas($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->movimiento_salida, 'data' => $arrCol->movimiento_refacciones_internas_id);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}

}