<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendedores extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('crm/vendedores_model', 'vendedores');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('crm/vendedores', $arrDatos);
	}

	/*******************************************************************************************************************
	Funciones de la tabla vendedores
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->vendedores->filtro(trim($this->input->post('strBusqueda')),
			                                $config['per_page'],
			                                $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['vendedores'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionAutorizar = 'no-mostrar';
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

			//Si el usuario cuenta con el permiso de acceso AUTORIZAR
			if (in_array('AUTORIZAR', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón Autorizar
				$arrDet->mostrarAccionAutorizar = '';
			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['vendedores'],
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
		$objVendedor = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		$objVendedor->intVendedorID = $this->input->post('intVendedorID');
		$objVendedor->intEmpleadoID = $this->input->post('intEmpleadoID');
		$objVendedor->intEmpleadoIDAnterior = $this->input->post('intEmpleadoIDAnterior');
		$objVendedor->intModuloID = $this->input->post('intModuloID');
		$objVendedor->intModuloIDAnterior = $this->input->post('intModuloIDAnterior');
		$objVendedor->intUsuarioID = $this->session->userdata('usuario_id');
		
		//Definir las reglas de validación
		//Validar que el empleado sea único en el módulo
        if (($objVendedor->intVendedorID == '') OR 
        	($objVendedor->intEmpleadoIDAnterior != $objVendedor->intEmpleadoID) OR
        	($objVendedor->intModuloIDAnterior != $objVendedor->intModuloID))
        {
        	$this->form_validation->set_rules('intEmpleadoID', 'empleado', 
        									  'required|callback_get_existencia['.$objVendedor->intModuloID.']');
        }
        else
        {
        	$this->form_validation->set_rules('intEmpleadoID', 'empleado', 'required');
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
			if (is_numeric($objVendedor->intVendedorID))
			{
				$bolResultado = $this->vendedores->modificar($objVendedor);
			}
			else
			{ 
				$bolResultado = $this->vendedores->guardar($objVendedor);
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


	//Verifica la existencia del empleado en el módulo
	//para evitar duplicación de datos al momento de modificar o guardar un registro.
    public function get_existencia($intEmpleadoID, $intModuloID) 
    {	
    	//Concatenar datos para realizar la búsqueda
    	$strCriteriosBusq = $intEmpleadoID.'|'.$intModuloID;
		//Hacer un llamado al método para comprobar la existencia del empleado en el módulo
		$otdResultado = $this->vendedores->buscar(NULL, $strCriteriosBusq);
		//Si existen datos
		if($otdResultado)
		{
		    //Enviar mensaje de error
		    $this->form_validation->set_message('get_existencia', 'El  %s ya ha sido registrado en este módulo, favor de verificar.');
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
		$arrDatos = array('row' => NULL, 'total_prospectos' => 0);
		//Variables que se utilizan para recuperar los valores de la vista 
		$strBusqueda = $this->input->post('strBusqueda');
		$strTipo = $this->input->post('strTipo');
		//Dependiendo del tipo realizar la búsqueda de datos
		//Seleccionar los datos del registro que coincide con el parámetro enviado
		if($strTipo == 'id')
		{
			$otdResultado = $this->vendedores->buscar($strBusqueda);
		}
		else 
		{
			//Se recupera cadena concatenada con los criterios de búsqueda: empleadoID|moduloID
    		$otdResultado = $this->vendedores->buscar(NULL, $strBusqueda);
		}
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;

			//Seleccionar los datos de los prospectos
			$otdProspectos = $this->vendedores->buscar_prospectos($otdResultado->vendedor_id);
			//Si existen prospectos del registro, se asignan al array
			if($otdProspectos)
			{
				$arrDatos['prospectos'] = $otdProspectos;
				$arrDatos['total_prospectos'] = count($otdProspectos);

			}
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intVendedorID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intVendedorID');
		    $strEstatus = $this->input->post('strEstatus');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->vendedores->set_estatus($intID, $strEstatus);
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
		$intModuloID = $this->input->post('intModuloID');

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->vendedores->autocomplete($intModuloID, $strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
					//Asignar nombre del vendedor
					$strVendedor = $arrCol->vendedor;
					//Si no existe módulo
					if($intModuloID == 0)
					{
						$strVendedor .= ' MOD. '.$arrCol->modulo;
					}

		        	$arrDatos[] = array('value' => $strVendedor, 
		        						'data' => $arrCol->vendedor_id,
		        						'modulo' => $arrCol->modulo,
		        						'modulo_id' => $arrCol->modulo_id);
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
		$otdResultado = $this->vendedores->buscar(NULL, NULL, $strBusqueda); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'LISTADO DE VENDEDORES';
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('MÓDULO'), 'NOMBRE', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(50, 120, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C');
		//Establece la alineación de las celdas de la tabla prospectos
	    $arrAlineacionProspectos = array('L');
	    //Establece el ancho de las columnas de la tabla prospectos
		$arrAnchuraProspectos = array(170);

		//Agregar la primer pagina
		$pdf->AddPage();

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol->modulo), 
								utf8_decode($arrCol->empleado), 
								$arrCol->estatus), 
								$pdf->arrAlineacion);

				//Seleccionar los prospectos del vendedor
				$otdProspectos = $this->vendedores->buscar_prospectos($arrCol->vendedor_id);
				//Verificar si existe información de los prospectos 
				if($otdProspectos)
				{

					//Asigna el tipo y tamaño de letra
			        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Lista de prospectos del vendedor
					$pdf->Cell(11, 4, 'LISTA DE PROSPECTOS', 0, 0, 'L', 0);
					$pdf->Ln(3);//Deja un salto de línea
					//Recorremos el arreglo 
			        foreach ($otdProspectos as $arrProsp) 
			        {
			        	//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraProspectos);

			        	//Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array(utf8_decode($arrProsp->prospecto)), 
					    				$arrAlineacionProspectos, 'ClippedCell');
			        }

					$pdf->Ln(2);//Deja un salto de línea

				}//Cierre de verificación de prospectos

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
		$pdf->Output('vendedores.pdf','I'); 
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
		$otdResultado = $this->vendedores->buscar(NULL, NULL, $strBusqueda); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE VENDEDORES');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'MÓDULO')
        		 ->setCellValue('B'.$intPosEncabezados, 'NOMBRE')
                 ->setCellValue('C'.$intPosEncabezados, 'ESTATUS')
                 ->setCellValue('D'.$intPosEncabezados, 'LISTA DE PROSPECTOS');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:D9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Array que se utiliza para agregar los prospectos
		        $arrProspectos = array();
				//Variable que se utiliza para asignar el número de prospectos 
		        $intNumProspectos = 1;
		        //Variable que se utiliza para contar el número de prospectos
				$intContProsp = 0;

                //Seleccionar los prospectos del vendedor
				$otdProspectos = $this->vendedores->buscar_prospectos($arrCol->vendedor_id);
				//Verificar si existe información de los prospectos 
				if($otdProspectos)
				{	
					//Asignar el número de prospectos
				    $intNumProspectos = count($otdProspectos);

				    //Recorremos el arreglo 
					foreach ($otdProspectos as $arrProsp)
					{
						//Agregar datos al array
			        	$arrProspectos[$intContProsp]['prospecto'] = $arrProsp->prospecto;

			        	//Incrementar el contador por cada registro
	                    $intContProsp++;
					}

				}//Cierre de verificación de prospectos

				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumProspectos; $intContDet++) 
			    {

			    	//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
	                         ->setCellValue('A'.$intFila, $arrCol->modulo)
	                         ->setCellValue('B'.$intFila, $arrCol->empleado)
	                         ->setCellValue('C'.$intFila, $arrCol->estatus);

	                //Si existen prospectos del vendedor
	                if($intContProsp > 0)
	                {
  						//Agregar información del prospecto
						$objExcel->setActiveSheetIndex(0)
					 		 	->setCellValue('D'.$intFila, $arrProspectos[$intContDet]['prospecto']);
	                }
	              

			    	//Incrementar el indice para escribir los datos del siguiente registro
                	$intFila++; 
			    }

                //Incrementar el contador por cada registro
				$intContador++;
			}

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('D'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('D'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'vendedores.xls', 'vendedores', $intFila);
	}

	/*******************************************************************************************************************
	Funciones de la tabla prospectos_vendedores
	*********************************************************************************************************************/
	 //Método para guardar los datos de un registro
	public function guardar_prospectos()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objVendedorProspecto = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		$objVendedorProspecto->intVendedorID = $this->input->post('intVendedorID');
		$objVendedorProspecto->strProspectoID =  $this->input->post('strProspectoID'); 

		//Guardamos los datos del registro
		$bolResultado = $this->vendedores->guardar_prospectos($objVendedorProspecto);
		
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
}