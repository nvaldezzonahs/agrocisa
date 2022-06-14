<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Salidas_maquinaria_validacion_model extends CI_model {

	//Método para guardar un registro nuevo
	public function guardar($strFolio, $objSalidaValidacion)
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();
        
		//Variable que se utiliza para asignar el id del nuevo registro
		$intMovimientoMaquinariaID = 0;

		//Tabla movimientos_maquinaria
		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $strFolio); 

		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $this->session->userdata('sucursal_id'),
						  'tipo_movimiento' => mb_strtoupper($objSalidaValidacion->strTipoMovimiento),
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => mb_strtoupper($objSalidaValidacion->strFecha),
						  'referencia_id'=> $objSalidaValidacion->intReferenciaID,  
						  'prospecto_id'=> $objSalidaValidacion->intReferenciaID,
						  'vendedor_id' => $objSalidaValidacion->intVendedorID,
						  'chofer_id' => $objSalidaValidacion->intChoferID, 
						  'vehiculo_id' => $objSalidaValidacion->intVehiculoID, 
						  'observaciones' => mb_strtoupper($objSalidaValidacion->strObservaciones),
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('movimientos_maquinaria', $arrDatos);
		//Asignar id del nuevo registro en la base de datos
		$intMovimientoMaquinariaID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la entrada por compra
		$this->guardar_maquinaria_detalles($intMovimientoMaquinariaID, $objSalidaValidacion->arrMaquinarias);
		
		//Hacer un llamado para actualizar el campo salida_id en la tabla maquinaria_inventario
		$this->actualizar_maquinaria_inventario($intMovimientoMaquinariaID, $objSalidaValidacion->arrMaquinarias);

		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intMovimientoMaquinariaID.'_'.$strFolioConsecutivo;
		
	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar($intMovimientoMaquinariaID, $objSalidaValidacion)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $this->session->userdata('sucursal_id'),
						  'tipo_movimiento' => mb_strtoupper($objSalidaValidacion->strTipoMovimiento),
						  'fecha' => mb_strtoupper($objSalidaValidacion->strFecha),
						  'referencia_id'=> $objSalidaValidacion->intReferenciaID,  
						  'prospecto_id'=> $objSalidaValidacion->intReferenciaID,
						  'vendedor_id' => $objSalidaValidacion->intVendedorID,
						  'chofer_id' => $objSalidaValidacion->intChoferID, 
						  'vehiculo_id' => $objSalidaValidacion->intVehiculoID, 
						  'observaciones' => mb_strtoupper($objSalidaValidacion->strObservaciones),
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('movimiento_maquinaria_id', $intMovimientoMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_maquinaria', $arrDatos);
	
		//Eliminar los detalles del movimiento en la tabla: movimientos_maquinaria_detalles
		$this->db->where('movimiento_maquinaria_id', $intMovimientoMaquinariaID);
		$this->db->delete('movimientos_maquinaria_detalles');
		
		//Hacer un llamado al método para guardar los detalles de la entrada por compra
		$this->guardar_maquinaria_detalles($intMovimientoMaquinariaID, $objSalidaValidacion->arrMaquinarias);

		//Hacer un llamado para actualizar el campo salida_id en la tabla maquinaria_inventario
		$this->actualizar_maquinaria_inventario($intMovimientoMaquinariaID, $objSalidaValidacion->arrMaquinarias);
		
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intMovimientoMaquinariaID, $strEstatus)
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
		$this->db->where('movimiento_maquinaria_id', $intMovimientoMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('movimientos_maquinaria', $arrDatos);
	}

	//Función que se utiliza para guardar los detalles guardar_maquinaria_detalles
	public function guardar_maquinaria_detalles($intMovimientoMaquinariaID, $arrMaquinarias)
	{
		//Validar que al menos exista una maquinaria en el arreglo
		if(sizeof($arrMaquinarias) > 0){
			//Hacer recorrido para insertar los datos en la tabla movimientos_maquinaria_detalles
			for ($intCon = 0; $intCon < sizeof($arrMaquinarias); $intCon++) 
			{	
				//Asignar datos al array
				$arrDatos = array('movimiento_maquinaria_id' => $intMovimientoMaquinariaID,
					   			  'renglon' => mb_strtoupper($arrMaquinarias[$intCon]->intRenglon) + 1, 
					   			  'maquinaria_descripcion_id' => mb_strtoupper($arrMaquinarias[$intCon]->strMaquinariaDescripcionID),
					   			  'codigo' => mb_strtoupper($arrMaquinarias[$intCon]->strCodigo),
								  'descripcion_corta' => mb_strtoupper($arrMaquinarias[$intCon]->strDescripcionCorta),
								  'descripcion' => mb_strtoupper($arrMaquinarias[$intCon]->strDescripcion),
								  'serie' => mb_strtoupper($arrMaquinarias[$intCon]->strSerie),
								  'motor' => mb_strtoupper($arrMaquinarias[$intCon]->strMotor)
								);
				//Guardar los datos del registro
				$this->db->insert('movimientos_maquinaria_detalles', $arrDatos);
			}
		}
	}

	//Función que se utiliza para actualizar la tabla maquinaria_inventario
	public function actualizar_maquinaria_inventario($intMovimientoMaquinariaID, $arrMaquinarias)
	{
		//Validar que al menos exista una maquinaria en el arreglo
		if(sizeof($arrMaquinarias) > 0){
			//Hacer recorrido para insertar los datos en la tabla maquinaria_inventario
			for ($intCon = 0; $intCon < sizeof($arrMaquinarias); $intCon++) 
			{	
				//Asignar datos al array
				$arrDatos = array(
									'estatus'=> 'VALIDACION', 
									'salida_id' => $intMovimientoMaquinariaID,
									'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  			'usuario_actualizacion' => $this->session->userdata('usuario_id')
								 );
				$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
				$this->db->where('maquinaria_descripcion_id', mb_strtoupper($arrMaquinarias[$intCon]->strMaquinariaDescripcionID));
				$this->db->where('serie', mb_strtoupper($arrMaquinarias[$intCon]->strSerie));
				$this->db->limit(1);
				//Actualizar los datos del registro
				$this->db->update('maquinaria_inventario', $arrDatos);
			}
		}
	}

	//Método para efectuar un reingreso de maquinaria
	public function reingresar($intMovimientoMaquinariaID, $otdDetalles)
	{	
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Actualizar los datos del registro
		$arrDatos = array(
							'fecha_reingreso' => date("Y-m-d H:i:s"),
							'usuario_reingreso' => $this->session->userdata('usuario_id')
						 );
		$this->db->where('movimiento_maquinaria_id', $intMovimientoMaquinariaID);
		$this->db->limit(1);
		$this->db->update('movimientos_maquinaria', $arrDatos);

		//Recorremos el arreglo 
		foreach ($otdDetalles as $arrCol)
		{
        	//Asignar datos al array
			$arrDatos = array(
								'salida_id' => null,
								'estatus' => 'ACTIVO',
								'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  		'usuario_actualizacion' => $this->session->userdata('usuario_id')
							 );
			$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->where('maquinaria_descripcion_id', $arrCol->maquinaria_descripcion_id);
			$this->db->where('serie', $arrCol->serie);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('maquinaria_inventario', $arrDatos);
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
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL,  $intClienteID = NULL,$strEstatus = NULL, $strBusqueda = NULL, $intNumRows, $intPos)
	{	
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    if($intClienteID != 0){
	    	$this->db->where("MM.prospecto_id", $intClienteID);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MM.estatus', $strEstatus);
		}
		$this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
		    (CL.nombre_comercial LIKE '%$strBusqueda%'))"); 


	    $this->db->from('movimientos_maquinaria AS MM');
	    $this->db->join('clientes AS CL', 'CL.prospecto_id = MM.referencia_id', 'inner');
	    $this->db->join('vendedores AS VE', 'VE.vendedor_id = MM.vendedor_id', 'inner');
	    $this->db->join('empleados AS E2', 'E2.empleado_id = VE.empleado_id', 'inner');
	    $this->db->join('choferes AS C', 'C.chofer_id = MM.chofer_id', 'inner');
		$this->db->join('empleados AS E', 'C.empleado_id = E.empleado_id', 'inner');
		$this->db->join('vehiculos AS V', 'V.vehiculo_id = MM.vehiculo_id', 'inner');
		$this->db->join('usuarios AS UC', 'UC.usuario_id = MM.usuario_creacion', 'left');
		$this->db->where('MM.tipo_movimiento', SALIDA_MAQUINARIA_VALIDACION);
		$this->db->where("MM.sucursal_id", $this->session->userdata('sucursal_id'));
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MM.movimiento_maquinaria_id, 
						   MM.folio,
						   DATE_FORMAT(MM.fecha,'%d/%m/%Y') AS fecha,
						   MM.referencia_id,
						   CL.nombre_comercial AS cliente,
						   MM.vendedor_id,
						   CONCAT(E2.codigo, ' - ', E2.apellido_paterno,' ', E2.apellido_materno,' ', E2.nombre) AS vendedor,
						   MM.chofer_id,
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS chofer,
						   MM.vehiculo_id,
						   CONCAT(V.modelo, ' - ', V.marca) AS vehiculo,
						   MM.fecha_reingreso,
						   MM.usuario_reingreso,
						   MM.observaciones, 
						   MM.estatus,
						   UC.usuario AS usuario_creacion ", FALSE);
		$this->db->from('movimientos_maquinaria AS MM');
	    $this->db->join('clientes AS CL', 'CL.prospecto_id = MM.referencia_id', 'inner');
	    $this->db->join('vendedores AS VE', 'VE.vendedor_id = MM.vendedor_id', 'inner');
	    $this->db->join('empleados AS E2', 'E2.empleado_id = VE.empleado_id', 'inner');
	    $this->db->join('choferes AS C', 'C.chofer_id = MM.chofer_id', 'inner');
		$this->db->join('empleados AS E', 'C.empleado_id = E.empleado_id', 'inner');
		$this->db->join('vehiculos AS V', 'V.vehiculo_id = MM.vehiculo_id', 'inner');
		$this->db->join('usuarios AS UC', 'UC.usuario_id = MM.usuario_creacion', 'left');
		$this->db->where('MM.tipo_movimiento', SALIDA_MAQUINARIA_VALIDACION);
		$this->db->where("MM.sucursal_id", $this->session->userdata('sucursal_id'));
		if($intClienteID != 0){
	    	$this->db->where("MM.prospecto_id", $intClienteID);
	    } 
	    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
	    {
	   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }


	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MM.estatus', $strEstatus);
		}
		$this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
		    (CL.nombre_comercial LIKE '%$strBusqueda%'))"); 
	    
		$this->db->order_by('MM.fecha DESC', 'MM.folio DESC' );
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		
		return $arrResultado;
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMovimientoMaquinariaID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, $intClienteID = NULL)
	{
		$this->db->select("MM.movimiento_maquinaria_id, 
						   MM.folio,
						   DATE_FORMAT(MM.fecha,'%d/%m/%Y') AS fecha,
						   MM.referencia_id,
						   CL.nombre_comercial AS cliente,
						   MM.vendedor_id,
						   CONCAT(E2.codigo, ' - ', E2.apellido_paterno,' ', E2.apellido_materno,' ', E2.nombre) AS vendedor,
						   MM.chofer_id,
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS chofer,
						   MM.vehiculo_id,
						   CONCAT(V.modelo, ' - ', V.marca) AS vehiculo,
						   MM.observaciones, 
						   MM.estatus,
						   UC.usuario AS usuario_creacion ", FALSE);
	    $this->db->from('movimientos_maquinaria AS MM');
	    $this->db->join('clientes AS CL', 'CL.prospecto_id = MM.referencia_id', 'inner');
	    $this->db->join('vendedores AS VE', 'VE.vendedor_id = MM.vendedor_id', 'inner');
	    $this->db->join('empleados AS E2', 'E2.empleado_id = VE.empleado_id', 'inner');
	    $this->db->join('choferes AS C', 'C.chofer_id = MM.chofer_id', 'inner');
		$this->db->join('empleados AS E', 'C.empleado_id = E.empleado_id', 'inner');
		$this->db->join('vehiculos AS V', 'V.vehiculo_id = MM.vehiculo_id', 'inner');
		$this->db->join('usuarios AS UC', 'UC.usuario_id = MM.usuario_creacion', 'left');
		$this->db->where('MM.tipo_movimiento', SALIDA_MAQUINARIA_VALIDACION);
		//Si existe id del movimiento de maquinaria
		if ($intMovimientoMaquinariaID != NULL)
		{   
			$this->db->where('MM.movimiento_maquinaria_id', $intMovimientoMaquinariaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			//Si existe id de la sucursal
		    if($intClienteID > 0)
		    {
		   		$this->db->where('MM.referencia_id', $intClienteID);
		    }
			//Si existe rango de fechas
		    if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
		    {
		   		$this->db->where("(MM.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 
			$this->db->order_by('MM.folio', 'DESC');
			return $this->db->get()->result();
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intMovimientoMaquinariaID)
	{
		$this->db->select('	MMD.movimiento_maquinaria_id, 
							MMD.renglon, 
							MMD.maquinaria_descripcion_id,
							MMD.codigo, 
							MMD.descripcion_corta, 
							MMD.descripcion, 
						    MMD.serie, 
						    MMD.motor,
						    MI.numero_pedimento,
						    MI.consignacion,
						    ML.descripcion AS maquinaria_linea,
							MM.descripcion AS maquinaria_marca,
							MMOD.descripcion AS maquinaria_modelo');
		$this->db->from('movimientos_maquinaria_detalles AS MMD');
		$this->db->join('maquinaria_descripciones MD', 'MD.maquinaria_descripcion_id = MMD.maquinaria_descripcion_id', 'inner');	
		$this->db->join('maquinaria_lineas AS ML', 'ML.maquinaria_linea_id = MD.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MM', 'MM.maquinaria_marca_id = MD.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'MMOD.maquinaria_modelo_id = MD.maquinaria_modelo_id', 'inner');
		$this->db->join('maquinaria_inventario AS MI', 'MI.serie = MMD.serie','inner');
		$this->db->where('MMD.movimiento_maquinaria_id', $intMovimientoMaquinariaID);
		$this->db->order_by('MMD.renglon', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
    	$this->db->select('movimiento_maquinaria_id, folio');
        $this->db->from('movimientos_maquinaria');
	    $this->db->where('referencia_id', $this->session->userdata('sucursal_id') );
        $this->db->where('tipo_movimiento', '12' );
        $this->db->where("(folio LIKE '%$strDescripcion%')");  
		$this->db->order_by('folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);

	  	return $this->db->get()->result();
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function serie_autocomplete($strDescripcion)
	{
    	$this->db->select('	maquinaria_descripcion_id,
						serie,
    					motor,
    					codigo,
    					descripcion_corta,
    					descripcion ');
        $this->db->from('maquinaria_inventario');
	    $this->db->where('sucursal_id', $this->session->userdata('sucursal_id') );
        $this->db->where('salida_id IS NULL'); 
        $this->db->where("(serie LIKE '%$strDescripcion%')");  
		$this->db->order_by('serie', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);

	  	return $this->db->get()->result();

	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function motor_autocomplete($strDescripcion)
	{
    	$this->db->select('	maquinaria_descripcion_id,
						serie,
    					motor,
    					codigo,
    					descripcion_corta,
    					descripcion ');
        $this->db->from('maquinaria_inventario');
	    $this->db->where('sucursal_id', $this->session->userdata('sucursal_id') );
        $this->db->where('salida_id IS NULL'); 
        $this->db->where("(motor LIKE '%$strDescripcion%')");  
		$this->db->order_by('motor', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);

	  	return $this->db->get()->result();

	}

	//Método para regresar los aditamentos correspondientes a una serie
	public function get_aditamentos($strSerie)
	{
    	$this->db->select('serie, renglon, cantidad, descripcion');
        $this->db->from('maquinaria_inventario_aditamentos');
	    $this->db->where('serie', $strSerie); 
		$this->db->order_by('renglon', 'ASC');

	  	return $this->db->get()->result();

	}
}
?>