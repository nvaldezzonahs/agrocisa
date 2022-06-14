<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procesos extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de procesos
		$this->load->model('seguridad/procesos_model', 'procesos');
		//Cargamos el modelo de usuarios
		$this->load->model('seguridad/usuarios_model', 'usuarios');
		//Cargamos el modelo de grupos de usuarios
		$this->load->model('seguridad/grupos_usuarios_model', 'grupos_usuarios');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('seguridad/procesos', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->procesos->filtro(trim($this->input->post('strBusqueda')),
										  $config['per_page'],
										  $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['procesos'] as $arrDet)
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
		$arrDatos = array('rows' => $result['procesos'],
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
		$objProceso = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objProceso->intProcesoID = $this->input->post('intProcesoID');
		$objProceso->intProcesoPadreID = ($this->input->post('intProcesoPadreID') == 0 ? NULL: $this->input->post('intProcesoPadreID'));
		$objProceso->strMenuNivel = $this->input->post('strMenuNivel');
		$objProceso->strDescripcion = trim($this->input->post('strDescripcion'));
		$objProceso->intOrden = $this->input->post('intOrden');
		$objProceso->strRutaAcceso = trim($this->input->post('strRutaAcceso'));
		$objProceso->strTipoVentana = $this->input->post('strTipoVentana');
		$objProceso->intUsuarioID = $this->session->userdata('usuario_id');

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objProceso->intProcesoID))
		{
			$bolResultado = $this->procesos->modificar($objProceso);
		}
		else
		{ 
			$bolResultado = $this->procesos->guardar($objProceso);
			/*Quitar '_'  de la cadena (resultadoTransaccion_procesoID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
				 */
			list($bolResultado, $objProceso->intProcesoID) = explode("_", $bolResultado); 
		}

		//Si no se obtienen errores al ejecutar el proceso
		if($bolResultado)
		{
			//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE,
						 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
						 	  'proceso_id' => $objProceso->intProcesoID,
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
		$intProcesoID = $this->input->post('intProcesoID');
		//Seleccionar los datos del registro que coincide con el parámetro enviado
		$otdResultado = $this->procesos->buscar($intProcesoID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para regresar los registros que coincidan con los parámetros enviados para cargarlos en un combobox
	public function get_combo_box()
	{
		//Recuperar valores de la vista (criterios de búsqueda)
		$intProcesoPadreID = $this->input->post('intProcesoPadreID');
		$arrDatos['procesos'] = $this->procesos->buscar(NULL, $intProcesoPadreID);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para alimentar la plantilla de subprocesos en el formulario procesos
	public function get_subprocesos()
	{
		//Inicializamos el array que se enviará con la información encontrada
		$arrPlantilla =  NULL;
		//Definimos el arreglo que nos servirá para agregar la lista de suprocesos
		$arrTemp = array("funcion"=>'', "subProcesoID"=>NULL);
		//Obtener los subprocesos registrados para el proceso
		$objSubprocesos = $this->procesos->get_subprocesos($this->input->post('intProcesoID'));

		//Recorremos el arreglo con las funciones definidas en MY_Controller
		foreach ($this->ARR_FUNCIONES as $rowSub)
		{
			$arrTemp["funcion"] = $rowSub;
			$arrTemp["subProcesoID"] = NULL;
			foreach ($objSubprocesos as $rowTmp)
			{
				//Si el subproceso se encuentra en los permisos del usuario
				if ($arrTemp["funcion"] == $rowTmp->funcion)
				{
					$arrTemp["subProcesoID"] = $rowTmp->subproceso_id;
				}
			}
			$arrPlantilla[] = $arrTemp;
		}
		$arrDatos = array('rows' => $arrPlantilla);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para agregar/eliminar subprocesos
	public function set_subproceso()
	{
		//Si tenemos el ID del subproceso es una eliminación, si no, es una inserción
		if ($this->input->post('intSubProcesoID'))
		{
			//Definir las reglas de validación
			$this->form_validation->set_rules('intSubProcesoID', 'Subproceso', 'required|integer');
		}
		else
		{
			//Definir las reglas de validación
			$this->form_validation->set_rules('intProcesoID', 'Proceso', 'required|integer');
			$this->form_validation->set_rules('strFuncion', 'Función', 'required');
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
			//Si tenemos el ID del subproceso es una eliminación, si no, es una inserción
			if ($this->input->post('intSubProcesoID'))
			{
				$bolResultado = $this->procesos->eliminar_subproceso($this->input->post('intSubProcesoID'));
				$strMensaje = 'El subproceso se eliminó correctamente.';
			}
			else
			{
				$bolResultado = $this->procesos->set_subproceso($this->input->post('intProcesoID'), $this->input->post('strFuncion'));
				$strMensaje = 'El subproceso se agregó correctamente.';
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

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
		//Definir las reglas de validación
		$this->form_validation->set_rules('intProcesoID', 'ID', 'required|integer');
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
			$intID = $this->input->post('intProcesoID');
			$strEstatus = $this->input->post('strEstatus');
			//Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->procesos->set_estatus($intID, $strEstatus);
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

	//Método para regresar el treeview con los procesos
	/*****
	 * Parámetros
	 * strTipo - Indica si se buscan los permisos para un Usuario o Grupo de Usuarios
	 * intID - Es el ID del tipo seleccionado
	 * intSucursalID - Es la sucursal del usuario donde se están buscando los permisos
	*****/
	public function get_treeview($strTipo = NULL, $intID = 0, $intSucursalID = 0)
	{
		//Array que se utiliza para guardar los permisos de acceso
		$arrPermisos = array();
		//Array que se utiliza para enviar el resultado a la vista
		$arrProcesos = array();
		//Si se envía el buscamos los permisos correspondientes
		if ($intID !== 0)
		{
			//Dependiendo del tipo, regresar permisos de acceso
			if ($strTipo == 'Usuario')
			{
				$otdPermisos = $this->usuarios->get_permisos($intID, $intSucursalID);
			}
			else
			{
				$otdPermisos = $this->grupos_usuarios->get_permisos($intID);
			}

			//Si se obtienen resultados, los asignamos al array
			if ($otdPermisos)
			{	
				//Separar los ID de los subprocesos a los que tiene acceso y guardarlos en un arreglo
				$arrPermisos = explode('|', $otdPermisos->permisos);
			}
		}
		//Llamar a la función para cargar los procesos
		$arrProcesos = $this->cargar_treeview(0, $arrPermisos);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrProcesos));
	}

	//Función para cargar el treeview con los procesos y permisos de acceso
	public function cargar_treeview($intProcesoID, $arrPermisos)
	{
		//Arreglo que regresa los valores asignados
		$arrProcesos = array();

		//Seleccionar los procesos hijos del proceso enviado
		$otdProcesos = $this->procesos->get_procesos_hijos($intProcesoID);
		//Recorrer los procesos hijos
		foreach ($otdProcesos as $rowPro)
		{
			//Inicializar el arreglo con los hijos del proceso
			$arrHijos = array();
			//Obtener los subprocesos del proceso
			$objSubprocesos = $this->procesos->get_subprocesos($rowPro->proceso_id);
			if ($objSubprocesos)
			{
				//Si no tiene hijos, recorremos los subprocesos del proceso para agregarlos como hijos
				if ($rowPro->hijos == 0)
				{
					foreach ($objSubprocesos as $rowSub)
					{
						//Asignar datos al array de procesos hijos
						$arrHijos[] = array('title' => $rowSub->funcion,
											'icon'=> FALSE,
											'key' => $rowSub->subproceso_id, 
											'children' => [],
											'selected' => in_array($rowSub->subproceso_id, $arrPermisos), 
											'agregar' => TRUE);
					}
					//Si el proceso no tiene hijos, no se agregaría como permiso, sólo los subprocesos seleccionados
					$bolAgregar = FALSE;
					//La llave que se agrega es el ID del proceso concatenado con una P para que sea único
					$strKey = 'P'.$rowPro->proceso_id;
				}
				else
				{
					//Si el proceso tiene hijos, se llama a la función para cargarlos
					$arrHijos = $this->cargar_treeview($rowPro->proceso_id, $arrPermisos);
					//En caso de estar seleccionado, el proceso si se agregaría como permiso
					$bolAgregar = TRUE;
					//Recorrer los subprocesos para obtener el ID y asignarlo como llave
					foreach ($objSubprocesos as $rowSub)
					{
						$strKey = $rowSub->subproceso_id;
					}
				}
				//Asignar datos al array de procesos hijos
				$arrProcesos[] = array('title' => $rowPro->descripcion,
									   'icon'=> FALSE,
									   'key' => $strKey, 
									   'children' => $arrHijos,
									   'selected' => in_array($strKey, $arrPermisos),
									   'agregar' => $bolAgregar);
			}
		}
		return $arrProcesos;
	}

	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte()
	{	            
		//Variables que se utilizan para recuperar los valores de la vista
		$strBusqueda = trim($this->input->post('strBusqueda'));
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		
		//Seleccionar los datos de los registros
		$otdResultado = $this->procesos->buscar(NULL, NULL, $strBusqueda); 
		
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = utf8_decode('LISTADO DE PROCESOS');
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('PROCESO','PROCESO PADRE', utf8_decode('NIVEL DE MENÚ'),'ORDEN','ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(60,75,20,15,20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'C', 'C');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Si hay información
		if ($otdResultado)
		{
			foreach ($otdResultado as $arrCol)
			{ //Recorremos el arreglo 
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol->proceso), utf8_decode($arrCol->proceso_padre), 
								$arrCol->menu_nivel, $arrCol->orden, $arrCol->estatus), $pdf->arrAlineacion);
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
		$pdf->Output('procesos.pdf','I'); 
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
		$otdResultado = $this->procesos->buscar(NULL, NULL, $strBusqueda); 
     	
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE PROCESOS');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'PROCESO')
        		 ->setCellValue('B'.$intPosEncabezados, 'PROCESO PADRE')
        		 ->setCellValue('C'.$intPosEncabezados, 'RUTA DE ACCESO')
        		 ->setCellValue('D'.$intPosEncabezados, 'NIVEL DE MENÚ')
        		 ->setCellValue('E'.$intPosEncabezados, 'ORDEN')
        		 ->setCellValue('F'.$intPosEncabezados, 'TIPO DE VENTANA')
                 ->setCellValue('G'.$intPosEncabezados, 'ESTATUS');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
        		 ->getStyle('A9:G9')
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
                         ->setCellValue('A'.$intFila, $arrCol->proceso)
                         ->setCellValue('B'.$intFila, $arrCol->proceso_padre)
                         ->setCellValue('C'.$intFila, $arrCol->ruta_acceso)
                         ->setCellValue('D'.$intFila, $arrCol->menu_nivel)
                         ->setCellValue('E'.$intFila, $arrCol->orden)
                         ->setCellValue('F'.$intFila, $arrCol->tipo_ventana)
                         ->setCellValue('G'.$intFila, $arrCol->estatus);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('D'.$intFilaInicial.':'.'G'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('G'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('G'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'procesos.xls', 'procesos', $intFila);
	}
}