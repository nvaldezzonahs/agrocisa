<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validacion_prospectos extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('cuentas_cobrar/clientes_model', 'clientes');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('cuentas_cobrar/validacion_prospectos', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->clientes->filtro(trim($this->input->post('strBusqueda')),
										  'VALIDACION',
			                              $config['per_page'],
			                              $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['clientes'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			//Cambiar descripción del estatus
			$arrDet->estatus = 'VALIDACIÓN';

			//Variable que se utiliza para asignar el número interior
			$strNumInterior = (($arrDet->numero_interior !== NULL && 
						        empty($arrDet->numero_interior) === FALSE) ?
	                            ' INT. '.$arrDet->numero_interior : '');

		    //Variable que se utiliza para asignar el código postal
			$strCodigoPostal = (($arrDet->codigo_postal !== NULL && 
						        empty($arrDet->codigo_postal) === FALSE) ?
	                            ' C.P. '.$arrDet->codigo_postal : '');

			//Variable que se utiliza para concatenar municipio, estado y país
			$strMunicipio = (($arrDet->municipio !== NULL && 
						        empty($arrDet->municipio) === FALSE) ?
	                            ', '. $arrDet->municipio.', '.
	    						 $arrDet->estado.', '.$arrDet->pais : '');

			//Concatenar datos para el domicilio
	    	$arrDet->domicilio = $arrDet->calle.' #'.$arrDet->numero_exterior.$strNumInterior.
	    						 ' COL. ' .$arrDet->colonia.$strCodigoPostal. ' ' .
	    						 $arrDet->localidad.$strMunicipio;

			//Si el usuario cuenta con el permiso de acceso EDITAR
			if (in_array('EDITAR', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón EDITAR
				$arrDet->mostrarAccionEditar = '';
			}

			//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
			if (in_array('CAMBIAR ESTATUS', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón Desactivar
				$arrDet->mostrarAccionDesactivar = '';
			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['clientes'],
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

	//Método para modificar los datos de validación de un registro
	public function modificar()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objCliente = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objCliente->intProspectoID = $this->input->post('intProspectoID');
		$objCliente->strRazonSocial = mb_strtoupper(trim($this->input->post('strRazonSocial')));
		$objCliente->strRfc = mb_strtoupper(trim($this->input->post('strRfc')));
		$objCliente->strTipoPersona =  $this->input->post('strTipoPersona');
		$objCliente->strNombreComercial = mb_strtoupper(trim($this->input->post('strNombreComercial')));
		$objCliente->strRepresentanteLegal = mb_strtoupper(trim($this->input->post('strRepresentanteLegal')));
		$objCliente->strTelefonoPrincipal = $this->input->post('strTelefonoPrincipal');
		$objCliente->strTelefonoSecundario = $this->input->post('strTelefonoSecundario');
		$objCliente->strCorreoElectronico = mb_strtolower(trim($this->input->post('strCorreoElectronico')));
		$objCliente->strCalle = mb_strtoupper(trim($this->input->post('strCalle')));
		$objCliente->strNumeroExterior = mb_strtoupper($this->input->post('strNumeroExterior'));
		$objCliente->strNumeroInterior = mb_strtoupper($this->input->post('strNumeroInterior'));
		//Si no existe id del código postal asignar valor nulo
		$objCliente->intCodigoPostalID = (($this->input->post('intCodigoPostalID') !== '') ? 
							   $this->input->post('intCodigoPostalID') : NULL);
		$objCliente->strColonia = mb_strtoupper(trim($this->input->post('strColonia')));
		$objCliente->strLocalidad = mb_strtoupper(trim($this->input->post('strLocalidad')));
		$objCliente->strReferencia =  mb_strtoupper(trim($this->input->post('strReferencia')));
		//Si no existe id del municipio postal asignar valor nulo
		$objCliente->intMunicipioID = (($this->input->post('intMunicipioID') !== '') ? 
							$this->input->post('intMunicipioID') : NULL);
		$objCliente->strContactoNombre =  mb_strtoupper(trim($this->input->post('strContactoNombre')));
		$objCliente->strContactoTelefono = $this->input->post('strContactoTelefono');
		$objCliente->strContactoExtension = trim($this->input->post('strContactoExtension'));
		$objCliente->strContactoCelular = $this->input->post('strContactoCelular');
		$objCliente->strContactoCorreoElectronico =  mb_strtolower(trim($this->input->post('strContactoCorreoElectronico')));
		$objCliente->strEstatus = (($this->input->post('strEstatus') !== '')? $this->input->post('strEstatus') : NULL);
		$objCliente->intUsuarioID = $this->session->userdata('usuario_id');			
		//Actualizamos los datos de validación del registro
		$bolResultado = $this->clientes->modificar($objCliente);
        //Si no se obtienen errores al ejecutar el proceso
		if($bolResultado)
		{
			//Dependiendo del estatus cambiar el mensaje de éxito
			$strMensaje = MSJ_GUARDAR;

			//Si el estatus del registro es ACTIVO
			if($objCliente->strEstatus == 'ACTIVO')
			{
				$strMensaje = MSJ_AUTORIZAR;
			}

			//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE,
						 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
						      'mensaje' => $strMensaje);
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
		$intID = $this->input->post('intProspectoID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->clientes->buscar($intID);
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
		$this->form_validation->set_rules('intProspectoID', 'ID', 'required|integer');
		$this->form_validation->set_rules('strMensaje', 'Mensaje', 'required');
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
	        $intID = $this->input->post('intProspectoID');
		    $strMensaje = $this->input->post('strMensaje');
		    $strEstatus = 'RECHAZADO';
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->clientes->set_estatus($intID, $strEstatus, $strMensaje);
			//Si no se obtienen errores al ejecutar el proceso
			if($bolResultado)
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos = array('resultado' => TRUE,
							 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
							      'mensaje' => MSJ_RECHAZAR);
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
		$otdResultado = $this->clientes->buscar(NULL, 'VALIDACION', $strBusqueda); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  utf8_decode('LISTADO DE VALIDACIÓN DE PROSPECTOS');
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('CÓDIGO'), 'NOMBRE', 'CONTACTO', 'DOMICILIO', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(15, 55, 50, 50, 20);
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
				//Variable que se utiliza para asignar el número interior
				$strNumInterior = (($arrCol->numero_interior !== NULL && 
							        empty($arrCol->numero_interior) === FALSE) ?
		                            ' INT. '.$arrCol->numero_interior : '');

			    //Variable que se utiliza para asignar el código postal
				$strCodigoPostal = (($arrCol->codigo_postal !== NULL && 
							        empty($arrCol->codigo_postal) === FALSE) ?
		                            ' C.P. '.$arrCol->codigo_postal : '');

				//Variable que se utiliza para concatenar municipio, estado y país
				$strMunicipio = (($arrCol->municipio !== NULL && 
							        empty($arrCol->municipio) === FALSE) ?
		                            ', '. $arrCol->municipio.', '.
		    						 $arrCol->estado_rep.', '.$arrCol->pais_rep : '');

				//Concatenar datos para el domicilio
		    	$strDomicilio = $arrCol->calle.' #'.$arrCol->numero_exterior.$strNumInterior.
		    						 ' COL. ' .$arrCol->colonia.$strCodigoPostal. ' ' .
		    						 $arrCol->localidad.$strMunicipio;

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->codigo, utf8_decode($arrCol->nombre_comercial), 
								utf8_decode($arrCol->contacto_nombre), utf8_decode($strDomicilio), $arrCol->estatus), 
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
		$pdf->Output('validacion_prospectos.pdf','I'); 
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
		$otdResultado = $this->clientes->buscar(NULL, 'VALIDACION', $strBusqueda); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE VALIDACIÓN DE PROSPECTOS');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$intPosEncabezados, 'CÓDIGO')
                 ->setCellValue('B'.$intPosEncabezados, 'RAZÓN SOCIAL')
                 ->setCellValue('C'.$intPosEncabezados, 'RFC')
                 ->setCellValue('D'.$intPosEncabezados, 'NOMBRE COMERCIAL')
                 ->setCellValue('E'.$intPosEncabezados, 'REPRESENTANTE LEGAL')
                 ->setCellValue('F'.$intPosEncabezados, 'TELÉFONO PRINCIPAL')
        		 ->setCellValue('G'.$intPosEncabezados, 'TELÉFONO SECUNDARIO')
        		 ->setCellValue('H'.$intPosEncabezados, 'CORREO ELECTRÓNICO')
        		 ->setCellValue('I'.$intPosEncabezados, 'CALLE')
                 ->setCellValue('J'.$intPosEncabezados, 'NO. EXTERIOR')
                 ->setCellValue('K'.$intPosEncabezados, 'NO. INTERIOR')
                 ->setCellValue('L'.$intPosEncabezados, 'CÓDIGO POSTAL')
                 ->setCellValue('M'.$intPosEncabezados, 'COLONIA')
                 ->setCellValue('N'.$intPosEncabezados, 'LOCALIDAD')
                 ->setCellValue('O'.$intPosEncabezados, 'REFERENCIA')
                 ->setCellValue('P'.$intPosEncabezados, 'MUNICIPIO')
                 ->setCellValue('Q'.$intPosEncabezados, 'ESTADO')
                 ->setCellValue('R'.$intPosEncabezados, 'PAÍS')
                 ->setCellValue('S'.$intPosEncabezados, 'NOMBRE DE CONTACTO')
                 ->setCellValue('T'.$intPosEncabezados, 'TELÉFONO DE OFICINA')
                 ->setCellValue('U'.$intPosEncabezados, 'EXTENSIÓN')
                 ->setCellValue('V'.$intPosEncabezados, 'CELULAR')
                 ->setCellValue('W'.$intPosEncabezados, 'CORREO ELECTRÓNICO')
                 ->setCellValue('X'.$intPosEncabezados, 'ESTATUS');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:X9')
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
						 ->setCellValueExplicit('A'.$intFila, $arrCol->codigo, PHPExcel_Cell_DataType::TYPE_STRING)
		                 ->setCellValue('B'.$intFila, $arrCol->razon_social)
		                 ->setCellValue('C'.$intFila, $arrCol->rfc)
		                 ->setCellValue('D'.$intFila, $arrCol->nombre_comercial)
		                 ->setCellValue('E'.$intFila, $arrCol->representante_legal)
		                 ->setCellValue('F'.$intFila, $arrCol->telefono_principal)
		        		 ->setCellValue('G'.$intFila, $arrCol->telefono_secundario)
		        		 ->setCellValue('H'.$intFila, $arrCol->correo_electronico)
		        		 ->setCellValue('I'.$intFila, $arrCol->calle)
		                 ->setCellValue('J'.$intFila, $arrCol->numero_exterior)
		                 ->setCellValue('K'.$intFila, $arrCol->numero_interior)
		                 ->setCellValue('L'.$intFila, $arrCol->codigo_postal)
		                 ->setCellValue('M'.$intFila, $arrCol->colonia)
		                 ->setCellValue('N'.$intFila, $arrCol->localidad)
		                 ->setCellValue('O'.$intFila, $arrCol->referencia)
		                 ->setCellValue('P'.$intFila, $arrCol->municipio)
		                 ->setCellValue('Q'.$intFila, $arrCol->estado)
		                 ->setCellValue('R'.$intFila, $arrCol->pais)
		                 ->setCellValue('S'.$intFila, $arrCol->contacto_nombre)
		                 ->setCellValue('T'.$intFila, $arrCol->contacto_telefono)
		                 ->setCellValue('U'.$intFila, $arrCol->contacto_extension)
		                 ->setCellValue('V'.$intFila, $arrCol->contacto_celular)
		                 ->setCellValue('W'.$intFila, $arrCol->contacto_correo_electronico)
		                 ->setCellValue('X'.$intFila, 'VALIDACIÓN');
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('X'.$intFilaInicial.':'.'X'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('X'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('X'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'validacion_prospectos.xls', 'prospectos', $intFila);
	}
}