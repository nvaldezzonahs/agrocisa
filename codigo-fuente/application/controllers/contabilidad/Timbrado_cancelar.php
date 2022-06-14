<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timbrado_cancelar extends MY_Controller {

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar ruta de la carpeta principal
	    $this->archivo['strCarpetaPrincipal'] = './archivos/';
		//Cargamos el modelo de empresas
		$this->load->model('administracion/empresas_model', 'empresas');
		//Cargamos el modelo de certificados
		$this->load->model('contabilidad/certificados_model', 'certificados');
		//Cargamos el modelo de anticipos
		$this->load->model('caja/anticipos_model', 'anticipos');
		//Cargamos el modelo de aplicación de anticipo
		$this->load->model('caja/anticipos_aplicacion_model', 'aplicacion');
		//Cargamos el modelo de pagos
		$this->load->model('caja/pagos_model', 'pagos');
		//Cargamos el modelo de facturas de servicio
		$this->load->model('servicio/facturas_servicio_model', 'facturas_servicio');
		//Cargamos el modelo de facturas de refacciones
		$this->load->model('refacciones/facturas_refacciones_model', 'facturas_refacciones');
		//Cargamos el modelo de facturas de maquinaria
		$this->load->model('maquinaria/facturas_maquinaria_model', 'facturas_maquinaria');
		//Cargamos el modelo de facturas de conceptos
		$this->load->model('contabilidad/facturas_conceptos_model', 'facturas_conceptos');
		//Cargamos el modelo de movimientos de refacciones
		$this->load->model('refacciones/movimientos_refacciones_model', 'movimientos_refacciones');
		//Cargamos el modelo de entradas de maquinaria por devolución
		$this->load->model('maquinaria/entradas_maquinaria_devolucion_model', 'entradas_maquinaria_devolucion');
		//Cargamos el modelo de notas de crédito servicio
		$this->load->model('servicio/notas_credito_servicio_model', 'notas_credito_servicio');
		//Cargamos el modelo de notas de crédito digitales
		$this->load->model('cuentas_cobrar/notas_credito_digitales_model', 'notas_credito_digitales');
		//Cargamos el modelo de notas de cargo digitales
		$this->load->model('cuentas_cobrar/notas_cargo_digitales_model', 'notas_cargo_digitales');
		//Variable que se utiliza para asignar los errores del timbrado al ejecutar el servicio de facturación
        $this->ARR_DATOS['strErrorXML'] = '';
        //Variable que se utiliza para asignar el tipo de mensaje de error
        $this->ARR_DATOS['strTipoMensaje'] = '';
	}

	//Método para cancelar los datos del timbrado de un registro
	public function set_cancelar()
	{
		//Variables que se utilizan para recuperar los valores de la vista 
		$intMovimientoID = $this->input->post('intMovimientoID');
		$strTipoReferencia = $this->input->post('strTipoReferencia');
		$strMotivo = $this->input->post('strMotivo');
		$strUuidSustitucion = $this->input->post('strUuidSustitucion');

		//Datos para cambiar el estatus del registro
		//Crear un objeto vacio, stdClass es el objeto por default de PHP
		$objCancelacionCfdi = new stdClass();
		//Datos para la cancelación del registro
		$objCancelacionCfdi->intReferenciaCfdiID = $intMovimientoID;
		$objCancelacionCfdi->strTipoReferenciaCfdi = $strTipoReferencia;
		$objCancelacionCfdi->intCancelacionMotivoID = $this->input->post('intCancelacionMotivoID');
		//Si no existe id del tipo de relación asignar valor nulo
		$objCancelacionCfdi->intSustitucionID = (($this->input->post('intSustitucionID') !== '') ? 
					   	   						 	 $this->input->post('intSustitucionID') : NULL);

		$objCancelacionCfdi->intPolizaID = $this->input->post('intPolizaID');
		//Datos para modificar el estatus de la referencia(cotización/pedido/remisión)
		$objCancelacionCfdi->strTipoReferenciaReg = $this->input->post('strTipoReferenciaReg');
		$objCancelacionCfdi->intReferenciaIDReg  = $this->input->post('intReferenciaIDReg');
	
		

		//Array que se utiliza para obtener los permisos del usuario
		$arrMotivo = explode('-', $strMotivo);
		$strCodigoMotivo = $arrMotivo[0];

		//Hacer un llamado a la función para generar la cancelación del registro
		$this->cancelar($intMovimientoID, $strTipoReferencia, $strCodigoMotivo, $strUuidSustitucion);

		//Si no se obtienen errores al ejecutar el proceso
		if ($this->ARR_DATOS['strErrorXML'] == '')
		{	

			//Hacer un llamado a la función para cambiar el estatus del registro y guardar cancelación
			$arrDatos = $this->set_estatus($objCancelacionCfdi);
			
		}
		else
		{
			//Enviar el mensaje de error al formulario
			$arrDatos = array('resultado' => FALSE, 'tipo_mensaje' => $this->ARR_DATOS['strTipoMensaje'], 'mensaje' =>  $this->ARR_DATOS['strErrorXML']);
		}

		//Enviar datos a la vista
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para generar una cancelación con los datos de timbrado proporcionados
	public function cancelar($intMovimientoID, $strTipoReferencia, $strCodigoMotivo, $strUuidSustitucion = NULL)
	{	
		//Variable que se utiliza para asignar los resultados de la respuesta al servidor Web Facturaxion 
        //que se utiliza para generar timbre
        $strResultado = "";
	    
	    //Asignar objeto con los datos de la referencia que se utilizan para la búsqueda del registro
		$otdReferencia =  $this->get_referencia($strTipoReferencia, 'busqueda');
		//Asignar valores de la referencia
		$strModeloReferencia = $otdReferencia['modelo'];
		$strMetodoBusqueda = $otdReferencia['metodo_busqueda'];

		//------------------------------------------------------------------------------------------------------------------------
		//---------- MOVIMIENTO FISCAL
		//------------------------------------------------------------------------------------------------------------------------
	    //Seleccionar datos del movimiento (Busca en el modelo correspondiente)
	    $otdMovimiento = $this->$strModeloReferencia->$strMetodoBusqueda($intMovimientoID);

		//------------------------------------------------------------------------------------------------------------------------
		//---------- CERTIFICADO DIGITAL
		//------------------------------------------------------------------------------------------------------------------------
		//Seleccionar datos del certificado activo
		$otdCertificado = $this->certificados->buscar(NULL, NULL, 'ACTIVO');
		
		//------------------------------------------------------------------------------------------------------------------------
		//---------- RUTAS DE LOS ARCHIVOS KEY Y CER
		//------------------------------------------------------------------------------------------------------------------------
		$rutaLlavePrivada = "./certificados/".$otdCertificado->folio.".key.pem";
		$rutaCertificado = "./certificados/".$otdCertificado->folio.".cer.pem";

		//------------------------------------------------------------------------------------------------------------------------
		//---------- CONEXIÓN CON EL SERVICIO WEB
		//------------------------------------------------------------------------------------------------------------------------
		set_time_limit(0);

		$objClienteSOAP = new SoapClient(WS_URL_CFDI_CANCELAR);

		//---------- AUTENTICACION CON EL SERVICIO WEB
		$objAutenticacion = new Autenticar();
		$objAutenticacion->usuario = WS_USUARIO;
		$objAutenticacion->password = WS_CONTRASENA;

		//---------- ASIGNACIÓN DE PARÁMETROS
		$objCancelar = new Cancelar();
		$objCancelar->rfcEmisor = $otdMovimiento[0]->RFC;
		$objCancelar->fecha = substr($otdMovimiento[0]->Fecha, 0, 10)."T".substr($otdMovimiento[0]->Fecha, 11);

		$objFolio = new Folios();
		$objFolio->uuid = $otdMovimiento[0]->uuid;
		$objFolio->motivo = $strCodigoMotivo;
		//Si el código del motivo de cancelación es 01-Comprobante emitido con errores con relación.
		if($strCodigoMotivo == '01') {
			$objFolio->folioSustitucion = $strUuidSustitucion;
		} else {
			$objFolio->folioSustitucion = '';
		}
		$objCancelar->folios = $objFolio;

		//------------------------------------------------------------------------------------------------------------------------
		//---------- LECTURA DEL CERTIFICADO
		//------------------------------------------------------------------------------------------------------------------------
		$objGestor = fopen($rutaCertificado,"r");
		$objContenido = fread($objGestor, filesize($rutaCertificado));
		$objCancelar->publicKey = $objContenido;

		//------------------------------------------------------------------------------------------------------------------------
		//---------- LECTURA DE LA LLAVE PRIVADA
		//------------------------------------------------------------------------------------------------------------------------
		$objGestor = fopen($rutaLlavePrivada,"r");
		$objContenido = fread($objGestor, filesize($rutaLlavePrivada));
		$objCancelar->privateKey = $objContenido;
		$objCancelar->password = CONTRASENA_LLAVE_PRIVADA;
		//----------- ASIGNAMOS EL OBJETO DE AUTENTICACIÓN
		$objCancelar->accesos = $objAutenticacion;

		$arrCancelar = array(
			'rfcEmisor' => $objCancelar->rfcEmisor,
			'fecha' => $objCancelar->fecha,
			'folios' => array(
				'folio' => array(
					'folioSustitucion' => $objFolio->folioSustitucion,
					'motivo' => $objFolio->motivo,
					'uuid' => $objFolio->uuid
				)
			),
			'publicKey' => $objCancelar->publicKey,
			'privateKey' => $objCancelar->privateKey,
			'password' => $objCancelar->password,
			'accesos' => array(
				'password' => $objAutenticacion->password,
				'usuario' => $objAutenticacion->usuario
			)
		);


		//---------- TOMAMOS LA RESPUESTA
		$objRespuesta = $objClienteSOAP->Cancelacion40_1($arrCancelar);

		if ($objRespuesta->return->codEstatus != 0)
		{
			$this->ARR_DATOS['strErrorXML']= 'Ocurrió un error al cancelar el folio: '.$otdMovimiento[0]->folio.' '.
											 ' Error '.utf8_encode($objRespuesta->return->codEstatus.' '.
											 $objRespuesta->return->mensaje);	
			$this->ARR_DATOS['strTipoMensaje'] = 'error_timbrado';
		}
		else if ($objRespuesta->return->folios->folio->estatusUUID != CODIGO_EXITO_CANCELACION)
		{
			$this->ARR_DATOS['strErrorXML']= 'Ocurrió un error al cancelar el folio: '.$otdMovimiento[0]->folio.'. '.
											 'Error: '.utf8_encode($objRespuesta->return->folios->folio->estatusUUID.'-'.
											 $objRespuesta->return->folios->folio->mensaje);	
			$this->ARR_DATOS['strTipoMensaje'] = 'error_timbrado';
		}

		$this->ARR_DATOS['strTipoMensaje'] = 'error_timbrado';

    }

    //Función para cambiar el estatus de un registro y guardar cancelación
	public function set_estatus(stdClass $objCancelacionCfdi)
	{
		//Asignar objeto con los datos de la referencia que se utilizan para la búsqueda del registro
		$otdReferencia =  $this->get_referencia($objCancelacionCfdi->strTipoReferenciaCfdi, 'set_cancelar');
		//Asignar valores de la referencia
		$strModeloReferencia = $otdReferencia['modelo'];
		$strMetodoBusqueda = $otdReferencia['metodo_busqueda'];
	   
        //Hacer un llamado al método para cambiar el estatus de un registro
		$bolResultado = $this->$strModeloReferencia->$strMetodoBusqueda($objCancelacionCfdi);

		//Si no se obtienen errores al ejecutar el proceso
		if($bolResultado)
		{
			//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE, 'tipo_mensaje' => TIPO_MSJ_EXITO, 'mensaje' => 'El registro se canceló correctamente.');
		}
		else
		{
			//Enviar el mensaje de error al formulario
			$arrDatos = array('resultado' => FALSE, 
							  'tipo_mensaje' => 'error_timbrado', 
							  'mensaje' => MSJ_ERROR_GUARDAR);
		}


		//Regresar array de datos
		return $arrDatos;
		
	}


    //Función que se utiliza para regresar los datos de la referencia (modelo, método de búsqueda, etc.)
	public function get_referencia($strTipoReferencia, $strTipoAccion)
	{
		//Array que se utiliza para enviar datos
		$arrDatos = array('modelo' => '', 
					      'metodo_busqueda' => '');
		//Variable para asignar tipo de referencia
		$strModeloReferencia = '';

		if($strTipoAccion == 'busqueda')
		{
			//Método que se utiliza para la obtener los datos del movimiento fiscal
	    	$strMetodoBusqueda = 'buscar_movimiento_fiscal';
		}
		else
		{
			//Método que se utiliza para la obtener los datos del movimiento fiscal
	    	$strMetodoBusqueda = 'set_cancelar';
		}
	

		//Dependiendo del tipo de referencia seleccionar los datos del registro
	    switch ($strTipoReferencia) 
	    { 
		    
		   	case "ANTICIPO":
		    	$strModeloReferencia = 'anticipos';
		    	break;
		    case "APLICACION ANTICIPO":
		        $strModeloReferencia = 'aplicacion';
		        break;
		    case "PAGO":
		    	$strModeloReferencia = 'pagos';
		    	break;
		    case "FACTURA SERVICIO":
		    	$strModeloReferencia = 'facturas_servicio';
		    	break;
		    case "FACTURA REFACCIONES":
		    	$strModeloReferencia = 'facturas_refacciones';
		    	break;
		    case "FACTURA MAQUINARIA":
		    	$strModeloReferencia = 'facturas_maquinaria';
		    	break;
		    case "FACTURA CONCEPTOS":
		    	$strModeloReferencia = 'facturas_conceptos';
		    	break;
		    case "DEVOLUCION REFACCIONES":
		    	$strModeloReferencia = 'movimientos_refacciones';
		    	break; 
		    case "DEVOLUCION MAQUINARIA":
		    	$strModeloReferencia = 'entradas_maquinaria_devolucion';
		    	break;
		    case "DEVOLUCION SERVICIO":
		    	$strModeloReferencia = 'notas_credito_servicio';
		    	break;	
		    case "NOTA CREDITO":
		    	$strModeloReferencia = 'notas_credito_digitales';
		    	break;
		    case "NOTA CARGO":
		    	$strModeloReferencia = 'notas_cargo_digitales';
		    	break;			  
		}

		//Agregar datos al array
		$arrDatos['modelo'] = $strModeloReferencia;
		$arrDatos['metodo_busqueda'] = $strMetodoBusqueda;

		//Regresar array con los datos de la referencia
		return $arrDatos;
	}

	

}


//------------------------------------------------------------------------------------------------------------------------
//---------- CLASES
//------------------------------------------------------------------------------------------------------------------------
class Autenticar
{
	public $usuario;
	public $password;
}

class Cancelar
{
	public $rfcEmisor;
	public $fecha;
	public $folios;
	public $publicKey;
	public $privateKey;
	public $password;
	public $accesos;
}

class Folios {
	public $folioSustitucion;
	public $motivo;
	public $uuid;
}
