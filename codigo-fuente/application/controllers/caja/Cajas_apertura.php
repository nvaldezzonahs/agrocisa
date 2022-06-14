<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cajas_apertura extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('caja/cajas_apertura_model', 'apertura');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('caja/cajas_apertura', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->apertura->filtro($this->input->post('dteFechaInicial'),
									   	  $this->input->post('dteFechaFinal'),
									   	  $this->input->post('intUsuarioID'),
									   	  trim($this->input->post('strEstatus')),
										  trim($this->input->post('strBusqueda')),
			                              $config['per_page'],
			                              $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['aperturas'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionCancelar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = '';

            //Si el estatus del registro es CERRADA
            if ($arrDet->estatus == 'CERRADA')
            {
            	//Si el usuario cuenta con el permiso de acceso CANCELAR
				if (in_array('CANCELAR', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Cancelar
					$arrDet->mostrarAccionCancelar = '';
				}
				
            }

            //Si el usuario cuenta con el permiso de acceso VER REGISTRO
			if (in_array('VER REGISTRO', $arrPermisos))
			{
				$arrDet->mostrarAccionVerRegistro = '';
			}
			

			$arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;
			
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['aperturas'],
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
		$objCajaApertura = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		$objCajaApertura->intCuentaBancariaID = $this->input->post('intCuentaBancariaID');
		$objCajaApertura->dteFecha = $this->input->post('dteFecha');
		$objCajaApertura->intImporteApertura = $this->input->post('intImporteApertura');
		$objCajaApertura->intImporteInterno = $this->input->post('intImporteInterno');
		$objCajaApertura->intSaldo = $this->input->post('intSaldo');
		$objCajaApertura->intSucursalID = $this->session->userdata('sucursal_id');
		$objCajaApertura->intUsuarioID = $this->session->userdata('usuario_id');
		//Guardar los datos de un registro nuevo
		$bolResultado = $this->apertura->guardar($objCajaApertura);
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

	//Verifica la existencia de caja abierta para evitar guardar un registro.
    public function get_existencia() 
    {	
    	//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('mensaje' => NULL, 'row' => NULL);
    	//Variables que se utilizan para recuperar los valores de la vista
    	$strFormulario= $this->input->post('strFormulario');
    	//Hacer un llamado al método para comprobar existencia de caja abierta
		$otdResultado = $this->apertura->buscar(NULL, 'ABIERTA');
		//Dependiendo del formulario enviar mensaje
		if($strFormulario == 'apertura_caja')
		{
			//Si existen datos
			if($otdResultado)
			{
			    $arrDatos['mensaje'] = 'Ya existe una caja abierta para esta sucursal.';
			}
		}
		else
		{
			//Si no existen datos
			if(!$otdResultado)
			{
			    $arrDatos['mensaje'] = 'No exite una caja abierta para esta sucursal.';
			}
			else
			{
				//Asignar los datos recuperados en el array
				$arrDatos['row'] = $otdResultado;
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
		$intID = $this->input->post('intCajaAperturaID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->apertura->buscar($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para cancelar los datos de un registro
	public function set_cancelar()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intCajaAperturaID', 'Apertura de caja', 'required|integer');
		$this->form_validation->set_rules('intCajaCorteID', 'Cierre de caja', 'required|integer');
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
	        $intCajaAperturaID = $this->input->post('intCajaAperturaID');
	        $intCajaCorteID = $this->input->post('intCajaCorteID');
	        //Hacer un llamado al método para cancelar los datos del registro
			$bolResultado = $this->apertura->set_cancelar($intCajaAperturaID, $intCajaCorteID);
			//Si no se obtienen errores al ejecutar el proceso
			if($bolResultado)
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos = array('resultado' => TRUE,
							 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
							      'mensaje' => 'El registro se canceló correctamente.');
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
		$intUsuarioID = $this->input->post('intUsuarioID');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));

	
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->apertura->buscar(NULL, NULL, $dteFechaInicial, $dteFechaFinal, 
											    $intUsuarioID, $strEstatus, $strBusqueda);
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
		$pdf->strLinea1 =  'APERTURAS DE CAJA '.$strTituloRangoFechas;
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FECHA', 'HORA', 'USUARIO', 'IMPT. APERTURA', 
								  'IMPT. INTERNO', 'SALDO', 'TOTAL', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(18, 18, 47, 20, 25, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'R', 'R', 'R', 'R', 'C');
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
				//Variables que se utilizan para asignar valores
				$intImporteApertura = $arrCol->importe_apertura;
				$intImporteInterno = $arrCol->importe_interno;
				$intSaldo = $arrCol->saldo;

				//Calcular el importe total
				$intTotal = $intImporteApertura + $intImporteInterno + $intSaldo;

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->fecha, $arrCol->hora,  utf8_decode($arrCol->usuario),  
							    '$'.number_format($intImporteApertura,2),
							    '$'.number_format($intImporteInterno,2),
							    '$'.number_format($intSaldo,2),
							    '$'.number_format($intTotal,2),
							    $arrCol->estatus), $pdf->arrAlineacion, 'ClippedCell');
				 //Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
				//Cuenta bancaria
				$pdf->Cell(11, 4, 'CUENTA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(179, 4, utf8_decode($arrCol->cuenta_bancaria), 0, 0, 'L', 0);
			    $pdf->Ln(5); //Deja un salto de línea

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
		$pdf->Output('apertura_caja.pdf','I'); 
	}

	
	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intUsuarioID = $this->input->post('intUsuarioID');
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
		$otdResultado = $this->apertura->buscar(NULL, NULL, $dteFechaInicial, $dteFechaFinal, $intUsuarioID,  
												$strEstatus, $strBusqueda);
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
			     ->setCellValue('A7', 'APERTURAS DE CAJA '.$strTituloRangoFechas);
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('B'.$intPosEncabezados, 'HORA')
        		 ->setCellValue('C'.$intPosEncabezados, 'USUARIO')
        		 ->setCellValue('D'.$intPosEncabezados, 'CUENTA')
        		 ->setCellValue('E'.$intPosEncabezados, 'IMPORTE APERTURA')
        		 ->setCellValue('F'.$intPosEncabezados, 'IMPORTE INTERNO')
        		 ->setCellValue('G'.$intPosEncabezados, 'SALDO')
        		 ->setCellValue('H'.$intPosEncabezados, 'TOTAL')
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

				//Variables que se utilizan para asignar valores
				$intImporteApertura = $arrCol->importe_apertura;
				$intImporteInterno = $arrCol->importe_interno;
				$intSaldo = $arrCol->saldo;

				//Calcular el importe total
				$intTotal = $intImporteApertura + $intImporteInterno + $intSaldo;

				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFila, $arrCol->fecha)
                         ->setCellValue('B'.$intFila, $arrCol->hora)
                         ->setCellValue('C'.$intFila, $arrCol->usuario)
                         ->setCellValue('D'.$intFila, $arrCol->cuenta_bancaria)
                         ->setCellValue('E'.$intFila, $intImporteApertura)
                         ->setCellValue('F'.$intFila, $intImporteInterno)
                         ->setCellValue('G'.$intFila, $intSaldo)
                         ->setCellValue('H'.$intFila, $intTotal)
                         ->setCellValue('I'.$intFila, $arrCol->estatus);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}
			
			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('E'.$intFilaInicial.':'.'H'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar alineación de las siguientes celdas
           	$objExcel->getActiveSheet()
                	 ->getStyle('A'.$intFilaInicial.':'.'A'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('E'.$intFilaInicial.':'.'H'.$intFila)
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
        $this->get_pie_pagina_archivo_excel($objExcel, 'apertura_caja.xls', 'aperturas', $intFila);
	}
}