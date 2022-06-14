<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');

class recibos_ingreso_model extends CI_model {

	/*******************************************************************************************************************
	Funciones de la tabla recibos_ingreso
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objReciboIngreso)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objReciboIngreso->strFolio); 

		//Concatenar hora, minutos y segundos
		$dteFecha = $objReciboIngreso->dteFecha.' '.date("H:i:s"); 

		//Tabla recibos_ingreso
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objReciboIngreso->intSucursalID,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha, 
						  'moneda_id' => $objReciboIngreso->intMonedaID, 
						  'tipo_cambio' => $objReciboIngreso->intTipoCambio,
						  'prospecto_id' => $objReciboIngreso->intProspectoID,
						  'razon_social' => $objReciboIngreso->strRazonSocial, 
						  'rfc' => $objReciboIngreso->strRfc, 
						  'calle' => $objReciboIngreso->strCalle,
						  'numero_exterior' => $objReciboIngreso->strNumeroExterior,
						  'numero_interior' => $objReciboIngreso->strNumeroInterior,
						  'codigo_postal' => $objReciboIngreso->strCodigoPostal,
						  'colonia' => $objReciboIngreso->strColonia,
						  'localidad' => $objReciboIngreso->strLocalidad,
						  'municipio' => $objReciboIngreso->strMunicipio,
						  'estado' => $objReciboIngreso->strEstado,
						  'pais' => $objReciboIngreso->strPais,
						  'forma_pago_id' => $objReciboIngreso->intFormaPagoID,
						  'observaciones' => $objReciboIngreso->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objReciboIngreso->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('recibos_ingreso', $arrDatos);
		
		//Agregar id del nuevo registro al objeto
		$objReciboIngreso->intReciboIngresoID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles del recibo de ingreso 
		$this->guardar_detalles($objReciboIngreso);
			
		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objReciboIngreso->intReciboIngresoID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objReciboIngreso)
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Concatenar hora, minutos y segundos
		$dteFecha = $objReciboIngreso->dteFecha.' '.date("H:i:s"); 

		//Tabla recibos_ingreso
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha, 
						  'moneda_id' => $objReciboIngreso->intMonedaID, 
						  'tipo_cambio' => $objReciboIngreso->intTipoCambio,
						  'prospecto_id' => $objReciboIngreso->intProspectoID,
						  'razon_social' => $objReciboIngreso->strRazonSocial, 
						  'rfc' => $objReciboIngreso->strRfc, 
						  'calle' => $objReciboIngreso->strCalle,
						  'numero_exterior' => $objReciboIngreso->strNumeroExterior,
						  'numero_interior' => $objReciboIngreso->strNumeroInterior,
						  'codigo_postal' => $objReciboIngreso->strCodigoPostal,
						  'colonia' => $objReciboIngreso->strColonia,
						  'localidad' => $objReciboIngreso->strLocalidad,
						  'municipio' => $objReciboIngreso->strMunicipio,
						  'estado' => $objReciboIngreso->strEstado,
						  'pais' => $objReciboIngreso->strPais,
						  'forma_pago_id' => $objReciboIngreso->intFormaPagoID,
						  'observaciones' => $objReciboIngreso->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objReciboIngreso->intUsuarioID);
		$this->db->where('recibo_ingreso_id', $objReciboIngreso->intReciboIngresoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('recibos_ingreso', $arrDatos);

		//Eliminar los detalles guardados del recibo de ingreso
		$this->db->where('recibo_ingreso_id', $objReciboIngreso->intReciboIngresoID);
		$this->db->delete('recibos_ingreso_detalles');
		
		//Hacer un llamado al método para guardar los detalles del recibo de ingreso 
		$this->guardar_detalles($objReciboIngreso);


		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}


	//Método para modificar el estatus de un registro
	public function set_estatus($intReciboIngresoID, $intPolizaID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (pólizas) 
        $otdModelPolizas = new Polizas_model();
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('recibo_ingreso_id', $intReciboIngresoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('recibos_ingreso',$arrDatos);

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
	public function buscar($intReciboIngresoID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
					       $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';

		//Si existe id del recibo de ingreso
		if ($intReciboIngresoID !== NULL)
		{   
			$strRestricciones .= " AND RI.recibo_ingreso_id = $intReciboIngresoID";
		}
		else
		{
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$strRestricciones .= " AND RI.prospecto_id = $intProspectoID";
		    }

			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$strRestricciones .= " AND (DATE_FORMAT(RI.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
		    }

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$strRestricciones .= " AND (IFNULL(PF.poliza_id, 0) = 0)";
					$strRestricciones .= " AND (RI.estatus = 'ACTIVO')";
				}
				else
				{
					$strRestricciones .= " AND RI.estatus = '$strEstatus'";
				}
			}

			$strRestricciones .= " AND ((RI.folio LIKE '%$strBusqueda%') OR
				    				    (CONCAT_WS(' - ', RI.rfc, RI.razon_social) LIKE '%$strBusqueda%') OR
					                    (CONCAT_WS(' ', RI.rfc, RI.razon_social) LIKE '%$strBusqueda%') OR
			    				        (CONCAT_WS(' - ', RI.razon_social, RI.rfc) LIKE '%$strBusqueda%') OR
					                    (CONCAT_WS(' ', RI.razon_social, RI.rfc) LIKE '%$strBusqueda%'))";

		}

		//Formar consulta
		$queryRecibosIngreso = "SELECT RI.recibo_ingreso_id, RI.folio,
										   DATE_FORMAT(RI.fecha,'%d/%m/%Y') AS fecha,
										   RI.moneda_id, RI.tipo_cambio, RI.prospecto_id, 
										   RI.razon_social, RI.rfc, RI.calle, RI.numero_exterior, 
										   RI.numero_interior, RI.codigo_postal, RI.colonia, 
										   RI.localidad, RI.municipio, RI.estado, 
										   RI.pais, RI.forma_pago_id, RI.observaciones, RI.estatus, 
										   M.codigo AS codigo_moneda, 
										   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
										   CONCAT_WS(' - ', FP.codigo, FP.descripcion) AS forma_pago, 
										   C.correo_electronico, C.contacto_correo_electronico, 
										   PRO.codigo AS CodigoProspecto, 
										   ROUND((Detalles.Precio/RI.tipo_cambio), 2) AS subtotal,
										   ROUND((Detalles.IVA/RI.tipo_cambio), 2) AS iva,
										   ROUND((Detalles.IEPS/RI.tipo_cambio), 2) AS ieps, 
										   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   				   PF.folio AS folio_poliza
								    FROM recibos_ingreso AS RI
								    INNER JOIN sat_monedas AS M ON RI.moneda_id = M.moneda_id
								    INNER JOIN clientes AS C ON RI.prospecto_id = C.prospecto_id
								    INNER JOIN prospectos AS PRO ON PRO.prospecto_id = C.prospecto_id
								    INNER JOIN sat_forma_pago AS FP ON RI.forma_pago_id = FP.forma_pago_id
								    INNER JOIN (SELECT Det.recibo_ingreso_id AS referenciaID,
								    				   SUM(Det.precio) AS Precio, 
								    				   SUM(Det.iva) AS IVA,
								    				   SUM(Det.ieps) AS IEPS
								    		    FROM recibos_ingreso_detalles AS Det
								    			GROUP BY Det.recibo_ingreso_id) AS Detalles ON Detalles.referenciaID = RI.recibo_ingreso_id
								    LEFT JOIN polizas AS PF ON RI.recibo_ingreso_id = PF.referencia_id 
								    	 AND PF.modulo = 'CUENTAS POR COBRAR' AND PF.proceso = 'RECIBO INGRESO'
								    WHERE RI.sucursal_id = $intSucursalID
								    $strRestricciones
								    ORDER BY RI.fecha DESC, RI.folio DESC";
		
		$strSQL = $this->db->query($queryRecibosIngreso);
		//Si existe id del recibo de ingreso
		if ($intReciboIngresoID !== NULL)
		{ 
			//Regresar datos de la primer fila
			return $strSQL->row();
		}
		else
		{
			//Regresar todas las filas
			return $strSQL->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
											 $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('recibos_ingreso AS RI');
		$this->db->join('sat_monedas AS M', 'RI.moneda_id = M.moneda_id', 'inner');
		$this->db->where('RI.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('RI.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(RI.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('RI.estatus', $strEstatus);
		}

		$this->db->where("((RI.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', RI.rfc, RI.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', RI.rfc, RI.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', RI.razon_social, RI.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', RI.razon_social, RI.rfc) LIKE '%$strBusqueda%'))");

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL,  
						   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('CUENTAS POR COBRAR');
		$strProcesoPoliza = $this->db->escape('RECIBO INGRESO');
		
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('RI.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('RI.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(RI.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(RI.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('RI.estatus', $strEstatus);
			}
		}

		$this->db->where("((RI.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', RI.rfc, RI.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', RI.rfc, RI.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', RI.razon_social, RI.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', RI.razon_social, RI.rfc) LIKE '%$strBusqueda%'))");

		$this->db->from('recibos_ingreso AS RI');
	    $this->db->join('sat_monedas AS M', 'RI.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'RI.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'RI.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.'
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND RI.recibo_ingreso_id = PF.referencia_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("RI.recibo_ingreso_id, RI.folio, 
						   DATE_FORMAT(RI.fecha,'%d/%m/%Y') AS fecha, 
						   RI.rfc, RI.razon_social, RI.estatus,
						    IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   	PF.folio AS folio_poliza", FALSE);
		$this->db->from('recibos_ingreso AS RI');
	    $this->db->join('sat_monedas AS M', 'RI.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'RI.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('sat_forma_pago AS FP', 'RI.forma_pago_id = FP.forma_pago_id', 'inner');
	    $this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.'
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND RI.recibo_ingreso_id = PF.referencia_id', 'left');
	    $this->db->where('RI.sucursal_id', $this->session->userdata('sucursal_id'));
	    //Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('RI.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(RI.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(RI.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('RI.estatus', $strEstatus);
			}
		}

		$this->db->where("((RI.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', RI.rfc, RI.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', RI.rfc, RI.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', RI.razon_social, RI.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', RI.razon_social, RI.rfc) LIKE '%$strBusqueda%'))");
		$this->db->order_by('RI.fecha DESC, RI.folio DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["recibos"] =$this->db->get()->result();
		return $arrResultado;
	}



	/*******************************************************************************************************************
	Funciones de la tabla recibos_ingreso_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de un recibo de ingreso 
	public function guardar_detalles(stdClass $objReciboIngreso)
	{
		//Quitar | de la lista para obtener los valores del array
		$arrReferencias = explode("|", $objReciboIngreso->strReferencias);
		$arrReferenciaID = explode("|", $objReciboIngreso->strReferenciaID);
		$arrPrecios = explode("|", $objReciboIngreso->strPrecios);
		$arrTasaCuotaIva = explode("|", $objReciboIngreso->strTasaCuotaIva);
		$arrIvas = explode("|", $objReciboIngreso->strIvas);
		$arrTasaCuotaIeps = explode("|", $objReciboIngreso->strTasaCuotaIeps);
		$arrIeps = explode("|", $objReciboIngreso->strIeps);
		
		//Hacer recorrido para insertar los datos en la tabla recibos_ingreso_detalles
		for ($intCon = 0; $intCon < sizeof($arrReferenciaID); $intCon++) 
		{
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? $arrTasaCuotaIeps[$intCon] : NULL);

			//Asignar datos al array
			$arrDatos = array('recibo_ingreso_id' => $objReciboIngreso->intReciboIngresoID,
				 			  'renglon' => ($intCon + 1),
							  'referencia' => $arrReferencias[$intCon],
							  'referencia_id' => $arrReferenciaID[$intCon],
							  'precio' => $arrPrecios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon],
							  'iva' => $arrIvas[$intCon],
							  'tasa_cuota_ieps' => $intTasaCuotaIeps,
							  'ieps' => $arrIeps[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('recibos_ingreso_detalles', $arrDatos);
		}
		
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intReciboIngresoID)
	{

		$this->db->select('RID.referencia, RID.referencia_id, RID.precio, 
						   RID.tasa_cuota_iva, RID.iva, RID.tasa_cuota_ieps, RID.ieps, 
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps,
						   TIeps.tipo AS tipo_ieps, TIeps.factor AS factor_ieps');
		$this->db->from('recibos_ingreso_detalles AS RID');
		$this->db->join('sat_tasa_cuota AS TIva', 'RID.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'RID.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('RID.recibo_ingreso_id', $intReciboIngresoID);
		$this->db->order_by('RID.renglon', 'ASC');
		return $this->db->get()->result();
	}

}