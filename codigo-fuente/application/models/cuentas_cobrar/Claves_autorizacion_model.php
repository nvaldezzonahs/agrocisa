<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Claves_autorizacion_model extends CI_model {

	//Método para guardar un registro nuevo
	public function guardar(stdClass $objGenerarClave)
	{
		//Asignar datos al array
		$arrDatos = array('prospecto_id' => $objGenerarClave->intProspectoID,
						  'clave' => $objGenerarClave->strClaveGenerada,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objGenerarClave->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('claves_autorizacion', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar($intClaveAutorizacionID, $strReferencia, $intReferenciaID)
	{	

		//Asignar datos al array
		$arrDatos = array('referencia' => $strReferencia,
						  'referencia_id' => $intReferenciaID,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('clave_autorizacion_id', $intClaveAutorizacionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('claves_autorizacion', $arrDatos);
	}

   
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intClaveAutorizacionID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProspectoID = NULL, $strBusqueda = NULL, $strClave = NULL)
	{
		
	    //Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("	CA.clave_autorizacion_id,
							DATE_FORMAT(CA.fecha_creacion,'%d/%m/%Y') AS fecha,
							CA.clave,
							DATE_FORMAT(CA.fecha_actualizacion, '%d/%m/%Y') AS fecha_aplico,
							CA.referencia_id,
							CT.razon_social,
							CASE
								WHEN FM.factura_maquinaria_id > 0 
								  THEN CONCAT_WS(' - ', FM.folio,  CA.referencia)
								WHEN FR.factura_refacciones_id > 0 
								  THEN  CONCAT_WS(' - ', FR.folio, CA.referencia )
								WHEN FS.factura_servicio_id > 0 
									THEN CONCAT_WS(' - ', FS.folio, CA.referencia)
								ELSE ''
								END AS folio_referencia,
						   	CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado_genero,
						   	CONCAT(EA.codigo, ' - ', EA.apellido_paterno,' ', EA.apellido_materno,' ', EA.nombre) AS empleado_aplico", FALSE);
		$this->db->from('claves_autorizacion AS CA');
	    $this->db->join('clientes AS CT', 'CA.prospecto_id = CT.prospecto_id', 'inner');
	    $this->db->join('usuarios AS UC', 'CA.usuario_creacion = UC.usuario_id', 'inner');
	    $this->db->join('empleados AS E', 'E.empleado_id = UC.empleado_id', 'left');
	    $this->db->join('usuarios AS UA', 'CA.usuario_actualizacion = UA.usuario_id', 'left');
	    $this->db->join('empleados AS EA', 'EA.empleado_id = UA.empleado_id', 'left');
	    $this->db->join('facturas_maquinaria AS FM', 'CA.referencia = "MAQUINARIA" 
	    				AND CA.referencia_id = FM.factura_maquinaria_id', 'left');
	    $this->db->join('facturas_refacciones AS FR', 'CA.referencia = "REFACCIONES" 
	    				AND CA.referencia_id = FR.factura_refacciones_id', 'left');
	    $this->db->join('facturas_servicio AS FS', 'CA.referencia = "SERVICIO" 
	    				 AND CA.referencia_id = FS.factura_servicio_id', 'left');

		//Si exite clave
		if($strClave != NULL) 
		{
			$this->db->where('CA.prospecto_id', $intProspectoID);
			$this->db->where('CA.clave', $strClave);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{

			//Si existe id del prospecto
			if($intProspectoID > 0)
		    {
		   		$this->db->where('CA.prospecto_id', $intProspectoID);
		    }

			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		    	$this->db->where("(DATE_FORMAT(CA.fecha_creacion,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }

		    $this->db->where("((CA.clave LIKE '%$strBusqueda%') OR
		    				   (CONCAT_WS(' - ', CT.rfc, CT.razon_social) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', CT.rfc, CT.razon_social) LIKE '%$strBusqueda%') OR
	    				       (CONCAT_WS(' - ', CT.razon_social, CT.rfc) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', CT.razon_social, CT.rfc) LIKE '%$strBusqueda%') OR 
			                  	(CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
							    (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
						        (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
						        (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
						        (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR
						        (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
						        (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
						        (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
			                    (CONCAT_WS(' - ', FM.folio, CA.referencia) LIKE '%$strBusqueda%') OR 
			               	    (CONCAT_WS(' - ', FR.folio, CA.referencia) LIKE '%$strBusqueda%') OR 
			               	    (CONCAT_WS(' - ', FS.folio, CA.referencia) LIKE '%$strBusqueda%'))");

		   
			$this->db->order_by('CA.fecha_creacion', 'DESC');

			return $this->db->get()->result();
		}
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('CA.prospecto_id', $intProspectoID);
	    }

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	    	$this->db->where("(DATE_FORMAT(CA.fecha_creacion,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

      
	    $this->db->where("((CA.clave LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', CT.rfc, CT.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', CT.rfc, CT.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', CT.razon_social, CT.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', CT.razon_social, CT.rfc) LIKE '%$strBusqueda%') OR 
		                  	(CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
						    (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
					        (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					        (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					        (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR
					        (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
					        (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
					        (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
		                    (CONCAT_WS(' - ', FM.folio, CA.referencia) LIKE '%$strBusqueda%') OR 
		               	    (CONCAT_WS(' - ', FR.folio, CA.referencia) LIKE '%$strBusqueda%') OR 
		               	    (CONCAT_WS(' - ', FS.folio, CA.referencia) LIKE '%$strBusqueda%'))");


		$this->db->from('claves_autorizacion AS CA');
	    $this->db->join('clientes AS CT', 'CA.prospecto_id = CT.prospecto_id', 'inner');
	    $this->db->join('usuarios AS UC', 'CA.usuario_creacion = UC.usuario_id', 'inner');
	    $this->db->join('empleados AS E', 'E.empleado_id = UC.empleado_id', 'left');
	    $this->db->join('usuarios AS UA', 'CA.usuario_actualizacion = UA.usuario_id', 'left');
	    $this->db->join('empleados AS EA', 'EA.empleado_id = UA.empleado_id', 'left');
	    $this->db->join('facturas_maquinaria AS FM', 'CA.referencia = "MAQUINARIA" 
	    				AND CA.referencia_id = FM.factura_maquinaria_id', 'left');
	    $this->db->join('facturas_refacciones AS FR', 'CA.referencia = "REFACCIONES" 
	    				AND CA.referencia_id = FR.factura_refacciones_id', 'left');
	    $this->db->join('facturas_servicio AS FS', 'CA.referencia = "SERVICIO" 
	    				 AND CA.referencia_id = FS.factura_servicio_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("	CA.clave_autorizacion_id,
							DATE_FORMAT(CA.fecha_creacion,'%d/%m/%Y') AS fecha,
							CA.clave,
							CT.razon_social,
							CASE
								WHEN FM.factura_maquinaria_id > 0 
								  THEN CONCAT_WS(' - ', FM.folio,  CA.referencia)
								WHEN FR.factura_refacciones_id > 0 
								  THEN  CONCAT_WS(' - ', FR.folio, CA.referencia )
								WHEN FS.factura_servicio_id > 0 
									THEN CONCAT_WS(' - ', FS.folio, CA.referencia)
								ELSE ''
								END AS folio_referencia,
						   	CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado_genero,
						   	CONCAT(EA.codigo, ' - ', EA.apellido_paterno,' ', EA.apellido_materno,' ', EA.nombre) AS empleado_aplico", FALSE);
		$this->db->from('claves_autorizacion AS CA');
	    $this->db->join('clientes AS CT', 'CA.prospecto_id = CT.prospecto_id', 'inner');
	    $this->db->join('usuarios AS UC', 'CA.usuario_creacion = UC.usuario_id', 'inner');
	    $this->db->join('empleados AS E', 'E.empleado_id = UC.empleado_id', 'left');
	    $this->db->join('usuarios AS UA', 'CA.usuario_actualizacion = UA.usuario_id', 'left');
	    $this->db->join('empleados AS EA', 'EA.empleado_id = UA.empleado_id', 'left');
	    $this->db->join('facturas_maquinaria AS FM', 'CA.referencia = "MAQUINARIA" 
	    				AND CA.referencia_id = FM.factura_maquinaria_id', 'left');
	    $this->db->join('facturas_refacciones AS FR', 'CA.referencia = "REFACCIONES" 
	    				AND CA.referencia_id = FR.factura_refacciones_id', 'left');
	    $this->db->join('facturas_servicio AS FS', 'CA.referencia = "SERVICIO" 
	    				 AND CA.referencia_id = FS.factura_servicio_id', 'left');



	    //Si existe id del prospecto
		if($intProspectoID > 0)
	    {
	   		$this->db->where('CA.prospecto_id', $intProspectoID);
	    }
	    
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	    	$this->db->where("(DATE_FORMAT(CA.fecha_creacion,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	   
	    $this->db->where("((CA.clave LIKE '%$strBusqueda%') OR
	    				   (CONCAT_WS(' - ', CT.rfc, CT.razon_social) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', CT.rfc, CT.razon_social) LIKE '%$strBusqueda%') OR
    				       (CONCAT_WS(' - ', CT.razon_social, CT.rfc) LIKE '%$strBusqueda%') OR
		                   (CONCAT_WS(' ', CT.razon_social, CT.rfc) LIKE '%$strBusqueda%') OR 
		                  	(CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
						    (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
					        (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					        (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					        (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR
					        (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
					        (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
					        (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
		                    (CONCAT_WS(' - ', FM.folio, CA.referencia) LIKE '%$strBusqueda%') OR 
		               	    (CONCAT_WS(' - ', FR.folio, CA.referencia) LIKE '%$strBusqueda%') OR 
		               	    (CONCAT_WS(' - ', FS.folio, CA.referencia) LIKE '%$strBusqueda%'))");

	    $this->db->order_by('CA.fecha_creacion', 'DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["claves"] =$this->db->get()->result();
		return $arrResultado;
	}
}