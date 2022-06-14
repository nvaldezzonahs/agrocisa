<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensajes extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('administracion/mensajes_model', 'mensajes');
	}

	//Método principal del controlador.
	public function index()
	{
		$arrDatos[] = 'Mensajes';
		$arrDatos[] = '';
		$arrDatos[] = '';
		$arrDatos[] = '';

		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('administracion/mensajes', $arrDatos);
	}


	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->mensajes->filtro(trim($this->input->post('strBusqueda')),
										  $this->input->post('dteFechaInicial'),
									      $this->input->post('dteFechaFinal'),
			                              $config['per_page'],
			                              $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];

		//Hacer recorrido para cambiar estilo del registro
		foreach ($result['mensajes'] as $arrDet)
		{
			//Variable que se utiliza para asignar el nombre del empleado
			$strNombreEmpleado = (($arrDet->empleado_creacion !== NULL && 
						           empty($arrDet->empleado_creacion) === FALSE) ?
	                               ' - '.$arrDet->empleado_creacion : '');

			$arrDet->usuario_creacion .= $strNombreEmpleado;

			//Si el estatus del registro es NUEVO 
			if($arrDet->estatus == 'NUEVO')
			{
				//Cambiar valor de las siguientes variables
				$arrDet->tipoMensaje = 'No leído';
				$arrDet->colorIcono = '#92a58c';//Color gris
			}
			else
			{
				//Cambiar valor de las siguientes variables
				$arrDet->tipoMensaje = 'Leído';
				$arrDet->colorIcono = '#4fc3f7';//Color azul
			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['mensajes'],
						  'paginacion' => $this->pagination->create_links(),
						  'pagina' => $config['cur_page'],
						  'total_rows' => $config['total_rows']);
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	//Método para regresar el número de mensajes nuevos del usuario logeado en el sistema
	public function get_mensajes_nuevos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Seleccionar el número de mensajes nuevos del usuario logeado en el sistema
		$otdResultado = $this->mensajes->get_mensajes_nuevos();
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para regresar los datos de los registros de una referencia
	public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intReferenciaID = $this->input->post('intReferenciaID');
		$strProceso = $this->input->post('strProceso');
		//Seleccionar los datos de los registros que coinciden con los parámetros enviados
		$otdResultado = $this->mensajes->buscar($intReferenciaID, $strProceso);
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
		//Variables que se utilizan para recuperar los valores de la vista 
		$intReferenciaID = $this->input->post('intReferenciaID');
		$strProceso = $this->input->post('strProceso');
		//Dependiendo del tipo  realizar la modificación de estatus
		//Modificar el estatus del registro que coincide con el parámetro enviado
		if(is_numeric($intReferenciaID))
		{
			$bolResultado = $this->mensajes->set_estatus($intReferenciaID, $strProceso);
		}
		else
		{
    		$bolResultado = $this->mensajes->set_estatus();
		}
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
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

}