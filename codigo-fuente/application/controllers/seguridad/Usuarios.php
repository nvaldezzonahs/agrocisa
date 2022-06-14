<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('seguridad/usuarios_model', 'usuarios');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('seguridad/usuarios', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->usuarios->filtro(trim($this->input->post('strBusqueda')),
										  $config['per_page'],
										  $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];

		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['usuarios'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionDesactivar = 'no-mostrar';
			$arrDet->mostrarAccionRestaurar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';
			//Variable que se utiliza para asignar  el color de fondo del registro
            $arrDet->estiloRegistro =  'registro-'.$arrDet->estatus;

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
				//Si el usuario cuenta con el permiso de acceso VER REGISTRO
				if (in_array('VER REGISTRO', $arrPermisos))
				{
					$arrDet->mostrarAccionVerRegistro = '';
				}
				
				
				//Si el usuario cuenta con el permiso de acceso CAMBIAR ESTATUS
				if (in_array('CAMBIAR ESTATUS', $arrPermisos))
				{
					//Asignar cadena vacia para mostrar botón Restaurar
					$arrDet->mostrarAccionRestaurar = '';
				}

			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['usuarios'],
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
		$objUsuario = new stdClass();
		//Variables que se utilizan para recuperar los valores de la vista 
		//Datos del usuario
		//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
		$objUsuario->intUsuarioID = $this->input->post('intUsuarioID');
		//Si no existe id del empleado asignar valor nulo
		$objUsuario->intEmpleadoID = (($this->input->post('intEmpleadoID') !== '') ? 
						   $this->input->post('intEmpleadoID') : NULL);
		$objUsuario->strUsuario = mb_strtoupper(trim($this->input->post('strUsuario')));
		$objUsuario->strUsuarioAnterior = mb_strtoupper($this->input->post('strUsuarioAnterior'));
		$objUsuario->strContrasena = $this->input->post('strContrasena');
		//Si hubo cambios en la contraseña
		if($objUsuario->strContrasena != '')
		{
			$objUsuario->strContrasena = password_hash($objUsuario->strContrasena, PASSWORD_BCRYPT);
		}
		$objUsuario->strCorreoElectronico = mb_strtolower($this->input->post('strCorreoElectronico'));
		$objUsuario->intSucursalID = $this->input->post('intSucursalID');
		$objUsuario->intUsuarioModID = $this->session->userdata('usuario_id');
		//Permisos de acces
		$objUsuario->strPermisosAcceso = $this->input->post('strPermisosAcceso');

		//Definir las reglas de validación
		//Validar que la descripción sea única
		if (($objUsuario->intUsuarioID == '') OR 
			($objUsuario->strUsuarioAnterior != $objUsuario->strUsuario))
		{
			$this->form_validation->set_rules('strUsuario', 'usuario', 'trim|required|is_unique[usuarios.usuario]');
		}
		else
		{
			$this->form_validation->set_rules('strUsuario', 'usuario', 'trim|required');
		}
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
			//Si obtenemos un id actualizamos los datos del registro, de lo contrario, se guarda un registro nuevo
			if (is_numeric($objUsuario->intUsuarioID))
			{
				$bolResultado = $this->usuarios->modificar($objUsuario);
			}
			else
			{
				$bolResultado = $this->usuarios->guardar($objUsuario);
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
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para modificar el estatus de un registro
	public function set_estatus()
	{
		//Definir las reglas de validación
		$this->form_validation->set_rules('intUsuarioID', 'ID', 'required|integer');
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
			$intID = $this->input->post('intUsuarioID');
			$strEstatus = $this->input->post('strEstatus');
			//Hacer un llamado al método para modificar el estatus del registro
			$bolResultado = $this->usuarios->set_estatus($intID, $strEstatus);
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

	//Método para regresar los datos de un registro
	public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$strBusqueda = $this->input->post('strBusqueda');
		$strTipo = $this->input->post('strTipo');
		//Dependiendo del tipo realizar la búsqueda de datos
		//Seleccionar los datos del registro que coincide con el parámetro enviado
		if($strTipo == 'id')
		{
			$otdResultado = $this->usuarios->buscar($strBusqueda);
		}
		else 
		{
    		$otdResultado = $this->usuarios->buscar(NULL, NULL, $strBusqueda);
		}
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para regresar el treeview con los usuarios
	/*****
	 * Parámetros
	 * intSubProcesoID - Indica el permiso de acceso a verificar de los usuarios
	 * strProcesoMensaje - Indica el proceso del mensaje 
	 * intReferenciaIDMensaje - Indica el id de la referencia del mensaje
	*****/
	public function get_treeview($intSubProcesoID = NULL, $strProcesoMensaje = NULL, 
							     $intReferenciaIDMensaje = NULL)
	{
		//Array que se utiliza para enviar el resultado a la vista
		$arrDatos = array();
		//Array que se utiliza para asignar los permisos de acceso
		$arrPermisos = array();
		//Variables que se utilizan para asignar el usuario anterior del recorrido de datos, de esta manera, se verificará si paso a otro usuario
		$intUsuarioIDAnterior = 0;
		$strUsuarioAnterior = '';
		//Variable que se utiliza para asignar los permisos de acceso del usuario anterior
		$strPermisosAnterior = '';
		//Variable que se utiliza para agregar los datos del usuario en el array 
		//en caso de que exista el permiso en la lista de accesos del usuario
		$strAgregar = '';
		//Variable que se utiliza para seleccionar el checkbox del treeview
		$bolSeleccionar = FALSE;
		//Si existe descripción del proceso y id de la referencia de un mensaje
		if($strProcesoMensaje !== NULL &&  $intReferenciaIDMensaje > 0)
		{
			
			//Quitar espacios vacíos y decodificar cadena cifrada
			$strProcesoMensaje = trim(urldecode($strProcesoMensaje));
			//Consulta de los usuarios que recibieron el mensaje
			$otdUsuarios = $this->usuarios->get_permisos(NULL, NULL, $strProcesoMensaje, $intReferenciaIDMensaje);
			//Si no existen usuarios correspondientes a la referencia del mensaje
			if(!$otdUsuarios)
			{
				//Consulta de los usuarios activos
				$otdUsuarios = $this->usuarios->get_permisos(NULL, NULL);

			}
			else
			{
				//Asignar TRUE para seleccionar checkbox del treeview
				$bolSeleccionar = TRUE;
			}
		}
		else
		{
			//Consulta de los usuarios activos
			$otdUsuarios = $this->usuarios->get_permisos(NULL, NULL);

		}
		
		//Recorrer los resultados para asignarlos en el array que se regresa a la vista
		foreach ($otdUsuarios as $row)
		{	
			//Separar los ID de los subprocesos a los que tiene acceso el usuario
		   	$arrPermisos = explode('|', $strPermisosAnterior);
		   

		   	//Verificar que el usuario  cuente con el permiso de acceso
			if($intSubProcesoID == 'VALIDACION_PROSPECTOS')
			{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(VALIDACION_PROSPECTOS, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}

			//Verificar que el usuario  cuente con el permiso de acceso
			if($intSubProcesoID == 'DEVOLUCION_ANTICIPOS_CLIENTES')
			{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(DEVOLUCION_ANTICIPOS_CLIENTES, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}

			//Verificar que el usuario  cuente con el permiso de acceso
			if($intSubProcesoID == 'AUTORIZAR_ORDENES_COMPRA_CUENTAS_PAGAR')
			{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_ORDENES_COMPRA_CUENTAS_PAGAR, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}

			//Verificar que el usuario  cuente con el permiso de acceso
			if($intSubProcesoID == 'AUTORIZAR_ORDENES_COMPRA_ESPECIALES_CUENTAS_PAGAR')
			{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_ORDENES_COMPRA_ESPECIALES_CUENTAS_PAGAR, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}

			//Verificar que el usuario  cuente con el permiso de acceso
			if($intSubProcesoID == 'AUTORIZAR_ORDENES_COMPRA_CONTROL_VEHICULOS')
			{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_ORDENES_COMPRA_CONTROL_VEHICULOS, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}

			//Verificar que el usuario  cuente con el permiso de acceso
			if($intSubProcesoID == 'AUTORIZAR_ORDENES_COMPRA_MAQUINARIA')
			{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_ORDENES_COMPRA_MAQUINARIA, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}

			//Verificar que el usuario  cuente con el permiso de acceso
			if($intSubProcesoID == 'AUTORIZAR_ORDENES_COMPRA_SERVICIO')
			{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_ORDENES_COMPRA_SERVICIO, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}


			//Verificar que el usuario  cuente con el permiso de acceso
			if($intSubProcesoID == 'AUTORIZAR_COTIZACIONES_MAQUINARIA')
			{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_COTIZACIONES_MAQUINARIA, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}

			//Verificar que el usuario  cuente con el permiso de acceso
			if($intSubProcesoID == 'AUTORIZAR_ORDENES_COMPRA_REFACCIONES')
			{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_ORDENES_COMPRA_REFACCIONES, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}

			//Verificar que el usuario  cuente con el permiso de acceso
			if($intSubProcesoID == 'AUTORIZAR_PEDIDOS_MAQUINARIA')
			{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_PEDIDOS_MAQUINARIA, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}

			//Verificar que el usuario  cuente con el permiso de acceso
			if($intSubProcesoID == 'AUTORIZAR_VALES_CAJA_CHICA_CAJA')
			{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_VALES_CAJA_CHICA_CAJA, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}

		    //Verificar que el usuario  cuente con el permiso de acceso
			if($intSubProcesoID == 'AUTORIZAR_PROVEEDORES')
			{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_PROVEEDORES, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}

			//Si el usuario cambio
   			if($intUsuarioIDAnterior != $row->usuario_id && $intUsuarioIDAnterior != 0 && $strAgregar == 'SI')
   			{
		   		//Agregar datos al array de usuarios
				$arrDatos[] = array('title' => $strUsuarioAnterior,
								    'icon'=> FALSE,
				                    'key' => $intUsuarioIDAnterior, 
				                    'children' =>  [],
				                    'selected' => $bolSeleccionar,
				                	'agregar' => TRUE);
				//Limpiar variable
				$strAgregar = '';
   			}

   			//Variable que se utiliza para asignar el nombre del empleado
			$strNombreEmpleado = (($row->empleado !== NULL && 
						           empty($row->empleado) === FALSE) ?
	                               ' - '.$row->empleado : '');

			//Inicializar variables
   			$intUsuarioIDAnterior = $row->usuario_id;
   			$strUsuarioAnterior =   $row->usuario.$strNombreEmpleado;
   			$strPermisosAnterior =  $row->permisos;
		}

		//Separar los ID de los subprocesos a los que tiene acceso el usuario
		$arrPermisos = explode('|', $strPermisosAnterior);

		//Verificar que el usuario  cuente con el permiso de acceso
		if($intSubProcesoID == 'VALIDACION_PROSPECTOS')
		{
		  	//Verificar permiso de acceso del último usuario
			if($strPermisosAnterior != '')
		   	{
		   		//Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(VALIDACION_PROSPECTOS, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
		   	}
		}

		//Verificar que el usuario  cuente con el permiso de acceso
		if($intSubProcesoID == 'DEVOLUCION_ANTICIPOS_CLIENTES')
		{
			//Verificar permiso de acceso del último usuario
			if($strPermisosAnterior != '')
		   	{
		   		//Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(DEVOLUCION_ANTICIPOS_CLIENTES, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
		   	}
		}

		//Verificar que el usuario  cuente con el permiso de acceso
		if($intSubProcesoID == 'AUTORIZAR_ORDENES_COMPRA_CUENTAS_PAGAR')
		{
			//Verificar permiso de acceso del último usuario
			if($strPermisosAnterior != '')
		   	{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_ORDENES_COMPRA_CUENTAS_PAGAR, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}
		}

		//Verificar que el usuario  cuente con el permiso de acceso
		if($intSubProcesoID == 'AUTORIZAR_ORDENES_COMPRA_ESPECIALES_CUENTAS_PAGAR')
		{
			//Verificar permiso de acceso del último usuario
			if($strPermisosAnterior != '')
		   	{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_ORDENES_COMPRA_ESPECIALES_CUENTAS_PAGAR, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}
		}

		//Verificar que el usuario  cuente con el permiso de acceso
		if($intSubProcesoID == 'AUTORIZAR_ORDENES_COMPRA_CONTROL_VEHICULOS')
		{
			//Verificar permiso de acceso del último usuario
			if($strPermisosAnterior != '')
		   	{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_ORDENES_COMPRA_CONTROL_VEHICULOS, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}
		}

		//Verificar que el usuario  cuente con el permiso de acceso
		if($intSubProcesoID == 'AUTORIZAR_ORDENES_COMPRA_MAQUINARIA')
		{
			//Verificar permiso de acceso del último usuario
			if($strPermisosAnterior != '')
		   	{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_ORDENES_COMPRA_MAQUINARIA, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}
		}

		//Verificar que el usuario  cuente con el permiso de acceso
		if($intSubProcesoID == 'AUTORIZAR_ORDENES_COMPRA_SERVICIO')
		{
			//Verificar permiso de acceso del último usuario
			if($strPermisosAnterior != '')
		   	{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_ORDENES_COMPRA_SERVICIO, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}
		}

		//Verificar que el usuario  cuente con el permiso de acceso
		if($intSubProcesoID == 'AUTORIZAR_COTIZACIONES_MAQUINARIA')
		{
			//Verificar permiso de acceso del último usuario
			if($strPermisosAnterior != '')
		   	{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_COTIZACIONES_MAQUINARIA, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}
		}

		//Verificar que el usuario  cuente con el permiso de acceso
		if($intSubProcesoID == 'AUTORIZAR_ORDENES_COMPRA_REFACCIONES')
		{
			//Verificar permiso de acceso del último usuario
			if($strPermisosAnterior != '')
		   	{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_ORDENES_COMPRA_REFACCIONES, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}
		}
		
		//Verificar que el usuario  cuente con el permiso de acceso
		if($intSubProcesoID == 'AUTORIZAR_PEDIDOS_MAQUINARIA')
		{
			//Verificar permiso de acceso del último usuario
			if($strPermisosAnterior != '')
		   	{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_PEDIDOS_MAQUINARIA, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}
		}

		//Verificar que el usuario  cuente con el permiso de acceso
		if($intSubProcesoID == 'AUTORIZAR_VALES_CAJA_CHICA_CAJA')
		{
			//Verificar permiso de acceso del último usuario
			if($strPermisosAnterior != '')
		   	{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_VALES_CAJA_CHICA_CAJA, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}
		}

		//Verificar que el usuario  cuente con el permiso de acceso
		if($intSubProcesoID == 'AUTORIZAR_PROVEEDORES')
		{
			//Verificar permiso de acceso del último usuario
			if($strPermisosAnterior != '')
		   	{
		   	    //Si el permiso se encuentra en los accesos del usuario
			   	if(in_array(AUTORIZAR_PROVEEDORES, $arrPermisos))
			    {
			    	//Asignar SI -> para agregar datos del usuario en el array
			    	$strAgregar = 'SI';
			    }
			}
		}

		//Agregar datos del último usuario
		if($intUsuarioIDAnterior != 0 && $strAgregar == 'SI')
		{
			//Agregar datos al array de usuarios
			$arrDatos[] = array('title' => $strUsuarioAnterior,
								'icon'=> FALSE,
				                'key' => $intUsuarioIDAnterior, 
				                'children' =>  [],
				                'selected' => $bolSeleccionar,
				                'agregar' => TRUE);
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para regresar todos los registros activos en un autocomplete
	public function autocomplete()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$strDescripcion = trim($this->input->post('strDescripcion'));

		//Si existe descripción
		if(isset($strDescripcion))
		{
			//Array que se utiliza para enviar datos a la vista
			$arrDatos = array();
			//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento) 
			$strDescripcion = mb_strtoupper($strDescripcion);
			//Hacer un llamado al método para obtener todos los registros (activos) 
			//que coincidan con la descripción
			$otdResultado = $this->usuarios->autocomplete($strDescripcion);
			//Si se obtienen coincidencias
	    	if ($otdResultado)
			{
				//Recorremos el arreglo 
				foreach ($otdResultado as $arrCol)
				{
		        	$arrDatos[] = array('value'=>$arrCol->usuario, 
		        						'data'=>$arrCol->usuario_id);
				}
	    	}
			
			//Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		}
	}


	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte() 
	{	            
		//Variables que se utilizan para recuperar los valores de la vista
		$strBusqueda = trim($this->input->post('strBusqueda'));
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		
		//Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->usuarios->buscar(NULL, NULL, NULL, $strBusqueda); 
		
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'LISTADO DE USUARIOS';
		$pdf->arrCabecera = array('USUARIO', utf8_decode('CORREO ELECTRÓNICO'), 'EMPLEADO', 'SUCURSALES',
							 'ESTATUS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(35, 45, 40, 50, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L', 'C');
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
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol->usuario), utf8_decode($arrCol->correo_electronico), 
							    utf8_decode($arrCol->empleado), utf8_decode($arrCol->sucursales), 
							    $arrCol->estatus), $pdf->arrAlineacion);
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
		$pdf->Output('usuarios.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$strBusqueda = trim($this->input->post('strBusqueda'));
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        
        //Seleccionar los datos de los registros que coinciden con el parámetro enviado
		$otdResultado = $this->usuarios->buscar(NULL, NULL, NULL, $strBusqueda); 
     	
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE USUARIOS');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'USUARIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'CORREO ELECTRÓNICO')
        		 ->setCellValue('C'.$intPosEncabezados, 'EMPLEADO')
        		 ->setCellValue('D'.$intPosEncabezados, 'SUCURSALES')
                 ->setCellValue('E'.$intPosEncabezados, 'ESTATUS');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
        		 ->getStyle('A9:E9')
        		 ->getFill()
        		 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFila, $arrCol->usuario)
                         ->setCellValue('B'.$intFila, $arrCol->correo_electronico)
                         ->setCellValue('C'.$intFila, $arrCol->empleado)
                         ->setCellValue('D'.$intFila, $arrCol->sucursales)
                         ->setCellValue('E'.$intFila, $arrCol->estatus);
                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar alineación de las siguientes celdas
			$objExcel->getActiveSheet()
                	 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);
			//Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('E'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('E'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'usuarios.xls', 'usuarios', $intFila);
	}
}