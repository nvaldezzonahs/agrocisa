<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_inventario_concentrado extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de inventario de maquinaria
		$this->load->model('maquinaria/maquinaria_inventario_model', 'inventario');
		//Cargamos el modelo de líneas de maquinaria
		$this->load->model('maquinaria/maquinaria_lineas_model', 'lineas');
		//Cargamos el modelo de marcas de maquinaria
		$this->load->model('maquinaria/maquinaria_marcas_model', 'marcas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('maquinaria/rep_inventario_concentrado', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el inventario concentrado de maquinaria
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte() 
	{	            
		
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte =  $this->input->post('dteFechaCorte');
		$intMaquinariaLineaID =  $this->input->post('intMaquinariaLineaID');
		$intMaquinariaMarcaID =  $this->input->post('intMaquinariaMarcaID');
		$intMaquinariaModeloID =  $this->input->post('intMaquinariaModeloID');


		//Variable que se utiliza pra asignar el id actual de la línea de maquinaria
		$intMaquinariaLineaIDActual = 0;
		//Variable que se utiliza pra asignar el id actual de la marca de maquinaria
		$intMaquinariaMarcaIDActual = 0;
		//Variable que se utiliza pra asignar el id actual de la descripción de maquinaria
		$intMaquinariaDescripcionIDActual = 0;
		//Variable que se utiliza para asignar el subtitulo del reporte
		$strSubtitulo = '';
	    //Variable que se utiliza para asignar el acumulado de existencias
	    $intAcumExistencias = 0;
	    //Variable que se utiliza para asignar el acumulado de pedidos
	    $intAcumPedidos = 0;
	    //Array que se utiliza para asignar el total de existencias de la sucursal
        $arrTotalesExistenciaSuc = array();
        //Asignar posición de la abscisa 
        $intPosX = 10;
        //Asignar posición de la ordenada  
        $intPosY = 67;
		
		//Seleccionar los datos del inventario que coinciden con el parámetro enviado
		$otdResultado = $this->inventario->buscar_inventario_concentrado($dteFechaCorte, $intMaquinariaLineaID, 
						   			                                     $intMaquinariaMarcaID, $intMaquinariaModeloID); 

		//Seleccionar los datos de las sucursales que coinciden con el parámetro enviado
		$otdSucursales = $this->inventario->buscar_distintas_sucursales_inventario_concentrado($dteFechaCorte,
																							   $intMaquinariaLineaID, 
						   			                                          		           $intMaquinariaMarcaID, 
						   			                                          		           $intMaquinariaModeloID); 

		//Se crea una instancia de la clase PDF  
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFecha = $this->get_fecha_formato_letra($dteFechaCorte, 'C');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = 'INVENTARIO AL '.$strTituloFecha;
		//Si existe id de la línea de maquinaria
		if($intMaquinariaLineaID > 0)
		{
			//Seleccionar los datos de la línea de maquinaria que coincide con el id
			$otdMaquinariaLinea =  $this->lineas->buscar($intMaquinariaLineaID);
			$strSubtitulo .= utf8_decode('LÍNEA: '.$otdMaquinariaLinea->descripcion);
		}

		//Si existe id de la marca de maquinaria
		if($intMaquinariaMarcaID > 0)
		{
			//Seleccionar los datos de la marca de maquinaria que coincide con el id
			$otdMaquinariaMarca =  $this->marcas->buscar($intMaquinariaMarcaID);
			$strSubtitulo .= '    '. utf8_decode('MARCA: '.$otdMaquinariaMarca->descripcion);
			
		}

		//Si se cumple la sentencia
		if($intMaquinariaLineaID > 0 OR $intMaquinariaMarcaID > 0)
		{
			//Incrementar ordenada  
			$intPosY+=6;
		}

		//Asignar el valor de la descripción (subtítulo de la lista de registros) del reporte
		$pdf->strLinea2 =  $strSubtitulo;
		//Variable que se utiliza para asignar el número de columnas  correspondientes a los totales (EXISTENCIAS, PEDIDOS Y TOTAL)
		$intColTotales = 3;
		//Variable que se utiliza para asignar el tamaño restante de la hoja doble cara
        $intTamColSucursales = 13;

        //Variable que se utiliza para asignar el tamaño de los encabezados de las columnas fijas 
		$intTamColFijas = (190 -  ($intTamColSucursales  * (count($otdSucursales) + $intColTotales)));
	
		//Establece el ancho de las columnas de cabecera
		$arrAnchura = array($intTamColFijas);

        
				            
		//Si hay información
		if ($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Si la línea de maquinaria actual es igual a cero (primer línea de maquinaria)
				if ($intMaquinariaLineaIDActual == 0)
				{
					//Agregar la primer pagina
					$pdf->AddPage();

					//Crea los titulos de la cabecera
					$arrCabecera = array('');
					//Realizar recorrido para agregar a la cabecera las columnas de sucursales
			        if ($otdSucursales) //Si hay información
			        { 	//Recorremos el arreglo 
			        	foreach ($otdSucursales as $arrSuc) 
			        	{
			        		//Asignar datos al array
					        $arrCabecera[] = $arrSuc->nombre;
					        $arrAnchura [] =  $intTamColSucursales;
					        //Inicializar el total de existencia de la sucursal
					        $arrTotalesExistenciaSuc[$arrSuc->sucursal_id] = 0; 
			        	}

			        }//Cierre de verificación de sucursales

			        //Agregar al array las siguientes columnas
				    //Total de existencias
				    $arrCabecera[] =  'EXISTENCIAS'; 
				    $arrAnchura [] =  $intTamColSucursales;
				    //Total de pedidos
				    $arrCabecera[] =  'PEDIDOS'; 
				    $arrAnchura [] =  $intTamColSucursales;
				    //Diferencia
				    $arrCabecera[] =  'TOTAL';
				    $arrAnchura [] =  $intTamColSucursales;
				    //Hacer un llamado a la función para crear cabecera de la tabla
			      	$this->get_cabecera_tabla($pdf,$arrCabecera, $arrAnchura, $arrCol->maquinaria_linea);
					$pdf->Ln(); //Deja un salto de línea
					//Asignar id de la línea de maquinaria actual
	      		    $intMaquinariaLineaIDActual = $arrCol->maquinaria_linea_id;
	      		    //Actualizar posición de abscisa y ordenada
	      		    $pdf->SetXY($intPosX,$intPosY);

				}


				//Si la descripción de maquinaria actual es diferente al anterior
				if ($intMaquinariaDescripcionIDActual != $arrCol->maquinaria_descripcion_id)
				{
					//Si existe id de la descripción de maquinaria actual
					if ($intMaquinariaDescripcionIDActual > 0)
					{
						//Seleccionar el total de pedidos de la maquinaria
						$otdPedidos = $this->inventario->buscar_pedidos_inventario_concentrado($dteFechaCorte,
																						  	   $intMaquinariaDescripcionIDActual, 
																						       $intMaquinariaLineaIDActual, 
						   			                      								       $intMaquinariaMarcaIDActual, 
						   			                      								       $intMaquinariaModeloID);
						//Si hay información
						if($otdPedidos)
						{
							//Recorremos el arreglo 
							foreach ($otdPedidos as $arrPed)
							{
								//Asignar el total de pedidos
								$intAcumPedidos = $arrPed->total_pedidos;
							}
						}

						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);

						//Espacios de salto de línea
						$pdf->Ln();
						$pdf->ClippedCell($intTamColFijas, 4, utf8_decode($strMaquinariaDescripcion), 1, 0, 'L', 0);
						 //Si hay información de las sucursales
					     if ($otdSucursales) 
				         { 	//Recorremos el arreglo 
				        	foreach ($otdSucursales as $arrSuc) 
				        	{
				        		//Existencia de la sucursal
						        $pdf->ClippedCell($intTamColSucursales, 4, $arrTotalesExistenciaSuc[$arrSuc->sucursal_id], 1, 0, 'R', 0);
						        //Inicializar el total de existencia de la sucursal
						        $arrTotalesExistenciaSuc[$arrSuc->sucursal_id] = 0;
				        	}

				        }//Cierre de verificación de sucursales

				        //Calcular existencia total 
		       		    $intTotal = $intAcumExistencias - $intAcumPedidos;

				        //Escribir totales
				        //Acumulado de existencias
				        $pdf->ClippedCell($intTamColSucursales, 4, $intAcumExistencias, 1, 0, 'R', 0);
				        //Acumulado de pedidos
				        $pdf->ClippedCell($intTamColSucursales, 4, $intAcumPedidos, 1, 0, 'R', 0);
				        //Total
				        $pdf->ClippedCell($intTamColSucursales, 4, $intTotal, 1, 0, 'R', 0);

				        //Inicializar variable
				        $intAcumExistencias = 0;
					}

					//Asignar valores de la descripción de maquinaria
					$intMaquinariaDescripcionIDActual = $arrCol->maquinaria_descripcion_id;
					$arrTotalesExistenciaSuc[$arrCol->sucursal_id] =  $arrCol->existencia;
					$intAcumExistencias += $arrCol->existencia;
					//Limpiar las siguientes variables (por cada descripción de maquinaria recorrida)
					$intAcumPedidos =  0;


				}
				else
				{
					//Incrementar acumulados
					$arrTotalesExistenciaSuc[$arrCol->sucursal_id] +=  $arrCol->existencia;
					$intAcumExistencias += $arrCol->existencia;
				}

				//Si la línea de maquinaria actual es diferente a la anterior
   				if ($intMaquinariaLineaIDActual != $arrCol->maquinaria_linea_id)
				{
					//Agregar pagina
					$pdf->AddPage();
					//Hacer un llamado a la función para crear cabecera de la tabla
			      	$this->get_cabecera_tabla($pdf,$arrCabecera, $arrAnchura, $arrCol->maquinaria_linea);
			      	//Actualizar posición de abscisa y ordenada
			      	$pdf->SetXY($intPosX,$intPosY);
					//Inicializar variable
			      	$intMaquinariaMarcaIDActual = 0;
				}

				$pdf->SetTextColor(0); //establece el color de texto

				//Si la marca de maquinaria actual es igual a cero (primer marca de maquinaria )
				if ($intMaquinariaMarcaIDActual == 0)
				{
					//Espacios de salto de línea
					$pdf->Ln(5);
					//Marca
					$pdf->ClippedCell(190, 4, utf8_decode($arrCol->maquinaria_marca), 1, 0, 'L', 0);
					//Asignar id de la marca de maquinaria actual
	      			$intMaquinariaMarcaIDActual = $arrCol->maquinaria_marca_id;
					
				}

				//Si la marca de maquinaria actual es diferente al anterior
	      	    if ($intMaquinariaMarcaIDActual != $arrCol->maquinaria_marca_id)
				{
					//Asigna el tipo y tamaño de letra 
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Espacios de salto de línea
					$pdf->Ln();
					//Marca
					$pdf->ClippedCell(190, 4, utf8_decode($arrCol->maquinaria_marca), 1, 0, 'L', 0);
				}

				//Asignar id de la marca de maquinaria actual
      			$intMaquinariaMarcaIDActual = $arrCol->maquinaria_marca_id;
      			//Asignar id de la línea de maquinaria actual
      			$intMaquinariaLineaIDActual = $arrCol->maquinaria_linea_id;
      			//Asignar descripción de maquinaria actual
      			$strMaquinariaDescripcion = $arrCol->maquinaria_descripcion;
			}

			//Escribir los acumulados de la última descripción de maquinaria
			if ($intMaquinariaDescripcionIDActual > 0)
			{
				//Seleccionar el total de pedidos de la maquinaria
				$otdPedidos = $this->inventario->buscar_pedidos_inventario_concentrado($dteFechaCorte,
																				  	   $intMaquinariaDescripcionIDActual, 
																				       $intMaquinariaLineaIDActual, 
				   			                      								       $intMaquinariaMarcaIDActual, 
				   			                      								       $intMaquinariaModeloID);
				//Si hay información
				if($otdPedidos)
				{
					//Recorremos el arreglo 
					foreach ($otdPedidos as $arrPed)
					{
						//Asignar el total de pedidos
						$intAcumPedidos = $arrPed->total_pedidos;
					}
				}

				//Asigna el tipo y tamaño de letra para la cabecera de la tabla
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);

				//Espacios de salto de línea
				$pdf->Ln();
				$pdf->ClippedCell($intTamColFijas, 4, utf8_decode($strMaquinariaDescripcion), 1, 0, 'L', 0);
				//Si hay información de las sucursales
			    if ($otdSucursales) 
		        { 	//Recorremos el arreglo 
		        	foreach ($otdSucursales as $arrSuc) 
		        	{
		        		//Existencia de la sucursal
				        $pdf->ClippedCell($intTamColSucursales, 4, $arrTotalesExistenciaSuc[$arrSuc->sucursal_id], 1, 0, 'R', 0);
		        	}

		        }//Cierre de verificación de sucursales

		        //Calcular existencia total 
		        $intTotal = $intAcumExistencias - $intAcumPedidos;

			    //Escribir totales
		        //Acumulado de existencias
		        $pdf->ClippedCell($intTamColSucursales, 4, $intAcumExistencias, 1, 0, 'R', 0);
		        //Acumulado de pedidos
		        $pdf->ClippedCell($intTamColSucursales, 4, $intAcumPedidos, 1, 0, 'R', 0);
		        //Total
		        $pdf->ClippedCell($intTamColSucursales, 4, $intTotal, 1, 0, 'R', 0);
			}
 
		}

		//Ejecutar la salida del reporte
		$pdf->Output('inventario_concentrado_maquinaria.pdf','I'); 
	}


	//Método para crear cabecera de la tabla del archivo PDF
    public function get_cabecera_tabla($pdf, $arrCabecera, $arrAchura, $strLineaMaquinaria)
    {
    	//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Establecer el color de fondo para la cabecera
		$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		//Escribir primer columna (descripción de la línea de maquinaria)
		$pdf->ClippedCell($arrAchura[0],25, utf8_decode($strLineaMaquinaria),1, 2 , 'C', TRUE);
		//Asignar posición actual de la abscisa 
		$intPosX = $pdf->GetX();
		//Asignar posición actual de la ordenada 
		$intPosY = $pdf->GetY();
		//Rotar celdas a 90 grados
		$pdf->Rotate(90);
		//Incrementar ordenada
		$intPosY +=$arrAchura[0];
		//Actualizar posición de abscisa y ordenada
		$pdf->SetXY($intPosX, $intPosY);
		//Recorre el array de titulos de encabezado para crearlos
        for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
        {	
        	//Si el indice no corresponde a la primer columna
            if( $intCont > 0)
            {
            	//inserta los titulos de la cabecera
                $pdf->ClippedCell(25,$arrAchura[$intCont], utf8_decode($arrCabecera[$intCont]),1, 1 , 'L', TRUE);
            }
           
        }
		//Devolver rotación a 0 grados
		$pdf->Rotate(0);
    }



	/*Método para generar un archivo XLS con el inventario concentrado de maquinaria
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaCorte =  $this->input->post('dteFechaCorte');
		$intMaquinariaLineaID =  $this->input->post('intMaquinariaLineaID');
		$intMaquinariaMarcaID =  $this->input->post('intMaquinariaMarcaID');
		$intMaquinariaModeloID =  $this->input->post('intMaquinariaModeloID');

        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 11;
         //Variable que se utiliza para asignar el número de columna donde se empezaran a escribir las sucursales
	    $intIndColSuc = 2;
	    //Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
		//Variable que se utiliza pra asignar el id actual de la línea de maquinaria
		$intMaquinariaLineaIDActual = 0;
		//Variable que se utiliza pra asignar el id actual de la marca de maquinaria
		$intMaquinariaMarcaIDActual = 0;
		//Variable que se utiliza pra asignar el id actual de la descripción de maquinaria
		$intMaquinariaDescripcionIDActual = 0;
		//Variable que se utiliza para asignar el acumulado de existencias
	    $intAcumExistencias = 0;
	    //Variable que se utiliza para asignar el acumulado de pedidos
	    $intAcumPedidos = 0;
	    //Array que se utiliza para asignar el total de existencias de la sucursal
        $arrTotalesExistenciaSuc = array();
      	//Seleccionar los datos del inventario que coinciden con el parámetro enviado
		$otdResultado = $this->inventario->buscar_inventario_concentrado($dteFechaCorte, $intMaquinariaLineaID, 
						   			                        			 $intMaquinariaMarcaID, $intMaquinariaModeloID); 
     	
     	//Seleccionar los datos de las sucursales que coinciden con el parámetro enviado
		$otdSucursales = $this->inventario->buscar_distintas_sucursales_inventario_concentrado($dteFechaCorte,
																							   $intMaquinariaLineaID, 
						   			                                          		           $intMaquinariaMarcaID, 
						   			                                          		           $intMaquinariaModeloID); 


		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloFecha = $this->get_fecha_formato_letra($dteFechaCorte, 'C');
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE,
        												'name' => 'Arial',
        												'size' => 9,
    													'color' => array('rgb' => 'ffffff')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		//Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));
        
		//Si hay información
		if ($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Asignar el nombre de la hoja
				$strNombreHoja = 'inventario '.$arrCol->maquinaria_linea;

				//Si la línea de maquinaria actual es igual a cero (primer línea de maquinaria)
				if ($intMaquinariaLineaIDActual == 0)
				{
					//Número de fila donde se va a comenzar a rellenar
				    $intFila = 12;
				    $intFilaInicial = 12;
				    $intIndColE = $intIndColSuc;//Empezar en la columna 2-B (Encabezados de las sucursales)

				    //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
			        $this->get_encabezado_archivo_excel($objExcel);
			        //Marcar como activa la nueva hoja
			        $objExcel->setActiveSheetIndex($intContadorHojas); 

			        //Se agrega el título del archivo
					$objExcel->getActiveSheet()->setCellValue('A7', 'INVENTARIO AL '.$strTituloFecha);
					//Si existe id de la línea de maquinaria
					if($intMaquinariaLineaID > 0)
					{
						//Seleccionar los datos de la línea de maquinaria que coincide con el id
						$otdMaquinariaLinea =  $this->lineas->buscar($intMaquinariaLineaID);
						$objExcel->setActiveSheetIndex(0)
						         ->setCellValue('A8', 'LÍNEA: '.$otdMaquinariaLinea->descripcion);
					}

					//Si existe id de la marca de maquinaria
					if($intMaquinariaMarcaID > 0)
					{
						//Seleccionar los datos de la marca de maquinaria que coincide con el id
						$otdMaquinariaMarca =  $this->marcas->buscar($intMaquinariaMarcaID);
						$objExcel->setActiveSheetIndex(0)
						         ->setCellValue('A9', 'MARCA: '.$otdMaquinariaMarca->descripcion);
						
					}

					//Se agregan las columnas de cabecera
				    $objExcel->getActiveSheet()
				    		->setCellValue('A'.$intPosEncabezados, $arrCol->maquinaria_linea);

					//Realizar recorrido para agregar a la cabecera las columnas de sucursales
			        if ($otdSucursales) //Si hay información
			        { 	//Recorremos el arreglo 
			        	foreach ($otdSucursales as $arrSuc) 
			        	{
			        		//Se agrega en el encabezado del archivo las sucursales
        	  		 		$objExcel->getActiveSheet()
		               			     ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados, $arrSuc->nombre);
					        //Inicializar el total de existencia de la sucursal
					        $arrTotalesExistenciaSuc[$arrSuc->sucursal_id] = 0; 
					        //Incrementar indice de la columna
			  			    $intIndColE++;       
			        	}

			        }//Cierre de verificación de sucursales

			        //Se agrega en el encabezado del archivo las columnas de los totales
      			  	$objExcel->getActiveSheet()
        		 			->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados, 'EXISTENCIAS')
        		 		    ->setCellValue($this->ARR_COLUMNAS[$intIndColE+1].$intPosEncabezados, 'PEDIDOS')
        		 			->setCellValue($this->ARR_COLUMNAS[$intIndColE+2].$intPosEncabezados, 'TOTAL');

        		 	//Combinar las siguientes celdas
				    $objExcel->getActiveSheet()->mergeCells('A8:D8');
				    $objExcel->getActiveSheet()->mergeCells('A9:D9');

			    	//Cambiar estilo de las siguientes celdas
			        $objExcel->getActiveSheet()
			        		 ->getStyle('A8:D8')
			        		 ->applyFromArray($arrStyleBold);

			       $objExcel->getActiveSheet()
			        		 ->getStyle('A9:D9')
			        		 ->applyFromArray($arrStyleBold);

			        //Preferencias de color de relleno de celda 
			        $objExcel->getActiveSheet()
			    			 ->getStyle('A11:'.$this->ARR_COLUMNAS[$intIndColE+2].'11')
			    			 ->getFill()
			    			 ->applyFromArray($arrStyleColumnas);

			   		//Preferencias de color de texto de la celda 
			    	$objExcel->getActiveSheet()
			    			 ->getStyle('A11:'.$this->ARR_COLUMNAS[$intIndColE+2].'11')
			    			 ->applyFromArray($arrStyleFuenteColumnas);

			    	//Cambiar alineación de las siguientes celdas
					$objExcel->getActiveSheet()
			            	 ->getStyle('A11:'.$this->ARR_COLUMNAS[$intIndColE+2].'11')
			            	 ->getAlignment()
			            	 ->applyFromArray($arrStyleAlignmentCenter);


					//Asignar id de la línea de maquinaria actual
	      		    $intMaquinariaLineaIDActual = $arrCol->maquinaria_linea_id;

				}


				//Si la descripción de maquinaria actual es diferente al anterior
				if ($intMaquinariaDescripcionIDActual != $arrCol->maquinaria_descripcion_id)
				{
					//Si existe id de la descripción de maquinaria actual
					if ($intMaquinariaDescripcionIDActual > 0)
					{
						//Inicializar indice de la columna para empezar en la columna 2-B (total de existencias en la sucursal)
						$intIndColExistenciaSuc = $intIndColSuc;

						//Seleccionar el total de pedidos de la maquinaria
						$otdPedidos = $this->inventario->buscar_pedidos_inventario_concentrado($dteFechaCorte,
																						  	   $intMaquinariaDescripcionIDActual, 
																						       $intMaquinariaLineaIDActual, 
						   			                      								       $intMaquinariaMarcaIDActual, 
						   			                      								       $intMaquinariaModeloID);
						//Si hay información
						if($otdPedidos)
						{
							//Recorremos el arreglo 
							foreach ($otdPedidos as $arrPed)
							{
								//Asignar el total de pedidos
								$intAcumPedidos = $arrPed->total_pedidos;
							}
						}


						//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
						//Agregar información de la descripción de maquinaria
						$objExcel->getActiveSheet()
								 ->setCellValueExplicit('A'.$intFila, $strMaquinariaDescripcion, PHPExcel_Cell_DataType::TYPE_STRING);

						 //Si hay información de las sucursales
					     if ($otdSucursales) 
				         { 	//Recorremos el arreglo 
				        	foreach ($otdSucursales as $arrSuc) 
				        	{
				        		//Agregar Información del total de existencias por sucursal
		            	   	    $objExcel->getActiveSheet()
					                	 ->setCellValue($this->ARR_COLUMNAS[$intIndColExistenciaSuc].$intFila, 
					                   					$arrTotalesExistenciaSuc[$arrSuc->sucursal_id]);
						        //Inicializar el total de existencia de la sucursal
						        $arrTotalesExistenciaSuc[$arrSuc->sucursal_id] = 0;
						        //Incrementar indice de la columna
				    			$intIndColExistenciaSuc++;  
				        	}

				        }//Cierre de verificación de sucursales

				        //Calcular existencia total 
		       		    $intTotal = $intAcumExistencias - $intAcumPedidos;

				        //Escribir totales
					    //Agregar información de los totales
	         		    $objExcel->getActiveSheet()
						         ->setCellValue($this->ARR_COLUMNAS[$intIndColExistenciaSuc].$intFila, $intAcumExistencias)
						         ->setCellValue($this->ARR_COLUMNAS[$intIndColExistenciaSuc+1].$intFila, $intAcumPedidos)
						         ->setCellValue($this->ARR_COLUMNAS[$intIndColExistenciaSuc+2].$intFila, $intTotal);

				       

				        //Inicializar variable
				        $intAcumExistencias = 0;

				         //Incrementar el indice para escribir los datos del siguiente registro
               			$intFila++;
					}

					//Asignar valores de la descripción de maquinaria
					$intMaquinariaDescripcionIDActual = $arrCol->maquinaria_descripcion_id;
					$arrTotalesExistenciaSuc[$arrCol->sucursal_id] =  $arrCol->existencia;
					$intAcumExistencias += $arrCol->existencia;
					//Limpiar las siguientes variables (por cada descripción de maquinaria recorrida)
					$intAcumPedidos =  0;

				}
				else
				{
					//Incrementar acumulados
					$arrTotalesExistenciaSuc[$arrCol->sucursal_id] +=  $arrCol->existencia;
					$intAcumExistencias += $arrCol->existencia;
				}

				//Si la línea de maquinaria actual es diferente a la anterior
   				if ($intMaquinariaLineaIDActual != $arrCol->maquinaria_linea_id)
				{

					//Cambiar alineación de las siguientes celdas
		    		$objExcel->getActiveSheet()
				        	 ->getStyle('B'.$intFilaInicial.':'.$this->ARR_COLUMNAS[$intIndColE+2].$intFila)
				        	 ->getAlignment()
				        	 ->applyFromArray($arrStyleAlignmentRight);

					//Incrementar contador por cada línea de maquinaria
					$intContadorHojas++;

					//Agregar nueva hoja
					$objNuevaHoja = $objExcel->createSheet();
					//Marcar como activa la nueva hoja
					$objExcel->setActiveSheetIndex($intContadorHojas); 
					//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
		            $this->get_encabezado_archivo_excel($objNuevaHoja, 'nueva');
		            //Definir nombre de la hoja
					$objNuevaHoja->setTitle($strNombreHoja);

				
				    $intIndColE = $intIndColSuc;//Empezar en la columna 2-B (Encabezados de las sucursales)
					
					//Se agrega el título del archivo
					$objExcel->getActiveSheet()->setCellValue('A7', 'INVENTARIO AL '.$strTituloFecha);
					//Si existe id de la línea de maquinaria
					if($intMaquinariaLineaID > 0)
					{
						//Seleccionar los datos de la línea de maquinaria que coincide con el id
						$otdMaquinariaLinea =  $this->lineas->buscar($intMaquinariaLineaID);
						$objExcel->setActiveSheetIndex(0)
						         ->setCellValue('A8', 'LÍNEA: '.$otdMaquinariaLinea->descripcion);
					}

					//Si existe id de la marca de maquinaria
					if($intMaquinariaMarcaID > 0)
					{
						//Seleccionar los datos de la marca de maquinaria que coincide con el id
						$otdMaquinariaMarca =  $this->marcas->buscar($intMaquinariaMarcaID);
						$objExcel->setActiveSheetIndex(0)
						         ->setCellValue('A9', 'MARCA: '.$otdMaquinariaMarca->descripcion);
						
					}

					//Se agregan las columnas de cabecera
				    $objExcel->getActiveSheet()
				    		->setCellValue('A'.$intPosEncabezados, $arrCol->maquinaria_linea);

				    //Realizar recorrido para agregar a la cabecera las columnas de sucursales
			        if ($otdSucursales) //Si hay información
			        { 	//Recorremos el arreglo 
			        	foreach ($otdSucursales as $arrSuc) 
			        	{
			        		//Se agrega en el encabezado del archivo las sucursales
        	  		 		$objExcel->getActiveSheet()
		               			     ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados, $arrSuc->nombre);
					        //Incrementar indice de la columna
			  			    $intIndColE++;      

			        	}

			        }//Cierre de verificación de sucursales

			       //Se agrega en el encabezado del archivo las columnas de los totales
      			  	$objExcel->getActiveSheet()
        		 			->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados, 'EXISTENCIAS')
        		 		    ->setCellValue($this->ARR_COLUMNAS[$intIndColE+1].$intPosEncabezados, 'PEDIDOS')
        		 			->setCellValue($this->ARR_COLUMNAS[$intIndColE+2].$intPosEncabezados, 'TOTAL');

        		 	//Combinar las siguientes celdas
				    $objExcel->getActiveSheet()->mergeCells('A8:D8');
				    $objExcel->getActiveSheet()->mergeCells('A9:D9');

			    	//Cambiar estilo de las siguientes celdas
			        $objExcel->getActiveSheet()
			        		 ->getStyle('A8:D8')
			        		 ->applyFromArray($arrStyleBold);

			       $objExcel->getActiveSheet()
			        		 ->getStyle('A9:D9')
			        		 ->applyFromArray($arrStyleBold);

			        //Preferencias de color de relleno de celda 
			        $objExcel->getActiveSheet()
			    			 ->getStyle('A11:'.$this->ARR_COLUMNAS[$intIndColE+2].'11')
			    			 ->getFill()
			    			 ->applyFromArray($arrStyleColumnas);

			   		//Preferencias de color de texto de la celda 
			    	$objExcel->getActiveSheet()
			    			 ->getStyle('A11:'.$this->ARR_COLUMNAS[$intIndColE+2].'11')
			    			 ->applyFromArray($arrStyleFuenteColumnas);

			    	//Cambiar alineación de las siguientes celdas
					$objExcel->getActiveSheet()
			            	 ->getStyle('A11:'.$this->ARR_COLUMNAS[$intIndColE+2].'11')
			            	 ->getAlignment()
			            	 ->applyFromArray($arrStyleAlignmentCenter);	

			        //Número de fila donde se va a comenzar a rellenar
				    $intFila = 12;
				    $intFilaInicial = 12;
					//Inicializar variable
			      	$intMaquinariaMarcaIDActual = 0;
				}

				
				//Si la marca de maquinaria actual es igual a cero (primer marca de maquinaria )
				if ($intMaquinariaMarcaIDActual == 0)
				{
					//Agregar información de la marca
				    $objExcel->getActiveSheet()
				    		 ->setCellValue('A'.$intFila, $arrCol->maquinaria_marca);

				    //Combinar las siguientes celdas
				    $objExcel->getActiveSheet()->mergeCells('A'.$intFila.':D'.$intFila);

	      			//Cambiar estilo de la celda
			        $objExcel->getActiveSheet()
			        		 ->getStyle('A'.$intFila)
			        		 ->applyFromArray($arrStyleBold);

					//Asignar id de la marca de maquinaria actual
	      			$intMaquinariaMarcaIDActual = $arrCol->maquinaria_marca_id;
	      			//Incrementar el indice para escribir los datos del siguiente registro
               		$intFila++;
					
				}

				//Si la marca de maquinaria actual es diferente al anterior
	      	    if ($intMaquinariaMarcaIDActual != $arrCol->maquinaria_marca_id)
				{
					//Agregar información de la marca
				    $objExcel->getActiveSheet()
				    		 ->setCellValue('A'.$intFila, $arrCol->maquinaria_marca);

				   //Combinar las siguientes celdas
				    $objExcel->getActiveSheet()->mergeCells('A'.$intFila.':D'.$intFila);

				    //Cambiar estilo de la celda
			        $objExcel->getActiveSheet()
			        		 ->getStyle('A'.$intFila)
			        		 ->applyFromArray($arrStyleBold);

			        //Incrementar el indice para escribir los datos del siguiente registro
               		$intFila++;
				}

				//Asignar id de la marca de maquinaria actual
      			$intMaquinariaMarcaIDActual = $arrCol->maquinaria_marca_id;
      			//Asignar id de la línea de maquinaria actual
      			$intMaquinariaLineaIDActual = $arrCol->maquinaria_linea_id;
      			//Asignar descripción de maquinaria actual
      			$strMaquinariaDescripcion = $arrCol->maquinaria_descripcion;
			}

			//Escribir los acumulados de la última descripción de maquinaria
			if ($intMaquinariaDescripcionIDActual > 0)
			{
				//Inicializar indice de la columna para empezar en la columna 2-B (total de existencias en la sucursal)
				$intIndColExistenciaSuc = $intIndColSuc;

				//Seleccionar el total de pedidos de la maquinaria
				$otdPedidos = $this->inventario->buscar_pedidos_inventario_concentrado($dteFechaCorte,
																				  	   $intMaquinariaDescripcionIDActual, 
																				       $intMaquinariaLineaIDActual, 
				   			                      								       $intMaquinariaMarcaIDActual, 
				   			                      								       $intMaquinariaModeloID);
				//Si hay información
				if($otdPedidos)
				{
					//Recorremos el arreglo 
					foreach ($otdPedidos as $arrPed)
					{
						//Asignar el total de pedidos
						$intAcumPedidos = $arrPed->total_pedidos;
					}
				}

				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información de la descripción de maquinaria
				$objExcel->getActiveSheet()
						 ->setCellValueExplicit('A'.$intFila, $strMaquinariaDescripcion, PHPExcel_Cell_DataType::TYPE_STRING);

				 //Si hay información de las sucursales
			     if ($otdSucursales) 
		         { 	//Recorremos el arreglo 
		        	foreach ($otdSucursales as $arrSuc) 
		        	{
		        		//Agregar Información del total de existencias por sucursal
            	   	    $objExcel->getActiveSheet()
			                	 ->setCellValue($this->ARR_COLUMNAS[$intIndColExistenciaSuc].$intFila, 
			                   					$arrTotalesExistenciaSuc[$arrSuc->sucursal_id]);
				        //Inicializar el total de existencia de la sucursal
				        $arrTotalesExistenciaSuc[$arrSuc->sucursal_id] = 0;
				        //Incrementar indice de la columna
		    			$intIndColExistenciaSuc++;  
		        	}

		        }//Cierre de verificación de sucursales

		        //Calcular existencia total 
       		    $intTotal = $intAcumExistencias - $intAcumPedidos;

		        //Escribir totales
			    //Agregar información de los totales
     		    $objExcel->getActiveSheet()
				         ->setCellValue($this->ARR_COLUMNAS[$intIndColExistenciaSuc].$intFila, $intAcumExistencias)
				         ->setCellValue($this->ARR_COLUMNAS[$intIndColExistenciaSuc+1].$intFila, $intAcumPedidos)
				         ->setCellValue($this->ARR_COLUMNAS[$intIndColExistenciaSuc+2].$intFila, $intTotal);
			}
 
		}

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'inventario_concentrado_maquinaria.xls', 'inventario', $intFila);
	}
}