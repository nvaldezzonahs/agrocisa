<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cultivos extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('crm/cultivos_model', 'cultivos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('crm/cultivos', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->cultivos->filtro(trim($this->input->post('strBusqueda')),
			                              $config['per_page'],
			                              $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['cultivos'] as $arrDet)
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
		$arrDatos = array('rows' => $result['cultivos'],
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
		$objCultivo = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Datos del cultivo
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objCultivo->intCultivoID = $this->input->post('intCultivoID');
		$objCultivo->strDescripcion = mb_strtoupper(trim($this->input->post('strDescripcion')));
		$objCultivo->strDescripcionAnterior = mb_strtoupper(trim($this->input->post('strDescripcionAnterior')));
		$objCultivo->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de las temporadas
		$objCultivo->strSiembras = $this->input->post('strSiembras');
	    $objCultivo->strCosechas = $this->input->post('strCosechas');
		
        //Definir las reglas de validación
		//Validar que la descripción sea única
        if (($objCultivo->intCultivoID == '') OR 
        	($objCultivo->strDescripcionAnterior != $objCultivo->strDescripcion))
        {
            $this->form_validation->set_rules('strDescripcion', 'cultivo', 'required|is_unique[cultivos.descripcion]');
        }
        else
        {
        	$this->form_validation->set_rules('strDescripcion', 'cultivo', 'required');
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
			if (is_numeric($objCultivo->intCultivoID))
			{
				$bolResultado = $this->cultivos->modificar($objCultivo);
			}
			else
			{ 
				$bolResultado = $this->cultivos->guardar($objCultivo);
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
			$otdResultado = $this->cultivos->buscar($strBusqueda);
		}
		else 
		{
    		$otdResultado = $this->cultivos->buscar(NULL, $strBusqueda);
		}
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;

			//Seleccionar las temporadas del registro
			$otdTemporadas = $this->cultivos->buscar_temporadas($otdResultado->cultivo_id);
			//Si existen temporadas del registro, se asignan al array
			if($otdTemporadas)
			{
				$arrDatos['temporadas'] = $otdTemporadas;
			}
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
	    //Definir las reglas de validación
		$this->form_validation->set_rules('intCultivoID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intCultivoID');
		    $strEstatus = $this->input->post('strEstatus');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->cultivos->set_estatus($intID, $strEstatus);
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
			$otdResultado = $this->cultivos->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->descripcion, 
		        						'data' => $arrCol->cultivo_id);
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
		//Variable que se utiliza pra asignar el id actual del cultivo
		$intCultivoIDActual = 0;
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;

		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->cultivos->buscar(NULL, NULL, $strBusqueda);  
		
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1= 'LISTADO DE CULTIVOS';
		//Crea los titulos de la primer cabecera 
		$pdf->arrCabecera = array('CULTIVO', 'ESTATUS');
		//Crea los titulos de la segunda cabecera 
		$pdf->arrCabecera2 = array('','SIEMBRA', 'COSECHA', '');
		//Establece el ancho de las columnas de las cabeceras
		$pdf->arrAnchura = array(170, 20);
		$pdf->arrAnchura2 = array(5, 50, 50, 85);
		///Establece la alineación de las celdas de las tablas
		$pdf->arrAlineacion = array('L', 'C');
		$pdf->arrAlineacion2 = array('L', 'L', 'L', 'L');
		//Agregar la primer pagina
		$pdf->AddPage();
		
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas de la primer cabecera
				$pdf->SetWidths($pdf->arrAnchura);
				//Si el cultivo actual es igual a cero (primer cultivo)
	      		if ($intCultivoIDActual === 0)
	      		{
	      			//Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
	      			//Se agrega la informacion de la primer cabecera al reporte... se utiliza utf8 para acentos y tildes
	      			$pdf->Row(array(utf8_decode($arrCol->descripcion), $arrCol->estatus), 
							  $pdf->arrAlineacion, 'ClippedCell');
							
	      			//Asignar id del cultivo actual
	      			$intCultivoIDActual = $arrCol->cultivo_id;
	      		}

				//Si el cultivo actual es diferente al anterior
	      		if ($intCultivoIDActual != $arrCol->cultivo_id)
	      		{
	      			//Cambiar el volumen de la fuente a bold
	      			$pdf->strTipoLetraTabla = 'Negrita';
	      			//Se agrega la informacion de la primer cabecera al reporte... se utiliza utf8 para acentos y tildes
	      			$pdf->Row(array(utf8_decode($arrCol->descripcion), $arrCol->estatus), 
							  $pdf->arrAlineacion, 'ClippedCell');
	      			
	      			//Asignar id del cultivo actual
	      	    	$intCultivoIDActual = $arrCol->cultivo_id;
	      		}
   				
	      		//Cambiar el volumen de la fuente a normal
				$pdf->strTipoLetraTabla = '';

				//Seleccionar las temporadas del registro
				$otdTemporadas = $this->cultivos->buscar_temporadas($arrCol->cultivo_id);
				//Verificar si existe información de las temporadas 
				if($otdTemporadas)
				{	
					//Establece el ancho de las columnas de la segunda cabecera
					$pdf->SetWidths($pdf->arrAnchura2);
					//Recorremos el arreglo 
					foreach ($otdTemporadas as $arrTemp)
					{ 

						//Se agrega la informacion de la segunda cabecera al reporte... se utiliza utf8 para acentos y tildes
						$pdf->Row(array('', $arrTemp->siembra, $arrTemp->cosecha, ''),
								  $pdf->arrAlineacion2, 'ClippedCell');
					}
					
					$pdf->Ln(1); //Deja un salto de línea

				}//Cierre de verificación de temporadas
				
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
		$pdf->Output('cultivos.pdf','I'); 
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
		$otdResultado = $this->cultivos->buscar(NULL, NULL, $strBusqueda); 
     	
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE CULTIVOS');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'CULTIVO')
        		 ->setCellValue('B'.$intPosEncabezados, 'ESTATUS')
        		 ->setCellValue('C'.$intPosEncabezados, 'SIEMBRA')
                 ->setCellValue('D'.$intPosEncabezados, 'COSECHA');
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
				//Array que se utiliza para agregar los detalles 
		        $arrDetalles = array();
		        //Variable que se utiliza para asignar el número de detalles 
		        $intNumDetalles = 1;
		         //Variable que se utiliza para asignar el número de temporadas
		        $intNumTemporadas = 0;

		        //Seleccionar las temporadas del registro
				$otdTemporadas = $this->cultivos->buscar_temporadas($arrCol->cultivo_id);
				//Verificar si existe información de las temporadas
				if($otdTemporadas)
			    {
			    	//Variable que se utiliza para contar el número de temporadas
			    	$intContTemp = 0;
			    	//Asignar el número de temporadas
			    	$intNumTemporadas = count($otdTemporadas);
			    	$intNumDetalles = $intNumTemporadas;

			    	//Recorremos el arreglo 
			        foreach ($otdTemporadas as $arrTemp) 
			        {
			        	//Asignar datos al array
			        	$arrDetalles[$intContTemp]['siembra']= $arrTemp->siembra;
			        	$arrDetalles[$intContTemp]['cosecha']= $arrTemp->cosecha;
			        	//Incrementar el contador por cada registro
                        $intContTemp++;
			        }

			    }//Cierre de verificación de temporadas

			    //Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    { 
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
	                         ->setCellValue('A'.$intFila, $arrCol->descripcion)
	                         ->setCellValue('B'.$intFila, $arrCol->estatus);

	                //Si existen temporadas
		            if($intNumTemporadas > 0)
		            {
		            	//Agregar información del registro
						$objExcel->setActiveSheetIndex(0)
					        	 ->setCellValue('C'.$intFila, $arrDetalles[$intContDet]['siembra'])
					        	 ->setCellValue('D'.$intFila, $arrDetalles[$intContDet]['cosecha']);
					    
		            }

	                //Incrementar el indice para escribir los datos del siguiente registro
	                $intFila++; 
            	}

                //Incrementar el contador por cada registro
			    $intContador++;
			}

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('B'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('B'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'cultivos.xls', 'cultivos', $intFila);
	}
}