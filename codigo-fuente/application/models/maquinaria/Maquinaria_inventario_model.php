<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maquinaria_inventario_model extends CI_model {

	/*******************************************************************************************************************
	Funciones de la tabla maquinaria_inventario
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objMovimiento)
	{
		//Hacer recorrido para obtener los detalles del movimiento
		foreach ($objMovimiento->arrDetalles as $arrDets)
		{
			//Hacer recorrido para obtener los datos del detalle
			foreach ($arrDets as $arrDet)
			{
				//Variable que se utiliza para asignar el código interno
				$strCodigoInterno = '';

				//Verificamos si existe el código interno de la serie en el inventario
				$otdCodigoSerie = $this->buscar_codigo_interno_serie($arrDet->intMaquinariaDescripcionID, 
																	 $arrDet->strSerie, $arrDet->strConsignacion);
				//Si existe el código interno de la serie (consignación)
				if($otdCodigoSerie)
				{
					//Asignar código interno
					$strCodigoInterno = $otdCodigoSerie->codigo_interno;
				}
				else
				{
					//Asignar (generar) código interno consecutivo 
					$strCodigoInterno = $this->get_codigo_interno($arrDet->strConsignacion);
				}

				//Tabla maquinaria_inventario
				//Asignar datos al array
				$arrDatos = array('sucursal_id' => $objMovimiento->intSucursalID,
								  'maquinaria_descripcion_id' => $arrDet->intMaquinariaDescripcionID,
								  'codigo' => $arrDet->strCodigo,
								  'descripcion_corta' => $arrDet->strDescripcionCorta,
								  'descripcion' => $arrDet->strDescripcion,
								  'serie' =>  $arrDet->strSerie,
								  'motor' =>  $arrDet->strMotor,
								  'numero_pedimento' => $arrDet->strNumeroPedimento,
								  'consignacion' => $arrDet->strConsignacion,
								  'entrada_id' => $objMovimiento->intMovimientoMaquinariaID,
								  'codigo_interno' => $strCodigoInterno,
								  'costo' => $arrDet->intCosto,
								  'fecha_creacion' => date("Y-m-d H:i:s"),
						  		  'usuario_creacion' => $objMovimiento->intUsuarioID);
				//Guardar los datos del registro
				$this->db->insert('maquinaria_inventario', $arrDatos);

				//Si existen aditamentos
				if($arrDet->arrAditamentos)
				{
					//Hacer un llamado al método para guardar los aditamentos del detalle
					$this->guardar_aditamentos($arrDet);
				}
				

			}//Cierre de foreach Detalle

		}//Cierre de foreach Detalles

	}

	//Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objMaquinariaInventario)
	{

		//Dependiendo del tipo modificar datos del inventario
		if($objMaquinariaInventario->strTipo == 'POLIZA')//Si los datos se evian desde el generador de pólizas
		{

			//Asignar datos al array
			$arrDatos = array('codigo_interno' => $objMaquinariaInventario->strCodigoInterno, 
							  'costo' => $objMaquinariaInventario->intCosto, 
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $objMaquinariaInventario->intUsuarioID);
			$this->db->where('sucursal_id', $objMaquinariaInventario->intSucursalID);
			$this->db->where('maquinaria_descripcion_id', $objMaquinariaInventario->intMaquinariaDescripcionID);
			$this->db->where('serie', $objMaquinariaInventario->strSerie);

		}
		else
		{

			//Asignar datos al array
			$arrDatos = array('vendedor_id' => $objMaquinariaInventario->intVendedorID, 
							  'prospecto_id' => $objMaquinariaInventario->intProspectoID, 
							  'observaciones' => $objMaquinariaInventario->strObservaciones,
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $objMaquinariaInventario->intUsuarioID);
			$this->db->where('sucursal_id', $objMaquinariaInventario->intSucursalID);
			$this->db->where('maquinaria_descripcion_id', $objMaquinariaInventario->intMaquinariaDescripcionID);
			$this->db->where('serie', $objMaquinariaInventario->strSerie);
			$this->db->where('consignacion', $objMaquinariaInventario->strConsignacion);

		}
		
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('maquinaria_inventario', $arrDatos);
	}


	//Método para eliminar los datos de maquinarias previamente guardadas
	public function eliminar($intSucursalID, $otdDetalles)
	{
		//Recorremos el arreglo 
		foreach ($otdDetalles as $arrDet)
		{

			//Eliminamos las maquinarias asociadas al movimiento de la tabla: maquinaria_inventario
			$this->db->where('sucursal_id', $intSucursalID);
			$this->db->where('maquinaria_descripcion_id', $arrDet->maquinaria_descripcion_id);
			$this->db->where('serie', $arrDet->serie);
			$this->db->where('consignacion', $arrDet->consignacion);
			$this->db->delete('maquinaria_inventario');	

			//Eliminamos los aditamentos asociadas a la serie de la tabla: maquinaria_inventario_aditamentos
			$this->db->where('serie', $arrDet->serie);
			$this->db->delete('maquinaria_inventario_aditamentos');	

		}//Cierre del foreach

	}

	//Método para modificar el estatus de las maquinarias de un movimiento
	public function set_estatus_maquinarias($intSucursalID, $otdDetalles)
	{
		//Recorremos el arreglo 
		foreach ($otdDetalles as $arrDet)
		{

			//Asignar datos al array
			$arrDatos = array('estatus' => 'INACTIVO',
						  	  'fecha_eliminacion' => date("Y-m-d H:i:s"),
						  	  'usuario_eliminacion' => $this->session->userdata('usuario_id'));

			//Actualizar los datos del registro
			$this->db->where('sucursal_id', $intSucursalID);
			$this->db->where('maquinaria_descripcion_id', $arrDet->maquinaria_descripcion_id);
			$this->db->where('serie', $arrDet->serie);
			$this->db->where('consignacion', $arrDet->consignacion);
			$this->db->limit(1);
			//Actualizar los datos del registro
			$this->db->update('maquinaria_inventario', $arrDatos);

		}//Cierre del foreach

	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMaquinariaDescripcionID = NULL, $strSerie = NULL, 
						   $strConsignacion = NULL, $strBusqueda = NULL)
	{

		$this->db->select("MI.maquinaria_descripcion_id, MI.serie, MI.motor, 
						   MI.codigo, MI.descripcion_corta, MI.descripcion, MI.consignacion, 
						   MI.vendedor_id, MI.prospecto_id, MI.observaciones, MME.folio AS folio_entrada, 
						   DATE_FORMAT(MME.fecha,'%d/%m/%Y') AS fecha_entrada,
						   MMS.folio AS folio_salida, DATE_FORMAT(MMS.fecha,'%d/%m/%Y') AS fecha_salida, 
						   CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre) AS vendedor,
						   CONCAT_WS(' - ', P.codigo, P.nombre_comercial) AS prospecto", FALSE);
		$this->db->from('maquinaria_inventario AS MI');
		$this->db->join('movimientos_maquinaria AS MME', 'MI.entrada_id = MME.movimiento_maquinaria_id', 'left');
		$this->db->join('movimientos_maquinaria AS MMS', 'MI.salida_id = MMS.movimiento_maquinaria_id', 'left');
		$this->db->join('vendedores AS V', 'MI.vendedor_id = V.vendedor_id', 'left');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'left');
	    $this->db->join('prospectos AS P', 'MI.prospecto_id = P.prospecto_id', 'left');
		$this->db->where('MI.sucursal_id', $this->session->userdata('sucursal_id'));
		//Si existen id´s del inventario
		if ($intMaquinariaDescripcionID !== NULL && $strSerie !== NULL)
		{   
			$this->db->where('MI.maquinaria_descripcion_id', $intMaquinariaDescripcionID);
			$this->db->where('MI.serie', $strSerie);

			//Si existe consignación
			if($strConsignacion !== NULL)
			{
				$this->db->where('MI.consignacion', $strConsignacion);
			}
			
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->where("(MI.serie LIKE '%$strBusqueda%' OR 
							   MI.motor LIKE '%$strBusqueda%' OR 
							   MI.codigo LIKE '%$strBusqueda%' OR
							   MI.descripcion_corta LIKE '%$strBusqueda%' OR
							   MI.consignacion LIKE '%$strBusqueda%')");
			$this->db->order_by('MI.serie', 'ASC');
			return $this->db->get()->result();
		}
	}

	/*Método para regresar el inventario de maquinaria que coincida con 
	 *los criterios de búsqueda proporcionados (se utiliza en el reporte de inventario)*/
	public function buscar_inventario($dteFechaCorte, $strConsignacion, $intMaquinariaLineaID, 
						   			  $intMaquinariaMarcaID, $intMaquinariaModeloID)
	{
		$this->db->select("MI.maquinaria_descripcion_id, MI.serie, MI.motor, MI.consignacion, 
						   MI.vendedor_id, MI.prospecto_id, MI.observaciones,
						   DATE_FORMAT(MM.fecha,'%d/%m/%Y') AS fecha, MM.folio AS folio_entrada, 
						   CONCAT_WS(' - ', MI.codigo, MI.descripcion_corta) AS maquinaria_descripcion, 
						   MDL.descripcion AS maquinaria_linea, MDM.descripcion AS maquinaria_marca,
					       MDMO.descripcion AS maquinaria_modelo, 
					       CONCAT(EMP.codigo, ' - ', EMP.apellido_paterno,' ', EMP.apellido_materno,' ', EMP.nombre) AS vendedor, 
					       CONCAT_WS(' - ', P.codigo, P.nombre_comercial) AS prospecto", FALSE);
	    $this->db->from('maquinaria_inventario AS MI');
	    $this->db->join('movimientos_maquinaria AS MM', 'MI.entrada_id = MM.movimiento_maquinaria_id', 'inner');
	    $this->db->join('maquinaria_descripciones AS MD', 
	    				'MI.maquinaria_descripcion_id = MD.maquinaria_descripcion_id', 'inner');
	    $this->db->join('maquinaria_lineas AS MDL', 'MD.maquinaria_linea_id = MDL.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MDM', 'MD.maquinaria_marca_id = MDM.maquinaria_marca_id', 'inner');
	    $this->db->join('maquinaria_modelos AS MDMO', 'MD.maquinaria_modelo_id = MDMO.maquinaria_modelo_id', 'inner');
	    $this->db->join('vendedores AS V', 'MI.vendedor_id = V.vendedor_id', 'left');
		$this->db->join('empleados AS EMP', 'V.empleado_id = EMP.empleado_id', 'left');
	    $this->db->join('prospectos AS P', 'MI.prospecto_id = P.prospecto_id', 'left');
		$this->db->where('MI.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where('MI.salida_id IS NULL');
		$this->db->where("(MI.estatus <> 'INACTIVO')");
		$this->db->where("MM.fecha  <= '$dteFechaCorte'", NULL, FALSE);	
		//Si existe id de la línea de maquinaria
	    if($intMaquinariaLineaID > 0)
	    {
	   		$this->db->where('MD.maquinaria_linea_id', $intMaquinariaLineaID);
	    }
	    //Si existe id de la marca de maquinaria
	    if($intMaquinariaMarcaID > 0)
	    {
	   		$this->db->where('MD.maquinaria_marca_id', $intMaquinariaMarcaID);
	    }
		//Si existe id del modelo de maquinaria
	    if($intMaquinariaModeloID > 0)
	    {
	   		$this->db->where('MD.maquinaria_modelo_id', $intMaquinariaModeloID);
	    }
	    //Si existe consignación
		if($strConsignacion != 'TODOS')
		{
			$this->db->where('MI.consignacion', $strConsignacion);
		} 
		$this->db->order_by('MI.maquinaria_descripcion_id ASC');
		return $this->db->get()->result();
	}

	/*Método para regresar el inventario concentrado de maquinaria que coincida con 
	 *los criterios de búsqueda proporcionados (se utiliza en el reporte de inventario concentrado)*/
	public function buscar_inventario_concentrado($dteFechaCorte, $intMaquinariaLineaID, 
						   			              $intMaquinariaMarcaID, $intMaquinariaModeloID)
	{
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';

		//Si existe id de la línea de maquinaria
		if($intMaquinariaLineaID > 0)
		{
			$strRestricciones .= " AND MD.maquinaria_linea_id = $intMaquinariaLineaID";
		}

		//Si existe id de la marca de maquinaria
		if($intMaquinariaMarcaID > 0)
		{
			$strRestricciones .= " AND MD.maquinaria_marca_id = $intMaquinariaMarcaID";
		}

		//Si existe id del modelo de maquinaria
		if($intMaquinariaModeloID > 0)
		{
			$strRestricciones .= " AND MD.maquinaria_modelo_id = $intMaquinariaModeloID";
		}

		$strSQL = $this->db->query("SELECT MD.maquinaria_linea_id, MDM.maquinaria_marca_id, MI.maquinaria_descripcion_id, 
										   S.sucursal_id, MDL.descripcion AS maquinaria_linea, 
										   MDM.descripcion AS maquinaria_marca,  
										   MI.descripcion_corta AS maquinaria_descripcion, 
										   COUNT(MI.maquinaria_descripcion_id) AS existencia
									FROM maquinaria_inventario AS MI
									INNER JOIN sucursales AS S ON MI.sucursal_id = S.sucursal_id
									INNER JOIN movimientos_maquinaria AS MM ON MI.entrada_id = MM.movimiento_maquinaria_id
									INNER JOIN maquinaria_descripciones AS MD ON MI.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
									INNER JOIN maquinaria_lineas AS MDL ON  MD.maquinaria_linea_id = MDL.maquinaria_linea_id
									INNER JOIN maquinaria_marcas AS MDM ON MD.maquinaria_marca_id = MDM.maquinaria_marca_id
									INNER JOIN maquinaria_modelos AS MDMO ON MD.maquinaria_modelo_id = MDMO.maquinaria_modelo_id
									WHERE MI.salida_id IS NULL
									AND MM.fecha  <= '$dteFechaCorte'
									$strRestricciones
									GROUP BY MD.maquinaria_linea_id, MDM.maquinaria_marca_id, MI.maquinaria_descripcion_id, MI.descripcion_corta, S.sucursal_id
									ORDER BY MDL.descripcion, MDM.descripcion,  MI.maquinaria_descripcion_id, MI.descripcion_corta ASC");
		return $strSQL->result();
	}
	
	  /*Método para regresar el total de pedidos de la maquinaria
	  que coincida con los criterios de búsqueda proporcionados (se utiliza en el reporte de inventario concentrado)*/
	public function buscar_pedidos_inventario_concentrado($dteFechaCorte, $intMaquinariaDescripcionID, $intMaquinariaLineaID, 
						   			                      $intMaquinariaMarcaID, $intMaquinariaModeloID = NULL)
	{
		//Variable que se utiliza para agregar restricción para la búsqueda de datos
		$strRestricciones = '';

		//Si existe id del modelo de maquinaria
		if($intMaquinariaModeloID > 0)
		{
			$strRestricciones .= " AND MDPM.maquinaria_modelo_id = $intMaquinariaModeloID";
		}

		$strSQL = $this->db->query("SELECT COUNT(PM.pedido_maquinaria_id)  total_pedidos
									FROM pedidos_maquinaria AS PM
									INNER JOIN maquinaria_descripciones AS MDPM ON PM.maquinaria_descripcion_id = MDPM.maquinaria_descripcion_id
									WHERE PM.fecha <= '$dteFechaCorte'
									AND   MDPM.maquinaria_descripcion_id = $intMaquinariaDescripcionID
									AND   MDPM.maquinaria_linea_id = $intMaquinariaLineaID
									AND   MDPM.maquinaria_marca_id = $intMaquinariaMarcaID
									$strRestricciones
									AND (PM.estatus = 'ACTIVO' OR PM.estatus = 'AUTORIZADO')");
		return $strSQL->result();
	}

	//Método para regresar las monedas que coincidan con el criterio de búsqueda proporcionado
	public function buscar_distintas_sucursales_inventario_concentrado($dteFechaCorte, $intMaquinariaLineaID, 
						   			              					   $intMaquinariaMarcaID, $intMaquinariaModeloID)
	{
		$this->db->select("DISTINCT  S.sucursal_id, S.nombre", FALSE);
		$this->db->from('maquinaria_inventario AS MI');
	    $this->db->join('sucursales AS S', 'MI.sucursal_id = S.sucursal_id', 'inner');
	    $this->db->join('movimientos_maquinaria AS MM', 'MI.entrada_id = MM.movimiento_maquinaria_id', 'inner');
	    $this->db->join('maquinaria_descripciones AS MD', 
	    				'MI.maquinaria_descripcion_id = MD.maquinaria_descripcion_id', 'inner');
	    $this->db->join('maquinaria_lineas AS MDL', 'MD.maquinaria_linea_id = MDL.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MDM', 'MD.maquinaria_marca_id = MDM.maquinaria_marca_id', 'inner');
	    $this->db->join('maquinaria_modelos AS MDMO', 'MD.maquinaria_modelo_id = MDMO.maquinaria_modelo_id', 'inner');
		$this->db->where("MM.fecha  <= '$dteFechaCorte'", NULL, FALSE);	
		//Si existe id de la línea de maquinaria
	    if($intMaquinariaLineaID > 0)
	    {
	   		$this->db->where('MD.maquinaria_linea_id', $intMaquinariaLineaID);
	    }
	    //Si existe id de la marca de maquinaria
	    if($intMaquinariaMarcaID > 0)
	    {
	   		$this->db->where('MD.maquinaria_marca_id', $intMaquinariaMarcaID);
	    }
		//Si existe id del modelo de maquinaria
	    if($intMaquinariaModeloID > 0)
	    {
	   		$this->db->where('MD.maquinaria_modelo_id', $intMaquinariaModeloID);
	    }
		return $this->db->get()->result();
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->where('MI.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where("(MI.serie LIKE '%$strBusqueda%' OR 
						   MI.motor LIKE '%$strBusqueda%' OR 
						   MI.codigo LIKE '%$strBusqueda%' OR
						   MI.descripcion_corta LIKE '%$strBusqueda%' OR
						   MI.consignacion LIKE '%$strBusqueda%')");
		$this->db->from('maquinaria_inventario AS MI');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('MI.maquinaria_descripcion_id, MI.serie, MI.motor, MI.codigo, MI.descripcion_corta, 
						   MI.consignacion');
		$this->db->from('maquinaria_inventario AS MI');
		$this->db->where('MI.sucursal_id', $this->session->userdata('sucursal_id'));
		$this->db->where("(MI.serie LIKE '%$strBusqueda%' OR 
						   MI.motor LIKE '%$strBusqueda%' OR 
						   MI.codigo LIKE '%$strBusqueda%' OR
						   MI.descripcion_corta LIKE '%$strBusqueda%' OR
						   MI.consignacion LIKE '%$strBusqueda%')");
		$this->db->order_by('MI.serie', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["inventarios"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion, $intMaquinariaDescripcionID, $strTipo, 
								 $strFormulario)
	{
		$this->db->select(' MI.maquinaria_descripcion_id, 
							MI.serie, 
							MI.motor,
							CONCAT_WS(" - ", MI.serie, MI.motor) AS serie_motor, 
							MI.consignacion,
							MD.codigo,
							MD.descripcion,
							MD.descripcion_corta, 
							MI.numero_pedimento', FALSE);
		$this->db->from('maquinaria_inventario MI');
		$this->db->join('maquinaria_descripciones MD', 'MD.maquinaria_descripcion_id = MI.maquinaria_descripcion_id', 'inner');
		$this->db->where('MI.sucursal_id', $this->session->userdata('sucursal_id'));
		
		//Si el formulario (proceso) no corresponde a ordenes de reparación internas
		if($strFormulario != 'ordenes_reparacion_internas')
		{
			$this->db->where('MI.estatus', 'ACTIVO');

			if($strFormulario == 'facturacion')
			{

				 $this->db->where("MI.serie IN (SELECT serie FROM ordenes_reparacion OREP WHERE  OREP.estatus = 'FINALIZADO')", NULL, FALSE);

				  $this->db->where("MI.serie IN (SELECT serie FROM ordenes_reparacion OREP WHERE  OREP.estatus = 'FINALIZADO' )", NULL, FALSE);

			}

		}



		//Si existe el id de la descripción de maquinaria
		if($intMaquinariaDescripcionID > 0)
		{
			$this->db->where('MD.maquinaria_descripcion_id', $intMaquinariaDescripcionID);
			$this->db->where('MI.salida_id IS NULL');
		}

		//Dependiendo del tipo realizar búsqueda de datos
		if($strTipo == 'serie')
		{
			$this->db->where("(MI.serie LIKE '%$strDescripcion%')");
			$this->db->order_by("MI.serie",'ASC');
		}
		else
		{
			$this->db->where("(MI.motor LIKE '%$strDescripcion%')"); 
			$this->db->order_by("MI.motor",'ASC');
		}
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
		return $this->db->get()->result();
	}

	//Método para modificar el estatus de una MAQUINARIA SIMPLE
	public function set_estatus($intMaquinariaDescripcionID, $strSerie, $strEstatus, 
								$intMovimientoSalidaID = NULL, $strConsignacion = NULL, 
								$intSucursalIDSalida = NULL)
	{

		//Variable que se utiliza para asignar el id de la sucursal seleccionada
		$intSucursalID = $this->session->userdata('sucursal_id');

		//Si existe id de la sucursal de salida
		if($intSucursalIDSalida > 0)
		{
		   $intSucursalID = $intSucursalIDSalida;
		}

		//Dependiendo del estatus actualizar el registro
		if($strEstatus == 'FACTURADO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		}
		else if($strEstatus == 'ACTIVO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'salida_id' => NULL,
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		}
		else if($strEstatus == 'TRASPASO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'salida_id' => $intMovimientoSalidaID,
							  'fecha_actualizacion' => date("Y-m-d H:i:s"),
							  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		}
		else if($strEstatus == 'INACTIVO')
		{
			//Asignar datos al array
			$arrDatos = array('estatus' => $strEstatus,
							  'fecha_eliminacion' => date("Y-m-d H:i:s"),
							  'usuario_eliminacion' => $this->session->userdata('usuario_id'));
		}
		$this->db->where('maquinaria_descripcion_id', $intMaquinariaDescripcionID);
		$this->db->where('serie', $strSerie);
		//Si existe consignación
		if($strConsignacion !== NULL)
		{
			$this->db->where('consignacion', $strConsignacion);
		}

		$this->db->where('sucursal_id', $intSucursalID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('maquinaria_inventario', $arrDatos);
	}

	//Método para modificar el estatus de una MAQUINARIA COMPUESTA
	public function set_estatus_componentes($strMaquinariaDescripcionID, $strSeries, $strEstatus, $strConsignacion)
	{
		//Si se cumple la sentencia
		if($strEstatus == 'FACTURADO' OR $strEstatus == 'ACTIVO')
		{

			//Si existen maquinarias descripciones ID
			if($strMaquinariaDescripcionID !== '')
			{
				//Quitar | de la lista para obtener el ID de la maquinaria y la serie
				$arrMaquinariaDescripcionID = explode("|", $strMaquinariaDescripcionID);
				$arrSeries = explode("|", $strSeries);
				$arrConsignacion = explode("|", $strConsignacion);

				//Hacer recorrido para modificar los datos en la tabla maquinaria_inventario
				for ($intCon = 0; $intCon < sizeof($arrMaquinariaDescripcionID); $intCon++) 
				{	
					
					//Si el estatus es ACTIVO
					if($strEstatus == 'ACTIVO')
					{
						//Asignar datos al array
						$arrDatos = array('estatus' => $strEstatus,
										  'salida_id' => NULL,
									 	  'fecha_actualizacion' => date("Y-m-d H:i:s"),
									      'usuario_actualizacion' => $this->session->userdata('usuario_id'));
					}
					else
					{

						//Asignar datos al array
						$arrDatos = array('estatus' => $strEstatus,
									  	  'fecha_actualizacion' => date("Y-m-d H:i:s"),
									  	  'usuario_actualizacion' => $this->session->userdata('usuario_id'));
					}
					
					
					$this->db->where('maquinaria_descripcion_id', $arrMaquinariaDescripcionID[$intCon]);
					$this->db->where('serie', $arrSeries[$intCon] );
					$this->db->where('consignacion', $arrConsignacion[$intCon]);
					$this->db->where('sucursal_id', $this->session->userdata('sucursal_id'));
					$this->db->limit(1);
					//Actualizar los datos del registro
					$this->db->update('maquinaria_inventario', $arrDatos);

				}

			}

		}	
	}

	//Métodos para efectuar un cambio de estatus en el INVENTARIO DE MAQUINARA referentes a DEVOLUCIONES
	//Entrada por devolución 
	public function set_estatus_devolucion($intMaquinariaDescripcionID, $strSerie, $intSucursalID){

		//Asignar datos al array
		$arrDatos = array(	'estatus' => 'ACTIVO',
							'salida_id' => NULL,
							'fecha_actualizacion' => date("Y-m-d H:i:s"),
							'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('maquinaria_descripcion_id', $intMaquinariaDescripcionID);
		$this->db->where('serie', $strSerie);
		$this->db->where('sucursal_id', $intSucursalID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('maquinaria_inventario', $arrDatos);

	}

	//CANCELAR una Entrada por devolución
	public function set_cancelar_estatus_devolucion($intMaquinariaDescripcionID, $strSerie, $intSucursalID, $strEstatus, $intSalidaID = NULL){

		//Asignar datos al array
		$arrDatos = array(	'estatus' => $strEstatus,
							'salida_id' => $intSalidaID,
							'fecha_actualizacion' => date("Y-m-d H:i:s"),
							'usuario_actualizacion' => $this->session->userdata('usuario_id'));
		$this->db->where('maquinaria_descripcion_id', $intMaquinariaDescripcionID);
		$this->db->where('serie', $strSerie);
		$this->db->where('sucursal_id', $intSucursalID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('maquinaria_inventario', $arrDatos);

	}

	//Método para regresar el estatus de una Maquinaria que será objeto de devolución
	public function buscar_estatus_devolucion($intMaquinariaDescripcionID, $strSerie, $intSucursalID)
	{

		$this->db->select('MI.salida_id', FALSE);
		$this->db->from('maquinaria_inventario MI');
		$this->db->where('MI.maquinaria_descripcion_id', $intMaquinariaDescripcionID );
		$this->db->where('MI.serie', $strSerie );
		$this->db->where('MI.sucursal_id', $intSucursalID);
		$this->db->limit(1);
		return $this->db->get()->row();

	}

	//Método para regresar el código interno máximo del inventario de maquinaria
	public function buscar_codigo_interno($strConsignacion)
	{
		$this->db->select('IFNULL(MAX(MI.codigo_interno),0) AS codigo_interno', FALSE);
		$this->db->from('maquinaria_inventario AS MI');
		$this->db->where('MI.consignacion', $strConsignacion);
		$this->db->limit(1);
		return $this->db->get()->row();
	}


	//Método para regresar el código interno de la serie
	public function buscar_codigo_interno_serie($intMaquinariaDescripcionID, $strSerie, $strConsignacion)
	{
		$this->db->select('MI.codigo_interno', FALSE);
		$this->db->from('maquinaria_inventario AS MI');
		$this->db->where('MI.maquinaria_descripcion_id', $intMaquinariaDescripcionID);
		$this->db->where('MI.serie', $strSerie);
		$this->db->where('MI.consignacion', $strConsignacion);
		$this->db->limit(1);
		return $this->db->get()->row();
	}



	//Función que se utiliza para regresar el código interno consecutivo
	function get_codigo_interno($strConsignacion)
	{	
		//Variable que se utiliza para regresar el código consecutivo
    	$strCodigoConsecutivo = '';

		//Hacer un llamado al método para obtener el código interno máximo del inventario de maquinaria
		$otdResultado = $this->buscar_codigo_interno($strConsignacion);

		//Si existen datos
		if($otdResultado)
		{
			//Asignar valores
	    	$strCodigoInterno = $otdResultado->codigo_interno;

	    	//Concatenar al consecutivo el incremento de ceros
	    	$strCodigoConsecutivo = str_pad(($strCodigoInterno + 1), 5, "0", STR_PAD_LEFT);

		}

		//Regresar código consecutivo
		return $strCodigoConsecutivo;
	}

	//Método para regresar los rastreos de maquinaria que coincidan con los criterios de búsqueda proporcionados (se utiliza para generar póliza de orden de reparación interna)
	public function buscar_rastreo_orden($strSerie, $dteFecha, $intSucursalID, $strTipo)
	{
		//Constante para identificar al tipo de servicio: facturación
		$intTipoServicioFacturacion = TIPO_SERVICIO_FACTURACION;
		//Constante para identificar al tipo de movimiento salida de maquinaria por venta
		$intMovSalidaVenta = SALIDA_MAQUINARIA_VENTA;
		//Constante para identificar al tipo de movimiento salida de maquinaria por traspaso
		$intMovSalidaTraspaso = SALIDA_MAQUINARIA_TRASPASO;
		//Constante para identificar al tipo de movimiento salida de maquinaria por demostración
		$intMovSalidaDemostracion = SALIDA_MAQUINARIA_DEMOSTRACION;
		//Constante para identificar al tipo de movimiento salida de maquinaria por validación
		$intMovSalidaValidacion = SALIDA_MAQUINARIA_VALIDACION;

		//Variable que se utiliza para formar la  consulta
		$queryRastreos = '';

		//Dependiendo del tipo realizar búsqueda de datos
		if($strTipo == 'inventario')
		{
			//Inventario de maquinaria
			$queryRastreos = "SELECT MI.sucursal_id, MI.serie, MI.motor, MI.descripcion_corta, 
									MI.consignacion, MI.codigo_interno, ML.maquinaria_linea_id AS Modulo
							   FROM   maquinaria_inventario AS MI 
							   INNER JOIN maquinaria_descripciones AS MD 
							         ON MI.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
							   INNER JOIN maquinaria_lineas AS ML 
							   		 ON MD.maquinaria_linea_id = ML.maquinaria_linea_id
							  WHERE  MI.serie = '$strSerie'
							  AND    MI.sucursal_id = $intSucursalID";
		}
		else if($strTipo == 'movimientos')
		{
			$queryRastreos ="SELECT MM.movimiento_maquinaria_id AS referencia_id, MM.sucursal_id, 
								   MM.fecha, MM.tipo_movimiento, MI.serie, MI.motor, 
								   MI.descripcion_corta, MI.consignacion, MI.codigo_interno, 
								   ML.maquinaria_linea_id AS Modulo
						     FROM   movimientos_maquinaria AS MM 
						     INNER JOIN movimientos_maquinaria_detalles AS MMD 
							       ON MM.movimiento_maquinaria_id = MMD.movimiento_maquinaria_id
		      	             INNER JOIN maquinaria_descripciones AS MD 
							   	   ON MMD.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
							 INNER JOIN maquinaria_lineas AS ML 
							 	  ON MD.maquinaria_linea_id = ML.maquinaria_linea_id 
							 INNER JOIN maquinaria_inventario AS MI 
							       ON MM.sucursal_id = MI.sucursal_id
		         				   AND MMD.maquinaria_descripcion_id = MI.maquinaria_descripcion_id
								   AND MMD.serie = MI.serie
						    WHERE  MMD.serie = '$strSerie'
							AND    MM.fecha <= '$dteFecha' 
							AND    MM.estatus <> 'INACTIVO'
						    AND    MM.tipo_movimiento <> $intMovSalidaVenta
							AND    MM.tipo_movimiento <> $intMovSalidaTraspaso
							AND    MM.tipo_movimiento <> $intMovSalidaDemostracion
							AND    MM.tipo_movimiento <> $intMovSalidaValidacion";
		$queryRastreos.=" UNION ";
		$queryRastreos.="SELECT FM.factura_maquinaria_id AS referencia_id, FM.sucursal_id, 
							    FM.fecha, $intTipoServicioFacturacion AS tipo_movimiento, MI.serie,
						       MI.motor, MI.descripcion_corta, MI.consignacion, 
						       MI.codigo_interno, ML.maquinaria_linea_id AS Modulo
		                 FROM   facturas_maquinaria AS FM 
		                 INNER JOIN maquinaria_inventario AS MI ON FM.sucursal_id = MI.sucursal_id 
						       AND FM.maquinaria_descripcion_id = MI.maquinaria_descripcion_id
							   AND FM.serie = MI.serie 
						 INNER JOIN maquinaria_descripciones AS MD 
							   ON FM.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
					     INNER JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id 
						 WHERE  FM.serie = '$strSerie'
						 AND    FM.fecha <= '$dteFecha'
						 AND    FM.estatus <> 'INACTIVO' ";
		$queryRastreos.=" UNION ";
		$queryRastreos.="SELECT FM.factura_maquinaria_id AS referencia_id, FM.sucursal_id, FM.fecha, 
								$intTipoServicioFacturacion AS tipo_movimiento, MI.serie, 
						        MI.motor, MI.descripcion_corta, MI.consignacion, MI.codigo_interno, 
						        ML.maquinaria_linea_id AS Modulo
						 FROM   facturas_maquinaria AS FM 
						 INNER JOIN facturas_maquinaria_detalles AS FMD
					           ON FM.factura_maquinaria_id = FMD.factura_maquinaria_id
		   				 INNER JOIN maquinaria_descripciones AS MD 
							   ON FMD.maquinaria_descripcion_id = MD.maquinaria_descripcion_id
						 INNER JOIN maquinaria_lineas AS ML ON MD.maquinaria_linea_id = ML.maquinaria_linea_id 
						 INNER JOIN maquinaria_inventario AS MI ON FM.sucursal_id = MI.sucursal_id
					       	  AND FMD.maquinaria_descripcion_id = MI.maquinaria_descripcion_id 
						      AND FMD.serie = MI.serie
						 WHERE  FMD.serie = '$strSerie'
						 AND    FM.fecha <= '$dteFecha'
						 AND    FM.estatus <> 'INACTIVO'
						ORDER BY fecha, tipo_movimiento";
		}

		//Ejecutar consulta
		$strSQL = $this->db->query($queryRastreos);
		return $strSQL->row();

	}



	/*******************************************************************************************************************
	Funciones de la tabla maquinaria_inventario_aditamentos
	*********************************************************************************************************************/
	//Función que se utiliza para guardar aditamentos en el inventario
	public function guardar_aditamentos($otdDetalle)
	{
		//Hacer recorrido para insertar los datos en la tabla maquinaria_inventario_aditamentos
		for ($intCon = 0; $intCon < sizeof($otdDetalle->arrAditamentos); $intCon++) 
		{	
			//Asignar datos al array
			$arrDatos = array('serie' => $otdDetalle->strSerie,
				   			  'renglon' =>($intCon + 1),
							  'cantidad' => $otdDetalle->arrAditamentos[$intCon]->intCantidad,
							  'descripcion' => $otdDetalle->arrAditamentos[$intCon]->strDescripcion);
			//Guardar los datos del registro
			$this->db->insert('maquinaria_inventario_aditamentos', $arrDatos);
		}

	}

	//Método para regresar los aditamentos de una serie
	public function buscar_aditamentos($strSerie)
	{
		$this->db->select('serie, renglon, cantidad, descripcion');
		$this->db->from('maquinaria_inventario_aditamentos');
		$this->db->where('serie', $strSerie);
		$this->db->order_by('renglon', 'ASC');
		return $this->db->get()->result();
	}

}
?>