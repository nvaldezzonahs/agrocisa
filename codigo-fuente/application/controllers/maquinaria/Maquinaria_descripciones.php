<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maquinaria_descripciones extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('maquinaria/maquinaria_descripciones_model', 'descripciones');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('maquinaria/maquinaria_descripciones', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->descripciones->filtro(trim($this->input->post('strBusqueda')),
											   NULL,
			                                   $config['per_page'],
			                                   $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['descripciones'] as $arrDet)
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
		$arrDatos = array('rows' => $result['descripciones'],
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
		$objMaquinariaDescripcion = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista
		//Datos de la descripción de maquinaria
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objMaquinariaDescripcion->intMaquinariaDescripcionID = $this->input->post('intMaquinariaDescripcionID');
		$objMaquinariaDescripcion->strCodigo = mb_strtoupper(trim($this->input->post('strCodigo')));
		$objMaquinariaDescripcion->strCodigoAnterior = mb_strtoupper(trim($this->input->post('strCodigoAnterior')));
		$objMaquinariaDescripcion->intProductoServicioID = $this->input->post('intProductoServicioID');
		$objMaquinariaDescripcion->intUnidadID = $this->input->post('intUnidadID');
		//Si no existe id del objeto impuesto asignar valor nulo
		$objMaquinariaDescripcion->intObjetoImpuestoID = (($this->input->post('intObjetoImpuestoID') !== '') ? 
										       			   $this->input->post('intObjetoImpuestoID') : NULL);
		$objMaquinariaDescripcion->strDescripcionCorta = mb_strtoupper(trim($this->input->post('strDescripcionCorta')));
		$objMaquinariaDescripcion->strDescripcion = mb_strtoupper(trim($this->input->post('strDescripcion')));
		$objMaquinariaDescripcion->strServicio  = $this->input->post('strServicio');
		$objMaquinariaDescripcion->intMaquinariaLineaID = $this->input->post('intMaquinariaLineaID');
		$objMaquinariaDescripcion->intMaquinariaMarcaID = $this->input->post('intMaquinariaMarcaID');
		$objMaquinariaDescripcion->intMaquinariaModeloID = $this->input->post('intMaquinariaModeloID');
		$objMaquinariaDescripcion->intMesesGarantia = trim($this->input->post('intMesesGarantia'));
		$objMaquinariaDescripcion->intHorasGarantia = trim($this->input->post('intHorasGarantia'));
		$objMaquinariaDescripcion->intMonedaID  = $this->input->post('intMonedaID');
		$objMaquinariaDescripcion->intTasaCuotaIva = $this->input->post('intTasaCuotaIva');
		$objMaquinariaDescripcion->intTasaCuotaIeps = ($this->input->post('intTasaCuotaIeps') == '' ? 
														NULL: $this->input->post('intTasaCuotaIeps'));
		$objMaquinariaDescripcion->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los componentes
		$objMaquinariaDescripcion->strComponentes = $this->input->post('strComponentes');

        //Definir las reglas de validación
		//Validar que el código sea único
        if (($objMaquinariaDescripcion->intMaquinariaDescripcionID == '') OR 
        	($objMaquinariaDescripcion->strCodigoAnterior != $objMaquinariaDescripcion->strCodigo))
        {
            $this->form_validation->set_rules('strCodigo', 'código', 'required|is_unique[maquinaria_descripciones.codigo]');
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
			if (is_numeric($objMaquinariaDescripcion->intMaquinariaDescripcionID))
			{
				$bolResultado = $this->descripciones->modificar($objMaquinariaDescripcion);
			}
			else
			{ 
				$bolResultado = $this->descripciones->guardar($objMaquinariaDescripcion);
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
			$otdResultado = $this->descripciones->buscar($strBusqueda);
			
		}
		else 
		{
    		$otdResultado = $this->descripciones->buscar(NULL, $strBusqueda);
		}
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{

			$arrDatos['row'] = $otdResultado;
			//Seleccionar los componentes del registro
			$otdDetalles = $this->descripciones->buscar_componentes($otdResultado->maquinaria_descripcion_id);
			//Si existen componentes del registro, se asignan al array
			if($otdDetalles)
			{
				$arrDatos['detalles'] = $otdDetalles;
			}

		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intMaquinariaDescripcionID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intMaquinariaDescripcionID');
		    $strEstatus = $this->input->post('strEstatus');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->descripciones->set_estatus($intID, $strEstatus);
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
			$otdResultado = $this->descripciones->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array(
		        							'value' => $arrCol->concepto, 
		        							'data' => $arrCol->maquinaria_descripcion_id,
		        							'tasa_cuota_id' => $arrCol->tasa_cuota_iva,
		        							'tasa_cuota_ieps' => $arrCol->tasa_cuota_ieps,
		        							'porcentaje_iva' => $arrCol->porcentaje_iva,
		        							'porcentaje_ieps' => $arrCol->porcentaje_ieps, 
		        							'descripcion' => $arrCol->descripcion
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
		$otdResultado = $this->descripciones->buscar(NULL, NULL, $strBusqueda); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'LISTADO DE DESCRIPCIONES DE MAQUINARIA';
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('CÓDIGO'), utf8_decode('DESCRIPCIÓN'), 'SERVICIO',
								 utf8_decode('CÓDIGO SAT'), 'UNIDAD SAT', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(35, 45, 15, 40, 35, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'L', 'L', 'C');
		//Establece la alineación de las celdas de la tabla componentes
	    $arrAlineacionComponentes = array('C', 'L');
	    //Establece el ancho de las columnas de la tabla componentes
		$arrAnchuraComponentes = array(30, 60);
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);

		//Establecer el color de fondo para la línea
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->codigo, utf8_decode($arrCol->descripcion_corta), 
								$arrCol->servicio, utf8_decode($arrCol->producto_servicio), 
								utf8_decode($arrCol->unidad), $arrCol->estatus), 
								$pdf->arrAlineacion, 'ClippedCell');


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

				//Array que se utiliza para agregar los componentes
		        $arrComponentes = array();
		        //Array que se utiliza para agregar los datos
		        $arrAuxiliar = array();
				//Seleccionar los componentes del registro
				$otdComponentes = $this->descripciones->buscar_componentes($arrCol->maquinaria_descripcion_id);
				
				//Verificar si existe información de los detalles 
				if($otdComponentes)
				{
					//Recorremos el arreglo 
					
					foreach ($otdComponentes as $arrDet)
					{
						//Definir valores del array auxiliar de información (para cada componente)
						$arrAuxiliar["codigo"] = $arrDet->codigo;
						$arrAuxiliar["descripcion_corta"] = utf8_decode($arrDet->descripcion_corta);
		                //Asignar datos al array
                        array_push($arrComponentes, $arrAuxiliar); 
					}
					
					//Recorremos el arreglo 
			        foreach ($arrComponentes as $arrDet) 
			        {
					   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array($arrDet['codigo'], $arrDet['descripcion_corta']), 
					    				$arrAlineacionComponentes, 
					    				'ClippedCell');
					    $pdf->Ln(1);//Deja un salto de línea
					}
					
					
				}//Cierre de verificación de detalles
							
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
		$pdf->Output('descripciones_maquinaria.pdf','I'); 
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
		$otdResultado = $this->descripciones->buscar(NULL, NULL, $strBusqueda); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE DESCRIPCIONES DE MAQUINARIA');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'CÓDIGO')
        		 ->setCellValue('B'.$intPosEncabezados, 'DESCRIPCIÓN CORTA')
        		 ->setCellValue('C'.$intPosEncabezados, 'SERVICIO')
        		 ->setCellValue('D'.$intPosEncabezados, 'CÓDIGO SAT')
        		 ->setCellValue('E'.$intPosEncabezados, 'UNIDAD SAT')
        		 ->setCellValue('F'.$intPosEncabezados, 'OBJETO DE IMPUESTO SAT')
        		 ->setCellValue('G'.$intPosEncabezados, 'IVA %')
        		 ->setCellValue('H'.$intPosEncabezados, 'IEPS %')
        		 ->setCellValue('I'.$intPosEncabezados, 'DESCRIPCIÓN')
        		 ->setCellValue('J'.$intPosEncabezados, 'LÍNEA')
        		 ->setCellValue('K'.$intPosEncabezados, 'MARCA')
        		 ->setCellValue('L'.$intPosEncabezados, 'MODELO')
        		 ->setCellValue('M'.$intPosEncabezados, 'MESES DE GARANTÍA')
        		 ->setCellValue('N'.$intPosEncabezados, 'HORAS DE GARANTÍA')
        		 ->setCellValue('O'.$intPosEncabezados, 'MONEDA')
                 ->setCellValue('P'.$intPosEncabezados, 'ESTATUS')
                 ->setCellValue('Q'.$intPosEncabezados, 'CÓDIGO COMPONENTE')
                 ->setCellValue('R'.$intPosEncabezados, 'DESCRIPCIÓN CORTA COMPONENTE');

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
    			 ->getStyle('A9:R9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Array que se utiliza para agregar los componentes
		        $arrComponentes = array();
		        //Array que se utiliza para agregar los datos de un Componente
		        $arrAuxiliar = array();
		        //Variable que se utiliza para asignar el número de detalles 
		        $intNumDetalles = 1;
		         //Variable que se utiliza para asignar el número de componentes
		        $intNumComponentes = 0;

				//Seleccionar los componentes del registro
				$otdComponentes = $this->descripciones->buscar_componentes($arrCol->maquinaria_descripcion_id);
				
				//Verificar si existe información de los Componentes 
				if($otdComponentes)
				{
					//Variable que se utiliza para contar el número de componentes
			    	$intContComp = 0;
			    	//Asignar el número de actividades
			    	$intNumComponentes = count($otdComponentes);
			    	//Si el número de componentes es mayor que el número de detalles
					if($intNumComponentes > $intNumDetalles)
					{	
						//Asignar el número de componentes
						$intNumDetalles = $intNumComponentes;
					}

					//Recorremos el arreglo 
					foreach ($otdComponentes as $arrComp)
					{
						//Asignar datos al array
			        	$arrComponentes[$intContComp]['codigo']= $arrComp->codigo;
			        	$arrComponentes[$intContComp]['descripcion_corta']= $arrComp->codigo;
		               //Incrementar el contador por cada registro
                        $intContComp++;
					}

				}//Cierre de verificación de Componentes

				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    {
			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro 
					$objExcel->setActiveSheetIndex(0)
				 		 ->setCellValueExplicit('A'.$intFila, $arrCol->codigo, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->descripcion_corta)
                         ->setCellValue('C'.$intFila, $arrCol->servicio)
                         ->setCellValueExplicit('D'.$intFila, $arrCol->producto_servicio, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValueExplicit('E'.$intFila, $arrCol->unidad, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValueExplicit('F'.$intFila, $arrCol->objeto_impuesto, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('G'.$intFila, $arrCol->porcentaje_iva)
                         ->setCellValue('H'.$intFila, $arrCol->porcentaje_ieps)
                         ->setCellValue('I'.$intFila, $arrCol->descripcion)
                         ->setCellValue('J'.$intFila, $arrCol->maquinaria_linea)
                         ->setCellValue('K'.$intFila, $arrCol->maquinaria_marca)
                         ->setCellValue('L'.$intFila, $arrCol->maquinaria_modelo)
                         ->setCellValue('M'.$intFila, $arrCol->meses_garantia)
                         ->setCellValue('N'.$intFila, $arrCol->horas_garantia)
                         ->setCellValue('O'.$intFila, $arrCol->moneda)
                         ->setCellValue('P'.$intFila, $arrCol->estatus);

	                //Si existen componentes
		            if($intNumComponentes > 0)
		            {
		            	//Agregar información del registro
						$objExcel->setActiveSheetIndex(0)
								 ->setCellValueExplicit('Q'.$intFila, $arrComponentes[$intContDet]['codigo'], PHPExcel_Cell_DataType::TYPE_STRING)
					        	 ->setCellValue('R'.$intFila, $arrComponentes[$intContDet]['descripcion_corta']);
					    //Decrementar el número de componentes
					    $intNumComponentes --;
		            }

			        //Incrementar el indice para escribir los datos del siguiente registro
	                $intFila++; 
			    }

			
                //Incrementar el contador por cada registro
				$intContador++;

			}

			//Cambiar contenido de las celdas a formato porcentaje
            $objExcel->getActiveSheet()
            		 ->getStyle('G'.$intFilaInicial.':'.'H'.$intFila)
            		 ->getNumberFormat()
            		 ->applyFromArray($arrStylePorcentaje);

            //Cambiar contenido de las celdas a formato númerico
            $objExcel->getActiveSheet()
            		 ->getStyle('N'.$intFilaInicial.':'.'N'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

			//Cambiar alineación de las siguientes celdas
           $objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('G'.$intFilaInicial.':'.'H'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
                	 ->getStyle('M'.$intFilaInicial.':'.'N'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);
                	 		 
			$objExcel->getActiveSheet()
                	 ->getStyle('P'.$intFilaInicial.':'.'P'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('P'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('P'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'descripciones_maquinaria.xls', 'descripciones', $intFila);
	}
}