<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Localidades extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('crm/localidades_model', 'localidades');
		//Cargamos el modelo de zonas
		$this->load->model('crm/zonas_model', 'zonas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('crm/localidades', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->localidades->filtro(trim($this->input->post('strBusqueda')),
			                                 $config['per_page'],
			                                 $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['localidades'] as $arrDet)
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
		$arrDatos = array('rows' => $result['localidades'],
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
		$objLocalidad = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objLocalidad->intLocalidadID = $this->input->post('intLocalidadID');
		$objLocalidad->intMunicipioID = $this->input->post('intMunicipioID');
		$objLocalidad->intMunicipioIDAnterior = $this->input->post('intMunicipioIDAnterior');
		$objLocalidad->strDescripcion = trim($this->input->post('strDescripcion'));
		$objLocalidad->strDescripcionAnterior = trim($this->input->post('strDescripcionAnterior'));
		$objLocalidad->intUsuarioID = $this->session->userdata('usuario_id');
		
        //Definir las reglas de validación
		//Validar que la descripción sea única en el municipio
        if (($objLocalidad->intLocalidadID == '') OR 
        	($objLocalidad->strDescripcionAnterior != $objLocalidad->strDescripcion) OR
        	($objLocalidad->intMunicipioIDAnterior != $objLocalidad->intMunicipioID))
        {
           	$this->form_validation->set_rules('strDescripcion', 'localidad', 
        									  'required|callback_get_existencia['.$objLocalidad->intMunicipioID.']');
        }
        else
        {
        	$this->form_validation->set_rules('strDescripcion', 'localidad', 'required');
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
			if (is_numeric($objLocalidad->intLocalidadID))
			{
				$bolResultado = $this->localidades->modificar($objLocalidad);
			}
			else
			{ 
				$bolResultado = $this->localidades->guardar($objLocalidad);
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

	//Verifica la existencia de la descripción en el municipio
	//para evitar duplicación de datos al momento de modificar o guardar un registro.
    public function get_existencia($strDescripcion, $intMunicipioID) 
    {	
    	//Concatenar datos para realizar la búsqueda
    	$strCriteriosBusq = $intMunicipioID.'|'.$strDescripcion;
    	
		//Hacer un llamado al método para comprobar la existencia de la descripción en el municipio
		$otdResultado = $this->localidades->buscar(NULL, $strCriteriosBusq);
		//Si existen datos
		if($otdResultado)
		{
		    //Enviar mensaje de error
		    $this->form_validation->set_message('get_existencia', 'La  %s ya ha sido registrada en el municipio, favor de verificar.');
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
			$otdResultado = $this->localidades->buscar($strBusqueda);
		}
		else 
		{
			//Se recupera cadena concatenada con los criterios de búsqueda: municipio_id|descripcion
    		$otdResultado = $this->localidades->buscar(NULL, $strBusqueda);
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
		$this->form_validation->set_rules('intLocalidadID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intLocalidadID');
		    $strEstatus = $this->input->post('strEstatus');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->localidades->set_estatus($intID, $strEstatus);
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
		$intMunicipioID = $this->input->post('intMunicipioID');

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->localidades->autocomplete($strDescripcion, $intMunicipioID);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->localidad, 
		        						'data' => $arrCol->localidad_id);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}


	//Método para regresar el treeview con las localidades
	/*****
	 * Parámetros
	 * strTipo - Indica si se buscan las localidades para una Zona
	 * intID - Es el ID del tipo seleccionado
	 * intModuloID - - Es el ID del módulo de la zona seleccionada
	*****/
	public function get_treeview($strTipo = NULL, $intID = 0, $intModuloID = NULL)
	{
		//Array que se utiliza para guardar las localidades
		$arrLocalidadesIDS = array();
		//Array que se utiliza para verifar las localidades ocupadas de un módulo
		$arrLocalidadesOcupadasIDS = array();
		//Array que se utiliza para enviar el resultado a la vista
		$arrDatos = array();
		//Si se envía el id buscamos los permisos correspondientes
		if ($intID > 0)
		{   
		   //Seleccionar los datos del registro que coincide con el parámetro enviado
			if ($strTipo == 'Zona')
			{
				$otdLocalidades = $this->zonas->get_localidades($intID);
				//Seleccionar las localidades ocupadas del módulo
				$otdLocalidadesOcupadas = $this->zonas->get_localidades($intID, 'Ocupadas', $intModuloID);

			}
			//Si se obtienen resultados de localidades, los asignamos al array
			if ($otdLocalidades)
			{
			   //Recorremos el arreglo 
			   foreach ($otdLocalidades as $arrLoc)
			   {
			   		//Agregar datos al array de localidades id´s
			   		$arrLocalidadesIDS[] = $arrLoc->localidad_id;
			   } 
			}

			//Si se obtienen resultados de localidades ocupadas, los asignamos al array
			if ($otdLocalidadesOcupadas)
			{
			   //Recorremos el arreglo 
			   foreach ($otdLocalidadesOcupadas as $arrLoc)
			   {
			   		//Agregar datos al array de localidades id´s
			   		$arrLocalidadesOcupadasIDS[] = $arrLoc->localidad_id;
			   } 
			}
		}
		//Llamar a la función para cargar las localidades
		$arrDatos = $this->cargar_treeview(0, $arrLocalidadesIDS, $arrLocalidadesOcupadasIDS);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Función para cargar el treeview con las localidades, municipios y países
	public function cargar_treeview($intProcesoID, $arrLocalidadesIDS,  $arrLocalidadesOcupadasIDS)
	{
		//Arreglo que regresa los valores asignados
		$arrDatos = array();
		//Variables que se utilizan para asignar el país anterior del recorrido de datos, de esta manera, se verificará si paso a otro país
		$intPaisIDAnterior = 0;
		$strPaisAnterior = '';
		//Variables que se utilizan para asignar el estado anterior del recorrido de datos, de esta manera se verificará si paso a otro estado
   		$intEstadoIDAnterior = 0;
   		$strEstadoAnterior = '';
   		//Variables que se utilizan para asignar el municipio anterior del recorrido de datos, de esta manera se verificará si paso a otro municipio
   		$intMunicipioIDAnterior = 0;
   		$strMunicipioAnterior = '';
   		//Array que se utiliza para asignar los datos de los estados de un país
   		$arrEstados = array();
   		//Array que se utiliza para asignar los datos de los municipios de un estado
   		$arrMunicipios = array();
   		//Array que se utiliza para asignar los datos de las localidades de un municipio
   		$arrLocalidades = array();
		//Consulta de las localidades activas
		$otdLocalidades = $this->localidades->buscar(NULL, NULL, 'ACTIVO');
		//Recorrer las localidades
		foreach ($otdLocalidades as $row)
		{	 
			//Si el municipio cambio
   			if($intMunicipioIDAnterior != $row->municipio_id && $intMunicipioIDAnterior != 0)
   			{
   				//Agregar datos al array de municipios
   				$arrMunicipios[] = array('title' => $strMunicipioAnterior,
									     'icon'=> FALSE,
					                     'key' => $intMunicipioIDAnterior, 
					                     'children' =>  $arrLocalidades,
					                     'agregar' => FALSE);

   				//Limpiar array de localidades
   				$arrLocalidades = array();
   			}

   			//Si el estado cambio
   			if($intEstadoIDAnterior != $row->estado_id && $intEstadoIDAnterior != 0)
   			{
   				//Agregar datos al array de estados
   				$arrEstados[] = array('title' => $strEstadoAnterior,
									  'icon'=> FALSE,
					                  'key' => $intEstadoIDAnterior, 
					                  'children' =>  $arrMunicipios,
					                  'agregar' => FALSE);

   				//Limpiar array de municipios
   				$arrMunicipios = array();
   			}
   			
   			//Si el país cambio
   			if($intPaisIDAnterior != $row->pais_id && $intPaisIDAnterior != 0)
   			{
   				//Agregar datos al array de países, estados, municipios y localidades
   				$arrDatos[] = array('title' => $strPaisAnterior,
									'icon'=> FALSE,
					                'key' => $intPaisIDAnterior, 
					                'children' =>  $arrEstados,
					                'agregar' => FALSE);
   				//Limpiar array de estados
   				$arrEstados = array();
   			}

   			//Verificar si el id de la localidad se encuentra ocupado en otra zona
   			if(in_array($row->localidad_id, $arrLocalidadesOcupadasIDS))
   			{	
   				//No permitir agregar la localidad
   				$bolAgregar = FALSE;
   				//Deshabilitar casilla del tree view
   				$bolUnSelecTable = TRUE;
   			}
   			else
   			{
   				//Permitir agregar la localidad
   				$bolAgregar = TRUE;
   				//Habilitar casilla del tree view
   				$bolUnSelecTable = FALSE;
   			}


   			//Agregar datos al array de localidades
   			$arrLocalidades[] = array('title' => $row->localidad,
									  'icon'=> FALSE,
									  'key' => $row->localidad_id, 
									  'children' => [],
									  'unselectable' => $bolUnSelecTable,
									  'selected' => in_array($row->localidad_id, $arrLocalidadesIDS), 
									  'agregar' => $bolAgregar);

   		    //Inicializar variables
   			$intMunicipioIDAnterior = $row->municipio_id;
   			$strMunicipioAnterior = $row->municipio;
   			$intEstadoIDAnterior = $row->estado_id;
   			$strEstadoAnterior = $row->estado;
   			$intPaisIDAnterior = $row->pais_id;
   			$strPaisAnterior = $row->pais;
   		}

   		//Agregar datos del último municipio
   		if($intMunicipioIDAnterior != 0)
		{
			//Agregar datos al array de municipios
			$arrMunicipios[] = array('title' => $strMunicipioAnterior,
							     'icon'=> FALSE,
			                     'key' => $intMunicipioIDAnterior, 
			                     'children' =>  $arrLocalidades,
			                     'agregar' => FALSE 
			                     );
		}

		//Agregar datos del último estado
		if($intEstadoIDAnterior != 0)
		{
			//Agregar datos al array de estados
			$arrEstados[] = array('title' => $strEstadoAnterior,
							     'icon'=> FALSE,
			                     'key' => $intEstadoIDAnterior, 
			                     'children' =>  $arrMunicipios,
			                     'agregar' => FALSE 
			                     );
		}

		//Agregar datos del último país
		if($intPaisIDAnterior != 0)
		{
			//Agregar datos al array de países, estados, municipios y localidades
			$arrDatos[] = array('title' => $strPaisAnterior,
									'icon'=> FALSE,
					                'key' => $intPaisIDAnterior, 
					                'children' =>  $arrEstados,
					                'agregar' => FALSE 
					                );
		}

		//Regresar array con la estructura del treeview (árbol)
		return $arrDatos;
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
		$otdResultado = $this->localidades->buscar(NULL, NULL, NULL, $strBusqueda); 
		
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'LISTADO DE LOCALIDADES';
		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array('LOCALIDAD', 'MUNICIPIO', 'ESTADO', utf8_decode('PAÍS'), 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(42.5, 42.5, 42.5, 42.5, 20);
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
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol->localidad), utf8_decode($arrCol->municipio), 
								utf8_decode($arrCol->estado), utf8_decode($arrCol->pais), 
								$arrCol->estatus), $pdf->arrAlineacion);
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
		$pdf->Output('localidades.pdf','I'); 
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
		$otdResultado = $this->localidades->buscar(NULL, NULL, NULL, $strBusqueda); 
     	
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE LOCALIDADES');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'LOCALIDAD')
        		 ->setCellValue('B'.$intPosEncabezados, 'MUNICIPIO')
        		 ->setCellValue('C'.$intPosEncabezados, 'ESTADO')
        		 ->setCellValue('D'.$intPosEncabezados, 'PAÍS')
                 ->setCellValue('E'.$intPosEncabezados, 'ESTATUS');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:E9')
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
                         ->setCellValue('A'.$intFila, $arrCol->localidad)
                         ->setCellValue('B'.$intFila, $arrCol->municipio)
                         ->setCellValue('C'.$intFila, $arrCol->estado)
                         ->setCellValue('D'.$intFila, $arrCol->pais)
                         ->setCellValue('E'.$intFila, $arrCol->estatus);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('E'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('E'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'localidades.xls', 'localidades', $intFila);
	}
}