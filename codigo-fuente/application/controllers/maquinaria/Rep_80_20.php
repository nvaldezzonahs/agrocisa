<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_80_20 extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Cargamos el modelo para consultar los datos
		$this->load->model('maquinaria/rep_80_20_model', 'ventas');
		//Cargamos el modelo de Clientes
		$this->load->model('crm/prospectos_model', 'prospectos');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('maquinaria/rep_80_20', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte()
	{
		
		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strTipo = $this->input->post('strTipo');
		$strSucursales = trim($this->input->post('strSucursales'));

		//Dependiendo del tipo generar reporte PDF
		if($strTipo == 'CLIENTES')
		{
			//Hacer un llamado a la función para generar reporte de clientes
			$this->get_reporte_clientes($strSucursales, $dteFechaInicial, $dteFechaFinal);	
		}
		else
		{
			//Hacer un llamado a la función para generar reporte de maquinarias
			$this->get_reporte_maquinarias($strSucursales, $dteFechaInicial, $dteFechaFinal);
		}
	}

	/*Método para generar un reporte PDF con el listado de CLIENTES dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte_clientes($strSucursales, $dteFechaInicial, $dteFechaFinal) 
	{	        
		//Variable que se utiliza pra asignar el id actual del cliente
		$intClienteIDActual = 0;
        //Variable que se utiliza para definir título de rango de fechas
        $strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Variable que se utiliza para contar el número de registros por cliente
		$intTotalVisitasCliente = 0;
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

		//Buscar el nombre de las sucursales que han sido seleccionadas y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 3
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


		//Se crea una instancia de la clase PDF
		$pdf = new PDF('L','mm','letter');//orientación horizontal

		//Asignar el valor de la descripción (título de la lista de registros) del reporte dependiendo del tipo de reporte
		$pdf->strLinea1 = 'VENTAS A CLIENTES 80-20';
		//Asignar el valor de la línea dos del título
		$pdf->strLinea2 =  'LISTADO DE MOVIMIENTOS '.$strTituloRangoFechas;
		//Asignar el valor de la línea tres del título
		$pdf->strLinea3 = utf8_decode('SUCURSALES: '.trim($strTituloSucursales));

		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('CLIENTE', 'LOCALIDAD', 'MUNICIPIO', 'ESTADO',  'SUBTOTAL', 'IVA', 'IEPS', 'TOTAL', 'NO. FACT.', '%PART.', '%ACUM.');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(60, 30, 30, 30, 20, 15, 15, 20, 16, 12, 12);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L', 'R', 'R', 'R', 'R', 'C', 'C', 'C');
		//Agregar la primer pagina
		$pdf->AddPage();
		
		
		//Variable para asignar el resultado
		$otdVentas = $this->ventas->ventas_clientes($dteFechaInicial, $dteFechaFinal, $strSucursales);
		//var_dump($otdVentas);

		//Si hay información
		if($otdVentas)
		{	

			$pdf->SetWidths($pdf->arrAnchura);

			//Obtener las ventas totales para ese rango de fechas
			$totalVentas = 0;
			//Recorremos el arreglo 
			foreach ($otdVentas as $arrCol)
			{
				$totalVentas += $arrCol->total;
			}

			//Variable para la acumulación porcentual de ventas
			$porcentajeAcumulado = 0;

			//Recorremos el arreglo 
			foreach ($otdVentas as $arrCol)
			{
				
				//Si es el primer registro y no existe id del cliente
      			if($intContador === 0 && $arrCol->prospecto_id === NULL)
      			{
					//Asignar id del cliente actual
      				$intClienteIDActual = $arrCol->prospecto_id;
      			}

				//Si el cliente actual es igual a cero (primer cliente)
	      		if ($intClienteIDActual === 0 && $arrCol->prospecto_id > 0)
	      		{
	      			//Limpiar las siguientes variables (por cada cliente recorrido)
      				$intClienteIDActual = $arrCol->prospecto_id;
	      		}

				//Si el cliente actual es diferente al anterior
	      		if($intClienteIDActual != $arrCol->prospecto_id && $arrCol->prospecto_id !== NULL)
	      		{
	      			//Limpiar las siguientes variables (por cada cliente recorrido)
	      			$intClienteIDActual = $arrCol->prospecto_id;
	      		}
	      		
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				$pdf->SetTextColor(0); //Establecer el color de texto por defecto
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
                $pdf->Row(array(utf8_decode($arrCol->cliente),
                				utf8_decode($arrCol->localidad), 
                				utf8_decode($arrCol->municipio),
                				utf8_decode($arrCol->estado),
                				'$'.number_format($arrCol->subtotal,2),
                				'$'.number_format($arrCol->iva, 2),
                				'$'.number_format($arrCol->ieps, 2),
                				'$'.number_format($arrCol->total, 2),
                				$arrCol->numero_facturas,
                				number_format(($arrCol->total * 100)/$totalVentas, 2),
                				number_format( (($arrCol->total * 100)/$totalVentas) +  $porcentajeAcumulado, 2)
                				),
                		       $pdf->arrAlineacion);
                
                $porcentajeAcumulado += number_format(($arrCol->total * 100)/$totalVentas, 2);

	            $pdf->Ln(1); //Deja un salto de línea
                //Incrementar el contador por cada registro
            	$intContador++;
			}

			//Espacios de salto de línea
			$pdf->Ln();
			//Asigna el tipo y tamaño de letra para los totales
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Escribe la cadena concatenada con el total de registros
	    	$pdf->Cell(0,3,'TOTAL: '.$intContador, 0, 0, 'R');

		}

		//Ejecutar la salida del reporte
        $pdf->Output('80-20.pdf','I'); 
	}

	/*Método para generar un reporte PDF con el listado de MAQUINARIAS dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte_maquinarias($strSucursales, $dteFechaInicial, $dteFechaFinal) 
	{	        
		//Variable que se utiliza pra asignar la maquinaria actual
		$strMaquinariaActual = '';
        //Variable que se utiliza para definir título de rango de fechas
        $strTituloRangoFechas = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Variable que se utiliza para contar el número de registros por cliente
		$intTotalVisitasCliente = 0;
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

		//Buscar el nombre de las sucursales que han sido seleccionadas y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 3
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


		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación horizontal

		//Asignar el valor de la descripción (título de la lista de registros) del reporte dependiendo del tipo de reporte
		$pdf->strLinea1 = 'VENTAS DE MAQUINARIA 80-20';
		//Asignar el valor de la línea dos del título
		$pdf->strLinea2 =  'LISTADO DE MOVIMIENTOS '.$strTituloRangoFechas;
		//Asignar el valor de la línea tres del título
		$pdf->strLinea3 = utf8_decode('SUCURSALES: '.trim($strTituloSucursales));

		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
			//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('MAQUINARIA',  'SUBTOTAL', 'IVA', 'IEPS', 'TOTAL', 'NO. FACT.', '%PART.', '%ACUM.');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(80, 20, 15, 15, 20, 16, 12, 12);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'R', 'R', 'R', 'R', 'C', 'C', 'C');
		//Agregar la primer pagina
		$pdf->AddPage();
	
		
		//Variable para asignar el resultado
		$otdVentas = $this->ventas->ventas_maquinarias($dteFechaInicial, $dteFechaFinal, $strSucursales);
		//var_dump($otdVentas);

		//Si hay información
		if($otdVentas)
		{	

			$pdf->SetWidths($pdf->arrAnchura);

			//Obtener las ventas totales para ese rango de fechas
			$totalVentas = 0;
			//Recorremos el arreglo 
			foreach ($otdVentas as $arrCol)
			{
				$totalVentas += $arrCol->total;
			}

			//Variable para la acumulación porcentual de ventas
			$porcentajeAcumulado = 0;

			//Recorremos el arreglo 
			foreach ($otdVentas as $arrCol)
			{
				
				//Si es el primer registro y no existe id del cliente
      			if($intContador === 0 && $arrCol->descripcion_corta === NULL)
      			{
					//Asignar maquinaria actual
      				$strMaquinariaActual = $arrCol->descripcion_corta;
      			}

				//Si la maquinaria actual es igual a '' (primera maquinaria)
	      		if ($strMaquinariaActual === '' && $arrCol->descripcion_corta != '')
	      		{
	      			//Limpiar las siguientes variables (por cada maquinaria recorrida)
      				$strMaquinariaActual = $arrCol->descripcion_corta;
	      		}

				//Si la maquinaria actual es diferente al anterior
	      		if($strMaquinariaActual != $arrCol->descripcion_corta && $arrCol->descripcion_corta !== NULL)
	      		{
	      			//Limpiar las siguientes variables (por cada maquinaria recorrida)
      				$strMaquinariaActual = $arrCol->descripcion_corta;
	      		}
	      		
				//Establece el ancho de las columnas
				$pdf->SetWidths($pdf->arrAnchura);
				$pdf->SetTextColor(0); //Establecer el color de texto por defecto
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
                $pdf->Row(array(utf8_decode($arrCol->descripcion_corta),
                				'$'.number_format($arrCol->subtotal,2),
                				'$'.number_format($arrCol->iva, 2),
                				'$'.number_format($arrCol->ieps, 2),
                				'$'.number_format($arrCol->total, 2),
                				$arrCol->numero_facturas,
                				number_format(($arrCol->total * 100)/$totalVentas, 2),
                				number_format( (($arrCol->total * 100)/$totalVentas) +  $porcentajeAcumulado, 2)
                				),
                		        $pdf->arrAlineacion);
                
                $porcentajeAcumulado += number_format(($arrCol->total * 100)/$totalVentas, 2);

	            $pdf->Ln(1); //Deja un salto de línea
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
        $pdf->Output('80-20.pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de los registros dependiendo del criterio de búsqueda proporcionado*/
   	public function get_xls()
   	{

   		//Variables que se utilizan para recuperar los valores de la vista
		$dteFechaInicial = $this->input->post('dteFechaInicial');
		$dteFechaFinal = $this->input->post('dteFechaFinal');
		$strTipo = $this->input->post('strTipo');
		$strSucursales = trim($this->input->post('strSucursales'));

		//Dependiendo del tipo generar reporte XLS
   		if($strTipo == 'CLIENTES')
   		{
   			//Hacer un llamado a la función para generar reporte de clientes
			$this->get_xls_clientes($dteFechaInicial, $dteFechaFinal, $strSucursales);		
		}
		else
		{
			//Hacer un llamado a la función para generar reporte de maquinarias
			$this->get_xls_maquinarias($dteFechaInicial, $dteFechaFinal, $strSucursales);
		}
   	}

	/*Método para generar un archivo XLS solo de CLIENTES con el listado de los registros dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls_clientes($dteFechaInicial, $dteFechaFinal, $strSucursales) 
	{	


		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable para modificiar el titulo del reporte
		$strTituloReporte = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 11;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 12;
        $intFilaInicial = 12;
		//Seleccionar los datos del registro que coincide con el id
		$intTipoMovimiento = 12;
		
		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');

		//Buscar el nombre de las sucursales que han sido seleccionadas y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 3
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


     	
     	$otdVentas = $this->ventas->ventas_clientes($dteFechaInicial, $dteFechaFinal, $strSucursales);
     	

     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        /*
		* HOJA CORRESPONDIENTE A LA INFORMACIÓN REPRESENTADA DE MANERA ACUMULADA
		*/
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
		//Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
				 ->setCellValue('A7', 'VENTAS A CLIENTES 80-20')
				 ->setCellValue('A8', 'LISTADO DE MOVIMIENTOS '.$strTituloRangoFechas)
				 ->setCellValue('A9', 'SUCURSALES: '.$strTituloSucursales);
	

     	//Se agregan las columnas de cabecera
		$objExcel->setActiveSheetIndex(0)
		     ->setCellValue('A'.$intPosEncabezados, 'CLIENTE')
             ->setCellValue('B'.$intPosEncabezados, 'LOCALIDAD')
             ->setCellValue('C'.$intPosEncabezados, 'MUNICIPIO')
             ->setCellValue('D'.$intPosEncabezados, 'ESTADO')
             ->setCellValue('E'.$intPosEncabezados, 'SUBTOTAL')
             ->setCellValue('F'.$intPosEncabezados, 'IVA')
             ->setCellValue('G'.$intPosEncabezados, 'IEPS')
             ->setCellValue('H'.$intPosEncabezados, 'TOTAL')
             ->setCellValue('I'.$intPosEncabezados, 'NO. FACT.')
             ->setCellValue('J'.$intPosEncabezados, '%PART.')
             ->setCellValue('K'.$intPosEncabezados, '%ACUM.');      

        //Definir estilos de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));
        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE, 'color' => array('rgb' => 'ffffff')));

         $arrStyleFuenteEncabezado = array('font' => array('bold' => TRUE,
        												  'name' => 'Arial',
        												  'size' => 10,
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

       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A8:D8')
        		 ->applyFromArray($arrStyleBold);

        $objExcel->getActiveSheet()
        		 ->getStyle('A9:D9')
        		 ->applyFromArray($arrStyleFuenteEncabezado);


        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet(0)
        		 ->getStyle('A11:K11')
        		 ->getFill()
        		 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet(0)
    	         ->getStyle('A11:K11')
    	         ->applyFromArray($arrStyleFuenteColumnas);	 

    	//Cambiar alineación de las siguientes celdas
    	$objExcel->getActiveSheet()
    			 ->getStyle('A9:D9')
    			 ->getAlignment()
    			 ->applyFromArray($arrStyleAlignmentLeft);

		$objExcel->getActiveSheet(0)
				 ->getStyle('A11:K11')
				 ->getAlignment()
				 ->applyFromArray($arrStyleAlignmentCenter);
		//Si hay información
		if ($otdVentas)
		{	
			//Obtener las ventas totales para ese rango de fechas
			$totalVentas = 0;
			foreach ($otdVentas as $arrCol)
			{
				$totalVentas += $arrCol->total;
			}
			//Variable para la acumulación porcentual de ventas
			$porcentajeAcumulado = 0;

			//Recorremos el arreglo 
			foreach ($otdVentas as $arrCol)
			{   
				
		    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValue('A'.$intFila, $arrCol->cliente)
							 ->setCellValue('B'.$intFila, $arrCol->localidad)
						     ->setCellValue('C'.$intFila, $arrCol->municipio)
						     ->setCellValue('D'.$intFila, $arrCol->estado)
						     ->setCellValue('E'.$intFila, $arrCol->subtotal)
							 ->setCellValue('F'.$intFila, $arrCol->iva)
							 ->setCellValue('G'.$intFila, $arrCol->ieps)
							 ->setCellValue('H'.$intFila, $arrCol->total)
							 ->setCellValue('I'.$intFila, $arrCol->numero_facturas)
	                         ->setCellValue('J'.$intFila, ($arrCol->total * 100)/$totalVentas )
					 		 ->setCellValue('K'.$intFila, (($arrCol->total * 100)/$totalVentas) +  $porcentajeAcumulado);

				//Acumulamos el porcentaje de participación	 		 
	            $porcentajeAcumulado += number_format(($arrCol->total * 100)/$totalVentas, 2);
	                         
	    		//Incrementar el indice para escribir los datos del siguiente registro
            	$intFila++; 
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet(0)->getStyle('E'.$intFilaInicial.':'.'H'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00');
            //Cambiar contenido de las celdas a formato númerico de 2 decimales
            $objExcel->getActiveSheet(0)->getStyle('J'.$intFilaInicial.':'.'K'.$intFila)->getNumberFormat()->setFormatCode('###0.00');

			//Cambiar alineación de las siguientes celdas
    		$objExcel->getActiveSheet(0)->getStyle('E'.$intFilaInicial.':'.'K'.$intFila)->getAlignment()->applyFromArray($arrStyleAlignmentRight);
            
		}


		/*
		* HOJA CORRESPONDIENTE A LA INFORMACIÓN REPRESENTADA DE MANERA MENSUAL
		*/
		//Agregar nueva hoja
		$otdVentasMensual = $this->ventas->ventas_clientes_mensual($dteFechaInicial, $dteFechaFinal, $strSucursales);
		//var_dump($otdVentasMensual);
		$strNombreHoja = 'Mensual';
		$objNuevaHoja = $objExcel->createSheet();
		//Marcar como activa la nueva hoja
		$objExcel->setActiveSheetIndex(1); 
		//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objNuevaHoja, 'nueva');
        //Definir nombre de la hoja
		$objNuevaHoja->setTitle($strNombreHoja);
		$objExcel->setActiveSheetIndex(1)->setCellValue('A7', $strTituloReporte);

		//Preferencias de color de relleno de celda
        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE, 'color' => array('rgb' => 'ffffff')));
    	$arrStyleFuenteNormal = array('font' => array('bold' => FALSE, 'color' => array('rgb' => '000000')));  
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));
        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));
        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        //Formato del celda Porcentaje
        $format_percent =  array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
		//Se agregan las columnas de cabecera
        //Titulo de las columnas
		$objExcel->setActiveSheetIndex(1)->setCellValue('E8', 'ENERO');
		$objExcel->setActiveSheetIndex(1)->setCellValue('H8', 'FEBRERO');
		$objExcel->setActiveSheetIndex(1)->setCellValue('K8', 'MARZO');
		$objExcel->setActiveSheetIndex(1)->setCellValue('N8', 'ABRIL');
		$objExcel->setActiveSheetIndex(1)->setCellValue('Q8', 'MAYO');
		$objExcel->setActiveSheetIndex(1)->setCellValue('T8', 'JUNIO');
		$objExcel->setActiveSheetIndex(1)->setCellValue('W8', 'JULIO');
		$objExcel->setActiveSheetIndex(1)->setCellValue('Z8', 'AGOSTO');
		$objExcel->setActiveSheetIndex(1)->setCellValue('AC8', 'SEPTIEMBRE');
		$objExcel->setActiveSheetIndex(1)->setCellValue('AF8', 'OCTUBRE');
		$objExcel->setActiveSheetIndex(1)->setCellValue('AI8', 'NOVIEMBRE');
		$objExcel->setActiveSheetIndex(1)->setCellValue('AL8', 'DICIEMBRE');
		$objExcel->setActiveSheetIndex(1)->setCellValue('AO8', 'ANUAL');
		//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet(1)->getStyle('E8:AQ8')->applyFromArray($arrStyleBold);
        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet(1)->getStyle('E8:AQ8')->getFill()->applyFromArray($arrStyleColumnas);
        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet(1)->getStyle('E8:AQ8')->applyFromArray($arrStyleFuenteColumnas);
    	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet(1)->getStyle('A9:AQ9')->applyFromArray($arrStyleBold);
        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet(1)->getStyle('A9:AQ9')->getFill()->applyFromArray($arrStyleColumnas);
        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet(1)->getStyle('A9:AQ9')->applyFromArray($arrStyleFuenteColumnas);

    	//Subtitulos de las columnas
    	//Restablecemos la posición del encabezado para los subtitulos
    	$intPosEncabezados = 9;
        $objExcel->setActiveSheetIndex(1)
        		 ->setCellValue('A'.$intPosEncabezados, 'CLIENTE')
        		 ->setCellValue('B'.$intPosEncabezados, 'LOCALIDAD')
        		 ->setCellValue('C'.$intPosEncabezados, 'MUNICIPIO')
                 ->setCellValue('D'.$intPosEncabezados, 'ESTADO')
                 ->setCellValue('E'.$intPosEncabezados, 'NO. FACT.')
                 ->setCellValue('F'.$intPosEncabezados, 'VENTA $')
                 ->setCellValue('G'.$intPosEncabezados, 'PART. %')
                 ->setCellValue('H'.$intPosEncabezados, 'NO. FACT.')
                 ->setCellValue('I'.$intPosEncabezados, 'VENTA $')
                 ->setCellValue('J'.$intPosEncabezados, 'PART. %')
                 ->setCellValue('K'.$intPosEncabezados, 'NO. FACT.')
                 ->setCellValue('L'.$intPosEncabezados, 'VENTA $')
                 ->setCellValue('M'.$intPosEncabezados, 'PART. %')
                 ->setCellValue('N'.$intPosEncabezados, 'NO. FACT.')
                 ->setCellValue('O'.$intPosEncabezados, 'VENTA $')
                 ->setCellValue('P'.$intPosEncabezados, 'PART. %')
                 ->setCellValue('Q'.$intPosEncabezados, 'NO. FACT.')
                 ->setCellValue('R'.$intPosEncabezados, 'VENTA $')
                 ->setCellValue('S'.$intPosEncabezados, 'PART. %')
                 ->setCellValue('T'.$intPosEncabezados, 'NO. FACT.')
                 ->setCellValue('U'.$intPosEncabezados, 'VENTA $')
                 ->setCellValue('V'.$intPosEncabezados, 'PART. %')
                 ->setCellValue('W'.$intPosEncabezados, 'NO. FACT.')
                 ->setCellValue('X'.$intPosEncabezados, 'VENTA $')
                 ->setCellValue('Y'.$intPosEncabezados, 'PART. %')
                 ->setCellValue('Z'.$intPosEncabezados, 'NO. FACT.')
                 ->setCellValue('AA'.$intPosEncabezados, 'VENTA $')
                 ->setCellValue('AB'.$intPosEncabezados, 'PART. %')
                 ->setCellValue('AC'.$intPosEncabezados, 'NO. FACT.')
                 ->setCellValue('AD'.$intPosEncabezados, 'VENTA $')
                 ->setCellValue('AE'.$intPosEncabezados, 'PART. %')
                 ->setCellValue('AF'.$intPosEncabezados, 'NO. FACT.')
                 ->setCellValue('AG'.$intPosEncabezados, 'VENTA $')
                 ->setCellValue('AH'.$intPosEncabezados, 'PART. %')
                 ->setCellValue('AI'.$intPosEncabezados, 'NO. FACT.')
                 ->setCellValue('AJ'.$intPosEncabezados, 'VENTA $')
                 ->setCellValue('AK'.$intPosEncabezados, 'PART. %')
                 ->setCellValue('AL'.$intPosEncabezados, 'NO. FACT.')
                 ->setCellValue('AM'.$intPosEncabezados, 'VENTA $')
                 ->setCellValue('AN'.$intPosEncabezados, 'PART. %')
                 ->setCellValue('AO'.$intPosEncabezados, 'NO. FACT.')
                 ->setCellValue('AP'.$intPosEncabezados, 'VENTA $')
                 ->setCellValue('AQ'.$intPosEncabezados, 'PART. %');

    	//Combinar las siguientes celdas
       	$objExcel->setActiveSheetIndex(1)->mergeCells('E8:G8');
       	$objExcel->setActiveSheetIndex(1)->mergeCells('H8:J8');
       	$objExcel->setActiveSheetIndex(1)->mergeCells('K8:M8');
       	$objExcel->setActiveSheetIndex(1)->mergeCells('N8:P8');	
       	$objExcel->setActiveSheetIndex(1)->mergeCells('Q8:S8');
       	$objExcel->setActiveSheetIndex(1)->mergeCells('T8:V8');
       	$objExcel->setActiveSheetIndex(1)->mergeCells('W8:Y8');
       	$objExcel->setActiveSheetIndex(1)->mergeCells('Z8:AB8'); 
       	$objExcel->setActiveSheetIndex(1)->mergeCells('AC8:AE8');
       	$objExcel->setActiveSheetIndex(1)->mergeCells('AF8:AH8');
       	$objExcel->setActiveSheetIndex(1)->mergeCells('AI8:AK8');
       	$objExcel->setActiveSheetIndex(1)->mergeCells('AL8:AN8'); 
       	$objExcel->setActiveSheetIndex(1)->mergeCells('AO8:AQ8');

       	$objExcel->getActiveSheet(1)->getStyle('E8:G8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet(1)->getStyle('H8:J8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet(1)->getStyle('K8:M8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet(1)->getStyle('N8:P8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet(1)->getStyle('Q8:S8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet(1)->getStyle('T8:V8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet(1)->getStyle('W8:Y8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet(1)->getStyle('Z8:AB8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet(1)->getStyle('AC8:AE8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet(1)->getStyle('AF8:AH8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet(1)->getStyle('AI8:AK8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet(1)->getStyle('AL8:AN8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);
        $objExcel->getActiveSheet(1)->getStyle('AO8:AQ8')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);

        $objExcel->getActiveSheet(1)->getStyle('E8:AQ8')->getFill()->applyFromArray($arrStyleColumnas); 
        $objExcel->getActiveSheet(1)->getStyle('A9:AQ9')->getFill()->applyFromArray($arrStyleColumnas);
        $objExcel->getActiveSheet(1)->getStyle('A9:AQ9')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);

        //Si hay información
		if ($otdVentasMensual)
		{
			//Obtener las ventas totales por mes
			$totalVentasEnero = 0; $totalVentasFebrero = 0; $totalVentasMarzo = 0; $totalVentasAbril = 0; $totalVentasMayo = 0; $totalVentasJunio = 0;
			$totalVentasJulio = 0; $totalVentasAgosto = 0; $totalVentasSeptiembre = 0; $totalVentasOctubre = 0; $totalVentasNoviembre = 0; $totalVentasDiciembre = 0;
			$totalVentasAnuales = 0;
			foreach ($otdVentasMensual as $arrCol)
			{
				$totalVentasEnero += $arrCol->TotalEnero;
				$totalVentasFebrero += $arrCol->TotalFebrero;
				$totalVentasMarzo += $arrCol->TotalMarzo;
				$totalVentasAbril += $arrCol->TotalAbril;
				$totalVentasMayo += $arrCol->TotalMayo;
				$totalVentasJunio += $arrCol->TotalJunio;
				$totalVentasJulio += $arrCol->TotalJulio;
				$totalVentasAgosto += $arrCol->TotalAgosto;
				$totalVentasSeptiembre += $arrCol->TotalSeptiembre;
				$totalVentasOctubre += $arrCol->TotalOctubre;
				$totalVentasNoviembre += $arrCol->TotalNoviembre;
				$totalVentasDiciembre += $arrCol->TotalDiciembre;
				$totalVentasAnuales += $arrCol->TotalAnual;
			}

			//Inicializamos esta variable para insertar la información desde este renglón en esta hoja
			$intFila = 10;
			foreach ($otdVentasMensual as $arrCol)
			{
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(1)
						 ->setCellValue('A'.$intFila, $arrCol->cliente)
					     ->setCellValue('B'.$intFila, $arrCol->localidad)
					     ->setCellValue('C'.$intFila, $arrCol->municipio)
					     ->setCellValue('D'.$intFila, $arrCol->estado)

					     ->setCellValue('E'.$intFila, $arrCol->FacturasEnero)
					     ->setCellValue('F'.$intFila, $arrCol->TotalEnero)
					     ->setCellValue('G'.$intFila, $this->division_zero($arrCol->TotalEnero, $totalVentasEnero))

					     ->setCellValue('H'.$intFila, $arrCol->FacturasFebrero)
						 ->setCellValue('I'.$intFila, $arrCol->TotalFebrero)
						 ->setCellValue('J'.$intFila, $this->division_zero($arrCol->TotalFebrero, $totalVentasFebrero))
						 
						 ->setCellValue('K'.$intFila, $arrCol->FacturasMarzo)
					     ->setCellValue('L'.$intFila, $arrCol->TotalMarzo)
					     ->setCellValue('M'.$intFila, $this->division_zero($arrCol->TotalMarzo, $totalVentasMarzo))
					     
					     ->setCellValue('N'.$intFila, $arrCol->FacturasAbril)
					     ->setCellValue('O'.$intFila, $arrCol->TotalAbril)
					     ->setCellValue('P'.$intFila, $this->division_zero($arrCol->TotalAbril, $totalVentasAbril))
					     
					     ->setCellValue('Q'.$intFila, $arrCol->FacturasMayo)
					     ->setCellValue('R'.$intFila, $arrCol->TotalMayo)
					     ->setCellValue('S'.$intFila, $this->division_zero($arrCol->TotalMayo, $totalVentasMayo))

					     ->setCellValue('T'.$intFila, $arrCol->FacturasJunio)
					     ->setCellValue('U'.$intFila, $arrCol->TotalJunio)
					     ->setCellValue('V'.$intFila, $this->division_zero($arrCol->TotalJunio, $totalVentasJunio))
					     
					     ->setCellValue('W'.$intFila, $arrCol->FacturasJulio)
					     ->setCellValue('X'.$intFila, $arrCol->TotalJulio)
					     ->setCellValue('Y'.$intFila, $this->division_zero($arrCol->TotalJulio, $totalVentasJulio))
					     
					     ->setCellValue('Z'.$intFila, $arrCol->FacturasAgosto)
					     ->setCellValue('AA'.$intFila, $arrCol->TotalAgosto)
					     ->setCellValue('AB'.$intFila, $this->division_zero($arrCol->TotalAgosto, $totalVentasAgosto))
						 
						 ->setCellValue('AC'.$intFila, $arrCol->FacturasSeptiembre)
						 ->setCellValue('AD'.$intFila, $arrCol->TotalSeptiembre)
						 ->setCellValue('AE'.$intFila, $this->division_zero($arrCol->TotalSeptiembre, $totalVentasSeptiembre) )

					     ->setCellValue('AF'.$intFila, $arrCol->FacturasOctubre)
					     ->setCellValue('AG'.$intFila, $arrCol->TotalOctubre)
					     ->setCellValue('AH'.$intFila, $this->division_zero($arrCol->TotalOctubre, $totalVentasOctubre) )
					     
					     ->setCellValue('AI'.$intFila, $arrCol->FacturasNoviembre)
					     ->setCellValue('AJ'.$intFila, $arrCol->TotalNoviembre)
					     ->setCellValue('AK'.$intFila, $this->division_zero($arrCol->TotalNoviembre, $totalVentasOctubre) )
					     
					     ->setCellValue('AL'.$intFila, $arrCol->FacturasDiciembre)
					     ->setCellValue('AM'.$intFila, $arrCol->TotalDiciembre)
					     ->setCellValue('AN'.$intFila, $this->division_zero($arrCol->TotalDiciembre, $totalVentasDiciembre) )

					     ->setCellValue('AO'.$intFila, $arrCol->FacturasAnuales)
					     ->setCellValue('AP'.$intFila, $arrCol->TotalAnual)
					     ->setCellValue('AQ'.$intFila, $this->division_zero($arrCol->TotalAnual, $totalVentasAnuales));
					     
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++;
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet(0)->getStyle('F'.$intFilaInicial.':'.'F'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00');
            $objExcel->getActiveSheet(0)->getStyle('I'.$intFilaInicial.':'.'I'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00');
            $objExcel->getActiveSheet(0)->getStyle('L'.$intFilaInicial.':'.'L'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00');
            $objExcel->getActiveSheet(0)->getStyle('O'.$intFilaInicial.':'.'O'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00');
            $objExcel->getActiveSheet(0)->getStyle('R'.$intFilaInicial.':'.'R'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00');
            $objExcel->getActiveSheet(0)->getStyle('U'.$intFilaInicial.':'.'U'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00');
            $objExcel->getActiveSheet(0)->getStyle('X'.$intFilaInicial.':'.'X'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00');
            $objExcel->getActiveSheet(0)->getStyle('AA'.$intFilaInicial.':'.'AA'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00');
            $objExcel->getActiveSheet(0)->getStyle('AD'.$intFilaInicial.':'.'AD'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00');
            $objExcel->getActiveSheet(0)->getStyle('AG'.$intFilaInicial.':'.'AG'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00');
            $objExcel->getActiveSheet(0)->getStyle('AJ'.$intFilaInicial.':'.'AJ'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00');
            $objExcel->getActiveSheet(0)->getStyle('AM'.$intFilaInicial.':'.'AM'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00');
            $objExcel->getActiveSheet(0)->getStyle('AP'.$intFilaInicial.':'.'AP'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00');
            //Cambiar contenido de las celdas a formato númerico de 2 decimales
            $objExcel->getActiveSheet(0)->getStyle('G'.$intFilaInicial.':'.'G'.$intFila)->getNumberFormat()->setFormatCode('###0.00');
            $objExcel->getActiveSheet(0)->getStyle('J'.$intFilaInicial.':'.'J'.$intFila)->getNumberFormat()->setFormatCode('###0.00');
            $objExcel->getActiveSheet(0)->getStyle('M'.$intFilaInicial.':'.'M'.$intFila)->getNumberFormat()->setFormatCode('###0.00');
            $objExcel->getActiveSheet(0)->getStyle('P'.$intFilaInicial.':'.'P'.$intFila)->getNumberFormat()->setFormatCode('###0.00');
            $objExcel->getActiveSheet(0)->getStyle('S'.$intFilaInicial.':'.'S'.$intFila)->getNumberFormat()->setFormatCode('###0.00');
            $objExcel->getActiveSheet(0)->getStyle('V'.$intFilaInicial.':'.'V'.$intFila)->getNumberFormat()->setFormatCode('###0.00');
            $objExcel->getActiveSheet(0)->getStyle('Y'.$intFilaInicial.':'.'Y'.$intFila)->getNumberFormat()->setFormatCode('###0.00');
            $objExcel->getActiveSheet(0)->getStyle('AB'.$intFilaInicial.':'.'AB'.$intFila)->getNumberFormat()->setFormatCode('###0.00');
            $objExcel->getActiveSheet(0)->getStyle('AE'.$intFilaInicial.':'.'AE'.$intFila)->getNumberFormat()->setFormatCode('###0.00');
            $objExcel->getActiveSheet(0)->getStyle('AH'.$intFilaInicial.':'.'AH'.$intFila)->getNumberFormat()->setFormatCode('###0.00');
            $objExcel->getActiveSheet(0)->getStyle('AK'.$intFilaInicial.':'.'AK'.$intFila)->getNumberFormat()->setFormatCode('###0.00');
            $objExcel->getActiveSheet(0)->getStyle('AN'.$intFilaInicial.':'.'AN'.$intFila)->getNumberFormat()->setFormatCode('###0.00');
            $objExcel->getActiveSheet(0)->getStyle('AQ'.$intFilaInicial.':'.'AQ'.$intFila)->getNumberFormat()->setFormatCode('###0.00');

		}
		
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, '80-20.xls', 'Acumulado', $intFila);
	}

	//Función para controlar las posibles divisiones con cociente ZERO
	public function division_zero($divisor, $dividendo){
	   
	   if($dividendo != 0){
	     $resultado = ($divisor * 100)/$dividendo;
	   }
	   else{ //Si el resultado es zero entonces otorgar el valor 0
	     $resultado = 0;
	   }

	   return $resultado;

	}

	/*Método para generar un archivo XLS solo de MAQUINARIAS con el listado de los registros dependiendo del criterio de búsqueda proporcionado*/
	public function get_xls_maquinarias($dteFechaInicial, $dteFechaFinal, $strSucursales) 
	{	
		//Variable que se utiliza para asignar título del rango de fechas
		$strTituloRangoFechas = '';
		//Variable para modificiar el titulo del reporte
		$strTituloReporte = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 11;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 12;
        $intFilaInicial = 12;


		//Hacer un llamado a la función get_fecha_formato_letra para cambiar fecha a formato con letra
		//por ejemplo: 2017-10-16 a 16/OCT/2017 
		$strTituloRangoFechas = 'ENTRE '.$this->get_fecha_formato_letra($dteFechaInicial, 'C');
		$strTituloRangoFechas .= ' Y '.$this->get_fecha_formato_letra($dteFechaFinal, 'C');


		//Buscar el nombre de las sucursales que han sido seleccionadas y por tanto apareceran en el reporte
	    //Variable para concatenar lo que será impreso en el titulo del renglon 3
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


     	//Seleccionar los datos de los registros que coinciden con el parámetro enviado
     	$otdVentas = $this->ventas->ventas_maquinarias($dteFechaInicial, $dteFechaFinal, $strSucursales);
     
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
		$objExcel->setActiveSheetIndex(0)
				 ->setCellValue('A7', 'VENTAS DE MAQUINARIA 80-20')
				 ->setCellValue('A8', 'LISTADO DE MOVIMIENTOS '.$strTituloRangoFechas)
				 ->setCellValue('A9', 'SUCURSALES: '.$strTituloSucursales);

     	//Se agregan las columnas de cabecera
		$objExcel->setActiveSheetIndex(0)
		     ->setCellValue('A'.$intPosEncabezados, 'MAQUINARIA')
             ->setCellValue('B'.$intPosEncabezados, 'SUBTOTAL')
             ->setCellValue('C'.$intPosEncabezados, 'IVA')
             ->setCellValue('D'.$intPosEncabezados, 'IEPS')
             ->setCellValue('E'.$intPosEncabezados, 'TOTAL')
             ->setCellValue('F'.$intPosEncabezados, 'NO. FACT.')
             ->setCellValue('G'.$intPosEncabezados, '%PART.')
             ->setCellValue('H'.$intPosEncabezados, '%ACUM.');      

        //Definir estilos de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE, 'color' => array('rgb' => 'ffffff')));

        $arrStyleFuenteEncabezado = array('font' => array('bold' => TRUE,
        												  'name' => 'Arial',
        												  'size' => 10,
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

       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet()
        		 ->getStyle('A8:D8')
        		 ->applyFromArray($arrStyleBold);

        $objExcel->getActiveSheet()
        		 ->getStyle('A9:D9')
        		 ->applyFromArray($arrStyleFuenteEncabezado);

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()->getStyle('A11:H11')
        		 ->getFill()
        		 ->applyFromArray($arrStyleColumnas);

        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet()
    	         ->getStyle('A11:H11')
    	         ->applyFromArray($arrStyleFuenteColumnas);
    			 
    	//Cambiar alineación de las siguientes celdas
    	$objExcel->getActiveSheet()
    			 ->getStyle('A9:D9')
    			 ->getAlignment()
    			 ->applyFromArray($arrStyleAlignmentLeft);

		$objExcel->getActiveSheet()
				 ->getStyle('A11:H11')
				 ->getAlignment()
				 ->applyFromArray($arrStyleAlignmentCenter);



		//Si hay información
		if ($otdVentas)
		{	

			//Obtener las ventas totales para ese rango de fechas
			$totalVentas = 0;
			foreach ($otdVentas as $arrCol)
			{
				$totalVentas += $arrCol->total;
			}
			//Variable para la acumulación porcentual de ventas
			$porcentajeAcumulado = 0;

			//Recorremos el arreglo 
			foreach ($otdVentas as $arrCol)
			{   
				
		    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValue('A'.$intFila, $arrCol->descripcion_corta)
						     ->setCellValue('B'.$intFila, $arrCol->subtotal)
							 ->setCellValue('C'.$intFila, $arrCol->iva)
							 ->setCellValue('D'.$intFila, $arrCol->ieps)
							 ->setCellValue('E'.$intFila, $arrCol->total)
							 ->setCellValue('F'.$intFila, $arrCol->numero_facturas)
	                         ->setCellValue('G'.$intFila, ($arrCol->total * 100)/$totalVentas )
					 		 ->setCellValue('H'.$intFila, (($arrCol->total * 100)/$totalVentas) +  $porcentajeAcumulado);

				//Acumulamos el porcentaje de participación	 		 
	            $porcentajeAcumulado += number_format(($arrCol->total * 100)/$totalVentas, 2);
	                         
	    		//Incrementar el indice para escribir los datos del siguiente registro
            	$intFila++; 
			}

			//Cambiar contenido de las celdas a formato moneda
            $objExcel->getActiveSheet()->getStyle('B'.$intFilaInicial.':'.'E'.$intFila)->getNumberFormat()->setFormatCode('$#,##0.00');
            //Cambiar contenido de las celdas a formato númerico de 2 decimales
            $objExcel->getActiveSheet()->getStyle('G'.$intFilaInicial.':'.'H'.$intFila)->getNumberFormat()->setFormatCode('###0.00');

			//Cambiar alineación de las siguientes celdas
    		$objExcel->getActiveSheet()->getStyle('B'.$intFilaInicial.':'.'H'.$intFila)->getAlignment()->applyFromArray($arrStyleAlignmentRight);
            
		}
		
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, '80-20.xls', '80-20', $intFila);
	}


}