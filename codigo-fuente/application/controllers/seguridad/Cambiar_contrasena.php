<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cambiar_contrasena extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo de usuario
		$this->load->model('seguridad/usuarios_model', 'usuarios');
	}

	//Método principal del controlador.
	public function index()
	{
		$arrDatos[] = 'Cambiar Contraseña';
		$arrDatos[] = '';
		$arrDatos[] = '';
		$arrDatos[] = '';

		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('seguridad/cambiar_contrasena', $arrDatos);
	}

	//Método para modificar la contraseña del usuario que se encuentra logeado en el sistema.
	public function guardar()
	{ 
		//Recuperamos la contraseña del usuario
		$otdUsuario = $this->usuarios->buscar(NULL, $this->session->userdata('usuario'));
		//Validamos que la contraseña actual que se proporcionó coincida con la que se tiene guardada
		if($otdUsuario && password_verify($this->input->post('strContrasenaActual'), $otdUsuario->contrasena))
		{
			//Encriptar contraseña nueva
			$strContrasena = password_hash($this->input->post('strContrasena'), PASSWORD_BCRYPT);
			//Llamar el método para modificar contraseña del usuario
			if ($this->usuarios->set_contrasena($strContrasena))
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos = array('resultado' => TRUE,
								  'tipo_mensaje' => TIPO_MSJ_EXITO,
								  'mensaje' => 'La contraseña se guardó correctamente.');
			}
			else
			{
				//Enviar el mensaje de error al formulario
				$arrDatos = array('resultado' => FALSE,
								  'tipo_mensaje' => TIPO_MSJ_ERROR,
								  'mensaje' => MSJ_ERROR_GUARDAR);
			}
		}
		else{
			//Enviar el mensaje de error al formulario
			$arrDatos = array('resultado' => FALSE,
							  'tipo_mensaje' => TIPO_MSJ_ERROR,
							  'mensaje' => 'La contraseña actual no es correcta.');
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}	
}