<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Claves_autorizacion extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de generar claves
		$this->load->model('cuentas_cobrar/claves_autorizacion_model', 'claves');
		//Cargamos el modelo de clientes
		$this->load->model('cuentas_cobrar/clientes_model', 'clientes');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('cuentas_cobrar/claves_autorizacion', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}
	
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->claves->filtro(
											$this->input->post('dteFechaInicial'),
										  	$this->input->post('dteFechaFinal'),
										  	$this->input->post('intProspectoID'),
										  	trim($this->input->post('strBusqueda')),
			                              	$config['per_page'],
			                              	$config['cur_page']
			                            );
		$config['total_rows'] = $result['total_rows'];

		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['claves'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows']);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para guardar o modificar los datos de un registro
	public function guardar()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objGenerarClave = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objGenerarClave->intClaveAutorizacionID = $this->input->post('intClaveAutorizacionID');
		$objGenerarClave->intProspectoID = $this->input->post('intProspectoID');
		$objGenerarClave->strClaveGenerada = $this->input->post('strClaveGenerada');
		$objGenerarClave->intUsuarioID = $this->session->userdata('usuario_id');

		//Guardar los datos de un nuevo registro 
		$bolResultado = $this->claves->guardar($objGenerarClave); 

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

	
	//Verifica la existencia de clave para evitar guardar/modificar una factura.
	public function get_existencia()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('mensaje' => NULL, 
						  'clave_autorizacion_id' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$strClave = $this->input->post('strClave');
		$intProspectoID = $this->input->post('intProspectoID');

		//Variable que se utiliza para asignar el mensaje de error
	    $strMensajeError = '';

		//Hacer un llamado al método para comprobar existencia de clave
	    $otdResultado = $this->claves->buscar(NULL, NULL, NULL, $intProspectoID, NULL, $strClave);

		//Si existen datos, verificar clave de autorización
		if($otdResultado)
		{
			//Si existe id de la referencia, significa que la clave ha sido utilizada anteriormente
			if($otdResultado->referencia_id > 0)
			{
				$strMensajeError = 'La clave: <b>'.$strClave.'</b> ya ha sido utilizada';
			}
			else
			{	
				//Asignar el id de la clave de autorización
				$arrDatos['clave_autorizacion_id'] = $otdResultado->clave_autorizacion_id;
			}
		}
		else
		{
			$strMensajeError = 'La clave: <b>'.$strClave.'</b> no existe para este cliente';
		}

		//Si existe mensaje de error
		if($strMensajeError != '')
		{
			$strMensajeError .= ', favor de solicitar una clave de autorización.';

			//Asignar mensaje de error
			$arrDatos['mensaje'] = $strMensajeError;
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
		$strBusqueda = trim($this->input->post('strBusqueda'));

		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->claves->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, $strBusqueda);	
		
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
		$pdf->strLinea1 =  'LISTADO DE CLAVES GENERADAS '.$strTituloRangoFechas;
		//Si existe id del cliente
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del cliente que coincide con el id
			$otdProspecto =  $this->clientes->buscar($intProspectoID);
			$pdf->strLinea2 =  utf8_decode('RAZÓN SOCIAL: '.$otdProspecto->razon_social);
		}

		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('CLAVE', 'FECHA',  utf8_decode('GENERÓ'), utf8_decode('RAZÓN SOCIAL'), 'REFERENCIA');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(15, 20, 60, 55, 40);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'L', 'L', 'L');
		//Agregar la primer pagina
		$pdf->AddPage();

		//Si hay información
		if ($otdResultado)
		{	
			//Establece el ancho de las columnas
			$pdf->SetWidths($pdf->arrAnchura);
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->clave, $arrCol->fecha, 
								utf8_decode($arrCol->empleado_genero),
								utf8_decode($arrCol->razon_social), 
								$arrCol->folio_referencia), 
						      $pdf->arrAlineacion, 'ClippedCell');

				//Si existe id de la referencia (factura)
				if($arrCol->referencia_id > 0)
				{
					//Asigna el tipo y tamaño de letra
		        	$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
		        	//empleado que aplicó la clave de autorización
					$pdf->Cell(10, 4, utf8_decode('APLICÓ:'), 0, 0, 'L', 0);
				    $pdf->ClippedCell(55, 4, utf8_decode($arrCol->empleado_aplico), 0, 0, 'L', 0);
				    //Fecha en que se aplicó la clave de autorización
					$pdf->Cell(27, 4, utf8_decode('FECHA DE APLICACIÓN:'), 0, 0, 'L', 0);
				    $pdf->ClippedCell(20, 4, utf8_decode($arrCol->fecha_aplico), 0, 0, 'L', 0);
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
		$pdf->Output('claves_autorizadas_generadas.pdf','I'); 
	}

	
	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProspectoID = $this->input->post('intProspectoID');
		$strBusqueda = trim($this->input->post('strBusqueda'));

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
		$otdResultado = $this->claves->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID, $strBusqueda);
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
			     ->setCellValue('A7', 'LISTADO DE CLAVES GENERADAS '.$strTituloRangoFechas);
		//Si existe id del cliente
		if($intProspectoID > 0)
		{   
			//Seleccionar los datos del cliente que coincide con el id
			$otdProspecto =  $this->clientes->buscar($intProspectoID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'RAZÓN SOCIAL: '.$otdProspecto->razon_social);
		}
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'CLAVE')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA DE CREACIÓN')
        		 ->setCellValue('C'.$intPosEncabezados, 'GENERÓ')
        		 ->setCellValue('D'.$intPosEncabezados, 'RAZÓN SOCIAL')
        		 ->setCellValue('E'.$intPosEncabezados, 'REFERENCIA')
        		 ->setCellValue('F'.$intPosEncabezados, 'APLICÓ')
        		 ->setCellValue('G'.$intPosEncabezados, 'FECHA DE APLICACIÓN');

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
    			 ->getStyle('A10:G10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:G10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:U10')
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
				 		 ->setCellValueExplicit('A'.$intFila, $arrCol->clave, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->fecha)
                         ->setCellValue('C'.$intFila, $arrCol->empleado_genero)
                         ->setCellValue('D'.$intFila, $arrCol->razon_social)
                         ->setCellValue('E'.$intFila, $arrCol->folio_referencia)
                         ->setCellValue('F'.$intFila, $arrCol->empleado_aplico)
                         ->setCellValue('G'.$intFila, $arrCol->fecha_aplico);

	                //Incrementar el indice para escribir los datos del siguiente registro
                    $intFila++;
			    

                //Incrementar el contador por cada registro
				$intContador++;
			
			}


			//Cambiar alineación de las siguientes celdas
    		$objExcel->getActiveSheet()
		        	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);

		    $objExcel->getActiveSheet()
		        	 ->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('G'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('G'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'claves_autorizacion.xls', 'claves generadas', $intFila);
	}

}	