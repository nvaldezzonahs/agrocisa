<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends MY_Controller {

		//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de reportes
		$this->load->model('contabilidad/reportes_model', 'reportes');

	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('contabilidad/reportes', $arrDatos);
	}

	/*******************************************************************************************************************
	Funciones de la tabla reportes
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->reportes->filtro(trim($this->input->post('strBusqueda')),
			                           $config['per_page'],
			                           $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['reportes'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
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
				//Asignar cadena vacia para mostrar botón Imprimir
        		$arrDet->mostrarAccionImprimir = '';
			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['reportes'],
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
		$objReporte = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista
		//Datos del reporte
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objReporte->intReporteID = $this->input->post('intReporteID');
		$objReporte->strTitulo = mb_strtoupper(trim($this->input->post('strTitulo')));
		$objReporte->strTituloAnterior = mb_strtoupper(trim($this->input->post('strTituloAnterior')));
		$objReporte->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los detalles del reporte
		$objReporte->arrDetalles = json_decode($this->input->post('arrDetalles'));	


		//Definir las reglas de validación
		//Validar que el título sea único
        if (($objReporte->intReporteID == '') OR ($objReporte->strTituloAnterior != $objReporte->strTitulo))
        {
            $this->form_validation->set_rules('strTitulo', 'título', 'required|is_unique[reportes.titulo]');
        }
        else
        {
        	$this->form_validation->set_rules('strTitulo', 'título', 'required');
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
			if (is_numeric($objReporte->intReporteID))
			{
				$bolResultado = $this->reportes->modificar($objReporte);
			}
			else
			{ 
				$bolResultado = $this->reportes->guardar($objReporte);
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
			$otdResultado = $this->reportes->buscar($strBusqueda);
		}
		else 
		{
    		$otdResultado = $this->reportes->buscar(NULL, $strBusqueda);
		}

		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			
			$arrDatos['row'] = $otdResultado;

			//Seleccionar los detalles del registro
			$otdDetalles = $this->reportes->buscar_detalles($otdResultado->reporte_id);
			//Si existen detalles del registro, se asignan al array
			if($otdDetalles)
			{
				//Hacer recorrido para agregar las cuentas del registro
				foreach ($otdDetalles as $arrDet)
				{

					//Seleccionar las cuentas del detalle
					$arrDet->arrCuentas =  $this->reportes->buscar_cuentas($otdResultado->reporte_id, $arrDet->renglon);
				}

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
		$this->form_validation->set_rules('intReporteID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intReporteID');
		    $strEstatus = $this->input->post('strEstatus');
		   
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->reportes->set_estatus($intID, $strEstatus);
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
		$intReporteID = $this->input->post('intReporteID');

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);

			
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->reportes->autocomplete($strDescripcion, $intReporteID);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->concepto_padre, 
		        						'data' => $arrCol->concepto_padre);
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

		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->reportes->buscar(NULL, NULL, $strBusqueda);
		
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  'LISTADO DE REPORTES ';
		
		//Establece los títulos de la cabeceras
		$pdf->arrCabecera = array(utf8_decode('TÍTULO'),  'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(170, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C');
		//Establece el ancho de las columnas de cabecera detalles del reporte
		$arrAnchuraDetalles = array(40, 40, 20);
		//Establece la alineación de las celdas de la tabla detalles del reporte
		$arrAlineacionDetalles = array('L', 'L', 'R');
		//Establece el ancho de las columnas de cabecera cuentas del detalle
		$arrAnchuraDetCtasR = array(90);
		//Establece la alineación de las celdas de la tabla cuentas del detalle
		$arrAlineacionDetCtasR = array('L');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo para obtener la información de los reportes
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol->titulo), $arrCol->estatus), 
							    $pdf->arrAlineacion, 'ClippedCell');
				
				//Seleccionar los detalles del reporte
	    		$otdDetalles = $this->reportes->buscar_detalles($arrCol->reporte_id);
	    		//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDetR)
					{
						$pdf->SetX(15);
						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraDetalles);


						//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
						$pdf->Row(array(utf8_decode($arrDetR->concepto_padre), utf8_decode($arrDetR->concepto), 
										$arrDetR->orden), 
										$arrAlineacionDetalles, 'ClippedCell');

						
						 
						//Seleccionar los cuentas del detalle
	    				$otdDetallesCtas = $this->reportes->buscar_cuentas($arrCol->reporte_id, $arrDetR->renglon);
	    				//Verificar si existe información de los detalles relacionados
						if ($otdDetallesCtas) 
						{
							//Establece el ancho de las columnas
							$pdf->SetWidths($arrAnchuraDetCtasR);
							
							//Recorremos el arreglo 
							foreach ($otdDetallesCtas as $arrDetCta)
							{
								$pdf->SetX(18);

								
								//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
								$pdf->Row(array(utf8_decode($arrDetCta->cuenta)), 
												$arrAlineacionDetCtasR, 'ClippedCell', 'SI');
							}

							$pdf->Ln(2);//Deja un salto de línea

						}//Cierre de verificación de cuentas

					}

					$pdf->Ln(2);//Deja un salto de línea
				
				}//Cierre de verificación de detalles del reporte

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
		$pdf->Output('reportes.pdf','I'); 
	}



	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$intReporteID = $this->input->post('intReporteID');

		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->reportes->buscar($intReporteID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->reportes->buscar_detalles($intReporteID);
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical

		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variable que se utiliza para asignar el acumulado del subtotal
		$intAcumSubtotal = 0;
		//Variable que se utiliza para asignar el acumulado del IVA
		$intAcumIva = 0;
		//Variable que se utiliza para asignar el acumulado del IEPS
		$intAcumIeps = 0;
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'reporte';
		//Agregar la primer pagina
		$pdf->AddPage();
		//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
		$this->get_encabezado_archivo_pdf($pdf);

		//Verificar si hay información del registro
		if($otdResultado)
		{

			//Hacer un llamado a la función para mostrar imagen del estatus (INACTIVO/TIMBRAR)
			$this->get_img_estatus_archivo_pdf($pdf, $otdResultado->estatus);

			//------------------------------------------------------------------------------------------------------------------------
			//---------- DATOS DEL REPORTE
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 42);
			$pdf->ClippedCell(185, 3, 'REPORTE', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0); //establece el color de texto
			//Título
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, 46);
			$pdf->ClippedCell(12, 3, utf8_decode('TÍTULO'));

			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Título
			$pdf->SetXY(27, 46);
			$pdf->ClippedCell(158, 3, utf8_decode($otdResultado->titulo));

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DEL REPORTE
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 54);
			$pdf->ClippedCell(185, 3, 'CONCEPTOS', 0, 0, 'C', TRUE);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);

			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				//Tabla con los detalles del movimiento
				$pdf->SetXY(15, 58);
				//Crea los titulos de la cabecera
				$arrCabecera = array('Agrupador', 'Concepto', 'Orden');
				 //Establece el ancho de las columnas de cabecera
				$arrAnchura = array(80, 80, 25);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'R');
				//Recorre el array de títulos de encabezado 1 para crearlos
				for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchura[$intCont], 3, $arrCabecera[$intCont], 1, 0, 
							   $arrAlineacion[$intCont], TRUE);
				}

				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDet)
				{ 
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchura);
					$pdf->SetX(15);

					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(utf8_decode($arrDet->concepto_padre), 
									utf8_decode($arrDet->concepto), 
										$arrDet->orden),
									$arrAlineacion, 'ClippedCell');
					//Seleccionar los cuentas del detalle
    				$otdDetallesCtas = $this->reportes->buscar_cuentas($otdResultado->reporte_id, $arrDet->renglon);
    				//Verificar si existe información de los detalles relacionados
					if ($otdDetallesCtas) 
					{
						$pdf->Ln(1);//Espacios de salto de línea
					    $pdf->SetX(15);
					    //Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						//Detalles relacionados
						$pdf->ClippedCell(80, 3, 'CUENTAS CONTABLES');
						$pdf->Ln();//Espacios de salto de línea
						 $pdf->SetX(15);
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_PIE_PAGINA_PDF);
						//Crea los titulos de la cabecera
						$arrCabeceraDetCtas = array('CUENTA');
						//Establece el ancho de las columnas de cabecera
						$arrAnchuraDetCtas = array(185);
						//Establece la alineación de las celdas de la tabla 
						$arrAlineacioDetCtas = array('L');
						//Recorre el array de títulos de encabezado para crearlos
						for ($intCont = 0; $intCont < count($arrCabeceraDetCtas); $intCont++)
						{
							//inserta los titulos de la cabecera
							$pdf->Cell($arrAnchuraDetCtas[$intCont], 3, $arrCabeceraDetCtas[$intCont], 0, 0, $arrAlineacioDetCtas[$intCont], FALSE);
						}
						
						$pdf->Ln(); //Deja un salto de línea
						$intPosY = $pdf->GetY();
						$pdf->SetXY(15, $intPosY);
						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraDetCtas);	
						//Recorremos el arreglo 
						foreach ($otdDetallesCtas as $arrDetCta)
						{
							$pdf->SetX(18);

							
							//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							$pdf->Row(array(utf8_decode($arrDetCta->cuenta)), 
											$arrAlineacioDetCtas, 'ClippedCell', 'SI');
						}

						$pdf->Ln(2);//Deja un salto de línea

					}//Cierre de verificación de cuentas
					
					//Asignar posición de la ordenada para dibujar línea
	    			$intPosYL = $pdf->GetY();	
					
					//Dibuja una línea para separar la información de los detalles
	    			$pdf->Line(15, $intPosYL , 200, $intPosYL );	

				}//Cierre de foreach detalles


			}//Cierre de verificación de detalles


		}//Cierre de verificación de información

		//Ejecutar la salida del reporte
		$pdf->Output($strNombreArchivo.'.pdf','I'); 

	}


	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
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
		$otdResultado = $this->reportes->buscar(NULL, NULL, $strBusqueda);
	
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE REPORTES '.$strTituloRangoFechas);
		
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'TÍTULO')
        		 ->setCellValue('B'.$intPosEncabezados, 'ESTATUS')
        		 ->setCellValue('C'.$intPosEncabezados, 'AGRUPADOR')
        		 ->setCellValue('D'.$intPosEncabezados, 'CONCEPTO')
        		 ->setCellValue('E'.$intPosEncabezados, 'ORDEN')
        		 ->setCellValue('F'.$intPosEncabezados, 'CUENTA');



        //Definir estilo de las celdas correspondientes a los encabezados
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
    			 ->getStyle('A10:F10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

    	//Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:F10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:F10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				
                //Seleccionar los detalles del reporte
	    		$otdDetalles = $this->reportes->buscar_detalles($arrCol->reporte_id);
	    		//Verificar si existe información de los detalles 
				if ($otdDetalles) 
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDetR)
					{
						

						//Seleccionar los cuentas del detalle
	    				$otdDetallesCtas = $this->reportes->buscar_cuentas($arrCol->reporte_id, $arrDetR->renglon);
	    				//Verificar si existe información de los detalles relacionados
						if ($otdDetallesCtas) 
						{
							
							//Recorremos el arreglo 
							foreach ($otdDetallesCtas as $arrDetCta)
							{

								

					        	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
								//Agregar información del registro
								$objExcel->setActiveSheetIndex(0)
								 		->setCellValueExplicit('A'.$intFila, $arrCol->titulo, PHPExcel_Cell_DataType::TYPE_STRING)
								 		->setCellValue('B'.$intFila, $arrCol->estatus)
				                        ->setCellValue('C'.$intFila, $arrDetR->concepto_padre)
				                        ->setCellValue('D'.$intFila, $arrDetR->concepto)
				                        ->setCellValue('E'.$intFila, $arrDetR->orden)
				                        ->setCellValue('F'.$intFila, $arrDetCta->cuenta);
	                    		
	                    		//Incrementar el indice para escribir los datos del siguiente registro
	               				$intFila++;


							}

						}//Cierre de verificación de cuentas

					}
				
				}//Cierre de verificación de detalles del reporte


			    //Incrementar el contador por cada registro
				$intContador++;
			}

			

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
		        	 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);
                	  
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('B'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('B'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'reportes.xls', 'reportes', $intFila);
	}

}