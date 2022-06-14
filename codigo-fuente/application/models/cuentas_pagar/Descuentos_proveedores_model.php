<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Descuentos_proveedores_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla descuentos_proveedores
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objDescuentoProveedor)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
			
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objDescuentoProveedor->strFolio); 

		//Tabla descuentos_proveedores
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objDescuentoProveedor->intSucursalID,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objDescuentoProveedor->dteFecha, 
						  'moneda_id' => $objDescuentoProveedor->intMonedaID, 
						  'tipo_cambio' => $objDescuentoProveedor->intTipoCambio, 
						  'referencia' => $objDescuentoProveedor->strReferencia, 
						  'proveedor_id' => $objDescuentoProveedor->intProveedorID, 
						  'razon_social' => $objDescuentoProveedor->strRazonSocial,
						  'rfc' => $objDescuentoProveedor->strRfc,
						  'calle' => $objDescuentoProveedor->strCalle,
						  'numero_exterior' => $objDescuentoProveedor->strNumeroExterior,
						  'numero_interior' => $objDescuentoProveedor->strNumeroInterior,
						  'codigo_postal' => $objDescuentoProveedor->strCodigoPostal,
						  'colonia' => $objDescuentoProveedor->strColonia,
						  'localidad' => $objDescuentoProveedor->strLocalidad,
						  'municipio' => $objDescuentoProveedor->strMunicipio,
						  'estado' => $objDescuentoProveedor->strEstado,
						  'pais' => $objDescuentoProveedor->strPais,
						  'observaciones' => $objDescuentoProveedor->strObservaciones, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objDescuentoProveedor->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('descuentos_proveedores', $arrDatos);
		//Agregar id del nuevo registro al objeto
		$objDescuentoProveedor->intDescuentoProveedorID = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles del descuento
		$this->guardar_detalles($objDescuentoProveedor);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objDescuentoProveedor->intDescuentoProveedorID.'_'.$strFolioConsecutivo;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objDescuentoProveedor)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla descuentos_proveedores
		//Asignar datos al array
		$arrDatos = array('fecha' => $objDescuentoProveedor->dteFecha, 
						  'moneda_id' => $objDescuentoProveedor->intMonedaID, 
						  'tipo_cambio' => $objDescuentoProveedor->intTipoCambio, 
						  'referencia' => $objDescuentoProveedor->strReferencia, 
						  'proveedor_id' => $objDescuentoProveedor->intProveedorID, 
						  'razon_social' => $objDescuentoProveedor->strRazonSocial,
						  'rfc' => $objDescuentoProveedor->strRfc,
						  'calle' => $objDescuentoProveedor->strCalle,
						  'numero_exterior' => $objDescuentoProveedor->strNumeroExterior,
						  'numero_interior' => $objDescuentoProveedor->strNumeroInterior,
						  'codigo_postal' => $objDescuentoProveedor->strCodigoPostal,
						  'colonia' => $objDescuentoProveedor->strColonia,
						  'localidad' => $objDescuentoProveedor->strLocalidad,
						  'municipio' => $objDescuentoProveedor->strMunicipio,
						  'estado' => $objDescuentoProveedor->strEstado,
						  'pais' => $objDescuentoProveedor->strPais,
						  'observaciones' => $objDescuentoProveedor->strObservaciones,  
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objDescuentoProveedor->intUsuarioID);
		$this->db->where('descuento_proveedor_id', $objDescuentoProveedor->intDescuentoProveedorID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('descuentos_proveedores', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('descuento_proveedor_id', $objDescuentoProveedor->intDescuentoProveedorID);
		$this->db->delete('descuentos_proveedores_detalles');
		//Hacer un llamado al método para guardar los detalles del descuento
		$this->guardar_detalles($objDescuentoProveedor);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intDescuentoProveedorID)
	{
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('descuento_proveedor_id', $intDescuentoProveedorID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('descuentos_proveedores', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intDescuentoProveedorID = NULL,$dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{


		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = "WHERE ";

		//Si existe id del descuento
		if ($intDescuentoProveedorID != NULL)
		{   

			$strRestricciones .= "DP.descuento_proveedor_id = $intDescuentoProveedorID";
		}
		else  
		{
			$strRestricciones .= "DP.sucursal_id = $intSucursalID";

			//Si existe id del proveedor
		    if($intProveedorID > 0)
		    {
		    	$strRestricciones .= " AND DP.proveedor_id = $intProveedorID";
		    }

			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$strRestricciones .= " AND (DP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
		    }

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$strRestricciones .= " AND DP.estatus = '$strEstatus'";
			}


			$strRestricciones .= " AND ((DP.folio LIKE '%$strBusqueda%') OR
		        				      	(CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
					                  	(CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))";
		
		}

		//Formar consulta
		$queryDescuentos = "SELECT DP.descuento_proveedor_id, DP.folio, 
								   DATE_FORMAT(DP.fecha,'%d/%m/%Y') AS fecha, 
								   DP.moneda_id, DP.tipo_cambio, DP.referencia, DP.proveedor_id, 
								   DP.razon_social, DP.rfc, DP.calle, DP.numero_exterior, DP.numero_interior,
								   DP.codigo_postal, DP.colonia, DP.localidad, DP.municipio, DP.estado, 
								   DP.pais, DP.observaciones, DP.estatus,
								   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, 
								   P.telefono_principal, P.correo_electronico, P.contacto_correo_electronico, 
								   M.codigo AS codigo_moneda, CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,  
								   UC.usuario AS usuario_creacion, 
								   DATE_FORMAT(DP.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion, 
								   ROUND((Detalles.Importe/DP.tipo_cambio), 2) AS subtotal,
						  		   ROUND((Detalles.IVA/DP.tipo_cambio), 2) AS iva,
						   		   ROUND((Detalles.IEPS/DP.tipo_cambio), 2) AS ieps 
							FROM descuentos_proveedores AS DP
							INNER JOIN sat_monedas AS M ON DP.moneda_id = M.moneda_id
							INNER JOIN proveedores AS P ON DP.proveedor_id = P.proveedor_id
							INNER JOIN (SELECT Det.descuento_proveedor_id AS referenciaID,
								    	  	   SUM(Det.importe) AS Importe, 
								    	 	   SUM(Det.iva) AS IVA,
								    	       SUM(Det.ieps) AS IEPS
						    	   		FROM descuentos_proveedores_detalles AS Det
						    	   		GROUP BY Det.descuento_proveedor_id) AS Detalles ON Detalles.referenciaID = DP.descuento_proveedor_id 
							LEFT JOIN usuarios AS UC ON DP.usuario_creacion = UC.usuario_id
					   		$strRestricciones
					   		ORDER BY DP.fecha DESC, DP.folio DESC";

		$strSQL = $this->db->query($queryDescuentos);
		//Si existe id del descuento
		if ($intDescuentoProveedorID != NULL)
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
						   					 $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('descuentos_proveedores AS DP');
		$this->db->join('sat_monedas AS M', 'DP.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'DP.proveedor_id = P.proveedor_id', 'inner');
		$this->db->where('DP.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del proveedor
	    if($intProveedorID > 0)
	    {
	   		$this->db->where('DP.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('DP.estatus', $strEstatus);
		}

	    $this->db->where("((DP.folio LIKE '%$strBusqueda%') OR
    				      	(CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
		                  	(CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))");

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProveedorID = NULL, 
						   $strEstatus = NULL, $strBusqueda =  NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('DP.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('DP.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('DP.estatus', $strEstatus);
		}

		$this->db->where("((DP.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->from('descuentos_proveedores AS DP');
	    $this->db->join('sat_monedas AS M', 'DP.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'DP.proveedor_id = P.proveedor_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("DP.descuento_proveedor_id, DP.folio, DATE_FORMAT(DP.fecha,'%d/%m/%Y') AS fecha, 
						   DP.estatus, CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor", FALSE);
		$this->db->from('descuentos_proveedores AS DP');
	    $this->db->join('sat_monedas AS M', 'DP.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'DP.proveedor_id = P.proveedor_id', 'inner');
		$this->db->where('DP.sucursal_id', $this->session->userdata('sucursal_id'));
	    //Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('DP.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('DP.estatus', $strEstatus);
		}

		$this->db->where("((DP.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
		
		$this->db->order_by('DP.fecha DESC, DP.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["descuentos"] =$this->db->get()->result();
		return $arrResultado;
	}

	
	/*******************************************************************************************************************
	Funciones de las tablas ordenes_compra, ordenes_compra_maquinaria, ordenes_compra_refacciones y trabajos_foraneos
	*********************************************************************************************************************/
	//Método para regresar los registros activos y autorizados que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($intProveedorID, $intMonedaID, $strDescripcion)
	{
		//Asignar número de registros para el autocomplete
    	$intLimite = LIMITE_AUTOCOMPLETE;
	    $strSQL = $this->db->query("SELECT OCM.orden_compra_maquinaria_id  AS referencia_id, 
    									   OCM.folio, 'MAQUINARIA' AS tipo_referencia  
    	 							FROM ordenes_compra_maquinaria AS OCM
    	 							WHERE OCM.proveedor_id = $intProveedorID
    	 							AND  (OCM.estatus = 'AUTORIZADO' OR OCM.estatus = 'SURTIDO')
    	 							AND  (OCM.folio LIKE '%$strDescripcion%')
							        UNION 
							        SELECT OCR.orden_compra_refacciones_id  AS referencia_id, 
    									   OCR.folio, 'REFACCIONES' AS tipo_referencia
    	 							FROM ordenes_compra_refacciones AS OCR
    	 							WHERE OCR.proveedor_id = $intProveedorID
    	 							AND  (OCR.estatus = 'AUTORIZADO' OR OCR.estatus = 'SURTIDO')
    	 							AND  (OCR.folio LIKE '%$strDescripcion%')
			        				UNION 
			        				SELECT TF.trabajo_foraneo_id  AS referencia_id, 
    									   TF.folio, 'SERVICIO' AS tipo_referencia
    	 							FROM trabajos_foraneos_02 AS TF

    	 							WHERE TF.proveedor_id = $intProveedorID
    	 							AND   TF.estatus = 'AUTORIZADO'
    	 							AND   TF.orden_compra_id IS NULL
    	 							AND   (TF.folio LIKE '%$strDescripcion%')
    	 							UNION
    	 							SELECT OC.orden_compra_id  AS referencia_id, 
    									   OC.folio, 'GENERAL' AS tipo_referencia
    	 							FROM ordenes_compra AS OC
    	 							WHERE OC.proveedor_id = $intProveedorID
    	 							AND  (OC.estatus = 'AUTORIZADO' OR OC.estatus = 'SURTIDO')
    	 							AND  (OC.folio LIKE '%$strDescripcion%')
    	 							ORDER BY folio ASC 
    	 							LIMIT 0, $intLimite");

	    return $strSQL->result();
	}


	/*******************************************************************************************************************
	Funciones de la tabla descuentos_proveedores_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles del descuento
	public function guardar_detalles(stdClass $objDescuentoProveedor)
	{
		/*Quitar | de la lista para obtener el referencia, referencia_id, importe, iva e ieps
		*/
		$arrReferencias = explode("|", $objDescuentoProveedor->strReferencias);
		$arrReferenciaID = explode("|", $objDescuentoProveedor->strReferenciaID);
		$arrImportes = explode("|", $objDescuentoProveedor->strImportes);
		$arrTasaCuotaIva = explode("|", $objDescuentoProveedor->strTasaCuotaIva);
		$arrIvas = explode("|", $objDescuentoProveedor->strIvas);
		$arrTasaCuotaIeps = explode("|", $objDescuentoProveedor->strTasaCuotaIeps);
		$arrIeps = explode("|", $objDescuentoProveedor->strIeps);

		//Hacer recorrido para insertar los datos en la tabla descuentos_proveedores_detalles
		for ($intCon = 0; $intCon < sizeof($arrReferencias); $intCon++) 
		{
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);

			//Separar cadena para obtener la referencia del detalle,  por ejemplo: CARTERA - REFACCIONES será CARTERA
			$arrTipoReferencia = explode(" - ", $arrReferencias[$intCon]);
			
			//Asignar datos al array
			$arrDatos = array('descuento_proveedor_id' => $objDescuentoProveedor->intDescuentoProveedorID,
							  'renglon' => ($intCon + 1),
							  'referencia' => $arrTipoReferencia[0], 
							  'referencia_id' => $arrReferenciaID[$intCon],
							  'importe' => $arrImportes[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva' => $arrIvas[$intCon],
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps' => $arrIeps[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('descuentos_proveedores_detalles', $arrDatos);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intDescuentoProveedorID)
	{
		$this->db->select('DPD.referencia, DPD.referencia_id, DPD.importe, 
						   DPD.tasa_cuota_iva, DPD.iva, DPD.tasa_cuota_ieps, DPD.ieps,
						   TIva.valor_maximo AS porcentaje_iva, TIeps.valor_maximo AS porcentaje_ieps,
						   TIeps.tipo AS tipo_ieps, TIeps.factor AS factor_ieps');
		$this->db->from('descuentos_proveedores_detalles AS DPD');
		$this->db->join('sat_tasa_cuota AS TIva', 'DPD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'DPD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('DPD.descuento_proveedor_id', $intDescuentoProveedorID);
		$this->db->order_by('DPD.renglon', 'ASC');
		return $this->db->get()->result();
	}
}	
?>