<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones_reclasificacion extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('refacciones/refacciones_reclasificacion_model', 'reclasificacion');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('refacciones/refacciones_reclasificacion', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->reclasificacion->filtro($this->input->post('strTipo'),
					                             $config['per_page'],
					                             $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['reclasificaciones'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';

			//Si el usuario cuenta con el permiso de acceso EDITAR
			if (in_array('EDITAR', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón EDITAR
				$arrDet->mostrarAccionEditar = '';
			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['reclasificaciones'],
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
		$objReclasificacion = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objReclasificacion->intRefaccionesReclasificacionID = $this->input->post('intRefaccionesReclasificacionID');
		$objReclasificacion->strTipo = $this->input->post('strTipo');
		$objReclasificacion->strTipoAnterior = $this->input->post('strTipoAnterior');
		$objReclasificacion->strClasificacion = mb_strtoupper(trim($this->input->post('strClasificacion')));
		$objReclasificacion->strClasificacionAnterior = mb_strtoupper(trim($this->input->post('strClasificacionAnterior')));
		$objReclasificacion->intMinimo = trim($this->input->post('intMinimo'));
		$objReclasificacion->intMaximo = trim($this->input->post('intMaximo'));
		$objReclasificacion->intDiasVenta = trim($this->input->post('intDiasVenta'));
		$objReclasificacion->intUsuarioID = $this->session->userdata('usuario_id');

        //Definir las reglas de validación
		//Validar que la clasificación sea única en el tipo
        if (($objReclasificacion->intRefaccionesReclasificacionID == '') OR 
        	($objReclasificacion->strClasificacionAnterior != $objReclasificacion->strClasificacion) OR 
        	($objReclasificacion->strTipoAnterior != $objReclasificacion->strTipo))
        {

        	$this->form_validation->set_rules('strClasificacion', 'clasificación', 
        									  'required|callback_get_existencia['.$objReclasificacion->strTipo.']');
        }
        else
        {
        	$this->form_validation->set_rules('strClasificacion', 'clasificación', 'required');
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
			if (is_numeric($objReclasificacion->intRefaccionesReclasificacionID))
			{
				$bolResultado = $this->reclasificacion->modificar($objReclasificacion);
			}
			else
			{ 
				$bolResultado = $this->reclasificacion->guardar($objReclasificacion);
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

	//Verifica la existencia de la clasificación en el tipo
	//para evitar duplicación de datos al momento de modificar o guardar un registro.
    public function get_existencia($strClasificacion, $strTipo) 
    {	
    	//Concatenar datos para realizar la búsqueda
    	$strCriteriosBusq = $strTipo.'|'.$strClasificacion;

		//Hacer un llamado al método para comprobar la existencia de la clasificación en el tipo
		$otdResultado = $this->reclasificacion->buscar(NULL, $strCriteriosBusq);
		//Si existen datos
		if($otdResultado)
		{
		    //Enviar mensaje de error
		    $this->form_validation->set_message('get_existencia', 'La  %s ya ha sido registrada en el tipo, favor de verificar.');
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
			$otdResultado = $this->reclasificacion->buscar($strBusqueda);
		}
		else 
		{
			//Se recupera cadena concatenada con los criterios de búsqueda: tipo|clasificacion
    		$otdResultado = $this->reclasificacion->buscar(NULL, $strBusqueda);
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
		$strTipo = $this->input->post('strTipo');
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->reclasificacion->buscar(NULL, NULL, $strTipo); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1=  utf8_decode('LISTADO DE RANGOS DE RECLASIFICACIÓN  DEL TIPO: '.$strTipo);
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('CLASIFICACIÓN'), utf8_decode('MÍNIMO'), utf8_decode('MÁXIMO'),
						     utf8_decode('DÍAS DE VENTA'));
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(47.5, 47.5, 47.5, 47.5);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('C', 'R', 'R', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();		
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		$pdf->SetTextColor(0); //Establecer el color de texto por defecto
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->clasificacion, $arrCol->minimo, $arrCol->maximo,
								$arrCol->dias_venta), $pdf->arrAlineacion);
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
		$pdf->Output('rangos_reclasificacion.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$strTipo = $this->input->post('strTipo');
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->reclasificacion->buscar(NULL, NULL, $strTipo); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE RANGOS DE RECLASIFICACIÓN  DEL TIPO: '.$strTipo);
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'CLASIFICACIÓN')
        		 ->setCellValue('B'.$intPosEncabezados, 'MÍNIMO')
        		 ->setCellValue('C'.$intPosEncabezados, 'MÁXIMO')
                 ->setCellValue('D'.$intPosEncabezados, 'DÍAS DE VENTA');
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
        		 ->getStyle('A9:D9')
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
				 		 ->setCellValue('A'.$intFila, $arrCol->clasificacion)
				 		 ->setCellValue('B'.$intFila, $arrCol->minimo)
				 		 ->setCellValue('C'.$intFila, $arrCol->maximo)
                         ->setCellValue('D'.$intFila, $arrCol->dias_venta);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('A'.$intFilaInicial.':'.'A'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'D'.$intFila)
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
        $this->get_pie_pagina_archivo_excel($objExcel, 'rangos_reclasificacion.xls', 'rangos', $intFila);
	}
}