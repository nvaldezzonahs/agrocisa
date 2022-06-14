<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep_catalogo_cuentas_xml extends MY_Controller {

	//Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar ruta de la carpeta destino
	    $this->archivo['strCarpetaDestino'] = './archivos/catalogos_cuentas_xml/';
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
		$this->cargar_vista('contabilidad/rep_catalogo_cuentas_xml', $arrDatos);
	}

	
	//Regresa los permisos de acceso del usuario para este proceso
	public function get_permisos_acceso()
	{
		//Array que se utiliza para enviar datos a la vista
		$arrDatos = array('row' => $this->encrypt->decode($this->input->post('strPermisosAcceso')));
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	

	/*Método para generar un archivo XML con la información de las cuentas contables*/
	public function get_xml() 
	{	            
		
		//Variables que se utilizan para recuperar los valores de la vista
		$strTipoReporte = $this->input->post('strTipoReporte');
		$strMes = $this->input->post('strMes');
		$strAnio = $this->input->post('strAnio');

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
		//---------- VALIDAR QUE LAS CUENTAS A ENVIAR SE ENCUENTREN LIGADAS AL CATALOGO DEL SAT
		//------------------------------------------------------------------------------------------------------------------------
		//Seleccionar cuentas contables sin cuenta SAT
	    $otdCuentasSinCtaSat = $this->cuentas->buscar_cuentas_cuentaSat($strTipoReporte, 
	    																$strAnio, $strMes, "NO");

	     //Verificar si hay información de cuentas no ligadas al catálogo SAT
		if($otdCuentasSinCtaSat)
		{
			//Recorremos el arreglo 
			foreach ($otdCuentasSinCtaSat as $arrCta)
			{
				//Concatenar cuenta contable
				$strErrores.= $arrCta->cuenta."\r\n";

			}//Cierre de foreach

			

			//Asignar el nombre del archivo
			$strNombreArchivo = "cuentasSinCtaSat".basename($strAnio.$strMes);
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
			//---------- DATOS DE LA EMPRESA
			//------------------------------------------------------------------------------------------------------------------------
			//Seleccionar datos de la empresa
	    	$otdEmpresa = $this->empresas->buscar($this->session->userdata('sucursal_id'));

	    	//Seleccionar cuentas contables con cuenta SAT
	   		$otdCuentasCtaSat = $this->cuentas->buscar_cuentas_cuentaSat($strTipoReporte, 
	    																  $strAnio, $strMes);


	   		//------------------------------------------------------------------------------------------------------------------------
			//---------- INFORMACIÓN DEL NODO CATALOGO
			//------------------------------------------------------------------------------------------------------------------------
			$strArchivo = "<catalogocuentas:Catalogo ";
			$strArchivo.= "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" ";
			$strArchivo.= "xmlns:catalogocuentas=\"http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/CatalogoCuentas\" ";
			$strArchivo.= "xsi:schemaLocation=\"http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/CatalogoCuentas http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/CatalogoCuentas/CatalogoCuentas_1_3.xsd\" ";
			$strArchivo.= "Version=\"1.3\" ";
			$strArchivo.= "RFC=\"".$otdEmpresa->rfc."\" ";
			$strArchivo.= "Mes=\"".$strMes."\" ";
			$strArchivo.= "Anio=\"".$strAnio."\" ";
			//$strArchivo.= "Sello=\"".validaParaXML("PAGO EN UNA SOLA EXHIBICION")."\" ";
			//$strArchivo.= "noCertificado=\"".$rstFolios["certificado_serie"]."\" ";
			//$strArchivo.= "Certificado=\"".$strCertificado."\" ";
			$strArchivo.= "> ";


			//------------------------------------------------------------------------------------------------------------------------
			//---------- DETALLE DE LAS CUENTAS
			//------------------------------------------------------------------------------------------------------------------------
			//Verificar si hay información de cuentas ligadas al catálogo SAT
			if($otdCuentasCtaSat)
			{
				//Recorremos el arreglo 
				foreach ($otdCuentasCtaSat as $arrCta)
				{
					$strArchivo.= "<catalogocuentas:Ctas ";
					$strArchivo.= "CodAgrup=\"".$arrCta->codigo_agrupador."\" ";
					$strArchivo.= "NumCta=\"".$arrCta->primer_nivel.$arrCta->segundo_nivel.
								   $arrCta->tercer_nivel.$arrCta->cuarto_nivel."\" ";
					$strArchivo.= "Desc=\"".$this->validaParaXML($arrCta->descripcion)."\" ";
					//Si existe cuenta del padre (primer nivel de la cuenta padre)
					if ($arrCta->PrimerNivelPadre <> "")
					{
						$strArchivo.= "SubCtaDe=\"".$arrCta->PrimerNivelPadre.$arrCta->SegundoNivelPadre.
									  $arrCta->TercerNivelPadre.$arrCta->CuartoNivelPadre."\" ";
					}

					//Variable que se utiliza para asigna nivel de la cuenta
					$numNivel = 1;

					//Dependiendo de la cuenta cambiar el nivel
					if ($arrCta->cuarto_nivel <> "00000")
					{
						$numNivel = 4;
					}
					else if ($arrCta->tercer_nivel <> "00")
					{
						$numNivel = 3;
					}
					else if ($arrCta->segundo_nivel <> "00")
					{
						$numNivel = 2;
					}

					$strArchivo.= "Nivel=\"".$numNivel."\" ";


					//Si la naturaleza de la cuenta es DEUDORA
					if ($arrCta->naturaleza  == 'DEUDORA')
					{
						$strArchivo.= "Natur=\"D\"";
					}
					else
					{
						$strArchivo.= "Natur=\"A\"";
					}

					$strArchivo.="/>";

				}//Cierre de foreach
			}


			//------------------------------------------------------------------------------------------------------------------------
			//---------- AGREGAMOS ENCABEZADO Y CIERRE DE XML
			//------------------------------------------------------------------------------------------------------------------------
			$strArchivo = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>".$strArchivo."</catalogocuentas:Catalogo>";
			$strArchivo = utf8_encode($strArchivo);
			$strNombreArchivo = basename($otdEmpresa->rfc.$strAnio.$strMes."CT");
			//Asignar ruta del archivo
			$strRutaArchivo = $strNombreCarpeta.$strNombreArchivo.".xml";
			//Creamos el archivo XML
			$arcTemp = fopen($strRutaArchivo,"w"); 
			//fwrite($arcTemp, "\xEF\xBB\xBF");
			//Escribir información
			fwrite($arcTemp, $strArchivo);
			//Cerrar el archivo XML
			fclose($arcTemp);
				
		}


		//Hacer un llamado a la función para descargar el archivo
		$this->descargar_archivo_reg($strNombreCarpeta, $strNombreArchivo);
		
	}
	
}