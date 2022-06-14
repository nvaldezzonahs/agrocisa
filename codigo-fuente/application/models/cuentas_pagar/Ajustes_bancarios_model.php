<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Incluir la clase modelo de folios (para modificar el consecutivo del folio)
include_once(APPPATH . 'models/administracion/Folios_model.php');

class Ajustes_bancarios_model extends CI_model {
	//Método para guardar un registro nuevo
	public function guardar(stdClass $objAjusteBancario)
	{
		//Iniciamos la transacción
		$this->db->trans_begin();
		//Se crea una instancia de la clase modelo (folios) 
        $otdModelFolios = new  Folios_model();

		/*Quitar '_'  de la cadena (folioConsecutivo_folioID_consecutivo) para obtener los datos del folio consecutivo
		 * (esto con la finalidad de actualizar  el consecutivo de la tabla folios después de realizar registro de datos)
		 */
		 list($strFolioConsecutivo, $intFolioID, $intConsecutivo) = explode("_", $objAjusteBancario->strFolio); 

		//Asignar datos al array
		$arrDatos = array('folio' => $strFolioConsecutivo, 
						  'fecha' => $objAjusteBancario->dteFecha,  
						  'tipo' => $objAjusteBancario->intTipo,
						  'concepto' => $objAjusteBancario->strConcepto,
						  'observaciones' => $objAjusteBancario->strObservaciones,
						  'cuenta_bancaria_id' => $objAjusteBancario->intCuentaBancariaID,
						  'subtotal' => $objAjusteBancario->intSubtotal,
						  'tasa_cuota_iva' => $objAjusteBancario->intTasaCuotaIva,
						  'iva' => $objAjusteBancario->intIva,
						  'fecha_creacion' => date("Y-m-d H:i:s"),
						  'usuario_creacion' => $objAjusteBancario->intUsuarioID);
		//Guardar los datos del registro
		$this->db->insert('ajustes_bancarios', $arrDatos);
		
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
	public function modificar(stdClass $objAjusteBancario)
	{
		
		//Asignar datos al array
		$arrDatos = array('fecha' => $objAjusteBancario->dteFecha,  
						  'tipo' => $objAjusteBancario->intTipo,
						  'concepto' => $objAjusteBancario->strConcepto,
						  'observaciones' => $objAjusteBancario->strObservaciones,
						  'cuenta_bancaria_id' => $objAjusteBancario->intCuentaBancariaID,
						  'subtotal' => $objAjusteBancario->intSubtotal,
						  'tasa_cuota_iva' => $objAjusteBancario->intTasaCuotaIva,
						  'iva' => $objAjusteBancario->intIva,
						  'fecha_actualizacion' => date("Y-m-d H:i:s"),
						  'usuario_actualizacion' => $objAjusteBancario->intUsuarioID);
		$this->db->where('ajuste_bancario_id', $objAjusteBancario->intAjusteBancarioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('ajustes_bancarios', $arrDatos);

	}

    //Método para modificar el estatus de un registro
	public function set_estatus($intAjusteBancarioID, $strEstatus)
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
		$this->db->where('ajuste_bancario_id', $intAjusteBancarioID);
		$this->db->limit(1);
		//Actualizar los datos del registro
		return $this->db->update('ajustes_bancarios', $arrDatos);
	}
	
	//Método para regresar los registros que coincidan con el criterio de búsqueda proporcionado
	public function buscar($intAjusteBancarioID = NULL,  $dteFechaInicial = NULL, $dteFechaFinal = NULL, 
						   $intCuentaBancariaID = NULL, $strEstatus = NULL, $strBusqueda =  NULL)
	{
		$this->db->select("AB.ajuste_bancario_id, AB.folio, DATE_FORMAT(AB.fecha,'%d/%m/%Y') AS fecha,
						   AB.tipo,  AB.concepto, AB.observaciones, AB.cuenta_bancaria_id,
						   AB.subtotal, AB.tasa_cuota_iva,  AB.iva, AB.estatus,
						   CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta, 
						   CONCAT_WS(' - ', M.codigo, M.descripcion) AS moneda, M.codigo AS codigo_moneda,
						   TIva.valor_maximo AS porcentaje_iva, UC.usuario AS usuario_creacion", FALSE);
	    $this->db->from('ajustes_bancarios AB');
		$this->db->join('cuentas_bancarias AS CB', 'AB.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
	    $this->db->join('sat_monedas AS M', 'CB.moneda_id = M.moneda_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'AB.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$this->db->join('usuarios AS UC', 'UC.usuario_id = AB.usuario_creacion', 'left');
		//Si existe id del ajuste bancario
		if($intAjusteBancarioID !== NULL)
		{
			$this->db->where('AB.ajuste_bancario_id', $intAjusteBancarioID);
			$this->db->limit(1);
			return $this->db->get()->row();
		}
		else
		{
			//Si existe id de la cuenta bancaria
			if($intCuentaBancariaID > 0)
			{
				$this->db->where('AB.cuenta_bancaria_id', $intCuentaBancariaID);
			}
			//Si existe rango de fechas
			if($dteFechaInicial != '0000-00-00' && $dteFechaFinal != '0000-00-00')
			{
			   	$this->db->where("(AB.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal')", NULL, FALSE);
			   	
			}
			//Si existe estatus
			if($strEstatus != 'TODOS')
			{
				$this->db->where('AB.estatus', $strEstatus);
			}

			$this->db->where("((AB.folio LIKE '%$strBusqueda%') OR
        				   	   (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
			                   (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))"); 

			$this->db->order_by('AB.fecha DESC, AB.folio DESC');
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
	    	$this->db->where("AB.cuenta_bancaria_id", $intCuentaBancariaID);
	    } 
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("AB.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('AB.estatus', $strEstatus);
		}

		$this->db->where("((AB.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))"); 

		$this->db->from('ajustes_bancarios AB');
		$this->db->join('cuentas_bancarias AS CB', 'AB.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
	    $this->db->join('sat_monedas AS M', 'CB.moneda_id = M.moneda_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'AB.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
		$arrResultado["total_rows"] = $this->db->count_all_results();
		
		//Seleccionar los registros que coincidan con los criterios de búsqueda
		$this->db->select("AB.ajuste_bancario_id, AB.folio,  DATE_FORMAT(AB.fecha, '%d/%m/%Y') AS fecha,
					       AB.tipo, AB.concepto, CONCAT('$',FORMAT((AB.subtotal + AB.iva),2)) AS importe,
					       AB.estatus, CONCAT_WS(' - ', CB.cuenta, CB.descripcion) AS cuenta_bancaria");
		$this->db->from('ajustes_bancarios AB');
		$this->db->join('cuentas_bancarias AS CB', 'AB.cuenta_bancaria_id = CB.cuenta_bancaria_id', 'inner');
	    $this->db->join('sat_monedas AS M', 'CB.moneda_id = M.moneda_id', 'inner');
		$this->db->join('sat_tasa_cuota AS TIva', 'AB.tasa_cuota_iva = TIva.tasa_cuota_id', 'inner');
	    //Si existe id de la cuenta bancaria
	    if($intCuentaBancariaID != NULL)
	    {
	    	$this->db->where("AB.cuenta_bancaria_id", $intCuentaBancariaID);
	    } 
	    //Si existe rango de fechas
	    if($dteFechaInicial != NULL && $dteFechaFinal != NULL)
	    {
	   		$this->db->where("AB.fecha BETWEEN '$dteFechaInicial' AND '$dteFechaFinal'", NULL, FALSE);
	    }
	    //Si existe estatus
		if($strEstatus != 'TODOS')
		{
			$this->db->where('AB.estatus', $strEstatus);
		}

	    $this->db->where("((AB.folio LIKE '%$strBusqueda%') OR
        				   (CONCAT_WS(' - ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%') OR
			               (CONCAT_WS(' ', CB.cuenta, CB.descripcion) LIKE '%$strBusqueda%'))"); 

		$this->db->order_by('AB.fecha DESC, AB.folio DESC');
		$this->db->limit($intNumRows, $intPos);
		$arrResultado["ajustes"] =$this->db->get()->result();
		return $arrResultado;
	}

	//Método para regresar los registros activos que coincidan con el criterio de búsqueda proporcionado
	public function autocomplete($strDescripcion)
	{
		$this->db->select(" MI.movimiento_insumo_id,
						    CONCAT(MI.folio, ' - ', E.descripcion) AS movimiento ", FALSE);
        $this->db->from('movimientos_insumos MI');
        $this->db->join('eventos E', 'E.evento_id = MI.evento_id', 'left');
		$this->db->where('MI.estatus', 'ACTIVO');
		$this->db->where('MI.tipo_movimiento', '11');
        $this->db->where("((MI.folio LIKE '%$strDescripcion%') OR (E.descripcion LIKE '%$strDescripcion%'))"); 
		$this->db->order_by('MI.folio', 'ASC');
		$this->db->limit(LIMITE_AUTOCOMPLETE, 0);
	    return $this->db->get()->result();
	}
}
?>