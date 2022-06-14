<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_agenda extends MY_Controller {
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
		$this->cargar_vista('crm/rep_agenda', $arrDatos);
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
	public function get_reporte() 
	{	        
		
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intModuloID = $this->input->post('intModuloID');
		$strModulo = trim($this->input->post('strModulo'));
		$intVendedorID = $this->input->post('intVendedorID');
        //Variable que se utiliza pra asignar el id actual del vendedor
		$intVendedorIDActual = 0;
		//Variable que se utiliza pra asignar el id actual del prospecto
		$intProspectoIDActual = 0;
        //Variable que se utiliza para definir título de rango de fechas
        $strTituloRangoFechas = '';
        //Variable que se utiliza para definir título de meses y días del rango de fechas
        $strTituloMesDiaRangoFechas = '';
        //Variable que se utiliza para definir título de meses del rango de fechas
        $strTituloMesRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Variable que se utiliza para contar el número de registros por vendedor
		$intTotalVisitasVendedor = 0;
		//Variable que se utiliza para contar el número de cultivos por prospecto
		$intTotalCultivosProspecto = 0;

		//Si existe rango de fechas
   		if($dteFechaInicial != '' && $dteFechaFinal  != '')
   		{
   			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
   			$strTituloRangoFechas  = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
   			$strTituloRangoFechas  .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');


   			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16 DE OCTUBRE
   			$strTituloMesDiaRangoFechas  = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'MDIA');
   			$strTituloMesDiaRangoFechas  .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'MDIA');

   			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a OCTUBRE
   			$strTituloMesRangoFechas  = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'M');
   			$strTituloMesRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'M');

   			//Seleccionar los datos de los prospectos que cumplen años en el rango de fechas (mes y día)
			$otdFechasNacimiento = $this->prospectos->buscar_agenda($dteFechaInicial, $dteFechaFinal, 
																     $intModuloID, $intVendedorID, 
																     'fecha_nacimiento');
			//Seleccionar los datos de los cultivos en el rango de fechas (mes)
			$otdCultivos = $this->prospectos->buscar_agenda($dteFechaInicial, $dteFechaFinal, 
															$intModuloID, $intVendedorID, 'cultivos');
   		}


		//Seleccionar los datos de las próximas visitas a los prospectos
		$otdResultado = $this->prospectos->buscar_agenda($dteFechaInicial, $dteFechaFinal, 
														  $intModuloID, $intVendedorID); 

		

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
	   //Crea los titulos de la cabecera
		$pdf->arrCabecera = array('PROSPECTO', 'LOCALIDAD', 'DOMICILIO', utf8_decode('TELÉFONO'), 
						          'MADUREZ','VISITA');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(60, 30, 43, 18, 14, 25);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'C', 'C', 'C');
		//Establece el ancho de las columnas del vendedor
		$arrAnchuraVendedor = array(20, 170);
		//Establece la alineación de las celdas del vendedor
		$arrAlineacionVendedor = array('L', 'L');
		//Establece el ancho de las columnas del cultivo
		$arrAnchuraCultivo = array(25, 75, 15, 25, 15, 25);
		//Establece la alineación de las celdas del cultivo
		$arrAlineacionCultivo = array('L', 'L', 'L', 'L', 'L', 'L');
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

	      			//Limpiar las siguientes variables (por cada vendedor recorrido)
      				$intVendedorIDActual = $arrCol->vendedor_id;
      				$intTotalVisitasVendedor = 0;
	      		}

				//Si el vendedor actual es diferente al anterior
	      		if($intVendedorIDActual != $arrCol->vendedor_id && $arrCol->vendedor_id !== NULL)
	      		{
					$pdf->Ln(1);//Deja un salto de línea
					//Asigna el tipo y tamaño de letra para los totales
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Escribe la cadena concatenada con el total de registros
					$pdf->Cell(0,3,'VISITAS: '.$intTotalVisitasVendedor, 0, 0, 'R');
	      			$pdf->Ln(4); //Deja un salto de línea
	      			//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
	      			//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraVendedor);
	                //Vendedor (se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
		        	$pdf->Row(array('VENDEDOR|Negrita', utf8_decode($arrCol->vendedor)), 
							     $arrAlineacionVendedor, 'ClippedCell');
		    		//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
					$pdf->Ln(1); //Deja un salto de línea
	      			//Limpiar las siguientes variables (por cada vendedor recorrido)
	      			$intVendedorIDActual = $arrCol->vendedor_id;
	      			$intTotalVisitasVendedor = 0;
	      		}
	      		
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				$pdf->SetTextColor(0); //Establecer el color de texto por defecto
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
                $pdf->Row(array(utf8_decode($arrCol->codigo.' - '.$arrCol->nombre_comercial),
                				utf8_decode($arrCol->localidad), utf8_decode($strDomicilio),
                				$arrCol->telefono_principal, $arrCol->madurez, $arrCol->proxima_visita),
                		        $pdf->arrAlineacion);

                 //Si existe nombre del contacto
                if($arrCol->contacto_nombre != '')
                {
                    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
                    $pdf->Row(array(utf8_decode($arrCol->contacto_nombre), '', '', 
                    				$arrCol->contacto_telefono, '', ''), 
                    				$pdf->arrAlineacion);
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
	    		$pdf->Ln(1); //Deja un salto de línea
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

        //Verificar si hay información de las fechas de nacimiento
   		if($dteFechaInicial != '' &&  $dteFechaFinal != '' && $otdFechasNacimiento)
		{	
			//Asignar el valor de la descripción (título de la lista de registros) del reporte
			$pdf->strLinea1 = utf8_decode('LISTADO DE PROSPECTOS QUE CUMPLEN AÑOS ').$strTituloMesDiaRangoFechas;
			//Agregar pagina
			$pdf->AddPage();
			//Inicializar variables
			$intVendedorIDActual = 0;
			$intContador = 0;
			$intTotalVisitasVendedor = 0;

			//Recorremos el arreglo 
			foreach ($otdFechasNacimiento as $arrCol)
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

	      			//Limpiar las siguientes variables (por cada vendedor recorrido)
      				$intVendedorIDActual = $arrCol->vendedor_id;
      				$intTotalVisitasVendedor = 0;
	      		}

				//Si el vendedor actual es diferente al anterior
	      		if($intVendedorIDActual != $arrCol->vendedor_id && $arrCol->vendedor_id !== NULL)
	      		{
					$pdf->Ln(1);//Deja un salto de línea
					//Asigna el tipo y tamaño de letra para los totales
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Escribe la cadena concatenada con el total de registros
					$pdf->Cell(0,3,'VISITAS: '.$intTotalVisitasVendedor, 0, 0, 'R');
	      			$pdf->Ln(4); //Deja un salto de línea
	      			//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
	      			//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraVendedor);
	                //Vendedor (se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
		        	$pdf->Row(array('VENDEDOR|Negrita', utf8_decode($arrCol->vendedor)), 
							        $arrAlineacionVendedor, 'ClippedCell');
		    		//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
					$pdf->Ln(1); //Deja un salto de línea
	      			//Limpiar las siguientes variables (por cada vendedor recorrido)
	      			$intVendedorIDActual = $arrCol->vendedor_id;
	      			$intTotalVisitasVendedor = 0;
	      		}
	      		
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				$pdf->SetTextColor(0); //Establecer el color de texto por defecto
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
                $pdf->Row(array(utf8_decode($arrCol->codigo.' - '.$arrCol->nombre_comercial),
                				utf8_decode($arrCol->localidad), utf8_decode($strDomicilio),
                				$arrCol->telefono_principal, $arrCol->madurez, $arrCol->proxima_visita),
                		        $pdf->arrAlineacion);

                 //Si existe nombre del contacto
                if($arrCol->contacto_nombre != '')
                {
                    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
                    $pdf->Row(array(utf8_decode($arrCol->contacto_nombre), '', '', 
                    				$arrCol->contacto_telefono, '', ''),  
                    				$pdf->arrAlineacion);
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

	            //Fecha de nacimiento
	            $pdf->Cell(25, 5, utf8_decode('FECHA DE NAC.:'), 0, 0, 'L', 0);
	            $pdf->MultiCell(165, 4, utf8_decode($arrCol->fecha_nacimiento), 0, 'J', 0);
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

			//Espacios de salto de línea
	        $pdf->Ln();
	        //Asigna el tipo y tamaño de letra para los totales
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
	        //Escribe la cadena concatenada con el total de registros
	        $pdf->Cell(0,3,'VISITAS TOTALES: '.$intContador, 0, 0, 'R');

		}//Cierre de verificación de fechas de nacimiento


		//Verificar si hay información de los cultivos
   		if($dteFechaInicial != '' &&  $dteFechaFinal != '' && $otdCultivos)
		{	
			//Asignar el valor de la descripción (título de la lista de registros) del reporte
			$pdf->strLinea1 = utf8_decode('LISTADO DE PROSPECTOS CON CULTIVO ').$strTituloMesRangoFechas;
			//Agregar pagina
			$pdf->AddPage();
			//Inicializar variables
			$intVendedorIDActual = 0;
			$intProspectoIDActual = 0;
			$intContador = 0;
			$intTotalVisitasVendedor = 0;
			$intTotalCultivosProspecto = 0;

			//Recorremos el arreglo 
			foreach ($otdCultivos as $arrCol)
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

	      			//Limpiar las siguientes variables (por cada vendedor recorrido)
      				$intVendedorIDActual = $arrCol->vendedor_id;
      				$intTotalVisitasVendedor = 0;
	      		}

				//Si el vendedor actual es diferente al anterior
	      		if($intVendedorIDActual != $arrCol->vendedor_id && $arrCol->vendedor_id !== NULL)
	      		{
					$pdf->Ln(1);//Deja un salto de línea
					//Asigna el tipo y tamaño de letra para los totales
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Escribe la cadena concatenada con el total de registros
					$pdf->Cell(0,3,'VISITAS: '.$intTotalVisitasVendedor, 0, 0, 'R');
	      			$pdf->Ln(4); //Deja un salto de línea
	      			//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
	      			//Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraVendedor);
	                //Vendedor (se concatena |Negrita -> para cambiar el volumen de la fuente a bold)
		        	$pdf->Row(array('VENDEDOR|Negrita', utf8_decode($arrCol->vendedor)), 
							        $arrAlineacionVendedor, 'ClippedCell');
		    		//Dibuja una línea para separar la información
	    			$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
					$pdf->Ln(1); //Deja un salto de línea
	      			//Limpiar las siguientes variables (por cada vendedor recorrido)
	      			$intVendedorIDActual = $arrCol->vendedor_id;
	      			$intTotalVisitasVendedor = 0;
	      		}
	      		
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				$pdf->SetTextColor(0); //Establecer el color de texto por defecto
				
	            //Si el prospecto actual es igual a cero (primer prospecto)
	      		if ($intProspectoIDActual === 0)
	      		{
	      			//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
	                $pdf->Row(array(utf8_decode($arrCol->codigo.' - '.$arrCol->nombre_comercial),
	                				utf8_decode($arrCol->localidad), utf8_decode($strDomicilio),
	                				$arrCol->telefono_principal, $arrCol->madurez, $arrCol->proxima_visita),
	                		        $pdf->arrAlineacion);

	                 //Si existe nombre del contacto
	                if($arrCol->contacto_nombre != '')
	                {
	                    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
	                    $pdf->Row(array(utf8_decode($arrCol->contacto_nombre), '', '', 
	                    				$arrCol->contacto_telefono, '', ''),  
	                    				$pdf->arrAlineacion);
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

		            //Asignar id del prospecto actual
	      			$intProspectoIDActual = $arrCol->prospecto_id;
	      			//Incrementar el contador por cada vendedor
					$intTotalVisitasVendedor++;
					//Incrementar el contador por cada prospecto
            		$intContador++;
	      		}

	      		//Si el prospecto actual es diferente al anterior
	      		if ($intProspectoIDActual != $arrCol->prospecto_id)
	      		{
	      			//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
	                $pdf->Row(array(utf8_decode($arrCol->codigo.' - '.$arrCol->nombre_comercial),
	                				utf8_decode($arrCol->localidad), utf8_decode($strDomicilio),
	                				$arrCol->telefono_principal, $arrCol->madurez, $arrCol->proxima_visita),
	                		        $pdf->arrAlineacion);

	                 //Si existe nombre del contacto
	                if($arrCol->contacto_nombre != '')
	                {
	                    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
	                    $pdf->Row(array(utf8_decode($arrCol->contacto_nombre), '', '', 
	                    				$arrCol->contacto_telefono, '', ''),
	                    				$pdf->arrAlineacion);
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

	      			//Asignar id del prospecto actual
	      			$intProspectoIDActual = $arrCol->prospecto_id;
	      			//Incrementar el contador por cada vendedor
					$intTotalVisitasVendedor++;
					//Incrementar el contador por cada prospecto
            		$intContador++;
            		//Inicializar contador de cultivos
            		$intTotalCultivosProspecto = 0;
            		
	      		}

	      		//Incrementar el contador por cada registro
	      		$intTotalCultivosProspecto++;

	      		//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchuraCultivo);
	      		//Cultivo
      		    $pdf->Row(array('CULTIVO:', utf8_decode($arrCol->cultivo), 
      		  				    'SIEMBRA:', utf8_decode($arrCol->siembra),
      		  				    'COSECHA:', utf8_decode($arrCol->cosecha)),
                    		    $arrAlineacionCultivo, 'ClippedCell');


	      		//Si el total de cultivos es igual al contador
	      		if($intTotalCultivosProspecto == $arrCol->total_cultivos)
	      		{
	      			//Dibuja una línea para separar la información de cada prospecto
		    		$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); 
	      		}
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

			//Espacios de salto de línea
	        $pdf->Ln();
	        //Asigna el tipo y tamaño de letra para los totales
	        $pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
	        //Escribe la cadena concatenada con el total de registros
	        $pdf->Cell(0,3,'VISITAS TOTALES: '.$intContador, 0, 0, 'R');

		}//Cierre de verificación de cultivos

        //Ejecutar la salida del reporte
        $pdf->Output('impresion_agenda'.$strModulo.'.pdf','I'); 
	}

    /*Método para generar un archivo XLS con el listado de las próximas visitas 
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls() 
	{	

		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$intModuloID = $this->input->post('intModuloID');
		$strModulo = trim($this->input->post('strModulo'));
		$intVendedorID = $this->input->post('intVendedorID');
		//Variable que se utiliza para contar el número de hojas
		$intContadorHojas = 0;
		//Variable que se utiliza para definir título de rango de fechas
        $strTituloRangoFechas = '';
        //Variable que se utiliza para definir título de meses y días del rango de fechas
        $strTituloMesDiaRangoFechas = '';
        //Variable que se utiliza para definir título de meses del rango de fechas
        $strTituloMesRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Variable que se utiliza para asignar el número máximo de registros (evitar que la fecha de impresión tome como última fila el número de registros de la última hoja)
		$intNumMaxRegistros = 0;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;

		//Si existe rango de fechas
   		if($dteFechaInicial != '' &&  $dteFechaFinal != '')
   		{
   			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16/OCT/2017 
   			$strTituloRangoFechas  = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
   			$strTituloRangoFechas  .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

   			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo: 2017-10-16 a 16 DE OCTUBRE
   			$strTituloMesDiaRangoFechas  = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'MDIA');
   			$strTituloMesDiaRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'MDIA');

   			//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
			//por ejemplo:  2017-10-16 a OCTUBRE
   			$strTituloMesRangoFechas  = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'M');
   			$strTituloMesRangoFechas  .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'M');

   			//Seleccionar los datos de los prospectos que cumplen años en el rango de fechas (mes y día)
			$otdFechasNacimiento = $this->prospectos->buscar_agenda($dteFechaInicial, $dteFechaFinal, 
															        $intModuloID, $intVendedorID, 'fecha_nacimiento'); 

			//Seleccionar los datos de los cultivos en el rango de fechas (mes)
			$otdCultivos = $this->prospectos->buscar_agenda($dteFechaInicial, $dteFechaFinal, 
														    $intModuloID, $intVendedorID, 'cultivos');
   		}

		//Seleccionar los datos de las próximas visitas a los prospectos
		$otdResultado = $this->prospectos->buscar_agenda($dteFechaInicial, $dteFechaFinal, $intModuloID, 
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

		//Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnasPrinc = array('font' => array('bold' => TRUE,
        												     'name' => 'Arial',
        												     'size' => 9,
    													     'color' => array('rgb' => 'ffffff')));

        $arrStyleFuenteColumnasSec = array('font' => array('name' => 'Arial',
        												   'size' => 9));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo para alinear a la izquierda el contenido de la celda
        $arrStyleAlignmentLeft = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
        		 ->getStyle('A9:K9')
        		 ->getFill()
        		 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdResultado)
		{	
		    //Asignar el nombre de la hoja
			$strNombreHoja = 'visitas';

			//Hacer un llamado a la función para agregar (o activar) una hoja en el archivo excel
			$intContadorHojas = $this->get_hoja_archivo_excel($objExcel, $strNombreHoja, $intContadorHojas);

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
				$objExcel->getActiveSheet()
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
						 ->setCellValue('K'.$intFila, $arrCol->contacto_hobbies);
				//Incrementar el contador por cada registro
				$intContador++;
				//Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Incrementar el indice para escribir el total
            $intFila++; 
            //Agregar información del total
            $objExcel->getActiveSheet()
                     ->setCellValue('K'.$intFila, 'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()
            		 ->getStyle('K'.$intFila)
            		 ->applyFromArray($arrStyleBold);

           	//Si el número de registros (por cada hoja) es mayor que el número máximo de registros 
		    if($intFila > $intNumMaxRegistros)
            {
            	//Asignar número de registros
            	$intNumMaxRegistros = $intFila;
            }

		}//Cierre de verificación de visitas


		//Verificar si hay información de las fechas de nacimiento
   		if($dteFechaInicial != '' &&  $dteFechaFinal != '' && $otdFechasNacimiento)
		{

			//Inicializar variables
			$intFila = 10;
			$intContador = 0;
			//Incrementar contador por cada hoja nueva
			$intContadorHojas++;

			//Asignar el nombre de la hoja
			$strNombreHoja = 'cumpleanos_prospectos';

			//Hacer un llamado a la función para agregar (o activar) una hoja en el archivo excel
			$intContadorHojas = $this->get_hoja_archivo_excel($objExcel, $strNombreHoja, $intContadorHojas);

			//Se agrega el título del archivo
			$objExcel->getActiveSheet()
					 ->setCellValue('A7', 'LISTADO DE PROSPECTOS QUE CUMPLEN AÑOS '.$strTituloMesDiaRangoFechas);
			

			//Se agregan las columnas de cabecera
        	$objExcel->getActiveSheet()
        	         ->setCellValue('A'.$intPosEncabezados, 'VENDEDOR')
        		 	 ->setCellValue('B'.$intPosEncabezados, 'PROSPECTO')
        		     ->setCellValue('C'.$intPosEncabezados, 'LOCALIDAD')
                     ->setCellValue('D'.$intPosEncabezados, 'DOMICILIO')
                     ->setCellValue('E'.$intPosEncabezados, 'TELÉFONO')
                     ->setCellValue('F'.$intPosEncabezados, 'MADUREZ')
                     ->setCellValue('G'.$intPosEncabezados, 'VISITA')
                     ->setCellValue('H'.$intPosEncabezados, 'COMENTARIOS')
                     ->setCellValue('I'.$intPosEncabezados, 'NOMBRE DEL CONTACTO')
                     ->setCellValue('J'.$intPosEncabezados, 'FECHA DE NACIMIENTO')
                     ->setCellValue('K'.$intPosEncabezados, 'TELÉFONO')
                     ->setCellValue('L'.$intPosEncabezados, 'HOBBIES');


	        //Preferencias de color de relleno de celda 
            $objExcel->getActiveSheet()
            		 ->getStyle('A9:L9')
			         ->getFill()
			         ->applyFromArray($arrStyleColumnas);

    		//Preferencias de color de texto de la celda 
			$objExcel->getActiveSheet()
    				 ->getStyle('A9:L9')
    			     ->applyFromArray($arrStyleFuenteColumnasPrinc);


    		//Recorremos el arreglo 
			foreach ($otdFechasNacimiento as $arrCol)
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
				$objExcel->getActiveSheet()
						 ->setCellValue('A'.$intFila, $arrCol->vendedor)
					     ->setCellValueExplicit('B'.$intFila, $arrCol->codigo.' - '.$arrCol->nombre_comercial, PHPExcel_Cell_DataType::TYPE_STRING)
				         ->setCellValue('C'.$intFila, $arrCol->localidad)
				         ->setCellValue('D'.$intFila, $strDomicilio)
				         ->setCellValue('E'.$intFila, $arrCol->telefono_principal)
					     ->setCellValue('F'.$intFila, $arrCol->madurez)
					     ->setCellValue('G'.$intFila, $arrCol->proxima_visita)
					     ->setCellValue('H'.$intFila, $arrCol->comentario)
					     ->setCellValue('I'.$intFila, $arrCol->contacto_nombre)
					     ->setCellValue('J'.$intFila, $arrCol->fecha_nacimiento)
					     ->setCellValue('K'.$intFila, $arrCol->contacto_telefono)
					     ->setCellValue('L'.$intFila, $arrCol->contacto_hobbies);
				//Incrementar el contador por cada registro
				$intContador++;
				//Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}
			
			//Cambiar el tipo y tamaño de fuente
			$objExcel->getActiveSheet()
		             ->getStyle('A'.$intFilaInicial.':'.'L'.$intFila)
    			     ->applyFromArray($arrStyleFuenteColumnasSec);

			//Cambiar alineación de las siguientes celdas
    		$objExcel->getActiveSheet()
			         ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
	        	     ->getAlignment()
	        	     ->applyFromArray($arrStyleAlignmentLeft);

	       	$objExcel->getActiveSheet()
    			     ->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
	        	     ->getAlignment()
	        	     ->applyFromArray($arrStyleAlignmentCenter);

	       	$objExcel->getActiveSheet()
		    		 ->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentCenter);

		    $objExcel->getActiveSheet()
		   		     ->getStyle('K'.$intFilaInicial.':'.'K'.$intFila)
	        	     ->getAlignment()
	        	     ->applyFromArray($arrStyleAlignmentLeft);

			//Incrementar el indice para escribir el total
            $intFila++; 
            //Agregar información del total
            $objExcel->getActiveSheet()
        			 ->setCellValue('L'.$intFila, 'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
        	$objExcel->getActiveSheet()
            		 ->getStyle('L'.$intFila)
            		 ->applyFromArray($arrStyleBold);

           	//Si el número de registros (por cada hoja) es mayor que el número máximo de registros 
		    if($intFila > $intNumMaxRegistros)
            {
            	//Asignar número de registros
            	$intNumMaxRegistros = $intFila;
            }

		}//Cierre de verificación de fechas de nacimiento

		//Verificar si hay información de los cultivos
   		if($dteFechaInicial != '' &&  $dteFechaFinal != '' && $otdCultivos)
		{
			
			//Inicializar variables
			$intFila = 10;
			$intContador = 0;
			$intProspectoIDActual = 0;
			//Incrementar contador por cada hoja nueva
			$intContadorHojas++;

			//Asignar el nombre de la hoja
			$strNombreHoja = 'cultivos_prospectos';

			//Hacer un llamado a la función para agregar (o activar) una hoja en el archivo excel
			$intContadorHojas = $this->get_hoja_archivo_excel($objExcel, $strNombreHoja, $intContadorHojas);
			
			//Se agrega el título del archivo
			$objExcel->getActiveSheet()
					 ->setCellValue('A7', 'LISTADO DE PROSPECTOS CON CULTIVO '.$strTituloMesRangoFechas);
			

			//Se agregan las columnas de cabecera
			$objExcel->getActiveSheet()
        			 ->setCellValue('A'.$intPosEncabezados, 'VENDEDOR')
        		 	 ->setCellValue('B'.$intPosEncabezados, 'PROSPECTO')
        		     ->setCellValue('C'.$intPosEncabezados, 'LOCALIDAD')
                     ->setCellValue('D'.$intPosEncabezados, 'DOMICILIO')
                     ->setCellValue('E'.$intPosEncabezados, 'TELÉFONO')
                     ->setCellValue('F'.$intPosEncabezados, 'MADUREZ')
                     ->setCellValue('G'.$intPosEncabezados, 'VISITA')
                     ->setCellValue('H'.$intPosEncabezados, 'COMENTARIOS')
                     ->setCellValue('I'.$intPosEncabezados, 'NOMBRE DEL CONTACTO')
                     ->setCellValue('J'.$intPosEncabezados, 'TELÉFONO')
                     ->setCellValue('K'.$intPosEncabezados, 'HOBBIES')
                     ->setCellValue('L'.$intPosEncabezados, 'CULTIVO')
                     ->setCellValue('M'.$intPosEncabezados, 'SIEMBRA')
                     ->setCellValue('N'.$intPosEncabezados, 'COSECHA');

	        //Preferencias de color de relleno de celda
            $objExcel->getActiveSheet()
       			     ->getStyle('A9:N9')
			         ->getFill()
			         ->applyFromArray($arrStyleColumnas);

    		//Preferencias de color de texto de la celda
			$objExcel->getActiveSheet()
    				 ->getStyle('A9:N9')
    			     ->applyFromArray($arrStyleFuenteColumnasPrinc);


    		//Recorremos el arreglo 
			foreach ($otdCultivos as $arrCol)
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
				$objExcel->getActiveSheet()
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
					     ->setCellValue('K'.$intFila, $arrCol->contacto_hobbies)
					     ->setCellValue('L'.$intFila, $arrCol->cultivo)
					     ->setCellValue('M'.$intFila, $arrCol->siembra)
					     ->setCellValue('N'.$intFila, $arrCol->cosecha);
				
				//Si el prospecto actual es igual a cero (primer prospecto)
	      		if ($intProspectoIDActual === 0)
	      		{
	      			//Incrementar el contador por cada registro
					$intContador++;
					//Asignar id del prospecto actual
	      			$intProspectoIDActual = $arrCol->prospecto_id;
	      		}

	      		//Si el prospecto actual es diferente al anterior
	      		if ($intProspectoIDActual != $arrCol->prospecto_id)
	      		{
	      			//Incrementar el contador por cada registro
					$intContador++;
					//Asignar id del prospecto actual
	      			$intProspectoIDActual = $arrCol->prospecto_id;
	      		}

				//Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Cambiar el tipo y tamaño de fuente
			$objExcel->getActiveSheet()
		   		     ->getStyle('A'.$intFilaInicial.':'.'N'.$intFila)
    			     ->applyFromArray($arrStyleFuenteColumnasSec);

			//Cambiar alineación de las siguientes celdas
    		$objExcel->getActiveSheet()
					 ->getStyle('E'.$intFilaInicial.':'.'E'.$intFila)
			         ->getAlignment()
			         ->applyFromArray($arrStyleAlignmentLeft);

			$objExcel->getActiveSheet()
		    		->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)
			        ->getAlignment()
			        ->applyFromArray($arrStyleAlignmentCenter);

			$objExcel->getActiveSheet()
		             ->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)
		        	 ->getAlignment()
		        	 ->applyFromArray($arrStyleAlignmentLeft);

			//Incrementar el indice para escribir el total
            $intFila++; 
            //Agregar información del total
            $objExcel->getActiveSheet()
           			 ->setCellValue('N'.$intFila, 'TOTAL: '.$intContador);
            //Cambiar estilo de la celda
           	$objExcel->getActiveSheet()
           			 ->getStyle('N'.$intFila)
            		 ->applyFromArray($arrStyleBold);

           	//Si el número de registros (por cada hoja) es mayor que el número máximo de registros 
		    if($intFila > $intNumMaxRegistros)
            {
            	//Asignar número de registros
            	$intNumMaxRegistros = $intFila;
            }

		}//Cierre de verificación de cultivos

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'impresion_agenda_'.$strModulo.'.xls', 'visitas', 
        								    $intNumMaxRegistros);
	}

}