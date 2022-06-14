<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio_presupuestos_mano_obra extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('servicio/servicio_presupuestos_mano_obra_model', 'presupuestos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('servicio/servicio_presupuestos_mano_obra', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para guardar o modificar los datos de un presupuesto
	public function guardar()
	{ 
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objServicioPresupuestoMO = new stdClass();
		//Array que se utiliza para agregar los datos del presupuesto
	    $objServicioPresupuestoMO->arrDatos = array();
	    //Array que se utiliza para agregar los datos de un mes
	    $arrAuxiliar = array(); 
		//Variables que se utilizan para recuperar los valores de la vista 
		$objServicioPresupuestoMO->strNuevoID = $this->input->post('strNuevoID');
		$objServicioPresupuestoMO->intMecanicoID = $this->input->post('intMecanicoID');
		$objServicioPresupuestoMO->strAnio = $this->input->post('strAnio');
		$objServicioPresupuestoMO->intUsuarioID = $this->session->userdata('usuario_id');

	    //Hacer recorrido para agregar al array los datos del presupuesto
        for ($intCont = 0; $intCont < count($this->ARR_MESES); $intCont++)
        {	
        	//Variable que se utiliza para asignar el importe del mes
        	$intImporte = 0;
        	$intHoras = 0;
			$intImporte = trim($this->input->post('intImporte'.$this->ARR_MESES[$intCont]));
			$intHoras = trim($this->input->post('intHoras'.$this->ARR_MESES[$intCont]));
    		//Definir valores del array auxiliar de información (para cada mes)
           	$arrAuxiliar["mes"] = $this->ARR_MESES[$intCont];
           	$arrAuxiliar["importe"] = $intImporte;
           	$arrAuxiliar["horas"] = $intHoras;
           	//Si existen datos del presupuesto
           	if ($objServicioPresupuestoMO->strNuevoID == '')
           	{
           		$arrAuxiliar["mecanico_id"] = $objServicioPresupuestoMO->intMecanicoID;
            	$arrAuxiliar["anio"] = $objServicioPresupuestoMO->strAnio;	
           		$arrAuxiliar["fecha_creacion"] = date("Y-m-d H:i:s");
           		$arrAuxiliar["usuario_creacion"] = $objServicioPresupuestoMO->intUsuarioID;
           	}
           	else
           	{
           		$arrAuxiliar["fecha_actualizacion"] = date("Y-m-d H:i:s");
           		$arrAuxiliar["usuario_actualizacion"] = $objServicioPresupuestoMO->intUsuarioID;
           	}
           	
           	//Asignar datos al array resultado
            array_push($objServicioPresupuestoMO->arrDatos, $arrAuxiliar);

        }   

		//Si existe un presupuesto actualizamos los datos de los registros, de lo contrario, se guarda un presupuesto nuevo
		if ($objServicioPresupuestoMO->strNuevoID == '')
		{
			$bolResultado = $this->presupuestos->guardar($objServicioPresupuestoMO->arrDatos);
		}
		else
		{
			$bolResultado = $this->presupuestos->modificar($objServicioPresupuestoMO);
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

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
		
	}

    //Método para regresar los datos de un presupuesto
	public function get_datos()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row_importes' => NULL, 'row_horas' => NULL);
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Array que se utiliza para agregar los datos del presupuesto
	    $arrImportes = array();
	    $arrHoras = array();
		//Variables que se utilizan para recuperar los valores de la vista 
		$intMecanicoID = $this->input->post('intMecanicoID');
		$strAnio = $this->input->post('strAnio');
		//Seleccionar los datos del presupuesto que coincide con los parámetros enviados
	  	$otdResultado = $this->presupuestos->buscar($intMecanicoID, $strAnio);
		//Si existen datos, asignar los datos recuperados en el array
		if($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol) 
			{	
				//Variable que se utiliza para asignar el importe del mes
				$strImporte = '';
				//Variable que se utiliza para asignar el importe del horas
				$strHoras = '';

				//Si importe es mayor que cero
				if($arrCol->importe > 0)
				{
					$strImporte =  $arrCol->importe;
					$strHoras = $arrCol->horas;
				}
				
				//Asignar datos al array resultado
				$arrImportes["importe".$this->ARR_MESES[$intContador]] = $strImporte;
				$arrHoras["horas".$this->ARR_MESES[$intContador]] = $strHoras;
				//Incrementar el contador por cada registro
				$intContador++;
			}

			$arrDatos['row_importes'] = $arrImportes;
			$arrDatos['row_horas'] = $arrHoras;
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}	
}