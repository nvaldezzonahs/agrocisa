<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* Cargar libreria para generar el archivo Excel*/
include_once(APPPATH . 'libraries/utilerias/PHPExcel/IOFactory.php');
set_time_limit(1000);

class MY_Controller extends CI_Controller {

	//Información que se utiliza para asignar el número de decimales a redondear
	var $intNumDecimales = NUM_DECIMALES_MOSTRAR_CUENTAS_PAGAR;
	//Información que se utiliza para asignar el número de decimales a redondear del IVA unitario
	var $intNumDecimalesIvaUnitario = NUM_DECIMALES_IVA_UNIT_OC_CUENTAS_PAGAR;
	//Información que se utiliza para asignar el número de decimales a redondear del IEPS unitario
	var $intNumDecimalesIepsUnitario = NUM_DECIMALES_IEPS_UNIT_OC_CUENTAS_PAGAR;
	//Asignar el número máximo de las colummas dináminas (ARR_COLUMNAS)
	var $intNumColumnasDinamicas = 104;

	//Constructor de la clase
	function __construct () {
		parent::__construct();
	    //Cargamos el modelo de empresas
	    $this->load->model('administracion/empresas_model','empresas');
	    //Cargamos el modelo de sucursales
	    $this->load->model('administracion/sucursales_model','sucursales');
	    //Cargamos el modelo de folios por proceso
	    $this->load->model('administracion/folios_procesos_model','consecutivos');
	    //Cargamos el modelo de folios por póliza
	    $this->load->model('administracion/folios_polizas_model','consecutivos_poliza');
	    //Cargamos el modelo de pólizas
	    $this->load->model('contabilidad/polizas_model','polizas_referencia');
	    //Cargamos el modelo de pagos a proveedores
		$this->load->model('cuentas_pagar/pagos_proveedores_model', 'pagos_proveedor');
		//Cargamos el modelo de pagos de clientes (prospectos)
		$this->load->model('caja/pagos_model', 'pagos_cliente');
		//Cargamos el modelo de anticipos de clientes
		$this->load->model('caja/anticipos_model', 'anticipos_cliente');
		//Cargamos el modelo de facturas de refacciones
		$this->load->model('refacciones/facturas_refacciones_model', 'facturas_refacciones');
		//Cargamos el modelo de pedidos de refacciones
		$this->load->model('refacciones/pedidos_refacciones_model', 'pedidos_refacciones');
		//Cargamos el modelo de remisiones de refacciones
		$this->load->model('refacciones/remisiones_refacciones_model', 'remisiones_refacciones');


	}

	//Arreglo se utiliza para asignar las columnas dinámicas de un archivo XLS
	public $ARR_COLUMNAS = array(1 => "A", 2 => "B", 3 => "C", 4 => "D", 5 => "E", 6 =>"F", 7 =>"G", 8 =>"H",
	    					     9 => "I", 10 => "J", 11 => "K", 12 => "L", 13 => "M", 14 => "N", 15 => "O", 
	    					     16 => "P", 17 => "Q", 18 => "R", 19 => "S", 20 => "T", 21 => "U", 22 => "V", 
	    					     23 => "W", 24 => "X", 25 => "Y", 26 => "Z", 27 => "AA", 28 => "AB", 29 => "AC",
	    					     30 => "AD", 31 => "AE", 32 =>"AF", 33 =>"AG", 34=>"AH", 35 => "AI", 36 => "AJ",
	    					     37 => "AK", 38 => "AL", 39 => "AM", 40 => "AN", 41 => "AO", 42 => "AP", 
	    					     43 => "AQ", 44 => "AR", 45 => "AS", 46 => "AT", 47 => "AU", 48 => "AV", 
	    					     49 => "AW", 50 => "AX", 51 => "AY", 52 => "AZ", 
	    					     53 => "BA", 54 => "BB", 55 => "BC", 56 => "BD", 57 => "BE", 58 =>"BF", 
	    					     59 =>"BG", 60 =>"BH", 61 => "BI", 62 => "BJ", 63 => "BK", 64 => "BL", 
	    					     65 => "BM", 66 => "BN", 67 => "BO", 68 => "BP", 69 => "BQ", 70 => "BR", 
	    					     71 => "BS", 72 => "BT", 73 => "BU", 74 => "BV", 75 => "BW", 76 => "BX", 
	    					     77 => "BY", 78 => "BZ", 79 => "CA", 80 => "CB", 81 => "CC", 82 => "CD", 
	    					     83 => "CE", 84 =>"CF", 85 =>"CG", 86 =>"CH",
	    					     87 => "CI", 88 => "CJ", 89 => "CK", 90 => "CL", 91 => "CM", 92 => "CN", 
	    					     93 => "CO", 94 => "CP", 95 => "CQ", 96 => "CR", 97 => "CS", 98 => "CT", 
	    					     99 => "CU", 100 => "CV", 101 => "CW", 102 => "CX", 103 => "CY", 104 => "CZ");
	
	//Arreglo con el listado de funciones que pueden existir en los formularios de la aplicación
	public $ARR_FUNCIONES = array('NUEVO',
								  'GUARDAR', 
								  'BUSCAR', 
								  'EDITAR', 
								  'CAMBIAR ESTATUS', 
								  'IMPRIMIR REPORTE', 
								  'IMPRIMIR REGISTRO', 
								  'ENVIAR CORREO', 
								  'ADJUNTAR', 
								  'VER REGISTRO', 
								  'GENERAR PEDIDO',
								  'VALIDAR',
								  'AUTORIZAR', 
								  'FACTURAR',
								  'APLICAR DEVOLUCION',
								  'FINALIZAR ORDEN DE REPARACION',
								  'REACTIVAR ORDEN DE REPARACION',
								  'DESCARGAR PDF', 
								  'DESCARGAR XML', 
								  'DESCARGAR XLS',
								  'DESCARGAR XLS REGISTRO',
								  'TIMBRAR', 
								  'CANCELAR', 
								  'ELIMINAR');

	//Arreglo con el listado de extensiones de un archivo
	public $ARR_EXTENSIONES = array('jpeg',
									'jpg',
								    'gif',
								    'png',  
								    'pdf', 
								    'doc',
								    'docx',
								    'xls',
								    'xlsx',
								    'txt');


	//Mensaje que se utiliza para informar al usuario las extensiones válidas de un archivo
	public $STR_MENSAJE_EXTENSIONES = 'Extensión del archivo no válida, solo se permiten archivos con las
					                   siguientes extensiones: jpeg, jpg, gif, png, pdf, doc, docx, xls,
					                   xlsx y txt.';

	//Arreglo con el listado de meses
	public $ARR_MESES = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');

	//Arreglo se utiliza para asignar la descripción de un mes con base a un número
	public $ARR_MESES_DESCRIPCIONES = array(1 => "ENERO", 
											2 => "FEBRERO", 
											3 => "MARZO", 
											4 => "ABRIL", 
											5 => "MAYO", 
											6 => "JUNIO", 
											7 => "JULIO",
											8 => "AGOSTO",
											9 => "SEPTIEMBRE",
										    10 => "OCTUBRE",
										    11 => "NOVIEMBRE",
											12 => "DICIEMBRE");

	//Arreglo se utiliza para asignar la descripción de un mes con base a un número
	public $ARR_MESES_NUMEROS_DESCRIPCIONES = array("ENERO" => 1, 
													"FEBRERO" => 2, 
													"MARZO" => 3, 
													"ABRIL" => 4, 
													"MAYO" => 5, 
													"JUNIO" => 6, 
													"JULIO" => 7,
													"AGOSTO" => 8,
													"SEPTIEMBRE" => 9,
												    "OCTUBRE" => 10,
												    "NOVIEMBRE" => 11,
													"DICIEMBRE" => 12);

	//Arreglo se utiliza para asignar la descripción de un tipo de movimiento de refacciones
	public $ARR_MOV_REFACCIONES_DESCRIPCIONES = array(ENTRADA_REFACCIONES_COMPRA => "ENTRADA POR COMPRA", 
													  ENTRADA_REFACCIONES_DEVOLUCION_FACTURA => "ENTRADA POR DEV. DEL CLIENTE", 
													  ENTRADA_REFACCIONES_DEVOLUCION_TALLER => "ENTRADA POR DEV. DEL TALLER", 
													  ENTRADA_REFACCIONES_TRASPASO => "ENTRADA POR TRASPASO", 
													  ENTRADA_REFACCIONES_AJUSTE => "ENTRADA POR AJUSTES",
													  SALIDA_REFACCIONES_TALLER => "SALIDA PARA TALLER", 
													  SALIDA_REFACCIONES_CONSUMO_INTERNO => "SALIDA POR CONSUMO INTERNO",
													  SALIDA_REFACCIONES_TRASPASO => "SALIDA POR TRASPASO",
													  SALIDA_REFACCIONES_DEVOLUCION_PROVEEDOR => "SALIDA POR DEV. AL PROVEEDOR",
													  SALIDA_REFACCIONES_AJUSTE => "SALIDA POR AJUSTES",
													  SALIDA_REFACCIONES_VENTA => "SALIDA POR VENTA",
													  SALIDA_REFACCIONES_TRASPASO_VEHICULAR => "TRASPASO A PARQUE VEHICULAR");

	//Arreglo se utiliza para asignar la descripción de un tipo de movimiento de refacciones internas
	public $ARR_MOV_REFACCIONES_INTERNAS_DESCRIPCIONES = array(ENTRADA_REFACCIONES_INTERNAS_TRASPASO => "ENTRADA POR TRASPASO", 
													 		   ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER => "ENTRADA POR DEV. DEL TALLER", 
													  		   ENTRADA_REFACCIONES_INTERNAS_POR_AJUSTE => "ENTRADA POR AJUSTES", 
													  		  SALIDA_REFACCIONES_INTERNAS => "SALIDA DE REFACCIONES", 
													  		  SALIDA_REFACCIONES_INTERNAS_POR_AJUSTE => "SALIDA POR AJUSTES",
													  		  SALIDA_REFACCIONES_INTERNAS_CONSUMO_INTERNO => "SALIDA POR CONSUMO INTERNO");



	//Arreglo con la configuración para el envío de email
	public $ARR_CONFIG_EMAIL =  array('protocol' => 'smtp',
									  'smtp_host' => 'mail.zonahs.com.mx',
									  'smtp_port' => 587,
									  'mailtype' => 'html',
									  'charset'   => 'iso-8859-1');


	//Arreglo se utiliza para asignar los tipos de movimientos de maquinaria
	public $ARR_MOVIMIENTOS_MAQUINARIA = array(1 => "ENTRADA POR COMPRA", 
											   2 => "ENTRADA POR TRASPASO", 
											   3 => "ENTRADA POR DEVOLUCIÓN", 
											   11 => "SALIDA POR VENTA", 
											   12 => "SALIDA POR TRASPASO", 
											   13 => "SALIDA POR DEMOSTRACIÓN", 
											   14 => "SALIDA POR VALIDACIÓN",
											   15 => "SALIDA POR DEVOLUCIÓN AL PROVEEDOR");

	//Método que se utiliza para cargar el contenido de la vista correspondiente según los parámetros enviados
	public function cargar_vista($strRuta, $arrValores)
	{
		//Si el usuario ha iniciado sesión
		if($this->session->userdata('usuario_id'))
		{
			//Si el dispositivo es celular
			if ($this->agent->is_mobile())
			{
				//Asignar título para mostrarlo en el encabezado del modal
				$arrDatos['strTitulo'] = $arrValores[0];
				//Asignar los permisos de acceso del usuario
				$strTempPermisos = '<input id="txtAcciones_'.$arrValores[1].'" type="hidden" ';
				$strTempPermisos.= 'value="'.$this->encrypt->encode($arrValores[2]).'"></input>';
				//Asignar el id del proceso
				$strTempProcesoID = '<input id="txtProcesoMenuID_'.$arrValores[1].'" type="hidden" ';
				$strTempProcesoID.= 'value="'.$this->encrypt->encode($arrValores[3]).'"></input>';
				$arrDatos['strPermisos'] = $strTempPermisos;
				$arrDatos['strProcesoMenuID'] = $strTempProcesoID;
				$this->load->view("movil/header", $arrDatos); //Carga la cabecera de la pagina
				$this->load->view("pages/$strRuta"); //Cargando Vista del Proceso
				$this->load->view("movil/nav"); //Carga el menu de la pagina
				$this->load->view("pages/footer"); //Carga pie de pagina
			}
			else
			{
				$this->load->view("pages/$strRuta"); //Cargando Vista del Proceso
			}
		}
		else
		{
			//Redireccionar a la página login 
			redirect('login', 'refresh');
		}
	}

	//Función para generar folio consecutivo de un proceso
    public  function get_folio_consecutivo($intProcesoID, $intCeros, $strTipo = NULL, $strSinSucursal = NULL)
    {
    	//Variable que se utiliza para asignar el folio consecutivo
    	$strFolioConsecutivo = '';
    	//Aumenta el tiempo límite de ejecución de un script PHP
	    ini_set('max_execution_time', 300); //300 seconds = 3 minutes

	    //Si no existe tipo de folio por proceso
	    if($strTipo === NULL)
	    {
	    	//Asignar proceso
	    	$strTipo = 'PROCESO';
	    }

	    //Seleccionar los datos del registro que coincide con el proceso
	    $otdResultado = $this->consecutivos->buscar(NULL, $intProcesoID, 'ACTIVO', 
													NULL, $strTipo, $strSinSucursal);
	
	    //Si hay información
	    if($otdResultado)
	    {		

	    	//Asignar valores
	    	$intFolioID = $otdResultado->folio_id;
	    	$strSerie = $otdResultado->serie;
	    	$intConsecutivo = $otdResultado->consecutivo;
	    	//Obtener longitud de la serie
	    	$intTamanoSerie = strlen($strSerie);
	    	//Decrementar longitud de la serie
	    	$intCeros -= $intTamanoSerie;
	    	//Concatenar al consecutivo el incremento de ceros
            $strFolioConsecutivo = str_pad($intConsecutivo, $intCeros, "0", STR_PAD_LEFT);
            //Incrementar consecutivo
            $intConsecutivo++;
			//Asignar folio consecutivo
			$strFolioConsecutivo = $strSerie.$strFolioConsecutivo.'_'.$intFolioID.'_'. $intConsecutivo;
	    }

	    //Regresar folio consecutivo
		return $strFolioConsecutivo;
	}



	//Función para generar folio consecutivo de una póliza
    public  function get_folio_consecutivo_poliza($strTipo, $intCeros)
    {
    	//Variable que se utiliza para asignar el folio consecutivo
    	$strFolioConsecutivo = '';
    	//Aumenta el tiempo límite de ejecución de un script PHP
	    ini_set('max_execution_time', 300); //300 seconds = 3 minutes

	    
	    //Seleccionar los datos del registro que coincide con el proceso
	    $otdResultado = $this->consecutivos_poliza->buscar(NULL, $strTipo, 'ACTIVO');
	
	    //Si hay información
	    if($otdResultado)
	    {		
	    	//Asignar valores
	    	$intFolioID = $otdResultado->folio_id;
	    	$strSerie = $otdResultado->serie;
	    	$intConsecutivo = $otdResultado->consecutivo;
	    	//Obtener longitud de la serie
	    	$intTamanoSerie = strlen($strSerie);
	    	//Decrementar longitud de la serie
	    	$intCeros -= $intTamanoSerie;
	    	//Concatenar al consecutivo el incremento de ceros
            $strFolioConsecutivo = str_pad($intConsecutivo, $intCeros, "0", STR_PAD_LEFT);
            //Incrementar consecutivo
            $intConsecutivo++;
			//Asignar folio consecutivo
			$strFolioConsecutivo = $strSerie.$strFolioConsecutivo.'_'.$intFolioID.'_'. $intConsecutivo;
	    }

	    //Regresar folio consecutivo
		return $strFolioConsecutivo;
	}

	
	//Función para regresar el id de la póliza de una referencia
	public function get_poliza_referencia($intReferenciaID, $strModulo, $strProceso) 
    {	
    	//Array que se utiliza para enviar datos
		$arrDatos = array('poliza_id' => '0',
						  'folio' => '');

    	//Concatenar datos para realizar la búsqueda
    	$strCriteriosBusq = $intReferenciaID.'|'.$strModulo.'|'.$strProceso;

    	//Seleccionar los datos del registro que coincide con los criterios de búsqueda
		$otdPoliza = $this->polizas_referencia->buscar(NULL, $strCriteriosBusq);
		//Si hay información
		if($otdPoliza)
		{
			//Asignar primer posición del arreglo
			$otdPoliza = $otdPoliza[0];

			//Agregar datos al array
			$arrDatos['poliza_id'] = $otdPoliza->poliza_id;
			$arrDatos['folio'] = $otdPoliza->folio;

		}

		 //Regresar array con los datos de la póliza
		return $arrDatos;
    }

    //Función para generar folio consecutivo de una póliza
    public  function validar_regimen_fiscal($intRegimenFiscalID, $intRegimenFiscalIDAnterior)
    {
    	$strModRegimenFiscal = 'NO';

    	//Si se cumple la sentencia modificar el régimen fiscal de un registro (significa que el registro ACTIVO seleccionado como referencia no tenia régimen fiscal y el usuario actualizo el régimen fiscal desde la tabla clientes)
		if($intRegimenFiscalID != $intRegimenFiscalIDAnterior && $intRegimenFiscalIDAnterior == 0)
		{
			$strModRegimenFiscal = 'SI';
		}

    	return $strModRegimenFiscal;
    }

	//Función para  regresar encabezado del archivo PDF (logotipo y datos del emisor)
    public  function get_encabezado_archivo_pdf($pdf, $strTipoReporte = NULL,
    											$intTamLetra = TAMANO_LETRA_SUBTITULO_PDF,
    											$strEncabezado = 'EMISOR')
    {
    	//Seleccionar los datos de la empresa (logeada en el sistema)
	    $otdEmpresa = $this->empresas->buscar($this->session->userdata('empresa_id'));
	    //Seleccionar los datos de la sucursal seleccionada (logeada en el sistema)
        $otdSucursal = $this->sucursales->buscar($this->session->userdata('sucursal_id'));
       	//Hacer un llamado a la función para mostrar imagen del logotipo
       	$this->get_logotipo_archivo_pdf($pdf);

		//Variable que se utiliza para asignar el número interior
		$strNumInteriorSucursal = (($otdSucursal->numero_interior !== NULL && 
					        	    empty($otdSucursal->numero_interior) === FALSE) ?
                                    ' INT. '.$otdSucursal->numero_interior : '');
		
      	
      	//Si no existe el tamaño de la letra
      	if($intTamLetra == NULL)
      	{
      		//Asignar por default el tamaño del subtítulo
      		$intTamLetra = TAMANO_LETRA_SUBTITULO_PDF;
      	}

		//------------------------------------------------------------------------------------------------------------------------
        //---------- DATOS DE LA EMPRESA (EMISOR)
        //------------------------------------------------------------------------------------------------------------------------
   		//Encabezado
   		if($strEncabezado != '')
   		{
   			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

   			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, $intTamLetra);
			$pdf->SetXY(80, 15);
			$pdf->ClippedCell(120, 3, $strEncabezado, 0, 0, 'C', TRUE);
			
   		}
   		
   		$pdf->SetTextColor(0); //establece el color de texto
	
		//RFC
		//Asigna el tipo y tamaño de letra
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, $intTamLetra);
		$pdf->SetXY(80, 19);
		$pdf->ClippedCell(35, 3, 'RFC');
		//Asigna el tipo y tamaño de letra
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, $intTamLetra);
		$pdf->SetXY(115, 19);
		$pdf->ClippedCell(85, 3, utf8_decode($otdEmpresa->rfc));


		//Razón social
		//Asigna el tipo y tamaño de letra
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, $intTamLetra);
		$pdf->SetXY(80, 23);
	    $pdf->ClippedCell(35, 3, 'NOMBRE');
	    //Asigna el tipo y tamaño de letra
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, $intTamLetra);
		$pdf->SetXY(115, 23);
		$pdf->ClippedCell(85, 3,utf8_decode($otdEmpresa->razon_social));

		//Si el tipo de reporte es Fiscal (facturas, anticipos, movimientos que se timbran, etc.)
		if($strTipoReporte == 'FISCAL')
		{
			
			//Concatenar datos para el domicilio
	    	$strDomicilioSucursal = $otdSucursal->calle . ' NO.'.$otdSucursal->numero_exterior.
	    							$strNumInteriorSucursal.' COL. ' . $otdSucursal->colonia.' '.$otdSucursal->localidad. ', '. 
	    							$otdSucursal->municipio. ', '.$otdSucursal->estado_rep;

	        //Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
			$strDomicilioSucursal = mb_strtoupper($strDomicilioSucursal);

			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, $intTamLetra);
			//Régimen fiscal
		    $pdf->SetXY(80, 27);
		    $pdf->ClippedCell(35, 3, utf8_decode('RÉGIMEN FISCAL'));
			//Lugar de expedición
			$pdf->SetXY(80, 31);
			$pdf->ClippedCell(35, 3, utf8_decode('LUGAR DE EXPEDICIÓN'));
			//Teléfono
			$pdf->SetXY(140, 31);
			$pdf->ClippedCell(20, 3, utf8_decode('TELÉFONO'));

			//Información del emisor
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, $intTamLetra);
			//Régimen fiscal
			$pdf->SetXY(115, 27);
			$pdf->ClippedCell(85, 3,utf8_decode($otdEmpresa->regimen_fiscal));
			//Lugar de expedición
			$pdf->SetXY(115, 31);
			$pdf->ClippedCell(85, 3,utf8_decode($otdSucursal->codigo_postal));
			//Teléfono
			$pdf->SetXY(160, 31);
			$pdf->ClippedCell(40, 3, $otdSucursal->telefono_01);
			//Domicilio de la sucursal
			$pdf->SetXY(80, 35);
			$pdf->MultiCell(120, 3, utf8_decode($strDomicilioSucursal));

		}
		else
		{

			//Concatenar datos para el domicilio
    		$strDomicilioSucursal = $otdSucursal->calle . ' NO.'.$otdSucursal->numero_exterior.
	    							$strNumInteriorSucursal.' COL. ' . $otdSucursal->colonia.' C.P. '.
	    							$otdSucursal->codigo_postal.' '.$otdSucursal->localidad. ', '. 
	    							$otdSucursal->municipio. ', '.$otdSucursal->estado_rep;

	    	 //Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
			$strDomicilioSucursal = mb_strtoupper($strDomicilioSucursal);		

			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, $intTamLetra);
			//Domicilio de la sucursal
			$pdf->SetXY(80, 27);
			$pdf->ClippedCell(35, 3, utf8_decode('DOMICILIO'));
			//Teléfono
			$pdf->SetXY(140, 27);
			$pdf->ClippedCell(20, 3, utf8_decode('TELÉFONO'));
		    
			//Información del emisor
		    //Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, $intTamLetra);
			//Teléfono
			$pdf->SetXY(160, 27);
			$pdf->ClippedCell(40, 3, $otdSucursal->telefono_01);
			//Domicilio de la sucursal
			$pdf->SetXY(80, 31);
			$pdf->MultiCell(120, 3, utf8_decode($strDomicilioSucursal));
		}

    }


    //Función para mostrar logotipos de la empresa en el archivo PDF
    public function get_logotipo_archivo_pdf($pdf)
    {
    	//Inserta logo en la esquina superior izquierda
		$pdf->Image("assets/images/misc/agrocisa.jpg", 10, 15, 75, 25);
		//Inserta imagen de marca de agua
		$pdf->Image("assets/images/misc/logo_marca_agua.jpg", 35, 90, 150, 50);

    }

    //Función para mostrar la imagen del estatus en el archivo PDF
    public function get_img_estatus_archivo_pdf($pdf, $strEstatus)
    {
		//Si el estatus del registro es INACTIVO
		if($strEstatus == 'INACTIVO')
		{
			//Inserta imagen de cancelado
			$pdf->Image("assets/images/misc/cancelado.jpg", 10, 50, 192, 123.5);

		}
		else if( $strEstatus == 'TIMBRAR')
		{
			//Inserta imagen de timbrar
			$pdf->Image("assets/images/misc/timbrar.jpg", 10, 50, 192, 123.5);
		}
    }

    //Función para  regresar encabezado del archivo PDF (logotipo y datos del emisor)
    public  function get_page_break_pdf($pdf, $intAltura)
    {
    	$nb =0;
    	$intPosY =0;

    	$nb = max($nb, $pdf->NbLines(110,  250));

    	 //Ajustar altura de la celda
		$h = $intAltura * $nb;
		//Definir el tamaño de la hoja
		$numTamHoja = 36;
		//Calcular el consumo de la hoja
		$numConsumo = $pdf->GetY() + $h;

        //Si la altura h provocaría un desbordamiento, añadir una nueva página inmediatamente
        if ($numConsumo  >=  $numTamHoja)
        {
        	//Emitir un salto de página en primer lugar si es necesario
        	$pdf->CheckPageBreak($h);
        }

    }



	//Método que se utiliza para regresar encabezado del archivo XLS  (logotipo y datos del emisor)
	public function get_encabezado_archivo_excel($objExcel, $strTipoHoja = NULL)
	{
		//Seleccionar los datos de la empresa (logeada en el sistema)
	    $otdEmpresa = $this->empresas->buscar($this->session->userdata('empresa_id'));
	    //Seleccionar los datos de la sucursal seleccionada (logeada en el sistema)
        $otdSucursal = $this->sucursales->buscar($this->session->userdata('sucursal_id'));
    	
    	//Si el tipo de hoja es nueva 
	    if($strTipoHoja == 'nueva')
	    {
	    	//Se crea una instancia de la clase para agregar imagen en el archivo
	    	$objDrawing = new PHPExcel_Worksheet_Drawing();
            $objDrawing->setName('logotipo');
            $objDrawing->setDescription('logotipo');
            //Asignar ruta de la imagen
            $strRutaImagen = 'assets/images/misc/agrocisa.jpg'; 
            $objDrawing->setPath($strRutaImagen);
            $objDrawing->setOffsetX(0);   
			$objDrawing->setOffsetY(7); 
            $objDrawing->setCoordinates('A1');
            //Asignar FALSE para no obtener el tamaño proporcional de la imagen
            $objDrawing->setResizeProportional(FALSE);
            //Asignar el ancho de la imagen
            $objDrawing->setWidth(386);
            //Asignar el alto de la imagen
            $objDrawing->setHeight(92);
            //Insertar imagen en  la hoja
			$objDrawing->setWorksheet($objExcel);

			//Variable que se utiliza para asignar el tamaño de la columna principal
			$intTamColPrinc = 55.16;
			//Variable que se utiliza para asignar el tamaño de las columnas secundarias
			$intTamColSec= 43.86;

			//Hacer recorrido para cambiar tamaño de las columnas
	        for($intContCol = 1; $intContCol <= $this->intNumColumnasDinamicas;  $intContCol++)
	        {
	        	//Cambiar el ancho de las columnas
	        	$objExcel->getColumnDimension($this->ARR_COLUMNAS[$intContCol])->setWidth($intTamColPrinc);	

	        }


		    //Definir estilos de las celdas correspondientes a los encabezados
	    	$arrStyleFuenteColumnasPrinc = array('font' => array('bold' => TRUE,
	    													     'name' => 'Arial',
	    													     'size' => 12));

	    	$arrStyleFuenteColumnasSec  = array('font' => array('name' => 'Arial',
	    													    'size' => 10));

	    	//Definir estilos de las celdas correspondientes al título
	    	$arrStyleFuenteColumnasTitulo = array('font' => array('bold' => TRUE,
	    													      'name' => 'Arial',
	    													      'size' => 10));

	    	//Se agrega el encabezado del archivo
			$objExcel->setCellValue('B1', $otdEmpresa->nombre_comercial) 
					 ->setCellValue('B2', $otdEmpresa->razon_social)
					 ->setCellValue('B3', $otdEmpresa->rfc)
					 ->setCellValue('B4', 'SUC. '. $otdSucursal->nombre)
					 ->setCellValue('B5', 'TEL. '. $otdSucursal->telefono_01);

			
			//Combinar las siguientes celdas
			$objExcel->mergeCells('A7:G7');
       		$objExcel->mergeCells('B1:H1');
       		$objExcel->mergeCells('B2:H2');
       		$objExcel->mergeCells('B3:H3');
       		$objExcel->mergeCells('B4:H4');
       		$objExcel->mergeCells('B5:H5');
       	
       		//Preferencias del tipo y tamaño de fuente
       		$objExcel->getStyle('A7:G7')
    			     ->applyFromArray($arrStyleFuenteColumnasTitulo);

			$objExcel->getStyle('B1:B3')
    			     ->applyFromArray($arrStyleFuenteColumnasPrinc);

    	    $objExcel->getStyle('B4:B5')
    			     ->applyFromArray($arrStyleFuenteColumnasSec);

	    }
	    else //Si es una hoja existente
	    {
	    	//Establecer propiedades
			$objExcel->getProperties()->setCreator("Agrocisa - Sistema Administrativo")
					 ->setLastModifiedBy("Agrocisa - Sistema Administrativo")
					 ->setTitle("Agrocisa - Sistema Administrativo")
					 ->setSubject("Office 2007 XLSX Test Document")
					 ->setCategory("Reporte");

	        //Se agrega el encabezado del archivo
			$objExcel->setActiveSheetIndex(0)
					 ->setCellValue('B1', $otdEmpresa->nombre_comercial) 
					 ->setCellValue('B2', $otdEmpresa->razon_social)
					 ->setCellValue('B3', $otdEmpresa->rfc)
					 ->setCellValue('B4', 'SUC. '. $otdSucursal->nombre)
					 ->setCellValue('B5', 'TEL. '. $otdSucursal->telefono_01);	
	    }
		
	}

	//Método que se utiliza para regresar pie de página del archivo XLS
	public function get_pie_pagina_archivo_excel($objExcel, $strNombreArchivoExcel, $strNombreHojaExcel, $intFila)
	{

		//Incrementar el indice para escribir el pie de página
	    $intFila = $intFila+25;//Posición que se utiliza para el pie de página
        //Se combinan las celdas para colocar el pie de página
	    $objExcel->setActiveSheetIndex(0)
		    	 ->mergeCells('A'.$intFila.':G'.$intFila);
		//Seleccionar la fecha en español
        setlocale(LC_TIME, 'spanish');
        //Fecha de impresión 
        $dteFecha = date("d/m/Y h:i:s a");
        //se crea una cadena con acentos y tildes correctamente para colocarlo en el pie de página
        $strPiePagina = 'IMPRESIÓN: '.$dteFecha.'      USUARIO: '.$this->session->userdata('usuario');
        //Pie de página
		$objExcel->setActiveSheetIndex(0)
				 ->setCellValue('A'.$intFila,$strPiePagina);
		//Renombrar hoja
        $objExcel->getActiveSheet()->setTitle($strNombreHojaExcel);
        //Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
        $objExcel->setActiveSheetIndex(0);
		//Con los siguientes encabezado indicamos que la salida será un archivo de excel
		header('Content-type: application/vnd.ms-excel; charset=UTF-8');
		header('Content-Disposition: attachment; filename= '.$strNombreArchivoExcel);
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}


	//Función que se utiliza para agregar o activar una hoja en el archivo Excel
    public function get_hoja_archivo_excel($objExcel, $strNombreHoja, $intContadorHojas)
    {

    	//Si se cumple la sentencia
      	if($intContadorHojas == 0)
      	{
      		//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
	        $this->get_encabezado_archivo_excel($objExcel);
	        //Marcar como activa la nueva hoja
	        $objExcel->setActiveSheetIndex($intContadorHojas);   
	     
		}
		else
		{
			
			//Agregar nueva hoja
			$objNuevaHoja = $objExcel->createSheet();
			//Marcar como activa la nueva hoja
			$objExcel->setActiveSheetIndex($intContadorHojas); 
			//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
            $this->get_encabezado_archivo_excel($objNuevaHoja, 'nueva');
            //Definir nombre de la hoja
			$objNuevaHoja->setTitle($strNombreHoja);
		}
    	

    	//Regresar el contador actual de la hoja (para evitar perder indice)
    	return $intContadorHojas;
    }


    //Función que se utiliza para escribir los datos de un registro en el archivo Excel
    public function get_datos_registro_excel($objExcel, $arrDatos, $intIndColE, $intFila)
    {
    	
		//Hacer recorrido para obtener los datos del registro
    	foreach ($arrDatos as $arrDet) 
    	{
    		//Asignar columna actual
			$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFila;

			//Agregar información del registro
			$objExcel->getActiveSheet()
             		 ->setCellValue($strColActual, $arrDet);

            //Incrementar indice de la columna
			$intIndColE++;     

    	}//Cierre de foreach del array datos

    }

    //Función que se utiliza para enviar correo electrónico
    public function set_enviar_correo($arrValores)
	{

		//Inicializar configuraciones para enviar email
		$this->email->initialize($this->ARR_CONFIG_EMAIL);
		//Correo que envía mensaje
		$this->email->from(CORREO_CONFIGURACION, TITULO_NAVEGADOR);
		//Correo al que se le envía mensaje
		$this->email->to($arrValores['strCorreoElectronico']);
		//Si existe correo electrónico al que se le enviara una copia
		if($arrValores['strCopiaCorreoElectronico'] != '')
		{
			//Copia oculta
			$this->email->bcc($arrValores['strCopiaCorreoElectronico']);
		}
		//Asunto
		$this->email->subject($arrValores['strTitulo']);
		//Asignar los comentarios en el array para mostrarlos en la plantilla (email)
		$arrDatosEmail["strTitulo"] = $arrValores['strTitulo'];
		$arrDatosEmail["strComentarios"] = $arrValores['strComentarios'];
		//Cargar plantilla email
		$objMensaje = $this->load->view('pages/plantilla_email', $arrDatosEmail, TRUE);
		//Mensaje
		$this->email->message($objMensaje);
		//Adjuntar archivo
		$this->email->attach($arrValores['strRuta']);

		//Si existen errores al enviar correo electrónico
		if (!$this->email->send())
		{
			//Hacer un llamado a la función para eliminar carpeta temporal
			$strMensajeCarpetaTemp = $this->eliminar_carpeta_temporal($arrValores['intReferenciaID']);
			//Enviar el mensaje de error al formulario
			$arrDatos = array('resultado' => FALSE,
						      'tipo_mensaje' => TIPO_MSJ_ERROR,
				              'mensaje' => 'Ocurrió un error al enviar correo electrónico: <br>'.$this->email->print_debugger().' <br>'.$strMensajeCarpetaTemp);
		}
		else
		{
			//Hacer un llamado a la función para eliminar carpeta temporal
			$strMensajeCarpetaTemp = $this->eliminar_carpeta_temporal($arrValores['intReferenciaID']);

			//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE,
						 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
						      'mensaje' => 'El correo electrónico se envió correctamente. '.$strMensajeCarpetaTemp);

		}


		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));

	}

	//Convierte el formato de la fecha a letra,  para así mostrarlo al usuario en los reportes
   	// * @param string $dteFecha Fecha a convertir
    public function get_fecha_formato_letra($dteFecha = NULL, $strOpcion = NULL) 
    {
    	//El parametro $dteFecha tiene que enviarse bajo el siguiente formato: YYYY-mm-dd

		//Si la opción es C-corta de fechas (se utiliza para la fecha con mes corto ejemplo 2012-08-14 a 14-ago-2012)
		// de lo contrario la fecha sera así 14 de agosto de 2013
		$strFecha = ''; //Variable con  la descripción de la fecha de la factura
		//Recuperar el valor de la fecha y separar los datos 
		setlocale(LC_TIME, 'spanish');
		
		//Si existe fecha
		if($dteFecha !== NULL)
		{
			$strFecha=  strtotime($dteFecha); 
			$strAnio=date("Y", $strFecha);//Año 
			$strMes=date("m", $strFecha);//Mes
			$intDia=date("d", $strFecha);//Dia
			//Convertir la fecha  a cadena 
			if($strOpcion == 'C')//Significa que se mostará la  fecha así   14/ago/2012
			{
			   $strFecha = strftime("%d/%b/%Y", mktime(0, 0, 0,$strMes,$intDia,$strAnio));
			   //Convertir letras a mayúsculas
			   $strFecha = strtoupper($strFecha);
			}
			else if($strOpcion == 'MDIA')//Significa que se mostará la fecha así  14 de Agosto
			{
			   $strFecha = strftime("%d de %B", mktime(0, 0, 0,$strMes,$intDia,$strAnio));
			   //Convertir letras a mayúsculas
			   $strFecha = strtoupper($strFecha);
			}
			else if($strOpcion == 'MDIAC')//Significa que se mostará la fecha así  14-AGO
			{
			   $strFecha = strftime("%d-%b", mktime(0, 0, 0,$strMes,$intDia,$strAnio));
			   //Convertir letras a mayúsculas
			   $strFecha = strtoupper($strFecha);
			}
			else if($strOpcion == 'M')//Significa que se mostará la fecha así  Agosto
			{
			   $strFecha = strftime("%B", mktime(0, 0, 0,$strMes,$intDia,$strAnio));
			   //Convertir letras a mayúsculas
			   $strFecha = strtoupper($strFecha);
			}
			elseif($strOpcion == 'L')//Significa que se mostará la  fecha así  martes 14 de Agosto  de 2012
			{
			   //Significa que se mostará la  fecha así  martes 14 de Agosto  de 2012
			   $strFecha = strftime("%A %d de %B de %Y", mktime(0, 0, 0,$strMes,$intDia,$strAnio));
			}
			else //Significa que se mostará la  fecha así   14 de Agosto  de 2012
			{
			   //Significa que se mostará la  fecha así   14 de Agosto  de 2012
			   $strFecha = strftime("%d de %B de %Y", mktime(0, 0, 0,$strMes,$intDia,$strAnio));
			}  
		}
		else
		{
			//Variable que se utiliza para asignar la fecha actual ejemplo: 23 de agosto de 2017
			$strFecha = strftime('%d de %B de %Y');
		}
		
		//Regresar descripción de la fecha
		return  $strFecha;
    }



    //Función que se utiliza para restar días a una fecha
	public function get_fecha_inicial($dteFecha)
	{
		$strFecha=  strtotime($dteFecha); 
		$strAnio=date("Y", $strFecha);//Año 
		$strMes=date("m", $strFecha);//Mes
		$intDia=date("d", $strFecha);//Dia

		$strFecha = $strAnio.'-'.$strMes.'-01';

		//Regresar fecha correspondiente al decremento de días
		return $strFecha;
	}


    //Función que se utiliza para restar días a una fecha
	public function restar_dias_fecha($intDias, $dteFecha)
	{
		$dteNuevaFecha = strtotime ('-'.$intDias.' day', strtotime($dteFecha));
		$dteNuevaFecha = date ('Y-m-d' , $dteNuevaFecha);
		//Regresar fecha correspondiente al decremento de días
		return $dteNuevaFecha;
	}


	//Función que se utiliza para sumar días a una fecha
	public function sumar_dias_fecha($intDias, $dteFecha)
	{
		$dteNuevaFecha = strtotime ('+'.$intDias.' day', strtotime($dteFecha));
		$dteNuevaFecha = date ('Y-m-d' , $dteNuevaFecha);
		//Regresar fecha correspondiente al incremento de días
		return $dteNuevaFecha;
	}

    
    //Función que se utiliza para calcular la diferencia de días entre dos fechas
	public function diferencia_dias_fechas($dteFechaInicial, $dteFechaFinal)
	{
		//Crear una instancia de tiempo
		$dteFecha1 = new DateTime($dteFechaInicial);
		$dteFecha2 = new DateTime($dteFechaFinal);
		$objDiff = $dteFecha1->diff($dteFecha2);

		//Incrementar 1 para considerar la fecha inicial
		$intDias = $objDiff->days + 1;
	
		//Regresar diferencia de días
		return $intDias;
	}

	//Funciones que se utilizan para validar cadenas del archivo XML 
	public  function validaCadena($strCadena){
		$strCadena = str_replace("|", "/", $strCadena);
		//$strCadena = str_replace("&", "&amp;", $strCadena);
		$strCadena = str_replace("\"", "", $strCadena);
		$strCadena = str_replace("<", "", $strCadena);
		$strCadena = str_replace(">", "", $strCadena);
		$strCadena = str_replace("'", "", $strCadena);
		$strCadena = str_replace("Ã", "A", $strCadena);
		$strCadena = str_replace("Ã‰", "E", $strCadena);
		$strCadena = str_replace("Ã", "I", $strCadena);
		$strCadena = str_replace("Ã“", "O", $strCadena);
		$strCadena = str_replace("Ãš", "U", $strCadena);
		$strCadena = str_replace("Á", "A", $strCadena);
		$strCadena = str_replace("É", "E", $strCadena);
		$strCadena = str_replace("Í", "I", $strCadena);
		$strCadena = str_replace("Ó", "O", $strCadena);
		$strCadena = str_replace("Ú", "U", $strCadena);
		$strCadena = str_replace("Ã‘", "Ñ", $strCadena);
		$strCadena = preg_replace('/\s\s+/', ' ', $strCadena);
		$strCadena = trim($strCadena);
		return ($strCadena);
	}
	
	public  function validaParaXML($strCadena){
		$strCadena = str_replace("|", "/", $strCadena);
		$strCadena = str_replace("&", "&amp;", $strCadena);
		$strCadena = str_replace("\"", "", $strCadena);
		$strCadena = str_replace("<", "", $strCadena);
		$strCadena = str_replace(">", "", $strCadena);
		$strCadena = str_replace("'", "", $strCadena);
		//Mayúsculas
		$strCadena = str_replace("Ã", "A", $strCadena);
		$strCadena = str_replace("Ã‰", "E", $strCadena);
		$strCadena = str_replace("Ã", "I", $strCadena);
		$strCadena = str_replace("Ã“", "O", $strCadena);
		$strCadena = str_replace("Ãš", "U", $strCadena);
		$strCadena = str_replace("Á", "A", $strCadena);
		$strCadena = str_replace("É", "E", $strCadena);
		$strCadena = str_replace("Í", "I", $strCadena);
		$strCadena = str_replace("Ó", "O", $strCadena);
		$strCadena = str_replace("Ú", "U", $strCadena);
		$strCadena = str_replace("Ã‘", "Ñ", $strCadena);
		
		$strCadena = preg_replace('/\s\s+/', ' ', $strCadena);
		$strCadena = trim($strCadena);
		return ($strCadena);
	}

	//Función para regresar el nombre del archivo de un registro (y de esta manera poder efectuar acciones posteriores)
	public function get_verifar_archivo_registro($strNombreCarpeta, $strArchivoVerificar = NULL)
	{
		//Variable que se utiliza para asignar el nombre del archivo
	    $strNombreArchivo = '';
		//Variable que se utiliza para asignar el cadena concatenada con el nombre de los archivos
		$strNombreArchivos = '';
		//Verificar si la carpeta es un directorio 
        if (is_dir($strNombreCarpeta))
        {
			//Hacer recorrido en la carpeta para obtener archivos
            foreach (scandir($strNombreCarpeta) as $item) 
            {
                if ($item == '.' OR $item == '..') continue;
                //Separar extensión del archivo
                $arrArchivo = explode(".", $item);

                //Si no existe nombre del archivo que se va a verificar
                if( $strArchivoVerificar !== NULL)
                {
                	//Si el nombre del archivo existe
	                if($arrArchivo[0] ==  $strArchivoVerificar)
	                {
	                    //Asignar nombre completo del archivo (ejemplo: 1.xml)
	                    $strNombreArchivo = $item;
	                }
                }
                else
                {
                	//Asignar nombre completo de los archivo (ejemplo: FAR0000038.xml|FAR0000038.pdf)
		            $strNombreArchivos .= $item.'|';
                }   
            }
        }

        //Si existen archivos en la subcarpeta
        if($strNombreArchivos  != '')
        {
        	//Quitar el último simbolo concatenado |
			$strNombreArchivo = substr($strNombreArchivos, 0, -1);
        }

        //Regresar el nombre del archivo (o cadena concatenada con el nombre de los archivos) correspondiente al registro
        return $strNombreArchivo;

	}

	//Función para regresar el total de archivos que contiene la carpeta de un registro (y de esta manera poder efectuar acciones posteriores)
	public function get_total_archivos_registro($strNombreCarpeta)
	{
		//Variable que se utiliza para asignar el número de archivos que contiene la carpeta
		$intTotalArchivos = 0;
		//Verificar si la carpeta es un directorio 
        if (is_dir($strNombreCarpeta))
        {
        	//Hacer recorrido en la carpeta para obtener subcarpetas
            foreach (scandir($strNombreCarpeta) as $item) 
            {
            	if ($item == '.' OR $item == '..') continue;
            	//Asignar ruta de la subcarpeta
               	$strArchivoTemp = $strNombreCarpeta.'/'.$item;
               	//Hacer recorrido en la carpeta para obtener archivos
                foreach (scandir($strArchivoTemp) as $itemRen) 
                {
                    if ($itemRen == '.' OR $itemRen == '..') continue;
                    
                    //Asignar nombre completo de los archivo (ejemplo: 1.xml|2.pdf)
                    $intTotalArchivos++;                        
                }
               	
            }

        }

        //Regresar el número de archivos que contiene la carpeta
        return $intTotalArchivos;
	}
	
	//Función para descargar archivo(s) de un registro
	public function descargar_archivo_reg($strNombreCarpeta, $strNombreArchivo = NULL, 
										  $strNombreCarpetaZIP = NULL)
	{
		//Verificar si la carpeta es un directorio 
        if (is_dir($strNombreCarpeta))
        {
        	//Si existe nombre del archivo
        	if($strNombreArchivo !== NULL)
        	{
        		//Hacer recorrido en la carpeta para obtener archivos
	            foreach (scandir($strNombreCarpeta) as $item) 
	            {
	                if ($item == '.' OR $item == '..') continue;
	                //Separar extensión del archivo
	                $arrArchivo = explode(".", $item);
	                //Si existe el archivo
	                if($arrArchivo[0] == $strNombreArchivo)
	                {
	                	//Asignar la ruta del archivo
	                	$strRuta = $strNombreCarpeta.'/'.$item;
	                	header('Content-Type: application/force-download');
						header('Content-Disposition: attachment; filename='.$item);
						header('Content-Transfer-Encoding: binary');
						header('Content-Length: '.filesize($strRuta));
				    	readfile($strRuta);
	                }
	                    
	            }
        	}
        	else //Si existe nombre de la carpeta ZIP
        	{
        		//Comprimir contenido del directorio
	        	$this->zip->read_dir($strNombreCarpeta, FALSE);
	        	//Descargar carpeta zip
				$this->zip->download($strNombreCarpetaZIP);
        	}
        	
        }

	}


	//Función para eliminar archivo(s) de un registro
	public function eliminar_archivo_reg($strNombreCarpeta, $strNombreArchivo)
	{
		//Verificar si la carpeta es un directorio 
        if (is_dir($strNombreCarpeta))
        {
        	//Hacer recorrido en la carpeta para obtener archivos
            foreach (scandir($strNombreCarpeta) as $item) 
            {
                if ($item == '.' OR $item == '..') continue;
                //Separar extensión del archivo
                $arrArchivo = explode(".", $item);
                //Si existe el archivo
                if($arrArchivo[0] == $strNombreArchivo)
                {
                	//Asignar la ruta del archivo
                	$strRuta = $strNombreCarpeta.'/'.$item;

                	//Borrar fichero del servidor
					if (!unlink($strRuta))
					{
						//Enviar el mensaje de error al formulario
						$arrDatos = array('resultado' => FALSE,
								          'tipo_mensaje' => TIPO_MSJ_ERROR,
						                  'mensaje' => 'Ocurrió un error al eliminar el archivo, vuelva a intentarlo.');
					}
					else
					{
						//Enviar el mensaje de éxito al formulario
						$arrDatos = array('resultado' => TRUE,
									 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
									      'mensaje' => 'El archivo se eliminó correctamente.');
					}

					//Enviar datos a la vista del formulario
					$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
                }
                    
            }
        }
	}


	//Función para subir archivo(s) de un registro
	public function subir_archivo_reg($strBotonArchivoID, $strCarpetaPrincipal, $strCarpetaDestino, 
									  $strNombreCarpeta, $strRefArchivo = NULL, $bolVarios = NULL, 
									  $strNombreSubCarpeta = NULL)
	{
		//Variable que se utiliza para asigar el nombre de los archivos que no se movieron a la carpeta
		$strArchivosNoMovidos = '';
		//Variable que se utiliza para asignar el número de archivos que contiene la carpeta principal
		$intTotalArchivos = 0;

		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('resultado' => NULL,
					 	  'tipo_mensaje' => '',
					 	  'total_archivos' => '',
					      'mensaje' => 'El archivo se guardó correctamente.');

		
		//Si no existe la carpeta crearla
		if(!is_dir($strCarpetaPrincipal))
		{ 
			@mkdir($strCarpetaPrincipal, 0700); 
		}

		//Si no existe la carpeta crearla
		if(!is_dir($strCarpetaDestino))
		{ 
			@mkdir($strCarpetaDestino, 0700); 
		}

		//Definir ubicación de la carpeta
		$strRuta=$strNombreCarpeta.'/';
		//Si no existe la carpeta crearla
		if(!is_dir($strNombreCarpeta))
		{ 
			@mkdir($strNombreCarpeta, 0700); 
		} 

		//Si existe subcarpeta
		if($strNombreSubCarpeta != NULL)
		{
			//Si no existe la carpeta crearla
			if(!is_dir($strNombreSubCarpeta))
			{ 
				@mkdir($strNombreSubCarpeta, 0700); 
			} 

			//Definir ubicación de la carpeta
			$strRuta = $strNombreSubCarpeta.'/';
		}
		


		//Si son varios archivos por subir (xml y pdf)
    	if($bolVarios == TRUE)
    	{
    		//Hacer recorrido para obtener archivos 
			for($intCont = 0; $intCont < count($strBotonArchivoID["name"]); $intCont++)
		    {
		    	$strBotonArchivoID["name"][$intCont];
		    	//Asignar array con los datos del archivo
		      	$strArchivo = $strBotonArchivoID["name"][$intCont];

		      	//Si existe archivo
		      	if($strArchivo != '')
		      	{
		      		$strExtension = pathinfo($strArchivo, PATHINFO_EXTENSION);
			      	//Convertir extension a minúsculas
	            	$strExtension = strtolower($strExtension);
			      	
	            	//Si existe subcarpeta
					if($strNombreSubCarpeta != NULL)
					{
						//Asignar nombre del archivo para mover archivos a la subcarpeta
						$strNombreArchivo = $strArchivo;
						//Verificar si la carpeta es un directorio 
				        if (is_dir($strNombreSubCarpeta))
				        {
				        	//Hacer recorrido en la carpeta para obtener archivos
				            foreach (scandir($strNombreSubCarpeta) as $item) 
				            {
				                if ($item == '.' OR $item == '..') continue;
				                //Separar extensión del archivo
				                $arrArchivoCarp = explode(".", $item);

				                //Si existe archivo con la misma extensión
				                if($strExtension == $arrArchivoCarp[1])
				                {
				                	//Borrar fichero del servidor
									if (!unlink($strNombreSubCarpeta.'/'.$item))
									{
										$strArchivosNoMovidos .= 'No es posible eliminar archivo '.$item.' ';
									}
				                }
				            }

				        }
	            	}
	            	else
	            	{
	            		//Nombre del archivo 
						$strNombreArchivo = $strRefArchivo.'.'.$strExtension;

				      	//Hacer recorrido en la carpeta para obtener archivos
						foreach (scandir($strNombreCarpeta) as $item) 
						{
							if ($item == '.' OR $item == '..') continue;

							//Verificar si existe archivo 
							if($item == $strNombreArchivo)
							{
								//Borrar fichero del servidor
								unlink($strRuta.$item);
							}
						}//Cierre de foreach de los archivos 

						
	            	}


	            	//Mover archivo a la carpeta
					if (move_uploaded_file($strBotonArchivoID["tmp_name"][$intCont], $strRuta."$strNombreArchivo")){}
					else
					{
						//Se concatena el nombre del archivo a la variable
						$strArchivosNoMovidos.= $strArchivo.' y ';
					}

			      	
		      	}//Cierre de verificación de archivo(s)
		      	
		    }


		    //Si existe subcarpeta
			if($strNombreSubCarpeta != NULL)
			{
				//Asignar el total de archivos que contiene la carpeta del registro
				$intTotalArchivos = $this->get_total_archivos_registro($strNombreCarpeta);
				//Asignar el total de archivos
				$arrDatos['total_archivos'] = $intTotalArchivos;
		    }
		    

		    //Si hay archivos que no se movieron a la carpeta
		    if ($strArchivosNoMovidos != '') 
			{
				//Quitar el último simbolo concatenado y
		        $strArchivosNoMovidos = substr($strArchivosNoMovidos, 0, -2);

				//Enviar el mensaje de error al formulario
				$arrDatos['resultado'] = FALSE;
				$arrDatos['tipo_mensaje'] = TIPO_MSJ_ERROR;
				$arrDatos['mensaje'] = 'Ocurrió un error al subir el archivo '.$strArchivosNoMovidos.', vuelva a intentarlo.';
			} 
			else 
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos['resultado'] = TRUE;
				$arrDatos['tipo_mensaje'] = TIPO_MSJ_EXITO;
				
			}
    	}
    	else
    	{
    		//Asignar array con los datos del archivo
			$strArchivo = $_FILES[$strBotonArchivoID];
			$strExtension = pathinfo($strArchivo['name'], PATHINFO_EXTENSION);
			//Convertir extension a minúsculas
            $strExtension = strtolower($strExtension);
        	//Nombre del archivo o imagen
			$strNombreArchivo = $strRefArchivo.'.'.$strExtension;

    		//Hacer recorrido en la carpeta para obtener archivos e imágenes
			foreach (scandir($strNombreCarpeta) as $item) 
			{
				if ($item == '.' OR $item == '..') continue;
				//Quitar '.' de la cadena ejemplo: 1.gif(archivo.extensión)
				list($strArchivoExistente,$strExtensionExistente) = explode(".", $item);
				//Verificar si existe archivo 
				if($strArchivoExistente == $strRefArchivo)
				{
					//Borrar fichero del servidor
					unlink($strRuta.$item);
				}


			}//Cierre de foreach de los archivos e imágenes del empleado
			
			//Mover archivo a la carpeta
			if (move_uploaded_file($strArchivo['tmp_name'],$strRuta."$strNombreArchivo")) 
			{
				//Enviar el mensaje de éxito al formulario
				$arrDatos['resultado'] = TRUE;
				$arrDatos['tipo_mensaje'] = TIPO_MSJ_EXITO;
			} 
			else 
			{
				//Enviar el mensaje de error al formulario
				$arrDatos['resultado'] = FALSE;
				$arrDatos['tipo_mensaje'] = TIPO_MSJ_ERROR;
				$arrDatos['mensaje'] = 'Ocurrió un error al subir el archivo, vuelva a intentarlo.';
			}

    	}
		

		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));

	}

	//Función para guardar un archivo PDF en el servidor (carpeta temporal que se eliminará cuando se envía el correo electrónico)
	public function guardar_archivo_pdf($pdf, $strNombreCarpeta, $strNombreArchivo)
	{
		//Si no existe la carpeta crearla
		if(!is_dir($strNombreCarpeta))
		{ 
			@mkdir($strNombreCarpeta, 0700); 
		}
		//Guardar archivo en la carpeta
		$strRuta = $strNombreCarpeta.$strNombreArchivo.'.pdf'; 
		$pdf->Output($strRuta, 'F');
		//Regresar ruta del archivo
        return $strRuta;

	}

	//Función para eliminar carpeta(s) de un registro
	public function eliminar_carpeta_reg($strNombreCarpeta, $bolFormulario = NULL, 
										 $strCarpetaPrincipal = NULL, $strRenglones = NULL)
	{	
		//Variables que se utilizan para asignar el mensaje de error
		$strMensaje = '';
		$strTipoMensaje = '';
		//Variable que se utiliza para asignar el número de archivos que contiene la carpeta principal
		$intTotalArchivos = 0;

		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('resultado' => TRUE, 
						  'tipo_mensaje' => '',
						  'total_archivos' => '',
						  'mensaje' => '');

		//Si existen renglones del registro
		if($strRenglones != NULL)
		{
			/*Quitar | de la lista para obtener el renglón*/
			$arrRenglones = explode("|", $strRenglones);
			//Array que se utiliza para agregar las subcarpetas (renglones) del  registro
			$arrSubcarpetas = array();

			//Verificar si la carpeta es un directorio 
	        if (is_dir($strNombreCarpeta))
	        {
	        	//Hacer recorrido en la carpeta para obtener subcarpetas
	            foreach (scandir($strNombreCarpeta) as $item) 
	            {
	            	if ($item == '.' OR $item == '..') continue;

	            	//Agregar nombre (renglón) de la subcarpeta
	            	$arrSubcarpetas[] = $item;
	            }
	        }

	        //Hacer recorrido para eliminar subcarpetas correspondientes a los renglones que no se encuentran en los detalles
	        foreach($arrSubcarpetas as $valor)
	    	{
	    		//Si la carpetar contiene renglones que no se encunetran en los detalles del registro
				if (!in_array($valor, $arrRenglones))
				{
					//Definir ubicación de la subcarpeta
					$strSubCarpeta = $strNombreCarpeta.'/'.$valor; 

					//Hacer recorrido en la subcarpeta para obtener archivos
		        	foreach(glob($strSubCarpeta . "/*") as $arc)
					{             
						//Borrar fichero del servidor
						if (!unlink($arc))
						{
							$strMensaje .= 'No es posible eliminar archivo '.$arc.' ';
						}
						
					}

					//Borrar subcarpeta del servidor
					if (!rmdir($strSubCarpeta))
					{
						$strMensaje .= 'No es posible eliminar subcarpeta '.$strSubCarpeta;
					}

				}
	    		
	    	}

		}
		else
		{
			//Verificar si la carpeta es un directorio 
	        if (is_dir($strNombreCarpeta))
	        {
	        	//Hacer recorrido en la carpeta para obtener archivos e imágenes
	        	foreach(glob($strNombreCarpeta . "/*") as $item)
				{             
					//Borrar fichero del servidor
					if (!unlink($item))
					{
						$strTipoMensaje = TIPO_MSJ_ERROR;
						$strMensaje .= 'No es posible eliminar archivo '.$item.' ';

					}
					
				}

				//Borrar carpeta del servidor
				if (!rmdir($strNombreCarpeta))
				{
					$strTipoMensaje = TIPO_MSJ_ERROR;
					$strMensaje .= 'No es posible eliminar carpeta '.$strNombreCarpeta;

				}
	        }
		}
		

        //Si la eliminación de la carpeta se hace desde la vista (formulario)
        if($bolFormulario == TRUE)
        {
        	//Si la carpeta que contiene el archivo corresponde a una subcarpeta
          	if($strCarpetaPrincipal != NULL)
          	{
          		//Asignar el total de archivos que contiene la carpeta del registro (principal)
				$intTotalArchivos = $this->get_total_archivos_registro($strCarpetaPrincipal);
				//Asignar el total de archivos
				$arrDatos['total_archivos'] = $intTotalArchivos;
          	}

        	//Si existen errores al momento de eliminar los archivos de la carpeta
        	if($strTipoMensaje == TIPO_MSJ_ERROR)
        	{
        		//Enviar el mensaje de error al formulario
        		$arrDatos['resultado'] = FALSE;
        		$arrDatos['tipo_mensaje'] = $strTipoMensaje;
        		$arrDatos['mensaje'] = $strMensaje;
        	}
        	else
        	{
        		//Enviar el mensaje de éxito al formulario
        		$arrDatos['tipo_mensaje'] = TIPO_MSJ_EXITO;
        		$arrDatos['mensaje'] = 'El archivo se eliminó correctamente.';
        	}

		    //Enviar datos a la vista del formulario
			$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
        }
        else
        {
        	//Regresar mensaje de acción (error o éxito)
        	return $strMensaje;
        }
        
	}


	//Método para renombrar subcarpetas del registro
	public function renombrar_subcarpetas_reg($strCarpetaDestino, $strRenglonesActuales, $strRenglonesAnteriores)
	{
		//Variable que se utiliza para asignar el mensaje de error
		$strMensaje = '';
		/*Quitar | de la lista para obtener el renglon actual y renglonanterior
		*/
		$arrRenglonesActuales = explode("|", $strRenglonesActuales);
		$arrRenglonesAnteriores = explode("|", $strRenglonesAnteriores);

		//Verificar si la carpeta es un directorio 
        if (is_dir($strCarpetaDestino))
        {
        	
        	//Hacer recorrido para cambiar el nombre de la carpeta
			for ($intCon = 0; $intCon < sizeof($arrRenglonesActuales); $intCon++) 
			{

				//Asignar id del renglón (que se va a renombrar) anterior
				$intRenglonAnterior = $arrRenglonesAnteriores[$intCon];
				//Asignar id del renglón actual
				$intRenglonActual = $arrRenglonesActuales[$intCon];

				//Si se cumple la regla de validación
				if($intRenglonAnterior != $intRenglonActual)
				{
					//Asignar ruta de la subcarpeta
					$strArchivoRenglonAnterior = $strCarpetaDestino.'/'.$intRenglonAnterior;
					//Concatenar _temp para no perder el renglón actual por el que fue reemplazado el renglon anterior
					$strArchivoRenglonActual = $strCarpetaDestino.'/'.$intRenglonActual.'_temp';

					//Verificar si la subcarpeta es un directorio 
					if (is_dir($strArchivoRenglonAnterior))
					{
					    //Cambiar el nombre de la subcarpeta
		           		if(rename($strArchivoRenglonAnterior, $strArchivoRenglonActual)){}
		           		else
		           		{
		           			$strMensaje .= 'No es posible cambiar el nombre de la carpeta  '.$intRenglonAnterior.' ';
		           		}
					}
				}
			}

			//Hacer recorrido en la carpeta para obtener subcarpetas
            foreach (scandir($strCarpetaDestino) as $item) 
            {
            	if ($item == '.' OR $item == '..') continue;
            	//Asignar ruta de la subcarpeta
               	$strArchivoTemp = $strCarpetaDestino.'/'.$item;
               	//Reemplazar _temp por cadena vacia
               	$strArchivoRenglon = str_replace("_temp", "", $strArchivoTemp);

               	//Cambiar el nombre de la subcarpeta
               	if(rename($strArchivoTemp, $strArchivoRenglon)){}
               	else
           		{
           			$strMensaje .= 'No es posible cambiar el nombre de la carpeta  '.$strArchivoTemp.' ';
           		}
            }


        }

        //Regresar mensaje de error
        return $strMensaje;
	}

	//Función que se utiliza para regresar los detalles del pago a proveedor
	public function get_datos_detalles_pagos_proveedor($otdDetalles, $intTipoCambioPago = NULL)
	{
		//Variable que se utiliza para asignar la fecha actual 
		$dteFechaCorte = date("Y-m-d");

		//Hacer recorrido para obtener los detalles del registro
		foreach ($otdDetalles as $arrDet)
		{
			//Variable que se utiliza para asignar el id de la orden de compra
			$intReferenciaID = $arrDet->referencia_id;
			//Variable que se utiliza para asignar el tipo de referencia (MAQUINARIA/REFACCIONES/SERVICIO/GENERAL) de la orden de compra 
			$strTipoReferencia = $arrDet->referencia;

			//Variable que se utiliza para asignar el importe del pago
			$intImporte = $arrDet->importe;
			//Variable que se utiliza para asignar el importe de iva del pago
			$intImporteIva = $arrDet->iva;
			//Variable que se utiliza para asignar el importe de ieps del pago
			$intImporteIeps = $arrDet->ieps;
			//Variable que se utiliza para asignar el id de la tasa o cuota del impuesto de IVA
			$intTasaCuotaIva =  $arrDet->tasa_cuota_iva;
			//Variable que se utiliza para asignar el id de la tasa o cuota del impuesto de IEPS
			$intTasaCuotaIeps =   $arrDet->tasa_cuota_ieps;
			//Variable que se utiliza para asignar el tipo de la tasa o cuota del impuesto de IEPS
		    $strTipoTasaCuotaIeps = $arrDet->tipo_ieps;
		    //Variable que se utiliza para asignar el factor de la tasa o cuota del impuesto de IEPS
			$strFactorTasaCuotaIeps = $arrDet->factor_ieps;

			//Seleccionar los datos de la orden de compra que coincida con el id (primer posición del arreglo)
			$otdOrdenCompra = $this->pagos_proveedor->buscar_ordenes_compra_importes(NULL, $dteFechaCorte, 
																					 NULL, NULL, 
																  		    		 $intReferenciaID, 
																  		    		 $strTipoReferencia, 
																  		    		 NULL, 
																  		    		 $intTasaCuotaIva,
																  		    		 $intTasaCuotaIeps)[0];

			//Si hay información
			if($otdOrdenCompra)
			{
				//Variable que se utiliza para asignar el tipo de cambio de la orden de compra
				$intTipoCambioOrden = $otdOrdenCompra->tipo_cambio;

				//Asignar datos de la orden de compra
				$arrDet->folio = $otdOrdenCompra->folio;
				$arrDet->fecha = $otdOrdenCompra->fecha_format;
				$arrDet->moneda_id = $otdOrdenCompra->moneda_id;
				$arrDet->moneda_tipo = $otdOrdenCompra->moneda_tipo;
				$arrDet->tipo_cambio = $intTipoCambioOrden;
				$arrDet->referencia = $otdOrdenCompra->tipo_referencia;
			             
				//Si existe tipo de cambio del pago/descuento
				if($intTipoCambioPago !== NULL)
				{
					//Convertir peso mexicano a tipo de cambio
					$intImporte = ($intImporte / $intTipoCambioPago);
					$intImporteIva = ($intImporteIva / $intTipoCambioPago);
					$intImporteIeps = ($intImporteIeps / $intTipoCambioPago);

					
				}
				

				//Calcular abono
				$intAbono = $intImporte + $intImporteIva + $intImporteIeps;

				//Asignar datos de los importes de la orden de compra
				$intSubtotalOrdenCompra = $otdOrdenCompra->subtotal;
                $intIepsOrdenCompra = $otdOrdenCompra->ieps;

                //Si la tasa de cuota es de tipo RANGO y su factor es Cuota
				if($strTipoTasaCuotaIeps == 'RANGO' && $strFactorTasaCuotaIeps == 'Cuota')
				{
					//Sumarle al subtotal el importe de ieps
					$intSubtotalOrdenCompra += $intIepsOrdenCompra;
					//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
		   	 		$intIepsOrdenCompra = 0;
				}

				$arrDet->subtotal_orden = $intSubtotalOrdenCompra;
				$arrDet->iva_orden = $otdOrdenCompra->iva; 
				$arrDet->ieps_orden = $intIepsOrdenCompra; 
				$arrDet->total_orden = $otdOrdenCompra->importe; 
				$arrDet->importe_pagado = $otdOrdenCompra->abonos;
				$arrDet->saldo_orden =  number_format($otdOrdenCompra->saldo, 2, '.','');

				//Variables auxiliares
				$arrDet->subtotal_orden_auxiliar = number_format($intSubtotalOrdenCompra, 2, '.','');
				$arrDet->iva_orden_auxiliar = number_format($otdOrdenCompra->iva, 2, '.','');
				$arrDet->ieps_orden_auxiliar = number_format($intIepsOrdenCompra, 2, '.','');
				$arrDet->saldo_orden_auxiliar =  $otdOrdenCompra->saldo;
				$arrDet->total_orden_auxiliar = number_format($otdOrdenCompra->importe, 2, '.',''); 


				//Asignar datos de los importes del abono
				$arrDet->importe = $intImporte;
				$arrDet->iva = $intImporteIva;
				$arrDet->ieps = $intImporteIeps;
				$arrDet->abono =  number_format($intAbono, 2, '.','');

				//Variables auxiliares
				$arrDet->importe_auxiliar = number_format($intImporte, 2, '.','');
				$arrDet->iva_auxiliar = number_format($intImporteIva, 2, '.','');
				$arrDet->ieps_auxiliar = number_format($intImporteIeps, 2, '.','');

				//Si no existe id de la tasa o cuota del impuesto de IEPS asignar cadena vacia (para la validación del detalle en el grid view)
				$arrDet->tasa_cuota_ieps = (($arrDet->tasa_cuota_ieps  !== null) ? 
							   	  	  		 $arrDet->tasa_cuota_ieps : '');

			}//Cierre de verificación de la orden de compra


		}//Cierre de foreach detalles del registro

		//Regresar objeto con los datos de los detalles del registro
		return $otdDetalles;
	}


	//Función que se utiliza para regresar los detalles del pago (notas de crédito digital, póliza de abono, etc.) de un cliente
	public function get_datos_detalles_pagos_cliente($otdDetalles, $intTipoCambioPago = NULL)
	{

		//Variable que se utiliza para asignar la fecha actual 
		$dteFechaCorte = date("Y-m-d");

		//Hacer recorrido para obtener los detalles del registro
		foreach ($otdDetalles as $arrDet)
		{
			//Variable que se utiliza para asignar el id de la factura
			$intReferenciaID = $arrDet->referencia_id;
			//Variable que se utiliza para asignar el tipo de referencia (MAQUINARIA/REFACCIONES/SERVICIO/CARTERA) de la factura
			$strTipoReferencia = $arrDet->referencia;
			//Variable que se utiliza para asignar el precio
			$intPrecio = $arrDet->precio;
			//Variable que se utiliza para asignar el importe de iva del pago
			$intImporteIva = $arrDet->iva;
			//Variable que se utiliza para asignar el importe de ieps del pago
			$intImporteIeps = $arrDet->ieps;
			//Variable que se utiliza para asignar el id de la tasa o cuota del impuesto de IVA
			$intTasaCuotaIva =  $arrDet->tasa_cuota_iva;
			//Variable que se utiliza para asignar el id de la tasa o cuota del impuesto de IEPS
			$intTasaCuotaIeps =   $arrDet->tasa_cuota_ieps;
			//Variable que se utiliza para asignar el tipo de la tasa o cuota del impuesto de IEPS
		    $strTipoTasaCuotaIeps = $arrDet->tipo_ieps;
		    //Variable que se utiliza para asignar el factor de la tasa o cuota del impuesto de IEPS
			$strFactorTasaCuotaIeps = $arrDet->factor_ieps;
			//Variable que se utiliza para asignar el total de pagos (recepción de pagos) aplicados a la factura 
			$intTotalPagos = 0;

			
			//Seleccionar los datos de la factura que coincida con el id 
			$otdFactura = $this->pagos_cliente->buscar_facturas_importes(NULL, $dteFechaCorte, NULL, NULL, NULL, 
																	     $intReferenciaID, $strTipoReferencia)[0];


			//Si hay información
			if($otdFactura)
			{
				//Asignar datos de la factura
				$arrDet->folio = $otdFactura->folio;
				$arrDet->fecha = $otdFactura->fecha_format;
				$arrDet->metodo_pago = $otdFactura->metodo_pago;
				$arrDet->moneda_id = $otdFactura->moneda_id;
				$arrDet->moneda_tipo = $otdFactura->moneda_tipo;
				$arrDet->tipo_cambio = $otdFactura->tipo_cambio;
				$arrDet->tipo_referencia_cfdi = $otdFactura->tipo_referencia_cfdi;
				
				//Si existe tipo de cambio de la nota de crédito/póliza de abono
				if($intTipoCambioPago !== NULL)
				{
					//Convertir peso mexicano a tipo de cambio
					$intPrecio = ($intPrecio / $intTipoCambioPago);
					$intImporteIva = ($intImporteIva / $intTipoCambioPago);
					$intImporteIeps = ($intImporteIeps / $intTipoCambioPago);
				}

				//Calcular abono
				$intAbono = $intPrecio + $intImporteIva + $intImporteIeps;
				
				//Asignar datos de los importes de la factura
				$intSubtotalFactura = $otdFactura->subtotal;
                $intIepsFactura = $otdFactura->ieps;
                //Asignar el saldo de la factura que le corresponde a la tasa
				$intSaldoTasa = $otdFactura->saldo_tasa;

				//Asignar acumulado de pagos (recepción de pagos)
				$intTotalPagos = $otdFactura->pagos;

				//Asignar saldo actual de la factura por sus tasas de IVA e IEPS
				$intSaldoTasa = $this->get_saldo_factura_tasa($intTotalPagos, $intReferenciaID, $strTipoReferencia, 
										   				      $intTasaCuotaIva, $intTasaCuotaIeps);

			
                //Si la tasa de cuota es de tipo RANGO y su factor es Cuota
				if($strTipoTasaCuotaIeps == 'RANGO' && $strFactorTasaCuotaIeps == 'Cuota')
				{
					//Sumarle al subtotal el importe de ieps
					$intSubtotalFactura += $intIepsFactura;
					//Asignar cero para no visualizar importe de IEPS por ser de tipo RANGO
		   	 		$intIepsFactura = 0;
				}

		
				//Asignar valores de la factura
				$arrDet->subtotal_factura = $intSubtotalFactura;
				$arrDet->iva_factura = $otdFactura->iva; 
				$arrDet->ieps_factura = $intIepsFactura; 
				$arrDet->total_factura = $otdFactura->importe; 
				$arrDet->importe_pagado = $otdFactura->abonos;
				$arrDet->saldo_factura =  number_format($intSaldoTasa, 2, '.','');

				//Variables auxiliares
				$arrDet->subtotal_factura_auxiliar = number_format($intSubtotalFactura, 2, '.','');
				$arrDet->iva_factura_auxiliar = number_format($otdFactura->iva, 2, '.','');
				$arrDet->ieps_factura_auxiliar = number_format($intIepsFactura, 2, '.','');
				$arrDet->saldo_factura_auxiliar = $intSaldoTasa;
				$arrDet->total_factura_auxiliar = number_format($otdFactura->importe, 2, '.',''); 

				//Asignar datos de los importes del abono
				$arrDet->precio = $intPrecio;
				$arrDet->iva = $intImporteIva;
				$arrDet->ieps = $intImporteIeps;
				$arrDet->abono =  number_format($intAbono, 2, '.','');

				//Variables auxiliares
				$arrDet->precio_auxiliar = number_format($intPrecio, 2, '.','');
				$arrDet->iva_auxiliar = number_format($intImporteIva, 2, '.','');
				$arrDet->ieps_auxiliar = number_format($intImporteIeps, 2, '.','');

				//Si no existe id de la tasa o cuota del impuesto de IEPS asignar cadena vacia (para la validación del detalle en el grid view)
				$arrDet->tasa_cuota_ieps = (($arrDet->tasa_cuota_ieps  !== null) ? 
							   	  	  		 $arrDet->tasa_cuota_ieps : '');

			}//Cierre de verificación de la factura


		}//Cierre de foreach detalles del registro

		//Regresar objeto con los datos de los detalles del registro
		return $otdDetalles;
	}

	//Función que se utiliza para regresar los detalles del anticipo (fiscal/No fiscal) de un cliente
	public function get_datos_detalles_anticipos_cliente($otdDetalles)
	{
		//Variable que se utiliza para asignar la fecha actual 
		$dteFechaCorte = date("Y-m-d");

		//Hacer recorrido para obtener los detalles del registro
		foreach ($otdDetalles as $arrDet)
		{
			//Variable que se utiliza para asignar el id del anticipo
			$intReferenciaID = $arrDet->referencia_id;
			//Variable que se utiliza para asignar el tipo de referencia (FISCAL/NO FISCAL) del anticipo
			$strTipoReferencia = $arrDet->referencia;
			//Variable que se utiliza para asignar el subtotal
			$intSubtotal = $arrDet->subtotal;
			//Variable que se utiliza para asignar el importe de iva de la devolución
			$intImporteIva = $arrDet->iva;
			//Variable que se utiliza para asignar el importe de ieps de la devolución
			$intImporteIeps = $arrDet->ieps;
			
			//Seleccionar los datos del anticipo que coincida con el id (primer posición del arreglo)
			$otdAnticipo = $this->anticipos_cliente->buscar_saldos_anticipos($dteFechaCorte, NULL, 
																			 NULL, NULL, 
																			 NULL, NULL, 
																			 $intReferenciaID, 
																			 $strTipoReferencia)[0];
			//Si hay información
			if($otdAnticipo)
			{

				//Variable que se utiliza para asignar el tipo de cambio
				$intTipoCambio = $otdAnticipo->tipo_cambio; 

				//Asignar datos del anticipo
				$arrDet->folio = $otdAnticipo->folio;
				$arrDet->fecha = $otdAnticipo->fecha_format;
				$arrDet->tipo_cambio = $otdAnticipo->tipo_cambio; 
				$arrDet->concepto = $otdAnticipo->concepto;
				$arrDet->subtotal_anticipo = $otdAnticipo->subtotal;
				$arrDet->iva_anticipo = $otdAnticipo->iva;
				$arrDet->ieps_anticipo = $otdAnticipo->ieps;
				$arrDet->total_anticipo = $otdAnticipo->importe;
				$arrDet->saldo_anticipo =  number_format($otdAnticipo->saldo, 2, '.',''); 

				//Convertir peso mexicano a tipo de cambio
				$intSubtotal = ($intSubtotal / $intTipoCambio);
				$intImporteIva = ($intImporteIva / $intTipoCambio);
				$intImporteIeps = ($intImporteIeps / $intTipoCambio);

				//Calcular devolución 
				$intDevolucion = $intSubtotal + $intImporteIva + $intImporteIeps;

				//Asignar datos de los importes de la devolución
				$arrDet->subtotal = $intSubtotal;
				$arrDet->iva = $intImporteIva;
				$arrDet->ieps = $intImporteIeps;
				$arrDet->devolucion =  number_format($intDevolucion, 2, '.','');

				//Variables auxiliares
				$arrDet->subtotal_auxiliar = number_format($intSubtotal, 2, '.','');
				$arrDet->iva_auxiliar = number_format($intImporteIva, 2, '.','');
				$arrDet->ieps_auxiliar = number_format($intImporteIeps, 2, '.','');


				//Si no existe id de la tasa o cuota del impuesto de IEPS asignar cadena vacia (para la validación del detalle en el grid view)
				$arrDet->tasa_cuota_ieps = (($arrDet->tasa_cuota_ieps  !== null) ? 
							   	  	  		 $arrDet->tasa_cuota_ieps : '');
				
			}//Cierre de verificación del anticipo


		}//Cierre de foreach detalles del registro

		//Regresar objeto con los datos de los detalles del registro
		return $otdDetalles;
	}

	//Método para regresar el saldo actual de una factura por sus tasas de IVA e IEPS
	public function get_saldo_factura_tasa($intTotalPagos, $intReferenciaID, $strTipoReferencia, 
										   $intTasaCuotaIvaFra, $intTasaCuotaIepsFra)
	{

		//Variable que se utiliza para asignar la fecha actual 
		$dteFechaCorte = date("Y-m-d");

		//Seleccionar las tasas de los detalles (agrupados por tasa_cuota_iva y tasa_cuota_ieps) de la factura 
   		$otdTasas =  $this->pagos_cliente->buscar_tasas_detalles_facturas($intReferenciaID, $strTipoReferencia);
   		//Si hay información
		if($otdTasas)
		{
			//Hacer recorrido para obtener las distintas tasas de los detalles de la factura
			foreach ($otdTasas as $arrTasa)
			{
				//Variable que se utiliza para asignar el id de la tasa o cuota del impuesto de IVA
			    $intTasaCuotaIva = $arrTasa->tasa_cuota_iva;
			    //Variable que se utiliza para asignar el id de la tasa o cuota del impuesto de IEPS
			    $intTasaCuotaIeps = $arrTasa->tasa_cuota_ieps;

				//Seleccionar los importes de la factura (primer posición del arreglo)
				$otdImportesTasa = $this->pagos_cliente->buscar_facturas_importes(NULL, $dteFechaCorte, NULL, 
									   				  		   				  	  NULL, NULL, $intReferenciaID, 
									   				           				      $strTipoReferencia, NULL, NULL, 
									   				           				      NULL, $intTasaCuotaIva, 
									   				           				      $intTasaCuotaIeps)[0];
				//Si hay información
				if($otdImportesTasa)
				{
					//Asignar el saldo de la factura que le corresponde a la tasa
					$intSaldoTasa = $otdImportesTasa->saldo_tasa;

					//Si la factura no se encuentra pagada 
					//if (($intSaldoTasa >= 1) OR ($intSaldoTasa <= -1))  //Validación anterior
					if($intSaldoTasa > 0)
					{
						//Si se cumple la sentencia (decrementar el acumulado de los pagos)
	                    if($intTotalPagos > $intSaldoTasa)
	                    {
	                    	//Decrementar el acumulado de los pagos (recepción de pagos)
	                    	$intTotalPagos -= $intSaldoTasa;
	                    	//Asignar valor cero para indicar que ya se saldo la factura con esta tasa
	                    	$intSaldoTasa = 0;
	                    }
	                    else
	                    {
	                    	//Decrementar el saldo de la tasa
	                    	$intSaldoTasa -= $intTotalPagos;
	                    	//Asignar valor cero para evitar decrementar el resto del acumulado de pagos
	                    	$intTotalPagos = 0;
	                    }

	                    //Si se cumple la sentencia
	                    if($intTasaCuotaIvaFra == $intTasaCuotaIva AND  $intTasaCuotaIepsFra == $intTasaCuotaIeps)
	                    {
	                    	//Regresar el saldo de la factura por sus tasas de IVA e IEPS
	                    	return $intSaldoTasa;
	                    }

					}//Cierre de verificación del saldo

				}//Cierre de verificación de importe y saldo de la factura por su tasa	


			}//Cierre de foreach tasas de los detalles de la factura

		}//Cierre de verificación de tasas de los detalles de la factura

	}

	//Función que se utiliza para regresar los abonos (pagos) de una factura
	public function get_abonos_factura($intID, $strTipoReferencia, $strEstatus)
	{

		//Variable que se utiliza para asignar la fecha actual 
		$dteFechaCorte = date("Y-m-d");

		//Variable que se utiliza para asignar el importe de abonos (pagos) de la factura
		$intAbonos = 0;

		//Si se cumple la sentencia
		if($strEstatus == 'TIMBRAR')
		{
			//Seleccionar los abonos (pagos) de la factura (en caso de que existan abonos no permitir agregar/eliminar detalles de la factura)
			$otdPagosFra = $this->pagos_cliente->buscar_facturas_importes(NULL, $dteFechaCorte, NULL, NULL, NULL, 
															     		   $intID, $strTipoReferencia)[0];

			//Si hay información de la factura (pagos)
			if($otdPagosFra)
			{
				//Si existen abonos (pagos) de la factura
				if($otdPagosFra->abonos > 0)
				{
					$intAbonos = $otdPagosFra->abonos;
				}
				
			}//Cierre de verificación de pagos	
		}


		//Regresar abonos de la factura
		return $intAbonos;
	}

	//Función que se utiliza para regresar el saldo por aplicar de un anticipo
	public function get_saldo_anticipo($intAnticipoID, $intReferenciaID =  NULL, $strTipoReferencia = NULL, $strFormulario = NULL, $intRenglon = NULL)
	{

		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('saldo' => NULL,
						  'numero_operaciones' => NULL);

		//Variable que se utiliza para asignar el saldo por aplicar del anticipo 
		$intSaldo = 0;
		//Variable que se utiliza para asignar el número de operaciones del anticipo aplicado
		$intNumeroOperaciones = 0;

		//Si existe id del anticipo
		if($intAnticipoID > 0)
		{

			//Seleccionar el saldo por aplicar del anticipo (primer posición del arreglo)
		    $otdSaldoAplicar = $this->anticipos_cliente->buscar_saldos_anticipos(NULL, NULL, NULL, NULL,  NULL, NULL,
																				 $intAnticipoID, 'FISCAL', 
																				 $intReferenciaID, $strTipoReferencia, $strFormulario, $intRenglon)[0];

		   
		    //Si hay información
			if($otdSaldoAplicar)
			{
				//Convertir tipo de moneda a peso méxicano
				$intSaldo = $otdSaldoAplicar->saldo * $otdSaldoAplicar->tipo_cambio;

				//Convertir cantidad a dos decimales
				$intSaldo =  number_format($intSaldo, 2, '.', '');

				//Asignar el número de operaciones del anticipo (aplicado)
				$intNumeroOperaciones = $otdSaldoAplicar->numero_operaciones;

			}//Cierre de verificación del saldo
		
		}
		

		//Asignar datos al array los saldos de la cuenta contable
		$arrDatos = array('saldo' => $intSaldo,
						  'numero_operaciones' =>  $intNumeroOperaciones);

		//Regresar array con los datos del anticipo
		return $arrDatos;
	}

	//Función que se utiliza para saber si la cotización hace referencia a una factura, pedido o remisión
	public function get_referencia_cotizacion_refacciones($intCotizacionRefaccionesID)
	{
		//Variable que se utiliza para asignar el tipo de referencia de la cotización
		$strTipoReferencia = '';

		//Seleccionar los datos de la factura que tiene como referencia el id de la cotización
        $otdFactura = $this->facturas_refacciones->buscar(NULL, NULL, NULL, 
									    				  NULL, NULL, NULL, 
									   					  $intCotizacionRefaccionesID, 
									   					  'COTIZACION');

		//Seleccionar los datos del pedido que tiene como referencia el id de la cotización
        $otdPedido = $this->pedidos_refacciones->buscar(NULL, NULL, NULL, 
						  								NULL, NULL,  NULL, $intCotizacionRefaccionesID);

        //Dependiendo de la referencia, asignar valor
        if($otdFactura)
        {
        	//Significa que la cotización se encuentra en una factura de refacciones
        	$strTipoReferencia = 'FACTURA';
        }
        else if($otdPedido)
        {
        	//Significa que la cotización se encuentra en un pedido de refacciones
        	$strTipoReferencia = 'PEDIDO';
        }

        //Regresar tipo de referencia de la cotización
        return $strTipoReferencia;
	}


	//Función que se utiliza para saber si el pedido hace referencia a una factura o remisión
	public function get_referencia_pedido_refacciones($intPedidoRefaccionesID)
	{
		//Variable que se utiliza para asignar el tipo de referencia del pedido
		$strTipoReferencia = '';

		//Seleccionar los datos de la factura que tiene como referencia el id del pedido
        $otdFactura = $this->facturas_refacciones->buscar(NULL, NULL, NULL, 
									    				  NULL, NULL, NULL, 
									   					  $intPedidoRefaccionesID, 
									   					  'PEDIDO');

        //Dependiendo de la referencia, asignar valor
        if($otdFactura)
        {
        	//Significa que el pedido se encuentra en una factura de refacciones
        	$strTipoReferencia = 'FACTURA';
        }
       

        //Regresar tipo de referencia del pedido
        return $strTipoReferencia;
	}

	//Función que se utiliza para regresar el número de días vencidos
	public function get_dias_vencidos($dteFechaCorte, $dteFechaVencimiento)
	{
		//Variable que se utiliza para asignar el número de días vencidos
		$intDiasVencidos = 0;

		//Calcular los días vencidos
		$intDiasVencidos = ceil((strtotime($dteFechaCorte) - strtotime($dteFechaVencimiento)) / 86400);
		
		//Regresar el número de días vencidos
		return $intDiasVencidos;
	}

	//Función que se utiliza para regresar el número de días de un mes
	public function get_dias_mes($intMes, $strAnio)
	{
		//Variable que se utiliza para asignar el número de días vencidos
		$intDiasMes = 0;

	    //Calcular los días del mes
		$intDiasMes = cal_days_in_month(CAL_GREGORIAN, $intMes, $strAnio);

		//Regresar el número de días
		return $intDiasMes;
	}


	//Función que se utiliza para regresar las semanas que tiene un mes
	public function get_semanas_mes($strMes, $strAnio)
	{

		//Indica cuando comienza y cuando finaliza una semana
		$bolInicioSemana = FALSE;
		//Variable que se utiliza para asignar el número de días anteriores al primer Lunes del mes
		$intDiasAntPrimerLunes = 0;
		//Variable que se utiliza para indicar el primer Lunes del mes
		$intPrimerLunes = 0;
		//Array que se utiliza para agregar los días anteriores al primer Lunes del mes
		$arrDiasAntPrimerLunes = array();
		//Variable que se utiliza para asignar el último Lunes del mes (indica que se completo la última semana del mes)
		$intUltimoLunes = 0;
		//Obtener el último día del mes
		$strMesAnio = $strAnio.'-'.$strMes;
		$strAuxiliar = date('Y-m-d', strtotime("{$strMesAnio} + 1 month"));
		$intUltimoDiaMes = date('d', strtotime("{$strAuxiliar} - 1 day"));
	    //Variable que se utiliza para contar el número de días del mes (indica el día en que termina el mes)
		$intContador = 1;
		//Array que se utiliza para agregar los datos de las semanas del mes
        $arrSemanas = array();
        //Array que se utiliza para agregar los datos de una semana (rango)
        $arrAuxiliar = array();

		//Array que se utiliza para agregar los días del mes
	    $arrDiasMes = array();
	    //Hacer recorrido para obtener los días del mes
		for($intDia=1; $intDia<=31; $intDia++)
		{	
			//Obtener el timestamp de la fecha indicada
		    $intTiempo = mktime(12, 0, 0, $strMes, $intDia, $strAnio);          
		    //Si el día se encuentra en el mes
		    if (date('m', $intTiempo) == $strMes)
		    {	
		       //Agregar al array el día del mes (por ejemplo: Sun|01 = día de la semana|número del día)
		       $arrDiasMes[] = date('D|d', $intTiempo);
		    }    
		}

		//Hacer recorrido para formar array con las semanas del mes
		foreach ($arrDiasMes as $row)
		{ 
			
			//Separar día de la semana (nombre del día| día del mes)
			$arrDia = explode("|", $row);
			//Variable que se utiliza para asignar el nomnre del día (Lunes, Martes, Miércoles, Jueves, Viernes, Sábado y Domingo)
			$strNombreDia = $arrDia[0];
			//Variable que se utiliza para asignar el día del mes
			$intDia = $arrDia[1];

			//Si el día de la semana no corresponde al primer lunes
			if($strNombreDia != "Mon" &&  $intPrimerLunes == 0)
		    {
		    	//Incrementar contador por cada día diferente al primer Lunes del mes
		    	$intDiasAntPrimerLunes++;
		    	//Agregar al array el día (anterior al primer Lunes) del mes
		    	$arrDiasAntPrimerLunes[] = $intDia;
		    } 

			//Si el día es Lunes	
			if ($strNombreDia == "Mon") 
			{
				//Si el valor es cero, significa que es el primer Lunes del mes
				if($intPrimerLunes == 0)
				{
					//Incrementar contador para indicar que ya existe primer Lunes del mes
					$intPrimerLunes++;
				}

				//Si existen días anteriores al primer Lunes del mes
				if($intDiasAntPrimerLunes > 0)
				{

					//Definir valores del array auxiliar de información (para cada semana)
					$arrAuxiliar["primer_dia"] = $arrDiasAntPrimerLunes[0];
					$arrAuxiliar["ultimo_dia"] = $arrDiasAntPrimerLunes[$intDiasAntPrimerLunes-1];
					//Agregar datos al array
	                array_push($arrSemanas, $arrAuxiliar);

				}

				//Asignar TRUE para indicar que la semana comenzo
				$bolInicioSemana = TRUE;

				//Asignar número de día del mes que le corresponde al día Lunes
				$intDiaLunes = $intDia;

				//Inicializar varible para indicar que ya existe primer Lunes del mes
				$intDiasAntPrimerLunes = 0;

				//Asignar último Lunes del mes
				$intUltimoLunes = $intDia;
				
			}
			else if($bolInicioSemana && $strNombreDia == "Sun")//Si el día es Domingo	
			{
				//Asignar FALSE para indicar que la semana finalizo (reiniciar variable)
				$bolInicioSemana = FALSE;

				//Definir valores del array auxiliar de información (para cada semana)
				$arrAuxiliar["primer_dia"] = $intDiaLunes;
				$arrAuxiliar["ultimo_dia"] = $intDia;
				//Agregar datos al array
                array_push($arrSemanas, $arrAuxiliar);
			}

			//Obtener días después del último Lunes del mes
			$intDiasPSemana = $intUltimoDiaMes - $intUltimoLunes;
			
			//Si no se cumple con la semana (días faltantes)
			if($intDiasPSemana != 6)
			{
				//Si es el último día del mes
				if ($intContador == $intUltimoDiaMes) 
				{

					//Definir valores del array auxiliar de información (para cada semana)
					$arrAuxiliar["primer_dia"] = $intDiaLunes;
					$arrAuxiliar["ultimo_dia"] = $intDia;
					//Agregar datos al array
	                array_push($arrSemanas, $arrAuxiliar);
				}
			}

		
			//Incrementar contador por cada día
			$intContador++;
		}


		//Regresar array con las semanas del mes
		return $arrSemanas;
	}


	//Función que se utiliza para regresar el saldos (inicial (anterior) y actual) de la cuenta contable
	public function get_saldos_cuenta_contable($arrCta)
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('saldo_inicial' => NULL,
						  'saldo_actual' => NULL, 
						  'acumulado_cargos' => NULL,
						  'acumulado_abonos' => NULL);

		//Variable que se utiliza para asignar el saldo inicial
		$intSaldoInicial = 0;
		//Variable que se utiliza para asignar el saldo actual
		$intSaldoActual = 0;
		//Variable que se utiliza para asignar el acumulado de los cargos para calcular el saldo inicial
		$intAcumCargosSaldoInicial = 0;
		//Variable que se utiliza para asignar el acumulado de los abonos para calcular el saldo inicial
		$intAcumAbonosSaldoInicial = 0;
		//Variable que se utiliza para asignar el acumulado de los cargos para calcular el saldo actual
		$intAcumCargosSaldoActual = 0;
		//Variable que se utiliza para asignar el acumulado de los abonos para calcular el saldo actual
		$intAcumAbonosSaldoActual = 0;

	
		//Asignar cargos y abonos correspondientes al saldo inicial
		$intAcumCargosSaldoInicial = $arrCta->cargos_saldo_inicial;
		$intAcumAbonosSaldoInicial = $arrCta->abonos_saldo_inicial;
		
		//Asignar cargos y abonos correspondientes al saldo actual
		$intAcumCargosSaldoActual = $arrCta->cargos_saldo_actual;
		$intAcumAbonosSaldoActual = $arrCta->abonos_saldo_actual;

		//Dependiendo de la naturaleza de la cuenta, calcular el saldo inicial (anterior)
		if($arrCta->naturaleza == 'ACREEDORA')
		{
			$intSaldoInicial = $intAcumAbonosSaldoInicial - $intAcumCargosSaldoInicial;
			$intSaldoActual = $intAcumAbonosSaldoActual - $intAcumCargosSaldoActual;
		}
		else
		{
			$intSaldoInicial = $intAcumCargosSaldoInicial - $intAcumAbonosSaldoInicial;
			$intSaldoActual = $intAcumCargosSaldoActual - $intAcumAbonosSaldoActual;
		}

		//Decrementar saldo inicial (anterior)
		$intSaldoActual += $intSaldoInicial;

		//Convertir cantidad a dos decimales
	    $intSaldoInicial =  number_format($intSaldoInicial, 2, '.', '');
	    $intSaldoActual =  number_format($intSaldoActual, 2, '.', '');
	    $intAcumCargosSaldoActual =  number_format($intAcumCargosSaldoActual, 2, '.', '');
	    $intAcumAbonosSaldoActual =  number_format($intAcumAbonosSaldoActual, 2, '.', '');

		//Asignar datos al array los saldos de la cuenta contable
		$arrDatos = array('saldo_inicial' => $intSaldoInicial,
						  'saldo_actual' =>  $intSaldoActual, 
						  'acumulado_cargos' =>  $intAcumCargosSaldoActual,
						  'acumulado_abonos' =>  $intAcumAbonosSaldoActual);

		//Regresar array con los saldos de la cuenta contable
		return $arrDatos;
	}

	//Función que se utiliza para regresar el domicilio del cliente/prospecto
	public function get_domicilio_cliente($arrCol)
	{
		//Variable que se utiliza para regresar el domicilio del cliente/prospecto
		$strDomicilio = '';

		//Verificar si el prospecto es un cliente
		if($arrCol->cliente_estatus == 'ACTIVO')
		{
			//Asignar los datos del cliente
			$strCalle = $arrCol->cliente_calle;
			$strNumExterior = $arrCol->cliente_numero_exterior;
			$strNumInterior = $arrCol->cliente_numero_interior;
			$strColonia = $arrCol->cliente_colonia;
			$strCodigoPostal = $arrCol->cliente_codigo_postal;
			$strLocalidad = $arrCol->cliente_localidad;
			$strMunicipio = $arrCol->cliente_municipio;
			$strEstado = $arrCol->cliente_estado;
		}
		else
		{
			//Asignar los datos del prospecto
			$strCalle = $arrCol->calle;
			$strNumExterior = $arrCol->numero_exterior;
			$strNumInterior = $arrCol->numero_interior;
			$strColonia = $arrCol->colonia;
			$strCodigoPostal = $arrCol->codigo_postal;
			$strLocalidad = $arrCol->localidad;
			$strMunicipio = $arrCol->municipio;
			$strEstado = $arrCol->estado;
		}

		//Si no existe el número interior asignar cadena vacia
		$strNumInterior = (($strNumInterior !== NULL && 
			        	    empty($strNumInterior) === FALSE) ?
                            ' INT. '.$strNumInterior : '');

		//Si no existe el código postal asignar cadena vacia
		$strCodigoPostal = (($strCodigoPostal !== NULL && 
			        	     empty($strCodigoPostal) === FALSE) ?
                             ' C.P. '.$strCodigoPostal : '');

		//Concatenar datos para el domicilio
    	$strDomicilio =  $strCalle . ' NO.'.$strNumExterior;
    	$strDomicilio .= $strNumInterior.' COL. ' . $strColonia;
    	$strDomicilio .= $strCodigoPostal.' '.$strLocalidad. ', ';
    	$strDomicilio .= $strMunicipio. ', '.$strEstado;

    	//Regresar el domicilio del cliente/prospecto
    	return $strDomicilio;
	} 


	


	//Función pque se utiliza para regresar el porcentaje de cumplimiento con base a un presupuesto 
	public function get_cumplimiento_ppto($intPresupuestado, $intImpReal)
	{
        //Variable que se utiliza para regresar el porcentaje de cumplimiento
        $intPorcCumplimiento = 0;

        //Si existe importe del presupuesto
        if($intPresupuestado > 0)
        {
            //Calcular el porcentaje de cumplimiento
            $intPorcCumplimiento = ($intImpReal / $intPresupuestado) * 100;
        }

        //Regresar el porcentaje de cumplimiento
        return $intPorcCumplimiento;
	}


	//Función para obtener el último dígito de una placa vehicular
	public function ultimo_digito($placa){
		if(preg_match('/(\d+)[^\d]*/', $placa, $match)){
	        return $match[1][strlen($match[1])-1];
	    } else {
	        return NULL;
	    }
	}

}
?>