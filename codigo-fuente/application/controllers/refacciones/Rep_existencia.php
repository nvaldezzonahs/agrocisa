<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_existencia extends MY_Controller {
	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Cargamos el modelo
		$this->load->model('refacciones/rep_existencia_model', 'existencia');
		$this->load->model('administracion/empresas_model', 'empresas');
		$this->load->model('administracion/sucursales_model', 'sucursales');

	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('refacciones/rep_existencia', $arrDatos);
	}


	/*Método para generar un reporte PDF con el listado de los registros 
	 *dependiendo del criterio de búsqueda proporcionado*/
	public function get_reporte($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intMarcaID, $intLineaID, $intRefaccionID) 
	{
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');		
		//Variable que se utiliza para asignar título de la fecha
		$strTituloFecha = '';
		//Variable que se utiliza para contar el número de registros
		$intContador = 0;
		//Seleccionar los datos del registro que coincide con la fecha
		$result = $this->existencia->consultar($dteFechaInicial, $dteFechaFinal, $intSucursalID, $intMarcaID, $intLineaID, $intRefaccionID);
		$otdResultado = $result->result();

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
		$pdf->strLinea1 =  'EXISTENCIA REFACCIONES '.$strTituloFecha;
		//Crea los titulos de la cabecera
		$pdf->arrCabecera = array(utf8_decode('SUCURSAL'), utf8_decode('DESCRIPCIÓN'), 'FECHA', 'KARDEX', 'COSTO',  'IMPORTE');
		//Establece el ancho de las columnas de cabecera
		$pdf->arrAnchura = array(50, 60, 20, 20, 20, 20);
		//Establece la alineación de las celdas de la tabla
		$pdf->arrAlineacion = array('L', 'L', 'C', 'R', 'R', 'R');
		//Agregar la primer pagina
		$pdf->AddPage();
		//Establece el ancho de las columnas
		$pdf->SetWidths($pdf->arrAnchura);
		
		//Array que se utiliza para agregar los datos de un detalle
		$arrAuxiliar = array();
		//Si hay información
		if ($otdResultado)
		{

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
   				if($intRefaccionID != $arrCol->refaccion_id && $intRefaccionID != 0)
   				{	
   					//Impresión de variables
					$pdf->Row(array(utf8_decode($strSucursal),
									utf8_decode($strDescripcion), 
									$strFecha,  
									$numExistencia, 
									'$'.number_format($numCosto, 2),
									'$'.number_format($numExistencia * $numCosto, 2)
									), 									
									$pdf->arrAlineacion, 
									'ClippedCell'
							);

					//Reinicializar variables
					$numExistencia = $arrCol->inicial_existencia;
					$numCosto = $arrCol->inicial_costo;
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

				$intRefaccionID = $arrCol->refaccion_id;
				$strSucursal = $arrCol->sucursal;
				$strDescripcion = $arrCol->descripcion;
				$strFecha = $arrCol->fecha;	
				//Incrementar el contador por cada registro
				$intContador++;
				
			}

			//Agregar datos del último refacción
   			if($intRefaccionID != 0)
			{
				$pdf->Row(array(utf8_decode($strSucursal),
								utf8_decode($strDescripcion), 
								$strFecha,  
								$numExistencia, 
								'$'.number_format($numCosto, 2),
								'$'.number_format($numExistencia * $numCosto, 2)
									), 									
									$pdf->arrAlineacion
							);
			}


		}

				//Espacios de salto de línea
		$pdf->Ln();
		//Asigna el tipo y tamaño de letra para los totales
		$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
		//Escribe la cadena concatenada con el total de registros
		$pdf->Cell(0,3,'TOTAL: '.$intContador, 0, 0, 'R');			
		//Ejecutar la salida del reporte
		$pdf->Output('reporte_existencia.pdf','I');	            
		
	}


}	