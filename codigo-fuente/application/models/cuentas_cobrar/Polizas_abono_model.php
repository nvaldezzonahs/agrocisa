<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');

class polizas_abono_model extends CI_model {

	/*******************************************************************************************************************
	Funciones de la tabla polizas_abono_02
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objPolizaAbono)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
		
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objPolizaAbono->strFolio); 

		//Concatenar hora, minutos y segundos
		$dteFecha = $objPolizaAbono->dteFecha.' '.date("H:i:s"); 

		//Tabla polizas_abono_02
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objPolizaAbono->intSucursalID,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha, 
						  'anticipo_id' => $objPolizaAbono->intAnticipoID, 
						  'moneda_id' => $objPolizaAbono->intMonedaID, 
						  'tipo_cambio' => $objPolizaAbono->intTipoCambio,
						  'prospecto_id' => $objPolizaAbono->intProspectoID,
						  'razon_social' => $objPolizaAbono->strRazonSocial, 
						  'rfc' => $objPolizaAbono->strRfc, 
						  'calle' => $objPolizaAbono->strCalle,
						  'numero_exterior' => $objPolizaAbono->strNumeroExterior,
						  'numero_interior' => $objPolizaAbono->strNumeroInterior,
						  'codigo_postal' => $objPolizaAbono->strCodigoPostal,
						  'colonia' => $objPolizaAbono->strColonia,
						  'localidad' => $objPolizaAbono->strLocalidad,
						  'municipio' => $objPolizaAbono->strMunicipio,
						  'estado' => $objPolizaAbono->strEstado,
						  'pais' => $objPolizaAbono->strPais,
						  'observaciones' => $objPolizaAbono->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objPolizaAbono->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('polizas_abono_02', $arrDatos);
		
		//Agregar id del nuevo registro al objeto
		$objPolizaAbono->intPolizaAbonoID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la póliza de abono
		$this->guardar_detalles($objPolizaAbono);
			
		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objPolizaAbono->intPolizaAbonoID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objPolizaAbono)
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Concatenar hora, minutos y segundos
		$dteFecha = $objPolizaAbono->dteFecha.' '.date("H:i:s"); 

		//Tabla polizas_abono_02
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha, 
						  'anticipo_id' => $objPolizaAbono->intAnticipoID, 
						  'moneda_id' => $objPolizaAbono->intMonedaID, 
						  'tipo_cambio' => $objPolizaAbono->intTipoCambio,
						  'prospecto_id' => $objPolizaAbono->intProspectoID,
						  'razon_social' => $objPolizaAbono->strRazonSocial, 
						  'rfc' => $objPolizaAbono->strRfc, 
						  'calle' => $objPolizaAbono->strCalle,
						  'numero_exterior' => $objPolizaAbono->strNumeroExterior,
						  'numero_interior' => $objPolizaAbono->strNumeroInterior,
						  'codigo_postal' => $objPolizaAbono->strCodigoPostal,
						  'colonia' => $objPolizaAbono->strColonia,
						  'localidad' => $objPolizaAbono->strLocalidad,
						  'municipio' => $objPolizaAbono->strMunicipio,
						  'estado' => $objPolizaAbono->strEstado,
						  'pais' => $objPolizaAbono->strPais,
						  'observaciones' => $objPolizaAbono->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objPolizaAbono->intUsuarioID);
		$this->db->where('poliza_abono_id', $objPolizaAbono->intPolizaAbonoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('polizas_abono_02', $arrDatos);

		//Eliminar los detalles guardados de la póliza de abono
		$this->db->where('poliza_abono_id', $objPolizaAbono->intPolizaAbonoID);
		$this->db->delete('polizas_abono_detalles_02');
		
		//Hacer un llamado al método para guardar los detalles de la póliza de abono
		$this->guardar_detalles($objPolizaAbono);


		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}


	//Método para modificar el estatus de un registro
	public function set_estatus($intPolizaAbonoID, $intPolizaID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (pólizas) 
        $otdModelPolizas = new Polizas_model();
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('poliza_abono_id', $intPolizaAbonoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('polizas_abono_02',$arrDatos);

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
	public function buscar($intPolizaAbonoID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
					       $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';

		//Si existe id de la póliza de abono
		if ($intPolizaAbonoID !== NULL)
		{   
			$strRestricciones .= " AND PA.poliza_abono_id = $intPolizaAbonoID";
		}
		else
		{
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$strRestricciones .= " AND PA.prospecto_id = $intProspectoID";
		    }

			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$strRestricciones .= " AND (DATE_FORMAT(PA.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
		    }

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$strRestricciones .= " AND (IFNULL(PF.poliza_id, 0) = 0)";
					$strRestricciones .= " AND (PA.estatus = 'ACTIVO')";
				}
				else
				{
					$strRestricciones .= " AND PA.estatus = '$strEstatus'";
				}
			}

			$strRestricciones .= " AND ((PA.folio LIKE '%$strBusqueda%') OR
				    				   (CONCAT_WS(' - ', PA.rfc, PA.razon_social) LIKE '%$strBusqueda%') OR
					                   (CONCAT_WS(' ', PA.rfc, PA.razon_social) LIKE '%$strBusqueda%') OR
			    				       (CONCAT_WS(' - ', PA.razon_social, PA.rfc) LIKE '%$strBusqueda%') OR
					                   (CONCAT_WS(' ', PA.razon_social, PA.rfc) LIKE '%$strBusqueda%'))";
		}


		//Formar consulta
		$queryPolizasAbono = "SELECT PA.poliza_abono_id, PA.folio, PA.anticipo_id,
								   DATE_FORMAT(PA.fecha,'%d/%m/%Y') AS fecha,
								   PA.moneda_id, PA.tipo_cambio, PA.prospecto_id, 
								   PA.razon_social, PA.rfc, PA.calle, PA.numero_exterior, 
								   PA.numero_interior, PA.codigo_postal, PA.colonia, 
								   PA.localidad, PA.municipio, PA.estado, 
								   PA.pais, PA.observaciones, PA.estatus, 
								   M.codigo AS codigo_moneda, 
								   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
								   C.correo_electronico, C.contacto_correo_electronico,
								   PRO.codigo AS CodigoProspecto,
								   ROUND((Detalles.Precio/PA.tipo_cambio), 2) AS subtotal,
								   ROUND((Detalles.IVA/PA.tipo_cambio), 2) AS iva,
								   ROUND((Detalles.IEPS/PA.tipo_cambio), 2) AS ieps,
								   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   		   PF.folio AS folio_poliza,  A.folio AS folio_anticipo
							FROM polizas_abono_02 AS PA
							INNER JOIN sat_monedas AS M ON PA.moneda_id = M.moneda_id
							INNER JOIN clientes AS C ON PA.prospecto_id = C.prospecto_id  
							INNER JOIN prospectos AS PRO ON PRO.prospecto_id = C.prospecto_id
							INNER JOIN (SELECT Det.poliza_abono_id AS referenciaID,
								    		   SUM(Det.precio) AS Precio, 
								    		   SUM(Det.iva) AS IVA,
								    		   SUM(Det.ieps) AS IEPS
						    		    FROM polizas_abono_detalles_02 AS Det
						    			GROUP BY Det.poliza_abono_id) AS Detalles ON Detalles.referenciaID = PA.poliza_abono_id
						    LEFT JOIN anticipos AS A ON PA.anticipo_id = A.anticipo_id
						    LEFT JOIN polizas AS PF ON PA.poliza_abono_id = PF.referencia_id 
						    	 AND PF.modulo = 'CUENTAS POR COBRAR' AND  PF.proceso = 'POLIZA ABONO'
						    WHERE PA.sucursal_id = $intSucursalID
						    $strRestricciones
						    ORDER BY PA.fecha DESC, PA.folio DESC";


	   	$strSQL = $this->db->query($queryPolizasAbono);
		//Si existe id de la póliza de abono
		if ($intPolizaAbonoID !== NULL)
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
		$this->db->from('polizas_abono_02 AS PA');
		$this->db->join('sat_monedas AS M', 'PA.moneda_id = M.moneda_id', 'inner');
		$this->db->where('PA.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('PA.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(PA.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('PA.estatus', $strEstatus);
		}

		$this->db->where("((PA.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', PA.rfc, PA.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', PA.rfc, PA.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', PA.razon_social, PA.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', PA.razon_social, PA.rfc) LIKE '%$strBusqueda%'))");

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
		$strProcesoPoliza = $this->db->escape('POLIZA ABONO');


		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('PA.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('PA.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(PA.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(PA.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('PA.estatus', $strEstatus);
			}
		}

		$this->db->where("((PA.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', PA.rfc, PA.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', PA.rfc, PA.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', PA.razon_social, PA.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', PA.razon_social, PA.rfc) LIKE '%$strBusqueda%'))");

		$this->db->from('polizas_abono_02 AS PA');
	    $this->db->join('sat_monedas AS M', 'PA.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'PA.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.'
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND PA.poliza_abono_id = PF.referencia_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("PA.poliza_abono_id, PA.folio, 
						   DATE_FORMAT(PA.fecha,'%d/%m/%Y') AS fecha, 
						   PA.rfc, PA.razon_social, PA.estatus,
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza, 
						   IFNULL(A.anticipo_id,0) AS anticipo_id", FALSE);
		$this->db->from('polizas_abono_02 AS PA');
	    $this->db->join('sat_monedas AS M', 'PA.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'PA.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('anticipos AS A', 'PA.anticipo_id = A.anticipo_id', 'left');
	    $this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.'
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND PA.poliza_abono_id = PF.referencia_id', 'left');
	    $this->db->where('PA.sucursal_id', $this->session->userdata('sucursal_id'));
	    //Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('PA.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(PA.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(PA.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('PA.estatus', $strEstatus);
			}
		}

		$this->db->where("((PA.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', PA.rfc, PA.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', PA.rfc, PA.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', PA.razon_social, PA.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', PA.razon_social, PA.rfc) LIKE '%$strBusqueda%'))");
		$this->db->order_by('PA.fecha DESC, PA.folio DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["polizas"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*******************************************************************************************************************
	Funciones de la tabla polizas_abono_detalles_02
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de una póliza de abono
	public function guardar_detalles(stdClass $objPolizaAbono)
	{
		//Quitar | de la lista para obtener los valores del array
		$arrReferencias = explode("|", $objPolizaAbono->strReferencias);
		$arrReferenciaID = explode("|", $objPolizaAbono->strReferenciaID);
		$arrPrecios = explode("|", $objPolizaAbono->strPrecios);
		$arrTasaCuotaIva = explode("|", $objPolizaAbono->strTasaCuotaIva);
		$arrIvas = explode("|", $objPolizaAbono->strIvas);
		$arrTasaCuotaIeps = explode("|", $objPolizaAbono->strTasaCuotaIeps);
		$arrIeps = explode("|", $objPolizaAbono->strIeps);
		
		//Hacer recorrido para insertar los datos en la tabla polizas_abono_detalles_02
		for ($intCon = 0; $intCon < sizeof($arrReferenciaID); $intCon++) 
		{
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? $arrTasaCuotaIeps[$intCon] : NULL);

			//Asignar datos al array
			$arrDatos = array('poliza_abono_id' => $objPolizaAbono->intPolizaAbonoID,
				 			  'renglon' => ($intCon + 1),
							  'referencia' => $arrReferencias[$intCon],
							  'referencia_id' => $arrReferenciaID[$intCon],
							  'precio' => $arrPrecios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon],
							  'iva' => $arrIvas[$intCon],
							  'tasa_cuota_ieps' => $intTasaCuotaIeps,
							  'ieps' => $arrIeps[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('polizas_abono_detalles_02', $arrDatos);
		}
		
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intPolizaAbonoID)
	{

		$this->db->select('PAD.referencia, PAD.referencia_id, PAD.precio, 
						   PAD.tasa_cuota_iva, PAD.iva, PAD.tasa_cuota_ieps, PAD.ieps, 
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps,
						   TIeps.tipo AS tipo_ieps, TIeps.factor AS factor_ieps');
		$this->db->from('polizas_abono_detalles_02 AS PAD');
		$this->db->join('sat_tasa_cuota AS TIva', 'PAD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'PAD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('PAD.poliza_abono_id', $intPolizaAbonoID);
		$this->db->order_by('PAD.renglon', 'ASC');
		return $this->db->get()->result();
	}

}