<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');

class Ordenes_reparacion_internas_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla ordenes_reparacion_internas
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objOrdenReparacionInterna)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objOrdenReparacionInterna->strFolio); 

		//Tabla ordenes_reparacion_internas
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objOrdenReparacionInterna->intSucursalID,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objOrdenReparacionInterna->dteFecha, 
						  'servicio_interno_tipo_id' => $objOrdenReparacionInterna->intServicioInternoTipoID,
						  'vehiculo_id' => $objOrdenReparacionInterna->intVehiculoID,
						  'serie' => $objOrdenReparacionInterna->strSerie,
						  'motor' => $objOrdenReparacionInterna->strMotor,
						  'kilometraje' => $objOrdenReparacionInterna->intKilometraje,
						  'falla' => $objOrdenReparacionInterna->strFalla,
						  'causa' => $objOrdenReparacionInterna->strCausa,
						  'solucion' => $objOrdenReparacionInterna->strSolucion,
						  'observaciones' => $objOrdenReparacionInterna->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objOrdenReparacionInterna->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('ordenes_reparacion_internas', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objOrdenReparacionInterna->intOrdenReparacionInternaID = $this->db->insert_id();


		//Hacer un llamado al método para guardar los servicios de la orden de reparación interna
		$this->guardar_servicios($objOrdenReparacionInterna);

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
	public function modificar(stdClass $objOrdenReparacionInterna)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla ordenes_reparacion_internas
		//Asignar datos al array
		$arrDatos = array('fecha' => $objOrdenReparacionInterna->dteFecha, 
						  'servicio_interno_tipo_id' => $objOrdenReparacionInterna->intServicioInternoTipoID,
						  'vehiculo_id' => $objOrdenReparacionInterna->intVehiculoID,
						  'serie' => $objOrdenReparacionInterna->strSerie,
						  'motor' => $objOrdenReparacionInterna->strMotor,
						  'kilometraje' => $objOrdenReparacionInterna->intKilometraje,
						  'falla' => $objOrdenReparacionInterna->strFalla,
						  'causa' => $objOrdenReparacionInterna->strCausa,
						  'solucion' => $objOrdenReparacionInterna->strSolucion,
						  'observaciones' => $objOrdenReparacionInterna->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objOrdenReparacionInterna->intUsuarioID);
		$this->db->where('orden_reparacion_interna_id', $objOrdenReparacionInterna->intOrdenReparacionInternaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('ordenes_reparacion_internas', $arrDatos);

		//Eliminar los servicios guardados
		$this->db->where('orden_reparacion_interna_id', $objOrdenReparacionInterna->intOrdenReparacionInternaID);
		$this->db->delete('ordenes_reparacion_internas_servicios');
		//Hacer un llamado al método para guardar los servicios de la orden de reparación interna
		$this->guardar_servicios($objOrdenReparacionInterna);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intOrdenReparacionInternaID, $strEstatus, $intPolizaID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Dependiendo del estatus actualizar el registro
		if($strEstatus == 'ACTIVO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'),
							  'fecha_eliminacion' => NULL,
							  'usuario_eliminacion' => NULL);
		}
		else if ($strEstatus == 'INACTIVO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_eliminacion' => date("Y-m-d H:i:s"),
							  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		}
		else if ($strEstatus == 'FINALIZADO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_finalizacion' => date("Y-m-d H:i:s"),
							  'usuario_finalizacion' =>  $this->session->userdata('usuario_id'));
		}
		else //REACTIVAR
		{


			//Si existe el id de la póliza
			if($intPolizaID > 0)
			{
				//Se crea una instancia de la clase modelo (pólizas) 
        		$otdModelPolizas = new Polizas_model();
				//Hacer un llamado al método para modificar el estatus de la póliza 
				$otdModelPolizas->set_estatus($intPolizaID, 'INACTIVO');
			}


			//Asignar datos al array
			$arrDatos = array('estatus' => 'ACTIVO',
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'),
							  'fecha_finalizacion' => NULL,
							  'usuario_finalizacion' => NULL);

		}
		$this->db->where('orden_reparacion_interna_id', $intOrdenReparacionInternaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('ordenes_reparacion_internas', $arrDatos);



		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intOrdenReparacionInternaID = NULL, $dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL, $intVehiculoID = NULL, $strEstatus = NULL, 
						   $strBusqueda =  NULL)
	{
		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('CONTROL DE VEHICULOS');
		$strProcesoPoliza = $this->db->escape('ORDEN DE TRABAJO');

		$this->db->select("ORI.orden_reparacion_interna_id, 
						   ORI.folio, DATE_FORMAT(ORI.fecha,'%d/%m/%Y') AS fecha, 
							ORI.servicio_interno_tipo_id, ORI.vehiculo_id,
							ORI.serie, ORI.motor, ORI.kilometraje, ORI.falla, 
		                   	ORI.causa, ORI.solucion, ORI.observaciones,	ORI.estatus, 
					       	DATE_FORMAT(ORI.fecha_finalizacion,'%d/%m/%Y') AS fecha_finalizacion,
					        SIT.descripcion AS servicio_interno_tipo,
					       	CASE 
							   WHEN  ORI.vehiculo_id > 0 
							   		THEN CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas)
								    ELSE '' 
						   	END AS vehiculo,
					       	V.codigo AS codigo_vehiculo, 
					       	V.modelo AS modelo_vehiculo, 
					       	V.marca AS marca_vehiculo, 
					       	V.placas AS placas_vehiculo, 
					       	UF.usuario AS usuario_finalizacion, 
					       	UC.usuario AS usuario_creacion,
					       	DATE_FORMAT(ORI.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion,
					       	IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza", FALSE);
		$this->db->from('ordenes_reparacion_internas AS ORI');
        $this->db->join('servicios_internos_tipos AS SIT', 'ORI.servicio_interno_tipo_id = SIT.servicio_interno_tipo_id', 'inner');
		$this->db->join('vehiculos AS V', 'ORI.vehiculo_id = V.vehiculo_id', 'left');
		$this->db->join('usuarios AS UF', 'ORI.usuario_finalizacion = UF.usuario_id', 'left');
		$this->db->join('usuarios AS UC', 'ORI.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND ORI.orden_reparacion_interna_id = PF.referencia_id
	    							      AND PF.estatus = "ACTIVO"', 'left');
		
		//Si existe id de la orden de reparación interna
		if ($intOrdenReparacionInternaID !== NULL)
		{   
			$this->db->where('ORI.orden_reparacion_interna_id', $intOrdenReparacionInternaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('ORI.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del vehículo
		    if($intVehiculoID > 0)
		    {
		   		$this->db->where('ORI.vehiculo_id', $intVehiculoID);
		    }
		    //Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(ORI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 
			
			//Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(ORI.estatus = 'FINALIZADO')");
				}
				else
				{
					$this->db->where('ORI.estatus', $strEstatus);
				}
			}
		

			$this->db->where("((ORI.folio LIKE '%$strBusqueda%') OR
							   (SIT.descripcion LIKE '%$strBusqueda%') OR
							   (ORI.serie LIKE '%$strBusqueda%') OR 
							   (CONCAT_WS(' - ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%') OR 
							   (CONCAT_WS(' ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%'))");

			$this->db->order_by('ORI.fecha DESC, ORI.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
											 $intVehiculoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;
        
		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('ordenes_reparacion_internas AS ORI');
		$this->db->join('servicios_internos_tipos AS SIT', 'ORI.servicio_interno_tipo_id = SIT.servicio_interno_tipo_id', 'inner');
		$this->db->join('trabajos_foraneos_internos AS TFI', 
						'ORI.orden_reparacion_interna_id = TFI.orden_reparacion_interna_id', 'inner');
		$this->db->join('sat_monedas AS M', 'TFI.moneda_id = M.moneda_id', 'inner');
		$this->db->join('vehiculos AS V', 'ORI.vehiculo_id = V.vehiculo_id', 'left');
		$this->db->where('ORI.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('TFI.estatus', 'ACTIVO');
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del vehículo
	    if($intVehiculoID > 0)
	    {
	   		$this->db->where('ORI.vehiculo_id', $intVehiculoID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(ORI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
		//Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('ORI.estatus', $strEstatus);
		}

	   $this->db->where("((ORI.folio LIKE '%$strBusqueda%') OR
						   (SIT.descripcion LIKE '%$strBusqueda%') OR
						   (ORI.serie LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' - ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%'))");

		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}


	//Método para regresar los datos de un registro (se utiliza para generar póliza)
	public function buscar_referencia_poliza($intOrdenReparacionInternaID)
	{
	
		//Ordenes de reparación
		$queryReferencia = "SELECT OREP.orden_reparacion_interna_id AS referencia_id, 
							       OREP.sucursal_id, OREP.folio, 
							       OREP.fecha_finalizacion AS fecha, OREP.estatus, 
							       OREP.servicio_interno_tipo_id, OREP.serie, 
							       V.codigo, V.modelo, V.marca, V.placas,
							       V.modulo_id, V.sucursal_id AS SucVeh, V.departamento_id
							FROM  ordenes_reparacion_internas AS OREP
							LEFT JOIN vehiculos V ON OREP.vehiculo_id = V.vehiculo_id
							WHERE OREP.orden_reparacion_interna_id = $intOrdenReparacionInternaID";
		//Ejecutar consulta
		$strSQL = $this->db->query($queryReferencia);
		return $strSQL->row();
	}



	//Método para regresar los detalles de un registro (se utiliza para generar póliza)
	public function buscar_detalles_poliza($intOrdenReparacionInternaID)
	{

		//Constante para identificar al tipo de movimiento salida de refacciones internas
		$intMovSalidaInterna = SALIDA_REFACCIONES_INTERNAS;
		//Constante para identificar al tipo de movimiento entrada de refacciones internas por devolución del taller
		$intMovEntradaDevolucion = ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER;

		
	    $queryDetalles ="SELECT RR.orden_reparacion_interna_id AS referencia_id, 
	    						'REFACCIONES' AS Tipo,
							   SUM(MRD.cantidad * MRD.costo_unitario) AS Costo
						FROM   requisiciones_refacciones_internas AS RR 
							INNER JOIN movimientos_refacciones_internas AS MR 
								  ON RR.requisicion_refacciones_internas_id = MR.referencia_id 
								  AND MR.tipo_movimiento = $intMovSalidaInterna 
						    INNER JOIN movimientos_refacciones_internas_detalles AS MRD 
						    	  ON MR.movimiento_refacciones_internas_id = MRD.movimiento_refacciones_internas_id 
					    WHERE  RR.orden_reparacion_interna_id = $intOrdenReparacionInternaID
						AND    RR.estatus <> 'INACTIVO'
					    AND    MR.estatus <> 'INACTIVO'
						GROUP BY RR.orden_reparacion_interna_id";
		$queryDetalles.=" UNION ";
		$queryDetalles.="SELECT RR.orden_reparacion_interna_id, 
							   'REFACCIONES' AS Tipo, 
					   			SUM(MRDE.cantidad * MRDE.costo_unitario * -1) AS Costo 
						 FROM   requisiciones_refacciones_internas AS RR 
						 INNER JOIN movimientos_refacciones_internas AS MR
							   ON RR.requisicion_refacciones_internas_id = MR.referencia_id 
							   AND MR.tipo_movimiento = $intMovSalidaInterna 
					     INNER JOIN movimientos_refacciones_internas_detalles AS MRD 
						   	   ON MR.movimiento_refacciones_internas_id = MRD.movimiento_refacciones_internas_id 
						 INNER JOIN movimientos_refacciones_internas AS MRE 
							   ON MRE.referencia_id = MR.movimiento_refacciones_internas_id 
							   AND MRE.tipo_movimiento = $intMovEntradaDevolucion
					     INNER JOIN movimientos_refacciones_internas_detalles AS MRDE 
							   ON MRE.movimiento_refacciones_internas_id = MRDE.movimiento_refacciones_internas_id
			   				   AND MRD.renglon = MRDE.renglon 
							   AND MRD.refaccion_id = MRDE.refaccion_id 
						 WHERE  RR.orden_reparacion_interna_id = $intOrdenReparacionInternaID
						 AND    RR.estatus <> 'INACTIVO' 
						 AND    MR.estatus <> 'INACTIVO' 
					     AND    MRE.estatus <> 'INACTIVO'
						 GROUP BY RR.orden_reparacion_interna_id";
	    $queryDetalles.=" UNION ";
	    $queryDetalles.="SELECT TF.orden_reparacion_interna_id, 
	    					    'FORANEOS' AS Tipo, 
					    	    SUM(TFD.cantidad * (TFD.costo_unitario + TFD.ieps_unitario)) AS Costo 
						 FROM   trabajos_foraneos_internos AS TF 
						 INNER JOIN trabajos_foraneos_internos_detalles AS TFD
						       ON TF.trabajo_foraneo_interno_id = TFD.trabajo_foraneo_interno_id
						 WHERE  TF.orden_reparacion_interna_id =  $intOrdenReparacionInternaID
						 AND    TF.estatus <> 'INACTIVO'
						 GROUP BY TF.orden_reparacion_interna_id
						 ORDER BY Tipo";

		//Ejecutar consulta
		$strSQL = $this->db->query($queryDetalles);
		return $strSQL->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intVehiculoID = NULL, 
						   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('CONTROL DE VEHICULOS');
		$strProcesoPoliza = $this->db->escape('ORDEN DE TRABAJO');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('ORI.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del vehículo
	    if($intVehiculoID  != NULL)
	    {
	   		$this->db->where('ORI.vehiculo_id', $intVehiculoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(ORI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    
	    ///Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(ORI.estatus = 'FINALIZADO')");
			}
			else
			{
				$this->db->where('ORI.estatus', $strEstatus);
			}
		}

		$this->db->where("((ORI.folio LIKE '%$strBusqueda%') OR
						   (SIT.descripcion LIKE '%$strBusqueda%') OR
						   (ORI.serie LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' - ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%'))");

		$this->db->from('ordenes_reparacion_internas AS ORI');
	    $this->db->join('servicios_internos_tipos AS SIT', 'ORI.servicio_interno_tipo_id = SIT.servicio_interno_tipo_id', 'inner');
		$this->db->join('vehiculos AS V', 'ORI.vehiculo_id = V.vehiculo_id', 'left');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND ORI.orden_reparacion_interna_id = PF.referencia_id
	    							      AND PF.estatus = "ACTIVO"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("ORI.orden_reparacion_interna_id, ORI.folio, 
						   DATE_FORMAT(ORI.fecha,'%d/%m/%Y') AS fecha,
						   ORI.serie, ORI.estatus, SIT.descripcion AS servicio_interno_tipo,
						   CASE 
							   WHEN  ORI.vehiculo_id > 0 
							   		THEN CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas)
								    ELSE '' 
						   	END AS vehiculo, 
						   	IFNULL(PF.poliza_id, 0) AS poliza_id, 
						    PF.folio AS folio_poliza", FALSE);
		$this->db->from('ordenes_reparacion_internas AS ORI');
		$this->db->join('servicios_internos_tipos AS SIT', 'ORI.servicio_interno_tipo_id = SIT.servicio_interno_tipo_id', 'inner');
		$this->db->join('vehiculos AS V', 'ORI.vehiculo_id = V.vehiculo_id', 'left');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND ORI.orden_reparacion_interna_id = PF.referencia_id
	    							      AND PF.estatus = "ACTIVO"', 'left');



		$this->db->where('ORI.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del vehículo
	    if($intVehiculoID  != NULL)
	    {
	   		$this->db->where('ORI.vehiculo_id', $intVehiculoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(ORI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    
	   //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(ORI.estatus = 'FINALIZADO')");
			}
			else
			{
				$this->db->where('ORI.estatus', $strEstatus);
			}
		}

		$this->db->where("((ORI.folio LIKE '%$strBusqueda%') OR
						   (SIT.descripcion LIKE '%$strBusqueda%') OR
						   (ORI.serie LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' - ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%'))");

		$this->db->order_by('ORI.fecha DESC, ORI.folio DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["ordenes"] =$this->db->get()->result();
		return $arrResultado;
	}


	

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select("ORI.orden_reparacion_interna_id, ORI.folio, ORI.vehiculo_id,
						   ORI.serie, CONCAT_WS(' ', codigo, '-', modelo, marca, placas) AS vehiculo", FALSE);
       $this->db->from('ordenes_reparacion_internas AS ORI');
		$this->db->join('vehiculos AS V', 'ORI.vehiculo_id = V.vehiculo_id', 'left');
	    $this->db->where('ORI.estatus', 'ACTIVO');
        $this->db->where("(ORI.folio LIKE '%$strDescripcion%')");  
        $this->db->order_by("ORI.folio",'DESC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

    /*******************************************************************************************************************
	Funciones de la tabla ordenes_reparacion_internas_servicios
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los servicios de la orden de reparación interna
	public function guardar_servicios(stdClass $objOrdenReparacionInterna)
	{
		//Si existen servicios
		if($objOrdenReparacionInterna->strServicioInternoID !== '')
		{
			//Quitar | de la lista para obtener el ID del servicio, hora y ID del mecánico
			$arrServicioInternoID = explode("|", $objOrdenReparacionInterna->strServicioInternoID);
			$arrHoras = explode("|", $objOrdenReparacionInterna->strHoras);
			$arrMecanicoInternoID = explode("|", $objOrdenReparacionInterna->strMecanicoInternoID);

			//Hacer recorrido para insertar los datos en la tabla ordenes_reparacion_internas_servicios
			for ($intCon = 0; $intCon < sizeof($arrServicioInternoID); $intCon++) 
			{

				//Asignar datos al array
				$arrDatos = array('orden_reparacion_interna_id' => $objOrdenReparacionInterna->intOrdenReparacionInternaID,
								  'renglon' => ($intCon + 1),
								  'servicio_interno_id' => $arrServicioInternoID[$intCon],
								  'horas' => $arrHoras[$intCon],
								  'mecanico_interno_id' => $arrMecanicoInternoID[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('ordenes_reparacion_internas_servicios', $arrDatos);
			}
		}
	}

	//Método para regresar los servicios de un registro
	public function buscar_servicios($intOrdenReparacionInternaID)
	{
		$this->db->select("ORIS.servicio_interno_id, ORIS.horas, 
						   ORIS.mecanico_interno_id, SI.codigo, SI.descripcion, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS mecanico", FALSE);
		$this->db->from('ordenes_reparacion_internas_servicios AS ORIS');
		$this->db->join('servicios_internos AS SI', 'ORIS.servicio_interno_id = SI.servicio_interno_id', 'inner');
		$this->db->join('mecanicos_internos AS MI', 'ORIS.mecanico_interno_id = MI.mecanico_interno_id', 'inner');
		$this->db->join('empleados AS E', 'MI.empleado_id = E.empleado_id', 'inner');
		$this->db->where('ORIS.orden_reparacion_interna_id', $intOrdenReparacionInternaID);
		$this->db->order_by('ORIS.renglon', 'ASC');
		return $this->db->get()->result();
	}
}
?>