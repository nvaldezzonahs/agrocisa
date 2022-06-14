<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_comisiones extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
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
		$this->cargar_vista('maquinaria/rep_comisiones', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el listado de las próximas visitas 
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte($strModulo, $intVendedorID, $dteFechaInicial, $dteFechaFinal) 
	{	        
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
        //Variable que se utiliza pra asignar el id actual del vendedor
		$intVendedorIDActual = 0;
        //Variable que se utiliza para definir título de rango de fechas
        $strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Variable que se utiliza para contar el número de registros por vendedor
		$intTotalVisitasVendedor = 0;
		//Si existe rango de fechas
   		if($dteFechaInicial !== '0000-00-00' &&  $dteFechaFinal !== '0000-00-00')
   		{
   			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
   			$strTituloRangoFechas  = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C').' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
   		}

		//Seleccionar los datos de las próximas visitas a los prospectos
		$otdResultado = $this->prospectos->buscar_agenda($dteFechaInicial, $dteFechaFinal, $strModulo, 
													     $intVendedorID); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1= 'LISTADO DE VISITAS A PROSPECTOS '.$strTituloRangoFechas;
		//Agregar la primer pagina
		$pdf->AddPage();
		//Crea los titulos de la cabecera
		$arrCabecera = array('PROSPECTO', 'LOCALIDAD', 'DOMICILIO', utf8_decode('TELÉFONO'),
						     'MADUREZ','VISITA');
		//Establece el ancho de las columnas de cabecera
		$arrAchura = array(65, 30, 43, 18, 14, 20);
		//Establece la alineación de las celdas de la tabla
		$arrAlineacion = array('L', 'L', 'L', 'C', 'C', 'C');
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
      				//Asigna el tipo y tamaño de letra para la cabecera de la tabla
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Recorre el array de titulos de encabezado para crearlos
					for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
					{
						//Establecer el color de fondo para la cabecera
						$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
						$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
						$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
						//inserta los titulos de la cabecera
						$pdf->Cell($arrAchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, 
								   $arrAlineacion[$intCont], TRUE);
					}
					$pdf->Ln(); //Deja un salto de línea
					//Asignar id del vendedor actual
      				$intVendedorIDActual = $arrCol->vendedor_id;
      			}


				//Si el vendedor actual es igual a cero (primer vendedor)
	      		if ($intVendedorIDActual === 0 && $arrCol->vendedor_id > 0)
	      		{
	      			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					//Nombre del vendedor
					$pdf->Cell(20, 5, 'VENDEDOR', 0, 0, 'L', 0);
					//Asigna el tipo y tamaño de letra
		            $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		    		$pdf->ClippedCell(170, 5, utf8_decode($arrCol->vendedor), 0, 1, 'L', 0);
		    		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Recorre el array de titulos de encabezado para crearlos
					for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
					{
						//Establecer el color de fondo para la cabecera
						$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
						$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
						$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
						//inserta los titulos de la cabecera
						$pdf->Cell($arrAchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, $arrAlineacion[$intCont], TRUE);
					}
					$pdf->Ln(); //Deja un salto de línea
	      			//Limpiar las siguientes variables (por cada vendedor recorrido)
      				$intVendedorIDActual = $arrCol->vendedor_id;
      				$intTotalVisitasVendedor = 0;
	      		}

				//Si el vendedor actual es diferente al anterior
	      		if($intVendedorIDActual != $arrCol->vendedor_id && $arrCol->vendedor_id !== NULL)
	      		{
					$pdf->Ln();//Deja un salto de línea
					//Asigna el tipo y tamaño de letra para los totales
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Escribe la cadena concatenada con el total de registros
					$pdf->Cell(0,3,'VISITAS: '.$intTotalVisitasVendedor, 0, 0, 'R');
	      			$pdf->Ln(4); //Deja un salto de línea
	      			//Asigna el tipo y tamaño de letra para la cabecera de la tabla
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
					//Nombre del vendedor
					$pdf->Cell(20, 5, 'VENDEDOR', 0, 0, 'L', 0);
					//Asigna el tipo y tamaño de letra
		            $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_SUBTITULO_PDF);
		    		$pdf->ClippedCell(170, 5, utf8_decode($arrCol->vendedor), 0, 1, 'L', 0);
		    		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Recorre el array de titulos de encabezado para crearlos
					for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
					{
						//Establecer el color de fondo para la cabecera
						$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
						$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
						$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
						//inserta los titulos de la cabecera
						$pdf->Cell($arrAchura[$intCont], 7, $arrCabecera[$intCont], 1, 0, $arrAlineacion[$intCont], TRUE);
					}
					$pdf->Ln(); //Deja un salto de línea
	      			//Limpiar las siguientes variables (por cada vendedor recorrido)
	      			$intVendedorIDActual = $arrCol->vendedor_id;
	      			$intTotalVisitasVendedor = 0;
	      		}
	      		
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAchura);
				$pdf->SetTextColor(0); //Establecer el color de texto por defecto
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
                $pdf->Row(array(utf8_decode($arrCol->codigo.' - '.$arrCol->nombre_comercial),
                				utf8_decode($arrCol->localidad), utf8_decode($strDomicilio),
                				$arrCol->telefono_principal, $arrCol->madurez, $arrCol->proxima_visita),
                		        $arrCabecera, $arrAchura, $arrAlineacion, FALSE, FALSE, $arrAlineacion);

                 //Si existe nombre del contacto
                if($arrCol->contacto_nombre != '')
                {
                    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
                    $pdf->Row(array(utf8_decode($arrCol->contacto_nombre), '', '', 
                    				$arrCol->contacto_telefono, '', ''), $arrCabecera, $arrAchura, 
                    				$arrAlineacion, FALSE, FALSE, $arrAlineacion);
           		}
                
                //Si existen hobbies
                if($arrCol->hobbies != '')
                {
		    		$pdf->Cell(25, 5, utf8_decode('HOBBIES:'), 0, 0, 'L', 0);
		    		$pdf->MultiCell(165, 4, utf8_decode($arrCol->hobbies), 0, 'J', 0);
                }
	            
	            //Si existen comentarios
	            if($arrCol->comentario != '')
	            {
		    		$pdf->Cell(25, 5, utf8_decode('COMENTARIOS:'), 0, 0, 'L', 0);
		            $pdf->MultiCell(165, 4, utf8_decode($arrCol->comentario), 0, 'J', 0);
	            }
	            $pdf->Ln(8); //Deja un salto de línea
	    		//Dibuja una línea para separar la información de cada prospecto
	    		$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
                //Incrementar el contador por cada registro
            	$intContador++;
            	//Incrementar el contador por cada vendedor
				$intTotalVisitasVendedor++;
			}

			//Escribir las visitas del último vendedor
	   		if($intVendedorIDActual > 0)
			{
				$pdf->Ln();//Deja un salto de línea
				//Asigna el tipo y tamaño de letra para los totales
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Escribe la cadena concatenada con el total de registros
				$pdf->Cell(0,3,'VISITAS: '.$intTotalVisitasVendedor, 0, 0, 'R');
			}
		}
		//Espacios de salto de línea
        $pdf->Ln();
        //Asigna el tipo y tamaño de letra para los totales
        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
        //Escribe la cadena concatenada con el total de registros
        $pdf->Cell(0,3,'VISITAS TOTALES: '.$intContador, 0, 0, 'R');
        //Ejecutar la salida del reporte
        $pdf->Output('impresion_agenda'.$strModulo.'.pdf','I'); 
	}

    /*Método para generar un archivo XLS con el listado de las próximas visitas 
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls($strModulo, $intVendedorID, $dteFechaInicial, $dteFechaFinal) 
	{	
		//Variable que se utiliza para definir título de rango de fechas
        $strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Si existe rango de fechas
   		if($dteFechaInicial !== '0000-00-00' &&  $dteFechaFinal !== '0000-00-00')
   		{
   			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
   			$strTituloRangoFechas  = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C').' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');
   		}
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
		//Seleccionar los datos de las próximas visitas a los prospectos
		$otdResultado = $this->prospectos->buscar_agenda($dteFechaInicial, $dteFechaFinal, $strModulo, 
													     $intVendedorID); 
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/crm/archivos_excel/impresion_agenda.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE VISITAS A PROSPECTOS '.$strTituloRangoFechas);

		//Definir estilo de las celdas que apareceran en negrita
        $arrStyleTotal = array('font'=> array('bold'=> TRUE));

		//Si hay información
		if ($otdResultado)
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

				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
					     ->setCellValue('A'.$intFila, $arrCol->vendedor)
						 ->setCellValueExplicit('B'.$intFila, $arrCol->codigo.' - '.$arrCol->nombre_comercial, PHPExcel_Cell_DataType::TYPE_STRING)
					     ->setCellValue('C'.$intFila, $arrCol->localidad)
					     ->setCellValue('D'.$intFila, $strDomicilio)
					     ->setCellValue('E'.$intFila, $arrCol->telefono_principal)
						 ->setCellValue('F'.$intFila, $arrCol->madurez)
						 ->setCellValue('G'.$intFila, $arrCol->proxima_visita)
						 ->setCellValue('H'.$intFila, $arrCol->comentario)
						 ->setCellValue('I'.$intFila, $arrCol->contacto_nombre)
						 ->setCellValue('J'.$intFila, $arrCol->contacto_telefono)
						 ->setCellValue('K'.$intFila, $arrCol->hobbies);
				//Incrementar el contador por cada registro
				$intContador++;
				//Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Incrementar el indice para escribir el total
            $intFila++; 
            //Agregar información del total
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('K'.$intFila, 'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('K'.$intFila)
            		 ->applyFromArray($arrStyleTotal);
		}
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'impresion_agenda_'.$strModulo.'.xls', 'visitas', 
        								    $intFila);
	}
}