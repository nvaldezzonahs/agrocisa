<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polizas extends MY_Controller {
	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar ruta de la carpeta principal
	    $this->archivo['strCarpetaPrincipal'] = './archivos/';
		//Asignar ruta de la carpeta destino
	    $this->archivo['strCarpetaDestino'] = './archivos/polizas/';
	    //Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('contabilidad/polizas_model', 'polizas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('contabilidad/polizas', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->polizas->filtro($this->input->post('dteFechaInicial'),
										 $this->input->post('dteFechaFinal'),
										 trim($this->input->post('strEstatus')),
										 trim($this->input->post('strModulo')),
										 trim($this->input->post('strProceso')),
									     trim($this->input->post('strBusqueda')),
			                             $config['per_page'],
			                             $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		
		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['polizas'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionVerArchivoRegistro = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
            //Reemplazar cadena vacia por '_'
            $strEstiloEstatus =  str_replace (' ' , '_' ,  $arrDet->estatus);
            //Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = 'registro-'.$strEstiloEstatus;

           //Concatenar id del registro que hace referencia a la carpeta donde se encuentran los archivos (de los detalles)
			$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$arrDet->poliza_id;

			//Asignar el total de archivos que contiene la carpeta del registro
			$intTotalArchivos = $this->get_total_archivos_registro($strNombreCarpeta);
            
			//Si el estatus del registro es INACTIVO
			if($arrDet->estatus == 'INACTIVO')
			{

				//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
				if (in_array('CAMBIAR ESTATUS', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Restaurar
					$arrDet->mostrarAccionRestaurar = '';
				}
				
				//Si el usuario cuenta con el permiso de acceso VER REGISTRO
				if (in_array('VER REGISTRO', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Ver registro
	        		$arrDet->mostrarAccionVerRegistro = '';	
				}
			}
			else
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

			
			//Si el usuario cuenta con el permiso de acceso IMPRIMIR REGISTRO
			if (in_array('IMPRIMIR REGISTRO', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón Imprimir
        		$arrDet->mostrarAccionImprimir = '';
			}

			//Si existen archivos del registro 
			if($intTotalArchivos > 0)
    		{
    			//Si el usuario cuenta con el permiso de acceso VER REGISTRO
				if (in_array('VER REGISTRO', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Ver archivo del registro
	        		$arrDet->mostrarAccionVerArchivoRegistro = '';
	        	}
    		}

		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['polizas'],
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
		$objPoliza = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Datos de la póliza
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objPoliza->intPolizaID = $this->input->post('intPolizaID');
	    $objPoliza->strTipo = $this->input->post('strTipo');
	    $objPoliza->strModulo = 'CONTABILIDAD';
	    $objPoliza->strProceso = 'POLIZA';
	    //Asignar NO para indicar que la póliza no corresponde al cierre anual
	    $objPoliza->strCierreAnual = 'NO';
	    $objPoliza->intReferenciaID = NULL;
	    $objPoliza->dteFecha = $this->input->post('dteFecha');
		$objPoliza->strConcepto = mb_strtoupper(trim($this->input->post('strConcepto')));
		$objPoliza->strObservaciones = mb_strtoupper(trim($this->input->post('strObservaciones')));
		$objPoliza->strEstatus = $this->input->post('strEstatus');
		$objPoliza->intSucursalID = $this->session->userdata('sucursal_id');
		$objPoliza->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los detalles
		$objPoliza->arrDetalles = json_decode($this->input->post('arrDetalles'));
		//Datos de los renglones	
		$strRenglonesActuales = $this->input->post('strRenglonesActuales');
		$strRenglonesAnteriores = $this->input->post('strRenglonesAnteriores');
		$intProcesoMenuID =  $this->encrypt->decode($this->input->post('intProcesoMenuID'));
		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objPoliza->intPolizaID))
		{
			//Hacer un llamado a la función para cambiar el nombre de las carpetas de los detalles del registro
	   		$strMensajeRenombrarCarpeta = $this->renombrar_carpetas($objPoliza->intPolizaID, 
	   															    $strRenglonesActuales, 
	   															    $strRenglonesAnteriores);

	   		 //Si no existen errores al momento de renombrar la carpetas e los detalles del registro
		    if($strMensajeRenombrarCarpeta == '')
		    {
		    	//Hacer un llamado a la función para eliminar las carpetas de los detalles del registro
		   	 	$strMensajeEliminarCarpeta = $this->eliminar_carpetas($objPoliza->intPolizaID, 
		   	 														  $strRenglonesActuales);
		   	 	//Si no existen errores al momento de eliminar las carpetas de los detalles del registro
			    if($strMensajeEliminarCarpeta == '')
			    {
			    	$bolResultado = $this->polizas->modificar($objPoliza);
			    }
			    else
			    {
			    	//Enviar el mensaje de error al formulario
					$arrDatos = array('resultado' => FALSE,
								      'tipo_mensaje' => TIPO_MSJ_ERROR,
						              'mensaje' => $strMensajeEliminarCarpeta);
			    }
			}
			else
		    {
		    	//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => $strMensajeRenombrarCarpeta);
		    }

		}
		else
		{ 
			
			//Hacer un llamado a la función para generar el folio consecutivo de la póliza
			$objPoliza->strFolio = $this->get_folio_consecutivo_poliza($objPoliza->strTipo, 10);
			//Si no existe folio del proceso
			if($objPoliza->strFolio == '')
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
							      'tipo_mensaje' => TIPO_MSJ_ERROR,
					              'mensaje' => MSJ_GENERAR_FOLIO);
			}
			else
			{
				$bolResultado = $this->polizas->guardar($objPoliza); 

				/*Quitar '_'  de la cadena (resultadoTransaccion_polizaID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
					 */
				list($bolResultado, $objPoliza->intPolizaID) = explode("_", $bolResultado);
			}
		}

		//Si se ejecutó acción en la base de datos
		if($bolResultado !== NULL)
		{
	        //Si no se obtienen errores al ejecutar el proceso
			if($bolResultado)
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos = array('resultado' => TRUE,
							 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
							 	  'poliza_id' => $objPoliza->intPolizaID,
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
		$intID = $this->input->post('intPolizaID');
		//Seleccionar los datos del registro que coincide con el id (primer posición del arreglo)
	    //$otdResultado = $this->polizas->buscar($intID)[0];
	     $otdResultado = $this->polizas->buscar($intID);
	    //Concatenar id del registro que hace referencia a la carpeta donde se encuentran los archivos (de los detalles)
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intID;
		
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{	
			$arrDatos['row'] = $otdResultado;

			//Seleccionar los detalles del registro
			$otdDetalles = $this->polizas->buscar_detalles($intID);
			//Si existen detalles del registro, se asignan al array
			if($otdDetalles)
			{
				//Hacer recorrido para verificar si el detalle tiene archivos
				foreach ($otdDetalles as $arrDet)
				{
					//Seleccionar los detalles Diot del registro
					$otdDetallesDiot = $this->polizas->buscar_detalles_diot($intID, $arrDet->renglon);

					//Si existen detalles Diot del registro, se asignan al array
					if($otdDetallesDiot)
					{
						$arrDet->arrDetallesDiot =  $otdDetallesDiot;
					}

					//Concatenar renglón que hace referencia a la carpeta donde se encuentra el archivo
					$strNombreSubCarpeta = $strNombreCarpeta.'/'.$arrDet->renglon;

		            //Asignar cadena con los nombres de los archivos
		            $arrDet->archivos = $this->get_verifar_archivo_registro($strNombreSubCarpeta);
				}

				//Asignar el total de archivos que contiene la carpeta del registro
				$arrDatos['total_archivos'] = $this->get_total_archivos_registro($strNombreCarpeta);
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
		$this->form_validation->set_rules('intPolizaID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intPolizaID');
		    $strEstatus = $this->input->post('strEstatus');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->polizas->set_estatus($intID, $strEstatus);
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

	//Método para descargar archivos de un registro
    public function descargar_archivos()
	{	
        //Variables que se utilizan para recuperar los valores de la vista
		$intPolizaID = $this->input->post('intPolizaID');
		$strFolio = $this->input->post('strFolio');

		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intPolizaID;
		//Asignar nombre de la carpeta zip
		$strNombreCarpetaZIP = 'POL_'.$strFolio.'.zip';

		//Hacer un llamado a la función para descargar el archivo
		$this->descargar_archivo_reg($strNombreCarpeta, NULL,  $strNombreCarpetaZIP);
	}
	
	//Método para regresar todos los registros activos en un autocomplete
	public function autocomplete()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$strDescripcion = trim($this->input->post('strDescripcion'));
		$strEstatus = $this->input->post('strEstatus');
		$intSucursalID = $this->input->post('intSucursalID');
		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->polizas->autocomplete($strDescripcion, $intSucursalID, $strEstatus);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value' => $arrCol->folio, 
		        						'data' => $arrCol->poliza_id);
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
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strModulo = trim($this->input->post('strModulo'));
		$strProceso = trim($this->input->post('strProceso'));
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strDetalles = $this->input->post('strDetalles');

		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->polizas->buscar(NULL, NULL, $dteFechaInicial, $dteFechaFinal, 
											   $strEstatus, $strModulo, $strProceso, $strBusqueda);
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal != '')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
			$strTituloRangoFechas .= ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
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
		$pdf->strLinea1 =  utf8_decode('LISTADO DE PÓLIZAS ').$strTituloRangoFechas;
		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA', 'TIPO', 'CONCEPTO',  'IMPORTE', 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(18, 18, 20, 83, 30, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L', 'R', 'C');
		//Establece la alineación de las celdas de la tabla detalles
	    $arrAlineacionDetalles = array('L', 'L', 'L', 'R', 'R');
	    //Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(22, 80, 15, 25, 25 );
		//Agregar la primer pagina
		$pdf->AddPage();
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo para obtener la información de las polizas de compra
			foreach ($otdResultado as $arrCol)
			{ 
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				//Array que se utiliza para agregar los detalles
		        $arrDetalles = array();
		        //Array que se utiliza para agregar los datos de un detalle
		        $arrAuxiliar = array();
		        //Variable que se utiliza para asignar el acumulado de los cargos
				$intAcumCargos = 0;
				//Seleccionar los detalles del registro
				$otdDetalles = $this->polizas->buscar_detalles($arrCol->poliza_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Variable que se utiliza para asignar el importe del cargo
						$intCargo = '';
						//Variable que se utiliza para asignar el importe del cargo con formato moneda
						$strCargo = '';
						//Variable que se utiliza para asignar el importe del abono con formato moneda
						$strAbono = '';
						//Variable que se utiliza para asignar la naturaleza
						$strNaturaleza = $arrDet->naturaleza;
						//Variable que se utiliza para asignar el importe
						$intImporte = $arrDet->importe;

						//Dependiendo de la naturaleza, asignar importe
						if($strNaturaleza == 'CARGO')
						{
							$strCargo =  '$'.number_format($arrDet->importe,5);
							$intCargo = $intImporte;
						}
						else
						{
							$strAbono = '$'.number_format($arrDet->importe,5);
						}

						//Definir valores del array auxiliar de información (para cada detalle)
						$arrAuxiliar["cuenta"] = $arrDet->cuenta;
						$arrAuxiliar["descripcion"] = utf8_decode($arrDet->cuenta_descripcion);
		                $arrAuxiliar["naturaleza"] = $arrDet->naturaleza;
		                $arrAuxiliar["cargo"] = $strCargo;
		                $arrAuxiliar["abono"] = $strAbono;
		                $arrAuxiliar["concepto"] = $arrDet->concepto;
		                $arrAuxiliar["referencia"] = $arrDet->referencia;
		                //Asignar datos al array
                        array_push($arrDetalles, $arrAuxiliar);
                        //Incrementar acumulados
						$intAcumCargos += $intCargo;
					}

				}//Cierre de verificación de detalles

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, $arrCol->fecha,  $arrCol->tipo, 
								utf8_decode($arrCol->concepto), '$'.number_format($intAcumCargos,2), 
								$arrCol->estatus), 
								$pdf->arrAlineacion,'ClippedCell');

				//Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
				//Módulo
				$pdf->Cell(13, 4, utf8_decode('MÓDULO:'), 0, 0, 'L', 0);
			    $pdf->ClippedCell(42, 4, $arrCol->modulo, 0, 0, 'L', 0);
		    	//Proceso
		    	$pdf->Cell(13, 4, 'PROCESO:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(60, 4,$arrCol->proceso, 0, 0, 'L', 0);
			    //Referencia
		    	$pdf->Cell(15, 4, 'REFERENCIA:', 0, 0, 'L', 0);
			    $pdf->ClippedCell(28, 4,$arrCol->referencia, 0, 0, 'L', 0);
		        
				//Si se cumple la sentencia mostrar detalles del registro
				if($arrDetalles && $strDetalles == 'SI')
				{
					$pdf->Ln(5);//Deja un salto de línea
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraDetalles);
					//Recorremos el arreglo 
			        foreach ($arrDetalles as $arrDet) 
			        {
			        	//Variable que se utiliza para asignar el concepto 
						$strConcepto = $arrDet['concepto'];
						//Variable que se utiliza para asignar la referencia  
						$strReferencia = $arrDet['referencia'];

					   //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array($arrDet['cuenta'], $arrDet['descripcion'], $arrDet['naturaleza'],  
									    $arrDet['cargo'], $arrDet['abono']),
					    				$arrAlineacionDetalles,'ClippedCell');

					    //Si existe concepto o referencia
						if($strConcepto != '' OR $strReferencia != '')
						{
							//Asigna el tipo y tamaño de letra
					        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
							//Si existe concepto
							if($strConcepto != '')
							{
								//Concepto
								$pdf->Cell(15, 4, 'CONCEPTO:', 0, 0, 'L', 0);
						    	$pdf->ClippedCell(55, 4, utf8_decode($strConcepto), 0, 0, 'L', 0);
							}

							//Si existe referencia
							if($strReferencia != '')
							{
								//Referencia
					    		$pdf->Cell(17, 4, 'REFERENCIA:', 0, 0, 'L', 0);
						   	    $pdf->ClippedCell(55, 4, utf8_decode($strReferencia), 0, 0, 'L', 0);
							}
							
					    	
						    $pdf->Ln(4);//Deja un salto de línea
						}

					}
				}//Cierre de verificación de detalles
				$pdf->Ln(5);//Deja un salto de línea
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
		$pdf->Output('polizas.pdf','I'); 
	}

	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro() 
	{	            
		//Variables que se utilizan para recuperar los valores de la vista
		$intPolizaID = $this->input->post('intPolizaID');
		
		//Seleccionar los datos del registro que coincide con el id (primer posición del arreglo)
	    $otdResultado = $this->polizas->buscar($intPolizaID);
		//Seleccionar los detalles del registro
		$otdDetalles = $this->polizas->buscar_detalles($intPolizaID);
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variable que se utiliza para asignar el acumulado de los cargos
		$intAcumCargos = 0;
		//Variable que se utiliza para asignar el acumulado de los abonos
		$intAcumAbonos = 0;
		//Variable que se utiliza para asignar el nombre del archivo PDF
		$strNombreArchivo  = 'poliza_';
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
	        //---------- DATOS DE LA PÓLIZA
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 42);
			$pdf->ClippedCell(185, 3, utf8_decode('PÓLIZA'), 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0); //establece el color de texto
			//Folio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, 46);
			$pdf->ClippedCell(10, 3, 'FOLIO');
			//Sucursal
			$pdf->SetXY(80, 46);
			$pdf->ClippedCell(15, 3, 'SUCURSAL');
			//Fecha
			$pdf->SetXY(160, 46);
			$pdf->ClippedCell(10, 3, 'FECHA');
			//Tipo de póliza
			$pdf->SetXY(15, 49);
			$pdf->ClippedCell(22, 03, utf8_decode('TIPO DE PÓLIZA'));
			//Estatus
			$pdf->SetXY(80, 49);
			$pdf->ClippedCell(22, 03, 'ESTATUS');
			//Módulo
			$pdf->SetXY(15, 52);
			$pdf->ClippedCell(22, 03, utf8_decode('MÓDULO'));
			//Proceso
			$pdf->SetXY(80, 52);
			$pdf->ClippedCell(22, 03, 'PROCESO');
			//Referencia
			$pdf->SetXY(160, 52);
			$pdf->ClippedCell(22, 03, 'REFERENCIA');
			//Concepto
			$pdf->SetXY(15, 55);
			$pdf->ClippedCell(22, 3, 'CONCEPTO');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Folio
			$pdf->SetXY(40, 46);
			$pdf->ClippedCell(30, 3, $otdResultado->folio);
			//Sucursal
			$pdf->SetXY(96, 46);
			$pdf->ClippedCell(30, 3, utf8_decode($otdResultado->sucursal));
			//Fecha
			$pdf->SetXY(180, 46);
			$pdf->ClippedCell(30, 3, $otdResultado->fecha);
			//Tipo de póliza
			$pdf->SetXY(40, 49);
			$pdf->ClippedCell(60, 3, $otdResultado->tipo);
			//Estatus
			$pdf->SetXY(96, 49);
			$pdf->ClippedCell(30, 3, $otdResultado->estatus);
			//Módulo
			$pdf->SetXY(40, 52);
			$pdf->ClippedCell(60, 3, $otdResultado->modulo);
			//Proceso
			$pdf->SetXY(96, 52);
			$pdf->ClippedCell(100, 3, $otdResultado->proceso);
			//Referencia
			$pdf->SetXY(180, 52);
			$pdf->ClippedCell(20, 3, $otdResultado->referencia);
			//Concepto
			$pdf->SetXY(40, 55);
			$pdf->ClippedCell(155, 3, utf8_decode($otdResultado->concepto));


			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DE LA PÓLIZA
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 60);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{

				//Tabla con los detalles de la póliza
				$pdf->SetXY(15, 60);
				//Crea los titulos de la cabecera
				$arrCabecera = array('Ren.', 'Cuenta', utf8_decode('Descripción'), 'Cargo', 'Abono');
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(15, 22, 98, 25, 25);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('C', 'L', 'L', 'R', 'R');
				//Recorre el array de títulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchura[$intCont], 3, $arrCabecera[$intCont], 1, 0, $arrAlineacion[$intCont], TRUE);
				}
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
				
				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDet)
				{ 
					$pdf->SetX(15);
					//Variable que se utiliza para asignar el concepto 
					$strConcepto = $arrDet->concepto;
					//Variable que se utiliza para asignar la referencia  
					$strReferencia = $arrDet->referencia;
					//Variable que se utiliza para asignar el importe del cargo
					$intCargo = 0;
					//Variable que se utiliza para asignar el importe del cargo con formato moneda
					$strCargo = '';
					//Variable que se utiliza para asignar el importe del abono
					$intAbono = 0;
					//Variable que se utiliza para asignar el importe del abono con formato moneda
					$strAbono = '';
					//Variable que se utiliza para asignar la naturaleza
					$strNaturaleza = $arrDet->naturaleza;
					//Variable que se utiliza para asignar el importe
					$intImporte = $arrDet->importe;


					//Dependiendo de la naturaleza, asignar importe
					if($strNaturaleza == 'CARGO')
					{
						$intCargo =  $intImporte;
						$strCargo = '$'.number_format($intImporte,2);
					}
					else
					{
						$intAbono =  $intImporte;
						$strAbono = '$'.number_format($intImporte,2);
					}


					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchura);
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($arrDet->renglon, 
								    utf8_decode($arrDet->cuenta),
								    utf8_decode($arrDet->cuenta_descripcion), $strCargo, 
								    $strAbono), 
									$arrAlineacion, 'ClippedCell');

					//Si existe concepto o referencia
					if($strConcepto != '' OR $strReferencia != '')
					{
						$pdf->SetX(15);
						//Asigna el tipo y tamaño de letra
				        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_PIE_PAGINA_PDF);
						//Si existe concepto
						if($strConcepto != '')
						{
							//Concepto
							$pdf->Cell(15, 4, 'CONCEPTO:', 0, 0, 'L', 0);
					    	$pdf->ClippedCell(60, 4, utf8_decode($strConcepto), 0, 0, 'L', 0);
						}

						//Si existe referencia
						if($strReferencia != '')
						{
							//Referencia
				    		$pdf->Cell(17, 4, 'REFERENCIA:', 0, 0, 'L', 0);
					   	    $pdf->ClippedCell(60, 4, utf8_decode($strReferencia), 0, 0, 'L', 0);
						}
						
				    	
					    $pdf->Ln(4);//Deja un salto de línea
					}

					//Incrementar acumulados
					$intAcumCargos += $intCargo;
					$intAcumAbonos += $intAbono;

				}

			}//Cierre de verificación de detalles
			
	    	//Dibuja una línea para separar la información de cada prospecto
	    	$pdf->Line(15, $pdf->GetY(), 200, $pdf->GetY());
	    	$pdf->Ln(1); //Deja un salto de línea
	    	//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
	    	//Total
			$pdf->SetX(120);
			$pdf->ClippedCell(30, 3, 'TOTALES:', 0, 0, 'R');
			//Acumulado del cargo
			$pdf->ClippedCell(25, 3, '$'.number_format($intAcumCargos,2), 0, 0, 'R');
			//Acumulado del abono
			$pdf->ClippedCell(25, 3, '$'.number_format($intAcumAbonos,2), 0, 0, 'R');
			
			//Fecha y hora de impresión (pie de pagina)
			$pdf->strUsuarioCreacion = $otdResultado->usuario_creacion;
			$pdf->dteFechaCreacion = $otdResultado->fecha_creacion;
			$pdf->strIncluirMembrete = 'SI';

			//Concatenar folio para identificar póliza
			$strNombreArchivo .= $otdResultado->folio;

		}//Cierre de verificación de información

		
		//Ejecutar la salida del reporte
		$pdf->Output($strNombreArchivo.'.pdf','I'); 
		
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strEstatus = trim($this->input->post('strEstatus'));
		$strModulo = trim($this->input->post('strModulo'));
		$strProceso = trim($this->input->post('strProceso'));
		$strBusqueda = trim($this->input->post('strBusqueda'));
		$strDetalles = $this->input->post('strDetalles');
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
		$otdResultado = $this->polizas->buscar(NULL, NULL, $dteFechaInicial, $dteFechaFinal, 
											   $strEstatus, $strModulo, $strProceso, $strBusqueda);
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal != '')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
			$strTituloRangoFechas .= ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		}
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE PÓLIZAS '.$strTituloRangoFechas);
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('C'.$intPosEncabezados, 'TIPO DE PÓLIZA')
        		 ->setCellValue('D'.$intPosEncabezados, 'CONCEPTO')
        		 ->setCellValue('E'.$intPosEncabezados, 'IMPORTE')
        		 ->setCellValue('F'.$intPosEncabezados, 'MÓDULO')
        		 ->setCellValue('G'.$intPosEncabezados, 'PROCESO')
        		 ->setCellValue('H'.$intPosEncabezados, 'REFERENCIA')
        		 ->setCellValue('I'.$intPosEncabezados, 'OBSERVACIONES')
                 ->setCellValue('J'.$intPosEncabezados, 'ESTATUS');

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
    			 ->getStyle('A10:J10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:J10')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:J10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si se cumple la sentencia dar estilo a la columna detalles
        if($strDetalles == 'SI')
        {
        	 //Combinar las siguientes celdas
	       	$objExcel->setActiveSheetIndex(0)
	       		    	->setCellValue('K'.$intPosEncabezados, 'RENGLÓN')
                        ->setCellValue('L'.$intPosEncabezados, 'CUENTA')
                        ->setCellValue('M'.$intPosEncabezados, 'DESCRIPCIÓN')
                        ->setCellValue('N'.$intPosEncabezados, 'NATURALEZA')
                        ->setCellValue('O'.$intPosEncabezados, 'CARGO')
			            ->setCellValue('P'.$intPosEncabezados, 'ABONO')
			            ->setCellValue('Q'.$intPosEncabezados, 'CONCEPTO')
			            ->setCellValue('R'.$intPosEncabezados,'REFERENCIA');

        	//Preferencias de color de relleno de celda 
        	$objExcel->getActiveSheet()
    			     ->getStyle('K'.$intPosEncabezados.':R'.$intPosEncabezados)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

    		 //Preferencias de color de texto de la celda 
	    	$objExcel->getActiveSheet()
	    			 ->getStyle('K'.$intPosEncabezados.':R'.$intPosEncabezados)
	    			 ->applyFromArray($arrStyleFuenteColumnas);
	    			 
	    	//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
	            	 ->getStyle('K'.$intPosEncabezados.':R'.$intPosEncabezados)
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
		       //Variable que se utiliza para asignar el acumulado de los cargos
				$intAcumCargos = 0;

				//Seleccionar los detalles del registro
				$otdDetalles = $this->polizas->buscar_detalles($arrCol->poliza_id);
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					//Variable que se utiliza para contar el número de detalles
				    $intContDetPol = 0;

				    //Si se cumple la sentencia mostrar detalles del registro
				    if($strDetalles == 'SI')
				    {
				    	//Asignar el número de detalles
				    	$intNumDetalles = count($otdDetalles);
				    }

					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{
						//Variable que se utiliza para asignar el importe del cargo
						$intCargo = 0;
						//Variable que se utiliza para asignar el importe del cargo con formato moneda
						$strCargo = '';
						//Variable que se utiliza para asignar el importe del abono con formato moneda
						$strAbono = '';
						//Variable que se utiliza para asignar la naturaleza
						$strNaturaleza = $arrDet->naturaleza;
						//Variable que se utiliza para asignar el importe
						$intImporte = $arrDet->importe;

						//Dependiendo de la naturaleza, asignar importe
						if($strNaturaleza == 'CARGO')
						{
							$intCargo =  $intImporte;
							$strCargo =  $intImporte;
						}
						else
						{
							$strAbono =  $intImporte;
						}

                        //Agregar datos al array
                        $arrDetalles[$intContDetPol]['renglon'] = $arrDet->renglon;
			        	$arrDetalles[$intContDetPol]['cuenta'] = $arrDet->cuenta;
			        	$arrDetalles[$intContDetPol]['cuenta_descripcion'] = $arrDet->cuenta_descripcion;
			        	$arrDetalles[$intContDetPol]['naturaleza'] = $arrDet->naturaleza;
			        	$arrDetalles[$intContDetPol]['cargo'] = $strCargo;
			        	$arrDetalles[$intContDetPol]['abono'] = $strAbono;
			        	$arrDetalles[$intContDetPol]['concepto'] = $arrDet->concepto;
			        	$arrDetalles[$intContDetPol]['referencia'] = $arrDet->referencia;

                        //Incrementar acumulados
						$intAcumCargos += $intCargo;

						//Incrementar el contador por cada registro
	                    $intContDetPol++;
					}

				}//Cierre de verificación de detalles


				//Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    {
			    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
	                         ->setCellValue('B'.$intFila, $arrCol->fecha)
	                         ->setCellValue('C'.$intFila, $arrCol->tipo)
	                         ->setCellValue('D'.$intFila, $arrCol->concepto)
	                         ->setCellValue('E'.$intFila, $intAcumCargos)
	                         ->setCellValue('F'.$intFila, $arrCol->modulo)
	                         ->setCellValue('G'.$intFila, $arrCol->proceso)
	                         ->setCellValue('H'.$intFila, $arrCol->referencia)
	                         ->setCellValue('I'.$intFila, $arrCol->observaciones)
	                         ->setCellValue('J'.$intFila, $arrCol->estatus);

	                //Si se cumple la sentencia mostrar detalles del registro
					if($arrDetalles && $strDetalles == 'SI')
					{
						//Agregar información del detalle
						$objExcel->setActiveSheetIndex(0)
								 ->setCellValue('K'.$intFila, $arrDetalles[$intContDet]['renglon'])
						 		 ->setCellValue('L'.$intFila, $arrDetalles[$intContDet]['cuenta'])
						 		 ->setCellValue('M'.$intFila, $arrDetalles[$intContDet]['cuenta_descripcion'])
						 		 ->setCellValue('N'.$intFila, $arrDetalles[$intContDet]['naturaleza'])
						         ->setCellValue('O'.$intFila, $arrDetalles[$intContDet]['cargo'])
						         ->setCellValue('P'.$intFila, $arrDetalles[$intContDet]['abono'])
						         ->setCellValue('Q'.$intFila, $arrDetalles[$intContDet]['concepto'])
						         ->setCellValue('R'.$intFila, $arrDetalles[$intContDet]['referencia']);
					}

	                //Incrementar el indice para escribir los datos del siguiente registro
                    $intFila++;
			    }

                //Incrementar el contador por cada registro
				$intContador++;
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

           	$objExcel->getActiveSheet()
            		 ->getStyle('O'.$intFilaInicial.':'.'P'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00000');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'B'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
		        	 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

            $objExcel->getActiveSheet()
                	 ->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('N'.$intFilaInicial.':'.'N'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
		        	 ->getStyle('K'.$intFilaInicial.':'.'K'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);

    		$objExcel->getActiveSheet()
		        	 ->getStyle('O'.$intFilaInicial.':'.'P'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentRight);

			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('J'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('J'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}//Cierre de verificación de información
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'polizas.xls', 'pólizas', $intFila);
	}


	/*******************************************************************************************************************
	Funciones de la tabla polizas_detalles
	*********************************************************************************************************************/
	//Método para renombrar carpetas de los renglones anteriores (existentes en la base de datos) del registro
	public function renombrar_carpetas($intPolizaID, $strRenglonesActuales, $strRenglonesAnteriores)
	{
		
		//Definir ubicación de la carpeta
		$strCarpetaDestino = $this->archivo['strCarpetaDestino'].$intPolizaID; 

		//Hacer un llamado a la función para renombrar las subcarpetas del registro
		$this->renombrar_subcarpetas_reg($strCarpetaDestino, $strRenglonesActuales, $strRenglonesAnteriores);
	}

	//Método para eliminar carpetas de los renglones no existentes en los detalles del registro
	public function eliminar_carpetas($intPolizaID, $strRenglones)
	{
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intPolizaID; 
		
		//Hacer un llamado a la función para eliminar las subcarpetas del registro
	    $this->eliminar_carpeta_reg($strNombreCarpeta, NULL, NULL, $strRenglones);
	}

	//Método para subir los archivos de un detalle
    public function subir_archivos()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$intPolizaID = $_POST["intPolizaID_detalles_polizas_contabilidad"];
		$intRenglon = $_POST["intRenglon_detalles_polizas_contabilidad"];
		$strBotonArchivoID = $_FILES["archivo_varios_detalles_polizas_contabilidad"];
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $this->archivo['strCarpetaDestino'].$intPolizaID; 
		//Definir ubicación de la subcarpeta
		$strNombreSubCarpeta = $strNombreCarpeta.'/'.$intRenglon; 

		//Hacer un llamado a la función para subir el archivo
		$this->subir_archivo_reg($strBotonArchivoID, $this->archivo['strCarpetaPrincipal'], 
								 $this->archivo['strCarpetaDestino'], 
							     $strNombreCarpeta, NULL, TRUE, $strNombreSubCarpeta);
		
	}


	//Método para descargar archivos de un registro
    public function descargar_archivos_detalle()
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$intPolizaID = $this->input->post('intPolizaID');
		$intRenglon = $this->input->post('intRenglonID');

		//Definir ubicación de la carpeta principal
		$strCarpetaDestino = $this->archivo['strCarpetaDestino'].$intPolizaID.'/';
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $strCarpetaDestino.$intRenglon;
		//Asignar nombre de la carpeta zip
		$strNombreCarpetaZIP = 'POLR_'.$intPolizaID.'_'.$intRenglon.'.zip';

		//Hacer un llamado a la función para descargar el archivo
		$this->descargar_archivo_reg($strNombreCarpeta, NULL,  $strNombreCarpetaZIP);

	}


	//Método para eliminar los archivos de un registro
	public function eliminar_carpeta_detalle()
	{	
		
		//Variables que se utilizan para recuperar los valores de la vista 
		$intPolizaID = $this->input->post('intPolizaID');
		$intRenglon = $this->input->post('intRenglon');
		//Definir ubicación de la carpeta principal
		$strCarpetaDestino = $this->archivo['strCarpetaDestino'].$intPolizaID.'/';
		//Definir ubicación de la carpeta
		$strNombreCarpeta = $strCarpetaDestino.'/'.$intRenglon;

		//Hacer un llamado a la función para eliminar la carpeta
		$this->eliminar_carpeta_reg($strNombreCarpeta, TRUE, $strCarpetaDestino);
	}
}