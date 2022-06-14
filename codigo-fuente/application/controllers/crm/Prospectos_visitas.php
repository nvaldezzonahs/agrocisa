<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prospectos_visitas extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de prospectos
		$this->load->model('crm/prospectos_model', 'prospectos');
		//Cargamos el modelo de vendedores
		$this->load->model('crm/vendedores_model', 'vendedores');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('crm/prospectos_visitas', $arrDatos);
	}

	/*******************************************************************************************************************
	Funciones de la tabla prospectos_visitas
	*********************************************************************************************************************/
	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->prospectos->filtro_visitas($this->input->post('intProspectoID'),
													$this->input->post('dteFechaInicial'),
													$this->input->post('dteFechaFinal'),
													$this->input->post('intModuloID'),
													$this->input->post('intVendedorID'),
					                                $config['per_page'],
					                                $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Asignar el estatus del prospecto
		$strEstatusProspecto = $this->input->post('strEstatusProspecto');

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['visitas'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionCancelar = 'no-mostrar';
			$arrDet->mostrarAccionSeguimiento = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			
    		//Si el usuario cuenta con el permiso de acceso EDITAR
			if (in_array('EDITAR', $arrPermisos))
			{	
				//Si el estatus del prospecto es  INACTIVO
				if($strEstatusProspecto == 'INACTIVO')
				{
					//Asignar cadena vacia para mostrar botón Ver
					$arrDet->mostrarAccionVerRegistro = '';
				}
				else
				{
					//Asignar cadena vacia para mostrar botón Editar
					$arrDet->mostrarAccionEditar = '';
					//Asignar cadena vacia para mostrar botón Seguimiento
	    			$arrDet->mostrarAccionSeguimiento = '';
				}
				
				
			}

			//Si el usuario cuenta con el permiso de acceso CANCELAR
			if (in_array('CANCELAR', $arrPermisos) && $strEstatusProspecto != 'INACTIVO')
			{
				//Asignar cadena vacia para mostrar botón Cancelar
				$arrDet->mostrarAccionCancelar = '';
			}

			//Si el usuario cuenta con el permiso de acceso IMPRIMIR REGISTRO
			if (in_array('IMPRIMIR REGISTRO', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón Imprimir
        		$arrDet->mostrarAccionImprimir = '';
			}
			
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['visitas'],
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
		$objProspectoVisita = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objProspectoVisita->intProspectoVisitaID = $this->input->post('intProspectoVisitaID');
		//Si no existe id de la referencia asignar valor nulo
		$objProspectoVisita->intProspectoVisitaReferencia = (($this->input->post('intProspectoVisitaReferencia') !== '') ? 
						  								      $this->input->post('intProspectoVisitaReferencia') : NULL);
		$objProspectoVisita->intProspectoID = $this->input->post('intProspectoID');
		$objProspectoVisita->intModuloID = $this->input->post('intModuloID');
	    //Si no existe id de la estrategia asignar valor nulo
		$objProspectoVisita->intEstrategiaID = (($this->input->post('intEstrategiaID') !== '') ? 
						  						 $this->input->post('intEstrategiaID') : NULL);
		//Si no existe id de la descripción de maquinaria asignar valor nulo
		$objProspectoVisita->intMaquinariaDescripcionID = (($this->input->post('intMaquinariaDescripcionID') !== '') ? 
						  						 			$this->input->post('intMaquinariaDescripcionID') : NULL);
		$objProspectoVisita->dteFecha = $this->input->post('dteFecha');
		$objProspectoVisita->strComentario = mb_strtoupper(trim($this->input->post('strComentario')));
		$objProspectoVisita->strMadurez = $this->input->post('strMadurez');
		$objProspectoVisita->intMotivoVisitaID = $this->input->post('intMotivoVisitaID');
		//Si no existe fecha asignar 2000-01-01
		$objProspectoVisita->dteProbabilidadCompra = (($this->input->post('dteProbabilidadCompra') !== '') ? 
						  						 	   $this->input->post('dteProbabilidadCompra') : '2000-01-01');
		$objProspectoVisita->strCondicionesPago = $this->input->post('strCondicionesPago');
		$objProspectoVisita->strPlazo = $this->input->post('strPlazo');
		$objProspectoVisita->dteProximaVisita = $this->input->post('dteProximaVisita');
		$objProspectoVisita->intUsuarioID = $this->session->userdata('usuario_id');
		
		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objProspectoVisita->intProspectoVisitaID))
		{
			$bolResultado = $this->prospectos->modificar_visitas($objProspectoVisita);
		}
		else
		{ 
			$bolResultado = $this->prospectos->guardar_visitas($objProspectoVisita);
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
		$intID = $this->input->post('intProspectoVisitaID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->prospectos->buscar_visitas($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Asignar primer elemento del array resultado
			$arrDatos['row'] = $otdResultado[0];
		}

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte()
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$intProspectoID =  $this->input->post('intProspectoID');
		$dteFechaInicial =  $this->input->post('dteFechaInicial');
		$strHoraInicial =  $this->input->post('strHoraInicial');
		$dteFechaFinal =  $this->input->post('dteFechaFinal');
		$strHoraFinal =  $this->input->post('strHoraFinal');
		$intModuloID =  $this->input->post('intModuloID');
		$intVendedorID =  $this->input->post('intVendedorID');

		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado de visitas de un prospecto
			$this->get_reporte_prospecto($intProspectoID, $dteFechaInicial, $strHoraInicial, 
										 $dteFechaFinal, $strHoraFinal, $intModuloID, $intVendedorID);
		}
		else
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado general de visitas
			$this->get_reporte_general($dteFechaInicial, $strHoraInicial, $dteFechaFinal,  $strHoraFinal,
									   $intModuloID, $intVendedorID);
		}

	}

	//Método para generar un reporte PDF con el listado de visitas de un prospecto
    public function get_reporte_prospecto($intProspectoID, $dteFechaInicial, $strHoraInicial,
    									  $dteFechaFinal, $strHoraFinal, $intModuloID, $intVendedorID = NULL)
    {
    	
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Variable para concatenar los vendedores de las visitas
		$strListaVendedores = '';
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Seleccionar los datos del prospecto que coincide con el id
		$otdProspecto = $this->prospectos->buscar($intProspectoID); 
		//Tomar primer elemento del array
		$otdProspecto = $otdProspecto[0]; 
		
		//Seleccionar los datos de las visitas
	    $otdVisitas = $this->prospectos->buscar_visitas(NULL, $intProspectoID, $dteFechaInicial, 
	    										        $dteFechaFinal, $intModuloID, $intVendedorID); 
	    
    	//Seleccionar los datos de los vendedores por módulo
    	$otdVendedores = $this->prospectos->buscar_vendedores_visitas($intProspectoID, $dteFechaInicial, 
    																  $dteFechaFinal, $intModuloID, 
    																  $intVendedorID); 
	   
	    //Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
			$strTituloRangoFechas .= ' HORA: '.$strHoraInicial;
			$strTituloRangoFechas .= ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
			$strTituloRangoFechas .= ' HORA: '.$strHoraFinal;
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
		$pdf->strLinea1=  'VISITAS '.$strTituloRangoFechas;
		//Variable que se utiliza para asignar código del prospecto (y poder identificar reporte)
		$strCodigo  = '';
		//Agregar la primer pagina
		$pdf->AddPage();
		//Verificar si hay información del registro
		if($otdProspecto)
		{
			//Asignar código del prospecto 
			$strCodigo = $otdProspecto->codigo;
			//Cambiar color de relleno de la celda
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//Hacer un llamado a la función para escribir los datos del prospecto
			$this->get_datos_prospecto_pdf($pdf, $otdProspecto);

			//Verificar si existe información de visitas 
			if($otdVisitas)
			{
				//Vendedor(es) 
				//Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->Cell(190, 6, 'VENDEDOR(ES)', 0, 1, 'L', 0);

				//Verificar si existe información de vendedores 
				if($otdVendedores)
				{
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
					//Recorremos el arreglo
					foreach ($otdVendedores as $arrVend)
					{
						//Variable que se utiliza para asignar el nombre del vendedor
						$strVendedor  = '';

						//Si existe id del módulo
						if($intModuloID > 0)
						{
							//Asignar nombre del vendedor
							$strVendedor = $arrVend->vendedor;
							
						}
						else
						{
							//Si existe vendedor del módulo
							if($arrVend->vendedor != '')
							{
								//Concatenar los datos del vendedor
								$strVendedor = $arrVend->modulo.': '.$arrVend->vendedor;
							}
							
						}
						
						//Vendedor
						$pdf->ClippedCell(190, 3, utf8_decode($strVendedor), 0, 1, 'L', 0);
						$pdf->Ln(1);//Deja un salto de línea

					} 

				}//Cierre de verificación de vendedores
				

				//$pdf->ClippedCell(190, 6, utf8_decode($strListaVendedores), 0, 1, 'L', 0);
				$pdf->Ln(4);//Deja un salto de línea

				//Visitas
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
				$pdf->Cell(190, 6, utf8_decode('VISITAS'), 1, 1, 'C', 1);
				$pdf->SetTextColor(0); //establece el color de texto negro
				//Crea los titulos de la cabecera
				$arrCabeceraVis = array('VISITA', utf8_decode('PRÓXIMA'), utf8_decode('MÓDULO'), 
									    'MADUREZ', 'COMENTARIOS');
				//Establece el ancho de las columnas de cabecera
				$arrAnchuraVis = array(25, 25, 23, 18, 99);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacionVis = array('C', 'C', 'L', 'C', 'L');
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraVis);
				//Recorre el array de titulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabeceraVis); $intCont++) 
				{ 
					$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				   	//inserta los titulos de la cabecera
				    $pdf->Cell($arrAnchuraVis[$intCont], 7, $arrCabeceraVis[$intCont], 1, 0, 
				    		   $arrAlineacionVis[$intCont], TRUE);
				}
				$pdf->SetTextColor(0); //establece el color de texto negro
				$pdf->Ln(); //Deja un salto de linea
				//Recorremos el arreglo 
				foreach ($otdVisitas as $arrVis)
				{ 
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				    $pdf->Row(array($arrVis->fecha, $arrVis->proxima_visita, $arrVis->modulo, 
				    				$arrVis->madurez, utf8_decode($arrVis->comentario)), 
				                    $arrAlineacionVis);
				    //Incrementar el contador por cada registro
					$intContador++;
				}
				//Asigna el tipo y tamaño de letra para los totales
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Escribir totales
		    	$pdf->Cell(172,4,'TOTAL: ', 0, 0, 'R');  
		    	//Total de registros
	            $pdf->Cell(18,4,$intContador, 0, 0, 'R');
			}//Cierre de verificación de visitas
		}//Cierre de verificación de información
		//Ejecutar la salida del reporte
		$pdf->Output('visitas_'.$strCodigo.'.pdf','I');
    }


    //Método para generar un reporte PDF con el listado general de visitas
    public function get_reporte_general($dteFechaInicial, $strHoraInicial, $dteFechaFinal, $strHoraFinal, 
    									$intModuloID, $intVendedorID)
    {

		//Variable que se utiliza pra asignar el id actual del vendedor
		$intVendedorIDActual = 0;
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Variable que se utiliza para contar el número de registros por vendedor
		$intTotalVisitasVendedor = 0;
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
	    $otdResultado = $this->prospectos->buscar_visitas(NULL, NULL, $dteFechaInicial, $dteFechaFinal, 
	    												  $intModuloID, $intVendedorID, 'general'); 
	    //Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
			$strTituloRangoFechas .= ' HORA: '.$strHoraInicial;
			$strTituloRangoFechas .= ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
			$strTituloRangoFechas .= ' HORA: '.$strHoraFinal;
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
		$pdf->strLinea1=  'LISTADO DE VISITAS '.$strTituloRangoFechas;
		
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('PROSPECTO', 'VISITA', utf8_decode('PRÓXIMA'), 
							       utf8_decode('MÓDULO'), 'COMENTARIOS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(45, 25, 25, 23, 72);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'C', 'L', 'L');
		//Establece el ancho de las columnas del vendedor
		$arrAnchuraVendedor = array(20, 170);
		//Establece la alineación de las celdas del vendedor
		$arrAlineacionVendedor = array('L', 'L');
		//Agregar la primer pagina
		$pdf->AddPage();

		//Establecer el color de fondo para la cabecera
		$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);		
	
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				
				//Si es el primer registro y no existe id del vendedor
      			if($intContador === 0 && $arrCol->vendedor_id === NULL)
      			{
					//Asignar id del vendedor actual
      				$intVendedorIDActual = $arrCol->vendedor_id;
      			}

				//Si el vendedor actual es igual a cero (primer vendedor)
	      		if ($intVendedorIDActual === 0 && $arrCol->vendedor_id > 0)
	      		{
	      			//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
      				//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraVendedor);
	                //Vendedor (se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
		        	$pdf->Row(array('VENDEDOR|Negrita', utf8_decode($arrCol->vendedor)), 
							     $arrAlineacionVendedor, 'ClippedCell');
		        	//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

					//Limpiar las siguientes variables (por cada vendedor recorrido)
      				$intVendedorIDActual = $arrCol->vendedor_id;
      				$intTotalVisitasVendedor = 0;
	      		}

	      		//Si el vendedor actual es diferente al anterior
	      		if($intVendedorIDActual != $arrCol->vendedor_id && $arrCol->vendedor_id !== NULL)
	      		{
					$pdf->Ln(1);//Deja un salto de línea
					//Asigna el tipo y tamaño de letra para los totales
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Escribe la cadena concatenada con el total de registros
					$pdf->Cell(0,3,'VISITAS: '.$intTotalVisitasVendedor, 0, 0, 'R');
	      			$pdf->Ln(4); //Deja un salto de línea
	      			//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
	      			//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraVendedor);
	                //Vendedor (se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
		        	$pdf->Row(array('VENDEDOR|Negrita', utf8_decode($arrCol->vendedor)), 
							     $arrAlineacionVendedor, 'ClippedCell');
		        	//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
					$pdf->Ln(1); //Deja un salto de línea
	      			//Limpiar las siguientes variables (por cada vendedor recorrido)
	      			$intVendedorIDActual = $arrCol->vendedor_id;
	      			$intTotalVisitasVendedor = 0;
	      		}

	      		//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				$pdf->SetTextColor(0); //Establecer el color de texto por defecto

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol->prospecto), $arrCol->fecha, 
								$arrCol->proxima_visita, $arrCol->modulo, 
								utf8_decode($arrCol->comentario)), 
								$pdf->arrAlineacion);

				//Incrementar el contador por cada registro
				$intContador++;
				//Incrementar el contador por cada vendedor
				$intTotalVisitasVendedor++;
			}

			//Escribir las visitas del último vendedor
	   		if($intVendedorIDActual > 0)
			{
				$pdf->Ln();//Deja un salto de línea
				//Asigna el tipo y tamaño de letra para los totales
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Escribe la cadena concatenada con el total de registros
				$pdf->Cell(0,3,'VISITAS: '.$intTotalVisitasVendedor, 0, 0, 'R');
			}
		}
		//Espacios de salto de línea
		$pdf->Ln();
		//Asigna el tipo y tamaño de letra para los totales
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Escribe la cadena concatenada con el total de registros
		$pdf->Cell(0,3,'VISITAS TOTALES: '.$intContador, 0, 0, 'R');
		//Ejecutar la salida del reporte
		$pdf->Output('visitas.pdf','I');
    }


    //Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$intProspectoVisitaID = $this->input->post('intProspectoVisitaID');
		$intProspectoID = $this->input->post('intProspectoID');

		//Seleccionar los datos de la visita que coincide con el id
	    $otdVisita = $this->prospectos->buscar_visitas($intProspectoVisitaID);
		//Seleccionar los datos del prospecto que coincide con el id
		$otdProspecto = $this->prospectos->buscar($intProspectoID); 
		//Tomar primer elemento del array
		$otdProspecto = $otdProspecto[0]; 

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  '';
		//Variable que se utiliza para asignar código del prospecto (y poder identificar reporte)
		$strCodigo  = '';
		//Agregar la primer pagina
		$pdf->AddPage();
		//Verificar si hay información del registro
		if($otdVisita)
		{
			//Asignar primer elemento del array resultado
	        $otdVisita =  $otdVisita[0];
			//Asignar código del prospecto 
			$strCodigo = $otdProspecto->codigo;
			//Cambiar color de relleno de la celda
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->Ln(10);//Espacios de salto de línea
			//Hacer un llamado a la función para escribir los datos del prospecto
			$this->get_datos_prospecto_pdf($pdf, $otdProspecto);

			//Verificar si existe vendedor
			if($otdVisita->vendedor_id > 0)
			{
				//Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->Cell(33, 6, 'VENDEDOR', 0, 0, 'L', 0);
				//Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->ClippedCell(157, 6, utf8_decode($otdVisita->vendedor), 0, 1, 'L', 0);
			}

			//Datos de la visita
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, utf8_decode('VISITA'), 0, 1, 'C', 1);
			$pdf->SetTextColor(0); //establece el color de texto negro
			//Fecha de la visita
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(23, 5, 'VISITA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(30, 5, $otdVisita->fecha, 0, 0, 'L', 0);
			//Fecha de la próxima visita
	        //Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(26, 5, utf8_decode('PRÓXIMA VISITA'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(30, 5, $otdVisita->proxima_visita, 0, 0, 'L', 0);
			//Módulo
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(15, 5, utf8_decode('MÓDULO'), 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(43, 5,  $otdVisita->modulo, 0, 0, 'L', 0);
			//Madurez
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(18, 5, 'MADUREZ', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(16, 5,  $otdVisita->madurez, 0, 1, 'L', 0);
			//Estrategia
	        //Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(23, 5, 'ESTRATEGIA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(86, 5, $otdVisita->estrategia, 0, 1, 'L', 0);

			//Si existe id de la descripción de maquinaria
			if($otdVisita->maquinaria_descripcion_id > 0)
			{
				//Descripción de maquinaria
		        //Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->Cell(48, 5, utf8_decode('DESCRIPCIÓN DE MAQUINARIA'), 0, 0, 'L', 0);
				//Asigna el tipo y tamaño de letra
		        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->ClippedCell(142, 5, utf8_decode($otdVisita->maquinaria_descripcion), 0, 1, 'L', 0);
			}
			
			//Comentarios
	        //Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(190, 5, 'COMENTARIOS', 0, 1, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->MultiCell(190, 4, utf8_decode($otdVisita->comentario), 0, 'J', 0);
			

			//Motivo
	        //Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(23, 5, 'MOTIVO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(86, 5, $otdVisita->motivo_visita, 0, 0, 'L', 0);
			//Probabilidad de compra
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(43, 5, 'PROBABILIDAD DE COMPRA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(38, 5, utf8_decode($otdVisita->probabilidad_compra), 0, 1, 'L', 0);
			//Condiciones de pago
	        //Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(35, 5, 'CONDICIONES DE PAGO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(74, 5, $otdVisita->condiciones_pago, 0, 0, 'L', 0);
			//Plazo
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(15, 5, 'PLAZO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(65, 5,  utf8_decode($otdVisita->plazo), 0, 1, 'L', 0);

			//Fecha y hora de impresión (pie de pagina)
		   $pdf->strUsuarioCreacion = $otdVisita->usuario_creacion;
		   $pdf->dteFechaCreacion = $otdVisita->fecha_creacion;

			
		}//Cierre de verificación de información
		//Ejecutar la salida del reporte
		$pdf->Output('visita_'.$strCodigo.'.pdf','I'); 
	}


	//Función que se utiliza para escribir los datos del prospecto en el archivo PDF
	public function get_datos_prospecto_pdf($pdf, $otdProspecto)
	{
		//Seleccionar los datos de las actividades
		$otdActividades = $this->prospectos->buscar_actividades($otdProspecto->prospecto_id, 'lista');
		//Seleccionar los datos de los cultivos
		$otdCultivos = $this->prospectos->buscar_cultivos($otdProspecto->prospecto_id, 'lista');

		//Código del prospecto
        //Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(33, 5, utf8_decode('CÓDIGO'), 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(157, 5, $otdProspecto->codigo, 0, 1, 'L', 0);
		//Nombre comercial
        //Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(33, 5, 'NOMBRE COMERCIAL', 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(157, 5, utf8_decode($otdProspecto->nombre_comercial), 0, 1, 'L', 0);
		//Domicilio
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(190, 5, 'DOMICILIO', 0, 1, 'L', 0);
		//Calle
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(33, 5, 'CALLE', 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(72, 5, utf8_decode($otdProspecto->calle), 0, 0, 'L', 0);
		//Número exterior
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(22, 5, 'NO. EXTERIOR', 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(18, 5, $otdProspecto->numero_exterior, 0, 0, 'L', 0);
		//Número interior
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(25, 5, 'NO. INTERIOR', 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(20, 5, utf8_decode($otdProspecto->numero_interior), 0, 1, 'L', 0);
		//Colonia
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(33, 5, 'COLONIA', 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(72, 5, utf8_decode($otdProspecto->colonia), 0, 0, 'L', 0);
		//Código postal
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(8, 5, 'C.P.', 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(14, 5, $otdProspecto->codigo_postal, 0, 0, 'L', 0);
		//Localidad
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(18, 5, 'LOCALIDAD', 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(45, 5, utf8_decode($otdProspecto->localidad), 0, 1, 'L', 0);
		//Referencia
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(33, 5, 'REFERENCIA', 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(72, 5, utf8_decode($otdProspecto->referencia), 0, 0, 'L', 0);
		//Municipio
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(22, 5, 'MUNICIPIO', 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(63, 5, utf8_decode($otdProspecto->municipio), 0, 1, 'L', 0);
		//Estado
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(33, 5, 'ESTADO', 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(72, 5, utf8_decode($otdProspecto->estado), 0, 0, 'L', 0);
		//País
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(22, 5, utf8_decode('PAÍS'), 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(63, 5, utf8_decode($otdProspecto->pais), 0, 1, 'L', 0);
		//Datos de contacto
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(190, 5, 'DATOS DE CONTACTO', 0, 1, 'L', 0);
		//Nombre
        //Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(33, 5, 'NOMBRE', 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(72, 5, utf8_decode($otdProspecto->contacto_nombre), 0, 0, 'L', 0);
		//Fecha de nacimiento
        //Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(25, 5, 'FECHA DE NAC.', 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(20, 5, utf8_decode($otdProspecto->fecha_nacimiento), 0, 1, 'L', 0);
		//Teléfonos
        //Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(33, 5, utf8_decode('TELÉFONOS'), 0, 0, 'L', 0);
		//Variables que se utilizan para asignar datos de los teléfono del contacto
		$strTelefonoContacto = (($otdProspecto->contacto_telefono !== NULL && 
								 empty($otdProspecto->contacto_telefono) === FALSE) ?
                                 $otdProspecto->contacto_telefono : '');

		$strCelularContacto = (($otdProspecto->contacto_celular !== NULL && 
								 empty($otdProspecto->contacto_celular) === FALSE) ?
                                 'CEL. '.$otdProspecto->contacto_celular : '');

		//Concatenar los datos de los teléfonos
		$strTelefonosContacto = $strTelefonoContacto.' '.$strCelularContacto;
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(42, 5, $strTelefonosContacto, 0, 0, 'L', 0);
		//Extensión
        //Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(20, 5, utf8_decode('EXTENSIÓN'), 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(10, 5, $otdProspecto->contacto_extension, 0, 0, 'L', 0);
		//Correo electrónico
        //Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(15, 5, 'CORREO', 0, 0, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->ClippedCell(70, 5, utf8_decode($otdProspecto->contacto_correo_electronico), 0, 1, 'L', 0);
        //Hobbies
        //Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->Cell(190, 5, 'HOBBIES', 0, 1, 'L', 0);
		//Asigna el tipo y tamaño de letra
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		$pdf->MultiCell(190, 4, utf8_decode($otdProspecto->contacto_hobbies), 0, 'J', 0);
		//Número de hectáreas
		//Concatenar datos para el número de hectáreas
		$strNumeroHectareas = (($otdProspecto->hectareas_temporal > 0) ?
                            	'TEMPORAL - '.$otdProspecto->hectareas_temporal : '');
		$strNumeroHectareas .= (($otdProspecto->hectareas_riego > 0) ?
                            	', RIEGO - '.$otdProspecto->hectareas_riego : '');
		$strNumeroHectareas .= (($otdProspecto->hectareas_otras > 0) ?
                            	', OTRAS - '.$otdProspecto->hectareas_otras : '');
		//Si existen número de hectáreas
		if($strNumeroHectareas != '')
		{
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(190, 5, utf8_decode('NÚMERO DE HECTÁREAS'), 0, 1, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(190, 5, utf8_decode($strNumeroHectareas), 0, 1, 'L', 0);
		}

		//Hectáreas por tipo de terreno
		//Concatenar datos para el número de hectáreas por tipo de terreno
		$strNumeroTerrenos = (($otdProspecto->terreno_arenoso > 0) ?
                            	'ARENOSO - '.$otdProspecto->terreno_arenoso : '');
		$strNumeroTerrenos .= (($otdProspecto->terreno_arcilloso > 0) ?
                            	', ARCILLOSO - '.$otdProspecto->terreno_arcilloso : '');
		$strNumeroTerrenos .= (($otdProspecto->terreno_compacto > 0) ?
                            	', COMPACTO - '.$otdProspecto->terreno_compacto : '');
		$strNumeroTerrenos .= (($otdProspecto->terreno_pedregoso > 0) ?
                            	', PEDREGOSO - '.$otdProspecto->terreno_pedregoso : '');
		$strNumeroTerrenos .= (($otdProspecto->terreno_otros > 0) ?
                            	', OTROS - '.$otdProspecto->terreno_otros : '');
		//Si existen número de terrenos
		if($strNumeroTerrenos != '')
		{
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(190, 5, utf8_decode('HECTÁREAS POR TIPO DE TERRENO'), 0, 1, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(190, 5, utf8_decode($strNumeroTerrenos), 0, 1, 'L', 0);
		}

		//Verificar si existe información de actividades 
		if($otdActividades->lista !== NULL)
		{
		//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(190, 5, 'ACTIVIDADES', 0, 1, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(190, 5, utf8_decode($otdActividades->lista), 0, 1, 'L', 0);
		}//Cierre de verificación de actividades

		//Verificar si existe información de cultivos 
		if($otdCultivos->lista !== NULL)
		{
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(190, 5, 'CULTIVOS', 0, 1, 'L', 0);
			//Asigna el tipo y tamaño de letra
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(190, 5, utf8_decode($otdCultivos->lista), 0, 1, 'L', 0);
		}//Cierre de verificación de cultivos

	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$intProspectoID =  $this->input->post('intProspectoID');
		$dteFechaInicial =  $this->input->post('dteFechaInicial');
		$strHoraInicial =  $this->input->post('strHoraInicial');
		$dteFechaFinal =  $this->input->post('dteFechaFinal');
		$strHoraFinal =  $this->input->post('strHoraFinal');
		$intModuloID =  $this->input->post('intModuloID');
		$intVendedorID =  $this->input->post('intVendedorID');

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
		$otdResultado = $this->prospectos->buscar_visitas(NULL, $intProspectoID, $dteFechaInicial, $dteFechaFinal, 
														  $intModuloID, $intVendedorID); 
		 //Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
			$strTituloRangoFechas .= ' HORA: '.$strHoraInicial;
			$strTituloRangoFechas .= ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
			$strTituloRangoFechas .= ' HORA: '.$strHoraFinal;
		}

     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE VISITAS '.$strTituloRangoFechas);
	    //Si existe id del vendedor
		if($intVendedorID > 0)
		{   //Seleccionar los datos del vendedor que coincide con el id
			$otdVendedor =  $this->vendedores->buscar($intVendedorID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A8', 'VENDEDOR: '.$otdVendedor->empleado);
		}
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'PROSPECTO')
        		 ->setCellValue('B'.$intPosEncabezados, 'VISITA')
        		 ->setCellValue('C'.$intPosEncabezados, 'PRÓXIMA VISITA')
        		 ->setCellValue('D'.$intPosEncabezados, 'MÓDULO')
        		 ->setCellValue('E'.$intPosEncabezados, 'ESTRATEGIA')
                 ->setCellValue('F'.$intPosEncabezados, 'MADUREZ')
                 ->setCellValue('G'.$intPosEncabezados, 'COMENTARIOS')
                 ->setCellValue('H'.$intPosEncabezados, 'MOTIVO')
                 ->setCellValue('I'.$intPosEncabezados, 'CÓDIGO DE MAQUINARIA')
                 ->setCellValue('J'.$intPosEncabezados, 'DESCRIPCIÓN CORTA')
                 ->setCellValue('K'.$intPosEncabezados, 'DESCRIPCIÓN')
                 ->setCellValue('L'.$intPosEncabezados, 'LÍNEA')
                 ->setCellValue('M'.$intPosEncabezados, 'MARCA')
                 ->setCellValue('N'.$intPosEncabezados, 'MODELO')
                 ->setCellValue('O'.$intPosEncabezados, 'PROBABILIDAD DE COMPRA')
                 ->setCellValue('P'.$intPosEncabezados, 'CONDICIONES DE PAGO')
                 ->setCellValue('Q'.$intPosEncabezados, 'PLAZO')
                 ->setCellValue('R'.$intPosEncabezados, 'VENDEDOR')
                 ->setCellValue('S'.$intPosEncabezados, 'LOCALIDAD')
                 ->setCellValue('T'.$intPosEncabezados, 'MUNICIPIO')
                 ->setCellValue('U'.$intPosEncabezados, 'ESTADO');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE,
    													'color' => array('rgb' => 'ffffff')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

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
    			 ->getStyle('A10:U10')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

    	//Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    			 ->getStyle('A10:U10')
    			 ->applyFromArray($arrStyleFuenteColumnas);

    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A10:U10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
				 		 ->setCellValueExplicit('A'.$intFila, $arrCol->prospecto, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->fecha)
                         ->setCellValue('C'.$intFila, $arrCol->proxima_visita)
                         ->setCellValue('D'.$intFila, $arrCol->modulo)
                         ->setCellValue('E'.$intFila, $arrCol->estrategia)
                         ->setCellValue('F'.$intFila, $arrCol->madurez)
                         ->setCellValue('G'.$intFila, $arrCol->comentario)
                         ->setCellValue('H'.$intFila, $arrCol->motivo_visita)
                         ->setCellValue('I'.$intFila, $arrCol->codigo_maquinaria)
                         ->setCellValue('J'.$intFila, $arrCol->descripcion_corta_maquinaria)
                         ->setCellValue('K'.$intFila, $arrCol->descripcion_maquinaria)
                         ->setCellValue('L'.$intFila, $arrCol->maquinaria_linea)
                         ->setCellValue('M'.$intFila, $arrCol->maquinaria_marca)
                         ->setCellValue('N'.$intFila, $arrCol->maquinaria_modelo)
                         ->setCellValue('O'.$intFila, $arrCol->probabilidad_compra)
                         ->setCellValue('P'.$intFila, $arrCol->condiciones_pago)
                         ->setCellValue('Q'.$intFila, $arrCol->plazo)
                         ->setCellValue('R'.$intFila, $arrCol->vendedor)
                         ->setCellValue('S'.$intFila, $arrCol->localidad)
                         ->setCellValue('T'.$intFila, $arrCol->municipio)
                         ->setCellValue('U'.$intFila, $arrCol->estado);

                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('B'.$intFilaInicial.':'.'C'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

			$objExcel->getActiveSheet()
                	 ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('U'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('U'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'visitas.xls', 'visitas', $intFila);
	}

	/*******************************************************************************************************************
	Funciones de la tabla prospectos_visitas_reprogramacion
	*********************************************************************************************************************/
	//Método para guardar los datos de un registro
	public function guardar_reprogramacion_visitas()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objProspectoVisita = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objProspectoVisita->intProspectoVisitaID = $this->input->post('intProspectoVisitaID');
		$objProspectoVisita->dteFechaOriginal = $this->input->post('dteFechaOriginal');
		$objProspectoVisita->dteFechaReprogramada = $this->input->post('dteFechaReprogramada');
		$objProspectoVisita->strComentario = mb_strtoupper(trim($this->input->post('strComentario')));
		$objProspectoVisita->intUsuarioID = $this->session->userdata('usuario_id');

		//Guardamos los datos del registro
		$bolResultado = $this->prospectos->guardar_reprogramacion_visitas($objProspectoVisita);
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