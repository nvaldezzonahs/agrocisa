<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehiculos extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('control_vehiculos/vehiculos_model', 'vehiculos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('control_vehiculos/vehiculos', $arrDatos);
	}
	
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->vehiculos->filtro(trim($this->input->post('strBusqueda')), $config['per_page'], $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['vehiculos'] as $arrDet)
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
		$arrDatos = array('rows' => $result['vehiculos'],
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
		$objVehiculo = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
		$objVehiculo->intVehiculoID = $this->input->post('intVehiculoID');
		$objVehiculo->strCodigo = mb_strtoupper(trim($this->input->post('strCodigo')));
		$objVehiculo->strCodigoAnterior = mb_strtoupper(trim($this->input->post('strCodigoAnterior')));
		$objVehiculo->strModelo = mb_strtoupper(trim($this->input->post('strModelo')));
		$objVehiculo->strMarca = mb_strtoupper(trim($this->input->post('strMarca')));
		$objVehiculo->strAnio = $this->input->post('strAnio');
		$objVehiculo->strSerie = mb_strtoupper(trim($this->input->post('strSerie')));
		$objVehiculo->strPlacas = mb_strtoupper(trim($this->input->post('strPlacas')));
		$objVehiculo->intEstadoID = $this->input->post('intEstadoID');
		$objVehiculo->intCosto = $this->input->post('intCosto');
		$objVehiculo->intKilometraje = $this->input->post('intKilometraje');
		$objVehiculo->intResponsableID = $this->input->post('intResponsableID');
		//Si no existe id del módulo asignar valor nulo
		$objVehiculo->intModuloID = (($this->input->post('intModuloID') !== '') ? 
								    $this->input->post('intModuloID') : NULL);
		$objVehiculo->intDepartamentoID = $this->input->post('intDepartamentoID');
		//Si no existe id de la sucursal asignar valor nulo
		$objVehiculo->intSucursalID = (($this->input->post('intSucursalID') !== '') ? 
										  $this->input->post('intSucursalID') : NULL);
	    $objVehiculo->strAseguradora = mb_strtoupper(trim($this->input->post('strAseguradora')));
		$objVehiculo->strPoliza = mb_strtoupper(trim($this->input->post('strPoliza')));
		//Si la fecha esta vacia asignar valor nulo
		$objVehiculo->dteFechaRenovacion = (($this->input->post('dteFechaRenovacion') !== '') ? 
											$this->input->post('dteFechaRenovacion') : NULL);
		$objVehiculo->intCostoPoliza = $this->input->post('intCostoPoliza');
		$objVehiculo->strVerificacionFederal = $this->input->post('strVerificacionFederal');
		$objVehiculo->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objVehiculo->intUsuarioID = $this->session->userdata('usuario_id');

        //Definir las reglas de validación
		//Validar que el código sea único
        if (($objVehiculo->intVehiculoID == '') OR ($objVehiculo->strCodigoAnterior != $objVehiculo->strCodigo))
        {
            $this->form_validation->set_rules('strCodigo', 'código', 'required|is_unique[vehiculos.codigo]');
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
			if (is_numeric($objVehiculo->intVehiculoID))
			{
				$bolResultado = $this->vehiculos->modificar($objVehiculo);
			}
			else
			{ 
				$bolResultado = $this->vehiculos->guardar($objVehiculo);
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
			$otdResultado = $this->vehiculos->buscar($strBusqueda);
		}
		else 
		{
    		$otdResultado = $this->vehiculos->buscar(NULL, $strBusqueda);
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
		$this->form_validation->set_rules('intVehiculoID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intVehiculoID');
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
			$bolResultado = $this->vehiculos->set_estatus($intID, $strEstatus);
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
			$otdResultado = $this->vehiculos->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->vehiculo, 
		        						'data' => $arrCol->vehiculo_id);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}

	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($strBusqueda = NULL) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->vehiculos->buscar(NULL, NULL, $strBusqueda); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = utf8_decode('LISTADO DE VEHÍCULOS');
	  	//Establece los títulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('CÓDIGO'), 'MODELO', 'MARCA', 'PLACAS', 
								  'RESPONSABLE', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(15, 40, 45, 20, 50, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L','L', 'L', 'L', 'L', 'C');
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
				$pdf->Row(array($arrCol->codigo, 
								utf8_decode($arrCol->modelo), 
								utf8_decode($arrCol->marca), 
								utf8_decode($arrCol->placas),
								utf8_decode($arrCol->responsable),
								$arrCol->estatus), 
								$pdf->arrAlineacion);
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
		$pdf->Output('vehiculos.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($strBusqueda = NULL) 
	{	
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->vehiculos->buscar(NULL, NULL, $strBusqueda); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE VEHÍCULOS');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'CÓDIGO')
                 ->setCellValue('B'.$intPosEncabezados, 'MODELO')
                 ->setCellValue('C'.$intPosEncabezados, 'MARCA')
                 ->setCellValue('D'.$intPosEncabezados, 'AÑO')
                 ->setCellValue('E'.$intPosEncabezados, 'SERIE')
                 ->setCellValue('F'.$intPosEncabezados, 'COSTO')
                 ->setCellValue('G'.$intPosEncabezados, 'RESPONSABLE')
                 ->setCellValue('H'.$intPosEncabezados, 'MÓDULO')
                 ->setCellValue('I'.$intPosEncabezados, 'DEPARTAMENTO')
                 ->setCellValue('J'.$intPosEncabezados, 'CORPORATIVO')
                 ->setCellValue('K'.$intPosEncabezados, 'SUCURSAL')
                 ->setCellValue('L'.$intPosEncabezados, 'LICENCIA')
                 ->setCellValue('M'.$intPosEncabezados, 'TIPO DE LICENCIA')
                 ->setCellValue('N'.$intPosEncabezados, 'VIGENCIA DE LICENCIA')
                 ->setCellValue('O'.$intPosEncabezados, 'PLACAS')
                 ->setCellValue('P'.$intPosEncabezados, 'ESTADO')
                 ->setCellValue('Q'.$intPosEncabezados, 'ASEGURADORA')
                 ->setCellValue('R'.$intPosEncabezados, 'PÓLIZA')
                 ->setCellValue('S'.$intPosEncabezados, 'RENOVACIÓN')
                 ->setCellValue('T'.$intPosEncabezados, 'COSTO POLIZA')
                 ->setCellValue('U'.$intPosEncabezados, 'KILOMETRAJE')
                 ->setCellValue('V'.$intPosEncabezados, 'VERIFICACIÓN FEDERAL')
                 ->setCellValue('W'.$intPosEncabezados, 'OBSERVACIONES')
                 ->setCellValue('X'.$intPosEncabezados, 'ESTATUS');
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
    			 ->getStyle('A9:X9')
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
						 ->setCellValueExplicit('A'.$intFila, $arrCol->codigo, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->modelo)
                         ->setCellValue('C'.$intFila, $arrCol->marca)
                         ->setCellValue('D'.$intFila, $arrCol->anio)
                         ->setCellValue('E'.$intFila, $arrCol->serie)
                         ->setCellValue('F'.$intFila, $arrCol->costo)
                         ->setCellValue('G'.$intFila, $arrCol->responsable)
                         ->setCellValue('H'.$intFila, $arrCol->modulo)
                         ->setCellValue('I'.$intFila, $arrCol->departamento)
                         ->setCellValue('J'.$intFila, $arrCol->corporativo)
                         ->setCellValue('K'.$intFila, $arrCol->sucursal)
                         ->setCellValue('L'.$intFila, $arrCol->licencia_manejo)
                         ->setCellValue('M'.$intFila, $arrCol->licencia_tipo)
                         ->setCellValue('N'.$intFila, $arrCol->licencia_vigencia)
                         ->setCellValue('O'.$intFila, $arrCol->placas)
                         ->setCellValue('P'.$intFila, $arrCol->estado)
                         ->setCellValue('Q'.$intFila, $arrCol->aseguradora)
                         ->setCellValue('R'.$intFila, $arrCol->poliza)
                         ->setCellValue('S'.$intFila, $arrCol->fecha_renovacion)
                         ->setCellValue('T'.$intFila, $arrCol->costo_poliza)
                         ->setCellValue('U'.$intFila, $arrCol->kilometraje)
                         ->setCellValue('W'.$intFila, $arrCol->verificacion_federal)
                         ->setCellValue('Y'.$intFila, $arrCol->observaciones)
                         ->setCellValue('X'.$intFila, $arrCol->estatus);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}


			//Cambiar contenido de las celdas a formato moneda
			$objExcel->getActiveSheet()
            		 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

            $objExcel->getActiveSheet()
            		 ->getStyle('T'.$intFilaInicial.':'.'T'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');


			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

			$objExcel->getActiveSheet()
                	 ->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('T'.$intFilaInicial.':'.'U'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);
                	 
			$objExcel->getActiveSheet()
                	 ->getStyle('X'.$intFilaInicial.':'.'X'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('X'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('X'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'vehiculos.xls', 'vehículos', $intFila);
	}
}