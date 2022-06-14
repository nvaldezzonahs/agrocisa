<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion_polizas extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('servicio/configuracion_polizas_model', 'configuraciones');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('servicio/configuracion_polizas', $arrDatos);
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
		//Variables que se utilizan para recuperar los valores de la vista 
		$strTabla = $this->input->post('strTabla');
		//Asignar el metódo de paginación (filtro)
	    $strMetodo = 'filtro_'.$strTabla;

		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->configuraciones->$strMetodo($config['per_page'],
					                             	 $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['configuraciones'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionEliminar = 'no-mostrar';

			//Si el usuario cuenta con el permiso de acceso EDITAR
			if (in_array('EDITAR', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón Editar
				$arrDet->mostrarAccionEditar = '';
			}

			//Si el usuario cuenta con el permiso de acceso ELIMINAR
			if (in_array('ELIMINAR', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón Eliminar
				$arrDet->mostrarAccionEliminar = '';
			}
			
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['configuraciones'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows']);
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
		$strTabla = $this->input->post('strTabla');
		$strTipoReferencia = $this->input->post('strTipoReferencia');

		//Asignar el metódo de búsqueda
	    $strMetodo = 'buscar_'.$strTabla;

		//Dependiendo del tipo realizar la búsqueda de datos
		//Seleccionar los datos del registro que coincide con el parámetro enviado
		if($strTipo == 'id')
		{
			$otdResultado = $this->configuraciones->$strMetodo($strBusqueda);
		}
		else 
		{
			//Si existe tipo de referencia
			if($strTipoReferencia  != '')
			{
				$otdResultado = $this->configuraciones->$strMetodo(NULL, $strBusqueda, $strTipoReferencia);
			}
			else
			{
				$otdResultado = $this->configuraciones->$strMetodo(NULL, $strBusqueda);
			}
    		
		}
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para eliminar los datos de un registro
	public function eliminar()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intConfiguracionID', 'ID', 'required|integer');
		$this->form_validation->set_rules('strTabla', 'tabla', 'required');
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
	        $intID = $this->input->post('intConfiguracionID');
	        $strTabla = $this->input->post('strTabla');
	        //Asignar el metódo de eliminación
	        $strMetodo = 'eliminar_'.$strTabla;

	        //Hacer un llamado al método para eliminar los datos del registro
			$bolResultado = $this->configuraciones->$strMetodo($intID);
	        
			//Si no se obtienen errores al ejecutar el proceso
			if($bolResultado)
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos = array('resultado' => TRUE,
							 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
							      'mensaje' => MSJ_ELIMINAR);
			}
			else
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_ERROR_ELIMINAR);
			}
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	//Método para regresar todos los registros en un combobox
	public function get_combo_box()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$strTipo = $this->input->post('strTipo');
		$strTipoReferencia = $this->input->post('strTipoReferencia');

		//Obtener el listado de registros activos
		$arrDatos['referencias'] = $this->configuraciones->get_combo_box($strTipo, $strTipoReferencia);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	//Verifica la existencia de la referencia
	//para evitar duplicación de datos al momento de modificar o guardar un registro.
    public function get_existencia_referencia($intReferenciaID, $strTipoReferencia) 
    {	

    	//Variables que se utilizan para recuperar los valores de la vista 
		$strTabla = $this->input->post('strTabla');

		//Asignar el metódo de búsqueda
	    $strMetodo = 'buscar_'.$strTabla;

    	//Concatenar datos para realizar la búsqueda
    	$strCriteriosBusq = $intReferenciaID.'|'.$strTipoReferencia;

		//Hacer un llamado al método para comprobar la existencia de la referencia
		$otdResultado = $this->configuraciones->$strMetodo(NULL, $strCriteriosBusq);
		//Si existen datos
		if($otdResultado)
		{
		    //Enviar mensaje de error
		    $this->form_validation->set_message('get_existencia_referencia', 'La  %s ya ha sido registrada, favor de verificar.');
		    //Regresar FALSE para no permitir registrar o actualizar datos
		    return FALSE;
		}
		else
		{
			//Regresar TRUE para permitir registrar o actualizar datos
			return TRUE;
		}
    }


	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte() 
	{	            

		//Seleccionar los datos de las IEPS
		$otdConfIeps = $this->configuraciones->buscar_configuracion_ieps();
		//Seleccionar los datos de las MONEDAS
		$otdConfMonedas = $this->configuraciones->buscar_configuracion_monedas();
		//Seleccionar los datos de las DEPARTAMENTOS
		$otdConfDepto = $this->configuraciones->buscar_configuracion_departamentos();
		//Seleccionar los datos de los procesos
		$otdConfProcesos = $this->configuraciones->buscar_configuracion_procesos();
		//Seleccionar los datos de las MÓDULOS
		$otdConfModulos = $this->configuraciones->buscar_configuracion_modulos();
		//Seleccionar los datos de las CUENTAS BANCARIAS
		$otdConfCtasBancarias = $this->configuraciones->buscar_configuracion_cuentas_bancarias();

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = utf8_decode('CONFIGURACIONES PARA PÓLIZAS');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Cambiar color de relleno de la celda
		$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);	

		//------------------------------------------------------------------------------------------------------------------------
        //---------- IEPS
        //------------------------------------------------------------------------------------------------------------------------
		//Verificar si existe información de las IEPS
		if($otdConfIeps)
		{
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, 'IEPS', 1, 1, 'C', 1);
			//Crea los titulos de la cabecera
			$arrCabecera = array('IEPS', 'CUENTA');
			//Establece el ancho de las columnas de cabecera
			$arrAnchura = array(95, 95);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacion = array('L', 'L');
			//Recorre el array de titulos de encabezado para crearlos
			for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
			{
				//inserta los titulos de la cabecera
				$pdf->Cell($arrAnchura[$intCont], 5, $arrCabecera[$intCont], 1, 0, 
						   $arrAlineacion[$intCont], TRUE);
			}

			$pdf->Ln(5); //Deja un salto de línea
			//Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchura);

			//Recorremos el arreglo 
			foreach ($otdConfIeps as $arrIeps)
			{
				//Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrIeps->porcentaje_ieps, $arrIeps->cuenta), 
								$arrAlineacion, 'ClippedCell');
			}

			$pdf->Ln(10); //Deja un salto de línea

		}//Cierre de verificación de cuentas IEPS
		
		

		//------------------------------------------------------------------------------------------------------------------------
        //---------- MONEDAS
        //------------------------------------------------------------------------------------------------------------------------
		//Verificar si existe información de las MONEDAS
		if($otdConfMonedas)
		{
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, 'MONEDAS', 1, 1, 'C', 1);
			//Crea los titulos de la cabecera
			$arrCabecera = array('MONEDA', 'CUENTA');
			//Establece el ancho de las columnas de cabecera
			$arrAnchura = array(95, 95);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacion = array('L', 'L');
			//Recorre el array de titulos de encabezado para crearlos
			for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
			{
				//inserta los titulos de la cabecera
				$pdf->Cell($arrAnchura[$intCont], 5, $arrCabecera[$intCont], 1, 0, 
						   $arrAlineacion[$intCont], TRUE);
			}

			$pdf->Ln(5); //Deja un salto de línea
			//Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchura);

			//Recorremos el arreglo 
			foreach ($otdConfMonedas as $arrMon)
			{
				//Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrMon->moneda), $arrMon->cuenta), 
								$arrAlineacion, 'ClippedCell');
			}

			$pdf->Ln(10); //Deja un salto de línea

		}//Cierre de verificación de MONEDAS


		//------------------------------------------------------------------------------------------------------------------------
        //---------- DEPARTAMENTOS
        //------------------------------------------------------------------------------------------------------------------------
		//Verificar si existe información de las DEPARTAMENTOS
		if($otdConfDepto)
		{
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, 'DEPARTAMENTOS', 1, 1, 'C', 1);
			//Crea los titulos de la cabecera
			$arrCabecera = array(utf8_decode('MÓDULO'), 'REFERENCIA', 'CUENTA');
			//Establece el ancho de las columnas de cabecera
			$arrAnchura = array(50, 60, 80);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacion = array('L', 'L', 'L');
			//Recorre el array de titulos de encabezado para crearlos
			for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
			{
				//inserta los titulos de la cabecera
				$pdf->Cell($arrAnchura[$intCont], 5, $arrCabecera[$intCont], 1, 0, 
						   $arrAlineacion[$intCont], TRUE);
			}

			$pdf->Ln(5); //Deja un salto de línea
			//Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchura);

			//Recorremos el arreglo 
			foreach ($otdConfDepto as $arrDepto)
			{
				//Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrDepto->tipo_referencia,
								utf8_decode($arrDepto->referencia), 
								utf8_decode($arrDepto->cuenta)), 
								$arrAlineacion, 'ClippedCell');
			}

			$pdf->Ln(10); //Deja un salto de línea
		}//Cierre de verificación de DEPARTAMENTOS

		
		//------------------------------------------------------------------------------------------------------------------------
        //---------- PROCESOS
        //------------------------------------------------------------------------------------------------------------------------
		//Verificar si existe información de los procesos
		if($otdConfProcesos)
		{
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, 'PROCESOS', 1, 1, 'C', 1);
			//Crea los titulos de la cabecera
			$arrCabecera = array(utf8_decode('MÓDULO'), 'REFERENCIA', 'PROCESO');
			//Establece el ancho de las columnas de cabecera
			$arrAnchura = array(50, 60, 80);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacion = array('L', 'L', 'L');
			//Recorre el array de titulos de encabezado para crearlos
			for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
			{
				//inserta los titulos de la cabecera
				$pdf->Cell($arrAnchura[$intCont], 5, $arrCabecera[$intCont], 1, 0, 
						   $arrAlineacion[$intCont], TRUE);
			}

			$pdf->Ln(5); //Deja un salto de línea
			//Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchura);

			//Recorremos el arreglo 
			foreach ($otdConfProcesos as $arrProc)
			{
				//Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array( $arrProc->tipo_referencia, 
								utf8_decode($arrProc->referencia),
								utf8_decode($arrProc->proceso)), 
								$arrAlineacion, 'ClippedCell');
			}

			$pdf->Ln(10); //Deja un salto de línea

		}//Cierre de verificación de cuentas de procesos


		//------------------------------------------------------------------------------------------------------------------------
        //---------- MÓDULOS
        //------------------------------------------------------------------------------------------------------------------------
		//Verificar si existe información de las MÓDULOS
		if($otdConfModulos)
		{
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, utf8_decode('MÓDULOS'), 1, 1, 'C', 1);
			//Crea los titulos de la cabecera
			$arrCabecera = array(utf8_decode('MÓDULO'), 'REFERENCIA', 'CUENTA');
			//Establece el ancho de las columnas de cabecera
			$arrAnchura = array(60, 50, 80);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacion = array('L', 'L','L');
			//Recorre el array de titulos de encabezado para crearlos
			for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
			{
				//inserta los titulos de la cabecera
				$pdf->Cell($arrAnchura[$intCont], 5, $arrCabecera[$intCont], 1, 0, 
						   $arrAlineacion[$intCont], TRUE);
			}

			$pdf->Ln(5); //Deja un salto de línea
			//Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchura);

			//Recorremos el arreglo 
			foreach ($otdConfModulos as $arrMod)
			{
				//Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrMod->modulo), 
								utf8_decode($arrMod->referencia), 
									$arrMod->cuenta), 
								$arrAlineacion, 'ClippedCell');
			}

			$pdf->Ln(10); //Deja un salto de línea

		}//Cierre de verificación de MÓDULOS


		//------------------------------------------------------------------------------------------------------------------------
        //---------- CUENTAS BANCARIAS
        //------------------------------------------------------------------------------------------------------------------------
		//Verificar si existe información de las CUENTAS BANCARIAS
		if($otdConfCtasBancarias)
		{
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, utf8_decode('CUENTAS BANCARIAS'), 1, 1, 'C', 1);
			//Crea los titulos de la cabecera
			$arrCabecera = array('CUENTA BANCARIA', 'REFERENCIA', 'CUENTA');
			//Establece el ancho de las columnas de cabecera
			$arrAnchura = array(60, 50, 80);
			//Establece la alineación de las celdas de la tabla
			$arrAlineacion = array('L', 'L','L');
			//Recorre el array de titulos de encabezado para crearlos
			for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
			{
				//inserta los titulos de la cabecera
				$pdf->Cell($arrAnchura[$intCont], 5, $arrCabecera[$intCont], 1, 0, 
						   $arrAlineacion[$intCont], TRUE);
			}

			$pdf->Ln(5); //Deja un salto de línea
			//Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchura);

			//Recorremos el arreglo 
			foreach ($otdConfCtasBancarias as $arrCta)
			{
				//Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCta->cuenta_bancaria), 
								utf8_decode($arrCta->tipo_referencia), 
									$arrCta->cuenta), 
								$arrAlineacion, 'ClippedCell');
			}

			$pdf->Ln(10); //Deja un salto de línea

		}//Cierre de verificación de MÓDULOS
		
		//Ejecutar la salida del reporte
		$pdf->Output('configuraciones_polizas.pdf','I'); 
	}


	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;

        //Seleccionar los datos de las IEPS
		$otdConfIeps = $this->configuraciones->buscar_configuracion_ieps();
		//Seleccionar los datos de las MONEDAS
		$otdConfMonedas = $this->configuraciones->buscar_configuracion_monedas();
		//Seleccionar los datos de las DEPARTAMENTOS
		$otdConfDepto = $this->configuraciones->buscar_configuracion_departamentos();
		//Seleccionar los datos de los procesos
		$otdConfProcesos = $this->configuraciones->buscar_configuracion_procesos();
		//Seleccionar los datos de las MÓDULOS
		$otdConfModulos = $this->configuraciones->buscar_configuracion_modulos();
		//Seleccionar los datos de las CUENTAS BANCARIAS
		$otdConfCtasBancarias = $this->configuraciones->buscar_configuracion_cuentas_bancarias();

     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'CONFIGURACIONES PARA PÓLIZAS');
	
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

         $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE,
    													'color' => array('rgb' => 'ffffff')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));


        //------------------------------------------------------------------------------------------------------------------------
        //---------- IEPS
        //------------------------------------------------------------------------------------------------------------------------
		//Verificar si existe información de las IEPS
		if($otdConfIeps)
		{
			//Se agregan las columnas de cabecera
	        $objExcel->setActiveSheetIndex(0)
	        		 ->setCellValue('A'.$intPosEncabezados, 'IEPS');
	        
	        //Incrementar indice para escribir la segunda cabecera
	        $intPosEncabezados++;         
	        
	        //Se agregan las columnas de cabecera
	        $objExcel->setActiveSheetIndex(0)
	        		 ->setCellValue('A'.$intPosEncabezados, 'IEPS')
	                 ->setCellValue('B'.$intPosEncabezados, 'CUENTA');
	        
	        //Combinar las siguientes celdas
       		$objExcel->setActiveSheetIndex(0)
       			 	 ->mergeCells('A9:B9');

	        //Preferencias de color de relleno de celda 
       		$objExcel->getActiveSheet()
	        		 ->getStyle('A9:B10')
	        		 ->getFill()
	        		 ->applyFromArray($arrStyleColumnas);
	        

	       //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('A10:B10')
	    			 ->applyFromArray($arrStyleFuenteColumnas);


	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('A10:B10')
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentCenter);

            //Recorremos el arreglo 
			foreach ($otdConfIeps as $arrIeps)
			{   
				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
						 ->setCellValueExplicit('A'.$intFila, $arrIeps->porcentaje_ieps, 
											    PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrIeps->cuenta);

                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}


			//Incrementar el indice para escribir las MONEDAS
			$intFila+=2;

	    }//Cierre de verificación de cuentas IEPS



	    //------------------------------------------------------------------------------------------------------------------------
        //---------- MONEDAS
        //------------------------------------------------------------------------------------------------------------------------------------------
		//Verificar si existe información de las MONEDAS
		if($otdConfMonedas)
		{
			//Asignar indice de fila donde se empezaran a escribir las MONEDAS
			$intPosEncabezados = $intFila;

			//Se agregan las columnas de cabecera
	        $objExcel->setActiveSheetIndex(0)
	        		 ->setCellValue('A'.$intPosEncabezados, 'MONEDAS');
	        
	        //Incrementar indice para escribir la segunda cabecera
	        $intFila++;         
	        
	        //Se agregan las columnas de cabecera
	        $objExcel->setActiveSheetIndex(0)
	        		 ->setCellValue('A'.$intFila, 'MONEDA')
	                 ->setCellValue('B'.$intFila, 'CUENTA');
	        
	        //Combinar las siguientes celdas
       		$objExcel->setActiveSheetIndex(0)
       			 	 ->mergeCells('A'.$intPosEncabezados.':B'.$intPosEncabezados);

	        //Preferencias de color de relleno de celda 
       		$objExcel->getActiveSheet()
	        		 ->getStyle('A'.$intPosEncabezados.':B'.$intFila)
	        		 ->getFill()
	        		 ->applyFromArray($arrStyleColumnas);
	        

	       //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('A'.$intPosEncabezados.':B'.$intFila)
	    			 ->applyFromArray($arrStyleFuenteColumnas);


	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('A'.$intPosEncabezados.':B'.$intFila)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentCenter);

	         //Incrementar el indice para escribir los datos
             $intFila++; 

            //Recorremos el arreglo 
			foreach ($otdConfMonedas as $arrMon)
			{   

				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
						  ->setCellValue('A'.$intFila, $arrMon->moneda)
                         ->setCellValue('B'.$intFila, $arrMon->cuenta);

                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}


			//Incrementar el indice para escribir los datos de las DEPARTAMENTOS
			$intFila+=2;

	    }//Cierre de verificación de MONEDAS

		
		//------------------------------------------------------------------------------------------------------------------------
        //---------- DEPARTAMENTOS
        //------------------------------------------------------------------------------------------------------------------------------------------
		//Verificar si existe información de las DEPARTAMENTOS
		if($otdConfDepto)
		{
			//Asignar indice de fila donde se empezaran a escribir las DEPARTAMENTOS
			$intPosEncabezados = $intFila;
			//Se agregan las columnas de cabecera
	        $objExcel->setActiveSheetIndex(0)
	        		 ->setCellValue('A'.$intPosEncabezados, 'DEPARTAMENTOS');
	        //Incrementar indice para escribir la segunda cabecera
	        $intFila++;         
	        
	        //Se agregan las columnas de cabecera
	        $objExcel->setActiveSheetIndex(0)
	        		 ->setCellValue('A'.$intFila, 'MÓDULO')
	                 ->setCellValue('B'.$intFila, 'REFERENCIA')
	                 ->setCellValue('C'.$intFila, 'CUENTA');
	        
	        //Combinar las siguientes celdas
       		$objExcel->setActiveSheetIndex(0)
       			 	 ->mergeCells('A'.$intPosEncabezados.':C'.$intPosEncabezados);

	        //Preferencias de color de relleno de celda 
       		$objExcel->getActiveSheet()
	        		 ->getStyle('A'.$intPosEncabezados.':C'.$intFila)
	        		 ->getFill()
	        		 ->applyFromArray($arrStyleColumnas);
	        

	       //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('A'.$intPosEncabezados.':C'.$intFila)
	    			 ->applyFromArray($arrStyleFuenteColumnas);


	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('A'.$intPosEncabezados.':C'.$intFila)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentCenter);

	        //Incrementar el indice para escribir los datos
             $intFila++; 

            //Recorremos el arreglo 
			foreach ($otdConfDepto as $arrDepto)
			{   

				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
						 ->setCellValue('A'.$intFila, $arrDepto->tipo_referencia)
						 ->setCellValue('B'.$intFila, $arrDepto->referencia)
                         ->setCellValue('C'.$intFila, $arrDepto->cuenta);

                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}


			//Incrementar el indice para escribir los procesos
			$intFila+=2;

	    }//Cierre de verificación de DEPARTAMENTOS


	    //------------------------------------------------------------------------------------------------------------------------
        //---------- PROCESOS
        //------------------------------------------------------------------------------------------------------------------------------------------
		//Verificar si existe información de los procesos
		if($otdConfProcesos)
		{
			//Asignar indice de fila donde se empezaran a escribir los procesos
			$intPosEncabezados = $intFila;
			//Se agregan las columnas de cabecera
	        $objExcel->setActiveSheetIndex(0)
	        		 ->setCellValue('A'.$intPosEncabezados, 'PROCESOS');
	        
	        //Incrementar indice para escribir la segunda cabecera
	        $intFila++;         
	        
	        //Se agregan las columnas de cabecera
	        $objExcel->setActiveSheetIndex(0)
	        		 ->setCellValue('A'.$intFila, 'MÓDULO')
	                 ->setCellValue('B'.$intFila, 'REFERENCIA')
	                 ->setCellValue('C'.$intFila, 'PROCESO');
	        
	        //Combinar las siguientes celdas
       		$objExcel->setActiveSheetIndex(0)
       			 	 ->mergeCells('A'.$intPosEncabezados.':C'.$intPosEncabezados);

	        //Preferencias de color de relleno de celda 
       		$objExcel->getActiveSheet()
	        		 ->getStyle('A'.$intPosEncabezados.':C'.$intFila)
	        		 ->getFill()
	        		 ->applyFromArray($arrStyleColumnas);
	        

	       //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('A'.$intPosEncabezados.':C'.$intFila)
	    			 ->applyFromArray($arrStyleFuenteColumnas);


	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('A'.$intPosEncabezados.':C'.$intFila)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentCenter);

	         //Incrementar el indice para escribir los datos
             $intFila++; 

            //Recorremos el arreglo 
			foreach ($otdConfProcesos as $arrProc)
			{   

				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
						 ->setCellValue('A'.$intFila, $arrProc->tipo_referencia)
						 ->setCellValue('B'.$intFila, $arrProc->referencia)
                         ->setCellValue('C'.$intFila, $arrProc->proceso);

                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Incrementar el indice para escribir los datos de las MÓDULOS
			$intFila+=2;

	    }//Cierre de verificación de cuentas de procesos


	    //------------------------------------------------------------------------------------------------------------------------
        //---------- MÓDULOS
        //------------------------------------------------------------------------------------------------------------------------------------------
		//Verificar si existe información de las MÓDULOS
		if($otdConfModulos)
		{
			//Asignar indice de fila donde se empezaran a escribir las MÓDULOS
			$intPosEncabezados = $intFila;

			//Se agregan las columnas de cabecera
	        $objExcel->setActiveSheetIndex(0)
	        		 ->setCellValue('A'.$intPosEncabezados, 'MÓDULOS');
	        
	        //Incrementar indice para escribir la segunda cabecera
	        $intFila++;         
	        
	        //Se agregan las columnas de cabecera
	        $objExcel->setActiveSheetIndex(0)
	        		 ->setCellValue('A'.$intFila, 'MÓDULO')
	        		 ->setCellValue('B'.$intFila, 'REFERENCIA')
	                 ->setCellValue('C'.$intFila, 'CUENTA');
	        
	        //Combinar las siguientes celdas
       		$objExcel->setActiveSheetIndex(0)
       			 	 ->mergeCells('A'.$intPosEncabezados.':C'.$intPosEncabezados);

	        //Preferencias de color de relleno de celda 
       		$objExcel->getActiveSheet()
	        		 ->getStyle('A'.$intPosEncabezados.':C'.$intFila)
	        		 ->getFill()
	        		 ->applyFromArray($arrStyleColumnas);
	        

	       //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('A'.$intPosEncabezados.':C'.$intFila)
	    			 ->applyFromArray($arrStyleFuenteColumnas);


	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('A'.$intPosEncabezados.':C'.$intFila)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentCenter);

	         //Incrementar el indice para escribir los datos
             $intFila++; 

            //Recorremos el arreglo 
			foreach ($otdConfModulos as $arrMod)
			{   

				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
						  ->setCellValue('A'.$intFila, $arrMod->modulo)
                          ->setCellValue('B'.$intFila, $arrMod->referencia)
                          ->setCellValue('C'.$intFila, $arrMod->cuenta);


                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}


	    }//Cierre de verificación de MÓDULOS


	     //------------------------------------------------------------------------------------------------------------------------
        //---------- CUENTAS BANCARIAS
        //------------------------------------------------------------------------------------------------------------------------------------------
		//Verificar si existe información de las CUENTAS BANCARIAS
		if($otdConfCtasBancarias)
		{
			//Asignar indice de fila donde se empezaran a escribir las CUENTAS BANCARIAS
			$intPosEncabezados = $intFila;

			//Se agregan las columnas de cabecera
	        $objExcel->setActiveSheetIndex(0)
	        		 ->setCellValue('A'.$intPosEncabezados, 'CUENTAS BANCARIAS');
	        
	        //Incrementar indice para escribir la segunda cabecera
	        $intFila++;         
	        
	        //Se agregan las columnas de cabecera
	        $objExcel->setActiveSheetIndex(0)
	        		 ->setCellValue('A'.$intFila, 'CUENTA BANCARIA')
	        		 ->setCellValue('B'.$intFila, 'REFERENCIA')
	                 ->setCellValue('C'.$intFila, 'CUENTA');
	        
	        //Combinar las siguientes celdas
       		$objExcel->setActiveSheetIndex(0)
       			 	 ->mergeCells('A'.$intPosEncabezados.':C'.$intPosEncabezados);

	        //Preferencias de color de relleno de celda 
       		$objExcel->getActiveSheet()
	        		 ->getStyle('A'.$intPosEncabezados.':C'.$intFila)
	        		 ->getFill()
	        		 ->applyFromArray($arrStyleColumnas);
	        

	       //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('A'.$intPosEncabezados.':C'.$intFila)
	    			 ->applyFromArray($arrStyleFuenteColumnas);


	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('A'.$intPosEncabezados.':C'.$intFila)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentCenter);

	         //Incrementar el indice para escribir los datos
             $intFila++; 

            //Recorremos el arreglo 
			foreach ($otdConfCtasBancarias as $arrCta)
			{   

				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
						  ->setCellValue('A'.$intFila, $arrCta->cuenta_bancaria)
                          ->setCellValue('B'.$intFila, $arrCta->tipo_referencia)
                          ->setCellValue('C'.$intFila, $arrCta->cuenta);


                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}


	    }//Cierre de verificación de CUENTAS BANCARIAS


		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'configuraciones_polizas.xls', 'configuraciones', $intFila);
	}


	/*******************************************************************************************************************
	Funciones de la tabla configuracion_ieps
	*********************************************************************************************************************/
	//Método para guardar o modificar los datos de un registro
	public function guardar_configuracion_ieps()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objConfiguracion = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objConfiguracion->intConfiguracionID = $this->input->post('intConfiguracionID');
		$objConfiguracion->intTasaCuotaID = $this->input->post('intTasaCuotaID');
		$objConfiguracion->intTasaCuotaIDAnterior = $this->input->post('intTasaCuotaIDAnterior');
		$objConfiguracion->strCuenta = mb_strtoupper(trim($this->input->post('strCuenta')));
		$objConfiguracion->intUsuarioID = $this->session->userdata('usuario_id');

        //Definir las reglas de validación
		//Validar que la cuenta contable sea única
        if (($objConfiguracion->intConfiguracionID == '') OR 
			($objConfiguracion->intTasaCuotaIDAnterior != $objConfiguracion->intTasaCuotaID))
        {
            $this->form_validation->set_rules('intTasaCuotaID', 'porcentaje de IEPS',
            								  'required|is_unique[configuracion_ieps.tasa_cuota_id]');
        }
        else
        {
        	$this->form_validation->set_rules('intTasaCuotaID', 'porcentaje de IEPS', 'required');
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
			if (is_numeric($objConfiguracion->intConfiguracionID))
			{
				$bolResultado = $this->configuraciones->modificar_configuracion_ieps($objConfiguracion);
			}
			else
			{ 
				$bolResultado = $this->configuraciones->guardar_configuracion_ieps($objConfiguracion);
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
	

	/*******************************************************************************************************************
	Funciones de la tabla configuracion_monedas
	*********************************************************************************************************************/
	//Método para guardar o modificar los datos de un registro
	public function guardar_configuracion_monedas()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objConfiguracion = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objConfiguracion->intConfiguracionID = $this->input->post('intConfiguracionID');
		$objConfiguracion->intMonedaID = $this->input->post('intMonedaID');
		$objConfiguracion->intMonedaIDAnterior = $this->input->post('intMonedaIDAnterior');
		$objConfiguracion->strCuenta = mb_strtoupper(trim($this->input->post('strCuenta')));
		$objConfiguracion->intUsuarioID = $this->session->userdata('usuario_id');

        //Definir las reglas de validación
		//Validar que la cuenta contable sea única
        if (($objConfiguracion->intConfiguracionID == '') OR 
			($objConfiguracion->intMonedaIDAnterior != $objConfiguracion->intMonedaID))
        {
            $this->form_validation->set_rules('intMonedaID', 'moneda',
            								  'required|is_unique[configuracion_monedas.moneda_id]');
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
			if (is_numeric($objConfiguracion->intConfiguracionID))
			{
				$bolResultado = $this->configuraciones->modificar_configuracion_monedas($objConfiguracion);
			}
			else
			{ 
				$bolResultado = $this->configuraciones->guardar_configuracion_monedas($objConfiguracion);
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

  
	
	/*******************************************************************************************************************
	Funciones de la tabla configuracion_departamentos
	*********************************************************************************************************************/
	//Método para guardar o modificar los datos de un registro
	public function guardar_configuracion_departamentos()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objConfiguracion = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objConfiguracion->intConfiguracionID = $this->input->post('intConfiguracionID');
		$objConfiguracion->intReferenciaID = $this->input->post('intReferenciaID');
		$objConfiguracion->intReferenciaIDAnterior = $this->input->post('intReferenciaIDAnterior');
		$objConfiguracion->strTipoReferencia = $this->input->post('strTipoReferencia');
		$objConfiguracion->strTipoReferenciaAnterior = $this->input->post('strTipoReferenciaAnterior');
		$objConfiguracion->strCuenta = mb_strtoupper(trim($this->input->post('strCuenta')));
		$objConfiguracion->intUsuarioID = $this->session->userdata('usuario_id');

        //Definir las reglas de validación
		//Validar que la cuenta contable sea única
	  	if (($objConfiguracion->intConfiguracionID == '') OR 
        	($objConfiguracion->intReferenciaIDAnterior != $objConfiguracion->intReferenciaID) OR 
        	($objConfiguracion->strTipoReferenciaAnterior != $objConfiguracion->strTipoReferencia))
        {

            $this->form_validation->set_rules('intReferenciaID', 'referencia', 
        									  'required|callback_get_existencia_referencia['.$objConfiguracion->strTipoReferencia.']');
        }
        else
        {
        	$this->form_validation->set_rules('intReferenciaID', 'referencia', 'required');
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
			if (is_numeric($objConfiguracion->intConfiguracionID))
			{
				$bolResultado = $this->configuraciones->modificar_configuracion_departamentos($objConfiguracion);
			}
			else
			{ 
				$bolResultado = $this->configuraciones->guardar_configuracion_departamentos($objConfiguracion);
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


	

    /*******************************************************************************************************************
	Funciones de la tabla configuracion_departamentos
	*********************************************************************************************************************/
	//Método para guardar o modificar los datos de un registro
	public function guardar_configuracion_procesos()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objConfiguracion = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objConfiguracion->intConfiguracionID = $this->input->post('intConfiguracionID');
		$objConfiguracion->intReferenciaID = $this->input->post('intReferenciaID');
		$objConfiguracion->intReferenciaIDAnterior = $this->input->post('intReferenciaIDAnterior');
		$objConfiguracion->strTipoReferencia = $this->input->post('strTipoReferencia');
		$objConfiguracion->strTipoReferenciaAnterior = $this->input->post('strTipoReferenciaAnterior');
		$objConfiguracion->strProceso = mb_strtoupper(trim($this->input->post('strProceso')));
		$objConfiguracion->intUsuarioID = $this->session->userdata('usuario_id');

        //Definir las reglas de validación
		//Validar que la cuenta contable sea única
	  	if (($objConfiguracion->intConfiguracionID == '') OR 
        	($objConfiguracion->intReferenciaIDAnterior != $objConfiguracion->intReferenciaID) OR 
        	($objConfiguracion->strTipoReferenciaAnterior != $objConfiguracion->strTipoReferencia))
        {

            $this->form_validation->set_rules('intReferenciaID', 'referencia', 
        									  'required|callback_get_existencia_referencia['.$objConfiguracion->strTipoReferencia.']');
        }
        else
        {
        	$this->form_validation->set_rules('intReferenciaID', 'referencia', 'required');
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
			if (is_numeric($objConfiguracion->intConfiguracionID))
			{
				$bolResultado = $this->configuraciones->modificar_configuracion_procesos($objConfiguracion);
			}
			else
			{ 
				$bolResultado = $this->configuraciones->guardar_configuracion_procesos($objConfiguracion);
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


	/*******************************************************************************************************************
	Funciones de la tabla configuracion_modulos
	*********************************************************************************************************************/
	//Método para guardar o modificar los datos de un registro
	public function guardar_configuracion_modulos()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objConfiguracion = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objConfiguracion->intConfiguracionID = $this->input->post('intConfiguracionID');
		$objConfiguracion->intModuloID = $this->input->post('intModuloID');
		$objConfiguracion->intModuloIDAnterior = $this->input->post('intModuloIDAnterior');
		$objConfiguracion->strTipoReferencia = $this->input->post('strTipoReferencia');
		$objConfiguracion->strTipoReferenciaAnterior = $this->input->post('strTipoReferenciaAnterior');
		$objConfiguracion->strCuenta = mb_strtoupper(trim($this->input->post('strCuenta')));
		$objConfiguracion->intUsuarioID = $this->session->userdata('usuario_id');


        //Definir las reglas de validación
		//Validar que el módulo sea único
	 	if (($objConfiguracion->intConfiguracionID == '') OR 
        	($objConfiguracion->intModuloIDAnterior != $objConfiguracion->intModuloID) OR 
        	($objConfiguracion->strTipoReferenciaAnterior != $objConfiguracion->strTipoReferencia))
        {
            $this->form_validation->set_rules('intModuloID', 'módulo',
            								 'required|callback_get_existencia_modulo['.$objConfiguracion->strTipoReferencia.']');
        }
        else
        {
        	$this->form_validation->set_rules('intModuloID', 'módulo', 'required');
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
			if (is_numeric($objConfiguracion->intConfiguracionID))
			{
				$bolResultado = $this->configuraciones->modificar_configuracion_modulos($objConfiguracion);
			}
			else
			{ 
				$bolResultado = $this->configuraciones->guardar_configuracion_modulos($objConfiguracion);
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

	//Verifica la existencia del módulo en el tipo de referencia
	//para evitar duplicación de datos al momento de modificar o guardar un registro.
    public function get_existencia_modulo($intModuloID, $strTipoReferencia) 
    {	

		//Hacer un llamado al método para comprobar la existencia del módulo en el tipo de referencia
		$otdResultado = $this->configuraciones->buscar_configuracion_modulos(NULL, $intModuloID, $strTipoReferencia);
		//Si existen datos
		if($otdResultado)
		{
		    //Enviar mensaje de error
		    $this->form_validation->set_message('get_existencia_modulo', 'El módulo ya ha sido registrado en la referencia, favor de verificar.');
		    //Regresar FALSE para no permitir registrar o actualizar datos
		    return FALSE;
		}
		else
		{
			//Regresar TRUE para permitir registrar o actualizar datos
			return TRUE;
		}
    }



	/*******************************************************************************************************************
	Funciones de la tabla configuracion_cuentas_bancarias
	*********************************************************************************************************************/
	//Método para guardar o modificar los datos de un registro
	public function guardar_configuracion_cuentas_bancarias()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objConfiguracion = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objConfiguracion->intConfiguracionID = $this->input->post('intConfiguracionID');
		$objConfiguracion->intCuentaBancariaID = $this->input->post('intCuentaBancariaID');
		$objConfiguracion->intCuentaBancariaIDAnterior = $this->input->post('intCuentaBancariaIDAnterior');
		$objConfiguracion->strTipoReferencia = $this->input->post('strTipoReferencia');
		$objConfiguracion->strTipoReferenciaAnterior = $this->input->post('strTipoReferenciaAnterior');
		$objConfiguracion->strCuenta = mb_strtoupper(trim($this->input->post('strCuenta')));
		$objConfiguracion->intUsuarioID = $this->session->userdata('usuario_id');


        //Definir las reglas de validación
		//Validar que la cuenta bancaria sea única
	 	if (($objConfiguracion->intConfiguracionID == '') OR 
        	($objConfiguracion->intCuentaBancariaIDAnterior != $objConfiguracion->intCuentaBancariaID) OR 
        	($objConfiguracion->strTipoReferenciaAnterior != $objConfiguracion->strTipoReferencia))
        {
            $this->form_validation->set_rules('intCuentaBancariaID', 'cuenta bancaria',
            								 'required|callback_get_existencia_cta_bancaria['.$objConfiguracion->strTipoReferencia.']');
        }
        else
        {
        	$this->form_validation->set_rules('intCuentaBancariaID', 'cuenta bancaria', 'required');
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
			if (is_numeric($objConfiguracion->intConfiguracionID))
			{
				$bolResultado = $this->configuraciones->modificar_configuracion_cuentas_bancarias($objConfiguracion);
			}
			else
			{ 
				$bolResultado = $this->configuraciones->guardar_configuracion_cuentas_bancarias($objConfiguracion);
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

	//Verifica la existencia de la cuenta bancaria en el tipo de referencia
	//para evitar duplicación de datos al momento de modificar o guardar un registro.
    public function get_existencia_cta_bancaria($intCuentaBancariaID, $strTipoReferencia) 
    {	

		//Hacer un llamado al método para comprobar la existencia del módulo en el tipo de referencia
		$otdResultado = $this->configuraciones->buscar_configuracion_cuentas_bancarias(NULL, $intCuentaBancariaID, $strTipoReferencia);
		//Si existen datos
		if($otdResultado)
		{
		    //Enviar mensaje de error
		    $this->form_validation->set_message('get_existencia_cta_bancaria', 'La cuenta bancaria ya ha sido registrada en la referencia, favor de verificar.');
		    //Regresar FALSE para no permitir registrar o actualizar datos
		    return FALSE;
		}
		else
		{
			//Regresar TRUE para permitir registrar o actualizar datos
			return TRUE;
		}
    }
}