<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_prospectos_visitados_madurez extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo
		$this->load->model('crm/prospectos_model', 'prospectos');
		//Cargamos el modelo de módulos
		$this->load->model('crm/modulos_model', 'modulos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('crm/rep_prospectos_visitados_madurez', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el listado de las últimas visitas de los prospectos 
	 *por madurez registradas en la BD, dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{	   
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte = $this->input->post('dteFechaCorte');
		$intModuloID = $this->input->post('intModuloID');
		$strModulo = trim($this->input->post('strModulo'));
		$intVendedorID = $this->input->post('intVendedorID');
		$intLocalidadID = $this->input->post('intLocalidadID');
        //Variable que se utiliza para contar el número de registros
        $intContador=0;
        //Variables que se utilizan para contar las visitas de los prospectos especiales
        //Variable que se utiliza como contador de visitas de la madurez
        $intTotalProspectosEspeciales = 0; 
	     //Variable que se utiliza como contador de visitas  del rango de  0-60 días
		$intTotalR0A60Especiales = 0; 
		//Variable que se utiliza como contador de visitas del rango de 61-90 días
		$intTotalR61A90Especiales = 0; 
		//Variable que se utiliza como contador de visitas del rango de 91-120 días
		$intTotalR91A120Especiales = 0; 
	    //Variable que se utiliza como contador de visitas del rango de 121-150 días
		$intTotalR121A150Especiales = 0;
		//Variable que se utiliza como contador de visitas del rango mayor a 151 días
		$intTotalRMayorA151Especiales = 0;
		//Variable que se utiliza como contador de nuevos prospectos con visitas
		$intTotalNuevosProspectosEspeciales = 0;
		//Variables que se utilizan para acumular totales
		$intAcumTotalProspectos = 0; //Total de visitas de los prospectos
		$intAcumTotalR0A60 = 0; //Total de visitas del rango 0-60 días
		$intAcumTotalR61A90 = 0; //Total de visitas del rango 61-90 días
		$intAcumTotalR91A120 = 0; //Total de visitas del rango 91-120 días
		$intAcumTotalR121A150 = 0;//Total de visitas del rango 121-150 días
		$intAcumTotalRMayorA151 = 0;//Total de visitas del rango  ayor a 151 días
		$intAcumTotalNuevosProspectos = 0; //Total de visitas a nuevos prospectos
		
		//Seleccionar los datos de las últimas visitas de los prospectos por su madurez
		$otdResultado = $this->get_prospectos_visitados_madurez($dteFechaCorte, $intModuloID, $intVendedorID, 
																$intLocalidadID, $strModulo); 
		
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$pdf->strLinea1 = utf8_decode('NÚMERO DE PROSPECTOS VISITADOS  FECHA DE CORTE: '.
									  $this->get_fecha_formato_letra($dteFechaCorte, 'C'));
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('MADUREZ', utf8_decode('NÚMERO'), '0-60', '61-90', '91-120', 
								  '121-150', utf8_decode('MÁS DE 151'), 'NUEVOS');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(50, 20, 20, 20, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'R', 'R', 'R', 'R', 'R', 'R', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		$pdf->SetTextColor(0); //Establecer el color de texto por defecto
		//Establecer el color de fondo para la cabecera
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Si hay información
		if($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Si el contador es igual que cero (primer registro)
            	//asignar totales de los prospectos especiales (y así evitar asignarlos varias veces)
            	if($intContador == 0)
            	{
            		//Asignar totales a las siguientes variables (prospectos especiales) 
				    $intTotalProspectosEspeciales = $arrCol["total_prospectos_especiales"]; 
					$intTotalR0A60Especiales = $arrCol["total_R0A60_especiales"]; 
					$intTotalR61A90Especiales = $arrCol["total_R61A90_especiales"]; 
					$intTotalR91A120Especiales = $arrCol["total_R91A120_especiales"]; 
					$intTotalR121A150Especiales = $arrCol["total_R121A150_especiales"];
					$intTotalRMayorA151Especiales = $arrCol["total_RMayorA151_especiales"];
					$intTotalNuevosProspectosEspeciales = $arrCol["total_nuevos_especiales"];
            	}
                //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
                $pdf->Row(array($arrCol["madurez"], $arrCol["total_prospectos"], $arrCol["total_R0A60"],
                				$arrCol["total_R61A90"], $arrCol["total_R91A120"], $arrCol["total_R121A150"],
                				$arrCol["total_RMayorA151"], $arrCol["total_nuevos"]),
                				$pdf->arrAlineacion, NULL, NULL, TRUE);
                //Incrementar acumulados
            	$intAcumTotalProspectos += $arrCol["total_prospectos"];
                $intAcumTotalR0A60 += $arrCol["total_R0A60"];
                $intAcumTotalR61A90 += $arrCol["total_R61A90"]; 
				$intAcumTotalR91A120 += $arrCol["total_R91A120"]; 
				$intAcumTotalR121A150 += $arrCol["total_R121A150"];
				$intAcumTotalRMayorA151 += $arrCol["total_RMayorA151"];
				$intAcumTotalNuevosProspectos += $arrCol["total_nuevos"];
				//Incrementar el contador por cada registro
            	$intContador++;
			}
		}


		//Cambiar el tipo de letra de la tabla
        $pdf->strTipoLetraTabla = 'Negrita';
		//Escribir acumulados de las visitas
		$pdf->Row(array('TOTALES', $intAcumTotalProspectos, $intAcumTotalR0A60,
                		  $intAcumTotalR61A90, $intAcumTotalR91A120, $intAcumTotalR121A150,
                		  $intAcumTotalRMayorA151, $intAcumTotalNuevosProspectos),
                		  $pdf->arrAlineacion, NULL, NULL, TRUE);

	    //Escribir totales de las visitas donde el prospecto es especial
	   $pdf->Row(array('ESPECIAL', $intTotalProspectosEspeciales, $intTotalR0A60Especiales,
                		  $intTotalR61A90Especiales, $intTotalR91A120Especiales, 
                		  $intTotalR121A150Especiales,$intTotalRMayorA151Especiales, 
                		  $intTotalNuevosProspectosEspeciales),
                		  $pdf->arrAlineacion, NULL, NULL, TRUE);


        //Ejecutar la salida del reporte
        $pdf->Output('prospectos_visitados_madurez_'.$strModulo.'.pdf','I'); 
	}


    /*Método para generar un archivo XLS con el listado de las últimas visitas de los prospectos 
	 *por madurez registradas en la BD, dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte = $this->input->post('dteFechaCorte');
		$intModuloID = $this->input->post('intModuloID');
		$strModulo = trim($this->input->post('strModulo'));
		$intVendedorID = $this->input->post('intVendedorID');
		$intLocalidadID = $this->input->post('intLocalidadID');
        //Variables que se utilizan para contar las visitas de los prospectos especiales
        //Variable que se utiliza como contador de visitas de la madurez
        $intTotalProspectosEspeciales = 0; 
	     //Variable que se utiliza como contador de visitas  del rango de  0-60 días
		$intTotalR0A60Especiales = 0; 
		//Variable que se utiliza como contador de visitas del rango de 61-90 días
		$intTotalR61A90Especiales = 0; 
		//Variable que se utiliza como contador de visitas del rango de 91-120 días
		$intTotalR91A120Especiales = 0; 
	    //Variable que se utiliza como contador de visitas del rango de 121-150 días
		$intTotalR121A150Especiales = 0;
		//Variable que se utiliza como contador de visitas del rango mayor a 151 días
		$intTotalRMayorA151Especiales = 0;
		//Variable que se utiliza como contador de nuevos prospectos con visitas
		$intTotalNuevosProspectosEspeciales = 0;
		//Variables que se utilizan para acumular totales
		$intAcumTotalProspectos = 0; //Total de visitas de los prospectos
		$intAcumTotalR0A60 = 0; //Total de visitas del rango 0-60 días
		$intAcumTotalR61A90 = 0; //Total de visitas del rango 61-90 días
		$intAcumTotalR91A120 = 0; //Total de visitas del rango 91-120 días
		$intAcumTotalR121A150 = 0;//Total de visitas del rango 121-150 días
		$intAcumTotalRMayorA151 = 0;//Total de visitas del rango  ayor a 151 días
		$intAcumTotalNuevosProspectos = 0; //Total de visitas a nuevos prospectos
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;

		//Seleccionar los datos de las últimas visitas de los prospectos por su madurez
		$otdResultado = $this->get_prospectos_visitados_madurez($dteFechaCorte, $intModuloID, $intVendedorID, 
																$intLocalidadID, $strModulo); 
     	
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/crm/archivos_excel/prospectos_visitados_madurez.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
        //Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'NÚMERO DE PROSPECTOS VISITADOS  FECHA DE CORTE: '.
			     					   $this->get_fecha_formato_letra($dteFechaCorte, 'C'));

		//Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

		//Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));
        
         //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:H9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Si el indice es igual que 10 (primer fila)
        	  	//asignar totales de los prospectos especiales (y así evitar asignarlos varias veces)
            	if($intFila == 10)
            	{
            		//Asignar totales a las siguientes variables (prospectos especiales)
				    $intTotalProspectosEspeciales = $arrCol["total_prospectos_especiales"]; 
					$intTotalR0A60Especiales = $arrCol["total_R0A60_especiales"]; 
					$intTotalR61A90Especiales = $arrCol["total_R61A90_especiales"]; 
					$intTotalR91A120Especiales = $arrCol["total_R91A120_especiales"]; 
					$intTotalR121A150Especiales = $arrCol["total_R121A150_especiales"];
					$intTotalRMayorA151Especiales = $arrCol["total_RMayorA151_especiales"];
					$intTotalNuevosProspectosEspeciales = $arrCol["total_nuevos_especiales"];
            	}

        		//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
						 ->setCellValue('A'.$intFila, $arrCol["madurez"])
						 ->setCellValue('B'.$intFila, $arrCol["total_prospectos"])
						 ->setCellValue('C'.$intFila, $arrCol["total_R0A60"])
						 ->setCellValue('D'.$intFila, $arrCol["total_R61A90"])
						 ->setCellValue('E'.$intFila, $arrCol["total_R91A120"])
						 ->setCellValue('F'.$intFila, $arrCol["total_R121A150"])
						 ->setCellValue('G'.$intFila, $arrCol["total_RMayorA151"])
						 ->setCellValue('H'.$intFila, $arrCol["total_nuevos"]);

                //Incrementar acumulados
            	$intAcumTotalProspectos += $arrCol["total_prospectos"];
                $intAcumTotalR0A60 += $arrCol["total_R0A60"];
                $intAcumTotalR61A90 += $arrCol["total_R61A90"]; 
				$intAcumTotalR91A120 += $arrCol["total_R91A120"]; 
				$intAcumTotalR121A150 += $arrCol["total_R121A150"];
				$intAcumTotalRMayorA151 += $arrCol["total_RMayorA151"];
				$intAcumTotalNuevosProspectos += $arrCol["total_nuevos"];

	      	    //Incrementar el indice para escribir los datos del siguiente registro
			    $intFila++; 
			}
			
            //Agregar información de los acumulados
		    $objExcel->setActiveSheetIndex(0)
				     ->setCellValue('A'.$intFila, 'TOTAL')
			         ->setCellValue('B'.$intFila, $intAcumTotalProspectos)
				     ->setCellValue('C'.$intFila, $intAcumTotalR0A60)
				     ->setCellValue('D'.$intFila, $intAcumTotalR61A90)
				     ->setCellValue('E'.$intFila, $intAcumTotalR91A120)
				     ->setCellValue('F'.$intFila, $intAcumTotalR121A150)
				     ->setCellValue('G'.$intFila, $intAcumTotalRMayorA151)
				     ->setCellValue('H'.$intFila, $intAcumTotalNuevosProspectos);

			//Cambiar estilo de las celdas
	 	    $objExcel->getActiveSheet()
	 	    		 ->getStyle('A'.$intFila.':'.'H'.$intFila)
	 	    		 ->applyFromArray($arrStyleBold);

			//Incrementar el indice para escribir los datos de los prospectos especiales
			$intFila++; 

			//Agregar información de los totales de todas las visitas  donde el prospecto es especial
		    $objExcel->setActiveSheetIndex(0)
					 ->setCellValue('A'.$intFila, 'ESPECIAL')
				     ->setCellValue('B'.$intFila, $intTotalProspectosEspeciales)
					 ->setCellValue('C'.$intFila, $intTotalR0A60Especiales)
					 ->setCellValue('D'.$intFila, $intTotalR61A90Especiales)
					 ->setCellValue('E'.$intFila, $intTotalR91A120Especiales)
					 ->setCellValue('F'.$intFila, $intTotalR121A150Especiales)
					 ->setCellValue('G'.$intFila, $intTotalRMayorA151Especiales)
					 ->setCellValue('H'.$intFila, $intTotalNuevosProspectosEspeciales);

			//Cambiar estilo de las celdas
	 	    $objExcel->getActiveSheet()
	 	    		 ->getStyle('A'.$intFila.':'.'H'.$intFila)
	 	    		 ->applyFromArray($arrStyleBold);	
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'prospectos_visitados_madurez_'.$strModulo.'.xls', 'visitas', $intFila);
	}

	/*Método para regresar los prospectos visitados por madurez que coincidan con los criterios de búsqueda
	 *proporcionados  (se utiliza en el reporte de prospectos visitados por madurez)*/
	public function get_prospectos_visitados_madurez($dteFechaCorte, $intModuloID, $intVendedorID, 
													 $intLocalidadID, $strModulo)
	{
	    //Variable que se utiliza como contador de visitas de la madurez
	    $intTotalProspectos = 0; 
	    //Variable que se utiliza como contador de visitas del rango de  0-60 días
		$intTotalR0A60 = 0; 
		//Variable que se utiliza como contador de visitas del rango de 61-90 días
		$intTotalR61A90 = 0; 
		//Variable que se utiliza como contador de visitas del rango de 91-120 días
		$intTotalR91A120 = 0; 
	    //Variable que se utiliza como contador de visitas del rango de 121-150 días
		$intTotalR121A150 = 0;
		//Variable que se utiliza como contador de visitas del rango mayor a 151 días
		$intTotalRMayorA151 = 0;
		//Variable que se utiliza como contador de nuevos prospectos con visitas
		$intTotalNuevosProspectos = 0;
		//Variables que se utilizan para contar las visitas de los prospectos especiales
	    //Variable que se utiliza como contador de visitas de la madurez
	    $intTotalProspectosEspeciales = 0; 
	     //Variable que se utiliza como contador de visitas del rango de  0-60 días
		$intTotalR0A60Especiales = 0; 
		//Variable que se utiliza como contador de visitas del rango de 61-90 días
		$intTotalR61A90Especiales = 0; 
		//Variable que se utiliza como contador de visitas del rango de 91-120 días
		$intTotalR91A120Especiales = 0; 
	    //Variable que se utiliza como contador de visitas del rango de 121-150 días
		$intTotalR121A150Especiales = 0;
		//Variable que se utiliza como contador de visitas del rango mayor a 151 días
		$intTotalRMayorA151Especiales = 0;
		//Variable que se utiliza como contador de nuevos prospectos con visitas
		$intTotalNuevosProspectosEspeciales = 0;
		//Array que se utiliza para agregar las últimas visitas de los prospectos
        $arrDatos = array();
        //Array que se utiliza para agregar los datos de una madurez
        $arrAuxiliar = array();
        //Array que se utiliza para asignar los tipos de madurez 
		$arrMadurezVisitas = array('1', '2', '3', '4'); 
		//Seleccionar los datos de las últimas visitas de los prospectos del módulo
		$otdVisitasProspectos = $this->prospectos->buscar_visitas_prospectos_madurez($dteFechaCorte, 
																					 $intModuloID, 
																				     $intVendedorID, 
																				     $intLocalidadID);
		//Seleccionar todos los módulos activos
		$otdModulos = $this->modulos->buscar();
		//Restar 30 días a la fecha de corte
		$dteFechaR30Dias = $this->restar_dias_fecha(30, $dteFechaCorte);
		//Restar 60 días a la fecha de corte
		$dteFechaR60Dias = $this->restar_dias_fecha(60, $dteFechaCorte);
		//Restar 90 días a la fecha de corte
		$dteFechaR90Dias = $this->restar_dias_fecha(90, $dteFechaCorte);
		//Restar 120 días a la fecha de corte
		$dteFechaR120Dias = $this->restar_dias_fecha(120, $dteFechaCorte);
		//Restar 150 días a la fecha de corte
		$dteFechaR150Dias = $this->restar_dias_fecha(150, $dteFechaCorte);
		
		//Hacer recorrido para obtener la información de las visitas por su madurez
		foreach ($arrMadurezVisitas as $arrMad) 
		{
			//Asignar madurez de la visita
			$strMadurez = $arrMad;
			//Inicializar variables
			$intTotalProspectos = 0; 
			$intTotalR0A60 = 0; 
			$intTotalR61A90 = 0; 
			$intTotalR91A120 = 0; 
			$intTotalR121A150 = 0;
			$intTotalRMayorA151 = 0;
			$intTotalNuevosProspectos = 0;
			//Hacer recorrido para obtener la información de las visitas por su madurez
			foreach ($otdVisitasProspectos as $arrVisitas) 
			{
				//Asignar última visita del prospecto 
				$dteUltimaVisita = $arrVisitas->ultima_visita;
				//Asignar fecha de creación del prospecto 
				$dteFechaCreacionProspecto = $arrVisitas->fecha_creacion;
				//Variable que se utiliza para saber si el cliente es especial
				$strEspeciales = 'NO';

				//Asignar ID´s de los módulos importantes
		        $strImportante = $arrVisitas->importante;

		        //Si existen módulos
		        if($strImportante != '')
		        {
					//Obtenemos los módulos que tiene asignado un Prospecto(En caso de que aplique)
					$arrModulosAplicados = explode("|", $strImportante);

					//En caso de que existan módulos asignados, debemos verificar cuales son con base en su ID
					foreach ($otdModulos as $arrModulo) 
					{
						//Hacer recorrido para obtener el id de los módulos
						foreach ($arrModulosAplicados as $intModuloID) 
						{
							//En caso de que el módulo este aplicado
							if($arrModulo->modulo_id == $intModuloID)
							{
								$strEspeciales = 'SI';
							}
						}
					}
				}
				
				//Si la madurez tiene visitas
				if($strMadurez == $arrVisitas->madurez)
				{	
					//Verificar si es un nuevo prospecto
					if(($dteFechaCreacionProspecto >= $dteFechaR30Dias) && 
						($dteFechaCreacionProspecto <= $dteFechaCorte))
					{
						//Incrementar contador por cada nuevo prospecto
						$intTotalNuevosProspectos++;
						//Si el cliente es importante 
						if($strEspeciales == 'SI')
						{	
							//Incrementar contador por cada nuevo prospecto especial
							$intTotalNuevosProspectosEspeciales++;
						}
					}

					//Si la última visita se encuentra en el rango de 0-60 días
					if(($dteUltimaVisita >= $dteFechaR60Dias) && ($dteUltimaVisita <= $dteFechaCorte))
					{
						//Incrementar contador del rango por cada visita 
						$intTotalR0A60++;
					    //Si el cliente es importante 
						if($strEspeciales == 'SI')
						{	
							//Incrementar contador del rango por cada visita especial
							$intTotalR0A60Especiales++;
						}
					}
					//Si la última visita se encuentra en el rango de 61-90 días
					else if(($dteUltimaVisita >= $dteFechaR90Dias) && ($dteUltimaVisita < $dteFechaR60Dias))
					{
						//Incrementar contador del rango
						$intTotalR61A90++;
						//Si el cliente es importante 
						if($strEspeciales == 'SI')
						{
							//Incrementar contador del rango por cada visita especial
							$intTotalR61A90Especiales++;
						}
					}
					//Si la última visita se encuentra en el rango de 91-120 días
					else if(($dteUltimaVisita >= $dteFechaR120Dias) && ($dteUltimaVisita < $dteFechaR90Dias))
					{
						//Incrementar contador del rango 
						$intTotalR91A120++;
						//Si el cliente es importante 
						if($strEspeciales == 'SI')
						{
							//Incrementar contador del rango por cada visita especial
							$intTotalR91A120Especiales++;
						}
					}
					//Si la última visita se encuentra en el rango de 121-150 días
					else if(($dteUltimaVisita >= $dteFechaR150Dias) && ($dteUltimaVisita < $dteFechaR120Dias))
					{
						//Incrementar contador del rango
						$intTotalR121A150++;
						//Si el cliente es importante 
						if($strEspeciales == 'SI')
						{
							//Incrementar contador del rango por cada visita especial
							$intTotalR121A150Especiales++;
						}
					}
					else //Si la última visita se encuentra en el rango de mayor que 151 días
					{
						//Incrementar contador del rango
						$intTotalRMayorA151++;
						//Si el cliente es importante 
						if($strEspeciales == 'SI')
						{
							//Incrementar contador del rango por cada visita especial
							$intTotalRMayorA151Especiales++;
						}
					}

					//Si el cliente es importante 
					if($strEspeciales == 'SI')
					{
						//Incrementar contador del rango por cada visita especial
						$intTotalProspectosEspeciales++;
					}

					//Incrementar contador por cada visita del prospecto
				    $intTotalProspectos++;
				}
			}
			//Definir valores del array auxiliar de información (para cada madurez)
			$arrAuxiliar["madurez"] = $strMadurez;
			$arrAuxiliar["total_prospectos"] = $intTotalProspectos;
			$arrAuxiliar["total_R0A60"] = $intTotalR0A60;
			$arrAuxiliar["total_R61A90"] = $intTotalR61A90;
			$arrAuxiliar["total_R91A120"] = $intTotalR91A120;
			$arrAuxiliar["total_R121A150"] = $intTotalR121A150;
			$arrAuxiliar["total_RMayorA151"] = $intTotalRMayorA151;
			$arrAuxiliar["total_nuevos"] = $intTotalNuevosProspectos;
			$arrAuxiliar["total_prospectos_especiales"] = $intTotalProspectosEspeciales;
			$arrAuxiliar["total_R0A60_especiales"] = $intTotalR0A60Especiales;
			$arrAuxiliar["total_R61A90_especiales"] = $intTotalR61A90Especiales;
			$arrAuxiliar["total_R91A120_especiales"] = $intTotalR91A120Especiales;
			$arrAuxiliar["total_R121A150_especiales"] = $intTotalR121A150Especiales;
			$arrAuxiliar["total_RMayorA151_especiales"] = $intTotalRMayorA151Especiales;
			$arrAuxiliar["total_nuevos_especiales"] = $intTotalNuevosProspectosEspeciales;
			//Asignar datos al array resultado
			array_push($arrDatos,$arrAuxiliar); 
		}//Cierre de foreach visitas

		return $arrDatos;
	}
}