<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla empleados
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objEmpleado)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla empleados
		//Asignar datos al array
		$arrDatos = array('codigo' => $objEmpleado->strCodigo, 
						  'nombre' => $objEmpleado->strNombre, 
						  'apellido_paterno' => $objEmpleado->strApellidoPaterno, 
						  'apellido_materno' => $objEmpleado->strApellidoMaterno,
						  'rfc' => $objEmpleado->strRfc,
						  'curp' => $objEmpleado->strCurp,
						  'estado_civil' => $objEmpleado->strEstadoCivil,
						  'sexo' => $objEmpleado->strSexo,
						  'fecha_nacimiento' => $objEmpleado->dteFechaNacimiento,
						  'municipio_nacimiento_id' => $objEmpleado->intMunicipioNacimientoID,
						  'calle' => $objEmpleado->strCalle,
						  'numero_exterior' => $objEmpleado->strNumeroExterior,
						  'numero_interior' => $objEmpleado->strNumeroInterior,
						  'codigo_postal_id' =>  $objEmpleado->intCodigoPostalID,
						  'colonia' => $objEmpleado->strColonia,
						  'localidad' => $objEmpleado->strLocalidad,
						  'municipio_id' => $objEmpleado->intMunicipioID,
						  'telefono_particular' => $objEmpleado->strTelefonoParticular,
						  'correo_electronico' => $objEmpleado->strCorreoElectronico,
						  'emergencia_nombre' => $objEmpleado->strEmergenciaNombre,
						  'emergencia_telefono' => $objEmpleado->strEmergenciaTelefono,
						  'emergencia_parentesco' => $objEmpleado->strEmergenciaParentesco,
						  'fecha_ingreso' => $objEmpleado->dteFechaIngreso,
						  'sucursal_id' => $objEmpleado->intSucursalID,
						  'departamento_id' => $objEmpleado->intDepartamentoID,
						  'puesto_id' => $objEmpleado->intPuestoID,
						  'licencia_manejo' => $objEmpleado->strLicenciaManejo,
						  'licencia_tipo' => $objEmpleado->strLicenciaTipo,
						  'licencia_expedicion' => $objEmpleado->dteLicenciaExpedicion,
						  'licencia_vigencia' => $objEmpleado->dteLicenciaVigencia,
						  'cuenta_bancaria' => $objEmpleado->strCuentaBancaria,
						  'clabe' => $objEmpleado->strClabe,
						  'nss' => $objEmpleado->strNss,
						  'clinica' => $objEmpleado->strClinica,
						  'infonavit' => $objEmpleado->strInfonavit,
						  'tipo_retencion' => $objEmpleado->strTipoRetencion,
						  'importe' => $objEmpleado->intImporte,
						  'fecha_infonavit' => $objEmpleado->dteFechaInfonavit,
						  'tipo_sangre' => $objEmpleado->strTipoSangre,
						  'talla_camisa' => $objEmpleado->strTallaCamisa,
						  'talla_pantalon' => $objEmpleado->strTallaPantalon,
						  'talla_zapatos' => $objEmpleado->strTallaZapatos,
						  'numero_afore' => $objEmpleado->strNumeroAfore,
						  'afore' => $objEmpleado->strAfore,
						  'grado_estudios' => $objEmpleado->strGradoEstudios,
						  'licenciatura_titulo' => $objEmpleado->strLicenciaturaTitulo,
						  'licenciatura_institucion' => $objEmpleado->strLicenciaturaInstitucion,
						  'licenciatura_fecha' => $objEmpleado->dteLicenciaturaFecha,
						  'maestria_titulo' => $objEmpleado->strMaestriaTitulo,
						  'maestria_institucion' => $objEmpleado->strMaestriaInstitucion,
						  'maestria_fecha' => $objEmpleado->dteMaestriaFecha,
						  'ingles_comprension' => $objEmpleado->intInglesComprension,
						  'ingles_lectura' => $objEmpleado->intInglesLectura,
						  'ingles_escritura' => $objEmpleado->intInglesEscritura,
						  'frances_comprension' =>  $objEmpleado->intFrancesComprension,
						  'frances_lectura' =>  $objEmpleado->intFrancesLectura,
						  'frances_escritura' => $objEmpleado->intFrancesEscritura,
						  'otro_idioma' => $objEmpleado->strOtroIdioma,
						  'otro_comprension' => $objEmpleado->intOtroComprension,
						  'otro_lectura' =>  $objEmpleado->intOtroLectura,
						  'otro_escritura' => $objEmpleado->intOtroEscritura,
						  'excel' => $objEmpleado->intExcel,
						  'word' =>  $objEmpleado->intWord,
						  'power_point' => $objEmpleado->intPowerPoint,
						  'access' => $objEmpleado->intAccess,
						  'otras_habilidades' => $objEmpleado->strOtrasHabilidades,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objEmpleado->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('empleados', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objEmpleado->intEmpleadoID = $this->db->insert_id();

		//Hacer un llamado al método para guardar los dependientes del empleado
		$this->guardar_dependientes($objEmpleado);


		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objEmpleado->intEmpleadoID;
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objEmpleado)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla empleados
		//Asignar datos al array
		$arrDatos = array('codigo' => $objEmpleado->strCodigo, 
						  'nombre' => $objEmpleado->strNombre, 
						  'apellido_paterno' => $objEmpleado->strApellidoPaterno, 
						  'apellido_materno' => $objEmpleado->strApellidoMaterno,
						  'rfc' => $objEmpleado->strRfc,
						  'curp' => $objEmpleado->strCurp,
						  'estado_civil' => $objEmpleado->strEstadoCivil,
						  'sexo' => $objEmpleado->strSexo,
						  'fecha_nacimiento' => $objEmpleado->dteFechaNacimiento,
						  'municipio_nacimiento_id' => $objEmpleado->intMunicipioNacimientoID,
						  'calle' => $objEmpleado->strCalle,
						  'numero_exterior' => $objEmpleado->strNumeroExterior,
						  'numero_interior' => $objEmpleado->strNumeroInterior,
						  'codigo_postal_id' =>  $objEmpleado->intCodigoPostalID,
						  'colonia' => $objEmpleado->strColonia,
						  'localidad' => $objEmpleado->strLocalidad,
						  'municipio_id' => $objEmpleado->intMunicipioID,
						  'telefono_particular' => $objEmpleado->strTelefonoParticular,
						  'correo_electronico' => $objEmpleado->strCorreoElectronico,
						  'emergencia_nombre' => $objEmpleado->strEmergenciaNombre,
						  'emergencia_telefono' => $objEmpleado->strEmergenciaTelefono,
						  'emergencia_parentesco' => $objEmpleado->strEmergenciaParentesco,
						  'fecha_ingreso' => $objEmpleado->dteFechaIngreso,
						  'sucursal_id' => $objEmpleado->intSucursalID,
						  'departamento_id' => $objEmpleado->intDepartamentoID,
						  'puesto_id' => $objEmpleado->intPuestoID,
						  'licencia_manejo' => $objEmpleado->strLicenciaManejo,
						  'licencia_tipo' => $objEmpleado->strLicenciaTipo,
						  'licencia_expedicion' => $objEmpleado->dteLicenciaExpedicion,
						  'licencia_vigencia' => $objEmpleado->dteLicenciaVigencia,
						  'cuenta_bancaria' => $objEmpleado->strCuentaBancaria,
						  'clabe' => $objEmpleado->strClabe,
						  'nss' => $objEmpleado->strNss,
						  'clinica' => $objEmpleado->strClinica,
						  'infonavit' => $objEmpleado->strInfonavit,
						  'tipo_retencion' => $objEmpleado->strTipoRetencion,
						  'importe' => $objEmpleado->intImporte,
						  'fecha_infonavit' => $objEmpleado->dteFechaInfonavit,
						  'tipo_sangre' => $objEmpleado->strTipoSangre,
						  'talla_camisa' => $objEmpleado->strTallaCamisa,
						  'talla_pantalon' => $objEmpleado->strTallaPantalon,
						  'talla_zapatos' => $objEmpleado->strTallaZapatos,
						  'numero_afore' => $objEmpleado->strNumeroAfore,
						  'afore' => $objEmpleado->strAfore,
						  'grado_estudios' => $objEmpleado->strGradoEstudios,
						  'licenciatura_titulo' => $objEmpleado->strLicenciaturaTitulo,
						  'licenciatura_institucion' => $objEmpleado->strLicenciaturaInstitucion,
						  'licenciatura_fecha' => $objEmpleado->dteLicenciaturaFecha,
						  'maestria_titulo' => $objEmpleado->strMaestriaTitulo,
						  'maestria_institucion' => $objEmpleado->strMaestriaInstitucion,
						  'maestria_fecha' => $objEmpleado->dteMaestriaFecha,
						  'ingles_comprension' => $objEmpleado->intInglesComprension,
						  'ingles_lectura' => $objEmpleado->intInglesLectura,
						  'ingles_escritura' => $objEmpleado->intInglesEscritura,
						  'frances_comprension' =>  $objEmpleado->intFrancesComprension,
						  'frances_lectura' =>  $objEmpleado->intFrancesLectura,
						  'frances_escritura' => $objEmpleado->intFrancesEscritura,
						  'otro_idioma' => $objEmpleado->strOtroIdioma,
						  'otro_comprension' => $objEmpleado->intOtroComprension,
						  'otro_lectura' =>  $objEmpleado->intOtroLectura,
						  'otro_escritura' => $objEmpleado->intOtroEscritura,
						  'excel' => $objEmpleado->intExcel,
						  'word' =>  $objEmpleado->intWord,
						  'power_point' => $objEmpleado->intPowerPoint,
						  'access' => $objEmpleado->intAccess,
						  'otras_habilidades' => $objEmpleado->strOtrasHabilidades,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objEmpleado->intUsuarioID);
		$this->db->where('empleado_id', $objEmpleado->intEmpleadoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('empleados', $arrDatos);

		//Eliminar los dependientes guardados
		$this->db->where('empleado_id', $objEmpleado->intEmpleadoID);
		$this->db->delete('empleados_dependientes');

		//Hacer un llamado al método para guardar los dependientes del empleado
		$this->guardar_dependientes($objEmpleado);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intEmpleadoID, $strEstatus)
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
		$this->db->where('empleado_id', $intEmpleadoID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('empleados', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intEmpleadoID = NULL, $strCodigo = NULL, $strRfc = NULL, 
						   $strCurp = NULL, $strBusqueda = NULL)
	{
		$this->db->select("E.empleado_id, E.codigo, E.nombre, E.apellido_paterno, E.apellido_materno, 
						   E.rfc, E.curp, E.estado_civil, E.sexo, 
						   DATE_FORMAT(E.fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento,
						   E.municipio_nacimiento_id, E.calle, E.numero_exterior, E.numero_interior, 
						   E.codigo_postal_id, E.colonia, E.localidad, E.municipio_id, E.telefono_particular, 
						   E.correo_electronico, E.emergencia_nombre, E.emergencia_telefono, 
						   E.emergencia_parentesco, DATE_FORMAT(E.fecha_ingreso,'%d/%m/%Y') AS fecha_ingreso, 
						   E.fecha_ingreso AS fecha_ingreso_rep, E.sucursal_id, E.departamento_id,
						   E.puesto_id, E.licencia_manejo, E.licencia_tipo, 
						   DATE_FORMAT(E.licencia_expedicion,'%d/%m/%Y') AS licencia_expedicion, 
						   DATE_FORMAT(E.licencia_vigencia,'%d/%m/%Y') AS licencia_vigencia, 
						   E.cuenta_bancaria, E.clabe, E.nss, E.clinica, E.infonavit, E.tipo_retencion, 
						   E.importe, DATE_FORMAT(E.fecha_infonavit,'%d/%m/%Y') AS fecha_infonavit, E.tipo_sangre, 
						   E.talla_camisa, E.talla_pantalon, E.talla_zapatos, E.numero_afore, E.afore,
						   E.grado_estudios, E.licenciatura_titulo, E.licenciatura_institucion, 
						   DATE_FORMAT(E.licenciatura_fecha,'%d/%m/%Y') AS licenciatura_fecha, E.maestria_titulo,
						   E.maestria_institucion,  DATE_FORMAT(E.maestria_fecha,'%d/%m/%Y') AS maestria_fecha,
						   E.ingles_comprension, E.ingles_lectura, E.ingles_escritura, E.frances_comprension,
						   E.frances_lectura, E.frances_escritura, E.otro_idioma, E.otro_comprension,
						   E.otro_lectura, E.otro_escritura, E.excel, E.word, E.power_point, E.access,
						   E.otras_habilidades, E.estatus, 
						   DATE_FORMAT(E.fecha_eliminacion,'%Y-%m-%d') AS fecha_eliminacion_rep, C.codigo_postal,
						   S.nombre AS sucursal, D.descripcion AS departamento, P.descripcion AS puesto, 
						   MN.descripcion AS municipio_nacimiento, EN.descripcion AS estado_nacimiento_rep, 
						   PN.descripcion AS pais_nacimiento_rep,
						   CASE 
							   WHEN  E.municipio_nacimiento_id IS NULL THEN ''
								    ELSE CONCAT_WS(' - ', EN.codigo, EN.descripcion) 
						   END AS estado_nacimiento,
						   CASE 
							   WHEN E.municipio_nacimiento_id IS NULL THEN ''
							   ELSE CONCAT_WS(' - ', PN.codigo, PN.descripcion) 
						   END AS pais_nacimiento, 
						   MD.descripcion AS municipio,
						   CASE 
							   WHEN E.municipio_id IS NULL THEN ''
							   ELSE CONCAT_WS(' - ', ED.codigo, ED.descripcion) 
						   END AS estado,
						   CASE
							   WHEN E.municipio_id IS NULL THEN ''
							   ELSE CONCAT_WS(' - ', PD.codigo, PD.descripcion) 
						   END AS pais, ED.descripcion AS estado_rep, PD.descripcion AS pais_rep,
						   CASE 
							   WHEN  S.sucursal_id > 0 
							   	 THEN ''
								 ELSE 'SI' 
						   END AS corporativo, ES.descripcion AS estado_sucursal", FALSE);
		$this->db->from('empleados AS E');
		$this->db->join('departamentos AS D', 'E.departamento_id = D.departamento_id', 'inner');
		$this->db->join('puestos AS P', 'E.puesto_id = P.puesto_id', 'inner');
		$this->db->join('sucursales AS S', 'E.sucursal_id = S.sucursal_id', 'left');
		$this->db->join('sat_codigos_postales AS C', 'E.codigo_postal_id = C.codigo_postal_id', 'left');
	    $this->db->join('municipios AS MN', 'E.municipio_nacimiento_id = MN.municipio_id', 'left');
	    $this->db->join('sat_estados AS EN', 'MN.estado_id = EN.estado_id', 'left');
		$this->db->join('sat_paises AS PN', 'EN.pais_id = PN.pais_id', 'left');
		$this->db->join('municipios AS MD', 'E.municipio_id = MD.municipio_id', 'left');
	    $this->db->join('sat_estados AS ED', 'MD.estado_id = ED.estado_id', 'left');
	    $this->db->join('sat_paises AS PD', 'ED.pais_id = PD.pais_id', 'left');
	    $this->db->join('localidades AS SL', 'S.localidad_id = SL.localidad_id', 'left');
	    $this->db->join('municipios AS MS', 'SL.municipio_id = MS.municipio_id', 'left');
	    $this->db->join('sat_estados AS ES', 'MS.estado_id = ES.estado_id', 'left');

		//Si existe id del empleado
		if ($intEmpleadoID !== NULL)
		{   
			$this->db->where('E.empleado_id', $intEmpleadoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigo !== NULL)//Si existe código
		{
			$this->db->where('E.codigo', $strCodigo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strRfc !== NULL)//Si existe rfc
		{
			$this->db->where('E.rfc', $strRfc);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCurp !== NULL)//Si existe curp
		{
			$this->db->where('E.curp', $strCurp);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->like('E.estatus', $strBusqueda);
			$this->db->or_like("E.codigo", $strBusqueda);
		    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
	        $this->db->or_like("S.nombre", $strBusqueda);
	        $this->db->or_like("D.descripcion", $strBusqueda);
	        $this->db->or_like("P.descripcion", $strBusqueda);
			$this->db->order_by('E.apellido_paterno', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('E.estatus', $strBusqueda);
		$this->db->or_like("E.codigo", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
        $this->db->or_like("S.nombre", $strBusqueda);
        $this->db->or_like("D.descripcion", $strBusqueda);
        $this->db->or_like("P.descripcion", $strBusqueda);
		$this->db->from('empleados AS E');
		$this->db->join('departamentos AS D', 'E.departamento_id = D.departamento_id', 'inner');
		$this->db->join('puestos AS P', 'E.puesto_id = P.puesto_id', 'inner');
		$this->db->join('sucursales AS S', 'E.sucursal_id = S.sucursal_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("E.empleado_id, E.codigo,  E.estatus,
						   CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) AS nombre,
						   S.nombre AS sucursal, D.descripcion AS departamento, P.descripcion AS puesto,
						   CASE 
							   WHEN  S.sucursal_id > 0 
							   	 THEN ''
								 ELSE 'SI' 
						   END AS corporativo", FALSE);
		$this->db->from('empleados AS E');
		$this->db->join('departamentos AS D', 'E.departamento_id = D.departamento_id', 'inner');
		$this->db->join('puestos AS P', 'E.puesto_id = P.puesto_id', 'inner');
		$this->db->join('sucursales AS S', 'E.sucursal_id = S.sucursal_id', 'left');
		$this->db->like('E.estatus', $strBusqueda);
		$this->db->or_like("E.codigo", $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
        $this->db->or_like("S.nombre", $strBusqueda);
        $this->db->or_like("D.descripcion", $strBusqueda);
        $this->db->or_like("P.descripcion", $strBusqueda);
		$this->db->order_by('E.apellido_paterno', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["empleados"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" empleado_id,
						    CONCAT(codigo, ' - ', apellido_paterno,' ', apellido_materno,' ', nombre) AS empleado ", FALSE);
        $this->db->from('empleados');
		$this->db->where('estatus', 'ACTIVO');
        $this->db->where("((codigo LIKE '%$strDescripcion%') OR 
        				   (CONCAT_WS(' ', apellido_paterno, apellido_materno, nombre) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', nombre, apellido_paterno, apellido_materno) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', apellido_paterno, apellido_materno) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', nombre, apellido_paterno) LIKE '%$strDescripcion%') OR 
			               (CONCAT_WS(' ', apellido_paterno, nombre) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', nombre, apellido_materno) LIKE '%$strDescripcion%') OR 
			               (CONCAT_WS(' ', apellido_materno, nombre) LIKE '%$strDescripcion%'))"); 
		$this->db->order_by('apellido_paterno', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla empleados_dependientes
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los dependientes del empleado
	public function guardar_dependientes(stdClass $objEmpleado)
	{
		//Si existen dependientes
		if($objEmpleado->strNombres !== '')
		{
			//Quitar | de la lista para obtener el nombre, el sexo, la fecha de nacimiento y  el parentesco
			$arrNombres = explode("|", $objEmpleado->strNombres);
			$arrSexos = explode("|", $objEmpleado->strSexos);
			$arrParentescos = explode("|", $objEmpleado->strParentescos);
			$arrFechasNacimiento = explode("|", $objEmpleado->strFechasNacimiento);

			//Hacer recorrido para insertar los datos en la tabla empleados_dependientes
			for ($intCon = 0; $intCon < sizeof($arrNombres); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('empleado_id' => $objEmpleado->intEmpleadoID,
					 			  'renglon' => ($intCon + 1),
								  'nombre' => $arrNombres[$intCon],
								  'sexo' => $arrSexos[$intCon],
								  'parentesco' => $arrParentescos[$intCon],
								  'fecha_nacimiento' => $arrFechasNacimiento[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('empleados_dependientes', $arrDatos);
			}
		}
	}

	//Método para regresar los dependientes de un registro
	public function buscar_dependientes($intEmpleadoID)
	{
		$this->db->select("nombre, sexo, parentesco, 
						   DATE_FORMAT(fecha_nacimiento,'%d/%m/%Y') AS fecha_nacimiento", FALSE);
		$this->db->from('empleados_dependientes');
		$this->db->where('empleado_id', $intEmpleadoID);
		$this->db->order_by('fecha_nacimiento', 'ASC');
		return $this->db->get()->result();
	}
}
?>