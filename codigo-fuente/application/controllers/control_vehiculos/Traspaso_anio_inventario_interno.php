<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Traspaso_anio_inventario_interno extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('control_vehiculos/refacciones_internas_inventario_model', 'inventario');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('control_vehiculos/traspaso_anio_inventario_interno', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	//Método para modificar el IVA de las refacciones
	public function guardar()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objInventario = new stdClass();

		//Variables que se utilizan para recuperar los valores de la vista
		$objInventario->strAnioInventario = $this->input->post('strAnioInventario');
		$objInventario->strAnioTraspaso = $this->input->post('strAnioTraspaso');
		$objInventario->intSucursalID = $this->session->userdata('sucursal_id');
		
		//Guardar el traspaso del inventario
		$bolResultado = $this->inventario->guardar_traspaso($objInventario);

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

	 //Método para regresar el último año del inventario de refacciones
	public function get_ultimo_anio()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		
		//Seleccionar el último año del inventario correspondiente a la sucursal seleccionada (logeada)
		$otdResultado = $this->inventario->buscar_ultimo_anio();
		
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	//Método para regresar las refacciones con existencia en el inventario
	public function get_diferencia_refacciones()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('mensaje' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$strAnioTraspaso = $this->input->post('strAnioTraspaso');
		
		//Seleccionar las refacciones (año del traspaso) que tienen existencia
		$otdExistenciasAnioTraspaso = $this->inventario->buscar_diferencia_refacciones($strAnioTraspaso);

		//Si existen existencias en el año del traspaso
		if($otdExistenciasAnioTraspaso)
		{
			$strMensaje = '<b>No se puede realizar el traspaso de año porque hay refacciones con existencia en el año del traspaso:</b><br>';

			//Hacer un llamado a la función para asignar lista de refacciones con existencia (año del traspaso)
			$strMensaje .= $this->get_lista_refacciones($otdExistenciasAnioTraspaso);

			$arrDatos['mensaje'] = $strMensaje;
		}

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	 //Método para regresar la lista de refacciones correspondientes al otd (objeto de transferencia de datos) de la consulta
	public function get_lista_refacciones($otdInventario)
	{
		//Variable que se utiliza para concatenar refacciones
		$strListaRefacciones = '';

		//Hacer recorrido para obtener refacciones
		foreach ($otdInventario as $arrRef)
		{
			$strListaRefacciones .= $arrRef->refaccion;
			$strListaRefacciones .= '<br>';
			$strListaRefacciones .= 'Localización: '.$arrRef->localizacion;
			$strListaRefacciones .= '<br>';
			$strListaRefacciones .= ' Existencia: '.$arrRef->actual_existencia;
			$strListaRefacciones .= '<br>';
			$strListaRefacciones .= ' Costo: '.'$'.number_format($arrRef->actual_costo,2);
			$strListaRefacciones .=  '<br><br>';

		}//Cierre de foreach


		//Regresar lista de refacciones
		return $strListaRefacciones;


	}

	
}