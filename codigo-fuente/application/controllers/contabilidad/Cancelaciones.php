<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancelaciones extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('contabilidad/cancelaciones_model', 'cancelaciones');
	}


	
    //Método para regresar los datos de un registro
	public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intCancelacionID = $this->input->post('intCancelacionID');
		$strTipoReferencia = $this->input->post('strTipoReferencia');
		
		//Realizar la búsqueda de datos
		$otdResultado = $this->cancelaciones->buscar($intCancelacionID, $strTipoReferencia);
		
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	
}