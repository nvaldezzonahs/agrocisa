<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de mensajes (para guardar el mensaje que se envía a los usuarios)
include_once(APPPATH . 'models/administracion/Mensajes_model.php');

class Proveedores_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla proveedores
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objProveedor)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
	
		//Asignar código consecutivo
		$strCodigo = $this->get_codigo_consecutivo();
		//Tabla proveedores
		//Asignar datos al array
		$arrDatos = array('codigo' => $strCodigo, 
						  'razon_social' => $objProveedor->strRazonSocial,
						  'rfc' => $objProveedor->strRfc,
						  'regimen_fiscal_id' => $objProveedor->intRegimenFiscalID,
						  'nombre_comercial' => $objProveedor->strNombreComercial, 
						  'tipo_proveedor' => $objProveedor->strTipoProveedor, 
						  'telefono_principal' => $objProveedor->strTelefonoPrincipal,
						  'telefono_secundario' => $objProveedor->strTelefonoSecundario,
						  'correo_electronico' => $objProveedor->strCorreoElectronico,
						  'calle' => $objProveedor->strCalle,
						  'numero_exterior' => $objProveedor->strNumeroExterior,
						  'numero_interior' => $objProveedor->strNumeroInterior,
						  'colonia' => $objProveedor->strColonia,
						  'referencia' => $objProveedor->strReferencia,
						  'codigo_postal_id' => $objProveedor->intCodigoPostalID,
						  'localidad' => $objProveedor->strLocalidad,
						  'municipio_id' => $objProveedor->intMunicipioID,
						  'contacto_nombre' => $objProveedor->strContactoNombre,
						  'contacto_telefono' => $objProveedor->strContactoTelefono,
						  'contacto_extension' => $objProveedor->strContactoExtension,
						  'contacto_celular' => $objProveedor->strContactoCelular,
						  'contacto_correo_electronico' => $objProveedor->strContactoCorreoElectronico,
						  'dias_credito' => $objProveedor->intDiasCredito,
						  'limite_credito' => $objProveedor->intLimiteCredito,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objProveedor->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('proveedores', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objProveedor->intProveedorID = $this->db->insert_id();

		//Hacer un llamado al método para guardar las cuentas bancarias del proveedor
		$this->guardar_cuentas_bancarias($objProveedor);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$objProveedor->intProveedorID.'_'.$strCodigo;;
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objProveedor)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();
		//Tabla proveedores
		//Asignar datos al array
		$arrDatos = array('razon_social' => $objProveedor->strRazonSocial,
						  'rfc' => $objProveedor->strRfc,
						  'regimen_fiscal_id' => $objProveedor->intRegimenFiscalID,
						  'nombre_comercial' => $objProveedor->strNombreComercial, 
						  'tipo_proveedor' => $objProveedor->strTipoProveedor, 
						  'telefono_principal' => $objProveedor->strTelefonoPrincipal,
						  'telefono_secundario' => $objProveedor->strTelefonoSecundario,
						  'correo_electronico' => $objProveedor->strCorreoElectronico,
						  'calle' => $objProveedor->strCalle,
						  'numero_exterior' => $objProveedor->strNumeroExterior,
						  'numero_interior' => $objProveedor->strNumeroInterior,
						  'colonia' => $objProveedor->strColonia,
						  'referencia' => $objProveedor->strReferencia,
						  'codigo_postal_id' => $objProveedor->intCodigoPostalID,
						  'localidad' => $objProveedor->strLocalidad,
						  'municipio_id' => $objProveedor->intMunicipioID,
						  'contacto_nombre' => $objProveedor->strContactoNombre,
						  'contacto_telefono' => $objProveedor->strContactoTelefono,
						  'contacto_extension' => $objProveedor->strContactoExtension,
						  'contacto_celular' => $objProveedor->strContactoCelular,
						  'contacto_correo_electronico' => $objProveedor->strContactoCorreoElectronico,
						  'dias_credito' => $objProveedor->intDiasCredito,
						  'limite_credito' => $objProveedor->intLimiteCredito,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objProveedor->intUsuarioID);
		$this->db->where('proveedor_id', $objProveedor->intProveedorID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('proveedores', $arrDatos);

		//Eliminar las cuentas bancarias guardadas
		$this->db->where('proveedor_id', $objProveedor->intProveedorID);
		$this->db->delete('proveedores_cuentas_bancarias');

		//Hacer un llamado al método para guardar las cuentas bancarias del proveedor
		$this->guardar_cuentas_bancarias($objProveedor);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intProveedorID, $strEstatus)
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
		//Si el estatus del registro es VALIDACION
		else if($strEstatus == 'VALIDACION')
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
							  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'), 
							  'fecha_autorizacion' => NULL,
							  'usuario_autorizacion' => NULL);
		}
		$this->db->where('proveedor_id', $intProveedorID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('proveedores', $arrDatos);
	}

	//Método para enviar la autorización de un registro
	public function set_enviar_autorizacion($intProveedorID, $strUsuarios, $strMensaje, $strEstatus)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (Mensajes) 
        $otdModelMensajes = new  Mensajes_model();

		//Si existe estatus
		if($strEstatus !== NULL)
		{
			//Tabla proveedores
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_autorizacion' => date("Y-m-d H:i:s"),
							  'usuario_autorizacion' => $this->session->userdata('usuario_id'));
			$this->db->where('proveedor_id', $intProveedorID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('proveedores', $arrDatos);
		}
		
        //Hacer un llamado al método para guardar el mensaje que se envía a los usuarios
		$otdModelMensajes->guardar('PROVEEDORES', $intProveedorID, $strUsuarios, $strMensaje);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intProveedorID = NULL, $strRfc = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{
		$this->db->select("PV.proveedor_id, PV.codigo, PV.razon_social, PV.rfc, PV.regimen_fiscal_id, PV.nombre_comercial, 
						   PV.tipo_proveedor, PV.telefono_principal, PV.telefono_secundario, PV.correo_electronico,
						   PV.calle, PV.numero_exterior, PV.numero_interior, PV.colonia,  PV.referencia,
						   PV.codigo_postal_id, PV.localidad,  PV.municipio_id,  PV.contacto_nombre, 
						   PV.contacto_telefono, PV.contacto_extension, PV.contacto_celular, 
						   PV.contacto_correo_electronico, PV.dias_credito, PV.limite_credito, 
						   PV.estatus, C.codigo_postal, M.descripcion AS municipio, 
						   CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado, E.descripcion AS estado_rep,
						   CONCAT_WS(' - ', P.codigo, P.descripcion) AS pais, P.descripcion AS pais_rep, 
						   CONCAT_WS(' - ', RF.codigo, RF.descripcion) AS regimen_fiscal", FALSE);
		$this->db->from('proveedores AS PV');
		$this->db->join('sat_codigos_postales AS C', 'PV.codigo_postal_id = C.codigo_postal_id', 'inner');
		$this->db->join('municipios AS M', 'PV.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		$this->db->join('sat_regimen_fiscal AS RF', 'PV.regimen_fiscal_id = RF.regimen_fiscal_id', 'left');
		//Si existe id del proveedor
		if ($intProveedorID !== NULL)
		{   
			$this->db->where('PV.proveedor_id', $intProveedorID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strRfc !== NULL)//Si existe rfc
		{
			$this->db->where('PV.rfc', $strRfc);
			return $this->db->get()->result();
		}
		else 
		{
			//Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('PV.estatus', $strEstatus);
			}

			$this->db->where("(PV.codigo LIKE '%$strBusqueda%' OR 
		 				       PV.razon_social LIKE '%$strBusqueda%' OR 
		 				       PV.nombre_comercial LIKE '%$strBusqueda%' OR 
		 				       PV.tipo_proveedor LIKE '%$strBusqueda%' OR 
		 				       P.descripcion LIKE '%$strBusqueda%' OR 
		 				       E.descripcion LIKE '%$strBusqueda%' OR 
		 				       M.descripcion LIKE '%$strBusqueda%')"); 

			$this->db->order_by('PV.codigo', 'ASC');
			return $this->db->get()->result();
		}
	}
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strEstatus, $strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('PV.estatus', $strEstatus);
		}

		$this->db->where("(PV.codigo LIKE '%$strBusqueda%' OR 
		 				   PV.razon_social LIKE '%$strBusqueda%' OR 
		 				   PV.nombre_comercial LIKE '%$strBusqueda%' OR 
		 				   PV.tipo_proveedor LIKE '%$strBusqueda%' OR 
		 				   P.descripcion LIKE '%$strBusqueda%' OR 
		 				   E.descripcion LIKE '%$strBusqueda%' OR 
		 				   M.descripcion LIKE '%$strBusqueda%')"); 

		$this->db->from('proveedores AS PV');
		$this->db->join('sat_codigos_postales AS C', 'PV.codigo_postal_id = C.codigo_postal_id', 'inner');
		$this->db->join('municipios AS M', 'PV.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('PV.proveedor_id, PV.codigo, PV.nombre_comercial,  PV.tipo_proveedor,
						   PV.calle, PV.numero_exterior, PV.numero_interior, PV.colonia, PV.contacto_nombre, 
						   PV.estatus, PV.localidad,
						   M.descripcion AS municipio, 
	    				   E.descripcion AS estado, P.descripcion AS pais, C.codigo_postal');
		$this->db->from('proveedores AS PV');
		$this->db->join('sat_codigos_postales AS C', 'PV.codigo_postal_id = C.codigo_postal_id', 'inner');
		$this->db->join('municipios AS M', 'PV.municipio_id = M.municipio_id', 'inner');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'inner');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'inner');
		//Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('PV.estatus', $strEstatus);
		}

		$this->db->where("(PV.codigo LIKE '%$strBusqueda%' OR 
		 				   PV.razon_social LIKE '%$strBusqueda%' OR 
		 				   PV.nombre_comercial LIKE '%$strBusqueda%' OR 
		 				   PV.tipo_proveedor LIKE '%$strBusqueda%' OR 
		 				   P.descripcion LIKE '%$strBusqueda%' OR 
		 				   E.descripcion LIKE '%$strBusqueda%' OR 
		 				   M.descripcion LIKE '%$strBusqueda%')"); 
		$this->db->order_by('PV.codigo', 'ASC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["proveedores"] =$this->db->get()->result();
		return $arrResultado;
	}

	
	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select("proveedor_id, CONCAT_WS(' - ', codigo, razon_social) AS proveedor, 
						   dias_credito, rfc, razon_social, regimen_fiscal_id", FALSE);
		$this->db->from('proveedores');
		$this->db->where('estatus', 'ACTIVO');
		$this->db->where("((codigo LIKE '%$strDescripcion%') OR
						   (nombre_comercial LIKE '%$strDescripcion%') OR
						   (razon_social LIKE '%$strDescripcion%'))"); 
		$this->db->order_by("nombre_comercial",'ASC');  
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
		return $this->db->get()->result();
	}

	//Función que se utiliza para regresar el código consecutivo 
	public function get_codigo_consecutivo()
    {
   	    //Variable que se utiliza para asignar el código consecutivo
	  	$strCodigo = '';
   		//Seleccionar el código máximo de la tabla proveedores
	    $this->db->select("IFNULL(MAX(codigo),0) AS codigo", FALSE);
		$this->db->from('proveedores');
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
                $intConsecutivo = ($strCodigoMaximo + 1);

		    }
		}

	    //Concatenar al consecutivo el  incremento de ceros
        $strCodigo = str_pad($intConsecutivo, 5, "0", STR_PAD_LEFT);

		//Regresar código consecutivo
		return $strCodigo;
    }

    /*******************************************************************************************************************
	Funciones de la tabla proveedores_cuentas_bancarias
	*********************************************************************************************************************/
	//Función que se utiliza para guardar las cuentas bancarias del proveedor
	public function guardar_cuentas_bancarias(stdClass $objProveedor)
	{
		
		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener las cuentas bancarias del proveedor
		foreach ($objProveedor->arrCuentasBancarias as $arrCtas)
		{
			//Hacer recorrido para obtener los datos de la cuenta bancaria
			foreach ($arrCtas as $arrDet)
			{
				//Incrementar renglón consecutivo
				$intRenglon++;

			    //Asignar datos al array
				$arrDatos = array('proveedor_id' => $objProveedor->intProveedorID,
								  'renglon' => $intRenglon,
								  'banco_id' => $arrDet->intBancoID,
								  'cuenta' => $arrDet->strCuenta,
								  'clabe' => $arrDet->strClabe,
								  'moneda_id' => $arrDet->intMonedaID);
				//Guardar los datos del registro
				$this->db->insert('proveedores_cuentas_bancarias', $arrDatos);
			}
		}
	}

	//Método para regresar las cuentas bancarias de un registro
	public function buscar_cuentas_bancarias($intProveedorID)
	{
		$this->db->select("PCB.renglon, PCB.banco_id, PCB.cuenta, PCB.clabe, PCB.moneda_id,
						   CONCAT_WS(' - ', B.codigo, B.descripcion) AS banco,
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda", FALSE);
		$this->db->from('proveedores_cuentas_bancarias AS PCB');
		$this->db->join('sat_bancos AS B', 'PCB.banco_id = B.banco_id', 'inner');
		$this->db->join('sat_monedas AS M', 'PCB.moneda_id = M.moneda_id', 'inner');
		$this->db->where('PCB.proveedor_id', $intProveedorID);
		$this->db->order_by('PCB.renglon', 'ASC');
		return $this->db->get()->result();
	}
}
?>