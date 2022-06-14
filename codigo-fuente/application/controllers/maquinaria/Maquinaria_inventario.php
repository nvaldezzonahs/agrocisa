<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maquinaria_inventario extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('maquinaria/maquinaria_inventario_model', 'inventario');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('maquinaria/maquinaria_inventario', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->inventario->filtro(trim($this->input->post('strBusqueda')),
			                              $config['per_page'],
			                              $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['inventarios'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			
			//Si el usuario cuenta con el permiso de acceso EDITAR
			if (in_array('EDITAR', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón Editar
				$arrDet->mostrarAccionEditar = '';
			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['inventarios'],
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

	//Método para modificar los datos de un registro
	public function guardar()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objMaquinariaInventario = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista 
		//Asignar valor -> NORMAL para indicar que los datos no se envian desde el generador de pólizas
		$objMaquinariaInventario->strTipo = 'NORMAL';
		$objMaquinariaInventario->intMaquinariaDescripcionID = $this->input->post('intMaquinariaDescripcionID');
		$objMaquinariaInventario->strSerie = $this->input->post('strSerie');
		$objMaquinariaInventario->strConsignacion = $this->input->post('strConsignacion');

		//Si no existe id del vendedor asignar valor nulo
		$objMaquinariaInventario->intVendedorID = (($this->input->post('intVendedorID') !== '') ? 
						   	   						$this->input->post('intVendedorID') : NULL);

		//Si no existe id del prospecto asignar valor nulo
		$objMaquinariaInventario->intProspectoID = (($this->input->post('intProspectoID') !== '') ? 
						   	   						 $this->input->post('intProspectoID') : NULL);

		$objMaquinariaInventario->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objMaquinariaInventario->intSucursalID = $this->session->userdata('sucursal_id');
		$objMaquinariaInventario->intUsuarioID = $this->session->userdata('usuario_id');

       //Actualizamos los datos del registro
		$bolResultado = $this->inventario->modificar($objMaquinariaInventario);
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
		$intMaquinariaDescripcionID = $this->input->post('intMaquinariaDescripcionID');
		$strSerie = $this->input->post('strSerie');
		$strConsignacion = $this->input->post('strConsignacion');
		
		//Seleccionar los datos del registro que coincide con los id´s
	    $otdResultado = $this->inventario->buscar($intMaquinariaDescripcionID, $strSerie, $strConsignacion);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para regresar los datos de un registro
	public function get_aditamentos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array();

		//Variables que se utilizan para recuperar los valores de la vista 
		$strSerie = $this->input->post('strSerie');

		//Si existe serie
		if(isset($strSerie))
		{
			$strSerie = strtoupper(trim($strSerie));
			//Hacer un llamado al método para obtener todos los aditamentos de la serie
			$otdResultado = $this->inventario->buscar_aditamentos($strSerie);
			//Si existen datos, asignar los datos recuperados en el array
			if($otdResultado)
			{
				$arrDatos = $otdResultado;
			}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}

		
	}





	//Método para regresar todos los registros activos en un autocomplete
	public function autocomplete()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$strDescripcion = trim($this->input->post('strDescripcion'));
		$intMaquinariaDescripcionID = $this->input->post('intMaquinariaDescripcionID');
		$strTipo = $this->input->post('strTipo');
		$strFormulario = $this->input->post('strFormulario');

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->inventario->autocomplete($strDescripcion, $intMaquinariaDescripcionID, $strTipo, 
															$strFormulario);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{

		        	$arrDatos[] = array('value' => $arrCol->serie_motor, 
		        					    'serie' => $arrCol->serie, 
		        					    'motor' => $arrCol->motor,
										'maquinaria_descripcion_id' => $arrCol->maquinaria_descripcion_id, 
									    'consignacion' => $arrCol->consignacion,
									    'codigo' => $arrCol->codigo,
									    'descripcion' => $arrCol->descripcion,
									    'descripcion_corta' => $arrCol->descripcion_corta,
									    'numero_pedimento' => $arrCol->numero_pedimento
										);				
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
		$otdResultado = $this->inventario->buscar(NULL, NULL, NULL, $strBusqueda); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1= 'LISTADO DE INVENTARIOS DE MAQUINARIA';
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('SERIE', 'MOTOR', utf8_decode('CÓDIGO'), utf8_decode('DESCRIPCIÓN'), 
							 utf8_decode('CONSIGNACIÓN'));
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(40, 40, 20, 68, 22);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L', 'C');
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
				$pdf->Row(array(utf8_decode($arrCol->serie), utf8_decode($arrCol->motor), 
								utf8_decode($arrCol->codigo), utf8_decode($arrCol->descripcion_corta),
							    $arrCol->consignacion), $pdf->arrAlineacion);
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
		$pdf->Output('inventarios_maquinaria.pdf','I'); 
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
		$otdResultado = $this->inventario->buscar(NULL, NULL, NULL, $strBusqueda); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE INVENTARIOS DE MAQUINARIA');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'SERIE')
        		 ->setCellValue('B'.$intPosEncabezados, 'MOTOR')
        		 ->setCellValue('C'.$intPosEncabezados, 'CÓDIGO')
        		 ->setCellValue('D'.$intPosEncabezados, 'DESCRIPCIÓN CORTA')
        		 ->setCellValue('E'.$intPosEncabezados, 'DESCRIPCIÓN')
        		 ->setCellValue('F'.$intPosEncabezados, 'CONSIGNACIÓN')
        		 ->setCellValue('G'.$intPosEncabezados, 'ENTRADA')
        		 ->setCellValue('H'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('I'.$intPosEncabezados, 'SALIDA')
        		 ->setCellValue('J'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('K'.$intPosEncabezados, 'VENDEDOR')
        		 ->setCellValue('L'.$intPosEncabezados, 'PROSPECTO')
                 ->setCellValue('M'.$intPosEncabezados, 'OBSERVACIONES');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:M9')
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
	                     ->setCellValueExplicit('A'.$intFila, $arrCol->serie, PHPExcel_Cell_DataType::TYPE_STRING)
	                     ->setCellValueExplicit('B'.$intFila, $arrCol->motor, PHPExcel_Cell_DataType::TYPE_STRING)
	                     ->setCellValueExplicit('C'.$intFila, $arrCol->codigo, PHPExcel_Cell_DataType::TYPE_STRING)
				         ->setCellValue('D'.$intFila, $arrCol->descripcion_corta)
				         ->setCellValue('E'.$intFila, $arrCol->descripcion)
				         ->setCellValue('F'.$intFila, $arrCol->consignacion)
				         ->setCellValueExplicit('G'.$intFila, $arrCol->folio_entrada, PHPExcel_Cell_DataType::TYPE_STRING)
				         ->setCellValue('H'.$intFila, $arrCol->fecha_entrada)
				         ->setCellValueExplicit('I'.$intFila, $arrCol->folio_salida, PHPExcel_Cell_DataType::TYPE_STRING)
				         ->setCellValue('J'.$intFila, $arrCol->fecha_salida)
				         ->setCellValue('K'.$intFila, $arrCol->vendedor)
				         ->setCellValue('L'.$intFila, $arrCol->prospecto)
				         ->setCellValue('M'.$intFila, $arrCol->observaciones);

                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('M'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('M'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'inventarios_maquinaria.xls', 'inventarios', $intFila);
	}
}