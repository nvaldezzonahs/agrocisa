<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_balanza_comprobacion_xml extends MY_Controller {

	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar ruta de la carpeta destino
	    $this->archivo['strCarpetaDestino'] = './archivos/balanza_comprobacion_xml/';
	    //Cargamos el modelo de empresas
		$this->load->model('administracion/empresas_model', 'empresas');
		//Cargamos el modelo
		$this->load->model('contabilidad/catalogo_cuentas_model', 'cuentas');
	}

	//Método principal del controlador.
	public function index($strParametros = NULL)
	{
		$strParametros = str_replace(array('-', '_', '~'), array('+', '/', '='), $strParametros);
		$strParametros = $this->encrypt->decode($strParametros);
		$arrDatos = explode('||', $strParametros);
		//Hacer un llamado a la función para cargar contenido de la vista
		$this->cargar_vista('contabilidad/rep_balanza_comprobacion_xml', $arrDatos);
	}

	
	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	

	/*Método para generar un archivo XML con la información de la balanza de comprobación*/
	public function get_xml() 
	{	            
		
		//Variables que se utilizan para recuperar los valores de la vista
		$strMes = $this->input->post('strMes');
		$strAnio = $this->input->post('strAnio');
		$strTipoEnvio = $this->input->post('strTipoEnvio');
		$dteFechaModificacion = $this->input->post('dteFechaModificacion');


		//Concatenar id del registro que hace referencia a la carpeta donde se encuentran los archivos 
		//Ubicación donde se guardaran los archivos generados
	 	$strNombreCarpeta = $this->archivo['strCarpetaDestino'];
		//Si no existe la carpeta crearla
		if(!is_dir($strNombreCarpeta))
		{ 
			@mkdir($strNombreCarpeta, 0700); 
		}


		//------------------------------------------------------------------------------------------------------------------------
		//---------- VARIABLES DE SALIDA
		//------------------------------------------------------------------------------------------------------------------------
		$strErrores = "";

		//------------------------------------------------------------------------------------------------------------------------
		//---------- DATOS DE LA EMPRESA
		//------------------------------------------------------------------------------------------------------------------------
		//Seleccionar datos de la empresa
    	$otdEmpresa = $this->empresas->buscar($this->session->userdata('sucursal_id'));


    	//------------------------------------------------------------------------------------------------------------------------
		//---------- INFORMACIÓN DEL NODO BALANZA
		//------------------------------------------------------------------------------------------------------------------------
		$strArchivo = "<BCE:Balanza ";
		$strArchivo.= "xsi:schemaLocation=\"http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/BalanzaComprobacion http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/BalanzaComprobacion/BalanzaComprobacion_1_3.xsd\" ";
		$strArchivo.= "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" ";
		$strArchivo.= "xmlns:BCE=\"http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/BalanzaComprobacion\" ";
		$strArchivo.= "Version=\"1.3\" ";
		$strArchivo.= "RFC=\"".$otdEmpresa->rfc."\" ";
		$strArchivo.= "Mes=\"".$strMes."\" ";
		$strArchivo.= "Anio=\"".$strAnio."\" ";
		$strArchivo.= "TipoEnvio=\"".$strTipoEnvio."\" ";
		//Si el tipo de envío es complementaria
		if ($strTipoEnvio == "C")
		{
			$strArchivo.= "FechaModBal=\"".$dteFechaModificacion."\" ";
		}
		//$strArchivo.= "Sello=\"".validaParaXML("PAGO EN UNA SOLA EXHIBICION")."\" ";
		//$strArchivo.= "noCertificado=\"".$rstFolios["certificado_serie"]."\" ";
		//$strArchivo.= "Certificado=\"".$strCertificado."\" ";
		$strArchivo.= "> ";
	
		
		//------------------------------------------------------------------------------------------------------------------------
		//---------- CONSULTAR EL CATALOGO DE CUENTAS
		//------------------------------------------------------------------------------------------------------------------------
		//Seleccionar cuentas contables sin tercer nivel 
	    $otdCuentas = $this->cuentas->buscar_cuentas_balanza();

	    //Verificar si hay información de cuentas 
		if($otdCuentas)
		{

			//Recorremos el arreglo 
			foreach ($otdCuentas as $arrCta)
			{
			
				//------------------------------------------------------------------------------------------------------------------------
				//---------- RECORRER TABLAS PARA SUMAR SALDOS DE LAS CUENTAS
				//------------------------------------------------------------------------------------------------------------------------
				$otdSaldosCuenta = $this->cuentas->buscar_saldos_cuenta_balanza($strAnio, $strMes,  
																				$arrCta->primer_nivel,
																				$arrCta->segundo_nivel, 
																				$arrCta->acepta_movimientos);

				//Variables que se utilizan para los acumulados
				$numDebeAnt = 0;
				$numHaberAnt = 0;
				$numDebeAct = 0;
				$numHaberAct = 0;

				//Verificar si hay información de saldos de la cuenta
				if($otdSaldosCuenta)
				{
					//Recorremos el arreglo 
					foreach ($otdSaldosCuenta as $arrSdoCta)
					{
						//Incrementar acumulados
						$numDebeAnt += $arrSdoCta->DebeAnterior;
						$numHaberAnt += $arrSdoCta->HaberAnterior;
						$numDebeAct += $arrSdoCta->Debe;
						$numHaberAct += $arrSdoCta->Haber;

					}//Cierre de foreach

				}//Cierre de verificación de saldos de la cuenta


				//------------------------------------------------------------------------------------------------------------------------
				//---------- DETALLE DE LAS CUENTAS
				//------------------------------------------------------------------------------------------------------------------------
				if ((($numDebeAnt - $numHaberAnt) > 0.1) OR (($numHaberAnt - $numDebeAnt) > 0.1) OR
					(($numDebeAct - $numHaberAct) > 0.1) OR (($numHaberAct - $numDebeAct) > 0.1) OR 
					($arrCta->estatus == 'ACTIVO'))
				{
					//Si no existe cuenta SAT
					if ($arrCta->sat_cuenta_id == 0)
					{
						$strErrores.= $arrCta->primer_nivel." ".$arrCta->segundo_nivel." ".$arrCta->tercer_nivel." ".$arrCta->cuarto_nivel." - ".$arrCta->descripcion."\r\n";
					}
					else
					{
						$strArchivo.= "<BCE:Ctas ";
						$strArchivo.= "NumCta=\"".$arrCta->primer_nivel.$arrCta->segundo_nivel.$arrCta->tercer_nivel.$arrCta->cuarto_nivel."\" ";

						//Si la cuenta es de naturaleza deudora
						if ($arrCta->naturaleza == "DEUDORA")
						{
							$strArchivo.= "SaldoIni=\"".number_format(($numDebeAnt - $numHaberAnt), 2, '.', '')."\" ";
						}
						else
						{
							$strArchivo.= "SaldoIni=\"".number_format(($numHaberAnt - $numDebeAnt), 2, '.', '')."\" ";
						}

						$strArchivo.= "Debe=\"".number_format($numDebeAct, 2, '.', '')."\" ";
						$strArchivo.= "Haber=\"".number_format($numHaberAct, 2, '.', '')."\" ";
						//Si la cuenta es de naturaleza deudora
						if ($arrCta->naturaleza == "DEUDORA")
						{
							$strArchivo.= "SaldoFin=\"".number_format(($numDebeAnt + $numDebeAct - $numHaberAnt - $numHaberAct), 2, '.', '')."\" ";
						}
						else
						{
							$strArchivo.= "SaldoFin=\"".number_format(($numHaberAnt + $numHaberAct - $numDebeAnt - $numDebeAct), 2, '.', '')."\" ";
						}

						$strArchivo.="/>";
					}
				}


			}//Cierre de foreach cuentas contables

		}//Cierre de verificación de cuentas contables

		//Si existen errores
		if ($strErrores <> "")
		{
			//Asignar el nombre del archivo
			$strNombreArchivo = "erroresBalanzaComp".basename($strAnio.$strMes);
			$strErrores = utf8_encode($strErrores);
			//Asignar ruta del archivo
			$strRutaArchivo = $strNombreCarpeta.$strNombreArchivo.".txt";
			//Creamos el archivo TXT
			$arcTemp = fopen($strRutaArchivo,"w"); 
			//Escribir información
			fwrite($arcTemp, $strErrores);
			//Cerrar el archivo TXT
			fclose($arcTemp);
		}
		else
		{
			//------------------------------------------------------------------------------------------------------------------------
			//---------- AGREGAMOS ENCABEZADO Y CIERRE DE XML
			//------------------------------------------------------------------------------------------------------------------------
			$strArchivo = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>".$strArchivo."</BCE:Balanza>";
			$strArchivo = utf8_encode($strArchivo);
			//Si el tipo de envío es complementaria
			if ($strTipoEnvio == "C")
			{
				//Asignar el nombre del archivo
				$strNombreArchivo = basename($otdEmpresa->rfc.$strAnio.$strMes."BC");
			}
			else
			{	
				//Asignar el nombre del archivo
				$strNombreArchivo = basename($otdEmpresa->rfc.$strAnio.$strMes."BN");
			}


			//Asignar ruta del archivo
			$strRutaArchivo = $strNombreCarpeta.$strNombreArchivo.".xml";
			//Creamos el archivo XML
			$arcTemp = fopen($strRutaArchivo,"w");
			//Escribir información
			fwrite($arcTemp, $strArchivo);
			//Cerrar el archivo XML
			fclose($arcTemp);

		}
	
		
		//Hacer un llamado a la función para descargar el archivo
		$this->descargar_archivo_reg($strNombreCarpeta, $strNombreArchivo);
		
	}
	
}