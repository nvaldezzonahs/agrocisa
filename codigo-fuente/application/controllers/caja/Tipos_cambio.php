<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipos_cambio extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de tipos de cambio
		$this->load->model('caja/tipos_cambio_model', 'tipos');
		//Cargamos el modelo de monedas
		$this->load->model('contabilidad/sat_monedas_model', 'monedas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('caja/tipos_cambio', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->tipos->filtro($this->input->post('dteFechaInicial'),
									   $this->input->post('dteFechaFinal'),
									   $this->input->post('intMonedaID'),
			                           $config['per_page'],
			                           $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['tipos'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';

            //Convertir cantidad a formato moneda
            $arrDet->tipo_cambio_venta = '$'.number_format($arrDet->tipo_cambio_venta, 4, '.', '');
            $arrDet->tipo_cambio_sat = '$'.number_format($arrDet->tipo_cambio_sat, 4, '.', '');

            //Si el usuario cuenta con el permiso de acceso EDITAR
			if (in_array('EDITAR', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón Editar
				$arrDet->mostrarAccionEditar = '';
			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['tipos'],
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
		$objTipoCambio = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		$objTipoCambio->intTipoCambioID = $this->input->post('intTipoCambioID');
		$objTipoCambio->dteFecha = $this->input->post('dteFecha');
		$objTipoCambio->dteFechaAnterior = $this->input->post('dteFechaAnterior');
		$objTipoCambio->intMonedaID = $this->input->post('intMonedaID');
		$objTipoCambio->intMonedaIDAnterior = $this->input->post('intMonedaIDAnterior');
		$objTipoCambio->intTipoCambioVenta = $this->input->post('intTipoCambioVenta');
		$objTipoCambio->intTipoCambioSat = $this->input->post('intTipoCambioSat');
		$objTipoCambio->intUsuarioID = $this->session->userdata('usuario_id');
		
        //Definir las reglas de validación
        //Validar que la fecha y la moneda sean únicas
        if (($objTipoCambio->intTipoCambioID == '') OR 
        	($objTipoCambio->dteFechaAnterior != $objTipoCambio->dteFecha) OR
        	($objTipoCambio->intMonedaIDAnterior != $objTipoCambio->intMonedaID))
        {

            $this->form_validation->set_rules('dteFecha', 'fecha', 
        									  'required|callback_get_existencia['.$objTipoCambio->intMonedaID.']');
        }
        else
        {
        	$this->form_validation->set_rules('dteFecha', 'fecha', 'required');
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
			if (is_numeric($objTipoCambio->intTipoCambioID))
			{
				$bolResultado = $this->tipos->modificar($objTipoCambio);
			}
			else
			{ 
				$bolResultado = $this->tipos->guardar($objTipoCambio);
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

	//Verifica la existencia de la fecha y la moneda
	//para evitar duplicación de datos al momento de modificar o guardar un registro.
    public function get_existencia($dteFecha, $intMonedaID) 
    {	
    	//Concatenar datos para realizar la búsqueda
    	$strCriteriosBusq = $dteFecha.'|'.$intMonedaID;

		//Hacer un llamado al método para comprobar la existencia de la fecha y la moneda
		$otdResultado = $this->tipos->buscar(NULL, $strCriteriosBusq);
		//Si existen datos
		if($otdResultado)
		{
		    //Enviar mensaje de error
		    $this->form_validation->set_message('get_existencia', 'La  %s  y la moneda ya han sido registradas, favor de verificar.');
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
			$otdResultado = $this->tipos->buscar($strBusqueda);
		}
		else 
		{
    		$otdResultado = $this->tipos->buscar(NULL, $strBusqueda);
		}
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
	public function get_reporte() 
	{	             
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intMonedaID = $this->input->post('intMonedaID');
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->tipos->buscar(NULL, NULL, $dteFechaInicial, $dteFechaFinal, $intMonedaID);
		
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal != '')
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
		$pdf->strLinea1 = 'LISTADO DE TIPOS DE CAMBIO '.$strTituloRangoFechas;
		//Si existe id de la moneda
		if($intMonedaID > 0)
		{
			//Seleccionar los datos de la moneda que coincide con el id
			$otdMoneda =  $this->monedas->buscar($intMonedaID);
			//Concatenar los datos de la moneda
			$strMoneda = strtoupper($otdMoneda->codigo.' - '.$otdMoneda->descripcion);
			$pdf->strLinea2 =  'MONEDA: '.utf8_decode($strMoneda);
		}

		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array('FECHA', 'MONEDA', 'TIPO DE CAMBIO VENTA', 'TIPO DE CAMBIO SAT');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(18, 112, 30, 30);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'R', 'R');
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
				$pdf->Row(array($arrCol->fecha, utf8_decode($arrCol->moneda), 
								'$'.$arrCol->tipo_cambio_venta, 
								'$'.$arrCol->tipo_cambio_sat), 
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
		$pdf->Output('tipos_cambio.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intMonedaID = $this->input->post('intMonedaID');
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
		$otdResultado = $this->tipos->buscar(NULL, NULL, $dteFechaInicial, $dteFechaFinal, $intMonedaID);
		
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal != '')
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
			     ->setCellValue('A7', 'LISTADO DE TIPOS DE CAMBIO '.$strTituloRangoFechas);
	    //Si existe id de la moneda
		if($intMonedaID > 0)
		{
			//Seleccionar los datos de la moneda que coincide con el id
			$otdMoneda =  $this->monedas->buscar($intMonedaID);
			//Concatenar los datos de la moneda
			$strMoneda = strtoupper($otdMoneda->codigo.' - '.$otdMoneda->descripcion);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'MONEDA: '.$strMoneda);
		}
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
         		 ->setCellValue('A'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('B'.$intPosEncabezados, 'MONEDA')
                 ->setCellValue('C'.$intPosEncabezados, 'TIPO DE CAMBIO VENTA')
                 ->setCellValue('D'.$intPosEncabezados, 'TIPO DE CAMBIO SAT');
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

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
						 ->setCellValue('A'.$intFila, $arrCol->fecha)
                         ->setCellValueExplicit('B'.$intFila, $arrCol->moneda, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('C'.$intFila, $arrCol->tipo_cambio_venta)
                         ->setCellValue('D'.$intFila, $arrCol->tipo_cambio_sat);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar contenido de las celdas a formato númerico de 4 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('C'.$intFilaInicial.':'.'D'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$###0.0000');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('A'.$intFilaInicial.':'.'A'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

			$objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'D'.$intFila)
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
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'tipos_cambio.xls', 'tipos de cambio', $intFila);
	}
}