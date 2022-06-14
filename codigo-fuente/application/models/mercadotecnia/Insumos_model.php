<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insumos_model extends CI_model {
	
	//Método para guardar un registro nuevo
	public function guardar($strDescripcion)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Asignar datos al array
		$arrDatos = array(
			              'descripcion' => $strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id')
						  );
		//Guardar los datos del registro
		//return $this->db->insert('insumos', $arrDatos);
		$this->db->insert('insumos', $arrDatos);
		//Asignar id del nuevo registro en la base de datos
		$intInsumoID  = $this->db->insert_id();

		$this->inventario_insertar($intInsumoID);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	public function inventario_insertar($intInsumoID){

		//Asignar datos al array
		$arrDatos = array(	'insumo_id' => $intInsumoID,
							'anio' => date("Y"),
							'inicial_existencia' => 0,
							'inicial_costo' => 0,
							'actual_existencia' => 0,
							'actual_costo' => 0 );
		
		//Guardar los datos del registro
		$this->db->insert('insumos_inventario', $arrDatos);

	} 

    //Método para modificar los datos de un registro previamente guardado
	public function modificar($intInsumoID, $strDescripcion)
	{
		//Asignar datos al array
		$arrDatos = array('descripcion' => $strDescripcion, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('insumo_id', $intInsumoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('insumos', $arrDatos);
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intInsumoID, $strEstatus)
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
		$this->db->where('insumo_id', $intInsumoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('insumos', $arrDatos);
	}
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intInsumoID = NULL, $strDescripcion = NULL, $strBusqueda = NULL)
	{
		$this->db->select('insumo_id, descripcion, estatus');
		$this->db->from('insumos');
		//Si existe id del insumo
		if ($intInsumoID !== NULL)
		{   
			$this->db->where('insumo_id', $intInsumoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strDescripcion !== NULL)//Si existe descripción
		{
			//echo $strDescripcion;
			$this->db->where('descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('descripcion', $strBusqueda);
	        $this->db->or_like('estatus', $strBusqueda); 
			$this->db->order_by('descripcion', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);  
		$this->db->from('insumos');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('insumo_id, descripcion, estatus');
		$this->db->from('insumos');
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);  
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["insumos"] =$this->db->get()->result();
		return $arrResultado;
	}

	/*******************************************************************************************************************
	Funciones de la tabla movimientos_insumos_detalles
	*********************************************************************************************************************/

	//Función que se utiliza para guardar los detalles de la orden de compra
	public function guardar_detalles($intOrdenCompraID, $strConceptos, $strCantidades, $strPreciosUnitarios, 
							    	 $strDescuentosUnitarios, $strIvasUnitarios, $strIepsUnitarios)
	{
		/*Quitar | de la lista para obtener el concepto, cantidad, precio unitario, descuento unitario, 
		  iva unitario e ieps unitario
		*/
		$arrConceptos = explode("|", $strConceptos);
		$arrCantidades = explode("|", $strCantidades);
		$arrPreciosUnitarios = explode("|", $strPreciosUnitarios);
		$arrDescuentosUnitarios = explode("|", $strDescuentosUnitarios);
		$arrIvasUnitarios = explode("|", $strIvasUnitarios);
		$arrIepsUnitarios = explode("|", $strIepsUnitarios);

		//Hacer recorrido para insertar los datos en la tabla ordenes_compra_detalles_02
		for ($intCon = 0; $intCon < sizeof($arrConceptos); $intCon++) 
		{
			//Asignar datos al array
			$arrDatos = array('orden_compra_id' => $intOrdenCompraID,
							  'renglon' => ($intCon + 1),
							  'concepto' => $arrConceptos[$intCon], 
							  'cantidad' => $arrCantidades[$intCon],
							  'precio_unitario' => $arrPreciosUnitarios[$intCon],
							  'descuento_unitario' => $arrDescuentosUnitarios[$intCon],
							  'iva_unitario' => $arrIvasUnitarios[$intCon], 
							  'ieps_unitario' => $arrIepsUnitarios[$intCon]);
			//Guardar los datos del registro
			$this->db->insert('ordenes_compra_detalles_02', $arrDatos);
		}
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select("insumo_id, descripcion", FALSE);
		$this->db->from('insumos');
		$this->db->where("( (descripcion LIKE '%$strDescripcion%') )");
		$this->db->where("estatus = 'ACTIVO' ");
		$this->db->order_by("descripcion",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
		return $this->db->get()->result();
	}

}
?>