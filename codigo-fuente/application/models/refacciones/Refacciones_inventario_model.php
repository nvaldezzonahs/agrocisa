<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones_inventario_model extends CI_model {


    //Método para guardar un traspaso de inventario
	public function guardar_traspaso(stdClass $objInventario)
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Seleccionar la información del último inventario de la sucursal (logeada)
		$otdInventario = $this->buscar_refacciones_traspaso($objInventario->strAnioInventario, $objInventario->strAnioTraspaso);

		if($otdInventario)
		{
			//Hacer recorrido para obtener datos del inventario
			foreach ($otdInventario as $arrInv)
			{
				

				//Si existe la refacción en el año del traspaso
				if($arrInv->AnioTraspaso > 0)
				{
					/*************************************************************************************
					* Actualizar datos del inventario por cada registro 
					* de la tabla refacciones_inventario		
					**************************************************************************************/
					//Asignar datos al array
					$arrDatos = array('inicial_existencia' => $arrInv->actual_existencia,
									  'inicial_costo' => $arrInv->actual_costo,
									  'actual_existencia' => $arrInv->actual_existencia,
									  'disponible_existencia' => $arrInv->disponible_existencia,
									  'actual_costo' => $arrInv->actual_costo);

					$this->db->where('sucursal_id', $objInventario->intSucursalID);
					$this->db->where('anio', $objInventario->strAnioTraspaso);
					$this->db->where('refaccion_id', $arrInv->refaccion_id);
					$this->db->limit(1);
					//Actualizar los datos del registro
					$this->db->update('refacciones_inventario', $arrDatos);

				}
				else
				{

					/*************************************************************************************
					* Guardar datos del inventario por cada registro 
					* de la tabla refacciones_inventario		
					**************************************************************************************/
					//Asignar datos al array
					$arrDatos = array('sucursal_id' => $objInventario->intSucursalID,
									  'refaccion_id' => $arrInv->refaccion_id,
									  'anio' => $objInventario->strAnioTraspaso,
									  'localizacion' => $arrInv->localizacion,
									  'clasificacion' => $arrInv->clasificacion,
									  'clasificacion_planta' => $arrInv->clasificacion_planta,
									  'minimo' => $arrInv->minimo,
									  'maximo' => $arrInv->maximo,
									  'reorden' => $arrInv->reorden,
									  'inicial_existencia' => $arrInv->actual_existencia,
									  'inicial_costo' => $arrInv->actual_costo,
									  'actual_existencia' => $arrInv->actual_existencia,
									  'disponible_existencia' => $arrInv->disponible_existencia,
									  'actual_costo' => $arrInv->actual_costo);

					//Guardar los datos del registro
					$this->db->insert('refacciones_inventario', $arrDatos);
				}
				

			}//Cierre de foreach

		}//Cierre de verificación de inventario
		
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}



	/*Método para regresar la existencia inicial que coincida con los criterios de búsqueda proporcionados*/
	public function buscar_existencia_inicial($dteFechaCorte, $intRefaccionesLineaID, $intRefaccionesMarcaID, 
											  $strTipoOrdenamiento, $strLocalizacionInicial = NULL, 
											  $strLocalizacionFinal = NULL)
	{
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';
		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID = $this->session->userdata('sucursal_id');
		//Separar fecha para obtener el año
		$strFecha = explode("-", $dteFechaCorte);
		$strAnio = $strFecha[0];

		//Si existe id de la línea de refacciones
		if($intRefaccionesLineaID > 0)
		{
			$strRestricciones .= " AND R.refacciones_linea_id = $intRefaccionesLineaID";
		}


		//Si existe id de la marca de refacciones
		if($intRefaccionesMarcaID > 0)
		{
			$strRestricciones .= " AND R.refacciones_marca_id = $intRefaccionesMarcaID";
		}

		//Si existe rango de localización
		if($strLocalizacionInicial !== NULL && $strLocalizacionFinal !== NULL)
		{
			$strRestricciones.="AND  RI.localizacion >= '".$strLocalizacionInicial."'";
			$strRestricciones.="AND  RI.localizacion <= '".$strLocalizacionFinal."'";
		}

		//Dependiendo del tipo ordenar los datos
		switch ($strTipoOrdenamiento)
		{
			case "LOCALIZACION":
				$strRestricciones.=" ORDER BY RI.localizacion, RL.descripcion, R.descripcion, R.codigo_01";
				break;
			case "DESCRIPCION":
				$strRestricciones.=" ORDER BY R.descripcion, R.codigo_01, RL.descripcion, RI.localizacion";
				break;
			case "CODIGO":
				$strRestricciones.=" ORDER BY R.codigo_01, R.descripcion, RL.descripcion, RI.localizacion";
				break;
			case "LINEA":
				$strRestricciones.=" ORDER BY RL.descripcion, R.descripcion, R.codigo_01, RI.localizacion";
				break;
		}

		$strSQL = $this->db->query("SELECT R.refaccion_id, R.codigo_01, R.descripcion, 
										   RL.codigo AS CodigoLinea, U.codigo AS CodigoUnidad, 
										   RI.localizacion, RI.inicial_existencia, RI.inicial_costo,
										   IFNULL(Temp.Fecha, _latin1'') AS Fecha
									FROM refacciones AS R 
									INNER JOIN refacciones_lineas AS RL ON R.refacciones_linea_id = RL.refacciones_linea_id
									INNER JOIN sat_unidades AS U ON R.unidad_id = U.unidad_id
									INNER JOIN refacciones_inventario AS RI ON R.refaccion_id = RI.refaccion_id
									LEFT JOIN (SELECT MRD.refaccion_id, DATE_FORMAT(MAX(MR.fecha), '%d/%m/%Y')  AS Fecha
											   FROM movimientos_refacciones AS MR 
											   INNER JOIN movimientos_refacciones_detalles AS MRD ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
											   WHERE  MR.sucursal_id = $intSucursalID
											   AND DATE_FORMAT(MR.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
											   GROUP BY MRD.refaccion_id) AS Temp ON  RI.refaccion_id = Temp.refaccion_id
									WHERE  RI.sucursal_id = $intSucursalID
									AND    RI.anio = '$strAnio'
									$strRestricciones");
		return $strSQL->result();
	}

	/*Método para regresar los movimientos que coincidan con los criterios de búsqueda proporcionados*/
	public function buscar_movimientos($dteFechaCorte, $intRefaccionID)
	{

		//Constante para identificar al tipo de movimiento salida de refacciones por venta (factura)
		$intMovSalidaVenta = SALIDA_REFACCIONES_VENTA;

		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID = $this->session->userdata('sucursal_id');

		//Separar fecha para obtener el año
		$strFecha = explode("-", $dteFechaCorte);
		$strAnio = $strFecha[0];
		//Asignar fecha inicial del inventario
		$dteFechaInicialInv = $strAnio.'-01-01';

		$strSQL = $this->db->query("SELECT MR.tipo_movimiento, MR.fecha,  MR.fecha_creacion,  MR.fecha_actualizacion,
										   MRD.renglon, MRD.cantidad, MRD.costo_unitario
									FROM movimientos_refacciones AS MR 
									INNER JOIN movimientos_refacciones_detalles AS MRD ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id
									WHERE MRD.refaccion_id = $intRefaccionID
									AND  MR.sucursal_id = $intSucursalID
									AND  DATE_FORMAT(MR.fecha, '%Y-%m-%d') >= '$dteFechaInicialInv'
									AND  DATE_FORMAT(MR.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
									AND MR.estatus <> 'INACTIVO'
									UNION 
									SELECT $intMovSalidaVenta AS tipo_movimiento,
										   FR.fecha,  FR.fecha_creacion,  FR.fecha_actualizacion,
										   FRD.renglon, FRD.cantidad, FRD.costo_unitario
									FROM facturas_refacciones AS FR 
									INNER JOIN facturas_refacciones_detalles AS FRD ON FR.factura_refacciones_id = FRD.factura_refacciones_id
									WHERE FRD.refaccion_id = $intRefaccionID
									AND  FR.sucursal_id = $intSucursalID
									AND  DATE_FORMAT(FR.fecha, '%Y-%m-%d') >= '$dteFechaInicialInv'
									AND  DATE_FORMAT(FR.fecha, '%Y-%m-%d') <= '$dteFechaCorte'
									AND FR.estatus <> 'INACTIVO'
									ORDER BY fecha, fecha_creacion, fecha_actualizacion");
		return $strSQL->result();

	}

	/*Método para regresar el último año del inventario de la sucursal logeada*/
	public function buscar_ultimo_anio()
	{

		$this->db->select("MAX(anio) AS anio", FALSE);
		$this->db->from('refacciones_inventario');
		$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	//Método para regresar las refacciones del inventario con existencia y disponibilidad distintas
	public function buscar_diferencia_refacciones($strAnio, $strTipo = NULL)
	{

		$this->db->select("CONCAT_WS(' - ', R.codigo_01, R.descripcion) AS refaccion, RI.localizacion, 
							RI.actual_existencia, RI.disponible_existencia, RI.actual_costo", FALSE);
		$this->db->from('refacciones_inventario AS RI');
		$this->db->join('refacciones AS R', 'RI.refaccion_id = R.refaccion_id', 'inner');
		$this->db->where('RI.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('RI.anio', $strAnio);

		//Dependiendo del tipo, agregar condición
		if($strTipo == 'existencia')
		{
			$this->db->where("(RI.actual_existencia > 0 OR RI.disponible_existencia > 0)");
		}
		else
		{
			$this->db->where('RI.actual_existencia <> RI.disponible_existencia');
		}
		
		return $this->db->get()->result();
	}


	//Método para regresar las refacciones del inventario (para su traspaso)
	public function buscar_refacciones_traspaso($strAnioInventario, $strAnioTraspaso)
	{

		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID = $this->session->userdata('sucursal_id');

		$strSQL = $this->db->query("SELECT RI.refaccion_id, RI.localizacion, RI.clasificacion, RI.clasificacion_planta, RI.minimo, 
										   RI.maximo, RI.reorden, RI.actual_existencia, RI.disponible_existencia, RI.actual_costo, 
										   IFNULL(RT.anio, 0) AS AnioTraspaso
									FROM   refacciones_inventario AS RI LEFT JOIN refacciones_inventario AS RT 
									       ON RI.refaccion_id = RT.refaccion_id AND RI.sucursal_id = RT.sucursal_id	AND RT.anio = '$strAnioTraspaso'
									WHERE  RI.sucursal_id = $intSucursalID
									AND    RI.anio = '$strAnioInventario'");

		return $strSQL->result();
	}


}
?>