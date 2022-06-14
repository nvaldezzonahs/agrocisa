<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('refacciones/refacciones_model', 'refacciones');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('refacciones/refacciones', $arrDatos);
	}
	
	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*******************************************************************************************************************
	Funciones de la tabla refacciones
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->refacciones->filtro(trim($this->input->post('strBusqueda')),
			 								 NULL,
			                                 $config['per_page'],
			                                 $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['refacciones'] as $arrDet)
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
		$arrDatos = array('rows' => $result['refacciones'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows']);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para guardar o modificar los datos de un registro
	public function guardar()
	{ 

		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objRefaccion = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Datos de la refacción
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objRefaccion->intRefaccionID = $this->input->post('intRefaccionID');
		$objRefaccion->strCodigo01 = mb_strtoupper(trim($this->input->post('strCodigo01')));
		$objRefaccion->strCodigo01Anterior = mb_strtoupper(trim($this->input->post('strCodigo01Anterior')));
		$objRefaccion->strCodigo02 = mb_strtoupper(trim($this->input->post('strCodigo02')));
		$objRefaccion->strCodigo02Anterior = mb_strtoupper(trim($this->input->post('strCodigo02Anterior')));
		$objRefaccion->strCodigo03 = mb_strtoupper(trim($this->input->post('strCodigo03')));
		$objRefaccion->strCodigo03Anterior = mb_strtoupper(trim($this->input->post('strCodigo03Anterior')));
		$objRefaccion->strCodigo04 = mb_strtoupper(trim($this->input->post('strCodigo04')));
		$objRefaccion->strCodigo04Anterior = mb_strtoupper(trim($this->input->post('strCodigo04Anterior')));
		$objRefaccion->strDescripcion = mb_strtoupper(trim($this->input->post('strDescripcion')));
		$objRefaccion->strServicio  = $this->input->post('strServicio');
		$objRefaccion->intProductoServicioID = $this->input->post('intProductoServicioID');
		$objRefaccion->intUnidadID = $this->input->post('intUnidadID');
		//Si no existe id del objeto impuesto asignar valor nulo
		$objRefaccion->intObjetoImpuestoID = (($this->input->post('intObjetoImpuestoID') !== '') ? 
										       $this->input->post('intObjetoImpuestoID') : NULL);
		$objRefaccion->intRefaccionesLineaID = $this->input->post('intRefaccionesLineaID');
		$objRefaccion->intRefaccionesMarcaID = $this->input->post('intRefaccionesMarcaID');
		//Si no existe id del MPC (Marketing Product Code) asignar valor nulo
		$objRefaccion->intMpcID = (($this->input->post('intMpcID') !== '') ? 
						   			$this->input->post('intMpcID') : NULL);
		$objRefaccion->intCostoPlanta = $this->input->post('intCostoPlanta');
		$objRefaccion->intMonedaID = $this->input->post('intMonedaID');
		$objRefaccion->intTasaCuotaIva = $this->input->post('intTasaCuotaIva');
		//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
		$objRefaccion->intTasaCuotaIeps = (($this->input->post('intTasaCuotaIeps') !== '') ? 
						   	 			    $this->input->post('intTasaCuotaIeps') : NULL);

		//Si no existe id de la refacción que reemplaza asignar valor nulo
		$objRefaccion->intRemplazaID = (($this->input->post('intRemplazaID') !== '') ? 
						   				 $this->input->post('intRemplazaID') : NULL);
		$objRefaccion->intSucursalID = $this->session->userdata('sucursal_id');
		$objRefaccion->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos del inventario
		$objRefaccion->strLocalizacion = mb_strtoupper(trim($this->input->post('strLocalizacion')));
		//Datos de los detalles
		$objRefaccion->strRefaccionesListaPrecioID = $this->input->post('strRefaccionesListaPrecioID');
		$objRefaccion->strPrecios = $this->input->post('strPrecios');
		
        //Definir las reglas de validación
		//Validar que el código sea único
        if (($objRefaccion->intRefaccionID == '') OR 
        	($objRefaccion->strCodigo01Anterior != $objRefaccion->strCodigo01))
        {
            $this->form_validation->set_rules('strCodigo01', 'código 01', 
        									  'required|callback_get_existencia');
        }
        else
        {
        	$this->form_validation->set_rules('strCodigo01', 'código 01', 'trim|required');
        }


        //Validar que el código sea único
        if (($objRefaccion->intRefaccionID == '' && $objRefaccion->strCodigo02 != '') OR 
        	($objRefaccion->strCodigo02Anterior != $objRefaccion->strCodigo02 && $objRefaccion->strCodigo02 != ''))
        {
            $this->form_validation->set_rules('strCodigo02', 'código 02', 
        									  'required|callback_get_existencia');
        }

        //Validar que el código sea único
        if (($objRefaccion->intRefaccionID == '' && $objRefaccion->strCodigo03 != '') OR 
        	($objRefaccion->strCodigo03Anterior != $objRefaccion->strCodigo03 && $objRefaccion->strCodigo03 != ''))
        {
            $this->form_validation->set_rules('strCodigo03', 'código 03', 
        									  'required|callback_get_existencia');
        }

        //Validar que el código sea único
        if (($objRefaccion->intRefaccionID == '' && $objRefaccion->strCodigo04 != '') OR 
        	($objRefaccion->strCodigo04Anterior != $objRefaccion->strCodigo04 && $objRefaccion->strCodigo04 != ''))
        {
            $this->form_validation->set_rules('strCodigo04', 'código 04', 
        									  'required|callback_get_existencia');
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
			if (is_numeric($objRefaccion->intRefaccionID))
			{
				$bolResultado = $this->refacciones->modificar($objRefaccion);
			}
			else
			{ 
				$bolResultado = $this->refacciones->guardar($objRefaccion);
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

	//Verifica la existencia del código para evitar duplicación de datos al momento de modificar o guardar un registro.
    public function get_existencia($strCodigo) 
    {	
		//Hacer un llamado al método para comprobar la existencia del código
		$otdResultado = $this->refacciones->buscar(NULL, NULL, NULL, NULL, $strCodigo);
		//Si existen datos
		if($otdResultado)
		{
		    //Enviar mensaje de error
		    $this->form_validation->set_message('get_existencia', 'El  %s ya ha sido registrado, favor de verificar.');
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
		$intProveedorID = $this->input->post('intProveedorID');
		$intRefaccionesListaPrecioID = $this->input->post('intRefaccionesListaPrecioID');
		$dteFechaTipoCambio = $this->input->post('dteFechaTipoCambio');
		$strTipoReferencia = $this->input->post('strTipoReferencia');
		$intReferenciaID = $this->input->post('intReferenciaID');
	    $strListaPrecioCte = $this->input->post('strListaPrecioCte');
		
		//Dependiendo del tipo realizar la búsqueda de datos
		//Seleccionar los datos del registro que coincide con el parámetro enviado
		if($strTipo == 'id')
		{
			$otdResultado = $this->refacciones->buscar($strBusqueda, $intProveedorID, 
													  $intRefaccionesListaPrecioID, 
													  $dteFechaTipoCambio, 
													  NULL, NULL, NULL, NULL, NULL, $strListaPrecioCte);
		}
		else if($strTipo == 'referencias')
		{
			$otdResultado = $this->refacciones->buscar(NULL,  NULL, $intRefaccionesListaPrecioID, 
													   $dteFechaTipoCambio, NULL,  
													   NULL, NULL, $strTipoReferencia, $intReferenciaID, 
													   $strListaPrecioCte);
		}
		else 
		{
    		$otdResultado = $this->refacciones->buscar(NULL, NULL, NULL, NULL, $strBusqueda);
		}
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para obtener el precio de una refacción con base a un ID y un precio de lista proporcionado
	public function get_precio(){
		
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		
		//Variables que se utilizan para recuperar los valores de la vista 
		$intRefaccionID = $this->input->post('intRefaccionID');
		$intListaPrecioID = $this->input->post('intListaPrecioID');

		//Seleccionar los datos del registro que coincide con el parámetro enviado
    	$otdResultado = $this->refacciones->buscar_precio($intRefaccionID, $intListaPrecioID);
		
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
		$this->form_validation->set_rules('intRefaccionID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intRefaccionID');
		    $strEstatus = $this->input->post('strEstatus');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->refacciones->set_estatus($intID, $strEstatus);
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
		$strTipo = $this->input->post('strTipo');
		$strTipoMovimiento =  $this->input->post('strTipoMovimiento');

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->refacciones->autocomplete($strDescripcion, $strTipo, $strTipoMovimiento);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value'=>$arrCol->refaccion, 
		        						'data'=>$arrCol->refaccion_id, 
		        						'codigo' => $arrCol->codigo);
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
		$otdResultado = $this->refacciones->buscar(NULL, NULL, NULL,  NULL, NULL, $strBusqueda); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'LISTADO DE REFACCIONES';
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('LÍNEA'), utf8_decode('CÓDIGO 01'), 
								  utf8_decode('DESCRIPCIÓN'), 'SERVICIO', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(50, 40, 65, 15, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L','L', 'L', 'C', 'C');
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
				$otdDetalles = $this->refacciones->buscar_precios($arrCol->refaccion_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{

					//Variable que se utiliza para agregar salto de línea en caso de que existen más códigos
					$strAgregarSaltoLinea = 'NO';

					//Establece el ancho de las columnas
					$pdf->SetWidths($pdf->arrAnchura);
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(utf8_decode($arrCol->refacciones_linea), 
									utf8_decode($arrCol->codigo_01), 
									utf8_decode($arrCol->descripcion),$arrCol->servicio, $arrCol->estatus), 
									$pdf->arrAlineacion, 'ClippedCell');

					//Asigna el tipo y tamaño de letra
			        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
			      	//Si existe código 02
			        if($arrCol->codigo_02 != '')
			        {
			        	//Código 02
						$pdf->Cell(15, 4, utf8_decode('CÓDIGO 02:'), 0, 0, 'L', 0);
				    	$pdf->ClippedCell(40, 4, utf8_decode($arrCol->codigo_02), 0, 0, 'L', 0);
				    	//Asignar SI para agregar saltos de línea
				    	$strAgregarSaltoLinea = 'SI';
			        }
			       	
			       	//Si existe código 03
			        if($arrCol->codigo_03 != '')
			        {
				    	//Código 03
				    	$pdf->Cell(15, 4, utf8_decode('CÓDIGO 03:'), 0, 0, 'L', 0);
					    $pdf->ClippedCell(40, 4,utf8_decode($arrCol->codigo_03), 0, 0, 'L', 0);
					    //Asignar SI para agregar saltos de línea
					    $strAgregarSaltoLinea = 'SI';
					}

					//Si existe código 04
			        if($arrCol->codigo_04 != '')
			        {
					    //Código 04
				    	$pdf->Cell(15, 4, utf8_decode('CÓDIGO 04:'), 0, 0, 'L', 0);
					    $pdf->ClippedCell(40, 4,utf8_decode($arrCol->codigo_04), 0, 0, 'L', 0);
					    //Asignar SI para agregar saltos de línea
					    $strAgregarSaltoLinea = 'SI';
					}

					//Si la refacción tiene varios códigos
					if($strAgregarSaltoLinea == 'SI')
					{
						$pdf->Ln(3);//Deja un salto de línea
					}
					

					//Producto o servicio
					$pdf->Cell(15, 4, utf8_decode('CÓDIGO SAT:'), 0, 0, 'L', 0);
				    $pdf->ClippedCell(45, 4, utf8_decode($arrCol->producto_servicio), 0, 0, 'L', 0);
			    	//Unidad
			    	$pdf->Cell(15, 4, 'UNIDAD SAT:', 0, 0, 'L', 0);
				    $pdf->ClippedCell(34, 4,utf8_decode($arrCol->unidad), 0, 0, 'L', 0);

				    //Si existe id del objeto de impuesto
				    if($arrCol->objeto_impuesto_id > 0)
				    {
				    	 //Objeto de impuesto 
				    	$pdf->Cell(30, 4, 'OBJETO DE IMPUESTO SAT:', 0, 0, 'L', 0);
					    $pdf->ClippedCell(52, 4,utf8_decode($arrCol->objeto_impuesto), 0, 0, 'L', 0);

				    }
				   


					$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->Ln(5);//Deja un salto de línea
					//Establece el ancho de las columnas
				    $pdf->SetWidths($arrAnchuraDetalles);
				    //Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array(utf8_decode($arrDet->descripcion), 
					    			    '$'.number_format($arrDet->precio,2)), 
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
		$pdf->Output('refacciones.pdf','I'); 
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
        //Variable que se utiliza para asignar el número de columna donde se empezaran a escribir los precios
	    $intIndColPrecios = 29;
	    $intIndColE = $intIndColPrecios;//Empezar en la columna 29-AC(Encabezados de los precios)
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->refacciones->buscar(NULL, NULL, NULL, NULL, NULL, $strBusqueda);
		//Seleccionar las listas de precios activas
	    $otdListasPrecio = $this->refacciones->buscar_precios(0);
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE REFACCIONES');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'CÓDIGO 01')
                 ->setCellValue('B'.$intPosEncabezados, 'CÓDIGO 02')
                 ->setCellValue('C'.$intPosEncabezados, 'CÓDIGO 03')
                 ->setCellValue('D'.$intPosEncabezados, 'CÓDIGO 04')
                 ->setCellValue('E'.$intPosEncabezados, 'DESCRIPCIÓN')
                 ->setCellValue('F'.$intPosEncabezados, 'SERVICIO')
                 ->setCellValue('G'.$intPosEncabezados, 'CÓDIGO SAT')
                 ->setCellValue('H'.$intPosEncabezados, 'UNIDAD SAT')
                 ->setCellValue('I'.$intPosEncabezados, 'OBJETO DE IMPUESTO SAT')
                 ->setCellValue('J'.$intPosEncabezados, 'MPC')
                 ->setCellValue('K'.$intPosEncabezados, 'MPL')
                 ->setCellValue('L'.$intPosEncabezados, 'MCD')
                 ->setCellValue('M'.$intPosEncabezados, 'LÍNEA')
                 ->setCellValue('N'.$intPosEncabezados, 'MARCA')
                 ->setCellValue('O'.$intPosEncabezados, 'MONEDA')
                 ->setCellValue('P'.$intPosEncabezados, 'IVA %')
                 ->setCellValue('Q'.$intPosEncabezados, 'IEPS %')
                 ->setCellValue('R'.$intPosEncabezados, 'COSTO PLANTA')
                 ->setCellValue('S'.$intPosEncabezados, 'COSTO')
                 ->setCellValue('T'.$intPosEncabezados, 'EXISTENCIA')
                 ->setCellValue('U'.$intPosEncabezados, 'DISPONIBLE')
                 ->setCellValue('V'.$intPosEncabezados, 'LOCALIZACIÓN')
                 ->setCellValue('W'.$intPosEncabezados, 'CLASIFICACIÓN PLANTA')
                 ->setCellValue('X'.$intPosEncabezados, 'CLASIFICACIÓN')
                 ->setCellValue('Y'.$intPosEncabezados, 'REORDEN')
                 ->setCellValue('Z'.$intPosEncabezados, 'MÍNIMO')
                 ->setCellValue('AA'.$intPosEncabezados, 'MÁXIMO')
                 ->setCellValue('AB'.$intPosEncabezados, 'REEMPLAZA')
                 ->setCellValue('AC'.$intPosEncabezados, 'REEMPLAZÓ')
                 ->setCellValue('AD'.$intPosEncabezados, 'ESTATUS');

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
				//Seleccionar los precios del registro
				$otdPrecios = $this->refacciones->buscar_precios($arrCol->refaccion_id);
				//Indice de la columna donde empezara a escribir la información de los detalles 
		        $intIndColDet = $intIndColPrecios;

				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
						 ->setCellValueExplicit('A'.$intFila, $arrCol->codigo_01, PHPExcel_Cell_DataType::TYPE_STRING)
						 ->setCellValueExplicit('B'.$intFila, $arrCol->codigo_02, PHPExcel_Cell_DataType::TYPE_STRING)
						 ->setCellValueExplicit('C'.$intFila, $arrCol->codigo_03, PHPExcel_Cell_DataType::TYPE_STRING)
						 ->setCellValueExplicit('D'.$intFila, $arrCol->codigo_04, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('E'.$intFila, $arrCol->descripcion)
                         ->setCellValue('F'.$intFila, $arrCol->servicio)
                         ->setCellValueExplicit('G'.$intFila, $arrCol->producto_servicio, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValueExplicit('H'.$intFila, $arrCol->unidad, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValueExplicit('I'.$intFila, $arrCol->objeto_impuesto, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValueExplicit('J'.$intFila, $arrCol->marketing_product_code, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValueExplicit('K'.$intFila, $arrCol->marketing_product_line, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValueExplicit('L'.$intFila, $arrCol->marketing_code_description, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('M'.$intFila, $arrCol->refacciones_linea)
                         ->setCellValue('N'.$intFila, $arrCol->refacciones_marca)
                         ->setCellValue('O'.$intFila, $arrCol->moneda)
                         ->setCellValue('P'.$intFila, $arrCol->porcentaje_iva)
                         ->setCellValue('Q'.$intFila, $arrCol->porcentaje_ieps)
                         ->setCellValue('R'.$intFila, $arrCol->costo_planta)
                         ->setCellValue('S'.$intFila, $arrCol->actual_costo)
                         ->setCellValue('T'.$intFila, $arrCol->actual_existencia)
                         ->setCellValue('U'.$intFila, $arrCol->disponible_existencia)
                         ->setCellValue('V'.$intFila, $arrCol->localizacion)
                         ->setCellValue('W'.$intFila, $arrCol->clasificacion_planta)
                         ->setCellValue('X'.$intFila, $arrCol->clasificacion)
                         ->setCellValue('Y'.$intFila, $arrCol->reorden)
                         ->setCellValue('Z'.$intFila, $arrCol->minimo)
                         ->setCellValue('AA'.$intFila, $arrCol->maximo)
                         ->setCellValueExplicit('AB'.$intFila, $arrCol->remplaza, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValueExplicit('AC'.$intFila, $arrCol->remplazo, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('AD'.$intFila, $arrCol->estatus);

                    //Verificar si existe información de los precios 
                    if ($otdPrecios) 
			        { 
			        	//Recorremos el arreglo 
		                foreach ($otdPrecios as $arrP) 
		                { 
		                    //Agregar información del registro
		                    $objExcel->setActiveSheetIndex(0)
			                         ->setCellValue($this->ARR_COLUMNAS[$intIndColDet].$intFila, $arrP->precio);
			  
				            //Incrementar indice de la columna
				            $intIndColDet++;
		                }

		            }//Cierre de verificación de precios

                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar contenido de las celdas a formato porcentaje
            $objExcel->getActiveSheet()
            		 ->getStyle('P'.$intFilaInicial.':'.'Q'.$intFila)
            		 ->getNumberFormat()
            		 ->applyFromArray($arrStylePorcentaje);

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle($this->ARR_COLUMNAS[$intIndColPrecios].$intFilaInicial.':'.
            		 			$this->ARR_COLUMNAS[$intIndColE].$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

           	$objExcel->getActiveSheet()
            		 ->getStyle('R'.$intFilaInicial.':'.'S'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');


            //Cambiar contenido de las celdas a formato númerico
            $objExcel->getActiveSheet()
            		 ->getStyle('T'.$intFilaInicial.':'.'U'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

            $objExcel->getActiveSheet()
            		 ->getStyle('Y'.$intFilaInicial.':'.'AA'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('P'.$intFilaInicial.':'.'U'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

             $objExcel->getActiveSheet()
                	 ->getStyle('Y'.$intFilaInicial.':'.'AA'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);
                	 		 
			$objExcel->getActiveSheet()
                	 ->getStyle('AD'.$intFilaInicial.':'.'AD'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
            		 ->getStyle($this->ARR_COLUMNAS[$intIndColPrecios].$intFilaInicial.':'.
            		 			$this->ARR_COLUMNAS[$intIndColE].$intFila)
            		 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('AD'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('AD'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'refacciones.xls', 'refacciones', $intFila);
	}

	/*******************************************************************************************************************
	Funciones de la tabla refacciones_precios
	*********************************************************************************************************************/
	public function get_datos_precios()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('precios' => NULL);
	    //Si no existe id de la refacción asignar valor cero
		$intID = (($this->input->post('intRefaccionID') !== '') ? 
							   $this->input->post('intRefaccionID') : 0);

		//Seleccionar los precios del registro que coincide con el id
	    $otdResultado = $this->refacciones->buscar_precios($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['precios'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}
}