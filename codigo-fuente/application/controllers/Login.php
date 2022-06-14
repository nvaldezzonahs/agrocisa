<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	//Constructor de la clase
	function __construct ()
	{
		parent::__construct ();
		//Cargamos el modelo de usuarios
		$this->load->model('seguridad/usuarios_model','usuarios');
	}

	public function index()
	{
		//Si el usuario no ha iniciado sesión
		if ($this->session->userdata('login') !== TRUE)
		{
			//Depende el tipo de dispositivo se carga el encabezado
			if ($this->agent->is_mobile())
			{
				$this->load->view("movil/header_login");
			}
			else
			{
				$this->load->view("desktop/header_login");
			}
			$this->load->view("pages/login"); //Cargando Vista del Proceso
			$this->load->view("pages/footer"); //Carga pie de pagina
		}
		else
		{
			//Depende el tipo de dispositivo se carga el controlador
			if ($this->agent->is_mobile())
			{
				//Cargar vista para el dispositivo móvil 
				redirect(base_url('movil'));
			}
			else
			{
				//Cargar vista para el dispositivo de escritorio 
				redirect(base_url('desktop'));
			}
		}
	}

	//Método para verificar usuario e ingresar al sistema.
	public function iniciar_sesion()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('state' => TIPO_MSJ_ERROR,
						  'titulo' => 'Información no valida',
						  'mensaje' => 'Usuario o contraseña incorrectos.', 
						  'pagina' => '');
		//Asignar valor recuperado a las siguientes variables
		$strUsuario = $this->input->post('strUsuario');
		$strContrasena = $this->input->post('strContrasena');
		$strIP = $this->input->post('strListaIps');
		//Seleccionar los datos del usuario que coincide con el nombre de usuario proporcionado
		//(verificar existencia del usuario en la base de datos)
		$otdUsuario = $this->usuarios->buscar(NULL, $strUsuario);
		//Si hay información
		if($otdUsuario && password_verify($strContrasena, $otdUsuario->contrasena))
		{
			//Asignar datos al Array de variables de sesión
			$arrUsuario =array('empresa_id' => 1,
							   'sucursal_id' => 0,
							   'usuario_id' => $otdUsuario->usuario_id,
							   'usuario' => $otdUsuario->usuario,
							   'empleado' => $otdUsuario->empleado,
							   'empleado_firma' => $otdUsuario->empleado_firma,
							   'puesto_empleado' => $otdUsuario->puesto_empleado,
							   'inicio_sesion' => date("Y-m-d H:i:s"),
							   'direccion_ip' => $strIP,
							   'login' => TRUE,
							   'mensaje' => '',
							   'base_url' => base_url());
			//Asignar array con las variables de sesión que se utilizarán en el sistema
			$this->session->set_userdata($arrUsuario);

			//Llamar el método para guardar el inicio de sesión del usuario
			//Si regresa valor, se produjo algún error durante la llamada
			if ($this->usuarios->set_inicio_sesion() === FALSE)
			{
				//Cambiar mensaje de error
				$arrDatos['mensaje'] = 'Error durante el inicio de sesión, vuelva a intentarlo.';
			}
			else{
				//Cambiar datos del array  (asignar estado de éxito para poder ingresar al sistema)
				$arrDatos['state'] = TIPO_MSJ_EXITO;
				//Página a la que se redireccionará al usuario dependiendo del tipo de dispositivo
				if ($this->agent->is_mobile())
				{
					$arrDatos['pagina'] = 'movil';
				}
				else
				{
					$arrDatos['pagina'] = 'desktop';
				}
			}
		}
		else
		{
			//Si el usuario llegó al máximo de intentos, se suspende la cuenta
			if ($this->usuarios->get_intentos($strUsuario) == INTENTOS_MAXIMOS)
			{
				if ($this->usuarios->set_suspendido($strUsuario) === TRUE)
				{
					//Cambiar datos del array 
					$arrDatos['state'] = 'exceso_intentos';
					$arrDatos['titulo'] = 'Cuenta bloqueada';
					$arrDatos['mensaje'] = 'Se ha superado el número de intentos permitidos, comuníquese con el administrador.';
				}
			}
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método que se utiliza para destruir la sesión. 
	public function cerrar_sesion(){
		//Llamar el método para actualizar los datos de cierre de sesión del usuario
		$this->usuarios->set_cerrar_sesion();
		//Destruir la sesión
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}