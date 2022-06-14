<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_prospectos extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo de prospectos
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
		$this->cargar_vista('crm/rep_prospectos', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el listado de los pospectos
	 *(con su última visita en caso de que exista) dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte() 
	{	  
		//Variables que se utilizan para recuperar los valores de la vista
		$intModuloID = $this->input->post('intModuloID');
		$strModulo = trim($this->input->post('strModulo'));
		$intVendedorID = $this->input->post('intVendedorID');
		$intLocalidadID = $this->input->post('intLocalidadID');
		$strMadurez = $this->input->post('strMadurez');
        //Variable que se utiliza pra asignar el id actual del vendedor
		$intVendedorIDActual = 0;
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;

		//Seleccionar los datos de los prospectos
		$otdResultado = $this->prospectos->buscar_prospectos($intModuloID, $intVendedorID, 
															 $intLocalidadID, $strMadurez);

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1= 'LISTADO DE PROSPECTOS ';
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('PROSPECTO', 'LOCALIDAD', 'DOMICILIO', utf8_decode('TELÉFONO'), 
							 	  'MADUREZ', 'ULT. VISITA');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(60, 30, 43, 18, 14, 25);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'C', 'C', 'C');
		//Establece el ancho de las columnas del vendedor
		$arrAnchuraVendedor = array(20, 170);
		//Establece la alineación de las celdas del vendedor
		$arrAlineacionVendedor = array('L', 'L');
		//Agregar la primer pagina
		$pdf->AddPage();

		//Establecer el color de fondo para la cabecera
		$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Si hay información
		if($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{
				//Variables que se utilizan para asignar datos del domicilio
				$strCalle = (($arrCol->calle !== NULL && 
							  empty($arrCol->calle) === FALSE) ?
				              $arrCol->calle : '');

				$strNumeroExterior = (($arrCol->numero_exterior !== NULL && 
							           empty($arrCol->numero_exterior) === FALSE) ?
				    		           '#'.$arrCol->numero_exterior : '');

				$strColonia = (($arrCol->colonia !== NULL && 
							 	empty($arrCol->colonia) === FALSE) ?
				    			'COL. '.$arrCol->colonia : '');

				$strCodigoPostal = (($arrCol->codigo_postal !== NULL && 
							  	    empty($arrCol->codigo_postal) === FALSE) ?
				    		        'CP '.$arrCol->codigo_postal : '');

				//Concatenar los datos del domicilio
				$strDomicilio = $strCalle.' '.$strNumeroExterior.' '.$strColonia.' '.$strCodigoPostal;

				//Si es el primer registro y no existe id del vendedor
      			if($intContador === 0 && $arrCol->vendedor_id === NULL)
      			{
					//Asignar id del vendedor actual
      				$intVendedorIDActual = $arrCol->vendedor_id;
      			}

				//Si el vendedor actual es igual a cero (primer vendedor)
	      		if ($intVendedorIDActual === 0 && $arrCol->vendedor_id > 0)
	      		{
	      			//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
					//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraVendedor);
	                //Vendedor (se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
		        	$pdf->Row(array('VENDEDOR|Negrita', utf8_decode($arrCol->vendedor)), 
							     $arrAlineacionVendedor, 'ClippedCell');
		    		//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
	      			//Asignar id del vendedor actual
	      			$intVendedorIDActual = $arrCol->vendedor_id;
	      		}

				//Si el vendedor actual es diferente al anterior
	      		if($intVendedorIDActual != $arrCol->vendedor_id && $arrCol->vendedor_id !== NULL)
	      		{
	      			$pdf->Ln(1);//Deja un salto de línea
	      			
	               //Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraVendedor);
	                //Vendedor (se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
		        	$pdf->Row(array('VENDEDOR|Negrita', utf8_decode($arrCol->vendedor)), 
							       $arrAlineacionVendedor, 'ClippedCell');
	                //Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
					$pdf->Ln(); //Deja un salto de línea
	      			//Asignar id del vendedor actual
	      			$intVendedorIDActual = $arrCol->vendedor_id;
	      		}
	      		
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				$pdf->SetTextColor(0); //Establecer el color de texto por defecto
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
                $pdf->Row(array(utf8_decode($arrCol->codigo.' - '.$arrCol->nombre_comercial),
                				utf8_decode($arrCol->localidad), utf8_decode($strDomicilio),
                				$arrCol->telefono_principal, $arrCol->madurez, $arrCol->ultima_visita),
                		        $pdf->arrAlineacion);

                //Si existe nombre del contacto o fecha de la próxima visita
                if($arrCol->contacto_nombre != '' OR $arrCol->proxima_visita != '')
                {
                	//Variables que se utiliza para asignar datos de la próxima visita
                	$strProximaVisita = (($arrCol->proxima_visita !== NULL && 
							  		      empty($arrCol->proxima_visita) === FALSE) ?
                    		              'VISITA' : '');

                    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
                    $pdf->Row(array(utf8_decode($arrCol->contacto_nombre), '', '', 
                    				$arrCol->contacto_telefono, $strProximaVisita, 
                    				$arrCol->proxima_visita), $pdf->arrAlineacion);
           		}
                
                //Si existen hobbies
                if($arrCol->contacto_hobbies != '')
                {
		    		$pdf->Cell(25, 5, utf8_decode('HOBBIES:'), 0, 0, 'L', 0);
		    		$pdf->MultiCell(165, 4, utf8_decode($arrCol->contacto_hobbies), 0, 'J', 0);
                }
	            
	            //Si existen comentarios
	            if($arrCol->comentario != '')
	            {
		    		$pdf->Cell(25, 5, utf8_decode('COMENTARIOS:'), 0, 0, 'L', 0);
		            $pdf->MultiCell(165, 4, utf8_decode($arrCol->comentario), 0, 'J', 0);
	            }
	    		//Dibuja una línea para separar la información de cada prospecto
	    		$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
                //Incrementar el contador por cada registro
            	$intContador++;
			}
		}
		//Espacios de salto de línea
        $pdf->Ln();
        //Asigna el tipo y tamaño de letra para los totales
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
        //Escribe la cadena concatenada con el total de registros
        $pdf->Cell(0,3,'TOTAL: '.$intContador, 0, 0, 'R');
        //Ejecutar la salida del reporte
        $pdf->Output('listado_prospectos'.$strModulo.'.pdf','I'); 
	}

    /*Método para generar un archivo XLS con el listado de los pospectos
	 *(con su última visita en caso de que exista) dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{	
		//Variables que se utilizan para recuperar los valores de la vista
		$intModuloID = $this->input->post('intModuloID');
		$strModulo = trim($this->input->post('strModulo'));
		$intVendedorID = $this->input->post('intVendedorID');
		$intLocalidadID = $this->input->post('intLocalidadID');
		$strMadurez = $this->input->post('strMadurez');
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
	    //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
        //Array que se utiliza para establecer los títulos de la cabecera detalles
		$arrCabeceraDet = array();
        //Variables que se utilizan para asignar el número de columna donde se empezaran a escribir los detalles 
        $intIndColDet = 33;
        $intIndColE = $intIndColDet;

		//Seleccionar los datos de los prospectos
		$otdResultado = $this->prospectos->buscar_prospectos($intModuloID, $intVendedorID, $intLocalidadID, 
															 $strMadurez); 
		//Seleccionar los datos de los módulos activos
		$otdModulos = $this->modulos->buscar(NULL, NULL, NULL, 'ACTIVO');


     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE PROSPECTOS');
	    //Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'CÓDIGO')
        		 ->setCellValue('B'.$intPosEncabezados, 'NOMBRE COMERCIAL')
        		 ->setCellValue('C'.$intPosEncabezados, 'TELÉFONO PRINCIPAL')
        		 ->setCellValue('D'.$intPosEncabezados, 'TELÉFONO SECUNDARIO')
        		 ->setCellValue('E'.$intPosEncabezados, 'CORREO ELECTRÓNICO')
        		 ->setCellValue('F'.$intPosEncabezados, 'PÁGINA WEB')
        		 ->setCellValue('G'.$intPosEncabezados, 'CALLE')
                 ->setCellValue('H'.$intPosEncabezados, 'NO. EXTERIOR')
                 ->setCellValue('I'.$intPosEncabezados, 'NO. INTERIOR')
                 ->setCellValue('J'.$intPosEncabezados, 'CÓDIGO POSTAL')
                 ->setCellValue('K'.$intPosEncabezados, 'COLONIA')
                 ->setCellValue('L'.$intPosEncabezados, 'LOCALIDAD')
                 ->setCellValue('M'.$intPosEncabezados, 'REFERENCIA')
                 ->setCellValue('N'.$intPosEncabezados, 'MUNICIPIO')
                 ->setCellValue('O'.$intPosEncabezados, 'ESTADO')
                 ->setCellValue('P'.$intPosEncabezados, 'PAÍS')
                 ->setCellValue('Q'.$intPosEncabezados, 'NOMBRE DE CONTACTO')
                 ->setCellValue('R'.$intPosEncabezados, 'FECHA DE NACIMIENTO')
                 ->setCellValue('S'.$intPosEncabezados, 'TELÉFONO DE OFICINA')
                 ->setCellValue('T'.$intPosEncabezados, 'EXTENSIÓN')
                 ->setCellValue('U'.$intPosEncabezados, 'CELULAR')
                 ->setCellValue('V'.$intPosEncabezados, 'CORREO ELECTRÓNICO')
                 ->setCellValue('W'.$intPosEncabezados, 'HOBBIES')
                 ->setCellValue('X'.$intPosEncabezados, 'CLIENTE IMPORTANTE PARA')
                 ->setCellValue('Y'.$intPosEncabezados, 'NO. HECTÁREAS TEMPORAL')
                 ->setCellValue('Z'.$intPosEncabezados, 'RIEGO')
                 ->setCellValue('AA'.$intPosEncabezados, 'OTRAS')
                 ->setCellValue('AB'.$intPosEncabezados, 'HECTÁREAS TIPO ARENOSO')
                 ->setCellValue('AC'.$intPosEncabezados, 'ARCILLOSO')
                 ->setCellValue('AD'.$intPosEncabezados, 'COMPACTO')
                 ->setCellValue('AE'.$intPosEncabezados, 'PEDREGOSO')
                 ->setCellValue('AF'.$intPosEncabezados, 'OTROS');

        //Definir estilos de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE,
    													'color' => array('rgb' => 'ffffff')));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:AF9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);


        //Verificar si existe información de módulos 
    	if($otdModulos)
    	{
    		//Hacer recorrido para obtener los datos de los módulos
			foreach ($otdModulos as $arrMod) 
			{
				//Descripción del módulo
				$arrCabeceraDet[] = 'VENDEDOR  '.$arrMod->descripcion;
			}

    	}//Cierre de verificación de módulos


    	//Agregar datos a los array de la cabecera detalles
    	$arrCabeceraDet[] = 'VENDEDOR ÚLTIMA VISITA';
    	$arrCabeceraDet[] = 'MADUREZ';
    	$arrCabeceraDet[] = 'ÚLTIMA VISITA';
    	$arrCabeceraDet[] = 'PRÓXIMA VISITA';
    	$arrCabeceraDet[] = 'COMENTARIOS';
    	$arrCabeceraDet[] = 'INVENTARIO DESCRIPCIÓN';
    	$arrCabeceraDet[] = 'AÑO';
    	$arrCabeceraDet[] = 'SERIE';
    	$arrCabeceraDet[] = 'MARCA';
    	$arrCabeceraDet[] = 'MODELO';
    	$arrCabeceraDet[] = 'HORAS';
    	$arrCabeceraDet[] = 'CABALLOS';
    	$arrCabeceraDet[] = 'TRACCIÓN';
    	$arrCabeceraDet[] = 'RECAMBIO';
    	$arrCabeceraDet[] = 'ACTIVIDAD';
    	$arrCabeceraDet[] = 'CULTIVO';
    	$arrCabeceraDet[] = 'HECTÁREAS';

    	//Hacer recorrido para obtener los datos de la cabecera detalles
    	foreach ($arrCabeceraDet as $arrDet) 
    	{
    		//Asignar columna actual
    		$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intPosEncabezados;

        	//Se agrega en el encabezado del archivo 
        	$objExcel->getActiveSheet()->setCellValue($strColActual, $arrDet);

        	 //Cambiar estilo de las siguientes celdas
	        $objExcel->getActiveSheet()
	        		 ->getStyle($strColActual)
	        		 ->applyFromArray($arrStyleBold);

	        //Cambiar alineación de las siguientes celdas
		    $objExcel->getActiveSheet()
		        	 ->getStyle($strColActual)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);

	        //Preferencias de color de relleno de celda
       		$objExcel->getActiveSheet()
    			     ->getStyle($strColActual)
    			     ->getFill()
    			     ->applyFromArray($arrStyleColumnas);

	        //Preferencias de color de texto de la celda
       	    $objExcel->getActiveSheet()
    			     ->getStyle($strColActual)
    			     ->applyFromArray($arrStyleFuenteColumnas);


		    //Incrementar indice de la columna
			$intIndColE++;  

        }//Cierre de foreach (cabecera detalles)

		//Si hay información
		if ($otdResultado)
		{	
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{   
				//Array que se utiliza para agregar los detalles 
		        $arrDetalles = array();
		        //Variable que se utiliza para asignar el número de detalles 
		        $intNumDetalles = 1;
		        //Variable que se utiliza para asignar el número de actividades
		        $intNumActividades = 0;
		        //Variable que se utiliza para asignar el número de cultivos 
		        $intNumCultivos = 0;
		        //Variable que se utiliza para asignar el número de inventarios
		        $intNumInventarios = 0;
		        //Asignar el id del prospecto
		        $intProspectoID = $arrCol->prospecto_id;

		        //Buscar la descripción de los módulos del prospecto
			    $strModulos = '';
		        //Asignar ID´s de los módulos importantes
		        $strImportante = $arrCol->importante;

		        //Si existen módulos
		        if($strImportante != '')
		        {
		        	 $arrModulosID = explode('|', $strImportante);
				    //Hacer recorrido para obtener el id de los módulos
				    foreach ($arrModulosID as &$intModuloID) 
				    {		    
					    //Seleccionar los datos del módulo
						$otdModulo = $this->modulos->buscar($intModuloID);
						//Si existe información del módulo
						if($otdModulo)
						{
							//Concatenamos la descripción del módulo a la variable de impresión
							$strModulos .= $otdModulo->descripcion.', ';

						}//Cierre de verificación del módulo
					}

					//Quitar último elemento de la cadena (,)
					$strModulos = substr($strModulos, 0, -2);
		        }
		       
			   

		        //Seleccionar los datos del inventario
				$otdInventario = $this->prospectos->buscar_inventario($intProspectoID);
				//Verificar si existe información del inventario
				if($otdInventario)
			    {
			    	//Variable que se utiliza para contar el número de inventarios
			    	$intContInv = 0;
			    	//Asignar el número de inventarios
			    	$intNumInventarios = count($otdInventario);
			    	//Si el número de inventarios es mayor que el número de detalles
					if($intNumInventarios > $intNumDetalles)
					{   
						//Asignar el número de inventarios
						$intNumDetalles = $intNumInventarios;
					}

					//Recorremos el arreglo 
			        foreach ($otdInventario as $arrInv) 
			        {
			        	//Asignar datos al array
			        	$arrDetalles[$intContInv]['descripcion']= $arrInv->descripcion;
			        	$arrDetalles[$intContInv]['anio']= $arrInv->anio;
			        	$arrDetalles[$intContInv]['serie']= $arrInv->serie;
			        	$arrDetalles[$intContInv]['maquinaria_marca']= $arrInv->maquinaria_marca;
			        	$arrDetalles[$intContInv]['maquinaria_modelo']= $arrInv->maquinaria_modelo;
			        	$arrDetalles[$intContInv]['horas']= $arrInv->horas;
			        	$arrDetalles[$intContInv]['caballos']= $arrInv->caballos;
			        	$arrDetalles[$intContInv]['traccion']= $arrInv->traccion;
			        	$arrDetalles[$intContInv]['recambio']= $arrInv->recambio;
			        	//Incrementar el contador por cada registro
                        $intContInv++;
			        }

			    }//Cierre de verificación de inventario

				//Seleccionar los datos de las actividades
				$otdActividades = $this->prospectos->buscar_actividades($intProspectoID);
				//Verificar si existe información de las actividades 
			    if($otdActividades)
			    {
			    	//Variable que se utiliza para contar el número de actividades
			    	$intContAct = 0;
			    	//Asignar el número de actividades
			    	$intNumActividades = count($otdActividades);
			    	//Si el número de actividades es mayor que el número de detalles
					if($intNumActividades > $intNumDetalles)
					{	
						//Asignar el número de actividades
						$intNumDetalles = $intNumActividades;
					}
					
					//Recorremos el arreglo 
			        foreach ($otdActividades as $arrAct) 
			        {
			        	//Asignar datos al array
			        	$arrDetalles[$intContAct]['actividad']= $arrAct->actividad;
						//Incrementar el contador por cada registro
                        $intContAct++;
			        }

			    }//Cierre de verificación de actividades

				//Seleccionar los datos de los cultivos
			    $otdCultivos = $this->prospectos->buscar_cultivos($intProspectoID);
			    //Verificar si existe información de los cultivos 
			    if($otdCultivos)
			    {
			    	//Variable que se utiliza para contar el número de cultivos
			    	$intContCult = 0;
			    	//Asignar el número de cultivos
			    	$intNumCultivos = count($otdCultivos);
			    	//Si el número de cultivos es mayor que el número de detalles
			    	if($intNumCultivos > $intNumDetalles)
					{
						//Asignar el número de cultivos
						$intNumDetalles = $intNumCultivos;
					}

					//Recorremos el arreglo 
			        foreach ($otdCultivos as $arrCult) 
			        {
			        	//Asignar datos al array
			        	$arrDetalles[$intContCult]['cultivo']= $arrCult->cultivo;
			        	$arrDetalles[$intContCult]['hectareas']= $arrCult->hectareas;
			        	//Incrementar el contador por cada registro
                        $intContCult++;
			        }

			    }//Cierre de verificación de cultivos

			    //Hacer recorrido para obtener información del registro
			    for ($intContDet = 0; $intContDet < $intNumDetalles; $intContDet++) 
			    { 
					//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
					//Agregar información del registro
					$objExcel->setActiveSheetIndex(0)
							 ->setCellValueExplicit('A'.$intFila, $arrCol->codigo, PHPExcel_Cell_DataType::TYPE_STRING)
			        		 ->setCellValue('B'.$intFila, $arrCol->nombre_comercial)
			        		 ->setCellValue('C'.$intFila, $arrCol->telefono_principal)
			        		 ->setCellValue('D'.$intFila, $arrCol->telefono_secundario)
			        		 ->setCellValue('E'.$intFila, $arrCol->correo_electronico)
			        		 ->setCellValue('F'.$intFila, $arrCol->pagina_web)
			        		 ->setCellValue('G'.$intFila, $arrCol->calle)
			                 ->setCellValue('H'.$intFila, $arrCol->numero_exterior)
			                 ->setCellValue('I'.$intFila, $arrCol->numero_interior)
			                 ->setCellValue('J'.$intFila, $arrCol->codigo_postal)
			                 ->setCellValue('K'.$intFila, $arrCol->colonia)
			                 ->setCellValue('L'.$intFila, $arrCol->localidad)
			                 ->setCellValue('M'.$intFila, $arrCol->referencia)
			                 ->setCellValue('N'.$intFila, $arrCol->municipio)
			                 ->setCellValue('O'.$intFila, $arrCol->estado)
			                 ->setCellValue('P'.$intFila, $arrCol->pais)
			                 ->setCellValue('Q'.$intFila, $arrCol->contacto_nombre)
			                 ->setCellValue('R'.$intFila, $arrCol->contacto_fecha_nacimiento)
			                 ->setCellValue('S'.$intFila, $arrCol->contacto_telefono)
			                 ->setCellValue('T'.$intFila, $arrCol->contacto_extension)
			                 ->setCellValue('U'.$intFila, $arrCol->contacto_celular)
			                 ->setCellValue('V'.$intFila, $arrCol->contacto_correo_electronico)
			                 ->setCellValue('W'.$intFila, $arrCol->contacto_hobbies)
			                 ->setCellValue('X'.$intFila, $strModulos)
			                 ->setCellValue('Y'.$intFila, $arrCol->hectareas_temporal)
			                 ->setCellValue('Z'.$intFila, $arrCol->hectareas_riego)
			                 ->setCellValue('AA'.$intFila, $arrCol->hectareas_otras)
			                 ->setCellValue('AB'.$intFila, $arrCol->terreno_arenoso)
			                 ->setCellValue('AC'.$intFila, $arrCol->terreno_arcilloso)
			                 ->setCellValue('AD'.$intFila, $arrCol->terreno_compacto)
			                 ->setCellValue('AE'.$intFila, $arrCol->terreno_pedregoso)
			                 ->setCellValue('AF'.$intFila, $arrCol->terreno_otros);

			        //Inicializar variable para escribir los detalles del prospecto
					$intIndColE = $intIndColDet;

					//Verificar si existe información de módulos 
					if($otdModulos)
		        	{
		        		//Hacer recorrido para obtener los datos del vendedor
						foreach ($otdModulos as $arrMod) 
						{
							
						    //Seleccionar los datos del vendedor asignado al módulo
						    $otdVendedor = $this->prospectos->buscar_vendedores_prospecto($intProspectoID, $arrMod->modulo_id);
						    //Tomar primer elemento del array
							$otdVendedor = $otdVendedor[0]; 
							//Si existe información del vendedor
						    if($otdVendedor)
						    {
						    	//Asignar columna actual
						   		$strColActual = $this->ARR_COLUMNAS[$intIndColE].$intFila;

						    	//Agregar información del vendedor
								$objExcel->getActiveSheet()
				                    	 ->setCellValue($strColActual, $otdVendedor->vendedor);

						    }//Cierre de verificación de vendedor en el módulo

				            //Incrementar indice de la columna
							$intIndColE++;  

						}//Cierre de foreach

		        	}//Cierre de verificación de módulos

		        	//Agregar información de la última visita
				    $objExcel->setActiveSheetIndex(0)
				   			 ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intFila, $arrCol->vendedor)
		                 	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+1].$intFila, $arrCol->madurez)
		                 	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+2].$intFila, $arrCol->ultima_visita)
		                 	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+3].$intFila, $arrCol->proxima_visita)
		                 	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+4].$intFila, $arrCol->comentario);

		           	//Cambiar alineación de las siguientes celdas
		            $objExcel->getActiveSheet()
		                	 ->getStyle($this->ARR_COLUMNAS[$intIndColE+1].$intFila.':'.
		                	 			$this->ARR_COLUMNAS[$intIndColE+3].$intFila)
		                	 ->getAlignment()
		                	 ->applyFromArray($arrStyleAlignmentCenter);

		            //Incrementar indice de la columna (sumar el número de columnas correspondientes a la última visita)
		            $intIndColE = $intIndColE+5;


			        //Si existen inventarios
		            if($intNumInventarios > 0)
		            {
		            	//Agregar información del inventario
						$objExcel->setActiveSheetIndex(0)
					        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intFila, $arrDetalles[$intContDet]['descripcion'])
					        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+1].$intFila, $arrDetalles[$intContDet]['anio'])
					        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+2].$intFila, $arrDetalles[$intContDet]['serie'])
					        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+3].$intFila, $arrDetalles[$intContDet]['maquinaria_marca'])
					        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+4].$intFila, $arrDetalles[$intContDet]['maquinaria_modelo'])
					        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+5].$intFila, $arrDetalles[$intContDet]['horas'])
					        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+6].$intFila, $arrDetalles[$intContDet]['caballos'])
					        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+7].$intFila, $arrDetalles[$intContDet]['traccion'])
					        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE+8].$intFila, $arrDetalles[$intContDet]['recambio']);

					    //Decrementar el número de inventarios
					    $intNumInventarios --;
		            }

		            //Incrementar indice de la columna (sumar el número de columnas correspondientes al inventario)
			        $intIndColE = $intIndColE+9;

		            //Si existen actividades
		            if($intNumActividades > 0)
		            {
		            	//Agregar información de la actividad
						$objExcel->setActiveSheetIndex(0)
					        	 ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intFila, $arrDetalles[$intContDet]['actividad']);

					    //Decrementar el número de actividades
					    $intNumActividades --;
		            }

		            //Incrementar indice de la columna (sumar el número de columnas correspondientes a las actividades)
			        $intIndColE++;

		            //Si existen cultivos
		            if($intNumCultivos > 0)
		            {
		            	//Agregar información del cultivo
						$objExcel->setActiveSheetIndex(0)
						 		 ->setCellValue($this->ARR_COLUMNAS[$intIndColE].$intFila, $arrDetalles[$intContDet]['cultivo'])
					             ->setCellValue($this->ARR_COLUMNAS[$intIndColE+1].$intFila, $arrDetalles[$intContDet]['hectareas']);


			            //Cambiar contenido de la celda a formato númerico de 2 decimales
				        $objExcel->getActiveSheet()
				                 ->getStyle($this->ARR_COLUMNAS[$intIndColE+1].$intFila)
				                 ->getNumberFormat()
        		 				 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

				        //Cambiar alineación de la celda
			            $objExcel->getActiveSheet()
			                	 ->getStyle($this->ARR_COLUMNAS[$intIndColE+1].$intFila)
			                	 ->getAlignment()
			                	 ->applyFromArray($arrStyleAlignmentRight);

					    //Decrementar el número de cultivos
					    $intNumCultivos --;
		            }
					
					//Incrementar el indice para escribir los datos del siguiente registro
	                $intFila++; 
	            }

	            //Incrementar el contador por cada registro
			    $intContador++;
			}

			//Cambiar contenido de las celdas a formato númerico
            $objExcel->getActiveSheet()
            		 ->getStyle('Y'.$intFilaInicial.':'.'AF'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

			//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('R'.$intFilaInicial.':'.'R'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentCenter);


            $objExcel->getActiveSheet()
                	 ->getStyle('Y'.$intFilaInicial.':'.'AF'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

            //Incrementar el indice para escribir el total
            $intFila++;
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0) //COMENTARIO
                     ->setCellValue('AF'.$intFila,  'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('AF'.$intFila)
            		 ->applyFromArray($arrStyleBold);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'listado_prospectos_'.$strModulo.'.xls', 'prospectos', 
        								    $intFila);
	}
}