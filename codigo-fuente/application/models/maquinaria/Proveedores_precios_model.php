<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores_precios_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla proveedores_precios
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objProveedorPrecios)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla proveedores_precios
		//Asignar datos al array
		$arrDatos = array('proveedor_id' => $objProveedorPrecios->intProveedorID, 
						  'moneda_id' => $objProveedorPrecios->intMonedaID,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objProveedorPrecios->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('proveedores_precios', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objProveedorPrecios->intProveedorPrecioID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los precios del proveedor
		$this->guardar_detalles($objProveedorPrecios);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objProveedorPrecios)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla proveedores_precios
		//Asignar datos al array
		$arrDatos = array('proveedor_id' => $objProveedorPrecios->intProveedorID, 
						  'moneda_id' => $objProveedorPrecios->intMonedaID,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objProveedorPrecios->intUsuarioID);
		$this->db->where('proveedor_precio_id', $objProveedorPrecios->intProveedorPrecioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('proveedores_precios', $arrDatos);

		//Eliminar los precios guardados
		$this->db->where('proveedor_precio_id', $objProveedorPrecios->intProveedorPrecioID);
		$this->db->delete('proveedores_precios_detalles');
		//Hacer un llamado al método para guardar los precios del proveedor
		$this->guardar_detalles($objProveedorPrecios);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intProveedorPrecioID, $strEstatus)
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
		$this->db->where('proveedor_precio_id', $intProveedorPrecioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('proveedores_precios', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intProveedorPrecioID = NULL, $strCriteriosBusq = NULL, $strBusqueda = NULL)
	{
		$this->db->select("PP.proveedor_precio_id, PP.proveedor_id, 
						   CONCAT_WS(' - ',P.codigo, P.razon_social) AS proveedor, 
						   PP.moneda_id, CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, 
						   PP.estatus", FALSE);
		$this->db->from('proveedores_precios AS PP');
		$this->db->join('proveedores AS P', 'PP.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_monedas AS M', 'PP.moneda_id = M.moneda_id', 'inner');
		///Si existe id de los precios del proveedor
		if ($intProveedorPrecioID !== NULL)
		{   
			$this->db->where('PP.proveedor_precio_id', $intProveedorPrecioID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (proveedor_id|moneda_id) para obtener los criterios de búsqueda
			list($intProveedorID, $intMonedaID) = explode("|", $strCriteriosBusq);
			$this->db->where('PP.proveedor_id', $intProveedorID);
			$this->db->where('PP.moneda_id', $intMonedaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{

			$this->db->where("((PP.estatus LIKE '%$strBusqueda%') OR
			 				    (CONCAT_WS(' - ', M.codigo, M.descripcion) LIKE '%$strBusqueda%') OR
			                    (CONCAT_WS(' ', M.codigo, M.descripcion) LIKE '%$strBusqueda%') OR
        				        (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
			                    (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('P.razon_social', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where("((PP.estatus LIKE '%$strBusqueda%') OR
		 				   (CONCAT_WS(' - ', M.codigo, M.descripcion) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', M.codigo, M.descripcion) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
		$this->db->from('proveedores_precios AS PP');
		$this->db->join('proveedores AS P', 'PP.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_monedas AS M', 'PP.moneda_id = M.moneda_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("PP.proveedor_precio_id, 
						   CONCAT_WS(' - ',P.codigo, P.razon_social) AS proveedor, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, 
						   PP.estatus", FALSE);
		$this->db->from('proveedores_precios AS PP');
		$this->db->join('proveedores AS P', 'PP.proveedor_id = P.proveedor_id', 'inner');
		$this->db->join('sat_monedas AS M', 'PP.moneda_id = M.moneda_id', 'inner');
		$this->db->where("((PP.estatus LIKE '%$strBusqueda%') OR
		 				   (CONCAT_WS(' - ', M.codigo, M.descripcion) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', M.codigo, M.descripcion) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 
		$this->db->order_by('P.razon_social', 'ASC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["proveedores_precios"] = $this->db->get()->result();
		return $arrResultado;
	}

	/*******************************************************************************************************************
	Funciones de la tabla proveedores_precios_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los precios del proveedor
	public function guardar_detalles(stdClass $objProveedorPrecios)
	{
		//Si existen descripciones de maquinaria
		if($objProveedorPrecios->strMaquinariaID !== '')
		{
			//Quitar | de la lista para obtener el ID de la maquinaria y el precio
			$arrMaquinariaID = explode("|", $objProveedorPrecios->strMaquinariaID);
			$arrPrecios = explode("|", $objProveedorPrecios->strPrecios);
			//Hacer recorrido para insertar los datos en la tabla proveedores_precios_detalles
			for ($intCon = 0; $intCon < sizeof($arrMaquinariaID); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('proveedor_precio_id' => $objProveedorPrecios->intProveedorPrecioID,
								  'maquinaria_descripcion_id' => $arrMaquinariaID[$intCon],
								  'renglon' => ($intCon + 1),
								  'precio' => $arrPrecios[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('proveedores_precios_detalles', $arrDatos);
			}
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intProveedorPrecioID)
	{
		$this->db->select("PPD.proveedor_precio_id, PPD.maquinaria_descripcion_id, PPD.precio,
						   CONCAT(MD.codigo, ' - ', MD.descripcion_corta) AS maquinaria, MD.codigo, MD.descripcion_corta");
		$this->db->from('proveedores_precios_detalles AS PPD');
		$this->db->join('maquinaria_descripciones AS MD', 'PPD.maquinaria_descripcion_id = MD.maquinaria_descripcion_id', 'inner');
		$this->db->where('PPD.proveedor_precio_id', $intProveedorPrecioID);
		$this->db->order_by('PPD.renglon', 'ASC');
		return $this->db->get()->result();
	}
}
?>