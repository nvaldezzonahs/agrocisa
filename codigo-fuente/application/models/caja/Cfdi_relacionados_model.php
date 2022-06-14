<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cfdi_relacionados_model extends CI_model {
	
	//Método para guardar los CFDI relacionados de un registro
	public function guardar($intReferenciaID, $strTipoReferencia, $strCfdiRelacionado, $strTipoRelacion)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		
		//Eliminar los cfdi relacionados guardados
		$this->db->where('referencia_id', $intReferenciaID);
		$this->db->where('tipo_referencia', $strTipoReferencia);
		$this->db->delete('cfdi_relacionados');

		//Verificamos que el movimiento cuente con CFDIs relacionados
		if($strCfdiRelacionado != ""){

			/*Quitar | de la lista para obtener el CFDI relacionado y tipo de relación*/
			$arrCfdiRelacionado = explode("|", $strCfdiRelacionado);
			$arrTipoRelacion = explode("|", $strTipoRelacion);

			//Hacer recorrido para insertar los datos en la tabla cfdi_relacionados
			for ($intCon = 0; $intCon < sizeof($arrCfdiRelacionado); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('referencia_id' => $intReferenciaID,
								  'tipo_referencia' => $strTipoReferencia,
								  'renglon' => ($intCon + 1),
								  'cfdi_relacionado' => $arrCfdiRelacionado[$intCon], 
								  'tipo_relacion' => $arrTipoRelacion[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('cfdi_relacionados', $arrDatos);
			}

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
	public function buscar($intReferenciaID = NULL, $strTipoReferencia = NULL, $dteFechaInicial = NULL, 
						   $dteFechaFinal = NULL, $intProspectoID = NULL)
	{
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución de la factura
		$intMovDevRef = ENTRADA_REFACCIONES_DEVOLUCION_FACTURA;
		//Constante para identificar al tipo de movimiento entrada de maquinaria por devolución de la factura
		$intMovDevMaq = ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA;

		//Variable que se utiliza para formar la  consulta
		$queryCfdi = '';

		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		//Prospecto
		$strRestriccionesProspecto = '';
		//ID de la referencia
		$strRestriccionesReferencia = '';
		//UUID
		$strRestriccionesUUID = '';
		//Fecha
		$strRestriccionesFecha = '';

		//Variables que se utilizan para agregar union con la tabla cfdi_relacionados
		$strUnionCfdiRelAnticipo = '';
		$strUnionCfdiRelApliAnticipo = '';
		$strUnionCfdiRelFactMaq = '';
		$strUnionCfdiRelDevMaq = '';
		$strUnionCfdiRelFactRef = '';
		$strUnionCfdiRelDevRef = '';
		$strUnionCfdiRelFactServ = '';
		$strUnionCfdiRelDevServ = '';
		$strUnionCfdiRelFactConceptos = '';
		$strUnionCfdiRelPago = '';
		$strUnionCfdiRelNotaCred = '';
		$strUnionCfdiRelNotaCargo = '';
		$strUnionCfdiRelCartera = '';

		//Variable que se utiliza para agregar los campos de la tabla cfdi_relacionados
		$strCampoRenglon = '';

		//Variable que se utiliza para ordenar los registros dependiendo del tipo de búsqueda
		$strOrdenamiento = "ORDER BY ";

		//Si existe id de la referencia
		if ($intReferenciaID != NULL)
		{
			$strCampoRenglon = ", CFDR.renglon";

			$strRestriccionesReferencia .= "WHERE CFDR.referencia_id = $intReferenciaID";
			$strRestriccionesReferencia .= " AND CFDR.tipo_referencia = '$strTipoReferencia'";

			//Relacionar tablas: anticipos y cfdi_relacionados
			$strUnionCfdiRelAnticipo .= "INNER JOIN cfdi_relacionados AS CFDR ON Reg.anticipo_id = CFDR.cfdi_relacionado ";
			$strUnionCfdiRelAnticipo .= "AND CFDR.tipo_relacion = 'ANTICIPO'";

			//Relacionar tablas: anticipos_aplicacion y cfdi_relacionados
			$strUnionCfdiRelApliAnticipo .= "INNER JOIN cfdi_relacionados AS CFDR ON 
											 			Reg.anticipo_aplicacion_id = CFDR.cfdi_relacionado ";
			$strUnionCfdiRelApliAnticipo .= "AND CFDR.tipo_relacion = 'APLICACION ANTICIPO'";


			//Relacionar tablas: facturas_maquinaria y cfdi_relacionados
			$strUnionCfdiRelFactMaq .= "INNER JOIN cfdi_relacionados AS CFDR ON 
											       Reg.factura_maquinaria_id = CFDR.cfdi_relacionado ";
			$strUnionCfdiRelFactMaq .= "AND CFDR.tipo_relacion = 'FACTURA MAQUINARIA'";


			//Relacionar tablas: movimientos_maquinaria y cfdi_relacionados
			$strUnionCfdiRelDevMaq .= "INNER JOIN cfdi_relacionados AS CFDR ON 
												  Reg.movimiento_maquinaria_id = CFDR.cfdi_relacionado ";
			$strUnionCfdiRelDevMaq .= "AND CFDR.tipo_relacion = 'DEVOLUCION MAQUINARIA'";

			//Relacionar tablas: facturas_refacciones y cfdi_relacionados
			$strUnionCfdiRelFactRef .= "INNER JOIN cfdi_relacionados AS CFDR ON 
												   Reg.factura_refacciones_id = CFDR.cfdi_relacionado ";
			$strUnionCfdiRelFactRef .= "AND CFDR.tipo_relacion = 'FACTURA REFACCIONES'";


			//Relacionar tablas: movimientos_refacciones y cfdi_relacionados
			$strUnionCfdiRelDevRef .= "INNER JOIN cfdi_relacionados AS CFDR ON 
												  Reg.movimiento_refacciones_id = CFDR.cfdi_relacionado ";
			$strUnionCfdiRelDevRef .= "AND CFDR.tipo_relacion = 'DEVOLUCION REFACCIONES'";


			//Relacionar tablas: facturas_servicio y cfdi_relacionados
			$strUnionCfdiRelFactServ .= "INNER JOIN cfdi_relacionados AS CFDR ON 
													Reg.factura_servicio_id = CFDR.cfdi_relacionado ";
			$strUnionCfdiRelFactServ .= "AND CFDR.tipo_relacion = 'FACTURA SERVICIO'";


			//Relacionar tablas: notas_credito_servicio y cfdi_relacionados
			$strUnionCfdiRelDevServ .= "INNER JOIN cfdi_relacionados AS CFDR ON 
													Reg.nota_credito_servicio_id = CFDR.cfdi_relacionado ";
			$strUnionCfdiRelDevServ .= "AND CFDR.tipo_relacion = 'DEVOLUCION SERVICIO'";


			//Relacionar tablas: facturas_conceptos y cfdi_relacionados
			$strUnionCfdiRelFactConceptos .= "INNER JOIN cfdi_relacionados AS CFDR ON 
													Reg.factura_concepto_id = CFDR.cfdi_relacionado ";
			$strUnionCfdiRelFactConceptos .= "AND CFDR.tipo_relacion = 'FACTURA CONCEPTOS'";


			//Relacionar tablas: pagos y cfdi_relacionados
			$strUnionCfdiRelPago .= "INNER JOIN cfdi_relacionados AS CFDR ON Reg.pago_id = CFDR.cfdi_relacionado ";
			$strUnionCfdiRelPago .= "AND CFDR.tipo_relacion = 'PAGO'";

			//Relacionar tablas: notas_credito_digitales y cfdi_relacionados
			$strUnionCfdiRelNotaCred .= "INNER JOIN cfdi_relacionados AS CFDR ON 
													Reg.nota_credito_digital_id = CFDR.cfdi_relacionado ";

			$strUnionCfdiRelNotaCred .= "AND CFDR.tipo_relacion = 'NOTA CREDITO'";

			//Relacionar tablas: notas_cargo_digitales y cfdi_relacionados
			$strUnionCfdiRelNotaCargo .= "INNER JOIN cfdi_relacionados AS CFDR ON 
													Reg.nota_cargo_digital_id = CFDR.cfdi_relacionado ";

			$strUnionCfdiRelNotaCargo .= "AND CFDR.tipo_relacion = 'NOTA CARGO'";
			

			//Relacionar tablas: cartera y cfdi_relacionados
			$strUnionCfdiRelCartera .= "INNER JOIN cfdi_relacionados AS CFDR ON Reg.cartera_id = CFDR.cfdi_relacionado ";
			$strUnionCfdiRelCartera .= "AND CFDR.tipo_relacion = 'CARTERA'";

			$strOrdenamiento .= "renglon ASC";

		}
		else
		{

			$strRestriccionesUUID .= "WHERE Reg.uuid IS NOT NULL";

			//Si existe id del prospecto
		    if($intProspectoID != NULL)
		    {
		    	$strRestriccionesProspecto .= "AND C.prospecto_id = $intProspectoID";
		    }

			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$strRestriccionesFecha .= "AND (DATE_FORMAT(Reg.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' 
		   								        AND '$dteFechaFinal')";
		    }

		    $strOrdenamiento .= " tipo_referencia, folio";
		}

	    //Variables para definir que tipos de módulo se incluiran en la búsqueda
	    //Anticipos
		$queryAnticipos = "SELECT Reg.anticipo_id  AS referencia_id, 
								  'ANTICIPO' AS tipo_referencia, 
								  DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha, 
								  Reg.folio, Reg.uuid, Reg.prospecto_id, Reg.razon_social AS cliente, 
								  ((Reg.subtotal + ROUND(Reg.iva,2) + ROUND(Reg.ieps,2)) / Reg.tipo_cambio) AS importe 
								  $strCampoRenglon
						   FROM anticipos AS Reg
						   INNER JOIN clientes AS C ON Reg.prospecto_id = C.prospecto_id
						   $strUnionCfdiRelAnticipo
						   $strRestriccionesReferencia
						   $strRestriccionesUUID
						   $strRestriccionesProspecto
						   $strRestriccionesFecha";

		//Aplicación de anticipos
		$queryAnticiposAplicacion = "SELECT Reg.anticipo_aplicacion_id AS referencia_id, 
										   'APLICACION ANTICIPO' AS tipo_referencia, 
										   DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha,
										   Reg.folio,  Reg.uuid, Reg.prospecto_id, Reg.razon_social AS cliente, 
										   ((Reg.subtotal + ROUND(Reg.iva,2) + ROUND(Reg.ieps,2)) / Reg.tipo_cambio) AS importe
										   $strCampoRenglon
									FROM anticipos_aplicacion AS Reg
									INNER JOIN clientes AS C ON Reg.prospecto_id = C.prospecto_id
									$strUnionCfdiRelApliAnticipo
									$strRestriccionesReferencia
									$strRestriccionesUUID
									$strRestriccionesProspecto
									$strRestriccionesFecha";

		//Facturas de maquinaria
		$queryMaquinaria = "SELECT Reg.factura_maquinaria_id AS referencia_id, 
								   'FACTURA MAQUINARIA' AS tipo_referencia, 
								   DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha,
								   Reg.folio, Reg.uuid, Reg.prospecto_id, Reg.razon_social AS cliente,
								  ((Reg.precio + ROUND(Reg.iva,2) + ROUND(Reg.ieps,2)) / Reg.tipo_cambio) AS importe
								  $strCampoRenglon
							FROM facturas_maquinaria AS Reg
							INNER JOIN clientes AS C ON Reg.prospecto_id = C.prospecto_id
							$strUnionCfdiRelFactMaq
							$strRestriccionesReferencia
							$strRestriccionesUUID 
							$strRestriccionesProspecto
							$strRestriccionesFecha";

	    //Devoluciones de maquinaria
		$queryDevMaquinaria = "SELECT Reg.movimiento_maquinaria_id AS referencia_id, 
									  'DEVOLUCION MAQUINARIA' AS  tipo_referencia, 
									   DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha,
									   Reg.folio, Reg.uuid, Reg.prospecto_id, C.razon_social AS cliente,
									  ((FM.precio + ROUND(FM.iva,2) + ROUND(FM.ieps,2)) / FM.tipo_cambio) AS importe
									  $strCampoRenglon
								FROM movimientos_maquinaria AS Reg
								INNER JOIN clientes AS C ON Reg.prospecto_id = C.prospecto_id
								INNER JOIN facturas_maquinaria AS FM ON Reg.referencia_id = FM.factura_maquinaria_id
								$strUnionCfdiRelDevMaq
								$strRestriccionesReferencia
								$strRestriccionesUUID
								AND Reg.tipo_movimiento = $intMovDevMaq
								$strRestriccionesProspecto
								$strRestriccionesFecha";

		//Facturas de refacciones
		$queryRefacciones = "SELECT Reg.factura_refacciones_id AS referencia_id, 
								  'FACTURA REFACCIONES' AS tipo_referencia, 
								   DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha,
								   Reg.folio, Reg.uuid, Reg.prospecto_id, Reg.razon_social AS cliente, 
								   ((IFNULL((Reg.gastos_paqueteria + Reg.gastos_paqueteria_iva), 0) +  
				   					SUM(ROUND((Det.precio_unitario * Det.cantidad), 2) + 
				   						ROUND((Det.iva_unitario * Det.cantidad), 2) + 
				   						ROUND((Det.ieps_unitario * Det.cantidad), 2))) / Reg.tipo_cambio)  AS importe
								   $strCampoRenglon
							 FROM facturas_refacciones AS Reg
							 INNER JOIN clientes AS C ON Reg.prospecto_id = C.prospecto_id
							 INNER JOIN facturas_refacciones_detalles AS Det ON Reg.factura_refacciones_id = Det.factura_refacciones_id
							 $strUnionCfdiRelFactRef
							 $strRestriccionesReferencia
							 $strRestriccionesUUID
							 $strRestriccionesProspecto
							 $strRestriccionesFecha
							 GROUP BY Reg.factura_refacciones_id $strCampoRenglon";

		//Devoluciones de refacciones
		$queryDevRefacciones = "SELECT Reg.movimiento_refacciones_id AS referencia_id, 
									  'DEVOLUCION REFACCIONES' AS tipo_referencia,  
									   DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha,
									   Reg.folio, Reg.uuid, FR.prospecto_id, FR.razon_social AS cliente, 
									   SUM(((Det.precio_unitario + ROUND(Det.iva_unitario,2) + 
									   		ROUND(Det.ieps_unitario,2)) * Det.cantidad) / Reg.tipo_cambio) AS importe
									   $strCampoRenglon
								FROM movimientos_refacciones AS Reg 
								INNER JOIN movimientos_refacciones_detalles AS Det ON Reg.movimiento_refacciones_id = Det.movimiento_refacciones_id
								INNER JOIN facturas_refacciones AS FR ON Reg.referencia_id = FR.factura_refacciones_id
								INNER JOIN clientes AS C ON FR.prospecto_id = C.prospecto_id
								$strUnionCfdiRelDevRef
								$strRestriccionesReferencia
								$strRestriccionesUUID
								AND Reg.tipo_movimiento = $intMovDevRef
								$strRestriccionesProspecto
								$strRestriccionesFecha
								GROUP BY Reg.movimiento_refacciones_id $strCampoRenglon";

		//Facturas de servicio
		$queryServicio = "SELECT Reg.factura_servicio_id AS referencia_id, 
							     'FACTURA SERVICIO' AS tipo_referencia, 
							     DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha,
							     Reg.folio, Reg.uuid, Reg.prospecto_id, Reg.razon_social AS cliente,
							     ((IFNULL((Reg.gastos_servicio + Reg.gastos_servicio_iva), 0) +  
						  		   IFNULL(ManoObra.Importe, 0) +
   						  		   IFNULL(Otros.Importe, 0) +
   						  		   IFNULL(Refacciones.Importe, 0) +
   						  		   IFNULL(Foraneos.Importe, 0)) / Reg.tipo_cambio) AS importe
							    $strCampoRenglon
						 FROM facturas_servicio AS Reg
						 INNER JOIN clientes AS C ON Reg.prospecto_id = C.prospecto_id
						 $strUnionCfdiRelFactServ
						 LEFT JOIN (SELECT factura_servicio_id, 
										  SUM(ROUND(precio_unitario,2) + 
											  ROUND(iva_unitario,2) + 
											  ROUND(ieps_unitario,2)) AS Importe
						           FROM   facturas_servicio_mano_obra
						           GROUP BY factura_servicio_id) AS ManoObra ON Reg.factura_servicio_id = ManoObra.factura_servicio_id
						 LEFT JOIN (SELECT factura_servicio_id, 
										  SUM(ROUND((precio_unitario * cantidad), 2) + 
								   			  ROUND((iva_unitario * cantidad), 2) + 
								   			  ROUND((ieps_unitario * cantidad), 2)) AS Importe
						           FROM   facturas_servicio_otros
						           GROUP BY factura_servicio_id) AS Otros ON Reg.factura_servicio_id = Otros.factura_servicio_id
						 LEFT JOIN (SELECT factura_servicio_id, 
									      SUM(ROUND((precio_unitario * cantidad), 2) + 
								   			  ROUND((iva_unitario * cantidad), 2) + 
								   			  ROUND((ieps_unitario * cantidad), 2)) AS Importe
						           FROM   facturas_servicio_refacciones
						           GROUP BY factura_servicio_id) AS Refacciones ON Reg.factura_servicio_id = Refacciones.factura_servicio_id
						 LEFT JOIN (SELECT factura_servicio_id, 
										   SUM(ROUND((precio_unitario * cantidad), 2) + 
								   			  ROUND((iva_unitario * cantidad), 2) + 
								   			  ROUND((ieps_unitario * cantidad), 2)) AS Importe
						           FROM   facturas_servicio_trabajos_foraneos
						           GROUP BY factura_servicio_id) AS Foraneos ON Reg.factura_servicio_id = Foraneos.factura_servicio_id
						 $strRestriccionesReferencia   
						 $strRestriccionesUUID
						 $strRestriccionesProspecto
						 $strRestriccionesFecha
						 GROUP BY Reg.factura_servicio_id  $strCampoRenglon";

	    //Devoluciones (notas de crédito) de servicio
		$queryDevServicio = "SELECT Reg.nota_credito_servicio_id AS referencia_id, 
							       'DEVOLUCION SERVICIO' AS tipo_referencia, 
							    	DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha,
							        Reg.folio, Reg.uuid, Reg.prospecto_id, 
							        Reg.razon_social AS cliente, 
							        (SUM(ROUND(Det.precio, 2) + 
				   						 ROUND(Det.iva, 2) + 
				   						 ROUND(Det.ieps, 2)) / Reg.tipo_cambio)  AS importe
				   				    $strCampoRenglon
							FROM notas_credito_servicio AS Reg
						 	INNER JOIN clientes AS C ON Reg.prospecto_id = C.prospecto_id
						 	INNER JOIN notas_credito_servicio_detalles AS Det ON Reg.nota_credito_servicio_id = Det.nota_credito_servicio_id
						 	$strUnionCfdiRelDevServ
						 	$strRestriccionesReferencia
							$strRestriccionesUUID
							$strRestriccionesProspecto
							$strRestriccionesFecha
							GROUP BY Reg.nota_credito_servicio_id $strCampoRenglon";


		//Facturas de conceptos
		$queryConceptos = "SELECT Reg.factura_concepto_id AS referencia_id, 
								  'FACTURA CONCEPTOS' AS tipo_referencia, 
								   DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha,
								   Reg.folio, Reg.uuid, Reg.prospecto_id, Reg.razon_social AS cliente, 
								   (SUM(ROUND((Det.precio_unitario * Det.cantidad), 2) + 
				   						ROUND((Det.iva_unitario * Det.cantidad), 2) + 
				   						ROUND((Det.ieps_unitario * Det.cantidad), 2)) / Reg.tipo_cambio)  AS importe
								   $strCampoRenglon
							 FROM facturas_conceptos AS Reg
							 INNER JOIN clientes AS C ON Reg.prospecto_id = C.prospecto_id
							 INNER JOIN facturas_conceptos_detalles AS Det ON Reg.factura_concepto_id = Det.factura_concepto_id
							 $strUnionCfdiRelFactConceptos
							 $strRestriccionesReferencia
							 $strRestriccionesUUID
							 $strRestriccionesProspecto
							 $strRestriccionesFecha
							 GROUP BY Reg.factura_concepto_id $strCampoRenglon";

		//Pagos
		$queryPagos = "SELECT Reg.pago_id AS referencia_id, 
							  'PAGO' AS tipo_referencia, 
							   DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha,
							   Reg.folio, Reg.uuid, Reg.prospecto_id, Reg.razon_social AS cliente, 
							   SUM(Det.monto) AS importe
							   $strCampoRenglon
					   FROM pagos AS Reg
					   INNER JOIN clientes AS C ON Reg.prospecto_id = C.prospecto_id
					   INNER JOIN pagos_detalles_02 AS Det ON Reg.pago_id = Det.pago_id
					   $strUnionCfdiRelPago
					   $strRestriccionesReferencia
					   $strRestriccionesUUID
					   $strRestriccionesProspecto
					   $strRestriccionesFecha
					   GROUP BY Reg.pago_id $strCampoRenglon";


		//Notas de crédito digital
		$queryNotasCreditoDigital = "SELECT Reg.nota_credito_digital_id AS referencia_id, 
										   'NOTA CREDITO' AS tipo_referencia, 
										   DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha,
										   Reg.folio, Reg.uuid, Reg.prospecto_id, Reg.razon_social AS cliente, 
										   SUM((Det.precio + ROUND(Det.iva,2) + ROUND(Det.ieps,2)) / Reg.tipo_cambio) AS importe
										   $strCampoRenglon
									FROM notas_credito_digitales AS Reg
									INNER JOIN clientes AS C ON Reg.prospecto_id = C.prospecto_id
									INNER JOIN notas_credito_digitales_detalles AS Det ON Reg.nota_credito_digital_id = Det.nota_credito_digital_id
									$strUnionCfdiRelNotaCred
									$strRestriccionesReferencia
									$strRestriccionesUUID
									$strRestriccionesProspecto
									$strRestriccionesFecha
									GROUP BY Reg.nota_credito_digital_id $strCampoRenglon";

		//Notas de cargo digital
		$queryNotasCargoDigital = "SELECT Reg.nota_cargo_digital_id AS referencia_id, 
										   'NOTA CARGO' AS tipo_referencia, 
										   DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha,
										   Reg.folio, Reg.uuid, Reg.prospecto_id, Reg.razon_social AS cliente, 
										   SUM((Det.precio + ROUND(Det.iva,2) + ROUND(Det.ieps,2)) / Reg.tipo_cambio) AS importe
										   $strCampoRenglon
									FROM notas_cargo_digitales AS Reg
									INNER JOIN clientes AS C ON Reg.prospecto_id = C.prospecto_id
									INNER JOIN notas_cargo_digitales_detalles AS Det ON Reg.nota_cargo_digital_id = Det.nota_cargo_digital_id
									$strUnionCfdiRelNotaCargo
									$strRestriccionesReferencia
									$strRestriccionesUUID
									$strRestriccionesProspecto
									$strRestriccionesFecha
									GROUP BY Reg.nota_cargo_digital_id $strCampoRenglon";

		
		//Cartera
		$queryCartera = "SELECT Reg.cartera_id AS referencia_id, 
							    'CARTERA' AS tipo_referencia, 
							    DATE_FORMAT(Reg.fecha,'%d/%m/%Y') AS fecha,
							    Reg.folio, Reg.uuid, Reg.prospecto_id, Reg.razon_social AS cliente, 
							    Reg.importe 
							   $strCampoRenglon
						 FROM cartera AS Reg
						 INNER JOIN clientes AS C ON Reg.prospecto_id = C.prospecto_id
						 $strUnionCfdiRelCartera
						 $strRestriccionesReferencia
						 $strRestriccionesUUID
						 $strRestriccionesProspecto
						 $strRestriccionesFecha";


     	//Formar consulta
		$queryCfdi .= $queryAnticipos;
		$queryCfdi .= " UNION ";
		$queryCfdi .= $queryAnticiposAplicacion;
		$queryCfdi .= " UNION ";
		$queryCfdi .= $queryMaquinaria;
		$queryCfdi .= " UNION ";
		$queryCfdi .= $queryDevMaquinaria;
		$queryCfdi .= " UNION ";
		$queryCfdi .= $queryRefacciones;
		$queryCfdi .= " UNION ";
		$queryCfdi .= $queryDevRefacciones;
		$queryCfdi .= " UNION ";
		$queryCfdi .= $queryServicio;
		$queryCfdi .= " UNION ";
		$queryCfdi .= $queryDevServicio;
		$queryCfdi .= " UNION ";
		$queryCfdi .= $queryConceptos;
		$queryCfdi .= " UNION ";
		$queryCfdi .= $queryPagos;
		$queryCfdi .= " UNION ";
		$queryCfdi .= $queryNotasCreditoDigital;
		$queryCfdi .= " UNION ";
		$queryCfdi .= $queryNotasCargoDigital;
		$queryCfdi .= " UNION ";
		$queryCfdi .= $queryCartera;
		$queryCfdi .= $strOrdenamiento;

		$strSQL = $this->db->query($queryCfdi);
		return $strSQL->result();

	}
}
?>