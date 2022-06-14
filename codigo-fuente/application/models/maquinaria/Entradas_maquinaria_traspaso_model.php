<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');
//Incluir la clase modelo de Maquinaria Inventario (para cambiar el estatus de una maquinara facturada)
include_once(APPPATH . 'models/maquinaria/Maquinaria_inventario_model.php');
//Incluir la clase modelo de póliza (para modificar el estatus de la póliza)
include_once(APPPATH . 'models/contabilidad/Polizas_model.php');

class Entradas_maquinaria_traspaso_model extends CI_model {

	/*******************************************************************************************************************
	Funciones de la tabla movimientos_maquinaria -> ENTRADAS POR TRASPASO
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar($strFolio, $objEntradaTraspaso)
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Variable que se utiliza para asignar el id del nuevo registro
		$intMovimientoMaquinariaID = 0;

		//Concatenar hora, minutos y segundos
		$dteFecha = mb_strtoupper($objEntradaTraspaso->strFecha).' '.date("H:i:s");  
			 
		//Asignar datos al array
		$arrDatos = array('sucursal_id' => $this->session->userdata('sucursal_id'),
						  'tipo_movimiento' => mb_strtoupper($objEntradaTraspaso->strTipoMovimiento),
						  'folio' => $strFolio,  
						  'fecha' => $dteFecha,  
						  'referencia_id'=> mb_strtoupper($objEntradaTraspaso->intReferenciaID),
						  'chofer_id' => mb_strtoupper($objEntradaTraspaso->intChoferID), 
						  'vehiculo_id' => mb_strtoupper($objEntradaTraspaso->intVehiculoID), 
						  'observaciones' => mb_strtoupper($objEntradaTraspaso->strObservaciones),
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $this->session->userdata('usuario_id'));
		//Guardar los datos del registro
		$this->db->insert('movimientos_maquinaria', $arrDatos);
		//Asignar id del nuevo registro en la base de datos
		$intMovimientoMaquinariaID  = $this->db->insert_id();

		//Hacer un llamado al método guardar los detalles del movimiento e inventario
		$this->guardar_maquinaria_inventario($intMovimientoMaquinariaID, $this->session->userdata('sucursal_id'), 
											$objEntradaTraspaso->arrMaquinarias, $objEntradaTraspaso->intSucursalSalidaID);
		
		
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status().'_'.$intMovimientoMaquinariaID;
	}

	

	//Método para modificar el estatus de un registro
	public function set_estatus($intMovimientoMaquinariaID, $intPolizaID = NULL)
	{

		//Obtenemos los datos de la Maquinaria perteneciente al movimiento 
		$otdMovimiento = $this->buscar($intMovimientoMaquinariaID);
		$otdDetalles = $this->buscar_detalles($intMovimientoMaquinariaID);

		//Asignar datos al array
		$arrDatos = array('estatus' => 'INACTIVO',
						  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  'usuario_eliminacion' =>  $this->session->userdata('usuario_id'));

		$this->db->where('movimiento_maquinaria_id', $intMovimientoMaquinariaID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_maquinaria', $arrDatos);

		//Modificar en el Inventario la Maquinaria perteneciente al movimiento 
		//Validar que al menos exista una maquinaria en el arreglo
		if($otdDetalles)
		{

			//Se crea una instancia de la clase modelo (inventario de maquinaria) 
       	 	$otdModelInventario = new  Maquinaria_inventario_model();

       	 	//Hacer recorrido para obtener los detalles del movimiento
       	 	foreach ($otdDetalles as $arrDet)
			{
				//Variable que se utiliza para asignar el id de la maquinaria
				$intMaquinariaDescripcionID = $arrDet->maquinaria_descripcion_id;
				//Variable que se utiliza para asignar la serie de maquinaria
				$strSerie = $arrDet->serie;

				//Cancelamos y Modificamos el inventario de la sucursal de ENTRADA a la que se hizo el TRASPASO
	            $otdModelInventario->set_estatus($intMaquinariaDescripcionID, $strSerie, 
	           								    'INACTIVO');

	           //Modificamos el inventario de la sucursal de SALIDA que hizo el TRASPASO
	            $otdModelInventario->set_estatus($intMaquinariaDescripcionID, $strSerie, 
	           								    'TRASPASO', NULL, NULL, $otdMovimiento->sucursalSalidaID);

			}//Cierre de foreach

		}//Cierre de verificación de detalles

		//Si existe el id de la póliza
		if($intPolizaID > 0)
		{
			//Se crea una instancia de la clase modelo (pólizas) 
       		$otdModelPolizas = new Polizas_model();
       		//Hacer un llamado al método para modificar el estatus de la póliza 
			$otdModelPolizas->set_estatus($intPolizaID, 'INACTIVO');
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
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL,  $intSucursalSalidaID = NULL,
						   $strEstatus = NULL, $strBusqueda = NULL,$intNumRows, $intPos)
	{	

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR TRASPASO');

		$this->db->where('MM.tipo_movimiento', ENTRADA_MAQUINARIA_TRASPASO);
		$this->db->where("MM.sucursal_id", $this->session->userdata('sucursal_id'));

		//Si existe id de la sucursal
	    if($intSucursalSalidaID > 0)
		{
	    	$this->db->where("MM2.sucursal_id", $intSucursalSalidaID);
	    } 

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
		
		$this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
        				   ( S.nombre LIKE '%$strBusqueda%'))"); 
		$this->db->from('movimientos_maquinaria AS MM'); 
	   
		$this->db->join('movimientos_maquinaria AS MM2', 'MM2.movimiento_maquinaria_id = MM.referencia_id', 'inner');
		$this->db->join('sucursales AS S', 'S.sucursal_id = MM2.sucursal_id', 'inner');
		$this->db->join('usuarios AS UC', 'UC.usuario_id = MM.usuario_creacion', 'left');
		$this->db->join('choferes AS C', 'C.chofer_id = MM.chofer_id', 'left');
		$this->db->join('empleados AS E', 'C.empleado_id = E.empleado_id', 'left');
		$this->db->join('vehiculos AS V', 'V.vehiculo_id = MM.vehiculo_id', 'left');
		$this->db->join('polizas AS PF', 'MM.movimiento_maquinaria_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "MAQUINARIA"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();		

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MM.movimiento_maquinaria_id, 
						   MM.folio,
						   DATE_FORMAT(MM.fecha,'%d/%m/%Y') AS fecha,
						   MM.referencia_id,
						   MM2.folio AS folioSalida,
						   S.nombre AS sucursalSalida, 
						   MM.chofer_id,
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS chofer,
						   MM.vehiculo_id,
						   CONCAT(V.modelo, ' - ', V.marca) AS vehiculo,
						   MM.observaciones, 
						   MM.estatus, 
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza", FALSE);
		$this->db->from('movimientos_maquinaria AS MM'); 
	  	$this->db->join('movimientos_maquinaria AS MM2', 'MM2.movimiento_maquinaria_id = MM.referencia_id', 'inner');
		$this->db->join('sucursales AS S', 'S.sucursal_id = MM2.sucursal_id', 'inner');
		$this->db->join('choferes AS C', 'C.chofer_id = MM.chofer_id', 'left');
		$this->db->join('empleados AS E', 'C.empleado_id = E.empleado_id', 'left');
		$this->db->join('vehiculos AS V', 'V.vehiculo_id = MM.vehiculo_id', 'left');
		$this->db->join('usuarios AS UC', 'UC.usuario_id = MM.usuario_creacion', 'left');
		$this->db->join('polizas AS PF', 'MM.movimiento_maquinaria_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "MAQUINARIA"', 'left');

		$this->db->where('MM.tipo_movimiento', ENTRADA_MAQUINARIA_TRASPASO);
		$this->db->where("MM.sucursal_id", $this->session->userdata('sucursal_id'));

		//Si existe id de la sucursal
	    if($intSucursalSalidaID > 0)
		{
	    	$this->db->where("MM2.sucursal_id", $intSucursalSalidaID);
	    } 

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
		
		$this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
        				   ( S.nombre LIKE '%$strBusqueda%'))"); 
	    
		$this->db->order_by('MM.fecha DESC', 'MM.folio DESC' );
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();		
		return $arrResultado;
	
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMovimientoMaquinariaID = NULL, $strFolio = NULL, 
						   $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intSucursalSalidaID = NULL, $strEstatus = NULL, $strBusqueda = NULL)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strTipoMovimiento = $this->db->escape('ENTRADA POR TRASPASO');


		$this->db->select("MM.movimiento_maquinaria_id, 
						   MM.folio,
						   DATE_FORMAT(MM.fecha,'%d/%m/%Y') AS fecha,
						   MM.referencia_id,
						   MM2.folio AS folioSalida,
						   MM2.sucursal_id AS sucursalSalidaID,
    					   S2.nombre AS sucursalSalida, 
    					   S.nombre AS sucursalDestino,
						   MM.chofer_id,
						   CONCAT(E.codigo, ' - ', E.apellido_paterno,' ', E.apellido_materno,' ', E.nombre) AS chofer,
						   MM.vehiculo_id,
						   CONCAT(V.modelo, ' - ', V.marca) AS vehiculo,
						   MM.observaciones, 
						   MM.estatus,
						   UC.usuario AS usuario_creacion,
						   IFNULL(PF.poliza_id, 0) AS poliza_id, 
						   PF.folio AS folio_poliza, 
						   UC.usuario AS usuario_creacion, 
						   DATE_FORMAT(MM.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
	    $this->db->from('movimientos_maquinaria AS MM'); 
		$this->db->join('movimientos_maquinaria AS MM2', 'MM2.movimiento_maquinaria_id = MM.referencia_id', 'inner');
		$this->db->join('sucursales AS S', 'S.sucursal_id = MM2.referencia_id', 'inner');
		$this->db->join('sucursales AS S2', 'S2.sucursal_id = MM2.sucursal_id', 'inner');
		$this->db->join('choferes AS C', 'C.chofer_id = MM.chofer_id', 'left');
		$this->db->join('empleados AS E', 'C.empleado_id = E.empleado_id', 'left');
		$this->db->join('vehiculos AS V', 'V.vehiculo_id = MM.vehiculo_id', 'left');
		$this->db->join('usuarios AS UC', 'UC.usuario_id = MM.usuario_creacion', 'left');
		$this->db->join('polizas AS PF', 'MM.movimiento_maquinaria_id = PF.referencia_id
	    							      AND PF.proceso = '.$strTipoMovimiento.' 
	    							      AND PF.modulo = "MAQUINARIA"', 'left');
		$this->db->where('MM.tipo_movimiento', ENTRADA_MAQUINARIA_TRASPASO);
		

		//Si existe id del movimiento de maquinaria
		if ($intMovimientoMaquinariaID !== NULL)
		{   
			$this->db->where('MM.movimiento_maquinaria_id', $intMovimientoMaquinariaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strFolio !== NULL)///Si existe folio del traspaso
		{   
			$this->db->where('MM.folio', $strFolio);
			$this->db->where('MM.sucursal_id', $this->session->userdata('sucursal_id'));
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else  
		{

			$this->db->where('MM.sucursal_id', $this->session->userdata('sucursal_id'));
			//Si existe id de la sucursal
		    if($intSucursalSalidaID > 0)
			{
		    	$this->db->where("MM2.sucursal_id", $intSucursalSalidaID);
		    } 

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
			
			$this->db->where("((MM.folio LIKE '%$strBusqueda%') OR
	        				   ( S.nombre LIKE '%$strBusqueda%'))");

		    
			$this->db->order_by('MM.fecha DESC', 'MM.folio DESC' );
			return $this->db->get()->result();
		}
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

	/*******************************************************************************************************************
	Funciones de las tablas movimientos_maquinaria_detalles/maquinaria_inventario
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles del movimiento e inventario
	public function guardar_maquinaria_inventario($intMovimientoMaquinariaID, $intSucursalID, $arrMaquinarias, $intSucursalSalidaID)
	{
		//Validar que al menos exista una maquinaria en el arreglo
		if(sizeof($arrMaquinarias) > 0)
		{

			//Se crea una instancia de la clase modelo (inventario de maquinaria) 
       	 	$otdModelInventario = new  Maquinaria_inventario_model();

			//Hacer recorrido para insertar los datos en la tabla movimientos_maquinaria_detalles
			for ($intCon = 0; $intCon < sizeof($arrMaquinarias); $intCon++) 
			{	
				//Variable que se utiliza para asignar el id de la maquinaria
				$intMaquinariaDescripcionID = $arrMaquinarias[$intCon]->strMaquinariaDescripcionID;
				//Variable que se utiliza para asignar la serie de maquinaria
				$strSerie = $arrMaquinarias[$intCon]->strSerie;

				//Verificamos si la MAQUINARIA ya ha sido previamente agregada al inventario
				$otdDetMaqSalida = $this->buscar_detalles_maquinaria_inventario($intMaquinariaDescripcionID, 
																				$strSerie, $intSucursalSalidaID);

				$otdExisteMaquinaria = $this->buscar_maquinaria_inventario($intMaquinariaDescripcionID, $strSerie);


				//Si existen datos del traspaso
				if($otdDetMaqSalida)
				{
					//Variables que se utilizan para asignar datos del inventario
					$intVendedorID = ($otdDetMaqSalida->vendedor_id > 0)?$otdDetMaqSalida->vendedor_id:NULL;
					$intProspectoID = ($otdDetMaqSalida->prospecto_id > 0)?$otdDetMaqSalida->prospecto_id:NULL;
					$strObservaciones = ($otdDetMaqSalida->observaciones)?$otdDetMaqSalida->observaciones:NULL;

					
					//Tabla movimientos_maquinaria_detalles
					//Asignar datos al array
					$arrDatos = array('movimiento_maquinaria_id' => $intMovimientoMaquinariaID,
						   			  'renglon' => mb_strtoupper($arrMaquinarias[$intCon]->intRenglon + 1), 
						   			  'maquinaria_descripcion_id' => $intMaquinariaDescripcionID,
						   			  'codigo' => $otdDetMaqSalida->codigo,
									  'descripcion_corta' =>  $otdDetMaqSalida->descripcion_corta,
									  'descripcion' => $otdDetMaqSalida->descripcion,
									  'serie' => $strSerie,
									  'motor' => $otdDetMaqSalida->motor,
									  'numero_pedimento' => $otdDetMaqSalida->numero_pedimento);
					//Guardar los datos del registro
					$this->db->insert('movimientos_maquinaria_detalles', $arrDatos);


					//Tabla maquinaria_inventario
					//Si existe maquinaria en la sucursal (logeada)
					if($otdExisteMaquinaria)
					{

						//Asignar datos al array
						$arrDatos = array(
											'estatus' => 'ACTIVO',
											'salida_id' => NULL,
											'vendedor_id' => $intVendedorID,
											'prospecto_id' => $intProspectoID,
											'observaciones' => $strObservaciones,
											'codigo_interno' => $otdDetMaqSalida->codigo_interno,
											'costo' => $otdDetMaqSalida->costo,
									  		'fecha_actualizacion' => date("Y-m-d H:i:s"),
									  		'usuario_actualizacion' => $this->session->userdata('usuario_id')
									  	);

						$this->db->where('maquinaria_descripcion_id', $intMaquinariaDescripcionID);
						$this->db->where('serie', $strSerie);
						$this->db->where('sucursal_id', $intSucursalID);
						$this->db->limit(1);
						//Actualizar los datos del registro
						$this->db->update('maquinaria_inventario', $arrDatos);

					}
					else
					{
						//Asignar datos al array
						$arrDatos = array(
											'sucursal_id' => $intSucursalID,
							   			  	'maquinaria_descripcion_id' => $intMaquinariaDescripcionID,
										  	'serie' => $strSerie,
										  	'motor' => $otdDetMaqSalida->motor,
										  	'codigo' => $otdDetMaqSalida->codigo,
										  	'descripcion_corta' => $otdDetMaqSalida->descripcion_corta,
										  	'descripcion' => $otdDetMaqSalida->descripcion,
										  	'numero_pedimento' => $otdDetMaqSalida->numero_pedimento,
										  	'consignacion' => $otdDetMaqSalida->consignacion,
										  	'entrada_id' => $intMovimientoMaquinariaID,
										  	'codigo_interno' => $otdDetMaqSalida->codigo_interno,
											'costo' => $otdDetMaqSalida->costo,
											'vendedor_id' => $intVendedorID, 
											'prospecto_id' => $intProspectoID,
											'observaciones' => $strObservaciones,
										  	'fecha_creacion' => date("Y-m-d H:i:s"),
								  		  	'usuario_creacion' => $this->session->userdata('usuario_id')
										);
						//Guardar los datos del registro
						$this->db->insert('maquinaria_inventario', $arrDatos);

					}


					//Modificamos el inventario de la sucursal de salida que hizo el TRASPASO
	            	$otdModelInventario->set_estatus($intMaquinariaDescripcionID, $strSerie, 
	           								    'INACTIVO', NULL, NULL, $intSucursalSalidaID);

				}//Cierre de verificación de la salida por traspaso

			}//Cierre del for
		}
		

	}

	//Verificamos si la MAQUINARIA ya ha sido previamente agregada al inventario
	public function buscar_maquinaria_inventario($intMaquinariaDescripcionID, $strSerie)
	{
		$this->db->select("	MI.maquinaria_descripcion_id, 
							MI.serie, 
							MI.motor, 
						    MI.codigo ", FALSE);
		$this->db->from('maquinaria_inventario AS MI');
		$this->db->where('MI.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MI.maquinaria_descripcion_id', $intMaquinariaDescripcionID);
		$this->db->where('MI.serie', $strSerie);
		return $this->db->get()->row();
	}

	//Verificamos si la MAQUINARIA contiene información de salida correspondiente
	public function buscar_detalles_maquinaria_inventario($intMaquinariaDescripcionID, $strSerie, $intSucursalSalidaID)
	{
		$this->db->select(" MI.motor, 
							MI.codigo, 
							MI.descripcion_corta, 
							MI.descripcion,
							MI.numero_pedimento, 
							MI.consignacion, 
							MI.vendedor_id,
							MI.prospecto_id, 
							MI.observaciones, 
							MI.codigo_interno, 
							MI.costo", FALSE);
		$this->db->from('maquinaria_inventario AS MI');
		$this->db->where('MI.sucursal_id', $intSucursalSalidaID);
		$this->db->where('MI.maquinaria_descripcion_id', $intMaquinariaDescripcionID);
		$this->db->where('MI.serie', $strSerie);
		return $this->db->get()->row();
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
		$this->db->join('maquinaria_inventario AS MI', 'MI.serie = MMD.serie AND MMD.maquinaria_descripcion_id = MI.maquinaria_descripcion_id AND  MI.sucursal_id = MM.sucursal_id','left');
		$this->db->where('MM.movimiento_maquinaria_id', $intMovimientoMaquinariaID);
		$this->db->where('MM.tipo_movimiento', ENTRADA_MAQUINARIA_TRASPASO);
		$this->db->where('MM.sucursal_id',  $this->session->userdata('sucursal_id'));
		$this->db->order_by('MMD.renglon', 'ASC');
		return $this->db->get()->result();
	}

	

}