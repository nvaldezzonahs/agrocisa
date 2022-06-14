<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de mensajes (para guardar el mensaje que se envía a los usuarios)
include_once(APPPATH . 'models/administracion/Mensajes_model.php');

class Ordenes_compra_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla ordenes_compra
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objOrdenCompra)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
		
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objOrdenCompra->strFolio); 

		//Tabla ordenes_compra
		//Asignar datos al array
		$arrDatos = array('folio' => $strFolioConsecutivo, 
						  'fecha' => $objOrdenCompra->dteFecha, 
						  'fecha_entrega' => $objOrdenCompra->dteFechaEntrega,
						  'fecha_vencimiento' => $objOrdenCompra->dteFechaVencimiento,
						  'condiciones_pago' => $objOrdenCompra->strCondicionesPago,
						  'moneda_id' => $objOrdenCompra->intMonedaID, 
						  'tipo_cambio' => $objOrdenCompra->intTipoCambio, 
						  'factura' => $objOrdenCompra->strFactura, 
						  'proveedor_id' => $objOrdenCompra->intProveedorID, 
						  'regimen_fiscal_id' => $objOrdenCompra->intRegimenFiscalID, 
						  'solicita_id' => $objOrdenCompra->intSolicitaID,
						  'sucursal_id' => $objOrdenCompra->intSucursalID,
						  'departamento_id' => $objOrdenCompra->intDepartamentoID,
						  'porcentaje_retencion_id' => $objOrdenCompra->intPorcentajeRetencionID,
						  'importe_retenido' => $objOrdenCompra->intImporteRetenido,
						  'observaciones' => $objOrdenCompra->strObservaciones, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objOrdenCompra->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('ordenes_compra', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objOrdenCompra->intOrdenCompraID = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la orden de compra
		$this->guardar_detalles($objOrdenCompra);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objOrdenCompra->intOrdenCompraID.'_'.$strFolioConsecutivo;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objOrdenCompra)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla ordenes_compra
		//Asignar datos al array
		$arrDatos = array('fecha' => $objOrdenCompra->dteFecha, 
						  'fecha_entrega' => $objOrdenCompra->dteFechaEntrega,
						  'fecha_vencimiento' => $objOrdenCompra->dteFechaVencimiento,
						  'condiciones_pago' => $objOrdenCompra->strCondicionesPago,
						  'moneda_id' => $objOrdenCompra->intMonedaID, 
						  'tipo_cambio' => $objOrdenCompra->intTipoCambio, 
						  'factura' => $objOrdenCompra->strFactura, 
						  'proveedor_id' => $objOrdenCompra->intProveedorID, 
						  'regimen_fiscal_id' => $objOrdenCompra->intRegimenFiscalID, 
						  'solicita_id' => $objOrdenCompra->intSolicitaID,
						  'sucursal_id' => $objOrdenCompra->intSucursalID,
						  'departamento_id' => $objOrdenCompra->intDepartamentoID,
						  'porcentaje_retencion_id' => $objOrdenCompra->intPorcentajeRetencionID,
						  'importe_retenido' => $objOrdenCompra->intImporteRetenido,
						  'observaciones' => $objOrdenCompra->strObservaciones, 
						  'estatus' => 'ACTIVO', 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objOrdenCompra->intUsuarioID);
		$this->db->where('orden_compra_id', $objOrdenCompra->intOrdenCompraID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('ordenes_compra', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('orden_compra_id', $objOrdenCompra->intOrdenCompraID);
		$this->db->delete('ordenes_compra_detalles_02');
		//Hacer un llamado al método para guardar los detalles de la orden de compra
		$this->guardar_detalles($objOrdenCompra);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intOrdenCompraID, $strEstatus)
	{
		//Si el estatus del registro es ACTIVO
		if($strEstatus == 'ACTIVO')
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
		$this->db->where('orden_compra_id', $intOrdenCompraID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('ordenes_compra', $arrDatos);
	}

	//Método para enviar la autorización (o rechazo) de un registro
	public function set_enviar_autorizacion($intOrdenCompraID, $strUsuarios, $strMensaje, $strEstatus)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (Mensajes) 
        $otdModelMensajes = new  Mensajes_model();

		//Si existe estatus
		if($strEstatus !== NULL)
		{
			//Tabla ordenes_compra
			//Si el estatus del registro es AUTORIZADO
			if($strEstatus == 'AUTORIZADO')
			{
				//Asignar datos al array
				$arrDatos = array('estatus' => $strEstatus,
								  'fecha_autorizacion' => date("Y-m-d H:i:s"),
								  'usuario_autorizacion' => $this->session->userdata('usuario_id'));
			}
			else
			{
				//Asignar datos al array
				$arrDatos = array('estatus' => $strEstatus,
								  'fecha_actualizacion' => date("Y-m-d H:i:s"),
								  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
			}
			$this->db->where('orden_compra_id', $intOrdenCompraID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('ordenes_compra', $arrDatos);
		}
		
        //Hacer un llamado al método para guardar el mensaje que se envía a los usuarios
		$otdModelMensajes->guardar('ORDENES DE COMPRA', $intOrdenCompraID, $strUsuarios, $strMensaje);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intOrdenCompraID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{

		$this->db->select("OC.orden_compra_id, OC.folio, DATE_FORMAT(OC.fecha,'%d/%m/%Y') AS fecha, 
						   DATE_FORMAT(OC.fecha_entrega,'%d/%m/%Y') AS fecha_entrega,
						   DATE_FORMAT(OC.fecha_vencimiento,'%d/%m/%Y') AS fecha_vencimiento, 
						   OC.condiciones_pago, OC.moneda_id, OC.tipo_cambio, OC.factura, OC.proveedor_id, 
						   IFNULL(OC.regimen_fiscal_id,'') AS regimen_fiscal_id, OC.solicita_id, OC.sucursal_id, OC.departamento_id,
						   OC.porcentaje_retencion_id, OC.importe_retenido, OC.observaciones, OC.estatus,
						   CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor, P.dias_credito,
						   P.regimen_fiscal_id AS regimenFiscalIDProv, 
						   P.correo_electronico, P.contacto_correo_electronico,
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS solicita,
						   S.nombre AS sucursal, D.descripcion AS departamento, P.rfc, P.telefono_principal,  
						   P.calle, P.numero_exterior, P.numero_interior, P.colonia,  
						   P.localidad, MP.descripcion AS municipio, EP.descripcion AS estado,
						   CP.codigo_postal, M.codigo AS codigo_moneda, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, 
						   PIsr.porcentaje AS porcentaje_isr, 
						   UC.usuario AS usuario_creacion, 
						   UA.usuario AS usuario_autorizacion, 
						   DATE_FORMAT(OC.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
	    $this->db->from('ordenes_compra AS OC');
	    $this->db->join('sat_monedas AS M', 'OC.moneda_id = M.moneda_id', 'inner');
		$this->db->join('empleados AS E', 'OC.solicita_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sucursales AS S',  'OC.sucursal_id = S.sucursal_id', 'left');
		$this->db->join('departamentos AS D', 'OC.departamento_id = D.departamento_id', 'left');
		$this->db->join('usuarios AS UC', 'OC.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('usuarios AS UA', 'OC.usuario_autorizacion = UA.usuario_id', 'left');
		$this->db->join('porcentaje_retencion_isr AS PIsr', 'OC.porcentaje_retencion_id = PIsr.porcentaje_retencion_id', 'left');

		//Si existe id de la orden de compra
		if ($intOrdenCompraID != NULL)
		{   
			$this->db->where('OC.orden_compra_id', $intOrdenCompraID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			//Si existe id del proveedor
		    if($intProveedorID > 0)
		    {
		   		$this->db->where('OC.proveedor_id', $intProveedorID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(OC.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('OC.estatus', $strEstatus);
			}

		    $this->db->where("((OC.folio LIKE '%$strBusqueda%') OR
        				      (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			                  (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('OC.fecha DESC, OC.folio DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						                     $intProveedorID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;

		$this->db->select("DISTINCT M.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS descripcion", FALSE);
		$this->db->from('ordenes_compra AS OC');
		$this->db->join('sat_monedas AS M', 'OC.moneda_id = M.moneda_id', 'inner');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'inner');
	 	$this->db->where('M.moneda_id <>', $intMonedaBase);
		//Si existe id del proveedor
	    if($intProveedorID > 0)
	    {
	   		$this->db->where('OC.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OC.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OC.estatus', $strEstatus);
		}

		$this->db->where("((OC.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
		$this->db->order_by('M.moneda_id', 'ASC');
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProveedorID = NULL,
		                   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('OC.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OC.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OC.estatus', $strEstatus);
		}

		$this->db->where("((OC.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->from('ordenes_compra AS OC');
	    $this->db->join('sat_monedas AS M', 'OC.moneda_id = M.moneda_id', 'inner');
		$this->db->join('empleados AS E', 'OC.solicita_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("OC.orden_compra_id, OC.folio, DATE_FORMAT(OC.fecha,'%d/%m/%Y') AS fecha, 
						   OC.estatus, CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor", FALSE);
		$this->db->from('ordenes_compra AS OC');
	    $this->db->join('sat_monedas AS M', 'OC.moneda_id = M.moneda_id', 'inner');
		$this->db->join('empleados AS E', 'OC.solicita_id = E.empleado_id', 'inner');
		$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'inner');
		$this->db->join('municipios AS MP', 'P.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
	    //Si existe id del proveedor
	    if($intProveedorID != NULL)
	    {
	   		$this->db->where('OC.proveedor_id', $intProveedorID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(OC.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('OC.estatus', $strEstatus);
		}

		$this->db->where("((OC.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))");

		$this->db->order_by('OC.fecha DESC, OC.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["ordenes"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros autorizados que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strTipo = NULL)
	{
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID =  $this->session->userdata('sucursal_id');
		//Asignar el id de la moneda base (peso mexicano)
    	$intMonedaBaseID = MONEDA_BASE;
		//Asignar número de registros para el autocomplete
    	$intLimite = LIMITE_AUTOCOMPLETE;

		//Si el Autocomplete es por tasas (generales, especiales, maquinaria, servicio y refacciones)
		if($strTipo == 'tasas')
		{

			//Variable que se utiliza para formar la  consulta
			$queryOrdenesCompra = '';

		    //Variables para definir que tipos de módulo se incluiran en la búsqueda
		    //Ordenes de compra de maquinaria
			$queryMaquinaria = "SELECT Reg.orden_compra_maquinaria_id AS referencia_id, 
			 						  'MAQUINARIA' AS tipo_referencia, Reg.folio,
									   Reg.factura, Reg.proveedor_id,
								       CONCAT(Reg.folio,' - ', 'MAQUINARIA', ' - ',' IVA %: ',TIva.valor_maximo,
								     	     '  ',IFNULL(CONCAT('IEPS%: ',TIeps.valor_maximo),'')) AS orden_compra,
								       CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor,
								       Det.tasa_cuota_iva,  TIva.valor_maximo AS porcentaje_iva, 
								       Det.tasa_cuota_ieps, TIeps.valor_maximo AS porcentaje_ieps
								FROM ordenes_compra_maquinaria AS Reg
								INNER JOIN proveedores AS P ON Reg.proveedor_id = P.proveedor_id
								INNER JOIN ordenes_compra_maquinaria_detalles AS Det ON Reg.orden_compra_maquinaria_id = Det.orden_compra_maquinaria_id
								INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
							    LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
								WHERE  Reg.sucursal_id = $intSucursalID
							    AND Reg.estatus = 'AUTORIZADO'
							    AND Reg.moneda_id =  $intMonedaBaseID
							    AND (CONCAT_WS(' - ', Reg.folio, 'MAQUINARIA') LIKE '%$strDescripcion%' OR 
			    					 CONCAT_WS('-', Reg.folio, 'MAQUINARIA') LIKE '%$strDescripcion%')
			    			    GROUP BY Reg.orden_compra_maquinaria_id, Det.tasa_cuota_iva, Det.tasa_cuota_ieps";


			//Entradas de refacciones por compra
			$queryRefacciones = "SELECT Reg.movimiento_refacciones_id AS referencia_id, 
										'REFACCIONES' AS tipo_referencia, Reg.folio,
										Reg.factura, Reg.proveedor_id,
								    	CONCAT(Reg.folio,' - ', 'REFACCIONES', ' - ',' IVA %: ',TIva.valor_maximo,
								     	      '  ',IFNULL(CONCAT('IEPS%: ',TIeps.valor_maximo),'')) AS orden_compra,
								     	CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor,
								    	Det.tasa_cuota_iva,  TIva.valor_maximo AS porcentaje_iva, 
								    	Det.tasa_cuota_ieps, TIeps.valor_maximo AS porcentaje_ieps
								 FROM movimientos_refacciones AS Reg
								 INNER JOIN proveedores AS P ON Reg.proveedor_id = P.proveedor_id
								 INNER JOIN movimientos_refacciones_detalles AS Det ON Reg.movimiento_refacciones_id = Det.movimiento_refacciones_id
								 INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
							     LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
								 WHERE  Reg.sucursal_id = $intSucursalID
							     AND  Reg.estatus = 'ACTIVO'
							     AND Reg.moneda_id =  $intMonedaBaseID
							     AND (CONCAT_WS(' - ', Reg.folio, 'REFACCIONES') LIKE '%$strDescripcion%' OR 
			    					  CONCAT_WS('-', Reg.folio, 'REFACCIONES') LIKE '%$strDescripcion%')
			    				 GROUP BY Reg.movimiento_refacciones_id, Det.tasa_cuota_iva, Det.tasa_cuota_ieps";
			    				     			    
			//Ordenes de compra generales
			$queryGeneral = "SELECT Reg.orden_compra_id AS referencia_id, 
								    'GENERAL' AS tipo_referencia,  
								    Reg.folio, Reg.factura, Reg.proveedor_id,
									CONCAT(Reg.folio, ' - ',
									       'GENERAL', ' - ',' IVA %: ',TIva.valor_maximo,'  ',
									       IFNULL(CONCAT('IEPS%: ',TIeps.valor_maximo),'')) AS orden_compra,
									CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor,
									Det.tasa_cuota_iva,  TIva.valor_maximo AS porcentaje_iva, 
								    Det.tasa_cuota_ieps, TIeps.valor_maximo AS porcentaje_ieps
							 FROM ordenes_compra AS Reg
							 INNER JOIN proveedores AS P ON Reg.proveedor_id = P.proveedor_id
							 INNER JOIN ordenes_compra_detalles_02 AS Det ON Reg.orden_compra_id = Det.orden_compra_id
							 INNER JOIN  sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
							 LEFT JOIN  sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
							 WHERE Reg.orden_compra_id NOT IN (SELECT TF.orden_compra_id FROM  trabajos_foraneos_02 AS TF)
							 AND Reg.orden_compra_id NOT IN (SELECT TFI.orden_compra_id FROM  trabajos_foraneos_internos AS TFI)
							 AND Reg.estatus = 'AUTORIZADO'
							 AND Reg.moneda_id =  $intMonedaBaseID
						     AND (CONCAT_WS(' - ', Reg.folio, 'GENERAL') LIKE '%$strDescripcion%' OR 
		    					  CONCAT_WS('-', Reg.folio, 'GENERAL') LIKE '%$strDescripcion%')
		    			     GROUP BY Reg.orden_compra_id, Det.tasa_cuota_iva, Det.tasa_cuota_ieps";


		    //Ordenes de compra de servicio (trabajos foráneos)
			$queryServicio = "SELECT Reg.trabajo_foraneo_id AS referencia_id, 
								    'SERVICIO' AS tipo_referencia,  
								     Reg.folio, Reg.factura, 
								     CASE 
									   WHEN  OC.orden_compra_id > 0 
									   		THEN  OC.proveedor_id
										    ELSE OCS.proveedor_id
								      END AS proveedor_id,

								      CASE 
									   WHEN  OC.orden_compra_id > 0 
									   		THEN  
									   			 CONCAT(Reg.folio, ' - ',
												       'SERVICIO', ' - ',' IVA %: ',TIva.valor_maximo,'  ',
												       IFNULL(CONCAT('IEPS%: ',TIeps.valor_maximo),''))

										    ELSE 
										    	 CONCAT(Reg.folio, ' - ',
												       'SERVICIO', ' - ',' IVA %: ',TIvaS.valor_maximo,'  ',
												       IFNULL(CONCAT('IEPS%: ',TIepsS.valor_maximo),''))
								      END AS orden_compra,
								      CASE 
									   WHEN  OC.orden_compra_id > 0 
									   		THEN  CONCAT_WS(' - ', P.codigo, P.razon_social)
										    ELSE CONCAT_WS(' - ', PS.codigo, PS.razon_social)
								      END AS proveedor,
								      CASE 
									   WHEN  OC.orden_compra_id > 0 
									   		THEN  Det.tasa_cuota_iva
										    ELSE DetS.tasa_cuota_iva
								      END AS tasa_cuota_iva,
								      CASE 
									   WHEN  OC.orden_compra_id > 0 
									   		THEN  TIva.valor_maximo
										    ELSE TIvaS.valor_maximo
								      END AS porcentaje_iva,

								      CASE 
									   WHEN  OC.orden_compra_id > 0 
									   		THEN  Det.tasa_cuota_ieps
										    ELSE DetS.tasa_cuota_ieps
								      END AS tasa_cuota_ieps,
								      CASE 
									   WHEN  OC.orden_compra_id > 0 
									   		THEN  TIeps.valor_maximo
										    ELSE TIepsS.valor_maximo
								      END AS porcentaje_ieps
							  FROM trabajos_foraneos_02 AS Reg
							  LEFT JOIN ordenes_compra AS OC ON Reg.orden_compra_id = OC.orden_compra_id
							  AND Reg.tipo_referencia = 'GENERAL'
							  LEFT JOIN proveedores AS P ON OC.proveedor_id = P.proveedor_id
							  LEFT JOIN ordenes_compra_detalles_02 AS Det ON OC.orden_compra_id = Det.orden_compra_id
							  LEFT JOIN  sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
							  LEFT JOIN  sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
							  LEFT JOIN ordenes_compra_servicio AS OCS ON Reg.orden_compra_id = OCS.orden_compra_servicio_id
							  AND Reg.tipo_referencia = 'SERVICIO'
							  LEFT JOIN proveedores AS PS ON OCS.proveedor_id = PS.proveedor_id
							  LEFT JOIN ordenes_compra_servicio_detalles AS DetS ON OCS.orden_compra_servicio_id = DetS.orden_compra_servicio_id
							  LEFT JOIN  sat_tasa_cuota AS TIvaS ON DetS.tasa_cuota_iva = TIvaS.tasa_cuota_id
							  LEFT JOIN  sat_tasa_cuota AS TIepsS ON DetS.tasa_cuota_ieps = TIepsS.tasa_cuota_id
							  WHERE  Reg.sucursal_id = $intSucursalID
							  AND Reg.estatus = 'ACTIVO'
							  AND Reg.moneda_id =  $intMonedaBaseID
						      AND (CONCAT_WS(' - ', Reg.folio, 'SERVICIO') LIKE '%$strDescripcion%' OR 
		    					   CONCAT_WS('-', Reg.folio, 'SERVICIO') LIKE '%$strDescripcion%')
		    				  GROUP BY Reg.trabajo_foraneo_id, Det.tasa_cuota_iva, Det.tasa_cuota_ieps, 
		    				  		   DetS.tasa_cuota_iva, DetS.tasa_cuota_ieps";

		    //Ordenes de compra de servicio interno (trabajos foráneos internos)
			$queryServicioInterno = "SELECT Reg.trabajo_foraneo_interno_id AS referencia_id, 
								    'SERVICIO INTERNO' AS tipo_referencia,  
								     Reg.folio, Reg.factura, OC.proveedor_id,
									 CONCAT(Reg.folio, ' - ',
									       'SERVICIO INTERNO', ' - ',' IVA %: ',TIva.valor_maximo,'  ',
									       IFNULL(CONCAT('IEPS%: ',TIeps.valor_maximo),'')) AS orden_compra,
									CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor,
									Det.tasa_cuota_iva,  TIva.valor_maximo AS porcentaje_iva, 
								    Det.tasa_cuota_ieps, TIeps.valor_maximo AS porcentaje_ieps
								  FROM trabajos_foraneos_internos AS Reg
								  INNER JOIN ordenes_compra AS OC ON Reg.orden_compra_id = OC.orden_compra_id
								  INNER JOIN proveedores AS P ON OC.proveedor_id = P.proveedor_id
								  INNER JOIN ordenes_compra_detalles_02 AS Det ON OC.orden_compra_id = Det.orden_compra_id
								  INNER JOIN  sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
								  LEFT JOIN  sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
								  WHERE  Reg.sucursal_id = $intSucursalID
								  AND Reg.estatus = 'ACTIVO'
								  AND Reg.moneda_id =  $intMonedaBaseID
							      AND (CONCAT_WS(' - ', Reg.folio, 'SERVICIO INTERNO') LIKE '%$strDescripcion%' OR 
			    					   CONCAT_WS('-', Reg.folio, 'SERVICIO INTERNO') LIKE '%$strDescripcion%')
			    				  GROUP BY Reg.trabajo_foraneo_interno_id, Det.tasa_cuota_iva, Det.tasa_cuota_ieps";


			//Ordenes de compra especiales
			$queryEspecial = "SELECT Reg.orden_compra_especial_id AS referencia_id,
									 'ESPECIAL' AS tipo_referencia, Reg.folio, Reg.factura, Reg.proveedor_id,
								     CONCAT(Reg.folio,' - ', 'ESPECIAL', ' - ',' IVA %: ',TIva.valor_maximo,
								     	    '  ',IFNULL(CONCAT('IEPS%: ',TIeps.valor_maximo),'')) AS orden_compra,
								     CONCAT_WS(' - ', P.codigo, P.razon_social) AS proveedor,
								     Det.tasa_cuota_iva,  TIva.valor_maximo AS porcentaje_iva, 
								     Det.tasa_cuota_ieps, TIeps.valor_maximo AS porcentaje_ieps
							  FROM ordenes_compra_especiales AS Reg
							  INNER JOIN proveedores AS P ON Reg.proveedor_id = P.proveedor_id
							  INNER JOIN ordenes_compra_especiales_detalles AS Det ON Reg.orden_compra_especial_id = Det.orden_compra_especial_id
							  INNER JOIN sat_tasa_cuota AS TIva ON Det.tasa_cuota_iva = TIva.tasa_cuota_id
							  LEFT JOIN sat_tasa_cuota AS TIeps ON Det.tasa_cuota_ieps = TIeps.tasa_cuota_id
						      WHERE Reg.estatus = 'AUTORIZADO'
						      AND Reg.moneda_id =  $intMonedaBaseID
						      AND (CONCAT_WS(' - ', Reg.folio, 'ESPECIAL') LIKE '%$strDescripcion%' OR 
		    					   CONCAT_WS('-', Reg.folio, 'ESPECIAL') LIKE '%$strDescripcion%')
		    				  GROUP BY Reg.orden_compra_especial_id, Det.tasa_cuota_iva, Det.tasa_cuota_ieps";
			

			//Formar consulta
		    $queryOrdenesCompra .= $queryMaquinaria;
		    $queryOrdenesCompra .= " UNION ";
		    $queryOrdenesCompra .= $queryRefacciones;
		    $queryOrdenesCompra .= " UNION ";
		    $queryOrdenesCompra .= $queryGeneral;
		    $queryOrdenesCompra .= " UNION ";
		    $queryOrdenesCompra .= $queryServicio;
		    $queryOrdenesCompra .= " UNION ";
		    $queryOrdenesCompra .= $queryServicioInterno;
		    $queryOrdenesCompra .= " UNION ";
		    $queryOrdenesCompra .= $queryEspecial;
			$queryOrdenesCompra .= " ORDER BY folio ASC";
			$queryOrdenesCompra .= " LIMIT 0, $intLimite";
			$strSQL = $this->db->query($queryOrdenesCompra);
			return $strSQL->result();

		}
		else
		{

			$this->db->select("	OC.orden_compra_id, 
								CONCAT_WS(' - ', OC.folio, P.razon_social) AS orden_compra", FALSE);
			$this->db->from('ordenes_compra AS OC');
			$this->db->join('proveedores AS P', 'OC.proveedor_id = P.proveedor_id', 'inner');
			$this->db->where('OC.estatus', 'AUTORIZADO');
			$this->db->where("(OC.folio LIKE '%$strDescripcion%' OR 
							   P.razon_social LIKE '%$strDescripcion%')"); 
			$this->db->order_by("OC.folio",'ASC');
			$this->db->limit($intLimite, 0);
			return $this->db->get()->result();
		}
	}



	/*******************************************************************************************************************
	Funciones de la tabla ordenes_compra_detalles_02
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la orden de compra
	public function guardar_detalles(stdClass $objOrdenCompra)
	{
		/*Quitar | de la lista para obtener el ID de la sucursal, ID del módulo, ID del tipo de gasto, 
		 ID del vehículo, concepto, cantidad, precio unitario,
		 descuento unitario, iva unitario e ieps unitario
		*/
		$arrSucursalID = explode("|", $objOrdenCompra->strSucursalID);
		$arrModuloID = explode("|", $objOrdenCompra->strModuloID);
		$arrGastoTipoID = explode("|", $objOrdenCompra->strGastoTipoID);
		$arrVehiculoID = explode("|", $objOrdenCompra->strVehiculoID);
		$arrConceptos = explode("|", $objOrdenCompra->strConceptos);
		$arrCantidades = explode("|", $objOrdenCompra->strCantidades);
		$arrPreciosUnitarios = explode("|", $objOrdenCompra->strPreciosUnitarios);
		$arrDescuentosUnitarios = explode("|", $objOrdenCompra->strDescuentosUnitarios);
		$arrTasaCuotaIva = explode("|", $objOrdenCompra->strTasaCuotaIva);
		$arrIvasUnitarios = explode("|", $objOrdenCompra->strIvasUnitarios);
		$arrTasaCuotaIeps = explode("|", $objOrdenCompra->strTasaCuotaIeps);
		$arrIepsUnitarios = explode("|", $objOrdenCompra->strIepsUnitarios);
		$arrRetencionIsr = explode("|", $objOrdenCompra->strRetencionIsr);
		$arrRetencionesIsrUnitarios = explode("|", $objOrdenCompra->strRetencionesIsrUnitarios);
		$arrRetencionIva = explode("|", $objOrdenCompra->strRetencionIva);
		$arrRetencionesIvaUnitarios = explode("|", $objOrdenCompra->strRetencionesIvaUnitarios);

		//Hacer recorrido para insertar los datos en la tabla ordenes_compra_detalles_02
		for ($intCon = 0; $intCon < sizeof($arrConceptos); $intCon++) 
		{
			//Si no existe id de la sucursal asignar valor nulo
			$intSucursalID = (($arrSucursalID[$intCon] !== '') ? 
						   	   $arrSucursalID[$intCon] : NULL);

			//Si no existe id del módulo asignar valor nulo
			$intModuloID = (($arrModuloID[$intCon] !== '') ? 
						   	   $arrModuloID[$intCon] : NULL);

			//Si no existe id del vehículo asignar valor nulo
			$intVehiculoID = (($arrVehiculoID[$intCon] !== '') ? 
						   	 $arrVehiculoID[$intCon] : NULL);

			//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
			$intTasaCuotaIeps = (($arrTasaCuotaIeps[$intCon] !== '') ? 
						   	  	  $arrTasaCuotaIeps[$intCon] : NULL);

			//Si no existe porcentaje de la retención de ISR asignar valor nulo
			$intRetencionIsr = (($arrRetencionIsr[$intCon] !== '') ? 
						   	  	 $arrRetencionIsr[$intCon] : NULL);

			//Si no existe porcentaje de la retención de IVA asignar valor nulo
			$intRetencionIva = (($arrRetencionIva[$intCon] !== '') ? 
						   	  	 $arrRetencionIva[$intCon] : NULL);


			//Asignar datos al array
			$arrDatos = array('orden_compra_id' => $objOrdenCompra->intOrdenCompraID,
							  'renglon' => ($intCon + 1),
							  'sucursal_id' => $intSucursalID,
							  'modulo_id' => $intModuloID,
							  'gasto_tipo_id' => $arrGastoTipoID[$intCon],
							  'vehiculo_id' => $intVehiculoID,
							  'concepto' => $arrConceptos[$intCon], 
							  'cantidad' => $arrCantidades[$intCon],
							  'precio_unitario' => $arrPreciosUnitarios[$intCon],
							  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
							  'tasa_cuota_iva' => $arrTasaCuotaIva[$intCon], 
							  'iva_unitario' => $arrIvasUnitarios[$intCon], 
							  'tasa_cuota_ieps' => $intTasaCuotaIeps, 
							  'ieps_unitario' => $arrIepsUnitarios[$intCon],
							  'retencion_isr' => $intRetencionIsr, 
							  'retencion_isr_unitario' => $arrRetencionesIsrUnitarios[$intCon],
							  'retencion_iva' => $intRetencionIva, 
							  'retencion_iva_unitario' => $arrRetencionesIvaUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('ordenes_compra_detalles_02', $arrDatos);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intOrdenCompraID)
	{
		
		$this->db->select("OCD.renglon, OCD.sucursal_id, OCD.modulo_id, OCD.gasto_tipo_id, 
						   OCD.vehiculo_id, OCD.concepto, OCD.cantidad, OCD.precio_unitario, 
						   OCD.descuento_unitario, OCD.tasa_cuota_iva, OCD.iva_unitario, 
						   OCD.tasa_cuota_ieps, OCD.ieps_unitario, OCD.retencion_isr,
						   OCD.retencion_isr_unitario,  OCD.retencion_iva,
						   OCD.retencion_iva_unitario, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps,
						   TIeps.valor_minimo AS  valor_minimo_ieps, TIeps.tipo AS tipo_ieps, 
						   TIeps.factor AS factor_ieps, 
						   GT.descripcion AS gasto,  GT.tipo_gasto, GT.parque_vehicular,
						   GT.retencion_iva AS retencion_iva_gasto,  GT.retencion_isr AS retencion_isr_gasto, 
						   CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas) AS vehiculo,
						   S.nombre AS sucursal, M.descripcion AS modulo", FALSE);
		$this->db->from('ordenes_compra_detalles_02 OCD');
		$this->db->join('sat_tasa_cuota AS TIva', 'OCD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'OCD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('gastos_tipos AS GT', 'OCD.gasto_tipo_id = GT.gasto_tipo_id', 'left');
		$this->db->join('sucursales AS S', 'OCD.sucursal_id = S.sucursal_id', 'left');
		$this->db->join('modulos AS M', 'OCD.modulo_id = M.modulo_id', 'left');
		$this->db->join('vehiculos AS V', 'OCD.vehiculo_id = V.vehiculo_id', 'left');
		$this->db->where('OCD.orden_compra_id', $intOrdenCompraID);
		$this->db->order_by('OCD.renglon', 'ASC');
		return $this->db->get()->result();

	}
}	
?>