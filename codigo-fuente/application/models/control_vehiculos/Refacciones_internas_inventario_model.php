<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones_internas_inventario_model extends CI_model {


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
					* de la tabla refacciones_internas_inventario		
					**************************************************************************************/
					//Asignar datos al array
					$arrDatos = array('inicial_existencia' => $arrInv->actual_existencia,
									  'inicial_costo' => $arrInv->actual_costo,
									  'actual_existencia' => $arrInv->actual_existencia,
									  'actual_costo' => $arrInv->actual_costo);

					$this->db->where('sucursal_id', $objInventario->intSucursalID);
					$this->db->where('anio', $objInventario->strAnioTraspaso);
					$this->db->where('refaccion_id', $arrInv->refaccion_id);
					$this->db->limit(1);
					//Actualizar los datos del registro
					$this->db->update('refacciones_internas_inventario', $arrDatos);

				}
				else
				{

					/*************************************************************************************
					* Guardar datos del inventario por cada registro 
					* de la tabla refacciones_internas_inventario		
					**************************************************************************************/
					//Asignar datos al array
					$arrDatos = array('sucursal_id' => $objInventario->intSucursalID,
									  'refaccion_id' => $arrInv->refaccion_id,
									  'anio' => $objInventario->strAnioTraspaso,
									  'localizacion' => $arrInv->localizacion,
									  'inicial_existencia' => $arrInv->actual_existencia,
									  'inicial_costo' => $arrInv->actual_costo,
									  'actual_existencia' => $arrInv->actual_existencia,
									  'actual_costo' => $arrInv->actual_costo);

					//Guardar los datos del registro
					$this->db->insert('refacciones_internas_inventario', $arrDatos);
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
	public function buscar_existencia_inicial($dteFechaCorte, $intRefaccionesLineaID, 
											  $intRefaccionesMarcaID, $strTipoOrdenamiento, 
											  $strLocalizacionInicial = NULL, 
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
			$strRestricciones.="AND  RII.localizacion >= '".$strLocalizacionInicial."'";
			$strRestricciones.="AND  RII.localizacion <= '".$strLocalizacionFinal."'";
		}

		//Dependiendo del tipo ordenar los datos
		switch ($strTipoOrdenamiento)
		{
			case "LOCALIZACION":
				$strRestricciones.=" ORDER BY RII.localizacion, RL.descripcion, R.descripcion, R.codigo_01";
				break;
			case "DESCRIIPCION":
				$strRestricciones.=" ORDER BY R.descripcion, R.codigo_01, RL.descripcion, RII.localizacion";
				break;
			case "CODIGO":
				$strRestricciones.=" ORDER BY R.codigo_01, R.descripcion, RL.descripcion, RII.localizacion";
				break;
			case "LINEA":
				$strRestricciones.=" ORDER BY RL.descripcion, R.descripcion, R.codigo_01, RII.localizacion";
				break;
		}

		$strSQL = $this->db->query("SELECT R.refaccion_id, R.codigo_01, R.descripcion, 
										   RL.codigo AS CodigoLinea, U.codigo AS CodigoUnidad, 
										   RII.localizacion, RII.inicial_existencia, RII.inicial_costo,
										   IFNULL(Temp.Fecha, _latin1'') AS Fecha
									FROM refacciones AS R 
									INNER JOIN refacciones_lineas AS RL ON R.refacciones_linea_id = RL.refacciones_linea_id
									INNER JOIN sat_unidades AS U ON R.unidad_id = U.unidad_id
									INNER JOIN refacciones_internas_inventario AS RII ON R.refaccion_id = RII.refaccion_id
									LEFT JOIN (SELECT MRID.refaccion_id, DATE_FORMAT(MAX(MRII.fecha), '%d/%m/%Y')  AS Fecha
											   FROM movimientos_refacciones_internas AS MRII 
											   INNER JOIN movimientos_refacciones_internas_detalles AS MRID ON MRII.movimiento_refacciones_internas_id = MRID.movimiento_refacciones_internas_id
											   WHERE  MRII.sucursal_id = $intSucursalID
											   AND MRII.fecha <= '$dteFechaCorte'
											   GROUP BY MRID.refaccion_id) AS Temp ON  RII.refaccion_id = Temp.refaccion_id
									WHERE  RII.sucursal_id = $intSucursalID
									AND    RII.anio = '$strAnio'
									$strRestricciones");
		return $strSQL->result();
	}

	/*Método para regresar los movimientos que coincidan con los criterios de búsqueda proporcionados*/
	public function buscar_movimientos($dteFechaCorte, $intRefaccionID)
	{

		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID = $this->session->userdata('sucursal_id');

		//Separar fecha para obtener el año
		$strFecha = explode("-", $dteFechaCorte);
		$strAnio = $strFecha[0];
		//Asignar fecha inicial del inventario
		$dteFechaInicialInv = $strAnio.'-01-01';

		$strSQL = $this->db->query("SELECT MRI.tipo_movimiento, MRI.fecha,  MRI.fecha_creacion,  
										   MRI.fecha_actualizacion,
										   MRID.renglon, MRID.cantidad, MRID.costo_unitario
									FROM movimientos_refacciones_internas AS MRI 
									INNER JOIN movimientos_refacciones_internas_detalles AS MRID ON MRI.movimiento_refacciones_internas_id = MRID.movimiento_refacciones_internas_id
									WHERE MRID.refaccion_id = $intRefaccionID
									AND  MRI.sucursal_id = $intSucursalID
									AND  MRI.fecha >= '$dteFechaInicialInv'
									AND  MRI.fecha <= '$dteFechaCorte'
									AND MRI.estatus <> 'INACTIVO'
									ORDER BY fecha, fecha_creacion, fecha_actualizacion");
		return $strSQL->result();

	}

	/*Método para regresar el último año del inventario de la sucursal logeada*/
	public function buscar_ultimo_anio()
	{

		$this->db->select("MAX(anio) AS anio", FALSE);
		$this->db->from('refacciones_internas_inventario');
		$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	//Método para regresar las refacciones del inventario con existencia
	public function buscar_diferencia_refacciones($strAnio)
	{

		$this->db->select("CONCAT_WS(' - ', R.codigo_01, R.descripcion) AS refaccion, RI.localizacion, 
							RI.actual_existencia, RI.actual_costo", FALSE);
		$this->db->from('refacciones_internas_inventario AS RI');
		$this->db->join('refacciones AS R', 'RI.refaccion_id = R.refaccion_id', 'inner');
		$this->db->where('RI.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('RI.anio', $strAnio);
		$this->db->where('RI.actual_existencia > 0');
		return $this->db->get()->result();
	}


	//Método para regresar las refacciones del inventario (para su traspaso)
	public function buscar_refacciones_traspaso($strAnioInventario, $strAnioTraspaso)
	{

		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID = $this->session->userdata('sucursal_id');

		$strSQL = $this->db->query("SELECT RI.refaccion_id, RI.localizacion, RI.actual_existencia, RI.actual_costo, 
										   IFNULL(RT.anio, 0) AS AnioTraspaso
									FROM   refacciones_internas_inventario AS RI LEFT JOIN refacciones_internas_inventario AS RT 
									       ON RI.refaccion_id = RT.refaccion_id AND RI.sucursal_id = RT.sucursal_id	AND RT.anio = '$strAnioTraspaso'
									WHERE  RI.sucursal_id = $intSucursalID
									AND    RI.anio = '$strAnioInventario'");

		return $strSQL->result();
	}

}
?>