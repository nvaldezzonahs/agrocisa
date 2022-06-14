<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salidas_maquinaria_demostracion extends MY_Controller {
	
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos los modelos
		$this->load->model('maquinaria/salidas_maquinaria_demostracion_model', 'movimientos');
		$this->load->model('cuentas_cobrar/clientes_model', 'clientes');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('maquinaria/salidas_maquinaria_demostracion', $arrDatos);
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

		//Variables que afectan el filtro de información
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intClienteID = $this->input->post('intClienteID');
		$strEstatus = $this->input->post('strEstatus');
		$strBusqueda = trim($this->input->post('strBusqueda'));
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->movimientos->filtro($dteFechaInicial,
											 $dteFechaFinal,
											 $intClienteID,
											 $strEstatus,
											 $strBusqueda,
				                             $config['per_page'],
				                             $config['cur_page']);	
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['movimientos'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionReingresar = 'no-mostrar';
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
					//Asignar cadena vacia para mostrar botón Ver registro
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

			//Si el registro no cuenta con un reingreso de maquinaria
			if($arrDet->fecha_reingreso == null){
				//Asignar cadena vacia para mostrar botón Reingresar
        		$arrDet->mostrarAccionReingresar = '';
			}

		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['movimientos'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows']);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para guardar o modificar los datos de un registro
	public function guardar()
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$objSalidaDemostracion = json_decode($this->input->post('salidaDemostracion'));		
		$intMovimientoMaquinariaID = $objSalidaDemostracion->intMovimientoMaquinariaID;
		$strFolioConsecutivo = $this->input->post('strFolioConsecutivo');
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));

		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($intMovimientoMaquinariaID))
		{
			$bolResultado = $this->movimientos->modificar($intMovimientoMaquinariaID, $objSalidaDemostracion);
		}
		else
		{
			//Hacer un llamado a la función para generar el folio consecutivo del proceso
			$strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
			//Si no existe folio del proceso
			if($strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{	
				$bolResultado = $this->movimientos->guardar($strFolio, $objSalidaDemostracion); 

				/*Quitar '_'  de la cadena (resultadoTransaccion_entradaCompraID_folioConsecutivo) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			    list($bolResultado, $intMovimientoMaquinariaID, $strFolioConsecutivo) = explode("_", $bolResultado); 
			}

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
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para regresar los datos de un registro
	public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intID = $this->input->post('intMovimientoMaquinariaID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->movimientos->buscar($intID);
	    
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
			//Seleccionar los detalles del registro
			$otdDetalles = $this->movimientos->buscar_detalles($intID);
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
		$this->form_validation->set_rules('intMovimientoMaquinariaID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intMovimientoMaquinariaID');
		    $strEstatus = $this->input->post('strEstatus');
		    //Dependiendo del estatus cambiar su valor
	        //ACTIVO a INACTIVO o viceversa
			if ($strEstatus == "ACTIVO")
			{
				$strEstatus = "INACTIVO";
			}
			else
			{
				$strEstatus = "ACTIVO";
			}

	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->movimientos->set_estatus($intID, $strEstatus);
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

	//Método para reingresar una maquinaria
	public function reingresar()
	{
		//Definir las reglas de validación
		$this->form_validation->set_rules('intMovimientoMaquinariaID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intMovimientoMaquinariaID');
	        //Obtener detalles del movimiento para obtener SERIE y MOTOR
	        $otdDetalles = $this->movimientos->buscar_detalles($intID);

	        if($otdDetalles)
			{
				$bolResultado = $this->movimientos->reingresar($intID, $otdDetalles);
				//Si no se obtienen errores al ejecutar el proceso
				if($bolResultado)
				{
					//Enviar el mensaje de éxito al formulario
					$arrDatos = array('resultado' => TRUE,
								 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
								      'mensaje' => 'El reingreso se efectuó correctamente.');
				}
				else
				{
					//Enviar el mensaje de error al formulario
					$arrDatos = array('resultado' => FALSE,
								      'tipo_mensaje' => TIPO_MSJ_ERROR,
						              'mensaje' => 'Ocurrió un error al reingresar, vuelva a intentarlo.');
				}	
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
			$otdResultado = $this->movimientos->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->folio, 
		        						'movimiento_maquinaria_id' => $arrCol->movimiento_maquinaria_id);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}


	//Método para regresar todos los registros activos en un serie_autocomplete
	public function serie_autocomplete()
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
			$otdResultado = $this->movimientos->serie_autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{

		        	$arrDatos[] = array('value'=>$arrCol->serie,
		        							'maquinaria_descripcion_id' => $arrCol->maquinaria_descripcion_id, 
		        							'serie'=>$arrCol->serie,
		        							'motor'=>$arrCol->motor,
		        							'codigo'=>$arrCol->codigo,
		        							'descripcion_corta'=>$arrCol->descripcion_corta,
		        							'descripcion'=>$arrCol->descripcion);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}

	//Método para regresar todos los registros activos en un motor_autocomplete
	public function motor_autocomplete()
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
			$otdResultado = $this->movimientos->motor_autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{

		        	$arrDatos[] = array('value'=>$arrCol->motor,
	        							'maquinaria_descripcion_id' => $arrCol->maquinaria_descripcion_id, 
	        							'serie'=>$arrCol->serie,
	        							'motor'=>$arrCol->motor,
	        							'codigo'=>$arrCol->codigo,
	        							'descripcion_corta'=>$arrCol->descripcion_corta,
	        							'descripcion'=>$arrCol->descripcion);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}

	//Función para consultar si una SERIE contine aditamentos agregados
	public function get_aditamentos(){
		//Si existe serie
		if(isset($_POST['strSerie']))
		{
			$arrResultado = array();
			$strSerie = strtoupper(trim($_POST['strSerie']));
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->movimientos->get_aditamentos($strSerie);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				foreach ($otdResultado as $arrCol)
				{
					$arrResultado[] = array('renglon'=>$arrCol->renglon,
		        						'serie' => $arrCol->serie, 
		        						'cantidad'=>$arrCol->cantidad,
		        						'descripcion'=>$arrCol->descripcion
		        						);
				}
				
	    	}
			$this->output->set_content_type('application/json')->set_output(json_encode($arrResultado));
		}
	}
	
	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $intClienteDestinoID, $strEstatus, 
								$strDetalles, $strBusqueda = NULL) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strEstatus = trim(urldecode($strEstatus));
		//Array que se utiliza para asignar los estatus 
		$arrEstatus = array('ACTIVO','INACTIVO'); 
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;

		$result = $this->movimientos->filtro($dteFechaInicial, $dteFechaFinal, $intClienteDestinoID,$strEstatus, $strBusqueda, NULL, NULL);
		
		$otdResultado = $result['movimientos'];

		//Si existe rango de fechas
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal  != '0000-00-00')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C'). ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		}
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  utf8_decode('LISTADO DE MOVIMIENTOS DE SALIDA A DEMOSTRACIÓN ').$strTituloRangoFechas;
		
		//Si existe id de la sucursal destino
		if($intClienteDestinoID > 0)
		{
			//Seleccionar los datos del cliente que coincide con el id
			$otdCliente =  $this->clientes->buscar($intClienteDestinoID, NULL, NULL);
			$pdf->strLinea2 = 'CLIENTE: '.utf8_decode($otdCliente->nombre_comercial);
		}		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA', 'CLIENTE', 'CHOFER', utf8_decode('VEHÍCULO'), 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(16, 16, 48, 55, 25, 30);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'L', 'L', 'L', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('L', 'L', 'L', 'L', 'L', 'L');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(20, 65, 20, 20, 20, 20);
		
		//Agregar la primer pagina
		$pdf->AddPage();

		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
			
		//Si hay información
		if ($otdResultado)
		{		
			//Recorremos el arreglo para obtener la información de las ordenes de compra
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				//Array que se utiliza para agregar los detalles
		        $arrDetalles = array();
		        //Array que se utiliza para agregar los datos de un detalle
		        $arrAuxiliar = array();
				//Seleccionar los detalles del registro
				$otdDetalles = $this->movimientos->buscar_detalles($arrCol->movimiento_maquinaria_id);
				
				//Verificar si existe información de los detalles 
				
				if($otdDetalles)
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{

						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["codigo"] = $arrDet->codigo;
						$arrAuxiliar["descripcion_corta"] = utf8_decode($arrDet->descripcion_corta);
		                $arrAuxiliar["serie"] = $arrDet->serie;
		                $arrAuxiliar["motor"] = $arrDet->motor;
		                $arrAuxiliar["numero_pedimento"] = $arrDet->numero_pedimento;
		                $arrAuxiliar["consignacion"] = $arrDet->consignacion;
		                //Asignar datos al array
                        array_push($arrDetalles, $arrAuxiliar); 
					}
					
				}//Cierre de verificación de detalles
				
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, 
								$arrCol->fecha, 
								utf8_decode($arrCol->cliente),
								utf8_decode($arrCol->chofer),
								utf8_decode($arrCol->vehiculo),
								$arrCol->estatus), 								
								$pdf->arrAlineacion, 'ClippedCell');
		        
		        //Asigna el tipo y tamaño de letra para la cabecera de la tabla
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);

		        //Si se cumple la sentencia mostrar detalles del registro
				if($arrDetalles && $strDetalles == 'SI')
				{
					$pdf->Ln(1);//Deja un salto de línea
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraDetalles);
					//Recorremos el arreglo 
			        foreach ($arrDetalles as $arrDet) 
			        {
					   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array(
					    					$arrDet['codigo'], 
					    					$arrDet['descripcion_corta'], 
					    					$arrDet['serie'],
					    					$arrDet['motor'], 
					    					$arrDet['numero_pedimento'], 
					    					$arrDet['consignacion']
										), 
					    				$arrAlineacionDetalles, 
					    				'ClippedCell');
					}
				}//Cierre de verificación de detalles
				$pdf->Ln(3);//Deja un salto de línea
				//Incrementar el contador por cada registro
				$intContador++;
			}
			//Espacios de salto de línea
			$pdf->Ln();
			//Asigna el tipo y tamaño de letra para los totales
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Escribe la cadena concatenada con el total de registros
	    	$pdf->Cell(0,3,'TOTAL: '.$intContador, 0, 0, 'R');
		}

		//Ejecutar la salida del reporte
		$pdf->Output('salidas_maquinaria_traspaso.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro($intMovimientoMaquinariaID) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Seleccionar los datos del registro que coincide con el id
		$otdResultado = $this->movimientos->buscar($intMovimientoMaquinariaID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->movimientos->buscar_detalles($intMovimientoMaquinariaID);
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
		$strNombreArchivo  = 'salidas_maquinaria_demostracion_';
		//Agregar la primer pagina
		$pdf->AddPage();
		//Hacer un llamado a la función para mostrar imagen del logotipo
       	$this->get_logotipo_archivo_pdf($pdf);

		
		//Establecer el color de fondo para la cabecera
		$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
   		//Encabezado
   		//Asigna el tipo y tamaño de letra
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->SetXY(80, 15);
		$pdf->ClippedCell(120, 3, utf8_decode('SALIDAS DE MAQUINARIA A DEMOSTRACIÓN'), 0, 0, 'C', TRUE);
		$pdf->SetTextColor(0); //establece el color de texto
		//Asigna el tipo y tamaño de letra
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);

		//FOLIO
		$pdf->SetXY(80, 19);
		$pdf->ClippedCell(35, 3, 'FOLIO');
		//FECHA
		$pdf->SetXY(140, 19);
		$pdf->ClippedCell(35, 3, 'FECHA');
		//CLIENTE
		$pdf->SetXY(80, 23);
		$pdf->ClippedCell(35, 3, 'CLIENTE');
		//CHOFER
		$pdf->SetXY(80, 27);
		$pdf->ClippedCell(35, 3, 'CHOFER');
		//VEHICULO
		$pdf->SetXY(80, 31);
		$pdf->ClippedCell(35, 3, utf8_decode('VEHÍCULO'));

		//Información de la salida de insumos después evento
		//Verificar si hay información del registro
		if($otdResultado)
		{	 
			//Hacer un llamado a la función para mostrar imagen del estatus (INACTIVO/TIMBRAR)
			$this->get_img_estatus_archivo_pdf($pdf, $otdResultado->estatus);

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL REGISTRO
	        //------------------------------------------------------------------------------------------------------------------------
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//FOLIO
			$pdf->SetXY(111, 19);
			$pdf->ClippedCell(35, 3, $otdResultado->folio);
			//FECHA
			$pdf->SetXY(154, 19);
			$pdf->ClippedCell(30, 3, $otdResultado->fecha);
			//SUCURSAL
			$pdf->SetXY(111, 23);
			$pdf->ClippedCell(60, 3, utf8_decode($otdResultado->cliente));
			//CHOFER
			$pdf->SetXY(111, 27);
			$pdf->ClippedCell(60, 3, utf8_decode($otdResultado->chofer));
			//VEHICULO
			$pdf->SetXY(111, 31);
			$pdf->ClippedCell(60, 3, utf8_decode($otdResultado->vehiculo));

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DE LA SALIDA DE MAQUINARIA POR TRASPASO
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 44);
			$pdf->ClippedCell(185, 3, 'DETALLES DE LA SALIDA', 0, 0, 'C', TRUE);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			
			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				//Tabla con los detalles de la orden de compra
				$pdf->SetXY(15, 48);
				//Crea los titulos de la cabecera
				$arrCabecera = array(utf8_decode('Código'), utf8_decode('Descripción'), utf8_decode('Serie'), utf8_decode('Motor'), utf8_decode('Pedimento'), utf8_decode('Consignación'));
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(15, 100, 15, 15, 15, 25);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'L', 'L', 'L', 'L');
				//Recorre el array de títulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchura[$intCont], 3, $arrCabecera[$intCont], 1, 0, $arrAlineacion[$intCont], TRUE);
				}
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchura);
				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDet)
				{ 
					$pdf->SetX(15);
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(utf8_decode($arrDet->codigo), 
									utf8_decode($arrDet->descripcion_corta),  
								    utf8_decode($arrDet->serie),
								    utf8_decode($arrDet->motor), 
									utf8_decode($arrDet->numero_pedimento),  
								    utf8_decode($arrDet->consignacion)), 
						
									$arrAlineacion, 'ClippedCell'
							  );

				}
				
				
				$pdf->Ln(); //Deja un salto de línea
				//Observaciones
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(15);
				$pdf->ClippedCell(30, 3, 'OBSERVACIONES');
				
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();

				//Observaciones
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(15, $intPosY);
				$pdf->MultiCell(110, 3, utf8_decode($otdResultado->observaciones));
				
	            $pdf->SetXY(15,260);
	            $pdf->SetXY(109, 260);
	            $pdf->Ln(5);//Espacios de salto de línea
	            $pdf->SetX(15);
	            //Asigna el tipo y tamaño de letra
	            $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
	            $pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
	            $pdf->Cell(90, 3, 'RECIBIO', 0, 0, 'C',  TRUE);
	            //Persona que reviso el anticipo
	            $pdf->SetXY(109, 265);
	            $pdf->Cell(90, 3, 'REVISO', 0, 0, 'C',  TRUE);
	          
	          	$pdf->strUsuarioCreacion = $otdResultado->usuario_creacion;
				$pdf->dteFechaCreacion = $otdResultado->fecha_creacion;
				$pdf->strIncluirMembrete = 'SI';

			}//Cierre de verificación de detalles

			//Concatenar folio para identificar orden de compra
			$strNombreArchivo .= $otdResultado->folio;
		}
		
		//Ejecutar la salida del reporte
		$pdf->Output($strNombreArchivo.'.pdf','I'); 

	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $intClienteDestinoID, $strEstatus, $strDetalles, $strBusqueda = NULL) 
	{	
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strBusqueda = trim(urldecode($strBusqueda));
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strEstatus = trim(urldecode($strEstatus));
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para asignar título de Cliente
		$strCliente = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;

        $result = $this->movimientos->filtro($dteFechaInicial, $dteFechaFinal, $intClienteDestinoID, $strEstatus, $strBusqueda, NULL, NULL);
		$otdResultado = $result['movimientos'];

		//Si existe rango de fechas
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal  != '0000-00-00')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C'). ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		}
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE SALIDAS DE MAQUINARIA POR DEMOSTRACIÓN '.$strTituloRangoFechas);
	
		//Si existe id del proveedor
		if($intClienteDestinoID > 0)
		{
			//Seleccionar los datos del cliente que coincide con el id
			$otdCliente =  $this->clientes->buscar($intClienteDestinoID, NULL, NULL);
			$strCliente =  'CLIENTE: '.$otdCliente->nombre_comercial;

			//Se agrega el título del archivo
			$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A8', $strCliente);

		}	     

		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('C'.$intPosEncabezados, 'CLIENTE')
        		 ->setCellValue('D'.$intPosEncabezados, 'CHOFER')
        		 ->setCellValue('E'.$intPosEncabezados, 'VEHÍCULO')
                 ->setCellValue('F'.$intPosEncabezados, 'ESTATUS');

        //Si se cumple la sentencia mostrar columna detalles
        if($strDetalles == 'SI')
        {
        	$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('G'.$intPosEncabezados, 'DETALLES');

        }         

        //Definir estilos de las celdas correspondientes a los encabezados
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

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
	       			 ->setCellValue('G'.$intPosEncabezados, 'CÓDIGO')
                     ->setCellValue('H'.$intPosEncabezados, 'DESCRIPCIÓN')
                     ->setCellValue('I'.$intPosEncabezados, 'LÍNEA')
                     ->setCellValue('J'.$intPosEncabezados, 'MARCA')
                     ->setCellValue('K'.$intPosEncabezados, 'MODELO')
                     ->setCellValue('L'.$intPosEncabezados, 'SERIE')
                     ->setCellValue('M'.$intPosEncabezados, 'MOTOR')
                     ->setCellValue('N'.$intPosEncabezados, 'NÚMERO DE PEDIMENTO')
			         ->setCellValue('O'.$intPosEncabezados, 'CONSIGNACIÓN');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('G'.$intPosEncabezados.':O'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('G'.$intPosEncabezados.':O'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('G'.$intPosEncabezados.':O'.$intPosEncabezados)
	            	 ->getAlignment()
	            	 ->applyFromArray($arrStyleAlignmentCenter);
        }

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Array que se utiliza para agregar los detalles
		        $arrDetalles = array();
		        //Variable que se utiliza para asignar el número de detalles 
		        $intNumDetalles = 1;

		        //Si se cumple la sentencia mostrar detalles del registro
				if($strDetalles == 'SI')
				{
					//Seleccionar los detalles del registro
					$otdDetalles = $this->movimientos->buscar_detalles($arrCol->movimiento_maquinaria_id);
					
					//Verificar si existe información de los detalles 
					if($otdDetalles)
					{
						//Variable que se utiliza para contar el número de detalles
				    	$intContMov = 0;
				    	//Asignar el número de detalles
						$intNumDetalles = count($otdDetalles); 

						//Recorremos el arreglo 
						foreach ($otdDetalles as $arrDet)
						{
							
							//Agregar datos al array
							$arrDetalles[$intContMov]["codigo"] = $arrDet->codigo;
			                $arrDetalles[$intContMov]["descripcion_corta"] = $arrDet->descripcion_corta;
			                $arrDetalles[$intContMov]["maquinaria_linea"] = $arrDet->maquinaria_linea;
			                $arrDetalles[$intContMov]["maquinaria_marca"] = $arrDet->maquinaria_marca;
			                $arrDetalles[$intContMov]["maquinaria_modelo"] = $arrDet->maquinaria_modelo;
			                $arrDetalles[$intContMov]["serie"] = $arrDet->serie;
			                $arrDetalles[$intContMov]["motor"] = $arrDet->motor;
			                $arrDetalles[$intContMov]["numero_pedimento"] = $arrDet->numero_pedimento;
			                $arrDetalles[$intContMov]["consignacion"] = $arrDet->consignacion;

			                //Incrementar el contador por cada registro
	                        $intContMov++;	
						}

					}//Cierre de verificación de detalles
				}

				
				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    {
			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
						 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValue('B'.$intFila, $arrCol->fecha)
		                         ->setCellValueExplicit('C'.$intFila, $arrCol->cliente, PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValueExplicit('D'.$intFila, $arrCol->chofer, PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValueExplicit('E'.$intFila, $arrCol->vehiculo, PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValue('F'.$intFila, $arrCol->estatus);

		            //Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
								 ->setCellValueExplicit('G'.$intFila, $arrDetalles[$intContDet]['codigo'], PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValue('H'.$intFila, $arrDetalles[$intContDet]['descripcion_corta'])
		                         ->setCellValue('I'.$intFila, $arrDetalles[$intContDet]['maquinaria_linea'])
		                         ->setCellValue('J'.$intFila, $arrDetalles[$intContDet]['maquinaria_marca'])
		                         ->setCellValue('K'.$intFila, $arrDetalles[$intContDet]['maquinaria_modelo'])
		                         ->setCellValue('L'.$intFila, $arrDetalles[$intContDet]['serie'])
		                         ->setCellValue('M'.$intFila, $arrDetalles[$intContDet]['motor'])
		                         ->setCellValue('N'.$intFila, $arrDetalles[$intContDet]['numero_pedimento'])
						         ->setCellValue('O'.$intFila, $arrDetalles[$intContDet]['consignacion']);
					}

					//Incrementar el indice para escribir los datos del siguiente registro
	                $intFila++; 
			    }

                //Incrementar el contador por cada registro
				$intContador++;
			}
	 
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('F'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('F'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
			
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'salidas_maquinaria_demostracion.xls', 'salidas maquinaria demostracion', $intFila);
	}

}	