<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones_actualizacion_precios extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('refacciones/refacciones_actualizacion_precios_model', 'actualizaciones');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('refacciones/refacciones_actualizacion_precios', $arrDatos);
	}

	//Método  que regresa un listado de los registros en formato JSON.
	public function get_paginacion()
	{
		$config['base_url'] = '';
		$config['per_page'] = PAGINACION_ELEMENTOS;
		$config['cur_page'] =  $this->input->post('intPagina');
		//Seleccionar los datos que coinciden con los criterios de búsqueda
		$result = $this->actualizaciones->filtro($this->input->post('dteFechaInicial'),
											     $this->input->post('dteFechaFinal'),
											     $this->input->post('intRefaccionesListaPrecioID'),
											     trim($this->input->post('strBusqueda')),
			                                     $config['per_page'],
			                                     $config['cur_page']);
		$config['total_rows'] = $result['total_rows'];
		//Array que se utiliza para obtener los permisos del usuario
		$arrPermisos = explode('|', $this->encrypt->decode($this->input->post('strPermisosAcceso')));

		//Hacer recorrido para validar los permisos del usuario en el grid
		foreach ($result['actualizaciones'] as $arrDet)
		{
			//Asignamos el valor no-mostrar a los botones del grid
			$arrDet->mostrarAccionEditar = 'no-mostrar';
			$arrDet->mostrarAccionVerRegistro = 'no-mostrar';

			//Si el usuario cuenta con el permiso de acceso EDITAR
			if (in_array('EDITAR', $arrPermisos))
			{
				//Asignar cadena vacia para mostrar botón Editar
				$arrDet->mostrarAccionEditar = '';
			}

			//Si el usuario cuenta con el permiso de acceso VER REGISTRO
			if (in_array('VER REGISTRO', $arrPermisos))
			{
				$arrDet->mostrarAccionVerRegistro = '';
			}
		}
		//Inicializar paginación de registros
		$this->pagination->initialize($config); 
		$arrDatos = array('rows' => $result['actualizaciones'],
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

	//Método para guardar los datos de un registro
	public function guardar()
	{ 
		//Variables que se utilizan para recuperar los valores de la vista
		//Datos de la actualización de precios
		$intRefaccionesListaPrecioID = $this->input->post('intRefaccionesListaPrecioID');
		$strBase = $this->input->post('strBase');
		$intReferenciaID = $this->input->post('intReferenciaID');
		$intPorcentaje = $this->input->post('intPorcentaje');
		$intTipoCambio = $this->input->post('intTipoCambio');
		//Datos de los detalles
		$strRefaccionesLineaID = $this->input->post('strRefaccionesLineaID');
		  
      	//Guardamos los datos del registro
		$bolResultado = $this->actualizaciones->guardar($intRefaccionesListaPrecioID, $strBase, $intReferenciaID, 
					 						            $intPorcentaje, $intTipoCambio, $strRefaccionesLineaID);

		/*Quitar '_'  de la cadena (resultadoTransaccion_impacto) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
			 */
		list($bolResultado, $intImpacto) = explode("_", $bolResultado); 
        //Si no se obtienen errores al ejecutar el proceso
		if($bolResultado)
		{
			//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE,
						 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
						 	  'impacto' => $intImpacto,
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
	
    //Método para regresar los datos de un registro
    public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => NULL);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intID = $this->input->post('intRefaccionActualizacionPrecioID');
		//Seleccionar los datos del registro que coincide con el id
	    $otdResultado = $this->actualizaciones->buscar($intID);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			$arrDatos['row'] = $otdResultado;
			
			//Seleccionar los detalles del registro
			$otdDetalles = $this->actualizaciones->buscar_detalles($otdResultado->refaccion_actualizacion_precio_id);
			//Si existen detalles del registro, se asignan al array
			if($otdDetalles)
			{
				$arrDatos['detalles'] = $otdDetalles;
			}
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}
}