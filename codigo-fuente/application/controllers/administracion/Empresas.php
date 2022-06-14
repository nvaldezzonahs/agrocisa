<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('administracion/empresas_model', 'empresas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('administracion/empresas', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar los datos del registro
	public function modificar()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objEmpresa = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objEmpresa->intEmpresaID = $this->session->userdata('empresa_id');
		$objEmpresa->strRazonSocial = mb_strtoupper(trim($this->input->post('strRazonSocial')));
		$objEmpresa->strNombreComercial = mb_strtoupper(trim($this->input->post('strNombreComercial')));
	    $objEmpresa->strRfc = mb_strtoupper(trim($this->input->post('strRfc')));
	    $objEmpresa->intRegimenFiscalID = $this->input->post('intRegimenFiscalID');
	    $objEmpresa->intUsuarioID = $this->session->userdata('usuario_id');
	    
		//Actualizamos los datos del registro
		$bolResultado = $this->empresas->modificar($objEmpresa);
		
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

    //Método para regresar los datos del registro
	public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Seleccionar los datos del registro 
	    $otdResultado = $this->empresas->buscar();
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para generar un reporte PDF con los datos del registro
	public function get_reporte()
	{	            
		
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos del registro
		$otdResultado = $this->empresas->buscar(); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1= utf8_decode('EMPRESA');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establecer el color de fondo para la cabecera
		$pdf->SetFillColor(255, 255, 255);
	    $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
	    //Razón social
	    //Asigna el tipo y tamaño de letra
	    $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(40, 5, utf8_decode('RAZÓN SOCIAL:'), 0, 0, 'L', 1);
		//Asigna el tipo y tamaño de letra
	    $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(150, 5, utf8_decode($otdResultado->razon_social), 0, 1, 'L', 0);
		//Nombre comercial
	    //Asigna el tipo y tamaño de letra
	    $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(40, 5, utf8_decode('NOMBRE COMERCIAL:'), 0, 0, 'L', 1);
		//Asigna el tipo y tamaño de letra
	    $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(150, 5, utf8_decode($otdResultado->nombre_comercial), 0, 1, 'L', 0);
		//RFC
	    //Asigna el tipo y tamaño de letra
	    $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(40, 5, utf8_decode('RFC:'), 0, 0, 'L', 1);
		//Asigna el tipo y tamaño de letra
	    $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(150, 5, utf8_decode($otdResultado->rfc), 0, 1, 'L', 0);
		//Régimen fiscal
	    //Asigna el tipo y tamaño de letra
	    $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(40, 5, utf8_decode('RÉGIMEN FISCAL:'), 0, 0, 'L', 1);
		//Asigna el tipo y tamaño de letra
	    $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(150, 5, utf8_decode($otdResultado->regimen_fiscal), 0, 1, 'L', 0);
		//Ejecutar la salida del reporte
		$pdf->Output('empresa.pdf','I'); 
	}

	//Método para generar un archivo XLS con los datos del registro
	public function get_xls() 
	{	
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        //Seleccionar los datos del registro
		$otdResultado = $this->empresas->buscar(); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'EMPRESA');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$intPosEncabezados, 'RAZÓN SOCIAL')
                 ->setCellValue('B'.$intPosEncabezados, 'NOMBRE COMERCIAL')
                 ->setCellValue('C'.$intPosEncabezados, 'RFC')
                 ->setCellValue('D'.$intPosEncabezados, 'RÉGIMEN FISCAL');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));
        
        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
        		 ->getStyle('A9:D9')
        		 ->getFill()
        		 ->applyFromArray($arrStyleColumnas);
		//Agregar información del registro
		$objExcel->setActiveSheetIndex(0)
           		 ->setCellValue('A'.$intFila, $otdResultado->razon_social)
                 ->setCellValue('B'.$intFila, $otdResultado->nombre_comercial)
                 ->setCellValue('C'.$intFila, $otdResultado->rfc)
                 ->setCellValue('D'.$intFila, $otdResultado->regimen_fiscal);
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'empresa.xls', 'empresa', $intFila);
	}
}