<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones_kits_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla refacciones_kits
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objKits)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		
		//Tabla refacciones_kits
		//Asignar datos al array
		$arrDatos = array('codigo' => $objKits->strCodigo, 
						  'descripcion' => $objKits->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objKits->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('refacciones_kits', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objKits->intRefaccionKitID = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles del kit de refacciones
		$this->guardar_detalles($objKits);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objKits)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla refacciones_kits
		//Asignar datos al array
		$arrDatos = array('codigo' => $objKits->strCodigo, 
						  'descripcion' => $objKits->strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objKits->intUsuarioID);
		$this->db->where('refaccion_kit_id', $objKits->intRefaccionKitID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('refacciones_kits', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('refaccion_kit_id', $objKits->intRefaccionKitID);
		$this->db->delete('refacciones_kits_detalles');
		//Hacer un llamado al método para guardar los detalles del kit de refacciones
		$this->guardar_detalles($objKits);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intRefaccionKitID, $strEstatus)
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
		$this->db->where('refaccion_kit_id', $intRefaccionKitID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('refacciones_kits', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intRefaccionKitID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select('refaccion_kit_id, codigo, descripcion, estatus');
	    $this->db->from('refacciones_kits');
		//Si existe id del kit de refacciones
		if ($intRefaccionKitID !== NULL)
		{   
			$this->db->where('refaccion_kit_id', $intRefaccionKitID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigo !== NULL)//Si existe código
		{
			$this->db->where("codigo = '$strCodigo'"); 
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->like('codigo', $strBusqueda);
			$this->db->or_like('descripcion', $strBusqueda); 
	        $this->db->or_like('estatus', $strBusqueda);
			$this->db->order_by('codigo', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('codigo', $strBusqueda);
		$this->db->or_like('descripcion', $strBusqueda); 
        $this->db->or_like('estatus', $strBusqueda);
		$this->db->from('refacciones_kits');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('refaccion_kit_id, codigo, descripcion, estatus');
		$this->db->from('refacciones_kits');
		$this->db->like('codigo', $strBusqueda);
		$this->db->or_like('descripcion', $strBusqueda); 
        $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('codigo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["kits"] =$this->db->get()->result();
		return $arrResultado;
	}

	
	/*******************************************************************************************************************
	Funciones de la tabla refacciones_kits_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles del kit de refacciones
	public function guardar_detalles(stdClass $objKits)
	{
		/*Quitar | de la lista para obtener el ID de la refacción, cantidad y descuento
		*/
		$arrRefaccionID = explode("|", $objKits->strRefaccionID);
		$arrCantidades = explode("|", $objKits->strCantidades);
		$arrDescuentos = explode("|", $objKits->strDescuentos);

		//Hacer recorrido para insertar los datos en la tabla refacciones_kits_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionID); $intCon++) 
		{
			//Asignar datos al array
			$arrDatos = array('refaccion_kit_id' => $objKits->intRefaccionKitID,
							  'renglon' => ($intCon + 1),
							  'refaccion_id' => $arrRefaccionID[$intCon], 
							  'cantidad' => $arrCantidades[$intCon],
							  'descuento' => $arrDescuentos[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('refacciones_kits_detalles', $arrDatos);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intRefaccionKitID)
	{
		//Constante para identificar el ID de la primer lista de precios
        $intRefaccionListaPreciosBase = REFACCION_LISTA_PRECIOS_BASE;
     

		$this->db->select("RKD.refaccion_kit_id, RKD.refaccion_id, RKD.cantidad, RKD.descuento,
						   CONCAT_WS(' - ', R.codigo_01, R.descripcion) AS refaccion,
						   CONCAT_WS(' - ', RL.codigo, RL.descripcion) AS refacciones_linea,
						   RL.codigo AS codigo_refacciones_linea,
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   M.codigo AS codigo_moneda,
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps, 
						   IFNULL(RP.precio, 0) AS precio", FALSE);
		$this->db->from('refacciones_kits_detalles AS RKD');
		$this->db->join('refacciones AS R', 'RKD.refaccion_id = R.refaccion_id', 'inner');
		$this->db->join('refacciones_lineas AS RL', 'R.refacciones_linea_id = RL.refacciones_linea_id', 'inner');
		$this->db->join('sat_monedas AS M', 'R.moneda_id = M.moneda_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIva', 'R.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIeps', 'R.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('refacciones_precios AS RP', 'R.refaccion_id = RP.refaccion_id 
						  AND RP.refacciones_lista_precio_id = '.$intRefaccionListaPreciosBase, 'left');
		$this->db->where('RKD.refaccion_kit_id', $intRefaccionKitID);
		$this->db->order_by('RKD.renglon', 'ASC');
		return $this->db->get()->result();
	}
}	
?>