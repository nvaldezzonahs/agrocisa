<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion_polizas_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla configuracion_ieps
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_configuracion_ieps(stdClass $objConfiguracion)
	{
		//Asignar datos al array
		$arrDatos = array('tasa_cuota_id' => $objConfiguracion->intTasaCuotaID,
						  'cuenta' => $objConfiguracion->strCuenta, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objConfiguracion->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('configuracion_ieps', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar_configuracion_ieps(stdClass $objConfiguracion)
	{
		//Asignar datos al array
		$arrDatos = array('tasa_cuota_id' => $objConfiguracion->intTasaCuotaID,
						  'cuenta' => $objConfiguracion->strCuenta, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objConfiguracion->intUsuarioID);
		$this->db->where('configuracion_id', $objConfiguracion->intConfiguracionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('configuracion_ieps', $arrDatos);
	}

	//Método para eliminar los datos de un registro
	public function eliminar_configuracion_ieps($intConfiguracionID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		$this->db->where('configuracion_id', $intConfiguracionID);
		//Eliminar los datos del registro
        $this->db->delete('configuracion_ieps');
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}
   
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_configuracion_ieps($intConfiguracionID = NULL, $intTasaCuotaID = NULL)
	{

		$this->db->select('CI.configuracion_id, CI.tasa_cuota_id, CI.cuenta, 
						   TIeps.valor_maximo AS porcentaje_ieps');
	    $this->db->from('configuracion_ieps AS CI');
	    $this->db->join('sat_tasa_cuota AS TIeps', 'CI.tasa_cuota_id = TIeps.tasa_cuota_id', 'inner');
		//Si existe id de la cuenta
		if ($intConfiguracionID !== NULL)
		{ 
			$this->db->where('CI.configuracion_id', $intConfiguracionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($intTasaCuotaID !== NULL)//Si existe id de la tasa o cuota
		{
			$this->db->where('CI.tasa_cuota_id', $intTasaCuotaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->order_by('TIeps.valor_maximo', 'ASC');
			return $this->db->get()->result();
		}
	}

	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_configuracion_ieps($intNumRows, $intPos)
	{
		$this->db->from('configuracion_ieps AS CI');
	    $this->db->join('sat_tasa_cuota AS TIeps', 'CI.tasa_cuota_id = TIeps.tasa_cuota_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select('CI.configuracion_id, CI.cuenta, 
						   TIeps.valor_maximo AS porcentaje_ieps');
	    $this->db->from('configuracion_ieps AS CI');
	    $this->db->join('sat_tasa_cuota AS TIeps', 'CI.tasa_cuota_id = TIeps.tasa_cuota_id', 'inner');
	   
		$this->db->order_by('TIeps.valor_maximo', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["configuraciones"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*******************************************************************************************************************
	Funciones de la tabla configuracion_monedas
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_configuracion_monedas(stdClass $objConfiguracion)
	{
		//Asignar datos al array
		$arrDatos = array('moneda_id' => $objConfiguracion->intMonedaID,
						  'cuenta' => $objConfiguracion->strCuenta, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objConfiguracion->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('configuracion_monedas', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar_configuracion_monedas(stdClass $objConfiguracion)
	{
		//Asignar datos al array
		$arrDatos = array('moneda_id' => $objConfiguracion->intMonedaID,
						  'cuenta' => $objConfiguracion->strCuenta, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objConfiguracion->intUsuarioID);
		$this->db->where('configuracion_id', $objConfiguracion->intConfiguracionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('configuracion_monedas', $arrDatos);
	}


	//Método para eliminar los datos de un registro
	public function eliminar_configuracion_monedas($intConfiguracionID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		$this->db->where('configuracion_id', $intConfiguracionID);
		//Eliminar los datos del registro
        $this->db->delete('configuracion_monedas');
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}
   
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_configuracion_monedas($intConfiguracionID = NULL, $intMonedaID = NULL)
	{
		$this->db->select("CM.configuracion_id, CM.moneda_id, CM.cuenta,  
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda", FALSE);
	    $this->db->from('configuracion_monedas AS CM');
	    $this->db->join('sat_monedas AS M', 'CM.moneda_id = M.moneda_id', 'inner');
		//Si existe id de la cuenta
		if ($intConfiguracionID !== NULL)
		{ 
			$this->db->where('CM.configuracion_id', $intConfiguracionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($intMonedaID !== NULL)//Si existe id de la moneda
		{
			$this->db->where('CM.moneda_id', $intMonedaID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->order_by('M.moneda_id', 'ASC');
			return $this->db->get()->result();
		}
	}

	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_configuracion_monedas($intNumRows, $intPos)
	{
		$this->db->from('configuracion_monedas AS CM');
	    $this->db->join('sat_monedas AS M', 'CM.moneda_id = M.moneda_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CM.configuracion_id, CM.cuenta, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda", FALSE);
	    $this->db->from('configuracion_monedas AS CM');
	    $this->db->join('sat_monedas AS M', 'CM.moneda_id = M.moneda_id', 'inner');
		$this->db->order_by('M.moneda_id', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["configuraciones"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*******************************************************************************************************************
	Funciones de la tabla configuracion_departamentos
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_configuracion_departamentos(stdClass $objConfiguracion)
	{
		//Asignar datos al array
		$arrDatos = array('referencia_id' => $objConfiguracion->intReferenciaID,
						  'tipo_referencia' => $objConfiguracion->strTipoReferencia,
						  'cuenta' => $objConfiguracion->strCuenta, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objConfiguracion->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('configuracion_departamentos', $arrDatos);
	}


	//Método para modificar los datos de un registro previamente guardado
	public function modificar_configuracion_departamentos(stdClass $objConfiguracion)
	{
		//Asignar datos al array
		$arrDatos = array('referencia_id' => $objConfiguracion->intReferenciaID,
						  'tipo_referencia' => $objConfiguracion->strTipoReferencia,
						  'cuenta' => $objConfiguracion->strCuenta, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objConfiguracion->intUsuarioID);
		$this->db->where('configuracion_id', $objConfiguracion->intConfiguracionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('configuracion_departamentos', $arrDatos);
	}

	//Método para eliminar los datos de un registro
	public function eliminar_configuracion_departamentos($intConfiguracionID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		$this->db->where('configuracion_id', $intConfiguracionID);
		//Eliminar los datos del registro
        $this->db->delete('configuracion_departamentos');
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}
   

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_configuracion_departamentos($intConfiguracionID = NULL, $strCriteriosBusq = NULL)
	{
		//Variable que se utiliza para asignar la descripción de cuentas por cobrar
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strCuentasCobrar = $this->db->escape('CUENTAS POR COBRAR');
		

		$this->db->select("CD.configuracion_id, CD.referencia_id, CD.tipo_referencia, CD.cuenta,  
							 CASE 
							 	WHEN  ML.maquinaria_linea_id > 0 
							      THEN ML.descripcion
							     WHEN  MLD.maquinaria_linea_id > 0 
							      THEN MLD.descripcion
							    WHEN  MV.modulo_id > 0 
							      THEN MV.descripcion
							 	ELSE
							 	   M.descripcion END AS referencia", FALSE);
	    $this->db->from('configuracion_departamentos AS CD');
	    $this->db->join('maquinaria_lineas AS ML', 'CD.referencia_id = ML.maquinaria_linea_id  
						 AND CD.tipo_referencia = "MAQUINARIA"', 'left');
	    $this->db->join('modulos AS M', 'CD.referencia_id = M.modulo_id  
						  AND CD.tipo_referencia = "REFACCIONES"', 'left');
	    $this->db->join('modulos AS MV', 'CD.referencia_id = MV.modulo_id  
						  AND CD.tipo_referencia = "VEHICULOS"', 'left');
	     $this->db->join('maquinaria_lineas AS MLD', 'CD.tipo_referencia = '.$strCuentasCobrar.' 
						 AND CD.referencia_id = MLD.maquinaria_linea_id', 'left');
		//Si existe id de la cuenta
		if ($intConfiguracionID !== NULL)
		{ 
			$this->db->where('CD.configuracion_id', $intConfiguracionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL) //Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (referencia_id/descripcion|tipo_referencia) para obtener los criterios de búsqueda
            list($intReferenciaID, $strTipoReferencia) = explode("|", $strCriteriosBusq); 

            //Si el tipo de referencia corresponde a Cuentas por Cobrar
            if($strTipoReferencia == 'CUENTAS POR COBRAR')
            {
            	//Buscar por descripción de la línea de maquinaria
            	$this->db->where('MLD.descripcion', $intReferenciaID);
            }
            else
            {
            	$this->db->where('CD.referencia_id', $intReferenciaID);
            }
			
			$this->db->where('CD.tipo_referencia', $strTipoReferencia);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->order_by('tipo_referencia, referencia', 'ASC');
			return $this->db->get()->result();
		}
	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_configuracion_departamentos($intNumRows, $intPos)
	{
		
		//Variable que se utiliza para asignar la descripción de cuentas por cobrar
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strCuentasCobrar = $this->db->escape('CUENTAS POR COBRAR');


		$this->db->from('configuracion_departamentos AS CD');
	    $this->db->join('maquinaria_lineas AS ML', 'CD.referencia_id = ML.maquinaria_linea_id  
						 AND CD.tipo_referencia = "MAQUINARIA"', 'left');
	    $this->db->join('modulos AS M', 'CD.referencia_id = M.modulo_id  
						 AND CD.tipo_referencia = "REFACCIONES"', 'left');
	    $this->db->join('modulos AS MV', 'CD.referencia_id = MV.modulo_id  
						 AND CD.tipo_referencia = "VEHICULOS"', 'left');
	    $this->db->join('maquinaria_lineas AS MLD', 'CD.tipo_referencia = '.$strCuentasCobrar.' 
						 AND CD.referencia_id = MLD.maquinaria_linea_id', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CD.configuracion_id, CD.tipo_referencia, CD.cuenta, 
						    CASE 
							 	WHEN  ML.maquinaria_linea_id > 0 
							      THEN ML.descripcion
							    WHEN  MLD.maquinaria_linea_id > 0 
							      THEN MLD.descripcion
							    WHEN  MV.modulo_id > 0 
							      THEN MV.descripcion
							 	ELSE
							 	   M.descripcion END AS referencia", FALSE);
	    $this->db->from('configuracion_departamentos AS CD');
	    $this->db->join('maquinaria_lineas AS ML', 'CD.referencia_id = ML.maquinaria_linea_id  
						 AND CD.tipo_referencia = "MAQUINARIA"', 'left');
	    $this->db->join('modulos AS M', 'CD.referencia_id = M.modulo_id  
						 AND CD.tipo_referencia = "REFACCIONES"', 'left');
	    $this->db->join('modulos AS MV', 'CD.referencia_id = MV.modulo_id  
						 AND CD.tipo_referencia = "VEHICULOS"', 'left');
	    $this->db->join('maquinaria_lineas AS MLD', 'CD.tipo_referencia = '.$strCuentasCobrar.' 
						 AND CD.referencia_id = MLD.maquinaria_linea_id', 'left');
		$this->db->order_by('tipo_referencia, referencia', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["configuraciones"] =$this->db->get()->result();
		return $arrResultado;


	}


	//Método para regresar los registros a un combobox
	public function get_combo_box($strTipo, $strTipoReferencia = NULL)
	{	
		//Variable ques se utiliza para formar la consulta
		$queryReferencias = '';

		//Dependiendo del tipo realizar la búsqueda de datos
	    if($strTipo == 'departamentos')
	    {
	    	//Dependiendo del tipo de referencia realizar la búsqueda de datos
	    	if($strTipoReferencia == 'MAQUINARIA' OR $strTipoReferencia == 'CUENTAS POR COBRAR')
	    	{
	    		//Líneas de maquinaria
				$queryReferencias = "SELECT ML.maquinaria_linea_id AS value, 
											ML.descripcion AS nombre
									 FROM maquinaria_lineas AS ML
									 WHERE ML.estatus = 'ACTIVO'";
	    	} 
			else if($strTipoReferencia == 'REFACCIONES') 
			{
				//Módulos
				$queryReferencias = "SELECT M.modulo_id AS value, 
								   	 	M.descripcion AS nombre
								  	 FROM modulos AS M
								  	 WHERE M.estatus = 'ACTIVO'
								  	 AND M.factura = 'REFACCIONES'";
			}
			else if($strTipoReferencia == 'VEHICULOS') 
			{
				//Módulos
				$queryReferencias = "SELECT M.modulo_id AS value, 
								   	 	M.descripcion AS nombre
								  	 FROM modulos AS M
								  	 WHERE M.estatus = 'ACTIVO'";
			}
		}
		else if($strTipo == 'procesos')
	    {

	    	//Dependiendo del tipo de referencia realizar la búsqueda de datos
	    	if($strTipoReferencia == 'SERVICIO')
	    	{

		    	//Tipos de servicios
				$queryReferencias = "SELECT ST.servicio_tipo_id AS value, 
											   ST.descripcion AS nombre
									  FROM servicios_tipos AS ST
									  WHERE ST.estatus = 'ACTIVO'
									  AND ST.facturar = 'NO'";
				//Trabajo foráneo
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= TIPO_SERVICIO_TRABAJO_FORANEO;
				$queryReferencias .= " AS value, 'TRABAJO FORANEO' AS nombre";

				//Facturación
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= TIPO_SERVICIO_FACTURACION;
				$queryReferencias .= " AS value, 'FACTURACION' AS nombre";

		    }
		     else if($strTipoReferencia == 'MAQUINARIA')
	    	{
	    		//Movimientos de maquinaria
				$queryReferencias = "SELECT ";
				$queryReferencias .= ENTRADA_MAQUINARIA_COMPRA;
				$queryReferencias .= " AS value, 'ENTRADA POR COMPRA' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= ENTRADA_MAQUINARIA_TRASPASO;
				$queryReferencias .= " AS value, 'ENTRADA POR TRASPASO' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA;
				$queryReferencias .= " AS value, 'ENTRADA POR DEVOLUCION DE CLIENTE' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= SALIDA_MAQUINARIA_VENTA;
				$queryReferencias .= " AS value, 'SALIDA POR VENTA' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= SALIDA_MAQUINARIA_TRASPASO;
				$queryReferencias .= " AS value, 'SALIDA POR TRASPASO' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= SALIDA_MAQUINARIA_DEMOSTRACION;
				$queryReferencias .= " AS value, 'SALIDA POR DEMOSTRACION' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= SALIDA_MAQUINARIA_VALIDACION;
				$queryReferencias .= " AS value, 'SALIDA POR VALIDACION' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= SALIDA_MAQUINARIA_DEVOLUCION_PROVEEDOR;
				$queryReferencias .= " AS value, 'SALIDA POR DEVOLUCION AL PROVEEDOR' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= SALIDA_MAQUINARIA_INTERNA;
				$queryReferencias .= " AS value, 'SALIDA POR CONSUMO INTERNO' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= SALIDA_MAQUINARIA_POR_AJUSTE;
				$queryReferencias .= " AS value, 'SALIDA POR AJUSTE' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= TIPO_SERVICIO_FACTURACION;
				$queryReferencias .= " AS value, 'FACTURACION' AS nombre";


	    	}
		    else if($strTipoReferencia == 'REFACCIONES')
		    {
		    	//Movimientos de refacciones
		    	$queryReferencias = "SELECT ";
				$queryReferencias .= ENTRADA_REFACCIONES_COMPRA;
				$queryReferencias .= " AS value, 'ENTRADA POR COMPRA' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= ENTRADA_REFACCIONES_DEVOLUCION_FACTURA;
				$queryReferencias .= " AS value, 'ENTRADA POR DEVOLUCION DE CLIENTE' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= ENTRADA_REFACCIONES_DEVOLUCION_TALLER;
				$queryReferencias .= " AS value, 'ENTRADA POR DEVOLUCION DE TALLER' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= ENTRADA_REFACCIONES_TRASPASO;
				$queryReferencias .= " AS value, 'ENTRADA POR TRASPASO' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= ENTRADA_REFACCIONES_AJUSTE;
				$queryReferencias .= " AS value, 'ENTRADA POR AJUSTE' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= SALIDA_REFACCIONES_TALLER;
				$queryReferencias .= " AS value, 'SALIDA POR TALLER' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= SALIDA_REFACCIONES_CONSUMO_INTERNO;
				$queryReferencias .= " AS value, 'SALIDA POR CONSUMO INTERNO' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= SALIDA_REFACCIONES_TRASPASO;
				$queryReferencias .= " AS value, 'SALIDA POR TRASPASO' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= SALIDA_REFACCIONES_DEVOLUCION_PROVEEDOR;
				$queryReferencias .= " AS value, 'SALIDA POR DEVOLUCION AL PROVEEDOR' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= SALIDA_REFACCIONES_AJUSTE;
				$queryReferencias .= " AS value, 'SALIDA POR AJUSTE' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= TIPO_SERVICIO_FACTURACION;
				$queryReferencias .= " AS value, 'FACTURACION' AS nombre";
		    }
		    else if($strTipoReferencia == 'CONTROL DE VEHICULOS')
		    {
		    	//Movimientos de refacciones internas
		    	$queryReferencias = "SELECT ";
				$queryReferencias .= ENTRADA_REFACCIONES_INTERNAS_TRASPASO;
				$queryReferencias .= " AS value, 'ENTRADA POR TRASPASO ALMACEN GENERAL' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER;
				$queryReferencias .= " AS value, 'ENTRADA POR DEVOLUCION DE TALLER' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= SALIDA_REFACCIONES_INTERNAS;
				$queryReferencias .= " AS value, 'SALIDA POR TALLER' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= SALIDA_REFACCIONES_INTERNAS_CONSUMO_INTERNO;
				$queryReferencias .= " AS value, 'SALIDA POR CONSUMO INTERNO' AS nombre";
				$queryReferencias .= " UNION ";
				$queryReferencias .= "SELECT ";
				$queryReferencias .= TIPO_SERVICIO_FACTURACION;
				$queryReferencias .= " AS value, 'TRABAJO FORANEO' AS nombre";
		    }

		}

		//Si no existe consulta
		if($queryReferencias == '')
		{
			//Formar consulta vacia (esto con la intención de que el usuario este consiente de que no existen datos cuando la opción del primer combobox (principal) se encuentra vacia)
			$queryReferencias = "SELECT '' AS value, '' AS nombre";
		}

		$queryReferencias .= " ORDER BY nombre ASC";
		//Ejecutar consulta
		$strSQL = $this->db->query($queryReferencias);
	    return $strSQL->result();
	}




	/*******************************************************************************************************************
	Funciones de la tabla configuracion_procesos
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_configuracion_procesos(stdClass $objConfiguracion)
	{
		//Asignar datos al array
		$arrDatos = array('referencia_id' => $objConfiguracion->intReferenciaID,
						  'tipo_referencia' => $objConfiguracion->strTipoReferencia,
						  'proceso' => $objConfiguracion->strProceso, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objConfiguracion->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('configuracion_procesos', $arrDatos);
	}


	//Método para modificar los datos de un registro previamente guardado
	public function modificar_configuracion_procesos(stdClass $objConfiguracion)
	{
		//Asignar datos al array
		$arrDatos = array('referencia_id' => $objConfiguracion->intReferenciaID,
						  'tipo_referencia' => $objConfiguracion->strTipoReferencia,
						  'proceso' => $objConfiguracion->strProceso, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objConfiguracion->intUsuarioID);
		$this->db->where('configuracion_id', $objConfiguracion->intConfiguracionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('configuracion_procesos', $arrDatos);
	}

	//Método para eliminar los datos de un registro
	public function eliminar_configuracion_procesos($intConfiguracionID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		$this->db->where('configuracion_id', $intConfiguracionID);
		//Eliminar los datos del registro
        $this->db->delete('configuracion_procesos');
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}
   

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_configuracion_procesos($intConfiguracionID = NULL, $strCriteriosBusq = NULL)
	{
		//Constante para identificar al tipo de servicio: trabajo foráneo
		$intTipoServicioTF = TIPO_SERVICIO_TRABAJO_FORANEO;
		//Constante para identificar al tipo de servicio: facturación
		$intTipoServicioFacturacion = TIPO_SERVICIO_FACTURACION;
		//Constantes para identificar los movimientos de refacciones
		$intMovRefEntradaCompra = ENTRADA_REFACCIONES_COMPRA;
		$intMovRefEntradaDevFra = ENTRADA_REFACCIONES_DEVOLUCION_FACTURA;
		$intMovRefEntradaDevTaller = ENTRADA_REFACCIONES_DEVOLUCION_TALLER;
		$intMovRefEntradaTraspaso = ENTRADA_REFACCIONES_TRASPASO;
		$intMovRefEntradaAjuste = ENTRADA_REFACCIONES_AJUSTE;
		$intMovRefSalidaTaller = SALIDA_REFACCIONES_TALLER;
		$intMovRefSalidaConsInt = SALIDA_REFACCIONES_CONSUMO_INTERNO;
		$intMovRefSalidaTraspaso = SALIDA_REFACCIONES_TRASPASO;
		$intMovRefSalidaDevProv = SALIDA_REFACCIONES_DEVOLUCION_PROVEEDOR;
		$intMovRefSalidaAjuste = SALIDA_REFACCIONES_AJUSTE;
		//Constantes para identificar los movimientos de maquinaria
		$intMovMaqEntradaCompra = ENTRADA_MAQUINARIA_COMPRA;
		$intMovMaqEntradaTraspaso = ENTRADA_MAQUINARIA_TRASPASO; 
		$intMovMaqEntradaDevFra = ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA; 
		$intMovMaqSalidaVenta  = SALIDA_MAQUINARIA_VENTA; 
		$intMovMaqSalidaTraspaso = SALIDA_MAQUINARIA_TRASPASO;
		$intMovMaqSalidaDemo = SALIDA_MAQUINARIA_DEMOSTRACION;  
		$intMovMaqSalidaVal = SALIDA_MAQUINARIA_VALIDACION;
		$intMovMaqSalidaDevProv = SALIDA_MAQUINARIA_DEVOLUCION_PROVEEDOR;
		$intMovMaqSalidaConsInt = SALIDA_MAQUINARIA_INTERNA;
		$intMovMaqSalidaAjuste = SALIDA_MAQUINARIA_POR_AJUSTE;

		//Constantes para identificar los movimientos de control de vehiculos
		$intMovRefIntEntradaTraspaso = ENTRADA_REFACCIONES_INTERNAS_TRASPASO;
		$intMovRefIntEntradaDevTaller = ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER;
		$intMovefIntSalidaTaller = SALIDA_REFACCIONES_INTERNAS;
		$intMovefIntSalidaConsInt = SALIDA_REFACCIONES_INTERNAS_CONSUMO_INTERNO;
		$intMovefIntTrabajoForaneo = TIPO_SERVICIO_FACTURACION;
		



		$this->db->select("CP.configuracion_id, CP.referencia_id, CP.tipo_referencia, CP.proceso,  
						   CASE 
							   WHEN  CP.referencia_id = $intTipoServicioTF 
							   		 AND CP.tipo_referencia = 'SERVICIO'
							   	  THEN 	'TRABAJO FORANEO'
							   WHEN  CP.referencia_id = $intTipoServicioFacturacion 
							   		 AND CP.tipo_referencia = 'SERVICIO'
							     THEN 	'FACTURACION' 
							   WHEN  CP.referencia_id = ST.servicio_tipo_id  
							   		 AND CP.tipo_referencia = 'SERVICIO'
							   	  THEN  ST.descripcion
							   WHEN  CP.referencia_id = $intMovRefEntradaCompra
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'ENTRADA POR COMPRA'
							   WHEN  CP.referencia_id = $intMovRefEntradaDevFra
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'ENTRADA POR DEVOLUCION DE CLIENTE'
							   WHEN  CP.referencia_id = $intMovRefEntradaDevTaller
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'ENTRADA POR DEVOLUCION DE TALLER' 
							   WHEN  CP.referencia_id = $intMovRefEntradaTraspaso
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'ENTRADA POR TRASPASO'  
							   WHEN  CP.referencia_id = $intMovRefEntradaAjuste
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'ENTRADA POR AJUSTE'
							   WHEN  CP.referencia_id = $intMovRefSalidaTaller
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'SALIDA POR TALLER'
							   WHEN  CP.referencia_id = $intMovRefSalidaConsInt
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'SALIDA POR CONSUMO INTERNO' 
							   WHEN  CP.referencia_id = $intMovRefSalidaTraspaso
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'SALIDA POR TRASPASO'
							   WHEN  CP.referencia_id = $intMovRefSalidaDevProv
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'SALIDA POR DEVOLUCION AL PROVEEDOR'
							   WHEN  CP.referencia_id = $intMovRefSalidaAjuste
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'SALIDA POR AJUSTE'
							   WHEN  CP.referencia_id = $intMovMaqEntradaCompra
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'ENTRADA POR COMPRA'
							   WHEN  CP.referencia_id = $intMovMaqEntradaTraspaso
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'ENTRADA POR TRASPASO'
							   WHEN  CP.referencia_id = $intMovMaqEntradaDevFra
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'ENTRADA POR DEVOLUCION DE CLIENTE'
							   WHEN  CP.referencia_id = $intMovMaqSalidaVenta
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'SALIDA POR VENTA'
							   WHEN  CP.referencia_id = $intMovMaqSalidaTraspaso
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'SALIDA POR TRASPASO'
							   WHEN  CP.referencia_id = $intMovMaqSalidaDemo
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'SALIDA POR DEMOSTRACION'
							   WHEN  CP.referencia_id = $intMovMaqSalidaVal
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'SALIDA POR VALIDACION'
							   WHEN  CP.referencia_id = $intMovMaqSalidaDevProv
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'SALIDA POR DEVOLUCION AL PROVEEDOR'
							   WHEN  CP.referencia_id = $intMovMaqSalidaConsInt
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'SALIDA POR CONSUMO INTERNO'
							   WHEN  CP.referencia_id = $intMovMaqSalidaAjuste
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'SALIDA POR AJUSTE' 
							   WHEN  CP.referencia_id = $intMovRefIntEntradaTraspaso
							   		 AND CP.tipo_referencia = 'CONTROL DE VEHICULOS'
							   	    THEN  'ENTRADA POR TRASPASO ALMACEN GENERAL' 
							   WHEN  CP.referencia_id = $intMovRefIntEntradaDevTaller
							   		 AND CP.tipo_referencia = 'CONTROL DE VEHICULOS'
							   	    THEN  'ENTRADA POR DEVOLUCION DE TALLER' 
							   WHEN  CP.referencia_id = $intMovefIntSalidaTaller
							   		 AND CP.tipo_referencia = 'CONTROL DE VEHICULOS'
							   	    THEN  'SALIDA POR TALLER' 
							   WHEN  CP.referencia_id = $intMovefIntSalidaConsInt
							   		 AND CP.tipo_referencia = 'CONTROL DE VEHICULOS'
							   	    THEN  'SALIDA POR CONSUMO INTERNO' 
							   	WHEN  CP.referencia_id = $intMovefIntTrabajoForaneo
							   		 AND CP.tipo_referencia = 'CONTROL DE VEHICULOS'
							   	    THEN  'TRABAJO FORANEO' 
							   ELSE
							   	'FACTURACION'
							   END AS referencia", FALSE);
	    $this->db->from('configuracion_procesos AS CP');
	    $this->db->join('servicios_tipos AS ST', 'CP.referencia_id = ST.servicio_tipo_id  
						 AND CP.tipo_referencia = "SERVICIO"', 'left');
		//Si existe id de la cuenta
		if ($intConfiguracionID !== NULL)
		{ 
			$this->db->where('CP.configuracion_id', $intConfiguracionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($strCriteriosBusq !== NULL) //Si existe lista con criterios de búsqueda
		{
			//Quitar '|'  de la cadena (referencia_id|tipo_referencia) para obtener los criterios de búsqueda
            list($intReferenciaID, $strTipoReferencia) = explode("|", $strCriteriosBusq); 
			$this->db->where('CP.referencia_id', $intReferenciaID);
			$this->db->where('CP.tipo_referencia', $strTipoReferencia);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			$this->db->order_by('tipo_referencia, referencia', 'ASC');
			return $this->db->get()->result();
		}

	}


	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_configuracion_procesos($intNumRows, $intPos)
	{

		//Constante para identificar al tipo de servicio: trabajo foráneo
		$intTipoServicioTF = TIPO_SERVICIO_TRABAJO_FORANEO;
		//Constante para identificar al tipo de servicio: facturación
		$intTipoServicioFacturacion = TIPO_SERVICIO_FACTURACION;
		//Constantes para identificar los movimientos de refacciones
		$intMovRefEntradaCompra = ENTRADA_REFACCIONES_COMPRA;
		$intMovRefEntradaDevFra = ENTRADA_REFACCIONES_DEVOLUCION_FACTURA;
		$intMovRefEntradaDevTaller = ENTRADA_REFACCIONES_DEVOLUCION_TALLER;
		$intMovRefEntradaTraspaso = ENTRADA_REFACCIONES_TRASPASO;
		$intMovRefEntradaAjuste = ENTRADA_REFACCIONES_AJUSTE;
		$intMovRefSalidaTaller = SALIDA_REFACCIONES_TALLER;
		$intMovRefSalidaConsInt = SALIDA_REFACCIONES_CONSUMO_INTERNO;
		$intMovRefSalidaTraspaso = SALIDA_REFACCIONES_TRASPASO;
		$intMovRefSalidaDevProv = SALIDA_REFACCIONES_DEVOLUCION_PROVEEDOR;
		$intMovRefSalidaAjuste = SALIDA_REFACCIONES_AJUSTE;
		//Constantes para identificar los movimientos de maquinaria
		$intMovMaqEntradaCompra = ENTRADA_MAQUINARIA_COMPRA;
		$intMovMaqEntradaTraspaso = ENTRADA_MAQUINARIA_TRASPASO; 
		$intMovMaqEntradaDevFra = ENTRADA_MAQUINARIA_DEVOLUCION_FACTURA; 
		$intMovMaqSalidaVenta  = SALIDA_MAQUINARIA_VENTA; 
		$intMovMaqSalidaTraspaso = SALIDA_MAQUINARIA_TRASPASO;
		$intMovMaqSalidaDemo = SALIDA_MAQUINARIA_DEMOSTRACION;  
		$intMovMaqSalidaVal = SALIDA_MAQUINARIA_VALIDACION;
		$intMovMaqSalidaDevProv = SALIDA_MAQUINARIA_DEVOLUCION_PROVEEDOR;
		$intMovMaqSalidaConsInt = SALIDA_MAQUINARIA_INTERNA;
		$intMovMaqSalidaAjuste = SALIDA_MAQUINARIA_POR_AJUSTE;

		//Constantes para identificar los movimientos de control de vehiculos
		$intMovRefIntEntradaTraspaso = ENTRADA_REFACCIONES_INTERNAS_TRASPASO;
		$intMovRefIntEntradaDevTaller = ENTRADA_REFACCIONES_INTERNAS_DEVOLUCION_TALLER;
		$intMovefIntSalidaTaller = SALIDA_REFACCIONES_INTERNAS;
		$intMovefIntSalidaConsInt = SALIDA_REFACCIONES_INTERNAS_CONSUMO_INTERNO;
		$intMovefIntTrabajoForaneo = TIPO_SERVICIO_FACTURACION;

		$this->db->from('configuracion_procesos AS CP');
	    $this->db->join('servicios_tipos AS ST', 'CP.referencia_id = ST.servicio_tipo_id  
						 AND CP.tipo_referencia = "SERVICIO"', 'left');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CP.configuracion_id, CP.tipo_referencia, CP.proceso, 
						   CASE 
							   WHEN  CP.referencia_id = $intTipoServicioTF 
							   		 AND CP.tipo_referencia = 'SERVICIO'
							   	  THEN 	'TRABAJO FORANEO'
							   WHEN  CP.referencia_id = $intTipoServicioFacturacion 
							   		 AND CP.tipo_referencia = 'SERVICIO'
							     THEN 	'FACTURACION' 
							   WHEN  CP.referencia_id = ST.servicio_tipo_id  
							   		 AND CP.tipo_referencia = 'SERVICIO'
							   	  THEN  ST.descripcion
							   WHEN  CP.referencia_id = $intMovRefEntradaCompra
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'ENTRADA POR COMPRA'
							   WHEN  CP.referencia_id = $intMovRefEntradaDevFra
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'ENTRADA POR DEVOLUCION DE CLIENTE'
							   WHEN  CP.referencia_id = $intMovRefEntradaDevTaller
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'ENTRADA POR DEVOLUCION DE TALLER' 
							   WHEN  CP.referencia_id = $intMovRefEntradaTraspaso
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'ENTRADA POR TRASPASO'  
							   WHEN  CP.referencia_id = $intMovRefEntradaAjuste
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'ENTRADA POR AJUSTE'
							   WHEN  CP.referencia_id = $intMovRefSalidaTaller
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'SALIDA POR TALLER'
							   WHEN  CP.referencia_id = $intMovRefSalidaConsInt
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'SALIDA POR CONSUMO INTERNO' 
							   WHEN  CP.referencia_id = $intMovRefSalidaTraspaso
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'SALIDA POR TRASPASO'
							   WHEN  CP.referencia_id = $intMovRefSalidaDevProv
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'SALIDA POR DEVOLUCION AL PROVEEDOR'
							   WHEN  CP.referencia_id = $intMovRefSalidaAjuste
							   		 AND CP.tipo_referencia = 'REFACCIONES'
							   	  THEN  'SALIDA POR AJUSTE'
							   WHEN  CP.referencia_id = $intMovMaqEntradaCompra
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'ENTRADA POR COMPRA'
							   WHEN  CP.referencia_id = $intMovMaqEntradaTraspaso
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'ENTRADA POR TRASPASO'
							   WHEN  CP.referencia_id = $intMovMaqEntradaDevFra
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'ENTRADA POR DEVOLUCION DE CLIENTE'
							   WHEN  CP.referencia_id = $intMovMaqSalidaVenta
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'SALIDA POR VENTA'
							   WHEN  CP.referencia_id = $intMovMaqSalidaTraspaso
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'SALIDA POR TRASPASO'
							   WHEN  CP.referencia_id = $intMovMaqSalidaDemo
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'SALIDA POR DEMOSTRACION'
							   WHEN  CP.referencia_id = $intMovMaqSalidaVal
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'SALIDA POR VALIDACION'
							   WHEN  CP.referencia_id = $intMovMaqSalidaDevProv
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'SALIDA POR DEVOLUCION AL PROVEEDOR'
							   WHEN  CP.referencia_id = $intMovMaqSalidaConsInt
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'SALIDA POR CONSUMO INTERNO'
							   WHEN  CP.referencia_id = $intMovMaqSalidaAjuste
							   		 AND CP.tipo_referencia = 'MAQUINARIA'
							   	    THEN  'SALIDA POR AJUSTE' 
							   WHEN  CP.referencia_id = $intMovRefIntEntradaTraspaso
							   		 AND CP.tipo_referencia = 'CONTROL DE VEHICULOS'
							   	    THEN  'ENTRADA POR TRASPASO ALMACEN GENERAL' 
							   WHEN  CP.referencia_id = $intMovRefIntEntradaDevTaller
							   		 AND CP.tipo_referencia = 'CONTROL DE VEHICULOS'
							   	    THEN  'ENTRADA POR DEVOLUCION DE TALLER' 
							   WHEN  CP.referencia_id = $intMovefIntSalidaTaller
							   		 AND CP.tipo_referencia = 'CONTROL DE VEHICULOS'
							   	    THEN  'SALIDA POR TALLER' 
							   WHEN  CP.referencia_id = $intMovefIntSalidaConsInt
							   		 AND CP.tipo_referencia = 'CONTROL DE VEHICULOS'
							   	    THEN  'SALIDA POR CONSUMO INTERNO' 
							   	WHEN  CP.referencia_id = $intMovefIntTrabajoForaneo
							   		 AND CP.tipo_referencia = 'CONTROL DE VEHICULOS'
							   	    THEN  'TRABAJO FORANEO' 
							   ELSE
							   	'FACTURACION'
							   END AS referencia", FALSE);
	    $this->db->from('configuracion_procesos AS CP');
	    $this->db->join('servicios_tipos AS ST', 'CP.referencia_id = ST.servicio_tipo_id  
						 AND CP.tipo_referencia = "SERVICIO"', 'left');
		$this->db->order_by('tipo_referencia, referencia', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["configuraciones"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*******************************************************************************************************************
	Funciones de la tabla configuracion_modulos
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_configuracion_modulos(stdClass $objConfiguracion)
	{
		//Asignar datos al array
		$arrDatos = array('modulo_id' => $objConfiguracion->intModuloID,
						  'tipo_referencia' => $objConfiguracion->strTipoReferencia, 
						  'cuenta' => $objConfiguracion->strCuenta, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objConfiguracion->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('configuracion_modulos', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar_configuracion_modulos(stdClass $objConfiguracion)
	{

		//Asignar datos al array
		$arrDatos = array('modulo_id' => $objConfiguracion->intModuloID,
						  'tipo_referencia' => $objConfiguracion->strTipoReferencia, 
						  'cuenta' => $objConfiguracion->strCuenta, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objConfiguracion->intUsuarioID);
		$this->db->where('configuracion_id', $objConfiguracion->intConfiguracionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('configuracion_modulos', $arrDatos);
	}


	//Método para eliminar los datos de un registro
	public function eliminar_configuracion_modulos($intConfiguracionID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		$this->db->where('configuracion_id', $intConfiguracionID);
		//Eliminar los datos del registro
        $this->db->delete('configuracion_modulos');
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}
   
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_configuracion_modulos($intConfiguracionID = NULL, $intModuloID = NULL, $strTipoReferencia = NULL, 
											     $strModulo = NULL)
	{
		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strCteTsa16 = $this->db->escape('CLIENTE TASA16');
		$strCteTsa0 = $this->db->escape('CLIENTE TASA0');

		$this->db->select("CM.configuracion_id, CM.modulo_id, CM.cuenta,  CM.tipo_referencia, 
							CASE 
							 	WHEN  CM.tipo_referencia = $strCteTsa16
							      THEN 'CLIENTE TASA 16%'
							    WHEN  CM.tipo_referencia = $strCteTsa0
							      THEN 'CLIENTE TASA 0%'
							 	ELSE
							 	   CM.tipo_referencia END AS referencia, 
						   M.descripcion AS modulo");
	    $this->db->from('configuracion_modulos AS CM');
	    $this->db->join('modulos AS M', 'CM.modulo_id = M.modulo_id', 'inner');
		//Si existe id de la cuenta
		if ($intConfiguracionID !== NULL)
		{ 
			$this->db->where('CM.configuracion_id', $intConfiguracionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($intModuloID !== NULL OR $strModulo !== NULL)//Si existe id/descripción del módulo
		{
			//Si existe id del módulo
			if($intModuloID > 0)
			{
				$this->db->where('CM.modulo_id', $intModuloID);
			}
			

			//Si existe descripción del módulo
			if($strModulo != NULL)
			{
				//Si la descripción del módulo es DIVERSOS
				if($strModulo == 'DIVERSOS')
				{
					$strModulo = 'CORPORATIVO';
				}

				$this->db->where('M.descripcion', $strModulo);
			}


			//Si existe  tipo de referencia
		    if($strTipoReferencia != NULL)
		    {
		    	$this->db->where('CM.tipo_referencia', $strTipoReferencia);
		    }
		    else
		    {
		    	//Buscar los módulos donde el tipo de referencia es GENERAL de esta manera no se afectan las pólizas (antes de agregar la póliza de diario (notas de cargo, notas de crédito, etc.))
		    	$this->db->where('CM.tipo_referencia', 'GENERAL');
		    }

			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->order_by('M.descripcion', 'ASC');
			return $this->db->get()->result();
		}
	}

	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_configuracion_modulos($intNumRows, $intPos)
	{

		//Variable que se utiliza para asignar la descripción del tipo de movimiento
		//Nota: la función escape soluciona el problema de espacios entre comillas
		$strCteTsa16 = $this->db->escape('CLIENTE TASA16');
		$strCteTsa0 = $this->db->escape('CLIENTE TASA0');

		$this->db->from('configuracion_modulos AS CM');
	    $this->db->join('modulos AS M', 'CM.modulo_id = M.modulo_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CM.configuracion_id, CM.cuenta, 
							CASE 
							 	WHEN  CM.tipo_referencia = $strCteTsa16
							      THEN 'CLIENTE TASA 16%'
							    WHEN  CM.tipo_referencia = $strCteTsa0
							      THEN 'CLIENTE TASA 0%'
							 	ELSE
							 	   CM.tipo_referencia END AS referencia,
			                M.descripcion AS modulo");
	    $this->db->from('configuracion_modulos AS CM');
	    $this->db->join('modulos AS M', 'CM.modulo_id = M.modulo_id', 'inner');
		$this->db->order_by('M.descripcion', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["configuraciones"] =$this->db->get()->result();
		return $arrResultado;
	}


	/*******************************************************************************************************************
	Funciones de la tabla configuracion_cuentas_bancarias
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar_configuracion_cuentas_bancarias(stdClass $objConfiguracion)
	{
		//Asignar datos al array
		$arrDatos = array('cuenta_bancaria_id' => $objConfiguracion->intCuentaBancariaID,
						  'tipo_referencia' => $objConfiguracion->strTipoReferencia, 
						  'cuenta' => $objConfiguracion->strCuenta, 
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objConfiguracion->intUsuarioID);
		//Guardar los datos del registro
		return $this->db->insert('configuracion_cuentas_bancarias', $arrDatos);
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar_configuracion_cuentas_bancarias(stdClass $objConfiguracion)
	{

		//Asignar datos al array
		$arrDatos = array('cuenta_bancaria_id' => $objConfiguracion->intCuentaBancariaID,
						  'tipo_referencia' => $objConfiguracion->strTipoReferencia, 
						  'cuenta' => $objConfiguracion->strCuenta, 
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objConfiguracion->intUsuarioID);
		$this->db->where('configuracion_id', $objConfiguracion->intConfiguracionID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('configuracion_cuentas_bancarias', $arrDatos);
	}


	//Método para eliminar los datos de un registro
	public function eliminar_configuracion_cuentas_bancarias($intConfiguracionID)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		$this->db->where('configuracion_id', $intConfiguracionID);
		//Eliminar los datos del registro
        $this->db->delete('configuracion_cuentas_bancarias');
		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}
   
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar_configuracion_cuentas_bancarias($intConfiguracionID = NULL, $intCuentaBancariaID = NULL, $strTipoReferencia = NULL)
	{
		

		$this->db->select("CCB.configuracion_id, CCB.cuenta_bancaria_id, CCB.cuenta, CCB.tipo_referencia,  
						   CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria");
	    $this->db->from('configuracion_cuentas_bancarias AS CCB');
	    $this->db->join('cuentas_bancarias AS CB', 'CCB.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		//Si existe id de la cuenta
		if ($intConfiguracionID !== NULL)
		{ 
			$this->db->where('CCB.configuracion_id', $intConfiguracionID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else if ($intCuentaBancariaID !== NULL)//Si existe id de la cuenta bancaria
		{
			
			$this->db->where('CCB.cuenta_bancaria_id', $intCuentaBancariaID);
		    $this->db->where('CCB.tipo_referencia', $strTipoReferencia);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else 
		{
			$this->db->order_by('CCB.cuenta_bancaria_id, CCB.tipo_referencia', 'ASC');
			return $this->db->get()->result();
		}
	}

	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro_configuracion_cuentas_bancarias($intNumRows, $intPos)
	{

		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
		$this->db->from('configuracion_cuentas_bancarias AS CCB');
	    $this->db->join('cuentas_bancarias AS CB', 'CCB.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();

		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("CCB.configuracion_id, CCB.cuenta,  CCB.tipo_referencia, 
			               CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria");
	    $this->db->from('configuracion_cuentas_bancarias AS CCB');
	    $this->db->join('cuentas_bancarias AS CB', 'CCB.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
		$this->db->order_by('CCB.cuenta_bancaria_id, CCB.tipo_referencia', 'ASC');
		$this->db->limit($intNumRows,$intPos);
		$arrResultado["configuraciones"] =$this->db->get()->result();
		return $arrResultado;
	}
}	
?>