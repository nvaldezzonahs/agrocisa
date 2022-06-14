<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla usuarios
	*********************************************************************************************************************/
	//Método para registrar los datos de un usuario.
	public function guardar(stdClass $objUsuario)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		
		//Tabla usuarios
		//Asignar datos al array
		$arrDatos = array('empleado_id' => $objUsuario->intEmpleadoID, 
						  'usuario' => $objUsuario->strUsuario,
						  'contrasena' => $objUsuario->strContrasena,
						  'correo_electronico' => $objUsuario->strCorreoElectronico,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objUsuario->intUsuarioModID);
		//Guardar los datos del registro
		$this->db->insert('usuarios', $arrDatos);
		//Agregar id del nuevo registro al objeto
		$objUsuario->intUsuarioID = $this->db->insert_id();

		//Si se envían los accesos para una sucursal
		if (($objUsuario->intSucursalID > 0) && ($objUsuario->strPermisosAcceso != ''))
		{
			//Hacer un llamado al método para guardar los permisos de acceso del usuario
			$this->guardar_permisos_acceso($objUsuario);
		}

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar (actualizar) los datos de un usuario.
	public function modificar(stdClass $objUsuario)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Tabla usuarios
		//Asignar datos al array
		$arrDatos = array('empleado_id' => $objUsuario->intEmpleadoID, 
						  'usuario' => $objUsuario->strUsuario,
						  'correo_electronico' => $objUsuario->strCorreoElectronico,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objUsuario->intUsuarioModID);
		$this->db->where('usuario_id', $objUsuario->intUsuarioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('usuarios', $arrDatos);

		//Si hubo cambios en la contraseña
		if ($objUsuario->strContrasena !== '')
		{	
			//Hacer un llamado a la función para modificar la contraseña del usuario
			$this->set_contrasena($objUsuario->strContrasena, $objUsuario->intUsuarioID);
		}

		//Si se envían los accesos para una sucursal
		if ($objUsuario->intSucursalID > 0)
		{
			//Eliminar los permisos de acceso del usuario
			$this->db->where('usuario_id', $objUsuario->intUsuarioID);  
			$this->db->where('sucursal_id', $objUsuario->intSucursalID);  
			$this->db->delete('usuarios_permisos');
			
			//Si existen permisos de acceso para la sucursal
			if ($objUsuario->strPermisosAcceso !== '')
			{
				//Hacer un llamado al método para guardar los permisos de acceso del usuario
				$this->guardar_permisos_acceso($objUsuario);
			}
		}
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intUsuarioID = NULL, $strUsuarioIntentos = NULL, $strUsuario = NULL, $strBusqueda = NULL)
	{
		//Si existe id del usuario
		if ($intUsuarioID !== NULL)
		{
			$this->db->select("U.usuario_id, U.empleado_id, U.usuario, U.correo_electronico, U.estatus,
							   CONCAT(E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
							   CONCAT(E.nombre,' ', E.apellido_paterno,' ', E.apellido_materno) AS empleado_firma", FALSE);
			$this->db->from('usuarios AS U');
			$this->db->join('empleados AS E', 'U.empleado_id = E.empleado_id', 'left');
			$this->db->where('U.usuario_id', $intUsuarioID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strUsuarioIntentos !== NULL)	//Si existe usuario que intenta iniciar sesión
		{
			$this->db->select("U.usuario_id, U.usuario, U.contrasena, U.intentos,
							   CONCAT(E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado, 
							   CONCAT(E.nombre,' ', E.apellido_paterno,' ', E.apellido_materno) AS empleado_firma,
							   P.descripcion AS puesto_empleado", FALSE);
			$this->db->from('usuarios AS U');
			$this->db->join('empleados AS E', 'U.empleado_id = E.empleado_id', 'left');
			$this->db->join('puestos AS P', 'E.puesto_id = P.puesto_id', 'left');
			$this->db->where('U.usuario', $strUsuarioIntentos);
			$this->db->where('U.estatus', 'ACTIVO');
			$this->db->limit(1);		
			return $this->db->get()->row();
		}
		else if ($strUsuario !== NULL)	//Si existe usuario
		{
			$this->db->select("U.usuario_id, U.empleado_id, U.usuario, U.correo_electronico, U.estatus,
							   CONCAT(E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado, 
							   CONCAT(E.nombre,' ', E.apellido_paterno,' ', E.apellido_materno) AS empleado_firma", FALSE);
			$this->db->from('usuarios AS U');
			$this->db->join('empleados AS E', 'U.empleado_id = E.empleado_id', 'left');
			$this->db->where('U.usuario', $strUsuario);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->select("U.usuario, U.correo_electronico, U.estatus,
							   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
							   (SELECT GROUP_CONCAT(S.nombre ORDER BY S.nombre ASC SEPARATOR ',')
								FROM   usuarios_permisos AS UP INNER JOIN sucursales AS S ON UP.sucursal_id = S.sucursal_id
								WHERE  UP.usuario_id = U.usuario_id) AS sucursales", FALSE);
			$this->db->from('usuarios AS U');
			$this->db->join('empleados AS E', 'U.empleado_id = E.empleado_id', 'left');
			$this->db->like('U.usuario', $strBusqueda);
	        $this->db->or_like('U.correo_electronico', $strBusqueda);
            $this->db->or_like('U.estatus', $strBusqueda);
            $this->db->or_like('E.codigo', $strBusqueda);
		    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
	        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
			$this->db->order_by('U.usuario','ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('U.usuario', $strBusqueda);
		$this->db->or_like('U.correo_electronico', $strBusqueda);
        $this->db->or_like('U.estatus', $strBusqueda);
        $this->db->or_like('E.codigo', $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
		$this->db->from('usuarios AS U');
		$this->db->join('empleados AS E', 'U.empleado_id = E.empleado_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("U.usuario_id, U.usuario, U.correo_electronico, U.estatus, 
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS empleado,
						   (SELECT GROUP_CONCAT(S.nombre ORDER BY S.nombre ASC SEPARATOR ',')
							FROM   usuarios_permisos AS UP INNER JOIN sucursales AS S ON UP.sucursal_id = S.sucursal_id
							WHERE  UP.usuario_id = U.usuario_id) AS sucursales", FALSE);
		$this->db->from('usuarios AS U');
		$this->db->join('empleados AS E', 'U.empleado_id = E.empleado_id', 'left');
		$this->db->like('U.usuario', $strBusqueda);
		$this->db->or_like('U.correo_electronico', $strBusqueda);
        $this->db->or_like('U.estatus', $strBusqueda);
        $this->db->or_like('E.codigo', $strBusqueda);
	    $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_paterno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_paterno, E.nombre)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.nombre, E.apellido_materno)", $strBusqueda);
        $this->db->or_like("CONCAT_WS(' ', E.apellido_materno, E.nombre)", $strBusqueda);
		$this->db->order_by('U.usuario', 'ASC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["usuarios"] = $this->db->get()->result();
		return $arrResultado;
	}

	//Método para modificar la contraseña del usuario
	public function set_contrasena($strContrasena, $intUsuarioID = 0)
	{
		//Asignar datos al array
		$arrDatos = array('contrasena' => $strContrasena,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		//Si no se envía usuario, se cambia la contraseña del usuario logueado en el sistema
		if ($intUsuarioID === 0)
		{
			$this->db->where('usuario_id', $this->session->userdata('usuario_id'));
		}
		else
		{
			$this->db->where('usuario_id', $intUsuarioID);
		}
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('usuarios', $arrDatos);
	}

	//Método para modificar el estatus de un usuario.
	public function set_estatus($intUsuarioID, $strEstatus)
	{
		//Si el estatus del registro es ACTIVO
		if ($strEstatus == 'ACTIVO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'intentos' => 0,
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
		$this->db->where('usuario_id', $intUsuarioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('usuarios', $arrDatos);
	}

	//Método para modificar el estatus de un usuario (a suspendido) por exceso de intentos al querer ingresar al sistema.
	public function set_suspendido($strUsuario)
	{
		//Asignar datos al array
		$arrDatos = array('estatus' => 'SUSPENDIDO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"));
		$this->db->where('usuario', $strUsuario);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('usuarios', $arrDatos);
	}

	//Método para registrar los datos de inicio de sesión de un usuario.
	public function set_inicio_sesion()
	{
		//Iniciamos transacción
		$this->db->trans_begin();
		//Asignar datos al array para guardar el inicio de sesión
		$arrDatos = array('usuario_id' => $this->session->userdata('usuario_id'), 
						  'inicio_sesion' => $this->session->userdata('inicio_sesion'), 
						  'direccion_ip' => $this->session->userdata('direccion_ip'),
						  'host_name' =>  php_uname('n'));
		//Guardar los datos del registro
		$this->db->insert('bitacora_inicio', $arrDatos);

		//Asignar datos al array para reiniciar a 0 los intentos de inicio de sesión
		$arrDatos = array('intentos' => 0);
		$this->db->where('usuario_id', $this->session->userdata('usuario_id'));
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('usuarios', $arrDatos);

		//Si existen errores, no se registra los datos en la BD, de lo contrario, se confirman ambos movimientos
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		return $this->db->trans_status();
	}

	//Método para registrar los datos de cierre de sesión de un usuario.
	public function set_cerrar_sesion()
	{
		//Asignar datos al array
		$arrDatos = array('cierre_sesion' => date("Y-m-d H:i:s"));
		$this->db->where('usuario_id', $this->session->userdata('usuario_id'));
		$this->db->where('inicio_sesion', $this->session->userdata('inicio_sesion'));
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('bitacora_inicio', $arrDatos);
	}

	//Método para incrementar y regresar el número de intentos de inicio de sesión del usuario
	public function get_intentos($strUsuario)
	{
		//Seleccionar el número de intentos del usuario
		$this->db->select('intentos');
		$this->db->from('usuarios');
		$this->db->where('usuario', $strUsuario);
		$this->db->limit(1);		
		$resConsulta = $this->db->get();
		//Si el usuario existe
		if ($resConsulta->num_rows() === 1)
		{
			//Asignar datos e incrementar el contador de intentos para guardarlo en la BD
			$rowInt = $resConsulta->row();
			$rowInt->intentos = $rowInt->intentos + 1;
			$arrDatos = array('intentos' => $rowInt->intentos);
			$this->db->where('usuario', $strUsuario);
			$this->db->limit(1);
			//Actualizar los datos del registro
			if ($this->db->update('usuarios', $arrDatos) !== FALSE)
			{
				return $rowInt->intentos;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" U.usuario_id, 
						    CASE 
						   	   WHEN U.empleado_id > 0  
							   THEN  CONCAT(U.usuario,' - ', E.apellido_paterno, ' ', E.apellido_materno,' ', E.nombre)
							   ELSE  U.usuario
						    END AS usuario ", FALSE);
        $this->db->from('usuarios AS U');
        $this->db->join('empleados AS E', 'U.empleado_id = E.empleado_id', 'left');
		$this->db->where('U.estatus', 'ACTIVO');
        $this->db->where("(U.usuario LIKE '%$strDescripcion%' OR
        				   ((CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strDescripcion%') OR 
			               (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strDescripcion%') OR
			               (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strDescripcion%') OR 
			               (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strDescripcion%')))"); 
		$this->db->order_by('apellido_paterno', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}


	/*******************************************************************************************************************
	Funciones de la tabla usuarios_permisos
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los permisos de acceso del usuario
	public function guardar_permisos_acceso(stdClass $objUsuario)
	{
		//Asignar datos al array
		$arrDatos = array('usuario_id' => $objUsuario->intUsuarioID,
						  'sucursal_id' => $objUsuario->intSucursalID,
						  'permisos' => $objUsuario->strPermisosAcceso);
		//Guardar los datos del registro
		$this->db->insert('usuarios_permisos', $arrDatos);
	}

	//Método para regresar los permisos del usuario que coincide con los id's proporcionados.
	public function get_permisos($intUsuarioID = NULL, $intSucursalID = NULL, 
								 $strProcesoMensaje = NULL, $intReferenciaIDMensaje = NULL)
	{
		//Si existe id del usuario y id de la sucursal
		if($intUsuarioID !== NULL && $intSucursalID !== NULL)
		{
			$this->db->select('permisos');
			$this->db->from('usuarios_permisos');
			$this->db->where('usuario_id', $intUsuarioID);
			$this->db->where('sucursal_id', $intSucursalID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			//Si existe descripción del proceso y id de la referencia de un mensaje
			if($strProcesoMensaje !== NULL && $intReferenciaIDMensaje !== NULL)
			{
				$this->db->select("U.usuario_id, U.usuario, 
							   CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) AS empleado, 
							   UP.permisos", FALSE);
				$this->db->from('mensajes AS M');
				$this->db->join('usuarios AS U', 'M.para = U.usuario_id', 'inner');
				$this->db->join('usuarios_permisos AS UP', 'U.usuario_id = UP.usuario_id', 'inner');
				$this->db->join('empleados AS E', 'U.empleado_id = E.empleado_id', 'left');
				$this->db->where('U.estatus', 'ACTIVO');
				$this->db->where('M.proceso', $strProcesoMensaje);
				$this->db->where('M.referencia_id', $intReferenciaIDMensaje);
				$this->db->order_by('U.usuario', 'ASC');
			}
			else
			{
				$this->db->select("U.usuario_id, U.usuario, 
							   CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) AS empleado, 
							   UP.permisos", FALSE);
				$this->db->from('usuarios AS U');
				$this->db->join('usuarios_permisos AS UP', 'U.usuario_id = UP.usuario_id', 'inner');
				$this->db->join('empleados AS E', 'U.empleado_id = E.empleado_id', 'left');
				$this->db->where('U.estatus', 'ACTIVO');
				$this->db->order_by('U.usuario', 'ASC');
				
			}

			return $this->db->get()->result();
			
		}
		
	}

	//Método para regresar el menú con los accesos del usuario
	public function get_menu()
	{
		$this->db->select('permisos');
		$this->db->from('usuarios_permisos');
		$this->db->where('usuario_id', $this->session->userdata('usuario_id'));
		$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	
}
?>