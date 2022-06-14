<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entrada_insumos_eventos extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('mercadotecnia/movimientos_insumos_model', 'movimientos');
		//Cargamos el modelo de eventos
		$this->load->model('mercadotecnia/eventos_model', 'eventos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('mercadotecnia/Entrada_insumos_eventos', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');

		//Variables que afectan el filtro de información
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intEventoID = $this->input->post('intEventoID');
		$intTipoMovimiento = $this->input->post('intTipoMovimiento');

		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->movimientos->filtro_entrada_evento($dteFechaInicial,
											 $dteFechaFinal,
											 $intEventoID,
											 $intTipoMovimiento,
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
				//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
				if (in_array('CAMBIAR ESTATUS', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Restaurar
					$arrDet->mostrarAccionRestaurar = '';
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
			$otdResultado = $this->movimientos->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->movimiento, 
		        						'data' => $arrCol->movimiento_insumo_id);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}


	//Método para guardar o modificar los datos de un registro
	public function guardar()
	{ 
		//Datos de la orden de compra
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$intEntradaInsumosEventosID = $this->input->post('intEntradaInsumosEventosID');
		$strFolioConsecutivo = $this->input->post('strFolioConsecutivo');
		$dteFecha = $this->input->post('dteFecha');
		$intMovimientoInsumoReferenciaID = $this->input->post('intMovimientoInsumoReferenciaID');
		$strObservaciones = mb_strtoupper($this->input->post('strObservaciones'));
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Datos de los detalles
		$strInsumoID = $this->input->post('strInsumoID');
		$strCantidades = $this->input->post('strCantidades'); 
		$strPreciosUnitarios = $this->input->post('strPreciosUnitarios'); 
		//Variable para identificar el tipo de movimiento de insumo. En este caso: Entrada de insumo despues de Evento
		$intTipoMovimiento = 2; 
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($intEntradaInsumosEventosID))
		{
			$bolResultado = $this->movimientos->modificar_entrada_evento($intEntradaInsumosEventosID, 
													 	  $dteFecha, 
														  $intMovimientoInsumoReferenciaID,
														  $strObservaciones,
														  $strInsumoID,  
														  $strCantidades, 
														  $strPreciosUnitarios,
														  $intTipoMovimiento);
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
				$bolResultado = $this->movimientos->guardar_entrada_evento($strFolio,
																		  $dteFecha, 
																		  $intMovimientoInsumoReferenciaID,
																		  $strObservaciones,
																		  $strInsumoID,  
																		  $strCantidades, 
																		  $strPreciosUnitarios,
																		  $intTipoMovimiento); 

				/*Quitar '_'  de la cadena (resultadoTransaccion_entradaCompraID_folioConsecutivo) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $intEntradaInsumosEventosID, $strFolioConsecutivo) = explode("_", $bolResultado); 
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
							 	  'entrada_insumos_eventos_id' => $intEntradaInsumosEventosID,
							 	  'folio' => $strFolioConsecutivo,
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

	//Función para buscar la información correspondiente a una salida de insumos a evento
	public function get_salida_evento(){

		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intID = $this->input->post('intSalidaInsumoID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->movimientos->buscar_detalle_evento($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;	
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));

	}

	//Función para buscar si la salida a eventos seleccionada ya fue registrada
	public function verificar_salida(){

		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('id' => NULL);
		//Registro que se deberá buscar
		$intID = $this->input->post('intMovimientoInsumoID');
		//Variable para identificar el tipo de movimiento de insumo. En este caso: Entrada de insumo despues de Evento
		$intTipoMovimiento = 2; 

		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->movimientos->verificar_salida($intID, $intTipoMovimiento);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['id'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));

	}

	
	public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intID = $this->input->post('intMovimientoInsumoID');
		$intTipoMovimiento = 2;
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->movimientos->buscar_entrada_evento($intID, $intTipoMovimiento);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;

			//Seleccionar los datos de los detalles
			$otdDetalles = $this->movimientos->buscar_detalles_entrada_evento($intID);
			
			$arrDatos['detalles'] = $otdDetalles;
			
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intEntradaInsumosEventosID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intEntradaInsumosEventosID');
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
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $intEventoID, $strDetalles) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;

		//Seleccionar los datos del registro que coincide con el id
		$intTipoMovimiento = 2;
		$otdResultado = $this->movimientos->buscar_entrada_evento(NULL, $intTipoMovimiento, $dteFechaInicial, $dteFechaFinal, $intEventoID);
		
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
		$pdf->strLinea1 =  'LISTADO DE ENTRADA DE INSUMOS A EVENTO '.$strTituloRangoFechas;
		
		//Si existe id del evento
		if($intEventoID > 0)
		{
			//Seleccionar los datos del proveedor que coincide con el id
			$otdEvento =  $this->eventos->buscar($intEventoID);
			$pdf->strLinea2 =  'EVENTO: '.$otdEvento->descripcion;
		}

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
		//Agregar la primer pagina
		$pdf->AddPage();
		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Crea los titulos de la cabecera
		$arrCabecera = array('FOLIO', 'FECHA', 'SALIDA', 'EVENTO', 'TOTAL', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$arrAchura = array(16, 16, 16, 102, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$arrAlineacion = array('L', 'C', 'L', 'L','R', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('R', 'L', 'R', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAchuraDetalles = array(16, 45, 25, 25 );

		//Recorre el array de titulos de encabezado para crearlos
		for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
		{
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//inserta los titulos de la cabecera
			$pdf->Cell($arrAchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, $arrAlineacion[$intCont], TRUE);
		}
		$pdf->Ln(); //Deja un salto de línea
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAchura);
			
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo para obtener la información de los estatus
			foreach ($arrEstatus as $arrEst)
			{
				//Inicializar variables
				$arrSubtotalEstatus[$arrEst] = 0;
				$arrTotalEstatus[$arrEst] = 0;
			}	
			
			$intTotal = 0;
			//Recorremos el arreglo para obtener la información de las ordenes de compra
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAchura);
				//Array que se utiliza para agregar los detalles
		        $arrDetalles = array();
		        //Array que se utiliza para agregar los datos de un detalle
		        $arrAuxiliar = array();
		        //Variable que se utiliza para asignar el acumulado del subtotal
				$intAcumSubtotal = 0;

				//Seleccionar los detalles del registro
				$otdDetalles = $this->movimientos->buscar_detalles_entrada_evento($arrCol->movimiento_insumo_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Variables que se utilizan para asignar valores del detalle
						$intPrecioUnitario = $arrDet->precio_unitario;
						
						//Calcular subtotal
						$intSubTotalUnitario = $arrDet->entrada * $intPrecioUnitario;

						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["entrada"] = $arrDet->entrada;
						$arrAuxiliar["concepto"] = utf8_decode($arrDet->descripcion);
		                $arrAuxiliar["precio_unitario"] = '$'.number_format($intPrecioUnitario,6);
		                $arrAuxiliar["subtotal"] = '$'.number_format($intSubTotalUnitario,6);
		                //Asignar datos al array
                        array_push($arrDetalles, $arrAuxiliar); 

                        //Incrementar acumulados
						$intAcumSubtotal += $intSubTotalUnitario;
					}
					
				}//Cierre de verificación de detalles

				//Calcular importe total
				$intTotal += $intAcumSubtotal;

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, 
								$arrCol->fecha, 
								$arrCol->folioSalida,
								utf8_decode($arrCol->evento),
								'$'.number_format($intAcumSubtotal,2), 
								$arrCol->estatus), 
								$arrCabecera, 
								$arrAchura, 
								$arrAlineacion, 
								FALSE, 
								FALSE, 
								$arrAlineacion, 'ClippedCell');
		        
		        //Asigna el tipo y tamaño de letra para la cabecera de la tabla
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
				
				//Si se cumple la sentencia mostrar detalles del registro
				
				if($arrDetalles && $strDetalles == 'SI')
				{
					$pdf->Ln(1);//Deja un salto de línea
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAchuraDetalles);
					//Recorremos el arreglo 
			        foreach ($arrDetalles as $arrDet) 
			        {
					   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array($arrDet['entrada'], 
					    				$arrDet['concepto'], 
					    				$arrDet['precio_unitario'],  
									    $arrDet['subtotal']
										), 
					    				NULL, 
					    				$arrAchuraDetalles, 
					    				$arrAlineacionDetalles, 
					    				FALSE, FALSE, NULL, 'ClippedCell');
					}
				}//Cierre de verificación de detalles
				
		    	//$pdf->Ln(5);//Deja un salto de línea
				//Incrementar el contador por cada registro
				$intContador++;
			}
	
			//Cambiar color de relleno de la celda
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetX(10);
			$pdf->ClippedCell(190, 3, '', 0, 0, 'C', TRUE);
			$pdf->Ln(3);//Deja un salto de linea
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//TOTAL
			$pdf->SetX(145);
			$pdf->ClippedCell(30, 3, 'TOTAL');
			$pdf->SetX(155);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->ClippedCell(25, 3, '$'.number_format($intTotal,2), 0, 0, 'R');
			$pdf->Ln(); //Deja un salto de línea

		}
		

		//Ejecutar la salida del reporte
		$pdf->Output('entrada_insumos_evento.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro($intEntradaInsumosEventosID) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Seleccionar los datos del registro que coincide con el id
		$intTipoMovimiento = 2;
		$otdResultado = $this->movimientos->buscar_entrada_evento($intEntradaInsumosEventosID, $intTipoMovimiento);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->movimientos->buscar_detalles_entrada_evento($intEntradaInsumosEventosID);
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
		$strNombreArchivo  = 'entrada_insumos_evento';
		//Agregar la primer pagina
		$pdf->AddPage();
		//Hacer un llamado a la función para mostrar imagen del logotipo
       	$this->get_logotipo_archivo_pdf($pdf);
		
		//Establecer el color de fondo para la cabecera
		$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
   		//Encabezado
   		//Asigna el tipo y tamaño de letra
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->SetXY(80, 15);
		$pdf->ClippedCell(120, 3, utf8_decode('ENTRADA DE INSUMOS DESPUÉS DE EVENTO'), 0, 0, 'C', TRUE);
		$pdf->SetTextColor(0); //establece el color de texto
		//Asigna el tipo y tamaño de letra
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);

		//FOLIO
		$pdf->SetXY(80, 19);
		$pdf->ClippedCell(35, 3, 'FOLIO');
		//FECHA
		$pdf->SetXY(140, 19);
		$pdf->ClippedCell(35, 3, 'FECHA');
		//EVENTO
		$pdf->SetXY(80, 23);
		$pdf->ClippedCell(35, 3, 'SALIDA');
		//RESPONSABLE
		$pdf->SetXY(80, 27);
		$pdf->ClippedCell(35, 3, 'EVENTO');

		//Información de la salida de insumos después evento
		//Verificar si hay información del registro
		if($otdResultado)
		{	 
			//Hacer un llamado a la función para mostrar imagen del estatus (INACTIVO/TIMBRAR)
			$this->get_img_estatus_archivo_pdf($pdf, $otdResultado->estatus);


			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL REGISTRO
	        //------------------------------------------------------------------------------------------------------------------------
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//FOLIO
			$pdf->SetXY(101, 19);
			$pdf->ClippedCell(30, 3, $otdResultado->folio);
			//FECHA
			$pdf->SetXY(154, 19);
			$pdf->ClippedCell(30, 3, $otdResultado->fecha);
			//FOLIO DE SALIDA
			$pdf->SetXY(101, 23);
			$pdf->ClippedCell(60, 3, utf8_decode($otdResultado->folioSalida));
			//EVENTO
			$pdf->SetXY(101, 27);
			$pdf->ClippedCell(60, 3, utf8_decode($otdResultado->evento));

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DE LA SALIDA DE INSUMOS A EVENTO
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 44);
			$pdf->ClippedCell(185, 3, 'CONCEPTOS', 0, 0, 'C', TRUE);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			
			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				//Tabla con los detalles de la orden de compra
				$pdf->SetXY(15, 48);
				
				//Crea los titulos de la cabecera
				$arrCabecera = array('Salida', 'Entrada', utf8_decode('Descripción'), 'Importe', 'Subtotal');
				//Establece el ancho de las columnas de cabecera
				$arrAchura = array(15, 15, 105, 25, 25);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('R', 'R', 'L', 'R', 'R');
				//Recorre el array de títulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAchura[$intCont], 3, $arrCabecera[$intCont], 1, 0, $arrAlineacion[$intCont], TRUE);
				}
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAchura);
				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDet)
				{ 
					$pdf->SetX(15);
					//Variables que se utilizan para asignar valores del detalle
					$intSalida = $arrDet->salida;
					$intEntrada = $arrDet->entrada;
					$intPrecioUnitario = $arrDet->precio_unitario;
					
					//Calcular subtotal
					$intSubTotalUnitario = $intEntrada * $intPrecioUnitario;
				
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($intSalida,
									$intEntrada, 
									utf8_decode($arrDet->descripcion),  
								    number_format($intPrecioUnitario,6), 
								    number_format($intSubTotalUnitario,6)), 
									$arrCabecera, 
									$arrAchura, 
									$arrAlineacion,FALSE,FALSE, NULL, 'ClippedCell'
							  );

					//Incrementar acumulados
					$intAcumSubtotal += $intSubTotalUnitario;

				}

				
				//Calcular importe total
				$intAcumSubtotal = round($intAcumSubtotal, 2);
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
				$pdf->MultiCell(185, 3, 'SON: (' .$AifLibNumber->toCurrency($intAcumSubtotal) . ')');
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
				$pdf->ClippedCell(30, 3, 'TOTAL');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumSubtotal,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();

				//Observaciones
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(15, $intPosY);
				$pdf->MultiCell(110, 3, utf8_decode($otdResultado->observaciones));
				
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
	            $strPiePagina = utf8_decode('IMPRESO: '.$dteFecha.'    CAPTURO: '.$otdResultado->usuario_creacion);
	            $pdf->ClippedCell(90, 5, $strPiePagina, 0, 0, 'R');

			}//Cierre de verificación de detalles

			//Concatenar folio para identificar orden de compra
			$strNombreArchivo .= $otdResultado->folio;

		}

		//Ejecutar la salida del reporte
		$pdf->Output($strNombreArchivo.'.pdf','I'); 

	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $intEventoID, $strDetalles) 
	{	
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para asignar título de Evento
		$strEvento = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;
		//Seleccionar los datos del registro que coincide con el id
		$intTipoMovimiento = 2;
		$otdResultado = $this->movimientos->buscar_entrada_evento(NULL, $intTipoMovimiento, $dteFechaInicial, $dteFechaFinal, $intEventoID);
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
			     ->setCellValue('A7', 'LISTADO DE ENTRADAS DE INSUMOS DESPUÉS EVENTO '.$strTituloRangoFechas);
		//Si existe id del evento
		if($intEventoID > 0)
		{
			//Seleccionar los datos del proveedor que coincide con el id
			$otdEvento =  $this->eventos->buscar($intEventoID);
			$strEvento =  'EVENTO: '.$otdEvento->descripcion;

			//Se agrega el título del archivo
			$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A8', $strEvento);
		} 


		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('C'.$intPosEncabezados, 'SALIDA')
        		 ->setCellValue('D'.$intPosEncabezados, 'EVENTO')
        		 ->setCellValue('E'.$intPosEncabezados, 'TOTAL')
                 ->setCellValue('F'.$intPosEncabezados, 'ESTATUS');

        //Si se cumple la sentencia mostrar columna detalles
        if($strDetalles == 'SI')
        {
        	$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('K'.$intPosEncabezados, 'DETALLES');

        }         

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
                     ->setCellValue('G'.$intPosEncabezados, 'SALIDA')
                     ->setCellValue('H'.$intPosEncabezados, 'ENTRADA')
			         ->setCellValue('I'.$intPosEncabezados, 'CONCEPTO')
			         ->setCellValue('J'.$intPosEncabezados,'PRECIO UNITARIO')
			         ->setCellValue('K'.$intPosEncabezados, 'SUBTOTAL');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('G'.$intPosEncabezados.':K'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('G'.$intPosEncabezados.':K'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('G'.$intPosEncabezados.':K'.$intPosEncabezados)
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
				$otdDetalles = $this->movimientos->buscar_detalles_entrada_evento($arrCol->movimiento_insumo_id);
				
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
						$intEntrada = $arrDet->entrada;
						$intPrecioUnitario = $arrDet->precio_unitario;
						//Calcular subtotal
						$intSubTotalUnitario = $intEntrada * $intPrecioUnitario;

						//Agregar datos al array
						$arrDetalles[$intContDetMov]["concepto"] = $arrDet->descripcion;
		                $arrDetalles[$intContDetMov]["entrada"] = $intEntrada;
		                $arrDetalles[$intContDetMov]["salida"] = $arrDet->salida;
		                $arrDetalles[$intContDetMov]["precio_unitario"] = $intPrecioUnitario;
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
	                         ->setCellValueExplicit('C'.$intFila, $arrCol->folioSalida, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('D'.$intFila, $arrCol->evento)
	                         ->setCellValue('E'.$intFila, $intAcumSubtotal)
	                         ->setCellValue('F'.$intFila, $arrCol->estatus);

	                //Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
						 		 ->setCellValue('G'.$intFila, $arrDetalles[$intContDet]['salida'])
		                         ->setCellValue('H'.$intFila, $arrDetalles[$intContDet]['entrada'])
						         ->setCellValue('I'.$intFila, $arrDetalles[$intContDet]['concepto'])
						         ->setCellValue('J'.$intFila, $arrDetalles[$intContDet]['precio_unitario'])
						         ->setCellValue('K'.$intFila, $arrDetalles[$intContDet]['subtotal']);
					}

			    	//Incrementar el indice para escribir los datos del siguiente registro
                    $intFila++; 
			    }
				
                //Incrementar el contador por cada registro
				$intContador++;
			}

			
			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('J'.$intFilaInicial.':'.'K'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

    		$objExcel->getActiveSheet()
		        	 ->getStyle('J'.$intFilaInicial.':'.'K'.$intFila)
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
		}
		
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'entrada_insumos_evento.xls', 'entrada de insumos de evento', $intFila);
	}

}