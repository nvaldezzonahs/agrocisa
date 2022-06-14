<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de anticipos a proveedores
include_once(APPPATH . 'models/cuentas_pagar/Anticipos_proveedores_model.php');

class Anticipos_proveedores_aplicacion_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla anticipos_proveedores_aplicacion
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objAplicacionAnticipo)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        //Se crea una instancia de la clase modelo (anticipos a proveedores) 
        $otdModelAnticiposProveedores = new  Anticipos_proveedores_model();
        

		//Tabla anticipos_proveedores_aplicacion
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objAplicacionAnticipo->strFolio); 

		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objAplicacionAnticipo->intSucursalID, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objAplicacionAnticipo->dteFecha,  
						  'anticipo_proveedor_id' => $objAplicacionAnticipo->intAnticipoProveedorID, 
						  'observaciones' => $objAplicacionAnticipo->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objAplicacionAnticipo->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('anticipos_proveedores_aplicacion', $arrDatos);
		//Agregar id del nuevo registro al objeto
		$objAplicacionAnticipo->intAnticipoProveedorAplicacionID = $this->db->insert_id();
		
		//Hacer un llamado al método para guardar los detalles de la aplicación de anticipo
		$this->guardar_detalles($objAplicacionAnticipo);

	    //Hacer un llamado al método para modificar el estatus del anticipo
		$otdModelAnticiposProveedores->set_estatus($objAplicacionAnticipo->intAnticipoProveedorID, 
												   $objAplicacionAnticipo->strEstatusAnticipoProveedor);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
		
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objAplicacionAnticipo)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (anticipos a proveedores) 
        $otdModelAnticiposProveedores = new  Anticipos_proveedores_model();

		//Tabla anticipos_proveedores_aplicacion
		//Asignar datos al array
		$arrDatos = array('fecha' => $objAplicacionAnticipo->dteFecha,  
						  'anticipo_proveedor_id' => $objAplicacionAnticipo->intAnticipoProveedorID, 
						  'observaciones' => $objAplicacionAnticipo->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objAplicacionAnticipo->intUsuarioID);
		$this->db->where('anticipo_proveedor_aplicacion_id', $objAplicacionAnticipo->intAnticipoProveedorAplicacionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('anticipos_proveedores_aplicacion', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('anticipo_proveedor_aplicacion_id', $objAplicacionAnticipo->intAnticipoProveedorAplicacionID);
		$this->db->delete('anticipos_proveedores_aplicacion_detalles');
		//Hacer un llamado al método para guardar los detalles de la aplicación de anticipo
		$this->guardar_detalles($objAplicacionAnticipo);

		//Hacer un llamado al método para modificar el estatus del anticipo
		$otdModelAnticiposProveedores->set_estatus($objAplicacionAnticipo->intAnticipoProveedorID, 
												   $objAplicacionAnticipo->strEstatusAnticipoProveedor);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intAnticipoProveedorAplicacionID)
	{

		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('anticipo_proveedor_aplicacion_id', $intAnticipoProveedorAplicacionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('anticipos_proveedores_aplicacion', $arrDatos);
	}
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intAnticipoProveedorAplicacionID = NULL,  $dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL, $intProveedorID = NULL, $strEstatus = NULL, 
						   $strBusqueda =  NULL)
	{
		
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = "WHERE ";

		//Si existe id de la aplicación de anticipo
		if ($intAnticipoProveedorAplicacionID !== NULL)
		{   
			$strRestricciones .= "APA.anticipo_proveedor_aplicacion_id = $intAnticipoProveedorAplicacionID";
		}
		else
		{

			$strRestricciones .= "APA.sucursal_id = $intSucursalID";
			//Si existe id del proveedor
			if($intProveedorID > 0)
			{
				$strRestricciones .= " AND AP.proveedor_id = $intProveedorID";
			}

			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$strRestricciones .= " AND (APA.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$strRestricciones .= " AND APA.estatus = '$strEstatus'";
			}


			$strRestricciones .= " AND ((APA.folio LIKE '%$strBusqueda%') OR
										(AP.folio LIKE '%$strBusqueda%') OR
		        				        (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
					                    (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))";

		}


		//Formar consulta
		$queryAplicaciones = "SELECT APA.anticipo_proveedor_aplicacion_id, APA.folio, 
										   DATE_FORMAT(APA.fecha,'%d/%m/%Y') AS fecha,
										   APA.anticipo_proveedor_id, APA.observaciones, APA.estatus,
										   AP.folio AS folio_anticipo,
										   AP.moneda_id, AP.tipo_cambio, AP.referencia, AP.proveedor_id, 
										   AP.razon_social, AP.rfc,
										   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
										   M.codigo AS codigo_moneda, 
										   CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria,
										   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor,
										   P.telefono_principal, P.calle, P.numero_exterior, 
										   P.numero_interior, P.colonia,  P.localidad, 
										   MP.descripcion AS municipio, EP.descripcion AS estado,
						   				   CP.codigo_postal,
						   				   IFNULL(DetallesAnt.Subtotal, 0) AS subtotal,
										   IFNULL(DetallesAnt.IVA, 0) AS iva, 
										   IFNULL(DetallesAnt.ieps, 0) AS ieps, 
										   IFNULL(DetallesAnt.Total, 0) AS importe,
										   IFNULL(AplicacionAnticipos.Total, 0) AS total_aplicado_anticipo,
										   UC.usuario AS usuario_creacion,
						  				   DATE_FORMAT(APA.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion, 
						  				   ROUND((Detalles.Importe/AP.tipo_cambio), 2) AS subtotal_detalles,
								  		   ROUND((Detalles.IVA/AP.tipo_cambio), 2) AS iva_detalles,
								   		   ROUND((Detalles.IEPS/AP.tipo_cambio), 2) AS ieps_detalles 
						  		    FROM anticipos_proveedores_aplicacion AS APA
						  		    INNER JOIN (SELECT Reg.anticipo_proveedor_id AS referenciaID,
								   					  SUM(ROUND((Det.importe/AP.tipo_cambio), 2) + 
												   		  ROUND((Det.iva/AP.tipo_cambio), 2) + 
								                  		  ROUND((Det.ieps/AP.tipo_cambio), 2)) AS Total
								  			   FROM anticipos_proveedores_aplicacion AS Reg
								  			   INNER JOIN anticipos_proveedores AS AP ON Reg.anticipo_proveedor_id = AP.anticipo_proveedor_id
								  			   INNER JOIN anticipos_proveedores_aplicacion_detalles AS Det ON Reg.anticipo_proveedor_aplicacion_id = Det.anticipo_proveedor_aplicacion_id
								  			   WHERE Reg.estatus = 'ACTIVO'
								  			   GROUP BY Reg.anticipo_proveedor_id) AS AplicacionAnticipos ON AplicacionAnticipos.referenciaID = APA.anticipo_proveedor_id
								  	INNER JOIN (SELECT Det.anticipo_proveedor_aplicacion_id AS referenciaID,
								                  	   SUM(Det.importe) AS Importe, 
										    	 	   SUM(Det.iva) AS IVA,
										    	       SUM(Det.ieps) AS IEPS
								  			   FROM anticipos_proveedores_aplicacion_detalles AS Det
								  			   GROUP BY Det.anticipo_proveedor_aplicacion_id) AS Detalles ON Detalles.referenciaID = APA.anticipo_proveedor_aplicacion_id	
						  		    INNER JOIN anticipos_proveedores AS AP ON APA.anticipo_proveedor_id = AP.anticipo_proveedor_id
						  		    INNER JOIN cuentas_bancarias AS CB ON AP.cuenta_bancaria_id = CB.cuenta_bancaria_id
						  		    INNER JOIN sat_monedas AS M ON AP.moneda_id = M.moneda_id
						  		    INNER JOIN proveedores AS P ON AP.proveedor_id = P.proveedor_id
						  		    INNER JOIN sat_codigos_postales AS CP ON P.codigo_postal_id = CP.codigo_postal_id
								    INNER JOIN municipios AS MP ON P.municipio_id = MP.municipio_id
								    INNER JOIN sat_estados AS EP ON MP.estado_id = EP.estado_id
								    LEFT JOIN usuarios AS UC ON UC.usuario_id = APA.usuario_creacion
								    LEFT JOIN (SELECT Det.anticipo_proveedor_id AS referenciaID,
								                	  SUM(ROUND((Det.subtotal/Reg.tipo_cambio), 2) + 
																 ROUND((Det.iva/Reg.tipo_cambio), 2) + 
																 ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS Total, 
													  SUM(ROUND((Det.subtotal/Reg.tipo_cambio), 2)) AS Subtotal,
													  SUM(ROUND((Det.iva/Reg.tipo_cambio), 2)) AS IVA,
													  SUM(ROUND((Det.ieps/Reg.tipo_cambio), 2)) AS IEPS
							   				   FROM anticipos_proveedores AS Reg
							   				   INNER JOIN anticipos_proveedores_detalles AS Det ON Reg.anticipo_proveedor_id = Det.anticipo_proveedor_id
								    		   GROUP BY Det.anticipo_proveedor_id) AS DetallesAnt ON DetallesAnt.referenciaID = APA.anticipo_proveedor_id
								    $strRestricciones
								    ORDER BY APA.fecha DESC, APA.folio DESC";

		$strSQL = $this->db->query($queryAplicaciones);
		//Si existe id de la aplicación de anticipo
		if ($intAnticipoProveedorAplicacionID !== NULL)
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
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProveedorID = NULL, 
						   					 $strEstatus = NULL, $strBusqueda =  NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('anticipos_proveedores_aplicacion AS APA');
		$this->db->join('anticipos_proveedores AS AP', 'APA.anticipo_proveedor_id = AP.anticipo_proveedor_id', 'inner');
		$this->db->join('proveedores AS P', 'AP.proveedor_id = P.proveedor_id', 'inner');	
		$this->db->join('sat_monedas AS M', 'AP.moneda_id = M.moneda_id', 'inner');
		$this->db->where('APA.sucursal_id', $this->session->userdata('sucursal_id'));
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del proveedor
		if($intProveedorID > 0)
		{
			$this->db->where('AP.proveedor_id', $intProveedorID);
		}

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(APA.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('APA.estatus', $strEstatus);
		}

		$this->db->where("((APA.folio LIKE '%$strBusqueda%') OR
						   (AP.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar el total de aplicaciones activas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_total_aplicaciones_anticipo_proveedor($intAnticipoProveedorID)
	{
		$this->db->select('COUNT(anticipo_proveedor_aplicacion_id) AS total_aplicaciones');
		$this->db->from('anticipos_proveedores_aplicacion');
		$this->db->where('anticipo_proveedor_id', $intAnticipoProveedorID);
		$this->db->where('estatus', 'ACTIVO');
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProveedorID = NULL, 
						   $strEstatus = NULL, $strBusqueda =  NULL, $intNumRows, $intPos)
	{	
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('APA.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del proveedor
		if($intProveedorID != NULL)
	    {
	    	$this->db->where("AP.proveedor_id", $intProveedorID);
	    } 

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(APA.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('APA.estatus', $strEstatus);
		}

		$this->db->where("((APA.folio LIKE '%$strBusqueda%') OR
						   (AP.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
	    
		$this->db->from('anticipos_proveedores_aplicacion AS APA');
	    $this->db->join('anticipos_proveedores AS AP', 'APA.anticipo_proveedor_id = AP.anticipo_proveedor_id', 'inner');
		$this->db->join('cuentas_bancarias AS CB', 'AP.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$this->db->join('sat_monedas AS M', 'AP.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'AP.proveedor_id = P.proveedor_id', 'inner');
	    $this->db->join('sat_codigos_postales AS C', 'P.codigo_postal_id = C.codigo_postal_id', 'inner');
	    $this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'MP.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS PP', 'E.pais_id = PP.pais_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("APA.anticipo_proveedor_aplicacion_id, APA.folio, 
						   DATE_FORMAT(APA.fecha,'%d/%m/%Y') AS fecha,
						   APA.anticipo_proveedor_id, APA.estatus, AP.folio AS folio_anticipo,
					       CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, 
					       CONCAT('$',FORMAT(IFNULL((SELECT SUM((ROUND((Det.importe/AP.tipo_cambio), 2) + 
										                         ROUND((Det.iva/AP.tipo_cambio), 2) + 
										                         ROUND((Det.ieps/AP.tipo_cambio), 2)))
												    FROM anticipos_proveedores_aplicacion_detalles AS Det
												    WHERE Det.anticipo_proveedor_aplicacion_id = APA.anticipo_proveedor_aplicacion_id),0),2)) AS importe_aplicado", FALSE);
	    $this->db->from('anticipos_proveedores_aplicacion AS APA');
	    $this->db->join('anticipos_proveedores AS AP', 'APA.anticipo_proveedor_id = AP.anticipo_proveedor_id', 'inner');
		$this->db->join('cuentas_bancarias AS CB', 'AP.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$this->db->join('sat_monedas AS M', 'AP.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'AP.proveedor_id = P.proveedor_id', 'inner');
	    $this->db->join('sat_codigos_postales AS C', 'P.codigo_postal_id = C.codigo_postal_id', 'inner');
	    $this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'MP.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS PP', 'E.pais_id = PP.pais_id', 'inner');
		$this->db->where('APA.sucursal_id', $this->session->userdata('sucursal_id'));
	    //Si existe id del proveedor
		if($intProveedorID != NULL)
	    {
	    	$this->db->where("AP.proveedor_id", $intProveedorID);
	    } 
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(APA.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('APA.estatus', $strEstatus);
		}

		$this->db->where("((APA.folio LIKE '%$strBusqueda%') OR
						   (AP.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('APA.fecha DESC, APA.folio DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["anticipos_aplicacion"] =$this->db->get()->result();
		return $arrResultado;
	}

	/*******************************************************************************************************************
	Funciones de la tabla anticipos_proveedores_aplicacion_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la aplicación de anticipo
	public function guardar_detalles(stdClass $objAplicacionAnticipo)
	{
		/*Quitar | de la lista para obtener el referencia, referencia_id, importe, iva e ieps
		*/
		$arrReferencias = explode("|", $objAplicacionAnticipo->strReferencias);
		$arrReferenciaID = explode("|", $objAplicacionAnticipo->strReferenciaID);
		$arrImportes = explode("|", $objAplicacionAnticipo->strImportes);
		$arrTasaCuotaIva = explode("|", $objAplicacionAnticipo->strTasaCuotaIva);
		$arrIvas = explode("|", $objAplicacionAnticipo->strIvas);
		$arrTasaCuotaIeps = explode("|", $objAplicacionAnticipo->strTasaCuotaIeps);
		$arrIeps = explode("|", $objAplicacionAnticipo->strIeps);

		//Hacer recorrido para insertar los datos en la tabla anticipos_proveedores_aplicacion_detalles
		for ($intCon = 0; $intCon < sizeof($arrReferencias); $intCon++) 
		{
			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);

			//Separar cadena para obtener la referencia del detalle,  por ejemplo: CARTERA - REFACCIONES será CARTERA
			$arrTipoReferencia = explode(" - ", $arrReferencias[$intCon]);
			
			//Asignar datos al array
			$arrDatos = array('anticipo_proveedor_aplicacion_id' => $objAplicacionAnticipo->intAnticipoProveedorAplicacionID,
							  'renglon' => ($intCon + 1),
							  'referencia' => $arrTipoReferencia[0], 
							  'referencia_id' => $arrReferenciaID[$intCon],
							  'importe' => $arrImportes[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva' => $arrIvas[$intCon],
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps' => $arrIeps[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('anticipos_proveedores_aplicacion_detalles', $arrDatos);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intAnticipoProveedorAplicacionID)
	{
		$this->db->select('APAD.referencia, APAD.referencia_id, APAD.importe, 
						   APAD.tasa_cuota_iva, APAD.iva, APAD.tasa_cuota_ieps, APAD.ieps,
						   TIva.valor_maximo AS porcentaje_iva, TIeps.valor_maximo AS porcentaje_ieps,
						   TIeps.tipo AS tipo_ieps, TIeps.factor AS factor_ieps');
		$this->db->from('anticipos_proveedores_aplicacion_detalles AS APAD');
		$this->db->join('sat_tasa_cuota AS TIva', 'APAD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'APAD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->where('APAD.anticipo_proveedor_aplicacion_id', $intAnticipoProveedorAplicacionID);
		$this->db->order_by('APAD.renglon', 'ASC');
		return $this->db->get()->result();
	}
}
?>