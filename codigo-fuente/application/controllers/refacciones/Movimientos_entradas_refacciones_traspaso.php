<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movimientos_entradas_refacciones_traspaso extends MY_Controller {
	///Variable para identificar el tipo de movimiento
	var $intTipoMovimiento = ENTRADA_REFACCIONES_TRASPASO;
	//Información que se utiliza para asignar el número de decimales a redondear
	var $intNumDecimales = NUM_DECIMALES_MOSTRAR_REFACCIONES;  
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de movimientos de refacciones
		$this->load->model('refacciones/movimientos_refacciones_model', 'movimientos');
		//Cargamos el modelo de sucursales
		$this->load->model('administracion/sucursales_model', 'sucursales');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('refacciones/movimientos_entradas_refacciones_traspaso', $arrDatos);
	}

	/*******************************************************************************************************************
	Funciones de la tabla movimientos_refacciones
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->movimientos->filtro_entrada_traspaso($this->intTipoMovimiento,
														      $this->input->post('dteFechaInicial'),
															  $this->input->post('dteFechaFinal'),
															  $this->input->post('intSucursalSalidaID'),
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
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
		    $arrDet->mostrarAccionGenerarPoliza = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;

			//Si el estatus del registro es ACTIVO
			if($arrDet->estatus == 'ACTIVO')
			{	
				
				//Si no existe id de la póliza
				if($arrDet->poliza_id == 0)
				{
					//Asignar cadena vacia para mostrar botón Generar póliza
	    			$arrDet->mostrarAccionGenerarPoliza = '';
				}
				else
				{
					//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
					if (in_array('CAMBIAR ESTATUS', $arrPermisos))
					{
						//Asignar cadena vacia para mostrar botón Desactivar
						$arrDet->mostrarAccionDesactivar = '';
					}
				}

			}

			//Si el usuario cuenta con el permiso de acceso VER REGISTRO
			if (in_array('VER REGISTRO', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón Ver registro
        		$arrDet->mostrarAccionVerRegistro = '';	
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
		$objMovimiento = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista 
		//Datos del movimiento
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objMovimiento->intMovimientoRefaccionesID = $this->input->post('intMovimientoRefaccionesID');
		$objMovimiento->intTipoMovimiento = $this->intTipoMovimiento;
		$objMovimiento->strFolio = $this->input->post('strFolio');
		$objMovimiento->dteFecha = $this->input->post('dteFecha');
		$objMovimiento->intReferenciaID = $this->input->post('intReferenciaID');
		$objMovimiento->intSucursalSalidaID = $this->input->post('intSucursalSalidaID');
		$objMovimiento->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objMovimiento->intSucursalID =  $this->session->userdata('sucursal_id');
		$objMovimiento->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los detalles
		$objMovimiento->strRenglon = $this->input->post('strRenglon');
		$objMovimiento->strRefaccionID = $this->input->post('strRefaccionID');
		$objMovimiento->strCodigos = $this->input->post('strCodigos'); 
		$objMovimiento->strDescripciones = $this->input->post('strDescripciones'); 
		$objMovimiento->strCodigosLineas = $this->input->post('strCodigosLineas'); 
		$objMovimiento->strCantidades = $this->input->post('strCantidades'); 
		$objMovimiento->strCostosUnitarios = $this->input->post('strCostosUnitarios');

		//Definir las reglas de validación
		$this->form_validation->set_rules('strFolio', 'folio', 
        								  'required|callback_get_existencia['.$objMovimiento->intTipoMovimiento.']');

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
			//Guardamos los datos del registro
			$bolResultado = $this->movimientos->guardar_entrada_traspaso($objMovimiento); 
			/*Quitar '_'  de la cadena (resultadoTransaccion_movimientoRefaccionesID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			list($bolResultado, $objMovimiento->intMovimientoRefaccionesID) = explode("_", $bolResultado); 
			
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

	//Verifica la existencia de la salida por traspaso
	//para evitar duplicación de datos al momento de modificar o guardar un registro.
    public function get_existencia($strFolio, $intTipoMovimiento) 
    {	
    	//Concatenar datos para realizar la búsqueda
    	$strCriteriosBusq = $strFolio.'|'.$intTipoMovimiento;

		//Hacer un llamado al método para comprobar la existencia del movimiento
		$otdResultado = $this->movimientos->buscar_entrada_traspaso(NULL, $strCriteriosBusq);
		//Si existen datos
		if($otdResultado)
		{
		    //Enviar mensaje de error
		    $this->form_validation->set_message('get_existencia', 'La salida ya ha sido registrada, favor de verificar.');
		    //Regresar FALSE para no permitir registrar o actualizar datos
		    return FALSE;
		}
		else
		{
			//Regresar TRUE para permitir registrar o actualizar datos
			return TRUE;
		}
    }

    //Método para regresar los datos de un registro
	public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intID = $this->input->post('intMovimientoRefaccionesID');
		
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->movimientos->buscar_entrada_traspaso($intID);
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
		$this->form_validation->set_rules('intMovimientoRefaccionesID', 'ID', 'required|integer');
		$this->form_validation->set_rules('intReferenciaID', 'Referencia', 'required|integer');
		$this->form_validation->set_rules('intSucursalSalidaID', 'Sucursal de salida', 'required|integer');
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
	        $intMovimientoRefaccionesID = $this->input->post('intMovimientoRefaccionesID');
	        $intReferenciaID = $this->input->post('intReferenciaID');
	        $intSucursalSalidaID = $this->input->post('intSucursalSalidaID');
	        $intPolizaID = $this->input->post('intPolizaID');

	        //Hacer un llamado al método para modificar el historial de inventario de la salida por traspaso
			$bolResultadoSalida = $this->movimientos->modificar_historial_inventario_refacciones_salida_traspaso($intReferenciaID, 
																										  		 $intSucursalSalidaID); 
			//Si no se obtienen errores al ejecutar el proceso
	        if($bolResultadoSalida)
	        {
	        	 //Hacer un llamado al método para modificar el estatus del registro
				$bolResultado = $this->movimientos->set_estatus($intMovimientoRefaccionesID, 
																$this->intTipoMovimiento, 
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
	        else
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => 'Ocurrió un error al actualizar el inventario de la salida por traspaso, vuelva a intentarlo.');
			}
	       
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


     /*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte() 
	{	      

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intSucursalSalidaID = $this->input->post('intSucursalSalidaID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strDetalles = $this->input->post('strDetalles');

		//Array que se utiliza para asignar los estatus 
		$arrEstatus = array('ACTIVO', 'INACTIVO'); 
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->movimientos->buscar_entrada_traspaso(NULL, NULL, $this->intTipoMovimiento, 
																    $dteFechaInicial, $dteFechaFinal, 
																    $intSucursalSalidaID, $strEstatus, 
																    $strBusqueda);
		
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
		$pdf->strLinea1 =  utf8_decode('LISTADO DE ENTRADAS DE REFACCIONES POR TRASPASO ').$strTituloRangoFechas;
		//Si existe id de la sucursal de salida por traspaso
		if($intSucursalSalidaID > 0)
		{
			//Seleccionar los datos de la sucursal que coincide con el id
			$otdSucursal =  $this->sucursales->buscar($intSucursalSalidaID);
			$pdf->strLinea2 =  'SUCURSAL: '.utf8_decode($otdSucursal->nombre);
		}
		
		//Array que se utiliza para asignar el total por estatus
		$arrTotalEstatus = array();
		//Variable que se utiliza para asignar el acumulado del total por estatus
		$intAcumTotalEstatus = 0;
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA', 'SUCURSAL', 'TOTAL', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(16, 15, 121, 18, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'L', 'R', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('R', 'L', 'L', 'L', 'L', 'R', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(16, 20, 20, 46, 20, 25, 25 );
		//Agregar la primer pagina
		$pdf->AddPage();		
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo para obtener la información de los estatus
			foreach ($arrEstatus as $arrEst)
			{
				//Inicializar variable
				$arrTotalEstatus[$arrEst] = 0;
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
				
				//Seleccionar los detalles del registro
				$otdDetalles = $this->movimientos->buscar_detalles_entrada_traspaso($arrCol->movimiento_refacciones_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Variables que se utilizan para asignar valores del detalle
						$intCantidad = $arrDet->cantidad;
						$intCostoUnitario = $arrDet->costo_unitario;
						
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
					}

				}//Cierre de verificación de detalles

				//Incrementar valor del array
			    $arrTotalEstatus[$arrCol->estatus] += $intAcumSubtotal;
				
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, $arrCol->fecha, utf8_decode($arrCol->sucursal_salida), 
								'$'.number_format($intAcumSubtotal,$this->intNumDecimales), 
								$arrCol->estatus),  
								$pdf->arrAlineacion, 'ClippedCell');
		        
				//Si se cumple la sentencia mostrar detalles del registro
				if($arrDetalles && $strDetalles == 'SI')
				{
					$pdf->Ln(2);//Deja un salto de línea
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraDetalles);
					//Recorremos el arreglo 
			        foreach ($arrDetalles as $arrDet) 
			        {
					   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array($arrDet['cantidad'], $arrDet['codigo_linea'], $arrDet['codigo'], 
					    				$arrDet['descripcion'], $arrDet['localizacion'], $arrDet['costo_unitario'],  
					    				$arrDet['subtotal']), $arrAlineacionDetalles,'ClippedCell');
					}
					
					$pdf->Ln(5);//Deja un salto de línea
				}//Cierre de verificación de detalles
		    	
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
			$arrCabeceraResumen = array('ESTATUS', 'TOTAL');
			//Establece el ancho de las columnas de cabecera
			$arrAnchuraResumen = array(28, 27.8);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacionResumen = array('L', 'R');
			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Creación de la tabla Resumen
			$pdf->Cell(56, 4, 'RESUMEN GENERAL EN PESOS', 0, 0, 'C', TRUE);
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
				//Si existe total
				if($arrTotalEstatus[$arrEst] > 0)
				{
				 	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($arrEst,'$'.number_format($arrTotalEstatus[$arrEst],$this->intNumDecimales)), 
									 $arrAlineacionResumen);

					//Incrementar acumulado si el estatus es ACTIVO 
					if($arrEst == 'ACTIVO')
					{
						//Incrementar acumulado
						$intAcumTotalEstatus += $arrTotalEstatus[$arrEst];
					}
				}
			}

			//Asigna el tipo y tamaño de letra para los totales
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Escribir totales
	    	$pdf->Cell(13,3,'TOTALES: ', 0, 0, 'L');  
	    	//Total de registros
            $pdf->Cell(15,3,$intContador, 0, 0, 'R');
            //Acumulado del importe total
            $pdf->Cell(27.8,3,'$'.number_format($intAcumTotalEstatus,$this->intNumDecimales), 0, 0, 'R');
		}
		//Ejecutar la salida del reporte
		$pdf->Output('entradas_refacciones_traspaso.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro() 
	{	         
		//Variables que se utilizan para recuperar los valores de la vista
		$intMovimientoRefaccionesID = $this->input->post('intMovimientoRefaccionesID');   
		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->movimientos->buscar_entrada_traspaso($intMovimientoRefaccionesID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->movimientos->buscar_detalles_entrada_traspaso($intMovimientoRefaccionesID);
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variable que se utiliza para asignar el acumulado del subtotal
		$intAcumSubtotal = 0;
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'entrada_refacciones_traspaso_';
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
	        //---------- DATOS DE LA SUCURSAL DE LA SALIDA POR TRASPASO
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 42);
			$pdf->ClippedCell(92, 3, 'SUCURSAL', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0); //establece el color de texto
			//Sucursal
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, 46);
			$pdf->ClippedCell(12, 3, 'NOMBRE');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Sucursal
			$pdf->SetXY(27, 46);
			$pdf->ClippedCell(30, 3, utf8_decode($otdResultado->sucursal_salida));


			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL MOVIMIENTO
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(108, 42);
			$pdf->ClippedCell(92, 3, utf8_decode('ENTRADA DE REFACCIONES POR TRASPASO'), 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0);//establece el color de texto
			//Folio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, 46);
			$pdf->ClippedCell(15, 3, 'FOLIO');
			//Fecha 
			$pdf->SetXY(154, 46);
			$pdf->ClippedCell(15, 3, 'FECHA');
			//Estatus
			$pdf->SetXY(108, 49);
			$pdf->ClippedCell(15, 3, 'ESTATUS');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(135, 46);
			$pdf->ClippedCell(76, 3, $otdResultado->folio);
			//Fecha
			$pdf->SetXY(178, 46);
			$pdf->ClippedCell(29, 3, $otdResultado->fecha);
			//Estatus
			$pdf->SetXY(135, 49);
			$pdf->ClippedCell(29, 3, $otdResultado->estatus);

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DEL MOVIMIENTO
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 57);
			$pdf->ClippedCell(185, 3, 'CONCEPTOS', 0, 0, 'C', TRUE);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			
			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				//Tabla con los detalles del movimiento
				$pdf->SetXY(15, 61);
				//Crea los titulos de la cabecera
				$arrCabecera = array('Cantidad',  utf8_decode('Código'), utf8_decode('Descripción'), 
									 utf8_decode('Localización'), 'Unitario', 'Importe');
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(15, 20, 80, 20, 25, 25);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('R', 'L', 'L', 'L', 'R', 'R');
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
					$intCostoUnitario = $arrDet->costo_unitario;
					
					//Calcular subtotal
					$intSubTotalUnitario = $intCantidad * $intCostoUnitario;
				
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(number_format($intCantidad,2),  utf8_decode($arrDet->codigo), 
									utf8_decode($arrDet->descripcion), utf8_decode($arrDet->localizacion),
									number_format($intCostoUnitario,$this->intNumDecimales), number_format($intSubTotalUnitario,$this->intNumDecimales)), 
									 $arrAlineacion, 'ClippedCell');

					//Incrementar acumulados
					$intAcumSubtotal += $intSubTotalUnitario;

				}

			}//Cierre de verificación de detalles


			//Redondear importe total a dos decimales
			$intTotal = number_format($intAcumSubtotal,$this->intNumDecimales);

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
			//Total
			$pdf->SetX(135);
			$pdf->ClippedCell(30, 3, 'TOTAL');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(175);
			$pdf->ClippedCell(25, 3, '$'.$intTotal, 0, 0, 'R');
			$pdf->Ln(); //Deja un salto de línea
			$intPosY = $pdf->GetY();
			//Observaciones
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, $intPosY);
			$pdf->MultiCell(110, 3, utf8_decode($otdResultado->observaciones));
		   //Persona que recibio la entrada de refacciones
            $pdf->SetXY(15,260);
            //Persona que reviso la entrada de refacciones
            $pdf->SetXY(109, 260);
            $pdf->Ln(5);//Espacios de salto de línea
            $pdf->SetX(15);
            //Persona que recibio la entrada de refacciones
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
		$intSucursalSalidaID = $this->input->post('intSucursalSalidaID');
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
		$otdResultado = $this->movimientos->buscar_entrada_traspaso(NULL, NULL, $this->intTipoMovimiento, 
																    $dteFechaInicial, $dteFechaFinal, 
																    $intSucursalSalidaID, $strEstatus, $strBusqueda);
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
			     ->setCellValue('A7', 'LISTADO DE ENTRADAS DE REFACCIONES POR TRASPASO '.$strTituloRangoFechas);
		//Si existe id de la sucursal de salida por traspaso
		if($intSucursalSalidaID > 0)
		{   //Seleccionar los datos de la sucursal que coincide con el id
			$otdSucursal =  $this->sucursales->buscar($intSucursalSalidaID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'SUCURSAL: '.$otdSucursal->nombre);
		}
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('C'.$intPosEncabezados, 'SUCURSAL')
        		 ->setCellValue('D'.$intPosEncabezados, 'TOTAL')
        		 ->setCellValue('E'.$intPosEncabezados, 'OBSERVACIONES')
                 ->setCellValue('F'.$intPosEncabezados, 'ESTATUS');
        

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
    			 ->getStyle('A10:F10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:F10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:F10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('G'.$intPosEncabezados, 'CANTIDAD')
                     ->setCellValue('H'.$intPosEncabezados, 'CÓDIGO DE LÍNEA')
                     ->setCellValue('I'.$intPosEncabezados, 'CÓDIGO')
			         ->setCellValue('J'.$intPosEncabezados, 'DESCRIPCIÓN')
			         ->setCellValue('K'.$intPosEncabezados, 'REFACCIONES LINEA')
			         ->setCellValue('L'.$intPosEncabezados, 'REFACCIONES MARCA')
			         ->setCellValue('M'.$intPosEncabezados, 'LOCALIZACIÓN')
			         ->setCellValue('N'.$intPosEncabezados, 'COSTO UNITARIO')
			         ->setCellValue('O'.$intPosEncabezados, 'SUBTOTAL');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('G'.$intPosEncabezados.':O'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('G'.$intPosEncabezados.':O'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('G'.$intPosEncabezados.':O'.$intPosEncabezados)
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

				//Seleccionar los detalles del registro
				$otdDetalles = $this->movimientos->buscar_detalles_entrada_traspaso($arrCol->movimiento_refacciones_id);
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
						$intCostoUnitario = $arrDet->costo_unitario;
					
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

						//Incrementar el contador por cada registro
	                    $intContDetMov++;
					}

				}//Cierre de verificación de detalles

				//Calcular importe total
				$intTotal = $intAcumSubtotal;

				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    {
			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
						 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValue('B'.$intFila, $arrCol->fecha)
		                         ->setCellValue('C'.$intFila, $arrCol->sucursal_salida)
		                         ->setCellValue('D'.$intFila, $intAcumSubtotal)
		                         ->setCellValue('E'.$intFila, $arrCol->observaciones)
		                         ->setCellValue('F'.$intFila, $arrCol->estatus);

		            //Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
								 ->setCellValue('G'.$intFila, $arrDetalles[$intContDet]['cantidad'])
								 ->setCellValueExplicit('H'.$intFila, $arrDetalles[$intContDet]['codigo_linea'], PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValueExplicit('I'.$intFila, $arrDetalles[$intContDet]['codigo'], PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValue('J'.$intFila, $arrDetalles[$intContDet]['descripcion'])
		                         ->setCellValue('K'.$intFila, $arrDetalles[$intContDet]['refacciones_linea'])
		                         ->setCellValue('L'.$intFila, $arrDetalles[$intContDet]['refacciones_marca'])
		                         ->setCellValue('M'.$intFila, $arrDetalles[$intContDet]['localizacion'])
						         ->setCellValue('N'.$intFila, $arrDetalles[$intContDet]['costo_unitario'])
						         ->setCellValue('O'.$intFila, $arrDetalles[$intContDet]['subtotal']);
					}

					//Incrementar el indice para escribir los datos del siguiente registro
	                $intFila++; 
			    }
				
                //Incrementar el contador por cada registro
				$intContador++;
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.0000');

           	$objExcel->getActiveSheet()
            		 ->getStyle('N'.$intFilaInicial.':'.'O'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.0000');


            //Cambiar contenido de las celdas a formato númerico de 2 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('###0.00');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

    		$objExcel->getActiveSheet()
		        	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			$objExcel->getActiveSheet()
                	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
            
		    $objExcel->getActiveSheet()
		        	 ->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

           $objExcel->getActiveSheet()
		        	 ->getStyle('M'.$intFilaInicial.':'.'O'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);


			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('F'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('F'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'entradas_refacciones_traspaso.xls', 
        									'entradas de refacciones', $intFila);
	}

	/*******************************************************************************************************************
	Funciones de la tabla movimientos_refacciones_detalles
	*********************************************************************************************************************/
	//Método para regresar los detalles de un registro
	public function get_datos_detalles()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('detalles' => NULL);
	    //Si no existe id del movimiento de refacción asignar valor cero
		$intMovimientoRefaccionesID = (($this->input->post('intMovimientoRefaccionesID') !== '') ? 
							  			$this->input->post('intMovimientoRefaccionesID') : 0);
		$intReferenciaID = $this->input->post('intReferenciaID');

		//Seleccionar los precios del registro que coincide con el id
	    $otdResultado = $this->movimientos->buscar_detalles_entrada_traspaso($intMovimientoRefaccionesID, $intReferenciaID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['detalles'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

}