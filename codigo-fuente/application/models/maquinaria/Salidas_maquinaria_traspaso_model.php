<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de Maquinaria Inventario (para cambiar el estatus de una maquinara facturada)
include_once(APPPATH . 'models/maquinaria/Maquinaria_inventario_model.php');

class Salidas_maquinaria_traspaso_model extends CI_model {



	//Método para guardar un registro nuevo
	public function guardar($strFolio, $objSalidaTraspaso)
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
						  'tipo_movimiento' => mb_strtoupper($objSalidaTraspaso->strTipoMovimiento),
						  'folio' => $strFolioConsecutivo, 
						  'fecha' => mb_strtoupper($objSalidaTraspaso->strFecha),  
						  'referencia_id'=> mb_strtoupper($objSalidaTraspaso->intReferenciaID),
						  'chofer_id' => mb_strtoupper($objSalidaTraspaso->intChoferID), 
						  'vehiculo_id' => mb_strtoupper($objSalidaTraspaso->intVehiculoID), 
						  'observaciones' => mb_strtoupper($objSalidaTraspaso->strObservaciones),
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('movimientos_maquinaria', $arrDatos);
		//Asignar id del nuevo registro en la base de datos
		$intMovimientoMaquinariaID  = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles de la entrada por compra
		$this->guardar_maquinaria_detalles($intMovimientoMaquinariaID, $objSalidaTraspaso->arrMaquinarias);
		
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
	public function modificar($intMovimientoMaquinariaID, $objSalidaTraspaso)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $this->session->userdata('sucursal_id'),
						  'tipo_movimiento' => mb_strtoupper($objSalidaTraspaso->strTipoMovimiento),
						  'fecha' => mb_strtoupper($objSalidaTraspaso->strFecha),  
						  'referencia_id'=> $objSalidaTraspaso->intReferenciaID,
						  'chofer_id' => $objSalidaTraspaso->intChoferID, 
						  'vehiculo_id' => $objSalidaTraspaso->intVehiculoID, 
						  'observaciones' => mb_strtoupper($objSalidaTraspaso->strObservaciones),
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
		$this->guardar_maquinaria_detalles($intMovimientoMaquinariaID, $objSalidaTraspaso->arrMaquinarias);
		
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}

	//Método para modificar el estatus de un registro
	public function set_estatus($intMovimientoMaquinariaID)
	{
		
		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));
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

			//Se crea una instancia de la clase modelo (Maquinaria_inventario) 
        	$otdMaquinariaInventario = new  Maquinaria_inventario_model();
			//Hacer recorrido para insertar los datos en la tabla movimientos_maquinaria_detalles
			for ($intCon = 0; $intCon < sizeof($arrMaquinarias); $intCon++) 
			{	
				//Asignar datos al array
				$arrDatos = array(
									'movimiento_maquinaria_id' => $intMovimientoMaquinariaID,
					   			  	'renglon' => mb_strtoupper($arrMaquinarias[$intCon]->intRenglon), 
					   			  	'maquinaria_descripcion_id' => mb_strtoupper($arrMaquinarias[$intCon]->strMaquinariaDescripcionID),
					   			  	'codigo' => mb_strtoupper($arrMaquinarias[$intCon]->strCodigo),
								  	'descripcion_corta' => mb_strtoupper($arrMaquinarias[$intCon]->strDescripcionCorta),
								  	'descripcion' => mb_strtoupper($arrMaquinarias[$intCon]->strDescripcion),
								  	'serie' => mb_strtoupper($arrMaquinarias[$intCon]->strSerie),
								  	'motor' => mb_strtoupper($arrMaquinarias[$intCon]->strMotor),
								  	'numero_pedimento' => mb_strtoupper($arrMaquinarias[$intCon]->strNumeroPedimento)
								);
				//Guardar los datos del registro
				$this->db->insert('movimientos_maquinaria_detalles', $arrDatos);

				//Modificar en el inventario de maquinaria la serie que corresponda
        		$otdMaquinariaInventario->set_estatus($arrMaquinarias[$intCon]->strMaquinariaDescripcionID, $arrMaquinarias[$intCon]->strSerie, 'TRASPASO', $intMovimientoMaquinariaID);

			}
		}
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL,  $intSucursalDestinoID = NULL,  $strEstatus = NULL, 
						   $strBusqueda = NULL,$intNumRows, $intPos)
	{	

		//Constante para identificar al tipo de movimiento entrada de maquinaria por traspaso
		$intMovEntradaTraspaso = ENTRADA_MAQUINARIA_TRASPASO;

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
	    //Si existe id de la sucursal
	    if($intSucursalDestinoID > 0)
	    {
	    	$this->db->where("MM.referencia_id", $intSucursalDestinoID);
	    } 

	    //Si existe rango de fechas
		if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MM.estatus', $strEstatus);
		}

		$this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
          				   (S.nombre LIKE '%$strBusqueda%'))"); 

	    $this->db->where("MM.tipo_movimiento", SALIDA_MAQUINARIA_TRASPASO);
	    $this->db->where("MM.sucursal_id", $this->session->userdata('sucursal_id'));
		$this->db->from('movimientos_maquinaria MM');
		$this->db->join('sucursales AS S', 'S.sucursal_id = MM.referencia_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MM.movimiento_maquinaria_id, 
						   MM.folio,
						   DATE_FORMAT(MM.fecha,'%d/%m/%Y') AS fecha,
						   MM.referencia_id,
						   S.nombre AS sucursalDestino,  
						   MM.estatus, 
						   (SELECT IFNULL(COUNT(MME.movimiento_maquinaria_id), 0)
							FROM movimientos_maquinaria AS MME
							WHERE MME.tipo_movimiento = $intMovEntradaTraspaso
							AND MME.referencia_id = MM.movimiento_maquinaria_id
							AND MME.estatus = 'ACTIVO') AS total_entradas_traspaso", FALSE);
		$this->db->from('movimientos_maquinaria AS MM');
	    $this->db->join('sucursales AS S', 'S.sucursal_id = MM.referencia_id', 'inner');
		$this->db->where('MM.tipo_movimiento', SALIDA_MAQUINARIA_TRASPASO);
		$this->db->where("MM.sucursal_id", $this->session->userdata('sucursal_id'));
		 //Si existe id de la sucursal
	    if($intSucursalDestinoID > 0)
	    {
	    	$this->db->where("MM.referencia_id", $intSucursalDestinoID);
	    }

	    //Si existe rango de fechas
		if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   	    $this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
	    }
	    

	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MM.estatus', $strEstatus);
		}

		$this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
          					(S.nombre LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('MM.fecha DESC, MM.folio DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMovimientoMaquinariaID = NULL, $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
					        $intSucursalDestinoID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{

		//Constante para identificar al tipo de movimiento entrada de maquinaria por traspaso
		$intMovEntradaTraspaso = ENTRADA_MAQUINARIA_TRASPASO;

		$this->db->select("MM.movimiento_maquinaria_id, 
						   MM.folio,
						   DATE_FORMAT(MM.fecha,'%d/%m/%Y') AS fecha,
						   MM.referencia_id,
						   S.nombre AS sucursalSalida,
						   MM.sucursal_id AS sucursalSalidaID,
						   SS.nombre AS sucursalDestino,
						   MM.referencia_id AS sucursalDestinoID, 
						   MM.chofer_id,
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS chofer,
						   MM.vehiculo_id,
						   CONCAT(V.modelo, ' - ', V.marca) AS vehiculo,
						   MM.observaciones, 						   
						   MM.estatus,
						   UC.usuario AS usuario_creacion, 
						   DATE_FORMAT(MM.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
	    $this->db->from('movimientos_maquinaria AS MM');
	    $this->db->join('sucursales AS S', 'S.sucursal_id = MM.sucursal_id', 'inner');
	    $this->db->join('sucursales AS SS', 'SS.sucursal_id = MM.referencia_id', 'inner');
	    $this->db->join('choferes AS C', 'C.chofer_id = MM.chofer_id', 'left');
		$this->db->join('empleados AS E', 'C.empleado_id = E.empleado_id', 'left');
		$this->db->join('vehiculos AS V', 'V.vehiculo_id = MM.vehiculo_id', 'left');
		$this->db->join('usuarios AS UC', 'UC.usuario_id = MM.usuario_creacion', 'left');
		$this->db->where('MM.tipo_movimiento', SALIDA_MAQUINARIA_TRASPASO);
	    
		//Si existe id del movimiento de maquinaria
		if ($intMovimientoMaquinariaID != NULL)
		{   
			$this->db->where('MM.movimiento_maquinaria_id', $intMovimientoMaquinariaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{
			$this->db->where("MM.sucursal_id", $this->session->userdata('sucursal_id'));
			
			 //Si existe id de la sucursal
		    if($intSucursalDestinoID > 0)
		    {
		    	$this->db->where("MM.referencia_id", $intSucursalDestinoID);
		    }

		    //Si existe rango de fechas
			if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
		    {
		   	    $this->db->where("(DATE_FORMAT(MM.fecha,'%Y-%m-%d') BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
		    }
		    

		    //Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('MM.estatus', $strEstatus);
			}

			$this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
	          					(S.nombre LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('MM.fecha DESC', 'MM.folio DESC' );
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
					        MMD.numero_pedimento, 
					        MI.consignacion,
					        MI.codigo_interno,
					        MI.costo,
					        ML.descripcion AS maquinaria_linea,
 							MMAR.descripcion AS maquinaria_marca,
 							MMOD.descripcion AS maquinaria_modelo ');
		$this->db->from('movimientos_maquinaria_detalles AS MMD');
		$this->db->join('movimientos_maquinaria AS MM', 'MM.movimiento_maquinaria_id = MMD.movimiento_maquinaria_id','inner');	
		$this->db->join('maquinaria_descripciones MD', 'MD.maquinaria_descripcion_id = MMD.maquinaria_descripcion_id', 'inner');	
		$this->db->join('maquinaria_lineas AS ML', 'ML.maquinaria_linea_id = MD.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MMAR', 'MMAR.maquinaria_marca_id = MD.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'MMOD.maquinaria_modelo_id = MD.maquinaria_modelo_id', 'inner');
		$this->db->join('maquinaria_inventario AS MI', 'MI.serie = MMD.serie AND MI.maquinaria_descripcion_id = MMD.maquinaria_descripcion_id AND MI.codigo = MMD.codigo AND MI.sucursal_id = MM.sucursal_id','left');
		$this->db->where('MM.movimiento_maquinaria_id', $intMovimientoMaquinariaID);
		$this->db->where('MM.tipo_movimiento', SALIDA_MAQUINARIA_TRASPASO);
		$this->db->order_by('MMD.renglon', 'ASC');
		return $this->db->get()->result();
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
    	$this->db->select('MM.movimiento_maquinaria_id, MM.folio');
        $this->db->from('movimientos_maquinaria AS MM');
        $this->db->where("MM.movimiento_maquinaria_id NOT IN (SELECT DISTINCT MM2.referencia_id FROM movimientos_maquinaria MM2 WHERE MM2.tipo_movimiento = 2 AND MM2.estatus = 'ACTIVO' )", NULL, FALSE);
	    $this->db->where('MM.referencia_id', $this->session->userdata('sucursal_id') );
        $this->db->where('MM.tipo_movimiento', SALIDA_MAQUINARIA_TRASPASO );
        $this->db->where('MM.estatus', 'ACTIVO');
        $this->db->where("(MM.folio LIKE '%$strDescripcion%')");  
		$this->db->order_by('MM.folio', 'ASC');
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

	//Método para verificar si el movimiento de salida por traspaso ya presenta una entrada por traspaso
	public function verificar_entrada($intMovimientoMaquinariaID){

		$this->db->select('MM.movimiento_maquinaria_id, MM.folio');
        $this->db->from('movimientos_maquinaria AS MM');
        $this->db->where("MM.movimiento_maquinaria_id IN (SELECT DISTINCT MM2.referencia_id FROM movimientos_maquinaria MM2 WHERE MM2.tipo_movimiento = 2 AND MM2.estatus = 'ACTIVO')", NULL, FALSE);
	    $this->db->where('MM.sucursal_id', $this->session->userdata('sucursal_id') );
        $this->db->where('MM.tipo_movimiento', SALIDA_MAQUINARIA_TRASPASO );
        $this->db->where('MM.movimiento_maquinaria_id', $intMovimientoMaquinariaID );

	  	$this->db->limit(1);
		return $this->db->get()->row();

	}

}
?>