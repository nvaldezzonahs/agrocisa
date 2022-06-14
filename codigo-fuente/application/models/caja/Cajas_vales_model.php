<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de mensajes (para guardar el mensaje que se envía a los usuarios)
include_once(APPPATH . 'models/administracion/Mensajes_model.php');

class Cajas_vales_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla cajas_vales
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objCajaVale)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		//Variable que se utiliza para asignar el id del nuevo registro
		$intCajaValeID = 0;
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objCajaVale->strFolio); 

		//Tabla cajas_vales
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $objCajaVale->intSucursalID,
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => $objCajaVale->dteFecha, 
						  'tipo_vale' => $objCajaVale->strTipoVale, 
						  'cuenta_bancaria_id' => $objCajaVale->intCuentaBancariaID, 
						  'tipo_referencia' => $objCajaVale->strTipoReferencia, 
						  'referencia_id' => $objCajaVale->intReferenciaID, 
						  'sucursal_gasto' => $objCajaVale->intSucursalGasto,
						  'departamento_id' => $objCajaVale->intDepartamentoID,
						  'concepto' => $objCajaVale->strConcepto,
						  'importe' => $objCajaVale->intImporte,
						  'observaciones' => $objCajaVale->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objCajaVale->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('cajas_vales', $arrDatos);
		//Asignar id del nuevo registro en la base de datos
		$intCajaValeID  = $this->db->insert_id();

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intCajaValeID.'_'.$strFolioConsecutivo;
	}

	//Método para guardar el cierre de caja
	public function guardar_cierre_caja(stdClass $objCajaVale)
	{
		//Asignar datos al array
		$arrDatos = array('caja_corte_id' => $objCajaVale->intCajaCorteID, 
						  'fecha_actualizacion' => $objCajaVale->dteFecha,
						  'usuario_actualizacion' => $objCajaVale->intUsuarioID);
		$this->db->where('sucursal_id', $objCajaVale->intSucursalID);
		$this->db->where('caja_corte_id IS NULL');
		$this->db->where('estatus', 'CERRADO');

		//Actualizar los datos del registro
		return $this->db->update('cajas_vales', $arrDatos);
	}

	//Método para cancelar el cierre de caja
	public function set_cancelar_cierre_caja(stdClass $objCajaVale)
	{
	    //Asignar datos al array
		$arrDatos = array('caja_corte_id' => NULL, 
						  'fecha_actualizacion' => $objCajaVale->dteFecha,
						  'usuario_actualizacion' => $objCajaVale->intUsuarioID);
		$this->db->where('caja_corte_id', $objCajaVale->intCajaCorteID);
		//Actualizar los datos del registro
	    return $this->db->update('cajas_vales', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objCajaVale)
	{
		//Asignar datos al array
		$arrDatos = array('fecha' => $objCajaVale->dteFecha, 
						  'tipo_vale' => $objCajaVale->strTipoVale, 
						  'cuenta_bancaria_id' => $objCajaVale->intCuentaBancariaID, 
						  'tipo_referencia' => $objCajaVale->strTipoReferencia, 
						  'referencia_id' => $objCajaVale->intReferenciaID, 
						  'sucursal_gasto' => $objCajaVale->intSucursalGasto,
						  'departamento_id' => $objCajaVale->intDepartamentoID,
						  'concepto' => $objCajaVale->strConcepto,
						  'importe' => $objCajaVale->intImporte,
						  'observaciones' => $objCajaVale->strObservaciones,
						  'estatus' => 'ACTIVO', 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objCajaVale->intUsuarioID);
		$this->db->where('caja_vale_id', $objCajaVale->intCajaValeID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('cajas_vales', $arrDatos);
	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intCajaValeID, $strEstatus)
	{
		//Si el estatus del registro es ACTIVO o CERRADO
		if($strEstatus == 'ACTIVO' OR $strEstatus == 'CERRADO')
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
		$this->db->where('caja_vale_id', $intCajaValeID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('cajas_vales', $arrDatos);
	}

	//Método para enviar la autorización (o rechazo) de un registro
	public function set_enviar_autorizacion($intCajaValeID, $strUsuarios, $strMensaje, $strEstatus)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (Mensajes) 
        $otdModelMensajes = new  Mensajes_model();

		//Si existe estatus
		if($strEstatus !== NULL)
		{
			//Tabla cajas_vales
			//Si el estatus del registro es AUTORIZADO
			if($strEstatus == 'AUTORIZADO')
			{
				//Asignar datos al array
				$arrDatos = array('estatus' => $strEstatus,
								  'fecha_autorizacion' => date("Y-m-d H:i:s"),
								  'usuario_autorizacion' => $this->session->userdata('usuario_id'));
			}
			else
			{
				//Asignar datos al array
				$arrDatos = array('estatus' => $strEstatus,
								  'fecha_actualizacion' => date("Y-m-d H:i:s"),
								  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
			}
			$this->db->where('caja_vale_id', $intCajaValeID);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('cajas_vales', $arrDatos);
		}
		
		//Hacer un llamado al método para guardar el mensaje que se envía a los usuarios
		$otdModelMensajes->guardar('VALES DE CAJA CHICA', $intCajaValeID, $strUsuarios, $strMensaje);
        
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intCajaValeID = NULL, $intCajaCorteID = NULL, $strTipoCajaCorte = NULL,  
						   $dteFechaInicial = NULL, $dteFechaFinal = NULL, $strTipoReferencia = NULL, 
						   $intReferenciaID = NULL, $intSucursalGastoID = NULL, $strEstatus = NULL, 
						   $strBusqueda =  NULL)
	{

			//Si el tipo de corte de caja es ARQUEO
			if($strTipoCajaCorte == 'ARQUEO')
			{
				$strCamposImportes = " CCAV.importe,  CCAVD.importe AS importe_devolucion";
			}
			else
			{
				$strCamposImportes = " CV.importe, ";
				$strCamposImportes .= "(SELECT SUM(CVD.subtotal + CVD.iva + CVD.ieps)
											    FROM cajas_vales_detalles AS CVD 
											    WHERE CVD.caja_vale_id = CV.caja_vale_id
											    AND CVD.tipo = 'DEVOLUCION') AS importe_devolucion";
				
			}

			//Seleccionar los registros que coincidan con los criterios de búsqueda
			$this->db->select("CV.caja_vale_id, CV.folio, 
							   DATE_FORMAT(CV.fecha,'%d/%m/%Y') AS fecha, CV.tipo_vale, CV.cuenta_bancaria_id,
							   CV.tipo_referencia, CV.referencia_id, CV.sucursal_gasto, CV.departamento_id, 
							   CV.concepto,  CV.observaciones, 
							   IFNULL(CV.caja_corte_id, 0) AS caja_corte_id, CV.estatus,
							   CASE 
								   WHEN  CV.tipo_referencia = 'PROVEEDOR'
								   		THEN  CONCAT_WS(' - ', P.codigo, P.razon_social)
								   ELSE CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre)
							   END AS referencia,
							   S.nombre AS sucursal, D.descripcion AS departamento,
							   CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria,
							   $strCamposImportes, 
							   (SELECT COUNT(CVD.renglon)
							    FROM cajas_vales_detalles AS CVD
							    WHERE CVD.caja_vale_id = CV.caja_vale_id) AS total_detalles, 
							    UC.usuario AS usuario_creacion, 
						   	    UA.usuario AS usuario_autorizacion,
						   	    DATE_FORMAT(CV.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
			$this->db->from('cajas_vales AS CV');
			$this->db->join('sucursales AS S', 'CV.sucursal_gasto = S.sucursal_id', 'left');
			$this->db->join('departamentos AS D', 'CV.departamento_id = D.departamento_id', 'left');
			$this->db->join('cuentas_bancarias AS CB', 'CV.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'left');
			$this->db->join('empleados AS E', 'CV.referencia_id = E.empleado_id 
							 AND CV.tipo_referencia = "EMPLEADO"', 'left');
			$this->db->join('proveedores AS P', 'CV.referencia_id = P.proveedor_id  
							 AND CV.tipo_referencia = "PROVEEDOR"', 'left');
			$this->db->join('usuarios AS UC', 'CV.usuario_creacion = UC.usuario_id', 'left');
			$this->db->join('usuarios AS UA', 'CV.usuario_autorizacion = UA.usuario_id', 'left');
			$this->db->where('CV.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id del vale de caja
		    if ($intCajaValeID !== NULL)
			{   
				$this->db->where('CV.caja_vale_id', $intCajaValeID);
				$this->db->limit(1);
				return $this->db->get()->row();
			}
			else if ($intCajaCorteID !== NULL)//Si existe id del corte de caja
			{
				//Si el tipo de corte de caja es ARQUEO
				if($strTipoCajaCorte == 'ARQUEO')
				{
					$this->db->join('cajas_corte_arqueos AS CCAV', 
							        'CV.caja_vale_id = CCAV.referencia_id AND CCAV.tipo = "VALE"', 'inner');
					$this->db->join('cajas_corte_arqueos AS CCAVD', 
							        'CV.caja_vale_id = CCAVD.referencia_id AND CCAVD.tipo = "DEVOLUCION"
							         AND CCAVD.caja_corte_id = '.$intCajaCorteID, 'left');
					$this->db->where('CCAV.caja_corte_id', $intCajaCorteID);
				}
				else
				{
					$this->db->where('CV.caja_corte_id', $intCajaCorteID);
				}
				
				$this->db->order_by('D.descripcion, CV.tipo_referencia, CV.referencia_id, CV.fecha, CV.folio');
				return $this->db->get()->result();
			}
			else
			{
				
				//Si existe id de la referencia
			    if($strTipoReferencia != 'TODOS')
			    {	
			    	$this->db->where('CV.tipo_referencia', $strTipoReferencia);
			    	$this->db->where('CV.referencia_id', $intReferenciaID);
			   		
			    }

			    //Si existe id de la sucursal
			    if($intSucursalGastoID > 0)
			    {
			   		$this->db->where('CV.sucursal_gasto', $intSucursalGastoID);
			    }

			    //Si existe estatus
				if($strEstatus != 'TODOS')
				{
					$this->db->where('CV.estatus', $strEstatus);
				}

				//Si existe rango de fechas
			    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
			    {
			   		$this->db->where("(CV.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
			    } 

			    $this->db->where("((CV.folio LIKE '%$strBusqueda%') OR
			    				   (D.descripcion LIKE '%$strBusqueda%') OR
			    				   (S.nombre LIKE '%$strBusqueda%') OR
			    				   (CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
				        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
							       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
							       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
							       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
							       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
							       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
							       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR 
							       (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

				$this->db->order_by('CV.fecha DESC, CV.folio DESC');
				return $this->db->get()->result();
			}
	}

	//Método para regresar los registros que se encuentran cerrados (se utilizan para guardar un arqueo de caja)
	public function buscar_vales_arqueo_caja()
	{
		$this->db->select("CV.caja_vale_id, CV.importe, 
						   IFNULL((SELECT SUM(CVD.subtotal)
								   FROM cajas_vales_detalles AS CVD 
								   WHERE CV.caja_vale_id = CVD.caja_vale_id
								   AND CVD.tipo = 'DEVOLUCION'),0) AS importe_devolucion", FALSE);
		$this->db->from('cajas_vales AS CV');
		$this->db->where('CV.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('CV.caja_corte_id IS NULL');
		$this->db->where('CV.tipo_vale', 'FONDO DE CAJA');
		$this->db->where('CV.estatus', 'CERRADO');
		return $this->db->get()->result();
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $strTipoReferencia = NULL,
						   $intReferenciaID = NULL,  $intSucursalGastoID = NULL,  
						   $strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('CV.sucursal_id', $this->session->userdata('sucursal_id'));

		//Si existe id de la referencia
	    if($strTipoReferencia != NULL)
	    {	
	    	$this->db->where('CV.tipo_referencia', $strTipoReferencia);
	    	$this->db->where('CV.referencia_id', $intReferenciaID);
	    }
	    //Si existe id de la sucursal
	    if($intSucursalGastoID != NULL)
	    {
	   		$this->db->where('CV.sucursal_gasto', $intSucursalGastoID);
	    }
	  	//Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('CV.estatus', $strEstatus);
		}
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(CV.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    $this->db->where("((CV.folio LIKE '%$strBusqueda%') OR
	    				   (D.descripcion LIKE '%$strBusqueda%') OR
	    				   (S.nombre LIKE '%$strBusqueda%') OR
	    				   (CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
		        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->from('cajas_vales AS CV');
		$this->db->join('sucursales AS S', 'CV.sucursal_gasto = S.sucursal_id', 'left');
		$this->db->join('departamentos AS D', 'CV.departamento_id = D.departamento_id', 'left');
		$this->db->join('empleados AS E', 'CV.referencia_id = E.empleado_id', 'left');
		$this->db->join('proveedores AS P', 'CV.referencia_id = P.proveedor_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CV.caja_vale_id, CV.folio, DATE_FORMAT(CV.fecha,'%d/%m/%Y') AS fecha,
						   CV.tipo_referencia, CV.referencia_id, CV.caja_corte_id, CV.estatus,
						   CASE 
							   WHEN  CV.tipo_referencia = 'PROVEEDOR'
							   		THEN  CONCAT_WS(' - ', P.codigo, P.razon_social)
							   ELSE CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre)
						   END AS referencia,
						   CONCAT('$',FORMAT(CV.importe,2)) AS importe,
						   (SELECT COUNT(CVD.renglon)
						    FROM cajas_vales_detalles AS CVD
						    WHERE CVD.caja_vale_id = CV.caja_vale_id) AS total_detalles", FALSE);
		$this->db->from('cajas_vales AS CV');
		$this->db->join('sucursales AS S', 'CV.sucursal_gasto = S.sucursal_id', 'left');
		$this->db->join('departamentos AS D', 'CV.departamento_id = D.departamento_id', 'left');
		$this->db->join('empleados AS E', 'CV.referencia_id = E.empleado_id 
						 AND CV.tipo_referencia = "EMPLEADO"', 'left');
		$this->db->join('proveedores AS P', 'CV.referencia_id = P.proveedor_id  
						 AND CV.tipo_referencia = "PROVEEDOR"', 'left');
		$this->db->where('CV.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existe id de la referencia
	    if($strTipoReferencia != NULL)
	    {	
	    	$this->db->where('CV.tipo_referencia', $strTipoReferencia);
	    	$this->db->where('CV.referencia_id', $intReferenciaID);
	    }
	    //Si existe id de la sucursal
	    if($intSucursalGastoID != NULL)
	    {
	   		$this->db->where('CV.sucursal_gasto', $intSucursalGastoID);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('CV.estatus', $strEstatus);
		}
		//Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(CV.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

   	   $this->db->where("((CV.folio LIKE '%$strBusqueda%') OR
	    				   (D.descripcion LIKE '%$strBusqueda%') OR
	    				   (S.nombre LIKE '%$strBusqueda%') OR
	    				   (CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) LIKE '%$strBusqueda%') OR
		        		   (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.apellido_paterno, E.apellido_materno) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_paterno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_paterno, E.nombre) LIKE '%$strBusqueda%') OR
					       (CONCAT_WS(' ', E.nombre, E.apellido_materno) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' ', E.apellido_materno, E.nombre) LIKE '%$strBusqueda%') OR 
					       (CONCAT_WS(' - ', P.codigo, P.razon_social) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('CV.fecha DESC, CV.folio DESC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["vales"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $strTipo, $intEmpleadoID = NULL)
	{
		//Asignar número de registros para el autocomplete
	    $intLimite = LIMITE_AUTOCOMPLETE;

		//Si el Autocomplete es por referencias (empleados y proveedores)
	    if($strTipo == 'referencias')
	    {

	    	//Variable que se utiliza para formar la  consulta
			$queryReferencias = '';

			//Empleados
			$queryEmpleados = "SELECT  empleado_id  AS referencia_id, 
	    							     CONCAT(codigo, ' - ', apellido_paterno,' ', apellido_materno,' ', nombre) AS referencia, 'EMPLEADO' AS tipo_referencia
		 					   FROM empleados AS E
		 					   WHERE estatus = 'ACTIVO'
		 					   AND ((codigo LIKE '%$strDescripcion%') OR 
				        			(CONCAT_WS(' ', apellido_paterno, apellido_materno, nombre) LIKE '%$strDescripcion%') OR
							        (CONCAT_WS(' ', nombre, apellido_paterno, apellido_materno) LIKE '%$strDescripcion%') OR
							        (CONCAT_WS(' ', apellido_paterno, apellido_materno) LIKE '%$strDescripcion%') OR
							        (CONCAT_WS(' ', nombre, apellido_paterno) LIKE '%$strDescripcion%') OR 
							        (CONCAT_WS(' ', apellido_paterno, nombre) LIKE '%$strDescripcion%') OR
							        (CONCAT_WS(' ', nombre, apellido_materno) LIKE '%$strDescripcion%') OR 
							        (CONCAT_WS(' ', apellido_materno, nombre) LIKE '%$strDescripcion%'))";


			//Proveedores
			$queryProveedores = "SELECT proveedor_id AS referencia_id, 
								        	   CONCAT_WS(' - ', codigo, razon_social) AS referencia,
								        	   'PROVEEDOR' AS tipo_referencia
						         FROM proveedores
						         WHERE estatus = 'ACTIVO'
						         AND  ((codigo LIKE '%$strDescripcion%') OR
									   (nombre_comercial LIKE '%$strDescripcion%') OR
									   (razon_social LIKE '%$strDescripcion%'))";

			//Formar consulta
			$queryReferencias .= $queryEmpleados;
			$queryReferencias .= " UNION ";
			$queryReferencias .= $queryProveedores;
			$queryReferencias .= " ORDER BY referencia ASC";
			$queryReferencias .= " LIMIT 0, $intLimite";
			$strSQL = $this->db->query($queryReferencias);
			return $strSQL->result();
	    }
	    else
	    {
	    	$this->db->select(" CV.caja_vale_id, 
								CONCAT_WS(' - ', CV.folio, CV.tipo_vale) AS descripcion, 
								(CV.importe -
								 IFNULL((SELECT SUM(CVD.subtotal + CVD.iva + CVD.ieps) 
								  		 FROM cajas_vales_detalles AS CVD
								  		 WHERE CVD.caja_vale_id = CV.caja_vale_id), 0) -
								  IFNULL((SELECT SUM(CP.importe)
										  FROM cajas_pagos AS CP 
										  WHERE CV.caja_vale_id = CP.caja_vale_id
										  AND CP.estatus = 'ACTIVO'), 0)) AS saldo", FALSE);
	        $this->db->from('cajas_vales AS CV');
	        $this->db->where('CV.sucursal_id', $this->session->userdata('sucursal_id'));
		    $this->db->where('CV.estatus', 'CERRADO');
		    $this->db->where('CV.tipo_referencia', 'EMPLEADO');
		    $this->db->where('CV.referencia_id', $intEmpleadoID);
		    $this->db->where("(CV.folio LIKE '%$strDescripcion%')"); 
	        $this->db->order_by("CV.folio",'ASC');  
			$this->db->limit($intLimite, 0);
		    return $this->db->get()->result();

	    }
	}

	/*******************************************************************************************************************
	Funciones de la tabla cajas_vales_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles del vale de caja
	public function guardar_detalles(stdClass $objCajaValeDetalles)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		
		//Eliminar los detalles guardados
		$this->db->where('caja_vale_id', $objCajaValeDetalles->intCajaValeID);
		$this->db->delete('cajas_vales_detalles');

		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener los detalles del vale
		foreach ($objCajaValeDetalles->arrDetalles as $arrDets)
		{
			//Hacer recorrido para obtener los datos del detalle
			foreach ($arrDets as $arrDet)
			{
				//Incrementar renglón consecutivo
				$intRenglon++;

				//Si no existe referencia de la orden de compra asignar valor nulo
				$strTipoOrdenCompra = (($arrDet->strTipoOrdenCompra !== '') ? 
						   	  	  	    $arrDet->strTipoOrdenCompra : NULL);

				//Si no existe id de la orden de compra asignar valor nulo
				$intOrdenCompraID = (($arrDet->intOrdenCompraID !== '') ? 
						   	  	  	  $arrDet->intOrdenCompraID : NULL);

				//Si no existe id del proveedor asignar valor nulo
				$intProveedorID = (($arrDet->intProveedorID !== '') ? 
						   	  	  	$arrDet->intProveedorID : NULL);

				//Si no existe id de la sucursal asignar valor nulo
				$intSucursalID = (($arrDet->intSucursalID !== '') ? 
						   	  	   $arrDet->intSucursalID : NULL);

				//Si no existe id del módulo asignar valor nulo
				$intModuloID = (($arrDet->intModuloID !== '') ? 
							   	 $arrDet->intModuloID : NULL);

				//Si no existe id del tipo de gasto asignar valor nulo
				$intGastoTipoID = (($arrDet->intGastoTipoID !== '') ? 
						   	 	   $arrDet->intGastoTipoID : NULL);

				//Si no existe id del vehículo asignar valor nulo
				$intVehiculoID = (($arrDet->intVehiculoID !== '') ? 
						   	 	   $arrDet->intVehiculoID : NULL);


				//Si no existe id de la tasa o cuota del impuesto de IVA asignar valor nulo
				$intTasaCuotaIva = (($arrDet->intTasaCuotaIva !== '') ? 
						   	  	  	 $arrDet->intTasaCuotaIva : NULL);

				//Si no existe id de la tasa o cuota del impuesto de IEPS asignar valor nulo
				$intTasaCuotaIeps = (($arrDet->intTasaCuotaIeps !== '') ? 
						   	  	  	  $arrDet->intTasaCuotaIeps : NULL);

				//Convertir a mayúsculas haciendo un llamado a la función mb_strtoupper (para tomar encuenta las letras con acento)
				//Asignar datos al array
				$arrDatos = array('caja_vale_id' => $objCajaValeDetalles->intCajaValeID,
								  'renglon' => $intRenglon,
								  'tipo' => $arrDet->strTipo,
								  'fecha' => $arrDet->dteFecha,
								  'tipo_orden_compra' => $strTipoOrdenCompra,
								  'orden_compra_id' => $intOrdenCompraID,
								  'proveedor_id' => $intProveedorID,
								  'sucursal_id' => $intSucursalID,
								  'modulo_id' => $intModuloID,
								  'gasto_tipo_id' => $intGastoTipoID,
								  'vehiculo_id' => $intVehiculoID,
								  'factura' =>  mb_strtoupper($arrDet->strFactura),
								  'concepto' =>  mb_strtoupper($arrDet->strConcepto),
								  'subtotal' => $arrDet->intSubtotal,
								  'tasa_cuota_iva' => $intTasaCuotaIva,
								  'iva' => $arrDet->intIva,
								  'tasa_cuota_ieps' => $intTasaCuotaIeps,
								  'ieps' => $arrDet->intIeps);
				//Guardar los datos del registro
				$this->db->insert('cajas_vales_detalles', $arrDatos);
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

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intCajaValeID = NULL, $intCajaCorteID = NULL, $strTipoCajaCorte = NULL, 
									$strTipoGasto = NULL)
	{

		//Constante para identificar al tipo de movimiento entrada de refacciones por compra
		$intMovEntradaCompra = ENTRADA_REFACCIONES_COMPRA;
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';
		//Variable que se utiliza para agregar union con la tabla cajas_corte_arqueos
		$strUnionCajasCorteArqueos = '';

		//Variable que se utiliza para ordenar los registros dependiendo del tipo de búsqueda
		$strOrdenamiento = " ORDER BY ";

		//Si existe id del vale de caja
		if ($intCajaValeID !== NULL)
		{   
			$strRestricciones .= " WHERE CVD.caja_vale_id = $intCajaValeID";
			$strOrdenamiento .= "CVD.renglon ASC";
		}
		else
		{
			$strRestricciones .= " WHERE CVD.tipo = '$strTipoGasto'";

			//Si el tipo de corte de caja es ARQUEO
			if($strTipoCajaCorte == 'ARQUEO')
			{
				//Relacionar tablas: cajas_vales_detalles y cajas_corte_arqueos
				$strUnionCajasCorteArqueos .= "INNER JOIN cajas_corte_arqueos AS CCAV ON 
											   CVD.caja_vale_id = CCAV.referencia_id AND CCAV.tipo = 'VALE'";

			    $strRestricciones .= " AND CCAV.caja_corte_id = $intCajaCorteID";
			}
			else
			{
				$strRestricciones .= " AND CV.caja_corte_id = $intCajaCorteID";
			}


			//Si el tipo de gasto es FISCAL
			if($strTipoGasto == 'FISCAL')
			{
				$strOrdenamiento .= "CVD.tipo_orden_compra, CVD.modulo_id";
			}
			else
			{
				$strOrdenamiento .= "DCV.descripcion, CV.tipo_referencia, CV.referencia_id, CV.fecha, CV.folio";
			}

		}


        //Seleccionar los registros que coincidan con los criterios de búsqueda
		$strSQL = $this->db->query("SELECT CVD.renglon, CVD.tipo, CVD.tipo_orden_compra, CVD.orden_compra_id,  
						 			  	   CVD.fecha, DATE_FORMAT(CVD.fecha,'%d/%m/%Y') AS fecha_format,
						   				   CVD.proveedor_id, CVD.sucursal_id, CVD.modulo_id, CVD.gasto_tipo_id, 
						   			       CVD.vehiculo_id, CVD.factura, CVD.concepto, CVD.subtotal, 
						   				   CVD.tasa_cuota_iva, CVD.iva, CVD.tasa_cuota_ieps,
						  				   CVD.ieps, CONCAT_WS(' - ', PCVD.codigo, PCVD.razon_social) AS proveedor,
						   				   TIva.valor_maximo AS porcentaje_iva, TIeps.valor_maximo AS porcentaje_ieps,
						   				   CV.folio, DATE_FORMAT(CV.fecha,'%d/%m/%Y') AS fecha_vale,
						   				   CV.tipo_referencia,  CV.referencia_id, 
						   				   CV.departamento_id,
										   CASE 
											   WHEN  CV.tipo_referencia = 'PROVEEDOR'
											   		THEN  CONCAT_WS(' - ', P.codigo, P.razon_social)
											   ELSE CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre)
										   END AS referencia, SCV.nombre AS sucursal, DCV.descripcion AS departamento, 
										   CASE 
												WHEN  CVD.tipo_orden_compra = 'GENERAL' 
													THEN  CONCAT_WS(' - ', OC.folio, CVD.tipo_orden_compra)
										        WHEN  CVD.tipo_orden_compra = 'ESPECIAL' 
										        	THEN  CONCAT_WS(' - ', OCE.folio, CVD.tipo_orden_compra)
												WHEN  CVD.tipo_orden_compra = 'MAQUINARIA' 
													THEN  CONCAT_WS(' - ', OCM.folio, CVD.tipo_orden_compra)
												WHEN  CVD.tipo_orden_compra = 'REFACCIONES' 
													THEN  CONCAT_WS(' - ', MR.folio, CVD.tipo_orden_compra)
												WHEN  CVD.tipo_orden_compra = 'SERVICIO' 
													 THEN  CONCAT_WS(' - ', TF.folio, CVD.tipo_orden_compra)
												ELSE  CONCAT_WS(' - ', TFI.folio, CVD.tipo_orden_compra)
										   END AS folio_orden_compra,
										   GT.descripcion AS gasto,  GT.tipo_gasto, GT.parque_vehicular,
										   CONCAT_WS(' ', V.codigo, '-', V.modelo, V.marca, V.placas) AS vehiculo,
										   SCVD.nombre AS sucursal_detalle, M.descripcion AS modulo

									FROM cajas_vales_detalles AS CVD
									INNER JOIN cajas_vales AS CV ON CVD.caja_vale_id = CV.caja_vale_id
									$strUnionCajasCorteArqueos
									LEFT JOIN ordenes_compra AS OC ON CVD.orden_compra_id = OC.orden_compra_id
										AND CVD.tipo_orden_compra = 'GENERAL'
								    LEFT JOIN ordenes_compra_especiales AS OCE ON CVD.orden_compra_id = OCE.orden_compra_especial_id
						 				AND CVD.tipo_orden_compra = 'ESPECIAL'
						 		    LEFT JOIN ordenes_compra_maquinaria AS OCM ON CVD.orden_compra_id = OCM.orden_compra_maquinaria_id
										AND CVD.tipo_orden_compra = 'MAQUINARIA'
									LEFT JOIN movimientos_refacciones AS MR ON CVD.orden_compra_id = MR.movimiento_refacciones_id
									   AND CVD.tipo_orden_compra = 'REFACCIONES' 
									   AND MR.tipo_movimiento = $intMovEntradaCompra
									LEFT JOIN trabajos_foraneos_02 AS TF ON CVD.orden_compra_id = TF.trabajo_foraneo_id
										 AND CVD.tipo_orden_compra = 'SERVICIO'
									LEFT JOIN trabajos_foraneos_internos AS TFI ON CVD.orden_compra_id = TFI.trabajo_foraneo_interno_id
										AND CVD.tipo_orden_compra = 'SERVICIO INTERNO'
								    LEFT JOIN proveedores AS PCVD ON CVD.proveedor_id = PCVD.proveedor_id
								    LEFT JOIN gastos_tipos AS GT ON CVD.gasto_tipo_id = GT.gasto_tipo_id
								    LEFT JOIN sucursales AS SCVD ON CVD.sucursal_id = SCVD.sucursal_id
								    LEFT JOIN modulos AS M ON CVD.modulo_id = M.modulo_id
								    LEFT JOIN vehiculos AS V ON CVD.vehiculo_id = V.vehiculo_id
								    LEFT JOIN sat_tasa_cuota AS TIva ON CVD.tasa_cuota_iva = TIva.tasa_cuota_id
								    LEFT JOIN sat_tasa_cuota AS TIeps ON CVD.tasa_cuota_ieps = TIeps.tasa_cuota_id
								    LEFT JOIN sucursales AS SCV ON CV.sucursal_gasto = SCV.sucursal_id
								    LEFT JOIN departamentos AS DCV ON CV.departamento_id = DCV.departamento_id
								    LEFT JOIN empleados AS E ON CV.referencia_id = E.empleado_id 
										 AND CV.tipo_referencia = 'EMPLEADO'
								    LEFT JOIN  proveedores AS P ON CV.referencia_id = P.proveedor_id  
										 AND CV.tipo_referencia = 'PROVEEDOR'
									$strRestricciones
									$strOrdenamiento");

		return $strSQL->result();
	}
	
}
?>