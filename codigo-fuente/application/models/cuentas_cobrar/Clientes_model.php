<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla clientes
	*********************************************************************************************************************/
	//Método para modificar los datos generales de un registro previamente guardado
	public function modificar(stdClass $objCliente)
	{
		//Asignar datos al array
		$arrDatos = array('razon_social' => $objCliente->strRazonSocial, 
						  'tipo_persona' => $objCliente->strTipoPersona,
						  'rfc' => $objCliente->strRfc,
						  'regimen_fiscal_id' => $objCliente->intRegimenFiscalID,
						  'nombre_comercial' => $objCliente->strNombreComercial,
						  'representante_legal' => $objCliente->strRepresentanteLegal,
						  'telefono_principal' => $objCliente->strTelefonoPrincipal,
						  'telefono_secundario' => $objCliente->strTelefonoSecundario,
						  'correo_electronico' => $objCliente->strCorreoElectronico,
						  'calle' => $objCliente->strCalle,
						  'numero_exterior' => $objCliente->strNumeroExterior,
						  'numero_interior' => $objCliente->strNumeroInterior,
						  'codigo_postal_id' => $objCliente->intCodigoPostalID,
						  'colonia' => $objCliente->strColonia,
						  'localidad' => $objCliente->strLocalidad,
						  'referencia' => $objCliente->strReferencia,
						  'municipio_id' => $objCliente->intMunicipioID,
						  'contacto_nombre' => $objCliente->strContactoNombre,
						  'contacto_telefono' => $objCliente->strContactoTelefono,
						  'contacto_extension' => $objCliente->strContactoExtension,
						  'contacto_celular' => $objCliente->strContactoCelular,
						  'contacto_correo_electronico' => $objCliente->strContactoCorreoElectronico,
						  'estatus' => $objCliente->strEstatus,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objCliente->intUsuarioID);
		$this->db->where('prospecto_id', $objCliente->intProspectoID);        
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('clientes', $arrDatos); 
		
		
	}

	//Método para modificar los datos crediticios de un registro previamente guardado
	public function modificar_datos_crediticios(stdClass $objCliente)
	{
		//Asignar datos al array
		$arrDatos = array('credito_solicitud' => $objCliente->strCreditoSolicitud, 
						  'credito_inicio' => $objCliente->dteCreditoInicio,
						  'uso_cfdi_id' => $objCliente->intUsoCFDIID,
						  'dias_revision' => $objCliente->strDiasRevision,
						  'dias_pago' => $objCliente->strDiasPago,
						  'encargado_compras' => $objCliente->strEncargadoCompras,
						  'encargado_pagos' => $objCliente->strEncargadoPagos,
						  'comentarios_credito' => $objCliente->strComentariosCredito,
						  'maquinaria_credito_limite' => $objCliente->intMaquinariaCreditoLimite,
						  'maquinaria_credito_dias' => $objCliente->intMaquinariaCreditoDias,
						  'maquinaria_lista_precio_id' => $objCliente->intMaquinariaListaPrecioID,
						  'refacciones_credito_limite' => $objCliente->intRefaccionesCreditoLimite,
						  'refacciones_credito_dias' => $objCliente->intRefaccionesCreditoDias,
						  'refacciones_lista_precio_id' => $objCliente->intRefaccionesListaPrecioID,
						  'servicio_credito_limite' => $objCliente->intServicioCreditoLimite,
						  'servicio_credito_dias' => $objCliente->intServicioCreditoDias,
						  'servicio_lista_precio_id' => $objCliente->intServicioListaPrecioID,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objCliente->intUsuarioID);
		$this->db->where('prospecto_id', $objCliente->intProspectoID);        
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('clientes', $arrDatos); 
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intProspectoID, $strEstatus, $strMensaje = NULL)
	{
		//Si el estatus del registro es RECHAZADO
		if($strEstatus == 'RECHAZADO')
		{
			//Iniciamos la transacción
			$this->db->trans_begin();
			//Tabla clientes
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
			$this->db->where('prospecto_id', $intProspectoID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('clientes', $arrDatos);

			//Seleccionar el último mensaje de la referencia
			$this->db->select('usuario_creacion');
			$this->db->from('mensajes');
			$this->db->where("mensaje_id = (SELECT MAX(mensaje_id)
											FROM mensajes
											WHERE proceso = 'PROSPECTOS'
						                    AND referencia_id = $intProspectoID)", NULL, FALSE);
			$this->db->limit(1);
			//Hacer recorrido para insertar los datos en la tabla mensajes
			if ($row = $this->db->get()->row())
			{
				//Tabla mensajes
				//Asignar datos al array
	        	$arrDatos = array('proceso' => 'PROSPECTOS', 
	        					  'referencia_id' => $intProspectoID,
	        					  'para' => $row->usuario_creacion,
	        					  'mensaje' => $strMensaje,
	        					  'fecha_creacion' => date("Y-m-d H:i:s"),
							  	  'usuario_creacion' => $this->session->userdata('usuario_id'));
	        	//Guardar los datos del registro
				$this->db->insert('mensajes', $arrDatos);
			}

			//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
			if ($this->db->trans_status() === FALSE)
				$this->db->trans_rollback();
			else
				$this->db->trans_commit();

			//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
			return $this->db->trans_status();

		}
		else
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
			return $this->db->update('clientes', $arrDatos);
		}
	}


	//Método para modificar el régimen fiscal de una factura/anticipo (se utiliza para aquellos registros que ya se encuentran activos y son utilizados como referencia en otro proceso; por ejemplo: un anticipo activo que se selecciona en una aplicación y dicho anticipo no cuente con el id del régimen fiscal)
	public function set_regimen_fiscal($intReferenciaID,  $strTipoReferencia, $intRegimenFiscalID)
	{

		//Iniciamos la transacción
		$this->db->trans_begin();

		//Asignar datos al array
		$arrDatos = array('regimen_fiscal_id' => $intRegimenFiscalID,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'));

		//Dependiendo del tipo de referencia modificar id del régimen fiscal
		if($strTipoReferencia == 'ANTICIPO')
		{
			$this->db->where('anticipo_id', $intReferenciaID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('anticipos', $arrDatos);
		}
		else if($strTipoReferencia == 'REFACCIONES')
		{

			$this->db->where('factura_refacciones_id', $intReferenciaID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('facturas_refacciones', $arrDatos);

		}
		else if($strTipoReferencia == 'SERVICIO')
		{
			
			$this->db->where('factura_servicio_id', $intReferenciaID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('facturas_servicio', $arrDatos);
		}
		else if($strTipoReferencia == 'MAQUINARIA')
		{
			
			$this->db->where('factura_maquinaria_id', $intReferenciaID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('facturas_maquinaria', $arrDatos);
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
	public function buscar($intProspectoID = NULL,  $strEstatus = NULL, $strBusqueda = NULL)
	{
		$this->db->select("	C.prospecto_id,
							C.tipo_persona, 
							C.razon_social, 
							C.rfc, 
							C.regimen_fiscal_id, 
							C.nombre_comercial, 
							C.representante_legal,
						   	C.telefono_principal, 
						   	C.telefono_secundario, 
						   	C.correo_electronico, 
						   	C.calle, 
						   	C.numero_exterior, 
						   	C.numero_interior, 
						   	C.codigo_postal_id, 
						   	C.colonia, 
						   	C.localidad, 
						   	C.referencia, 
						   	C.municipio_id, 
						   	C.contacto_nombre, 
						   	C.contacto_telefono, 
						   	C.contacto_extension,
						   	C.contacto_celular, 
						   	C.contacto_correo_electronico, 
						   	C.credito_solicitud, 
						   	DATE_FORMAT(C.credito_inicio,'%d/%m/%Y') AS credito_inicio, 
						   	C.uso_cfdi_id,
						   	CONCAT_WS(' - ', U.codigo, U.descripcion) AS uso_cfdi, 
						   	C.dias_revision, 
						   	C.dias_pago, 
						   	C.encargado_compras,
						   	C.encargado_pagos, 
						   	FORMAT(C.maquinaria_credito_limite, 2) AS maquinaria_credito_limite,
						   	C.maquinaria_credito_limite AS maquinaria_credito_limite_rep,
						   	C.maquinaria_credito_dias,
						   	C.maquinaria_lista_precio_id, 
						   	FORMAT(C.refacciones_credito_limite, 2) AS refacciones_credito_limite,
						   	C.refacciones_credito_limite AS refacciones_credito_limite_rep,
						   	C.refacciones_credito_dias, 
						   	C.refacciones_lista_precio_id, 
						   	FORMAT(C.servicio_credito_limite, 2) AS servicio_credito_limite,
						   	C.servicio_credito_limite AS servicio_credito_limite_rep, 
						   	C.servicio_credito_dias,
						   	C.servicio_lista_precio_id,
						   	C.comentarios_credito, 
						   	C.estatus, 
						   	PP.codigo, M.descripcion AS municipio,
						   	CONCAT_WS(' - ', E.codigo, E.descripcion) AS estado,
						   	CONCAT_WS(' - ', P.codigo, P.descripcion) AS pais, E.descripcion AS estado_rep,
						   	P.descripcion AS pais_rep, CP.codigo_postal, MLP.descripcion AS maquinaria_lista_precio,
						   	RLP.descripcion AS refacciones_lista_precio,
						   	SRLP.descripcion AS servicio_lista_precio,
						   	CONCAT_WS(' - ', RF.codigo, RF.descripcion) AS regimen_fiscal,
						   	DATE_FORMAT(C.fecha_creacion,'%d/%m/%Y') AS fecha_creacion", FALSE);
		$this->db->from('clientes AS C');
		$this->db->join('prospectos AS PP', 'C.prospecto_id = PP.prospecto_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'C.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('sat_uso_cfdi AS U', 'U.uso_cfdi_id = C.uso_cfdi_id', 'left');
		$this->db->join('municipios AS M', 'C.municipio_id = M.municipio_id', 'left');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'left');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'left');
		$this->db->join('maquinaria_listas_precios AS MLP', 'C.maquinaria_lista_precio_id = MLP.maquinaria_lista_precio_id', 'left');
		$this->db->join('refacciones_listas_precios AS RLP', 'C.refacciones_lista_precio_id = RLP.refacciones_lista_precio_id', 'left');
		$this->db->join('refacciones_listas_precios AS SRLP', 'C.servicio_lista_precio_id = SRLP.refacciones_lista_precio_id', 'left');
		$this->db->join('sat_regimen_fiscal AS RF', 'C.regimen_fiscal_id = RF.regimen_fiscal_id', 'left');
		//Si existe id del prospecto
		if ($intProspectoID !== NULL)
		{   
			$this->db->where('C.prospecto_id', $intProspectoID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			//Si existe estatus
			if($strEstatus !== NULL)
			{
				$this->db->where('C.estatus', $strEstatus);
			}
			else
			{
				$this->db->where("(C.estatus = 'ACTIVO'  OR C.estatus = 'INACTIVO')", NULL, FALSE);
			}

			$this->db->where("(PP.codigo LIKE '%$strBusqueda%' OR 
	    					   C.nombre_comercial LIKE '%$strBusqueda%' OR
	    					   C.contacto_nombre LIKE '%$strBusqueda%' OR
	    					   C.localidad LIKE '%$strBusqueda%' OR
	    					   M.descripcion LIKE '%$strBusqueda%' OR
	    					   E.descripcion LIKE '%$strBusqueda%' OR
	    					   P.descripcion LIKE '%$strBusqueda%')");
			$this->db->order_by('PP.codigo', 'ASC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los vendedores de un cliente
	public function buscar_vendedores_cliente($intProspectoID)
	{
		$this->db->select("CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) AS vendedor,
	   					   M.descripcion AS modulo", FALSE);
		$this->db->from('clientes AS C');
		$this->db->join('prospectos AS PP', 'C.prospecto_id = PP.prospecto_id', 'inner');
		$this->db->join('localidades AS L', 'PP.localidad_id = L.localidad_id', 'inner');
		$this->db->join('zonas_localidades AS ZL', 'L.localidad_id = ZL.localidad_id', 'inner');
		$this->db->join('zonas AS Z', 'ZL.zona_id = Z.zona_id', 'inner');
		$this->db->join('vendedores AS V', 'Z.vendedor_id = V.vendedor_id', 'inner');
		$this->db->join('modulos AS M', 'V.modulo_id = M.modulo_id', 'inner');
		$this->db->join('empleados AS E', 'V.empleado_id = E.empleado_id', 'inner');
		$this->db->where('PP.prospecto_id', $intProspectoID);
		$this->db->where('V.estatus', 'ACTIVO');
		$this->db->order_by('M.descripcion', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $strEstatus = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe estatus
		if( $strEstatus !== NULL)
		{
			$this->db->where('C.estatus', $strEstatus);
		}
		else
		{
			$this->db->where("(C.estatus = 'ACTIVO'  OR C.estatus = 'INACTIVO')", NULL, FALSE);
		}
        $this->db->where("(PP.codigo LIKE '%$strBusqueda%' OR 
    					   C.nombre_comercial LIKE '%$strBusqueda%' OR
    					   C.contacto_nombre LIKE '%$strBusqueda%' OR
    					   C.localidad LIKE '%$strBusqueda%' OR
    					   M.descripcion LIKE '%$strBusqueda%' OR
    					   E.descripcion LIKE '%$strBusqueda%' OR
    					   P.descripcion LIKE '%$strBusqueda%')");  
		$this->db->from('clientes AS C');
		$this->db->join('prospectos AS PP', 'C.prospecto_id = PP.prospecto_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'C.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('municipios AS M', 'C.municipio_id = M.municipio_id', 'left');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'left');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('C.prospecto_id, PP.codigo, C.nombre_comercial, C.calle, C.numero_exterior, 
						   C.numero_interior, C.colonia, C.localidad, C.contacto_nombre, C.estatus,
						   CP.codigo_postal, M.descripcion AS municipio, E.descripcion AS estado, 
						   P.descripcion AS pais');
		$this->db->from('clientes AS C');
		$this->db->join('prospectos AS PP', 'C.prospecto_id = PP.prospecto_id', 'inner');
		$this->db->join('sat_codigos_postales AS CP', 'C.codigo_postal_id = CP.codigo_postal_id', 'left');
		$this->db->join('municipios AS M', 'C.municipio_id = M.municipio_id', 'left');
		$this->db->join('sat_estados AS E', 'M.estado_id = E.estado_id', 'left');
		$this->db->join('sat_paises AS P', 'E.pais_id = P.pais_id', 'left');
		//Si existe estatus
		if( $strEstatus !== NULL)
		{
			$this->db->where('C.estatus', $strEstatus);
		}
		else
		{
			$this->db->where("(C.estatus = 'ACTIVO'  OR C.estatus = 'INACTIVO')", NULL, FALSE);
		}
        $this->db->where("(PP.codigo LIKE '%$strBusqueda%' OR 
    					   C.nombre_comercial LIKE '%$strBusqueda%' OR
    					   C.contacto_nombre LIKE '%$strBusqueda%' OR
    					   C.localidad LIKE '%$strBusqueda%' OR
    					   M.descripcion LIKE '%$strBusqueda%' OR
    					   E.descripcion LIKE '%$strBusqueda%' OR
    					   P.descripcion LIKE '%$strBusqueda%')");
        $this->db->order_by('PP.codigo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["clientes"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strTipo = NULL)
	{
		$this->db->select('C.prospecto_id, C.nombre_comercial, C.razon_social,  
						  	IFNULL(C.regimen_fiscal_id, 0) AS regimen_fiscal_id, 
						   C.telefono_principal, C.refacciones_lista_precio_id, 
						   C.estatus, PP.codigo');
        $this->db->from('clientes AS C');
        $this->db->join('prospectos AS PP', 'C.prospecto_id = PP.prospecto_id', 'inner');
        //Si el Autocomplete se muestra en los reportes de saldos (facturas)
		if($strTipo == 'saldos')
		{
			 $this->db->where("(C.estatus = 'ACTIVO' OR
	        				    C.estatus = 'INACTIVO')"); 
		}
		else
		{
			$this->db->where('C.estatus', 'ACTIVO');
		}
        $this->db->where("((PP.codigo LIKE '%$strDescripcion%') OR 
        					(C.nombre_comercial LIKE '%$strDescripcion%') OR 
         					(C.razon_social LIKE '%$strDescripcion%') OR 
        				    (CONCAT_WS(' ', C.nombre_comercial, C.razon_social) LIKE '%$strDescripcion%') OR
			                (CONCAT_WS(' ', C.razon_social, C.nombre_comercial) LIKE '%$strDescripcion%'))"); 
		$this->db->order_by('C.razon_social', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla clientes_referencias
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_referencias($intProspectoID, $strNombre, $strContacto, $strTelefono, $strExtension, 
									   $strCalificacion, $strTipo, $strClienteDesde, $strManejaCredito,
							           $intImporteCredito, $intPlazoCredito, $strFormaPago, $strChequeSinFondos, 
							           $strAtrasos, $strGarantiaAdicional, $strExperienciaGeneral, $strTipoServicio, $strComentarios, 
							           $strNombreReferencia, $strPuestoReferencia)
	{
		//Asignar renglón consecutivo de la referencia
		$intRenglon = $this->get_renglon_consecutivo_referencias($intProspectoID);
		//Asignar datos al array
		$arrDatos = array('prospecto_id' => $intProspectoID, 
						  'renglon' => $intRenglon, 
						  'nombre' => $strNombre,
						  'contacto' => $strContacto,  
						  'telefono' => $strTelefono,
						  'extension' => $strExtension,  
						  'calificacion' => $strCalificacion, 
						  'tipo' => $strTipo, 
						  'cliente_desde' => $strClienteDesde,
						  'maneja_credito' => $strManejaCredito, 
						  'importe_credito' => $intImporteCredito,  
						  'plazo_credito' => $intPlazoCredito, 
						  'forma_pago' => $strFormaPago, 
						  'cheque_sin_fondos' => $strChequeSinFondos,
						  'atrasos' => $strAtrasos,
						  'garantia_adicional' => $strGarantiaAdicional,
						  'experiencia_general' => $strExperienciaGeneral,
						  'tipo_servicio' => $strTipoServicio,
						  'comentarios' => $strComentarios,
						  'nombre_referencia' => $strNombreReferencia,
						  'puesto_referencia' => $strPuestoReferencia,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		return $this->db->insert('clientes_referencias', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_referencias($intProspectoID, $intRenglon, $strNombre, $strContacto, $strTelefono, 
										 $strExtension, $strCalificacion, $strTipo, $strClienteDesde, 
										 $strManejaCredito, $intImporteCredito, $intPlazoCredito, $strFormaPago, 
										 $strChequeSinFondos, $strAtrasos, $strGarantiaAdicional, $strExperienciaGeneral, $strTipoServicio, 
										 $strComentarios, $strNombreReferencia, $strPuestoReferencia)
	{
		//Asignar datos al array
		$arrDatos = array('nombre' => $strNombre,
						  'contacto' => $strContacto,  
						  'telefono' => $strTelefono,
						  'extension' => $strExtension,  
						  'calificacion' => $strCalificacion, 
						  'tipo' => $strTipo, 
						  'cliente_desde' => $strClienteDesde,
						  'maneja_credito' => $strManejaCredito, 
						  'importe_credito' => $intImporteCredito,  
						  'plazo_credito' => $intPlazoCredito, 
						  'forma_pago' => $strFormaPago, 
						  'cheque_sin_fondos' => $strChequeSinFondos,
						  'atrasos' => $strAtrasos,
						  'garantia_adicional' => $strGarantiaAdicional,
						  'experiencia_general' => $strExperienciaGeneral,
						  'tipo_servicio' => $strTipoServicio,
						  'comentarios' => $strComentarios,
						  'nombre_referencia' => $strNombreReferencia,
						  'puesto_referencia' => $strPuestoReferencia, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('prospecto_id', $intProspectoID);
		$this->db->where('renglon', $intRenglon);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('clientes_referencias', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus_referencias($intProspectoID, $intRenglon, $strEstatus)
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
		$this->db->where('renglon', $intRenglon);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('clientes_referencias', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_referencias($intProspectoID, $intRenglon = NULL, $strNombre = NULL)
	{
		$this->db->select('renglon, nombre, contacto, telefono, extension, calificacion, tipo, cliente_desde,
						   maneja_credito, importe_credito, plazo_credito, forma_pago, cheque_sin_fondos, atrasos, garantia_adicional,
						   experiencia_general, tipo_servicio, comentarios, nombre_referencia, puesto_referencia, estatus');
		$this->db->from('clientes_referencias');
		//Si existe nombre
		if ($strNombre !== NULL)
		{   
			$this->db->where('prospecto_id', $intProspectoID);
			$this->db->where('nombre', $strNombre);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->where('prospecto_id', $intProspectoID);
			$this->db->where('renglon', $intRenglon);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_referencias($intProspectoID, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('prospecto_id', $intProspectoID);
		$this->db->from('clientes_referencias');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('renglon, nombre, tipo, calificacion, estatus');
		$this->db->from('clientes_referencias');
		$this->db->where('prospecto_id', $intProspectoID);
		$this->db->order_by('nombre','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["referencias"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Función que se utiliza para regresar el renglón consecutivo 
	public function get_renglon_consecutivo_referencias($intProspectoID)
	{
		//Variable que se utiliza para asignar el id del renglón 
	  	$intRenglon = 0;
	    //Seleccionar el renglón máximo que coincide con el id del prospecto 
		//en la tabla clientes_referencias
	    $this->db->select('MAX(renglon) AS renglon');
		$this->db->from('clientes_referencias');
		$this->db->where('prospecto_id', $intProspectoID);
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
	Funciones de la tabla clientes_personas_autorizadas
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_personas_autorizadas($intProspectoID, $intRenglon, $strNombre)
	{
		
		//Asignar datos al array
		$arrDatos = array('prospecto_id' => $intProspectoID, 
						  'renglon' => $intRenglon, 
						  'nombre' => $strNombre,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		return $this->db->insert('clientes_personas_autorizadas', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_personas_autorizadas($intProspectoID, $intRenglon, $strNombre)
	{
		//Asignar datos al array
		$arrDatos = array('nombre' => $strNombre, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('prospecto_id', $intProspectoID);
		$this->db->where('renglon', $intRenglon);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('clientes_personas_autorizadas', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus_personas_autorizadas($intProspectoID, $intRenglon, $strEstatus)
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
		$this->db->where('renglon', $intRenglon);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('clientes_personas_autorizadas', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_personas_autorizadas($intProspectoID, $intRenglon = NULL, $strNombre = NULL)
	{
		$this->db->select('renglon, nombre, estatus');
		$this->db->from('clientes_personas_autorizadas');
		//Si existe nombre
		if ($strNombre !== NULL)
		{   
			$this->db->where('prospecto_id', $intProspectoID);
			$this->db->where('nombre', $strNombre);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->where('prospecto_id', $intProspectoID);
			$this->db->where('renglon', $intRenglon);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_personas_autorizadas($intProspectoID, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('prospecto_id', $intProspectoID);
		$this->db->from('clientes_personas_autorizadas');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('renglon, nombre, estatus');
		$this->db->from('clientes_personas_autorizadas');
		$this->db->where('prospecto_id', $intProspectoID);
		$this->db->order_by('nombre','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["personas"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Función que se utiliza para regresar el renglón consecutivo 
	public function get_renglon_consecutivo_personas_autorizadas($intProspectoID)
	{
		//Variable que se utiliza para asignar el id del renglón 
	  	$intRenglon = 0;
	    //Seleccionar el renglón máximo que coincide con el id del prospecto 
		//en la tabla clientes_personas_autorizadas
	    $this->db->select('MAX(renglon) AS renglon');
		$this->db->from('clientes_personas_autorizadas');
		$this->db->where('prospecto_id', $intProspectoID);
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
	Funciones de la tabla clientes_cuentas_bancarias
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_cuentas_bancarias($intProspectoID, $intBancoID, $strCuenta)
	{
		//Asignar renglón consecutivo de la cuenta bancaria
		$intRenglon = $this->get_renglon_consecutivo_cuentas_bancarias($intProspectoID);
		//Asignar datos al array
		$arrDatos = array('prospecto_id' => $intProspectoID, 
						  'renglon' => $intRenglon, 
						  'banco_id' => $intBancoID,
						  'cuenta' => $strCuenta,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		return $this->db->insert('clientes_cuentas_bancarias', $arrDatos);
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar_cuentas_bancarias($intProspectoID, $intRenglon, $intBancoID, $strCuenta)
	{
		//Asignar datos al array
		$arrDatos = array('banco_id' => $intBancoID,
						  'cuenta' => $strCuenta,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('prospecto_id', $intProspectoID);
		$this->db->where('renglon', $intRenglon);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('clientes_cuentas_bancarias', $arrDatos);
	}

	//Método para modificar el estatus de un registro
	public function set_estatus_cuentas_bancarias($intProspectoID, $intRenglon, $strEstatus)
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
		$this->db->where('renglon', $intRenglon);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('clientes_cuentas_bancarias', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_cuentas_bancarias($intProspectoID, $intRenglon = NULL, $strCuenta = NULL)
	{
		$this->db->select("CB.renglon, CB.banco_id, CB.cuenta, CB.estatus, 
						   CONCAT_WS(' - ', B.codigo, B.descripcion) AS banco", FALSE);
		$this->db->from('clientes_cuentas_bancarias AS CB');
		$this->db->join('sat_bancos AS B', 'CB.banco_id = B.banco_id', 'inner');
		//Si existe cuenta bancaria
		if ($strCuenta !== NULL)
		{   
			$this->db->where('CB.prospecto_id', $intProspectoID);
			$this->db->where('CB.cuenta', $strCuenta);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->where('CB.prospecto_id', $intProspectoID);
			$this->db->where('CB.renglon', $intRenglon);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_cuentas_bancarias($intProspectoID, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('CB.prospecto_id', $intProspectoID);
		$this->db->from('clientes_cuentas_bancarias AS CB');
		$this->db->join('sat_bancos AS B', 'CB.banco_id = B.banco_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CB.renglon, CB.cuenta, CB.estatus,
						   CONCAT_WS(' - ', B.codigo, B.descripcion) AS banco", FALSE);
		$this->db->from('clientes_cuentas_bancarias AS CB');
		$this->db->join('sat_bancos AS B', 'CB.banco_id = B.banco_id', 'inner');
		$this->db->where('CB.prospecto_id', $intProspectoID);
		$this->db->order_by('B.codigo','ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["cuentas"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete_cuentas_bancarias($intProspectoID, $strDescripcion)
	{
		$this->db->select("	CB.cuenta, CB.banco_id,
							CONCAT_WS(' - ', B.codigo, B.descripcion) AS banco,
							B.razon_social AS razon_social_banco, 
						   	B.rfc AS rfc_banco", FALSE);
        $this->db->from('clientes_cuentas_bancarias AS CB');
        $this->db->join('sat_bancos AS B', 'CB.banco_id = B.banco_id', 'inner');
        $this->db->where('CB.prospecto_id', $intProspectoID);
        $this->db->where('CB.estatus', 'ACTIVO');
        $this->db->where("(CB.cuenta LIKE '%$strDescripcion%')"); 
		$this->db->order_by('CB.cuenta', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	//Función que se utiliza para regresar el renglón consecutivo 
	public function get_renglon_consecutivo_cuentas_bancarias($intProspectoID)
	{
		//Variable que se utiliza para asignar el id del renglón 
	  	$intRenglon = 0;
	    //Seleccionar el renglón máximo que coincide con el id del prospecto 
		//en la tabla clientes_cuentas_bancarias
	    $this->db->select('MAX(renglon) AS renglon');
		$this->db->from('clientes_cuentas_bancarias');
		$this->db->where('prospecto_id', $intProspectoID);
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

	//Método para regresar los datos crediticios de un Cliente
	public function buscar_datos_crediticios($intProspectoID)
	{
		
		$this->db->select(" maquinaria_credito_dias,
							maquinaria_credito_limite,
					        refacciones_credito_dias,
					        refacciones_credito_limite,
					        servicio_credito_dias,
					        servicio_credito_limite", FALSE);
		$this->db->from('clientes');
		$this->db->where('prospecto_id', $intProspectoID);

		return $this->db->get()->row();

	}

}
?>