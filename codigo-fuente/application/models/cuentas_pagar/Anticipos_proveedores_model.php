<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Anticipos_proveedores_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla anticipos_proveedores
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objAnticipoProveedor)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objAnticipoProveedor->strFolio); 

		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objAnticipoProveedor->intSucursalID, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objAnticipoProveedor->dteFecha,  
						  'moneda_id' => $objAnticipoProveedor->intMonedaID, 
						  'tipo_cambio' => $objAnticipoProveedor->intTipoCambio,
						  'referencia' => $objAnticipoProveedor->strReferencia,
						  'proveedor_id' => $objAnticipoProveedor->intProveedorID,
						  'razon_social' => $objAnticipoProveedor->strRazonSocial,
						  'rfc' => $objAnticipoProveedor->strRfc,
						  'cuenta_bancaria_id' => $objAnticipoProveedor->intCuentaBancariaID,
						  'observaciones' => $objAnticipoProveedor->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objAnticipoProveedor->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('anticipos_proveedores', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objAnticipoProveedor->intAnticipoProveedorID = $this->db->insert_id();
		
		//Hacer un llamado al método para guardar los detalles del anticipo
		$this->guardar_detalles($objAnticipoProveedor);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objAnticipoProveedor->intAnticipoProveedorID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objAnticipoProveedor)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Tabla anticipos_proveedores
		//Asignar datos al array
		$arrDatos = array('fecha' => $objAnticipoProveedor->dteFecha,  
						  'moneda_id' => $objAnticipoProveedor->intMonedaID, 
						  'tipo_cambio' => $objAnticipoProveedor->intTipoCambio,
						  'proveedor_id' => $objAnticipoProveedor->intProveedorID,
						  'razon_social' => $objAnticipoProveedor->strRazonSocial,
						  'rfc' => $objAnticipoProveedor->strRfc,
						  'referencia' => $objAnticipoProveedor->strReferencia,
						  'cuenta_bancaria_id' => $objAnticipoProveedor->intCuentaBancariaID,
						  'observaciones' => $objAnticipoProveedor->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objAnticipoProveedor->intUsuarioID);
		$this->db->where('anticipo_proveedor_id', $objAnticipoProveedor->intAnticipoProveedorID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('anticipos_proveedores', $arrDatos);

	    //Eliminar los detalles guardados
		$this->db->where('anticipo_proveedor_id', $objAnticipoProveedor->intAnticipoProveedorID);
		$this->db->delete('anticipos_proveedores_detalles');
		//Hacer un llamado al método para guardar los detalles del anticipo
		$this->guardar_detalles($objAnticipoProveedor);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intAnticipoProveedorID, $strEstatus)
	{
		//Si el estatus del registro es diferente de INACTIVO
		if($strEstatus != 'INACTIVO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'),
							  'fecha_eliminacion' => NULL,
							  'usuario_eliminacion' => NULL);
		}
		else 
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_eliminacion' => date("Y-m-d H:i:s"),
							  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		}
		$this->db->where('anticipo_proveedor_id', $intAnticipoProveedorID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('anticipos_proveedores', $arrDatos);
	}
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intAnticipoProveedorID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = "WHERE ";

		//Si existe id del anticipo
		if ($intAnticipoProveedorID !== NULL)
		{   
			$strRestricciones .= "AP.anticipo_proveedor_id = $intAnticipoProveedorID";
		}
		else
		{
			$strRestricciones .= "AP.sucursal_id = $intSucursalID";

			//Si existe id del proveedor
			if($intProveedorID > 0)
			{
				$strRestricciones .= " AND AP.proveedor_id = $intProveedorID";
			}

			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$strRestricciones .= " AND (AP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$strRestricciones .= " AND AP.estatus = '$strEstatus'";
			}


			$strRestricciones .= " AND ((AP.folio LIKE '%$strBusqueda%') OR
				    				    (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
					               	    (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
		        				        (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
					                    (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))";

		}

		
		//Formar consulta
		$queryAnticipos = "SELECT AP.anticipo_proveedor_id, AP.folio, 
								   DATE_FORMAT(AP.fecha,'%d/%m/%Y') AS fecha,
								   AP.moneda_id, AP.tipo_cambio, AP.referencia, AP.proveedor_id, 
								   AP.razon_social, AP.rfc, AP.cuenta_bancaria_id, AP.observaciones,
								   AP.estatus,  CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
								   M.codigo AS codigo_moneda, 
								   CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria,
								   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor,
								   P.telefono_principal, P.calle, P.numero_exterior, 
								   P.numero_interior, P.colonia,  
				   				   P.localidad, MP.descripcion AS municipio, EP.descripcion AS estado,
				   				   CP.codigo_postal,
								   IFNULL(Detalles.Subtotal, 0) AS subtotal,
								   IFNULL(Detalles.IVA, 0) AS iva, IFNULL(Detalles.ieps, 0) AS ieps, 
								   IFNULL(Detalles.Total, 0) AS importe,
								   IFNULL(AplicacionAnticipos.Total, 0) AS total_aplicado_anticipo,
								   UC.usuario AS usuario_creacion,
								   DATE_FORMAT(AP.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion
						    FROM anticipos_proveedores AS AP
						    INNER JOIN cuentas_bancarias AS CB ON AP.cuenta_bancaria_id = CB.cuenta_bancaria_id
						    INNER JOIN sat_monedas AS M ON AP.moneda_id = M.moneda_id
						    INNER JOIN proveedores AS P ON AP.proveedor_id = P.proveedor_id
						    INNER JOIN sat_codigos_postales AS CP ON P.codigo_postal_id = CP.codigo_postal_id
						    INNER JOIN municipios AS MP ON P.municipio_id = MP.municipio_id
						    INNER JOIN sat_estados AS EP ON MP.estado_id = EP.estado_id
						    LEFT JOIN usuarios AS UC ON UC.usuario_id = AP.usuario_creacion
						    LEFT JOIN (SELECT Det.anticipo_proveedor_id AS referenciaID,
						                	  SUM(ROUND((Det.subtotal/Reg.tipo_cambio), 2) + 
														 ROUND((Det.iva/Reg.tipo_cambio), 2) + 
														 ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
											  SUM(ROUND((Det.subtotal/Reg.tipo_cambio), 2)) AS Subtotal,
											  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
											  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
					   				   FROM anticipos_proveedores AS Reg
					   				   INNER JOIN anticipos_proveedores_detalles AS Det ON Reg.anticipo_proveedor_id = Det.anticipo_proveedor_id
						    		   GROUP BY Det.anticipo_proveedor_id) AS Detalles ON Detalles.referenciaID = AP.anticipo_proveedor_id
						    LEFT JOIN (SELECT Reg.anticipo_proveedor_id AS referenciaID,
						   					  SUM(ROUND((Det.importe/AP.tipo_cambio), 2) + 
										   		  ROUND((Det.iva/AP.tipo_cambio), 2) + 
						                  		  ROUND((Det.ieps/AP.tipo_cambio), 2)) AS Total
			  			    FROM anticipos_proveedores_aplicacion AS Reg
			  			    INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
			  			    INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
			  			    WHERE Reg.estatus = 'ACTIVO'
			  			    GROUP BY Reg.anticipo_proveedor_id) AS AplicacionAnticipos ON AplicacionAnticipos.referenciaID = AP.anticipo_proveedor_id
						  $strRestricciones
						  ORDER BY AP.fecha DESC, AP.folio DESC";


		$strSQL = $this->db->query($queryAnticipos);
		//Si existe id del anticipo
		if ($intAnticipoProveedorID !== NULL)
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
		$this->db->from('anticipos_proveedores AS AP');
		$this->db->join('cuentas_bancarias AS CB', 'AP.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$this->db->join('sat_monedas AS M', 'AP.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'AP.proveedor_id = P.proveedor_id', 'inner');
		$this->db->where('AP.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del proveedor
		if($intProveedorID > 0)
		{
			$this->db->where('AP.proveedor_id', $intProveedorID);
		}

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(AP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('AP.estatus', $strEstatus);
		}

	   $this->db->where("((AP.folio LIKE '%$strBusqueda%') OR
		    			  (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
			              (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
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
		$this->db->where('AP.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del proveedor
		if($intProveedorID != NULL)
	    {
	    	$this->db->where("AP.proveedor_id", $intProveedorID);
	    } 

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("AP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('AP.estatus', $strEstatus);
		}

	   $this->db->where("((AP.folio LIKE '%$strBusqueda%') OR
		    			  (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
			              (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
        				  (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			              (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
	    
		$this->db->from('anticipos_proveedores AS AP');
		$this->db->join('cuentas_bancarias AS CB', 'AP.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$this->db->join('sat_monedas AS M', 'AP.moneda_id = M.moneda_id', 'inner');
 		$this->db->join('proveedores AS P', 'AP.proveedor_id = P.proveedor_id', 'inner');	
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("AP.anticipo_proveedor_id, AP.folio,
					       DATE_FORMAT(AP.fecha,'%d/%m/%Y') AS fecha, AP.estatus,
					       CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor,
					       CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria, 
					       CONCAT('$',FORMAT(IFNULL((SELECT SUM((ROUND((Det.subtotal/AP.tipo_cambio), 2) + 
										                         ROUND((Det.iva/AP.tipo_cambio), 2) + 
										                         ROUND((Det.ieps/AP.tipo_cambio), 2)))
								   FROM anticipos_proveedores_detalles AS Det
								   WHERE Det.anticipo_proveedor_id = AP.anticipo_proveedor_id),0),2)) AS total", FALSE);
		$this->db->from('anticipos_proveedores AS AP');
		$this->db->join('cuentas_bancarias AS CB', 'AP.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$this->db->join('sat_monedas AS M', 'AP.moneda_id = M.moneda_id', 'inner');
 		$this->db->join('proveedores AS P', 'AP.proveedor_id = P.proveedor_id', 'inner');	
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
	    $this->db->where('AP.sucursal_id', $this->session->userdata('sucursal_id'));
	    //Si existe id del proveedor
		if($intProveedorID != NULL)
	    {
	    	$this->db->where("AP.proveedor_id", $intProveedorID);
	    } 
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("AP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('AP.estatus', $strEstatus);
		}

	   $this->db->where("((AP.folio LIKE '%$strBusqueda%') OR
		    			  (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
			              (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
        				  (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			              (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
	    
		$this->db->order_by('AP.fecha DESC, AP.folio DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["anticipos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select("AP.anticipo_proveedor_id,
						   CONCAT(AP.folio, ' - ', P.razon_social) AS anticipo_proveedor", FALSE);
        $this->db->from('anticipos_proveedores AS AP');
        $this->db->join('proveedores AS P', 'AP.proveedor_id = P.proveedor_id', 'inner');		
		$this->db->where("(AP.estatus = 'ACTIVO' OR AP.estatus = 'PARCIALMENTE APLICADO')", NULL, FALSE);
        $this->db->where("(AP.folio LIKE '%$strDescripcion%' OR 
        				   P.razon_social LIKE '%$strDescripcion%')"); 
		$this->db->order_by('AP.folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}


	/*******************************************************************************************************************
	Funciones de la tabla anticipos_proveedores_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles del anticipo
	public function guardar_detalles(stdClass $objAnticipoProveedor)
	{

		/*Quitar | de la lista para obtener el concepto, subtotal, iva e ieps
		*/
		$arrConceptos = explode("|", $objAnticipoProveedor->strConceptos);
		$arrSubtotales = explode("|", $objAnticipoProveedor->strSubtotales);
		$arrTasaCuotaIva = explode("|", $objAnticipoProveedor->strTasaCuotaIva);
		$arrIvas = explode("|", $objAnticipoProveedor->strIvas);
		$arrTasaCuotaIeps = explode("|", $objAnticipoProveedor->strTasaCuotaIeps);
		$arrIeps = explode("|", $objAnticipoProveedor->strIeps);

		//Hacer recorrido para insertar los datos en la tabla anticipos_proveedores_detalles
		for ($intCon = 0; $intCon < sizeof($arrConceptos); $intCon++) 
		{
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);

			//Asignar datos al array
			$arrDatos = array('anticipo_proveedor_id' => $objAnticipoProveedor->intAnticipoProveedorID,
							  'renglon' => ($intCon + 1),
							  'concepto' => $arrConceptos[$intCon], 
							  'subtotal' => $arrSubtotales[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva' => $arrIvas[$intCon], 
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps' => $arrIeps[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('anticipos_proveedores_detalles', $arrDatos);
		}

	}


	//Método para regresar los detalles de un registro
	public function buscar_detalles($intAnticipoProveedorID)
	{
		$this->db->select("APD.renglon, APD.concepto, APD.subtotal, 
						   APD.tasa_cuota_iva, APD.iva, APD.tasa_cuota_ieps, 
						   APD.ieps, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps", FALSE);
		$this->db->from('anticipos_proveedores_detalles AS APD');
		$this->db->join('sat_tasa_cuota AS TIva', 'APD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'APD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('APD.anticipo_proveedor_id', $intAnticipoProveedorID);
		$this->db->order_by('APD.renglon', 'ASC');
		return $this->db->get()->result();
	}
}
?>