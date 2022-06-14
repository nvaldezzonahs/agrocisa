<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancelaciones_model extends CI_model {

	/*******************************************************************************************************************
	Funciones de la tabla cancelaciones
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objCancelacion)
	{

		//Asignar datos al array
		$arrDatos = array('tipo_referencia' => $objCancelacion->strTipoReferenciaCfdi,
						  'referencia_id' => $objCancelacion->intReferenciaCfdiID,
						  'cancelacion_motivo_id' => $objCancelacion->intCancelacionMotivoID,
						  'sustitucion_id' => $objCancelacion->intSustitucionID,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
				  		  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('cancelaciones', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intCancelacionID, $strTipoReferencia)
	{
		//Constante para identificar al tipo de movimiento entrada de maquinaria por devolución de la factura
		$intMovEntradaDevMaq = ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA;
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución de la factura
		$intMovEntradaDevRef = ENTRADA_REFACCIONES_DEVOLUCION_FACTURA;

		$queryReferencia = "SELECT C.cancelacion_motivo_id, UC.usuario AS usuario_creacion, 
							 DATE_FORMAT(C.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion,
							 RT.folio AS folio_referencia, S.folio AS folio_sustitucion ";
		$strUnionCfdi =  "FROM cancelaciones AS C INNER JOIN 
						  usuarios AS UC ON C.usuario_creacion = UC.usuario_id";

		//Dependiendo del tipo de referencia CFDI relacionar tablas
		if($strTipoReferencia == 'FACTURA REFACCIONES')
		{
			$strUnionCfdi .= " INNER JOIN facturas_refacciones AS RT ON C.referencia_id = RT.factura_refacciones_id 
								  AND C.tipo_referencia = '$strTipoReferencia'";
			$strUnionCfdi .= " LEFT JOIN facturas_refacciones AS S ON C.sustitucion_id = S.factura_refacciones_id";

		}
		else if($strTipoReferencia == 'FACTURA MAQUINARIA')
		{
			$strUnionCfdi .= " INNER JOIN facturas_maquinaria AS RT ON C.referencia_id = RT.factura_maquinaria_id 
								  AND C.tipo_referencia = '$strTipoReferencia'";
			$strUnionCfdi .= " LEFT JOIN facturas_maquinaria AS S ON C.sustitucion_id = S.factura_maquinaria_id";
		}
		else if($strTipoReferencia == 'FACTURA SERVICIO')
		{
			$strUnionCfdi .= " INNER JOIN facturas_servicio AS RT ON C.referencia_id = RT.factura_servicio_id 
								  AND C.tipo_referencia = '$strTipoReferencia'";
			$strUnionCfdi .= " LEFT JOIN facturas_servicio AS S ON C.sustitucion_id = S.factura_servicio_id";
		}
		else if($strTipoReferencia == 'FACTURA CONCEPTOS')
		{
			$strUnionCfdi .= " INNER JOIN facturas_conceptos AS RT ON C.referencia_id = RT.factura_concepto_id 
								  AND C.tipo_referencia = '$strTipoReferencia'";
			$strUnionCfdi .= " LEFT JOIN facturas_conceptos AS S ON C.sustitucion_id = S.factura_concepto_id";
		}

		else if($strTipoReferencia == 'ANTICIPO')
		{
			$strUnionCfdi .= " INNER JOIN anticipos AS RT ON C.referencia_id = RT.anticipo_id 
								  AND C.tipo_referencia = '$strTipoReferencia'";
			$strUnionCfdi .= " LEFT JOIN anticipos AS S ON C.sustitucion_id = S.anticipo_id";


		}
		else if($strTipoReferencia == 'APLICACION ANTICIPO')
		{
			$strUnionCfdi .= " INNER JOIN anticipos_aplicacion AS RT ON C.referencia_id = RT.anticipo_aplicacion_id 
								  AND C.tipo_referencia = '$strTipoReferencia'";
			$strUnionCfdi .= " LEFT JOIN anticipos_aplicacion AS S ON C.sustitucion_id = S.anticipo_aplicacion_id";

		}
		else if($strTipoReferencia == 'PAGO')
		{
			$strUnionCfdi .= " INNER JOIN pagos AS RT ON C.referencia_id = RT.pago_id 
								  AND C.tipo_referencia = '$strTipoReferencia'";
			$strUnionCfdi .= " LEFT JOIN pagos AS S ON C.sustitucion_id = S.pago_id";
		}
		else if($strTipoReferencia == 'NOTA CARGO')
		{
			$strUnionCfdi .= " INNER JOIN notas_cargo_digitales AS RT ON C.referencia_id = RT.nota_cargo_digital_id 
								  AND C.tipo_referencia = '$strTipoReferencia'";
			$strUnionCfdi .= " LEFT JOIN notas_cargo_digitales AS S ON C.sustitucion_id = S.nota_cargo_digital_id";
		}
		else if($strTipoReferencia == 'NOTA CREDITO')
		{
			$strUnionCfdi .= " INNER JOIN notas_credito_digitales AS RT ON C.referencia_id = RT.nota_credito_digital_id 
								  AND C.tipo_referencia = '$strTipoReferencia'";
			$strUnionCfdi .= " LEFT JOIN notas_credito_digitales AS S ON C.sustitucion_id = S.nota_credito_digital_id";
		}
		else if($strTipoReferencia == 'DEVOLUCION SERVICIO')
		{
			$strUnionCfdi .= " INNER JOIN notas_credito_servicio AS RT ON C.referencia_id = RT.nota_credito_servicio_id 
								  AND C.tipo_referencia = '$strTipoReferencia'";
			$strUnionCfdi .= " LEFT JOIN notas_credito_servicio AS S ON C.sustitucion_id = S.nota_credito_servicio_id";
		}
		else if($strTipoReferencia == 'DEVOLUCION MAQUINARIA')
		{
			$strUnionCfdi .= " INNER JOIN movimientos_maquinaria AS RT ON C.referencia_id = RT.movimiento_maquinaria_id 
								  AND C.tipo_referencia = '$strTipoReferencia' 
								  AND RT.tipo_movimiento = $intMovEntradaDevMaq";
			$strUnionCfdi .= " LEFT JOIN movimientos_maquinaria AS S ON C.sustitucion_id = S.movimiento_maquinaria_id
										AND S.tipo_movimiento = $intMovEntradaDevMaq";
		}
		else if($strTipoReferencia == 'DEVOLUCION REFACCIONES')
		{
			$strUnionCfdi .= " INNER JOIN movimientos_refacciones AS RT ON C.referencia_id = RT.movimiento_refacciones_id 
								  AND C.tipo_referencia = '$strTipoReferencia' 
								  AND RT.tipo_movimiento = $intMovEntradaDevRef";
			$strUnionCfdi .= " LEFT JOIN movimientos_refacciones AS S ON C.sustitucion_id = S.movimiento_refacciones_id
										AND S.tipo_movimiento = $intMovEntradaDevRef";
		}


		$queryReferencia .= $strUnionCfdi;
		$queryReferencia .= " WHERE C.cancelacion_id = $intCancelacionID";


		//Ejecutar consulta
		$strSQL = $this->db->query($queryReferencia);
		return $strSQL->row();
		
	}


}
?>