<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Traspasos_caja_bancos extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de traspasos de caja a bancos
		$this->load->model('caja/traspasos_caja_bancos_model', 'traspasos');
		//Cargamos el modelo de empleados
		$this->load->model('recursos_humanos/empleados_model', 'empleados');

	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('caja/traspasos_caja_bancos', $arrDatos);
	}

	/*******************************************************************************************************************
	Funciones de la tabla traspasos
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->traspasos->filtro($this->input->post('dteFechaInicial'),
										   $this->input->post('dteFechaFinal'),
										   $this->input->post('intEmpleadoID'),
										   $this->input->post('strEstatus'),
										   trim($this->input->post('strBusqueda')),
			                               $config['per_page'],
			                               $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['traspasos'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
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
					//Si el usuario cuenta con el permiso de acceso EDITAR
					if (in_array('EDITAR', $arrPermisos))
					{
						//Asignar cadena vacia para mostrar botón Editar
						$arrDet->mostrarAccionEditar = '';
					}

					//Asignar cadena vacia para mostrar botón Generar póliza
	    			$arrDet->mostrarAccionGenerarPoliza = '';
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
						//Asignar cadena vacia para mostrar botón Desactivar
						$arrDet->mostrarAccionDesactivar = '';
					}

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
		$arrDatos = array('rows' => $result['traspasos'],
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
		$objTraspasoCajaBancos = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Datos del traspaso
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objTraspasoCajaBancos->intTraspasoCajaBancoID = $this->input->post('intTraspasoCajaBancoID');
		$objTraspasoCajaBancos->dteFecha = $this->input->post('dteFecha');
		$objTraspasoCajaBancos->intCuentaBancariaID = $this->input->post('intCuentaBancariaID');	
		$objTraspasoCajaBancos->intImporte = $this->input->post('intImporte');	
		$objTraspasoCajaBancos->intEmpleadoID = $this->input->post('intEmpleadoID');
		$objTraspasoCajaBancos->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objTraspasoCajaBancos->intSucursalID = $this->session->userdata('sucursal_id');
		$objTraspasoCajaBancos->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los detalles
		$objTraspasoCajaBancos->arrDetalles = json_decode($this->input->post('arrDetalles'));
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;
		
		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objTraspasoCajaBancos->intTraspasoCajaBancoID))
		{
			$bolResultado = $this->traspasos->modificar($objTraspasoCajaBancos);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objTraspasoCajaBancos->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($objTraspasoCajaBancos->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->traspasos->guardar($objTraspasoCajaBancos);
				/*Quitar '_'  de la cadena (resultadoTransaccion_traspasoCajaBancoID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $objTraspasoCajaBancos->intTraspasoCajaBancoID) = explode("_", $bolResultado); 
				
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
							 	  'traspaso_caja_banco_id' => $objTraspasoCajaBancos->intTraspasoCajaBancoID,
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
		$intID = $this->input->post('intTraspasoCajaBancoID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->traspasos->buscar($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
			//Seleccionar los detalles del registro
			$otdDetalles = $this->traspasos->buscar_ingresos($intID);
			//Si existen detalles del registro, se asignan al array
			if($otdDetalles)
			{
				$arrDatos['detalles'] = $otdDetalles;
			}
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}



	//Método para regresar ingresos sin póliza del traspaso
	public function get_ingresos_poliza()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('ingresos' => NULL, 
						  'numero_ingresos' => 0);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intID = $this->input->post('intTraspasoCajaBancoID');
		
	    //Variable que se utiliza para asignar el número de ingresos sin póliza
	    $intNumIngresos = 0;

	    //Seleccionar los ingresos sin póliza del registro
	    $otdIngresos = $this->traspasos->buscar_ingresos_poliza($intID);


		//Si existen datos, asignar los datos recuperados en el array
		if($otdIngresos)
		{
			$arrDatos['ingresos'] = $otdIngresos;
			$arrDatos['numero_ingresos'] = count($otdIngresos);
		}

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	


	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intTraspasoCajaBancoID', 'ID', 'required|integer');

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
	        $intID = $this->input->post('intTraspasoCajaBancoID');
	        $intPolizaID = $this->input->post('intPolizaID');

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->traspasos->set_estatus($intID, $intPolizaID);
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
	public function get_reporte() 
	{	            

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intEmpleadoID = $this->input->post('intEmpleadoID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strDetalles = $this->input->post('strDetalles');

		//Array que se utiliza para asignar los estatus 
		$arrEstatus = array('ACTIVO', 'INACTIVO'); 
	    //Array que se utiliza para asignar el total por estatus
		$arrTotalEstatus = array(); 
		//Array que se utiliza para asignar el total por moneda
		$arrTotalMoneda = array(); 
		//Array que se utiliza para asignar el total de registros por moneda
		$arrTotalRegistrosMoneda = array();
		//Variable que se utiliza para asignar el acumulado del total por estatus
		$intAcumTotalEstatus = 0;
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->traspasos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intEmpleadoID, 
												 $strEstatus, $strBusqueda);
		//Seleccionar los datos de las monedas que coinciden con el parámetro enviado
		$otdMonedas = $this->traspasos->buscar_distintas_monedas($dteFechaInicial, $dteFechaFinal, $intEmpleadoID, 
															     $strEstatus, $strBusqueda);
	
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
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
		$pdf->strLinea1 =  'LISTADO DE TRASPASOS DE CAJA A BANCOS '.$strTituloRangoFechas;
		//Si existe id del empleado
		if($intEmpleadoID > 0)
		{
			//Seleccionar los datos del empleado que coincide con el id
			$otdEmpleado =  $this->empleados->buscar($intEmpleadoID);
			//Variable que se utiliza para concatenar los datos del empleado
			$strNombreEmpleado = $otdEmpleado->codigo.' - '.$otdEmpleado->apellido_paterno;
			$strNombreEmpleado .= ' '.$otdEmpleado->apellido_materno.' '.$otdEmpleado->nombre;
			$pdf->strLinea2 =  'EMPLEADO: '.utf8_decode($strNombreEmpleado);
		}

		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA', 'MONEDA', 'CUENTA', 'EMPLEADO', 
							       'MONTO', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(18, 16, 12, 65, 43, 20, 16);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'L', 'L', 'L', 'R', 'C');
		//Establece el ancho de las columnas de cabecera detalles del traspaso
		$arrAnchuraDetalles = array(18, 37, 40, 18, 25, 25, 20);
		//Establece la alineación de las celdas de la tabla detalles del traspaso
		$arrAlineacionDetalles = array('L', 'L', 'L', 'C', 'L', 'L', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo para obtener la información de los estatus
			foreach ($arrEstatus as $arrEst)
			{
				//Inicializar variables
				$arrTotalEstatus[$arrEst] = 0;
			}	

			//Recorremos el arreglo para obtener la información de las monedas
			foreach ($otdMonedas as $arrMon)
			{
				//Recorremos el arreglo para obtener la información de los estatus
				foreach ($arrEstatus as $arrEst)
				{
					//Inicializar variables
					$arrTotalMoneda[$arrMon->moneda_id][$arrEst] = 0;
					$arrTotalRegistrosMoneda[$arrMon->moneda_id] = 0;
				}
			}

			//Recorremos el arreglo para obtener la información de los traspasos
			foreach ($otdResultado as $arrCol)
			{
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				//Array que se utiliza para agregar los detalles
		        $arrDetalles = array();
		        //Array que se utiliza para agregar los datos de un detalle
		        $arrAuxiliar = array();
		        //Variable que se utiliza para asignar el acumulado del importe
				$intAcumImporte = 0;

		        //Seleccionar los detalles del traspaso
	    		$otdDetalles = $this->traspasos->buscar_ingresos($arrCol->traspaso_caja_banco_id);
	    		//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
			        //Hacer recorrido para obtener los ingresos
					foreach ($otdDetalles as $arrDet)
					{
						//Variable que se utiliza para asignar el importe
						$intImporte = $arrDet->importe;

						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["folio"] =  $arrDet->folio;
						$arrAuxiliar["folio_detalle"] =  $arrDet->folio_detalle;
						$arrAuxiliar["razon_social"] = utf8_decode($arrDet->razon_social);
						$arrAuxiliar["fecha"] =  $arrDet->fecha;
						$arrAuxiliar["forma_pago"] = utf8_decode($arrDet->forma_pago);
						$arrAuxiliar["tipo_referencia"] = $arrDet->tipo_referencia;
		                $arrAuxiliar["importe"] = '$'.number_format($intImporte,2);
		                //Asignar datos al array
                        array_push($arrDetalles, $arrAuxiliar); 

						//Incrementar acumulado del importe
		                $intAcumImporte += $intImporte;

		                //Incrementar valor del array
						$arrTotalEstatus[$arrCol->estatus] += ($intImporte * $arrDet->tipo_cambio);
						//Si el id de la moneda no corresponde al peso mexicano
				      	if($arrCol->moneda_id != MONEDA_BASE)
				      	{
				      		//Incrementar valores de los siguientes arrays
					      	$arrTotalMoneda[$arrCol->moneda_id][$arrCol->estatus] += $intImporte;
					      	$arrTotalRegistrosMoneda[$arrCol->moneda_id] += 1;
				      	}

					}

				}//Cierre de verificación de detalles

			
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, $arrCol->fecha, utf8_decode($arrCol->codigo_moneda), 
								utf8_decode($arrCol->cuenta_bancaria), utf8_decode($arrCol->empleado),
								'$'.number_format($intAcumImporte,2), $arrCol->estatus),
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
					    $pdf->Row(array($arrDet['folio'], $arrDet['folio_detalle'], 
					    				$arrDet['razon_social'], $arrDet['fecha'],
					    				$arrDet['forma_pago'], $arrDet['tipo_referencia'], $arrDet['importe']), 
					    		  $arrAlineacionDetalles, 'ClippedCell');
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
			$arrAnchuraResumen = array(36, 35);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacionResumen = array('L', 'R');
			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Creación de la tabla Resumen
			$pdf->Cell(71, 4, 'RESUMEN GENERAL EN PESOS', 0, 0, 'C', TRUE);
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
					$pdf->Row(array($arrEst,'$'.number_format($arrTotalEstatus[$arrEst],2)), 
								    $arrAlineacionResumen);

					//Incrementar acumulados si el estatus es ACTIVO
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
	    	$pdf->Cell(12,3,'TOTALES: ', 0, 0, 'L');  
	    	//Total de registros
            $pdf->Cell(24,3,$intContador, 0, 0, 'R');
            //Acumulado del total
            $pdf->Cell(35,3,'$'.number_format($intAcumTotalEstatus,2), 0, 0, 'R');
            $pdf->Ln(8);//Deja un salto de línea

            //Hacer recorrido para obtener el resumen por cada tipo de moneda
			foreach ($otdMonedas as $arrMon) 
			{
				//Limpiar la siguiente variable (por cada moneda recorrida)
				$intAcumTotalEstatus = 0;

				//Asigna el tipo y tamaño de letra para la cabecera de la tabla
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Creación de la tabla Resumen
				$pdf->ClippedCell(71, 4, 'RESUMEN POR MONEDA '.$arrMon->descripcion, 0, 0, 'C', TRUE);
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
				//Hacer recorrido para obtener totales por estatus
				foreach ($arrEstatus as $arrEst)
				{
					//Si existe total
					if($arrTotalMoneda[$arrMon->moneda_id][$arrEst] > 0)
					{
					 	//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						$pdf->Row(array($arrEst,'$'.number_format($arrTotalMoneda[$arrMon->moneda_id][$arrEst],2)), 
										$arrAlineacionResumen);


						//Incrementar acumulados si el estatus es ACTIVO
						if($arrEst == 'ACTIVO')
						{
							//Incrementar acumulados
							$intAcumTotalEstatus += $arrTotalMoneda[$arrMon->moneda_id][$arrEst];
						}

					}

				}

				//Asigna el tipo y tamaño de letra para los totales
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Escribir totales
		    	$pdf->Cell(12,3,'TOTALES: ', 0, 0, 'L');  
		    	//Total de registros
	            $pdf->Cell(24,3,$arrTotalRegistrosMoneda[$arrMon->moneda_id], 0, 0, 'R');
	            //Acumulado del subtotal
	            $pdf->Cell(35,3,'$'.number_format($intAcumTotalEstatus,2), 0, 0, 'R');
	            $pdf->Ln(8);//Deja un salto de línea
			}
           
		}
		//Ejecutar la salida del reporte
		$pdf->Output('traspasos_caja_bancos.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro() 
	{	  
	          
		//Variables que se utilizan para recuperar los valores de la vista
		$intTraspasoCajaBancoID = $this->input->post('intTraspasoCajaBancoID');

		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->traspasos->buscar($intTraspasoCajaBancoID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->traspasos->buscar_ingresos($intTraspasoCajaBancoID);
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variable que se utiliza para asignar el acumulado del importe
		$intAcumImporte = 0;
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'traspaso_caja_';
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
	        //---------- DATOS DEL TRASPASO
	        //------------------------------------------------------------------------------------------------------------------------
	        //Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 42);
			$pdf->ClippedCell(185, 3, 'TRASPASO DE CAJA A BANCO', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(15, 46);
			$pdf->ClippedCell(10, 3, 'FOLIO');
			//Fecha
			$pdf->SetXY(60, 46);
			$pdf->ClippedCell(22, 03, 'FECHA');
			//Cuenta bancaria
			$pdf->SetXY(105, 46);
			$pdf->ClippedCell(22, 03, 'CUENTA');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(32, 46);
			$pdf->ClippedCell(30, 3, $otdResultado->folio);
			//Fecha
			$pdf->SetXY(78, 46);
			$pdf->ClippedCell(30, 3, $otdResultado->fecha);
			//Cuenta bancaria
			$pdf->SetXY(120, 46);
			$pdf->ClippedCell(78, 3, utf8_decode($otdResultado->cuenta_bancaria));
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Moneda
			$pdf->SetXY(15, 49);
			$pdf->ClippedCell(12, 3, 'MONEDA');
			//Estatus
			$pdf->SetXY(60, 49);
			$pdf->ClippedCell(22, 03, 'ESTATUS');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Moneda
			$pdf->SetXY(32, 49);
			$pdf->ClippedCell(30, 3, $otdResultado->codigo_moneda);
			//Estatus
			$pdf->SetXY(78, 49);
			$pdf->ClippedCell(90, 3, $otdResultado->estatus);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, 52);
			$pdf->ClippedCell(20, 3, 'EMPLEADO');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Empleado
			$pdf->SetXY(32, 52);
			$pdf->ClippedCell(65, 3, utf8_decode($otdResultado->empleado));
			

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DEL TRASPASO
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
				//Tabla con los detalles del traspaso
				$pdf->SetXY(15, 64);
				//Crea los titulos de la cabecera
				$arrCabecera = array('Folio', 'Referencia', utf8_decode('Razón Social'), 
									 'Fecha', 'Forma Pago', utf8_decode('Módulo'), 'Importe');
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(18, 37, 40, 18, 25, 27, 20);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'L', 'C', 'L', 'L', 'R');
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
					//Variable que se utiliza para asignar el importe
					$intImporte = $arrDet->importe;

					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row(array($arrDet->folio, $arrDet->folio_detalle, utf8_decode($arrDet->razon_social), 
				    				$arrDet->fecha,  utf8_decode($arrDet->forma_pago), 
				    				$arrDet->tipo_referencia, '$'.number_format($intImporte,2)), 
				    				$arrAlineacion, 'ClippedCell');

					//Incrementar acumulado del importe
		            $intAcumImporte += $intImporte;
					
				}

			}//Cierre de verificación de detalles
			
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
			$pdf->MultiCell(185, 3, 'SON: (' .$AifLibNumber->toCurrency($intAcumImporte, $otdResultado->codigo_moneda) . ')');
			//Cambiar color de relleno de la celda
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
			$pdf->ClippedCell(30, 3, 'TOTAL DOCUMENTOS');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(175);
			$pdf->ClippedCell(25, 3, '$'.number_format($intAcumImporte,2), 0, 0, 'R');
			$pdf->Ln(); //Deja un salto de línea
			$intPosY = $pdf->GetY();

			//Asignar el importe del deposito
			$intImporte = $otdResultado->importe;

			//Calcular diferencia
			$intDiferencia = $intImporte - $intAcumImporte;

			//Total del deposito
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(135);
			$pdf->ClippedCell(30, 3, utf8_decode('TOTAL DEPÓSITO'));
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(175);
			$pdf->ClippedCell(25, 3, '$'.number_format($intImporte,2), 0, 0, 'R');
			$pdf->Ln(); //Deja un salto de línea

			//DIFERENCIA
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(135);
			$pdf->ClippedCell(30, 3, 'DIFERENCIA');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(175);
			$pdf->ClippedCell(25, 3, '$'.number_format($intDiferencia,2), 0, 0, 'R');
			$pdf->Ln(); //Deja un salto de línea
			//Observaciones
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, $intPosY);
			$pdf->MultiCell(110, 3, utf8_decode($otdResultado->observaciones));
           
            //Fecha y hora de impresión (pie de pagina)
			$pdf->strUsuarioCreacion = $otdResultado->usuario_creacion;
			$pdf->dteFechaCreacion = $otdResultado->fecha_creacion;
			$pdf->strIncluirMembrete = 'SI';
	     	
	     	//Concatenar folio para identificar traspaso de caja
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
		$intEmpleadoID = $this->input->post('intEmpleadoID');
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
		$otdResultado = $this->traspasos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intEmpleadoID,  
											     $strEstatus, $strBusqueda);
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
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
			     ->setCellValue('A7', 'LISTADO DE TRASPASOS DE CAJA A BANCOS '.$strTituloRangoFechas);
		//Si existe id del empleado
		if($intEmpleadoID > 0)
		{   //Seleccionar los datos del empleado que coincide con el id
			$otdEmpleado =  $this->empleados->buscar($intEmpleadoID);
			//Variable que se utiliza para concatenar los datos del empleado
			$strNombreEmpleado = $otdEmpleado->codigo.' - '.$otdEmpleado->apellido_paterno;
			$strNombreEmpleado .= ' '.$otdEmpleado->apellido_materno.' '.$otdEmpleado->nombre;
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'EMPLEADO: '.$strNombreEmpleado);
		}

		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('C'.$intPosEncabezados, 'MONEDA')
        		 ->setCellValue('D'.$intPosEncabezados, 'CUENTA')
        		 ->setCellValue('E'.$intPosEncabezados, 'EMPLEADO')
        		 ->setCellValue('F'.$intPosEncabezados, 'MONTO')
        		 ->setCellValue('G'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('H'.$intPosEncabezados, 'ESTATUS');

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
    			 ->getStyle('A10:H10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:H10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:H10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	//Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('I'.$intPosEncabezados, 'FOLIO')
                     ->setCellValue('J'.$intPosEncabezados, 'REFERENCIA')
	        		 ->setCellValue('K'.$intPosEncabezados, 'RAZÓN SOCIAL')
	        		 ->setCellValue('L'.$intPosEncabezados, 'FECHA')
	        		 ->setCellValue('M'.$intPosEncabezados, 'FORMA DE PAGO')
	        		 ->setCellValue('N'.$intPosEncabezados, 'MODULO')
	        		 ->setCellValue('O'.$intPosEncabezados, 'IMPORTE');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('I'.$intPosEncabezados.':O'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('I'.$intPosEncabezados.':O'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('I'.$intPosEncabezados.':O'.$intPosEncabezados)
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
		        //Variable que se utiliza para asignar el acumulado del importe
				$intAcumImporte = 0;

				//Seleccionar los detalles del traspaso
	    		$otdDetalles = $this->traspasos->buscar_ingresos($arrCol->traspaso_caja_banco_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Variable que se utiliza para contar el número de detalles
				    $intContDetTras = 0;

				    //Si se cumple la sentencia mostrar detalles del registro
				    if($strDetalles == 'SI')
				    {
				    	//Asignar el número de detalles
				    	$intNumDetalles = count($otdDetalles);
				    }

					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						
						//Variable que se utiliza para asignar el importe
						$intImporte = $arrDet->importe;


                        //Agregar datos al array
                        $arrDetalles[$intContDetTras]['folio'] = $arrDet->folio;
                        $arrDetalles[$intContDetTras]['folio_detalle'] = $arrDet->folio_detalle;
			        	$arrDetalles[$intContDetTras]['razon_social'] = $arrDet->razon_social;
			        	$arrDetalles[$intContDetTras]['fecha'] = $arrDet->fecha;
			        	$arrDetalles[$intContDetTras]['forma_pago'] = $arrDet->forma_pago;
			        	$arrDetalles[$intContDetTras]['tipo_referencia'] = $arrDet->tipo_referencia;
			        	$arrDetalles[$intContDetTras]['importe'] = $intImporte;

                     	//Incrementar acumulado del importe
		                $intAcumImporte += $intImporte;

						//Incrementar el contador por cada registro
	                    $intContDetTras++;
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
			        		 ->setCellValue('C'.$intFila, $arrCol->moneda)
			        		 ->setCellValue('D'.$intFila, $arrCol->cuenta_bancaria)
			        		 ->setCellValue('E'.$intFila, $arrCol->empleado)
			        		 ->setCellValue('F'.$intFila, $intAcumImporte)
			        		 ->setCellValue('G'.$intFila, $arrCol->observaciones)
			        		 ->setCellValue('H'.$intFila, $arrCol->estatus);

			        //Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
								 ->setCellValueExplicit('I'.$intFila, $arrDetalles[$intContDet]['folio'], PHPExcel_Cell_DataType::TYPE_STRING)
								 ->setCellValueExplicit('J'.$intFila, $arrDetalles[$intContDet]['folio_detalle'], PHPExcel_Cell_DataType::TYPE_STRING)
						 		 ->setCellValue('K'.$intFila, $arrDetalles[$intContDet]['razon_social'])
						 		 ->setCellValue('L'.$intFila, $arrDetalles[$intContDet]['fecha'])
				        		 ->setCellValue('M'.$intFila, $arrDetalles[$intContDet]['forma_pago'])
				        		 ->setCellValue('N'.$intFila, $arrDetalles[$intContDet]['tipo_referencia'])
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
            		 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            $objExcel->getActiveSheet()
            		 ->getStyle('O'.$intFilaInicial.':'.'O'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.00');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

    		$objExcel->getActiveSheet()
		        	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

		     $objExcel->getActiveSheet()
                	 ->getStyle('H'.$intFilaInicial.':'.'H'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

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
                     ->setCellValue('H'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('H'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'traspasos_caja_bancos.xls', 'traspasos', $intFila);
	}

	/*******************************************************************************************************************
	Funciones de los ingresos (anticipos, pagos, recibos de ingreso y pólizas de abono) pendientes por depositar 
	*********************************************************************************************************************/
	//Método para regresar los ingresos (anticipos, pagos, recibos de ingreso y pólizas de abono) del día
	public function get_ingresos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('rows' => NULL, 'acumulado_importe' => '$0.00');
		//Variables que se utilizan para recuperar los valores de la vista 
		$intTraspasoCajaBancoID = $this->input->post('intTraspasoCajaBancoID');
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProspectoID = $this->input->post('intProspectoID');
		$intMonedaIDTraspaso = $this->input->post('intMonedaIDTraspaso');
	    //Array que se utiliza para agregar los ingresos pendientes por depositar 
        $arrIngresos = array();
        //Array que se utiliza para agregar los datos de un ingreso
        $arrAuxiliar = array();
        //Variable que se utiliza para asignar el acumulado del importe
	    $intAcumImporte = 0;

		//Seleccionar los datos de los ingresos que coinciden con el parámetro enviado
    	$otdResultado = $this->traspasos->buscar_ingresos(NULL, $dteFechaInicial, $dteFechaFinal, 
    													 $intProspectoID, $intMonedaIDTraspaso);

		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Hacer recorrido para obtener los ingresos
			foreach ($otdResultado as $arrCol)
			{
	                //Variable que se utiliza para asignar el importe del ingreso pendiente por depositar 
	                $intImporte = $arrCol->importe;

	                //Definir valores del array auxiliar de información (para cada ingreso)
					$arrAuxiliar["referencia_id"] = $arrCol->referencia_id;
					$arrAuxiliar["renglon_referencia"] = $arrCol->renglon_referencia;
					$arrAuxiliar["tipo_cambio"] = $arrCol->tipo_cambio;
					$arrAuxiliar["folio"] = $arrCol->folio;
					$arrAuxiliar["folio_detalle"] = $arrCol->folio_detalle;
					$arrAuxiliar["razon_social"] = $arrCol->razon_social;
					$arrAuxiliar["fecha"] = $arrCol->fecha;
					$arrAuxiliar["forma_pago"] = $arrCol->forma_pago;
					$arrAuxiliar["tipo_referencia"] = $arrCol->tipo_referencia;
					$arrAuxiliar["importe"] = number_format($intImporte,2);
					//Asignar datos al array
                    array_push($arrIngresos, $arrAuxiliar); 

                    //Incrementar acumulado del importe
                    $intAcumImporte += $intImporte;
			}

			$arrDatos['rows'] = $arrIngresos;
			//Convertir cantidad a formato moneda
			$arrDatos['acumulado_importe'] = '$'.number_format($intAcumImporte,2);
		}

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}
}