<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');

class Anticipos_no_fiscales_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla anticipos_no_fiscales
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objAnticipoNoFiscal)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objAnticipoNoFiscal->strFolio); 


		//Tabla anticipos_no_fiscales
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objAnticipoNoFiscal->intSucursalID, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objAnticipoNoFiscal->dteFecha,  
						  'moneda_id' => $objAnticipoNoFiscal->intMonedaID, 
						  'tipo_cambio' => $objAnticipoNoFiscal->intTipoCambio,
						  'prospecto_id' => $objAnticipoNoFiscal->intProspectoID,
						  'razon_social' => $objAnticipoNoFiscal->strRazonSocial, 
						  'rfc' => $objAnticipoNoFiscal->strRfc, 
						  'calle' => $objAnticipoNoFiscal->strCalle,
						  'numero_exterior' => $objAnticipoNoFiscal->strNumeroExterior,
						  'numero_interior' => $objAnticipoNoFiscal->strNumeroInterior,
						  'codigo_postal' => $objAnticipoNoFiscal->strCodigoPostal,
						  'colonia' => $objAnticipoNoFiscal->strColonia,
						  'localidad' => $objAnticipoNoFiscal->strLocalidad,
						  'municipio' => $objAnticipoNoFiscal->strMunicipio,
						  'estado' => $objAnticipoNoFiscal->strEstado,
						  'pais' => $objAnticipoNoFiscal->strPais,
						  'modulo_id' => $objAnticipoNoFiscal->intModuloID,
						  'concepto' => $objAnticipoNoFiscal->strConcepto,
						  'subtotal' => $objAnticipoNoFiscal->intSubtotal,
						  'tasa_cuota_iva' => $objAnticipoNoFiscal->intTasaCuotaIva,
						  'iva' => $objAnticipoNoFiscal->intIva,
						  'tasa_cuota_ieps' => $objAnticipoNoFiscal->intTasaCuotaIeps,
						  'ieps' => $objAnticipoNoFiscal->intIeps,
						  'forma_pago_id' => $objAnticipoNoFiscal->intFormaPagoID,
						  'cuenta_bancaria_id' => $objAnticipoNoFiscal->intCuentaBancariaID,
						  'observaciones' => $objAnticipoNoFiscal->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objAnticipoNoFiscal->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('anticipos_no_fiscales', $arrDatos);
	    //Asignar id del nuevo registro en la base de datos
		$intAnticipoNoFiscalID  = $this->db->insert_id();

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intAnticipoNoFiscalID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objAnticipoNoFiscal)
	{

		//Asignar datos al array
		$arrDatos = array('fecha' => $objAnticipoNoFiscal->dteFecha,  
						  'moneda_id' => $objAnticipoNoFiscal->intMonedaID, 
						  'tipo_cambio' => $objAnticipoNoFiscal->intTipoCambio,
						  'prospecto_id' => $objAnticipoNoFiscal->intProspectoID,
						  'razon_social' => $objAnticipoNoFiscal->strRazonSocial, 
						  'rfc' => $objAnticipoNoFiscal->strRfc, 
						  'calle' => $objAnticipoNoFiscal->strCalle,
						  'numero_exterior' => $objAnticipoNoFiscal->strNumeroExterior,
						  'numero_interior' => $objAnticipoNoFiscal->strNumeroInterior,
						  'codigo_postal' => $objAnticipoNoFiscal->strCodigoPostal,
						  'colonia' => $objAnticipoNoFiscal->strColonia,
						  'localidad' => $objAnticipoNoFiscal->strLocalidad,
						  'municipio' => $objAnticipoNoFiscal->strMunicipio,
						  'estado' => $objAnticipoNoFiscal->strEstado,
						  'pais' => $objAnticipoNoFiscal->strPais,
						  'modulo_id' => $objAnticipoNoFiscal->intModuloID,
						  'concepto' => $objAnticipoNoFiscal->strConcepto,
						  'subtotal' => $objAnticipoNoFiscal->intSubtotal,
						  'tasa_cuota_iva' => $objAnticipoNoFiscal->intTasaCuotaIva,
						  'iva' => $objAnticipoNoFiscal->intIva,
						  'tasa_cuota_ieps' => $objAnticipoNoFiscal->intTasaCuotaIeps,
						  'ieps' => $objAnticipoNoFiscal->intIeps,
						  'forma_pago_id' => $objAnticipoNoFiscal->intFormaPagoID,
						  'cuenta_bancaria_id' => $objAnticipoNoFiscal->intCuentaBancariaID,
						  'observaciones' => $objAnticipoNoFiscal->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objAnticipoNoFiscal->intUsuarioID);
		$this->db->where('anticipo_no_fiscal_id', $objAnticipoNoFiscal->intAnticipoNoFiscalID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('anticipos_no_fiscales', $arrDatos);
	}


	//Método para modificar el estatus de un registro
	public function set_estatus($intAnticipoNoFiscalID, $intPolizaID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (pólizas) 
        $otdModelPolizas = new Polizas_model();
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' => $this->session->userdata('usuario_id'));
		$this->db->where('anticipo_no_fiscal_id', $intAnticipoNoFiscalID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('anticipos_no_fiscales', $arrDatos);

		//Hacer un llamado al método para modificar el estatus de la póliza 
		$otdModelPolizas->set_estatus($intPolizaID, 'INACTIVO');

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}
 
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intAnticipoNoFiscalID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strProcesoPoliza = $this->db->escape('RECIBO INTERNO ANTICIPO');

		$this->db->select("ANF.anticipo_no_fiscal_id, ANF.folio, DATE_FORMAT(ANF.fecha,'%d/%m/%Y') AS fecha,
						   ANF.moneda_id, ANF.tipo_cambio, ANF.prospecto_id, ANF.razon_social, 
						   ANF.rfc, ANF.calle, ANF.numero_exterior, ANF.numero_interior, ANF.codigo_postal, 
						   ANF.colonia, ANF.localidad, ANF.municipio, ANF.estado, ANF.pais, ANF.modulo_id, 
						   ANF.concepto, ANF.subtotal, ANF.tasa_cuota_iva, ANF.iva, 
						   ANF.tasa_cuota_ieps, ANF.ieps, ANF.forma_pago_id, ANF.cuenta_bancaria_id,
						   ANF.observaciones, ANF.estatus, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, 
						   M.codigo AS codigo_moneda, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, 
						   MO.descripcion AS modulo,
						   CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria,
						   PRO.codigo AS CodigoProspecto,
						   TIva.valor_maximo AS porcentaje_iva, TIeps.valor_maximo AS porcentaje_ieps, 
						   TIva.factor AS FactorIva, IIva.codigo AS ImpuestoIva, 
						   TIeps.factor AS FactorIeps, IIeps.codigo AS ImpuestoIeps,
						   UC.usuario AS usuario_creacion,
						   DATE_FORMAT(ANF.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza", FALSE);
		$this->db->from('anticipos_no_fiscales AS ANF');
		$this->db->join('clientes AS C', 'ANF.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('sat_monedas AS M', 'ANF.moneda_id = M.moneda_id', 'inner');
		$this->db->join('modulos AS MO', 'ANF.modulo_id = MO.modulo_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'ANF.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('cuentas_bancarias AS CB', 'ANF.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIva', 'ANF.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	    $this->db->join('sat_impuestos AS IIva', 'TIva.impuesto_id = IIva.impuesto_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIeps', 'ANF.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
	    $this->db->join('sat_impuestos AS IIeps', 'TIeps.impuesto_id = IIeps.impuesto_id', 'left');
	    $this->db->join('usuarios AS UC', 'ANF.usuario_creacion = UC.usuario_id', 'left');
	     $this->db->join('polizas AS PF', 'PF.modulo = "CAJA" 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND ANF.anticipo_no_fiscal_id = PF.referencia_id', 'left');

		//Si existe id del anticipo no fiscal
		if ($intAnticipoNoFiscalID !== NULL)
		{   
			$this->db->where('ANF.anticipo_no_fiscal_id', $intAnticipoNoFiscalID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('ANF.sucursal_id', $this->session->userdata('sucursal_id'));

		    //Si existe id del cliente
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('ANF.prospecto_id', $intProspectoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(ANF.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(ANF.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('ANF.estatus', $strEstatus);
				}
			}

			$this->db->where("((ANF.folio LIKE '%$strBusqueda%') OR
		    				   (ANF.concepto LIKE '%$strBusqueda%') OR
		    				   (CONCAT_WS(' - ', ANF.rfc, ANF.razon_social) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', ANF.rfc, ANF.razon_social) LIKE '%$strBusqueda%') OR
	    				       (CONCAT_WS(' - ', ANF.razon_social, ANF.rfc) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', ANF.razon_social, ANF.rfc) LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('ANF.fecha DESC, ANF.folio DESC');
			return $this->db->get()->result();
		}
	}


	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL, 
											 $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('anticipos_no_fiscales AS ANF');
		$this->db->join('sat_monedas AS M', 'ANF.moneda_id = M.moneda_id', 'inner');
		$this->db->where('ANF.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
	 
		//Si existe id del cliente
	    if($intProspectoID > 0)
	    {
	   		$this->db->where('ANF.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(ANF.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('ANF.estatus', $strEstatus);
		}

		$this->db->where("((ANF.folio LIKE '%$strBusqueda%') OR
	    				   (ANF.concepto LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', ANF.rfc, ANF.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', ANF.rfc, ANF.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', ANF.razon_social, ANF.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', ANF.razon_social, ANF.rfc) LIKE '%$strBusqueda%'))");  

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL, 
						   $strEstatus = NULL, $strBusqueda =  NULL, $intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strProcesoPoliza = $this->db->escape('RECIBO INTERNO ANTICIPO');


		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('ANF.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del cliente
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('ANF.prospecto_id', $intProspectoID);
	    }

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(ANF.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(ANF.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('ANF.estatus', $strEstatus);
			}
		}

		$this->db->where("((ANF.folio LIKE '%$strBusqueda%') OR
	    				   (ANF.concepto LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', ANF.rfc, ANF.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', ANF.rfc, ANF.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', ANF.razon_social, ANF.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', ANF.razon_social, ANF.rfc) LIKE '%$strBusqueda%'))"); 

		$this->db->from('anticipos_no_fiscales AS ANF');
		$this->db->join('clientes AS C', 'ANF.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('sat_monedas AS M', 'ANF.moneda_id = M.moneda_id', 'inner');
		$this->db->join('modulos AS MD', 'ANF.modulo_id = MD.modulo_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'ANF.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('cuentas_bancarias AS CB', 'ANF.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIva', 'ANF.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	    $this->db->join('polizas AS PF', 'PF.modulo = "CAJA" 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND ANF.anticipo_no_fiscal_id = PF.referencia_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("ANF.anticipo_no_fiscal_id, ANF.folio, DATE_FORMAT(ANF.fecha,'%d/%m/%Y') AS fecha,
						   ANF.razon_social, ANF.rfc, ANF.concepto, 
						   CONCAT('$',FORMAT(((ANF.subtotal + ANF.iva +ANF.ieps) / ANF.tipo_cambio),2)) AS total, 
						   ANF.estatus, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza", FALSE);
		$this->db->from('anticipos_no_fiscales AS ANF');
		$this->db->join('clientes AS C', 'ANF.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
		$this->db->join('sat_monedas AS M', 'ANF.moneda_id = M.moneda_id', 'inner');
		$this->db->join('modulos AS MD', 'ANF.modulo_id = MD.modulo_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'ANF.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('cuentas_bancarias AS CB', 'ANF.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIva', 'ANF.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	    $this->db->join('polizas AS PF', 'PF.modulo = "CAJA" 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND ANF.anticipo_no_fiscal_id = PF.referencia_id', 'left');

		$this->db->where('ANF.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del cliente
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where('ANF.prospecto_id', $intProspectoID);
	    }

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(ANF.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(ANF.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('ANF.estatus', $strEstatus);
			}
		}

		$this->db->where("((ANF.folio LIKE '%$strBusqueda%') OR
	    				   (ANF.concepto LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', ANF.rfc, ANF.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', ANF.rfc, ANF.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', ANF.razon_social, ANF.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', ANF.razon_social, ANF.rfc) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('ANF.fecha DESC, ANF.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["anticipos"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>