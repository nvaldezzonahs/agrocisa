<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir libreria que se utiliza para crear imagen QRCODE
include_once(APPPATH . 'libraries/utilerias/phpqrcode/qrlib.php'); 

class Timbrado extends MY_Controller {
	//Variables de la clase
    //Información que se envia a la vista
    var $ARR_DATOS = NULL;
    //Información que se utiliza para asignar la ruta de la carpeta destino (donde se guarda el archivo del registro)
	var $archivo = NULL;

	//Constructor de la clase
	function __construct()
	{
		parent::__construct();
		//Asignar ruta de la carpeta principal
	    $this->archivo['strCarpetaPrincipal'] = './archivos/';
		//Cargamos el modelo de empresas
		$this->load->model('administracion/empresas_model', 'empresas');
		//Cargamos el modelo de certificados
		$this->load->model('contabilidad/certificados_model', 'certificados');
		//Cargamos el modelo de anticipos
		$this->load->model('caja/anticipos_model', 'anticipos');
		//Cargamos el modelo de aplicación de anticipo
		$this->load->model('caja/anticipos_aplicacion_model', 'aplicacion');
		//Cargamos el modelo de aplicación de pagos
		$this->load->model('caja/pagos_model', 'pagos');
		//Cargamos el modelo de facturas de servicio
		$this->load->model('servicio/facturas_servicio_model', 'facturas_servicio');
		//Cargamos el modelo de facturas de  refacciones
		$this->load->model('refacciones/facturas_refacciones_model', 'facturas_refacciones');
		//Cargamos el modelo de facturas de maquinaria
		$this->load->model('maquinaria/facturas_maquinaria_model', 'facturas_maquinaria');
		//Cargamos el modelo de facturas de conceptos
		$this->load->model('contabilidad/facturas_conceptos_model', 'facturas_conceptos');
		//Cargamos el modelo de movimiento de refacciones
		$this->load->model('refacciones/movimientos_refacciones_model', 'movimientos_refacciones');
		//Cargamos el modelo de movimiento de entradas de maquinaria por devolucion
		$this->load->model('maquinaria/entradas_maquinaria_devolucion_model', 'entradas_maquinaria_devolucion');
		//Cargamos el modelo de notas de crédito servicio
		$this->load->model('servicio/notas_credito_servicio_model', 'notas_credito_servicio');
		//Cargamos el modelo de notas de crédito digitales
		$this->load->model('cuentas_cobrar/notas_credito_digitales_model', 'notas_credito_digitales');
		//Cargamos el modelo de notas de cargo digitales
		$this->load->model('cuentas_cobrar/notas_cargo_digitales_model', 'notas_cargo_digitales');
		//Cargamos el modelo de CFDI relacionados
		$this->load->model('caja/cfdi_relacionados_model', 'cfdi');
		//Variable que se utiliza para asignar los errores del timbrado al ejecutar el servicio de facturación
        $this->ARR_DATOS['strErrorXML'] = '';
        //Variable que se utiliza para asignar el tipo de mensaje de error
        $this->ARR_DATOS['strTipoMensaje'] = '';
	}

	//Método para guardar los datos del timbrado de un registro
	public function set_timbrar()
	{
		//No mostrar los errores de php
	    error_reporting(0);
		//Variables que se utilizan para recuperar los valores de la vista 
		$intReferenciaID = $this->input->post('intReferenciaID');
		$strTipoReferencia = $this->input->post('strTipoReferencia');
		$arrReferencia = explode(" ", $strTipoReferencia);

		//Hacer un llamado a la función para generar el archivo XML 
		$this->get_xml($intReferenciaID, $strTipoReferencia);

		//Si no se obtienen errores al ejecutar el proceso
		if ($this->ARR_DATOS['strErrorXML'] == '')
		{	
			//Se manda llamar la función para generar documentos PDF de tipo FACTURA unicamente
			if ($arrReferencia[0] == 'FACTURA')
			{
				$this->get_pdf_facturas($intReferenciaID, $strTipoReferencia, 'SI');
			}
			else
			{	
				//Hacer un llamado a la función para generar el archivo PDF
		    	$this->get_pdf($intReferenciaID, $strTipoReferencia, 'SI');
			}	

			//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE, 'tipo_mensaje' => TIPO_MSJ_EXITO, 'mensaje' => 'El registro se timbro correctamente.');
		}
		else
		{
			//Enviar el mensaje de error al formulario
			$arrDatos = array('resultado' => FALSE, 'tipo_mensaje' => $this->ARR_DATOS['strTipoMensaje'], 'mensaje' =>  $this->ARR_DATOS['strErrorXML']);
		}
		//Enviar datos a la vista
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}

	//Método para generar un archivo XML con los datos de timbrado
	public function get_xml($intReferenciaID, $strTipoReferencia)
	{	
		//Variable que se utiliza para asignar los resultados de la respuesta al servidor Web Facturaxion 
        //que se utiliza para generar timbre
        $strResultado = "";
        $numSubtotal = 0;
		$numDescuento = 0;
		$numIVA = 0;
		$arrIVA = Array();
		$numEleIVA = 0;
		$numIEPS = 0;
		$arrIEPS = Array();
		$numEleIEPS = 0;
		$intTotalImpuestosTraslados = 0;
		
		//Definir ubicación de la carpeta principal
		$strCarpetaDestino = $this->archivo['strCarpetaPrincipal']; 
	  
	    //Asignar objeto con los datos de la referencia que se utilizan para la búsqueda del registro
		$otdReferencia =  $this->get_referencia($strTipoReferencia);
		//Asignar valores de la referencia
		$strModeloReferencia = $otdReferencia['modelo'];
		$strMetodoBusqueda = $otdReferencia['metodo_busqueda'];
		$strMetodoBusquedaDetalles = $otdReferencia['metodo_busqueda_detalles'];
		$strCarpetaReferencia = $otdReferencia['carpeta'];

	    //Si no existe la carpeta crearla
		if(!is_dir($strCarpetaDestino))
		{ 
			@mkdir($strCarpetaDestino, 0700); 
		}

		//Concaternar ubicación de la carpeta destino
		$strCarpetaDestino .= './'.$strCarpetaReferencia.'/';
		//Si no existe la carpeta crearla
		if(!is_dir($strCarpetaDestino))
		{ 
			@mkdir($strCarpetaDestino, 0700); 
		} 

		//Definir ubicación de la carpeta
		$strNombreCarpeta = $strCarpetaDestino.$intReferenciaID; 
		$strRuta = $strNombreCarpeta.'/';
		//Si no existe la carpeta crearla
		if(!is_dir($strNombreCarpeta))
		{ 
			@mkdir($strNombreCarpeta, 0700); 
		}

	    //------------------------------------------------------------------------------------------------------------------------
		//---------- DATOS DEL EMISOR
		//------------------------------------------------------------------------------------------------------------------------
        //Seleccionar datos de la empresa (emisor)
	    $otdEmisor = $this->empresas->buscar($this->session->userdata('sucursal_id'));

	    //------------------------------------------------------------------------------------------------------------------------
		//---------- DATOS DE CFDI RELACIONADOS
		//------------------------------------------------------------------------------------------------------------------------
	    //Seleccionar los CFDI relacionados del movimiento fiscal
	    $otdCfdiRelacionados = $this->cfdi->buscar($intReferenciaID, $strTipoReferencia);
	    
	    //------------------------------------------------------------------------------------------------------------------------
		//---------- CERTIFICADO DIGITAL
		//------------------------------------------------------------------------------------------------------------------------
		//Seleccionar datos del certificado activo
		$otdCertificado = $this->certificados->buscar(NULL, NULL, 'ACTIVO');

		//------------------------------------------------------------------------------------------------------------------------
		//---------- RUTAS DE LOS ARCHIVOS KEY Y CER
		//------------------------------------------------------------------------------------------------------------------------
		$rutaLlavePrivada = "./certificados/".$otdCertificado->folio.".key.pem";
		$rutaCertificado = "./certificados/".$otdCertificado->folio.".cer.pem";

        //------------------------------------------------------------------------------------------------------------------------
		//---------- MOVIMIENTO FISCAL
		//------------------------------------------------------------------------------------------------------------------------
	    //Seleccionar datos del movimiento (Busca en el modelo correspondiente)
	    $otdMovimiento = $this->$strModeloReferencia->$strMetodoBusqueda($intReferenciaID);

		//------------------------------------------------------------------------------------------------------------------------
		//---------- DETALLES DEL MOVIMIENTO FISCAL
		//------------------------------------------------------------------------------------------------------------------------
		//Seleccionar los detalles del movimiento (Busca en el modelo correspondiente)
	    $otdDetalles = $this->$strModeloReferencia->$strMetodoBusquedaDetalles($intReferenciaID);


		//Asignar el nombre del archivo XML
		$strNombreArchivo = $strRuta.$otdMovimiento->folio.'.xml';

		//Si hay información del movimiento fiscal
		if($otdMovimiento)
		{
			//Variable que se utiliza para asignar el tipo de cambio
			$intTipoCambio = (float)$otdMovimiento->tipo_cambio;
			//Verificar si existe información de los detalles 
			if ($otdDetalles) 
			{ 
				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDet)
				{
					//Variables que se utilizan para asignar valores del detalle
					$intSubtotal =  ($arrDet->cantidad * $arrDet->subtotal);
					$intDescuento = ($arrDet->cantidad * $arrDet->descuento);
					$intImporteIva = ($arrDet->cantidad * $arrDet->iva);
					$intImporteIeps = ($arrDet->cantidad * $arrDet->ieps);

					//Si existe tipo de cambio
					if ($intTipoCambio > 0)
					{
						//Convertir peso mexicano a tipo de cambio
						$intSubtotal = ($intSubtotal/$intTipoCambio);
						$intDescuento = ($intDescuento/$intTipoCambio);
						$intImporteIva = ($intImporteIva/$intTipoCambio);
						$intImporteIeps = ($intImporteIeps/$intTipoCambio);
					}

					//Convertir cantidad a dos decimales
					$intSubtotal =  number_format($intSubtotal, 2, '.', '');
					$intDescuento = number_format($intDescuento, 2, '.', '');
					$intImporteIva = number_format($intImporteIva, 2, '.', '');
					$intImporteIeps = number_format($intImporteIeps, 2, '.', '');

					//Convertir cantidad a seis decimales
					$intPorcentajeIva = number_format($arrDet->PorcentajeIva, 6, '.', '');
					$intPorcentajeIeps = number_format($arrDet->PorcentajeIeps, 6, '.', '');

					//Incrementar acumulados
					$numSubtotal += $intSubtotal;
					$numDescuento += $intDescuento;
					$numIVA += $intImporteIva;
					$numIEPS += $intImporteIeps;

					//Array que contiene el impuesto de IVA
					$bolEntroIVA = FALSE;
					for ($intConIVA = 0; $intConIVA < $numEleIVA; $intConIVA++)
					{
						if ($arrIVA[$intConIVA][2] == $intPorcentajeIva)
						{
							$arrIVA[$intConIVA][3] += $intImporteIva;
							$bolEntroIVA = TRUE;
							$intConIVA = $numEleIVA;
						}
					}
					if (!$bolEntroIVA)
					{
						$arrIVA[$numEleIVA][0] = $arrDet->ImpuestoIva;
						$arrIVA[$numEleIVA][1] = $arrDet->FactorIva;
						$arrIVA[$numEleIVA][2] = $intPorcentajeIva;
						$arrIVA[$numEleIVA][3] = $intImporteIva;
						
						$numEleIVA++;
					}

					//Si existe importe de IEPS
					if ($intImporteIeps > 0)
					{
					    //Array que contiene el impuesto de IEPS
						$bolEntroIEPS = FALSE;
						for ($intConIEPS = 0; $intConIEPS < $numEleIEPS; $intConIEPS++)
						{
							if ($arrIEPS[$intConIEPS][2] == $intPorcentajeIeps)
							{
								$arrIEPS[$intConIEPS][3] += $intImporteIeps;
								$bolEntroIEPS = TRUE;
								$intConIEPS = $numEleIEPS;
							}
						}
						if (!$bolEntroIEPS)
						{
							$arrIEPS[$numEleIEPS][0] = $arrDet->ImpuestoIeps;
							$arrIEPS[$numEleIEPS][1] = $arrDet->FactorIeps;
							$arrIEPS[$numEleIEPS][2] = $intPorcentajeIeps;
							$arrIEPS[$numEleIEPS][3] = $intImporteIeps;
							$numEleIEPS++;
						}
					}
				}
			}//Cierre de verificación de detalles

			//------------------------------------------------------------------------------------------------------------------------
			//-------------------------------------------------------------------------------------------------------- CADENA ORIGINAL
			//------------------------------------------------------------------------------------------------------------------------
			//------------------------------------------------------------------------------------------------------------------------
			//---------- INFORMACIÓN DEL NODO COMPROBANTE
			//------------------------------------------------------------------------------------------------------------------------
			$strCadena ="||3.3|";//--a. Version
			$strSerie = substr($otdMovimiento->folio, 0, strpos($otdMovimiento->folio, "0"));
			$numFolio = substr($otdMovimiento->folio, strpos($otdMovimiento->folio, "0")) + 0;
			$strCadena.= $strSerie."|";//--b. Serie
			$strCadena.= $numFolio."|";//--c. Folio
			$strFecha = substr($otdMovimiento->fecha, 0, 10)."T".substr($otdMovimiento->fecha, 11);
			$strCadena.= $strFecha."|";//--d. Fecha
			//Si existe forma de pago
			if ($otdMovimiento->FormaPago != "")
			{
				$strCadena.= $otdMovimiento->FormaPago."|";//--e. FormaPago
			}
			$strCadena.= $otdCertificado->folio."|";//--f. NoCertificado
			//Si existen codiciones de pago
			if ($otdMovimiento->CondicionesDePago != "")
			{
				$strCadena.= $otdMovimiento->CondicionesDePago."|";//--g. CondicionesDePago
			}
            $numSubtotalDesc = $numSubtotal + $numDescuento;
		    //Si existe subtotal
			if ($numSubtotalDesc > 0)
			{
				//Convertir cantidad a dos decimales
			    $numSubtotalDesc = number_format($numSubtotalDesc, 2, '.', '');
				$strCadena.= $numSubtotalDesc."|";//--h. Subtotal
			}
			else
			{
				$strCadena.= "0|";//--h. Subtotal
			}
			//Si existe importe del descuento
			if ($numDescuento > 0)
			{
				//Convertir cantidad a dos decimales
				$numDescuento = number_format($numDescuento, 2, '.', '');
				$strCadena.= $numDescuento."|";//--i. Descuento
			}
			$strCadena.= $otdMovimiento->MonedaTipo."|";//--j. Moneda
			//Si existe tipo de cambio
			if ($intTipoCambio > 0)
			{
				$strCadena.= $intTipoCambio."|";//--k. TipoCambio
			}
			//Calcular importe total
			$numTotal = ($numSubtotal + $numIVA + $numIEPS);
			//Si existe importe total
			if ($numTotal > 0)
			{
				//Convertir cantidad a dos decimales
				$numTotal = number_format($numTotal, 2, '.', '');
				$strCadena.= $numTotal."|";//--l. Total
			}
			else
			{
				$strCadena.= "0|";//--l. Total
			}
			$strCadena.= $otdMovimiento->TipoDeComprobante."|";//--m. TipoDeComprobante
			//Si existe método de pago
			if ($otdMovimiento->MetodoPago != "")
			{
				$strCadena.= $otdMovimiento->MetodoPago."|";//--n. MetodoPago
			}
			$strCadena.= $otdEmisor->codigo_postal."|";//--o. LugarExpedicion
			//------------------------------------------------------------------------------------------------------------------------
			//---------- INFORMACIÓN DEL NODO CFDIRelacionados
			//------------------------------------------------------------------------------------------------------------------------
			//Si existe tipo de relación
			if ($otdMovimiento->TipoRelacion != "")
			{
				
				$strCadena.= $otdMovimiento->TipoRelacion."|";//--a. TipoRelacion
	    		//Verificar si existe información de los CFDI relacionados 
				if ($otdCfdiRelacionados) 
				{ 
					
					//Recorremos el arreglo 
					foreach ($otdCfdiRelacionados as $arrCfdi)
					{
						$strCadena.= $arrCfdi->uuid."|";//--a. UUID
					}
				}//Cierre de verificación de CFDI relacionados 
			}
			//------------------------------------------------------------------------------------------------------------------------
			//---------- INFORMACIÓN DEL NODO EMISOR
			//------------------------------------------------------------------------------------------------------------------------
			$strCadena.= $this->validaCadena($otdEmisor->rfc)."|";//--a. Rfc
			$strCadena.= $this->validaCadena($otdEmisor->razon_social)."|";//--b. Nombre
			$strCadena.= $otdEmisor->RegimenFiscal."|";//--c. RegimenFiscal

			//------------------------------------------------------------------------------------------------------------------------
			//---------- INFORMACIÓN DEL NODO RECEPTOR
			//------------------------------------------------------------------------------------------------------------------------
			$strRFC = $otdMovimiento->rfc;
			if ((strlen($otdMovimiento->rfc) < 8))
			{
				$strRFC = "XAXX010101000";
			}
			$strCadena.=  $this->validaCadena($strRFC)."|";//--a. Rfc
			$strCadena.=  $this->validaCadena($otdMovimiento->razon_social)."|";//--b. Nombre
			//$strCadena.= "|";//--c. ResidenciaFiscal
			//$strCadena.= "|";//--d. NumRegIdTrib
			$strCadena.= $otdMovimiento->UsoCFDI."|";//--e. UsoCFDI
			//------------------------------------------------------------------------------------------------------------------------
			//---------- INFORMACIÓN DEL NODO CONCEPTO
			//------------------------------------------------------------------------------------------------------------------------
			$strArchivoDetalles = "";
			//Verificar si existe información de los detalles 
			if ($otdDetalles) 
			{ 
				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDet)
				{
					//Variables que se utilizan para asignar valores del detalle
					$intPrecioUnitario =  ($arrDet->subtotal + $arrDet->descuento);
					$intDescuento = ($arrDet->cantidad * $arrDet->descuento);
					$intImporteIva = ($arrDet->cantidad * $arrDet->iva);
					$intImporteIeps = ($arrDet->cantidad * $arrDet->ieps);

					//Si existe tipo de cambio
					if ($intTipoCambio > 0)
					{
						//Convertir peso mexicano a tipo de cambio
						$intPrecioUnitario = ($intPrecioUnitario/$intTipoCambio);
						$intDescuento = ($intDescuento/$intTipoCambio);
						$intImporteIva = ($intImporteIva/$intTipoCambio);
						$intImporteIeps = ($intImporteIeps/$intTipoCambio);
					}
					//Convertir cantidad a dos decimales
					$intImporteIva = number_format($intImporteIva, 2, '.', '');
					$intImporteIeps = number_format($intImporteIeps, 2, '.', '');
					$intDescuento = number_format($intDescuento, 2, '.', '');
					//Convertir cantidad a seis decimales
					$intPorcentajeIva = number_format($arrDet->PorcentajeIva, 6, '.', '');
					$intPorcentajeIeps = number_format($arrDet->PorcentajeIeps, 6, '.', '');
					$strArchivoDetalles.= "<cfdi:Concepto ";
					//--a. ClaveProdServ
					$strCadena.= $arrDet->ClaveProdServ."|";
					$strArchivoDetalles.= "ClaveProdServ=\"".$arrDet->ClaveProdServ."\" ";
					//--b. NoIdentificacion
					if ($arrDet->NoIdentificacion != "")
					{
						$strCadena.= $arrDet->NoIdentificacion."|";
						$strArchivoDetalles.= "NoIdentificacion=\"".$arrDet->NoIdentificacion."\" ";
					}
					//--c. Cantidad
					$strCadena.= $arrDet->cantidad."|";
					$strArchivoDetalles.= "Cantidad=\"".$arrDet->cantidad."\" ";
					//--d. ClaveUnidad
					$strCadena.= $this->validaCadena($arrDet->ClaveUnidad)."|";
					$strArchivoDetalles.= "ClaveUnidad=\"".$this->validaParaXML($arrDet->ClaveUnidad)."\" ";
					//--e. Unidad
					if ($arrDet->Unidad != "")
					{
						$strCadena.= $this->validaCadena($arrDet->Unidad)."|";
						$strArchivoDetalles.= "Unidad=\"".$this->validaParaXML($arrDet->Unidad)."\" ";
					}

					//-- Para el caso de facturas de maquinaria el concepto tendrá información adicional referente a: MODELO, SERIE y MOTOR. En caso de que aplique
					if($strTipoReferencia == "FACTURA MAQUINARIA"){ //Si es de tipo MAQUINARIA la factura
						$strDesc = $arrDet->Descripcion;
						if($otdMovimiento->modelo){
							$strDesc .= ' MODELO: '.$otdMovimiento->modelo;
						}
						if($otdMovimiento->serie){
							$strDesc .= ' SERIE: '.$otdMovimiento->serie;
						}
						if($otdMovimiento->motor){
							$strDesc .= ' MOTOR: '.$otdMovimiento->motor;
						}
						//--f. Descripcion
						$strCadena.= $this->validaCadena($strDesc)."|";
						$strArchivoDetalles.= "Descripcion=\"".$this->validaParaXML($strDesc)."\" ";
					}
					else{
						//--f. Descripcion
						$strCadena.= $this->validaCadena($arrDet->Descripcion)."|";
						$strArchivoDetalles.= "Descripcion=\"".$this->validaParaXML($arrDet->Descripcion)."\" ";
					}
					
					
					//--g. ValorUnitario
					//Si existe precio unitario
					if ($intPrecioUnitario > 0)
					{
						$numTemp = number_format($intPrecioUnitario, 2, '.', '');
						$strCadena.= $numTemp."|";
						$strArchivoDetalles.= "ValorUnitario=\"".$numTemp."\" ";
					}
					else
					{
						$strCadena.= "0|";
						$strArchivoDetalles.= "ValorUnitario=\"0\" ";
					}
					//--h. Importe
					$intImporte = ($intPrecioUnitario * $arrDet->cantidad);

					//Si existe importe
					if ($intImporte > 0)
					{
						$numImporte = number_format($intImporte, 2, '.', '');
						$strCadena.= $numImporte."|";
						$strArchivoDetalles.= "Importe=\"".$numImporte."\" ";
					}
					else
					{
						$strCadena.= "0|";
						$strArchivoDetalles.= "Importe=\"0\" ";
					}
					//--i. Descuento
					$numDesTmp = 0;
					//Si existe descuento
					if ($intDescuento > 0)
					{
						$numDesTmp = $intDescuento;
						$strCadena.= $numDesTmp."|";
						$strArchivoDetalles.= "Descuento=\"".$numDesTmp."\"";
					}
					$strArchivoDetalles.= " >";
					//Si el tipo de referencia es diferente a PAGO
					
					if ($strTipoReferencia != "PAGO")
					{

						//Calcular el importe base
						$intImporteBase = number_format(($numImporte - $numDesTmp), 2, '.', '');
						//--j. Impuestos Traslado
						$strArchivoDetalles.= "<cfdi:Impuestos>";
						$strArchivoDetalles.= "<cfdi:Traslados>";
						//--IVA
						$strArchivoDetalles.= "<cfdi:Traslado ";
						//--a. Base
						$strCadena.= $intImporteBase."|";
						$strArchivoDetalles.= "Base=\"".$intImporteBase."\" ";
						//--b. Impuesto
						$strCadena.= $arrDet->ImpuestoIva."|";
						$strArchivoDetalles.= "Impuesto=\"".$arrDet->ImpuestoIva."\" ";
						//--c. TipoFactor
						$strCadena.= $arrDet->FactorIva."|";
						$strArchivoDetalles.= "TipoFactor=\"".$arrDet->FactorIva."\" ";
						//--d. TasaOCuota
						$strCadena.= $intPorcentajeIva."|";
						$strArchivoDetalles.= "TasaOCuota=\"".$intPorcentajeIva."\" ";
						//--e. Importe
						$strCadena.= $intImporteIva."|";
						$strArchivoDetalles.= "Importe=\"".$intImporteIva."\" />";

						//--IEPS
						if ($intImporteIeps > 0)
						{
							$strArchivoDetalles.= "<cfdi:Traslado ";
							//--a. Base
							$strCadena.= $intImporteBase."|";
							$strArchivoDetalles.= "Base=\"".$intImporteBase."\" ";
							//--b. Impuesto
							$strCadena.= $arrDet->ImpuestoIeps."|";
							$strArchivoDetalles.= "Impuesto=\"".$arrDet->ImpuestoIeps."\" ";
							//--c. TipoFactor
							$strCadena.= $arrDet->FactorIeps."|";
							$strArchivoDetalles.= "TipoFactor=\"".$arrDet->FactorIeps."\" ";
							//--d. TasaOCuota
							$strCadena.= $intPorcentajeIeps."|";
							$strArchivoDetalles.= "TasaOCuota=\"".$intPorcentajeIeps."\" ";
							//--e. Importe
							$strCadena.= $intImporteIeps."|";
							$strArchivoDetalles.= "Importe=\"".$intImporteIeps."\" />";
						}
						$strArchivoDetalles.= "</cfdi:Traslados>";
						$strArchivoDetalles.= "</cfdi:Impuestos>";
						

					}//Cierre de verificación del tipo de referencia
					

					//--k. Impuesto Retencion
					//$strCadena.= $numTemp."|";//--a. Base
					//$strCadena.= $numTemp."|";//--b. Impuesto
					//$strCadena.= $numTemp."|";//--c. TipoFactor
					//$strCadena.= $numTemp."|";//--d. TasaOCuota
					//$strCadena.= $numTemp."|";//--e. Importe
					
					//--l. InformacionAduanera
					//Verificamos si el código de la refacción será acredor a un pedimento aduanal	
					//Solo aplica para facturas de Refacciones
					if($strTipoReferencia == 'FACTURA REFACCIONES')
					{
						//Códigos de refacciones con el primer pedimento Aduanal
						$arrCodigosPrimerPedimento = explode("|", CODIGOS_CON_PEDIMENTO_INFORMACION_ADUANERA);
						//Códigos de refacciones con el segundo pedimento Aduanal
						$arrCodigosSegundoPedimento = explode("|", CODIGOS_CON_PEDIMENTO_INFORMACION_ADUANERA_DOS);
						//Códigos de refacciones con el tercer pedimento Aduanal
						$arrCodigosTercerPedimento = explode("|", CODIGOS_CON_PEDIMENTO_INFORMACION_ADUANERA_TRES);

						//Si el código se encuentra en el primer pedimento Aduanal
						if (in_array($arrDet->Codigo, $arrCodigosPrimerPedimento)) 
						{
							//--a. NumeroPedimento
							$strCadena.= preg_replace('/\s\s+/', " ", NUMERO_PEDIMENTO_INFORMACION_ADUANERA)."|";
							$strArchivoDetalles.= "<cfdi:InformacionAduanera NumeroPedimento=\"".NUMERO_PEDIMENTO_INFORMACION_ADUANERA."\" />";
						}

						//Si el código se encuentra en el segundo pedimento Aduanal
						if (in_array($arrDet->Codigo, $arrCodigosSegundoPedimento)) 
						{
							//--a. NumeroPedimento
							$strCadena.= preg_replace('/\s\s+/', " ", NUMERO_PEDIMENTO_INFORMACION_ADUANERA_DOS)."|";
							$strArchivoDetalles.= "<cfdi:InformacionAduanera NumeroPedimento=\"".NUMERO_PEDIMENTO_INFORMACION_ADUANERA_DOS."\" />";
						}

						//Si el código se encuentra en el tercer pedimento Aduanal
						if (in_array($arrDet->Codigo, $arrCodigosTercerPedimento)) 
						{
							//--a. NumeroPedimento
							$strCadena.= preg_replace('/\s\s+/', " ", NUMERO_PEDIMENTO_INFORMACION_ADUANERA_TRES)."|";
							$strArchivoDetalles.= "<cfdi:InformacionAduanera NumeroPedimento=\"".NUMERO_PEDIMENTO_INFORMACION_ADUANERA_TRES."\" />";
						}
					}
					else
					{

						//Si existe número de pedimento
						if ($arrDet->Pedimento != "")
						{
							//--a. NumeroPedimento
							$strCadena.= preg_replace('/\s\s+/', " ", $arrDet->Pedimento)."|";
							$strArchivoDetalles.= "<cfdi:InformacionAduanera NumeroPedimento=\"".$arrDet->Pedimento."\" />";
						}

					}

					$strArchivoDetalles.= "</cfdi:Concepto>";
				}
			}//Cierre de verificación de detalles
			
			//------------------------------------------------------------------------------------------------------------------------
			//---------- INFORMACIÓN DEL NODO TRASLADO
			//------------------------------------------------------------------------------------------------------------------------
			//Si el tipo de referencia es diferente a PAGO
			if ($strTipoReferencia != "PAGO")
			{
				//---------- IVA
				for ($intConIVA = 0; $intConIVA < $numEleIVA; $intConIVA++)
				{
					$strCadena.= $arrIVA[$intConIVA][0]."|";//--a. Impuesto
					$strCadena.= $arrIVA[$intConIVA][1]."|";//--b. TipoFactor
					$strCadena.= $arrIVA[$intConIVA][2]."|";//--c. TasaOCuota
					$strCadena.= number_format($arrIVA[$intConIVA][3], 2, '.', '')."|";//--d. Importe
				}
				//---------- IEPS
				for ($intConIEPS = 0; $intConIEPS < $numEleIEPS; $intConIEPS++)
				{
					$strCadena.= $arrIEPS[$intConIEPS][0]."|";//--a. Impuesto
					$strCadena.= $arrIEPS[$intConIEPS][1]."|";//--b. TipoFactor
					$strCadena.= $arrIEPS[$intConIEPS][2]."|";//--c. TasaOCuota
					$strCadena.= number_format($arrIEPS[$intConIEPS][3], 2, '.', '')."|";//--d. Importe
				}
				//Calcular total de impuestos trasladados
				$intTotalImpuestosTraslados = number_format(($numIVA + $numIEPS), 2, '.', '');
				$strCadena.= $intTotalImpuestosTraslados."|";//--a. TotalImpuestosTrasladados
			}//Cierre de verificación del tipo de referencia

			//------------------------------------------------------------------------------------------------------------------------
			//----------------------------------------------------------------------------------------------------------- COMPLEMENTOS
			//------------------------------------------------------------------------------------------------------------------------
			$strComplemento = "";
			//Si el tipo de referencia corresponde a PAGO
			if($strTipoReferencia == "PAGO")
			{
			    //------------------------------------------------------------------------------------------------------------------------
	       		//---------- DETALLES Y DETALLES RELACIONADOS DEL PAGO
	        	//------------------------------------------------------------------------------------------------------------------------
				//Seleccionar los detalles del pago
	    		$otdDetallesPago = $this->$strModeloReferencia->buscar_detalles($intReferenciaID);

	    		//Verificar si existe información de los detalles 
				if ($otdDetallesPago) 
				{ 
					$strComplemento.="<cfdi:Complemento>";
					//--1. Versión
					$strCadena.= "1.0|";
					$strComplemento.="<pago10:Pagos Version=\"1.0\">";
					//Recorremos el arreglo 
					foreach ($otdDetallesPago as $arrDetP)
					{
						$strComplemento.="<pago10:Pago ";
						//Variable que se utiliza para asignar la fecha de pago del detalle
						$strFechaPago = substr($arrDetP->fecha_pago, 0, 10)."T".substr($arrDetP->fecha_pago, 11);
						//--a. FechaPago
						$strCadena.= $strFechaPago."|";
						$strComplemento.="FechaPago=\"".$strFechaPago."\" ";
						//--b. FormaDePagoP
						$strCadena.= $arrDetP->CodForPag."|";
						$strComplemento.="FormaDePagoP=\"".$arrDetP->CodForPag."\" ";
						//--c. MonedaP
						//Variable que se utiliza para asignar la moneda del pago
						$intMonedaIDDetallePago = $arrDetP->moneda_id;
						$strCadena.= $arrDetP->MonedaTipo."|";
						$strComplemento.="MonedaP=\"".$arrDetP->MonedaTipo."\" ";
						//--d. TipoCambioP
						//Variable que se utiliza para asignar el tipo de cambio del detalle
						$intTipoCambioP = number_format($arrDetP->tipo_cambio, 4, '.', '');
					    //Si el código de la moneda no corresponde al peso mexicano
						if ($arrDetP->MonedaTipo != CODIGO_MONEDA_BASE)
						{
							$strCadena.= $intTipoCambioP."|";
							$strComplemento.="TipoCambioP=\"".$intTipoCambioP."\" ";	
						}
						//--e. Monto
						//Convertir peso mexicano a tipo de cambio
					    $intMontoP = ($arrDetP->monto / $intTipoCambioP);
						//Variable que se utiliza para asignar el monto del detalle
						$intMontoP = number_format($intMontoP, 2, '.', '');
						$strCadena.= $intMontoP."|";
						$strComplemento.="Monto=\"".$intMontoP."\" ";
						//--f. NumOperacion
						if ($arrDetP->num_operacion != "")
						{
							$strCadena.= $arrDetP->num_operacion."|";
							$strComplemento.="NumOperacion=\"".$arrDetP->num_operacion."\" ";
						}
						//--g. RfcEmisorCtaOrd
						if ($arrDetP->rfc_emisor_cta_ord != "")
						{
							$strCadena.= $arrDetP->rfc_emisor_cta_ord."|";
							$strComplemento.="RfcEmisorCtaOrd=\"".$arrDetP->rfc_emisor_cta_ord."\" ";
						}
						//--h. NomBancoOrdExt
						if ($arrDetP->nom_banco_ord_ext != "")
						{
							$strCadena.= $arrDetP->nom_banco_ord_ext."|";
							$strComplemento.="NomBancoOrdExt=\"".$arrDetP->nom_banco_ord_ext."\" ";
						}
						//--i. CtaOrdenante
						if ($arrDetP->cta_ordenante != "")
						{
							$strCadena.= $arrDetP->cta_ordenante."|";
							$strComplemento.="CtaOrdenante=\"".$arrDetP->cta_ordenante."\" ";
						}
						//--j. RfcEmisorCtaBen
						if ($arrDetP->rfc_emisor_cta_ben != "")
						{
							$strCadena.= $arrDetP->rfc_emisor_cta_ben."|";
							$strComplemento.="RfcEmisorCtaBen=\"".$arrDetP->rfc_emisor_cta_ben."\" ";
						}
						//--k. CtaBeneficiario
						if ($arrDetP->cta_beneficiario != "")
						{
							$strCadena.= $arrDetP->cta_beneficiario."|";
							$strComplemento.="CtaBeneficiario=\"".$arrDetP->cta_beneficiario."\" ";
						}
						//--l. TipoCadPago
						if ($arrDetP->CodCadPag != "")
						{
							$strCadena.= $arrDetP->CodCadPag."|";
							$strComplemento.="TipoCadPago=\"".$arrDetP->CodCadPag."\" ";
						}
						//--m. CertPago
						if ($arrDetP->cer_pago != "")
						{
							$strCadena.= $arrDetP->cer_pago."|";
							$strComplemento.="CertPago=\"".$arrDetP->cer_pago."\" ";
						}
						//--n. CadPago
						if ($arrDetP->cad_pago != "")
						{
							$strCadena.= $arrDetP->cad_pago."|";
							$strComplemento.="CadPago=\"".$arrDetP->cad_pago."\" ";
						}
						//--o. SelloPago
						if ($arrDetP->sello_pago != "")
						{
							$strCadena.= $arrDetP->sello_pago."|";
							$strComplemento.="SelloPago=\"".$arrDetP->sello_pago."\" ";
						}
						$strComplemento.= ">";
						//Seleccionar los detalles relacionados del pago
	    				$otdDetallesRelPago = $this->$strModeloReferencia->buscar_detalles_relacionados($intReferenciaID, $arrDetP->renglon);
	    				//Verificar si existe información de los detalles 
						if ($otdDetallesRelPago) 
						{ 
							//Recorremos el arreglo 
							foreach ($otdDetallesRelPago as $arrDetRP)
							{

								$strComplemento.="<pago10:DoctoRelacionado ";
								//--a. IdDocumento
								$strCadena.= $arrDetRP->uuid."|";
								$strComplemento.="IdDocumento=\"".$arrDetRP->uuid."\" ";
								//--b. Serie
								$strSerieTmp = substr($arrDetRP->folio, 0, strpos($arrDetRP->folio, "0"));
								$strCadena.= $strSerieTmp."|";
								$strComplemento.="Serie=\"".$strSerieTmp."\" ";
								//--c. Folio
								$numFolioTmp = substr($arrDetRP->folio, strpos($arrDetRP->folio, "0")) + 0;
								$strCadena.= $numFolioTmp."|";
								$strComplemento.="Folio=\"".$numFolioTmp."\" ";
								//--d. MonedaDR
								//Variable que se utiliza para asignar el id de la moneda del detalle relacionado
								$intMonedaIDRP = $arrDetRP->moneda_id;
								$strCadena.= $arrDetRP->moneda_tipo."|";
								$strComplemento.="MonedaDR=\"".$arrDetRP->moneda_tipo."\" ";
								//--e. TipoCambioDR
								//Variable que se utiliza para asignar el tipo de cambio del detalle relacionado
								$intTipoCambioRP = number_format($arrDetRP->tipo_cambio, 4, '.', '');
								//Convertir tipo de cambio (detalle relacionado) a flotante
								$intConvTipoCambioRP = (float)$intTipoCambioRP;

								//Variable que se utiliza para asignar el saldo anterior del detalle relacionado
								$intImpSaldoAntRP = $arrDetRP->imp_saldo_ant;
								//Variable que se utiliza para asignar el importe pagado del detalle relacionado
								$intImpPagadoRP = $arrDetRP->imp_pagado;
								//Variable que se utiliza para asignar el saldo insoluto del detalle relacionado
								$intImpSaldoInsolutoRP = $arrDetRP->imp_saldo_insoluto;

								//Convertir tipo de cambio (detalle del pago) a flotante
								$intTipoCambioDetallePago = (float)$intTipoCambioP;

								//Si el código de la moneda (detalle de pago) corresponde a peso mexicano
								if ($arrDetP->MonedaTipo == CODIGO_MONEDA_BASE)
								{
									//Si el código de la moneda (del detalle relacionado) no corresponde a peso mexicano
									if ($arrDetRP->moneda_tipo != CODIGO_MONEDA_BASE)
									{
										$strCadena.= $intTipoCambioRP."|";
										$strComplemento.="TipoCambioDR=\"".$intTipoCambioRP."\" ";
									}

								}
								else
								{

									//Si el código de la moneda (detalle relacionado) corresponde a peso mexicano
									if ($arrDetRP->moneda_tipo == CODIGO_MONEDA_BASE)
									{
										$strCadena.= $intTipoCambioRP."|";
										$strComplemento.="TipoCambioDR=\"".$intTipoCambioRP."\" ";
									}

								}

								//Si la moneda del pago es diferente a la moneda de la factura
								if($intMonedaIDDetallePago != $intMonedaIDRP)
								{
								    //Asignar el tipo de cambio de la factura
									$intTipoCambioDetallePago = $intConvTipoCambioRP;
								}

								//Convertir peso mexicano a tipo de cambio del pago
								$intImpSaldoAntRP = ($intImpSaldoAntRP / $intTipoCambioDetallePago);
							    $intImpPagadoRP = ($intImpPagadoRP / $intTipoCambioDetallePago);
							    $intImpSaldoInsolutoRP = ($intImpSaldoInsolutoRP / $intTipoCambioDetallePago);

								//--f. MetodoDePagoDR
								$strCadena.= $arrDetRP->metodo_pago."|";
								$strComplemento.="MetodoDePagoDR=\"".$arrDetRP->metodo_pago."\" ";
								//--g. NumParcialidad
								$strCadena.= $arrDetRP->num_parcialidad."|";
								$strComplemento.="NumParcialidad=\"".$arrDetRP->num_parcialidad."\" ";
								//--h. ImpSaldoAnt
								//Convertir cantidad a dos decimales
								$intImpSaldoAntRP = number_format($intImpSaldoAntRP, 2, '.', '');
								$strCadena.= $intImpSaldoAntRP."|";
								$strComplemento.="ImpSaldoAnt=\"".$intImpSaldoAntRP."\" ";
								//--i. ImpPagado
								//Convertir cantidad a dos decimales
								$intImpPagadoRP = number_format($intImpPagadoRP, 2, '.', '');
								$strCadena.= $intImpPagadoRP."|";
								$strComplemento.="ImpPagado=\"".$intImpPagadoRP."\" ";
								//--j. ImpSaldoInsoluto
								//Convertir cantidad a dos decimales
								$intImpSaldoInsolutoRP = number_format($intImpSaldoInsolutoRP, 2, '.', '');
								$strCadena.= $intImpSaldoInsolutoRP."|";
								$strComplemento.="ImpSaldoInsoluto=\"".$intImpSaldoInsolutoRP."\" />";
							}
						}//Cierre de verificación de detalles relacionados
						$strComplemento.="</pago10:Pago>";
					}
					$strComplemento.="</pago10:Pagos>";
					$strComplemento.="</cfdi:Complemento>";
				}//Cierre de verificación de detalles del pago
			}//Cierre de verificación del tipo de referencia
			//------------------------------------------------------------------------------------------------------------------------
			//---------- FIN DE LA CADENA ORIGINAL
			//------------------------------------------------------------------------------------------------------------------------
			$strCadena.= "|";
			$strCadena = utf8_encode($strCadena);
			//------------------------------------------------------------------------------------------------------------------------
			//---------- GENERACION DEL SELLO DIGITAL
			//------------------------------------------------------------------------------------------------------------------------
			$objLlavePrivada = openssl_get_privatekey(file_get_contents($rutaLlavePrivada));
			openssl_sign($strCadena, $strSelloDigital, $objLlavePrivada, OPENSSL_ALGO_SHA256);
			openssl_free_key($objLlavePrivada);
			$strSelloDigital = base64_encode($strSelloDigital);
			//------------------------------------------------------------------------------------------------------------------------
			//---------- LECTURA DEL CERTIFICADO
			//------------------------------------------------------------------------------------------------------------------------
			$arcCertificado = file($rutaCertificado);
			$strCertificado = "";
			$bolCarga = FALSE;
			for ($intCon = 0; $intCon < sizeof($arcCertificado); $intCon++)
			{
				if (strstr($arcCertificado[$intCon], "END CERTIFICATE"))
					$bolCarga = FALSE;
				if ($bolCarga)
					$strCertificado.=trim($arcCertificado[$intCon]);
				if (strstr($arcCertificado[$intCon], "BEGIN CERTIFICATE"))
					$bolCarga = TRUE;
			}
			//------------------------------------------------------------------------------------------------------------------------
			//-------------------------------------------------------------------------------------------------------------------- XML
			//------------------------------------------------------------------------------------------------------------------------
			//------------------------------------------------------------------------------------------------------------------------
			//---------- INFORMACIÓN DEL NODO COMPROBANTE
			//------------------------------------------------------------------------------------------------------------------------
			$strArchivo = "<cfdi:Comprobante ";
			$strArchivo.= "xmlns:cfdi=\"http://www.sat.gob.mx/cfd/3\" ";
			$strArchivo.= "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" ";
			//Si el tipo de referencia corresponde a PAGO
			if ($strTipoReferencia == "PAGO")
			{
				$strArchivo.= "xmlns:pago10=\"http://www.sat.gob.mx/Pagos\" ";
				$strArchivo.= "xsi:schemaLocation=\"http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd http://www.sat.gob.mx/Pagos http://www.sat.gob.mx/sitio_internet/cfd/Pagos/Pagos10.xsd\" ";
			}
			else
			{
				$strArchivo.= "xsi:schemaLocation=\"http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd\" ";
			}//Cierre de verificación del tipo de referencia
			$strArchivo.= "Version=\"3.3\" ";
			$strArchivo.= "Serie=\"".$strSerie."\" ";
			$strArchivo.= "Folio=\"".$numFolio."\" ";
			$strArchivo.= "Fecha=\"".$strFecha."\" ";
			$strArchivo.= "Sello=\"".$strSelloDigital."\" ";
			//Si existe forma de pago
			if ($otdMovimiento->FormaPago != "")
			{
				$strArchivo.= "FormaPago=\"".$otdMovimiento->FormaPago."\" ";
			}
			$strArchivo.= "NoCertificado=\"".$otdCertificado->folio."\" ";
			$strArchivo.= "Certificado=\"".$strCertificado."\" ";
			//Si existen codiciones de pago
			if ($otdMovimiento->CondicionesDePago != "")
			{
				$strArchivo.= "CondicionesDePago=\"".$this->validaParaXML($otdMovimiento->CondicionesDePago)."\" ";
			}
			//Si existe subtotal
			if ($numSubtotalDesc > 0)
			{
				$strArchivo.= "SubTotal=\"".$numSubtotalDesc."\" ";
			}
			else
			{
				$strArchivo.= "SubTotal=\"0\" ";
			}
			//Si existe importe del descuento
			if ($numDescuento > 0)
			{
				$strArchivo.= "Descuento=\"".$numDescuento."\" ";
			}
			$strArchivo.= "Moneda=\"".$otdMovimiento->MonedaTipo."\" ";
			//Si existe tipo de cambio
			if ($intTipoCambio > 0)
			{
				$strArchivo.= "TipoCambio=\"".$intTipoCambio."\" ";
			}
			//Si existe total a pagar
			if ($numTotal > 0)
			{
				$strArchivo.= "Total=\"".$numTotal."\" ";
			}
			else
			{
				$strArchivo.= "Total=\"0\" ";
			}
			$strArchivo.= "TipoDeComprobante=\"".$otdMovimiento->TipoDeComprobante."\" ";
			//Si existe método de pago
			if ($otdMovimiento->MetodoPago != "")
			{
				$strArchivo.= "MetodoPago=\"".$otdMovimiento->MetodoPago."\" ";
			}
			$strArchivo.= "LugarExpedicion=\"".$otdEmisor->codigo_postal."\" ";
			$strArchivo.= ">";
			//------------------------------------------------------------------------------------------------------------------------
			//---------- INFORMACIÓN DEL NODO CFDIRelacionados
			//------------------------------------------------------------------------------------------------------------------------
			//Si existe tipo de relación
			if ($otdMovimiento->TipoRelacion != "")
			{
				$strArchivo.= "<cfdi:CfdiRelacionados ";
				$strArchivo.= "TipoRelacion=\"".$otdMovimiento->TipoRelacion."\">";

	    		//Verificar si existe información de los CFDI relacionados 
				if ($otdCfdiRelacionados) 
				{ 
					//Recorremos el arreglo 
					foreach ($otdCfdiRelacionados as $arrCfdi)
					{
						$strArchivo.= "<cfdi:CfdiRelacionado UUID=\"".$arrCfdi->uuid."\" />";
					}
				}//Cierre de verificación de CFDI relacionados 
				$strArchivo.= "</cfdi:CfdiRelacionados>";
			}
			//------------------------------------------------------------------------------------------------------------------------
			//---------- INFORMACIÓN DEL NODO EMISOR
			//------------------------------------------------------------------------------------------------------------------------
			$strArchivo.= "<cfdi:Emisor ";
			$strArchivo.= "Rfc=\"".$this->validaParaXML($otdEmisor->rfc)."\" ";
			$strArchivo.= "Nombre=\"".$this->validaParaXML($otdEmisor->razon_social)."\" ";
			$strArchivo.= "RegimenFiscal=\"".$this->validaParaXML($otdEmisor->RegimenFiscal)."\" />";
			//------------------------------------------------------------------------------------------------------------------------
			//---------- INFORMACIÓN DEL NODO RECEPTOR
			//------------------------------------------------------------------------------------------------------------------------
			$strArchivo.= "<cfdi:Receptor ";
			$strArchivo.= "Rfc=\"".$this->validaParaXML($strRFC)."\" ";
			$strArchivo.= "Nombre=\"".$this->validaParaXML($otdMovimiento->razon_social)."\" ";
			$strArchivo.= "UsoCFDI=\"".$this->validaParaXML($otdMovimiento->UsoCFDI)."\" />";
			//------------------------------------------------------------------------------------------------------------------------
			//---------- INFORMACIÓN DEL NODO CONCEPTOS
			//------------------------------------------------------------------------------------------------------------------------
			$strArchivo.= "<cfdi:Conceptos>";
			$strArchivo.= $strArchivoDetalles;
			$strArchivo.= "</cfdi:Conceptos>";
			//------------------------------------------------------------------------------------------------------------------------
			//---------- INFORMACIÓN DEL NODO COMPLEMENTOS
			//------------------------------------------------------------------------------------------------------------------------
			$strArchivo.= $strComplemento;
			//------------------------------------------------------------------------------------------------------------------------
			//---------- INFORMACIÓN DEL NODO TRASLADO
			//------------------------------------------------------------------------------------------------------------------------
			//Si el tipo de referencia es diferente a PAGO
			if ($strTipoReferencia != "PAGO")
			{
				$strArchivo.= "<cfdi:Impuestos ";
				$strArchivo.= "TotalImpuestosTrasladados=\"".$intTotalImpuestosTraslados."\" >";
				$strArchivo.= "<cfdi:Traslados>";
				//---------- IVA
				for ($intConIVA = 0; $intConIVA < $numEleIVA; $intConIVA++)
				{
					$strArchivo.= "<cfdi:Traslado ";
					$strArchivo.= "Impuesto=\"".$arrIVA[$intConIVA][0]."\" ";
					$strArchivo.= "TipoFactor=\"".$arrIVA[$intConIVA][1]."\" ";
					$strArchivo.= "TasaOCuota=\"".$arrIVA[$intConIVA][2]."\" ";
					$strArchivo.= "Importe=\"".number_format($arrIVA[$intConIVA][3], 2, '.', '')."\" />";
				}
				//---------- IEPS
				for ($intConIEPS = 0; $intConIEPS < $numEleIEPS; $intConIEPS++)
				{
					$strArchivo.= "<cfdi:Traslado ";
					$strArchivo.= "Impuesto=\"".$arrIEPS[$intConIEPS][0]."\" ";
					$strArchivo.= "TipoFactor=\"".$arrIEPS[$intConIEPS][1]."\" ";
					$strArchivo.= "TasaOCuota=\"".$arrIEPS[$intConIEPS][2]."\" ";
					$strArchivo.= "Importe=\"".number_format($arrIEPS[$intConIEPS][3], 2, '.', '')."\" />";
				}
				$strArchivo.= "</cfdi:Traslados>";
				$strArchivo.= "</cfdi:Impuestos>";
			}//Cierre de verificación del tipo de referencia
			$strArchivo.= "</cfdi:Comprobante>";

		    //Archivo prueba con estructura XML
			/*$strNombreArchivoPrueba = $strRuta.'prueba_'.$otdMovimiento->folio.'.xml';
			$arcTemp = fopen($strNombreArchivoPrueba,"w+"); 
			fwrite($arcTemp, "\xEF\xBB\xBF");
			fwrite($arcTemp, $strArchivo);
			fclose($arcTemp);*/
			//------------------------------------------------------------------------------------------------------------------------
			//---------- CONEXION CON EL SERVICIO WEB
			//------------------------------------------------------------------------------------------------------------------------
			set_time_limit(0);

			try 
		    {
				$objClienteSOAP = new SoapClient(WS_URL_CFDI);
				//---------- AUTENTICACION CON EL SERVICIO WEB
				$objAutenticacion = new Autenticar();
				$objAutenticacion->usuario = WS_USUARIO;
				$objAutenticacion->contrasena = WS_CONTRASENA;
				$objRespuestaAutenticacion = $objClienteSOAP->Autenticar($objAutenticacion);
				//---------- ASIGNACION DE PARAMETROS
				$objTimbrar = new Timbrar();
				$objTimbrar->cfd = utf8_encode($strArchivo);
				$objTimbrar->token = $objRespuestaAutenticacion->return->token;
				//---------- TOMAMOS LA RESPUESTA
				$objRespuesta = $objClienteSOAP->Timbrar($objTimbrar);
				//---------- SI EL VALOR QUE REGRESA ES 0, SE LOGRO TIMBRAR EL XML
				if ($objRespuesta->return->codigo === "0")
				{
					//---------- GUARDAMOS EL ARCHIVO XML TIMBRADO
					$arcTemp = fopen($strNombreArchivo,"w");
					fwrite($arcTemp, "\xEF\xBB\xBF");
					fwrite($arcTemp, $objRespuesta->return->cfdi);
					fclose($arcTemp);
					//---------- LECTURA DEL XML TIMBRADO
					$arcXML = file_get_contents($strNombreArchivo);
					$strValor='<tfd:TimbreFiscalDigital.*?UUID.*?"(.*?)"';
					preg_match_all('/'.$strValor.'/is',$arcXML, $arrUUID);
					$strValor='<.*?FechaTimbrado.*?"(.*?)"';
					preg_match_all('/'.$strValor.'/is',$arcXML, $arrFechaTimbrado);
					$strValor='<.*?NoCertificadoSAT.*?"(.*?)"';
					preg_match_all('/'.$strValor.'/is',$arcXML, $arrCertificadoSAT);
					$strValor='<.*?SelloSAT.*?"(.*?)"';
					preg_match_all('/'.$strValor.'/is',$arcXML, $arrSelloSAT);
					$strValor='<.*?SelloCFD.*?"(.*?)"';
					preg_match_all('/'.$strValor.'/is',$arcXML, $arrSelloCFD);
					$strValor='<.*?RfcProvCertif.*?"(.*?)"';
					preg_match_all('/'.$strValor.'/is',$arcXML, $arrPACRFC);
					$strValor='<.*?Leyenda.*?"(.*?)"';
					preg_match_all('/'.$strValor.'/is',$arcXML, $arrLeyendaSAT);
					//Si no existe leyenda SAT
					if(isset($arrLeyendaSAT[0]) && isset($arrLeyendaSAT[0]))
					{
						$strLeyendaSAT = '';
					}
					else
					{
						$strLeyendaSAT = $arrLeyendaSAT[1][0];
					}

					//Crear un objeto vacio, stdClass es el objeto por default de PHP
					$objTimbrado = new stdClass();
					//Asignar valores al objeto
					$objTimbrado->intReferenciaID = $intReferenciaID;
					$objTimbrado->strCertificado = $otdCertificado->folio;
					$objTimbrado->strSello = $arrSelloCFD[1][0];
					$objTimbrado->strUuid =  $arrUUID[1][0];
					$objTimbrado->strFechaTimbrado = $arrFechaTimbrado[1][0];
					$objTimbrado->strCertificadoSat = $arrCertificadoSAT[1][0];
					$objTimbrado->strSelloSat = $arrSelloSAT[1][0];
					$objTimbrado->strLeyendaSat = $strLeyendaSAT;
					$objTimbrado->strRfcPac = $arrPACRFC[1][0];
					$objTimbrado->intUsuarioID = $this->session->userdata('usuario_id');

					//Modificar los datos de timbrado
		    		$bolResultado =  $this->$strModeloReferencia->modificar_timbrado($objTimbrado);
					//Si no se obtienen errores al ejecutar el proceso
					if($bolResultado)
					{
						//--------------------------------------------------------------------------------------------------------------------
						//---------- GENERAR CBB
						//--------------------------------------------------------------------------------------------------------------------
						if (strpos($numTotal, "."))
						{
							$strEntero = str_pad(substr($numTotal, 0, strpos($numTotal, ".")), 18, "0", STR_PAD_LEFT);
							$strDecimal = str_pad(substr($numTotal, (strpos($numTotal, ".") + 1)), 6, "0", STR_PAD_RIGHT);
						}
						else
						{
							$strEntero = str_pad($numTotal, 18, "0", STR_PAD_LEFT);
							$strDecimal = "000000";
						}
						$strCadenaCBB = "https://verificacfdi.facturaelectronica.sat.gob.mx/default.aspx?";
						$strCadenaCBB.= "id=".$arrUUID[1][0];
						$strCadenaCBB.= "&re=".$otdEmisor->rfc;
						$strCadenaCBB.= "&rr=".$strRFC;
						$strCadenaCBB.= "&tt=".$strEntero.".".$strDecimal;
						$strCadenaCBB.= "&fe=".substr($arrSelloCFD[1][0], -8);
						//Generar imagen bidireccional QR (QRCODE)
						QRcode::png($strCadenaCBB, $strRuta.$otdMovimiento->folio.".png", 'L', 4, 2);
					}
					else
					{
						//Asignar mensaje de error
				 		$this->ARR_DATOS['strErrorXML'] = "Ha ocurrido un error al actualizar la base de datos.";
				 		$this->ARR_DATOS['strTipoMensaje'] = 'error';
					}
				}
				else
				{
					//Asignar mensaje de error
				 	$this->ARR_DATOS['strErrorXML']= 'Ocurrió un error al timbrar el folio: '.$otdMovimiento->folio.'. '.
												 'Error: '.utf8_encode($objRespuesta->return->codigo.'-'.$objRespuesta->return->mensaje);
				 	$this->ARR_DATOS['strTipoMensaje'] = 'error_timbrado';
				}
			}
			catch (SoapFault $e) 
			{

				//Asignar mensaje de error
				$this->ARR_DATOS['strErrorXML']= 'Error en el Servicio Web: '.$e->faultstring;
				$this->ARR_DATOS['strTipoMensaje'] = 'error_timbrado';
			}

		}//Cierre de verificación del movimiento fiscal
	}

	
	//Método para generar un archivo PDF con los datos de timbrado
	public function get_pdf($intReferenciaID, $strTipoReferencia, $strTimbrar = NULL)
	{	
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strTipoReferencia = trim(urldecode($strTipoReferencia));
		//Variable que se utiliza para asignar el nombre de la carpeta correspondiente al tipo de referencia
		$strCarpetaReferencia = '';
		//Definir ubicación de la carpeta principal
   		$strCarpetaDestino = $this->archivo['strCarpetaPrincipal']; ;
   		//Variable que se utiliza para concatenar los folios de las facturas relacionadas de una nota
   		$strFoliosFrasNota = '';

	    //Asignar objeto con los datos de la referencia que se utilizan para la búsqueda del registro
		$otdReferencia =  $this->get_referencia($strTipoReferencia);
		//Asignar valores de la referencia
		$strModeloReferencia = $otdReferencia['modelo'];
		$strMetodoBusqueda = $otdReferencia['metodo_busqueda'];
		$strMetodoBusquedaDetalles = $otdReferencia['metodo_busqueda_detalles'];
		$strCarpetaReferencia = $otdReferencia['carpeta'];
		$strTitulo = $otdReferencia['titulo_reporte'];

		//Si el tipo de referencia corresponde a un pago
		if($strTipoReferencia == 'PAGO')
		{
			//Crea los titulos de la cabecera detalles relacionados del pago
			$arrCabeceraDetRelPago = array('UUID', 'FOLIO', 'MONEDA', 'TIPO CAMBIO', 
											utf8_decode('MÉTODO PAGO'), 'PARCIALIDAD', 
											'ANTERIOR', 'PAGADO', 'INSOLUTO');
			//Establece el ancho de las columnas de cabecera detalles relacionados del pago
			$arrAnchuraDetRelPago = array(48, 15, 14, 14, 18, 18, 18, 20, 20);
			//Establece la alineación de las celdas de la tabla detalles relacionados del pago
			$arrAlineacionDetRelPago = array('L', 'L', 'C',  'R', 'C', 'R', 'R', 'R', 'R');
		}


		//Concaternar ubicación de la carpeta destino
		$strCarpetaDestino .= './'.$strCarpetaReferencia.'/';
		$strNombreCarpeta = $strCarpetaDestino.$intReferenciaID; 
		$strRuta = $strNombreCarpeta.'/';
		//------------------------------------------------------------------------------------------------------------------------
		//---------- MOVIMIENTO FISCAL
		//------------------------------------------------------------------------------------------------------------------------
       	//Seleccionar datos del movimiento
	    $otdMovimiento = $this->$strModeloReferencia->$strMetodoBusqueda($intReferenciaID);
		//------------------------------------------------------------------------------------------------------------------------
		//---------- DETALLES DEL MOVIMIENTO FISCAL
		//------------------------------------------------------------------------------------------------------------------------
		//Seleccionar los detalles del movimiento
	    $otdDetalles = $this->$strModeloReferencia->$strMetodoBusquedaDetalles($intReferenciaID);
		//Asignar el nombre del archivo PDF
		$strNombreArchivo = $otdMovimiento->folio.'.pdf';
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical
		//No incluir membrete del reporte
		$pdf->strIncluirMembrete=  'NO';
		//Variable que se utiliza para asignar el acumulado del subtotal
		$intAcumSubtotal = 0;
		//Variable que se utiliza para asignar el acumulado del IVA
		$intAcumIva = 0;
		//Variable que se utiliza para asignar el acumulado del IEPS
		$intAcumIeps = 0;
		$arrIVA = Array();
		$numEleIVA = 0;
		$arrIEPS = Array();
		$numEleIEPS = 0;
		//Variable que se utiliza para asignar el acumulado del descuento
		$intAcumDescuento = 0;
		//Agregar la primer pagina
		$pdf->AddPage();
		//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
		$this->get_encabezado_archivo_pdf($pdf, 'FISCAL');

		//Verificar si hay información del registro
		if($otdMovimiento)
		{	
			//Hacer un llamado a la función para mostrar imagen del estatus (INACTIVO/TIMBRAR)
			$this->get_img_estatus_archivo_pdf($pdf, $otdMovimiento->estatus);

			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DEL MOVIMIENTO FISCAL
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, 42);
			$pdf->ClippedCell(92, 3, 'RECEPTOR', 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0); //establece el color de texto
			//RFC
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(15, 46);
			$pdf->ClippedCell(10, 3, 'RFC');
			//Nombre comercial
			$pdf->SetXY(15, 49);
			$pdf->ClippedCell(22, 03, 'NOMBRE');
			//Uso de CFDI
			$pdf->SetXY(15, 58);
			$pdf->ClippedCell(22, 3, 'USO DEL CFDI');
			//Información
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			//RFC
			$pdf->SetXY(25, 46);
			$pdf->ClippedCell(30, 3, $otdMovimiento->rfc);
			//Nombre comercial y razón social
			//Variable que se utiliza para concatenar los datos del cliente
			$strCliente = $otdMovimiento->CodigoProspecto.' '.$otdMovimiento->razon_social;
			$pdf->SetXY(15, 52);
			$pdf->MultiCell(92, 3, utf8_decode($strCliente));
			//Uso de CFDI
			$pdf->SetXY(15, 61);
			$pdf->MultiCell(92, 3, utf8_decode($otdMovimiento->uso_cfdi));
			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DATOS DE LA REFERENCIA
	        //------------------------------------------------------------------------------------------------------------------------
			//Encabezado
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(108, 42);
			$pdf->ClippedCell(92, 3, utf8_decode($strTitulo), 0, 0, 'C', TRUE);
			$pdf->SetTextColor(0);//establece el color de texto
			//UUID
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, 46);
			$pdf->ClippedCell(15, 3, 'UUID');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(135, 46);
			$pdf->ClippedCell(64, 3, $otdMovimiento->uuid);
			//Folio
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, 49);
			$pdf->ClippedCell(15, 3, 'FOLIO');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(135, 49);
			$pdf->ClippedCell(64, 3, $otdMovimiento->folio);
			//Asignar posición de la ordenada
			$intPosY = 49;
			//Fecha
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(160, $intPosY);
			$pdf->ClippedCell(15, 3, 'FECHA');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(175, $intPosY);
			$pdf->ClippedCell(29, 3, $otdMovimiento->fecha);
			//Si el tipo de referencia es diferente a PAGO
			if ($strTipoReferencia != "PAGO")
			{
				//Incrementar posición de la ordenada
				$intPosY+=3;
				//Moneda
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(108, $intPosY);
				$pdf->ClippedCell(15, 3, 'MONEDA');
				//Tipo de cambio
				$pdf->SetXY(160, $intPosY);
				$pdf->ClippedCell(25, 3, 'TIPO DE CAMBIO');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Información 
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Moneda
				$pdf->SetXY(135, $intPosY);
				$pdf->ClippedCell(29, 3, $otdMovimiento->MonedaTipo);
				//Tipo de cambio
				$pdf->SetXY(184, $intPosY);
				$pdf->ClippedCell(20, 3, '$'.number_format($otdMovimiento->tipo_cambio, 4, '.', ','));
			}//Cierre de verificación del tipo de referencia
			//Incrementar posición de la ordenada
			$intPosY+=3;
			//Tipo de comprobante
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(108, $intPosY);
			$pdf->ClippedCell(32, 3, 'TIPO DE COMPROBANTE');
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
			$pdf->SetXY(140, $intPosY);
			$pdf->ClippedCell(60, 3, utf8_decode($otdMovimiento->tipo_comprobante));
			//Si existen condiciones de pago
			if($otdMovimiento->CondicionesDePago != "")
			{
				//Incrementar posición de la ordenada
				$intPosY+=3;
				//Condiciones de pago
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(108, $intPosY);
				$pdf->ClippedCell(32, 3, 'CONDICIONES DE PAGO');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(140, $intPosY);
				$pdf->ClippedCell(60, 3, $otdMovimiento->CondicionesDePago);
			}
			//Incrementar posición de la ordenada
			$intPosY+=3;
			//Si existe forma de pago
			if($otdMovimiento->forma_pago != "")
			{
				//Forma de pago
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(108, $intPosY);
				$pdf->ClippedCell(32, 3, 'FORMA DE PAGO');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(140, $intPosY);
				$pdf->ClippedCell(60, 3, utf8_decode($otdMovimiento->forma_pago));
			}
			//Incrementar posición de la ordenada
			$intPosY+=3;
			//Si existe método de pago
			if($otdMovimiento->metodo_pago != "")
			{
				//Método de pago
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(108, $intPosY);
				$pdf->ClippedCell(32, 3, utf8_decode('MÉTODO DE PAGO'));
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(140, $intPosY);
				$pdf->ClippedCell(60, 3, utf8_decode($otdMovimiento->metodo_pago));
			}

			//Si el tipo de referencia es una nota de crédito o una nota de cargo
			if($strTipoReferencia == "NOTA CREDITO" OR $strTipoReferencia == "NOTA CARGO")
			{
				//Asignar la posición de las facturas de la nota
				$intPosYFrasNota = $pdf->GetY();
				//Incrementar posición de la ordenada
				$intPosY+=3;
			}
			
			//Variable que se utiliza para asignar el tipo de cambio
			$intTipoCambio = (float)$otdMovimiento->tipo_cambio;
			//Incrementar posición de la ordenada
			$intPosY+=6;
			//------------------------------------------------------------------------------------------------------------------------
	        //---------- DETALLES DE LA REFERENCIA
	        //------------------------------------------------------------------------------------------------------------------------	
			$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
			$pdf->SetXY(15, $intPosY);
			$pdf->ClippedCell(185, 3, 'CONCEPTOS', 0, 0, 'C', TRUE);
			//Asigna el tipo y tamaño de letra
			$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			//Incrementar posición de la ordenada
			$intPosY+=4;
			//Verificar si existe información de los detalles 
			if($otdDetalles)
			{
				//Tabla con los detalles del movimiento
				$pdf->SetXY(15, $intPosY);
				//Crea los titulos de la cabecera
				$arrCabecera = array('Cantidad', 'ClaveProdServ', 'ClaveUnidad', utf8_decode('Descripción'), 
									 'Unitario', 'Descuento', 'Importe');
				//Establece el ancho de las columnas de cabecera
				$arrAnchura = array(15, 25, 20, 50, 25, 25, 25);
				//Establece la alineación de las celdas de la tabla
				$arrAlineacion = array('R', 'L', 'L',  'L', 'R', 'R', 'R');
				//Anchura especificada para la impresion del renglon correspondiente a Impuestos Trasladados
				$arrAnchuraTrasladosAduana = array(30, 160);
				$arrAlineacionTrasladosAduana = array('L', 'L');
				//Recorre el array de títulos de encabezado para crearlos
				for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
				{
					//inserta los titulos de la cabecera
					$pdf->Cell($arrAnchura[$intCont], 3, $arrCabecera[$intCont], 1, 0, $arrAlineacion[$intCont], TRUE);
				}
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();
				$pdf->SetXY(15, $intPosY);
				//Establece el ancho de las columnas
				$pdf->SetWidths($arrAnchura);
				//Variable que se utiliza para asignar el tipo de cambio
				$intTipoCambio = (float)$otdMovimiento->tipo_cambio;
				//Recorremos el arreglo 
				foreach ($otdDetalles as $arrDet)
				{ 
					$pdf->SetX(15);
					//Variables que se utilizan para asignar valores del detalle
					$intCantidad = $arrDet->cantidad;
					$intPrecioUnitario = $arrDet->subtotal;
					$intDescuentoUnitario = $arrDet->descuento;
					$intIvaUnitario = $arrDet->iva;
					$intIepsUnitario = $arrDet->ieps;
					//Si el tipo de referencia es diferente a PAGO
					if ($strTipoReferencia != "PAGO")
					{
						//Convertir peso mexicano a tipo de cambio
						$intPrecioUnitario = ($intPrecioUnitario / $intTipoCambio);
						$intDescuentoUnitario = ($intDescuentoUnitario / $intTipoCambio);
						$intIvaUnitario = ($intIvaUnitario / $intTipoCambio);
						$intIepsUnitario = ($intIepsUnitario / $intTipoCambio);
					}//Cierre de verificación del tipo de referencia
					$intSubTotalUnitario = $intPrecioUnitario;
					//Variable que se utiliza para asignar el importe de IVA
					$intImporteIva = 0;
					//Variable que se utiliza para asignar el importe de IEPS
					$intImporteIeps = 0;
					//Si existe importe del descuento
					if($intDescuentoUnitario > 0)
					{
						$intPrecioUnitario = $intPrecioUnitario + $intDescuentoUnitario;
					}
					//Si existe importe de IVA unitario
					if($intIvaUnitario > 0)
					{
						//Calcular importe de IVA
					    $intImporteIva =  $intIvaUnitario * $intCantidad;
					}
					//Si existe importe de IEPS unitario
					if($intIepsUnitario > 0)
					{
						//Calcular importe de IEPS
					    $intImporteIeps =  $intIepsUnitario * $intCantidad;
					}
					//Calcular subtotal
					$intSubTotalUnitario = $intCantidad * $intSubTotalUnitario;
					//Convertir cantidad a dos decimales
					$intPrecioUnitario = number_format($intPrecioUnitario, 2, '.', '');
					$intDescuentoUnitario = number_format($intDescuentoUnitario, 2, '.', '');
					$intIvaUnitario = number_format($intIvaUnitario, 2, '.', '');
					$intIepsUnitario = number_format($intIepsUnitario, 2, '.', '');
					$intSubTotalUnitario = number_format($intSubTotalUnitario, 2, '.', '');
					$intImporteIva = number_format($intImporteIva, 2, '.', '');
					$intImporteIeps = number_format($intImporteIeps, 2, '.', '');
					//Convertir cantidad a seis decimales
					$intPorcentajeIva = number_format($arrDet->PorcentajeIva, 6, '.', '');
					$intPorcentajeIeps = number_format($arrDet->PorcentajeIeps, 6, '.', '');
					//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
					$pdf->Row(array(number_format($intCantidad,2), utf8_decode($arrDet->ClaveProdServ), 
									utf8_decode($arrDet->ClaveUnidad), utf8_decode($arrDet->concepto), 
								    $intPrecioUnitario, $intDescuentoUnitario, 
								    $intSubTotalUnitario), $arrAlineacion);

					//Si el tipo de referencia es una nota de crédito o una nota de cargo
					if ($strTipoReferencia == "NOTA CREDITO" OR $strTipoReferencia == "NOTA CARGO")
					{
						//Concatenar el folio de la factura (referencia)
						$strFoliosFrasNota .= $arrDet->folio_referencia.', ';

					}//Cierre de verificación del tipo de referencia

					//Incrementar acumulados
					$intAcumSubtotal += $intSubTotalUnitario;
					$intAcumIva += $intImporteIva;
					$intAcumIeps += $intImporteIeps;
					$intAcumDescuento += $intDescuentoUnitario;
					//Array que contiene el impuesto de IVA
					$bolEntroIVA = FALSE;
					for ($intConIVA = 0; $intConIVA < $numEleIVA; $intConIVA++)
					{
						if ($arrIVA[$intConIVA][2] == $intPorcentajeIva)
						{
							$arrIVA[$intConIVA][3] += $intImporteIva;
							$bolEntroIVA = TRUE;
							$intConIVA = $numEleIVA;
						}
					}
					if (!$bolEntroIVA)
					{
						$arrIVA[$numEleIVA][0] = $arrDet->ImpuestoIva.' IVA';
						$arrIVA[$numEleIVA][1] = $arrDet->FactorIva;
						$arrIVA[$numEleIVA][2] = $intPorcentajeIva;
						$arrIVA[$numEleIVA][3] = $intImporteIva;
						
						$numEleIVA++;
					}
					//Si existe importe de IEPS
					if ($intImporteIeps > 0)
					{
					    //Array que contiene el impuesto de IEPS
						$bolEntroIEPS = FALSE;
						for ($intConIEPS = 0; $intConIEPS < $numEleIEPS; $intConIEPS++)
						{
							if ($arrIEPS[$intConIEPS][2] == $intPorcentajeIeps)
							{
								$arrIEPS[$intConIEPS][3] += $intImporteIeps;
								$bolEntroIEPS = TRUE;
								$intConIEPS = $numEleIEPS;
							}
						}
						if (!$bolEntroIEPS)
						{
							$arrIEPS[$numEleIEPS][0] = $arrDet->ImpuestoIeps.' IEPS';
							$arrIEPS[$numEleIEPS][1] = $arrDet->FactorIeps;
							$arrIEPS[$numEleIEPS][2] = $intPorcentajeIeps;
							$arrIEPS[$numEleIEPS][3] = $intImporteIeps;
							$numEleIEPS++;
						}
					}
				}
				//Calcular importe total
				$intTotal = $intAcumSubtotal + $intAcumIva + $intAcumIeps;
				//Redondear importe total a dos decimales
				$intTotal = number_format($intTotal,2);
				$pdf->Ln(2); //Deja un salto de línea
				//Asignar la posición de los totales
				$intPosYTotales = $pdf->GetY();

				//Si el tipo de referencia es una nota de crédito o una nota de cargo
				if ($strTipoReferencia == "NOTA CREDITO" OR $strTipoReferencia == "NOTA CARGO")
				{
					//Incrementar posición de la ordenada
					$intPosYFrasNota+=3;

					//Quitar último elemento de la cadena (,)
					$strFoliosFrasNota = substr($strFoliosFrasNota, 0, -2);

					//Facturas de la nota
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetXY(108, $intPosYFrasNota);
					$pdf->ClippedCell(32, 3, 'FACTURA');
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetXY(140, $intPosYFrasNota);
					$pdf->ClippedCell(60, 3, $strFoliosFrasNota);

				}//Cierre de verificación del tipo de referencia


				//Reestablecer posición
				$pdf->SetXY(15, $intPosYTotales);

				$intConImpIEPS = 0;
				//------------------------------------------------------------------------------------------------------------------------
				//---------- INFORMACIÓN DE IMPUESTOS TRASLADOS
				//------------------------------------------------------------------------------------------------------------------------
				//Si el tipo de referencia es diferente a PAGO
				if ($strTipoReferencia != "PAGO")
				{
					//Variable que se utiliza para formar cadena de impuestos trasladados
					$strCadenaTraslado = 'Base:';
					//--a. Base
					$strCadenaTraslado.= number_format(($intAcumSubtotal), 2, '.', '')."|";
					//---------- IVA
					for ($intConIVA = 0; $intConIVA < $numEleIVA; $intConIVA++)
					{
						$strCadenaTraslado.= "Impuesto:";//--a. Impuesto
						$strCadenaTraslado.= $arrIVA[$intConIVA][0]."|";//--a. Impuesto
						$strCadenaTraslado.= "Tipo Factor:";//--b. TipoFactor
						$strCadenaTraslado.= $arrIVA[$intConIVA][1]."|";//--b. TipoFactor
						$strCadenaTraslado.= "Tasa o Cuota:";//--c. TasaOCuota
						$strCadenaTraslado.= $arrIVA[$intConIVA][2]."|";//--c. TasaOCuota
						$strCadenaTraslado.= "Importe:";//--d. Importe
						$strCadenaTraslado.= number_format($arrIVA[$intConIVA][3], 2, '.', '');//--d. Importe
					}

					//---------- IEPS
					for ($intConIEPS = 0; $intConIEPS < $numEleIEPS; $intConIEPS++)
					{
						$strCadenaTraslado.= "|";
						$strCadenaTraslado.= "Impuesto:";//--a. Impuesto
						$strCadenaTraslado.= $arrIEPS[$intConIEPS][0]."|";//--a. Impuesto
						$strCadenaTraslado.= "Tipo Factor:";//--b. TipoFactor
						$strCadenaTraslado.= $arrIEPS[$intConIEPS][1]."|";//--b. TipoFactor
						$strCadenaTraslado.= "Tasa o Cuota:";//--c. TasaOCuota
						$strCadenaTraslado.= $arrIEPS[$intConIEPS][2]."|";//--c. TasaOCuota
						$strCadenaTraslado.= "Importe:";//--d. Importe
						$strCadenaTraslado.= number_format($arrIEPS[$intConIEPS][3], 2, '.', '');//--d. Importe
						
					}

				
					//Asigna el tipo y tamaño de letra
					$pdf->SetX(15);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_PIE_PAGINA_PDF);
					//Establece el ancho de las columnas 
					$pdf->SetWidths($arrAnchuraTrasladosAduana);
					$pdf->Row(array('Impuestos Traslados:|Negrita', $strCadenaTraslado), $arrAlineacionTrasladosAduana);

					$pdf->Ln(7); //Deja un salto de línea
					$pdf->SetX(15);
				}//Cierre de verificación del tipo de referencia
				//Cantidad con letra
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->ClippedCell(60, 3, 'CANTIDAD CON LETRA');
				$pdf->Ln(); //Deja un salto de línea
				$pdf->SetX(15);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->MultiCell(185, 3, 'SON: (' .$AifLibNumber->toCurrency($intTotal, $otdMovimiento->MonedaTipo) . ')');
				//Cambiar color de relleno de la celda
				$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
				$pdf->SetX(15);
				$pdf->ClippedCell(185, 3, '', 0, 0, 'C', TRUE);
				$pdf->Ln(); //Deja un salto de línea
				//Observaciones
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(15);
				$pdf->ClippedCell(30, 3, 'OBSERVACIONES');
				//Subtotal
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'SUBTOTAL');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.number_format($intAcumSubtotal,2), 0, 0, 'R');
				$pdf->Ln(); //Deja un salto de línea
				$intPosY = $pdf->GetY();

				//Observaciones
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(15, $intPosY);
				$pdf->MultiCell(110, 3, utf8_decode($otdMovimiento->observaciones));

				//Si se cumple la sentencia
				if($pdf->GetY() <= $intPosY)
				{
					//Regresar a la posición 15
					$intPosY = 15;
				}

				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(135, $intPosY);
				//Si el tipo de referencia es diferente a PAGO
				if ($strTipoReferencia != "PAGO")
				{
					/*
					//DEPRECATED (COMENTADO UN PAR DE DIAS PARA CONOCER SI NO AFECTA A OTROS PROCESOS EL CAMBIO)
					//IVA
					$pdf->ClippedCell(30, 3, 'IVA');
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetX(175);
					$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIva,2), 0, 0, 'R');
					$pdf->Ln(); //Deja un salto de línea
					//IEPS
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetX(135);
					$pdf->ClippedCell(30, 3, 'IEPS');
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetX(175);
					$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIeps,2), 0, 0, 'R');
					$pdf->Ln(); //Deja un salto de línea
					*/

					//IVA
					if($otdDetalles[0]->PorcentajeIva != NULL)
					{
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->SetX(135);
						$pdf->ClippedCell(30, 3, $otdDetalles[0]->ImpuestoIva.' '.'IVA'.' '.'TASA'.' '.$otdDetalles[0]->PorcentajeIva);
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->SetX(175);
						$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIva,2), 0, 0, 'R');
						$pdf->Ln(); //Deja un salto de línea
					}

				
					//IEPS
					if($intAcumIeps > 0)
					{
						//Decrementar uno para obtener última tasa de IEPS
					 	$intIndiceIeps = $numEleIEPS - 1;
					   	//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->SetX(135);
						$pdf->ClippedCell(35, 3,$arrIEPS[$intIndiceIeps][0].' '.strtoupper($arrIEPS[$intIndiceIeps][1]).' '.$arrIEPS[$intIndiceIeps][2]);
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->SetX(175);
						$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIeps,2), 0, 0, 'R');
						$pdf->Ln(); //Deja un salto de línea
					
					}
				}
				else
				{
					//Descuento
					$pdf->ClippedCell(30, 3, 'DESCUENTO');
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetX(175);
					$pdf->ClippedCell(25, 3, '$'.number_format($intAcumDescuento,2), 0, 0, 'R');
					$pdf->Ln(); //Deja un salto de línea
				}//Cierre de verificación del tipo de referencia
				//Total
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(135);
				$pdf->ClippedCell(30, 3, 'TOTAL');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetX(175);
				$pdf->ClippedCell(25, 3, '$'.$intTotal, 0, 0, 'R');
				
				//------------------------------------------------------------------------------------------------------------------------
				//---------- INFORMACIÓN DE CFDIRelacionados
				//------------------------------------------------------------------------------------------------------------------------
				//Si existe tipo de relación
				if ($otdMovimiento->TipoRelacion != "")
				{
					$pdf->Ln(); //Deja un salto de línea
					//Seleccionar los CFDI relacionados del movimiento fiscal
	   			    $otdCfdiRelacionados = $this->cfdi->buscar($intReferenciaID, $strTipoReferencia);
	   				//Variable que se utiliza para formar cadena de CFDI relacionados
					$strCfdiRelacionados = '';
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetX(15);
					$pdf->ClippedCell(25, 3, utf8_decode('TIPO DE RELACIÓN'));
					$pdf->Ln(); //Deja un salto de línea
					$pdf->SetX(15);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->ClippedCell(110, 3, utf8_decode($otdMovimiento->tipo_relacion), 0, 0, 'L');
					$pdf->Ln(); //Deja un salto de línea
					$pdf->SetX(15);
		    		//Verificar si existe información de los CFDI relacionados 
					if ($otdCfdiRelacionados) 
					{ 
						//Recorremos el arreglo 
						foreach ($otdCfdiRelacionados as $arrCfdi)
						{

							$strCfdiRelacionados.= $arrCfdi->uuid."\n";
						}

					}//Cierre de verificación de CFDI relacionados 
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetX(15);
					$pdf->ClippedCell(30, 3, utf8_decode('CFDI RELACIONADOS'));
					$pdf->Ln(); //Deja un salto de línea
					$pdf->SetX(15);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->MultiCell(110, 3, $strCfdiRelacionados);
				}
				//Si el tipo de referencia corresponde a PAGO
				if($strTipoReferencia == "PAGO")
				{
					//------------------------------------------------------------------------------------------------------------------------
		       		//---------- DETALLES Y DETALLES RELACIONADOS DEL PAGO
		        	//------------------------------------------------------------------------------------------------------------------------
					//Seleccionar los detalles del pago
	    			$otdDetallesPago = $this->$strModeloReferencia->buscar_detalles($intReferenciaID);
	    			//Verificar si existe información de los detalles 
					if ($otdDetallesPago) 
					{
						$pdf->Ln(); //Deja un salto de línea
						//Asignar posición de la ordenada para dibujar línea 
						$intPosYL = $pdf->GetY();	
						//Recorremos el arreglo 
						foreach ($otdDetallesPago as $arrDetP)
						{
							//Dibuja una línea para separar la información de cada detalle
	    					$pdf->Line(15, $intPosYL , 200, $intPosYL );
	    					$pdf->Ln(); //Deja un salto de línea
	    					//Asignar posición de la ordenada
							$intPosY = $pdf->GetY();		
							//Asigna el tipo y tamaño de letra
							$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
							$pdf->SetTextColor(0); //establece el color de texto
							//Fecha de pago
							$pdf->SetXY(15, $intPosY);
							$pdf->ClippedCell(22, 3, 'FECHA DE PAGO');
							//Forma de pago
							$pdf->SetXY(108, $intPosY);
							$pdf->ClippedCell(22, 3, 'FORMA DE PAGO');
							//Información
							//Asigna el tipo y tamaño de letra
							$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
							//Fecha de pago
							$pdf->SetXY(53, $intPosY);
							//Variable que se utiliza para asignar la fecha de pago del detalle
							$strFechaPago = substr($arrDetP->fecha_pago, 0, 10)."T".substr($arrDetP->fecha_pago, 11);
							$pdf->ClippedCell(32, 3, $strFechaPago);
							//Forma de pago
							$pdf->SetXY(140, $intPosY);
							$pdf->ClippedCell(59, 3, utf8_decode($arrDetP->forma_pago));
							//Incrementar posición de la ordenada
							$intPosY+=3;
							//Variable que se utiliza para asignar la moneda del pago
							$intMonedaIDDetallePago = $arrDetP->moneda_id;
							//Asigna el tipo y tamaño de letra
							$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
							//Moneda de pago
							$pdf->SetXY(15, $intPosY);
							$pdf->ClippedCell(25, 3, 'MONEDA DE PAGO');
							//Tipo de cambio
							//Asignar tipo de cambio del detalle
							$intTipoCambioP = number_format($arrDetP->tipo_cambio, 4, '.', '');
							$pdf->SetXY(65, $intPosY);
							$pdf->ClippedCell(25, 3, 'TIPO DE CAMBIO');
							//Monto
							$pdf->SetXY(108, $intPosY);
							$pdf->ClippedCell(25, 3, 'MONTO');
							//Información
							//Asigna el tipo y tamaño de letra
							$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
							//Moneda de pago
							$pdf->SetXY(53, $intPosY);
							$pdf->ClippedCell(22, 3, $arrDetP->MonedaTipo);
							//Tipo de cambio
							$pdf->SetXY(88, $intPosY);
							$pdf->ClippedCell(25, 3, '$'.$intTipoCambioP);
							//Monto
							//Convertir peso mexicano a tipo de cambio
					   		$intMontoP = ($arrDetP->monto / $intTipoCambioP);
							$pdf->SetXY(140, $intPosY);
							$pdf->ClippedCell(59, 3, '$'.number_format($intMontoP, 2));
							//Si existe número de operación
							if ($arrDetP->num_operacion != "")
							{
								//Incrementar posición de la ordenada
								$intPosY+=3;
								//Asigna el tipo y tamaño de letra
								$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
								//Número de operación
								$pdf->SetXY(15, $intPosY);
								$pdf->ClippedCell(32, 3, utf8_decode('NÚMERO DE OPERACIÓN'));
								//Asigna el tipo y tamaño de letra
								$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
								$pdf->SetXY(53, $intPosY);
								$pdf->ClippedCell(146, 3, $arrDetP->num_operacion);
							}
							//Si existe RFC de la cuenta ordenante
							if ($arrDetP->rfc_emisor_cta_ord != "")
							{
								//Incrementar posición de la ordenada
								$intPosY+=3;
								//Asigna el tipo y tamaño de letra
								$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
								//RFC cuenta ordenante
								$pdf->SetXY(15, $intPosY);
								$pdf->ClippedCell(36, 3, 'RFC CUENTA ORDENANTE');
								//Asigna el tipo y tamaño de letra
								$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
								$pdf->SetXY(53, $intPosY);
								$pdf->ClippedCell(32, 3, $arrDetP->rfc_emisor_cta_ord);
							}
							//Si existe cuenta ordenante
							if ($arrDetP->cta_ordenante != "")
							{
								//Asigna el tipo y tamaño de letra
								$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
								//Cuenta ordenante
								$pdf->SetXY(108, $intPosY);
								$pdf->ClippedCell(32, 3, 'CUENTA ORDENANTE');
								//Asigna el tipo y tamaño de letra
								$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
								$pdf->SetXY(140, $intPosY);
								$pdf->ClippedCell(59, 3, $arrDetP->cta_ordenante);
							}
							//Si existe banco de la cuenta ordenante
							if ($arrDetP->nom_banco_ord_ext != "")
							{
								//Incrementar posición de la ordenada
								$intPosY+=3;
								//Asigna el tipo y tamaño de letra
								$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
								//Banco ordenante
								$pdf->SetXY(15, $intPosY);
								$pdf->ClippedCell(32, 3, 'BANCO ORDENANTE');
								//Asigna el tipo y tamaño de letra
								$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
								$pdf->SetXY(53, $intPosY);
								$pdf->ClippedCell(146, 3,utf8_decode($arrDetP->nom_banco_ord_ext));
							}
							//Si existe RFC de la cuenta beneficiario
							if ($arrDetP->rfc_emisor_cta_ben != "")
							{
								//Incrementar posición de la ordenada
								$intPosY+=3;
								//Asigna el tipo y tamaño de letra
								$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
								//RFC cuenta beneficiario
								$pdf->SetXY(15, $intPosY);
								$pdf->ClippedCell(36, 3, 'RFC CUENTA BENEFICIARIO');
								//Asigna el tipo y tamaño de letra
								$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
								$pdf->SetXY(53, $intPosY);
								$pdf->ClippedCell(32, 3, $arrDetP->rfc_emisor_cta_ben);
							}
							//Si existe cuenta beneficiario
							if ($arrDetP->cta_beneficiario != "")
							{
								//Asigna el tipo y tamaño de letra
								$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
								//Cuenta beneficiario
								$pdf->SetXY(108, $intPosY);
								$pdf->ClippedCell(32, 3, 'CUENTA BENEFICIARIO');
								//Asigna el tipo y tamaño de letra
								$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
								$pdf->SetXY(140, $intPosY);
								$pdf->ClippedCell(59, 3, $arrDetP->cta_beneficiario);
							}
							//Seleccionar los detalles relacionados del pago
	    					$otdDetallesRelPago = $this->$strModeloReferencia->buscar_detalles_relacionados($intReferenciaID, $arrDetP->renglon);
	    					//Verificar si existe información de los detalles relacionados
							if ($otdDetallesRelPago) 
							{  
							    $pdf->Ln(5);//Espacios de salto de línea
							    $pdf->SetX(15);
							    //Asigna el tipo y tamaño de letra
								$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
								//Detalles relacionados
								$pdf->ClippedCell(80, 3, 'DOCUMENTOS RELACIONADOS');
								$pdf->Ln();//Espacios de salto de línea
								 $pdf->SetX(15);
								//Asigna el tipo y tamaño de letra
								$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_PIE_PAGINA_PDF);
								//Recorre el array de títulos de encabezado para crearlos
								for ($intCont = 0; $intCont < count($arrCabeceraDetRelPago); $intCont++)
								{
									//inserta los titulos de la cabecera
									$pdf->Cell($arrAnchuraDetRelPago[$intCont], 3, $arrCabeceraDetRelPago[$intCont], 0, 0, $arrAlineacionDetRelPago[$intCont], FALSE);
								}
								$pdf->Ln(); //Deja un salto de línea
								$intPosY = $pdf->GetY();
								$pdf->SetXY(15, $intPosY);
								//Establece el ancho de las columnas
								$pdf->SetWidths($arrAnchuraDetRelPago);
								//Recorremos el arreglo 
								foreach ($otdDetallesRelPago as $arrDetRP)
								{
									$pdf->SetX(15);
									//Variable que se utiliza para asignar el id de la moneda del detalle relacionado
									$intMonedaIDRP = $arrDetRP->moneda_id;
									//Variable que se utiliza para asignar el tipo de cambio del detalle relacionado
									$intTipoCambioRP = number_format($arrDetRP->tipo_cambio, 4, '.', '');
									//Convertir tipo de cambio (detalle relacionado) a flotante
									$intConvTipoCambioRP = (float)$intTipoCambioRP;
									//Variable que se utiliza para asignar el saldo anterior del detalle relacionado
									$intImpSaldoAntRP = $arrDetRP->imp_saldo_ant;
									//Variable que se utiliza para asignar el importe pagado del detalle relacionado
									$intImpPagadoRP = $arrDetRP->imp_pagado;
									//Variable que se utiliza para asignar el saldo insoluto del detalle relacionado
									$intImpSaldoInsolutoRP = $arrDetRP->imp_saldo_insoluto;
									
									//Convertir tipo de cambio (detalle del pago) a flotante
									$intTipoCambioDetallePago = (float)$intTipoCambioP;

									//Si la moneda del pago es diferente a la moneda de la factura
									if($intMonedaIDDetallePago != $intMonedaIDRP)
									{
									    //Asignar el tipo de cambio de la factura
										$intTipoCambioDetallePago = $intConvTipoCambioRP;
									}

									
								    //Convertir peso mexicano a tipo de cambio del pago
									$intImpSaldoAntRP = ($intImpSaldoAntRP / $intTipoCambioDetallePago);
							    	$intImpPagadoRP = ($intImpPagadoRP / $intTipoCambioDetallePago);
							    	$intImpSaldoInsolutoRP = ($intImpSaldoInsolutoRP / $intTipoCambioDetallePago);

									//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
									$pdf->Row(array($arrDetRP->uuid, $arrDetRP->folio, $arrDetRP->moneda_tipo, 
													'$'.$arrDetRP->tipo_cambio, $arrDetRP->metodo_pago,
												    $arrDetRP->num_parcialidad, '$'.number_format($intImpSaldoAntRP,2), 
												    '$'.number_format($intImpPagadoRP,2),
												    '$'.number_format($intImpSaldoInsolutoRP,2)), 
												    $arrAlineacionDetRelPago, 'ClippedCell', 'SI');
								}
	    					}//Cierre de verificación de detalles relacionados
	    					//Asignar posición de la ordenada para dibujar línea
	    					$intPosYL = $pdf->GetY();	
						}
						//Dibuja una línea para separar la información de los detalles
	    				$pdf->Line(15, $intPosYL , 200, $intPosYL );	
	    			}//Cierre de verificación de detalles del pago
				}//Cierre de verificación del tipo de referencia
				//------------------------------------------------------------------------------------------------------------------------
	       		//---------- DATOS DE LA FACTURA ELECTRÓNICA
	        	//------------------------------------------------------------------------------------------------------------------------
				//Si el registro se encuentra timbrado
				if( $otdMovimiento->uuid != "")
				{
					//Asignar el nombre de la imagen
			        $strNombreImagen = $otdMovimiento->folio.'.png'; 
			        $strRutaImagenPng = $strRuta.$strNombreImagen;
					$pdf->Ln(15);//Espacios de salto de línea

					//Hacer un llamado a la función para saltar de hoja en caso de ser necesario
					$this->get_page_break_pdf($pdf, 27.5);

					$intPosY = $pdf->GetY();
					$pdf->SetXY(15, $intPosY);
					//Verificar si existe el archivo (de esta manera evitaremos errores)
				    if (file_exists($strRutaImagenPng))
					{
						//Imagen QRCODE
				        $pdf->Image($strRutaImagenPng, 15, $pdf->GetY(), 27.5, 27.5);
				    }
			        $pdf->SetY($pdf->GetY() + 2);
			        //Asigna el tipo y tamaño de letra
			       	$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			        //Certificado
			        $pdf->SetX(50);
			        $pdf->ClippedCell(30, 3, 'CERTIFICADO EMISOR');
			        //Rfc PAC
			        $pdf->SetX(135);
			        $pdf->ClippedCell(30, 3, 'RFC PAC');
			        //Información
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Certificado
					$pdf->SetX(80);
					$pdf->ClippedCell(50, 3, $otdMovimiento->certificado);
					//Rfc PAC
					$pdf->SetX(165);
					$pdf->ClippedCell(50, 3, $otdMovimiento->rfc_pac);
					$pdf->Ln(); //Deja un salto de línea
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Certificado
			        $pdf->SetX(50);
			        $pdf->ClippedCell(30, 3, 'CERTIFICADO SAT');
			        //Rfc PAC
			        $pdf->SetX(135);
			        $pdf->ClippedCell(30, 3, 'FECHA DE TIMBRADO');
			        //Información
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Certificado SAT
					$pdf->SetX(80);
					$pdf->ClippedCell(76, 3, $otdMovimiento->certificado_sat);
					//Fecha de timbrado
					$pdf->SetX(165);
					$pdf->ClippedCell(76, 3, $otdMovimiento->fecha_timbrado);
					$pdf->Ln(); //Deja un salto de línea
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Sello
			        $pdf->SetX(50);
			        $pdf->ClippedCell(50, 3, 'SELLO DIGITAL DEL EMISOR');
			        $pdf->Ln(); //Deja un salto de línea
			        $pdf->SetX(50);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->MultiCell(151, 3, utf8_decode($otdMovimiento->sello));
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					//Sello SAT
			        $pdf->SetX(50);
			        $pdf->ClippedCell(50, 3, 'SELLO DIGITAL DEL SAT');
			        $pdf->Ln(); //Deja un salto de línea
			        $pdf->SetX(50);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->MultiCell(151, 3, utf8_decode($otdMovimiento->sello_sat));
					$pdf->Ln(); //Deja un salto de línea
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetX(15);
					//Cadena original
			        $pdf->ClippedCell(100, 3, 'CADENA ORIGINAL DEL COMPLEMENTO DE CERTIFICACION DIGITAL DEL SAT');
			        $pdf->Ln(); //Deja un salto de línea
			        //Variable que se utiliza para formar cadena original complemento
			        $strCadenaOriginalComplemento = "||1.1"; //Versión
			        $strCadenaOriginalComplemento .= "|".$otdMovimiento->uuid; //UUID
			        $strFechaTimbrado = substr($otdMovimiento->fecha_timbrado, 0, 10)."T".substr($otdMovimiento->fecha_timbrado, 11);
			        $strCadenaOriginalComplemento .= "|".$strFechaTimbrado; //Fecha de timbrado
			        $strCadenaOriginalComplemento .= "|".$otdMovimiento->rfc_pac; //RFC del PAC
			        //Verificar existencia de leyenda SAT
			        if ($otdMovimiento->leyenda_sat != "")
			        {
			             $strCadenaOriginalComplemento .= "|".$otdMovimiento->leyenda_sat;
			        }
			        $strCadenaOriginalComplemento .= "|".$otdMovimiento->sello; //Sello del emisor
			        $strCadenaOriginalComplemento .= "|".$otdMovimiento->certificado_sat; //Certificado SAT
			        $strCadenaOriginalComplemento .= "||";
			        //Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetX(15);
					$pdf->MultiCell(185, 3, utf8_decode($strCadenaOriginalComplemento));
					$pdf->Ln(); //Deja un salto de línea
			        $pdf->SetX(15);
			       //Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
			        $pdf->ClippedCell(100, 3, 'ESTE DOCUMENTO ES UNA REPRESENTACION IMPRESA DE UN CFDI');
				}//Cierre de verificación del UUID
			}//Cierre de verificación de detalles
		}//Cierre de verificación de información
		//Si la opción es timbrar registro

		if($strTimbrar == 'SI')
		{	
			//Concatenar nombre del archivo
			$strRuta .= $strNombreArchivo; 
			$pdf->Output($strRuta, 'F');
			//Regresar ruta del archivo
            return $strRuta;
		}
		else
		{
			//Cambiar nombre del archivo
			$strNombreArchivo = $strTipoReferencia.'_'.$strNombreArchivo;
			//Ejecutar la salida del reporte
			$pdf->Output($strNombreArchivo,'I'); 
		}
	}



	//Método para generar un archivo PDF con los datos de timbrado el cual aplica solo a documentos de tipo FACTURA
	public function get_pdf_facturas($intReferenciaID, $strTipoReferencia, $strTimbrar = NULL)
	{
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strTipoReferencia = trim(urldecode($strTipoReferencia));
		//Definir ubicación de la carpeta principal
   		$strCarpetaDestino = $this->archivo['strCarpetaPrincipal']; 

   		//Asignar objeto con los datos de la referencia que se utilizan para la búsqueda del registro
		$otdReferencia =  $this->get_referencia($strTipoReferencia);
		//Asignar valores de la referencia
		$strModeloReferencia = $otdReferencia['modelo'];
		$strMetodoBusqueda = $otdReferencia['metodo_busqueda'];
		$strMetodoBusquedaDetalles = $otdReferencia['metodo_busqueda_detalles'];
		$strCarpetaReferencia = $otdReferencia['carpeta'];

		//Concaternar ubicación de la carpeta destino
		$strCarpetaDestino .= './'.$strCarpetaReferencia.'/';
		$strNombreCarpeta = $strCarpetaDestino.$intReferenciaID; 
		$strRuta = $strNombreCarpeta.'/';
		//------------------------------------------------------------------------------------------------------------------------
		//---------- MOVIMIENTO FISCAL
		//------------------------------------------------------------------------------------------------------------------------
       	//Seleccionar datos del movimiento
	    $otdMovimiento = $this->$strModeloReferencia->$strMetodoBusqueda($intReferenciaID);
		//------------------------------------------------------------------------------------------------------------------------
		//---------- DETALLES DEL MOVIMIENTO FISCAL
		//------------------------------------------------------------------------------------------------------------------------
		//Seleccionar los detalles del movimiento
	    $otdDetalles = $this->$strModeloReferencia->$strMetodoBusquedaDetalles($intReferenciaID);
		//Asignar el nombre del archivo PDF
		$strNombreArchivo = $otdMovimiento->folio.'.pdf';
		//Cargar el helper del reporte
		$this->load->helper('hlpfpdf');
		//Seleccionar los datos de la empresa que coincide con el id 
        $otdEmpresa = $this->empresas->buscar($this->session->userdata('empresa_id'));
        //Seleccionar los datos de la empresa que coincide con el id 
        $otdSucursal = $this->sucursales->buscar($this->session->userdata('sucursal_id'));
		//Se crea una instancia de la clase AifLibNumber
		$AifLibNumber = new AifLibNumber();
		//Se crea una instancia de la clase PDF
		$pdf = new PDF();//orientación vertical

		//Variable que se utiliza para asignar el número interior
		$strNumInteriorSucursal = (($otdSucursal->numero_interior !== NULL && 
					        	    empty($otdSucursal->numero_interior) === FALSE) ?
                                    ' INT. '.$otdSucursal->numero_interior : '');
		
		//Concatenar datos para el domicilio
    	$strDomicilioSucursal = $otdSucursal->calle . ' NO.'.$otdSucursal->numero_exterior.
    							$strNumInteriorSucursal.' COL. ' . $otdSucursal->colonia.' C.P. '.
    							$otdSucursal->codigo_postal.' '.$otdSucursal->localidad. ', '. 
    							$otdSucursal->municipio. ', '.$otdSucursal->estado_rep;


		//Arreglo que se utiliza para la impresión en el titulo de la factura. Todas las facturas tendran 4 copias correspondientes
		$arrTitulosFactura = ['FACTURA - ORIGINAL', 'FACTURA - COPIA CLIENTE', 
							   'FACTURA - COPIA INFORME'];
		//Hacer recorrido para agregar hojas					   
		for ($intNumHoja = 1; $intNumHoja <= 3; $intNumHoja++) 
		{ 
			
			//No incluir membrete del reporte
			$pdf->strIncluirMembrete=  'NO';
			//Variable que se utiliza para asignar el acumulado del subtotal
			$intAcumSubtotal = 0;
			//Variable que se utiliza para asignar el acumulado del IVA
			$intAcumIva = 0;
			//Variable que se utiliza para asignar el acumulado del IEPS
			$intAcumIeps = 0;
			$arrIVA = Array();
			$numEleIVA = 0;
			$arrIEPS = Array();
			$numEleIEPS = 0;
			//Variable que se utiliza para asignar el acumulado del descuento
			$intAcumDescuento = 0;
			//Agregar la primer pagina
			$pdf->AddPage();
			//Hacer un llamado a la función para agregar (escribir) encabezado en el archivo
			$this->get_encabezado_archivo_pdf($pdf, 'FISCAL');

			//Verificar si hay información del registro
			if($otdMovimiento)
			{	
				//Hacer un llamado a la función para mostrar imagen del estatus (INACTIVO/TIMBRAR)
				$this->get_img_estatus_archivo_pdf($pdf, $otdMovimiento->estatus);
				
				//------------------------------------------------------------------------------------------------------------------------
		        //---------- DATOS DEL MOVIMIENTO FISCAL
		        //------------------------------------------------------------------------------------------------------------------------
				//Encabezado
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->SetXY(15, 42);
				$pdf->ClippedCell(92, 3, 'RECEPTOR', 0, 0, 'C', TRUE);
				$pdf->SetTextColor(0); //establece el color de texto
				//RFC
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(15, 46);
				$pdf->ClippedCell(10, 3, 'RFC');
				//Nombre comercial
				$pdf->SetXY(15, 49);
				$pdf->ClippedCell(22, 03, 'NOMBRE');
				//Uso de CFDI
				$pdf->SetXY(15, 58);
				$pdf->ClippedCell(22, 3, 'USO DEL CFDI');
				//Información
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//RFC
				$pdf->SetXY(25, 46);
				$pdf->ClippedCell(30, 3, $otdMovimiento->rfc);
				//Nombre comercial y razón social
				//Variable que se utiliza para concatenar los datos del cliente
				$strCliente = $otdMovimiento->CodigoProspecto.' '.$otdMovimiento->razon_social;
				$pdf->SetXY(15, 52);
				$pdf->MultiCell(92, 3, utf8_decode($strCliente));
				//Uso de CFDI
				$pdf->SetXY(15, 61);
				$pdf->MultiCell(92, 3, utf8_decode($otdMovimiento->uso_cfdi));
				//------------------------------------------------------------------------------------------------------------------------
		        //---------- DATOS DE LA REFERENCIA
		        //------------------------------------------------------------------------------------------------------------------------
				//Encabezado
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->SetXY(108, 42);
				$pdf->ClippedCell(92, 3, utf8_decode( $arrTitulosFactura[$intNumHoja - 1] ), 0, 0, 'C', TRUE);
				$pdf->SetTextColor(0);//establece el color de texto
				//UUID
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(108, 46);
				$pdf->ClippedCell(15, 3, 'UUID');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(135, 46);
				$pdf->ClippedCell(64, 3, $otdMovimiento->uuid);
				//Folio
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(108, 49);
				$pdf->ClippedCell(15, 3, 'FOLIO');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(135, 49);
				$pdf->ClippedCell(64, 3, $otdMovimiento->folio);
				//Asignar posición de la ordenada
				$intPosY = 49;
				//Fecha
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(160, $intPosY);
				$pdf->ClippedCell(15, 3, 'FECHA');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(175, $intPosY);
				$pdf->ClippedCell(29, 3, $otdMovimiento->fecha);
				//Incrementar posición de la ordenada
				$intPosY+=3;
				//Moneda
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(108, $intPosY);
				$pdf->ClippedCell(15, 3, 'MONEDA');
				//Tipo de cambio
				$pdf->SetXY(160, $intPosY);
				$pdf->ClippedCell(25, 3, 'TIPO DE CAMBIO');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Información 
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Moneda
				$pdf->SetXY(135, $intPosY);
				$pdf->ClippedCell(29, 3, $otdMovimiento->MonedaTipo);
				//Tipo de cambio
				$pdf->SetXY(184, $intPosY);
				$pdf->ClippedCell(20, 3, '$'.number_format($otdMovimiento->tipo_cambio, 4, '.', ','));
				//Incrementar posición de la ordenada
				$intPosY+=3;
				//Tipo de comprobante
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(108, $intPosY);
				$pdf->ClippedCell(32, 3, 'TIPO DE COMPROBANTE');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(140, $intPosY);
				$pdf->ClippedCell(60, 3, utf8_decode($otdMovimiento->tipo_comprobante));
				//Incrementar posición de la ordenada
				$intPosY+=3;
				//Condiciones de pago
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(108, $intPosY);
				$pdf->ClippedCell(32, 3, 'CONDICIONES DE PAGO');
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
				$pdf->SetXY(140, $intPosY);
				$pdf->ClippedCell(60, 3, $otdMovimiento->CondicionesDePago);
				//Incrementar posición de la ordenada
				$intPosY+=3;
				//Si existe forma de pago
				if($otdMovimiento->forma_pago != "")
				{
					//Forma de pago
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetXY(108, $intPosY);
					$pdf->ClippedCell(32, 3, 'FORMA DE PAGO');
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetXY(140, $intPosY);
					$pdf->ClippedCell(60, 3, utf8_decode($otdMovimiento->forma_pago));
				}
				//Incrementar posición de la ordenada
				$intPosY+=3;
				//Si existe método de pago
				if($otdMovimiento->metodo_pago != "")
				{
					//Método de pago
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetXY(108, $intPosY);
					$pdf->ClippedCell(32, 3, utf8_decode('MÉTODO DE PAGO'));
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetXY(140, $intPosY);
					$pdf->ClippedCell(60, 3, utf8_decode($otdMovimiento->metodo_pago));
				}
				//Variable que se utiliza para asignar el tipo de cambio
				$intTipoCambio = (float)$otdMovimiento->tipo_cambio;
				//Incrementar posición de la ordenada
				$intPosY+=6;
				//------------------------------------------------------------------------------------------------------------------------
		        //---------- DETALLES DE LA REFERENCIA
		        //------------------------------------------------------------------------------------------------------------------------	
				$pdf->SetTextColor(COLOR_TEXTO); //establece el color de texto
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_SUBTITULO_PDF);
				$pdf->SetXY(15, $intPosY);
				$pdf->ClippedCell(185, 3, 'CONCEPTOS', 0, 0, 'C', TRUE);
				//Asigna el tipo y tamaño de letra
				$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				//Incrementar posición de la ordenada
				$intPosY+=4;
				//Verificar si existe información de los detalles 
				if($otdDetalles)
				{
					
					//Tabla con los detalles del movimiento
					$pdf->SetXY(15, $intPosY);
					//Crea los titulos de la cabecera
					$arrCabecera = array('Cantidad', 'ClaveProdServ', 'ClaveUnidad', utf8_decode('Descripción'), 
										 'Unitario', 'Descuento', 'Importe');
					//Establece el ancho de las columnas de cabecera
					$arrAnchura = array(15, 25, 25, 55, 20, 20, 25);
					//Establece la alineación de las celdas de la tabla
					$arrAlineacion = array('R', 'L', 'L', 'L', 'R', 'R', 'R');

					//Establece la alineación de las celdas de la tabla
					//Alineación exclusiva para facturas de refacciones, ya que este tipo de facturas necesitan de una columna adicional
					$arrAlineacionRefacciones = array('R', 'L', 'L', 'L', 'L', 'R', 'R', 'R');
					$arrAnchuraRefacciones = array(12, 20, 20, 18, 60, 20, 15, 20);
					$arrCabeceraRefacciones = array('Cantidad', 'ClaveProdServ', 'ClaveUnidad', utf8_decode('Localización'), utf8_decode('Descripción'), 'Unitario', 'Descuento', 'Importe');
					
					//Anchura especificada para la impresion del renglon correspondiente a Impuestos Trasladados
					$arrAnchuraTrasladosAduana = array(30, 160);
					$arrAlineacionTrasladosAduana = array('L', 'L');

					//Si el tipo de referencia es una factura de refacciones
					if($strTipoReferencia == 'FACTURA REFACCIONES')
					{
						//Recorre el array de títulos de encabezado para crearlos
						for ($intCont = 0; $intCont < count($arrCabeceraRefacciones); $intCont++)
						{
							//inserta los titulos de la cabecera
							$pdf->Cell($arrAnchuraRefacciones[$intCont], 3, $arrCabeceraRefacciones[$intCont], 1, 0, 
									   $arrAlineacionRefacciones[$intCont], TRUE);
						}
					}
					else
					{
						//Recorre el array de títulos de encabezado para crearlos
						for ($intCont = 0; $intCont < count($arrCabecera); $intCont++)
						{
							//inserta los titulos de la cabecera
							$pdf->Cell($arrAnchura[$intCont], 3, $arrCabecera[$intCont], 1, 0, 
									   $arrAlineacion[$intCont], TRUE);
						}
					}
					
					$pdf->Ln(); //Deja un salto de línea
					$intPosY = $pdf->GetY();
					$pdf->SetXY(15, $intPosY);
					//Variable que se utiliza para asignar el tipo de cambio
					$intTipoCambio = (float)$otdMovimiento->tipo_cambio;

					//Recorremos el arreglo 
					foreach ($otdDetalles as $arrDet)
					{ 
						
						$pdf->SetX(15);
						//Establece el ancho de las columnas
						$pdf->SetWidths($arrAnchura);
						//Variables que se utilizan para asignar valores del detalle
						$intCantidad = $arrDet->cantidad;
						$intPrecioUnitario = $arrDet->subtotal;
						$intDescuentoUnitario = $arrDet->descuento;
						$intIvaUnitario = $arrDet->iva;
						$intIepsUnitario = $arrDet->ieps;
						//Convertir peso mexicano a tipo de cambio
						$intPrecioUnitario = ($intPrecioUnitario / $intTipoCambio);
						$intDescuentoUnitario = ($intDescuentoUnitario / $intTipoCambio);
						$intIvaUnitario = ($intIvaUnitario / $intTipoCambio);
						$intIepsUnitario = ($intIepsUnitario / $intTipoCambio);
						$intSubTotalUnitario = $intPrecioUnitario;
						//Variable que se utiliza para asignar el importe de IVA
						$intImporteIva = 0;
						//Variable que se utiliza para asignar el importe de IEPS
						$intImporteIeps = 0;
						//Si existe importe del descuento
						if($intDescuentoUnitario > 0)
						{
							$intPrecioUnitario = $intPrecioUnitario + $intDescuentoUnitario;
						}
						//Si existe importe de IVA unitario
						if($intIvaUnitario > 0)
						{
							//Calcular importe de IVA
						    $intImporteIva =  $intIvaUnitario * $intCantidad;
						}
						//Si existe importe de IEPS unitario
						if($intIepsUnitario > 0)
						{
							//Calcular importe de IEPS
						    $intImporteIeps =  $intIepsUnitario * $intCantidad;
						}
						//Calcular subtotal
						$intSubTotalUnitario = $intCantidad * $intSubTotalUnitario;
						//Convertir cantidad a dos decimales
						$intPrecioUnitario = number_format($intPrecioUnitario, 2, '.', '');
						$intDescuentoUnitario = number_format($intDescuentoUnitario, 2, '.', '');
						$intIvaUnitario = number_format($intIvaUnitario, 2, '.', '');
						$intIepsUnitario = number_format($intIepsUnitario, 2, '.', '');
						$intSubTotalUnitario = number_format($intSubTotalUnitario, 2, '.', '');
						$intImporteIva = number_format($intImporteIva, 2, '.', '');
						$intImporteIeps = number_format($intImporteIeps, 2, '.', '');
						//Convertir cantidad a seis decimales
						$intPorcentajeIva = number_format($arrDet->PorcentajeIva, 6, '.', '');
						$intPorcentajeIeps = number_format($arrDet->PorcentajeIeps, 6, '.', '');
						
						//Solo si la FACTURA es de tipo MAQUINARIA. Se agregará a la celda CONCEPTO el Módelo, Serie y Motor que corresponan al registro
						if($strTipoReferencia == "FACTURA MAQUINARIA"){

							$strConceptoMaquinaria = $arrDet->concepto;

							if($otdMovimiento->modelo){
								$strConceptoMaquinaria .= "\n".'MODELO: '.$otdMovimiento->modelo;
							}
							
							//Es necesario verificar si la MAQUINARIA que desea imprimirse es de tipo SIMPLE ó COMPUESTA. Con base a la SERIE del movimiento
							//MAQUINARIA SIMPLE
							if($otdMovimiento->serie){
								
								$strConceptoMaquinaria .= "\n".'SERIE: '.$otdMovimiento->serie;
								
								if($otdMovimiento->motor){
									$strConceptoMaquinaria .= "\n".'MOTOR: '.$otdMovimiento->motor;
								}

							}
							else{

								//Es necesario buscar los componentes asociados a la MAQUINARIA
								//CODIGO - DESCRIPCIÓN - SERIE - MOTOR(opcional)
								$otdComponentes = $this->$strModeloReferencia->buscar_detalles($intReferenciaID);
								
								if($otdComponentes){

									$strConceptoMaquinaria .= "\n\n".'COMPONENTES: ';
									//Recorremos el arreglo de objetos
									foreach ($otdComponentes as $arrComponente)
									{
										$strConceptoMaquinaria.= "\n".'CÓDIGO: '.$arrComponente->componente_codigo.' SERIE: '.$arrComponente->componente_serie;
									}

								}

							}


							//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							$pdf->Row(array(number_format($intCantidad,2), 
											utf8_decode($arrDet->ClaveProdServ), 
											utf8_decode($arrDet->ClaveUnidad).' '.utf8_decode($arrDet->Unidad), 
											utf8_decode($strConceptoMaquinaria), 
											number_format($intPrecioUnitario, 2, '.', ','), 
											number_format($intDescuentoUnitario, 2, '.', ','), 
											number_format($intSubTotalUnitario, 2, '.', ',')), $arrAlineacion);

						}
						else if($strTipoReferencia == "FACTURA REFACCIONES"){

							$pdf->SetWidths($arrAnchuraRefacciones);

							//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							$pdf->Row(array(number_format($intCantidad,2), 
											utf8_decode($arrDet->ClaveProdServ), 
											utf8_decode($arrDet->ClaveUnidad).' '.utf8_decode($arrDet->Unidad),
											$arrDet->localizacion, 
											utf8_decode($arrDet->Codigo.' '.$arrDet->concepto), 
											number_format($intPrecioUnitario, 2, '.', ','), 
											number_format($intDescuentoUnitario, 2, '.', ','), 
											number_format($intSubTotalUnitario, 2, '.', ',')), $arrAlineacionRefacciones, 'ClippedCell');


						}
						else{

							//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							$pdf->Row(array(number_format($intCantidad,2), 
											utf8_decode($arrDet->ClaveProdServ), 
											utf8_decode($arrDet->ClaveUnidad).' '.utf8_decode($arrDet->Unidad), 
											utf8_decode($arrDet->concepto), 
											number_format($intPrecioUnitario, 2, '.', ','), 
											number_format($intDescuentoUnitario, 2, '.', ','), 
											number_format($intSubTotalUnitario, 2, '.', ',')), $arrAlineacion);
						}

						//Si existe importe de IVA
						//if ($intImporteIva > 0)
						//{
							$arrIVA[0] = $arrDet->ImpuestoIva;
							$arrIVA[1] = $arrDet->FactorIva;
							$arrIVA[2] = $intPorcentajeIva;
							$arrIVA[3] = $intImporteIva;
						//}
						
						//Si existe importe de IEPS
						if ($intImporteIeps > 0)
						{
							$arrIEPS[0] = $arrDet->ImpuestoIeps;
							$arrIEPS[1] = $arrDet->FactorIeps;
							$arrIEPS[2] = $intPorcentajeIeps;
							$arrIEPS[3] = $intImporteIeps;
						}

						//------------------------------------------------------------------------------------------------------------------------
						//---------- INFORMACIÓN DE IMPUESTOS TRASLADOS
						//------------------------------------------------------------------------------------------------------------------------
						//Variable que se utiliza para formar cadena de impuestos trasladados
						$strCadenaTraslado = 'Base:';
						//--a. Base
						$strCadenaTraslado.= number_format(($intSubTotalUnitario), 2, '.', '')."|";
						
						/*
						$strCadenaTraslado.= "Impuesto:";//--a. Impuesto
						$strCadenaTraslado.= $arrIVA[0]."|";//--a. Impuesto
						$strCadenaTraslado.= "Tipo Factor:";//--b. TipoFactor
						$strCadenaTraslado.= $arrIVA[1]."|";//--b. TipoFactor
						$strCadenaTraslado.= "Tasa o Cuota:";//--c. TasaOCuota
						$strCadenaTraslado.= $arrIVA[2]."|";//--c. TasaOCuota
						$strCadenaTraslado.= "Importe:";//--d. Importe
						$strCadenaTraslado.= $arrIVA[3];//--d. Importe
						*/
						
						//---------- IVA
						//if ($intImporteIva > 0)
						//{
							$strCadenaTraslado.= "Impuesto:";//--a. Impuesto
							$strCadenaTraslado.= $arrDet->ImpuestoIva.' IVA'."|";//--a. Impuesto
							$strCadenaTraslado.= "Tipo Factor:";//--b. TipoFactor
							$strCadenaTraslado.= $arrDet->FactorIva."|";//--b. TipoFactor
							$strCadenaTraslado.= "Tasa o Cuota:";//--c. TasaOCuota
							$strCadenaTraslado.= $intPorcentajeIva."|";//--c. TasaOCuota
							$strCadenaTraslado.= "Importe:";//--d. Importe
							$strCadenaTraslado.= $intImporteIva;//--d. Importe
						//}
						
						//---------- IEPS
						if ($intImporteIeps > 0)
						{
							$strCadenaTraslado.= "|";
							$strCadenaTraslado.= "Impuesto:";//--a. Impuesto
							$strCadenaTraslado.= $arrDet->ImpuestoIeps.' IEPS'."|";//--a. Impuesto
							$strCadenaTraslado.= "Tipo Factor:";//--b. TipoFactor
							$strCadenaTraslado.= $arrDet->FactorIeps."|";//--b. TipoFactor
							$strCadenaTraslado.= "Tasa o Cuota:";//--c. TasaOCuota
							$strCadenaTraslado.= $intPorcentajeIeps."|";//--c. TasaOCuota
							$strCadenaTraslado.= "Importe:";//--d. Importe
							$strCadenaTraslado.= $intImporteIeps;//--d. Importe
						}
						

						//Cantidad con letra
						//Asigna el tipo y tamaño de letra
						$pdf->SetX(15);
						//Establece el ancho de las columnas 
						$pdf->SetWidths($arrAnchuraTrasladosAduana);
						//Cambiar el volumen de la letra a Negrita
						$pdf->strTipoLetraTabla = 'Negrita';
						$pdf->Row(array('Impuestos Traslados:', $strCadenaTraslado), $arrAlineacionTrasladosAduana);

						//Verificamos si el código de la refacción será acredor a un pedimento aduanal
						//Solo aplica para facturas de Refacciones
						if($strTipoReferencia == 'FACTURA REFACCIONES')
						{
							//Códigos de refacciones con el primer pedimento Aduanal
							$arrCodigosPrimerPedimento = explode("|", CODIGOS_CON_PEDIMENTO_INFORMACION_ADUANERA);
							//Códigos de refacciones con el segundo pedimento Aduanal
						    $arrCodigosSegundoPedimento = explode("|", CODIGOS_CON_PEDIMENTO_INFORMACION_ADUANERA_DOS);
						    //Códigos de refacciones con el tercer pedimento Aduanal
						    $arrCodigosTercerPedimento = explode("|", CODIGOS_CON_PEDIMENTO_INFORMACION_ADUANERA_TRES);

							//Si el código se encuentra en el primer pedimento Aduanal
							if (in_array($arrDet->Codigo, $arrCodigosPrimerPedimento)) 
							{
							    //Asigna el tipo y tamaño de letra
								$pdf->SetX(15);
								//Establece el ancho de las columnas 
								$pdf->SetWidths($arrAnchuraTrasladosAduana);
								//Cambiar el volumen de la letra a Negrita
								$pdf->strTipoLetraTabla = 'Negrita';
								$pdf->Row(array(utf8_decode('Información Aduanera:'), NUMERO_PEDIMENTO_INFORMACION_ADUANERA), $arrAlineacionTrasladosAduana);
							}

							//Si el código se encuentra en el segundo pedimento Aduanal
							if (in_array($arrDet->Codigo, $arrCodigosSegundoPedimento)) 
							{
							    //Asigna el tipo y tamaño de letra
								$pdf->SetX(15);
								//Establece el ancho de las columnas 
								$pdf->SetWidths($arrAnchuraTrasladosAduana);
								//Cambiar el volumen de la letra a Negrita
								$pdf->strTipoLetraTabla = 'Negrita';
								$pdf->Row(array(utf8_decode('Información Aduanera:'), NUMERO_PEDIMENTO_INFORMACION_ADUANERA_DOS), $arrAlineacionTrasladosAduana);
							}

							//Si el código se encuentra en el tercer pedimento Aduanal
							if (in_array($arrDet->Codigo, $arrCodigosTercerPedimento)) 
							{
							    //Asigna el tipo y tamaño de letra
								$pdf->SetX(15);
								//Establece el ancho de las columnas 
								$pdf->SetWidths($arrAnchuraTrasladosAduana);
								//Cambiar el volumen de la letra a Negrita
								$pdf->strTipoLetraTabla = 'Negrita';
								$pdf->Row(array(utf8_decode('Información Aduanera:'), NUMERO_PEDIMENTO_INFORMACION_ADUANERA_TRES), $arrAlineacionTrasladosAduana);
							}

						}
						else
						{
							//Si existe número de pedimento
							if ($arrDet->Pedimento != "")
							{
							    //Asigna el tipo y tamaño de letra
								$pdf->SetX(15);
								//Establece el ancho de las columnas 
								$pdf->SetWidths($arrAnchuraTrasladosAduana);
								//Cambiar el volumen de la letra a Negrita
								$pdf->strTipoLetraTabla = 'Negrita';
								$pdf->Row(array(utf8_decode('Información Aduanera:'), $arrDet->Pedimento), $arrAlineacionTrasladosAduana);
							}

						}

						//Cambiar el volumen de la letra a Normal
						$pdf->strTipoLetraTabla = 'Normal';

						//Incrementar subtotal (sumar descuento unitario para evitar doble descuento)
						$intSubTotalUnitario += $intDescuentoUnitario;
						//Incrementar acumulados
						$intAcumSubtotal += $intSubTotalUnitario;
						$intAcumIva += $intImporteIva;
						$intAcumIeps += $intImporteIeps;
						$intAcumDescuento += $intDescuentoUnitario;
						$strCadenaTraslado = '';

					} //END FOR EACH 
					//Calcular importe total
					$intTotal = ($intAcumSubtotal - $intAcumDescuento) + $intAcumIva + $intAcumIeps;
					//Redondear importe total a dos decimales
					$intTotal = number_format($intTotal,2);
					$pdf->Ln(2); //Deja un salto de línea
					$pdf->SetX(15);
					//Cantidad con letra
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->ClippedCell(60, 3, 'CANTIDAD CON LETRA');
					$pdf->Ln(); //Deja un salto de línea
					$pdf->SetX(15);
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->MultiCell(185, 3, 'SON: (' .$AifLibNumber->toCurrency($intTotal, $otdMovimiento->MonedaTipo) . ')');
					//Cambiar color de relleno de la celda
					$pdf->SetFillColor(COLOR_FONDO_R, COLOR_FONDO_G, COLOR_FONDO_B);
					$pdf->SetX(15);
					$pdf->ClippedCell(185, 3, '', 0, 0, 'C', TRUE);
					$pdf->Ln(); //Deja un salto de línea
					//Observaciones
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetX(15);
					$pdf->ClippedCell(30, 3, 'NOTAS');
					//Subtotal
					$pdf->SetX(135);
					$pdf->ClippedCell(30, 3, 'SUBTOTAL');
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetX(175);
					$pdf->ClippedCell(25, 3, '$'.number_format($intAcumSubtotal,2), 0, 0, 'R');
					$pdf->Ln(); //Deja un salto de línea
					$intPosY = $pdf->GetY();
					//Notas
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetXY(15, $intPosY);
					$pdf->MultiCell(110, 3, utf8_decode($otdMovimiento->notas));

					//Si se cumple la sentencia
					if($pdf->GetY() <= $intPosY)
					{
						//Regresar a la posición 15
						$intPosY = 15;
					}

					//Descuento
					$pdf->SetXY(135, $intPosY);
					//$pdf->SetX(135);
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->ClippedCell(30, 3, 'DESCUENTO');
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetX(175);
					$pdf->ClippedCell(25, 3, '$'.number_format($intAcumDescuento,2), 0, 0, 'R');
					$pdf->Ln(); //Deja un salto de línea
					//$intPosY = $pdf->GetY();
					//IVA
					//if($intAcumIva > 0)
					//{
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->SetX(135);
						$pdf->ClippedCell(35, 3, $arrIVA[0].' '.'IVA'.' '.strtoupper($arrIVA[1]).' '.$arrIVA[2]);
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->SetX(175);
						$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIva,2), 0, 0, 'R');
						$pdf->Ln(); //Deja un salto de línea
					//}
					//IEPS
					if($intAcumIeps > 0)
					{
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->SetX(135);
						$pdf->ClippedCell(35, 3, $arrIEPS[0].' '.'IEPS'.' '.strtoupper($arrIEPS[1]).' '.$arrIEPS[2]);
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->SetX(175);
						$pdf->ClippedCell(25, 3, '$'.number_format($intAcumIeps,2), 0, 0, 'R');
						$pdf->Ln(); //Deja un salto de línea
					}

					//Total
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetX(135);
					$pdf->ClippedCell(30, 3, 'TOTAL');
					//Asigna el tipo y tamaño de letra
					$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
					$pdf->SetX(175);
					$pdf->ClippedCell(25, 3, '$'.$intTotal, 0, 0, 'R');
					

					//------------------------------------------------------------------------------------------------------------------------
					//---------- INFORMACIÓN DE CFDIRelacionados
					//------------------------------------------------------------------------------------------------------------------------
					//Si existe tipo de relación
					if ($otdMovimiento->TipoRelacion != "")
					{
						$pdf->Ln(); //Deja un salto de línea
						//Seleccionar los CFDI relacionados del movimiento fiscal
		   			    $otdCfdiRelacionados = $this->cfdi->buscar($intReferenciaID, $strTipoReferencia);
		   				//Variable que se utiliza para formar cadena de CFDI relacionados
						$strCfdiRelacionados = '';
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->SetX(15);
						$pdf->ClippedCell(25, 3, utf8_decode('TIPO DE RELACIÓN'));
						$pdf->Ln(); //Deja un salto de línea
						$pdf->SetX(15);
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->ClippedCell(110, 3, utf8_decode($otdMovimiento->tipo_relacion), 0, 0, 'L');
						$pdf->Ln(); //Deja un salto de línea
						$pdf->SetX(15);
			    		//Verificar si existe información de los CFDI relacionados 
						if ($otdCfdiRelacionados) 
						{ 
							//Recorremos el arreglo 
							foreach ($otdCfdiRelacionados as $arrCfdi)
							{
								$strCfdiRelacionados.= $arrCfdi->uuid." ";
							}
						}//Cierre de verificación de CFDI relacionados 
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->SetX(15);
						$pdf->ClippedCell(30, 3, utf8_decode('CFDI RELACIONADOS'));
						$pdf->Ln(); //Deja un salto de línea
						$pdf->SetX(15);
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->MultiCell(110, 3, $strCfdiRelacionados);
					}
					//------------------------------------------------------------------------------------------------------------------------
		       		//---------- DATOS DE LA FACTURA ELECTRÓNICA
		        	//------------------------------------------------------------------------------------------------------------------------
					//Si el registro se encuentra timbrado
					if( $otdMovimiento->uuid != "")
					{
						//Asignar el nombre de la imagen
				        $strNombreImagen = $otdMovimiento->folio.'.png'; 
				        $strRutaImagenPng = $strRuta.$strNombreImagen;
						$pdf->Ln(15);//Espacios de salto de línea

						//Hacer un llamado a la función para saltar de hoja en caso de ser necesario
						$this->get_page_break_pdf($pdf, 27.5);

						$intPosY = $pdf->GetY();
						$pdf->SetXY(15, $intPosY);
						//Verificar si existe el archivo (de esta manera evitaremos errores)
					    if (file_exists($strRutaImagenPng))
						{
							//Imagen QRCODE
				        	$pdf->Image($strRutaImagenPng, 15, $pdf->GetY(), 27.5, 27.5);
						}
						
				        $pdf->SetY($pdf->GetY() + 2);
				        //Asigna el tipo y tamaño de letra
				       	$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				        //Certificado
				        $pdf->SetX(50);
				        $pdf->ClippedCell(30, 3, 'CERTIFICADO EMISOR');
				        //Rfc PAC
				        $pdf->SetX(135);
				        $pdf->ClippedCell(30, 3, 'RFC PAC');
				        //Información
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
						//Certificado
						$pdf->SetX(80);
						$pdf->ClippedCell(50, 3, $otdMovimiento->certificado);
						//Rfc PAC
						$pdf->SetX(165);
						$pdf->ClippedCell(50, 3, $otdMovimiento->rfc_pac);
						$pdf->Ln(); //Deja un salto de línea
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						//Certificado
				        $pdf->SetX(50);
				        $pdf->ClippedCell(30, 3, 'CERTIFICADO SAT');
				        //Rfc PAC
				        $pdf->SetX(135);
				        $pdf->ClippedCell(30, 3, 'FECHA DE TIMBRADO');
				        //Información
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
						//Certificado SAT
						$pdf->SetX(80);
						$pdf->ClippedCell(76, 3, $otdMovimiento->certificado_sat);
						//Fecha de timbrado
						$pdf->SetX(165);
						$pdf->ClippedCell(76, 3, $otdMovimiento->fecha_timbrado);
						$pdf->Ln(); //Deja un salto de línea
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						//Sello
				        $pdf->SetX(50);
				        $pdf->ClippedCell(50, 3, 'SELLO DIGITAL DEL EMISOR');
				        $pdf->Ln(); //Deja un salto de línea
				        $pdf->SetX(50);
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->MultiCell(151, 3, utf8_decode($otdMovimiento->sello));
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						//Sello SAT
				        $pdf->SetX(50);
				        $pdf->ClippedCell(50, 3, 'SELLO DIGITAL DEL SAT');
				        $pdf->Ln(); //Deja un salto de línea
				        $pdf->SetX(50);
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->MultiCell(151, 3, utf8_decode($otdMovimiento->sello_sat));
						$pdf->Ln(); //Deja un salto de línea
						//Asigna el tipo y tamaño de letra
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->SetX(15);
						//Cadena original
				        $pdf->ClippedCell(100, 3, 'CADENA ORIGINAL DEL COMPLEMENTO DE CERTIFICACION DIGITAL DEL SAT');
				        $pdf->Ln(); //Deja un salto de línea
				        //Variable que se utiliza para formar cadena original complemento
				        $strCadenaOriginalComplemento = "||1.1"; //Versión
				        $strCadenaOriginalComplemento .= "|".$otdMovimiento->uuid; //UUID
				        $strFechaTimbrado = substr($otdMovimiento->fecha_timbrado, 0, 10)."T".substr($otdMovimiento->fecha_timbrado, 11);
				        $strCadenaOriginalComplemento .= "|".$strFechaTimbrado; //Fecha de timbrado
				        $strCadenaOriginalComplemento .= "|".$otdMovimiento->rfc_pac; //RFC del PAC
				        //Verificar existencia de leyenda SAT
				        if ($otdMovimiento->leyenda_sat != "")
				        {
				             $strCadenaOriginalComplemento .= "|".$otdMovimiento->leyenda_sat;
				        }
				        $strCadenaOriginalComplemento .= "|".$otdMovimiento->sello; //Sello del emisor
				        $strCadenaOriginalComplemento .= "|".$otdMovimiento->certificado_sat; //Certificado SAT
				        $strCadenaOriginalComplemento .= "||";
				        //Asigna el tipo y tamaño de letra
						$pdf->SetX(15);
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->MultiCell(185, 3, utf8_decode($strCadenaOriginalComplemento));
						$pdf->Ln(); //Deja un salto de línea
				        //Asigna el tipo y tamaño de letra
				        $pdf->SetX(15);
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NEGRITA, TAMANO_LETRA_TITULO_TABLA_PDF);
				        $pdf->ClippedCell(100, 3, 'ESTE DOCUMENTO ES UNA REPRESENTACION IMPRESA DE UN CFDI');
				        $pdf->Ln();
				        $pdf->Ln();
				        $pdf->SetX(15);
						$pdf->SetFont(TIPO_LETRA_PDF, LETRA_NORMAL, TAMANO_LETRA_TITULO_TABLA_PDF);
						$pdf->MultiCell(185, 3, utf8_decode('ESTA FACTURA CAUSARA UN INTERES MORATORIO DEL 3% MENSUAL SI NO ES LIQUIDADA EN SU VENCIMIENTO ASI COMO EL COBRO DEL 20% POR CHEQUE DEVUELTO DE ACUERDO AL ART. 193 DE LA LEY GENERAL DE TITULOS Y OPERACIONES DE CREDITO.'));
						$pdf->Ln(); //Deja un salto de línea

						//Area de PAGARÉ
						//Si la impresión es de la primera página y la factura emitida es a crédito
						if($intNumHoja == 1)
						{
							
							$pdf->Ln(5);
							$arrAlineacionPagare = array('C', 'C', 'C', 'C', 'C');
							$arrAnchuraPagare = array(38, 38, 38, 38, 38);
							$pdf->SetWidths($arrAnchuraPagare);

							//Se agrega la informacion al reporte... se utiliza utf8 para acentos y tildes
							$pdf->strTipoLetraTabla = 'Negrita';
							$pdf->Row(array(utf8_decode('PAGARÉ'), utf8_decode('LUGAR DE EXPEDICIÓN'), 'FECHA', 'BUENO POR', utf8_decode('PAGARÉ')), $arrAlineacionPagare);

							$pdf->strTipoLetraTabla = '';
							$pdf->Row(array('', $otdSucursal->codigo_postal, $otdMovimiento->fecha, '$'.$intTotal, $otdMovimiento->folio), $arrAlineacionPagare);

							$pdf->Ln(3);
							//Creación del formato del PAGARÉ
							$strFechaPagare = explode(" ", $otdMovimiento->fecha);

							$pdf->MultiCell(185, 3, utf8_decode('DEBO(EMOS) Y PAGARE(MOS) INCONDICIONALMENTE POR ESTE PAGARE A LA ORDEN DE '.$otdEmpresa->razon_social.' EN '.utf8_decode( strtoupper($strDomicilioSucursal) ).' O EN CUALQUIER OTRO LUGAR QUE SE ME(NOS) REQUIERA DE PAGO A ELECCION DEL ACREEDOR EL '.$strFechaPagare[0].' LA CANTIDAD DE '.'$'.$intTotal.'(**SON: ('.$AifLibNumber->toCurrency($intTotal, $otdMovimiento->MonedaTipo).')**) VALOR RECIBIDO A MI ENTERA SATISFACCION, DESDE LA FECHA DE VENCIMIENTO DE ESTE DOCUMENTO HASTA EL DIA DE SU LIQUIDACIÓN CAUSARA INTERESES MORATORIOS AL TIPO DE 3% MENSUAL PAGADERO EN ESTA CIUDAD JUNTAMENTE CON EL PRINCIPAL.'));

							$pdf->Ln(3);
							$arrAlineacionPagare2 = array('L', 'C');
							$arrAnchuraPagare2 = array(95, 95);
							$pdf->SetWidths($arrAnchuraPagare2);
							$pdf->strTipoLetraTabla = 'Negrita';
							$pdf->Row(array(utf8_decode('NOMBRE Y DATOS DEL DEUDOR'), utf8_decode('ACEPTO(AMOS)')), $arrAlineacionPagare2);
							$pdf->strTipoLetraTabla = '';
							$pdf->Row(array(utf8_decode($strCliente), ''), $arrAlineacionPagare2);
							$pdf->Row(array(utf8_decode($otdMovimiento->rfc), 'FIRMA(S) ________________________________________________________'), $arrAlineacionPagare2);
						}//Cierre del bloque para PAGARÉ	

		            	
					}//Cierre de verificación del UUID
				}//Cierre de verificación de detalles
			}//Cierre de verificación de información

		}

		
		//Si la opción es timbrar registro
		if($strTimbrar == 'SI')
		{	
			//Concatenar nombre del archivo
			$strRuta .= $strNombreArchivo; 
			$pdf->Output($strRuta, 'F');
			//Regresar ruta del archivo
            return $strRuta;
		}
		else
		{
			//Cambiar nombre del archivo
			$strNombreArchivo = $strTipoReferencia.'_'.$strNombreArchivo;
			//Ejecutar la salida del reporte
			$pdf->Output($strNombreArchivo,'I'); 
		}
	}

	//Método para descargar archivos de un registro
    public function descargar_archivos($intReferenciaID, $strTipoReferencia, $strFolio)
	{
		//Quitar espacios vacíos y decodificar cadena cifrada
		$strTipoReferencia = trim(urldecode($strTipoReferencia));
		//Definir ubicación de la carpeta principal
   		$strCarpetaDestino = $this->archivo['strCarpetaPrincipal']; 

   		//Asignar objeto con los datos de la referencia que se utilizan para la búsqueda del registro
		$otdReferencia =  $this->get_referencia($strTipoReferencia);
		//Asignar valores de la referencia
		$strCarpetaReferencia = $otdReferencia['carpeta'];
		$strNombreCarpetaZIP = $otdReferencia['carpeta_zip'];
		
		//Concaternar ubicación de la carpeta destino
		$strCarpetaDestino .= './'.$strCarpetaReferencia.'/';
		$strNombreCarpeta = $strCarpetaDestino.$intReferenciaID; 
		//Concaternar folio
		$strNombreCarpetaZIP .= $strFolio.'.zip';
		//Verificar si la carpeta es un directorio 
        if (is_dir($strNombreCarpeta))
        {
        	//Comprimir contenido del directorio
        	$this->zip->read_dir($strNombreCarpeta, FALSE);
        	//Descargar carpeta zip
			$this->zip->download($strNombreCarpetaZIP);
        }
	}

	//Método para enviar archivos al correo electrónico del cliente
	public function enviar_correo_electronico_cliente()
	{
		//Variables que se utilizan para recuperar los valores de la vista
		$intReferenciaID = $this->input->post('intReferenciaID');
		$strTipoReferencia = $this->input->post('strTipoReferencia');
		$strFolio = $this->input->post('strFolio');
		$strCorreoElectronico = $this->input->post('strCorreoElectronico');
		$strCopiaCorreoElectronico = $this->input->post('strCopiaCorreoElectronico');
		//Definir ubicación de la carpeta principal
   		$strCarpetaDestino = $this->archivo['strCarpetaPrincipal']; 
   		
   		//Asignar objeto con los datos de la referencia que se utilizan para la búsqueda del registro
		$otdReferencia =  $this->get_referencia($strTipoReferencia);
		//Asignar valores de la referencia
		$strCarpetaReferencia = $otdReferencia['carpeta'];
		$strTitulo = $otdReferencia['titulo_correo'];
		$strComentarios = $otdReferencia['comentarios_correo'];

		//Se utiliza utf8 para acentos y tildes
		$strTitulo = utf8_decode($strTitulo);
		//Concaternar ubicación de la carpeta destino
		$strCarpetaDestino .= './'.$strCarpetaReferencia.'/';
		$strNombreCarpeta = $strCarpetaDestino.$intReferenciaID.'/'; 
	 	//Asignar ruta del archivo XML
        $strRutaArchivoXml = $strNombreCarpeta.$strFolio.'.pdf';
        //Asignar ruta del archivo PDF
        $strRutaArchivoPdf = $strNombreCarpeta.$strFolio.'.xml';
	 	//Inicializar configuraciones para enviar email
		$this->email->initialize($this->ARR_CONFIG_EMAIL);
		//Correo que envía mensaje
		$this->email->from(CORREO_CONFIGURACION, TITULO_NAVEGADOR);
		//Correo al que se le envía mensaje
		$this->email->to($strCorreoElectronico);
		//Si existe correo electrónico al que se le enviara una copia
		if($strCopiaCorreoElectronico != '')
		{
			//Copia oculta
			$this->email->bcc($strCopiaCorreoElectronico);
		}
		//Asunto
		$this->email->subject($strTitulo);
		//Asignar los comentarios en el array para mostrarlos en la plantilla (email)
		$arrDatosEmail["strTitulo"] = $strTitulo;
		$arrDatosEmail["strComentarios"] = utf8_decode($strComentarios);
		//Cargar plantilla email
		$objMensaje = $this->load->view('pages/plantilla_email', $arrDatosEmail, TRUE);
		//Mensaje
		$this->email->message($objMensaje);
		//Adjuntar archivos
		$this->email->attach($strRutaArchivoXml);
		$this->email->attach($strRutaArchivoPdf);
		//Si no se obtienen errores al enviar el correo electrónico
		if($this->email->send())
		{
			//Enviar el mensaje de éxito al formulario
			$arrDatos = array('resultado' => TRUE,
						 	  'tipo_mensaje' => TIPO_MSJ_EXITO,
						      'mensaje' => 'El correo electrónico se envió correctamente.');
		}
		else
		{
			//Enviar el mensaje de error al formulario
			$arrDatos = array('resultado' => FALSE,
						      'tipo_mensaje' => TIPO_MSJ_ERROR,
				              'mensaje' => 'Ocurrió un error al enviar correo electrónico, vuelva a intentarlo.');
		}
		//Enviar datos a la vista del formulario
		$this->output->set_content_type('application/json')->set_output(json_encode($arrDatos));
	}


	//Función que se utiliza para regresar los datos de la referencia (modelo, método de búsqueda, etc.)
	public function get_referencia($strTipoReferencia, $strFolio = NULL)
	{
		//Array que se utiliza para enviar datos
		$arrDatos = array('modelo' => '', 
					      'metodo_busqueda' => '', 
					      'metodo_busqueda_detalles' => '',  
					      'carpeta' => '', 
					      'carpeta_zip' => '', 
					      'titulo_reporte' => '', 
					      'titulo_correo' => '',
					      'comentarios_correo' => '');

		
		//Variable que se utiliza para asignar el nombre de la carpeta correspondiente al tipo de referencia
		$strCarpetaReferencia = '';
		//Variable que se utiliza para asignar el nombre de la carpeta zip correspondiente al tipo de referencia
		$strNombreCarpetaZIP = '';
		//Variable que se utiliza para asignar el título del reporte PDF
		$strTituloReporte = '';
	    //Variable que se utiliza para asignar el título del correo electrónico
		$strTituloCorreo = '';
		//Variable que se utiliza para asignar los comentarios del correo electrónico
		$strComentariosCorreo = '';
		//Variable que se utiliza para asignar tipo de referencia
		$strModeloReferencia = '';
	    //Método que se utiliza para la obtener los datos del movimiento fiscal
	    $strMetodoBusqueda = 'buscar';
	    //Método que se utiliza para la obtener los datos del detalle del movimiento fiscal
	    $strMetodoBusquedaDetalles = 'buscar_detalles_xml';
	    
	    //Dependiendo del tipo de referencia seleccionar los datos del registro
	    switch ($strTipoReferencia) 
        {

		    case "ANTICIPO":
	    		$strModeloReferencia = 'anticipos';
	    		$strCarpetaReferencia = 'anticipos';
	    		$strNombreCarpetaZIP = 'ANT_';
	    		$strTituloReporte = 'ANTICIPO';
	    		$strTituloCorreo = 'Anticipo';
		        $strComentariosCorreo = 'Anticipo '.$strFolio;
		        break;
		    case "APLICACION ANTICIPO":
		        $strModeloReferencia = 'aplicacion';
		        $strCarpetaReferencia = 'aplicacion_anticipos';
		        $strNombreCarpetaZIP = 'AANT_';
		        $strTituloReporte = 'APLICACIÓN DE ANTICIPO';
		        $strTituloCorreo = 'Aplicación de anticipo';
		        $strComentariosCorreo = 'Aplicación de anticipo '.$strFolio;
		        break;
		    case "PAGO":
		        $strModeloReferencia = 'pagos';
		        $strCarpetaReferencia = 'pagos';
		        $strNombreCarpetaZIP = 'PAGO_';
		        $strTituloReporte = 'PAGO';
		        $strTituloCorreo = 'Pago';
		        $strComentariosCorreo = 'Pago '.$strFolio;
		        break;
		    case "FACTURA SERVICIO":
		        $strModeloReferencia = 'facturas_servicio';
		        $strCarpetaReferencia = 'facturas_servicio';
		        $strNombreCarpetaZIP = 'FACT_SERV_';
		        $strTituloCorreo = 'Factura de servicio';
		        $strComentariosCorreo = 'Factura de servicio '.$strFolio;
		        break;
		    case "FACTURA REFACCIONES":
		    	$strModeloReferencia = 'facturas_refacciones';
		        $strCarpetaReferencia = 'facturas_refacciones';
		        $strNombreCarpetaZIP = 'FACT_REF_';
		        $strTituloCorreo = 'Factura de refacciones';
		        $strComentariosCorreo = 'Factura de refacciones '.$strFolio;
		    	break;
		    case "FACTURA MAQUINARIA":
		    	$strModeloReferencia = 'facturas_maquinaria';
		        $strCarpetaReferencia = 'facturas_maquinaria';
		        $strNombreCarpetaZIP = 'FACT_MAQ_';
		        $strTituloCorreo = 'Factura de maquinaria';
		        $strComentariosCorreo = 'Factura de maquinaria '.$strFolio;
		    	break; 	 
		   	case "FACTURA CONCEPTOS":
		    	$strModeloReferencia = 'facturas_conceptos';
		        $strCarpetaReferencia = 'facturas_conceptos';
		        $strNombreCarpetaZIP = 'FACT_CONCEPTOS_';
		        $strTituloCorreo = 'Factura de conceptos';
		        $strComentariosCorreo = 'Factura de conceptos '.$strFolio;
		    	break; 	 
		    case "DEVOLUCION REFACCIONES":
		    	$strModeloReferencia = 'movimientos_refacciones';
		        $strMetodoBusqueda = 'buscar_entrada_devolucion_factura';
		        $strMetodoBusquedaDetalles = 'buscar_detalles_xml_devolucion_factura';
		        $strCarpetaReferencia = 'movimientos_entradas_refacciones_dev_facturas';
		        $strNombreCarpetaZIP = 'DEV_REF_';
		        $strTituloReporte = 'DEVOLUCIÓN DE REFACCIONES';
		        $strTituloCorreo = 'Devolución de refacciones';
		        $strComentariosCorreo = 'Devolución de refacciones '.$strFolio;
		    	break;
		    case "DEVOLUCION MAQUINARIA":
		    	$strModeloReferencia = 'entradas_maquinaria_devolucion';
		        $strMetodoBusqueda = 'buscar_entrada_devolucion_factura';
		        $strMetodoBusquedaDetalles = 'buscar_detalles_xml_devolucion_factura';
		        $strCarpetaReferencia = 'entradas_maquinaria_devolucion_dev_facturas';
		        $strNombreCarpetaZIP = 'DEV_MAQ_';
		        $strTituloReporte = 'DEVOLUCIÓN DE MAQUINARIA';
		        $strTituloCorreo = 'Devolución de maquinaria';
		        $strComentariosCorreo = 'Devolución de maquinaria '.$strFolio;
		    	break;
		    case "DEVOLUCION SERVICIO":
		    	$strModeloReferencia = 'notas_credito_servicio';
		        $strCarpetaReferencia = 'notas_credito_servicio';
		        $strNombreCarpetaZIP = 'DEV_SERV_';
		        $strTituloReporte = 'DEVOLUCIÓN DE SERVICIO';
		        $strTituloCorreo = 'Devolución de servicio';
		        $strComentariosCorreo = 'Devolución de servicio '.$strFolio;
		    	break;
		    case "NOTA CREDITO":
		    	$strModeloReferencia = 'notas_credito_digitales';
		        $strCarpetaReferencia = 'notas_credito_digitales';
		        $strNombreCarpetaZIP = 'NOT_CRE_';
		        $strTituloReporte = 'NOTA DE CRÉDITO';
		        $strTituloCorreo = 'Nota de crédito digital';
		        $strComentariosCorreo = 'Nota de crédido digital '.$strFolio;
		    	break;
		    case "NOTA CARGO":
		    	$strModeloReferencia = 'notas_cargo_digitales';
		        $strCarpetaReferencia = 'notas_cargo_digitales';
		        $strNombreCarpetaZIP = 'NOT_CAR_';
		        $strTituloReporte = 'NOTA DE CARGO';
		        $strTituloCorreo = 'Nota de cargo digital';
		        $strComentariosCorreo = 'Nota de cargo digital '.$strFolio;
		    	break;		
		}

		//Agregar datos al array
		$arrDatos['modelo'] = $strModeloReferencia;
		$arrDatos['metodo_busqueda'] = $strMetodoBusqueda;
		$arrDatos['metodo_busqueda_detalles'] = $strMetodoBusquedaDetalles;
		$arrDatos['carpeta'] = $strCarpetaReferencia;
		$arrDatos['carpeta_zip'] = $strNombreCarpetaZIP;
		$arrDatos['titulo_reporte'] = $strTituloReporte;
		$arrDatos['titulo_correo'] = $strTituloCorreo;
		$arrDatos['comentarios_correo'] = $strComentariosCorreo;
		
		//Regresar array con los datos de la referencia
		return $arrDatos;
	}
}


//------------------------------------------------------------------------------------------------------------------------
//---------- CLASES
//------------------------------------------------------------------------------------------------------------------------
class Autenticar
{
	public $usuario;
	public $contrasena;
}
class Timbrar
{
	public $cfd;
	public $token;
}