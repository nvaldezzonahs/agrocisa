<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sat_tasa_cuota extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('contabilidad/sat_tasa_cuota_model', 'tasa');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('contabilidad/sat_tasa_cuota', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->tasa->filtro(trim($this->input->post('strBusqueda')),
			                          $config['per_page'],
			                          $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['tasa_cuota'] as $arrDet)
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
		$arrDatos = array('rows' => $result['tasa_cuota'],
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
		$objSatTasaCuota = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objSatTasaCuota->intTasaCuotaID = $this->input->post('intTasaCuotaID');
		$objSatTasaCuota->intImpuestoID = $this->input->post('intImpuestoID');
		$objSatTasaCuota->intImpuestoIDAnterior = $this->input->post('intImpuestoIDAnterior');
		$objSatTasaCuota->strTipo = $this->input->post('strTipo');
		$objSatTasaCuota->strTipoAnterior = $this->input->post('strTipoAnterior');
		$objSatTasaCuota->strFactor = $this->input->post('strFactor');
		$objSatTasaCuota->intValorMinimo = $this->input->post('intValorMinimo');
		$objSatTasaCuota->intValorMaximo = $this->input->post('intValorMaximo');
		$objSatTasaCuota->intValorMaximoAnterior = $this->input->post('intValorMaximoAnterior');
		$objSatTasaCuota->strRetencion = $this->input->post('strRetencion');
		$objSatTasaCuota->strTraslado = $this->input->post('strTraslado');
		$objSatTasaCuota->intUsuarioID = $this->session->userdata('usuario_id');
		
        //Definir las reglas de validación
		//Validar que el valor máximo del impuesto sea único
        if (($objSatTasaCuota->intTasaCuotaID == '') OR 
        	($objSatTasaCuota->intImpuestoIDAnterior != $objSatTasaCuota->intImpuestoID) OR 
        	($objSatTasaCuota->strTipoAnterior != $objSatTasaCuota->strTipo) OR 
        	($objSatTasaCuota->intValorMaximoAnterior != $objSatTasaCuota->intValorMaximo))
        {
           $this->form_validation->set_rules('intImpuestoID', 'impuesto', 
        									  'required|callback_get_existencia['.$objSatTasaCuota->strTipo.']');
        }
        else
        {
        	$this->form_validation->set_rules('intImpuestoID', 'impuesto', 'required');
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
			if (is_numeric($objSatTasaCuota->intTasaCuotaID))
			{
				$bolResultado = $this->tasa->modificar($objSatTasaCuota);
			}
			else
			{ 
				$bolResultado = $this->tasa->guardar($objSatTasaCuota);
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

	//Verifica la existencia del impuesto con el mismo tipo y valor máximo
	//para evitar duplicación de datos al momento de modificar o guardar un registro.
    public function get_existencia($intImpuestoID, $strTipo) 
    {	
    	//Variables que se utilizan para recuperar los valores de la vista
    	$intValorMaximo = $this->input->post('intValorMaximo');


    	//Concatenar datos para realizar la búsqueda
    	$strCriteriosBusq = $intImpuestoID.'|'.$strTipo.'|'.$intValorMaximo;

		//Hacer un llamado al método para comprobar la existencia del impuesto con el mismo tipo y valor máximo
		$otdResultado = $this->tasa->buscar(NULL, $strCriteriosBusq);
		//Si existen datos
		if($otdResultado)
		{
		    //Enviar mensaje de error
		    $this->form_validation->set_message('get_existencia', 'El  %s ya ha sido registrado con el mismo valor máximo, favor de verificar.');
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
			$otdResultado = $this->tasa->buscar($strBusqueda);
		}
		else if($strTipo == 'impuesto')
		{
			//Se recupera cadena concatenada con los criterios de búsqueda: impuesto_id|tipo|valor_maximo
    		$otdResultado = $this->tasa->buscar(NULL, $strBusqueda);
		}
		else
		{
    		//Se recupera cadena concatenada con los criterios de búsqueda: codigo_impuesto|factor|valor_maximo
    		$otdResultado = $this->tasa->buscar(NULL, NULL, $strBusqueda);
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
		$this->form_validation->set_rules('intTasaCuotaID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intTasaCuotaID');
		    $strEstatus = $this->input->post('strEstatus');

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->tasa->set_estatus($intID, $strEstatus);
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
		$strImpuesto = $this->input->post('strImpuesto');

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			$strImpuesto = mb_strtoupper($strImpuesto);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->tasa->autocomplete($strDescripcion, $strImpuesto);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->valor_maximo, 
		        						'data' => $arrCol->tasa_cuota_id,
		        						'tipo' => $arrCol->tipo,
		        						'factor' => $arrCol->factor,
		        						'valor_minimo' => $arrCol->valor_minimo);
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
		$otdResultado = $this->tasa->buscar(NULL, NULL, NULL, $strBusqueda); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'LISTADO DE TASAS O CUOTAS';
		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array('TIPO', utf8_decode('VALOR MÍNIMO'), utf8_decode('VALOR MÁXIMO'), 
							      'IMPUESTO', 'FACTOR', 'TRASLADO', utf8_decode('RETENCIÓN'), 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(20, 22, 22, 46, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'R', 'R', 'L', 'L', 'C', 'C', 'C');
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
				$pdf->Row(array($arrCol->tipo, $arrCol->valor_minimo, $arrCol->valor_maximo,
					   		    utf8_decode($arrCol->impuesto), strtoupper($arrCol->factor),
					   		    $arrCol->traslado, $arrCol->retencion, $arrCol->estatus), 
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
		$pdf->Output('tasa_cuota.pdf','I'); 
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
		$otdResultado = $this->tasa->buscar(NULL, NULL, NULL, $strBusqueda); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE TASAS O CUOTAS');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$intPosEncabezados, 'TIPO')
                 ->setCellValue('B'.$intPosEncabezados, 'VALOR MÍNIMO')
                 ->setCellValue('C'.$intPosEncabezados, 'VALOR MÁXIMO')
                 ->setCellValue('D'.$intPosEncabezados, 'IMPUESTO')
                 ->setCellValue('E'.$intPosEncabezados, 'FACTOR')
                 ->setCellValue('F'.$intPosEncabezados, 'TRASLADO')
                 ->setCellValue('G'.$intPosEncabezados, 'RETENCIÓN')
                 ->setCellValue('H'.$intPosEncabezados, 'ESTATUS');

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
        		 ->getStyle('A9:H9')
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
						 ->setCellValue('A'.$intFila, $arrCol->tipo)
						 ->setCellValue('B'.$intFila, $arrCol->valor_minimo)
						 ->setCellValue('C'.$intFila, $arrCol->valor_maximo)
                   		 ->setCellValueExplicit('D'.$intFila, $arrCol->impuesto, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('E'.$intFila, strtoupper($arrCol->factor))
                         ->setCellValue('F'.$intFila, $arrCol->traslado)
                         ->setCellValue('G'.$intFila, $arrCol->retencion)
                         ->setCellValue('H'.$intFila, $arrCol->estatus);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar contenido de las celdas a formato númerico de 6 decimales
            $objExcel->getActiveSheet()
            		 ->getStyle('B'.$intFilaInicial.':'.'C'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('###0.000000');

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
                	 ->getStyle('F'.$intFilaInicial.':'.'H'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('H'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('H'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'tasa_cuota.xls', 'tasa o cuota', $intFila);
	}
}