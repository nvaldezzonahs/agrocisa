<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursales extends MY_Controller {
	//Constructor de la clase
	function __construct ()
	{
		parent::__construct ();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('administracion/sucursales_model','sucursales');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('administracion/sucursales', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->sucursales->filtro(trim($this->input->post('strBusqueda')),
			                                $config['per_page'],
			                                $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['sucursales'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro =  'registro-'.$arrDet->estatus;
			//Variable que se utiliza para asignar el número interior
			$strNumInterior = (($arrDet->numero_interior !== NULL && 
						        empty($arrDet->numero_interior) === FALSE) ?
	                            ' INT. '.$arrDet->numero_interior : '');
			//Concatenar datos para el domicilio
	    	$arrDet->domicilio = $arrDet->calle . ' #' .$arrDet->numero_exterior .$strNumInterior.
	    						 ' COL. ' . $arrDet->colonia.' C.P. '.$arrDet->codigo_postal. ' ' .
	    						  $arrDet->localidad . ', ' . $arrDet->municipio. ', ' .
	    						  $arrDet->estado. ', ' .$arrDet->pais;

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
		$arrDatos = array('rows' => $result['sucursales'],
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
		$objSucursal = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objSucursal->intSucursalID = $this->input->post('intSucursalID');
		$objSucursal->strNombre = mb_strtoupper(trim($this->input->post('strNombre')));
		$objSucursal->strNombreAnterior = mb_strtoupper(trim($this->input->post('strNombreAnterior')));
		$objSucursal->strCalle = mb_strtoupper(trim($this->input->post('strCalle')));
		$objSucursal->strNumeroExterior = mb_strtoupper(trim($this->input->post('strNumeroExterior')));
		$objSucursal->strNumeroInterior = mb_strtoupper(trim($this->input->post('strNumeroInterior')));
		$objSucursal->strCodigoPostal = $this->input->post('strCodigoPostal');
		$objSucursal->strColonia = mb_strtoupper(trim($this->input->post('strColonia')));
		$objSucursal->intLocalidadID = $this->input->post('intLocalidadID');
		$objSucursal->strTelefono01 = $this->input->post('strTelefono01');
		$objSucursal->strTelefono02 = $this->input->post('strTelefono02');
		$objSucursal->strCorreoElectronico = mb_strtolower(trim($this->input->post('strCorreoElectronico')));
		$objSucursal->intEmpresaID = $this->session->userdata('empresa_id');
		$objSucursal->intUsuarioID = $this->session->userdata('usuario_id');

		//Definir las reglas de validación
		//Validar que el nombre sea único
		if (($objSucursal->intSucursalID == '') OR 
			($objSucursal->strNombreAnterior != $objSucursal->strNombre))
		{
			$this->form_validation->set_rules('strNombre', 'nombre', 'required|is_unique[sucursales.nombre]');
		}
		else
		{
			$this->form_validation->set_rules('strNombre', 'nombre', 'required');
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
			if (is_numeric($objSucursal->intSucursalID))
			{
				$bolResultado = $this->sucursales->modificar($objSucursal);
			}
			else
			{
				$bolResultado = $this->sucursales->guardar($objSucursal);
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
			$otdResultado = $this->sucursales->buscar($strBusqueda);
		}
		else
		{
    		$otdResultado = $this->sucursales->buscar(NULL, $strBusqueda);
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
		$this->form_validation->set_rules('intSucursalID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intSucursalID');
		    $strEstatus = $this->input->post('strEstatus');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->sucursales->set_estatus($intID, $strEstatus);
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

	//Método para regresar todas las sucursales (activas) del usuario logeado en el sistema registradas en la BD (y poder cargarlos en un combobox).
	public function get_combo_box($strTipo = NULL)
	{
		// Si la llamada es desde la página de inicio, se cargan las sucursales a las que tiene acceso el usuario logueado
		if ($strTipo == 'home')
		{
			//Obtener el listado de sucursales activas a las que tiene acceso el usuario
			$arrDatos['sucursales'] = $this->sucursales->get_combo_box($this->session->userdata('usuario_id'));
		}
		else
		{
			//Obtener el listado de sucursales activas
			$arrDatos['sucursales'] = $this->sucursales->get_combo_box();
		}

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}
	
	//Método para regresar todos los registros activos en un autocomplete
	public function autocomplete()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$strDescripcion = trim($this->input->post('strDescripcion'));
		$strTipo = $this->input->post('strTipo');

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->sucursales->autocomplete($strDescripcion, $strTipo);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->nombre, 
		        						'data' => $arrCol->sucursal_id);
				}
	    	}

	    	//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}

	//Método para regresar todos los registros activos en un autocomplete para obtener sucursales diferentes a la logeada
	public function destino_autocomplete()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$strDescripcion = trim($this->input->post('strDescripcion'));
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->sucursales->destino_autocomplete($strDescripcion, $intSucursalID);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->nombre, 
		        						'data' => $arrCol->sucursal_id);
				}
	    	}
	    	
	    	//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}


	//Método para generar un reporte PDF con el listado de los registros en la BD
	public function get_reporte()
	{	            
		
	    //Variables que se utilizan para recuperar los valores de la vista
		$strBusqueda = trim($this->input->post('strBusqueda'));
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;

		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->sucursales->buscar(NULL, NULL, $strBusqueda); 
		
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1= utf8_decode('LISTADO DE SUCURSALES');
		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array('SUCURSAL', utf8_decode('TELÉFONO'), 'DOMICILIO', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(60, 20, 90, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'C');
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
				//Variable que se utiliza para asignar el número interior
			    $strNumInterior = (($arrCol->numero_interior !== NULL && 
					                empty($arrCol->numero_interior) === FALSE) ?
	                                ' INT. '.$arrCol->numero_interior : '');

	        	//Concatenar datos para el domicilio
				$strDomicilio = $arrCol->calle . ' #' .$arrCol->numero_exterior .$strNumInterior.
							   ' COL. ' . $arrCol->colonia.' C.P. '.$arrCol->codigo_postal.' ' .
							    $arrCol->localidad . ', ' . $arrCol->municipio. ', ' .
							    $arrCol->estado_rep. ', ' .$arrCol->pais_rep;

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol->nombre), $arrCol->telefono_01, 
							    utf8_decode($strDomicilio), $arrCol->estatus), 
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
		$pdf->Output('sucursales.pdf','I'); 
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
		$otdResultado = $this->sucursales->buscar(NULL, NULL, $strBusqueda); 
     	
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE SUCURSALES');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$intPosEncabezados, 'SUCURSAL')
                 ->setCellValue('B'.$intPosEncabezados, 'CALLE')
                 ->setCellValue('C'.$intPosEncabezados, 'NO. EXTERIOR')
                 ->setCellValue('D'.$intPosEncabezados, 'NO. INTERIOR')
                 ->setCellValue('E'.$intPosEncabezados, 'CÓDIGO POSTAL')
                 ->setCellValue('F'.$intPosEncabezados, 'COLONIA')
                 ->setCellValue('G'.$intPosEncabezados, 'LOCALIDAD')
                 ->setCellValue('H'.$intPosEncabezados, 'MUNICIPIO')
                 ->setCellValue('I'.$intPosEncabezados, 'ESTADO')
                 ->setCellValue('J'.$intPosEncabezados, 'PAÍS')
                 ->setCellValue('K'.$intPosEncabezados, 'TELÉFONO 01')
                 ->setCellValue('L'.$intPosEncabezados, 'TELÉFONO 02')
                 ->setCellValue('M'.$intPosEncabezados, 'CORREO ELECTRÓNICO')
                 ->setCellValue('N'.$intPosEncabezados, 'ESTATUS');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
        		 ->getStyle('A9:N9')
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
               			 ->setCellValue('A'.$intFila, $arrCol->nombre)
                         ->setCellValue('B'.$intFila, $arrCol->calle)
                         ->setCellValue('C'.$intFila, $arrCol->numero_exterior)
                         ->setCellValue('D'.$intFila, $arrCol->numero_interior)
                         ->setCellValue('E'.$intFila, $arrCol->codigo_postal)
                         ->setCellValue('F'.$intFila, $arrCol->colonia)
                         ->setCellValue('G'.$intFila, $arrCol->localidad)
                         ->setCellValue('H'.$intFila, $arrCol->municipio)
                         ->setCellValue('I'.$intFila, $arrCol->estado)
                         ->setCellValue('J'.$intFila, $arrCol->pais)
                         ->setCellValue('K'.$intFila, $arrCol->telefono_01)
                         ->setCellValue('L'.$intFila, $arrCol->telefono_02)
                         ->setCellValue('M'.$intFila, $arrCol->correo_electronico)
                         ->setCellValue('N'.$intFila, $arrCol->estatus);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('N'.$intFilaInicial.':'.'N'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('N'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('N'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'sucursales.xls', 'sucursales', $intFila);
	}
}