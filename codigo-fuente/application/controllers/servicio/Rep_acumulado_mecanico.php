<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_acumulado_mecanico extends MY_Controller {
	
	//Variable para identificar el tipo de movimiento
	var $intTipoMovimiento = SALIDA_REFACCIONES_TALLER;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de ordenes de reparación
		$this->load->model('servicio/ordenes_reparacion_model', 'ordenes');
		//Cargamos el modelo de tipos se servicios
		$this->load->model('servicio/servicios_tipos_model', 'tipos');
		//Cargamos el modelo de prospectos
		$this->load->model('crm/prospectos_model', 'prospectos');
		//Cargamos el modelo de mecánicos
		$this->load->model('servicio/mecanicos_model', 'mecanicos');
		//Cargamos el modelo de movimientos de refacciones
		$this->load->model('refacciones/movimientos_refacciones_model', 'movimientos');
		//Cargamos el modelo de trabajos foráneos internos
		$this->load->model('servicio/trabajos_foraneos_model', 'trabajos');
		//Cargamos el modelo de pagos
		$this->load->model('caja/pagos_model', 'pagos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('servicio/rep_acumulado_mecanico', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	

	/*Método para generar un reporte PDF con los acumulados por mecánico
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strSucursales = $this->input->post('strSucursales');
		$strServiciosTipos = $this->input->post('strServiciosTipos');
		$intMecanicoID = $this->input->post('intMecanicoID');


		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

		//Buscar el nombre de las sucursales que han sido seleccionadas y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 2
	    $strTituloSucursales = '';
	    $arrSucursalesID = explode('|', $strSucursales);
	    //Hacer recorrido para obtener el id de las sucursales
	    foreach ($arrSucursalesID as &$intSucursalID) 
	    {		    
		    //Seleccionar los datos de la sucursal
			$otdSucursal = $this->sucursales->buscar($intSucursalID);
			//Concatenamos el nombre de la sucursal a la variable de impresión
			$strTituloSucursales .= $otdSucursal->nombre.', ';
		}

		//Quitar último elemento de la cadena (,)
		$strTituloSucursales = substr($strTituloSucursales, 0, -2);

		//Buscar el nombre de los tipos de servicios que han sido seleccionados y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 3
	    $strTituloServiciosTipos = '';
	    $arrServiciosTiposID = explode('|', $strServiciosTipos);
	    //Hacer recorrido para obtener el id de los tipos de servicios
	    foreach ($arrServiciosTiposID as &$intServicioTipoID) 
	    {		    
		    //Seleccionar los datos del tipo de servicio
			$otdServicioTipo = $this->tipos->buscar($intServicioTipoID);
			//Concatenamos la descripción del tipo de servicio a la variable de impresión
			$strTituloServiciosTipos .= $otdServicioTipo->descripcion.', ';
		}

		//Quitar último elemento de la cadena (,)
		$strTituloServiciosTipos = substr($strTituloServiciosTipos, 0, -2);


		//Si existe id del mecánico
		if($intMecanicoID > 0)
		{
			
			//Hacer un llamado a la función para generar un reporte PDF con el listado de movimientos (detallado) de un mecánico
			$this->get_reporte_mecanico($strSucursales, $strServiciosTipos, $strTituloSucursales, 
									    $strTituloServiciosTipos, $strTituloRangoFechas,
									    $dteFechaInicial, $dteFechaFinal, 
									    $intMecanicoID);
		}
		else
		{
			//Hacer un llamado a la función para generar un reporte PDF con el listado general de acumulados por mecánico
			$this->get_reporte_general($strSucursales, $strServiciosTipos, $strTituloSucursales, 
									   $strTituloServiciosTipos, $strTituloRangoFechas,
									   $dteFechaInicial, $dteFechaFinal);
		}
		
	}


	/*Método para generar un reporte PDF con  el listado de movimientos (detallado) de un mecánico
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte_mecanico($strSucursales, $strServiciosTipos, $strTituloSucursales, 
									     $strTituloServiciosTipos, $strTituloRangoFechas,
									     $dteFechaInicial, $dteFechaFinal, $intMecanicoID) 
	{

		//Array que se utiliza para agregar los datos de las ordenes de reparación
		$arrOrdenesReparacion = array();
		//Variables que se utilizan para asignar los acumulados de servicios de mano de obra
	    $intAcumGralSubtotalMO = 0;
	    $intAcumGralIvaMO = 0;
	    $intAcumGralIepsMO = 0;
	    $intAcumGralTotalMO = 0;
	    $intAcumGralHorasMO = 0;
	    //Variables que se utilizan para asignar los acumulados de salidas de refacciones
	    $intAcumGralSubtotalSR = 0;
	    $intAcumGralIvaSR = 0;
	    $intAcumGralIepsSR = 0;
	    $intAcumGralTotalSR = 0;
	    //Variables que se utilizan para asignar los acumulados de trabajos foráneos
	    $intAcumGralSubtotalTF = 0;
	    $intAcumGralIvaTF = 0;
	    $intAcumGralIepsTF = 0;
	    $intAcumGralTotalTF = 0;
	    //Variables que se utilizan para asignar los acumulados de otros servicios
	    $intAcumGralSubtotalOtros = 0;
	    $intAcumGralIvaOtros = 0;
	    $intAcumGralIepsOtros = 0;
	    $intAcumGralTotalOtros = 0;
	    //Variables que se utilizan para asignar los acumulados de gastos de servicio
	    $intAcumGralSubtotalGS = 0;
	    $intAcumGralIvaGS = 0;
	    $intAcumGralIepsGS = 0;
	    $intAcumGralTotalGS = 0;

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA', 'PAG.', 'CLIENTE', 'MANO DE OBRA', 'REFACCIONES', 
								  'TRAB. FOR.', 'OTROS', 'KMS.');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(18, 15, 10, 47, 20, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'C', 'L', 'R', 'R', 'R', 'R', 'R');
		//Establece el ancho de las columnas de la tabla totales
		$arrAnchuraTotales = array(90, 20, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R', 'R', 'R', 'R');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  utf8_decode('REPORTE INDIVIDUAL DE MECÁNICOS ').$strTituloRangoFechas;
		//Asignar el valor de la línea dos del título
		$pdf->strLinea2 = utf8_decode('SUCURSALES: '.trim($strTituloSucursales));
		//Asignar el valor de la línea tres del título
		$pdf->strLinea3 = utf8_decode('TIPOS DE SERVICIOS: '.trim($strTituloServiciosTipos));
		//Si existe id del mecánico
		if($intMecanicoID > 0)
		{
			//Seleccionar los datos del mecánico que coincide con el id
			$otdMecanico =  $this->mecanicos->buscar($intMecanicoID);
			$pdf->strLinea4 = utf8_decode( 'MECÁNICO: '.$otdMecanico->empleado);
		}

		

		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Establecer el color de línea
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Asignar objeto con los acumulados de los mecánicos en el rango de fechas
		$otdAcumulados = $this->get_acumulados_mecanicos($dteFechaInicial, $dteFechaFinal, $strSucursales, 
									   					 $strServiciosTipos, $intMecanicoID);
		//Asignar array con los datos de las ordenes de reparación
		$arrOrdenesReparacion = $otdAcumulados['rows'];
	    //Asignar acumulados
		//Acumulados de servicios de mano de obra
		$intAcumGralSubtotalMO = $otdAcumulados['acumulado_gralSubtotalMO'];
	    $intAcumGralIvaMO = $otdAcumulados['acumulado_gralIvaMO'];
	    $intAcumGralIepsMO = $otdAcumulados['acumulado_gralIepsMO'];
	    $intAcumGralTotalMO = $otdAcumulados['acumulado_gralTotalMO'];
	    $intAcumGralHorasMO = $otdAcumulados['acumulado_gralHorasMO'];
	    //Acumulados de salidas de refacciones
	    $intAcumGralSubtotalSR = $otdAcumulados['acumulado_gralSubtotalSR'];
	    $intAcumGralIvaSR = $otdAcumulados['acumulado_gralIvaSR'];
	    $intAcumGralIepsSR = $otdAcumulados['acumulado_gralIepsSR'];
	    $intAcumGralTotalSR = $otdAcumulados['acumulado_gralTotalSR'];
	    //Acumulados de trabajos foráneos
	    $intAcumGralSubtotalTF = $otdAcumulados['acumulado_gralSubtotalTF'];
	    $intAcumGralIvaTF = $otdAcumulados['acumulado_gralIvaTF'];
	    $intAcumGralIepsTF = $otdAcumulados['acumulado_gralIepsTF'];
	    $intAcumGralTotalTF = $otdAcumulados['acumulado_gralTotalTF'];
	    //Acumulados de otros servicios
	    $intAcumGralSubtotalOtros = $otdAcumulados['acumulado_gralSubtotalOtros'];
	    $intAcumGralIvaOtros = $otdAcumulados['acumulado_gralIvaOtros'];
	    $intAcumGralIepsOtros = $otdAcumulados['acumulado_gralIepsOtros'];
	    $intAcumGralTotalOtros = $otdAcumulados['acumulado_gralTotalOtros'];
	    //Acumulados de gastos de servicio
	    $intAcumGralSubtotalGS = $otdAcumulados['acumulado_gralSubtotalGS'];
	    $intAcumGralIvaGS = $otdAcumulados['acumulado_gralIvaGS'];
	    $intAcumGralIepsGS = $otdAcumulados['acumulado_gralIepsGS'];
	    $intAcumGralTotalGS = $otdAcumulados['acumulado_gralTotalGS'];

		//Si hay información de las ordenes de reparación
		if($arrOrdenesReparacion)
		{
			//Recorremos el arreglo 
	        foreach ($arrOrdenesReparacion as $arrDet) 
	        {
	        	//Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
			    $pdf->Row(array($arrDet['folio'], $arrDet['fecha'], $arrDet['pagada'],
			    			    utf8_decode($arrDet['prospecto']), 
			    				'$'.number_format($arrDet['subtotal_MO'],2),
			    				'$'.number_format($arrDet['subtotal_SR'],2),
			    				'$'.number_format($arrDet['subtotal_TF'],2),
			    				'$'.number_format($arrDet['subtotal_Otros'],2),
			    				'$'.number_format($arrDet['subtotal_GS'],2)), 
			    			    $pdf->arrAlineacion, 'ClippedCell');

			    //Tipo de servicio
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(25, 3, 'TIPO DE SERVICIO:', 0, 0, 'L', 0);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(165, 3, utf8_decode($arrDet['servicio_tipo']), 0, 0, 'L', 0);
				$pdf->Ln(4);//Deja un salto de línea

	        }//Cierre de foreach 


		}//Cierre de verificación de información

		//------------------------------------------------------------------------------------------------------------------------
        //---------- RESUMEN
        //------------------------------------------------------------------------------------------------------------------------
		//Dibuja una línea para separar el total
    	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    	//Establece el ancho de las columnas
		$pdf->SetWidths($arrAnchuraTotales);

    	//Acumulados generales del subtotal
		$pdf->Row(array('SUBTOTAL:|Negrita', 
						'$'.number_format($intAcumGralSubtotalMO,2),
						'$'.number_format($intAcumGralSubtotalSR,2),
						'$'.number_format($intAcumGralSubtotalTF,2),
						'$'.number_format($intAcumGralSubtotalOtros,2),
						'$'.number_format($intAcumGralSubtotalGS,2)), 
					    $arrAlineacionTotales, 'ClippedCell');

		//Acumulados generales del importe de IVA
		$pdf->Row(array('IVA:|Negrita', 
						'$'.number_format($intAcumGralIvaMO,2),
						'$'.number_format($intAcumGralIvaSR,2),
						'$'.number_format($intAcumGralIvaTF,2),
						'$'.number_format($intAcumGralIvaOtros,2),
						'$'.number_format($intAcumGralIvaGS,2)), 
					    $arrAlineacionTotales, 'ClippedCell');

		//Acumulados generales del importe de IEPS
		$pdf->Row(array('IEPS:|Negrita', 
						'$'.number_format($intAcumGralIepsMO,2),
						'$'.number_format($intAcumGralIepsSR,2),
						'$'.number_format($intAcumGralIepsTF,2),
						'$'.number_format($intAcumGralIepsOtros,2),
						'$'.number_format($intAcumGralIepsGS,2)), 
					    $arrAlineacionTotales, 'ClippedCell');

		 //Cambiar el volumen de la fuente a bold
		$pdf->strTipoLetraTabla = 'Negrita';
		//Acumulados generales del importe total
		$pdf->Row(array('TOTAL:', 
						'$'.number_format($intAcumGralTotalMO,2),
						'$'.number_format($intAcumGralTotalSR,2),
						'$'.number_format($intAcumGralTotalTF,2),
						'$'.number_format($intAcumGralTotalOtros,2),
						'$'.number_format($intAcumGralTotalGS,2)), 
					    $arrAlineacionTotales, 'ClippedCell');
		//Cambiar el volumen de la letra
		$pdf->strTipoLetraTabla = 'Normal';

		//Ejecutar la salida del reporte
		$pdf->Output('acumulado_mecanico_detalle.pdf','I');	
	}


	/*Método para generar un reporte PDF con el listado general de acumulados por mecánico
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte_general($strSucursales, $strServiciosTipos, $strTituloSucursales, 
									    $strTituloServiciosTipos, $strTituloRangoFechas,
									    $dteFechaInicial, $dteFechaFinal) 
	{

		//Variables que se utilizan para asignar los acumulados de servicios de mano de obra
	    $intAcumGralSubtotalMO = 0;
	    $intAcumGralIvaMO = 0;
	    $intAcumGralIepsMO = 0;
	    $intAcumGralTotalMO = 0;
	    $intAcumGralHorasMO = 0;
	    //Variables que se utilizan para asignar los acumulados de salidas de refacciones
	    $intAcumGralSubtotalSR = 0;
	    $intAcumGralIvaSR = 0;
	    $intAcumGralIepsSR = 0;
	    $intAcumGralTotalSR = 0;
	    //Variables que se utilizan para asignar los acumulados de trabajos foráneos
	    $intAcumGralSubtotalTF = 0;
	    $intAcumGralIvaTF = 0;
	    $intAcumGralIepsTF = 0;
	    $intAcumGralTotalTF = 0;
	    //Variables que se utilizan para asignar los acumulados de otros servicios
	    $intAcumGralSubtotalOtros = 0;
	    $intAcumGralIvaOtros = 0;
	    $intAcumGralIepsOtros = 0;
	    $intAcumGralTotalOtros = 0;
	    //Variables que se utilizan para asignar los acumulados de gastos de servicio
	    $intAcumGralSubtotalGS = 0;
	    $intAcumGralIvaGS = 0;
	    $intAcumGralIepsGS = 0;
	    $intAcumGralTotalGS = 0;
	    //Array que se utiliza para agregar los datos de los mecánicos
		$arrMecanicos = array();

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('MECÁNICO'), 'MANO DE OBRA', 'REFACCIONES', 
								 'TRAB. FOR.', 'OTROS', 'KMS.', 'HORAS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(70, 20, 20, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'R', 'R', 'R', 'R', 'R', 'R');
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R', 'R', 'R', 'R', 'R');

		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  utf8_decode('REPORTE DETALLADO DE MECÁNICOS ').$strTituloRangoFechas;
		//Asignar el valor de la línea dos del título
		$pdf->strLinea2 = utf8_decode('SUCURSALES: '.trim($strTituloSucursales));
		//Asignar el valor de la línea tres del título
		$pdf->strLinea3 = utf8_decode('TIPOS DE SERVICIOS: '.trim($strTituloServiciosTipos));


		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Establecer el color de línea
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Asignar objeto con los acumulados de los mecánicos en el rango de fechas
		$otdAcumulados = $this->get_acumulados_mecanicos($dteFechaInicial, $dteFechaFinal, $strSucursales, 
									   					 $strServiciosTipos);

		//Asignar array con los datos de los mecánicos
		$arrMecanicos = $otdAcumulados['rows'];
		//Asignar acumulados
		//Acumulados de servicios de mano de obra
		$intAcumGralSubtotalMO = $otdAcumulados['acumulado_gralSubtotalMO'];
	    $intAcumGralIvaMO = $otdAcumulados['acumulado_gralIvaMO'];
	    $intAcumGralIepsMO = $otdAcumulados['acumulado_gralIepsMO'];
	    $intAcumGralTotalMO = $otdAcumulados['acumulado_gralTotalMO'];
	    $intAcumGralHorasMO = $otdAcumulados['acumulado_gralHorasMO'];
	    //Acumulados de salidas de refacciones
	    $intAcumGralSubtotalSR = $otdAcumulados['acumulado_gralSubtotalSR'];
	    $intAcumGralIvaSR = $otdAcumulados['acumulado_gralIvaSR'];
	    $intAcumGralIepsSR = $otdAcumulados['acumulado_gralIepsSR'];
	    $intAcumGralTotalSR = $otdAcumulados['acumulado_gralTotalSR'];
	    //Acumulados de trabajos foráneos
	    $intAcumGralSubtotalTF = $otdAcumulados['acumulado_gralSubtotalTF'];
	    $intAcumGralIvaTF = $otdAcumulados['acumulado_gralIvaTF'];
	    $intAcumGralIepsTF = $otdAcumulados['acumulado_gralIepsTF'];
	    $intAcumGralTotalTF = $otdAcumulados['acumulado_gralTotalTF'];
	    //Acumulados de otros servicios
	    $intAcumGralSubtotalOtros = $otdAcumulados['acumulado_gralSubtotalOtros'];
	    $intAcumGralIvaOtros = $otdAcumulados['acumulado_gralIvaOtros'];
	    $intAcumGralIepsOtros = $otdAcumulados['acumulado_gralIepsOtros'];
	    $intAcumGralTotalOtros = $otdAcumulados['acumulado_gralTotalOtros'];
	    //Acumulados de gastos de servicio
	    $intAcumGralSubtotalGS = $otdAcumulados['acumulado_gralSubtotalGS'];
	    $intAcumGralIvaGS = $otdAcumulados['acumulado_gralIvaGS'];
	    $intAcumGralIepsGS = $otdAcumulados['acumulado_gralIepsGS'];
	    $intAcumGralTotalGS = $otdAcumulados['acumulado_gralTotalGS'];

	   	//Si hay información de los mecánicos
		if($arrMecanicos)
		{
			//Recorremos el arreglo 
	        foreach ($arrMecanicos as $arrDet) 
	        {
	        	//Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
			    $pdf->Row(array(utf8_decode($arrDet['mecanico']), 
			    				'$'.number_format($arrDet['subtotal_MO'],2),
			    				'$'.number_format($arrDet['subtotal_SR'],2),
			    				'$'.number_format($arrDet['subtotal_TF'],2),
			    				'$'.number_format($arrDet['subtotal_Otros'],2),
			    				'$'.number_format($arrDet['subtotal_GS'],2),
			    				number_format($arrDet['horas_MO'],2)), 
			    			    $pdf->arrAlineacion, 'ClippedCell');

	        }//Cierre de foreach 

		}//Cierre de verificación de información 

		//------------------------------------------------------------------------------------------------------------------------
        //---------- RESUMEN
        //------------------------------------------------------------------------------------------------------------------------
		//Dibuja una línea para separar el total
    	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());

    	//Acumulados generales del subtotal
		$pdf->Row(array('SUBTOTAL:|Negrita', 
						'$'.number_format($intAcumGralSubtotalMO,2),
						'$'.number_format($intAcumGralSubtotalSR,2),
						'$'.number_format($intAcumGralSubtotalTF,2),
						'$'.number_format($intAcumGralSubtotalOtros,2),
						'$'.number_format($intAcumGralSubtotalGS,2),
						 number_format($intAcumGralHorasMO,2)), 
					    $arrAlineacionTotales, 'ClippedCell');

		//Acumulados generales del importe de IVA
		$pdf->Row(array('IVA:|Negrita', 
						'$'.number_format($intAcumGralIvaMO,2),
						'$'.number_format($intAcumGralIvaSR,2),
						'$'.number_format($intAcumGralIvaTF,2),
						'$'.number_format($intAcumGralIvaOtros,2),
						'$'.number_format($intAcumGralIvaGS,2)), 
					    $arrAlineacionTotales, 'ClippedCell');

		//Acumulados generales del importe de IEPS
		$pdf->Row(array('IEPS:|Negrita', 
						'$'.number_format($intAcumGralIepsMO,2),
						'$'.number_format($intAcumGralIepsSR,2),
						'$'.number_format($intAcumGralIepsTF,2),
						'$'.number_format($intAcumGralIepsOtros,2),
						'$'.number_format($intAcumGralIepsGS,2)), 
					    $arrAlineacionTotales, 'ClippedCell');

		 //Cambiar el volumen de la fuente a bold
		$pdf->strTipoLetraTabla = 'Negrita';
		//Acumulados generales del importe total
		$pdf->Row(array('TOTAL:', 
						'$'.number_format($intAcumGralTotalMO,2),
						'$'.number_format($intAcumGralTotalSR,2),
						'$'.number_format($intAcumGralTotalTF,2),
						'$'.number_format($intAcumGralTotalOtros,2),
						'$'.number_format($intAcumGralTotalGS,2)), 
					    $arrAlineacionTotales, 'ClippedCell');
		//Cambiar el volumen de la letra
		$pdf->strTipoLetraTabla = 'Normal';

		//Ejecutar la salida del reporte
		$pdf->Output('acumulado_general_mecanicos.pdf','I');	

	}


	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strSucursales = $this->input->post('strSucursales');
		$strServiciosTipos = $this->input->post('strServiciosTipos');
		$intMecanicoID = $this->input->post('intMecanicoID');

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

		//Buscar el nombre de las sucursales que han sido seleccionadas y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 2
	    $strTituloSucursales = '';
	    $arrSucursalesID = explode('|', $strSucursales);
	    //Hacer recorrido para obtener el id de las sucursales
	    foreach ($arrSucursalesID as &$intSucursalID) 
	    {		    
		    //Seleccionar los datos de la sucursal
			$otdSucursal = $this->sucursales->buscar($intSucursalID);
			//Concatenamos el nombre de la sucursal a la variable de impresión
			$strTituloSucursales .= $otdSucursal->nombre.', ';
		}

		//Quitar último elemento de la cadena (,)
		$strTituloSucursales = substr($strTituloSucursales, 0, -2);

		//Buscar el nombre de los tipos de servicios que han sido seleccionados y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 3
	    $strTituloServiciosTipos = '';
	    $arrServiciosTiposID = explode('|', $strServiciosTipos);
	    //Hacer recorrido para obtener el id de los tipos de servicios
	    foreach ($arrServiciosTiposID as &$intServicioTipoID) 
	    {		    
		    //Seleccionar los datos del tipo de servicio
			$otdServicioTipo = $this->tipos->buscar($intServicioTipoID);
			//Concatenamos la descripción del tipo de servicio a la variable de impresión
			$strTituloServiciosTipos .= $otdServicioTipo->descripcion.', ';
		}

		//Quitar último elemento de la cadena (,)
		$strTituloServiciosTipos = substr($strTituloServiciosTipos, 0, -2);


		//Si existe id del mecánico
		if($intMecanicoID > 0)
		{
			
			//Hacer un llamado a la función para generar un archivo XLS con el listado de movimientos (detallado) de un mecánico
			$this->get_xls_mecanico($strSucursales, $strServiciosTipos, $strTituloSucursales, 
								    $strTituloServiciosTipos, $strTituloRangoFechas,
								    $dteFechaInicial, $dteFechaFinal, 
								    $intMecanicoID);
		}
		else
		{
			//Hacer un llamado a la función para generar un archivo XLS con el listado general de acumulados por mecánico
			$this->get_xls_general($strSucursales, $strServiciosTipos, $strTituloSucursales, 
								   $strTituloServiciosTipos, $strTituloRangoFechas,
								   $dteFechaInicial, $dteFechaFinal);
		}
	}


    //Método para generar un archivo XLS con el listado de movimientos (detallado) de un mecánico
	public function get_xls_mecanico($strSucursales, $strServiciosTipos, $strTituloSucursales, 
								    $strTituloServiciosTipos, $strTituloRangoFechas,
								    $dteFechaInicial, $dteFechaFinal, $intMecanicoID) 
	{
		
		//Array que se utiliza para agregar los datos de las ordenes de reparación
		$arrOrdenesReparacion = array();
		//Variables que se utilizan para asignar los acumulados de servicios de mano de obra
	    $intAcumGralSubtotalMO = 0;
	    $intAcumGralIvaMO = 0;
	    $intAcumGralIepsMO = 0;
	    $intAcumGralTotalMO = 0;
	    $intAcumGralHorasMO = 0;
	    //Variables que se utilizan para asignar los acumulados de salidas de refacciones
	    $intAcumGralSubtotalSR = 0;
	    $intAcumGralIvaSR = 0;
	    $intAcumGralIepsSR = 0;
	    $intAcumGralTotalSR = 0;
	    //Variables que se utilizan para asignar los acumulados de trabajos foráneos
	    $intAcumGralSubtotalTF = 0;
	    $intAcumGralIvaTF = 0;
	    $intAcumGralIepsTF = 0;
	    $intAcumGralTotalTF = 0;
	    //Variables que se utilizan para asignar los acumulados de otros servicios
	    $intAcumGralSubtotalOtros = 0;
	    $intAcumGralIvaOtros = 0;
	    $intAcumGralIepsOtros = 0;
	    $intAcumGralTotalOtros = 0;
	    //Variables que se utilizan para asignar los acumulados de gastos de servicio
	    $intAcumGralSubtotalGS = 0;
	    $intAcumGralIvaGS = 0;
	    $intAcumGralIepsGS = 0;
	    $intAcumGralTotalGS = 0;
		//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 12;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 13;
        $intFilaInicial = 13;

	   //Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'REPORTE INDIVIDUAL DE MECÁNICOS '.$strTituloRangoFechas)
			     ->setCellValue('A8', 'SUCURSALES: '.$strTituloSucursales)
			     ->setCellValue('A9', 'TIPOS DE SERVICIOS: '.$strTituloServiciosTipos);

		//Si existe id del mecánico
		if($intMecanicoID > 0)
		{   
			//Seleccionar los datos del mecánico que coincide con el id
			$otdMecanico =  $this->mecanicos->buscar($intMecanicoID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A10', 'MECÁNICO: '.$otdMecanico->empleado);
		}


		//Se agregan las columnas de la segunda cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('C'.$intPosEncabezados, 'PAG.')
        		 ->setCellValue('D'.$intPosEncabezados, 'CLIENTE')
        		 ->setCellValue('E'.$intPosEncabezados, 'TIPO DE SERVICIO')
        		 ->setCellValue('F'.$intPosEncabezados, 'MANO DE OBRA')
        		 ->setCellValue('G'.$intPosEncabezados, 'REFACCIONES')
        		 ->setCellValue('H'.$intPosEncabezados, 'TRABAJOS FORÁNEOS')
        		 ->setCellValue('I'.$intPosEncabezados, 'OTROS')
        		 ->setCellValue('J'.$intPosEncabezados, 'KMS.');

        //Definir estilos de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE,
    													'color' => array('rgb' => 'ffffff')));


        $arrStyleFuenteColumnasPrinc = array('font' => array('bold' => TRUE,
    													     'color' => array('rgb' => '000000')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la izquierda el contenido de la celda
        $arrStyleAlignmentLeft = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));
        //Combinar las siguientes celdas
       	$objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A8:D8');

       	$objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A9:D9');

       	$objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A10:D10');

       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A8:D8')
        		 ->applyFromArray($arrStyleBold);

        $objExcel->getActiveSheet()
        		 ->getStyle('A9:D9')
        		 ->applyFromArray($arrStyleBold);

        $objExcel->getActiveSheet()
        		 ->getStyle('A10:D10')
        		 ->applyFromArray($arrStyleBold);

        //Preferencias de color de texto de la celda
        $objExcel->getActiveSheet()
			    ->getStyle('A9:D9')
			    ->applyFromArray($arrStyleFuenteColumnasPrinc);

	    $objExcel->getActiveSheet()
			    ->getStyle('A10:D10')
			    ->applyFromArray($arrStyleFuenteColumnasPrinc);


	    //Cambiar alineación de las siguientes celdas
    	$objExcel->getActiveSheet()
            	 ->getStyle('A9:D9')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentLeft);

        $objExcel->getActiveSheet()
            	 ->getStyle('A10:D10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentLeft);


        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A12:J12')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda
      	$objExcel->getActiveSheet()
    			 ->getStyle('A12:J12')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A12:J12')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        
        //Asignar objeto con los acumulados de los mecánicos en el rango de fechas
		$otdAcumulados = $this->get_acumulados_mecanicos($dteFechaInicial, $dteFechaFinal, $strSucursales, 
									   					 $strServiciosTipos, $intMecanicoID);
		//Asignar array con los datos de las ordenes de reparación
		$arrOrdenesReparacion = $otdAcumulados['rows'];
	    //Asignar acumulados
		//Acumulados de servicios de mano de obra
		$intAcumGralSubtotalMO = $otdAcumulados['acumulado_gralSubtotalMO'];
	    $intAcumGralIvaMO = $otdAcumulados['acumulado_gralIvaMO'];
	    $intAcumGralIepsMO = $otdAcumulados['acumulado_gralIepsMO'];
	    $intAcumGralTotalMO = $otdAcumulados['acumulado_gralTotalMO'];
	    $intAcumGralHorasMO = $otdAcumulados['acumulado_gralHorasMO'];
	    //Acumulados de salidas de refacciones
	    $intAcumGralSubtotalSR = $otdAcumulados['acumulado_gralSubtotalSR'];
	    $intAcumGralIvaSR = $otdAcumulados['acumulado_gralIvaSR'];
	    $intAcumGralIepsSR = $otdAcumulados['acumulado_gralIepsSR'];
	    $intAcumGralTotalSR = $otdAcumulados['acumulado_gralTotalSR'];
	    //Acumulados de trabajos foráneos
	    $intAcumGralSubtotalTF = $otdAcumulados['acumulado_gralSubtotalTF'];
	    $intAcumGralIvaTF = $otdAcumulados['acumulado_gralIvaTF'];
	    $intAcumGralIepsTF = $otdAcumulados['acumulado_gralIepsTF'];
	    $intAcumGralTotalTF = $otdAcumulados['acumulado_gralTotalTF'];
	    //Acumulados de otros servicios
	    $intAcumGralSubtotalOtros = $otdAcumulados['acumulado_gralSubtotalOtros'];
	    $intAcumGralIvaOtros = $otdAcumulados['acumulado_gralIvaOtros'];
	    $intAcumGralIepsOtros = $otdAcumulados['acumulado_gralIepsOtros'];
	    $intAcumGralTotalOtros = $otdAcumulados['acumulado_gralTotalOtros'];
	    //Acumulados de gastos de servicio
	    $intAcumGralSubtotalGS = $otdAcumulados['acumulado_gralSubtotalGS'];
	    $intAcumGralIvaGS = $otdAcumulados['acumulado_gralIvaGS'];
	    $intAcumGralIepsGS = $otdAcumulados['acumulado_gralIepsGS'];
	    $intAcumGralTotalGS = $otdAcumulados['acumulado_gralTotalGS'];

		//Si hay información de las ordenes de reparación
		if($arrOrdenesReparacion)
		{
			//Recorremos el arreglo 
	        foreach ($arrOrdenesReparacion as $arrDet) 
	        {

	        	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
				 		 ->setCellValueExplicit('A'.$intFila, $arrDet['folio'], PHPExcel_Cell_DataType::TYPE_STRING)
		                 ->setCellValue('B'.$intFila, $arrDet['fecha'])
		                 ->setCellValue('C'.$intFila, $arrDet['pagada'])
		                 ->setCellValueExplicit('D'.$intFila, $arrDet['prospecto'], PHPExcel_Cell_DataType::TYPE_STRING)
		                 ->setCellValue('E'.$intFila, $arrDet['servicio_tipo'])
		                 ->setCellValue('F'.$intFila, $arrDet['subtotal_MO'])
		                 ->setCellValue('G'.$intFila, $arrDet['subtotal_SR'])
		                 ->setCellValue('H'.$intFila, $arrDet['subtotal_TF'])
		                 ->setCellValue('I'.$intFila, $arrDet['subtotal_Otros'])
		                 ->setCellValue('J'.$intFila, $arrDet['subtotal_GS']);

		        //Incrementar el indice para escribir los datos del siguiente registro
       		    $intFila++;

	        }//Cierre de foreach 


		}//Cierre de verificación de información


        //Incrementar el indice para escribir los acumulados
        $intFila++;   	 

		
		//------------------------------------------------------------------------------------------------------------------------
        //---------- RESUMEN
        //------------------------------------------------------------------------------------------------------------------------
        //Número de fila donde se va a comenzar a rellenar
	    $intFilaInicialAcum = $intFila;

	    //Acumulados generales del subtotal
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('E'.$intFila, 'SUBTOTAL:')
                 ->setCellValue('F'.$intFila, $intAcumGralSubtotalMO)
                 ->setCellValue('G'.$intFila, $intAcumGralSubtotalSR)
                 ->setCellValue('H'.$intFila, $intAcumGralSubtotalTF)
                 ->setCellValue('I'.$intFila, $intAcumGralSubtotalOtros)
                 ->setCellValue('J'.$intFila, $intAcumGralSubtotalGS);

        //Incrementar el indice para escribir los datos del siguiente acumulado
        $intFila++;

      	//Acumulados generales del importe de IVA
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('E'.$intFila, 'IVA:')
                 ->setCellValue('F'.$intFila, $intAcumGralIvaMO)
                 ->setCellValue('G'.$intFila, $intAcumGralIvaSR)
                 ->setCellValue('H'.$intFila, $intAcumGralIvaTF)
                 ->setCellValue('I'.$intFila, $intAcumGralIvaOtros)
                 ->setCellValue('J'.$intFila, $intAcumGralIvaGS);


        //Incrementar el indice para escribir los datos del siguiente acumulado
        $intFila++;

      	//Acumulados generales del importe de IEPS
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('E'.$intFila, 'IEPS:')
                 ->setCellValue('F'.$intFila, $intAcumGralIepsMO)
                 ->setCellValue('G'.$intFila, $intAcumGralIepsSR)
                 ->setCellValue('H'.$intFila, $intAcumGralIepsTF)
                 ->setCellValue('I'.$intFila, $intAcumGralIepsOtros)
                 ->setCellValue('J'.$intFila, $intAcumGralIepsGS);

        //Incrementar el indice para escribir los datos del siguiente acumulado
        $intFila++;

        //Acumulados generales del importe total
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('E'.$intFila, 'TOTAL:')
                 ->setCellValue('F'.$intFila, $intAcumGralTotalMO)
                 ->setCellValue('G'.$intFila, $intAcumGralTotalSR)
                 ->setCellValue('H'.$intFila, $intAcumGralTotalTF)
                 ->setCellValue('I'.$intFila, $intAcumGralTotalOtros)
                 ->setCellValue('J'.$intFila, $intAcumGralTotalGS);



        //Cambiar contenido de las celdas a formato moneda
        $objExcel->getActiveSheet()
        		 ->getStyle('F'.$intFilaInicial.':'.'J'.$intFila)
        		 ->getNumberFormat()
        		 ->setFormatCode('$#,##0.00');

       	//Cambiar alineación de las siguientes celdas
         $objExcel->getActiveSheet()
            	 ->getStyle('B'.$intFilaInicial.':'.'C'.$intFila)
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        $objExcel->getActiveSheet()
            	 ->getStyle('F'.$intFilaInicial.':'.'J'.$intFila)
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentRight);

        $objExcel->getActiveSheet()
            	 ->getStyle('D'.$intFilaInicialAcum.':'.'J'.$intFila)
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentRight);


        //Cambiar estilo de la celda
        $objExcel->getActiveSheet()
		  		 ->getStyle('E'.$intFilaInicialAcum.':'.'E'.$intFila)
		 		 ->applyFromArray($arrStyleBold);

        $objExcel->getActiveSheet()
		  		 ->getStyle('F'.$intFila.':'.'J'.$intFila)
		 		 ->applyFromArray($arrStyleBold);

        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'acumulado_mecanico_detalle.xls', 'detallado', $intFila);

	}
	

	//Método para generar un archivo XLS con el listado general de acumulados por mecánico
	public function get_xls_general($strSucursales, $strServiciosTipos, $strTituloSucursales, 
								    $strTituloServiciosTipos, $strTituloRangoFechas,
								    $dteFechaInicial, $dteFechaFinal) 
	{
		
		//Array que se utiliza para agregar los datos de los mecánicos
		$arrMecanicos = array();
		//Variables que se utilizan para asignar los acumulados de servicios de mano de obra
	    $intAcumGralSubtotalMO = 0;
	    $intAcumGralIvaMO = 0;
	    $intAcumGralIepsMO = 0;
	    $intAcumGralTotalMO = 0;
	    $intAcumGralHorasMO = 0;
	    //Variables que se utilizan para asignar los acumulados de salidas de refacciones
	    $intAcumGralSubtotalSR = 0;
	    $intAcumGralIvaSR = 0;
	    $intAcumGralIepsSR = 0;
	    $intAcumGralTotalSR = 0;
	    //Variables que se utilizan para asignar los acumulados de trabajos foráneos
	    $intAcumGralSubtotalTF = 0;
	    $intAcumGralIvaTF = 0;
	    $intAcumGralIepsTF = 0;
	    $intAcumGralTotalTF = 0;
	    //Variables que se utilizan para asignar los acumulados de otros servicios
	    $intAcumGralSubtotalOtros = 0;
	    $intAcumGralIvaOtros = 0;
	    $intAcumGralIepsOtros = 0;
	    $intAcumGralTotalOtros = 0;
	    //Variables que se utilizan para asignar los acumulados de gastos de servicio
	    $intAcumGralSubtotalGS = 0;
	    $intAcumGralIvaGS = 0;
	    $intAcumGralIepsGS = 0;
	    $intAcumGralTotalGS = 0;
		//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 11;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 12;
        $intFilaInicial = 12;

	   //Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'REPORTE DETALLADO DE MECÁNICOS '.$strTituloRangoFechas)
			     ->setCellValue('A8', 'SUCURSALES: '.$strTituloSucursales)
			     ->setCellValue('A9', 'TIPOS DE SERVICIOS: '.$strTituloServiciosTipos);


		//Se agregan las columnas de la segunda cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'MECÁNICO')
        		 ->setCellValue('B'.$intPosEncabezados, 'MANO DE OBRA')
        		 ->setCellValue('C'.$intPosEncabezados, 'REFACCIONES')
        		 ->setCellValue('D'.$intPosEncabezados, 'TRABAJOS FORÁNEOS')
        		 ->setCellValue('E'.$intPosEncabezados, 'OTROS')
        		 ->setCellValue('F'.$intPosEncabezados, 'KMS.')
        		 ->setCellValue('G'.$intPosEncabezados, 'HORAS');

        //Definir estilos de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE,
    													'color' => array('rgb' => 'ffffff')));


        $arrStyleFuenteColumnasPrinc = array('font' => array('bold' => TRUE,
    													     'color' => array('rgb' => '000000')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la izquierda el contenido de la celda
        $arrStyleAlignmentLeft = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));
        //Combinar las siguientes celdas
       	$objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A8:D8');

       	$objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A9:D9');

       	$objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A10:D10');

       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A8:D8')
        		 ->applyFromArray($arrStyleBold);

        $objExcel->getActiveSheet()
        		 ->getStyle('A9:D9')
        		 ->applyFromArray($arrStyleBold);

        $objExcel->getActiveSheet()
        		 ->getStyle('A10:D10')
        		 ->applyFromArray($arrStyleBold);

        //Preferencias de color de texto de la celda
        $objExcel->getActiveSheet()
			    ->getStyle('A9:D9')
			    ->applyFromArray($arrStyleFuenteColumnasPrinc);

	    $objExcel->getActiveSheet()
			    ->getStyle('A10:D10')
			    ->applyFromArray($arrStyleFuenteColumnasPrinc);


	    //Cambiar alineación de las siguientes celdas
    	$objExcel->getActiveSheet()
            	 ->getStyle('A9:D9')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentLeft);

        $objExcel->getActiveSheet()
            	 ->getStyle('A10:D10')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentLeft);


        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A11:G11')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda
      	$objExcel->getActiveSheet()
    			 ->getStyle('A11:G11')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A11:G11')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        
        //Asignar objeto con los acumulados de los mecánicos en el rango de fechas
		$otdAcumulados = $this->get_acumulados_mecanicos($dteFechaInicial, $dteFechaFinal, $strSucursales, 
									   					 $strServiciosTipos);
		//Asignar array con los datos de los mecánicos
		$arrMecanicos = $otdAcumulados['rows'];
	    //Asignar acumulados
		//Acumulados de servicios de mano de obra
		$intAcumGralSubtotalMO = $otdAcumulados['acumulado_gralSubtotalMO'];
	    $intAcumGralIvaMO = $otdAcumulados['acumulado_gralIvaMO'];
	    $intAcumGralIepsMO = $otdAcumulados['acumulado_gralIepsMO'];
	    $intAcumGralTotalMO = $otdAcumulados['acumulado_gralTotalMO'];
	    $intAcumGralHorasMO = $otdAcumulados['acumulado_gralHorasMO'];
	    //Acumulados de salidas de refacciones
	    $intAcumGralSubtotalSR = $otdAcumulados['acumulado_gralSubtotalSR'];
	    $intAcumGralIvaSR = $otdAcumulados['acumulado_gralIvaSR'];
	    $intAcumGralIepsSR = $otdAcumulados['acumulado_gralIepsSR'];
	    $intAcumGralTotalSR = $otdAcumulados['acumulado_gralTotalSR'];
	    //Acumulados de trabajos foráneos
	    $intAcumGralSubtotalTF = $otdAcumulados['acumulado_gralSubtotalTF'];
	    $intAcumGralIvaTF = $otdAcumulados['acumulado_gralIvaTF'];
	    $intAcumGralIepsTF = $otdAcumulados['acumulado_gralIepsTF'];
	    $intAcumGralTotalTF = $otdAcumulados['acumulado_gralTotalTF'];
	    //Acumulados de otros servicios
	    $intAcumGralSubtotalOtros = $otdAcumulados['acumulado_gralSubtotalOtros'];
	    $intAcumGralIvaOtros = $otdAcumulados['acumulado_gralIvaOtros'];
	    $intAcumGralIepsOtros = $otdAcumulados['acumulado_gralIepsOtros'];
	    $intAcumGralTotalOtros = $otdAcumulados['acumulado_gralTotalOtros'];
	    //Acumulados de gastos de servicio
	    $intAcumGralSubtotalGS = $otdAcumulados['acumulado_gralSubtotalGS'];
	    $intAcumGralIvaGS = $otdAcumulados['acumulado_gralIvaGS'];
	    $intAcumGralIepsGS = $otdAcumulados['acumulado_gralIepsGS'];
	    $intAcumGralTotalGS = $otdAcumulados['acumulado_gralTotalGS'];

		//Si hay información de los mecánicos
		if($arrMecanicos)
		{
			//Recorremos el arreglo 
	        foreach ($arrMecanicos as $arrDet) 
	        {

	        	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
				 		 ->setCellValueExplicit('A'.$intFila, $arrDet['mecanico'], PHPExcel_Cell_DataType::TYPE_STRING)
		                 ->setCellValue('B'.$intFila, $arrDet['subtotal_MO'])
		                 ->setCellValue('C'.$intFila, $arrDet['subtotal_SR'])
		                 ->setCellValue('D'.$intFila, $arrDet['subtotal_TF'])
		                 ->setCellValue('E'.$intFila, $arrDet['subtotal_Otros'])
		                 ->setCellValue('F'.$intFila, $arrDet['subtotal_GS'])
		                 ->setCellValue('G'.$intFila, $arrDet['horas_MO']);

		        //Incrementar el indice para escribir los datos del siguiente registro
       		    $intFila++;

	        }//Cierre de foreach 


		}//Cierre de verificación de información


        //Incrementar el indice para escribir los acumulados
        $intFila++;   	 

		
		//------------------------------------------------------------------------------------------------------------------------
        //---------- RESUMEN
        //------------------------------------------------------------------------------------------------------------------------
        //Número de fila donde se va a comenzar a rellenar
	    $intFilaInicialAcum = $intFila;

	    //Acumulados generales del subtotal
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$intFila, 'SUBTOTAL:')
                 ->setCellValue('B'.$intFila, $intAcumGralSubtotalMO)
                 ->setCellValue('C'.$intFila, $intAcumGralSubtotalSR)
                 ->setCellValue('D'.$intFila, $intAcumGralSubtotalTF)
                 ->setCellValue('E'.$intFila, $intAcumGralSubtotalOtros)
                 ->setCellValue('F'.$intFila, $intAcumGralSubtotalGS)
                 ->setCellValue('G'.$intFila, $intAcumGralHorasMO);

        //Incrementar el indice para escribir los datos del siguiente acumulado
        $intFila++;

      	//Acumulados generales del importe de IVA
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$intFila, 'IVA:')
                 ->setCellValue('B'.$intFila, $intAcumGralIvaMO)
                 ->setCellValue('C'.$intFila, $intAcumGralIvaSR)
                 ->setCellValue('D'.$intFila, $intAcumGralIvaTF)
                 ->setCellValue('E'.$intFila, $intAcumGralIvaOtros)
                 ->setCellValue('F'.$intFila, $intAcumGralIvaGS);


        //Incrementar el indice para escribir los datos del siguiente acumulado
        $intFila++;

      	//Acumulados generales del importe de IEPS
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$intFila, 'IEPS:')
                 ->setCellValue('B'.$intFila, $intAcumGralIepsMO)
                 ->setCellValue('C'.$intFila, $intAcumGralIepsSR)
                 ->setCellValue('D'.$intFila, $intAcumGralIepsTF)
                 ->setCellValue('E'.$intFila, $intAcumGralIepsOtros)
                 ->setCellValue('F'.$intFila, $intAcumGralIepsGS);

        //Incrementar el indice para escribir los datos del siguiente acumulado
        $intFila++;

        //Acumulados generales del importe total
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('A'.$intFila, 'TOTAL:')
                 ->setCellValue('B'.$intFila, $intAcumGralTotalMO)
                 ->setCellValue('C'.$intFila, $intAcumGralTotalSR)
                 ->setCellValue('D'.$intFila, $intAcumGralTotalTF)
                 ->setCellValue('E'.$intFila, $intAcumGralTotalOtros)
                 ->setCellValue('F'.$intFila, $intAcumGralTotalGS);

        //Cambiar contenido de las celdas a formato moneda
        $objExcel->getActiveSheet()
        		 ->getStyle('B'.$intFilaInicial.':'.'F'.$intFila)
        		 ->getNumberFormat()
        		 ->setFormatCode('$#,##0.00');

        //Cambiar contenido de las celdas a formato númerico de 2 decimales
        $objExcel->getActiveSheet()
        		 ->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)
        		 ->getNumberFormat()
        		 ->setFormatCode('###0.00');

       	//Cambiar alineación de las siguientes celdas
        $objExcel->getActiveSheet()
            	 ->getStyle('B'.$intFilaInicial.':'.'G'.$intFila)
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentRight);

        $objExcel->getActiveSheet()
            	 ->getStyle('A'.$intFilaInicialAcum.':'.'G'.$intFila)
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentRight);


        //Cambiar estilo de la celda
        $objExcel->getActiveSheet()
		  		 ->getStyle('A'.$intFilaInicialAcum.':'.'A'.$intFila)
		 		 ->applyFromArray($arrStyleBold);

        $objExcel->getActiveSheet()
		  		 ->getStyle('B'.$intFila.':'.'F'.$intFila)
		 		 ->applyFromArray($arrStyleBold);
		 		 
        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'acumulado_general_mecanicos.xls', 'acumulado', $intFila);

	}
	

	//Función que se utiliza para regresar acumulados de los mecánicos en el rango de fechas
	public function get_acumulados_mecanicos($dteFechaInicial, $dteFechaFinal, $strSucursales, 
									   		$strServiciosTipos, $intMecanicoBusqID = NULL)
	{

		//Array que se utiliza para enviar datos
		$arrDatos = array('rows' => NULL, 
						  'acumulado_gralSubtotalMO' => '0.00',
						  'acumulado_gralIvaMO' => '0.00',
						  'acumulado_gralIepsMO' => '0.00',
						  'acumulado_gralTotalMO' => '0.00', 
						  'acumulado_gralHorasMO' => '0.00',   
						  'acumulado_gralSubtotalSR' => '0.00',
						  'acumulado_gralIvaSR' => '0.00', 
						  'acumulado_gralIepsSR' => '0.00',
						  'acumulado_gralTotalSR' => '0.00',
						  'acumulado_gralSubtotalTF' => '0.00',
						  'acumulado_gralIvaTF' => '0.00',
						  'acumulado_gralIepsTF' => '0.00',
						  'acumulado_gralTotalTF' => '0.00', 
						  'acumulado_gralSubtotalOtros' => '0.00',
						  'acumulado_gralIvaOtros' => '0.00', 
						  'acumulado_gralIepsOtros' => '0.00',
						  'acumulado_gralTotalOtros' => '0.00', 
						  'acumulado_gralSubtotalGS' => '0.00',
						  'acumulado_gralIvaGS' => '0.00',
						  'acumulado_gralIepsGS' => '0.00',
						  'acumulado_gralTotalGS' => '0.00');

		//Variable que se utiliza pra asignar el id actual del mecánico
	    $intMecanicoIDActual = 0;
	    //Variables que se utilizan para asignar los acumulados de servicios de mano de obra
	    $intAcumGralSubtotalMO = 0;
	    $intAcumGralIvaMO = 0;
	    $intAcumGralIepsMO = 0;
	    $intAcumGralTotalMO = 0;
	    $intAcumGralHorasMO = 0;
	    //Variables que se utilizan para asignar los acumulados de salidas de refacciones
	    $intAcumGralSubtotalSR = 0;
	    $intAcumGralIvaSR = 0;
	    $intAcumGralIepsSR = 0;
	    $intAcumGralTotalSR = 0;
	    //Variables que se utilizan para asignar los acumulados de trabajos foráneos
	    $intAcumGralSubtotalTF = 0;
	    $intAcumGralIvaTF = 0;
	    $intAcumGralIepsTF = 0;
	    $intAcumGralTotalTF = 0;
	    //Variables que se utilizan para asignar los acumulados de otros servicios
	    $intAcumGralSubtotalOtros = 0;
	    $intAcumGralIvaOtros = 0;
	    $intAcumGralIepsOtros = 0;
	    $intAcumGralTotalOtros = 0;
	    //Variables que se utilizan para asignar los acumulados de gastos de servicio
	    $intAcumGralSubtotalGS = 0;
	    $intAcumGralIvaGS = 0;
	    $intAcumGralIepsGS = 0;
	    $intAcumGralTotalGS = 0;
	    //Array que se utiliza para agregar los datos de los mecánicos
        $arrMecanicos = array();
        //Array que se utiliza para agregar los datos de un mecánico
        $arrAuxiliar = array();

        //Seleccionar los datos de las ordenes de reparación que coinciden con el parámetro enviado
		$otdResultado = $this->ordenes->buscar_ordenes_mecanicos($dteFechaInicial, $dteFechaFinal, $strSucursales, 
										  					    $strServiciosTipos, $intMecanicoBusqID);  

		//Si hay información
		if($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Asignar objeto con los detalles de la orden de reparación
				$otdDetalles = $this->get_acumulado_detalles($arrCol->orden_reparacion_id);
				//Acumulados de salidas de refacciones (orden de reparación)
				$intSubtotalSROrden =  $otdDetalles['acumulado_subtotalSR'];
				$intIvaSROrden =  $otdDetalles['acumulado_ivaSR'];
				$intIepsSROrden =  $otdDetalles['acumulado_iepsSR'];
				$intTotalSROrden =  $otdDetalles['acumulado_totalSR'];
				//Acumulados de trabajos foráneos (orden de reparación)
				$intSubtotalTFOrden =  $otdDetalles['acumulado_subtotalTF'];
				$intIvaTFOrden = $otdDetalles['acumulado_ivaTF'];
				$intIepsTFOrden = $otdDetalles['acumulado_iepsTF'];
				$intTotalTFOrden =  $otdDetalles['acumulado_totalTF'];

				//Acumulados de servicios de mano de obra (orden de reparación)
				$intSubtotalMOOrden =  $otdDetalles['acumulado_subtotalMO'];
				$intIvaMOOrden = $otdDetalles['acumulado_ivaMO'];
				$intIepsMOOrden = $otdDetalles['acumulado_iepsMO'];
				$intTotalMOOrden =  $otdDetalles['acumulado_totalMO'];
				$intHorasMOOrden  =  $otdDetalles['acumulado_horasMO'];

				//Acumulados de otros servicios (orden de reparación)
				$intSubtotalOtrosOrden =  $arrCol->Subtotal_Otros;
				$intIvaOtrosOrden =  $arrCol->IVA_Otros;
				$intIepsOtrosOrden =  $arrCol->IEPS_Otros;
				$intTotalOtrosOrden =  $arrCol->Total_Otros;
				//Acumulados de gastos de servicio (orden de reparación)
				$intSubtotalGSOrden =  $arrCol->Subtotal_GastosServicio;
				$intIvaGSOrden =  $arrCol->IVA_GastosServicio;
				$intIepsGSOrden =  0;
				$intTotalGSOrden =  $arrCol->Total_GastosServicio;

				//Si no existe id del mecánico, significa que se van a obtener los datos para el reporte general
                if($intMecanicoBusqID == NULL)
                {
                	//Si el mecánico actual es diferente al anterior
					if ($intMecanicoIDActual != $arrCol->mecanico_id)
					{
						//Si existe id del mecánico actual
						if ($intMecanicoIDActual > 0)
						{
							//Definir valores del array auxiliar de información (para cada mecánico)
							$arrAuxiliar["mecanico"] = $strMecanico;
							$arrAuxiliar["subtotal_MO"] = $intSubtotalMO;
							$arrAuxiliar["horas_MO"] = $intHorasMO;
							$arrAuxiliar["subtotal_SR"] = $intSubtotalSR;
							$arrAuxiliar["subtotal_TF"] = $intSubtotalTF;
							$arrAuxiliar["subtotal_Otros"] = $intSubtotalOtros;
							$arrAuxiliar["subtotal_GS"] = $intSubtotalGS;
			                //Agregar datos al array
			                array_push($arrMecanicos, $arrAuxiliar);

			                //Inicializar variables
			                $intSubtotalMO = 0;
			                $intHorasMO = 0;
			                $intSubtotalSR = 0;
			                $intSubtotalTF = 0;
			                $intSubtotalOtros = 0;
			                $intSubtotalGS = 0;
						}

						//Asignar valores del mecánico
						$intMecanicoIDActual = $arrCol->mecanico_id;
                        $strMecanico = $arrCol->mecanico;
                        $intSubtotalMO = $intSubtotalMOOrden;
                        $intHorasMO = $intHorasMOOrden;
                        $intSubtotalSR = $intSubtotalSROrden;
                        $intSubtotalTF = $intSubtotalTFOrden;
                        $intSubtotalOtros = $intSubtotalOtrosOrden;
                        $intSubtotalGS = $intSubtotalGSOrden;

                        //Incrementar acumulados generales
                        //Acumulados de servicios de mano de obra
					    $intAcumGralSubtotalMO += $intSubtotalMOOrden;
					    $intAcumGralIvaMO += $intIvaMOOrden;
					    $intAcumGralIepsMO += $intIepsMOOrden;
					    $intAcumGralTotalMO += $intTotalMOOrden;
					    $intAcumGralHorasMO += $intHorasMOOrden;
					    //Acumulados de salidas de refacciones
					    $intAcumGralSubtotalSR += $intSubtotalSROrden;
					    $intAcumGralIvaSR += $intIvaSROrden;
					    $intAcumGralIepsSR += $intIepsSROrden;
					    $intAcumGralTotalSR += $intTotalSROrden;
					    //Acumulados de trabajos foráneos
					    $intAcumGralSubtotalTF += $intSubtotalTFOrden;
					    $intAcumGralIvaTF += $intIvaTFOrden;
					    $intAcumGralIepsTF += $intIepsTFOrden;
					    $intAcumGralTotalTF += $intTotalTFOrden;
					    //Acumulados de otros servicios
					    $intAcumGralSubtotalOtros += $intSubtotalOtrosOrden;
					    $intAcumGralIvaOtros += $intIvaOtrosOrden;
					    $intAcumGralIepsOtros += $intIepsOtrosOrden;
					    $intAcumGralTotalOtros += $intTotalOtrosOrden;
					    //Acumulados de gastos de servicio
					    $intAcumGralSubtotalGS += $intSubtotalGSOrden;
					    $intAcumGralIvaGS += $intIvaGSOrden;
					    $intAcumGralIepsGS += $intIepsGSOrden;
					    $intAcumGralTotalGS += $intTotalGSOrden;
					}
					else
					{
						//Incrementar acumulados por mecánico
						$intSubtotalMO += $intSubtotalMOOrden;
                        $intHorasMO += $intHorasMOOrden;
                        $intSubtotalSR += $intSubtotalSROrden;
                        $intSubtotalTF += $intSubtotalTFOrden;
                        $intSubtotalOtros += $intSubtotalOtrosOrden;
                        $intSubtotalGS += $intSubtotalGSOrden;

                        //Incrementar acumulados generales
                        //Acumulados de servicios de mano de obra
					    $intAcumGralSubtotalMO += $intSubtotalMOOrden;
					    $intAcumGralIvaMO += $intIvaMOOrden;
					    $intAcumGralIepsMO += $intIepsMOOrden;
					    $intAcumGralTotalMO += $intTotalMOOrden;
					    $intAcumGralHorasMO += $intHorasMOOrden;
					    //Acumulados de salidas de refacciones
					    $intAcumGralSubtotalSR += $intSubtotalSROrden;
					    $intAcumGralIvaSR += $intIvaSROrden;
					    $intAcumGralIepsSR += $intIepsSROrden;
					    $intAcumGralTotalSR += $intTotalSROrden;
					    //Acumulados de trabajos foráneos
					    $intAcumGralSubtotalTF += $intSubtotalTFOrden;
					    $intAcumGralIvaTF += $intIvaTFOrden;
					    $intAcumGralIepsTF += $intIepsTFOrden;
					    $intAcumGralTotalTF += $intTotalTFOrden;
					    //Acumulados de otros servicios
					    $intAcumGralSubtotalOtros += $intSubtotalOtrosOrden;
					    $intAcumGralIvaOtros += $intIvaOtrosOrden;
					    $intAcumGralIepsOtros += $intIepsOtrosOrden;
					    $intAcumGralTotalOtros += $intTotalOtrosOrden;
					    //Acumulados de gastos de servicio 
					    $intAcumGralSubtotalGS += $intSubtotalGSOrden;
					    $intAcumGralIvaGS += $intIvaGSOrden;
					    $intAcumGralIepsGS += $intIepsGSOrden;
					    $intAcumGralTotalGS += $intTotalGSOrden;

					}
                }
                else //Obtener los datos para el reporte individual
                {

                	//Asignar el id de la factura de servicio
                	$intFacturaServicioID = $arrCol->factura_servicio_id;
                	$strTipoReferencia = $arrCol->tipo_referencia;
                	//Variable que se utiliza para indicar si la factura esta pagada
                	$strFacturaPagada = 'NO';

                	//Si existe el id de la factura
                	if($intFacturaServicioID > 0)
                	{
                		//Seleccionar los importes de la factura (primer posición del arreglo)
						$otdImportes = $this->pagos->buscar_facturas_importes(NULL, $dteFechaFinal, NULL, 
															   				  NULL, NULL, $intFacturaServicioID, 
															   				  $strTipoReferencia)[0];
						
						//Si hay información
						if($otdImportes)
						{
						
							//Si la factura no se encuentra pagada
							if($otdImportes->saldo > 0) 
							{
								$strFacturaPagada = 'NO';

							}
							else
							{
								$strFacturaPagada = 'SI';
							}

						}//Cierre de verificación de información

                	}//Cierre de verificación de la factura



                	//Definir valores del array auxiliar de información de la orden de reparación
					$arrAuxiliar["folio"] = $arrCol->folio;
					$arrAuxiliar["fecha"] = $arrCol->fecha;
					$arrAuxiliar["pagada"] = $strFacturaPagada;
					$arrAuxiliar["prospecto"] = $arrCol->prospecto;
					$arrAuxiliar["servicio_tipo"] = $arrCol->servicio_tipo;
					$arrAuxiliar["subtotal_MO"] = $intSubtotalMOOrden;
					$arrAuxiliar["subtotal_SR"] = $intSubtotalSROrden;
					$arrAuxiliar["subtotal_TF"] = $intSubtotalTFOrden;
					$arrAuxiliar["subtotal_Otros"] = $intSubtotalOtrosOrden;
					$arrAuxiliar["subtotal_GS"] = $intSubtotalGSOrden;
	                //Agregar datos al array
	                array_push($arrMecanicos, $arrAuxiliar);

	                //Incrementar acumulados generales
                    //Acumulados de servicios de mano de obra
				    $intAcumGralSubtotalMO += $intSubtotalMOOrden;
				    $intAcumGralIvaMO += $intIvaMOOrden;
				    $intAcumGralIepsMO += $intIepsMOOrden;
				    $intAcumGralTotalMO += $intTotalMOOrden;
				    $intAcumGralHorasMO += $intHorasMOOrden;
				    //Acumulados de salidas de refacciones
				    $intAcumGralSubtotalSR += $intSubtotalSROrden;
				    $intAcumGralIvaSR += $intIvaSROrden;
				    $intAcumGralIepsSR += $intIepsSROrden;
				    $intAcumGralTotalSR += $intTotalSROrden;
				    //Acumulados de trabajos foráneos
				    $intAcumGralSubtotalTF += $intSubtotalTFOrden;
				    $intAcumGralIvaTF += $intIvaTFOrden;
				    $intAcumGralIepsTF += $intIepsTFOrden;
				    $intAcumGralTotalTF += $intTotalTFOrden;
				    //Acumulados de otros servicios
				    $intAcumGralSubtotalOtros += $intSubtotalOtrosOrden;
				    $intAcumGralIvaOtros += $intIvaOtrosOrden;
				    $intAcumGralIepsOtros += $intIepsOtrosOrden;
				    $intAcumGralTotalOtros += $intTotalOtrosOrden;
				    //Acumulados de gastos de servicio
				    $intAcumGralSubtotalGS += $intSubtotalGSOrden;
				    $intAcumGralIvaGS += $intIvaGSOrden;
				    $intAcumGralIepsGS += $intIepsGSOrden;
				    $intAcumGralTotalGS += $intTotalGSOrden;
                }

			}//Cierre de foreach

			//Escribir los acumulados del último mecánico (en caso de que sea el reporte general)
			if ($intMecanicoIDActual > 0 && $intMecanicoBusqID == NULL)
			{
				//Definir valores del array auxiliar de información (para cada mecánico)
				$arrAuxiliar["mecanico"] = $strMecanico;
				$arrAuxiliar["subtotal_MO"] = $intSubtotalMO;
				$arrAuxiliar["horas_MO"] = $intHorasMO;
				$arrAuxiliar["subtotal_SR"] = $intSubtotalSR;
				$arrAuxiliar["subtotal_TF"] = $intSubtotalTF;
				$arrAuxiliar["subtotal_Otros"] = $intSubtotalOtros;
				$arrAuxiliar["subtotal_GS"] = $intSubtotalGS;
                //Agregar datos al array
                array_push($arrMecanicos, $arrAuxiliar);

			}//Cierre de verificación del último mecánico


			//Agregar datos al array
		    $arrDatos['rows'] = $arrMecanicos;
		    $arrDatos['acumulado_gralSubtotalMO'] = $intAcumGralSubtotalMO;
			$arrDatos['acumulado_gralIvaMO'] = $intAcumGralIvaMO;
			$arrDatos['acumulado_gralIepsMO'] = $intAcumGralIepsMO;
			$arrDatos['acumulado_gralTotalMO'] = $intAcumGralTotalMO;
			$arrDatos['acumulado_gralHorasMO'] = $intAcumGralHorasMO;
			$arrDatos['acumulado_gralSubtotalSR'] = $intAcumGralSubtotalSR;
			$arrDatos['acumulado_gralIvaSR'] = $intAcumGralIvaSR;
			$arrDatos['acumulado_gralIepsSR'] = $intAcumGralIepsSR;
			$arrDatos['acumulado_gralTotalSR'] = $intAcumGralTotalSR;
			$arrDatos['acumulado_gralSubtotalTF'] = $intAcumGralSubtotalTF;
			$arrDatos['acumulado_gralIvaTF'] = $intAcumGralIvaTF;
			$arrDatos['acumulado_gralIepsTF'] = $intAcumGralIepsTF;
			$arrDatos['acumulado_gralTotalTF'] = $intAcumGralTotalTF;
			$arrDatos['acumulado_gralSubtotalOtros'] = $intAcumGralSubtotalOtros;
			$arrDatos['acumulado_gralIvaOtros'] = $intAcumGralIvaOtros;
			$arrDatos['acumulado_gralIepsOtros'] = $intAcumGralIepsOtros;
			$arrDatos['acumulado_gralTotalOtros'] = $intAcumGralTotalOtros;
			$arrDatos['acumulado_gralSubtotalGS'] = $intAcumGralSubtotalGS;
			$arrDatos['acumulado_gralIvaGS'] = $intAcumGralIvaGS;
			$arrDatos['acumulado_gralIepsGS'] = $intAcumGralIepsGS;
			$arrDatos['acumulado_gralTotalGS'] = $intAcumGralTotalGS;

		}//Cierre de verificación de ordenes de reparación 

		//Regresar array con los datos de los mecánicos
		return $arrDatos;

	}

	
	//Función que se utiliza para regresar los acumulados de los detalles de una orden de reparación
	public function get_acumulado_detalles($intOrdenReparacionID)
	{
		//Array que se utiliza para enviar datos
		$arrDatos = array('acumulado_subtotalSR' => '0.00',
						  'acumulado_ivaSR' => '0.00',
						  'acumulado_iepsSR' => '0.00',
						  'acumulado_totalSR' => '0.00',
						  'acumulado_subtotalTF' => '0.00',
						  'acumulado_ivaTF' => '0.00',
						  'acumulado_iepsTF' => '0.00',
						  'acumulado_totalTF' => '0.00',
						  'acumulado_subtotalMO' => '0.00',
						  'acumulado_ivaMO' => '0.00',
						  'acumulado_iepsMO' => '0.00',
						  'acumulado_totalMO' => '0.00',
						  'acumulado_horasMO' => '0.00');
       
	    //Variables que se utilizan para asignar los acumulados de salidas de refacciones
	    $intAcumSubtotalSR = 0;
	    $intAcumIvaSR = 0;
	    $intAcumIepsSR = 0;
	    $intAcumTotalSR = 0;
	    //Variables que se utilizan para asignar los acumulados de trabajos foráneos
	    $intAcumSubtotalTF = 0;
	    $intAcumIvaTF= 0;
	    $intAcumIepsTF = 0;
	    $intAcumTotalTF = 0;
	   //Variables que se utilizan para asignar los acumulados de servicios de mano de obra
	    $intAcumSubtotalMO = 0;
	    $intAcumIvaMO= 0;
	    $intAcumIepsMO = 0;
	    $intAcumTotalMO = 0;
	    $intAcumHorasMO = 0;

		//Seleccionar las salidas de refacciones del registro
		$otdSalidasRefacciones = $this->movimientos->buscar_detalles_salida_taller(NULL, NULL, $this->intTipoMovimiento, $intOrdenReparacionID);

		//Verificar si existe información de las salidas de refacciones por taller
		if($otdSalidasRefacciones)
		{

		    //Recorremos el arreglo 
	        foreach ($otdSalidasRefacciones as $arrSal) 
	        {
				//Variables que se utilizan para asignar valores del detalle
				$intCantidadSurtida = $arrSal->cantidad;
				$intCantidadDevolucion = $arrSal->cantidad_devolucion;
	        	$intTasaCuotaIeps = $arrSal->tasa_cuota_ieps;
	        	$intPorcentajeIva = $arrSal->porcentaje_iva;
	        	$intPorcentajeIeps = $arrSal->porcentaje_ieps;
	        	$intPrecioUnitario = $arrSal->precio_unitario;

			    //Variable que se utiliza para asignar el importe de iva
				$intImporteIva = 0;
				//Variable que se utiliza para asignar el importe de ieps
				$intImporteIeps = 0;		
			    //Variable que se utiliza para asignar el subtotal 
				$intSubtotalUnitario = 0;

				//Decrementar cantidad devuelta
				$intCantidadFacturar = $intCantidadSurtida - $intCantidadDevolucion;

				//Calcular subtotal
				$intSubtotalUnitario = $intCantidadFacturar * $intPrecioUnitario;

				//Calcular importe de IVA
				$intImporteIva = $intSubtotalUnitario * $intPorcentajeIva;

				//Si existe id de la tasa de cuota del IEPS
				if($intTasaCuotaIeps > 0)
				{
					//Calcular importe de IEPS
					$intImporteIeps = $intSubtotalUnitario * $intPorcentajeIeps;
				}


				//Calcular importe total
				$intTotal = $intSubtotalUnitario + $intImporteIva + $intImporteIeps;


		    	//Incrementar acumulados por cada registro
				$intAcumSubtotalSR += $intSubtotalUnitario;
				$intAcumIvaSR += $intImporteIva;
				$intAcumIepsSR += $intImporteIeps;
				$intAcumTotalSR += $intTotal;

			}//Cierre de foreach

		}//Cierre de verificación de salidas de refacciones


		//Seleccionar los trabajos foráneos del registro
        $otdTrabajosForaneos = $this->trabajos->buscar_detalles(NULL, $intOrdenReparacionID, 'reporte');

        //Verificar si existe información de los trabajos foráneos 
		if($otdTrabajosForaneos)
		{
			//Recorremos el arreglo 
	        foreach ($otdTrabajosForaneos as $arrTrab) 
	        {
	        	//Variables que se utilizan para asignar valores del detalle
				$intCantidad =  number_format($arrTrab->cantidad, 2, '.', '');
				$intPrecioUnitario = $arrTrab->precio_unitario;
				$intPorcentajeIva = $arrTrab->porcentaje_iva;
			    $intPorcentajeIeps = $arrTrab->porcentaje_ieps;
			    $intTasaCuotaIeps = $arrTrab->tasa_cuota_ieps;
			    $strTipoTasaCuotaIeps = $arrTrab->tipo_ieps;
				$strFactorTasaCuotaIeps = $arrTrab->factor_ieps;
				//Variable que se utiliza para asignar el importe de iva
				$intImporteIva = 0;
				//Variable que se utiliza para asignar el importe de ieps
				$intImporteIeps = 0;		
			    //Variable que se utiliza para asignar el subtotal 
				$intSubtotalUnitario = 0;
				//Variable que se utiliza para asignar el subtotal 
				$intSubtotalUnitario = 0;

				//Calcular subtotal
				$intSubtotalUnitario = $intCantidad * $intPrecioUnitario;

				//Calcular importe de IVA
				$intImporteIva = $intSubtotalUnitario * $intPorcentajeIva;

				//Si existe id de la tasa de cuota del IEPS
				if($intTasaCuotaIeps > 0)
				{
					//Si la tasa de cuota no es de tipo RANGO ni su factor es Cuota
					if($strTipoTasaCuotaIeps !== 'RANGO' && $strFactorTasaCuotaIeps !=='Cuota')
					{
						//Calcular importe de IEPS
						$intImporteIeps = $intSubtotalUnitario * $intPorcentajeIeps;
					}
				}

				//Calcular importe total
				$intTotal = $intSubtotalUnitario + $intImporteIva + $intImporteIeps;


				//Incrementar acumulados por cada registro
				$intAcumSubtotalTF += $intSubtotalUnitario;
				$intAcumIvaTF += $intImporteIva;
				$intAcumIepsTF += $intImporteIeps;
				$intAcumTotalTF += $intTotal;

	        }//Cierre de foreach

		}//Cierre de verificación de trabajos foráneos

		//Seleccionar los servicios del registro
	    $otdServicios = $this->ordenes->buscar_servicios($intOrdenReparacionID, NULL, 'FINALIZADO');
		
		//Verificar si existe información de los servicios de mano de obra
		if($otdServicios)
		{	
			//Recorremos el arreglo 
	        foreach ($otdServicios as $arrServ) 
	        {
	        	//Variable que se utiliza para asignar el importe de iva
				$intImporteIva = 0;
				//Variable que se utiliza para asignar el importe de ieps
				$intImporteIeps = 0;
				//Variable que se utiliza para asignar el subtotal 
				$intSubtotalUnitario = 0;
				//Asignar el porcentaje del IVA
	        	$intPorcentajeIva = $arrServ->porcentaje_iva;
	        	//Asignar el porcentaje del IEPS
	        	$intPorcentajeIeps = $arrServ->porcentaje_ieps;
	        	//Asignar horas de la mano de obra
	        	$intHoras = $arrServ->horas;
	        	//Asignar precio del servicio por mano de obra
	        	$intPrecio = $arrServ->precio;

	        	//Calcular subtotal
	        	$intSubtotalUnitario = $intHoras * $intPrecio;


	        	//Calcular importe de IVA
				$intImporteIva = $intSubtotalUnitario * $intPorcentajeIva;

				//Si existe porcentaje de IEPS
				if($intPorcentajeIeps != '')
				{
					//Calcular importe de IEPS
					$intImporteIeps = $intSubtotalUnitario * $intPorcentajeIeps;
				}

				//Calcular importe total
				$intTotal = $intSubtotalUnitario + $intImporteIva + $intImporteIeps;

        		//Incrementar acumulados por cada registro
				$intAcumSubtotalMO += $intSubtotalUnitario;
				$intAcumIvaMO += $intImporteIva;
				$intAcumIepsMO += $intImporteIeps;
				$intAcumTotalMO += $intTotal;
				$intAcumHorasMO += $intHoras;

	        }//Cierre de foreach

		}//Cierre de verificación de servicios de mano de obra


		
		//Agregar datos al array
		//Acumulados de las salidas de refacciones
	    $arrDatos['acumulado_subtotalSR'] = $intAcumSubtotalSR;
	    $arrDatos['acumulado_ivaSR'] = $intAcumIvaSR;
	    $arrDatos['acumulado_iepsSR'] = $intAcumIepsSR;
	    $arrDatos['acumulado_totalSR'] = $intAcumTotalSR;
		//Acumulados de los trabajos foráneos
	    $arrDatos['acumulado_subtotalTF'] = $intAcumSubtotalTF;
	    $arrDatos['acumulado_ivaTF'] = $intAcumIvaTF;
	    $arrDatos['acumulado_iepsTF'] = $intAcumIepsTF;
	    $arrDatos['acumulado_totalTF'] = $intAcumTotalTF;
	    //Acumulados de los servicios de mano de obra
	    $arrDatos['acumulado_subtotalMO'] = $intAcumSubtotalMO;
	    $arrDatos['acumulado_ivaMO'] = $intAcumIvaMO;
	    $arrDatos['acumulado_iepsMO'] = $intAcumIepsMO;
	    $arrDatos['acumulado_totalMO'] = $intAcumTotalMO;
	    $arrDatos['acumulado_horasMO'] = $intAcumHorasMO;

	    //Regresar array con los detalles de la orden de reparación
		return $arrDatos;
	}
	
}	