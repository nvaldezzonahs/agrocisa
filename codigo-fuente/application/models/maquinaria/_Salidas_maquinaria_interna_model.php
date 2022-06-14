<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');

class Salidas_maquinaria_interna_model extends CI_model {

	//Método para guardar un registro nuevo
	public function guardar($strFolio, $objSalidaInterna)
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
						  'tipo_movimiento' => mb_strtoupper($objSalidaInterna->strTipoMovimiento),
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => mb_strtoupper($objSalidaInterna->strFecha),
						  'observaciones' => mb_strtoupper($objSalidaInterna->strObservaciones),
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('movimientos_maquinaria', $arrDatos);
		//Asignar id del nuevo registro en la base de datos
		$intMovimientoMaquinariaID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la entrada por compra
		$this->guardar_maquinaria_detalles($intMovimientoMaquinariaID, $objSalidaInterna->arrMaquinarias);

		//Hacer un llamado para actualizar el campo salida_id en la tabla maquinaria_inventario
		$this->actualizar_maquinaria_inventario($intMovimientoMaquinariaID, $objSalidaInterna->arrMaquinarias, 'INACTIVO');
		
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
	public function modificar($intMovimientoMaquinariaID, $objSalidaInterna)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $this->session->userdata('sucursal_id'),
						  'tipo_movimiento' => mb_strtoupper($objSalidaInterna->strTipoMovimiento),
						  'fecha' => mb_strtoupper($objSalidaInterna->strFecha),
						  'observaciones' => mb_strtoupper($objSalidaInterna->strObservaciones),
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
		$this->guardar_maquinaria_detalles($intMovimientoMaquinariaID, $objSalidaInterna->arrMaquinarias);

		//Hacer un llamado para actualizar el campo salida_id en la tabla maquinaria_inventario
		$this->actualizar_maquinaria_inventario($intMovimientoMaquinariaID, $objSalidaInterna->arrMaquinarias, 'INACTIVO');
		
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intMovimientoMaquinariaID, $intPolizaID = NULL)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		
			//Asignar datos al array
			$arrDatos = array('estatus' => 'INACTIVO',
							  'fecha_eliminacion' => date("Y-m-d H:i:s"),
							  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));

		
		$this->db->where('movimiento_maquinaria_id', $intMovimientoMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_maquinaria', $arrDatos);

    	//Si existe el id de la póliza
		if($intPolizaID > 0)
		{
			//Se crea una instancia de la clase modelo (pólizas) 
       		$otdModelPolizas = new Polizas_model();
       		//Hacer un llamado al método para modificar el estatus de la póliza 
			$otdModelPolizas->set_estatus($intPolizaID, 'INACTIVO');
		}

		//Actualizar el Inventario
		//Seleccionar las maquniarias pertenecientes a este movimiento
		$otdMaquinarias = $this->buscar_detalles($intMovimientoMaquinariaID);
	
		$strEstatusInv = 'ACTIVO';
		$this->actualizar_maquinaria_inventario($intMovimientoMaquinariaID, $otdMaquinarias, $strEstatusInv, 'CAMBIAR ESTATUS');

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
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
	public function actualizar_maquinaria_inventario($intMovimientoMaquinariaID, $arrMaquinarias, $strEstatus, $strTipoAccion = NULL)
	{

		$salidaID = NULL;
		if($strEstatus == 'INACTIVO'){
			$salidaID = $intMovimientoMaquinariaID;
		}


		//Validar que al menos exista una maquinaria en el arreglo
		if(sizeof($arrMaquinarias) > 0){
			//Hacer recorrido para insertar los datos en la tabla maquinaria_inventario
			for ($intCon = 0; $intCon < sizeof($arrMaquinarias); $intCon++) 
			{	
				//Variables que se utilizan para asignar valores del detalle
				$intMaquinariaDescripcionID = 0;
				$strSerie = '';

				//Dependiendo del tipo de acción asignar valores
				if($strTipoAccion == 'CAMBIAR ESTATUS')
				{
					$intMaquinariaDescripcionID = $arrMaquinarias[$intCon]->maquinaria_descripcion_id;
					$strSerie = $arrMaquinarias[$intCon]->serie;

				}
				else
				{
					$intMaquinariaDescripcionID =  mb_strtoupper($arrMaquinarias[$intCon]->strMaquinariaDescripcionID);
					$strSerie =  mb_strtoupper($arrMaquinarias[$intCon]->strSerie);

				}
				//Asignar datos al array
				$arrDatos = array(	
									'estatus'=> $strEstatus, 
									'salida_id' => $salidaID,
									'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  			'usuario_actualizacion' => $this->session->userdata('usuario_id')
								 );
				$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
				$this->db->where('maquinaria_descripcion_id', $intMaquinariaDescripcionID);
				$this->db->where('serie', $strSerie);
				$this->db->limit(1);
				//Actualizar los datos del registro
				$this->db->update('maquinaria_inventario', $arrDatos);
			}
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL,  $dteFechaFinal = NULL, $strEstatus = NULL, 
						   $strBusqueda = NULL,  $intNumRows, $intPos)
	{	
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('SALIDA POR CONSUMO INTERNO');


		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		 //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MM.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MM.estatus', $strEstatus);
			}
		}

		$this->db->where("(MM.folio LIKE '%$strBusqueda%')"); 


	    $this->db->from('movimientos_maquinaria AS MM');
		$this->db->join('usuarios AS UC', 'UC.usuario_id = MM.usuario_creacion', 'left');
		$this->db->join('polizas AS PF', 'MM.movimiento_maquinaria_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "MAQUINARIA"', 'left');

		$this->db->where('MM.tipo_movimiento', SALIDA_MAQUINARIA_INTERNA);
		$this->db->where("MM.sucursal_id", $this->session->userdata('sucursal_id'));
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MM.movimiento_maquinaria_id, 
						   MM.folio,
						   DATE_FORMAT(MM.fecha,'%d/%m/%Y') AS fecha,
						   MM.observaciones, 
						   MM.estatus,
						   UC.usuario AS usuario_creacion, 
						    IFNULL(PF.poliza_id, 0) AS poliza_id,
						   PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_maquinaria AS MM');
		$this->db->join('usuarios AS UC', 'UC.usuario_id = MM.usuario_creacion', 'left');
		 $this->db->join('polizas AS PF', 'MM.movimiento_maquinaria_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "MAQUINARIA"', 'left');
		$this->db->where('MM.tipo_movimiento', SALIDA_MAQUINARIA_INTERNA);
		$this->db->where("MM.sucursal_id", $this->session->userdata('sucursal_id')); 
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    } 

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
			if($strEstatus == 'GENERAR POLIZA')
			{

				$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
				$this->db->where("(MM.estatus = 'ACTIVO')");
			}
			else
			{
				$this->db->where('MM.estatus', $strEstatus);
			}
		}

		$this->db->where("(MM.folio LIKE '%$strBusqueda%')");
	    
		$this->db->order_by('MM.fecha, MM.folio', 'DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMovimientoMaquinariaID = NULL, $dteFechaInicial = NULL,  $dteFechaFinal = NULL,
						   $strEstatus = NULL, $strBusqueda = NULL)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('SALIDA POR CONSUMO INTERNO');



		$this->db->select("MM.movimiento_maquinaria_id, 
						   MM.folio,
						   DATE_FORMAT(MM.fecha,'%d/%m/%Y') AS fecha,
						   MM.observaciones, 
						   MM.estatus,
						   UC.usuario AS usuario_creacion, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id,
						   PF.folio AS folio_poliza, 
						    DATE_FORMAT(MM.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
	    $this->db->from('movimientos_maquinaria AS MM');
		$this->db->join('usuarios AS UC', 'UC.usuario_id = MM.usuario_creacion', 'left');
		$this->db->join('polizas AS PF', 'MM.movimiento_maquinaria_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "MAQUINARIA"', 'left');
		$this->db->where('MM.tipo_movimiento', SALIDA_MAQUINARIA_INTERNA);
		$this->db->where("MM.sucursal_id", $this->session->userdata('sucursal_id')); 
		//Si existe id del movimiento de maquinaria
		if ($intMovimientoMaquinariaID != NULL)
		{   
			$this->db->where('MM.movimiento_maquinaria_id', $intMovimientoMaquinariaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{		
			 //Si existe rango de fechas
		    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    } 

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				//Si se cumple la sentencia buscar aquellos registros que no tienen generada una póliza
				if($strEstatus == 'GENERAR POLIZA')
				{

					$this->db->where("(IFNULL(PF.poliza_id, 0) = 0)");
					$this->db->where("(MM.estatus = 'ACTIVO')");
				}
				else
				{
					$this->db->where('MM.estatus', $strEstatus);
				}
			}

			$this->db->where("(MM.folio LIKE '%$strBusqueda%')");
			$this->db->order_by('MM.fecha, MM.folio', 'DESC');
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
						    MI.consignacion ');
		$this->db->from('movimientos_maquinaria_detalles AS MMD');
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