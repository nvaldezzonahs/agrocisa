<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refacciones_reclasificacion_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objReclasificacion)
	{
		//Asignar datos al array
		$arrDatos = array('tipo' => $objReclasificacion->strTipo, 
						  'clasificacion' => $objReclasificacion->strClasificacion,
						  'minimo' => $objReclasificacion->intMinimo,
						  'maximo' => $objReclasificacion->intMaximo,
						  'dias_venta' => $objReclasificacion->intDiasVenta,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objReclasificacion->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('refacciones_reclasificacion', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objReclasificacion)
	{
		//Asignar datos al array
		$arrDatos = array('tipo' => $objReclasificacion->strTipo, 
						  'clasificacion' => $objReclasificacion->strClasificacion,
						  'minimo' => $objReclasificacion->intMinimo,
						  'maximo' => $objReclasificacion->intMaximo,
						  'dias_venta' => $objReclasificacion->intDiasVenta, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objReclasificacion->intUsuarioID);
		$this->db->where('refacciones_reclasificacion_id', $objReclasificacion->intRefaccionesReclasificacionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('refacciones_reclasificacion', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intRefaccionesReclasificacionID = NULL, $strCriteriosBusq = NULL, $strTipo = NULL)
	{
		$this->db->select('refacciones_reclasificacion_id, tipo, clasificacion, minimo, maximo, dias_venta');
		$this->db->from('refacciones_reclasificacion');
		//Si existe id de la reclasificación de refacciones
		if ($intRefaccionesReclasificacionID !== NULL)
		{   
			$this->db->where('refacciones_reclasificacion_id', $intRefaccionesReclasificacionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL)//Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (tipo|clasificacion) para obtener los criterios de búsqueda
            list($strTipo, $strClasificacion) = explode("|", $strCriteriosBusq);
			$this->db->where('tipo', $strTipo);
			$this->db->where('clasificacion', $strClasificacion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->where('tipo', $strTipo);
			$this->db->order_by('tipo, clasificacion', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strTipo, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('tipo', $strTipo);
		$this->db->from('refacciones_reclasificacion');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('refacciones_reclasificacion_id, clasificacion, minimo, maximo, dias_venta');
		$this->db->from('refacciones_reclasificacion');
		$this->db->where('tipo', $strTipo);
		$this->db->order_by('clasificacion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["reclasificaciones"] =$this->db->get()->result();
		return $arrResultado;
	}
}
?>