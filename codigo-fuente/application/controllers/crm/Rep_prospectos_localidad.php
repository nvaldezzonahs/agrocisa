<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_prospectos_localidad extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('crm/prospectos_model', 'prospectos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('crm/rep_prospectos_localidad', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el listado de los prospectos por localidad 
     *dependiendo del tipo de reporte proporcionado*/
    public function get_reporte() 
    {	
    	//Variables que se utilizan para recuperar los valores de la vista
		$strTipoReporte = $this->input->post('strTipoReporte');
		$intMunicipioID = $this->input->post('intMunicipioID');
		$intEstadoID = $this->input->post('intEstadoID');

   		//Dependiendo del tipo de reporte realizar la búsqueda de datos
		//Seleccionar reporte que coincide con el parámetro enviado
        if($strTipoReporte == 'HECTAREAS')
   		{
   			/*Hacer un llamado a la función para generar un reporte PDF con los tipos de hectáreas 
   			 *de los prospectos por localidad*/
        	$this->get_reporte_hectareas($strTipoReporte, $intMunicipioID, $intEstadoID);
   		}
   		else if($strTipoReporte == 'TERRENO')
   		{
   			/*Hacer un llamado a la función para generar un reporte PDF con los tipos de terrenos 
   			 *de los prospectos por localidad*/
        	$this->get_reporte_terrenos($strTipoReporte, $intMunicipioID, $intEstadoID);
   		}
   		else //Si el tipo de reporte es CULTIVOS O ACTIVIDADES
   		{
   			/*Hacer un llamado a la función para generar un reporte PDF con los cultivos (o actividades) 
   			 *de los prospectos por localidad*/
        	$this->get_reporte_actividades_cultivos($strTipoReporte, $intMunicipioID, $intEstadoID);
   		}
    }

	//Método para generar un reporte PDF con el listado de tipos de hectáreas de los prospectos por localidad
	public function get_reporte_hectareas($strTipoReporte, $intMunicipioID, $intEstadoID) 
	{	            
		
		//Variables que se utilizan para acumular totales
        $intAcumTotalHectareasTemporal = 0; //Total de prospectos con hectárea temporal
        $intAcumTotalHectareasRiego = 0; //Total de prospectos con hectárea de riego
        $intAcumTotalHectareasOtras = 0; //Total de prospectos con otra hectárea
        $intAcumTotalProspectos = 0;  //Total de prospectos
		//Seleccionar los datos de los tipos de hectáreas de los prospectos por localidad
		$otdResultado = $this->get_hectareas_localidad($strTipoReporte, $intMunicipioID, $intEstadoID); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = utf8_decode('LISTADO DE TIPO DE HECTÁREAS DE LOS PROSPECTOS');
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('LOCALIDAD', 'MUNICIPIO', 'ESTADO', 'TEMPORAL', 'RIEGO', 'OTRAS', 'TOTAL');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(50, 30, 30, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'R', 'R', 'R', 'R');
		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(110, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R', 'R', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Establecer el color de línea
	    $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Si hay información
		if($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol["localidad"]),
								utf8_decode($arrCol["municipio"]),
								utf8_decode($arrCol["estado"]),
                                number_format($arrCol["total_hectareas_temporal"], 2),
                				number_format($arrCol["total_hectareas_riego"], 2),
                                number_format($arrCol["total_hectareas_otras"], 2),
                                number_format($arrCol["total_prospectos"], 2)), 
								$pdf->arrAlineacion);
				//Incrementar acumulados
                $intAcumTotalHectareasTemporal += $arrCol["total_hectareas_temporal"];
                $intAcumTotalHectareasRiego += $arrCol["total_hectareas_riego"];
                $intAcumTotalHectareasOtras += $arrCol["total_hectareas_otras"];
                $intAcumTotalProspectos +=  $arrCol["total_prospectos"];
			}
		}
	
		$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
        //Escribir totales
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAnchuraTotales);
	    //Cambiar el volumen de la letra
		$pdf->strTipoLetraTabla = 'Negrita';
		//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
		$pdf->Row(array('TOTALES: ', 
						'$'.number_format($intAcumTotalHectareasTemporal, 2), 
						'$'.number_format($intAcumTotalHectareasRiego, 2), 
						'$'.number_format($intAcumTotalHectareasOtras, 2),
						'$'.number_format($intAcumTotalProspectos, 2)), 
						$arrAlineacionTotales, 'ClippedCell');

        //Ejecutar la salida del reporte
        $pdf->Output('prospectos_localidad_'.$strTipoReporte.'.pdf','I'); 
	}

    //Método para generar un reporte PDF con el listado de tipos de terrenos de los prospectos por localidad
	public function get_reporte_terrenos($strTipoReporte, $intMunicipioID, $intEstadoID) 
	{	            
		//Variables que se utilizan para acumular totales
        $intAcumTotalTerrenoArenoso = 0;  //Total de prospectos con terreno arenoso
        $intAcumTotalTerrenoArcilloso = 0; //Total de prospectos con terreno arcilloso
        $intAcumTotalTerrenoCompacto = 0; //Total de prospectos con terreno compacto
        $intAcumTotalTerrenoPedregoso = 0; //Total de prospectos con terreno pedregoso
        $intAcumTotalTerrenoOtros = 0; //Total de prospectos con otro terreno
        $intAcumTotalProspectos = 0; //Total de prospectos
		//Seleccionar los datos de los tipos de terrenos de los prospectos por localidad
		$otdResultado = $this->get_terrenos_localidad($strTipoReporte, $intMunicipioID, $intEstadoID); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'LISTADO DE TIPO DE TERRENO DE LOS PROSPECTOS';
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('LOCALIDAD', 'MUNICIPIO', 'ESTADO', 'ARENOSO', 'ARCILLOSO', 
							  'COMPACTO', 'PEDREGOSO', 'OTROS', 'TOTAL');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(30, 22, 30, 18, 18, 18, 18, 18, 18);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'R', 'R', 'R', 'R', 'R', 'R');
		//Establece el ancho de las columnas de los totales
		$arrAnchuraTotales = array(82, 18, 18, 18, 18, 18, 18);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R', 'R', 'R', 'R', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Establecer el color de línea
	    $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Si hay información
		if($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol["localidad"]),
								utf8_decode($arrCol["municipio"]),
								utf8_decode($arrCol["estado"]),
                                number_format($arrCol["total_terreno_arenoso"], 2),
                                number_format($arrCol["total_terreno_arcilloso"], 2),
                                number_format($arrCol["total_terreno_compacto"], 2),
                                number_format($arrCol["total_terreno_pedregoso"], 2),
                                number_format($arrCol["total_terreno_otros"], 2),
                                number_format($arrCol["total_prospectos"], 2)),
				                $pdf->arrAlineacion);
                
				//Incrementar acumulados
                $intAcumTotalTerrenoArenoso += $arrCol["total_terreno_arenoso"]; 
                $intAcumTotalTerrenoArcilloso += $arrCol["total_terreno_arcilloso"]; 
                $intAcumTotalTerrenoCompacto += $arrCol["total_terreno_compacto"]; 
                $intAcumTotalTerrenoPedregoso += $arrCol["total_terreno_pedregoso"]; 
                $intAcumTotalTerrenoOtros += $arrCol["total_terreno_otros"]; 
                $intAcumTotalProspectos += $arrCol["total_prospectos"]; 
			}
		}

		$pdf->Line(10, ($pdf->GetY() + 0.4), 200, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la información de los totales
        //Escribir totales
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAnchuraTotales);
	    //Cambiar el volumen de la letra
		$pdf->strTipoLetraTabla = 'Negrita';
		//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
		$pdf->Row(array('TOTALES: ', 
							'$'.number_format($intAcumTotalTerrenoArenoso, 2), 
							'$'.number_format($intAcumTotalTerrenoArcilloso, 2), 
							'$'.number_format($intAcumTotalTerrenoCompacto, 2),
							'$'.number_format($intAcumTotalTerrenoPedregoso, 2),
							'$'.number_format($intAcumTotalTerrenoOtros, 2),
							'$'.number_format($intAcumTotalProspectos, 2)), 
							$arrAlineacionTotales, 'ClippedCell');

        //Ejecutar la salida del reporte
        $pdf->Output('prospectos_localidad_'.$strTipoReporte.'.pdf','I'); 
	}

	/*Método para generar un reporte PDF con el listado de cultivos (o actividades) de los prospectos
	 *por localidad*/
	public function get_reporte_actividades_cultivos($strTipoReporte, $intMunicipioID, $intEstadoID) 
	{
		//Array que se utiliza para asignar el acumulado (total) de los detalles (cultivos o actividades)
        $arrAcumTotalDetalle = array();
        //Variable que se utiliza para acumular totales
        $intAcumTotalProspectos = 0;//Total de los prospectos
		//Seleccionar los datos de los cultivos (o actividades) de los prospectos por localidad
		$otdResultado = $this->get_actividades_cultivos_localidad($strTipoReporte, $intMunicipioID, $intEstadoID); 
		//Seleccionar los datos de los cultivos o actividades activos
        $otdDetalles = $this->prospectos->buscar_actividades_cultivos($strTipoReporte);
        //Variable que se utiliza para asignar el número de cultivos (o actividades) encontrados
        $intNumDetalles = count($otdDetalles);
        //Se crea una instancia de la clase PDF
        $pdf = new PDF('L','mm','legal');//orientación horizontal
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'LISTADO DE '.$strTipoReporte.' DE LOS PROSPECTOS';
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('LOCALIDAD', 'MUNICIPIO', 'ESTADO');
		//Variable que se utiliza para asignar el tamaño de los encabezados de las columnas fijas
        $intTamColFijas = 130;
        //Incrementar el número de detalles para agregar la columna total
        $intNumDetalles++;
        //Variable que se utiliza para asignar el tamaño restante de la hoja 
	    $intTamColDetalles = ((335 - $intTamColFijas) / $intNumDetalles);
        //Establece el ancho de las columnas de cabecera
        $pdf->arrAnchura = array(50, 50, 30);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L');
		//Verificar que exista información de los cultivos o actividades
        if($otdDetalles)//Si hay información.
        {
            //Realizar recorrido para agregar a la cabecera las columnas con las descripciones de los cultivos (o actividades)
            foreach ($otdDetalles as $arrDet) { //Recorremos el arreglo 
                //Asignar datos al array
                $pdf->arrCabecera[] = utf8_decode($arrDet->descripcion);
                $pdf->arrAnchura[] =  $intTamColDetalles;
                $pdf->arrAlineacion[] =  'R';
                //Inicializar acumulado del detalle
                $arrAcumTotalDetalle[$arrDet->id] = 0; 
             }
        }//Cierre de verificación para obtener información de cultivos o actividades
        //Agregar al array la siguiente columna
        //Total de los detalles (cultivos o actividades) por localidad
        $pdf->arrCabecera[] =  'TOTAL'; 
        //Agregar al array el siguiente tamaño
        $pdf->arrAnchura[] =  $intTamColDetalles;//Columna Total
        //Agregar al array las siguientes alineaciones
	    $pdf->arrAlineacion[] = 'R';
		//Agregar la primer pagina
		$pdf->AddPage();
	
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		//Establecer el color de línea
	    $pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Si hay información
		if($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Asignar al array los datos de la localidad
                $arrDatos = array(utf8_decode($arrCol["localidad"]), utf8_decode($arrCol["municipio"]), 
                				  utf8_decode($arrCol["estado"]));
                //Hacer recorrido para agregar al array el total de prospectos por detalle (cultivo o actividad)
                foreach ($otdDetalles as $arrDet) 
                { 
                    //Asignar el total del detalle (cultivo o actividad)
                    $intTotalDetalle = $arrCol["totalDetalle_".$arrDet->id];
                    //Total del detalle (cultivo o actividad)
                    $arrDatos[] = number_format($intTotalDetalle, 2);
                    //Incrementar acumulado del detalle (cultivo o atividad)
                    $arrAcumTotalDetalle[$arrDet->id] += $intTotalDetalle;
                }
                //Total de prospecto
                $arrDatos[] =  number_format($arrCol["total_prospectos"], 2); 
                //Incrementar acumulado de prospectos
                $intAcumTotalProspectos += $arrCol["total_prospectos"];
                //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
                $pdf->Row($arrDatos, $pdf->arrAlineacion);
			}
			
			//Escribir acumulados de los prospectos por detalle (cultivo o actividad)
            //Array que se utiliza para asignar los acumulados
            $arrDatosTotales = array('','','TOTALES:');
            //Hacer recorrido para obtener acumulado por cada detalle (cultivo o actividad)
            foreach ($otdDetalles as $arrDet) 
            { 
                //Acumulado del total del detalle (cultivo o actividad)
                $arrDatosTotales[] = number_format($arrAcumTotalDetalle[$arrDet->id], 2);
            }
            //Acumulado del total de prospectos
            $arrDatosTotales[] =   number_format($intAcumTotalProspectos, 2);

			$pdf->Line(10, ($pdf->GetY() + 0.4), 345, ($pdf->GetY() + 0.4)); //dibuja una linea para separar la 
            //Cambiar el tipo de letra de la tabla
            $pdf->strTipoLetraTabla = 'Negrita';
            //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
            $pdf->Row($arrDatosTotales, $pdf->arrAlineacion);

		}
        //Ejecutar la salida del reporte
        $pdf->Output('prospectos_localidad_'.$strTipoReporte.'.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los prospectos por localidad 
     *dependiendo del tipo de reporte proporcionado*/
    public function get_xls() 
    {	

    	//Variables que se utilizan para recuperar los valores de la vista
		$strTipoReporte = $this->input->post('strTipoReporte');
		$intMunicipioID = $this->input->post('intMunicipioID');
		$intEstadoID = $this->input->post('intEstadoID');

        //Dependiendo del tipo de reporte realizar la búsqueda de datos
		//Seleccionar reporte que coincide con el parámetro enviado
        if($strTipoReporte == 'HECTAREAS')
   		{
   			/*Hacer un llamado a la función para generar un archivo XLS con los tipos de hectáreas 
   			 *de los prospectos por localidad*/
        	$this->get_xls_hectareas($strTipoReporte, $intMunicipioID, $intEstadoID);
   		}
   		else if($strTipoReporte == 'TERRENO')
   		{
   			/*Hacer un llamado a la función para generar un archivo XLS con los tipos de terrenos 
   			 *de los prospectos por localidad*/
        	$this->get_xls_terrenos($strTipoReporte, $intMunicipioID, $intEstadoID);
   		}
   		else //Si el tipo de reporte es CULTIVOS O ACTIVIDADES
   		{
   			/*Hacer un llamado a la función para generar un archivo XLS con los cultivos (o actividades) 
   			 *de los prospectos por localidad*/
        	$this->get_xls_actividades_cultivos($strTipoReporte, $intMunicipioID, $intEstadoID);
   		}
    }

    //Método para generar un archivo XLS con el listado de tipos de hectáreas de los prospectos por localidad
	public function get_xls_hectareas($strTipoReporte, $intMunicipioID, $intEstadoID) 
	{	
		//Variables que se utilizan para acumular totales
        $intAcumTotalHectareasTemporal = 0; //Total de prospectos con hectárea temporal
        $intAcumTotalHectareasRiego = 0; //Total de prospectos con hectárea de riego
        $intAcumTotalHectareasOtras = 0; //Total de prospectos con otra hectárea
        $intAcumTotalProspectos = 0;  //Total de prospectos
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        //Seleccionar los datos de los tipos de hectáreas de los prospectos por localidad
		$otdResultado = $this->get_hectareas_localidad($strTipoReporte, $intMunicipioID, $intEstadoID); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/crm/archivos_excel/prospectos_localidad.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE TIPO DE HECTÁREAS DE LOS PROSPECTOS');
		//Se agrega en el encabezado del archivo las columnas de los tipos de hectáreas
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('D'.$intPosEncabezados, 'TEMPORAL')
                 ->setCellValue('E'.$intPosEncabezados, 'RIEGO')
                 ->setCellValue('F'.$intPosEncabezados, 'OTRAS')
                 ->setCellValue('G'.$intPosEncabezados, 'TOTAL');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font' => array('bold' => TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:G9')
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
               			 ->setCellValue('A'.$intFila, $arrCol["localidad"])
               			 ->setCellValue('B'.$intFila, $arrCol["municipio"])
               			 ->setCellValue('C'.$intFila, $arrCol["estado"])
                         ->setCellValue('D'.$intFila, $arrCol["total_hectareas_temporal"])
                         ->setCellValue('E'.$intFila, $arrCol["total_hectareas_riego"])
                         ->setCellValue('F'.$intFila, $arrCol["total_hectareas_otras"])
                         ->setCellValue('G'.$intFila, $arrCol["total_prospectos"]);
                //Incrementar acumulados
                $intAcumTotalHectareasTemporal += $arrCol["total_hectareas_temporal"];
                $intAcumTotalHectareasRiego += $arrCol["total_hectareas_riego"];
                $intAcumTotalHectareasOtras += $arrCol["total_hectareas_otras"];
                $intAcumTotalProspectos +=  $arrCol["total_prospectos"];
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}
            //Agregar información de los acumulados
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('A'.$intFila, 'TOTAL')
                     ->setCellValue('D'.$intFila, $intAcumTotalHectareasTemporal)
                     ->setCellValue('E'.$intFila, $intAcumTotalHectareasRiego)
                     ->setCellValue('F'.$intFila, $intAcumTotalHectareasOtras)
                     ->setCellValue('G'.$intFila, $intAcumTotalProspectos);
            //Cambiar estilo de las celdas
            $objExcel->getActiveSheet()
        			 ->getStyle('A'.$intFila.':'.'G'.$intFila)
        			 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'prospectos_localidad_'.$strTipoReporte.'.xls', 
        									'prospectos', $intFila);
	}

	//Método para generar un archivo XLS con el listado de tipos de terrenos de los prospectos por localidad
	public function get_xls_terrenos($strTipoReporte, $intMunicipioID, $intEstadoID) 
	{	
		//Variables que se utilizan para acumular totales
        $intAcumTotalTerrenoArenoso = 0;  //Total de prospectos con terreno arenoso
        $intAcumTotalTerrenoArcilloso = 0; //Total de prospectos con terreno arcilloso
        $intAcumTotalTerrenoCompacto = 0; //Total de prospectos con terreno compacto
        $intAcumTotalTerrenoPedregoso = 0; //Total de prospectos con terreno pedregoso
        $intAcumTotalTerrenoOtros = 0; //Total de prospectos con otro terreno
        $intAcumTotalProspectos = 0; //Total de prospectos 
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        //Seleccionar los datos de los tipos de terrenos de los prospectos por localidad
		$otdResultado = $this->get_terrenos_localidad($strTipoReporte, $intMunicipioID, $intEstadoID); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/crm/archivos_excel/prospectos_localidad.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE TIPO DE TERRENO DE LOS PROSPECTOS');
		//Se agrega en el encabezado del archivo las columnas de los tipos de hectáreas
        $objExcel->setActiveSheetIndex(0)
                 ->setCellValue('D'.$intPosEncabezados, 'ARENOSO')
                 ->setCellValue('E'.$intPosEncabezados, 'ARCILLOSO')
                 ->setCellValue('F'.$intPosEncabezados, 'COMPACTO')
                 ->setCellValue('G'.$intPosEncabezados, 'PEDREGOSO')
                 ->setCellValue('H'.$intPosEncabezados, 'OTROS')
                 ->setCellValue('I'.$intPosEncabezados, 'TOTAL');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font' => array('bold' => TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:I9')
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
		                 ->setCellValue('A'.$intFila, $arrCol["localidad"])
		                 ->setCellValue('B'.$intFila, $arrCol["municipio"])
		                 ->setCellValue('C'.$intFila, $arrCol["estado"])
		                 ->setCellValue('D'.$intFila, $arrCol["total_terreno_arenoso"])
		                 ->setCellValue('E'.$intFila, $arrCol["total_terreno_arcilloso"])
		                 ->setCellValue('F'.$intFila, $arrCol["total_terreno_compacto"])
		                 ->setCellValue('G'.$intFila, $arrCol["total_terreno_pedregoso"])
		                 ->setCellValue('H'.$intFila, $arrCol["total_terreno_otros"])
		                 ->setCellValue('I'.$intFila, $arrCol["total_prospectos"]);
                //Incrementar acumulados
                $intAcumTotalTerrenoArenoso += $arrCol["total_terreno_arenoso"]; 
                $intAcumTotalTerrenoArcilloso += $arrCol["total_terreno_arcilloso"]; 
                $intAcumTotalTerrenoCompacto += $arrCol["total_terreno_compacto"]; 
                $intAcumTotalTerrenoPedregoso += $arrCol["total_terreno_pedregoso"]; 
                $intAcumTotalTerrenoOtros += $arrCol["total_terreno_otros"]; 
                $intAcumTotalProspectos += $arrCol["total_prospectos"]; 
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}
            //Agregar información de los acumulados
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('A'.$intFila, 'TOTAL')
                     ->setCellValue('D'.$intFila, $intAcumTotalTerrenoArenoso)
                     ->setCellValue('E'.$intFila, $intAcumTotalTerrenoArcilloso)
                     ->setCellValue('F'.$intFila, $intAcumTotalTerrenoCompacto)
                     ->setCellValue('G'.$intFila, $intAcumTotalTerrenoPedregoso)
                     ->setCellValue('H'.$intFila, $intAcumTotalTerrenoOtros)
                     ->setCellValue('I'.$intFila, $intAcumTotalProspectos);
            //Cambiar estilo de las celdas
            $objExcel->getActiveSheet()
        			 ->getStyle('A'.$intFila.':'.'I'.$intFila)
        			 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'prospectos_localidad_'.$strTipoReporte.'.xls', 
        								   'prospectos', $intFila);
	}

	/*Método para generar un archivo XLS con el listado de cultivos (o actividades) de los prospectos
	 *por localidad*/
	public function get_xls_actividades_cultivos($strTipoReporte, $intMunicipioID, $intEstadoID) 
	{	
		//Array que se utiliza para asignar los totales de detalles del movimiento
        $arrAcumTotalDetalle = array();
        //Variable que se utiliza para acumular totales
        $intAcumTotalProspectos = 0;//Total de los prospectos
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        //Variable que se utiliza para asignar el número de columna donde se empezaran a escribir los cultivos (o actividades)
        $intIndColDet = 4;
        $intIndColE = $intIndColDet;//Empezar en la columna 2-B (Encabezados de los detalles de prospectos)
		//Seleccionar los datos de los cultivos (o actividades) de los prospectos por localidad
        $otdResultado = $this->get_actividades_cultivos_localidad($strTipoReporte, $intMunicipioID, $intEstadoID);
        //Seleccionar los datos de los cultivos o actividades activos
        $otdDetalles = $this->prospectos->buscar_actividades_cultivos($strTipoReporte);
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/crm/archivos_excel/prospectos_localidad.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE '.$strTipoReporte.' DE LOS PROSPECTOS');
			     
		//Verificar que exista información de los cultivos o actividades
        if($otdDetalles)//Si hay información.
        {
            //Hacer recorrido para agregar a la cabecera las columnas con las descripciones de los cultivos (o actividades)
            foreach ($otdDetalles as $arrDet) 
            {  
                //Se agrega en el encabezado del archivo las columnas de los detalles (cultivos o actividades)
                $objExcel->setActiveSheetIndex(0)
                         ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados,$arrDet->descripcion);
                //Inicializar acumulado del detalle
                $arrAcumTotalDetalle[$arrDet->id] = 0;
                //Incrementar indice de la columna
                $intIndColE++; 
            }
        }//Cierre de verificación para obtener información de cultivos o actividades
        //Se agrega en el encabezado del archivo las columnas de los totales
        $objExcel->setActiveSheetIndex(0)
                    ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados, 'TOTAL');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font' => array('bold' => TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
        		 ->getStyle('A9:'.$this->ARR_COLUMNAS[$intIndColE].'9')
        		 ->getFill()
        		 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Inicializar indice de la columna para empezar en la columna 2-B (total de prospectos por detalle (cultivo o actividad))
                $intIndColTotalDetalle = $intIndColDet;
				//Agregar información del registro
			    $objExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$intFila, $arrCol["localidad"])
                         ->setCellValue('B'.$intFila, $arrCol["municipio"])
                         ->setCellValue('C'.$intFila, $arrCol["estado"]);

                //Hacer recorrido para escribir el total de prospectos por detalle (cultivo o actividad)
                foreach ($otdDetalles as $arrDet) 
                {
                    //Asignar el total del detalle (cultivo o actividad)
                    $intTotalDetalle = $arrCol["totalDetalle_".$arrDet->id];
                    //Agregar Información del total del detalle (cultivo o actividad)
                    $objExcel->setActiveSheetIndex(0)
                             ->setCellValue($this->ARR_COLUMNAS[$intIndColTotalDetalle].$intFila, $intTotalDetalle);
                    //Incrementar acumulado por detalle (cultivo o actividad)
                    $arrAcumTotalDetalle[$arrDet->id] += $intTotalDetalle;
                    //Incrementar indice de la columna
                    $intIndColTotalDetalle++;       
                }

			    //Incrementar acumulado de prospectos
                $intAcumTotalProspectos += $arrCol["total_prospectos"];
                //Agregar Información del total de prospectos
                $objExcel->setActiveSheetIndex(0)
                         ->setCellValue($this->ARR_COLUMNAS[$intIndColTotalDetalle].$intFila, $arrCol["total_prospectos"]);
                //Incrementar el indice para escribir los datos del siguiente registro                 
                $intFila++;
			}
			//Inicializar indice de la columna para empezar en la columna 2-B (acumulado de prospectos por detalle (cultivo o actividad))
            $intIndColAcumTotalDetalle = $intIndColDet;
            //Agregar información de los totales
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('A'.$intFila, 'TOTAL');
            //Hacer recorrido para obtener acumulado por cada detalle (cultivo o actividad)
            foreach ($otdDetalles as $arrDet) 
            { 
                //Agregar Información del acumulado del detalle (cultivo o actividad)
                $objExcel->setActiveSheetIndex(0)
                         ->setCellValue($this->ARR_COLUMNAS[$intIndColAcumTotalDetalle].$intFila, $arrAcumTotalDetalle[$arrDet->id]);

                //Incrementar indice de la columna
                $intIndColAcumTotalDetalle++;
            }
            //Agregar información del acumulado de prospectos
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue($this->ARR_COLUMNAS[$intIndColAcumTotalDetalle].$intFila, $intAcumTotalProspectos);
            //Cambiar estilo de las celdas
            $objExcel->getActiveSheet()
            		 ->getStyle('A'.$intFila.':'.$this->ARR_COLUMNAS[$intIndColAcumTotalDetalle+1].$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'prospectos_localidad_'.$strTipoReporte.'.xls', 
        								   'prospectos', $intFila);
	}


	//Método para regresar las hectáreas por localidad de los prospectos en la BD 
	public function get_hectareas_localidad($strTipoReporte, $intMunicipioID, $intEstadoID)
	{
		//Variable que se utiliza como contador de prospectos con hectárea temporal
		$intTotalHectTemporal = 0;
		//Variable que se utiliza como contador de prospectos con hectárea de riego
		$intTotalHectRiego = 0;
		//Variable que se utiliza como contador de prospectos con  otra hectárea
		$intTotalHectOtras = 0;
		//Variable que se utiliza como contador de todos los prospectos de la localidad
		$intTotalProspectos = 0;
		//Array que se utiliza para agregar los prospectos con hectáreas en las localidades
	    $arrDatos = array();
	    //Array que se utiliza para agregar los datos de una localidad
	    $arrAuxiliar = array();
	    //Seleccionar los datos de las localidades
		$otdLocalidades = $this->prospectos->buscar_localidades($intMunicipioID, $intEstadoID);
		//Seleccionar los datos de los prospectos activos (con o sin hectáreas)
		$otdProspectos = $this->prospectos->buscar_prospectos_localidad($strTipoReporte, $intMunicipioID, $intEstadoID);
		//Si hay información
		if($otdLocalidades)
		{
			//Hacer recorrido para obtener la información de las localidades
			foreach ($otdLocalidades as $arrLocalidad) 
			{
				//Inicializar variables
				$intTotalHectTemporal = 0;
				$intTotalHectRiego = 0;
				$intTotalHectOtras = 0;
				$intTotalProspectos = 0;
				//Asignar id de la localidad
				$intLocalidadID =  $arrLocalidad->localidad_id;
				//Hacer recorrido para obtener la información de los prospectos
				foreach ($otdProspectos as $arrProspecto) 
				{
					//Si la localidad tiene prospectos
					if($intLocalidadID == $arrProspecto->localidad_id)
					{	
						//Si el prospecto tiene hectárea temporal
						if($arrProspecto->hectareas_temporal != '')
	       	    		{
	       	    			//Incrementar contador de la hectárea
	       	    			$intTotalHectTemporal++;
	       	    			//Incrementar contador por cada prospecto con hectárea temporal
	       	    			$intTotalProspectos++;
	       	    		}
	       	    		
	       	    		//Si el prospecto tiene hectárea de riego
	       	    		if($arrProspecto->hectareas_riego != '' )
	       	    		{
	       	    			//Incrementar contador de la hectárea
	       	    			$intTotalHectRiego++;
	       	    			//Incrementar contador por cada prospecto con hectárea de riego
	       	    			$intTotalProspectos++;
	       	    		}
	       	    		
	       	    		//Si el prospecto tiene  otra hectárea
	       	    		if($arrProspecto->hectareas_otras != '')
	       	    		{
	       	    			//Incrementar contador de la hectárea
	       	    			$intTotalHectOtras++;
	       	    			//Incrementar contador por cada prospecto con otra hectárea
	       	    			$intTotalProspectos++;
	       	    		}
					}
		    	}
				//Definir valores del array auxiliar de información (para cada localidad)
	           	$arrAuxiliar["localidad"] = $arrLocalidad->localidad;
	           	$arrAuxiliar["municipio"] = $arrLocalidad->municipio;
	           	$arrAuxiliar["estado"] = $arrLocalidad->estado;
	           	$arrAuxiliar["total_hectareas_temporal"] = $intTotalHectTemporal;
	           	$arrAuxiliar["total_hectareas_riego"] = $intTotalHectRiego;
	           	$arrAuxiliar["total_hectareas_otras"] = $intTotalHectOtras;
	           	$arrAuxiliar["total_prospectos"] = 	$intTotalProspectos;
	           	//Asignar datos al array resultado
	            array_push($arrDatos,$arrAuxiliar); 
			}//Cierre de foreach localidades

		}//Cierre de verificación para obtener información de localidades
		return $arrDatos;
	}

	//Método para regresar las terrenos por localidad de los prospectos en la BD
	public function get_terrenos_localidad($strTipoReporte, $intMunicipioID, $intEstadoID)
	{
		//Variable que se utiliza como contador de prospectos con terreno arenoso
		$intTotalTerrenoArenoso = 0;
		//Variable que se utiliza como contador de prospectos con terreno arcilloso
		$intTotalTerrenoArcilloso = 0;
		//Variable que se utiliza como contador de prospectos con terreno compacto
		$intTotalTerrenoCompacto = 0;
		//Variable que se utiliza como contador de prospectos con terreno pedregoso
		$intTotalTerrenoPedregoso = 0;
		//Variable que se utiliza como contador de prospectos con otro terreno
		$intTotalTerrenoOtros = 0;
		//Variable que se utiliza como contador de todos los prospectos de la localidad
		$intTotalProspectos = 0;
		//Array que se utiliza para agregar los prospectos con terrenos en las localidades
        $arrDatos = array();
        //Array que se utiliza para agregar los datos de una localidad
        $arrAuxiliar = array();
        //Seleccionar los datos de las localidades
		$otdLocalidades = $this->prospectos->buscar_localidades($intMunicipioID, $intEstadoID);
		//Seleccionar los datos de los prospectos activos (con o sin terrenos)
   		$otdProspectos = $this->prospectos->buscar_prospectos_localidad($strTipoReporte, $intMunicipioID, $intEstadoID);
   		//Si hay información
   		if($otdLocalidades)
		{
			//Hacer recorrido para obtener la información de las localidades
			foreach ($otdLocalidades as $arrLocalidad) 
			{
				//Inicializar variables
				$intTotalTerrenoArenoso = 0;
				$intTotalTerrenoArcilloso = 0;
				$intTotalTerrenoCompacto = 0;
				$intTotalTerrenoPedregoso = 0;
				$intTotalTerrenoOtros = 0;
				$intTotalProspectos = 0;
				//Asignar id de la localidad
				$intLocalidadID =  $arrLocalidad->localidad_id;
				//Hacer recorrido para obtener la información de los prospectos
				foreach ($otdProspectos as $arrProspecto) 
				{
					//Si la localidad tiene prospectos
					if($intLocalidadID == $arrProspecto->localidad_id)
					{	
						//Si el prospecto tiene terreno arenoso
						if($arrProspecto->terreno_arenoso != '')
	       	    		{
	       	    			//Incrementar contador del terreno
	       	    			$intTotalTerrenoArenoso++;
	       	    			//Incrementar contador por cada prospecto con terreno arenoso
	       	    			$intTotalProspectos++;
	       	    		}
	       	    		
	       	    		//Si el prospecto tiene terreno arcilloso
	       	    		if($arrProspecto->terreno_arcilloso != '' )
	       	    		{
	       	    			//Incrementar contador del terreno
	       	    			$intTotalTerrenoArcilloso++;
	       	    			//Incrementar contador por cada prospecto con terreno arcilloso
	       	    			$intTotalProspectos++;
	       	    		}
	       	    		
	       	    		//Si el prospecto tiene terreno compacto
	       	    		if($arrProspecto->terreno_compacto != '')
	       	    		{
	       	    			//Incrementar contador del terreno
	       	    			$intTotalTerrenoCompacto++;
	       	    			//Incrementar contador por cada prospecto con terreno compacto
	       	    			$intTotalProspectos++;
	       	    		}

	       	    		//Si el prospecto tiene terreno pedregoso
	       	    		if($arrProspecto->terreno_pedregoso != '')
	       	    		{
	       	    			//Incrementar contador del terreno
	       	    			$intTotalTerrenoPedregoso++;
	       	    			//Incrementar contador por cada prospecto con terreno pedregoso
	       	    			$intTotalProspectos++;
	       	    		}

	       	    		//Si el prospecto tiene otro terreno
	       	    		if($arrProspecto->terreno_otros != '')
	       	    		{
	       	    			//Incrementar contador del terreno
	       	    			$intTotalTerrenoOtros++;
	       	    			//Incrementar contador por cada prospecto con  otro terreno
	       	    			$intTotalProspectos++;
	       	    		}
					}
   	    		}
				//Definir valores del array auxiliar de información (para cada localidad)
               	$arrAuxiliar["localidad"] = $arrLocalidad->localidad;
               	$arrAuxiliar["municipio"] = $arrLocalidad->municipio;
               	$arrAuxiliar["estado"] = $arrLocalidad->estado;
               	$arrAuxiliar["total_terreno_arenoso"] = $intTotalTerrenoArenoso;
               	$arrAuxiliar["total_terreno_arcilloso"] = $intTotalTerrenoArcilloso;
               	$arrAuxiliar["total_terreno_compacto"] = $intTotalTerrenoCompacto;
               	$arrAuxiliar["total_terreno_pedregoso"] = $intTotalTerrenoPedregoso;
                $arrAuxiliar["total_terreno_otros"] = $intTotalTerrenoOtros;
               	$arrAuxiliar["total_prospectos"] = $intTotalProspectos;
               	//Asignar datos al array resultado
                array_push($arrDatos,$arrAuxiliar); 
			}//Cierre de foreach localidades
		}//Cierre de verificación para obtener información de localidades
		return $arrDatos;
	}

	//Método para regresar los cultivos (o actividades) por localidad de los prospecto en la BD
	public function get_actividades_cultivos_localidad($strTipoReporte, $intMunicipioID, $intEstadoID)
	{
		//Array que se utiliza para agregar los prospectos con detalles (cultivos o actividades) en las localidades
        $arrDatos = array();
        //Array que se utiliza para agregar los datos de una localidad
        $arrAuxiliar = array();
        //Seleccionar los datos de las localidades
		$otdLocalidades = $this->prospectos->buscar_localidades($intMunicipioID, $intEstadoID);
		//Seleccionar los datos de los cultivos o actividades activos
		$otdDetalles = $this->prospectos->buscar_actividades_cultivos($strTipoReporte);
		//Seleccionar los datos de los prospectos con detalles (cultivos o actividades)
   		$otdProspectos = $this->prospectos->buscar_prospectos_localidad($strTipoReporte, $intMunicipioID, $intEstadoID);
   		//Si hay información
   		if($otdLocalidades)
		{
			//Hacer recorrido para obtener la información de las localidades
			foreach ($otdLocalidades as $arrLocalidad) 
			{
				//Inicializar variables
				$intTotalProspectos = 0;
				//Asignar id de la localidad
				$intLocalidadID =  $arrLocalidad->localidad_id;
				//Definir valores del array auxiliar de información (para cada localidad)
               	$arrAuxiliar["localidad"] = $arrLocalidad->localidad;
               	$arrAuxiliar["municipio"] = $arrLocalidad->municipio;
               	$arrAuxiliar["estado"] = $arrLocalidad->estado;
               	//Hacer recorrido para inicializar contador de los detalles (cultivos o actividades)
				foreach ($otdDetalles as $arrDet) 
				{
					//Inicializar contador del detalle (cultivo o actividad)
					$arrAuxiliar["totalDetalle_".$arrDet->id] = 0;
				}
				
				//Hacer recorrido para obtener la información de los prospectos
				foreach ($otdProspectos as $arrProspecto) 
				{
					//Si la localidad tiene prospectos
					if($intLocalidadID == $arrProspecto->localidad_id)
					{	
						//Incrementar contador del detalle (cultivo o actividad)
						$arrAuxiliar["totalDetalle_".$arrProspecto->id]+=1;
						//Incrementar contador por cada prospecto con detalle (cultivo o actividad)
	       	    		$intTotalProspectos++;
					}
   	    		}
               	$arrAuxiliar["total_prospectos"] = $intTotalProspectos;
               	//Asignar datos al array resultado
                array_push($arrDatos,$arrAuxiliar); 
			}//Cierre de foreach localidades
		}//Cierre de verificación para obtener información de localidades
		return $arrDatos;
	}
}