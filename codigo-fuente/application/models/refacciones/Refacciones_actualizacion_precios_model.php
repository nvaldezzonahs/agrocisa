<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones_actualizacion_precios_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla refacciones_actualizacion_precios
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar($intRefaccionesListaPrecioID, $strBase, $intReferenciaID, $intPorcentaje, 
						    $intTipoCambio, $strRefaccionesLineaID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Constante para identificar el ID de la moneda base
        $intMonedaBase = MONEDA_BASE;
		//Variable que se utiliza para asignar el número de refacciones que se actualizaron
		$intImpacto = 0;
		//Variable que se utiliza el precio actualizado
		$intPrecio =  0;

		//Seleccionar los datos de las refacciones que se actualizarán
	    $otdRefacciones = $this->buscar_refacciones_actualizar($strBase, $intReferenciaID, $strRefaccionesLineaID);
	    //Verificar si existe información de refacciones 
		if($otdRefacciones)
		{
			//Recorremos el arreglo
			foreach ($otdRefacciones as $arrRef)
			{
				//Si existe id de la referencia (lista de precios)
				if($intReferenciaID > 0)
				{
					//Verificar si la moneda de la refacción es diferente al peso mexicano
					if($arrRef->moneda_id != $intMonedaBase)
					{
						//Calcular precio
						$intPrecio = ($arrRef->actualizar / $intPorcentaje) / $intTipoCambio;
					}
					else
					{
						//Calcular precio
						$intPrecio = $arrRef->actualizar / $intPorcentaje;
					}
				}
				else
				{
					//Calcular precio
					$intPrecio = $arrRef->actualizar / $intPorcentaje;
				}

				//Redondear a dos decimales
				$intPrecio = round($intPrecio, 2);

				//Seleccionar los datos del precio de la refacción
				$otdPrecioRefaccion = $this->buscar_precio_refaccion($arrRef->refaccion_id, 
																	 $intRefaccionesListaPrecioID);

				//Verificar si existe información del precio 
				if($otdPrecioRefaccion)
				{
					//Actualizar el precio de la refacción
					//Asignar datos al array
					$arrDatos = array('precio' => $intPrecio);
					$this->db->where('refaccion_id', $arrRef->refaccion_id);
					$this->db->where('refacciones_lista_precio_id', $intRefaccionesListaPrecioID);
					$this->db->limit(1);
					$this->db->update('refacciones_precios', $arrDatos);
			    }
				else
				{

					//Guardar el precio de la refacción
					//Asignar datos al array
					$arrDatos = array('refaccion_id' => $arrRef->refaccion_id, 
									  'refacciones_lista_precio_id' => $intRefaccionesListaPrecioID,
									  'precio' => $intPrecio);
				    $this->db->insert('refacciones_precios', $arrDatos);

				}

				//Incrementar contador por cada refacción
				$intImpacto++;
			}

			//Tabla refacciones_actualizacion_precios
			//Asignar datos al array
			$arrDatos = array('refacciones_lista_precio_id' => $intRefaccionesListaPrecioID, 
							  'base' => $strBase, 
							  'referencia_id' => $intReferenciaID, 
							  'porcentaje' => $intPorcentaje, 
							  'tipo_cambio' => $intTipoCambio, 
							  'impacto' => $intImpacto, 
							  'fecha_creacion' => date("Y-m-d H:i:s"),
							  'usuario_creacion' => $this->session->userdata('usuario_id'));
			//Guardar los datos del registro
			$this->db->insert('refacciones_actualizacion_precios', $arrDatos);
			//Hacer un llamado al método para guardar los detalles de la actualización de precios
			$this->guardar_detalles($this->db->insert_id(), $strRefaccionesLineaID);

		}//Cierre de verificación de refacciones

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intImpacto;
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intRefaccionActualizacionPrecioID = NULL, $dteFechaInicial = NULL, 
						  $dteFechaFinal = NULL, $intRefaccionesListaPrecioID = NULL)
	{

		$this->db->select("RAP.refaccion_actualizacion_precio_id, RAP.refacciones_lista_precio_id,
						   RAP.base, RAP.referencia_id, RAP.porcentaje, RAP.tipo_cambio,
						   DATE_FORMAT(RAP.fecha_creacion,'%d/%m/%Y') AS fecha, 
						   RLP.descripcion AS refacciones_lista_precio, 
						   R.descripcion AS referencia", FALSE);
	    $this->db->from('refacciones_actualizacion_precios AS RAP');
	    $this->db->join('refacciones_listas_precios AS RLP', 
						'RAP.refacciones_lista_precio_id = RLP.refacciones_lista_precio_id', 'inner');
	     $this->db->join('refacciones_listas_precios AS R', 'RAP.referencia_id = R.refacciones_lista_precio_id', 'left');
		//Si existe id de la actualización
		if ($intRefaccionActualizacionPrecioID !== NULL)
		{   
			$this->db->where('RAP.refaccion_actualizacion_precio_id', $intRefaccionActualizacionPrecioID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			//Si existe id de la lista de precios
		    if($intRefaccionesListaPrecioID > 0)
		    {
		   		$this->db->where('RAP.refacciones_lista_precio_id', $intRefaccionesListaPrecioID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("(RAP.fecha_creacion BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }

		    $this->db->order_by('RAP.fecha_creacion', 'DESC');
		    return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intRefaccionesListaPrecioID = NULL,$strBusqueda = NULL,
						   $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe id de la lista de precios
		if($intRefaccionesListaPrecioID > 0)
	    {
	   		$this->db->where('RAP.refacciones_lista_precio_id', $intRefaccionesListaPrecioID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {	   		
	   	    $this->db->where("(DATE_FORMAT(RAP.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

		$this->db->where("((RLP.descripcion LIKE '%$strBusqueda%') OR
					(RAP.base LIKE '%$strBusqueda%') )"); 
		$this->db->from('refacciones_actualizacion_precios AS RAP');
		$this->db->join('refacciones_listas_precios AS RLP', 
						'RAP.refacciones_lista_precio_id = RLP.refacciones_lista_precio_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("RAP.refaccion_actualizacion_precio_id, RAP.base, CONCAT(RAP.porcentaje,'%') AS porcentaje,
						   DATE_FORMAT(RAP.fecha_creacion,'%d/%m/%Y') AS fecha,
						   RLP.descripcion AS refacciones_lista_precio", FALSE);
		$this->db->from('refacciones_actualizacion_precios AS RAP');
		$this->db->join('refacciones_listas_precios AS RLP', 
						'RAP.refacciones_lista_precio_id = RLP.refacciones_lista_precio_id', 'inner');
		//Si existe id de la lista de precios
	    if($intRefaccionesListaPrecioID > 0)
	    {
	   		$this->db->where('RAP.refacciones_lista_precio_id', $intRefaccionesListaPrecioID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {	   		
	   		$this->db->where("(DATE_FORMAT(RAP.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    $this->db->where("((RLP.descripcion LIKE '%$strBusqueda%') OR
					(RAP.base LIKE '%$strBusqueda%') )"); 
		$this->db->order_by('RAP.fecha_creacion', 'DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["actualizaciones"] =$this->db->get()->result();
		return $arrResultado;
	}
	
	
	/*******************************************************************************************************************
	Funciones de la tabla refacciones_actualizacion_precios_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la promoción
	public function guardar_detalles($intRefaccionActualizacionPrecioID, $strRefaccionesLineaID)
	{
		//Si existen líneas de refacciones
		if($strRefaccionesLineaID !== '')
		{
			//Quitar | de la lista para obtener el ID de la línea de refacción
			$arrRefaccionesLineaID = explode("|", $strRefaccionesLineaID);

			//Hacer recorrido para insertar los datos en la tabla refacciones_actualizacion_precios_detalles
			for ($intCon = 0; $intCon < sizeof($arrRefaccionesLineaID); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('refaccion_actualizacion_precio_id' => $intRefaccionActualizacionPrecioID,
								  'renglon' => ($intCon + 1),
								  'refacciones_linea_id' => $arrRefaccionesLineaID[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('refacciones_actualizacion_precios_detalles', $arrDatos);
			}
	    }
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intRefaccionActualizacionPrecioID)
	{
		$this->db->select("RAPD.refacciones_linea_id,  
						   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea", FALSE);
		$this->db->from('refacciones_actualizacion_precios_detalles AS RAPD');
		$this->db->join('refacciones_lineas AS RL', 'RAPD.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
		$this->db->where('RAPD.refaccion_actualizacion_precio_id', $intRefaccionActualizacionPrecioID);
		$this->db->order_by('RAPD.renglon', 'ASC');
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Función de las tablas refacciones, refacciones_precios y refacciones_inventario
	*********************************************************************************************************************/
	//Método para regresar las refacciones que se actualizarán
	public function buscar_refacciones_actualizar($strBase, $intRefaccionesListaPrecioID, $strRefaccionesLineaID)
	{
		//Variable que se utiliza para asignar el año actual
		$strAnioActual = date("Y");

		//Variable que se utiliza para agregar restricción para la búsqueda de datos
	    $strRestriccionesLineas = '';

		//Si existen líneas de refacción
		if($strRefaccionesLineaID !== '')
		{
			//Quitar | de la lista para obtener el ID de la línea de refacción
			$arrRefaccionesLineaID = explode("|", $strRefaccionesLineaID);

			//Hacer recorrido para 
			for ($intCon = 0; $intCon < sizeof($arrRefaccionesLineaID); $intCon++) 
			{
				$intRefaccionesLineaID = $arrRefaccionesLineaID[$intCon];

				//Si no existen restricciones asignar condición WHERE
				$strRestriccionesLineas .= (($strRestriccionesLineas !== '') ? 
										     " OR " : "AND ( ");

				$strRestriccionesLineas .= " R.refacciones_linea_id = $intRefaccionesLineaID ";
			}

			$strRestriccionesLineas .= ")";
		}

		//Dependiendo de la base realizar la búsqueda de datos
		if($strBase == 'COSTO PROMEDIO')
		{	
			//Seleccionar el costo actual máximo del inventario de refacciones
			$strSQL = $this->db->query("SELECT RI.refaccion_id, MAX(RI.actual_costo) AS actualizar, 
										R.moneda_id
										FROM refacciones_inventario AS RI 
										INNER JOIN refacciones AS R ON RI.refaccion_id = R.refaccion_id
										WHERE RI.anio = '$strAnioActual'
										AND RI.actual_existencia > 0
										$strRestriccionesLineas 
										GROUP BY RI.refaccion_id");
	
		}
		else if($strBase == 'COSTO PLANTA')
		{
			//Seleccionar  el costo planta de las refacciones que coinciden con la lista de precios
			$strSQL = $this->db->query("SELECT R.refaccion_id,  MAX(R.costo_planta) AS actualizar, 
										R.moneda_id
										FROM refacciones_inventario AS RI 
										INNER JOIN refacciones AS R ON RI.refaccion_id = R.refaccion_id
										AND  RI.anio = '$strAnioActual'
										AND  R.costo_planta > 0
										$strRestriccionesLineas
										GROUP BY RI.refaccion_id");
			
		}
		else
		{
			//Seleccionar el precio de las refacciones que coinciden con la lista de precios
			$strSQL = $this->db->query("SELECT RP.refaccion_id,  RP.precio AS actualizar, 
										R.moneda_id
										FROM refacciones_precios AS RP 
										INNER JOIN refacciones AS R ON RP.refaccion_id = R.refaccion_id
										INNER JOIN refacciones_inventario AS RI ON RI.refaccion_id = R.refaccion_id
										WHERE RP.refacciones_lista_precio_id = $intRefaccionesListaPrecioID
										AND  RI.anio = '$strAnioActual'
										$strRestriccionesLineas");

		}

		return $strSQL->result();
	}


	//Método para regresar el precio de la refacción que coincide con los criterios de búsqueda proporcionados
	public function buscar_precio_refaccion($intRefaccionID, $intRefaccionesListaPrecioID)
	{
		$this->db->select('refaccion_id');
	    $this->db->from('refacciones_precios');
	    $this->db->where('refaccion_id', $intRefaccionID);
	    $this->db->where('refacciones_lista_precio_id', $intRefaccionesListaPrecioID);
		$this->db->limit(1);
		return $this->db->get()->row();
	}

}	
?>