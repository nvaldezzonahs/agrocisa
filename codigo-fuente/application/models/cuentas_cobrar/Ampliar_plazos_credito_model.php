<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ampliar_plazos_credito_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla ampliar_plazos_credito
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objAmpliarPlazoCredito)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Asignar datos al array
		$arrDatos = array('tipo_referencia' => $objAmpliarPlazoCredito->strTipoReferencia, 
						  'referencia_id' => $objAmpliarPlazoCredito->intReferenciaID, 
						  'vencimiento' => $objAmpliarPlazoCredito->dteVencimiento,
						  'dias' => $objAmpliarPlazoCredito->intDias,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objAmpliarPlazoCredito->intUsuarioID);
		
		//Si existe renglón, modificar la forma de pago del pedido de maquinaria
		if($objAmpliarPlazoCredito->intRenglon > 0  && 
		   $objAmpliarPlazoCredito->strTipoReferencia == 'MAQUINARIA')
		{
			$arrDatos['renglon'] = $objAmpliarPlazoCredito->intRenglon;
			$arrDatos['documento_pago_id'] = $objAmpliarPlazoCredito->intDocumentoPagoID;
		}	


		//Guardar los datos del registro
		$this->db->insert('ampliar_plazos_credito', $arrDatos);

		//Hacer un llamado al método para modificar la fecha de vencimiento de la factura
		$this->modificar_vencimiento_factura($objAmpliarPlazoCredito);

		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intAmpliarPlazoCreditoID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
		                   $intProspectoID = NULL, $strTipoReferencia = NULL, $strBusqueda = NULL)
	{

		$this->db->select("APC.tipo_referencia, APC.referencia_id,  APC.renglon, APC.documento_pago_id,
						    DATE_FORMAT(APC.vencimiento,'%d/%m/%Y') AS vencimiento,
			    		   APC.dias,  
			    		   DATE_FORMAT(ADDDATE(APC.vencimiento, INTERVAL APC.dias DAY), '%d/%m/%Y') AS nuevo_vencimiento,
			    		   DP.descripcion AS documento_pago, PMP.importe,
			    		   IFNULL(FM.factura_maquinaria_id, 0) AS factura_maquinaria_id,
						   CASE 
							   WHEN  UC.empleado_id > 0 THEN 
							         CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre)
								  ELSE UC.usuario  
						   END AS empleado_autorizacion", FALSE);
	    $this->db->from('ampliar_plazos_credito AS APC');
		$this->db->join('facturas_maquinaria AS FM', '(APC.referencia_id = FM.factura_maquinaria_id OR 								 APC.referencia_id = FM.pedido_maquinaria_id)
						 AND APC.tipo_referencia = "MAQUINARIA"', 'left');
		$this->db->join('clientes AS CFM', 'FM.prospecto_id = CFM.prospecto_id', 'left');
		$this->db->join('pedidos_maquinaria AS PM', 'FM.pedido_maquinaria_id = PM.pedido_maquinaria_id', 'left');
		$this->db->join('pedidos_maquinaria_pago AS PMP', 'PM.pedido_maquinaria_id = PMP.pedido_maquinaria_id
						 AND PMP.renglon = APC.renglon', 'left');
		$this->db->join('documentos_pagos AS DP', 'APC.documento_pago_id = DP.documento_pago_id', 'left');	
		$this->db->join('facturas_refacciones AS FR', 'APC.referencia_id = FR.factura_refacciones_id 
						 AND APC.tipo_referencia = "REFACCIONES"', 'left');
	    $this->db->join('clientes AS CFR', 'FR.prospecto_id = CFR.prospecto_id', 'left');
		$this->db->join('facturas_servicio AS FS', 'APC.referencia_id = FS.factura_servicio_id 
						 AND APC.tipo_referencia = "SERVICIO"', 'left');
		$this->db->join('clientes AS CFS', 'FS.prospecto_id = CFS.prospecto_id', 'left');
	   	$this->db->join('cartera AS C', 'APC.referencia_id = C.cartera_id 
						 AND APC.tipo_referencia = "CARTERA"', 'left');
	   	$this->db->join('clientes AS CC', 'C.prospecto_id = CC.prospecto_id', 'left');
		$this->db->join('usuarios AS UC', 'APC.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('empleados AS E', 'UC.empleado_id = E.empleado_id', 'left');

		//Si existe id del plazo del crédito
		if ($intAmpliarPlazoCreditoID != NULL)
		{   
			$this->db->where('APC.ampliar_plazo_credito_id', $intAmpliarPlazoCreditoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			//Si existe id del prospecto
		    if($intProspectoID != NULL)
		    {
		   		$this->db->where("(FM.prospecto_id = $intProspectoID OR 
		   		 				   FR.prospecto_id = $intProspectoID OR 
		   		 				   FS.prospecto_id = $intProspectoID OR
		   		 				   C.prospecto_id = $intProspectoID)");
		    }

			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(APC.vencimiento BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }

		    //Si existe tipo de referencia
			if($strTipoReferencia != 'TODOS')
			{
				$this->db->where('APC.tipo_referencia', $strTipoReferencia);
			}


		    $this->db->where("((APC.tipo_referencia LIKE '%$strBusqueda%') OR
							   (FM.folio LIKE '%$strBusqueda%') OR
		    				   (FR.folio LIKE '%$strBusqueda%') OR
		    				   (FS.folio LIKE '%$strBusqueda%') OR
		    				   (C.folio LIKE '%$strBusqueda%') OR 
		    				   (CONCAT_WS(' - ', FM.folio, DP.descripcion) LIKE '%$strBusqueda%') OR
		    				   (CFM.razon_social LIKE '%$strBusqueda%') OR 
		    				   (CFR.razon_social LIKE '%$strBusqueda%') OR
		    				   (CFS.razon_social LIKE '%$strBusqueda%') OR
		    				   (CC.razon_social LIKE '%$strBusqueda%') OR
		    				   (UC.usuario LIKE '%$strBusqueda%') OR 
		    				   (CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
			        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
						       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
						       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
						       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('APC.vencimiento', 'DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_monedas($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
		                   					 $intProspectoID = NULL, $strTipoReferencia = NULL, 
		                   					 $strBusqueda = NULL)
	{
		//Constante para identificar el ID de la moneda que corresponde al peso mexicano
        $intMonedaBase = MONEDA_BASE;
        
		$this->db->select("DISTINCT 
						   CASE 
							   WHEN  FM.factura_maquinaria_id > 0 
							   	 THEN MFM.moneda_id
							   WHEN  FR.factura_refacciones_id > 0  
							   	 THEN MFR.moneda_id
							   WHEN  FS.factura_servicio_id > 0 
							  	 THEN MFS.moneda_id 
							   ELSE  MC.moneda_id
						   END AS moneda_id,
						   CASE 
							   WHEN  FM.factura_maquinaria_id > 0
							   	THEN CONCAT_WS(' - ', MFM.codigo, MFM.descripcion)
							   WHEN  FR.factura_refacciones_id > 0 
							   	THEN CONCAT_WS(' - ', MFR.codigo, MFR.descripcion)
							   WHEN  FS.factura_servicio_id > 0 
							   	THEN CONCAT_WS(' - ', MFS.codigo, MFS.descripcion)
							   ELSE  
							   	  CONCAT_WS(' - ', MC.codigo, MC.descripcion)
						   END AS descripcion", FALSE);
		$this->db->from('ampliar_plazos_credito AS APC');
		$this->db->join('facturas_maquinaria AS FM', '(APC.referencia_id = FM.factura_maquinaria_id OR 								 APC.referencia_id = FM.pedido_maquinaria_id)
						 AND APC.tipo_referencia = "MAQUINARIA"', 'left');
		$this->db->join('clientes AS CFM', 'FM.prospecto_id = CFM.prospecto_id', 'left');
		$this->db->join('pedidos_maquinaria AS PM', 'FM.pedido_maquinaria_id = PM.pedido_maquinaria_id', 'left');
		$this->db->join('pedidos_maquinaria_pago AS PMP', 'PM.pedido_maquinaria_id = PMP.pedido_maquinaria_id
						 AND PMP.renglon = APC.renglon', 'left');
		$this->db->join('documentos_pagos AS DP', 'APC.documento_pago_id = DP.documento_pago_id', 'left');
		$this->db->join('sat_monedas AS MFM', 'FM.moneda_id = MFM.moneda_id', 'left');
		$this->db->join('facturas_refacciones AS FR', 'APC.referencia_id = FR.factura_refacciones_id 
						 AND APC.tipo_referencia = "REFACCIONES"', 'left');
	    $this->db->join('clientes AS CFR', 'FR.prospecto_id = CFR.prospecto_id', 'left');
	    $this->db->join('sat_monedas AS MFR', 'FR.moneda_id = MFR.moneda_id', 'left');
		$this->db->join('facturas_servicio AS FS', 'APC.referencia_id = FS.factura_servicio_id 
						 AND APC.tipo_referencia = "SERVICIO"', 'left');
		$this->db->join('clientes AS CFS', 'FS.prospecto_id = CFS.prospecto_id', 'left');
		$this->db->join('sat_monedas AS MFS', 'FS.moneda_id = MFS.moneda_id', 'left');
	   	$this->db->join('cartera AS C', 'APC.referencia_id = C.cartera_id 
						 AND APC.tipo_referencia = "CARTERA"', 'left');
	   	$this->db->join('clientes AS CC', 'C.prospecto_id = CC.prospecto_id', 'left');
	   	$this->db->join('sat_monedas AS MC', 'C.moneda_id = MC.moneda_id', 'left');
		$this->db->join('usuarios AS UC', 'APC.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('empleados AS E', 'UC.empleado_id = E.empleado_id', 'left');
		$this->db->where("(MFM.moneda_id <> $intMonedaBase OR 
	 				       MFR.moneda_id <> $intMonedaBase OR 
	 				       MFS.moneda_id <> $intMonedaBase OR
	 				       MC.moneda_id <> $intMonedaBase)");

		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where("(FM.prospecto_id = $intProspectoID OR 
	   		 				   FR.prospecto_id = $intProspectoID OR 
	   		 				   FS.prospecto_id = $intProspectoID OR
	   		 				   C.prospecto_id = $intProspectoID)");
	    }

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(APC.vencimiento BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe tipo de referencia
		if($strTipoReferencia != 'TODOS')
		{
			$this->db->where('APC.tipo_referencia', $strTipoReferencia);
		}


	    $this->db->where("((APC.tipo_referencia LIKE '%$strBusqueda%') OR
						   (FM.folio LIKE '%$strBusqueda%') OR
	    				   (FR.folio LIKE '%$strBusqueda%') OR
	    				   (FS.folio LIKE '%$strBusqueda%') OR
	    				   (C.folio LIKE '%$strBusqueda%') OR 
	    				   (CONCAT_WS(' - ', FM.folio, DP.descripcion) LIKE '%$strBusqueda%') OR
	    				   (CFM.razon_social LIKE '%$strBusqueda%') OR 
	    				   (CFR.razon_social LIKE '%$strBusqueda%') OR
	    				   (CFS.razon_social LIKE '%$strBusqueda%') OR
	    				   (CC.razon_social LIKE '%$strBusqueda%') OR
	    				   (UC.usuario LIKE '%$strBusqueda%') OR 
	    				   (CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
		        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))");  

		$this->db->order_by('moneda_id', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL,
						   $strTipoReferencia = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where("(FM.prospecto_id = $intProspectoID OR 
	   		 				   FR.prospecto_id = $intProspectoID OR 
	   		 				   FS.prospecto_id = $intProspectoID OR
	   		 				   C.prospecto_id = $intProspectoID)");
	    }

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(APC.vencimiento BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe tipo de referencia
		if($strTipoReferencia != 'TODOS')
		{
			$this->db->where('APC.tipo_referencia', $strTipoReferencia);
		}


	    $this->db->where("((APC.tipo_referencia LIKE '%$strBusqueda%') OR
						   (FM.folio LIKE '%$strBusqueda%') OR
	    				   (FR.folio LIKE '%$strBusqueda%') OR
	    				   (FS.folio LIKE '%$strBusqueda%') OR
	    				   (C.folio LIKE '%$strBusqueda%') OR 
	    				   (CONCAT_WS(' - ', FM.folio, DP.descripcion) LIKE '%$strBusqueda%') OR
	    				   (CFM.razon_social LIKE '%$strBusqueda%') OR 
	    				   (CFR.razon_social LIKE '%$strBusqueda%') OR
	    				   (CFS.razon_social LIKE '%$strBusqueda%') OR
	    				   (CC.razon_social LIKE '%$strBusqueda%') OR
	    				   (UC.usuario LIKE '%$strBusqueda%') OR 
	    				   (CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
		        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))"); 
		
		$this->db->from('ampliar_plazos_credito AS APC');
		$this->db->join('facturas_maquinaria AS FM', '(APC.referencia_id = FM.factura_maquinaria_id OR 								 APC.referencia_id = FM.pedido_maquinaria_id)
						 AND APC.tipo_referencia = "MAQUINARIA"', 'left');
		$this->db->join('clientes AS CFM', 'FM.prospecto_id = CFM.prospecto_id', 'left');
		$this->db->join('pedidos_maquinaria AS PM', 'FM.pedido_maquinaria_id = PM.pedido_maquinaria_id', 'left');
		$this->db->join('pedidos_maquinaria_pago AS PMP', 'PM.pedido_maquinaria_id = PMP.pedido_maquinaria_id
						 AND PMP.renglon = APC.renglon', 'left');
		$this->db->join('documentos_pagos AS DP', 'APC.documento_pago_id = DP.documento_pago_id', 'left');	
		$this->db->join('facturas_refacciones AS FR', 'APC.referencia_id = FR.factura_refacciones_id 
						 AND APC.tipo_referencia = "REFACCIONES"', 'left');
	    $this->db->join('clientes AS CFR', 'FR.prospecto_id = CFR.prospecto_id', 'left');
		$this->db->join('facturas_servicio AS FS', 'APC.referencia_id = FS.factura_servicio_id 
						 AND APC.tipo_referencia = "SERVICIO"', 'left');
		$this->db->join('clientes AS CFS', 'FS.prospecto_id = CFS.prospecto_id', 'left');
	   	$this->db->join('cartera AS C', 'APC.referencia_id = C.cartera_id 
						 AND APC.tipo_referencia = "CARTERA"', 'left');
	   	$this->db->join('clientes AS CC', 'C.prospecto_id = CC.prospecto_id', 'left');
		$this->db->join('usuarios AS UC', 'APC.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('empleados AS E', 'UC.empleado_id = E.empleado_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("APC.ampliar_plazo_credito_id, APC.tipo_referencia, APC.referencia_id,
						   DATE_FORMAT(APC.vencimiento,'%d/%m/%Y') AS vencimiento,
						   DATE_FORMAT(ADDDATE(APC.vencimiento, INTERVAL APC.dias DAY), '%d/%m/%Y') AS nuevo_vencimiento,
						   CASE 
							   WHEN  APC.documento_pago_id > 0
							   		THEN CONCAT_WS(' - ', FM.folio, DP.descripcion) 
							   WHEN  FR.factura_refacciones_id > 0
							   		THEN FR.folio
							   WHEN  FS.factura_servicio_id > 0
							   		THEN FS.folio
							   WHEN  C.cartera_id > 0
							    	THEN C.folio
							   ELSE 
							   		FM.folio
						   END AS folio,
						   CASE 
							   WHEN  APC.documento_pago_id > 0
							   		THEN CFM.razon_social
							   WHEN  FR.factura_refacciones_id > 0
							   		THEN CFR.razon_social
							   WHEN  FS.factura_servicio_id > 0
							   		THEN CFS.razon_social
							   WHEN  C.cartera_id > 0
							    	THEN CC.razon_social
							   ELSE 
							   		CFM.razon_social
						   END AS razon_social,
						   CASE 
							   WHEN  UC.empleado_id > 0 THEN 
							         CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre)
								  ELSE UC.usuario  
						   END AS empleado_autorizacion", FALSE);
		$this->db->from('ampliar_plazos_credito AS APC');
		$this->db->join('facturas_maquinaria AS FM', '(APC.referencia_id = FM.factura_maquinaria_id OR 								 APC.referencia_id = FM.pedido_maquinaria_id)
						 AND APC.tipo_referencia = "MAQUINARIA"', 'left');
		$this->db->join('clientes AS CFM', 'FM.prospecto_id = CFM.prospecto_id', 'left');
		$this->db->join('pedidos_maquinaria AS PM', 'FM.pedido_maquinaria_id = PM.pedido_maquinaria_id', 'left');
		$this->db->join('pedidos_maquinaria_pago AS PMP', 'PM.pedido_maquinaria_id = PMP.pedido_maquinaria_id
						 AND PMP.renglon = APC.renglon', 'left');
		$this->db->join('documentos_pagos AS DP', 'APC.documento_pago_id = DP.documento_pago_id', 'left');	
		$this->db->join('facturas_refacciones AS FR', 'APC.referencia_id = FR.factura_refacciones_id 
						 AND APC.tipo_referencia = "REFACCIONES"', 'left');
	    $this->db->join('clientes AS CFR', 'FR.prospecto_id = CFR.prospecto_id', 'left');
		$this->db->join('facturas_servicio AS FS', 'APC.referencia_id = FS.factura_servicio_id 
						 AND APC.tipo_referencia = "SERVICIO"', 'left');
		$this->db->join('clientes AS CFS', 'FS.prospecto_id = CFS.prospecto_id', 'left');
	   	$this->db->join('cartera AS C', 'APC.referencia_id = C.cartera_id 
						 AND APC.tipo_referencia = "CARTERA"', 'left');
	   	$this->db->join('clientes AS CC', 'C.prospecto_id = CC.prospecto_id', 'left');
		$this->db->join('usuarios AS UC', 'APC.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('empleados AS E', 'UC.empleado_id = E.empleado_id', 'left');

		//Si existe id del prospecto
	    if($intProspectoID != NULL)
	    {
	   		$this->db->where("(FM.prospecto_id = $intProspectoID OR 
	   		 				   FR.prospecto_id = $intProspectoID OR 
	   		 				   FS.prospecto_id = $intProspectoID OR
	   		 				   C.prospecto_id = $intProspectoID)");
	    }

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(APC.vencimiento BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe tipo de referencia
		if($strTipoReferencia != 'TODOS')
		{
			$this->db->where('APC.tipo_referencia', $strTipoReferencia);
		}


		$this->db->where("((APC.tipo_referencia LIKE '%$strBusqueda%') OR
						   (FM.folio LIKE '%$strBusqueda%') OR
	    				   (FR.folio LIKE '%$strBusqueda%') OR
	    				   (FS.folio LIKE '%$strBusqueda%') OR
	    				   (C.folio LIKE '%$strBusqueda%') OR 
	    				   (CONCAT_WS(' - ', FM.folio, DP.descripcion) LIKE '%$strBusqueda%') OR
	    				   (CFM.razon_social LIKE '%$strBusqueda%') OR 
	    				   (CFR.razon_social LIKE '%$strBusqueda%') OR
	    				   (CFS.razon_social LIKE '%$strBusqueda%') OR
	    				   (CC.razon_social LIKE '%$strBusqueda%') OR
	    				   (UC.usuario LIKE '%$strBusqueda%') OR 
	    				   (CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
		        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('APC.vencimiento', 'DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["plazos"] =$this->db->get()->result();
		return $arrResultado;

	}


	/*******************************************************************************************************************
	Funciones de las tablas facturas_maquinaria, facturas_refacciones, facturas_servicio y cartera
	*********************************************************************************************************************/
	//Función que se utiliza para modificar la fecha de vencimiento de una factura
	public function modificar_vencimiento_factura(stdClass $objAmpliarPlazoCredito)
	{
		//Si existe renglón, modificar la forma de pago del pedido de maquinaria
		if($objAmpliarPlazoCredito->intRenglon > 0  && 
			$objAmpliarPlazoCredito->strTipoReferencia == 'MAQUINARIA')
		{
			//Variables que se utilizan para indicar que la fecha de vencimiento pertenece a una forma de pago
			$strTabla = 'pedidos_maquinaria_pago';

			//Asignar datos al array
			$arrDatos = array('vencimiento' => $objAmpliarPlazoCredito->dteNuevoVencimiento,
							  'documento_pago_id' => $objAmpliarPlazoCredito->intNuevoDocumentoPagoID);
			$this->db->where('pedido_maquinaria_id', $objAmpliarPlazoCredito->intReferenciaID);
			$this->db->where('renglon', $objAmpliarPlazoCredito->intRenglon);
		}
		else
		{
			//Dependiendo del tipo de referencia actualizar los datos del registro
			if($objAmpliarPlazoCredito->strTipoReferencia == 'MAQUINARIA')
			{
				//Variables que se utilizan para indicar que la fecha de vencimiento pertenece a una factura de maquinaria 
				$strTabla = 'facturas_maquinaria';
				$strCampoClaveID = 'factura_maquinaria_id';

			}
			else if($objAmpliarPlazoCredito->strTipoReferencia == 'REFACCIONES')
			{
				//Variables que se utilizan para indicar que la fecha de vencimiento pertenece a una factura de refacciones 
				$strTabla = 'facturas_refacciones';
				$strCampoClaveID = 'factura_refacciones_id';
			}
			else if($objAmpliarPlazoCredito->strTipoReferencia == 'SERVICIO')
			{
				//Variables que se utilizan para indicar que la fecha de vencimiento pertenece a una factura de servicio 
				$strTabla = 'facturas_servicio';
				$strCampoClaveID = 'factura_servicio_id';
			}
			else if($objAmpliarPlazoCredito->strTipoReferencia == 'CARTERA')
			{
				//Variables que se utilizan para indicar que la fecha de vencimiento pertenece a la cartera
				$strTabla = 'cartera';
				$strCampoClaveID = 'cartera_id';
			}
			
			//Asignar datos al array
			$arrDatos = array('vencimiento' => $objAmpliarPlazoCredito->dteNuevoVencimiento, 
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $objAmpliarPlazoCredito->intUsuarioID);
			$this->db->where($strCampoClaveID, $objAmpliarPlazoCredito->intReferenciaID);
			
		}
		
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update($strTabla, $arrDatos);
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		//Variable que se utiliza para formar la  consulta
		$queryFacturas = '';
		//Asignar número de registros para el autocomplete
    	$intLimite = LIMITE_AUTOCOMPLETE;

    	//Variables para definir que tipos de módulo se incluiran en la búsqueda
		//Facturas de maquinaria con formas de pago
		$queryMaquinaria = "SELECT Reg.factura_maquinaria_id AS referencia_id,
								  'MAQUINARIA' AS tipo_referencia,
								   CASE 
									   WHEN  PMP.documento_pago_id > 0 
									   	  THEN CONCAT(Reg.folio,' - ', DP.descripcion, ' $', FORMAT(PMP.importe,2), ', MAQUINARIA')
									   ELSE 
									   	  CONCAT_WS(' - ', Reg.folio, 'MAQUINARIA')
								   END AS referencia,
								  Reg.pedido_maquinaria_id, PMP.renglon, PMP.documento_pago_id,
								  DP.descripcion AS documento_pago,
								  PMP.importe, DATE_FORMAT(PMP.vencimiento,'%d/%m/%Y') AS vencimiento
						    FROM  facturas_maquinaria AS Reg
						    INNER JOIN pedidos_maquinaria AS PM ON Reg.pedido_maquinaria_id = PM.pedido_maquinaria_id
						    LEFT JOIN pedidos_maquinaria_pago AS PMP ON PM.pedido_maquinaria_id = PMP.pedido_maquinaria_id
						    LEFT JOIN documentos_pagos AS DP ON PMP.documento_pago_id = DP.documento_pago_id
							WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR') 
						    AND (Reg.folio LIKE '%$strDescripcion%' OR 
						    	 CONCAT(Reg.folio,' - ', DP.descripcion, ', MAQUINARIA') LIKE '%$strDescripcion%' OR
		    					  CONCAT_WS(' - ', Reg.folio, 'MAQUINARIA') LIKE '%$strDescripcion%' OR 
		    					  CONCAT_WS('-', Reg.folio, 'MAQUINARIA') LIKE '%$strDescripcion%')";

		//Facturas de refacciones
		$queryRefacciones = "SELECT Reg.factura_refacciones_id AS referencia_id, 
								   'REFACCIONES' AS tipo_referencia,
								    CONCAT_WS(' - ', Reg.folio, 'REFACCIONES') AS referencia,
								    0 AS pedido_maquinaria_id, 0 AS renglon, 0 AS documento_pago_id,
								    '' AS documento_pago, 0  AS importe, '' AS vencimiento 
						    FROM  facturas_refacciones AS Reg
						    WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR') 
						    AND (Reg.folio LIKE '%$strDescripcion%' OR 
		    					 CONCAT_WS(' - ', Reg.folio, 'REFACCIONES') LIKE '%$strDescripcion%' OR 
		    					 CONCAT_WS('-', Reg.folio, 'REFACCIONES') LIKE '%$strDescripcion%')";

		//Facturas de servicio
		$queryServicio = "SELECT Reg.factura_servicio_id AS referencia_id, 
								 'SERVICIO' AS tipo_referencia,
								  CONCAT_WS(' - ', Reg.folio, 'SERVICIO') AS referencia,
								 0 AS pedido_maquinaria_id, 0 AS renglon, 0 AS documento_pago_id,
								 '' AS documento_pago, 0  AS importe, '' AS vencimiento 
						  FROM  facturas_servicio AS Reg
						  WHERE (Reg.estatus = 'ACTIVO' OR Reg.estatus = 'TIMBRAR') 
						  AND (Reg.folio LIKE '%$strDescripcion%' OR 
		    				   CONCAT_WS(' - ', Reg.folio, 'SERVICIO') LIKE '%$strDescripcion%' OR 
		    				   CONCAT_WS('-', Reg.folio, 'SERVICIO') LIKE '%$strDescripcion%')";

		//Cartera
		$queryCartera = "SELECT Reg.cartera_id AS referencia_id,
								'CARTERA' AS tipo_referencia,
								CONCAT_WS(' - ', Reg.folio, 'CARTERA') AS referencia,
								0 AS pedido_maquinaria_id, 0 AS renglon, 0 AS documento_pago_id,
								'' AS documento_pago, 0  AS importe, '' AS vencimiento  
						  FROM  cartera AS Reg
						  WHERE (Reg.folio LIKE '%$strDescripcion%' OR 
		    				   CONCAT_WS(' - ', Reg.folio, 'CARTERA') LIKE '%$strDescripcion%' OR 
		    				   CONCAT_WS('-', Reg.folio, 'CARTERA') LIKE '%$strDescripcion%')";


		//Formar consulta
		$queryFacturas .= $queryMaquinaria;
	    $queryFacturas .= " UNION ";
		$queryFacturas .= $queryRefacciones;
		$queryFacturas .= " UNION ";
		$queryFacturas .= $queryServicio;
		$queryFacturas .= " UNION ";
		$queryFacturas .= $queryCartera;
		$queryFacturas .= " ORDER BY referencia ASC ";
		$queryFacturas .= " LIMIT 0, $intLimite";

	    $strSQL = $this->db->query($queryFacturas);
		return $strSQL->result();
	}
}
?>