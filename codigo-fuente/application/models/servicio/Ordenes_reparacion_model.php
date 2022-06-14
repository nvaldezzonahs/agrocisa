<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Ordenes_reparacion_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla ordenes_reparacion
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objOrdenReparacion)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        
		//Variable que se utiliza para asignar el id del nuevo registro
		$intOrdenReparacionID = 0;


		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objOrdenReparacion->strFolio); 

		//Tabla ordenes_reparacion
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objOrdenReparacion->intSucursalID,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objOrdenReparacion->dteFecha, 
						  'servicio_tipo_id' => $objOrdenReparacion->intServicioTipoID,
						  'tipo_reparacion' => $objOrdenReparacion->strTipoReparacion,
						  'ubicacion' => $objOrdenReparacion->strUbicacion,
						  'prospecto_id' => $objOrdenReparacion->intProspectoID,
						  'serie' => $objOrdenReparacion->strSerie,
						  'motor' => $objOrdenReparacion->strMotor,
						  'equipo_tipo_id' => $objOrdenReparacion->intEquipoTipoID,
						  'maquinaria_descripcion_id' => $objOrdenReparacion->intMaquinariaDescripcionID,
						  'horas' => $objOrdenReparacion->intHoras,
						  'falla' => $objOrdenReparacion->strFalla,
						  'causa' => $objOrdenReparacion->strCausa,
						  'solucion' => $objOrdenReparacion->strSolucion,
						  'gastos_servicio' => $objOrdenReparacion->intGastosServicio,
						  'gastos_servicio_iva' => $objOrdenReparacion->intGastosServicioIva,
						  'observaciones' => $objOrdenReparacion->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objOrdenReparacion->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('ordenes_reparacion', $arrDatos);
		//Asignar id del nuevo registro en la base de datos
		$intOrdenReparacionID  = $this->db->insert_id();

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intOrdenReparacionID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objOrdenReparacion)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla ordenes_reparacion
		//Asignar datos al array
		$arrDatos = array('fecha' => $objOrdenReparacion->dteFecha, 
						  'servicio_tipo_id' => $objOrdenReparacion->intServicioTipoID,
						  'tipo_reparacion' => $objOrdenReparacion->strTipoReparacion,
						  'ubicacion' => $objOrdenReparacion->strUbicacion,
						  'prospecto_id' => $objOrdenReparacion->intProspectoID,
						  'serie' => $objOrdenReparacion->strSerie,
						  'motor' => $objOrdenReparacion->strMotor,
						  'equipo_tipo_id' => $objOrdenReparacion->intEquipoTipoID,
						  'maquinaria_descripcion_id' => $objOrdenReparacion->intMaquinariaDescripcionID,
						  'horas' => $objOrdenReparacion->intHoras,
						  'falla' => $objOrdenReparacion->strFalla,
						  'causa' => $objOrdenReparacion->strCausa,
						  'solucion' => $objOrdenReparacion->strSolucion,
						  'gastos_servicio' => $objOrdenReparacion->intGastosServicio,
						  'gastos_servicio_iva' => $objOrdenReparacion->intGastosServicioIva,
						  'observaciones' => $objOrdenReparacion->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objOrdenReparacion->intUsuarioID);
		$this->db->where('orden_reparacion_id', $objOrdenReparacion->intOrdenReparacionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('ordenes_reparacion', $arrDatos);

		//Eliminar otros servicios guardados
		$this->db->where('orden_reparacion_id', $objOrdenReparacion->intOrdenReparacionID);
		$this->db->delete('ordenes_reparacion_otros');

		//Hacer un llamado al método para guardar otros servicios de la orden de reparación
		$this->guardar_otros($objOrdenReparacion);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intOrdenReparacionID, $strEstatus, $strSerie = NULL)
	{
		//Dependiendo del estatus actualizar el registro
		if($strEstatus == 'ACTIVO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'),
							  'fecha_eliminacion' => NULL,
							  'usuario_eliminacion' => NULL);
		}
		else if ($strEstatus == 'INACTIVO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_eliminacion' => date("Y-m-d H:i:s"),
							  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
		}
		else if ($strEstatus == 'FINALIZADO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'serie' => $strSerie,
							  'fecha_finalizacion' => date("Y-m-d H:i:s"),
							  'usuario_finalizacion' =>  $this->session->userdata('usuario_id'));
		}
		else if($strEstatus == 'FACTURADO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		}
		else //REACTIVAR
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => 'ACTIVO',
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'),
							  'fecha_finalizacion' => NULL,
							  'usuario_finalizacion' => NULL);

		}
		$this->db->where('orden_reparacion_id', $intOrdenReparacionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('ordenes_reparacion', $arrDatos);
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intOrdenReparacionID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intProspectoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{

		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strProcesoPoliza = $this->db->escape('ORDEN DE TRABAJO');

		$this->db->select("OREP.orden_reparacion_id, OREP.folio, 
						   DATE_FORMAT(OREP.fecha,'%d/%m/%Y') AS fecha, 
						   OREP.servicio_tipo_id, OREP.tipo_reparacion, OREP.ubicacion, 
						   OREP.prospecto_id, OREP.serie, 
		                   OREP.motor, OREP.equipo_tipo_id, OREP.maquinaria_descripcion_id, 
		                   OREP.horas, OREP.falla, OREP.causa, OREP.solucion, 
		                   OREP.gastos_servicio, OREP.gastos_servicio_iva, OREP.observaciones,  
		                   OREP.estatus, DATE_FORMAT(OREP.fecha_finalizacion,'%d/%m/%Y') AS fecha_finalizacion,
					       UF.usuario AS usuario_finalizacion, 
					       ST.descripcion AS servicio_tipo,
					       ST.facturar AS facturar_servicio_tipo,
					       CASE 
							   WHEN  C.prospecto_id > 0 THEN C.razon_social
								    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   	END AS prospecto,
					       	P.telefono_principal, P.calle, P.numero_exterior, 
					       	P.numero_interior, P.colonia,  L.descripcion AS localidad, 
						   	MP.descripcion AS municipio, EP.descripcion AS estado,
						   	CP.codigo_postal, ET.descripcion AS equipo_tipo, 
					       	CONCAT(MD.codigo, ' - ', MD.descripcion_corta) AS maquinaria_descripcion,
					       	C.servicio_credito_dias, C.rfc,
					       	CASE 
							   WHEN  C.regimen_fiscal_id > 0 
							   		THEN C.regimen_fiscal_id		
							   ELSE 0
						    END regimen_fiscal_id,
					       	C.estatus AS cliente_estatus,
					       	C.nombre_comercial AS cliente, C.razon_social, 
					       	C.telefono_principal AS cliente_telefono_principal, 
						   	C.calle AS cliente_calle, 
						   	C.numero_exterior AS cliente_numero_exterior, 
						   	C.numero_interior AS cliente_numero_interior,  
						   	CCP.codigo_postal AS cliente_codigo_postal,
						   	C.colonia AS cliente_colonia, 
						   	C.localidad AS cliente_localidad, 
						   	MC.descripcion AS cliente_municipio,  
						   	EC.descripcion AS cliente_estado, 
						   	PC.descripcion AS cliente_pais,
						   	UC.usuario AS usuario_creacion,
						    DATE_FORMAT(OREP.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion, 
						    IFNULL((SELECT COUNT(RR.requisicion_refacciones_id)
						    		FROM requisiciones_refacciones AS RR
						    		WHERE RR.orden_reparacion_id = OREP.orden_reparacion_id
						    		AND (RR.estatus = 'ACTIVO' OR
						    			 RR.estatus = 'PARCIALMENTE SURTIDO')), 0) AS total_requisiciones, 
						    IFNULL(PF.poliza_id, 0) AS poliza_id, 
						    PF.folio AS folio_poliza ", FALSE);
		$this->db->from('ordenes_reparacion AS OREP');
		$this->db->join('servicios_tipos AS ST', 'OREP.servicio_tipo_id = ST.servicio_tipo_id', 'inner');
	    $this->db->join('equipos_tipos AS ET', 'OREP.equipo_tipo_id = ET.equipo_tipo_id', 'inner');
	    $this->db->join('maquinaria_descripciones AS MD', 'OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id', 'inner');
	    $this->db->join('prospectos AS P', 'OREP.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'P.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('sat_codigos_postales AS CCP', 'C.codigo_postal_id = CCP.codigo_postal_id', 'left');
		$this->db->join('municipios AS MC', 'C.municipio_id = MC.municipio_id', 'left');
		$this->db->join('sat_estados AS EC', 'MC.estado_id = EC.estado_id', 'left');
		$this->db->join('sat_paises AS PC', 'EC.pais_id = PC.pais_id', 'left');
		$this->db->join('usuarios AS UF', 'OREP.usuario_finalizacion = UF.usuario_id', 'left');
		$this->db->join('usuarios AS UC', 'OREP.usuario_creacion = UC.usuario_id', 'left');
		$this->db->join('polizas AS PF', 'OREP.orden_reparacion_id = PF.referencia_id
	    							      AND PF.proceso = '.$strProcesoPoliza.' 
	    							      AND PF.modulo = "SERVICIO"', 'left');
		//Si existe id de la orden de reparación
		if ($intOrdenReparacionID !== NULL)
		{   
			$this->db->where('OREP.orden_reparacion_id', $intOrdenReparacionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->where('OREP.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del prospecto
		    if($intProspectoID > 0)
		    {
		   		$this->db->where('OREP.prospecto_id', $intProspectoID);
		    }
		    //Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(OREP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 
			//Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where('OREP.estatus','FINALIZADO');
					$this->db->where('ST.facturar','NO');
				}
				else
				{
					$this->db->where('OREP.estatus', $strEstatus);
				}
			}

			$this->db->where("((OREP.folio LIKE '%$strBusqueda%') OR
								(C.razon_social LIKE '%$strBusqueda%') OR
							    (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
				                (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))"); 
			$this->db->order_by('OREP.folio', 'DESC');
			return $this->db->get()->result();
		}
	}

	/*Método para regresar las ordenes de reparación que coincidan con los criterios de 
	 búsqueda proporcionados*/
	public function buscar_ordenes_proceso($dteFechaCorte = NULL, $strSucursales = NULL, 
										   $strServiciosTipos =  NULL, $intProspectoID =  NULL,  
										   $intMecanicoID =  NULL, $dteFechaInicial = NULL, 
										   $strSerie =  NULL, $strFormulario = NULL)
	{
		//Variable que se utiliza para formar la consulta
		$queryOrdenesReparacion = '';
		//Variable que se utiliza para agregar union con las tablas ordenes_reparacion_servicios y mecanicos
		$strUnionServiciosReparacion = '';
		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		//Fecha de corte
		$strRestriccionesRegFecha = '';
		//Prospecto
		$strRestriccionesProspecto = '';
		//Mecánico
		$strRestriccionesMecanico = '';
		//Serie
		$strRestriccionesSerie = '';
		//ID´s de las sucursales
		$strRestriccionesSucursales = '';
		//ID´s de los tipos de servicios
		$strRestriccionesServiciosTipos = '';


		//Variable que se utiliza para agregar los campos de las tabla facturas_servicio
		$strCamposFacturasServicio = '';


		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			$strRestriccionesProspecto .= " AND OREP.prospecto_id = $intProspectoID";
		}

		//Si existe id del mecánico 
		if($intMecanicoID > 0)
		{
			//Relacionar tablas: ordenes_reparacion y ordenes_reparacion_servicios
			$strUnionServiciosReparacion .= "INNER JOIN ordenes_reparacion_servicios AS ORS 
										 		   ON OREP.orden_reparacion_id = ORS.orden_reparacion_id";
			
			//Relacionar tablas: ordenes_reparacion_servicios y mecanicos (empleados)
			$strUnionServiciosReparacion .= " INNER JOIN mecanicos AS M ON ORS.mecanico_id = M.mecanico_id";
			$strUnionServiciosReparacion .= " INNER JOIN empleados AS E ON M.empleado_id = E.empleado_id";

			//Restricción del estatus (servicio de la orden de reparación)
			$strRestriccionesMecanico .= " AND ORS.estatus = 'FINALIZADO'";	

			//Restricción del ID del mecánico
			$strRestriccionesMecanico .= " AND ORS.mecanico_id = $intMecanicoID";

		}

		//Si existe serie
		if($strSerie != NULL)
		{
			$strRestriccionesSerie .= " AND OREP.serie = '$strSerie'";
		}

		//Si el formulario (proceso) corresponde al reporte detallado de ordenes de reparación
		if($strFormulario == 'DETALLADO')
		{

			$strRestriccionesRegFecha = "OREP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaCorte'";
		}
		else //Si el formulario (proceso) corresponde al reporte de ordenes en proceso
		{
			$strRestriccionesRegFecha = "(ST.facturar = 'SI' OR ST.facturar = 'NO')
										AND  ((OREP.fecha <= '$dteFechaCorte' 
											   AND (OREP.estatus = 'ACTIVO' OR OREP.estatus = 'FINALIZADO')) OR 
											  (OREP.fecha <= '$dteFechaCorte' 
											   AND DATE_FORMAT(OREP.fecha_finalizacion, '%Y-%m-%d') >= '$dteFechaCorte' 
											   AND OREP.estatus = 'FINALIZADO'))";
		}

		//Si existen sucursales seleccionadas
		if($strSucursales)
		{
			//Generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
			$strRestriccionesSucursales .= " AND (";

		    //Quitar | de la lista para obtener el id de la sucursal
			$arrSucursales = explode("|", $strSucursales);

			//Hacer recorrido para formar restricción con los ID's de las sucursales
			for ($intCon = 0; $intCon < sizeof($arrSucursales); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otra sucursal)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesSucursales .= " OR ";
				}

				//Concatenar id de la sucursal 
				$strRestriccionesSucursales .= "OREP.sucursal_id = ".$arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}//Cierre de verificación de sucursales


		//Si existen tipos de servicios seleccionados
		if($strServiciosTipos)
		{

			//Generar las condiciones dinamicas de las consultas respecto a la columna servicio_tipo_id
			$strRestriccionesServiciosTipos .= " AND (";

		    //Quitar | de la lista para obtener el id del tipo de servicio 
			$arrServiciosTipos = explode("|", $strServiciosTipos);

			//Hacer recorrido para formar restricción con los ID's de los tipos de servicios
			for ($intCon = 0; $intCon < sizeof($arrServiciosTipos); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otro tipo de servicio)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesServiciosTipos .= " OR ";
				}

				//Concatenar id del tipo de servicio 
				$strRestriccionesServiciosTipos .= "OREP.servicio_tipo_id = ".$arrServiciosTipos[$intCon];
			}

			$strRestriccionesServiciosTipos .= ")";

		}//Cierre de verificación de tipos de servicios


		//Ordenes de reparación
		$queryOrdenesReparacion = "SELECT OREP.orden_reparacion_id, OREP.folio, 
										  DATE_FORMAT(OREP.fecha,'%d/%m/%Y') AS fecha,
										  OREP.tipo_reparacion, OREP.ubicacion, OREP.serie, 
										  OREP.falla, OREP.causa, OREP.solucion, 
										  OREP.gastos_servicio, OREP.gastos_servicio_iva, 
										  OREP.estatus, MD.descripcion_corta AS maquinaria_descripcion, 
									      ST.descripcion AS servicio_tipo, 
										  CASE 
										    WHEN  C.prospecto_id > 0  
										      THEN CONCAT_WS(' - ', P.codigo, C.razon_social)  
											ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
										 END AS prospecto, 
										 P.telefono_principal, P.calle, P.numero_exterior, 
										 P.numero_interior, P.colonia,  L.descripcion AS localidad, 
										 MP.descripcion AS municipio, EP.descripcion AS estado,
										 CP.codigo_postal,  C.estatus AS cliente_estatus,
										 C.telefono_principal AS cliente_telefono_principal, 
										 C.calle AS cliente_calle, C.numero_exterior AS cliente_numero_exterior, 
										 C.numero_interior AS cliente_numero_interior,  
										 CCP.codigo_postal AS cliente_codigo_postal,
										 C.colonia AS cliente_colonia, C.localidad AS cliente_localidad, 
										 MC.descripcion AS cliente_municipio, EC.descripcion AS cliente_estado, 
									     PC.descripcion AS cliente_pais 
									     $strCamposFacturasServicio
									FROM ordenes_reparacion AS OREP
									INNER JOIN servicios_tipos AS ST ON OREP.servicio_tipo_id = ST.servicio_tipo_id
									INNER JOIN maquinaria_descripciones AS MD ON OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
									$strUnionServiciosReparacion
									INNER JOIN prospectos AS P ON OREP.prospecto_id = P.prospecto_id
									INNER JOIN localidades AS L ON P.localidad_id = L.localidad_id
									INNER JOIN municipios AS MP ON L.municipio_id = MP.municipio_id
									INNER JOIN sat_estados AS EP ON MP.estado_id = EP.estado_id
									LEFT JOIN sat_codigos_postales AS CP ON P.codigo_postal_id = CP.codigo_postal_id
									LEFT JOIN clientes AS C ON P.prospecto_id = C.prospecto_id
									LEFT JOIN sat_codigos_postales AS CCP ON C.codigo_postal_id = CCP.codigo_postal_id
									LEFT JOIN  municipios AS MC ON C.municipio_id = MC.municipio_id
									LEFT JOIN sat_estados AS EC ON MC.estado_id = EC.estado_id
									LEFT JOIN sat_paises AS PC ON EC.pais_id = PC.pais_id
									WHERE $strRestriccionesRegFecha
									$strRestriccionesSucursales
									$strRestriccionesServiciosTipos
									$strRestriccionesSerie
									$strRestriccionesProspecto
									$strRestriccionesMecanico
								   ORDER BY OREP.fecha, OREP.folio";

		$strSQL = $this->db->query($queryOrdenesReparacion);
		return $strSQL->result();
	}


	/*Método para regresar los acumulados ordenes de reparación por mecánico que coincidan con los criterios de 
	 búsqueda proporcionados*/
	public function buscar_ordenes_mecanicos($dteFechaInicial = NULL, $dteFechaFinal = NULL, 
											 $strSucursales = NULL, $strServiciosTipos =  NULL,
										     $intMecanicoID =  NULL)
	{

		//Variable que se utiliza para formar la consulta
		$queryOrdenesReparacion = '';
		//Variable que se utiliza para agregar union con las tablas ordenes_reparacion_servicios y mecanicos
		$strUnionServiciosReparacion = '';
		//Variables que se utilizan para agregar restricciones a la búsqueda de datos
		//Mecánico
		$strRestriccionesMecanico = '';
		//ID´s de las sucursales
		$strRestriccionesSucursales = '';
		//ID´s de los tipos de servicios
		$strRestriccionesServiciosTipos = '';

		//Si existe id del mecánico 
		if($intMecanicoID > 0)
		{
			$strRestriccionesMecanico .= " AND ORS.mecanico_id = $intMecanicoID";
		}

		//Si existen sucursales seleccionadas
		if($strSucursales)
		{
			//Generar las condiciones dinamicas de las consultas respecto a la columna sucursal_id
			$strRestriccionesSucursales .= " AND (";

		    //Quitar | de la lista para obtener el id de la sucursal
			$arrSucursales = explode("|", $strSucursales);

			//Hacer recorrido para formar restricción con los ID's de las sucursales
			for ($intCon = 0; $intCon < sizeof($arrSucursales); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otra sucursal)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesSucursales .= " OR ";
				}

				//Concatenar id de la sucursal 
				$strRestriccionesSucursales .= "OREP.sucursal_id = ".$arrSucursales[$intCon];
			}

			$strRestriccionesSucursales .= ")";

		}//Cierre de verificación de sucursales


		//Si existen tipos de servicios seleccionados
		if($strServiciosTipos)
		{

			//Generar las condiciones dinamicas de las consultas respecto a la columna servicio_tipo_id
			$strRestriccionesServiciosTipos .= " AND (";

		    //Quitar | de la lista para obtener el id del tipo de servicio 
			$arrServiciosTipos = explode("|", $strServiciosTipos);

			//Hacer recorrido para formar restricción con los ID's de los tipos de servicios
			for ($intCon = 0; $intCon < sizeof($arrServiciosTipos); $intCon++) 
			{
				//Si el contador es mayor a cero (concatenar OR a la cadena para obtener datos de otro tipo de servicio)
				if($intCon > 0)
				{
					//Asignar condición OR
					$strRestriccionesServiciosTipos .= " OR ";
				}

				//Concatenar id del tipo de servicio 
				$strRestriccionesServiciosTipos .= "OREP.servicio_tipo_id = ".$arrServiciosTipos[$intCon];
			}

			$strRestriccionesServiciosTipos .= ")";

		}//Cierre de verificación de tipos de servicios


		//Ordenes de reparación
		$queryOrdenesReparacion = "SELECT OREP.orden_reparacion_id, OREP.folio, 
										  DATE_FORMAT(OREP.fecha,'%d/%m/%Y') AS fecha,
										  OREP.tipo_reparacion, OREP.ubicacion,
										  ST.descripcion AS servicio_tipo, 
										  CASE 
										    WHEN  C.prospecto_id > 0  
										      THEN CONCAT_WS(' - ', P.codigo, C.razon_social)  
											ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
										 END AS prospecto, 
										 ORS.mecanico_id, 
										 CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS mecanico, 
										 FS.factura_servicio_id,  'SERVICIO' AS tipo_referencia, 
										 IFNULL(ROUND((OREP.gastos_servicio + OREP.gastos_servicio_iva), 2), 0) AS Total_GastosServicio, 
										 IFNULL(ROUND(OREP.gastos_servicio, 2), 0) AS Subtotal_GastosServicio, 
										 IFNULL(ROUND(OREP.gastos_servicio_iva, 2), 0) AS IVA_GastosServicio,
										 IFNULL(Otros.Importe, 0) AS Total_Otros,
										 IFNULL(Otros.Subtotal, 0) AS Subtotal_Otros,
										 IFNULL(Otros.IVA, 0) AS IVA_Otros,
										 IFNULL(Otros.IEPS, 0) AS IEPS_Otros
									FROM ordenes_reparacion AS OREP
									INNER JOIN servicios_tipos AS ST ON OREP.servicio_tipo_id = ST.servicio_tipo_id
									INNER JOIN ordenes_reparacion_servicios AS ORS ON OREP.orden_reparacion_id = ORS.orden_reparacion_id
									INNER JOIN mecanicos AS M ON ORS.mecanico_id = M.mecanico_id
									INNER JOIN empleados AS E ON M.empleado_id = E.empleado_id
									INNER JOIN prospectos AS P ON OREP.prospecto_id = P.prospecto_id
									LEFT JOIN clientes AS C ON P.prospecto_id = C.prospecto_id
									LEFT JOIN facturas_servicio AS FS ON OREP.orden_reparacion_id =  FS.orden_reparacion_id AND (FS.estatus = 'ACTIVO' OR FS.estatus = 'TIMBRAR')
									LEFT JOIN (SELECT Det.orden_reparacion_id,
															   SUM(ROUND((Det.precio_unitario * Det.cantidad), 2) + 
								   						  	 	   ROUND((Det.iva_unitario * Det.cantidad), 2) + 
								   						  	       ROUND((Det.ieps_unitario * Det.cantidad), 2)) AS Importe,
								   						      SUM(ROUND((Det.precio_unitario * Det.cantidad), 2)) AS Subtotal, 
													          SUM(ROUND((Det.iva_unitario * Det.cantidad), 2)) AS IVA, 
													          SUM(ROUND((Det.ieps_unitario * Det.cantidad), 2)) AS IEPS
													    FROM ordenes_reparacion_otros AS Det
													    GROUP BY Det.orden_reparacion_id) AS Otros ON OREP.orden_reparacion_id = Otros.orden_reparacion_id
									WHERE OREP.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'
									AND OREP.estatus <> 'INACTIVO'
									AND ORS.estatus = 'FINALIZADO'
									$strRestriccionesMecanico
									$strRestriccionesSucursales
									$strRestriccionesServiciosTipos
								   ORDER BY ORS.mecanico_id, OREP.fecha, OREP.folio";

		$strSQL = $this->db->query($queryOrdenesReparacion);
		return $strSQL->result();
	}


	/*Método para regresar las ordenes de reparación por mano de obra que coincidan con los criterios de 
	 búsqueda proporcionados*/
	public function buscar_ordenes_mano_obra($dteFechaInicial, $dteFechaFinal)
	{
		//Ordenes de reparación
		$queryOrdenesReparacion = "SELECT S.sucursal_id, S.nombre AS Sucursal, 
										  M.mecanico_id, E.codigo AS CodMec, 
								       CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) AS Mecanico,
								       OrdRep.folio AS FolioOrden, FS.folio AS FolioFactura, 
								       DATE_FORMAT(FS.fecha,'%d/%m/%Y') AS fecha, FS.razon_social,
								       IFNULL(SUM(ORS.horas * ORS.precio), 0) AS Importe, ST.servicio_tipo_id
									FROM   ordenes_reparacion OrdRep INNER JOIN sucursales S ON OrdRep.sucursal_id = S.sucursal_id 
									       INNER JOIN ordenes_reparacion_servicios ORS ON OrdRep.orden_reparacion_id = ORS.orden_reparacion_id 
									       INNER JOIN servicios_tipos ST ON OrdRep.servicio_tipo_id = ST.servicio_tipo_id 
									       INNER JOIN facturas_servicio FS ON OrdRep.orden_reparacion_id = FS.orden_reparacion_id 
									       INNER JOIN mecanicos M ON ORS.mecanico_id = M.mecanico_id 
									       INNER JOIN empleados E ON M.empleado_id = E.empleado_id 
									WHERE  DATE_FORMAT(FS.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
									AND    DATE_FORMAT(FS.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
									AND    FS.estatus <> 'INACTIVO' 
									GROUP BY OrdRep.orden_reparacion_id, M.mecanico_id, FS.factura_servicio_id";
			$queryOrdenesReparacion .= " UNION ";
			$queryOrdenesReparacion .= "SELECT S.sucursal_id, S.nombre AS Sucursal, M.mecanico_id, 
											   E.codigo AS CodMec, 
										       CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) AS Mecanico, 
										       OrdRep.folio AS FolioOrden, '' AS FolioFactura, 
										       	DATE_FORMAT(OrdRep.fecha,'%d/%m/%Y') AS fecha, 
										       	ST.descripcion AS razon_social, 
										       IFNULL(SUM(ORS.horas * ORS.precio), 0) AS Importe, ST.servicio_tipo_id 
										FROM   ordenes_reparacion OrdRep INNER JOIN sucursales S ON OrdRep.sucursal_id = S.sucursal_id 
										       INNER JOIN ordenes_reparacion_servicios ORS ON OrdRep.orden_reparacion_id = ORS.orden_reparacion_id
										       INNER JOIN servicios_tipos ST ON OrdRep.servicio_tipo_id = ST.servicio_tipo_id 
										       INNER JOIN clientes C ON OrdRep.prospecto_id = C.prospecto_id 
										       INNER JOIN mecanicos M ON ORS.mecanico_id = M.mecanico_id
										       INNER JOIN empleados E ON M.empleado_id = E.empleado_id 
										WHERE  OrdRep.fecha_finalizacion >= '$dteFechaInicial  00:00:00' 
										AND    OrdRep.fecha_finalizacion <= '$dteFechaFinal  23:59:59' 
										AND    OrdRep.estatus = 'FINALIZADO' 
										AND    ST.facturar = 'NO' 
										GROUP BY OrdRep.orden_reparacion_id, M.mecanico_id
										ORDER BY sucursal_id, mecanico_id, FolioOrden";


		$strSQL = $this->db->query($queryOrdenesReparacion);
		return $strSQL->result();

	}



	/*Método para regresar las comisiones de los servicios que coincidan con los criterios de 
	 búsqueda proporcionados*/
	public function buscar_comisiones($dteFechaInicial, $dteFechaFinal)
	{
		//Comisiones de servicios
		$queryComisiones = "SELECT S.sucursal_id, S.nombre AS Sucursal, M.mecanico_id, 
										  E.codigo AS CodMec, 
								       CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) AS Mecanico, 
								       OrdRep.folio AS FolioOrden, FS.folio AS FolioFactura, 
								       DATE_FORMAT(FS.fecha,'%d/%m/%Y') AS fecha, FS.razon_social, 
								       IFNULL(SUM(ORS.horas * ORS.precio), 0) AS Importe, ST.servicio_tipo_id, 
								       (ROUND(IFNULL(FS.gastos_servicio, 0), 2) + 
								       	ROUND(IFNULL(FS.gastos_servicio_iva, 0), 2) + 
								       	ROUND(IFNULL(ManoObra.Total, 0), 2) + 
								       	ROUND(IFNULL(Refacciones.Total, 0), 2) + 
								       	ROUND(IFNULL(Foraneos.Total, 0), 2) + 
								       	ROUND(IFNULL(Otros.Total, 0), 2) + 
								        (IFNULL((SELECT SUM(NCD.precio + NCD.iva + NCD.ieps) 
												 FROM   notas_cargo NC INNER JOIN notas_cargo_detalles NCD ON NC.nota_cargo_id = NCD.nota_cargo_id 
												 WHERE  NCD.referencia = 'SERVICIO' 
												 AND    NCD.referencia_id = FS.factura_servicio_id 
												 AND    NC.estatus <> 'INACTIVO'), 0)) + 
								        (IFNULL((SELECT SUM(NCDD.precio + NCDD.iva + NCDD.ieps) 
												 FROM   notas_cargo_digitales NCD INNER JOIN notas_cargo_digitales_detalles NCDD 
												        ON NCD.nota_cargo_digital_id = NCDD.nota_cargo_digital_id 
												 WHERE  NCDD.referencia = 'SERVICIO' 
												 AND    NCDD.referencia_id = FS.factura_servicio_id 
												 AND    NCD.estatus <> 'INACTIVO'), 0))) AS Total, 
									   ((IFNULL((SELECT SUM(PDR.imp_pagado) 
										         FROM   pagos P INNER JOIN pagos_detalles_relacionados_02 PDR ON PDR.pago_id = P.pago_id 
										         WHERE  PDR.tipo_referencia = 'SERVICIO' 
												 AND    PDR.referencia_id = FS.factura_servicio_id 
												 AND    DATE_FORMAT(P.fecha, '%Y-%m-%d') <= '$dteFechaFinal'
										         AND    P.estatus <> 'INACTIVO'), 0)) + 
										(IFNULL((SELECT SUM(PAD.precio + PAD.iva + PAD.ieps) 
												 FROM   polizas_abono_02 PA INNER JOIN polizas_abono_detalles_02 PAD ON PA.poliza_abono_id = PAD.poliza_abono_id  
												 WHERE  PAD.referencia = 'SERVICIO' 
												 AND    PAD.referencia_id = FS.factura_servicio_id 
												 AND    DATE_FORMAT(PA.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
												 AND    PA.estatus <> 'INACTIVO'), 0)) + 
										(IFNULL((SELECT SUM(RID.precio + RID.iva + RID.ieps) 
												 FROM   recibos_ingreso RI INNER JOIN recibos_ingreso_detalles RID 
												        ON RI.recibo_ingreso_id = RID.recibo_ingreso_id 
												 WHERE  RID.referencia = 'SERVICIO' 
												 AND    RID.referencia_id = FS.factura_servicio_id 
												 AND    DATE_FORMAT(RI.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
												 AND    RI.estatus <> 'INACTIVO'), 0)) + 
										(IFNULL((SELECT SUM(NCDD.precio + NCDD.iva + NCDD.ieps) 
												 FROM   notas_credito_digitales NCD INNER JOIN notas_credito_digitales_detalles NCDD 
												        ON NCD.nota_credito_digital_id = NCDD.nota_credito_digital_id  
												 WHERE  NCDD.referencia = 'SERVICIO' 
												 AND    NCDD.referencia_id = FS.factura_servicio_id 
												 AND    DATE_FORMAT(NCD.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
												 AND    NCD.estatus <> 'INACTIVO'), 0))) AS AbonoTotal, 
									   ((IFNULL((SELECT SUM(PDR.imp_pagado) 
										         FROM   pagos P INNER JOIN pagos_detalles_relacionados_02 PDR ON PDR.pago_id = P.pago_id 
										         WHERE  PDR.tipo_referencia = 'SERVICIO' 
												 AND    PDR.referencia_id = FS.factura_servicio_id 
												 AND    DATE_FORMAT(P.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
												 AND    DATE_FORMAT(P.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
										         AND    P.estatus <> 'INACTIVO'), 0)) + 
										(IFNULL((SELECT SUM(PAD.precio + PAD.iva + PAD.ieps) 
												 FROM   polizas_abono_02 PA INNER JOIN polizas_abono_detalles_02 PAD ON PA.poliza_abono_id = PAD.poliza_abono_id  
												 WHERE  PAD.referencia = 'SERVICIO' 
												 AND    PAD.referencia_id = FS.factura_servicio_id 
												 AND    DATE_FORMAT(PA.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
												 AND    DATE_FORMAT(PA.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
												 AND    PA.estatus <> 'INACTIVO'), 0)) + 
										(IFNULL((SELECT SUM(RID.precio + RID.iva + RID.ieps) 
												 FROM   recibos_ingreso RI INNER JOIN recibos_ingreso_detalles RID 
												        ON RI.recibo_ingreso_id = RID.recibo_ingreso_id 
												 WHERE  RID.referencia = 'SERVICIO' 
												 AND    RID.referencia_id = FS.factura_servicio_id 
												 AND    DATE_FORMAT(RI.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
												 AND    DATE_FORMAT(RI.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
												 AND    RI.estatus <> 'INACTIVO'), 0)) + 
										(IFNULL((SELECT SUM(NCDD.precio + NCDD.iva + NCDD.ieps) 
												 FROM   notas_credito_digitales NCD INNER JOIN notas_credito_digitales_detalles NCDD 
												        ON NCD.nota_credito_digital_id = NCDD.nota_credito_digital_id  
												 WHERE  NCDD.referencia = 'SERVICIO' 
												 AND    NCDD.referencia_id = FS.factura_servicio_id 
												 AND   DATE_FORMAT(NCD.fecha, '%Y-%m-%d') >= '$dteFechaInicial' 
												 AND   DATE_FORMAT(NCD.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
												 AND    NCD.estatus <> 'INACTIVO'), 0))) AS AbonoParcial 
								FROM   ordenes_reparacion OrdRep INNER JOIN sucursales S ON OrdRep.sucursal_id = S.sucursal_id 
								       INNER JOIN ordenes_reparacion_servicios ORS ON OrdRep.orden_reparacion_id = ORS.orden_reparacion_id 
								       INNER JOIN servicios_tipos ST ON OrdRep.servicio_tipo_id = ST.servicio_tipo_id 
								       INNER JOIN facturas_servicio FS ON OrdRep.orden_reparacion_id = FS.orden_reparacion_id 
								       INNER JOIN mecanicos M ON ORS.mecanico_id = M.mecanico_id 
								       INNER JOIN empleados E ON M.empleado_id = E.empleado_id 
								LEFT JOIN(SELECT FSMO.factura_servicio_id AS referenciaID, 
												 SUM(FSMO.precio_unitario + FSMO.iva_unitario + FSMO.ieps_unitario) AS Total 
										  FROM   facturas_servicio_mano_obra FSMO 
										  GROUP BY FSMO.factura_servicio_id) AS ManoObra ON ManoObra.referenciaID = FS.factura_servicio_id 
								LEFT JOIN(SELECT FSR.factura_servicio_id AS referenciaID, 
												 SUM(FSR.cantidad * (FSR.precio_unitario + FSR.iva_unitario + FSR.ieps_unitario)) AS Total 
										  FROM   facturas_servicio_refacciones FSR 
										  GROUP BY FSR.factura_servicio_id) AS Refacciones ON Refacciones.referenciaID = FS.factura_servicio_id 
								LEFT JOIN(SELECT FSTF.factura_servicio_id AS referenciaID, 
												 SUM(FSTF.cantidad * (FSTF.precio_unitario + FSTF.iva_unitario + FSTF.ieps_unitario)) AS Total 
										  FROM facturas_servicio_trabajos_foraneos FSTF 
										  GROUP BY FSTF.factura_servicio_id) AS Foraneos ON Foraneos.referenciaID = FS.factura_servicio_id 
								LEFT JOIN(SELECT FSO.factura_servicio_id AS referenciaID, 
												 SUM(FSO.cantidad * (FSO.precio_unitario + FSO.iva_unitario + FSO.ieps_unitario)) AS Total 
										  FROM   facturas_servicio_otros FSO 
										  GROUP BY FSO.factura_servicio_id) AS Otros ON Otros.referenciaID = FS.factura_servicio_id 
								WHERE  DATE_FORMAT(FS.fecha, '%Y-%m-%d') <= '$dteFechaFinal' 
								AND    FS.estatus <> 'INACTIVO' 
								GROUP BY OrdRep.orden_reparacion_id, M.mecanico_id, FS.factura_servicio_id";
			$queryComisiones .= " UNION ";
			$queryComisiones .= "SELECT S.sucursal_id, S.nombre AS Sucursal, M.mecanico_id, 
									           E.codigo AS CodMec, 
										       CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) AS Mecanico, 
										       OrdRep.folio AS FolioOrden, '' AS FolioFactura, 
										       DATE_FORMAT(OrdRep.fecha,'%d/%m/%Y') AS fecha, 
										       ST.descripcion AS razon_social, 
										       IFNULL(SUM(ORS.horas * ORS.precio), 0) AS Importe, ST.servicio_tipo_id, 
										       IFNULL(SUM(ORS.horas * ORS.precio), 0) AS Total, IFNULL(SUM(ORS.horas * ORS.precio), 0) AS AbonoTotal, 
										       IFNULL(SUM(ORS.horas * ORS.precio), 0) AS AbonoParcial 
										FROM   ordenes_reparacion OrdRep INNER JOIN sucursales S ON OrdRep.sucursal_id = S.sucursal_id 
										       INNER JOIN ordenes_reparacion_servicios ORS ON OrdRep.orden_reparacion_id = ORS.orden_reparacion_id 
										       INNER JOIN servicios_tipos ST ON OrdRep.servicio_tipo_id = ST.servicio_tipo_id 
										       INNER JOIN clientes C ON OrdRep.prospecto_id = C.prospecto_id 
										       INNER JOIN mecanicos M ON ORS.mecanico_id = M.mecanico_id 
										       INNER JOIN empleados E ON M.empleado_id = E.empleado_id 
										WHERE  OrdRep.fecha_finalizacion >= '$dteFechaInicial 00:00:00' 
										AND    OrdRep.fecha_finalizacion <= '$dteFechaFinal 23:59:59' 
										AND    OrdRep.estatus = 'FINALIZADO' 
										AND    ST.facturar = 'NO' 
										GROUP BY OrdRep.orden_reparacion_id, M.mecanico_id 
										ORDER BY sucursal_id, mecanico_id, FolioOrden";


		$strSQL = $this->db->query($queryComisiones);
		return $strSQL->result();

	}

	/*Método para regresar los abonos recuperados de una sucursal*/
	public function buscar_abonos_sucursal($dteFechaInicial, $dteFechaFinal, $intSucursalID)
	{
		//Abonos
		$queryAbonos = "SELECT 
						    P.pago_id AS ID, PDR.renglon, PDR.imp_pagado AS Abono
						FROM
						    (pagos P
						    INNER JOIN pagos_detalles_relacionados_02 PDR ON P.pago_id = PDR.pago_id)
						        INNER JOIN
						    cartera C ON PDR.tipo_referencia = 'CARTERA'
						        AND PDR.referencia_id = C.cartera_id
						        AND C.modulo = 'SERVICIO'
						WHERE
						    C.sucursal_id = $intSucursalID 
						        AND DATE_FORMAT(P.fecha, '%Y-%m-%d') >= '$dteFechaInicial'
						        AND DATE_FORMAT(P.fecha, '%Y-%m-%d') <= '$dteFechaFinal'
						        AND P.estatus <> 'INACTIVO'
						GROUP BY PDR.pago_id , PDR.renglon, PDR.imp_pagado";
		$queryAbonos .= " UNION "; 
		$queryAbonos .= "SELECT 
						    RID.recibo_ingreso_id AS ID,
						    RID.renglon,
						    (RID.precio + RID.iva + RID.ieps) AS Abono
						FROM
						    (recibos_ingreso RI
						    INNER JOIN recibos_ingreso_detalles RID ON RI.recibo_ingreso_id = RID.recibo_ingreso_id)
						        INNER JOIN
						    facturas_servicio FS ON RID.referencia = 'SERVICIO'
						        AND RID.referencia_id = FS.factura_servicio_id
						WHERE
						    FS.sucursal_id = $intSucursalID 
						        AND DATE_FORMAT(RI.fecha, '%Y-%m-%d') >= '$dteFechaInicial'
						        AND DATE_FORMAT(RI.fecha, '%Y-%m-%d') <= '$dteFechaFinal'
						        AND RI.estatus <> 'INACTIVO'
						GROUP BY RID.recibo_ingreso_id , RID.renglon";
		$queryAbonos .= " UNION "; 
		$queryAbonos .= "SELECT 
						    PAD.poliza_abono_id AS ID,
						    PAD.renglon,
						    (PAD.precio + PAD.iva + PAD.ieps) AS Abono
						FROM
						    (polizas_abono_02 PA
						    INNER JOIN polizas_abono_detalles_02 PAD ON PA.poliza_abono_id = PAD.poliza_abono_id)
						        INNER JOIN
						    facturas_servicio FS ON PAD.referencia = 'SERVICIO'
						        AND PAD.referencia_id = FS.factura_servicio_id
						WHERE
						    FS.sucursal_id = $intSucursalID 
						        AND DATE_FORMAT(PA.fecha, '%Y-%m-%d') >= '$dteFechaInicial'
						        AND DATE_FORMAT(PA.fecha, '%Y-%m-%d') <= '$dteFechaFinal'
						        AND PA.estatus <> 'INACTIVO'
						GROUP BY PAD.poliza_abono_id , PAD.renglon
						ORDER BY ID , renglon";

		$strSQL = $this->db->query($queryAbonos);
		return $strSQL->result();

	}



	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intProspectoID = NULL, 
						   $strEstatus, $strBusqueda = NULL,$intNumRows, $intPos)
	{
		//Variable que se utiliza para asignar las referencias de la póliza
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strProcesoPoliza = $this->db->escape('ORDEN DE TRABAJO');

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('OREP.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
	    if($intProspectoID  != NULL)
	    {
	   		$this->db->where('OREP.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	
	   		$this->db->where("(DATE_FORMAT(OREP.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where('OREP.estatus','FINALIZADO');
				$this->db->where('ST.facturar','NO');
			}
			else
			{
				$this->db->where('OREP.estatus', $strEstatus);
			}
		}

		$this->db->where("((OREP.folio LIKE '%$strBusqueda%') OR
							(C.razon_social LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))"); 
		
		$this->db->from('ordenes_reparacion AS OREP');
		$this->db->join('servicios_tipos AS ST', 'OREP.servicio_tipo_id = ST.servicio_tipo_id', 'inner');
	    $this->db->join('equipos_tipos AS ET', 'OREP.equipo_tipo_id = ET.equipo_tipo_id', 'inner');
	    $this->db->join('maquinaria_descripciones AS MD', 'OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id', 'inner');
	    $this->db->join('prospectos AS P', 'OREP.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('polizas AS PF', 'OREP.orden_reparacion_id = PF.referencia_id
	    							      AND PF.proceso = '.$strProcesoPoliza.' 
	    							      AND PF.modulo = "SERVICIO"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("OREP.orden_reparacion_id, OREP.folio, 
						   DATE_FORMAT(OREP.fecha,'%d/%m/%Y') AS fecha, 
						   OREP.serie,  OREP.estatus, 
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' THEN C.razon_social
								    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   END AS prospecto,
						   (SELECT COUNT(ORS.renglon)
							FROM ordenes_reparacion_servicios AS ORS
						    WHERE ORS.orden_reparacion_id = OREP.orden_reparacion_id
							AND ORS.estatus <> 'FINALIZADO') AS total_serviciosNofinalizados, 
							ST.facturar AS facturar_servicio_tipo, 
							IFNULL((SELECT COUNT(RR.requisicion_refacciones_id)
						    		FROM requisiciones_refacciones AS RR
						    		WHERE RR.orden_reparacion_id = OREP.orden_reparacion_id
						    		AND (RR.estatus = 'ACTIVO' OR
						    			 RR.estatus = 'PARCIALMENTE SURTIDO')), 0) AS total_requisiciones, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						    PF.folio AS folio_poliza ", FALSE);
		$this->db->from('ordenes_reparacion AS OREP');
		$this->db->join('servicios_tipos AS ST', 'OREP.servicio_tipo_id = ST.servicio_tipo_id', 'inner');
	    $this->db->join('equipos_tipos AS ET', 'OREP.equipo_tipo_id = ET.equipo_tipo_id', 'inner');
	    $this->db->join('maquinaria_descripciones AS MD', 'OREP.maquinaria_descripcion_id = MD.maquinaria_descripcion_id', 'inner');
	    $this->db->join('prospectos AS P', 'OREP.prospecto_id = P.prospecto_id', 'inner');
	    $this->db->join('localidades AS L', 'P.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS MP', 'L.municipio_id = MP.municipio_id', 'inner');
		$this->db->join('sat_estados AS EP', 'MP.estado_id = EP.estado_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
		$this->db->join('polizas AS PF', 'OREP.orden_reparacion_id = PF.referencia_id
	    							      AND PF.proceso = '.$strProcesoPoliza.' 
	    							      AND PF.modulo = "SERVICIO"', 'left');

		$this->db->where('OREP.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id del prospecto
	    if($intProspectoID  != NULL)
	    {
	   		$this->db->where('OREP.prospecto_id', $intProspectoID);
	    }
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	
	   		$this->db->where("(DATE_FORMAT(OREP.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	   //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where('OREP.estatus','FINALIZADO');
				$this->db->where('ST.facturar','NO');
			}
			else
			{
				$this->db->where('OREP.estatus', $strEstatus);
			}
		}

		$this->db->where("((OREP.folio LIKE '%$strBusqueda%') OR
							(C.razon_social LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', P.codigo, P.nombre_comercial) LIKE '%$strBusqueda%'))"); 
		$this->db->order_by('OREP.folio', 'DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["ordenes"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strEstatus, $intProspectoID = NULL)
	{
		$this->db->select(" OREP.orden_reparacion_id, OREP.folio, OREP.tipo_reparacion, 
						   CASE 
							   WHEN  C.estatus = 'ACTIVO' THEN C.razon_social
								    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
						   END AS prospecto,
						   C.servicio_lista_precio_id, 
						   IFNULL(ST.porcentaje_trabajos_foraneos,0) AS porcentaje_trabajos_foraneos, 
						   CASE 
							   WHEN  C.regimen_fiscal_id > 0 
							   		THEN C.regimen_fiscal_id		
							   ELSE 0
						    END regimen_fiscal_id", FALSE);
        $this->db->from('ordenes_reparacion AS OREP');
		$this->db->join('prospectos AS P', 'OREP.prospecto_id = P.prospecto_id', 'inner');
		$this->db->join('servicios_tipos AS ST', 'OREP.servicio_tipo_id = ST.servicio_tipo_id', 'inner');
		$this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
	  	$this->db->where('OREP.sucursal_id', $this->session->userdata('sucursal_id'));
	  	
	  	//Si existe id del prospecto
	  	if($intProspectoID > 0)
	  	{
	  		$this->db->where('OREP.prospecto_id', $intProspectoID);
	  	}

	  	//Si el estatus es FINALIZADO, significa que el autocomplete se esta mostrando en factura de servicios
	  	if($strEstatus == 'FINALIZADO')
	  	{
	  		//Regresar ordenes de raparación que se encuentren Finalizadas y que se puedan facturar
	  		$this->db->where('ST.facturar', 'SI');
	  		$this->db->where('OREP.estatus', $strEstatus); 
	  	}
	  	else
	  	{
	  		$this->db->where('OREP.estatus', $strEstatus);
	  	}
        $this->db->where("(OREP.folio LIKE '%$strDescripcion%')");  
        $this->db->order_by("OREP.folio",'DESC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}


	//Método para regresar los detalles de un registro (se utiliza para generar póliza)
	public function buscar_detalles_poliza($intOrdenReparacionID)
	{
		//Constante para identificar al tipo de movimiento entrada de refacciones por devolución del taller
		$intMovEntradaDevolucion = ENTRADA_REFACCIONES_DEVOLUCION_TALLER;
		//Constante para identificar al tipo de movimiento salida de refacciones por taller
		$intMovSalidaTaller = SALIDA_REFACCIONES_TALLER;

		//Formar consulta
		$queryDetalles ="SELECT orden_reparacion_id AS ID, 'MANO OBRA' AS Tipo, 	   
							    SUM(horas * costo) AS Costo 
						FROM   ordenes_reparacion_servicios
						WHERE  orden_reparacion_id = $intOrdenReparacionID
						GROUP BY orden_reparacion_id";
		$queryDetalles.=" UNION ";
		//Decrementar las devoluciones de las refacciones
		$queryDetalles.="SELECT RR.orden_reparacion_id AS ID, 'REFACCIONES' AS Tipo, 
							   SUM((MRD.cantidad -
							        (SELECT IFNULL(SUM(MRDE.cantidad), 0)
									 FROM movimientos_refacciones_detalles AS MRDE
									 INNER JOIN movimientos_refacciones AS MRE ON MRDE.movimiento_refacciones_id = MRE.movimiento_refacciones_id
									 WHERE MRE.tipo_movimiento = $intMovEntradaDevolucion
									 AND MRE.referencia_id = MR.movimiento_refacciones_id
									 AND MRE.estatus = 'ACTIVO'
									 AND MRDE.refaccion_id = MRD.refaccion_id)) * MRD.costo_unitario) AS Costo 
						 FROM   requisiciones_refacciones AS RR INNER JOIN movimientos_refacciones AS MR 
								ON RR.requisicion_refacciones_id = MR.referencia_id 
								AND MR.tipo_movimiento = $intMovSalidaTaller 
						 INNER JOIN movimientos_refacciones_detalles AS MRD
							   ON MR.movimiento_refacciones_id = MRD.movimiento_refacciones_id 
						 WHERE  RR.orden_reparacion_id = $intOrdenReparacionID
						 AND    RR.estatus <> 'INACTIVO'
						 AND    MR.estatus <> 'INACTIVO'
						 GROUP BY RR.orden_reparacion_id";
		$queryDetalles.=" UNION ";
		$queryDetalles.="SELECT TF.orden_reparacion_id AS ID, 'FORANEOS' AS Tipo, 
					    	    SUM(TFD.cantidad * (TFD.costo_unitario + TFD.ieps_unitario)) AS Costo
						 FROM trabajos_foraneos_02 AS TF INNER JOIN trabajos_foraneos_detalles AS TFD
							   ON TF.trabajo_foraneo_id = TFD.trabajo_foraneo_id 
						 WHERE  TF.orden_reparacion_id = $intOrdenReparacionID
					     AND    TF.estatus <> 'INACTIVO'
						 GROUP BY TF.orden_reparacion_id
						 ORDER BY Tipo";

	    //Ejecutar consulta
		$strSQL = $this->db->query($queryDetalles);
		return $strSQL->result();
	}

    /*******************************************************************************************************************
	Funciones de la tabla ordenes_reparacion_servicios
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_servicios(stdClass $objServicioMO)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Asignar renglón consecutivo del servicio
		$intRenglon = $this->get_renglon_consecutivo_servicios($objServicioMO->intOrdenReparacionID);
		//Variable que se utiliza para asignar la fecha de creación
		$dteFechaCreacion = date("Y-m-d H:i:s");
	
		//Tabla ordenes_reparacion_servicios
		//Asignar datos al array
		$arrDatos = array('orden_reparacion_id' => $objServicioMO->intOrdenReparacionID,
						  'renglon' => $intRenglon, 
						  'servicio_id' => $objServicioMO->intServicioID,
						  'horas' => $objServicioMO->intHoras,
						  'precio' => $objServicioMO->intPrecio,
						  'costo' => $objServicioMO->intCosto,
						  'mecanico_id' => $objServicioMO->intMecanicoID,
						  'fecha_creacion' => $dteFechaCreacion,
						  'usuario_creacion' => $objServicioMO->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('ordenes_reparacion_servicios', $arrDatos);

		//Hacer un llamado al método para guardar el tiempo del servicio
		$this->guardar_servicios_tiempos($objServicioMO->intOrdenReparacionID, $intRenglon, 
										 $dteFechaCreacion, $objServicioMO->intUsuarioID);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_servicios(stdClass $objServicioMO)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Asignar datos al array
		$arrDatos = array('horas' => $objServicioMO->intHoras, 
						  'precio' => $objServicioMO->intPrecio, 
						  'costo' => $objServicioMO->intCosto,
						  'mecanico_id' => $objServicioMO->intMecanicoID, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objServicioMO->intUsuarioID);
		$this->db->where('orden_reparacion_id', $objServicioMO->intOrdenReparacionID);
		$this->db->where('renglon', $objServicioMO->intRenglon);
		$this->db->limit(1);
		//Actualizar los datos del registro
	    $this->db->update('ordenes_reparacion_servicios', $arrDatos);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	 //Método para modificar el estatus de un registro
	public function set_estatus_servicios($intOrdenReparacionID, $intRenglon)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		
		//Variable que se utiliza para asignar la fecha de creación
		$dteFechaModificacion = date("Y-m-d H:i:s");
		//Variable que se utiliza para asignar el id del usuario logeado en el sistema
		$intUsuarioID = $this->session->userdata('usuario_id');

		//Asignar datos al array
		$arrDatos = array('estatus' => 'ACTIVO',
						  'fecha_actualizacion' => $dteFechaModificacion,
						  'usuario_actualizacion' => $intUsuarioID,
						  'fecha_eliminacion' => NULL,
						  'usuario_eliminacion' => NULL);
		$this->db->where('orden_reparacion_id', $intOrdenReparacionID);
		$this->db->where('renglon', $intRenglon);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('ordenes_reparacion_servicios', $arrDatos);

		//Hacer un llamado al método para guardar el tiempo del servicio
		$this->guardar_servicios_tiempos($intOrdenReparacionID, $intRenglon, $dteFechaModificacion, $intUsuarioID);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_servicios($intOrdenReparacionID, $intRenglon = NULL, $strEstatus = NULL)
	{
		$this->db->select("ORS.renglon, ORS.servicio_id, ORS.horas, ORS.precio, ORS.costo, 
						   ORS.mecanico_id, ORS.estatus, S.codigo, S.descripcion, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS mecanico, 
						   TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps, 
						   S.tasa_cuota_iva, S.tasa_cuota_ieps, 
						   PS.codigo AS codigo_sat,  U.codigo AS unidad_sat,
						  OImp.codigo AS  objeto_impuesto_sat", FALSE);
		$this->db->from('ordenes_reparacion_servicios AS ORS');
		$this->db->join('mecanicos AS M', 'ORS.mecanico_id = M.mecanico_id', 'inner');
		$this->db->join('empleados AS E', 'M.empleado_id = E.empleado_id', 'inner');
		$this->db->join('servicios AS S', 'ORS.servicio_id = S.servicio_id', 'inner');
		$this->db->join('sat_productos_servicios AS PS', 'S.producto_servicio_id = PS.producto_servicio_id', 'inner');
		$this->db->join('sat_unidades AS U', 'S.unidad_id = U.unidad_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'S.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'S.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('sat_objeto_impuesto AS OImp', 'S.objeto_impuesto_id = OImp.objeto_impuesto_id', 'left');
		$this->db->where('ORS.orden_reparacion_id', $intOrdenReparacionID);
		//Si existe id del renglón
		if ($intRenglon !== NULL)
		{ 
			$this->db->where('ORS.renglon', $intRenglon);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{	
			//Si existe estatus
			if($strEstatus !== NULL)
			{
				$this->db->where('ORS.estatus', $strEstatus);
			}
			$this->db->order_by('ORS.renglon', 'ASC');
			return $this->db->get()->result();
		}

	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_servicios($intOrdenReparacionID, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('ORS.orden_reparacion_id', $intOrdenReparacionID);
		$this->db->from('ordenes_reparacion_servicios AS ORS');
		$this->db->join('servicios AS S', 'ORS.servicio_id = S.servicio_id', 'inner');
	    $this->db->join('mecanicos AS M', 'ORS.mecanico_id = M.mecanico_id', 'inner');
	    $this->db->join('empleados AS E', 'M.empleado_id = E.empleado_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar el número de registros activos que coincidan con los criterios de búsqueda
		$this->db->where('ORS.orden_reparacion_id', $intOrdenReparacionID);
		$this->db->where('ORS.estatus', 'ACTIVO');
		$this->db->from('ordenes_reparacion_servicios AS ORS');
		$this->db->join('servicios AS S', 'ORS.servicio_id = S.servicio_id', 'inner');
	    $this->db->join('mecanicos AS M', 'ORS.mecanico_id = M.mecanico_id', 'inner');
	    $this->db->join('empleados AS E', 'M.empleado_id = E.empleado_id', 'inner');
		$arrResultado["total_servicios_activos"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("ORS.renglon, FORMAT(ORS.horas,2) AS horas, FORMAT(ORS.precio,2) AS precio, 
						  ORS.estatus, S.codigo, S.descripcion,
						  CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS mecanico", FALSE);
		$this->db->from('ordenes_reparacion_servicios AS ORS');
		$this->db->join('servicios AS S', 'ORS.servicio_id = S.servicio_id', 'inner');
	    $this->db->join('mecanicos AS M', 'ORS.mecanico_id = M.mecanico_id', 'inner');
	    $this->db->join('empleados AS E', 'M.empleado_id = E.empleado_id', 'inner');
	    $this->db->where('ORS.orden_reparacion_id', $intOrdenReparacionID);
		$this->db->order_by('ORS.renglon', 'ASC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["servicios"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Función que se utiliza para regresar el renglón consecutivo 
	public function get_renglon_consecutivo_servicios($intOrdenReparacionID)
	{
		//Variable que se utiliza para asignar el id del renglón 
	  	$intRenglon = 0;
	    //Seleccionar el renglón máximo que coincide con el id de la orden de reparación
		//en la tabla ordenes_reparacion_servicios
	    $this->db->select('MAX(renglon) AS renglon');
		$this->db->from('ordenes_reparacion_servicios');
		$this->db->where('orden_reparacion_id', $intOrdenReparacionID);
		$this->db->limit(1);
		//Si existen datos
		if ($row = $this->db->get()->row())
		{
			//Asignar valor del renglon
		    $intRenglon = $row->renglon;
			//si devuelve nulo asignar el valor de 1
			if($intRenglon=='null')
		    {
		    	$intRenglon = 1;
		    }
		    else
		    {
		    	//Incrementar el valor del renglon a 1
		    	$intRenglon = ($intRenglon + 1);

		    }
		}
		//Regresar renglón consecutivo
		return $intRenglon;
	}

	/*******************************************************************************************************************
	Funciones de la tabla ordenes_reparacion_servicios_tiempos
	*********************************************************************************************************************/
   	//Método para guardar un registro nuevo
	public function guardar_servicios_tiempos($intOrdenReparacionID, $intRenglon, $dteFechaCreacion, $intUsuarioID)
	{
		//Asignar datos al array
		$arrDatos = array('orden_reparacion_id' => $intOrdenReparacionID,
						  'renglon' => $intRenglon, 
						  'fecha_inicio' => $dteFechaCreacion,
						  'usuario_inicio' => $intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('ordenes_reparacion_servicios_tiempos', $arrDatos);
	}


	//Método para modificar los datos de un registro previamente guardado
	public function modificar_servicios_tiempos(stdClass $objServicioT)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Constante para identificar el ID del primer motivo de suspensión
        $intMotivoSuspensionBase = MOTIVO_SUSPENSION_BASE;
        //Variable que se utiliza para asignar la fecha de modificación
		$dteFechaModificacion = date("Y-m-d H:i:s");
		//Variable que se utiliza para asignar el estatus del servicio
		$strEstatusServicio = 'SUSPENDIDO';

		//Si el id del motivo de suspensión corresponde al FINALIZADO
		if($objServicioT->intMotivoSuspensionID == $intMotivoSuspensionBase)
		{
			//Cambiar el estatus del servio a FINALIZADO
			$strEstatusServicio = 'FINALIZADO';
		}
		
		//Tabla ordenes_reparacion_servicios
		//Si el estatus del registro es FINALIZADO
		if($strEstatusServicio == 'FINALIZADO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatusServicio,
							  'fecha_finalizacion' => $dteFechaModificacion,
							  'usuario_finalizacion' => $objServicioT->intUsuarioID);
		}
		else
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatusServicio,
							  'fecha_eliminacion' => $dteFechaModificacion,
							  'usuario_eliminacion' => $objServicioT->intUsuarioID);
		}
		$this->db->where('orden_reparacion_id', $objServicioT->intOrdenReparacionID);
		$this->db->where('renglon', $objServicioT->intRenglon);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('ordenes_reparacion_servicios', $arrDatos);

		//Tabla ordenes_reparacion_servicios_tiempos
		//Asignar datos al array
		$arrDatos = array('fecha_suspension' => $dteFechaModificacion,
						  'usuario_suspension' => $objServicioT->intUsuarioID,
						  'motivo_suspension_id' => $objServicioT->intMotivoSuspensionID);
		$this->db->where('orden_reparacion_tiempo_id', $objServicioT->intOrdenReparacionTiempoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('ordenes_reparacion_servicios_tiempos', $arrDatos);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar el registro que coincida con el criterio de búsqueda proporcionado
	public function buscar_servicios_tiempos($intOrdenReparacionTiempoID)
	{
		$this->db->select("ORST.orden_reparacion_tiempo_id, ORST.renglon, 
						   DATE_FORMAT(ORST.fecha_inicio,'%d/%m/%Y %h:%i:%s %p') AS fecha_inicio, 
						   IFNULL(DATE_FORMAT(ORST.fecha_suspension,'%d/%m/%Y %h:%i:%s %p'), '') AS fecha_suspension,
						   CASE 
						   	  WHEN ORST.fecha_suspension IS NULL
				            	THEN ''
				            	ELSE TIMEDIFF(ORST.fecha_suspension,ORST.fecha_inicio) 
				             END AS tiempo,
						   ORS.estatus, MS.descripcion AS motivo_suspension, 
						   UI.usuario AS usuario_inicio,   US.usuario AS usuario_suspension", FALSE);
		$this->db->from('ordenes_reparacion_servicios_tiempos AS ORST');
		$this->db->join('ordenes_reparacion_servicios AS ORS', 'ORST.orden_reparacion_id = ORS.orden_reparacion_id 
						 AND ORST.renglon = ORS.renglon', 'inner');
		$this->db->join('motivos_suspension AS MS', 'ORST.motivo_suspension_id = MS.motivo_suspension_id', 'left');
	    $this->db->join('usuarios AS UI', 'ORST.usuario_inicio = UI.usuario_id', 'left');
		$this->db->join('usuarios AS US', 'ORST.usuario_suspension = US.usuario_id', 'left');
		$this->db->where('ORST.orden_reparacion_tiempo_id', $intOrdenReparacionTiempoID);
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_servicios_tiempos($intOrdenReparacionID, $intServicioID, $intRenglon, $intNumRows, $intPos)
	{
		//Constante para identificar el ID del primer motivo de suspensión
        $intMotivoSuspensionBase = MOTIVO_SUSPENSION_BASE;

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('ORST.orden_reparacion_id', $intOrdenReparacionID);
		$this->db->where('ORS.servicio_id', $intServicioID);
		$this->db->where('ORS.renglon', $intRenglon);
		$this->db->from('ordenes_reparacion_servicios_tiempos AS ORST');
		$this->db->join('ordenes_reparacion_servicios AS ORS', 'ORST.orden_reparacion_id = ORS.orden_reparacion_id
			            AND ORST.renglon = ORS.renglon', 'inner');
		$this->db->join('motivos_suspension AS MS', 'ORST.motivo_suspension_id = MS.motivo_suspension_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();


		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("ORST.orden_reparacion_tiempo_id, 
						   DATE_FORMAT(ORST.fecha_inicio,'%d/%m/%Y %h:%i:%s %p') AS fecha_inicio, 
						   IFNULL(DATE_FORMAT(ORST.fecha_suspension,'%d/%m/%Y %h:%i:%s %p'), '') AS fecha_suspension, 
						   CASE 
						   	 WHEN ORST.fecha_suspension IS NULL
				               THEN ''
				               ELSE TIMEDIFF(ORST.fecha_suspension,ORST.fecha_inicio) 
				              END AS tiempo,
				            MS.descripcion AS motivo_suspension, 
				            CASE 
							  WHEN ORST.motivo_suspension_id IS NULL
							  	THEN 'ACTIVO'
							    WHEN ORST.motivo_suspension_id = $intMotivoSuspensionBase 
							  	THEN  'FINALIZADO'
							  	ELSE 'SUSPENDIDO'
							  END AS estatus ", FALSE);
		$this->db->from('ordenes_reparacion_servicios_tiempos AS ORST');
		$this->db->join('ordenes_reparacion_servicios AS ORS', 'ORST.orden_reparacion_id = ORS.orden_reparacion_id 
						 AND ORST.renglon = ORS.renglon', 'inner');
		$this->db->join('motivos_suspension AS MS', 'ORST.motivo_suspension_id = MS.motivo_suspension_id', 'left');
	    $this->db->where('ORST.orden_reparacion_id', $intOrdenReparacionID);
		$this->db->where('ORS.servicio_id', $intServicioID);
		$this->db->where('ORS.renglon', $intRenglon);
		$this->db->order_by('ORST.fecha_inicio', 'DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["tiempos"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*******************************************************************************************************************
	Funciones de la tabla ordenes_reparacion_otros
	*********************************************************************************************************************/
	//Función que se utiliza para guardar otros servicios de la orden de reparación
	public function guardar_otros(stdClass $objOrdenReparacion)
	{
		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener otros servicios de la orden de reparación
		foreach ($objOrdenReparacion->arrOtros as $arrDets)
		{
			//Hacer recorrido para obtener los datos del detalle (otro servicio)
			foreach ($arrDets as $arrDet)
			{
				//Incrementar renglón consecutivo
				$intRenglon++;

				//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
				$intTasaCuotaIeps = (($arrDet->intTasaCuotaIeps !== '') ? 
						   	  	 	  $arrDet->intTasaCuotaIeps : NULL);

				//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
				//Asignar datos al array
				$arrDatos = array('orden_reparacion_id' => $objOrdenReparacion->intOrdenReparacionID,
								  'renglon' => $intRenglon,
								  'concepto' => mb_strtoupper($arrDet->strConcepto),
								  'producto_servicio_id' => $arrDet->intProductoServicioID,
								  'unidad_id' => $arrDet->intUnidadID,
								  'objeto_impuesto_id' => $arrDet->intObjetoImpuestoID, 
								  'cantidad' => $arrDet->intCantidad,
								  'precio_unitario' => $arrDet->intPrecioUnitario,
								  'descuento_unitario' => $arrDet->intDescuentoUnitario,
								  'tasa_cuota_iva' => $arrDet->intTasaCuotaIva,
								  'iva_unitario' =>  $arrDet->intIvaUnitario,
								  'tasa_cuota_ieps' => $intTasaCuotaIeps,
								  'ieps_unitario' => $arrDet->intIepsUnitario);
				//Guardar los datos del registro
				$this->db->insert('ordenes_reparacion_otros', $arrDatos);

			}
		}
	}

	//Método para regresar los otros servicios de un registro
	public function buscar_otros($intOrdenReparacionID)
	{

		$this->db->select("ORO.renglon, ORO.concepto, ORO.producto_servicio_id, ORO.unidad_id, 
						   ORO.objeto_impuesto_id, ORO.cantidad, ORO.precio_unitario, ORO.descuento_unitario, 
						   ORO.tasa_cuota_iva, ORO.iva_unitario, ORO.tasa_cuota_ieps, 
						   ORO.ieps_unitario, TIva.valor_maximo AS porcentaje_iva, 
						   TIeps.valor_maximo AS porcentaje_ieps, 
						   CONCAT_WS(' - ', PS.codigo, PS.descripcion) AS producto_servicio, 
						   PS.codigo AS codigo_sat,
						   CONCAT_WS(' - ', U.codigo, U.nombre) AS unidad, 
						   U.codigo AS unidad_sat, 
						   CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto, 
						   OImp.codigo AS objeto_impuesto_sat, ", FALSE);
		$this->db->from('ordenes_reparacion_otros AS ORO');
		$this->db->join('sat_productos_servicios AS PS', 'ORO.producto_servicio_id = PS.producto_servicio_id', 'inner');
		$this->db->join('sat_unidades AS U', 'ORO.unidad_id = U.unidad_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'ORO.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIeps', 'ORO.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('sat_objeto_impuesto AS OImp', 'ORO.objeto_impuesto_id = OImp.objeto_impuesto_id', 'left');
		$this->db->where('ORO.orden_reparacion_id', $intOrdenReparacionID);
		$this->db->order_by('ORO.renglon', 'ASC');
		return $this->db->get()->result();
	}
}
?>