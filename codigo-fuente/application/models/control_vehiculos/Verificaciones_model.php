<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Verificaciones_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objVerificacion)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		//Variable que se utiliza para asignar el id del nuevo registro
		$intVerificacionID = 0;

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objVerificacion->strFolio); 

		//Tabla verificaciones
		//Asignar datos al array
		$arrDatos = array('folio' => $strFolioConsecutivo, 
						  'fecha' => $objVerificacion->dteFecha,  
						  'tipo' => $objVerificacion->strTipo, 
						  'vehiculo_id' => $objVerificacion->intVehiculoID, 
						  'anio'=> $objVerificacion->strAnio,
						  'placas' => $objVerificacion->strPlacas, 
						  'folio_verificacion' => $objVerificacion->strFolioVerificacion, 
						  'fecha_verificacion' => $objVerificacion->dteFechaVerificacion,
						  'semestre' => $objVerificacion->strSemestre,
						  'centro_verificacion' => $objVerificacion->strCentroVerificacion,
						  'resultado' => $objVerificacion->strResultado,
						  'autorizacion' => $objVerificacion->strAutorizacion,
						  'costo' => $objVerificacion->intCosto,
						  'observaciones' => $objVerificacion->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objVerificacion->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('verificaciones', $arrDatos);
	    //Asignar id del nuevo registro en la base de datos
		$intVerificacionID  = $this->db->insert_id();

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intVerificacionID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objVerificacion)
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Tabla verificaciones
		//Asignar datos al array
		$arrDatos = array('fecha' => $objVerificacion->dteFecha,  
						  'tipo' => $objVerificacion->strTipo, 
						  'vehiculo_id' => $objVerificacion->intVehiculoID, 
						  'anio'=> $objVerificacion->strAnio,
						  'placas' => $objVerificacion->strPlacas, 
						  'folio_verificacion' => $objVerificacion->strFolioVerificacion, 
						  'fecha_verificacion' => $objVerificacion->dteFechaVerificacion,
						  'semestre' => $objVerificacion->strSemestre,
						  'centro_verificacion' => $objVerificacion->strCentroVerificacion,
						  'resultado' => $objVerificacion->strResultado,
						  'autorizacion' => $objVerificacion->strAutorizacion,
						  'costo' => $objVerificacion->intCosto,
						  'observaciones' => $objVerificacion->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objVerificacion->intUsuarioID);
		$this->db->where('verificacion_id', $objVerificacion->intVerificacionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('verificaciones', $arrDatos);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();

	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intVerificacionID, $strEstatus)
	{
		//Asignar datos al array
		$arrDatos = array('estatus' => $strEstatus,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'),
						  'fecha_eliminacion' => NULL,
						  'usuario_eliminacion' => NULL);

		$this->db->where('verificacion_id', $intVerificacionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('verificaciones', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado 
	public function buscar($intVerificacionID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, $intVehiculoID = NULL, $strEstatus = NULL)
	{
		$this->db->select("	VE.verificacion_id, 
							VE.folio, 
							DATE_FORMAT(VE.fecha,'%d/%m/%Y') AS fecha, 
							VE.tipo,
							VE.vehiculo_id,
							VE.anio,
							VE.placas,
							VE.folio_verificacion, 
							DATE_FORMAT(VE.fecha_verificacion,'%d/%m/%Y') AS fecha_verificacion,
							VE.semestre,
							VE.centro_verificacion,
							VE.resultado,
							VE.autorizacion,
							VE.costo,
							VE.observaciones,
							VE.estatus,
							CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca) AS vehiculo");
		$this->db->from('verificaciones VE');
		$this->db->join('vehiculos V', 'VE.vehiculo_id = V.vehiculo_id', 'inner');
		//Si existe id de la verificación
		if ($intVerificacionID !== NULL)
		{   
			$this->db->where('VE.verificacion_id', $intVerificacionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			//Si existe id del vehículo
		    if($intVehiculoID > 0)
		    {
		   		$this->db->where('VE.vehiculo_id', $intVehiculoID);
		    }
		    //Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("(VE.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 
			//Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('VE.estatus', $strEstatus);
			}
			$this->db->order_by('VE.folio', 'DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intVehiculoID = NULL, $strEstatus, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe id del vehículo
	    if($intVehiculoID  != NULL)
	    {
	   		$this->db->where('VE.vehiculo_id', $intVehiculoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(VE.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('VE.estatus', $strEstatus);
		}
		$this->db->from('verificaciones AS VE');
		$this->db->join('vehiculos AS V', 'VE.vehiculo_id = V.vehiculo_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("	VE.verificacion_id, 
							VE.folio, 
							DATE_FORMAT(VE.fecha,'%d/%m/%Y') AS fecha, 
							DATE_FORMAT(VE.fecha_verificacion,'%d/%m/%Y') AS fecha_verificacion,
							VE.tipo,
						   	VE.estatus, 
						   	CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas) AS vehiculo", FALSE);
		$this->db->from('verificaciones AS VE');
		$this->db->join('vehiculos AS V', 'VE.vehiculo_id = V.vehiculo_id', 'inner');
		//Si existe id del vehículo
	    if($intVehiculoID  != NULL)
	    {
	   		$this->db->where('VE.vehiculo_id', $intVehiculoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(VE.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('VE.estatus', $strEstatus);
		}
		$this->db->order_by('VE.folio', 'DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["verificaciones"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" vehiculo_id, CONCAT_WS(' ', codigo, '-', modelo, marca, placas) AS vehiculo ", FALSE);
        $this->db->from('vehiculos');
	    $this->db->where('estatus', 'ACTIVO');
        $this->db->where("(codigo LIKE '%$strDescripcion%' OR 
    					   modelo LIKE '%$strDescripcion%' OR
    					   marca LIKE '%$strDescripcion%' OR
    					   placas LIKE '%$strDescripcion%')");  
        $this->db->order_by("codigo",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

}
?>