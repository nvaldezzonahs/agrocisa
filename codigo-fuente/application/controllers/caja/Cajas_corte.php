<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cajas_corte extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de cortes de caja
		$this->load->model('caja/cajas_corte_model', 'cortes');
		//Cargamos el modelo de vales de caja
		$this->load->model('caja/cajas_vales_model', 'vales');
		//Cargamos el modelo de pagos de caja
		$this->load->model('caja/cajas_pagos_model', 'pagos');
		//Cargamos el modelo de ingresos de caja 
		$this->load->model('caja/cajas_ingresos_model', 'ingresos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('caja/cajas_corte', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->cortes->filtro($this->input->post('dteFechaInicial'),
										$this->input->post('dteFechaFinal'),
										$this->input->post('intUsuarioID'),
										$this->input->post('strTipo'),
			                            $config['per_page'],
			                            $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['cortes'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			$arrDet->mostrarAccionImprimir = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro = '';

			//Dependiendo del tipo de registro mostrar botones del grid
		    if($arrDet->tipo == 'ARQUEO' && $arrDet->estatus_caja_apertura == 'ABIERTA')
			{
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
					//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
					if (in_array('CAMBIAR ESTATUS', $arrPermisos))
					{
						//Asignar cadena vacia para mostrar botón Restaurar
						$arrDet->mostrarAccionRestaurar = '';
					}

					//Si el usuario cuenta con el permiso de acceso VER REGISTRO
					if (in_array('VER REGISTRO', $arrPermisos))
					{
						$arrDet->mostrarAccionVerRegistro = '';
					}

				}
			}
			else 
			{
				//Si el usuario cuenta con el permiso de acceso VER REGISTRO
				if (in_array('VER REGISTRO', $arrPermisos))
				{
					$arrDet->mostrarAccionVerRegistro = '';
				}
			}

			//Si el usuario cuenta con el permiso de acceso IMPRIMIR REGISTRO
			if (in_array('IMPRIMIR REGISTRO', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón Imprimir
        		$arrDet->mostrarAccionImprimir = '';
			}

			$arrDet->estiloRegistro = 'registro-'.$arrDet->estatus;
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['cortes'],
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
		$objCajaCorte = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista
		$objCajaCorte->intCajaCorteID = $this->input->post('intCajaCorteID');
		$objCajaCorte->intCajaAperturaID = $this->input->post('intCajaAperturaID');
		$objCajaCorte->dteFecha = $this->input->post('dteFecha');
		$objCajaCorte->strTipo = $this->input->post('strTipo');
		$objCajaCorte->intImporteTeorico = $this->input->post('intImporteTeorico');
		$objCajaCorte->intMil = $this->input->post('intMil');
		$objCajaCorte->intQuinientos = $this->input->post('intQuinientos');
		$objCajaCorte->intDoscientos = $this->input->post('intDoscientos');
		$objCajaCorte->intCien = $this->input->post('intCien');
		$objCajaCorte->intCincuenta = $this->input->post('intCincuenta');
		$objCajaCorte->intVeinte = $this->input->post('intVeinte');
		$objCajaCorte->intDiez = $this->input->post('intDiez');
		$objCajaCorte->intCinco = $this->input->post('intCinco');
		$objCajaCorte->intDos = $this->input->post('intDos');
		$objCajaCorte->intUno = $this->input->post('intUno');
		$objCajaCorte->intCincuentaCentavos = $this->input->post('intCincuentaCentavos');
		$objCajaCorte->intVeinteCentavos = $this->input->post('intVeinteCentavos');
		$objCajaCorte->intDiezCentavos = $this->input->post('intDiezCentavos');
		$objCajaCorte->intCincoCentavos = $this->input->post('intCincoCentavos');
		$objCajaCorte->intSucursalID = $this->session->userdata('sucursal_id');
	    $objCajaCorte->intUsuarioID = $this->session->userdata('usuario_id');


		//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
		if (is_numeric($objCajaCorte->intCajaCorteID))
		{
			$bolResultado = $this->cortes->modificar($objCajaCorte);
		}
		else
		{ 
			$bolResultado = $this->cortes->guardar($objCajaCorte);
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

	//Regresar el total del importe físico del último cierre de caja
    public function get_importe_fisico_ultimo_cierre() 
    {	
    	//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('importe_fisico' => '0.00');
    	//Seleccionar los datos del último cierre de caja 
		$otdResultado = $this->cortes->buscar(NULL, NULL, NULL, NULL, NULL, 'ULTIMO CIERRE');
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Asignar el total de importe físico
			$arrDatos['importe_fisico'] =  number_format($this->get_importe_fisico($otdResultado),2);
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
		$intID = $this->input->post('intCajaCorteID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->cortes->buscar($intID);
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
		$this->form_validation->set_rules('intCajaCorteID', 'ID', 'required|integer');
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
	        $intID = $this->input->post('intCajaCorteID');
		    $strEstatus = $this->input->post('strEstatus');
	        //Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->cortes->set_estatus($intID, $strEstatus);
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

	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte() 
	{	            
		
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intUsuarioID = $this->input->post('intUsuarioID');
		$strTipo = $this->input->post('strTipo');

		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->cortes->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intUsuarioID, $strTipo);
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
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
		$pdf->strLinea1 =  'CIERRES DE CAJA '.$strTituloRangoFechas;
		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array('FECHA', 'HORA', 'USUARIO', 'TIPO', utf8_decode('IMPORTE FÍSICO'), 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(18, 18, 92, 20, 22, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L', 'R', 'C');
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
				//Asignar el total de importe físico
        		$intTotalImporteFisico =  $this->get_importe_fisico($arrCol);

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->fecha, $arrCol->hora, utf8_decode($arrCol->usuario),  
							    $arrCol->tipo, '$'.number_format($intTotalImporteFisico,2),
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
		$pdf->Output('cierres_caja.pdf','I'); 
	}

	
	//Método para generar un reporte PDF con la información de un registro 
	public function get_reporte_registro() 
	{	            

		//Variables que se utilizan para recuperar los valores de la vista
		$intCajaCorteID = $this->input->post('intCajaCorteID');
		$strTipo = $this->input->post('strTipo');

		//Variable que se utiliza pra asignar el id actual del departamento
		$intDepartamentoIDActual = 0;
		//Variable que se utiliza pra asignar el tipo de referencia actual
		$strTipoReferenciaActual = '';
		//Variable que se utiliza pra asignar el id actual de la referencia
		$intReferenciaIDActual = 0;
		//Variables que se utilizan para acumular total de los vales de caja
        $intAcumTotalVales = 0;  //Suma total de vales
        $intAcumImporteVale = 0; //Suma total de importe del vale
        $intAcumImporteDevolucion = 0; //Suma total de importe de la devolución
        $intAcumImporteIva = 0;  //Suma total de importe de IVA
	    $intAcumSubtotal = 0;  //Suma del subtotal
        //Variables que se utilizan para acumular los vales de caja por departamento
        $intSumTotalValesDepto = 0;
		$intSumValeDepto = 0;
		$intSumDevolucionDepto = 0;
		$intSumIvaDepto = 0;
		$intSumSubtotalDepto = 0;
		//Variable que se utiliza para acumular el total de ingresos de caja
        $intAcumTotalPagos = 0;
		//Variable que se utiliza para acumular el total de ingresos de caja
        $intAcumTotalIngresos = 0;
        //Variable que se utiliza para acumular el importe de ingresos de caja
        $intAcumImptIngresos = 0;
        //Variable que se utiliza para acumular el importe interno de ingresos de caja
        $intAcumImptInternoIngresos = 0;
        //Variable que se utiliza para asignar el total de importe físico
        $intTotalImporteFisico = 0;
        //Variable que se utiliza para asignar diferencia de importes (teórico y físico)
        $intDiferenciaImportes = 0;
        //Seleccionar los datos del corte de caja que coincide con el id
		$otdCorteCaja = $this->cortes->buscar($intCajaCorteID);
		//Seleccionar los datos de los vales del corte de caja
		$otdValesCaja = $this->vales->buscar(NULL, $intCajaCorteID, $strTipo);
		//Seleccionar los datos de los vales fiscales (detalles) del corte de caja
		$otdValesCajaFiscales = $this->vales->buscar_detalles(NULL, $intCajaCorteID, $strTipo, 'FISCAL');
		//Seleccionar los datos de los vales  no fiscales (detalles) del corte de caja
		$otdValesCajaNoFiscales = $this->vales->buscar_detalles(NULL, $intCajaCorteID, $strTipo, 'NO FISCAL');
		//Seleccionar los datos de los pagos del corte de caja
		$otdPagosCaja = $this->pagos->buscar(NULL, $intCajaCorteID, $strTipo);
		//Seleccionar los datos de los ingresos del corte de caja
		$otdIngresosCaja = $this->ingresos->buscar(NULL, $intCajaCorteID, $strTipo);
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1= $strTipo.' DE CAJA';
		//Variable que se utiliza para asignar usuario que realizó el corte (y poder identificar reporte)
		$strUsuarioCorte  = '';
		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(125, 20, 25, 20);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R', 'R');
		//Establece el ancho de las columnas de los totales: comprobación fiscal de vales de caja
		$arrAnchuraTotalesVF = array(110, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla totales: comprobación fiscal de vales de caja
		$arrAlineacionTotalesVF = array('R', 'R', 'R', 'R', 'R');
		//Establece el ancho de las columnas de los totales: comprobación no fiscal de vales de caja
		$arrAnchuraTotalesVNF = array(170, 20);
		//Establece la alineación de las celdas de la tabla totales: comprobación no fiscal de vales de caja
		$arrAlineacionTotalesVNF = array('R', 'R');
		//Establece el ancho de las columnas del importe físico
		$arrAnchuraImporteFisico = array(15, 12, 15, 12, 15, 12, 15, 12, 15, 12, 15, 12, 15, 13);
		//Establece la alineación de las celdas de la tabla importe físico
		$arrAlineacionImporteFisico = array('R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R', 'R');
		//Establece el ancho de las columnas de la diferencia de importes
		$arrAnchuraDiferencia = array(27, 20, 32, 20, 30, 20);
		//Establece la alineación de las celdas de la tabla diferencia de importes
		$arrAlineacionDiferencia = array('L', 'R', 'R', 'R', 'R', 'R');

		//Agregar la primer pagina
		$pdf->AddPage();

		//Establecer el color de fondo para la cabecera
        $pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
        $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		
		//Verificar si hay información del registro
		if($otdCorteCaja)
		{
			//Asignar usuario que realizó el corte
			$strUsuarioCorte = $otdCorteCaja->usuario;
		
			//Usuario
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(20, 5, 'USUARIO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(80, 5, utf8_decode($strUsuarioCorte), 0, 0, 'L', 0);
			//Fecha
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(20, 5, 'FECHA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(20, 5, $otdCorteCaja->fecha, 0, 0, 'L', 0);
			//Hora
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(20, 5, 'HORA', 0, 0, 'C', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->ClippedCell(30, 5, $otdCorteCaja->hora, 0, 1, 'L', 0);
			//Verificar si hay información de los vales de caja
			if($otdValesCaja)
			{
				//Vales de caja
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
				$pdf->Cell(190, 5, 'VALES DE CAJA CHICA', 1, 1, 'C', 1);
				$pdf->SetTextColor(0); //establece el color de texto negro
				//Recorremos el arreglo 
				foreach ($otdValesCaja as $arrCol)
				{ 
					//Si el departamento actual es igual a cero (primer departamento)
		      		if ($intDepartamentoIDActual == 0)
		      		{
						//Crea los titulos de la cabecera
						$arrCabecera = array('FECHA', 'FOLIO', 'CONCEPTO', 
											 'IMPORTE', utf8_decode('DEVOLUCIÓN'), 'TOTAL');
						//Establece el ancho de las columnas de cabecera
						$arrAnchura = array(20, 20, 85, 20, 25, 20);
						//Establece la alineación de las celdas de la tabla
						$arrAlineacion = array('L', 'L', 'L', 'R', 'R', 'R');
		      			//Recorre el array de titulos de encabezado para crearlos
						for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
						{
							$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
							//inserta los titulos de la cabecera
							$pdf->Cell($arrAnchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, 
									   $arrAlineacion[$intCont], TRUE);
						}
						$pdf->SetTextColor(0); //establece el color de texto negro
						$pdf->Ln(); //Deja un salto de linea
						//Departamento
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
						//Hacer un llamado a la función para ajustar texto al tamaño de la celda
	                	//Nota: se utiliza esta función porque el texto no se muestra cuando el tipo de celda es ClippedCell
	                	$pdf->drawTextBox('DEPARTAMENTO '.utf8_decode($arrCol->departamento), 190, 5, 'C');
						//Asignar id del departamento actual
		      			$intDepartamentoIDActual = $arrCol->departamento_id;
		      			
					}

					//Si el departamento actual es diferente al anterior
		      		if($intDepartamentoIDActual != $arrCol->departamento_id)
		      		{
						
						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraTotales);

						//Cambiar el volumen de la fuente a bold
		  				$pdf->strTipoLetraTabla = 'Negrita';
						//Acumulados del departamento anterior
						$pdf->Row(array('SUMAS', 
										'$'.number_format($intSumValeDepto,2), 
									    '$'.number_format($intSumDevolucionDepto,2), 
									    '$'.number_format($intSumTotalValesDepto,2)), 
									    $arrAlineacionTotales, 'ClippedCell');
						//Cambiar el volumen de la letra
						$pdf->strTipoLetraTabla = 'Normal';

		      			$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los departamentos
		      			//Departamento
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
						$pdf->drawTextBox('DEPARTAMENTO '.utf8_decode($arrCol->departamento), 190, 5, 'C');
		      			//Asignar id del departamento actual
		      			$intDepartamentoIDActual = $arrCol->departamento_id;
		      			//Inicializar valores
		      			$intSumTotalValesDepto = 0;
						$intSumValeDepto = 0;
						$intSumDevolucionDepto = 0;
		      		}

					//Variable que se utilizan para asignar importe de devolución
					$strImporteDevolucion = (($arrCol->importe_devolucion !== NULL && 
											  empty($arrCol->importe_devolucion) === FALSE) ?
								              '$'.number_format($arrCol->importe_devolucion,2) : '');

					//Calcular total
					$intTotal = $arrCol->importe - $arrCol->importe_devolucion;

					//Si la referncia actual es igual a cero (primer referencia) o diferente a la anterior
		      		if (($intReferenciaIDActual == 0) OR ($intReferenciaIDActual != $arrCol->referencia_id)
		      			OR ($strTipoReferenciaActual != $arrCol->tipo_referencia))
		      		{
		      			//Asignar posición de la ordenada
		      			$intPosY = $pdf->GetY();
						//Sucursal
					    //Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
						$pdf->Cell(20, 5, 'SUCURSAL', 0, 0, 'L', 0);
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
						$pdf->drawTextBox(utf8_decode($arrCol->sucursal), 50, 5, 'L');
						$pdf->SetXY(90, $intPosY);
						//Referencia
					    //Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
						$pdf->Cell(22, 5, 'REFERENCIA', 0, 0, 'C', 0);
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
						$pdf->drawTextBox(utf8_decode($arrCol->referencia), 90, 5, 'L');
						$pdf->Ln(1); //Deja un salto de linea
					}

					//Establece el ancho de las columnas
				    $pdf->SetWidths($arrAnchura);
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($arrCol->fecha, $arrCol->folio, utf8_decode($arrCol->concepto),
									'$'.number_format($arrCol->importe,2), $strImporteDevolucion,
									'$'.number_format($intTotal,2)), $arrAlineacion,
									'ClippedCell');

					//Incrementar acumulados para cada departamento
					$intSumTotalValesDepto += $intTotal;
					$intSumValeDepto += $arrCol->importe;
					$intSumDevolucionDepto += $arrCol->importe_devolucion;
				    //Incrementar acumulados para todos los departamentos
					$intAcumTotalVales += $intTotal; 
	        		$intAcumImporteVale +=  $arrCol->importe;
	        		$intAcumImporteDevolucion += $arrCol->importe_devolucion;
	        		//Asignar datos de la referencia actual
	        		$strTipoReferenciaActual = $arrCol->tipo_referencia;
        			$intReferenciaIDActual = $arrCol->referencia_id;

				}

				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraTotales);
				//Cambiar el volumen de la fuente a bold
		  		$pdf->strTipoLetraTabla = 'Negrita';
				//Acumulados del último departamento
				$pdf->Row(array('SUMAS', 
								'$'.number_format($intSumValeDepto,2), 
							    '$'.number_format($intSumDevolucionDepto,2), 
							    '$'.number_format($intSumTotalValesDepto,2)), 
								 $arrAlineacionTotales, 'ClippedCell');

				//Acumulados de todos los departamentos
				$pdf->Row(array('SUMAS TOTALES', 
								'$'.number_format($intAcumImporteVale,2), 
							    '$'.number_format($intAcumImporteDevolucion,2), 
							    '$'.number_format($intAcumTotalVales,2)), 
								 $arrAlineacionTotales, 'ClippedCell');
				
				//Cambiar el volumen de la letra
				$pdf->strTipoLetraTabla = 'Normal';


			}//Cierre de verificación de vales

			//Verificar si hay información de los pagos de caja
			if($otdPagosCaja)
			{
				//Ingresos de caja
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
				$pdf->Cell(190, 5, 'PAGOS A CAJA CHICA ', 1, 1, 'C', 1);
				//Crea los titulos de la cabecera
				$arrCabecera = array('FECHA', 'FOLIO', 'EMPLEADO', 'VALE', 'IMPORTE');
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(20, 20, 110, 20, 20);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'L', 'L', 'R');
				//Recorre el array de titulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, 
							   $arrAlineacion[$intCont], TRUE);
				}
				$pdf->Ln(); //Deja un salto de linea
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchura);
				$pdf->SetTextColor(0); //establece el color de texto negro
				//Recorremos el arreglo 
				foreach ($otdPagosCaja as $arrCol)
				{ 
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($arrCol->fecha, $arrCol->folio, utf8_decode($arrCol->empleado),
									utf8_decode($arrCol->folio_vale), '$'.number_format($arrCol->importe,2)),
									$arrAlineacion);

					//Incrementar acumulado
					$intAcumTotalPagos += $arrCol->importe; 
				}

				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraTotalesVNF);
				//Cambiar el volumen de la fuente a bold
		  		$pdf->strTipoLetraTabla = 'Negrita';
				//Total de pagos
				$pdf->Row(array('SUMAS TOTALES', 
								'$'.number_format($intAcumTotalPagos,2)), 
								 $arrAlineacionTotalesVNF, 'ClippedCell');
				
				//Cambiar el volumen de la letra
				$pdf->strTipoLetraTabla = 'Normal';

			}//Cierre de verificación de pagos

			//Verificar si hay información de los ingresos de caja
			if($otdIngresosCaja)
			{
				//Ingresos de caja
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
				$pdf->Cell(190, 5, 'INGRESOS DE EFECTIVO A CAJA CHICA ', 1, 1, 'C', 1);
				//Crea los titulos de la cabecera
				$arrCabecera = array('FECHA', 'CONCEPTO', 'IMPORTE', 'IMPT. INTERNO', 'TOTAL');
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(20, 105, 20, 25, 20);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('L', 'L', 'R', 'R', 'R');
				//Recorre el array de titulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, 
							   $arrAlineacion[$intCont], TRUE);
				}
				$pdf->Ln(); //Deja un salto de linea
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchura);
				$pdf->SetTextColor(0); //establece el color de texto negro
				//Recorremos el arreglo 
				foreach ($otdIngresosCaja as $arrCol)
				{ 
					//Variables que se utilizan para asignar valores
					$intImporte = $arrCol->importe;
					$intImporteInterno = $arrCol->importe_interno;

					//Calcular el importe total
					$intTotal = $intImporte + $intImporteInterno;

					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array($arrCol->fecha, utf8_decode($arrCol->concepto),
									'$'.number_format($intImporte,2), 
									'$'.number_format($intImporteInterno,2), 
									'$'.number_format($intTotal,2)),
									 $arrAlineacion);

					//Incrementar acumulados
					$intAcumTotalIngresos += $intTotal; 
					$intAcumImptIngresos += $intImporte; 
					$intAcumImptInternoIngresos += $intImporteInterno; 
				}

			    //Total de ingresos
			    //Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraTotales);
				//Cambiar el volumen de la fuente a bold
		  		$pdf->strTipoLetraTabla = 'Negrita';
				//Total de pagos
				$pdf->Row(array('SUMAS TOTALES', 
								'$'.number_format($intAcumImptIngresos,2), 
								'$'.number_format($intAcumImptInternoIngresos,2),
								'$'.number_format($intAcumTotalIngresos,2)), 
								 $arrAlineacionTotales, 'ClippedCell');
				
				//Cambiar el volumen de la letra
				$pdf->strTipoLetraTabla = 'Normal';

			}//Cierre de verificación de ingresos

			//Importe teórico
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, utf8_decode('IMPORTE TEÓRICO'), 1, 1, 'C', 1);
			$pdf->SetTextColor(0); //establece el color de texto negro
			//Asignar posición de la ordenada
		    $intPosY = $pdf->GetY();
			//Apertura  de caja
			//Importe de apertura
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(38, 5, 'IMPORTE DE APERTURA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->drawTextBox('$'.number_format($otdCorteCaja->importe_apertura, 2), 28, 5, 'R');
			$pdf->SetXY(81, $intPosY);
			//Importe interno
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(42, 5, 'IMPORTE INTERNO DE APERTURA', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->drawTextBox('$'.number_format($otdCorteCaja->importe_interno, 2), 25, 5, 'R');
			$pdf->SetXY(141, $intPosY);
			//Saldo
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(39, 5, 'SALDO', 0, 0, 'R', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->drawTextBox('$'.number_format($otdCorteCaja->saldo, 2), 20, 5, 'R');
			//Asignar posición de la ordenada
		    $intPosY = $pdf->GetY();
			//Total de ingresos
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(38, 5, 'INGRESOS DE EFECTIVO', 0, 0, 'L', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->drawTextBox('$'.number_format($intAcumTotalIngresos, 2), 28, 5, 'R');
			$pdf->SetXY(76, $intPosY);
			//Total de pagos de caja
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(45, 5, 'PAGOS DE CAJA CHICA', 0, 0, 'C', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->drawTextBox('$'.number_format($intAcumTotalPagos, 2), 20, 5, 'R');
			$pdf->SetXY(141, $intPosY);
			//Total de vales de caja
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(39, 5, 'VALES DE CAJA CHICA', 0, 0, 'R', 0);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->drawTextBox('$'.number_format($intAcumTotalVales, 2), 20, 5, 'R');
			//Asignar posición de la ordenada
		    $intPosY = $pdf->GetY();
			//Total de importe teórico
		    //Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->drawTextBox('TOTAL',170, 5, 'R');
			$pdf->SetXY(180, $intPosY);
			$pdf->drawTextBox('$'.number_format($otdCorteCaja->importe_teorico, 2), 20, 5, 'R');

			$pdf->Ln(5);//Deja un salto de línea
			//Importe físico
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, utf8_decode('IMPORTE FÍSICO'), 1, 1, 'C', 1);
			$pdf->SetTextColor(0); //establece el color de texto negro
				$pdf->Ln(1);//Deja un salto de línea
			//Cantidad de billetes y monedas por denominación
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Cell(190, 5, utf8_decode('CANTIDAD DE BILLETES Y MONEDAS POR DENOMINACIÓN'), 0, 1, 'C', 0);
			
			//Asignar el total de importe físico
        	$intTotalImporteFisico =  $this->get_importe_fisico($otdCorteCaja);
		
		    //Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchuraImporteFisico);
			//Billetes y monedas por denominación (se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
			$pdf->Row(array('$1,000.00|Negrita', $otdCorteCaja->mil,
							'$500.00|Negrita', $otdCorteCaja->quinientos,
							'$200.00|Negrita', $otdCorteCaja->doscientos,
							'$100.00|Negrita', $otdCorteCaja->cien,
							'$50.00|Negrita', $otdCorteCaja->cincuenta,
							'$20.00|Negrita', $otdCorteCaja->veinte,
							'$10.00|Negrita', $otdCorteCaja->diez), 
						     $arrAlineacionImporteFisico, 'ClippedCell');
			
			$pdf->Row(array('$5.00|Negrita', $otdCorteCaja->cinco,
							'$2.00|Negrita', $otdCorteCaja->dos,
							'$1.00|Negrita', $otdCorteCaja->uno,
							'50 c.|Negrita', $otdCorteCaja->cincuenta_centavos,
							'20 c.|Negrita', $otdCorteCaja->veinte_centavos,
							'10 c.|Negrita', $otdCorteCaja->diez_centavos,
							'5 c.|Negrita', $otdCorteCaja->cinco_centavos), 
						     $arrAlineacionImporteFisico, 'ClippedCell');

			//Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchuraTotalesVNF);
			//Cambiar el volumen de la fuente a bold
	  		$pdf->strTipoLetraTabla = 'Negrita';
		    //Total de importe físico
			$pdf->Row(array('TOTAL', 
							'$'.number_format($intTotalImporteFisico,2)), 
							 $arrAlineacionTotalesVNF, 'ClippedCell');
			
			//Cambiar el volumen de la letra
			$pdf->strTipoLetraTabla = 'Normal';
			
			//Diferencia
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, utf8_decode('DIFERENCIA'), 0, 1, 'C', 1);
			$pdf->SetTextColor(0); //establece el color de texto negro
			
			//Calcular diferencia de importes
			$intDiferenciaImportes = $otdCorteCaja->importe_teorico  - $intTotalImporteFisico;

			//Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchuraDiferencia);

			//Diferencia de importes (se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
			$pdf->Row(array(utf8_decode('IMPORTE TEÓRICO|Negrita'), 
							'$'.number_format($otdCorteCaja->importe_teorico, 2),
							utf8_decode('IMPORTE FÍSICO|Negrita'), 
							'$'.number_format($intTotalImporteFisico, 2),
							'DIFERENCIA|Negrita', '$'.number_format($intDiferenciaImportes, 2)), 
						     $arrAlineacionDiferencia, 'ClippedCell');

			$pdf->Ln(15);//Espacios de salto de línea
			//línea para escribir la firma la persona que eleboro corte
			$pdf->Cell(90,3,'__________________________________', 0, 0, 'C');
			//línea para escribir la firma de autorización
			$pdf->Cell(90,3,'__________________________________', 0, 0, 'C');
			$pdf->Ln(5);//Espacios de salto de línea
			//Firma de la persona que eleboro corte
			$pdf->Cell(90,3,'ELABORO', 0, 0, 'C');
			//Firma de autorización
			$pdf->Cell(90,3, 'AUTORIZO', 0, 0, 'C');
	    }//Cierre de verificación de información
		
		//Verificar si hay información de los vales fiscales de caja 
		if($otdValesCajaFiscales)
		{
			//Agregar pagina
			$pdf->AddPage();
	        //Inicializar variables
			$strDepartamentoIDActual = '';
			$strTipoReferenciaActual = '';
			$intReferenciaIDActual = 0;
	        $intAcumTotalVales = 0;  
	        $intAcumImporteVale = 0; 
	        $intAcumSubtotal = 0;
	        $intAcumIva = 0;    
	        $intAcumIeps = 0;    
	        $intSumTotalValesDepto = 0;
			$intSumSubtotalDepto = 0;
			$intSumIvaDepto = 0;
			$intSumIepsDepto = 0;
			

			//Vales de caja
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, utf8_decode('COMPROBACIÓN FISCAL DE VALES DE CAJA CHICA'), 1, 1, 'C', 1);
			$pdf->SetTextColor(0); //establece el color de texto negro
			//Recorremos el arreglo 
			foreach ($otdValesCajaFiscales as $arrCol)
			{ 
				
				//Dependiendo de la referencia asignar datos del departamento
				if($arrCol->tipo_orden_compra != '')
				{
					$strDepartamento = $arrCol->tipo_orden_compra;
					$strDeptoReferenciaID = $arrCol->tipo_orden_compra;
				}
				else if($arrCol->tipo_orden_compra == '' && $arrCol->modulo_id > 0)
				{
					$strDepartamento = $arrCol->modulo;
					$strDeptoReferenciaID = $arrCol->modulo_id;
				}
				else
				{
					$strDepartamento = $arrCol->tipo_gasto;
					$strDeptoReferenciaID = $arrCol->tipo_gasto;
				}

				//Si el departamento actual es igual a cero (primer departamento)
	      		if ($strDepartamentoIDActual == '')
	      		{
					//Crea los titulos de la cabecera
					$arrCabecera = array('FECHA', 'FACTURA', 'CONCEPTO','SUBTOTAL', 
										 'IVA', 'IEPS', 'TOTAL');
					//Establece el ancho de las columnas de cabecera
					$arrAnchura = array(15, 20, 75, 20, 20, 20, 20);
					//Establece la alineación de las celdas de la tabla
					$arrAlineacion = array('L', 'L', 'L', 'R', 'R', 'R', 'R');
					//Establece el ancho de las columnas de la tabla tipo de gasto
					$arrAnchuraTipoGasto = array(40, 35, 40, 30, 50);
					//Establece la alineación de las celdas de la tabla tipo de gasto
					$arrAlineacionTipoGasto = array('L', 'L', 'L', 'L', 'L');
					//Establece el ancho de las columnas de la tabla orden de compra
					$arrAnchuraOrdenCompra = array(190);
					//Establece la alineación de las celdas de la tabla orden de compra
					$arrAlineacionOrdenCompra = array('L');
	      			//Recorre el array de titulos de encabezado para crearlos
					for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
					{
						$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
						//inserta los titulos de la cabecera
						$pdf->Cell($arrAnchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, 
								  $arrAlineacion[$intCont], TRUE);
					}
					$pdf->Ln(); //Deja un salto de linea
					$pdf->SetTextColor(0); //establece el color de texto negro
					//Departamento
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					
					//Hacer un llamado a la función para ajustar texto al tamaño de la celda
	                //Nota: se utiliza esta función porque el texto no se muestra cuando el tipo de celda es ClippedCell
	                $pdf->drawTextBox('DEPARTAMENTO '.utf8_decode($strDepartamento), 190, 5, 'C');
					//Asignar id del departamento actual
	      			$strDepartamentoIDActual = $strDeptoReferenciaID;

	      			
				}

				//Si el departamento actual es diferente al anterior
	      		if($strDepartamentoIDActual != $strDeptoReferenciaID)
	      		{
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraTotalesVF);

					//Cambiar el volumen de la fuente a bold
	  				$pdf->strTipoLetraTabla = 'Negrita';
					//Acumulados del departamento anterior
					$pdf->Row(array('SUMAS',  
								    '$'.number_format($intSumSubtotalDepto,2), 
								    '$'.number_format($intSumIvaDepto,2),
									'$'.number_format($intSumIepsDepto,2),
									'$'.number_format($intSumTotalValesDepto,2)), 
								    $arrAlineacionTotalesVF, 'ClippedCell');
					//Cambiar el volumen de la letra
					$pdf->strTipoLetraTabla = 'Normal';

					$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los departamentos
	      			//Departamento
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->drawTextBox('DEPARTAMENTO '.utf8_decode($strDepartamento), 190, 5, 'C');
	      			//Asignar id del departamento actual
	      			$strDepartamentoIDActual = $strDeptoReferenciaID;
	      			//Inicializar valores
	      			$intSumTotalValesDepto = 0;
					$intSumSubtotalDepto = 0;
					$intSumIvaDepto = 0;
					$intSumIepsDepto = 0;
	      		}

				//Variables que se utilizan para asignar valores del detalle
				$intSubtotal = $arrCol->subtotal;
				$intImporteIva = $arrCol->iva;
				$intImporteIeps = $arrCol->ieps;

				//Calcular importe total
				$intTotal = $intSubtotal + $intImporteIva + $intImporteIeps;

				//Si la referncia actual es igual a cero (primer referencia) o diferente a la anterior
				if (($intReferenciaIDActual == 0) OR ($intReferenciaIDActual != $arrCol->referencia_id)
		      		OR ($strTipoReferenciaActual != $arrCol->tipo_referencia))
	      		{

	      			//Asignar posición de la ordenada
		      		$intPosY = $pdf->GetY();
					//Folio
				    //Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->Cell(20, 5, 'FOLIO', 0, 0, 'L', 0);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->drawTextBox($arrCol->folio, 25, 5, 'L');
					$pdf->SetXY(55, $intPosY);
					//Fecha
				    //Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->Cell(15, 5, 'FECHA', 0, 0, 'L', 0);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->drawTextBox($arrCol->fecha_vale, 20, 5, 'L');
					$pdf->SetXY(90, $intPosY);
					//Sucursal
				    //Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->Cell(20, 5, 'SUCURSAL', 0, 0, 'L', 0);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->drawTextBox(utf8_decode($arrCol->sucursal), 93, 5, 'L');
					//Referencia
				    //Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->Cell(20, 5, 'REFERENCIA', 0, 0, 'L', 0);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->drawTextBox(utf8_decode($arrCol->referencia), 170, 5, 'L');
					$pdf->Ln(1); //Deja un salto de linea
				}

				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchura);

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->fecha_format, $arrCol->factura, 
							    utf8_decode($arrCol->concepto), 
								'$'.number_format($intSubtotal,2), 
								'$'.number_format($intImporteIva,2), 
								'$'.number_format($intImporteIeps,2),
								'$'.number_format($intTotal,2)), 
								 $arrAlineacion, 'ClippedCell');

				//Variable que se utiliza para asignar los datos del vehículo
				$strVehiculo = '';
				//Si existe id del vehículo
				if($arrCol->vehiculo_id > 0)
				{
					//Asignar los datos del vehículo
				   $strVehiculo = $arrCol->vehiculo;
				}


				//Si existe id de la orden de compra 
				if($arrCol->orden_compra_id > 0)
				{
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraOrdenCompra);
					//Se agrega la información de la orden de compra 
					$pdf->Row(array(utf8_decode($arrCol->folio_orden_compra)),  
								    $arrAlineacionOrdenCompra, 'ClippedCell', 'SI');


				}
				else
				{
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraTipoGasto);
					//Se agrega la información de la orden de compra
					$pdf->Row(array(utf8_decode($arrCol->sucursal_detalle),
									utf8_decode($arrCol->tipo_gasto),
									utf8_decode($arrCol->modulo),
									utf8_decode($arrCol->gasto),
									utf8_decode($strVehiculo)), 
								    $arrAlineacionTipoGasto, 'ClippedCell', 'SI');
				}

				$pdf->Ln(1); //Deja un salto de línea
				
				
				//Incrementar acumulados para cada departamento
				$intSumTotalValesDepto += $intTotal;
				$intSumSubtotalDepto += $intSubtotal;
				$intSumIvaDepto += $intImporteIva;
				$intSumIepsDepto += $intImporteIeps;

			    //Incrementar acumulados para todos los departamentos
				$intAcumTotalVales += $intTotal; 
        		$intAcumImporteVale +=  $intSubtotal;
        		$intAcumSubtotal += $intSubtotal;
        		$intAcumIva += $intImporteIva;
        		$intAcumIeps += $intImporteIeps;

        		//Asignar datos de la referencia actual
	        	$strTipoReferenciaActual = $arrCol->tipo_referencia;
        		$intReferenciaIDActual = $arrCol->referencia_id;
			}


			//Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchuraTotalesVF);

			//Cambiar el volumen de la fuente a bold
			$pdf->strTipoLetraTabla = 'Negrita';
			//Acumulados del último departamento
			$pdf->Row(array('SUMAS', 
						    '$'.number_format($intSumSubtotalDepto,2), 
						    '$'.number_format($intSumIvaDepto,2),
							'$'.number_format($intSumIepsDepto,2),
							'$'.number_format($intSumTotalValesDepto,2)), 
						    $arrAlineacionTotalesVF, 'ClippedCell');

			//Acumulados de todos los departamentos
			$pdf->Row(array('SUMAS TOTALES', 
						    '$'.number_format($intAcumSubtotal,2), 
						    '$'.number_format($intAcumIva,2),
							'$'.number_format($intAcumIeps,2),
							'$'.number_format($intAcumTotalVales,2)), 
						    $arrAlineacionTotalesVF, 'ClippedCell');

			//Cambiar el volumen de la letra
			$pdf->strTipoLetraTabla = 'Normal';

			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Ln(15);//Espacios de salto de línea
			//línea para escribir la firma la persona que eleboro corte
			$pdf->Cell(90,3,'__________________________________', 0, 0, 'C');
			//línea para escribir la firma de autorización
			$pdf->Cell(90,3,'__________________________________', 0, 0, 'C');
			$pdf->Ln(5);//Espacios de salto de línea
			//Firma de la persona que eleboro corte
			$pdf->Cell(90,3,'ELABORO', 0, 0, 'C');
			//Firma de autorización
			$pdf->Cell(90,3, 'AUTORIZO', 0, 0, 'C');

		}//Cierre de verificación de vales fiscales


		//Verificar si hay información de los vales no fiscales de caja 
		if($otdValesCajaNoFiscales)
		{
			//Agregar pagina
			$pdf->AddPage();
	        //Inicializar variables
			$intDepartamentoIDActual = 0;
			$strTipoReferenciaActual = '';
			$intReferenciaIDActual = 0;
	        $intAcumImporteVale = 0; 
			$intSumValeDepto = 0;

			//Vales de caja
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto blanco
			$pdf->Cell(190, 5, utf8_decode('COMPROBACIÓN NO FISCAL DE VALES DE CAJA CHICA'), 1, 1, 'C', 1);
			$pdf->SetTextColor(0); //establece el color de texto negro
			//Recorremos el arreglo 
			foreach ($otdValesCajaNoFiscales as $arrCol)
			{ 
				//Si el departamento actual es igual a cero (primer departamento)
	      		if ($intDepartamentoIDActual == 0)
	      		{
					//Crea los titulos de la cabecera
					$arrCabecera = array('FECHA', 'CONCEPTO', 'IMPORTE');
					//Establece el ancho de las columnas de cabecera
					$arrAnchura = array(15, 155, 20);
					//Establece la alineación de las celdas de la tabla
					$arrAlineacion = array('L', 'L', 'R');
	      			//Recorre el array de titulos de encabezado para crearlos
					for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
					{
						$pdf->SetTextColor(COLOR_TEXTO);  //establece el color de texto blanco
						//inserta los titulos de la cabecera
						$pdf->Cell($arrAnchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, 
								   $arrAlineacion[$intCont], TRUE);
					}
					$pdf->Ln(); //Deja un salto de linea
					$pdf->SetTextColor(0); //establece el color de texto negro
					//Departamento
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					//Hacer un llamado a la función para ajustar texto al tamaño de la celda
	                //Nota: se utiliza esta función porque el texto no se muestra cuando el tipo de celda es ClippedCell
	                $pdf->drawTextBox('DEPARTAMENTO '.utf8_decode($arrCol->departamento), 190, 5, 'C');
					//Asignar id del departamento actual
	      			$intDepartamentoIDActual = $arrCol->departamento_id;
	      			
				}

				//Si el departamento actual es diferente al anterior
	      		if($intDepartamentoIDActual != $arrCol->departamento_id)
	      		{

					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraTotalesVNF);
					//Cambiar el volumen de la fuente a bold
			  		$pdf->strTipoLetraTabla = 'Negrita';
					//Acumulados del departamento anterior
					$pdf->Row(array('SUMAS', 
									'$'.number_format($intSumValeDepto,2)), 
									 $arrAlineacionTotalesVNF, 'ClippedCell');
					//Cambiar el volumen de la letra
					$pdf->strTipoLetraTabla = 'Normal';

					$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los departamentos
	      			//Departamento
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->drawTextBox('DEPARTAMENTO '.utf8_decode($arrCol->departamento), 190, 5, 'C');
	      			//Asignar id del departamento actual
	      			$intDepartamentoIDActual = $arrCol->departamento_id;
	      			//Inicializar valores
					$intSumValeDepto = 0;
	      		}

	      		//Variables que se utilizan para asignar valores del detalle
				$intSubtotal = $arrCol->subtotal;

				//Si la referncia actual es igual a cero (primer referencia) o diferente a la anterior
	      		if (($intReferenciaIDActual == 0) OR ($intReferenciaIDActual != $arrCol->referencia_id)
		      		 OR ($strTipoReferenciaActual != $arrCol->tipo_referencia))
	      		{

	      			//Asignar posición de la ordenada
		      		$intPosY = $pdf->GetY();
					//Folio
				    //Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->Cell(20, 5, 'FOLIO', 0, 0, 'L', 0);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->drawTextBox($arrCol->folio, 25, 5, 'L');
					$pdf->SetXY(55, $intPosY);
					//Fecha
				    //Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->Cell(15, 5, 'FECHA', 0, 0, 'L', 0);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->drawTextBox($arrCol->fecha_vale, 20, 5, 'L');
					$pdf->SetXY(90, $intPosY);
					//Sucursal
				    //Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->Cell(20, 5, 'SUCURSAL', 0, 0, 'L', 0);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->drawTextBox(utf8_decode($arrCol->sucursal), 93, 5, 'L');
					//Referencia
				    //Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->Cell(20, 5, 'REFERENCIA', 0, 0, 'L', 0);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
					$pdf->drawTextBox(utf8_decode($arrCol->referencia), 170, 5, 'L');
					$pdf->Ln(1); //Deja un salto de linea
				}

				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchura);

				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->fecha_format, utf8_decode($arrCol->concepto), 
							    '$'.number_format($intSubtotal,2)), 
								$arrAlineacion, 'ClippedCell');

				//Incrementar acumulados para cada departamento
				$intSumValeDepto += $intSubtotal;
			    //Incrementar acumulados para todos los departamentos
        		$intAcumImporteVale +=  $intSubtotal;
        		
        		//Asignar datos de la referencia actual
	        	$strTipoReferenciaActual = $arrCol->tipo_referencia;
        		$intReferenciaIDActual = $arrCol->referencia_id;
			}

			//Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchuraTotalesVNF);
			//Cambiar el volumen de la fuente a bold
	  		$pdf->strTipoLetraTabla = 'Negrita';
			//Acumulados del último departamento
			$pdf->Row(array('SUMAS', 
							'$'.number_format($intSumValeDepto,2)), 
							 $arrAlineacionTotalesVNF, 'ClippedCell');

			//Acumulados de todos los departamentos
			$pdf->Row(array('SUMAS TOTALES', 
							'$'.number_format($intAcumImporteVale,2)), 
							 $arrAlineacionTotalesVNF, 'ClippedCell');
			
			//Cambiar el volumen de la letra
			$pdf->strTipoLetraTabla = 'Normal';

			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->Ln(15);//Espacios de salto de línea
			//línea para escribir la firma la persona que eleboro corte
			$pdf->Cell(90,3,'__________________________________', 0, 0, 'C');
			//línea para escribir la firma de autorización
			$pdf->Cell(90,3,'__________________________________', 0, 0, 'C');
			$pdf->Ln(5);//Espacios de salto de línea
			//Firma de la persona que eleboro corte
			$pdf->Cell(90,3,'ELABORO', 0, 0, 'C');
			//Firma de autorización
			$pdf->Cell(90,3, 'AUTORIZO', 0, 0, 'C');
		}//Cierre de verificación de vales no fiscales

		//Ejecutar la salida del reporte
		$pdf->Output(strtolower($strTipo.'_caja_'.$strUsuarioCorte.'.pdf'),'I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intUsuarioID = $this->input->post('intUsuarioID');
		$strTipo = $this->input->post('strTipo');

		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->cortes->buscar(NULL, $dteFechaInicial, $dteFechaFinal, $intUsuarioID, $strTipo);
		//Si existe rango de fechas
		if($dteFechaInicial != '' && $dteFechaFinal  != '')
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
			     ->setCellValue('A7', 'CIERRES DE CAJA '.$strTituloRangoFechas);
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('B'.$intPosEncabezados, 'HORA')
        		 ->setCellValue('C'.$intPosEncabezados, 'USUARIO')
        		 ->setCellValue('D'.$intPosEncabezados, 'TIPO')
        		 ->setCellValue('E'.$intPosEncabezados, 'BILLETES DE $1,000.00')
        		 ->setCellValue('F'.$intPosEncabezados, '$500.00')
        		 ->setCellValue('G'.$intPosEncabezados, '$200.00')
        		 ->setCellValue('H'.$intPosEncabezados, '$100.00')
        		 ->setCellValue('I'.$intPosEncabezados, '$50.00')
        		 ->setCellValue('J'.$intPosEncabezados, '$20.00')
        		 ->setCellValue('K'.$intPosEncabezados, 'MONEDAS DE $10.00')
        		 ->setCellValue('L'.$intPosEncabezados, '$5.00')
        		 ->setCellValue('M'.$intPosEncabezados, '$2.00')
        		 ->setCellValue('N'.$intPosEncabezados, '$1.00')
        		 ->setCellValue('O'.$intPosEncabezados, '50 c.')
        		 ->setCellValue('P'.$intPosEncabezados, '20 c.')
        		 ->setCellValue('Q'.$intPosEncabezados, '10 c.')
        		 ->setCellValue('R'.$intPosEncabezados, '5 c.')
        		 ->setCellValue('S'.$intPosEncabezados, 'IMPORTE FÍSICO')
        		 ->setCellValue('T'.$intPosEncabezados, 'ESTATUS');
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
    			 ->getStyle('A9:T9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Asignar el total de importe físico
        		$intTotalImporteFisico =  $this->get_importe_fisico($arrCol);

				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFila, $arrCol->fecha)
                         ->setCellValue('B'.$intFila, $arrCol->hora)
                         ->setCellValue('C'.$intFila, $arrCol->usuario)
                         ->setCellValue('D'.$intFila, $arrCol->tipo)
		        		 ->setCellValue('E'.$intFila, $arrCol->mil)
		        		 ->setCellValue('F'.$intFila, $arrCol->quinientos)
		        		 ->setCellValue('G'.$intFila, $arrCol->doscientos)
		        		 ->setCellValue('H'.$intFila, $arrCol->cien)
		        		 ->setCellValue('I'.$intFila, $arrCol->cincuenta)
		        		 ->setCellValue('J'.$intFila, $arrCol->veinte)
		        		 ->setCellValue('K'.$intFila, $arrCol->diez)
		        		 ->setCellValue('L'.$intFila, $arrCol->cinco)
		        		 ->setCellValue('M'.$intFila, $arrCol->dos)
		        		 ->setCellValue('N'.$intFila, $arrCol->uno)
		        		 ->setCellValue('O'.$intFila, $arrCol->cincuenta_centavos)
		        		 ->setCellValue('P'.$intFila, $arrCol->veinte_centavos)
		        		 ->setCellValue('Q'.$intFila, $arrCol->diez_centavos)
		        		 ->setCellValue('R'.$intFila, $arrCol->cinco_centavos)
		        		 ->setCellValue('S'.$intFila, $intTotalImporteFisico)
                         ->setCellValue('T'.$intFila, $arrCol->estatus);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}
			
			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('S'.$intFilaInicial.':'.'S'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('A'.$intFilaInicial.':'.'A'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);

            $objExcel->getActiveSheet()
                	 ->getStyle('E'.$intFilaInicial.':'.'S'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);		
                	  
			$objExcel->getActiveSheet()
                	 ->getStyle('T'.$intFilaInicial.':'.'T'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('T'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('T'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'cierres_caja.xls', 'cierres', $intFila);
	}


	//Método para regresar el total de importe físico de un corte de caja (CIERRE/ARQUEO)
	public function get_importe_fisico($arrDato)
	{
		//Variable que se utiliza para asignar el total de importe físico
		$intTotalImporteFisico = 0;
	    //Incrementar total de importe físico 
		$intTotalImporteFisico += ($arrDato->mil * 1000);
		$intTotalImporteFisico += ($arrDato->quinientos * 500);
		$intTotalImporteFisico += ($arrDato->doscientos * 200);
		$intTotalImporteFisico += ($arrDato->cien * 100);
		$intTotalImporteFisico += ($arrDato->cincuenta * 50);
		$intTotalImporteFisico += ($arrDato->veinte * 20);
		$intTotalImporteFisico += ($arrDato->diez * 10);
		$intTotalImporteFisico += ($arrDato->cinco * 5);
		$intTotalImporteFisico += ($arrDato->dos * 2);
		$intTotalImporteFisico += ($arrDato->uno * 1);
		$intTotalImporteFisico += ($arrDato->cincuenta_centavos * 0.50);
		$intTotalImporteFisico += ($arrDato->veinte_centavos * 0.20);
		$intTotalImporteFisico += ($arrDato->diez_centavos * 0.10);
		$intTotalImporteFisico += ($arrDato->cinco_centavos * 0.05);

		//Regresar el total de importe físico 
		return $intTotalImporteFisico;
	}

}