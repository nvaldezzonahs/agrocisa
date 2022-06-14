<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios_programacion extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('servicio/servicios_programacion_model', 'programacion');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('servicio/servicios_programacion', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->programacion->filtro($this->input->post('dteFechaInicial'),
											  $this->input->post('dteFechaFinal'),
											  $this->input->post('intProspectoID'),
											  $this->input->post('intMecanicoID'),
											  trim($this->input->post('strEstatus')),
										 	  trim($this->input->post('strBusqueda')),
				                              $config['per_page'],
				                              $config['cur_page']);		
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['programacion'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro =  'registro-'.$arrDet->estatus;

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

				//Dependiendo del tipo signar el color de fondo
				if($arrDet->tipo == 'NORMAL')
				{
					$arrDet->estiloRegistro = '';
				}
				else if($arrDet->tipo == 'PRIORIDAD')
				{
					$arrDet->estiloRegistro = 'registro-PRIORIDAD';
				}
				else
				{
					$arrDet->estiloRegistro = 'registro-URGENTE';
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
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['programacion'],
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
		$objServicioProgramacion = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objServicioProgramacion->intServicioProgramacionID = $this->input->post('intServicioProgramacionID');
		$objServicioProgramacion->dteFecha = $this->input->post('dteFecha');
		$objServicioProgramacion->dteFechaAnterior = $this->input->post('dteFechaAnterior');
		$objServicioProgramacion->strTipo = $this->input->post('strTipo');
		$objServicioProgramacion->strUbicacion = $this->input->post('strUbicacion');
		$objServicioProgramacion->intProspectoID = $this->input->post('intProspectoID');
		$objServicioProgramacion->strTelefono = $this->input->post('strTelefono');
		$objServicioProgramacion->intMecanicoID = $this->input->post('intMecanicoID');
		$objServicioProgramacion->intMecanicoIDAnterior = $this->input->post('intMecanicoIDAnterior');
		$objServicioProgramacion->strActividad = mb_strtoupper(trim($this->input->post('strActividad')));
		$objServicioProgramacion->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		//Si no existe id de la orden de reparación asignar valor nulo
		$objServicioProgramacion->intOrdenReparacionID = (($this->input->post('intOrdenReparacionID') != '') ? 
							   			      			   $this->input->post('intOrdenReparacionID') : NULL);

		$objServicioProgramacion->intSucursalID = $this->session->userdata('sucursal_id');
		$objServicioProgramacion->intUsuarioID = $this->session->userdata('usuario_id');
		$intProcesoMenuID = $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

        //Definir las reglas de validación
		//Validar que el mecanico sea único en la fecha
        if (($objServicioProgramacion->intServicioProgramacionID == '') OR 
        	($objServicioProgramacion->dteFechaAnterior != $objServicioProgramacion->dteFecha) OR
        	($objServicioProgramacion->intMecanicoIDAnterior != $objServicioProgramacion->intMecanicoID))
        {
        	$this->form_validation->set_rules('intMecanicoID', 'mecánico', 
        									  'required|callback_get_existencia['.$objServicioProgramacion->dteFecha.']');
        }
        else
        {
        	$this->form_validation->set_rules('intMecanicoID', 'mecánico', 'required');
        }

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
			//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
			if (is_numeric($objServicioProgramacion->intServicioProgramacionID))
			{
				$bolResultado = $this->programacion->modificar($objServicioProgramacion);
			}
			else
			{ 
				//Hacer un llamado a la función para generar el folio consecutivo del proceso
				$objServicioProgramacion->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
				//Si no existe folio del proceso
				if($objServicioProgramacion->strFolio == '')
				{
					//Enviar el mensaje de error al formulario
					$arrDatos = array('resultado' => FALSE,
								      'tipo_mensaje' => TIPO_MSJ_ERROR,
						              'mensaje' => MSJ_GENERAR_FOLIO);
				}
				else
				{
					$bolResultado = $this->programacion->guardar($objServicioProgramacion); 
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
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Verifica la existencia del mecánico en la fecha
	//para evitar duplicación de datos al momento de modificar o guardar un registro.
    public function get_existencia($intMecanicoID, $dteFecha) 
    {	
    	//Concatenar datos para realizar la búsqueda
    	$strCriteriosBusq = $dteFecha.'|'.$intMecanicoID;

		//Hacer un llamado al método para comprobar la existencia del mecánico en la fecha
		$otdResultado = $this->programacion->buscar(NULL, $strCriteriosBusq);
		//Si existen datos
		if($otdResultado)
		{
		    //Enviar mensaje de error
		    $this->form_validation->set_message('get_existencia', 'EL  %s ya ha sido registrado con la misma fecha y hora, favor de verificar.');
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
		$strBusqueda = $this->input->post('strBusqueda');
		$strTipo = $this->input->post('strTipo');
		//Dependiendo del tipo realizar la búsqueda de datos
		//Seleccionar los datos del registro que coincide con el parámetro enviado
		if($strTipo == 'id')
		{
			$otdResultado = $this->programacion->buscar($strBusqueda);
		}
		else
		{
			//Se recupera cadena concatenada con los criterios de búsqueda: fecha|mecanicoID
    		$otdResultado = $this->programacion->buscar(NULL, $strBusqueda);
		}
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
		$this->form_validation->set_rules('intServicioProgramacionID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intServicioProgramacionID');
		    $strEstatus = $this->input->post('strEstatus');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->programacion->set_estatus($intID, $strEstatus);
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
		$intProspectoID = $this->input->post('intProspectoID');
		$intMecanicoID = $this->input->post('intMecanicoID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->programacion->buscar(NULL, NULL, $dteFechaInicial, $dteFechaFinal, 
													$intProspectoID, $intMecanicoID, $strEstatus, $strBusqueda);
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
		$pdf->strLinea1 =  utf8_decode('PROGRAMACIÓN DE SERVICIOS ').$strTituloRangoFechas;
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA', 'CLIENTE', utf8_decode('TELÉFONO'), 
								  utf8_decode('MECÁNICO'), 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(20, 30, 52, 18, 50, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L', 'L', 'C');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, $arrCol->fecha_rep, utf8_decode($arrCol->cliente),  
							    $arrCol->telefono, utf8_decode($arrCol->mecanico), $arrCol->estatus), 
								$pdf->arrAlineacion);

				//Si existe el id de la orden de reparación
				if($arrCol->orden_reparacion_id > 0)
				{
					//Asigna el tipo y tamaño de letra
			        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
					//Orden de reparación
					$pdf->Cell(18, 4, 'NO. DE ORDEN:', 0, 0, 'L', 0);
				    $pdf->ClippedCell(20, 4, $arrCol->folio_orden_reparacion, 0, 0, 'L', 0);
				    $pdf->Ln(5);//Deja un salto de línea
				}
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
		$pdf->Output('programacion_servicios.pdf','I'); 
	}
	
	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProspectoID = $this->input->post('intProspectoID');
		$intMecanicoID = $this->input->post('intMecanicoID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));
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
		$otdResultado = $this->programacion->buscar(NULL, NULL, $dteFechaInicial, $dteFechaFinal, 
													$intProspectoID, $intMecanicoID, $strEstatus, $strBusqueda);
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
			     ->setCellValue('A7', 'PROGRAMACIÓN DE SERVICIOS '.$strTituloRangoFechas);
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('C'.$intPosEncabezados, 'HORA')
        		 ->setCellValue('D'.$intPosEncabezados, 'TIPO')
        		 ->setCellValue('E'.$intPosEncabezados, 'UBICACIÓN')
        		 ->setCellValue('F'.$intPosEncabezados, 'CLIENTE')
        		 ->setCellValue('G'.$intPosEncabezados, 'TELÉFONO')
        		 ->setCellValue('H'.$intPosEncabezados, 'ORDEN DE REPARACIÓN')
        		 ->setCellValue('I'.$intPosEncabezados, 'MECÁNICO')
        		 ->setCellValue('J'.$intPosEncabezados, 'ACTIVIDAD')
        		 ->setCellValue('K'.$intPosEncabezados, 'OBSERVACIONES')
        		 ->setCellValue('L'.$intPosEncabezados, 'ESTATUS');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:L9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
				 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->fecha)
                         ->setCellValue('C'.$intFila, $arrCol->hora)
                         ->setCellValue('D'.$intFila, $arrCol->tipo)
                         ->setCellValue('E'.$intFila, $arrCol->ubicacion)
                         ->setCellValue('F'.$intFila, $arrCol->cliente)
                         ->setCellValue('G'.$intFila, $arrCol->telefono)
                         ->setCellValueExplicit('H'.$intFila, $arrCol->folio_orden_reparacion, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('I'.$intFila, $arrCol->mecanico)
                         ->setCellValue('J'.$intFila, $arrCol->actividad)
                         ->setCellValue('K'.$intFila, $arrCol->observaciones)
                         ->setCellValue('L'.$intFila, $arrCol->estatus);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}
				
           //Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
                	  
			$objExcel->getActiveSheet()
                	 ->getStyle('L'.$intFilaInicial.':'.'L'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
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
        $this->get_pie_pagina_archivo_excel($objExcel, 'programacion_servicios.xls', 'programación de servicios', $intFila);
	}
}