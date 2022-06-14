<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cultivos_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla cultivos
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objCultivo)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla cultivos
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objCultivo->strDescripcion, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objCultivo->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('cultivos', $arrDatos);

	    //Agregar id del nuevo registro al objeto
		$objCultivo->intCultivoID = $this->db->insert_id();

	    //Hacer un llamado al método para guardar las temporadas del cultivo
		$this->guardar_temporadas($objCultivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objCultivo)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla cultivos
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objCultivo->strDescripcion,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objCultivo->intUsuarioID);
		$this->db->where('cultivo_id', $objCultivo->intCultivoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('cultivos', $arrDatos);

		//Eliminar las temporadas guardadas
		$this->db->where('cultivo_id', $objCultivo->intCultivoID);
		$this->db->delete('cultivos_temporadas');
		//Hacer un llamado al método para guardar las temporadas del cultivo
		$this->guardar_temporadas($objCultivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intCultivoID, $strEstatus)
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
		$this->db->where('cultivo_id', $intCultivoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('cultivos', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intCultivoID = NULL, $strDescripcion = NULL, $strBusqueda = NULL)
	{
		$this->db->select('cultivo_id, descripcion, estatus');
		$this->db->from('cultivos');
		//Si existe id del cultivo
		if ($intCultivoID !== NULL)
		{   
			$this->db->where('cultivo_id', $intCultivoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strDescripcion !== NULL)//Si existe descripción
		{
			$this->db->where('descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->like('descripcion', $strBusqueda);;
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
		$this->db->from('cultivos');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('cultivo_id, descripcion, estatus');
		$this->db->from('cultivos');
		$this->db->like('descripcion', $strBusqueda);
	    $this->db->or_like('estatus', $strBusqueda);
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["cultivos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(' cultivo_id, descripcion ');
        $this->db->from('cultivos');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(descripcion LIKE '%$strDescripcion%')");  
        $this->db->order_by("descripcion",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla cultivos_temporadas
	*********************************************************************************************************************/
	//Función que se utiliza para guardar las temporadas del cultivo
	public function guardar_temporadas(stdClass $objCultivo)
	{
		//Si existen temporadas
		if($objCultivo->strSiembras !== '')
		{
			//Quitar | de la lista para obtener la siembra y cosecha
			$arrSiembras = explode("|", $objCultivo->strSiembras);
			$arrCosechas = explode("|", $objCultivo->strCosechas);

			//Hacer recorrido para insertar los datos en la tabla cultivos_temporadas
			for ($intCon = 0; $intCon < sizeof($arrSiembras); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('cultivo_id' => $objCultivo->intCultivoID,
								  'renglon' => ($intCon + 1),
								  'siembra' => $arrSiembras[$intCon],
								  'cosecha' => $arrCosechas[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('cultivos_temporadas', $arrDatos);
			}
		}
	}

	//Método para regresar las temporadas de un registro
	public function buscar_temporadas($intCultivoID)
	{
		$this->db->select('siembra, cosecha');
		$this->db->from('cultivos_temporadas');
		$this->db->where('cultivo_id', $intCultivoID);
		$this->db->order_by('renglon', 'ASC');
		return $this->db->get()->result();
	}
}
?>