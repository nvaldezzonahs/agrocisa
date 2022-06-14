<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Movimientos_bancarios_model extends CI_model {
	/*******************************************************************************************************************
	Funciones de la tabla movimientos_bancarios
	*********************************************************************************************************************/
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objMovimientoBancario)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objMovimientoBancario->strFolio); 

		//Tabla movimientos_bancarios
		//Asignar datos al array
		$arrDatos = array('folio' => $strFolioConsecutivo, 
						  'fecha' => $objMovimientoBancario->dteFecha,  
						  'tipo' => $objMovimientoBancario->strTipo,
						  'movimiento_bancario_tipo_id' => $objMovimientoBancario->intMovimientoBancarioTipoID,
						  'cuenta_bancaria_id' => $objMovimientoBancario->intCuentaBancariaID,
						  'subtotal' => $objMovimientoBancario->intSubtotal,
						  'tasa_cuota_iva' => $objMovimientoBancario->intTasaCuotaIva,
						  'iva' => $objMovimientoBancario->intIva,
						  'concepto' => $objMovimientoBancario->strConcepto,
						  'observaciones' => $objMovimientoBancario->strObservaciones,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objMovimientoBancario->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('movimientos_bancarios', $arrDatos);

		//Agregar id del nuevo registro al objeto
		$objMovimientoBancario->intMovimientoBancarioID = $this->db->insert_id();

		//Hacer un llamado al método para guardar los detalles del movimiento bancario
		$this->guardar_detalles($objMovimientoBancario);
		
		//Hacer un llamado al método para modificar el consecutivo del folio
		$otdModelFolios->modificar_consecutivo_folio($intFolioID, $intConsecutivo);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();
		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
		
	}

    //Método para modificar los datos de un registro previamente guardado
	public function modificar(stdClass $objMovimientoBancario)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();

		//Tabla movimientos_bancarios
		//Asignar datos al array
		$arrDatos = array('fecha' => $objMovimientoBancario->dteFecha,  
						  'tipo' => $objMovimientoBancario->strTipo,
						  'movimiento_bancario_tipo_id' => $objMovimientoBancario->intMovimientoBancarioTipoID,
						  'cuenta_bancaria_id' => $objMovimientoBancario->intCuentaBancariaID,
						  'subtotal' => $objMovimientoBancario->intSubtotal,
						  'tasa_cuota_iva' => $objMovimientoBancario->intTasaCuotaIva,
						  'iva' => $objMovimientoBancario->intIva,
						  'concepto' => $objMovimientoBancario->strConcepto,
						  'observaciones' => $objMovimientoBancario->strObservaciones,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objMovimientoBancario->intUsuarioID);
		$this->db->where('movimiento_bancario_id', $objMovimientoBancario->intMovimientoBancarioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		$this->db->update('movimientos_bancarios', $arrDatos);

		//Eliminar los detalles guardados
		$this->db->where('movimiento_bancario_id', $objMovimientoBancario->intMovimientoBancarioID);
		$this->db->delete('movimientos_bancarios_detalles');

		//Hacer un llamado al método para guardar los detalles del movimiento bancario
		$this->guardar_detalles($objMovimientoBancario);

		//Si existe algún error, se cancela la transacción, de lo contrario, se confirma
		if ($this->db->trans_status() === FALSE)
			$this->db->trans_rollback();
		else
			$this->db->trans_commit();

		//Se envía el estatus de la transacción para saber si se pudo realizar o no el movimiento
		return $this->db->trans_status();
	}


    //Método para modificar el estatus de un registro
	public function set_estatus($intMovimientoBancarioID, $strEstatus)
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
		$this->db->where('movimiento_bancario_id', $intMovimientoBancarioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('movimientos_bancarios', $arrDatos);
	}
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intMovimientoBancarioID = NULL,  $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intCuentaBancariaID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		$this->db->select("MB.movimiento_bancario_id, MB.folio, DATE_FORMAT(MB.fecha,'%d/%m/%Y') AS fecha,
						   MB.tipo,  MB.movimiento_bancario_tipo_id,  MB.cuenta_bancaria_id,
						   MB.subtotal, MB.tasa_cuota_iva,  MB.iva, MB.concepto, MB.observaciones,
						   MB.estatus, CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, M.codigo AS codigo_moneda,
						   MBT.descripcion AS movimiento_bancario_tipo,
						   TIva.valor_maximo AS porcentaje_iva, UC.usuario AS usuario_creacion, 
						   DATE_FORMAT(MB.fecha_creacion,'%d/%m/%Y %r') AS fecha_creacion", FALSE);
	    $this->db->from('movimientos_bancarios MB');
	    $this->db->join('movimientos_bancarios_tipos AS MBT', 'MB.movimiento_bancario_tipo_id = MBT.movimiento_bancario_tipo_id', 'inner');
		$this->db->join('cuentas_bancarias AS CB', 'MB.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
	    $this->db->join('sat_monedas AS M', 'CB.moneda_id = M.moneda_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'MB.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('usuarios AS UC', 'UC.usuario_id = MB.usuario_creacion', 'left');
		//Si existe id del ajuste bancario
		if($intMovimientoBancarioID !== NULL)
		{
			$this->db->where('MB.movimiento_bancario_id', $intMovimientoBancarioID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			//Si existe id de la cuenta bancaria
			if($intCuentaBancariaID > 0)
			{
				$this->db->where('MB.cuenta_bancaria_id', $intCuentaBancariaID);
			}
			//Si existe rango de fechas
			if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
			{
			   	$this->db->where("(MB.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
			   	
			}
			//Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('MB.estatus', $strEstatus);
			}

			$this->db->where("((MB.folio LIKE '%$strBusqueda%') OR
					       	   (MB.concepto LIKE '%$strBusqueda%') OR
					           (MB.tipo LIKE '%$strBusqueda%') OR
        				       (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('MB.fecha DESC, MB.folio DESC');
			return $this->db->get()->result();
		}

	}

	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function filtro($dteFechaInicial = NULL, $dteFechaFinal = NULL, $intCuentaBancariaID = NULL, 
						   $strEstatus = NULL, $strBusqueda =  NULL, $intNumRows, $intPos)
	{
		//Seleccionar el número de registros que coincidan con los criterios de búsqueda
	    //Si existe id de la cuenta bancaria
	    if($intCuentaBancariaID != NULL)
	    {
	    	$this->db->where("MB.cuenta_bancaria_id", $intCuentaBancariaID);
	    } 
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("MB.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MB.estatus', $strEstatus);
		}

		$this->db->where("((MB.folio LIKE '%$strBusqueda%') OR
					       (MB.concepto LIKE '%$strBusqueda%') OR
					       (MB.tipo LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))"); 

		$this->db->from('movimientos_bancarios MB');
		$this->db->join('cuentas_bancarias AS CB', 'MB.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
	    $this->db->join('sat_monedas AS M', 'CB.moneda_id = M.moneda_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'MB.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("MB.movimiento_bancario_id, MB.folio,  DATE_FORMAT(MB.fecha, '%d/%m/%Y') AS fecha,
					       MB.tipo, MB.concepto, CONCAT('$',FORMAT((MB.subtotal + MB.iva),2)) AS importe,
					       MB.estatus, CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria");
		$this->db->from('movimientos_bancarios MB');
		$this->db->join('cuentas_bancarias AS CB', 'MB.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
	    $this->db->join('sat_monedas AS M', 'CB.moneda_id = M.moneda_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'MB.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	    //Si existe id de la cuenta bancaria
	    if($intCuentaBancariaID != NULL)
	    {
	    	$this->db->where("MB.cuenta_bancaria_id", $intCuentaBancariaID);
	    } 
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("MB.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('MB.estatus', $strEstatus);
		}

	    $this->db->where("((MB.folio LIKE '%$strBusqueda%') OR
	    	 			   (MB.concepto LIKE '%$strBusqueda%') OR
	    	 			   (MB.tipo LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('MB.fecha DESC, MB.folio DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["movimientos"] =$this->db->get()->result();
		return $arrResultado;
	}

	
	/*******************************************************************************************************************
	Funciones de la tabla movimientos_bancarios_detalles
	*********************************************************************************************************************/
	//Función que se utiliza para guardar los detalles del movimiento bancario
	public function guardar_detalles(stdClass $objMovimientoBancario)
	{
		//Asignar renglón consecutivo
		$intRenglon = 0;

		//Hacer recorrido para obtener los detalles del movimiento bancario
		foreach ($objMovimientoBancario->arrDetalles as $arrDets)
		{
			//Hacer recorrido para obtener los datos del detalle
			foreach ($arrDets as $arrDet)
			{
				//Incrementar renglón consecutivo
				$intRenglon++;


				//Asignar datos al array
				$arrDatos = array('movimiento_bancario_id' => $objMovimientoBancario->intMovimientoBancarioID,
								  'renglon' => $intRenglon,
								  'cuenta_id' => $arrDet->intCuentaID,
								  'importe' => $arrDet->intImporte);
				//Guardar los datos del registro
				$this->db->insert('movimientos_bancarios_detalles', $arrDatos);

			}
		}
		
	}

	//Método para regresar los detalles de un registro
	public function buscar_detalles($intMovimientoBancarioID)
	{
		$this->db->select("MBD.renglon, MBD.cuenta_id, MBD.importe, 
						   CONCAT_WS(' ', CC.primer_nivel, CC.segundo_nivel, CC.tercer_nivel, CC.cuarto_nivel) AS cuenta,
						   CC.descripcion AS cuenta_descripcion", FALSE);
		$this->db->from('movimientos_bancarios_detalles AS MBD');
		$this->db->join('catalogo_cuentas AS CC', 'MBD.cuenta_id = CC.cuenta_id', 'inner');
		$this->db->where('MBD.movimiento_bancario_id', $intMovimientoBancarioID);
		$this->db->order_by('MBD.renglon', 'ASC');
		return $this->db->get()->result();
	}

}
?>