<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones_lineas extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('refacciones/refacciones_lineas_model', 'lineas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('refacciones/refacciones_lineas', $arrDatos);
	}
	

	
	/*******************************************************************************************************************
	Funciones de la tabla refacciones_lineas
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->lineas->filtro(trim($this->input->post('strBusqueda')),
			                            $config['per_page'],
			                            $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['lineas'] as $arrDet)
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
		$arrDatos = array('rows' => $result['lineas'],
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
		$objLinea = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Datos de la línea de refacciones
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objLinea->intRefaccionesLineaID = $this->input->post('intRefaccionesLineaID');
		$objLinea->strCodigo = mb_strtoupper(trim($this->input->post('strCodigo')));
		$objLinea->strCodigoAnterior = mb_strtoupper(trim($this->input->post('strCodigoAnterior')));
		$objLinea->strDescripcion = mb_strtoupper(trim($this->input->post('strDescripcion')));
		$objLinea->intModuloID = $this->input->post('intModuloID');
		$objLinea->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los detalles
		$objLinea->strRefaccionesListaPrecioID = $this->input->post('strRefaccionesListaPrecioID'); 
		$objLinea->strPorcentajesUtilidad = $this->input->post('strPorcentajesUtilidad');
        //Definir las reglas de validación
		//Validar que el código sea único
        if (($objLinea->intRefaccionesLineaID == '') OR 
        	($objLinea->strCodigoAnterior != $objLinea->strCodigo))
        {
            $this->form_validation->set_rules('strCodigo', 'código',
            								  'required|is_unique[refacciones_lineas.codigo]');
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
			if (is_numeric($objLinea->intRefaccionesLineaID))
			{
				$bolResultado = $this->lineas->modificar($objLinea);
			}
			else
			{ 
				$bolResultado = $this->lineas->guardar($objLinea);
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
			$otdResultado = $this->lineas->buscar($strBusqueda);
		}
		else 
		{
    		$otdResultado = $this->lineas->buscar(NULL, $strBusqueda);
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
		$this->form_validation->set_rules('intRefaccionesLineaID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intRefaccionesLineaID');
		    $strEstatus = $this->input->post('strEstatus');

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->lineas->set_estatus($intID, $strEstatus);
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
			$otdResultado = $this->lineas->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->descripcion, 
		        						'data' => $arrCol->refacciones_linea_id);
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
		$otdResultado = $this->lineas->buscar(NULL, NULL, $strBusqueda); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = utf8_decode('LISTADO DE LÍNEAS DE REFACCIONES');
		//Crea los titulos de la cabecera principal
		$pdf->arrCabecera = array(utf8_decode('CÓDIGO'), utf8_decode('LÍNEA'), utf8_decode('MÓDULO'), 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(15, 125, 30, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('L', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(70, 25);

		//Agregar la primer pagina
		$pdf->AddPage();		
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Seleccionar los detalles del registro
				$otdDetalles = $this->lineas->buscar_detalles($arrCol->refacciones_linea_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{	
					//Establece el ancho de las columnas
					$pdf->SetWidths($pdf->arrAnchura);
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($arrCol->codigo, utf8_decode($arrCol->descripcion),
								utf8_decode($arrCol->modulo), $arrCol->estatus), $pdf->arrAlineacion, 'ClippedCell');

					$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->Ln(3);//Deja un salto de línea
					//Establece el ancho de las columnas
				    $pdf->SetWidths($arrAnchuraDetalles);
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array(utf8_decode($arrDet->descripcion), $arrDet->porcentaje_utilidad.'%'), 
					    				$arrAlineacionDetalles, 'ClippedCell');
					}

					$pdf->Ln(5);//Deja un salto de línea

				}//Cierre de verificación de detalles
				
				//Incrementar el contador por cada registro
				$intContador++;
			}
		}
		//Asigna el tipo y tamaño de letra para los totales
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Escribe la cadena concatenada con el total de registros
		$pdf->Cell(0,3,'TOTAL: '.$intContador, 0, 0, 'R');
		//Ejecutar la salida del reporte
		$pdf->Output('lineas_refacciones.pdf','I'); 
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
        //Variable que se utiliza para asignar el número de columna donde se empezaran a escribir los detalles
	    $intIndColDetalles = 5;
	    $intIndColE = $intIndColDetalles;//Empezar en la columna 5-AC(Encabezados de los detalles)
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->lineas->buscar(NULL, NULL, $strBusqueda); 
		//Seleccionar las listas de precios activas
	    $otdListasPrecio = $this->lineas->buscar_detalles(0);
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE LÍNEAS DE REFACCIONES');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'CÓDIGO')
                 ->setCellValue('B'.$intPosEncabezados, 'LÍNEA')
                 ->setCellValue('C'.$intPosEncabezados, 'MÓDULO')
                 ->setCellValue('D'.$intPosEncabezados, 'ESTATUS');

            //Verificar si existe información de las listas de precios 
	        if ($otdListasPrecio) 
	        { 
	        	//Recorremos el arreglo 
                foreach ($otdListasPrecio as $arrP) 
                { 
                   //Se agregan las columnas de cabecera
                   $objExcel->setActiveSheetIndex(0)
	                        ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados, $arrP->descripcion);
	  
		               //Incrementar indice de la columna
		               $intIndColE++;
                }

                //Drecrementar indice de la columna para evitar rellenar columna sin descripción
                $intIndColE--;

            }//Cierre de verificación de las listas de precios


        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo para cambiar el formato de la celda a porcentaje
        $arrStylePorcentaje = array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:'.$this->ARR_COLUMNAS[$intIndColE].'9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Seleccionar los detalles del registro
				$otdDetalles = $this->lineas->buscar_detalles($arrCol->refacciones_linea_id);
				//Indice de la columna donde empezara a escribir la información de los detalles
		        $intIndColDet = $intIndColDetalles;

				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
						 ->setCellValueExplicit('A'.$intFila, $arrCol->codigo, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->descripcion)
                         ->setCellValue('C'.$intFila, $arrCol->modulo)
                         ->setCellValue('D'.$intFila, $arrCol->estatus);

                    //Verificar si existe información de los detalles 
                    if ($otdDetalles) 
			        { 
			        	//Recorremos el arreglo 
		                foreach ($otdDetalles as $arrDet) 
		                { 
		                	//Convertir cantidad a porcentaje para que aparezca correctamente al cambiar el formato de la celda
							$arrDet->porcentaje_utilidad = $arrDet->porcentaje_utilidad / 100;

		                    //Agregar información del registro
		                    $objExcel->setActiveSheetIndex(0)
			                         ->setCellValue($this->ARR_COLUMNAS[$intIndColDet].$intFila, $arrDet->porcentaje_utilidad);
			  
				            //Incrementar indice de la columna
				            $intIndColDet++;
		                }

		            }//Cierre de verificación de detalles

                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar contenido de las celdas a formato porcentaje
            $objExcel->getActiveSheet()
            		 ->getStyle($this->ARR_COLUMNAS[$intIndColDetalles].$intFilaInicial.':'.
            		 			$this->ARR_COLUMNAS[$intIndColE].$intFila)
            		 ->getNumberFormat()
            		 ->applyFromArray($arrStylePorcentaje);

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('D'.$intFilaInicial.':'.'D'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
            		 ->getStyle($this->ARR_COLUMNAS[$intIndColDetalles].$intFilaInicial.':'.
            		 			$this->ARR_COLUMNAS[$intIndColE].$intFila)
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
        $this->get_pie_pagina_archivo_excel($objExcel, 'lineas_refacciones.xls', 'líneas', $intFila);
	}

	/*******************************************************************************************************************
	Funciones de la tabla refacciones_lineas_detalles
	*********************************************************************************************************************/
	public function get_datos_detalles()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('detalles' => NULL);
	    //Si no existe id de la refacción asignar valor cero
		$intID = (($this->input->post('intRefaccionesLineaID') !== '') ? 
							   $this->input->post('intRefaccionesLineaID') : 0);

		//Seleccionar los detalles del registro que coincide con el id
	    $otdResultado = $this->lineas->buscar_detalles($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['detalles'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}
}