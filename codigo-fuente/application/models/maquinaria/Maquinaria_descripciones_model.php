<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maquinaria_descripciones_model extends CI_model {

	/*******************************************************************************************************************
	Funciones de la tabla maquinaria_descripciones
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objMaquinariaDescripcion)
	{
				
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Asignar datos al array
		$arrDatos = array('codigo' => $objMaquinariaDescripcion->strCodigo, 
						  'producto_servicio_id' => $objMaquinariaDescripcion->intProductoServicioID, 
						  'unidad_id' => $objMaquinariaDescripcion->intUnidadID,
						  'objeto_impuesto_id' => $objMaquinariaDescripcion->intObjetoImpuestoID, 
						  'descripcion_corta' => $objMaquinariaDescripcion->strDescripcionCorta, 
						  'descripcion' => $objMaquinariaDescripcion->strDescripcion, 
						  'servicio' => $objMaquinariaDescripcion->strServicio, 
						  'maquinaria_linea_id' => $objMaquinariaDescripcion->intMaquinariaLineaID,
						  'maquinaria_marca_id' => $objMaquinariaDescripcion->intMaquinariaMarcaID,
						  'maquinaria_modelo_id' => $objMaquinariaDescripcion->intMaquinariaModeloID,
						  'meses_garantia' => $objMaquinariaDescripcion->intMesesGarantia, 
						  'horas_garantia' => $objMaquinariaDescripcion->intHorasGarantia, 
						  'moneda_id' => $objMaquinariaDescripcion->intMonedaID,
						  'tasa_cuota_iva' => $objMaquinariaDescripcion->intTasaCuotaIva,
						  'tasa_cuota_ieps' => $objMaquinariaDescripcion->intTasaCuotaIeps, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMaquinariaDescripcion->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('maquinaria_descripciones', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objMaquinariaDescripcion->intMaquinariaDescripcionID  = $this->db->insert_id();

		
		//Hacer un llamado al método para guardar los componentes de la maquinaria
		$this->guardar_componentes($objMaquinariaDescripcion);
		
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
		

	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objMaquinariaDescripcion)
	{
		
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Asignar datos al array
		$arrDatos = array('codigo' => $objMaquinariaDescripcion->strCodigo, 
						  'producto_servicio_id' => $objMaquinariaDescripcion->intProductoServicioID, 
						  'unidad_id' => $objMaquinariaDescripcion->intUnidadID,
						  'objeto_impuesto_id' => $objMaquinariaDescripcion->intObjetoImpuestoID, 
						  'descripcion_corta' => $objMaquinariaDescripcion->strDescripcionCorta, 
						  'descripcion' => $objMaquinariaDescripcion->strDescripcion, 
						  'servicio' => $objMaquinariaDescripcion->strServicio, 
						  'maquinaria_linea_id' => $objMaquinariaDescripcion->intMaquinariaLineaID,
						  'maquinaria_marca_id' => $objMaquinariaDescripcion->intMaquinariaMarcaID,
						  'maquinaria_modelo_id' => $objMaquinariaDescripcion->intMaquinariaModeloID,
						  'meses_garantia' => $objMaquinariaDescripcion->intMesesGarantia, 
						  'horas_garantia' => $objMaquinariaDescripcion->intHorasGarantia, 
						  'moneda_id' => $objMaquinariaDescripcion->intMonedaID,
						  'tasa_cuota_iva' => $objMaquinariaDescripcion->intTasaCuotaIva,
						  'tasa_cuota_ieps' => $objMaquinariaDescripcion->intTasaCuotaIeps, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMaquinariaDescripcion->intUsuarioID);
		$this->db->where('maquinaria_descripcion_id', $objMaquinariaDescripcion->intMaquinariaDescripcionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('maquinaria_descripciones', $arrDatos);

		//Eliminar los detalles del movimiento en la tabla: movimientos_maquinaria_detalles
		$this->db->where('maquinaria_descripcion_id', $objMaquinariaDescripcion->intMaquinariaDescripcionID);
		$this->db->delete('maquinaria_descripciones_componentes');
		
		
		//Hacer un llamado al método para guardar los componentes de la maquinaria
		$this->guardar_componentes($objMaquinariaDescripcion);
		
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
		

	}


    //Método para modificar el estatus de un registro
	public function set_estatus($intMaquinariaDescripcionID, $strEstatus)
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
		$this->db->where('maquinaria_descripcion_id', $intMaquinariaDescripcionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('maquinaria_descripciones', $arrDatos);
	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMaquinariaDescripcionID = NULL, $strCodigo = NULL, $strBusqueda = NULL, 
						   $strEstatus = NULL)
	{
		$this->db->select("MD.maquinaria_descripcion_id, MD.codigo, MD.producto_servicio_id, MD.unidad_id,
						   MD.objeto_impuesto_id, MD.descripcion_corta, MD.descripcion, MD.servicio,
						   MD.meses_garantia, MD.horas_garantia, MD.moneda_id,
						   MD.maquinaria_linea_id, MD.maquinaria_marca_id, MD.maquinaria_modelo_id, MD.estatus,
						   CONCAT_WS(' - ', PS.codigo, PS.descripcion) AS producto_servicio, 
						   CONCAT_WS(' - ', U.codigo, U.nombre) AS unidad, 
						   CONCAT_WS(' - ', OImp.codigo, OImp.descripcion) AS objeto_impuesto,
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda,
						   ML.descripcion AS maquinaria_linea ,MM.descripcion AS maquinaria_marca,
						   MD.tasa_cuota_iva,
						   TIva.valor_maximo AS porcentaje_iva,
						   MD.tasa_cuota_ieps,
						   TIeps.valor_maximo AS porcentaje_ieps,
						   MMOD.descripcion AS maquinaria_modelo, PS.codigo AS codigo_sat, U.codigo AS unidad_sat", FALSE);
		$this->db->from('maquinaria_descripciones AS MD');
		$this->db->join('sat_monedas AS M', 'MD.moneda_id = M.moneda_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'MD.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	    $this->db->join('sat_tasa_cuota AS TIeps', 'MD.tasa_cuota_ieps = TIeps.tasa_cuota_id', 'left');
		$this->db->join('maquinaria_lineas AS ML', 'MD.maquinaria_linea_id = ML.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MM', 'MD.maquinaria_marca_id = MM.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'MD.maquinaria_modelo_id = MMOD.maquinaria_modelo_id', 'inner');
		$this->db->join('sat_productos_servicios AS PS', 'MD.producto_servicio_id = PS.producto_servicio_id', 'left');
		$this->db->join('sat_unidades AS U', 'MD.unidad_id = U.unidad_id', 'left');
		$this->db->join('sat_objeto_impuesto AS OImp', 'MD.objeto_impuesto_id = OImp.objeto_impuesto_id', 'left');
		//Si existe id de la descripción de maquinaria
		if ($intMaquinariaDescripcionID !== NULL)
		{   
			$this->db->where('MD.maquinaria_descripcion_id', $intMaquinariaDescripcionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCodigo !== NULL)//Si existe código
		{
			$this->db->where('MD.codigo', $strCodigo);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			//Si existe estatus 
			if($strEstatus !== NULL)
			{
				$this->db->where('MD.estatus', $strEstatus);
			}
			$this->db->where("(MD.codigo LIKE '%$strBusqueda%' OR  
        				       MD.descripcion_corta LIKE '%$strBusqueda%' OR
        				       MD.estatus LIKE '%$strBusqueda%')");
			$this->db->order_by('MD.codigo', 'ASC');
			return $this->db->get()->result();
		}
	}

	

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($strBusqueda, $strEstatus = NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		//Si existe estatus 
		if($strEstatus !== NULL)
		{
			$this->db->where('MD.estatus', $strEstatus);
		}
		$this->db->where("(MD.codigo LIKE '%$strBusqueda%' OR  
        				   MD.descripcion_corta LIKE '%$strBusqueda%' OR
        				   MD.estatus LIKE '%$strBusqueda%')");
		$this->db->from('maquinaria_descripciones AS MD');
		$this->db->join('sat_monedas AS M', 'MD.moneda_id = M.moneda_id', 'inner');
		$this->db->join('maquinaria_lineas AS ML', 'MD.maquinaria_linea_id = ML.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MM', 'MD.maquinaria_marca_id = MM.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'MD.maquinaria_modelo_id = MMOD.maquinaria_modelo_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('MD.maquinaria_descripcion_id, MD.codigo, MD.descripcion_corta, MD.servicio, MD.estatus');
		$this->db->from('maquinaria_descripciones AS MD');
		$this->db->join('sat_monedas AS M', 'MD.moneda_id = M.moneda_id', 'inner');
		$this->db->join('maquinaria_lineas AS ML', 'MD.maquinaria_linea_id = ML.maquinaria_linea_id', 'inner');
		$this->db->join('maquinaria_marcas AS MM', 'MD.maquinaria_marca_id = MM.maquinaria_marca_id', 'inner');
		$this->db->join('maquinaria_modelos AS MMOD', 'MD.maquinaria_modelo_id = MMOD.maquinaria_modelo_id', 'inner');
		//Si existe estatus 
		if($strEstatus !== NULL)
		{
			$this->db->where('MD.estatus', $strEstatus);
		}
		$this->db->where("(MD.codigo LIKE '%$strBusqueda%' OR  
        				   MD.descripcion_corta LIKE '%$strBusqueda%' OR
        				   MD.estatus LIKE '%$strBusqueda%')");
		$this->db->order_by('MD.codigo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["descripciones"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" 
							MD.maquinaria_descripcion_id, 
						    CONCAT_WS(' - ', MD.codigo, MD.descripcion_corta) AS concepto,
						    MD.descripcion, 
						    MD.tasa_cuota_iva,
						    MD.tasa_cuota_ieps,
						    STC1.valor_maximo AS porcentaje_iva,
						    STC2.valor_maximo AS porcentaje_ieps
						  ", FALSE);
        $this->db->from('maquinaria_descripciones MD');
        $this->db->join('sat_tasa_cuota STC1', 'STC1.tasa_cuota_id = MD.tasa_cuota_iva', 'inner');
        $this->db->join('sat_tasa_cuota STC2', 'STC2.tasa_cuota_id = MD.tasa_cuota_ieps', 'left');
   	    $this->db->where('MD.estatus','ACTIVO');
        $this->db->where("(MD.codigo LIKE '%$strDescripcion%' OR  
        				   MD.descripcion_corta LIKE '%$strDescripcion%')");  
		$this->db->order_by('MD.codigo', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}

	/*******************************************************************************************************************
	Funciones de la tabla maquinaria_descripciones_componentes
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los componentes de la maquinaria
	public function guardar_componentes(stdClass $objMaquinariaDescripcion)
	{
		//Hacer un llamado al método para guardar los componentes de una maquinaria en caso de que aplique
		if($objMaquinariaDescripcion->strComponentes != '')
		{
			/*Quitar | de la lista para obtener la referenciaID*/
			$arrComponentes = explode("|", $objMaquinariaDescripcion->strComponentes);

			//Hacer recorrido para insertar los datos en la tabla maquinaria_descripciones_componentes
			for ($intCon = 0; $intCon < sizeof($arrComponentes); $intCon++) 
			{
				//Asignar datos al array
				$arrDatos = array('maquinaria_descripcion_id' => $objMaquinariaDescripcion->intMaquinariaDescripcionID,
								  'renglon' => ($intCon + 1), 
								  'referencia_id' => $arrComponentes[$intCon]);
				//Guardar los datos del registro
				$this->db->insert('maquinaria_descripciones_componentes', $arrDatos);
			}
		}
	}

	//Método para regresar los detalles de un registro
	public function buscar_componentes($intMaquinariaDescripcionID)
	{
		$this->db->select('MDC.maquinaria_descripcion_id, 
							MDC.renglon, 
							MDC.referencia_id,
							MD.maquinaria_descripcion_id AS maquinaria_descripcion_componente_id,
							MD.codigo,
							MD.descripcion_corta, "" AS serie, "" AS motor');
		$this->db->from('maquinaria_descripciones_componentes AS MDC');
		$this->db->join('maquinaria_descripciones MD', 'MD.maquinaria_descripcion_id = MDC.referencia_id', 'inner');
		$this->db->where('MDC.maquinaria_descripcion_id', $intMaquinariaDescripcionID);
		$this->db->order_by('MDC.renglon', 'ASC');
		return $this->db->get()->result();
	}

}
?>