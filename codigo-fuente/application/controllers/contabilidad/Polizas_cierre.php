<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polizas_cierre extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('contabilidad/polizas_model', 'polizas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('contabilidad/polizas_cierre', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para guardar la póliza de cierre
	public function guardar()
	{
		// Asignar la fecha de creación de la póliza
		$strFecha = $this->input->post('intAnio').'-12-31';
		$intProcesoMenuID = $this->encrypt->decode($this->input->post('intProcesoMenuID'));


		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objPoliza = new stdClass();
		$objPoliza->intPolizaID = 0;
		$objPoliza->intSucursalID = $this->session->userdata('sucursal_id');
		$objPoliza->strTipo = 'DIARIO';
		$objPoliza->strModulo = 'CONTABILIDAD';
		$objPoliza->strProceso = 'POLIZA';
		 //Asignar SI para indicar que la póliza corresponde al cierre anual
		$objPoliza->strCierreAnual = 'SI';
		$objPoliza->intReferenciaID = NULL;
		//Hacer un llamado a la función para generar el folio consecutivo de la póliza
		$objPoliza->strFolio = $this->get_folio_consecutivo($intProcesoMenuID, 10);
		$objPoliza->dteFecha = $strFecha;
		$objPoliza->strConcepto = mb_strtoupper(trim($this->input->post('strConcepto')));
		$objPoliza->strObservaciones = '';
		$objPoliza->strEstatus = 'ACTIVO';
		$objPoliza->intUsuarioID = $this->session->userdata('usuario_id');
		//Datos de los detalles
		$objPoliza->arrDetalles = $this->polizas->generar_detalles_polizas_cierre($strFecha, $this->input->post('intCuentaID'));


		//Variable que se utiliza para asignar respuesta de acción de la base de datos
		$bolResultado = NULL;

		//Si no existe folio del proceso
		if($objPoliza->strFolio == '')
		{
			//Enviar el mensaje de error al formulario
			$arrDatos = array('resultado' => FALSE,
							  'tipo_mensaje' => TIPO_MSJ_ERROR,
							  'mensaje' => MSJ_GENERAR_FOLIO);
		}
		else
		{
			$bolResultado = $this->polizas->guardar($objPoliza);
			//Quitar '_'  de la cadena (resultadoTransaccion_polizaID) para obtener el resultado de la transacción del movimiento en la BD y el id del registro 
			list($bolResultado, $objPoliza->intPolizaID) = explode("_", $bolResultado);
		}

		//Si se ejecutó acción en la base de datos
		if($bolResultado !== NULL)
		{
			//Si no se obtienen errores al ejecutar el proceso
			if($bolResultado)
			{
				//Separar cadena que contiene el folio consecutivo
				$arrFolio = explode("_", $objPoliza->strFolio);

				//Enviar el mensaje de éxito al formulario
				$arrDatos = array('resultado' => TRUE,
								  'tipo_mensaje' => TIPO_MSJ_EXITO,
								  'poliza_id' => $objPoliza->intPolizaID,
								  'folio' => $arrFolio[0],
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
}