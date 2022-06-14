<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');
//Incluir la clase modelo de inventario de maquinaria (para guardar maquinarias en inventario)
include_once(APPPATH . 'models/maquinaria/Maquinaria_inventario_model.php');

class Movimientos_maquinaria_model extends CI_model {
	

	/*******************************************************************************************************************
	Funciones de la tabla movimientos_maquinaria
	*********************************************************************************************************************/
	//Método para regresar los rastreos de maquinaria que coincidan con los criterios de búsqueda proporcionados  
	public function buscar_rastreos($strSerie, $dteFecha)
	{

		//Constante para identificar al tipo de servicio: facturación
		$intTipoServicioFacturacion = TIPO_SERVICIO_FACTURACION;
		//Constante para identificar al tipo de movimiento salida de maquinaria por venta
		$intMovSalidaVenta = SALIDA_MAQUINARIA_VENTA;
		//Constante para identificar al tipo de movimiento salida de maquinaria por traspaso
		$intMovSalidaTraspaso = SALIDA_MAQUINARIA_TRASPASO;
		//Constante para identificar al tipo de movimiento salida de maquinaria por demostración
		$intMovSalidaDemostracion = SALIDA_MAQUINARIA_DEMOSTRACION;
		//Constante para identificar al tipo de movimiento salida de maquinaria por validación
		$intMovSalidaValidacion = SALIDA_MAQUINARIA_VALIDACION;
		

		//Variable que se utiliza para formar la  consulta
		$queryRastreos = '';

		//Inventario inicial
		$queryInvInicial = "SELECT entrada_id AS referencia_id, 
									  sucursal_id, '2019-01-01 00:00:01' AS fecha, 1 AS tipo_movimiento, codigo_interno 
							   FROM   maquinaria_inventario 
							   WHERE  serie = '$strSerie'
							   AND    entrada_id = 1";

		//Movimientos de maquinaria
		$queryMovMaquinaria = "SELECT MM.movimiento_maquinaria_id AS referencia_id, 
									 MM.sucursal_id, MM.fecha, MM.tipo_movimiento, MI.codigo_interno 
							   FROM   movimientos_maquinaria AS MM INNER JOIN movimientos_maquinaria_detalles AS MMD 
			      						ON MM.movimiento_maquinaria_id = MMD.movimiento_maquinaria_id
						       INNER JOIN maquinaria_inventario AS MI ON MM.sucursal_id = MI.sucursal_id
									   AND MMD.maquinaria_descripcion_id = MI.maquinaria_descripcion_id
									   AND MMD.serie = MI.serie 
							   WHERE  MMD.serie = '$strSerie'
							   AND    MM.fecha <= '$dteFecha'
							   AND    MM.estatus <> 'INACTIVO' 
							   AND    MM.tipo_movimiento <> $intMovSalidaVenta
							   AND    MM.tipo_movimiento <> $intMovSalidaTraspaso
							   AND    MM.tipo_movimiento <> $intMovSalidaDemostracion
							   AND    MM.tipo_movimiento <> $intMovSalidaValidacion";

		//Inventario de maquinaria
	    $queryInventario =  "SELECT FM.factura_maquinaria_id AS referencia_id, FM.sucursal_id, FM.fecha, 
	    						  $intTipoServicioFacturacion AS tipo_movimiento, MI.codigo_interno 
							 FROM   facturas_maquinaria AS FM INNER JOIN maquinaria_inventario AS MI 
							      ON FM.sucursal_id = MI.sucursal_id 
							 AND FM.maquinaria_descripcion_id = MI.maquinaria_descripcion_id
						     AND FM.serie = MI.serie
							 WHERE  FM.serie = '$strSerie'
							 AND    FM.fecha <= '$dteFecha'
							 AND    FM.estatus <> 'INACTIVO'";


		//Facturas de maquinaria
		$queryFacturas = "SELECT FM.factura_maquinaria_id AS referencia_id, FM.sucursal_id, FM.fecha, 
								 $intTipoServicioFacturacion AS tipo_movimiento, MI.codigo_interno
						  FROM  facturas_maquinaria AS FM INNER JOIN facturas_maquinaria_detalles AS FMD
						        ON FM.factura_maquinaria_id = FMD.factura_maquinaria_id
						  INNER JOIN maquinaria_inventario AS MI ON FM.sucursal_id = MI.sucursal_id
						      AND FMD.maquinaria_descripcion_id = MI.maquinaria_descripcion_id
						      AND FMD.serie = MI.serie
						  WHERE  FMD.serie = '$strSerie'
		                  AND    FM.fecha <= '$dteFecha'
		                  AND    FM.estatus <> 'INACTIVO'";
		

		//Formar consulta
		$queryRastreos .= $queryInvInicial;
		$queryRastreos .= " UNION ";
		$queryRastreos .= $queryMovMaquinaria;
		$queryRastreos .= " UNION ";
		$queryRastreos .= $queryInventario;
		$queryRastreos .= " UNION ";
		$queryRastreos .= $queryFacturas;
		$queryRastreos .= " ORDER BY fecha, tipo_movimiento";

		//Ejecutar consulta
		$strSQL = $this->db->query($queryRastreos);
		return $strSQL->result();
	}


	/*Método para regresar los registros que coincidan con la serie proporcionada
	 *(se utiliza en el reporte de rastreo de series)*/
	public function buscar_serie($strSerie)
	{

		//Variable que se utiliza para formar la  consulta
		$querySerie = '';

		//Variables para definir que tipos de módulo se incluiran en la búsqueda
		//Inventario inicial de maquinaria
		$queryInventarioInicial = "SELECT 'INVENTARIO INICIAL' AS tipo_referencia, '0000000001' AS folio, 
										   '2019-01-01' AS fecha, '2000-01-01' AS fecha_creacion, 
	   										'01/01/2019' AS fecha_format, 
	   									  'INVENTARIO INICIAL' AS tipo_movimiento,  'ACTIVO' AS estatus, 
	   									  S.nombre AS sucursal
	   								   FROM maquinaria_inventario AS MI 
									   INNER JOIN sucursales AS S ON MI.sucursal_id = S.sucursal_id
									   WHERE MI.entrada_id = 1
									   AND MI.serie = '$strSerie'";

		//Movimientos de maquinaria
		$queryMovimientosMaquinaria = "SELECT 'MOVIMIENTO' AS tipo_referencia, MM.folio, 
											   MM.fecha, MM.fecha_creacion, 
	   										   DATE_FORMAT(MM.fecha,'%d/%m/%Y') AS fecha_format, 
	   										   MM.tipo_movimiento,  MM.estatus, S.nombre AS sucursal
	   								   FROM movimientos_maquinaria AS MM 
									   INNER JOIN sucursales AS S ON MM.sucursal_id = S.sucursal_id
									   INNER JOIN movimientos_maquinaria_detalles AS MMD ON MM.movimiento_maquinaria_id =  MMD.movimiento_maquinaria_id
									   WHERE MMD.serie = '$strSerie'";

		//Facturas de maquinaria
		$queryFacturasMaquinaria = "SELECT 'FACTURA MAQUINARIA' AS tipo_referencia, FM.folio, 
										    FM.fecha, FM.fecha_creacion, 
	   									    DATE_FORMAT(FM.fecha,'%d/%m/%Y') AS fecha_format, 
	  										'FACTURA DE MAQUINARIA' AS tipo_movimiento,  
	  										FM.estatus, S.nombre AS sucursal
								    FROM facturas_maquinaria AS FM 
									INNER JOIN sucursales AS S ON FM.sucursal_id = S.sucursal_id
									LEFT JOIN facturas_maquinaria_detalles AS FMD ON FM.factura_maquinaria_id =  FMD.factura_maquinaria_id
									WHERE (FM.serie = '$strSerie' OR FMD.serie = '$strSerie')";

		//Ordenes de reparación
		$queryOrdenesReparacion = "SELECT 'ORDEN DE TRABAJO' AS tipo_referencia, OT.folio, 
										   OT.fecha_finalizacion AS fecha, OT.fecha_creacion, 
										   CASE 
											   WHEN  OT.estatus = 'FINALIZADO'
											   		THEN DATE_FORMAT(OT.fecha_finalizacion,'%d/%m/%Y')	
											   ELSE DATE_FORMAT(OT.fecha_creacion,'%d/%m/%Y')
										    END AS fecha_format, 
	   									  ST.descripcion AS tipo_movimiento,  OT.estatus, S.nombre AS sucursal
									FROM ordenes_reparacion AS OT 
									INNER JOIN sucursales AS S ON OT.sucursal_id = S.sucursal_id
									INNER JOIN servicios_tipos AS ST ON OT.servicio_tipo_id = ST.servicio_tipo_id
									WHERE OT.serie = '$strSerie'";

		//Ordenes de reparación interna
		$queryOrdenesReparacionInterna = "SELECT 'ORDEN DE TRABAJO INTERNA' AS tipo_referencia, OTI.folio, 
											      OTI.fecha_finalizacion AS fecha, OTI.fecha_creacion, 
	  											   CASE 
													   WHEN  OTI.estatus = 'FINALIZADO'
													   		THEN DATE_FORMAT(OTI.fecha_finalizacion,'%d/%m/%Y')	
													   ELSE DATE_FORMAT(OTI.fecha_creacion,'%d/%m/%Y')
												    END AS fecha_format,
	  										      STI.descripcion AS tipo_movimiento,  OTI.estatus, 
	  										      S.nombre AS sucursal
										  FROM ordenes_reparacion_internas AS OTI 
										  INNER JOIN sucursales AS S ON OTI.sucursal_id = S.sucursal_id
										  INNER JOIN servicios_internos_tipos AS STI ON OTI.servicio_interno_tipo_id = STI.servicio_interno_tipo_id
										  WHERE OTI.serie = '$strSerie'";

		//Formar consulta
		$querySerie .= $queryInventarioInicial;
	    $querySerie .= " UNION ";
		$querySerie .= $queryMovimientosMaquinaria;
	    $querySerie .= " UNION ";
		$querySerie .= $queryFacturasMaquinaria;
		$querySerie .= " UNION ";
		$querySerie .= $queryOrdenesReparacion;
		$querySerie .= " UNION ";
		$querySerie .= $queryOrdenesReparacionInterna;
		$querySerie .= " ORDER BY fecha, fecha_creacion, folio";

		$strSQL = $this->db->query($querySerie);
		return $strSQL->result();

	}



	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Entradas de Maquinaria por Compra
	*********************************************************************************************************************
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_entrada_compra(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        //Se crea una instancia de la clase modelo (inventario de maquinaria) 
        $otdModelInventario = new  Maquinaria_inventario_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 

		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s"); 

		//Tabla movimientos_maquinaria
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID,
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objMovimiento->dteFecha,  
						  'moneda_id' => $objMovimiento->intMonedaID, 
						  'tipo_cambio' => $objMovimiento->intTipoCambio, 
						  'referencia_id'=> $objMovimiento->intReferenciaID,
						  'chofer_id' => $objMovimiento->intChoferID, 
						  'vehiculo_id' => $objMovimiento->intVehiculoID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_maquinaria', $arrDatos);
	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoMaquinariaID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la entrada de maquinaria
		$this->guardar_detalles_entrada_compra($objMovimiento);

		//Hacer un llamado al método para guardar maquinarias en el inventario
		$otdModelInventario->guardar($objMovimiento);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoMaquinariaID;
	}


	 //Método para modificar los datos de un registro previamente guardado
	public function modificar_entrada_compra(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (inventario de maquinaria) 
        $otdModelInventario = new  Maquinaria_inventario_model();

		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s"); 

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_maquinaria		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimiento->dteFecha,  
						  'chofer_id' => $objMovimiento->intChoferID, 
						  'vehiculo_id' => $objMovimiento->intVehiculoID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_maquinaria_id', $objMovimiento->intMovimientoMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_maquinaria', $arrDatos);

	    //Obtener los detalles del registro para eliminar inventario asociado a las maquinarias
		$otdDetalles = $this->buscar_detalles_entrada_compra($objMovimiento->intMovimientoMaquinariaID);

		//Verificar si existe información de los detalles 
		if($otdDetalles)
	    {

		    /*************************************************************************************
			* Eliminar los detalles del movimiento en 
			* la tabla movimientos_maquinaria_detalles		
			**************************************************************************************/
			$this->db->where('movimiento_maquinaria_id', $objMovimiento->intMovimientoMaquinariaID);
			$this->db->delete('movimientos_maquinaria_detalles');

			//Hacer un llamado al método para eliminar maquinarias del inventario
			$otdModelInventario->eliminar($objMovimiento->intSucursalID, $otdDetalles);

			//Hacer un llamado al método para guardar los detalles de la entrada de maquinaria
			$this->guardar_detalles_entrada_compra($objMovimiento);

			//Hacer un llamado al método para guardar maquinarias en el inventario
			$otdModelInventario->guardar($objMovimiento);

		}//Cierre de verificación de detalles


		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}


	//Método para modificar el estatus de un registro
	public function set_estatus($intMovimientoMaquinariaID, $intTipoMovimiento, $intPolizaID = NULL)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_maquinaria		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('movimiento_maquinaria_id', $intMovimientoMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_maquinaria', $arrDatos);

		//Si el tipo de movimiento corresponde a una entrada de maquinaria por compra
		if($intTipoMovimiento == ENTRADA_MAQUINARIA_COMPRA)
		{


			//Seleccionar los detalles del registro
			$otdDetalles = $this->buscar_detalles_entrada_compra($intMovimientoMaquinariaID);

			//Se crea una instancia de la clase modelo (inventario de maquinaria) 
        	$otdModelInventario = new  Maquinaria_inventario_model();
			//Hacer un llamado al método para modificar el estatus de las maquinarias del movimiento
			$otdModelInventario->set_estatus_maquinarias($this->session->userdata('sucursal_id'), $otdDetalles);
		}



		//Si existe el id de la póliza
		if($intPolizaID > 0)
		{
			//Se crea una instancia de la clase modelo (pólizas) 
       		$otdModelPolizas = new Polizas_model();
       		//Hacer un llamado al método para modificar el estatus de la póliza 
			$otdModelPolizas->set_estatus($intPolizaID, 'INACTIVO');
		}

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_entrada_compra($intMovimientoMaquinariaID = NULL,  $intTipoMovimiento = NULL, 
						   		   		  $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   		  $intProveedorID = NULL, $strEstatus = NULL, 
						   		   		  $strBusqueda =  NULL)
	{
		//Constante para identificar al tipo de movimiento salida de maquinaria por devolución al proveedor
		$intMovSalidaDevolucion = SALIDA_MAQUINARIA_DEVOLUCION_PROVEEDOR;
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR COMPRA');


		$this->db->select("MM.movimiento_maquinaria_id,	MM.folio, 
							DATE_FORMAT(MM.fecha, '%d/%m/%Y') AS fecha,
							MM.moneda_id, MM.tipo_cambio,
							MM.referencia_id, MM.chofer_id, MM.vehiculo_id,
							MM.observaciones, MM.estatus, 
							OCM.folio AS folio_orden_compra,
							OCM.proveedor_id, OCM.moneda_id, OCM.tipo_cambio, 
							CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor,
							P.rfc, P.telefono_principal, P.calle, P.numero_exterior, P.numero_interior, P.colonia,
						    CP.codigo_postal, P.localidad, MP.descripcion AS municipio, 
						    EP.descripcion AS estado,
							CONCAT(E.codigo, ' - ', E.nombre, ' ', E.apellido_paterno, ' ', E.apellido_materno) AS chofer,
							CONCAT(V.codigo, ' - ', V.modelo, ' ', V.marca) AS vehiculo, 
							(SELECT IFNULL(COUNT(MMS.movimiento_maquinaria_id), 0)
							FROM movimientos_maquinaria AS MMS
							WHERE MMS.tipo_movimiento = $intMovSalidaDevolucion
							AND MMS.referencia_id = MM.movimiento_maquinaria_id
							AND MMS.estatus = 'ACTIVO') AS total_salidas_devolucion_proveedor,
							IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza,
							UC.usuario AS usuario_creacion, 
							DATE_FORMAT(MM.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
	    $this->db->from('movimientos_maquinaria AS MM');
	    $this->db->join('ordenes_compra_maquinaria AS OCM', 'OCM.orden_compra_maquinaria_id = MM.referencia_id','inner');
	    $this->db->join('proveedores AS P', 'P.proveedor_id = OCM.proveedor_id','inner');
	    $this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
	    $this->db->join('vehiculos AS V', 'V.vehiculo_id = MM.vehiculo_id','left');
	    $this->db->join('choferes AS C', 'C.chofer_id = MM.chofer_id','left');
	    $this->db->join('empleados AS E', 'E.empleado_id = C.empleado_id','left');
	    $this->db->join('usuarios AS UC', 'UC.usuario_id = MM.usuario_creacion', 'left');
	    $this->db->join('polizas AS PF', 'MM.movimiento_maquinaria_id = PF.referencia_id
	    							        AND PF.proceso = '.$strTipoMovimiento.' 
	    							        AND PF.modulo = "MAQUINARIA"', 'left');

	     //Si existe id del movimiento
		if($intMovimientoMaquinariaID != NULL)
		{   
			$this->db->where('MM.movimiento_maquinaria_id', $intMovimientoMaquinariaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MM.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MM.tipo_movimiento', $intTipoMovimiento);

			//Si existe id del proveedor
		    if($intProveedorID > 0)
		    {
		   		$this->db->where('OCM.proveedor_id', $intProveedorID);
		    }

		    //Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		   //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(MM.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('MM.estatus', $strEstatus);
				}
			}
			
			$this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
							   (OCM.folio LIKE '%$strBusqueda%') OR
							   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
					           (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 


		    $this->db->order_by('MM.fecha DESC, MM.folio DESC');
		    return $this->db->get()->result();
		}
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_entrada_compra($intTipoMovimiento, $dteFechaInicial = NULL, 
										  $dteFechaFinal = NULL, $intProveedorID = NULL, 
										  $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{

		//Constante para identificar al tipo de movimiento salida de maquinaria por devolución al proveedor
		$intMovSalidaDevolucion = SALIDA_MAQUINARIA_DEVOLUCION_PROVEEDOR;
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR COMPRA');


		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MM.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MM.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('OCM.proveedor_id', $intProveedorID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 


	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MM.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MM.estatus', $strEstatus);
			}
		}


		$this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
						   (OCM.folio LIKE '%$strBusqueda%') OR
						   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
				           (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->from('movimientos_maquinaria AS MM');
		$this->db->join('ordenes_compra_maquinaria AS OCM', 'OCM.orden_compra_maquinaria_id = MM.referencia_id','inner');
	    $this->db->join('proveedores AS P', 'P.proveedor_id = OCM.proveedor_id','inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('polizas AS PF', 'MM.movimiento_maquinaria_id = PF.referencia_id
	    							        AND PF.proceso = '.$strTipoMovimiento.' 
	    							        AND PF.modulo = "MAQUINARIA"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();


		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MM.movimiento_maquinaria_id, MM.folio, MM.estatus,
						   DATE_FORMAT(MM.fecha,'%d/%m/%Y') AS fecha,
						   OCM.folio AS folio_orden_compra,
						   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, 
						   P.proveedor_id, 
						  (SELECT IFNULL(COUNT(MMS.movimiento_maquinaria_id), 0)
							FROM movimientos_maquinaria AS MMS
							WHERE MMS.tipo_movimiento = $intMovSalidaDevolucion
							AND MMS.referencia_id = MM.movimiento_maquinaria_id
							AND MMS.estatus = 'ACTIVO') AS total_salidas_devolucion_proveedor,
							IFNULL(PF.poliza_id, 0) AS poliza_id, 
						    PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_maquinaria AS MM');
		$this->db->join('ordenes_compra_maquinaria AS OCM', 'OCM.orden_compra_maquinaria_id = MM.referencia_id','inner');
	    $this->db->join('proveedores AS P', 'P.proveedor_id = OCM.proveedor_id','inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('polizas AS PF', 'MM.movimiento_maquinaria_id = PF.referencia_id
	    							        AND PF.proceso = '.$strTipoMovimiento.' 
	    							        AND PF.modulo = "MAQUINARIA"', 'left');

		$this->db->where('MM.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MM.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('OCM.proveedor_id', $intProveedorID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 


	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MM.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MM.estatus', $strEstatus);
			}
		}

		
		$this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
						   (OCM.folio LIKE '%$strBusqueda%') OR
						   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
				           (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('MM.fecha DESC, MM.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}


	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $intTipoMovimiento, $strTipo = NULL)
	{


		//Asignar número de registros para el autocomplete
    	$intLimite = LIMITE_AUTOCOMPLETE;
		//Dependiendo del tipo de movimiento realizar la búsqueda de datos
		if($intTipoMovimiento == ENTRADA_MAQUINARIA_COMPRA)
		{

		    $this->db->select("movimiento_maquinaria_id, folio, referencia_id", FALSE);
	        $this->db->from('movimientos_maquinaria');
			$this->db->where('estatus', 'ACTIVO');
			$this->db->where('tipo_movimiento', $intTipoMovimiento);
			$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
	        $this->db->where("(folio LIKE '%$strDescripcion%')"); 
			$this->db->order_by('folio', 'ASC');
			$this->db->limit($intLimite, 0);
			return $this->db->get()->result();

		}
		
	}


	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Entradas de Maquinaria por Ajuste
	*********************************************************************************************************************
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_entrada_ajuste(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        //Se crea una instancia de la clase modelo (inventario de maquinaria) 
        $otdModelInventario = new  Maquinaria_inventario_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 

		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s"); 

		//Tabla movimientos_maquinaria
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID,
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objMovimiento->dteFecha,  
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_maquinaria', $arrDatos);
	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoMaquinariaID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la entrada de maquinaria
		$this->guardar_detalles_entrada_compra($objMovimiento);

		//Hacer un llamado al método para guardar maquinarias en el inventario
		$otdModelInventario->guardar($objMovimiento);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoMaquinariaID;
	}


	 //Método para modificar los datos de un registro previamente guardado
	public function modificar_entrada_ajuste(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (inventario de maquinaria) 
        $otdModelInventario = new  Maquinaria_inventario_model();

		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s"); 

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_maquinaria		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimiento->dteFecha,  
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_maquinaria_id', $objMovimiento->intMovimientoMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_maquinaria', $arrDatos);

	    //Obtener los detalles del registro para eliminar inventario asociado a las maquinarias
		$otdDetalles = $this->buscar_detalles_entrada_compra($objMovimiento->intMovimientoMaquinariaID);

		//Verificar si existe información de los detalles 
		if($otdDetalles)
	    {

		    /*************************************************************************************
			* Eliminar los detalles del movimiento en 
			* la tabla movimientos_maquinaria_detalles		
			**************************************************************************************/
			$this->db->where('movimiento_maquinaria_id', $objMovimiento->intMovimientoMaquinariaID);
			$this->db->delete('movimientos_maquinaria_detalles');

			//Hacer un llamado al método para eliminar maquinarias del inventario
			$otdModelInventario->eliminar($objMovimiento->intSucursalID, $otdDetalles);

			//Hacer un llamado al método para guardar los detalles de la entrada de maquinaria
			$this->guardar_detalles_entrada_compra($objMovimiento);

			//Hacer un llamado al método para guardar maquinarias en el inventario
			$otdModelInventario->guardar($objMovimiento);

		}//Cierre de verificación de detalles


		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_entrada_ajuste($intMovimientoMaquinariaID = NULL,  $intTipoMovimiento = NULL, 
						   		   		  $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   		  $strEstatus = NULL,  $strBusqueda =  NULL)
	{
		//Constante para identificar al tipo de movimiento salida de maquinaria por devolución al proveedor
		$intMovSalidaDevolucion = SALIDA_MAQUINARIA_DEVOLUCION_PROVEEDOR;
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR AJUSTE');


		$this->db->select("MM.movimiento_maquinaria_id,	MM.folio, 
							DATE_FORMAT(MM.fecha, '%d/%m/%Y') AS fecha,
							MM.observaciones, MM.estatus, MM.fecha_creacion,
							MM.usuario_creacion,
							IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza,
							UC.usuario AS usuario_creacion, 
							DATE_FORMAT(MM.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
	    $this->db->from('movimientos_maquinaria AS MM');
	    $this->db->join('usuarios AS UC', 'UC.usuario_id = MM.usuario_creacion', 'left');
	    $this->db->join('polizas AS PF', 'MM.movimiento_maquinaria_id = PF.referencia_id
	    							        AND PF.proceso = '.$strTipoMovimiento.' 
	    							        AND PF.modulo = "MAQUINARIA"', 'left');

	     //Si existe id del movimiento
		if($intMovimientoMaquinariaID != NULL)
		{   
			$this->db->where('MM.movimiento_maquinaria_id', $intMovimientoMaquinariaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MM.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MM.tipo_movimiento', $intTipoMovimiento);

			
		    //Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('MM.estatus', $strEstatus);
			}

			$this->db->where("(MM.folio LIKE '%$strBusqueda%')"); 

		    $this->db->order_by('MM.fecha DESC, MM.folio DESC');
		    return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_entrada_ajuste($intTipoMovimiento, $dteFechaInicial = NULL, 
										  $dteFechaFinal = NULL,
										  $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{

		
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR AJUSTE');


		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MM.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MM.tipo_movimiento', $intTipoMovimiento);
		
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 


	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MM.estatus', $strEstatus);
		}

		
		$this->db->where("(MM.folio LIKE '%$strBusqueda%')"); 

		$this->db->from('movimientos_maquinaria AS MM');
		$arrResultado["total_rows"] = $this->db->count_all_results();


		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MM.movimiento_maquinaria_id, MM.folio, MM.estatus,
						   DATE_FORMAT(MM.fecha,'%d/%m/%Y') AS fecha,
							IFNULL(PF.poliza_id, 0) AS poliza_id, 
						    PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_maquinaria AS MM');
		$this->db->join('polizas AS PF', 'MM.movimiento_maquinaria_id = PF.referencia_id
	    							        AND PF.proceso = '.$strTipoMovimiento.' 
	    							        AND PF.modulo = "MAQUINARIA"', 'left');

		$this->db->where('MM.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MM.tipo_movimiento', $intTipoMovimiento);
		
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 


	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MM.estatus', $strEstatus);
		}

		
		$this->db->where("(MM.folio LIKE '%$strBusqueda%')"); 

		$this->db->order_by('MM.fecha DESC, MM.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}



	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Salidas de Maquinaria por Traspaso
	*********************************************************************************************************************
	*********************************************************************************************************************/
	public function guardar_salida_traspaso(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 

		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");

		//Tabla movimientos_maquinaria
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID, 
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objMovimiento->dteFecha,  
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'chofer_id' => $objMovimiento->intChoferID, 
						  'vehiculo_id' => $objMovimiento->intVehiculoID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_maquinaria', $arrDatos);

	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoMaquinariaID = $this->db->insert_id();

	    //Hacer un llamado al método para guardar los detalles de la salida por traspaso
		$this->guardar_detalles_salida_traspaso($objMovimiento);
		
	    //Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);
	    
	    //Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoMaquinariaID;
	}


    //Método para modificar los datos de un registro previamente guardado
	public function modificar_salida_traspaso(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Se crea una instancia de la clase modelo (inventario de maquinaria) 
        $otdModelInventario = new  Maquinaria_inventario_model();


		//Concatenar hora, minutos y segundos
		$objMovimiento->dteFecha .= ' '.date("H:i:s");

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimiento->dteFecha, 
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'chofer_id' => $objMovimiento->intChoferID, 
						  'vehiculo_id' => $objMovimiento->intVehiculoID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_maquinaria_id', $objMovimiento->intMovimientoMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_maquinaria', $arrDatos);

	    //Hacer un llamado al método para modificar el estatus de las maquinarias
	   	$otdModelInventario->set_estatus_componentes($objMovimiento->arrMaquinariaDescripcionID, 
	   												 $objMovimiento->arrSeries,	
	   												 'ACTIVO');

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_movimientos_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_maquinaria_id', $objMovimiento->intMovimientoMaquinariaID);
		$this->db->delete('movimientos_movimientos_detalles');

		//Hacer un llamado al método para guardar los detalles de la salida por traspaso
		$this->guardar_detalles_salida_traspaso($objMovimiento);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	

	/*******************************************************************************************************************
	Funciones de la tabla movimientos_maquinaria_detalles
	*********************************************************************************************************************/
	/*******************************************************************************************************************
	Funciones del proceso Entradas de Maquinaria por Compra
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la entrada de maquinaria por compra
	public function guardar_detalles_entrada_compra(stdClass $objMovimiento)
	{
		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener los detalles del movimiento
		foreach ($objMovimiento->arrDetalles as $arrDets)
		{
			//Hacer recorrido para obtener los datos del detalle
			foreach ($arrDets as $arrDet)
			{
				//Incrementar renglón consecutivo
				$intRenglon++;

				//Asignar datos al array
				$arrDatos = array('movimiento_maquinaria_id' => $objMovimiento->intMovimientoMaquinariaID,
								  'renglon' => $intRenglon,
								  'maquinaria_descripcion_id' => $arrDet->intMaquinariaDescripcionID,
								  'codigo' => $arrDet->strCodigo,
								  'descripcion_corta' => $arrDet->strDescripcionCorta,
								  'descripcion' => $arrDet->strDescripcion,
								  'serie' =>  $arrDet->strSerie,
								  'motor' =>  $arrDet->strMotor,
								  'numero_pedimento' => $arrDet->strNumeroPedimento);
				//Guardar los datos del registro
				$this->db->insert('movimientos_maquinaria_detalles', $arrDatos);

			}//Cierre de foreach Detalle

		}//Cierre de foreach Detalles
	}


	//Método para regresar los detalles de un registro
	public function buscar_detalles_entrada_compra($intMovimientoMaquinariaID)
	{
		$this->db->select("MMD.movimiento_maquinaria_id, MMD.renglon, 
						   MMD.maquinaria_descripcion_id,MMD.codigo, 
						   MMD.descripcion_corta, MMD.descripcion, 
						   MMD.serie, MMD.motor,
						   ML.descripcion AS maquinaria_linea,
						   MM.descripcion AS maquinaria_marca,
						   MMOD.descripcion AS maquinaria_modelo,
						   MI.numero_pedimento,
						   MI.consignacion,
						   MI.costo,
						   (SELECT COUNT(OMM.movimiento_maquinaria_id)
							FROM movimientos_maquinaria_detalles AS OMM
						    WHERE OMM.serie = MMD.serie
						    AND OMM.movimiento_maquinaria_id <> MMD.movimiento_maquinaria_id) AS otros_movimientos", FALSE);
		$this->db->from('movimientos_maquinaria_detalles AS MMD');	
		$this->db->join('maquinaria_descripciones AS MD', 'MD.maquinaria_descripcion_id = MMD.maquinaria_descripcion_id', 'inner');	
		$this->db->join('maquinaria_lineas AS ML', 'ML.maquinaria_linea_id = MD.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MM', 'MM.maquinaria_marca_id = MD.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'MMOD.maquinaria_modelo_id = MD.maquinaria_modelo_id', 'inner');
		$this->db->join('maquinaria_inventario MI', 'MI.entrada_id = MMD.movimiento_maquinaria_id 
						 AND MMD.maquinaria_descripcion_id = MI.maquinaria_descripcion_id
						 AND MMD.serie = MI.serie', 'inner');
		$this->db->where('MMD.movimiento_maquinaria_id', $intMovimientoMaquinariaID);
		$this->db->order_by('MMD.renglon', 'ASC');
		return $this->db->get()->result();
	}




	/*******************************************************************************************************************
	Funciones del proceso Salidas de Maquinaria por Traspaso
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la salida por traspaso
	public function guardar_detalles_salida_traspaso(stdClass $objMovimiento)
	{

		//Se crea una instancia de la clase modelo (inventario de maquinaria) 
        $otdModelInventario = new  Maquinaria_inventario_model();

		/*Quitar | de la lista para obtener el ID de la maquinaria, código, descripción, etc.
		*/
		$arrMaquinariaDescripcionID = explode("|", $objMovimiento->strMaquinariaDescripcionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripcionesCortas = explode("|", $objMovimiento->strDescripcionesCortas);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrSeries = explode("|", $objMovimiento->strSeries);
		$arrMotores = explode("|", $objMovimiento->strMotores);
		$arrNumerosPedimento = explode("|", $objMovimiento->strNumerosPedimento);

		//Hacer recorrido para insertar los datos en la tabla movimientos_maquinaria_detalles
		for ($intCon = 0; $intCon < sizeof($arrMaquinariaDescripcionID); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intMaquinariaDescripcionID = $arrMaquinariaDescripcionID[$intCon];
			$strSerie = $arrSeries[$intCon];
			
			//Asignar datos al array
			$arrDatos = array('movimiento_maquinaria_id' => $objMovimiento->intMovimientoMaquinariaID,
							  'renglon' => ($intCon + 1),
							  'maquinaria_descripcion_id' => $intMaquinariaDescripcionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion_corta' => $arrDescripcionesCortas[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'serie' => $strSerie, 
							  'motor' => $arrMotores[$intCon], 
							  'numero_pedimento' => $arrNumerosPedimento[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('movimientos_maquinaria_detalles', $arrDatos);

			//Modificar en el inventario de maquinaria la serie que corresponda
            $otdModelInventario->set_estatus($intMaquinariaDescripcionID, $strSerie, 
           								    'TRASPASO', $objMovimiento->intMovimientoMaquinariaID);

		}

	}



}
?>