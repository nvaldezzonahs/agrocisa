<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupos_usuarios_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla grupos_usuarios
	*********************************************************************************************************************/
	//Método para registrar los datos de un grupo de usuarios.
	public function guardar(stdClass $objGrupoUsuario)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla grupos_usuarios
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objGrupoUsuario->strDescripcion,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objGrupoUsuario->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('grupos_usuarios', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objGrupoUsuario->intGrupoUsuarioID = $this->db->insert_id();

		//Hacer un llamado al método para guardar los permisos de acceso del grupo
		$this->guardar_permisos_acceso($objGrupoUsuario);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar (actualizar) los datos de un grupo de usuarios.
	public function modificar(stdClass $objGrupoUsuario)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla grupos_usuarios
		//Asignar datos al array
		$arrDatos = array('descripcion' => $objGrupoUsuario->strDescripcion,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objGrupoUsuario->intUsuarioID);
		$this->db->where('grupo_usuario_id', $objGrupoUsuario->intGrupoUsuarioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('grupos_usuarios', $arrDatos);

		//Hacer un llamado al método para modificar los permisos de acceso del grupo
		$this->modificar_permisos_acceso($objGrupoUsuario);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar el estatus de un  grupo de usuarios.
	public function set_estatus($intGrupoUsuarioID, $strEstatus)
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
		$this->db->where('grupo_usuario_id', $intGrupoUsuarioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('grupos_usuarios', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intGrupoUsuarioID = NULL, $strDescripcion = NULL, $strEstatus = NULL, 
						   $strBusqueda = NULL)
	{
		$this->db->select('GU.grupo_usuario_id, GU.descripcion, GU.estatus, GUP.permisos');
		$this->db->from('grupos_usuarios AS GU');
		$this->db->join('grupos_usuarios_permisos AS GUP', 'GU.grupo_usuario_id = GUP.grupo_usuario_id', 'inner');
		//Si existe id del grupo de usuarios
		if ($intGrupoUsuarioID !== NULL)
		{
			$this->db->where('GU.grupo_usuario_id', $intGrupoUsuarioID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strDescripcion !== NULL)//Si existe descripción
		{
			$this->db->where('GU.descripcion', $strDescripcion);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{	
			//Si existe estatus
			if ($strEstatus !== NULL)
			{
				$this->db->where('GU.estatus', $strEstatus);
			}
			else
			{
				$this->db->like('descripcion', $strBusqueda);
				$this->db->or_like('estatus', $strBusqueda);
			}
			$this->db->order_by('GU.descripcion', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->like('descripcion', $strBusqueda);
		$this->db->or_like('estatus', $strBusqueda);
		$this->db->from('grupos_usuarios');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('grupo_usuario_id, descripcion, estatus');
		$this->db->like('descripcion', $strBusqueda);
		$this->db->or_like('estatus', $strBusqueda);
		$this->db->from('grupos_usuarios');
		$this->db->order_by('descripcion', 'ASC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["grupos"] =$this->db->get()->result();
		return $arrResultado;
	}

	/*******************************************************************************************************************
	Funciones de la tabla grupos_usuarios_permisos
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los permisos de acceso del grupo
	public function guardar_permisos_acceso(stdClass $objGrupoUsuario)
	{
		//Asignar datos al array
		$arrDatos = array('grupo_usuario_id' => $objGrupoUsuario->intGrupoUsuarioID,
						  'permisos' => $objGrupoUsuario->strPermisosAcceso);
		//Guardar los datos del registro
		$this->db->insert('grupos_usuarios_permisos', $arrDatos);
	}

	//Función que se utiliza para modificar los permisos de acceso del grupo
	public function modificar_permisos_acceso(stdClass $objGrupoUsuario)
	{
		//Asignar datos al array
		$arrDatos = array('permisos' => $objGrupoUsuario->strPermisosAcceso);
		$this->db->where('grupo_usuario_id', $objGrupoUsuario->intGrupoUsuarioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('grupos_usuarios_permisos', $arrDatos);

	}

	//Método para obtener los permisos de un grupo
	public function get_permisos($intGrupoUsuarioID = NULL)
	{
		//Seleccionar los subprocesos del proceso enviado como parámetro
		$this->db->select('grupo_usuario_id, permisos');
		$this->db->from('grupos_usuarios_permisos');
		$this->db->where('grupo_usuario_id', $intGrupoUsuarioID);
		return $this->db->get()->row();
	}
}
?>