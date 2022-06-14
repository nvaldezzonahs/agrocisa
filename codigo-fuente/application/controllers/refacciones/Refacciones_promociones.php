<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones_promociones extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de promociones
		$this->load->model('refacciones/refacciones_promociones_model', 'promociones');
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
		$this->cargar_vista('refacciones/refacciones_promociones', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->promociones->filtro($this->input->post('dteFechaInicial'),
											 $this->input->post('dteFechaFinal'),
											 $this->input->post('intSucursalID'),
			                                 $config['per_page'],
			                                 $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['promociones'] as $arrDet)
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
					$arrDet->mostrarAccionVerRegistro = '';
				}
				
				//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
				if (in_array('CAMBIAR ESTATUS', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Restaurar
					$arrDet->mostrarAccionRestaurar = '';
				}
				
			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['promociones'],
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
		$objRefaccionPromocion = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista
		//Datos de la promoción
		$objRefaccionPromocion->intRefaccionPromocionID = $this->input->post('intRefaccionPromocionID');
		$objRefaccionPromocion->dteFechaInicio = $this->input->post('dteFechaInicio');
		$objRefaccionPromocion->dteFechaFinal = $this->input->post('dteFechaFinal');
		//Si no existe id de la sucursal asignar valor nulo
		$objRefaccionPromocion->intSucursalID = (($this->input->post('intSucursalID') !== '') ? 
						   				          $this->input->post('intSucursalID') : NULL);
		$objRefaccionPromocion->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los detalles
		$objRefaccionPromocion->strTipos = $this->input->post('strTipos');
		$objRefaccionPromocion->strReferenciaID = $this->input->post('strReferenciaID'); 
		$objRefaccionPromocion->strDescuentos = $this->input->post('strDescuentos');
		
		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objRefaccionPromocion->intRefaccionPromocionID))
		{
			$bolResultado = $this->promociones->modificar($objRefaccionPromocion);
		}
		else
		{ 
			$bolResultado = $this->promociones->guardar($objRefaccionPromocion);
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
		$intID = $this->input->post('intRefaccionPromocionID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->promociones->buscar($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
			
			//Seleccionar los detalles del registro
			$otdDetalles = $this->promociones->buscar_detalles($otdResultado->refaccion_promocion_id);
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
		$this->form_validation->set_rules('intRefaccionPromocionID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intRefaccionPromocionID');
		    $strEstatus = $this->input->post('strEstatus');

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->promociones->set_estatus($intID, $strEstatus);
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
		$strTipo =  $this->input->post('strTipo');
		$dteFecha = $this->input->post('dteFecha');
		$intRefaccionesListaPrecioID = $this->input->post('intRefaccionesListaPrecioID');
		$strListaPrecioCte = $this->input->post('strListaPrecioCte');

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->promociones->autocomplete($strDescripcion, $strTipo, $dteFecha, 
															 $intRefaccionesListaPrecioID, $strListaPrecioCte);
			
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
					/*************************************************************************************
					*Array ques se utiliza para agregar datos del registro
					**************************************************************************************/
					$arrRegistro = array('value' => $arrCol->referencia,
								  	     'data' => $arrCol->referencia_id,
								  		 'tipo_referencia' => $arrCol->tipo_referencia);

					//Si existe fecha para la búsqueda del descuento de promoción
					if($dteFecha != '')
					{
						//Agregar elemento en el array
						$arrRegistro['descuento_promocion'] = $arrCol->descuento_promocion; 
						$arrRegistro['descuento_linea'] = $arrCol->descuento_linea; 
					}

		        	$arrDatos[] = $arrRegistro;
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
		$intSucursalID = $this->input->post('intSucursalID');
		$strDetalles = $this->input->post('strDetalles');

		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->promociones->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intSucursalID);
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
		$pdf->strLinea1 =  'LISTADO DE PROMOCIONES '.$strTituloRangoFechas;
		//Si existe id de la sucursal
		if($intSucursalID > 0)
		{
			//Seleccionar los datos de la sucursal que coincide con el id
			$otdSucursal =  $this->sucursales->buscar($intSucursalID);
			$pdf->strLinea2 =  'SUCURSAL: '.utf8_decode($otdSucursal->nombre);
		}


		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FECHA INICIAL', 'FECHA FINAL', 'SUCURSAL', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(25, 25, 120, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('C', 'C', 'L', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('L',  'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(70, 25);
		//Agregar la primer pagina
		$pdf->AddPage();
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo para obtener la información de las promociones
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->fecha_inicio, $arrCol->fecha_final, 
								utf8_decode($arrCol->sucursal), $arrCol->estatus), 
						  $pdf->arrAlineacion, 'ClippedCell');

				//Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
					//Seleccionar los detalles del registro
					$otdDetalles = $this->promociones->buscar_detalles($arrCol->refaccion_promocion_id);
					//Verificar si existe información de los detalles 
					if($otdDetalles)
					{
						$pdf->Ln(1);//Deja un salto de línea
						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraDetalles);
						//Recorremos el arreglo 
				        foreach ($otdDetalles as $arrDet) 
				        {
						   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						    $pdf->Row(array(utf8_decode($arrDet->referencia), $arrDet->descuento.'%'), 
						    			    $arrAlineacionDetalles, 'ClippedCell');
						}
					}//Cierre de verificación de detalles

					$pdf->Ln(5);//Deja un salto de línea
				}

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
		$pdf->Output('promociones_refacciones.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intSucursalID = $this->input->post('intSucursalID');
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
		$otdResultado = $this->promociones->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intSucursalID);
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
			     ->setCellValue('A7', 'LISTADO DE PROMOCIONES');
		//Si existe id de la sucursal
		if($intSucursalID > 0)
		{   //Seleccionar los datos de la sucursal que coincide con el id
			$otdSucursal =  $this->sucursales->buscar($intSucursalID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'SUCURSAL: '.$otdSucursal->nombre);
		}
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FECHA INICIAL')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA FINAL')
        		 ->setCellValue('C'.$intPosEncabezados, 'SUCURSAL')
                 ->setCellValue('D'.$intPosEncabezados, 'ESTATUS');

        //Definir estilos de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE,
    													'color' => array('rgb' => 'ffffff')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo para cambiar el formato de la celda a porcentaje
        $arrStylePorcentaje = array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

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
    			 ->getStyle('A10:D10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:D10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:D10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
                     ->setCellValue('E'.$intPosEncabezados, 'REFERENCIA')
			         ->setCellValue('F'.$intPosEncabezados, 'DESCUENTO');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('E'.$intPosEncabezados.':F'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('E'.$intPosEncabezados.':F'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('E'.$intPosEncabezados.':F'.$intPosEncabezados)
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
					$otdDetalles = $this->promociones->buscar_detalles($arrCol->refaccion_promocion_id);
					//Verificar si existe información de los detalles 
					if($otdDetalles)
					{
						//Variable que se utiliza para contar el número de detalles
				    	$intContDetPro = 0;
				    	//Asignar el número de detalles
				    	$intNumDetalles = count($otdDetalles);

						//Recorremos el arreglo 
				        foreach ($otdDetalles as $arrDet) 
				        {
				        	//Convertir cantidad a porcentaje para que aparezca correctamente al cambiar el formato de la celda
				        	$arrDet->descuento = $arrDet->descuento / 100;

				        	//Agregar datos al array
				        	$arrDetalles[$intContDetPro]["referencia"] = $arrDet->referencia;
							$arrDetalles[$intContDetPro]["descuento"] = $arrDet->descuento;

							//Incrementar el contador por cada registro
	                    	$intContDetPro++;
						}

					}//Cierre de verificación de detalles

				}

				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    {
			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValue('A'.$intFila, $arrCol->fecha_inicio)
					 		 ->setCellValue('B'.$intFila, $arrCol->fecha_final)
					 		 ->setCellValue('C'.$intFila, $arrCol->sucursal)
					 		 ->setCellValue('D'.$intFila, $arrCol->estatus);

					//Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
								 ->setCellValueExplicit('E'.$intFila, $arrDetalles[$intContDet]['referencia'], PHPExcel_Cell_DataType::TYPE_STRING)
			                     ->setCellValue('F'.$intFila, $arrDetalles[$intContDet]['descuento']);
					}

					//Incrementar el indice para escribir los datos del siguiente registro
	                $intFila++; 
			    }

                //Incrementar el contador por cada registro
				$intContador++;
			}

			//Cambiar contenido de las celdas a formato porcentaje
			$objExcel->getActiveSheet()
            		 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
            		 ->getNumberFormat()
            		 ->applyFromArray($arrStylePorcentaje);

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('A'.$intFilaInicial.':'.'B'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
		        	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('D'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('D'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'promociones_refacciones.xls', 'promociones de refacciones', $intFila);
	}
}