<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('servicio/servicios_model', 'servicios');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('servicio/servicios', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->servicios->filtro(trim($this->input->post('strBusqueda')),
										   NULL,
			                               $config['per_page'],
			                               $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['servicios'] as $arrDet)
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
		$arrDatos = array('rows' => $result['servicios'],
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

	{   //Crear un objeto vacio, stdClass es el objeto por defualt de PHP
		$objServicio = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objServicio->intServicioID = $this->input->post('intServicioID');
		$objServicio->strCodigo = mb_strtoupper(trim($this->input->post('strCodigo')));
		$objServicio->strCodigoAnterior = mb_strtoupper(trim($this->input->post('strCodigoAnterior')));
		$objServicio->intProductoServicioID = $this->input->post('intProductoServicioID');
		$objServicio->intUnidadID = $this->input->post('intUnidadID');
		//Si no existe id del objeto impuesto asignar valor nulo
		$objServicio->intObjetoImpuestoID = (($this->input->post('intObjetoImpuestoID') !== '') ? 
										      $this->input->post('intObjetoImpuestoID') : NULL);

		$objServicio->strDescripcion = mb_strtoupper(trim($this->input->post('strDescripcion')));
		$objServicio->intHoras = trim($this->input->post('intHoras'));
		$objServicio->intTasaCuotaIva = $this->input->post('intTasaCuotaIva');
		$objServicio->intTasaCuotaIeps = ($this->input->post('intTasaCuotaIeps') == ''? NULL: $this->input->post('intTasaCuotaIeps'));
		$objServicio->intUsuarioID = $this->session->userdata('usuario_id');
		
        //Definir las reglas de validación
		//Validar que el código sea único
        if (($objServicio->intServicioID == '') OR 
        	($objServicio->strCodigoAnterior != $objServicio->strCodigo))
        {
            $this->form_validation->set_rules('strCodigo', 'código', 'required|is_unique[servicios.codigo]');
        }
        else
        {
        	$this->form_validation->set_rules('strCodigo', 'código', 'required');
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
			if (is_numeric($objServicio->intServicioID))
			{
				$bolResultado = $this->servicios->modificar($objServicio);
			}
			else
			{ 
				$bolResultado = $this->servicios->guardar($objServicio);
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
		$strBusqueda = $this->input->post('strBusqueda');
		$strTipo = $this->input->post('strTipo');
		//Dependiendo del tipo realizar la búsqueda de datos
		//Seleccionar los datos del registro que coincide con el parámetro enviado
		if($strTipo == 'id')
		{
			$otdResultado = $this->servicios->buscar($strBusqueda);
		}
		else 
		{
    		$otdResultado = $this->servicios->buscar(NULL, $strBusqueda);
		}
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para regresar los datos de un precio correspondiente a un servicio-equipo
	public function get_servicio_equipo_precio(){
		
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intServicioTipoID = $this->input->post('intServicioTipoID');
		$intEquipoTipoID = $this->input->post('intEquipoTipoID');
		//Dependiendo del tipo realizar la búsqueda de datos
		//Seleccionar los datos del registro que coincide con los parámetros enviados

		$otdResultado = $this->servicios->buscar_servicio_equipo_precio($intServicioTipoID, $intEquipoTipoID);
		
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['precio'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));	

	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intServicioID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intServicioID');
		    $strEstatus = $this->input->post('strEstatus');

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->servicios->set_estatus($intID, $strEstatus);
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

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->servicios->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->servicio, 
		        						'data' => $arrCol->servicio_id);
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
		$strBusqueda = trim($this->input->post('strBusqueda'));
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->servicios->buscar(NULL, NULL, $strBusqueda); 
		
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'LISTADO DE SERVICIOS';
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('CÓDIGO'),utf8_decode('DESCRIPCIÓN'),
								  utf8_decode('CÓDIGO SAT'), 'UNIDAD SAT','IVA %',
								  'IEPS %', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(20, 40, 40, 30,20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L','R','R','C');
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
				$pdf->Row(array($arrCol->codigo, utf8_decode($arrCol->descripcion), 
								utf8_decode($arrCol->producto_servicio), 
								utf8_decode($arrCol->unidad), 
								$arrCol->porcentaje_iva, $arrCol->porcentaje_ieps,
								$arrCol->estatus), $pdf->arrAlineacion);

				//Asigna el tipo y tamaño de letra
			    $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
			     //Si existe id del objeto de impuesto
			    if($arrCol->objeto_impuesto_id > 0)
			    {
			    	 //Objeto de impuesto 
			    	$pdf->Cell(30, 4, 'OBJETO DE IMPUESTO SAT:', 0, 0, 'L', 0);
				    $pdf->ClippedCell(52, 4,utf8_decode($arrCol->objeto_impuesto), 0, 0, 'L', 0);
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
		$pdf->Output('servicios.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$strBusqueda = trim($this->input->post('strBusqueda'));
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;

        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->servicios->buscar(NULL, NULL, $strBusqueda); 
     	
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE SERVICIOS');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'CÓDIGO')
        		 ->setCellValue('B'.$intPosEncabezados, 'DESCRIPCIÓN')
        		 ->setCellValue('C'.$intPosEncabezados, 'CÓDIGO SAT')
        		 ->setCellValue('D'.$intPosEncabezados, 'UNIDAD SAT')
        		 ->setCellValue('E'.$intPosEncabezados, 'OBJETO DE IMPUESTO SAT')
        		 ->setCellValue('F'.$intPosEncabezados, 'IVA %')
        		 ->setCellValue('G'.$intPosEncabezados, 'IEPS %')
        		 ->setCellValue('H'.$intPosEncabezados, 'TIEMPO')
                 ->setCellValue('I'.$intPosEncabezados, 'ESTATUS');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
        		 ->getStyle('A9:I9')
        		 ->getFill()
        		 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFila, $arrCol->codigo)
                         ->setCellValue('B'.$intFila, $arrCol->descripcion)
                         ->setCellValueExplicit('C'.$intFila, $arrCol->producto_servicio, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValueExplicit('D'.$intFila, $arrCol->unidad, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValueExplicit('E'.$intFila, $arrCol->objeto_impuesto, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValueExplicit('F'.$intFila, $arrCol->porcentaje_iva, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValueExplicit('G'.$intFila, $arrCol->porcentaje_ieps, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('H'.$intFila, $arrCol->horas)
                         ->setCellValue('I'.$intFila, $arrCol->estatus);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar contenido de las celdas a formato númerico
            $objExcel->getActiveSheet()
            		 ->getStyle('H'.$intFilaInicial.':'.'H'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
            		 
			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('F'.$intFilaInicial.':'.'H'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);
                	 
			$objExcel->getActiveSheet()
                	 ->getStyle('I'.$intFilaInicial.':'.'I'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('I'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('I'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'servicios.xls', 'servicios', $intFila);
	}
}