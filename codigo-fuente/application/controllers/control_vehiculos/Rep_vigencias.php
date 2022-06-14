<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_vigencias extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('control_vehiculos/rep_vigencias_model', 'vigencias');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('control_vehiculos/rep_vigencias', $arrDatos);
	}

	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	/*Método para generar un reporte PDF con el listado de LICENCIAS o PÓLIZAS según
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_reporte($strTipo) 
	{	
		switch ($strTipo) {
		    case 'LICENCIAS':
		        //Hacer un llamado a la función para generar un reporte PDF con el listado de licencias
				$this->get_reporte_licencias();
		        break;
		    case 'POLIZAS':
		        //Hacer un llamado a la función para generar un reporte PDF con el listado de pólizas
				$this->get_reporte_polizas();
		        break;
		    case 'VERIFICACIONES':
		        //Hacer un llamado a la función para generar un reporte PDF con el listado de verificaciones
				$this->get_reporte_verificaciones();
		        break;
		}
	}

	/*Método para generar un reporte PDF con el listado de las licencias*/
	public function get_reporte_licencias() 
	{	        
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');

		//Seleccionar los datos de las licencias vencidas y vigentes
		$otdLicenciasVencidas = $this->vigencias->licencias_vencidas(); 
		$otdLicenciasVigentes = $this->vigencias->licencias_vigentes(); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		//$pdf->strLinea1= 'LISTADO DE VIGENCIAs '.$strTituloRangoFechas;
		$pdf->strLinea1 = 'LISTADO DE VIGENCIA DE LICENCIAS';
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array('EMPLEADO', 'LICENCIA', 'TIPO', utf8_decode('EXPEDICIÓN'), 'VIGENCIA');
		$pdf->arrCabecera2 = array('SUCURSAL', 'DEPARTAMENTO', 'PUESTO');

		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(90, 25, 25, 25, 25);
		$pdf->arrAnchura2 = array(63, 64, 63);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'C', 'C');
		$pdf->arrAlineacion2 = array('L', 'L', 'L');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Si se encuentran licencias vencidas
		if($otdLicenciasVencidas){
			//Asigna el tipo y tamaño de letra para un subtitulo
			$pdf->Ln();
			$pdf->SetTextColor(0);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			//Subtitulo
			$pdf->Cell(20, 5, 'VENCIDAS', 0, 0, 'L', 0);
			$pdf->Ln();
			foreach ($otdLicenciasVencidas as $arrCol)
			{ 
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->SetWidths($pdf->arrAnchura);
				$pdf->Row(array($arrCol->empleado, $arrCol->licencia_manejo, $arrCol->licencia_tipo, 
								 $arrCol->licencia_expedicion, $arrCol->licencia_vigencia), 
						  $pdf->arrAlineacion);

				$pdf->SetWidths($pdf->arrAnchura2);
				$pdf->Row(array(utf8_decode($arrCol->sucursal), utf8_decode($arrCol->departamento),
								utf8_decode($arrCol->puesto)), 
						  $pdf->arrAlineacion2);
				
				//Dibuja una línea para separar la información de cada prospecto
	    		$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
			}
		}

		//Si se encuentran licencias por vencer
		if($otdLicenciasVigentes){
			//Asigna el tipo y tamaño de letra para un subtitulo
			$pdf->Ln();
			$pdf->SetTextColor(0);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			//Subtitulo
			$pdf->Cell(20, 5, 'POR VENCER', 0, 0, 'L', 0);
			$pdf->Ln();
			foreach ($otdLicenciasVigentes as $arrCol)
			{ 
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->SetWidths($pdf->arrAnchura);
				$pdf->Row( array($arrCol->empleado, $arrCol->licencia_manejo, $arrCol->licencia_tipo, 
								 $arrCol->licencia_expedicion, $arrCol->licencia_vigencia), 
								 $pdf->arrAlineacion);

				$pdf->SetWidths($pdf->arrAnchura2);
				$pdf->Row(array(utf8_decode($arrCol->sucursal), utf8_decode($arrCol->departamento), 
								utf8_decode($arrCol->puesto)), 
						  $pdf->arrAlineacion2);
				
				//Dibuja una línea para separar la información de cada prospecto
	    		$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
			}
		}
	
		//Espacios de salto de línea
        $pdf->Ln();
        //Ejecutar la salida del reporte
        $pdf->Output('licencias_vigentes'.'pdf','I'); 
	}

	
	/*Método para generar un reporte PDF con el listado de las pólizas*/
	public function get_reporte_polizas() 
	{	        
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');

		//Seleccionar los datos de las licencias vencidas y vigentes
		$otdPolizasVencidas = $this->vigencias->polizas_vencidas(); 
		$otdPolizasVigentes = $this->vigencias->polizas_vigentes(); 
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1 = utf8_decode('LISTADO DE VIGENCIA DE PÓLIZAS');
		//Establece los títulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('CÓDIGO'), 'MODELO', 'MARCA', 'ASEGURADORA', 
								  utf8_decode('PÓLIZA'), 'COSTO', utf8_decode('RENOVACIÓN'));
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(15, 30, 35, 40, 30, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'L', 'L', 'L', 'R', 'C');
		//Agregar la primer pagina
		$pdf->AddPage();
		
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		

		//Si se encuentran licencias vencidas
		if($otdPolizasVencidas){
			$pdf->SetTextColor(0);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			//Subtitulo
			$pdf->Cell(20, 5, 'VENCIDAS', 0, 0, 'L', 0);
			$pdf->Ln();
			foreach ($otdPolizasVencidas as $arrCol)
			{ 
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->Row(array(utf8_decode($arrCol->codigo), 
								 utf8_decode($arrCol->modelo), 
								 utf8_decode($arrCol->marca),
								 utf8_decode($arrCol->aseguradora), 
								 utf8_decode($arrCol->poliza),
								 '$'.number_format($arrCol->costo_poliza, 2),
								 utf8_decode($arrCol->fecha_renovacion)), 
						  $pdf->arrAlineacion);
			}


			$pdf->Ln();
		}

		//Si se encuentran licencias por vencer
		if($otdPolizasVigentes){
		
			$pdf->SetTextColor(0);
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			//Subtitulo
			$pdf->Cell(20, 5, 'POR VENCER', 0, 0, 'L', 0);
			$pdf->Ln();
			foreach ($otdPolizasVigentes as $arrCol)
			{ 
				//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
				$pdf->SetWidths($pdf->arrAnchura);
				$pdf->Row(array(utf8_decode($arrCol->codigo), 
								 utf8_decode($arrCol->modelo), 
								 utf8_decode($arrCol->marca),
								 utf8_decode($arrCol->aseguradora), 
								 utf8_decode($arrCol->poliza),
								 '$'.number_format($arrCol->costo_poliza, 2),
								 utf8_decode($arrCol->fecha_renovacion)), 
						  $pdf->arrAlineacion);
			}
		}
	
		//Espacios de salto de línea
        $pdf->Ln();
        //Ejecutar la salida del reporte
        $pdf->Output('polizas_vigentes'.'pdf','I'); 
	}

	/*Método para generar un reporte PDF con el listado de las verificaciones*/
	public function get_reporte_verificaciones() 
	{	        
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');

		//Seleccionar los datos de los vehículos activos
 		$otdVehiculos = $this->vigencias->vehiculos_activos();

		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//Asignar el nombre del usuario que se encuantra logeado en el sistema
		//para el pie de pagina del PDF
		$pdf->strUsuario = $this->session->userdata('usuario');
		//Asignar el valor del id de la sucursal que se encuantra logeada en el sistema
		//para el encabezado del PDF
		$pdf->intSucursalID = $this->session->userdata('sucursal_id');
		//Asignar el valor de la descripción (título de la lista de registros) del reporte
		$pdf->strLinea1= utf8_decode('LISTADO DE VIGENCIA DE VERIFICACIONES');
		//Agregar la primer pagina
		$pdf->AddPage();
		
		
		//Crea los titulos de la cabecera
		$arrCabecera1 = array( utf8_decode('VEHICULARES') );
		$arrCabecera2 = array( utf8_decode('EMISIONES CONTAMINANTES') );
		$arrCabecera3 = array( utf8_decode('FÍSICO MECÁNICAS') );
		//Establece el ancho de las columnas de cabecera
		$arrAnchura1 = array(190);

		/*
		******************************************************************************************************
		******************************************************************************************************
		BLOQUE DE CÓDIGO CORRESPONDIENTE A LAS VERFICACIONES ESTATALES VEHICULARES
		******************************************************************************************************
		******************************************************************************************************
		*/
		//Establece el ancho de las columnas de la tabla vehículos
		$arrAchuraVehiculos = array(38, 38, 38, 38, 38);
		//Establece la alineación de las celdas de la tabla vehículos
		$arrAlineacionVehiculos = array('L', 'L', 'L', 'L', 'L');

		//Establece el ancho de las columnas de la tabla vehículos verificables
		$arrAchuraVehiculosVerificables = array(20, 30, 30, 20, 30, 30, 30);
		//Establece la alineación de las celdas de la tabla vehículos verificables
		$arrAlineacionVehiculosVerificables = array('L', 'L', 'L', 'L', 'L', 'L', 'L');

		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Recorre el array de titulos de encabezado para crearlos
		for ($intCont = 0; $intCont < count($arrCabecera1); $intCont++)
		{
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//inserta los titulos de la cabecera
			$pdf->Cell($arrAnchura1[$intCont], 7, $arrCabecera1[$intCont], 1, 0, 'C', TRUE);
		}
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAnchura1);
		//Espacios de salto de línea
        $pdf->Ln(8);

        if($otdVehiculos){

        	//Obtenemos el mes y año actual para realizar las comparaciones correspondientes
        	$mes = date('m');
        	$anio = date('Y');
        	//Array que se utiliza para agregar los datos de los vehiculos exentos
		    $arrVehiculosExentos = array();
		    $arrVehiculosVerificarVencidos = array();
		    $arrVehiculosVerificarVencer = array();
		   	$arrAuxiliar = array();

		   	//Creamos la inicialización de la matrices de comparación
		   	$arrVerificacionesVehicularesObligatorias = array();
		   	$arrVerificacionesVehicularesEfectuadas = array();
		   	foreach ($otdVehiculos as $arrCol)
			{ 
				array_push($arrVerificacionesVehicularesObligatorias, array($arrCol->vehiculo_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0) );
				array_push($arrVerificacionesVehicularesEfectuadas, array($arrCol->vehiculo_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0) );  
			}

			//Cargamos los meses para los cuales un vehículo debe llevar a cabo su verificación vehicular obligatoria
			$index = 0;
        	foreach ($otdVehiculos as $arrCol)
			{ 
				//Definir valores del array de información (para cada vehículo)
				$arrAuxiliar["codigo"] = $arrCol->codigo;
				$arrAuxiliar["modelo"] = utf8_decode($arrCol->modelo);
				$arrAuxiliar["marca"] = utf8_decode($arrCol->marca);
				$arrAuxiliar["anio"] = $arrCol->anio;
				$arrAuxiliar["placas"] = $arrCol->placas;
				
				//Obtenemos la diferencia entre el año actual y el año en que se registro el vehículo
				$diferencia = (int)$anio - (int)$arrCol->anio;
				//Bloque de código para verificar si el vehículo será acredor a una liberación de pago
				if($diferencia > 1){ //Vehículos que deberán pasar por la verificación
					
					$estadoID = $arrCol->estado_id;
					//Código para obtener el último dígito de una placa vehicular
					$digito = $this->ultimo_digito($arrCol->placas);
					//Seleccionar los datos de los vehículos activos
 					$otdMesesAplican = $this->vigencias->meses_aplican($estadoID, $digito);

 					if($otdMesesAplican){
 						foreach ($otdMesesAplican as $arrMes)
						{
							$m = $this->ARR_MESES_NUMEROS_DESCRIPCIONES[$arrMes->mes];
							$arrVerificacionesVehicularesObligatorias[$index][$m] = 1;
						}
 					}		
				}
				else{ 
					//Vehiculos exentos		
					//Asignar datos al array
			        array_push($arrVehiculosExentos, $arrAuxiliar); 
				}
				//Aumentamos el indice de modificación de manera manual
				$index++;
			}
			
			//Cargamos las verificaciones efectuadas en el año actual
			$index = 0;
			foreach ($otdVehiculos as $arrCol) {
				//Obtenemos la diferencia entre el año actual y el año en que se registro el vehículo
				$diferencia = (int)$anio - (int)$arrCol->anio;
				//Vehículos que deberán pasar por la verificación
				if($diferencia > 1){ 
					//Seleccionar las verificaciones para los vehiculos
 					$otdVerificacionesVehiculos = $this->vigencias->verificaciones_vehiculo($arrCol->vehiculo_id, (int)$anio);
 					if($otdVerificacionesVehiculos){
 						foreach ($otdVerificacionesVehiculos as $arrVer)
						{
							$arrVerificacionesVehicularesEfectuadas[$index][$m] = 1;
						}
 					}	
				}
				$index++;
			}

			//Generamos la comparación de las verificaciones con base al mes actual de corte
			$index = 0;
			$mes_corte = (int)$mes;
			//$mes_corte = 11;
			foreach ($otdVehiculos as $arrCol) {

				//Definir valores del array de información (para cada vehículo)
				$arrAuxiliar["codigo"] = $arrCol->codigo;
				$arrAuxiliar["modelo"] = utf8_decode($arrCol->modelo);
				$arrAuxiliar["marca"] = utf8_decode($arrCol->marca);
				$arrAuxiliar["anio"] = $arrCol->anio;
				$arrAuxiliar["placas"] = $arrCol->placas;
				
				//Obtenemos la diferencia entre el año actual y el año en que se registro el vehículo
				$diferencia = (int)$anio - (int)$arrCol->anio;
				//Vehículos que deberán pasar por la verificación
				if($diferencia > 1){ 
					
					$semestre1 = 0; //1:VERIFICADO, 2:VENCIDO, 3:POR VENCER
					$semestre2 = 0; //1:VERIFICADO, 2:VENCIDO, 3:POR VENCER
					$sem1 = 0;
					$sem2 = 0;	
					
					//Si la el mes de corte es menor ó igual que el mes de una verificación obligatoria (MARCAR PENDIENTE)
					//Si el mes de corte es mayor que una verificación obligatoria que no ha sido efectuada (MARCAR VENCIDA)
					//Verificaciones obligatorias
					//Recorrer la información del semestre 1
					for($j=1; $j<=6; $j++){
						if($arrVerificacionesVehicularesObligatorias[$index][$j] == 1){ $sem1 = $j; }
					}
					//Recorrer la información del semestre 2
					for($j=7; $j<=12; $j++){
						if($arrVerificacionesVehicularesObligatorias[$index][$j] == 1){ $sem2 = $j; }
					}

					//Comparativa de verificación obligatoria vs verificación efectuada
					//-------------------------------------------------------SEMESTRE 1
					if($mes_corte <= $sem1){
						$semestre1 = 3;
						for($j=$mes_corte; $j>=1; $j--){
							if($arrVerificacionesVehicularesEfectuadas[$index][$j] == 1){
								$semestre1 = 1;
								$sem1 = $j;
							}
						}
					}
					else{
						$semestre1 = 2;
						for($j=$mes_corte; $j>=1; $j--){
							if($arrVerificacionesVehicularesEfectuadas[$index][$j] == 1){
								$semestre1 = 1;
								$sem1 = $j;
							}
						}
					}
					//-------------------------------------------------------------------
					if($semestre1 = 2){

						$arrAuxiliar["semestre"] = 'SEMESTRE 1';
						$arrAuxiliar["mes"] = $this->ARR_MESES_DESCRIPCIONES[$sem1];
						//Vehiculos vencidos		
						//Asignar datos al array
			        	array_push($arrVehiculosVerificarVencidos, $arrAuxiliar);
					}
					else if($semestre1 = 3){

						$arrAuxiliar["semestre"] = 'SEMESTRE 1';
						$arrAuxiliar["mes"] = $this->ARR_MESES_DESCRIPCIONES[$sem1];
						//Vehiculos vencidos		
						//Asignar datos al array
			        	array_push($arrVehiculosVerificarVencer, $arrAuxiliar);
					}
					//----------------------------------------------------------SEMESTRE 2
					if($mes_corte <= $sem2){
						$semestre2 = 3;
						for($j=$mes_corte; $j>=7; $j--){
							if($arrVerificacionesVehicularesEfectuadas[$index][$j] == 1){
								$semestre2 = 1;
								$sem2 = $j;
							}
						}
					}
					else{
						$semestre2 = 2;
						for($j=$mes_corte; $j>=7; $j--){
							if($arrVerificacionesVehicularesEfectuadas[$index][$j] == 1){
								$semestre2 = 1;
								$sem2 = $j;
							}
						}
					}
					
					//-------------------------------------------------------------------
					if($semestre2 == 2){

						$arrAuxiliar["semestre"] = 'SEMESTRE 2';
						$arrAuxiliar["mes"] = $this->ARR_MESES_DESCRIPCIONES[$sem2];
						//Vehiculos vencidos		
						//Asignar datos al array
			        	array_push($arrVehiculosVerificarVencidos, $arrAuxiliar);
					}
					else if($semestre2 == 3){

						$arrAuxiliar["semestre"] = 'SEMESTRE 2';
						$arrAuxiliar["mes"] = $this->ARR_MESES_DESCRIPCIONES[$sem2];
						//Vehiculos vencidos		
						//Asignar datos al array
			        	array_push($arrVehiculosVerificarVencer, $arrAuxiliar);
					}
				}

				$index++;

			}
			
		}
	
		//Asigna el tipo y tamaño de letra
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		$pdf->SetTextColor(0); //establece el color de texto negro
		$pdf->Cell(190, 5, utf8_decode('VEHÍCULOS EXENTOS'), 0, 1, 'L', 0);

		//Recorremos el arreglo 
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAchuraVehiculos);
        if($arrVehiculosExentos){
        	foreach ($arrVehiculosExentos as $arrReg) 
	        {
			    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
			    $pdf->Row(array($arrReg["codigo"], 
				    			$arrReg['modelo'], 
				    			$arrReg['marca'], 
				    			$arrReg['anio'], 
				    			$arrReg['placas']), 
						  $arrAlineacionVehiculos); 
			}
        }
		//Espacios de salto de línea
        $pdf->Ln(5);

        //Asigna el tipo y tamaño de letra
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		$pdf->SetTextColor(0); //establece el color de texto negro
		$pdf->Cell(190, 5, utf8_decode('VEHÍCULOS A VERIFICACIÓN'), 0, 1, 'L', 0);

		//Vehículos que tienen una verificación vencida para el año actual
		$pdf->Cell(190, 5, utf8_decode('VENCIDOS'), 0, 1, 'L', 0);
		//Recorremos el arreglo 
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAchuraVehiculosVerificables);
        if($arrVehiculosVerificarVencidos){
        	foreach ($arrVehiculosVerificarVencidos as $arrReg) 
	        {
			    $pdf->Row(array($arrReg["codigo"], 
				    			$arrReg['modelo'], 
				    			$arrReg['marca'], 
				    			$arrReg['anio'], 
				    			$arrReg['placas'],
				    			$arrReg['semestre'],
				    			$arrReg['mes']), 
						   $arrAlineacionVehiculosVerificables); 
			}
        }
        
		//Vehículos con verificaciones pendientes por vences
		//Asigna el tipo y tamaño de letra
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		$pdf->SetTextColor(0); //establece el color de texto negro
		$pdf->Cell(190, 5, utf8_decode('POR VENCER'), 0, 1, 'L', 0);
		//Recorremos el arreglo 
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAchuraVehiculosVerificables);
        if($arrVehiculosVerificarVencer){
        	foreach ($arrVehiculosVerificarVencer as $arrReg) 
	        {
			    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
			    $pdf->Row(array($arrReg["codigo"], 
				    			$arrReg['modelo'], 
				    			$arrReg['marca'], 
				    			$arrReg['anio'], 
				    			$arrReg['placas'],
				    			$arrReg['semestre'],
				    			$arrReg['mes']), 
						  $arrAlineacionVehiculosVerificables); 
			}
        }
		//Espacios de salto de línea
        $pdf->Ln(10);


        /*
		******************************************************************************************************
		******************************************************************************************************
		BLOQUE DE CÓDIGO CORRESPONDIENTE A LAS VERFICACIONES FEDERALES DE EMISIONES CONTAMINANTES
		******************************************************************************************************
		******************************************************************************************************
		*/
		//Seleccionar los datos de los vehículos activos que son acreedores a una verificación federal
 		$otdVehiculosFederal = $this->vigencias->vehiculos_activos('SI');

 		if($otdVehiculosFederal){

 			//Obtenemos el mes y año actual para realizar las comparaciones correspondientes
        	$mes = date('m');
        	$anio = date('Y');
 			
 			//Array que se utiliza para agregar los datos de los vehiculos con verificación vencida o pendientes de verificar
		    $arrVehiculosVerificarContaminantes = array();
		   	$arrAuxiliar = array();

		   	foreach ($otdVehiculosFederal as $arrReg) 
	        {

	        	//Definir valores del array de información (para cada vehículo)
				$arrAuxiliar["codigo"] = $arrCol->codigo;
				$arrAuxiliar["modelo"] = utf8_decode($arrCol->modelo);
				$arrAuxiliar["marca"] = utf8_decode($arrCol->marca);
				$arrAuxiliar["anio"] = $arrCol->anio;
				$arrAuxiliar["placas"] = $arrCol->placas;

	        	//Seleccionar las verificaciones de emisiones contaminantes para los vehiculos que apliquen
			   	//SEMESTRE 1
			   	$otdVerificacionSemestre1 = $this->vigencias->verificacion_emisiones_contaminantes($arrReg->vehiculo_id, (int)$anio, 'PRIMERO');
			   	//SEMESTRE 2
			   	$otdVerificacionSemestre2 = $this->vigencias->verificacion_emisiones_contaminantes($arrReg->vehiculo_id, (int)$anio, 'SEGUNDO');
			   	
			   	//Condicional para comprobar las verificaciones con base al mes de corte
	 			if( (int)$mes <= 6 ){ 
	 				
	 				if( sizeof($otdVerificacionSemestre1) <= 0){ 
	 					$arrAuxiliar["semestre1"] = 'VENCIDO'; 
	 				}
	 				else{ 
	 					$arrAuxiliar["semestre1"] = 'VERIFICADO'; 
	 				}
	 				$arrAuxiliar["semestre2"] = 'PENDIENTE';

	 			} 
	 			else{ 

	 				if( sizeof($otdVerificacionSemestre1) <= 0){ 
	 					$arrAuxiliar["semestre1"] = 'VENCIDO'; 
	 				}
	 				else{ 
	 					$arrAuxiliar["semestre1"] = 'VERIFICADO'; 
	 				}

	 				if( sizeof($otdVerificacionSemestre2) <= 0){ 
	 					$arrAuxiliar["semestre2"] = 'VENCIDO'; 
	 				}
	 				else{ 
	 					$arrAuxiliar["semestre2"] = 'VERIFICADO'; 
	 				}

	 			}

				//Asignar datos al array
	        	array_push($arrVehiculosVerificarContaminantes, $arrAuxiliar);
	        }   	

 		}

		//Recorre el array de titulos de encabezado para crearlos
		for ($intCont = 0; $intCont < count($arrCabecera2); $intCont++)
		{
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//inserta los titulos de la cabecera
			$pdf->Cell($arrAnchura1[$intCont], 7, $arrCabecera2[$intCont], 1, 0, 'C', TRUE);
		}
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAnchura1);
		//Espacios de salto de línea
        $pdf->Ln(8);
        //Asigna el tipo y tamaño de letra
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		$pdf->SetTextColor(0); //establece el color de texto negro
		$pdf->Cell(190, 5, utf8_decode('VEHÍCULOS A VERIFICACIÓN'), 0, 1, 'L', 0);

		//Recorremos el arreglo 
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAchuraVehiculosVerificables);
        if($arrVehiculosVerificarContaminantes){
        	foreach ($arrVehiculosVerificarContaminantes as $arrReg) 
	        {
			    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
			    $pdf->Row(array($arrReg["codigo"], 
				    			$arrReg['modelo'], 
				    			$arrReg['marca'], 
				    			$arrReg['anio'], 
				    			$arrReg['placas'],
				    			'SEM. 1: '.$arrReg['semestre1'],
				    			'SEM. 2: '.$arrReg['semestre2']), 
						   $arrAlineacionVehiculosVerificables); 
			}
        }
        //Espacios de salto de línea
        $pdf->Ln(10);

		 /*
		******************************************************************************************************
		******************************************************************************************************
		BLOQUE DE CÓDIGO CORRESPONDIENTE A LAS VERFICACIONES FEDERALES DE CONDICIONES FÍSICO MECÁNICAS
		******************************************************************************************************
		******************************************************************************************************
		*/
		//Seleccionar los datos de los vehículos activos que son acreedores a una verificación federal
 		$otdVehiculosFederal = $this->vigencias->vehiculos_activos('SI');

 		if($otdVehiculosFederal){
 			
 			//Obtenemos el mes y año actual para realizar las comparaciones correspondientes
        	$mes = date('m');
        	$anio = date('Y');

        	//Variables de tipo ARRAY para almacenar un vehículo según sea su estatus
		    $arrVehiculosVerificarVencidos = array();
		    $arrVehiculosVerificarVencer = array();
		   	$arrAuxiliar = array();
		   	$estatus = 0;

			//Cargamos los meses para los cuales un vehículo debe llevar a cabo su verificación vehicular obligatoria
			$index = 0;
        	foreach ($otdVehiculosFederal as $arrCol)
			{ 
				//Definir valores del array de información (para cada vehículo)
				$arrAuxiliar["codigo"] = $arrCol->codigo;
				$arrAuxiliar["modelo"] = utf8_decode($arrCol->modelo);
				$arrAuxiliar["marca"] = utf8_decode($arrCol->marca);
				$arrAuxiliar["anio"] = $arrCol->anio;
				$arrAuxiliar["placas"] = $arrCol->placas;
				
				//Obtenemos la diferencia entre el año actual y el año en que se registro el vehículo
				$diferencia = (int)$anio - (int)$arrCol->anio;
				//Bloque de código para verificar si el vehículo será acredor a una liberación de pago
				if($diferencia > 1){ //Vehículos que deberán pasar por la verificación
			
					//Código para obtener el último dígito de una placa vehicular
					$digito = $this->ultimo_digito($arrCol->placas);
					
					//OBTENER INFORMACIÓN RESPECTO A VERIFICACIONES OBLIGATORIAS
					//Seleccionar los meses para los que aplicará
 					$otdMesesAplican = $this->vigencias->meses_aplican_verificacion_mecanica($digito);
 					$otdMesVerificado = $this->vigencias->mes_verificado_verificacion_mecanica($arrCol->vehiculo_id, (int)$anio);

 					//var_dump((int)$otdMesVerificado[0]->mes);
 					$mes_verifico = $otdMesVerificado[0]->mes;

 					if($otdMesesAplican){

 						$meses = explode("|", $otdMesesAplican->meses);
 						//Mes inferior - Mes superior
 						$min = (int)min($meses);
 						$max = (int)max($meses);

 						//Condicional para comprobar las verificaciones con base al mes de corte
 						//----------ESTADOS 
 						//1:VIGENTE 2:POR VENCER 3:EXTEMPORANEO 4:VENCIDO

			 			if( (int)$mes <= $max ){ 

			 				$estatus = 2;

			 				if($mes_verifico){
			 					if(in_array($mes_verifico, $meses) ){
						    		$estatus = 1;
								}
			 				}

			 			} 
			 			else{

			 				$estatus = 4;
			 				if($mes_verifico){
			 					if(in_array($mes_verifico, $meses) ){
						    		$estatus = 1;
								}
								else{
									$estatus = 3;
								}
			 				}

			 			}

			 			//Añadimos información adicional para los vehículos que serán agregados al reporte
			 			switch ($estatus) {
			 				case 2:
			 					$arrAuxiliar["estatus"] = 'POR VENCER';
			 					$arrAuxiliar["mes"] = $this->ARR_MESES_DESCRIPCIONES[$max]; 
			 					//Asignar datos al array
	        					array_push($arrVehiculosVerificarVencer, $arrAuxiliar);

			 					break;
			 				
			 				case 4:
			 					$arrAuxiliar["estatus"] = 'VENCIDO';
			 					$arrAuxiliar["mes"] = $this->ARR_MESES_DESCRIPCIONES[$max];
			 					//Asignar datos al array
	        					array_push($arrVehiculosVerificarVencidos, $arrAuxiliar);

			 					break;
			 			}

 					}
 							
				}

				$index++;
			}	

			

 		}	

		//Asigna el tipo y tamaño de letra para la cabecera de la tabla
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
        //Recorre el array de titulos de encabezado para crearlos
		for ($intCont = 0; $intCont < count($arrCabecera3); $intCont++)
		{
			//Establecer el color de fondo para la cabecera
			$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			$pdf->SetDrawColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
			//inserta los titulos de la cabecera
			$pdf->Cell($arrAnchura1[$intCont], 7, $arrCabecera3[$intCont], 1, 0, 'C', TRUE);
		}
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAnchura1);
		//Espacios de salto de línea
        $pdf->Ln(8);
        //Asigna el tipo y tamaño de letra
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		$pdf->SetTextColor(0); //establece el color de texto negro
		$pdf->Cell(190, 5, utf8_decode('VEHÍCULOS A VERIFICACIÓN'), 0, 1, 'L', 0);

		//Vehículos que tienen una verificación vencida para el año actual
		$pdf->Cell(190, 5, utf8_decode('VENCIDOS'), 0, 1, 'L', 0);
		//Recorremos el arreglo 
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAchuraVehiculosVerificables);
        if($arrVehiculosVerificarVencidos){
        	foreach ($arrVehiculosVerificarVencidos as $arrReg) 
	        {
			    $pdf->Row(array($arrReg["codigo"], 
				    			$arrReg['modelo'], 
				    			$arrReg['marca'], 
				    			$arrReg['anio'], 
				    			$arrReg['placas'],
				    			$arrReg['estatus'],
				    			$arrReg['mes']), 
						  $arrAlineacionVehiculosVerificables); 
			}
        }
        
		//Vehículos con verificaciones pendientes por vences
		//Asigna el tipo y tamaño de letra
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		$pdf->SetTextColor(0); //establece el color de texto negro
		$pdf->Cell(190, 5, utf8_decode('POR VENCER'), 0, 1, 'L', 0);
		//Recorremos el arreglo 
		//Establece el ancho de las columnas
		$pdf->SetWidths($arrAchuraVehiculosVerificables);
        if($arrVehiculosVerificarVencer){
        	foreach ($arrVehiculosVerificarVencer as $arrReg) 
	        {
			    //Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
			    $pdf->Row(array($arrReg["codigo"], 
				    			$arrReg['modelo'], 
				    			$arrReg['marca'], 
				    			$arrReg['anio'], 
				    			$arrReg['placas'],
				    			$arrReg['estatus'],
				    			$arrReg['mes']), 
						  $arrAlineacionVehiculosVerificables); 
			}
        }
		//Espacios de salto de línea
        $pdf->Ln(10);
		
		
		//Espacios de salto de línea
        $pdf->Ln();
        //Ejecutar la salida del reporte
        $pdf->Output('polizas_verificaciones'.'pdf','I'); 
	}

	/*Método para generar un archivo XLS con el listado de las licencias o pólizas 
	 *dependiendo de los criterios de búsqueda proporcionados*/
	public function get_xls($strTipo) 
	{
		switch ($strTipo) {
		    case 'LICENCIAS':
		        //Hacer un llamado a la función para generar un reporte XLS con el listado de licencias
				$this->get_xls_licencias();
		        break;
		    case 'POLIZAS':
		        //Hacer un llamado a la función para generar un reporte XLS con el listado de pólizas
				$this->get_xls_polizas();
		        break;
		    case 'VERIFICACIONES':
		        //Hacer un llamado a la función para generar un reporte XLS con el listado de verificaciones
				$this->get_xls_verificaciones();
		        break;
		}
	}

    /*Método para generar un archivo XLS con el listado de las licencias*/
	public function get_xls_licencias() 
	{	

		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
       
		//Seleccionar los datos de las licencias vencidas y vigentes
		$otdLicenciasVencidas = $this->vigencias->licencias_vencidas(); 
		$otdLicenciasVigentes = $this->vigencias->licencias_vigentes();

     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE VIGENCIA DE LICENCIAS');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'ESTATUS')
        		 ->setCellValue('B'.$intPosEncabezados, 'EMPLEADO')
        		 ->setCellValue('C'.$intPosEncabezados, 'LICENCIA')
                 ->setCellValue('D'.$intPosEncabezados, 'TIPO')
                 ->setCellValue('E'.$intPosEncabezados, 'VIGENCIA')
                 ->setCellValue('F'.$intPosEncabezados, 'EXPEDICIÓN')
                 ->setCellValue('G'.$intPosEncabezados, 'SUCURSAL')
                 ->setCellValue('H'.$intPosEncabezados, 'DEPARTAMENTO')
                 ->setCellValue('I'.$intPosEncabezados, 'PUESTO');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:I9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdLicenciasVencidas)
		{	
			//Recorremos el arreglo 
			foreach ($otdLicenciasVencidas as $arrCol)
			{   
				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
					     ->setCellValue('A'.$intFila, 'VENCIDA')
						 ->setCellValue('B'.$intFila, $arrCol->empleado)
					     ->setCellValue('C'.$intFila, $arrCol->licencia_manejo)
					     ->setCellValue('D'.$intFila, $arrCol->licencia_tipo)
					     ->setCellValue('E'.$intFila, $arrCol->licencia_vigencia)
						 ->setCellValue('F'.$intFila, $arrCol->licencia_expedicion)
						 ->setCellValue('G'.$intFila, $arrCol->sucursal)
						 ->setCellValue('H'.$intFila, $arrCol->departamento)
						 ->setCellValue('I'.$intFila, $arrCol->puesto);

                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}
		}

		if ($otdLicenciasVigentes)
		{	
			//Recorremos el arreglo 
			foreach ($otdLicenciasVigentes as $arrCol)
			{   
				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
					     ->setCellValue('A'.$intFila, 'VIGENTE')
						 ->setCellValue('B'.$intFila, $arrCol->empleado)
					     ->setCellValue('C'.$intFila, $arrCol->licencia_manejo)
					     ->setCellValue('D'.$intFila, $arrCol->licencia_tipo)
					     ->setCellValue('E'.$intFila, $arrCol->licencia_vigencia)
						 ->setCellValue('F'.$intFila, $arrCol->licencia_expedicion)
						 ->setCellValue('G'.$intFila, $arrCol->sucursal)
						 ->setCellValue('H'.$intFila, $arrCol->departamento)
						 ->setCellValue('I'.$intFila, $arrCol->puesto);

                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Incrementar el indice para escribir el total
            $intFila++;
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()->getStyle('I'.$intFila)->applyFromArray($arrStyleBold);
		}

		//Agregar información del total
        $objExcel->setActiveSheetIndex(0)->setCellValue('I'.$intFila,  'TOTAL: '.$intContador);
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'licencias_vigentes.xls', 'licencias', $intFila);

	}

	/*Método para generar un archivo XLS con el listado de las pólizas*/
	public function get_xls_polizas() 
	{	

		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
       
		//Seleccionar los datos de las licencias vencidas y vigentes
		$otdPolizasVencidas = $this->vigencias->polizas_vencidas(); 
		$otdPolizasVigentes = $this->vigencias->polizas_vigentes();

     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
        //Se agrega el título del archivo
		$objExcel->setActiveSheetIndex(0)
			     ->setCellValue('A7', 'LISTADO DE VIGENCIA DE PÓLIZAS');
		//Se agregan las columnas de cabecera
        $objExcel->setActiveSheetIndex(0)
        		 ->setCellValue('A'.$intPosEncabezados, 'ESTATUS')
        		 ->setCellValue('B'.$intPosEncabezados, 'CÓDIGO')
        		 ->setCellValue('C'.$intPosEncabezados, 'MODELO')
                 ->setCellValue('D'.$intPosEncabezados, 'MARCA')
                 ->setCellValue('E'.$intPosEncabezados, 'ASEGURADORA')
                 ->setCellValue('F'.$intPosEncabezados, 'PÓLIZA')
                 ->setCellValue('G'.$intPosEncabezados, 'COSTO')
                 ->setCellValue('H'.$intPosEncabezados, 'RENOVACIÓN');
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID,
                                  'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));

        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));

        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet()
    			 ->getStyle('A9:H9')
    			 ->getFill()
    			 ->applyFromArray($arrStyleColumnas);

		//Si hay información
		if ($otdPolizasVencidas)
		{	
			//Recorremos el arreglo 
			foreach ($otdPolizasVencidas as $arrCol)
			{   
				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
					     ->setCellValue('A'.$intFila, 'VENCIDA')
						 ->setCellValue('B'.$intFila, $arrCol->codigo)
					     ->setCellValue('C'.$intFila, $arrCol->modelo)
					     ->setCellValue('D'.$intFila, $arrCol->marca)
					     ->setCellValue('E'.$intFila, $arrCol->aseguradora)
						 ->setCellValue('F'.$intFila, $arrCol->poliza)
						 ->setCellValue('G'.$intFila, $arrCol->costo_poliza)
						 ->setCellValue('H'.$intFila, $arrCol->fecha_renovacion);

                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}
		}

		if ($otdPolizasVigentes)
		{	
			//Recorremos el arreglo 
			foreach ($otdPolizasVigentes as $arrCol)
			{   
				//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
					     ->setCellValue('A'.$intFila, 'VENCIDA')
						 ->setCellValue('B'.$intFila, $arrCol->codigo)
					     ->setCellValue('C'.$intFila, $arrCol->modelo)
					     ->setCellValue('D'.$intFila, $arrCol->marca)
					     ->setCellValue('E'.$intFila, $arrCol->aseguradora)
						 ->setCellValue('F'.$intFila, $arrCol->poliza)
						 ->setCellValue('G'.$intFila, $arrCol->costo_poliza)
						 ->setCellValue('H'.$intFila, $arrCol->fecha_renovacion);

                //Incrementar el contador por cada registro
				$intContador++;
                //Incrementar el indice para escribir los datos del siguiente registro
                $intFila++; 
			}

			//Incrementar el indice para escribir el total
            $intFila++;
            //Cambiar estilo de la celda
            $objExcel->getActiveSheet()->getStyle('H'.$intFila)->applyFromArray($arrStyleBold);
		}

		//Agregar información del total
        $objExcel->setActiveSheetIndex(0)->setCellValue('H'.$intFila,  'TOTAL: '.$intContador);
		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'polizas_vigentes.xls', 'polizas', $intFila);

	}

	/*Método para generar un archivo XLS con el listado de las vigencias correspondientes a verificaciones vehiculares*/
	public function get_xls_verificaciones() 
	{
		
		//Variable para modificiar el titulo del reporte
		$strTituloReporte = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
        //Posición para escribir las descripciones de las columnas 
        $intPosEncabezados = 9;
        //Número de fila donde se va a comenzar a rellenar
        $intFila = 10;
        $intFilaInicial = 10;
     	
     	
     	//Se crea una instancia de la clase phpExcel
        $objExcel = new PHPExcel();
        //Cargar archivo base 
        $objExcel = PHPExcel_IOFactory::load(APPPATH .'controllers/administracion/archivos_excel/general.xls');
        
        /*******************************************************************************************************************************
        ********************************************************************************************************************************
		* HOJA CORRESPONDIENTE A LA INFORMACIÓN DE VERIFICACIONES VEHICULARES ESTATALES
		********************************************************************************************************************************
		*******************************************************************************************************************************/
        //Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objExcel);
		//Se agrega el título del archivo
		$strTituloReporte = 'LISTADO DE VIGENCIA DE VERIFICACIONES VEHÍCULARES';
		$objExcel->setActiveSheetIndex(0)->setCellValue('A7', $strTituloReporte);

     	//Se agregan las columnas de cabecera
		$objExcel->setActiveSheetIndex(0)
		     ->setCellValue('A'.$intPosEncabezados, 'CÓDIGO')
             ->setCellValue('B'.$intPosEncabezados, 'MODELO')
             ->setCellValue('C'.$intPosEncabezados, 'MARCA')
             ->setCellValue('D'.$intPosEncabezados, 'AÑO')
             ->setCellValue('E'.$intPosEncabezados, 'PLACAS')
             ->setCellValue('F'.$intPosEncabezados, 'ESTATUS')
             ->setCellValue('G'.$intPosEncabezados, 'SEMESTRE')
             ->setCellValue('H'.$intPosEncabezados, 'MES');      

        //Definir estilos de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));
        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE, 'color' => array('rgb' => 'ffffff')));
        //Definir estilo para centrar el contenido de la celda
        $arrStyleAlignmentCenter = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //Definir estilo para alinear a la derecha el contenido de la celda
        $arrStyleAlignmentRight = array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        //Definir estilo de las celdas que apareceran en negrita
        $arrStyleBold = array('font'=> array('bold'=> TRUE));
       	//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet(0)->getStyle('A9:D9')->applyFromArray($arrStyleBold);
        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet(0)->getStyle('A9:H9')->getFill()->applyFromArray($arrStyleColumnas);
        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet(0)->getStyle('A9:H9')->applyFromArray($arrStyleFuenteColumnas);	 
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet(0)->getStyle('A9:H9')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);

		
 		//----------------------------------------------------------------------------------Consultamos la información para el reporte
		//Seleccionar los datos de los vehículos activos
 		$otdVehiculos = $this->vigencias->vehiculos_activos();
 		if($otdVehiculos){

        	//Obtenemos el mes y año actual para realizar las comparaciones correspondientes
        	$mes = date('m');
        	$anio = date('Y');
        	//Array que se utiliza para agregar los datos de los vehiculos exentos
		    $arrVehiculosExentos = array();
		    $arrVehiculosVerificarVencidos = array();
		    $arrVehiculosVerificarVencer = array();
		   	$arrAuxiliar = array();

		   	//Creamos la inicialización de la matrices de comparación
		   	$arrVerificacionesVehicularesObligatorias = array();
		   	$arrVerificacionesVehicularesEfectuadas = array();
		   	foreach ($otdVehiculos as $arrCol)
			{ 
				array_push($arrVerificacionesVehicularesObligatorias, array($arrCol->vehiculo_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0) );
				array_push($arrVerificacionesVehicularesEfectuadas, array($arrCol->vehiculo_id, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0) );  
			}

			//Cargamos los meses para los cuales un vehículo debe llevar a cabo su verificación vehicular obligatoria
			$index = 0;
        	foreach ($otdVehiculos as $arrCol)
			{ 
				//Definir valores del array de información (para cada vehículo)
				$arrAuxiliar["codigo"] = $arrCol->codigo;
				$arrAuxiliar["modelo"] = utf8_decode($arrCol->modelo);
				$arrAuxiliar["marca"] = utf8_decode($arrCol->marca);
				$arrAuxiliar["anio"] = $arrCol->anio;
				$arrAuxiliar["placas"] = $arrCol->placas;
				
				//Obtenemos la diferencia entre el año actual y el año en que se registro el vehículo
				$diferencia = (int)$anio - (int)$arrCol->anio;
				//Bloque de código para verificar si el vehículo será acredor a una liberación de pago
				if($diferencia > 1){ //Vehículos que deberán pasar por la verificación
					
					$estadoID = $arrCol->estado_id;
					//Código para obtener el último dígito de una placa vehicular
					$digito = $this->ultimo_digito($arrCol->placas);
					//Seleccionar los datos de los vehículos activos
 					$otdMesesAplican = $this->vigencias->meses_aplican($estadoID, $digito);

 					if($otdMesesAplican){
 						foreach ($otdMesesAplican as $arrMes)
						{
							$m = $this->ARR_MESES_NUMEROS_DESCRIPCIONES[$arrMes->mes];
							$arrVerificacionesVehicularesObligatorias[$index][$m] = 1;
						}
 					}		
				}
				else{ 
					//Vehiculos exentos		
					//Asignar datos al array
			        array_push($arrVehiculosExentos, $arrAuxiliar); 
				}
				//Aumentamos el indice de modificación de manera manual
				$index++;
			}
			
			//Cargamos las verificaciones efectuadas en el año actual
			$index = 0;
			foreach ($otdVehiculos as $arrCol) {
				//Obtenemos la diferencia entre el año actual y el año en que se registro el vehículo
				$diferencia = (int)$anio - (int)$arrCol->anio;
				//Vehículos que deberán pasar por la verificación
				if($diferencia > 1){ 
					//Seleccionar las verificaciones para los vehiculos
 					$otdVerificacionesVehiculos = $this->vigencias->verificaciones_vehiculo($arrCol->vehiculo_id, (int)$anio);
 					if($otdVerificacionesVehiculos){
 						foreach ($otdVerificacionesVehiculos as $arrVer)
						{
							$arrVerificacionesVehicularesEfectuadas[$index][$m] = 1;
						}
 					}	
				}
				$index++;
			}

			//Generamos la comparación de las verificaciones con base al mes actual de corte
			$index = 0;
			$mes_corte = (int)$mes;
			//$mes_corte = 11;
			foreach ($otdVehiculos as $arrCol) {

				//Definir valores del array de información (para cada vehículo)
				$arrAuxiliar["codigo"] = $arrCol->codigo;
				$arrAuxiliar["modelo"] = utf8_decode($arrCol->modelo);
				$arrAuxiliar["marca"] = utf8_decode($arrCol->marca);
				$arrAuxiliar["anio"] = $arrCol->anio;
				$arrAuxiliar["placas"] = $arrCol->placas;
				
				//Obtenemos la diferencia entre el año actual y el año en que se registro el vehículo
				$diferencia = (int)$anio - (int)$arrCol->anio;
				//Vehículos que deberán pasar por la verificación
				if($diferencia > 1){ 
					
					$semestre1 = 0; //1:VERIFICADO, 2:VENCIDO, 3:POR VENCER
					$semestre2 = 0; //1:VERIFICADO, 2:VENCIDO, 3:POR VENCER
					$sem1 = 0;
					$sem2 = 0;	
					
					//Si la el mes de corte es menor ó igual que el mes de una verificación obligatoria (MARCAR PENDIENTE)
					//Si el mes de corte es mayor que una verificación obligatoria que no ha sido efectuada (MARCAR VENCIDA)
					//Verificaciones obligatorias
					//Recorrer la información del semestre 1
					for($j=1; $j<=6; $j++){
						if($arrVerificacionesVehicularesObligatorias[$index][$j] == 1){ $sem1 = $j; }
					}
					//Recorrer la información del semestre 2
					for($j=7; $j<=12; $j++){
						if($arrVerificacionesVehicularesObligatorias[$index][$j] == 1){ $sem2 = $j; }
					}

					//Comparativa de verificación obligatoria vs verificación efectuada
					//-------------------------------------------------------SEMESTRE 1
					if($mes_corte <= $sem1){
						$semestre1 = 3;
						for($j=$mes_corte; $j>=1; $j--){
							if($arrVerificacionesVehicularesEfectuadas[$index][$j] == 1){
								$semestre1 = 1;
								$sem1 = $j;
							}
						}
					}
					else{
						$semestre1 = 2;
						for($j=$mes_corte; $j>=1; $j--){
							if($arrVerificacionesVehicularesEfectuadas[$index][$j] == 1){
								$semestre1 = 1;
								$sem1 = $j;
							}
						}
					}
					//-------------------------------------------------------------------
					if($semestre1 = 2){

						$arrAuxiliar["semestre"] = 'SEMESTRE 1';
						$arrAuxiliar["mes"] = $this->ARR_MESES_DESCRIPCIONES[$sem1];
						//Vehiculos vencidos		
						//Asignar datos al array
			        	array_push($arrVehiculosVerificarVencidos, $arrAuxiliar);
					}
					else if($semestre1 = 3){

						$arrAuxiliar["semestre"] = 'SEMESTRE 1';
						$arrAuxiliar["mes"] = $this->ARR_MESES_DESCRIPCIONES[$sem1];
						//Vehiculos vencidos		
						//Asignar datos al array
			        	array_push($arrVehiculosVerificarVencer, $arrAuxiliar);
					}
					//----------------------------------------------------------SEMESTRE 2
					if($mes_corte <= $sem2){
						$semestre2 = 3;
						for($j=$mes_corte; $j>=7; $j--){
							if($arrVerificacionesVehicularesEfectuadas[$index][$j] == 1){
								$semestre2 = 1;
								$sem2 = $j;
							}
						}
					}
					else{
						$semestre2 = 2;
						for($j=$mes_corte; $j>=7; $j--){
							if($arrVerificacionesVehicularesEfectuadas[$index][$j] == 1){
								$semestre2 = 1;
								$sem2 = $j;
							}
						}
					}
					
					//-------------------------------------------------------------------
					if($semestre2 == 2){

						$arrAuxiliar["semestre"] = 'SEMESTRE 2';
						$arrAuxiliar["mes"] = $this->ARR_MESES_DESCRIPCIONES[$sem2];
						//Vehiculos vencidos		
						//Asignar datos al array
			        	array_push($arrVehiculosVerificarVencidos, $arrAuxiliar);
					}
					else if($semestre2 == 3){

						$arrAuxiliar["semestre"] = 'SEMESTRE 2';
						$arrAuxiliar["mes"] = $this->ARR_MESES_DESCRIPCIONES[$sem2];
						//Vehiculos vencidos		
						//Asignar datos al array
			        	array_push($arrVehiculosVerificarVencer, $arrAuxiliar);
					}
				}

				$index++;

			}
			
		}

		//Recorremos el arreglo 
		if($arrVehiculosExentos){
			foreach ($arrVehiculosExentos as $arrCol)
			{   	
		    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol["codigo"], PHPExcel_Cell_DataType::TYPE_STRING)
							 ->setCellValue('B'.$intFila, $arrCol["modelo"])
						     ->setCellValue('C'.$intFila, $arrCol["marca"])
						     ->setCellValue('D'.$intFila, $arrCol["anio"])
						     ->setCellValue('E'.$intFila, $arrCol["placas"])
							 ->setCellValue('F'.$intFila, 'EXENTO')
							 ->setCellValue('G'.$intFila, 'N/A')
							 ->setCellValue('H'.$intFila, 'N/A');
	                         
	    		//Incrementar el indice para escribir los datos del siguiente registro
	        	$intFila++; 
			}
		}

		if($arrVehiculosVerificarVencer){
			foreach ($arrVehiculosVerificarVencer as $arrCol)
			{   	
		    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol["codigo"], PHPExcel_Cell_DataType::TYPE_STRING)
							 ->setCellValue('B'.$intFila, $arrCol["modelo"])
						     ->setCellValue('C'.$intFila, $arrCol["marca"])
						     ->setCellValue('D'.$intFila, $arrCol["anio"])
						     ->setCellValue('E'.$intFila, $arrCol["placas"])
							 ->setCellValue('F'.$intFila, 'POR VENCER')
							 ->setCellValue('G'.$intFila, $arrCol["semestre"])
							 ->setCellValue('H'.$intFila, $arrCol["mes"]);
	                         
	    		//Incrementar el indice para escribir los datos del siguiente registro
	        	$intFila++; 
			}
		}

		if($arrVehiculosVerificarVencidos){
			foreach ($arrVehiculosVerificarVencidos as $arrCol)
			{   	
		    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(0)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol["codigo"], PHPExcel_Cell_DataType::TYPE_STRING)
							 ->setCellValue('B'.$intFila, $arrCol["modelo"])
						     ->setCellValue('C'.$intFila, $arrCol["marca"])
						     ->setCellValue('D'.$intFila, $arrCol["anio"])
						     ->setCellValue('E'.$intFila, $arrCol["placas"])
							 ->setCellValue('F'.$intFila, 'VENCIDO')
							 ->setCellValue('G'.$intFila, $arrCol["semestre"])
							 ->setCellValue('H'.$intFila, $arrCol["mes"]);
	                         
	    		//Incrementar el indice para escribir los datos del siguiente registro
	        	$intFila++; 
			}
		}

		

		/*******************************************************************************************************************************
		********************************************************************************************************************************
		* HOJA CORRESPONDIENTE A LA INFORMACIÓN DE VERIFICACIONES DE EMISIONES CONTAMINANTES
		********************************************************************************************************************************
		*******************************************************************************************************************************/
		//Agregar nueva hoja
 		//----------------------------------------------------------------------------------Consultamos la información para el reporte
		//Seleccionar los datos de los vehículos activos que son acreedores a una verificación federal
 		$otdVehiculosFederal = $this->vigencias->vehiculos_activos('SI');

 		if($otdVehiculosFederal){

 			$intFila = 10;
 			//Obtenemos el mes y año actual para realizar las comparaciones correspondientes
        	$mes = date('m');
        	$anio = date('Y');
 			
 			//Array que se utiliza para agregar los datos de los vehiculos con verificación vencida o pendientes de verificar
		    $arrVehiculosVerificarContaminantes = array();
		   	$arrAuxiliar = array();

		   	foreach ($otdVehiculosFederal as $arrReg) 
	        {

	        	//Definir valores del array de información (para cada vehículo)
				$arrAuxiliar["codigo"] = $arrReg->codigo;
				$arrAuxiliar["modelo"] = utf8_decode($arrReg->modelo);
				$arrAuxiliar["marca"] = utf8_decode($arrReg->marca);
				$arrAuxiliar["anio"] = $arrReg->anio;
				$arrAuxiliar["placas"] = $arrReg->placas;

	        	//Seleccionar las verificaciones de emisiones contaminantes para los vehiculos que apliquen
			   	//SEMESTRE 1
			   	$otdVerificacionSemestre1 = $this->vigencias->verificacion_emisiones_contaminantes($arrReg->vehiculo_id, (int)$anio, 'PRIMERO');
			   	//SEMESTRE 2
			   	$otdVerificacionSemestre2 = $this->vigencias->verificacion_emisiones_contaminantes($arrReg->vehiculo_id, (int)$anio, 'SEGUNDO');
			   	
			   	//Condicional para comprobar las verificaciones con base al mes de corte
	 			if( (int)$mes <= 6 ){ 
	 				
	 				if( sizeof($otdVerificacionSemestre1) <= 0){ 
	 					$arrAuxiliar["semestre1"] = 'VENCIDO'; 
	 				}
	 				else{ 
	 					$arrAuxiliar["semestre1"] = 'VERIFICADO'; 
	 				}
	 				$arrAuxiliar["semestre2"] = 'PENDIENTE';

	 			} 
	 			else{ 

	 				if( sizeof($otdVerificacionSemestre1) <= 0){ 
	 					$arrAuxiliar["semestre1"] = 'VENCIDO'; 
	 				}
	 				else{ 
	 					$arrAuxiliar["semestre1"] = 'VERIFICADO'; 
	 				}

	 				if( sizeof($otdVerificacionSemestre2) <= 0){ 
	 					$arrAuxiliar["semestre2"] = 'VENCIDO'; 
	 				}
	 				else{ 
	 					$arrAuxiliar["semestre2"] = 'VERIFICADO'; 
	 				}

	 			}

				//Asignar datos al array
	        	array_push($arrVehiculosVerificarContaminantes, $arrAuxiliar);
	        }   	

 		}

		//Se agrega el título del archivo
		$strTituloReporte = 'LISTADO DE VIGENCIA DE EMISONES CONTAMINANTES';
		$strNombreHoja = 'Emisiones contaminantes';
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
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));
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
		$objExcel->setActiveSheetIndex(1)->setCellValue('A9', 'CÓDIGO');
		$objExcel->setActiveSheetIndex(1)->setCellValue('B9', 'MODELO');
		$objExcel->setActiveSheetIndex(1)->setCellValue('C9', 'MARCA');
		$objExcel->setActiveSheetIndex(1)->setCellValue('D9', 'AÑO');
		$objExcel->setActiveSheetIndex(1)->setCellValue('E9', 'PLACAS');
		$objExcel->setActiveSheetIndex(1)->setCellValue('F9', 'SEMESTRE 1');
		$objExcel->setActiveSheetIndex(1)->setCellValue('G9', 'SEMESTRE 2');
		
		//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet(1)->getStyle('A9:G9')->applyFromArray($arrStyleBold);
        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet(1)->getStyle('A9:G9')->getFill()->applyFromArray($arrStyleColumnas);
        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet(1)->getStyle('A9:G9')->applyFromArray($arrStyleFuenteColumnas);
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet(1)->getStyle('A9:G9')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);

		if($arrVehiculosVerificarContaminantes){
			foreach ($arrVehiculosVerificarContaminantes as $arrCol)
			{   	
		    	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(1)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol["codigo"], PHPExcel_Cell_DataType::TYPE_STRING)
							 ->setCellValue('B'.$intFila, $arrCol["modelo"])
						     ->setCellValue('C'.$intFila, $arrCol["marca"])
						     ->setCellValue('D'.$intFila, $arrCol["anio"])
						     ->setCellValue('E'.$intFila, $arrCol["placas"])
							 ->setCellValue('F'.$intFila, $arrCol["semestre1"])
							 ->setCellValue('G'.$intFila, $arrCol["semestre2"]);
	                         
	    		//Incrementar el indice para escribir los datos del siguiente registro
	        	$intFila++; 
			}
		}


		/*******************************************************************************************************************************
		********************************************************************************************************************************
		* HOJA CORRESPONDIENTE A LA INFORMACIÓN DE VERIFICACIONES FÍSICO MECÁNICAS
		********************************************************************************************************************************
		*******************************************************************************************************************************/
		//Agregar nueva hoja
 		//----------------------------------------------------------------------------------Consultamos la información para el reporte
 		//Seleccionar los datos de los vehículos activos que son acreedores a una verificación federal
 		$otdVehiculosFederal = $this->vigencias->vehiculos_activos('SI');

 		if($otdVehiculosFederal){
 			
 			//Obtenemos el mes y año actual para realizar las comparaciones correspondientes
        	$mes = date('m');
        	$anio = date('Y');

        	//Variables de tipo ARRAY para almacenar un vehículo según sea su estatus
		    $arrVehiculosVerificarVencidos = array();
		    $arrVehiculosVerificarVencer = array();
		   	$arrAuxiliar = array();
		   	$estatus = 0;

			//Cargamos los meses para los cuales un vehículo debe llevar a cabo su verificación vehicular obligatoria
			$index = 0;
        	foreach ($otdVehiculosFederal as $arrCol)
			{ 
				//Definir valores del array de información (para cada vehículo)
				$arrAuxiliar["codigo"] = $arrCol->codigo;
				$arrAuxiliar["modelo"] = utf8_decode($arrCol->modelo);
				$arrAuxiliar["marca"] = utf8_decode($arrCol->marca);
				$arrAuxiliar["anio"] = $arrCol->anio;
				$arrAuxiliar["placas"] = $arrCol->placas;
				
				//Obtenemos la diferencia entre el año actual y el año en que se registro el vehículo
				$diferencia = (int)$anio - (int)$arrCol->anio;
				//Bloque de código para verificar si el vehículo será acredor a una liberación de pago
				if($diferencia > 1){ //Vehículos que deberán pasar por la verificación
			
					//Código para obtener el último dígito de una placa vehicular
					$digito = $this->ultimo_digito($arrCol->placas);
					
					//OBTENER INFORMACIÓN RESPECTO A VERIFICACIONES OBLIGATORIAS
					//Seleccionar los meses para los que aplicará
 					$otdMesesAplican = $this->vigencias->meses_aplican_verificacion_mecanica($digito);
 					$otdMesVerificado = $this->vigencias->mes_verificado_verificacion_mecanica($arrCol->vehiculo_id, (int)$anio);

 					//var_dump((int)$otdMesVerificado[0]->mes);
 					$mes_verifico = $otdMesVerificado[0]->mes;

 					if($otdMesesAplican){

 						$meses = explode("|", $otdMesesAplican->meses);
 						//Mes inferior - Mes superior
 						$min = (int)min($meses);
 						$max = (int)max($meses);

 						//Condicional para comprobar las verificaciones con base al mes de corte
 						//----------ESTADOS 
 						//1:VIGENTE 2:POR VENCER 3:EXTEMPORANEO 4:VENCIDO

			 			if( (int)$mes <= $max ){ 

			 				$estatus = 2;

			 				if($mes_verifico){
			 					if(in_array($mes_verifico, $meses) ){
						    		$estatus = 1;
								}
			 				}

			 			} 
			 			else{

			 				$estatus = 4;
			 				if($mes_verifico){
			 					if(in_array($mes_verifico, $meses) ){
						    		$estatus = 1;
								}
								else{
									$estatus = 3;
								}
			 				}

			 			}

			 			//Añadimos información adicional para los vehículos que serán agregados al reporte
			 			switch ($estatus) {
			 				case 2:
			 					$arrAuxiliar["estatus"] = 'POR VENCER';
			 					$arrAuxiliar["mes"] = $this->ARR_MESES_DESCRIPCIONES[$max]; 
			 					//Asignar datos al array
	        					array_push($arrVehiculosVerificarVencer, $arrAuxiliar);

			 					break;
			 				
			 				case 4:
			 					$arrAuxiliar["estatus"] = 'VENCIDO';
			 					$arrAuxiliar["mes"] = $this->ARR_MESES_DESCRIPCIONES[$max];
			 					//Asignar datos al array
	        					array_push($arrVehiculosVerificarVencidos, $arrAuxiliar);

			 					break;
			 			}

 					}
 							
				}

				$index++;
			}	
 		}
		
		//Se agrega el título del archivo
		$strTituloReporte = 'LISTADO DE VIGENCIA DE VERIFICACIONES FÍSICO MECÁNICAS';
		$strNombreHoja = 'Fisico mecanicas';
		$objNuevaHoja = $objExcel->createSheet();
		//Marcar como activa la nueva hoja
		$objExcel->setActiveSheetIndex(2); 
		//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
        $this->get_encabezado_archivo_excel($objNuevaHoja, 'nueva');
        //Definir nombre de la hoja
		$objNuevaHoja->setTitle($strNombreHoja);
		$objExcel->setActiveSheetIndex(2)->setCellValue('A7', $strTituloReporte);

		//Preferencias de color de relleno de celda
        $arrStyleFuenteColumnas = array('font' => array('bold' => TRUE, 'color' => array('rgb' => 'ffffff')));
    	$arrStyleFuenteNormal = array('font' => array('bold' => FALSE, 'color' => array('rgb' => '000000')));  
        //Definir estilo de las celdas correspondientes a los encabezados
        $arrStyleColumnas = array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => COLOR_RELLENO_CELDA));
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
		$objExcel->setActiveSheetIndex(2)->setCellValue('A9', 'CÓDIGO');
		$objExcel->setActiveSheetIndex(2)->setCellValue('B9', 'MODELO');
		$objExcel->setActiveSheetIndex(2)->setCellValue('C9', 'MARCA');
		$objExcel->setActiveSheetIndex(2)->setCellValue('D9', 'AÑO');
		$objExcel->setActiveSheetIndex(2)->setCellValue('E9', 'PLACAS');
		$objExcel->setActiveSheetIndex(2)->setCellValue('F9', 'ESTATUS');
		$objExcel->setActiveSheetIndex(2)->setCellValue('G9', 'MES');
		
		//Cambiar estilo de las siguientes celdas
        $objExcel->getActiveSheet(2)->getStyle('A9:G9')->applyFromArray($arrStyleBold);
        //Preferencias de color de relleno de celda 
        $objExcel->getActiveSheet(2)->getStyle('A9:G9')->getFill()->applyFromArray($arrStyleColumnas);
        //Preferencias de color de texto de la celda 
    	$objExcel->getActiveSheet(2)->getStyle('A9:G9')->applyFromArray($arrStyleFuenteColumnas);
    	//Cambiar alineación de las siguientes celdas
		$objExcel->getActiveSheet(2)->getStyle('A9:G9')->getAlignment()->applyFromArray($arrStyleAlignmentCenter);

		$intFila = 9;

		if($arrVehiculosVerificarVencidos){
        	foreach ($arrVehiculosVerificarVencidos as $arrReg) 
	        {
			 	
			 	//La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(1)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol["codigo"], PHPExcel_Cell_DataType::TYPE_STRING)
							 ->setCellValue('B'.$intFila, $arrCol["modelo"])
						     ->setCellValue('C'.$intFila, $arrCol["marca"])
						     ->setCellValue('D'.$intFila, $arrCol["anio"])
						     ->setCellValue('E'.$intFila, $arrCol["placas"])
							 ->setCellValue('F'.$intFila, $arrCol["estatus"])
							 ->setCellValue('G'.$intFila, $arrCol["mes"]);
	                         
	    		//Incrementar el indice para escribir los datos del siguiente registro
	        	$intFila++; 	

			}
        }
        
        if($arrVehiculosVerificarVencer){
        	foreach ($arrVehiculosVerificarVencer as $arrReg) 
	        {
			    //La función PHPExcel_Cell_DataType::TYPE_STRING se utiliza para mostrar bien el texto en la celda
				//Agregar información del registro
				$objExcel->setActiveSheetIndex(1)
					 		 ->setCellValueExplicit('A'.$intFila, $arrCol["codigo"], PHPExcel_Cell_DataType::TYPE_STRING)
							 ->setCellValue('B'.$intFila, $arrCol["modelo"])
						     ->setCellValue('C'.$intFila, $arrCol["marca"])
						     ->setCellValue('D'.$intFila, $arrCol["anio"])
						     ->setCellValue('E'.$intFila, $arrCol["placas"])
							 ->setCellValue('F'.$intFila, $arrCol["estatus"])
							 ->setCellValue('G'.$intFila, $arrCol["mes"]);
			}
        }

		//Hacer un llamado a la función para agregar (escribir) pie de página en el archivo
        $this->get_pie_pagina_archivo_excel($objExcel, 'verificaciones_vigentes.xls', 'Vehiculares', $intFila);		 
    			 
	}

}