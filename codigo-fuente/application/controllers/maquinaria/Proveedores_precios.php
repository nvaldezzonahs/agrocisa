<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores_precios extends MY_Controller {
	//Información que se utiliza para asignar los indices iniciales del archivo Excel
	var $archivoExcel = NULL;
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar el indice de la columna principal
	    $this->archivoExcel['intIndColInicial'] = 1;
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('maquinaria/proveedores_precios_model', 'proveedores_precios');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('maquinaria/proveedores_precios', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->proveedores_precios->filtro(trim($this->input->post('strBusqueda')),
													 $config['per_page'],
													 $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['proveedores_precios'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			$arrDet->mostrarAccionXLS = 'no-mostrar';
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

			//Si el usuario cuenta con el permiso de acceso IMPRIMIR REGISTRO
			if (in_array('IMPRIMIR REGISTRO', $arrPermisos))
			{
				$arrDet->mostrarAccionImprimir = '';
			}

			//Si el usuario cuenta con el permiso de acceso DESCARGAR XLS REGISTRO
			if (in_array('DESCARGAR XLS REGISTRO', $arrPermisos))
			{
				$arrDet->mostrarAccionXLS = '';
			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['proveedores_precios'],
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
		$objProveedorPrecios = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista
		//Datos del proveedor
		$objProveedorPrecios->intProveedorPrecioID = $this->input->post('intProveedorPrecioID');
		$objProveedorPrecios->intProveedorID = $this->input->post('intProveedorID');
		$objProveedorPrecios->intProveedorIDAnterior = $this->input->post('intProveedorIDAnterior');
		$objProveedorPrecios->intMonedaID = $this->input->post('intMonedaID');
		$objProveedorPrecios->intMonedaIDAnterior = $this->input->post('intMonedaIDAnterior');
		$objProveedorPrecios->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los detalles
		$objProveedorPrecios->strMaquinariaID = $this->input->post('strMaquinariaID');
		$objProveedorPrecios->strPrecios = $this->input->post('strPrecios');

		//Definir las reglas de validación
		//Validar que el proveedor sea único en la moneda
		if (($objProveedorPrecios->intProveedorPrecioID == '') OR 
        	($objProveedorPrecios->intProveedorIDAnterior != $objProveedorPrecios->intProveedorID) OR 
        	($objProveedorPrecios->intMonedaIDAnterior != $objProveedorPrecios->intMonedaID))
        {

        	$this->form_validation->set_rules('intMonedaID', 'moneda', 
        									  'required|callback_get_existencia['.$objProveedorPrecios->intProveedorID.']');

        }
        else
        {
        	$this->form_validation->set_rules('intMonedaID', 'moneda', 'required');
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
			if (is_numeric($objProveedorPrecios->intProveedorPrecioID))
			{
				$bolResultado = $this->proveedores_precios->modificar($objProveedorPrecios);
			}
			else
			{
				$bolResultado = $this->proveedores_precios->guardar($objProveedorPrecios);
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


	//Verifica la existencia de la moneda en el proveedor
	//para evitar duplicación de datos al momento de modificar o guardar un registro.
    public function get_existencia($intMonedaID, $intProveedorID) 
    {	
    	//Concatenar datos para realizar la búsqueda
    	$strCriteriosBusq = $intProveedorID.'|'.$intMonedaID;

		//Hacer un llamado al método para comprobar la existencia de la descripción en el estado
		$otdResultado = $this->proveedores_precios->buscar(NULL, $strCriteriosBusq);
		//Si existen datos
		if($otdResultado)
		{
		    //Enviar mensaje de error
		    $this->form_validation->set_message('get_existencia', 'La  %s ya ha sido registrada en el proveedor, favor de verificar.');
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
		$arrDatos = array('row' => NULL, 'detalles' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$strBusqueda = $this->input->post('strBusqueda');
		$strTipo = $this->input->post('strTipo');
		//Dependiendo del tipo realizar la búsqueda de datos
		//Seleccionar los datos del registro que coincide con el parámetro enviado
		if($strTipo == 'id')
		{
			$otdResultado = $this->proveedores_precios->buscar($strBusqueda);
		}
		else 
		{
    		$otdResultado = $this->proveedores_precios->buscar(NULL, $strBusqueda);
		}
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
			//Seleccionar los detalles del registro
			$otdDetalles = $this->proveedores_precios->buscar_detalles($otdResultado->proveedor_precio_id);
			//Si existen detalles del registro, se asignan al array
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
		$this->form_validation->set_rules('intProveedorPrecioID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intProveedorPrecioID');
		    $strEstatus = $this->input->post('strEstatus');

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->proveedores_precios->set_estatus($intID, $strEstatus);
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

	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte() 
	{	            
		
		//Variables que se utilizan para recuperar los valores de la vista
		$strBusqueda = trim($this->input->post('strBusqueda'));
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->proveedores_precios->buscar(NULL, NULL, $strBusqueda); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'LISTAS DE PRECIOS DE PROVEEDORES';
		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('PROVEEDOR', 'MONEDA', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(140, 30, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('L', 'L', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(30, 55, 25);
		//Agregar la primer pagina
		$pdf->AddPage();
		$pdf->SetTextColor(0); //Establecer el color de texto por defecto
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol->proveedor), $arrCol->moneda, 
								$arrCol->estatus), $pdf->arrAlineacion, 'ClippedCell');

				//Seleccionar los detalles del registro
				$otdDetalles = $this->proveedores_precios->buscar_detalles($arrCol->proveedor_precio_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					$pdf->Ln(1);//Deja un salto de línea
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraDetalles);
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
					   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array(utf8_decode($arrDet->codigo), 
					    				utf8_decode($arrDet->descripcion_corta),
					    				'$'.number_format($arrDet->precio,2)),
					    				$arrAlineacionDetalles, 'ClippedCell');
					}

					$pdf->Ln(3);//Deja un salto de línea
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
		$pdf->Output('proveedores_precios.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro() 
	{

		//Variables que se utilizan para recuperar los valores de la vista
		$intProveedorPrecioID = $this->input->post('intProveedorPrecioID');

		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->proveedores_precios->buscar($intProveedorPrecioID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->proveedores_precios->buscar_detalles($intProveedorPrecioID);
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1=  '';
		//Variable que se utiliza para asignar descripción del proveedor (y poder identificar reporte)
		$strProveedor  = '';
		//Agregar la primer pagina
		$pdf->AddPage();
		//Crea los titulos de la cabecera de detalles
		$arrCabeceraDetalles = array(utf8_decode('CÓDIGO'), utf8_decode('DESCRIPCIÓN CORTA'), 'PRECIO');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('L', 'L', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(45, 120, 25);
		//Verificar si hay información del registro
		if($otdResultado)
		{
			//Asignar la descripción del proveedor
			$strProveedor = $otdResultado->proveedor;
			//Cambiar color de relleno de la celda
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->Ln(10);//Espacios de salto de línea
			//Lista de precios
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, 'LISTA DE PRECIOS', 1, 1, 'C', 1);
			$pdf->SetTextColor(0); //establece el color de texto negro
			//Descripción de la Encuesta
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'PROVEEDOR', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(157, 5, utf8_decode($strProveedor), 0, 1, 'L', 0);
			//Moneda
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'MONEDA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(157, 5, utf8_decode($otdResultado->moneda), 0, 1, 'L', 0);
			//Estatus
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(33, 5, 'ESTATUS', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(157, 5, $otdResultado->estatus, 0, 1, 'L', 0);

			$pdf->Ln(5); //Deja un salto de línea
			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				//Asigna el tipo y tamaño de letra para la cabecera de la tabla
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Recorre el array de titulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabeceraDetalles); $intCont++)
				{
					$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto

					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchuraDetalles[$intCont], 5, $arrCabeceraDetalles[$intCont], 1, 0, 
							   $arrAlineacionDetalles[$intCont], TRUE);
				}
				$pdf->Ln(); //Deja un salto de línea
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraDetalles);
				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDet)
				{
				   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row(array(utf8_decode($arrDet->codigo), utf8_decode($arrDet->descripcion_corta),
				    				'$'.number_format($arrDet->precio,2)),
				    				$arrAlineacionDetalles, 'ClippedCell');
				    //Incrementar el contador por cada registro
					$intContador++;
				}
				//Asigna el tipo y tamaño de letra para los totales
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Escribir totales
		    	$pdf->Cell(165,4,'TOTAL: ', 0, 0, 'R');  
		    	//Total de registros
	            $pdf->Cell(25,4,$intContador, 0, 0, 'R');
			}//Cierre de verificación de detalles
		}//Cierre de verificación de información
		//Ejecutar la salida del reporte
		$pdf->Output('lista_precios_proveedor_'.$strProveedor.'.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$intProveedorPrecioID = $this->input->post('intProveedorPrecioID');

		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
       
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);

       	//Variable que se utiliza para asignar el nombre del archivo
		$strNombreArchivo = '';

        //Si existe id del proveedor
        if($intProveedorPrecioID > 0)
        {
        	//Seleccionar los datos del registro que coincide con el id
			$otdResultado = $this->proveedores_precios->buscar($intProveedorPrecioID);
			//Variable que se utiliza para asignar descripción del proveedor (y poder identificar archivo)
			$strProveedor = $otdResultado->proveedor;
			$strEncabezado = 'LISTA DE PRECIOS DEL PROVEEDOR: '.$strProveedor;
			$strNombreArchivo = 'lista_precios_proveedor_'.$strProveedor.'.xls';
			
        }
        else
        {
        	//Seleccionar los datos de los registros que coinciden con el parámetro enviado
			$otdResultado = $this->proveedores_precios->buscar(NULL, NULL, $strBusqueda); 
			$strEncabezado = 'LISTAS DE PRECIOS DE PROVEEDORES';
			$strNombreArchivo = 'lista_precios_proveedores.xls';
        }

		//Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', $strEncabezado);
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'PROVEEDOR')
        		 ->setCellValue('B'.$intPosEncabezados, 'MONEDA')
                 ->setCellValue('C'.$intPosEncabezados, 'ESTATUS')
                 ->setCellValue('D'.$intPosEncabezados, 'CÓDIGO')
                 ->setCellValue('E'.$intPosEncabezados, 'DESCRIPCIÓN CORTA')
                 ->setCellValue('F'.$intPosEncabezados, 'PRECIO');;
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
        			->getStyle('A9:F9')
        			->getFill()
        			->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Si existe id del proveedor
			if($intProveedorPrecioID > 0)
			{	
				//Hacer un llamado a la función para escribir los datos del registro
				$intFila = $this->escribir_datos_excel($objExcel, $otdResultado, $intFila);
				//Incrementar el contador por cada registro
				$intContador++;
			}
			else
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
					
					//Hacer un llamado a la función para escribir los datos del registro
					$intFila = $this->escribir_datos_excel($objExcel, $arrCol, $intFila);
					
					//Incrementar el indice para escribir los datos del siguiente registro
					$intFila++;

	                //Incrementar el contador por cada registro
					$intContador++;
				}

			}
			

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('F'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('F'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, $strNombreArchivo, 'listas de precios', $intFila);
	}


	//Función que se utiliza para escribir los datos de un regitro en el archivo Excel
	public function escribir_datos_excel($objExcel, $arrCol, $intFila)
	{
		//Array que se utiliza para agregar los datos del proveedor
	    $arrDatosProv = array();
	    $arrDatosProv[] = $arrCol->proveedor;
	    $arrDatosProv[] = $arrCol->moneda;
	    $arrDatosProv[] = $arrCol->estatus;
	    //Hacer un llamado a la función para escribir los datos del proveedor
		$this->get_datos_registro_excel($objExcel, $arrDatosProv, 
										$this->archivoExcel['intIndColInicial'], 
									    $intFila);

		//Seleccionar los detalles del registro
		$otdDetalles = $this->proveedores_precios->buscar_detalles($arrCol->proveedor_precio_id);
		

		//Verificar si existe información de los detalles 
		if($otdDetalles)
		{
			//Asignar el número de columna donde se empezaran a escribir los datos de un detalle 
			$intIndColDetalle = count($arrDatosProv) + 1;

			//Recorremos el arreglo 
	        foreach ($otdDetalles as $arrDet) 
	        {
	        	//Hacer un llamado a la función para escribir los datos del proveedor
				$this->get_datos_registro_excel($objExcel, $arrDatosProv, 
											  $this->archivoExcel['intIndColInicial'], 
											  $intFila);

				//Array que se utiliza para agregar los datos del detalle
				$arrDatos = array();
				$arrDatos[] = $arrDet->codigo;
				$arrDatos[] = $arrDet->descripcion_corta;
				$arrDatos[] = $arrDet->precio;

				//Hacer un llamado a la función para escribir los datos del detalle
			    $this->get_datos_registro_excel($objExcel, $arrDatos, 
											  $intIndColDetalle, 
											  $intFila);

                //Incrementar el indice para escribir los datos del siguiente registro
            	$intFila++;
        	}
		}

		//Regresar indice de la fila
		return  $intFila;
	}

	
}