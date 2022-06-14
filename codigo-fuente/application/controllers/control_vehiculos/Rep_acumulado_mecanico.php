<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_acumulado_mecanico extends MY_Controller {
	
	//Variable para identificar el tipo de movimiento
	var $intTipoMovimiento = SALIDA_REFACCIONES_INTERNAS;
	var $intTipoMovimientoDev = ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER; 

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('control_vehiculos/rep_acumulado_mecanico_model', 'acumulado');
		//Cargamos el modelo de trabajos foráneos internos
		$this->load->model('control_vehiculos/trabajos_foraneos_internos_model', 'trabajos');
		//Cargamos el modelo de Mecanicos
		$this->load->model('control_vehiculos/mecanicos_model', 'mecanicos');
		$this->load->model('administracion/empresas_model', 'empresas');
		$this->load->model('administracion/sucursales_model', 'sucursales');
		//Cargamos el modelo de movimientos de refacciones internas
		$this->load->model('control_vehiculos/movimientos_refacciones_internas_model', 'movimientos');

	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('control_vehiculos/rep_acumulado_mecanico', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}



	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intMecanicoID, $intVehiculoID) 
	{
		
		if( (int)$intMecanicoID == 0) {
			$this->get_detallado_mecanicos($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intMecanicoID, $intVehiculoID);
		}
		else{
			$this->get_reporte_individual_mecanico($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intMecanicoID, $intVehiculoID);
		}            
		
	}

	/*Método para generar un reporte DETALLADO DE MECÁNICOS en PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionada*/
	public function get_detallado_mecanicos($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intMecanicoID, $intVehiculoID){

		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para asignar título de la fecha
		$strTituloFecha = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;

		//Seleccionar los datos correspondientes a los mecánicos que coinciden con la fecha
		$result = $this->acumulado->ordenes_servicios_internos($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intMecanicoID, $intVehiculoID);
		$otdResultado = $result->result();
		//Seleccionamos el nombre de la sucursal que coincide con el criterio de busqueda
		$otdSucursal = $this->sucursales->buscar($intSucursalID);

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFecha = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C').' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  utf8_decode('REPORTE DETALLADO DE MECÁNICOS ').$strTituloFecha;
		
		if($otdSucursal == NULL){
			$strNombreSucursal = 'TODAS';
		}
		else{
			$strNombreSucursal = $otdSucursal->nombre;
		}
		$pdf->strLinea2 = 'SUCURSAL: '.utf8_decode($strNombreSucursal);
		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('MECÁNICO'), utf8_decode('MANO DE OBRA'), 
						     'REFACCIONES', 'TRABAJOS FORANEOS', 'HORAS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(70, 30, 30, 30, 30);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'C', 'C', 'C');
		//Establece la alineación de las celdas de la tabla
		$arrAlineacionRegistros = array('L', 'R', 'R', 'R', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);

		//Si hay información
		if ($otdResultado)
		{

			//Variables globales acumuladoras de cantidades
			$intAcumTotalManoObra = 0;
			$intAcumTotalRefacciones = 0;
			$intAcumTotalTrabajosForaneos = 0;
			$intAcumTotalHoras = 0;


			//Variable de control
			$intMecanicoIDAnterior = 0;
			//Variable para acumular el número de horas para un mecánico
			$intHoras = 0;
			//Variable que se utiliza para asignar el acumulado del subtotal de importe en REFACCIONES
			$intAcumSubtotal = 0;
			//Variable para acumular el importe en TRABAJOS FORANEOS
			$intTrabajosForaneos = 0;

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdResultado as $arrCol)
			{

	   			$intMecanicoID = (int)$arrCol->mecanico_id;

				if( ($intMecanicoIDAnterior != $intMecanicoID) && $intMecanicoIDAnterior != 0)
	   			{

	   				//Seleccionar el nombre del Mecánico para impresion
	   				$otdMecanico = $this->mecanicos->buscar($intMecanicoIDAnterior);

	   				//Agregar datos al array de preguntas
	    			$pdf->Row(array(utf8_decode($otdMecanico->empleado),
									'$'.number_format(0, 2), 
									'$'.number_format($intAcumSubtotal, 2),  
									'$'.number_format($intTrabajosForaneos, 2), 
									 number_format($intHoras, 2)), 
									$pdf->arrAlineacion, 'ClippedCell');
					
					$intAcumTotalRefacciones += $intAcumSubtotal;
					$intAcumTotalTrabajosForaneos += $intTrabajosForaneos;
					$intAcumTotalHoras += $intHoras;


					//***********************************************************************************************
		   			//Inicializar las variables acumuladoras
		   			//*********************************************************************************************** 
					$intHoras = 0;
					$intTrabajosForaneos = 0;
					$intAcumSubtotal = 0;	

	   			}

	   			//***********************************************************************************************
	   			//Asignación de valores
	   			//***********************************************************************************************
	   			$intHoras += $arrCol->horas;
	   			$intMecanicoIDAnterior = $intMecanicoID;

				//----------------------------------------------------------------------Buscar MANO DE OBRA (N/A)

				//-----------------------------------------------------------------------------Buscar REFACCIONES
				//Seleccionar las salidas de refacción correspondientes a una orden de reparación interna
				$salidas = $this->movimientos->buscar_salidas($this->intTipoMovimiento, $arrCol->orden_reparacion_interna_id);
			    //Si se encuentran salidas de refacciones internas para la orden de reparación seleccionada
			    if($salidas){

			    	//Variable que se utiliza para contar el número de detalles
					$intContDetMov = 0;

			    	foreach($salidas as $arrDet){

			    		$intMovimientoRefaccionesInternasID = $arrDet->movimiento_refacciones_internas_id;
			    		$intOrdenReparacionInternaID = $arrDet->orden_reparacion_interna_id;
			    		$salidas_devoluciones = $this->movimientos->buscar_salidas_con_devoluciones($this->intTipoMovimiento, $this->intTipoMovimientoDev, $intMovimientoRefaccionesInternasID, $intOrdenReparacionInternaID);

			    		//En caso de que una salida tenga devoluciones
			    		if($salidas_devoluciones){

			    			foreach($salidas_devoluciones as $arrDet2){

			    				//Si el estatus del registro es ACTIVO
								if($arrDet2->estatus == 'ACTIVO')
								{
									//Variables que se utilizan para asignar valores del detalle
									$intCantidad = $arrDet2->cantidad;
									$intPrecioUnitario = $arrDet2->precio_unitario;
									//Calcular subtotal
					            	$intSubTotalUnitario =  $intCantidad * $intPrecioUnitario;

									//Incrementar acumulados
									//Preguntamos si es un movimiento de tipo SALIDA
									if($arrDet2->sort_col2 == 1){
						            	$intAcumSubtotal += $intSubTotalUnitario;
									}
									else{
						            	$intAcumSubtotal -= $intSubTotalUnitario;
									}
						       	}

			    			}
			    		}
			    	}
			    }

				//------------------------------------------------------------------Buscar TRABAJOS FORANEOS 
				$result = $this->acumulado->buscar_trabajos_foraneos($arrCol->orden_reparacion_interna_id);
				$otdTrabajosForaneos = $result->result();

				foreach ($otdTrabajosForaneos as $arrTrabajoForaneo)
				{
					$intTrabajosForaneos += $arrTrabajoForaneo->importe_trabajo_foraneo;
				}		
				
			}	

			//Agregar datos del último mecánico
	   		if($intMecanicoIDAnterior != 0)
			{

				$intAcumTotalRefacciones += $intAcumSubtotal;
				$intAcumTotalTrabajosForaneos += $intTrabajosForaneos;
				$intAcumTotalHoras += $intHoras;

				//Seleccionar el nombre del Mecánico para impresion
	   			$otdMecanico = $this->mecanicos->buscar($intMecanicoIDAnterior);

				//Agregar información del registro al reporte
    			$pdf->Row(array(utf8_decode($otdMecanico->empleado),
								'$'.number_format(0, 2), 
								'$'.number_format($intAcumSubtotal, 2),  
								'$'.number_format($intTrabajosForaneos, 2), 
								 number_format($intHoras, 2)), 
    						$pdf->arrAlineacion, 'ClippedCell');
			}	

			//Dibuja una línea para posteriormente imprimir las cantidades totales acumuladas
	    	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
	    	//Agregar información del registro al reporte
    		$pdf->Row(array(utf8_decode('TOTAL'), 
    						'$'.number_format($intAcumTotalManoObra, 2), 
    						'$'.number_format($intAcumTotalRefacciones, 2), 
    						'$'.number_format($intAcumTotalTrabajosForaneos, 2), 
    						 number_format($intAcumTotalHoras, 2)), 
							$arrAlineacionRegistros,'ClippedCell');

		}
		

		//Ejecutar la salida del reporte
		$pdf->Output('reporte_detallado_mecanicos.pdf','I');

	}

	/*Método para generar un reporte INDIVIDUAL POR MECÁNICO en PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionada*/
	public function get_reporte_individual_mecanico($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intMecanicoID, $intVehiculoID){

		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Variable que se utiliza para asignar título de la fecha
		$strTituloFecha = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;

		//Seleccionar los datos correspondientes a los mecánicos que coinciden con la fecha
		$result = $this->acumulado->ordenes_servicios_internos_mecanico($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intMecanicoID, $intVehiculoID);
		$otdResultado = $result->result();
		
		//Seleccionamos el nombre de la sucursal que coincide con el criterio de busqueda
		$otdSucursal = $this->sucursales->buscar($intSucursalID);

		//Seleccionamos el nombre del mecánico que coincide con el criterio de busqueda
		$otdMecanico = $this->mecanicos->buscar($intMecanicoID);

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFecha = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C').' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  utf8_decode('REPORTE INDIVIDUAL DE MECÁNICOS ').$strTituloFecha;
		
		if($otdSucursal == NULL){
			$strNombreSucursal = 'TODAS';
		}
		else{
			$strNombreSucursal = $otdSucursal->nombre;
		}
		$pdf->strLinea2 = 'SUCURSAL: '.utf8_decode($strNombreSucursal);

		if($otdMecanico != NULL){
			$pdf->strLinea3 = 'MECANICO: '.utf8_decode($otdMecanico->empleado);
		}

		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array('FOLIO', 'FECHA', utf8_decode('VEHÍCULO'), 
							 utf8_decode('MANO DE OBRA'), 'REFACCIONES', 'TRABAJOS FORANEOS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(20, 20, 60, 30, 30, 30);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'C', 'L', 'C', 'C', 'C');
		//Establece la alineación de las celdas de la tabla
		$arrAlineacionRegistros = array('L', 'C', 'L', 'R', 'R', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		$pdf->Ln(); //Deja un salto de línea
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);

		//Si hay información
		if ($otdResultado)
		{
			//Variables globales acumuladoras de cantidades
			$intAcumTotalManoObra = 0;
			$intAcumTotalRefacciones = 0;
			$intAcumTotalTrabajosForaneos = 0;

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdResultado as $arrCol)
			{	

				//Variable que se utiliza para el importe de MANO DE OBRA
				$intManoObra = 0;
				//Variable que se utiliza para asignar el acumulado del subtotal de importe en REFACCIONES
				$intAcumSubtotal = 0;
				//Variable para acumular el importe en TRABAJOS FORANEOS
				$intTrabajosForaneos = 0;

				//------------------------------------------------------------------Buscar MANO DE OBRA
				// N/A 

				//------------------------------------------------------------------Buscar REFACCIONES
				//Seleccionar las salidas de refacción correspondientes a una orden de reparación interna
				$salidas = $this->movimientos->buscar_salidas($this->intTipoMovimiento, $arrCol->orden_reparacion_interna_id);
			    //Si se encuentran salidas de refacciones internas para la orden de reparación seleccionada
			    if($salidas){

			    	//Variable que se utiliza para contar el número de detalles
					$intContDetMov = 0;

			    	foreach($salidas as $arrDet){

			    		$intMovimientoRefaccionesInternasID = $arrDet->movimiento_refacciones_internas_id;
			    		$intOrdenReparacionInternaID = $arrDet->orden_reparacion_interna_id;
			    		$salidas_devoluciones = $this->movimientos->buscar_salidas_con_devoluciones($this->intTipoMovimiento, $this->intTipoMovimientoDev, $intMovimientoRefaccionesInternasID, $intOrdenReparacionInternaID);

			    		//En caso de que una salida tenga devoluciones
			    		if($salidas_devoluciones){

			    			foreach($salidas_devoluciones as $arrDet2){

			    				//Si el estatus del registro es ACTIVO
								if($arrDet2->estatus == 'ACTIVO')
								{
									//Variables que se utilizan para asignar valores del detalle
									$intCantidad = $arrDet2->cantidad;
									$intPrecioUnitario = $arrDet2->precio_unitario;
									//Calcular subtotal
					            	$intSubTotalUnitario =  $intCantidad * $intPrecioUnitario;

									//Incrementar acumulados
									//Preguntamos si es un movimiento de tipo SALIDA
									if($arrDet2->sort_col2 == 1){
						            	$intAcumSubtotal += $intSubTotalUnitario;
									}
									else{
						            	$intAcumSubtotal -= $intSubTotalUnitario;
									}
						       	}

			    			}
			    		}
			    	}
			    }

				//------------------------------------------------------------------Buscar TRABAJOS FORANEOS
				$result = $this->acumulado->buscar_trabajos_foraneos($arrCol->orden_reparacion_interna_id);
				$otdTrabajosForaneos = $result->result();

				foreach ($otdTrabajosForaneos as $arrTrabajoForaneo)
				{
					$intTrabajosForaneos += $arrTrabajoForaneo->importe_trabajo_foraneo;
				} 

		    	//Agregar información del registro al reporte
	    		$pdf->Row(array($arrCol->folio, $arrCol->fecha, 
	    						utf8_decode($arrCol->vehiculo), 
	    						'$'.number_format($intManoObra, 2), 
	    						'$'.number_format($intAcumSubtotal, 2), 
	    						'$'.number_format($intTrabajosForaneos, 2)), 
								$arrAlineacionRegistros, 'ClippedCell');

	    		//----------------------------------------------------------------- ACUMULACIÓN DE TOTALES
	    		$intAcumTotalManoObra += $intManoObra;
	    		$intAcumTotalRefacciones += $intAcumSubtotal;
	    		$intAcumTotalTrabajosForaneos += $intTrabajosForaneos;

			}

			//Dibuja una línea para posteriormente imprimir las cantidades totales acumuladas
	    	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
	    	//Agregar información del registro al reporte
    		$pdf->Row(array(utf8_decode('TOTAL'), '', '', 
    						'$'.number_format($intAcumTotalManoObra, 2), 
    						'$'.number_format($intAcumTotalRefacciones, 2), 
    						'$'.number_format($intAcumTotalTrabajosForaneos, 2)), 
							$arrAlineacionRegistros, 'ClippedCell');
			
		}
		
		//Ejecutar la salida del reporte
		$pdf->Output('reporte_individual_mecanico.pdf','I');

	}

	/*Método para generar un archivo XLS con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intRefaccionID) 
	{	
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 10;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 11;
        $intFilaInicial = 11;
        
        //Seleccionar los datos del registro que coincide con la fecha
		$result = $this->existencia->consultar($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intRefaccionID);
		$otdResultado = $result->result();
		
		//Si existe rango de fechas
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal  != '0000-00-00')
		{
			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
			$strTituloRangoFechas = 'DEL '.$this->get_fecha_formato_letra($dteFechaInicial, 'C'). ' AL '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
		}

     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)->setCellValue('A7', 'EXISTENCIA DE REFACCIONES INTERNAS '.$strTituloRangoFechas);

		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'SUCURSAL')
        		 ->setCellValue('B'.$intPosEncabezados, 'DESCRIPCIÓN')
        		 ->setCellValue('C'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('D'.$intPosEncabezados, 'KARDEX')
        		 ->setCellValue('E'.$intPosEncabezados, 'COSTO')
        		 ->setCellValue('F'.$intPosEncabezados, 'IMPORTE');

        //Definir estilos de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE, 'color' => array('rgb' => 'ffffff')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Combinar las siguientes celdas
       	$objExcel->setActiveSheetIndex(0)->mergeCells('A8:D8');
       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()->getStyle('A8:D8')->applyFromArray($arrStyleBold);

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()->getStyle('A10:F10')->getFill()->applyFromArray($arrStyleColumnas);
        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()->getStyle('A10:F10')->applyFromArray($arrStyleFuenteColumnas);	 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()->getStyle('A10:F10')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);

		//Si hay información
		if ($otdResultado)
		{
			
			//Array que se utiliza para agregar los datos de los registros 
		    $arrRegistros = array();

			$intRefaccionID = 0;
			$numExistencia = 0;
			$numCosto = 0;
			$strSucursal = '';
			$strDescripcion = '';
			$strFecha = '';

			//Recorremos el arreglo para obtener la información de los movimientos
			foreach ($otdResultado as $arrCol)
			{

				//Si la refacción cambió
   				if($intRefaccionID != $arrCol->refaccion_interna_id && $intRefaccionID != 0)
   				{	
   					
   					//Impresión de variables
					$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValue('A'. $intFila, $strSucursal)
	                         ->setCellValue('B'.$intFila, $strDescripcion)
	                         ->setCellValue('C'.$intFila, $strFecha)
	                         ->setCellValue('D'.$intFila, $numExistencia)
	                         ->setCellValue('E'.$intFila, $numCosto)
	                         ->setCellValue('F'.$intFila, $numExistencia * $numCosto);

					//Reinicializar variables
					$numExistencia = $arrCol->inicial_existencia;
					$numCosto = $arrCol->inicial_costo;

					$intFila++;

   				}

   				if($arrCol->tipo_movimiento < 11){
					
					$numCosto = (($numExistencia * $numCosto) + ($arrCol->cantidad * $arrCol->precio_unitario));
	                $numExistencia += $arrCol->cantidad;
	                if ($numExistencia <> 0){
	                    $numCosto = $numCosto / $numExistencia;
	                }

				}
				else{
					
					$numCosto = (($numExistencia * $numCosto) - ($arrCol->cantidad * $arrCol->precio_unitario));
					$numExistencia -= $arrCol->cantidad;
					if ($numExistencia <> 0){
						$numCosto = $numCosto / $numExistencia;
					}

				}

				$intRefaccionID = $arrCol->refaccion_interna_id;
				$strSucursal = $arrCol->sucursal;
				$strDescripcion = $arrCol->descripcion;
				$strFecha = $arrCol->fecha;	
				
				//Incrementar el indice para escribir los datos del siguiente registro
	             
				
			}

			//Agregar datos del último refacción
   			if($intRefaccionID != 0)
			{
				$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValue('A'. $intFila, $strSucursal)
	                         ->setCellValue('B'.$intFila, $strDescripcion)
	                         ->setCellValue('C'.$intFila, $strFecha)
	                         ->setCellValue('D'.$intFila, $numExistencia)
	                         ->setCellValue('E'.$intFila, $numCosto)
	                         ->setCellValue('F'.$intFila, $numExistencia * $numCosto);            
			}

		}
       
		//Dar formato a las columnas de la tabla respecto a alineación y formato
		//Cambiar contenido de las celdas a formato moneda
   		$objExcel->getActiveSheet()
        		 ->getStyle('E'.$intFilaInicial.':'.'F'.$intFila)
        		 ->getNumberFormat()
        		 ->setFormatCode('$#,##0.00');

       	//Cambiar alineación de las siguientes celdas
       	$objExcel->getActiveSheet()
	        	 ->getStyle('C'.$intFilaInicial.':'.'C'.$intFila)
	        	 ->getAlignment()
	        	 ->applyFromArray($arrStyleAlignmentCenter);

       	$objExcel->getActiveSheet()
	        	 ->getStyle('D'.$intFilaInicial.':'.'F'.$intFila)
	        	 ->getAlignment()
	        	 ->applyFromArray($arrStyleAlignmentRight);
        		 
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'existencia.xls', 'existencia', $intFila);
        
	}


}	