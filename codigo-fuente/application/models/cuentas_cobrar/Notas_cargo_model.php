<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');

class notas_cargo_model extends CI_model {

	/*******************************************************************************************************************
	Funciones de la tabla notas_cargo
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objNotaCargo)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objNotaCargo->strFolio); 

		//Concatenar hora, minutos y segundos
		$dteFecha = $objNotaCargo->dteFecha.' '.date("H:i:s"); 

		//Tabla notas_cargo
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objNotaCargo->intSucursalID,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha, 
						  'moneda_id' => $objNotaCargo->intMonedaID, 
						  'tipo_cambio' => $objNotaCargo->intTipoCambio,
						  'prospecto_id' => $objNotaCargo->intProspectoID,
						  'razon_social' => $objNotaCargo->strRazonSocial, 
						  'rfc' => $objNotaCargo->strRfc, 
						  'calle' => $objNotaCargo->strCalle,
						  'numero_exterior' => $objNotaCargo->strNumeroExterior,
						  'numero_interior' => $objNotaCargo->strNumeroInterior,
						  'codigo_postal' => $objNotaCargo->strCodigoPostal,
						  'colonia' => $objNotaCargo->strColonia,
						  'localidad' => $objNotaCargo->strLocalidad,
						  'municipio' => $objNotaCargo->strMunicipio,
						  'estado' => $objNotaCargo->strEstado,
						  'pais' => $objNotaCargo->strPais,
						  'observaciones' => $objNotaCargo->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objNotaCargo->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('notas_cargo', $arrDatos);
		
		//Agregar id del nuevo registro al objeto
		$objNotaCargo->intNotaCargoID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la nota de cargo
		$this->guardar_detalles($objNotaCargo);
			
		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objNotaCargo->intNotaCargoID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objNotaCargo)
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Concatenar hora, minutos y segundos
		$dteFecha = $objNotaCargo->dteFecha.' '.date("H:i:s"); 

		//Tabla notas_cargo
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha, 
						  'moneda_id' => $objNotaCargo->intMonedaID, 
						  'tipo_cambio' => $objNotaCargo->intTipoCambio,
						  'prospecto_id' => $objNotaCargo->intProspectoID,
						  'razon_social' => $objNotaCargo->strRazonSocial, 
						  'rfc' => $objNotaCargo->strRfc, 
						  'calle' => $objNotaCargo->strCalle,
						  'numero_exterior' => $objNotaCargo->strNumeroExterior,
						  'numero_interior' => $objNotaCargo->strNumeroInterior,
						  'codigo_postal' => $objNotaCargo->strCodigoPostal,
						  'colonia' => $objNotaCargo->strColonia,
						  'localidad' => $objNotaCargo->strLocalidad,
						  'municipio' => $objNotaCargo->strMunicipio,
						  'estado' => $objNotaCargo->strEstado,
						  'pais' => $objNotaCargo->strPais,
						  'observaciones' => $objNotaCargo->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objNotaCargo->intUsuarioID);
		$this->db->where('nota_cargo_id', $objNotaCargo->intNotaCargoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('notas_cargo', $arrDatos);

		//Eliminar los detalles guardados de la nota de cargo
		$this->db->where('nota_cargo_id', $objNotaCargo->intNotaCargoID);
		$this->db->delete('notas_cargo_detalles');
		
		//Hacer un llamado al método para guardar los detalles de la nota de cargo
		$this->guardar_detalles($objNotaCargo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	
	//Método para modificar el estatus de un registro a INACTIVO 
	public function set_estatus($intNotaCargoID, $intPolizaID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Se crea una instancia de la clase modelo (pólizas) 
        $otdModelPolizas = new Polizas_model();


		 //Modificar el estatus a INACTIVO de un registro de notas de cargo
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('nota_cargo_id', $intNotaCargoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('notas_cargo', $arrDatos);

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
	public function buscar($intNotaCargoID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
					       $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';

		//Si existe id de la nota de cargo
		if ($intNotaCargoID !== NULL)
		{   
			$strRestricciones .= " AND NC.nota_cargo_id = $intNotaCargoID";
		}
		else
		{
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$strRestricciones .= " AND NC.prospecto_id = $intProspectoID";
		    }

			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$strRestricciones .= " AND (DATE_FORMAT(NC.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
		    }

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$strRestricciones .= " AND (IFNULL(PF.poliza_id, 0) = 0)";
					$strRestricciones .= " AND (NC.estatus = 'ACTIVO')";
				}
				else
				{
					$strRestricciones .= " AND NC.estatus = '$strEstatus'";
				}
			}

			$strRestricciones .= " AND ((NC.folio LIKE '%$strBusqueda%') OR
				    				   (CONCAT_WS(' - ', NC.rfc, NC.razon_social) LIKE '%$strBusqueda%') OR
					                   (CONCAT_WS(' ', NC.rfc, NC.razon_social) LIKE '%$strBusqueda%') OR
			    				       (CONCAT_WS(' - ', NC.razon_social, NC.rfc) LIKE '%$strBusqueda%') OR
					                   (CONCAT_WS(' ', NC.razon_social, NC.rfc) LIKE '%$strBusqueda%'))";
		}


		//Formar consulta
		$queryNotasCargo = "SELECT NC.nota_cargo_id, NC.folio,
								   NC.fecha, DATE_FORMAT(NC.fecha,'%d/%m/%Y') AS fecha,
								   NC.moneda_id, NC.tipo_cambio, NC.prospecto_id, 
								   NC.razon_social, NC.rfc, NC.calle, NC.numero_exterior, 
								   NC.numero_interior, NC.codigo_postal, NC.colonia, 
								   NC.localidad, NC.municipio, NC.estado, 
								   NC.pais, NC.observaciones, NC.estatus, 
								   M.codigo AS codigo_moneda, 
								   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
								   C.correo_electronico, C.contacto_correo_electronico,
								   UC.usuario AS usuario_creacion,
								   PRO.codigo AS CodigoProspecto, 
								   ROUND((Detalles.Precio/NC.tipo_cambio), 2) AS subtotal,
								   ROUND((Detalles.IVA/NC.tipo_cambio), 2) AS iva,
								   ROUND((Detalles.IEPS/NC.tipo_cambio), 2) AS ieps, 
								   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   		   PF.folio AS folio_poliza

						    FROM notas_cargo AS NC
						    INNER JOIN sat_monedas AS M ON NC.moneda_id = M.moneda_id
						    INNER JOIN clientes AS C ON NC.prospecto_id = C.prospecto_id
						    INNER JOIN prospectos AS PRO ON PRO.prospecto_id = C.prospecto_id
						    INNER JOIN (SELECT Det.nota_cargo_id AS referenciaID,
								    		   SUM(Det.precio) AS Precio, 
								    		   SUM(Det.iva) AS IVA,
								    		   SUM(Det.ieps) AS IEPS
						    		    FROM notas_cargo_detalles AS Det
						    			GROUP BY Det.nota_cargo_id) AS Detalles ON Detalles.referenciaID = NC.nota_cargo_id
						    LEFT JOIN usuarios AS UC ON NC.usuario_creacion = UC.usuario_id
						    LEFT JOIN polizas AS PF ON NC.nota_cargo_id = PF.referencia_id
								 AND  PF.modulo = 'CUENTAS POR COBRAR' AND PF.proceso = 'NOTA CARGO'
						    WHERE  NC.sucursal_id = $intSucursalID
						    $strRestricciones
						    ORDER BY NC.fecha DESC, NC.folio DESC";

		$strSQL = $this->db->query($queryNotasCargo);
		//Si existe id de la nota de cargo
		if ($intNotaCargoID !== NULL)
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
		$this->db->from('notas_cargo AS NC');
		$this->db->join('sat_monedas AS M', 'NC.moneda_id = M.moneda_id', 'inner');
		$this->db->where('NC.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('NC.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(NC.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('NC.estatus', $strEstatus);
		}

		$this->db->where("((NC.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', NC.rfc, NC.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NC.rfc, NC.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', NC.razon_social, NC.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NC.razon_social, NC.rfc) LIKE '%$strBusqueda%'))");

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
		$strProcesoPoliza = $this->db->escape('NOTA CARGO');


		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('NC.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('NC.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(NC.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(NC.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('NC.estatus', $strEstatus);
			}
		}

		$this->db->where("((NC.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', NC.rfc, NC.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NC.rfc, NC.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', NC.razon_social, NC.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NC.razon_social, NC.rfc) LIKE '%$strBusqueda%'))");

		$this->db->from('notas_cargo AS NC');
	    $this->db->join('sat_monedas AS M', 'NC.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'NC.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	     $this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND NC.nota_cargo_id = PF.referencia_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("NC.nota_cargo_id, 
						   NC.folio, 
						   DATE_FORMAT(NC.fecha,'%d/%m/%Y') AS fecha, 
						   NC.rfc, NC.razon_social, NC.estatus, 
						   	IFNULL(PF.poliza_id, 0) AS poliza_id, 
						    PF.folio AS folio_poliza", FALSE);
		$this->db->from('notas_cargo AS NC');
	    $this->db->join('sat_monedas AS M', 'NC.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('clientes AS C', 'NC.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('prospectos AS PRO', 'PRO.prospecto_id = C.prospecto_id', 'inner');
	    $this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND NC.nota_cargo_id = PF.referencia_id', 'left');
	    $this->db->where('NC.sucursal_id', $this->session->userdata('sucursal_id'));
	    //Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('NC.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(NC.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	   //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(NC.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('NC.estatus', $strEstatus);
			}
		}


		$this->db->where("((NC.folio LIKE '%$strBusqueda%') OR
		    			   (CONCAT_WS(' - ', NC.rfc, NC.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NC.rfc, NC.razon_social) LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', NC.razon_social, NC.rfc) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', NC.razon_social, NC.rfc) LIKE '%$strBusqueda%'))");
		$this->db->order_by('NC.fecha DESC, NC.folio DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["notas"] =$this->db->get()->result();
		return $arrResultado;
	}



	/*******************************************************************************************************************
	Funciones de la tabla notas_cargo_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de una nota de cargo
	public function guardar_detalles(stdClass $objNotaCargo)
	{
		//Quitar | de la lista para obtener los valores del array
		$arrReferencias = explode("|", $objNotaCargo->strReferencias);
		$arrReferenciaID = explode("|", $objNotaCargo->strReferenciaID);
		$arrConceptos = explode("|", $objNotaCargo->strConceptos);
		$arrPrecios = explode("|", $objNotaCargo->strPrecios);
		$arrTasaCuotaIva = explode("|", $objNotaCargo->strTasaCuotaIva);
		$arrIvas = explode("|", $objNotaCargo->strIvas);
		$arrTasaCuotaIeps = explode("|", $objNotaCargo->strTasaCuotaIeps);
		$arrIeps = explode("|", $objNotaCargo->strIeps);
		
		//Hacer recorrido para insertar los datos en la tabla notas_cargo_detalles
		for ($intCon = 0; $intCon < sizeof($arrReferenciaID); $intCon++) 
		{
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? $arrTasaCuotaIeps[$intCon] : NULL);

			//Asignar datos al array
			$arrDatos = array( 'nota_cargo_id' => $objNotaCargo->intNotaCargoID,
				 			  'renglon' => ($intCon + 1),
							  'referencia' => $arrReferencias[$intCon],
							  'referencia_id' => $arrReferenciaID[$intCon],
							  'concepto' => $arrConceptos[$intCon],
							  'codigo_sat' => CLAVE_PRODUCTO_SAT_NCARGO,
							  'unidad_sat' => CLAVE_UNIDAD_SAT_NCARGO,
							  'precio' => $arrPrecios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon],
							  'iva' => $arrIvas[$intCon],
							  'tasa_cuota_ieps' => $intTasaCuotaIeps,
							  'ieps' => $arrIeps[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('notas_cargo_detalles', $arrDatos);
		}
		
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intNotaCargoID)
	{

		$this->db->select('NCD.referencia, NCD.referencia_id, NCD.concepto, NCD.codigo_sat, 
						   NCD.unidad_sat, NCD.precio, NCD.tasa_cuota_iva, NCD.iva, 
						   NCD.tasa_cuota_ieps, NCD.ieps, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps,
						   TIeps.tipo AS tipo_ieps, TIeps.factor AS factor_ieps');
		$this->db->from('notas_cargo_detalles AS NCD');
		$this->db->join('sat_tasa_cuota AS TIva', 'NCD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'NCD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('NCD.nota_cargo_id', $intNotaCargoID);
		$this->db->order_by('NCD.renglon', 'ASC');
		return $this->db->get()->result();
	}
}