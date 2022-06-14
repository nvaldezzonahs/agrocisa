<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vales_gasolina extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('control_vehiculos/vales_gasolina_model', 'vales');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('control_vehiculos/vales_gasolina', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->vales->filtro($this->input->post('dteFechaInicial'),
									   $this->input->post('dteFechaFinal'),
									   $this->input->post('intVehiculoID'),
									   $this->input->post('strEstatus'),
									   trim($this->input->post('strBusqueda')),
		                               $config['per_page'],
		                               $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['vales'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;

            //Si el estatus del registro es ACTIVO
			if($arrDet->estatus == 'ACTIVO')
			{
				//Si el registro cuenta con ordenes de compra
				if($arrDet->total_ordenes_compra > 0)
				{
					//Si el usuario cuenta con el permiso de acceso VER REGISTRO
					if (in_array('VER REGISTRO', $arrPermisos))
					{
						//Asignar cadena vacia para mostrar botón Ver registro
		        		$arrDet->mostrarAccionVerRegistro = '';	
					}
				}
				else
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
				
			}
			else
			{	
				//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
				if (in_array('CAMBIAR ESTATUS', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Restaurar
					$arrDet->mostrarAccionRestaurar = '';
				}

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
		$arrDatos = array('rows' => $result['vales'],
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
		//Crear un objeto vacio, stdClass es el objeto por defualt de PHP
		$objValeGasolina = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Datos del vale de gasolina
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objValeGasolina->intValeGasolinaID = $this->input->post('intValeGasolinaID');
		$objValeGasolina->dteFecha = $this->input->post('dteFecha');
		$objValeGasolina->intProveedorID = $this->input->post('intProveedorID');
		$objValeGasolina->strHora = $this->input->post('strHora');
		$objValeGasolina->strBomba = mb_strtoupper(trim($this->input->post('strBomba')));
		$objValeGasolina->strFactura = mb_strtoupper(trim($this->input->post('strFactura')));
		$objValeGasolina->intVehiculoID = $this->input->post('intVehiculoID');
		$objValeGasolina->intKilometraje = $this->input->post('intKilometraje');
		$objValeGasolina->intEmpleadoID = $this->input->post('intEmpleadoID');
		//Si no existe id del módulo asignar valor nulo
		$objValeGasolina->intModuloID = (($this->input->post('intModuloID') !== '') ? 
								          $this->input->post('intModuloID') : NULL);
		//Si no existe id de la sucursal asignar valor nulo
		$objValeGasolina->intSucursalID = (($this->input->post('intSucursalID') !== '') ? 
										    $this->input->post('intSucursalID') : NULL);
		$objValeGasolina->strDestino = mb_strtoupper(trim($this->input->post('strDestino')));
		$objValeGasolina->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los detalles
		$objValeGasolina->strArticulos = $this->input->post('strArticulos');
		$objValeGasolina->strLitros = $this->input->post('strLitros');
		$objValeGasolina->strSubtotales = $this->input->post('strSubtotales');    
		$objValeGasolina->strIvas = $this->input->post('strIvas');  
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;
		
		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objValeGasolina->intValeGasolinaID))
		{
			$bolResultado = $this->vales->modificar($objValeGasolina);
		}
		else
		{ 
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$objValeGasolina->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10, NULL, 'SI');
			//Si no existe folio del proceso
			if($objValeGasolina->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->vales->guardar($objValeGasolina);
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
		$intID = $this->input->post('intValeGasolinaID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->vales->buscar($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;

			//Seleccionar los detalles
			$otdDetallesVale = $this->vales->buscar_detalles($intID);
			//Si existen detalles para un vale
			if($otdDetallesVale)
			{
				$arrDatos['detalles'] = $otdDetallesVale;
			}

		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intValeGasolinaID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intValeGasolinaID');
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
			$bolResultado = $this->vales->set_estatus($intID, $strEstatus);
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
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $intVehiculoID,  
								$strEstatus, $strDetalles, $strBusqueda = NULL) 
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
		$otdResultado = $this->vales->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intVehiculoID,$strEstatus, $strBusqueda);

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
		$pdf->strLinea1=  'VALES DE GASOLINA '.$strTituloRangoFechas;
		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA', 'PROVEEDOR', 'EMPLEADO', 
								   utf8_decode('VEHÍCULO'), 'LITROS / IMPORTE', 
								   'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(17, 15, 53, 35, 30, 25, 15);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L', 'L', 'R', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('L', 'L', 'L');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(30, 30, 30 );
		//Agregar la primer pagina
		$pdf->AddPage();
		
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 

				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				//Array que se utiliza para agregar los detalles
		        $arrDetalles = array();
		        //Array que se utiliza para agregar los datos de un detalle
		        $arrAuxiliar = array();
		        //Variables acumuladoras para cada registro de los valores: litros e importe
		        $intAcumLitros = 0;
		        $intAcumSubtotal = 0;

				//Seleccionar los detalles del registro
				$otdDetalles = $this->vales->buscar_detalles($arrCol->vale_gasolina_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Variable que se utiliza para asignar el subtotal
						$intSubtotal = $arrDet->subtotal;

						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["articulo"] = utf8_decode($arrDet->articulo);
		                $arrAuxiliar["litros"] = number_format($arrDet->litros, 2);
		                $arrAuxiliar["subtotal"] = '$'.number_format($intSubtotal, 2);
		                //Asignar datos al array
                        array_push($arrDetalles, $arrAuxiliar); 

                        //Incrementar acumulados
						$intAcumLitros += $arrDet->litros;
						$intAcumSubtotal += $intSubtotal;
					}
				}//Cierre de verificación de detalles
				
				//Concatenar datos de los litros sobre importe
			    $strLitrosImpt = number_format($arrDet->litros, 2);
			    $strLitrosImpt .= ' / '.'$'.number_format($intAcumSubtotal, 2);

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, $arrCol->fecha,
								utf8_decode($arrCol->proveedor),
								utf8_decode($arrCol->empleado),
								utf8_decode($arrCol->vehiculo),
								$strLitrosImpt, $arrCol->estatus), 
							   $pdf->arrAlineacion,'ClippedCell');

		        //Si se cumple la sentencia mostrar detalles del registro
				if($arrDetalles && $strDetalles == 'SI')
				{

					//Asigna el tipo y tamaño de letra
			        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
					//Factura
					$pdf->Cell(11, 4, 'FACTURA:', 0, 0, 'L', 0);
				    $pdf->ClippedCell(12, 4, utf8_decode($arrCol->factura), 0, 0, 'L', 0);
			    	//Kilometros iniciales
			    	$pdf->Cell(13, 4, 'KM INICIAL:', 0, 0, 'L', 0);
				    $pdf->ClippedCell(13, 4, number_format($arrCol->kilometraje_inicial), 0, 0, 'L', 0);
					//Kilometros Final
					$pdf->Cell(12, 4, 'KM FINAL:', 0, 0, 'L', 0);
				    $pdf->ClippedCell(13, 4, number_format($arrCol->kilometraje_final), 0, 0, 'L', 0);
					//Kilometros Recorridos
					$pdf->Cell(20, 4, 'KM RECORRIDOS:', 0, 0, 'L', 0);
				    $pdf->ClippedCell(13, 4, number_format($arrCol->kilometraje_final - $arrCol->kilometraje_inicial), 0, 0, 'L', 0);
				    //Rendimiento 
				    $pdf->Cell(16, 4, 'RENDIMIENTO:', 0, 0, 'L', 0);
				    //Si existen litros
				    if($arrDet->litros > 0)
				    {
				    	$pdf->ClippedCell(13, 4, number_format( ($arrCol->kilometraje_final - $arrCol->kilometraje_inicial)/$arrDet->litros ), 0, 0, 'L', 0);
				    }
				    else
				    {
				    	$pdf->ClippedCell(13, 4, 'N/A', 0, 0, 'L', 0);
				    }
				    
				    //Rendimiento 
				    $pdf->Cell(11, 4, 'DESTINO:', 0, 0, 'L', 0);
				    $pdf->ClippedCell(30, 4, utf8_decode($arrCol->destino), 0, 0, 'L', 0);

					$pdf->Ln(5);//Deja un salto de línea
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraDetalles);
					//Recorremos el arreglo 
			        foreach ($arrDetalles as $arrDet) 
			        {
					   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array(utf8_decode($arrDet['articulo']), 
					    				'IMPORTE:'.' '.$arrDet['subtotal'], 
					    				'LITROS:'.' '.$arrDet['litros']), 
					    		  $arrAlineacionDetalles, 'ClippedCell');
					}
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
		$pdf->Output('vales_gasolina.pdf','I');
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro($intValeGasolinaID) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Buscar el registro
		$otdResultado = $this->vales->buscar($intValeGasolinaID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->vales->buscar_detalles($intValeGasolinaID);
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variable que se utiliza para asignar el acumulado de litros
		$intAcumLitros = 0;
		//Variable que se utiliza para asignar el acumulado del subtotal
		$intAcumSubtotal = 0;
		//Variable que se utiliza para asignar el acumulado del IVA
		$intAcumIva = 0;
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'vales_gasolina_';
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
			//Razón social
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
	        //---------- DATOS DEL VALE DE GASOLINA
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(108, 42);
			$pdf->ClippedCell(92, 3, 'VALE DE GASOLINA', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0);//establece el color de texto
			
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(108, 46);
			$pdf->ClippedCell(15, 3, 'FOLIO');
			//Fecha 
			$pdf->SetXY(154, 46);
			$pdf->ClippedCell(15, 3, 'FECHA');
			//Hora
		    $pdf->SetXY(108, 49);
			$pdf->ClippedCell(30, 3, 'HORA');
			//Bomba
		    $pdf->SetXY(154, 49);
			$pdf->ClippedCell(32, 3, 'BOMBA');
			//Factura
			$pdf->SetXY(108, 52);
			$pdf->ClippedCell(15, 3, 'FACTURA');
			//Estatus
			$pdf->SetXY(154, 52);
			$pdf->ClippedCell(25, 3, 'ESTATUS');
			//Empleado
			$pdf->SetXY(108, 55);
			$pdf->ClippedCell(30, 3, 'EMPLEADO');
			//Vehículo
			$pdf->SetXY(108, 58);
			$pdf->ClippedCell(30, 3, utf8_decode('VEHÍCULO'));
			//Placas
			$pdf->SetXY(108, 61);
			$pdf->ClippedCell(15, 3, 'PLACAS');
			//Kilometraje
			$pdf->SetXY(154, 61);
			$pdf->ClippedCell(25, 3, 'KILOMETRAJE');

			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(124, 46);
			$pdf->ClippedCell(76, 3, $otdResultado->folio);
			//Fecha
			$pdf->SetXY(178, 46);
			$pdf->ClippedCell(29, 3, $otdResultado->fecha);
			//Hora
			$pdf->SetXY(124, 49);
			$pdf->ClippedCell(30, 3, $otdResultado->hora_format);
			//Bomba
			$pdf->SetXY(178, 49);
			$pdf->ClippedCell(30, 3, $otdResultado->bomba);
			//Factura
			$pdf->SetXY(124, 52);
			$pdf->ClippedCell(29, 3, $otdResultado->factura);
			//Estatus
			$pdf->SetXY(178, 52);
			$pdf->ClippedCell(20, 3, $otdResultado->estatus);
			//Empleado
			$pdf->SetXY(124, 55);
			$pdf->ClippedCell(72, 3, $otdResultado->empleado);
			//Vehículo
			$pdf->SetXY(124, 58);
			$pdf->ClippedCell(72, 3, $otdResultado->vehiculo);
			//Placas
			$pdf->SetXY(124, 61);
			$pdf->ClippedCell(29, 3, $otdResultado->placas);
			//Kilometraje
			$pdf->SetXY(178, 61);
			$pdf->ClippedCell(20, 3, number_format($otdResultado->kilometraje, 2, '.', ','));

			//Si existe id de la sucursal
			if($otdResultado->sucursal_id > 0)
			{
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Sucursal
				$pdf->SetXY(108, 64);
				$pdf->ClippedCell(25, 3, 'SUCURSAL');
				//Sucursal
				$pdf->SetXY(108, 67);
				$pdf->ClippedCell(25, 3, utf8_decode('MÓDULO'));

				//Información
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Sucursal
				$pdf->SetXY(124, 64);
				$pdf->ClippedCell(72, 3, $otdResultado->sucursal);
				//Módulo
				$pdf->SetXY(124, 67);

				//Asignar la descripción del módulo
				$strModulo = $this->get_modulo($otdResultado->sucursal_id, $otdResultado->modulo);

				$pdf->ClippedCell(72, 3, utf8_decode($strModulo));
			}

			$pdf->Ln(9); //Deja un salto de línea
			$intPosY = $pdf->GetY();

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DEL VALE DE GASOLINA
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, $intPosY);
			$pdf->ClippedCell(185, 3, utf8_decode('CONCEPTOS'), 0, 0, 'C', TRUE);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			
			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				//Incrementar posición de la ordenada
				$intPosY += 4;
				//Tabla con los detalles del registro
				$pdf->SetXY(15, $intPosY);
				//Crea los titulos de la cabecera
				$arrCabecera = array(utf8_decode('Artículo'), 'Litros', 'Importe');
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(135, 25, 25);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'R', 'R');
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
					$intSubTotal = $arrDet->subtotal;
					$intLitros = $arrDet->litros;

					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(utf8_decode($arrDet->articulo),  
								    number_format($intLitros, 2), 
								    number_format($intSubTotal, 2)), 
							   $arrAlineacion, 'ClippedCell');

					//Incrementar acumulados
					$intAcumLitros += $intLitros;
					$intAcumSubtotal += $arrDet->subtotal;
					$intAcumIva +=  $arrDet->iva;
				}

			}//Cierre de verificación de detalles

			//Calcular importe total
			$intTotal = $intAcumSubtotal+$intAcumIva;

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
			//Destino
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(15);
			$pdf->ClippedCell(30, 3, 'DESTINO');
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
			//Totales
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetX(135);
			$pdf->ClippedCell(30, 3, 'TOTALES');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Total de litros
			$pdf->SetX(150);
			$pdf->ClippedCell(25, 3, number_format($intAcumLitros,2), 0, 0, 'R');
			//Importe total
			$pdf->SetX(175);
			$pdf->ClippedCell(25, 3, '$'.number_format($intTotal,2), 0, 0, 'R');
			//Destino
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, $intPosY);
			$pdf->MultiCell(110, 3, utf8_decode($otdResultado->destino));
			$pdf->Ln(8); //Deja un salto de línea
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Mensaje de prohibición
			$pdf->SetX(15);
			$pdf->ClippedCell(60, 3, utf8_decode('PROHIBIDA SU ALTERACIÓN, MAL USO O CANJE'));
		   //Persona que recibio el vale de gasolina
            $pdf->SetXY(15,260);
            //Persona que reviso el vale de gasolina
            $pdf->SetXY(109, 260);
            $pdf->Ln(5);//Espacios de salto de línea
            $pdf->SetX(15);
            //Persona que recibio el vale de gasolina
            //Asigna el tipo y tamaño de letra
            $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
            $pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
            $pdf->Cell(90, 3, 'RECIBIO', 0, 0, 'C',  TRUE);
            //Persona que reviso el vale de gasolina
            $pdf->SetXY(109, 265);
            $pdf->Cell(90, 3, 'REVISO', 0, 0, 'C',  TRUE);
            
            //Fecha y hora de impresión (pie de pagina)
			$pdf->strUsuarioCreacion = $otdResultado->usuario_creacion;
			$pdf->dteFechaCreacion = $otdResultado->fecha_creacion;
			$pdf->strIncluirMembrete = 'SI';

			//Concatenar folio para identificar vale de gasolina
			$strNombreArchivo .= $otdResultado->folio;

		}//Cierre de verificación de información
		
		//Ejecutar la salida del reporte
		$pdf->Output($strNombreArchivo.'.pdf','I'); 

	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $intVehiculoID,  $strEstatus, 
						    $strDetalles, $strBusqueda = NULL) 
	{	
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		$strEstatus = trim(urldecode($strEstatus));
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->vales->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intVehiculoID, 
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
		$objExcel->setActiveSheetIndex(0)->setCellValue('A7', 'VALES DE GASOLINA '.$strTituloRangoFechas);
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('C'.$intPosEncabezados, 'HORA')
        		 ->setCellValue('D'.$intPosEncabezados, 'BOMBA')
        		 ->setCellValue('E'.$intPosEncabezados, 'PROVEEDOR')
        		 ->setCellValue('F'.$intPosEncabezados, 'FACTURA')
        		 ->setCellValue('G'.$intPosEncabezados, 'VEHÍCULO')
        		 ->setCellValue('H'.$intPosEncabezados, 'PLACAS')
        		 ->setCellValue('I'.$intPosEncabezados, 'KILOMETRAJE INICIAL')
        		 ->setCellValue('J'.$intPosEncabezados, 'KILOMETRAJE FINAL')
        		 ->setCellValue('K'.$intPosEncabezados, 'KILOMETROS RECORRIDOS')
        		 ->setCellValue('L'.$intPosEncabezados, 'CORPORATIVO')
        		 ->setCellValue('M'.$intPosEncabezados, 'MÓDULO')
        		 ->setCellValue('N'.$intPosEncabezados, 'SUCURSAL')
        		 ->setCellValue('O'.$intPosEncabezados, 'EMPLEADO')
        		 ->setCellValue('P'.$intPosEncabezados, 'DESTINO')
        		 ->setCellValue('Q'.$intPosEncabezados, 'SUBTOTAL')
        		 ->setCellValue('R'.$intPosEncabezados, 'IVA')
        		 ->setCellValue('S'.$intPosEncabezados, 'TOTAL')
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

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:T9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

    	//Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A10:T9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:T9')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:T9')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

    	//Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('U'.$intPosEncabezados, 'ARTÍCULO')
			         ->setCellValue('V'.$intPosEncabezados, 'LITROS')
			         ->setCellValue('W'.$intPosEncabezados,'IMPORTE');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('U'.$intPosEncabezados.':W'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		//Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('U'.$intPosEncabezados.':W'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('U'.$intPosEncabezados.':W'.$intPosEncabezados)
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

				//Seleccionar los detalles del registro
				$otdDetalles = $this->vales->buscar_detalles($arrCol->vale_gasolina_id);

				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Variable que se utiliza para contar el número de detalles
				    $intContDet = 0;

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
						$intSubtotal = $arrDet->subtotal;
						
						//Agregar datos al array
						$arrDetalles[$intContDet]["articulo"] = $arrDet->articulo;
		                $arrDetalles[$intContDet]["litros"] = $arrDet->litros;
		                $arrDetalles[$intContDet]["importe"] = $intSubtotal;

		                 //Incrementar acumulados
						$intAcumSubtotal += $intSubtotal;
						$intAcumIva += $arrDet->iva;

						//Incrementar el contador por cada registro
	                    $intContDet++;
					}

				}//Cierre de verificación de detalles

				//Calcular importe total
				$intTotal = $intAcumSubtotal+$intAcumIva;

				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    {

			    	//Asignar el kilometraje inicial
			    	$intKilometrajeInicial =  $arrCol->kilometraje_inicial;
			    	//Asignar el kilometraje final
			    	$intKilometrajeFinal =  $arrCol->kilometraje_final;
			    	//Calcular kilometraje recorrido
			    	$intKilometrosRecorridos =  $intKilometrajeFinal - $intKilometrajeInicial;

					//Asignar la descripción del módulo
					$strModulo = $this->get_modulo($arrCol->sucursal_id, $arrCol->modulo);

			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
	                         ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('B'.$intFila, $arrCol->fecha)
	                         ->setCellValue('C'.$intFila, $arrCol->hora_format)
	                         ->setCellValue('D'.$intFila, $arrCol->bomba)
	                         ->setCellValue('E'.$intFila, $arrCol->proveedor)
	                         ->setCellValue('F'.$intFila, $arrCol->factura)
	                         ->setCellValue('G'.$intFila, $arrCol->vehiculo)
	                         ->setCellValue('H'.$intFila, $arrCol->placas)
	                         ->setCellValue('I'.$intFila, $intKilometrajeInicial)
	                         ->setCellValue('J'.$intFila, $intKilometrajeFinal)
	                         ->setCellValue('K'.$intFila, $intKilometrosRecorridos)
	                         ->setCellValue('L'.$intFila, $arrCol->corporativo)
	                         ->setCellValue('M'.$intFila, $strModulo)
	                         ->setCellValue('N'.$intFila, $arrCol->sucursal)
	                         ->setCellValue('O'.$intFila, $arrCol->empleado)
	                         ->setCellValue('P'.$intFila, $arrCol->destino)
	                         ->setCellValue('Q'.$intFila, $intAcumSubtotal)
	                         ->setCellValue('R'.$intFila, $intAcumIva)
	                         ->setCellValue('S'.$intFila, $intTotal)
	                         ->setCellValue('T'.$intFila, $arrCol->estatus);


	                //Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
						 		 ->setCellValue('U'.$intFila,  $arrDetalles[$intContDet]['articulo'])
						         ->setCellValue('V'.$intFila,  $arrDetalles[$intContDet]['litros'])
						         ->setCellValue('W'.$intFila,  $arrDetalles[$intContDet]['importe']);
					}

					//Incrementar el indice para escribir los datos del siguiente registro
	                $intFila++; 
			    }

				
                //Incrementar el contador por cada registro
				$intContador++;
			}
			

			//Cambiar contenido de las celdas a formato númerico
            $objExcel->getActiveSheet()
            		 ->getStyle('I'.$intFilaInicial.':'.'K'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

			//Cambiar contenido de las celdas a formato númerico de 2 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('V'.$intFilaInicial.':'.'V'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('###0.00');

            //Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('O'.$intFilaInicial.':'.'S'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            $objExcel->getActiveSheet()
            		 ->getStyle('W'.$intFilaInicial.':'.'W'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            //Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

    		$objExcel->getActiveSheet()
		        	 ->getStyle('I'.$intFilaInicial.':'.'K'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			$objExcel->getActiveSheet()
                	 ->getStyle('L'.$intFilaInicial.':'.'L'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('O'.$intFilaInicial.':'.'S'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			$objExcel->getActiveSheet()
                	 ->getStyle('T'.$intFilaInicial.':'.'T'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

		    $objExcel->getActiveSheet()
                	 ->getStyle('U'.$intFilaInicial.':'.'U'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

             $objExcel->getActiveSheet()
		        	 ->getStyle('V'.$intFilaInicial.':'.'W'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);
                	 
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
        $this->get_pie_pagina_archivo_excel($objExcel, 'vales_gasolina.xls', 'vales de gasolina', $intFila);
	}


	//Función que se utiliza para regresar la descripción del módulo
	public function get_modulo($intSucursalID, $strModulo)
	{
		//Si existe id de la sucursal
		if($intSucursalID > 0)
		{
			//Si no existe descripción del módulo
			if($strModulo == '')
			{	
				$strModulo = 'ADMINISTRACIÓN';
			}
		}

		//Regresar la descripción del módulo
		return  $strModulo;
	}

}