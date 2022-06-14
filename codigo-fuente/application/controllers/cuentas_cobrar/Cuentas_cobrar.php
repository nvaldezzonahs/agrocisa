<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cuentas_cobrar extends MY_Controller {

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo de recibos de ingreso
		$this->load->model('cuentas_cobrar/cuentas_cobrar_model', 'cuentas');
	}

	//Método para regresar los importes de una factura (MAQUINARIA, REFACCIONES, SERVICIO)
	public function get_importes_factura()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		
		//Variables que se utilizan para recuperar los valores de la vista 
		$intReferenciaID = $this->input->post('intReferenciaID');
		$strTipoReferencia = $this->input->post('strTipoReferencia');

		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->cuentas->buscar_importes_factura($intReferenciaID, $strTipoReferencia);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Hacer recorrido para validar los permisos del usuario en el grid
			foreach ($otdResultado as $arrDet)
			{
			
				if($strTipoReferencia == 'SERVICIO')
				{
					$arrDet->PorcentajeTasaCuotaIEPS=  "0.000000";
					$arrDet->PorcentajeTasaCuotaIVA = PORCENTAJE_IVA_GASTOS_SERVICIO;
					$arrDet->TasaCuotaIva = SAT_TASA_CUOTA_IVA_ID;
				}
			}
			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

}
