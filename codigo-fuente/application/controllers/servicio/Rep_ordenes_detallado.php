<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_ordenes_detallado extends MY_Controller {
	
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
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('servicio/rep_ordenes_detallado', $arrDatos);
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
	public function get_reporte() 
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strSucursales = $this->input->post('strSucursales');
		$strServiciosTipos = $this->input->post('strServiciosTipos');
		$strSerie = trim($this->input->post('strSerie'));
		$intProspectoID = $this->input->post('intProspectoID');
		$intMecanicoID = $this->input->post('intMecanicoID');
		$strFormulario = $this->input->post('strFormulario');

		//Variable que se utiliza para asignar el acumulado del costo
		$intAcumGralCosto = 0;
		//Variable que se utiliza para asignar el acumulado del precio 
		$intAcumGralPrecio = 0;
		//Variable que se utiliza para asignar el acumulado del costo (salidas de refacciones)
		$intAcumGralCostoSR = 0;
		//Variable que se utiliza para asignar el acumulado del precio  (salidas de refacciones)
		$intAcumGralPrecioSR = 0;
		//Variable que se utiliza para asignar el acumulado del costo (trabajos foráneos)
		$intAcumGralCostoTF = 0;
		//Variable que se utiliza para asignar el acumulado del precio (trabajos foráneos)
		$intAcumGralPrecioTF = 0;
		//Variable que se utiliza para asignar el acumulado del costo (servicios de mano de obra)
		$intAcumGralCostoMO = 0;
		//Variable que se utiliza para asignar el acumulado del precio (servicios de mano de obra)
		$intAcumGralPrecioMO = 0;
		//Variable que se utiliza para asignar el acumulado del precio (otros servicios)
		$intAcumGralPrecioOtros = 0;
		//Variable que se utiliza para asignar el acumulado del precio (gastos de servicio)
		$intAcumGralPrecioGS = 0;

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

		//Seleccionar los datos de las ordenes de reparación que coinciden con el parámetro enviado
		$otdResultado = $this->ordenes->buscar_ordenes_proceso($dteFechaFinal, $strSucursales, 
										  					   $strServiciosTipos, 
										  					   $intProspectoID,  
										   					   $intMecanicoID, 
										   					   $dteFechaInicial, 
										   					   $strSerie, $strFormulario);  

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


		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Crea los titulos de la primer cabecera 
		$pdf->arrCabecera = array(utf8_decode('DETALLADO DE ORDENES DE REPARACIÓN'));
		//Crea los titulos de la segunda cabecera 
		$pdf->arrCabecera2 = array('FOLIO', 'CLIENTE', 'MAQUINARIA', 'SERIE',
							      'FECHA', 'ESTATUS');
		//Establece el ancho de las columnas de las cabeceras
		$pdf->arrAnchura = array(190);
		$pdf->arrAnchura2 = array(18, 57, 50, 35, 15, 15);
		//Establece la alineación de las celdas de las tablas
		$pdf->arrAlineacion = array('L');
		$pdf->arrAlineacion2 = array('L', 'L', 'L', 'L', 'C', 'C');
		//Establece el ancho de las columnas de la tabla detalles
		$arrAnchuraDetalles = array(18, 30, 15, 20, 20);
		//Establece la alineación de las celdas de la tabla detalles
		$arrAlineacionDetalles = array('L', 'L', 'C', 'R', 'R');
		//Establece el ancho de las columnas de la tabla totales
		$arrAnchuraTotales = array(63, 20, 20);
		//Establece la alineación de las celdas de la tabla totales
		$arrAlineacionTotales = array('R', 'R', 'R');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 =  'LISTADO DE MOVIMIENTOS '.$strTituloRangoFechas;
		//Asignar el valor de la línea dos del título
		$pdf->strLinea2 = utf8_decode('SUCURSALES: '.trim($strTituloSucursales));
		//Asignar el valor de la línea tres del título
		$pdf->strLinea3 = utf8_decode('TIPOS DE SERVICIOS: '.trim($strTituloServiciosTipos));
		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			//Seleccionar los datos del prospecto que coincide con el id
			$otdProspecto =  $this->prospectos->buscar($intProspectoID, NULL, 'referencias');
			$pdf->strLinea4 =  'CLIENTE: '.utf8_decode($otdProspecto->codigo.' - '.$otdProspecto->prospecto);
		}

		//Si existe id del mecánico
		if($intMecanicoID > 0)
		{
			//Seleccionar los datos del mecánico que coincide con el id
			$otdMecanico =  $this->mecanicos->buscar($intMecanicoID);
			$pdf->strLinea5 = utf8_decode( 'MECÁNICO: '.$otdMecanico->empleado);
		}

		
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establecer el color de fondo para la cabecera
        $pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
		//Establecer el color de línea
		$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);

		//Si hay información
		if ($otdResultado)
		{
			//Recorremos el arreglo para obtener la información de las ordenes de reparación
			foreach ($otdResultado as $arrCol)
			{
				//Variable que se utiliza para asignar el acumulado del costo de la orden de reparación
			    $intAcumCostoOrden = 0;
				//Variable que se utiliza para asignar el acumulado del subtotal de la orden de reparación
			    $intAcumSubtotalOrden = 0;
				//Array que se utiliza para agregar los detalles de la orden de reparación
		        $arrDetalles = array();

			    //Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura2);
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array($arrCol->folio, utf8_decode($arrCol->prospecto), 
							   utf8_decode($arrCol->maquinaria_descripcion), utf8_decode($arrCol->serie),
						       $arrCol->fecha, $arrCol->estatus), $pdf->arrAlineacion2, 'ClippedCell');
				//Asignar el domicilio del cliente/prospecto
				$strDomicilio = $this->get_domicilio_cliente($arrCol);
				//Domicilio
				$pdf->MultiCell(190, 3, strtoupper(utf8_decode($strDomicilio)));
				//Tipo de servicio
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(25, 3, 'TIPO DE SERVICIO:', 0, 0, 'L', 0);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(50, 3, utf8_decode($arrCol->servicio_tipo), 0, 0, 'L', 0);
				//Ubicación
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(18, 3, utf8_decode('UBICACIÓN:'), 0, 0, 'L', 0);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(20, 3, $arrCol->ubicacion, 0, 0, 'L', 0);
				//Tipo de reparación
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(30, 3, utf8_decode('TIPO DE REPARACIÓN:'), 0, 0, 'L', 0);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(47, 3, $arrCol->tipo_reparacion, 0, 1, 'L', 0);
				//Falla
			    //Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(13, 3, 'FALLA:', 0, 0, 'L', 0);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(174, 3, utf8_decode($arrCol->falla), 0, 1, 'L', 0);
				//Si existe causa
				if($arrCol->causa != '')
				{
					//Causa
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->ClippedCell(13, 3, 'CAUSA:', 0, 0, 'L', 0);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->ClippedCell(174, 3, utf8_decode($arrCol->causa), 0, 0, 'L', 0);
				}

				//Asignar objeto con los detalles de la orden de reparación
				$otdDetalles = $this->get_detalles($arrCol, 
									   				$intAcumCostoOrden, $intAcumSubtotalOrden,  
													$intAcumGralCosto, $intAcumGralPrecio, 
													$intAcumGralCostoSR, $intAcumGralPrecioSR, 
													$intAcumGralCostoTF, $intAcumGralPrecioTF, 
													$intAcumGralCostoMO, $intAcumGralPrecioMO, 
													$intAcumGralPrecioOtros, $intAcumGralPrecioGS);
				
				//Asignar array con los datos de los detalles
				$arrDetalles = $otdDetalles['rows'];
				//Asignar acumulados
				$intAcumCostoOrden +=  $otdDetalles['acumulado_costoOrden'];
				$intAcumSubtotalOrden +=  $otdDetalles['acumulado_subtotalOrden'];
				$intAcumGralCosto =  $otdDetalles['acumulado_gralCosto'];
				$intAcumGralPrecio =  $otdDetalles['acumulado_gralPrecio'];
				$intAcumGralCostoSR =  $otdDetalles['acumulado_gralCostoSR'];
				$intAcumGralPrecioSR =  $otdDetalles['acumulado_gralPrecioSR'];
				$intAcumGralCostoTF =  $otdDetalles['acumulado_gralCostoTF'];
				$intAcumGralPrecioTF =  $otdDetalles['acumulado_gralPrecioTF'];
				$intAcumGralCostoMO =  $otdDetalles['acumulado_gralCostoMO'];
				$intAcumGralPrecioMO =  $otdDetalles['acumulado_gralPrecioMO'];
				$intAcumGralPrecioOtros =  $otdDetalles['acumulado_gralPrecioOtros'];
				$intAcumGralPrecioGS =  $otdDetalles['acumulado_gralPrecioGS'];

				//Si se cumple la sentencia mostrar detalles del registro
				if($arrDetalles)
				{
					$pdf->Ln(4);//Deja un salto de línea
					//Recorremos el arreglo 
			        foreach ($arrDetalles as $arrDet) 
			        {
			        	//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchuraDetalles);
						//Variable que se utiliza para asignar el costo unitario
						$intCostoUnitario = $arrDet['costo'];
						//Variable que se utiliza para asignar el precio unitario
						$intPrecioUnitario = $arrDet['precio'];

						//Si existe costo unitario
						if($intCostoUnitario > 0)
						{
							//Convertir cantidad a formato moneda
							$intCostoUnitario =  '$'.number_format($intCostoUnitario,2);
						}

						//Si existe precio unitario
						if($intPrecioUnitario > 0)
						{
							//Convertir cantidad a formato moneda
							$intPrecioUnitario =  '$'.number_format($intPrecioUnitario,2);
						}


						//Se agrega la información al reporte... se utiliza utf8 para acentos y tildes
					    $pdf->Row(array($arrDet['folio'], 
					    				utf8_decode($arrDet['tipo']), 
					    				$arrDet['fecha'],
					    				$intCostoUnitario,  
					    				$intPrecioUnitario), 
					    			    $arrAlineacionDetalles, 'ClippedCell');
			        }


			        //Establece el ancho de las columnas
					$pdf->SetWidths($arrAnchuraTotales);
				    //Cambiar el volumen de la fuente a bold
			  		$pdf->strTipoLetraTabla = 'Negrita';
					//Acumulados de la orden de reparación
					$pdf->Row(array('SUBTOTAL:', 
									'$'.number_format($intAcumCostoOrden,2),
									'$'.number_format($intAcumSubtotalOrden,2)), 
								    $arrAlineacionTotales, 'ClippedCell');
					//Cambiar el volumen de la letra
					$pdf->strTipoLetraTabla = 'Normal';

				}//Cierre de verificación de detalles

				$pdf->Ln(5);//Deja un salto de línea

			}//Cierre de foreach 


			//------------------------------------------------------------------------------------------------------------------------
	        //---------- RESUMEN
	        //------------------------------------------------------------------------------------------------------------------------
			//Dibuja una línea para separar el total
	    	$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
	    	//Establece el ancho de las columnas
			$pdf->SetWidths($arrAnchuraTotales);
		   
			//Acumulados generales de las salidas de refacciones
			$pdf->Row(array('TOTAL REFACCIONES:|Negrita', 
							'$'.number_format($intAcumGralCostoSR,2),
							'$'.number_format($intAcumGralPrecioSR,2)), 
						    $arrAlineacionTotales, 'ClippedCell');

			//Acumulados generales de los trabajos foráneos
			$pdf->Row(array(utf8_decode('TOTAL TRABAJOS FORÁNEOS:|Negrita'), 
							'$'.number_format($intAcumGralCostoTF,2),
							'$'.number_format($intAcumGralPrecioTF,2)), 
						    $arrAlineacionTotales, 'ClippedCell');

			//Acumulados generales de los servicios de mano de obra
			$pdf->Row(array('TOTAL MANO OBRA:|Negrita', 
							'$'.number_format($intAcumGralCostoMO,2),
							'$'.number_format($intAcumGralPrecioMO,2)), 
						    $arrAlineacionTotales, 'ClippedCell');

			//Acumulados generales de los otros servicios
			$pdf->Row(array('TOTAL OTROS:|Negrita', 
							'',
							'$'.number_format($intAcumGralPrecioOtros,2)), 
						    $arrAlineacionTotales, 'ClippedCell');

			//Acumulados generales de los gastos de servicio
			$pdf->Row(array('TOTAL KILOMETRAJE:|Negrita', 
							'',
							'$'.number_format($intAcumGralPrecioGS,2)), 
						    $arrAlineacionTotales, 'ClippedCell');

			//Cambiar el volumen de la fuente a bold
	  		$pdf->strTipoLetraTabla = 'Negrita';
			//Acumulados generales 
			$pdf->Row(array('TOTAL GENERAL:', 
							'$'.number_format($intAcumGralCosto,2), 
							'$'.number_format($intAcumGralPrecio,2)), 
						    $arrAlineacionTotales, 'ClippedCell');
			//Cambiar el volumen de la letra
			$pdf->strTipoLetraTabla = 'Normal';

		}//Cierre de verificación de información

		//Ejecutar la salida del reporte
		$pdf->Output('ordenes_reparacion_detallado.pdf','I');	

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
		$strSerie = trim($this->input->post('strSerie'));
		$intProspectoID = $this->input->post('intProspectoID');
		$intMecanicoID = $this->input->post('intMecanicoID');
		$strFormulario = $this->input->post('strFormulario');
		
		//Variable que se utiliza para asignar el acumulado del costo
		$intAcumGralCosto = 0;
		//Variable que se utiliza para asignar el acumulado del precio 
		$intAcumGralPrecio = 0;
		//Variable que se utiliza para asignar el acumulado del costo (salidas de refacciones)
		$intAcumGralCostoSR = 0;
		//Variable que se utiliza para asignar el acumulado del precio  (salidas de refacciones)
		$intAcumGralPrecioSR = 0;
		//Variable que se utiliza para asignar el acumulado del costo (trabajos foráneos)
		$intAcumGralCostoTF = 0;
		//Variable que se utiliza para asignar el acumulado del precio (trabajos foráneos)
		$intAcumGralPrecioTF = 0;
		//Variable que se utiliza para asignar el acumulado del costo (servicios de mano de obra)
		$intAcumGralCostoMO = 0;
		//Variable que se utiliza para asignar el acumulado del precio (servicios de mano de obra)
		$intAcumGralPrecioMO = 0;
		//Variable que se utiliza para asignar el acumulado del precio (otros servicios)
		$intAcumGralPrecioOtros = 0;
		//Variable que se utiliza para asignar el acumulado del precio (gastos de servicio)
		$intAcumGralPrecioGS = 0;
		//Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 13;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 15;

		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

		//Seleccionar los datos de las ordenes de reparación que coinciden con el parámetro enviado
		$otdResultado = $this->ordenes->buscar_ordenes_proceso($dteFechaFinal, $strSucursales, 
										  					   $strServiciosTipos, 
										  					   $intProspectoID,  
										   					   $intMecanicoID, 
										   					   $dteFechaInicial, 
										   					   $strSerie, $strFormulario);    

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


	   //Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE MOVIMIENTOS '.$strTituloRangoFechas)
			     ->setCellValue('A8', 'SUCURSALES: '.$strTituloSucursales)
			     ->setCellValue('A9', 'TIPOS DE SERVICIOS: '.$strTituloServiciosTipos);

		//Si existe id del prospecto
		if($intProspectoID > 0)
		{   //Seleccionar los datos del prospecto que coincide con el id
			$otdProspecto =  $this->prospectos->buscar($intProspectoID, NULL, 'referencias');
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A10', 'CLIENTE: '.$otdProspecto->codigo.' - '.$otdProspecto->prospecto);
		}

		//Si existe id del mecánico
		if($intMecanicoID > 0)
		{
			//Seleccionar los datos del mecánico que coincide con el id
			$otdMecanico =  $this->mecanicos->buscar($intMecanicoID);
			$objExcel->setActiveSheetIndex(0)
			         ->setCellValue('A11', 'MECÁNICO: '.$otdMecanico->empleado);
		}


		//Se agregan las columnas de la primer cabecera
		$objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'DETALLADO DE ORDENES DE REPARACIÓN');

        //Incrementar los indices para escribir las columnas de la cabecera 2
        $intPosEncabezados++;

		//Se agregan las columnas de la segunda cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'FOLIO')
        		 ->setCellValue('B'.$intPosEncabezados, 'CLIENTE')
        		 ->setCellValue('C'.$intPosEncabezados, 'MAQUINARIA')
        		 ->setCellValue('D'.$intPosEncabezados, 'SERIE')
        		 ->setCellValue('E'.$intPosEncabezados, 'FECHA')
        		 ->setCellValue('F'.$intPosEncabezados, 'ESTATUS')
        		 ->setCellValue('G'.$intPosEncabezados, 'DOMICILIO')
        		 ->setCellValue('H'.$intPosEncabezados, 'TIPO DE SERVICIO')
        		 ->setCellValue('I'.$intPosEncabezados, 'UBICACIÓN')
        		 ->setCellValue('J'.$intPosEncabezados, 'TIPO DE REPARACIÓN')
        		 ->setCellValue('K'.$intPosEncabezados, 'FALLA')
        		 ->setCellValue('L'.$intPosEncabezados, 'CAUSA');

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

       	$objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A11:D11');

       $objExcel->setActiveSheetIndex(0)
       			 ->mergeCells('A13:L13');

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

        $objExcel->getActiveSheet()
        		 ->getStyle('A11:D11')
        		 ->applyFromArray($arrStyleBold);

        //Preferencias de color de texto de la celda
        $objExcel->getActiveSheet()
			    ->getStyle('A9:D9')
			    ->applyFromArray($arrStyleFuenteColumnasPrinc);

	    $objExcel->getActiveSheet()
			    ->getStyle('A10:D10')
			    ->applyFromArray($arrStyleFuenteColumnasPrinc);

	    $objExcel->getActiveSheet()
			    ->getStyle('A11:D11')
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

        $objExcel->getActiveSheet()
            	 ->getStyle('A11:D11')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentLeft);

        //Preferencias de color de relleno de celda
        $objExcel->getActiveSheet()
    			 ->getStyle('A13:L13')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        $objExcel->getActiveSheet()
    			 ->getStyle('A14:L14')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda
      	$objExcel->getActiveSheet()
    			 ->getStyle('A13:L13')
    			 ->applyFromArray($arrStyleFuenteColumnas);

    	$objExcel->getActiveSheet()
    			 ->getStyle('A14:L14')
    			 ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet()
            	 ->getStyle('A14:L14')
            	 ->getAlignment()
            	 ->applyFromArray($arrStyleAlignmentCenter);

        //Si hay información
		if ($otdResultado)
		{
			//Recorremos el arreglo 
			foreach ($otdResultado as $arrCol)
			{ 
				//Variable que se utiliza para asignar el acumulado del costo de la orden de reparación
			    $intAcumCostoOrden = 0;
				//Variable que se utiliza para asignar el acumulado del subtotal de la orden de reparación
			    $intAcumSubtotalOrden = 0;
				//Array que se utiliza para agregar los detalles
		        $arrDetalles = array();
			    //Asignar el domicilio del cliente/prospecto
				$strDomicilio = $this->get_domicilio_cliente($arrCol);

				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
				 		 ->setCellValueExplicit('A'.$intFila, $arrCol->folio, PHPExcel_Cell_DataType::TYPE_STRING)
                         ->setCellValue('B'.$intFila, $arrCol->prospecto)
                         ->setCellValue('C'.$intFila, $arrCol->maquinaria_descripcion)
                         ->setCellValue('D'.$intFila, $arrCol->serie)
                         ->setCellValue('E'.$intFila, $arrCol->fecha)
                         ->setCellValue('F'.$intFila, $arrCol->estatus)
                         ->setCellValue('G'.$intFila, $strDomicilio)
                         ->setCellValue('H'.$intFila, $arrCol->servicio_tipo)
                         ->setCellValue('I'.$intFila, $arrCol->ubicacion)
                         ->setCellValue('J'.$intFila, $arrCol->tipo_reparacion)
                         ->setCellValue('K'.$intFila, $arrCol->falla)
                         ->setCellValue('L'.$intFila, $arrCol->causa);

                //Cambiar alineación de las siguientes celdas
	            $objExcel->getActiveSheet()
	                	 ->getStyle('E'.$intFila.':'.'F'.$intFila)
	                	 ->getAlignment()
	                	 ->applyFromArray($arrStyleAlignmentCenter);

                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++;


				//Asignar objeto con los detalles de la orden de reparación
				$otdDetalles = $this->get_detalles($arrCol, 
								   				   $intAcumCostoOrden, $intAcumSubtotalOrden,  
												   $intAcumGralCosto, $intAcumGralPrecio, 
												   $intAcumGralCostoSR, $intAcumGralPrecioSR, 
												   $intAcumGralCostoTF, $intAcumGralPrecioTF, 
												   $intAcumGralCostoMO, $intAcumGralPrecioMO, 
												   $intAcumGralPrecioOtros, $intAcumGralPrecioGS);
				
				//Asignar array con los datos de los detalles
				$arrDetalles = $otdDetalles['rows'];
				//Asignar acumulados
				$intAcumCostoOrden +=  $otdDetalles['acumulado_costoOrden'];
				$intAcumSubtotalOrden +=  $otdDetalles['acumulado_subtotalOrden'];
				$intAcumGralCosto =  $otdDetalles['acumulado_gralCosto'];
				$intAcumGralPrecio =  $otdDetalles['acumulado_gralPrecio'];
				$intAcumGralCostoSR =  $otdDetalles['acumulado_gralCostoSR'];
				$intAcumGralPrecioSR =  $otdDetalles['acumulado_gralPrecioSR'];
				$intAcumGralCostoTF =  $otdDetalles['acumulado_gralCostoTF'];
				$intAcumGralPrecioTF =  $otdDetalles['acumulado_gralPrecioTF'];
				$intAcumGralCostoMO =  $otdDetalles['acumulado_gralCostoMO'];
				$intAcumGralPrecioMO =  $otdDetalles['acumulado_gralPrecioMO'];
				$intAcumGralPrecioOtros =  $otdDetalles['acumulado_gralPrecioOtros'];
				$intAcumGralPrecioGS =  $otdDetalles['acumulado_gralPrecioGS'];

				//Si se cumple la sentencia mostrar detalles del registro
				if($arrDetalles)
				{

					//Número de fila donde se va a comenzar a rellenar
					$intFilaInicialDet = $intFila;

					//Recorremos el arreglo 
			        foreach ($arrDetalles as $arrDet) 
			        {
						
			        	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
						//Agregar información del detalle
					    $objExcel->setActiveSheetIndex(0)
						 		 ->setCellValueExplicit('A'.$intFila, $arrDet['folio'], PHPExcel_Cell_DataType::TYPE_STRING)
		                         ->setCellValue('B'.$intFila, $arrDet['tipo'])
		                         ->setCellValue('C'.$intFila, $arrDet['fecha'])
		                         ->setCellValue('D'.$intFila, $arrDet['costo'])
		                         ->setCellValue('E'.$intFila, $arrDet['precio']);


		                //Cambiar alineación de las siguientes celdas
			            $objExcel->getActiveSheet()
			                	 ->getStyle('C'.$intFila)
			                	 ->getAlignment()
			                	 ->applyFromArray($arrStyleAlignmentCenter);

		                //Incrementar el indice para escribir los datos del siguiente registro
               			$intFila++;

			        }//Cierre de foreach

					//Acumulados de la orden de reparación
					$objExcel->setActiveSheetIndex(0)
	                         ->setCellValue('C'.$intFila, 'SUBTOTAL:')
	                         ->setCellValue('D'.$intFila, $intAcumCostoOrden)
	                         ->setCellValue('E'.$intFila, $intAcumSubtotalOrden);


		            //Cambiar contenido de las celdas a formato moneda
		            $objExcel->getActiveSheet()
		            		 ->getStyle('D'.$intFilaInicialDet.':'.'E'.$intFila)
		            		 ->getNumberFormat()
		            		 ->setFormatCode('$#,##0.00');

		           	//Cambiar alineación de las siguientes celdas
		            $objExcel->getActiveSheet()
		                	 ->getStyle('C'.$intFilaInicialDet.':'.'E'.$intFila)
		                	 ->getAlignment()
		                	 ->applyFromArray($arrStyleAlignmentRight);

		            //Cambiar estilo de la celda
           			$objExcel->getActiveSheet()
            		  		 ->getStyle('C'.$intFila.':'.'E'.$intFila)
            		 		 ->applyFromArray($arrStyleBold);

		             //Incrementar el indice para escribir los datos del siguiente registro
               		 $intFila+=2;

				}//Cierre de verificación de detalles

			}//Cierre de foreach

			//Incrementar el indice para escribir los acumulados
            $intFila++;

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- RESUMEN
	        //------------------------------------------------------------------------------------------------------------------------
	        //Número de fila donde se va a comenzar a rellenar
	        $intFilaInicialAcum = $intFila;

	        //Acumulados generales de las salidas de refacciones
	        $objExcel->setActiveSheetIndex(0)
	                         ->setCellValue('C'.$intFila, 'TOTAL REFACCIONES:')
	                         ->setCellValue('D'.$intFila, $intAcumGralCostoSR)
	                         ->setCellValue('E'.$intFila, $intAcumGralPrecioSR);
	        
	        //Incrementar el indice para escribir los datos del siguiente acumulado
            $intFila++;

            //Acumulados generales de los trabajos foráneos
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('C'.$intFila, 'TOTAL TRABAJOS FORÁNEOS:')
                     ->setCellValue('D'.$intFila, $intAcumGralCostoTF)
                     ->setCellValue('E'.$intFila, $intAcumGralPrecioTF);

            //Incrementar el indice para escribir los datos del siguiente acumulado
            $intFila++;

            //Acumulados generales de los servicios de mano de obra
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('C'.$intFila, 'TOTAL MANO OBRA:')
                     ->setCellValue('D'.$intFila, $intAcumGralCostoMO)
                     ->setCellValue('E'.$intFila, $intAcumGralPrecioMO);

            //Incrementar el indice para escribir los datos del siguiente acumulado
            $intFila++;

            //Acumulados generales de los otros servicios
            $objExcel->setActiveSheetIndex(0)
		             ->setCellValue('C'.$intFila, 'TOTAL OTROS:')
		             ->setCellValue('E'.$intFila, $intAcumGralPrecioOtros);

		    //Incrementar el indice para escribir los datos del siguiente acumulado
            $intFila++;

            //Acumulados generales de los otros servicios
            $objExcel->setActiveSheetIndex(0)
		             ->setCellValue('C'.$intFila, 'TOTAL KILOMETRAJE:')
		             ->setCellValue('E'.$intFila, $intAcumGralPrecioGS);


		    //Incrementar el indice para escribir los datos del siguiente acumulado
            $intFila++;

            //Acumulados generales 
            $objExcel->setActiveSheetIndex(0)
                     ->setCellValue('C'.$intFila, 'TOTAL GENERAL:')
                     ->setCellValue('D'.$intFila, $intAcumGralCosto)
                     ->setCellValue('E'.$intFila, $intAcumGralPrecio);

            
		    //Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()
            		 ->getStyle('D'.$intFilaInicialAcum.':'.'E'.$intFila)
            		 ->getNumberFormat()
            		 ->setFormatCode('$#,##0.00');

           	//Cambiar alineación de las siguientes celdas
            $objExcel->getActiveSheet()
                	 ->getStyle('C'.$intFilaInicialAcum.':'.'E'.$intFila)
                	 ->getAlignment()
                	 ->applyFromArray($arrStyleAlignmentRight);

            //Cambiar estilo de la celda
   			$objExcel->getActiveSheet()
    		  		 ->getStyle('C'.$intFilaInicialAcum.':'.'C'.$intFila)
    		 		 ->applyFromArray($arrStyleBold);

    		$objExcel->getActiveSheet()
    		  		 ->getStyle('D'.$intFila.':'.'E'.$intFila)
    		 		 ->applyFromArray($arrStyleBold);

		}//Cierre de verificación de información

        //Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'ordenes_reparacion_detallado.xls', 'detallado', $intFila);

	}
	

	//Función que se utiliza para regresar los detalles de la orden de reparación
	public function get_detalles($arrCol, $intAcumCostoOrden, $intAcumSubtotalOrden,  
							     $intAcumGralCosto, $intAcumGralPrecio, $intAcumGralCostoSR, 
							     $intAcumGralPrecioSR, $intAcumGralCostoTF, $intAcumGralPrecioTF, 
							     $intAcumGralCostoMO, $intAcumGralPrecioMO, $intAcumGralPrecioOtros, 
							     $intAcumGralPrecioGS)
	{
		//Array que se utiliza para enviar datos
		$arrDatos = array('rows' => NULL, 
						  'acumulado_costoOrden' => '0.00',
						  'acumulado_subtotalOrden' => '0.00',
						  'acumulado_gralCosto' => '0.00',
						  'acumulado_gralPrecio' => '0.00', 
						  'acumulado_gralCostoSR' => '0.00',
						  'acumulado_gralPrecioSR' => '0.00',
						  'acumulado_gralCostoTF' => '0.00',
						  'acumulado_gralPrecioTF' => '0.00',
						  'acumulado_gralCostoMO' => '0.00',
						  'acumulado_gralPrecioMO' => '0.00',
						  'acumulado_gralPrecioOtros' => '0.00',
						  'acumulado_gralPrecioGS' => '0.00');

		//Array que se utiliza para agregar los detalles de la orden de reparación
        $arrDetalles = array();
        //Array que se utiliza para agregar los datos de un detalle
        $arrAuxiliar = array();
        //Asignar el id de la orden de reparación
        $intOrdenReparacionID = $arrCol->orden_reparacion_id;
        //Asignar el estatus orden de reparación
        $strEstatus = $arrCol->estatus;
        //Asignar subtotal del gasto de servicio
	    $intGatosServiciosSubtotal = $arrCol->gastos_servicio;

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
	        	$intPrecioUnitario = $arrSal->precio_unitario;
	        	$intCostoUnitario = $arrSal->costo_unitario;

			    //Variable que se utiliza para asignar el subtotal 
				$intSubtotalUnitario = 0;
				//Variable que se utiliza para asignar el costo 
				$intCostoTotal = 0;

				//Decrementar cantidad devuelta
				$intCantidadFacturar = $intCantidadSurtida - $intCantidadDevolucion;

				//Calcular subtotal
				$intSubtotalUnitario = $intCantidadFacturar * $intPrecioUnitario;

				//Calcular costo
        		$intCostoTotal  = $intCantidadFacturar * $intCostoUnitario;

        		//Definir valores del array auxiliar de información (para cada detalle)
        		$arrAuxiliar["folio"] = $arrSal->folio;
        		$arrAuxiliar["tipo"] = 'REFACCIONES';
        		$arrAuxiliar["fecha"] = $arrSal->fecha;
        		$arrAuxiliar["costo"] = $intCostoTotal;
                $arrAuxiliar["precio"] = $intSubtotalUnitario;
                //Asignar datos al array
                array_push($arrDetalles, $arrAuxiliar); 

				//Incrementar acumulados por cada registro
				//Acumulados de la orden de reparación
				$intAcumCostoOrden += $intCostoTotal;
			    $intAcumSubtotalOrden += $intSubtotalUnitario;
			    
			    //Si el estatus es diferente de INACTIVO
			    if($strEstatus != 'INACTIVO')
			    {
			    	//Acumulados generales
				    $intAcumGralCosto += $intCostoTotal;
				    $intAcumGralPrecio += $intSubtotalUnitario;
				    $intAcumGralCostoSR += $intCostoTotal;
				    $intAcumGralPrecioSR += $intSubtotalUnitario;
			    }

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
				$intCostoUnitario = $arrTrab->costo_unitario;
				//Variable que se utiliza para asignar el subtotal 
				$intSubtotalUnitario = 0;
				//Variable que se utiliza para asignar el costo 
				$intCostoTotal = 0;

				//Calcular subtotal
				$intSubtotalUnitario = $intCantidad * $intPrecioUnitario;

				//Calcular costo
        		$intCostoTotal  = $intCantidad * $intCostoUnitario;

        		//Definir valores del array auxiliar de información (para cada detalle)
        		$arrAuxiliar["folio"] = $arrTrab->folio;
        		$arrAuxiliar["tipo"] = 'TRABAJOS FORÁNEOS';
        		$arrAuxiliar["fecha"] = $arrTrab->fecha;
        		$arrAuxiliar["costo"] = $intCostoTotal;
                $arrAuxiliar["precio"] = $intSubtotalUnitario;
                //Asignar datos al array
                array_push($arrDetalles, $arrAuxiliar); 

                //Incrementar acumulados por cada registro
			  	//Acumulados de la orden de reparación
			    $intAcumCostoOrden += $intCostoTotal;
			    $intAcumSubtotalOrden += $intSubtotalUnitario;

			    //Si el estatus es diferente de INACTIVO
			    if($strEstatus != 'INACTIVO')
			    {
				    //Acumulados generales
				    $intAcumGralCosto += $intCostoTotal;
				    $intAcumGralPrecio += $intSubtotalUnitario;
				    $intAcumGralCostoTF += $intCostoTotal;
				    $intAcumGralPrecioTF += $intSubtotalUnitario;
				}

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
	        	//Variable que se utiliza para asignar el subtotal 
				$intSubtotalUnitario = 0;
				//Variable que se utiliza para asignar el costo 
				$intCostoTotal = 0;
				//Asignar horas de la mano de obra
	        	$intHoras = $arrServ->horas;
	        	//Asignar precio del servicio por mano de obra
	        	$intPrecio = $arrServ->precio;
	        	//Asignar costo del servicio por mano de obra
        		$intCosto = $arrServ->costo;

	        	//Calcular subtotal
	        	$intSubtotalUnitario = $intHoras * $intPrecio;

	        	//Calcular costo
        		$intCostoTotal  = $intHoras * $intCosto;

        		//Definir valores del array auxiliar de información (para cada detalle)
        		$arrAuxiliar["folio"] = '';
        		$arrAuxiliar["tipo"] = 'MANO DE OBRA';
        		$arrAuxiliar["fecha"] =  '';
        		$arrAuxiliar["costo"] = $intCostoTotal;
                $arrAuxiliar["precio"] = $intSubtotalUnitario;
                //Asignar datos al array
                array_push($arrDetalles, $arrAuxiliar); 

                //Incrementar acumulados por cada registro
                //Acumulados de la orden de reparación
			    $intAcumCostoOrden += $intCostoTotal;
			    $intAcumSubtotalOrden += $intSubtotalUnitario;
			    
				//Si el estatus es diferente de INACTIVO
			    if($strEstatus != 'INACTIVO')
			    {
				    //Acumulados generales
				    $intAcumGralCosto += $intCostoTotal;
				    $intAcumGralPrecio += $intSubtotalUnitario;
				    $intAcumGralCostoMO += $intCostoTotal;
				    $intAcumGralPrecioMO += $intSubtotalUnitario;
				}

	        }//Cierre de foreach

		}//Cierre de verificación de servicios de mano de obra


		//Seleccionar los otros servicios del registro
        $otdOtros = $this->ordenes->buscar_otros($intOrdenReparacionID);

        //Verificar si existe información de los otros servicios
		if($otdOtros)
		{
			//Recorremos el arreglo 
	        foreach ($otdOtros as $arrOtro) 
	        {
	        	//Variables que se utilizan para asignar valores del detalle
				$intCantidad =  number_format($arrOtro->cantidad, 2, '.', '');
				$intPrecioUnitario = $arrOtro->precio_unitario;
				//Variable que se utiliza para asignar el subtotal 
				$intSubtotalUnitario = 0;

				//Calcular subtotal
				$intSubtotalUnitario = $intCantidad * $intPrecioUnitario;

				//Definir valores del array auxiliar de información (para cada detalle)
        		$arrAuxiliar["folio"] = '';
        		$arrAuxiliar["tipo"] = 'OTROS';
        		$arrAuxiliar["fecha"] =  '';
        		$arrAuxiliar["costo"] = '';
                $arrAuxiliar["precio"] = $intSubtotalUnitario;
                //Asignar datos al array
                array_push($arrDetalles, $arrAuxiliar); 

                //Incrementar acumulados por cada registro
                //Acumulados de la orden de reparación
			    $intAcumSubtotalOrden += $intSubtotalUnitario;
			   
			    //Si el estatus es diferente de INACTIVO
			    if($strEstatus != 'INACTIVO')
			    {
				    //Acumulados generales
				    $intAcumGralPrecio += $intSubtotalUnitario;
				    $intAcumGralPrecioOtros += $intSubtotalUnitario;
				}

	        }//Cierre de foreach

		}//Cierre de verificación de otros servicios

		//Si existe importe de gastos de servicio 
		if($intGatosServiciosSubtotal > 0)
		{
			//Definir valores del array auxiliar de información (para cada detalle)
    		$arrAuxiliar["folio"] = '';
    		$arrAuxiliar["tipo"] = 'GASTOS DE SERVICIO';
    		$arrAuxiliar["fecha"] =  '';
    		$arrAuxiliar["costo"] = '';
            $arrAuxiliar["precio"] = $intGatosServiciosSubtotal;
            //Asignar datos al array
            array_push($arrDetalles, $arrAuxiliar); 

			//Incrementar acumulados por cada registro
			//Acumulados de la orden de reparación
			$intAcumSubtotalOrden += $intGatosServiciosSubtotal;
			
 			//Si el estatus es diferente de INACTIVO
		    if($strEstatus != 'INACTIVO')
		    {
				//Acumulados generales
				$intAcumGralPrecio += $intGatosServiciosSubtotal;
				$intAcumGralPrecioGS += $intGatosServiciosSubtotal;
			}

		}//Cierre de verificación de gastos de servicio 

		//Agregar datos al array
		$arrDatos['rows'] = $arrDetalles;
		$arrDatos['acumulado_costoOrden'] = $intAcumCostoOrden;
	    $arrDatos['acumulado_subtotalOrden'] = $intAcumSubtotalOrden;
	    $arrDatos['acumulado_gralCosto'] = $intAcumGralCosto;
	    $arrDatos['acumulado_gralPrecio'] = $intAcumGralPrecio;
	    $arrDatos['acumulado_gralCostoSR'] = $intAcumGralCostoSR;
	    $arrDatos['acumulado_gralPrecioSR'] = $intAcumGralPrecioSR;
	    $arrDatos['acumulado_gralCostoTF'] = $intAcumGralCostoTF;
	    $arrDatos['acumulado_gralPrecioTF'] = $intAcumGralPrecioTF;
	    $arrDatos['acumulado_gralCostoMO'] = $intAcumGralCostoMO;
	    $arrDatos['acumulado_gralPrecioMO'] = $intAcumGralPrecioMO;
	    $arrDatos['acumulado_gralPrecioOtros'] = $intAcumGralPrecioOtros;
	    $arrDatos['acumulado_gralPrecioGS'] = $intAcumGralPrecioGS;

	    //Regresar array con los detalles de la orden de reparación
		return $arrDatos;
	}

}	