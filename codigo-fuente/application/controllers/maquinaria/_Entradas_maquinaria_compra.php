<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entradas_maquinaria_compra extends MY_Controller {
	
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos los modelos
		$this->load->model('maquinaria/entradas_maquinaria_compra_model', 'movimientos');
		$this->load->model('cuentas_pagar/proveedores_model', 'proveedores');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('maquinaria/entradas_maquinaria_compra', $arrDatos);
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
											 $this->input->post('intProveedorID'),
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
		//Variables que se utilizan para recuperar los valores de la vista
		$objEntradaCompra = json_decode($this->input->post('entradaCompra'));		
		$intMovimientoMaquinariaID = $objEntradaCompra->intMovimientoMaquinariaID;
		$strFolioConsecutivo = $this->input->post('strFolioConsecutivo');
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));

		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($intMovimientoMaquinariaID))
		{
			$bolResultado = $this->movimientos->modificar($intMovimientoMaquinariaID, $objEntradaCompra);
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
				$bolResultado = $this->movimientos->guardar($strFolio, $objEntradaCompra); 

				/*Quitar '_'  de la cadena (resultadoTransaccion_entradaCompraID_folioConsecutivo) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $intMovimientoMaquinariaID, $strFolioConsecutivo) = explode("_", $bolResultado); 
			}

		}
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
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para regresar los datos de un registro
	public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intID = $this->input->post('intMovimientoMaquinariaID');
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
				

				foreach ($otdDetalles as $arrDet)
				{
		        	//Se define el arreglo de ADITAMENTOS como vacio
					$arrDet->aditamentos = [];
					
					//Verificar si la MAQUINARIA contiene ADITAMENTOS
					$otdAditamentos = $this->movimientos->buscar_aditamentos($arrDet->serie);
					
					//Si la maquinaria cuenta con ADITAMENTOS
					if($otdAditamentos){
						//var_dump($otdAditamentos);
						$arrDet->aditamentos = $otdAditamentos;
					}
				}

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
		$this->form_validation->set_rules('intMovimientoMaquinariaID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intMovimientoMaquinariaID');
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

	
	//Método para regresar todos los registros activos en un autocomplete
	public function autocomplete()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$strDescripcion = trim($this->input->post('strDescripcion'));
		$strTipo = $this->input->post('strTipo');

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->movimientos->autocomplete($strDescripcion, $strTipo);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	//Si el Autocomplete es por rastreo de serie
					if($strTipo == 'rastreo_serie')
					{
						$arrDatos[] = array('value' => $arrCol->serie, 
										    'serie' => $arrCol->serie);
					}
					else //Si el Autocomplete es por Folio
					{
						$arrDatos[] = array('value' => $arrCol->folio, 
											'movimiento_maquinaria_id' => $arrCol->movimiento_maquinaria_id, 
											'referencia_id' => $arrCol->referencia_id);
					}
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}

	//Método para regresar los datos de un registro asociados a los posibles ADITAMENTOS adjuntos a una MAQUINARIA
	public function get_aditamentos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$strSerie = $this->input->post('strSerie');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->movimientos->buscar_aditamentos($strSerie);
	   
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{	
			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $intProveedorID, $strEstatus, 
								$strDetalles, $strBusqueda = NULL) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strEstatus = trim(urldecode($strEstatus));
		//Array que se utiliza para asignar los estatus 
		$arrEstatus = array('ACTIVO', 'TIMBRAR' ,'INACTIVO'); 
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->movimientos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProveedorID,
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
		$pdf->strLinea1 =  'LISTADO DE MOVIMIENTOS DE ENTRADA POR COMPRA '.$strTituloRangoFechas;
		//Si existe id del proveedor
		if($intProveedorID > 0)
		{
			//Seleccionar los datos del mecánico que coincide con el id
			$otdProveedor =  $this->proveedores->buscar($intProveedorID, NULL, NULL);
			$pdf->strLinea2 =   utf8_decode('PROVEEDOR: ').$otdProveedor->nombre_comercial;
		}
		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA', 'ORDEN DE COMPRA', 'PROVEEDOR', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(20, 16, 30, 104, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'L', 'L', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('L', 'L', 'L', 'L', 'L', 'L');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(30, 70, 30, 30, 20, 10);
		//Agregar la primer pagina
		$pdf->AddPage();
			
		//Si hay información
		if ($otdResultado)
		{		
			//Recorremos el arreglo para obtener la información de las ordenes de compra
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				//Array que se utiliza para agregar los detalles
		        $arrDetalles = array();
		        //Array que se utiliza para agregar los datos de un detalle
		        $arrAuxiliar = array();
				//Seleccionar los detalles del registro
				$otdDetalles = $this->movimientos->buscar_detalles($arrCol->movimiento_maquinaria_id);
				
				//Verificar si existe información de los detalles 
				
				if($otdDetalles)
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["codigo"] = $arrDet->codigo;
						$arrAuxiliar["descripcion_corta"] = utf8_decode($arrDet->descripcion_corta);
		                $arrAuxiliar["serie"] = $arrDet->serie;
		                $arrAuxiliar["motor"] = $arrDet->motor;
		                $arrAuxiliar["numero_pedimento"] = $arrDet->numero_pedimento;
		                $arrAuxiliar["consignacion"] = $arrDet->consignacion;
		                //Asignar datos al array
                        array_push($arrDetalles, $arrAuxiliar); 
					}
					
				}//Cierre de verificación de detalles
				
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, 
								$arrCol->fecha, 
								$arrCol->folio_orden_compra,
								utf8_decode($arrCol->proveedor),
								$arrCol->estatus), 
								$pdf->arrAlineacion, 'ClippedCell');
		        
		        //Asigna el tipo y tamaño de letra para la cabecera de la tabla
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);

		        //Si se cumple la sentencia mostrar detalles del registro
				if($arrDetalles && $strDetalles == 'SI')
				{
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraDetalles);
					//Recorremos el arreglo 
			        foreach ($arrDetalles as $arrDet) 
			        {
					   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array($arrDet['codigo'], 
					    			    $arrDet['descripcion_corta'], 
					    				$arrDet['serie'],
					    				$arrDet['motor'], 
					    				$arrDet['numero_pedimento'], 
					    				$arrDet['consignacion']), 
					    				$arrAlineacionDetalles, 
					    				'ClippedCell');
					}

					$pdf->Ln(3);//Deja un salto de línea
				}//Cierre de verificación de detalles
				
				//Incrementar el contador por cada registro
				$intContador++;
			}
			//Espacios de salto de línea
			$pdf->Ln();
			//Asigna el tipo y tamaño de letra para los totales
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Escribe la cadena concatenada con el total de registros
	    	$pdf->Cell(0,3,'TOTAL: '.$intContador, 0, 0, 'R');
		}

		//Ejecutar la salida del reporte
		$pdf->Output('entradas_maquinaria_compra.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro($intMovimientoMaquinariaID) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->movimientos->buscar($intMovimientoMaquinariaID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->movimientos->buscar_detalles($intMovimientoMaquinariaID);
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
		$strNombreArchivo  = 'entradas_maquinaria_compra_';
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
		$pdf->ClippedCell(120, 3, utf8_decode('ENTRADAS DE MAQUINARIA POR COMPRA'), 0, 0, 'C', TRUE);
		$pdf->SetTextColor(0); //establece el color de texto
		//Asigna el tipo y tamaño de letra
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);

		//FOLIO
		$pdf->SetXY(80, 19);
		$pdf->ClippedCell(35, 3, 'FOLIO');
		//FECHA
		$pdf->SetXY(140, 19);
		$pdf->ClippedCell(35, 3, 'FECHA');
		//ORDEN DE COMPRA
		$pdf->SetXY(80, 23);
		$pdf->ClippedCell(35, 3, utf8_decode('ORDEN DE COMPRA'));
		//PROVEEDOR
		$pdf->SetXY(80, 27);
		$pdf->ClippedCell(35, 3, 'PROVEEDOR');
		//CHOFER
		$pdf->SetXY(80, 31);
		$pdf->ClippedCell(35, 3, 'CHOFER');
		//VEHICULO
		$pdf->SetXY(80, 35);
		$pdf->ClippedCell(35, 3, utf8_decode('VEHÍCULO'));

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
			$pdf->SetXY(111, 19);
			$pdf->ClippedCell(35, 3, $otdResultado->folio);
			//FECHA
			$pdf->SetXY(154, 19);
			$pdf->ClippedCell(30, 3, $otdResultado->fecha);
			//MECÁNICO
			$pdf->SetXY(111, 23);
			$pdf->ClippedCell(60, 3, $otdResultado->folio_orden_compra);
			//TIPO DE MOVIMIENTO
			$pdf->SetXY(111, 27);
			$pdf->ClippedCell(60, 3, utf8_decode($otdResultado->proveedor));
			//CHOFER
			$pdf->SetXY(111, 31);
			$pdf->ClippedCell(60, 3, utf8_decode($otdResultado->chofer));
			//VEHICULO
			$pdf->SetXY(111, 35);
			$pdf->ClippedCell(60, 3, utf8_decode($otdResultado->vehiculo));

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DE LA SALIDA DE INSUMOS A EVENTO
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 44);
			$pdf->ClippedCell(185, 3, 'DETALLES DE LA ENTRADA', 0, 0, 'C', TRUE);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			
			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				
				//Tabla con los detalles del movimiento
				$pdf->SetXY(15, 48);
				
				//Crea los titulos de la cabecera
				$arrCabecera = array(utf8_decode('Código'), utf8_decode('Descripción'));
				$arrCabecera2 = array('Serie', 'Motor', 'Pedimento', utf8_decode('Consignación'));
			    //Establece el ancho de las columnas de cabecera
				$arrAnchura = array(40, 145);
				$arrAnchura2 = array(65, 65, 35, 20);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L');
				$arrAlineacion2 = array('L', 'L', 'L', 'C');
				//Recorre el array de títulos de encabezado 1 para crearlos
				for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchura[$intCont], 3, $arrCabecera[$intCont], 1, 0, 
							   $arrAlineacion[$intCont], TRUE);
				}
				$pdf->Ln();
				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
				//Recorre el array de títulos de encabezado 2 para crearlos
				for ($intCont = 0; $intCont < count($arrCabecera2); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchura2[$intCont], 3, $arrCabecera2[$intCont], 1, 0, 
							   $arrAlineacion2[$intCont], TRUE);
				}
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
			
				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDet)
				{ 
					
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchura);
					$pdf->SetX(15);
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(utf8_decode($arrDet->codigo), 
									utf8_decode($arrDet->descripcion_corta)),
									$arrAlineacion, 'ClippedCell');
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchura2);
					$pdf->SetX(15);
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(utf8_decode($arrDet->serie), 
									utf8_decode($arrDet->motor), 
									utf8_decode($arrDet->numero_pedimento),
									utf8_decode($arrDet->consignacion)),
									$arrAlineacion2, 'ClippedCell');
				}
				
				
				$pdf->Ln(); //Deja un salto de línea
				//Observaciones
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(15);
				$pdf->ClippedCell(30, 3, 'OBSERVACIONES');
				
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



			}//Cierre de verificación de detalles
			
			//Fecha y hora de impresión (pie de pagina)
			$pdf->strUsuarioCreacion = $otdResultado->usuario_creacion;
			$pdf->dteFechaCreacion = $otdResultado->fecha_creacion;
			$pdf->strIncluirMembrete = 'SI';
	            
			//Concatenar folio para identificar orden de compra
			$strNombreArchivo .= $otdResultado->folio;
		}
		
		//Ejecutar la salida del reporte
		$pdf->Output($strNombreArchivo.'.pdf','I'); 

	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $intProveedorID, $strEstatus, $strDetalles, $strBusqueda = NULL) 
	{	
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strEstatus = trim(urldecode($strEstatus));
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para asignar título de Proveedor
		$strProveedor = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;

        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->movimientos->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProveedorID, $strEstatus, $strBusqueda);

		

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
			     ->setCellValue('A7', 'LISTADO DE ENTRADAS DE MAQUINARIA POR COMPRA '.$strTituloRangoFechas);
	
		//Si existe id del proveedor
		if($intProveedorID > 0)
		{
			//Seleccionar los datos del proveedor que coincide con el id
			$otdProveedor =  $this->proveedores->buscar($intProveedorID);
			$strProveedor =  'PROVEEDOR: '.$otdProveedor->nombre_comercial;

			//Se agrega el título del archivo
			$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A8', $strProveedor);

		}	     


		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('C'.$intPosEncabezados, 'ORDEN DE COMPRA')
        		 ->setCellValue('D'.$intPosEncabezados, 'PROVEEDOR')
                 ->setCellValue('E'.$intPosEncabezados, 'ESTATUS');

        //Si se cumple la sentencia mostrar columna detalles
        if($strDetalles == 'SI')
        {
        	$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('H'.$intPosEncabezados, 'DETALLES');

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
    			 ->getStyle('A10:E10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:E10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:E10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
	       			 ->setCellValue('F'.$intPosEncabezados, 'CÓDIGO')
                     ->setCellValue('G'.$intPosEncabezados, 'DESCRIPCIÓN')
                     ->setCellValue('H'.$intPosEncabezados, 'LÍNEA')
                     ->setCellValue('I'.$intPosEncabezados, 'MARCA')
                     ->setCellValue('J'.$intPosEncabezados, 'MODELO')
                     ->setCellValue('K'.$intPosEncabezados, 'SERIE')
                     ->setCellValue('L'.$intPosEncabezados, 'MOTOR')
                     ->setCellValue('M'.$intPosEncabezados, 'NÚMERO DE PEDIMENTO')
			         ->setCellValue('N'.$intPosEncabezados, 'CONSIGNACIÓN');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('F'.$intPosEncabezados.':N'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('F'.$intPosEncabezados.':N'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('F'.$intPosEncabezados.':N'.$intPosEncabezados)
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

				//Si se cumple la sentencia mostrar detalles del registro
			    if($strDetalles == 'SI')
			    {
			    	//Seleccionar los detalles del registro
					$otdDetalles = $this->movimientos->buscar_detalles($arrCol->movimiento_maquinaria_id);
					
					
					//Verificar si existe información de los detalles 
					if($otdDetalles)
					{
						//Variable que se utiliza para contar el número de detalles
					    $intContDetMov = 0;

					    //Asignar el número de detalles
					    $intNumDetalles = count($otdDetalles);

						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							//Agregar datos al array
							$arrDetalles[$intContDetMov]["codigo"] = $arrDet->codigo;
			                $arrDetalles[$intContDetMov]["descripcion_corta"] = $arrDet->descripcion_corta;
			                $arrDetalles[$intContDetMov]["maquinaria_linea"] = $arrDet->maquinaria_linea;
			                $arrDetalles[$intContDetMov]["maquinaria_marca"] = $arrDet->maquinaria_marca;
			                $arrDetalles[$intContDetMov]["maquinaria_modelo"] = $arrDet->maquinaria_modelo;
			                $arrDetalles[$intContDetMov]["serie"] = $arrDet->serie;
			                $arrDetalles[$intContDetMov]["motor"] = $arrDet->motor;
			                $arrDetalles[$intContDetMov]["numero_pedimento"] = $arrDet->numero_pedimento;
			                $arrDetalles[$intContDetMov]["consignacion"] = $arrDet->consignacion;

			                //Incrementar el contador por cada registro
		                    $intContDetMov++;	
						}

					}//Cierre de verificación de detalles
			    }

				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    {
			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('B'.$intFila, $arrCol->fecha)
	                         ->setCellValueExplicit('C'.$intFila, $arrCol->folio_orden_compra, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValueExplicit('D'.$intFila, $arrCol->proveedor, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('E'.$intFila, $arrCol->estatus);

	                //Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
						 	     ->setCellValue('F'.$intFila, $arrDetalles[$intContDet]['codigo'])
		                         ->setCellValue('G'.$intFila, $arrDetalles[$intContDet]['descripcion_corta'])
		                         ->setCellValue('H'.$intFila, $arrDetalles[$intContDet]['maquinaria_linea'])
		                         ->setCellValue('I'.$intFila, $arrDetalles[$intContDet]['maquinaria_marca'])
		                         ->setCellValue('J'.$intFila, $arrDetalles[$intContDet]['maquinaria_modelo'])
		                         ->setCellValue('K'.$intFila, $arrDetalles[$intContDet]['serie'])
		                         ->setCellValue('L'.$intFila, $arrDetalles[$intContDet]['motor'])
		                         ->setCellValue('M'.$intFila, $arrDetalles[$intContDet]['numero_pedimento'])
						         ->setCellValue('N'.$intFila, $arrDetalles[$intContDet]['consignacion']);
					}

					//Incrementar el indice para escribir los datos del siguiente registro
	                $intFila++; 
			    }
				
                //Incrementar el contador por cada registro
				$intContador++;
			}
	 		
	 		//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('E'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('E'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
			
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
       $this->get_pie_pagina_archivo_excel($objExcel, 'entradas_maquinaria_compra.xls', 'entradas maquinaria compra', $intFila);
	}

}	