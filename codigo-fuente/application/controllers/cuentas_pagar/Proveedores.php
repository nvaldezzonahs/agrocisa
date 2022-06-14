<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('cuentas_pagar/proveedores_model', 'proveedores');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('cuentas_pagar/proveedores', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->proveedores->filtro($this->input->post('strEstatus'),
											 trim($this->input->post('strBusqueda')),
			                                 $config['per_page'],
			                                 $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['proveedores'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionAutorizar = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;

			//Variable que se utiliza para asignar el número interior
			$strNumInterior = (($arrDet->numero_interior !== NULL && 
						        empty($arrDet->numero_interior) === FALSE) ?
	                            ' INT. '.$arrDet->numero_interior : '');
			
			//Concatenar datos para el domicilio
	    	$arrDet->domicilio = $arrDet->calle . ' #' .$arrDet->numero_exterior .$strNumInterior.
	    						 ' COL. ' . $arrDet->colonia.' C.P. '.$arrDet->codigo_postal. ' ' .
	    						 $arrDet->localidad . ', ' . $arrDet->municipio. ', ' .
	    						 $arrDet->estado. ', ' .$arrDet->pais;
	    						  
			//Si el estatus del registro es VALIDACION o ACTIVO
			if($arrDet->estatus == 'VALIDACION' OR $arrDet->estatus == 'ACTIVO')
			{
				//Si el estatus del registro es VALIDACION
				if($arrDet->estatus == 'VALIDACION')
				{
					//Si el usuario cuenta con el permiso de acceso AUTORIZAR
					if (in_array('AUTORIZAR', $arrPermisos))
					{
						//Asignar cadena vacia para mostrar botón Autorizar
						$arrDet->mostrarAccionAutorizar = '';
					}
				}
				
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
		$arrDatos = array('rows' => $result['proveedores'],
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
		$objProveedor = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista
		//Datos del proveedor
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
		$objProveedor->intProveedorID = $this->input->post('intProveedorID');
		$objProveedor->strCodigo = $this->input->post('strCodigo');
		$objProveedor->strRazonSocial = mb_strtoupper(trim($this->input->post('strRazonSocial')));
		$objProveedor->strRfc = mb_strtoupper(trim($this->input->post('strRfc')));
		//Si no existe id del municipio de nacimiento asignar valor nulo
		$objProveedor->intRegimenFiscalID = (($this->input->post('intRegimenFiscalID') !== '') ? 
							          			   $this->input->post('intRegimenFiscalID') : NULL);
		$objProveedor->strNombreComercial = mb_strtoupper(trim($this->input->post('strNombreComercial')));
		$objProveedor->strTipoProveedor = $this->input->post('strTipoProveedor');
		$objProveedor->strTelefonoPrincipal = $this->input->post('strTelefonoPrincipal');
		$objProveedor->strTelefonoSecundario = $this->input->post('strTelefonoSecundario');
		$objProveedor->strCorreoElectronico = mb_strtolower(trim($this->input->post('strCorreoElectronico')));
		$objProveedor->strCalle = mb_strtoupper(trim($this->input->post('strCalle')));
		$objProveedor->strNumeroExterior = mb_strtoupper(trim($this->input->post('strNumeroExterior')));
		$objProveedor->strNumeroInterior = mb_strtoupper(trim($this->input->post('strNumeroInterior')));
		$objProveedor->strColonia = mb_strtoupper(trim($this->input->post('strColonia')));
		$objProveedor->strReferencia = mb_strtoupper(trim($this->input->post('strReferencia')));
		$objProveedor->intCodigoPostalID = $this->input->post('intCodigoPostalID');
		$objProveedor->strLocalidad = mb_strtoupper(trim($this->input->post('strLocalidad')));
		$objProveedor->intMunicipioID = $this->input->post('intMunicipioID');
		$objProveedor->strContactoNombre = mb_strtoupper(trim($this->input->post('strContactoNombre')));
		$objProveedor->strContactoTelefono = $this->input->post('strContactoTelefono');
		$objProveedor->strContactoExtension = trim($this->input->post('strContactoExtension'));
		$objProveedor->strContactoCelular = $this->input->post('strContactoCelular');
		$objProveedor->strContactoCorreoElectronico = mb_strtolower(trim($this->input->post('strContactoCorreoElectronico')));
		$objProveedor->intDiasCredito = trim($this->input->post('intDiasCredito'));
		$objProveedor->intLimiteCredito = trim($this->input->post('intLimiteCredito'));
		$objProveedor->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de las cuentas bancarias del proveedor
		$objProveedor->arrCuentasBancarias = json_decode($this->input->post('arrCuentasBancarias'));
		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objProveedor->intProveedorID))
		{
			$bolResultado = $this->proveedores->modificar($objProveedor);
		}
		else
		{ 
			$bolResultado = $this->proveedores->guardar($objProveedor);

			/*Quitar '_'  de la cadena (resultadoTransaccion_proveedorID_codigo) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			list($bolResultado, $objProveedor->intProveedorID, $objProveedor->strCodigo) = explode("_", $bolResultado); 
		}
        //Si no se obtienen errores al ejecutar el proceso
		if($bolResultado)
		{
			//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE,
						 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
						 	  'proveedor_id' => $objProveedor->intProveedorID,
						 	  'codigo' => $objProveedor->strCodigo,
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

    //Verifica la existencia del rfc para permitir guardar un nuevo registro.
    public function get_existencia() 
    {	
    	//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('mensaje' => NULL);

    	//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
		$intProveedorID = $this->input->post('intProveedorID');
		$strRfc = mb_strtoupper(trim($this->input->post('strRfc')));
		$strRfcAnterior = mb_strtoupper(trim($this->input->post('strRfcAnterior')));

		/*Verificar si el RFC del proveedor existe, de ser así, preguntar al usuario si desea dar de alta
		 *un nuevo registro con el mismo RFC*/
        if (($intProveedorID == '') OR ($strRfcAnterior != $strRfc))
        {
            //Hacer un llamado al método para comprobar la existencia del rfc
			$otdResultado = $this->proveedores->buscar(NULL, $strRfc);
			//Si existen datos, asignar los datos recuperados en el array
			if($otdResultado)
			{
				$arrDatos['mensaje'] = '¿Este RFC se encuentra registrado, desea guardarlo como un nuevo proveedor?';
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
		$intID = $this->input->post('intProveedorID');
		$strRfc =  $this->input->post('strRfc');
		//Seleccionar los datos del registro que coincide con el id
		if($strRfc != ''){
			$otdResultado = $this->proveedores->buscar(NULL, $strRfc);
		}
		else{
			$otdResultado = $this->proveedores->buscar($intID);
		}
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
			//Seleccionar las cuentas bancarias del registro
			$otdCuentasBancarias = $this->proveedores->buscar_cuentas_bancarias($intID);
			//Si existen cuentas bancarias del registro, se asignan al array
			if($otdCuentasBancarias)
			{
				$arrDatos['cuentas_bancarias'] = $otdCuentasBancarias;
			}
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intProveedorID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intProveedorID');
		    $strEstatus = $this->input->post('strEstatus');
		    //Dependiendo del estatus cambiar su valor
	        //Si el estatus del registro es INACTIVO
			if ($strEstatus == "INACTIVO")
			{
				$strEstatus = "VALIDACION";
			}
			else //ACTIVO  o VALIDACION
			{
				$strEstatus = "INACTIVO";
			}

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->proveedores->set_estatus($intID, $strEstatus);
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
			$otdResultado = $this->proveedores->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->proveedor, 
		        						'data' => $arrCol->proveedor_id,
		        					    'dias_credito' => $arrCol->dias_credito,
		        					    'rfc' => $arrCol->rfc,
		        						'razon_social' => $arrCol->razon_social, 
		        						'regimen_fiscal_id'=> $arrCol->regimen_fiscal_id);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}

	//Método para enviar la autorización (o el rechazo) de un registro
	public function set_enviar_autorizacion()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intProveedorID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intProveedorID');
	        $strUsuarios = $this->input->post('strUsuarios');
	        $strMensaje = trim($this->input->post('strMensaje'));
	        //Si el tipo de acción corresponde a Guardar asignar valor nulo
			$strEstatus = (($this->input->post('strTipoAccion') === 'Guardar') ? 
							NULL : $this->input->post('strEstatus'));

	        //Hacer un llamado al método para autorizar o rechazar los datos de un registro
			$bolResultado = $this->proveedores->set_enviar_autorizacion($intID, $strUsuarios, $strMensaje, $strEstatus);
			//Si no se obtienen errores al ejecutar el proceso
			if($bolResultado)
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos = array('resultado' => TRUE,
							 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
							      'mensaje' => 'La notificación se envió correctamente.');
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
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));

		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->proveedores->buscar(NULL, NULL, $strEstatus, $strBusqueda); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1= 'LISTADO DE PROVEEDORES';
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('CÓDIGO'), utf8_decode('RAZÓN SOCIAL'), 'RFC', 'TIPO',
								  utf8_decode('TELÉFONO'), utf8_decode('DÍAS'), utf8_decode('LÍMITE'), 
								  'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(12, 62, 26, 20, 20, 10, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('C', 'L', 'L', 'L', 'C', 'R', 'R', 'C');
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
				$pdf->Row(array($arrCol->codigo, utf8_decode($arrCol->razon_social), $arrCol->rfc,
								$arrCol->tipo_proveedor,$arrCol->telefono_principal, $arrCol->dias_credito, 
								'$'.number_format($arrCol->limite_credito,2),
								$arrCol->estatus), $pdf->arrAlineacion, 'ClippedCell');
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
		$pdf->Output('proveedores.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$strEstatus = trim($this->input->post('strEstatus'));
		$strBusqueda = trim($this->input->post('strBusqueda'));

		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->proveedores->buscar(NULL, NULL, $strEstatus, $strBusqueda); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE PROVEEDORES');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$intPosEncabezados, 'CÓDIGO')
                 ->setCellValue('B'.$intPosEncabezados, 'NOMBRE COMERCIAL')
                 ->setCellValue('C'.$intPosEncabezados, 'RAZÓN SOCIAL')
                 ->setCellValue('D'.$intPosEncabezados, 'RFC')
                 ->setCellValue('E'.$intPosEncabezados, 'RÉGIMEN FISCAL')
                 ->setCellValue('F'.$intPosEncabezados, 'TIPO')
                 ->setCellValue('G'.$intPosEncabezados, 'TELÉFONO PRINCIPAL')
                 ->setCellValue('H'.$intPosEncabezados, 'TELÉFONO SECUNDARIO')
                 ->setCellValue('I'.$intPosEncabezados, 'CORREO ELECTRÓNICO')
                 ->setCellValue('J'.$intPosEncabezados, 'DÍAS DE CRÉDITO')
                 ->setCellValue('K'.$intPosEncabezados, 'LÍMITE DE CRÉDITO')
                 ->setCellValue('L'.$intPosEncabezados, 'CALLE')
                 ->setCellValue('M'.$intPosEncabezados, 'NO. EXTERIOR')
                 ->setCellValue('N'.$intPosEncabezados, 'NO. INTERIOR')
                 ->setCellValue('O'.$intPosEncabezados, 'CÓDIGO POSTAL')
                 ->setCellValue('P'.$intPosEncabezados, 'COLONIA')
                 ->setCellValue('Q'.$intPosEncabezados, 'LOCALIDAD')
                 ->setCellValue('R'.$intPosEncabezados, 'REFERENCIA')
                 ->setCellValue('S'.$intPosEncabezados, 'MUNICIPIO')
                 ->setCellValue('T'.$intPosEncabezados, 'ESTADO')
                 ->setCellValue('U'.$intPosEncabezados, 'PAÍS')
                 ->setCellValue('V'.$intPosEncabezados, 'NOMBRE DE CONTACTO')
                 ->setCellValue('W'.$intPosEncabezados, 'TELÉFONO DE OFICINA')
                 ->setCellValue('X'.$intPosEncabezados, 'EXTENSIÓN')
                 ->setCellValue('Y'.$intPosEncabezados, 'CELULAR')
                 ->setCellValue('Z'.$intPosEncabezados, 'CORREO ELECTRÓNICO')
                 ->setCellValue('AA'.$intPosEncabezados, 'ESTATUS');
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
    			 ->getStyle('A9:AA9')
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
					     ->setCellValue('B'.$intFila, $arrCol->nombre_comercial)
					     ->setCellValue('C'.$intFila, $arrCol->razon_social)
					     ->setCellValueExplicit('D'.$intFila, $arrCol->rfc, PHPExcel_Cell_DataType::TYPE_STRING)
					     ->setCellValueExplicit('E'.$intFila, $arrCol->regimen_fiscal, PHPExcel_Cell_DataType::TYPE_STRING)
					     ->setCellValue('F'.$intFila, $arrCol->tipo_proveedor)
					     ->setCellValue('G'.$intFila, $arrCol->telefono_principal)
					     ->setCellValue('H'.$intFila, $arrCol->telefono_secundario)
					     ->setCellValue('I'.$intFila, $arrCol->correo_electronico)
					     ->setCellValue('J'.$intFila, $arrCol->dias_credito)
					     ->setCellValue('K'.$intFila, $arrCol->limite_credito)
					     ->setCellValue('L'.$intFila, $arrCol->calle)
					     ->setCellValue('M'.$intFila, $arrCol->numero_exterior)
					     ->setCellValue('N'.$intFila, $arrCol->numero_interior)
					     ->setCellValue('O'.$intFila, $arrCol->codigo_postal)
					     ->setCellValue('P'.$intFila, $arrCol->colonia)
					     ->setCellValue('Q'.$intFila, $arrCol->localidad)
					     ->setCellValue('R'.$intFila, $arrCol->referencia)
					     ->setCellValue('S'.$intFila, $arrCol->municipio)
					     ->setCellValue('T'.$intFila, $arrCol->estado)
					     ->setCellValue('U'.$intFila, $arrCol->pais)
					     ->setCellValue('V'.$intFila, $arrCol->contacto_nombre)
					     ->setCellValue('W'.$intFila, $arrCol->contacto_telefono)
					     ->setCellValue('X'.$intFila, $arrCol->contacto_extension)
					     ->setCellValue('Y'.$intFila, $arrCol->contacto_celular)
					     ->setCellValue('Z'.$intFila, $arrCol->contacto_correo_electronico)
					     ->setCellValue('AA'.$intFila, $arrCol->estatus);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('K'.$intFilaInicial.':'.'K'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('J'.$intFilaInicial.':'.'K'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

			$objExcel->getActiveSheet()
                	 ->getStyle('AA'.$intFilaInicial.':'.'AA'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('AA'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('AA'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'proveedores.xls', 'proveedores', $intFila);
	}
}