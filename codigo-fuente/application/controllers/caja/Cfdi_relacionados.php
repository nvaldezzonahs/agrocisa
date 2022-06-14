<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cfdi_relacionados extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('caja/cfdi_relacionados_model', 'cfdi');
	}

	//Método para regresar los datos de un registro
	public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('rows' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intReferenciaID = $this->input->post('intReferenciaID');
		$strTipoReferencia = $this->input->post('strTipoReferencia');
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intProspectoID = $this->input->post('intProspectoID');
		
		//Seleccionar los datos del registro que coincide con el parámetro enviado
		if($intReferenciaID > 0)
		{
			$otdResultado = $this->cfdi->buscar($intReferenciaID, $strTipoReferencia);
		}
		else 
		{
    		$otdResultado = $this->cfdi->buscar(NULL, NULL, $dteFechaInicial, $dteFechaFinal, $intProspectoID);
		}

		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Hacer recorrido para convertir importe a formato moneda
			foreach ($otdResultado as $arrDet)
			{
				$arrDet->importe = '$'.number_format($arrDet->importe,2);
			}

			$arrDatos['rows'] = $otdResultado;
		}

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}	
}