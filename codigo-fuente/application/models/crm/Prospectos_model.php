<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de mensajes (para guardar el mensaje que se envía a los usuarios)
include_once(APPPATH . 'models/administracion/Mensajes_model.php');

class Prospectos_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla prospectos
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objProspecto)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla prospectos
		//Asignar código consecutivo
		$strCodigo = $this->get_codigo_consecutivo();

		//Asignar datos al array
		$arrDatos = array('codigo' => $strCodigo, 
						  'nombre_comercial' => $objProspecto->strNombreComercial, 
						  'telefono_principal' => $objProspecto->strTelefonoPrincipal,
						  'telefono_secundario' => $objProspecto->strTelefonoSecundario,
						  'correo_electronico' => $objProspecto->strCorreoElectronico,
						  'pagina_web' => $objProspecto->strPaginaWeb,
						  'calle' => $objProspecto->strCalle,
						  'numero_exterior' => $objProspecto->strNumeroExterior,
						  'numero_interior' => $objProspecto->strNumeroInterior,
						  'colonia' => $objProspecto->strColonia,
						  'referencia' => $objProspecto->strReferencia,
						  'codigo_postal_id' => $objProspecto->intCodigoPostalID,
						  'localidad_id' => $objProspecto->intLocalidadID,
						  'contacto_nombre' => $objProspecto->strContactoNombre,
						  'contacto_fecha_nacimiento' => $objProspecto->dteContactoFechaNacimiento,
						  'contacto_telefono' => $objProspecto->strContactoTelefono,
						  'contacto_extension' => $objProspecto->strContactoExtension,
						  'contacto_celular' => $objProspecto->strContactoCelular,
						  'contacto_correo_electronico' => $objProspecto->strContactoCorreoElectronico,
						  'contacto_hobbies' => $objProspecto->strContactoHobbies,
						  'importante' => $objProspecto->strImportante,
						  'hectareas_temporal' => $objProspecto->intHectareasTemporal,
						  'hectareas_riego' => $objProspecto->intHectareasRiego,
						  'hectareas_otras' => $objProspecto->intHectareasOtras,
						  'terreno_arenoso' => $objProspecto->intTerrenoArenoso,
						  'terreno_arcilloso' => $objProspecto->intTerrenoArcilloso,
						  'terreno_compacto' => $objProspecto->intTerrenoCompacto,
						  'terreno_pedregoso' => $objProspecto->intTerrenoPedregoso,
						  'terreno_otros' => $objProspecto->intTerrenoOtros, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objProspecto->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('prospectos', $arrDatos);
		//Agregar id del nuevo registro al objeto
		$objProspecto->intProspectoID = $this->db->insert_id();

		//Hacer un llamado al método para guardar el inventario del prospecto
		$this->guardar_inventario($objProspecto);

		//Hacer un llamado al método para guardar las actividades del prospecto
		$this->guardar_actividades($objProspecto);

		//Hacer un llamado al método para guardar los cultivos del prospecto
		$this->guardar_cultivos($objProspecto);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objProspecto->intProspectoID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objProspecto)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla prospectos
		//Asignar datos al array
		$arrDatos = array('nombre_comercial' => $objProspecto->strNombreComercial, 
						  'telefono_principal' => $objProspecto->strTelefonoPrincipal,
						  'telefono_secundario' => $objProspecto->strTelefonoSecundario,
						  'correo_electronico' => $objProspecto->strCorreoElectronico,
						  'pagina_web' => $objProspecto->strPaginaWeb,
						  'calle' => $objProspecto->strCalle,
						  'numero_exterior' => $objProspecto->strNumeroExterior,
						  'numero_interior' => $objProspecto->strNumeroInterior,
						  'colonia' => $objProspecto->strColonia,
						  'referencia' => $objProspecto->strReferencia,
						  'codigo_postal_id' => $objProspecto->intCodigoPostalID,
						  'localidad_id' => $objProspecto->intLocalidadID,
						  'contacto_nombre' => $objProspecto->strContactoNombre,
						  'contacto_fecha_nacimiento' => $objProspecto->dteContactoFechaNacimiento,
						  'contacto_telefono' => $objProspecto->strContactoTelefono,
						  'contacto_extension' => $objProspecto->strContactoExtension,
						  'contacto_celular' => $objProspecto->strContactoCelular,
						  'contacto_correo_electronico' => $objProspecto->strContactoCorreoElectronico,
						  'contacto_hobbies' => $objProspecto->strContactoHobbies,
						  'importante' => $objProspecto->strImportante,
						  'hectareas_temporal' => $objProspecto->intHectareasTemporal,
						  'hectareas_riego' => $objProspecto->intHectareasRiego,
						  'hectareas_otras' => $objProspecto->intHectareasOtras,
						  'terreno_arenoso' => $objProspecto->intTerrenoArenoso,
						  'terreno_arcilloso' => $objProspecto->intTerrenoArcilloso,
						  'terreno_compacto' => $objProspecto->intTerrenoCompacto,
						  'terreno_pedregoso' => $objProspecto->intTerrenoPedregoso,
						  'terreno_otros' => $objProspecto->intTerrenoOtros, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objProspecto->intUsuarioID);
		$this->db->where('prospecto_id', $objProspecto->intProspectoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('prospectos', $arrDatos);

		//Eliminar el inventario guardado
		$this->db->where('prospecto_id', $objProspecto->intProspectoID);
		$this->db->delete('prospectos_inventario');
		//Hacer un llamado al método para guardar el inventario del prospecto
		$this->guardar_inventario($objProspecto);

		//Eliminar las actividades guardadas
		$this->db->where('prospecto_id', $objProspecto->intProspectoID);
		$this->db->delete('prospectos_actividades');
		//Hacer un llamado al método para guardar las actividades del prospecto
		$this->guardar_actividades($objProspecto);

		//Eliminar los cultivos guardados
		$this->db->where('prospecto_id', $objProspecto->intProspectoID);
		$this->db->delete('prospectos_cultivos');
		//Hacer un llamado al método para guardar los cultivos del prospecto
		$this->guardar_cultivos($objProspecto);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intProspectoID, $strEstatus)
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
		$this->db->where('prospecto_id', $intProspectoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('prospectos', $arrDatos);
	}

	//Método para enviar a validación los datos de un registro
	public function set_validacion($intProspectoID, $strEstatusCliente, $strUsuarios, $strMensaje)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (Mensajes) 
        $otdModelMensajes = new  Mensajes_model();

		//Tabla prospectos
		//Asignar datos al array
		$arrDatos = array('fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('prospecto_id', $intProspectoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('prospectos', $arrDatos);

		//Seleccionar los datos a validar
		$this->db->select("PP.nombre_comercial, PP.telefono_principal, PP.telefono_secundario,
						   PP.correo_electronico, PP.calle, PP.numero_exterior,PP.numero_interior, 
						   PP.codigo_postal_id AS codigo_postal_id,
						   PP.colonia, L.descripcion AS localidad, PP.referencia, M.municipio_id, PP.contacto_nombre,
						   PP.contacto_telefono, PP.contacto_extension, PP.contacto_celular, 
						   PP.contacto_correo_electronico", FALSE);
		$this->db->from('prospectos AS PP');
		$this->db->join('localidades AS L', 'PP.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS M', 'L.municipio_id = M.municipio_id', 'inner');
		$this->db->where('PP.prospecto_id', $intProspectoID);
		$this->db->limit(1);
		//Hacer recorrido para insertar o actualizar los datos en la tabla clientes
		if ($row = $this->db->get()->row())
		{
			//Tabla clientes
			//Asignar datos al array
			$arrDatos = array('nombre_comercial' => $row->nombre_comercial, 
							  'telefono_principal' => $row->telefono_principal, 
							  'telefono_secundario' => $row->telefono_secundario, 
							  'correo_electronico' => $row->correo_electronico, 
							  'calle' => $row->calle, 
							  'numero_exterior' => $row->numero_exterior, 
							  'numero_interior' => $row->numero_interior, 
							  'codigo_postal_id' => $row->codigo_postal_id, 
							  'colonia' => $row->colonia,
							  'localidad' => $row->localidad,
							  'referencia' => $row->referencia,
							  'municipio_id' => $row->municipio_id,
							  'contacto_nombre' => $row->contacto_nombre,
							  'contacto_telefono' => $row->contacto_telefono,
							  'contacto_extension' => $row->contacto_extension,
							  'contacto_celular' => $row->contacto_celular,
							  'contacto_correo_electronico' => $row->contacto_correo_electronico,
							  'estatus' => 'VALIDACION');

			//Si el estatus es RECHAZADO
			if($strEstatusCliente ==  'RECHAZADO')
			{
				$arrDatos["fecha_actualizacion"] = date("Y-m-d H:i:s");
				$arrDatos["usuario_actualizacion"] =  $this->session->userdata('usuario_id');

				$this->db->where('prospecto_id', $intProspectoID);
				$this->db->limit(1);
				//Actualizar los datos del registro
				$this->db->update('clientes', $arrDatos);
			}
			else
			{
				$arrDatos["prospecto_id"] = $intProspectoID;
				$arrDatos["fecha_creacion"] = date("Y-m-d H:i:s");
				$arrDatos["usuario_creacion"] =  $this->session->userdata('usuario_id');

				//Guardar los datos del registro
		    	$this->db->insert('clientes', $arrDatos);
			}
			
		}

        //Hacer un llamado al método para guardar el mensaje que se envía a los usuarios
		$otdModelMensajes->guardar('PROSPECTOS', $intProspectoID, $strUsuarios, $strMensaje);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intProspectoID = NULL, $strBusqueda = NULL, $strTipo = NULL)
	{
		//Dependiendo del tipo realizar la búsqueda de datos
		if($strTipo == 'referencias')
		{
			$this->db->select(" CASE 
								   WHEN  C.estatus = 'ACTIVO' THEN C.razon_social
									    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
							    END AS prospecto, P.codigo ", FALSE);
	        $this->db->from('prospectos AS P');
	        $this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
  			$this->db->where("P.prospecto_id", $intProspectoID);
  			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			//Variable que se utiliza para agregar restricción para la búsqueda de datos
		    $strRestricciones = '';
		    //Si existe id del prospecto
			if($intProspectoID > 0)
			{
				$strRestricciones .= " PP.prospecto_id = $intProspectoID";
			}
			else
			{
				$strRestricciones .= " (PP.codigo LIKE '%$strBusqueda%' OR ";
				$strRestricciones .= "  PP.nombre_comercial LIKE '%$strBusqueda%' OR ";
				$strRestricciones .= "  PP.contacto_nombre LIKE '%$strBusqueda%' OR ";
				$strRestricciones .= "  PP.estatus LIKE '%$strBusqueda%' OR ";
				$strRestricciones .= "  P.descripcion LIKE '%$strBusqueda%' OR ";
				$strRestricciones .= "  E.descripcion LIKE '%$strBusqueda%' OR ";
				$strRestricciones .= "  L.descripcion LIKE '%$strBusqueda%')";
			}


		    //Seleccionar los registros que coincidan con los criterios de búsqueda
			$strSQL= $this->db->query("SELECT  PP.prospecto_id, PP.codigo, PP.nombre_comercial, 
											   PP.telefono_principal, PP.telefono_secundario, 
											   PP.correo_electronico, PP.pagina_web, 
											   DATE_FORMAT(PP.contacto_fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento, 
											   PP.contacto_hobbies, PP.importante, 
											   PP.calle, PP.numero_exterior, PP.numero_interior, 
											   PP.codigo_postal_id, PP.colonia, PP.localidad_id, PP.referencia, 
											   PP.contacto_nombre, PP.contacto_telefono, PP.contacto_extension, 
											   PP.contacto_celular, PP.contacto_correo_electronico,
											   PP.hectareas_temporal, PP.hectareas_riego, PP.hectareas_otras,
											   PP.terreno_arenoso, PP.terreno_arcilloso, PP.terreno_compacto, 
											   PP.terreno_pedregoso, PP.terreno_otros, PP.estatus, 
											   L.descripcion AS localidad, M.municipio_id, 
											   M.descripcion AS municipio, 
											   CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado,
											   CONCAT_WS(' - ', P.codigo, P.descripcion) AS pais, 
											   E.descripcion AS estado_rep,
											   P.descripcion AS pais_rep, CP.codigo_postal, C.prospecto_id AS cliente,
											   C.estatus AS cliente_estatus,
										      DATE_FORMAT(PV.fecha,'%d/%m/%Y %h:%i%p') AS ultima_visita,
											  DATE_FORMAT(PV.proxima_visita,'%d/%m/%Y %h:%i%p') AS proxima_visita,
											  PV.comentario, PV.madurez,
											  CASE 
												   WHEN  VVP.vendedor_id > 0
												   		THEN  VVP.vendedor_id
														ELSE V.vendedor_id
											  END AS vendedor_id,
											  CASE 
												   WHEN  VVP.vendedor_id > 0
												   		THEN  CONCAT(EMPVP.codigo, ' - ', EMPVP.apellido_paterno,' ', EMPVP.apellido_materno,' ', EMPVP.nombre)
														ELSE CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre)
											   END AS vendedor,
											   CASE 
												   WHEN  VVP.vendedor_id > 0
												   		THEN  EMPVP.apellido_paterno
													    ELSE EMP.apellido_paterno
											   END AS apellido_paterno
										FROM   (prospectos AS PP 
												INNER JOIN localidades AS L ON PP.localidad_id = L.localidad_id
												INNER JOIN municipios AS M ON L.municipio_id = M.municipio_id
												INNER JOIN sat_estados AS E ON M.estado_id = E.estado_id
										        INNER JOIN sat_paises AS P ON E.pais_id = P.pais_id)
											   LEFT JOIN sat_codigos_postales AS CP ON PP.codigo_postal_id = CP.codigo_postal_id
											   LEFT JOIN clientes AS C ON PP.prospecto_id = C.prospecto_id
											   LEFT JOIN prospectos_visitas AS PV ON PP.prospecto_id = PV.prospecto_id
													AND  PV.fecha = (SELECT MAX(PV2.fecha)
																     FROM prospectos_visitas AS PV2
																	 WHERE   PV2.prospecto_id =  PP.prospecto_id)
											  LEFT JOIN 
											  (zonas_localidades AS ZL INNER JOIN zonas AS Z ON ZL.zona_id = Z.zona_id
											   INNER JOIN vendedores AS V ON Z.vendedor_id = V.vendedor_id
											   INNER JOIN empleados AS EMP ON V.empleado_id = EMP.empleado_id)
											  ON L.localidad_id = ZL.localidad_id AND PV.modulo_id = Z.modulo_id
											     AND (SELECT COUNT(PV2.vendedor_id) 
													  FROM  prospectos_vendedores AS PV2
													  INNER JOIN vendedores AS V2 ON PV2.vendedor_id = V2.vendedor_id
													  WHERE PV2.prospecto_id = PV.prospecto_id AND V2.modulo_id = PV.modulo_id) = 0
		           							  LEFT JOIN
										      (prospectos_vendedores AS VP 
											   INNER JOIN vendedores AS VVP ON VP.vendedor_id = VVP.vendedor_id
											   INNER JOIN empleados AS EMPVP ON VVP.empleado_id = EMPVP.empleado_id)
										      ON PV.modulo_id = VVP.modulo_id AND VP.prospecto_id = PV.prospecto_id 
									    WHERE  $strRestricciones
									    ORDER BY PP.codigo ASC");
			return $strSQL->result();

		}
	}

	//Método para regresar el vendedor que tiene asignado un prospecto en el módulo
	public function buscar_vendedores_prospecto($intProspectoID, $intModuloID)
	{
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$strSQL= $this->db->query("SELECT 
									   CASE 
										   WHEN  VVP.vendedor_id > 0
												THEN  VVP.vendedor_id
												ELSE V.vendedor_id
									  END AS vendedor_id,
									  CASE 
										   WHEN  VVP.vendedor_id > 0
												THEN  CONCAT(EMPVP.codigo, ' - ', EMPVP.apellido_paterno,' ', EMPVP.apellido_materno,' ', EMPVP.nombre)
												ELSE CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre)
									   END AS vendedor
								FROM   (prospectos AS PP 
										INNER JOIN localidades AS L ON PP.localidad_id = L.localidad_id
										INNER JOIN municipios AS M ON L.municipio_id = M.municipio_id
										INNER JOIN sat_estados AS E ON M.estado_id = E.estado_id
										INNER JOIN sat_paises AS P ON E.pais_id = P.pais_id)
								LEFT JOIN 
									  (zonas_localidades AS ZL INNER JOIN zonas AS Z ON ZL.zona_id = Z.zona_id
									   INNER JOIN vendedores AS V ON Z.vendedor_id = V.vendedor_id
									   INNER JOIN empleados AS EMP ON V.empleado_id = EMP.empleado_id)
									  ON L.localidad_id = ZL.localidad_id AND Z.modulo_id = $intModuloID
										 AND (SELECT COUNT(PV2.vendedor_id) 
											  FROM  prospectos_vendedores AS PV2
											  INNER JOIN vendedores AS V2 ON PV2.vendedor_id = V2.vendedor_id
											  WHERE PV2.prospecto_id = PP.prospecto_id AND 
								              V2.modulo_id = $intModuloID) = 0
									  LEFT JOIN
									  (prospectos_vendedores AS VP 
									   INNER JOIN vendedores AS VVP ON VP.vendedor_id = VVP.vendedor_id
									   INNER JOIN empleados AS EMPVP ON VVP.empleado_id = EMPVP.empleado_id)
									  ON  VP.prospecto_id = PP.prospecto_id AND VVP.modulo_id = $intModuloID
								WHERE PP.prospecto_id = $intProspectoID");
		return $strSQL->result();



	}

	/*Método para regresar las próximas visitas de los prospectos que coincidan con los criterios 
     *de búsqueda proporcionados (se utiliza en el reporte de impresión de agenda)*/
	public function buscar_agenda($dteFechaInicial = NULL, $dteFechaFinal = NULL,  $intModuloID = NULL, 
								  $intVendedorID = NUL, $strTipo = NULL)
	{
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';
		//Variable que se utiliza para agregar los campos de cultivos
		$strCamposCultivos = '';

		//Variable que se utiliza para agregar union con las tablas prospectos_cultivos, cultivos y temporadas_cultivos
		$strUnionCultivos = '';

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	    	//Quitar - de la fecha inicial ejemplo: 2017-01-01(Año-mes-día)
            list($strAnioFechaInicial,$intMesFechaInicial,$intDiaFechaInicial) = explode("-", $dteFechaInicial); 
            //Quitar - de la fecha final ejemplo: 2017-12-01(Año-mes-día)
            list($strAnioFechaFinal,$intMesFechaFinal,$intDiaFechaFinal) = explode("-", $dteFechaFinal); 

            //Dependiendo del tipo realizar búsqueda de datos
	    	if($strTipo == 'fecha_nacimiento' OR $strTipo == 'cultivos')
	    	{
	    		$strRestricciones .= " AND PV.fecha = (SELECT MAX(PV2.fecha) 
												       FROM prospectos_visitas AS PV2 
									                   WHERE PV2.prospecto_id = PP.prospecto_id) ";

				//Si el tipo corresponde a fecha de nacimiento
				if($strTipo == 'fecha_nacimiento')
				{
					$strRestricciones .= " AND (MONTH(PP.contacto_fecha_nacimiento) BETWEEN $intMesFechaInicial AND $intMesFechaFinal
       					  	   	     	        AND DAY(PP.contacto_fecha_nacimiento) BETWEEN $intDiaFechaInicial AND $intDiaFechaFinal)";
				}
				else
				{
					$strCamposCultivos .= ", C.descripcion AS cultivo, PC.hectareas, CT.siembra, CT.cosecha, ";
					$strCamposCultivos .= " (SELECT COUNT(CT2.cultivo_id)
											 FROM cultivos_temporadas AS CT2
											 INNER JOIN prospectos_cultivos AS PC2 ON PC2.cultivo_id = CT2.cultivo_id
											 WHERE PC2.prospecto_id = PC.prospecto_id
											 AND (CT2.siembra BETWEEN $intMesFechaInicial AND $intMesFechaFinal
       					  	   	                  OR CT2.cosecha BETWEEN $intMesFechaInicial AND $intMesFechaFinal)) AS total_cultivos ";
					
					$strUnionCultivos .= " INNER JOIN prospectos_cultivos AS PC ON PP.prospecto_id = PC.prospecto_id";
					$strUnionCultivos .= " INNER JOIN cultivos AS C ON PC.cultivo_id = C.cultivo_id";
					$strUnionCultivos .= " INNER JOIN cultivos_temporadas AS CT ON C.cultivo_id = CT.cultivo_id";

					$strRestricciones .= " AND (CT.siembra BETWEEN $intMesFechaInicial AND $intMesFechaFinal
       					  	   	                OR CT.cosecha BETWEEN $intMesFechaInicial AND $intMesFechaFinal)";
				}					                   
	    		
	    	}
	    	else
	    	{
	    		$strRestricciones .= " AND (DATE_FORMAT(PV.proxima_visita,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
	    	}
	    }

		//Si existe id del módulo
		if($intModuloID > 0)
		{
			$strRestricciones .= " AND PV.modulo_id = $intModuloID";
		}

		//Si existe id del vendedor
		if($intVendedorID > 0)
		{

			$strRestricciones .= " AND (V.vendedor_id = $intVendedorID OR VVP.vendedor_id = $intVendedorID)";
		}

		//Seleccionar los registros que coincidan con los criterios de búsqueda
	    $strSQL = $this->db->query("SELECT 	PP.prospecto_id, 
	    									PP.codigo, 
	    									PP.nombre_comercial, 
	    									PP.telefono_principal, 
										   	PP.telefono_secundario, PP.calle, 
										   	DATE_FORMAT(PP.contacto_fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento, 
										   	PP.numero_exterior, PP.colonia, PP.contacto_nombre, 
									       	PP.contacto_telefono, PP.contacto_extension, PP.contacto_celular,
									       	PP.contacto_hobbies, CP.codigo_postal,L.descripcion AS localidad,
       									   	CONCAT_WS(' - ', PP.codigo, PP.nombre_comercial) AS prospecto,
       									   	L.descripcion AS localidad, M.descripcion AS municipio,
       									   	CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado, 
       									   	PV.comentario, PV.madurez,DATE_FORMAT(PV.proxima_visita,'%d/%m/%Y %h:%i%p') AS proxima_visita,
       									    CASE 
											   WHEN  VVP.vendedor_id > 0
											   		THEN  VVP.vendedor_id
													ELSE V.vendedor_id
										    END AS vendedor_id,
											CASE 
											   WHEN  VVP.vendedor_id > 0
											   		THEN  CONCAT(EMPVP.codigo, ' - ', EMPVP.apellido_paterno,' ', EMPVP.apellido_materno,' ', EMPVP.nombre)
													ELSE CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre)
										    END AS vendedor,
										    CASE 
											   WHEN  VVP.vendedor_id > 0
											   		THEN  EMPVP.apellido_paterno
												    ELSE EMP.apellido_paterno
										    END AS apellido_paterno $strCamposCultivos
								    FROM   (prospectos_visitas AS PV INNER JOIN prospectos AS PP ON PV.prospecto_id = PP.prospecto_id
								            INNER JOIN localidades AS L ON PP.localidad_id = L.localidad_id
								            INNER JOIN municipios AS M ON L.municipio_id = M.municipio_id
								            INNER JOIN sat_estados AS E ON M.estado_id = E.estado_id 
								            $strUnionCultivos)
								           LEFT JOIN sat_codigos_postales AS CP ON PP.codigo_postal_id = CP.codigo_postal_id
								           LEFT JOIN 
								          (zonas_localidades AS ZL INNER JOIN zonas AS Z ON ZL.zona_id = Z.zona_id
								           INNER JOIN vendedores AS V ON Z.vendedor_id = V.vendedor_id
								           INNER JOIN empleados AS EMP ON V.empleado_id = EMP.empleado_id)
								          ON L.localidad_id = ZL.localidad_id AND PV.modulo_id = Z.modulo_id
								             AND (SELECT COUNT(PV2.vendedor_id) 
												  FROM  prospectos_vendedores AS PV2
												  INNER JOIN vendedores AS V2 ON PV2.vendedor_id = V2.vendedor_id
												  WHERE PV2.prospecto_id = PV.prospecto_id AND V2.modulo_id = PV.modulo_id) = 0
	           							  LEFT JOIN
										  (prospectos_vendedores AS VP 
										   INNER JOIN vendedores AS VVP ON VP.vendedor_id = VVP.vendedor_id
										   INNER JOIN empleados AS EMPVP ON VVP.empleado_id = EMPVP.empleado_id)
										  ON PV.modulo_id = VVP.modulo_id AND VP.prospecto_id = PV.prospecto_id 
								    WHERE PP.estatus = 'ACTIVO'
								    $strRestricciones
								    ORDER BY vendedor_id ASC, PV.proxima_visita DESC");
	    return $strSQL->result();
	}

	/*Método para regresar los prospectos (con su última visita en caso de que exista) que coincidan con 
	 *los criterios de búsqueda proporcionados (se utiliza en el reporte de listado de prospectos)*/
	public function buscar_prospectos($intModuloID, $intVendedorID, $intLocalidadID, $strMadurez = NULL)
	{
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
	    $strRestricciones = '';

	    //Si existe id del módulo
		if($intModuloID > 0)
		{

			$strRestricciones .= "AND PV.modulo_id = $intModuloID";
		}

		//Si existe madurez
	    if($strMadurez != 0)
	    {
        	$strRestricciones .= " AND PV.madurez = '$strMadurez'";
	    }

	    //Si existe id del vendedor
	    if($intVendedorID > 0)
	    {
        	$strRestricciones .= " AND (V.vendedor_id = $intVendedorID OR VVP.vendedor_id = $intVendedorID)";
	    }

	    //Si existe id de la localidad
	    if($intLocalidadID > 0)
	    {
        	$strRestricciones .= " AND L.localidad_id = $intLocalidadID";
	    }

	    //Realizar búsqueda de los prospectos con su última visita
		$strSQL= $this->db->query("SELECT PP.prospecto_id, PP.codigo, PP.nombre_comercial, 
										  PP.telefono_principal, 
										  PP.telefono_secundario, PP.correo_electronico, PP.pagina_web, 
										  DATE_FORMAT(PP.contacto_fecha_nacimiento,'%d/%m/%Y') AS contacto_fecha_nacimiento, 
										  PP.contacto_hobbies, PP.importante, PP.calle, PP.numero_exterior, PP.numero_interior, 
										  PP.colonia, PP.referencia, PP.contacto_nombre, PP.contacto_telefono,
										  PP.contacto_extension, PP.contacto_celular, PP.contacto_correo_electronico,
										  PP.hectareas_temporal, PP.hectareas_riego, PP.hectareas_otras,
										  PP.terreno_arenoso, PP.terreno_arcilloso, PP.terreno_compacto, 
										  PP.terreno_pedregoso, PP.terreno_otros, PP.estatus, 
										  L.descripcion AS localidad, M.descripcion AS municipio,
									      CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado,
									      CONCAT_WS(' - ', P.codigo, P.descripcion) AS pais,
									      DATE_FORMAT(PV.fecha,'%d/%m/%Y %h:%i%p') AS ultima_visita,
										  DATE_FORMAT(PV.proxima_visita,'%d/%m/%Y %h:%i%p') AS proxima_visita,
										  PV.comentario, PV.madurez, CP.codigo_postal,
										  CASE 
											   WHEN  VVP.vendedor_id > 0
											   		THEN  VVP.vendedor_id
													ELSE V.vendedor_id
										  END AS vendedor_id,
										  CASE 
											   WHEN  VVP.vendedor_id > 0
											   		THEN  CONCAT(EMPVP.codigo, ' - ', EMPVP.apellido_paterno,' ', EMPVP.apellido_materno,' ', EMPVP.nombre)
													ELSE CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre)
										   END AS vendedor,
										   CASE 
											   WHEN  VVP.vendedor_id > 0
											   		THEN  EMPVP.apellido_paterno
												    ELSE EMP.apellido_paterno
										   END AS apellido_paterno
									FROM   (prospectos AS PP 
											INNER JOIN localidades AS L ON PP.localidad_id = L.localidad_id
											INNER JOIN municipios AS M ON L.municipio_id = M.municipio_id
											INNER JOIN sat_estados AS E ON M.estado_id = E.estado_id
									        INNER JOIN sat_paises AS P ON E.pais_id = P.pais_id)
										   LEFT JOIN sat_codigos_postales AS CP ON PP.codigo_postal_id = CP.codigo_postal_id
										   LEFT JOIN prospectos_visitas AS PV ON PP.prospecto_id = PV.prospecto_id
												AND  PV.fecha = (SELECT MAX(PV2.fecha)
															     FROM prospectos_visitas AS PV2
																 WHERE   PV2.prospecto_id =  PP.prospecto_id)
										  LEFT JOIN 
										  (zonas_localidades AS ZL INNER JOIN zonas AS Z ON ZL.zona_id = Z.zona_id
										   INNER JOIN vendedores AS V ON Z.vendedor_id = V.vendedor_id
										   INNER JOIN empleados AS EMP ON V.empleado_id = EMP.empleado_id)
										  ON L.localidad_id = ZL.localidad_id AND PV.modulo_id = Z.modulo_id
										     AND (SELECT COUNT(PV2.vendedor_id) 
												  FROM  prospectos_vendedores AS PV2
												  INNER JOIN vendedores AS V2 ON PV2.vendedor_id = V2.vendedor_id
												  WHERE PV2.prospecto_id = PV.prospecto_id AND V2.modulo_id = PV.modulo_id) = 0
	           							  LEFT JOIN
									      (prospectos_vendedores AS VP 
										   INNER JOIN vendedores AS VVP ON VP.vendedor_id = VVP.vendedor_id
										   INNER JOIN empleados AS EMPVP ON VVP.empleado_id = EMPVP.empleado_id)
									      ON PV.modulo_id = VVP.modulo_id AND VP.prospecto_id = PV.prospecto_id 
								   WHERE PP.estatus = 'ACTIVO'
								   $strRestricciones
								   ORDER BY vendedor_id, L.descripcion, PP.nombre_comercial");
		return $strSQL->result();
	}

	//Método para regresar los vendedores de un módulo (se utiliza para el tabulador de visitas mensuales)
	public function buscar_vendedores_modulo($intModuloID)
	{
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
	    $strRestricciones = '';

	    //Si existe id del módulo
		if($intModuloID > 0)
	    {
	    	$strRestricciones = "WHERE V.modulo_id = $intModuloID";
		}

		//Seleccionar los datos de los vendedores que coinciden con el módulo
		$strSQL= $this->db->query("SELECT V.vendedor_id, V.modulo_id, V.estatus, 
						          		  CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre) AS vendedor, 
						          		  MO.descripcion AS modulo, MO.factura
						            FROM vendedores AS V
						            INNER JOIN modulos AS MO ON V.modulo_id = MO.modulo_id
						            INNER JOIN empleados AS EMP ON V.empleado_id = EMP.empleado_id
						            $strRestricciones
						            ORDER BY EMP.apellido_paterno ASC");
		return $strSQL->result();
	}

	/*Método para regresar las visitas mensuales de los vendedores de un módulo 
	 *(se utiliza para el tabulador de visitas mensuales)*/
	public function buscar_visitas_vendedores($intMes, $strAnio, $intModuloID)
	{
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
	    $strRestricciones = '';

	    //Si existe id del módulo
		if($intModuloID > 0)
	    {
	    	$strRestricciones = "AND PV.modulo_id = $intModuloID";
		}

		//Seleccionar los datos de las visitas diarias de los vendedores que coinciden con el mes y módulo
		$strSQL= $this->db->query("SELECT DAY(PV.fecha) AS dia,
										  COUNT(DAY(PV.fecha)) AS total,
										  CASE 
											   WHEN  VVP.vendedor_id > 0
											   		THEN  VVP.vendedor_id
													ELSE V.vendedor_id
										  END AS vendedor_id,
										  CASE 
											   WHEN  VVP.vendedor_id > 0
											   		THEN  CONCAT(EMPVP.codigo, ' - ', EMPVP.apellido_paterno,' ', EMPVP.apellido_materno,' ', EMPVP.nombre)
													ELSE CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre)
										   END AS vendedor,
										   CASE 
											   WHEN  VVP.vendedor_id > 0
											   		THEN  EMPVP.apellido_paterno
													ELSE EMP.apellido_paterno
										   END AS apellido_paterno
									FROM (prospectos_visitas AS PV INNER JOIN prospectos AS P ON PV.prospecto_id = P.prospecto_id
								         INNER JOIN localidades AS L ON P.localidad_id = L.localidad_id
								         INNER JOIN municipios AS M ON L.municipio_id = M.municipio_id
								         INNER JOIN sat_estados AS E ON M.estado_id = E.estado_id)
							            LEFT JOIN 
							            (zonas_localidades AS ZL INNER JOIN zonas AS Z ON ZL.zona_id = Z.zona_id
							             INNER JOIN vendedores AS V ON Z.vendedor_id = V.vendedor_id
							             INNER JOIN empleados AS EMP ON V.empleado_id = EMP.empleado_id)
							             ON L.localidad_id = ZL.localidad_id AND PV.modulo_id = Z.modulo_id
								            AND (SELECT COUNT(PV2.vendedor_id) 
								            	 FROM  prospectos_vendedores AS PV2
								            	 INNER JOIN vendedores AS V2 ON PV2.vendedor_id = V2.vendedor_id
           									     WHERE PV2.prospecto_id = PV.prospecto_id AND V2.modulo_id = PV.modulo_id) = 0
           							    LEFT JOIN
									    (prospectos_vendedores AS VP 
										 INNER JOIN vendedores AS VVP ON VP.vendedor_id = VVP.vendedor_id
										 INNER JOIN empleados AS EMPVP ON VVP.empleado_id = EMPVP.empleado_id)
									     ON PV.modulo_id = VVP.modulo_id AND VP.prospecto_id = PV.prospecto_id 
								   WHERE P.estatus = 'ACTIVO'
						           AND  YEAR(PV.fecha) = '$strAnio'
								   AND  MONTH(PV.fecha) = '$intMes'
								   $strRestricciones
								   GROUP BY  V.vendedor_id, VVP.vendedor_id, DAY(PV.fecha)
								   ORDER BY vendedor_id, DAY(PV.fecha) ASC");

		return $strSQL->result();
	}

	/*Método para regresar las visitas reprogramadas mensuales de un vendedor
	 *(se utiliza para el tabulador de visitas mensuales)*/
	public function buscar_visitas_reprogramadas_vendedor($intMes, $strAnio, $intVendedorID, $intModuloID)
	{
		
		//Seleccionar los datos de las visitas reprogramadas del vendedor que coinciden con el mes y módulo
		$strSQL= $this->db->query("SELECT COUNT(PVR.prospecto_visita_reprogramacion_id) AS numero_visitas
								   FROM   (prospectos_visitas_reprogramacion AS PVR 
								    		INNER JOIN prospectos_visitas AS PV ON PVR.prospecto_visita_id = PV.prospecto_visita_id
								    		INNER JOIN prospectos AS P ON PV.prospecto_id = P.prospecto_id
								            INNER JOIN localidades AS L ON P.localidad_id = L.localidad_id
								            INNER JOIN municipios AS M ON L.municipio_id = M.municipio_id
								            INNER JOIN sat_estados AS E ON M.estado_id = E.estado_id)
								           LEFT JOIN 
								          (zonas_localidades AS ZL INNER JOIN zonas AS Z ON ZL.zona_id = Z.zona_id
								           INNER JOIN vendedores AS V ON Z.vendedor_id = V.vendedor_id
								           INNER JOIN empleados AS EMP ON V.empleado_id = EMP.empleado_id)
								          ON L.localidad_id = ZL.localidad_id AND PV.modulo_id = Z.modulo_id
								             AND (SELECT COUNT(PV2.vendedor_id) 
								            	  FROM  prospectos_vendedores AS PV2
								            	  INNER JOIN vendedores AS V2 ON PV2.vendedor_id = V2.vendedor_id
           									      WHERE PV2.prospecto_id = PV.prospecto_id AND V2.modulo_id = PV.modulo_id) = 0
           								  LEFT JOIN
									      (prospectos_vendedores AS VP 
										   INNER JOIN vendedores AS VVP ON VP.vendedor_id = VVP.vendedor_id
										   INNER JOIN empleados AS EMPVP ON VVP.empleado_id = EMPVP.empleado_id)
									       ON PV.modulo_id = VVP.modulo_id AND VP.prospecto_id = PV.prospecto_id
									WHERE
									    P.estatus = 'ACTIVO'
									    AND MONTH(PVR.fecha_original) = '$intMes'
									    AND YEAR(PVR.fecha_original) = '$strAnio'
									    AND PV.modulo_id = $intModuloID
									    AND (V.vendedor_id = $intVendedorID OR VVP.vendedor_id = $intVendedorID)");

		return $strSQL->result();
	}


	/*Método para regresar las ventas mensuales de un vendedor
	 *(se utiliza para el tabulador de visitas mensuales)*/
	public function buscar_ventas_vendedor($intMes, $strAnio, $intVendedorID, $strTipoFactura)
	{
		//Dependiendo del tipo realizar búsqueda de datos
		if($strTipoFactura == 'MAQUINARIA')
		{
		    //Facturas de maquinaria
			$strSQL = $this->db->query("SELECT COUNT(factura_maquinaria_id) AS numero_facturas
									  	 FROM facturas_maquinaria
									     WHERE estatus = 'ACTIVO'
									     AND MONTH(fecha) = '$intMes'
									     AND YEAR(fecha) = '$strAnio'
									     AND vendedor_id = $intVendedorID");
			return $strSQL->result();

		}
		else if($strTipoFactura == 'REFACCIONES')
		{
			//Facturas de refacciones
			$strSQL = $this->db->query("SELECT COUNT(factura_refacciones_id) AS numero_facturas
									    FROM facturas_refacciones
									    WHERE estatus = 'ACTIVO'
									    AND MONTH(fecha) = '$intMes'
									    AND YEAR(fecha) = '$strAnio'
									    AND vendedor_id = $intVendedorID");
			return $strSQL->result();
		}
	}


	/*Método para regresar las cotizaciones mensuales de un vendedor
	 *(se utiliza para el tabulador de visitas mensuales)*/
	public function buscar_cotizaciones_vendedor($intMes, $strAnio, $intVendedorID, $strTipoFactura)
	{
		//Dependiendo del tipo realizar búsqueda de datos
		if($strTipoFactura == 'MAQUINARIA')
		{
		    //Cotizaciones de maquinaria
			$strSQL = $this->db->query("SELECT COUNT(cotizacion_maquinaria_id) AS numero_cotizaciones
							  	  	    FROM cotizaciones_maquinaria
							            WHERE estatus = 'ACTIVO'
							            AND MONTH(fecha) = '$intMes'
							            AND YEAR(fecha) = '$strAnio'
							            AND vendedor_id = $intVendedorID");
			return $strSQL->result();

		}
		else if($strTipoFactura == 'REFACCIONES')
		{
			//Cotizaciones de refacciones
			$strSQL = $this->db->query("SELECT COUNT(cotizacion_refacciones_id) AS numero_cotizaciones
									    FROM cotizaciones_refacciones
									    WHERE estatus = 'ACTIVO'
									    AND MONTH(fecha) = '$intMes'
									    AND YEAR(fecha) = '$strAnio'
									    AND vendedor_id = $intVendedorID");
			return $strSQL->result();
		}
	}

	/*Método para regresar las últimas visitas de los prospectos de un módulo que coincidan 
	 *con los criterios de búsqueda proporcionados*/
	public function buscar_visitas_prospectos_madurez($dteFechaCorte, $intModuloID, $intVendedorID, 
													  $intLocalidadID)
	{
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
	    $strRestricciones = '';

	    //Si existe id del módulo
		if($intModuloID > 0)
	    {
	    	$strRestricciones = "AND PV.modulo_id = $intModuloID";
		}

	     //Si existe id del vendedor
	    if($intVendedorID > 0)
	    {
        	$strRestricciones .= " AND (V.vendedor_id = $intVendedorID OR VVP.vendedor_id = $intVendedorID)";
	    }

	    //Si existe id de la localidad
	    if($intLocalidadID > 0)
	    {
        	$strRestricciones .= " AND L.localidad_id = $intLocalidadID";
	    }

		//Seleccionar los datos de las últimas visitas de los prospectos
		$strSQL= $this->db->query("	SELECT 	P.importante, 
										  	DATE_FORMAT(P.fecha_creacion,'%Y-%m-%d') AS fecha_creacion, 
									      	PV.fecha AS ultima_visita, 
									      	L.descripcion, 
									      	PV.madurez 
								   	FROM (prospectos_visitas AS PV INNER JOIN prospectos AS P ON PV.prospecto_id = P.prospecto_id
										  INNER JOIN localidades AS L ON P.localidad_id = L.localidad_id
										  INNER JOIN municipios AS M ON L.municipio_id = M.municipio_id
										  INNER JOIN sat_estados AS E ON M.estado_id = E.estado_id)
										LEFT JOIN 
										(zonas_localidades AS ZL INNER JOIN zonas AS Z ON ZL.zona_id = Z.zona_id
										 INNER JOIN vendedores AS V ON Z.vendedor_id = V.vendedor_id
										 INNER JOIN empleados AS EMP ON V.empleado_id = EMP.empleado_id)
										 ON L.localidad_id = ZL.localidad_id AND PV.modulo_id = Z.modulo_id
											AND (SELECT COUNT(PV2.vendedor_id) 
												 FROM  prospectos_vendedores AS PV2
												 INNER JOIN vendedores AS V2 ON PV2.vendedor_id = V2.vendedor_id
												 WHERE PV2.prospecto_id = PV.prospecto_id AND V2.modulo_id = PV.modulo_id) = 0
										LEFT JOIN
										(prospectos_vendedores AS VP 
										 INNER JOIN vendedores AS VVP ON VP.vendedor_id = VVP.vendedor_id
										 INNER JOIN empleados AS EMPVP ON VVP.empleado_id = EMPVP.empleado_id)
										 ON PV.modulo_id = VVP.modulo_id AND VP.prospecto_id = PV.prospecto_id 
								   	WHERE P.estatus = 'ACTIVO' 
								   	AND PV.fecha = (SELECT MAX(PV2.fecha) 
												   FROM prospectos_visitas AS PV2 
									               WHERE PV2.prospecto_id = P.prospecto_id)
								   	AND  PV.fecha  <=  '$dteFechaCorte'
								   	AND  (V.vendedor_id IS NOT NULL OR VVP.vendedor_id IS NOT NULL)
								   	$strRestricciones
								   	ORDER BY PV.madurez ASC");
		return $strSQL->result();
	}

	//Método para regresar las localidades
	public function buscar_localidades($intMunicipioID, $intEstadoID)
	{
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
	    $strRestricciones = '';

	    //Si existe id del municipio
	    if($intMunicipioID > 0)
	    {
        	$strRestricciones .= " AND M.municipio_id = $intMunicipioID";
	    }

	    //Si existe id del municipio
	    if($intEstadoID > 0)
	    {
        	$strRestricciones .= " AND M.estado_id = $intEstadoID";
	    }

		//Seleccionar los datos de las localidades
		$strSQL= $this->db->query("SELECT L.localidad_id, L.descripcion AS localidad, M.descripcion AS municipio,
										  CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado
						           FROM localidades AS L
						           INNER JOIN municipios AS M ON L.municipio_id = M.municipio_id
						           INNER JOIN sat_estados AS E ON M.estado_id = E.estado_id
						           $strRestricciones
						           ORDER BY L.descripcion ASC");
		return $strSQL->result();
	}

	//Método para regresar los datos de los prospectos activos dependiendo del tipo de reporte proporcionado
	public function buscar_prospectos_localidad($strTipoReporte, $intMunicipioID, $intEstadoID)
	{
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
	    $strRestricciones = '';

	    //Si existe id del municipio
	    if($intMunicipioID > 0)
	    {
        	$strRestricciones .= " AND M.municipio_id = $intMunicipioID";
	    }

	    //Si existe id del municipio
	    if($intEstadoID > 0)
	    {
        	$strRestricciones .= " AND M.estado_id = $intEstadoID";
	    }

		//Si el tipo de reporte es ACTIVIDADES
		if($strTipoReporte == 'ACTIVIDADES')
		{	
			//Seleccionar los datos de las actividades (no eliminadas) de los prospectos activos
			$strSQL= $this->db->query("SELECT PP.prospecto_id,PP.localidad_id, PA.actividad_id AS id
									   FROM prospectos_actividades AS PA
									   INNER JOIN actividades AS A ON PA.actividad_id = A.actividad_id
									   INNER JOIN prospectos AS PP ON PA.prospecto_id = PP.prospecto_id
									   INNER JOIN localidades AS L ON PP.localidad_id = L.localidad_id
									   INNER JOIN municipios AS M ON L.municipio_id = M.municipio_id
									   WHERE A.estatus = 'ACTIVO'
									   AND PP.estatus = 'ACTIVO'
									   $strRestricciones
									   ORDER BY L.descripcion, A.descripcion ASC");
		}
		else if($strTipoReporte == 'CULTIVOS')//Si el tipo de reporte es CULTIVOS
		{
			//Seleccionar los datos de los cultivos (no eliminados) de los prospectos activos
			$strSQL= $this->db->query("SELECT PP.prospecto_id,PP.localidad_id, PC.cultivo_id  AS id
									   FROM prospectos_cultivos AS PC
									   INNER JOIN cultivos AS C ON PC.cultivo_id = C.cultivo_id
									   INNER JOIN prospectos AS PP ON PC.prospecto_id = PP.prospecto_id 
									   INNER JOIN localidades AS L ON PP.localidad_id = L.localidad_id
									   INNER JOIN municipios AS M ON L.municipio_id = M.municipio_id
									   WHERE C.estatus = 'ACTIVO'
									   AND PP.estatus = 'ACTIVO'
									   $strRestricciones
									   ORDER BY L.descripcion, C.descripcion ASC");
		}
		else //Si el tipo de reporte es  TIPO DE HECTAREAS O TIPO DE TERRENO
		{	
			//Seleccionar los datos de los prospectos activos
			$strSQL= $this->db->query("SELECT PP.prospecto_id,PP.localidad_id, 
									   		  IFNULL(PP.hectareas_temporal,'') AS hectareas_temporal, 
  									          IFNULL(PP.hectareas_riego,'') AS hectareas_riego, 
  									          IFNULL(PP.hectareas_otras,'') AS hectareas_otras,
  									          IFNULL(PP.terreno_arenoso,'') AS terreno_arenoso, 
  									          IFNULL(PP.terreno_arcilloso,'') AS terreno_arcilloso,
  									          IFNULL(PP.terreno_compacto,'') AS terreno_compacto, 
  									          IFNULL(PP.terreno_pedregoso,'') AS terreno_pedregoso,
  									          IFNULL(PP.terreno_otros,'') AS terreno_otros
									  FROM prospectos AS PP
									  INNER JOIN localidades AS L ON PP.localidad_id = L.localidad_id
									  INNER JOIN municipios AS M ON L.municipio_id = M.municipio_id
									  WHERE PP.estatus = 'ACTIVO'
									  $strRestricciones
									  ORDER BY L.descripcion ASC");
		}
		return $strSQL->result();
	}

	//Método para regresar las actividades o cultivos dependiendo del tipo de reporte proporcionado
	public function buscar_actividades_cultivos($strTipoReporte){
		//Si el tipo de reporte es ACTIVIDADES
		if($strTipoReporte == 'ACTIVIDADES')
		{
			//Seleccionar los datos de las actividades activas
			$strSQL= $this->db->query("SELECT A.actividad_id AS id, A.descripcion
						           	   FROM actividades AS A
						               WHERE A.estatus = 'ACTIVO'
						               ORDER BY A.descripcion ASC");
		}
		else//Si el tipo de reporte es CULTIVOS
		{
			//Seleccionar los datos de los cultivos activos
			$strSQL= $this->db->query("SELECT C.cultivo_id AS id, C.descripcion
						           	   FROM cultivos AS C
						               WHERE C.estatus = 'ACTIVO'
						               ORDER BY C.descripcion ASC");
		}
		return $strSQL->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('PP.codigo', $strBusqueda);
		$this->db->or_like('PP.nombre_comercial', $strBusqueda);
    	$this->db->or_like('PP.contacto_nombre', $strBusqueda);
    	$this->db->or_like('PP.estatus', $strBusqueda);
    	$this->db->or_like('P.descripcion', $strBusqueda);
        $this->db->or_like('E.descripcion', $strBusqueda);
        $this->db->or_like('M.descripcion', $strBusqueda);
    	$this->db->or_like('L.descripcion', $strBusqueda);
		$this->db->from('prospectos AS PP');
		$this->db->join('localidades AS L', 'PP.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS M', 'L.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		$this->db->join('clientes AS C', 'PP.prospecto_id = C.prospecto_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('PP.prospecto_id, PP.codigo, PP.nombre_comercial, PP.contacto_nombre, 
						   PP.estatus,  L.descripcion AS localidad, M.descripcion AS municipio, 
						   E.descripcion AS estado, P.descripcion AS pais, 
						   C.prospecto_id AS cliente, C.estatus AS cliente_estatus');
		$this->db->from('prospectos AS PP');
		$this->db->join('localidades AS L', 'PP.localidad_id = L.localidad_id', 'inner');
		$this->db->join('municipios AS M', 'L.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		$this->db->join('clientes AS C', 'PP.prospecto_id = C.prospecto_id', 'left');
		$this->db->like('PP.codigo', $strBusqueda);
		$this->db->or_like('PP.nombre_comercial', $strBusqueda);
    	$this->db->or_like('PP.contacto_nombre', $strBusqueda);
    	$this->db->or_like('PP.estatus', $strBusqueda);
    	$this->db->or_like('P.descripcion', $strBusqueda);
        $this->db->or_like('E.descripcion', $strBusqueda);
        $this->db->or_like('M.descripcion', $strBusqueda);
    	$this->db->or_like('L.descripcion', $strBusqueda);
		$this->db->order_by('PP.codigo', 'ASC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["prospectos"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strEstatus, $strTipo, 
								 $strFacturar, $intProspectoID)
	{
		//Variable que se utiliza para ordenar los registros dependiendo del tipo de búsqueda
		$strOrdenamiento = 'P.codigo';

		//Si el Autocomplete es por referencias (prospectos y clientes)
		if($strTipo == 'referencias')
		{
			//Seleccionar los prospectos/clientes activos
			$this->db->select(" P.prospecto_id, 
								CASE 
								   WHEN  C.estatus = 'ACTIVO' THEN C.nombre_comercial
									    ELSE CONCAT_WS(' - ', P.codigo, P.nombre_comercial) 
							    END AS prospecto,
						        C.refacciones_lista_precio_id, C.servicio_lista_precio_id, 
						        C.maquinaria_lista_precio_id", FALSE);
	        $this->db->from('prospectos AS P');
	        $this->db->join('clientes AS C', 'P.prospecto_id = C.prospecto_id', 'left');
  			$this->db->where("(P.estatus = 'ACTIVO' OR
	        				   C.estatus = 'ACTIVO')"); 
	        $this->db->where("(P.codigo LIKE '%$strDescripcion%' OR
	        				   P.nombre_comercial LIKE '%$strDescripcion%' OR 
	        				   C.nombre_comercial LIKE '%$strDescripcion%' OR
	        				   C.razon_social LIKE '%$strDescripcion%')"); 
		}
		//Si el Autocomplete es por serie (prospectos_inventario y maquinaria_inventario)
		else if($strTipo == 'series')
		{	
			//Cambiar orden de los registros
			$strOrdenamiento = 'RI.serie';

			//Si el tipo de servicio se factura
			if($strFacturar == 'SI')
			{
				//Seleccionar las series de la tabla prospectos_inventario
				$this->db->select(" RI.prospecto_inventario_id AS referencia_id, 
									RI.serie", FALSE);
		        $this->db->from('prospectos_inventario AS RI');
		        $this->db->where('RI.prospecto_id', $intProspectoID);
		        $this->db->where("(RI.serie LIKE '%$strDescripcion%')");
			}
			else//Si el tipo de servicio no se factura
			{
				//Seleccionar las series de la tabla maquinaria_inventario
				$this->db->select(" RI.maquinaria_descripcion_id AS referencia_id, 
									RI.serie", FALSE);
		        $this->db->from('maquinaria_inventario AS RI');
		        $this->db->where('RI.sucursal_id', $this->session->userdata('sucursal_id'));
		        $this->db->where("(RI.serie LIKE '%$strDescripcion%')");
			}
		}
		else
		{
			$this->db->select(" P.prospecto_id, 
							    CONCAT_WS(' - ', P.codigo, P.nombre_comercial) AS prospecto", FALSE);
	        $this->db->from('prospectos AS P');
	        //Si existe estatus
	        if($strEstatus !== '')
	        {
	        	 $this->db->where('P.estatus', $strEstatus);
	        }
	        $this->db->where("(P.codigo LIKE '%$strDescripcion%' OR
	        				   P.nombre_comercial LIKE '%$strDescripcion%')");  
		}


		$this->db->order_by($strOrdenamiento, 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

    //Función que se utiliza para regresar el código consecutivo 
	public function get_codigo_consecutivo()
    {
   	    //Variable que se utiliza para asignar el código consecutivo
	  	$strCodigo = '';
   		//Seleccionar el código máximo de la tabla prospectos
	    $this->db->select("IFNULL(MAX(codigo),0) AS codigo", FALSE);
		$this->db->from('prospectos');
		$this->db->limit(1);
		//Si existen datos
		if ($row = $this->db->get()->row()){
			//Asignar valor del código
		    $strCodigoMaximo = $row->codigo;
			//Si el código máximo es igual a cero
			if($strCodigoMaximo == 0)
		    {
		    	$intConsecutivo = 1;
		    }
		    else
		    {
		    	//Incrementar contador en uno
                $intConsecutivo =   ($strCodigoMaximo + 1);

		    }
		}

	    //Concatenar al consecutivo el  incremento de ceros
        $strCodigo = str_pad($intConsecutivo, 5, "0", STR_PAD_LEFT);

		//Regresar código consecutivo
		return $strCodigo;
    }


    /*******************************************************************************************************************
	Funciones de la tabla prospectos_inventario
	*********************************************************************************************************************/
	//Función que se utiliza para guardar el inventario del prospecto
	public function guardar_inventario(stdClass $objProspecto)
	{
		//Si existe inventario
		if($objProspecto->strMaquinariaMarcaID !== '')
		{
			//Quitar | de la lista para obtener la descripción, año, serie, marca, modelo, horas, caballos y tracción
			$arrSeries = explode("|", $objProspecto->strSeries);
			$arrMaquinariaMarcaID = explode("|", $objProspecto->strMaquinariaMarcaID);
			$arrMaquinariaModeloID = explode("|", $objProspecto->strMaquinariaModeloID);
			$arrDescripciones = explode("|", $objProspecto->strDescripciones);
			$arrAnios = explode("|", $objProspecto->strAnios);
			$arrHoras = explode("|", $objProspecto->strHoras);
			$arrCaballos = explode("|", $objProspecto->strCaballos);
			$arrTracciones = explode("|", $objProspecto->strTracciones);
			$arrRecambios = explode("|", $objProspecto->strRecambios);

			//Hacer recorrido para insertar los datos en la tabla prospectos_inventario
			for ($intCon = 0; $intCon < sizeof($arrDescripciones); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('prospecto_id' => $objProspecto->intProspectoID,
								  'serie' => $arrSeries[$intCon],
								  'maquinaria_marca_id' => $arrMaquinariaMarcaID[$intCon],
								  'maquinaria_modelo_id' => $arrMaquinariaModeloID[$intCon],
								  'descripcion' => $arrDescripciones[$intCon],
								  'anio' => $arrAnios[$intCon],
								  'horas' => $arrHoras[$intCon],
								  'caballos' => $arrCaballos[$intCon],
								  'traccion' => $arrTracciones[$intCon],
								  'recambio' => $arrRecambios[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('prospectos_inventario', $arrDatos);
			}
		}
	}

	//Método para regresar el inventario de un registro
	public function buscar_inventario($intProspectoID)
	{
		$this->db->select('PI.serie, PI.maquinaria_marca_id, PI.maquinaria_modelo_id, PI.descripcion, 
						   PI.anio, PI.horas, PI.caballos, PI.traccion, PI.recambio, 
						   MM.descripcion AS maquinaria_marca, MMOD.descripcion AS maquinaria_modelo');
		$this->db->from('prospectos_inventario AS PI');
		$this->db->join('maquinaria_marcas AS MM', 'PI.maquinaria_marca_id = MM.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'PI.maquinaria_modelo_id = MMOD.maquinaria_modelo_id', 'inner');
		$this->db->where('PI.prospecto_id', $intProspectoID);
		$this->db->order_by('PI.descripcion', 'ASC');
		return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla prospectos_actividades
	*********************************************************************************************************************/
	//Función que se utiliza para guardar las actividades del prospecto
	public function guardar_actividades(stdClass $objProspecto)
	{
		//Si existen actividades
		if($objProspecto->strActividadID !== '')
		{
			//Quitar | de la lista para obtener el ID de la actividad
			$arrActividadID = explode("|", $objProspecto->strActividadID);

			//Hacer recorrido para insertar los datos en la tabla prospectos_actividades
			for ($intCon = 0; $intCon < sizeof($arrActividadID); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('prospecto_id' => $objProspecto->intProspectoID,
								  'actividad_id' => $arrActividadID[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('prospectos_actividades', $arrDatos);
			}
		}
	}

	//Método para regresar las actividades de un registro dependiendo del tipo de búsqueda
	public function buscar_actividades($intProspectoID, $strTipo = NULL)
	{
		//Dependiendo del tipo realizar la búsqueda de datos
		if($strTipo == 'lista')
		{
			$this->db->select("GROUP_CONCAT(A.descripcion 
											ORDER BY  A.descripcion ASC SEPARATOR ',') AS lista", FALSE);
			$this->db->from('prospectos_actividades AS PA');
			$this->db->join('actividades AS A', 'PA.actividad_id = A.actividad_id', 'inner');
			$this->db->where('PA.prospecto_id', $intProspectoID);
			$this->db->limit(1);		
			return $this->db->get()->row();
		}
		else
		{
			$this->db->select('PA.actividad_id, A.descripcion AS actividad');
			$this->db->from('prospectos_actividades AS PA');
			$this->db->join('actividades AS A', 'PA.actividad_id = A.actividad_id', 'inner');
			$this->db->where('PA.prospecto_id', $intProspectoID);
			$this->db->order_by('A.descripcion', 'ASC');
			return $this->db->get()->result();
		}
		
	}

	/*******************************************************************************************************************
	Funciones de la tabla prospectos_cultivos
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los cultivos del prospecto
	public function guardar_cultivos(stdClass $objProspecto)
	{
		//Si existen cultivos
		if($objProspecto->strCultivoID !== '')
		{
			//Quitar | de la lista para obtener el ID del cultivo y el número de hectáreas
			$arrCultivoID = explode("|", $objProspecto->strCultivoID);
			$arrHectareas = explode("|", $objProspecto->strHectareas);

			//Hacer recorrido para insertar los datos en la tabla prospectos_cultivos
			for ($intCon = 0; $intCon < sizeof($arrCultivoID); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('prospecto_id' => $objProspecto->intProspectoID,
								  'cultivo_id' => $arrCultivoID[$intCon],
								  'hectareas' => $arrHectareas[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('prospectos_cultivos', $arrDatos);
			}
		}
	}

	//Método para regresar los cultivos de un registro dependiendo del tipo de búsqueda
	public function buscar_cultivos($intProspectoID, $strTipo = NULL)
	{
		//Dependiendo del tipo realizar la búsqueda de datos
		if($strTipo == 'lista')
		{
			$this->db->select("GROUP_CONCAT(CONCAT_WS(' - ', C.descripcion, PC.hectareas) 
								            ORDER BY  C.descripcion ASC SEPARATOR ',') AS lista", FALSE);
			$this->db->from('prospectos_cultivos AS PC');
			$this->db->join('cultivos AS C', 'PC.cultivo_id = C.cultivo_id', 'inner');
			$this->db->where('PC.prospecto_id', $intProspectoID);
			$this->db->limit(1);		
			return $this->db->get()->row();
		}
		else
		{	
			
			$this->db->select('PC.cultivo_id, C.descripcion AS cultivo, PC.hectareas');
			$this->db->from('prospectos_cultivos AS PC');
			$this->db->join('cultivos AS C', 'PC.cultivo_id = C.cultivo_id', 'inner');
		    $this->db->where('PC.prospecto_id', $intProspectoID);
			$this->db->order_by('C.descripcion', 'ASC');
			return $this->db->get()->result();
		}
		
	}

	/*******************************************************************************************************************
	Funciones de la tabla prospectos_visitas
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_visitas(stdClass $objProspectoVisita)
	{
		//Asignar datos al array
		$arrDatos = array('prospecto_visita_referencia' => $objProspectoVisita->intProspectoVisitaReferencia, 
						  'prospecto_id' => $objProspectoVisita->intProspectoID, 
						  'modulo_id' => $objProspectoVisita->intModuloID, 
						  'estrategia_id' => $objProspectoVisita->intEstrategiaID,
						  'maquinaria_descripcion_id' => $objProspectoVisita->intMaquinariaDescripcionID, 
						  'fecha' => $objProspectoVisita->dteFecha, 
						  'comentario' => $objProspectoVisita->strComentario, 
						  'madurez' => $objProspectoVisita->strMadurez, 
						  'motivo_visita_id' => $objProspectoVisita->intMotivoVisitaID, 
						  'probabilidad_compra' => $objProspectoVisita->dteProbabilidadCompra, 
						  'condiciones_pago' => $objProspectoVisita->strCondicionesPago, 
						  'plazo' => $objProspectoVisita->strPlazo, 
						  'proxima_visita' => $objProspectoVisita->dteProximaVisita, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objProspectoVisita->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('prospectos_visitas', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_visitas(stdClass $objProspectoVisita)
	{
		//Asignar datos al array
		$arrDatos = array('prospecto_id' => $objProspectoVisita->intProspectoID,
						  'modulo_id' => $objProspectoVisita->intModuloID, 
						  'estrategia_id' => $objProspectoVisita->intEstrategiaID,
						  'maquinaria_descripcion_id' => $objProspectoVisita->intMaquinariaDescripcionID, 
						  'fecha' => $objProspectoVisita->dteFecha, 
						  'comentario' => $objProspectoVisita->strComentario, 
						  'madurez' => $objProspectoVisita->strMadurez, 
						  'motivo_visita_id' => $objProspectoVisita->intMotivoVisitaID, 
						  'probabilidad_compra' => $objProspectoVisita->dteProbabilidadCompra, 
						  'condiciones_pago' => $objProspectoVisita->strCondicionesPago, 
						  'plazo' => $objProspectoVisita->strPlazo, 
						  'proxima_visita' => $objProspectoVisita->dteProximaVisita,  
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objProspectoVisita->intUsuarioID);
		$this->db->where('prospecto_visita_id', $objProspectoVisita->intProspectoVisitaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('prospectos_visitas', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_visitas($intProspectoVisitaID = NULL, $intProspectoID = NULL, 
								   $dteFechaInicial = NULL, $dteFechaFinal = NULL, $intModuloID = NULL, 
								   $intVendedorID = NULL, $strTipoReporte = NULL)
	{
		
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
	    $strRestricciones = '';
	    //Variable que se utiliza para ordenar los registros dependiendo del tipo de reporte
	    $strOrdenamiento = '';

	    //Dependiendo del tipo de reporte ordenar los registros de la búsqueda
	    if($strTipoReporte == 'general')
	    {
	    	$strOrdenamiento = "vendedor_id ASC,  PV.fecha DESC";
	    }
	    else
	    {
	    	$strOrdenamiento = "PV.fecha DESC";
	    }

	    //Si existe id de la visita
	    if ($intProspectoVisitaID !== NULL)
	    { 
	    	 $strRestricciones = "WHERE PV.prospecto_visita_id = $intProspectoVisitaID";
	    }
	    else
	    {
	    	//Si existe id del prospecto
			if($intProspectoID > 0)
			{
				 $strRestricciones = "WHERE PV.prospecto_id = $intProspectoID";
			}

			//Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
			{
				//Si no existen restricciones asignar condición WHERE
				$strRestricciones .= (($strRestricciones !== '') ? 
										" AND " : "WHERE ");

				$strRestricciones .= "(PV.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
			}

			//Si existe id del módulo
			if($intModuloID > 0)
			{
				//Si no existen restricciones asignar condición WHERE
				$strRestricciones .= (($strRestricciones !== '') ? 
										" AND " : "WHERE ");

				$strRestricciones .= "PV.modulo_id = $intModuloID";
			}

			//Si existe id del vendedor
			if($intVendedorID > 0)
			{
				//Si no existen restricciones asignar condición WHERE
				$strRestricciones .= (($strRestricciones !== '') ? 
										" AND " : "WHERE ");

				$strRestricciones .= " (V.vendedor_id = $intVendedorID OR VVP.vendedor_id = $intVendedorID)";
			}
	    }

	    //Seleccionar los registros que coincidan con los criterios de búsqueda
	    $strSQL = $this->db->query("SELECT PV.prospecto_visita_id, 
	    								   PV.prospecto_visita_referencia, 
	    								   PV.prospecto_id,  PV.modulo_id, PV.estrategia_id,
	    								   PV.maquinaria_descripcion_id, 
	    								   DATE_FORMAT(PV.fecha, '%d/%m/%Y %h:%i%p') AS fecha, 
	    								   DATE_FORMAT(PV.fecha,'%d/%m/%Y') AS fecha_visita,
										   DATE_FORMAT(PV.fecha,'%h:%i %p') AS hora_visita,
										   DATE_FORMAT(PV.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion,
	    								   PV.comentario, PV.madurez, PV.motivo_visita_id,
	    								   DATE_FORMAT(PV.probabilidad_compra,'%d/%m/%Y') AS probabilidad_compra, 
	    								   PV.condiciones_pago, PV.plazo, 
	    								   DATE_FORMAT(PV.proxima_visita, '%d/%m/%Y %h:%i%p') AS proxima_visita,
       									   DATE_FORMAT(PV.proxima_visita,'%d/%m/%Y') AS fecha_proxima_visita,
										   DATE_FORMAT(PV.proxima_visita,'%h:%i %p') AS hora_proxima_visita,
       									   CONCAT_WS(' - ', P.codigo, P.nombre_comercial) AS prospecto,
       									   L.descripcion AS localidad, M.descripcion AS municipio,
       									   CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado, 
       									   CASE 
											   WHEN  VVP.vendedor_id > 0
											   		THEN  VVP.vendedor_id
													ELSE V.vendedor_id
										    END AS vendedor_id,
											CASE 
											   WHEN  VVP.vendedor_id > 0
											   		THEN  CONCAT(EMPVP.codigo, ' - ', EMPVP.apellido_paterno,' ', EMPVP.apellido_materno,' ', EMPVP.nombre)
													ELSE CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre)
										    END AS vendedor,
										    CASE 
											   WHEN  VVP.vendedor_id > 0
											   		THEN  EMPVP.apellido_paterno
												    ELSE EMP.apellido_paterno
										    END AS apellido_paterno, MO.descripcion AS modulo, 
										    MV.descripcion AS motivo_visita, EG.descripcion AS estrategia,
										    CONCAT_WS(' - ', MD.codigo, MD.descripcion_corta) AS maquinaria_descripcion,
										    MD.codigo AS codigo_maquinaria,	  
										    MD.descripcion_corta AS descripcion_corta_maquinaria,
										    MD.descripcion AS descripcion_maquinaria,
										    ML.descripcion AS maquinaria_linea,
										     MM.descripcion AS maquinaria_marca,
						   					MMOD.descripcion AS maquinaria_modelo,
						   					UC.usuario AS usuario_creacion, 
						   					 DATE_FORMAT(PV.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion

								    FROM   (prospectos_visitas AS PV  
								    		INNER JOIN modulos AS MO ON PV.modulo_id = MO.modulo_id
									   		INNER JOIN motivos_visitas AS MV ON PV.motivo_visita_id = MV.motivo_visita_id
								    	    INNER JOIN prospectos AS P ON PV.prospecto_id = P.prospecto_id
								            INNER JOIN localidades AS L ON P.localidad_id = L.localidad_id
								            INNER JOIN municipios AS M ON L.municipio_id = M.municipio_id
								            INNER JOIN sat_estados AS E ON M.estado_id = E.estado_id
								            LEFT JOIN estrategias AS EG ON PV.estrategia_id =  EG.estrategia_id
								            LEFT JOIN maquinaria_descripciones AS MD ON PV.maquinaria_descripcion_id =  MD.maquinaria_descripcion_id
								            LEFT JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id
								            LEFT JOIN maquinaria_marcas AS MM ON MD.maquinaria_marca_id = MM.maquinaria_marca_id
								            LEFT JOIN maquinaria_modelos AS MMOD ON MD.maquinaria_modelo_id = MMOD.maquinaria_modelo_id
								            LEFT JOIN usuarios AS UC ON PV.usuario_creacion = UC.usuario_id)
								           LEFT JOIN 
								          (zonas_localidades AS ZL INNER JOIN zonas AS Z ON ZL.zona_id = Z.zona_id
								           INNER JOIN vendedores AS V ON Z.vendedor_id = V.vendedor_id
								           INNER JOIN empleados AS EMP ON V.empleado_id = EMP.empleado_id)
								           ON L.localidad_id = ZL.localidad_id AND PV.modulo_id = Z.modulo_id
									           AND (SELECT COUNT(PV2.vendedor_id) 
													FROM  prospectos_vendedores AS PV2
													INNER JOIN vendedores AS V2 ON PV2.vendedor_id = V2.vendedor_id
													WHERE PV2.prospecto_id = PV.prospecto_id AND V2.modulo_id = PV.modulo_id) = 0
								          LEFT JOIN
									      (prospectos_vendedores AS VP 
										   INNER JOIN vendedores AS VVP ON VP.vendedor_id = VVP.vendedor_id
										   INNER JOIN empleados AS EMPVP ON VVP.empleado_id = EMPVP.empleado_id)
									      ON PV.modulo_id = VVP.modulo_id AND VP.prospecto_id = PV.prospecto_id 
								    $strRestricciones
								    ORDER BY $strOrdenamiento");
	    return $strSQL->result();
	}

	//Método para regresar los vendedores de las visitas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_vendedores_visitas($intProspectoID = NULL, $dteFechaInicial = NULL, 	
										      $dteFechaFinal = NULL, $intModuloID = NULL, 
										      $intVendedorID = NULL)
	{
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
	    $strRestricciones = '';

	    //Si existe id del módulo
		if($intModuloID > 0)
		{
			$strRestricciones .= "AND PV.modulo_id = $intModuloID";
		}
		
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		{
			$strRestricciones .= "AND (PV.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
		}

		//Si existe id del vendedor
		if($intVendedorID > 0)
		{
			$strRestricciones .= "AND (V.vendedor_id = $intVendedorID  OR VVP.vendedor_id = $intVendedorID)";
		}

		//Seleccionar los registros que coincidan con los criterios de búsqueda
	    $strSQL = $this->db->query("SELECT MO.descripcion AS modulo,
	    							CASE 
									   WHEN  VVP.vendedor_id > 0
									   		THEN  VVP.vendedor_id
											ELSE V.vendedor_id
								    END AS vendedor_id,
									CASE 
									   WHEN  VVP.vendedor_id > 0
									   		THEN  CONCAT(EMPVP.codigo, ' - ', EMPVP.apellido_paterno,' ', EMPVP.apellido_materno,' ', EMPVP.nombre)
											ELSE CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre)
								    END AS vendedor
									FROM   (prospectos_visitas AS PV INNER JOIN modulos AS MO ON PV.modulo_id = MO.modulo_id
											INNER JOIN prospectos AS P ON PV.prospecto_id = P.prospecto_id
											INNER JOIN localidades AS L ON P.localidad_id = L.localidad_id
											INNER JOIN municipios AS M ON L.municipio_id = M.municipio_id
											INNER JOIN sat_estados AS E ON M.estado_id = E.estado_id)
										   LEFT JOIN 
										  (zonas_localidades AS ZL INNER JOIN zonas AS Z ON ZL.zona_id = Z.zona_id
										   INNER JOIN vendedores AS V ON Z.vendedor_id = V.vendedor_id
										   INNER JOIN empleados AS EMP ON V.empleado_id = EMP.empleado_id)
										  ON L.localidad_id = ZL.localidad_id AND PV.modulo_id = Z.modulo_id
										     AND (SELECT COUNT(PV2.vendedor_id) 
												  FROM  prospectos_vendedores AS PV2
												  INNER JOIN vendedores AS V2 ON PV2.vendedor_id = V2.vendedor_id
												  WHERE PV2.prospecto_id = PV.prospecto_id AND V2.modulo_id = PV.modulo_id) = 0
										  LEFT JOIN
									      (prospectos_vendedores AS VP 
										   INNER JOIN vendedores AS VVP ON VP.vendedor_id = VVP.vendedor_id
										   INNER JOIN empleados AS EMPVP ON VVP.empleado_id = EMPVP.empleado_id)
									      ON PV.modulo_id = VVP.modulo_id AND VP.prospecto_id = PV.prospecto_id 
									WHERE PV.prospecto_id = $intProspectoID
									$strRestricciones
									GROUP BY PV.modulo_id, V.vendedor_id, VVP.vendedor_id");
	    return $strSQL->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_visitas($intProspectoID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						           $intModuloID = NULL, $intVendedorID = NULL, $intNumRows, $intPos)
	{

		//Variable que se utiliza para agregar restricción para la búsqueda de datos
	    $strRestricciones = '';

		//Si la posicion inicial del limite es cadena vacia asignar el valor de cero
	    if($intPos == '')
	    {
	        $intPos = 0;
	    }
		
		//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			 $strRestricciones = "WHERE PV.prospecto_id = $intProspectoID";
		}


		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		{
			//Si no existen restricciones asignar condición WHERE
			$strRestricciones .= (($strRestricciones !== '') ? 
									" AND " : "WHERE ");

			$strRestricciones .= "(PV.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
		}

		//Si existe id del módulo
		if($intModuloID > 0)
		{
			//Si no existen restricciones asignar condición WHERE
			$strRestricciones .= (($strRestricciones !== '') ? 
									" AND " : "WHERE ");

			$strRestricciones .= "PV.modulo_id = $intModuloID";
		}

		//Si existe id del vendedor
		if($intVendedorID > 0)
		{
			//Si no existen restricciones asignar condición WHERE
			$strRestricciones .= (($strRestricciones !== '') ? 
									" AND " : "WHERE ");

			$strRestricciones .= "(V.vendedor_id = $intVendedorID OR VVP.vendedor_id = $intVendedorID)";
		}
	  
		//Variable que se utiliza para formar la  consulta
		$queryVisitas = "SELECT PV.prospecto_visita_id, PV.prospecto_id, 
							   DATE_FORMAT(PV.fecha, '%d/%m/%Y %h:%i %p') AS fecha, PV.comentario, 
							   DATE_FORMAT(PV.proxima_visita, '%d/%m/%Y %h:%i %p') AS proxima_visita,
								   CONCAT_WS(' - ', P.codigo, P.nombre_comercial) AS prospecto,
							    MO.descripcion AS modulo
					     FROM   (prospectos_visitas AS PV  INNER JOIN modulos AS MO ON PV.modulo_id = MO.modulo_id
						   		INNER JOIN motivos_visitas AS MV ON PV.motivo_visita_id = MV.motivo_visita_id
					    		INNER JOIN prospectos AS P ON PV.prospecto_id = P.prospecto_id
					            INNER JOIN localidades AS L ON P.localidad_id = L.localidad_id
					            INNER JOIN municipios AS M ON L.municipio_id = M.municipio_id
					            INNER JOIN sat_estados AS E ON M.estado_id = E.estado_id)
					           LEFT JOIN 
					          (zonas_localidades AS ZL INNER JOIN zonas AS Z ON ZL.zona_id = Z.zona_id
					           INNER JOIN vendedores AS V ON Z.vendedor_id = V.vendedor_id
					           INNER JOIN empleados AS EMP ON V.empleado_id = EMP.empleado_id)
					          ON L.localidad_id = ZL.localidad_id AND PV.modulo_id = Z.modulo_id
					              AND (SELECT COUNT(PV2.vendedor_id) 
									   FROM  prospectos_vendedores AS PV2
									   INNER JOIN vendedores AS V2 ON PV2.vendedor_id = V2.vendedor_id
									   WHERE PV2.prospecto_id = PV.prospecto_id AND V2.modulo_id = PV.modulo_id) = 0
   							  LEFT JOIN
						      (prospectos_vendedores AS VP 
							   INNER JOIN vendedores AS VVP ON VP.vendedor_id = VVP.vendedor_id
							   INNER JOIN empleados AS EMPVP ON VVP.empleado_id = EMPVP.empleado_id)
						      ON PV.modulo_id = VVP.modulo_id AND VP.prospecto_id = PV.prospecto_id
					    $strRestricciones
					    ORDER BY PV.fecha DESC";

	    //Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$strSQLNum = $this->db->query($queryVisitas);
		$arrResultado["total_rows"] = $strSQLNum->num_rows(); 

		//Concatenar límite de registros
		$queryVisitas .= " LIMIT $intPos, $intNumRows";

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$strSQL = $this->db->query($queryVisitas);
		$arrResultado["visitas"] = $strSQL->result();
		return $arrResultado;
	}

	/*******************************************************************************************************************
	Funciones de la tabla prospectos_visitas_reprogramacion
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_reprogramacion_visitas(stdClass $objProspectoVisita)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Variable que se utiliza para asignar fecha y hora actual
		$dteFecha = date("Y-m-d H:i:s");
		//Tabla prospectos_visitas_reprogramacion
		//Asignar datos al array
		$arrDatos = array('prospecto_visita_id' => $objProspectoVisita->intProspectoVisitaID, 
						  'fecha_original' => $objProspectoVisita->dteFechaOriginal, 
						  'fecha_reprogramada' => $objProspectoVisita->dteFechaReprogramada, 
						  'comentario' => $objProspectoVisita->strComentario, 
						  'fecha_creacion' => $dteFecha,
						  'usuario_creacion' => $objProspectoVisita->intUsuarioID);
		//Guardar los datos del registro
	    $this->db->insert('prospectos_visitas_reprogramacion', $arrDatos);

	    //Tabla prospectos_visitas
	    //Asignar datos al array
		$arrDatos = array('proxima_visita' => $objProspectoVisita->dteFechaReprogramada, 
						  'fecha_actualizacion' => $dteFecha,
						  'usuario_actualizacion' => $objProspectoVisita->intUsuarioID);
		$this->db->where('prospecto_visita_id', $objProspectoVisita->intProspectoVisitaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('prospectos_visitas', $arrDatos);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_reprogramacion_visitas($intProspectoID = NULL, $dteFechaInicial = NULL,
								                  $dteFechaFinal = NULL, $intModuloID = NULL, 
								                  $intVendedorID = NULL)
	{
		
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
	    $strRestricciones = '';

    	//Si existe id del prospecto
		if($intProspectoID > 0)
		{
			 $strRestricciones = "WHERE PV.prospecto_id = $intProspectoID";
		}

		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		{
			//Si no existen restricciones asignar condición WHERE
			$strRestricciones .= (($strRestricciones !== '') ? 
									" AND " : "WHERE ");

			$strRestricciones .= "(DATE_FORMAT(PVR.fecha_original,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')";
		}

		//Si existe id del módulo
		if($intModuloID > 0)
		{
			//Si no existen restricciones asignar condición WHERE
			$strRestricciones .= (($strRestricciones !== '') ? 
									" AND " : "WHERE ");

			$strRestricciones .= "PV.modulo_id = $intModuloID";
		}

		//Si existe id del vendedor
		if($intVendedorID > 0)
		{
			//Si no existen restricciones asignar condición WHERE
			$strRestricciones .= (($strRestricciones !== '') ? 
									" AND " : "WHERE ");

			$strRestricciones .= "(V.vendedor_id = $intVendedorID OR VVP.vendedor_id = $intVendedorID)";
		}

	    //Seleccionar los registros que coincidan con los criterios de búsqueda
	    $strSQL = $this->db->query("SELECT MO.descripcion AS modulo, 
	    								   DATE_FORMAT(PVR.fecha_original, '%d/%m/%Y %h:%i%p') AS fecha_original, 
	    								   DATE_FORMAT(PVR.fecha_reprogramada, '%d/%m/%Y %h:%i%p') AS fecha_reprogramada,
	    								   PVR.comentario, CONCAT_WS(' - ', P.codigo, P.nombre_comercial) AS prospecto,
       									   L.descripcion AS localidad, M.descripcion AS municipio,
       									   CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado, 
       									   CASE 
											   WHEN  VVP.vendedor_id > 0
											   		THEN  VVP.vendedor_id
													ELSE V.vendedor_id
										  END AS vendedor_id,
										  CASE 
											   WHEN  VVP.vendedor_id > 0
											   		THEN  CONCAT(EMPVP.codigo, ' - ', EMPVP.apellido_paterno,' ', EMPVP.apellido_materno,' ', EMPVP.nombre)
													ELSE CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre)
										   END AS vendedor,
										   CASE 
											   WHEN  VVP.vendedor_id > 0
											   		THEN  EMPVP.apellido_paterno
													ELSE EMP.apellido_paterno
										   END AS apellido_paterno
								    FROM   (prospectos_visitas_reprogramacion AS PVR 
								    		INNER JOIN prospectos_visitas AS PV ON PVR.prospecto_visita_id = PV.prospecto_visita_id
								    		INNER JOIN modulos AS MO ON PV.modulo_id = MO.modulo_id
								    		INNER JOIN prospectos AS P ON PV.prospecto_id = P.prospecto_id
								            INNER JOIN localidades AS L ON P.localidad_id = L.localidad_id
								            INNER JOIN municipios AS M ON L.municipio_id = M.municipio_id
								            INNER JOIN sat_estados AS E ON M.estado_id = E.estado_id)
								           LEFT JOIN 
								          (zonas_localidades AS ZL INNER JOIN zonas AS Z ON ZL.zona_id = Z.zona_id
								           INNER JOIN vendedores AS V ON Z.vendedor_id = V.vendedor_id
								           INNER JOIN empleados AS EMP ON V.empleado_id = EMP.empleado_id)
								          ON L.localidad_id = ZL.localidad_id AND PV.modulo_id = Z.modulo_id
								             AND (SELECT COUNT(PV2.vendedor_id) 
								            	  FROM  prospectos_vendedores AS PV2
								            	  INNER JOIN vendedores AS V2 ON PV2.vendedor_id = V2.vendedor_id
           									      WHERE PV2.prospecto_id = PV.prospecto_id AND V2.modulo_id = PV.modulo_id) = 0
           								  LEFT JOIN
									      (prospectos_vendedores AS VP 
										   INNER JOIN vendedores AS VVP ON VP.vendedor_id = VVP.vendedor_id
										   INNER JOIN empleados AS EMPVP ON VVP.empleado_id = EMPVP.empleado_id)
									       ON PV.modulo_id = VVP.modulo_id AND VP.prospecto_id = PV.prospecto_id
								    $strRestricciones
								    ORDER BY vendedor_id ASC, PVR.fecha_original DESC");
	    return $strSQL->result();
	}

}
?>