<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones_lineas_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla refacciones_lineas
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objLinea)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();
		//Tabla refacciones_lineas
		//Asignar datos al array
		$arrDatos = array('codigo' => $objLinea->strCodigo, 
						  'descripcion' => $objLinea->strDescripcion, 
						  'modulo_id' => $objLinea->intModuloID, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objLinea->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('refacciones_lineas', $arrDatos);

	    //Agregar id del nuevo registro al objeto
		$objLinea->intRefaccionesLineaID = $this->db->insert_id();

	    //Hacer un llamado al método para guardar los detalles de la línea de refacciones
		$this->guardar_detalles($objLinea);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objLinea)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();
		//Tabla refacciones_lineas
		//Asignar datos al array
		$arrDatos = array('codigo' => $objLinea->strCodigo, 
						  'descripcion' => $objLinea->strDescripcion, 
						  'modulo_id' => $objLinea->intModuloID,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objLinea->intUsuarioID);
		$this->db->where('refacciones_linea_id', $objLinea->intRefaccionesLineaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('refacciones_lineas', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('refacciones_linea_id', $objLinea->intRefaccionesLineaID);
		$this->db->delete('refacciones_lineas_detalles');
		//Hacer un llamado al método para guardar los detalles de la línea de refacciones
		$this->guardar_detalles($objLinea);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intRefaccionesLineaID, $strEstatus)
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
		$this->db->where('refacciones_linea_id', $intRefaccionesLineaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('refacciones_lineas', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intRefaccionesLineaID = NULL, $strCodigo = NULL, $strBusqueda = NULL)
	{
		$this->db->select('RL.refacciones_linea_id, RL.codigo, RL.descripcion, RL.modulo_id,
						   RL.estatus, M.descripcion AS modulo');
		$this->db->from('refacciones_lineas AS RL');
		$this->db->join('modulos AS M', 'RL.modulo_id = M.modulo_id', 'inner');
		//Si existe id de la línea de refacciones
		if ($intRefaccionesLineaID !== NULL)
		{   
			$this->db->where('RL.refacciones_linea_id', $intRefaccionesLineaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigo !== NULL)//Si existe código
		{
			$this->db->where('RL.codigo', $strCodigo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->like('RL.codigo', $strBusqueda);
			$this->db->or_like('RL.descripcion', $strBusqueda);
		    $this->db->or_like('RL.estatus', $strBusqueda); 
		    $this->db->or_like('M.descripcion', $strBusqueda);
			$this->db->order_by('M.descripcion, RL.codigo', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('RL.codigo', $strBusqueda);
		$this->db->or_like('RL.descripcion', $strBusqueda);
		$this->db->or_like('RL.estatus', $strBusqueda); 
		$this->db->or_like('M.descripcion', $strBusqueda);
		$this->db->from('refacciones_lineas AS RL');
		$this->db->join('modulos AS M', 'RL.modulo_id = M.modulo_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('RL.refacciones_linea_id, RL.codigo, RL.descripcion, 
						   M.descripcion AS modulo, RL.estatus');
		$this->db->from('refacciones_lineas AS RL');
		$this->db->join('modulos AS M', 'RL.modulo_id = M.modulo_id', 'inner');
		$this->db->like('RL.codigo', $strBusqueda);
		$this->db->or_like('RL.descripcion', $strBusqueda);
		$this->db->or_like('RL.estatus', $strBusqueda); 
		$this->db->or_like('M.descripcion', $strBusqueda);
		$this->db->order_by('M.descripcion, RL.codigo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["lineas"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" refacciones_linea_id, 
						    CONCAT_WS(' - ', codigo, descripcion) AS descripcion ", FALSE);
        $this->db->from('refacciones_lineas');
   	    $this->db->where('estatus','ACTIVO');
        $this->db->where("(codigo LIKE '%$strDescripcion%' OR  
        				   descripcion LIKE '%$strDescripcion%')");  
		$this->db->order_by('codigo', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla refacciones_lineas_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles de la línea de refacciones
	public function guardar_detalles(stdClass $objLinea)
	{
		/*Quitar | de la lista para obtener el ID de la lista y el porcentaje de utilidad
		*/
		$arrRefaccionesListaPrecioID = explode("|", $objLinea->strRefaccionesListaPrecioID);
		$arrPorcentajesUtilidad = explode("|", $objLinea->strPorcentajesUtilidad);

		//Hacer recorrido para insertar los datos en la tabla refacciones_lineas_detalles
		for ($intCon = 0; $intCon < sizeof($arrRefaccionesListaPrecioID); $intCon++) 
		{
			//Asignar datos al array
			$arrDatos = array('refacciones_linea_id' => $objLinea->intRefaccionesLineaID,
							  'renglon' => ($intCon + 1),
							  'refacciones_lista_precio_id' => $arrRefaccionesListaPrecioID[$intCon], 
							  'porcentaje_utilidad' => $arrPorcentajesUtilidad[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('refacciones_lineas_detalles', $arrDatos);
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intRefaccionesLineaID)
	{
		$this->db->select("RLP.refacciones_lista_precio_id, RLP.descripcion, 
						   IFNULL(RLD.porcentaje_utilidad, 0) AS porcentaje_utilidad", FALSE);
		$this->db->from('refacciones_listas_precios AS RLP');
		$this->db->join('refacciones_lineas_detalles AS RLD', 
						'RLP.refacciones_lista_precio_id = RLD.refacciones_lista_precio_id 
						 AND RLD.refacciones_linea_id = '.$intRefaccionesLineaID, 'left');
		$this->db->where('RLP.estatus', 'ACTIVO');
		$this->db->order_by('RLP.refacciones_lista_precio_id', 'ASC');
		return $this->db->get()->result();
	}
}
?>