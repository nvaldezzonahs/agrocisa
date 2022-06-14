<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_resultados_encuestas extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('mercadotecnia/rep_resultados_encuestas_model', 'rep_resultados_encuestas');
		$this->load->model('administracion/empresas_model', 'empresas');
		$this->load->model('administracion/sucursales_model', 'sucursales');

	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('mercadotecnia/rep_resultados_encuestas', $arrDatos);
	}

	//Seleccionar los datos de la empresa que coincide con el identificador
	public function get_header(){
		
		$otdEmpresa = $this->empresas->buscar(1);
        $otdSucursal = $this->sucursales->buscar($this->session->userdata('sucursal_id'));

		$arrDatos = array('empresa' => $otdEmpresa, 'sucursal' => $otdSucursal);
		
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

	/*Método para generar un reporte PDF con el listado de los pospectos
	 *(con su última visita en caso de que exista) dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte($dteFechaInicial, 
								$dteFechaFinal, 
								$intEncuestaID,
								$intZonaID,
								$intLocalidadID,
								$intMunicipioID,
								$intEstadoID,
								$intActividadID, 
								$intCultivoID) 
	{	            
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
        //Variable que se utiliza pra asignar el id actual del vendedor
		$intVendedorIDActual = 0;
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos de los prospectos
		$otdResultado = $this->rep_resultados_encuestas->buscar($dteFechaInicial, 
																$dteFechaFinal, 
																$intEncuestaID,
																$intZonaID,
																$intLocalidadID,
																$intMunicipioID,
																$intEstadoID,
																$intActividadID, 
																$intCultivoID); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1= 'REPORTE DE ENCUESTAS APLICADAS ';
		//Agregar la primer pagina
		$pdf->AddPage();
		
		//Espacios de salto de línea
        $pdf->Ln();
        //Asigna el tipo y tamaño de letra para los totales
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
        
        //Crea los titulos de la cabecera
		$arrCabecera = array('ID', 'FECHA', 'FOLIO', 'ENCUESTA ID', 'PROSPECTO ID', 'OBSERVACIONES');
		//Establece el ancho de las columnas de cabecera
		$arrAchura = array(18, 18, 18, 28, 28, 80);
		//Establece la alineación de las celdas de la tabla
		$arrAlineacion = array('L', 'L', 'L', 'L', 'L', 'L');
		//Recorre el array de titulos de encabezado para crearlos
		for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
		{
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//inserta los titulos de la cabecera
			$pdf->Cell($arrAchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, 'C', TRUE);
		}
		$pdf->Ln(); //Deja un salto de línea
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAchura);
		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->encuesta_prospecto_id, 
								$arrCol->fecha, 
								$arrCol->folio, 
								$arrCol->encuesta_id, 
								$arrCol->prospecto_id, 
								$arrCol->observaciones), 
								$arrCabecera, $arrAchura, $arrAlineacion);
				//Incrementar el contador por cada registro
				$intContador++;
			}
		}
		//Espacios de salto de línea
		$pdf->Ln();
        //Escribe la cadena concatenada con el total de registros
        $pdf->Cell(0,3,'TOTAL: '.$intContador, 0, 0, 'R');
        //Ejecutar la salida del reporte
        $pdf->Output('reporte_encuestas_aplicadas'.'.pdf','I'); 
	}

    function get_respuestas(){

    	//Variables que se utilizan para recuperar los valores de la vista 
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intEncuestaID = $this->input->post('intEncuestaID');
		$intZonaID = $this->input->post('intZonaID');
		$intLocalidadID = $this->input->post('intLocalidadID');
		$intMunicipioID = $this->input->post('intMunicipioID');
		$intEstadoID = $this->input->post('intEstadoID');
		$intActividadID = $this->input->post('intActividadID');
		$intCultivoID = $this->input->post('intCultivoID');

		//var_dump($dteFechaInicial);

    	$result = $this->rep_resultados_encuestas->get_respuestas($dteFechaInicial, 
																  $dteFechaFinal, 
																  $intEncuestaID,
																  $intZonaID,
																  $intLocalidadID,
																  $intMunicipioID,
																  $intEstadoID,
																  $intActividadID, 
																  $intCultivoID); 

    	$respuestas = $result['respuestas'];

    	$intPreguntaAnterior = 0;
    	$strEncuestaAnterior = '';
    	$strPreguntaAnterior = '';
    	//Array que se utiliza para guardar las preguntas de una encuesta
    	$arrPreguntas = array(); 
    	//Array que se utiliza para guardar las respuestas de una pregunta
		$arrRespuestas = array();
		//Arreglo para fines de configuración en una gráfica de tipo PIE-CHART
		$cols = array( array( "id" => "", "label" => "Topping", "pattern" => "", "type" => "string" ),
					   array( "id" => "", "label" => "Total", "pattern" => "", "type" => "number" ) );
    	
    	foreach($respuestas as $row){
    		
    		//Si el renglon de la pregunta cambió
   			if($intPreguntaAnterior != $row->RenglonPregunta && $intPreguntaAnterior != 0)
   			{
   				//Agregar datos al array de preguntas
    			array_push( $arrPreguntas, array("encuesta" => $strEncuestaAnterior, "pregunta" => $strPreguntaAnterior, "cols" => $cols, "rows" => $arrRespuestas) );
				//Inicializar el array de Respuestas 
				$arrRespuestas = array();
   			}

    		array_push($arrRespuestas, array("c" => array( array( "v" => $row->Respuesta, "f" => null ), array( "v" => (int)$row->Total, "f" => null ) ) ) );

    		//Inicializar variable
			$intPreguntaAnterior = $row->RenglonPregunta;
			$strPreguntaAnterior = $row->Pregunta; 
			$strEncuestaAnterior = $row->Encuesta; 		
    	
    	}
    	//Agregar datos de la última pregunta
   		if($intPreguntaAnterior != 0)
		{
			//Agregar datos al array de preguntas
			array_push( $arrPreguntas, array("encuesta" => $strEncuestaAnterior, "pregunta" => $strPreguntaAnterior, "cols" => $cols, "rows" => $arrRespuestas) );
		}

    	//echo json_encode($arrPreguntas); 

    	
    
    }

}

?>