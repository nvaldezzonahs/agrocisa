<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');
//Incluir la clase modelo de movimientos de refacciones (para modificar el inventario de refacciones)
include_once(APPPATH . 'models/refacciones/Movimientos_refacciones_model.php');

class Movimientos_refacciones_internas_model extends CI_model {

	/*******************************************************************************************************************
	Funciones de la tabla movimientos_refacciones_internas
	*********************************************************************************************************************/
	//Método para regresar los datos de un registro (se utiliza para generar póliza)
	public function buscar_referencia_poliza($intReferenciaID, $strTipoReferencia)
	{
		//Constante para identificar al tipo de movimiento: trabajo foráneo interno
		$intTipoServicioFacturacion = TIPO_SERVICIO_FACTURACION;

		//Dependiendo del tipo de referencia realizar consulta
		if($strTipoReferencia == 'TRABAJO FORANEO')
		{

			//Trabajos foráneos internos
			$queryReferencia ="SELECT TF.trabajo_foraneo_interno_id AS referencia_id, TF.sucursal_id,
						   			  $intTipoServicioFacturacion AS tipo_movimiento, 
						   			  TF.folio, TF.fecha, TF.estatus
							   FROM   trabajos_foraneos_internos AS TF 
							   WHERE  TF.trabajo_foraneo_interno_id = $intReferenciaID";
		}
		else //Movimientos de refacciones internas
		{

			//Movimientos de refacciones internas
			$queryReferencia ="SELECT MR.movimiento_refacciones_internas_id AS referencia_id, 
									  MR.sucursal_id,  MR.tipo_movimiento, MR.folio, 
									  MR.fecha, MR.estatus
							  FROM   movimientos_refacciones_internas AS MR 
							  WHERE  MR.movimiento_refacciones_internas_id = $intReferenciaID";
		}

		//Ejecutar consulta
		$strSQL = $this->db->query($queryReferencia);
		return $strSQL->row();
	}

	//Método para regresar los detalles de un registro (se utiliza para generar póliza)
	public function buscar_detalles_poliza($intReferenciaID, $intTipoMovimiento)
	{

		//Dependiendo del tipo de movimiento realizar búsqueda de datos
		if($intTipoMovimiento == ENTRADA_REFACCIONES_INTERNAS_TRASPASO) 
		{
			//Entradas de refacciones internas por traspaso almacén general
			$queryDetalles ="SELECT MR.movimiento_refacciones_internas_id  AS referencia_id,
								   SUM(MRD.cantidad * MRD.costo_unitario) AS Subtotal
						     FROM   movimientos_refacciones_internas AS MR 
						     INNER JOIN movimientos_refacciones_internas_detalles AS MRD 
						  	       ON MR.movimiento_refacciones_internas_id = MRD.movimiento_refacciones_internas_id 
							 WHERE  MR.movimiento_refacciones_internas_id = $intReferenciaID
							GROUP BY MR.movimiento_refacciones_internas_id";
		}
		else if($intTipoMovimiento == ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER) 
		{
			//Entradas de refacciones internas por devolución de taller
			$queryDetalles ="SELECT MR.movimiento_refacciones_internas_id AS referencia_id, 
									ORI.folio AS OrdRep,
							 	   SUM(MRD.cantidad * MRD.costo_unitario) AS Subtotal 
						    FROM   movimientos_refacciones_internas AS MR 
						    INNER JOIN movimientos_refacciones_internas_detalles AS MRD 
			       				  ON MR.movimiento_refacciones_internas_id = MRD.movimiento_refacciones_internas_id
			 			    INNER JOIN movimientos_refacciones_internas AS MR2 
			 			    	  ON MR.referencia_id = MR2.movimiento_refacciones_internas_id 
						    INNER JOIN requisiciones_refacciones_internas AS RR 
						    	  ON MR2.referencia_id = RR.requisicion_refacciones_internas_id
							INNER JOIN ordenes_reparacion_internas AS ORI ON RR.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id 
							WHERE  MR.movimiento_refacciones_internas_id = $intReferenciaID
							GROUP BY MR.movimiento_refacciones_internas_id";
		}
		else if($intTipoMovimiento == SALIDA_REFACCIONES_INTERNAS) 
		{
			//Salidas de refacciones internas por taller
			$queryDetalles ="SELECT MR.movimiento_refacciones_internas_id AS referencia_id, 
									ORI.folio AS OrdRep, 
							   		SUM(MRD.cantidad * MRD.costo_unitario) AS Subtotal 
						     FROM   movimientos_refacciones_internas AS MR 
						     INNER JOIN movimientos_refacciones_internas_detalles AS MRD
				   				   ON MR.movimiento_refacciones_internas_id = MRD.movimiento_refacciones_internas_id 
							 INNER JOIN requisiciones_refacciones_internas AS RR 
								   ON MR.referencia_id = RR.requisicion_refacciones_internas_id 
							 INNER JOIN ordenes_reparacion_internas AS ORI 
							 	   ON RR.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id
							 WHERE  MR.movimiento_refacciones_internas_id =  $intReferenciaID
							 GROUP BY MR.movimiento_refacciones_internas_id";
		}
		else if($intTipoMovimiento == SALIDA_REFACCIONES_INTERNAS_CONSUMO_INTERNO) 
		{
			//Salidas de refacciones internas por consumo interno
			$queryDetalles ="SELECT MR.movimiento_refacciones_internas_id AS referencia_id, 
									MR.observaciones, MRD.renglon,
							   		(MRD.cantidad * MRD.costo_unitario) AS Subtotal, 
							   		MRDG.sucursal_id, MRDG.modulo_id, GT.tipo_gasto, GT.prefijo,
							   		MDGS.descripcion AS ModuloTipoGasto

							 FROM   movimientos_refacciones_internas AS MR 
							 INNER JOIN movimientos_refacciones_internas_detalles AS MRD
				   					ON MR.movimiento_refacciones_internas_id = MRD.movimiento_refacciones_internas_id 
							 INNER JOIN movimientos_refacciones_internas_detalles_gastos AS MRDG 
				   				   ON MRD.movimiento_refacciones_internas_id = MRDG.movimiento_refacciones_internas_id 
				   				   AND MRD.renglon = MRDG.renglon 
							 INNER JOIN gastos_tipos AS GT ON MRDG.gasto_tipo_id = GT.gasto_tipo_id 
							 LEFT JOIN modulos AS MDGS ON MRDG.modulo_id = MDGS.modulo_id
							 WHERE  MR.movimiento_refacciones_internas_id = $intReferenciaID
						     ORDER BY MRD.renglon";
		}
		else if ($intTipoMovimiento == TIPO_SERVICIO_FACTURACION)
		{
			//Trabajos foráneos internos
			$queryDetalles ="SELECT TF.trabajo_foraneo_interno_id AS referencia_id, 
								    P.codigo, P.razon_social, P.tipo_proveedor,
				   					TF.factura, SM.moneda_id, SM.codigo AS Moneda, 
				   					SUM(TFD.cantidad * TFD.costo_unitario) AS Subtotal,
				   					SUM(TFD.cantidad * TFD.iva_unitario) AS IVA, 
				   					TFD.tasa_cuota_ieps, STC.valor_maximo AS TasaIEPS, 
				   					SUM(TFD.cantidad * TFD.ieps_unitario) AS IEPS
							FROM   trabajos_foraneos_internos AS TF 
							INNER JOIN trabajos_foraneos_internos_detalles AS TFD 
				   				 ON TF.trabajo_foraneo_interno_id = TFD.trabajo_foraneo_interno_id
			 				INNER JOIN ordenes_compra AS OC ON TF.orden_compra_id = OC.orden_compra_id
							INNER JOIN proveedores AS P ON OC.proveedor_id = P.proveedor_id 
			 				LEFT JOIN sat_tasa_cuota AS STC ON TFD.tasa_cuota_ieps = STC.tasa_cuota_id 
							LEFT JOIN sat_monedas AS SM ON TF.moneda_id = SM.moneda_id 
							WHERE  TF.trabajo_foraneo_interno_id = $intReferenciaID
							GROUP BY TF.trabajo_foraneo_interno_id, TFD.tasa_cuota_ieps 
							ORDER BY TFD.tasa_cuota_iva, TFD.tasa_cuota_ieps";
		}

		//Ejecutar consulta
		$strSQL = $this->db->query($queryDetalles);
		return $strSQL->result();
	}



	/*******************************************************************************************************************
	Funciones del proceso Entradas de Refacciones por Traspaso
	*********************************************************************************************************************/
	public function guardar_entrada_traspaso(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin(); 

		//Tabla movimientos_refacciones_internas
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID,
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento,
						  'folio' => $objMovimiento->strFolio, 
						  'fecha' => $objMovimiento->dteFecha,  
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones_internas', $arrDatos);
	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoRefaccionesInternasID  = $this->db->insert_id();

	    //Hacer un llamado al método para guardar las refacciones en el inventario (en caso de que no existan)
		$this->guardar_refacciones_internas_inventario($objMovimiento->dteFecha, 
											  		   $objMovimiento->strRefaccionID, 
											 		   $objMovimiento->strLocalizaciones);

	    //Hacer un llamado al método para guardar los detalles de la entrada por traspaso
		$this->guardar_detalles_entrada_traspaso($objMovimiento);

	    //Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoRefaccionesInternasID;
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_entrada_traspaso($intMovimientoRefaccionesInternasID = NULL, 
											$strCriteriosBusq = NULL,
											$intTipoMovimiento = NULL, 
						   		   		  	$dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   		  	$strEstatus = NULL, $strBusqueda = NULL)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('CONTROL DE VEHICULOS');
		$strProcesoPoliza = $this->db->escape('ENTRADA POR TRASPASO ALMACEN GENERAL');



		$this->db->select("MRIE.movimiento_refacciones_internas_id, MRIE.folio, 
						   DATE_FORMAT(MRIE.fecha,'%d/%m/%Y') AS fecha, 
						   MRIE.referencia_id,  MRIE.observaciones, 
						   MRIE.estatus,  S.nombre AS sucursal,
						   UC.usuario AS usuario_creacion, 
						   DATE_FORMAT(MRIE.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_refacciones_internas AS MRIE');
		$this->db->join('movimientos_refacciones AS MRIS', 'MRIE.referencia_id = MRIS.movimiento_refacciones_id', 'inner');
		$this->db->join('sucursales AS S', 'MRIE.sucursal_id = S.sucursal_id', 'inner');
		$this->db->join('usuarios AS UC', 'MRIE.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND MRIE.movimiento_refacciones_internas_id = PF.referencia_id', 'left');
		//Si existe id del movimiento
		if ($intMovimientoRefaccionesInternasID !== NULL)
		{   
			$this->db->where('MRIE.movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (folio|tipoMovimiento) para obtener los criterios de búsqueda
            list($strFolio, $intTipoMovimiento) = explode("|", $strCriteriosBusq); 
            $this->db->where('MRIE.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MRIE.folio', $strFolio);
			$this->db->where('MRIE.tipo_movimiento', $intTipoMovimiento);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MRIE.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MRIE.tipo_movimiento', $intTipoMovimiento);
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(MRIE.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

			//Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(MRIE.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('MRIE.estatus', $strEstatus);
				}
			}

			$this->db->where("(MRIE.folio LIKE '%$strBusqueda%')"); 

		    $this->db->order_by('MRIE.fecha DESC, MRIE.folio DESC');
		    return $this->db->get()->result();
		}

	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_entrada_traspaso($intTipoMovimiento, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   		    $strEstatus = NULL, $strBusqueda = NULL,
						   		   		    $intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('CONTROL DE VEHICULOS');
		$strProcesoPoliza = $this->db->escape('ENTRADA POR TRASPASO ALMACEN GENERAL');


		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MRIE.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRIE.tipo_movimiento', $intTipoMovimiento);
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(MRIE.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRIE.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRIE.estatus', $strEstatus);
			}
		}

		$this->db->where("(MRIE.folio LIKE '%$strBusqueda%')"); 

	    $this->db->from('movimientos_refacciones_internas AS MRIE');
		$this->db->join('movimientos_refacciones AS MRIS', 'MRIE.referencia_id = MRIS.movimiento_refacciones_id', 'inner');
		$this->db->join('sucursales AS S', 'MRIE.sucursal_id = S.sucursal_id', 'inner');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND MRIE.movimiento_refacciones_internas_id = PF.referencia_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();


		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MRIE.movimiento_refacciones_internas_id, MRIE.folio,  
						   MRIE.referencia_id, MRIE.estatus,
						   DATE_FORMAT(MRIE.fecha,'%d/%m/%Y') AS fecha, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_refacciones_internas AS MRIE');
		$this->db->join('movimientos_refacciones AS MRIS', 'MRIE.referencia_id = MRIS.movimiento_refacciones_id', 'inner');
		$this->db->join('sucursales AS S', 'MRIE.sucursal_id = S.sucursal_id', 'inner');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND MRIE.movimiento_refacciones_internas_id = PF.referencia_id', 'left');
		$this->db->where('MRIE.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRIE.tipo_movimiento', $intTipoMovimiento);
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(MRIE.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRIE.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRIE.estatus', $strEstatus);
			}
		}

		$this->db->where("(MRIE.folio LIKE '%$strBusqueda%')"); 

	    $this->db->order_by('MRIE.fecha DESC, MRIE.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}
	

	//Método para modificar el estatus de un registro
	public function set_estatus($intMovimientoRefaccionesInternasID, $intTipoMovimiento, $intPolizaID = NULL)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones_internas		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		$this->db->where('movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_refacciones_internas', $arrDatos);


		//Si existe el id de la póliza
		if($intPolizaID > 0)
		{
			//Se crea una instancia de la clase modelo (pólizas) 
       		$otdModelPolizas = new Polizas_model();
       		//Hacer un llamado al método para modificar el estatus de la póliza 
			$otdModelPolizas->set_estatus($intPolizaID, 'INACTIVO');
		}



		//Seleccionar la fecha del movimiento que coincide con el id
		$otdFechaMovimiento = $this->buscar_fecha_movimiento($intMovimientoRefaccionesInternasID);

		//Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($intMovimientoRefaccionesInternasID, 
	   													  $intTipoMovimiento, 
	   													  $otdFechaMovimiento->fecha);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar la fecha del movimiento que coincide con el id proporcionado
	public function buscar_fecha_movimiento($intMovimientoRefaccionesInternasID)
	{
		$this->db->select("DATE_FORMAT(fecha,'%Y-%m-%d') AS fecha", FALSE);
		$this->db->from('movimientos_refacciones_internas');
		$this->db->where('movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
		$this->db->limit(1);
		return $this->db->get()->row();
	}


	//Método para regresar los registros autorizados que coincidan con el criterio de búsqueda proporcionado (SALIDAS DE REFACCIONES INTERNAS)
	public function autocomplete_salidas($strDescripcion)
	{

		$this->db->select("	MRI.movimiento_refacciones_internas_id, MRI.folio AS movimiento_salida", FALSE);
		$this->db->from('movimientos_refacciones_internas AS MRI');
		$this->db->where('MRI.tipo_movimiento', SALIDA_REFACCIONES_INTERNAS);
		$this->db->where('MRI.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRI.estatus', 'ACTIVO');
		$this->db->where("(MRI.folio LIKE '%$strDescripcion%')"); 
		$this->db->order_by("MRI.folio",'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
		return $this->db->get()->result();
		
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $intTipoMovimiento)
	{
		//Asignar número de registros para el autocomplete
    	$intLimite = LIMITE_AUTOCOMPLETE;

    	$this->db->select("	MRI.movimiento_refacciones_internas_id,  MRI.folio AS movimiento", FALSE);
		$this->db->from('movimientos_refacciones_internas AS MRI');
		$this->db->where('MRI.sucursal_id',  $this->session->userdata('sucursal_id'));
		$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
		$this->db->where('MRI.estatus', 'ACTIVO');
		$this->db->where("(MRI.folio LIKE '%$strDescripcion%')");
		$this->db->order_by('MRI.fecha DESC, MRI.folio DESC');
		$this->db->limit($intLimite, 0);
		return $this->db->get()->result();
	}


	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Entradas de Refacciones por Devolución del Taller
	*********************************************************************************************************************
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_entrada_devolucion_taller(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 

		
		//Tabla movimientos_refacciones_internas
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID,
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objMovimiento->dteFecha,  
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones_internas', $arrDatos);
	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoRefaccionesInternasID  = $this->db->insert_id();

	    //Hacer un llamado al método para guardar los detalles de la entrada por devolución del taller
		$this->guardar_detalles_entrada_devolucion_taller($objMovimiento);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoRefaccionesInternasID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar_entrada_devolucion_taller(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones_internas		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimiento->dteFecha, 
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_refacciones_internas_id', $objMovimiento->intMovimientoRefaccionesInternasID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_refacciones_internas', $arrDatos);

	     //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($objMovimiento->intMovimientoRefaccionesInternasID, 
	   													  $objMovimiento->intTipoMovimiento, 
	   													  $objMovimiento->dteFecha);

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_internas_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_internas_id', $objMovimiento->intMovimientoRefaccionesInternasID);
		$this->db->delete('movimientos_refacciones_internas_detalles');

		//Hacer un llamado al método para guardar los detalles de la entrada por devolución del taller
		$this->guardar_detalles_entrada_devolucion_taller($objMovimiento);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_entrada_devolucion_taller($intMovimientoRefaccionesInternasID = NULL, $intTipoMovimiento = NULL, 
						   		   	     			 $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   	     			 $intVehiculoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('CONTROL DE VEHICULOS');
		$strProcesoPoliza = $this->db->escape('ENTRADA POR DEVOLUCION DE TALLER');



		$this->db->select("MRIE.movimiento_refacciones_internas_id, MRIE.folio, DATE_FORMAT(MRIE.fecha,'%d/%m/%Y') AS fecha, 
						   MRIE.referencia_id,  MRIE.observaciones, MRIE.estatus, 
						   MRIS.folio AS folio_salida, ORI.folio AS folio_orden_reparacion, 
						   ORI.serie, ORI.motor, ORI.vehiculo_id,
						   CASE 
							   WHEN  ORI.vehiculo_id > 0 
							   		THEN CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas)
								    ELSE '' 
						   	END AS vehiculo,
						   	V.codigo AS codigo_vehiculo, 
					       	V.modelo AS modelo_vehiculo, 
					       	V.marca AS marca_vehiculo, 
					       	V.placas AS placas_vehiculo,
						    UC.usuario AS usuario_creacion, 
						   DATE_FORMAT(MRIE.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_refacciones_internas AS MRIE');
		$this->db->join('movimientos_refacciones_internas AS MRIS', 
						'MRIE.referencia_id = MRIS.movimiento_refacciones_internas_id', 'inner');
		$this->db->join('requisiciones_refacciones_internas AS RRI', 
						'MRIS.referencia_id = RRI.requisicion_refacciones_internas_id', 'inner');
		$this->db->join('ordenes_reparacion_internas AS ORI', 
						'RRI.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id', 'inner');
		$this->db->join('vehiculos AS V', 'ORI.vehiculo_id = V.vehiculo_id', 'left');
		$this->db->join('usuarios AS UC', 'MRIE.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND MRIE.movimiento_refacciones_internas_id = PF.referencia_id', 'left');
	
		//Si existe id del movimiento
		if ($intMovimientoRefaccionesInternasID !== NULL)
		{   
			$this->db->where('MRIE.movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MRIE.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MRIE.tipo_movimiento', $intTipoMovimiento);
			//Si existe id del vehículo
		    if($intVehiculoID > 0)
		    {
		   		$this->db->where('ORI.vehiculo_id', $intVehiculoID);
		    }

			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(MRIE.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		     //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(MRIE.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('MRIE.estatus', $strEstatus);
				}
			}



	       $this->db->where("((MRIE.folio LIKE '%$strBusqueda%') OR
	       					  (MRIS.folio LIKE '%$strBusqueda%') OR
			           	      (ORI.serie LIKE '%$strBusqueda%') OR 
						      (CONCAT_WS(' - ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%') OR 
						      (CONCAT_WS(' ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%'))");  


		    $this->db->order_by('MRIE.fecha DESC, MRIE.folio DESC');
		    return $this->db->get()->result();
		}

	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_entrada_devolucion_taller($intTipoMovimiento, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   		 		     $intVehiculoID = NULL, $strEstatus = NULL, $strBusqueda = NULL, 
						   		   		 		     $intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('CONTROL DE VEHICULOS');
		$strProcesoPoliza = $this->db->escape('ENTRADA POR DEVOLUCION DE TALLER');


		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MRIE.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRIE.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del vehículo
	    if($intVehiculoID > 0)
	    {
	   		$this->db->where('ORI.vehiculo_id', $intVehiculoID);
	    }

	    //Si existe rango de fechas
	     if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRIE.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRIE.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRIE.estatus', $strEstatus);
			}
		}

	   $this->db->where("((MRIE.folio LIKE '%$strBusqueda%') OR
	       				  (MRIS.folio LIKE '%$strBusqueda%') OR
			           	  (ORI.serie LIKE '%$strBusqueda%') OR 
						  (CONCAT_WS(' - ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%') OR 
						  (CONCAT_WS(' ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%'))");  

		$this->db->from('movimientos_refacciones_internas AS MRIE');
		$this->db->join('movimientos_refacciones_internas AS MRIS', 
						'MRIE.referencia_id = MRIS.movimiento_refacciones_internas_id', 'inner');
		$this->db->join('requisiciones_refacciones_internas AS RRI', 
						'MRIS.referencia_id = RRI.requisicion_refacciones_internas_id', 'inner');
		$this->db->join('ordenes_reparacion_internas AS ORI', 
						'RRI.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id', 'inner');
		$this->db->join('vehiculos AS V', 'ORI.vehiculo_id = V.vehiculo_id', 'left');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND MRIE.movimiento_refacciones_internas_id = PF.referencia_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MRIE.movimiento_refacciones_internas_id, MRIE.folio, MRIE.referencia_id, MRIE.estatus,
						   DATE_FORMAT(MRIE.fecha,'%d/%m/%Y') AS fecha, MRIS.folio AS folio_salida,
						   CASE 
							   WHEN  ORI.vehiculo_id > 0
							   		THEN CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas)
							   ELSE ORI.serie
						   END AS referencia_orden_reparacion, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_refacciones_internas AS MRIE');
		$this->db->join('movimientos_refacciones_internas AS MRIS', 
						'MRIE.referencia_id = MRIS.movimiento_refacciones_internas_id', 'inner');
		$this->db->join('requisiciones_refacciones_internas AS RRI', 
						'MRIS.referencia_id = RRI.requisicion_refacciones_internas_id', 'inner');
		$this->db->join('ordenes_reparacion_internas AS ORI', 
						'RRI.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id', 'inner');
		$this->db->join('vehiculos AS V', 'ORI.vehiculo_id = V.vehiculo_id', 'left');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND MRIE.movimiento_refacciones_internas_id = PF.referencia_id', 'left');

		$this->db->where('MRIE.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRIE.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del vehículo
	    if($intVehiculoID > 0)
	    {
	   		$this->db->where('ORI.vehiculo_id', $intVehiculoID);
	    }

	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MRIE.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  

	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRIE.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRIE.estatus', $strEstatus);
			}
		}

	   $this->db->where("((MRIE.folio LIKE '%$strBusqueda%') OR
	       				  (MRIS.folio LIKE '%$strBusqueda%') OR
			           	  (ORI.serie LIKE '%$strBusqueda%') OR 
						  (CONCAT_WS(' - ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%') OR 
						  (CONCAT_WS(' ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%'))");

		$this->db->order_by('MRIE.fecha DESC, MRIE.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*******************************************************************************************************************
	Funciones del proceso Salida de Refacciones Internas
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_salida(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 

		
		//Tabla movimientos_refacciones_internas
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID,
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objMovimiento->dteFecha,  
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones_internas', $arrDatos);
	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoRefaccionesInternasID  = $this->db->insert_id();

	    //Hacer un llamado al método para guardar los detalles de la salida
		$this->guardar_detalles_salida($objMovimiento);

		//Hacer un llamado al método para modificar el estatus de la requisición de refacciones internas
	    $this->set_estatus_requisicion_refacciones_internas($objMovimiento->intReferenciaID, 
	    													$objMovimiento->strEstatusRequisicion);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoRefaccionesInternasID;
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_salida(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones_internas		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimiento->dteFecha, 
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_refacciones_internas_id', $objMovimiento->intMovimientoRefaccionesInternasID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_refacciones_internas', $arrDatos);

	    //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($objMovimiento->intMovimientoRefaccionesInternasID, 
	   													  $objMovimiento->intTipoMovimiento, 
	   													  $objMovimiento->dteFecha);

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_internas_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_internas_id', $objMovimiento->intMovimientoRefaccionesInternasID);
		$this->db->delete('movimientos_refacciones_internas_detalles');

		//Hacer un llamado al método para guardar los detalles de la salida
		$this->guardar_detalles_salida($objMovimiento);


		//Hacer un llamado al método para modificar el estatus de la requisición de refacciones internas
	    $this->set_estatus_requisicion_refacciones_internas($objMovimiento->intReferenciaID, 
	    													$objMovimiento->strEstatusRequisicion);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_salida($intMovimientoRefaccionesInternasID = NULL, $intTipoMovimiento = NULL, 
						   		  $dteFechaInicial = NULL, $dteFechaFinal = NULL,
						   		  $intVehiculoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		
		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('CONTROL DE VEHICULOS');
		$strProcesoPoliza = $this->db->escape('SALIDA POR TALLER');

		//Constante para identificar al tipo de movimiento entrada de refacciones internas por devolución del taller
		$intMovEntradaDevolucion = ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER;

		$this->db->select("MRI.movimiento_refacciones_internas_id, MRI.folio, 
						   DATE_FORMAT(MRI.fecha,'%d/%m/%Y') AS fecha, 
						   MRI.referencia_id,  MRI.observaciones, MRI.estatus, 
						   RRI.folio AS folio_requisicion, ORI.folio AS folio_orden_reparacion, 
						   ORI.serie, ORI.motor, ORI.vehiculo_id,
						   CASE 
							   WHEN  ORI.vehiculo_id > 0 
							   		THEN CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas)
								    ELSE '' 
						   	END AS vehiculo,
						   	V.codigo AS codigo_vehiculo, 
					       	V.modelo AS modelo_vehiculo, 
					       	V.marca AS marca_vehiculo, 
					       	V.placas AS placas_vehiculo, 
						   (SELECT IFNULL(COUNT(MRIE.movimiento_refacciones_internas_id), 0)
							FROM movimientos_refacciones_internas AS MRIE
							WHERE MRIE.tipo_movimiento = $intMovEntradaDevolucion
							AND MRIE.referencia_id = MRI.movimiento_refacciones_internas_id
							AND MRIE.estatus = 'ACTIVO') AS total_entradas_devolucion,
							UC.usuario AS usuario_creacion,
							DATE_FORMAT(MRI.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion,
							IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_refacciones_internas AS MRI');
		$this->db->join('requisiciones_refacciones_internas AS RRI', 
						'MRI.referencia_id = RRI.requisicion_refacciones_internas_id', 'inner');
		$this->db->join('ordenes_reparacion_internas AS ORI', 
						'RRI.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id', 'inner');
		$this->db->join('vehiculos AS V', 'ORI.vehiculo_id = V.vehiculo_id', 'left');
		$this->db->join('usuarios AS UC', 'MRI.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND MRI.movimiento_refacciones_internas_id = PF.referencia_id', 'left');
	
		//Si existe id del movimiento
		if ($intMovimientoRefaccionesInternasID !== NULL)
		{   
			$this->db->where('MRI.movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MRI.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
			//Si existe id del vehículo
		    if($intVehiculoID > 0)
		    {
		   		$this->db->where('ORI.vehiculo_id', $intVehiculoID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(MRI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(MRI.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('MRI.estatus', $strEstatus);
				}
			}

			$this->db->where("((MRI.folio LIKE '%$strBusqueda%') OR
        				       (RRI.folio LIKE '%$strBusqueda%') OR
			                   (ORI.folio LIKE '%$strBusqueda%') OR
			           	       (ORI.serie LIKE '%$strBusqueda%') OR 
						       (CONCAT_WS(' - ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%') OR 
						       (CONCAT_WS(' ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%'))");  

		    $this->db->order_by('MRI.fecha DESC, MRI.folio DESC');
		    return $this->db->get()->result();
		}

	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_salida($intTipoMovimiento, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		  $intVehiculoID = NULL,  $strEstatus = NULL, $strBusqueda = NULL,$intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('CONTROL DE VEHICULOS');
		$strProcesoPoliza = $this->db->escape('SALIDA POR TALLER');


		//Constante para identificar al tipo de movimiento entrada de refacciones internas por devolución del taller
		$intMovEntradaDevolucion = ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER;

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MRI.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del vehículo
	    if($intVehiculoID != NULL)
	    {
	   		$this->db->where('ORI.vehiculo_id', $intVehiculoID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(MRI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	      //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRI.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRI.estatus', $strEstatus);
			}
		}

		$this->db->where("((MRI.folio LIKE '%$strBusqueda%') OR
        				   (RRI.folio LIKE '%$strBusqueda%') OR
			               (ORI.folio LIKE '%$strBusqueda%') OR
			           	   (ORI.serie LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' - ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%'))"); 

		$this->db->from('movimientos_refacciones_internas AS MRI');
		$this->db->join('requisiciones_refacciones_internas AS RRI', 
						'MRI.referencia_id = RRI.requisicion_refacciones_internas_id', 'inner');
		$this->db->join('ordenes_reparacion_internas AS ORI', 
						'RRI.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id', 'inner');
		$this->db->join('vehiculos AS V', 'ORI.vehiculo_id = V.vehiculo_id', 'left');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND MRI.movimiento_refacciones_internas_id = PF.referencia_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MRI.movimiento_refacciones_internas_id, MRI.folio, MRI.referencia_id, MRI.estatus,
						   DATE_FORMAT(MRI.fecha,'%d/%m/%Y') AS fecha, RRI.folio AS folio_requisicion,
						   ORI.folio AS folio_orden_reparacion,  
						   CASE 
							   WHEN  ORI.vehiculo_id > 0
							   		THEN CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas)
							   ELSE ORI.serie
						   END AS referencia_orden_reparacion,
						   (SELECT IFNULL(COUNT(MRIE.movimiento_refacciones_internas_id), 0)
							FROM movimientos_refacciones_internas AS MRIE
							WHERE MRIE.tipo_movimiento = $intMovEntradaDevolucion
							AND MRIE.referencia_id = MRI.movimiento_refacciones_internas_id
							AND MRIE.estatus = 'ACTIVO') AS total_entradas_devolucion, 
							IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_refacciones_internas AS MRI');
		$this->db->join('requisiciones_refacciones_internas AS RRI', 
						'MRI.referencia_id = RRI.requisicion_refacciones_internas_id', 'inner');
		$this->db->join('ordenes_reparacion_internas AS ORI', 
						'RRI.orden_reparacion_interna_id = ORI.orden_reparacion_interna_id', 'inner');
		$this->db->join('vehiculos AS V', 'ORI.vehiculo_id = V.vehiculo_id', 'left');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND MRI.movimiento_refacciones_internas_id = PF.referencia_id', 'left');

		$this->db->where('MRI.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del vehículo
	    if($intVehiculoID != NULL)
	    {
	   		$this->db->where('ORI.vehiculo_id', $intVehiculoID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(MRI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  

	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRI.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRI.estatus', $strEstatus);
			}
		}


		$this->db->where("((MRI.folio LIKE '%$strBusqueda%') OR
        				   (RRI.folio LIKE '%$strBusqueda%') OR
			               (ORI.folio LIKE '%$strBusqueda%') OR
			           	   (ORI.serie LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' - ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%') OR 
						   (CONCAT_WS(' ',V.codigo, '-', V.modelo, V.marca, V.placas) LIKE '%$strBusqueda%'))");  

		$this->db->order_by('MRI.fecha DESC, MRI.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}
	

	//Método para regresar un listado con los IDs correspondientes a las salidas de refacciones adjuntas a una orden de reparación interna
	public function buscar_salidas($intTipoMovimiento, $intOrdenReparacionInternaID){

		$this->db->select('movimiento_refacciones_internas_id, referencia_id');
		$this->db->from('movimientos_refacciones_internas');
		$this->db->where('tipo_movimiento', $intTipoMovimiento);
	    $this->db->where('referencia_id', $intOrdenReparacionInternaID);
	    $this->db->where('estatus', 'ACTIVO');
		return $this->db->get()->result();

	}
		
	//Método para regresar un listado con las devoluciones correspondientes a una salida de refacciones internas
	public function buscar_salidas_con_devoluciones($intTipoMovimientoSalida, $intTipoMovimientoDevolucion, $intMovimientoRefaccionesInternasID, $intOrdenReparacionInternaID){

		$strSQL	= $this->db->query("(
							SELECT		
								RI.codigo_01 AS sort_col, 
						        1 AS sort_col2, 
						        CONCAT_WS('-', 'S', MRI.folio) AS tipo_folio,
						        'SALIDA' AS tipo, 
						        MRI.folio, 
						        DATE_FORMAT(MRI.fecha, '%d/%m/%Y') AS fecha, 
						        RI.codigo_01 AS codigo, 
						        RI.descripcion, 
						        RI.unidad, 
						        MRID.cantidad, 
						        MRID.precio_unitario, 
						        MRI.estatus
							FROM movimientos_refacciones_internas_detalles AS MRID
							INNER JOIN movimientos_refacciones_internas AS MRI ON MRID.movimiento_refacciones_internas_id = MRI.movimiento_refacciones_internas_id
							INNER JOIN refacciones_internas AS RI ON MRID.refaccion_id = RI.refaccion_id
							WHERE MRI.tipo_movimiento = $intTipoMovimientoSalida
							AND MRI.orden_reparacion_interna_id = $intOrdenReparacionInternaID
							AND MRI.movimiento_refacciones_internas_id = $intMovimientoRefaccionesInternasID
							ORDER BY MRID.renglon ASC
						)
						UNION
						(
							SELECT 
								RI.codigo_01, 2, 
								CONCAT_WS('-', 'E', MRI.folio) AS tipo_folio,
								'DEVOLUCION' AS tipo, 
								MRI.folio, DATE_FORMAT(MRI.fecha, '%d/%m/%Y') AS fecha, 
								RI.codigo_01 AS codigo, 
								RI.descripcion, 
								RI.unidad, 
								MRID.cantidad, 
								MRID.precio_unitario, 
								MRI.estatus
							FROM movimientos_refacciones_internas_detalles AS MRID
							INNER JOIN movimientos_refacciones_internas AS MRI ON MRID.movimiento_refacciones_internas_id = MRI.movimiento_refacciones_internas_id
							INNER JOIN refacciones_internas AS RI ON MRID.refaccion_id = RI.refaccion_id
							WHERE MRI.tipo_movimiento = $intTipoMovimientoDevolucion
							AND MRI.orden_reparacion_interna_id = $intMovimientoRefaccionesInternasID
							ORDER BY MRID.renglon ASC
						)
						ORDER BY sort_col, sort_col2, fecha ASC");

		return $strSQL->result();

	}	


	

	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Entrada de Refacciones Internas por Ajuste
	*********************************************************************************************************************
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_entrada_por_ajuste($strFolio, 
											  $intTipoMovimiento, 
											  $dteFecha, 
											  $strObservaciones, 
											  $strRefaccionInternaID, 
											  $strCantidades, 
											  $strPreciosUnitarios, 
											  $strDescuentosUnitarios, 
											  $strIvasUnitarios, 
											  $strIepsUnitarios)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		//Variable que se utiliza para asignar el id del nuevo registro
		$intMovimientoRefaccionesInternasID = 0;

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $strFolio); 

		//Tabla movimientos_refacciones_internas
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $this->session->userdata('sucursal_id'),
						  'tipo_movimiento' => $intTipoMovimiento, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha,
						  'observaciones' => $strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones_internas', $arrDatos);
	    //Asignar id del nuevo registro en la base de datos
		$intMovimientoRefaccionesInternasID  = $this->db->insert_id();

	    //Hacer un llamado al método para guardar los detalles de la entrada de refacciones internas
		$this->guardar_detalles_entrada($intMovimientoRefaccionesInternasID, 
										$dteFecha, 
										$intTipoMovimiento, 
										$strRefaccionInternaID, 
										$strCantidades, 
										$strPreciosUnitarios, 
										$strDescuentosUnitarios,  
										$strIvasUnitarios, 
										$strIepsUnitarios);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intMovimientoRefaccionesInternasID;
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_entrada_por_ajuste($intMovimientoRefaccionesInternasID, 
														$intTipoMovimiento, 
														$dteFecha,
												      	$strObservaciones, 
												      	$strRefaccionInternaID, 
												      	$strCantidades, 
												      	$strPreciosUnitarios, 
												      	$strDescuentosUnitarios, 
												      	$strIvasUnitarios, 
												      	$strIepsUnitarios)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones_internas		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha,
						  'observaciones' => $strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_refacciones_internas', $arrDatos);

	    //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($intMovimientoRefaccionesInternasID, $dteFecha);

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_internas_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
		$this->db->delete('movimientos_refacciones_internas_detalles');

		//Hacer un llamado al método para guardar los detalles de la entrada de refacciones internas
		$this->guardar_detalles_entrada($intMovimientoRefaccionesInternasID, 
										$dteFecha, 
										$intTipoMovimiento, 
										$strRefaccionInternaID, 
										$strCantidades, 
										$strPreciosUnitarios, 
										$strDescuentosUnitarios,
										$strIvasUnitarios, 
										$strIepsUnitarios);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_entrada_por_ajuste($intTipoMovimiento, $dteFechaInicial = NULL, $dteFechaFinal = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(MRI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
		$this->db->from('movimientos_refacciones_internas AS MRI');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("	MRI.movimiento_refacciones_internas_id, 
							MRI.folio, 
					        MRI.estatus, 
					        DATE_FORMAT(MRI.fecha, '%d/%m/%Y') AS fecha, 
					        SUM(cantidad) AS cantidad, 
					        SUM( ( cantidad * (precio_unitario - descuento_unitario) ) + iva_unitario + ieps_unitario ) AS importe " , FALSE);
		$this->db->from('movimientos_refacciones_internas AS MRI');
		$this->db->join('movimientos_refacciones_internas_detalles AS MRID', 'MRID.movimiento_refacciones_internas_id = MRI.movimiento_refacciones_internas_id', 'inner');
		$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(MRI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  
		$this->db->order_by('MRI.folio', 'DESC');
		$this->db->group_by('MRID.movimiento_refacciones_internas_id');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		
		return $arrResultado;
	
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_entrada_por_ajuste($intMovimientoRefaccionesInternasID = NULL, $intTipoMovimiento = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL)
	{
		
		$this->db->select("	MRI.movimiento_refacciones_internas_id, 
							MRI.folio,
						   	DATE_FORMAT(MRI.fecha,'%d/%m/%Y') AS fecha,
						   	SUM( MRID.cantidad) AS cantidad,
						    SUM( MRID.descuento_unitario) AS descuento,
						    SUM( MRID.cantidad * ( MRID.precio_unitario - MRID.descuento_unitario ) ) AS subtotal,
						    SUM( MRID.iva_unitario ) AS iva,
						    SUM( MRID.ieps_unitario ) AS ieps,
						    SUM( ( MRID.cantidad * ( MRID.precio_unitario - MRID.descuento_unitario) ) + MRID.iva_unitario + MRID.ieps_unitario ) AS importe,
						   	MRI.observaciones, 
						   	MRI.estatus,
						   	UC.usuario AS usuario_creacion", FALSE);
		$this->db->from('movimientos_refacciones_internas AS MRI');
		$this->db->join('movimientos_refacciones_internas_detalles AS MRID', 'MRID.movimiento_refacciones_internas_id = MRI.movimiento_refacciones_internas_id', 'inner');
		$this->db->join('usuarios AS UC', 'MRI.usuario_creacion = UC.usuario_id', 'left');

		if ($intMovimientoRefaccionesInternasID !== NULL)
		{   
			$this->db->where('MRI.movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
			//Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("(MRI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 
		    $this->db->order_by('MRI.fecha DESC, MRI.folio DESC');
		    $this->db->group_by('MRID.movimiento_refacciones_internas_id');
		    return $this->db->get()->result();
		}

	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_entrada_por_ajuste($intMovimientoRefaccionesInternasID, 
												       $intTipoMovimiento = NULL)
	{

		$intSucursalID = $this->session->userdata('sucursal_id');
		
		if ($intMovimientoRefaccionesInternasID !== NULL)
		{   
			$this->db->select("	 	MRI.folio, 
									DATE_FORMAT(MRI.fecha, '%d/%m/%Y') AS fecha, 
							        MRID.refaccion_id, 
							        MRID.cantidad, 
							        MRID.precio_unitario, 
							        MRID.descuento_unitario, 
							        MRID.iva_unitario, 
							        MRID.ieps_unitario, 
							        RI.descripcion, 
							        RI.codigo_01 AS codigo, 
							        RI.unidad
								FROM movimientos_refacciones_internas_detalles AS MRID
								INNER JOIN movimientos_refacciones_internas AS MRI ON MRID.movimiento_refacciones_internas_id = MRI.movimiento_refacciones_internas_id
								INNER JOIN refacciones_internas AS RI ON MRID.refaccion_id = RI.refaccion_id		 
								WHERE MRID.movimiento_refacciones_internas_id = $intMovimientoRefaccionesInternasID
								ORDER BY MRID.renglon ASC", FALSE);
		}

		return $this->db->get()->result();

	}


	/********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Salida de Refacciones Internas por Ajuste
	*********************************************************************************************************************
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_salida_por_ajuste($strFolio, 
											  $intTipoMovimiento, 
											  $dteFecha, 
											  $strObservaciones, 
											  $strRefaccionInternaID, 
											  $strCantidades, 
											  $strPreciosUnitarios, 
											  $strDescuentosUnitarios, 
											  $strIvasUnitarios, 
											  $strIepsUnitarios)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		//Variable que se utiliza para asignar el id del nuevo registro
		$intMovimientoRefaccionesInternasID = 0;

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $strFolio); 

		//Tabla movimientos_refacciones_internas
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $this->session->userdata('sucursal_id'),
						  'tipo_movimiento' => $intTipoMovimiento, 
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $dteFecha,
						  'observaciones' => $strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones_internas', $arrDatos);
	    //Asignar id del nuevo registro en la base de datos
		$intMovimientoRefaccionesInternasID  = $this->db->insert_id();

	    //Hacer un llamado al método para guardar los detalles de la entrada de refacciones internas
		$this->guardar_detalles_salida_por_ajuste($intMovimientoRefaccionesInternasID, 
										$dteFecha, 
										$intTipoMovimiento, 
										$strRefaccionInternaID, 
										$strCantidades, 
										$strPreciosUnitarios, 
										$strDescuentosUnitarios,  
										$strIvasUnitarios, 
										$strIepsUnitarios);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intMovimientoRefaccionesInternasID;

	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_salida_por_ajuste($intMovimientoRefaccionesInternasID, 
												$intTipoMovimiento, 
												$dteFecha,
										      	$strObservaciones, 
										      	$strRefaccionInternaID, 
										      	$strCantidades, 
										      	$strPreciosUnitarios, 
										      	$strDescuentosUnitarios, 
										      	$strIvasUnitarios, 
										      	$strIepsUnitarios)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones_internas		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $dteFecha,
						  'observaciones' => $strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_refacciones_internas', $arrDatos);

	    //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($intMovimientoRefaccionesInternasID, $dteFecha);

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_internas_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
		$this->db->delete('movimientos_refacciones_internas_detalles');

		//Hacer un llamado al método para guardar los detalles de la entrada de refacciones internas
		$this->guardar_detalles_salida_por_ajuste($intMovimientoRefaccionesInternasID, 
										$dteFecha, 
										$intTipoMovimiento, 
										$strRefaccionInternaID, 
										$strCantidades, 
										$strPreciosUnitarios, 
										$strDescuentosUnitarios,
										$strIvasUnitarios, 
										$strIepsUnitarios);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_salida_por_ajuste($intTipoMovimiento, $dteFechaInicial = NULL, $dteFechaFinal = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(MRI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 
		$this->db->from('movimientos_refacciones_internas AS MRI');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("	MRI.movimiento_refacciones_internas_id, 
							MRI.folio, 
					        MRI.estatus, 
					        DATE_FORMAT(MRI.fecha, '%d/%m/%Y') AS fecha, 
					        SUM(cantidad) AS cantidad, 
					        SUM( ( cantidad * (precio_unitario - descuento_unitario) ) + iva_unitario + ieps_unitario ) AS importe " , FALSE);
		$this->db->from('movimientos_refacciones_internas AS MRI');
		$this->db->join('movimientos_refacciones_internas_detalles AS MRID', 'MRID.movimiento_refacciones_internas_id = MRI.movimiento_refacciones_internas_id', 'inner');
		$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(MRI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  
		$this->db->order_by('MRI.folio', 'DESC');
		$this->db->group_by('MRID.movimiento_refacciones_internas_id');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		
		return $arrResultado;
	
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_salida_por_ajuste($intMovimientoRefaccionesInternasID = NULL, $intTipoMovimiento = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL)
	{
		
		$this->db->select("	MRI.movimiento_refacciones_internas_id, 
							MRI.folio,
						   	DATE_FORMAT(MRI.fecha,'%d/%m/%Y') AS fecha,
						   	SUM( MRID.cantidad) AS cantidad,
						    SUM( MRID.descuento_unitario) AS descuento,
						    SUM( MRID.cantidad * ( MRID.precio_unitario - MRID.descuento_unitario ) ) AS subtotal,
						    SUM( MRID.iva_unitario ) AS iva,
						    SUM( MRID.ieps_unitario ) AS ieps,
						    SUM( ( MRID.cantidad * ( MRID.precio_unitario - MRID.descuento_unitario) ) + MRID.iva_unitario + MRID.ieps_unitario ) AS importe,
						   	MRI.observaciones, 
						   	MRI.estatus,
						   	UC.usuario AS usuario_creacion", FALSE);
		$this->db->from('movimientos_refacciones_internas AS MRI');
		$this->db->join('movimientos_refacciones_internas_detalles AS MRID', 'MRID.movimiento_refacciones_internas_id = MRI.movimiento_refacciones_internas_id', 'inner');
		$this->db->join('usuarios AS UC', 'MRI.usuario_creacion = UC.usuario_id', 'left');

		if ($intMovimientoRefaccionesInternasID !== NULL)
		{   
			$this->db->where('MRI.movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
			//Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("(MRI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 
		    $this->db->order_by('MRI.fecha DESC, MRI.folio DESC');
		    $this->db->group_by('MRID.movimiento_refacciones_internas_id');
		    return $this->db->get()->result();
		}

	}

	/*********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Salidas de Refacciones Internas por Consumo Interno
	*********************************************************************************************************************
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_salida_consumo_interno(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimiento->strFolio); 


		//Tabla movimientos_refacciones_internas
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID, 
						  'tipo_movimiento' => $objMovimiento->intTipoMovimiento, 
						  'folio' => $strFolioConsecutivo,
						  'fecha' => $objMovimiento->dteFecha,  
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimiento->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('movimientos_refacciones_internas', $arrDatos);

	    //Agregar id del nuevo registro al objeto
		$objMovimiento->intMovimientoRefaccionesInternasID = $this->db->insert_id();

	    //Hacer un llamado al método para guardar los detalles de la salida por consumo interno
		$this->guardar_detalles_salida_consumo_interno($objMovimiento);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objMovimiento->intMovimientoRefaccionesInternasID;
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_salida_consumo_interno(stdClass $objMovimiento)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();;

		/*************************************************************************************
		* Modificar los datos del movimiento en la tabla movimientos_refacciones_internas		
		**************************************************************************************/
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimiento->dteFecha, 
						  'referencia_id' => $objMovimiento->intReferenciaID, 
						  'observaciones' => $objMovimiento->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimiento->intUsuarioID);
		$this->db->where('movimiento_refacciones_internas_id', $objMovimiento->intMovimientoRefaccionesInternasID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('movimientos_refacciones_internas', $arrDatos);

	    //Hacer un llamado al método para modificar el historial de refacciones en el inventario
	   	$this->modificar_historial_inventario_refacciones($objMovimiento->intMovimientoRefaccionesInternasID, 
	   													  $objMovimiento->intTipoMovimiento, 
	   													  $objMovimiento->dteFecha);

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_internas_detalles		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_internas_id', $objMovimiento->intMovimientoRefaccionesInternasID);
		$this->db->delete('movimientos_refacciones_internas_detalles');

		/*************************************************************************************
		* Eliminar los detalles del movimiento en 
		* la tabla movimientos_refacciones_internas_detalles_gastos		
		**************************************************************************************/
		$this->db->where('movimiento_refacciones_internas_id', $objMovimiento->intMovimientoRefaccionesInternasID);
		$this->db->delete('movimientos_refacciones_internas_detalles_gastos');
		

		//Hacer un llamado al método para guardar los detalles de la salida por consumo interno
		$this->guardar_detalles_salida_consumo_interno($objMovimiento);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar_salida_consumo_interno($intMovimientoRefaccionesInternasID = NULL, $intTipoMovimiento = NULL, 
						   		   				  $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   				  $intDepartamentoID = NULL,  $strEstatus = NULL, $strBusqueda = NULL)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('CONTROL DE VEHICULOS');
		$strProcesoPoliza = $this->db->escape('SALIDA POR CONSUMO INTERNO');


		$this->db->select("MRI.movimiento_refacciones_internas_id, MRI.folio, 
						   DATE_FORMAT(MRI.fecha,'%d/%m/%Y') AS fecha, 
						   MRI.referencia_id, MRI.observaciones, MRI.estatus, 
						   D.descripcion AS departamento,
						   UC.usuario AS usuario_creacion,
						   DATE_FORMAT(MRI.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_refacciones_internas AS MRI');
		$this->db->join('departamentos AS D', 'MRI.referencia_id = D.departamento_id', 'inner');
		$this->db->join('usuarios AS UC', 'MRI.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND MRI.movimiento_refacciones_internas_id = PF.referencia_id', 'left');

		//Si existe id del movimiento
		if ($intMovimientoRefaccionesInternasID !== NULL)
		{   
			$this->db->where('MRI.movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('MRI.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
			//Si existe id del departamento
		    if($intDepartamentoID > 0)
		    {
		   		$this->db->where('MRI.referencia_id', $intDepartamentoID);
		    }
			
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(MRI.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(MRI.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('MRI.estatus', $strEstatus);
				}
			}
			$this->db->where("((MRI.folio LIKE '%$strBusqueda%') OR
        				  	   (D.descripcion LIKE '%$strBusqueda%'))"); 
			
		    $this->db->order_by('MRI.fecha DESC, MRI.folio DESC');
		    return $this->db->get()->result();
		}

	}

    //Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_salida_consumo_interno($intTipoMovimiento, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   		   				  $intDepartamentoID = NULL, $strEstatus = NULL, $strBusqueda = NULL,
						   		   				  $intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strModuloPoliza = $this->db->escape('CONTROL DE VEHICULOS');
		$strProcesoPoliza = $this->db->escape('SALIDA POR CONSUMO INTERNO');


		
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MRI.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del departamento
		if($intDepartamentoID > 0)
	    {
	   		$this->db->where('MRI.referencia_id', $intDepartamentoID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(MRI.fecha  BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRI.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRI.estatus', $strEstatus);
			}
		}

		$this->db->where("((MRI.folio LIKE '%$strBusqueda%') OR
        				   (D.descripcion LIKE '%$strBusqueda%'))"); 

		$this->db->from('movimientos_refacciones_internas AS MRI');
		$this->db->join('departamentos AS D', 'MRI.referencia_id = D.departamento_id', 'inner');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND MRI.movimiento_refacciones_internas_id = PF.referencia_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MRI.movimiento_refacciones_internas_id, MRI.folio, MRI.estatus,
						   DATE_FORMAT(MRI.fecha,'%d/%m/%Y') AS fecha, D.descripcion AS departamento, 
						    IFNULL(PF.poliza_id, 0) AS poliza_id,
						   	PF.folio AS folio_poliza", FALSE);
	    $this->db->from('movimientos_refacciones_internas AS MRI');
		$this->db->join('departamentos AS D', 'MRI.referencia_id = D.departamento_id', 'inner');
		$this->db->join('polizas AS PF', 'PF.modulo = '.$strModuloPoliza.' 
	    							      AND PF.proceso ='.$strProcesoPoliza.'
	    							      AND MRI.movimiento_refacciones_internas_id = PF.referencia_id', 'left');

		$this->db->where('MRI.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
		//Si existe id del departamento
		if($intDepartamentoID > 0)
	    {
	   		$this->db->where('MRI.referencia_id', $intDepartamentoID);
	    }
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(MRI.fecha  BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }  

	     //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MRI.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MRI.estatus', $strEstatus);
			}
		}

		$this->db->where("((MRI.folio LIKE '%$strBusqueda%') OR
        				   (D.descripcion LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('MRI.fecha DESC, MRI.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*******************************************************************************************************************
	Funciones de la tabla movimientos_refacciones_internas_detalles
	*********************************************************************************************************************/
	/*******************************************************************************************************************
	Funciones para Actualizar Inventario de refacciones internas
	*********************************************************************************************************************/
	//Método para regresar los detalles de un registro (para actualizar inventario)
	public function buscar_detalles_movimiento($intMovimientoRefaccionesInternasID)
	{
		$this->db->select('renglon, refaccion_id, cantidad');
		$this->db->from('movimientos_refacciones_internas_detalles');
		$this->db->where('movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
		return $this->db->get()->result();
	}


	/*******************************************************************************************************************
	Funciones del proceso Entrada de Refacciones Internas
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la entrada de refacciones internas
	public function guardar_detalles_entrada(stdClass $objMovimiento)
	{
		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el ID de la refacción, cantidad, precio unitario, descuento unitario, 
		  iva unitario e ieps unitario
		*/
		$arrRefaccionInternaID = explode("|", $objMovimiento->strRefaccionInternaID);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrPreciosUnitarios = explode("|", $objMovimiento->strPreciosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objMovimiento->strDescuentosUnitarios);
		$arrIvasUnitarios = explode("|", $objMovimiento->strIvasUnitarios);
		$arrIepsUnitarios = explode("|", $objMovimiento->strIepsUnitarios);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_internas_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionInternaID); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionInternaID[$intCon];
			$intCantidad = $arrCantidades[$intCon];
			$intPrecioUnitario = $arrPreciosUnitarios[$intCon];

			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_internas_id' => $objMovimiento->intMovimientoRefaccionesInternasID,
							  'renglon' => ($intCon + 1),
							  'refaccion_id' => $intRefaccionID, 
							  'cantidad' => $intCantidad,
							  'precio_unitario' => $intPrecioUnitario,
							  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
							  'iva_unitario' => $arrIvasUnitarios[$intCon], 
							  'ieps_unitario' => $arrIepsUnitarios[$intCon]);

			//Verificamos que la cantidad de elementos del detalle sea mayor a cero
			if( $intCantidad > 0 ){

				$this->db->insert('movimientos_refacciones_internas_detalles', $arrDatos);
				//Hacer un llamado al método para modificar el inventario de la refacción
	   			$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   													$intRefaccionID, $intCantidad, $intPrecioUnitario);
			
			}
			
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_entrada($intMovimientoRefaccionesInternasID)
	{
		$this->db->select('MRID.refaccion_id, MRID.cantidad, MRID.precio_unitario,
					       MRID.descuento_unitario, MRID.iva_unitario, MRID.ieps_unitario, 
					       RI.descripcion, RI.codigo_01 AS codigo, RI.unidad');
		$this->db->from('movimientos_refacciones_internas_detalles AS MRID');
		$this->db->join('refacciones_internas AS RI', 'MRID.refaccion_id = RI.refaccion_id', 'inner');
		$this->db->where('MRID.movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
		$this->db->order_by('MRID.renglon', 'ASC');
		return $this->db->get()->result();
	}

	

	/*******************************************************************************************************************
	Funciones del proceso Entradas de Refacciones por Traspaso
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la entrada de refacciones por traspaso
	public function guardar_detalles_entrada_traspaso(stdClass $objMovimiento)
	{
		//Se crea una instancia de la clase modelo (movimientos de refacciones) 
        $otdModelMovimientosRefacciones = new  Movimientos_refacciones_model();

		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el renglón, ID de la refacción, código, descripción, 
		  código de la línea, cantidad y costo unitario
		*/
		$arrRenglon = explode("|", $objMovimiento->strRenglon);
		$arrRefaccionID = explode("|", $objMovimiento->strRefaccionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrCodigosLineas = explode("|", $objMovimiento->strCodigosLineas);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrCostosUnitarios = explode("|", $objMovimiento->strCostosUnitarios);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_internas_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];
			$intCostoUnitario = $arrCostosUnitarios[$intCon];

			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_internas_id' => $objMovimiento->intMovimientoRefaccionesInternasID,
							  'renglon' => $arrRenglon[$intCon], 
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $intCostoUnitario);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_internas_detalles', $arrDatos);

			//Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   												$intRefaccionID, $intCantidad, $intCostoUnitario);

	   		//Hacer un llamado al método para modificar el inventario de la refacción de la salida por traspaso vehicular
	   		$otdModelMovimientosRefacciones->modificar_inventario_refacciones_salida_traspaso_vehicular($strAnio,  
							   																		    $intRefaccionID, 
							   																            $intCantidad);
		} 
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_entrada_traspaso($intMovimientoRefaccionesInternasID, 
													 $intReferenciaID = NULL)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');


		//Si existe id del movimiento
		if($intMovimientoRefaccionesInternasID > 0)
		{
			
			$this->db->select("MRID.refaccion_id, MRID.codigo, MRID.descripcion, MRID.codigo_linea, 
				               MRID.cantidad, MRID.costo_unitario, RI.localizacion,
				               CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
				               RM.descripcion AS refacciones_marca", FALSE);
			$this->db->from('movimientos_refacciones_internas_detalles AS MRID');
			$this->db->join('refacciones AS R', 'MRID.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('refacciones_internas_inventario AS RI', 'MRID.refaccion_id = RI.refaccion_id 
							 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(NOW())', 'left');
			$this->db->where('MRID.movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
			$this->db->order_by('MRID.renglon', 'ASC');


		}
		else
		{
			$this->db->select("MRDS.renglon, MRDS.refaccion_id, MRDS.codigo, MRDS.descripcion, 
							   MRDS.codigo_linea, MRDS.cantidad, MRDS.costo_unitario, RI.localizacion,
							   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
							   RM.descripcion AS refacciones_marca", FALSE);
			$this->db->from('movimientos_refacciones_detalles AS MRDS');
			$this->db->join('refacciones AS R', 'MRDS.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('refacciones_inventario AS RI', 'MRDS.refaccion_id = RI.refaccion_id 
							 AND RI.sucursal_id = '.$intSucursalID.' AND RI.anio = YEAR(NOW())', 'left');
			$this->db->where('MRDS.movimiento_refacciones_id', $intReferenciaID);
			$this->db->order_by('MRDS.renglon', 'ASC');
			
		}

		return $this->db->get()->result();
	}



	/*******************************************************************************************************************
	Funciones del proceso Entradas de Refacciones por Devolución del Taller
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la entrada por devolución del taller
	public function guardar_detalles_entrada_devolucion_taller(stdClass $objMovimiento)
	{

		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el renglón, ID de la refacción, código, descripción, 
		  código de la línea, cantidad, costo unitario y precio unitario
		*/
		$arrRenglon = explode("|", $objMovimiento->strRenglon);
		$arrRefaccionID = explode("|", $objMovimiento->strRefaccionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrCodigosLineas = explode("|", $objMovimiento->strCodigosLineas);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrCostosUnitarios = explode("|", $objMovimiento->strCostosUnitarios);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_internas_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];
			$intCostoUnitario = $arrCostosUnitarios[$intCon];

			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_internas_id' => $objMovimiento->intMovimientoRefaccionesInternasID,
							  'renglon' => $arrRenglon[$intCon],
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $intCostoUnitario);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_internas_detalles', $arrDatos);

			//Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   											    $intRefaccionID, $intCantidad, $intCostoUnitario);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_entrada_devolucion_taller($intMovimientoRefaccionesInternasID, $intReferenciaID = NULL)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Constante para identificar al tipo de movimiento entrada de refacciones internas por devolución del taller
		$intMovEntradaDevolucion = ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER;

		//Si existe id de la referencia
		if($intReferenciaID  != NULL)
		{
			$this->db->select("MRIDS.renglon, MRIDS.refaccion_id, MRIDS.codigo, MRIDS.descripcion, MRIDS.codigo_linea,
						       MRIDS.cantidad AS cantidad_salida, MRIDS.costo_unitario,
						       IFNULL(MRIDE.cantidad, 0) AS cantidad_entrada,
						       (SELECT IFNULL(SUM(MRIDD.cantidad), 0)
								FROM movimientos_refacciones_internas_detalles AS MRIDD
								INNER JOIN movimientos_refacciones_internas AS MRI ON MRIDD.movimiento_refacciones_internas_id = MRI.movimiento_refacciones_internas_id
								WHERE MRI.tipo_movimiento = $intMovEntradaDevolucion
								AND MRI.referencia_id = $intReferenciaID
								AND MRI.estatus = 'ACTIVO'
								AND MRIDD.refaccion_id = MRIDS.refaccion_id) AS cantidad_devolucion,
								CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
								RM.descripcion AS refacciones_marca", FALSE);
			$this->db->from('movimientos_refacciones_internas_detalles AS MRIDS');
			$this->db->join('refacciones AS R', 'MRIDS.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('movimientos_refacciones_internas AS MRIE', 
							'MRIE.movimiento_refacciones_internas_id = '.$intMovimientoRefaccionesInternasID.'
							 AND MRIE.referencia_id = MRIDS.movimiento_refacciones_internas_id', 'left');
			$this->db->join('movimientos_refacciones_internas_detalles AS MRIDE', 
							'MRIE.movimiento_refacciones_internas_id = MRIDE.movimiento_refacciones_internas_id
							 AND MRIDE.refaccion_id = MRIDS.refaccion_id AND MRIDE.renglon = MRIDS.renglon', 'left');
			$this->db->where('MRIDS.movimiento_refacciones_internas_id', $intReferenciaID);
			$this->db->order_by('MRIDS.renglon', 'ASC');
		}
		else
		{
			$this->db->select("MRID.codigo, MRID.descripcion, MRID.codigo_linea, MRID.cantidad,  
							   MRID.costo_unitario, RII.localizacion,
							   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
							   RM.descripcion AS refacciones_marca");
			$this->db->from('movimientos_refacciones_internas_detalles AS MRID');
			$this->db->join('refacciones AS R', 'MRID.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('refacciones_internas_inventario AS RII', 'MRID.refaccion_id = RII.refaccion_id 
						 	 AND RII.sucursal_id = '.$intSucursalID.' AND RII.anio = YEAR(NOW())', 'left');
			$this->db->where('MRID.movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
			$this->db->order_by('MRID.renglon', 'ASC');
		}
		
		return $this->db->get()->result();
	}


	/*******************************************************************************************************************
	Funciones del proceso Salida de Refacciones Internas
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la salida 
	public function guardar_detalles_salida(stdClass $objMovimiento)
	{

		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el renglón, ID de la refacción, código, descripción, 
		  código de la línea, cantidad surtida, costo actual,
		  ID del back order, cantidad pendiente por surtir y estatus de la requisición interna en la tabla back_order_internos
		*/
		$arrRenglon = explode("|", $objMovimiento->strRenglon);
		$arrRefaccionID = explode("|", $objMovimiento->strRefaccionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrCodigosLineas = explode("|", $objMovimiento->strCodigosLineas);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrCostosUnitarios = explode("|", $objMovimiento->strCostosUnitarios);
		$arrBackOrderInternoID = explode("|", $objMovimiento->strBackOrderInternoID);
		$arrCantidadesBackOrder = explode("|", $objMovimiento->strCantidadesBackOrder);
		$arrEstatusBackOrder = explode("|", $objMovimiento->strEstatusBackOrder);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_internas_detalles
		for ($intCon = 0; $intCon < sizeof($arrRenglon); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRenglon = $arrRenglon[$intCon];
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];

			//Variables que se utilizan para asignar valores del pedido pendiente
			$intBackOrderInternoID = $arrBackOrderInternoID[$intCon];
			$intCantidadBackOrder = $arrCantidadesBackOrder[$intCon];
			$strEstatusBackOrder = $arrEstatusBackOrder[$intCon];

			/*************************************************************************************
			* Guardar datos de la refacción en la tabla movimientos_refacciones_internas_detalles
			**************************************************************************************/
			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_internas_id' => $objMovimiento->intMovimientoRefaccionesInternasID,
							  'renglon' => $intRenglon,
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $arrCostosUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_internas_detalles', $arrDatos);

			//Si existe id del pedido pendiente 
			if($intBackOrderInternoID > 0)
			{
				//Hacer un llamado a la función para actualizar los datos del pedido pendiente
				$this->modificar_pedido_pendiente($intBackOrderInternoID, $intCantidadBackOrder, 
												  $strEstatusBackOrder);
			}
			else
			{
				//Si el estatus es diferente de SURTIDO
				if($strEstatusBackOrder != 'SURTIDO')
				{
					//Hacer un llamado a la función para guardar los datos del pedido pendiente 
					$this->guardar_pedido_pendiente($objMovimiento->intReferenciaID, $intRenglon, 
													$intCantidadBackOrder, $strEstatusBackOrder);
				}
			}
			
			//Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   												$intRefaccionID, $intCantidad);
			
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_salida($intMovimientoRefaccionesInternasID, $intReferenciaID = NULL, 
										   $intTipoMovimiento = NULL, $intOrdenReparacionInternaID = NULL)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Constante para identificar al tipo de movimiento entrada de refacciones internas por devolución del taller
		$intMovEntradaDevolucion = ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER;

		//Si existe id de la referencia
		if($intReferenciaID  != NULL)
		{
			$this->db->select("RRID.refaccion_id, RRID.renglon, RRID.codigo, 
							   RRID.descripcion, RRID.codigo_linea, 
							   IFNULL(BO.back_order_interno_id, 0) AS back_order_interno_id, 
							   RRID.cantidad AS cantidad_solicitada, 
						       IFNULL(BO.cantidad, 0) AS cantidad_pendiente, 
						       IFNULL(MRID.cantidad, 0) AS cantidad_surtida,
						       CASE 
								   WHEN  MRI.movimiento_refacciones_internas_id  > 0
								   		THEN MRID.costo_unitario
								   ELSE IFNULL(RII.actual_costo, 0)
							   END AS costo_unitario, 
						       IFNULL(RII.actual_existencia, 0) AS actual_existencia,
						       CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
							   RM.descripcion AS refacciones_marca", FALSE);
			$this->db->from('requisiciones_refacciones_internas_detalles AS RRID');
			$this->db->join('refacciones AS R', 'RRID.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('back_order_internos AS BO', 'RRID.requisicion_refacciones_internas_id = BO.requisicion_refacciones_internas_id 
							 AND RRID.renglon = BO.renglon', 'left');
			$this->db->join('movimientos_refacciones_internas AS MRI', 
							'MRI.movimiento_refacciones_internas_id = '.$intMovimientoRefaccionesInternasID.'
							 AND MRI.referencia_id = RRID.requisicion_refacciones_internas_id', 'left');
			$this->db->join('movimientos_refacciones_internas_detalles AS MRID', 
							'MRI.movimiento_refacciones_internas_id = MRID.movimiento_refacciones_internas_id
							 AND MRID.refaccion_id = RRID.refaccion_id AND MRID.renglon = RRID.renglon', 'left');
			$this->db->join('refacciones_internas_inventario AS RII', 'RRID.refaccion_id = RII.refaccion_id 
							 AND RII.sucursal_id = '.$intSucursalID.' AND RII.anio = YEAR(NOW())', 'left');
			$this->db->where('RRID.requisicion_refacciones_internas_id', $intReferenciaID);
			$this->db->order_by('RRID.renglon', 'ASC');
		}
		else
		{

			$this->db->select("MRI.folio, DATE_FORMAT(MRI.fecha,'%d/%m/%Y') AS fecha,
							   RRI.folio AS folio_requisicion, MRID.refaccion_id, MRID.codigo, 
							   MRID.descripcion, MRID.codigo_linea, MRID.cantidad, 
							   MRID.costo_unitario, RRID.cantidad AS cantidad_solicitada, 
							   RII.localizacion,
						      (SELECT IFNULL(SUM(MRIDE.cantidad), 0)
								FROM movimientos_refacciones_internas_detalles AS MRIDE
								INNER JOIN movimientos_refacciones_internas AS MRIE ON MRIDE.movimiento_refacciones_internas_id = MRIE.movimiento_refacciones_internas_id
								WHERE MRIE.tipo_movimiento = $intMovEntradaDevolucion
								AND MRIE.referencia_id = MRI.movimiento_refacciones_internas_id
								AND MRIE.estatus = 'ACTIVO'
								AND MRIDE.refaccion_id = MRID.refaccion_id) AS cantidad_devolucion,
								CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
							   RM.descripcion AS refacciones_marca", FALSE);
		    $this->db->from('requisiciones_refacciones_internas_detalles AS RRID');
			$this->db->join('refacciones AS R', 'RRID.refaccion_id = R.refaccion_id', 'inner');
			$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
			$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
			$this->db->join('requisiciones_refacciones_internas AS RRI', 
							'RRID.requisicion_refacciones_internas_id = RRI.requisicion_refacciones_internas_id', 'inner');
			$this->db->join('movimientos_refacciones_internas AS MRI', 
							'MRI.referencia_id = RRI.requisicion_refacciones_internas_id', 'inner');
			$this->db->join('movimientos_refacciones_internas_detalles AS MRID', 
							'MRI.movimiento_refacciones_internas_id = MRID.movimiento_refacciones_internas_id
							 AND MRID.refaccion_id = RRID.refaccion_id AND MRID.renglon = RRID.renglon', 'inner');
			$this->db->join('refacciones_internas_inventario AS RII', 'RRID.refaccion_id = RII.refaccion_id 
							 AND RII.sucursal_id = '.$intSucursalID.' AND RII.anio = YEAR(NOW())', 'left');
			
			//Si existe id del movimiento
			if ($intMovimientoRefaccionesInternasID !== NULL)
			{
				$this->db->where('MRID.movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
				$this->db->order_by('MRID.renglon', 'ASC');

			}
			else
			{
				$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
		    	$this->db->where('RRI.orden_reparacion_interna_id', $intOrdenReparacionInternaID);
		    	$this->db->where('MRI.estatus', 'ACTIVO');
		    	$this->db->order_by('MRI.fecha DESC, MRI.folio DESC, MRID.renglon ASC');
			}
			
		}
		
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_detalles_salida($intTipoMovimiento, $intOrdenReparacionInternaID, 
										   $intNumRows, $intPos)
	{
		//Constante para identificar al tipo de movimiento entrada de refacciones internas por devolución del taller
		$intMovEntradaDevolucion = ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER;

		//Variable que se utiliza para asignar subconsulta de las entradas por devolución
		$strSubConsultaDevolucion = "(SELECT IFNULL(SUM(MRIDE.cantidad), 0)
										FROM movimientos_refacciones_internas_detalles AS MRIDE
										INNER JOIN movimientos_refacciones_internas AS MRIE ON MRIDE.movimiento_refacciones_internas_id = MRIE.movimiento_refacciones_internas_id
										WHERE MRIE.tipo_movimiento = $intMovEntradaDevolucion
										AND MRIE.referencia_id = MRI.movimiento_refacciones_internas_id
										AND MRIE.estatus = 'ACTIVO'
										AND MRIDE.refaccion_id = MRID.refaccion_id) AS cantidad_devolucion";

		//Seleccionar los registros sin límite que coincidan con los criterios de búsqueda
	    $this->db->select("MRID.cantidad, MRID.costo_unitario, MRI.estatus,
	    				   RRID.cantidad AS cantidad_solicitada,
	    				   $strSubConsultaDevolucion", FALSE);
		$this->db->from('requisiciones_refacciones_internas_detalles AS RRID');
		$this->db->join('requisiciones_refacciones_internas AS RRI', 
						'RRID.requisicion_refacciones_internas_id = RRI.requisicion_refacciones_internas_id', 'inner');
		$this->db->join('movimientos_refacciones_internas AS MRI', 
						'MRI.referencia_id = RRI.requisicion_refacciones_internas_id', 'inner');
		$this->db->join('movimientos_refacciones_internas_detalles AS MRID', 
						'MRI.movimiento_refacciones_internas_id = MRID.movimiento_refacciones_internas_id
						 AND MRID.refaccion_id = RRID.refaccion_id AND MRID.renglon = RRID.renglon', 'inner');
		$this->db->where('MRI.sucursal_id',  $this->session->userdata('sucursal_id'));
		$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
	    $this->db->where('RRI.orden_reparacion_interna_id', $intOrdenReparacionInternaID);
		$arrResultado["registros"] =$this->db->get()->result();
	
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MRI.folio, DATE_FORMAT(MRI.fecha,'%d/%m/%Y') AS fecha, MRI.estatus,
						   RRI.folio AS folio_requisicion,  MRID.codigo, MRID.descripcion, MRID.cantidad,
						   MRID.costo_unitario, RRID.cantidad AS cantidad_solicitada, 
						   $strSubConsultaDevolucion", FALSE);
		$this->db->from('requisiciones_refacciones_internas_detalles AS RRID');
		$this->db->join('requisiciones_refacciones_internas AS RRI', 
						'RRID.requisicion_refacciones_internas_id = RRI.requisicion_refacciones_internas_id', 'inner');
		$this->db->join('movimientos_refacciones_internas AS MRI', 
						'MRI.referencia_id = RRI.requisicion_refacciones_internas_id', 'inner');
		$this->db->join('movimientos_refacciones_internas_detalles AS MRID', 
						'MRI.movimiento_refacciones_internas_id = MRID.movimiento_refacciones_internas_id
						 AND MRID.refaccion_id = RRID.refaccion_id AND MRID.renglon = RRID.renglon', 'inner');
		$this->db->where('MRI.sucursal_id',  $this->session->userdata('sucursal_id'));
		$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
	    $this->db->where('RRI.orden_reparacion_interna_id', $intOrdenReparacionInternaID);
		$this->db->order_by('MRI.fecha DESC, MRI.folio DESC, MRID.renglon ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["detalles"] =$this->db->get()->result();
		return $arrResultado;
	}


	/********************************************************************************************************************
	*********************************************************************************************************************
	Funciones del proceso Salida de Refacciones Internas por Ajuste
	*********************************************************************************************************************
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la salida de refacciones internas por ajuste
	public function guardar_detalles_salida_por_ajuste(	$intMovimientoRefaccionesInternasID, 
														$dteFecha, 
														$intTipoMovimiento, 
														$strRefaccionInternaID, 
												      	$strCantidades, 
												      	$strPreciosUnitarios, 
												      	$strDescuentosUnitarios, 
												      	$strIvasUnitarios, 
												      	$strIepsUnitarios)
	{
		
		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el ID de la refacción, cantidad, precio unitario, descuento unitario, 
		  iva unitario e ieps unitario
		*/
		$arrRefaccionInternaID = explode("|", $strRefaccionInternaID);
		$arrCantidades = explode("|", $strCantidades);
		$arrPreciosUnitarios = explode("|", $strPreciosUnitarios);
		$arrDescuentosUnitarios = explode("|", $strDescuentosUnitarios);
		$arrIvasUnitarios = explode("|", $strIvasUnitarios);
		$arrIepsUnitarios = explode("|", $strIepsUnitarios);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_internas_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionInternaID); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionInternaID[$intCon];
			$intCantidad = $arrCantidades[$intCon];
			$intPrecioUnitario = $arrPreciosUnitarios[$intCon];

			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_internas_id' => $intMovimientoRefaccionesInternasID,
							  'renglon' => ($intCon + 1),
							  'refaccion_id' => $intRefaccionID, 
							  'cantidad' => $intCantidad,
							  'precio_unitario' => $intPrecioUnitario,
							  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
							  'iva_unitario' => $arrIvasUnitarios[$intCon], 
							  'ieps_unitario' => $arrIepsUnitarios[$intCon]);

			//Verificamos que la cantidad de elementos del detalle sea mayor a cero
			if( $intCantidad > 0 ){

				$this->db->insert('movimientos_refacciones_internas_detalles', $arrDatos);
				//Hacer un llamado al método para modificar el inventario de la refacción
	   			$this->modificar_inventario_refacciones($strAnio, $intTipoMovimiento, $intRefaccionID, $intCantidad, $intPrecioUnitario);
			
			}
			
		}

	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_salida_por_ajuste($intMovimientoRefaccionesInternasID, 
													  $intTipoMovimiento = NULL)
	{

		$intSucursalID = $this->session->userdata('sucursal_id');
		
		if ($intMovimientoRefaccionesInternasID !== NULL)
		{   
			$this->db->select("	 	MRI.folio, 
									DATE_FORMAT(MRI.fecha, '%d/%m/%Y') AS fecha, 
							        MRID.refaccion_id, 
							        MRID.cantidad, 
							        MRID.precio_unitario, 
							        MRID.descuento_unitario, 
							        MRID.iva_unitario, 
							        MRID.ieps_unitario, 
							        RI.descripcion, 
							        RI.codigo_01 AS codigo, 
							        RI.unidad
								FROM movimientos_refacciones_internas_detalles AS MRID
								INNER JOIN movimientos_refacciones_internas AS MRI ON MRID.movimiento_refacciones_internas_id = MRI.movimiento_refacciones_internas_id
								INNER JOIN refacciones_internas AS RI ON MRID.refaccion_id = RI.refaccion_id		 
								WHERE MRID.movimiento_refacciones_internas_id = $intMovimientoRefaccionesInternasID
								ORDER BY MRID.renglon ASC", FALSE);
		}

		return $this->db->get()->result();

	}


	/*******************************************************************************************************************
	Funciones del proceso Salidas de Refacciones Internas por Consumo Interno
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la salida por consumo interno
	public function guardar_detalles_salida_consumo_interno(stdClass $objMovimiento)
	{

		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $objMovimiento->dteFecha);
		$strAnio = $strFecha[0];

		/*Quitar | de la lista para obtener el ID de la refacción, código, descripción, código de la línea, cantidad y costo unitario 
		*/
		$arrRefaccionID = explode("|", $objMovimiento->strRefaccionID);
		$arrCodigos = explode("|", $objMovimiento->strCodigos);
		$arrDescripciones = explode("|", $objMovimiento->strDescripciones);
		$arrCodigosLineas = explode("|", $objMovimiento->strCodigosLineas);
		$arrCantidades = explode("|", $objMovimiento->strCantidades);
		$arrCostosUnitarios = explode("|", $objMovimiento->strCostosUnitarios);
		$arrSucursalID = explode("|", $objMovimiento->strSucursalID);
		$arrModuloID = explode("|", $objMovimiento->strModuloID);
		$arrGastoTipoID = explode("|", $objMovimiento->strGastoTipoID);

		//Hacer recorrido para insertar los datos en la tabla movimientos_refacciones_internas_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{

			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionID[$intCon];
			$intCantidad = $arrCantidades[$intCon];

			//Si no existe id de la sucursal asignar valor nulo
			$intSucursalID = (($arrSucursalID[$intCon] !== '') ? 
						   	   $arrSucursalID[$intCon] : NULL);

			//Si no existe id del módulo asignar valor nulo
			$intModuloID = (($arrModuloID[$intCon] !== '') ? 
						   	   $arrModuloID[$intCon] : NULL);

			//Asignar renglón consecutivo
			$intRenglon = ($intCon + 1);

			//Asignar datos al array
			$arrDatos = array('movimiento_refacciones_internas_id' => $objMovimiento->intMovimientoRefaccionesInternasID,
							  'renglon' => $intRenglon,
							  'refaccion_id' => $intRefaccionID, 
							  'codigo' => $arrCodigos[$intCon], 
							  'descripcion' => $arrDescripciones[$intCon], 
							  'codigo_linea' => $arrCodigosLineas[$intCon], 
							  'cantidad' => $intCantidad,
							  'costo_unitario' => $arrCostosUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_internas_detalles', $arrDatos);

			//Tabla movimientos_refacciones_internas_detalles_gastos
			$arrDatosGasto = array('movimiento_refacciones_internas_id' => $objMovimiento->intMovimientoRefaccionesInternasID,
								   'renglon' => $intRenglon,
								   'sucursal_id' => $intSucursalID, 
								   'modulo_id' => $intModuloID, 
								   'gasto_tipo_id' => $arrGastoTipoID[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('movimientos_refacciones_internas_detalles_gastos', $arrDatosGasto);

			//Hacer un llamado al método para modificar el inventario de la refacción
	   		$this->modificar_inventario_refacciones($strAnio, $objMovimiento->intTipoMovimiento, 
	   												$intRefaccionID, $intCantidad);

		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles_salida_consumo_interno($intMovimientoRefaccionesInternasID)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');

		$this->db->select("MRID.refaccion_id, MRID.codigo, MRID.descripcion, 
						   MRID.codigo_linea, MRID.cantidad, MRID.costo_unitario,
						   IFNULL(RII.actual_existencia, 0) AS actual_existencia, RII.localizacion,
						   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
						   RM.descripcion AS refacciones_marca,
						   MRIDG.sucursal_id, MRIDG.modulo_id, MRIDG.gasto_tipo_id,
						   GT.descripcion AS gasto,  GT.tipo_gasto,
						   S.nombre AS sucursal, M.descripcion AS modulo", FALSE);
		$this->db->from('movimientos_refacciones_internas_detalles AS MRID');
		$this->db->join('refacciones AS R', 'MRID.refaccion_id = R.refaccion_id', 'inner');
		$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
		$this->db->join('refacciones_marcas AS RM', 'R.refacciones_marca_id = RM.refacciones_marca_id', 'inner');
		$this->db->join('refacciones_internas_inventario AS RII', 'MRID.refaccion_id = RII.refaccion_id 
						 AND RII.sucursal_id = '.$intSucursalID.' AND RII.anio = YEAR(NOW())', 'left');
		$this->db->join('movimientos_refacciones_internas_detalles_gastos AS MRIDG', 
						'MRID.movimiento_refacciones_internas_id = MRIDG.movimiento_refacciones_internas_id 
						 AND MRID.renglon = MRIDG.renglon', 'left');
		$this->db->join('gastos_tipos AS GT', 'MRIDG.gasto_tipo_id = GT.gasto_tipo_id', 'left');
		$this->db->join('sucursales AS S', 'MRIDG.sucursal_id = S.sucursal_id', 'left');
		$this->db->join('modulos AS M', 'MRIDG.modulo_id = M.modulo_id', 'left');
		$this->db->where('MRID.movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
		$this->db->order_by('MRID.renglon', 'ASC');
		return $this->db->get()->result();
	}


	/*******************************************************************************************************************
	Funciones de la tabla refacciones_internas_inventario
	*********************************************************************************************************************/
	//Función que se utiliza para guardar las refacciones en el inventario
	public function guardar_refacciones_internas_inventario($dteFecha, $strRefaccionID, $strLocalizaciones = NULL)
	{
		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $dteFecha);
		$strAnio = $strFecha[0];

		//Quitar | de la lista para obtener el ID de la refacción y localización
		$arrRefaccionID = explode("|", $strRefaccionID);

		//Si existe el array de localizaciones 
		if($strLocalizaciones != NULL)
		{
			$arrLocalizaciones = explode("|", $strLocalizaciones);
		}
	
		//Hacer recorrido para insertar los datos en la tabla refacciones_internas_inventario
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Variables que se utilizan para obtener los valores del detalle (inventario)
			$intRefaccionID = $arrRefaccionID[$intCon];
			$strLocalizacion = '';

			//Si existe el array de localizaciones 
			if($strLocalizaciones != NULL)
			{
				$strLocalizacion = $arrLocalizaciones[$intCon];
			}

			//Seleccionar los datos de inventario de la refacción
			$otdInventario = $this->buscar_inventario_refaccion($intRefaccionID, $strAnio);

			//Si no existen datos del inventario
			if(!$otdInventario)
			{	
				//Asignar datos al array
				$arrDatos = array('refaccion_id' => $intRefaccionID,
						  	   	  'sucursal_id' => $this->session->userdata('sucursal_id'),
						  	   	  'anio' => $strAnio,
						  	   	  'localizacion' => $strLocalizacion,
								  'inicial_existencia' => 0,
								  'inicial_costo' => 0,
								  'actual_existencia' => 0,
								  'actual_costo' => 0);
				//Guardar los datos del registro
				$this->db->insert('refacciones_internas_inventario', $arrDatos);
			}
		}

	}

    //Función que se utiliza para modificar el inventario de una refacción del movimiento 
	public function modificar_inventario_refacciones($strAnio, $intTipoMovimiento, $intRefaccionID, 
													 $intCantidad, $intCostoUnitario = NULL)
	{
		
		//Actualizar existencia de la refacción en inventario
		//Seleccionar los datos de inventario de la refacción
		$otdInventario = $this->buscar_inventario_refaccion($intRefaccionID, $strAnio);
		
		//Asignar datos a las variables
		$intExistenciaActual = $otdInventario->actual_existencia;
		$intCostoActual = $otdInventario->actual_costo;

		//Si el tipo de movimiento corresponde a una entrada
		if($intTipoMovimiento < SALIDA_REFACCIONES_INTERNAS)
		{
			//Si el movimiento es de entrada a Almacén			
			if (($intExistenciaActual + $intCantidad) != 0)
			{
				//Calcular costo actual
				$intCostoActual = (($intCostoActual * $intExistenciaActual) + ($intCostoUnitario * $intCantidad)) / ($intExistenciaActual + $intCantidad);
			}
			else
			{
				//Asignar costo unitario
				$intCostoActual = $intCostoUnitario;
			}

			//Incrementar existencia actual
			$intExistenciaActual += $intCantidad;

			/*************************************************************************************
			* Agregar campos que se actualizaran en el inventario
			**************************************************************************************/
			$arrInventario = array('actual_existencia' => $intExistenciaActual,
							  	    'actual_costo' => $intCostoActual);
		}
		else
		{
			//Decrementar existencia actual
			$intExistenciaActual -= $intCantidad;

			/*************************************************************************************
			* Agregar campos que se actualizaran en el inventario
			**************************************************************************************/
			$arrInventario = array('actual_existencia' => $intExistenciaActual);
		}
		
		
		/*************************************************************************************
		* Actualizar datos del inventario por cada registro 
		* de la tabla refacciones_internas_inventario		
		**************************************************************************************/
		$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('anio', $strAnio);
		$this->db->where('refaccion_id', $intRefaccionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('refacciones_internas_inventario', $arrInventario);

	}


	//Función que se utiliza para modificar el historial de refacciones en el inventario
	public function modificar_historial_inventario_refacciones($intMovimientoRefaccionesInternasID, 
															   $intTipoMovimiento, 
															   $dteFecha)
	{
		//Quitar - de la fecha para obtener el año
		$strFecha = explode("-", $dteFecha);
		$strAnio = $strFecha[0];

		//Seleccionar los detalles del movimiento
		$otdDetalles = $this->buscar_detalles_movimiento($intMovimientoRefaccionesInternasID);

		//Hacer recorrido para actualizar los datos del inventario
	    foreach ($otdDetalles as $arrDet) 
		{
			//Asignar id de la refacción
			$intRefaccionID = $arrDet->refaccion_id;
			//Seleccionar los datos de inventario de la refacción
			$otdInventario = $this->buscar_inventario_refaccion($intRefaccionID, $strAnio);
			//Asignar datos a las variables
			$numCantidadActual = $otdInventario->inicial_existencia;
			$numCostoActual = $otdInventario->inicial_costo;

			//Seleccionar todos los movimientos activos de la refacción excluyendo el movimiento seleccionado
			$otdMovimientos = $this->buscar_movimientos_activos_refaccion($intRefaccionID, $strAnio, 
																		  $intMovimientoRefaccionesInternasID);

			//Si hay información de movimientos
			if($otdMovimientos)
			{
				//Recorremos el arreglo 
				foreach ($otdMovimientos as $arrMov) 
				{
					//Asignar tipo de movimiento
					$intTipoMovimiento = $arrMov->tipo_movimiento;

					//Si el tipo de movimiento corresponde a una entrada
					if ($intTipoMovimiento < SALIDA_REFACCIONES_INTERNAS)
					{
						//Calcular costo actual
						$numCostoActual = (($numCantidadActual * $numCostoActual) + ($arrMov->cantidad * $arrMov->costo_unitario));

						//Incrementar cantidad actual
						$numCantidadActual += $arrMov->cantidad;

					}
					else
					{
						//Calcular costo actual
						$numCostoActual = (($numCantidadActual * $numCostoActual) - ($arrMov->cantidad * $arrMov->costo_unitario));

						//Decrementar cantidad actual
						$numCantidadActual -= $arrMov->cantidad;

					}
					
					//Si hay existencia
					if ($numCantidadActual <> 0)
					{
						//Calcular costo actual
						$numCostoActual = $numCostoActual / $numCantidadActual;
					}
				}

			}//Cierre de verificación de movimientos de refacciones


			/*************************************************************************************
			* Array ques se utiliza para actualizar datos del inventario
			**************************************************************************************/
			$arrInventario = array('actual_costo' => $numCostoActual, 
								   'actual_existencia' => $numCantidadActual);
			
			/*************************************************************************************
			* Actualizar datos del inventario por cada registro 
			* de la tabla refacciones_internas_inventario		
			**************************************************************************************/
			$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('anio', $strAnio);
			$this->db->where('refaccion_id', $intRefaccionID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('refacciones_internas_inventario', $arrInventario);

		}//Cierre de foreach detalles del movimiento
	}


	//Método para regresar los datos de inventario que coinciden con los criterios de búsqueda proporcionados
	public function buscar_inventario_refaccion($intRefaccionID, $strAnio)
	{

		$this->db->select('inicial_existencia, inicial_costo, actual_existencia, actual_costo');
		$this->db->from('refacciones_internas_inventario');
		//Verificamos la existencia de la sucursal loggeada
		$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('anio', $strAnio);
		$this->db->where('refaccion_id', $intRefaccionID);
		$this->db->limit(1);
		return $this->db->get()->row();

	}

	//Método para regresar todos los movimientos activos de una refacción excluyendo el movimiento proporcionado
	function buscar_movimientos_activos_refaccion($intRefaccionID, $strAnio, $intMovimientoRefaccionesInternasID)
	{
		$this->db->select('MRI.movimiento_refacciones_internas_id, MRI.tipo_movimiento, MRI.fecha, 
						   MRI.fecha_creacion, MRI.fecha_actualizacion, 
						   MRID.refaccion_id, MRID.renglon, MRID.cantidad,  MRID.costo_unitario');
		$this->db->from('movimientos_refacciones_internas AS MRI');
		$this->db->join('movimientos_refacciones_internas_detalles AS MRID', 'MRI.movimiento_refacciones_internas_id = MRID.movimiento_refacciones_internas_id', 'inner');
		$this->db->where('MRID.refaccion_id', $intRefaccionID);
		$this->db->where('MRI.fecha >=', $strAnio.'-01-01');
		$this->db->where('MRI.fecha <=', $strAnio.'-12-31');
		$this->db->where('MRI.estatus <>', 'INACTIVO');
		$this->db->where('MRI.movimiento_refacciones_internas_id <>', $intMovimientoRefaccionesInternasID);
		$this->db->order_by('MRI.fecha, MRI.fecha_creacion, MRI.fecha_actualizacion', 'ASC');
		return $this->db->get()->result();
	}

	

	//Método para obtener solo los renglones de los detalles pertenecientes a ese movimiento
	function buscar_renglones_movimiento($intMovimientoRefaccionesInternasID)
	{
		$this->db->select('renglon');
		$this->db->from('movimientos_refacciones_internas_detalles');
		$this->db->where('movimiento_refacciones_internas_id', $intMovimientoRefaccionesInternasID);
		$this->db->order_by('renglon', 'ASC');
		return $this->db->get()->result();
	}


	/*******************************************************************************************************************
	Funciones de la tabla requisiciones_refacciones_internas
	*********************************************************************************************************************/
	//Método para modificar el estatus de la requisición de refacciones internas
	public function set_estatus_requisicion_refacciones_internas($intRequisicionRefaccionesInternasID, $strEstatus)
	{
		//Asignar datos al array
		$arrDatos = array('estatus' => $strEstatus,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('requisicion_refacciones_internas_id', $intRequisicionRefaccionesInternasID);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    return $this->db->update('requisiciones_refacciones_internas', $arrDatos);
	}

	//Método para regresar el total de movimientos activos que coincidan con los criterios de búsqueda proporcionados
	public function buscar_total_movimientos_requisicion_refacciones_internas($intTipoMovimiento, 
																			  $intRequisicionRefaccionesInternasID)
	{
		$this->db->select('COUNT(MRI.movimiento_refacciones_internas_id) AS total_movimientos');
		$this->db->from('movimientos_refacciones_internas AS MRI');
		$this->db->join('requisiciones_refacciones_internas AS RRI', 
						'MRI.referencia_id = RRI.requisicion_refacciones_internas_id', 'inner');
		$this->db->where('MRI.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MRI.tipo_movimiento', $intTipoMovimiento);
		$this->db->where('MRI.referencia_id', $intRequisicionRefaccionesInternasID);
		$this->db->where('MRI.estatus', 'ACTIVO');
		$this->db->limit(1);
		return $this->db->get()->row();
	}


	
	/*******************************************************************************************************************
	Funciones de la tabla back_order_internos
	*********************************************************************************************************************/
	//Método para guardar los datos de un pedido pendiente de la requisición de refacciones internas
	public function guardar_pedido_pendiente($intRequisicionRefaccionesInternasID, $intRenglon, 
											 $intCantidad, $strEstatus)
	{

		//Asignar datos al array
		$arrDatos = array('requisicion_refacciones_internas_id' => $intRequisicionRefaccionesInternasID, 
						  'renglon' => $intRenglon, 
						  'cantidad' => $intCantidad, 
						  'estatus' => $strEstatus,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('back_order_internos', $arrDatos);
	}

	//Método para modificar los datos de un pedido pendiente de la requisición de refacciones internas
	public function modificar_pedido_pendiente($intBackOrderInternoID, $intCantidad, $strEstatus)
	{
		//Asignar datos al array
		$arrDatos = array('cantidad' => $intCantidad, 
			              'estatus' => $strEstatus,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('back_order_interno_id', $intBackOrderInternoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('back_order_internos', $arrDatos);
	}

	//Método para eliminar los pedidos pendientes de una requisición de refacciones internas
	public function eliminar_pedidos_requisicion_refacciones($intRequisicionRefaccionesInternasID)
	{
		//Eliminar datos de la tabla back_order_internos
		$this->db->where('requisicion_refacciones_internas_id', $intRequisicionRefaccionesInternasID);
		return $this->db->delete('back_order_internos');
	}

}
?>